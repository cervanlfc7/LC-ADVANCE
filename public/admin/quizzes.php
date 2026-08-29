<?php
require_once __DIR__ . '/../../src/Config/config.php';
require_once __DIR__ . '/../../src/Config/csrf.php';
require_once __DIR__ . '/../../src/Core/admin.php';
requireAdmin();

$mensaje = '';
$error   = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && validarTokenCSRF($_POST['csrf_token'] ?? '')) {
    $accion = $_POST['accion'] ?? '';

    if ($accion === 'guardar' && isset($_POST['lesson_slug'])) {
        $slug  = $_POST['lesson_slug'];
        $pregunta  = trim($_POST['pregunta'] ?? '');
        $correcta  = trim($_POST['correcta'] ?? '');
        $opciones  = [];
        for ($i = 0; $i < 4; $i++) {
            $op = trim($_POST["opcion_$i"] ?? '');
            if ($op !== '') $opciones[] = $op;
        }
        $id = isset($_POST['id']) && $_POST['id'] !== '' ? (int)$_POST['id'] : null;
        if ($pregunta && $correcta && count($opciones) >= 2) {
            if (guardarPreguntaQuiz($pdo, $slug, $pregunta, $correcta, $opciones, $id)) {
                $mensaje = 'Pregunta guardada.';
            } else {
                $error = 'Error al guardar.';
            }
        } else {
            $error = 'Completa todos los campos (pregunta, respuesta correcta, al menos 2 opciones).';
        }
    }

    if ($accion === 'eliminar' && isset($_POST['id'])) {
        if (eliminarPreguntaQuiz($pdo, (int)$_POST['id'])) {
            $mensaje = 'Pregunta eliminada.';
        } else {
            $error = 'Error al eliminar.';
        }
    }

    // Importar todo y eliminar uno específico (para file questions)
    if ($accion === 'importar_y_eliminar' && isset($_POST['lesson_slug']) && isset($_POST['file_index'])) {
        $slug_i = $_POST['lesson_slug'];
        $file_idx = (int)$_POST['file_index'];
        $leccion_i = null;
        foreach (obtenerMaterias() as $mat) {
            $archivo = __DIR__ . '/../../src/Content/lessons/' . $mat . '.php';
            if (file_exists($archivo)) {
                $lecciones_materia = require $archivo;
                foreach ($lecciones_materia as $l) {
                    if ($l['slug'] === $slug_i) { $leccion_i = $l; break 2; }
                }
            }
        }
        if ($leccion_i) {
            $n = sincronizarQuizzesDesdeArchivo($pdo, $slug_i, $leccion_i);
            if ($n > 0 && isset($leccion_i['quiz'][$file_idx])) {
                // Desactivar la pregunta específica
                $preguntas_importadas = listarPreguntasQuiz($pdo, $slug_i);
                if (isset($preguntas_importadas[$file_idx])) {
                    eliminarPreguntaQuiz($pdo, $preguntas_importadas[$file_idx]['id']);
                    $mensaje = 'Pregunta eliminada (importada del archivo).';
                } else {
                    $mensaje = "$n preguntas importadas.";
                }
            } elseif ($n > 0) {
                $mensaje = "$n preguntas importadas.";
            } else {
                $error = 'No se encontraron preguntas en el archivo.';
            }
        }
    }

    if ($accion === 'importar' && isset($_POST['lesson_slug'])) {
        $slug_i  = $_POST['lesson_slug'];
        $leccion_i = null;
        foreach (obtenerMaterias() as $mat) {
            $archivo = __DIR__ . '/../../src/Content/lessons/' . $mat . '.php';
            if (file_exists($archivo)) {
                $lecciones_materia = require $archivo;
                foreach ($lecciones_materia as $l) {
                    if ($l['slug'] === $slug_i) { $leccion_i = $l; break 2; }
                }
            }
        }
        if ($leccion_i) {
            $n = sincronizarQuizzesDesdeArchivo($pdo, $slug_i, $leccion_i);
            if ($n > 0) {
                $mensaje = "$n preguntas importadas desde el archivo.";
            } else {
                $error = 'No se encontraron preguntas en el archivo para importar.';
            }
        }
    }
}

$lecciones_todas = [];
foreach (obtenerMaterias() as $mat) {
    $archivo = __DIR__ . '/../../src/Content/lessons/' . $mat . '.php';
    if (file_exists($archivo)) {
        $lecciones_materia = require $archivo;
        foreach ($lecciones_materia as $l) {
            $lecciones_todas[$l['slug']] = $l;
        }
    }
}

$slug_seleccionado = $_GET['slug'] ?? ($_POST['lesson_slug'] ?? '');
if ($slug_seleccionado && !isset($lecciones_todas[$slug_seleccionado])) {
    $slug_seleccionado = '';
}

$preguntas_db   = $slug_seleccionado ? listarPreguntasQuiz($pdo, $slug_seleccionado) : [];
$leccion_actual = $slug_seleccionado ? ($lecciones_todas[$slug_seleccionado] ?? null) : null;
$file_quiz      = $leccion_actual['quiz'] ?? [];

$page_title = 'Editor de Quizzes | Admin | LC-ADVANCE';
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
    <a href="quizzes.php" class="active">Quizzes</a>
    <a href="progress.php">Progreso</a>
    <a href="announcements.php">Anuncios</a>
    <a href="activity.php">Actividad</a>
    <a href="streaks.php">Rachas</a>
    <a href="lessons.php">Lecciones</a>
    <a href="<?= htmlspecialchars(getDashboardUrl()) ?>">← Dashboard</a>
    <a href="<?= htmlspecialchars($r . '/public/logout.php') ?>">🚪 Cerrar sesi&oacute;n</a>
  </nav>
  <main class="admin-main">
    <h1>Editor de Quizzes</h1>
    <?php if ($mensaje): ?><div class="admin-msg admin-msg-ok"><?= $mensaje ?></div><?php endif; ?>
    <?php if ($error): ?><div class="admin-msg admin-msg-err"><?= htmlspecialchars($error) ?></div><?php endif; ?>

    <!-- Selector -->
    <form method="get" class="admin-search" style="margin-bottom:20px">
      <select name="slug" class="admin-input" style="flex:1;max-width:400px" onchange="this.form.submit()">
        <option value="">— Selecciona una lecci&oacute;n —</option>
        <?php
        $materia_actual = '';
        foreach ($lecciones_todas as $slug => $l):
            $slug_materia = preg_replace('/[^a-z]/', '_', strtolower($l['materia'] ?? ''));
            if ($slug_materia !== $materia_actual):
                $materia_actual = $slug_materia;
                echo '<optgroup label="' . htmlspecialchars($l['materia'] ?? '') . '">';
            endif;
        ?>
        <option value="<?= htmlspecialchars($slug) ?>" <?= $slug === $slug_seleccionado ? 'selected' : '' ?>><?= htmlspecialchars($l['titulo'] ?? $slug) ?></option>
        <?php endforeach; ?>
      </select>
      <noscript><button type="submit" class="admin-btn">Ir</button></noscript>
    </form>

    <?php if ($slug_seleccionado && $leccion_actual): ?>

      <!-- Info -->
      <div class="admin-section" style="margin-bottom:16px;padding:12px 16px">
        <div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:8px">
          <div>
            <strong style="color:var(--cyan);font-size:15px"><?= htmlspecialchars($leccion_actual['titulo'] ?? $slug_seleccionado) ?></strong>
            <code style="color:var(--muted);font-size:11px;margin-left:8px"><?= htmlspecialchars($slug_seleccionado) ?></code>
          </div>
          <div style="display:flex;gap:12px;align-items:center;flex-wrap:wrap">
            <span style="font-size:13px"><span style="color:var(--green)"><?= count($preguntas_db) ?></span> en DB</span>
            <span style="font-size:13px"><span style="color:var(--yellow)"><?= count($file_quiz) ?></span> en archivo</span>
            <?php if ($file_quiz && count($preguntas_db) < count($file_quiz)): ?>
            <button type="button" class="admin-btn admin-btn-sm" style="border-color:var(--yellow);color:var(--yellow)" onclick="mostrarConfirm('📥','Importar preguntas','¿Importar <?= count($file_quiz) ?> preguntas del archivo a la DB?',function(){var f=document.createElement('form');f.method='post';f.innerHTML='<?= campoTokenCSRF() ?><input type=hidden name=accion value=importar><input type=hidden name=lesson_slug value=<?= htmlspecialchars($slug_seleccionado) ?>';document.body.appendChild(f);f.submit();})">📥 Importar</button>
            <?php endif; ?>
          </div>
        </div>
      </div>

      <!-- === PREGUNTAS EN DB === -->
      <?php if ($preguntas_db): ?>
      <h3 style="color:var(--green);font-size:14px;margin:0 0 8px 0">✅ Preguntas en base de datos</h3>
      <div style="overflow-x:auto;margin-bottom:20px">
        <table class="admin-table">
          <thead><tr><th>#</th><th>Pregunta</th><th>Opciones</th><th>Correcta</th><th style="width:100px">Acciones</th></tr></thead>
          <tbody>
            <?php foreach ($preguntas_db as $q): $opts = json_decode($q['opciones'], true) ?? []; ?>
            <tr>
              <td><?= (int)$q['orden'] ?></td>
              <td><?= htmlspecialchars($q['pregunta']) ?></td>
              <td style="font-size:12px">
                <?php foreach ($opts as $i => $o): ?>
                <span style="display:inline-block;padding:0 8px;margin:1px;border-radius:4px;background:var(--surface);border:1px solid var(--border)"><?= htmlspecialchars($o) ?></span>
                <?php endforeach; ?>
              </td>
              <td><span style="color:var(--green);font-weight:600"><?= htmlspecialchars($q['correcta']) ?></span></td>
              <td>
                <button class="admin-btn admin-btn-sm edit-btn" data-id="<?= (int)$q['id'] ?>" data-pregunta="<?= htmlspecialchars($q['pregunta'], ENT_QUOTES) ?>" data-correcta="<?= htmlspecialchars($q['correcta'], ENT_QUOTES) ?>" data-opciones='<?= htmlspecialchars(json_encode($opts, JSON_UNESCAPED_UNICODE), ENT_QUOTES) ?>'>✏️</button>
                <button type="button" class="admin-btn admin-btn-sm admin-btn-del del-btn-table" data-id="<?= (int)$q['id'] ?>" data-slug="<?= htmlspecialchars($slug_seleccionado) ?>">🗑️</button>
              </td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
      <?php endif; ?>

      <!-- === PREGUNTAS EN ARCHIVO === -->
      <?php if ($file_quiz): ?>
      <h3 style="color:var(--yellow);font-size:14px;margin:0 0 8px 0">📄 Preguntas en archivo (fallback)</h3>
      <div style="overflow-x:auto;margin-bottom:20px">
        <table class="admin-table" style="opacity:0.7">
          <thead><tr><th>#</th><th>Pregunta</th><th>Opciones</th><th>Correcta</th><th style="width:60px">Acci&oacute;n</th></tr></thead>
          <tbody>
            <?php foreach ($file_quiz as $i => $q): $opts = $q['opciones'] ?? []; ?>
            <tr>
              <td><?= $i + 1 ?></td>
              <td><?= htmlspecialchars($q['pregunta'] ?? '') ?></td>
              <td style="font-size:12px">
                <?php foreach ($opts as $o): ?>
                <span style="display:inline-block;padding:0 8px;margin:1px;border-radius:4px;background:var(--surface);border:1px solid var(--border)"><?= htmlspecialchars($o) ?></span>
                <?php endforeach; ?>
              </td>
              <td><span style="color:var(--green);font-weight:600"><?= htmlspecialchars($q['correcta'] ?? '') ?></span></td>
              <td>
                <button class="admin-btn admin-btn-sm edit-file-btn"
                  data-pregunta="<?= htmlspecialchars($q['pregunta'] ?? '', ENT_QUOTES) ?>"
                  data-correcta="<?= htmlspecialchars($q['correcta'] ?? '', ENT_QUOTES) ?>"
                  data-opciones='<?= htmlspecialchars(json_encode($opts, JSON_UNESCAPED_UNICODE), ENT_QUOTES) ?>'>✏️</button>
                <button type="button" class="admin-btn admin-btn-sm admin-btn-del" onclick="mostrarConfirm('🗑️','Eliminar pregunta','¿Importar todo a DB y eliminar esta pregunta?',function(){var f=document.createElement('form');f.method='post';f.innerHTML='<?= campoTokenCSRF() ?><input type=hidden name=accion value=importar_y_eliminar><input type=hidden name=lesson_slug value=<?= htmlspecialchars($slug_seleccionado) ?>><input type=hidden name=file_index value=<?= $i ?>';document.body.appendChild(f);f.submit();})">🗑️</button>
              </td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
      <?php endif; ?>

      <!-- Botón agregar -->
      <div style="margin-bottom:16px">
        <button class="admin-btn btn-primary" onclick="abrirModal('nueva')">➕ Agregar pregunta</button>
      </div>

      <!-- Modal overlay -->
      <div id="quizModal" class="admin-modal-overlay" style="display:none" onclick="if(event.target===this)cerrarModal()">
        <div class="admin-modal">
          <div class="admin-modal-header">
            <h3 id="modalTitle">➕ Agregar pregunta</h3>
            <button class="admin-btn admin-btn-sm admin-btn-ghost" onclick="cerrarModal()" style="font-size:18px;padding:0 8px">✕</button>
          </div>
          <form method="post" id="quizForm" onsubmit="document.getElementById('modalOverlay').value='1'">
            <?= campoTokenCSRF() ?>
            <input type="hidden" name="accion" value="guardar">
            <input type="hidden" name="lesson_slug" value="<?= htmlspecialchars($slug_seleccionado) ?>">
            <input type="hidden" name="id" id="editId" value="">
            <input type="hidden" name="modal" id="modalOverlay" value="1">

            <div class="admin-field">
              <label for="pregunta">Pregunta</label>
              <textarea id="pregunta" name="pregunta" class="admin-input" rows="3" required style="width:100%"></textarea>
            </div>

            <?php for ($i = 0; $i < 4; $i++): ?>
            <div class="admin-field" style="margin-bottom:10px">
              <label for="opcion_<?= $i ?>">Opci&oacute;n <?= $i + 1 ?></label>
              <input type="text" id="opcion_<?= $i ?>" name="opcion_<?= $i ?>" class="admin-input" placeholder="Opci&oacute;n <?= $i + 1 ?>" required style="width:100%">
            </div>
            <?php endfor; ?>

            <div class="admin-field">
              <label for="correcta">Respuesta correcta</label>
              <div class="admin-field-desc">Debe coincidir exactamente con el texto de una de las opciones de arriba.</div>
              <input type="text" id="correcta" name="correcta" class="admin-input" placeholder="Ej: Célula" required style="width:100%">
            </div>

            <div class="admin-modal-footer" style="display:flex;gap:8px;justify-content:space-between;align-items:center;margin-top:16px">
              <button type="button" class="admin-btn admin-btn-sm admin-btn-del" id="deleteInModalBtn" onclick="eliminarDesdeModal()">🗑️ Eliminar pregunta</button>
              <div style="display:flex;gap:8px">
                <button type="button" class="admin-btn admin-btn-ghost" onclick="cerrarModal()">Cancelar</button>
                <button type="submit" class="admin-btn btn-primary" id="submitBtn">💾 Guardar pregunta</button>
              </div>
            </div>
          </form>
        </div>
      </div>

      <!-- Confirmaci&oacute;n elegante -->
      <div id="confirmModal" class="admin-modal-overlay" style="display:none" onclick="if(event.target===this)cerrarConfirm()">
        <div class="admin-modal" style="max-width:400px;text-align:center">
          <div style="font-size:48px;margin-bottom:4px" id="confirmIcon">⚠️</div>
          <h3 id="confirmTitle" style="color:var(--text);margin:0 0 6px 0;font-size:18px"></h3>
          <p id="confirmMsg" style="color:var(--muted);margin:0 0 20px 0;font-size:13px"></p>
          <div style="display:flex;gap:12px;justify-content:center">
            <button class="admin-btn admin-btn-ghost" onclick="cerrarConfirm()">Cancelar</button>
            <button class="admin-btn" id="confirmBtn" style="background:var(--cyan);border-color:var(--cyan);color:#041420" onclick="ejecutarConfirm()">Confirmar</button>
          </div>
        </div>
      </div>

    <?php elseif (!$slug_seleccionado): ?>
    <div class="admin-empty">
      <div style="font-size:48px;margin-bottom:8px">📝</div>
      <p>Selecciona una lecci&oacute;n del men&uacute; de arriba para editar sus preguntas de quiz.</p>
      <p style="font-size:12px;color:var(--muted);margin-top:8px">Las preguntas en DB reemplazan a las del archivo. Usa el bot&oacute;n <strong>Importar</strong> para copiar las del archivo a la DB y luego ed&iacute;talas.</p>
    </div>
    <?php endif; ?>
  </main>
</div>

<script>
var deleteSlug = '';
var deleteId   = 0;
var _confirmCb = null;

function abrirModal(modo, data) {
    document.getElementById('editId').value = '';
    document.getElementById('quizForm').reset();
    document.getElementById('deleteInModalBtn').classList.add('is-hidden');
    if (modo === 'nueva') {
        document.getElementById('modalTitle').textContent = '➕ Nueva pregunta';
        document.getElementById('submitBtn').textContent = '💾 Guardar pregunta';
    } else if (modo === 'editar') {
        document.getElementById('editId').value = data.id;
        document.getElementById('pregunta').value = data.pregunta;
        document.getElementById('correcta').value = data.correcta;
        (data.opciones || []).forEach(function(v,i) {
            var el = document.getElementById('opcion_' + i);
            if (el) el.value = v || '';
        });
        document.getElementById('modalTitle').textContent = '✏️ Editar pregunta #' + data.id;
        document.getElementById('submitBtn').textContent = '💾 Actualizar pregunta';
        document.getElementById('deleteInModalBtn').classList.remove('is-hidden');
        deleteSlug = data.slug;
        deleteId   = data.id;
    }
    document.getElementById('quizModal').style.display = 'flex';
    document.getElementById('pregunta').focus();
}

function cerrarModal() {
    document.getElementById('quizModal').style.display = 'none';
}

function eliminarDesdeModal() {
    mostrarConfirm('⚠️', 'Eliminar pregunta', '¿Eliminar esta pregunta permanentemente?', function() {
        var f = document.createElement('form');
        f.method = 'post';
        f.innerHTML = '<?= campoTokenCSRF() ?><input type="hidden" name="accion" value="eliminar"><input type="hidden" name="id" value="' + deleteId + '"><input type="hidden" name="lesson_slug" value="' + deleteSlug + '">';
        document.body.appendChild(f);
        f.submit();
    });
}

function mostrarConfirm(icon, title, msg, cb) {
    document.getElementById('confirmIcon').textContent = icon;
    document.getElementById('confirmTitle').textContent = title;
    document.getElementById('confirmMsg').textContent = msg;
    _confirmCb = cb;
    document.getElementById('confirmModal').style.display = 'flex';
}

function cerrarConfirm() {
    document.getElementById('confirmModal').style.display = 'none';
    _confirmCb = null;
}

function ejecutarConfirm() {
    var cb = _confirmCb;
    cerrarConfirm();
    if (cb) cb();
}

// ── Botones de eliminar en tabla DB ──
document.querySelectorAll('.del-btn-table').forEach(function(btn) {
    btn.addEventListener('click', function() {
        mostrarConfirm('🗑️', 'Eliminar pregunta', '¿Eliminar esta pregunta permanentemente?', function() {
            var f = document.createElement('form');
            f.method = 'post';
            f.innerHTML = '<?= campoTokenCSRF() ?><input type="hidden" name="accion" value="eliminar"><input type="hidden" name="id" value="' + btn.dataset.id + '"><input type="hidden" name="lesson_slug" value="' + btn.dataset.slug + '">';
            document.body.appendChild(f);
            f.submit();
        });
    });
});

// ── Botones de editar DB ──
document.querySelectorAll('.edit-btn').forEach(function(btn) {
    btn.addEventListener('click', function() {
        var opciones;
        try { opciones = JSON.parse(this.dataset.opciones); } catch(e) { opciones = []; }
        abrirModal('editar', {
            id: this.dataset.id,
            pregunta: this.dataset.pregunta,
            correcta: this.dataset.correcta,
            opciones: opciones,
            slug: '<?= htmlspecialchars($slug_seleccionado) ?>'
        });
    });
});

// ── Botones de editar archivo ──
document.querySelectorAll('.edit-file-btn').forEach(function(btn) {
    btn.addEventListener('click', function() {
        var opciones;
        try { opciones = JSON.parse(this.dataset.opciones); } catch(e) { opciones = []; }
        document.getElementById('editId').value = '';
        document.getElementById('quizForm').reset();
        document.getElementById('pregunta').value = this.dataset.pregunta;
        document.getElementById('correcta').value = this.dataset.correcta;
        (opciones || []).forEach(function(v,i) {
            var el = document.getElementById('opcion_' + i);
            if (el) el.value = v || '';
        });
        document.getElementById('modalTitle').textContent = '📄 Desde archivo (se guardar\u00e1 en DB)';
        document.getElementById('submitBtn').textContent = '💾 Guardar en DB';
        document.getElementById('deleteInModalBtn').classList.add('is-hidden');
        document.getElementById('quizModal').style.display = 'flex';
        document.getElementById('pregunta').focus();
    });
});

// ── Confirmar guardar (add/edit) ──
document.getElementById('quizForm').addEventListener('submit', function(e) {
    e.preventDefault();
    var esNueva = document.getElementById('editId').value === '';
    mostrarConfirm('💾', esNueva ? 'Guardar pregunta' : 'Actualizar pregunta',
        esNueva ? '¿Guardar esta nueva pregunta en la base de datos?' : '¿Actualizar esta pregunta en la base de datos?',
        function() { document.getElementById('quizForm').submit(); }
    );
});

// ── Cerrar modales con Escape ──
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') { cerrarModal(); cerrarConfirm(); }
});
</script>

<?php require __DIR__ . '/../../src/Templates/page_end.php'; ?>
