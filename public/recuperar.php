<?php
require_once __DIR__ . '/../src/Config/config.php';
require_once __DIR__ . '/../src/Config/csrf.php';
iniciarSesionSegura();

if (isset($_SESSION['usuario_id'])) {
    redirigir('public/dashboard.php');
}

$mensaje = '';
$exito = false;

// Auto-crear tabla si no existe
try {
    $pdo->exec("CREATE TABLE IF NOT EXISTS `password_resets` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `usuario_id` int(11) NOT NULL,
        `token` varchar(128) NOT NULL,
        `expiracion` datetime NOT NULL,
        `usado` tinyint(1) NOT NULL DEFAULT 0,
        `creado_en` timestamp NOT NULL DEFAULT current_timestamp(),
        PRIMARY KEY (`id`),
        KEY `usuario_id` (`usuario_id`),
        KEY `token` (`token`),
        CONSTRAINT `password_resets_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci");
} catch (Exception $e) {}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    protegerCSRF();
    $correo = limpiarEntrada($_POST['correo'] ?? '');

    if (empty($correo) || !filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        $mensaje = '📧 Correo electrónico no válido.';
    } else {
        $stmt = $pdo->prepare("SELECT id, nombre_usuario FROM usuarios WHERE correo = ?");
        $stmt->execute([$correo]);
        $usuario = $stmt->fetch();

        if ($usuario) {
            // Generar token
            $token = bin2hex(random_bytes(64));
            $expiracion = date('Y-m-d H:i:s', strtotime('+1 hour'));

            $stmt = $pdo->prepare("INSERT INTO password_resets (usuario_id, token, expiracion) VALUES (?, ?, ?)");
            $stmt->execute([$usuario['id'], $token, $expiracion]);

            // Construir URL de restablecimiento
            $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
            $host = $_SERVER['HTTP_HOST'];
            $base = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
            $reset_url = "$protocol://$host$base/restablecer.php?token=" . urlencode($token);

            $nombre = htmlspecialchars($usuario['nombre_usuario']);
            $cuerpoHtml = emailTemplate('Recuperación de contraseña', "
                <p>Hola <strong>{$nombre}</strong>,</p>
                <p>Recibimos una solicitud para restablecer tu contraseña. Haz clic en el botón para crear una nueva:</p>
                <p style=\"text-align:center\"><a href=\"{$reset_url}\" class=\"btn\">Restablecer Contraseña</a></p>
                <p style=\"color:#888fa0;font-size:0.82rem\">Este enlace expira en <strong>1 hora</strong>. Si no solicitaste este cambio, ignora este mensaje.</p>
            ");

            enviarEmail($correo, 'Recuperación de contraseña - LC-ADVANCE', $cuerpoHtml);
            logSeguridadEvento('PASSWORD_RESET_REQUEST', "Usuario ID: {$usuario['id']} | Correo: {$correo}", $usuario['id']);
        }

        // Siempre mostrar éxito (seguridad: no revelar si el correo existe)
        $exito = true;
        $mensaje = '✅ Si el correo está registrado, recibirás un enlace para restablecer tu contraseña.';
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?= htmlspecialchars(csrfToken()) ?>">
    <title>Recuperar Contraseña | LC-ADVANCE</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&family=Syne:wght@700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #060a12; --surface: #0d1626; --surface2: #121d33;
            --border: rgba(0,230,255,0.16); --border2: rgba(0,230,255,0.24);
            --cyan: #00e5ff; --pink: #ff3cac; --green: #00ff87;
            --text: #e8f4ff; --muted: rgba(200,230,255,0.64);
            --font-display: "Syne", sans-serif;
            --font-body: "Space Grotesk", sans-serif;
        }
        *, *::before, *::after { box-sizing: border-box; }
        body {
            margin: 0; min-height:100vh; display:flex; align-items:center; justify-content:center;
            font-family: var(--font-body); color: var(--text);
            background: radial-gradient(circle at 30% -10%, rgba(0,229,255,0.15), transparent 40%), radial-gradient(circle at 85% 100%, rgba(255,60,200,0.15), transparent 45%), var(--bg);
        }
        .rec-card {
            background: var(--surface); border:1px solid var(--border); border-radius:16px;
            padding:36px; width:90%; max-width:420px; text-align:center;
        }
        .rec-card h1 { font-family:var(--font-display); font-size:1.3rem; color:var(--cyan); margin:0 0 8px; }
        .rec-card p { color:var(--muted); font-size:0.85rem; margin:0 0 20px; }
        .rec-input {
            width:100%; background:var(--surface2); border:1px solid var(--border2); border-radius:8px;
            padding:12px 16px; color:var(--text); font-family:var(--font-body); font-size:0.9rem;
        }
        .rec-btn {
            width:100%; border:none; border-radius:8px; padding:12px; margin-top:12px;
            background:var(--cyan); color:#000; font-family:'Space Grotesk',sans-serif;
            font-size:0.9rem; font-weight:600; cursor:pointer; transition:all 0.3s;
        }
        .rec-btn:hover { box-shadow:0 0 20px rgba(0,229,255,0.3); }
        .rec-msg { font-size:0.85rem; margin-bottom:16px; font-weight:500; }
        .rec-success { color:var(--green); }
        .rec-error { color:var(--pink); }
        .rec-back { display:block; margin-top:16px; color:var(--cyan); text-decoration:none; font-size:0.85rem; }
        .rec-back:hover { text-decoration:underline; }
    </style>
</head>
<body>
    <div class="rec-card">
        <h1>🔐 Recuperar Contraseña</h1>
        <p>Ingresa tu correo electrónico y te enviaremos un enlace para restablecer tu contraseña.</p>

        <?php if ($mensaje): ?>
            <div class="rec-msg <?= $exito ? 'rec-success' : 'rec-error' ?>"><?= htmlspecialchars($mensaje) ?></div>
        <?php endif; ?>

        <?php if (!$exito): ?>
            <form method="POST">
                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(csrfToken()) ?>">
                <input type="email" name="correo" class="rec-input" placeholder="tu@correo.com" required autocomplete="email">
                <button type="submit" class="rec-btn">Enviar Enlace</button>
            </form>
        <?php else: ?>
            <a href="login.php" class="rec-back">← Volver a Iniciar Sesión</a>
        <?php endif; ?>

        <a href="login.php" class="rec-back">← Iniciar Sesión</a>
    </div>
</body>
</html>
