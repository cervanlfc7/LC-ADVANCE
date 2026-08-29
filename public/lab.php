<?php
require_once __DIR__ . '/../src/Config/config.php';
require_once __DIR__ . '/../src/Core/panel_docente.php';
requireStudent();

$active_challenge = $_GET['challenge'] ?? 'prog-sum-array';

$challenges = require __DIR__ . '/../src/Config/challenges.php';

if (!isset($challenges[$active_challenge])) {
    $active_challenge = 'prog-sum-array';
}

$subjects = ['Programación', 'Pensamiento Matemático III', 'Física I', 'Química I', 'Ecosistemas'];

$materia = null;
if (isset($_GET['materia']) && $_GET['materia'] !== '') {
    $materia = $_GET['materia'];
} elseif (!empty($_SESSION['selected_materia'])) {
    $materia = $_SESSION['selected_materia'];
}
$return_params = getDashboardReturnParams();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?= htmlspecialchars(csrfToken()) ?>">
    <script>window.__APP_ROOT__ = <?= json_encode(appRootPath()) ?>;</script>
    <title>Laboratorio | LC-ADVANCE</title>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500;700&family=Syne:wght@700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.16.9/dist/katex.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/katex@0.16.9/dist/katex.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/katex@0.16.9/dist/contrib/auto-render.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mathjs/11.11.2/math.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js" integrity="sha384-e6nUZLBkQ86NJ6TVVKAeSaK8jWa3NhkYWZFomE39AvDbQWeie9PlQqM3pmYW5d1g" crossorigin="anonymous"></script>
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
            overflow-x: hidden;
            overflow-y: auto;
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
            grid-template-columns: 280px 1fr;
            height: calc(100vh - 58px);
            position: relative; z-index: 1;
        }
        
        .main-wrapper {
            display: flex;
            flex-direction: column;
            height: 100%;
            overflow: hidden;
        }
        
        .workspace-wrapper {
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 0;
            overflow: hidden;
        }

        /* Mobile responsive: keep sidebar accessible and make editor scrollable */
        @media (max-width: 900px) {
            .app-layout { grid-template-columns: 1fr; height: auto; }
            .sidebar { display: block; width: 100%; border-right: none; border-bottom: 1px solid var(--border); max-height: 340px; overflow-y: auto; }
            .sidebar-header { padding: 16px 18px; }
            .sidebar-search-wrap { padding: 0 16px 16px; }
            .main-panel { padding: 16px; min-height: 0; }
            .content-area { flex-direction: column; }
            .workspace-panel { overflow: visible; }
            .workspace-tabs { gap: 8px; }
            .editor-area { flex-direction: column; }
            .code-editor-inner { padding: 12px; }
            .code-editor-inner textarea { min-height: 280px; }
            .console-panel { height: 220px; max-height: 55vh; }
            .console-tabs { overflow-x: auto; }
            .console-tab { flex: 0 0 auto; }
            .console-resize-handle { height: 10px; }
            body { overflow-x: hidden; overflow-y: auto; }
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
            flex: 1; overflow-y: auto; overflow-x: hidden; padding: 8px;
        }
        .challenge-list::-webkit-scrollbar { width: 6px; }
        .challenge-list::-webkit-scrollbar-track { background: transparent; }
        .challenge-list::-webkit-scrollbar-thumb { background: var(--border); border-radius: 3px; }

        .nav-title {
            padding: 12px 12px 8px; font-size: 11px; font-weight: 600;
            text-transform: uppercase; letter-spacing: 1px; color: var(--muted);
        }
        .subject-group { margin-bottom: 0; }

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
            display: flex; flex-direction: column; overflow: hidden; 
            padding: 20px 24px;
            flex: 1;
            min-height: 0;
        }
        
        .problem-header {
            margin-bottom: 16px; display: flex;
            justify-content: space-between; align-items: center;
            flex-wrap: wrap; gap: 12px;
            flex-shrink: 0;
        }
        
        .problem-title {
            font-size: 22px; font-weight: 700;
            display: flex; align-items: center; gap: 12px; flex-wrap: wrap;
            animation: slideInLeft 0.3s ease;
        }
        
        @keyframes slideInLeft {
            from { opacity: 0; transform: translateX(-20px); }
            to { opacity: 1; transform: translateX(0); }
        }
        
        .problem-badge {
            font-size: 10px; padding: 4px 10px; border-radius: 20px; font-weight: 600;
            animation: fadeIn 0.3s ease 0.1s both;
        }
        
        .completed-badge {
            font-size: 11px; padding: 4px 10px; border-radius: 20px; font-weight: 600;
            background: rgba(0,255,135,0.15); color: var(--green); display: none;
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.7; }
        }
        
        .completed-badge.visible { display: inline-flex; align-items: center; gap: 4px; }

        .problem-actions { display: flex; gap: 8px; }

        /* ─── BUTTONS ────────────────────────────────────────────── */
        .btn {
            padding: 10px 18px; border-radius: 8px;
            font-family: var(--font-body); font-size: 13px; font-weight: 600;
            cursor: pointer; transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid var(--border2); display: flex; align-items: center; gap: 8px;
            position: relative; overflow: hidden;
        }
        
        .btn::before {
            content: ''; position: absolute; top: 0; left: -100%; width: 100%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent);
            transition: left 0.5s;
        }
        
        .btn:hover::before { left: 100%; }
        
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
            flex: 1; display: flex; flex-direction: column; overflow: hidden; 
            min-height: 0;
            border-radius: var(--radius);
            border: 1px solid var(--border);
            background: var(--surface);
            animation: fadeIn 0.3s ease;
        }
        
        .workspace-panel {
            background: var(--surface); 
            display: flex; flex-direction: column; overflow: hidden; 
            flex: 1; min-height: 0;
        }
        
        .workspace-tabs {
            display: flex; background: var(--surface2); border-bottom: 1px solid var(--border);
            padding: 0 16px;
            gap: 4px;
        }
        
        .workspace-tab {
            padding: 12px 16px; font-size: 12px; font-weight: 600;
            color: var(--muted); cursor: pointer; border-bottom: 2px solid transparent;
            transition: all 0.2s ease;
            position: relative;
        }
        
        .workspace-tab::after {
            content: ''; position: absolute; bottom: -1px; left: 0; right: 0;
            height: 2px; background: transparent; transition: all 0.2s ease;
        }
        
        .workspace-tab:hover { 
            color: var(--text-secondary); 
            background: rgba(0, 229, 255, 0.05);
        }
        
        .workspace-tab.active { 
            color: var(--cyan); 
            border-bottom-color: transparent;
        }
        
        .workspace-tab.active::after {
            background: var(--cyan);
        }

        .editor-area { 
            flex: 1; display: flex; overflow: hidden; 
            min-height: 0; 
            background: #0a0e14;
        }

        /* Code editor */
        .code-editor {
            flex: 1; display: flex; flex-direction: column; 
            background: #0a0e14; overflow: hidden;
            border-radius: 0 0 var(--radius) var(--radius);
        }
        
        .code-toolbar {
            display: flex; align-items: center; justify-content: space-between;
            padding: 10px 16px; border-bottom: 1px solid var(--border); 
            background: linear-gradient(180deg, #0d1218 0%, #080c14 100%);
        }
        
        .code-toolbar-left {
            display: flex; align-items: center; gap: 12px;
        }
        
        .code-toolbar-lang {
            font-family: var(--font-mono); font-size: 11px; color: var(--cyan);
            background: var(--cyan-dim); padding: 4px 12px; border-radius: 6px;
            font-weight: 500;
        }
        
        .code-toolbar-hint {
            font-size: 10px; color: var(--muted); font-family: var(--font-mono);
        }
        
        .code-toolbar-run {
            padding: 8px 16px; background: linear-gradient(135deg, var(--green), #2ed573);
            color: var(--bg); border: none; border-radius: 8px; font-family: var(--font-mono);
            font-size: 11px; font-weight: 700; cursor: pointer;
            transition: all 0.2s ease; display: flex; align-items: center; gap: 6px;
            box-shadow: 0 4px 15px rgba(0, 255, 135, 0.3);
        }
        
        .code-toolbar-run:hover { 
            transform: translateY(-2px); 
            box-shadow: 0 6px 25px rgba(0,255,135,0.5);
        }
        
        .code-toolbar-run:active {
            transform: translateY(0);
        }
        
        .code-editor-inner { 
            flex: 1; overflow: auto; padding: 16px; 
            background: repeating-linear-gradient(
                0deg,
                transparent,
                transparent 27px,
                rgba(0, 229, 255, 0.03) 27px,
                rgba(0, 229, 255, 0.03) 28px
            );
        }
        
        .code-editor-inner textarea {
            width: 100%; height: 100%; min-height: 200px; background: transparent; border: none;
            color: var(--text); font-family: var(--font-mono); font-size: 13px; line-height: 1.7;
            resize: none; outline: none; tab-size: 2;
        }
        
        .code-editor-inner textarea::selection {
            background: var(--cyan-dim);
        }

        /* Interactive area */
        .interactive-area {
            flex: 1; padding: 20px; overflow-y: auto;
            display: flex; flex-direction: column; gap: 16px;
        }
        
        .info-card {
            background: var(--surface2); border: 1px solid var(--border); 
            border-radius: 12px; padding: 16px;
            transition: all 0.2s ease;
            animation: slideUp 0.3s ease;
        }
        
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .info-card:hover {
            border-color: var(--cyan);
            box-shadow: 0 4px 20px rgba(0, 229, 255, 0.1);
        }
        
        .info-card h4 {
            font-size: 11px; font-weight: 600; text-transform: uppercase;
            letter-spacing: 1px; color: var(--muted); margin-bottom: 10px;
        }
        
        .formula-display {
            background: var(--bg); border: 1px solid var(--border); border-radius: 8px;
            padding: 12px; text-align: center; margin: 10px 0; font-size: 16px;
            transition: all 0.2s ease;
        }
        
        .formula-display:hover {
            border-color: var(--cyan);
            box-shadow: 0 0 15px rgba(0, 229, 255, 0.1);
        }
        
        .controls-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 16px; }
        .control-group {
            background: var(--bg); border: 1px solid var(--border); border-radius: 10px; padding: 14px;
            transition: all 0.2s ease;
        }
        
        .control-group:hover {
            border-color: var(--cyan-dim);
            transform: translateY(-2px);
        }
        
        .control-group label { 
            display: block; font-size: 12px; font-weight: 600; 
            color: var(--muted); margin-bottom: 8px; 
        }
        
        .control-group input[type="range"] {
            width: 100%; height: 6px; border-radius: 3px; background: var(--surface2);
            outline: none; -webkit-appearance: none; cursor: pointer;
        }
        
        .control-group input[type="range"]::-webkit-slider-thumb {
            -webkit-appearance: none; width: 18px; height: 18px; border-radius: 50%;
            background: var(--cyan); cursor: pointer; 
            box-shadow: 0 0 10px rgba(0, 229, 255, 0.5);
            transition: all 0.2s ease;
        }
        
        .control-group input[type="range"]::-webkit-slider-thumb:hover {
            transform: scale(1.2);
            box-shadow: 0 0 20px rgba(0, 229, 255, 0.8);
        }
        
        .slider-value { display: flex; justify-content: space-between; align-items: center; margin-top: 6px; }
        .slider-value span:first-child { font-size: 10px; color: var(--muted); }
        .slider-value span:last-child {
            font-family: var(--font-mono); font-size: 15px; font-weight: 600; color: var(--cyan);
        }
        
        .result-box {
            background: linear-gradient(135deg, rgba(0, 255, 135, 0.1), rgba(0, 229, 255, 0.1));
            border: 1px solid var(--green); border-radius: 16px;
            padding: 20px; text-align: center; margin-top: 16px;
            animation: glowPulse 2s infinite;
        }
        
        @keyframes glowPulse {
            0%, 100% { box-shadow: 0 0 20px rgba(0, 255, 135, 0.1); }
            50% { box-shadow: 0 0 30px rgba(0, 255, 135, 0.2); }
        }
        
        .result-label { font-size: 12px; color: var(--muted); margin-bottom: 8px; }
        .result-value {
            font-size: 32px; font-weight: 800;
            background: linear-gradient(90deg, var(--green), var(--cyan));
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;
            animation: gradientShift 3s ease infinite;
        }
        
        @keyframes gradientShift {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }
        
        .chart-area {
            background: var(--surface2); border: 1px solid var(--border);
            border-radius: 10px; padding: 16px; height: 200px; margin-top: 16px;
            transition: all 0.2s ease;
        }
        
        .chart-area:hover {
            border-color: var(--cyan);
            box-shadow: 0 4px 20px rgba(0, 229, 255, 0.1);
        }

        /* Answer section */
        .answer-input-group {
            background: var(--bg); border: 2px solid var(--border);
            border-radius: 12px; padding: 16px;
            transition: all 0.2s ease;
        }
        
        .answer-input-group:focus-within {
            border-color: var(--cyan);
            box-shadow: 0 0 20px rgba(0, 229, 255, 0.15);
        }
        
        .answer-input-group label {
            display: block; font-size: 13px; font-weight: 600;
            color: var(--text); margin-bottom: 10px;
        }
        
        .answer-input {
            width: 100%; padding: 14px; background: var(--surface2);
            border: 1px solid var(--border); border-radius: 8px;
            color: var(--text); font-family: var(--font-mono); font-size: 16px;
            outline: none; transition: all 0.2s ease;
        }
        
        .answer-input:focus { 
            border-color: var(--cyan); 
            box-shadow: 0 0 15px rgba(0, 229, 255, 0.2); 
        }
        
        .answer-input.correct { 
            border-color: var(--green); 
            box-shadow: 0 0 15px rgba(0,255,135,0.2); 
            animation: shake 0.3s ease;
        }
        
        .answer-input.incorrect { 
            border-color: var(--red); 
            box-shadow: 0 0 15px rgba(255,77,109,0.15); 
            animation: shake 0.3s ease;
        }
        
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }

        /* Test results */
        .test-results { display: flex; flex-direction: column; gap: 8px; }
        
        .test-row {
            display: flex; align-items: flex-start; gap: 10px; padding: 12px;
            border-radius: 10px; font-family: var(--font-mono); font-size: 12px;
            border: 1px solid transparent;
            transition: all 0.2s ease;
            animation: slideIn 0.2s ease;
        }
        
        @keyframes slideIn {
            from { opacity: 0; transform: translateX(-10px); }
            to { opacity: 1; transform: translateX(0); }
        }
        
        .test-row:hover {
            transform: translateX(4px);
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
            padding: 12px 16px; background: var(--bg);
            border-radius: 10px; border: 1px solid var(--border); margin-bottom: 12px;
        }
        
        .tests-summary-text { 
            font-size: 12px; font-weight: 600; 
            color: var(--text);
        }
        
        .tests-progress-bar { 
            flex: 1; height: 8px; background: var(--surface2); 
            border-radius: 4px; overflow: hidden; 
        }
        
        .tests-progress-fill {
            height: 100%; border-radius: 4px; 
            transition: width 0.4s ease;
            background: linear-gradient(90deg, var(--green), var(--cyan));
            box-shadow: 0 0 10px rgba(0, 255, 135, 0.3);
        }

        /* AI feedback */
        .ai-feedback {
            background: var(--surface2); border: 1px solid var(--border);
            border-radius: 12px; padding: 16px; display: none; 
            animation: fadeIn 0.3s ease;
        }
        
        .ai-feedback.visible { display: block; }
        
        .ai-feedback.correct-feedback { 
            border-color: rgba(0,255,135,0.35);
            box-shadow: 0 0 20px rgba(0, 255, 135, 0.1);
        }
        
        .ai-feedback.incorrect-feedback { 
            border-color: rgba(255,77,109,0.25);
            box-shadow: 0 0 20px rgba(255, 77, 109, 0.1);
        }

        @keyframes fadeIn { 
            from { opacity: 0; transform: translateY(6px); } 
            to { opacity: 1; transform: translateY(0); } 
        }

        .ai-feedback-header {
            display: flex; align-items: center; gap: 10px; margin-bottom: 12px;
        }
        
        .ai-avatar {
            width: 36px; height: 36px;
            background: linear-gradient(135deg, var(--cyan), var(--pink));
            border-radius: 50%; display: flex; align-items: center; justify-content: center; 
            font-size: 18px;
            animation: float 3s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-3px); }
        }
        
        .ai-name { font-size: 13px; font-weight: 600; color: var(--text); }
        .ai-text { font-size: 13px; line-height: 1.7; color: var(--text-secondary); }

        /* Theory / examples / hint */
        .theory-box {
            background: rgba(0, 229, 255, 0.08); 
            border-left: 3px solid var(--cyan);
            padding: 14px; border-radius: 0 10px 10px 0; 
            font-size: 13px; line-height: 1.6;
        }
        
        .examples-box {
            background: var(--bg); border: 1px solid var(--border); border-radius: 10px;
            padding: 14px; font-family: var(--font-mono); font-size: 12px; color: var(--green);
            line-height: 1.6; white-space: pre-wrap;
        }
        
        .hint-box {
            background: rgba(255, 210, 63, 0.08); 
            border: 1px solid rgba(255, 210, 63, 0.25);
            border-radius: 10px; padding: 14px; font-size: 13px; 
            color: var(--yellow); display: none;
        }
        
        .hint-box.visible { 
            display: block; 
            animation: fadeIn 0.2s ease; 
            box-shadow: 0 0 20px rgba(255, 210, 63, 0.1);
        }
.hint-toggle {
            margin-top: 8px; padding: 10px 18px; background: transparent;
            border: 1px solid var(--border); border-radius: 8px; color: var(--muted);
            cursor: pointer; font-size: 12px; font-family: var(--font-body);
            transition: all 0.2s ease;
        }
        
        .hint-toggle:hover { 
            border-color: var(--yellow); 
            color: var(--yellow);
            background: rgba(255, 210, 63, 0.1);
            transform: translateY(-2px);
        }

        /* ─── MARKDOWN ───────────────────────────────────────────── */
        .ai-text p { margin: 0 0 10px 0; }
        .ai-text p:last-child { margin-bottom: 0; }
        .ai-text strong { color: var(--cyan); font-weight: 600; }
        .ai-text em { color: var(--yellow); }
        .ai-text code {
            background: var(--surface2); padding: 3px 8px; border-radius: 6px;
            font-family: var(--font-mono); font-size: 12px;
            border: 1px solid var(--border);
        }
        .ai-text pre {
            background: var(--bg); padding: 14px; border-radius: 10px;
            overflow-x: auto; margin: 12px 0; border: 1px solid var(--border);
        }
        .ai-text pre code { background: transparent; padding: 0; border: none; }
        .ai-text ul, .ai-text ol { margin: 10px 0; padding-left: 24px; }
        .ai-text li { margin: 6px 0; }
        .ai-text a { color: var(--cyan); text-decoration: none; transition: all 0.2s ease; }
        .ai-text a:hover { text-decoration: underline; color: var(--pink); }
        .ai-text h1, .ai-text h2, .ai-text h3 { color: var(--text); margin: 16px 0 8px 0; }
        .ai-text blockquote {
            border-left: 3px solid var(--cyan); padding-left: 16px; margin: 12px 0; 
            color: var(--muted); background: rgba(0, 229, 255, 0.05);
            border-radius: 0 8px 8px 0;
        }

        /* ─── XP TOAST ───────────────────────────────────────────── */
        .xp-toast {
            position: fixed; bottom: 30px; right: 30px;
            background: linear-gradient(135deg, var(--green), #2ea043);
            color: var(--bg); padding: 16px 24px; border-radius: 12px;
            font-weight: 700; font-size: 14px;
            box-shadow: 0 10px 40px rgba(0, 255, 135, 0.4);
            transform: translateY(100px) scale(0.8); opacity: 0;
            transition: all 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
            z-index: 1000; display: flex; align-items: center; gap: 8px;
        }
        
        .xp-toast.show { 
            transform: translateY(0) scale(1); 
            opacity: 1; 
        }
        
        .xp-toast::before {
            content: '✨';
            font-size: 18px;
        }

        /* ─── NAV BUTTONS ────────────────────────────────────────── */
        .nav-buttons {
            padding: 16px; border-top: 1px solid var(--border); flex-shrink: 0;
            display: flex; flex-direction: column; gap: 8px;
        }
        
        .nav-btn {
            padding: 12px; border-radius: 8px; text-decoration: none; color: var(--muted);
            font-size: 13px; font-weight: 500; display: flex; align-items: center; gap: 10px;
            transition: all 0.2s ease; border: 1px solid transparent;
        }
        
        .nav-btn:hover { 
            background: var(--surface2); 
            color: var(--text); 
            border-color: var(--border);
            transform: translateX(4px);
        }

        /* ─── RESPONSIVE ─────────────────────────────────────────── */
        @media (max-width: 1200px) {
            .app-layout { grid-template-columns: 1fr; height: auto; }
            .sidebar { display: block; width: 100%; border-right: none; border-bottom: 1px solid var(--border); max-height: 360px; overflow-y: auto; }
            .content-area { flex-direction: column; }
            .main-panel { padding: 16px; min-height: 0; }
            .sidebar-search-wrap { padding: 0 16px 16px; }
            .console-tabs { overflow-x: auto; }
        }

        /* ─── LOADING SPINNER ────────────────────────────────────── */
        .spinner {
            display: inline-block; width: 14px; height: 14px;
            border: 2px solid rgba(6,10,18,0.3); border-top-color: var(--bg);
            border-radius: 50%; animation: spin 0.7s linear infinite;
        }
        @keyframes spin { to { transform: rotate(360deg); } }

        /* ─── KATEX ─────────────────────────────────────────────── */
        .katex-display { 
            overflow-x: auto; 
            padding: 12px 0;
        }
        
        .katex { 
            font-size: 1.1em;
        }
    
        /* Wolfram Calculator */
        .wolfram-section { padding: 20px; background: var(--surface); display: flex; flex-direction: column; flex: 1; overflow-y: auto; animation: fadeIn 0.3s ease; }
        .wolfram-header { margin-bottom: 16px; }
        .wolfram-header-top { display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px; }
        .wolfram-logo { font-size: 16px; color: var(--text); }
        .wolfram-logo strong { color: var(--cyan); font-family: var(--font-display); }
        .wolfram-badge { font-size: 10px; background: var(--cyan-dim); color: var(--cyan); padding: 3px 8px; border-radius: 999px; font-family: var(--font-mono); margin-left: 8px; }
        .wolfram-close { background: transparent; border: 1px solid var(--border); color: var(--muted); width: 28px; height: 28px; border-radius: 6px; cursor: pointer; font-size: 14px; transition: var(--transition); }
        .wolfram-close:hover { color: var(--text); border-color: var(--cyan); }
        .wolfram-subtitle { font-size: 12px; color: var(--muted); margin-bottom: 12px; }
        .wolfram-input-row { display: flex; gap: 8px; margin-bottom: 10px; }
        .wolfram-input { flex: 1; padding: 12px 16px; background: var(--surface2); border: 1px solid var(--border2); border-radius: 10px; color: var(--text); font-family: var(--font-body); font-size: 14px; outline: none; transition: var(--transition); }
        .wolfram-input:focus { border-color: var(--cyan); box-shadow: 0 0 0 3px rgba(0,229,255,0.1); }
        .wolfram-input::placeholder { color: var(--muted); font-size: 12px; }
        .wolfram-btn { padding: 12px 24px; background: linear-gradient(140deg, var(--cyan), var(--pink)); border: none; border-radius: 10px; color: var(--bg); font-family: var(--font-mono); font-weight: 700; font-size: 12px; cursor: pointer; transition: var(--transition); white-space: nowrap; }
        .wolfram-btn:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(0,229,255,0.3); }
        .wolfram-examples { display: flex; flex-wrap: wrap; gap: 6px; align-items: center; margin-bottom: 8px; }
        .examples-label { font-size: 10px; color: var(--muted); font-family: var(--font-mono); text-transform: uppercase; margin-right: 4px; }
        .example-chip { padding: 4px 12px; background: var(--surface2); border: 1px solid var(--border); border-radius: 999px; color: var(--muted); font-size: 10px; font-family: var(--font-mono); cursor: pointer; transition: var(--transition); }
        .example-chip:hover { border-color: var(--cyan); color: var(--cyan); background: var(--cyan-dim); }
        .wolfram-result { flex: 1; overflow-y: auto; }
        .wolfram-result .result-placeholder { display: flex; flex-direction: column; align-items: center; justify-content: center; min-height: 200px; color: var(--muted); gap: 12px; }
        .wolfram-result .result-placeholder .result-icon { font-size: 48px; opacity: 0.5; }
        .wolfram-card { background: var(--surface2); border: 1px solid var(--border); border-radius: 12px; margin-bottom: 12px; overflow: hidden; }
        .wolfram-card-header { padding: 10px 14px; font-size: 11px; font-family: var(--font-mono); text-transform: uppercase; letter-spacing: 0.5px; color: var(--cyan); border-bottom: 1px solid var(--border); background: rgba(0,229,255,0.04); }
        .wolfram-card-body { padding: 14px; font-size: 13px; line-height: 1.6; color: var(--text); }
        .wolfram-interp { color: var(--muted); font-style: italic; }
        .wolfram-result-value { font-size: 20px; font-weight: 600; padding: 16px; text-align: center; }
        .wolfram-step { display: flex; gap: 10px; margin-bottom: 8px; align-items: flex-start; }
        .step-num { background: var(--cyan-dim); color: var(--cyan); width: 24px; height: 24px; border-radius: 999px; display: flex; align-items: center; justify-content: center; font-size: 11px; font-weight: 700; flex-shrink: 0; }
        .step-text { padding-top: 3px; font-size: 12px; }
        .wolfram-alt-item { padding: 6px 10px; background: var(--surface); border: 1px solid var(--border); border-radius: 6px; margin-bottom: 6px; font-family: var(--font-mono); font-size: 12px; }
        .wolfram-related-chip { display: inline-block; padding: 4px 12px; background: var(--surface); border: 1px solid var(--border); border-radius: 999px; font-size: 11px; color: var(--muted); margin: 3px; }
        .error-card .wolfram-card-header { color: var(--red); border-color: rgba(255,77,109,0.3); }
        .wolfram-toggle { background: transparent; border: 1px solid var(--border); color: var(--muted); width: 30px; height: 30px; border-radius: 8px; cursor: pointer; font-size: 16px; transition: var(--transition); display: flex; align-items: center; justify-content: center; margin-left: auto; }
        .wolfram-toggle:hover { border-color: var(--cyan); color: var(--cyan); background: var(--cyan-dim); }
        /* Mode tabs */
        .wolfram-modes { display: flex; gap: 4px; margin-bottom: 12px; flex-wrap: wrap; }
        .wolfram-mode-tab { padding: 6px 14px; background: var(--surface2); border: 1px solid var(--border); border-radius: 999px; color: var(--muted); font-size: 11px; font-family: var(--font-mono); cursor: pointer; transition: var(--transition); }
        .wolfram-mode-tab:hover { border-color: var(--cyan); color: var(--text); background: var(--cyan-dim); }
        .wolfram-mode-tab.active { background: var(--cyan-dim); border-color: var(--cyan); color: var(--cyan); font-weight: 600; }
        /* Virtual keyboard */
        .wolfram-kb-toggle { margin-bottom: 8px; padding: 4px 10px; background: transparent; border: 1px solid var(--border); border-radius: 6px; color: var(--muted); font-size: 10px; cursor: pointer; transition: var(--transition); font-family: var(--font-mono); }
        .wolfram-kb-toggle:hover { border-color: var(--cyan); color: var(--cyan); }
        .wolfram-keyboard { display: none; margin-bottom: 10px; }
        .wolfram-keyboard.visible { display: block; }
        .kb-row { display: flex; gap: 4px; margin-bottom: 4px; flex-wrap: wrap; }
        .kb-btn { padding: 5px 10px; background: var(--surface2); border: 1px solid var(--border); border-radius: 5px; color: var(--text); font-family: var(--font-mono); font-size: 12px; cursor: pointer; transition: var(--transition); }
        .kb-btn:hover { background: var(--cyan-dim); border-color: var(--cyan); }
        .kb-btn-wide { padding: 5px 16px; }
        .result-loading { text-align:center;padding:40px; }
        .result-loading .spinner { display:inline-block;width:24px;height:24px;border:3px solid rgba(0,229,255,0.2);border-top-color:var(--cyan);border-radius:50%;animation:spin 0.7s linear infinite; }
        .result-loading div { margin-top:12px;color:var(--muted); }
        /* ── WOLFRAM ALPHA STYLE INPUT (LC-ADVANCE Dark) ────────── */
        .wa-input-box {
            position: relative;
            background: var(--surface);
            border: 2px solid var(--border2);
            border-radius: 10px;
            margin-bottom: 8px;
            display: flex;
            align-items: stretch;
            overflow: hidden;
            transition: border-color 0.2s, box-shadow 0.2s;
            min-height: 52px;
        }
        .wa-input-box:focus-within {
            border-color: var(--cyan);
            box-shadow: 0 0 0 3px rgba(0,229,255,0.15);
        }
        .wa-real-input {
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            opacity: 0;
            width: 100%;
            border: none;
            outline: none;
            background: transparent;
            font-size: 20px;
            cursor: text;
            z-index: 3;
            padding: 0 60px 0 16px;
            color: transparent;
            caret-color: var(--cyan);
        }
        .wa-display {
            flex: 1;
            display: flex;
            align-items: center;
            padding: 8px 60px 8px 16px;
            font-size: 20px;
            color: var(--text);
            min-height: 52px;
            cursor: text;
            position: relative;
            z-index: 2;
            overflow: hidden;
            font-family: var(--font-body);
        }
        .wa-display.empty::after {
            content: attr(data-placeholder);
            color: var(--muted);
            font-size: 14px;
            font-style: italic;
        }
        .wa-display .katex { color: var(--text); }
        .wa-display .wa-plain { color: var(--text-secondary); font-size: 18px; }
        .wa-cursor {
            display: inline-block;
            width: 2px;
            height: 1.1em;
            background: var(--cyan);
            margin-left: 1px;
            vertical-align: middle;
            animation: wa-blink 1s step-end infinite;
        }
        @keyframes wa-blink { 50% { opacity: 0; } }
        .wa-box-actions {
            position: absolute;
            right: 0; top: 0; bottom: 0;
            display: flex;
            align-items: center;
            gap: 2px;
            padding: 0 8px;
            z-index: 4;
        }
        .wa-clear-btn {
            width: 26px; height: 26px;
            border-radius: 50%;
            border: 1px solid var(--border);
            background: var(--surface2);
            color: var(--muted);
            font-size: 14px;
            cursor: pointer;
            display: none;
            align-items: center;
            justify-content: center;
            transition: var(--transition);
        }
        .wa-clear-btn:hover { background: var(--cyan-dim); color: var(--cyan); border-color: var(--cyan); }
        .wa-clear-btn.visible { display: flex; }
        /* Big submit button outside */
        .wa-submit-btn {
            padding: 0 28px;
            background: linear-gradient(135deg, var(--cyan), var(--pink));
            border: none;
            border-radius: 10px;
            color: var(--bg);
            font-family: var(--font-mono);
            font-weight: 700;
            font-size: 13px;
            cursor: pointer;
            transition: var(--transition);
            white-space: nowrap;
            min-height: 52px;
            flex-shrink: 0;
        }
        .wa-submit-btn:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(0,229,255,0.3); }
        /* Math toolbar row (like WolframAlpha) */
        .wa-toolbar {
            display: flex;
            gap: 3px;
            margin-bottom: 10px;
            flex-wrap: wrap;
            align-items: center;
        }
        .wa-tb-btn {
            height: 36px;
            min-width: 36px;
            padding: 0 8px;
            background: var(--surface2);
            border: 1px solid var(--border2);
            border-radius: 6px;
            color: var(--text);
            font-size: 14px;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: var(--font-mono);
            position: relative;
        }
        .wa-tb-btn:hover { background: var(--cyan-dim); border-color: var(--cyan); color: var(--cyan); }
        .wa-tb-btn .katex { font-size: 0.85em; }
        .wa-tb-sep { width: 1px; height: 24px; background: var(--border); margin: 0 2px; }
        /* Input row */
        .wa-input-row { display: flex; gap: 8px; margin-bottom: 8px; align-items: stretch; }
        .wa-input-wrap { flex: 1; display: flex; flex-direction: column; }

        /* Keep old classes working */
        .wolfram-input-row { display: flex; gap: 8px; margin-bottom: 10px; }
        .wolfram-input { flex: 1; padding: 12px 16px; background: var(--surface2); border: 1px solid var(--border2); border-radius: 10px; color: var(--text); font-family: var(--font-body); font-size: 14px; outline: none; transition: var(--transition); }
        .wolfram-input:focus { border-color: var(--cyan); box-shadow: 0 0 0 3px rgba(0,229,255,0.1); }
        .wolfram-input::placeholder { color: var(--muted); font-size: 12px; }
        .hidden { display: none !important; }

        /* ─── SIDEBAR SEARCH & FILTERS ──────────────────────────── */
        .sidebar-search-wrap {
            padding: 12px 12px 4px;
            flex-shrink: 0;
        }
        .sidebar-search {
            width: 100%;
            padding: 10px 12px;
            background: var(--surface2);
            border: 1px solid var(--border);
            border-radius: 8px;
            color: var(--text);
            font-family: var(--font-body);
            font-size: 12px;
            outline: none;
            transition: var(--transition);
            box-sizing: border-box;
        }
        .sidebar-search:focus {
            border-color: var(--cyan);
            box-shadow: 0 0 0 3px rgba(0, 229, 255, 0.1);
        }
        .sidebar-search::placeholder { color: var(--muted); }
        .subject-filters {
            display: flex;
            flex-wrap: wrap;
            gap: 4px;
            margin-top: 8px;
        }
        .filter-chip {
            padding: 4px 10px;
            background: var(--surface2);
            border: 1px solid var(--border);
            border-radius: 999px;
            color: var(--muted);
            font-size: 10px;
            font-family: var(--font-body);
            cursor: pointer;
            transition: var(--transition);
        }
        .filter-chip:hover {
            border-color: var(--cyan);
            color: var(--cyan);
            background: var(--cyan-dim);
        }
        .filter-chip.active {
            background: var(--cyan-dim);
            border-color: var(--cyan);
            color: var(--cyan);
        }

        /* ─── AI CHAT WIDGET ──────────────────────────────────────── */
        .chat-widget { 
            position: fixed; 
            bottom: 16px; 
            right: 16px; 
            z-index: 10020;
            max-width: calc(100vw - 32px);
            width: auto;
        }
        
        .chat-toggle-btn {
            width: 62px;
            height: 62px;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, var(--cyan), var(--pink));
            border: none;
            border-radius: 50%;
            color: var(--bg);
            font-family: var(--font-body);
            font-size: 22px;
            font-weight: 700;
            cursor: pointer;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            box-shadow: 0 12px 30px rgba(0, 229, 255, 0.25);
            position: relative;
            overflow: hidden;
            min-width: 62px;
        }
        
        .chat-toggle-btn::before {
            content: ''; position: absolute; top: 0; left: 0; right: 0; bottom: 0;
            background: linear-gradient(45deg, transparent 40%, rgba(255,255,255,0.2) 50%, transparent 60%);
            transform: translateX(-100%);
            transition: transform 0.6s;
        }
        
        .chat-toggle-btn:hover {
            transform: translateY(-3px) scale(1.02);
            box-shadow: 0 12px 35px rgba(0, 229, 255, 0.5);
        }
        
        .chat-toggle-btn:hover::before {
            transform: translateX(100%);
        }
        
        .chat-toggle-btn.has-unread::after {
            content: ''; position: absolute; top: 8px; right: 8px;
            width: 8px; height: 8px; background: var(--red);
            border-radius: 50%;
            animation: pulse 1.5s infinite;
        }
        
        .chat-panel {
            position: fixed;
            bottom: 80px;
            right: 16px;
            width: min(420px, calc(100vw - 32px));
            max-width: 420px;
            max-height: min(560px, calc(100vh - 120px));
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 18px;
            display: none;
            flex-direction: column;
            overflow: hidden;
            box-shadow: 0 25px 80px rgba(0, 0, 0, 0.6), 0 0 1px var(--cyan);
            animation: chatSlideIn 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
            width: min(420px, calc(100vw - 32px));
        }
        
        @keyframes chatSlideIn {
            from { 
                opacity: 0; 
                transform: translateY(20px) scale(0.95); 
            }
            to { 
                opacity: 1; 
                transform: translateY(0) scale(1); 
            }
        }
        
        .chat-panel.visible { display: flex; }
        
        .chat-panel-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 16px;
            border-bottom: 1px solid var(--border);
            font-weight: 600;
            font-size: 14px;
            background: linear-gradient(180deg, var(--surface2) 0%, var(--surface) 100%);
        }
        
        .chat-panel-header-title {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .chat-panel-header-title span {
            font-size: 14px;
            font-weight: 700;
            color: var(--text);
        }
        
        .chat-title {
            font-weight: 700;
            color: var(--text);
            font-size: 13px;
        }
        .chat-subtitle {
            font-size: 11px;
            color: var(--muted);
            line-height: 1.3;
        }
        
        .chat-header-actions {
            display: flex;
            gap: 6px;
        }
        .chat-hint {
            font-size: 11px;
            color: var(--muted);
            padding: 6px 16px 14px;
            text-align: center;
            font-family: var(--font-mono);
        }
        
        .chat-header-btn {
            background: transparent;
            border: 1px solid var(--border);
            color: var(--muted);
            width: 28px;
            height: 28px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 12px;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .chat-header-btn:hover { 
            color: var(--text); 
            border-color: var(--cyan);
            background: var(--cyan-dim);
        }
        
        .chat-header-btn.clear-btn:hover {
            border-color: var(--red);
            color: var(--red);
            background: rgba(255, 77, 109, 0.1);
        }
        .chat-messages {
            flex: 1;
            overflow-y: auto;
            padding: 16px;
            display: flex;
            flex-direction: column;
            gap: 14px;
            min-height: 220px;
            max-height: calc(100vh - 280px);
            background: var(--bg);
        }
        
        .chat-messages::-webkit-scrollbar { width: 6px; }
        .chat-messages::-webkit-scrollbar-track { background: transparent; }
        .chat-messages::-webkit-scrollbar-thumb { background: var(--border); border-radius: 3px; }
        
        .chat-msg {
            display: flex;
            gap: 12px;
            padding: 8px 0;
            max-width: 100%;
            animation: msgFadeIn 0.2s ease;
        }
        
        @keyframes msgFadeIn {
            from { opacity: 0; transform: translateY(8px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .chat-msg-avatar {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            flex-shrink: 0;
            background: linear-gradient(135deg, var(--cyan), var(--pink));
        }
        
        .chat-msg-avatar.user {
            background: linear-gradient(135deg, var(--green), var(--cyan));
        }
        
        .chat-msg-content {
            flex: 1;
            min-width: 0;
        }
        
        .chat-msg-time {
            font-size: 10px;
            color: var(--muted);
            margin-bottom: 4px;
            font-family: var(--font-mono);
        }
        
        .chat-msg-text {
            font-size: 14px;
            line-height: 1.6;
            color: var(--text);
            word-wrap: break-word;
        }
        
        .chat-msg.user {
            flex-direction: row-reverse;
        }
        
        .chat-msg.user .chat-msg-content {
            text-align: right;
        }
        
        .chat-msg.user .chat-msg-text {
            background: linear-gradient(135deg, var(--cyan-dim), rgba(0, 229, 255, 0.15));
            padding: 12px 16px;
            border-radius: 16px 16px 4px 16px;
            display: inline-block;
            border: 1px solid rgba(0, 229, 255, 0.2);
        }
        
        .chat-msg.ai .chat-msg-text {
            background: var(--surface2);
            padding: 12px 16px;
            border-radius: 16px 16px 16px 4px;
            border: 1px solid var(--border);
        }
        
        .chat-msg.ai p { margin: 0 0 8px 0; }
        .chat-msg.ai p:last-child { margin-bottom: 0; }
        
        .chat-msg.ai code {
            background: var(--bg);
            padding: 2px 6px;
            border-radius: 6px;
            font-family: var(--font-mono);
            font-size: 12px;
            border: 1px solid var(--border);
        }
        
        .chat-msg.ai pre {
            background: #0d1117;
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 14px;
            overflow-x: auto;
            margin: 10px 0;
        }
        
        .chat-msg.ai pre code {
            background: transparent;
            padding: 0;
            border: none;
            font-size: 12px;
            line-height: 1.5;
        }
        
        .chat-msg-actions {
            display: flex;
            gap: 8px;
            margin-top: 8px;
            padding-top: 8px;
            border-top: 1px solid var(--border);
        }
        
        .chat-action-btn {
            padding: 6px 12px;
            background: transparent;
            border: 1px solid var(--border);
            border-radius: 6px;
            color: var(--muted);
            font-size: 11px;
            cursor: pointer;
            transition: all 0.2s ease;
            font-family: var(--font-body);
        }
        
        .chat-action-btn:hover {
            border-color: var(--cyan);
            color: var(--cyan);
            background: var(--cyan-dim);
        }
        
        /* Typing indicator */
        .chat-typing-indicator {
            display: flex;
            align-items: center;
            gap: 4px;
            padding: 12px 16px;
            background: var(--surface2);
            border-radius: 16px 16px 16px 4px;
            border: 1px solid var(--border);
            width: fit-content;
        }
        
        .typing-dot {
            width: 8px;
            height: 8px;
            background: var(--cyan);
            border-radius: 50%;
            animation: typingBounce 1.4s infinite ease-in-out;
        }
        
        .typing-dot:nth-child(1) { animation-delay: 0s; }
        .typing-dot:nth-child(2) { animation-delay: 0.2s; }
        .typing-dot:nth-child(3) { animation-delay: 0.4s; }
        
        @keyframes typingBounce {
            0%, 60%, 100% { transform: translateY(0); }
            30% { transform: translateY(-6px); opacity: 0.8; }
        }
        
        .chat-input-row {
            display: flex;
            gap: 8px;
            padding: 10px 12px;
            border-top: 1px solid var(--border);
            background: var(--surface2);
        }
        .chat-input {
            flex: 1;
            padding: 10px 14px;
            background: var(--surface);
            border: 1px solid var(--border2);
            border-radius: 8px;
            color: var(--text);
            font-family: var(--font-body);
            font-size: 13px;
            outline: none;
            transition: var(--transition);
        }
        .chat-input:focus {
            border-color: var(--cyan);
            box-shadow: 0 0 0 3px rgba(0, 229, 255, 0.1);
        }
        .chat-input::placeholder { color: var(--muted); }
        .chat-send-btn {
            padding: 10px 16px;
            background: linear-gradient(135deg, var(--cyan), var(--pink));
            border: none;
            border-radius: 8px;
            color: var(--bg);
            font-family: var(--font-body);
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: var(--transition);
        }
        .chat-send-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0, 229, 255, 0.3);
        }

        @media (max-width: 900px) {
            .chat-widget {
                right: 12px;
                left: auto;
                bottom: 12px;
                max-width: unset;
                width: auto;
                display: flex;
                flex-direction: column;
                align-items: flex-end;
            }
            .chat-toggle-btn {
                width: 62px;
                height: 62px;
                min-width: 62px;
                padding: 0;
                border-radius: 50%;
            }
            .chat-panel {
                right: 12px;
                left: auto;
                bottom: 86px;
                width: min(92vw, 420px);
                max-width: calc(100vw - 24px);
                max-height: calc(100vh - 140px);
                border-radius: 20px;
            }
            .chat-messages {
                max-height: calc(100vh - 280px);
                min-height: 180px;
            }
            .chat-input-row {
                flex-wrap: wrap;
                gap: 8px;
                padding: 10px 12px;
            }
            .chat-input {
                flex: 1 1 100%;
                min-width: 0;
                width: 100%;
            }
            .chat-send-btn {
                width: 100%;
                max-width: 180px;
            }
        }
        @media (max-width: 640px) {
            .chat-widget {
                left: 8px;
                right: 8px;
                bottom: 8px;
                max-width: calc(100vw - 16px);
            }
            .chat-panel {
                bottom: 68px;
                max-height: calc(100vh - 96px);
                border-radius: 16px;
            }
            .chat-header-actions {
                gap: 4px;
            }
        }

        /* ─── BOTTOM CONSOLE ─────────────────────────────────────── */
        .app-main-wrap {
            flex: 1; display: flex; flex-direction: column; overflow: hidden; min-height: 0;
        }
        
        .console-resize-handle {
            height: 6px; background: var(--border); cursor: ns-resize; flex-shrink: 0;
            transition: all 0.2s ease; position: relative; z-index: 10;
            display: flex; align-items: center; justify-content: center;
            touch-action: none;
        }
        .console-resize-handle::before {
            content: ''; width: 40px; height: 3px; background: var(--muted);
            border-radius: 3px; opacity: 0.4; transition: all 0.2s ease;
        }
        .console-resize-handle:hover,
        .console-resize-handle.active {
            background: var(--cyan-dim);
        }
        .console-resize-handle:hover::before,
        .console-resize-handle.active::before {
            background: var(--cyan); opacity: 1; width: 60px;
        }
        
        .console-panel {
            background: var(--surface); border-top: 1px solid var(--border);
            display: flex; flex-direction: column; overflow: hidden;
            min-height: 50px; max-height: 60vh; height: 180px; flex-shrink: 0;
            transition: height 0.15s ease;
            box-shadow: 0 -4px 20px rgba(0, 0, 0, 0.3);
        }
        .console-panel.collapsed { height: 40px !important; min-height: 40px; }
        .console-panel.collapsed .console-body { display: none; }
        .console-tabs {
            display: flex; background: linear-gradient(180deg, var(--surface2) 0%, #0d1420 100%);
            border-bottom: 1px solid var(--border);
            padding: 0 12px; flex-shrink: 0; overflow-x: auto;
            gap: 2px;
        }
        
        .console-tab {
            padding: 10px 14px; font-size: 11px; font-weight: 600;
            color: var(--muted); cursor: pointer; border-bottom: 2px solid transparent;
            transition: all 0.2s ease; white-space: nowrap; font-family: var(--font-body);
            position: relative;
        }
        
        .console-tab:hover { 
            color: var(--text-secondary); 
            background: rgba(0, 229, 255, 0.05);
        }
        
        .console-tab.active { 
            color: var(--cyan); 
            border-bottom-color: transparent;
        }
        
        .console-tab.active::after {
            content: ''; position: absolute; bottom: -1px; left: 10%; right: 10%;
            height: 2px; background: var(--cyan);
            border-radius: 2px 2px 0 0;
        }
        
        .console-body {
            flex: 1; overflow-y: auto; padding: 16px; display: none; min-height: 0;
            background: var(--bg);
        }
        
        .console-body.active { 
            display: block; 
            animation: fadeIn 0.2s ease;
        }
        
        .console-body::-webkit-scrollbar { width: 6px; }
        .console-body::-webkit-scrollbar-track { background: transparent; }
        .console-body::-webkit-scrollbar-thumb { 
            background: var(--border); 
            border-radius: 3px;
        }
        
        .console-collapse-btn {
            margin-left: auto; background: transparent; border: none;
            color: var(--muted); cursor: pointer; font-size: 12px; padding: 8px;
            transition: all 0.2s ease;
            border-radius: 4px;
        }
        
        .console-collapse-btn:hover { 
            color: var(--text); 
            background: var(--surface2);
        }
        .console-output {
            font-family: var(--font-mono); font-size: 12px; color: var(--text-secondary);
            white-space: pre-wrap; line-height: 1.6;
        }
        .console-output .log-entry { margin-bottom: 6px; }
        .console-output .log-entry .log-time { color: var(--muted); margin-right: 8px; }
        .console-output .log-entry .log-ok { color: var(--green); }
        .console-output .log-entry .log-err { color: var(--red); }
        .console-output .log-entry .log-info { color: var(--cyan); }
        .console-clear-btn {
            padding: 4px 10px; background: transparent; border: 1px solid var(--border);
            border-radius: 4px; color: var(--muted); font-size: 10px; cursor: pointer;
            margin-left: 8px; font-family: var(--font-body); transition: var(--transition);
        }
        .console-clear-btn:hover { border-color: var(--red); color: var(--red); }
        .console-header-row {
            display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px;
        }
        /* Side section styles reused inside console */
        .console-body .theory-box { margin-top: 0; }
        .console-body .examples-box { margin-top: 0; }
        .console-body .hint-box { margin-top: 0; }
        .console-body .answer-input-group { margin-bottom: 0; }
        .console-body .test-results { margin-top: 0; }
        .console-body .ai-feedback { margin-top: 0; }
        .console-body .tests-summary { margin-bottom: 8px; }
        .console-body .control-group { margin-bottom: 0; }
    </style>
</head>
<body>
    <div class="grid-bg"></div>
    <div class="bg-orb bg-orb-1"></div>
    <div class="bg-orb bg-orb-2"></div>

    <header class="header">
        <div class="logo-text">LC-ADVANCE</div>
        <nav style="display:flex;gap:8px;">
            <a href="dashboard.php<?= $return_params ?>" class="btn btn-reset">📊 Dashboard</a>
            <a href="mapa/index.php" class="btn btn-reset">🗺️ Mapa</a>
        </nav>
    </header>

    <div class="app-layout">
        <!-- ── SIDEBAR ── -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <div class="logo">LC</div>
                <span class="logo-text-sb">LABORATORIO</span><button class="wolfram-toggle" onclick="toggleWolframMode()" title="Calculadora Wolfram">🔬</button>
            </div>

            <div class="sidebar-search-wrap">
                <input type="text" class="sidebar-search" id="searchInput" aria-label="Buscar desafío" placeholder="🔍 Buscar desafío..." oninput="filterChallenges()">
                <div class="subject-filters">
                    <button class="filter-chip active" data-subject="all" onclick="setSubjectFilter('all')">Todas</button>
                    <button class="filter-chip active" data-subject="Programación" onclick="setSubjectFilter('Programación')">Programación</button>
                    <button class="filter-chip active" data-subject="Pensamiento Matemático III" onclick="setSubjectFilter('Pensamiento Matemático III')">Pensamiento Matemático III</button>
                    <button class="filter-chip active" data-subject="Física I" onclick="setSubjectFilter('Física I')">Física I</button>
                    <button class="filter-chip active" data-subject="Química I" onclick="setSubjectFilter('Química I')">Química I</button>
                    <button class="filter-chip active" data-subject="Ecosistemas" onclick="setSubjectFilter('Ecosistemas')">Ecosistemas</button>
                </div>
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

        </aside>

        <!-- Wolfram Section -->
        <div id="wolframSection" class="wolfram-section hidden" style="display:none;">
            <div class="wolfram-header">
                <div class="wolfram-header-top">
                    <div class="wolfram-logo"><strong>LC-Wolfram</strong> <span class="wolfram-badge">Calculadora Inteligente</span></div>
                    <button class="wolfram-close" onclick="closeWolframMode()" aria-label="Cerrar Wolfram">X</button>
                </div>
                <div class="wolfram-subtitle">Selecciona una materia, escribe tu problema y presiona Resolver</div>
                <div class="wolfram-modes">
                    <button class="wolfram-mode-tab active" data-mode="math" onclick="setWolframMode('math')">🔢 Matematicas</button>
                    <button class="wolfram-mode-tab" data-mode="physics" onclick="setWolframMode('physics')">⚡ Fisica</button>
                    <button class="wolfram-mode-tab" data-mode="chemistry" onclick="setWolframMode('chemistry')">🧪 Quimica</button>
                    <button class="wolfram-mode-tab" data-mode="biology" onclick="setWolframMode('biology')">🌿 Ecosistemas</button>
                    <button class="wolfram-mode-tab" data-mode="programming" onclick="setWolframMode('programming')">💻 Programacion</button>
                    <button class="wolfram-mode-tab" data-mode="ai" onclick="setWolframMode('ai')">🤖 IA General</button>
                </div>
                <!-- Wolfram Alpha style input -->
                <div class="wa-input-row">
                    <div class="wa-input-wrap">
                        <!-- Math toolbar -->
                        <div class="wa-toolbar" id="waToolbar"></div>
                        <!-- The big white input box -->
                        <div class="wa-input-box" id="waInputBox" onclick="waFocus()">
                            <input type="text" id="wolframInput" aria-label="Expresión matemática"
                                class="wa-real-input"
                                autocomplete="off" spellcheck="false"
                                onkeydown="waKeyDown(event)"
                                oninput="waOnInput()">
                            <div class="wa-display" id="waDisplay"
                                data-placeholder="Escribe una expresión matemática... ej: derivada x²+3x, resolver 2x+5=11">
                            </div>
                            <div class="wa-box-actions">
                                <button class="wa-clear-btn" id="waClearBtn" onclick="waClear()" title="Limpiar">✕</button>
                            </div>
                        </div>
                    </div>
                    <button class="wa-submit-btn" onclick="solveWolfram()">= Resolver</button>
                </div>
                <button class="wolfram-kb-toggle" onclick="toggleWolframKeyboard()">⌨ Teclado virtual</button>
                <div class="wolfram-keyboard" id="wolframKeyboard"></div>
                <div class="wolfram-examples" id="wolframExamples">
                    <span class="examples-label" id="examplesLabel">Matematicas:</span>
                    <span id="examplesChips"></span>
                </div>
            </div>
            <div class="wolfram-result" id="wolframResult">
                <div class="result-placeholder">
                    <div class="result-icon">🔬</div>
                    <div>Escribe un problema y presiona Resolver<br><span style="font-size:12px;color:var(--muted);">Soporta matematicas, fisica, quimica, biologia, programacion y mas</span></div>
                </div>
            </div>
        </div>



        <!-- ── MAIN ── -->
        <div class="app-main-wrap">
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

                </div>
            </main>

        <!-- AI Chat Widget -->
        <div class="chat-widget" id="chatWidget">
            <button class="chat-toggle-btn" id="chatToggleBtn" type="button" aria-label="Abrir LC-Tutor">💬</button>
            <div class="chat-panel" id="chatPanel" aria-hidden="true" aria-label="Asistente LC-Tutor">
                <div class="chat-panel-header">
                    <div class="chat-panel-header-title">
                        <div class="chat-msg-avatar">🤖</div>
                        <div>
                            <div class="chat-title">LC-Tutor</div>
                            <div class="chat-subtitle">Tu asistente educativo</div>
                        </div>
                    </div>
                    <div class="chat-header-actions">
                        <button class="chat-header-btn clear-btn" onclick="clearChatHistory()" title="Limpiar conversación">🗑</button>
                        <button class="chat-header-btn" onclick="toggleChat()" title="Cerrar chat">✕</button>
                    </div>
                </div>
                <div class="chat-messages" id="chatMessages">
                    <div class="chat-msg welcome-msg" style="text-align: center; color: var(--muted); padding: 32px 20px;">
                        <div style="font-size: 32px; margin-bottom: 12px;">🚀</div>
                        <div>Pulsa el botón para iniciar una conversación con LC-Tutor.</div>
                    </div>
                </div>
                <form class="chat-input-row" onsubmit="event.preventDefault(); sendChatMessage();">
                    <textarea class="chat-input" id="chatInput" rows="2" placeholder="Pregunta lo que necesites..." autocomplete="off"></textarea>
                    <button class="chat-send-btn" type="submit" aria-label="Enviar mensaje">➤</button>
                </form>
                <div class="chat-hint">Enter para enviar · Shift+Enter para nueva línea</div>
            </div>
        </div>

<!-- ── Bottom Console ── -->
        <div class="console-resize-handle" id="consoleResizeHandle"></div>
        <div class="console-panel" id="consolePanel">
            <div class="console-tabs" id="consoleTabs">
                <div class="console-tab active" data-console="log" onclick="switchConsoleTab('log')">📋 Consola</div>
                <div class="console-tab" data-console="tests" onclick="switchConsoleTab('tests')">🧪 Tests</div>
                <div class="console-tab" data-console="answer" onclick="switchConsoleTab('answer')">✏️ Respuesta</div>
                <div class="console-tab" data-console="ai" onclick="switchConsoleTab('ai')">🤖 Analisis IA</div>
                <div class="console-tab" data-console="theory" onclick="switchConsoleTab('theory')">📖 Teoria</div>
                <div class="console-tab" data-console="examples" onclick="switchConsoleTab('examples')">📌 Ejemplos</div>
                <div class="console-tab" data-console="hint" onclick="switchConsoleTab('hint')">💡 Pista</div>
                <button class="console-collapse-btn" id="consoleCollapseBtn" onclick="toggleConsoleCollapse()" title="Colapsar">─</button>
            </div>
            <!-- Log tab -->
            <div class="console-body active" id="consoleLog">
                <div class="console-header-row">
                    <span style="font-size:12px;color:var(--muted);font-family:var(--font-mono);">Salida de depuración</span>
                    <button class="console-clear-btn" onclick="clearConsole()">🗑 Limpiar</button>
                </div>
                <div class="console-output" id="consoleOutput">Bienvenido al laboratorio. Los resultados se mostrarán aquí.</div>
            </div>
            <!-- Tests tab -->
            <div class="console-body" id="consoleTests">
                <div id="testsSummaryBar" style="display:none;">
                    <div class="tests-summary">
                        <span class="tests-summary-text" id="testsSummaryText">0/0</span>
                        <div class="tests-progress-bar">
                            <div class="tests-progress-fill" id="testsProgressFill" style="width:0%"></div>
                        </div>
                    </div>
                </div>
                <div class="test-results" id="codeResults"></div>
            </div>
            <!-- Answer tab -->
            <div class="console-body" id="consoleAnswer">
                <div class="answer-input-group">
                    <label id="answerLabel" for="userAnswer">Ingresa tu respuesta numérica:</label>
                    <input type="text" class="answer-input" id="userAnswer"
                           placeholder="Ej: 60"
                           oninput="onAnswerChange()"
                           onkeydown="if(event.key==='Enter') handleVerify()">
                </div>
                <button class="btn btn-run" style="width:100%;margin-top:12px;justify-content:center;" onclick="handleVerify()">
                    ✓ Verificar con IA
                </button>
            </div>
            <!-- AI Feedback tab -->
            <div class="console-body" id="consoleAi">
                <div class="ai-feedback" id="aiFeedback" style="display:block;margin-top:0;">
                    <div class="ai-feedback-header">
                        <div class="ai-avatar">🤖</div>
                        <span class="ai-name">LC-Tutor</span>
                    </div>
                    <div class="ai-text" id="aiText"></div>
                </div>
            </div>
            <!-- Theory tab -->
            <div class="console-body" id="consoleTheory">
                <h4 style="font-size:11px;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:var(--muted);margin-bottom:10px;">Teoría</h4>
                <div class="theory-box" id="theoryBox"></div>
            </div>
            <!-- Examples tab -->
            <div class="console-body" id="consoleExamples">
                <h4 style="font-size:11px;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:var(--muted);margin-bottom:10px;">Ejemplos</h4>
                <div class="examples-box" id="examplesBox"></div>
            </div>
            <!-- Hint tab -->
            <div class="console-body" id="consoleHint">
                <h4 style="font-size:11px;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:var(--muted);margin-bottom:10px;">Pista</h4>
                <div class="hint-box" id="hintBox" style="display:block;"></div>
                <button class="hint-toggle" onclick="toggleHint()" style="margin-top:8px;">💡 Mostrar pista</button>
            </div>
        </div>
    </div>

    <div class="xp-toast" id="xpToast">🎉 +<span id="xpAmount">10</span> XP</div>

    <script>
    const challenges = <?= json_encode($challenges, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP) ?>;
    let currentChallenge = '<?= addslashes($active_challenge) ?>';
</script>
<script src="<?= assetUrl('assets/js/lab.js') ?>"></script>
</body>
</html>
