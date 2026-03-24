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
    $stmt2 = $pdo->prepare("SELECT nombre_usuario, puntos, nivel FROM usuarios WHERE id = ?");
    $stmt2->execute([$user_id]);
    $row = $stmt2->fetch(PDO::FETCH_ASSOC);
    if ($row) {
        $user_data['nombre'] = $row['nombre_usuario'] ?? 'Estudiante';
        $user_data['puntos'] = (int)($row['puntos'] ?? 0);
        $user_data['nivel'] = (int)($row['nivel'] ?? 1);
        $user_data['progreso'] = min(100, round(($user_data['puntos'] % 500) / 5));
    }
}

// Lecciones completadas (para lista de progreso en sidebar)
$completed_slugs = [];
if ($user_id) {
    $stmt3 = $pdo->prepare("SELECT slug FROM user_progress WHERE user_id = ? AND completed = 1");
    $stmt3->execute([$user_id]);
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
    <title><?php echo htmlspecialchars($leccion['titulo']); ?> | LC-ADVANCE</title>
    
    <!-- Fuentes premium -->
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&family=VT323&family=Orbitron:wght@400;700&family=Roboto+Mono:wght@400;700&display=swap" rel="stylesheet">
    
    <!-- MathJax y Chart.js -->
    <script>
      MathJax = { tex: { inlineMath: [['$', '$'], ['\\(', '\\)']] } };
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=es6"></script>
    <script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
    
    <link rel="stylesheet" href="assets/css/style.css">
    <?php
    // Carga el CSS específico de la lección si existe
    $css_leccion = "assets/css/leccion-{$slug}.css";
    if (file_exists(__DIR__ . '/' . $css_leccion)):
    ?>
    <link rel="stylesheet" href="<?php echo htmlspecialchars($css_leccion); ?>">
    <?php endif; ?>
    <style>
        /* ======= LAYOUT CON SIDEBAR ======= */
        :root {
            --sidebar-w: 320px;
            --header-h: 70px;
            --accent-glow: 0 0 30px rgba(0, 255, 255, 0.3);
            --card-bg: rgba(20, 20, 25, 0.7);
            --glass-bg: rgba(255, 255, 255, 0.03);
            --border-glass: rgba(255, 255, 255, 0.1);
            --transition-smooth: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            --neon-cyan: #00ffff;
            --neon-pink: #ff00ff;
            --neon-yellow: #ffff00;
            --neon-green: #39ff14;
            --bg-dark: #0a0a0f;
            --bg-panel: rgba(0,255,255,0.04);
            --border-glow: rgba(0,255,255,0.25);
        }

        body {
            background-color: #050508;
            color: #fff;
            overflow-x: hidden;
            font-family: 'Roboto Mono', monospace;
        }

        /* Animated Grid Background */
        .grid-bg {
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            background-image: 
                linear-gradient(rgba(0, 255, 255, 0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(0, 255, 255, 0.03) 1px, transparent 1px);
            background-size: 60px 60px;
            pointer-events: none;
            z-index: -1;
            mask-image: radial-gradient(circle at center, black, transparent 85%);
            animation: gridMove 25s linear infinite;
        }

        @keyframes gridMove {
            from { background-position: 0 0; }
            to { background-position: 0 60px; }
        }

        /* Layout */
        .page-wrapper {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            height: 100vh;
            overflow: hidden;
        }

        .main-header {
            height: var(--header-h);
            background: rgba(0, 0, 0, 0.8);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--border-glass);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 30px;
            flex-shrink: 0;
            z-index: 100;
        }

        .content-container {
            display: flex;
            flex: 1;
            gap: 0;
            align-items: stretch;
            width: 100%;
            height: calc(100vh - var(--header-h));
            overflow: hidden;
        }

        /* ======= SIDEBAR ======= */
        .lesson-sidebar {
            width: var(--sidebar-w);
            min-width: var(--sidebar-w);
            max-width: var(--sidebar-w);
            background: linear-gradient(180deg, rgba(0,0,0,0.95) 0%, rgba(0,10,20,0.98) 100%);
            border-right: 1px solid var(--border-glow);
            padding: 0.8rem 0.7rem;
            display: flex;
            flex-direction: column;
            gap: 0.6rem;
            height: 100%;
            overflow-y: auto;
            z-index: 10;
            scrollbar-width: thin;
            scrollbar-color: var(--neon-cyan) transparent;
        }

        .lesson-sidebar::-webkit-scrollbar { width: 4px; }
        .lesson-sidebar::-webkit-scrollbar-thumb { background: var(--neon-cyan); border-radius: 2px; }

        /* Tarjeta de usuario */
        .sidebar-user-card {
            background: var(--bg-panel);
            border: 1px solid var(--border-glow);
            border-radius: 12px;
            padding: 0.7rem;
            text-align: center;
            position: relative;
        }

        .sidebar-avatar {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, var(--neon-cyan), var(--neon-pink));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
            margin: 0 auto 0.4rem;
            box-shadow: 0 0 16px rgba(0,255,255,0.4);
        }

        .sidebar-username {
            font-family: 'Orbitron', sans-serif;
            font-size: 0.6rem;
            color: var(--neon-cyan);
            letter-spacing: 0.08em;
            text-transform: uppercase;
            margin-bottom: 0.15rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .sidebar-level-badge {
            display: inline-block;
            padding: 4px 12px;
            background: rgba(255, 255, 0, 0.1);
            border: 1px solid var(--neon-yellow);
            color: var(--neon-yellow);
            font-size: 10px;
            font-family: 'Press Start 2P', cursive;
            border-radius: 4px;
            margin-bottom: 5px;
        }

        /* XP Bar */
        .sidebar-xp-block {
            margin-top: 0.5rem;
        }
        .sidebar-xp-label {
            display: flex;
            justify-content: space-between;
            font-family: 'Roboto Mono', monospace;
            font-size: 0.55rem;
            color: rgba(0,255,255,0.6);
            margin-bottom: 0.2rem;
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
            font-size: 0.6rem;
            color: rgba(255,255,255,0.5);
            text-align: center;
            margin-top: 0.3rem;
        }
        .sidebar-points strong {
            color: var(--neon-green);
        }

        /* ======= SECCIONES SIDEBAR ======= */
        .sidebar-section {
            border: 1px solid var(--border-glow);
            background: var(--bg-panel);
            border-radius: 12px;
            overflow: hidden;
        }

        .sidebar-section-title {
            font-family: 'Orbitron', sans-serif;
            font-size: 0.5rem;
            letter-spacing: 0.12em;
            color: rgba(0,255,255,0.5);
            text-transform: uppercase;
            padding: 0.4rem 0.6rem;
            border-bottom: 1px solid var(--border-glow);
            display: flex;
            align-items: center;
            gap: 0.3rem;
        }

        /* Esta lección */
        .sidebar-current-lesson {
            padding: 0.5rem 0.6rem;
        }
        .sidebar-current-lesson .lesson-name {
            font-family: 'Orbitron', sans-serif;
            font-size: 0.55rem;
            color: var(--neon-cyan);
            line-height: 1.3;
            margin-bottom: 0.3rem;
        }
        .sidebar-current-lesson .lesson-subject {
            font-family: 'Roboto Mono', monospace;
            font-size: 0.5rem;
            color: rgba(255,255,255,0.4);
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }

        /* Puntuación actual */
        .sidebar-score-display {
            padding: 0.5rem 0.6rem;
        }
        .score-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 0.4rem;
        }
        .score-value {
            font-family: 'Orbitron', sans-serif;
            font-size: 1rem;
            color: var(--neon-yellow);
            text-shadow: 0 0 10px rgba(255,255,0,0.4);
        }
        .score-max {
            font-family: 'Roboto Mono', monospace;
            font-size: 0.55rem;
            color: rgba(255,255,255,0.3);
        }
        .score-pct-bar {
            height: 4px;
            background: rgba(255,255,255,0.08);
            border-radius: 2px;
            margin-top: 0.4rem;
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
            font-size: 0.5rem;
            margin-top: 0.3rem;
            color: <?php echo $completed ? 'var(--neon-green)' : 'rgba(255,255,255,0.3)'; ?>;
        }

        /* Navegación de lecciones de la materia */
        .sidebar-nav-list {
            padding: 0.3rem 0;
            max-height: 200px;
            overflow-y: auto;
            scrollbar-width: none;
        }
        .sidebar-nav-list::-webkit-scrollbar { display: none; }

        .sidebar-nav-item {
            display: flex;
            align-items: center;
            gap: 0.35rem;
            padding: 0.35rem 0.6rem;
            text-decoration: none;
            font-family: 'Roboto Mono', monospace;
            font-size: 0.52rem;
            color: rgba(255,255,255,0.45);
            border-left: 2px solid transparent;
            transition: all 0.18s;
            line-height: 1.25;
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
        .sidebar-nav-item.done .nav-dot {
            background: var(--neon-green);
            box-shadow: 0 0 4px var(--neon-green);
        }

        /* Botón quiz en sidebar */
        .sidebar-quiz-btn {
            width: 100%;
            background: linear-gradient(135deg, rgba(0,255,255,0.08), rgba(255,0,255,0.08));
            border: 1px solid var(--neon-cyan);
            border-radius: 12px;
            color: var(--neon-cyan);
            font-family: 'Orbitron', sans-serif;
            font-size: 0.55rem;
            letter-spacing: 0.08em;
            padding: 0.7rem;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.4rem;
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
            justify-content: center;
            text-align: center;
            width: 100%;
            background: transparent;
            border: 1px solid var(--border-glass);
            border-radius: 12px;
            text-decoration: none;
            color: rgba(255,255,255,0.5);
            font-family: 'Roboto Mono', monospace;
            font-size: 0.6rem;
            padding: 0.7rem;
            transition: all 0.2s;
            margin-top: auto;
        }
        .sidebar-back-btn:hover {
            background: rgba(255,255,255,0.05);
            color: var(--neon-cyan);
            border-color: var(--neon-cyan);
        }

        /* ======= ÁREA DE CONTENIDO ======= */
        .lesson-main-content {
            flex: 1;
            padding: 40px;
            overflow-y: auto;
            position: relative;
            scrollbar-width: thin;
            scrollbar-color: rgba(255,255,255,0.2) transparent;
        }
        .lesson-main-content::-webkit-scrollbar { width: 6px; }
        .lesson-main-content::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); border-radius: 10px; }

        .lesson-content-inner {
            max-width: 1000px;
            margin: 0 auto;
            background: var(--card-bg);
            backdrop-filter: blur(12px);
            border: 1px solid var(--border-glass);
            border-radius: 24px;
            padding: 40px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5);
            animation: fadeInUp 0.8s ease-out;
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .lesson-header {
            margin-bottom: 40px;
            border-bottom: 1px solid var(--border-glass);
            padding-bottom: 30px;
        }

        .lesson-materia {
            font-family: 'Press Start 2P', cursive;
            font-size: 10px;
            color: var(--neon-pink);
            text-transform: uppercase;
            margin-bottom: 15px;
            display: block;
        }

        .lesson-title {
            font-family: 'Orbitron', sans-serif;
            font-size: 32px;
            font-weight: 700;
            color: #fff;
            margin: 0 0 10px;
            letter-spacing: -1px;
        }

        .lesson-content {
            font-family: 'Roboto Mono', monospace;
            font-size: 0.52rem;
            color: rgba(255,255,255,0.45);
            line-height: 1.25;
            font-size: 18px;
            line-height: 1.7;
            color: rgba(255, 255, 255, 0.85);
        }

        .lesson-content h2, .lesson-content h3 {
            font-family: 'Orbitron', sans-serif;
            color: var(--neon-cyan);
            margin-top: 40px;
        }

        .lesson-content p {
            margin-bottom: 25px;
        }

        .lesson-content code {
            background: rgba(0, 0, 0, 0.3);
            padding: 3px 8px;
            border-radius: 4px;
            color: var(--neon-yellow);
            font-family: 'VT323', monospace;
            font-size: 1.2em;
        }

        .lesson-content pre {
            background: #0a0a0f;
            border: 1px solid var(--border-glass);
            border-radius: 12px;
            padding: 20px;
            overflow-x: auto;
            margin: 25px 0;
        }

        /* Botones Premium */
        .btn-premium {
            padding: 16px 30px;
            font-family: 'Press Start 2P', cursive;
            font-size: 10px;
            border-radius: 12px;
            cursor: pointer;
            transition: var(--transition-smooth);
            text-transform: uppercase;
            border: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            text-decoration: none;
        }

        .btn-primary {
            background: var(--neon-cyan);
            color: #000;
            box-shadow: 0 0 20px rgba(0, 255, 255, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 0 40px rgba(0, 255, 255, 0.5);
        }

        .btn-secondary {
            background: transparent;
            border: 1px solid var(--border-glass);
            color: #fff;
        }

        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.05);
            border-color: #fff;
        }

        /* Modal Quiz Premium */
        .quiz-modal {
            background: rgba(10, 10, 15, 0.95);
            backdrop-filter: blur(25px);
            border: 1px solid var(--neon-cyan);
            width: 90%;
            max-width: 800px;
            max-height: 85vh;
            overflow-y: auto;
            padding: 40px;
            position: relative;
            border-radius: 24px;
        }

        .question-card {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid var(--border-glass);
            border-radius: 16px;
            padding: 25px;
            margin-bottom: 20px;
        }

        .question-text {
            font-family: 'Orbitron', sans-serif;
            font-size: 18px;
            margin-bottom: 20px;
            color: #fff;
        }

        .option-label {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 12px 20px;
            background: rgba(255, 255, 255, 0.02);
            border: 1px solid var(--border-glass);
            border-radius: 10px;
            margin-bottom: 10px;
            cursor: pointer;
            transition: 0.2s;
        }

        .option-label:hover {
            background: rgba(0, 255, 255, 0.05);
            border-color: var(--neon-cyan);
        }

        .option-label input:checked + .radio-custom {
            background: var(--neon-cyan);
            box-shadow: 0 0 10px var(--neon-cyan);
        }

        .radio-custom {
            width: 18px; height: 18px;
            border: 2px solid var(--neon-cyan);
            border-radius: 50%;
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
            border-radius: 24px;
        }

        /* Mobile Adjustments */
        @media (max-width: 900px) {
            .lesson-sidebar {
                position: fixed;
                left: -100%;
                top: var(--header-h);
                transition: left 0.4s ease;
                box-shadow: 4px 0 32px rgba(0,0,0,0.8);
            }
            .lesson-sidebar.open { left: 0; }
            .sidebar-toggle { display: flex; align-items: center; justify-content: center; }
            .sidebar-overlay {
                display: none;
                position: fixed;
                inset: 0;
                background: rgba(0,0,0,0.6);
                z-index: 199;
                top: 64px;
            }
            .sidebar-overlay.active { display: block; }
            .content-wrapper { padding-left: 0; }
            .lesson-area { width: 100%; padding: 20px; }
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

        /* Toast / Result Panels */
        .result-panel {
            background: rgba(0, 255, 255, 0.05);
            border: 1px solid var(--neon-cyan);
            padding: 1.5rem;
            border-radius: 12px;
            margin-top: 1rem;
            font-family: 'Roboto Mono', monospace;
            color: #fff;
        }
        .toast-container {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            z-index: 9999;
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }
        .toast {
            background: rgba(0, 0, 0, 0.9);
            border-left: 4px solid var(--neon-cyan);
            padding: 1rem 1.5rem;
            color: #fff;
            font-family: 'Orbitron', sans-serif;
            font-size: 0.9rem;
            box-shadow: 0 4px 12px rgba(0,255,255,0.2);
            animation: slideInRight 0.4s ease forwards;
        }
        .toast.hide {
            animation: slideOutRight 0.4s ease forwards;
        }
        @keyframes slideInRight { from { transform: translateX(100%); opacity: 0; } to { transform: translateX(0); opacity: 1; } }
        @keyframes slideOutRight { from { transform: translateX(0); opacity: 1; } to { transform: translateX(100%); opacity: 0; } }

        .detail-item { margin-bottom: 1rem; padding-bottom: 1rem; border-bottom: 1px solid var(--border-glass); }
        .detail-item.correct .detail-ok { color: var(--neon-green); font-weight: bold; margin-top: 5px; }
        .detail-item.wrong .detail-wrong { color: var(--neon-pink); font-weight: bold; margin-top: 5px; }
        .detail-q { margin-bottom: 5px; }
        .detail-a { color: rgba(255,255,255,0.7); font-size: 0.9em; }
    </style>
</head>
<body class="<?php echo($slug === 'contaminacion-ambiental') ? 'page-lesson-contaminacion' : ''; ?>">

<div class="grid-bg"></div>

<div class="page-wrapper">

    <header class="main-header">
        <div class="header-title">
            <h1>LC-ADVANCE <span class="access">ACCESS: ONLINE</span></h1>
        </div>
        <div class="header-nav" style="display: flex; gap: 10px;">
            <a href="dashboard.php<?php echo $return_params; ?>" class="btn-premium btn-secondary" style="padding: 10px 20px;">Dashboard</a>
            <a href="logout.php" class="btn-premium btn-secondary" style="padding: 10px 20px; border-color: var(--neon-pink); color: var(--neon-pink);">Salir</a>
        </div>
    </header>

    <!-- Overlay para cerrar sidebar en móvil -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <div class="content-container">

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
            <?php endif; ?>

            <!-- Volver al dashboard -->
            <a href="dashboard.php<?php echo $return_params; ?>" class="sidebar-back-btn back-dashboard-btn">
                ← VOLVER AL DASHBOARD
            </a>

        </aside><!-- /sidebar -->

        <!-- ======= ÁREA DE CONTENIDO ======= -->
        <main class="lesson-main-content">
            <section class="lesson-content-inner">
                <div class="lesson-header">
                    <span class="lesson-materia"><?php echo htmlspecialchars($materia_actual); ?></span>
                    <h2 class="lesson-title"><?php echo htmlspecialchars($leccion['titulo']); ?></h2>
                    <div style="display: flex; gap: 20px; margin-top: 15px; font-size: 12px; color: rgba(255,255,255,0.5);">
                        <span>Status: <?php echo $completed ? '<span style="color:var(--neon-green)">Completado</span>' : 'Pendiente'; ?></span>
                        <span>Score: <span style="color:var(--neon-yellow)"><?php echo $old_score; ?>/<?php echo $NUM_PREGUNTAS_QUIZ_FINAL; ?></span></span>
                    </div>
                </div>

                <div class="lesson-content">
                    <?php echo $leccion['contenido']; ?>
                </div>

                <div style="margin-top: 50px; display: flex; gap: 20px; flex-wrap: wrap; padding-bottom: 60px;">
                    <button class="btn-premium btn-primary open-quiz-btn" style="flex:1; min-width: 250px;">
                        🧠 <?php echo $completed ? 'REPETIR QUIZ' : 'INICIAR QUIZ'; ?>
                    </button>
                    
                    <?php
                    // Mapeo para el examen final
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
                    $prof_id = $materia_a_profesor_id[$materia_actual] ?? '1Cu';
                    $current_url = urlencode($_SERVER['REQUEST_URI']);
                    $examen_slug = "examen_final_" . strtolower(str_replace(' ', '_', $materia_actual));
                    ?>
                    <a href="Examen/sistemC.php?personaje=<?= $prof_id ?>&dialogo=1&pregunta=0&return_url=<?= $current_url ?>&slug=<?= $examen_slug ?>" class="btn-premium btn-secondary" style="border-color: var(--neon-yellow); color: var(--neon-yellow); flex:1; min-width: 250px;">
                        ⚔️ EXAMEN FINAL
                    </a>
                </div>
            </section>
        </main><!-- /lesson-area -->

    </div><!-- /content-wrapper -->

    <!-- Toggle sidebar móvil -->
    <button class="sidebar-toggle" id="sidebarToggle" aria-label="Abrir panel">◀</button>

</div><!-- /page-wrapper -->

<!-- Modal Quiz -->
<div id="quiz-overlay" class="overlay hidden" style="position:fixed; inset:0; background:rgba(0,0,0,0.8); z-index:1000; align-items:center; justify-content:center; display:none;">
    <div class="quiz-modal">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:30px;">
            <h3 style="font-family:'Orbitron',sans-serif; margin:0; color:var(--neon-cyan);">QUIZ: <?php echo htmlspecialchars($leccion['titulo']); ?></h3>
            <button class="close-btn" style="background:none; border:none; color:#fff; font-size:24px; cursor:pointer;">&times;</button>
        </div>
        <div id="quiz-content">
            <div class="loading">Cargando preguntas...</div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const quizOverlay    = document.getElementById('quiz-overlay');
    const quizContent    = document.getElementById('quiz-content');
    const openQuizBtns   = document.querySelectorAll('.open-quiz-btn');
    const closeBtn       = document.querySelector('.close-btn');
    const sidebar        = document.getElementById('lessonSidebar');
    const sidebarToggle  = document.getElementById('sidebarToggle');
    const sidebarOverlay = document.getElementById('sidebarOverlay');

    // ── Sidebar toggle (móvil) ──
    function openSidebar()  { sidebar.classList.add('open'); sidebarOverlay.classList.add('active'); sidebarToggle.textContent = '✖'; }
    function closeSidebar() { sidebar.classList.remove('open'); sidebarOverlay.classList.remove('active'); sidebarToggle.textContent = '◀'; }
    if(sidebarToggle) sidebarToggle.addEventListener('click', () => sidebar.classList.contains('open') ? closeSidebar() : openSidebar());
    if(sidebarOverlay) sidebarOverlay.addEventListener('click', closeSidebar);

    const quizData = <?php echo json_encode($quiz_selected); ?>;

    // ── Abrir quiz ──
    openQuizBtns.forEach(btn => btn.addEventListener('click', openQuiz));

    function openQuiz() {
        quizOverlay.classList.remove('hidden');
        quizOverlay.style.display = 'flex';
        renderQuiz();
    }

    // ── Cerrar quiz ──
    if (closeBtn) closeBtn.addEventListener('click', closeQuiz);
    quizOverlay.addEventListener('click', (e) => { if (e.target === quizOverlay) closeQuiz(); });
    
    function closeQuiz() {
        quizOverlay.classList.add('hidden');
        quizOverlay.style.display = 'none';
        if (quizData.length > 0) {
            quizContent.innerHTML = '<div class="loading">Cargando preguntas...</div>';
        }
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
                html += `<label class="option-label"><input type="radio" style="display:none;" name="${name}" value="${escapeHtml(op)}" ${idx===0?'required':''}><span class="radio-custom"></span><span class="option-text">${escapeHtml(op)}</span></label>`;
            });
            html += `</div></div>`;
        });
        html += `<div style="text-align:center; margin-top:30px;"><button type="submit" class="btn-premium btn-primary">✅ ENVIAR RESPUESTAS</button></div></form>`;
        
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
                detailHtml += `<div style="margin-top:0.6rem"><button class="btn-premium btn-primary" onclick="location.reload()">Cerrar y Continuar</button></div></div>`;
                quizContent.innerHTML = detailHtml;

                if (xp > 0) {
                    const xpEl = document.createElement('div');
                    xpEl.className = 'xp-fly';
                    xpEl.textContent = `+${xp} XP`;
                    document.body.appendChild(xpEl);
                    setTimeout(() => xpEl.remove(), 2100);
                }

                if (state.nivel > (oldState.nivel || 1)) showToast(`¡Subiste al nivel ${state.nivel}! 🎉`);

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

    if (window.MathJax && MathJax.typesetPromise) MathJax.typesetPromise([document.querySelector('.lesson-content')]);
});
</script>

<script src="assets/js/app.js"></script>
</body>
</html>
