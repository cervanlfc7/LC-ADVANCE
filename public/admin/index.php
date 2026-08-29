<?php
require_once __DIR__ . '/../../src/Config/config.php';
require_once __DIR__ . '/../../src/Config/csrf.php';
require_once __DIR__ . '/../../src/Core/admin.php';
requireAdmin();

$stats = obtenerStatsAdmin($pdo);
$sys = obtenerSystemInfo();
$health = obtenerHealthChecks();

// Cache management
$cache_msg = '';
$cache_file = RUTA_CACHE();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && validarCsrfToken($_POST['csrf_token'] ?? '')) {
    if ($_POST['accion'] === 'clear_cache') {
        if (file_exists($cache_file)) {
            unlink($cache_file);
            logSeguridadEvento('ADMIN_CACHE_CLEAR', 'Caché de lecciones eliminado por admin', $_SESSION['usuario_id']);
            $cache_msg = '✅ Caché de lecciones limpiado correctamente.';
        } else {
            $cache_msg = '⚠️ El archivo de caché no existe.';
        }
    }
}

// Registrations per day (last 14 days)
$chart_data = [];
for ($i = 13; $i >= 0; $i--) {
    $day = date('Y-m-d', strtotime("-$i days"));
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM usuarios WHERE DATE(creado_en) = ?");
    $stmt->execute([$day]);
    $chart_data[] = [
        'label' => date('d/m', strtotime($day)),
        'count' => (int)$stmt->fetchColumn(),
    ];
}
$max_count = max(array_column($chart_data, 'count'));
$max_count = $max_count > 0 ? $max_count : 1;

// Cache status
$cache_exists = file_exists($cache_file);
$cache_size = $cache_exists ? filesize($cache_file) : 0;

$pass_rate = $stats['quizzes_totales'] > 0 ? round(100 * $stats['quizzes_aprobados'] / $stats['quizzes_totales'], 1) : 0;

$page_title = 'Admin Panel | LC-ADVANCE';
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
    <a href="index.php" class="active">Dashboard</a>
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
    <a href="<?= htmlspecialchars(getDashboardUrl()) ?>">← Dashboard</a>
    <a href="<?= htmlspecialchars(appRootPath() . '/public/logout.php') ?>">🚪 Cerrar sesión</a>
  </nav>

  <main class="admin-main">
    <h1>Panel de Administración</h1>

    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:12px">
      <div style="font-size:0.95rem;color:var(--muted)">Panel de estado</div>
      <div style="display:flex;gap:8px;align-items:center;flex-wrap:wrap">
        <label style="font-size:0.85rem;color:var(--muted);display:flex;gap:8px;align-items:center">
          <input id="admin-autorefresh" type="checkbox"> Auto-refresh
        </label>
        <button type="button" id="admin-refresh-now" class="admin-btn admin-btn-sm">Actualizar</button>
        <div id="admin-refresh-indicator" style="font-size:0.85rem;color:var(--muted)">Última actualización: <span id="admin-last-updated">—</span></div>
      </div>
    </div>

    <div class="admin-cards">
      <div class="admin-card">
        <div class="admin-card-icon">👥</div>
        <div class="admin-card-body">
          <div class="admin-card-value"><?= $stats['total_usuarios'] ?></div>
          <div class="admin-card-label">Usuarios totales</div>
          <div class="admin-card-sub">+<?= $stats['usuarios_hoy'] ?> hoy</div>
        </div>
      </div>
      <div class="admin-card">
        <div class="admin-card-icon">📚</div>
        <div class="admin-card-body">
          <div class="admin-card-value"><?= $stats['lecciones_completadas'] ?></div>
          <div class="admin-card-label">Lecciones completadas</div>
        </div>
      </div>
      <div class="admin-card">
        <div class="admin-card-icon">📊</div>
        <div class="admin-card-body">
          <div class="admin-card-value"><?= $stats['progresos_totales'] ?></div>
          <div class="admin-card-label">Progresos registrados</div>
        </div>
      </div>
      <div class="admin-card">
        <div class="admin-card-icon">✅</div>
        <div class="admin-card-body">
          <div class="admin-card-value"><?= $stats['verificados'] ?>/<?= $stats['total_usuarios'] ?></div>
          <div class="admin-card-label">Correos verificados</div>
        </div>
      </div>
      <div class="admin-card">
        <div class="admin-card-icon">🏆</div>
        <div class="admin-card-body">
          <div class="admin-card-value"><?= $stats['badges_otorgados'] ?></div>
          <div class="admin-card-label">Badges otorgados</div>
        </div>
      </div>
      <div class="admin-card">
        <div class="admin-card-icon">🔥</div>
        <div class="admin-card-body">
          <div class="admin-card-value"><?= $stats['activos_7d'] ?></div>
          <div class="admin-card-label">Activos (7 días)</div>
        </div>
      </div>
      <div class="admin-card">
        <div class="admin-card-icon">🧠</div>
        <div class="admin-card-body">
          <div class="admin-card-value"><?= $stats['quizzes_totales'] ?></div>
          <div class="admin-card-label">Quizzes realizados</div>
        </div>
      </div>
      <div class="admin-card">
        <div class="admin-card-icon">📈</div>
        <div class="admin-card-body">
          <div class="admin-card-value"><?= $stats['promedio_score'] ?></div>
          <div class="admin-card-label">Score promedio</div>
          <div class="admin-card-sub"><?= $pass_rate ?>% aprobación</div>
        </div>
      </div>
    </div>

    <div class="admin-grid-2">
      <div class="admin-section">
        <h2>Top Usuarios</h2>
        <table class="admin-table">
          <thead><tr><th>#</th><th>Usuario</th><th>Puntos</th><th>Nivel</th></tr></thead>
          <tbody>
            <?php $i=1; foreach ($stats['top_usuarios'] as $u): ?>
            <tr><td><?= $i++ ?></td><td><?= htmlspecialchars($u['nombre_usuario']) ?></td><td><?= (int)$u['puntos'] ?></td><td><?= (int)$u['nivel'] ?></td></tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>

      <div class="admin-section">
        <h2>Registros Recientes</h2>
        <table class="admin-table">
          <thead><tr><th>Usuario</th><th>Correo</th><th>Tipo</th><th>Fecha</th></tr></thead>
          <tbody>
            <?php foreach ($stats['registros_recientes'] as $u): ?>
            <tr>
              <td><?= htmlspecialchars($u['nombre_usuario']) ?></td>
              <td class="admin-cell-mono"><?= htmlspecialchars($u['correo']) ?></td>
              <td><span class="admin-role admin-role-<?= htmlspecialchars($u['tipo']) ?>"><?= htmlspecialchars($u['tipo']) ?></span></td>
              <td class="admin-cell-mono"><?= date('d/m/Y', strtotime($u['creado_en'])) ?></td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>

    <?php if ($cache_msg): ?><div class="admin-msg <?= str_starts_with($cache_msg, '✅') ? 'admin-msg-ok' : 'admin-msg-err' ?>"><?= htmlspecialchars($cache_msg) ?></div><?php endif; ?>

    <div class="admin-grid-2">
      <div class="admin-section">
        <h2>Registros por día (últimos 14 días)</h2>
        <div class="chart-bars">
          <?php foreach ($chart_data as $d): ?>
          <div class="chart-col">
            <div class="chart-bar" style="height:<?= round(100 * $d['count'] / $max_count) ?>%"></div>
            <div class="chart-label"><?= htmlspecialchars($d['label']) ?></div>
            <div class="chart-value"><?= $d['count'] ?></div>
          </div>
          <?php endforeach; ?>
        </div>
      </div>

      <div class="admin-section">
        <h2>Caché del Sistema</h2>
        <table class="admin-table admin-table-details">
          <tbody>
            <tr><td>Lecciones compiladas</td><td><?= $cache_exists ? '✅ Existe' : '❌ No existe' ?></td></tr>
            <tr><td>Tamaño</td><td><?= $cache_size > 0 ? round($cache_size / 1024, 1) . ' KB' : '—' ?></td></tr>
            <tr><td>Última compilación</td><td><?= $cache_exists ? date('d/m/Y H:i', filemtime($cache_file)) : '—' ?></td></tr>
          </tbody>
        </table>
        <form method="post" style="margin-top:12px" onsubmit="return confirm('¿Limpiar caché de lecciones? Se regenerará automáticamente.')">
          <?= campoTokenCSRF() ?>
          <input type="hidden" name="accion" value="clear_cache">
          <button type="submit" class="admin-btn">🗑️ Limpiar caché</button>
        </form>
      </div>
    </div>

    <div class="admin-section">
      <h2>Sistema</h2>
      <table class="admin-table admin-table-details">
        <tbody>
          <tr><td>PHP</td><td><?= htmlspecialchars($sys['php_version']) ?></td></tr>
          <tr><td>Servidor</td><td><?= htmlspecialchars($sys['server_software']) ?></td></tr>
          <tr><td>SAPI</td><td><?= htmlspecialchars($sys['sapi']) ?></td></tr>
          <tr><td>BD tamaño</td><td><?= $sys['db_size_mb'] ?> MB</td></tr>
          <tr><td>Tablas</td><td><?= $sys['db_tables'] ?></td></tr>
          <tr><td>Upload max</td><td><?= htmlspecialchars($sys['max_upload']) ?></td></tr>
          <tr><td>Post max</td><td><?= htmlspecialchars($sys['max_post']) ?></td></tr>
          <tr><td>Memory limit</td><td><?= htmlspecialchars($sys['memory_limit']) ?></td></tr>
          <tr><td>Max exec</td><td><?= htmlspecialchars($sys['max_execution']) ?>s</td></tr>
          <tr><td>Time zone</td><td><?= htmlspecialchars($sys['timezone']) ?></td></tr>
          <tr><td>Display errors</td><td><?= htmlspecialchars($sys['display_errors']) ?></td></tr>
          <tr><td>Fecha servidor</td><td><?= htmlspecialchars($sys['date']) ?></td></tr>
        </tbody>
      </table>
    </div>

    <div class="admin-section" style="margin-top:24px">
      <h2>Health Checks</h2>
      <table class="admin-table admin-table-details">
        <tbody>
          <?php
          $check_labels = [
            'ext_pdo_mysql' => 'PDO MySQL',
            'ext_mbstring' => 'MBString',
            'ext_json' => 'JSON',
            'ext_session' => 'Session',
            'ext_openssl' => 'OpenSSL',
            'ext_gd' => 'GD (imágenes)',
            'ext_fileinfo' => 'FileInfo',
            'cache_writable' => 'Caché escribible',
            'uploads_writable' => 'Uploads escribible',
            'allow_url_fopen' => 'allow_url_fopen',
            'file_uploads' => 'File uploads',
          ];
          ?>
          <?php foreach ($check_labels as $key => $label): ?>
          <tr>
            <td><?= htmlspecialchars($label) ?></td>
            <td><?php if (isset($health[$key])): ?><?php if (is_bool($health[$key])): ?><span style="color:<?= $health[$key] ? 'var(--green)' : 'var(--red)' ?>"><?= $health[$key] ? '✅' : '❌' ?></span><?php else: ?><?= htmlspecialchars($health[$key]) ?><?php endif; ?><?php else: ?><span style="color:var(--muted)">—</span><?php endif; ?></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </main>
</div>

<script>
(function(){
  const checkbox = document.getElementById('admin-autorefresh');
  const lastEl = document.getElementById('admin-last-updated');
  const indicator = document.getElementById('admin-refresh-indicator');
  let timer = null;

  function formatTime(ts){
    const d = new Date(ts);
    return d.toLocaleString();
  }

  function updateCards(data){
    try{
      document.querySelectorAll('.admin-card').forEach(card=>{
        const label = card.querySelector('.admin-card-label')?.textContent?.trim();
        if(!label) return;
        switch(label){
          case 'Usuarios totales': card.querySelector('.admin-card-value').textContent = data.total_usuarios; break;
          case 'Lecciones completadas': card.querySelector('.admin-card-value').textContent = data.lecciones_completadas; break;
          case 'Progresos registrados': card.querySelector('.admin-card-value').textContent = data.progresos_totales; break;
          case 'Correos verificados': card.querySelector('.admin-card-value').textContent = data.verificados + '/' + data.total_usuarios; break;
          case 'Badges otorgados': card.querySelector('.admin-card-value').textContent = data.badges_otorgados; break;
          case 'Activos (7 días)': card.querySelector('.admin-card-value').textContent = data.activos_7d; break;
          case 'Quizzes realizados': card.querySelector('.admin-card-value').textContent = data.quizzes_totales; break;
          case 'Score promedio': card.querySelector('.admin-card-value').textContent = data.promedio_score; card.querySelector('.admin-card-sub') && (card.querySelector('.admin-card-sub').textContent = data.pass_rate + '% aprobación'); break;
        }
      });
    }catch(e){console.error('updateCards',e)}
  }

  async function fetchStats(){
    try{
      indicator.style.opacity = 0.6;
      const res = await fetch('api_stats.php', {credentials:'same-origin'});
      if(!res.ok) throw new Error('HTTP '+res.status);
      const json = await res.json();
      updateCards(json);
      lastEl.textContent = formatTime(Date.now());
      indicator.style.opacity = 1;
    }catch(e){
      console.error('Error fetching stats',e);
      indicator.style.opacity = 1;
    }
  }

  function start(){
    fetchStats();
    timer = setInterval(fetchStats, 30000); // 30s
  }
  function stop(){ if(timer){ clearInterval(timer); timer = null; } }

  checkbox.addEventListener('change', function(){ if(this.checked) start(); else stop(); });
  document.getElementById('admin-refresh-now')?.addEventListener('click', function(){ fetchStats(); });
})();
</script>

<?php require __DIR__ . '/../../src/Templates/page_end.php'; ?>
