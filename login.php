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

// Si ya hay sesión activa, redirige al mapa en vez de dashboard
if (isset($_SESSION['usuario_id'])) {
    redirigir('mapa/index.html');
}

$mensaje = '';

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

            // Redirige directamente al mapa del juego
            redirigir('mapa/index.html');
        } else {
            $mensaje = '❌ Usuario o contraseña incorrectos.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión | LC-ADVANCE</title>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    </head>
<body class="auth-page">
    
<div class="auth-form-wrapper"> 
    <h1 class="auth-title">🎮 Acceso Nivel 1</h1> 

    <?php if ($mensaje): ?>
        <div class="mensaje <?php echo (strpos($mensaje, '❌') !== false || strpos($mensaje, '⚠️') !== false) ? 'error' : 'exito'; ?>">
            <?php echo htmlspecialchars($mensaje); ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="" class="auth-form"> 
        <?= campoTokenCSRF() ?>

        <div class="input-group"> 
            <label for="nombre_usuario">👤 Usuario:</label>
            <input type="text" id="nombre_usuario" name="nombre_usuario" required class="retro-input" placeholder="Tu nombre de código"> 
        </div>

        <div class="input-group">
            <label for="contrasena">🔑 Contraseña:</label>
            <input type="password" id="contrasena" name="contrasena" required class="retro-input" placeholder="Clave de acceso">
        </div>

        <button type="submit" class="btn btn-primary btn-full-width animate-glitch" data-text="Entrar">Entrar</button>
    </form>

    <p class="auth-links"> 
        <a href="register.php" class="link-glow">🆕 Crear cuenta</a> 
        <span>|</span> 
        <a href="index.php" class="link-glow">⬅️ Volver al Inicio</a>
    </p>
</div>

<script src="assets/js/app.js"></script>

</body>
</html>