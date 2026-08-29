<?php
require_once __DIR__ . '/../../src/Config/config.php';
require_once __DIR__ . '/../../src/Config/csrf.php';
require_once __DIR__ . '/../../src/Core/admin.php';
requireAdmin();

// Allow admin to set up TOTP 2FA for their account
$userId = $_SESSION['usuario_id'];
$stmt = $pdo->prepare("SELECT id, nombre_usuario, correo, twofa_enabled, twofa_secret FROM usuarios WHERE id = ?");
$stmt->execute([$userId]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$user) { cerrarSesionSegura(); redirigir('public/login.php'); }

$error = '';
$success = '';

// If POST, verify provided code and save secret
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!validarCsrfToken($_POST['csrf_token'] ?? '')) { $error = 'Token CSRF inválido.'; }
    else {
        $provided = trim($_POST['otp_code'] ?? '');
        $secret = $_POST['secret'] ?? '';
        if (empty($secret) || empty($provided)) { $error = 'Se requiere secreto y código.'; }
        else {
            if (verify_totp($secret, $provided)) {
                // Save secret and enable 2FA
                $stmt = $pdo->prepare("UPDATE usuarios SET twofa_secret = ?, twofa_enabled = 1 WHERE id = ?");
                $stmt->execute([$secret, $userId]);
                logSeguridadEvento('ADMIN_2FA_ENABLED', '2FA activado por admin', $userId);
                $success = '✅ 2FA activado. A partir de ahora deberás usar tu app de autenticación.';
                $user['twofa_enabled'] = 1;
            } else {
                $error = 'Código TOTP inválido. Verifica la hora del dispositivo y vuelve a intentar.';
            }
        }
    }
}

// Generate a new secret for display in GET
$display_secret = $user['twofa_secret'] ?: generate_base32_secret(20);
$issuer = urlencode(APP_NAME ?: 'LC-ADVANCE');
$label = urlencode($user['nombre_usuario'] . '@' . ($_SERVER['SERVER_NAME'] ?? 'localhost'));
$provisioning = "otpauth://totp/{$label}?secret={$display_secret}&issuer={$issuer}&digits=6&period=30";
// QR will be generated locally in the browser (no external network dependency). Pass provisioning URI to client-side generator.
$provisioning_js = json_encode($provisioning);
$qr_endpoint = 'qr.php?d=' . urlencode(base64_encode($provisioning));
$qr_src = htmlspecialchars($qr_endpoint);

$page_title = 'Configurar 2FA | Admin | LC-ADVANCE';
$r = appRootPath();
$page_show_bg_orb = true;
$v = filemtime(__DIR__ . '/../assets/css/admin.css');
$page_extra_head = '<link rel="stylesheet" href="' . $r . '/public/assets/css/dashboard.css?v=' . filemtime(__DIR__ . '/../assets/css/dashboard.css') . '">' . "\n" .
    '<link rel="stylesheet" href="' . $r . '/public/assets/css/admin.css?v=' . $v . '">';
require __DIR__ . '/../../src/Templates/page_start.php';
?>
<div class="admin-wrap">
  <nav class="admin-nav">
    <h2>⚙️ Admin</h2>
    <a href="index.php">Dashboard</a>
    <a href="usuarios.php">Usuarios</a>
    <a href="logros.php">Logros</a>
    <a href="logs.php">Logs</a>
    <a href="settings.php">Config</a>
    <a href="backup.php">Respaldos</a>
    <a href="quizzes.php">Quizzes</a>
    <a href="progress.php">Progreso</a>
    <a href="announcements.php">Anuncios</a>
    <a href="activity.php">Actividad</a>
    <a href="streaks.php">Rachas</a>
    <a href="lessons.php">Lecciones</a>
    <a href="setup_2fa.php" class="active">2FA</a>
    <a href="<?= htmlspecialchars(getDashboardUrl()) ?>">← Dashboard</a>
    <a href="<?= htmlspecialchars(appRootPath() . '/public/logout.php') ?>">🚪 Cerrar sesión</a>
  </nav>
  <main class="admin-main">
    <h1>Configurar 2FA (TOTP)</h1>

    <?php if ($error): ?><div class="admin-msg admin-msg-err"><?= htmlspecialchars($error) ?></div><?php endif; ?>
    <?php if ($success): ?><div class="admin-msg admin-msg-ok"><?= htmlspecialchars($success) ?></div><?php endif; ?>

    <p>Usa una app de autenticación (Google Authenticator, Authy, FreeOTP) para escanear el siguiente código QR o ingresa manualmente el secreto.</p>

    <div style="display:flex;gap:18px;align-items:center;flex-wrap:wrap">
      <div style="min-width:220px">
        <div id="qr" style="border-radius:12px;border:1px solid var(--border);padding:8px;display:inline-block;background:var(--surface);"></div>
      </div>
      <div style="flex:1;min-width:220px">
        <div style="background:var(--surface2);padding:12px;border-radius:10px;border:1px solid var(--border);font-family:var(--font-mono);display:flex;gap:8px;align-items:center;">
          <div style="flex:1">
            <strong>Secreto (manual):</strong>
            <div id="secret-text" style="margin-top:8px;font-size:1.05rem;letter-spacing:2px;user-select:text"><?= htmlspecialchars($display_secret) ?></div>
          </div>
          <div style="display:flex;flex-direction:column;gap:8px">
            <button id="copy-secret" type="button" class="admin-btn" style="white-space:nowrap;padding:8px 10px;font-size:0.9rem">📋 Copiar</button>
            <button id="reveal-secret" type="button" class="admin-btn admin-btn-ghost" style="white-space:nowrap;padding:8px 10px;font-size:0.9rem">👁️ Mostrar</button>
          </div>
        </div>
        <form method="post" style="margin-top:12px;max-width:360px">
          <?= campoTokenCSRF() ?>
          <input type="hidden" name="secret" value="<?= htmlspecialchars($display_secret) ?>">
          <label style="display:block;margin-top:8px;font-size:0.85rem;color:var(--muted)">Código de 6 dígitos de tu app</label>
          <input name="otp_code" maxlength="6" pattern="\d{6}" required class="admin-input" style="width:160px;padding:10px;margin-top:6px;font-family:var(--font-mono)">
          <div style="margin-top:10px">
            <button type="submit" class="admin-btn">Verificar y activar 2FA</button>
            <a href="usuarios.php" class="admin-btn admin-btn-ghost" style="margin-left:8px">Cancelar</a>
          </div>
        </form>
      </div>
    </div>

    <?php if ($user['twofa_enabled']): ?>
      <details style="margin-top:18px">
        <summary>Estado actual</summary>
        <p>2FA está activado en esta cuenta.</p>
        <form method="post" action="disable_2fa.php" onsubmit="return confirm('Desactivar 2FA eliminará el requerimiento. ¿Continuar?')" style="margin-top:8px">
          <?= campoTokenCSRF() ?>
          <button type="submit" class="admin-btn admin-btn-danger">Desactivar 2FA</button>
        </form>
      </details>
    <?php endif; ?>

  </main>
</div>

<script src="<?= htmlspecialchars(assetUrl('public/assets/js/qrcode.full.min.js')) ?>"></script>
<script>
(function(){
  var prov = <?= $provisioning_js ?>;
  var qrEl = document.getElementById('qr');
  try{
    // Render QR using local library
    new QRCode(qrEl, { text: prov, width: 240, height: 240, colorDark: '#00e5ff', colorLight: '#0f1423' });
  }catch(e){
    // Fallback: request server-generated image
    qrEl.innerHTML = '';
    var img = document.createElement('img');
    img.src = '<?= htmlspecialchars($qr_src) ?>';
    img.alt = 'QR 2FA';
    img.style.borderRadius = '8px';
    img.style.display = 'block';
    qrEl.appendChild(img);
  }

  // Copy / reveal secret controls
  var copyBtn = document.getElementById('copy-secret');
  var revealBtn = document.getElementById('reveal-secret');
  var secretEl = document.getElementById('secret-text');
  if (copyBtn && secretEl) {
    copyBtn.addEventListener('click', function(){
      var text = secretEl.textContent.trim();
      if (navigator.clipboard && navigator.clipboard.writeText) {
        navigator.clipboard.writeText(text).then(function(){
          copyBtn.textContent = '✅ Copiado';
          setTimeout(function(){ copyBtn.textContent = '📋 Copiar'; }, 2000);
        }).catch(function(){
          // Fallback
          var ta = document.createElement('textarea'); ta.value = text; document.body.appendChild(ta); ta.select(); try{ document.execCommand('copy'); copyBtn.textContent='✅ Copiado'; setTimeout(function(){ copyBtn.textContent='📋 Copiar'; },2000);}catch(e){ alert('Copia manual: ' + text);} ta.remove();
        });
      } else {
        var ta = document.createElement('textarea'); ta.value = text; document.body.appendChild(ta); ta.select(); try{ document.execCommand('copy'); copyBtn.textContent='✅ Copiado'; setTimeout(function(){ copyBtn.textContent='📋 Copiar'; },2000);}catch(e){ alert('Copia manual: ' + text);} ta.remove();
      }
    });
  }
  if (revealBtn && secretEl) {
    var hidden = true;
    revealBtn.addEventListener('click', function(){
      if (hidden) { secretEl.style.filter = 'none'; revealBtn.textContent = '🙈 Ocultar'; hidden = false; }
      else { secretEl.style.filter = 'blur(6px)'; revealBtn.textContent = '👁️ Mostrar'; hidden = true; }
    });
    // Initially blur the secret a bit
    secretEl.style.filter = 'blur(6px)';
  }

})();
</script>

<?php require __DIR__ . '/../../src/Templates/page_end.php'; ?>