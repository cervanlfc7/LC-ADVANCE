<?php
// guest_login.php — Inicio de sesión rápido en modo "Invitado" (solo lectura)
require_once 'config/config.php';
// Iniciar sesión segura y regenerar id
iniciarSesionSegura();
session_regenerate_id(true);

// Asegurarse de limpiar cualquier sesión previa sensible
unset($_SESSION['usuario_id']);
unset($_SESSION['usuario_nombre']);
unset($_SESSION['usuario_puntos']);
unset($_SESSION['usuario_nivel']);
unset($_SESSION['usuario_es_invitado']);

// Configurar sesión de invitado
$_SESSION['usuario_id'] = 0; // id 0 reservada para Invitado
$_SESSION['usuario_nombre'] = 'Invitado';
$_SESSION['usuario_puntos'] = 0;
$_SESSION['usuario_nivel'] = 1;
$_SESSION['usuario_es_invitado'] = true;
$_SESSION['last_activity'] = time();

// Guardar materia si se pasó por la URL
if (!empty($_GET['materia'])) $_SESSION['selected_materia'] = trim($_GET['materia']);

// Redirigir al mapa (invitado)
header('Location: mapa/index.html');
exit;
