<?php
require_once __DIR__ . '/../src/Config/config.php';
requireLogin(true);

$supported_langs = ['es', 'en'];
if (isset($_GET['lang']) && in_array($_GET['lang'], $supported_langs, true)) {
    $_SESSION['lang'] = $_GET['lang'];
}
$lang = $_SESSION['lang'] ?? 'es';
if (!in_array($lang, $supported_langs, true)) $lang = 'es';
$t = [
  'es' => [
    'title'=>'Comunidad LC-ADVANCE','newpost'=>'Nuevo Post','search'=>'Buscar en comunidad...',
    'placeholder_title'=>'Título del post','placeholder_body'=>'Escribe tu mensaje...','placeholder_user'=>'Tu nombre',
    'publish'=>'Publicar','cancel'=>'Cancelar','popular'=>'Populares','members'=>'Miembros Activos',
    'rules'=>'Reglas de la Comunidad','rule1'=>'Sé respetuoso','rule2'=>'Sin spam',
    'rule3'=>'Mantén el tema','comments'=>'Comentarios','share'=>'Copiar enlace',
    'copied'=>'¡Enlace copiado!','empty'=>'Sé el primero en publicar','upvote'=>'Upvote',
    'downvote'=>'Downvote','reply'=>'Responder','delete'=>'Eliminar','edit'=>'Editar',
    'save'=>'Guardar','confirm_delete'=>'¿Eliminar este contenido?','light'=>'Claro','dark'=>'Oscuro',
    'just_now'=>'ahora mismo','min_ago'=>'hace %d min','hour_ago'=>'hace %d h','day_ago'=>'hace %d d',
    'month_ago'=>'hace %d meses','year_ago'=>'hace %d años','members_note'=>'Usuarios activos esta semana',
  ],
  'en' => [
    'title'=>'LC-ADVANCE Community','newpost'=>'New Post','search'=>'Search community...',
    'placeholder_title'=>'Post title','placeholder_body'=>'Write your message...','placeholder_user'=>'Your name',
    'publish'=>'Publish','cancel'=>'Cancel','popular'=>'Popular','members'=>'Active Members',
    'rules'=>'Community Rules','rule1'=>'Be respectful','rule2'=>'No spam',
    'rule3'=>'Stay on topic','comments'=>'Comments','share'=>'Copy link',
    'copied'=>'Link copied!','empty'=>'Be the first to post','upvote'=>'Upvote',
    'downvote'=>'Downvote','reply'=>'Reply','delete'=>'Delete','edit'=>'Edit',
    'save'=>'Save','confirm_delete'=>'Delete this content?','light'=>'Light','dark'=>'Dark',
    'just_now'=>'just now','min_ago'=>'%d min ago','hour_ago'=>'%d h ago','day_ago'=>'%d d ago',
    'month_ago'=>'%d months ago','year_ago'=>'%d years ago','members_note'=>'Active users this week',
  ],
];
$langData = $t[$lang];
$dashboardUrl = getDashboardUrl();
?>
<!DOCTYPE html>
<html lang="<?= htmlspecialchars($lang) ?>" data-theme="dark">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= htmlspecialchars($langData['title']) ?></title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;500;600;700;800&family=Space+Grotesk:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
:root {
  --bg: #0a0d14; --surface: #0f1423; --surface2: #141a2f;
  --border: rgba(0,229,255,0.12); --border2: rgba(0,229,255,0.18);
  --cyan: #00e5ff; --cyan-dim: rgba(0,229,255,0.08);
  --pink: #ff3cac; --green: #00ff87; --yellow: #ffd23f;
  --text: #e8f4ff; --text2: rgba(200,230,255,0.65);
  --font-display: 'Syne', sans-serif; --font-body: 'Space Grotesk', sans-serif;
  --font-mono: 'JetBrains Mono', monospace;
  --radius: 14px; --transition: all 0.3s cubic-bezier(0.4,0,0.2,1);
}
[data-theme="light"] {
  --bg: #f0f4fa; --surface: #ffffff; --surface2: #eef2f8;
  --border: rgba(0,100,180,0.15); --border2: rgba(0,100,180,0.25);
  --cyan: #0078d4; --cyan-dim: rgba(0,120,212,0.08);
  --pink: #c239b3; --green: #0f7b3a; --yellow: #d29922;
  --text: #1a2332; --text2: rgba(26,35,50,0.6);
}
* { margin:0; padding:0; box-sizing:border-box; }
body {
  font-family: var(--font-body); background: var(--bg); color: var(--text);
  min-height: 100vh; transition: var(--transition);
}
a { color: var(--cyan); text-decoration:none; }
a:hover { text-decoration:underline; }
button { cursor:pointer; font-family: var(--font-body); }

/* ── Grid background ── */
.grid-bg {
  position:fixed; inset:0; z-index:0; pointer-events:none; overflow:hidden;
  background-image:
    linear-gradient(rgba(0,229,255,0.03) 1px, transparent 1px),
    linear-gradient(90deg, rgba(0,229,255,0.03) 1px, transparent 1px);
  background-size: 60px 60px;
}
.main-layout, .navbar { position:relative; z-index:1; }

/* ── Navbar ── */
.navbar {
  display:flex; align-items:center; gap:12px; padding:10px 20px;
  background: rgba(10,13,20,0.88); backdrop-filter: blur(18px);
  border-bottom: 1px solid var(--border); position:sticky; top:0; z-index:100;
}
[data-theme="light"] .navbar { background: rgba(255,255,255,0.88); }
.nav-logo {
  font-family: var(--font-display); font-weight:800; font-size:17px;
  background: linear-gradient(135deg, var(--cyan), var(--pink));
  -webkit-background-clip: text; -webkit-text-fill-color: transparent;
  background-clip: text; white-space:nowrap;
}
.nav-logo span { -webkit-text-fill-color: var(--text); color:var(--text); }
.search-bar {
  flex:1; max-width:420px; padding:8px 14px;
  border: 1px solid var(--border); border-radius: 10px;
  background: var(--surface); color: var(--text); font-size:13px;
  outline:none; font-family: var(--font-body); transition: var(--transition);
}
.search-bar::placeholder { color: var(--text2); }
.search-bar:focus { border-color: var(--cyan); box-shadow: 0 0 0 3px rgba(0,229,255,0.08); }
.nav-actions { display:flex; gap:10px; align-items:center; }
.btn-primary {
  padding: 10px 18px;
  background: linear-gradient(135deg, #00e5ff 0%, #8d5bff 100%);
  color: #041420;
  border: none;
  border-radius: 12px;
  font-size: 12px;
  font-weight: 700;
  letter-spacing: 0.5px;
  font-family: var(--font-mono);
  white-space: nowrap;
  transition: var(--transition);
  text-transform: uppercase;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
  box-shadow: 0 14px 30px rgba(0, 229, 255, 0.18);
}
.btn-primary:hover {
  transform: translateY(-1px);
  box-shadow: 0 18px 34px rgba(0, 229, 255, 0.3);
  opacity: 1;
}
a.btn-primary { display:inline-flex; align-items:center; height:38px; }
/* theme toggle removed: keep base dark theme */

/* ── Layout ── */
.main-layout {
  display:flex; gap:24px; max-width:1200px; margin:0 auto; padding:24px 20px;
}
.feed { flex:1; min-width:0; }
.sidebar { width:300px; flex-shrink:0; }

/* ── Post Card ── */
.post-card {
  background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius);
  padding:18px 20px; margin-bottom:14px; transition: var(--transition);
  position:relative;
}
.post-card::before {
  content:''; position:absolute; inset:0; border-radius:inherit;
  background: linear-gradient(135deg, rgba(0,229,255,0.03), transparent 60%);
  pointer-events:none;
}
.post-card:hover { transform: translateY(-2px); border-color: var(--cyan); box-shadow: 0 8px 24px rgba(0,229,255,0.08); }
.post-header { display:flex; align-items:center; gap:10px; margin-bottom:10px; }
.avatar {
  width:38px; height:38px; border-radius:50%; display:flex; align-items:center;
  justify-content:center; font-weight:700; font-size:15px; color:#fff;
  flex-shrink:0; font-family: var(--font-mono);
}
.post-author { font-weight:600; font-size:14px; font-family: var(--font-display); }
.post-time { color: var(--text2); font-size:12px; font-family: var(--font-mono); }
.post-title { font-size:17px; font-weight:700; margin-bottom:6px; line-height:1.3; font-family: var(--font-display); }
.post-body { color: var(--text2); font-size:14px; line-height:1.6; margin-bottom:12px; white-space:pre-wrap; word-break:break-word; }

/* ── Vote / Actions ── */
.post-actions { display:flex; align-items:center; gap:6px; flex-wrap:wrap; }
.vote-group { display:flex; align-items:center; gap:4px; }
.vote-btn {
  background:none; border: 1px solid var(--border); border-radius:6px;
  padding:4px 10px; font-size:13px; color: var(--text2); transition: var(--transition);
  display:flex; align-items:center; gap:4px; min-width:36px; justify-content:center;
  font-family: var(--font-mono);
}
.vote-btn:hover { border-color: var(--cyan); color: var(--cyan); }
.vote-btn.upvoted { border-color: var(--cyan); color: var(--cyan); background: rgba(0,229,255,0.08); }
.vote-btn.downvoted { border-color: var(--pink); color: var(--pink); background: rgba(255,60,172,0.08); }
.vote-score { font-size:14px; font-weight:700; min-width:28px; text-align:center; font-family: var(--font-mono); }
.action-btn {
  background:none; border: 1px solid transparent; border-radius:6px;
  padding:4px 10px; font-size:12px; color: var(--text2); transition: var(--transition);
  display:flex; align-items:center; gap:4px; font-family: var(--font-mono);
}
.action-btn:hover { border-color: var(--border); color: var(--cyan); }
.action-btn.share-copied { border-color: var(--cyan); color: var(--cyan); }

/* ── Comments ── */
.comments-section { margin-top:12px; border-top: 1px solid var(--border); padding-top:12px; }
.comments-toggle {
  background:none; border:none; color: var(--cyan); font-size:12px; font-weight:600;
  padding:4px 0; cursor:pointer; margin-bottom:10px; font-family: var(--font-mono);
  letter-spacing:0.5px; text-transform:uppercase;
}
.comments-toggle:hover { opacity:0.8; text-decoration:underline; }
.comments-list { display:none; }
.comments-list.open { display:block; }
.comment-card {
  padding:10px 12px; margin-bottom:8px; background: var(--surface2); border-radius:10px;
  border: 1px solid var(--border);
}
.comment-header { display:flex; align-items:center; gap:8px; margin-bottom:4px; }
.comment-avatar { width:26px; height:26px; border-radius:50%; display:flex; align-items:center;
  justify-content:center; font-weight:700; font-size:11px; color:#fff; flex-shrink:0;
  font-family: var(--font-mono); }
.comment-author { font-weight:600; font-size:12px; font-family: var(--font-display); }
.comment-time { color: var(--text2); font-size:11px; font-family: var(--font-mono); }
.comment-body { font-size:13px; line-height:1.45; color: var(--text); white-space:pre-wrap; word-break:break-word; }
.comment-actions { display:flex; align-items:center; gap:4px; margin-top:6px; }
.comment-actions .vote-btn { padding:2px 8px; font-size:11px; min-width:28px; }
.comment-actions .vote-score { font-size:12px; min-width:20px; }
.comment-input-wrap { display:flex; gap:8px; align-items:flex-start; margin-top:10px; }
.comment-input {
  flex:1; padding:8px 12px; border: 1px solid var(--border); border-radius:10px;
  background: var(--surface); color: var(--text); font-size:13px; outline:none;
  resize:none; min-height:38px; font-family: var(--font-body); transition: var(--transition);
}
.comment-input::placeholder { color: var(--text2); }
.comment-input:focus { border-color: var(--cyan); box-shadow: 0 0 0 3px rgba(0,229,255,0.08); }
.comment-submit {
  padding:8px 16px; background: var(--cyan); color: #041420; border:none;
  border-radius:10px; font-size:11px; font-weight:700; letter-spacing:0.5px;
  font-family: var(--font-mono); white-space:nowrap; text-transform:uppercase;
  transition: var(--transition);
}
.comment-submit:hover { opacity:0.85; transform: translateY(-1px); }

/* ── Sidebar ── */
.sidebar-card {
  background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius);
  padding:16px 18px; margin-bottom:14px; position:relative;
}
.sidebar-card::before {
  content:''; position:absolute; inset:0; border-radius:inherit;
  background: linear-gradient(135deg, rgba(0,229,255,0.03), transparent 60%);
  pointer-events:none;
}
.sidebar-card h3 {
  font-size:11px; text-transform:uppercase; letter-spacing:1.5px;
  color: var(--text2); margin-bottom:12px; font-family: var(--font-mono);
}
.sidebar-item {
  display:flex; align-items:center; gap:8px; padding:7px 0; font-size:13px;
  border-bottom: 1px solid var(--border); font-family: var(--font-body);
}
.sidebar-item:last-child { border-bottom:none; }
.sidebar-item .rank { color: var(--text2); font-size:11px; min-width:20px; font-family: var(--font-mono); }
.sidebar-item .s-title { flex:1; overflow:hidden; text-overflow:ellipsis; white-space:nowrap; }
.sidebar-item .s-score { color: var(--cyan); font-size:12px; font-weight:600; font-family: var(--font-mono); }
.member-item { display:flex; align-items:center; gap:8px; padding:6px 0; font-size:13px; }
.member-item .status { width:8px; height:8px; border-radius:50%; flex-shrink:0; box-shadow:0 0 6px currentColor; }
.member-item .status.online { background: var(--green); color: var(--green); }
.member-item .status.away { background: var(--yellow); color: var(--yellow); }
.rule-item { padding:6px 0; font-size:13px; display:flex; gap:10px; align-items:center; }
.rule-item .r-num {
  width:22px; height:22px; border-radius:50%; background: var(--cyan);
  color: #041420; font-size:11px; font-weight:700; font-family: var(--font-mono);
  display:flex; align-items:center; justify-content:center; flex-shrink:0;
}

/* ── Modal ── */
.modal-overlay {
  display:none; position:fixed; inset:0; background: rgba(0,0,0,0.7);
  backdrop-filter: blur(4px); z-index:200; align-items:center;
  justify-content:center; padding:16px;
}
[data-theme="light"] .modal-overlay { background: rgba(0,0,0,0.4); }
.modal-overlay.open { display:flex; }
.modal {
  background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius-lg);
  padding:28px; width:100%; max-width:500px; max-height:90vh; overflow-y:auto;
}
.modal h2 { margin-bottom:20px; font-size:20px; font-family: var(--font-display); }
.modal input, .modal textarea {
  width:100%; padding:10px 14px; border: 1px solid var(--border); border-radius:10px;
  background: var(--surface2); color: var(--text); font-size:14px; outline:none;
  font-family: var(--font-body); margin-bottom:14px; transition: var(--transition);
}
.modal textarea { resize:vertical; min-height:120px; }
.modal input:focus, .modal textarea:focus { border-color: var(--cyan); box-shadow: 0 0 0 3px rgba(0,229,255,0.08); }
.modal-actions { display:flex; gap:10px; justify-content:flex-end; }
.btn-cancel {
  padding:8px 18px; background:transparent; border: 1px solid var(--border);
  border-radius:10px; color: var(--text2); font-size:12px; font-weight:600;
  font-family: var(--font-mono); transition: var(--transition);
}
.btn-cancel:hover { border-color: var(--text2); color: var(--text); }

/* ── Empty state ── */
.empty-state { text-align:center; padding:50px 20px; color: var(--text2); }
.empty-state p { margin-top:10px; font-size:14px; }

/* ── Notification ── */
.notification {
  position:fixed; bottom:24px; right:24px; background: var(--surface);
  border: 1px solid var(--cyan); border-radius:10px; padding:12px 20px;
  color: var(--text); z-index:300; font-size:13px; font-weight:500;
  box-shadow: 0 8px 24px rgba(0,0,0,0.3); animation: slideIn 0.25s ease;
}
@keyframes slideIn { from{transform:translateX(100%);opacity:0} to{transform:translateX(0);opacity:1} }

/* ── Responsive ── */
@media (max-width: 860px) {
  .sidebar { display:none; }
  .sidebar.show { display:block; width:100%; }
  .main-layout { flex-direction:column; }
  .navbar { padding:8px 14px; gap:8px; }
  .search-bar { max-width:200px; }
}
@media (max-width: 480px) {
  .navbar { padding:8px 10px; gap:6px; }
  .nav-logo { font-size:14px; }
  .search-bar { font-size:12px; padding:6px 10px; max-width:120px; }
  .btn-primary { padding:6px 12px; font-size:10px; }
  .post-card { padding:12px 14px; }
  .post-title { font-size:15px; }
  .modal { padding:20px; }
}
</style>
</head>
<body>

<div class="grid-bg"></div>

<!-- Navbar -->
<nav class="navbar">
  <div class="nav-logo">LC<span>Advance</span></div>
  <input class="search-bar" id="searchInput" type="text" placeholder="<?= htmlspecialchars($langData['search']) ?>">
  <div class="nav-actions">
    <a href="<?= htmlspecialchars($dashboardUrl) ?>" class="btn-primary">🏠 Dashboard</a>
    <button class="btn-primary" onclick="openModal()">+ <?= htmlspecialchars($langData['newpost']) ?></button>
  </div>
</nav>

<!-- Main Layout -->
<div class="main-layout">
  <!-- Feed -->
  <div class="feed" id="feed"></div>
  <!-- Sidebar -->
  <aside class="sidebar" id="sidebar">
    <div class="sidebar-card">
      <h3><?= htmlspecialchars($langData['popular']) ?></h3>
      <div id="popularPosts"></div>
    </div>
    <div class="sidebar-card">
      <h3><?= htmlspecialchars($langData['members']) ?></h3>
      <div id="activeMembers"></div>
      <p style="font-size:11px;color:var(--text2);margin-top:6px;"><?= htmlspecialchars($langData['members_note']) ?></p>
    </div>
    <div class="sidebar-card">
      <h3><?= htmlspecialchars($langData['rules']) ?></h3>
      <div class="rule-item"><span class="r-num">1</span><?= htmlspecialchars($langData['rule1']) ?></div>
      <div class="rule-item"><span class="r-num">2</span><?= htmlspecialchars($langData['rule2']) ?></div>
      <div class="rule-item"><span class="r-num">3</span><?= htmlspecialchars($langData['rule3']) ?></div>
    </div>
  </aside>
</div>

<!-- Modal -->
<div class="modal-overlay" id="modalOverlay">
  <div class="modal">
    <h2><?= htmlspecialchars($langData['newpost']) ?></h2>
    <input id="postUser" type="text" placeholder="<?= htmlspecialchars($langData['placeholder_user']) ?>">
    <input id="postTitle" type="text" placeholder="<?= htmlspecialchars($langData['placeholder_title']) ?>">
    <textarea id="postBody" placeholder="<?= htmlspecialchars($langData['placeholder_body']) ?>"></textarea>
    <div class="modal-actions">
      <button class="btn-cancel" onclick="closeModal()"><?= htmlspecialchars($langData['cancel']) ?></button>
      <button class="btn-primary" onclick="createPost()"><?= htmlspecialchars($langData['publish']) ?></button>
    </div>
  </div>
</div>

<script>
const LANG = <?= json_encode($langData) ?>;
const STORAGE_KEY = 'lc_community_data';
const VOTER_KEY = 'lc_community_voter';

// ── Data ──
function getData() {
  var raw = localStorage.getItem(STORAGE_KEY);
  if (raw) return JSON.parse(raw);
  return getDefaultData();
}

function saveData(data) {
  localStorage.setItem(STORAGE_KEY, JSON.stringify(data));
}

function getDefaultData() {
  return {
    posts: [
      {
        id: 'p1', title: '¿Cómo resolver integrales por partes?',
        body: 'Estoy atorado en los ejercicios de cálculo. Alguien me puede explicar la técnica de integración por partes con un ejemplo?',
        author: 'Carlos', createdAt: Date.now() - 3600000 * 2,
        upvotes: ['v1','v2','v3'], downvotes: [], comments: [
          { id: 'c1', author: 'María', body: 'Usa la fórmula ∫u dv = uv - ∫v du. El truco es elegir u como algo que se simplifica al derivar.', createdAt: Date.now() - 3600000 * 1.5, upvotes: ['v4','v5'], downvotes: [] },
          { id: 'c2', author: 'Pedro', body: 'Recomiendo el método ILATE para elegir u: Inversas, Logaritmos, Algebraicas, Trigonométricas, Exponenciales.', createdAt: Date.now() - 3600000 * 0.8, upvotes: ['v1'], downvotes: [] }
        ]
      },
      {
        id: 'p2', title: 'Tips para aprender química orgánica',
        body: 'Estoy empezando química orgánica y me cuesta trabajo memorizar los grupos funcionales. ¿Algún consejo?',
        author: 'Ana', createdAt: Date.now() - 3600000 * 5,
        upvotes: ['v4','v5','v6','v7'], downvotes: ['v2'], comments: [
          { id: 'c3', author: 'Luis', body: 'Haz flashcards con Anki. Los grupos funcionales se memorizan mejor con repetición espaciada.', createdAt: Date.now() - 3600000 * 4, upvotes: ['v1','v4'], downvotes: [] },
          { id: 'c4', author: 'Sofía', body: 'Dibuja cada grupo funcional 10 veces al día. La práctica manual ayuda mucho.', createdAt: Date.now() - 3600000 * 3, upvotes: ['v5'], downvotes: [] }
        ]
      },
      {
        id: 'p3', title: '¿Alguien más tiene problemas con el mapa interactivo?',
        body: 'En la sala de profesores no encuentro al profesor Espindola. He revisado varias veces pero no aparece. ¿Es un bug?',
        author: 'Miguel', createdAt: Date.now() - 3600000 * 8,
        upvotes: ['v2','v3','v5'], downvotes: [], comments: [
          { id: 'c5', author: 'Admin', body: 'El profesor Espindola aparece en ciertos horarios. Revisa el panel de horarios en la entrada.', createdAt: Date.now() - 3600000 * 7, upvotes: ['v1','v2','v3','v4'], downvotes: [] }
        ]
      },
      {
        id: 'p4', title: 'Compartan sus mejores recursos para física',
        body: 'Dejen links de canales de YouTube, páginas o documentos que les hayan servido para física clásica y moderna.',
        author: 'Diana', createdAt: Date.now() - 3600000 * 24,
        upvotes: ['v1','v4','v6','v7','v8'], downvotes: ['v3'], comments: [
          { id: 'c6', author: 'Roberto', body: 'El canal de "Physics Girl" y "3Blue1Brown" son excelentes para conceptos visuales.', createdAt: Date.now() - 3600000 * 20, upvotes: ['v1','v4','v5'], downvotes: [] },
          { id: 'c7', author: 'Diana', body: 'Gracias! Conozco 3B1B, pero no Physics Girl. Lo checo.', createdAt: Date.now() - 3600000 * 19, upvotes: ['v2'], downvotes: [] }
        ]
      }
    ]
  };
}

// ── Voter ID ──
function getVoterId() {
  var id = localStorage.getItem(VOTER_KEY);
  if (!id) { id = 'v_' + Date.now() + '_' + Math.random().toString(36).slice(2,6); localStorage.setItem(VOTER_KEY, id); }
  return id;
}

// ── Relative time ──
function timeAgo(ts) {
  var diff = Math.floor((Date.now() - ts) / 1000);
  if (diff < 60) return LANG.just_now;
  if (diff < 3600) return LANG.min_ago.replace('%d', Math.floor(diff / 60));
  if (diff < 86400) return LANG.hour_ago.replace('%d', Math.floor(diff / 3600));
  if (diff < 2592000) return LANG.day_ago.replace('%d', Math.floor(diff / 86400));
  if (diff < 31536000) return LANG.month_ago.replace('%d', Math.floor(diff / 2592000));
  return LANG.year_ago.replace('%d', Math.floor(diff / 31536000));
}

// ── Avatar colors ──
function avatarColor(name) {
  var colors = ['#1f6feb','#3fb950','#d29922','#f0883e','#da3633','#8b5cf6','#db61a2','#39d5c0'];
  var h = 0;
  for (var i = 0; i < name.length; i++) h = (h * 31 + name.charCodeAt(i)) & 0xffff;
  return colors[Math.abs(h) % colors.length];
}

function avatarHtml(name, size) {
  var initial = name ? name.charAt(0).toUpperCase() : '?';
  var c = avatarColor(name);
  return '<span class="avatar" style="width:'+size+'px;height:'+size+'px;background:'+c+'">'+initial+'</span>';
}

// ── Notification ──
function notify(msg) {
  var el = document.createElement('div');
  el.className = 'notification'; el.textContent = msg;
  document.body.appendChild(el);
  setTimeout(function(){ el.remove(); }, 2800);
}

// ── Vote logic ──
function vote(target, type) {
  var vid = getVoterId();
  var data = getData();
  var found = false;

  function toggle(item) {
    var u = item.upvotes.indexOf(vid);
    var d = item.downvotes.indexOf(vid);
    if (type === 'up') {
      if (u !== -1) { item.upvotes.splice(u,1); }
      else {
        if (d !== -1) item.downvotes.splice(d,1);
        item.upvotes.push(vid);
      }
    } else {
      if (d !== -1) { item.downvotes.splice(d,1); }
      else {
        if (u !== -1) item.upvotes.splice(u,1);
        item.downvotes.push(vid);
      }
    }
  }

  // target: 'p_ID' or 'c_ID'
  if (target.charAt(0) === 'p') {
    for (var i = 0; i < data.posts.length; i++) {
      if (data.posts[i].id === target) { toggle(data.posts[i]); found = true; break; }
    }
  } else {
    for (var i = 0; i < data.posts.length; i++) {
      for (var j = 0; j < data.posts[i].comments.length; j++) {
        if (data.posts[i].comments[j].id === target) { toggle(data.posts[i].comments[j]); found = true; break; }
      }
      if (found) break;
    }
  }
  if (found) { saveData(data); renderAll(); }
}

// ── Share ──
function sharePost(id) {
  var url = window.location.href.split('?')[0] + '?post=' + id;
  if (navigator.clipboard) {
    navigator.clipboard.writeText(url).then(function(){ notify(LANG.copied); });
  } else {
    var ta = document.createElement('textarea');
    ta.value = url; document.body.appendChild(ta); ta.select();
    document.execCommand('copy'); ta.remove(); notify(LANG.copied);
  }
}

// ── Create post ──
function openModal() {
  document.getElementById('modalOverlay').classList.add('open');
  var saved = localStorage.getItem('lc_community_username');
  if (saved) document.getElementById('postUser').value = saved;
  document.getElementById('postTitle').focus();
}
function closeModal() {
  document.getElementById('modalOverlay').classList.remove('open');
}
function createPost() {
  var user = document.getElementById('postUser').value.trim();
  var title = document.getElementById('postTitle').value.trim();
  var body = document.getElementById('postBody').value.trim();
  if (!user || !title || !body) { notify('Completa todos los campos'); return; }
  localStorage.setItem('lc_community_username', user);
  var data = getData();
  data.posts.unshift({
    id: 'p_' + Date.now(),
    title: title, body: body, author: user, createdAt: Date.now(),
    upvotes: [], downvotes: [], comments: []
  });
  saveData(data);
  document.getElementById('postTitle').value = '';
  document.getElementById('postBody').value = '';
  closeModal();
  renderAll();
}

// ── Delete post ──
function deletePost(id) {
  if (!confirm(LANG.confirm_delete)) return;
  var data = getData();
  for (var i = 0; i < data.posts.length; i++) {
    if (data.posts[i].id === id) { data.posts.splice(i,1); break; }
  }
  saveData(data); renderAll();
}

// ── Delete comment ──
function deleteComment(postId, commentId) {
  if (!confirm(LANG.confirm_delete)) return;
  var data = getData();
  for (var i = 0; i < data.posts.length; i++) {
    if (data.posts[i].id === postId) {
      for (var j = 0; j < data.posts[i].comments.length; j++) {
        if (data.posts[i].comments[j].id === commentId) { data.posts[i].comments.splice(j,1); break; }
      }
      break;
    }
  }
  saveData(data); renderAll();
}

// ── Add comment ──
function addComment(postId) {
  var input = document.getElementById('ci_' + postId);
  var userInput = document.getElementById('cu_' + postId);
  var body = input ? input.value.trim() : '';
  var user = userInput ? userInput.value.trim() : '';
  if (!user || !body) return;
  localStorage.setItem('lc_community_username', user);
  var data = getData();
  for (var i = 0; i < data.posts.length; i++) {
    if (data.posts[i].id === postId) {
      data.posts[i].comments.push({
        id: 'c_' + Date.now() + '_' + Math.random().toString(36).slice(2,5),
        author: user, body: body, createdAt: Date.now(), upvotes: [], downvotes: []
      });
      break;
    }
  }
  saveData(data);
  renderAll();
  // Re-open comments after re-render
  setTimeout(function(){ toggleComments(postId); }, 50);
}

// ── Toggle comments ──
function toggleComments(postId) {
  var el = document.getElementById('cl_' + postId);
  if (el) el.classList.toggle('open');
}

// ── Score helper ──
function score(item) { return (item.upvotes||[]).length - (item.downvotes||[]).length; }

// ── Render feed ──
function renderPost(post, vid) {
  var s = score(post);
  var userVote = '';
  if (post.upvotes.indexOf(vid) !== -1) userVote = 'up';
  else if (post.downvotes.indexOf(vid) !== -1) userVote = 'down';

  var commentsHtml = '', commentsCount = (post.comments||[]).length;
  var commentsList = '';
  for (var k = 0; k < post.comments.length; k++) {
    var c = post.comments[k];
    var cs = score(c);
    var cv = '';
    if (c.upvotes.indexOf(vid) !== -1) cv = 'up';
    else if (c.downvotes.indexOf(vid) !== -1) cv = 'down';
    commentsList += '<div class="comment-card">' +
      '<div class="comment-header">' +
        avatarHtml(c.author, 24) +
        '<span class="comment-author">' + esc(c.author) + '</span>' +
        '<span class="comment-time">' + timeAgo(c.createdAt) + '</span>' +
      '</div>' +
      '<div class="comment-body">' + esc(c.body) + '</div>' +
      '<div class="comment-actions">' +
        '<div class="vote-group">' +
          '<button class="vote-btn' + (cv==='up'?' upvoted':'') + '" onclick="vote(\'' + c.id + '\',\'up\')">▲</button>' +
          '<span class="vote-score">' + cs + '</span>' +
          '<button class="vote-btn' + (cv==='down'?' downvoted':'') + '" onclick="vote(\'' + c.id + '\',\'down\')">▼</button>' +
        '</div>' +
        '<button class="action-btn" onclick="deleteComment(\'' + post.id + '\',\'' + c.id + '\')" style="color:#da3633">' + LANG.delete + '</button>' +
      '</div>' +
    '</div>';
  }

  commentsHtml =
    '<button class="comments-toggle" onclick="toggleComments(\'' + post.id + '\')">' +
      commentsCount + ' ' + LANG.comments +
    '</button>' +
    '<div class="comments-list" id="cl_' + post.id + '">' + commentsList +
      '<div class="comment-input-wrap">' +
        '<input type="text" id="cu_' + post.id + '" placeholder="' + LANG.placeholder_user + '" style="width:100px;padding:6px 8px;border:1px solid var(--border);border-radius:8px;background:var(--input);color:var(--text);font-size:12px;outline:none">' +
        '<textarea class="comment-input" id="ci_' + post.id + '" rows="1" placeholder="' + LANG.reply + '..."></textarea>' +
        '<button class="comment-submit" onclick="addComment(\'' + post.id + '\')">' + LANG.reply + '</button>' +
      '</div>' +
    '</div>';

  return '<article class="post-card">' +
    '<div class="post-header">' +
      avatarHtml(post.author, 36) +
      '<div>' +
        '<div class="post-author">' + esc(post.author) + '</div>' +
        '<div class="post-time">' + timeAgo(post.createdAt) + '</div>' +
      '</div>' +
    '</div>' +
    '<div class="post-title">' + esc(post.title) + '</div>' +
    '<div class="post-body">' + esc(post.body) + '</div>' +
    '<div class="post-actions">' +
      '<div class="vote-group">' +
        '<button class="vote-btn' + (userVote==='up'?' upvoted':'') + '" onclick="vote(\'' + post.id + '\',\'up\')" title="' + LANG.upvote + '">▲</button>' +
        '<span class="vote-score">' + s + '</span>' +
        '<button class="vote-btn' + (userVote==='down'?' downvoted':'') + '" onclick="vote(\'' + post.id + '\',\'down\')" title="' + LANG.downvote + '">▼</button>' +
      '</div>' +
      '<button class="action-btn" onclick="sharePost(\'' + post.id + '\')">🔗 ' + LANG.share + '</button>' +
      '<button class="action-btn" style="color:#da3633" onclick="deletePost(\'' + post.id + '\')">' + LANG.delete + '</button>' +
    '</div>' +
    '<div class="comments-section">' + commentsHtml + '</div>' +
  '</article>';
}

function esc(s) {
  var d = document.createElement('div');
  d.textContent = s;
  return d.innerHTML;
}

// ── Render sidebar ──
function renderSidebar(data, vid) {
  // Popular posts - top 5 by score
  var sorted = data.posts.slice().sort(function(a,b){ return score(b) - score(a); });
  var popularHtml = '';
  for (var i = 0; i < Math.min(sorted.length, 5); i++) {
    var p = sorted[i];
    popularHtml += '<div class="sidebar-item"><span class="rank">#' + (i+1) + '</span><span class="s-title">' + esc(p.title) + '</span><span class="s-score">' + score(p) + '</span></div>';
  }
  document.getElementById('popularPosts').innerHTML = popularHtml || '<div style="color:var(--text2);font-size:13px">' + LANG.empty + '</div>';

  // Active members - extract unique authors from posts + comments
  var authors = {};
  data.posts.forEach(function(p){
    authors[p.author] = (authors[p.author]||0) + 1;
    p.comments.forEach(function(c){ authors[c.author] = (authors[c.author]||0) + 1; });
  });
  var memberList = Object.keys(authors).sort(function(a,b){ return authors[b] - authors[a]; });
  var memberHtml = '';
  var statuses = ['online','online','online','away','online','away','online'];
  for (var i = 0; i < Math.min(memberList.length, 7); i++) {
    var m = memberList[i];
    var st = statuses[i % statuses.length];
    memberHtml += '<div class="member-item"><span class="status ' + st + '"></span>' + avatarHtml(m, 20) + esc(m) + '</div>';
  }
  document.getElementById('activeMembers').innerHTML = memberHtml;
}

// ── Search filter ──
var searchTerm = '';
document.getElementById('searchInput').addEventListener('input', function(){
  searchTerm = this.value.toLowerCase().trim();
  renderAll();
});

// ── Main render ──
function renderAll() {
  var data = getData();
  var vid = getVoterId();
  var term = searchTerm;
  var feed = document.getElementById('feed');

  var filtered = data.posts;
  if (term) {
    filtered = data.posts.filter(function(p){
      return p.title.toLowerCase().indexOf(term) !== -1 || p.body.toLowerCase().indexOf(term) !== -1;
    });
  }

  if (filtered.length === 0) {
    feed.innerHTML = '<div class="empty-state"><div style="font-size:40px;margin-bottom:10px">📭</div><p>' + (term ? 'Sin resultados' : LANG.empty) + '</p></div>';
  } else {
    feed.innerHTML = filtered.map(function(p){ return renderPost(p, vid); }).join('');
  }

  renderSidebar(data, vid);
}

// Theme switching removed — site fixed to dark theme.

// ── Init ──
(function init() {
  // Enforce dark theme across the app
  document.documentElement.setAttribute('data-theme', 'dark');

  // Close modal on overlay click
  document.getElementById('modalOverlay').addEventListener('click', function(e){
    if (e.target === this) closeModal();
  });

  renderAll();
})();
</script>
</body>
</html>
