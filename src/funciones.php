<?php
require_once '../config/config.php';
requireLogin(true); // permitir invitados, también aplica timeout
require_once __DIR__ . '/content.php';

header('Content-Type: application/json');

// Permitir modo invitado (solo lectura)
$is_guest = !empty($_SESSION['usuario_es_invitado']);
if (!isset($_SESSION['usuario_id']) && !$is_guest) {
    echo json_encode(['ok' => false, 'error' => 'No autenticado']);
    exit;
}

$usuario_id = $_SESSION['usuario_id'] ?? 0;
$accion = $_POST['accion'] ?? '';

// Bloquear acciones que intenten guardar estado cuando es invitado
if ($is_guest && in_array($accion, ['completar', 'calificar_quiz'])) {
    echo json_encode(['ok' => false, 'error' => 'Modo invitado: no está permitido guardar progreso.']);
    exit;
}

if ($accion === 'obtener_estado') {
    if ($is_guest) {
        echo json_encode([
            'ok' => true,
            'puntos' => 0,
            'nivel' => 1,
            'progreso' => 0,
            'badges' => [],
            'ranking' => [] // aseguremos que siempre exista `ranking` (evita errores en el cliente)
        ]);
        exit;
    }

    $stmt = $pdo->prepare("SELECT puntos, nivel FROM usuarios WHERE id = ?");
    $stmt->execute([$usuario_id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        echo json_encode(['ok' => false, 'error' => 'Usuario no encontrado']);
        exit;
    }

    $puntos = (int)$user['puntos'];
    $nivel = (int)$user['nivel'];
    $puntos_base = $nivel * 500;
    $progreso = min(100, max(0, (($puntos - $puntos_base) / 500) * 100));

    // === BADGES ===
    $badges = [];
    if ($puntos >= 500) $badges[] = ['nombre' => 'Nivel 1: Novato', 'tipo' => 'bronze'];
    if ($puntos >= 1000) $badges[] = ['nombre' => 'Nivel 2: Explorador', 'tipo' => 'silver'];
    if ($puntos >= 2000) $badges[] = ['nombre' => 'Nivel 3: Élite', 'tipo' => 'gold'];

    // === RANKING TOP 10 ===
    try {
        // Obtener el nombre del usuario actual desde la BD por su ID
        $stmt = $pdo->prepare("SELECT nombre_usuario FROM usuarios WHERE id = ?");
        $stmt->execute([$usuario_id]);
        $usuario_actual = $stmt->fetch(PDO::FETCH_ASSOC);
        $nombre_usuario_actual = $usuario_actual['nombre_usuario'] ?? '';

        // Obtener top 10
        $stmt = $pdo->query("SELECT nombre_usuario, puntos FROM usuarios ORDER BY puntos DESC LIMIT 10");
        $ranking = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Agregar flag para identificar al usuario actual
        foreach ($ranking as &$r) {
            $r['es_actual'] = ($r['nombre_usuario'] === $nombre_usuario_actual);
        }
    } catch (Exception $e) {
        error_log("Error al obtener ranking: " . $e->getMessage());
        $ranking = [];
    }

    echo json_encode([
        'ok' => true,
        'puntos' => $puntos,
        'nivel' => $nivel,
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
    $details = [];

    foreach ($preguntas as $i => $pregunta) {
        $key = "q$i";
        $respuestaUsuario = isset($_POST[$key]) ? trim($_POST[$key]) : '';
        $isCorrect = (strcasecmp($respuestaUsuario, trim($pregunta['correcta'])) === 0);
        if ($isCorrect) {
            $score++;
        }
        // devolver detalle por pregunta
        $details[] = [
            'pregunta' => $pregunta['pregunta'] ?? '',
            'correcta' => $pregunta['correcta'] ?? '',
            'respuesta' => $respuestaUsuario,
            'acertada' => $isCorrect
        ];
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

        // recuperar estado actualizado del usuario
        $stmt = $pdo->prepare("SELECT puntos, nivel FROM usuarios WHERE id = ?");
        $stmt->execute([$usuario_id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        echo json_encode([
            'ok' => true,
            'score' => $score,
            'xp_ganado' => $xp_ganado,
            'details' => $details,
            'new_puntos' => $user['puntos'] ?? 0,
            'new_nivel' => $user['nivel'] ?? 1
        ]);
    } catch (Exception $e) {
        error_log("Error calificar_quiz: " . $e->getMessage());
        echo json_encode(['ok' => false, 'mensaje' => 'Error desconocido del servidor.']);
    }
    exit;
}

echo json_encode(['ok' => false, 'error' => 'Acción no válida']);
?>