<?php
// ==========================================
// LC-ADVANCE - login.php
// ==========================================
// Fecha: 2025-10-29
// Descripción: Inicio de sesión de usuarios
// ==========================================

require_once 'config/config.php';
iniciarSesionSegura();
require_once 'config/csrf.php';

// Si ya hay sesión activa, redirige
if (isset($_SESSION['usuario_id'])) {
    $redirect = $_GET['redirect'] ?? 'mapa/index.php';
    redirigir($redirect);
}

$mensaje = '';
$redirect_param = $_GET['redirect'] ?? '';

// Mensajes por parámetros (timeout, logout, etc.)
if (!empty($_GET['timeout'])) {
    $mensaje = '⚠️ Tu sesión expiró por inactividad. Por favor vuelve a iniciar sesión.';
}
if (!empty($_GET['logout'])) {
    $mensaje = 'Has cerrado sesión correctamente.';
}
// Procesar formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    protegerCSRF();

    $nombre_usuario = limpiarEntrada($_POST['nombre_usuario'] ?? '');
    $contrasena = $_POST['contrasena'] ?? '';
    $final_redirect = $_POST['redirect_to'] ?? 'mapa/index.php';

    if (empty($nombre_usuario) || empty($contrasena)) {
        $mensaje = '⚠️ Ingresa tu usuario y contraseña.';
    } else {
        // Buscar usuario en la base de datos
        $stmt = $pdo->prepare("SELECT id, nombre_usuario, contrasena_hash, puntos, nivel FROM usuarios WHERE nombre_usuario = ?");
        $stmt->execute([$nombre_usuario]);
        $usuario = $stmt->fetch();

        if ($usuario && password_verify($contrasena, $usuario['contrasena_hash'])) {
            // Login exitoso
            session_regenerate_id(true);
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_nombre'] = $usuario['nombre_usuario'];
            $_SESSION['usuario_puntos'] = $usuario['puntos'];
            $_SESSION['usuario_nivel'] = $usuario['nivel'];
            $_SESSION['last_activity'] = time();

            // Si el login incluye materia en la URL, guardarla
            if (!empty($_GET['materia'])) $_SESSION['selected_materia'] = trim($_GET['materia']);

            // Redirige al destino final
            redirigir($final_redirect);
        } else {
            logSeguridadEvento('LOGIN_FAIL', "Usuario: {$nombre_usuario} intento de contraseña incorrecta");
            $mensaje = '❌ Usuario o contraseña incorrectos.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Iniciar Sesión | LC-ADVANCE</title>
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
            background: radial-gradient(circle at 30% -10%, rgba(0, 229, 255, 0.15), transparent 40%), radial-gradient(circle at 85% 100%, rgba(255, 60, 200, 0.14), transparent 45%), var(--bg);
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

        .input-group {
            display: flex;
            flex-direction: column;
            gap: 6px;
            margin-bottom: 14px;
        }

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

        .auth-btn {
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
        }

        .auth-btn:hover {
            transform: translateY(-2px) scale(1.01);
            box-shadow: 0 10px 28px rgba(0, 229, 255, 0.45);
        }

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
            text-align: center;
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
            .social-auth { flex-direction: column; }
            .auth-card { padding: 28px 20px 24px; }
        }

        @media (max-width: 480px) {
            .container { padding: 16px 12px 24px; }
            .auth-card { padding: 18px 14px; }
            .auth-title { font-size: 1.25rem; }
            .auth-subtitle { font-size: 13px; }
            .btn-back { top: 12px; left: 10px; font-size: 9px; }
            .auth-footer { font-size: 12px; }
        }
    </style>
</head>
<body class="auth-page">

<div class="grid-bg"></div>
<div class="bg-orb bg-orb-1"></div>
<div class="bg-orb bg-orb-2"></div>

<div class="container">
    <div class="auth-card">
        <a href="index.php" class="btn-back">← INICIO</a>
        <div class="auth-icon">🎮</div>
        <h1 class="auth-title">Acceso Seguro</h1>
        <p class="auth-subtitle">Inicia sesión para continuar tu aventura.</p>

        <?php if ($mensaje): ?>
            <div class="mensaje <?php echo (strpos($mensaje, '❌') !== false || strpos($mensaje, '⚠️') !== false) ? 'error' : 'exito'; ?>">
                <?php echo htmlspecialchars($mensaje); ?>
            </div>
        <?php endif; ?>

        <div class="social-auth">
            <button class="btn-social" onclick="window.location='auth_provider.php?provider=google&redirect=<?php echo urlencode($redirect_param); ?>'">Google</button>
            <button class="btn-social" onclick="window.location='auth_provider.php?provider=github&redirect=<?php echo urlencode($redirect_param); ?>'">GitHub</button>
        </div>

        <div class="divider">Ó</div>

        <form method="POST" action="" class="auth-form" id="main-auth-form">
            <?= campoTokenCSRF() ?>
            <input type="hidden" name="redirect_to" value="<?php echo htmlspecialchars($redirect_param); ?>">

            <div class="input-group">
                <label for="nombre_usuario">Usuario o Email</label>
                <input type="text" id="nombre_usuario" name="nombre_usuario" class="auth-input" required placeholder="bit_warrior">
            </div>

            <div class="input-group" id="password-group">
                <label for="contrasena">Contraseña</label>
                <input type="password" id="contrasena" name="contrasena" class="auth-input" required placeholder="********">
            </div>

            <button type="submit" class="auth-btn" id="btn-continue">Entrar</button>

            <div style="margin-top: 14px; text-align: center;">
                <a href="#" id="toggle-magic-link" style="color: var(--cyan); text-decoration: none; letter-spacing: 0.5px; font-size: 12px;">Usar código por email</a>
            </div>
        </form>

        <div class="auth-footer">¿No tienes cuenta? <a href="register.php">Regístrate</a></div>
    </div>
</div>

<script>
    const toggleLink = document.getElementById('toggle-magic-link');
    const passGroup = document.getElementById('password-group');
    const btnContinue = document.getElementById('btn-continue');
    const userLabel = document.querySelector('label[for="nombre_usuario"]');

    toggleLink.addEventListener('click', function(e) {
        e.preventDefault();

        if (passGroup.style.display !== 'none') {
            passGroup.style.display = 'none';
            btnContinue.textContent = 'Enviar código OTP';
            userLabel.textContent = 'Email de acceso';
            toggleLink.textContent = 'Usar contraseña';
        } else {
            passGroup.style.display = 'block';
            btnContinue.textContent = 'Entrar';
            userLabel.textContent = 'Usuario o Email';
            toggleLink.textContent = 'Usar código por email';
        }
    });

    document.getElementById('main-auth-form').addEventListener('submit', function(event) {
        if (btnContinue.textContent === 'Enviar código OTP') {
            event.preventDefault();
            alert('🚀 SISTEMA: OTP enviado (simulado). Chequea tu correo para el enlace.');
        }
    });
</script>

<script src="assets/js/app.js"></script>
<?php if (!empty($_GET['timeout']) || !empty($_GET['logout'])): ?>
<script>
    for (let i = 0; i < localStorage.length; i++) {
        const key = localStorage.key(i);
        if (key && (key.startsWith('map.player_pos') || key === 'map.player_pos')) {
            localStorage.removeItem(key);
            i--;
        }
    }
</script>
<?php endif; ?>
</body>
</html>        :root {
            --auth-bg: #050508;
            --auth-card: rgba(15, 15, 20, 0.95);
            --auth-accent: #00ffff;
            --header-blur: blur(20px);
        }

        body.auth-page {
            background-color: var(--auth-bg);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 40px 20px;
            font-family: 'VT323', monospace;
            overflow-y: auto;
            box-sizing: border-box;
        }

        .grid-bg {
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            background-image: 
                linear-gradient(rgba(0, 255, 255, 0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(0, 255, 255, 0.03) 1px, transparent 1px);
            background-size: 50px 50px;
            z-index: -1;
            mask-image: radial-gradient(circle at center, black, transparent 80%);
        }

        .auth-form-wrapper {
            background: var(--auth-card);
            border: 1px solid rgba(0, 255, 255, 0.2);
            border-radius: 24px;
            padding: 50px 40px;
            width: 100%;
            max-width: 420px;
            backdrop-filter: var(--header-blur);
            box-shadow: 0 20px 60px rgba(0,0,0,0.8);
            text-align: center;
            animation: fadeInUp 0.8s ease-out;
        }

        .btn-back {
            position: absolute;
            top: 20px;
            left: 20px;
            color: #666;
            text-decoration: none;
            font-family: 'Press Start 2P', cursive;
            font-size: 8px;
            transition: 0.3s;
        }

        .btn-back:hover {
            color: var(--auth-accent);
        }

        .auth-logo {
            font-size: 40px;
            margin-bottom: 20px;
            filter: drop-shadow(0 0 10px var(--auth-accent));
        }

        .auth-title {
            font-family: 'Press Start 2P', cursive;
            font-size: 16px;
            color: #fff;
            margin-bottom: 10px;
            text-transform: uppercase;
        }

        .auth-subtitle {
            font-size: 18px;
            color: #888;
            margin-bottom: 30px;
        }

        /* Social Auth Simulation */
        .social-auth {
            display: flex;
            flex-direction: column;
            gap: 15px;
            margin-bottom: 30px;
        }

        .btn-social {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #fff;
            padding: 12px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            font-family: 'VT323', monospace;
            font-size: 18px;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn-social:hover {
            background: rgba(255, 255, 255, 0.08);
            border-color: rgba(255, 255, 255, 0.3);
        }

        .divider {
            display: flex;
            align-items: center;
            gap: 15px;
            margin: 30px 0;
            color: #444;
            font-family: 'Press Start 2P', cursive;
            font-size: 10px;
        }

        .divider::before, .divider::after {
            content: "";
            flex: 1;
            height: 1px;
            background: rgba(255, 255, 255, 0.05);
        }

        /* Standard Form Styling */
        .input-group {
            text-align: left;
            margin-bottom: 20px;
        }

        .input-group label {
            display: block;
            font-family: 'Press Start 2P', cursive;
            font-size: 9px;
            color: var(--auth-accent);
            margin-bottom: 10px;
            text-transform: uppercase;
        }

        .retro-input {
            width: 100%;
            background: rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 15px;
            border-radius: 12px;
            color: #fff;
            font-family: 'VT323', monospace;
            font-size: 20px;
            box-sizing: border-box;
            transition: 0.3s;
        }

        .retro-input:focus {
            border-color: var(--auth-accent);
            box-shadow: 0 0 15px rgba(0, 255, 255, 0.1);
            outline: none;
        }

        .btn-primary {
            width: 100%;
            background: var(--auth-accent);
            color: #000;
            padding: 18px;
            border: none;
            border-radius: 12px;
            font-family: 'Press Start 2P', cursive;
            font-size: 12px;
            cursor: pointer;
            transition: 0.3s;
            margin-top: 10px;
            box-shadow: 0 0 20px rgba(0, 255, 255, 0.2);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 0 35px rgba(0, 255, 255, 0.4);
        }

        .auth-footer {
            margin-top: 30px;
            color: #666;
            font-size: 16px;
        }

        .auth-footer a {
            color: var(--auth-accent);
            text-decoration: none;
            font-family: 'Press Start 2P', cursive;
            font-size: 9px;
            margin-left: 5px;
        }

        .mensaje {
            padding: 15px;
            border-radius: 12px;
            margin-bottom: 25px;
            font-size: 18px;
            width: 100%;
            box-sizing: border-box;
            text-align: center;
        }
        .mensaje.error { background: rgba(255, 0, 0, 0.1); color: #ff4444; border: 1px solid rgba(255, 0, 0, 0.2); }
        .mensaje.exito { background: rgba(0, 255, 0, 0.1); color: #00ff00; border: 1px solid rgba(0, 255, 0, 0.2); }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="auth-page">

<div class="grid-bg"></div>
    
<div class="auth-form-wrapper"> 
    <a href="index.php" class="btn-back">← INICIO</a>
    <div class="auth-logo">🎮</div>
    <h1 class="auth-title">Identidad Requerida</h1> 
    <p class="auth-subtitle">Ingresa tus credenciales para continuar la aventura.</p>

    <?php if ($mensaje): ?>
        <div class="mensaje <?php echo (strpos($mensaje, '❌') !== false || strpos($mensaje, '⚠️') !== false) ? 'error' : 'exito'; ?>">
            <?php echo htmlspecialchars($mensaje); ?>
        </div>
    <?php endif; ?>

    <div class="social-auth">
        <button class="btn-social" onclick="window.location='auth_provider.php?provider=google&redirect=<?php echo urlencode($redirect_param); ?>'">
            <img src="https://www.google.com/favicon.ico" width="16" height="16"> Continuar con Google
        </button>
        <button class="btn-social" onclick="window.location='auth_provider.php?provider=github&redirect=<?php echo urlencode($redirect_param); ?>'">
            <svg height="18" viewBox="0 0 16 16" version="1.1" width="18" aria-hidden="true" style="fill: #fff;"><path fill-rule="evenodd" d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.013 8.013 0 0016 8c0-4.42-3.58-8-8-8z"></path></svg> Continuar con GitHub
        </button>
    </div>

    <script>
        function simulateSocialAuth(provider) {
            alert('🚀 SISTEMA: Conectando con la API de ' + provider + '...\n\nEsta es una simulación. En una versión de producción, serías redirigido al portal de ' + provider + '.');
        }
    </script>

    <div class="divider">Ó</div>

    <form method="POST" action="" class="auth-form" id="main-auth-form"> 
        <?= campoTokenCSRF() ?>
        <input type="hidden" name="redirect_to" value="<?php echo htmlspecialchars($redirect_param); ?>">

        <div id="email-step">
            <div class="input-group"> 
                <label for="nombre_usuario">Usuario o Email</label>
                <input type="text" id="nombre_usuario" name="nombre_usuario" required class="retro-input" placeholder="p.ej. bit_warrior"> 
            </div>

            <div class="input-group" id="password-group">
                <label for="contrasena">Contraseña</label>
                <input type="password" id="contrasena" name="contrasena" required class="retro-input" placeholder="********">
            </div>

            <button type="submit" class="btn-primary" id="btn-continue">Entrar</button>
            
            <div style="margin-top: 20px;">
                <a href="#" id="toggle-magic-link" style="color: var(--auth-accent); text-decoration: none; font-size: 14px; font-family: 'Press Start 2P', cursive; font-size: 8px;">O usar código por email</a>
            </div>
        </div>
    </form>

    <script>
        document.getElementById('toggle-magic-link').addEventListener('click', function(e) {
            e.preventDefault();
            const passGroup = document.getElementById('password-group');
            const btn = document.getElementById('btn-continue');
            const label = document.querySelector('label[for="nombre_usuario"]');
            
            if (passGroup.style.display !== 'none') {
                passGroup.style.display = 'none';
                btn.textContent = 'Enviar Código OTP';
                label.textContent = 'Email de Destino';
                this.textContent = 'Usar contraseña';
            } else {
                passGroup.style.display = 'block';
                btn.textContent = 'Entrar';
                label.textContent = 'Usuario o Email';
                this.textContent = 'O usar código por email';
            }
        });

        document.getElementById('main-auth-form').addEventListener('submit', function(e) {
            const btn = document.getElementById('btn-continue');
            if (btn.textContent === 'Enviar Código OTP') {
                e.preventDefault();
                alert('🚀 SISTEMA: Se ha enviado un código de acceso a tu correo (Simulado para esta demo).');
            }
        });
    </script>

    <div class="auth-footer">
        ¿No tienes cuenta? <a href="register.php">Regístrate</a>
    </div>
</div>

<script src="assets/js/app.js"></script>
<?php if (!empty($_GET['timeout']) || !empty($_GET['logout'])): ?>
<script>
    // Limpieza agresiva de posición del jugador en timeout/logout
    for (let i = 0; i < localStorage.length; i++) {
        const key = localStorage.key(i);
        if (key && (key.startsWith("map.player_pos") || key === "map.player_pos")) {
            localStorage.removeItem(key);
            i--;
        }
    }
</script>
<?php endif; ?>
</body>
</html>