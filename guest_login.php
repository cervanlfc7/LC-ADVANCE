<?php
// guest_login.php — Inicio de sesión rápido en modo "Invitado" (solo lectura)
session_start();

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

// Aviso breve (opcional) — se puede leer en dashboard o en header
$_SESSION['mensaje_guest'] = 'Has entrado como Invitado. El progreso NO se guardará.';

// Redirigir al mapa (invitado)
header('Location: mapa/index.html');
exit;
