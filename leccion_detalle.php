<?php
// ==========================================
// LC-ADVANCE - leccion_detalle.php (Con Sidebar de Progreso)
// ==========================================
require_once 'config/config.php';
requireLogin(true);
require_once 'src/content.php';

$user_id = $_SESSION['usuario_id'] ?? null;
$slug = $_GET['slug'] ?? '';

$leccion = null;
foreach ($lecciones as $l) {
    if ($l['slug'] === $slug) {
        $leccion = $l;
        break;
    }
}

if (!$leccion) {
    if (!empty($_GET['materia'])) {
        header('Location: dashboard.php?materia=' . urlencode($_GET['materia']) . '&error=leccion_no_encontrada');
    }
    else {
        header('Location: dashboard.php?error=leccion_no_encontrada');
    }
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM user_progress WHERE user_id = ? AND slug = ?");
$stmt->execute([$user_id, $slug]);
$progress = $stmt->fetch(PDO::FETCH_ASSOC);
$completed = $progress ? (bool)$progress['completed'] : false;
$old_score = $progress ? $progress['score'] : 0;

$NUM_PREGUNTAS_QUIZ = 10;
$quiz_pool = $leccion['quiz'] ?? [];
if (count($quiz_pool) > $NUM_PREGUNTAS_QUIZ) {
    shuffle($quiz_pool);
    $quiz_selected = array_slice($quiz_pool, 0, $NUM_PREGUNTAS_QUIZ);
}
else {
    $quiz_selected = $quiz_pool;
}
$NUM_PREGUNTAS_QUIZ_FINAL = count($quiz_selected);

$_SESSION['current_quiz'] = [
    'slug' => $slug,
    'preguntas' => $quiz_selected,
    'num_preguntas' => $NUM_PREGUNTAS_QUIZ_FINAL
];

$progress_percent = $NUM_PREGUNTAS_QUIZ_FINAL ? round(($old_score / $NUM_PREGUNTAS_QUIZ_FINAL) * 100) : 0;

$return_params = '';
if (!empty($_GET['profesor'])) {
    $return_params = '?profesor=' . urlencode($_GET['profesor']);
}
elseif (isset($_GET['materia']) && $_GET['materia'] !== '') {
    $return_params = '?materia=' . urlencode($_GET['materia']);
}

// Datos del usuario para la sidebar
$user_data = ['puntos' => 0, 'nivel' => 1, 'nombre' => 'Estudiante', 'progreso' => 0];
if ($user_id) {
    $stmt2 = $pdo->prepare("SELECT nombre, puntos, nivel FROM usuarios WHERE id = ?");
    $stmt2->execute([$user_id]);
    $row = $stmt2->fetch(PDO::FETCH_ASSOC);
    if ($row) {
        $user_data['nombre'] = $row['nombre'] ?? 'Estudiante';
        $user_data['puntos'] = (int)($row['puntos'] ?? 0);
        $user_data['nivel'] = (int)($row['nivel'] ?? 1);
        $user_data['progreso'] = min(100, round(($user_data['puntos'] % 500) / 5));
    }
}

// Lecciones completadas (para lista de progreso en sidebar)
$completed_slugs = [];
if ($user_id) {
    $stmt3 = $pdo->query("SELECT slug FROM user_progress WHERE user_id = $user_id AND completed = 1");
    $completed_slugs = array_column($stmt3->fetchAll(PDO::FETCH_ASSOC), 'slug');
}

// Lecciones de la misma materia (para navegación en sidebar)
$materia_actual = $leccion['materia'] ?? '';
$lecciones_materia = array_filter($lecciones, fn($l) => ($l['materia'] ?? '') === $materia_actual);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <title><?php echo htmlspecialchars($leccion['titulo']); ?> | LC-ADVANCE</title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700&family=Roboto+Mono:wght@400;500&display=swap" rel="stylesheet">
    <script>
      MathJax = { tex: { inlineMath: [['$', '$'], ['\\(', '\\)']] }, svg: { fontCache: 'global' } };
    </script>
    <script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-svg.js" async></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=es6"></script>
    <script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        /* ======= LAYOUT CON SIDEBAR ======= */
        :root {
            --sidebar-w: 315px;
            --neon-cyan: #00ffff;
            --neon-pink: #ff00ff;
            --neon-yellow: #ffff00;
            --neon-green: #39ff14;
            --bg-dark: #0a0a0f;
            --bg-panel: rgba(0,255,255,0.04);
            --border-glow: rgba(0,255,255,0.25);
        }

        .page-wrapper {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Layout principal: sidebar + contenido */
        .content-wrapper {
            display: flex;
            flex: 1;
            gap: 0;
            align-items: flex-start;
            min-height: calc(100vh - 64px);
        }

        /* ======= SIDEBAR ======= */
        .lesson-sidebar {
            width: var(--sidebar-w);
            min-width: var(--sidebar-w);
            max-width: var(--sidebar-w);
            background: linear-gradient(180deg, rgba(0,0,0,0.95) 0%, rgba(0,10,20,0.98) 100%);
            border-right: 1px solid var(--border-glow);
            min-height: calc(100vh - 64px);
            padding: 1.2rem 1rem;
            display: flex;
            flex-direction: column;
            gap: 1rem;
            position: fixed;
            top: 64px;
            overflow-y: auto;
            z-index: 10;
            scrollbar-width: thin;
            scrollbar-color: var(--neon-cyan) transparent;
            height: calc(100vh - 64px);
        }

        .lesson-sidebar::-webkit-scrollbar { width: 4px; }
        .lesson-sidebar::-webkit-scrollbar-thumb { background: var(--neon-cyan); border-radius: 2px; }

        /* Tarjeta de usuario */
        .sidebar-user-card {
            background: var(--bg-panel);
            border: 1px solid var(--border-glow);
            padding: 1rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .sidebar-user-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 2px;
            background: linear-gradient(90deg, transparent, var(--neon-cyan), transparent);
        }

        .sidebar-avatar {
            width: 56px;
            height: 56px;
            background: linear-gradient(135deg, var(--neon-cyan), var(--neon-pink));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.6rem;
            margin: 0 auto 0.6rem;
            box-shadow: 0 0 16px rgba(0,255,255,0.4);
        }

        .sidebar-username {
            font-family: 'Orbitron', sans-serif;
            font-size: 0.7rem;
            color: var(--neon-cyan);
            letter-spacing: 0.1em;
            text-transform: uppercase;
            margin-bottom: 0.2rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .sidebar-level-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            background: rgba(255,255,0,0.1);
            border: 1px solid var(--neon-yellow);
            color: var(--neon-yellow);
            font-family: 'Orbitron', sans-serif;
            font-size: 0.6rem;
            padding: 0.2rem 0.6rem;
            letter-spacing: 0.08em;
            margin-top: 0.4rem;
        }

        /* XP Bar */
        .sidebar-xp-block {
            margin-top: 0.8rem;
        }
        .sidebar-xp-label {
            display: flex;
            justify-content: space-between;
            font-family: 'Roboto Mono', monospace;
            font-size: 0.6rem;
            color: rgba(0,255,255,0.6);
            margin-bottom: 0.3rem;
        }
        .sidebar-xp-bar {
            height: 6px;
            background: rgba(255,255,255,0.08);
            border-radius: 3px;
            overflow: hidden;
            position: relative;
        }
        .sidebar-xp-fill {
            height: 100%;
            border-radius: 3px;
            background: linear-gradient(90deg, var(--neon-cyan), var(--neon-pink));
            transition: width 0.8s cubic-bezier(0.4,0,0.2,1);
            box-shadow: 0 0 8px rgba(0,255,255,0.5);
        }

        /* Puntos totales */
        .sidebar-points {
            font-family: 'Roboto Mono', monospace;
            font-size: 0.65rem;
            color: rgba(255,255,255,0.5);
            text-align: center;
            margin-top: 0.4rem;
        }
        .sidebar-points strong {
            color: var(--neon-green);
        }

        /* ======= SECCIONES SIDEBAR ======= */
        .sidebar-section {
            border: 1px solid var(--border-glow);
            background: var(--bg-panel);
        }

        .sidebar-section-title {
            font-family: 'Orbitron', sans-serif;
            font-size: 0.55rem;
            letter-spacing: 0.15em;
            color: rgba(0,255,255,0.5);
            text-transform: uppercase;
            padding: 0.5rem 0.8rem;
            border-bottom: 1px solid var(--border-glow);
            display: flex;
            align-items: center;
            gap: 0.4rem;
        }

        /* Esta lección */
        .sidebar-current-lesson {
            padding: 0.7rem 0.8rem;
        }
        .sidebar-current-lesson .lesson-name {
            font-family: 'Orbitron', sans-serif;
            font-size: 0.6rem;
            color: var(--neon-cyan);
            line-height: 1.4;
            margin-bottom: 0.5rem;
        }
        .sidebar-current-lesson .lesson-subject {
            font-family: 'Roboto Mono', monospace;
            font-size: 0.55rem;
            color: rgba(255,255,255,0.4);
            text-transform: uppercase;
            letter-spacing: 0.1em;
        }

        /* Puntuación actual */
        .sidebar-score-display {
            padding: 0.7rem 0.8rem;
        }
        .score-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 0.5rem;
        }
        .score-value {
            font-family: 'Orbitron', sans-serif;
            font-size: 1.1rem;
            color: var(--neon-yellow);
            text-shadow: 0 0 10px rgba(255,255,0,0.4);
        }
        .score-max {
            font-family: 'Roboto Mono', monospace;
            font-size: 0.6rem;
            color: rgba(255,255,255,0.3);
        }
        .score-pct-bar {
            height: 4px;
            background: rgba(255,255,255,0.08);
            border-radius: 2px;
            margin-top: 0.5rem;
            overflow: hidden;
        }
        .score-pct-fill {
            height: 100%;
            background: linear-gradient(90deg, var(--neon-yellow), var(--neon-green));
            border-radius: 2px;
            box-shadow: 0 0 6px rgba(255,255,0,0.4);
            transition: width 0.8s ease;
        }
        .score-status {
            font-family: 'Roboto Mono', monospace;
            font-size: 0.55rem;
            margin-top: 0.4rem;
            color: <?php echo $completed ? 'var(--neon-green)' : 'rgba(255,255,255,0.3)'; ?>;
        }

        /* Navegación de lecciones de la materia */
        .sidebar-nav-list {
            padding: 0.4rem 0;
            max-height: 240px;
            overflow-y: auto;
            scrollbar-width: none;
        }
        .sidebar-nav-list::-webkit-scrollbar { display: none; }

        .sidebar-nav-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.45rem 0.8rem;
            text-decoration: none;
            font-family: 'Roboto Mono', monospace;
            font-size: 0.58rem;
            color: rgba(255,255,255,0.45);
            border-left: 2px solid transparent;
            transition: all 0.18s;
            line-height: 1.3;
        }
        .sidebar-nav-item:hover {
            color: var(--neon-cyan);
            border-left-color: var(--neon-cyan);
            background: rgba(0,255,255,0.04);
        }
        .sidebar-nav-item.active {
            color: var(--neon-cyan);
            border-left-color: var(--neon-cyan);
            background: rgba(0,255,255,0.07);
        }
        .sidebar-nav-item.done .nav-dot {
            background: var(--neon-green);
            box-shadow: 0 0 4px var(--neon-green);
        }
        .nav-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: rgba(255,255,255,0.2);
            flex-shrink: 0;
        }
        .nav-dot.active-dot {
            background: var(--neon-cyan);
            box-shadow: 0 0 6px var(--neon-cyan);
        }

        /* Botón quiz en sidebar */
        .sidebar-quiz-btn {
            width: 100%;
            background: linear-gradient(135deg, rgba(0,255,255,0.08), rgba(255,0,255,0.08));
            border: 1px solid var(--neon-cyan);
            color: var(--neon-cyan);
            font-family: 'Orbitron', sans-serif;
            font-size: 0.6rem;
            letter-spacing: 0.1em;
            padding: 0.7rem;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }
        .sidebar-quiz-btn:hover {
            background: rgba(0,255,255,0.15);
            box-shadow: 0 0 16px rgba(0,255,255,0.25);
            transform: translateY(-1px);
        }

        /* Botón volver en sidebar */
        .sidebar-back-btn {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            text-decoration: none;
            color: rgba(255,255,255,0.35);
            font-family: 'Roboto Mono', monospace;
            font-size: 0.58rem;
            padding: 0.5rem 0.3rem;
            transition: color 0.18s;
            border-top: 1px solid var(--border-glow);
            padding-top: 0.7rem;
            margin-top: auto;
        }
        .sidebar-back-btn:hover { color: var(--neon-cyan); }

        /* ======= ÁREA DE CONTENIDO ======= */
        .lesson-area {
            flex: 1;
            min-width: 0;
            padding: 1.5rem 2rem;
            margin-left: var(--sidebar-w); /* Margen izquierdo igual al ancho del sidebar */
        }

        /* Quitar full-width cuando hay sidebar */
        .lesson-main {
            width: 100% !important;
            max-width: 100% !important;
            padding: 0 !important;
            margin: 0 !important;
        }

        .main-content {
            padding: 0 !important;
            max-width: 100% !important;
        }

        /* Sidebar toggle en móvil */
        .sidebar-toggle {
            display: none;
            position: fixed;
            bottom: 80px;
            left: 12px;
            z-index: 500;
            background: var(--bg-dark);
            border: 1px solid var(--neon-cyan);
            color: var(--neon-cyan);
            width: 40px;
            height: 40px;
            font-size: 1.1rem;
            cursor: pointer;
            align-items: center;
            justify-content: center;
        }

        @media (max-width: 900px) {
            .lesson-sidebar {
                position: fixed;
                left: -100%;
                top: 0;
                height: 100vh;
                min-height: 100vh;
                z-index: 200;
                transition: left 0.3s cubic-bezier(0.4,0,0.2,1);
                box-shadow: 4px 0 32px rgba(0,0,0,0.8);
            }
            .lesson-sidebar.open { left: 0; }
            .sidebar-toggle { display: flex; }
            .sidebar-overlay {
                display: none;
                position: fixed;
                inset: 0;
                background: rgba(0,0,0,0.6);
                z-index: 199;
            }
            .sidebar-overlay.active { display: block; }
             .lesson-area {
               margin-left: 0; /* Quitar margen en móvil */ 
            }
        }

        /* ORIENTACIÓN HORIZONTAL */
        @media screen and (orientation: portrait) {
            body::before {
                content: "🔄 POR FAVOR, GIRA TU DISPOSITIVO PARA UNA MEJOR EXPERIENCIA (MODO HORIZONTAL)";
                position: fixed; top: 0; left: 0; width: 100%; height: 100%;
                background: #000; color: #0ff; display: flex;
                justify-content: center; align-items: center;
                z-index: 99999; text-align: center; padding: 2rem;
                font-family: 'Orbitron', sans-serif; font-size: 1.5rem;
                border: 4px solid #f0f;
            }
            .page-wrapper { display: none !important; }
        }
    </style>
</head>
<body class="<?php echo($slug === 'contaminacion-ambiental') ? 'page-lesson-contaminacion' : ''; ?>">

<div class="page-wrapper">

    <header class="main-header">
        <div class="header-title">
            <h1>LC-ADVANCE <span class="access">ACCESS: ONLINE</span></h1>
        </div>
        <button class="hamburger" type="button" aria-label="Menu">☰</button>
        <nav class="header-nav">
            <a href="dashboard.php<?php echo $return_params; ?>" class="btn btn-nav">⬅️ Dashboard</a>
            <a href="ranking.php" class="btn btn-nav">🏆 Ranking</a>
            <a href="logout.php" class="btn btn-logout">🚪 Salir</a>
        </nav>
    </header>

    <!-- Overlay para cerrar sidebar en móvil -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <div class="content-wrapper">

        <!-- ======= SIDEBAR ======= -->
        <aside class="lesson-sidebar" id="lessonSidebar">

            <!-- Tarjeta de usuario -->
            <div class="sidebar-user-card">
                <div class="sidebar-avatar">🎮</div>
                <div class="sidebar-username"><?php echo htmlspecialchars($user_data['nombre']); ?></div>
                <div class="sidebar-level-badge">
                    ⚡ NIV <?php echo $user_data['nivel']; ?>
                </div>
                <div class="sidebar-xp-block">
                    <div class="sidebar-xp-label">
                        <span>XP</span>
                        <span class="percent"><?php echo $user_data['progreso']; ?>%</span>
                    </div>
                    <div class="sidebar-xp-bar">
                        <div class="sidebar-xp-fill progress-fill" style="width: <?php echo $user_data['progreso']; ?>%"></div>
                    </div>
                </div>
                <div class="sidebar-points">
                    PUNTOS TOTALES: <strong><?php echo number_format($user_data['puntos']); ?></strong>
                </div>
            </div>

            <!-- Lección actual -->
            <div class="sidebar-section">
                <div class="sidebar-section-title">📍 LECCIÓN ACTUAL</div>
                <div class="sidebar-current-lesson">
                    <div class="lesson-name"><?php echo htmlspecialchars($leccion['titulo']); ?></div>
                    <div class="lesson-subject"><?php echo htmlspecialchars($materia_actual); ?></div>
                </div>
            </div>

            <!-- Puntuación de esta lección -->
            <div class="sidebar-section">
                <div class="sidebar-section-title">🏅 TU PUNTUACIÓN</div>
                <div class="sidebar-score-display">
                    <div class="score-row">
                        <span class="score-value" id="sidebar-score"><?php echo $old_score; ?></span>
                        <span class="score-max">/ <?php echo $NUM_PREGUNTAS_QUIZ_FINAL; ?></span>
                    </div>
                    <div class="score-pct-bar">
                        <div class="score-pct-fill" style="width: <?php echo $progress_percent; ?>%"></div>
                    </div>
                    <div class="score-status">
                        <?php echo $completed ? '✔ COMPLETADA' : '○ PENDIENTE'; ?>
                    </div>
                </div>
            </div>

            <!-- Botón quiz -->
            <button class="sidebar-quiz-btn open-quiz-btn">
                🧠 <?php echo $completed ? 'REPETIR QUIZ' : 'INICIAR QUIZ'; ?>
            </button>

            <!-- Otras lecciones de la misma materia -->
            <?php if (count($lecciones_materia) > 1): ?>
            <div class="sidebar-section">
                <div class="sidebar-section-title">📚 <?php echo htmlspecialchars(strtoupper($materia_actual)); ?></div>
                <div class="sidebar-nav-list">
                    <?php foreach ($lecciones_materia as $lm):
        $is_current = $lm['slug'] === $slug;
        $is_done = in_array($lm['slug'], $completed_slugs);
        $classes = 'sidebar-nav-item' . ($is_current ? ' active' : '') . ($is_done ? ' done' : '');
        $nav_params = $return_params ?: '';
        $href = "leccion_detalle.php?slug=" . urlencode($lm['slug']) . ($nav_params ? '&' . ltrim($nav_params, '?') : '');
?>
                    <a href="<?php echo $is_current ? '#' : htmlspecialchars($href); ?>"
                       class="<?php echo $classes; ?>">
                        <span class="nav-dot <?php echo $is_current ? 'active-dot' : ''; ?>"></span>
                        <?php echo htmlspecialchars($lm['titulo']); ?>
                    </a>
                    <?php
    endforeach; ?>
                </div>
            </div>
            <?php
endif; ?>

            <!-- Volver al dashboard -->
            <a href="dashboard.php<?php echo $return_params; ?>" class="sidebar-back-btn back-dashboard-btn">
                ← VOLVER AL DASHBOARD
            </a>

        </aside><!-- /sidebar -->

        <!-- ======= ÁREA DE CONTENIDO ======= -->
        <div class="lesson-area">
            <section class="lesson-main">
                <h2 class="module-title">MÓDULO DE APRENDIZAJE</h2>

                <div class="tabs">
                    <button class="tab-btn active" data-tab="content">📚 CONTENIDO</button>
                    <button class="tab-btn" data-tab="quiz">🧠 <?php echo $completed ? 'REPETIR QUIZ' : 'INICIAR QUIZ'; ?></button>
                </div>

                <div id="content-panel" class="panel">
                    <div class="lesson-header">
                        <div class="lesson-title-row">
                            <?php echo $leccion['icon'] ?? '<span class="icon-tema">💾</span>'; ?>
                            <h3 class="lesson-title"><?php echo htmlspecialchars($leccion['titulo']); ?></h3>
                        </div>
                        <span class="lesson-materia"><?php echo htmlspecialchars($leccion['materia']); ?></span>
                        <p class="previous-score">
                            Puntuación anterior: <strong><?php echo $old_score; ?></strong> / <?php echo $NUM_PREGUNTAS_QUIZ_FINAL; ?>
                        </p>
                    </div>

                    <div class="lesson-content">
                        <?php echo $leccion['contenido']; ?>
                    </div>

                    <div class="lesson-actions">
                        <button class="btn btn-primary btn-small open-quiz-btn">🧠 INICIAR QUIZ</button>
                        <a href="dashboard.php<?php echo $return_params; ?>#leccion-<?php echo htmlspecialchars($slug); ?>"
                           class="btn btn-secondary btn-small back-dashboard-btn">
                           ↩️ VOLVER AL DASHBOARD
                        </a>
                    </div>
                </div>
            </section>
        </div><!-- /lesson-area -->

    </div><!-- /content-wrapper -->

    <!-- MODAL QUIZ -->
    <div id="quiz-overlay" class="overlay hidden">
        <div class="quiz-modal">
            <div class="quiz-header">
                <h3>🧠 Quiz: <?php echo htmlspecialchars($leccion['titulo']); ?></h3>
                <button class="close-btn" aria-label="Cerrar quiz">✖</button>
            </div>
            <div id="quiz-content" class="quiz-body">
                <div class="loading">Cargando preguntas...</div>
            </div>
        </div>
    </div>

    <!-- Toggle sidebar móvil -->
    <button class="sidebar-toggle" id="sidebarToggle" aria-label="Abrir panel">◀</button>

    <button id="scroll-top" class="scroll-top-btn" aria-label="Subir">▲</button>

</div><!-- /page-wrapper -->

<script>
document.addEventListener('DOMContentLoaded', () => {
    const quizOverlay    = document.getElementById('quiz-overlay');
    const quizContent    = document.getElementById('quiz-content');
    const openQuizBtns   = document.querySelectorAll('.open-quiz-btn');
    const closeBtn       = document.querySelector('.close-btn');
    const tabQuiz        = document.querySelector('.tab-btn[data-tab="quiz"]');
    const tabContent     = document.querySelector('.tab-btn[data-tab="content"]');
    const scrollTopBtn   = document.getElementById('scroll-top');
    const hamburger      = document.querySelector('.hamburger');
    const headerNav      = document.querySelector('.header-nav');
    const sidebar        = document.getElementById('lessonSidebar');
    const sidebarToggle  = document.getElementById('sidebarToggle');
    const sidebarOverlay = document.getElementById('sidebarOverlay');

    // ── Hamburger ──
    if (hamburger && headerNav) {
        hamburger.addEventListener('click', () => {
            headerNav.classList.toggle('active');
            hamburger.textContent = headerNav.classList.contains('active') ? '✖' : '☰';
        });
        document.addEventListener('click', (e) => {
            if (!hamburger.contains(e.target) && !headerNav.contains(e.target) && headerNav.classList.contains('active')) {
                headerNav.classList.remove('active');
                hamburger.textContent = '☰';
            }
        });
    }

    // ── Sidebar toggle (móvil) ──
    function openSidebar()  { sidebar.classList.add('open'); sidebarOverlay.classList.add('active'); sidebarToggle.textContent = '✖'; }
    function closeSidebar() { sidebar.classList.remove('open'); sidebarOverlay.classList.remove('active'); sidebarToggle.textContent = '◀'; }
    sidebarToggle.addEventListener('click', () => sidebar.classList.contains('open') ? closeSidebar() : openSidebar());
    sidebarOverlay.addEventListener('click', closeSidebar);

    const quizData = <?php echo json_encode($quiz_selected); ?>;

    // ── Scroll to top ──
    window.addEventListener('scroll', () => scrollTopBtn.classList.toggle('visible', window.scrollY > 400));
    scrollTopBtn.addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));

    // ── Abrir quiz ──
    openQuizBtns.forEach(btn => btn.addEventListener('click', openQuiz));
    if (tabQuiz) tabQuiz.addEventListener('click', openQuiz);

    function openQuiz() {
        quizOverlay.classList.remove('hidden');
        if (tabQuiz) tabQuiz.classList.add('active');
        tabContent.classList.remove('active');
        try {
            if (quizContent.querySelector('.loading')) renderQuiz();
        } catch (err) {
            console.error('Error al renderizar quiz:', err);
            quizContent.innerHTML = `<div class="result-panel"><strong>Error:</strong> No se pudo cargar el quiz.</div>`;
        }
    }

    // ── Cerrar quiz ──
    if (closeBtn) closeBtn.addEventListener('click', closeQuiz);
    quizOverlay.addEventListener('click', (e) => { if (e.target === quizOverlay) closeQuiz(); });
    function closeQuiz() {
        quizOverlay.classList.add('hidden');
        tabContent.classList.add('active');
        tabQuiz.classList.remove('active');
    }

    // ── Renderizar quiz ──
    function renderQuiz() {
        if (quizData.length === 0) {
            quizContent.innerHTML = '<p class="no-questions">No hay preguntas disponibles.</p>';
            return;
        }
        function escapeHtml(str) {
            return String(str).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;').replace(/'/g,'&#39;');
        }
        let html = '<form id="quiz-form" class="quiz-form">';
        quizData.forEach((q, i) => {
            const name = `q${i}`;
            const shuffled = [...q.opciones].sort(() => Math.random() - 0.5);
            html += `<div class="question-card"><p class="question-text"><strong>${i+1}.</strong> ${escapeHtml(q.pregunta)}</p><div class="options">`;
            shuffled.forEach((op, idx) => {
                html += `<label class="option-label"><input type="radio" name="${name}" value="${escapeHtml(op)}" ${idx===0?'required':''}><span class="radio-custom"></span><span class="option-text">${escapeHtml(op)}</span></label>`;
            });
            html += `</div></div>`;
        });
        html += `<div class="quiz-submit"><button type="submit" class="btn btn-submit">✅ Enviar y Calificar</button></div></form>`;
        quizContent.innerHTML = html;

        document.getElementById('quiz-form').addEventListener('submit', async (e) => {
            e.preventDefault();
            const form = e.target;
            let oldState = { puntos: 0, nivel: 1 };
            try {
                const s = await fetch('src/funciones.php', { method: 'POST', body: new URLSearchParams({ accion: 'obtener_estado' }) });
                oldState = await s.json();
            } catch (ex) { console.warn('No se pudo obtener estado previo', ex); }

            const formData = new FormData(form);
            formData.append('accion', 'calificar_quiz');
            formData.append('slug', '<?php echo addslashes($slug); ?>');

            try {
                const resp  = await fetch('src/funciones.php', { method: 'POST', body: formData });
                const data  = await resp.json();

                if (!data.ok) {
                    quizContent.innerHTML = `<div class="result-panel"><strong>Error:</strong> ${escapeHtml(data.mensaje || data.error || 'Error al calificar')}</div>`;
                    return;
                }

                const score = data.score || 0;
                const xp    = data.xp_ganado || 0;

                const stateResp = await fetch('src/funciones.php', { method: 'POST', body: new URLSearchParams({ accion: 'obtener_estado' }) });
                const state = await stateResp.json();

                // Actualizar sidebar en tiempo real
                updateSidebar(state, score);

                let detailHtml = '<div class="result-panel">';
                detailHtml += `<h4>Resultado</h4><p>Puntos correctos: <strong>${score}</strong> / ${quizData.length}</p>`;
                detailHtml += `<p>XP ganado: <strong>${xp}</strong></p>`;
                detailHtml += `<p>Nuevo total de puntos: <strong>${state.puntos ?? '—'}</strong></p>`;
                detailHtml += `<p>Nivel actual: <strong>${state.nivel ?? '—'}</strong></p>`;

                if (Array.isArray(data.details)) {
                    detailHtml += '<hr style="margin:0.6rem 0"><div class="details-list">';
                    data.details.forEach((d, idx) => {
                        const ok = d.acertada ? 'correct' : 'wrong';
                        detailHtml += `<div class="detail-item ${ok}">
                            <div class="detail-q"><strong>${idx+1}.</strong> ${escapeHtml(d.pregunta)}</div>
                            <div class="detail-a">Tu respuesta: <span class="user-answer">${escapeHtml(d.respuesta||'—')}</span></div>
                            ${d.acertada ? '<div class="detail-ok">✔ Correcto</div>' : `<div class="detail-wrong">✖ Incorrecto — Respuesta correcta: <strong>${escapeHtml(d.correcta)}</strong></div>`}
                        </div>`;
                    });
                    detailHtml += '</div>';
                }
                detailHtml += `<div style="margin-top:0.6rem"><button class="btn btn-primary" id="close-result">Cerrar</button></div></div>`;
                quizContent.innerHTML = detailHtml;

                if (xp > 0) {
                    const xpEl = document.createElement('div');
                    xpEl.className = 'xp-fly';
                    xpEl.textContent = `+${xp} XP`;
                    document.body.appendChild(xpEl);
                    setTimeout(() => xpEl.remove(), 2100);
                }
                if (state.nivel > (oldState.nivel || 1)) showToast(`¡Subiste al nivel ${state.nivel}! 🎉`);

                document.getElementById('close-result')?.addEventListener('click', closeQuiz);

            } catch (err) {
                console.error(err);
                quizContent.innerHTML = `<div class="result-panel"><strong>Error:</strong> No se pudo conectar con el servidor.</div>`;
            }
        });

        if (window.MathJax && MathJax.typesetPromise) MathJax.typesetPromise([quizContent]);
    }

    // ── Actualizar sidebar tras calificar ──
    function updateSidebar(state, score) {
        // XP bar
        const fill    = document.querySelector('.progress-fill');
        const percent = document.querySelector('.percent');
        if (fill && state.puntos !== undefined) {
            const pct = Math.round(state.progreso || ((state.puntos % 500) / 5));
            fill.style.width = pct + '%';
            if (percent) percent.textContent = pct + '%';
        }
        // Puntos totales
        const ptEl = document.querySelector('.sidebar-points strong');
        if (ptEl && state.puntos !== undefined) ptEl.textContent = state.puntos.toLocaleString();
        // Nivel
        const lvlEl = document.querySelector('.sidebar-level-badge');
        if (lvlEl && state.nivel) lvlEl.innerHTML = `⚡ NIV ${state.nivel}`;
        // Puntuación de esta lección
        const scoreEl = document.getElementById('sidebar-score');
        if (scoreEl) scoreEl.textContent = score;
        const pctFill = document.querySelector('.score-pct-fill');
        if (pctFill) pctFill.style.width = Math.round((score / <?php echo $NUM_PREGUNTAS_QUIZ_FINAL ?: 1; ?>) * 100) + '%';
        const statusEl = document.querySelector('.score-status');
        if (statusEl && score > 0) { statusEl.textContent = '✔ COMPLETADA'; statusEl.style.color = 'var(--neon-green)'; }
    }

    function showToast(message, timeout = 3000) {
        let container = document.querySelector('.toast-container');
        if (!container) { container = document.createElement('div'); container.className = 'toast-container'; document.body.appendChild(container); }
        const t = document.createElement('div');
        t.className = 'toast'; t.textContent = message; container.appendChild(t);
        setTimeout(() => { t.classList.add('hide'); setTimeout(() => t.remove(), 420); }, timeout);
    }

    if (window.MathJax && MathJax.typesetPromise) MathJax.typesetPromise();
});
</script>
<script src="assets/js/app.js"></script>
</body>
</html>