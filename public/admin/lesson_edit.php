<?php
require_once __DIR__ . '/../../src/Config/config.php';
require_once __DIR__ . '/../../src/Config/csrf.php';
require_once __DIR__ . '/../../src/Core/admin.php';
requireAdmin();

$slug = trim($_GET['slug'] ?? '');
$leccion = buscarLeccion($slug);
if (!$leccion) {
    http_response_code(404);
    echo '<h1>Lecci&oacute;n no encontrada</h1>';
    exit;
}

$mensaje = '';
$error = '';

// Load content: DB override > file content
$contenido = obtenerContenidoLeccion($pdo, $slug, $leccion['contenido'] ?? '');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && validarTokenCSRF($_POST['csrf_token'] ?? '')) {
    if (($_POST['accion'] ?? '') === 'guardar') {
        $nuevo = $_POST['contenido'] ?? '';
        if (guardarContenidoLeccion($pdo, $slug, $nuevo)) {
            $contenido = $nuevo;
            logActividad('ADMIN_LESSON_EDIT', "Contenido editado: $slug", $_SESSION['usuario_id']);
            $mensaje = 'Contenido guardado.';
        } else {
            $error = 'Error al guardar.';
        }
    } elseif (($_POST['accion'] ?? '') === 'restaurar') {
        $contenido = $leccion['contenido'] ?? '';
        try {
            $pdo->prepare("DELETE FROM lecciones_contenido WHERE slug = ?")->execute([$slug]);
            logActividad('ADMIN_LESSON_RESTORE', "Contenido restaurado: $slug", $_SESSION['usuario_id']);
            $mensaje = 'Contenido restaurado al original.';
        } catch (Exception $e) {
            $error = 'Error al restaurar.';
        }
    }
}

$page_title = 'Editar: ' . htmlspecialchars($leccion['titulo'] ?? '') . ' | Admin | LC-ADVANCE';
$r = appRootPath();
$page_show_bg_orb = true;
$page_extra_head = '<link rel="stylesheet" href="' . $r . '/public/assets/css/dashboard.css?v=' . filemtime(__DIR__ . '/../assets/css/dashboard.css') . '">' . "\n" .
    '<link rel="stylesheet" href="' . $r . '/public/assets/css/admin.css?v=' . filemtime(__DIR__ . '/../assets/css/admin.css') . '">';
require __DIR__ . '/../../src/Templates/page_start.php';
?>
<style>
.edit-wrap { max-width: 1100px; margin: 0 auto; padding: 20px 16px 60px; }
.edit-header { display: flex; align-items: center; gap: 12px; margin-bottom: 16px; flex-wrap: wrap; }
.edit-header h1 { margin: 0; font-size: 20px; font-weight: 700; flex: 1; }
.edit-meta { display: flex; gap: 8px; flex-wrap: wrap; margin-bottom: 16px; }
.edit-meta span { padding: 3px 12px; border-radius: 20px; font-size: 11px; font-weight: 600; }
.edit-meta .slug { background: var(--surface); border: 1px solid var(--border); color: var(--muted); font-family: 'JetBrains Mono', monospace; }
.edit-meta .materia { background: var(--cyan)15; border: 1px solid var(--cyan)35; color: var(--cyan); }
.toolbar { display: flex; gap: 6px; flex-wrap: wrap; margin-bottom: 8px; padding: 8px; background: var(--surface2); border: 1px solid var(--border); border-radius: 8px; }
.toolbar button { padding: 4px 12px; background: var(--surface); border: 1px solid var(--border); border-radius: 4px; color: var(--text); font-size: 12px; cursor: pointer; font-family: var(--font-mono); }
.toolbar button:hover { background: var(--cyan-dim); border-color: var(--cyan); }
.editor-area { width: 100%; min-height: 500px; background: #0a0e1a; color: #e0f0ff; border: 1px solid var(--border); border-radius: 8px; padding: 16px; font-family: 'JetBrains Mono', monospace; font-size: 13px; line-height: 1.7; resize: vertical; tab-size: 2; }
.editor-area:focus { outline: none; border-color: var(--cyan); }
.editor-actions { display: flex; gap: 8px; margin-top: 12px; flex-wrap: wrap; }
.word-count { font-size: 11px; color: var(--muted); font-family: var(--font-mono); margin-top: 6px; }
</style>

<div class="edit-wrap">
  <div class="edit-header">
    <a href="<?= htmlspecialchars($r . '/public/admin/lesson_view.php?slug=' . urlencode($slug)) ?>" class="admin-btn admin-btn-ghost">&larr; Volver</a>
    <h1>✏️ <?= htmlspecialchars($leccion['titulo'] ?? '') ?></h1>
  </div>

  <div class="edit-meta">
    <span class="materia">📂 <?= htmlspecialchars($leccion['materia'] ?? '') ?></span>
    <span class="slug"><?= htmlspecialchars($slug) ?></span>
  </div>

  <?php if ($mensaje): ?><div class="admin-msg admin-msg-ok"><?= $mensaje ?></div><?php endif; ?>
  <?php if ($error): ?><div class="admin-msg admin-msg-err"><?= htmlspecialchars($error) ?></div><?php endif; ?>

  <div class="toolbar">
    <button onclick="insertTag('h2')">H2</button>
    <button onclick="insertTag('h3')">H3</button>
    <button onclick="insertTag('p')">P</button>
    <button onclick="insertTag('strong')"><b>B</b></button>
    <button onclick="insertTag('em')"><i>I</i></button>
    <button onclick="insertTag('code')">&lt;/&gt;</button>
    <button onclick="insertTag('pre')">Pre</button>
    <button onclick="insertTag('ul')">UL</button>
    <button onclick="insertTag('ol')">OL</button>
    <button onclick="insertTag('li')">LI</button>
    <button onclick="insertTag('table')">Tabla</button>
    <button onclick="insertTag('img')">Img</button>
    <button onclick="insertTag('a')">Link</button>
    <button onclick="insertTag('br')">BR</button>
  </div>

  <form method="post" id="editForm">
    <?= campoTokenCSRF() ?>
    <input type="hidden" name="accion" value="guardar">
    <textarea name="contenido" id="contenido" class="editor-area" spellcheck="false"><?= htmlspecialchars($contenido) ?></textarea>
  </form>

  <div class="word-count" id="wordCount"></div>

  <div class="editor-actions">
    <button class="admin-btn btn-primary" onclick="confirmSave()">💾 Guardar</button>
    <button class="admin-btn admin-btn-warn" onclick="confirmRestore()">↩️ Restaurar original</button>
    <a href="<?= htmlspecialchars($r . '/public/admin/lesson_view.php?slug=' . urlencode($slug)) ?>" class="admin-btn admin-btn-ghost">✕ Cancelar</a>
  </div>

  <div style="margin-top:20px;padding:12px;background:var(--yellow)10;border:1px solid var(--yellow)30;border-radius:8px;font-size:12px;color:var(--muted)">
    <strong style="color:var(--yellow)">⚠️ HTML seguro</strong> — Los scripts y formularios se eliminan autom&aacute;ticamente al guardar por seguridad.
  </div>
</div>

<!-- Confirmaci&oacute;n guardar/restaurar -->
<div id="confirmModal" class="admin-modal-overlay" style="display:none" onclick="if(event.target===this)cerrarConfirm()">
  <div class="admin-modal" style="max-width:380px;text-align:center">
    <div style="font-size:48px;margin-bottom:4px" id="confirmIcon">⚠️</div>
    <h3 id="confirmTitle" style="color:var(--text);margin:0 0 6px 0;font-size:17px"></h3>
    <p id="confirmMsg" style="color:var(--muted);margin:0 0 20px 0;font-size:13px"></p>
    <div style="display:flex;gap:12px;justify-content:center">
      <button class="admin-btn admin-btn-ghost" onclick="cerrarConfirm()">Cancelar</button>
      <button class="admin-btn" id="confirmBtn" style="background:var(--cyan);border-color:var(--cyan);color:#041420" onclick="ejecutarConfirm()">Confirmar</button>
    </div>
  </div>
</div>

<form method="post" id="restoreForm" style="display:none">
  <?= campoTokenCSRF() ?>
  <input type="hidden" name="accion" value="restaurar">
</form>

<script>
var _confirmCb = null;

function mostrarConfirm(title, msg, icon, cb) {
    document.getElementById('confirmIcon').textContent = icon || '⚠️';
    document.getElementById('confirmTitle').textContent = title;
    document.getElementById('confirmMsg').textContent = msg;
    _confirmCb = cb;
    document.getElementById('confirmModal').style.display = 'flex';
}
function cerrarConfirm() { document.getElementById('confirmModal').style.display = 'none'; _confirmCb = null; }
function ejecutarConfirm() { var cb = _confirmCb; cerrarConfirm(); if (cb) cb(); }

function sanitize(html) {
    return html.replace(/<script[^>]*>[\s\S]*?<\/script>/gi, '')
               .replace(/<form[^>]*>/gi, '')
               .replace(/<\/form>/gi, '')
               .replace(/<iframe[^>]*>[\s\S]*?<\/iframe>/gi, '')
               .replace(/on\w+\s*=\s*["\'][^"\']*["\']/gi, '');
}

function confirmSave() {
    var ta = document.getElementById('contenido');
    ta.value = sanitize(ta.value);
    mostrarConfirm('💾 Guardar cambios',
        '¿Guardar los cambios de esta lecci&oacute;n? Se actualizar&aacute; en la base de datos.',
        '💾',
        function() { document.getElementById('editForm').submit(); });
}

function confirmRestore() {
    mostrarConfirm('↩️ Restaurar original',
        '¿Restaurar el contenido original del archivo? Se perder&aacute;n los cambios guardados.',
        '↩️',
        function() { document.getElementById('restoreForm').submit(); });
}

function insertTag(tag) {
    var ta = document.getElementById('contenido');
    var start = ta.selectionStart;
    var end = ta.selectionEnd;
    var sel = ta.value.substring(start, end);
    var open, close;
    switch (tag) {
        case 'h2': open = '<h2>'; close = '</h2>'; break;
        case 'h3': open = '<h3>'; close = '</h3>'; break;
        case 'p': open = '<p>'; close = '</p>'; break;
        case 'strong': open = '<strong>'; close = '</strong>'; break;
        case 'em': open = '<em>'; close = '</em>'; break;
        case 'code': open = '<code>'; close = '</code>'; break;
        case 'pre': open = '<pre>'; close = '</pre>'; break;
        case 'ul': open = '<ul>\n  <li>'; close = '</li>\n</ul>'; break;
        case 'ol': open = '<ol>\n  <li>'; close = '</li>\n</ol>'; break;
        case 'li': open = '<li>'; close = '</li>'; break;
        case 'table': open = '<table>\n  <tr><th></th></tr>\n  <tr><td>'; close = '</td></tr>\n</table>'; break;
        case 'img': open = '<img src="'; close = '" alt="">'; break;
        case 'a': open = '<a href="'; close = '">' + (sel || 'link') + '</a>'; break;
        case 'br': open = '<br>'; close = ''; break;
        default: open = '<' + tag + '>'; close = '</' + tag + '>'; break;
    }
    var replacement = open + sel + close;
    ta.value = ta.value.substring(0, start) + replacement + ta.value.substring(end);
    ta.focus();
    ta.selectionStart = ta.selectionEnd = start + replacement.length;
}

function updateWordCount() {
    var ta = document.getElementById('contenido');
    var text = ta.value;
    var charCount = text.length;
    var wordCount = text.replace(/<[^>]*>/g, '').replace(/\s+/g, ' ').trim();
    var words = wordCount ? wordCount.split(' ').length : 0;
    document.getElementById('wordCount').textContent = words + ' palabras, ' + charCount + ' caracteres';
}

document.getElementById('contenido').addEventListener('input', updateWordCount);
updateWordCount();

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') cerrarConfirm();
    if ((e.ctrlKey || e.metaKey) && e.key === 's') { e.preventDefault(); confirmSave(); }
});
</script>

<?php require __DIR__ . '/../../src/Templates/page_end.php'; ?>
