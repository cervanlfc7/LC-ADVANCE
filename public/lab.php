<?php
require_once __DIR__ . '/../src/Config/config.php';
requireLogin(true);

$active_challenge = $_GET['challenge'] ?? 'prog-sum-array';

$challenges = require __DIR__ . '/../src/Config/challenges.php';

if (!isset($challenges[$active_challenge])) {
    $active_challenge = 'prog-sum-array';
}

$subjects = ['Programación', 'Pensamiento Matemático III', 'Física I', 'Química I', 'Ecosistemas'];

$return_params = '';
$params = [];
if (!empty($_GET['profesor'])) {
    $params[] = 'profesor=' . urlencode($_GET['profesor']);
}
$materia = null;
if (isset($_GET['materia']) && $_GET['materia'] !== '') {
    $materia = $_GET['materia'];
} elseif (!empty($_SESSION['selected_materia'])) {
    $materia = $_SESSION['selected_materia'];
}
if (!empty($materia)) {
    $params[] = 'materia=' . urlencode($materia);
}
if (!empty($params)) {
    $return_params = '?' . implode('&', $params);
}
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mathjs/11.11.2/math.min.js"></script>
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
            .app-layout { grid-template-columns: 1fr; }
            .sidebar { display: none; }
            .content-area { flex-direction: column; }
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
            bottom: 24px; 
            right: 24px; 
            z-index: 999;
        }
        
        .chat-toggle-btn {
            padding: 14px 24px;
            background: linear-gradient(135deg, var(--cyan), var(--pink));
            border: none;
            border-radius: 999px;
            color: var(--bg);
            font-family: var(--font-body);
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 20px rgba(0, 229, 255, 0.3);
            position: relative;
            overflow: hidden;
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
            right: 24px;
            width: 380px;
            max-height: 540px;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 16px;
            display: none;
            flex-direction: column;
            overflow: hidden;
            box-shadow: 0 25px 80px rgba(0, 0, 0, 0.6), 0 0 1px var(--cyan);
            animation: chatSlideIn 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
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
            gap: 8px;
        }
        
        .chat-panel-header-title span {
            background: linear-gradient(90deg, var(--cyan), var(--pink));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        .chat-header-actions {
            display: flex;
            gap: 6px;
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
            gap: 16px;
            min-height: 280px;
            max-height: 380px;
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

        /* ─── BOTTOM CONSOLE ─────────────────────────────────────── */
        .app-main-wrap {
            flex: 1; display: flex; flex-direction: column; overflow: hidden; min-height: 0;
        }
        
        .console-resize-handle {
            height: 6px; background: var(--border); cursor: ns-resize; flex-shrink: 0;
            transition: all 0.2s ease; position: relative; z-index: 10;
            display: flex; align-items: center; justify-content: center;
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
                <input type="text" class="sidebar-search" id="searchInput" placeholder="🔍 Buscar desafío..." oninput="filterChallenges()">
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
                    <button class="wolfram-close" onclick="closeWolframMode()">X</button>
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
                            <input type="text" id="wolframInput"
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
            <button class="chat-toggle-btn" id="chatToggleBtn" onclick="toggleChat()">💬 LC-Tutor</button>
            <div class="chat-panel" id="chatPanel">
                <div class="chat-panel-header">
                    <div class="chat-panel-header-title">
                        <span>🤖</span> <span>LC-Tutor</span>
                    </div>
                    <div class="chat-header-actions">
                        <button class="chat-header-btn clear-btn" onclick="clearChatHistory()" title="Limpiar conversación">🗑</button>
                        <button class="chat-header-btn" onclick="toggleChat()">✕</button>
                    </div>
                </div>
                <div class="chat-messages" id="chatMessages">
                    <div class="chat-msg welcome-msg" style="text-align: center; color: var(--muted); padding: 40px 20px;">
                        <div style="font-size: 32px; margin-bottom: 12px;">🤖</div>
                        <div>Haz clic en el botón para iniciar una conversación</div>
                    </div>
                </div>
                <div class="chat-input-row">
                    <input type="text" class="chat-input" id="chatInput" placeholder="Escribe tu mensaje..." onkeydown="if(event.key==='Enter' && !event.shiftKey) { event.preventDefault(); sendChatMessage(); }">
                    <button class="chat-send-btn" onclick="sendChatMessage()">➤</button>
                </div>
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

            // Console tab visibility for code challenges
            document.querySelector('.console-tab[data-console="answer"]').style.display = 'none';
            document.querySelector('.console-tab[data-console="tests"]').style.display = '';
            switchConsoleTab('tests');
            document.getElementById('testsSummaryBar').style.display = 'none';
            renderPendingTests(ch.tests || []);

        } else {
            // ── Interactive / sliders ──
            document.querySelector('.console-tab[data-console="answer"]').style.display = '';
            document.querySelector('.console-tab[data-console="tests"]').style.display = 'none';
            switchConsoleTab('answer');

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
        logToConsole('Verificacion completada.', 'ok');
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
        logToConsole('Tests: ' + passed + '/' + total + ' pasaron', allPass ? 'ok' : 'err');
    }

    async function verifyNumeric(ch) {
        const userAnswer = document.getElementById('userAnswer').value.trim();
        logToConsole('Verificando respuesta: ' + userAnswer, 'info');
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
            logToConsole('Fallo al contactar IA, usando verificacion local.', 'err');
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
    
    // ─── WOLFRAM MODE ────────────────────────────────────────────
    var wolframActive = false;
    var wolframMode = 'math';

    var wolframExamples = {
        math: [
            'derivada x^2 + 3x',
            'derivada sin(x)*cos(x)',
            'integral 2x dx',
            'integral x^2 + 5x de 0 a 3',
            '2x + 5 = 11',
            '5 = 2x - 3',
            'x^2 - 5x + 6 = 0',
            'limite x->0 sin(x)/x',
            'sqrt(144)',
            'log(1000)',
            'sin(pi/6)',
            '2^10'
        ],
        physics: ['v = d/t d=120 t=2', 'energia cinetica m=10 v=5', 'F = ma m=10 a=5', 'trabajo F=50 d=10', 'potencia W=1000 t=10', 'densidad m=10 V=2', 'presion h=10', 'Ley de Ohm I=2 R=10'],
        chemistry: ['masa molar H2O', 'pH H+=0.001', 'dilucion C1=6 V1=50 V2=200', 'composicion porcentual masa_elem=32 masa_total=80'],
        biology: ['crecimiento poblacional N0=100 r=0.05 t=10', 'eficiencia energetica energia=1000', 'indice de biodiversidad s1=20 s2=15 s3=10 s4=5'],
        programming: ['Como hacer un bucle for en JS', 'Como invertir un string en Python', 'Que es un closure en JavaScript', 'Explica la recursion con un ejemplo', 'Como ordenar un array'],
        ai: ['Explica la fotosintesis paso a paso', 'Cual es la segunda ley de Newton', 'Diferencia entre enlace ionico y covalente', 'Que es el teorema de Pitagoras', 'Como se calcula la media y desviacion estandar']
    };

    var wolframKeyboardKeys = {
        math: [
            [{l:'x²',i:'^2'},{l:'√',i:'\\sqrt{}'},{l:'π',i:'\\pi'},{l:'θ',i:'\\theta'},{l:'∞',i:'\\infty'},{l:'±',i:'\\pm'},{l:'≈',i:'\\approx'},{l:'≠',i:'\\neq'},{l:'→',i:'\\to'},{l:'∀',i:'\\forall'}],
            [{l:'sin',i:'\\sin'},{l:'cos',i:'\\cos'},{l:'tan',i:'\\tan'},{l:'log',i:'\\log'},{l:'ln',i:'\\ln'},{l:'∑',i:'\\sum'},{l:'∫',i:'\\int'},{l:'∂',i:'\\partial'},{l:'∇',i:'\\nabla'},{l:'∏',i:'\\prod'}],
            [{l:'( )',i:'()'},{l:'a/b',i:'\\frac{}{}'},{l:'√()',i:'\\sqrt{}'},{l:'×',i:'\\times'},{l:'÷',i:'\\div'},{l:'+',i:'+'},{l:'−',i:'-'},{l:'=',i:'='},{l:'%',i:'\\%'},{l:'!',i:'!'}],
            [{l:'lim',i:'\\lim'},{l:'dx',i:'\\,dx'},{l:'dy',i:'\\,dy'},{l:'Δt',i:'\\Delta'},{l:'α',i:'\\alpha'},{l:'β',i:'\\beta'},{l:'γ',i:'\\gamma'},{l:'λ',i:'\\lambda'},{l:'μ',i:'\\mu'},{l:'∞',i:'\\infty'}]
        ],
        physics: [
            [{l:'m',i:'m'},{l:'v',i:'v'},{l:'a',i:'a'},{l:'F',i:'F'},{l:'d',i:'d'},{l:'t',i:'t'},{l:'θ',i:'\\theta'},{l:'ω',i:'\\omega'},{l:'λ',i:'\\lambda'},{l:'ρ',i:'\\rho'}],
            [{l:'g',i:'g'},{l:'μ',i:'\\mu'},{l:'W',i:'W'},{l:'P',i:'P'},{l:'E',i:'E'},{l:'J',i:'J'},{l:'N',i:'N'},{l:'kg',i:'kg'},{l:'m/s',i:'m/s'},{l:'m/s²',i:'m/s^2'}],
            [{l:'( )',i:'()'},{l:'xʸ',i:'^'},{l:'×',i:'*'},{l:'÷',i:'/'},{l:'+',i:'+'},{l:'−',i:'-'},{l:'=',i:'='},{l:'.',i:'.'},{l:'cos',i:'\\cos'},{l:'sin',i:'\\sin'}],
            [{l:'tan',i:'\\tan'},{l:'π',i:'\\pi'},{l:'Δ',i:'\\Delta'},{l:'→',i:'\\to'},{l:'√',i:'\\sqrt{}'},{l:'α',i:'\\alpha'},{l:'β',i:'\\beta'},{l:'²',i:'^2'},{l:'∝',i:'\\propto'}]
        ],
        chemistry: [
            [{l:'H',i:'H'},{l:'O',i:'O'},{l:'C',i:'C'},{l:'N',i:'N'},{l:'Cl',i:'Cl'},{l:'Na',i:'Na'},{l:'S',i:'S'},{l:'P',i:'P'},{l:'Fe',i:'Fe'},{l:'Ca',i:'Ca'}],
            [{l:'→',i:'\\to'},{l:'⇌',i:'\\rightleftharpoons'},{l:'(aq)',i:'(aq)'},{l:'(s)',i:'(s)'},{l:'(g)',i:'(g)'},{l:'(l)',i:'(l)'},{l:'e⁻',i:'e^-'},{l:'H⁺',i:'H^+'},{l:'OH⁻',i:'OH^-'},{l:'Δ',i:'\\Delta'}],
            [{l:'pH',i:'pH'},{l:'pOH',i:'pOH'},{l:'mol',i:'mol'},{l:'M',i:'M'},{l:'g',i:'g'},{l:'L',i:'L'},{l:'mL',i:'mL'},{l:'%',i:'\\%'},{l:'/',i:'/'},{l:'·',i:'\\cdot'}],
            [{l:'( )',i:'()'},{l:'+',i:'+'},{l:'−',i:'-'},{l:'=',i:'='},{l:'.',i:'.'},{l:'²',i:'^2'},{l:'³',i:'^3'}]
        ],
        biology: [
            [{l:'N₀',i:'N_0'},{l:'r',i:'r'},{l:'t',i:'t'},{l:'→',i:'\\to'},{l:'%',i:'\\%'},{l:'/',i:'/'},{l:'E',i:'E'},{l:'k',i:'k'},{l:'K',i:'K'},{l:'P₀',i:'P_0'}],
            [{l:'CO₂',i:'CO_2'},{l:'O₂',i:'O_2'},{l:'H₂O',i:'H_2O'},{l:'ATP',i:'ATP'},{l:'kcal',i:'kcal'},{l:'N',i:'N'},{l:'P',i:'P'},{l:'10%',i:'10\\%'},{l:'λ',i:'\\lambda'},{l:'μ',i:'\\mu'}],
            [{l:'( )',i:'()'},{l:'+',i:'+'},{l:'−',i:'-'},{l:'=',i:'='},{l:'.',i:'.'},{l:'×',i:'*'},{l:'÷',i:'/'},{l:'²',i:'^2'},{l:'∑',i:'\\sum'}],
            [{l:'dN/dt',i:'dN/dt'},{l:'dP/dt',i:'dP/dt'},{l:'ln',i:'\\ln'},{l:'log',i:'\\log'},{l:'α',i:'\\alpha'},{l:'β',i:'\\beta'}]
        ],
        programming: [
            [{l:'fn',i:'function'},{l:'=>',i:'=>'},{l:'if',i:'if'},{l:'else',i:'else'},{l:'for',i:'for'},{l:'while',i:'while'},{l:'return',i:'return'}],
            [{l:'let',i:'let'},{l:'const',i:'const'},{l:'var',i:'var'},{l:'console',i:'console.'},{l:'true',i:'true'},{l:'false',i:'false'},{l:'null',i:'null'}],
            [{l:'[ ]',i:'[]'},{l:'{ }',i:'{}'},{l:'( )',i:'()'},{l:'===',i:'==='},{l:'!==',i:'!=='},{l:'&&',i:'&&'},{l:'||',i:'||'},{l:'+',i:'+'},{l:'−',i:'-'},{l:'×',i:'*'}],
            [{l:'.map',i:'.map('},{l:'.filter',i:'.filter('},{l:'.reduce',i:'.reduce('},{l:'.split',i:'.split('},{l:'.join',i:'.join('},{l:'.length',i:'.length'}]
        ],
        ai: [
            [{l:'?',i:'?'},{l:'¿',i:'¿'},{l:'!',i:'!'},{l:'.',i:'.'},{l:',',i:','},{l:':',i:':'},{l:';',i:';'},{l:'−',i:'-'},{l:'—',i:' — '}],
            [{l:'Que',i:'Que '},{l:'Como',i:'Como '},{l:'Por que',i:'Por que '},{l:'Cual',i:'Cual '},{l:'Cuando',i:'Cuando '},{l:'Donde',i:'Donde '}],
            [{l:'Explica',i:'Explica '},{l:'Describe',i:'Describe '},{l:'Compara',i:'Compara '},{l:'Define',i:'Define '},{l:'Resume',i:'Resume '}],
            [{l:'( )',i:'()'},{l:'""',i:'""'},{l:"''",i:"''"},{l:'{ }',i:'{}'},{l:'[ ]',i:'[]'}]
        ]
    };

    function setWolframMode(mode) {
        wolframMode = mode;
        document.querySelectorAll('.wolfram-mode-tab').forEach(function(t) {
            t.classList.toggle('active', t.getAttribute('data-mode') === mode);
        });
        var chips = document.getElementById('examplesChips');
        var label = document.getElementById('examplesLabel');
        var labels = { math:'Matematicas:', physics:'Fisica:', chemistry:'Quimica:', biology:'Ecosistemas:', programming:'Programacion:', ai:'IA General:' };
        label.textContent = labels[mode] || 'Ejemplos:';
        chips.innerHTML = '';
        var examples = wolframExamples[mode] || [];
        examples.forEach(function(ex) {
            var btn = document.createElement('button');
            btn.className = 'example-chip';
            btn.textContent = ex.length > 25 ? ex.substring(0,22) + '...' : ex;
            btn.onclick = function(){ loadWolframExample(ex); };
            chips.appendChild(btn);
        });
        renderKeyboard();
        updateWolframPreview();
    }

    function toggleWolframKeyboard() {
        var kb = document.getElementById('wolframKeyboard');
        kb.classList.toggle('visible');
    }

    function renderKeyboard() {
        var kb = document.getElementById('wolframKeyboard');
        kb.innerHTML = '';
        var keys = wolframKeyboardKeys[wolframMode] || wolframKeyboardKeys.math;
        keys.forEach(function(row) {
            var r = document.createElement('div');
            r.className = 'kb-row';
            row.forEach(function(key) {
                var b = document.createElement('button');
                b.className = 'kb-btn';
                var label = key.l || key;
                var insertVal = key.i || label;
                b.textContent = label;
                b.onclick = function(){ insertAtCursor(insertVal); };
                r.appendChild(b);
            });
            kb.appendChild(r);
        });
    }

    function insertAtCursor(text) {
        var inp = document.getElementById('wolframInput');
        inp.focus();
        var start = inp.selectionStart;
        var end = inp.selectionEnd;
        inp.value = inp.value.substring(0, start) + text + inp.value.substring(end);
        // Position cursor inside braces if text contains {}
        var bracePos = text.indexOf('{}');
        if (bracePos !== -1) {
            inp.selectionStart = inp.selectionEnd = start + bracePos + 1;
        } else {
            inp.selectionStart = inp.selectionEnd = start + text.length;
        }
        updateWolframPreview();
    }

    function toggleWolframMode() {
        wolframActive = !wolframActive;
        var ws = document.getElementById('wolframSection');
        var mp = document.querySelector('.main-panel');
        var cw = document.querySelector('.chat-widget');
        if (cw) cw.classList.toggle('hidden', wolframActive);
        if (wolframActive) {
            ws.classList.remove('hidden');
            ws.style.display = 'flex';
            mp.style.display = 'none';
            document.getElementById('wolframInput').focus();
            renderKeyboard();
            setWolframMode(wolframMode);
            updateWolframPreview();
        } else {
            ws.classList.add('hidden');
            ws.style.display = 'none';
            mp.style.display = 'flex';
        }
    }

    function closeWolframMode() {
        wolframActive = false;
        var ws = document.getElementById('wolframSection');
        ws.classList.add('hidden');
        ws.style.display = 'none';
        document.querySelector('.main-panel').style.display = 'flex';
        var cw = document.querySelector('.chat-widget');
        if (cw) cw.classList.remove('hidden');
    }

    function loadWolframExample(text) {
        var inp = document.getElementById('wolframInput');
        inp.value = text;
        inp.focus();
        updateWolframPreview();
        solveWolfram();
    }

    // ═══════════════════════════════════════════════════════════════
    // WOLFRAM ALPHA STYLE INPUT ENGINE
    // ═══════════════════════════════════════════════════════════════

    // Math toolbar button definitions
    var waToolbarDefs = {
        math: [
            { label:'x²',   ins:'^2',        tip:'Cuadrado' },
            { label:'xⁿ',   ins:'^',         tip:'Potencia' },
            { label:'√',    ins:'sqrt(',     tip:'Raíz cuadrada' },
            { label:'∛',    ins:'cbrt(',     tip:'Raíz cúbica' },
            { label:'1/x',  ins:'1/',        tip:'Recíproco' },
            { sep:true },
            { label:'∫',    ins:'integral ', tip:'Integral' },
            { label:'d/dx', ins:'derivada ', tip:'Derivada' },
            { label:'lim',  ins:'limite x->',tip:'Límite' },
            { label:'Σ',    ins:'sum(',      tip:'Suma' },
            { sep:true },
            { label:'sin',  ins:'sin(',      tip:'Seno' },
            { label:'cos',  ins:'cos(',      tip:'Coseno' },
            { label:'tan',  ins:'tan(',      tip:'Tangente' },
            { label:'log',  ins:'log(',      tip:'Logaritmo' },
            { label:'ln',   ins:'ln(',       tip:'Logaritmo natural' },
            { sep:true },
            { label:'π',    ins:'pi',        tip:'Pi' },
            { label:'e',    ins:'e',         tip:'Número e' },
            { label:'∞',    ins:'inf',       tip:'Infinito' },
            { label:'|x|',  ins:'abs(',      tip:'Valor absoluto' },
        ],
        physics: [
            { label:'v=d/t', ins:'v = d/t ',   tip:'Velocidad' },
            { label:'F=ma',  ins:'F = ma ',    tip:'Fuerza' },
            { label:'Ec',    ins:'energia cinetica m= v=', tip:'Energía cinética' },
            { label:'W=Fd',  ins:'trabajo F= d=', tip:'Trabajo' },
            { label:'P=W/t', ins:'potencia W= t=', tip:'Potencia' },
            { label:'ρ=m/V', ins:'densidad m= V=', tip:'Densidad' },
            { label:'V=IR',  ins:'Ley de Ohm I= R=', tip:'Ley de Ohm' },
            { sep:true },
            { label:'m',     ins:'m=',  tip:'masa' },
            { label:'v',     ins:'v=',  tip:'velocidad' },
            { label:'a',     ins:'a=',  tip:'aceleración' },
            { label:'F',     ins:'F=',  tip:'fuerza' },
            { label:'t',     ins:'t=',  tip:'tiempo' },
            { label:'d',     ins:'d=',  tip:'distancia' },
        ],
        chemistry: [
            { label:'H₂O',    ins:'masa molar H2O',  tip:'Agua' },
            { label:'CO₂',    ins:'masa molar CO2',  tip:'Dióxido de carbono' },
            { label:'pH',     ins:'pH H+=',          tip:'pH' },
            { label:'C₁V₁',   ins:'dilucion C1= V1= V2=', tip:'Dilución' },
            { label:'%comp',  ins:'composicion porcentual masa_elem= masa_total=', tip:'Composición %' },
            { sep:true },
            { label:'→',     ins:'->', tip:'Reacción' },
            { label:'⇌',     ins:'<=>', tip:'Equilibrio' },
        ],
        biology: [
            { label:'Nₜ=N₀eʳᵗ', ins:'crecimiento poblacional N0= r= t=', tip:'Crecimiento exponencial' },
            { label:'10%',       ins:'eficiencia energetica energia=', tip:'Eficiencia energética' },
            { label:'H\'(Shannon)',ins:'indice de biodiversidad s1= s2= s3=', tip:'Índice Shannon' },
        ],
        programming: [
            { label:'fn',    ins:'function ', tip:'Función' },
            { label:'=>',    ins:' => ',      tip:'Arrow' },
            { label:'for',   ins:'for ',      tip:'Bucle for' },
            { label:'if',    ins:'if ',       tip:'Condicional' },
            { label:'[]',    ins:'[]',        tip:'Array' },
            { label:'{}',    ins:'{}',        tip:'Objeto' },
        ],
        ai: [
            { label:'¿Qué es',  ins:'¿Qué es ',     tip:'Pregunta' },
            { label:'Explica',  ins:'Explica ',      tip:'Explicar' },
            { label:'Compara',  ins:'Compara ',      tip:'Comparar' },
            { label:'Cómo',     ins:'¿Cómo funciona ', tip:'Cómo' },
            { label:'Ejemplo',  ins:'Dame un ejemplo de ', tip:'Ejemplo' },
        ]
    };

    function waBuildToolbar(mode) {
        var tb = document.getElementById('waToolbar');
        if (!tb) return;
        tb.innerHTML = '';
        var defs = waToolbarDefs[mode] || waToolbarDefs.math;
        defs.forEach(function(d) {
            if (d.sep) {
                var sep = document.createElement('div');
                sep.className = 'wa-tb-sep';
                tb.appendChild(sep);
                return;
            }
            var btn = document.createElement('button');
            btn.className = 'wa-tb-btn';
            btn.title = d.tip || d.label;
            btn.setAttribute('tabindex', '-1'); // don't steal focus
            // Render label with KaTeX if possible
            var latexMap = {
                '√':'\\sqrt{\\phantom{x}}','∛':'\\sqrt[3]{\\phantom{x}}','∫':'\\int','d/dx':'\\frac{d}{dx}',
                'Σ':'\\sum','π':'\\pi','∞':'\\infty','|x|':'|x|','x²':'x^2','xⁿ':'x^n','1/x':'\\frac{1}{x}',
                'ρ=m/V':'\\rho=\\frac{m}{V}','C₁V₁':'C_1V_1','%comp':'\\%','H₂O':'H_2O','CO₂':'CO_2',
                'Nₜ=N₀eʳᵗ':'N_t=N_0e^{rt}','H\'(Shannon)':'H\'',
            };
            if (window.katex && latexMap[d.label]) {
                try {
                    var span = document.createElement('span');
                    katex.render(latexMap[d.label], span, { throwOnError:false, displayMode:false, strict:false });
                    btn.appendChild(span);
                } catch(e) { btn.textContent = d.label; }
            } else {
                btn.textContent = d.label;
            }
            btn.addEventListener('mousedown', function(e) {
                e.preventDefault(); // keep focus on input
                waInsert(d.ins);
            });
            tb.appendChild(btn);
        });
    }

    // ── Core WA input state ──────────────────────────────────────
    var _waFocused = false;

    function waFocus() {
        var inp = document.getElementById('wolframInput');
        if (inp) { inp.focus(); inp.setSelectionRange(inp.value.length, inp.value.length); }
    }

    function waClear() {
        var inp = document.getElementById('wolframInput');
        inp.value = '';
        waOnInput();
        waFocus();
    }

    function waInsert(text) {
        var inp = document.getElementById('wolframInput');
        inp.focus();
        var s = inp.selectionStart, e = inp.selectionEnd;
        inp.value = inp.value.substring(0, s) + text + inp.value.substring(e);
        var newPos = s + text.length;
        // If text ends with ( or = leave cursor at end; if = is in middle, after last =
        inp.selectionStart = inp.selectionEnd = newPos;
        waOnInput();
    }

    function waKeyDown(e) {
        if (e.key === 'Enter') { e.preventDefault(); solveWolfram(); }
    }

    function waOnInput() {
        var inp = document.getElementById('wolframInput');
        var val = inp.value;
        // Show/hide clear button
        var clearBtn = document.getElementById('waClearBtn');
        if (clearBtn) clearBtn.classList.toggle('visible', val.length > 0);
        // Update display
        waRenderDisplay(val);
        // Keep compatibility
        updateWolframPreview();
    }

    function waRenderDisplay(val) {
        var display = document.getElementById('waDisplay');
        if (!display) return;

        if (!val) {
            display.innerHTML = '';
            display.classList.add('empty');
            return;
        }
        display.classList.remove('empty');

        // Try to render as LaTeX/math
        var rendered = false;

        if (window.katex) {
            // 1) Try direct KaTeX render (if user typed LaTeX)
            var hasLatex = /\\[a-zA-Z]|[\^_]|\{/.test(val);
            if (hasLatex) {
                try {
                    display.innerHTML = '';
                    katex.render(val, display, { throwOnError: true, displayMode: false, strict: false, trust: true });
                    rendered = true;
                } catch(e) {}
            }

            // 2) Try math.js parse → toTex → KaTeX (for 2x+3, x^2+3x, etc.)
            if (!rendered) {
                try {
                    // Replace common natural language to math.js compatible
                    var mathVal = val
                        .replace(/\bpi\b/gi, 'pi')
                        .replace(/\binf\b/gi, 'Infinity')
                        .replace(/\babs\(/gi, 'abs(')
                        .replace(/\bsqrt\(/gi, 'sqrt(')
                        .replace(/\bcbrt\(/gi, 'cbrt(');
                    var node = math.parse(mathVal);
                    var tex = node.toTex({ parenthesis: 'keep' });
                    display.innerHTML = '';
                    katex.render(tex, display, { throwOnError: true, displayMode: false, strict: false });
                    rendered = true;
                } catch(e) {}
            }
        }

        // 3) Fallback: show plain text nicely
        if (!rendered) {
            display.innerHTML = '<span class="wa-plain">' + escHtml(val) + '</span>';
        }
    }

    function updateWolframPreview() {
        // compatibility shim — actual rendering is done by waRenderDisplay
        var inp = document.getElementById('wolframInput');
        if (inp) waRenderDisplay(inp.value);
    }

    function solveWolfram() {
        var input = document.getElementById('wolframInput').value.trim();
        if (!input) return;
        var rs = document.getElementById('wolframResult');
        rs.innerHTML = '<div class="result-loading"><div class="spinner"></div><div>Resolviendo...</div></div>';
        setTimeout(function() {
            processWolframWithMode(input, wolframMode);
        }, 300);
    }

    function processWolframWithMode(query, mode) {
        if (mode === 'ai' || mode === 'programming') {
            solveWithAI(query);
            return;
        }
        // Map LaTeX commands to keywords for local solver detection
        var qForDetection = query.replace(/\\([a-zA-Z]+)/g, function(m, name) {
            var map = {
                'int':'integral','sum':'suma','prod':'producto','lim':'limite',
                'sqrt':'raiz','frac':'fraccion','partial':'derivada parcial',
                'nabla':'gradiente','infty':'infinito','to':'tiende a',
                'alpha':'alfa','beta':'beta','gamma':'gamma','theta':'theta',
                'lambda':'lambda','mu':'mu','pi':'pi','Delta':'delta',
                'Omega':'omega','times':'por','div':'dividido',
                'sin':'sin','cos':'cos','tan':'tan','log':'log','ln':'ln'
            };
            return map[name] || map[name.toLowerCase()] || name;
        });

        // Try local solvers first
        var result = tryLocalSolvers(qForDetection, mode);
        if (result && result.type !== 'error') {
            displayWolframResult(result);
            return;
        }

        // For math mode, try direct math.js evaluation
        if (mode === 'math') {
            // Try evaluate as-is (handles: 2+2*3, sqrt(144), sin(pi/2), etc.)
            var cleanQuery = query.replace(/\\pi/g, 'pi').replace(/\\sqrt/g, 'sqrt').replace(/\\sin/g, 'sin').replace(/\\cos/g, 'cos').replace(/\\tan/g, 'tan').replace(/\\ln/g, 'log').replace(/\\log/g, 'log10').replace(/[{}]/g, '').trim();
            try {
                var ev = math.evaluate(cleanQuery);
                if (typeof ev === 'number' && isFinite(ev)) {
                    var evR = Math.round(ev * 1e10) / 1e10;
                    var tex = mathToTex(cleanQuery);
                    displayWolframResult({
                        type:'math', query:query,
                        interpretation:'Evaluar: ' + cleanQuery,
                        result: String(evR),
                        formula: '$$' + tex + ' = ' + evR + '$$',
                        steps: ['Expresión: ' + cleanQuery, 'Resultado: ' + evR],
                        explanation:'Evaluación directa'
                    });
                    return;
                }
            } catch(e) {}
        }

        // All other cases: use AI
        solveWithAI(query);
    }

    function tryLocalSolvers(query, mode) {
        var lq = query.toLowerCase();
        if (mode === 'math') {
            // Derivatives
            if (lq.match(/^(derivada|derivative|derivar)\b/) || lq.match(/\brespect\s*(to|a)\b/)) return solveMathDerivative(query);
            // Integrals
            if (lq.match(/^(integral|integrar|∫)\b/) || lq.match(/\bdx\b|\bdy\b/)) return solveMathIntegral(query);
            // Limits
            if (lq.match(/\b(limite|limit|lim)\b/) || lq.match(/->/)) return solveMathLimit(query);
            // Equations with = sign
            if (lq.indexOf('=') !== -1 && /[a-z]/.test(lq)) return solveMathEquation(query);
            return null;
        }
        if (mode === 'physics') {
            if (lq.match(/\bvelocidad\b/) || lq.match(/\bv\s*=\s*d\/t\b/)) return solvePhysicsVelocity(query);
            if (lq.match(/\benergia\s*cinetica\b/) || lq.match(/\bkinetic\b/)) return solvePhysicsEnergy(query);
            if (lq.match(/\bfuerza\b/) || lq.match(/\bforce\b/) || lq.match(/\bf\s*=\s*m\s*a\b/)) return solvePhysicsForce(query);
            if (lq.match(/\btrabajo\b/) || lq.match(/\bwork\b/)) return solvePhysicsWork(query);
            if (lq.match(/\bpotencia\b/) || lq.match(/\bpower\b/)) return solvePhysicsPower(query);
            if (lq.match(/\bdensidad\b/) || lq.match(/\bdensity\b/)) return solvePhysicsDensity(query);
            if (lq.match(/\bpresion\b/)) return solvePhysicsPressure(query);
            if (lq.match(/\bohm\b/) || lq.match(/\bvoltaje\b/)) return solvePhysicsOhm(query);
            return null;
        }
        if (mode === 'chemistry') {
            if (lq.match(/\bmasa\s*molar\b/) || lq.match(/\bpeso\s*molecular\b/)) return solveChemistryMolarMass(query);
            if (lq.match(/\bph\b/)) return solveChemistryPH(query);
            if (lq.match(/\bdiluci/)) return solveChemistryDilution(query);
            if (lq.match(/\bporcentual\b/) || lq.match(/\bcomposicion\b/)) return solveChemistryPercent(query);
            return null;
        }
        if (mode === 'biology') {
            if (lq.match(/\bcrecimiento\s*poblacional\b/)) return solveBioPopulation(query);
            if (lq.match(/\beficiencia\s*energetica\b/)) return solveBioEnergy(query);
            if (lq.match(/\bbiodivers/) || lq.match(/\bshannon\b/)) return solveBioBiodiversity(query);
            return null;
        }
        return null;
    }

    // ─── SOLVE WITH AI ───────────────────────────────────────────
    function solveWithAI(query) {
        var rs = document.getElementById('wolframResult');
        rs.innerHTML = '<div class="result-loading"><div class="spinner"></div><div>Consultando IA...</div></div>';

        var modeContext = {
            math: 'matemáticas (álgebra, cálculo, trigonometría, ecuaciones, integrales, derivadas, límites, estadística, etc.)',
            physics: 'física (cinemática, dinámica, termodinámica, óptica, electromagnetismo, etc.)',
            chemistry: 'química (estequiometría, equilibrio, termodinámica química, etc.)',
            biology: 'biología y ecosistemas (ecología, genética, fisiología, etc.)',
            programming: 'programación y algoritmos',
            ai: 'cualquier tema académico'
        };

        var systemPrompt = 'Eres LC-Tutor, un asistente matemático y científico experto. Responde SIEMPRE en español. ' +
            'Cuando resuelvas problemas: (1) muestra TODOS los pasos detallados, (2) usa notación LaTeX con $$ para fórmulas en bloque y $ para inline, ' +
            '(3) da el resultado final claramente marcado con **Resultado:**. ' +
            'Ejemplo de formato correcto:\n' +
            '**Paso 1:** Identificar la función: $f(x) = x^2 + 3x$\n' +
            '**Paso 2:** Aplicar regla de la potencia: $\\frac{d}{dx}[x^n] = nx^{n-1}$\n' +
            '**Resultado:** $$f\'(x) = 2x + 3$$\n' +
            'Contexto de la materia: ' + (modeContext[wolframMode] || 'matemáticas');

        var body = new URLSearchParams({
            slug: 'wolfram-query',
            lesson_title: 'LC-Wolfram: ' + query,
            lesson_subject: modeContext[wolframMode] || 'matematicas',
            correctas: '5',
            total: '5',
            question: 'Resuelve paso a paso, mostrando todo el procedimiento con LaTeX: ' + query,
            system_override: systemPrompt,
            provider: 'auto'
        });
        fetch('ai_tutor.php', { method:'POST', credentials:'same-origin', headers:{'Content-Type':'application/x-www-form-urlencoded'}, cache:'no-store', body:body })
        .then(function(r){ return r.text(); })
        .then(function(raw){
            try {
                var data = JSON.parse(raw);
                if (data.ok && data.ai_text) {
                    displayAIResult(query, data.ai_text);
                } else {
                    displayAIResult(query, '⚠️ No se pudo obtener respuesta de la IA. Verifica tu conexión.');
                }
            } catch(e) {
                displayAIResult(query, '⚠️ Error al procesar: ' + raw.substring(0,300));
            }
        })
        .catch(function(err){
            displayAIResult(query, '⚠️ Error de conexión: ' + err.message);
        });
    }

    function displayAIResult(query, text) {
        var rs = document.getElementById('wolframResult');
        var modeIcon = { ai:'🤖', programming:'💻', math:'🔢', physics:'⚡', chemistry:'🧪', biology:'🌿' };
        var icon = modeIcon[wolframMode] || '🤖';
        var h = '';
        h += '<div class="wolfram-card">';
        h += '<div class="wolfram-card-header">' + icon + ' ' + (wolframMode === 'programming' ? 'Asistente de Programacion' : 'LC-Tutor IA') + '</div>';
        h += '<div class="wolfram-card-body"><div class="ai-text" id="wolframAiText">' + renderMd(text) + '</div></div>';
        h += '</div>';
        rs.innerHTML = h;
        // Render math with a slight delay to ensure DOM is ready
        setTimeout(function() {
            var el = document.getElementById('wolframAiText');
            if (!el) el = rs;
            try {
                if (window.renderMathInElement) {
                    renderMathInElement(el, {
                        delimiters:[
                            {left:"$$",right:"$$",display:true},
                            {left:"$",right:"$",display:false},
                            {left:"\\(",right:"\\)",display:false},
                            {left:"\\[",right:"\\]",display:true}
                        ],
                        throwOnError:false
                    });
                }
            } catch(e) {}
        }, 150);
    }

    // ─── MATH SOLVERS ────────────────────────────────────────────
    function mathToTex(expr) {
        // Convert math.js string output to cleaner LaTeX
        try {
            return math.parse(expr).toTex({ parenthesis: 'keep' });
        } catch(e) {
            // Manual cleanup of common patterns
            return expr
                .replace(/\*\*/g, '^')
                .replace(/\s*\*\s*/g, ' \\cdot ')
                .replace(/sqrt\(([^)]+)\)/g, '\\sqrt{$1}')
                .replace(/\^(\d+)/g, '^{$1}');
        }
    }

    function solveMathDerivative(query) {
        var vMatch = query.match(/respect(?:o)?\s+(?:to\s+|a\s+)?(\w+)/i);
        var variable = vMatch ? vMatch[1] : 'x';
        var func = query
            .replace(/^(?:derivada|derivative|derivar)\s+(?:de\s+|of\s+)?/i, '')
            .replace(/\s*respect(?:o)?\s+(?:to\s+|a\s+)?\w+/i, '')
            .replace(/\s+d\w\s*$/, '')
            .trim();
        if (!func) return { type:'error', query:query, result:'Especifica la funcion a derivar. Ej: derivada x^2 + 3x' };
        try {
            var deriv = math.derivative(func, variable);
            var dStr = deriv.toString();
            var dTex = mathToTex(dStr);
            var fTex = mathToTex(func);
            var pts = [];
            try {
                var compiled = math.parse(func).compile();
                for (var xi = -5; xi <= 5; xi += 0.2) {
                    var scope = {}; scope[variable] = xi;
                    try { pts.push({ x: Math.round(xi*10)/10, y: Math.round(compiled.evaluate(scope)*100)/100 }); } catch(e) {}
                }
            } catch(e) {}
            return {
                type:'math', query:query,
                interpretation: 'Derivada de ' + func + ' respecto a ' + variable,
                result: "f'(" + variable + ') = ' + dTex,
                formula: '$$\\frac{d}{d' + variable + '}\\left(' + fTex + '\\right) = ' + dTex + '$$',
                graph: { label:'f(' + variable + ') = ' + func, points:pts },
                alternate: [ 'Notacion prima: f\'(' + variable + ') = ' + dTex, 'Notacion Leibniz: \\(\\frac{d}{d' + variable + '}(' + fTex + ')\\)' ],
                steps: [
                    'Funcion: f(' + variable + ') = ' + func,
                    'Aplicar reglas de derivacion',
                    'Regla de la potencia: d/dx[xⁿ] = n·xⁿ⁻¹',
                    'Resultado: f\'(' + variable + ') = ' + dTex
                ],
                explanation: 'Derivada calculada con math.js'
            };
        } catch(e) {
            return { type:'error', query:query, result:'No se pudo derivar "' + func + '". Asegúrate de usar sintaxis como: x^2 + 3*x o sin(x)' };
        }
    }

    function solveMathIntegral(query) {
        // Parse function from query
        var func = query
            .replace(/^(?:integral|integrar|∫)\s+(?:de\s+|of\s+)?/i, '')
            .replace(/\s*d[xyz]\s*$/i, '')
            .replace(/\s*dx\s*$/i, '')
            .trim();

        // Detect variable
        var varMatch = query.match(/d([xyz])\s*$/i);
        var variable = varMatch ? varMatch[1] : 'x';

        if (!func) return { type:'error', query:query, result:'Especifica la funcion. Ej: integral 2x dx' };

        // Try simple polynomial integration manually
        var fTex = mathToTex(func);

        // Try to compute a numeric definite integral if limits are given
        var limMatch = query.match(/(?:de|from)\s+([\d.-]+)\s+(?:a|to)\s+([\d.-]+)/i);
        if (limMatch) {
            var a2 = parseFloat(limMatch[1]), b2 = parseFloat(limMatch[2]);
            // Numerical integration (Simpson's rule)
            try {
                var compiled2 = math.parse(func).compile();
                var n2 = 1000;
                var h2 = (b2 - a2) / n2;
                var sum2 = 0;
                for (var i2 = 0; i2 <= n2; i2++) {
                    var xi2 = a2 + i2 * h2;
                    var scope2 = {}; scope2[variable] = xi2;
                    var fi2 = compiled2.evaluate(scope2);
                    sum2 += (i2 === 0 || i2 === n2) ? fi2 : (i2 % 2 === 0 ? 2 * fi2 : 4 * fi2);
                }
                var result2 = Math.round(h2 / 3 * sum2 * 1e8) / 1e8;
                return {
                    type:'math', query:query,
                    interpretation: 'Integral definida de ' + func + ' de ' + a2 + ' a ' + b2,
                    result: String(result2),
                    formula: '$$\\int_{' + a2 + '}^{' + b2 + '} \\left(' + fTex + '\\right)\\,d' + variable + ' = ' + result2 + '$$',
                    steps: [
                        'Función: f(' + variable + ') = ' + func,
                        'Límites: [' + a2 + ', ' + b2 + ']',
                        'Integración numérica (regla de Simpson, n=1000)',
                        'Resultado ≈ ' + result2
                    ],
                    explanation: 'Integral definida calculada numéricamente'
                };
            } catch(e) {}
        }

        // Indefinite: try basic polynomial rules
        // Return formula and route complex ones to AI
        return {
            type:'math', query:query,
            interpretation: 'Integral indefinida de ' + func,
            result: '\\int \\left(' + fTex + '\\right)\\,d' + variable + ' + C',
            formula: '$$\\int \\left(' + fTex + '\\right)\\,d' + variable + '$$',
            steps: [
                'Función: f(' + variable + ') = ' + func,
                'Para polinomios: ∫xⁿ dx = xⁿ⁺¹/(n+1) + C',
                'Para trigonométricas: ∫sin(x)dx = -cos(x)+C, ∫cos(x)dx = sin(x)+C',
                'Para exponenciales: ∫eˣdx = eˣ+C',
                'Usa modo IA General para integrales complejas'
            ],
            explanation: 'Para integrales simbólicas avanzadas (por partes, sustitución), usa el modo IA General'
        };
    }

    function solveMathEquation(query) {
        var eq = query.replace(/^(?:resolver|solve)\s+/i, '').trim();
        var parts = eq.split('=');
        if (parts.length < 2) {
            // No equals sign — try to evaluate or show form
            try {
                var n = math.parse(eq);
                var tex = n.toTex({ parenthesis:'keep' });
                return { type:'math', query:query, interpretation:'Expresion: ' + tex, result:'Expresion matematica', formula:'$$' + tex + '$$', steps:['Para resolver, usa "resolver ' + eq + ' = 0"'], explanation:'Puedes escribir resuelve ' + eq + ' = 0' };
            } catch(e) {}
            return { type:'error', query:query, result:'Escribe una ecuacion con =. Ej: 2x + 3 = 7' };
        }

        var left = parts[0].trim();
        var right = parts[1].trim();

        // Move everything to left: left - right = 0
        // This automatically handles x on either side
        var fullExpr = '(' + left + ') - (' + right + ')';

        // Determine if linear, quadratic, etc. by checking with math.js
        // Collect polynomial coefficients by substituting test values
        var hasX = (left + right).indexOf('x') !== -1 || (left + right).indexOf('X') !== -1;

        if (!hasX) {
            // Pure numeric, just evaluate
            try {
                var lv = math.evaluate(left), rv = math.evaluate(right);
                var eq2 = Math.abs(lv - rv) < 1e-9;
                return { type:'math', query:query, interpretation: left + ' = ' + right, result: eq2 ? 'Verdadero ✓' : 'Falso — ' + lv + ' ≠ ' + rv, formula: '$$' + left + ' = ' + right + '$$', steps:['Lado izquierdo: ' + lv, 'Lado derecho: ' + rv, eq2 ? 'Son iguales' : 'No son iguales'], explanation: 'Evaluacion numerica directa' };
            } catch(e) {}
        }

        // Evaluate expression at multiple x values to determine degree
        var evalAt = function(xv) {
            try { return math.evaluate(fullExpr, { x: xv }); } catch(e) { return NaN; }
        };

        var f0 = evalAt(0), f1 = evalAt(1), f2 = evalAt(2), fn1 = evalAt(-1), f3 = evalAt(3);

        // Check if linear: f(x) = a*x + b  => differences are constant
        var d01 = f1 - f0, d12 = f2 - f1, d23 = f3 - f2;
        var isLinear = Math.abs(d01 - d12) < 1e-8 && Math.abs(d12 - d23) < 1e-8;

        if (isLinear && Math.abs(d01) > 1e-10) {
            // linear: slope = d01, intercept = f0  => x = -f0/slope
            var slope = d01;
            var xSol = -f0 / slope;
            xSol = Math.round(xSol * 1e8) / 1e8;
            var texL, texR;
            try { texL = math.parse(left).toTex({parenthesis:'keep'}); } catch(e) { texL = left; }
            try { texR = math.parse(right).toTex({parenthesis:'keep'}); } catch(e) { texR = right; }
            return {
                type:'math', query:query,
                interpretation: 'Ecuacion lineal: ' + left + ' = ' + right,
                result: 'x = ' + xSol,
                formula: '$$' + texL + ' = ' + texR + ' \\implies x = ' + xSol + '$$',
                steps: [
                    'Ecuacion: ' + left + ' = ' + right,
                    'Pasar todos los terminos con x a la izquierda',
                    'Coeficiente de x: ' + Math.round(slope*1e8)/1e8,
                    'Termino independiente: ' + Math.round(f0*1e8)/1e8,
                    'x = ' + (-Math.round(f0*1e8)/1e8) + ' / ' + Math.round(slope*1e8)/1e8,
                    'x = ' + xSol
                ],
                explanation: 'Ecuacion lineal con una solucion'
            };
        }

        // Check quadratic: second differences constant
        var dd1 = d12 - d01, dd2 = d23 - d12;
        var isQuad = Math.abs(dd1 - dd2) < 1e-6 && Math.abs(dd1) > 1e-10;

        if (isQuad) {
            var a = dd1 / 2;
            var b2 = d01 - a * (2*0 + 1); // slope at x=0 approx
            b2 = (f1 - f0) - a;
            var c2 = f0;
            // refine: a*0^2 + b*0 + c = f0 => c = f0
            // a*1 + b + c = f1 => b = f1 - f0 - a
            b2 = f1 - f0 - a;
            var disc = b2*b2 - 4*a*c2;
            var discR = Math.round(disc*1e6)/1e6;
            var pts = [];
            for (var xi2 = -10; xi2 <= 10; xi2 += 0.25) {
                var yp = evalAt(xi2);
                if (isFinite(yp)) pts.push({x: Math.round(xi2*100)/100, y: Math.round(yp*100)/100});
            }
            var aR = Math.round(a*1e6)/1e6, bR = Math.round(b2*1e6)/1e6, cR = Math.round(c2*1e6)/1e6;
            if (disc >= 0) {
                var x1 = (-b2 + Math.sqrt(disc)) / (2*a);
                var x2 = (-b2 - Math.sqrt(disc)) / (2*a);
                x1 = Math.round(x1*1e6)/1e6; x2 = Math.round(x2*1e6)/1e6;
                return {
                    type:'math', query:query,
                    interpretation: 'Ecuacion cuadratica: ' + left + ' = ' + right,
                    result: disc > 1e-9 ? 'x₁ = ' + x1 + ', x₂ = ' + x2 : 'x = ' + x1 + ' (doble)',
                    formula: '$$x = \\frac{-(' + bR + ') \\pm \\sqrt{' + discR + '}}{2 \\cdot ' + aR + '} \\implies x_1=' + x1 + ',\\; x_2=' + x2 + '$$',
                    graph: { label: left + ' = ' + right, points: pts },
                    alternate: ['Discriminante: Δ = ' + discR, 'x₁ = ' + x1, 'x₂ = ' + x2],
                    steps: [
                        'Ecuacion: ' + left + ' = ' + right,
                        'Forma ax² + bx + c = 0: a ≈ ' + aR + ', b ≈ ' + bR + ', c ≈ ' + cR,
                        'Discriminante: Δ = b² - 4ac = ' + discR,
                        'x₁ = ' + x1, 'x₂ = ' + x2
                    ],
                    explanation: disc > 1e-9 ? 'Ecuacion cuadratica con dos soluciones reales' : 'Solucion doble'
                };
            } else {
                return {
                    type:'math', query:query,
                    interpretation: 'Ecuacion cuadratica: ' + left + ' = ' + right,
                    result: 'Sin soluciones reales (Δ = ' + discR + ' < 0)',
                    formula: '$$x = \\frac{-(' + bR + ') \\pm \\sqrt{' + discR + '}}{2 \\cdot ' + aR + '}$$',
                    graph: { label: left + ' = ' + right, points: pts },
                    steps: ['Discriminante negativo: Δ = ' + discR, 'Las soluciones son complejas'],
                    explanation: 'La parabola no cruza el eje x'
                };
            }
        }

        // Fallback: try numeric root-finding with bisection
        try {
            // Try to find root numerically between -1000 and 1000
            var roots = [];
            var prevSign = Math.sign(evalAt(-100));
            for (var xi3 = -99; xi3 <= 100; xi3++) {
                var fxi = evalAt(xi3);
                if (isFinite(fxi) && Math.abs(fxi) < 1e-8) {
                    roots.push(Math.round(xi3*1e6)/1e6);
                    prevSign = Math.sign(fxi);
                } else if (isFinite(fxi) && Math.sign(fxi) !== prevSign && prevSign !== 0) {
                    // Bisect
                    var lo = xi3-1, hi = xi3;
                    for (var iter = 0; iter < 50; iter++) {
                        var mid = (lo+hi)/2;
                        var fmid = evalAt(mid);
                        if (Math.abs(fmid) < 1e-10) { lo = hi = mid; break; }
                        if (Math.sign(fmid) === Math.sign(evalAt(lo))) lo = mid; else hi = mid;
                    }
                    var root = Math.round((lo+hi)/2*1e8)/1e8;
                    if (!roots.some(function(r){ return Math.abs(r-root)<0.001; })) roots.push(root);
                    prevSign = Math.sign(fxi);
                } else if (isFinite(fxi)) {
                    prevSign = Math.sign(fxi);
                }
            }
            if (roots.length > 0) {
                return {
                    type:'math', query:query,
                    interpretation: 'Resolver: ' + left + ' = ' + right,
                    result: roots.map(function(r,i){return 'x'+(roots.length>1?'₁₂₃₄'[i]||String(i+1):'') + ' = ' + r;}).join(', '),
                    formula: '$$' + left + ' = ' + right + '$$',
                    steps: ['Ecuacion: ' + eq, 'Metodo: busqueda numerica'].concat(roots.map(function(r){return 'Raiz: x = ' + r;})),
                    explanation: 'Solucion numerica aproximada'
                };
            }
        } catch(e2) {}

        return { type:'math', query:query, interpretation:'Resolver ecuacion', result:'No se pudo identificar la ecuacion. Intenta el modo IA General.', steps:['Formatos: x+5=10, 2x^2+3x+1=0, 5=2x+3', 'Para expresiones complejas usa el modo IA'], explanation:'Usa formato claro con = para indicar la igualdad' };
    }

    function solveMathLimit(query) {
        var m = query.match(/(?:limite|limit)\s+(?:\w+\s*->\s*(\S+?)(?:\s+of\s+(.+?))?)/i);
        if (!m) m = query.match(/(\w+)\s*->\s*(\S+?)(?:\s+of\s+(.+?))?/i);
        if (m) {
            var pt = m[2] || m[1] || '0';
            var fnc = m[3] || m[1] || 'x';
            if (!m[3] && m[1]) { fnc = m.index > 0 ? query.substring(0, m.index).trim() : 'x'; }
            return { type:'math', query:query, interpretation:'Limite cuando x → ' + pt, result:'\\lim_{x \\to ' + pt + '} ' + fnc, formula:'$$\\lim_{x \\to ' + pt + '}\\left(' + fnc + '\\right)$$', steps:[ 'Evaluar ' + fnc + ' cuando x se acerca a ' + pt, 'Aplicar propiedades de limites' ], explanation:'Calculo de limite' };
        }
        return { type:'error', query:query, result:'Sintaxis: limite x->0 of sin(x)/x' };
    }

    // ─── PHYSICS SOLVERS ─────────────────────────────────────────
    function solvePhysicsVelocity(query) {
        var m = query.match(/(\w+)\s*=\s*(\d+\.?\d*)/gi);
        var vals = {}; if (m) m.forEach(function(x){ var p=x.split('='); vals[p[0].trim().toLowerCase()]=parseFloat(p[1]); });
        if (vals.d && vals.t) {
            var d = vals.d, t = vals.t, v = d/t;
            return { type:'physics', query:query, interpretation:'Velocidad: distancia=' + d + ', tiempo=' + t, result:v.toFixed(2) + ' ' + (d > 100 ? 'km/h' : 'm/s'), formula:'$$v = \\frac{d}{t} = \\frac{' + d + '}{' + t + '} = ' + v.toFixed(2) + '\\,\\text{' + (d>100?'km/h':'m/s') + '}$$', steps:[ 'd = ' + d, 't = ' + t, 'v = ' + d + ' / ' + t, 'v = ' + v.toFixed(2) ], explanation:'Velocidad promedio = distancia / tiempo' };
        }
        return { type:'error', query:query, result:'Usa formato: v = d/t d=120 t=2' };
    }

    function solvePhysicsEnergy(query) {
        var m = query.match(/(\w+)\s*=\s*(\d+\.?\d*)/gi);
        var vals = {}; if (m) m.forEach(function(x){ var p=x.split('='); vals[p[0].trim().toLowerCase()]=parseFloat(p[1]); });
        if (vals.m && vals.v) {
            var masa = vals.m, v = vals.v, ec = 0.5 * masa * v * v;
            return { type:'physics', query:query, interpretation:'Energia cinetica: masa=' + masa + 'kg, velocidad=' + v + 'm/s', result:ec.toFixed(2) + ' J', formula:'$$E_c = \\frac{1}{2}mv^2 = \\frac{1}{2}\\cdot' + masa + '\\cdot' + v + '^2 = ' + ec.toFixed(2) + '\\,\\text{J}$$', steps:[ 'm = ' + masa + ' kg', 'v = ' + v + ' m/s', 'Ec = 0.5 × ' + masa + ' × ' + v + '²', 'Ec = ' + ec.toFixed(2) + ' J' ], explanation:'Energia cinetica de un cuerpo de ' + masa + ' kg a ' + v + ' m/s' };
        }
        return { type:'error', query:query, result:'Usa formato: energia cinetica m=10 v=5' };
    }

    function solvePhysicsForce(query) {
        var m = query.match(/(\w+)\s*=\s*(\d+\.?\d*)/gi);
        var vals = {}; if (m) m.forEach(function(x){ var p=x.split('='); vals[p[0].trim().toLowerCase()]=parseFloat(p[1]); });
        if (vals.m && vals.a) {
            var masa = vals.m, a = vals.a, f = masa * a;
            return { type:'physics', query:query, interpretation:'Fuerza: masa=' + masa + 'kg, aceleracion=' + a + 'm/s²', result:f.toFixed(2) + ' N', formula:'$$F = ma = ' + masa + '\\cdot' + a + ' = ' + f.toFixed(2) + '\\,\\text{N}$$', steps:[ 'm = ' + masa + ' kg', 'a = ' + a + ' m/s²', 'F = ' + masa + ' × ' + a, 'F = ' + f.toFixed(2) + ' N' ], explanation:'Segunda ley de Newton: Fuerza = masa × aceleracion' };
        }
        return { type:'error', query:query, result:'Usa formato: F = ma m=10 a=5' };
    }

    function solvePhysicsWork(query) {
        var m = query.match(/(\w+)\s*=\s*(\d+\.?\d*)/gi);
        var vals = {}; if (m) m.forEach(function(x){ var p=x.split('='); vals[p[0].trim().toLowerCase()]=parseFloat(p[1]); });
        var F = vals.f || vals.F || 0, d = vals.d || 0;
        if (F && d) {
            var theta = vals.theta || vals.angulo || 0;
            var rad = theta * Math.PI / 180;
            var W = F * d * Math.cos(rad);
            return { type:'physics', query:query, interpretation:'Trabajo: F=' + F + 'N, d=' + d + 'm, θ=' + theta + '°', result:W.toFixed(2) + ' J', formula:'$$W = Fd\\cos\\theta = ' + F + '\\cdot' + d + '\\cdot\\cos(' + theta + '°) = ' + W.toFixed(2) + '\\,\\text{J}$$', steps:[ 'F = ' + F + ' N', 'd = ' + d + ' m', 'θ = ' + theta + '°', 'W = ' + F + ' × ' + d + ' × cos(' + theta + '°)', 'W = ' + W.toFixed(2) + ' J' ], explanation:'Trabajo mecanico = fuerza × distancia × coseno del angulo' };
        }
        return { type:'error', query:query, result:'Usa formato: trabajo F=50 d=10 theta=0' };
    }

    function solvePhysicsPower(query) {
        var m = query.match(/(\w+)\s*=\s*(\d+\.?\d*)/gi);
        var vals = {}; if (m) m.forEach(function(x){ var p=x.split('='); vals[p[0].trim().toLowerCase()]=parseFloat(p[1]); });
        var W = vals.w || vals.trabajo || 0, t = vals.t || vals.tiempo || 0;
        if (W && t) {
            var P = W / t;
            return { type:'physics', query:query, interpretation:'Potencia: trabajo=' + W + 'J, tiempo=' + t + 's', result:P.toFixed(2) + ' W', formula:'$$P = \\frac{W}{t} = \\frac{' + W + '}{' + t + '} = ' + P.toFixed(2) + '\\,\\text{W}$$', steps:[ 'W = ' + W + ' J', 't = ' + t + ' s', 'P = ' + W + ' / ' + t, 'P = ' + P.toFixed(2) + ' W' ], explanation:'Potencia = trabajo / tiempo. 1 Watt = 1 J/s' };
        }
        return { type:'error', query:query, result:'Usa formato: potencia W=1000 t=10' };
    }

    function solvePhysicsDensity(query) {
        var m = query.match(/(\w+)\s*=\s*(\d+\.?\d*)/gi);
        var vals = {}; if (m) m.forEach(function(x){ var p=x.split('='); vals[p[0].trim().toLowerCase()]=parseFloat(p[1]); });
        var masa = vals.m || vals.masa || 0, V = vals.v || vals.volumen || 0;
        if (masa && V) {
            var rho = masa / V;
            return { type:'physics', query:query, interpretation:'Densidad: masa=' + masa + 'kg, volumen=' + V + 'm³', result:rho.toFixed(2) + ' kg/m³', formula:'$$\\rho = \\frac{m}{V} = \\frac{' + masa + '}{' + V + '} = ' + rho.toFixed(2) + '\\,\\text{kg/m}^3$$', steps:[ 'm = ' + masa + ' kg', 'V = ' + V + ' m³', 'ρ = ' + masa + ' / ' + V, 'ρ = ' + rho.toFixed(2) + ' kg/m³' ], explanation:'Densidad = masa / volumen' };
        }
        return { type:'error', query:query, result:'Usa formato: densidad m=10 V=2' };
    }

    function solvePhysicsPressure(query) {
        var m = query.match(/(\w+)\s*=\s*(\d+\.?\d*)/gi);
        var vals = {}; if (m) m.forEach(function(x){ var p=x.split('='); vals[p[0].trim().toLowerCase()]=parseFloat(p[1]); });
        var rho = vals.densidad || vals.rho || 1000;
        var h = vals.h || vals.profundidad || vals.h || 0;
        if (h) {
            var g = 9.81;
            var P = rho * g * h;
            return { type:'physics', query:query, interpretation:'Presion hidrostatica: ρ=' + rho + 'kg/m³, h=' + h + 'm', result:P.toFixed(2) + ' Pa', formula:'$$P = \\rho g h = ' + rho + '\\cdot' + g + '\\cdot' + h + ' = ' + P.toFixed(2) + '\\,\\text{Pa}$$', steps:[ 'ρ = ' + rho + ' kg/m³', 'g = 9.81 m/s²', 'h = ' + h + ' m', 'P = ' + rho + ' × 9.81 × ' + h, 'P = ' + P.toFixed(2) + ' Pa' ], explanation:'Presion hidrostatica = densidad × gravedad × profundidad' };
        }
        return { type:'error', query:query, result:'Usa formato: presion h=10' };
    }

    function solvePhysicsOhm(query) {
        var m = query.match(/(\w+)\s*=\s*(\d+\.?\d*)/gi);
        var vals = {}; if (m) m.forEach(function(x){ var p=x.split('='); vals[p[0].trim().toLowerCase()]=parseFloat(p[1]); });
        var I = vals.i || vals.I || 0, R = vals.r || vals.R || 0;
        if (I && R) {
            var V = I * R;
            return { type:'physics', query:query, interpretation:'Ley de Ohm: I=' + I + 'A, R=' + R + 'Ω', result:V.toFixed(2) + ' V', formula:'$$V = IR = ' + I + '\\cdot' + R + ' = ' + V.toFixed(2) + '\\,\\text{V}$$', steps:[ 'I = ' + I + ' A', 'R = ' + R + ' Ω', 'V = ' + I + ' × ' + R, 'V = ' + V.toFixed(2) + ' V' ], explanation:'Ley de Ohm: Voltaje = Corriente × Resistencia' };
        }
        return { type:'error', query:query, result:'Usa formato: Ley de Ohm I=2 R=10' };
    }

    // ─── CHEMISTRY SOLVERS ───────────────────────────────────────
    function solveChemistryMolarMass(query) {
        var formulas = { 'H2O':'Agua (18 g/mol)', 'CO2':'Dioxido de carbono (44 g/mol)', 'NaCl':'Cloruro de sodio (58.5 g/mol)', 'HCl':'Acido clorhidrico (36.5 g/mol)', 'H2SO4':'Acido sulfurico (98 g/mol)', 'NH3':'Amoniaco (17 g/mol)', 'CH4':'Metano (16 g/mol)', 'C2H5OH':'Etanol (46 g/mol)', 'C6H12O6':'Glucosa (180 g/mol)', 'C12H22O11':'Sacarosa (342 g/mol)' };
        for (var key in formulas) {
            if (query.toUpperCase().indexOf(key) !== -1) {
                var parts = key.match(/([A-Z][a-z]*)(\d*)/g);
                var detail = parts ? parts.join(' + ') : key;
                return { type:'chemistry', query:query, interpretation:'Masa molar de ' + formulas[key], result:formulas[key], formula:'$$M\\left(' + key + '\\right) = ' + formulas[key].match(/\(([^)]+)\)/)[1] + '$$', alternate:[ 'Formula: ' + key, detail ], steps:[ 'Identificar compuesto: ' + key, 'Buscar masas atomicas en tabla periodica', 'Sumar masas atomicas', formulas[key] ], explanation:'La masa molar es la masa de un mol del compuesto' };
            }
        }
        return { type:'chemistry', query:query, result:'Compuesto no reconocido. Ej: masa molar H2O, CO2, NaCl, HCl, H2SO4, NH3, CH4, C6H12O6', steps:['Compuestos disponibles: H2O, CO2, NaCl, HCl, H2SO4, NH3, CH4, C2H5OH, C6H12O6, C12H22O11'] };
    }

    function solveChemistryPH(query) {
        var m = query.match(/(\d+\.?\d*e[+-]?\d+)/i);
        if (!m) m = query.match(/H\+\s*=\s*(\d+\.?\d*)/i);
        if (!m) m = query.match(/(\d+\.?\d*)/);
        if (m) {
            var conc = parseFloat(m[1]);
            if (conc > 0) {
                var pH = -Math.log10(conc);
                return { type:'chemistry', query:query, interpretation:'pH con [H⁺] = ' + conc.toExponential() + ' M', result:'pH = ' + pH.toFixed(2), formula:'$$\\text{pH} = -\\log_{10}[' + conc.toExponential() + '] = ' + pH.toFixed(2) + '$$', steps:[ '[H⁺] = ' + conc.toExponential() + ' M', 'pH = -log₁₀(' + conc.toExponential() + ')', 'pH = ' + pH.toFixed(2) ], explanation:pH < 7 ? 'Solucion acida (pH < 7)' : (pH > 7 ? 'Solucion basica (pH > 7)' : 'Solucion neutra (pH = 7)') };
            }
        }
        return { type:'error', query:query, result:'Usa formato: pH H+=0.001 o pH H+=1e-3' };
    }

    function solveChemistryDilution(query) {
        var m = query.match(/(\w+)\s*=\s*(\d+\.?\d*)/gi);
        var vals = {}; if (m) m.forEach(function(x){ var p=x.split('='); vals[p[0].trim().toLowerCase()]=parseFloat(p[1]); });
        var C1 = vals.c1 || vals.C1 || 0, V1 = vals.v1 || vals.V1 || 0, V2 = vals.v2 || vals.V2 || 0;
        if (C1 && V1 && V2) {
            var C2 = C1 * V1 / V2;
            return { type:'chemistry', query:query, interpretation:'Dilucion: C₁=' + C1 + 'M, V₁=' + V1 + 'mL, V₂=' + V2 + 'mL', result:'C₂ = ' + C2.toFixed(4) + ' M', formula:'$$C_2 = \\frac{C_1 V_1}{V_2} = \\frac{' + C1 + ' \\times ' + V1 + '}{' + V2 + '} = ' + C2.toFixed(4) + '\\,\\text{M}$$', steps:[ 'C₁ = ' + C1 + ' M', 'V₁ = ' + V1 + ' mL', 'V₂ = ' + V2 + ' mL', 'C₂ = (' + C1 + ' × ' + V1 + ') / ' + V2, 'C₂ = ' + C2.toFixed(4) + ' M' ], explanation:'Formula de dilucion: C₁V₁ = C₂V₂' };
        }
        return { type:'error', query:query, result:'Usa formato: dilucion C1=6 V1=50 V2=200' };
    }

    function solveChemistryPercent(query) {
        var m = query.match(/(\w+)\s*=\s*(\d+\.?\d*)/gi);
        var vals = {}; if (m) m.forEach(function(x){ var p=x.split('='); vals[p[0].trim().toLowerCase()]=parseFloat(p[1]); });
        var elem = vals.masa_elem || vals.elem || 0, total = vals.masa_total || vals.total || 0;
        if (elem && total) {
            var pct = elem / total * 100;
            return { type:'chemistry', query:query, interpretation:'Composicion porcentual: elemento=' + elem + 'g, total=' + total + 'g', result:pct.toFixed(2) + '%', formula:'$$\\% = \\frac{' + elem + '}{' + total + '} \\times 100 = ' + pct.toFixed(2) + '\\%$$', steps:[ 'Masa del elemento = ' + elem + ' g', 'Masa total = ' + total + ' g', '% = (' + elem + ' / ' + total + ') × 100', '% = ' + pct.toFixed(2) + '%' ], explanation:'Composicion porcentual = (masa elemento / masa total) × 100' };
        }
        return { type:'error', query:query, result:'Usa formato: composicion porcentual masa_elem=32 masa_total=80' };
    }

    // ─── BIOLOGY/ECOSYSTEMS SOLVERS ──────────────────────────────
    function solveBioPopulation(query) {
        var m = query.match(/(\w+)\s*=\s*(\d+\.?\d*)/gi);
        var vals = {}; if (m) m.forEach(function(x){ var p=x.split('='); vals[p[0].trim().toLowerCase()]=parseFloat(p[1]); });
        var N0 = vals.n0 || vals.N0 || vals.n || vals.N || 0;
        var r = vals.r || 0;
        var t = vals.t || 0;
        if (N0 && r !== undefined && t) {
            var Nt = N0 * Math.exp(r * t);
            return { type:'biology', query:query, interpretation:'Crecimiento exponencial: P₀=' + N0 + ', r=' + r + ', t=' + t, result:'P(t) = ' + Math.round(Nt) + ' individuos', formula:'$$P(t) = ' + N0 + 'e^{' + r + '\\cdot' + t + '} = ' + Math.round(Nt) + '$$', steps:[ 'Poblacion inicial: P₀ = ' + N0, 'Tasa de crecimiento: r = ' + r, 'Tiempo: t = ' + t, 'P(t) = ' + N0 + ' × e^(' + r + ' × ' + t + ')', 'P(t) = ' + Math.round(Nt) + ' individuos' ], explanation:'Modelo de crecimiento exponencial: P(t) = P₀ × e^(rt)' };
        }
        return { type:'error', query:query, result:'Usa formato: crecimiento poblacional N0=100 r=0.05 t=10' };
    }

    function solveBioEnergy(query) {
        var m = query.match(/(\w+)\s*=\s*(\d+\.?\d*)/gi);
        var vals = {}; if (m) m.forEach(function(x){ var p=x.split('='); vals[p[0].trim().toLowerCase()]=parseFloat(p[1]); });
        var energia = vals.energia || vals.e || vals.E || 0;
        if (energia) {
            var nivel2 = energia * 0.1;
            var nivel3 = nivel2 * 0.1;
            return { type:'biology', query:query, interpretation:'Transferencia de energia: nivel inicial=' + energia + ' kcal', result:'Nivel 2: ' + nivel2.toFixed(2) + ' kcal | Nivel 3: ' + nivel3.toFixed(2) + ' kcal', formula:'$$\\text{Regla del 10\\%: }' + energia + ' \\times 0.1 = ' + nivel2.toFixed(2) + ',\\; ' + nivel2.toFixed(2) + ' \\times 0.1 = ' + nivel3.toFixed(2) + '$$', steps:[ 'Energia inicial: ' + energia + ' kcal', 'Nivel trofico 2 (10%): ' + energia + ' × 0.1 = ' + nivel2.toFixed(2) + ' kcal', 'Nivel trofico 3 (10%): ' + nivel2.toFixed(2) + ' × 0.1 = ' + nivel3.toFixed(2) + ' kcal', 'Energia perdida como calor: ~90% por nivel' ], explanation:'Regla del 10%: solo ~10% de la energia se transfiere al siguiente nivel trofico' };
        }
        return { type:'error', query:query, result:'Usa formato: eficiencia energetica energia=1000' };
    }

    function solveBioBiodiversity(query) {
        var m = query.match(/(\w+)\s*=\s*(\d+\.?\d*)/gi);
        var vals = {}; if (m) m.forEach(function(x){ var p=x.split('='); vals[p[0].trim().toLowerCase()]=parseFloat(p[1]); });
        var species = [];
        for (var k in vals) { if (k.match(/^s\d+$/)) species.push(vals[k]); }
        if (species.length >= 2) {
            var total = species.reduce(function(a,b){return a+b;}, 0);
            var H = 0;
            var detail = [];
            species.forEach(function(s, i) {
                var p = s / total;
                if (p > 0) H -= p * Math.log(p);
                detail.push('Especie ' + (i+1) + ': ' + s + ' (' + (p*100).toFixed(1) + '%)');
            });
            var maxH = Math.log(species.length);
            var E = H / maxH;
            return { type:'biology', query:query, interpretation:'Indice de Shannon-Wiener', result:'H\' = ' + H.toFixed(4), formula:'$$H\' = -\\sum_{i=1}^{' + species.length + '} p_i \\ln p_i = ' + H.toFixed(4) + '$$', alternate:[ 'Total individuos: ' + total, 'Riqueza: ' + species.length + ' especies', 'Equitatividad (E): ' + E.toFixed(4) ], steps:[].concat(detail, [ 'H\' = ' + H.toFixed(4), 'Entre mayor H\', mayor biodiversidad' ]), explanation:'El indice de Shannon mide la biodiversidad. Valores tipicos: 0.5-1.5 (baja), 1.5-3.5 (media), >3.5 (alta)' };
        }
        return { type:'error', query:query, result:'Usa formato: indice de biodiversidad s1=20 s2=15 s3=10 s4=5 (minimo 2 especies)' };
    }

    // ─── DISPLAY RESULTS ─────────────────────────────────────────
    function renderKatexStr(str) {
        // Render a string that may contain LaTeX into HTML using KaTeX
        if (!str) return '';
        // If it contains $$ or \( it's already LaTeX-wrapped
        if (/\$\$|\\[\(\[]/.test(str)) return str; // let renderMathInElement handle it
        // If it looks like a math expression but isn't wrapped, try to render it
        var hasLatex = /\\[a-zA-Z]|[\^_{}]/.test(str);
        if (hasLatex && window.katex) {
            try {
                var div = document.createElement('div');
                katex.render(str, div, { throwOnError: false, displayMode: false, strict: false });
                return div.innerHTML;
            } catch(e) {}
        }
        return escHtml(str);
    }

    function displayWolframResult(result) {
        var rs = document.getElementById('wolframResult');
        if (result.type === 'error') {
            rs.innerHTML = '<div class="wolfram-card error-card"><div class="wolfram-card-header">⚠️ Error</div><div class="wolfram-card-body">' + escHtml(result.result || 'No se pudo procesar') + '</div></div>';
            return;
        }
        var icon = { math:'🔢', physics:'⚡', chemistry:'🧪', biology:'🌿', geometry:'📐', success:'✅' };
        var typeIcon = icon[result.type] || '📐';
        var h = '';
        h += '<div class="wolfram-card"><div class="wolfram-card-header">' + typeIcon + ' Interpretacion</div><div class="wolfram-card-body wolfram-interp">' + escHtml(result.interpretation || result.query) + '</div></div>';
        // Result rendered with KaTeX if it contains math
        if (result.result) {
            var resHtml = result.result;
            // Wrap with $$ if it looks like a formula and isn't already
            if (/[=^_\\{}]/.test(resHtml) && !/\$/.test(resHtml)) {
                resHtml = '$$' + resHtml + '$$';
            }
            h += '<div class="wolfram-card"><div class="wolfram-card-header">' + typeIcon + ' Resultado</div><div class="wolfram-card-body wolfram-result-value">' + resHtml + '</div></div>';
        }
        if (result.formula) h += '<div class="wolfram-card"><div class="wolfram-card-header">📐 Formula</div><div class="wolfram-card-body formula-math">' + result.formula + '</div></div>';
        if (result.graph && result.graph.points && result.graph.points.length > 5) h += '<div class="wolfram-card"><div class="wolfram-card-header">📈 Grafico</div><div class="wolfram-card-body"><canvas id="wgc" width="600" height="250"></canvas></div></div>';
        if (result.alternate && result.alternate.length > 0) h += '<div class="wolfram-card"><div class="wolfram-card-header">🔄 Formas alternas</div><div class="wolfram-card-body">' + result.alternate.map(function(a){return '<div class="wolfram-alt-item">' + escHtml(a) + '</div>';}).join('') + '</div></div>';
        if (result.steps && result.steps.length > 0) h += '<div class="wolfram-card"><div class="wolfram-card-header">📝 Pasos</div><div class="wolfram-card-body">' + result.steps.map(function(s,i){return '<div class="wolfram-step"><span class="step-num">' + (i+1) + '</span><span class="step-text">' + escHtml(s) + '</span></div>';}).join('') + '</div></div>';
        if (result.explanation) h += '<div class="wolfram-card"><div class="wolfram-card-header">💡 Explicacion</div><div class="wolfram-card-body">' + escHtml(result.explanation) + '</div></div>';
        rs.innerHTML = h;
        setTimeout(function() {
            try {
                if (window.renderMathInElement) renderMathInElement(rs, {
                    delimiters:[
                        {left:"$$",right:"$$",display:true},
                        {left:"$",right:"$",display:false},
                        {left:"\\(",right:"\\)",display:false},
                        {left:"\\[",right:"\\]",display:true}
                    ],
                    throwOnError:false
                });
            } catch(e) {}
            if (result.graph && result.graph.points && result.graph.points.length > 5 && window.Chart) {
                var ctx = document.getElementById('wgc');
                if (ctx) {
                    try {
                        if (window._wolframChart) window._wolframChart.destroy();
                        window._wolframChart = new Chart(ctx, { type:'scatter', data:{datasets:[{label:result.graph.label||'f(x)',data:result.graph.points,borderColor:'#00e5ff',backgroundColor:'rgba(0,229,255,0.1)',showLine:true,fill:true,tension:0.4,pointRadius:0,borderWidth:2}]}, options:{responsive:true,maintainAspectRatio:false,plugins:{legend:{labels:{color:'#e8f4ff',font:{family:'JetBrains Mono'}}}},scales:{x:{grid:{color:'rgba(0,229,255,0.1)'},ticks:{color:'#888'}},y:{grid:{color:'rgba(0,229,255,0.1)'},ticks:{color:'#888'}}}} });
                    } catch(e) { console.error('Graph:', e); }
                }
            }
        }, 100);
    }

    function getStatusIcon(type) {
        var icons = { math:'=>', physics:'~>', chemistry:'~~>', biology:'->', geometry:'[]', error:'XX', success:'OK' };
        return icons[type] || '=>';
    }

    function escHtml(str) {
        return String(str).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');
    }

    // ─── SIDEBAR SEARCH & FILTER ──────────────────────
    function filterChallenges() {
        var query = document.getElementById('searchInput').value.toLowerCase().trim();
        var activeChip = document.querySelector('.filter-chip.active');
        var activeSubject = activeChip ? activeChip.getAttribute('data-subject') : 'all';

        document.querySelectorAll('.subject-group').forEach(function(group) {
            var title = group.previousElementSibling;
            var groupSubject = title && title.classList.contains('nav-title') ? title.textContent.trim() : '';
            var groupVisible = false;

            group.querySelectorAll('.challenge-item').forEach(function(item) {
                var name = item.querySelector('.challenge-name');
                if (!name) return;
                var matchSearch = !query || name.textContent.toLowerCase().includes(query);
                var matchSubject = activeSubject === 'all' || groupSubject === activeSubject;
                var visible = matchSearch && matchSubject;
                item.style.display = visible ? '' : 'none';
                if (visible) groupVisible = true;
            });

            group.style.display = groupVisible ? '' : 'none';
            if (title && title.classList.contains('nav-title')) {
                title.style.display = groupVisible ? '' : 'none';
            }
        });
    }

    function setSubjectFilter(subject) {
        document.querySelectorAll('.filter-chip').forEach(function(chip) {
            chip.classList.toggle('active', chip.getAttribute('data-subject') === subject);
        });
        filterChallenges();
    }

    // ─── AI CHAT WIDGET ──────────────────────────────
    var chatOpen = false;
    var chatHistory = [];
    var isGenerating = false;
    
    // Cargar historial del sessionStorage
    try {
        var saved = sessionStorage.getItem('lc_chat_history_' + currentChallenge);
        if (saved) chatHistory = JSON.parse(saved);
    } catch(e) {}

    function toggleChat() {
        chatOpen = !chatOpen;
        var panel = document.getElementById('chatPanel');
        panel.classList.toggle('visible', chatOpen);
        
        if (chatOpen && chatHistory.length === 0) {
            // Mensaje inicial con contexto del desafío
            var initMsg = getInitialContextMessage();
            addChatMessage('ai', initMsg, false);
        }
    }
    
    function getInitialContextMessage() {
        var challenge = challenges[currentChallenge];
        var title = challenge ? challenge.title : 'Desafío desconocido';
        var difficulty = challenge ? challenge.difficulty : '';
        var description = challenge ? (challenge.description || '') : '';
        
        return '¡Hola! Soy **LC-Tutor**, tu asistente de código.\n\n' +
            'Estoy ayudarte con el desafío actual: **' + title + '**\n' +
            'Nivel: ' + (difficulty || 'No especificado') + '\n\n' +
            (description ? '📋 ' + description.substring(0, 200) + '...\n\n' : '') +
            '¿En qué puedo ayudarte? Puedo:\n' +
            '- Explicarte el problema\n' +
            '- Ayudarte con el código\n' +
            '- Darte pistas sin spoilear la solución\n' +
            '- Explicar conceptos de programación';
    }

    function sendChatMessage() {
        if (isGenerating) return;
        
        var input = document.getElementById('chatInput');
        var msg = input.value.trim();
        if (!msg) return;
        
        // Agregar mensaje del usuario
        addChatMessage('user', msg, true);
        input.value = '';
        
        // Mostrar indicador de "escribiendo"
        showTypingIndicator();
        input.disabled = true;
        isGenerating = true;
        
        // Construir contexto del desafío actual
        var challenge = challenges[currentChallenge];
        var contextInfo = {
            challengeId: currentChallenge,
            challengeTitle: challenge ? challenge.title : '',
            challengeDifficulty: challenge ? challenge.difficulty : '',
            challengeDescription: challenge ? (challenge.description || '') : '',
            challengeStarter: challenge ? (challenge.starter || '') : '',
            challengeSolution: challenge ? (challenge.solution || '') : ''
        };
        
        // Construir historial de la conversación para contexto
        var conversationHistory = chatHistory.slice(-6).map(function(item) {
            return (item.role === 'user' ? 'Usuario: ' : 'Tutor: ') + item.content;
        }).join('\n');

        var body = new URLSearchParams({
            slug: 'lab-chat-' + currentChallenge,
            lesson_title: challenge ? challenge.title : 'Lab',
            lesson_subject: 'Programación - ' + (challenge ? challenge.difficulty : 'General'),
            correctas: '5',
            total: '10',
            question: msg,
            provider: 'auto',
            // Información adicional del contexto
            challenge_context: JSON.stringify(contextInfo),
            conversation_history: conversationHistory
        });

        fetch('ai_tutor.php', {
            method: 'POST',
            credentials: 'same-origin',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            cache: 'no-store',
            body: body
        })
        .then(function(r) { return r.text(); })
        .then(function(raw) {
            removeTypingIndicator();
            input.disabled = false;
            isGenerating = false;
            try {
                var data = JSON.parse(raw);
                if (data.ok && data.ai_text) {
                    addChatMessage('ai', data.ai_text, false);
                } else {
                    addChatMessage('ai', '⚠️ No se pudo obtener respuesta. Por favor intenta de nuevo.', false);
                }
            } catch(e) {
                addChatMessage('ai', '⚠️ Error al procesar la respuesta: ' + e.message, false);
            }
        })
        .catch(function(err) {
            removeTypingIndicator();
            input.disabled = false;
            isGenerating = false;
            addChatMessage('ai', '⚠️ Error de conexión. Verifica tu internet e intenta de nuevo.', false);
        });
    }

    function addChatMessage(role, text, saveToHistory) {
        var container = document.getElementById('chatMessages');
        
        // Remover mensaje de bienvenida si existe
        var welcomeMsg = container.querySelector('.welcome-msg');
        if (welcomeMsg) welcomeMsg.remove();
        
        var div = document.createElement('div');
        div.className = 'chat-msg ' + role;
        
        var time = new Date().toLocaleTimeString('es-ES', { hour: '2-digit', minute: '2-digit' });
        
        if (role === 'ai') {
            var avatar = '<div class="chat-msg-avatar">🤖</div>';
            var content = '<div class="chat-msg-content">' + 
                '<div class="chat-msg-time">' + time + '</div>' +
                '<div class="chat-msg-text">' + renderMd(text) + '</div>' +
                '</div>';
            div.innerHTML = avatar + content;
            
            // Agregar botones de acción para mensajes de IA
            addActionButtons(div, text);
        } else {
            var avatar = '<div class="chat-msg-avatar user">👤</div>';
            var content = '<div class="chat-msg-content">' + 
                '<div class="chat-msg-time">' + time + '</div>' +
                '<div class="chat-msg-text">' + escapeHtml(text) + '</div>' +
                '</div>';
            div.innerHTML = avatar + content;
        }
        
        container.appendChild(div);
        container.scrollTop = container.scrollHeight;
        
        // Guardar en historial
        if (saveToHistory) {
            chatHistory.push({ role: role, content: text, timestamp: Date.now() });
            try {
                sessionStorage.setItem('lc_chat_history_' + currentChallenge, JSON.stringify(chatHistory.slice(-20)));
            } catch(e) {}
        }
        
        // Renderizar matemática si hay
        setTimeout(function() {
            renderMath();
            // Highlight de código
            container.querySelectorAll('pre code').forEach(function(block) {
                hljs.highlightElement(block);
            });
        }, 100);
        
        // Asegurar que el panel esté visible
        document.getElementById('chatPanel').classList.add('visible');
        chatOpen = true;
    }
    
    function addActionButtons(msgDiv, text) {
        var actions = document.createElement('div');
        actions.className = 'chat-msg-actions';
        
        // Botón copiar
        var copyBtn = document.createElement('button');
        copyBtn.className = 'chat-action-btn';
        copyBtn.innerHTML = '📋 Copiar';
        copyBtn.onclick = function() {
            var textToCopy = text.replace(/```[\s\S]*?```/g, function(m) {
                return m.replace(/```\w*\n?/g, '').trim();
            });
            navigator.clipboard.writeText(textToCopy).then(function() {
                copyBtn.innerHTML = '✓ Copiado';
                setTimeout(function() { copyBtn.innerHTML = '📋 Copiar'; }, 2000);
            });
        };
        
        // Botón regenerar
        var regenBtn = document.createElement('button');
        regenBtn.className = 'chat-action-btn';
        regenBtn.innerHTML = '🔄 Regenerar';
        regenBtn.onclick = function() {
            if (chatHistory.length > 1) {
                var lastUserMsg = chatHistory[chatHistory.length - 2];
                chatHistory = chatHistory.slice(0, -2);
                var container = document.getElementById('chatMessages');
                container.innerHTML = '';
                sendChatMessage.call({ previousMessage: lastUserMsg.content });
            }
        };
        
        // Botón compartir
        var shareBtn = document.createElement('button');
        shareBtn.className = 'chat-action-btn';
        shareBtn.innerHTML = '📤 Compartir';
        shareBtn.onclick = function() {
            if (navigator.share) {
                navigator.share({ text: text, title: 'Conversación con LC-Tutor' });
            }
        };
        
        actions.appendChild(copyBtn);
        actions.appendChild(regenBtn);
        actions.appendChild(shareBtn);
        msgDiv.appendChild(actions);
    }
    
    function showTypingIndicator() {
        var container = document.getElementById('chatMessages');
        var indicator = document.createElement('div');
        indicator.className = 'chat-typing-indicator';
        indicator.id = 'typingIndicator';
        indicator.innerHTML = '<div class="typing-dot"></div><div class="typing-dot"></div><div class="typing-dot"></div>';
        container.appendChild(indicator);
        container.scrollTop = container.scrollHeight;
    }
    
    function removeTypingIndicator() {
        var indicator = document.getElementById('typingIndicator');
        if (indicator) indicator.remove();
    }
    
    function escapeHtml(text) {
        var div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }
    
    // Función para limpiar el chat
    function clearChatHistory() {
        chatHistory = [];
        try {
            sessionStorage.removeItem('lc_chat_history_' + currentChallenge);
        } catch(e) {}
        var container = document.getElementById('chatMessages');
        container.innerHTML = '';
        addChatMessage('ai', getInitialContextMessage(), false);
    }

    // ─── BOTTOM CONSOLE ────────────────────────────
    var consoleTabs = {};
    var consoleCollapsed = false;

    function switchConsoleTab(tab) {
        document.querySelectorAll('.console-tab').forEach(function(t) {
            t.classList.toggle('active', t.getAttribute('data-console') === tab);
        });
        document.querySelectorAll('.console-body').forEach(function(b) {
            b.classList.toggle('active', b.id === 'console' + tab.charAt(0).toUpperCase() + tab.slice(1));
        });
        if (consoleCollapsed) toggleConsoleCollapse();
    }

    function logToConsole(msg, type) {
        type = type || 'info';
        var out = document.getElementById('consoleOutput');
        if (!out) return;
        var time = new Date().toLocaleTimeString();
        var cls = type === 'ok' ? 'log-ok' : type === 'err' ? 'log-err' : 'log-info';
        var entry = document.createElement('div');
        entry.className = 'log-entry';
        entry.innerHTML = '<span class="log-time">[' + time + ']</span><span class="' + cls + '">' + escHtml(String(msg)) + '</span>';
        out.appendChild(entry);
        out.scrollTop = out.scrollHeight;
        // Remove welcome message on first log
        var welcome = out.querySelector('.log-entry:first-child');
        if (welcome && msg) welcome.style.display = 'none';
    }

    function clearConsole() {
        document.getElementById('consoleOutput').innerHTML = '';
        logToConsole('Consola limpiada.', 'info');
    }

    function toggleConsoleCollapse() {
        consoleCollapsed = !consoleCollapsed;
        document.getElementById('consolePanel').classList.toggle('collapsed', consoleCollapsed);
        document.getElementById('consoleCollapseBtn').textContent = consoleCollapsed ? '□' : '─';
        document.getElementById('consoleCollapseBtn').title = consoleCollapsed ? 'Expandir' : 'Colapsar';
    }

    // ─── CONSOLE RESIZE ────────────────────────────
    (function() {
        var handle = document.getElementById('consoleResizeHandle');
        var panel = document.getElementById('consolePanel');
        var isResizing = false;
        var startY, startHeight;

        function onMouseMove(e) {
            if (!isResizing) return;
            var newHeight = startHeight - (e.clientY - startY);
            if (newHeight < 60) newHeight = 60;
            var maxH = window.innerHeight * 0.7;
            if (newHeight > maxH) newHeight = maxH;
            panel.style.height = newHeight + 'px';
            panel.classList.remove('collapsed');
        }

        function onMouseUp() {
            if (isResizing) {
                isResizing = false;
                document.body.style.cursor = '';
                document.body.style.userSelect = '';
                handle.classList.remove('active');
                document.removeEventListener('mousemove', onMouseMove);
                document.removeEventListener('mouseup', onMouseUp);
            }
        }

        handle.addEventListener('mousedown', function(e) {
            isResizing = true;
            startY = e.clientY;
            startHeight = panel.offsetHeight;
            document.body.style.cursor = 'ns-resize';
            document.body.style.userSelect = 'none';
            handle.classList.add('active');
            document.addEventListener('mousemove', onMouseMove);
            document.addEventListener('mouseup', onMouseUp);
            e.preventDefault();
        });
    })();

</script>
</body>
</html>