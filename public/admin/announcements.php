<?php
require_once __DIR__ . '/../../src/Config/config.php';
require_once __DIR__ . '/../../src/Config/csrf.php';
require_once __DIR__ . '/../../src/Core/admin.php';
requireAdmin();

$mensaje = '';
$error   = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && validarTokenCSRF($_POST['csrf_token'] ?? '')) {
    $accion = $_POST['accion'] ?? '';
    if ($accion === 'crear' && !empty($_POST['titulo']) && !empty($_POST['contenido'])) {
        $tipos_validos = ['info', 'success', 'warning', 'danger'];
        $tipo = in_array($_POST['tipo'] ?? '', $tipos_validos) ? $_POST['tipo'] : 'info';
        if (crearAnuncio($pdo, trim($_POST['titulo']), trim($_POST['contenido']), $tipo)) {
            logActividad('ADMIN_ANNOUNCEMENT_CREATE', 'Anuncio: ' . mb_substr($_POST['titulo'], 0, 50), $_SESSION['usuario_id']);
            $mensaje = 'Anuncio creado.';
        } else $error = 'Error al crear.';
    } elseif ($accion === 'editar' && isset($_POST['id']) && !empty($_POST['titulo'])) {
        $id = (int)$_POST['id'];
        $tipos_validos = ['info', 'success', 'warning', 'danger'];
        $tipo = in_array($_POST['tipo'] ?? '', $tipos_validos) ? $_POST['tipo'] : 'info';
        if (editarAnuncio($pdo, $id, trim($_POST['titulo']), trim($_POST['contenido']), $tipo)) {
            logActividad('ADMIN_ANNOUNCEMENT_EDIT', "Anuncio #$id", $_SESSION['usuario_id']);
            $mensaje = 'Anuncio actualizado.';
        } else $error = 'Error al actualizar.';
    } elseif ($accion === 'eliminar' && isset($_POST['id'])) {
        eliminarAnuncio($pdo, (int)$_POST['id']);
        logActividad('ADMIN_ANNOUNCEMENT_DELETE', "Anuncio #{$_POST['id']}", $_SESSION['usuario_id']);
        $mensaje = 'Anuncio eliminado.';
    } elseif ($accion === 'toggle' && isset($_POST['id'])) {
        toggleAnuncio($pdo, (int)$_POST['id']);
        $mensaje = 'Estado cambiado.';
    }
}

$anuncios = listarAnuncios($pdo);
$tipos_anuncio = [
    'info'    => ['ℹ️', 'var(--cyan)'],
    'success' => ['✅', 'var(--green)'],
    'warning' => ['⚠️', 'var(--yellow)'],
    'danger'  => ['🚨', 'var(--red)'],
];

$page_title = 'Anuncios | Admin | LC-ADVANCE';
$r = appRootPath();
$page_show_bg_orb = true;
$page_extra_head = '<link rel="stylesheet" href="' . $r . '/public/assets/css/dashboard.css?v=' . filemtime(__DIR__ . '/../assets/css/dashboard.css') . '">' . "\n" .
    '<link rel="stylesheet" href="' . $r . '/public/assets/css/admin.css?v=' . filemtime(__DIR__ . '/../assets/css/admin.css') . '">';
require __DIR__ . '/../../src/Templates/page_start.php';
?>
<div class="admin-wrap">
  <nav class="admin-nav">
    <h2>⚙️ Admin</h2>
    <a href="index.php">Dashboard</a>
    <a href="usuarios.php">Usuarios</a>
    <a href="logros.php">Logros</a>
    <a href="logs.php">Logs</a>
    <a href="settings.php">Config</a>
    <a href="backup.php">Respaldos</a>
    <a href="quizzes.php">Quizzes</a>
    <a href="progress.php">Progreso</a>
    <a href="announcements.php" class="active">Anuncios</a>
    <a href="activity.php">Actividad</a>
    <a href="streaks.php">Rachas</a>
    <a href="lessons.php">Lecciones</a>
    <a href="<?= htmlspecialchars(getDashboardUrl()) ?>">← Dashboard</a>
    <a href="<?= htmlspecialchars($r . '/public/logout.php') ?>">🚪 Cerrar sesi&oacute;n</a>
  </nav>
  <main class="admin-main">
    <h1>Anuncios del Sistema</h1>
    <?php if ($mensaje): ?><div class="admin-msg admin-msg-ok"><?= $mensaje ?></div><?php endif; ?>
    <?php if ($error): ?><div class="admin-msg admin-msg-err"><?= htmlspecialchars($error) ?></div><?php endif; ?>

    <div style="margin-bottom:16px">
      <button class="admin-btn btn-primary" onclick="abrirModalAnuncio('nueva')">➕ Nuevo anuncio</button>
    </div>

    <?php if ($anuncios): ?>
    <div style="overflow-x:auto">
      <table class="admin-table">
        <thead><tr><th>ID</th><th>T&iacute;tulo</th><th>Tipo</th><th>Estado</th><th>Creado</th><th style="width:140px">Acciones</th></tr></thead>
        <tbody>
          <?php foreach ($anuncios as $a): $t = $tipos_anuncio[$a['tipo']] ?? ['ℹ️', 'var(--cyan)']; ?>
          <tr>
            <td class="admin-cell-mono"><?= $a['id'] ?></td>
            <td class="admin-cell-trunc"><strong><?= htmlspecialchars($a['titulo']) ?></strong></td>
            <td><span style="display:inline-flex;align-items:center;gap:4px;padding:2px 8px;border-radius:20px;font-size:10px;font-weight:600;background:<?= $t[1] ?>15;color:<?= $t[1] ?>;border:1px solid <?= $t[1] ?>35"><?= $t[0] ?> <?= $a['tipo'] ?></span></td>
            <td><?= $a['activo'] ? '<span style="color:var(--green);font-weight:600">Activo</span>' : '<span style="color:var(--muted)">Inactivo</span>' ?></td>
            <td class="admin-cell-mono"><?= date('d/m/Y H:i', strtotime($a['created_at'])) ?></td>
            <td>
              <button class="admin-btn admin-btn-sm edit-ann-btn" data-id="<?= $a['id'] ?>" data-titulo="<?= htmlspecialchars($a['titulo'], ENT_QUOTES) ?>" data-contenido="<?= htmlspecialchars($a['contenido'], ENT_QUOTES) ?>" data-tipo="<?= $a['tipo'] ?>">✏️</button>
              <form method="post" style="display:inline" id="toggleForm_<?= $a['id'] ?>">
                <?= campoTokenCSRF() ?>
                <input type="hidden" name="accion" value="toggle">
                <input type="hidden" name="id" value="<?= $a['id'] ?>">
                <button type="button" class="admin-btn admin-btn-sm" onclick="confirmToggle(<?= $a['id'] ?>, <?= $a['activo'] ? 'true' : 'false' ?>)"><?= $a['activo'] ? '🙈' : '👁️' ?></button>
              </form>
              <button type="button" class="admin-btn admin-btn-sm admin-btn-del" onclick="confirmDelAnuncio(<?= $a['id'] ?>)">🗑️</button>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
    <?php else: ?>
    <div class="admin-empty">
      <div style="font-size:48px;margin-bottom:8px">📢</div>
      <p>Sin anuncios. Crea el primero con el bot&oacute;n de arriba.</p>
    </div>
    <?php endif; ?>

    <!-- Modal anuncio -->
    <div id="annModal" class="admin-modal-overlay" style="display:none" onclick="if(event.target===this)cerrarAnnModal()">
      <div class="admin-modal" style="max-width:520px">
        <div class="admin-modal-header">
          <h3 id="annModalTitle">➕ Nuevo anuncio</h3>
          <button class="admin-btn admin-btn-sm admin-btn-ghost" onclick="cerrarAnnModal()" style="font-size:18px;padding:0 8px">✕</button>
        </div>
        <form method="post" id="annForm">
          <?= campoTokenCSRF() ?>
          <input type="hidden" name="accion" id="annAccion" value="crear">
          <input type="hidden" name="id" id="annId" value="">

          <div class="admin-field">
            <label for="annTitulo">T&iacute;tulo</label>
            <input type="text" id="annTitulo" name="titulo" class="admin-input" required placeholder="T&iacute;tulo del anuncio">
          </div>

          <div class="admin-field">
            <label for="annTipo">Tipo</label>
            <select id="annTipo" name="tipo" class="admin-input">
              <option value="info">ℹ️ Informaci&oacute;n</option>
              <option value="success">✅ &Eacute;xito</option>
              <option value="warning">⚠️ Advertencia</option>
              <option value="danger">🚨 Importante</option>
            </select>
          </div>

          <div class="admin-field">
            <label for="annContenido">Contenido</label>
            <textarea id="annContenido" name="contenido" class="admin-input" rows="4" required placeholder="Contenido del anuncio…"></textarea>
          </div>

          <div class="admin-modal-footer" style="display:flex;gap:8px;justify-content:flex-end;margin-top:16px">
            <button type="button" class="admin-btn admin-btn-ghost" onclick="cerrarAnnModal()">Cancelar</button>
            <button type="submit" class="admin-btn btn-primary" id="annSubmitBtn">📢 Publicar</button>
          </div>
        </form>
      </div>
    </div>

    <!-- Confirmaci&oacute;n -->
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
  </main>
</div>

<script>
var _confirmCb = null;
var _delId = 0;

function mostrarConfirm(icon, title, msg, cb) {
    document.getElementById('confirmIcon').textContent = icon;
    document.getElementById('confirmTitle').textContent = title;
    document.getElementById('confirmMsg').textContent = msg;
    _confirmCb = cb;
    document.getElementById('confirmModal').style.display = 'flex';
}
function cerrarConfirm() { document.getElementById('confirmModal').style.display = 'none'; _confirmCb = null; }
function ejecutarConfirm() { var cb = _confirmCb; cerrarConfirm(); if (cb) cb(); }

function abrirModalAnuncio(modo, data) {
    document.getElementById('annForm').reset();
    document.getElementById('annId').value = '';
    if (modo === 'nueva') {
        document.getElementById('annModalTitle').textContent = '➕ Nuevo anuncio';
        document.getElementById('annAccion').value = 'crear';
        document.getElementById('annSubmitBtn').textContent = '📢 Publicar';
    } else if (modo === 'editar') {
        document.getElementById('annModalTitle').textContent = '✏️ Editar anuncio #' + data.id;
        document.getElementById('annAccion').value = 'editar';
        document.getElementById('annId').value = data.id;
        document.getElementById('annTitulo').value = data.titulo;
        document.getElementById('annContenido').value = data.contenido;
        document.getElementById('annTipo').value = data.tipo;
        document.getElementById('annSubmitBtn').textContent = '💾 Guardar';
    }
    document.getElementById('annModal').style.display = 'flex';
    document.getElementById('annTitulo').focus();
}
function cerrarAnnModal() { document.getElementById('annModal').style.display = 'none'; }

document.querySelectorAll('.edit-ann-btn').forEach(function(btn) {
    btn.addEventListener('click', function() {
        abrirModalAnuncio('editar', {
            id: this.dataset.id,
            titulo: this.dataset.titulo,
            contenido: this.dataset.contenido,
            tipo: this.dataset.tipo,
        });
    });
});

function confirmDelAnuncio(id) {
    _delId = id;
    mostrarConfirm('🗑️', 'Eliminar anuncio', '¿Eliminar este anuncio permanentemente?', function() {
        var f = document.createElement('form');
        f.method = 'post';
        f.innerHTML = '<?= campoTokenCSRF() ?><input type="hidden" name="accion" value="eliminar"><input type="hidden" name="id" value="' + _delId + '">';
        document.body.appendChild(f);
        f.submit();
    });
}

function confirmToggle(id, activo) {
    mostrarConfirm(activo ? '🙈' : '👁️', activo ? 'Desactivar anuncio' : 'Activar anuncio',
        activo ? '¿Ocultar este anuncio a los usuarios?' : '¿Mostrar este anuncio a los usuarios?',
        function() { document.getElementById('toggleForm_' + id).submit(); }
    );
}

document.getElementById('annForm').addEventListener('submit', function(e) {
    e.preventDefault();
    var esNueva = document.getElementById('annId').value === '';
    mostrarConfirm('📢', esNueva ? 'Publicar anuncio' : 'Guardar anuncio',
        esNueva ? '¿Publicar este anuncio para todos los usuarios?' : '¿Guardar los cambios de este anuncio?',
        function() { document.getElementById('annForm').submit(); }
    );
});

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') { cerrarAnnModal(); cerrarConfirm(); }
});
</script>

<?php require __DIR__ . '/../../src/Templates/page_end.php'; ?>
