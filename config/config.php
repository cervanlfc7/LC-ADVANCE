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
define('DB_NAME', 'lc_advance');
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

/* ================================
   SESIONES SEGURAS Y POLÍTICAS
   ================================ */

define('SESSION_TIMEOUT', 3600); // 1 hora en segundos

/**
 * Inicia sesión de forma consistente y aplica parámetros seguros a la cookie.
 */
function iniciarSesionSegura() {
    if (session_status() === PHP_SESSION_NONE) {
        $cookieParams = session_get_cookie_params();
        // Uso de SameSite y flags seguros para cookie
        session_set_cookie_params([
            'lifetime' => $cookieParams['lifetime'],
            'path' => $cookieParams['path'],
            'domain' => $cookieParams['domain'],
            'secure' => (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off'),
            'httponly' => true,
            'samesite' => 'Lax'
        ]);
        session_start();
    }
}

/**
 * Requiere que exista una sesión (tanto usuario registrado como invitado).
 * Actualiza el timestamp de actividad y aplica timeout.
 */
function requireLogin($allowGuest = true) {
    iniciarSesionSegura();

    // Si no hay usuario ni invitado, redirigir a login
    if (empty($_SESSION['usuario_id']) && (empty($_SESSION['usuario_es_invitado']) || !$allowGuest)) {
        redirigir('login.php');
    }

    // Timeout por inactividad
    if (isset($_SESSION['last_activity']) && (time() - (int)$_SESSION['last_activity']) > SESSION_TIMEOUT) {
        // destruir sesión segura
        $_SESSION = [];
        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params['path'], $params['domain'], $params['secure'] ?? false, $params['httponly'] ?? true
            );
        }
        session_destroy();
        // redirigir con un indicador opcional
        redirigir('login.php?timeout=1');
    }

    // Actualizar último tiempo de actividad
    $_SESSION['last_activity'] = time();
}

/**
 * Requiere que exista un contexto de materia antes de acceder a cierto contenido (p. ej. dashboard)
 * Si no existe en GET o SESSION, redirige a `index.php` para que el usuario seleccione.
 */
function requireMateriaContext() {
    iniciarSesionSegura();
    $materia = null;

    if (!empty($_GET['materia'])) {
        $materia = trim($_GET['materia']);
        $_SESSION['selected_materia'] = $materia;
    } elseif (!empty($_SESSION['selected_materia'])) {
        $materia = $_SESSION['selected_materia'];
    }

    if (empty($materia)) {
        // Si venimos desde dashboard.php sin parámetros, mostramos el selector en forma de popup
        $script = basename($_SERVER['PHP_SELF'] ?? '');
        if ($script === 'dashboard.php') {
            // Si la llegada incluye ?profesor=... permitimos la entrada (no forzar selector)
            if (!empty($_GET['profesor'])) {
                return null;
            }
            // Redirigimos a index para que muestre el modal select-materia y pasamos un indicador
            redirigir('index.php?seleccionar_materia=1&from=dashboard');
        }

        // Comportamiento por defecto: forzar selección de materia
        redirigir('index.php?seleccionar_materia=1');
    }

    return $materia;
}

/**
 * Cierra la sesión de forma segura (por timeout o logout explícito)
 */
function cerrarSesionSegura() {
    iniciarSesionSegura();
    $_SESSION = [];
    if (ini_get('session.use_cookies')) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params['path'], $params['domain'], $params['secure'] ?? false, $params['httponly'] ?? true
        );
    }
    session_destroy();
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
