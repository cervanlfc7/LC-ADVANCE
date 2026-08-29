<?php
require_once __DIR__ . '/../../src/Config/config.php';
require_once __DIR__ . '/../../src/Config/csrf.php';
require_once __DIR__ . '/../../src/Core/admin.php';
requireAdmin();

$mensaje = '';
$error   = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && validarTokenCSRF($_POST['csrf_token'] ?? '')) {
    $booleanos = [
        'maintenance_mode', 'registration_enabled',
        'enable_guest_mode', 'enable_ai_tutor',
    ];
    foreach ($booleanos as $k) {
        actualizarSetting($pdo, $k, isset($_POST[$k]) && $_POST[$k] === '1' ? '1' : '0');
    }
    $numericos = [
        'points_per_lesson', 'xp_per_quiz_correct', 'max_weekly_lessons',
        'points_per_level', 'streak_xp_multiplier',
        'quiz_questions_per_lesson', 'quiz_pass_threshold', 'exam_pass_threshold',
        'session_timeout', 'otp_expiry', 'otp_cooldown',
        'ai_timeout', 'ai_max_tokens', 'items_per_page',
    ];
    foreach ($numericos as $k) {
        if (isset($_POST[$k])) {
            actualizarSetting($pdo, $k, trim($_POST[$k]));
        }
    }
    $textos = ['maintenance_message', 'site_name', 'default_timezone'];
    foreach ($textos as $k) {
        if (isset($_POST[$k])) {
            actualizarSetting($pdo, $k, trim($_POST[$k]));
        }
    }
    logActividad('ADMIN_SETTINGS', 'Configuraci&oacute;n actualizada', $_SESSION['usuario_id']);
    $mensaje = 'Configuraci&oacute;n guardada.';
    // Refetch
    $settings = [];
    $stmt = $pdo->query("SELECT * FROM settings ORDER BY clave");
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { $settings[$row['clave']] = $row; }
}

$settings = [];
$stmt = $pdo->query("SELECT * FROM settings ORDER BY clave");
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { $settings[$row['clave']] = $row; }

$page_title = 'Configuraci&oacute;n | Admin | LC-ADVANCE';
$r = appRootPath();
$page_show_bg_orb = true;
$page_extra_head = '<link rel="stylesheet" href="' . $r . '/public/assets/css/dashboard.css?v=' . filemtime(__DIR__ . '/../assets/css/dashboard.css') . '">' . "\n" .
    '<link rel="stylesheet" href="' . $r . '/public/assets/css/admin.css?v=' . filemtime(__DIR__ . '/../assets/css/admin.css') . '">';
require __DIR__ . '/../../src/Templates/page_start.php';
?>
<div class="admin-wrap">
  <nav class="admin-nav">
    <h2>⚙️ Admin</h2>
    <a href="index.php">Dashboard</a>
    <a href="usuarios.php">Usuarios</a>
    <a href="logros.php">Logros</a>
    <a href="logs.php">Logs</a>
    <a href="settings.php" class="active">Config</a>
    <a href="backup.php">Respaldos</a>
    <a href="quizzes.php">Quizzes</a>
    <a href="progress.php">Progreso</a>
    <a href="announcements.php">Anuncios</a>
    <a href="activity.php">Actividad</a>
    <a href="streaks.php">Rachas</a>
    <a href="lessons.php">Lecciones</a>
    <a href="<?= htmlspecialchars(getDashboardUrl()) ?>">← Dashboard</a>
    <a href="<?= htmlspecialchars($r . '/public/logout.php') ?>">🚪 Cerrar sesi&oacute;n</a>
  </nav>
  <main class="admin-main">
    <h1>Configuraci&oacute;n del Sistema</h1>
    <?php if ($mensaje): ?><div class="admin-msg admin-msg-ok"><?= $mensaje ?></div><?php endif; ?>
    <?php if ($error): ?><div class="admin-msg admin-msg-err"><?= htmlspecialchars($error) ?></div><?php endif; ?>

    <form method="post" style="max-width:700px;margin:0 auto">
      <?= campoTokenCSRF() ?>

      <!-- ============================================================ -->
      <!-- GENERAL -->
      <!-- ============================================================ -->
      <div class="admin-section" style="margin-bottom:20px;padding:0">
        <h2 style="font-size:18px;color:var(--cyan);margin:0 0 16px 0;padding-bottom:8px;border-bottom:1px solid var(--border)">🌐 General</h2>

        <?php $k = 'site_name'; $s = $settings[$k] ?? []; ?>
        <div class="admin-field">
          <label for="<?= $k ?>"><?= htmlspecialchars(ucfirst(str_replace('_', ' ', $k))) ?></label>
          <div class="admin-field-desc"><?= htmlspecialchars($s['descripcion'] ?? '') ?></div>
          <input type="text" id="<?= $k ?>" name="<?= $k ?>" value="<?= htmlspecialchars($s['valor'] ?? 'LC-Advance') ?>" class="admin-input">
        </div>

        <?php $k = 'default_timezone'; $s = $settings[$k] ?? []; ?>
        <div class="admin-field">
          <label for="<?= $k ?>">Zona horaria</label>
          <div class="admin-field-desc"><?= htmlspecialchars($s['descripcion'] ?? '') ?></div>
          <input type="text" id="<?= $k ?>" name="<?= $k ?>" value="<?= htmlspecialchars($s['valor'] ?? 'America/Mexico_City') ?>" class="admin-input">
        </div>

        <?php $k = 'items_per_page'; $s = $settings[$k] ?? []; ?>
        <div class="admin-field">
          <label for="<?= $k ?>">Elementos por p&aacute;gina</label>
          <div class="admin-field-desc"><?= htmlspecialchars($s['descripcion'] ?? '') ?></div>
          <input type="number" id="<?= $k ?>" name="<?= $k ?>" value="<?= htmlspecialchars($s['valor'] ?? '25') ?>" class="admin-input" min="5" max="200" style="max-width:120px">
        </div>

        <?php foreach (['enable_guest_mode', 'registration_enabled'] as $k): $s = $settings[$k] ?? []; ?>
        <div class="admin-field-row">
          <div>
            <div class="admin-field-label"><?= htmlspecialchars(ucfirst(str_replace('_', ' ', $k))) ?></div>
            <div class="admin-field-desc"><?= htmlspecialchars($s['descripcion'] ?? '') ?></div>
          </div>
          <label class="toggle-switch">
            <input type="checkbox" name="<?= $k ?>" value="1" <?= ($s['valor'] ?? '0') === '1' ? 'checked' : '' ?>>
            <span class="toggle-track"><span class="toggle-dot"></span></span>
          </label>
        </div>
        <?php endforeach; ?>
      </div>

      <!-- ============================================================ -->
      <!-- GAMIFICACIÓN -->
      <!-- ============================================================ -->
      <div class="admin-section" style="margin-bottom:20px;padding:0">
        <h2 style="font-size:18px;color:var(--green);margin:0 0 16px 0;padding-bottom:8px;border-bottom:1px solid var(--border)">🏆 Gamificaci&oacute;n y XP</h2>

        <?php $campos_gam = [
          'points_per_lesson'  => ['Puntos por lecci&oacute;n', '50', 1, 9999],
          'xp_per_quiz_correct' => ['XP por respuesta correcta', '10', 1, 999],
          'points_per_level'    => ['Puntos por nivel', '500', 50, 99999],
          'streak_xp_multiplier' => ['Multiplicador XP de racha', '10', 1, 999],
        ]; ?>
        <?php foreach ($campos_gam as $k => $cfg): $s = $settings[$k] ?? []; ?>
        <div class="admin-field">
          <label for="<?= $k ?>"><?= $cfg[0] ?></label>
          <div class="admin-field-desc"><?= htmlspecialchars($s['descripcion'] ?? '') ?></div>
          <input type="number" id="<?= $k ?>" name="<?= $k ?>" value="<?= htmlspecialchars($s['valor'] ?? $cfg[1]) ?>" class="admin-input" min="<?= $cfg[2] ?>" max="<?= $cfg[3] ?>" style="max-width:120px">
        </div>
        <?php endforeach; ?>

        <?php $k = 'max_weekly_lessons'; $s = $settings[$k] ?? []; ?>
        <div class="admin-field">
          <label for="<?= $k ?>">L&iacute;mite semanal de lecciones</label>
          <div class="admin-field-desc"><?= htmlspecialchars($s['descripcion'] ?? '0 = sin l&iacute;mite') ?></div>
          <input type="number" id="<?= $k ?>" name="<?= $k ?>" value="<?= htmlspecialchars($s['valor'] ?? '0') ?>" class="admin-input" min="0" max="999" style="max-width:120px">
        </div>
      </div>

      <!-- ============================================================ -->
      <!-- QUIZZES Y EXÁMENES -->
      <!-- ============================================================ -->
      <div class="admin-section" style="margin-bottom:20px;padding:0">
        <h2 style="font-size:18px;color:var(--yellow);margin:0 0 16px 0;padding-bottom:8px;border-bottom:1px solid var(--border)">📝 Quizzes y Ex&aacute;menes</h2>

        <?php $campos_q = [
          'quiz_questions_per_lesson' => ['Preguntas por quiz', '10', 1, 50],
          'quiz_pass_threshold'       => ['% m&iacute;nimo para aprobar quiz', '60', 1, 100],
          'exam_pass_threshold'       => ['% m&iacute;nimo para aprobar examen final', '80', 1, 100],
        ]; ?>
        <?php foreach ($campos_q as $k => $cfg): $s = $settings[$k] ?? []; ?>
        <div class="admin-field">
          <label for="<?= $k ?>"><?= $cfg[0] ?></label>
          <div class="admin-field-desc"><?= htmlspecialchars($s['descripcion'] ?? '') ?></div>
          <input type="number" id="<?= $k ?>" name="<?= $k ?>" value="<?= htmlspecialchars($s['valor'] ?? $cfg[1]) ?>" class="admin-input" min="<?= $cfg[2] ?>" max="<?= $cfg[3] ?>" style="max-width:120px">
        </div>
        <?php endforeach; ?>
      </div>

      <!-- ============================================================ -->
      <!-- SEGURIDAD -->
      <!-- ============================================================ -->
      <div class="admin-section" style="margin-bottom:20px;padding:0">
        <h2 style="font-size:18px;color:var(--pink);margin:0 0 16px 0;padding-bottom:8px;border-bottom:1px solid var(--border)">🔒 Seguridad</h2>

        <?php $campos_s = [
          'session_timeout' => ['Tiempo de inactividad (segundos)', '1800', 60, 86400],
          'otp_expiry'      => ['Validez del OTP (segundos)', '600', 30, 3600],
          'otp_cooldown'    => ['Cooldown para reenviar OTP (segundos)', '60', 10, 600],
        ]; ?>
        <?php foreach ($campos_s as $k => $cfg): $s = $settings[$k] ?? []; ?>
        <div class="admin-field">
          <label for="<?= $k ?>"><?= $cfg[0] ?></label>
          <div class="admin-field-desc"><?= htmlspecialchars($s['descripcion'] ?? '') ?></div>
          <input type="number" id="<?= $k ?>" name="<?= $k ?>" value="<?= htmlspecialchars($s['valor'] ?? $cfg[1]) ?>" class="admin-input" min="<?= $cfg[2] ?>" max="<?= $cfg[3] ?>" style="max-width:120px">
        </div>
        <?php endforeach; ?>

        <?php $k = 'maintenance_mode'; $s = $settings[$k] ?? []; ?>
        <div class="admin-field-row">
          <div>
            <div class="admin-field-label">Modo mantenimiento</div>
            <div class="admin-field-desc"><?= htmlspecialchars($s['descripcion'] ?? '') ?></div>
          </div>
          <label class="toggle-switch">
            <input type="checkbox" name="<?= $k ?>" value="1" <?= ($s['valor'] ?? '0') === '1' ? 'checked' : '' ?>>
            <span class="toggle-track"><span class="toggle-dot"></span></span>
          </label>
        </div>

        <?php $k = 'maintenance_message'; $s = $settings[$k] ?? []; ?>
        <div class="admin-field">
          <label for="<?= $k ?>">Mensaje de mantenimiento</label>
          <div class="admin-field-desc"><?= htmlspecialchars($s['descripcion'] ?? '') ?></div>
          <textarea id="<?= $k ?>" name="<?= $k ?>" class="admin-input" rows="3"><?= htmlspecialchars($s['valor'] ?? 'Estamos realizando tareas de mantenimiento. Volvemos pronto.') ?></textarea>
        </div>
      </div>

      <!-- ============================================================ -->
      <!-- AI TUTOR -->
      <!-- ============================================================ -->
      <div class="admin-section" style="margin-bottom:20px;padding:0">
        <h2 style="font-size:18px;color:var(--pink);margin:0 0 16px 0;padding-bottom:8px;border-bottom:1px solid var(--border)">🤖 AI Tutor</h2>

        <?php $k = 'enable_ai_tutor'; $s = $settings[$k] ?? []; ?>
        <div class="admin-field-row">
          <div>
            <div class="admin-field-label">Activar AI Tutor</div>
            <div class="admin-field-desc"><?= htmlspecialchars($s['descripcion'] ?? '') ?></div>
          </div>
          <label class="toggle-switch">
            <input type="checkbox" name="<?= $k ?>" value="1" <?= ($s['valor'] ?? '1') === '1' ? 'checked' : '' ?>>
            <span class="toggle-track"><span class="toggle-dot"></span></span>
          </label>
        </div>

        <?php $campos_ai = [
          'ai_timeout'    => ['Tiempo m&aacute;ximo de espera (segundos)', '30', 1, 120],
          'ai_max_tokens' => ['M&aacute;ximo de tokens en respuesta', '1000', 100, 16000],
        ]; ?>
        <?php foreach ($campos_ai as $k => $cfg): $s = $settings[$k] ?? []; ?>
        <div class="admin-field">
          <label for="<?= $k ?>"><?= $cfg[0] ?></label>
          <div class="admin-field-desc"><?= htmlspecialchars($s['descripcion'] ?? '') ?></div>
          <input type="number" id="<?= $k ?>" name="<?= $k ?>" value="<?= htmlspecialchars($s['valor'] ?? $cfg[1]) ?>" class="admin-input" min="<?= $cfg[2] ?>" max="<?= $cfg[3] ?>" style="max-width:120px">
        </div>
        <?php endforeach; ?>
      </div>

      <div class="form-actions" style="text-align:center">
        <button type="submit" class="admin-btn btn-primary">💾 Guardar cambios</button>
      </div>
    </form>
  </main>
</div>
<script>
document.querySelectorAll('.toggle-switch input[type="checkbox"]').forEach(function(cb) {
  cb.addEventListener('change', function() {
    var track = this.nextElementSibling;
    var dot = track.querySelector('.toggle-dot');
    if (this.checked) {
      track.style.background = 'var(--cyan)';
      track.style.borderColor = 'var(--cyan)';
      dot.style.left = '25px';
      dot.style.background = '#041420';
    } else {
      track.style.background = 'var(--surface2)';
      track.style.borderColor = 'var(--border)';
      dot.style.left = '3px';
      dot.style.background = 'var(--muted)';
    }
  });
});
</script>
<?php require __DIR__ . '/../../src/Templates/page_end.php'; ?>
