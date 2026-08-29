<?php
// ================================================
// LC-ADVANCE — Admin 2FA OTP Verification
// ================================================
// Protects the entire admin panel with a one-time
// 6-digit code sent to the admin's registered email.
// Flow:
//  GET  → generate & email OTP (if not sent yet)
//  POST → validate OTP, set session flag, redirect
// ================================================

require_once __DIR__ . '/../../src/Config/config.php';
require_once __DIR__ . '/../../src/Config/csrf.php';
require_once __DIR__ . '/../../src/Core/admin.php';

// ── Auth: must be logged-in admin, but bypass 2FA gate ──────────
requireLogin();
if (!isset($_SESSION['usuario_tipo']) || $_SESSION['usuario_tipo'] !== 'admin') {
    redirigir(getDashboardUrl() . '?error=acceso_denegado');
    exit;
}

// Already verified this session → go to admin dashboard
if (!empty($_SESSION['admin_2fa_verified'])) {
    $returnTo = filter_var($_GET['return'] ?? '', FILTER_SANITIZE_URL);
    $safeReturn = (!empty($returnTo) && str_contains($returnTo, '/admin/')) ? $returnTo : appRootPath() . '/public/admin/index.php';
    redirigir($safeReturn);
    exit;
}

// ── Helpers ──────────────────────────────────────────────────────
$OTP_EXPIRY  = 600; // 10 minutes
$OTP_COOLDOWN = 60; // resend cooldown (seconds)
$userId      = $_SESSION['usuario_id'];
$returnUrl   = filter_var($_GET['return'] ?? '', FILTER_SANITIZE_URL);

// Fetch admin email from DB
$stmt = $pdo->prepare("SELECT correo, nombre_usuario FROM usuarios WHERE id = ?");
$stmt->execute([$userId]);
$admin = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$admin) {
    cerrarSesionSegura();
    redirigir('public/login.php');
    exit;
}

$error   = '';
$success = '';
$info    = '';

// ── Generate / resend OTP ─────────────────────────────────────────
function generateAndSendOtp(string $email, string $nombre): void {
    $otp = str_pad((string)random_int(0, 999999), 6, '0', STR_PAD_LEFT);
    $_SESSION['admin_otp_code'] = password_hash($otp, PASSWORD_BCRYPT);
    $_SESSION['admin_otp_ts']   = time();
    $_SESSION['admin_otp_sent_at'] = time();

    $subject = '🔐 Código de verificación — Panel Admin LC-ADVANCE';
    $body = emailTemplate('Verificación de dos factores — Admin', "
        <p>Hola, <strong>{$nombre}</strong>.</p>
        <p>Ingresa este código para acceder al panel de administración:</p>
        <div class=\"box\">
            <div class=\"code\">{$otp}</div>
            <p style=\"color:#888fa0;font-size:0.78rem;margin:8px 0 0\">⏱ Válido por 10 minutos</p>
        </div>
        <p style=\"color:#888fa0;font-size:0.78rem\">Si no solicitaste este código, alguien intentó acceder a tu cuenta de administrador. Cambia tu contraseña de inmediato.</p>
    ");

    enviarEmail($email, $subject, $body);
    logSeguridadEvento('ADMIN_OTP_SENT', "OTP enviado a {$email}", $_SESSION['usuario_id'] ?? null);
}

// ── Handle POST: validate OTP or TOTP ─────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!validarCsrfToken($_POST['csrf_token'] ?? '')) {
        $error = '⚠️ Token de seguridad inválido. Recarga la página.';
    } elseif (isset($_POST['resend'])) {
        // Resend request (only applies to email OTP)
        $cooldownLeft = ($OTP_COOLDOWN - (time() - ($_SESSION['admin_otp_sent_at'] ?? 0)));
        if ($cooldownLeft > 0) {
            $info = "⏳ Espera {$cooldownLeft} segundos antes de reenviar.";
        } else {
            generateAndSendOtp($admin['correo'], $admin['nombre_usuario']);
            $success = '📧 Nuevo código enviado a tu correo.';
        }
    } else {
        // Validate OTP or TOTP
        $entered = trim($_POST['otp_code'] ?? '');
        if (empty($entered)) { $error = 'Introduce el código.'; }
        else {
            // If user has TOTP enabled, prefer verifying TOTP
            $stmt2 = $pdo->prepare("SELECT twofa_enabled, twofa_secret FROM usuarios WHERE id = ?");
            $stmt2->execute([$userId]);
            $two = $stmt2->fetch(PDO::FETCH_ASSOC);
            $usesTotp = !empty($two['twofa_enabled']) && !empty($two['twofa_secret']);

            if ($usesTotp) {
                if (verify_totp($two['twofa_secret'], $entered)) {
                    $_SESSION['admin_2fa_verified'] = true;
                    logSeguridadEvento('ADMIN_2FA_TOTP_SUCCESS', '2FA TOTP verificada', $userId);
                    $safeReturn = (!empty($returnUrl) && str_contains($returnUrl, '/admin/')) ? $returnUrl : appRootPath() . '/public/admin/index.php';
                    redirigir($safeReturn);
                    exit;
                } else {
                    $error = '❌ Código TOTP incorrecto.';
                    logSeguridadEvento('ADMIN_2FA_TOTP_FAIL', 'TOTP incorrecto', $userId);
                }
            } else {
                // Fallback to email OTP
                $storedHash = $_SESSION['admin_otp_code'] ?? '';
                $sentAt     = $_SESSION['admin_otp_ts']   ?? 0;

                if (empty($storedHash)) {
                    $error = '⚠️ No hay código activo. Haz clic en "Reenviar código".';
                } elseif ((time() - $sentAt) > $OTP_EXPIRY) {
                    unset($_SESSION['admin_otp_code'], $_SESSION['admin_otp_ts']);
                    $error = '⏰ El código ha expirado. Solicita uno nuevo.';
                    logSeguridadEvento('ADMIN_OTP_EXPIRED', 'OTP expirado', $userId);
                } elseif (!preg_match('/^\d{6}$/', $entered)) {
                    $error = '⚠️ El código debe ser de 6 dígitos numéricos.';
                } elseif (!password_verify($entered, $storedHash)) {
                    $error = '❌ Código incorrecto. Vuelve a intentarlo.';
                    logSeguridadEvento('ADMIN_OTP_FAIL', 'Código OTP incorrecto', $userId);
                } else {
                    // ✅ OTP correcto
                    $_SESSION['admin_2fa_verified'] = true;
                    unset($_SESSION['admin_otp_code'], $_SESSION['admin_otp_ts'], $_SESSION['admin_otp_sent_at']);
                    logSeguridadEvento('ADMIN_OTP_SUCCESS', 'Verificación 2FA exitosa', $userId);

                    $safeReturn = (!empty($returnUrl) && str_contains($returnUrl, '/admin/'))
                        ? $returnUrl
                        : appRootPath() . '/public/admin/index.php';
                    redirigir($safeReturn);
                    exit;
                }
            }
        }
    }
} else {
    // ── GET: send OTP if not already sent (or expired) ────────────
    $alreadySent   = isset($_SESSION['admin_otp_ts']);
    $sentRecently  = $alreadySent && (time() - ($_SESSION['admin_otp_ts'] ?? 0)) < $OTP_EXPIRY;
    if (!$sentRecently) {
        generateAndSendOtp($admin['correo'], $admin['nombre_usuario']);
        $info = '📧 Hemos enviado un código de 6 dígitos a tu correo.';
    } else {
        $remaining = $OTP_EXPIRY - (time() - $_SESSION['admin_otp_ts']);
        $info = "📧 Ya tienes un código activo (expira en {$remaining}s). Revisa tu correo.";
    }
}

// ── Mask email for display ────────────────────────────────────────
function maskEmail(string $email): string {
    [$local, $domain] = explode('@', $email, 2);
    $masked = substr($local, 0, 2) . str_repeat('*', max(0, strlen($local) - 2));
    return $masked . '@' . $domain;
}
$maskedEmail = maskEmail($admin['correo']);

// ── Render page ───────────────────────────────────────────────────
$page_title = 'Verificación 2FA | Admin | LC-ADVANCE';
$r = appRootPath();
$page_show_bg_orb = true;
$v = filemtime(__DIR__ . '/../assets/css/admin.css');
$page_extra_head = '<link rel="stylesheet" href="' . $r . '/public/assets/css/dashboard.css?v=' . filemtime(__DIR__ . '/../assets/css/dashboard.css') . '">' . "\n" .
    '<link rel="stylesheet" href="' . $r . '/public/assets/css/admin.css?v=' . $v . '">';
require __DIR__ . '/../../src/Templates/page_start.php';
?>


<div class="tfa-wrap">
  <div class="tfa-card">

    <div class="tfa-header">
      <span class="tfa-icon">🔐</span>
      <h1>Verificación de dos factores</h1>
      <p>Hemos enviado un código de 6 dígitos a<br>
         <span class="tfa-email"><?= htmlspecialchars($maskedEmail) ?></span>
      </p>
    </div>

    <div class="tfa-body">

      <?php if ($error): ?>
        <div class="tfa-msg tfa-msg-error" role="alert"><?= htmlspecialchars($error) ?></div>
      <?php endif; ?>
      <?php if ($success): ?>
        <div class="tfa-msg tfa-msg-success" role="alert"><?= htmlspecialchars($success) ?></div>
      <?php endif; ?>
      <?php if ($info): ?>
        <div class="tfa-msg tfa-msg-info" role="status"><?= htmlspecialchars($info) ?></div>
      <?php endif; ?>

      <form method="post" action="verify_2fa.php<?= !empty($returnUrl) ? '?return=' . urlencode($returnUrl) : '' ?>" autocomplete="off">
        <?= campoTokenCSRF() ?>
        <input type="hidden" name="return" value="<?= htmlspecialchars($returnUrl) ?>">

        <label class="tfa-label" for="otp_code">Código de verificación</label>
        <input
          type="number"
          id="otp_code"
          name="otp_code"
          class="tfa-otp-input"
          inputmode="numeric"
          pattern="\d{6}"
          minlength="6"
          maxlength="6"
          placeholder="000000"
          autocomplete="one-time-code"
          autofocus
          required
          aria-label="Código OTP de 6 dígitos"
        >
        <div class="tfa-hint">Revisa tu bandeja de entrada y carpeta de spam.</div>

        <button type="submit" class="tfa-btn-primary">✅ Verificar código</button>
      </form>

      <?php
        $otpTs = $_SESSION['admin_otp_ts'] ?? 0;
        $expiresAt = ($otpTs > 0) ? ($otpTs + $OTP_EXPIRY) : 0;
      ?>
      <?php if ($expiresAt > time()): ?>
      <div class="tfa-timer">
        El código expira en <span id="tfa-countdown"></span>
      </div>
      <script>
        (function() {
          const expiresAt = <?= (int)$expiresAt ?>;
          const el = document.getElementById('tfa-countdown');
          function tick() {
            const secs = Math.max(0, expiresAt - Math.floor(Date.now() / 1000));
            const m = String(Math.floor(secs / 60)).padStart(2, '0');
            const s = String(secs % 60).padStart(2, '0');
            el.textContent = m + ':' + s;
            if (secs > 0) setTimeout(tick, 1000);
            else el.textContent = 'expirado';
          }
          tick();
        })();
      </script>
      <?php endif; ?>

    </div><!-- /.tfa-body -->

    <div class="tfa-footer">
      <form method="post" class="tfa-resend-form" action="verify_2fa.php<?= !empty($returnUrl) ? '?return=' . urlencode($returnUrl) : '' ?>">
        <?= campoTokenCSRF() ?>
        <input type="hidden" name="resend" value="1">
        <button type="submit" class="tfa-link-btn">📧 Reenviar código</button>
      </form>
      <a href="<?= htmlspecialchars(getDashboardUrl()) ?>" class="tfa-back">← Volver al dashboard</a>
    </div>

  </div><!-- /.tfa-card -->
</div><!-- /.tfa-wrap -->

<?php require __DIR__ . '/../../src/Templates/page_end.php'; ?>
