<?php
/**
 * LC-ADVANCE — Admin API: User Progress
 * Returns JSON with lesson progress, badges, and quick stats for a given user.
 * Requires admin session.
 */
require_once __DIR__ . '/../../src/Config/config.php';
require_once __DIR__ . '/../../src/Core/admin.php';

header('Content-Type: application/json; charset=utf-8');
header('X-Content-Type-Options: nosniff');

// Centralized admin checks
requireAdmin();

$uid = (int)($_GET['uid'] ?? 0);
if ($uid <= 0) {
    http_response_code(400);
    echo json_encode(['error' => 'ID de usuario inválido']);
    exit;
}

// Basic user info
$stmt = $pdo->prepare(
    "SELECT id, nombre_usuario, correo, puntos, nivel, tipo, racha_actual, protectores_racha, creado_en
     FROM usuarios WHERE id = ?"
);
$stmt->execute([$uid]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$usuario) {
    http_response_code(404);
    echo json_encode(['error' => 'Usuario no encontrado']);
    exit;
}

// Lesson progress — column is `slug`, timestamp is `updated_at`
$stmt = $pdo->prepare(
    "SELECT slug AS leccion_slug, completed, score, lesson_xp, updated_at
     FROM user_progress
     WHERE user_id = ?
     ORDER BY updated_at DESC"
);
$stmt->execute([$uid]);
$progreso = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Badges earned — badges table uses `nombre_badge`; usuarios_badges uses `obtenido_en`
$stmt = $pdo->prepare(
    "SELECT b.nombre_badge AS nombre, b.icono, b.descripcion, ub.obtenido_en AS fecha_obtencion
     FROM usuarios_badges ub
     JOIN badges b ON b.id = ub.badge_id
     WHERE ub.usuario_id = ?
     ORDER BY ub.obtenido_en DESC"
);
$stmt->execute([$uid]);
$badges = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Quick stats
$completadas = count(array_filter($progreso, fn($p) => (bool)$p['completed']));
$scores      = array_column(
    array_filter($progreso, fn($p) => $p['score'] !== null),
    'score'
);
$avg_score = count($scores) > 0 ? round(array_sum($scores) / count($scores), 1) : null;

echo json_encode([
    'usuario'  => $usuario,
    'progreso' => $progreso,
    'badges'   => $badges,
    'stats'    => [
        'lecciones_visitadas'   => count($progreso),
        'lecciones_completadas' => $completadas,
        'badges_total'          => count($badges),
        'avg_score'             => $avg_score,
    ],
], JSON_UNESCAPED_UNICODE);
