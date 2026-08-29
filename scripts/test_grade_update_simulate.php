<?php
require_once __DIR__ . '/../src/Config/config.php';
require_once __DIR__ . '/../src/Core/panel_docente.php';

// Find or create a group and student for testing
$profesor_id = 1;
$g = $pdo->query('SELECT id FROM grupos WHERE profesor_id = '.$profesor_id.' LIMIT 1')->fetch(PDO::FETCH_ASSOC);
if (!$g) {
    $g = crearGrupo($profesor_id, 'TEST_GRADE_SIM_'.time());
    $group_id = $g['id'];
} else {
    $group_id = (int)$g['id'];
}

$stu = $pdo->query('SELECT usuario_id FROM grupo_usuarios WHERE grupo_id = '.$group_id.' LIMIT 1')->fetch(PDO::FETCH_ASSOC);
if ($stu) { $user_id = (int)$stu['usuario_id']; }
else {
    $u = $pdo->query("SELECT id FROM usuarios LIMIT 1")->fetch(PDO::FETCH_ASSOC);
    if (!$u) { echo "No users available\n"; exit(1); }
    $user_id = (int)$u['id'];
    $pdo->prepare('INSERT IGNORE INTO grupo_usuarios (grupo_id, usuario_id) VALUES (?, ?)')->execute([$group_id, $user_id]);
}

$s = $pdo->query('SELECT slug FROM group_lecciones WHERE grupo_id = '.$group_id.' LIMIT 1')->fetch(PDO::FETCH_ASSOC);
if ($s) { $slug = $s['slug']; }
else {
    $less = obtenerLecciones();
    if (empty($less)) { echo "No lessons\n"; exit(1); }
    $slug = $less[0]['slug'];
    $pdo->prepare('INSERT IGNORE INTO group_lecciones (grupo_id, slug) VALUES (?, ?)')->execute([$group_id, $slug]);
}

echo "Simulating grade update: group={$group_id}, user={$user_id}, slug={$slug}\n";

// simulate grade_update logic
$stmt = $pdo->prepare('SELECT score FROM user_progress WHERE user_id = ? AND slug = ?');
$stmt->execute([$user_id, $slug]);
$old = $stmt->fetchColumn();
$score = rand(50, 95);
$completed = 1;
if ($old !== false) {
    $upd = $pdo->prepare('UPDATE user_progress SET score = ?, completed = ?, updated_at = NOW() WHERE user_id = ? AND slug = ?');
    $upd->execute([$score, $completed, $user_id, $slug]);
} else {
    $ins = $pdo->prepare('INSERT INTO user_progress (user_id, slug, score, lesson_xp, completed) VALUES (?, ?, ?, 0, ?)');
    $ins->execute([$user_id, $slug, $score, $completed]);
}

// insert audit
$aud = $pdo->prepare('INSERT INTO grade_changes (grupo_id, user_id, slug, old_score, new_score, changed_by, changed_at) VALUES (?, ?, ?, ?, ?, ?, NOW())');
$aud->execute([$group_id, $user_id, $slug, $old === false ? null : $old, $score, $profesor_id]);
$cid = $pdo->lastInsertId();
echo "Inserted grade_changes id={$cid}\n";

// verify
$v = $pdo->prepare('SELECT * FROM grade_changes WHERE id = ?'); $v->execute([$cid]); $row = $v->fetch(PDO::FETCH_ASSOC);
if ($row) { echo "OK: audit row present: "; print_r($row); } else { echo "Audit missing\n"; }

echo "Done.\n";
