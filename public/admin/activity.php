<?php
require_once __DIR__ . '/../../src/Config/config.php';
require_once __DIR__ . '/../../src/Config/csrf.php';
require_once __DIR__ . '/../../src/Core/admin.php';
requireAdmin();

$pagina   = max(1, (int)($_GET['p'] ?? 1));
$tipo     = trim($_GET['tipo'] ?? '');
$busqueda = trim($_GET['q'] ?? '');

$data = listarActividad($pdo, $pagina, $tipo, $busqueda);

$tipos_raw = $pdo->query("SELECT DISTINCT sl.evento_tipo FROM security_logs sl WHERE sl.evento_tipo NOT LIKE 'ADMIN_%' ORDER BY sl.evento_tipo")->fetchAll(PDO::FETCH_COLUMN);

// stats
$hoy = $pdo->prepare("SELECT COUNT(*) FROM security_logs WHERE DATE(creado_en) = CURDATE() AND evento_tipo NOT LIKE 'ADMIN_%'");
$hoy->execute();
$hoy_count = (int)$hoy->fetchColumn();

$semana = $pdo->prepare("SELECT COUNT(*) FROM security_logs WHERE creado_en >= DATE_SUB(NOW(), INTERVAL 7 DAY) AND evento_tipo NOT LIKE 'ADMIN_%'");
$semana->execute();
$semana_count = (int)$semana->fetchColumn();

$uniq = $pdo->prepare("SELECT COUNT(DISTINCT usuario_id) FROM security_logs WHERE DATE(creado_en) = CURDATE() AND usuario_id IS NOT NULL AND evento_tipo NOT LIKE 'ADMIN_%'");
$uniq->execute();
$uniq_count = (int)$uniq->fetchColumn();

$event_labels = [
    'LOGIN'        => ['Inicio sesi&oacute;n',      'var(--green)'],
    'LOGOUT'       => ['Cierre sesi&oacute;n',       'var(--muted)'],
    'REGISTER'     => ['Registro',                   'var(--cyan)'],
    'OAUTH_LOGIN'  => ['Login OAuth',                'var(--blue)'],
    'LESSON_VIEW'  => ['Vio lecci&oacute;n',         'var(--yellow)'],
    'LESSON_COMPLETE' => ['Complet&oacute; lecci&oacute;n', 'var(--green)'],
    'QUIZ_START'   => ['Inici&oacute; quiz',         'var(--pink)'],
    'QUIZ_COMPLETE' => ['Complet&oacute; quiz',       'var(--pink)'],
    'BADGE_UNLOCK' => ['Logro desbloqueado',         'var(--gold)'],
    'STREAK_UPDATE'=> ['Racha actualizada',          'var(--yellow)'],
    'EXAM_START'   => ['Inici&oacute; examen',       'var(--red)'],
    'EXAM_COMPLETE'=> ['Complet&oacute; examen',     'var(--green)'],
];

function fmtTipo($raw) {
    global $event_labels;
    $parts = explode('_', $raw, 2);
    $base  = $parts[0];
    return $event_labels[$base] ?? [htmlspecialchars($raw), 'var(--text)'];
}

$page_title = 'Actividad | Admin | LC-ADVANCE';
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
    <a href="backup.php">Respaldos</a>
    <a href="quizzes.php">Quizzes</a>
    <a href="progress.php">Progreso</a>
    <a href="announcements.php">Anuncios</a>
    <a href="activity.php" class="active">Actividad</a>
    <a href="streaks.php">Rachas</a>
    <a href="lessons.php">Lecciones</a>
    <a href="<?= htmlspecialchars(getDashboardUrl()) ?>">&larr; Dashboard</a>
    <a href="<?= htmlspecialchars($r . '/public/logout.php') ?>">🚪 Cerrar sesi&oacute;n</a>
  </nav>
  <main class="admin-main">
    <h1>Registro de Actividad</h1>

    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(140px,1fr));gap:10px;margin-bottom:20px">
      <div class="admin-card" style="text-align:center;padding:14px 10px">
        <div style="font-size:24px;font-weight:700;color:var(--cyan)"><?= $hoy_count ?></div>
        <div style="font-size:11px;color:var(--muted)">Hoy</div>
      </div>
      <div class="admin-card" style="text-align:center;padding:14px 10px">
        <div style="font-size:24px;font-weight:700;color:var(--yellow)"><?= $semana_count ?></div>
        <div style="font-size:11px;color:var(--muted)">Esta semana</div>
      </div>
      <div class="admin-card" style="text-align:center;padding:14px 10px">
        <div style="font-size:24px;font-weight:700;color:var(--green)"><?= $uniq_count ?></div>
        <div style="font-size:11px;color:var(--muted)">Usuarios hoy</div>
      </div>
      <div class="admin-card" style="text-align:center;padding:14px 10px">
        <div style="font-size:24px;font-weight:700;color:var(--pink)"><?= $data['total'] ?></div>
        <div style="font-size:11px;color:var(--muted)">Total registros</div>
      </div>
    </div>

    <form method="get" class="admin-search" style="display:flex;gap:8px;align-items:center;flex-wrap:wrap;margin-bottom:14px">
      <select name="tipo" class="admin-input" style="width:auto">
        <option value="">Todos los tipos</option>
        <?php foreach ($tipos_raw as $t): $lbl = fmtTipo($t); ?>
        <option value="<?= htmlspecialchars($t) ?>" <?= $tipo === $t ? 'selected' : '' ?>><?= $lbl[0] ?></option>
        <?php endforeach; ?>
      </select>
      <input type="text" name="q" placeholder="Buscar usuario o detalle&hellip;" value="<?= htmlspecialchars($busqueda) ?>" class="admin-input" style="flex:1;max-width:280px">
      <button type="submit" class="admin-btn" style="background:var(--cyan);border-color:var(--cyan);color:#041420">Filtrar</button>
      <?php if ($tipo || $busqueda): ?><a href="activity.php" class="admin-btn admin-btn-ghost">✕ Limpiar</a><?php endif; ?>
    </form>

    <div style="margin-bottom:10px;font-size:12px;color:var(--muted)"><?= $data['total'] ?> registro(s) &mdash; p&aacute;gina <?= $data['pagina'] ?> de <?= $data['paginas'] ?></div>

    <?php if ($data['items']): ?>
    <div style="overflow-x:auto">
      <table class="admin-table">
        <thead><tr><th>Fecha</th><th>Tipo</th><th>Usuario</th><th>Detalle</th><th>IP</th></tr></thead>
        <tbody>
          <?php foreach ($data['items'] as $l): list($lbl, $col) = fmtTipo($l['evento_tipo']); ?>
          <tr>
            <td class="admin-cell-mono"><?= date('d/m/y H:i', strtotime($l['creado_en'])) ?></td>
            <td><span style="display:inline-block;padding:2px 8px;border-radius:20px;font-size:10px;font-weight:600;background:<?= $col ?>15;color:<?= $col ?>;border:1px solid <?= $col ?>35"><?= $lbl ?></span></td>
            <td><?= $l['nombre_usuario'] ? htmlspecialchars($l['nombre_usuario']) : '<span style="color:var(--muted)">&mdash;</span>' ?></td>
            <td class="admin-cell-mono" style="max-width:380px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap" title="<?= htmlspecialchars($l['detalle'] ?? '') ?>"><?= htmlspecialchars($l['detalle'] ?? '') ?></td>
            <td class="admin-cell-mono"><?= htmlspecialchars($l['ip'] ?? '') ?></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

    <?php if ($data['paginas'] > 1): ?>
    <div class="admin-pages" style="margin-top:16px">
      <?php if ($data['pagina'] > 1): ?>
      <a href="?p=<?= $data['pagina'] - 1 ?><?= $tipo ? '&tipo='.urlencode($tipo) : '' ?><?= $busqueda ? '&q='.urlencode($busqueda) : '' ?>" class="admin-btn admin-btn-sm">&laquo; Anterior</a>
      <?php endif; ?>
      <?php for ($i = 1; $i <= $data['paginas']; $i++): ?>
      <a href="?p=<?= $i ?><?= $tipo ? '&tipo='.urlencode($tipo) : '' ?><?= $busqueda ? '&q='.urlencode($busqueda) : '' ?>" class="admin-page <?= $i === $data['pagina'] ? 'active' : '' ?>"><?= $i ?></a>
      <?php endfor; ?>
      <?php if ($data['pagina'] < $data['paginas']): ?>
      <a href="?p=<?= $data['pagina'] + 1 ?><?= $tipo ? '&tipo='.urlencode($tipo) : '' ?><?= $busqueda ? '&q='.urlencode($busqueda) : '' ?>" class="admin-btn admin-btn-sm">Siguiente &raquo;</a>
      <?php endif; ?>
    </div>
    <?php endif; ?>

    <?php else: ?>
    <div class="admin-empty">
      <div style="font-size:48px;margin-bottom:8px">📭</div>
      <p>No hay actividad registrada.</p>
    </div>
    <?php endif; ?>
  </main>
</div>
<?php require __DIR__ . '/../../src/Templates/page_end.php'; ?>
