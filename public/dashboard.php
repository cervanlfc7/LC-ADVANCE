<?php
// ==========================================
// LC-ADVANCE - dashboard.php (Rediseño 2025)
// ==========================================
require_once __DIR__ . '/../src/Config/config.php';
requireLogin(true);
require_once __DIR__ . '/../src/Content/content.php';

$supported_langs = ['es', 'en'];
if (isset($_GET['lang']) && in_array($_GET['lang'], $supported_langs, true)) {
    $_SESSION['lang'] = $_GET['lang'];
}
$lang = $_SESSION['lang'] ?? 'es';
if (!in_array($lang, $supported_langs, true)) {
    $lang = 'es';
}
$t = [
    'es' => [
        'language' => 'Idioma',
        'theme' => 'Tema',
        'community' => 'Comunidad',
        'daily_quests' => 'Quests diarias',
        'completed' => 'completada',
        'pending' => 'pendiente',
        'home' => 'Inicio',
        'go_map' => 'Ir al Mapa',
        'logout' => 'Cerrar Sesión',
        
        'coding_lab' => 'Laboratorio',
        'ask_teacher' => 'Preguntar al Maestro',
        'ask_teacher_btn' => '💬 PREGUNTAR AL MAESTRO',
        'player_profile' => 'Perfil del jugador',
        'teacher_panel' => 'Panel Docente',
        'date_reports' => 'Reportes por rango de fecha',
        'no_records' => 'Sin registros en este rango',
        'search_placeholder' => 'Buscar lección por título o tema...',
        'all_subjects' => 'Todas las materias',
        'all_states' => 'Todos los estados',
        'done_plural' => 'Completadas',
        'pending_plural' => 'Pendientes',
        'learning_paths' => 'Rutas de aprendizaje',
        'filter_controls' => 'Controles de filtro',
        'all_teachers' => 'Todos los profesores',
        'apply_filter' => 'Aplicar filtro',
        'clear' => 'Limpiar',
        'filter' => 'filtro',
        'none' => 'ninguno',
        'combat_system' => 'SISTEMA DE COMBATE',
        'start_exam' => 'INICIAR EXAMEN',
        'empty_filtered' => 'No se encontraron lecciones con ese filtro. Prueba otro profesor o materia.',
        'empty_modules' => 'No hay módulos disponibles.',
        'lessons_completed' => 'lecciones completadas',
        'connected' => 'CONECTADO',
        'performance_title' => 'Indicadores de rendimiento — Tasa de rezago por materia',
        'from' => 'Desde',
        'to' => 'Hasta',
        'filter_btn' => 'Filtrar',
        'export_csv' => 'Exportar CSV',
        'combat_focus' => 'Enfócate en %s y genera dominio total.',
        'repeat' => 'REPETIR',
        'enter' => 'ENTRAR',
        'chart_label' => 'Tasa de fallo (%)',
        'chart_title' => 'Materias con más rezago',
        'quest_lesson' => 'Completa 1 lección hoy',
        'quest_xp' => 'Llega a 1,000 XP totales',
        'quest_level' => 'Alcanza nivel 3',
    ],
    'en' => [
        'language' => 'Language',
        'theme' => 'Theme',
        'community' => 'Community',
        'daily_quests' => 'Daily quests',
        'completed' => 'completed',
        'pending' => 'pending',
        'home' => 'Home',
        'go_map' => 'Go to Map',
        'logout' => 'Log Out',
        
        'coding_lab' => 'Coding Lab',
        'ask_teacher' => 'Ask the Teacher',
        'ask_teacher_btn' => '💬 ASK THE TEACHER',
        'player_profile' => 'Player profile',
        'teacher_panel' => 'Teacher panel',
        'date_reports' => 'Date range reports',
        'no_records' => 'No records found in this range',
        'search_placeholder' => 'Search lesson by title or topic...',
        'all_subjects' => 'All subjects',
        'all_states' => 'All states',
        'done_plural' => 'Completed',
        'pending_plural' => 'Pending',
        'learning_paths' => 'Learning paths',
        'filter_controls' => 'Filter controls',
        'all_teachers' => 'All teachers',
        'apply_filter' => 'Apply filter',
        'clear' => 'Clear',
        'filter' => 'filter',
        'none' => 'none',
        'combat_system' => 'COMBAT SYSTEM',
        'start_exam' => 'START EXAM',
        'empty_filtered' => 'No lessons were found with this filter. Try another teacher or subject.',
        'empty_modules' => 'No modules available.',
        'lessons_completed' => 'lessons completed',
        'connected' => 'CONNECTED',
        'performance_title' => 'Performance indicators — Subject lag rate',
        'from' => 'From',
        'to' => 'To',
        'filter_btn' => 'Filter',
        'export_csv' => 'Export CSV',
        'combat_focus' => 'Focus on %s and build full mastery.',
        'repeat' => 'REPEAT',
        'enter' => 'ENTER',
        'chart_label' => 'Failure rate (%)',
        'chart_title' => 'Subjects with highest lag',
        'quest_lesson' => 'Complete 1 lesson today',
        'quest_xp' => 'Reach 1,000 total XP',
        'quest_level' => 'Reach level 3',
    ],
];

$filter_profesor = isset($_GET['profesor']) ? trim($_GET['profesor']) : null;
$filter_materia  = isset($_GET['materia'])  ? trim($_GET['materia'])  : null;

if (!empty($filter_materia)) {
    $_SESSION['selected_materia'] = $filter_materia;
}

$dashboard_context_params = getDashboardReturnParams();

// ------------------ USUARIO ------------------
if (!empty($_SESSION['usuario_es_invitado'])) {
    $usuario = [
        'id'             => 0,
        'nombre_usuario' => $_SESSION['usuario_nombre'] ?? 'Invitado',
        'puntos'         => $_SESSION['usuario_puntos'] ?? 0,
        'nivel'          => $_SESSION['usuario_nivel']  ?? 1,
    ];
} else {
    $stmt = $pdo->prepare("SELECT id, nombre_usuario, puntos, nivel FROM usuarios WHERE id = ?");
    $stmt->execute([(int)($_SESSION['usuario_id'] ?? 0)]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$usuario) { session_destroy(); header('Location: login.php'); exit; }
}

$puntos_por_nivel  = 500;
$puntos_necesarios = ($usuario['nivel'] + 1) * $puntos_por_nivel;
$puntos_base       = $usuario['nivel'] * $puntos_por_nivel;
$progreso          = max(0, min(100, (($usuario['puntos'] - $puntos_base) / $puntos_por_nivel) * 100));

$badges = [];
if ($usuario['puntos'] >= 500)  $badges[] = ['nombre'=>'Novato',    'tipo'=>'bronze', 'icon'=>'🏅'];
if ($usuario['puntos'] >= 1000) $badges[] = ['nombre'=>'Explorador','tipo'=>'silver', 'icon'=>'🥈'];
if ($usuario['puntos'] >= 2000) $badges[] = ['nombre'=>'Élite',     'tipo'=>'gold',   'icon'=>'🥇'];

// ------------------ FILTRADO ------------------
function norm($s){
    return mb_strtolower(trim(strtr($s,[
        'Ã¡'=>'a','Ã©'=>'e','Ã­'=>'i','Ã³'=>'o','Ãº'=>'u','Ã±'=>'n','&'=>'y'
    ])), 'UTF-8');
}

$profesor_materia_map = [
    'Miguel Marquez'    => ['Temas Selectos de Matemáticas I y II'],
    'Enrique'           => ['Inglés'],
    'Espindola'         => ['Pensamiento Matemático III'],
    'Manuel'            => ['Programación'],
    'Meza'              => ['Programación'],
    'Herson'            => ['Física I','Química I'],
    'Carolina'          => ['Ecosistemas'],
    'Refugio & Padilla' => ['Ciencias Sociales'],
    'Armando'           => ['Historia de México']
];

if ($filter_profesor && empty($filter_materia)) {
    $nf = norm($filter_profesor);
    foreach ($profesor_materia_map as $prof => $mats) {
        if (norm($prof) === $nf || strpos(norm($prof), $nf) !== false || strpos($nf, norm($prof)) !== false) {
            $filter_materia = $mats[0] ?? null;
            break;
        }
    }
}

$materia_a_profesor_id = [
    'Temas Selectos de Matemáticas I y II' => '1Le',
    'Inglés'                               => '1Go',
    'Pensamiento Matemático III'           => '1Es',
    'Programación'                         => '1Ma',
    'Física I'                             => '1He',
    'Química I'                            => '1He',
    'Ecosistemas'                          => '1Ca',
    'Ciencias Sociales'                    => '1Pa',
    'Historia de México'                   => '1Ar',
];

$profesor_a_id = [
    'Miguel Marquez'    => '1Le',
    'Enrique'           => '1Go',
    'Espindola'         => '1Es',
    'Manuel'            => '1Ma',
    'Meza'              => '1Me',
    'Herson'            => '1He',
    'Carolina'          => '1Ca',
    'Refugio & Padilla' => '1Pa',
    'Armando'           => '1Ar'
];

$filter_materias = [];
if ($filter_materia) {
    $filter_materias[] = $filter_materia;
} elseif ($filter_profesor) {
    $nf = norm($filter_profesor);
    foreach ($profesor_materia_map as $prof => $mats) {
        $np = norm($prof);
        if ($np === $nf || strpos($np, $nf) !== false || strpos($nf, $np) !== false) {
            $filter_materias = $mats;
            break;
        }
    }
}

$lecciones_agrupadas = [];
$seen_slugs = [];
$all_materias = [];

foreach ($lecciones as $le) {
    $slug = $le['slug'] ?? null;
    if ($slug !== null) {
        if (isset($seen_slugs[$slug])) continue;
        $seen_slugs[$slug] = true;
    }
    $m = $le['materia'] ?? 'Sin Materia';
    $all_materias[$m] = true;
    if (!empty($filter_materias)) {
        $match = false;
        foreach ($filter_materias as $fm) {
            if (norm($m) === norm($fm)) { $match = true; break; }
        }
        if (!$match) continue;
    }
    $lecciones_agrupadas[$m][] = $le;
}

$filter_activo = !empty($filter_profesor) || !empty($filter_materia) || !empty($filter_materias);
if (empty($lecciones_agrupadas) && !$filter_activo) {
    foreach ($lecciones as $le) {
        $m = $le['materia'] ?? 'Sin Materia';
        $lecciones_agrupadas[$m][] = $le;
        $all_materias[$m] = true;
    }
}
ksort($all_materias, SORT_NATURAL | SORT_FLAG_CASE);

$completadas = [];
if (empty($_SESSION['usuario_es_invitado'])) {
    try {
        $stmt = $pdo->prepare("SELECT slug FROM user_progress WHERE user_id=? AND completed=1");
        $stmt->execute([$usuario['id']]);
        $completadas = $stmt->fetchAll(PDO::FETCH_COLUMN);
    } catch(Exception $e){}
}

$learning_paths_definition = [
    'Ruta STEM Base' => ['Pensamiento Matemático III', 'Física I', 'Química I'],
    'Ruta Tech' => ['Programación', 'Inglés'],
    'Ruta Integral' => ['Temas Selectos de Matemáticas I y II', 'Historia de México', 'Ciencias Sociales', 'Ecosistemas'],
];

$learning_paths = [];
foreach ($learning_paths_definition as $path_name => $materias_path) {
    $total_lessons = 0;
    $completed_lessons = 0;
    foreach ($lecciones as $lesson) {
        $lesson_materia = $lesson['materia'] ?? null;
        if (!$lesson_materia || !in_array($lesson_materia, $materias_path, true)) {
            continue;
        }
        $total_lessons++;
        if (!empty($lesson['slug']) && in_array($lesson['slug'], $completadas, true)) {
            $completed_lessons++;
        }
    }
    $progress_percent = $total_lessons > 0 ? round(($completed_lessons / $total_lessons) * 100) : 0;
    $learning_paths[] = [
        'nombre' => $path_name,
        'materias' => $materias_path,
        'total' => $total_lessons,
        'completadas' => $completed_lessons,
        'progreso' => $progress_percent,
    ];
}

// Métricas docentes
$total_usuarios              = (int)($pdo->query("SELECT COUNT(*) FROM usuarios")->fetchColumn() ?: 0);
$total_lecciones             = (int)($pdo->query("SELECT COUNT(DISTINCT slug) FROM user_progress")->fetchColumn() ?: 0);
$lecciones_completadas_total = (int)($pdo->query("SELECT COUNT(*) FROM user_progress WHERE completed=1")->fetchColumn() ?: 0);
$media_completado = $total_lecciones > 0
    ? round(($lecciones_completadas_total / ($total_usuarios * $total_lecciones)) * 100, 1) : 0;

$top_alumnos = $pdo->query("SELECT nombre_usuario, puntos, nivel,
    (SELECT COUNT(*) FROM user_progress up2 WHERE up2.user_id=u.id AND up2.completed=1) as lecciones_completas
    FROM usuarios u ORDER BY lecciones_completas DESC, puntos DESC LIMIT 5")->fetchAll(PDO::FETCH_ASSOC);

$slugMateriaMap = [];
foreach ($lecciones as $le)
    if (!empty($le['slug']) && !empty($le['materia']))
        $slugMateriaMap[$le['slug']] = $le['materia'];

$materiaStats   = [];
$progressBySlug = $pdo->query("SELECT slug, COUNT(*) as intentos, SUM(completed=1) as completadas FROM user_progress GROUP BY slug")->fetchAll(PDO::FETCH_ASSOC);
foreach ($progressBySlug as $r) {
    $slug      = $r['slug'];
    $intentos  = (int)$r['intentos'];
    $comp_slug = (int)$r['completadas'];
    $materia   = $slugMateriaMap[$slug] ?? 'Sin Materia';
    if (!isset($materiaStats[$materia]))
        $materiaStats[$materia] = ['materia'=>$materia,'intentos'=>0,'completadas'=>0];
    $materiaStats[$materia]['intentos']    += $intentos;
    $materiaStats[$materia]['completadas'] += $comp_slug;
}

$materia_rezagada = [];
foreach ($materiaStats as $stat) {
    $tasaFallo = $stat['intentos'] > 0
        ? (($stat['intentos'] - $stat['completadas']) / $stat['intentos']) * 100 : 0;
    $materia_rezagada[] = ['materia' => $stat['materia'], 'tasa_fallo' => round($tasaFallo, 1)];
}
usort($materia_rezagada, fn($a,$b) => $b['tasa_fallo'] <=> $a['tasa_fallo']);
$materia_rezagada = array_slice($materia_rezagada, 0, 5);

$fecha_desde = !empty($_GET['desde']) ? $_GET['desde'] : date('Y-m-01');
$fecha_hasta = !empty($_GET['hasta']) ? $_GET['hasta'] : date('Y-m-d');

$reportQuery = $pdo->prepare("SELECT up.user_id, u.nombre_usuario, up.slug, up.score, up.lesson_xp, up.completed, up.updated_at
    FROM user_progress up JOIN usuarios u ON u.id = up.user_id
    WHERE up.updated_at BETWEEN ? AND ?
    ORDER BY up.updated_at DESC LIMIT 500");
$reportQuery->execute(["{$fecha_desde} 00:00:00", "{$fecha_hasta} 23:59:59"]);
$reportRows = $reportQuery->fetchAll(PDO::FETCH_ASSOC);
foreach ($reportRows as &$row) $row['materia'] = $slugMateriaMap[$row['slug']] ?? 'Sin Materia';
unset($row);

if (isset($_GET['export']) && $_GET['export'] === 'csv') {
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=dashboard_report_'.date('Ymd').'.csv');
    $out = fopen('php://output', 'w');
    fputcsv($out, ['Usuario','Materia','Lección','Score','XP','Completado','Actualizado en']);
    foreach ($reportRows as $row)
        fputcsv($out, [$row['nombre_usuario'],$row['materia'],$row['slug'],$row['score'],$row['lesson_xp'],$row['completed'],$row['updated_at']]);
    fclose($out); exit;
}

$completed_lessons_count = count(array_unique($completadas));
$daily_quests = [
    [
        'titulo' => $t[$lang]['quest_lesson'],
        'completada' => $completed_lessons_count >= 1,
    ],
    [
        'titulo' => $t[$lang]['quest_xp'],
        'completada' => (int)$usuario['puntos'] >= 1000,
    ],
    [
        'titulo' => $t[$lang]['quest_level'],
        'completada' => (int)$usuario['nivel'] >= 3,
    ],
];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | LC-ADVANCE</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500;700&family=Syne:wght@700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/dashboard.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body.theme-light {
            --bg: #f4f8ff;
            --surface: #ffffff;
            --surface2: #eef4ff;
            --text: #061523;
            --muted: rgba(20, 35, 55, 0.65);
            --border: rgba(0, 120, 170, 0.16);
            --border2: rgba(0, 120, 170, 0.28);
        }
        .toolbar-controls { display:flex; align-items:center; gap:8px; margin-left:8px; }
        .toolbar-controls select, .toolbar-controls button {
            background: var(--surface2);
            border: 1px solid var(--border2);
            color: var(--text);
            border-radius: 7px;
            height: 30px;
            padding: 0 8px;
            font-size: 10px;
            font-family: var(--font-mono);
        }
        .quest-list { display:grid; gap:8px; }
        .quest-item {
            border: 1px solid var(--border);
            border-radius: 10px;
            background: var(--surface2);
            padding: 10px;
            display:flex;
            justify-content:space-between;
            align-items:center;
            gap:10px;
            font-size: 12px;
        }
        .quest-status {
            font-family: var(--font-mono);
            font-size: 9px;
            text-transform: uppercase;
            padding: 4px 8px;
            border-radius: 999px;
            border: 1px solid var(--border2);
            color: var(--cyan);
        }
        .quest-status.done {
            color: var(--green);
            border-color: rgba(0,255,135,0.25);
            background: rgba(0,255,135,0.08);
        }
    </style>
</head>
<body>

<!-- Fondo animado -->
<div class="grid-bg"></div>
<div class="bg-orb bg-orb-1"></div>
<div class="bg-orb bg-orb-2"></div>

<!-- ===== HEADER ===== -->
<header class="header">
    <div>
        <span class="logo-text">LC-ADVANCE</span>
        <span class="logo-tag">// SYSTEM_DASHBOARD</span>
    </div>
    <nav>
        <a href="../index.php"      class="btn-nav"><span class="nav-icon">🏠</span><span class="nav-label"><?= htmlspecialchars($t[$lang]['home']) ?></span></a>
        <a href="mapa/index.php" class="btn-nav primary"><span class="nav-icon">🗺️</span><span class="nav-label"><?= htmlspecialchars($t[$lang]['go_map']) ?></span></a>
        
        <a href="lab.php<?= htmlspecialchars($dashboard_context_params) ?>" class="btn-nav"><span class="nav-icon">🧪</span><span class="nav-label"><?= htmlspecialchars($t[$lang]['coding_lab']) ?></span></a>
        <a href="community.php<?= htmlspecialchars($dashboard_context_params) ?>" class="btn-nav"><span class="nav-icon">👥</span><span class="nav-label"><?= htmlspecialchars($t[$lang]['community']) ?></span></a>
        <a href="logout.php"     class="btn-nav"><span class="nav-icon">🔓</span><span class="nav-label"><?= htmlspecialchars($t[$lang]['logout']) ?></span></a>
        <div class="header-volume">
            <button class="vol-btn" id="volBtn" onclick="toggleVolumeSlider()">🔊</button>
            <div class="vol-slider" id="volSlider">
                <input type="range" id="volPrincipalSlider" min="0" max="1" step="0.1" value="0.5">
            </div>
        </div>
        <div class="toolbar-controls">
            <label for="langSelector" style="font-size:10px;color:var(--muted);font-family:var(--font-mono);"><?= htmlspecialchars($t[$lang]['language']) ?></label>
            <select id="langSelector">
                <option value="es" <?= $lang === 'es' ? 'selected' : '' ?>>ES</option>
                <option value="en" <?= $lang === 'en' ? 'selected' : '' ?>>EN</option>
            </select>
        </div>
    </nav>
</header>

<!-- ===== MAIN ===== -->
<main class="container">
    <div class="dashboard-grid">

        <!-- ══════════════════════════
             COLUMNA IZQUIERDA
        ══════════════════════════ -->
        <div class="profile-sidebar">

            <!-- Perfil -->
            <div class="card reveal">
                <div class="card-label"><?= htmlspecialchars($t[$lang]['player_profile']) ?></div>

                <div class="profile-head">
                    <div class="avatar-glow">🎮</div>
                    <div>
                        <h2 class="username-premium"><?= htmlspecialchars($usuario['nombre_usuario']) ?></h2>
                        <div class="profile-status">// <?= htmlspecialchars($t[$lang]['connected']) ?></div>
                    </div>
                </div>

                <div class="chips">
                    <div class="chip">
                        <div class="chip-label">Nivel</div>
                        <div class="chip-val cyan"><?= $usuario['nivel'] ?></div>
                    </div>
                    <div class="chip">
                        <div class="chip-label">Puntos XP</div>
                        <div class="chip-val pink"><?= number_format($usuario['puntos']) ?></div>
                    </div>
                </div>

                <div class="progress-block">
                    <div class="progress-top">
                        <span>Progreso → Nivel <?= $usuario['nivel'] + 1 ?></span>
                        <span><?= round($progreso) ?>%</span>
                    </div>
                    <div class="progress-bar-premium">
                        <div class="progress-fill-premium" style="width: <?= $progreso ?>%;"></div>
                    </div>
                    <div class="progress-note"><?= $puntos_necesarios - $usuario['puntos'] ?> XP para subir</div>
                </div>

                <div class="card-label">Logros desbloqueados</div>
                <div class="badge-list">
                    <?php if (empty($badges)): ?>
                        <span class="badge-item empty">Sin insignias aún</span>
                    <?php else: ?>
                        <?php foreach ($badges as $b): ?>
                            <div class="badge-item <?= $b['tipo'] ?>">
                                <span><?= $b['icon'] ?></span><span><?= $b['nombre'] ?></span>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

                <a href="ranking.php" class="btn-full">Ver Ranking Global</a>
            </div>

            <!-- Panel Docente -->
            <div class="card reveal">
                <div class="card-label"><?= htmlspecialchars($t[$lang]['teacher_panel']) ?></div>

                <div class="doc-stats">
                    <div class="doc-chip">
                        <div class="doc-chip-n"><?= $total_usuarios ?></div>
                        <div class="doc-chip-l">Usuarios</div>
                    </div>
                    <div class="doc-chip">
                        <div class="doc-chip-n pink"><?= $lecciones_completadas_total ?></div>
                        <div class="doc-chip-l">Completadas</div>
                    </div>
                    <div class="doc-chip full">
                        <div class="doc-chip-n green"><?= $media_completado ?>%</div>
                        <div class="doc-chip-l">Tasa media completado</div>
                    </div>
                </div>

                <div class="small-title">⭐ Top Alumnos</div>
                <ul class="top-alumnos-list">
                    <?php foreach ($top_alumnos as $alumno): ?>
                        <li class="top-item">
                            <span class="top-user"><?= htmlspecialchars($alumno['nombre_usuario']) ?></span>
                            <span class="top-meta"><?= $alumno['lecciones_completas'] ?> lec · <?= number_format($alumno['puntos']) ?> pts</span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

        </div><!-- /profile-sidebar -->


        <!-- ══════════════════════════
             COLUMNA DERECHA
        ══════════════════════════ -->
        <div class="main-dashboard">

            <!-- Gráfica de rendimiento -->
            <div class="card section-card reveal">
                <div class="card-label"><?= htmlspecialchars($t[$lang]['performance_title']) ?></div>
                <div class="chart-wrapper">
                    <canvas id="teacherProgressChart"></canvas>
                </div>
            </div>

            <!-- Reportes por fecha -->
            <div class="card section-card reveal">
                <div class="card-label"><?= htmlspecialchars($t[$lang]['date_reports']) ?></div>
                <form method="get" class="date-filter-row">
                    <label>
                        <?= htmlspecialchars($t[$lang]['from']) ?>
                        <input type="date" name="desde" value="<?= htmlspecialchars($fecha_desde) ?>" required>
                    </label>
                    <label>
                        <?= htmlspecialchars($t[$lang]['to']) ?>
                        <input type="date" name="hasta" value="<?= htmlspecialchars($fecha_hasta) ?>" required>
                    </label>
                    <button type="submit" class="btn-sm cyan"><?= htmlspecialchars($t[$lang]['filter_btn']) ?></button>
                    <button type="submit" name="export" value="csv" class="btn-sm muted"><?= htmlspecialchars($t[$lang]['export_csv']) ?></button>
                </form>

                <div class="report-table-wrapper">
                    <table class="report-table">
                        <thead>
                            <tr>
                                <th style="width:16%">Usuario</th>
                                <th style="width:20%">Materia</th>
                                <th style="width:22%">Lección</th>
                                <th style="width:8%">Score</th>
                                <th style="width:8%">XP</th>
                                <th style="width:5%">✓</th>
                                <th style="width:21%">Actualizado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($reportRows as $row): ?>
                                <tr>
                                    <td><?= htmlspecialchars($row['nombre_usuario']) ?></td>
                                    <td><?= htmlspecialchars($row['materia'] ?: '—') ?></td>
                                    <td><?= htmlspecialchars($row['slug']) ?></td>
                                    <td class="center"><?= htmlspecialchars($row['score']) ?></td>
                                    <td class="center"><?= htmlspecialchars($row['lesson_xp']) ?></td>
                                    <td class="<?= $row['completed'] ? 'done' : 'fail' ?>"><?= $row['completed'] ? '✓' : '✗' ?></td>
                                    <td><?= htmlspecialchars($row['updated_at']) ?></td>
                                </tr>
                            <?php endforeach; ?>
                            <?php if (empty($reportRows)): ?>
                                <tr><td colspan="7" style="text-align:center;color:var(--muted);padding:16px 0;"><?= htmlspecialchars($t[$lang]['no_records']) ?></td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Buscador -->
            <div class="search-wrapper reveal">
                <span class="search-icon">🔍</span>
                <input type="text" id="lessonSearch" class="search-input"
                       placeholder="<?= htmlspecialchars($t[$lang]['search_placeholder']) ?>" autocomplete="off">
            </div>
            <div class="search-filters reveal">
                <select id="searchMateria">
                    <option value=""><?= htmlspecialchars($t[$lang]['all_subjects']) ?></option>
                    <?php foreach (array_keys($all_materias) as $materiaOption): ?>
                        <option value="<?= htmlspecialchars($materiaOption) ?>"><?= htmlspecialchars($materiaOption) ?></option>
                    <?php endforeach; ?>
                </select>
                <select id="searchEstado">
                    <option value=""><?= htmlspecialchars($t[$lang]['all_states']) ?></option>
                    <option value="completed"><?= htmlspecialchars($t[$lang]['done_plural']) ?></option>
                    <option value="pending"><?= htmlspecialchars($t[$lang]['pending_plural']) ?></option>
                </select>
            </div>

            <div class="card section-card reveal">
                <div class="card-label"><?= htmlspecialchars($t[$lang]['learning_paths']) ?></div>
                <div class="learning-path-grid">
                    <?php foreach ($learning_paths as $path): ?>
                        <article class="learning-path-card">
                            <div class="learning-path-head">
                                <h3><?= htmlspecialchars($path['nombre']) ?></h3>
                                <span><?= $path['progreso'] ?>%</span>
                            </div>
                            <p><?= htmlspecialchars(implode(' · ', $path['materias'])) ?></p>
                            <div class="learning-path-meta">
                                <?= $path['completadas'] ?>/<?= $path['total'] ?> <?= htmlspecialchars($t[$lang]['lessons_completed']) ?>
                            </div>
                            <div class="learning-path-progress">
                                <span style="width: <?= $path['progreso'] ?>%"></span>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="card section-card reveal">
                <div class="card-label"><?= htmlspecialchars($t[$lang]['daily_quests']) ?></div>
                <div class="quest-list">
                    <?php foreach ($daily_quests as $quest): ?>
                        <div class="quest-item">
                            <span><?= htmlspecialchars($quest['titulo']) ?></span>
                            <span class="quest-status <?= $quest['completada'] ? 'done' : '' ?>">
                                <?= $quest['completada'] ? htmlspecialchars($t[$lang]['completed']) : htmlspecialchars($t[$lang]['pending']) ?>
                            </span>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Filtros + combate + lecciones -->
            <div class="card section-card reveal" id="filter-and-combat-area">
                <div class="card-label"><?= htmlspecialchars($t[$lang]['filter_controls']) ?></div>

                <form class="dashboard-filter-form" method="get">
                    <select name="profesor">
                        <option value=""><?= htmlspecialchars($t[$lang]['all_teachers']) ?></option>
                        <?php foreach ($profesor_materia_map as $prof => $mats): ?>
                            <option value="<?= htmlspecialchars($prof) ?>"
                                <?= $filter_profesor && norm($filter_profesor) === norm($prof) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($prof) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                    <select name="materia">
                        <option value=""><?= htmlspecialchars($t[$lang]['all_subjects']) ?></option>
                        <?php foreach ($materia_a_profesor_id as $materia => $pid): ?>
                            <option value="<?= htmlspecialchars($materia) ?>"
                                <?= $filter_materia && norm($filter_materia) === norm($materia) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($materia) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                    <button type="submit" class="btn-sm cyan"><?= htmlspecialchars($t[$lang]['apply_filter']) ?></button>
                    <a href="dashboard.php" class="btn-sm danger"><?= htmlspecialchars($t[$lang]['clear']) ?></a>
                </form>

                <div class="lecciones-filtros-mensajes">
                    <span class="filter-status">
                        <?= htmlspecialchars($t[$lang]['filter']) ?>: <strong><?= $filter_activo
                            ? htmlspecialchars($filter_profesor ?: $filter_materia ?: implode(', ', $filter_materias))
                            : htmlspecialchars($t[$lang]['none']) ?></strong>
                    </span>
                </div>

                <!-- Sistema de combate (solo cuando hay filtro) -->
                <?php if ($filter_materia || !empty($filter_materias) || $filter_profesor): ?>
                    <?php
                    $id_profesor_final = '1Cu';
                    $materia_usada     = $filter_materia ?: ($filter_materias[0] ?? 'General');
                    if ($filter_profesor) {
                        $nf = norm($filter_profesor);
                        foreach ($profesor_a_id as $prof => $id)
                            if (norm($prof) === $nf || strpos(norm($prof), $nf) !== false || strpos($nf, norm($prof)) !== false) {
                                $id_profesor_final = $id; break;
                            }
                    } else {
                        $mn = norm($materia_usada);
                        foreach ($materia_a_profesor_id as $mm => $id)
                            if (norm($mm) === $mn || str_contains($mn, norm($mm))) {
                                $id_profesor_final = $id; break;
                            }
                    }
                    $current_url = urlencode($_SERVER['REQUEST_URI']);
                    $examen_slug = "examen_final_" . norm($materia_usada);
                    ?>
                    <div class="combat-card">
                        <div class="combat-title">⚔️ <?= htmlspecialchars($t[$lang]['combat_system']) ?></div>
                        <div class="combat-sub">
                            <?php
                            $combatMsg = sprintf($t[$lang]['combat_focus'], '<strong style="color:var(--yellow)">' . htmlspecialchars($materia_usada) . '</strong>');
                            echo $combatMsg;
                            ?>
                        </div>
                        <a href="Examen/sistemC.php?personaje=<?= $id_profesor_final ?>&dialogo=1&pregunta=0&return_url=<?= $current_url ?>&slug=<?= $examen_slug ?>"
                           class="combat-btn">
                            <?= htmlspecialchars($t[$lang]['start_exam']) ?>
                        </a>
                        <a href="maestro_chat.php?materia=<?= urlencode($materia_usada) ?>"
                           class="combat-btn" style="background:var(--cyan-dim);border-color:var(--cyan);margin-top:6px;display:flex;align-items:center;justify-content:center;gap:6px;">
                            <?= htmlspecialchars($t[$lang]['ask_teacher_btn']) ?>
                        </a>
                    </div>
                <?php endif; ?>
            </div>

            <!-- ── LECCIONES POR MATERIA ── -->
            <?php if (empty($lecciones_agrupadas)): ?>
                <div class="card reveal">
                    <p class="empty-state">
                        <?= $filter_activo
                            ? htmlspecialchars($t[$lang]['empty_filtered'])
                            : htmlspecialchars($t[$lang]['empty_modules']) ?>
                    </p>
                </div>
            <?php else: ?>
                <?php foreach ($lecciones_agrupadas as $materia => $temas): ?>
                    <div class="card leccion-materia-block reveal">
                        <div class="materia-title"><?= htmlspecialchars($materia) ?></div>
                        <div class="leccion-grid">
                            <?php foreach ($temas as $tema):
                                $es_completada = in_array($tema['slug'], $completadas);
                                $href = 'leccion_detalle.php?slug=' . urlencode($tema['slug']) . '&materia=' . urlencode($materia);
                                if ($filter_profesor) $href .= '&profesor=' . urlencode($filter_profesor);
                            ?>
                                <a href="<?= $href ?>" class="leccion-card <?= $es_completada ? 'completed' : '' ?>">
                                    <div class="leccion-info">
                                        <span class="leccion-status"><?= $es_completada ? '✓' : '▶' ?></span>
                                        <span class="leccion-name"><?= htmlspecialchars($tema['titulo']) ?></span>
                                    </div>
                                    <span class="leccion-action"><?= $es_completada ? htmlspecialchars($t[$lang]['repeat']) : htmlspecialchars($t[$lang]['enter']) ?></span>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>

        </div><!-- /main-dashboard -->
    </div>
</main>

<script src="assets/js/app.js"></script>

<script>
// ── Buscador ──────────────────────────────────────────────────────────
const searchInput   = document.getElementById('lessonSearch');
const searchMateria = document.getElementById('searchMateria');
const searchEstado  = document.getElementById('searchEstado');
const combatArea    = document.getElementById('filter-and-combat-area');
const leccionBlocks = document.querySelectorAll('.leccion-materia-block');

function runDashboardSearch() {
    const term = searchInput.value.toLowerCase().trim();
    const materiaSeleccionada = (searchMateria.value || '').toLowerCase().trim();
    const estadoSeleccionado = searchEstado.value;

    combatArea.style.opacity       = term ? '0.35' : '1';
    combatArea.style.pointerEvents = term ? 'none'  : 'all';
    combatArea.style.transition    = 'opacity 0.3s';

    leccionBlocks.forEach(block => {
        const materiaActual = (block.querySelector('.materia-title')?.textContent || '').toLowerCase().trim();
        const materiaMatch = !materiaSeleccionada || materiaActual === materiaSeleccionada;
        const cards = block.querySelectorAll('.leccion-card');
        let visible = 0;
        cards.forEach(card => {
            const title   = card.querySelector('.leccion-name').textContent.toLowerCase();
            const isCompleted = card.classList.contains('completed');
            const estadoMatch = !estadoSeleccionado
                || (estadoSeleccionado === 'completed' && isCompleted)
                || (estadoSeleccionado === 'pending' && !isCompleted);
            const matches = (!term || title.includes(term)) && materiaMatch && estadoMatch;
            card.style.display = matches ? 'flex' : 'none';
            if (matches) visible++;
        });
        block.style.display = visible > 0 ? 'block' : 'none';
    });
}

searchInput.addEventListener('input', runDashboardSearch);
searchMateria.addEventListener('change', runDashboardSearch);
searchEstado.addEventListener('change', runDashboardSearch);

// ── Scroll reveal ─────────────────────────────────────────────────────
const revealObs = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('visible');
            revealObs.unobserve(entry.target);
        }
    });
}, { threshold: 0.05, rootMargin: '0px 0px -20px 0px' });

document.querySelectorAll('.reveal').forEach(el => revealObs.observe(el));

document.addEventListener('DOMContentLoaded', () => {
    const langSelector = document.getElementById('langSelector');
    if (langSelector) {
        langSelector.addEventListener('change', (e) => {
            const u = new URL(window.location.href);
            u.searchParams.set('lang', e.target.value);
            window.location.href = u.toString();
        });
    }
});
</script>

<script>
// ── Chart.js ──────────────────────────────────────────────────────────
(function () {
    const canvas = document.getElementById('teacherProgressChart');
    if (!canvas) return;
    if (typeof Chart === 'undefined') {
        canvas.parentElement.innerHTML = '<div class="chart-error">Gráfica no disponible. Por favor recarga la página.</div>';
        return;
    }

    const materias = <?= json_encode(array_column($materia_rezagada, 'materia')) ?>;
    const tasa     = <?= json_encode(array_map(fn($m) => round($m['tasa_fallo'], 1), $materia_rezagada)) ?>;

    new Chart(canvas, {
        type: 'bar',
        data: {
            labels: materias,
            datasets: [{
                label: <?= json_encode($t[$lang]['chart_label']) ?>,
                data: tasa,
                backgroundColor: 'rgba(255, 60, 172, 0.2)',
                borderColor:     'rgba(255, 60, 172, 0.75)',
                borderWidth: 1,
                borderRadius: 5,
                hoverBackgroundColor: 'rgba(255, 60, 172, 0.38)',
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    max: 100,
                    ticks: { color: 'rgba(200,230,255,0.45)', font: { size: 11, family: "'JetBrains Mono'" } },
                    grid: { color: 'rgba(255,255,255,0.04)' },
                    border: { color: 'rgba(255,255,255,0.06)' }
                },
                x: {
                    ticks: { color: 'rgba(200,230,255,0.45)', font: { size: 10, family: "'JetBrains Mono'" } },
                    grid:  { color: 'rgba(255,255,255,0.03)' },
                    border: { color: 'rgba(255,255,255,0.06)' }
                }
            },
            plugins: {
                legend: { labels: { color: 'rgba(200,230,255,0.6)', font: { size: 11, family: "'JetBrains Mono'" } } },
                title:  {
                    display: true,
                    text: <?= json_encode($t[$lang]['chart_title']) ?>,
                    color: 'rgba(200,230,255,0.7)',
                    font: { size: 12, family: "'JetBrains Mono'", weight: '500' },
                    padding: { bottom: 12 }
                }
            }
        }
    });
})();
</script>

<audio id="dashboardMusic" loop>
  <source src="assets/music/cuco_pantalla_inicio.mp3" type="audio/mpeg">
</audio>
<script>
const STORAGE_KEY = 'lc_volume_settings';
function getStoredVolumes() {
    const stored = localStorage.getItem(STORAGE_KEY);
    if (stored) return JSON.parse(stored);
    return { principal: 1.0, ambiental: 0.8, examenes: 0.8 };
}
const volumes = getStoredVolumes();
const dAudio = document.getElementById('dashboardMusic');
if (dAudio) dAudio.volume = volumes.principal;
// Do not autoplay audio on mobile to avoid blocking and unwanted data/playback.
// Users can enable playback via the volume control or a play button if desired.
// Attempting to autoplay is intentionally omitted for better mobile UX.
<script src="assets/js/volume_manager.js"></script>
<script>if (typeof initPageAudio === 'function') initPageAudio('dashboardMusic');</script>
<style>
.header-volume-btn {
  position: fixed;
  top: 15px;
  right: 15px;
  z-index: 9999;
  background: rgba(0,0,0,0.7);
  border: 2px solid #00e5ff;
  border-radius: 8px;
  padding: 8px 12px;
  cursor: pointer;
  color: #00e5ff;
  font-size: 18px;
  display: flex;
  align-items: center;
  gap: 8px;
}
.header-volume-btn:hover {
  background: rgba(0,229,255,0.2);
}
.header-volume-slider {
  display: none;
  position: absolute;
  top: 100%;
  right: 0;
  background: rgba(0,0,0,0.9);
  border: 1px solid #00e5ff;
  border-radius: 8px;
  padding: 10px;
  margin-top: 5px;
}
.header-volume-slider.show {
  display: block;
}
.header-volume-slider input {
  width: 100px;
  cursor: pointer;
}
</style>
<style>
.header-volume {
  display: flex;
  align-items: center;
  gap: 8px;
  margin-left: 15px;
}
.vol-btn {
  background: rgba(0,229,255,0.1);
  border: 1px solid rgba(0,229,255,0.5);
  border-radius: 6px;
  padding: 6px 10px;
  cursor: pointer;
  color: #00e5ff;
  font-size: 16px;
  transition: all 0.3s ease;
}
.vol-btn:hover {
  background: rgba(0,229,255,0.2);
  border-color: #00e5ff;
}
.vol-slider {
  display: none;
  background: rgba(0,0,0,0.9);
  border: 1px solid rgba(0,229,255,0.5);
  border-radius: 6px;
  padding: 8px;
}
.vol-slider.show {
  display: block;
}
.vol-slider input {
  width: 100px;
  cursor: pointer;
  -webkit-appearance: none;
  background: #222;
  height: 12px;
  border: 2px solid #00e5ff;
  border-radius: 4px;
}

@media (max-width: 640px) {
    .vol-slider input { width: 120px; }
}
.vol-slider input::-webkit-slider-thumb {
  -webkit-appearance: none;
  width: 16px;
  height: 20px;
  background: #c9408a;
  border: 2px solid #fff;
  cursor: pointer;
  border-radius: 4px;
}
@media (max-width: 768px) {
  .vol-btn {
    padding: 4px 6px;
    font-size: 14px;
  }
  .vol-slider {
    padding: 6px;
  }
  .vol-slider input {
    width: 80px;
    height: 10px;
  }
  .vol-slider input::-webkit-slider-thumb {
    width: 14px;
    height: 16px;
  }
}
</style>
<script>
function toggleVolumeSlider() {
  document.getElementById('volSlider').classList.toggle('show');
}
const volSlider = document.getElementById('volPrincipalSlider');
volSlider.value = volumes.principal;
volSlider.addEventListener('input', function(e) {
  volumes.principal = parseFloat(e.target.value);
  localStorage.setItem(STORAGE_KEY, JSON.stringify(volumes));
  dAudio.volume = volumes.principal;
  document.getElementById('volBtn').textContent = volumes.principal > 0 ? '🔊' : '🔇';
});
</script>

</body>
</html>