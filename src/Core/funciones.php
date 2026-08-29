<?php
require_once __DIR__ . '/../Config/config.php';
requireLogin(true); // permitir invitados, también aplica timeout
require_once __DIR__ . '/../Content/content.php';
require_once __DIR__ . '/../Core/daily_quests.php';
require_once __DIR__ . '/../Core/notificaciones.php';
require_once __DIR__ . '/../Core/logros.php';

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

// ================================
// CSRF VALIDATION (write actions only)
// ================================
$csrf_write_actions = ['calificar_quiz', 'completar', 'calificar_examen_final', 'reclamar_mision', 'completar_onboarding', 'leer_notificacion', 'leer_todas_notificaciones', 'reenviar_verificacion'];
if (in_array($accion, $csrf_write_actions, true)) {
    $token = $_POST['csrf_token'] ?? '';
    if (!validarCsrfToken($token)) {
        echo json_encode(['ok' => false, 'error' => 'Token CSRF inválido.']);
        exit;
    }
}

// ================================
// RATE LIMITING para API
// ================================
$ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
$api_limit_key = "api_rate_{$ip}";

if (!isset($_SESSION[$api_limit_key])) {
    $_SESSION[$api_limit_key] = ['count' => 0, 'first' => time()];
}
$_SESSION[$api_limit_key]['count']++;

// Reset después de 60 segundos
if (time() - $_SESSION[$api_limit_key]['first'] > 60) {
    $_SESSION[$api_limit_key] = ['count' => 0, 'first' => time()];
}

// Limitar a 30 requests por minuto
if ($_SESSION[$api_limit_key]['count'] > 30) {
    error_log("Rate limit exceeded: IP {$ip}, accion {$accion}");
    echo json_encode(['ok' => false, 'error' => 'Demasiadas solicitudes. Espera un momento.']);
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
    } catch (\Throwable $e) {
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
    // Busca la lección por slug (usa caché de memoria)
    $leccion = buscarLeccion($slug);
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

    try {
        $s = $pdo->prepare("SELECT puntos FROM usuarios WHERE id = ?");
        $s->execute([$usuario_id]);
        $puntos_antes = (int)$s->fetchColumn();

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
    } catch (\Throwable $e) {
        error_log("Error calificar_quiz (critico): " . $e->getMessage());
        echo json_encode(['ok' => false, 'mensaje' => 'Error al guardar progreso.']);
        exit;
    }

    // Operaciones no críticas (ignorar errores individuales)
    try { actualizarProgresoMision($usuario_id, 'completar_lecciones'); } catch (\Throwable $e) { error_log("calificar_quiz: mision completar_lecciones: " . $e->getMessage()); }
    try { actualizarProgresoMision($usuario_id, 'ganar_xp', $xp_ganado); } catch (\Throwable $e) { error_log("calificar_quiz: mision ganar_xp: " . $e->getMessage()); }
    if ($score > 0 && $score === $numPreguntas) {
        try { actualizarProgresoMision($usuario_id, 'quiz_perfecto'); } catch (\Throwable $e) { error_log("calificar_quiz: mision quiz_perfecto: " . $e->getMessage()); }
        try { crearNotificacion($usuario_id, 'badge', '🎯 ¡Puntaje Perfecto!', "Acertaste todas las preguntas en {$leccion['titulo']}."); } catch (\Throwable $e) { error_log("calificar_quiz: notificacion: " . $e->getMessage()); }
    }
    try { logSeguridadEvento('QUIZ_COMPLETE', "Slug: {$slug} | Score: {$score}/{$numPreguntas} | XP: {$xp_ganado}", $usuario_id); } catch (\Throwable $e) { error_log("calificar_quiz: log: " . $e->getMessage()); }
    try { verificarSubidaNivel($usuario_id, $puntos_antes, $puntos_antes + $xp_ganado); } catch (\Throwable $e) { error_log("calificar_quiz: subida_nivel: " . $e->getMessage()); }
    try { verificarLogros($usuario_id, $pdo); } catch (\Throwable $e) { error_log("calificar_quiz: logros: " . $e->getMessage()); }

    $user = ['puntos' => 0, 'nivel' => 1];
    try {
        $stmt = $pdo->prepare("SELECT puntos, nivel FROM usuarios WHERE id = ?");
        $stmt->execute([$usuario_id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (\Throwable $e) { error_log("calificar_quiz: fetch final: " . $e->getMessage()); }

    echo json_encode([
        'ok' => true,
        'score' => $score,
        'xp_ganado' => $xp_ganado,
        'details' => $details,
        'new_puntos' => $user['puntos'] ?? 0,
        'new_nivel' => $user['nivel'] ?? 1
    ]);
    exit;
}

if ($accion === 'calificar_examen_final') {
    $slug = $_POST['slug'] ?? 'examen_final_general';
    $score = intval($_POST['score'] ?? 0);
    $max_score = 10;
    
    // XP basado en el score (ej: score 10 = 100 XP)
    $xp_ganado = $score * 10;

    try {
        // Guardar en user_progress
        $stmt = $pdo->prepare("SELECT * FROM user_progress WHERE user_id = ? AND slug = ?");
        $stmt->execute([$usuario_id, $slug]);
        $progress = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($progress) {
            // Solo actualizar si el nuevo score es mayor
            if ($score > $progress['score']) {
                $pdo->prepare("UPDATE user_progress SET score = ?, lesson_xp = ?, completed = 1 WHERE user_id = ? AND slug = ?")
                    ->execute([$score, $xp_ganado, $usuario_id, $slug]);
            }
        } else {
            $pdo->prepare("INSERT INTO user_progress (user_id, slug, score, lesson_xp, completed) VALUES (?, ?, ?, ?, 1)")
                ->execute([$usuario_id, $slug, $score, $xp_ganado]);
        }

        actualizarProgresoMision($usuario_id, 'ganar_xp', $xp_ganado);
        if ($score >= 8) {
            actualizarProgresoMision($usuario_id, 'examen_aprobado');
        }

        $pdo->prepare("UPDATE usuarios SET puntos = puntos + ? WHERE id = ?")
            ->execute([$xp_ganado, $usuario_id]);

        logSeguridadEvento('EXAM_COMPLETE', "Slug: {$slug} | Score: {$score}/{$max_score} | XP: {$xp_ganado}", $usuario_id);

        echo json_encode([
            'ok' => true,
            'xp_ganado' => $xp_ganado,
            'score' => $score
        ]);
    } catch (\Throwable $e) {
        error_log("Error calificar_examen_final: " . $e->getMessage());
        echo json_encode(['ok' => false, 'error' => 'Error al guardar progreso del examen.']);
    }
    exit;
}

if ($accion === 'completar') {
    $slug = $_POST['leccion'] ?? '';
    if (!$slug) {
        echo json_encode(['ok' => false, 'error' => 'Slug de lección faltante']);
        exit;
    }
    $leccion = buscarLeccion($slug);
    if (!$leccion) {
        echo json_encode(['ok' => false, 'error' => 'Lección no encontrada']);
        exit;
    }

    $xp_ganado = 50; // XP base por leer/completar una lección sin quiz

    try {
        $s = $pdo->prepare("SELECT puntos FROM usuarios WHERE id = ?");
        $s->execute([$usuario_id]);
        $puntos_antes = (int)$s->fetchColumn();

        $stmt = $pdo->prepare("SELECT * FROM user_progress WHERE user_id = ? AND slug = ?");
        $stmt->execute([$usuario_id, $slug]);
        $progress = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($progress) {
            // Ya completado anteriormente: no otorgar doble XP
            $xp_ganado = 0;
            if (!$progress['completed']) {
                $pdo->prepare("UPDATE user_progress SET completed = 1 WHERE user_id = ? AND slug = ?")
                    ->execute([$usuario_id, $slug]);
            }
        } else {
            $pdo->prepare("INSERT INTO user_progress (user_id, slug, score, lesson_xp, completed) VALUES (?, ?, 0, ?, 1)")
                ->execute([$usuario_id, $slug, $xp_ganado]);
            
            $pdo->prepare("UPDATE usuarios SET puntos = puntos + ? WHERE id = ?")
                ->execute([$xp_ganado, $usuario_id]);
        }
        
        if ($xp_ganado > 0) {
            try { actualizarProgresoMision($usuario_id, 'completar_lecciones'); } catch (\Throwable $e) {}
            try { actualizarProgresoMision($usuario_id, 'ganar_xp', $xp_ganado); } catch (\Throwable $e) {}
            try { verificarSubidaNivel($usuario_id, $puntos_antes, $puntos_antes + $xp_ganado); } catch (\Throwable $e) {}
        }
        
        try { verificarLogros($usuario_id, $pdo); } catch (\Throwable $e) {}
        try { logSeguridadEvento('LESSON_COMPLETE', "Slug: {$slug} | XP: {$xp_ganado}", $usuario_id); } catch (\Throwable $e) {}

        $stmt = $pdo->prepare("SELECT puntos, nivel FROM usuarios WHERE id = ?");
        $stmt->execute([$usuario_id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Cargar badges actuales formateados como espera app.js
        $badges_db = obtenerLogrosUsuario($usuario_id, $pdo);
        $badges = [];
        foreach ($badges_db as $b) {
            if ($b['obtenido']) {
                $tipo = 'bronze';
                if ($b['id'] >= 8) $tipo = 'gold';
                elseif ($b['id'] >= 5) $tipo = 'silver';
                $badges[] = ['nombre' => $b['nombre'], 'tipo' => $tipo];
            }
        }

        echo json_encode([
            'ok' => true,
            'puntos' => (int)($user['puntos'] ?? 0),
            'nivel' => (int)($user['nivel'] ?? 1),
            'badges' => $badges
        ]);
    } catch (\Throwable $e) {
        error_log("Error completar leccion: " . $e->getMessage());
        echo json_encode(['ok' => false, 'error' => 'Error al guardar progreso de lección.']);
    }
    exit;
}

if ($accion === 'reclamar_mision') {
    $quest_id = (int)($_POST['quest_id'] ?? 0);
    if ($is_guest) {
        echo json_encode(['success' => false, 'error' => 'Modo invitado no permite reclamar recompensas']);
        exit;
    }
    $resultado = reclamarRecompensaMision($quest_id, $usuario_id);
    echo json_encode($resultado);
    exit;
}

if ($accion === 'leer_notificacion') {
    $notif_id = (int)($_POST['notif_id'] ?? 0);
    if ($notif_id && !$is_guest) marcarNotificacionLeida($notif_id, $usuario_id);
    echo json_encode(['ok' => true]);
    exit;
}

if ($accion === 'leer_todas_notificaciones') {
    if (!$is_guest) marcarTodasLeidas($usuario_id);
    echo json_encode(['ok' => true]);
    exit;
}

if ($accion === 'completar_onboarding') {
    if (!$is_guest) {
        try {
            $stmt = $pdo->prepare("SELECT id FROM badges WHERE nombre_badge = 'Primer Paso'");
            $stmt->execute();
            $badge = $stmt->fetchColumn();
            if ($badge) {
                $stmt = $pdo->prepare("INSERT IGNORE INTO usuarios_badges (usuario_id, badge_id) VALUES (?, ?)");
                $stmt->execute([$usuario_id, $badge]);
            }
        } catch (\Throwable $e) {}
    }
    echo json_encode(['ok' => true]);
    exit;
}

if ($accion === 'reenviar_verificacion') {
    $stmt = $pdo->prepare("SELECT correo, email_verified, nombre_usuario FROM usuarios WHERE id = ?");
    $stmt->execute([$usuario_id]);
    $user = $stmt->fetch();
    if (!$user || $user['email_verified']) {
        echo json_encode(['ok' => false, 'error' => 'Tu correo ya está verificado.']);
        exit;
    }
    $verify_token = bin2hex(random_bytes(32));
    $pdo->prepare("UPDATE usuarios SET email_verify_token = ? WHERE id = ?")->execute([$verify_token, $usuario_id]);
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST'];
    $verify_url = "$protocol://$host/public/verificar.php?token=" . urlencode($verify_token);
    $nombre = htmlspecialchars($user['nombre_usuario']);
    $cuerpoHtml = emailTemplate('Verificación de correo', "
        <p>Hola <strong>{$nombre}</strong>,</p>
        <p>Haz clic en el botón para verificar tu correo:</p>
        <p style=\"text-align:center\"><a href=\"{$verify_url}\" class=\"btn\">Verificar Correo</a></p>
        <p style=\"color:#888fa0;font-size:0.82rem\">Si no creaste una cuenta, ignora este mensaje.</p>
    ");
    $ok = enviarEmail($user['correo'], 'Verifica tu correo - LC-ADVANCE', $cuerpoHtml);
    echo json_encode(['ok' => $ok, 'error' => $ok ? null : 'Error al enviar el correo.']);
    exit;
}

echo json_encode(['ok' => false, 'error' => 'Acción no válida']);
?>