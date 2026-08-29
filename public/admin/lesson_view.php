<?php
require_once __DIR__ . '/../../src/Config/config.php';
require_once __DIR__ . '/../../src/Config/csrf.php';
require_once __DIR__ . '/../../src/Core/admin.php';
require_once __DIR__ . '/../../src/Core/block_renderer.php';
requireAdmin();

$slug = trim($_GET['slug'] ?? '');
$leccion = buscarLeccion($slug);
if (!$leccion) {
    http_response_code(404);
    echo '<h1>Lecci&oacute;n no encontrada</h1>';
    exit;
}

// Use DB override if exists
$contenido_raw = obtenerContenidoLeccion($pdo, $slug, $leccion['contenido'] ?? '');

// Detect JSON (blocks) vs raw HTML
$es_json = (strlen($contenido_raw) > 0 && $contenido_raw[0] === '[');
if ($es_json) {
    $contenido = renderBlocks($contenido_raw);
} else {
    $contenido = $contenido_raw;
}

$es_builder = $es_json; // toggle builder button based on content format

$page_title = htmlspecialchars($leccion['titulo'] ?? 'Vista previa') . ' | Admin | LC-ADVANCE';
$r = appRootPath();
$page_show_bg_orb = true;

// Build extra head matching leccion_detalle.php
$extra = '';
// style.css + per-lesson CSS
$extra .= '<link rel="stylesheet" href="' . assetUrl('assets/css/style.css') . '">' . "\n";
$cssDir = realpath(__DIR__ . '/../assets/css');
if ($cssDir) {
    foreach (glob($cssDir . '/leccion-*.css') as $f) {
        $basename = basename($f);
        $extra .= '<link rel="stylesheet" href="' . htmlspecialchars($r . '/public/assets/css/' . $basename) . '">' . "\n";
    }
}
// MathJax for formula rendering
$extra .= '<script>MathJax = { tex: { inlineMath: [["$","$"],["\\\\(","\\\\)"]] } };</script>' . "\n";
$extra .= '<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js" async></script>' . "\n";
// dashboard.css
$extra .= '<link rel="stylesheet" href="' . $r . '/public/assets/css/dashboard.css?v=' . filemtime(__DIR__ . '/../assets/css/dashboard.css') . '">' . "\n";
// admin.css for admin header styles
$extra .= '<link rel="stylesheet" href="' . $r . '/public/assets/css/admin.css?v=' . filemtime(__DIR__ . '/../assets/css/admin.css') . '">';

$page_extra_head = $extra;
$page_inline_css = '
:root {
  --bg: #060a12; --surface: #0c1220; --surface2: #101828;
  --border: rgba(0,230,255,0.12); --border2: rgba(0,230,255,0.22);
  --cyan: #00e5ff; --cyan-dim: rgba(0,229,255,0.1);
  --pink: #ff3cac; --green: #00ff87; --yellow: #ffd23f;
  --text: #e8f4ff; --muted: rgba(200,230,255,0.45);
  --font-display: "Syne", sans-serif;
  --font-mono: "JetBrains Mono", monospace;
  --font-body: "Space Grotesk", sans-serif;
}
body { background: var(--bg); color: var(--text); font-family: var(--font-body); line-height: 1.7; }
.preview-bar { display:flex; align-items:center; gap:12px; padding:12px 20px; background:var(--surface2); border-bottom:1px solid var(--border); position:sticky; top:0; z-index:100; }
.preview-bar a { display:inline-flex; align-items:center; gap:6px; padding:6px 14px; background:var(--surface); border:1px solid var(--border); border-radius:6px; color:var(--text); text-decoration:none; font-size:12px; font-weight:500; transition:all .15s; }
.preview-bar a:hover { border-color:var(--cyan); color:var(--cyan); }
.preview-bar .meta { display:flex; gap:8px; flex-wrap:wrap; margin-left:auto; }
.preview-bar .meta span { padding:3px 12px; border-radius:20px; font-size:10px; font-weight:600; background:var(--cyan)15; border:1px solid var(--cyan)35; color:var(--cyan); }
.preview-bar .meta .quiz { background:var(--green)15; border-color:var(--green)35; color:var(--green); }
.preview-wrap { max-width: 960px; margin: 0 auto; padding: 24px 20px 80px; }
';

require __DIR__ . '/../../src/Templates/page_start.php';
?>
<div class="preview-bar">
  <a href="<?= htmlspecialchars($r . '/public/admin/lessons.php') ?>">&larr; Volver</a>
  <a href="<?= htmlspecialchars($r . '/public/admin/builder.php?slug=' . urlencode($slug)) ?>" style="background:var(--cyan);border-color:var(--cyan);color:#041420;font-weight:600">🧱 Builder</a>
  <a href="<?= htmlspecialchars($r . '/public/admin/lesson_edit.php?slug=' . urlencode($slug)) ?>" class="admin-btn admin-btn-ghost" style="font-size:11px;padding:4px 10px">✏️ HTML</a>
  <div class="meta">
    <span><?= htmlspecialchars($leccion['materia'] ?? '') ?></span>
    <span class="quiz">📝 <?= count($leccion['quiz'] ?? []) ?> preguntas</span>
  </div>
</div>

<div class="preview-wrap">
  <h1 style="font-size:24px;font-weight:700;margin-bottom:24px"><?= htmlspecialchars($leccion['titulo'] ?? '') ?></h1>
  <?= $contenido ?? '<p style="color:var(--muted)">Sin contenido.</p>' ?>
</div>

<?php require __DIR__ . '/../../src/Templates/page_end.php'; ?>
