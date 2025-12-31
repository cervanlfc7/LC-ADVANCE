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
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro | LC-ADVANCE</title>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="auth-page"> <div class="auth-form-wrapper"> <h1 class="auth-title">🕹️ REGISTRO: Nuevo Jugador</h1> <?php if ($mensaje): ?>
        <div class="mensaje <?php echo $exito ? 'exito' : 'error'; ?>">
            <?php echo htmlspecialchars($mensaje); ?>
        </div>
    <?php endif; ?>

    <?php if (!$exito): ?>
    <form method="POST" action="" class="auth-form"> <?= campoTokenCSRF() ?>
        
        <div class="input-group">
            <label for="nombre_usuario">👤 Nombre de Código:</label>
            <input type="text" id="nombre_usuario" name="nombre_usuario" maxlength="50" required class="retro-input" placeholder="Tu alias de juego"> </div>

        <div class="input-group">
            <label for="correo">📧 Correo (ID de Sistema):</label>
            <input type="email" id="correo" name="correo" maxlength="100" required class="retro-input" placeholder="ejemplo@cbtis168.edu.mx"> </div>

        <div class="input-group">
            <label for="contrasena">🔑 Contraseña (Clave):</label>
            <input type="password" id="contrasena" name="contrasena" minlength="6" required class="retro-input" placeholder="Mínimo 6 caracteres"> </div>

        <div class="input-group">
            <label for="confirmar">🔁 Verificar Clave:</label>
            <input type="password" id="confirmar" name="confirmar" minlength="6" required class="retro-input" placeholder="Repite la clave"> </div>

        <button type="submit" class="btn btn-register btn-full-width">Registrar</button>
    </form>
    <?php else: ?>
        <button class="btn btn-login btn-full-width" onclick="window.location='login.php'">➡️ Iniciar Sesión Ahora</button>
    <?php endif; ?>

    <p class="auth-links"> <a href="login.php" class="link-glow">⬅️ Ya tengo cuenta</a> 
        <span>|</span> 
        <a href="index.php" class="link-glow">🏠 Volver al inicio</a>
    </p>
</div>

<script src="assets/js/app.js"></script>

</body>
</html>