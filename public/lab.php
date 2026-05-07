<?php
require_once __DIR__ . '/../src/Config/config.php';
requireLogin(true);

$active_challenge = $_GET['challenge'] ?? 'prog-sum-array';

$challenges = require __DIR__ . '/../src/Config/challenges.php';

if (!isset($challenges[$active_challenge])) {
    $active_challenge = 'prog-sum-array';
}

$subjects = ['Programación', 'Pensamiento Matemático III', 'Física I', 'Química I', 'Ecosistemas'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laboratorio | LC-ADVANCE</title>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500;700&family=Syne:wght@700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.16.9/dist/katex.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/katex@0.16.9/dist/katex.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/katex@0.16.9/dist/contrib/auto-render.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/marked@9/marked.min.js"></script>
    <style>
        :root {
            --bg: #060a12;
            --surface: #0c1220;
            --surface2: #101828;
            --border: rgba(0, 230, 255, 0.12);
            --border2: rgba(0, 230, 255, 0.22);
            --cyan: #00e5ff;
            --cyan-dim: rgba(0, 229, 255, 0.12);
            --pink: #ff3cac;
            --green: #00ff87;
            --yellow: #ffd23f;
            --red: #ff4d6d;
            --text: #e8f4ff;
            --text-secondary: rgba(200, 230, 255, 0.75);
            --muted: rgba(200, 230, 255, 0.5);
            --font-display: "Syne", sans-serif;
            --font-body: "Space Grotesk", sans-serif;
            --font-mono: "JetBrains Mono", monospace;
            --transition: all 0.22s ease;
            --radius: 12px;
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            background: var(--bg);
            color: var(--text);
            font-family: var(--font-body);
            font-size: 14px;
            min-height: 100vh;
            overflow: hidden;
        }

        /* ─── BACKGROUNDS ───────────────────────────────────────── */
        .grid-bg {
            position: fixed; inset: 0; pointer-events: none; z-index: 0;
            background-image:
                linear-gradient(rgba(0, 229, 255, 0.025) 1px, transparent 1px),
                linear-gradient(90deg, rgba(0, 229, 255, 0.018) 1px, transparent 1px);
            background-size: 48px 48px;
        }
        .bg-orb {
            position: fixed; border-radius: 50%; filter: blur(90px); pointer-events: none; z-index: 0;
        }
        .bg-orb-1 {
            width: 500px; height: 500px;
            background: radial-gradient(circle, rgba(0, 229, 255, 0.07), transparent 70%);
            top: -120px; right: -100px;
        }
        .bg-orb-2 {
            width: 350px; height: 350px;
            background: radial-gradient(circle, rgba(255, 60, 172, 0.055), transparent 70%);
            bottom: 0; left: -80px;
        }

        /* ─── HEADER ─────────────────────────────────────────────── */
        header.header {
            position: sticky; top: 0; z-index: 100;
            padding: 0 28px; min-height: 58px;
            display: flex; align-items: center; justify-content: space-between;
            background: rgba(6, 10, 18, 0.88); backdrop-filter: blur(18px);
            border-bottom: 1px solid var(--border);
        }
        .logo-text {
            font-family: var(--font-display); font-size: 17px; font-weight: 800;
            background: linear-gradient(90deg, var(--cyan), var(--pink));
            -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
        }

        /* ─── LAYOUT ─────────────────────────────────────────────── */
        .app-layout {
            display: grid;
            grid-template-columns: 300px 1fr;
            height: calc(100vh - 58px);
            position: relative; z-index: 1;
        }

        /* ─── SIDEBAR ────────────────────────────────────────────── */
        .sidebar {
            background: var(--surface);
            border-right: 1px solid var(--border);
            display: flex; flex-direction: column; overflow: hidden;
        }
        .sidebar-header {
            padding: 20px; border-bottom: 1px solid var(--border);
            flex-shrink: 0; display: flex; align-items: center; gap: 12px;
        }
        .logo {
            width: 36px; height: 36px;
            background: linear-gradient(135deg, var(--cyan), var(--green));
            border-radius: 8px; display: flex; align-items: center; justify-content: center;
            font-weight: 800; font-size: 14px; color: var(--bg);
        }
        .logo-text-sb { font-size: 14px; font-weight: 700; letter-spacing: 0.5px; }

        .challenge-list {
            flex: 1; overflow-y: auto; overflow-x: hidden; padding: 12px;
        }
        .challenge-list::-webkit-scrollbar { width: 6px; }
        .challenge-list::-webkit-scrollbar-track { background: transparent; }
        .challenge-list::-webkit-scrollbar-thumb { background: var(--border); border-radius: 3px; }

        .nav-title {
            padding: 12px 12px 8px; font-size: 11px; font-weight: 600;
            text-transform: uppercase; letter-spacing: 1px; color: var(--muted);
        }
        .subject-group { margin-bottom: 12px; }

        .challenge-item {
            padding: 12px; border-radius: 8px; cursor: pointer;
            transition: var(--transition); border: 1px solid transparent; margin-bottom: 4px;
            display: flex; justify-content: space-between; align-items: flex-start;
        }
        .challenge-item:hover { background: var(--surface2); border-color: var(--border); }
        .challenge-item.active { background: var(--cyan-dim); border-color: var(--cyan); }

        .challenge-item-left { flex: 1; min-width: 0; }
        .challenge-name { font-size: 13px; font-weight: 500; margin-bottom: 4px; }
        .challenge-meta { display: flex; gap: 8px; font-size: 11px; color: var(--muted); }

        /* ── Completion badge in sidebar ── */
        .challenge-done-icon {
            color: var(--green); font-size: 14px; flex-shrink: 0; margin-left: 6px;
            opacity: 0; transition: opacity 0.3s;
        }
        .challenge-done-icon.visible { opacity: 1; }

        .difficulty { padding: 2px 6px; border-radius: 4px; font-weight: 500; }
        .easy   { background: rgba(0, 255, 135, 0.15); color: var(--green); }
        .medium { background: rgba(255, 210, 63, 0.15); color: var(--yellow); }
        .hard   { background: rgba(255, 60, 172, 0.15); color: var(--pink); }
        .points { color: var(--green); font-weight: 500; }

        /* ─── MAIN PANEL ─────────────────────────────────────────── */
        .main-panel {
            display: flex; flex-direction: column; overflow: hidden; padding: 24px;
        }
        .problem-header {
            margin-bottom: 20px; display: flex;
            justify-content: space-between; align-items: center;
            flex-wrap: wrap; gap: 16px;
        }
        .problem-title {
            font-size: 24px; font-weight: 700;
            display: flex; align-items: center; gap: 12px; flex-wrap: wrap;
        }
        .problem-badge {
            font-size: 11px; padding: 4px 10px; border-radius: 20px; font-weight: 600;
        }
        .completed-badge {
            font-size: 11px; padding: 4px 10px; border-radius: 20px; font-weight: 600;
            background: rgba(0,255,135,0.15); color: var(--green); display: none;
        }
        .completed-badge.visible { display: inline-flex; align-items: center; gap: 4px; }

        .problem-actions { display: flex; gap: 8px; }

        /* ─── BUTTONS ────────────────────────────────────────────── */
        .btn {
            padding: 10px 18px; border-radius: 8px;
            font-family: var(--font-body); font-size: 13px; font-weight: 600;
            cursor: pointer; transition: var(--transition);
            border: 1px solid var(--border2); display: flex; align-items: center; gap: 8px;
        }
        .btn-run { background: var(--green); color: var(--bg); border-color: var(--green); }
        .btn-run:hover {
            background: #33ff9f; box-shadow: 0 0 25px rgba(0, 255, 135, 0.35);
            transform: translateY(-2px);
        }
        .btn-run:disabled {
            background: var(--muted); border-color: var(--muted); cursor: not-allowed;
            transform: none; box-shadow: none;
        }
        .btn-reset { background: transparent; color: var(--muted); }
        .btn-reset:hover { background: var(--surface2); color: var(--text); }

        /* ─── CONTENT AREA ───────────────────────────────────────── */
        .content-area {
            flex: 1; display: grid; grid-template-columns: 1fr 380px; gap: 24px; overflow: hidden;
        }
        .workspace-panel {
            background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius);
            display: flex; flex-direction: column; overflow: hidden;
        }
        .workspace-tabs {
            display: flex; background: var(--surface2); border-bottom: 1px solid var(--border);
            padding: 0 16px;
        }
        .workspace-tab {
            padding: 14px 16px; font-size: 12px; font-weight: 600;
            color: var(--muted); cursor: pointer; border-bottom: 2px solid transparent;
            transition: var(--transition);
        }
        .workspace-tab.active { color: var(--text); border-bottom-color: var(--cyan); }

        .editor-area { flex: 1; display: flex; overflow: hidden; }

        /* Code editor */
        .code-editor {
            flex: 1; display: flex; flex-direction: column; background: #0a0e14; overflow: hidden;
        }
        .code-toolbar {
            display: flex; align-items: center; justify-content: space-between;
            padding: 8px 16px; border-bottom: 1px solid var(--border); background: #080c14;
        }
        .code-toolbar-lang {
            font-family: var(--font-mono); font-size: 11px; color: var(--muted);
            background: var(--surface2); padding: 3px 10px; border-radius: 4px;
        }
        .code-toolbar-run {
            padding: 6px 14px; background: var(--green); color: var(--bg);
            border: none; border-radius: 6px; font-family: var(--font-mono);
            font-size: 11px; font-weight: 700; cursor: pointer;
            transition: var(--transition); display: flex; align-items: center; gap: 6px;
        }
        .code-toolbar-run:hover { background: #33ff9f; box-shadow: 0 0 16px rgba(0,255,135,0.4); }
        .code-editor-inner { flex: 1; overflow: auto; padding: 16px; }
        .code-editor-inner textarea {
            width: 100%; height: 100%; min-height: 200px; background: transparent; border: none;
            color: var(--text); font-family: var(--font-mono); font-size: 13px; line-height: 1.7;
            resize: none; outline: none; tab-size: 2;
        }

        /* Interactive area */
        .interactive-area {
            flex: 1; padding: 20px; overflow-y: auto;
            display: flex; flex-direction: column; gap: 16px;
        }
        .info-card {
            background: var(--surface2); border: 1px solid var(--border); border-radius: 10px; padding: 16px;
        }
        .info-card h4 {
            font-size: 11px; font-weight: 600; text-transform: uppercase;
            letter-spacing: 1px; color: var(--muted); margin-bottom: 10px;
        }
        .formula-display {
            background: var(--bg); border: 1px solid var(--border); border-radius: 8px;
            padding: 12px; text-align: center; margin: 10px 0; font-size: 16px;
        }
        .controls-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 16px; }
        .control-group {
            background: var(--bg); border: 1px solid var(--border); border-radius: 8px; padding: 14px;
        }
        .control-group label { display: block; font-size: 12px; font-weight: 600; color: var(--muted); margin-bottom: 8px; }
        .control-group input[type="range"] {
            width: 100%; height: 6px; border-radius: 3px; background: var(--surface2);
            outline: none; -webkit-appearance: none; cursor: pointer;
        }
        .control-group input[type="range"]::-webkit-slider-thumb {
            -webkit-appearance: none; width: 18px; height: 18px; border-radius: 50%;
            background: var(--cyan); cursor: pointer; box-shadow: 0 0 10px rgba(0, 229, 255, 0.5);
        }
        .slider-value { display: flex; justify-content: space-between; align-items: center; margin-top: 6px; }
        .slider-value span:first-child { font-size: 10px; color: var(--muted); }
        .slider-value span:last-child {
            font-family: var(--font-mono); font-size: 15px; font-weight: 600; color: var(--cyan);
        }
        .result-box {
            background: linear-gradient(135deg, rgba(0, 255, 135, 0.1), rgba(0, 229, 255, 0.1));
            border: 1px solid var(--green); border-radius: 12px;
            padding: 20px; text-align: center; margin-top: 16px;
        }
        .result-label { font-size: 12px; color: var(--muted); margin-bottom: 8px; }
        .result-value {
            font-size: 32px; font-weight: 800;
            background: linear-gradient(90deg, var(--green), var(--cyan));
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;
        }
        .chart-area {
            background: var(--surface2); border: 1px solid var(--border);
            border-radius: 10px; padding: 16px; height: 200px; margin-top: 16px;
        }

        /* ─── SIDE PANEL ─────────────────────────────────────────── */
        .side-panel {
            background: var(--surface); border: 1px solid var(--border);
            border-radius: var(--radius); padding: 20px; overflow-y: auto;
            display: flex; flex-direction: column; gap: 20px;
        }
        .side-panel::-webkit-scrollbar { width: 6px; }
        .side-panel::-webkit-scrollbar-track { background: transparent; }
        .side-panel::-webkit-scrollbar-thumb { background: var(--border); border-radius: 3px; }

        .side-section {}
        .side-section h4 {
            font-size: 11px; font-weight: 600; text-transform: uppercase;
            letter-spacing: 1px; color: var(--muted); margin-bottom: 10px;
        }

        /* Answer section */
        .answer-input-group {
            background: var(--bg); border: 2px solid var(--border);
            border-radius: 10px; padding: 16px;
        }
        .answer-input-group label {
            display: block; font-size: 13px; font-weight: 600;
            color: var(--text); margin-bottom: 10px;
        }
        .answer-input {
            width: 100%; padding: 14px; background: var(--surface2);
            border: 1px solid var(--border); border-radius: 8px;
            color: var(--text); font-family: var(--font-mono); font-size: 16px;
            outline: none; transition: var(--transition);
        }
        .answer-input:focus { border-color: var(--cyan); box-shadow: 0 0 15px rgba(0, 229, 255, 0.2); }
        .answer-input.correct { border-color: var(--green); box-shadow: 0 0 15px rgba(0,255,135,0.2); }
        .answer-input.incorrect { border-color: var(--red); box-shadow: 0 0 15px rgba(255,77,109,0.15); }

        /* Test results */
        .test-results { display: flex; flex-direction: column; gap: 8px; }
        .test-row {
            display: flex; align-items: flex-start; gap: 10px; padding: 10px;
            border-radius: 8px; font-family: var(--font-mono); font-size: 12px;
            border: 1px solid transparent;
        }
        .test-row.pass {
            background: rgba(0, 255, 135, 0.07); border-color: rgba(0, 255, 135, 0.25);
        }
        .test-row.fail {
            background: rgba(255, 77, 109, 0.07); border-color: rgba(255, 77, 109, 0.25);
        }
        .test-row.pending {
            background: var(--surface2); border-color: var(--border);
        }
        .test-icon { font-size: 14px; flex-shrink: 0; margin-top: 1px; }
        .test-detail { flex: 1; }
        .test-name { font-weight: 600; margin-bottom: 2px; }
        .test-name.pass { color: var(--green); }
        .test-name.fail { color: var(--red); }
        .test-name.pending { color: var(--muted); }
        .test-info { color: var(--muted); font-size: 11px; line-height: 1.4; }

        /* Progress bar for tests */
        .tests-summary {
            display: flex; align-items: center; gap: 12px;
            padding: 10px 12px; background: var(--bg);
            border-radius: 8px; border: 1px solid var(--border); margin-bottom: 12px;
        }
        .tests-summary-text { font-size: 12px; font-weight: 600; }
        .tests-progress-bar { flex: 1; height: 6px; background: var(--surface2); border-radius: 3px; overflow: hidden; }
        .tests-progress-fill {
            height: 100%; border-radius: 3px; transition: width 0.4s ease;
            background: linear-gradient(90deg, var(--green), var(--cyan));
        }

        /* AI feedback */
        .ai-feedback {
            background: var(--surface2); border: 1px solid var(--border);
            border-radius: 10px; padding: 16px; display: none; animation: fadeIn 0.3s ease;
        }
        .ai-feedback.visible { display: block; }
        .ai-feedback.correct-feedback { border-color: rgba(0,255,135,0.35); }
        .ai-feedback.incorrect-feedback { border-color: rgba(255,77,109,0.25); }

        @keyframes fadeIn { from { opacity: 0; transform: translateY(6px); } to { opacity: 1; transform: translateY(0); } }

        .ai-feedback-header {
            display: flex; align-items: center; gap: 10px; margin-bottom: 12px;
        }
        .ai-avatar {
            width: 32px; height: 32px;
            background: linear-gradient(135deg, var(--cyan), var(--pink));
            border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 16px;
        }
        .ai-name { font-size: 13px; font-weight: 600; color: var(--text); }
        .ai-text { font-size: 13px; line-height: 1.7; color: var(--text-secondary); }

        /* Theory / examples / hint */
        .theory-box {
            background: rgba(0, 229, 255, 0.08); border-left: 3px solid var(--cyan);
            padding: 14px; border-radius: 0 8px 8px 0; font-size: 13px; line-height: 1.6;
        }
        .examples-box {
            background: var(--bg); border: 1px solid var(--border); border-radius: 8px;
            padding: 12px; font-family: var(--font-mono); font-size: 12px; color: var(--green);
            line-height: 1.6; white-space: pre-wrap;
        }
        .hint-box {
            background: rgba(255, 210, 63, 0.08); border: 1px solid rgba(255, 210, 63, 0.25);
            border-radius: 8px; padding: 12px; font-size: 13px; color: var(--yellow); display: none;
        }
        .hint-box.visible { display: block; animation: fadeIn 0.2s ease; }
        .hint-toggle {
            margin-top: 8px; padding: 8px 16px; background: transparent;
            border: 1px solid var(--border); border-radius: 6px; color: var(--muted);
            cursor: pointer; font-size: 12px; font-family: var(--font-body);
            transition: var(--transition);
        }
        .hint-toggle:hover { border-color: var(--yellow); color: var(--yellow); }

        /* ─── MARKDOWN ───────────────────────────────────────────── */
        .ai-text p { margin: 0 0 10px 0; }
        .ai-text p:last-child { margin-bottom: 0; }
        .ai-text strong { color: var(--cyan); }
        .ai-text em { color: var(--yellow); }
        .ai-text code {
            background: var(--surface2); padding: 2px 6px; border-radius: 4px;
            font-family: var(--font-mono); font-size: 12px;
        }
        .ai-text pre {
            background: var(--bg); padding: 12px; border-radius: 8px;
            overflow-x: auto; margin: 10px 0; border: 1px solid var(--border);
        }
        .ai-text pre code { background: transparent; padding: 0; }
        .ai-text ul, .ai-text ol { margin: 8px 0; padding-left: 20px; }
        .ai-text li { margin: 4px 0; }
        .ai-text a { color: var(--cyan); text-decoration: underline; }
        .ai-text h1, .ai-text h2, .ai-text h3 { color: var(--text); margin: 16px 0 8px 0; }
        .ai-text blockquote {
            border-left: 3px solid var(--cyan); padding-left: 12px; margin: 10px 0; color: var(--muted);
        }

        /* ─── XP TOAST ───────────────────────────────────────────── */
        .xp-toast {
            position: fixed; bottom: 30px; right: 30px;
            background: linear-gradient(135deg, var(--green), #2ea043);
            color: var(--bg); padding: 16px 24px; border-radius: 12px;
            font-weight: 700; font-size: 14px;
            box-shadow: 0 10px 40px rgba(0, 255, 135, 0.4);
            transform: translateY(100px); opacity: 0;
            transition: all 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
            z-index: 1000; display: flex; align-items: center; gap: 8px;
        }
        .xp-toast.show { transform: translateY(0); opacity: 1; }

        /* ─── NAV BUTTONS ────────────────────────────────────────── */
        .nav-buttons {
            padding: 16px; border-top: 1px solid var(--border); flex-shrink: 0;
            display: flex; flex-direction: column; gap: 8px;
        }
        .nav-btn {
            padding: 12px; border-radius: 8px; text-decoration: none; color: var(--muted);
            font-size: 13px; font-weight: 500; display: flex; align-items: center; gap: 10px;
            transition: var(--transition); border: 1px solid transparent;
        }
        .nav-btn:hover { background: var(--surface2); color: var(--text); border-color: var(--border); }

        /* ─── RESPONSIVE ─────────────────────────────────────────── */
        @media (max-width: 1200px) {
            .app-layout { grid-template-columns: 1fr; }
            .sidebar { display: none; }
            .content-area { grid-template-columns: 1fr; }
        }

        /* ─── LOADING SPINNER ────────────────────────────────────── */
        .spinner {
            display: inline-block; width: 14px; height: 14px;
            border: 2px solid rgba(6,10,18,0.3); border-top-color: var(--bg);
            border-radius: 50%; animation: spin 0.7s linear infinite;
        }
        @keyframes spin { to { transform: rotate(360deg); } }

        /* ─── KATEX ──────────────────────────────────────────────── */
        .katex-display { overflow-x: auto; padding: 8px 0; }
    </style>
</head>
<body>
    <div class="grid-bg"></div>
    <div class="bg-orb bg-orb-1"></div>
    <div class="bg-orb bg-orb-2"></div>

    <header class="header">
        <div class="logo-text">LC-ADVANCE</div>
        <nav style="display:flex;gap:8px;">
            <a href="dashboard.php" class="btn btn-reset">📊 Dashboard</a>
            <a href="mapa/index.php" class="btn btn-reset">🗺️ Mapa</a>
        </nav>
    </header>

    <div class="app-layout">
        <!-- ── SIDEBAR ── -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <div class="logo">LC</div>
                <span class="logo-text-sb">LABORATORIO</span>
            </div>

            <div class="challenge-list" id="challengeList">
                <?php foreach ($subjects as $subject): ?>
                <div class="nav-title"><?= htmlspecialchars($subject) ?></div>
                <div class="subject-group">
                    <?php foreach ($challenges as $id => $ch): ?>
                        <?php if ($ch['materia'] === $subject): ?>
                        <div class="challenge-item <?= $active_challenge === $id ? 'active' : '' ?>"
                             id="item-<?= htmlspecialchars($id) ?>"
                             onclick="loadChallenge('<?= htmlspecialchars($id, ENT_QUOTES) ?>')">
                            <div class="challenge-item-left">
                                <div class="challenge-name"><?= htmlspecialchars($ch['title']) ?></div>
                                <div class="challenge-meta">
                                    <span class="difficulty <?= strtolower($ch['difficulty']) === 'fácil' ? 'easy' : (strtolower($ch['difficulty']) === 'difícil' ? 'hard' : 'medium') ?>"><?= htmlspecialchars($ch['difficulty']) ?></span>
                                    <span class="points"><?= intval($ch['points']) ?> pts</span>
                                </div>
                            </div>
                            <span class="challenge-done-icon" id="done-<?= htmlspecialchars($id) ?>">✅</span>
                        </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
                <?php endforeach; ?>
            </div>

            <div class="nav-buttons">
                <a href="dashboard.php" class="nav-btn">📊 Dashboard</a>
                <a href="mapa/index.php" class="nav-btn">🗺️ Mapa</a>
            </div>
        </aside>

        <!-- ── MAIN ── -->
        <main class="main-panel">
            <header class="problem-header">
                <h1 class="problem-title">
                    <span id="challengeTitle"><?= htmlspecialchars($challenges[$active_challenge]['title'] ?? 'Selecciona') ?></span>
                    <span class="problem-badge" id="challengeBadge" style="background:var(--cyan-dim);color:var(--cyan);"><?= htmlspecialchars($challenges[$active_challenge]['difficulty'] ?? '') ?></span>
                    <span class="completed-badge" id="completedBadge">✅ Completado</span>
                </h1>
                <div class="problem-actions">
                    <button class="btn btn-reset" onclick="resetChallenge()">🔄 Reiniciar</button>
                    <button class="btn btn-run" id="verifyBtn" onclick="handleVerify()">✓ Verificar</button>
                </div>
            </header>

            <div class="content-area">
                <!-- Workspace -->
                <div class="workspace-panel">
                    <div class="workspace-tabs">
                        <div class="workspace-tab active" id="tab-problem">📝 Problema</div>
                    </div>
                    <div class="editor-area" id="workspaceArea"></div>
                </div>

                <!-- Side panel -->
                <div class="side-panel">

                    <!-- Answer input (numeric/formula challenges) -->
                    <div class="side-section" id="answerSection">
                        <h4>Tu Respuesta</h4>
                        <div class="answer-input-group">
                            <label id="answerLabel">Ingresa tu respuesta numérica:</label>
                            <input type="text" class="answer-input" id="userAnswer"
                                   placeholder="Ej: 60"
                                   oninput="onAnswerChange()"
                                   onkeydown="if(event.key==='Enter') handleVerify()">
                        </div>
                        <button class="btn btn-run" style="width:100%;margin-top:12px;justify-content:center;" onclick="handleVerify()">
                            ✓ Verificar con IA
                        </button>
                    </div>

                    <!-- Test results (code challenges) -->
                    <div class="side-section" id="codeResultsSection" style="display:none;">
                        <h4>Tests</h4>
                        <div id="testsSummaryBar" style="display:none;">
                            <div class="tests-summary">
                                <span class="tests-summary-text" id="testsSummaryText">0/0</span>
                                <div class="tests-progress-bar">
                                    <div class="tests-progress-fill" id="testsProgressFill" style="width:0%"></div>
                                </div>
                            </div>
                        </div>
                        <div class="test-results" id="codeResults"></div>
                        <button class="btn btn-run" style="width:100%;margin-top:12px;justify-content:center;" onclick="handleVerify()">
                            ▶ Ejecutar Tests
                        </button>
                    </div>

                    <!-- AI feedback -->
                    <div class="ai-feedback" id="aiFeedback">
                        <div class="ai-feedback-header">
                            <div class="ai-avatar">🤖</div>
                            <span class="ai-name">LC-Tutor</span>
                        </div>
                        <div class="ai-text" id="aiText"></div>
                    </div>

                    <!-- Theory -->
                    <div class="side-section">
                        <h4>Teoría</h4>
                        <div class="theory-box" id="theoryBox"></div>
                    </div>

                    <!-- Examples -->
                    <div class="side-section">
                        <h4>Ejemplos</h4>
                        <div class="examples-box" id="examplesBox"></div>
                    </div>

                    <!-- Hint -->
                    <div class="side-section">
                        <h4>Pista</h4>
                        <div class="hint-box" id="hintBox"></div>
                        <button class="hint-toggle" onclick="toggleHint()">💡 Mostrar pista</button>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <div class="xp-toast" id="xpToast">🎉 +<span id="xpAmount">10</span> XP</div>

    <script>
    // ─── DATA ────────────────────────────────────────────────────
    const challenges = <?= json_encode($challenges, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP) ?>;
    let currentChallenge = '<?= addslashes($active_challenge) ?>';
    let params = {};
    let chart = null;
    let calculatedResult = null;
    let hintVisible = false;

    // ─── PROGRESS (localStorage) ─────────────────────────────────
    function loadProgress() {
        try { return JSON.parse(localStorage.getItem('lab_progress') || '{}'); } catch { return {}; }
    }
    function saveProgress(id, completed) {
        try {
            const p = loadProgress();
            p[id] = { completed, timestamp: Date.now() };
            localStorage.setItem('lab_progress', JSON.stringify(p));
        } catch {}
    }
    function isCompleted(id) {
        return loadProgress()[id]?.completed === true;
    }

    // ─── INIT ─────────────────────────────────────────────────────
    document.addEventListener('DOMContentLoaded', () => {
        if (window.marked) marked.setOptions({ breaks: true, gfm: true });
        refreshSidebarBadges();
        loadChallenge(currentChallenge);
    });

    function refreshSidebarBadges() {
        Object.keys(challenges).forEach(id => {
            const el = document.getElementById(`done-${id}`);
            if (el && isCompleted(id)) el.classList.add('visible');
        });
    }

    // ─── MARKDOWN ─────────────────────────────────────────────────
    function renderMd(text) {
        if (!window.marked) return `<p>${text.replace(/\n/g, '<br>')}</p>`;
        try { return marked.parse(text); } catch { return `<p>${text}</p>`; }
    }

    function renderMath() {
        if (window.renderMathInElement) {
            renderMathInElement(document.body, {
                delimiters: [
                    { left: '$$', right: '$$', display: true },
                    { left: '\\(', right: '\\)', display: false },
                    { left: '\\[', right: '\\]', display: true }
                ],
                throwOnError: false
            });
        }
    }

    // ─── LOAD CHALLENGE ──────────────────────────────────────────
    function loadChallenge(id) {
        if (!challenges[id]) return;
        currentChallenge = id;

        // Update sidebar active state
        document.querySelectorAll('.challenge-item').forEach(el => el.classList.remove('active'));
        const activeItem = document.getElementById(`item-${id}`);
        if (activeItem) activeItem.classList.add('active');

        const ch = challenges[id];
        document.getElementById('challengeTitle').textContent = ch.title;
        document.getElementById('challengeBadge').textContent = ch.difficulty;

        // Show completed badge if done
        const completedBadge = document.getElementById('completedBadge');
        completedBadge.classList.toggle('visible', isCompleted(id));

        // Reset state
        document.getElementById('userAnswer').value = '';
        document.getElementById('userAnswer').className = 'answer-input';
        document.getElementById('aiFeedback').classList.remove('visible', 'correct-feedback', 'incorrect-feedback');
        hintVisible = false;
        document.getElementById('hintBox').classList.remove('visible');

        // Init params
        if (ch.params) {
            params = {};
            ch.params.forEach(p => { params[p.name] = parseFloat(p.value); });
        }

        renderWorkspace(ch);
        window.history.replaceState({}, '', `?challenge=${encodeURIComponent(id)}`);
        setTimeout(renderMath, 120);
    }

    // ─── RENDER WORKSPACE ────────────────────────────────────────
    function renderWorkspace(ch) {
        const workspace = document.getElementById('workspaceArea');
        const answerSection = document.getElementById('answerSection');
        const codeResultsSection = document.getElementById('codeResultsSection');
        const isCode = ch.type === 'code';

        if (isCode) {
            // ── Code editor ──
            workspace.innerHTML = `
                <div class="code-editor">
                    <div class="code-toolbar">
                        <span class="code-toolbar-lang">JavaScript</span>
                        <button class="code-toolbar-run" onclick="handleVerify()">▶ Run Tests</button>
                    </div>
                    <div class="code-editor-inner">
                        <textarea id="codeEditor" spellcheck="false"
                            placeholder="// Escribe tu función solve() aquí...">${escHtml(ch.starter || '')}</textarea>
                    </div>
                </div>
            `;
            // Tab key support in textarea
            setTimeout(() => {
                const ta = document.getElementById('codeEditor');
                if (ta) {
                    ta.addEventListener('keydown', function(e) {
                        if (e.key === 'Tab') {
                            e.preventDefault();
                            const s = this.selectionStart;
                            this.value = this.value.substring(0, s) + '  ' + this.value.substring(this.selectionEnd);
                            this.selectionStart = this.selectionEnd = s + 2;
                        }
                    });
                }
            }, 50);

            answerSection.style.display = 'none';
            codeResultsSection.style.display = 'block';
            renderPendingTests(ch.tests || []);

        } else {
            // ── Interactive / sliders ──
            answerSection.style.display = 'block';
            codeResultsSection.style.display = 'none';

            let controlsHTML = '';
            if (ch.params) {
                ch.params.forEach(p => {
                    const step = p.step !== undefined ? p.step : 1;
                    controlsHTML += `
                        <div class="control-group">
                            <label>${p.label}</label>
                            <input type="range" id="slider-${escAttr(p.name)}"
                                   min="${p.min}" max="${p.max}" step="${step}" value="${p.value}"
                                   oninput="updateParam('${escAttr(p.name)}', this.value)">
                            <div class="slider-value">
                                <span>${p.min} – ${p.max}</span>
                                <span id="val-${escAttr(p.name)}">${p.value}</span>
                            </div>
                        </div>
                    `;
                });
            }

            workspace.innerHTML = `
                <div class="interactive-area">
                    <div class="info-card">
                        <h4>Problema</h4>
                        <p>${ch.description}</p>
                        ${ch.formula ? `<div class="formula-display">\\(${ch.formula}\\)</div>` : ''}
                    </div>
                    <div class="info-card">
                        <h4>Parámetros</h4>
                        <div class="controls-grid">${controlsHTML}</div>
                        ${ch.visualize ? `<div class="chart-area"><canvas id="chartCanvas"></canvas></div>` : ''}
                        <div class="result-box">
                            <div class="result-label">RESULTADO CALCULADO</div>
                            <div class="result-value" id="calcResult">--</div>
                        </div>
                    </div>
                </div>
            `;

            if (ch.visualize) setTimeout(() => initChart(ch), 100);
            calculateResult();
        }

        // Populate side info
        document.getElementById('theoryBox').innerHTML = ch.theory || '';
        document.getElementById('examplesBox').textContent = ch.examples || '';
        document.getElementById('hintBox').textContent = ch.hint || 'Sin pista disponible.';

        const answerInput = document.getElementById('userAnswer');
        if (ch.input_type === 'formula') {
            document.getElementById('answerLabel').textContent = 'Ingresa la respuesta (fórmula o número):';
            answerInput.placeholder = 'Ej: 2*a*x + b o 14';
        } else {
            document.getElementById('answerLabel').textContent = 'Ingresa tu respuesta numérica:';
            answerInput.placeholder = 'Ej: 60';
        }

        setTimeout(renderMath, 150);
    }

    // ─── PENDING TESTS RENDER ────────────────────────────────────
    function renderPendingTests(tests) {
        const container = document.getElementById('codeResults');
        const summaryBar = document.getElementById('testsSummaryBar');
        summaryBar.style.display = 'none';
        if (!tests || tests.length === 0) {
            container.innerHTML = '<p style="color:var(--muted);font-size:12px;">Sin tests definidos para este challenge.</p>';
            return;
        }
        container.innerHTML = tests.map((t, i) => `
            <div class="test-row pending" id="test-row-${i}">
                <span class="test-icon">⬜</span>
                <div class="test-detail">
                    <div class="test-name pending">Test ${i + 1}</div>
                    <div class="test-info">Entrada: ${JSON.stringify(t.input)} → Esperado: ${JSON.stringify(t.expected)}</div>
                </div>
            </div>
        `).join('');
    }

    // ─── UPDATE PARAM / CALCULATE ────────────────────────────────
    function updateParam(name, value) {
        params[name] = parseFloat(value);
        const valEl = document.getElementById(`val-${name}`);
        if (valEl) valEl.textContent = value;
        calculateResult();
    }

    function calculateResult() {
        const ch = challenges[currentChallenge];
        if (!ch || !ch.calculate) return;
        try {
            // Safe evaluation: only allow numbers and math operators + known Math functions
            const expr = ch.calculate
                .replace(/Math\.(exp|log|sqrt|abs|pow|round|floor|ceil|sin|cos|tan)/g, 'Math.$1');

            const keys = Object.keys(params);
            const vals = Object.values(params);
            const fn = new Function(...keys, `"use strict"; return (${expr});`);
            const result = fn(...vals);
            calculatedResult = (typeof result === 'number' && isFinite(result)) ? result : null;
            const el = document.getElementById('calcResult');
            if (el) el.textContent = calculatedResult !== null ? formatNum(calculatedResult) : '--';
            const ch2 = challenges[currentChallenge];
            if (ch2.visualize && chart) updateChart(ch2);
        } catch {
            calculatedResult = null;
            const el = document.getElementById('calcResult');
            if (el) el.textContent = 'Error';
        }
    }

    function formatNum(n) {
        return Number.isInteger(n) ? n.toString() : n.toFixed(2);
    }

    // ─── ANSWER CHANGE ───────────────────────────────────────────
    function onAnswerChange() {
        document.getElementById('userAnswer').className = 'answer-input';
    }

    // ─── HINT ────────────────────────────────────────────────────
    function toggleHint() {
        hintVisible = !hintVisible;
        document.getElementById('hintBox').classList.toggle('visible', hintVisible);
        document.querySelector('.hint-toggle').textContent = hintVisible ? '🔒 Ocultar pista' : '💡 Mostrar pista';
    }

    // ─── CHART ───────────────────────────────────────────────────
    function buildChartData(ch) {
        const paramName = ch.params[0].name;
        const { min, max } = ch.params[0];
        const step = (max - min) / 20;
        const labels = [], data = [];
        const expr = ch.calculate.replace(/Math\.(exp|log|sqrt|abs|pow|round|floor|ceil|sin|cos|tan)/g, 'Math.$1');

        for (let i = min; i <= max + 0.001; i += step) {
            const testParams = { ...params, [paramName]: i };
            const keys = Object.keys(testParams);
            const vals = Object.values(testParams);
            try {
                const fn = new Function(...keys, `"use strict"; return (${expr});`);
                labels.push(i.toFixed(1));
                data.push(fn(...vals));
            } catch { labels.push(i.toFixed(1)); data.push(null); }
        }
        return { labels, data };
    }

    function initChart(ch) {
        const ctx = document.getElementById('chartCanvas');
        if (!ctx) return;
        if (chart) { chart.destroy(); chart = null; }
        const { labels, data } = buildChartData(ch);
        chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels,
                datasets: [{
                    label: 'Resultado', data,
                    borderColor: '#00e5ff', backgroundColor: 'rgba(0,229,255,0.08)',
                    fill: true, tension: 0.4, pointRadius: 0
                }]
            },
            options: {
                responsive: true, maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    x: { grid: { color: 'rgba(0,230,255,0.08)' }, ticks: { color: '#8b949e', maxTicksLimit: 6 } },
                    y: { grid: { color: 'rgba(0,230,255,0.08)' }, ticks: { color: '#8b949e' } }
                }
            }
        });
    }

    function updateChart(ch) {
        if (!chart) return;
        const { labels, data } = buildChartData(ch);
        chart.data.labels = labels;
        chart.data.datasets[0].data = data;
        chart.update('none');
    }

    // ─── RUN TESTS (code challenges) ────────────────────────────
    function runTests(code, tests) {
        if (!tests || tests.length === 0) return [{ pass: false, error: 'Sin tests definidos' }];
        let fn;
        try {
            fn = new Function(`"use strict"; ${code}; return typeof solve !== 'undefined' ? solve : null;`)();
            if (typeof fn !== 'function') throw new Error('No se encontró la función solve()');
        } catch (e) {
            return tests.map(() => ({ pass: false, error: e.message }));
        }
        return tests.map(t => {
            try {
                // Handle closures: solve(a)(b) pattern
                let result;
                if (t.input.length === 2 && typeof fn(t.input[0]) === 'function') {
                    result = fn(t.input[0])(t.input[1]);
                } else {
                    result = fn(...t.input);
                }
                // Normalize arrays to string for FizzBuzz-style tests
                let pass;
                const expected = t.expected;
                if (Array.isArray(result)) {
                    pass = JSON.stringify(result) === JSON.stringify(expected) ||
                           result.join(',') === String(expected);
                } else {
                    pass = result === expected ||
                           JSON.stringify(result) === JSON.stringify(expected) ||
                           String(result) === String(expected);
                }
                return { pass, result: JSON.stringify(result), expected: JSON.stringify(expected) };
            } catch (e) {
                return { pass: false, error: e.message };
            }
        });
    }

    function renderTestResults(results, tests) {
        const container = document.getElementById('codeResults');
        const summaryBar = document.getElementById('testsSummaryBar');
        const passedCount = results.filter(r => r.pass).length;
        const total = results.length;

        // Summary bar
        summaryBar.style.display = 'block';
        document.getElementById('testsSummaryText').textContent = `${passedCount}/${total} tests`;
        document.getElementById('testsProgressFill').style.width = `${(passedCount / total) * 100}%`;

        container.innerHTML = results.map((r, i) => {
            const t = tests[i];
            const statusClass = r.pass ? 'pass' : 'fail';
            const icon = r.pass ? '✅' : '❌';
            const detail = r.error
                ? `Error: ${escHtml(r.error)}`
                : (r.pass ? `→ ${r.result}` : `→ Obtenido: ${r.result} | Esperado: ${r.expected}`);
            return `
                <div class="test-row ${statusClass}">
                    <span class="test-icon">${icon}</span>
                    <div class="test-detail">
                        <div class="test-name ${statusClass}">Test ${i + 1}</div>
                        <div class="test-info">Entrada: ${JSON.stringify(t?.input ?? [])} ${detail}</div>
                    </div>
                </div>
            `;
        }).join('');
    }

    // ─── LOCAL ANSWER CHECK ──────────────────────────────────────
    function checkAnswerLocally(userAnswer, ch) {
        if (ch.answer === undefined) return false;
        const n = parseFloat(userAnswer.replace(',', '.'));
        if (isNaN(n)) return false;
        return Math.abs(n - ch.answer) < 0.1;
    }

    // ─── MAIN VERIFY HANDLER ─────────────────────────────────────
    async function handleVerify() {
        const ch = challenges[currentChallenge];
        if (!ch) return;

        const btn = document.getElementById('verifyBtn');
        btn.disabled = true;
        btn.innerHTML = '<span class="spinner"></span> Verificando…';

        document.getElementById('aiFeedback').classList.remove('correct-feedback', 'incorrect-feedback');

        if (ch.type === 'code') {
            await verifyCode(ch);
        } else {
            await verifyNumeric(ch);
        }

        btn.disabled = false;
        btn.innerHTML = '✓ Verificar';
    }

    async function verifyCode(ch) {
        const codeEditor = document.getElementById('codeEditor');
        if (!codeEditor) return;
        const code = codeEditor.value.trim();
        if (!code) {
            showAIResponse('❌ Por favor escribe tu código antes de ejecutar los tests.', false);
            return;
        }

        const results = runTests(code, ch.tests || []);
        renderTestResults(results, ch.tests || []);

        const passed = results.filter(r => r.pass).length;
        const total = results.length;
        const allPass = passed === total && total > 0;

        const summaryMsg = allPass
            ? `✅ **¡Excelente trabajo!** Todos los tests pasaron (${passed}/${total}).\n\nTu solución es correcta. 🎉`
            : `❌ **${passed}/${total} tests pasaron.** Revisa los tests fallidos y ajusta tu código.`;

        showAIResponse(renderMd(summaryMsg), allPass);

        if (allPass) {
            // Give XP only once
            if (!isCompleted(currentChallenge)) {
                showXP(ch.points);
            }
            saveProgress(currentChallenge, true);
            markSidebarDone(currentChallenge);
            document.getElementById('completedBadge').classList.add('visible');
        }
    }

    async function verifyNumeric(ch) {
        const userAnswer = document.getElementById('userAnswer').value.trim();
        if (!userAnswer) {
            showAIResponse('❌ Por favor ingresa una respuesta antes de verificar.', false);
            return;
        }

        const localCorrect = checkAnswerLocally(userAnswer, ch);
        const expectedAnswer = ch.answer !== undefined ? ch.answer : 'N/A';
        const calculatedValue = calculatedResult !== null ? formatNum(calculatedResult) : 'N/A';

        // Style input border
        const input = document.getElementById('userAnswer');
        input.className = 'answer-input ' + (localCorrect ? 'correct' : 'incorrect');

        // Show loading
        document.getElementById('aiFeedback').classList.add('visible');
        document.getElementById('aiText').innerHTML = '<em>🤖 Analizando con IA…</em>';

        try {
            const resp = await fetch('ai_tutor.php', {
                method: 'POST',
                credentials: 'same-origin',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                cache: 'no-store',
                body: new URLSearchParams({
                    slug: currentChallenge,
                    lesson_title: ch.title,
                    lesson_subject: ch.materia,
                    correctas: localCorrect ? 5 : 2,
                    total: 6,
                    question: `**Tema:** ${ch.title}\n**Materia:** ${ch.materia}\n**Problema:** ${ch.description}\n**Respuesta del alumno:** ${userAnswer}\n**Valor calculado:** ${calculatedValue}\n**Respuesta esperada:** ${expectedAnswer}\n\n¿Es correcta? Da retroalimentación breve en español.`,
                    provider: 'auto'
                })
            });

            const raw = await resp.text();
            let data;
            try { data = JSON.parse(raw); } catch { throw new Error('Respuesta inválida del servidor'); }

            if (data.ok && data.ai_text) {
                const html = renderMd(data.ai_text);
                const aiDetectsCorrect = /\b(correcto|correcta|bien|excelente|perfecto|sí|¡sí|acertado)\b/i.test(data.ai_text);
                showAIResponse(html, localCorrect || aiDetectsCorrect);
                if (localCorrect || aiDetectsCorrect) {
                    if (!isCompleted(currentChallenge)) showXP(ch.points);
                    saveProgress(currentChallenge, true);
                    markSidebarDone(currentChallenge);
                    document.getElementById('completedBadge').classList.add('visible');
                }
            } else {
                throw new Error('Sin respuesta de IA');
            }
        } catch {
            // Fallback local
            const msg = localCorrect
                ? `✅ **¡Correcto!** Tu respuesta \`${userAnswer}\` es correcta. El valor esperado era \`${expectedAnswer}\`.`
                : `❌ **Incorrecto.** Tu respuesta: \`${userAnswer}\` | Esperado: \`${expectedAnswer}\`\n\nRevisa los parámetros y tu cálculo.`;
            showAIResponse(renderMd(msg), localCorrect);
            if (localCorrect) {
                if (!isCompleted(currentChallenge)) showXP(ch.points);
                saveProgress(currentChallenge, true);
                markSidebarDone(currentChallenge);
                document.getElementById('completedBadge').classList.add('visible');
            }
        }
    }

    // ─── UI HELPERS ──────────────────────────────────────────────
    function showAIResponse(html, isCorrect) {
        const feedback = document.getElementById('aiFeedback');
        feedback.classList.add('visible');
        feedback.classList.toggle('correct-feedback', isCorrect);
        feedback.classList.toggle('incorrect-feedback', !isCorrect);
        document.getElementById('aiText').innerHTML = html;
    }

    function showXP(points) {
        document.getElementById('xpAmount').textContent = points;
        const toast = document.getElementById('xpToast');
        toast.classList.add('show');
        setTimeout(() => toast.classList.remove('show'), 3000);
    }

    function markSidebarDone(id) {
        const icon = document.getElementById(`done-${id}`);
        if (icon) icon.classList.add('visible');
    }

    // ─── RESET ───────────────────────────────────────────────────
    function resetChallenge() {
        const ch = challenges[currentChallenge];
        if (!ch) return;
        document.getElementById('userAnswer').value = '';
        document.getElementById('userAnswer').className = 'answer-input';
        document.getElementById('aiFeedback').classList.remove('visible', 'correct-feedback', 'incorrect-feedback');
        hintVisible = false;
        document.getElementById('hintBox').classList.remove('visible');
        document.querySelector('.hint-toggle').textContent = '💡 Mostrar pista';

        if (ch.type === 'code') {
            const ta = document.getElementById('codeEditor');
            if (ta) ta.value = ch.starter || '';
            renderPendingTests(ch.tests || []);
            document.getElementById('testsSummaryBar').style.display = 'none';
        } else if (ch.params) {
            ch.params.forEach(p => {
                params[p.name] = parseFloat(p.value);
                const slider = document.getElementById(`slider-${p.name}`);
                if (slider) slider.value = p.value;
                const valEl = document.getElementById(`val-${p.name}`);
                if (valEl) valEl.textContent = p.value;
            });
            calculateResult();
        }
    }

    // ─── UTILS ───────────────────────────────────────────────────
    function escHtml(str) {
        return String(str)
            .replace(/&/g, '&amp;').replace(/</g, '&lt;')
            .replace(/>/g, '&gt;').replace(/"/g, '&quot;');
    }
    function escAttr(str) {
        return String(str).replace(/[^a-zA-Z0-9_\-]/g, '');
    }

    // ─── BOOT ────────────────────────────────────────────────────
    // Moved to DOMContentLoaded above
    </script>
</body>
</html>