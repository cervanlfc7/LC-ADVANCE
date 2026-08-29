<?php
require_once __DIR__ . '/../src/Config/config.php';
require_once __DIR__ . '/../src/Config/csrf.php';
iniciarSesionSegura();

// Auto-crear tabla
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

$token = $_GET['token'] ?? $_POST['token'] ?? '';
$valido = false;
$usuario_id = null;
$mensaje = '';
$exito = false;

// Validar token
if (!empty($token)) {
    $stmt = $pdo->prepare("SELECT usuario_id, expiracion, usado FROM password_resets WHERE token = ?");
    $stmt->execute([$token]);
    $row = $stmt->fetch();

    if ($row && !$row['usado'] && strtotime($row['expiracion']) > time()) {
        $valido = true;
        $usuario_id = (int)$row['usuario_id'];
    } else {
        $mensaje = '❌ El enlace es inválido o ha expirado. Solicita uno nuevo.';
    }
}

// Procesar nueva contraseña
if ($valido && $_SERVER['REQUEST_METHOD'] === 'POST') {
    protegerCSRF();
    $nueva = $_POST['password'] ?? '';
    $confirmar = $_POST['password_confirm'] ?? '';

    if (empty($nueva) || empty($confirmar)) {
        $mensaje = 'Todos los campos son obligatorios.';
    } elseif ($nueva !== $confirmar) {
        $mensaje = 'Las contraseñas no coinciden.';
    } elseif (strlen($nueva) < 6) {
        $mensaje = 'La contraseña debe tener al menos 6 caracteres.';
    } else {
        $hash = password_hash($nueva, PASSWORD_DEFAULT);
        $pdo->beginTransaction();
        try {
            $stmt = $pdo->prepare("UPDATE usuarios SET contrasena_hash = ? WHERE id = ?");
            $stmt->execute([$hash, $usuario_id]);

            $stmt = $pdo->prepare("UPDATE password_resets SET usado = 1 WHERE token = ?");
            $stmt->execute([$token]);

            $pdo->commit();
            logSeguridadEvento('PASSWORD_RESET_SUCCESS', "Usuario ID: {$usuario_id}");
            $exito = true;
            $mensaje = '✅ Contraseña restablecida correctamente. Ya puedes iniciar sesión.';
        } catch (Exception $e) {
            $pdo->rollBack();
            $mensaje = 'Error al restablecer. Intenta de nuevo.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?= htmlspecialchars(csrfToken()) ?>">
    <title>Restablecer Contraseña | LC-ADVANCE</title>
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
            margin:0; min-height:100vh; display:flex; align-items:center; justify-content:center;
            font-family:var(--font-body); color:var(--text);
            background: radial-gradient(circle at 30% -10%, rgba(0,229,255,0.15), transparent 40%), radial-gradient(circle at 85% 100%, rgba(255,60,200,0.15), transparent 45%), var(--bg);
        }
        .rs-card {
            background:var(--surface); border:1px solid var(--border); border-radius:16px;
            padding:36px; width:90%; max-width:420px; text-align:center;
        }
        .rs-card h1 { font-family:var(--font-display); font-size:1.3rem; color:var(--cyan); margin:0 0 8px; }
        .rs-card p { color:var(--muted); font-size:0.85rem; margin:0 0 20px; }
        .rs-input {
            width:100%; background:var(--surface2); border:1px solid var(--border2); border-radius:8px;
            padding:12px 16px; color:var(--text); font-family:var(--font-body); font-size:0.9rem; margin-bottom:10px;
        }
        .rs-btn {
            width:100%; border:none; border-radius:8px; padding:12px;
            background:var(--cyan); color:#000; font-family:'Space Grotesk',sans-serif;
            font-size:0.9rem; font-weight:600; cursor:pointer; transition:all 0.3s;
        }
        .rs-btn:hover { box-shadow:0 0 20px rgba(0,229,255,0.3); }
        .rs-msg { font-size:0.85rem; margin-bottom:16px; font-weight:500; }
        .rs-success { color:var(--green); }
        .rs-error { color:var(--pink); }
        .rs-back { display:block; margin-top:16px; color:var(--cyan); text-decoration:none; font-size:0.85rem; }
        .rs-back:hover { text-decoration:underline; }
    </style>
</head>
<body>
    <div class="rs-card">
        <h1>🔑 Restablecer Contraseña</h1>

        <?php if ($mensaje): ?>
            <div class="rs-msg <?= $exito ? 'rs-success' : 'rs-error' ?>"><?= htmlspecialchars($mensaje) ?></div>
        <?php endif; ?>

        <?php if ($exito): ?>
            <a href="login.php" class="rs-btn" style="display:block;text-decoration:none;">Iniciar Sesión</a>
        <?php elseif ($valido): ?>
            <p>Elige una nueva contraseña para tu cuenta.</p>
            <form method="POST">
                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(csrfToken()) ?>">
                <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">
                <input type="password" name="password" class="rs-input" placeholder="Nueva contraseña" minlength="6" required autocomplete="new-password">
                <input type="password" name="password_confirm" class="rs-input" placeholder="Confirmar contraseña" minlength="6" required autocomplete="new-password">
                <button type="submit" class="rs-btn">Restablecer</button>
            </form>
        <?php else: ?>
            <p>El enlace es inválido o ha expirado.</p>
            <a href="recuperar.php" class="rs-btn" style="display:block;text-decoration:none;">Solicitar Nuevo Enlace</a>
        <?php endif; ?>

        <a href="login.php" class="rs-back">← Iniciar Sesión</a>
    </div>
</body>
</html>
