<?php
// ==========================================
// LC-ADVANCE - logout.php
// ==========================================
// Autor: LC-TEAM
// Fecha: 2025-10-29
// Descripción: Cierra la sesión del usuario
// ==========================================

require_once 'config/config.php';
// Usamos la función central para cerrar sesión de forma segura
cerrarSesionSegura();
header('Location: login.php');
exit;
?>
