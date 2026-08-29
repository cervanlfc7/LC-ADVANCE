<?php
require_once __DIR__ . '/../../src/Config/config.php';
require_once __DIR__ . '/../../src/Config/csrf.php';
require_once __DIR__ . '/../../src/Core/admin.php';
requireAdmin();

$mensaje = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && validarTokenCSRF($_POST['csrf_token'] ?? '')) {
    if (($_POST['accion'] ?? '') === 'clear_cache') {
        if (limpiarCachéLecciones($pdo)) $mensaje = 'Cach&eacute; limpiada.';
        else $error = 'El archivo de cach&eacute; no existe.';
    }
}

$lecciones = obtenerLecciones();
$materias  = obtenerMaterias();
$total_lees = count($lecciones);

$stats_materia = [];
foreach ($materias as $m) {
    $c = 0;
    foreach ($lecciones as $l) { if (($l['materia'] ?? '') === $m) $c++; }
    $stats_materia[$m] = $c;
}

$completados = [];
try {
    $stmt = $pdo->query("SELECT slug, COUNT(*) as c FROM user_progress WHERE completed = 1 GROUP BY slug");
    if ($stmt) { while ($r = $stmt->fetch(PDO::FETCH_ASSOC)) $completados[$r['slug']] = (int)$r['c']; }
} catch (PDOException $e) {}

$total_students = 0;
try { $total_students = (int)$pdo->query("SELECT COUNT(*) FROM usuarios WHERE tipo = 'student'")->fetchColumn(); } catch (Exception $e) {}

$page_title = 'Lecciones | Admin | LC-ADVANCE';
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
    <a href="streaks.php">Rachas</a>
    <a href="lessons.php" class="active">Lecciones</a>
    <a href="<?= htmlspecialchars(getDashboardUrl()) ?>">&larr; Dashboard</a>
    <a href="<?= htmlspecialchars($r . '/public/logout.php') ?>">🚪 Cerrar sesi&oacute;n</a>
  </nav>
  <main class="admin-main">
    <h1>Gesti&oacute;n de Contenido</h1>
    <?php if ($mensaje): ?><div class="admin-msg admin-msg-ok"><?= $mensaje ?></div><?php endif; ?>
    <?php if ($error): ?><div class="admin-msg admin-msg-err"><?= htmlspecialchars($error) ?></div><?php endif; ?>

    <div style="display:flex;gap:10px;align-items:center;margin-bottom:20px">
      <div class="admin-card" style="text-align:center;padding:12px 24px">
        <div style="font-size:26px;font-weight:700;color:var(--cyan)"><?= $total_lees ?></div>
        <div style="font-size:11px;color:var(--muted)">Total lecciones</div>
      </div>
      <div style="flex:1"></div>
      <button class="admin-btn admin-btn-warn" onclick="confirmClearCache()">🗑️ Limpiar cach&eacute;</button>
    </div>

    <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(180px,1fr));gap:10px;margin-bottom:24px">
      <?php foreach ($stats_materia as $m => $c): $safe = htmlspecialchars($m, ENT_QUOTES); ?>
      <div class="admin-card" style="cursor:pointer;text-align:center;padding:14px 10px;transition:all .15s" onclick="toggleMateria('<?= $safe ?>')" title="Ver lecciones de <?= $safe ?>">
        <div style="font-size:20px;font-weight:700;color:var(--green)"><?= $c ?></div>
        <div style="font-size:11px;color:var(--muted)"><?= $safe ?></div>
      </div>
      <?php endforeach; ?>
    </div>

    <div id="leccionesContainer">
      <?php foreach ($materias as $m): $slugs = obtenerSlugsPorMateria($m); if (!$slugs) continue; $mid = 'mat_' . preg_replace('/[^a-z0-9]/i', '_', $m); ?>
      <div class="materia-group" data-materia="<?= htmlspecialchars($m, ENT_QUOTES) ?>" style="margin-bottom:16px;display:none">
        <div style="display:flex;align-items:center;justify-content:space-between;padding:8px 12px;background:var(--surface);border:1px solid var(--border);border-radius:8px;margin-bottom:8px">
          <span style="font-weight:600;color:var(--cyan);font-size:14px">📂 <?= htmlspecialchars($m) ?> (<?= count($slugs) ?>)</span>
          <button class="admin-btn admin-btn-sm admin-btn-ghost" onclick="this.closest('.materia-group').style.display='none'">✕</button>
        </div>
        <div style="overflow-x:auto">
          <table class="admin-table">
            <thead><tr><th style="width:90px">Slug</th><th>T&iacute;tulo</th><th style="width:60px">Quiz</th><th style="width:120px">Completados</th><th style="width:60px">Ver</th></tr></thead>
            <tbody>
              <?php foreach ($lecciones as $l): if (($l['materia'] ?? '') !== $m) continue; $comp = $completados[$l['slug'] ?? ''] ?? 0; ?>
              <tr>
                <td class="admin-cell-mono" style="font-size:11px"><?= htmlspecialchars($l['slug'] ?? '') ?></td>
                <td><strong><?= htmlspecialchars($l['titulo'] ?? '') ?></strong></td>
                <td><?= !empty($l['quiz']) ? '<span style="color:var(--green)">✅ ' . count($l['quiz']) . '</span>' : '<span style="color:var(--muted)">—</span>' ?></td>
                <td>
                  <div style="display:flex;align-items:center;gap:6px">
                    <span style="font-weight:600;color:<?= $comp > 0 ? 'var(--cyan)' : 'var(--muted)' ?>"><?= $comp ?></span>
                    <?php if ($total_students > 0): $pct = round(($comp / $total_students) * 100); ?>
                    <div style="flex:1;max-width:50px;height:4px;background:var(--border);border-radius:4px;overflow:hidden">
                      <div style="height:100%;width:<?= $pct ?>%;background:<?= $pct > 50 ? 'var(--green)' : 'var(--cyan)' ?>;border-radius:4px"></div>
                    </div>
                    <span style="font-size:10px;color:var(--muted)"><?= $pct ?>%</span>
                    <?php endif; ?>
                  </div>
                </td>
                <td><a href="<?= $r ?>/public/admin/lesson_view.php?slug=<?= urlencode($l['slug'] ?? '') ?>" target="_blank" class="admin-btn admin-btn-sm">👁️</a></td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
      <?php endforeach; ?>
    </div>

    <?php if (!$lecciones): ?>
    <div class="admin-empty" style="margin-top:20px">
      <div style="font-size:48px;margin-bottom:8px">📚</div>
      <p>No hay lecciones cargadas.</p>
    </div>
    <?php endif; ?>
  </main>
</div>

<!-- Confirmaci&oacute;n -->
<div id="confirmModal" class="admin-modal-overlay" style="display:none" onclick="if(event.target===this)cerrarConfirm()">
  <div class="admin-modal" style="max-width:380px;text-align:center">
    <div style="font-size:48px;margin-bottom:4px">🗑️</div>
    <h3 style="color:var(--text);margin:0 0 6px 0;font-size:17px">Limpiar cach&eacute;</h3>
    <p style="color:var(--muted);margin:0 0 20px 0;font-size:13px">Se eliminar&aacute; el archivo de cach&eacute; de lecciones. Se regenerar&aacute; autom&aacute;ticamente.</p>
    <div style="display:flex;gap:12px;justify-content:center">
      <button class="admin-btn admin-btn-ghost" onclick="cerrarConfirm()">Cancelar</button>
      <button class="admin-btn" style="background:var(--yellow);border-color:var(--yellow);color:#041420" onclick="ejecutarConfirm()">Limpiar</button>
    </div>
  </div>
</div>

<script>
var _confirmCb = null;

function mostrarConfirm(cb) { _confirmCb = cb; document.getElementById('confirmModal').style.display = 'flex'; }
function cerrarConfirm() { document.getElementById('confirmModal').style.display = 'none'; _confirmCb = null; }
function ejecutarConfirm() { var cb = _confirmCb; cerrarConfirm(); if (cb) cb(); }

function confirmClearCache() {
    mostrarConfirm(function() {
        var f = document.createElement('form');
        f.method = 'post';
        f.innerHTML = '<?= campoTokenCSRF() ?><input type="hidden" name="accion" value="clear_cache">';
        document.body.appendChild(f);
        f.submit();
    });
}

function toggleMateria(nombre) {
    var groups = document.querySelectorAll('.materia-group');
    groups.forEach(function(g) {
        g.style.display = g.dataset.materia === nombre ? 'block' : 'none';
    });
}

document.addEventListener('keydown', function(e) { if (e.key === 'Escape') cerrarConfirm(); });
</script>

<?php require __DIR__ . '/../../src/Templates/page_end.php'; ?>
