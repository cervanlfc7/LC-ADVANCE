<?php
// ==========================================
// LC-ADVANCE - register.php
// ==========================================
// Autor: LC-TEAM
// Fecha: 2025-10-29
// Descripción: Registro de nuevos usuarios
// ==========================================

require_once __DIR__ . '/../src/Config/config.php';
// Iniciamos sesión de forma segura y consistente
iniciarSesionSegura();
require_once __DIR__ . '/../src/Config/csrf.php';

// Si el usuario ya está logueado, redirigir
if (isset($_SESSION['usuario_id'])) {
    redirigir('public/dashboard.php');
}

// Variables de mensaje
$mensaje = '';
$exito = false;

// Procesar formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    protegerCSRF();

    $nombre_usuario = limpiarEntrada($_POST['nombre_usuario'] ?? '');
    $correo = limpiarEntrada($_POST['correo'] ?? '');
    $contrasena = $_POST['contrasena'] ?? '';
    $confirmar = $_POST['confirmar'] ?? '';

    // Validaciones básicas
    if (empty($nombre_usuario) || empty($correo) || empty($contrasena) || empty($confirmar)) {
        $mensaje = '⚠️ Todos los campos son obligatorios.';
    } elseif (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        $mensaje = '📧 El correo no es válido.';
    } elseif ($contrasena !== $confirmar) {
        $mensaje = '🔒 Las contraseñas no coinciden.';
    } elseif (strlen($contrasena) < 6) {
        $mensaje = '🔑 La contraseña debe tener al menos 6 caracteres.';
    } else {
        // Verificar si ya existe usuario o correo
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM usuarios WHERE nombre_usuario = ? OR correo = ?");
        $stmt->execute([$nombre_usuario, $correo]);
        if ($stmt->fetchColumn() > 0) {
            $mensaje = '❌ El usuario o correo ya están registrados.';
        } else {
            // Crear usuario
            $hash = password_hash($contrasena, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT INTO usuarios (nombre_usuario, correo, contrasena_hash) VALUES (?, ?, ?)");
            if ($stmt->execute([$nombre_usuario, $correo, $hash])) {
                $exito = true;
                $mensaje = '✅ ¡Registro exitoso! Ahora puedes iniciar sesión.';
            } else {
                $mensaje = '⚠️ Error al registrar. Intenta más tarde.';
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Registro | LC-ADVANCE</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500;700&family=Syne:wght@700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #060a12;
            --surface: #0d1626;
            --surface2: #121d33;
            --border: rgba(0, 230, 255, 0.16);
            --border2: rgba(0, 230, 255, 0.24);
            --cyan: #00e5ff;
            --pink: #ff3cac;
            --green: #00ff87;
            --yellow: #ffd23f;
            --text: #e8f4ff;
            --muted: rgba(200, 230, 255, 0.64);
            --font-display: "Syne", sans-serif;
            --font-body: "Space Grotesk", sans-serif;
            --font-mono: "JetBrains Mono", monospace;
            --transition: all 0.22s ease;
        }

        *, *::before, *::after { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: var(--font-body);
            color: var(--text);
            background: radial-gradient(circle at 30% -10%, rgba(0, 229, 255, 0.15), transparent 40%), radial-gradient(circle at 85% 100%, rgba(255, 60, 200, 0.15), transparent 45%), var(--bg);
            overflow-x: hidden;
        }

        .container {
            width: min(100%, 960px);
            margin: 0 auto;
            padding: 24px 16px 34px;
            position: relative;
            z-index: 1;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .grid-bg {
            position: fixed;
            inset: 0;
            pointer-events: none;
            z-index: 0;
            background-image: linear-gradient(rgba(0, 229, 255, 0.035) 1px, transparent 1px), linear-gradient(90deg, rgba(0, 229, 255, 0.035) 1px, transparent 1px);
            background-size: 50px 50px;
            animation: gridScroll 36s linear infinite;
        }

        .bg-orb {
            position: fixed;
            border-radius: 50%;
            pointer-events: none;
            filter: blur(90px);
            z-index: 0;
        }

        .bg-orb-1 {
            width: 520px;
            height: 520px;
            top: -130px;
            right: -110px;
            background: radial-gradient(circle, rgba(0, 229, 255, 0.17), transparent 60%);
            animation: orbPulse 9s ease-in-out infinite;
        }

        .bg-orb-2 {
            width: 360px;
            height: 360px;
            bottom: -90px;
            left: -90px;
            background: radial-gradient(circle, rgba(255, 60, 200, 0.18), transparent 65%);
            animation: orbPulse 11s ease-in-out infinite reverse;
        }

        .auth-card {
            width: min(100%, 520px);
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 36px 26px 28px;
            box-shadow: 0 20px 42px rgba(0, 0, 0, 0.45);
            backdrop-filter: blur(12px);
            position: relative;
            z-index: 2;
            animation: fadeInUp 0.82s cubic-bezier(0.23, 1, 0.32, 1);
        }

        .auth-card::before {
            content: "";
            position: absolute;
            inset: 0;
            border-radius: 20px;
            background: linear-gradient(135deg, rgba(0, 229, 255, 0.05), transparent 65%);
            pointer-events: none;
        }

        .btn-back {
            position: absolute;
            top: 16px;
            left: 16px;
            font-family: var(--font-mono);
            font-size: 10px;
            color: var(--muted);
            text-decoration: none;
            z-index: 4;
            transition: var(--transition);
        }

        .btn-back:hover { color: var(--cyan); }

        .auth-icon {
            width: 70px;
            height: 70px;
            border-radius: 18px;
            margin: 0 auto 12px;
            display: grid;
            place-items: center;
            font-size: 30px;
            background: linear-gradient(160deg, rgba(0, 229, 255, 0.3), rgba(255, 60, 200, 0.3));
            border: 1px solid rgba(0, 229, 255, 0.26);
            box-shadow: 0 8px 18px rgba(0, 229, 255, 0.22);
            animation: glowPulse 3.2s ease-in-out infinite;
            z-index: 3;
        }

        .auth-title {
            font-family: var(--font-display);
            font-size: clamp(1.1rem, 2.5vw, 1.45rem);
            margin: 0;
            color: #fff;
            letter-spacing: 0.2px;
        }

        .auth-subtitle {
            margin-top: 8px;
            margin-bottom: 18px;
            color: var(--muted);
            font-size: 14px;
            font-family: var(--font-mono);
            font-weight: 500;
        }

        .social-auth {
            display: flex;
            gap: 10px;
            margin-bottom: 16px;
            animation: fadeInLeft 0.7s ease-out;
            flex-wrap: wrap;
        }

        .btn-social {
            flex: 1;
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid var(--border2);
            border-radius: 10px;
            color: var(--text);
            font-family: var(--font-mono);
            font-size: 11px;
            padding: 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            text-transform: uppercase;
            cursor: pointer;
            transition: var(--transition);
        }

        .btn-social:hover {
            background: rgba(0, 229, 255, 0.12);
            border-color: rgba(0, 229, 255, 0.45);
            transform: translateY(-1px);
            box-shadow: 0 8px 20px rgba(0, 229, 255, 0.2);
        }

        .btn-icon {
            width: 18px;
            height: 18px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .divider {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 16px 0 22px;
            color: var(--muted);
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .divider::before,
        .divider::after {
            content: "";
            flex: 1;
            height: 1px;
            background: var(--border2);
        }

        .input-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 14px;
            margin-bottom: 12px;
        }

        .input-group {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .input-group.full { grid-column: span 2; }

        .input-group label {
            font-family: var(--font-mono);
            font-size: 11px;
            color: var(--muted);
            letter-spacing: 0.7px;
            text-transform: uppercase;
        }

        .auth-input {
            width: 100%;
            padding: 11px 12px;
            border-radius: 10px;
            border: 1px solid var(--border2);
            background: var(--surface2);
            color: var(--text);
            font-family: var(--font-body);
            font-size: 13px;
            transition: var(--transition);
        }

        .auth-input:focus {
            border-color: var(--cyan);
            box-shadow: 0 0 0 4px rgba(0, 229, 255, 0.08);
            outline: none;
            background: rgba(8, 14, 22, 0.95);
        }

        .btn-primary {
            width: 100%;
            border: 1px solid var(--border2);
            border-radius: 10px;
            padding: 12px 14px;
            font-family: var(--font-mono);
            font-size: 12px;
            font-weight: 700;
            color: var(--bg);
            background: linear-gradient(140deg, var(--cyan), var(--pink));
            text-transform: uppercase;
            letter-spacing: 0.9px;
            cursor: pointer;
            transition: all 0.32s cubic-bezier(0.23, 1, 0.32, 1);
            box-shadow: 0 8px 20px rgba(0, 229, 255, 0.28);
            margin-top: 8px;
            overflow: hidden;
            position: relative;
        }

        .btn-primary:hover {
            transform: translateY(-2px) scale(1.01);
            box-shadow: 0 10px 28px rgba(0, 229, 255, 0.45);
        }

        .btn-primary:active { transform: translateY(1px); }

        .auth-footer {
            margin-top: 16px;
            color: var(--muted);
            font-size: 13px;
        }

        .auth-footer a {
            color: var(--cyan);
            text-decoration: none;
            font-weight: 700;
        }

        .mensaje {
            border-radius: 10px;
            margin-bottom: 18px;
            padding: 10px 12px;
            font-size: 13px;
            border: 1px solid transparent;
            animation: fadeInDown 0.65s ease-out;
        }

        .mensaje.error {
            background: rgba(255, 68, 68, 0.18);
            color: #ffb8b8;
            border-color: rgba(255, 68, 68, 0.35);
        }

        .mensaje.exito {
            background: rgba(0, 255, 135, 0.16);
            color: #ccffe2;
            border-color: rgba(0, 255, 135, 0.35);
        }

        @keyframes fadeInUp { 0% { opacity: 0; transform: translateY(18px); } 100% { opacity: 1; transform: translateY(0); } }
        @keyframes fadeInDown { 0% { opacity: 0; transform: translateY(-12px); } 100% { opacity: 1; transform: translateY(0); } }
        @keyframes fadeInLeft { 0% { opacity: 0; transform: translateX(-12px); } 100% { opacity: 1; transform: translateX(0); } }
        @keyframes glowPulse { 0%, 100% { transform: scale(1); box-shadow: 0 8px 18px rgba(0, 229, 255, 0.22); } 50% { transform: scale(1.05); box-shadow: 0 20px 28px rgba(0, 229, 255, 0.35); } }
        @keyframes gridScroll { 0% { background-position: 0 0, 0 0; } 100% { background-position: 110px 110px, 110px 110px; } }
        @keyframes orbPulse { 0%, 100% { transform: scale(1); opacity: 0.82; } 50% { transform: scale(1.08); opacity: 0.96; } }

        @media (max-width: 768px) {
            .input-grid { grid-template-columns: 1fr; }
            .input-group.full { grid-column: span 1; }
            .social-auth { flex-direction: column; }
        }

        @media (max-width: 480px) {
            .container { padding: 16px 12px 24px; }
            .auth-card { padding: 18px 14px; border-radius: 14px; }
            .auth-title { font-size: 1.25rem; }
            .auth-subtitle { font-size: 13px; }
            .btn-back { top: 12px; left: 10px; font-size: 9px; }
            .btn-social { font-size: 10px; padding: 8px; }
            .auth-footer { font-size: 12px; }
        }
        .password-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }
        .password-wrapper .auth-input {
            padding-right: 40px;
        }
        .toggle-password {
            position: absolute;
            right: 10px;
            cursor: pointer;
            font-size: 18px;
            user-select: none;
            opacity: 0.6;
            transition: opacity 0.2s;
        }
        .toggle-password:hover {
            opacity: 1;
        }
    </style>
</head>
<body class="auth-page">

<div class="grid-bg"></div>
<div class="bg-orb bg-orb-1"></div>
<div class="bg-orb bg-orb-2"></div>

<div class="container">
    <div class="auth-card">
        <a href="../index.php" class="btn-back">← INICIO</a>
        <div class="auth-icon">🎮</div>
        <h1 class="auth-title">Registro de Usuario</h1>
        <p class="auth-subtitle">Crea tu cuenta y empieza el camino al dominio.</p>

        <?php if ($mensaje): ?>
            <div class="mensaje <?php echo $exito ? 'exito' : 'error'; ?>">
                <?php echo htmlspecialchars($mensaje); ?>
            </div>
        <?php endif; ?>

        <?php if (!$exito): ?>
            <div class="social-auth">
                <button type="button" class="btn-social" onclick="window.location='auth_provider.php?provider=google'">
                    <span class="btn-icon">
                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path fill="#4285F4" d="M21.35 11.1h-9.33v2.8h5.34c-.23 1.24-1.04 2.29-2.22 2.99v2.48h3.6c2.11-1.94 3.32-4.8 3.32-8.29 0-.59-.06-1.17-.16-1.74z"/>
                            <path fill="#34A853" d="M12.02 22c2.97 0 5.47-1 7.29-2.71l-3.6-2.48c-.99.66-2.25 1.05-3.69 1.05-2.84 0-5.25-1.92-6.11-4.5H2.14v2.82C3.94 19.98 7.76 22 12.02 22z"/>
                            <path fill="#FBBC05" d="M5.91 13.86A7.6 7.6 0 0 1 5.5 12c0-.66.11-1.31.41-1.86V7.32H2.14A11.98 11.98 0 0 0 0 12c0 1.94.47 3.77 1.3 5.34l4.61-3.48z"/>
                            <path fill="#EA4335" d="M12.02 4.54c1.62 0 3.08.56 4.23 1.65l3.18-3.18C17.48 1.2 14.98 0 12.02 0 7.76 0 3.94 2.02 2.14 5.32l4.61 3.48c.86-2.58 3.27-4.5 6.11-4.5z"/>
                        </svg>
                    </span>
                    Google
                </button>
                <button type="button" class="btn-social" onclick="window.location='auth_provider.php?provider=github'">
                    <span class="btn-icon">
                        <svg viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path fill="currentColor" fill-rule="evenodd" d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82a7.64 7.64 0 0 1 4 0c1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.28.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.19 0 .21.15.46.55.38A8.01 8.01 0 0 0 16 8c0-4.42-3.58-8-8-8z"/>
                        </svg>
                    </span>
                    GitHub
                </button>
            </div>

            <div class="divider">ó</div>

            <form method="POST" action="" class="auth-form">
                <?= campoTokenCSRF() ?>
                <div class="input-grid">
                    <div class="input-group">
                        <label for="nombre_usuario">Nombre de Código</label>
                        <input type="text" id="nombre_usuario" name="nombre_usuario" maxlength="50" required class="auth-input" placeholder="Ingresa tu alias">
                    </div>
                    <div class="input-group">
                        <label for="correo">Email</label>
                        <input type="email" id="correo" name="correo" maxlength="100" required class="auth-input" placeholder="usuario@empresa.com">
                    </div>
                    <div class="input-group full">
                        <label for="contrasena">Contraseña</label>
                        <div class="password-wrapper">
                            <input type="password" id="contrasena" name="contrasena" minlength="6" required class="auth-input" placeholder="Al menos 6 caracteres">
                            <span class="toggle-password" onclick="togglePassword('contrasena', this)">👁️</span>
                        </div>
                    </div>
                    <div class="input-group full">
                        <label for="confirmar">Confirmar contraseña</label>
                        <div class="password-wrapper">
                            <input type="password" id="confirmar" name="confirmar" minlength="6" required class="auth-input" placeholder="Repite la contraseña">
                            <span class="toggle-password" onclick="togglePassword('confirmar', this)">👁️</span>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn-primary">Registrar</button>
            </form>
        <?php else: ?>
            <button class="btn-primary" onclick="window.location='login.php'">➡️ Iniciar Sesión Ahora</button>
        <?php endif; ?>

        <p class="auth-footer">¿Ya tienes cuenta? <a href="login.php">Ingresar</a></p>
    </div>
</div>

<script src="assets/js/app.js"></script>
<script>
function togglePassword(inputId, el) {
    const input = document.getElementById(inputId);
    if (input.type === 'password') {
        input.type = 'text';
    } else {
        input.type = 'password';
    }
}
</script>

</body>
</html>