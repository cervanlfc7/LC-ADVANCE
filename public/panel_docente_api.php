<?php
require_once __DIR__ . '/../src/Config/config.php';
require_once __DIR__ . '/../src/Core/panel_docente.php';
requireProfesor();

header('Content-Type: application/json; charset=utf-8');
$action = $_GET['action'] ?? '';
// Allow POST JSON bodies for grade updates
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $raw = file_get_contents('php://input');
    $data = json_decode($raw, true) ?: $_POST;
} else {
    $data = $_GET;
}
if ($action === 'get_student_progress') {
    $grupo_id = isset($_GET['grupo_id']) ? (int)$_GET['grupo_id'] : 0;
    $student_id = isset($_GET['student_id']) ? (int)$_GET['student_id'] : 0;
    if (!$grupo_id || !$student_id) {
        echo json_encode(['error' => 'Parámetros inválidos']); exit;
    }
    $profesor_id = (int)$_SESSION['usuario_id'];
    $progreso = obtenerProgresoDetalleEstudiante($student_id, $grupo_id, $profesor_id);
    $stats = obtenerEstadisticasEstudianteEnGrupo($grupo_id, $student_id);
    echo json_encode(['progreso' => $progreso, 'stats' => $stats]); exit;
}

if ($action === 'group_progress_timeseries') {
    $grupo_id = isset($_GET['grupo_id']) ? (int)$_GET['grupo_id'] : 0;
    $days = isset($_GET['days']) ? (int)$_GET['days'] : 30;
    if (!$grupo_id) { echo json_encode(['error' => 'Parámetros inválidos']); exit; }
    $profesor_id = (int)$_SESSION['usuario_id'];
    $timeseries = obtenerProgresoHistoricoGrupo($grupo_id, $profesor_id, $days);
    echo json_encode(['timeseries' => $timeseries]); exit;
}

// Undo a grade change by change_id
if ($action === 'grade_undo' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $body = json_decode(file_get_contents('php://input'), true);
    $csrf = $body['csrf_token'] ?? '';
    $change_id = isset($body['change_id']) ? (int)$body['change_id'] : 0;
    if (!validarCsrfToken($csrf)) {
        http_response_code(403);
        echo json_encode(['success' => false, 'error' => 'CSRF inválido']);
        exit;
    }
    if ($change_id <= 0) {
        echo json_encode(['success' => false, 'error' => 'change_id inválido']);
        exit;
    }
    // Fetch the grade_change row and verify instructor ownership
    $stmt = $pdo->prepare("SELECT gc.*, g.profesor_id FROM grade_changes gc JOIN grupos g ON gc.grupo_id = g.id WHERE gc.id = ? LIMIT 1");
    $stmt->execute([$change_id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$row) {
        echo json_encode(['success' => false, 'error' => 'Cambio no encontrado']);
        exit;
    }
    $current_user_id = (int)$_SESSION['usuario_id'];
    if ((int)$row['profesor_id'] !== $current_user_id && !esAdmin()) {
        echo json_encode(['success' => false, 'error' => 'No autorizado']);
        exit;
    }
    $old = $row['old_score'];
    $user = (int)$row['user_id'];
    $slug = $row['slug'];
    $grupo_id = (int)$row['grupo_id'];
    if ($old === null) {
        $pdo->prepare("DELETE FROM user_progress WHERE user_id = ? AND slug = ?")->execute([$user, $slug]);
    } else {
        $upd = $pdo->prepare("UPDATE user_progress SET score = ?, completed = ?, updated_at = NOW() WHERE user_id = ? AND slug = ?");
        $upd->execute([$old, 1, $user, $slug]);
        if ($upd->rowCount() === 0) {
            $pdo->prepare("INSERT INTO user_progress (user_id, slug, score, lesson_xp, completed, updated_at) VALUES (?, ?, ?, 0, 1, NOW())")
                ->execute([$user, $slug, $old]);
        }
    }
    $stmt = $pdo->prepare("INSERT INTO grade_changes (grupo_id, user_id, slug, old_score, new_score, changed_by, changed_at, note) VALUES (?, ?, ?, ?, ?, ?, NOW(), ?)");
    $note = 'undo of change_id ' . $change_id . ' by user ' . $current_user_id;
    $stmt->execute([$grupo_id, $user, $slug, $row['new_score'], $row['old_score'], $current_user_id, $note]);
    echo json_encode([
        'success' => true,
        'restored_score' => $old,
        'slug' => $slug,
        'user_id' => $user,
        'grupo_id' => $grupo_id,
        'undo_change_id' => (int)$pdo->lastInsertId(),
    ]);
    exit;
}

// Return grade change history for a user in a group
if ($action === 'grade_history') {
    $grupo_id = isset($data['grupo_id']) ? (int)$data['grupo_id'] : (int)($_GET['grupo_id'] ?? 0);
    $user_id = isset($data['user_id']) ? (int)$data['user_id'] : (int)($_GET['user_id'] ?? 0);
    if (!$grupo_id || !$user_id) { echo json_encode(['error' => 'Parámetros inválidos']); exit; }
    $profesor_id = (int)$_SESSION['usuario_id'];
    // verify ownership
    $stmt = $pdo->prepare('SELECT id FROM grupos WHERE id = ? AND profesor_id = ?'); $stmt->execute([$grupo_id, $profesor_id]);
    if (!$stmt->fetchColumn()) { echo json_encode(['error' => 'No autorizado']); exit; }
    $sql = 'SELECT gc.*, u.nombre_usuario AS changed_by_name FROM grade_changes gc JOIN usuarios u ON gc.changed_by = u.id WHERE gc.grupo_id = ? AND gc.user_id = ? ORDER BY gc.changed_at DESC LIMIT 200';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$grupo_id, $user_id]);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode(['history' => $rows]); exit;
}

// Save/update a grade (AJAX)
if ($action === 'grade_update' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $csrf = $data['csrf_token'] ?? $data['csrf'] ?? '';
    if (!validarCsrfToken($csrf)) {
        echo json_encode(['success' => false, 'error' => 'Token CSRF inválido']); exit;
    }

    
    $grupo_id = isset($data['grupo_id']) ? (int)$data['grupo_id'] : 0;
    $user_id = isset($data['user_id']) ? (int)$data['user_id'] : 0;
    $slug = isset($data['slug']) ? trim($data['slug']) : '';
    $score = array_key_exists('score', $data) ? $data['score'] : null;
    if ($score !== null) { if ($score === '') $score = null; else $score = (int)$score; }
    if (!$grupo_id || !$user_id || $slug === '') {
        echo json_encode(['success' => false, 'error' => 'Parámetros inválidos']); exit;
    }
    $profesor_id = (int)$_SESSION['usuario_id'];
    // verify group ownership
    $stmt = $pdo->prepare('SELECT id FROM grupos WHERE id = ? AND profesor_id = ?'); $stmt->execute([$grupo_id, $profesor_id]);
    if (!$stmt->fetchColumn()) { echo json_encode(['success' => false, 'error' => 'No autorizado']); exit; }
    // verify student in group
    $stmt = $pdo->prepare('SELECT 1 FROM grupo_usuarios WHERE grupo_id = ? AND usuario_id = ?'); $stmt->execute([$grupo_id, $user_id]);
    if (!$stmt->fetchColumn()) { echo json_encode(['success' => false, 'error' => 'Estudiante no pertenece al grupo']); exit; }
    // verify lesson assigned to group
    $stmt = $pdo->prepare('SELECT 1 FROM group_lecciones WHERE grupo_id = ? AND slug = ?'); $stmt->execute([$grupo_id, $slug]);
    if (!$stmt->fetchColumn()) { echo json_encode(['success' => false, 'error' => 'La lección no está asignada a este grupo']); exit; }

    // upsert into user_progress and record audit
    $stmt = $pdo->prepare('SELECT score FROM user_progress WHERE user_id = ? AND slug = ?');
    $stmt->execute([$user_id, $slug]);
    $old_score = $stmt->fetchColumn();
    $exists = $old_score !== false;
    $completed = ($score === null) ? 0 : 1;
    if ($exists) {
        $upd = $pdo->prepare('UPDATE user_progress SET score = ?, completed = ?, updated_at = NOW() WHERE user_id = ? AND slug = ?');
        $upd->execute([$score, $completed, $user_id, $slug]);
    } else {
        $ins = $pdo->prepare('INSERT INTO user_progress (user_id, slug, score, lesson_xp, completed, updated_at) VALUES (?, ?, ?, 0, ?, NOW())');
        $ins->execute([$user_id, $slug, $score, $completed]);
    }
    // audit log (best-effort)
    $audit_id = null;
    try {
        $audit = $pdo->prepare('INSERT INTO grade_changes (grupo_id, user_id, slug, old_score, new_score, changed_by, changed_at) VALUES (?, ?, ?, ?, ?, ?, NOW())');
        $audit->execute([$grupo_id, $user_id, $slug, $old_score === false ? null : $old_score, $score, $profesor_id]);
        $audit_id = (int)$pdo->lastInsertId();
    } catch (Exception $e) {
        // ignore audit failures
    }
    echo json_encode([
        'success' => true,
        'change_id' => $audit_id,
        'old_score' => $old_score === false ? null : $old_score,
        'new_score' => $score,
        'slug' => $slug,
        'user_id' => $user_id,
        'grupo_id' => $grupo_id,
    ]);
    exit;
}

// Export gradebook CSV for a group
if ($action === 'export_gradebook_csv' && isset($data['grupo_id'])) {
    $grupo_id = (int)$data['grupo_id'];
    $profesor_id = (int)$_SESSION['usuario_id'];
    // verify ownership
    $stmt = $pdo->prepare('SELECT id FROM grupos WHERE id = ? AND profesor_id = ?'); $stmt->execute([$grupo_id, $profesor_id]);
    if (!$stmt->fetchColumn()) { echo json_encode(['error' => 'No autorizado']); exit; }
    $assigned = obtenerLeccionesAsignadasGrupo($grupo_id, $profesor_id);
    $students = obtenerEstudiantesGrupo($grupo_id, $profesor_id);
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=gradebook_grupo_'.$grupo_id.'.csv');
    $out = fopen('php://output','w');
    $header = ['Usuario','Correo','Nivel','XP'];
    foreach ($assigned as $s) $header[] = $s;
    fputcsv($out, $header);
    if (!empty($students)) {
        $userIds = array_column($students, 'id');
        $placeholders = implode(',', array_fill(0, count($userIds), '?'));
        $slugPlaceholders = $assigned ? implode(',', array_fill(0, count($assigned), '?')) : '';
        $sql = 'SELECT user_id, slug, score FROM user_progress WHERE user_id IN ('.$placeholders.')';
        if ($assigned) $sql .= ' AND slug IN ('.$slugPlaceholders.')';
        $stmt = $pdo->prepare($sql);
        $params = array_merge($userIds, $assigned);
        $stmt->execute($params);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $map = [];
        foreach ($rows as $r) { $map[$r['user_id']][$r['slug']] = $r['score']; }
        foreach ($students as $st) {
            $row = [$st['nombre_usuario'], $st['correo'], $st['nivel'], $st['puntos']];
            foreach ($assigned as $s) { $row[] = isset($map[$st['id']][$s]) ? $map[$st['id']][$s] : ''; }
            fputcsv($out, $row);
        }
    }
    fclose($out); exit;
}

echo json_encode(['error' => 'Acción no soportada']);
