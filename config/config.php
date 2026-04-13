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
// Permitir sobrescritura por variables de entorno para CI y despliegue
define('DB_HOST', getenv('DB_HOST') ?: 'localhost');
define('DB_NAME', getenv('DB_NAME') ?: 'lc_advance');
define('DB_USER', getenv('DB_USER') ?: 'root');
define('DB_PASS', getenv('DB_PASS') ?: ''); // Cambia si tu usuario tiene contraseña

define('OLLAMA_API_URL', rtrim(getenv('OLLAMA_API_URL') ?: 'http://localhost:11434/v1', '/'));
define('OLLAMA_MODEL', getenv('OLLAMA_MODEL') ?: 'llama3.2:3b');
define('OLLAMA_API_KEY', getenv('OLLAMA_API_KEY') ?: '');
// Sin límite de tiempo para respuestas locales de Ollama.
define('OLLAMA_REQUEST_TIMEOUT', 0);

define('LM_STUDIO_API_URL', rtrim(getenv('LM_STUDIO_API_URL') ?: 'http://localhost:1234/v1', '/'));
define('LM_STUDIO_MODEL', getenv('LM_STUDIO_MODEL') ?: 'qwen2.5-0.5b-instruct-gguf');
define('LM_STUDIO_API_KEY', getenv('LM_STUDIO_API_KEY') ?: '');
define('LM_STUDIO_REQUEST_TIMEOUT', 0);

define('OPENROUTER_API_KEY', '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');
define('OPENROUTER_MODEL', 'google/gemini-2.0-flash-001'); // gratuito, o cambia por otro
define('OPENROUTER_TIMEOUT', 20);
// Si usas IP local para acceder desde el móvil, configura aquí la URL base.
// Ejemplo: APP_URL='http://192.168.3.210:8080/LC-ADVANCE'
define('APP_URL', getenv('APP_URL') ?: ''); // Dominio público estático. Dejar vacío en desarrollo local.

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
 * Devuelve la ruta base de la aplicación para redirecciones.
 */
function appRootPath() {
    $scriptName = $_SERVER['SCRIPT_NAME'] ?? '';
    $segments = explode('/', trim($scriptName, '/'));
    if (count($segments) <= 1) {
        return '';
    }

    $knownAppDirs = ['api', 'docs', 'mapa', 'Examen'];
    $firstSegment = $segments[0] ?? '';

    if (in_array($firstSegment, $knownAppDirs, true)) {
        return '';
    }

    return '/' . $firstSegment;
}

/**
 * Redirige de forma segura a otra página.
 */
function redirigir($url) {
    if (!preg_match('#^(https?://|/)#i', $url)) {
        $base = appRootPath();
        $url = ($base === '' ? '/' : $base . '/') . ltrim($url, '/');
    }
    header("Location: $url");
    exit;
}

/* ================================
   SESIONES SEGURAS Y POLÍTICAS
   ================================ */

define('SESSION_TIMEOUT', 1800); // 30 minutos en segundos

/**
 * Inicia sesión de forma consistente y aplica parámetros seguros a la cookie.
 */
function iniciarSesionSegura() {
    if (session_status() === PHP_SESSION_NONE) {
        // Establecer cookies de sesión que expiren al cerrar el navegador para mayor seguridad
        session_set_cookie_params([
            'lifetime' => 0,
            'path' => '/',
            'domain' => '',
            'secure' => (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off'),
            'httponly' => true,
            'samesite' => 'Lax'
        ]);
        session_start();
    }
    
    // Verificación de Timeout Centralizada
    if (isset($_SESSION['usuario_id']) && isset($_SESSION['last_activity'])) {
        if ((time() - $_SESSION['last_activity']) > SESSION_TIMEOUT) {
            logSeguridadEvento('TIMEOUT', 'Sesión expirada por inactividad', $_SESSION['usuario_id'] ?? null);
            cerrarSesionSegura();
            redirigir((strpos($_SERVER['PHP_SELF'], 'mapa/') !== false ? '../' : '') . 'login.php?timeout=1');
        }
    }
    $_SESSION['last_activity'] = time();

    // Regenerar ID periódicamente para prevenir secuestro de sesión
    if (!isset($_SESSION['created_at'])) {
        $_SESSION['created_at'] = time();
    } elseif (time() - $_SESSION['created_at'] > 1800) {
        $_SESSION['created_at'] = time();
        session_regenerate_id(true);
    }

    // CSRF token único por sesión
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
}


/**
 * Devuelve token CSRF para forms y AJAX.
 */
function csrfToken() {
    if (session_status() === PHP_SESSION_NONE) {
        iniciarSesionSegura();
    }
    return $_SESSION['csrf_token'] ?? '';
}

/**
 * Valida token CSRF entrante.
 */
function validarCsrfToken($token) {
    if (session_status() === PHP_SESSION_NONE) {
        iniciarSesionSegura();
    }
    return !empty($token) && !empty($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

/**
 * Registra eventos de seguridad en la base de datos.
 * Tipos: 'CSRF_FAIL', 'LOGIN_FAIL', 'TIMEOUT', 'ACCESO_NO_AUTORIZADO'.
 */
function logSeguridadEvento($tipo, $detalle = '', $usuario_id = null) {
    global $pdo;
    try {
        $p = $pdo->prepare("INSERT INTO security_logs (evento_tipo, usuario_id, detalle, creado_en) VALUES (?, ?, ?, NOW())");
        $p->execute([$tipo, $usuario_id, $detalle]);
    } catch (Exception $e) {
        // Si no existe la tabla, intentamos crearla y reintentar una sola vez.
        try {
            $pdo->exec("CREATE TABLE IF NOT EXISTS security_logs (
                id INT AUTO_INCREMENT PRIMARY KEY,
                evento_tipo VARCHAR(80) NOT NULL,
                usuario_id INT NULL,
                detalle TEXT NULL,
                creado_en DATETIME NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");
            $p = $pdo->prepare("INSERT INTO security_logs (evento_tipo, usuario_id, detalle, creado_en) VALUES (?, ?, ?, NOW())");
            $p->execute([$tipo, $usuario_id, $detalle]);
        } catch (Exception $ex) {
            error_log("Error logSeguridadEvento: " . $ex->getMessage());
        }
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
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
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
// CONFIGURACIÓN OAUTH (SOCIAL LOGIN)
// ================================

// Google
define('GOOGLE_CLIENT_ID', getenv('GOOGLE_CLIENT_ID') ?: '683843517989-s9or7ddfusfl57nvqcllm09kkebd7vvc.apps.googleusercontent.com');
define('GOOGLE_CLIENT_SECRET', getenv('GOOGLE_CLIENT_SECRET') ?: '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'); // Necesitas copiar el Secreto que te dio Google y pegarlo aquí

// GitHub
define('GITHUB_CLIENT_ID', getenv('GITHUB_CLIENT_ID') ?: 'Ov23lipzxi8W4UooK4C3');
define('GITHUB_CLIENT_SECRET', getenv('GITHUB_CLIENT_SECRET') ?: 'b605fbe1ba5e3b91fba7de7186cd6bd2ef9bb4ce');

// URL de retorno (Callback)
// Asegúrate de que esta URL esté registrada en tus consolas de desarrollador
// Si no quieres depender del host dinámico, define AUTH_CALLBACK_URL o APP_URL.
// Ejemplo de URL de callback: http://192.168.3.210:8080/LC-ADVANCE/auth_callback.php
$defaultAuthCallback = '';
$customAppUrl = trim(APP_URL);
if (!empty(getenv('AUTH_CALLBACK_URL'))) {
    $defaultAuthCallback = getenv('AUTH_CALLBACK_URL');
} elseif ($customAppUrl !== '') {
    $defaultAuthCallback = rtrim($customAppUrl, '/') . '/auth_callback.php';
} elseif (!empty($_SERVER['HTTP_HOST'])) {
    $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
    $scriptDir = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
    $defaultAuthCallback = $scheme . '://' . $_SERVER['HTTP_HOST'] . $scriptDir . '/auth_callback.php';
} else {
    $defaultAuthCallback = 'http://localhost:8080/LC-ADVANCE/auth_callback.php';
}
define('AUTH_CALLBACK_URL', $defaultAuthCallback);

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

