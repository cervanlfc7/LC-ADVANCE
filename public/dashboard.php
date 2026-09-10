<?php
// ==========================================
// LC-ADVANCE - dashboard.php (Rediseño 2025)
// ==========================================
require_once __DIR__ . '/../src/Config/config.php';
require_once __DIR__ . '/../src/Core/panel_docente.php';
requireLogin(true);
require_once __DIR__ . '/../src/Content/content.php';
require_once __DIR__ . '/../src/Core/daily_quests.php';
require_once __DIR__ . '/../src/Core/notificaciones.php';

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
        'profile' => 'Mi Perfil',
        'logout' => 'Cerrar Sesión',
        
        'coding_lab' => 'Laboratorio',
        'ask_teacher' => 'Preguntar al Maestro',
        'ask_teacher_btn' => '💬 PREGUNTAR AL MAESTRO',
        'welcome' => '¡Bienvenido a LC-ADVANCE!',
        'onboarding_intro' => 'Tu plataforma de aprendizaje gamificada. Gana XP, sube de nivel y domina las materias DGETI.',
        'onboarding_lessons_title' => 'Lecciones Interactivas',
        'onboarding_lessons_desc' => 'Cada materia tiene lecciones con contenido interactivo, ecuaciones en LaTeX y quizzes para ganar XP.',
        'onboarding_map_title' => 'Mapa Interactivo',
        'onboarding_map_desc' => 'Explora el mapa estilo RPG, encuentra maestros NPC y enfréntate a exámenes combate.',
        'onboarding_lab_title' => 'Laboratorio STEM',
        'onboarding_lab_desc' => 'Resuelve desafíos de programación, matemáticas, física y más con verificación automática.',
        'onboarding_ranking_title' => 'Ranking y Logros',
        'onboarding_ranking_desc' => 'Compite en el ranking global, desbloquea insignias y completa misiones diarias.',
        'skip' => 'Saltar',
        'next' => 'Siguiente',
        'start' => '¡Comenzar!',
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
        'profile' => 'My Profile',
        'logout' => 'Log Out',
        
        'coding_lab' => 'Coding Lab',
        'ask_teacher' => 'Ask the Teacher',
        'ask_teacher_btn' => '💬 ASK THE TEACHER',
        'welcome' => 'Welcome to LC-ADVANCE!',
        'onboarding_intro' => 'Your gamified learning platform. Earn XP, level up, and master DGETI subjects.',
        'onboarding_lessons_title' => 'Interactive Lessons',
        'onboarding_lessons_desc' => 'Each subject has interactive lessons with LaTeX equations and quizzes to earn XP.',
        'onboarding_map_title' => 'Interactive Map',
        'onboarding_map_desc' => 'Explore the RPG-style map, find teacher NPCs, and take on combat exams.',
        'onboarding_lab_title' => 'STEM Lab',
        'onboarding_lab_desc' => 'Solve coding, math, and physics challenges with automatic verification.',
        'onboarding_ranking_title' => 'Ranking & Achievements',
        'onboarding_ranking_desc' => 'Compete on the global leaderboard, unlock badges, and complete daily quests.',
        'skip' => 'Skip',
        'next' => 'Next',
        'start' => 'Start!',
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
    $stmt = $pdo->prepare("SELECT id, nombre_usuario, puntos, nivel, ultimo_login, racha_actual, correo, email_verified FROM usuarios WHERE id = ?");
    $stmt->execute([(int)($_SESSION['usuario_id'] ?? 0)]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$usuario) { session_destroy(); header('Location: login.php'); exit; }
}

require_once __DIR__ . '/../src/Core/rachas.php';
$racha_data = obtenerRacha((int)$usuario['id'], $pdo);

// ─── JOIN GROUP HANDLER ──────────────────────────────────
$join_group_error = '';
$join_group_ok = '';
$student_groups = [];
if (($_SESSION['usuario_tipo'] ?? '') === 'student' && !empty($_SESSION['usuario_id'])) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action_join_group'])) {
        $codigo = strtoupper(trim($_POST['codigo_acceso'] ?? ''));
        $token = $_POST['csrf_token'] ?? '';
        if (!validarCsrfToken($token)) {
            $join_group_error = 'Token de seguridad inválido. Recarga la página.';
        } elseif (strlen($codigo) < 4) {
            $join_group_error = 'Código inválido.';
        } else {
            $result = agregarEstudianteAGrupo($codigo, (int)$_SESSION['usuario_id']);
            if ($result['success']) {
                $join_group_ok = '✅ Te has unido al grupo: ' . htmlspecialchars($result['grupo']);
            } else {
                $join_group_error = $result['error'];
            }
        }
    }
    $student_groups = obtenerGruposDelEstudiante((int)$usuario['id']);
}

$puntos_por_nivel  = 500;
$puntos_necesarios = ($usuario['nivel'] + 1) * $puntos_por_nivel;
$puntos_base       = $usuario['nivel'] * $puntos_por_nivel;
$progreso          = max(0, min(100, (($usuario['puntos'] - $puntos_base) / $puntos_por_nivel) * 100));

require_once __DIR__ . '/../src/Core/logros.php';
$badges_db = obtenerLogrosUsuario((int)$usuario['id'], $pdo);
$badges = [];
foreach ($badges_db as $b) {
    if ($b['obtenido']) {
        $tipo = 'bronze';
        if ($b['id'] >= 8) $tipo = 'gold';
        elseif ($b['id'] >= 5) $tipo = 'silver';
        $badges[] = ['nombre' => $b['nombre'], 'tipo' => $tipo, 'icon' => '🏆'];
    }
}

$notif_no_leidas = 0;
$notificaciones_lista = [];
if (empty($_SESSION['usuario_es_invitado'])) {
    $notif_no_leidas = contarNotificacionesNoLeidas((int)$usuario['id']);
    $notificaciones_lista = obtenerNotificaciones((int)$usuario['id'], 10);
}

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
    if (($_SESSION['usuario_tipo'] ?? '') === 'student' && !empty($assignedSlugs) && $slug !== null && !in_array($slug, $assignedSlugs, true)) {
        continue;
    }
    $lecciones_agrupadas[$m][] = $le;
}

$filter_activo = !empty($filter_profesor) || !empty($filter_materia) || !empty($filter_materias);
if (empty($lecciones_agrupadas) && !$filter_activo) {
    foreach ($lecciones as $le) {
        $slug = $le['slug'] ?? null;
        if (($_SESSION['usuario_tipo'] ?? '') === 'student' && !empty($assignedSlugs) && $slug !== null && !in_array($slug, $assignedSlugs, true)) {
            continue;
        }
        $m = $le['materia'] ?? 'Sin Materia';
        $lecciones_agrupadas[$m][] = $le;
        $all_materias[$m] = true;
    }
}
ksort($all_materias, SORT_NATURAL | SORT_FLAG_CASE);

$completadas = [];
$mostrar_onboarding = false;
$assignedLessonsByGroup = [];
$assignedSlugs = [];
if (empty($_SESSION['usuario_es_invitado'])) {
    try {
        $stmt = $pdo->prepare("SELECT slug FROM user_progress WHERE user_id=? AND completed=1");
        $stmt->execute([$usuario['id']]);
        $completadas = $stmt->fetchAll(PDO::FETCH_COLUMN);
    } catch(Exception $e){}

    if ($_SESSION['usuario_tipo'] === 'student') {
        $assignedLessonsByGroup = obtenerLeccionesAsignadasPorGrupoParaEstudiante((int)$usuario['id']);
        foreach ($assignedLessonsByGroup as $groupData) {
            foreach ($groupData['slugs'] as $slug) {
                if (!in_array($slug, $assignedSlugs, true)) {
                    $assignedSlugs[] = $slug;
                }
            }
        }
    }

    // Mostrar onboarding si no tiene lecciones completadas, menos de 50 XP y nunca lo ha visto
    if (empty($completadas) && (int)($usuario['puntos'] ?? 0) < 50) {
        $stmt = $pdo->prepare("SELECT 1 FROM usuarios_badges WHERE usuario_id=? AND badge_id IN (SELECT id FROM badges WHERE nombre_badge='Primer Paso')");
        $stmt->execute([$usuario['id']]);
        if (!$stmt->fetchColumn()) {
            $mostrar_onboarding = true;
        }
    }
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
$stmt_usuarios = $pdo->prepare("SELECT COUNT(*) FROM usuarios");
$stmt_usuarios->execute();
$total_usuarios = (int)($stmt_usuarios->fetchColumn() ?: 0);

$stmt_lecciones = $pdo->prepare("SELECT COUNT(DISTINCT slug) FROM user_progress");
$stmt_lecciones->execute();
$total_lecciones = (int)($stmt_lecciones->fetchColumn() ?: 0);

$stmt_completadas = $pdo->prepare("SELECT COUNT(*) FROM user_progress WHERE completed = 1");
$stmt_completadas->execute();
$lecciones_completadas_total = (int)($stmt_completadas->fetchColumn() ?: 0);

$media_completado = $total_lecciones > 0
    ? round(($lecciones_completadas_total / ($total_usuarios * $total_lecciones)) * 100, 1) : 0;

$stmt_top = $pdo->prepare("SELECT nombre_usuario, puntos, nivel,
    (SELECT COUNT(*) FROM user_progress WHERE user_id = u.id AND completed = 1) as lecciones_completas
    FROM usuarios u WHERE tipo = 'student' ORDER BY lecciones_completas DESC, puntos DESC LIMIT 5");
$stmt_top->execute();
$top_alumnos = $stmt_top->fetchAll(PDO::FETCH_ASSOC);

$slugMateriaMap = [];
foreach ($lecciones as $le)
    if (!empty($le['slug']) && !empty($le['materia']))
        $slugMateriaMap[$le['slug']] = $le['materia'];

$materiaStats   = [];
$stmt_prog = $pdo->prepare("SELECT slug, COUNT(*) as intentos, SUM(completed=1) as completadas FROM user_progress GROUP BY slug");
$stmt_prog->execute();
$progressBySlug = $stmt_prog->fetchAll(PDO::FETCH_ASSOC);
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

// ─── Progreso por materia (usuario actual) ──────────────────────
$materias_disponibles = [];
foreach ($lecciones as $le) {
    $mat = $le['materia'] ?? 'General';
    if (!isset($materias_disponibles[$mat])) $materias_disponibles[$mat] = 0;
    $materias_disponibles[$mat]++;
}
$materias_completadas_usuario = [];
if (!empty($_SESSION['usuario_es_invitado'])) {
    foreach ($materias_disponibles as $mat => $total) {
        $materias_completadas_usuario[] = ['materia' => $mat, 'total' => $total, 'completadas' => 0];
    }
} else {
    $user_progress_slugs = $pdo->prepare("SELECT slug FROM user_progress WHERE user_id = ? AND completed = 1");
    $user_progress_slugs->execute([$usuario['id']]);
    $completed_slugs = $user_progress_slugs->fetchAll(PDO::FETCH_COLUMN);
    $materia_completed_counts = [];
    foreach ($completed_slugs as $slug) {
        $mat = $slugMateriaMap[$slug] ?? 'General';
        $materia_completed_counts[$mat] = ($materia_completed_counts[$mat] ?? 0) + 1;
    }
    foreach ($materias_disponibles as $mat => $total) {
        $comp = $materia_completed_counts[$mat] ?? 0;
        $materias_completadas_usuario[] = ['materia' => $mat, 'total' => $total, 'completadas' => $comp];
    }
}
usort($materias_completadas_usuario, fn($a,$b) => $b['total'] <=> $a['total']);

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
$daily_quests = empty($_SESSION['usuario_es_invitado']) ? generarMisionesDiarias((int)$usuario['id']) : [];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?= htmlspecialchars(csrfToken()) ?>">
    <title>Dashboard | LC-ADVANCE</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500;700&family=Syne:wght@700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= assetUrl('assets/css/dashboard.css') ?>">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js" integrity="sha384-e6nUZLBkQ86NJ6TVVKAeSaK8jWa3NhkYWZFomE39AvDbQWeie9PlQqM3pmYW5d1g" crossorigin="anonymous"></script>
    <script>try{var t=localStorage.getItem('lc_advance_theme');if(t==='light'){document.documentElement.classList.remove('dark');document.body.classList.add('theme-light')}else if(t==='dark'){document.documentElement.classList.add('dark')}else if(window.matchMedia('(prefers-color-scheme: light)').matches){document.body.classList.add('theme-light')}}catch(e){} window.__APP_ROOT__ = <?= json_encode(appRootPath()) ?>;if('serviceWorker'in navigator){navigator.serviceWorker.register((window.__APP_ROOT__||'')+'/service-worker.js')['catch'](function(){})}</script>
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
            padding: 10px 12px;
            display:flex;
            flex-wrap:wrap;
            align-items:center;
            gap:8px;
            font-size: 12px;
            transition: border-color 0.3s;
        }
        .quest-item.completada { border-color: rgba(0,255,135,0.3); }
        .quest-info { display:flex; align-items:center; gap:8px; flex:1; min-width:120px; }
        .quest-title { flex:1; }
        .quest-progress-text { font-family:var(--font-mono); font-size:10px; color:var(--cyan); white-space:nowrap; }
        .quest-bar-wrapper {
            flex:1; min-width:80px;
            height:6px; background:rgba(255,255,255,0.08);
            border-radius:3px; overflow:hidden;
        }
        .quest-bar {
            height:100%;
            background:linear-gradient(90deg,var(--cyan),var(--green));
            border-radius:3px; transition:width 0.5s ease;
        }
        .quest-actions { display:flex; align-items:center; gap:6px; white-space:nowrap; }
        .quest-xp { font-family:var(--font-mono); font-size:9px; color:var(--yellow); }
        .card-label { display:flex; align-items:center; gap:8px; }
        .ver-todos { color:var(--cyan); font-size:0.7rem; font-family:var(--font-mono); text-decoration:none; }
        .ver-todos:hover { text-decoration:underline; }
        .quest-claim-btn {
            font-family:var(--font-mono); font-size:9px;
            background:var(--green); color:#000; border:none;
            padding:4px 10px; border-radius:6px; cursor:pointer;
            text-transform:uppercase; font-weight:600; letter-spacing:0.5px;
            transition:all 0.3s;
        }
        .quest-claim-btn:hover { background:#00ff87; box-shadow:0 0 15px rgba(0,255,135,0.4); }
        .quest-claim-btn:disabled { opacity:0.5; cursor:default; }
        .quest-claimed { font-size:16px; }
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

        /* ─── ONBOARDING OVERLAY ─── */
        .onboarding-overlay {
            position:fixed; inset:0; z-index:99999;
            background:rgba(0,0,0,0.75);
            backdrop-filter:blur(8px);
            display:flex; align-items:center; justify-content:center;
            animation:fadeIn 0.4s ease;
        }
        .onboarding-card {
            background:var(--surface); border:1px solid var(--cyan);
            border-radius:20px; padding:40px; max-width:520px; width:90%;
            text-align:center; position:relative;
            box-shadow:0 0 60px rgba(0,229,255,0.15);
        }
        .onboarding-card h2 { font-family:'Syne',sans-serif; font-size:1.5rem; color:var(--cyan); margin:0 0 8px; }
        .onboarding-card p { color:var(--muted); font-size:0.9rem; line-height:1.6; margin:0 0 24px; }
        .onboarding-steps { display:flex; gap:6px; justify-content:center; margin-bottom:24px; }
        .onboarding-dot { width:10px; height:10px; border-radius:50%; background:rgba(255,255,255,0.15); cursor:pointer; transition:all 0.3s; }
        .onboarding-dot.active { background:var(--cyan); box-shadow:0 0 10px rgba(0,229,255,0.5); }
        .onboarding-actions { display:flex; gap:12px; justify-content:center; }
        .onboarding-btn {
            padding:10px 24px; border-radius:10px; border:none;
            font-family:'Space Grotesk',sans-serif; font-size:0.85rem; font-weight:600;
            cursor:pointer; transition:all 0.3s; text-transform:uppercase; letter-spacing:0.5px;
        }
        .onboarding-btn-primary { background:var(--cyan); color:#000; }
        .onboarding-btn-primary:hover { box-shadow:0 0 20px rgba(0,229,255,0.4); }
        .onboarding-btn-secondary { background:transparent; color:var(--muted); border:1px solid var(--border2); }
        .onboarding-btn-secondary:hover { color:var(--text); border-color:var(--cyan); }
        .onboarding-icon { font-size:3rem; margin-bottom:12px; }
        @keyframes fadeIn { from { opacity:0; } to { opacity:1; } }

        /* ─── VERIFY BANNER ─── */
        .verify-banner { background:rgba(255,210,63,0.1); border:1px solid rgba(255,210,63,0.3); border-radius:10px; padding:12px 16px; margin:12px auto; max-width:1200px; display:flex; align-items:center; justify-content:center; gap:12px; flex-wrap:wrap; font-size:0.85rem; color:var(--yellow); }
        .verify-btn { background:var(--yellow); color:#000; border:none; border-radius:6px; padding:6px 14px; font-family:'Space Grotesk',sans-serif; font-size:0.75rem; font-weight:600; cursor:pointer; transition:all 0.3s; }
        .verify-btn:hover { box-shadow:0 0 12px rgba(255,210,63,0.3); }
        .verify-btn:disabled { opacity:0.5; pointer-events:none; }

        /* ─── NOTIFICACIONES ─── */
        .notif-btn {
            position:relative; background:none; border:none; color:var(--cyan);
            font-size:1.2rem; cursor:pointer; padding:6px 8px; border-radius:8px;
            transition:all 0.3s;
        }
        .notif-btn:hover { background:rgba(0,229,255,0.1); }
        .notif-badge {
            position:absolute; top:-2px; right:-2px;
            background:var(--pink); color:#fff; font-size:8px;
            min-width:16px; height:16px; border-radius:8px;
            display:flex; align-items:center; justify-content:center;
            font-family:var(--font-mono); font-weight:700;
            border:2px solid var(--bg);
        }
        .notif-dropdown {
            position:absolute; top:100%; right:0; z-index:9999;
            width:340px; max-height:400px; overflow-y:auto;
            background:var(--surface); border:1px solid var(--border);
            border-radius:12px; box-shadow:0 20px 60px rgba(0,0,0,0.5);
            display:none;
        }
        .notif-dropdown.show { display:block; }
        .notif-item {
            padding:12px 16px; border-bottom:1px solid var(--border);
            cursor:pointer; transition:background 0.3s;
            text-align:left;
        }
        .notif-item:hover { background:rgba(0,229,255,0.05); }
        .notif-item:last-child { border-bottom:none; }
        .notif-item.unread { border-left:3px solid var(--cyan); }
        .notif-titulo { font-weight:600; font-size:0.85rem; color:var(--text); }
        .notif-mensaje { font-size:0.75rem; color:var(--muted); margin-top:2px; }
        .notif-tiempo { font-size:0.65rem; color:var(--text-dim); margin-top:4px; font-family:var(--font-mono); }
        .notif-empty { padding:24px; text-align:center; color:var(--muted); font-size:0.85rem; }
        .notif-header { padding:12px 16px; border-bottom:1px solid var(--border); display:flex; justify-content:space-between; align-items:center; }
        .notif-header span { font-weight:600; font-size:0.8rem; color:var(--text); }
        .notif-header button { background:none; border:none; color:var(--cyan); cursor:pointer; font-size:0.75rem; font-family:var(--font-mono); }
    </style>
</head>
<body>

<div class="grid-bg"></div>
<div class="bg-orb bg-orb-1"></div>
<div class="bg-orb bg-orb-2"></div>

<?php if ($mostrar_onboarding): ?>
<div class="onboarding-overlay" id="onboardingOverlay">
    <div class="onboarding-card" id="onboardingCard">
        <div class="onboarding-icon" id="onboardingIcon">🚀</div>
        <h2 id="onboardingTitle"><?= htmlspecialchars($t[$lang]['welcome'] ?? '¡Bienvenido a LC-ADVANCE!') ?></h2>
        <p id="onboardingDesc"><?= htmlspecialchars($t[$lang]['onboarding_intro'] ?? 'Tu plataforma de aprendizaje gamificada. Gana XP, sube de nivel y domina las materias DGETI.') ?></p>
        <div class="onboarding-steps" id="onboardingSteps">
            <span class="onboarding-dot active" data-step="0"></span>
            <span class="onboarding-dot" data-step="1"></span>
            <span class="onboarding-dot" data-step="2"></span>
            <span class="onboarding-dot" data-step="3"></span>
            <span class="onboarding-dot" data-step="4"></span>
        </div>
        <div class="onboarding-actions">
            <button class="onboarding-btn onboarding-btn-secondary" onclick="saltarOnboarding()"><?= htmlspecialchars($t[$lang]['skip'] ?? 'Saltar') ?></button>
            <button class="onboarding-btn onboarding-btn-primary" id="onboardingNext" onclick="siguientePaso()"><?= htmlspecialchars($t[$lang]['next'] ?? 'Siguiente') ?></button>
        </div>
    </div>
</div>
<script>
const onboardingPasos = [
    { icon: '🚀', title: <?= json_encode($t[$lang]['welcome'] ?? '¡Bienvenido a LC-ADVANCE!') ?>, desc: <?= json_encode($t[$lang]['onboarding_intro'] ?? 'Tu plataforma de aprendizaje gamificada. Gana XP, sube de nivel y domina las materias DGETI.') ?> },
    { icon: '📚', title: <?= json_encode($t[$lang]['onboarding_lessons_title'] ?? 'Lecciones Interactivas') ?>, desc: <?= json_encode($t[$lang]['onboarding_lessons_desc'] ?? 'Cada materia tiene lecciones con contenido interactivo, ecuaciones en LaTeX y quizzes al final para ganar XP.') ?> },
    { icon: '🗺️', title: <?= json_encode($t[$lang]['onboarding_map_title'] ?? 'Mapa Interactivo') ?>, desc: <?= json_encode($t[$lang]['onboarding_map_desc'] ?? 'Explora el mapa estilo RPG, encuentra maestros NPC y enfréntate a exámenes combate para ganar grandes recompensas.') ?> },
    { icon: '🧪', title: <?= json_encode($t[$lang]['onboarding_lab_title'] ?? 'Laboratorio STEM') ?>, desc: <?= json_encode($t[$lang]['onboarding_lab_desc'] ?? 'Resuelve desafíos de programación, matemáticas, física y más en el laboratorio interactivo con verificación automática.') ?> },
    { icon: '🏆', title: <?= json_encode($t[$lang]['onboarding_ranking_title'] ?? 'Ranking y Logros') ?>, desc: <?= json_encode($t[$lang]['onboarding_ranking_desc'] ?? 'Compite en el ranking global, desbloquea insignias, completa misiones diarias y sigue tus rutas de aprendizaje.') ?> },
];
let pasoActual = 0;
function mostrarPaso(idx) {
    pasoActual = idx;
    const p = onboardingPasos[idx];
    document.getElementById('onboardingIcon').textContent = p.icon;
    document.getElementById('onboardingTitle').textContent = p.title;
    document.getElementById('onboardingDesc').textContent = p.desc;
    document.querySelectorAll('.onboarding-dot').forEach((dot,i) => {
        dot.classList.toggle('active', i === idx);
    });
    const btn = document.getElementById('onboardingNext');
    if (idx >= onboardingPasos.length - 1) {
        btn.textContent = <?= json_encode($t[$lang]['start'] ?? '¡Comenzar!') ?>;
    } else {
        btn.textContent = <?= json_encode($t[$lang]['next'] ?? 'Siguiente') ?>;
    }
}
function siguientePaso() {
    if (pasoActual >= onboardingPasos.length - 1) {
        cerrarOnboarding();
    } else {
        mostrarPaso(pasoActual + 1);
    }
}
function saltarOnboarding() { cerrarOnboarding(); }
function cerrarOnboarding() {
    document.getElementById('onboardingOverlay').remove();
    localStorage.setItem('lc_onboarding_visto', '1');
    // Marcar badge "Primer Paso" en DB
    fetch('src/Core/funciones.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: new URLSearchParams({
            accion: 'completar_onboarding',
            csrf_token: document.querySelector('meta[name="csrf-token"]')?.content || ''
        })
    }).catch(()=>{});
}
</script>
<?php endif; ?>

<!-- ===== HEADER ===== -->
<header class="header">
    <div>
        <span class="logo-text">LC-ADVANCE</span>
        <span class="logo-tag">// SYSTEM_DASHBOARD</span>
    </div>
    <nav>
        <?php $tipo_usuario = $_SESSION['usuario_tipo'] ?? ''; ?>
        <a href="../index.php"      class="btn-nav"><span class="nav-icon">🏠</span><span class="nav-label"><?= htmlspecialchars($t[$lang]['home']) ?></span></a>
        <?php if ($tipo_usuario !== 'teacher' && $tipo_usuario !== 'admin'): ?>
        <a href="mapa/index.php" class="btn-nav primary"><span class="nav-icon">🗺️</span><span class="nav-label"><?= htmlspecialchars($t[$lang]['go_map']) ?></span></a>
        <?php endif; ?>
        
        <a href="lab.php<?= htmlspecialchars($dashboard_context_params) ?>" class="btn-nav"><span class="nav-icon">🧪</span><span class="nav-label"><?= htmlspecialchars($t[$lang]['coding_lab']) ?></span></a>
        <a href="community.php<?= htmlspecialchars($dashboard_context_params) ?>" class="btn-nav"><span class="nav-icon">👥</span><span class="nav-label"><?= htmlspecialchars($t[$lang]['community']) ?></span></a>
        <a href="perfil.php"     class="btn-nav"><span class="nav-icon">⚙️</span><span class="nav-label"><?= htmlspecialchars($t[$lang]['profile'] ?? 'Perfil') ?></span></a>
        <?php $tipo_usuario = $_SESSION['usuario_tipo'] ?? ''; ?>
        <?php if ($tipo_usuario === 'teacher' || $tipo_usuario === 'admin'): ?>
        <a href="panel_docente.php" class="btn-nav"><span class="nav-icon">👨‍🏫</span><span class="nav-label"><?= htmlspecialchars($t[$lang]['teacher_panel'] ?? 'Panel Docente') ?></span></a>
        <?php endif; ?>
        <?php if ($tipo_usuario === 'admin'): ?>
        <a href="admin/index.php" class="btn-nav"><span class="nav-icon">🛡️</span><span class="nav-label">Admin</span></a>
        <?php endif; ?>
        <a href="logout.php"     class="btn-nav"><span class="nav-icon">🔓</span><span class="nav-label"><?= htmlspecialchars($t[$lang]['logout']) ?></span></a>
        <div style="position:relative;display:inline-block;">
            <button class="notif-btn" id="notifBtn" onclick="toggleNotif()" aria-label="<?= htmlspecialchars($t[$lang]['notifications'] ?? 'Notificaciones') ?>">
                🔔<?php if ($notif_no_leidas > 0): ?><span class="notif-badge"><?= $notif_no_leidas > 9 ? '9+' : $notif_no_leidas ?></span><?php endif; ?>
            </button>
            <div class="notif-dropdown" id="notifDropdown">
                <div class="notif-header">
                    <span><?= htmlspecialchars($t[$lang]['notifications'] ?? 'Notificaciones') ?></span>
                    <?php if ($notif_no_leidas > 0): ?><button onclick="marcarLeidas()" aria-label="<?= htmlspecialchars($t[$lang]['mark_read'] ?? 'Leer todas') ?>"><?= htmlspecialchars($t[$lang]['mark_read'] ?? 'Leer todas') ?></button><?php endif; ?>
                </div>
                <?php if (empty($notificaciones_lista)): ?>
                    <div class="notif-empty"><?= htmlspecialchars($t[$lang]['no_notifications'] ?? 'Sin notificaciones') ?></div>
                <?php else: ?>
                    <?php foreach ($notificaciones_lista as $n): ?>
                        <div class="notif-item <?= $n['leida'] ? '' : 'unread' ?>" data-id="<?= $n['id'] ?>" onclick="clickNotif(<?= $n['id'] ?>)">
                            <div class="notif-titulo"><?= htmlspecialchars($n['titulo']) ?></div>
                            <?php if ($n['mensaje']): ?><div class="notif-mensaje"><?= htmlspecialchars($n['mensaje']) ?></div><?php endif; ?>
                            <div class="notif-tiempo"><?= date('d/m H:i', strtotime($n['created_at'])) ?></div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
        <div class="header-volume">
            <button class="vol-btn" id="volBtn">🔊</button>
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
            <button class="dark-toggle" aria-label="Alternar tema" title="Alternar tema">🌓</button>
        </div>
    </nav>
</header>

<!-- ===== MAIN ===== -->
<?php if (empty($_SESSION['usuario_es_invitado']) && empty($usuario['email_verified']) && !empty($usuario['correo'])): ?>
<div class="verify-banner">
    <span>📧 Verifica tu correo electrónico (<strong><?= htmlspecialchars($usuario['correo']) ?></strong>) para activar todas las funciones.</span>
    <button onclick="reenviarVerificacion()" class="verify-btn">Reenviar verificación</button>
</div>
<?php endif; ?>

<?php
// Mostrar anuncios activos del sistema
try {
    $ann_stmt = $pdo->query("SELECT * FROM announcements WHERE activo = 1 ORDER BY created_at DESC");
    $anuncios = $ann_stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) { $anuncios = []; }
if ($anuncios):
?>
<div style="display:flex;flex-direction:column;gap:8px;margin-bottom:16px">
<?php foreach ($anuncios as $ann): ?>
<div class="alert alert-<?= htmlspecialchars($ann['tipo']) ?>" style="margin-bottom:0">
  <strong><?= htmlspecialchars($ann['titulo']) ?></strong>
  <span style="margin-left:8px"><?= htmlspecialchars($ann['contenido']) ?></span>
</div>
<?php endforeach; ?>
</div>
<?php endif; ?>

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
                    <div class="chip">
                        <div class="chip-label">Racha 🔥</div>
                        <div class="chip-val <?= $racha_data['racha'] >= 7 ? 'gold' : 'cyan' ?>"><?= (int)$racha_data['racha'] ?> <?= $racha_data['hoy'] ? 'días' : '☀️' ?></div>
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

                <?php if ($tipo_usuario !== 'teacher' && $tipo_usuario !== 'admin'): ?>
                <div class="card-label">Logros desbloqueados <a href="logros.php" class="ver-todos">Ver todos →</a></div>
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
                <?php endif; ?>

                <a href="ranking.php" class="btn-full">Ver Ranking Global</a>
            </div>

            <?php if ($tipo_usuario === 'student' && !empty($_SESSION['usuario_id'])): ?>
            <!-- Unirse a Grupo / Mis Grupos -->
            <div class="card reveal">
                <div class="card-label">📚 Lecciones asignadas</div>
                <?php if (!empty($assignedSlugs)): ?>
                    <p style="color:var(--muted);font-size:11px;font-family:var(--font-mono);margin-bottom:8px;">Estas son las lecciones que tus profesores asignaron al grupo. Solo podrás ver estas lecciones hasta que se asignen más.</p>
                    <ul style="list-style:none;margin:0 0 10px;padding:0;">
                        <?php foreach ($assignedLessonsByGroup as $groupId => $groupData): ?>
                            <li style="padding:10px 12px;background:var(--surface2);border-radius:8px;margin-bottom:8px;font-size:11px;">
                                <div style="font-weight:600;color:var(--cyan);margin-bottom:4px;"><?= htmlspecialchars($groupData['grupo_nombre']) ?></div>
                                <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(120px,1fr));gap:6px;">
                                    <?php foreach ($groupData['slugs'] as $slug): $lesson = buscarLeccion($slug); ?>
                                        <span style="background:rgba(255,255,255,0.06);padding:6px 8px;border-radius:6px;font-size:10px;"><?= htmlspecialchars($lesson['titulo'] ?? $slug) ?></span>
                                    <?php endforeach; ?>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php elseif (!empty($student_groups)): ?>
                    <p style="color:var(--muted);font-size:11px;font-family:var(--font-mono);margin-bottom:8px;">Aún no hay lecciones asignadas en tus grupos. Pide al profesor que asigne temas usando el panel docente.</p>
                <?php else: ?>
                    <p style="color:var(--muted);font-size:11px;font-family:var(--font-mono);margin-bottom:8px;">Únete a un grupo con el código de tu profesor para conectar tu aprendizaje con sus asignaciones.</p>
                <?php endif; ?>
            </div>
            <div class="card reveal">
                <div class="card-label">📚 Mis Grupos</div>
                <?php if ($join_group_ok): ?>
                    <div style="color:var(--green);font-size:11px;font-family:var(--font-mono);margin-bottom:8px;"><?= $join_group_ok ?></div>
                <?php endif; ?>
                <?php if ($join_group_error): ?>
                    <div style="color:var(--pink);font-size:11px;font-family:var(--font-mono);margin-bottom:8px;"><?= htmlspecialchars($join_group_error) ?></div>
                <?php endif; ?>
                <?php if (!empty($student_groups)): ?>
                    <ul style="list-style:none;margin:0 0 10px;padding:0;">
                    <?php foreach ($student_groups as $g):
                        $gs = obtenerEstadisticasEstudianteEnGrupo((int)$g['id'], (int)$usuario['id']);
                    ?>
                        <li style="padding:8px 10px;background:var(--surface2);border-radius:8px;margin-bottom:6px;font-size:11px;font-family:var(--font-mono);">
                            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:4px;">
                                <span style="color:var(--cyan);font-weight:600;"><?= htmlspecialchars($g['nombre']) ?></span>
                                <span style="color:var(--yellow);font-size:9px;background:rgba(255,210,63,0.12);padding:2px 6px;border-radius:4px;">
                                    #<?= $gs['rank'] ?> de <?= $gs['total'] ?>
                                </span>
                            </div>
                            <div style="display:flex;gap:8px;align-items:center;">
                                <span style="color:var(--muted);font-size:9px;">📚 <?= $gs['lecciones'] ?> lecciones</span>
                                <div style="flex:1;height:4px;background:var(--border);border-radius:2px;overflow:hidden;">
                                    <div style="width:<?= $gs['pct'] ?>%;height:100%;background:linear-gradient(90deg,var(--cyan),var(--green));border-radius:2px;transition:width .5s;"></div>
                                </div>
                                <span style="color:var(--green);font-size:9px;"><?= $gs['pct'] ?>%</span>
                            </div>
                            <div style="color:var(--muted);font-size:9px;margin-top:3px;">👨‍🏫 <?= htmlspecialchars($g['profesor_nombre'] ?? '') ?></div>
                        </li>
                    <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p style="color:var(--muted);font-size:10px;font-family:var(--font-mono);margin-bottom:8px;">No estás en ningún grupo.</p>
                <?php endif; ?>
                <form method="post" style="display:flex;gap:6px;">
                    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(csrfToken()) ?>">
                    <input type="text" name="codigo_acceso" placeholder="Código del grupo" required
                           style="flex:1;padding:6px 8px;font-family:var(--font-mono);font-size:10px;background:var(--surface2);border:1px solid var(--border);border-radius:4px;color:var(--text);text-transform:uppercase;">
                    <button type="submit" name="action_join_group" value="1"
                            style="padding:6px 10px;font-family:var(--font-mono);font-size:9px;background:var(--cyan);color:#060a12;border:none;border-radius:4px;cursor:pointer;white-space:nowrap;">Unirse</button>
                </form>
            </div>
            <?php endif; ?>

            <?php if ($tipo_usuario === 'teacher' || $tipo_usuario === 'admin'): ?>
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

                <a href="panel_docente.php" class="btn-full" style="margin-top:12px;">👨‍🏫 Ir al Panel Docente</a>
            </div>
            <?php endif; ?>

        </div><!-- /profile-sidebar -->


        <!-- ══════════════════════════
             COLUMNA DERECHA
        ══════════════════════════ -->
        <div class="main-dashboard">

            <?php if ($tipo_usuario !== 'teacher' && $tipo_usuario !== 'admin'): ?>
            <!-- Progreso por materia -->
            <div class="card section-card reveal">
                <div class="card-label"><?= htmlspecialchars($t[$lang]['subject_progress'] ?? 'Progreso por materia') ?></div>
                <div class="chart-wrapper" style="height:240px;">
                    <canvas id="subjectProgressChart"></canvas>
                </div>
            </div>
            <?php endif; ?>

            <?php if ($tipo_usuario === 'teacher' || $tipo_usuario === 'admin'): ?>
            <!-- Gráfica de rendimiento (docente) -->
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
                    <label for="fecha-desde">
                        <?= htmlspecialchars($t[$lang]['from']) ?>
                        <input type="date" id="fecha-desde" name="desde" value="<?= htmlspecialchars($fecha_desde) ?>" required>
                    </label>
                    <label for="fecha-hasta">
                        <?= htmlspecialchars($t[$lang]['to']) ?>
                        <input type="date" id="fecha-hasta" name="hasta" value="<?= htmlspecialchars($fecha_hasta) ?>" required>
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
            <?php endif; ?>

            <!-- Buscador -->
            <div class="search-wrapper reveal">
                <span class="search-icon">🔍</span>
                <input type="text" id="lessonSearch" class="search-input" aria-label="<?= htmlspecialchars($t[$lang]['search_placeholder']) ?>"
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

            <?php if ($tipo_usuario !== 'teacher' && $tipo_usuario !== 'admin'): ?>
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
                        <div class="quest-item" data-quest-id="<?= $quest['id'] ?>">
                            <div class="quest-info">
                                <span class="quest-title"><?= htmlspecialchars($quest['titulo'] ?? $quest['quest_type']) ?></span>
                                <span class="quest-progress-text"><?= (int)$quest['progreso'] ?>/<?= (int)$quest['objetivo'] ?></span>
                            </div>
                            <div class="quest-bar-wrapper">
                                <div class="quest-bar" style="width: <?= min(100, ($quest['objetivo'] > 0 ? ((int)$quest['progreso'] / (int)$quest['objetivo']) * 100 : 0)) ?>%"></div>
                            </div>
                            <div class="quest-actions">
                                <span class="quest-xp">+<?= (int)$quest['recompensa_xp'] ?> XP</span>
                                <?php if ($quest['completada'] && !$quest['reclamada']): ?>
                                    <button class="quest-claim-btn" onclick="reclamarMision(<?= (int)$quest['id'] ?>, this)"><?= htmlspecialchars($t[$lang]['claim'] ?? 'Reclamar') ?></button>
                                <?php elseif ($quest['reclamada']): ?>
                                    <span class="quest-claimed">✅</span>
                                <?php else: ?>
                                    <span class="quest-status <?= $quest['completada'] ? 'done' : '' ?>"><?= $quest['completada'] ? htmlspecialchars($t[$lang]['completed']) : htmlspecialchars($t[$lang]['pending']) ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>

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
                <?php if ($tipo_usuario !== 'teacher' && $tipo_usuario !== 'admin' && ($filter_materia || !empty($filter_materias) || $filter_profesor)): ?>
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
                            : (empty($assignedSlugs)
                                ? htmlspecialchars($t[$lang]['empty_modules'])
                                : 'No hay lecciones asignadas según tu grupo.') ?>
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

<script src="<?= assetUrl('assets/js/loader.js') ?>"></script>
<script src="<?= assetUrl('assets/js/app.js') ?>"></script>

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

// ── Progreso por materia ──────────────────────────────────────────────────
(function () {
    const canvas = document.getElementById('subjectProgressChart');
    if (!canvas) return;

    const subjects = <?= json_encode(array_column($materias_completadas_usuario, 'materia')) ?>;
    const completed = <?= json_encode(array_map(fn($m) => $m['completadas'], $materias_completadas_usuario)) ?>;
    const totals   = <?= json_encode(array_map(fn($m) => $m['total'], $materias_completadas_usuario)) ?>;

    new Chart(canvas, {
        type: 'bar',
        data: {
            labels: subjects,
            datasets: [
                {
                    label: 'Completadas',
                    data: completed,
                    backgroundColor: 'rgba(0, 229, 255, 0.6)',
                    borderColor:     'rgba(0, 229, 255, 0.9)',
                    borderWidth: 1,
                    borderRadius: 4,
                },
                {
                    label: 'Total',
                    data: totals,
                    backgroundColor: 'rgba(255, 255, 255, 0.08)',
                    borderColor:     'rgba(255, 255, 255, 0.2)',
                    borderWidth: 1,
                    borderRadius: 4,
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { color: 'rgba(200,230,255,0.45)', font: { size: 11, family: "'JetBrains Mono'" }, stepSize: 1 },
                    grid: { color: 'rgba(255,255,255,0.04)' },
                    border: { color: 'rgba(255,255,255,0.06)' }
                },
                x: {
                    ticks: { color: 'rgba(200,230,255,0.45)', font: { size: 9, family: "'JetBrains Mono'" }, maxRotation: 45 },
                    grid:  { color: 'rgba(255,255,255,0.03)' },
                    border: { color: 'rgba(255,255,255,0.06)' }
                }
            },
            plugins: {
                legend: { labels: { color: 'rgba(200,230,255,0.6)', font: { size: 11, family: "'JetBrains Mono'" } } }
            }
        }
    });
})();

// ─── RECLAMAR MISION ────────────────────────────────────────────────────
// ─── NOTIFICACIONES ──────────────────────────────────────────────────
function toggleNotif() {
    const d = document.getElementById('notifDropdown');
    d.classList.toggle('show');
}
function clickNotif(id) {
    fetch('src/Core/funciones.php', {
        method: 'POST',
        headers: {'Content-Type':'application/x-www-form-urlencoded'},
        body: new URLSearchParams({
            accion: 'leer_notificacion',
            notif_id: id,
            csrf_token: document.querySelector('meta[name="csrf-token"]')?.content || ''
        })
    }).catch(()=>{});
    const item = document.querySelector(`.notif-item[data-id="${id}"]`);
    if (item) item.classList.remove('unread');
}
function marcarLeidas() {
    fetch('src/Core/funciones.php', {
        method: 'POST',
        headers: {'Content-Type':'application/x-www-form-urlencoded'},
        body: new URLSearchParams({
            accion: 'leer_todas_notificaciones',
            csrf_token: document.querySelector('meta[name="csrf-token"]')?.content || ''
        })
    }).then(r=>r.json()).then(() => {
        document.querySelectorAll('.notif-item').forEach(el => el.classList.remove('unread'));
        const badge = document.querySelector('.notif-badge');
        if (badge) badge.remove();
    }).catch(()=>{});
}
// Cerrar dropdown al hacer clic fuera
document.addEventListener('click', function(e) {
    const d = document.getElementById('notifDropdown');
    const b = document.getElementById('notifBtn');
    if (d && b && !d.contains(e.target) && !b.contains(e.target)) {
        d.classList.remove('show');
    }
});

function reclamarMision(questId, btn) {
    btn.disabled = true;
    btn.textContent = '...';
    fetch('src/Core/funciones.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: new URLSearchParams({
            accion: 'reclamar_mision',
            quest_id: questId,
            csrf_token: document.querySelector('meta[name="csrf-token"]')?.content || ''
        })
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            const item = btn.closest('.quest-item');
            item.classList.add('completada');
            btn.outerHTML = '<span class="quest-claimed">✅</span>';
            mostrarToast('+' + data.xp_ganado + ' XP ' + (<?= json_encode($t[$lang]['daily_quests'] ?? 'Daily quests') ?>));
        } else {
            btn.disabled = false;
            btn.textContent = 'Reclamar';
        }
    })
    .catch(() => { btn.disabled = false; btn.textContent = 'Reclamar'; });
}
function reenviarVerificacion() {
    const btn = document.querySelector('.verify-btn');
    if (btn) btn.disabled = true;
    fetch('src/Core/funciones.php', {
        method: 'POST',
        headers: {'Content-Type':'application/x-www-form-urlencoded'},
        body: new URLSearchParams({
            accion: 'reenviar_verificacion',
            csrf_token: document.querySelector('meta[name="csrf-token"]')?.content || ''
        })
    }).then(r=>r.json()).then(d => {
        if (d.ok) mostrarToast('📧 Correo de verificación reenviado');
        else mostrarToast('❌ ' + (d.error || 'Error'));
        if (btn) btn.disabled = false;
    }).catch(() => { if (btn) btn.disabled = false; });
}
function mostrarToast(msg) {
    let t = document.getElementById('quest-toast');
    if (!t) {
        t = document.createElement('div');
        t.id = 'quest-toast';
        t.setAttribute('role', 'alert');
        t.style.cssText = 'position:fixed;bottom:30px;right:30px;background:var(--green);color:#000;padding:12px 24px;border-radius:12px;font-family:var(--font-mono);font-size:13px;font-weight:600;z-index:9999;opacity:0;transform:translateY(20px);transition:all 0.4s ease;box-shadow:0 0 30px rgba(0,255,135,0.3);';
        document.body.appendChild(t);
    }
    t.textContent = msg;
    t.style.opacity = '1';
    t.style.transform = 'translateY(0)';
    setTimeout(() => { t.style.opacity = '0'; t.style.transform = 'translateY(20px)'; }, 3000);
}
</script>

<?php
$page_volume = [
    'audioId' => 'dashboardMusic',
    'source' => 'assets/music/cuco_pantalla_inicio.mp3',
    'sliderId' => 'volPrincipalSlider',
    'btnId' => 'volBtn',
    'containerId' => 'volSlider',
    'channel' => 'principal',
    'defaultVol' => 0.5,
    'autoplay' => false,
];
require __DIR__ . '/../src/Templates/page_end.php';