<?php
// ==========================================
// LC-ADVANCE - leccion_detalle.php (Rediseño Premium v2)
// ==========================================
require_once 'config/config.php';
requireLogin(true);
require_once 'src/content.php';

$user_id = $_SESSION['usuario_id'] ?? null;
$slug    = $_GET['slug'] ?? '';

$leccion = null;
foreach ($lecciones as $l) {
    if ($l['slug'] === $slug) { $leccion = $l; break; }
}

if (!$leccion) {
    $redir = !empty($_GET['materia'])
        ? 'dashboard.php?materia=' . urlencode($_GET['materia']) . '&error=leccion_no_encontrada'
        : 'dashboard.php?error=leccion_no_encontrada';
    header('Location: ' . $redir);
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM user_progress WHERE user_id = ? AND slug = ?");
$stmt->execute([$user_id, $slug]);
$progress  = $stmt->fetch(PDO::FETCH_ASSOC);
$completed = $progress ? (bool)$progress['completed'] : false;
$old_score = $progress ? $progress['score'] : 0;

$NUM_PREGUNTAS_QUIZ = 10;
$quiz_pool = $leccion['quiz'] ?? [];
if (count($quiz_pool) > $NUM_PREGUNTAS_QUIZ) { shuffle($quiz_pool); $quiz_selected = array_slice($quiz_pool, 0, $NUM_PREGUNTAS_QUIZ); }
else { $quiz_selected = $quiz_pool; }
$NUM_PREGUNTAS_QUIZ_FINAL = count($quiz_selected);

$_SESSION['current_quiz'] = ['slug' => $slug, 'preguntas' => $quiz_selected, 'num_preguntas' => $NUM_PREGUNTAS_QUIZ_FINAL];

$progress_percent = $NUM_PREGUNTAS_QUIZ_FINAL ? round(($old_score / $NUM_PREGUNTAS_QUIZ_FINAL) * 100) : 0;

$return_params = '';
if (!empty($_GET['profesor']))       $return_params = '?profesor=' . urlencode($_GET['profesor']);
elseif (isset($_GET['materia']) && $_GET['materia'] !== '') $return_params = '?materia=' . urlencode($_GET['materia']);

$user_data = ['puntos' => 0, 'nivel' => 1, 'nombre' => 'Estudiante', 'progreso' => 0];
if ($user_id) {
    $stmt2 = $pdo->prepare("SELECT nombre_usuario, puntos, nivel FROM usuarios WHERE id = ?");
    $stmt2->execute([$user_id]);
    $row = $stmt2->fetch(PDO::FETCH_ASSOC);
    if ($row) {
        $user_data['nombre']   = $row['nombre_usuario'] ?? 'Estudiante';
        $user_data['puntos']   = (int)($row['puntos'] ?? 0);
        $user_data['nivel']    = (int)($row['nivel'] ?? 1);
        $user_data['progreso'] = min(100, round(($user_data['puntos'] % 500) / 5));
    }
}

$completed_slugs = [];
if ($user_id) {
    $stmt3 = $pdo->prepare("SELECT slug FROM user_progress WHERE user_id = ? AND completed = 1");
    $stmt3->execute([$user_id]);
    $completed_slugs = array_column($stmt3->fetchAll(PDO::FETCH_ASSOC), 'slug');
}

$materia_actual   = $leccion['materia'] ?? '';
$lecciones_materia = array_filter($lecciones, fn($l) => ($l['materia'] ?? '') === $materia_actual);

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
$prof_id     = $materia_a_profesor_id[$materia_actual] ?? '1Cu';
$current_url = urlencode($_SERVER['REQUEST_URI']);
$examen_slug = "examen_final_" . strtolower(str_replace(' ', '_', $materia_actual));
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($leccion['titulo']) ?> | LC-ADVANCE</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@700;800&family=JetBrains+Mono:wght@400;500;700&family=Space+Grotesk:wght@300;400;500;600&display=swap" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/marked@9/marked.min.js"></script>
    <script>MathJax = { tex: { inlineMath: [['$','$'],['\\(','\\)']] } };</script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>

    <!-- Existing lesson CSS (content styles) -->
    <link rel="stylesheet" href="assets/css/style.css">
    <?php
    $cssFiles = glob('assets/css/leccion-*.css');
    foreach ($cssFiles as $f) echo '<link rel="stylesheet" href="' . htmlspecialchars(str_replace('\\','/',$f)) . '">' . "\n";
    ?>

    <style>
    /* ══════════════════════════════════════════
       LC-ADVANCE — leccion_detalle PREMIUM v2
       Sistema de variables del dashboard.css
       ══════════════════════════════════════════ */
    :root {
        --bg:        #060a12;
        --surface:   #0c1220;
        --surface2:  #101828;
        --border:    rgba(0,230,255,0.12);
        --border2:   rgba(0,230,255,0.22);
        --cyan:      #00e5ff;
        --cyan-dim:  rgba(0,229,255,0.1);
        --pink:      #ff3cac;
        --green:     #00ff87;
        --yellow:    #ffd23f;
        --text:      #e8f4ff;
        --muted:     rgba(200,230,255,0.45);
        --font-display: "Syne", sans-serif;
        --font-mono:    "JetBrains Mono", monospace;
        --font-body:    "Space Grotesk", sans-serif;
        --sidebar-w:    288px;
        --header-h:     58px;
        --ease:         cubic-bezier(0.23,1,0.32,1);
    }

    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    html { scroll-behavior: smooth; }

    body {
        background: var(--bg);
        color: var(--text);
        font-family: var(--font-body);
        font-size: 14px;
        min-height: 100vh;
        overflow-x: hidden;
    }

    a { text-decoration: none; color: inherit; }
    button { font-family: var(--font-body); cursor: pointer; }

    /* ── GRID BG ── */
    .grid-bg {
        position: fixed;
        inset: 0;
        pointer-events: none;
        z-index: 0;
        background-image:
            linear-gradient(rgba(0,229,255,0.025) 1px, transparent 1px),
            linear-gradient(90deg, rgba(0,229,255,0.018) 1px, transparent 1px);
        background-size: 48px 48px;
        animation: gridScroll 30s linear infinite;
    }
    @keyframes gridScroll { to { background-position: 0 48px; } }

    /* Orb decorativo */
    .bg-orb {
        position: fixed; border-radius: 50%;
        filter: blur(90px); pointer-events: none; z-index: 0;
    }
    .bg-orb-1 {
        width: 500px; height: 500px;
        background: radial-gradient(circle, rgba(0,229,255,0.06), transparent 70%);
        top: -100px; right: -100px;
        animation: orbPulse 9s ease-in-out infinite;
    }
    .bg-orb-2 {
        width: 350px; height: 350px;
        background: radial-gradient(circle, rgba(255,60,172,0.05), transparent 70%);
        bottom: 0; left: -80px;
        animation: orbPulse 11s ease-in-out infinite reverse;
    }
    @keyframes orbPulse { 0%,100% { transform: scale(1); } 50% { transform: scale(1.14); } }

    #globalLoader {
        position: fixed;
        inset: 0;
        z-index: 9999;
        display: none;
        align-items: center;
        justify-content: center;
        padding: 16px;
        background: rgba(0, 0, 0, 0.78);
        backdrop-filter: blur(4px);
    }
    #globalLoader.active { display: flex; }
    #globalLoader .loader-box {
        width: min(420px, 100%);
        padding: 22px 24px;
        border-radius: 18px;
        background: rgba(8, 18, 36, 0.96);
        border: 1px solid rgba(0, 255, 255, 0.16);
        box-shadow: 0 0 40px rgba(0, 255, 255, 0.14);
        text-align: center;
    }
    #globalLoader .loader-spinner {
        width: 48px;
        height: 48px;
        margin: 0 auto 14px;
        border: 4px solid rgba(0, 229, 255, 0.18);
        border-top-color: #00e5ff;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }
    @keyframes spin { to { transform: rotate(360deg); } }
    .lc-chat-draft { white-space: pre-wrap; word-break: break-word; font-family: var(--font-body); }

    /* ════════════ HEADER ════════════ */
    .lc-header {
        position: fixed;
        top: 0; left: 0; right: 0;
        height: var(--header-h);
        z-index: 200;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 24px;
        background: rgba(6,10,18,0.92);
        backdrop-filter: blur(20px);
        border-bottom: 1px solid var(--border2);
        gap: 12px;
    }

    .header-brand {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .brand-logo {
        font-family: var(--font-display);
        font-size: 16px;
        font-weight: 800;
        background: linear-gradient(90deg, var(--cyan), var(--pink));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        letter-spacing: -0.3px;
    }

    .brand-dot {
        width: 6px; height: 6px;
        border-radius: 50%;
        background: var(--cyan);
        box-shadow: 0 0 8px var(--cyan);
        animation: dotPulse 2s ease-in-out infinite;
    }
    @keyframes dotPulse { 0%,100%{opacity:1;} 50%{opacity:0.25;} }

    .header-crumb {
        display: flex;
        align-items: center;
        gap: 6px;
        font-family: var(--font-mono);
        font-size: 10px;
        color: var(--muted);
    }
    .crumb-sep { opacity: 0.3; }
    .crumb-active { color: var(--cyan); }

    .header-actions {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .mobile-menu-btn {
        display: none !important;
        width: 36px; height: 36px;
        border-radius: 8px;
        border: 1px solid var(--border2);
        background: transparent;
        color: var(--cyan);
        font-size: 16px;
        align-items: center;
        justify-content: center;
    }

    /* ── Shared button base ── */
    .btn {
        font-family: var(--font-mono);
        font-size: 9px;
        letter-spacing: 0.8px;
        text-transform: uppercase;
        border-radius: 8px;
        padding: 7px 14px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.25s var(--ease);
        cursor: pointer;
        border: 1px solid transparent;
    }
    .btn-ghost {
        border-color: var(--border2);
        color: var(--muted);
        background: transparent;
    }
    .btn-ghost:hover { color: var(--cyan); border-color: rgba(0,229,255,0.4); background: var(--cyan-dim); transform: translateY(-1px); }

    .btn-danger {
        border-color: rgba(255,60,172,0.3);
        color: rgba(255,60,172,0.8);
        background: transparent;
    }
    .btn-danger:hover { border-color: var(--pink); color: var(--pink); background: rgba(255,60,172,0.07); transform: translateY(-1px); }

    .btn-primary {
        background: var(--cyan);
        color: var(--bg);
        border-color: var(--cyan);
        font-weight: 700;
    }
    .btn-primary:hover { background: #33eeff; transform: translateY(-2px); box-shadow: 0 8px 24px rgba(0,229,255,0.3); }

    .btn-yellow {
        background: transparent;
        border-color: rgba(255,210,63,0.4);
        color: var(--yellow);
    }
    .btn-yellow:hover { background: rgba(255,210,63,0.08); border-color: var(--yellow); transform: translateY(-1px); box-shadow: 0 4px 16px rgba(255,210,63,0.15); }

    /* ════════════ LAYOUT ════════════ */
    .page-body {
        display: flex;
        padding-top: var(--header-h);
        min-height: 100vh;
        position: relative;
        z-index: 1;
    }

    /* ════════════ SIDEBAR ════════════ */
    .lc-sidebar {
        position: fixed;
        top: var(--header-h);
        left: 0;
        bottom: 0;
        width: var(--sidebar-w);
        background: rgba(6,10,18,0.94);
        backdrop-filter: blur(24px);
        border-right: 1px solid var(--border2);
        display: flex;
        flex-direction: column;
        gap: 0;
        overflow-y: auto;
        overflow-x: hidden;
        z-index: 150;
        scrollbar-width: thin;
        scrollbar-color: rgba(0,229,255,0.2) transparent;
        transition: transform 0.35s var(--ease);
    }
    .lc-sidebar::-webkit-scrollbar { width: 3px; }
    .lc-sidebar::-webkit-scrollbar-thumb { background: rgba(0,229,255,0.2); border-radius: 99px; }

    /* Sidebar sections */
    .sb-section {
        padding: 16px;
        border-bottom: 1px solid var(--border);
    }
    .sb-section:last-child { border-bottom: none; margin-top: auto; }

    .sb-label {
        font-family: var(--font-mono);
        font-size: 8px;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        color: var(--muted);
        margin-bottom: 12px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .sb-label::after { content:''; flex:1; height:1px; background: var(--border); }

    /* User card */
    .sb-user {
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .sb-avatar {
        width: 42px; height: 42px;
        border-radius: 12px;
        background: linear-gradient(135deg, rgba(0,229,255,0.25), rgba(255,60,172,0.2));
        border: 1px solid var(--border2);
        display: flex; align-items: center; justify-content: center;
        font-size: 18px;
        flex-shrink: 0;
        box-shadow: 0 0 16px rgba(0,229,255,0.15);
        animation: glowPulse 4s ease-in-out infinite;
    }
    @keyframes glowPulse { 0%,100%{box-shadow:0 0 10px rgba(0,229,255,0.1);} 50%{box-shadow:0 0 22px rgba(0,229,255,0.28);} }

    .sb-user-info { min-width: 0; }
    .sb-username {
        font-family: var(--font-display);
        font-size: 13px;
        font-weight: 700;
        color: var(--text);
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .sb-level {
        font-family: var(--font-mono);
        font-size: 9px;
        color: var(--yellow);
        margin-top: 2px;
    }

    /* XP bar */
    .xp-row {
        display: flex;
        justify-content: space-between;
        font-family: var(--font-mono);
        font-size: 8px;
        color: var(--muted);
        margin-bottom: 5px;
        margin-top: 12px;
    }
    .xp-track {
        height: 3px;
        background: rgba(255,255,255,0.07);
        border-radius: 99px;
        overflow: hidden;
    }
    .xp-fill {
        height: 100%;
        background: linear-gradient(90deg, var(--cyan), var(--pink));
        border-radius: 99px;
        box-shadow: 0 0 8px rgba(0,229,255,0.4);
        transition: width 1s var(--ease);
    }
    .sb-points {
        font-family: var(--font-mono);
        font-size: 9px;
        color: var(--muted);
        margin-top: 8px;
        text-align: center;
    }
    .sb-points strong { color: var(--green); }

    /* Current lesson info */
    .sb-lesson-title {
        font-family: var(--font-display);
        font-size: 12px;
        font-weight: 700;
        color: var(--cyan);
        line-height: 1.4;
        margin-bottom: 4px;
    }
    .sb-lesson-sub {
        font-family: var(--font-mono);
        font-size: 9px;
        color: var(--muted);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* Score card inside sidebar */
    .sb-score-card {
        background: var(--surface2);
        border: 1px solid var(--border);
        border-radius: 10px;
        padding: 12px;
    }
    .sb-score-row {
        display: flex;
        align-items: baseline;
        gap: 4px;
        margin-bottom: 8px;
    }
    .sb-score-val {
        font-family: var(--font-display);
        font-size: 28px;
        font-weight: 800;
        color: var(--yellow);
        line-height: 1;
    }
    .sb-score-max {
        font-family: var(--font-mono);
        font-size: 10px;
        color: var(--muted);
    }
    .sb-score-track {
        height: 3px;
        background: rgba(255,255,255,0.07);
        border-radius: 99px;
        overflow: hidden;
        margin-bottom: 6px;
    }
    .sb-score-fill {
        height: 100%;
        background: linear-gradient(90deg, var(--yellow), var(--green));
        border-radius: 99px;
        box-shadow: 0 0 8px rgba(255,210,63,0.4);
        transition: width 1s var(--ease);
    }
    .sb-status {
        font-family: var(--font-mono);
        font-size: 9px;
        color: <?= $completed ? 'var(--green)' : 'var(--muted)' ?>;
    }

    /* Nav list */
    .sb-nav { display: flex; flex-direction: column; gap: 2px; }
    .sb-nav-item {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 8px 10px;
        border-radius: 8px;
        font-family: var(--font-mono);
        font-size: 10px;
        color: var(--muted);
        border: 1px solid transparent;
        transition: all 0.2s ease;
        line-height: 1.3;
    }
    .sb-nav-item:hover { color: var(--cyan); background: var(--cyan-dim); border-color: var(--border); }
    .sb-nav-item.active { color: var(--cyan); background: rgba(0,229,255,0.08); border-color: rgba(0,229,255,0.2); }
    .sb-nav-item.done { color: rgba(0,255,135,0.7); }
    .sb-nav-item.done:hover { color: var(--green); background: rgba(0,255,135,0.05); border-color: rgba(0,255,135,0.15); }

    .nav-pip {
        width: 6px; height: 6px; border-radius: 50%; flex-shrink: 0;
        background: rgba(255,255,255,0.15);
        transition: all 0.2s;
    }
    .sb-nav-item.active .nav-pip { background: var(--cyan); box-shadow: 0 0 6px var(--cyan); }
    .sb-nav-item.done .nav-pip  { background: var(--green); box-shadow: 0 0 6px rgba(0,255,135,0.5); }

    /* Sidebar CTA */
    .sb-cta-quiz {
        width: 100%;
        padding: 11px 0;
        border-radius: 10px;
        border: 1px solid var(--cyan);
        background: rgba(0,229,255,0.07);
        color: var(--cyan);
        font-family: var(--font-mono);
        font-size: 9px;
        font-weight: 700;
        letter-spacing: 1px;
        text-transform: uppercase;
        cursor: pointer;
        transition: all 0.25s var(--ease);
        margin-bottom: 8px;
    }
    .sb-cta-quiz:hover { background: rgba(0,229,255,0.16); box-shadow: 0 0 20px rgba(0,229,255,0.18); transform: translateY(-1px); }

    .sb-back {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        width: 100%;
        padding: 9px 0;
        border-radius: 10px;
        border: 1px solid var(--border);
        color: var(--muted);
        font-family: var(--font-mono);
        font-size: 9px;
        letter-spacing: 0.5px;
        transition: all 0.2s ease;
        text-transform: uppercase;
    }
    .sb-back:hover { color: var(--cyan); border-color: var(--border2); background: var(--cyan-dim); }

    /* Sidebar overlay (mobile) */
    .sb-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.65);
        backdrop-filter: blur(4px);
        z-index: 140;
        top: var(--header-h);
    }
    .sb-overlay.active { display: block; }

    /* ════════════ MAIN CONTENT ════════════ */
    .lc-main {
        margin-left: var(--sidebar-w);
        flex: 1;
        min-height: calc(100vh - var(--header-h));
        display: flex;
        flex-direction: column;
        transition: margin-left 0.35s var(--ease);
    }

    .content-scroll {
        flex: 1;
        overflow-y: auto;
        padding: 32px 28px 60px;
        scrollbar-width: thin;
        scrollbar-color: rgba(255,255,255,0.1) transparent;
    }
    .content-scroll::-webkit-scrollbar { width: 4px; }
    .content-scroll::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); border-radius: 99px; }

    .lesson-card {
        max-width: 900px;
        margin: 0 auto;
        background: rgba(12,18,32,0.85);
        backdrop-filter: blur(16px);
        border: 1px solid var(--border);
        border-radius: 20px;
        overflow: hidden;
        animation: fadeInUp 0.6s var(--ease) both;
        box-shadow: 0 20px 50px rgba(0,0,0,0.4);
    }
    @keyframes fadeInUp { from { opacity:0; transform:translateY(24px); } to { opacity:1; transform:translateY(0); } }

    /* Lesson card header band */
    .lesson-card-head {
        padding: 28px 36px 24px;
        border-bottom: 1px solid var(--border);
        position: relative;
        overflow: hidden;
    }
    .lesson-card-head::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 2px;
        background: linear-gradient(90deg, var(--cyan), var(--pink), var(--yellow));
    }
    .lesson-card-head::after {
        content: '';
        position: absolute;
        top: 0; right: 0;
        width: 300px; height: 100%;
        background: radial-gradient(ellipse at right top, rgba(0,229,255,0.05), transparent 70%);
        pointer-events: none;
    }

    .lh-materia {
        font-family: var(--font-mono);
        font-size: 9px;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        color: var(--pink);
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .lh-materia::before { content:''; width:3px; height:3px; border-radius:50%; background: var(--pink); box-shadow: 0 0 6px var(--pink); }

    .lh-title {
        font-family: var(--font-display);
        font-size: clamp(20px, 3vw, 30px);
        font-weight: 800;
        color: var(--text);
        line-height: 1.2;
        letter-spacing: -0.5px;
        margin-bottom: 16px;
    }

    .lh-meta {
        display: flex;
        align-items: center;
        gap: 16px;
        flex-wrap: wrap;
    }
    .meta-chip {
        font-family: var(--font-mono);
        font-size: 9px;
        padding: 4px 10px;
        border-radius: 6px;
        display: flex;
        align-items: center;
        gap: 5px;
    }
    .meta-chip.status-done  { background: rgba(0,255,135,0.08); border: 1px solid rgba(0,255,135,0.2); color: var(--green); }
    .meta-chip.status-pend  { background: rgba(255,255,255,0.04); border: 1px solid var(--border); color: var(--muted); }
    .meta-chip.score        { background: rgba(255,210,63,0.07); border: 1px solid rgba(255,210,63,0.2); color: var(--yellow); }

    /* Lesson body */
    .lesson-card-body {
        padding: 32px 36px;
    }

    /* Override lesson content typography */
    .lesson-content {
        font-family: var(--font-body);
        font-size: 15px;
        line-height: 1.75;
        color: rgba(232,244,255,0.85);
    }
    .lesson-content h1,
    .lesson-content h2 {
        font-family: var(--font-display);
        font-size: clamp(18px, 2.5vw, 24px);
        font-weight: 700;
        color: var(--cyan);
        margin: 36px 0 14px;
        letter-spacing: -0.3px;
        padding-bottom: 8px;
        border-bottom: 1px solid var(--border);
    }
    .lesson-content h3 {
        font-family: var(--font-display);
        font-size: 16px;
        color: var(--yellow);
        margin: 28px 0 10px;
    }
    .lesson-content p { margin-bottom: 20px; }
    .lesson-content strong { color: var(--text); font-weight: 600; }
    .lesson-content em { color: var(--cyan); font-style: normal; font-weight: 500; }
    .lesson-content ul, .lesson-content ol { margin: 0 0 20px 20px; }
    .lesson-content li { margin-bottom: 8px; }
    .lesson-content a { color: var(--cyan); border-bottom: 1px solid rgba(0,229,255,0.3); transition: border-color 0.2s; }
    .lesson-content a:hover { border-color: var(--cyan); }
    .lesson-content code {
        font-family: var(--font-mono);
        font-size: 12px;
        background: rgba(0,229,255,0.07);
        border: 1px solid rgba(0,229,255,0.15);
        padding: 2px 7px;
        border-radius: 5px;
        color: var(--cyan);
    }
    .lesson-content pre {
        background: rgba(3,5,10,0.8);
        border: 1px solid var(--border2);
        border-radius: 12px;
        padding: 20px;
        overflow-x: auto;
        margin: 24px 0;
    }
    .lesson-content pre code { background: none; border: none; padding: 0; font-size: 13px; }
    .lesson-content table { width: 100%; border-collapse: collapse; margin: 24px 0; font-size: 13px; }
    .lesson-content th {
        font-family: var(--font-mono);
        font-size: 9px;
        letter-spacing: 1px;
        text-transform: uppercase;
        color: var(--muted);
        padding: 10px 14px;
        border-bottom: 1px solid var(--border2);
        text-align: left;
    }
    .lesson-content td { padding: 10px 14px; border-bottom: 1px solid var(--border); color: rgba(232,244,255,0.8); }
    .lesson-content tr:hover td { background: rgba(0,229,255,0.03); }
    .lesson-content blockquote {
        margin: 24px 0;
        padding: 16px 20px;
        border-left: 3px solid var(--cyan);
        background: rgba(0,229,255,0.04);
        border-radius: 0 8px 8px 0;
        font-style: italic;
        color: rgba(232,244,255,0.7);
    }
    .lesson-content img { max-width: 100%; border-radius: 10px; margin: 16px 0; }

    /* ── ACTION FOOTER ── */
    .lesson-actions {
        padding: 20px 36px 30px;
        border-top: 1px solid var(--border);
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }

    .action-btn {
        flex: 1;
        min-width: 200px;
        padding: 13px 20px;
        border-radius: 12px;
        font-family: var(--font-mono);
        font-size: 10px;
        letter-spacing: 1px;
        text-transform: uppercase;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.25s var(--ease);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        border: none;
        text-decoration: none;
    }
    .action-quiz {
        background: var(--cyan);
        color: var(--bg);
        box-shadow: 0 0 20px rgba(0,229,255,0.2);
    }
    .action-quiz:hover { background: #33eeff; transform: translateY(-2px); box-shadow: 0 8px 28px rgba(0,229,255,0.35); }

    .action-exam {
        background: transparent;
        border: 1px solid rgba(255,210,63,0.35);
        color: var(--yellow);
    }
    .action-exam:hover { background: rgba(255,210,63,0.08); border-color: var(--yellow); transform: translateY(-2px); box-shadow: 0 6px 20px rgba(255,210,63,0.15); }

    /* ════════════ QUIZ MODAL ════════════ */
    .quiz-overlay {
        position: fixed;
        inset: 0;
        background: rgba(3,5,10,0.85);
        backdrop-filter: blur(16px);
        z-index: 500;
        display: none;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }
    .quiz-overlay.open { display: flex; }

    .quiz-modal {
        width: 100%;
        max-width: 720px;
        max-height: 85vh;
        overflow-y: auto;
        background: rgba(10,16,28,0.98);
        border: 1px solid var(--border2);
        border-radius: 20px;
        box-shadow: 0 30px 80px rgba(0,0,0,0.7), 0 0 0 1px rgba(0,229,255,0.05);
        animation: modalIn 0.3s var(--ease) both;
        scrollbar-width: thin;
        scrollbar-color: rgba(0,229,255,0.2) transparent;
    }
    .quiz-modal::-webkit-scrollbar { width: 3px; }
    .quiz-modal::-webkit-scrollbar-thumb { background: rgba(0,229,255,0.2); }
    @keyframes modalIn { from { opacity:0; transform:scale(0.96) translateY(16px); } to { opacity:1; transform:scale(1) translateY(0); } }

    /* Modal header */
    .qm-head {
        padding: 22px 28px 18px;
        border-bottom: 1px solid var(--border);
        display: flex;
        align-items: center;
        justify-content: space-between;
        position: sticky;
        top: 0;
        background: rgba(10,16,28,0.98);
        backdrop-filter: blur(8px);
        z-index: 2;
    }
    .qm-title {
        font-family: var(--font-display);
        font-size: 16px;
        font-weight: 800;
        color: var(--cyan);
    }
    .qm-close {
        width: 32px; height: 32px;
        border-radius: 8px;
        border: 1px solid var(--border);
        background: transparent;
        color: var(--muted);
        font-size: 16px;
        display: flex; align-items: center; justify-content: center;
        transition: all 0.2s;
    }
    .qm-close:hover { border-color: var(--pink); color: var(--pink); background: rgba(255,60,172,0.07); }

    .qm-body { padding: 20px 28px 28px; }

    /* Question card */
    .q-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 14px;
        padding: 20px;
        margin-bottom: 14px;
        transition: border-color 0.2s;
    }
    .q-card:hover { border-color: var(--border2); }

    .q-num {
        font-family: var(--font-mono);
        font-size: 8px;
        color: var(--muted);
        letter-spacing: 1px;
        text-transform: uppercase;
        margin-bottom: 8px;
    }
    .q-text {
        font-family: var(--font-display);
        font-size: 14px;
        font-weight: 700;
        color: var(--text);
        line-height: 1.45;
        margin-bottom: 16px;
    }

    .q-options { display: flex; flex-direction: column; gap: 6px; }

    .q-option {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 14px;
        border-radius: 9px;
        border: 1px solid var(--border);
        cursor: pointer;
        transition: all 0.2s ease;
        font-size: 13px;
        color: rgba(232,244,255,0.8);
    }
    .q-option:hover { border-color: rgba(0,229,255,0.3); background: var(--cyan-dim); color: var(--text); }
    .q-option input[type="radio"] { display: none; }
    .q-radio {
        width: 16px; height: 16px;
        border-radius: 50%;
        border: 2px solid rgba(0,229,255,0.3);
        flex-shrink: 0;
        transition: all 0.2s;
        display: flex; align-items: center; justify-content: center;
    }
    .q-option input:checked ~ .q-radio { border-color: var(--cyan); background: var(--cyan); box-shadow: 0 0 8px rgba(0,229,255,0.4); }
    .q-option input:checked ~ .q-radio::after { content:''; width:5px; height:5px; border-radius:50%; background: var(--bg); }
    .q-option:has(input:checked) { border-color: rgba(0,229,255,0.35); background: rgba(0,229,255,0.05); color: var(--text); }

    .qm-submit {
        width: 100%;
        padding: 13px;
        border-radius: 12px;
        border: none;
        background: var(--cyan);
        color: var(--bg);
        font-family: var(--font-mono);
        font-size: 10px;
        font-weight: 700;
        letter-spacing: 1px;
        text-transform: uppercase;
        cursor: pointer;
        transition: all 0.25s var(--ease);
        margin-top: 8px;
        box-shadow: 0 0 20px rgba(0,229,255,0.2);
    }
    .qm-submit:hover { background: #33eeff; transform: translateY(-2px); box-shadow: 0 8px 28px rgba(0,229,255,0.3); }

    /* ── RESULT PANEL ── */
    .result-card {
        background: var(--surface);
        border: 1px solid var(--border2);
        border-radius: 14px;
        padding: 24px;
        margin-bottom: 12px;
    }
    .result-score-big {
        font-family: var(--font-display);
        font-size: 48px;
        font-weight: 800;
        color: var(--yellow);
        line-height: 1;
    }
    .result-sub { font-family: var(--font-mono); font-size: 10px; color: var(--muted); margin-top: 4px; }
    .result-meta { display: flex; gap: 16px; margin-top: 16px; flex-wrap: wrap; }
    .result-meta-item { font-family: var(--font-mono); font-size: 11px; }
    .result-meta-item strong { color: var(--green); }

    .detail-list { margin-top: 16px; display: flex; flex-direction: column; gap: 10px; }
    .detail-item {
        padding: 12px 14px;
        border-radius: 10px;
        border: 1px solid var(--border);
        font-size: 12px;
    }
    .detail-item.correct { border-color: rgba(0,255,135,0.2); background: rgba(0,255,135,0.03); }
    .detail-item.wrong   { border-color: rgba(255,60,172,0.2); background: rgba(255,60,172,0.03); }
    .detail-q { color: rgba(232,244,255,0.8); margin-bottom: 5px; line-height: 1.4; }
    .detail-a { font-family: var(--font-mono); font-size: 10px; color: var(--muted); }
    .detail-ok   { font-family: var(--font-mono); font-size: 10px; color: var(--green); margin-top: 4px; }
    .detail-wrong-txt { font-family: var(--font-mono); font-size: 10px; color: var(--pink); margin-top: 4px; }

    /* XP fly animation */
    .xp-fly {
        position: fixed;
        bottom: 80px;
        right: 32px;
        font-family: var(--font-display);
        font-size: 22px;
        font-weight: 800;
        color: var(--yellow);
        pointer-events: none;
        z-index: 9999;
        animation: xpFloat 2s var(--ease) forwards;
        text-shadow: 0 0 20px rgba(255,210,63,0.6);
    }
    @keyframes xpFloat {
        0%   { opacity: 0; transform: translateY(0) scale(0.8); }
        20%  { opacity: 1; transform: translateY(-10px) scale(1.1); }
        80%  { opacity: 1; transform: translateY(-50px) scale(1); }
        100% { opacity: 0; transform: translateY(-80px) scale(0.9); }
    }

    /* Toast */
    .toast-wrap {
        position: fixed; bottom: 24px; right: 24px;
        z-index: 9000; display: flex; flex-direction: column; gap: 8px;
    }
    .toast {
        background: rgba(10,16,28,0.97);
        border: 1px solid var(--border2);
        border-left: 3px solid var(--cyan);
        border-radius: 10px;
        padding: 12px 18px;
        font-family: var(--font-mono);
        font-size: 11px;
        color: var(--text);
        box-shadow: 0 8px 24px rgba(0,0,0,0.5);
        animation: toastIn 0.35s var(--ease) both;
    }
    .toast.hide { animation: toastOut 0.35s var(--ease) both; }
    @keyframes toastIn  { from { opacity:0; transform:translateX(20px); } to { opacity:1; transform:translateX(0); } }
    @keyframes toastOut { from { opacity:1; transform:translateX(0); } to { opacity:0; transform:translateX(20px); } }

    /* ── MOBILE ── */
    @media (max-width: 768px) {
        .lc-header {
            left: 0;
            width: 100%;
        }
        .lc-sidebar {
            transform: translateX(-100%);
            z-index: 160;
            width: min(var(--sidebar-w), 84vw);
        }
        .lc-sidebar.open { transform: translateX(0); }
        .lc-main { margin-left: 0; }
        .mobile-menu-btn { display: flex !important; }
        .header-crumb { display: none; }
    }
    @media (max-width: 640px) {
        .content-scroll { padding: 16px 14px 60px; }
        .lesson-card-head, .lesson-card-body, .lesson-actions { padding-left: 18px; padding-right: 18px; }
        .lesson-actions { flex-direction: column; }
        .action-btn { min-width: auto; }
        .qm-body { padding: 16px 16px 20px; }
        .qm-head { padding: 16px 18px; }
    }

    /* ════════════ CHAT ADAPTATIVO ════════════ */
    .lc-chat-widget {
        position: fixed;
        right: 24px;
        bottom: 24px;
        z-index: 10010;
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        gap: 12px;
    }
    .lc-chat-toggle {
        width: 62px;
        height: 62px;
        border-radius: 50%;
        border: none;
        background: linear-gradient(135deg, #00e5ff, #ff3cac);
        color: #06101a;
        font-size: 24px;
        box-shadow: 0 16px 40px rgba(0,229,255,0.25);
        cursor: pointer;
        transition: transform 0.2s var(--ease), box-shadow 0.2s;
    }
    .lc-chat-toggle:hover { transform: scale(1.08); box-shadow: 0 20px 50px rgba(0,229,255,0.35); }

    .lc-chat-panel {
        width: min(440px, calc(100vw - 48px));
        height: min(580px, calc(100vh - 120px));
        background: rgba(6,10,18,0.98);
        border: 1px solid rgba(0,229,255,0.22);
        border-radius: 20px;
        overflow: hidden;
        display: none;
        flex-direction: column;
        box-shadow: 0 32px 80px rgba(0,0,0,0.5), 0 0 0 1px rgba(0,229,255,0.05);
        animation: chatIn 0.28s var(--ease) both;
    }
    .lc-chat-panel.open { display: flex; }
    @keyframes chatIn { from { opacity:0; transform: translateY(16px) scale(0.97); } to { opacity:1; transform: translateY(0) scale(1); } }

    .lc-chat-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 14px 18px;
        background: linear-gradient(135deg, rgba(0,229,255,0.08), rgba(255,60,172,0.05));
        border-bottom: 1px solid rgba(0,229,255,0.12);
        flex-shrink: 0;
    }
    .lc-chat-header-info { display: flex; align-items: center; gap: 10px; }
    .lc-chat-avatar {
        width: 32px; height: 32px; border-radius: 50%;
        background: linear-gradient(135deg, #00e5ff, #ff3cac);
        display: flex; align-items: center; justify-content: center;
        font-size: 15px; flex-shrink: 0;
        box-shadow: 0 0 12px rgba(0,229,255,0.3);
    }
    .lc-chat-title {
        font-family: var(--font-display);
        font-size: 13px;
        font-weight: 700;
        color: var(--text);
    }
    .lc-chat-subtitle {
        font-family: var(--font-mono);
        font-size: 9px;
        color: var(--muted);
        margin-top: 1px;
    }
    .lc-chat-close {
        border: 1px solid var(--border);
        background: transparent;
        color: var(--muted);
        font-size: 15px;
        width: 28px; height: 28px;
        border-radius: 8px;
        cursor: pointer;
        display: flex; align-items: center; justify-content: center;
        transition: all 0.2s;
    }
    .lc-chat-close:hover { border-color: var(--pink); color: var(--pink); background: rgba(255,60,172,0.07); }

    .lc-chat-messages {
        flex: 1;
        padding: 16px;
        overflow-y: auto;
        display: flex;
        flex-direction: column;
        gap: 12px;
        scrollbar-width: thin;
        scrollbar-color: rgba(0,229,255,0.15) transparent;
    }
    .lc-chat-messages::-webkit-scrollbar { width: 3px; }
    .lc-chat-messages::-webkit-scrollbar-thumb { background: rgba(0,229,255,0.2); border-radius: 99px; }

    .lc-chat-message {
        max-width: 92%;
        padding: 11px 15px;
        border-radius: 16px;
        font-size: 13px;
        line-height: 1.55;
        position: relative;
    }
    .lc-chat-message.bot {
        background: rgba(0,229,255,0.07);
        border: 1px solid rgba(0,229,255,0.1);
        color: #e8f4ff;
        align-self: flex-start;
        border-bottom-left-radius: 4px;
    }
    .lc-chat-message.user {
        background: rgba(255,255,255,0.07);
        border: 1px solid rgba(255,255,255,0.08);
        color: #d8f6ff;
        align-self: flex-end;
        border-bottom-right-radius: 4px;
    }
    .lc-chat-message.thinking {
        background: rgba(0,229,255,0.04);
        border: 1px solid rgba(0,229,255,0.08);
        color: var(--muted);
        align-self: flex-start;
    }
    /* Typing dots */
    .lc-typing { display: flex; gap: 4px; align-items: center; padding: 4px 0; }
    .lc-typing span {
        width: 6px; height: 6px; border-radius: 50%;
        background: var(--cyan); opacity: 0.4;
        animation: typingBounce 1.2s ease-in-out infinite;
    }
    .lc-typing span:nth-child(2) { animation-delay: 0.2s; }
    .lc-typing span:nth-child(3) { animation-delay: 0.4s; }
    @keyframes typingBounce { 0%,60%,100%{transform:translateY(0); opacity:0.4;} 30%{transform:translateY(-5px); opacity:1;} }

    /* Markdown rendered inside bot messages */
    .lc-md h1,.lc-md h2,.lc-md h3 {
        font-family: var(--font-display);
        color: var(--cyan);
        margin: 12px 0 6px;
        line-height: 1.3;
    }
    .lc-md h1 { font-size: 15px; }
    .lc-md h2 { font-size: 14px; }
    .lc-md h3 { font-size: 13px; color: var(--yellow); }
    .lc-md p { margin: 6px 0; }
    .lc-md ul,.lc-md ol { padding-left: 18px; margin: 6px 0; }
    .lc-md li { margin: 3px 0; }
    .lc-md strong { color: #fffbe0; font-weight: 700; }
    .lc-md em { color: rgba(232,244,255,0.7); font-style: italic; }
    .lc-md code {
        font-family: var(--font-mono);
        font-size: 11px;
        background: rgba(0,229,255,0.1);
        border: 1px solid rgba(0,229,255,0.18);
        border-radius: 4px;
        padding: 1px 5px;
        color: #a8f0ff;
    }
    .lc-md pre {
        background: rgba(0,0,0,0.35);
        border: 1px solid rgba(0,229,255,0.15);
        border-radius: 10px;
        padding: 12px 14px;
        overflow-x: auto;
        margin: 10px 0;
    }
    .lc-md pre code {
        background: none; border: none; padding: 0;
        font-size: 12px; color: #c8f0ff;
    }
    .lc-md blockquote {
        border-left: 3px solid var(--cyan);
        margin: 8px 0;
        padding: 6px 12px;
        background: rgba(0,229,255,0.04);
        border-radius: 0 8px 8px 0;
        color: rgba(232,244,255,0.7);
        font-style: italic;
    }
    .lc-md hr { border: none; border-top: 1px solid var(--border); margin: 12px 0; }
    .lc-md a { color: var(--cyan); text-decoration: underline; }
    .lc-md table { width: 100%; border-collapse: collapse; font-size: 12px; margin: 8px 0; }
    .lc-md th { background: rgba(0,229,255,0.07); color: var(--cyan); padding: 6px 10px; text-align: left; font-family: var(--font-mono); font-size: 10px; }
    .lc-md td { padding: 5px 10px; border-bottom: 1px solid var(--border); color: rgba(232,244,255,0.8); }

    /* Input area */
    .lc-chat-form {
        display: flex;
        flex-direction: column;
        gap: 8px;
        padding: 12px 14px 14px;
        border-top: 1px solid rgba(0,229,255,0.08);
        background: rgba(0,0,0,0.15);
        flex-shrink: 0;
    }
    .lc-chat-input-row {
        display: flex;
        gap: 8px;
        align-items: flex-end;
    }
    .lc-chat-input {
        flex: 1;
        min-width: 0;
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: 12px;
        background: rgba(255,255,255,0.05);
        color: #f3fcff;
        padding: 10px 12px;
        font-family: var(--font-body);
        font-size: 13px;
        resize: none;
        min-height: 42px;
        max-height: 100px;
        line-height: 1.4;
        overflow-y: auto;
        transition: border-color 0.2s;
    }
    .lc-chat-input:focus { outline: none; border-color: rgba(0,229,255,0.3); background: rgba(0,229,255,0.04); }
    .lc-chat-input::placeholder { color: rgba(255,255,255,0.35); }
    .lc-chat-submit {
        border: none;
        border-radius: 12px;
        padding: 0 16px;
        height: 42px;
        background: linear-gradient(135deg, #00e5ff, #ff3cac);
        color: #06101a;
        font-weight: 700;
        font-size: 16px;
        cursor: pointer;
        flex-shrink: 0;
        transition: opacity 0.2s, transform 0.2s;
    }
    .lc-chat-submit:hover { opacity: 0.9; transform: scale(1.05); }
    .lc-chat-submit:disabled { opacity: 0.4; cursor: not-allowed; transform: none; }
    .lc-chat-hint {
        font-family: var(--font-mono);
        font-size: 9px;
        color: rgba(200,230,255,0.3);
        text-align: center;
    }
    @media (max-width: 480px) {
        .lc-chat-panel { width: calc(100vw - 32px); right: 16px; bottom: 16px; }
        .lc-chat-widget { right: 16px; bottom: 16px; }
    }
    </style>
</head>
<body>
<div class="grid-bg"></div>
<div class="bg-orb bg-orb-1"></div>
<div class="bg-orb bg-orb-2"></div>

<!-- ════ HEADER ════ -->
<header class="lc-header">
    <div class="header-brand">
        <button class="mobile-menu-btn btn" id="mobileMenuBtn" aria-label="Menú">☰</button>
        <span class="brand-logo">LC-ADVANCE</span>
        <div class="brand-dot"></div>
    </div>

    <nav class="header-crumb">
        <span class="crumb-sep"><?= htmlspecialchars($materia_actual) ?></span>
        <span class="crumb-sep">›</span>
        <span class="crumb-active"><?= htmlspecialchars($leccion['titulo']) ?></span>
    </nav>

    <div class="header-actions">
        <a href="dashboard.php<?= $return_params ?>" class="btn btn-ghost">← Dashboard</a>
        <a href="logout.php" class="btn btn-danger">Salir</a>
    </div>
</header>

<!-- ════ PAGE BODY ════ -->
<div class="page-body">

    <!-- Sidebar overlay -->
    <div class="sb-overlay" id="sbOverlay"></div>

    <!-- ════ SIDEBAR ════ -->
    <aside class="lc-sidebar" id="lcSidebar">

        <!-- User -->
        <div class="sb-section">
            <div class="sb-user">
                <div class="sb-avatar">🎮</div>
                <div class="sb-user-info">
                    <div class="sb-username"><?= htmlspecialchars($user_data['nombre']) ?></div>
                    <div class="sb-level">⚡ Nivel <?= $user_data['nivel'] ?></div>
                </div>
            </div>
            <div class="xp-row">
                <span>XP</span>
                <span id="xpPct"><?= $user_data['progreso'] ?>%</span>
            </div>
            <div class="xp-track">
                <div class="xp-fill" id="xpFill" style="width:<?= $user_data['progreso'] ?>%"></div>
            </div>
            <div class="sb-points">Puntos totales: <strong id="totalPts"><?= number_format($user_data['puntos']) ?></strong></div>
        </div>

        <!-- Current lesson -->
        <div class="sb-section">
            <div class="sb-label">📍 Lección Actual</div>
            <div class="sb-lesson-title"><?= htmlspecialchars($leccion['titulo']) ?></div>
            <div class="sb-lesson-sub"><?= htmlspecialchars($materia_actual) ?></div>
        </div>

        <!-- Score -->
        <div class="sb-section">
            <div class="sb-label">🏅 Tu Puntuación</div>
            <div class="sb-score-card">
                <div class="sb-score-row">
                    <span class="sb-score-val" id="sbScoreVal"><?= $old_score ?></span>
                    <span class="sb-score-max">/ <?= $NUM_PREGUNTAS_QUIZ_FINAL ?></span>
                </div>
                <div class="sb-score-track">
                    <div class="sb-score-fill" id="sbScoreFill" style="width:<?= $progress_percent ?>%"></div>
                </div>
                <div class="sb-status" id="sbStatus">
                    <?= $completed ? '✔ Completada' : '○ Pendiente' ?>
                </div>
            </div>
        </div>

        <!-- Quiz CTA -->
        <div class="sb-section">
            <button class="sb-cta-quiz open-quiz-btn">
                🧠 <?= $completed ? 'Repetir Quiz' : 'Iniciar Quiz' ?>
            </button>
            <a href="dashboard.php<?= $return_params ?>" class="sb-back">← Volver al Dashboard</a>
        </div>

        <!-- Lesson nav -->
        <?php if (count($lecciones_materia) > 1): ?>
        <div class="sb-section">
            <div class="sb-label">📚 <?= htmlspecialchars(strtoupper($materia_actual)) ?></div>
            <nav class="sb-nav">
                <?php foreach ($lecciones_materia as $lm):
                    $is_current = $lm['slug'] === $slug;
                    $is_done    = in_array($lm['slug'], $completed_slugs);
                    $cls = 'sb-nav-item' . ($is_current ? ' active' : '') . ($is_done ? ' done' : '');
                    $nav_p = $return_params ? '&' . ltrim($return_params, '?') : '';
                    $href  = "leccion_detalle.php?slug=" . urlencode($lm['slug']) . $nav_p;
                ?>
                <a href="<?= $is_current ? '#' : htmlspecialchars($href) ?>"
                   class="<?= $cls ?>">
                    <span class="nav-pip"></span>
                    <?= htmlspecialchars($lm['titulo']) ?>
                </a>
                <?php endforeach; ?>
            </nav>
        </div>
        <?php endif; ?>

    </aside><!-- /sidebar -->

    <!-- ════ MAIN ════ -->
    <main class="lc-main">
        <div class="content-scroll">
            <div class="lesson-card">

                <!-- Lesson head -->
                <div class="lesson-card-head">
                    <div class="lh-materia"><?= htmlspecialchars($materia_actual) ?></div>
                    <h1 class="lh-title"><?= htmlspecialchars($leccion['titulo']) ?></h1>
                    <div class="lh-meta">
                        <span class="meta-chip <?= $completed ? 'status-done' : 'status-pend' ?>">
                            <?= $completed ? '✔ Completada' : '○ Pendiente' ?>
                        </span>
                        <span class="meta-chip score">
                            Score: <?= $old_score ?>/<?= $NUM_PREGUNTAS_QUIZ_FINAL ?>
                        </span>
                        <?php if ($materia_actual): ?>
                        <span class="meta-chip status-pend"><?= htmlspecialchars($materia_actual) ?></span>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Lesson body -->
                <div class="lesson-card-body">
                    <div class="lesson-content">
                        <?= trim($leccion['contenido']) ?>
                    </div>
                </div>

                <!-- Actions -->
                <div class="lesson-actions">
                    <button class="action-btn action-quiz open-quiz-btn">
                        🧠 <?= $completed ? 'Repetir Quiz' : 'Iniciar Quiz' ?>
                    </button>
                    <a href="Examen/sistemC.php?personaje=<?= $prof_id ?>&dialogo=1&pregunta=0&return_url=<?= $current_url ?>&slug=<?= $examen_slug ?>"
                       class="action-btn action-exam">
                        ⚔️ Examen Final
                    </a>
                </div>

            </div><!-- /lesson-card -->
        </div><!-- /content-scroll -->
    </main>

</div><!-- /page-body -->

<!-- ════ QUIZ MODAL ════ -->
<div id="quizOverlay" class="quiz-overlay">
    <div class="quiz-modal">
        <div class="qm-head">
            <span class="qm-title">Quiz — <?= htmlspecialchars($leccion['titulo']) ?></span>
            <button class="qm-close" id="quizClose">✕</button>
        </div>
        <div class="qm-body" id="quizBody">
            <p style="color:var(--muted); font-family:var(--font-mono); font-size:11px;">Cargando preguntas...</p>
        </div>
    </div>
</div>

<!-- Chat adaptativo -->
<div id="lcChatWidget" class="lc-chat-widget">
    <button id="lcChatToggle" class="lc-chat-toggle" title="Abrir asistente">💬</button>
    <div id="lcChatPanel" class="lc-chat-panel" aria-hidden="true" aria-label="Asistente LC-Tutor">
        <div class="lc-chat-header">
            <div class="lc-chat-header-info">
                <div class="lc-chat-avatar">🤖</div>
                <div>
                    <div class="lc-chat-title">LC-Tutor</div>
                    <div class="lc-chat-subtitle">Asistente educativo · pregunta cualquier cosa</div>
                </div>
            </div>
            <button id="lcChatClose" class="lc-chat-close" type="button" aria-label="Cerrar chat">✕</button>
        </div>
        <div id="lcChatMessages" class="lc-chat-messages">
            <div class="lc-chat-message bot">
                <div class="lc-md">
                    <p>👋 Hola, soy <strong>LC-Tutor</strong>. Puedo ayudarte con dudas de esta lección o cualquier tema: matemáticas, ciencias, programación, historia…</p>
                    <p>¿Qué quieres saber?</p>
                </div>
            </div>
        </div>
        <form id="lcChatForm" class="lc-chat-form" onsubmit="event.preventDefault(); sendChatQuestion(); return false;">
            <div class="lc-chat-input-row">
                <textarea id="lcChatInput" class="lc-chat-input" name="question"
                    placeholder="Pregunta lo que necesites…" autocomplete="off" rows="1"></textarea>
                <button id="lcChatSend" type="submit" class="lc-chat-submit" title="Enviar">➤</button>
            </div>
            <div class="lc-chat-options-row">
                <label for="lcChatProvider">IA:</label>
                <select id="lcChatProvider" name="provider" class="lc-chat-provider">
                    <option value="auto" selected>Auto (API/local)</option>
                    <option value="api">IA Remota</option>
                    <option value="local">IA Local</option>
                </select>
            </div>
            <div class="lc-chat-hint">Enter para enviar · Shift+Enter para nueva línea</div>
        </form>
    </div>
</div>

<!-- Toast container -->
<div class="toast-wrap" id="toastWrap"></div>
<div id="globalLoader" aria-live="polite" aria-busy="false">
    <div class="loader-box">
        <div class="loader-spinner"></div>
        <div id="globalLoaderText">Cargando...</div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {

    // ── Sidebar mobile ──
    const sidebar   = document.getElementById('lcSidebar');
    const overlay   = document.getElementById('sbOverlay');
    const menuBtn   = document.getElementById('mobileMenuBtn');

    function openSidebar()  { sidebar.classList.add('open');  overlay.classList.add('active'); }
    function closeSidebar() { sidebar.classList.remove('open'); overlay.classList.remove('active'); }
    menuBtn.addEventListener('click', () => sidebar.classList.contains('open') ? closeSidebar() : openSidebar());
    overlay.addEventListener('click', closeSidebar);

    // ── Quiz ──
    const quizOverlay  = document.getElementById('quizOverlay');
    const quizBody     = document.getElementById('quizBody');
    const quizClose    = document.getElementById('quizClose');
    const openBtns     = document.querySelectorAll('.open-quiz-btn');
    const quizData     = <?= json_encode($quiz_selected) ?>;

    openBtns.forEach(b => b.addEventListener('click', openQuiz));
    quizClose.addEventListener('click', closeQuiz);
    quizOverlay.addEventListener('click', e => { if (e.target === quizOverlay) closeQuiz(); });

    function openQuiz()  { quizOverlay.classList.add('open'); renderQuiz(); }
    function closeQuiz() {
        quizOverlay.classList.remove('open');
        quizBody.innerHTML = '<p style="color:var(--muted);font-family:var(--font-mono);font-size:11px;">Cargando preguntas...</p>';
    }

    function esc(s) {
        return String(s).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;').replace(/'/g,'&#39;');
    }

    function renderQuiz() {
        if (!quizData.length) {
            quizBody.innerHTML = '<p style="color:var(--muted);font-family:var(--font-mono);font-size:11px;">No hay preguntas disponibles.</p>';
            return;
        }

        let html = '<form id="quizForm">';
        quizData.forEach((q, i) => {
            const name = `q${i}`;
            const shuffled = [...q.opciones].sort(() => Math.random() - 0.5);
            html += `<div class="q-card">
                <div class="q-num">Pregunta ${i+1} de ${quizData.length}</div>
                <div class="q-text">${esc(q.pregunta)}</div>
                <div class="q-options">`;
            shuffled.forEach(op => {
                html += `<label class="q-option">
                    <input type="radio" name="${name}" value="${esc(op)}" required>
                    <span class="q-radio"></span>
                    <span>${esc(op)}</span>
                </label>`;
            });
            html += `</div></div>`;
        });
        html += `<button type="submit" class="qm-submit">✅ Enviar Respuestas</button></form>`;
        quizBody.innerHTML = html;

        document.getElementById('quizForm').addEventListener('submit', submitQuiz);

        if (window.MathJax?.typesetPromise) MathJax.typesetPromise([quizBody]);
    }

    async function submitQuiz(e) {
        e.preventDefault();
        showGlobalLoader('Procesando tu quiz...');
        let oldPuntos = 0, oldNivel = 1;
        try {
            const s = await fetch('src/funciones.php', { method: 'POST', body: new URLSearchParams({ accion: 'obtener_estado' }) });
            const d = await s.json();
            oldPuntos = d.puntos || 0;
            oldNivel  = d.nivel  || 1;
        } catch(ex) {}

        const fd = new FormData(e.target);
        fd.append('accion', 'calificar_quiz');
        fd.append('slug', '<?= addslashes($slug) ?>');

        try {
            const r    = await fetch('src/funciones.php', { method: 'POST', body: fd });
            const data = await r.json();

            if (!data.ok) {
                quizBody.innerHTML = `<div class="result-card"><p style="color:var(--pink);font-family:var(--font-mono);font-size:11px;">Error: ${esc(data.mensaje || data.error || 'Error al calificar')}</p></div>`;
                return;
            }

            const score = data.score || 0;
            const xp    = data.xp_ganado || 0;

            const sr    = await fetch('src/funciones.php', { method: 'POST', body: new URLSearchParams({ accion: 'obtener_estado' }) });
            const state = await sr.json();

            updateSidebar(state, score);

            let html = `<div class="result-card">
                <div class="sb-score-row">
                    <span class="result-score-big">${score}</span>
                    <span class="sb-score-max" style="font-size:14px; margin-left:6px;">/ ${quizData.length}</span>
                </div>
                <div class="result-sub">Preguntas correctas</div>
                <div class="result-meta">
                    <div class="result-meta-item">XP ganado: <strong>+${xp}</strong></div>
                    <div class="result-meta-item">Puntos totales: <strong>${(state.puntos||0).toLocaleString()}</strong></div>
                    <div class="result-meta-item">Nivel: <strong>${state.nivel||1}</strong></div>
                </div>
            </div>`;

            if (Array.isArray(data.details)) {
                html += '<div class="detail-list">';
                data.details.forEach((d, idx) => {
                    const cls = d.acertada ? 'correct' : 'wrong';
                    html += `<div class="detail-item ${cls}">
                        <div class="detail-q"><strong>${idx+1}.</strong> ${esc(d.pregunta)}</div>
                        <div class="detail-a">Tu respuesta: ${esc(d.respuesta || '—')}</div>
                        ${d.acertada
                            ? '<div class="detail-ok">✔ Correcto</div>'
                            : `<div class="detail-wrong-txt">✖ Incorrecto — Correcta: <strong>${esc(d.correcta)}</strong></div>`}
                    </div>`;
                });
                html += '</div>';
            }

            html += `<button class="qm-submit" style="margin-top:20px;" onclick="location.reload()">Cerrar y Continuar</button>`;
            quizBody.innerHTML = html;

            if (xp > 0) {
                const el = document.createElement('div');
                el.className = 'xp-fly';
                el.textContent = `+${xp} XP`;
                document.body.appendChild(el);
                setTimeout(() => el.remove(), 2200);
            }

            if (state.nivel > oldNivel) showToast(`¡Subiste al nivel ${state.nivel}! 🎉`);

        } catch (err) {
            console.error(err);
            quizBody.innerHTML = `<div class="result-card"><p style="color:var(--pink);font-family:var(--font-mono);font-size:11px;">Error de conexión con el servidor.</p></div>`;
        } finally {
            hideGlobalLoader();
        }
    }

    function updateSidebar(state, score) {
        const pct = Math.round(state.progreso || Math.min(100, ((state.puntos||0) % 500) / 5));
        const xpFill = document.getElementById('xpFill');
        const xpPct  = document.getElementById('xpPct');
        if (xpFill) xpFill.style.width = pct + '%';
        if (xpPct)  xpPct.textContent  = pct + '%';

        const ptEl = document.getElementById('totalPts');
        if (ptEl && state.puntos != null) ptEl.textContent = state.puntos.toLocaleString();

        const sbVal  = document.getElementById('sbScoreVal');
        const sbFill = document.getElementById('sbScoreFill');
        const sbStat = document.getElementById('sbStatus');
        if (sbVal)  sbVal.textContent  = score;
        if (sbFill) sbFill.style.width = Math.round((score / <?= $NUM_PREGUNTAS_QUIZ_FINAL ?: 1 ?>) * 100) + '%';
        if (sbStat && score > 0) { sbStat.textContent = '✔ Completada'; sbStat.style.color = 'var(--green)'; }
    }

    function showToast(msg, ms = 3500) {
        const wrap = document.getElementById('toastWrap');
        const t = document.createElement('div');
        t.className = 'toast';
        t.textContent = msg;
        wrap.appendChild(t);
        setTimeout(() => { t.classList.add('hide'); setTimeout(() => t.remove(), 400); }, ms);
    }

    const chatToggle   = document.getElementById('lcChatToggle');
    const chatPanel    = document.getElementById('lcChatPanel');
    const chatClose    = document.getElementById('lcChatClose');
    const chatForm     = document.getElementById('lcChatForm');
    const chatSend     = document.getElementById('lcChatSend');
    const chatInput    = document.getElementById('lcChatInput');
    const chatMessages = document.getElementById('lcChatMessages');

    // Configure marked
    if (window.marked) {
        marked.setOptions({
            breaks: true,
            gfm: true
        });
    }

    function renderMd(text) {
        if (!window.marked) return `<p>${text.replace(/\n/g, '<br>')}</p>`;
        try { return marked.parse(text); } catch(e) { return `<p>${text}</p>`; }
    }

    function appendChatMessage(text, sender = 'bot', isMarkdown = false) {
        const msg = document.createElement('div');
        msg.className = `lc-chat-message ${sender}`;
        if (sender === 'bot' && isMarkdown) {
            const inner = document.createElement('div');
            inner.className = 'lc-md';
            inner.innerHTML = renderMd(text);
            msg.appendChild(inner);
        } else {
            msg.textContent = text;
        }
        chatMessages.appendChild(msg);
        chatMessages.scrollTop = chatMessages.scrollHeight;
        return msg;
    }

    function showTyping() {
        const msg = document.createElement('div');
        msg.className = 'lc-chat-message bot thinking';
        msg.id = 'lcTyping';
        msg.innerHTML = '<div class="lc-typing"><span></span><span></span><span></span></div>';
        chatMessages.appendChild(msg);
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }

    function removeTyping() {
        document.getElementById('lcTyping')?.remove();
    }

    const globalLoader = document.getElementById('globalLoader');
    const globalLoaderText = document.getElementById('globalLoaderText');

    function showGlobalLoader(text = 'Cargando...') {
        if (!globalLoader) return;
        globalLoaderText.textContent = text;
        globalLoader.setAttribute('aria-busy', 'true');
        globalLoader.classList.add('active');
    }

    function hideGlobalLoader() {
        if (!globalLoader) return;
        globalLoader.setAttribute('aria-busy', 'false');
        globalLoader.classList.remove('active');
    }

    function createDraftMessage() {
        const msg = document.createElement('div');
        msg.className = 'lc-chat-message bot';
        const inner = document.createElement('div');
        inner.className = 'lc-md lc-chat-draft';
        inner.textContent = '';
        msg.appendChild(inner);
        chatMessages.appendChild(msg);
        chatMessages.scrollTop = chatMessages.scrollHeight;
        return inner;
    }

    function typeWriterEffect(text, target) {
        return new Promise(resolve => {
            const total = text.length;
            if (total === 0) {
                target.textContent = '';
                resolve();
                return;
            }
            const maxSteps = 120;
            const steps = Math.min(maxSteps, total);
            const chunk = Math.max(1, Math.ceil(total / steps));
            const duration = Math.min(2200, Math.max(900, Math.round(total * 10)));
            const interval = Math.max(10, Math.floor(duration / steps));
            let index = 0;
            const timer = setInterval(() => {
                index = Math.min(total, index + chunk);
                target.textContent = text.slice(0, index);
                chatMessages.scrollTop = chatMessages.scrollHeight;
                if (index >= total) {
                    clearInterval(timer);
                    resolve();
                }
            }, interval);
        });
    }

    function toggleChat(open) {
        if (!chatPanel) return;
        chatPanel.classList.toggle('open', open);
        chatPanel.setAttribute('aria-hidden', open ? 'false' : 'true');
        if (open) setTimeout(() => chatInput.focus(), 200);
    }

    chatToggle?.addEventListener('click', () => toggleChat(true));
    chatClose?.addEventListener('click',  () => toggleChat(false));

    // Auto-resize textarea
    chatInput?.addEventListener('input', function() {
        this.style.height = 'auto';
        this.style.height = Math.min(this.scrollHeight, 100) + 'px';
    });

    // Enter sends, Shift+Enter is newline
    chatInput?.addEventListener('keydown', function(e) {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            sendChatQuestion();
        }
    });

    async function sendChatQuestion() {
        const question = chatInput.value.trim();
        if (!question) return;

        appendChatMessage(question, 'user');
        chatInput.value = '';
        chatInput.style.height = 'auto';
        chatSend.disabled = true;
        showTyping();
        showGlobalLoader('Consultando a LC-Tutor...');

        try {
            const response = await fetch('ai_tutor.php', {
                method: 'POST',
                credentials: 'same-origin',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                cache: 'no-store',
                body: new URLSearchParams({
                    slug: '<?= addslashes($slug) ?>',
                    lesson_title: '<?= addslashes($leccion['titulo']) ?>',
                    lesson_subject: '<?= addslashes($materia_actual) ?>',
                    correctas: 0,
                    total: 1,
                    question,
                    provider: document.getElementById('lcChatProvider')?.value || 'auto'
                })
            });

            const text = await response.text();
            let result;
            try {
                result = JSON.parse(text);
            } catch (parseError) {
                throw new Error(`Respuesta inválida del servidor (${response.status}): ${text.slice(0, 200)}`);
            }

            removeTyping();
            if (!response.ok || !result.ok) {
                const errorMsg = result.error || `HTTP ${response.status}`;
                appendChatMessage(`❌ Error del asistente: ${errorMsg}`, 'bot', true);
            } else {
                const draft = createDraftMessage();
                const aiText = result.ai_text || 'No se recibió respuesta del asistente.';
                await typeWriterEffect(aiText, draft);
                if (aiText && window.marked) {
                    draft.innerHTML = renderMd(aiText);
                }
            }
        } catch (err) {
            removeTyping();
            appendChatMessage(`❌ Error al conectar con el asistente: ${err.message}`, 'bot', true);
        } finally {
            chatSend.disabled = false;
            hideGlobalLoader();
            chatInput.focus();
        }
    }

    chatSend?.addEventListener('click', sendChatQuestion);

    if (window.MathJax?.typesetPromise) MathJax.typesetPromise([document.querySelector('.lesson-content')]);
});
</script>

<script src="assets/js/app.js"></script>
</body>
</html>