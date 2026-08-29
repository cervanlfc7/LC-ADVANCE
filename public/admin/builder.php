<?php
require_once __DIR__ . '/../../src/Config/config.php';
require_once __DIR__ . '/../../src/Config/csrf.php';
require_once __DIR__ . '/../../src/Core/admin.php';
require_once __DIR__ . '/../../src/Core/block_renderer.php';
requireAdmin();

$slug = trim($_GET['slug'] ?? '');
$leccion = buscarLeccion($slug);
if (!$leccion) { http_response_code(404); echo '<h1>Lecci&oacute;n no encontrada</h1>'; exit; }

$mensaje = ''; $error = '';

// Cargar bloques: DB (JSON) > file content (raw HTML wrapped) > empty
$blocks_raw = obtenerContenidoLeccion($pdo, $slug, '');
$blocks_data = [];
$is_imported_html = false;

if ($blocks_raw) {
    $decoded = json_decode($blocks_raw, true);
    if (is_array($decoded)) {
        $blocks_data = $decoded;
    } else {
        // Raw HTML en DB — split into individual blocks
        $blocks_data = htmlToBlocks($blocks_raw);
        $is_imported_html = true;
    }
} elseif (!empty($leccion['contenido'])) {
    // No hay DB — tomar contenido del archivo y dividirlo en bloques
    $blocks_data = htmlToBlocks($leccion['contenido']);
    $is_imported_html = true;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && validarTokenCSRF($_POST['csrf_token'] ?? '')) {
    $accion = $_POST['accion'] ?? '';
    if ($accion === 'guardar') {
        $json = $_POST['blocks_json'] ?? '[]';
        $decoded = json_decode($json, true);
        if (is_array($decoded)) {
            guardarContenidoLeccion($pdo, $slug, $json);
            $blocks_data = $decoded;
            logActividad('ADMIN_BUILDER_SAVE', "Bloques guardados: $slug", $_SESSION['usuario_id']);
            $mensaje = 'Bloques guardados.';
        } else {
            $error = 'JSON inv&aacute;lido.';
        }
    } elseif ($accion === 'restaurar') {
        try { $pdo->prepare("DELETE FROM lecciones_contenido WHERE slug = ?")->execute([$slug]); $blocks_data = []; $mensaje = 'Contenido restaurado.'; logActividad('ADMIN_BUILDER_RESTORE', "Bloques restaurados: $slug", $_SESSION['usuario_id']); } catch (Exception $e) { $error = 'Error.'; }
    } elseif ($accion === 'ai_chat') {
        $prompt = $_POST['prompt'] ?? '';
        $blocks_json = $_POST['blocks_json'] ?? '[]';
        $ai_response = '';
        $context = 'Eres un asistente que ayuda a crear contenido educativo interactivo. El usuario tiene estos bloques actuales en su lecci&oacute;n: ' . $blocks_json . '. Responde &uacute;til y breve. Si el usuario te pide crear contenido que pueda insertarse directamente en la lecci&oacute;n, usa [insertBlocks][{...}][/insertBlocks] con un array JSON de objetos bloque (cada uno con: id (string), tipo (heading/text/image/video/list/table/card/alert/divider/columns/quiz/html), data (object con propiedades seg&uacute;n el tipo)). O usa [insertHtml]...c&oacute;digo HTML...[/insertHtml] para HTML directo. Los marcadores se renderizar&aacute;n como botones de inserci&oacute;n.';

        // Intentar modelos gratuitos de OpenRouter con fallbacks
        $api_key = OPENROUTER_API_KEY;
        if ($api_key) {
            $modelsToTry = defined('OPENROUTER_FALLBACK_MODELS') && is_array(OPENROUTER_FALLBACK_MODELS)
                ? OPENROUTER_FALLBACK_MODELS
                : ['openrouter/free', 'deepseek/deepseek-chat-v3-0324:free', 'qwen/qwen3-235b-a22b:free', 'meta-llama/llama-4-maverick:free', 'microsoft/phi-4:free'];

            foreach ($modelsToTry as $tryModel) {
                $ch = curl_init('https://openrouter.ai/api/v1/chat/completions');
                curl_setopt_array($ch, [
                    CURLOPT_HTTPHEADER => ['Authorization: Bearer ' . $api_key, 'Content-Type: application/json', 'HTTP-Referer: https://lc-advance.local'],
                    CURLOPT_POST => true,
                    CURLOPT_POSTFIELDS => json_encode(['model' => $tryModel, 'messages' => [['role'=>'system','content'=>$context],['role'=>'user','content'=>$prompt]], 'max_tokens'=>900, 'temperature'=>0.7]),
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_CONNECTTIMEOUT => 10,
                ]);
                $resp = curl_exec($ch);
                $http = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                curl_close($ch);
                if ($http === 200) {
                    $data = json_decode($resp, true);
                    $ai_response = trim($data['choices'][0]['message']['content'] ?? '');
                    break;
                }
            }
            if (!$ai_response) {
                $msgs = [
                    400 => 'Solicitud inv&aacute;lida.',
                    401 => 'API key inv&aacute;lida o revocada. Verifica en openrouter.ai/keys.',
                    402 => 'Saldo insuficiente o modelo de pago. Usando solo modelos gratuitos.',
                    403 => 'Acceso denegado.',
                    429 => 'Demasiadas solicitudes. Espera unos segundos.',
                ];
                $ai_response = 'Error API (HTTP ' . $http . '): ' . ($msgs[$http] ?? 'Error desconocido. Verifica la conexi&oacute;n.');
            }
        } else {
            $ai_response = 'API key no configurada. Define OPENROUTER_API_KEY en .env o en la tabla credenciales.';
        }
        header('Content-Type: application/json'); echo json_encode(['response' => $ai_response]); exit;
    }
}

$page_title = 'Builder: ' . htmlspecialchars($leccion['titulo'] ?? '') . ' | Admin | LC-ADVANCE';
$r = appRootPath();
$page_show_bg_orb = true;

$page_extra_head = '<link rel="stylesheet" href="' . assetUrl('assets/css/style.css') . '">' . "\n";
$cssDir = realpath(__DIR__ . '/../assets/css');
if ($cssDir) {
    foreach (glob($cssDir . '/leccion-*.css') as $f) {
        $basename = basename($f);
        $page_extra_head .= '<link rel="stylesheet" href="' . htmlspecialchars($r . '/public/assets/css/' . $basename) . '">' . "\n";
    }
}
$page_extra_head .= '<script>MathJax = { tex: { inlineMath: [["$","$"],["\\\\(","\\\\)"]] } };</script>' . "\n";
$page_extra_head .= '<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js" async></script>' . "\n";
$page_extra_head .= '<link rel="stylesheet" href="' . $r . '/public/assets/css/dashboard.css?v=' . filemtime(__DIR__ . '/../assets/css/dashboard.css') . '">' . "\n" .
    '<link rel="stylesheet" href="' . $r . '/public/assets/css/admin.css?v=' . filemtime(__DIR__ . '/../assets/css/admin.css') . '">';
require __DIR__ . '/../../src/Templates/page_start.php';
?>
<style>
.builder-wrap { display:flex; flex-direction:column; height:calc(100dvh - 80px); }
.builder-top { display:flex; align-items:center; gap:10px; padding:8px 16px; background:var(--surface2); border-bottom:1px solid var(--border); flex-wrap:wrap; flex-shrink:0; }
.builder-top h2 { margin:0; font-size:16px; font-weight:600; flex:1; min-width:0; overflow:hidden; text-overflow:ellipsis; white-space:nowrap; }
.builder-body { display:flex; flex:1; overflow:hidden; min-height:0; }
.builder-palette { width:200px; overflow-y:auto; padding:8px; background:var(--surface); border-right:1px solid var(--border); flex-shrink:0; }
.builder-palette h3 { font-size:11px; color:var(--muted); text-transform:uppercase; letter-spacing:.5px; margin:0 0 8px 0; }
.palette-block { display:flex; align-items:center; gap:6px; padding:6px 10px; margin-bottom:3px; border-radius:6px; cursor:grab; font-size:12px; color:var(--text); background:var(--surface2); border:1px solid var(--border); transition:all .12s; user-select:none; }
.palette-block:hover { background:var(--cyan-dim); border-color:var(--cyan); }
.builder-canvas { flex:1; overflow-y:auto; padding:24px 32px; background:var(--bg); min-width:0; position:relative; }
.builder-canvas:empty { display:flex; align-items:center; justify-content:center; }
.canvas-placeholder { text-align:center; color:var(--muted); padding:60px; }
.canvas-placeholder .icon { font-size:48px; margin-bottom:8px; }
.block-wrap { position:relative; margin-bottom:4px; transition:all .15s; }
.block-wrap .block-overlay { position:absolute; inset:0; border-radius:8px; border:2px solid transparent; pointer-events:none; transition:all .15s; z-index:2; }
.block-wrap:hover .block-overlay { border-color:var(--border2); background:rgba(0,229,255,0.02); pointer-events:auto; }
.block-wrap.selected .block-overlay { border-color:var(--cyan); background:rgba(0,229,255,0.04); box-shadow:0 0 0 1px var(--cyan), 0 4px 24px rgba(0,229,255,0.06); }
.block-wrap .block-toolbar { position:absolute; top:-12px; left:50%; transform:translateX(-50%); display:flex; gap:2px; background:var(--surface2); border:1px solid var(--border); border-radius:6px; padding:2px; opacity:0; transition:opacity .12s; z-index:3; white-space:nowrap; }
.block-wrap:hover .block-toolbar { opacity:1; }
.block-wrap.selected .block-toolbar { opacity:1; }
.block-toolbar button { padding:2px 8px; font-size:10px; background:transparent; border:none; border-radius:4px; cursor:pointer; color:var(--text); font-weight:500; }
.block-toolbar button:hover { background:var(--cyan-dim); color:var(--cyan); }
.block-toolbar .del-btn:hover { background:var(--red)20; color:var(--red); }
.block-toolbar .badge { padding:2px 8px; font-size:9px; font-weight:600; color:var(--muted); letter-spacing:.3px; }
.block-live { pointer-events:none; user-select:none; }
.block-wrap.editable-block .block-overlay { pointer-events:none !important; }
.block-wrap.editable-block .block-live { pointer-events:auto; user-select:text; cursor:text; }
.block-wrap.editable-block .block-live [contenteditable="true"],
.block-wrap.editable-block .block-live[contenteditable="true"] { cursor:text; }
.block-wrap.editable-block .block-live [contenteditable="true"]:focus,
.block-wrap.editable-block .block-live[contenteditable="true"]:focus { outline:2px dashed var(--cyan); outline-offset:2px; border-radius:4px; }
.block-wrap.editable-block .block-live [contenteditable="true"]:hover,
.block-wrap.editable-block .block-live[contenteditable="true"]:hover { outline:1px dashed var(--border2); outline-offset:2px; }
.builder-props { width:280px; overflow-y:auto; padding:12px; background:var(--surface); border-left:1px solid var(--border); flex-shrink:0; }
.builder-props h3 { font-size:11px; color:var(--muted); text-transform:uppercase; letter-spacing:.5px; margin:0 0 12px 0; }
#inlineElementPanel { padding-bottom:12px; margin-bottom:12px; border-bottom:1px solid var(--border); }
#inlineElementPanel:empty { display:none; }
#inlineElementPanel h3 { color:var(--cyan); }
#inlineElementPanel .inline-tag { display:inline-block; padding:2px 8px; background:var(--cyan-dim); border-radius:4px; font-size:10px; font-family:var(--font-mono); color:var(--cyan); margin-left:6px; }
.inline-style-group { display:flex; gap:6px; flex-wrap:wrap; align-items:center; margin-bottom:8px; }
.inline-style-group label { font-size:10px; color:var(--muted); min-width:60px; }
.inline-style-group select { padding:3px 6px; font-size:11px; background:var(--surface2); border:1px solid var(--border); border-radius:4px; color:var(--text); }
.inline-style-group input[type="color"] { width:32px; height:28px; padding:1px; border:1px solid var(--border); border-radius:4px; background:var(--surface2); cursor:pointer; }
.style-btn-row { display:flex; gap:4px; }
.style-btn-row button { flex:1; padding:6px; border-radius:4px; cursor:pointer; font-size:13px; border:1px solid var(--border); background:var(--surface2); color:var(--text); transition:all .12s; }
.style-btn-row button:hover { background:var(--cyan-dim); border-color:var(--cyan); }
.style-btn-row button.active { background:var(--cyan)25; border-color:var(--cyan); color:var(--cyan); }
/* Drag-and-drop */
.block-wrap.drag-over { outline:2px dashed var(--cyan); outline-offset:2px; }
.block-wrap.dragging { opacity:0.4; }
.builder-canvas.drag-over-canvas { outline:2px dashed var(--cyan); outline-offset:-8px; background:rgba(0,229,255,0.02); border-radius:8px; }
/* Línea indicadora de inserción */
.drop-indicator { position:absolute; left:8px; right:8px; height:3px; background:var(--cyan); border-radius:2px; pointer-events:none; z-index:10; opacity:0; transition:opacity .1s; }
.drop-indicator.show { opacity:1; }
/* Chat resize handle */
.chat-resize-handle { height:5px; cursor:ns-resize; background:transparent; position:relative; flex-shrink:0; }
.chat-resize-handle:hover,.chat-resize-handle:active { background:var(--cyan-dim); }
.chat-resize-handle::after { content:''; position:absolute; top:2px; left:50%; transform:translateX(-50%); width:30px; height:1px; background:var(--border); border-radius:1px; }
.chat-resize-handle:hover::after { background:var(--cyan); }
.msg-insert-btn { display:inline-block; margin-top:6px; padding:4px 12px; background:linear-gradient(135deg,var(--cyan),#00b8d4); border:none; border-radius:6px; color:#041420; font-size:11px; font-weight:600; cursor:pointer; transition:opacity .15s; }
.msg-insert-btn:hover { opacity:.85; }
.prop-group { margin-bottom:12px; }
.prop-group label { display:block; font-size:11px; color:var(--muted); margin-bottom:3px; font-weight:500; }
.prop-group input,.prop-group select,.prop-group textarea { width:100%; padding:6px 8px; background:var(--surface2); border:1px solid var(--border); border-radius:4px; color:var(--text); font-size:12px; font-family:var(--font-mono); }
.prop-group textarea { min-height:60px; resize:vertical; }
.prop-group input:focus,.prop-group select:focus,.prop-group textarea:focus { outline:none; border-color:var(--cyan); }
.builder-chat-wrap { display:flex; flex-direction:column; flex-shrink:0; min-height:0; background:var(--surface); border-top:1px solid var(--border); }
.chat-toggle { display:flex; align-items:center; gap:8px; width:100%; padding:5px 16px; background:var(--surface); border:none; color:var(--muted); font-size:11px; font-weight:500; cursor:pointer; transition:all .12s; }
.chat-toggle:hover { color:var(--cyan); background:var(--surface2); }
.chat-toggle .arrow { display:inline-block; transition:transform .25s ease; font-size:9px; margin-right:4px; }
.chat-toggle.open .arrow { transform:rotate(180deg); }
.builder-chat { background:var(--surface2); display:flex; flex-direction:column; flex:1; min-height:80px; overflow:hidden; transition:max-height .3s ease, opacity .25s; max-height:400px; }
.builder-chat.collapsed { max-height:0; min-height:0; opacity:0; pointer-events:none; }
.builder-chat .chat-header { display:flex; align-items:center; gap:8px; padding:5px 14px; background:var(--surface); border-bottom:1px solid var(--border); flex-shrink:0; }
.builder-chat .chat-header .chat-title { font-size:11px; font-weight:600; color:var(--cyan); }
.builder-chat .chat-header .chat-status { font-size:10px; color:var(--muted); margin-left:auto; transition:color .2s; }
.builder-chat .chat-header .chat-clear { background:none; border:none; color:var(--muted); font-size:10px; cursor:pointer; padding:2px 6px; border-radius:4px; transition:all .12s; }
.builder-chat .chat-header .chat-clear:hover { color:var(--red); background:var(--red)15; }
.builder-chat .chat-msgs { flex:1; overflow-y:auto; padding:10px 14px; min-height:0; scrollbar-width:thin; scrollbar-color:var(--border) transparent; }
.builder-chat .chat-msgs::-webkit-scrollbar { width:4px; }
.builder-chat .chat-msgs::-webkit-scrollbar-track { background:transparent; }
.builder-chat .chat-msgs::-webkit-scrollbar-thumb { background:var(--border); border-radius:4px; }
.builder-chat .chat-msgs .msg { margin-bottom:10px; padding:10px 14px; border-radius:10px; font-size:13px; line-height:1.65; animation:fadeSlideIn .2s ease; position:relative; }
@keyframes fadeSlideIn { from{opacity:0;transform:translateY(8px)} to{opacity:1;transform:translateY(0)} }
.builder-chat .chat-msgs .msg.user { background:linear-gradient(135deg,var(--cyan-dim),var(--surface2)); border:1px solid var(--cyan)25; margin-left:32px; }
.builder-chat .chat-msgs .msg.ai { background:var(--surface); border:1px solid var(--border); margin-right:32px; }
.builder-chat .chat-msgs .msg .msg-label { display:inline-block; padding:0 8px; border-radius:8px; font-size:9px; font-weight:600; letter-spacing:.3px; margin-bottom:5px; text-transform:uppercase; }
.builder-chat .chat-msgs .msg.ai .msg-label { color:var(--cyan); background:var(--cyan)12; }
.builder-chat .chat-msgs .msg.user .msg-label { color:var(--green); background:var(--green)12; }
.builder-chat .chat-msgs .msg .msg-text { word-wrap:break-word; }
.builder-chat .chat-msgs .msg .msg-text code { background:#0d1117; padding:1px 5px; border-radius:3px; font-size:12px; font-family:var(--font-mono); }
.builder-chat .chat-msgs .msg .msg-text pre { background:#0d1117; padding:10px; border-radius:6px; overflow-x:auto; font-size:12px; font-family:var(--font-mono); line-height:1.5; margin:6px 0; }
.builder-chat .chat-msgs .msg .typing-dots { display:inline-flex; gap:4px; padding:4px 0; }
.builder-chat .chat-msgs .msg .typing-dots span { width:6px; height:6px; background:var(--cyan); border-radius:50%; animation:typing 1.2s infinite; }
.builder-chat .chat-msgs .msg .typing-dots span:nth-child(2) { animation-delay:.2s; }
.builder-chat .chat-msgs .msg .typing-dots span:nth-child(3) { animation-delay:.4s; }
@keyframes typing { 0%,60%,100%{opacity:.2;transform:translateY(0)} 30%{opacity:1;transform:translateY(-4px)} }
.builder-chat .chat-msgs .msg.error { background:var(--red)10; border:1px solid var(--red)25; color:var(--red); font-size:12px; }
.builder-chat .chat-msgs .msg.error .msg-label { color:var(--red); background:var(--red)12; }
.builder-chat .chat-input { display:flex; gap:6px; padding:8px 14px; border-top:1px solid var(--border); background:var(--surface); flex-shrink:0; }
.builder-chat .chat-input input { flex:1; padding:8px 12px; background:var(--surface2); border:1px solid var(--border); border-radius:8px; color:var(--text); font-size:12px; transition:border-color .15s, box-shadow .15s; }
.builder-chat .chat-input input:focus { outline:none; border-color:var(--cyan); box-shadow:0 0 0 3px rgba(0,229,255,0.08); }
.builder-chat .chat-input input::placeholder { color:var(--muted); }
.builder-chat .chat-input button { padding:8px 18px; background:linear-gradient(135deg,var(--cyan),#00b8d4); border:none; border-radius:8px; color:#041420; font-size:12px; font-weight:600; cursor:pointer; white-space:nowrap; transition:opacity .15s, transform .1s; }
.builder-chat .chat-input button:hover { opacity:.9; }
.builder-chat .chat-input button:active { transform:scale(.97); }
.builder-chat .chat-input button:disabled { opacity:.35; cursor:not-allowed; transform:none; }
.inline-format-bar { display:flex; gap:4px; flex-wrap:wrap; align-items:center; padding:6px 0; margin-bottom:10px; border-bottom:1px solid var(--border); }
.inline-format-bar button { padding:4px 8px; font-size:12px; background:var(--surface2); border:1px solid var(--border); border-radius:4px; color:var(--text); cursor:pointer; transition:all .12s; }
.inline-format-bar button:hover { background:var(--cyan-dim); border-color:var(--cyan); }
.inline-format-bar button.active { background:var(--cyan)25; border-color:var(--cyan); color:var(--cyan); }
.inline-format-bar select { padding:4px 6px; background:var(--surface2); border:1px solid var(--border); border-radius:4px; color:var(--text); font-size:11px; }
.inline-format-bar input[type="color"] { width:26px; height:26px; padding:2px; border:1px solid var(--border); border-radius:4px; background:var(--surface2); cursor:pointer; }
@media(max-width:768px){ .builder-palette { width:120px; } .builder-props { width:200px; } }
</style>

<div class="builder-wrap">
  <div class="builder-top">
    <a href="<?= htmlspecialchars($r . '/public/admin/lesson_view.php?slug=' . urlencode($slug)) ?>" class="admin-btn admin-btn-ghost" style="padding:4px 10px;font-size:11px">&larr; Volver</a>
    <h2>🧱 <?= htmlspecialchars($leccion['titulo'] ?? '') ?></h2>
    <span style="font-size:11px;color:var(--muted);font-family:var(--font-mono)"><?= htmlspecialchars($slug) ?></span>
    <div style="display:flex;gap:6px">
      <button class="admin-btn admin-btn-warn" style="padding:4px 12px;font-size:11px" onclick="confirmRestore()">↩️</button>
      <button class="admin-btn btn-primary" style="padding:4px 16px;font-size:12px" onclick="guardar()">💾 Guardar</button>
    </div>
  </div>

  <?php if ($mensaje): ?><div class="admin-msg admin-msg-ok" style="margin:0;border-radius:0"><?= $mensaje ?></div><?php endif; ?>
  <?php if ($error): ?><div class="admin-msg admin-msg-err" style="margin:0;border-radius:0"><?= htmlspecialchars($error) ?></div><?php endif; ?>
  <?php if ($is_imported_html): ?>
  <div class="admin-msg admin-msg-ok" style="margin:0;border-radius:0;background:var(--yellow)15;border-color:var(--yellow)35;color:var(--yellow)">⚠️ Contenido HTML importado. Haz clic directamente sobre cualquier texto en el lienzo para editarlo ah&iacute; mismo, o reempl&aacute;zalo con bloques visuales desde la paleta.</div>
  <?php endif; ?>

  <div class="builder-body">
    <div class="builder-palette">
      <h3>Bloques</h3>
      <div class="palette-block" draggable="true" data-block-type="heading" onclick="addBlock('heading')">📰 T&iacute;tulo</div>
      <div class="palette-block" draggable="true" data-block-type="text" onclick="addBlock('text')">📝 Texto</div>
      <div class="palette-block" draggable="true" data-block-type="image" onclick="addBlock('image')">🖼️ Imagen</div>
      <div class="palette-block" draggable="true" data-block-type="video" onclick="addBlock('video')">🎬 Video</div>
      <div class="palette-block" draggable="true" data-block-type="list" onclick="addBlock('list')">📋 Lista</div>
      <div class="palette-block" draggable="true" data-block-type="table" onclick="addBlock('table')">📊 Tabla</div>
      <div class="palette-block" draggable="true" data-block-type="card" onclick="addBlock('card')">💳 Tarjeta</div>
      <div class="palette-block" draggable="true" data-block-type="alert" onclick="addBlock('alert')">🔔 Alerta</div>
      <div class="palette-block" draggable="true" data-block-type="divider" onclick="addBlock('divider')">➖ Divisor</div>
      <div class="palette-block" draggable="true" data-block-type="columns" onclick="addBlock('columns')">📐 Columnas</div>
      <div class="palette-block" draggable="true" data-block-type="quiz" onclick="addBlock('quiz')">❓ Quiz</div>
      <div class="palette-block" draggable="true" data-block-type="html" onclick="addBlock('html')">&lt;/&gt; HTML</div>
    </div>

    <div class="builder-canvas" id="canvas">
      <div class="canvas-placeholder" id="canvasPlaceholder">
        <div class="icon">🧱</div>
        <p>Arrastra bloques desde la paleta para empezar</p>
      </div>
      <div class="drop-indicator" id="dropIndicator"></div>
    </div>

    <div class="builder-props">
      <div id="inlineElementPanel"></div>
      <div id="propsPanel">
        <h3>Propiedades</h3>
        <p style="font-size:12px;color:var(--muted)">Selecciona un bloque para editarlo</p>
      </div>
    </div>
  </div>

  <div class="builder-chat-wrap" id="chatWrap">
    <button class="chat-toggle open" id="chatToggleBtn" onclick="toggleChat()">
      <span class="arrow">▼</span> 🤖 Asistente IA
    </button>
    <div class="chat-resize-handle" id="chatResizeHandle"></div>
    <div class="builder-chat" id="chatPanel">
      <div class="chat-header">
        <span class="chat-title">🤖 Asistente IA</span>
        <span class="chat-status" id="chatStatus">Listo</span>
        <button class="chat-clear" onclick="limpiarChat()" title="Limpiar mensajes">✕</button>
      </div>
      <div class="chat-msgs" id="chatMsgs">
        <div class="msg ai"><span class="msg-label">Asistente</span><div class="msg-text">¡Hola! Puedo ayudarte a crear contenido, sugerirte bloques o mejorar lo que tienes.</div></div>
      </div>
      <div class="chat-input">
        <input type="text" id="chatInput" placeholder="Escribe un mensaje..." onkeydown="if(event.key==='Enter')enviarChat()">
        <button id="chatSendBtn" onclick="enviarChat()">Enviar</button>
      </div>
    </div>
  </div>
</div>

<script>
var blocks = <?= json_encode($blocks_data, JSON_UNESCAPED_UNICODE) ?>;
var selectedId = null;
var idCounter = Date.now();
var EDITABLE_TYPES = ['heading','text','list','table','card','alert','html'];
var activeInlineEl = null;
var savedHost = null;
var savedRange = null;

function genId() { return 'b' + (idCounter++); }

function render() {
    activeInlineEl = null;
    var iep = document.getElementById('inlineElementPanel');
    if (iep) { iep.innerHTML = ''; iep.style.display = 'none'; }

    var canvas = document.getElementById('canvas');
    // Preservar dropIndicator
    var indicator = document.getElementById('dropIndicator');
    if (!blocks || blocks.length === 0) {
        canvas.innerHTML = '<div class="canvas-placeholder" id="canvasPlaceholder"><div class="icon">🧱</div><p>Agrega bloques desde la paleta</p></div>';
        if (indicator) canvas.appendChild(indicator);
        document.getElementById('propsPanel').innerHTML = '<h3>Propiedades</h3><p style="font-size:12px;color:var(--muted)">Selecciona un bloque para editarlo</p>';
        selectedId = null;
        return;
    }

    var html = blocks.map(function(b, i) {
        var sel = b.id === selectedId ? ' selected' : '';
        var live = renderBlockLive(b);
        var badges = {heading:'📰',text:'📝',image:'🖼️',video:'🎬',list:'📋',table:'📊',card:'💳',alert:'🔔',divider:'➖',columns:'📐',quiz:'❓',html:'</>'};
        var isEditable = EDITABLE_TYPES.indexOf(b.tipo) !== -1;
        var liveAttrs = (b.tipo === 'html') ? ' contenteditable="true" spellcheck="false" data-edit="html"' : '';
        return '<div class="block-wrap' + sel + (isEditable ? ' editable-block' : '') + '" draggable="true" data-index="' + i + '" id="bw_' + b.id + '">' +
            '<div class="block-toolbar">' +
                '<span class="badge">' + (badges[b.tipo]||b.tipo) + '</span>' +
                '<button onclick="event.stopPropagation();selectBlock(\'' + b.id + '\');moveBlock(' + i + ',-1)" ' + (i===0?'disabled':'') + ' title="Subir">▲</button>' +
                '<button onclick="event.stopPropagation();selectBlock(\'' + b.id + '\');moveBlock(' + i + ',1)" ' + (i===blocks.length-1?'disabled':'') + ' title="Bajar">▼</button>' +
                '<button onclick="event.stopPropagation();duplicarBlock(' + i + ')" title="Duplicar">⧉</button>' +
                '<button class="del-btn" onclick="event.stopPropagation();deleteBlock(' + i + ')" title="Eliminar">✕</button>' +
            '</div>' +
            '<div class="block-live"' + liveAttrs + '>' + live + '</div>' +
            '<div class="block-overlay" onclick="selectBlock(\'' + b.id + '\')"></div>' +
            '</div>';
    }).join('');
    canvas.innerHTML = html;
    if (indicator) canvas.appendChild(indicator);
    renderProps();
    renderInlinePanel();
}

function renderBlockLive(b) {
    var d = b.data || {};
    switch (b.tipo) {
        case 'heading':
            var tag = d.level || 'h2';
            var size = {1:'26px',2:'20px',3:'17px'}[tag] || '20px';
            var headingContent = d.html || esc(d.text||'');
            return '<' + tag + ' contenteditable="true" spellcheck="false" data-edit="text" data-singleline="1" style="font-size:' + size + ';font-weight:700;color:var(--text);margin:8px 0;outline:none;' + styleObjToCss(d.style) + '">' + headingContent + '</' + tag + '>';
        case 'text':
            var textContent = d.html || esc(d.text||'');
            return '<p contenteditable="true" spellcheck="false" data-edit="text" style="color:var(--text);line-height:1.7;margin:6px 0;outline:none;' + styleObjToCss(d.style) + '">' + textContent + '</p>';
        case 'image':
            return '<figure style="margin:10px 0"><img src="' + esc(d.src||'') + '" alt="' + esc(d.alt||'') + '" style="max-width:100%;border-radius:8px" onerror="this.outerHTML=\'<div style=color:var(--red);padding:12px;background:var(--surface2);border-radius:8px;text-align:center>🖼️ Imagen no encontrada</div>\'">' +
                (d.caption ? '<figcaption style="text-align:center;font-size:12px;color:var(--muted);margin-top:4px">' + esc(d.caption) + '</figcaption>' : '') + '</figure>';
        case 'video':
            var url = d.url||'';
            var vid = '';
            var m = url.match(/(?:youtube\.com\/watch\?v=|youtu\.be\/)([a-zA-Z0-9_-]+)/);
            if (m) vid = m[1];
            return '<div style="position:relative;padding-bottom:56.25%;height:0;overflow:hidden;border-radius:8px;margin:10px 0;background:var(--surface2)">' +
                (vid ? '<iframe src="https://www.youtube.com/embed/' + vid + '" style="position:absolute;top:0;left:0;width:100%;height:100%;border:0" allowfullscreen></iframe>' : '<div style="position:absolute;inset:0;display:flex;align-items:center;justify-content:center;color:var(--muted);font-size:13px">🎬 ' + esc(url) + '</div>') +
                '</div>';
        case 'list':
            var items = d.items||[];
            var tag2 = d.ordered ? 'ol' : 'ul';
            var h = '<' + tag2 + ' style="margin:6px 0;padding-left:20px;line-height:1.7;color:var(--text)">';
            items.forEach(function(item, ii) { h += '<li contenteditable="true" spellcheck="false" data-edit="items:' + ii + '" data-singleline="1" style="outline:none">' + esc(item) + '</li>'; });
            return h + '</' + tag2 + '>';
        case 'table':
            var hdrs = d.headers||[];
            var rows = d.rows||[];
            var h2 = '<div style="overflow-x:auto;margin:10px 0"><table style="width:100%;border-collapse:collapse;font-size:13px">';
            if (hdrs.length) {
                h2 += '<thead><tr>';
                hdrs.forEach(function(hdr, hi) { h2 += '<th contenteditable="true" spellcheck="false" data-edit="headers:' + hi + '" data-singleline="1" style="padding:8px 12px;border:1px solid var(--border);background:var(--surface2);color:var(--cyan);font-weight:600;font-size:12px;outline:none">' + esc(hdr) + '</th>'; });
                h2 += '</tr></thead>';
            }
            h2 += '<tbody>';
            rows.forEach(function(row, ri) {
                h2 += '<tr>';
                row.forEach(function(cell, ci) { h2 += '<td contenteditable="true" spellcheck="false" data-edit="rows:' + ri + ':' + ci + '" data-singleline="1" style="padding:8px 12px;border:1px solid var(--border);font-size:12px;outline:none">' + esc(cell) + '</td>'; });
                h2 += '</tr>';
            });
            return h2 + '</tbody></table></div>';
        case 'card':
            var cardTitleHtml = d.html_title || esc(d.title||'');
            var cardTextHtml = d.html || esc(d.text||'');
            return '<div style="display:flex;gap:12px;padding:16px;background:var(--surface2);border-radius:12px;border-left:4px solid ' + (d.color||'var(--cyan)') + ';margin:10px 0">' +
                (d.icon ? '<div style="font-size:28px;flex-shrink:0">' + esc(d.icon) + '</div>' : '') +
                '<div><div contenteditable="true" spellcheck="false" data-edit="title" data-singleline="1" style="font-weight:600;color:' + (d.color||'var(--cyan)') + ';font-size:14px;outline:none">' + cardTitleHtml + '</div>' +
                '<p contenteditable="true" spellcheck="false" data-edit="text" style="margin:4px 0 0;color:var(--muted);font-size:13px;outline:none">' + cardTextHtml + '</p></div></div>';
        case 'alert':
            var icons = {info:'ℹ️',success:'✅',warning:'⚠️',danger:'🚨'};
            var colors = {info:'var(--cyan)',success:'var(--green)',warning:'var(--yellow)',danger:'var(--red)'};
            var tp = d.type||'info';
            var alertHtml = d.html || esc(d.text||'');
            return '<div style="padding:12px 16px;border-radius:8px;margin:10px 0;font-size:14px;background:' + colors[tp] + '15;border:1px solid ' + colors[tp] + '35;color:var(--text)">' +
                (icons[tp]||'ℹ️') + ' <span contenteditable="true" spellcheck="false" data-edit="text" style="outline:none;' + styleObjToCss(d.style) + '">' + alertHtml + '</span></div>';
        case 'divider':
            return '<hr style="border:none;border-top:1px solid var(--border);margin:16px 0">';
        case 'columns':
            var cols = d.columns||[];
            var h3 = '<div style="display:grid;grid-template-columns:repeat(' + cols.length + ',1fr);gap:16px;margin:10px 0">';
            cols.forEach(function(col) {
                h3 += '<div style="padding:12px;background:var(--surface);border-radius:8px;border:1px dashed var(--border);min-height:40px"><span style="color:var(--muted);font-size:10px">📐 ' + (col.blocks||[]).length + ' bloques</span></div>';
            });
            return h3 + '</div>';
        case 'quiz':
            var qs = d.questions||[];
            var hq = '<div style="margin:10px 0">';
            qs.forEach(function(q, qi) {
                var opts = q.opciones || q.options || [];
                hq += '<div style="padding:14px;background:var(--surface2);border-radius:8px;margin-bottom:10px;border:1px solid var(--border)">';
                hq += '<div style="font-weight:600;margin-bottom:8px;font-size:14px">' + (qi+1) + '. ' + esc(q.pregunta||'') + '</div>';
                opts.forEach(function(opt) {
                    var ok = opt === (q.correcta||'');
                    hq += '<label style="display:block;padding:6px 10px;margin:4px 0;border-radius:6px;background:' + (ok ? 'var(--green)20' : 'var(--surface)') + ';border:1px solid ' + (ok ? 'var(--green)40' : 'var(--border)') + ';font-size:13px;cursor:default">';
                    hq += '<input type="radio" disabled' + (ok ? ' checked' : '') + ' style="margin-right:8px">';
                    hq += esc(opt);
                    if (ok) hq += ' ✅';
                    hq += '</label>';
                });
                hq += '</div>';
            });
            return hq + '</div>';
        case 'html':
            return d.html || '';
        default:
            return '<div style="color:var(--muted);padding:8px">' + esc(d.text||'') + '</div>';
    }
}

function esc(s) { if (!s) return ''; return String(s).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;'); }

function styleObjToCss(obj) {
    if (!obj) return '';
    var map = {color:'color',backgroundColor:'background-color',fontSize:'font-size',fontWeight:'font-weight',fontStyle:'font-style',textDecoration:'text-decoration',textAlign:'text-align',textShadow:'text-shadow'};
    var out = '';
    for (var k in obj) { if (map[k] && obj[k]) out += map[k] + ':' + obj[k] + ';'; }
    return out;
}

function selectBlock(id) {
    selectedId = id;
    render();
}

function selectBlockLight(id) {
    selectedId = id;
    document.querySelectorAll('.block-wrap').forEach(function(w) {
        w.classList.toggle('selected', w.id === 'bw_' + id);
    });
    renderProps();
}

function getBlockEditorElement(blockId) {
    var wrap = document.getElementById('bw_' + blockId);
    if (!wrap) return null;
    return wrap.querySelector('[contenteditable="true"]');
}

function execFormatCmdOnBlock(cmd, val) {
    var el = getBlockEditorElement(selectedId);
    if (!el) return;
    el.focus();
    document.execCommand(cmd, false, val || null);
    applyInlineEdit(el);
    setTimeout(renderProps, 50);
}

function renderProps() {
    var panel = document.getElementById('propsPanel');
    if (!selectedId) { panel.innerHTML = '<h3>Propiedades</h3><p style="font-size:12px;color:var(--muted)">Selecciona un bloque para editarlo</p>'; return; }
    var b = blocks.find(function(x) { return x.id === selectedId; });
    if (!b) { panel.innerHTML = '<h3>Propiedades</h3><p style="font-size:12px;color:var(--muted)">Bloque no encontrado</p>'; return; }

    var d = b.data || {};
    var html = '<h3>✏️ ' + b.tipo + '</h3>';

    // Formato inline para bloques de texto
    if (EDITABLE_TYPES.indexOf(b.tipo) !== -1 && b.tipo !== 'html') {
        html += '<div class="inline-format-bar">';
        html += '<button onclick="execFormatCmdOnBlock(\'bold\')" title="Negrita"><b>B</b></button>';
        html += '<button onclick="execFormatCmdOnBlock(\'italic\')" title="Cursiva"><i>I</i></button>';
        html += '<button onclick="execFormatCmdOnBlock(\'underline\')" title="Subrayado"><u>U</u></button>';
        html += '<button onclick="execFormatCmdOnBlock(\'strikeThrough\')" title="Tachado"><s>S</s></button>';
        html += '<select onchange="execFormatCmdOnBlock(\'fontSize\', this.value)" title="Tamaño de fuente"><option value="1">8</option><option value="2">10</option><option value="3" selected>12</option><option value="4">14</option><option value="5">18</option><option value="6">24</option><option value="7">36</option></select>';
        html += '<input type="color" onchange="execFormatCmdOnBlock(\'foreColor\', this.value)" title="Color de texto">';
        html += '<input type="color" onchange="execFormatCmdOnBlock(\'hiliteColor\', this.value)" title="Fondo de texto">';
        html += '<button onclick="execFormatCmdOnBlock(\'justifyLeft\')" title="Alinear izquierda">⫷</button>';
        html += '<button onclick="execFormatCmdOnBlock(\'justifyCenter\')" title="Centrar">⬌</button>';
        html += '<button onclick="execFormatCmdOnBlock(\'justifyRight\')" title="Alinear derecha">⫸</button>';
        html += '<button onclick="execFormatCmdOnBlock(\'insertUnorderedList\')" title="Lista">•</button>';
        html += '<button onclick="execFormatCmdOnBlock(\'insertOrderedList\')" title="Lista numerada">1.</button>';
        html += '<button onclick="execFormatCmdOnBlock(\'createLink\', prompt(\'URL del enlace:\', \'https://\'))" title="Insertar enlace">🔗</button>';
        html += '<button onclick="execFormatCmdOnBlock(\'removeFormat\')" title="Limpiar formato">✖</button>';
        html += '</div>';
    }

    switch (b.tipo) {
        case 'heading':
            html += propSelect('level', 'Nivel', {'2':'H2','3':'H3','1':'H1'}, d.level||'2');
            html += '<p style="font-size:11px;color:var(--muted)">✏️ Haz clic en el t&iacute;tulo para editar el texto.</p>';
            break;
        case 'text':
            html += '<p style="font-size:11px;color:var(--muted)">✏️ Haz clic en el p&aacute;rrafo para editar el texto directamente.</p>';
            break;
        case 'image':
            html += propText('src', 'URL imagen', d.src||'');
            html += propText('alt', 'Texto alternativo', d.alt||'');
            html += propText('caption', 'Pie de foto', d.caption||'');
            break;
        case 'video':
            html += propText('url', 'URL video (YouTube)', d.url||'');
            break;
        case 'list':
            var items = d.items || [''];
            html += '<p style="font-size:11px;color:var(--muted);margin-bottom:6px">✏️ Edita cada elemento haciendo clic en la lista.</p>';
            html += '<div class="prop-group"><label>Items (' + items.length + ')</label>';
            items.forEach(function(item, idx) {
                html += '<div style="display:flex;gap:4px;margin-bottom:4px;align-items:center"><span style="flex:1;font-size:11px;color:var(--muted);white-space:nowrap;overflow:hidden;text-overflow:ellipsis">' + (idx+1) + '. ' + esc(item) + '</span><button onclick="removeListItem(' + idx + ')" style="padding:2px 6px;background:var(--surface);border:1px solid var(--border);border-radius:4px;color:var(--red);cursor:pointer">✕</button></div>';
            });
            html += '<button onclick="addListItem()" style="padding:3px 10px;background:var(--surface2);border:1px solid var(--border);border-radius:4px;color:var(--cyan);font-size:11px;cursor:pointer">+ Item</button></div>';
            html += '<div class="prop-group"><label><input type="checkbox" ' + (d.ordered?'checked':'') + ' onchange="updateProp(\'ordered\',this.checked)"> Numerada</label></div>';
            break;
        case 'table':
            html += '<p style="font-size:11px;color:var(--muted)">✏️ Edita el texto de cada celda haciendo clic directamente en la tabla.</p>';
            html += propText('headers_json', 'Encabezados (separados por |)', (d.headers||[]).join(' | '));
            html += propArea('rows_json', 'Filas (una por l&iacute;nea, celdas separadas por |)', (d.rows||[]).map(function(r){return r.join('|');}).join('\n'));
            break;
        case 'card':
            html += propText('icon', 'Icono (emoji)', d.icon||'');
            html += '<p style="font-size:11px;color:var(--muted)">✏️ El t&iacute;tulo y el texto se editan haciendo clic en la tarjeta.</p>';
            html += propColor('color', 'Color acento', d.color||'var(--cyan)');
            break;
        case 'alert':
            html += propSelect('type', 'Tipo', {'info':'Info','success':'Éxito','warning':'Advertencia','danger':'Peligro'}, d.type||'info');
            html += '<p style="font-size:11px;color:var(--muted)">✏️ Edita el texto de la alerta haciendo clic sobre ella.</p>';
            break;
        case 'divider':
            html += '<p style="font-size:12px;color:var(--muted)">Sin propiedades adicionales.</p>';
            break;
        case 'columns':
            var cols = d.columns || [{blocks:[]}];
            html += '<div class="prop-group"><label>Columnas</label>';
            html += '<select onchange="updateColCount(Number(this.value))"><option value="1" ' + (cols.length===1?'selected':'') + '>1</option><option value="2" ' + (cols.length===2?'selected':'') + '>2</option><option value="3" ' + (cols.length===3?'selected':'') + '>3</option></select></div>';
            html += '<p style="font-size:11px;color:var(--muted)">Agrega bloques dentro de cada columna desde la paleta.</p>';
            break;
        case 'html':
            html += '<p style="font-size:12px;color:var(--text);line-height:1.6;margin-bottom:10px">✏️ Haz clic en cualquier elemento para editar su estilo en el panel superior "Elemento seleccionado". Doble clic en im&aacute;genes para cambiar URL.</p>';
            html += '<button type="button" onclick="toggleHtmlCode()" class="admin-btn admin-btn-ghost" style="font-size:11px;padding:4px 10px;margin-bottom:8px">{ } Ver/editar c&oacute;digo fuente</button>';
            html += '<div id="htmlCodeBox" style="display:none"><textarea onchange="updateProp(\'html\',this.value)" style="min-height:220px;font-family:var(--font-mono);font-size:11px">' + esc(d.html||'') + '</textarea></div>';
            break;
        case 'quiz':
            var qs = d.questions || [];
            html += '<div class="prop-group"><label>Preguntas (' + qs.length + ')</label>';
            qs.forEach(function(q, idx) {
                html += '<div style="padding:6px;background:var(--surface2);border-radius:4px;margin-bottom:6px;font-size:11px">';
                html += '<div style="display:flex;gap:4px;margin-bottom:4px"><input value="' + esc(q.pregunta||'') + '" onchange="updateQuizQ(' + idx + ',this.value)" placeholder="Pregunta" style="flex:1;padding:4px 6px;background:var(--surface);border:1px solid var(--border);border-radius:3px;color:var(--text);font-size:11px">';
                html += '<button onclick="removeQuizQ(' + idx + ')" style="padding:2px 6px;background:var(--surface);border:1px solid var(--border);border-radius:3px;color:var(--red);cursor:pointer">✕</button></div>';
                var opts = q.opciones || q.options || [];
                opts.forEach(function(o, oi) {
                    var is_c = o === (q.correcta||'');
                    html += '<div style="display:flex;gap:4px;margin:2px 0"><input value="' + esc(o) + '" onchange="updateQuizOpt(' + idx + ',' + oi + ',this.value)" style="flex:1;padding:2px 6px;background:var(--surface);border:1px solid var(--border);border-radius:3px;color:var(--text);font-size:10px">';
                    html += '<input type="radio" name="q' + idx + '_correct" ' + (is_c?'checked':'') + ' onchange="setQuizCorrect(' + idx + ',' + oi + ')" title="Correcta">';
                    html += '<button onclick="removeQuizOpt(' + idx + ',' + oi + ')" style="padding:2px 6px;background:var(--surface);border:1px solid var(--border);border-radius:3px;color:var(--red);cursor:pointer">✕</button></div>';
                });
                html += '<button onclick="addQuizOpt(' + idx + ')" style="padding:2px 8px;background:var(--surface2);border:1px solid var(--border);border-radius:3px;color:var(--cyan);font-size:10px;cursor:pointer;margin-top:2px">+ Opci&oacute;n</button>';
                html += '</div>';
            });
            html += '<button onclick="addQuizQ()" style="padding:4px 10px;background:var(--surface2);border:1px solid var(--border);border-radius:4px;color:var(--cyan);font-size:11px;cursor:pointer">+ Pregunta</button></div>';
            break;
    }
    html += '<div style="margin-top:16px;padding-top:12px;border-top:1px solid var(--border)">';
    html += '<div class="prop-group"><label>Fondo</label><input type="color" value="' + (d.bg||'#0c1220') + '" onchange="updateProp(\'bg\',this.value)"></div>';
    html += '<div class="prop-group"><label>Color texto</label><input type="color" value="' + (d.textColor||'#e8f4ff') + '" onchange="updateProp(\'textColor\',this.value)"></div>';
    html += '<div class="prop-group"><label>Alineaci&oacute;n</label><select onchange="updateProp(\'textAlign\',this.value)"><option value="">Auto</option><option value="left" ' + (d.textAlign==='left'?'selected':'') + '>Izquierda</option><option value="center" ' + (d.textAlign==='center'?'selected':'') + '>Centro</option><option value="right" ' + (d.textAlign==='right'?'selected':'') + '>Derecha</option></select></div>';
    html += '<div class="prop-group"><label>Padding</label><input value="' + esc(d.padding||'') + '" onchange="updateProp(\'padding\',this.value)" placeholder="ej. 12px"></div>';
    html += '</div>';
    panel.innerHTML = html;
}

function renderInlinePanel() {
    var panel = document.getElementById('inlineElementPanel');
    if (!activeInlineEl || !document.body.contains(activeInlineEl)) {
        activeInlineEl = null;
        if (panel) { panel.innerHTML = ''; panel.style.display = 'none'; }
        return;
    }
    var el = activeInlineEl;
    var tag = el.tagName.toLowerCase();
    var cs = getComputedStyle(el);
    var html = '<div style="display:flex;align-items:center;gap:6px;margin-bottom:8px">';
    html += '<h3 style="margin:0;flex:1">Elemento seleccionado</h3>';
    html += '<span class="inline-tag">&lt;' + tag + '&gt;</span></div>';

    html += '<div class="inline-style-group"><label>Tamaño</label>';
    html += '<select onchange="applyInlineStyle(\'fontSize\',this.value)">';
    var sizes = [10,12,14,16,18,20,24,28,32,36,42,48];
    var curSize = parseInt(cs.fontSize);
    for (var si=0; si<sizes.length; si++) {
        var s = sizes[si];
        html += '<option value="' + s + 'px" ' + (Math.abs(curSize-s)<3?'selected':'') + '>' + s + '</option>';
    }
    html += '</select></div>';

    html += '<div class="inline-style-group" style="gap:2px"><label>Formato</label>';
    var isBold = (cs.fontWeight >= 700 || cs.fontWeight === 'bold');
    var isItalic = (cs.fontStyle === 'italic');
    var isUnderline = (cs.textDecoration.indexOf('underline') !== -1);
    html += '<div class="style-btn-row">';
    html += '<button class="' + (isBold?'active':'') + '" onclick="execInlineCmd(\'bold\')" title="Negrita"><strong>B</strong></button>';
    html += '<button class="' + (isItalic?'active':'') + '" onclick="execInlineCmd(\'italic\')" title="Cursiva"><em>I</em></button>';
    html += '<button class="' + (isUnderline?'active':'') + '" onclick="execInlineCmd(\'underline\')" title="Subrayado"><u>U</u></button>';
    html += '</div></div>';

    html += '<div class="inline-style-group"><label>Color texto</label>';
    html += '<input type="color" value="' + rgbToHex(cs.color) + '" onchange="execInlineCmd(\'foreColor\',this.value)" oninput="execInlineCmd(\'foreColor\',this.value)">';
    html += '<label style="min-width:auto;margin-left:8px">Fondo</label>';
    html += '<input type="color" value="' + rgbToHex(cs.backgroundColor) + '" onchange="execInlineCmd(\'hiliteColor\',this.value)" oninput="execInlineCmd(\'hiliteColor\',this.value)">';
    html += '</div>';

    html += '<div class="inline-style-group"><label>Alineación</label>';
    html += '<select onchange="applyInlineStyle(\'textAlign\',this.value)">';
    var aligns = [['left','Izquierda'],['center','Centro'],['right','Derecha'],['justify','Justificado']];
    for (var ai=0; ai<aligns.length; ai++) {
        var a = aligns[ai];
        html += '<option value="' + a[0] + '" ' + (cs.textAlign===a[0]?'selected':'') + '>' + a[1] + '</option>';
    }
    html += '</select></div>';

    panel.innerHTML = html;
    panel.style.display = 'block';
}

function rgbToHex(rgb) {
    var m = String(rgb).match(/rgba?\((\d+),\s*(\d+),\s*(\d+)/i);
    if (m) {
        var r = Math.min(255,Math.max(0,parseInt(m[1])));
        var g = Math.min(255,Math.max(0,parseInt(m[2])));
        var b = Math.min(255,Math.max(0,parseInt(m[3])));
        return '#' + (r<16?'0':'') + r.toString(16) + (g<16?'0':'') + g.toString(16) + (b<16?'0':'') + b.toString(16);
    }
    return '#e8f4ff';
}

function applyInlineStyle(prop, val) {
    if (!activeInlineEl || !document.body.contains(activeInlineEl)) return;
    activeInlineEl.style[prop] = val;
    captureInlineHtml();
    renderInlinePanel();
}

function execInlineCmd(cmd, val) {
    if (!activeInlineEl || !document.body.contains(activeInlineEl)) return;
    activeInlineEl.focus();
    var sel = window.getSelection();
    if (!sel.rangeCount || !activeInlineEl.contains(sel.getAnchorNode())) {
        var range = document.createRange();
        range.selectNodeContents(activeInlineEl);
        range.collapse(false);
        sel.removeAllRanges();
        sel.addRange(range);
    }
    document.execCommand(cmd, false, val || null);
    captureInlineHtml();
    setTimeout(renderInlinePanel, 50);
}

function captureInlineHtml() {
    if (!activeInlineEl || !document.body.contains(activeInlineEl)) return;
    var wrap = activeInlineEl.closest('.block-wrap');
    if (!wrap) return;
    var id = wrap.id.replace('bw_', '');
    var b = blocks.find(function(x) { return x.id === id; });
    if (!b) return;
    if (!b.data) b.data = {};
    var key = activeInlineEl.getAttribute('data-edit');
    if (key === 'html') {
        b.data.html = wrap.querySelector('.block-live[data-edit="html"]').innerHTML;
    } else if (key === 'text') {
        b.data.html = activeInlineEl.innerHTML;
        b.data.text = activeInlineEl.textContent;
    } else if (key && key.indexOf(':') !== -1) {
        var parts = key.split(':');
        var field = parts[0];
        if (field === 'items') {
            if (!b.data.items) b.data.items = [];
            b.data.items[+parts[1]] = activeInlineEl.textContent;
        } else if (field === 'headers') {
            if (!b.data.headers) b.data.headers = [];
            b.data.headers[+parts[1]] = activeInlineEl.textContent;
        } else if (field === 'rows') {
            if (!b.data.rows) b.data.rows = [];
            if (!b.data.rows[+parts[1]]) b.data.rows[+parts[1]] = [];
            b.data.rows[+parts[1]][+parts[2]] = activeInlineEl.textContent;
        }
    } else if (key) {
        b.data[key] = activeInlineEl.textContent;
    }
    renderProps();
}

function propText(key, label, val) {
    return '<div class="prop-group"><label>' + label + '</label><input value="' + esc(val) + '" onchange="updateProp(\'' + key + '\',this.value)"></div>';
}
function propArea(key, label, val) {
    return '<div class="prop-group"><label>' + label + '</label><textarea onchange="updateProp(\'' + key + '\',this.value)">' + esc(val) + '</textarea></div>';
}
function propSelect(key, label, opts, val) {
    var h = '<div class="prop-group"><label>' + label + '</label><select onchange="updateProp(\'' + key + '\',this.value)">';
    for (var k in opts) { h += '<option value="' + k + '" ' + (String(val)===String(k)?'selected':'') + '>' + opts[k] + '</option>'; }
    return h + '</select></div>';
}
function propColor(key, label, val) {
    var hex = val.replace('var(--cyan)','#00e5ff').replace('var(--green)','#00ff87').replace('var(--yellow)','#ffd23f').replace('var(--pink)','#ff3cac').replace('var(--red)','#ff3333');
    return '<div class="prop-group"><label>' + label + '</label><input type="color" value="' + hex + '" onchange="updateProp(\'' + key + '\',this.value)"></div>';
}

function updateProp(key, val) {
    if (!selectedId) return;
    var b = blocks.find(function(x) { return x.id === selectedId; });
    if (!b) return;
    if (!b.data) b.data = {};
    b.data[key] = val;
    render();
}

function addBlock(tipo) {
    commitPendingEdits();
    var host = (savedHost && document.body.contains(savedHost)) ? savedHost : null;
    if (!host) {
        var mainHtmlBlock = blocks.find(function(x) { return x.tipo === 'html'; });
        if (mainHtmlBlock) host = document.querySelector('#bw_' + mainHtmlBlock.id + ' .block-live[data-edit="html"]');
    }
    if (host) {
        var snippet = staticSnippetForType(tipo);
        if (snippet === null) return;
        var range = (savedHost === host && savedRange) ? savedRange : makeRangeAtEnd(host);
        insertIntoHtmlHost(snippet, host, range);
        return;
    }

    var b = { id: genId(), tipo: tipo, data: defaultData(tipo) };
    if (selectedId) {
        var idx = blocks.findIndex(function(x) { return x.id === selectedId; });
        blocks.splice(idx + 1, 0, b);
    } else {
        blocks.push(b);
    }
    selectedId = b.id;
    render();
    setTimeout(function() { var el = document.getElementById('bw_' + b.id); if (el) el.scrollIntoView({behavior:'smooth',block:'center'}); }, 50);
}

function makeRangeAtEnd(el) {
    var range = document.createRange();
    range.selectNodeContents(el);
    range.collapse(false);
    return range;
}

function insertIntoHtmlHost(snippetHtml, host, range) {
    host.focus();
    var sel = window.getSelection();
    sel.removeAllRanges();
    try { sel.addRange(range); } catch (e) {}
    var ok = false;
    try { ok = document.execCommand('insertHTML', false, snippetHtml); } catch (e) {}
    if (!ok) { host.insertAdjacentHTML('beforeend', snippetHtml); }

    var wrap = host.closest('.block-wrap');
    if (wrap) {
        var id = wrap.id.replace('bw_', '');
        var b = blocks.find(function(x) { return x.id === id; });
        if (b) { if (!b.data) b.data = {}; b.data.html = host.innerHTML; }
    }
    var sel2 = window.getSelection();
    if (sel2.rangeCount) { savedRange = sel2.getRangeAt(0).cloneRange(); savedHost = host; }
    host.scrollIntoView({behavior:'smooth', block:'nearest'});
}

function staticSnippetForType(tipo) {
    switch (tipo) {
        case 'heading': return '<h2 style="font-size:20px;font-weight:700;color:var(--text);margin:8px 0">Nuevo t\u00edtulo</h2>';
        case 'text': return '<p style="color:var(--text);line-height:1.7;margin:6px 0">Escribe tu texto aqu\u00ed...</p>';
        case 'image': var src = prompt('URL de la imagen:', ''); if (src === null) return null; return '<figure style="margin:10px 0"><img src="' + esc(src) + '" style="max-width:100%;border-radius:8px"></figure>';
        case 'video': var url = prompt('URL de YouTube:', ''); if (url === null) return null; var vid = ''; var m = url.match(/(?:youtube\.com\/watch\?v=|youtu\.be\/)([a-zA-Z0-9_-]+)/); if (m) vid = m[1]; return '<div style="position:relative;padding-bottom:56.25%;height:0;overflow:hidden;border-radius:8px;margin:10px 0;background:var(--surface2)">' + (vid ? '<iframe src="https://www.youtube.com/embed/' + vid + '" style="position:absolute;top:0;left:0;width:100%;height:100%;border:0" allowfullscreen></iframe>' : '') + '</div>';
        case 'list': return '<ul style="margin:6px 0;padding-left:20px;line-height:1.7;color:var(--text)"><li>Item 1</li><li>Item 2</li><li>Item 3</li></ul>';
        case 'table': return '<div style="overflow-x:auto;margin:10px 0"><table style="width:100%;border-collapse:collapse;font-size:13px"><thead><tr><th style="padding:8px 12px;border:1px solid var(--border);background:var(--surface2);color:var(--cyan);font-weight:600;font-size:12px">Col 1</th><th style="padding:8px 12px;border:1px solid var(--border);background:var(--surface2);color:var(--cyan);font-weight:600;font-size:12px">Col 2</th></tr></thead><tbody><tr><td style="padding:8px 12px;border:1px solid var(--border);font-size:12px">&nbsp;</td><td style="padding:8px 12px;border:1px solid var(--border);font-size:12px">&nbsp;</td></tr></tbody></table></div>';
        case 'card': return '<div style="display:flex;gap:12px;padding:16px;background:var(--surface2);border-radius:12px;border-left:4px solid var(--cyan);margin:10px 0"><div style="font-size:28px;flex-shrink:0">💡</div><div><div style="font-weight:600;color:var(--cyan);font-size:14px">T\u00edtulo</div><p style="margin:4px 0 0;color:var(--muted);font-size:13px">Descripci\u00f3n...</p></div></div>';
        case 'alert': return '<div style="padding:12px 16px;border-radius:8px;margin:10px 0;font-size:14px;background:var(--cyan)15;border:1px solid var(--cyan)35;color:var(--text)">ℹ️ Mensaje de alerta</div>';
        case 'divider': return '<hr style="border:none;border-top:1px solid var(--border);margin:16px 0">';
        case 'columns': return '<div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin:10px 0"><div style="padding:12px;background:var(--surface);border-radius:8px;border:1px dashed var(--border);min-height:40px">&nbsp;</div><div style="padding:12px;background:var(--surface);border-radius:8px;border:1px dashed var(--border);min-height:40px">&nbsp;</div></div>';
        case 'quiz': return '<div style="padding:14px;background:var(--surface2);border-radius:8px;margin:10px 0;border:1px solid var(--border)"><div style="font-weight:600;margin-bottom:8px;font-size:14px">1. \u00bfPregunta?</div><label style="display:block;padding:6px 10px;margin:4px 0;border-radius:6px;background:var(--green)20;border:1px solid var(--green)40;font-size:13px"><input type="radio" disabled checked style="margin-right:8px">Opci\u00f3n correcta ✅</label><label style="display:block;padding:6px 10px;margin:4px 0;border-radius:6px;background:var(--surface);border:1px solid var(--border);font-size:13px"><input type="radio" disabled style="margin-right:8px">Otra opci\u00f3n</label></div>';
        case 'html': var raw = prompt('Pega el HTML a insertar:', ''); if (raw === null) return null; return raw;
        default: return '<p>&nbsp;</p>';
    }
}

function defaultData(tipo) {
    switch(tipo) {
        case 'heading': return {level:'2',text:'Nuevo t&iacute;tulo'};
        case 'text': return {text:'Escribe tu texto aqu&iacute;...'};
        case 'image': return {src:'',alt:'',caption:''};
        case 'video': return {url:''};
        case 'list': return {items:['Item 1','Item 2','Item 3'],ordered:false};
        case 'table': return {headers:['Col 1','Col 2'],rows:[['','']]};
        case 'card': return {icon:'💡',title:'T&iacute;tulo',text:'Descripci&oacute;n...',color:'var(--cyan)'};
        case 'alert': return {type:'info',text:'Mensaje de alerta'};
        case 'divider': return {};
        case 'columns': return {columns:[{blocks:[]},{blocks:[]}]};
        case 'quiz': return {questions:[{pregunta:'¿Pregunta?',opciones:['Opci&oacute;n 1','Opci&oacute;n 2'],correcta:'Opci&oacute;n 1'}]};
        case 'html': return {html:'<p>Contenido HTML aqu&iacute;...</p>'};
        default: return {text:''};
    }
}

function moveBlock(idx, dir) {
    commitPendingEdits();
    var newIdx = idx + dir;
    if (newIdx < 0 || newIdx >= blocks.length) return;
    var temp = blocks[idx];
    blocks[idx] = blocks[newIdx];
    blocks[newIdx] = temp;
    render();
}

function deleteBlock(idx) {
    commitPendingEdits();
    if (!confirm('¿Eliminar este bloque?')) return;
    if (blocks[idx] && blocks[idx].id === selectedId) selectedId = null;
    blocks.splice(idx, 1);
    render();
}

function duplicarBlock(idx) {
    commitPendingEdits();
    var original = blocks[idx];
    if (!original) return;
    var copy = JSON.parse(JSON.stringify(original));
    copy.id = genId();
    blocks.splice(idx + 1, 0, copy);
    selectedId = copy.id;
    render();
}

// ---- DRAG & DROP MEJORADO (posicionamiento libre entre bloques) ----
var dragSourceIndex = -1;
var dragPaletteType = null;
var lastDropY = 0;
var dropIndicator = document.getElementById('dropIndicator');

function getInsertIndexFromPoint(clientY) {
    var wraps = document.querySelectorAll('#canvas .block-wrap');
    if (wraps.length === 0) return 0;
    for (var i = 0; i < wraps.length; i++) {
        var rect = wraps[i].getBoundingClientRect();
        var midY = rect.top + rect.height / 2;
        if (clientY < midY) return i;
    }
    return wraps.length;
}

function showDropIndicatorAt(clientY) {
    if (!dropIndicator) return;
    var canvas = document.getElementById('canvas');
    var canvasRect = canvas.getBoundingClientRect();
    var wraps = document.querySelectorAll('#canvas .block-wrap');
    var top = canvasRect.top;
    var indicatorTop;
    if (wraps.length === 0) {
        indicatorTop = top + 30;
    } else {
        var idx = getInsertIndexFromPoint(clientY);
        if (idx === 0) {
            indicatorTop = wraps[0].getBoundingClientRect().top - 2;
        } else if (idx >= wraps.length) {
            var lastRect = wraps[wraps.length-1].getBoundingClientRect();
            indicatorTop = lastRect.bottom + 2;
        } else {
            indicatorTop = wraps[idx].getBoundingClientRect().top - 2;
        }
    }
    indicatorTop = indicatorTop - canvasRect.top;
    dropIndicator.style.top = indicatorTop + 'px';
    dropIndicator.classList.add('show');
}

function hideDropIndicator() {
    if (dropIndicator) dropIndicator.classList.remove('show');
}

function initDragDrop() {
    var canvas = document.getElementById('canvas');
    var palette = document.querySelector('.builder-palette');
    if (!canvas) return;

    if (palette) {
        palette.addEventListener('dragstart', function(e) {
            var palItem = e.target.closest('.palette-block');
            if (!palItem) { e.preventDefault(); return; }
            dragPaletteType = palItem.getAttribute('data-block-type');
            e.dataTransfer.effectAllowed = 'copy';
            e.dataTransfer.setData('text/plain', 'palette:' + dragPaletteType);
            palItem.style.opacity = '0.5';
        });
        palette.addEventListener('dragend', function(e) {
            dragPaletteType = null;
            var palItem = e.target.closest('.palette-block');
            if (palItem) palItem.style.opacity = '';
            hideDropIndicator();
        });
    }

    canvas.addEventListener('dragstart', function(e) {
        var wrap = e.target.closest('.block-wrap');
        if (!wrap) { e.preventDefault(); return; }
        var idx = parseInt(wrap.getAttribute('data-index'));
        if (isNaN(idx)) { e.preventDefault(); return; }
        dragSourceIndex = idx;
        e.dataTransfer.effectAllowed = 'move';
        e.dataTransfer.setData('text/plain', 'reorder:' + idx);
        wrap.classList.add('dragging');
    });

    canvas.addEventListener('dragend', function(e) {
        document.querySelectorAll('.block-wrap').forEach(function(w) {
            w.classList.remove('dragging', 'drag-over');
        });
        dragSourceIndex = -1;
        dragPaletteType = null;
        hideDropIndicator();
    });

    canvas.addEventListener('dragover', function(e) {
        e.preventDefault();
        e.dataTransfer.dropEffect = dragPaletteType ? 'copy' : 'move';
        var y = e.clientY;
        showDropIndicatorAt(y);
    });

    canvas.addEventListener('dragleave', function(e) {
        if (e.target === canvas) hideDropIndicator();
    });

    canvas.addEventListener('drop', function(e) {
        e.preventDefault();
        hideDropIndicator();
        document.querySelectorAll('.block-wrap').forEach(function(w) {
            w.classList.remove('dragging', 'drag-over');
        });
        commitPendingEdits();

        var targetIdx = getInsertIndexFromPoint(e.clientY);

        if (dragPaletteType) {
            var b = { id: genId(), tipo: dragPaletteType, data: defaultData(dragPaletteType) || {} };
            blocks.splice(targetIdx, 0, b);
            selectedId = b.id;
            render();
            setTimeout(function() {
                var el = document.getElementById('bw_' + b.id);
                if (el) el.scrollIntoView({behavior:'smooth', block:'center'});
            }, 50);
            return;
        }

        if (dragSourceIndex < 0) return;
        if (dragSourceIndex === targetIdx) return;
        var temp = blocks[dragSourceIndex];
        blocks.splice(dragSourceIndex, 1);
        var insertAt = dragSourceIndex < targetIdx ? targetIdx - 1 : targetIdx;
        if (insertAt < 0) insertAt = 0;
        if (insertAt > blocks.length) insertAt = blocks.length;
        blocks.splice(insertAt, 0, temp);
        selectedId = temp.id;
        render();
    });
}

// List helpers
function addListItem() { commitPendingEdits(); var b = getSelBlock(); if (!b) return; if (!b.data.items) b.data.items = []; b.data.items.push(''); render(); }
function removeListItem(idx) { commitPendingEdits(); var b = getSelBlock(); if (!b) return; b.data.items.splice(idx,1); render(); }
function getSelBlock() { return blocks.find(function(x) { return x.id === selectedId; }); }

// Quiz helpers
function addQuizQ() { var b = getSelBlock(); if (!b) return; (b.data.questions||[]).push({pregunta:'',opciones:['',''],correcta:''}); render(); }
function removeQuizQ(idx) { var b = getSelBlock(); if (!b) return; b.data.questions.splice(idx,1); render(); }
function updateQuizQ(idx, val) { var b = getSelBlock(); if (!b) return; b.data.questions[idx].pregunta=val; render(); }
function addQuizOpt(qIdx) { var b=getSelBlock(); if(!b)return; (b.data.questions[qIdx].opciones||b.data.questions[qIdx].options||[]).push(''); render(); }
function removeQuizOpt(qIdx, oIdx) { var b=getSelBlock(); if(!b)return; var opts=b.data.questions[qIdx].opciones||b.data.questions[qIdx].options||[]; opts.splice(oIdx,1); render(); }
function updateQuizOpt(qIdx, oIdx, val) { var b=getSelBlock(); if(!b)return; var opts=b.data.questions[qIdx].opciones||b.data.questions[qIdx].options||[]; opts[oIdx]=val; render(); }
function setQuizCorrect(qIdx, oIdx) { var b=getSelBlock(); if(!b)return; var opts=b.data.questions[qIdx].opciones||b.data.questions[qIdx].options||[]; b.data.questions[qIdx].correcta=opts[oIdx]; render(); }

function updateColCount(n) {
    var b = getSelBlock(); if (!b) return;
    var cur = b.data.columns || [{blocks:[]}];
    while (cur.length < n) cur.push({blocks:[]});
    if (cur.length > n) cur = cur.slice(0, n);
    b.data.columns = cur;
    render();
}

function toggleHtmlCode() {
    var box = document.getElementById('htmlCodeBox');
    if (box) box.style.display = (box.style.display === 'none' ? 'block' : 'none');
}

function guardar() {
    commitPendingEdits();
    var json = JSON.stringify(blocks);
    var f = document.createElement('form');
    f.method = 'post';
    f.innerHTML = '<?= campoTokenCSRF() ?><input type="hidden" name="accion" value="guardar"><input type="hidden" name="blocks_json" value="' + esc(json) + '">';
    document.body.appendChild(f);
    f.submit();
}

function confirmRestore() {
    if (!confirm('¿Restaurar contenido original? Se perder&aacute;n todos los cambios.')) return;
    var f = document.createElement('form');
    f.method = 'post';
    f.innerHTML = '<?= campoTokenCSRF() ?><input type="hidden" name="accion" value="restaurar">';
    document.body.appendChild(f);
    f.submit();
}

// AI Chat
function toggleChat() {
    var panel = document.getElementById('chatPanel');
    var btn = document.getElementById('chatToggleBtn');
    panel.classList.toggle('collapsed');
    btn.classList.toggle('open');
}

// Chat resize
function initChatResize() {
    var handle = document.getElementById('chatResizeHandle');
    var panel = document.getElementById('chatPanel');
    if (!handle || !panel) return;
    var startY, startH;
    handle.addEventListener('mousedown', function(e) {
        if (panel.classList.contains('collapsed')) return;
        e.preventDefault();
        startY = e.clientY;
        startH = panel.offsetHeight;
        panel.style.transition = 'none';
        panel.style.maxHeight = 'none';
        document.body.style.cursor = 'ns-resize';
        document.body.style.userSelect = 'none';
        function onMove(ev) {
            var delta = startY - ev.clientY;
            var newH = Math.max(60, startH + delta);
            panel.style.height = newH + 'px';
            panel.style.maxHeight = newH + 'px';
        }
        function onUp() {
            panel.style.transition = '';
            document.body.style.cursor = '';
            document.body.style.userSelect = '';
            document.removeEventListener('mousemove', onMove);
            document.removeEventListener('mouseup', onUp);
        }
        document.addEventListener('mousemove', onMove);
        document.addEventListener('mouseup', onUp);
    });
}

function enviarChat() {
    var input = document.getElementById('chatInput');
    var msg = input.value.trim();
    if (!msg) return;
    input.value = '';
    var btn = document.getElementById('chatSendBtn');
    btn.disabled = true;
    setChatStatus('Escribiendo...');
    addChatMsg('user', msg);

    var typingId = 'typing_' + Date.now();
    var typingDiv = document.createElement('div');
    typingDiv.className = 'msg ai';
    typingDiv.id = typingId;
    typingDiv.innerHTML = '<span class="msg-label">Asistente</span><div class="msg-text"><span class="typing-dots"><span></span><span></span><span></span></span></div>';
    document.getElementById('chatMsgs').appendChild(typingDiv);
    typingDiv.scrollIntoView({behavior:'smooth',block:'end'});

    var xhr = new XMLHttpRequest();
    xhr.open('POST', '', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        var typingEl = document.getElementById(typingId);
        if (typingEl) typingEl.remove();
        try {
            var d = JSON.parse(xhr.responseText);
            addChatMsg('ai', d.response || 'Sin respuesta.');
        } catch(e) {
            addChatMsg('error', 'Error al procesar la respuesta del servidor.');
        }
        btn.disabled = false;
        setChatStatus('Preg&uacute;ntame lo que necesites');
    };

    xhr.onerror = function() {
        var typingEl2 = document.getElementById(typingId);
        if (typingEl2) typingEl2.remove();
        addChatMsg('error', 'Error de conexi&oacute;n. Verifica tu red e int&eacute;ntalo de nuevo.');
        btn.disabled = false;
        setChatStatus('Error de conexi&oacute;n');
    };

    xhr.send('accion=ai_chat&csrf_token=' + encodeURIComponent('<?= csrfToken() ?>') + '&prompt=' + encodeURIComponent(msg) + '&blocks_json=' + encodeURIComponent(JSON.stringify(blocks)));
    input.focus();
}

function addChatMsg(role, text) {
    var div = document.createElement('div');
    div.className = 'msg ' + role;
    if (role === 'ai') {
        var parsed = parseAIInsert(text);
        var displayText = parsed.text;
        div.innerHTML = '<span class="msg-label">Asistente</span><div class="msg-text">' + displayText.replace(/\n/g, '<br>') + '</div>';
        if (parsed.blocks || parsed.html) {
            var btnDiv = document.createElement('div');
            if (parsed.blocks) {
                var b = document.createElement('button');
                b.className = 'msg-insert-btn';
                b.textContent = 'Insertar ' + parsed.blocks.length + ' bloque(s)';
                b.onclick = function() { insertBlocksFromAI(parsed.blocks); };
                btnDiv.appendChild(b);
            }
            if (parsed.html) {
                var b2 = document.createElement('button');
                b2.className = 'msg-insert-btn';
                b2.textContent = 'Insertar HTML';
                b2.style.marginLeft = '6px';
                b2.onclick = function() { insertHtmlFromAI(parsed.html); };
                btnDiv.appendChild(b2);
            }
            div.appendChild(btnDiv);
        }
    } else if (role === 'user') {
        div.innerHTML = '<span class="msg-label">T&uacute;</span><div class="msg-text">' + esc(text).replace(/\n/g, '<br>') + '</div>';
    } else {
        div.innerHTML = '<span class="msg-label">Error</span><div class="msg-text">' + text + '</div>';
    }
    document.getElementById('chatMsgs').appendChild(div);
    div.scrollIntoView({behavior:'smooth',block:'end'});
}

function parseAIInsert(text) {
    var result = { text: text, blocks: null, html: null };
    var blockMatch = text.match(/\[insertBlocks\]([\s\S]*?)\[\/insertBlocks\]/);
    if (blockMatch) {
        try {
            var parsed = JSON.parse(blockMatch[1]);
            if (Array.isArray(parsed)) {
                result.blocks = parsed;
                result.text = text.replace(blockMatch[0], '').trim();
            }
        } catch(e) {}
    }
    var htmlMatch = text.match(/\[insertHtml\]([\s\S]*?)\[\/insertHtml\]/);
    if (htmlMatch) {
        result.html = htmlMatch[1].trim();
        result.text = result.text.replace(htmlMatch[0], '').trim();
    }
    return result;
}

function insertBlocksFromAI(newBlocks) {
    commitPendingEdits();
    if (!Array.isArray(newBlocks) || !newBlocks.length) return;
    newBlocks.forEach(function(b) {
        if (!b.id) b.id = genId();
        if (!b.data) b.data = defaultData(b.tipo) || {};
    });
    if (selectedId) {
        var idx = blocks.findIndex(function(x) { return x.id === selectedId; });
        blocks.splice.apply(blocks, [idx + 1, 0].concat(newBlocks));
    } else {
        blocks = blocks.concat(newBlocks);
    }
    selectedId = newBlocks[newBlocks.length - 1].id;
    render();
    addChatMsg('ai', '✅ ' + newBlocks.length + ' bloque(s) insertado(s) en la lecci&oacute;n.');
}

function insertHtmlFromAI(html) {
    commitPendingEdits();
    var b = { id: genId(), tipo: 'html', data: { html: html } };
    if (selectedId) {
        var idx = blocks.findIndex(function(x) { return x.id === selectedId; });
        blocks.splice(idx + 1, 0, b);
    } else {
        blocks.push(b);
    }
    selectedId = b.id;
    render();
    addChatMsg('ai', '✅ HTML insertado en la lecci&oacute;n.');
}

function setChatStatus(text) {
    var el = document.getElementById('chatStatus');
    if (el) el.innerHTML = text;
}

function limpiarChat() {
    if (!confirm('¿Limpiar todos los mensajes del chat?')) return;
    var container = document.getElementById('chatMsgs');
    container.innerHTML = '<div class="msg ai"><span class="msg-label">Asistente</span><div class="msg-text">Chat limpiado. ¿Necesitas ayuda?</div></div>';
}

// ---- Edici&oacute;n in-place ----
function applyInlineEdit(el) {
    var wrap = el.closest('.block-wrap');
    if (!wrap) return;
    var id = wrap.id.replace('bw_', '');
    var b = blocks.find(function(x) { return x.id === id; });
    if (!b) return;
    if (!b.data) b.data = {};
    var key = el.getAttribute('data-edit');
    if (!key) return;
    var parts = key.split(':');
    var field = parts[0];
    if (field === 'html') {
        b.data.html = el.innerHTML;
    } else if (field === 'text') {
        b.data.text = el.textContent;
        b.data.html = el.innerHTML;
    } else if (field === 'items') {
        if (!b.data.items) b.data.items = [];
        b.data.items[+parts[1]] = el.textContent;
    } else if (field === 'headers') {
        if (!b.data.headers) b.data.headers = [];
        b.data.headers[+parts[1]] = el.textContent;
    } else if (field === 'rows') {
        if (!b.data.rows) b.data.rows = [];
        if (!b.data.rows[+parts[1]]) b.data.rows[+parts[1]] = [];
        b.data.rows[+parts[1]][+parts[2]] = el.textContent;
    } else {
        b.data[field] = el.textContent;
    }
    if (field === 'html') {
        renderProps();
    } else {
        render();
    }
}

function commitPendingEdits() {
    var active = document.activeElement;
    if (active && active.hasAttribute && active.hasAttribute('data-edit')) {
        active.blur();
    }
}

(function initCanvasEditing() {
    var canvas = document.getElementById('canvas');
    if (!canvas) return;

    canvas.addEventListener('focusout', function(e) {
        if (e.target.hasAttribute && e.target.hasAttribute('data-edit')) {
            applyInlineEdit(e.target);
        }
        setTimeout(function() {
            if (activeInlineEl && !activeInlineEl.contains(document.activeElement)) {
                activeInlineEl = null;
                renderInlinePanel();
            }
        }, 10);
    });

    canvas.addEventListener('focusin', function(e) {
        var wrap = e.target.closest('.block-wrap');
        if (wrap) {
            var id = wrap.id.replace('bw_', '');
            if (id !== selectedId) selectBlockLight(id);
        }
        // Detectar elemento individual incluso dentro de HTML genérico
        var editEl = e.target.closest('[data-edit]');
        if (!editEl) {
            // Si está dentro de un bloque html, tomar el elemento exacto si es significativo
            var htmlHost = e.target.closest('[data-edit="html"]');
            if (htmlHost && e.target !== htmlHost && /^(p|h[1-6]|div|span|a|strong|em|u|s|li|blockquote|pre|code)$/i.test(e.target.tagName)) {
                editEl = e.target;
            } else if (htmlHost) {
                editEl = htmlHost;
            }
        }
        if (editEl) {
            activeInlineEl = editEl;
            renderInlinePanel();
        }
    });

    canvas.addEventListener('click', function(e) {
        var a = e.target.closest('a');
        if (a && e.target.closest('[contenteditable="true"]')) { e.preventDefault(); return; }
        var editEl = e.target.closest('[data-edit]');
        if (!editEl) {
            var htmlHost = e.target.closest('[data-edit="html"]');
            if (htmlHost && e.target !== htmlHost && /^(p|h[1-6]|div|span|a|strong|em|u|s|li|blockquote|pre|code)$/i.test(e.target.tagName)) {
                editEl = e.target;
            } else if (htmlHost) {
                editEl = htmlHost;
            }
        }
        if (editEl) {
            activeInlineEl = editEl;
            renderInlinePanel();
        }
    });

    canvas.addEventListener('keydown', function(e) {
        if (e.key === 'Enter' && e.target.getAttribute && e.target.getAttribute('data-singleline') === '1') {
            e.preventDefault();
            e.target.blur();
        }
        if (e.key === 'Escape' && activeInlineEl) {
            activeInlineEl = null;
            renderInlinePanel();
        }
    });

    canvas.addEventListener('dblclick', function(e) {
        var img = e.target.closest('img');
        var host = img && img.closest('[data-edit="html"]');
        if (img && host) {
            var nueva = prompt('Nueva URL de la imagen:', img.getAttribute('src') || '');
            if (nueva !== null) {
                img.setAttribute('src', nueva);
                applyInlineEdit(host);
            }
        }
    });
})();

initDragDrop();
initChatResize();

document.addEventListener('keydown', function(e) {
    if (e.key === 'Delete' && selectedId && !(document.activeElement && document.activeElement.hasAttribute && document.activeElement.hasAttribute('data-edit'))) {
        var idx = blocks.findIndex(function(x) { return x.id === selectedId; });
        if (idx >= 0) deleteBlock(idx);
    }
    if ((e.ctrlKey || e.metaKey) && e.key === 's') { e.preventDefault(); guardar(); }
});

render();
</script>
<?php require __DIR__ . '/../../src/Templates/page_end.php'; ?>