<?php
session_start();
require_once '../config/config.php';
// Cargar las lecciones para poder evaluar correctamente las preguntas
require_once __DIR__ . '/content.php';

header('Content-Type: application/json');

if (!isset($_SESSION['usuario_id'])) {
    echo json_encode(['ok' => false, 'error' => 'No autenticado']);
    exit;
}

$usuario_id = $_SESSION['usuario_id'];
$accion = $_POST['accion'] ?? '';

if ($accion === 'obtener_estado') {
    $stmt = $pdo->prepare("SELECT puntos, nivel FROM usuarios WHERE id = ?");
    $stmt->execute([$usuario_id]);
    $user = $stmt->fetch();

    $progreso = ($user['puntos'] % 500) / 5;

    // === BADGES ===
    $badges = [];
    if ($user['puntos'] >= 500) $badges[] = ['nombre' => 'Nivel 1', 'tipo' => 'bronze'];
    if ($user['puntos'] >= 1000) $badges[] = ['nombre' => 'Nivel 2', 'tipo' => 'silver'];
    if ($user['puntos'] >= 2000) $badges[] = ['nombre' => 'Nivel 3', 'tipo' => 'gold'];

    // === RANKING ===
    $stmt = $pdo->query("SELECT nombre_usuario, puntos FROM usuarios ORDER BY puntos DESC LIMIT 10");
    $ranking = $stmt->fetchAll();
    foreach ($ranking as &$r) {
        $r['es_actual'] = ($r['nombre_usuario'] === $_SESSION['usuario_nombre']);
    }

    echo json_encode([
        'ok' => true,
        'puntos' => $user['puntos'],
        'nivel' => $user['nivel'],
        'progreso' => $progreso,
        'badges' => $badges,
        'ranking' => $ranking
    ]);
    exit;
}

if ($accion === 'calificar_quiz') {
    // Recibe: slug, respuestas
    $slug = $_POST['slug'] ?? '';
    if (!$slug) {
        echo json_encode(['ok' => false, 'mensaje' => 'Slug faltante']);
        exit;
    }
    // Busca la lección por slug
    $leccion = null;
    foreach ($lecciones as $l) {
        if ($l['slug'] === $slug) {
            $leccion = $l;
            break;
        }
    }
    if (!$leccion) {
        echo json_encode(['ok' => false, 'mensaje' => 'Lección no encontrada']);
        exit;
    }

    // Si hay un quiz activo en sesión y coincide el slug, usar esas preguntas (evita desajuste por slicing/shuffle)
    if (isset($_SESSION['current_quiz']) && is_array($_SESSION['current_quiz']) && ($_SESSION['current_quiz']['slug'] ?? '') === $slug) {
        $preguntas = $_SESSION['current_quiz']['preguntas'];
    } else {
        // Fallback: usar todo el pool de preguntas de la lección
        $preguntas = $leccion['quiz'];
    }
    $score = 0;
    $numPreguntas = count($preguntas);

    foreach ($preguntas as $i => $pregunta) {
        $key = "q$i";
        $respuestaUsuario = $_POST[$key] ?? '';
        if (strcasecmp(trim($respuestaUsuario), trim($pregunta['correcta'])) === 0) {
            $score++;
        }
    }

    $xp_ganado = $score * 10;

    // Guarda progreso en la base de datos
    try {
        $stmt = $pdo->prepare("SELECT * FROM user_progress WHERE user_id = ? AND slug = ?");
        $stmt->execute([$usuario_id, $slug]);
        $progress = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($progress) {
            $pdo->prepare("UPDATE user_progress SET score = ?, lesson_xp = ?, completed = 1 WHERE user_id = ? AND slug = ?")
                ->execute([$score, $xp_ganado, $usuario_id, $slug]);
        } else {
            $pdo->prepare("INSERT INTO user_progress (user_id, slug, score, lesson_xp, completed) VALUES (?, ?, ?, ?, 1)")
                ->execute([$usuario_id, $slug, $score, $xp_ganado]);
        }

        $pdo->prepare("UPDATE usuarios SET puntos = puntos + ? WHERE id = ?")
            ->execute([$xp_ganado, $usuario_id]);

        echo json_encode(['ok' => true, 'score' => $score, 'xp_ganado' => $xp_ganado]);
    } catch (Exception $e) {
        error_log("Error calificar_quiz: " . $e->getMessage());
        echo json_encode(['ok' => false, 'mensaje' => 'Error desconocido del servidor.']);
    }
    exit;
}

echo json_encode(['ok' => false, 'error' => 'Acción no válida']);
?>