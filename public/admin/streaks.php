<?php
require_once __DIR__ . '/../../src/Config/config.php';
require_once __DIR__ . '/../../src/Config/csrf.php';
require_once __DIR__ . '/../../src/Core/admin.php';
requireAdmin();

$mensaje = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && validarTokenCSRF($_POST['csrf_token'] ?? '')) {
    $accion = $_POST['accion'] ?? '';
    $uid = (int)($_POST['usuario_id'] ?? 0);
    if ($uid <= 0) $error = 'Usuario inv&aacute;lido.';
    elseif ($accion === 'reset' && $uid) {
        $pdo->prepare("UPDATE usuarios SET racha_actual = 0, ultimo_login = DATE_SUB(CURDATE(), INTERVAL 2 DAY) WHERE id = ?")->execute([$uid]);
        logActividad('ADMIN_STREAK_RESET', "Racha reiniciada usuario #$uid", $_SESSION['usuario_id']);
        $mensaje = 'Racha reiniciada.';
    } elseif ($accion === 'set' && $uid) {
        $valor = max(0, (int)($_POST['racha'] ?? 0));
        $pdo->prepare("UPDATE usuarios SET racha_actual = ? WHERE id = ?")->execute([$valor, $uid]);
        logActividad('ADMIN_STREAK_SET', "Racha a $valor para usuario #$uid", $_SESSION['usuario_id']);
        $mensaje = "Racha actualizada a $valor d&iacute;as.";
    }
}

$tab      = $_GET['tab'] ?? 'activas';
$pagina   = max(1, (int)($_GET['p'] ?? 1));
$busqueda = trim($_GET['q'] ?? '');
$orden    = in_array($_GET['o'] ?? '', ['racha_actual', 'nombre_usuario', 'puntos', 'dias_sin_login']) ? $_GET['o'] : 'racha_actual';
$dir      = strtoupper($_GET['d'] ?? '') === 'ASC' ? 'ASC' : 'DESC';

$por_pagina = 30;
$offset = ($pagina - 1) * $por_pagina;

$where_base = "WHERE u.tipo = 'student'";
$params = [];

if ($tab === 'perdidas') {
    $where_base .= " AND u.racha_actual = 0 AND u.ultimo_login IS NOT NULL";
} else {
    $where_base .= " AND u.racha_actual > 0";
}

$where = $where_base;
if ($busqueda) {
    $where .= " AND (u.nombre_usuario LIKE ? OR u.correo LIKE ?)";
    $params[] = "%$busqueda%";
    $params[] = "%$busqueda%";
}

$total = $pdo->prepare("SELECT COUNT(*) FROM usuarios u $where");
$total->execute($params);
$total = (int)$total->fetchColumn();

$order_col = $orden === 'dias_sin_login' ? 'ultimo_login' : $orden;
$order_dir = $orden === 'dias_sin_login' ? 'ASC' : $dir;

$stmt = $pdo->prepare("SELECT u.id, u.nombre_usuario, u.correo, u.puntos, u.nivel, u.racha_actual, u.ultimo_login,
    u.protectores_racha,
    DATEDIFF(CURDATE(), u.ultimo_login) as dias_sin_login,
    (SELECT COUNT(*) FROM lecciones_completadas lc WHERE lc.usuario_id = u.id) as lecciones_hechas
    FROM usuarios u $where ORDER BY $order_col $order_dir LIMIT $por_pagina OFFSET $offset");
$stmt->execute($params);
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

$paginas_total = max(1, ceil($total / $por_pagina));

// stats
$top  = $pdo->query("SELECT MAX(racha_actual) FROM usuarios WHERE tipo='student'")->fetchColumn();
$avg  = $pdo->query("SELECT AVG(racha_actual) FROM usuarios WHERE tipo='student'")->fetchColumn();
$cnt  = $pdo->query("SELECT COUNT(*) FROM usuarios WHERE tipo='student' AND racha_actual > 0")->fetchColumn();
$perd = $pdo->query("SELECT COUNT(*) FROM usuarios WHERE tipo='student' AND racha_actual = 0 AND ultimo_login IS NOT NULL")->fetchColumn();

$page_title = 'Rachas | Admin | LC-ADVANCE';
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
    <a href="activity.php">Actividad</a>
    <a href="streaks.php" class="active">Rachas</a>
    <a href="lessons.php">Lecciones</a>
    <a href="<?= htmlspecialchars(getDashboardUrl()) ?>">&larr; Dashboard</a>
    <a href="<?= htmlspecialchars($r . '/public/logout.php') ?>">🚪 Cerrar sesi&oacute;n</a>
  </nav>
  <main class="admin-main">
    <h1>Gesti&oacute;n de Rachas</h1>
    <?php if ($mensaje): ?><div class="admin-msg admin-msg-ok"><?= $mensaje ?></div><?php endif; ?>
    <?php if ($error): ?><div class="admin-msg admin-msg-err"><?= htmlspecialchars($error) ?></div><?php endif; ?>

    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(130px,1fr));gap:10px;margin-bottom:20px">
      <div class="admin-card" style="text-align:center;padding:14px 10px">
        <div style="font-size:24px;font-weight:700;color:var(--yellow)"><?= (int)$top ?></div>
        <div style="font-size:11px;color:var(--muted)">Racha m&aacute;xima</div>
      </div>
      <div class="admin-card" style="text-align:center;padding:14px 10px">
        <div style="font-size:24px;font-weight:700;color:var(--cyan)"><?= round((float)$avg, 1) ?></div>
        <div style="font-size:11px;color:var(--muted)">Promedio</div>
      </div>
      <div class="admin-card" style="text-align:center;padding:14px 10px">
        <div style="font-size:24px;font-weight:700;color:var(--green)"><?= (int)$cnt ?></div>
        <div style="font-size:11px;color:var(--muted)">Activas</div>
      </div>
      <div class="admin-card" style="text-align:center;padding:14px 10px">
        <div style="font-size:24px;font-weight:700;color:var(--red)"><?= (int)$perd ?></div>
        <div style="font-size:11px;color:var(--muted)">Perdidas</div>
      </div>
      <div class="admin-card" style="text-align:center;padding:14px 10px">
        <div style="font-size:24px;font-weight:700;color:var(--pink)"><?= (int)$cnt + (int)$perd ?></div>
        <div style="font-size:11px;color:var(--muted)">Total estudiantes</div>
      </div>
    </div>

    <!-- Tabs -->
    <div style="display:flex;gap:0;margin-bottom:16px;border-bottom:1px solid var(--border)">
      <a href="?tab=activas<?= $busqueda?'&q='.urlencode($busqueda):'' ?>" style="padding:8px 18px;font-size:13px;font-weight:600;text-decoration:none;color:<?= $tab==='activas'?'var(--cyan)':'var(--muted)' ?>;border-bottom:2px solid <?= $tab==='activas'?'var(--cyan)':'transparent' ?>;transition:all .15s">🔥 Activas (<?= (int)$cnt ?>)</a>
      <a href="?tab=perdidas<?= $busqueda?'&q='.urlencode($busqueda):'' ?>" style="padding:8px 18px;font-size:13px;font-weight:600;text-decoration:none;color:<?= $tab==='perdidas'?'var(--red)':'var(--muted)' ?>;border-bottom:2px solid <?= $tab==='perdidas'?'var(--red)':'transparent' ?>;transition:all .15s">💔 Perdidas (<?= (int)$perd ?>)</a>
    </div>

    <form method="get" class="admin-search" style="display:flex;gap:8px;align-items:center;flex-wrap:wrap;margin-bottom:14px">
      <input type="hidden" name="tab" value="<?= $tab ?>">
      <input type="text" name="q" placeholder="Buscar estudiante&hellip;" value="<?= htmlspecialchars($busqueda) ?>" class="admin-input" style="flex:1;max-width:260px">
      <button type="submit" class="admin-btn" style="background:var(--cyan);border-color:var(--cyan);color:#041420">Buscar</button>
      <?php if ($busqueda): ?><a href="streaks.php?tab=<?= $tab ?>" class="admin-btn admin-btn-ghost">✕ Limpiar</a><?php endif; ?>
    </form>

    <div style="margin-bottom:10px;font-size:12px;color:var(--muted)"><?= $total ?> estudiante(s) &mdash; p&aacute;gina <?= $pagina ?> de <?= $paginas_total ?></div>

    <?php if ($usuarios): ?>
    <div style="overflow-x:auto">
      <table class="admin-table">
        <thead>
          <tr>
            <th><a href="?tab=<?= $tab ?>&o=nombre_usuario&d=<?= $orden==='nombre_usuario'&&$dir==='DESC'?'ASC':'DESC' ?><?= $busqueda?'&q='.urlencode($busqueda):'' ?>" class="admin-sort">Usuario <?= $orden==='nombre_usuario' ? ($dir==='DESC'?'▼':'▲') : '' ?></a></th>
            <?php if ($tab === 'perdidas'): ?>
            <th><a href="?tab=<?= $tab ?>&o=dias_sin_login&d=<?= $orden==='dias_sin_login'&&$dir==='ASC'?'DESC':'ASC' ?><?= $busqueda?'&q='.urlencode($busqueda):'' ?>" class="admin-sort">Sin login <?= $orden==='dias_sin_login' ? ($dir==='ASC'?'▼':'▲') : '' ?></a></th>
            <?php else: ?>
            <th><a href="?tab=<?= $tab ?>&o=racha_actual&d=<?= $orden==='racha_actual'&&$dir==='DESC'?'ASC':'DESC' ?><?= $busqueda?'&q='.urlencode($busqueda):'' ?>" class="admin-sort">Racha <?= $orden==='racha_actual' ? ($dir==='DESC'?'▼':'▲') : '' ?></a></th>
            <?php endif; ?>
            <th><a href="?tab=<?= $tab ?>&o=puntos&d=<?= $orden==='puntos'&&$dir==='DESC'?'ASC':'DESC' ?><?= $busqueda?'&q='.urlencode($busqueda):'' ?>" class="admin-sort">Puntos <?= $orden==='puntos' ? ($dir==='DESC'?'▼':'▲') : '' ?></a></th>
            <th>Nivel</th>
            <th>Lecciones</th>
            <th>&Uacute;ltimo login</th>
            <th style="width:100px;text-align:center">🛡️</th>
            <th style="width:200px">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($usuarios as $u): $prot = (int)$u['protectores_racha']; ?>
          <tr>
            <td><strong><?= htmlspecialchars($u['nombre_usuario']) ?></strong></td>
            <?php if ($tab === 'perdidas'): ?>
            <td><span style="font-weight:700;color:var(--red)">💔 <?= (int)$u['dias_sin_login'] ?> d&iacute;a(s)</span></td>
            <?php else: ?>
            <td><span style="font-weight:700;color:<?= $u['racha_actual'] >= 30 ? 'var(--yellow)' : ($u['racha_actual'] >= 7 ? 'var(--cyan)' : 'var(--text)') ?>">🔥 <?= (int)$u['racha_actual'] ?> d&iacute;as</span></td>
            <?php endif; ?>
            <td><?= (int)$u['puntos'] ?></td>
            <td><?= (int)$u['nivel'] ?></td>
            <td><?= (int)$u['lecciones_hechas'] ?></td>
            <td class="admin-cell-mono"><?= $u['ultimo_login'] ? htmlspecialchars($u['ultimo_login']) : '&mdash;' ?></td>
            <td style="text-align:center"><span style="font-size:15px;font-weight:700;color:<?= $prot > 0 ? 'var(--cyan)' : 'var(--muted)' ?>"><?= $prot ?></span></td>
            <td>
              <button class="admin-btn admin-btn-sm" onclick="abrirDetalles(<?= $u['id'] ?>, '<?= htmlspecialchars($u['nombre_usuario'], ENT_QUOTES) ?>')">🔍</button>
              <button class="admin-btn admin-btn-sm admin-btn-warn" onclick="confirmReset(<?= $u['id'] ?>, '<?= htmlspecialchars($u['nombre_usuario'], ENT_QUOTES) ?>')">🔄 Reset</button>
              <button class="admin-btn admin-btn-sm" onclick="abrirSet(<?= $u['id'] ?>, '<?= htmlspecialchars($u['nombre_usuario'], ENT_QUOTES) ?>', <?= (int)$u['racha_actual'] ?>)">✏️ Set</button>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

    <?php if ($paginas_total > 1): ?>
    <div class="admin-pages" style="margin-top:16px">
      <?php if ($pagina > 1): ?>
      <a href="?tab=<?= $tab ?>&p=<?= $pagina - 1 ?><?= $busqueda ? '&q='.urlencode($busqueda) : '' ?>" class="admin-btn admin-btn-sm">&laquo; Anterior</a>
      <?php endif; ?>
      <?php for ($i = 1; $i <= $paginas_total; $i++): ?>
      <a href="?tab=<?= $tab ?>&p=<?= $i ?><?= $busqueda ? '&q='.urlencode($busqueda) : '' ?>" class="admin-page <?= $i === $pagina ? 'active' : '' ?>"><?= $i ?></a>
      <?php endfor; ?>
      <?php if ($pagina < $paginas_total): ?>
      <a href="?tab=<?= $tab ?>&p=<?= $pagina + 1 ?><?= $busqueda ? '&q='.urlencode($busqueda) : '' ?>" class="admin-btn admin-btn-sm">Siguiente &raquo;</a>
      <?php endif; ?>
    </div>
    <?php endif; ?>

    <?php else: ?>
    <div class="admin-empty">
      <div style="font-size:48px;margin-bottom:8px"><?= $tab === 'perdidas' ? '💔' : '🔥' ?></div>
      <p><?= $tab === 'perdidas' ? 'No hay estudiantes con rachas perdidas.' : 'No hay estudiantes con rachas activas.' ?></p>
    </div>
    <?php endif; ?>
  </main>
</div>

<!-- Confirmaci&oacute;n reset -->
<div id="confirmModal" class="admin-modal-overlay" style="display:none" onclick="if(event.target===this)cerrarConfirm()">
  <div class="admin-modal" style="max-width:380px;text-align:center">
    <div style="font-size:48px;margin-bottom:4px">🔄</div>
    <h3 id="confirmTitle" style="color:var(--text);margin:0 0 6px 0;font-size:17px"></h3>
    <p id="confirmMsg" style="color:var(--muted);margin:0 0 20px 0;font-size:13px"></p>
    <div style="display:flex;gap:12px;justify-content:center">
      <button class="admin-btn admin-btn-ghost" onclick="cerrarConfirm()">Cancelar</button>
      <button class="admin-btn" id="confirmBtn" style="background:var(--yellow);border-color:var(--yellow);color:#041420" onclick="ejecutarConfirm()">Confirmar</button>
    </div>
  </div>
</div>

<!-- Modal Set -->
<div id="setModal" class="admin-modal-overlay" style="display:none" onclick="if(event.target===this)cerrarSet()">
  <div class="admin-modal" style="max-width:360px">
    <div class="admin-modal-header">
      <h3 id="setModalTitle">✏️ Ajustar racha</h3>
      <button class="admin-btn admin-btn-sm admin-btn-ghost" onclick="cerrarSet()" style="font-size:18px;padding:0 8px">✕</button>
    </div>
    <form method="post" id="setForm">
      <?= campoTokenCSRF() ?>
      <input type="hidden" name="accion" value="set">
      <input type="hidden" name="usuario_id" id="setUserId" value="">
      <div class="admin-field">
        <label id="setUserLabel">Usuario</label>
        <div style="font-weight:600;color:var(--text);padding:6px 0" id="setUserName"></div>
      </div>
      <div class="admin-field">
        <label for="setRacha">Racha (d&iacute;as)</label>
        <input type="number" id="setRacha" name="racha" min="0" max="999" class="admin-input" required>
      </div>
      <div class="admin-modal-footer" style="display:flex;gap:8px;justify-content:flex-end;margin-top:16px">
        <button type="button" class="admin-btn admin-btn-ghost" onclick="cerrarSet()">Cancelar</button>
        <button type="button" class="admin-btn" style="background:var(--cyan);border-color:var(--cyan);color:#041420" onclick="confirmSet()">💾 Guardar</button>
      </div>
    </form>
  </div>
</div>

<!-- Modal detalles -->
<div id="detModal" class="admin-modal-overlay" style="display:none" onclick="if(event.target===this)cerrarDet()">
  <div class="admin-modal" style="max-width:600px">
    <div class="admin-modal-header">
      <h3 id="detTitle">🔍 Detalles</h3>
      <button class="admin-btn admin-btn-sm admin-btn-ghost" onclick="cerrarDet()" style="font-size:18px;padding:0 8px">✕</button>
    </div>
    <div id="detBody" style="max-height:420px;overflow-y:auto">
      <div style="text-align:center;padding:20px;color:var(--muted)">Cargando…</div>
    </div>
  </div>
</div>

<script>
var _confirmCb = null;

function cerrarDet() { document.getElementById('detModal').style.display = 'none'; }

function abrirDetalles(uid, nombre) {
    document.getElementById('detTitle').textContent = '🔍 ' + nombre;
    document.getElementById('detBody').innerHTML = '<div style="text-align:center;padding:20px;color:var(--muted)">Cargando…</div>';
    document.getElementById('detModal').style.display = 'flex';

    fetch('<?= $r ?>/public/admin/api_user_progress.php?uid=' + uid)
        .then(function(r) { return r.json(); })
        .then(function(d) {
            if (d.error) { document.getElementById('detBody').innerHTML = '<div style="text-align:center;padding:20px;color:var(--red)">' + d.error + '</div>'; return; }

            var u = d.usuario;
            var stats = d.stats;
            var totalXP = 0;
            var rows = '';
            (d.progreso || []).forEach(function(p) {
                var xp = parseInt(p.lesson_xp) || 0;
                totalXP += xp;
                var icon = p.completed == '1' ? '✅' : '👁️';
                rows += '<tr><td class="admin-cell-mono">' + p.leccion_slug + '</td><td>' + icon + '</td><td>' + (p.score || '—') + '</td><td style="text-align:right">' + xp + '</td></tr>';
            });

            document.getElementById('detBody').innerHTML =
                '<div style="display:grid;grid-template-columns:1fr 1fr;gap:10px;margin-bottom:16px">' +
                    '<div class="admin-card" style="text-align:center;padding:10px;background:var(--surface)"><div style="font-size:18px;font-weight:700;color:var(--cyan)">' + u.puntos + '</div><div style="font-size:10px;color:var(--muted)">Puntos</div></div>' +
                    '<div class="admin-card" style="text-align:center;padding:10px;background:var(--surface)"><div style="font-size:18px;font-weight:700;color:var(--green)">' + totalXP + '</div><div style="font-size:10px;color:var(--muted)">XP lecciones</div></div>' +
                    '<div class="admin-card" style="text-align:center;padding:10px;background:var(--surface)"><div style="font-size:18px;font-weight:700;color:var(--yellow)">🔥 ' + u.racha_actual + '</div><div style="font-size:10px;color:var(--muted)">Racha</div></div>' +
                    '<div class="admin-card" style="text-align:center;padding:10px;background:var(--surface)"><div style="font-size:18px;font-weight:700;color:var(--cyan)">🛡️ ' + (u.protectores_racha || 0) + '</div><div style="font-size:10px;color:var(--muted)">Protectores</div></div>' +
                    '<div class="admin-card" style="text-align:center;padding:10px;background:var(--surface)"><div style="font-size:18px;font-weight:700;color:var(--pink)">' + u.nivel + '</div><div style="font-size:10px;color:var(--muted)">Nivel</div></div>' +
                    '<div class="admin-card" style="text-align:center;padding:10px;background:var(--surface)"><div style="font-size:18px;font-weight:700;color:var(--green)">' + stats.lecciones_completadas + '/' + stats.lecciones_visitadas + '</div><div style="font-size:10px;color:var(--muted)">Lecciones</div></div>' +
                '</div>' +
                '<div class="admin-section" style="padding:0"><h4 style="font-size:13px;margin:0 0 8px 0;color:var(--cyan)">📚 Progreso por lecci&oacute;n</h4></div>' +
                '<div style="overflow-x:auto"><table class="admin-table" style="font-size:12px"><thead><tr><th>Lecci&oacute;n</th><th>Estado</th><th>Score</th><th style="text-align:right">XP</th></tr></thead><tbody>' + rows + '</tbody></table></div>' +
                (d.badges && d.badges.length ? '<div style="margin-top:12px"><h4 style="font-size:13px;margin:0 0 8px 0;color:var(--yellow)">🏅 Logros (' + d.badges.length + ')</h4><div style="display:flex;flex-wrap:wrap;gap:6px">' + d.badges.map(function(b) { return '<span style="padding:3px 10px;border-radius:20px;font-size:11px;background:var(--yellow)15;border:1px solid var(--yellow)35;color:var(--yellow)">' + b.icono + ' ' + b.nombre + '</span>'; }).join('') + '</div></div>' : '');
        })
        .catch(function() {
            document.getElementById('detBody').innerHTML = '<div style="text-align:center;padding:20px;color:var(--red)">Error al cargar datos.</div>';
        });
}

function mostrarConfirm(title, msg, cb) {
    document.getElementById('confirmTitle').textContent = title;
    document.getElementById('confirmMsg').textContent = msg;
    _confirmCb = cb;
    document.getElementById('confirmModal').style.display = 'flex';
}
function cerrarConfirm() { document.getElementById('confirmModal').style.display = 'none'; _confirmCb = null; }
function ejecutarConfirm() { var cb = _confirmCb; cerrarConfirm(); if (cb) cb(); }

function confirmReset(id, nombre) {
    mostrarConfirm('Reiniciar racha',
        '¿Reiniciar la racha de <strong>' + nombre + '</strong> a 0?',
        function() {
            var f = document.createElement('form');
            f.method = 'post';
            f.innerHTML = '<?= campoTokenCSRF() ?><input type="hidden" name="accion" value="reset"><input type="hidden" name="usuario_id" value="' + id + '">';
            document.body.appendChild(f);
            f.submit();
        }
    );
}

function abrirSet(id, nombre, racha) {
    document.getElementById('setUserId').value = id;
    document.getElementById('setUserName').textContent = nombre;
    document.getElementById('setRacha').value = racha;
    document.getElementById('setModal').style.display = 'flex';
    document.getElementById('setRacha').focus();
}
function cerrarSet() { document.getElementById('setModal').style.display = 'none'; }

function confirmSet() {
    var nombre = document.getElementById('setUserName').textContent;
    var val = document.getElementById('setRacha').value;
    mostrarConfirm('Ajustar racha',
        '¿Establecer racha de <strong>' + nombre + '</strong> a <strong>' + val + '</strong> d&iacute;as?',
        function() { document.getElementById('setForm').submit(); }
    );
}

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') { cerrarConfirm(); cerrarSet(); }
});
</script>

<?php require __DIR__ . '/../../src/Templates/page_end.php'; ?>
