<?php
require_once __DIR__ . '/../../src/Config/config.php';
require_once __DIR__ . '/../../src/Config/csrf.php';
require_once __DIR__ . '/../../src/Core/admin.php';
requireAdmin();

// ── Download via GET (before any output) ──
if (isset($_GET['download'])) {
    $file = basename($_GET['download']);
    $path = __DIR__ . '/../../backups/' . $file;
    if (file_exists($path)) {
        header('Content-Type: application/sql');
        header('Content-Disposition: attachment; filename="' . $file . '"');
        header('Content-Length: ' . filesize($path));
        readfile($path);
        exit;
    }
    $error_dl = 'Archivo no encontrado.';
}

$mensaje = '';
$error   = $error_dl ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && validarTokenCSRF($_POST['csrf_token'] ?? '')) {
    if (($_POST['accion'] ?? '') === 'crear') {
        $res = crearBackupDB($pdo);
        if ($res['ok']) {
            logActividad('ADMIN_BACKUP', "Backup creado: {$res['file']} ({$res['size']} bytes)", $_SESSION['usuario_id']);
            $mensaje = 'Backup creado: ' . $res['file'] . ' (' . round($res['size'] / 1024, 1) . ' KB)';
        } else {
            $error = 'Error: ' . ($res['error'] ?? 'no se pudo crear');
        }
    } elseif (($_POST['accion'] ?? '') === 'eliminar' && isset($_POST['file'])) {
        $file = basename($_POST['file']);
        $path = __DIR__ . '/../../backups/' . $file;
        if (file_exists($path) && unlink($path)) {
            logActividad('ADMIN_BACKUP_DELETE', "Backup eliminado: $file", $_SESSION['usuario_id']);
            $mensaje = "Backup $file eliminado.";
        } else {
            $error = 'No se pudo eliminar.';
        }
    }
}

$backups = listarBackups();
$total_size = array_sum(array_column($backups, 'size'));

function tiempoRelativo($fecha) {
    $ts = strtotime($fecha);
    $diff = time() - $ts;
    if ($diff < 60) return 'hace unos segundos';
    if ($diff < 3600) return 'hace ' . floor($diff / 60) . ' min';
    if ($diff < 86400) return 'hace ' . floor($diff / 3600) . ' h';
    if ($diff < 2592000) return 'hace ' . floor($diff / 86400) . ' d&iacute;as';
    return date('d/m/Y', $ts);
}

$page_title = 'Respaldos | Admin | LC-ADVANCE';
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
    <a href="settings.php">Config</a>
    <a href="backup.php" class="active">Respaldos</a>
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
    <h1>Respaldos de Base de Datos</h1>
    <?php if ($mensaje): ?><div class="admin-msg admin-msg-ok"><?= $mensaje ?></div><?php endif; ?>
    <?php if ($error): ?><div class="admin-msg admin-msg-err"><?= htmlspecialchars($error) ?></div><?php endif; ?>

    <!-- Stats row -->
    <div class="admin-cards" style="margin-bottom:20px;grid-template-columns:repeat(auto-fill,minmax(150px,1fr))">
      <div class="admin-card" style="text-align:center">
        <div style="font-size:28px;font-weight:700;color:var(--cyan)"><?= count($backups) ?></div>
        <div style="font-size:12px;color:var(--muted)">Respaldos</div>
      </div>
      <div class="admin-card" style="text-align:center">
        <div style="font-size:28px;font-weight:700;color:var(--green)"><?= $total_size > 1048576 ? round($total_size / 1048576, 1) . ' MB' : round($total_size / 1024, 1) . ' KB' ?></div>
        <div style="font-size:12px;color:var(--muted)">Tama&ntilde;o total</div>
      </div>
      <div class="admin-card" style="text-align:center">
        <div style="font-size:28px;font-weight:700;color:var(--yellow);word-break:break-all;font-size:20px"><?= $backups ? htmlspecialchars($backups[0]['file']) : '—' ?></div>
        <div style="font-size:12px;color:var(--muted)">&Uacute;ltimo respaldo</div>
      </div>
    </div>

    <!-- Create button -->
    <div style="margin-bottom:20px">
      <form method="post" style="display:inline" onsubmit="return confirm('¿Crear un nuevo respaldo? Esto puede tomar unos segundos.')">
        <?= campoTokenCSRF() ?>
        <input type="hidden" name="accion" value="crear">
        <button type="submit" class="admin-btn btn-primary">📦 Crear nuevo respaldo</button>
      </form>
    </div>

    <?php if ($backups): ?>
    <div style="overflow-x:auto">
      <table class="admin-table">
        <thead>
          <tr>
            <th>Archivo</th>
            <th>Tama&ntilde;o</th>
            <th>Fecha</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($backups as $b): ?>
          <tr>
            <td class="admin-cell-mono"><?= htmlspecialchars($b['file']) ?></td>
            <td><?= round($b['size'] / 1024, 1) ?> KB</td>
            <td class="admin-cell-mono"><?= htmlspecialchars($b['date']) ?><br><span style="font-size:11px;color:var(--muted)"><?= tiempoRelativo($b['date']) ?></span></td>
            <td>
              <a href="?download=<?= urlencode($b['file']) ?>" class="admin-btn admin-btn-sm">⬇️ Descargar</a>
              <form method="post" style="display:inline" onsubmit="return confirm('¿Eliminar este respaldo?')">
                <?= campoTokenCSRF() ?>
                <input type="hidden" name="accion" value="eliminar">
                <input type="hidden" name="file" value="<?= htmlspecialchars($b['file']) ?>">
                <button type="submit" class="admin-btn admin-btn-sm admin-btn-danger" title="Eliminar respaldo">🗑️</button>
              </form>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
    <?php else: ?>
    <div class="admin-empty">
      <div style="font-size:48px;margin-bottom:8px">📂</div>
      <p>No hay respaldos a&uacute;n. Crea tu primer respaldo con el bot&oacute;n de arriba.</p>
    </div>
    <?php endif; ?>
  </main>
</div>
<?php require __DIR__ . '/../../src/Templates/page_end.php'; ?>
