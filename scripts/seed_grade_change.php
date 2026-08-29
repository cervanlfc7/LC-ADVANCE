<?php
require_once __DIR__ . '/../src/Config/config.php';

try {
    // find a group
    $res = $pdo->query('SELECT id, profesor_id FROM grupos LIMIT 1');
    if ($res === false) { $err = $pdo->errorInfo(); echo "SQL error: {$err[2]}\n"; exit(1); }
    $g = $res->fetch(PDO::FETCH_ASSOC);
    if (!$g) { echo "No hay grupos. Crea un grupo desde el panel docente y vuelve a ejecutar.\n"; exit(1); }
    $grupo_id = (int)$g['id'];

    // find a student in the group
    $stu = $pdo->prepare('SELECT usuario_id FROM grupo_usuarios WHERE grupo_id = ? LIMIT 1');
    $stu->execute([$grupo_id]);
    $row = $stu->fetch(PDO::FETCH_ASSOC);
    if ($row) { $user_id = (int)$row['usuario_id']; }
    else {
        // fallback: pick any non-teacher user
        $uRes = $pdo->query("SELECT id FROM usuarios WHERE tipo IS NULL OR tipo != 'teacher' LIMIT 1");
        if ($uRes === false) { $err = $pdo->errorInfo(); echo "SQL error: {$err[2]}\n"; exit(1); }
        $u = $uRes->fetch(PDO::FETCH_ASSOC);
        if (!$u) {
            // create a temporary test student
            $email = 'seed_test_' . time() . '@example.test';
            $name = 'seed_user_' . time();
            $pw = password_hash('changeme', PASSWORD_DEFAULT);
            $ins = $pdo->prepare('INSERT INTO usuarios (nombre_usuario, correo, contrasena_hash, tipo, creado_en) VALUES (?, ?, ?, ?, NOW())');
            $ins->execute([$name, $email, $pw, 'student']);
            $user_id = (int)$pdo->lastInsertId();
            echo "Usuario temporal {$user_id} creado y añadido al grupo {$grupo_id}.\n";
            $pdo->prepare('INSERT IGNORE INTO grupo_usuarios (grupo_id, usuario_id) VALUES (?, ?)')->execute([$grupo_id, $user_id]);
        } else {
            $user_id = (int)$u['id'];
            // insert into grupo_usuarios
            $pdo->prepare('INSERT IGNORE INTO grupo_usuarios (grupo_id, usuario_id) VALUES (?, ?)')->execute([$grupo_id, $user_id]);
            echo "Usuario {$user_id} añadido al grupo {$grupo_id}.\n";
        }
    }

    // find an assigned lesson for the group
    $s = $pdo->prepare('SELECT slug FROM group_lecciones WHERE grupo_id = ? LIMIT 1');
    $s->execute([$grupo_id]);
    $r = $s->fetch(PDO::FETCH_ASSOC);
    if ($r) { $slug = $r['slug']; }
    else {
        // try to pick a lesson from cache
        $cacheFile = __DIR__ . '/../cache/lecciones_compiled.php';
        if (file_exists($cacheFile)) {
            $data = include $cacheFile; // returns array of lessons keyed by slug or numeric
            // pick first key that looks like a slug
            $slug = null;
            if (is_array($data)) {
                foreach ($data as $k => $v) { if (is_string($k) && $k !== '') { $slug = $k; break; } if (isset($v['slug'])) { $slug = $v['slug']; break; } }
            }
        }
        if (empty($slug)) { echo "No se encontró lección para asignar. Asigna una lección al grupo y reintenta.\n"; exit(1); }
        // assign to group
        $pdo->prepare('INSERT IGNORE INTO group_lecciones (grupo_id, slug) VALUES (?, ?)')->execute([$grupo_id, $slug]);
        echo "Lección '{$slug}' asignada al grupo {$grupo_id}.\n";
    }

    // determine existing score
    $stmt = $pdo->prepare('SELECT id, score FROM user_progress WHERE user_id = ? AND slug = ? LIMIT 1');
    $stmt->execute([$user_id, $slug]);
    $existing = $stmt->fetch(PDO::FETCH_ASSOC);
    $old_score = $existing ? $existing['score'] : null;
    $new_score = 78; // sample new score

    if ($existing) {
        $upd = $pdo->prepare('UPDATE user_progress SET score = ?, completed = 1, updated_at = NOW() WHERE id = ?');
        $upd->execute([$new_score, $existing['id']]);
    } else {
        $ins = $pdo->prepare('INSERT INTO user_progress (user_id, slug, score, lesson_xp, completed) VALUES (?, ?, ?, 0, 1)');
        $ins->execute([$user_id, $slug, $new_score]);
    }

    // record audit
    // choose changed_by as group's profesor_id if available
    $changed_by = isset($g['profesor_id']) ? (int)$g['profesor_id'] : 1;
    $aud = $pdo->prepare('INSERT INTO grade_changes (grupo_id, user_id, slug, old_score, new_score, changed_by, note, changed_at) VALUES (?, ?, ?, ?, ?, ?, ?, NOW())');
    $note = 'seed entry';
    $aud->execute([$grupo_id, $user_id, $slug, $old_score === null ? null : (int)$old_score, $new_score, $changed_by, $note]);
    $change_id = $pdo->lastInsertId();
    echo "Seed created: group={$grupo_id} user={$user_id} slug={$slug} new_score={$new_score} change_id={$change_id}\n";
    exit(0);

} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    exit(1);
}
