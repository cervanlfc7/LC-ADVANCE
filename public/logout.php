<?php
// ==========================================
// LC-ADVANCE - logout.php
// ==========================================
// Autor: LC-TEAM
// Fecha: 2025-10-29
// Descripción: Cierra la sesión del usuario
// ==========================================

require_once __DIR__ . '/../src/Config/config.php';
require_once __DIR__ . '/../src/Config/csrf.php';

// Only accept POST to perform logout. For GET show a confirmation form with CSRF token.
$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

if ($method !== 'POST') {
    // Show a minimal confirmation form to prevent CSRF via GET links
    $tokenHtml = campoTokenCSRF();
    echo '<!DOCTYPE html><html lang="es"><head><meta charset="UTF-8"><title>Confirmar cierre de sesión</title>'
       . '<style>body{font-family:sans-serif;background:#0a0a0f;color:#e8e8f0;display:flex;align-items:center;justify-content:center;height:100vh;margin:0}'
       . '.box{text-align:center;background:#13131f;border:1px solid #2a2a3a;border-radius:12px;padding:28px 34px}h1{color:#ffb86b;font-size:1.1rem;margin:0 0 8px}p{color:#bfc7d6;margin:0 0 16px;font-size:0.95rem}'
       . '.btn{display:inline-block;padding:10px 18px;border-radius:8px;border:1px solid #2a2a3a;background:#0f1624;color:#e6f7ff;text-decoration:none}</style>'
       . '</head><body><div class="box"><h1>¿Cerrar sesión?</h1><p>Confirma que deseas cerrar sesión en tu cuenta.</p>';
    // campoTokenCSRF(true) returns HTML <input type='hidden' name='csrf_token' value='...'>; include inside form
    echo '<form method="post" action="' . htmlspecialchars(basename(__FILE__)) . '">';
    echo $tokenHtml;
    echo '<button type="submit" class="btn">Cerrar sesión</button> ';
    echo '<a class="btn" href="' . htmlspecialchars(appRootPath() . '/public/dashboard.php', ENT_QUOTES) . '" style="margin-left:8px;background:#1a1a2e">Cancelar</a>';
    echo '</form></div></body></html>';
    exit;
}

// POST: validate CSRF and proceed
$token = $_POST['csrf_token'] ?? '';
if (!validarTokenCSRF($token)) {
    logSeguridadEvento('CSRF_LOGOUT_FAIL', 'Intento de logout con token CSRF inválido', $_SESSION['usuario_id'] ?? null);
    http_response_code(403);
    echo '<!DOCTYPE html><html lang="es"><head><meta charset="UTF-8"><title>Sesión inválida</title>'
       . '<style>body{font-family:sans-serif;background:#0a0a0f;color:#e8e8f0;display:flex;align-items:center;justify-content:center;height:100vh;margin:0}.box{text-align:center;background:#13131f;border:1px solid #2a2a3a;border-radius:16px;padding:40px 48px}h1{color:#ff4d4d;font-size:1.3rem;margin:0 0 12px}p{color:#8888aa;font-size:0.9rem;margin:0 0 20px}a{display:inline-block;padding:10px 24px;background:#1a1a2e;border:1px solid #2a2a3a;border-radius:8px;color:#00e5ff;text-decoration:none;font-size:0.85rem}</style></head><body>'
       . '<div class="box"><h1>⚠️ Solicitud inválida</h1><p>No se pudo cerrar la sesión correctamente.<br>Token de seguridad faltante o inválido.</p>'
       . '<a href="' . htmlspecialchars(appRootPath() . '/public/login.php', ENT_QUOTES) . '">← Ir al inicio</a></div></body></html>';
    exit;
}

if (isset($_SESSION['usuario_id'])) {
    logSeguridadEvento('LOGOUT', "Usuario ID: {$_SESSION['usuario_id']}", $_SESSION['usuario_id']);
}
cerrarSesionSegura();

// Usar script intermedio para limpiar datos locales antes de volver a login
echo '<!DOCTYPE html><html><head><title>Saliendo...</title></head><body style="background:#000;color:#fff;font-family:sans-serif;display:flex;justify-content:center;align-items:center;height:100vh;">';
echo '<div><p>Cerrando sesión y limpiando mapa...</p>';
echo '<script>
    // Limpiar TODA posible clave de guardado del mapa
    for (let i = localStorage.length - 1; i >= 0; i--) {
        const key = localStorage.key(i);
        if (key && key.startsWith("map.player_pos")) {
            localStorage.removeItem(key);
        }
    }
    // Limpiar caché del service worker para evitar volver a cargar una página antigua
    const destination = "login.php?logout=1&_=" + Date.now();
    if (typeof caches !== "undefined") {
        caches.keys().then((keys) => Promise.all(keys.map((key) => caches.delete(key)))).finally(() => {
            window.location.replace(destination);
        });
    } else {
        window.location.replace(destination);
    }
</script></div></body></html>';
exit;
?>
