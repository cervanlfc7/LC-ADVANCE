<?php
// ==========================================
// LC-ADVANCE - config.php
// ==========================================
// Fecha: 2025-10-29
// Descripción: Configuración principal del
// sistema y conexión PDO a la base de datos.
// ==========================================

// ================================
// CONFIGURACIÓN GENERAL
// ================================

// Modo depuración (true = muestra errores)
define('DEBUG_MODE', true);

// Zona horaria
date_default_timezone_set('America/Mexico_City');

// Nombre del sistema
define('APP_NAME', 'CBTIS168 Study Game');

// ================================
// CONFIGURACIÓN DE LA BASE DE DATOS
// ================================

// Cambia los valores según tu entorno local o hosting
define('DB_HOST', 'localhost');
define('DB_NAME', 'cbtis168_study_game');
define('DB_USER', 'root');
define('DB_PASS', ''); // Cambia si tu usuario tiene contraseña

// ================================
// CONEXIÓN PDO SEGURA
// ================================

try {
    $pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4",
        DB_USER,
        DB_PASS,
        [
            PDO::ATTR_ERRMODE => DEBUG_MODE ? PDO::ERRMODE_EXCEPTION : PDO::ERRMODE_SILENT,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false
        ]
    );
} catch (PDOException $e) {
    if (DEBUG_MODE) {
        die("❌ Error al conectar a la base de datos: " . $e->getMessage());
    } else {
        die("❌ No se pudo conectar a la base de datos.");
    }
}

// ================================
// FUNCIONES AUXILIARES DE SEGURIDAD
// ================================

/**
 * Sanitiza cualquier entrada para prevenir XSS.
 */
function limpiarEntrada($data) {
    return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}

/**
 * Verifica si un usuario está logueado.
 */
function usuarioAutenticado() {
    return isset($_SESSION['usuario_id']);
}

/**
 * Redirige de forma segura a otra página.
 */
function redirigir($url) {
    header("Location: $url");
    exit;
}

// ================================
// PUNTOS Y NIVELES
// ================================

/**
 * Calcula el nivel del usuario basado en los puntos.
 * Cada 500 puntos = +1 nivel.
 */
function calcularNivel($puntos) {
    return floor($puntos / 500) + 1;
}

// ================================
// SISTEMA DE BADGES
// ================================

/**
 * Otorga un badge al usuario (si no lo tiene ya).
 */
function otorgarBadge($usuario_id, $badge_id, $pdo) {
    $check = $pdo->prepare("SELECT COUNT(*) FROM usuarios_badges WHERE usuario_id = ? AND badge_id = ?");
    $check->execute([$usuario_id, $badge_id]);
    if ($check->fetchColumn() == 0) {
        $stmt = $pdo->prepare("INSERT INTO usuarios_badges (usuario_id, badge_id) VALUES (?, ?)");
        $stmt->execute([$usuario_id, $badge_id]);
    }
}

/**
 * Actualiza los puntos del usuario de forma segura.
 */
function actualizarPuntos($usuario_id, $puntos_sumar, $pdo) {
    $stmt = $pdo->prepare("UPDATE usuarios SET puntos = puntos + ? WHERE id = ?");
    $stmt->execute([$puntos_sumar, $usuario_id]);
}

?>
