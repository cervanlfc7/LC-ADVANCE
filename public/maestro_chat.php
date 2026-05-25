<?php
require_once __DIR__ . '/../src/Config/config.php';
requireLogin(true);
$supported_langs = ['es', 'en'];
if (isset($_GET['lang']) && in_array($_GET['lang'], $supported_langs, true)) $_SESSION['lang'] = $_GET['lang'];
$lang = $_SESSION['lang'] ?? 'es';
if (!in_array($lang, $supported_langs, true)) $lang = 'es';
$t = [
    'es' => [
        'title' => 'Preguntar al Maestro', 'placeholder' => 'Escribe tu pregunta...', 'send' => 'Enviar',
        'thinking' => 'El Maestro está pensando...', 'clear_history' => 'Limpiar historial',
        'back_dashboard' => '← Dashboard', 'greeting' => '¡Hola! Soy tu Maestro de',
        'greeting_ask' => 'Pregúntame cualquier cosa sobre la materia.', 'error_empty' => 'Escribe una pregunta primero.',
    ],
    'en' => [
        'title' => 'Ask the Teacher', 'placeholder' => 'Write your question...', 'send' => 'Send',
        'thinking' => 'The Teacher is thinking...', 'clear_history' => 'Clear history',
        'back_dashboard' => '← Dashboard', 'greeting' => 'Hi! I am your Teacher of',
        'greeting_ask' => 'Ask me anything about the subject.', 'error_empty' => 'Write a question first.',
    ],
];
$materia = trim($_GET['materia'] ?? '');
if (empty($materia)) { header('Location: dashboard.php'); exit; }
$materia_profesor_map = [
    'Temas Selectos de Matemáticas I y II' => 'Miguel Marquez', 'Inglés' => 'Enrique',
    'Pensamiento Matemático III' => 'Espindola', 'Programación' => 'Manuel',
    'Física I' => 'Herson', 'Química I' => 'Herson', 'Ecosistemas' => 'Carolina',
    'Ciencias Sociales' => 'Refugio & Padilla', 'Historia de México' => 'Armando',
];
$materia_imagen_map = [
    'Temas Selectos de Matemáticas I y II' => 'salon_miguel.png', 'Inglés' => 'salon_enrique.png',
    'Pensamiento Matemático III' => 'salon_espindola.png', 'Programación' => 'salon_manuel.png',
    'Física I' => 'salon_herson.png', 'Química I' => 'salon_herson.png',
    'Ecosistemas' => 'salon_carolina.png', 'Ciencias Sociales' => 'salon_padilla.png',
    'Historia de México' => 'salon_cuco.png',
];
$profesor = $materia_profesor_map[$materia] ?? 'Maestro';
$imagen = $materia_imagen_map[$materia] ?? 'salon_cuco.png';
$imagen_path = 'assets/img/' . $imagen;
$history_key = 'maestro_chat_' . str_replace(' ', '_', $materia);
$history = $_SESSION[$history_key] ?? [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json; charset=utf-8');
    $action = $_POST['action'] ?? '';
    if ($action === 'clear') { $_SESSION[$history_key] = []; echo json_encode(['ok' => true]); exit; }
    if ($action === 'save') {
        $role = $_POST['role'] ?? ''; $content = $_POST['content'] ?? '';
        if (in_array($role, ['user', 'assistant'], true) && !empty($content)) {
            $_SESSION[$history_key][] = ['role' => $role, 'content' => $content, 'timestamp' => time()];
            if (count($_SESSION[$history_key]) > 50) $_SESSION[$history_key] = array_slice($_SESSION[$history_key], -50);
        }
        echo json_encode(['ok' => true]); exit;
    }
    if ($action === 'ask') {
        $question = trim($_POST['question'] ?? '');
        if (empty($question)) { echo json_encode(['ok' => false, 'error' => $t[$lang]['error_empty']]); exit; }
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
        $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
        $base_dir = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
        $api_url = "$protocol://$host$base_dir/ai_tutor.php";
        $post_data = http_build_query([
            'question' => $question, 'materia' => $materia,
            'slug' => 'consulta_' . str_replace(' ', '_', $materia),
            'lesson_title' => 'Consulta general - ' . $materia,
            'lesson_subject' => $materia, 'provider' => 'auto',
        ]);
        session_write_close();
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $api_url); curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true); curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10); curl_setopt($ch, CURLOPT_TIMEOUT, 45);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        $session_cookie = session_name() . '=' . session_id();
        curl_setopt($ch, CURLOPT_COOKIE, $session_cookie);
        if (!empty($_SERVER['HTTP_COOKIE'])) curl_setopt($ch, CURLOPT_COOKIE, $_SERVER['HTTP_COOKIE']);
        $resp = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curl_error = curl_error($ch);
        curl_close($ch);
        if ($curl_error) { echo json_encode(['ok' => false, 'error' => "Error de conexión: $curl_error"]); exit; }
        if ($http_code >= 200 && $http_code < 300 && $resp) {
            $data = json_decode($resp, true);
            $response_text = $data['ai_text'] ?? $data['advice'] ?? '';
            echo json_encode(['ok' => true, 'response' => $response_text ?: ($data['advice'] ?? 'El maestro no respondió.')]);
        } else {
            echo json_encode(['ok' => false, 'error' => "Error HTTP $http_code"]);
        }
        exit;
    }
    echo json_encode(['ok' => false, 'error' => 'Acción no válida']); exit;
}
?>
<!DOCTYPE html>
<html lang="<?= $lang ?>">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<title><?= htmlspecialchars($profesor) ?> | <?= htmlspecialchars($t[$lang]['title']) ?> | LC-ADVANCE</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500;700&family=Syne:wght@700;800&display=swap" rel="stylesheet">
<style>
:root {
    --cyan: #00e5ff; --pink: #ff3cac; --green: #00ff87; --yellow: #ffd23f;
    --text: #e8f4ff; --text-secondary: rgba(200,230,255,0.75); --muted: rgba(200,230,255,0.5);
    --font-display: "Syne",sans-serif; --font-body: "Space Grotesk",sans-serif; --font-mono: "JetBrains Mono",monospace;
}
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
html,body{width:100%;height:100%;overflow:hidden;background:#060a12;color:var(--text);font-family:var(--font-body);font-size:14px}
.header{
    position:fixed;top:0;left:0;right:0;z-index:1000;
    display:flex;justify-content:space-between;align-items:center;
    padding:8px 16px;background:rgba(6,10,18,0.85);backdrop-filter:blur(8px);
    border-bottom:1px solid rgba(0,230,255,0.12);
}
.header-left{display:flex;align-items:center;gap:10px}
.logo-text{font-family:var(--font-display);font-size:16px;font-weight:800;color:var(--cyan);letter-spacing:-0.5px}
.logo-tag{font-family:var(--font-mono);font-size:8px;color:var(--muted);text-transform:uppercase}
.btn-nav{padding:6px 12px;font-family:var(--font-mono);font-size:9px;text-transform:uppercase;text-decoration:none;color:var(--text-secondary);background:rgba(16,24,40,0.9);border:1px solid rgba(0,230,255,0.12);border-radius:6px;transition:0.2s}
.btn-nav:hover{color:var(--cyan);border-color:var(--cyan)}
.maestro-badge{display:flex;align-items:center;gap:6px;font-family:var(--font-mono);font-size:10px}
.maestro-badge .name{color:var(--cyan)}
.maestro-badge .subj{color:var(--muted);font-size:9px}
@media(max-width:500px){.logo-tag,.maestro-badge .subj{display:none}.btn-nav{padding:4px 8px;font-size:8px}}

.classroom{position:fixed;top:0;left:0;right:0;bottom:0;display:flex;align-items:center;justify-content:center;background:#060a12}
.classroom img{width:100vw;height:100vh;object-fit:contain;image-rendering:pixelated;image-rendering:crisp-edges}

/* ── Chat overlay ── */
.chat-pizarron{
    position:fixed;z-index:10;display:flex;flex-direction:column;overflow:hidden;
    background:rgba(12,18,32,0.92);backdrop-filter:blur(12px);-webkit-backdrop-filter:blur(12px);
    border:1px solid rgba(0,230,255,0.12);border-radius:8px;
    box-shadow:0 4px 30px rgba(0,0,0,0.7);visibility:hidden;
    touch-action:none;
    top:0;left:0;width:min(380px,85vw);height:min(300px,55vh);
}
.chat-pizarron.visible{visibility:visible}

.chat-header-bar{
    display:flex;justify-content:space-between;align-items:center;
    padding:6px 10px;border-bottom:1px solid rgba(0,230,255,0.08);
    background:rgba(6,10,18,0.5);flex-shrink:0;cursor:grab;user-select:none;
}
.chat-header-bar:active{cursor:grabbing}
.chat-header-title{font-family:var(--font-mono);font-size:9px;text-transform:uppercase;color:var(--muted);overflow:hidden;text-overflow:ellipsis;white-space:nowrap}
.chat-header-btn{padding:3px 8px;font-family:var(--font-mono);font-size:8px;text-transform:uppercase;color:var(--text-secondary);background:transparent;border:1px solid rgba(0,230,255,0.12);border-radius:4px;cursor:pointer;transition:0.2s;flex-shrink:0}
.chat-header-btn:hover{color:var(--pink);border-color:var(--pink)}

.chat-messages{flex:1;overflow-y:auto;padding:6px 8px;display:flex;flex-direction:column;gap:5px;min-height:0}
.chat-messages::-webkit-scrollbar{width:3px}
.chat-messages::-webkit-scrollbar-track{background:transparent}
.chat-messages::-webkit-scrollbar-thumb{background:rgba(0,230,255,0.15);border-radius:2px}

.msg{padding:6px 9px;border-radius:6px;line-height:1.4;font-size:11px;max-width:98%;animation:msgIn 0.2s ease;word-wrap:break-word}
@keyframes msgIn{from{opacity:0;transform:translateY(4px)}to{opacity:1;transform:translateY(0)}}
.msg.user{align-self:flex-end;background:rgba(0,229,255,0.06);border:1px solid rgba(0,230,255,0.15)}
.msg.assistant{align-self:flex-start;background:rgba(16,24,40,0.85);border:1px solid rgba(0,230,255,0.06)}
.msg.assistant strong{color:var(--cyan)}
.msg.assistant code{font-family:var(--font-mono);background:rgba(6,10,18,0.8);padding:1px 4px;border-radius:3px;font-size:10px}
.msg.assistant pre{background:rgba(6,10,18,0.8);padding:6px;border-radius:4px;overflow-x:auto;margin:3px 0;font-size:10px}
.msg.assistant pre code{background:none;padding:0}
.msg.thinking{align-self:flex-start;color:var(--muted);font-style:italic;background:transparent;border:none;padding:6px 9px}
.msg.greeting{align-self:center;text-align:center;background:transparent;border:none;color:var(--muted);padding:10px 6px}
.msg.greeting strong{color:var(--text-secondary);display:block;font-size:11px}

.chat-input-area{padding:5px 8px;border-top:1px solid rgba(0,230,255,0.08);display:flex;gap:5px;background:rgba(6,10,18,0.3);flex-shrink:0}
.chat-input{flex:1;padding:6px 9px;font-family:var(--font-body);font-size:11px;color:var(--text);background:rgba(16,24,40,0.8);border:1px solid rgba(0,230,255,0.12);border-radius:5px;outline:none;resize:none;max-height:60px}
.chat-input:focus{border-color:var(--cyan)}
.chat-input::placeholder{color:var(--muted)}
.btn-send{padding:6px 12px;font-family:var(--font-mono);font-size:9px;font-weight:600;text-transform:uppercase;color:#060a12;background:var(--cyan);border:none;border-radius:5px;cursor:pointer;transition:0.2s;white-space:nowrap}
.btn-send:hover{background:#33ebff}
.btn-send:disabled{background:var(--muted);cursor:not-allowed}

/* ── Resize handles: corners + edges ── */
.resize-handle{
    position:absolute;z-index:20;
    transition:background 0.15s, border-color 0.15s;
}

/* Corner handles — only bottom corners */
.corner-handle{
    width:18px;height:18px;
    border:2px solid rgba(0,229,255,0.5);border-radius:2px;
    background:rgba(6,10,18,0.8);
    opacity:1;
}
.corner-handle:hover{border-color:var(--cyan);background:rgba(0,229,255,0.15)}
.corner-handle.se{bottom:-9px;right:-9px;cursor:nwse-resize;border-top:none;border-left:none}
.corner-handle.sw{bottom:-9px;left:-9px;cursor:nesw-resize;border-top:none;border-right:none}
.corner-handle.se::after{content:'';position:absolute;bottom:2px;right:2px;width:7px;height:7px;border-right:2px solid var(--cyan);border-bottom:2px solid var(--cyan)}
.corner-handle.sw::after{content:'';position:absolute;bottom:2px;left:2px;width:7px;height:7px;border-left:2px solid var(--cyan);border-bottom:2px solid var(--cyan)}

/* Edge handles */
.edge-handle{background:rgba(0,229,255,0.08);opacity:1;z-index:19}
.edge-handle.bottom{bottom:0;left:18px;right:18px;height:6px;cursor:s-resize;border-radius:0 0 3px 3px}
.edge-handle.left{left:0;top:8px;bottom:18px;width:6px;cursor:w-resize;border-radius:3px 0 0 3px}
.edge-handle.right{right:0;top:8px;bottom:18px;width:6px;cursor:e-resize;border-radius:0 3px 3px 0}
.edge-handle:hover{background:rgba(0,229,255,0.25)}

/* Touch: bigger handles */
@media(pointer:coarse){
    .corner-handle{width:26px;height:26px;}
    .corner-handle.se{bottom:-13px;right:-13px}.corner-handle.sw{bottom:-13px;left:-13px}
    .edge-handle.bottom{height:10px}
    .edge-handle.left,.edge-handle.right{width:10px}
}

/* ── Position controls bar ── */
.pos-controls{
    position:fixed;bottom:10px;left:50%;transform:translateX(-50%);z-index:100;
    display:flex;gap:4px;flex-wrap:wrap;justify-content:center;
    background:rgba(6,10,18,0.85);backdrop-filter:blur(6px);
    padding:5px 10px;border-radius:8px;border:1px solid rgba(0,230,255,0.12);
}
.pos-btn{
    padding:4px 9px;font-family:var(--font-mono);font-size:11px;color:var(--text-secondary);
    background:rgba(16,24,40,0.9);border:1px solid rgba(0,230,255,0.12);border-radius:4px;
    cursor:pointer;transition:0.2s;min-width:28px;text-align:center;touch-action:manipulation;
}
.pos-btn:hover{color:var(--cyan);border-color:var(--cyan);background:rgba(0,229,255,0.1)}
.pos-btn:active{background:rgba(0,229,255,0.2)}

.salon-credits{
    position:fixed;bottom:52px;left:50%;transform:translateX(-50%);z-index:100;
    font-family:var(--font-mono);font-size:9px;color:var(--muted);opacity:0.4;text-align:center;pointer-events:none;
}
@media(max-width:500px){
    .pos-controls{gap:3px;padding:4px 6px;bottom:6px}
    .pos-btn{font-size:10px;padding:3px 7px;min-width:24px}
    .salon-credits{display:none}
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
</head>
<body>

<header class="header">
    <div class="header-left">
        <span class="logo-text">LC-ADVANCE</span>
        <span class="logo-tag">// MAESTRO</span>
        <span class="maestro-badge">
            <span class="name"><?= htmlspecialchars($profesor) ?></span>
            <span class="subj">— <?= htmlspecialchars($materia) ?></span>
        </span>
    </div>
    <div class="header-volume">
      <button class="vol-btn" id="volBtn" onclick="toggleVolumeSlider()">🔊</button>
      <div class="vol-slider" id="volSlider">
        <input type="range" id="volPrincipalSlider" min="0" max="1" step="0.1" value="0.1">
      </div>
    </div>
    <a href="dashboard.php" class="btn-nav"><?= htmlspecialchars($t[$lang]['back_dashboard']) ?></a>
</header>

<div class="classroom">
    <img src="<?= htmlspecialchars($imagen_path) ?>" alt="Salón de <?= htmlspecialchars($profesor) ?>" id="salonImg">
</div>

<div class="chat-pizarron" id="chatOverlay">
    <!-- Resize handles: bottom corners + bottom/side edges only -->
    <div class="corner-handle se" data-resize="se"></div>
    <div class="corner-handle sw" data-resize="sw"></div>
    <div class="edge-handle bottom" data-resize="b"></div>
    <div class="edge-handle left" data-resize="l"></div>
    <div class="edge-handle right" data-resize="r"></div>

    <div class="chat-header-bar">
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
        <textarea class="chat-input" id="chatInput" rows="1" placeholder="<?= htmlspecialchars($t[$lang]['placeholder']) ?>"></textarea>
        <button class="btn-send" id="sendBtn"><?= htmlspecialchars($t[$lang]['send']) ?></button>
    </div>
</div>

<div class="pos-controls">
    <button class="pos-btn" id="posUp">↑</button>
    <button class="pos-btn" id="posDown">↓</button>
    <button class="pos-btn" id="posLeft">←</button>
    <button class="pos-btn" id="posRight">→</button>
    <span style="font-family:var(--font-mono);font-size:10px;color:var(--muted);margin:0 2px">│</span>
    <button class="pos-btn" id="posPlus">+</button>
    <button class="pos-btn" id="posMinus">−</button>
    <span style="font-family:var(--font-mono);font-size:10px;color:var(--muted);margin:0 2px">│</span>
    <button class="pos-btn" id="btnCalibrar" style="color:var(--green);border-color:var(--green)">🎯</button>
    <button class="pos-btn" id="posReset" style="color:var(--pink);border-color:var(--pink)">↺</button>
</div>

<div class="salon-credits"><?= htmlspecialchars($profesor) ?> — <?= htmlspecialchars($materia) ?></div>

<script>
const salonImg=document.getElementById('salonImg');
const chatEl=document.getElementById('chatOverlay');
const chatMsgs=document.getElementById('chatMessages');
const chatInput=document.getElementById('chatInput');
const sendBtn=document.getElementById('sendBtn');
const clearBtn=document.getElementById('clearBtn');

// ── State: absolute position & size (pixels) ──
// Once user touches the chat, these are saved. On next load they persist.
// 0 = not customized yet → calculate from BOARD.
let absX=parseInt(sessionStorage.getItem('mc_a_x')||'0');
let absY=parseInt(sessionStorage.getItem('mc_a_y')||'0');
let absW=parseInt(sessionStorage.getItem('mc_a_w')||'0');
let absH=parseInt(sessionStorage.getItem('mc_a_h')||'0');

// Blackboard region on the 160x160 pixel art (used for calibration)
const BOARD={x:38,y:55,w:100,h:40};

function getActualImageRect(img){
    const vr=img.getBoundingClientRect();
    const nW=img.naturalWidth,nH=img.naturalHeight;
    if(!nW||!nH)return null;
    const cR=vr.width/vr.height,iR=nW/nH;
    let rw,rh,rx,ry;
    if(cR>iR){rh=vr.height;rw=vr.height*iR;rx=vr.left+(vr.width-rw)/2;ry=vr.top}
    else{rw=vr.width;rh=vr.width/iR;rx=vr.left;ry=vr.top+(vr.height-rh)/2}
    return{left:rx,top:ry,width:rw,height:rh};
}

function calcDefaultPos(){
    const ir=getActualImageRect(salonImg);
    if(!ir||ir.width===0)return null;
    const vh=window.innerHeight;
    const headerH=50, bottomH=70;

    // Always place chat INSIDE the image, flush to its right edge
    const chatW=Math.min(320, Math.max(240, ir.width*0.30));
    const imgRight=ir.left+ir.width;
    const defX=imgRight-chatW; // right edge of chat = right edge of image

    const chatH=Math.min(vh-headerH-bottomH-16, Math.max(260, (vh-headerH-bottomH)*0.85));
    const defY=headerH+8;
    return{x:defX, y:defY, w:chatW, h:chatH};
}

function positionChat(){
    if(!salonImg.complete||salonImg.naturalWidth===0){salonImg.addEventListener('load',positionChat,{once:true});return}
    // Use absolute if set, otherwise calculate default
    let l,t,w,h;
    if(absX>0&&absY>0){
        l=absX;t=absY;w=absW>0?absW:300;h=absH>0?absH:240;
    }else{
        const def=calcDefaultPos();
        if(!def)return;
        l=def.x;t=def.y;w=absW>0?absW:def.w;h=absH>0?absH:def.h;
    }
    // Clamp to viewport (respect header at top, controls bar at bottom)
    const headerH=50, bottomH=60;
    l=Math.max(8,Math.min(l,window.innerWidth-w-8));
    t=Math.max(headerH+8,Math.min(t,window.innerHeight-h-bottomH));
    chatEl.style.left=l+'px';chatEl.style.top=t+'px';
    chatEl.style.width=w+'px';chatEl.style.height=h+'px';
    chatEl.classList.add('visible');
}

function saveAbsState(){
    const el=chatEl.style;
    if(el.left&&el.left!=='auto'){absX=parseInt(el.left);absY=parseInt(el.top)}
    if(el.width&&el.width!=='auto'){absW=parseInt(el.width);absH=parseInt(el.height)}
    sessionStorage.setItem('mc_a_x',absX);
    sessionStorage.setItem('mc_a_y',absY);
    sessionStorage.setItem('mc_a_w',absW);
    sessionStorage.setItem('mc_a_h',absH);
}


// ── Move by arrow buttons ──
function moveBy(dx,dy){
    const l=(parseInt(chatEl.style.left)||absX||0)+dx;
    const t=(parseInt(chatEl.style.top)||absY||0)+dy;
    chatEl.style.left=l+'px';chatEl.style.top=t+'px';
    saveAbsState();
}

// ── Resize by +/− buttons ──
function scaleSize(factor){
    const cw=parseInt(chatEl.style.width)||300;
    const ch=parseInt(chatEl.style.height)||240;
    absW=Math.max(160,Math.round(cw*factor));
    absH=Math.max(120,Math.round(ch*factor));
    chatEl.style.width=absW+'px';chatEl.style.height=absH+'px';
    saveAbsState();
}

// ── Calibrate: save current position as default ──
function calibrate(){
    saveAbsState();
    positionChat();
}

// ── Reset everything ──
function resetAll(){
    absX=0;absY=0;absW=0;absH=0;
    sessionStorage.removeItem('mc_a_x');sessionStorage.removeItem('mc_a_y');
    sessionStorage.removeItem('mc_a_w');sessionStorage.removeItem('mc_a_h');
    positionChat();
}

// ── Initialize ──
positionChat();
salonImg.addEventListener('load',positionChat);
window.addEventListener('resize',positionChat);
let tries=0;
const rt=setInterval(()=>{if(chatEl.classList.contains('visible')||tries>10){clearInterval(rt);return}positionChat();tries++},300);

// ── Button handlers ──
document.getElementById('posUp').onclick=()=>moveBy(0,-8);
document.getElementById('posDown').onclick=()=>moveBy(0,8);
document.getElementById('posLeft').onclick=()=>moveBy(-8,0);
document.getElementById('posRight').onclick=()=>moveBy(8,0);
document.getElementById('posPlus').onclick=()=>scaleSize(1.1);
document.getElementById('posMinus').onclick=()=>scaleSize(0.9);
document.getElementById('posReset').onclick=resetAll;
document.getElementById('btnCalibrar').onclick=calibrate;

// ── Keyboard shortcuts ──
document.addEventListener('keydown',e=>{
    if(document.activeElement===chatInput||e.ctrlKey||e.metaKey)return;
    const s=e.shiftKey?1:8;
    switch(e.key){
        case'ArrowUp':e.preventDefault();moveBy(0,-s);break;
        case'ArrowDown':e.preventDefault();moveBy(0,s);break;
        case'ArrowLeft':e.preventDefault();moveBy(-s,0);break;
        case'ArrowRight':e.preventDefault();moveBy(s,0);break;
        case'+':case'=':e.preventDefault();scaleSize(1.1);break;
        case'-':e.preventDefault();scaleSize(0.9);break;
        case'r':case'R':e.preventDefault();resetAll();break;
    }
});

// ── DRAG to MOVE (header drag) ──
let drag=false,dSX,dSY;
const hdr=document.querySelector('.chat-header-bar');

function startDrag(x,y){
    drag=true;dSX=x;dSY=y;
    chatEl.style.cursor='grabbing';
}
function moveDrag(x,y){
    if(!drag)return;
    const dx=x-dSX,dy=y-dSY;
    const l=(parseInt(chatEl.style.left)||absX||0)+dx;
    const t=(parseInt(chatEl.style.top)||absY||0)+dy;
    chatEl.style.left=l+'px';chatEl.style.top=t+'px';
    dSX=x;dSY=y;
}
function endDrag(){
    if(!drag)return;
    drag=false;chatEl.style.cursor='';
    saveAbsState();
}

hdr.addEventListener('mousedown',e=>{if(e.target.tagName==='BUTTON')return;e.preventDefault();startDrag(e.clientX,e.clientY)});
hdr.addEventListener('touchstart',e=>{if(e.target.tagName==='BUTTON')return;const t=e.touches[0];startDrag(t.clientX,t.clientY)},{passive:true});
// (global move/up/end are registered once in the resize section below)

// ── DRAG to RESIZE (corners + edges) ──
let resize=false,rDir,rSX,rSY,rSW,rSH,rSLeft,rSTop,rAF=null;
const MIN_W=200,MIN_H=150;

function startResize(dir,x,y,e){
    e.preventDefault();e.stopPropagation();
    if(drag){endDrag();} // cancel drag if active
    resize=true;rDir=dir;rSX=x;rSY=y;
    const r=chatEl.getBoundingClientRect();
    rSW=r.width; rSH=r.height;
    rSLeft=r.left; rSTop=r.top;
    chatEl.classList.add('is-resizing');
    document.body.style.cursor=getCursorForDir(dir);
    document.body.style.userSelect='none';
}

function getCursorForDir(d){
    const m={t:'n-resize',b:'s-resize',l:'w-resize',r:'e-resize',nw:'nwse-resize',se:'nwse-resize',ne:'nesw-resize',sw:'nesw-resize'};
    return m[d]||'default';
}

function doResize(clientX,clientY){
    if(!resize)return;
    if(rAF)cancelAnimationFrame(rAF);
    rAF=requestAnimationFrame(()=>{
        const dx=clientX-rSX;
        const dy=clientY-rSY;

        // Start from the snapshot taken at mousedown
        let left=rSLeft, top=rSTop, width=rSW, height=rSH;

        // Horizontal
        if(rDir==='r'||rDir==='se'||rDir==='ne'){
            // right edge moves → only width changes, left stays
            width=Math.max(MIN_W, rSW+dx);
        } else if(rDir==='l'||rDir==='sw'||rDir==='nw'){
            // left edge moves → anchor right edge (left+width = rSLeft+rSW)
            const newW=Math.max(MIN_W, rSW-dx);
            left=rSLeft+rSW-newW; // keep right edge fixed
            width=newW;
        }

        // Vertical
        if(rDir==='b'||rDir==='se'||rDir==='sw'){
            // bottom edge moves → only height changes, top stays
            height=Math.max(MIN_H, rSH+dy);
        } else if(rDir==='t'||rDir==='ne'||rDir==='nw'){
            // top edge moves → anchor bottom edge (top+height = rSTop+rSH)
            const newH=Math.max(MIN_H, rSH-dy);
            top=rSTop+rSH-newH; // keep bottom edge fixed
            height=newH;
        }

        chatEl.style.left=left+'px';
        chatEl.style.top=top+'px';
        chatEl.style.width=width+'px';
        chatEl.style.height=height+'px';
    });
}

function endResize(){
    if(!resize)return;
    resize=false;
    if(rAF){cancelAnimationFrame(rAF);rAF=null;}
    chatEl.classList.remove('is-resizing');
    document.body.style.cursor='';
    document.body.style.userSelect='';
    saveAbsState();
}

document.querySelectorAll('[data-resize]').forEach(h=>{
    const dir=h.dataset.resize;
    h.addEventListener('mousedown',e=>startResize(dir,e.clientX,e.clientY,e));
    h.addEventListener('touchstart',e=>{
        const t=e.touches[0];
        startResize(dir,t.clientX,t.clientY,e);
    },{passive:false});
});

// Single global move/up listeners (replace old ones)
function onGlobalMove(clientX,clientY){
    if(resize) doResize(clientX,clientY);
    else if(drag) moveDrag(clientX,clientY);
}
document.addEventListener('mousemove',e=>onGlobalMove(e.clientX,e.clientY));
document.addEventListener('touchmove',e=>{
    if(!resize&&!drag)return;
    e.preventDefault(); // prevent scroll during resize/drag
    const t=e.touches[0];
    onGlobalMove(t.clientX,t.clientY);
},{passive:false});

document.addEventListener('mouseup',()=>{endResize();endDrag();});
document.addEventListener('touchend',()=>{endResize();endDrag();});

// ── Chat message logic ──
function scrollToBottom(){chatMsgs.scrollTop=chatMsgs.scrollHeight}
function addMsg(role,content){
    const g=chatMsgs.querySelector('.msg.greeting');if(g)g.remove();
    const d=document.createElement('div');d.className='msg '+role;
    d.innerHTML=content.replace(/\n/g,'<br>');
    chatMsgs.appendChild(d);scrollToBottom();
}
function addThinking(){
    const d=document.createElement('div');d.className='msg thinking';d.id='thinkingMsg';
    d.textContent='🤔 <?= htmlspecialchars($t[$lang]['thinking']) ?>';
    chatMsgs.appendChild(d);scrollToBottom();
}
function rmThink(){const e=document.getElementById('thinkingMsg');if(e)e.remove()}

async function saveMsg(role,content){
    const fd=new FormData();fd.append('action','save');fd.append('role',role);fd.append('content',content);
    try{await fetch(window.location.href,{method:'POST',body:fd})}catch(e){}
}

async function sendMessage(){
    const q=chatInput.value.trim();if(!q)return;
    chatInput.value='';chatInput.style.height='auto';
    addMsg('user',q);saveMsg('user',q);
    sendBtn.disabled=true;chatInput.disabled=true;addThinking();
    const fd=new FormData();fd.append('action','ask');fd.append('question',q);
    try{
        const r=await fetch(window.location.href,{method:'POST',body:fd});
        const d=await r.json();rmThink();
        const a=d.ok&&d.response?d.response:(d.error||'El maestro no respondió.');
        addMsg('assistant',a);saveMsg('assistant',a);
    }catch(e){rmThink();addMsg('assistant','Error de conexión. Intenta de nuevo.')}
    sendBtn.disabled=false;chatInput.disabled=false;chatInput.focus();
}

sendBtn.onclick=sendMessage;
chatInput.addEventListener('keydown',e=>{if(e.key==='Enter'&&!e.shiftKey){e.preventDefault();sendMessage()}});
chatInput.addEventListener('input',()=>{chatInput.style.height='auto';chatInput.style.height=Math.min(chatInput.scrollHeight,60)+'px'});
clearBtn.onclick=async()=>{
    if(!confirm('¿Limpiar todo el historial?'))return;
    const fd=new FormData();fd.append('action','clear');
    try{await fetch(window.location.href,{method:'POST',body:fd})}catch(e){}
    location.reload();
};
scrollToBottom();
</script>
<audio id="pageMusic" loop>
  <source src="assets/music/cuco_pantalla_inicio.mp3" type="audio/mpeg">
</audio>
<script>
const STORAGE_KEY = 'lc_volume_settings';
function getStoredVolumes() {
  const stored = localStorage.getItem(STORAGE_KEY);
  if (stored) return JSON.parse(stored);
  return { principal: 0.1, ambiental: 0.8, examenes: 0.8 };
}
const volumes = getStoredVolumes();
const pAudio = document.getElementById('pageMusic');
pAudio.volume = volumes.principal;
pAudio.play().then(() => console.log('Music playing')).catch(e => console.log('Audio error:', e));
</script>
<script>
function toggleVolumeSlider() {
  document.getElementById('volSlider').classList.toggle('show');
}
const volSlider = document.getElementById('volPrincipalSlider');
volSlider.value = volumes.principal;
volSlider.addEventListener('input', function(e) {
  volumes.principal = parseFloat(e.target.value);
  localStorage.setItem(STORAGE_KEY, JSON.stringify(volumes));
  pAudio.volume = volumes.principal;
  document.getElementById('volBtn').textContent = volumes.principal > 0 ? '🔊' : '🔇';
});
</script>
</body>
</html>