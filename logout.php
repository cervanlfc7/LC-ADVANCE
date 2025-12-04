<?php
// ==========================================
// LC-ADVANCE - logout.php
// ==========================================
// Autor: LC-TEAM
// Fecha: 2025-10-29
// Descripción: Cierra la sesión del usuario
// ==========================================

session_start();

// Borrar todas las variables de sesión
$_SESSION = [];

// Eliminar la cookie de sesión si existe
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(), 
        '', 
        time() - 42000,
        $params["path"], 
        $params["domain"],
        $params["secure"], 
        $params["httponly"]
    );
}

// Destruir la sesión
session_destroy();

// Redirigir al login
header("Location: login.php");
exit;
?>
