<?php
require_once __DIR__ . '/../src/Config/config.php';
requireLogin(true);

$supported_langs = ['es', 'en'];
if (isset($_GET['lang']) && in_array($_GET['lang'], $supported_langs, true)) $_SESSION['lang'] = $_GET['lang'];
$lang = $_SESSION['lang'] ?? 'es';
if (!in_array($lang, $supported_langs, true)) $lang = 'es';

$t = [
    'es' => [
        'title'          => 'Preguntar al Maestro',
        'placeholder'    => 'Escribe tu pregunta...',
        'send'           => 'Enviar',
        'thinking'       => 'El Maestro está pensando...',
        'clear_history'  => 'Limpiar historial',
        'back_dashboard' => '← Dashboard',
        'greeting'       => '¡Hola! Soy tu Maestro de',
        'greeting_ask'   => 'Pregúntame cualquier cosa sobre la materia.',
        'error_empty'    => 'Escribe una pregunta primero.',
        'confirm_clear'  => '¿Limpiar todo el historial?',
    ],
    'en' => [
        'title'          => 'Ask the Teacher',
        'placeholder'    => 'Write your question...',
        'send'           => 'Send',
        'thinking'       => 'The Teacher is thinking...',
        'clear_history'  => 'Clear history',
        'back_dashboard' => '← Dashboard',
        'greeting'       => 'Hi! I am your Teacher of',
        'greeting_ask'   => 'Ask me anything about the subject.',
        'error_empty'    => 'Write a question first.',
        'confirm_clear'  => 'Clear all history?',
    ],
];

$materia = trim($_GET['materia'] ?? '');
if (empty($materia)) { redirigir(getDashboardUrl()); }

$materia_profesor_map = [
    'Temas Selectos de Matemáticas I y II' => 'Miguel Marquez',
    'Inglés'                               => 'Enrique',
    'Pensamiento Matemático III'           => 'Espindola',
    'Programación'                         => 'Manuel',
    'Física I'                             => 'Herson',
    'Química I'                            => 'Herson',
    'Ecosistemas'                          => 'Carolina',
    'Ciencias Sociales'                    => 'Refugio & Padilla',
    'Historia de México'                   => 'Armando',
];
$materia_imagen_map = [
    'Temas Selectos de Matemáticas I y II' => 'salon_miguel.png',
    'Inglés'                               => 'salon_enrique.png',
    'Pensamiento Matemático III'           => 'salon_espindola.png',
    'Programación'                         => 'salon_manuel.png',
    'Física I'                             => 'salon_herson.png',
    'Química I'                            => 'salon_herson.png',
    'Ecosistemas'                          => 'salon_carolina.png',
    'Ciencias Sociales'                    => 'salon_padilla.png',
    'Historia de México'                   => 'salon_cuco.png',
];

$profesor    = $materia_profesor_map[$materia] ?? 'Maestro';
$imagen      = $materia_imagen_map[$materia]   ?? 'salon_cuco.png';
$imagen_path = 'assets/img/' . $imagen;

$history_key = 'maestro_chat_' . str_replace(' ', '_', $materia);
$history     = $_SESSION[$history_key] ?? [];

/* ── AJAX handlers ── */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json; charset=utf-8');
    $action = $_POST['action'] ?? '';

    if ($action === 'clear') {
        $_SESSION[$history_key] = [];
        echo json_encode(['ok' => true]);
        exit;
    }

    if ($action === 'save') {
        $role    = $_POST['role']    ?? '';
        $content = $_POST['content'] ?? '';
        if (in_array($role, ['user', 'assistant'], true) && !empty($content)) {
            $_SESSION[$history_key][] = ['role' => $role, 'content' => $content, 'timestamp' => time()];
            if (count($_SESSION[$history_key]) > 50)
                $_SESSION[$history_key] = array_slice($_SESSION[$history_key], -50);
        }
        echo json_encode(['ok' => true]);
        exit;
    }

    if ($action === 'ask') {
        $question = trim($_POST['question'] ?? '');
        if (empty($question)) {
            echo json_encode(['ok' => false, 'error' => $t[$lang]['error_empty']]);
            exit;
        }
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
        $host     = $_SERVER['HTTP_HOST'] ?? 'localhost';
        $base_dir = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
        $api_url  = "$protocol://$host$base_dir/ai_tutor.php";

        $post_data = http_build_query([
            'question'      => $question,
            'materia'       => $materia,
            'slug'          => 'consulta_' . str_replace(' ', '_', $materia),
            'lesson_title'  => 'Consulta general - ' . $materia,
            'lesson_subject'=> $materia,
            'provider'      => 'auto',
        ]);

        session_write_close();
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,            $api_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST,           true);
        curl_setopt($ch, CURLOPT_POSTFIELDS,     $post_data);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($ch, CURLOPT_TIMEOUT,        45);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        if (!empty($_SERVER['HTTP_COOKIE']))
            curl_setopt($ch, CURLOPT_COOKIE, $_SERVER['HTTP_COOKIE']);
        $resp       = curl_exec($ch);
        $http_code  = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curl_error = curl_error($ch);
        curl_close($ch);

        if ($curl_error) {
            echo json_encode(['ok' => false, 'error' => "Error de conexión: $curl_error"]);
            exit;
        }
        if ($http_code >= 200 && $http_code < 300 && $resp) {
            $data          = json_decode($resp, true);
            $response_text = $data['ai_text'] ?? $data['advice'] ?? '';
            echo json_encode(['ok' => true, 'response' => $response_text ?: 'El maestro no respondió.']);
        } else {
            echo json_encode(['ok' => false, 'error' => "Error HTTP $http_code"]);
        }
        exit;
    }

    echo json_encode(['ok' => false, 'error' => 'Acción no válida']);
    exit;
}
?>
<!DOCTYPE html>
<html lang="<?= $lang ?>">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<title><?= htmlspecialchars($profesor) ?> | <?= htmlspecialchars($t[$lang]['title']) ?> | LC-ADVANCE</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500;700&family=Syne:wght@700;800&display=swap" rel="stylesheet">
<style>
/* ════════════════════════════════════════════
   TOKENS
════════════════════════════════════════════ */
:root {
    --cyan:           #00e5ff;
    --pink:           #ff3cac;
    --green:          #00ff87;
    --yellow:         #ffd23f;
    --text:           #e8f4ff;
    --text-secondary: rgba(200,230,255,0.75);
    --muted:          rgba(200,230,255,0.5);
    --bg:             #060a12;
    --surface:        rgba(12,18,32,0.92);
    --border:         rgba(0,230,255,0.12);
    --font-display:   "Syne", sans-serif;
    --font-body:      "Space Grotesk", sans-serif;
    --font-mono:      "JetBrains Mono", monospace;
    --header-h:       50px;
    --controls-h:     52px;
    --safe-bottom:    env(safe-area-inset-bottom, 0px);
}

/* ════════════════════════════════════════════
   RESET / BASE
════════════════════════════════════════════ */
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

html, body {
    width: 100%; height: 100%;
    overflow: hidden;
    background: var(--bg);
    color: var(--text);
    font-family: var(--font-body);
    font-size: 14px;
    -webkit-tap-highlight-color: transparent;
}

/* ════════════════════════════════════════════
   HEADER
════════════════════════════════════════════ */
.header {
    position: fixed; top: 0; left: 0; right: 0; z-index: 1000;
    height: var(--header-h);
    display: flex; justify-content: space-between; align-items: center;
    padding: 0 14px;
    background: rgba(6,10,18,0.88);
    backdrop-filter: blur(10px);
    border-bottom: 1px solid var(--border);
    gap: 8px;
}
.header-left {
    display: flex; align-items: center; gap: 8px;
    overflow: hidden; flex: 1; min-width: 0;
}
.logo-text {
    font-family: var(--font-display);
    font-size: 15px; font-weight: 800;
    color: var(--cyan); letter-spacing: -.5px;
    flex-shrink: 0;
}
.logo-tag {
    font-family: var(--font-mono);
    font-size: 8px; color: var(--muted);
    text-transform: uppercase; flex-shrink: 0;
}
.maestro-badge {
    display: flex; align-items: center; gap: 5px;
    font-family: var(--font-mono); font-size: 10px;
    overflow: hidden; min-width: 0;
}
.maestro-badge .name  { color: var(--cyan); white-space: nowrap; }
.maestro-badge .subj  { color: var(--muted); font-size: 9px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }

.header-right {
    display: flex; align-items: center; gap: 8px; flex-shrink: 0;
}
.btn-nav {
    padding: 5px 10px;
    font-family: var(--font-mono); font-size: 9px;
    text-transform: uppercase; text-decoration: none;
    color: var(--text-secondary);
    background: rgba(16,24,40,0.9);
    border: 1px solid var(--border); border-radius: 6px;
    transition: .2s; white-space: nowrap;
}
.btn-nav:hover { color: var(--cyan); border-color: var(--cyan); }

/* Volume */
.header-volume { display: flex; align-items: center; gap: 6px; }
.vol-btn {
    background: rgba(0,229,255,0.1);
    border: 1px solid rgba(0,229,255,0.4);
    border-radius: 6px; padding: 5px 8px;
    cursor: pointer; color: var(--cyan); font-size: 15px;
    transition: .2s; flex-shrink: 0;
}
.vol-btn:hover { background: rgba(0,229,255,0.2); }
.vol-slider {
    display: none;
    background: rgba(6,10,18,0.95);
    border: 1px solid rgba(0,229,255,0.4);
    border-radius: 6px; padding: 7px 10px;
}
.vol-slider.show { display: block; }
.vol-slider input[type=range] {
    width: 90px; cursor: pointer;
    -webkit-appearance: none;
    background: #1a2030; height: 10px;
    border: 1.5px solid var(--cyan); border-radius: 4px;
}
.vol-slider input[type=range]::-webkit-slider-thumb {
    -webkit-appearance: none;
    width: 14px; height: 18px;
    background: var(--pink); border: 2px solid #fff;
    cursor: pointer; border-radius: 3px;
}

/* ════════════════════════════════════════════
   CLASSROOM BG
════════════════════════════════════════════ */
.classroom {
    position: fixed; inset: 0;
    display: flex; align-items: center; justify-content: center;
    background: var(--bg);
}
.classroom img {
    width: 100vw; height: 100vh;
    object-fit: contain;
    image-rendering: pixelated;
    image-rendering: crisp-edges;
}

/* ════════════════════════════════════════════
   CHAT OVERLAY — DESKTOP (drag/resize)
════════════════════════════════════════════ */
.chat-pizarron {
    position: fixed; z-index: 10;
    display: flex; flex-direction: column;
    background: var(--surface);
    backdrop-filter: blur(14px); -webkit-backdrop-filter: blur(14px);
    border: 1px solid var(--border);
    border-radius: 12px;
    box-shadow: 0 6px 40px rgba(0,0,0,.75);
    visibility: hidden;
    overflow: visible;
    /* default desktop size — JS overrides */
    width: min(400px, 85vw);
    height: min(340px, 60vh);
    min-width: 240px; min-height: 220px;
    max-width: 520px; max-height: 600px;
}
.chat-pizarron.visible { visibility: visible; }

/* ── Header bar (drag handle) ── */
.chat-header-bar {
    display: flex; justify-content: space-between; align-items: center;
    padding: 7px 10px;
    border-bottom: 1px solid rgba(0,230,255,0.08);
    background: rgba(6,10,18,0.5);
    flex-shrink: 0;
    cursor: grab; user-select: none;
    border-radius: 12px 12px 0 0;
}
.chat-header-bar:active { cursor: grabbing; }
.chat-header-title {
    font-family: var(--font-mono); font-size: 9px;
    text-transform: uppercase; color: var(--muted);
    overflow: hidden; text-overflow: ellipsis; white-space: nowrap;
}
.chat-header-btn {
    padding: 3px 8px;
    font-family: var(--font-mono); font-size: 8px;
    text-transform: uppercase; color: var(--text-secondary);
    background: transparent;
    border: 1px solid var(--border); border-radius: 4px;
    cursor: pointer; transition: .2s; flex-shrink: 0;
}
.chat-header-btn:hover { color: var(--pink); border-color: var(--pink); }

/* ── Messages ── */
.chat-messages {
    flex: 1; overflow-y: auto;
    padding: 7px 9px;
    display: flex; flex-direction: column; gap: 5px;
    min-height: 0;
}
.chat-messages::-webkit-scrollbar { width: 3px; }
.chat-messages::-webkit-scrollbar-track { background: transparent; }
.chat-messages::-webkit-scrollbar-thumb { background: rgba(0,230,255,.15); border-radius: 2px; }

.msg {
    padding: 7px 10px; border-radius: 7px;
    line-height: 1.45; font-size: 12px;
    max-width: 98%;
    animation: msgIn .18s ease;
    word-wrap: break-word; word-break: break-word;
}
@keyframes msgIn { from { opacity:0; transform:translateY(4px); } to { opacity:1; transform:translateY(0); } }
.msg.user      { align-self:flex-end; background:rgba(0,229,255,.06); border:1px solid rgba(0,230,255,.15); }
.msg.assistant { align-self:flex-start; background:rgba(16,24,40,.85); border:1px solid rgba(0,230,255,.06); }
.msg.assistant strong { color:var(--cyan); }
.msg.assistant code  { font-family:var(--font-mono); background:rgba(6,10,18,.8); padding:1px 4px; border-radius:3px; font-size:10px; }
.msg.assistant pre   { background:rgba(6,10,18,.8); padding:6px; border-radius:4px; overflow-x:auto; margin:4px 0; font-size:10px; }
.msg.assistant pre code { background:none; padding:0; }
.msg.thinking  { align-self:flex-start; color:var(--muted); font-style:italic; background:transparent; border:none; }
.msg.greeting  { align-self:center; text-align:center; background:transparent; border:none; color:var(--muted); padding:12px 6px; }
.msg.greeting strong { color:var(--text-secondary); display:block; font-size:11px; margin-bottom:4px; }

/* ── Input area ── */
.chat-input-area {
    padding: 6px 8px;
    border-top: 1px solid rgba(0,230,255,.08);
    display: flex; gap: 6px;
    background: rgba(6,10,18,.3);
    flex-shrink: 0;
    align-items: flex-end;
    border-radius: 0 0 12px 12px;
}
.chat-input {
    flex: 1;
    padding: 7px 10px;
    font-family: var(--font-body); font-size: 12px;
    color: var(--text);
    background: rgba(16,24,40,.8);
    border: 1px solid var(--border); border-radius: 6px;
    outline: none; resize: none;
    max-height: 80px; min-height: 32px;
    line-height: 1.4;
}
.chat-input:focus { border-color: var(--cyan); }
.chat-input::placeholder { color: var(--muted); }
.btn-send {
    padding: 7px 13px;
    font-family: var(--font-mono); font-size: 9px; font-weight: 600;
    text-transform: uppercase;
    color: #060a12; background: var(--cyan);
    border: none; border-radius: 6px;
    cursor: pointer; transition: .2s; white-space: nowrap;
    align-self: flex-end; flex-shrink: 0;
    min-height: 32px;
}
.btn-send:hover    { background: #33ebff; }
.btn-send:disabled { background: var(--muted); cursor: not-allowed; }

/* ════════════════════════════════════════════
   RESIZE HANDLES (desktop only)
════════════════════════════════════════════ */
.corner-handle,
.edge-handle {
    position: absolute; z-index: 20;
    opacity: 0; visibility: hidden;
    transition: opacity .2s, visibility .2s;
    pointer-events: auto;
    touch-action: none;
}
.chat-pizarron:hover .corner-handle,
.chat-pizarron:hover .edge-handle {
    opacity: 1; visibility: visible;
}

/* Corners */
.corner-handle {
    width: 18px; height: 18px;
    border: 1px solid rgba(0,229,255,.28);
    border-radius: 3px;
    background: rgba(0,229,255,.12);
}
.corner-handle:hover { border-color: var(--cyan); background: rgba(0,229,255,.22); }

.corner-handle.nw { top:-9px;    left:-9px;   cursor:nwse-resize; border-bottom:none; border-right:none; }
.corner-handle.ne { top:-9px;    right:-9px;  cursor:nesw-resize; border-bottom:none; border-left:none;  }
.corner-handle.se { bottom:-9px; right:-9px;  cursor:nwse-resize; border-top:none;    border-left:none;  }
.corner-handle.sw { bottom:-9px; left:-9px;   cursor:nesw-resize; border-top:none;    border-right:none; }

.corner-handle.nw::after { content:''; position:absolute; top:2px;    left:2px;  width:7px; height:7px; border-left:2px solid var(--cyan); border-top:2px solid var(--cyan);    }
.corner-handle.ne::after { content:''; position:absolute; top:2px;    right:2px; width:7px; height:7px; border-right:2px solid var(--cyan); border-top:2px solid var(--cyan);   }
.corner-handle.se::after { content:''; position:absolute; bottom:2px; right:2px; width:7px; height:7px; border-right:2px solid var(--cyan); border-bottom:2px solid var(--cyan);}
.corner-handle.sw::after { content:''; position:absolute; bottom:2px; left:2px;  width:7px; height:7px; border-left:2px solid var(--cyan);  border-bottom:2px solid var(--cyan);}

/* Edges — start at 18px (corner width) to avoid overlap */
.edge-handle { background: rgba(0,229,255,.07); z-index: 19; }
.edge-handle:hover { background: rgba(0,229,255,.18); }

.edge-handle.top    { top:-4px;    left:18px;  right:18px;  height:8px; cursor:n-resize; border-radius:4px 4px 0 0; }
.edge-handle.bottom { bottom:-4px; left:18px;  right:18px;  height:8px; cursor:s-resize; border-radius:0 0 4px 4px; }
.edge-handle.left   { left:-4px;   top:18px;   bottom:18px; width:8px;  cursor:w-resize; border-radius:4px 0 0 4px; }
.edge-handle.right  { right:-4px;  top:18px;   bottom:18px; width:8px;  cursor:e-resize; border-radius:0 4px 4px 0; }

/* Touch: larger handles */
@media (pointer: coarse) {
    .corner-handle { width:26px; height:26px; }
    .corner-handle.nw { top:-13px;    left:-13px;  }
    .corner-handle.ne { top:-13px;    right:-13px; }
    .corner-handle.se { bottom:-13px; right:-13px; }
    .corner-handle.sw { bottom:-13px; left:-13px;  }
    .edge-handle.top,
    .edge-handle.bottom { height:10px; left:26px; right:26px; }
    .edge-handle.left,
    .edge-handle.right  { width:10px;  top:26px; bottom:26px; }
}

/* ════════════════════════════════════════════
   POSITION CONTROLS BAR (desktop)
════════════════════════════════════════════ */
.pos-controls {
    position: fixed; bottom: 10px; left: 50%; transform: translateX(-50%);
    z-index: 100;
    display: flex; gap: 4px; flex-wrap: wrap; justify-content: center;
    background: rgba(6,10,18,.88);
    backdrop-filter: blur(6px);
    padding: 5px 10px; border-radius: 8px;
    border: 1px solid var(--border);
}
.pos-sep {
    font-family: var(--font-mono); font-size: 10px;
    color: var(--muted); margin: 0 2px;
    align-self: center;
}
.pos-btn {
    padding: 4px 9px;
    font-family: var(--font-mono); font-size: 11px;
    color: var(--text-secondary);
    background: rgba(16,24,40,.9);
    border: 1px solid var(--border); border-radius: 4px;
    cursor: pointer; transition: .2s;
    min-width: 28px; text-align: center;
    touch-action: manipulation;
}
.pos-btn:hover  { color:var(--cyan); border-color:var(--cyan); background:rgba(0,229,255,.08); }
.pos-btn:active { background:rgba(0,229,255,.18); }

.salon-credits {
    position: fixed; bottom: 54px; left: 50%; transform: translateX(-50%);
    z-index: 100;
    font-family: var(--font-mono); font-size: 9px;
    color: var(--muted); opacity: .4;
    text-align: center; pointer-events: none;
    white-space: nowrap;
}

/* ════════════════════════════════════════════
   MOBILE OVERRIDES  (≤ 768px)
   Chat ocupa toda la pantalla, sin drag/resize
════════════════════════════════════════════ */
@media (max-width: 768px) {
    :root { --header-h: 46px; }

    /* Header más compacto */
    .logo-tag,
    .maestro-badge .subj { display: none; }
    .btn-nav { padding: 4px 8px; font-size: 8px; }
    .vol-slider input[type=range] { width: 72px; }

    /* Chat: full screen debajo del header */
    .chat-pizarron {
        left: 0    !important;
        right: 0   !important;
        top: var(--header-h) !important;
        bottom: calc(var(--controls-h) + var(--safe-bottom)) !important;
        width: 100% !important;
        height: auto !important;
        max-width: none;
        max-height: none;
        min-width: 0;
        min-height: 0;
        border-radius: 0;
        border-left: none;
        border-right: none;
        border-top: none;
    }
    /* Ocultar drag/resize en móvil */
    .corner-handle,
    .edge-handle { display: none !important; }

    /* Sin cursor grab en móvil */
    .chat-header-bar { cursor: default; }

    /* Mensajes con tipografía más legible */
    .msg { font-size: 13px; padding: 8px 11px; border-radius: 8px; }
    .chat-messages { padding: 10px 12px; gap: 7px; }

    /* Input area más cómoda para tocar */
    .chat-input-area {
        padding: 8px 10px;
        padding-bottom: max(8px, var(--safe-bottom));
        flex-wrap: nowrap; gap: 8px;
    }
    .chat-input {
        font-size: 14px;
        min-height: 40px;
        padding: 9px 12px;
    }
    .btn-send {
        padding: 9px 14px;
        font-size: 10px;
        min-height: 40px;
    }

    /* Controls bar: más pequeña y pegada al fondo */
    .pos-controls {
        bottom: calc(4px + var(--safe-bottom));
        padding: 4px 8px; gap: 3px;
    }
    .pos-btn { font-size: 10px; padding: 3px 7px; min-width: 24px; }
    .salon-credits { display: none; }
}

/* ════════════════════════════════════════════
   PEQUEÑO (≤ 400px)
════════════════════════════════════════════ */
@media (max-width: 400px) {
    .logo-text { font-size: 13px; }
    .maestro-badge .name { font-size: 9px; }
    .header { padding: 0 8px; gap: 5px; }
    .pos-controls { gap: 2px; padding: 3px 5px; }
    .pos-btn { min-width: 22px; padding: 2px 5px; font-size: 9px; }
}
</style>
</head>
<body>

<!-- ══ HEADER ══ -->
<header class="header">
    <div class="header-left">
        <span class="logo-text">LC-ADVANCE</span>
        <span class="logo-tag">// MAESTRO</span>
        <span class="maestro-badge">
            <span class="name"><?= htmlspecialchars($profesor) ?></span>
            <span class="subj">— <?= htmlspecialchars($materia) ?></span>
        </span>
    </div>

    <div class="header-right">
        <div class="header-volume">
            <button class="vol-btn" id="volBtn" onclick="toggleVolumeSlider()">🔊</button>
            <div class="vol-slider" id="volSlider">
                <input type="range" id="volPrincipalSlider" min="0" max="1" step="0.05" value="0.1">
            </div>
        </div>
        <a href="<?= htmlspecialchars(getDashboardUrl()) ?>" class="btn-nav"><?= htmlspecialchars($t[$lang]['back_dashboard']) ?></a>
    </div>
</header>

<!-- ══ CLASSROOM BG ══ -->
<div class="classroom">
    <img src="<?= htmlspecialchars($imagen_path) ?>"
         alt="Salón de <?= htmlspecialchars($profesor) ?>"
         id="salonImg">
</div>

<!-- ══ CHAT ══ -->
<div class="chat-pizarron" id="chatOverlay">

    <!-- Resize handles (visible solo desktop) -->
    <div class="corner-handle nw" data-resize="nw"></div>
    <div class="corner-handle ne" data-resize="ne"></div>
    <div class="corner-handle se" data-resize="se"></div>
    <div class="corner-handle sw" data-resize="sw"></div>
    <div class="edge-handle top"    data-resize="t"></div>
    <div class="edge-handle bottom" data-resize="b"></div>
    <div class="edge-handle left"   data-resize="l"></div>
    <div class="edge-handle right"  data-resize="r"></div>

    <div class="chat-header-bar" id="chatHeaderBar">
        <span class="chat-header-title">📚 <?= htmlspecialchars($materia) ?></span>
        <button class="chat-header-btn" id="clearBtn"><?= htmlspecialchars($t[$lang]['clear_history']) ?></button>
    </div>

    <div class="chat-messages" id="chatMessages">
        <?php if (empty($history)): ?>
            <div class="msg greeting">
                <strong>🎓 <?= htmlspecialchars($t[$lang]['greeting']) ?> <?= htmlspecialchars($materia) ?></strong>
                <?= htmlspecialchars($t[$lang]['greeting_ask']) ?>
            </div>
        <?php else: ?>
            <?php foreach ($history as $h): ?>
                <div class="msg <?= htmlspecialchars($h['role']) ?>"><?= nl2br(htmlspecialchars($h['content'])) ?></div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <div class="chat-input-area">
        <textarea class="chat-input" id="chatInput" rows="1"
                  placeholder="<?= htmlspecialchars($t[$lang]['placeholder']) ?>"></textarea>
        <button class="btn-send" id="sendBtn"><?= htmlspecialchars($t[$lang]['send']) ?></button>
    </div>
</div>

<!-- ══ POSITION CONTROLS ══ -->
<div class="pos-controls" id="posControls">
    <button class="pos-btn" id="posUp">↑</button>
    <button class="pos-btn" id="posDown">↓</button>
    <button class="pos-btn" id="posLeft">←</button>
    <button class="pos-btn" id="posRight">→</button>
    <span class="pos-sep">│</span>
    <button class="pos-btn" id="posPlus">+</button>
    <button class="pos-btn" id="posMinus">−</button>
    <span class="pos-sep">│</span>
    <button class="pos-btn" id="btnCalibrar" style="color:var(--green);border-color:var(--green)">🎯</button>
    <button class="pos-btn" id="posReset"    style="color:var(--pink);border-color:var(--pink)">↺</button>
</div>

<div class="salon-credits"><?= htmlspecialchars($profesor) ?> — <?= htmlspecialchars($materia) ?></div>

<!-- ══ AUDIO ══ -->
<audio id="pageMusic" loop>
    <source src="assets/music/cuco_pantalla_inicio.mp3" type="audio/mpeg">
</audio>

<script>
/* ════════════════════════════════════════════
   UTILS
════════════════════════════════════════════ */
const isMobile = () => window.innerWidth <= 768;

const salonImg  = document.getElementById('salonImg');
const chatEl    = document.getElementById('chatOverlay');
const chatMsgs  = document.getElementById('chatMessages');
const chatInput = document.getElementById('chatInput');
const sendBtn   = document.getElementById('sendBtn');
const clearBtn  = document.getElementById('clearBtn');

/* ════════════════════════════════════════════
   POSICIÓN / TAMAÑO (solo desktop)
════════════════════════════════════════════ */
let absX = parseInt(sessionStorage.getItem('mc_a_x') || '0');
let absY = parseInt(sessionStorage.getItem('mc_a_y') || '0');
let absW = parseInt(sessionStorage.getItem('mc_a_w') || '0');
let absH = parseInt(sessionStorage.getItem('mc_a_h') || '0');

function getActualImageRect(img) {
    const vr = img.getBoundingClientRect();
    const nW = img.naturalWidth, nH = img.naturalHeight;
    if (!nW || !nH) return null;
    const cR = vr.width / vr.height, iR = nW / nH;
    let rw, rh, rx, ry;
    if (cR > iR) { rh = vr.height; rw = vr.height * iR; rx = vr.left + (vr.width - rw) / 2; ry = vr.top; }
    else         { rw = vr.width;  rh = vr.width / iR;  rx = vr.left; ry = vr.top + (vr.height - rh) / 2; }
    return { left: rx, top: ry, width: rw, height: rh };
}

function calcDefaultPos() {
    const vw  = window.innerWidth;
    const vh  = window.innerHeight;
    const hH  = 50, bH = 70;
    const chatW = Math.min(360, Math.max(280, vw * 0.28));
    const chatH = Math.min(vh - hH - bH - 16, Math.max(260, (vh - hH - bH) * 0.6));
    const x = Math.max(12, vw - chatW - 18);
    const y = hH + 14;
    return { x, y, w: chatW, h: chatH };
}

function positionChat() {
    if (!salonImg.complete || salonImg.naturalWidth === 0) {
        salonImg.addEventListener('load', positionChat, { once: true });
        return;
    }
    // En móvil: CSS se encarga totalmente; solo mostramos el chat
    if (isMobile()) {
        chatEl.style.cssText = ''; // limpia estilos inline
        chatEl.classList.add('visible');
        return;
    }
    // Desktop: posición absoluta
    let l, t, w, h;
    if (absX > 0 && absY > 0) {
        l = absX; t = absY;
        w = absW > 0 ? absW : 300;
        h = absH > 0 ? absH : 260;
    } else {
        const def = calcDefaultPos();
        if (!def) return;
        l = def.x; t = def.y;
        w = absW > 0 ? absW : def.w;
        h = absH > 0 ? absH : def.h;
    }
    const hH = 50, bH = 60;
    l = Math.max(8, Math.min(l, window.innerWidth  - w - 8));
    t = Math.max(hH + 8, Math.min(t, window.innerHeight - h - bH));
    chatEl.style.left   = l + 'px';
    chatEl.style.top    = t + 'px';
    chatEl.style.width  = w + 'px';
    chatEl.style.height = h + 'px';
    chatEl.classList.add('visible');
}

function saveAbsState() {
    if (isMobile()) return;
    const s = chatEl.style;
    if (s.left && s.left !== 'auto') { absX = parseInt(s.left); absY = parseInt(s.top); }
    if (s.width && s.width !== 'auto') { absW = parseInt(s.width); absH = parseInt(s.height); }
    sessionStorage.setItem('mc_a_x', absX);
    sessionStorage.setItem('mc_a_y', absY);
    sessionStorage.setItem('mc_a_w', absW);
    sessionStorage.setItem('mc_a_h', absH);
}

/* ── Arrow/size buttons ── */
function moveBy(dx, dy) {
    if (isMobile()) return;
    const l = (parseInt(chatEl.style.left) || absX || 0) + dx;
    const t = (parseInt(chatEl.style.top)  || absY || 0) + dy;
    chatEl.style.left = l + 'px';
    chatEl.style.top  = t + 'px';
    saveAbsState();
}
function scaleSize(factor) {
    if (isMobile()) return;
    const cw = parseInt(chatEl.style.width)  || 300;
    const ch = parseInt(chatEl.style.height) || 260;
    absW = Math.max(200, Math.round(cw * factor));
    absH = Math.max(160, Math.round(ch * factor));
    chatEl.style.width  = absW + 'px';
    chatEl.style.height = absH + 'px';
    saveAbsState();
}
function calibrate()  { if (!isMobile()) { saveAbsState(); positionChat(); } }
function resetAll()   {
    absX = absY = absW = absH = 0;
    ['mc_a_x','mc_a_y','mc_a_w','mc_a_h'].forEach(k => sessionStorage.removeItem(k));
    chatEl.style.cssText = '';
    positionChat();
}

/* ── Init & resize ── */
positionChat();
salonImg.addEventListener('load', positionChat);
window.addEventListener('resize', () => { positionChat(); });

let tries = 0;
const rt = setInterval(() => {
    if (chatEl.classList.contains('visible') || tries > 10) { clearInterval(rt); return; }
    positionChat(); tries++;
}, 300);

/* ── Button bindings ── */
document.getElementById('posUp').onclick    = () => moveBy(0, -8);
document.getElementById('posDown').onclick  = () => moveBy(0,  8);
document.getElementById('posLeft').onclick  = () => moveBy(-8, 0);
document.getElementById('posRight').onclick = () => moveBy(8,  0);
document.getElementById('posPlus').onclick  = () => scaleSize(1.1);
document.getElementById('posMinus').onclick = () => scaleSize(0.9);
document.getElementById('posReset').onclick = resetAll;
document.getElementById('btnCalibrar').onclick = calibrate;

/* ── Keyboard shortcuts (desktop) ── */
document.addEventListener('keydown', e => {
    if (isMobile()) return;
    if (document.activeElement === chatInput || e.ctrlKey || e.metaKey) return;
    const s = e.shiftKey ? 1 : 8;
    switch (e.key) {
        case 'ArrowUp':    e.preventDefault(); moveBy(0, -s);  break;
        case 'ArrowDown':  e.preventDefault(); moveBy(0,  s);  break;
        case 'ArrowLeft':  e.preventDefault(); moveBy(-s, 0);  break;
        case 'ArrowRight': e.preventDefault(); moveBy(s,  0);  break;
        case '+': case '=': e.preventDefault(); scaleSize(1.1); break;
        case '-':           e.preventDefault(); scaleSize(0.9); break;
        case 'r': case 'R': e.preventDefault(); resetAll();     break;
    }
});

/* ════════════════════════════════════════════
   DRAG (header) — solo desktop
════════════════════════════════════════════ */
let drag = false, dSX, dSY;
const hdr = document.getElementById('chatHeaderBar');

function startDrag(x, y) {
    if (isMobile()) return;
    drag = true; dSX = x; dSY = y;
    chatEl.style.cursor = 'grabbing';
}
function moveDrag(x, y) {
    if (!drag) return;
    const dx = x - dSX, dy = y - dSY;
    const l = (parseInt(chatEl.style.left) || absX || 0) + dx;
    const t = (parseInt(chatEl.style.top)  || absY || 0) + dy;
    chatEl.style.left = l + 'px';
    chatEl.style.top  = t + 'px';
    dSX = x; dSY = y;
}
function endDrag() {
    if (!drag) return;
    drag = false; chatEl.style.cursor = '';
    saveAbsState();
}

hdr.addEventListener('mousedown', e => { if (e.target.tagName === 'BUTTON') return; e.preventDefault(); startDrag(e.clientX, e.clientY); });
hdr.addEventListener('touchstart', e => {
    if (isMobile() || e.target.tagName === 'BUTTON') return;
    const t = e.touches[0]; startDrag(t.clientX, t.clientY);
}, { passive: true });

/* ════════════════════════════════════════════
   RESIZE (corners + edges) — solo desktop
════════════════════════════════════════════ */
let resize = false, rDir, rSX, rSY, rSW, rSH, rSLeft, rSTop, rAF = null;
const MIN_W = 200, MIN_H = 150;

function startResize(dir, x, y, e) {
    if (isMobile()) return;
    e.preventDefault(); e.stopPropagation();
    if (drag) endDrag();
    resize = true; rDir = dir; rSX = x; rSY = y;
    const r = chatEl.getBoundingClientRect();
    rSW = r.width; rSH = r.height; rSLeft = r.left; rSTop = r.top;
    document.body.style.cursor     = getCursor(dir);
    document.body.style.userSelect = 'none';
}
function getCursor(d) {
    return { t:'n-resize', b:'s-resize', l:'w-resize', r:'e-resize',
             nw:'nwse-resize', se:'nwse-resize', ne:'nesw-resize', sw:'nesw-resize' }[d] || 'default';
}
function doResize(cx, cy) {
    if (!resize) return;
    if (rAF) cancelAnimationFrame(rAF);
    rAF = requestAnimationFrame(() => {
        const dx = cx - rSX, dy = cy - rSY;
        let left = rSLeft, top = rSTop, width = rSW, height = rSH;
        // Horizontal
        if      (rDir==='r'||rDir==='se'||rDir==='ne') { width = Math.max(MIN_W, rSW + dx); }
        else if (rDir==='l'||rDir==='sw'||rDir==='nw') { const nw = Math.max(MIN_W, rSW - dx); left = rSLeft + rSW - nw; width = nw; }
        // Vertical
        if      (rDir==='b'||rDir==='se'||rDir==='sw') { height = Math.max(MIN_H, rSH + dy); }
        else if (rDir==='t'||rDir==='ne'||rDir==='nw') { const nh = Math.max(MIN_H, rSH - dy); top = rSTop + rSH - nh; height = nh; }
        chatEl.style.left   = left   + 'px';
        chatEl.style.top    = top    + 'px';
        chatEl.style.width  = width  + 'px';
        chatEl.style.height = height + 'px';
    });
}
function endResize() {
    if (!resize) return;
    resize = false;
    if (rAF) { cancelAnimationFrame(rAF); rAF = null; }
    document.body.style.cursor     = '';
    document.body.style.userSelect = '';
    saveAbsState();
}

document.querySelectorAll('[data-resize]').forEach(h => {
    const dir = h.dataset.resize;
    h.addEventListener('mousedown', e => startResize(dir, e.clientX, e.clientY, e));
    h.addEventListener('touchstart', e => {
        const t = e.touches[0]; startResize(dir, t.clientX, t.clientY, e);
    }, { passive: false });
});

/* ── Global move/up ── */
function onGlobalMove(cx, cy) {
    if (resize) doResize(cx, cy);
    else if (drag) moveDrag(cx, cy);
}
document.addEventListener('mousemove', e => onGlobalMove(e.clientX, e.clientY));
document.addEventListener('touchmove', e => {
    if (!resize && !drag) return;
    e.preventDefault();
    const t = e.touches[0]; onGlobalMove(t.clientX, t.clientY);
}, { passive: false });
document.addEventListener('mouseup',  () => { endResize(); endDrag(); });
document.addEventListener('touchend', () => { endResize(); endDrag(); });

/* ════════════════════════════════════════════
   CHAT MESSAGES
════════════════════════════════════════════ */
function scrollToBottom() { chatMsgs.scrollTop = chatMsgs.scrollHeight; }

function addMsg(role, content) {
    const g = chatMsgs.querySelector('.msg.greeting');
    if (g) g.remove();
    const d = document.createElement('div');
    d.className = 'msg ' + role;
    d.innerHTML = content.replace(/\n/g, '<br>');
    chatMsgs.appendChild(d);
    scrollToBottom();
}
function addThinking() {
    const d = document.createElement('div');
    d.className = 'msg thinking'; d.id = 'thinkingMsg';
    d.textContent = '🤔 <?= htmlspecialchars($t[$lang]['thinking']) ?>';
    chatMsgs.appendChild(d); scrollToBottom();
}
function rmThink() { const e = document.getElementById('thinkingMsg'); if (e) e.remove(); }

async function saveMsg(role, content) {
    const fd = new FormData();
    fd.append('action', 'save'); fd.append('role', role); fd.append('content', content);
    try { await fetch(window.location.href, { method: 'POST', body: fd }); } catch(e) {}
}

async function sendMessage() {
    const q = chatInput.value.trim(); if (!q) return;
    chatInput.value = ''; chatInput.style.height = 'auto';
    addMsg('user', q); saveMsg('user', q);
    sendBtn.disabled = true; chatInput.disabled = true; addThinking();
    const fd = new FormData();
    fd.append('action', 'ask'); fd.append('question', q);
    try {
        const r = await fetch(window.location.href, { method: 'POST', body: fd });
        const d = await r.json(); rmThink();
        const a = d.ok && d.response ? d.response : (d.error || 'El maestro no respondió.');
        addMsg('assistant', a); saveMsg('assistant', a);
    } catch(e) { rmThink(); addMsg('assistant', 'Error de conexión. Intenta de nuevo.'); }
    sendBtn.disabled = false; chatInput.disabled = false; chatInput.focus();
}

sendBtn.onclick = sendMessage;
chatInput.addEventListener('keydown', e => {
    if (e.key === 'Enter' && !e.shiftKey) { e.preventDefault(); sendMessage(); }
});
chatInput.addEventListener('input', () => {
    chatInput.style.height = 'auto';
    chatInput.style.height = Math.min(chatInput.scrollHeight, 80) + 'px';
});

clearBtn.onclick = async () => {
    if (!confirm('<?= htmlspecialchars($t[$lang]['confirm_clear']) ?>')) return;
    const fd = new FormData(); fd.append('action', 'clear');
    try { await fetch(window.location.href, { method: 'POST', body: fd }); } catch(e) {}
    location.reload();
};

scrollToBottom();

/* ════════════════════════════════════════════
   AUDIO / VOLUME (centralizado)
════════════════════════════════════════════ */
const STORAGE_KEY = 'lc_volume_settings';
function getStoredVolumes() { const s = localStorage.getItem(STORAGE_KEY); return s ? JSON.parse(s) : { principal: 1.0, ambiental: 0.8, examenes: 0.8 }; }
const volumes = getStoredVolumes();
const pAudio  = document.getElementById('pageMusic');
if (pAudio) pAudio.volume = volumes.principal;
</script>
<script src="assets/js/volume_manager.js"></script>
<script>if (typeof initPageAudio === 'function') initPageAudio('pageMusic');</script>
</body>
</html>