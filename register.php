<?php
// ==========================================
// LC-ADVANCE - register.php
// ==========================================
// Autor: LC-TEAM
// Fecha: 2025-10-29
// Descripción: Registro de nuevos usuarios
// ==========================================

require_once 'config/config.php';
// Iniciamos sesión de forma segura y consistente
iniciarSesionSegura();
require_once 'config/csrf.php';

// Si el usuario ya está logueado, redirigir
if (isset($_SESSION['usuario_id'])) {
    redirigir('dashboard.php');
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
    <style>
        :root {
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
            font-family: 'VT323', monospace;
            overflow-y: auto;
            padding: 40px 20px;
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
            padding: 40px;
            width: 100%;
            max-width: 480px;
            backdrop-filter: var(--header-blur);
            box-shadow: 0 20px 60px rgba(0,0,0,0.8);
            text-align: center;
            animation: fadeInUp 0.8s ease-out;
            position: relative;
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
            margin-bottom: 15px;
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
            margin-bottom: 25px;
        }

        .social-auth {
            display: flex;
            gap: 15px;
            margin-bottom: 25px;
        }

        .btn-social {
            flex: 1;
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #fff;
            padding: 12px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
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
            margin: 25px 0;
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

        .input-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            text-align: left;
        }

        .input-group {
            margin-bottom: 15px;
            text-align: left;
        }

        .input-group.full {
            grid-column: span 2;
        }

        .input-group label {
            display: block;
            font-family: 'Press Start 2P', cursive;
            font-size: 8px;
            color: var(--auth-accent);
            margin-bottom: 8px;
            text-transform: uppercase;
        }

        .retro-input {
            width: 100%;
            background: rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 12px;
            border-radius: 10px;
            color: #fff;
            font-family: 'VT323', monospace;
            font-size: 18px;
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
            padding: 15px;
            border: none;
            border-radius: 12px;
            font-family: 'Press Start 2P', cursive;
            font-size: 11px;
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
            margin-top: 25px;
            color: #666;
            font-size: 16px;
        }

        .auth-footer a {
            color: var(--auth-accent);
            text-decoration: none;
            font-family: 'Press Start 2P', cursive;
            font-size: 8px;
            margin-left: 5px;
        }

        .mensaje {
            padding: 12px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 16px;
        }
        .mensaje.error { background: rgba(255, 0, 0, 0.1); color: #ff4444; border: 1px solid rgba(255, 0, 0, 0.2); }
        .mensaje.exito { background: rgba(0, 255, 0, 0.1); color: #00ff00; border: 1px solid rgba(0, 255, 0, 0.2); }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 600px) {
            .input-grid { grid-template-columns: 1fr; }
            .input-group.full { grid-column: span 1; }
            .social-auth { flex-direction: column; }
        }
    </style>
</head>
<body class="auth-page">

<div class="grid-bg"></div>

<div class="auth-form-wrapper"> 
    <a href="index.php" class="btn-back">← INICIO</a>
    <div class="auth-logo">🎮</div>
    <h1 class="auth-title">Nuevo Jugador</h1> 
    <p class="auth-subtitle">Únete a la élite de programadores.</p>

    <?php if ($mensaje): ?>
        <div class="mensaje <?php echo $exito ? 'exito' : 'error'; ?>">
            <?php echo htmlspecialchars($mensaje); ?>
        </div>
    <?php endif; ?>

    <?php if (!$exito): ?>
    <div class="social-auth">
        <button class="btn-social" onclick="window.location='auth_provider.php?provider=google'">
            <img src="https://www.google.com/favicon.ico" width="16" height="16"> Google
        </button>
        <button class="btn-social" onclick="window.location='auth_provider.php?provider=github'">
            <svg height="18" viewBox="0 0 16 16" version="1.1" width="18" aria-hidden="true" style="fill: #fff;"><path fill-rule="evenodd" d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.013 8.013 0 0016 8c0-4.42-3.58-8-8-8z"></path></svg> GitHub
        </button>
    </div>

    <script>
        function simulateSocialAuth(provider) {
            alert('🚀 SISTEMA: Conectando con la API de ' + provider + '...\n\nEsta es una simulación de registro profesional.');
        }
    </script>

    <div class="divider">Ó</div>

    <form method="POST" action="" class="auth-form"> <?= campoTokenCSRF() ?>
        
        <div class="input-grid">
            <div class="input-group">
                <label for="nombre_usuario">Nombre de Código</label>
                <input type="text" id="nombre_usuario" name="nombre_usuario" maxlength="50" required class="retro-input" placeholder="Alias"> 
            </div>

            <div class="input-group">
                <label for="correo">Email Corporativo</label>
                <input type="email" id="correo" name="correo" maxlength="100" required class="retro-input" placeholder="Email"> 
            </div>

            <div class="input-group">
                <label for="contrasena">Contraseña</label>
                <input type="password" id="contrasena" name="contrasena" minlength="6" required class="retro-input" placeholder="******"> 
            </div>

            <div class="input-group">
                <label for="confirmar">Verificar</label>
                <input type="password" id="confirmar" name="confirmar" minlength="6" required class="retro-input" placeholder="******"> 
            </div>
        </div>

        <button type="submit" class="btn-primary">Registrar</button>
    </form>
    <?php else: ?>
        <button class="btn-primary" onclick="window.location='login.php'">➡️ Iniciar Sesión Ahora</button>
    <?php endif; ?>

    <div class="auth-footer">
        ¿Ya tienes cuenta? <a href="login.php">Entrar</a>
    </div>
</div>

<script src="assets/js/app.js"></script>

</body>
</html>