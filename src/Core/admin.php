<?php
// ================================================
// LC-ADVANCE — Admin Panel Helpers
// Funciones para el panel de administración
// ================================================

function requireAdmin() {
    requireLogin();

    // ── 1. Role check ─────────────────────────────────────────────
    if (!isset($_SESSION['usuario_tipo']) || $_SESSION['usuario_tipo'] !== 'admin') {
        redirigir(getDashboardUrl() . '?error=acceso_denegado');
        exit;
    }

    // ── 2. IP Allowlisting ────────────────────────────────────────
    $allowedIpsEnv = getenv('ADMIN_ALLOWED_IPS');
    if (!empty($allowedIpsEnv)) {
        $allowedIps = array_filter(array_map('trim', explode(',', $allowedIpsEnv)));
        $remoteIp   = $_SERVER['REMOTE_ADDR'] ?? '';
        if (!in_array($remoteIp, $allowedIps, true)) {
            logSeguridadEvento(
                'ADMIN_IP_BLOCKED',
                "IP no permitida: {$remoteIp}",
                $_SESSION['usuario_id'] ?? null
            );
            http_response_code(403);
            die('<h1>403 Forbidden</h1><p>Tu dirección IP no está autorizada para acceder al panel de administración.</p>');
        }
    }

    // ── 3. Rate Limiting: max 120 req/min per admin session ───────
    $rl_key = 'admin_rl_' . ($_SESSION['usuario_id'] ?? 'anon');
    if (!isset($_SESSION[$rl_key])) {
        $_SESSION[$rl_key] = ['count' => 0, 'ts' => time()];
    }
    if (time() - $_SESSION[$rl_key]['ts'] > 60) {
        $_SESSION[$rl_key] = ['count' => 0, 'ts' => time()];
    }
    $_SESSION[$rl_key]['count']++;
    if ($_SESSION[$rl_key]['count'] > 120) {
        logSeguridadEvento(
            'ADMIN_RATE_LIMIT',
            'Rate limit excedido en panel admin',
            $_SESSION['usuario_id'] ?? null
        );
        http_response_code(429);
        die('<h1>429 Too Many Requests</h1><p>Demasiadas solicitudes. Espera un momento.</p>');
    }

    // ── 4. 2FA OTP verification ───────────────────────────────────
    // Allow the verify_2fa page itself to pass through without redirect loop.
    $current = basename($_SERVER['PHP_SELF'] ?? '');
    if ($current !== 'verify_2fa.php' && empty($_SESSION['admin_2fa_verified'])) {
        // Build the return URL so we can redirect back after OTP success.
        $returnUrl = htmlspecialchars($_SERVER['REQUEST_URI'] ?? '', ENT_QUOTES, 'UTF-8');
        $base      = appRootPath();
        $target    = ($base === '' ? '/' : $base . '/') . 'public/admin/verify_2fa.php';
        redirigir($target . '?return=' . urlencode($_SERVER['REQUEST_URI'] ?? ''));
        exit;
    }
}

function base32_decode_custom($b32) {
    $b32 = strtoupper($b32);
    $alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ234567';
    $bits = '';
    $out = '';
    foreach (str_split($b32) as $c) {
        if ($c === '=') break;
        $idx = strpos($alphabet, $c);
        if ($idx === false) continue;
        $bits .= str_pad(decbin($idx), 5, '0', STR_PAD_LEFT);
    }
    foreach (str_split($bits, 8) as $byte) {
        if (strlen($byte) < 8) continue;
        $out .= chr(bindec($byte));
    }
    return $out;
}

function verify_totp($secret_base32, $code, $digits = 6, $period = 30, $window = 1) {
    $secret = base32_decode_custom($secret_base32);
    if ($secret === '') return false;
    $time = floor(time() / $period);
    for ($i = -$window; $i <= $window; $i++) {
        $counter = pack('N*', 0) . pack('N*', $time + $i);
        $hash = hash_hmac('sha1', $counter, $secret, true);
        $offset = ord(substr($hash, -1)) & 0x0F;
        $truncated = substr($hash, $offset, 4);
        $value = unpack('N', $truncated)[1] & 0x7FFFFFFF;
        $generated = str_pad((string)($value % pow(10, $digits)), $digits, '0', STR_PAD_LEFT);
        if (hash_equals($generated, (string)$code)) return true;
    }
    return false;
}

function generate_base32_secret($length = 16) {
    $alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ234567';
    $bytes = random_bytes($length);
    $out = '';
    $bits = '';
    foreach (str_split($bytes) as $b) {
        $bits .= str_pad(decbin(ord($b)), 8, '0', STR_PAD_LEFT);
    }
    while (strlen($bits) >= 5) {
        $chunk = substr($bits, 0, 5);
        $bits = substr($bits, 5);
        $out .= $alphabet[bindec($chunk)];
    }
    if (strlen($bits) > 0) {
        $out .= $alphabet[bindec(str_pad($bits, 5, '0'))];
    }
    return $out;
}

function obtenerStatsAdmin($pdo) {
    $stats = [];

    $stats['total_usuarios'] = (int)$pdo->query("SELECT COUNT(*) FROM usuarios")->fetchColumn();
    $stats['usuarios_hoy'] = (int)$pdo->query("SELECT COUNT(*) FROM usuarios WHERE DATE(creado_en) = CURDATE()")->fetchColumn();

    $stmt = $pdo->query("SELECT COUNT(*) FROM user_progress WHERE completed = 1");
    $stats['lecciones_completadas'] = (int)$stmt->fetchColumn();

    $stmt = $pdo->query("SELECT COUNT(*) FROM usuarios WHERE DATE(ultimo_login) >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)");
    $stats['activos_7d'] = (int)$stmt->fetchColumn();

    $stmt = $pdo->query("SELECT COUNT(*) FROM user_progress");
    $stats['progresos_totales'] = (int)$stmt->fetchColumn();

    $stmt = $pdo->query("SELECT COUNT(*) FROM usuarios WHERE email_verified = 1");
    $stats['verificados'] = (int)$stmt->fetchColumn();

    $stmt = $pdo->query("SELECT COUNT(*) FROM usuarios_badges");
    $stats['badges_otorgados'] = (int)$stmt->fetchColumn();

    // Quiz stats
    $stmt = $pdo->query("SELECT COUNT(*) FROM user_progress WHERE completed = 1 AND score IS NOT NULL");
    $stats['quizzes_totales'] = (int)$stmt->fetchColumn();

    $stmt = $pdo->query("SELECT ROUND(AVG(score), 1) FROM user_progress WHERE score IS NOT NULL");
    $stats['promedio_score'] = (float)$stmt->fetchColumn();

    $stmt = $pdo->query("SELECT COUNT(*) FROM user_progress WHERE score >= 60");
    $stats['quizzes_aprobados'] = (int)$stmt->fetchColumn();

    $top = $pdo->query("SELECT nombre_usuario, puntos, nivel FROM usuarios WHERE tipo = 'student' ORDER BY puntos DESC LIMIT 5")->fetchAll(PDO::FETCH_ASSOC);
    $stats['top_usuarios'] = $top;

    $recent = $pdo->query("SELECT id, nombre_usuario, correo, puntos, nivel, tipo, creado_en FROM usuarios ORDER BY creado_en DESC LIMIT 10")->fetchAll(PDO::FETCH_ASSOC);
    $stats['registros_recientes'] = $recent;

    return $stats;
}

function obtenerHealthChecks() {
    $checks = [];

    // Required PHP extensions
    $required = ['pdo_mysql', 'mbstring', 'json', 'session', 'openssl', 'gd', 'fileinfo'];
    foreach ($required as $ext) {
        $checks['ext_' . $ext] = extension_loaded($ext);
    }

    // Cache directory writable
    $cache_dir = __DIR__ . '/../../cache';
    $checks['cache_writable'] = is_dir($cache_dir) && is_writable($cache_dir);

    // Uploads directory writable
    $uploads_dir = __DIR__ . '/../../public/uploads';
    $checks['uploads_writable'] = is_dir($uploads_dir) && is_writable($uploads_dir);

    // PHP config
    $checks['allow_url_fopen'] = (bool)ini_get('allow_url_fopen');
    $checks['file_uploads'] = (bool)ini_get('file_uploads');
    $checks['post_max_size'] = ini_get('post_max_size');
    $checks['upload_max_filesize'] = ini_get('upload_max_filesize');

    return $checks;
}

function RUTA_CACHE() {
    return __DIR__ . '/../../cache/lecciones_compiled.php';
}

function listarUsuarios($pdo, $pagina = 1, $busqueda = '', $orden = 'id', $dir = 'DESC') {
    $por_pagina = 25;
    $offset = ($pagina - 1) * $por_pagina;
    $ordenes_validos = ['id', 'nombre_usuario', 'correo', 'puntos', 'nivel', 'tipo', 'creado_en'];
    $orden = in_array($orden, $ordenes_validos) ? $orden : 'id';
    $dir = strtoupper($dir) === 'ASC' ? 'ASC' : 'DESC';

    if ($busqueda) {
        $like = '%' . $busqueda . '%';
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM usuarios WHERE nombre_usuario LIKE ? OR correo LIKE ?");
        $stmt->execute([$like, $like]);
        $total = (int)$stmt->fetchColumn();

        $stmt = $pdo->prepare("SELECT id, nombre_usuario, correo, puntos, nivel, tipo, email_verified, ultimo_login, racha_actual, creado_en, notas_admin FROM usuarios WHERE nombre_usuario LIKE ? OR correo LIKE ? ORDER BY $orden $dir LIMIT $por_pagina OFFSET $offset");
        $stmt->execute([$like, $like]);
    } else {
        $total = (int)$pdo->query("SELECT COUNT(*) FROM usuarios")->fetchColumn();
        $stmt = $pdo->query("SELECT id, nombre_usuario, correo, puntos, nivel, tipo, email_verified, ultimo_login, racha_actual, creado_en, notas_admin FROM usuarios ORDER BY $orden $dir LIMIT $por_pagina OFFSET $offset");
    }

    return [
        'usuarios' => $stmt->fetchAll(PDO::FETCH_ASSOC),
        'total' => $total,
        'paginas' => max(1, ceil($total / $por_pagina)),
        'pagina' => $pagina,
    ];
}

function obtenerUsuarioPorId($pdo, $id) {
    $stmt = $pdo->prepare("SELECT id, nombre_usuario, correo, puntos, nivel, tipo, email_verified, google_id, github_id, ultimo_login, racha_actual, creado_en FROM usuarios WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function actualizarRolUsuario($pdo, $id, $rol) {
    $roles_validos = ['student', 'teacher', 'admin'];
    if (!in_array($rol, $roles_validos)) return false;
    if ($id == $_SESSION['usuario_id']) return false;
    $stmt = $pdo->prepare("UPDATE usuarios SET tipo = ? WHERE id = ?");
    return $stmt->execute([$rol, $id]);
}

function actualizarPuntosAdmin($pdo, $id, $puntos) {
    $puntos = max(0, (int)$puntos);
    $stmt = $pdo->prepare("UPDATE usuarios SET puntos = ? WHERE id = ?");
    $success = $stmt->execute([$puntos, $id]);
    if ($success) {
        $nuevo_nivel = calcularNivel($puntos);
        $pdo->prepare("UPDATE usuarios SET nivel = ? WHERE id = ?")->execute([$nuevo_nivel, $id]);
    }
    return $success;
}

function eliminarUsuario($pdo, $id) {
    if ($id == $_SESSION['usuario_id']) return false;
    $stmt = $pdo->prepare("DELETE FROM usuarios WHERE id = ?");
    return $stmt->execute([$id]);
}

function obtenerSystemInfo() {
    $info = [];
    $info['php_version'] = PHP_VERSION;
    $info['server_software'] = $_SERVER['SERVER_SOFTWARE'] ?? 'N/A';
    $info['sapi'] = PHP_SAPI;
    $info['max_upload'] = ini_get('upload_max_filesize');
    $info['max_post'] = ini_get('post_max_size');
    $info['max_execution'] = ini_get('max_execution_time');
    $info['memory_limit'] = ini_get('memory_limit');
    $info['display_errors'] = ini_get('display_errors');
    $info['error_reporting'] = error_reporting();
    $info['date'] = date('Y-m-d H:i:s');
    $info['timezone'] = date_default_timezone_get();

    global $pdo;
    if ($pdo) {
        try {
            $stmt = $pdo->query("SELECT ROUND(SUM(data_length + index_length) / 1024 / 1024, 2) AS size_mb FROM information_schema.tables WHERE table_schema = (SELECT DATABASE())");
            $info['db_size_mb'] = (float)$stmt->fetchColumn();
            $stmt = $pdo->query("SELECT COUNT(*) FROM information_schema.tables WHERE table_schema = (SELECT DATABASE())");
            $info['db_tables'] = (int)$stmt->fetchColumn();
        } catch (Exception $e) {
            $info['db_size_mb'] = 0;
            $info['db_tables'] = 0;
        }
    }
    return $info;
}

// ── Settings ──────────────────────────────────────────
function obtenerSetting($pdo, $clave, $default = '') {
    $stmt = $pdo->prepare("SELECT valor FROM settings WHERE clave = ?");
    $stmt->execute([$clave]);
    $v = $stmt->fetchColumn();
    return $v !== false ? $v : $default;
}

function actualizarSetting($pdo, $clave, $valor) {
    $stmt = $pdo->prepare("INSERT INTO settings (clave, valor) VALUES (?, ?) ON DUPLICATE KEY UPDATE valor = VALUES(valor)");
    return $stmt->execute([$clave, $valor]);
}

// ── Announcements ─────────────────────────────────────
function listarAnuncios($pdo, $solo_activos = false) {
    $sql = "SELECT * FROM announcements" . ($solo_activos ? " WHERE activo = 1" : "") . " ORDER BY created_at DESC";
    return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}

function crearAnuncio($pdo, $titulo, $contenido, $tipo) {
    $stmt = $pdo->prepare("INSERT INTO announcements (titulo, contenido, tipo) VALUES (?, ?, ?)");
    return $stmt->execute([$titulo, $contenido, $tipo]);
}

function editarAnuncio($pdo, $id, $titulo, $contenido, $tipo) {
    $stmt = $pdo->prepare("UPDATE announcements SET titulo = ?, contenido = ?, tipo = ? WHERE id = ?");
    return $stmt->execute([$titulo, $contenido, $tipo, $id]);
}

function eliminarAnuncio($pdo, $id) {
    $stmt = $pdo->prepare("DELETE FROM announcements WHERE id = ?");
    return $stmt->execute([$id]);
}

function toggleAnuncio($pdo, $id) {
    $stmt = $pdo->prepare("UPDATE announcements SET activo = NOT activo WHERE id = ?");
    return $stmt->execute([$id]);
}

// ── Quiz Results ──────────────────────────────────────
function listarQuizResultados($pdo, $pagina = 1, $busqueda = '', $materia = '') {
    $por_pagina = 50;
    $offset = ($pagina - 1) * $por_pagina;
    $where = "WHERE up.score IS NOT NULL";
    $params = [];
    if ($busqueda) {
        $where .= " AND (u.nombre_usuario LIKE ? OR up.slug LIKE ?)";
        $params[] = "%$busqueda%";
        $params[] = "%$busqueda%";
    }
    if ($materia) {
        $where .= " AND (SELECT l.materia FROM (SELECT 1) dummy) IS NOT NULL";
        // materia filter via slug prefix matching
        $slugs_materia = obtenerSlugsPorMateria($materia);
        if ($slugs_materia) {
            $placeholders = implode(',', array_fill(0, count($slugs_materia), '?'));
            $where .= " AND up.slug IN ($placeholders)";
            $params = array_merge($params, $slugs_materia);
        }
    }
    $total = (int)$pdo->prepare("SELECT COUNT(*) FROM user_progress up JOIN usuarios u ON u.id = up.user_id $where")->execute($params);
    // Re-do for count
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM user_progress up JOIN usuarios u ON u.id = up.user_id $where");
    $stmt->execute($params);
    $total = (int)$stmt->fetchColumn();

    $stmt = $pdo->prepare("SELECT up.*, u.nombre_usuario, u.correo FROM user_progress up JOIN usuarios u ON u.id = up.user_id $where ORDER BY up.updated_at DESC LIMIT $por_pagina OFFSET $offset");
    $stmt->execute($params);
    return [
        'items' => $stmt->fetchAll(PDO::FETCH_ASSOC),
        'total' => $total,
        'paginas' => max(1, ceil($total / $por_pagina)),
        'pagina' => $pagina,
    ];
}

function obtenerSlugsPorMateria($materia) {
    $mapa = obtenerSlugAMateria();
    $slugs = [];
    foreach ($mapa as $slug => $mat) {
        if ($mat === $materia) $slugs[] = $slug;
    }
    return $slugs;
}

// ── Backups ───────────────────────────────────────────
function crearBackupDB($pdo) {
    $dir = __DIR__ . '/../../backups';
    if (!is_dir($dir)) mkdir($dir, 0755, true);
    $filename = 'lc_advance_backup_' . date('Y-m-d_H-i-s') . '.sql';
    $path = "$dir/$filename";
    $db = getenv('DB_NAME') ?: 'lc_advance';
    $user = getenv('DB_USER') ?: 'root';
    $pass = getenv('DB_PASS') ?: '';
    $host = getenv('DB_HOST') ?: 'localhost';
    $cmd = sprintf('mysqldump --host=%s --user=%s --password=%s %s 2>NUL',
        escapeshellarg($host),
        escapeshellarg($user),
        escapeshellarg($pass),
        escapeshellarg($db)
    );
    $output = shell_exec($cmd);
    if ($output) {
        file_put_contents($path, $output);
        return ['ok' => true, 'file' => $filename, 'size' => filesize($path)];
    }
    // Fallback PHP-based backup
    try {
        $tables = $pdo->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);
        $sql = "-- LC-ADVANCE Backup " . date('Y-m-d H:i:s') . "\n\n";
        foreach ($tables as $table) {
            $stmt = $pdo->query("SHOW CREATE TABLE $table");
            $row = $stmt->fetch(PDO::FETCH_NUM);
            $sql .= $row[1] . ";\n\n";
            $rows = $pdo->query("SELECT * FROM $table")->fetchAll(PDO::FETCH_ASSOC);
            foreach ($rows as $row) {
                $cols = implode(',', array_map(function($c) { return "`$c`"; }, array_keys($row)));
                $vals = implode(',', array_map(function($v) { return is_null($v) ? 'NULL' : "'" . addslashes($v) . "'"; }, array_values($row)));
                $sql .= "INSERT INTO `$table` ($cols) VALUES ($vals);\n";
            }
            $sql .= "\n";
        }
        file_put_contents($path, $sql);
        return ['ok' => true, 'file' => $filename, 'size' => filesize($path)];
    } catch (Exception $e) {
        return ['ok' => false, 'error' => $e->getMessage()];
    }
}

function listarBackups() {
    $dir = __DIR__ . '/../../backups';
    if (!is_dir($dir)) return [];
    $files = glob("$dir/lc_advance_backup_*.sql");
    $backups = [];
    foreach ($files as $f) {
        $backups[] = [
            'file' => basename($f),
            'size' => filesize($f),
            'date' => date('Y-m-d H:i:s', filemtime($f)),
        ];
    }
    rsort($backups);
    return $backups;
}

// ── Activity Logging ──────────────────────────────────
function logActividad($tipo, $detalle = '', $usuario_id = null) {
    global $pdo;
    try {
        $stmt = $pdo->prepare("INSERT INTO security_logs (evento_tipo, usuario_id, detalle, ip, creado_en) VALUES (?, ?, ?, ?, NOW())");
        $stmt->execute([$tipo, $usuario_id ?? ($_SESSION['usuario_id'] ?? null), $detalle, $_SERVER['REMOTE_ADDR'] ?? '']);
    } catch (Exception $e) {}
}

function listarActividad($pdo, $pagina = 1, $tipo = '', $busqueda = '') {
    $por_pagina = 50;
    $offset = ($pagina - 1) * $por_pagina;
    $where = "WHERE sl.evento_tipo NOT LIKE 'ADMIN_%'";
    $params = [];
    if ($tipo) {
        $where .= " AND sl.evento_tipo LIKE ?";
        $params[] = "$tipo%";
    }
    if ($busqueda) {
        $where .= " AND (u.nombre_usuario LIKE ? OR sl.detalle LIKE ?)";
        $params[] = "%$busqueda%";
        $params[] = "%$busqueda%";
    }
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM security_logs sl LEFT JOIN usuarios u ON u.id = sl.usuario_id $where");
    $stmt->execute($params);
    $total = (int)$stmt->fetchColumn();

    $stmt = $pdo->prepare("SELECT sl.*, u.nombre_usuario FROM security_logs sl LEFT JOIN usuarios u ON u.id = sl.usuario_id $where ORDER BY sl.creado_en DESC LIMIT $por_pagina OFFSET $offset");
    $stmt->execute($params);
    return [
        'items' => $stmt->fetchAll(PDO::FETCH_ASSOC),
        'total' => $total,
        'paginas' => max(1, ceil($total / $por_pagina)),
        'pagina' => $pagina,
    ];
}

// ── Content helpers ────────────────────────────────────
function obtenerMaterias() {
    $lecciones = obtenerLecciones();
    $materias = [];
    foreach ($lecciones as $l) {
        $m = $l['materia'] ?? 'Sin Materia';
        if (!in_array($m, $materias)) $materias[] = $m;
    }
    return $materias;
}

function limpiarCachéLecciones($pdo) {
    $cache = RUTA_CACHE();
    if (file_exists($cache)) {
        unlink($cache);
        logActividad('ADMIN_CACHE_CLEAR', 'Cach&eacute; de lecciones limpiado', $_SESSION['usuario_id']);
        return true;
    }
    return false;
}

// ── Quiz Questions CRUD ───────────────────────────────

function listarPreguntasQuiz($pdo, $lesson_slug) {
    try {
        $stmt = $pdo->prepare("SELECT * FROM quiz_questions WHERE lesson_slug = ? AND activa = 1 ORDER BY orden ASC, id ASC");
        $stmt->execute([$lesson_slug]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        return [];
    }
}

function guardarPreguntaQuiz($pdo, $lesson_slug, $pregunta, $correcta_texto, $opciones, $id = null) {
    try {
        $opciones_json = json_encode($opciones);
        if ($id) {
            $stmt = $pdo->prepare("UPDATE quiz_questions SET pregunta = ?, correcta = ?, opciones = ? WHERE id = ? AND lesson_slug = ?");
            $stmt->execute([$pregunta, $correcta_texto, $opciones_json, $id, $lesson_slug]);
        } else {
            $max = $pdo->prepare("SELECT COALESCE(MAX(orden), -1) + 1 FROM quiz_questions WHERE lesson_slug = ?");
            $max->execute([$lesson_slug]);
            $orden = (int)$max->fetchColumn() + 1;
            $stmt = $pdo->prepare("INSERT INTO quiz_questions (lesson_slug, pregunta, correcta, opciones, orden) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$lesson_slug, $pregunta, $correcta_texto, $opciones_json, $orden]);
        }
        logActividad('QUIZ_EDIT', "Pregunta " . ($id ? "actualizada" : "creada") . " en $lesson_slug", $_SESSION['usuario_id']);
        return true;
    } catch (Exception $e) {
        return false;
    }
}

function eliminarPreguntaQuiz($pdo, $id) {
    try {
        $stmt = $pdo->prepare("UPDATE quiz_questions SET activa = 0 WHERE id = ?");
        $stmt->execute([$id]);
        logActividad('QUIZ_DELETE', "Pregunta #$id eliminada", $_SESSION['usuario_id']);
        return true;
    } catch (Exception $e) {
        return false;
    }
}

function contarPreguntasQuizDB($pdo, $lesson_slug) {
    try {
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM quiz_questions WHERE lesson_slug = ? AND activa = 1");
        $stmt->execute([$lesson_slug]);
        return (int)$stmt->fetchColumn();
    } catch (Exception $e) {
        return 0;
    }
}

function obtenerQuizParaLeccion($pdo, $slug, $leccion) {
    $db_count = contarPreguntasQuizDB($pdo, $slug);
    if ($db_count > 0) {
        $preguntas_db = listarPreguntasQuiz($pdo, $slug);
        $quiz = [];
        foreach ($preguntas_db as $q) {
            $quiz[] = [
                'pregunta'  => $q['pregunta'],
                'correcta'  => $q['correcta'],
                'opciones'  => json_decode($q['opciones'], true) ?? [],
            ];
        }
        return $quiz;
    }
    return $leccion['quiz'] ?? [];
}

function sincronizarQuizzesDesdeArchivo($pdo, $slug, $leccion) {
    $file_quiz = $leccion['quiz'] ?? [];
    if (empty($file_quiz)) return 0;
    $pdo->prepare("UPDATE quiz_questions SET activa = 0 WHERE lesson_slug = ?")->execute([$slug]);
    $count = 0;
    foreach ($file_quiz as $q) {
        $pregunta  = $q['pregunta'] ?? '';
        $correcta  = $q['correcta'] ?? '';
        $opciones  = $q['opciones'] ?? [];
        if (!$pregunta || !$correcta || count($opciones) < 2) continue;
        $opciones_json = json_encode($opciones);
        $stmt = $pdo->prepare("INSERT INTO quiz_questions (lesson_slug, pregunta, correcta, opciones, orden) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$slug, $pregunta, $correcta, $opciones_json, $count]);
        $count++;
    }
    if ($count > 0) {
        logActividad('QUIZ_SYNC', "$count preguntas importadas para $slug", $_SESSION['usuario_id']);
    }
    return $count;
}


