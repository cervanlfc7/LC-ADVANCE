<?php
// ============================================
// API - Obtener Ranking
// ============================================
@session_start();

header('Content-Type: application/json; charset=utf-8');
header('X-Powered-By: LC-ADVANCE');

// Requerir autenticación
if (!isset($_SESSION['usuario_id']) && empty($_SESSION['usuario_es_invitado'])) {
    http_response_code(401);
    echo json_encode(['ok' => false, 'error' => 'No autenticado']);
    exit;
}

require_once __DIR__ . '/../config/config.php';

$usuario_id = $_SESSION['usuario_id'] ?? 0;
$is_guest = !empty($_SESSION['usuario_es_invitado']);

// Si es invitado, devolver datos vacíos
if ($is_guest) {
    echo json_encode([
        'ok' => true,
        'puntos' => 0,
        'nivel' => 1,
        'progreso' => 0,
        'badges' => [],
        'ranking' => []
    ]);
    exit;
}

try {
    // Obtener datos del usuario actual
    $stmt = $pdo->prepare("SELECT nombre_usuario, puntos, nivel FROM usuarios WHERE id = ?");
    $stmt->execute([$usuario_id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        http_response_code(404);
        echo json_encode(['ok' => false, 'error' => 'Usuario no encontrado']);
        exit;
    }

    $nombre_usuario_actual = $user['nombre_usuario'];
    $puntos = (int)$user['puntos'];
    $nivel = (int)$user['nivel'];
    $puntos_base = $nivel * 500;
    $progreso = min(100, max(0, (($puntos - $puntos_base) / 500) * 100));

    // Badges
    $badges = [];
    if ($puntos >= 500) $badges[] = ['nombre' => 'Nivel 1: Novato', 'tipo' => 'bronze'];
    if ($puntos >= 1000) $badges[] = ['nombre' => 'Nivel 2: Explorador', 'tipo' => 'silver'];
    if ($puntos >= 2000) $badges[] = ['nombre' => 'Nivel 3: Élite', 'tipo' => 'gold'];

    // Top 10 ranking
    $stmt = $pdo->query("SELECT id, nombre_usuario, puntos FROM usuarios ORDER BY puntos DESC LIMIT 10");
    $ranking = [];
    
    if ($stmt) {
        $ranking = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Marcar al usuario actual
        foreach ($ranking as &$r) {
            $r['es_actual'] = ($r['nombre_usuario'] === $nombre_usuario_actual) ? true : false;
        }
    }

    http_response_code(200);
    echo json_encode([
        'ok' => true,
        'puntos' => $puntos,
        'nivel' => $nivel,
        'progreso' => $progreso,
        'badges' => $badges,
        'ranking' => $ranking
    ]);

} catch (Exception $e) {
    error_log("Error en ranking API: " . $e->getMessage());
    http_response_code(500);
    echo json_encode([
        'ok' => false,
        'error' => $e->getMessage()
    ]);
}

