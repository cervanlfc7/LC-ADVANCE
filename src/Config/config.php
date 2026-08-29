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
define('DEBUG_MODE', false);
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

define('OPENROUTER_MODEL', getenv('OPENROUTER_MODEL') ?: 'openrouter/free');
define('OPENROUTER_TIMEOUT', 30);
define('OPENROUTER_FALLBACK_MODELS', getenv('OPENROUTER_FALLBACK_MODELS')
    ? explode(',', getenv('OPENROUTER_FALLBACK_MODELS'))
    : [
        'openrouter/free',
        'google/gemma-2-9b-it:free',
        'microsoft/phi-3-mini-128k-instruct:free'
    ]);
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
    
    // Ejecutar migraciones de base de datos automáticas
    inicializarMigraciones($pdo);
    // Verificar modo mantenimiento (bloquea a no-admins si está activo)
    checkMaintenanceMode($pdo);
} catch (PDOException $e) {
    if (DEBUG_MODE) { die("Error de conexión: " . $e->getMessage()); }
    else { die("No se pudo conectar a la base de datos."); }
}

function inicializarMigraciones($pdo) {
    // 1. Columna 'orden' en tabla 'badges'
    try {
        $stmt = $pdo->query("SHOW COLUMNS FROM badges LIKE 'orden'");
        if (!$stmt->fetch()) {
            $pdo->exec("ALTER TABLE badges ADD COLUMN orden INT NOT NULL DEFAULT 0");
        }
    } catch (Exception $e) {}

    // 2. Columna 'notas_admin' en tabla 'usuarios'
    try {
        $stmt = $pdo->query("SHOW COLUMNS FROM usuarios LIKE 'notas_admin'");
        if (!$stmt->fetch()) {
            $pdo->exec("ALTER TABLE usuarios ADD COLUMN notas_admin TEXT DEFAULT NULL");
        }
    } catch (Exception $e) {}

    // 3. Tabla de lecciones asignadas por grupo
    try {
        $pdo->exec("CREATE TABLE IF NOT EXISTS group_lecciones (
            id INT AUTO_INCREMENT PRIMARY KEY,
            grupo_id INT NOT NULL,
            slug VARCHAR(100) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            UNIQUE KEY uq_group_lesson (grupo_id, slug),
            INDEX idx_group_lecciones_slug (slug),
            INDEX idx_group_lecciones_grupo (grupo_id),
            FOREIGN KEY (grupo_id) REFERENCES grupos(id) ON DELETE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");
    } catch (Exception $e) {}

    // 4. Convertir iconos de badges a Emojis si están usando archivos .png
    try {
        $stmt = $pdo->query("SELECT icono FROM badges WHERE id = 1");
        $icon = $stmt->fetchColumn();
        if ($icon === 'badge_start.png') {
            $emojis = [
                1  => '🏁',
                2  => '🎯',
                3  => '⭐',
                4  => '👑',
                5  => '🔥',
                6  => '🥉',
                7  => '🥈',
                8  => '🥇',
                9  => '🏆',
                10 => '🌌',
                11 => '📖',
                12 => '🧙‍♂️',
                13 => '📜',
                14 => '🧠',
                15 => '⚡',
                16 => '🪐',
                17 => '☄️',
                18 => '☀️',
                19 => '📐',
                20 => '🧪',
                21 => '🏛️',
                22 => '🗣️'
            ];
            foreach ($emojis as $id => $emoji) {
                $pdo->prepare("UPDATE badges SET icono = ? WHERE id = ?")->execute([$emoji, $id]);
            }
        }
    } catch (Exception $e) {}

    // 4. Two-factor auth columns in usuarios
    try {
        $stmt = $pdo->query("SHOW COLUMNS FROM usuarios LIKE 'twofa_enabled'");
        if (!$stmt->fetch()) {
            $pdo->exec("ALTER TABLE usuarios ADD COLUMN twofa_enabled TINYINT(1) NOT NULL DEFAULT 0");
        }
        $stmt = $pdo->query("SHOW COLUMNS FROM usuarios LIKE 'twofa_secret'");
        if (!$stmt->fetch()) {
            $pdo->exec("ALTER TABLE usuarios ADD COLUMN twofa_secret VARCHAR(128) DEFAULT NULL");
        }
    } catch (Exception $e) {}

    // 4b. Columna 'protectores_racha' en usuarios
    try {
        $stmt = $pdo->query("SHOW COLUMNS FROM usuarios LIKE 'protectores_racha'");
        if (!$stmt->fetch()) {
            $pdo->exec("ALTER TABLE usuarios ADD COLUMN protectores_racha INT NOT NULL DEFAULT 0");
        }
    } catch (Exception $e) {}

    // 5. Tabla de settings del sistema
    try {
        $pdo->exec("CREATE TABLE IF NOT EXISTS settings (
            clave VARCHAR(100) PRIMARY KEY,
            valor TEXT,
            tipo VARCHAR(20) DEFAULT 'text',
            descripcion VARCHAR(255) DEFAULT NULL,
            actualizado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");
        // Valores por defecto
        $stmt = $pdo->query("SELECT COUNT(*) FROM settings");
        if ((int)$stmt->fetchColumn() === 0) {
            $pdo->exec("INSERT IGNORE INTO settings (clave, valor, tipo, descripcion) VALUES
                ('maintenance_mode', '0', 'boolean', 'Activar modo mantenimiento (bloquea acceso a usuarios no-admin)'),
                ('maintenance_message', 'Estamos realizando tareas de mantenimiento. Volvemos pronto.', 'text', 'Mensaje mostrado en modo mantenimiento'),
                ('points_per_lesson', '50', 'number', 'Puntos base por completar lección'),
                ('xp_per_quiz_correct', '10', 'number', 'XP por respuesta correcta en quiz'),
                ('max_weekly_lessons', '0', 'number', 'Límite semanal de lecciones (0 = sin límite)'),
                ('registration_enabled', '1', 'boolean', 'Permitir registro de nuevos usuarios'),
                ('site_name', 'LC-Advance', 'text', 'Nombre del sitio / plataforma'),
                ('items_per_page', '25', 'number', 'Elementos por p&aacute;gina en listados'),
                ('enable_guest_mode', '1', 'boolean', 'Permitir modo invitado'),
                ('points_per_level', '500', 'number', 'Puntos necesarios por nivel'),
                ('streak_xp_multiplier', '10', 'number', 'Multiplicador XP por racha (d&iacute;as &times; valor)'),
                ('quiz_questions_per_lesson', '10', 'number', 'M&aacute;ximo de preguntas por quiz'),
                ('quiz_pass_threshold', '60', 'number', 'Porcentaje m&iacute;nimo para aprobar quiz'),
                ('exam_pass_threshold', '80', 'number', 'Porcentaje m&iacute;nimo para aprobar examen final'),
                ('session_timeout', '1800', 'number', 'Tiempo de inactividad antes de cerrar sesi&oacute;n (segundos)'),
                ('otp_expiry', '600', 'number', 'Tiempo de validez del OTP (segundos)'),
                ('otp_cooldown', '60', 'number', 'Tiempo para reenviar OTP (segundos)'),
                ('enable_ai_tutor', '1', 'boolean', 'Activar tutor AI'),
                ('ai_timeout', '30', 'number', 'Tiempo m&aacute;ximo de espera del AI (segundos)'),
                ('ai_max_tokens', '1000', 'number', 'M&aacute;ximo de tokens en respuesta del AI')");
        }
    } catch (Exception $e) {}

    // 6. Tabla de anuncios
    try {
        $pdo->exec("CREATE TABLE IF NOT EXISTS announcements (
            id INT AUTO_INCREMENT PRIMARY KEY,
            titulo VARCHAR(200) NOT NULL,
            contenido TEXT NOT NULL,
            tipo ENUM('info','success','warning','danger') NOT NULL DEFAULT 'info',
            activo TINYINT(1) NOT NULL DEFAULT 1,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");
    } catch (Exception $e) {}

    // 7. Tabla de preguntas de quiz (editor desde admin)
    try {
        $pdo->exec("CREATE TABLE IF NOT EXISTS quiz_questions (
            id INT AUTO_INCREMENT PRIMARY KEY,
            lesson_slug VARCHAR(100) NOT NULL,
            pregunta TEXT NOT NULL,
            correcta TEXT NOT NULL COMMENT 'Texto de la respuesta correcta',
            opciones JSON NOT NULL COMMENT 'Array de opciones',
            orden INT NOT NULL DEFAULT 0,
            activa TINYINT(1) NOT NULL DEFAULT 1,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            INDEX idx_lesson_slug (lesson_slug),
            INDEX idx_orden (orden)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");
    } catch (Exception $e) {}

    // 8. Tabla de contenido personalizado de lecciones (editor admin)
    try {
        $pdo->exec("CREATE TABLE IF NOT EXISTS lecciones_contenido (
            slug VARCHAR(100) PRIMARY KEY,
            contenido LONGTEXT NOT NULL,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");
    } catch (Exception $e) {}
}

// ================================
// FUNCIONES AUXILIARES DE SEGURIDAD
// ================================
function limpiarEntrada($data) { return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8'); }
function usuarioAutenticado() { return isset($_SESSION['usuario_id']); }
function assetUrl($path) {
    // Prefer .min version if it exists
    if (!preg_match('/\.min\.(css|js)$/', $path)) {
        $minPath = preg_replace('/\.(css|js)$/', '.min.$1', $path);
        $minFull = $_SERVER['DOCUMENT_ROOT'] . '/' . ltrim(str_replace('/', '\\', $minPath), '\\/');
        $minFull = str_replace('/', DIRECTORY_SEPARATOR, $minFull);
        if (file_exists($minFull)) {
            return $minPath . '?v=' . substr(md5_file($minFull), 0, 8);
        }
    }
    $full = $_SERVER['DOCUMENT_ROOT'] . '/' . ltrim(str_replace('/', '\\', $path), '\\/');
    $full = str_replace('/', DIRECTORY_SEPARATOR, $full);
    if (file_exists($full)) {
        return $path . '?v=' . substr(md5_file($full), 0, 8);
    }
    return $path;
}

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
            redirigir('public/login.php?timeout=1');
        }
    }
    $_SESSION['last_activity'] = time();
    if (!isset($_SESSION['created_at'])) { $_SESSION['created_at'] = time(); }
    elseif (time() - $_SESSION['created_at'] > 1800) { $_SESSION['created_at'] = time(); session_regenerate_id(true); }
    if (empty($_SESSION['csrf_token'])) { $_SESSION['csrf_token'] = bin2hex(random_bytes(32)); }
}

function csrfToken() { if (session_status() === PHP_SESSION_NONE) iniciarSesionSegura(); if (empty($_SESSION['csrf_token'])) $_SESSION['csrf_token'] = bin2hex(random_bytes(32)); return $_SESSION['csrf_token']; }
function validarCsrfToken($token) { if (session_status() === PHP_SESSION_NONE) iniciarSesionSegura(); return !empty($token) && !empty($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token); }

function logSeguridadEvento($tipo, $detalle = '', $usuario_id = null) {
    global $pdo;
    $ip = $_SERVER['REMOTE_ADDR'] ?? '';
    try {
        $p = $pdo->prepare("INSERT INTO security_logs (evento_tipo, usuario_id, detalle, ip, creado_en) VALUES (?, ?, ?, ?, NOW())");
        $p->execute([$tipo, $usuario_id, $detalle, $ip]);
    } catch (Exception $e) {
        try {
            $pdo->exec("CREATE TABLE IF NOT EXISTS security_logs (id INT AUTO_INCREMENT PRIMARY KEY, evento_tipo VARCHAR(80) NOT NULL, usuario_id INT NULL, detalle TEXT NULL, ip VARCHAR(45) DEFAULT '', creado_en DATETIME NOT NULL, INDEX idx_evento_tipo (evento_tipo), INDEX idx_creado_en (creado_en)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");
            $p = $pdo->prepare("INSERT INTO security_logs (evento_tipo, usuario_id, detalle, ip, creado_en) VALUES (?, ?, ?, ?, NOW())");
            $p->execute([$tipo, $usuario_id, $detalle, $ip]);
        } catch (Exception $ex) { error_log("Error logSeguridadEvento: " . $ex->getMessage()); }
    }
}

function requireLogin($allowGuest = true) {
    iniciarSesionSegura();
    if (empty($_SESSION['usuario_id']) && (empty($_SESSION['usuario_es_invitado']) || !$allowGuest)) { redirigir('public/login.php'); }
}

function checkMaintenanceMode($pdo) {
    try {
        $stmt = $pdo->query("SELECT valor FROM settings WHERE clave = 'maintenance_mode'");
        $mode = $stmt->fetchColumn();
        $msg = $pdo->query("SELECT valor FROM settings WHERE clave = 'maintenance_message'")->fetchColumn();
    } catch (Exception $e) { return; }
    if ($mode === '1' && (!isset($_SESSION['usuario_tipo']) || $_SESSION['usuario_tipo'] !== 'admin')) {
        if (basename($_SERVER['PHP_SELF'] ?? '') === 'login.php') return;
        http_response_code(503);
        ?><!DOCTYPE html><html lang="es"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Mantenimiento — LC-ADVANCE</title><style>body{background:#060a12;color:#e8f4ff;font-family:'Space Grotesk',sans-serif;display:flex;align-items:center;justify-content:center;min-height:100vh;margin:0;text-align:center;padding:20px}.card{background:#0c1220;border:1px solid rgba(0,230,255,.12);border-radius:16px;padding:40px;max-width:480px}h1{font-family:Syne,sans-serif;font-size:28px;font-weight:800;background:linear-gradient(90deg,#00e5ff,#ff3cac);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text}p{color:rgba(200,230,255,.5);line-height:1.6}</style></head><body><div class="card"><h1>🔧 Modo Mantenimiento</h1><p><?= htmlspecialchars($msg ?: 'Estamos realizando tareas de mantenimiento. Volvemos pronto.') ?></p></div></body></html><?php
        exit;
    }
}

function getDashboardReturnParams() {
    if (session_status() === PHP_SESSION_NONE) {
        iniciarSesionSegura();
    }

    $params = [];
    if (!empty($_GET['profesor'])) {
        $params[] = 'profesor=' . urlencode($_GET['profesor']);
    }
    if (isset($_GET['materia']) && $_GET['materia'] !== '') {
        $params[] = 'materia=' . urlencode($_GET['materia']);
    } elseif (!empty($_SESSION['selected_materia'])) {
        $params[] = 'materia=' . urlencode($_SESSION['selected_materia']);
    }
    return $params ? '?' . implode('&', $params) : '';
}

function getDashboardUrl() {
    return appRootPath() . '/public/dashboard.php' . getDashboardReturnParams();
}

function getMateriasValidas() {
    return [
        'Temas Selectos de Matemáticas I y II',
        'Inglés',
        'Pensamiento Matemático III',
        'Programación',
        'Física I',
        'Química I',
        'Ecosistemas',
        'Ciencias Sociales',
        'Historia de México',
    ];
}

function isValidMateria($materia) {
    if (empty($materia)) {
        return false;
    }
    return in_array(trim($materia), getMateriasValidas(), true);
}

function requireMateriaContext() {
    iniciarSesionSegura();
    $materia = null;
    if (!empty($_GET['materia'])) {
        $materia = trim($_GET['materia']);
    } elseif (!empty($_SESSION['selected_materia'])) {
        $materia = trim($_SESSION['selected_materia']);
    }
    if (!isValidMateria($materia)) {
        redirigir('index.php?seleccionar_materia=1');
    }
    $_SESSION['selected_materia'] = $materia;
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
function calcularNivel($puntos) { return (int) floor($puntos / 500) + 1; }

// ================================
// CREDENCIALES DESDE BD (fallback si no hay env var)
// ================================
function getCredencial($clave, $default = '') {
    global $pdo;
    if (!isset($pdo)) return $default;
    if (isset($GLOBALS['__credenciales_cache'][$clave])) {
        return $GLOBALS['__credenciales_cache'][$clave];
    }
    try {
        $stmt = $pdo->prepare("SELECT valor FROM credenciales WHERE clave = ?");
        $stmt->execute([$clave]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $GLOBALS['__credenciales_cache'][$clave] = $row['valor'];
            return $row['valor'];
        }
    } catch (Exception $e) {
        error_log("getCredencial($clave): " . $e->getMessage());
    }
    return $default;
}

// ================================
// OAUTH (env var → BD → fallback vacío)
// ================================
$_google_client_id = getenv('GOOGLE_CLIENT_ID') ?: getCredencial('google_client_id');
$_google_client_secret = getenv('GOOGLE_CLIENT_SECRET') ?: getCredencial('google_client_secret');
$_github_client_id_dev = getenv('GITHUB_CLIENT_ID') ?: getCredencial('github_client_id_dev');
$_github_client_secret_dev = getenv('GITHUB_CLIENT_SECRET') ?: getCredencial('github_client_secret_dev');
$_github_client_id_prod = getenv('GITHUB_CLIENT_ID_PROD') ?: getCredencial('github_client_id_prod');
$_github_client_secret_prod = getenv('GITHUB_CLIENT_SECRET_PROD') ?: getCredencial('github_client_secret_prod');

// (GitHub selection moved below to avoid using AUTH_CALLBACK_URL before it's defined)

// Autenticación OAuth: configuraciones locales y de producción.
// Si se define AUTH_CALLBACK_URL en el entorno, úsalo directamente.
// Si se define APP_URL, se construye el callback desde esa URL.
// En producción con dominio completo, APP_URL puede ser la URL raíz,
// y el callback se normaliza a /public/auth_callback.php si la app corre en /public.
$defaultAuthCallback = '';
$customAppUrl = trim(APP_URL);
if (!empty(getenv('AUTH_CALLBACK_URL'))) {
    $defaultAuthCallback = getenv('AUTH_CALLBACK_URL');
} elseif ($customAppUrl !== '') {
    $normalizedAppUrl = rtrim($customAppUrl, '/');
    if (strpos($normalizedAppUrl, '/public') === false && !empty($_SERVER['SCRIPT_NAME']) && strpos($_SERVER['SCRIPT_NAME'], '/public/') !== false) {
        $normalizedAppUrl .= '/public';
    }
    $defaultAuthCallback = $normalizedAppUrl . '/auth_callback.php';
}
elseif (!empty($_SERVER['HTTP_HOST'])) {
    $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
    $scriptDir = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
    $defaultAuthCallback = $scheme . '://' . $_SERVER['HTTP_HOST'] . $scriptDir . '/auth_callback.php';
} else { $defaultAuthCallback = 'http://localhost/LC-Advance/auth_callback.php'; }
define('AUTH_CALLBACK_URL', $defaultAuthCallback);

// Selección de credenciales Google: permite credenciales separadas para producción.
// Variables de entorno soportadas:
// - GOOGLE_CLIENT_ID, GOOGLE_CLIENT_SECRET (dev/default)
// - GOOGLE_CLIENT_ID_PROD, GOOGLE_CLIENT_SECRET_PROD (producción)
$devGoogleId = getenv('GOOGLE_CLIENT_ID') ?: $_google_client_id;
$devGoogleSecret = getenv('GOOGLE_CLIENT_SECRET') ?: $_google_client_secret;
$prodGoogleId = getenv('GOOGLE_CLIENT_ID_PROD') ?: '';
$prodGoogleSecret = getenv('GOOGLE_CLIENT_SECRET_PROD') ?: '';

// Si hay credenciales de prod y el callback no apunta a localhost, usar prod.
if (!empty($prodGoogleId) && !preg_match('#^https?://(localhost|127\.0\.0\.1)#i', AUTH_CALLBACK_URL)) {
    define('GOOGLE_CLIENT_ID', $prodGoogleId);
    define('GOOGLE_CLIENT_SECRET', $prodGoogleSecret ?: $devGoogleSecret);
} else {
    define('GOOGLE_CLIENT_ID', $devGoogleId);
    define('GOOGLE_CLIENT_SECRET', $devGoogleSecret);
}

// Selección de credenciales GitHub: soporta credenciales separadas para producción.
// Variables de entorno soportadas:
// - GITHUB_CLIENT_ID, GITHUB_CLIENT_SECRET (dev/default)
// - GITHUB_CLIENT_ID_PROD, GITHUB_CLIENT_SECRET_PROD (producción)
$devGithubId = getenv('GITHUB_CLIENT_ID') ?: $_github_client_id_dev;
$devGithubSecret = getenv('GITHUB_CLIENT_SECRET') ?: $_github_client_secret_dev;
$prodGithubId = getenv('GITHUB_CLIENT_ID_PROD') ?: $_github_client_id_prod;
$prodGithubSecret = getenv('GITHUB_CLIENT_SECRET_PROD') ?: $_github_client_secret_prod;

if (!empty($prodGithubId) && !preg_match('#^https?://(localhost|127\.0\.0\.1)#i', AUTH_CALLBACK_URL)) {
    define('GITHUB_CLIENT_ID', $prodGithubId);
    define('GITHUB_CLIENT_SECRET', $prodGithubSecret ?: $devGithubSecret);
} else {
    define('GITHUB_CLIENT_ID', $devGithubId);
    define('GITHUB_CLIENT_SECRET', $devGithubSecret);
}

// ================================
// EMAIL / SMTP CONFIG (env var → BD → fallback vacío)
// ================================
$_smtp_username = getenv('SMTP_USERNAME') ?: getCredencial('smtp_username');
$_smtp_password = getenv('SMTP_PASSWORD') ?: getCredencial('smtp_password');
$_smtp_from_email = getenv('SMTP_FROM_EMAIL') ?: getCredencial('smtp_from_email');

define('SMTP_HOST', getenv('SMTP_HOST') ?: 'smtp.gmail.com');
define('SMTP_PORT', getenv('SMTP_PORT') ?: 465);
define('SMTP_USERNAME', getenv('SMTP_USERNAME') ?: $_smtp_username);
define('SMTP_PASSWORD', getenv('SMTP_PASSWORD') ?: $_smtp_password);
define('SMTP_FROM_EMAIL', getenv('SMTP_FROM_EMAIL') ?: $_smtp_from_email);
define('SMTP_FROM_NAME', getenv('SMTP_FROM_NAME') ?: 'LC-Advance');

// OpenRouter API key (definido aquí para que $pdo esté disponible)
define('OPENROUTER_API_KEY', getenv('OPENROUTER_API_KEY') ?: getCredencial('openrouter_api_key'));

function emailTemplate($titulo, $contenido, $colorAcento = '#00e5ff') {
    $appName = 'LC-ADVANCE';
    return <<<HTML
<!DOCTYPE html>
<html lang="es">
<head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1.0">
<style>
  body{margin:0;padding:0;background:#f4f6f9;font-family:'Segoe UI',system-ui,-apple-system,sans-serif}
  .wrap{max-width:520px;margin:32px auto;background:#ffffff;border-radius:16px;overflow:hidden;box-shadow:0 4px 24px rgba(0,0,0,0.06)}
  .head{background:linear-gradient(135deg,#0c1220,#1a1a2e);padding:32px 36px 28px;text-align:center}
  .head h1{margin:0;font-size:1.3rem;color:#ffffff;font-weight:700;letter-spacing:-0.3px}
  .head p{margin:6px 0 0;color:rgba(255,255,255,0.5);font-size:0.82rem}
  .body{padding:28px 36px;color:#1a1a2e;font-size:0.92rem;line-height:1.6}
  .body p{margin:0 0 14px}
  .btn{display:inline-block;padding:13px 28px;background:{$colorAcento};color:#0a0a0f;text-decoration:none;border-radius:10px;font-weight:700;font-size:0.92rem;margin:8px 0}
  .box{background:#f8f9fc;border:1px solid #e8ecf2;border-radius:10px;padding:20px;text-align:center;margin:18px 0}
  .code{font-size:2.4rem;font-weight:700;letter-spacing:6px;color:{$colorAcento};font-family:'Courier New',monospace}
  .foot{border-top:1px solid #e8ecf2;padding:16px 36px;text-align:center;color:#888fa0;font-size:0.72rem}
</style></head>
<body>
  <div class="wrap">
    <div class="head">
      <h1>⚡ {$appName}</h1>
      <p>{$titulo}</p>
    </div>
    <div class="body">
      {$contenido}
    </div>
    <div class="foot">LC-ADVANCE — Plataforma Educativa &bull; Este es un mensaje automático</div>
  </div>
</body></html>
HTML;
}

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
function obtenerContenidoLeccion($pdo, $slug, $contenido_default = '') {
    try { $stmt = $pdo->prepare("SELECT contenido FROM lecciones_contenido WHERE slug = ?"); $stmt->execute([$slug]); $r = $stmt->fetchColumn(); return $r !== false ? $r : $contenido_default; }
    catch (Exception $e) { return $contenido_default; }
}
function guardarContenidoLeccion($pdo, $slug, $contenido) {
    try { $stmt = $pdo->prepare("INSERT INTO lecciones_contenido (slug, contenido) VALUES (?, ?) ON DUPLICATE KEY UPDATE contenido = VALUES(contenido), updated_at = NOW()"); return $stmt->execute([$slug, $contenido]); }
    catch (Exception $e) { return false; }
}
