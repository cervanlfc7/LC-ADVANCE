<?php
// ==========================================
// LC-ADVANCE - sistemC.php (Rediseño Premium v2)
// ==========================================
require_once __DIR__ . '/../../src/Config/config.php';
iniciarSesionSegura();
requireLogin(true);

$idPersonaje = $_GET['personaje'] ?? '1Cu';
$idDialogo = intval($_GET['dialogo'] ?? 1);
$indicePregunta = intval($_GET['pregunta'] ?? 0);
$returnUrl = $_GET['return_url'] ?? '../dashboard.php';
$slugExamen = $_GET['slug'] ?? 'examen_' . $idPersonaje;

try {
    $stmt = $pdo->prepare("SELECT DialogoC, TipodialogoC FROM dilogoscombate WHERE IDPersonajeC = ? AND IDDialogoC = ?");
    $stmt->execute([$idPersonaje, $idDialogo]);
    $row = $stmt->fetch();
    $texto = "...";
    $tipoDialogo = "Pregunta";
    if ($row) {
        $texto = strtoupper($row["DialogoC"]);
        $tipoDialogo = $row["TipodialogoC"];
    }

    $stmt = $pdo->prepare("SELECT IDDialogoC, DialogoC, TipodialogoC FROM dilogoscombate WHERE IDPersonajeC = ? ORDER BY CAST(IDDialogoC AS UNSIGNED) ASC");
    $stmt->execute([$idPersonaje]);
    $dialogos = [];
    while ($r = $stmt->fetch()) {
        $dialogos[] = [
            "id" => intval($r["IDDialogoC"]),
            "texto" => strtoupper($r["DialogoC"]),
            "tipo" => $r["TipodialogoC"]
        ];
    }

    $stmt = $pdo->prepare("SELECT PersonajeC FROM idsmaestros WHERE IDPersonajeC = ?");
    $stmt->execute([$idPersonaje]);
    $r = $stmt->fetch();
    $nombreMaestro = "MAESTRO DESCONOCIDO";
    if ($r) {
        $nombreMaestro = "MAESTRO " . strtoupper($r["PersonajeC"]);
    }

    $stmt = $pdo->prepare("SELECT * FROM preguntas WHERE IDPersonajeC = ? ORDER BY IDPregunta ASC");
    $stmt->execute([$idPersonaje]);
    $preguntas = [];
    while ($r = $stmt->fetch()) {
        $preguntas[] = [
            "id" => intval($r["IDPregunta"]),
            "Pregunta" => strtoupper($r["Pregunta"]),
            "Opcion1" => strtoupper($r["Opcion1"]),
            "Opcion2" => strtoupper($r["Opcion2"]),
            "Opcion3" => strtoupper($r["Opcion3"]),
            "RespuestaCorrecta" => intval($r["RespuestaCorrecta"]),
            "TipoPreguntaC" => $r["TipoPreguntaC"]
        ];
    }

    $imagenFisica = __DIR__ . '/' . $idPersonaje . '.png';
    if (!file_exists($imagenFisica)) {
        $imagenFisica = __DIR__ . '/1Cu.png';
    }
    $imgProfesor = basename($imagenFisica);
    $imgProfesorUrl = './' . $imgProfesor;

} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SISTEMA DE COMBATE | LC-ADVANCE</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@700;800&family=JetBrains+Mono:wght@400;500;700&family=Space+Grotesk:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/dashboard.css">
    <style>
        /* ── VARIABLES COMBAT ── */
        :root {
            --cyan: #00e5ff;
            --pink: #ff3cac;
            --green: #00ff87;
            --yellow: #ffd23f;
            --bg: #060a12;
            --surface: #0c1220;
            --surface2: #101828;
            --border: rgba(0, 230, 255, 0.12);
            --border2: rgba(0, 230, 255, 0.22);
            --muted: rgba(200, 230, 255, 0.45);
            --font-display: "Syne", sans-serif;
            --font-mono: "JetBrains Mono", monospace;
            --font-body: "Space Grotesk", sans-serif;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        html, body {
            min-height: 100svh;
            min-height: 100dvh;
            min-height: 100vh;
            max-height: 100dvh;
            margin: 0;
            background: var(--bg);
            color: #e8f4ff;
            font-family: var(--font-body);
            overflow: hidden;
            touch-action: manipulation;
        }

        /* ── GRID BG ── */
        .grid-bg {
            position: fixed;
            inset: 0;
            pointer-events: none;
            z-index: 0;
            background-image:
                linear-gradient(rgba(0, 229, 255, 0.025) 1px, transparent 1px),
                linear-gradient(90deg, rgba(0, 229, 255, 0.018) 1px, transparent 1px);
            background-size: 48px 48px;
            animation: gridScroll 30s linear infinite;
        }
        @keyframes gridScroll { to { background-position: 0 48px; } }

        /* ── WRAPPER FULLSCREEN ── */
        .combat-screen {
            position: relative;
            z-index: 1;
            width: 100vw;
            height: 100dvh;
            min-height: calc(100svh - env(safe-area-inset-top) - env(safe-area-inset-bottom));
            max-height: 100dvh;
            display: grid;
            grid-template-columns: 1fr 420px;
            grid-template-rows: 64px 1fr;
            overflow: hidden;
        }

        /* ── TOP BAR ── */
        .top-bar {
            grid-column: 1 / -1;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 28px;
            background: rgba(6, 10, 18, 0.92);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--border2);
            gap: 20px;
        }

        .top-bar-left {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .maestro-badge {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .maestro-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--cyan);
            box-shadow: 0 0 8px var(--cyan);
            animation: dotPulse 2s ease-in-out infinite;
        }
        @keyframes dotPulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.3; }
        }

        .maestro-name {
            font-family: var(--font-display);
            font-size: 15px;
            font-weight: 800;
            color: var(--cyan);
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .mode-tag {
            font-family: var(--font-mono);
            font-size: 9px;
            padding: 3px 10px;
            border-radius: 999px;
            border: 1px solid rgba(0, 229, 255, 0.2);
            color: var(--muted);
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        /* ── HEALTH / SCORE AREA ── */
        .score-section {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .score-label {
            font-family: var(--font-mono);
            font-size: 9px;
            color: var(--muted);
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .hearts-container {
            display: flex;
            gap: 5px;
            align-items: center;
        }

        .heart {
            width: 18px;
            height: 18px;
            transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        .heart svg {
            width: 100%;
            height: 100%;
        }

        .heart.full svg path { fill: #ff3c6e; filter: drop-shadow(0 0 4px rgba(255,60,110,0.7)); }
        .heart.lost { transform: scale(0.5); opacity: 0; }
        .heart.lost svg path { fill: #2a2a3a; }

        .score-value {
            font-family: var(--font-mono);
            font-size: 13px;
            font-weight: 700;
            color: #ff3c6e;
            min-width: 40px;
            text-align: right;
        }

        /* ── PROGRESS BAR (top) ── */
        .progress-strip {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0 12px;
        }

        .progress-track {
            flex: 1;
            height: 3px;
            background: rgba(255,255,255,0.07);
            border-radius: 999px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, var(--cyan), #29a2ff);
            transition: width 0.4s ease;
            box-shadow: 0 0 8px rgba(0,229,255,0.5);
        }

        .progress-text {
            font-family: var(--font-mono);
            font-size: 9px;
            color: var(--muted);
            white-space: nowrap;
        }

        /* ── CHARACTER PANEL (left) ── */
        .character-panel {
            position: relative;
            display: flex;
            align-items: flex-end;
            justify-content: center;
            overflow: hidden;
            background: linear-gradient(180deg, transparent 0%, rgba(0, 229, 255, 0.02) 100%);
        }

        .char-ambient {
            position: absolute;
            bottom: -60px;
            left: 50%;
            transform: translateX(-50%);
            width: 340px;
            height: 340px;
            border-radius: 50%;
            background: radial-gradient(ellipse, rgba(0,229,255,0.12) 0%, transparent 70%);
            pointer-events: none;
            animation: ambientPulse 4s ease-in-out infinite;
        }
        @keyframes ambientPulse {
            0%, 100% { opacity: 0.5; transform: translateX(-50%) scale(1); }
            50% { opacity: 1; transform: translateX(-50%) scale(1.08); }
        }

        .char-scanlines {
            position: absolute;
            inset: 0;
            pointer-events: none;
            background: repeating-linear-gradient(
                0deg,
                transparent,
                transparent 2px,
                rgba(0, 0, 0, 0.03) 2px,
                rgba(0, 0, 0, 0.03) 4px
            );
            z-index: 1;
        }

        .character-img {
            position: relative;
            z-index: 2;
            height: clamp(300px, 72%, 580px);
            width: auto;
            object-fit: contain;
            image-rendering: pixelated;
            filter: drop-shadow(0 0 20px rgba(0,229,255,0.3)) drop-shadow(0 30px 30px rgba(0,0,0,0.8));
            transition: filter 0.3s ease, transform 0.3s ease;
            margin-bottom: -2px;
        }

        .character-img:hover {
            filter: drop-shadow(0 0 35px rgba(0,229,255,0.5)) drop-shadow(0 30px 30px rgba(0,0,0,0.8));
            transform: translateY(-6px);
        }

        /* Palomita */
        .palomita {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) scale(0);
            font-size: 80px;
            z-index: 10;
            pointer-events: none;
            display: none;
            animation: popCheck 0.9s ease-out forwards;
        }
        @keyframes popCheck {
            0%   { transform: translate(-50%, -50%) scale(0) rotate(-15deg); opacity: 0; }
            50%  { transform: translate(-50%, -50%) scale(1.2) rotate(5deg); opacity: 1; }
            100% { transform: translate(-50%, -50%) scale(1) rotate(0deg); opacity: 0; }
        }

        /* ── RIGHT PANEL ── */
        .right-panel {
            display: flex;
            flex-direction: column;
            background: rgba(6, 10, 18, 0.75);
            backdrop-filter: blur(24px);
            border-left: 1px solid var(--border2);
            overflow: hidden;
        }

        /* Progress strip dentro del right-panel */
        .rp-progress {
            padding: 12px 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }

        /* ── DIALOG BOX ── */
        .dialog-section {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 24px 22px 18px;
            position: relative;
        }

        /* Decorative corner accent */
        .dialog-section::before {
            content: '';
            position: absolute;
            top: 16px;
            left: 16px;
            width: 24px;
            height: 24px;
            border-top: 2px solid rgba(0, 229, 255, 0.4);
            border-left: 2px solid rgba(0, 229, 255, 0.4);
            border-radius: 2px 0 0 0;
        }
        .dialog-section::after {
            content: '';
            position: absolute;
            bottom: 100px;
            right: 16px;
            width: 24px;
            height: 24px;
            border-bottom: 2px solid rgba(0, 229, 255, 0.15);
            border-right: 2px solid rgba(0, 229, 255, 0.15);
            border-radius: 0 0 2px 0;
        }

        #dialogContent {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .dialog-text {
            font-family: var(--font-mono);
            font-size: 12px;
            line-height: 1.9;
            color: rgba(232, 244, 255, 0.9);
            letter-spacing: 0.3px;
        }

        /* Typing cursor */
        .typing-cursor::after {
            content: '▋';
            animation: blink 1s step-end infinite;
            color: var(--cyan);
            font-size: 10px;
        }
        @keyframes blink { 0%, 100% { opacity: 1; } 50% { opacity: 0; } }

        /* ── QUESTION STYLES ── */
        .question-text {
            font-family: var(--font-display);
            font-size: 14px;
            font-weight: 700;
            color: var(--yellow);
            line-height: 1.5;
            margin-bottom: 18px;
            display: block;
        }

        .options-grid {
            display: flex;
            flex-direction: column;
            gap: 7px;
        }

        .option-btn {
            background: rgba(255,255,255,0.03);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 10px;
            padding: 11px 14px;
            color: rgba(232, 244, 255, 0.85);
            font-family: var(--font-body);
            font-size: 12px;
            text-align: left;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 10px;
            line-height: 1.4;
            position: relative;
            overflow: hidden;
        }

        .option-btn::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(90deg, rgba(0,229,255,0.06), transparent);
            opacity: 0;
            transition: opacity 0.2s ease;
        }

        .option-btn:hover:not(:disabled) {
            border-color: rgba(0,229,255,0.35);
            color: #fff;
            transform: translateX(4px);
        }
        .option-btn:hover:not(:disabled)::before { opacity: 1; }

        .option-key {
            font-family: var(--font-mono);
            font-size: 9px;
            font-weight: 700;
            color: var(--cyan);
            background: rgba(0,229,255,0.1);
            border: 1px solid rgba(0,229,255,0.2);
            border-radius: 5px;
            width: 22px;
            height: 22px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            transition: all 0.2s ease;
        }

        .option-btn:hover:not(:disabled) .option-key {
            background: rgba(0,229,255,0.2);
            border-color: rgba(0,229,255,0.5);
        }

        .option-btn.incorrect {
            background: rgba(255, 60, 60, 0.1);
            border-color: rgba(255, 60, 60, 0.5);
            color: rgba(255,200,200,0.9);
            animation: shakeOption 0.35s ease;
        }
        .option-btn.incorrect .option-key {
            color: #ff6464;
            background: rgba(255,60,60,0.15);
            border-color: rgba(255,60,60,0.4);
        }
        @keyframes shakeOption {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-6px); }
            75% { transform: translateX(6px); }
        }

        /* ── FOOTER CONTROLS ── */
        .combat-footer {
            padding: 14px 20px 18px;
            display: flex;
            gap: 10px;
            border-top: 1px solid rgba(255,255,255,0.05);
            background: rgba(3, 5, 10, 0.4);
        }

        .btn-escape {
            flex: 1;
            padding: 11px 0;
            border-radius: 10px;
            border: 1px solid rgba(255, 60, 110, 0.25);
            background: transparent;
            color: rgba(255, 60, 110, 0.7);
            font-family: var(--font-mono);
            font-size: 9px;
            letter-spacing: 1px;
            text-transform: uppercase;
            cursor: pointer;
            transition: all 0.25s ease;
        }
        .btn-escape:hover {
            border-color: rgba(255,60,110,0.5);
            background: rgba(255,60,110,0.07);
            color: #ff3c6e;
        }

        .btn-next {
            flex: 2;
            padding: 11px 0;
            border-radius: 10px;
            border: none;
            background: var(--cyan);
            color: #040a12;
            font-family: var(--font-mono);
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            cursor: pointer;
            transition: all 0.25s cubic-bezier(0.23, 1, 0.32, 1);
            box-shadow: 0 0 20px rgba(0,229,255,0.2);
        }
        .btn-next:hover:not(:disabled) {
            background: #33eeff;
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(0,229,255,0.35);
        }
        .btn-next:disabled {
            background: rgba(255,255,255,0.07);
            color: rgba(255,255,255,0.2);
            cursor: not-allowed;
            box-shadow: none;
        }

        /* ── FEEDBACK ANIMATIONS ── */
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            20% { transform: translateX(-10px); }
            40% { transform: translateX(10px); }
            60% { transform: translateX(-7px); }
            80% { transform: translateX(7px); }
        }
        .shaking { animation: shake 0.4s ease; }

        /* ── RESULT STATES ── */
        .result-state {
            text-align: center;
            padding: 10px 0;
        }
        .result-icon {
            font-size: 42px;
            margin-bottom: 12px;
            display: block;
        }
        .result-title {
            font-family: var(--font-display);
            font-size: 18px;
            font-weight: 800;
            margin-bottom: 6px;
        }
        .result-sub {
            font-family: var(--font-mono);
            font-size: 10px;
            color: var(--muted);
            letter-spacing: 0.5px;
        }
        .result-title.win { color: var(--green); }
        .result-title.lose { color: #ff3c6e; }

        /* ── MOBILE ── */
        @media (max-width: 1024px) {
            .combat-screen {
                grid-template-columns: 1fr;
                grid-template-rows: 58px 42vw calc(100dvh - 58px - 42vw);
                height: 100dvh;
                min-height: calc(100svh - env(safe-area-inset-top) - env(safe-area-inset-bottom));
                max-height: 100dvh;
                gap: 0;
                overflow: hidden;
            }
            .character-panel {
                height: 42vw;
                min-height: 220px;
            }
            .right-panel {
                border-left: none;
                border-top: 1px solid var(--border2);
                max-height: calc(100dvh - 58px - 42vw);
                min-height: 180px;
                overflow-y: auto;
                -webkit-overflow-scrolling: touch;
            }
            .top-bar {
                padding: 10px 12px;
                gap: 8px;
            }
            .maestro-name { font-size: clamp(1.2rem, 4vw, 1.5rem); }
            .mode-tag { font-size: 0.7rem; }
        }

        @media (max-width: 768px) {
            html, body { overflow: hidden; }
            .combat-screen {
                grid-template-columns: 1fr;
                grid-template-rows: 52px 50vw calc(100dvh - 52px - 50vw);
                height: 100dvh;
                min-height: calc(100svh - env(safe-area-inset-top) - env(safe-area-inset-bottom));
                max-height: 100dvh;
            }
            .top-bar { padding: 8px 10px; }
            .character-panel {
                height: 48vw;
                min-height: 200px;
            }
            .character-img {
                height: 75%;
            }
            .right-panel {
                border-left: none;
                border-top: 1px solid var(--border2);
                max-height: calc(100vh - 52px - 48vw);
                overflow-y: auto;
            }
            .rp-progress { padding: 10px 12px; }
            .dialog-section { padding: 12px; }
            .dialog-text { font-size: 0.88rem; }
            .btn-escape, .btn-next {
                font-size: 0.78rem;
                padding: 10px 8px;
                min-width: 0;
            }
            .combat-footer {
                gap: 8px;
                padding: 10px;
            }
            .score-section {
                gap: 8px;
            }
            .score-label { display: none; }
            .heart { width: 14px; height: 14px; }
            .score-value { font-size: 0.85rem; }
        }

        @media (max-width: 500px), (orientation: portrait) {
            html, body { font-size: 13px; overflow: hidden; }
            .combat-screen {
                grid-template-columns: 1fr;
                grid-template-rows: 52px 50vw calc(100dvh - 52px - 50vw);
                height: 100dvh;
                min-height: calc(100svh - env(safe-area-inset-top) - env(safe-area-inset-bottom));
                max-height: 100dvh;
            }
            .top-bar {
                justify-content: space-between;
                padding: 7px 10px;
                gap: 6px;
            }
            .maestro-name { font-size: 0.95rem; }
            .mode-tag { font-size: 0.65rem; }
            .score-value { font-size: 0.8rem; }
            .character-panel {
                height: 50vw;
                min-height: 180px;
            }
            .character-img {
                height: 70%;
            }
            .right-panel {
                border-top: 1px solid var(--border2);
                max-height: calc(100vh - 52px - 50vw);
                overflow-y: auto;
            }
            .rp-progress { padding: 8px 10px; }
            .dialog-section { padding: 10px; }
            .dialog-text { font-size: 0.82rem; }
            .progress-track { height: 5px; }
            .heart { width: 10px; height: 10px; }
            .btn-escape, .btn-next { flex: 1; min-width: 0; font-size: 0.75rem; padding: 8px 8px; }
            .combat-footer { flex-wrap: wrap; gap: 5px; }
            .rp-progress, .dialog-section { min-height: 0; }
        }

        @media (orientation: landscape) and (max-height: 500px), (orientation: landscape) and (max-width: 900px) {
            .combat-screen {
                grid-template-columns: 48% 52%;
                grid-template-rows: 1fr;
                height: 100dvh;
                min-height: calc(100svh - env(safe-area-inset-top) - env(safe-area-inset-bottom));
                max-height: 100dvh;
            }
            .character-panel {
                height: 100%;
                min-height: 0;
            }
            .character-img { height: 78%; }
            .right-panel {
                border-left: 1px solid var(--border2);
                border-top: none;
                padding: 12px;
            }
            .dialog-section { min-height: auto; }
        }
    </style>
</head>
<body>
<div class="grid-bg"></div>

<div class="combat-screen" id="combatUI">

    <!-- TOP BAR -->
    <header class="top-bar">
        <div class="top-bar-left">
            <div class="maestro-badge">
                <div class="maestro-dot"></div>
                <span class="maestro-name"><?= htmlspecialchars($nombreMaestro) ?></span>
            </div>
            <span class="mode-tag">Examen Final</span>
        </div>

        <div class="score-section">
            <span class="score-label">Vidas</span>
            <div class="hearts-container" id="heartsContainer">
                <!-- Hearts rendered by JS -->
            </div>
            <span class="score-value" id="calificacionTexto">10/10</span>
        </div>
    </header>

    <!-- CHARACTER PANEL -->
    <div class="character-panel">
        <div class="char-ambient"></div>
        <div class="char-scanlines"></div>
        <div class="palomita" id="palomita">✓</div>
        <img id="imgCuco"
             src="<?= htmlspecialchars($imgProfesorUrl, ENT_QUOTES) ?>"
             alt="Profesor"
             class="character-img">
    </div>

    <!-- RIGHT PANEL -->
    <div class="right-panel">

        <!-- Progress strip -->
        <div class="rp-progress">
            <span class="progress-text" id="progressText">0 / 0</span>
            <div class="progress-track">
                <div class="progress-fill" id="progressBarFill" style="width:0%"></div>
            </div>
        </div>

        <!-- Dialog / Questions -->
        <div class="dialog-section">
            <div id="dialogContent" class="dialog-text"></div>
        </div>

        <!-- Footer -->
        <footer class="combat-footer">
            <button class="btn-escape" onclick="window.location.href='<?= htmlspecialchars($returnUrl, ENT_QUOTES) ?>'">
                ← Huir
            </button>
            <button class="btn-next" id="btnSiguiente" disabled>
                Siguiente →
            </button>
        </footer>

    </div><!-- /right-panel -->

</div><!-- /combat-screen -->

<script>
const preguntas    = <?= json_encode($preguntas) ?>;
const dialogos     = <?= json_encode($dialogos) ?>;
const personaje    = "<?= $idPersonaje ?>";
let dialogoActual  = <?= $idDialogo ?>;
let preguntaActual = <?= $indicePregunta ?>;

const dialogContent   = document.getElementById("dialogContent");
const btnSiguiente    = document.getElementById("btnSiguiente");
const califTexto      = document.getElementById("calificacionTexto");
const progressText    = document.getElementById("progressText");
const progressBarFill = document.getElementById("progressBarFill");
const combatUI        = document.getElementById("combatUI");
const heartsContainer = document.getElementById("heartsContainer");

let vidaActual   = 10;
const MAX_VIDAS  = 10;

/* ── HEARTS ── */
function renderHearts() {
    heartsContainer.innerHTML = "";
    for (let i = 0; i < MAX_VIDAS; i++) {
        const div = document.createElement("div");
        div.className = "heart " + (i < vidaActual ? "full" : "lost");
        div.innerHTML = `<svg viewBox="0 0 24 22" xmlns="http://www.w3.org/2000/svg">
            <path d="M12 21.6C12 21.6 1 14.4 1 7.2C1 3.76 3.79 1 7.2 1C9.16 1 10.9 1.96 12 3.44C13.1 1.96 14.84 1 16.8 1C20.21 1 23 3.76 23 7.2C23 14.4 12 21.6 12 21.6Z"/>
        </svg>`;
        heartsContainer.appendChild(div);
    }
}
renderHearts();

/* ── PROGRESS ── */
function actualizarProgreso() {
    const respondidas = Math.min(preguntaActual, preguntas.length);
    const ratio = preguntas.length > 0 ? (respondidas / preguntas.length) : 0;
    const avance = Math.round(ratio * 100);
    progressText.textContent = `${respondidas} / ${preguntas.length}`;
    progressBarFill.style.width = `${avance}%`;
}

/* ── KEYBOARD SHORTCUTS ── */
document.addEventListener('keydown', (ev) => {
    if (ev.key === 'Enter' && !btnSiguiente.disabled) btnSiguiente.click();
});

/* ── REDUCIR VIDA ── */
function reducirVida() {
    vidaActual = Math.max(0, vidaActual - 1);
    califTexto.textContent = `${vidaActual}/10`;

    // Animate lost heart
    const hearts = heartsContainer.querySelectorAll('.heart');
    if (hearts[vidaActual]) {
        hearts[vidaActual].classList.remove('full');
        hearts[vidaActual].classList.add('lost');
    }

    combatUI.classList.add("shaking");
    document.body.style.background = "rgba(255,20,20,0.06)";
    setTimeout(() => {
        combatUI.classList.remove("shaking");
        document.body.style.background = "";
    }, 420);

    if (vidaActual <= 4) {
        dialogContent.innerHTML = `
            <div class="result-state">
                <span class="result-icon">💀</span>
                <p class="result-title lose">Reprobaste</p>
                <p class="result-sub" style="margin-top:8px;">Calificación final: <strong style="color:#ff3c6e;">${vidaActual}/10</strong></p>
                <p class="result-sub" style="margin-top:4px;">Inténtalo de nuevo</p>
            </div>`;
        btnSiguiente.textContent  = "Volver →";
        btnSiguiente.disabled     = false;
        btnSiguiente.onclick      = () => window.location.href = '<?= $returnUrl ?>';
        registrarResultado(vidaActual);
    }
}

/* ── REGISTRAR RESULTADO ── */
async function registrarResultado(score) {
    const isGuest = <?= !empty($_SESSION['usuario_es_invitado']) ? 'true' : 'false' ?>;
    if (isGuest) return;
    const fd = new FormData();
    fd.append('accion', 'calificar_examen_final');
    fd.append('slug', '<?= $slugExamen ?>');
    fd.append('score', score);
    try {
        const r = await fetch('../src/Core/funciones.php', { method: 'POST', body: fd });
        return await r.json();
    } catch(e) { console.error("Error al registrar:", e); }
}

/* ── MOSTRAR DIALOGO ── */
function mostrarDialogo(texto, tipo) {
    let i = 0;
    dialogContent.innerHTML = `<p class="dialog-text typing-cursor" id="typingEl"></p>`;
    const el = document.getElementById("typingEl");
    btnSiguiente.disabled = true;
    btnSiguiente.onclick  = null;

    const intervalo = setInterval(() => {
        el.textContent += texto.charAt(i);
        i++;
        if (i >= texto.length) {
            clearInterval(intervalo);
            el.classList.remove("typing-cursor");
            btnSiguiente.disabled = false;

            if (tipo === "Pregunta") {
                btnSiguiente.onclick = () => mostrarPregunta(preguntaActual);
            } else {
                btnSiguiente.onclick = () => {
                    dialogoActual++;
                    avanzarDialogo();
                };
            }
        }
    }, 22);
}

/* ── MOSTRAR PREGUNTA ── */
function mostrarPregunta(index) {
    const actual = preguntas[index];
    if (!actual) {
        dialogoActual++;
        avanzarDialogo();
        return;
    }

    dialogContent.innerHTML = `
        <span class="question-text">${actual.Pregunta}</span>
        <div class="options-grid">
            <button class="option-btn" onclick="verificarRespuesta(1,${actual.RespuestaCorrecta}, this)">
                <span class="option-key">A</span>${actual.Opcion1}
            </button>
            <button class="option-btn" onclick="verificarRespuesta(2,${actual.RespuestaCorrecta}, this)">
                <span class="option-key">B</span>${actual.Opcion2}
            </button>
            <button class="option-btn" onclick="verificarRespuesta(3,${actual.RespuestaCorrecta}, this)">
                <span class="option-key">C</span>${actual.Opcion3}
            </button>
        </div>`;
    btnSiguiente.disabled = true;
    actualizarProgreso();
}

/* ── VERIFICAR RESPUESTA ── */
window.verificarRespuesta = function(seleccion, correcta, boton) {
    // Disable all options immediately
    const allBtns = document.querySelectorAll('.option-btn');
    allBtns.forEach(b => b.disabled = true);

    if (seleccion === correcta) {
        const palomita = document.getElementById("palomita");
        palomita.style.display = "block";
        boton.style.background = "rgba(0,255,135,0.15)";
        boton.style.borderColor = "rgba(0,255,135,0.5)";
        boton.querySelector('.option-key').style.color = "var(--green)";

        setTimeout(() => {
            palomita.style.display = "none";
            preguntaActual++;
            const actual = preguntas[preguntaActual - 1];
            if (actual && actual.TipoPreguntaC === "Dialogo") {
                dialogoActual++;
                avanzarDialogo();
            } else {
                mostrarPregunta(preguntaActual);
            }
        }, 900);
    } else {
        if (boton) {
            boton.classList.add('incorrect');
            setTimeout(() => {
                boton.classList.remove('incorrect');
                allBtns.forEach(b => b.disabled = false);
            }, 600);
        }
        reducirVida();
    }
};

/* ── AVANZAR DIALOGO ── */
function avanzarDialogo() {
    const siguiente = dialogos.find(d => d.id === dialogoActual);
    if (!siguiente) {
        actualizarProgreso();
        dialogContent.innerHTML = `
            <div class="result-state">
                <span class="result-icon">🏆</span>
                <p class="result-title win">¡Combate superado!</p>
                <p class="result-sub" style="margin-top:8px;">Calificación: <strong style="color:var(--green);">${vidaActual}/10</strong></p>
                <p class="result-sub" style="margin-top:4px;">Has demostrado tu valía.</p>
            </div>`;
        btnSiguiente.textContent  = "Finalizar →";
        btnSiguiente.disabled     = false;
        btnSiguiente.onclick      = () => window.location.href = '<?= $returnUrl ?>';
        registrarResultado(vidaActual);
        return;
    }
    mostrarDialogo(siguiente.texto, siguiente.tipo);
}

/* ── INIT ── */
actualizarProgreso();
const primero = dialogos.find(d => d.id === dialogoActual);
if (primero) {
    mostrarDialogo(primero.texto, primero.tipo);
} else {
    dialogContent.textContent = "⚠️ No se encontró el diálogo inicial.";
}
</script>
</body>
</html>