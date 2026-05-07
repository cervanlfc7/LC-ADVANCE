<?php
// ==========================================
// LC-ADVANCE - config.php
// ==========================================
// Fecha: 2025-10-29
// Descripción: Configuración principal del sistema y conexión PDO a la base de datos.
// ==========================================

// ================================
// CONFIGURACIÓN GENERAL
// ================================
define('DEBUG_MODE', true);
date_default_timezone_set('America/Mexico_City');
define('APP_NAME', 'LC-ADVANCE');

// ================================
// SECURITY HEADERS (producción)
// ================================
if (!DEBUG_MODE || (isset($_SERVER['REQUEST_URI']) && strpos($_SERVER['REQUEST_URI'], '/api/') === 0)) {
    require_once __DIR__ . '/security_headers.php';
    applySecurityHeaders();
}

// ================================
// CONFIGURACIÓN DE LA BASE DE DATOS
// ================================
define('DB_HOST', getenv('DB_HOST') ?: 'localhost');
define('DB_NAME', getenv('DB_NAME') ?: 'lc_advance');
define('DB_USER', getenv('DB_USER') ?: 'root');
define('DB_PASS', getenv('DB_PASS') ?: '');

define('OLLAMA_API_URL', rtrim(getenv('OLLAMA_API_URL') ?: 'http://localhost:11434/v1', '/'));
define('OLLAMA_MODEL', getenv('OLLAMA_MODEL') ?: 'llama3.2:3b');
define('OLLAMA_API_KEY', getenv('OLLAMA_API_KEY') ?: '');
define('OLLAMA_REQUEST_TIMEOUT', 0);

define('LM_STUDIO_API_URL', rtrim(getenv('LM_STUDIO_API_URL') ?: 'http://localhost:1234/v1', '/'));
define('LM_STUDIO_MODEL', getenv('LM_STUDIO_MODEL') ?: 'qwen2.5-0.5b-instruct-gguf');
define('LM_STUDIO_API_KEY', getenv('LM_STUDIO_API_KEY') ?: '');
define('LM_STUDIO_REQUEST_TIMEOUT', 0);

define('OPENROUTER_API_KEY', getenv('OPENROUTER_API_KEY') ?: '');
define('OPENROUTER_MODEL', getenv('OPENROUTER_MODEL') ?: 'google/gemini-2.0-flash-001');
define('OPENROUTER_TIMEOUT', 20);
define('APP_URL', getenv('APP_URL') ?: '');

// ================================
// CONEXIÓN PDO SEGURA
// ================================
try {
    $pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4",
        DB_USER,
        DB_PASS,
        [PDO::ATTR_ERRMODE => DEBUG_MODE ? PDO::ERRMODE_EXCEPTION : PDO::ERRMODE_SILENT,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false]
    );
} catch (PDOException $e) {
    if (DEBUG_MODE) { die("Error de conexión: " . $e->getMessage()); }
    else { die("No se pudo conectar a la base de datos."); }
}

// ================================
// FUNCIONES AUXILIARES DE SEGURIDAD
// ================================
function limpiarEntrada($data) { return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8'); }
function usuarioAutenticado() { return isset($_SESSION['usuario_id']); }

function appRootPath() {
    $scriptName = $_SERVER['SCRIPT_NAME'] ?? '';
    $segments = explode('/', trim($scriptName, '/'));
    if (count($segments) <= 1) return '';
    $knownAppDirs = ['api', 'docs', 'mapa', 'Examen'];
    $firstSegment = $segments[0] ?? '';
    if (in_array($firstSegment, $knownAppDirs, true)) return '';
    return '/' . $firstSegment;
}

function redirigir($url) {
    if (!preg_match('#^(https?://|/)#i', $url)) {
        $base = appRootPath();
        $url = ($base === '' ? '/' : $base . '/') . ltrim($url, '/');
    }
    header("Location: $url");
    exit;
}

// ================================
// SESIONES SEGURAS
// ================================
define('SESSION_TIMEOUT', 1800);

function iniciarSesionSegura() {
    if (session_status() === PHP_SESSION_NONE) {
        session_set_cookie_params(['lifetime' => 0, 'path' => '/', 'domain' => '', 'secure' => (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off'), 'httponly' => true, 'samesite' => 'Lax']);
        session_start();
    }
    if (isset($_SESSION['usuario_id']) && isset($_SESSION['last_activity'])) {
        if ((time() - $_SESSION['last_activity']) > SESSION_TIMEOUT) {
            logSeguridadEvento('TIMEOUT', 'Sesión expirada', $_SESSION['usuario_id'] ?? null);
            cerrarSesionSegura();
            redirigir((strpos($_SERVER['PHP_SELF'], 'mapa/') !== false ? '../' : '') . 'login.php?timeout=1');
        }
    }
    $_SESSION['last_activity'] = time();
    if (!isset($_SESSION['created_at'])) { $_SESSION['created_at'] = time(); }
    elseif (time() - $_SESSION['created_at'] > 1800) { $_SESSION['created_at'] = time(); session_regenerate_id(true); }
    if (empty($_SESSION['csrf_token'])) { $_SESSION['csrf_token'] = bin2hex(random_bytes(32)); }
}

function csrfToken() { if (session_status() === PHP_SESSION_NONE) iniciarSesionSegura(); return $_SESSION['csrf_token'] ?? ''; }
function validarCsrfToken($token) { if (session_status() === PHP_SESSION_NONE) iniciarSesionSegura(); return !empty($token) && !empty($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token); }

function logSeguridadEvento($tipo, $detalle = '', $usuario_id = null) {
    global $pdo;
    try {
        $p = $pdo->prepare("INSERT INTO security_logs (evento_tipo, usuario_id, detalle, creado_en) VALUES (?, ?, ?, NOW())");
        $p->execute([$tipo, $usuario_id, $detalle]);
    } catch (Exception $e) {
        try {
            $pdo->exec("CREATE TABLE IF NOT EXISTS security_logs (id INT AUTO_INCREMENT PRIMARY KEY, evento_tipo VARCHAR(80) NOT NULL, usuario_id INT NULL, detalle TEXT NULL, creado_en DATETIME NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");
            $p = $pdo->prepare("INSERT INTO security_logs (evento_tipo, usuario_id, detalle, creado_en) VALUES (?, ?, ?, NOW())");
            $p->execute([$tipo, $usuario_id, $detalle]);
        } catch (Exception $ex) { error_log("Error logSeguridadEvento: " . $ex->getMessage()); }
    }
}

function requireLogin($allowGuest = true) {
    iniciarSesionSegura();
    if (empty($_SESSION['usuario_id']) && (empty($_SESSION['usuario_es_invitado']) || !$allowGuest)) { redirigir('login.php'); }
}

function requireMateriaContext() {
    iniciarSesionSegura();
    $materia = null;
    if (!empty($_GET['materia'])) { $materia = trim($_GET['materia']); $_SESSION['selected_materia'] = $materia; }
    elseif (!empty($_SESSION['selected_materia'])) { $materia = $_SESSION['selected_materia']; }
    if (empty($materia)) {
        $script = basename($_SERVER['PHP_SELF'] ?? '');
        if ($script === 'dashboard.php' && !empty($_GET['profesor'])) { return null; }
        redirigir('index.php?seleccionar_materia=1');
    }
    return $materia;
}

function cerrarSesionSegura() {
    if (session_status() === PHP_SESSION_NONE) session_start();
    $_SESSION = [];
    if (ini_get('session.use_cookies')) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', ['expires' => time() - 42000, 'path' => $params['path'] ?: '/', 'domain' => $params['domain'] ?: '', 'secure' => $params['secure'] ?? false, 'httponly' => $params['httponly'] ?? true, 'samesite' => 'Lax']);
    }
    session_destroy();
    session_write_close();
    if (isset($_COOKIE[session_name()])) { setcookie(session_name(), '', ['expires' => time() - 3600, 'path' => '/', 'domain' => '', 'secure' => false, 'httponly' => true, 'samesite' => 'Lax']); }
}

// ================================
// PUNTOS Y NIVELES
// ================================
function calcularNivel($puntos) { return floor($puntos / 500) + 1; }

// ================================
// OAUTH (usar env vars en producción)
// ================================
// LOCAL DEV: hardcoded for testing (NO commit!)
$_google_client_id = '317866808413-8odsje97n8j7k150j3ag1lr89ughotb7.apps.googleusercontent.com';
$_google_client_secret = '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';
$_github_client_id = 'Ov23liR2ex0RxXcrUfAz';
$_github_client_secret = 'dc8524f64a5a4dff43d8aa1d6e9e7f01d57e968d';

define('GOOGLE_CLIENT_ID', getenv('GOOGLE_CLIENT_ID') ?: $_google_client_id);
define('GOOGLE_CLIENT_SECRET', getenv('GOOGLE_CLIENT_SECRET') ?: $_google_client_secret);
define('GITHUB_CLIENT_ID', getenv('GITHUB_CLIENT_ID') ?: $_github_client_id);
define('GITHUB_CLIENT_SECRET', getenv('GITHUB_CLIENT_SECRET') ?: $_github_client_secret);

$defaultAuthCallback = '';
$customAppUrl = trim(APP_URL);
if (!empty(getenv('AUTH_CALLBACK_URL'))) { $defaultAuthCallback = getenv('AUTH_CALLBACK_URL'); }
elseif ($customAppUrl !== '') { $defaultAuthCallback = rtrim($customAppUrl, '/') . '/auth_callback.php'; }
elseif (!empty($_SERVER['HTTP_HOST'])) {
    $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
    $scriptDir = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
    $defaultAuthCallback = $scheme . '://' . $_SERVER['HTTP_HOST'] . $scriptDir . '/auth_callback.php';
} else { $defaultAuthCallback = 'http://localhost/LC-Advance/auth_callback.php'; }
define('AUTH_CALLBACK_URL', $defaultAuthCallback);

// ================================
// EMAIL / SMTP CONFIG
// ================================
// LOCAL DEV: hardcoded Gmail (NO commit!)
$_smtp_username = 'lcadvance40@gmail.com';
$_smtp_password = 'jbgt frey azdf fsjo';
$_smtp_from_email = 'lcadvance40@gmail.com';

define('SMTP_HOST', getenv('SMTP_HOST') ?: 'smtp.gmail.com');
define('SMTP_PORT', getenv('SMTP_PORT') ?: 465);
define('SMTP_USERNAME', getenv('SMTP_USERNAME') ?: $_smtp_username);
define('SMTP_PASSWORD', getenv('SMTP_PASSWORD') ?: $_smtp_password);
define('SMTP_FROM_EMAIL', getenv('SMTP_FROM_EMAIL') ?: $_smtp_from_email);
define('SMTP_FROM_NAME', getenv('SMTP_FROM_NAME') ?: 'LC-Advance');

function enviarEmail($destinatario, $asunto, $cuerpoHtml) {
    if (empty(SMTP_USERNAME) || empty(SMTP_PASSWORD)) {
        error_log("SMTP no configurado. SMTP_USERNAME: '" . SMTP_USERNAME . "' SMTP_PASSWORD: '" . SMTP_PASSWORD . "'");
        return false;
    }

    require_once __DIR__ . '/../Vendor/PHPMailer-6.9.1/src/PHPMailer.php';
    require_once __DIR__ . '/../Vendor/PHPMailer-6.9.1/src/SMTP.php';
    require_once __DIR__ . '/../Vendor/PHPMailer-6.9.1/src/Exception.php';

    $mail = new PHPMailer\PHPMailer\PHPMailer(true);
    
    try {
        $mail->isSMTP();
        $mail->Host = SMTP_HOST;
        $mail->Port = SMTP_PORT;
        $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_SMTPS;
        $mail->SMTPAuth = true;
        $mail->Username = SMTP_USERNAME;
        $mail->Password = SMTP_PASSWORD;
        
        $mail->setFrom(SMTP_FROM_EMAIL, SMTP_FROM_NAME);
        $mail->addAddress($destinatario);
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        $mail->Subject = $asunto;
        $mail->Body = $cuerpoHtml;
        $mail->AltBody = strip_tags(str_replace('<br>', "\n", $cuerpoHtml));
        
        $mail->send();
        return true;
    } catch (PHPMailer\PHPMailer\Exception $e) {
        error_log("Error al enviar email: " . $e->getMessage());
        return false;
    }
}

// ================================
// BADGES
// ================================
function otorgarBadge($usuario_id, $badge_id, $pdo) {
    $check = $pdo->prepare("SELECT COUNT(*) FROM usuarios_badges WHERE usuario_id = ? AND badge_id = ?");
    $check->execute([$usuario_id, $badge_id]);
    if ($check->fetchColumn() == 0) { $pdo->prepare("INSERT INTO usuarios_badges (usuario_id, badge_id) VALUES (?, ?)")->execute([$usuario_id, $badge_id]); }
}

function actualizarPuntos($usuario_id, $puntos_sumar, $pdo) {
    $pdo->prepare("UPDATE usuarios SET puntos = puntos + ? WHERE id = ?")->execute([$puntos_sumar, $usuario_id]);
}

// ================================
// CACHÉ DE LECCIONES (compilado + precomputación)
// ================================
$GLOBALS['__cached_lecciones'] = null;
$GLOBALS['__cached_extra'] = null;

function compileLecciones() {
    $src = __DIR__ . '/../Content/content.php';
    $out = __DIR__ . '/../../cache/lecciones_compiled.php';
    if (!is_dir(dirname($out))) @mkdir(dirname($out), 0755, true);
    $mtime = filemtime($src);
    $cached = @json_decode(@file_get_contents($out), true);
    $out_mtime = ($cached["_mtime"] ?? 0);
    if ($out_mtime === $mtime && !empty($cached["data"])) {
        $GLOBALS['__cached_lecciones'] = $cached["data"];
        $GLOBALS['__cached_extra'] = ($cached["extra"] ?? null);
        return $cached["data"];
    }
    if ($GLOBALS['__cached_lecciones'] === null) { global $lecciones; require_once $src; $GLOBALS['__cached_lecciones'] = $lecciones; }
    $por_materia = []; $slug_a_materia = [];
    foreach ($GLOBALS['__cached_lecciones'] as $l) {
        $m = $l["materia"] ?? "Sin Materia";
        if (!isset($por_materia[$m])) $por_materia[$m] = [];
        $por_materia[$m][] = $l;
        if (!empty($l["slug"])) $slug_a_materia[$l["slug"]] = $m;
    }
    $extra = ["por_materia" => $por_materia, "slug_a_materia" => $slug_a_materia, "total" => count($GLOBALS['__cached_lecciones'])];
    $GLOBALS['__cached_extra'] = $extra;
    @file_put_contents($out, json_encode(["_mtime" => $mtime, "data" => $GLOBALS['__cached_lecciones'], "extra" => $extra]));
    return $GLOBALS['__cached_lecciones'];
}

function obtenerLecciones() { if ($GLOBALS['__cached_lecciones'] !== null) return $GLOBALS['__cached_lecciones']; return compileLecciones(); }
function obtenerLeccionesPorMateria() { if ($GLOBALS['__cached_extra'] !== null) return $GLOBALS['__cached_extra']["por_materia"]; compileLecciones(); return $GLOBALS['__cached_extra']["por_materia"]; }
function obtenerSlugAMateria() { if ($GLOBALS['__cached_extra'] !== null) return $GLOBALS['__cached_extra']["slug_a_materia"]; compileLecciones(); return $GLOBALS['__cached_extra']["slug_a_materia"]; }
function buscarLeccion($slug) { $lecciones = obtenerLecciones(); foreach ($lecciones as $l) { if ($l["slug"] === $slug) return $l; } return null; }
