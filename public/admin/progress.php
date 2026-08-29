<?php
require_once __DIR__ . '/../../src/Config/config.php';
require_once __DIR__ . '/../../src/Config/csrf.php';
require_once __DIR__ . '/../../src/Core/admin.php';
requireAdmin();

$materias = obtenerMaterias();
$stats_materias = [];
foreach ($materias as $m) {
    $slugs = obtenerSlugsPorMateria($m);
    if (!$slugs) continue;
    $placeholders = implode(',', array_fill(0, count($slugs), '?'));
    $total = $pdo->prepare("SELECT COUNT(DISTINCT up.user_id) FROM user_progress up WHERE up.slug IN ($placeholders) AND up.completed = 1");
    $total->execute($slugs);
    $total_est = (int)$total->fetchColumn();
    $total_lec = count($slugs);
    $completions = $pdo->prepare("SELECT COUNT(*) FROM user_progress up WHERE up.slug IN ($placeholders) AND up.completed = 1");
    $completions->execute($slugs);
    $stats_materias[$m] = [
        'estudiantes' => $total_est,
        'lecciones'   => $total_lec,
        'completions' => (int)$completions->fetchColumn(),
    ];
}

$top = $pdo->query("SELECT u.id, u.nombre_usuario, u.puntos, u.nivel,
    COUNT(up.id) AS quizzes_hechos, ROUND(AVG(up.score), 1) AS avg_score
    FROM usuarios u
    LEFT JOIN user_progress up ON up.user_id = u.id AND up.score IS NOT NULL
    WHERE u.tipo = 'student'
    GROUP BY u.id
    ORDER BY u.puntos DESC LIMIT 20")->fetchAll(PDO::FETCH_ASSOC);

$daily = $pdo->query("SELECT DATE(creado_en) as fecha, COUNT(*) as count FROM security_logs
    WHERE creado_en >= DATE_SUB(CURDATE(), INTERVAL 30 DAY)
    AND evento_tipo IN ('LESSON_COMPLETE', 'QUIZ_COMPLETE')
    GROUP BY DATE(creado_en) ORDER BY fecha")->fetchAll(PDO::FETCH_ASSOC);

$max_daily = 1;
$daily_map = [];
foreach ($daily as $d) {
    $daily_map[$d['fecha']] = (int)$d['count'];
    $max_daily = max($max_daily, (int)$d['count']);
}

$total_students  = (int)$pdo->query("SELECT COUNT(*) FROM usuarios WHERE tipo='student'")->fetchColumn();
$total_completions = (int)$pdo->query("SELECT COUNT(*) FROM user_progress WHERE completed=1")->fetchColumn();
$total_quizzes   = (int)$pdo->query("SELECT COUNT(*) FROM user_progress WHERE score IS NOT NULL")->fetchColumn();
$promedio_global = $pdo->query("SELECT ROUND(AVG(score),1) FROM user_progress WHERE score IS NOT NULL")->fetchColumn();

$medals = ['🥇', '🥈', '🥉'];

$page_title = 'Progreso Global | Admin | LC-ADVANCE';
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
    <a href="progress.php" class="active">Progreso</a>
    <a href="announcements.php">Anuncios</a>
    <a href="activity.php">Actividad</a>
    <a href="streaks.php">Rachas</a>
    <a href="lessons.php">Lecciones</a>
    <a href="<?= htmlspecialchars(getDashboardUrl()) ?>">← Dashboard</a>
    <a href="<?= htmlspecialchars($r . '/public/logout.php') ?>">🚪 Cerrar sesi&oacute;n</a>
  </nav>
  <main class="admin-main">
    <h1>Progreso Global</h1>

    <div class="admin-cards">
      <div class="admin-card">
        <div class="admin-card-icon">👥</div>
        <div class="admin-card-body">
          <div class="admin-card-value"><?= $total_students ?></div>
          <div class="admin-card-label">Estudiantes</div>
        </div>
      </div>
      <div class="admin-card">
        <div class="admin-card-icon">📚</div>
        <div class="admin-card-body">
          <div class="admin-card-value"><?= $total_completions ?></div>
          <div class="admin-card-label">Lecciones completadas</div>
        </div>
      </div>
      <div class="admin-card">
        <div class="admin-card-icon">📊</div>
        <div class="admin-card-body">
          <div class="admin-card-value"><?= $total_quizzes ?></div>
          <div class="admin-card-label">Quizzes resueltos</div>
        </div>
      </div>
      <div class="admin-card">
        <div class="admin-card-icon">📈</div>
        <div class="admin-card-body">
          <div class="admin-card-value"><?= $promedio_global ?: '—' ?>%</div>
          <div class="admin-card-label">Promedio global</div>
        </div>
      </div>
    </div>

    <div class="admin-cards">
      <?php foreach ($stats_materias as $mat => $s): ?>
      <div class="admin-card">
        <div class="admin-card-icon">📖</div>
        <div class="admin-card-body">
          <div class="admin-card-value"><?= $s['completions'] ?></div>
          <div class="admin-card-label"><?= htmlspecialchars(ucfirst(str_replace('_', ' ', $mat))) ?></div>
          <div class="admin-card-sub"><?= $s['estudiantes'] ?> est / <?= $s['lecciones'] ?> lec</div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>

    <div class="admin-grid-2">
      <div class="admin-section">
        <h2>🏆 Top Estudiantes</h2>
        <table class="admin-table">
          <thead><tr><th>#</th><th>Usuario</th><th>Puntos</th><th>Nivel</th><th>Q</th><th>Prom</th></tr></thead>
          <tbody>
            <?php $i=1; foreach ($top as $u): ?>
            <tr>
              <td style="text-align:center"><?= $i <= 3 ? $medals[$i-1] : $i ?></td>
              <td class="admin-cell-trunc"><strong><?= htmlspecialchars($u['nombre_usuario']) ?></strong></td>
              <td style="color:var(--green)"><?= (int)$u['puntos'] ?></td>
              <td><?= (int)$u['nivel'] ?></td>
              <td><?= (int)$u['quizzes_hechos'] ?></td>
              <td style="color:var(--cyan)"><?= $u['avg_score'] ?? '—' ?>%</td>
            </tr>
            <?php $i++; endforeach; ?>
          </tbody>
        </table>
      </div>

      <div class="admin-section">
        <h2>📅 Actividad (30 d&iacute;as)</h2>
        <div class="chart-bars" style="height:100px;margin-bottom:4px">
          <?php for ($i = 29; $i >= 0; $i--):
            $day = date('Y-m-d', strtotime("-$i days"));
            $count = $daily_map[$day] ?? 0;
          ?>
          <div class="chart-col">
            <div class="chart-bar" style="height:<?= max(3, round(100 * $count / $max_daily)) ?>%" title="<?= $count ?>"></div>
          </div>
          <?php endfor; ?>
        </div>
        <div style="text-align:right;font-size:10px;color:var(--muted)">
          Pico: <span style="color:var(--cyan)"><?= $max_daily ?></span> act/d&iacute;a
        </div>
      </div>
    </div>
  </main>
</div>
<?php require __DIR__ . '/../../src/Templates/page_end.php'; ?>
