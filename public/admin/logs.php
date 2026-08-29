<?php
require_once __DIR__ . '/../../src/Config/config.php';
require_once __DIR__ . '/../../src/Config/csrf.php';
require_once __DIR__ . '/../../src/Core/admin.php';
requireAdmin();

$page = max(1, (int)($_GET['p'] ?? 1));
$tipo_filtro = $_GET['tipo'] ?? '';
$busqueda = trim($_GET['q'] ?? '');
$fecha_desde = $_GET['desde'] ?? '';
$fecha_hasta = $_GET['hasta'] ?? '';
// New: filter by exact user id via dropdown
$f_user_id = isset($_GET['user_id']) ? (int)$_GET['user_id'] : 0;
$por_pagina = 50;
$offset = ($page - 1) * $por_pagina;

$mensaje = '';
$error = '';

// Handle POST: purge logs
if ($_SERVER['REQUEST_METHOD'] === 'POST' && validarCsrfToken($_POST['csrf_token'] ?? '')) {
    $accion = $_POST['accion'] ?? '';
    if ($accion === 'purgar') {
        $dias = max(1, (int)($_POST['dias'] ?? 90));
        $stmt = $pdo->prepare("DELETE FROM security_logs WHERE creado_en < NOW() - INTERVAL ? DAY");
        $stmt->execute([$dias]);
        $borrados = $stmt->rowCount();
        logSeguridadEvento('ADMIN_LOGS_PURGE', "Logs anteriores a {$dias} días purgados ({$borrados} registros)", $_SESSION['usuario_id']);
        $mensaje = "{$borrados} registro(s) anteriores a {$dias} días eliminados.";
    }
}

// Export CSV
if (isset($_GET['export']) && $_GET['export'] === 'csv') {
    $where_x = [];
    $params_x = [];
    if ($tipo_filtro) { $where_x[] = 'sl.evento_tipo = ?'; $params_x[] = $tipo_filtro; }
    if ($busqueda) { $where_x[] = '(sl.detalle LIKE ? OR u.nombre_usuario LIKE ?)'; $like = '%'.$busqueda.'%'; $params_x[] = $like; $params_x[] = $like; }
    if ($fecha_desde) { $where_x[] = 'sl.creado_en >= ?'; $params_x[] = $fecha_desde . ' 00:00:00'; }
    if ($fecha_hasta) { $where_x[] = 'sl.creado_en <= ?'; $params_x[] = $fecha_hasta . ' 23:59:59'; }
    $wsql = $where_x ? 'WHERE ' . implode(' AND ', $where_x) : '';
    $stmt = $pdo->prepare("SELECT sl.creado_en, sl.evento_tipo, u.nombre_usuario, sl.detalle, sl.ip FROM security_logs sl LEFT JOIN usuarios u ON sl.usuario_id = u.id $wsql ORDER BY sl.creado_en DESC");
    $stmt->execute($params_x);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename="logs_' . date('Y-m-d') . '.csv"');
    $out = fopen('php://output', 'w');
    fputcsv($out, ['Fecha','Tipo','Usuario','Detalle','IP']);
    foreach ($rows as $r) {
        fputcsv($out, [$r['creado_en'], $r['evento_tipo'], $r['nombre_usuario'] ?? '', $r['detalle'] ?? '', $r['ip'] ?? '']);
    }
    fclose($out);
    exit;
}

$where = [];
$params = [];

if ($tipo_filtro) {
    $where[] = 'sl.evento_tipo = ?';
    $params[] = $tipo_filtro;
}
if ($f_user_id > 0) {
    $where[] = 'sl.usuario_id = ?';
    $params[] = $f_user_id;
}
if ($busqueda) {
    $where[] = '(sl.detalle LIKE ? OR u.nombre_usuario LIKE ?)';
    $like = '%' . $busqueda . '%';
    $params[] = $like;
    $params[] = $like;
}
if ($fecha_desde) {
    $where[] = 'sl.creado_en >= ?';
    $params[] = $fecha_desde . ' 00:00:00';
}
if ($fecha_hasta) {
    $where[] = 'sl.creado_en <= ?';
    $params[] = $fecha_hasta . ' 23:59:59';
}
$where_sql = $where ? 'WHERE ' . implode(' AND ', $where) : '';

$stmt = $pdo->prepare("SELECT COUNT(*) FROM security_logs sl LEFT JOIN usuarios u ON sl.usuario_id = u.id $where_sql");
$stmt->execute($params);
$total = (int)$stmt->fetchColumn();
$paginas = max(1, ceil($total / $por_pagina));

$stmt = $pdo->prepare("SELECT sl.*, u.nombre_usuario FROM security_logs sl LEFT JOIN usuarios u ON sl.usuario_id = u.id $where_sql ORDER BY sl.creado_en DESC LIMIT $por_pagina OFFSET $offset");
$stmt->execute($params);
$logs = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Get distinct event types for filter dropdown
$tipos = $pdo->query("SELECT DISTINCT evento_tipo FROM security_logs ORDER BY evento_tipo")->fetchAll(PDO::FETCH_COLUMN);
// Get users list for user selector (only id and username)
$users_list = $pdo->query("SELECT id, nombre_usuario FROM usuarios ORDER BY nombre_usuario ASC")->fetchAll(PDO::FETCH_ASSOC);

$page_title = 'Logs de Seguridad | Admin | LC-ADVANCE';
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
    <a href="logs.php" class="active">Logs</a>
    <a href="settings.php">Config</a>
    <a href="backup.php">Respaldos</a>
    <a href="quizzes.php">Quizzes</a>
    <a href="progress.php">Progreso</a>
    <a href="announcements.php">Anuncios</a>
    <a href="activity.php">Actividad</a>
    <a href="streaks.php">Rachas</a>
    <a href="lessons.php">Lecciones</a>
    <a href="<?= htmlspecialchars(getDashboardUrl()) ?>">← Dashboard</a>
    <a href="<?= htmlspecialchars(appRootPath() . '/public/logout.php') ?>">🚪 Cerrar sesión</a>
  </nav>

  <main class="admin-main">
    <h1>Logs de Seguridad</h1>

    <?php if ($mensaje): ?><div class="admin-msg admin-msg-ok"><?= htmlspecialchars($mensaje) ?></div><?php endif; ?>
    <?php if ($error): ?><div class="admin-msg admin-msg-err"><?= htmlspecialchars($error) ?></div><?php endif; ?>

    <form method="get" class="admin-search" style="margin-bottom:12px;flex-wrap:wrap;align-items:center">
      <select name="tipo" class="admin-input" style="width:auto">
        <option value="">Todos los tipos</option>
        <?php foreach ($tipos as $t): ?>
        <option value="<?= htmlspecialchars($t) ?>" <?= $tipo_filtro === $t ? 'selected' : '' ?>><?= htmlspecialchars($t) ?></option>
        <?php endforeach; ?>
      </select>

      <!-- New: user selector -->
      <select name="user_id" class="admin-input" style="width:220px">
        <option value="">Todos los usuarios</option>
        <?php foreach ($users_list as $ul): ?>
          <option value="<?= (int)$ul['id'] ?>" <?= $f_user_id === (int)$ul['id'] ? 'selected' : '' ?>><?= htmlspecialchars($ul['nombre_usuario']) ?></option>
        <?php endforeach; ?>
      </select>

      <input type="text" name="q" placeholder="Buscar en detalle o usuario…" value="<?= htmlspecialchars($busqueda) ?>" class="admin-input" style="flex:1;max-width:300px">
      <label style="display:flex;align-items:center;gap:4px;font-size:0.72rem;color:var(--muted)">Desde <input type="date" name="desde" value="<?= htmlspecialchars($fecha_desde) ?>" class="admin-input" style="width:140px"></label>
      <label style="display:flex;align-items:center;gap:4px;font-size:0.72rem;color:var(--muted)">Hasta <input type="date" name="hasta" value="<?= htmlspecialchars($fecha_hasta) ?>" class="admin-input" style="width:140px"></label>
      <button type="submit" class="admin-btn">Filtrar</button>
      <?php if ($tipo_filtro || $busqueda || $fecha_desde || $fecha_hasta || $f_user_id): ?>
      <a href="logs.php" class="admin-btn admin-btn-ghost">✕ Limpiar</a>
      <?php endif; ?>
      <a href="?export=csv<?= $tipo_filtro ? '&tipo='.urlencode($tipo_filtro) : '' ?><?= $f_user_id ? '&user_id='.urlencode($f_user_id) : '' ?><?= $busqueda ? '&q='.urlencode($busqueda) : '' ?><?= $fecha_desde ? '&desde='.urlencode($fecha_desde) : '' ?><?= $fecha_hasta ? '&hasta='.urlencode($fecha_hasta) : '' ?>" class="admin-btn" style="margin-left:auto">📥 Exportar CSV</a>
    </form>

    <div class="admin-total"><?= $total ?> registros — página <?= $page ?> de <?= $paginas ?></div>

    <div style="overflow-x:auto">
      <table class="admin-table">
        <thead>
          <tr>
            <th>Fecha</th>
            <th>Tipo</th>
            <th>Usuario</th>
            <th>Detalle</th>
            <th>IP</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($logs as $l): ?>
          <tr class="log-row log-<?= htmlspecialchars(strtolower($l['evento_tipo'])) ?>" onclick="toggleDetail(<?= (int)$l['id'] ?>)">
            <td class="admin-cell-mono"><?= date('d/m/y H:i', strtotime($l['creado_en'])) ?></td>
            <td><span class="log-badge"><?= htmlspecialchars($l['evento_tipo']) ?></span></td>
            <td><a href="?user_id=<?= (int)$l['usuario_id'] ?>" style="color:inherit;text-decoration:none"><?= $l['nombre_usuario'] ? htmlspecialchars($l['nombre_usuario']) : '<span class="admin-muted">—</span>' ?></a></td>
            <td class="admin-cell-mono" style="max-width:400px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;cursor:pointer" title="Click para ver completo"><?= htmlspecialchars($l['detalle'] ?? '') ?></td>
            <td class="admin-cell-mono"><?= htmlspecialchars($l['ip'] ?? '') ?></td>
          </tr>
          <tr id="detail-<?= (int)$l['id'] ?>" style="display:none">
            <td colspan="5" style="padding:8px 12px;background:var(--surface2);border-bottom:1px solid var(--border);font-family:'JetBrains Mono',monospace;font-size:0.75rem;color:var(--text);word-break:break-all;line-height:1.5"><?= nl2br(htmlspecialchars($l['detalle'] ?? '')) ?></td>
          </tr>
          <?php endforeach; ?>
          <?php if (!$logs): ?><tr><td colspan="5" style="text-align:center;color:var(--muted);padding:24px">Sin registros.</td></tr><?php endif; ?>
        </tbody>
      </table>
    </div>

    <?php if ($paginas > 1): ?>
    <div class="admin-pages">
      <?php for ($i = 1; $i <= $paginas; $i++): ?>
        <a href="?p=<?= $i ?><?= $tipo_filtro ? '&tipo='.urlencode($tipo_filtro) : '' ?><?= $busqueda ? '&q='.urlencode($busqueda) : '' ?><?= $fecha_desde ? '&desde='.urlencode($fecha_desde) : '' ?><?= $fecha_hasta ? '&hasta='.urlencode($fecha_hasta) : '' ?>" class="admin-page <?= $i === $page ? 'active' : '' ?>"><?= $i ?></a>
      <?php endfor; ?>
    </div>
    <?php endif; ?>

    <!-- Purgar logs antiguos -->
    <details class="admin-section" style="margin-top:24px">
      <summary style="cursor:pointer;font-weight:600;font-size:0.82rem;color:var(--red);padding:8px 0;">🗑️ Purgar logs antiguos</summary>
      <form method="post" style="display:flex;gap:8px;align-items:center;margin-top:8px;" onsubmit="return confirm('¿Eliminar logs antiguos? Esta acción no se puede deshacer.')">
        <?= campoTokenCSRF() ?>
        <input type="hidden" name="accion" value="purgar">
        <label style="font-size:0.78rem;color:var(--muted)">Eliminar logs anteriores a
          <input type="number" name="dias" value="90" min="1" class="admin-input" style="width:70px"> días
        </label>
        <button type="submit" class="admin-btn admin-btn-sm admin-btn-danger">Purgar</button>
      </form>
    </details>
  </main>
</div>

<script>
function toggleDetail(id) {
  var row = document.getElementById('detail-' + id);
  if (row) row.style.display = row.style.display === 'none' ? 'table-row' : 'none';
}
</script>

<?php require __DIR__ . '/../../src/Templates/page_end.php'; ?>
