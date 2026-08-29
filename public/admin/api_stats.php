<?php
/**
 * LC-ADVANCE — Admin API: Stats
 * Returns JSON of current admin dashboard statistics for the auto-refresh feature.
 * Requires admin session.
 */
require_once __DIR__ . '/../../src/Config/config.php';
require_once __DIR__ . '/../../src/Core/admin.php';

header('Content-Type: application/json; charset=utf-8');
header('X-Content-Type-Options: nosniff');

// Require admin (centralized checks: role, IP allowlist, rate-limit, 2FA)
requireAdmin();

$stats = obtenerStatsAdmin($pdo);
$pass_rate = $stats['quizzes_totales'] > 0
    ? round(100 * $stats['quizzes_aprobados'] / $stats['quizzes_totales'], 1)
    : 0;

echo json_encode([
    'total_usuarios'       => $stats['total_usuarios'],
    'usuarios_hoy'         => $stats['usuarios_hoy'],
    'lecciones_completadas' => $stats['lecciones_completadas'],
    'progresos_totales'    => $stats['progresos_totales'],
    'verificados'          => $stats['verificados'],
    'badges_otorgados'     => $stats['badges_otorgados'],
    'activos_7d'           => $stats['activos_7d'],
    'quizzes_totales'      => $stats['quizzes_totales'],
    'promedio_score'       => $stats['promedio_score'],
    'pass_rate'            => $pass_rate,
], JSON_UNESCAPED_UNICODE);
