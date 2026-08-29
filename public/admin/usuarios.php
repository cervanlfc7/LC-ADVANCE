<?php
require_once __DIR__ . '/../../src/Config/config.php';
require_once __DIR__ . '/../../src/Config/csrf.php';
require_once __DIR__ . '/../../src/Core/admin.php';
requireAdmin();

$mensaje = '';
$error = '';

$pagina = max(1, (int)($_GET['p'] ?? 1));
$busqueda = trim($_GET['q'] ?? '');
$orden = $_GET['o'] ?? 'id';
$dir = $_GET['d'] ?? 'DESC';

// Export CSV
if (isset($_GET['export']) && $_GET['export'] === 'csv') {
    $stmt = $pdo->query("SELECT id, nombre_usuario, correo, puntos, nivel, tipo, email_verified, ultimo_login, racha_actual, DATE(creado_en) AS fecha_registro FROM usuarios ORDER BY id ASC");
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename="usuarios_' . date('Y-m-d') . '.csv"');
    $out = fopen('php://output', 'w');
    fputcsv($out, ['ID','Usuario','Correo','Puntos','Nivel','Rol','Verificado','Ultimo Login','Racha','Registro']);
    foreach ($rows as $r) {
        fputcsv($out, [$r['id'], $r['nombre_usuario'], $r['correo'], $r['puntos'], $r['nivel'], $r['tipo'], $r['email_verified'] ? 'Si' : 'No', $r['ultimo_login'] ?? '', $r['racha_actual'], $r['fecha_registro']]);
    }
    fclose($out);
    exit;
}

// Load badges for batch grant dropdown
$todos_badges = $pdo->query("SELECT id, nombre_badge, icono FROM badges ORDER BY orden ASC, id ASC")->fetchAll(PDO::FETCH_ASSOC);

// Handle actions
if ($_SERVER['REQUEST_METHOD'] === 'POST' && validarCsrfToken($_POST['csrf_token'] ?? '')) {
    $accion = $_POST['accion'] ?? '';
    $uid = (int)($_POST['usuario_id'] ?? 0);

    // ── Single-user actions ──────────────────────────────────────────────
    if ($accion === 'cambiar_rol' && $uid > 0) {
        $nuevo_rol = $_POST['rol'] ?? '';
        if (actualizarRolUsuario($pdo, $uid, $nuevo_rol)) {
            logSeguridadEvento('ADMIN_ROLE_CHANGE', "Usuario ID: {$uid} → Rol: {$nuevo_rol}", $_SESSION['usuario_id']);
            $mensaje = 'Rol actualizado correctamente.';
        } else {
            $error = 'No se pudo cambiar el rol.';
        }
    } elseif ($accion === 'ajustar_puntos' && $uid > 0) {
        $puntos = (int)($_POST['puntos'] ?? 0);
        if (actualizarPuntosAdmin($pdo, $uid, $puntos)) {
            logSeguridadEvento('ADMIN_POINTS_ADJUST', "Usuario ID: {$uid} → Puntos: {$puntos}", $_SESSION['usuario_id']);
            $mensaje = 'Puntos actualizados correctamente.';
        } else {
            $error = 'No se pudieron actualizar los puntos.';
        }
    } elseif ($accion === 'eliminar' && $uid > 0) {
        if (eliminarUsuario($pdo, $uid)) {
            logSeguridadEvento('ADMIN_USER_DELETE', "Usuario ID eliminado: {$uid}", $_SESSION['usuario_id']);
            $mensaje = 'Usuario eliminado.';
        } else {
            $error = 'No se pudo eliminar.';
        }
    } elseif ($accion === 'verificar_email' && $uid > 0) {
        $stmt = $pdo->prepare("UPDATE usuarios SET email_verified = 1 WHERE id = ?");
        $stmt->execute([$uid]);
        logSeguridadEvento('ADMIN_EMAIL_VERIFY', "Usuario ID: {$uid}", $_SESSION['usuario_id']);
        $mensaje = 'Correo marcado como verificado.';
    } elseif ($accion === 'crear_usuario') {
        $username = trim($_POST['username'] ?? '');
        $email    = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        $role     = $_POST['rol'] ?? 'student';
        if (strlen($username) < 3) {
            $error = 'El nombre de usuario debe tener al menos 3 caracteres.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = 'Correo inválido.';
        } elseif (strlen($password) < 6) {
            $error = 'La contraseña debe tener al menos 6 caracteres.';
        } elseif (!in_array($role, ['student', 'teacher', 'admin'], true)) {
            $error = 'Rol inválido.';
        } else {
            $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE nombre_usuario = ? OR correo = ?");
            $stmt->execute([$username, $email]);
            if ($stmt->fetch()) {
                $error = 'El nombre de usuario o correo ya existe.';
            } else {
                $hash = password_hash($password, PASSWORD_BCRYPT);
                $stmt = $pdo->prepare("INSERT INTO usuarios (nombre_usuario, correo, contrasena_hash, tipo, email_verified, creado_en) VALUES (?, ?, ?, ?, 1, NOW())");
                $stmt->execute([$username, $email, $hash, $role]);
                $nuevo_id = (int)$pdo->lastInsertId();
                logSeguridadEvento('ADMIN_CREATE_USER', "Creado usuario ID: {$nuevo_id} | {$username} ({$email})", $_SESSION['usuario_id']);
                $mensaje = "Usuario <strong>" . htmlspecialchars($username) . "</strong> creado (ID: {$nuevo_id}).";
            }
        }
    } elseif ($accion === 'editar_usuario' && $uid > 0) {
        $username    = trim($_POST['username'] ?? '');
        $email       = trim($_POST['email'] ?? '');
        $new_pass    = $_POST['new_password'] ?? '';
        $notas_admin = trim($_POST['notas_admin'] ?? '');
        if (strlen($username) < 3) {
            $error = 'El nombre de usuario debe tener al menos 3 caracteres.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = 'Correo inválido.';
        } else {
            $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE (nombre_usuario = ? OR correo = ?) AND id != ?");
            $stmt->execute([$username, $email, $uid]);
            if ($stmt->fetch()) {
                $error = 'El nombre de usuario o correo ya está en uso.';
            } else {
                // Build dynamic UPDATE to optionally change password
                if ($new_pass !== '' && strlen($new_pass) >= 6) {
                    $hash_new = password_hash($new_pass, PASSWORD_BCRYPT);
                    $stmt = $pdo->prepare("UPDATE usuarios SET nombre_usuario = ?, correo = ?, contrasena_hash = ?, notas_admin = ? WHERE id = ?");
                    $stmt->execute([$username, $email, $hash_new, $notas_admin ?: null, $uid]);
                    logSeguridadEvento('ADMIN_CHANGE_PASSWORD', "Contraseña cambiada por admin para usuario ID: {$uid}", $_SESSION['usuario_id']);
                } elseif ($new_pass !== '' && strlen($new_pass) < 6) {
                    $error = 'La nueva contraseña debe tener al menos 6 caracteres.';
                    goto skip_edit_success;
                } else {
                    $stmt = $pdo->prepare("UPDATE usuarios SET nombre_usuario = ?, correo = ?, notas_admin = ? WHERE id = ?");
                    $stmt->execute([$username, $email, $notas_admin ?: null, $uid]);
                }
                logSeguridadEvento('ADMIN_EDIT_USER', "Editado usuario ID: {$uid} → {$username} ({$email})", $_SESSION['usuario_id']);
                $mensaje = 'Usuario actualizado correctamente.';
                skip_edit_success:;
            }
        }

    // ── Batch operations ─────────────────────────────────────────────────
    } elseif ($accion === 'batch_cambiar_rol') {
        $ids       = array_filter(array_map('intval', (array)($_POST['selected_users'] ?? [])));
        $nuevo_rol = $_POST['batch_rol'] ?? '';
        if (!in_array($nuevo_rol, ['student', 'teacher', 'admin'], true)) {
            $error = 'Rol inválido para operación masiva.';
        } elseif (empty($ids)) {
            $error = 'No se seleccionaron usuarios.';
        } else {
            $ok = 0;
            foreach ($ids as $bid_u) {
                if ($bid_u === (int)$_SESSION['usuario_id']) continue; // skip self
                if (actualizarRolUsuario($pdo, $bid_u, $nuevo_rol)) $ok++;
            }
            logSeguridadEvento('ADMIN_BATCH_ROLE', "Batch rol → {$nuevo_rol} para " . count($ids) . " usuarios", $_SESSION['usuario_id']);
            $mensaje = "Rol cambiado a <strong>{$nuevo_rol}</strong> para {$ok} usuario(s).";
        }
    } elseif ($accion === 'batch_eliminar') {
        $ids = array_filter(array_map('intval', (array)($_POST['selected_users'] ?? [])));
        if (empty($ids)) {
            $error = 'No se seleccionaron usuarios.';
        } else {
            $ok = 0;
            foreach ($ids as $bid_u) {
                if ($bid_u === (int)$_SESSION['usuario_id']) continue; // protect self
                if (eliminarUsuario($pdo, $bid_u)) $ok++;
            }
            logSeguridadEvento('ADMIN_BATCH_DELETE', "Batch eliminar {$ok} usuarios", $_SESSION['usuario_id']);
            $mensaje = "{$ok} usuario(s) eliminado(s).";
        }
    } elseif ($accion === 'batch_otorgar_badge') {
        $ids   = array_filter(array_map('intval', (array)($_POST['selected_users'] ?? [])));
        $bid   = (int)($_POST['batch_badge_id'] ?? 0);
        if ($bid <= 0) {
            $error = 'Selecciona un badge válido.';
        } elseif (empty($ids)) {
            $error = 'No se seleccionaron usuarios.';
        } else {
            $ok = 0;
            foreach ($ids as $bid_u) {
                $check = $pdo->prepare("SELECT COUNT(*) FROM usuarios_badges WHERE usuario_id = ? AND badge_id = ?");
                $check->execute([$bid_u, $bid]);
                if ($check->fetchColumn() == 0) {
                    if (function_exists('otorgarBadge')) {
                        otorgarBadge($bid_u, $bid, $pdo);
                    } else {
                        $pdo->prepare("INSERT IGNORE INTO usuarios_badges (usuario_id, badge_id) VALUES (?, ?)")->execute([$bid_u, $bid]);
                    }
                    if (function_exists('crearNotificacion')) {
                        $nb = $pdo->prepare("SELECT nombre_badge FROM badges WHERE id = ?");
                        $nb->execute([$bid]);
                        $bnombre = $nb->fetchColumn();
                        crearNotificacion($bid_u, "🏆 Logro desbloqueado: $bnombre", "¡Un administrador te ha otorgado la insignia '$bnombre'!", $pdo);
                    }
                    $ok++;
                }
            }
            $bname_stmt = $pdo->prepare("SELECT nombre_badge FROM badges WHERE id = ?");
            $bname_stmt->execute([$bid]);
            $bname = $bname_stmt->fetchColumn() ?: "ID:{$bid}";
            logSeguridadEvento('ADMIN_BATCH_BADGE', "Batch badge '{$bname}' → {$ok} usuarios", $_SESSION['usuario_id']);
            $mensaje = "Badge <strong>" . htmlspecialchars($bname) . "</strong> otorgado a {$ok} usuario(s).";
        }
    }
}

$data = listarUsuarios($pdo, $pagina, $busqueda, $orden, $dir);

$page_title = 'Usuarios | Admin | LC-ADVANCE';
$r = appRootPath();
$page_show_bg_orb = true;
$v = filemtime(__DIR__ . '/../assets/css/admin.css');
$page_extra_head = '<link rel="stylesheet" href="' . $r . '/public/assets/css/dashboard.css?v=' . filemtime(__DIR__ . '/../assets/css/dashboard.css') . '">' . "\n" .
    '<link rel="stylesheet" href="' . $r . '/public/assets/css/admin.css?v=' . $v . '">';
require __DIR__ . '/../../src/Templates/page_start.php';
?>

<div class="admin-wrap">
  <nav class="admin-nav">
    <h2>⚙️ Admin</h2>
    <a href="index.php">Dashboard</a>
    <a href="usuarios.php" class="active">Usuarios</a>
    <a href="logros.php">Logros</a>
    <a href="logs.php">Logs</a>
    <a href="settings.php">Config</a>
    <a href="backup.php">Respaldos</a>
    <a href="quizzes.php">Quizzes</a>
    <a href="progress.php">Progreso</a>
    <a href="announcements.php">Anuncios</a>
    <a href="activity.php">Actividad</a>
    <a href="streaks.php">Rachas</a>
    <a href="lessons.php">Lecciones</a>
    <a href="<?= htmlspecialchars(getDashboardUrl()) ?>">← Dashboard</a>
    <a href="<?= htmlspecialchars(appRootPath() . '/public/logout.php') ?>">🚪 Cerrar sesión</a>
  </nav>

  <main class="admin-main">
    <h1>Gestión de Usuarios</h1>

    <?php if ($mensaje): ?><div class="admin-msg admin-msg-ok"><?= $mensaje ?></div><?php endif; ?>
    <?php if ($error): ?><div class="admin-msg admin-msg-err"><?= htmlspecialchars($error) ?></div><?php endif; ?>

    <!-- Crear usuario -->
    <details class="admin-section" style="margin-bottom:16px">
      <summary style="cursor:pointer;font-weight:600;font-size:0.85rem;color:var(--cyan);padding:8px 0;">➕ Crear nuevo usuario</summary>
      <form method="post" style="display:flex;gap:8px;flex-wrap:wrap;margin-top:8px;">
        <?= campoTokenCSRF() ?>
        <input type="hidden" name="accion" value="crear_usuario">
        <input type="text" name="username" placeholder="Usuario" required class="admin-input" style="flex:1;min-width:140px">
        <input type="email" name="email" placeholder="Correo" required class="admin-input" style="flex:1;min-width:180px">
        <input type="password" name="password" placeholder="Contraseña" required class="admin-input" style="flex:1;min-width:120px">
        <select name="rol" class="admin-input" style="width:100px">
          <option value="student">Student</option>
          <option value="teacher">Teacher</option>
          <option value="admin">Admin</option>
        </select>
        <button type="submit" class="admin-btn admin-btn-sm">Crear</button>
      </form>
    </details>

    <form method="get" class="admin-search">
      <input type="text" name="q" placeholder="Buscar usuario o correo…" value="<?= htmlspecialchars($busqueda) ?>" class="admin-input" style="flex:1;max-width:300px">
      <button type="submit" class="admin-btn">🔍 Buscar</button>
      <?php if ($busqueda): ?><a href="usuarios.php" class="admin-btn admin-btn-ghost">✕ Limpiar</a><?php endif; ?>
      <a href="?export=csv" class="admin-btn" style="margin-left:auto">📥 Exportar CSV</a>
    </form>

    <!-- ─── Batch operations toolbar (hidden until checkboxes selected) ─── -->
    <form method="post" id="batch-form">
      <?= campoTokenCSRF() ?>

      <div id="batch-toolbar" style="display:none;align-items:center;gap:8px;flex-wrap:wrap;padding:10px 14px;background:var(--surface2);border:1px solid var(--cyan);border-radius:8px;margin-bottom:12px;">
        <span id="batch-count" style="font-size:0.82rem;color:var(--cyan);font-weight:600;white-space:nowrap;">0 seleccionados</span>

        <!-- Cambiar rol -->
        <select name="batch_rol" class="admin-input" style="width:110px">
          <option value="student">student</option>
          <option value="teacher">teacher</option>
          <option value="admin">admin</option>
        </select>
        <button type="submit" name="accion" value="batch_cambiar_rol" class="admin-btn admin-btn-sm admin-btn-warn"
                onclick="return confirmBatch('¿Cambiar rol de los usuarios seleccionados?')">🔄 Cambiar rol</button>

        <!-- Otorgar badge -->
        <select name="batch_badge_id" class="admin-input" style="width:160px">
          <option value="">— Badge —</option>
          <?php foreach ($todos_badges as $b): ?>
          <option value="<?= (int)$b['id'] ?>"><?= htmlspecialchars($b['nombre_badge']) ?></option>
          <?php endforeach; ?>
        </select>
        <button type="submit" name="accion" value="batch_otorgar_badge" class="admin-btn admin-btn-sm"
                onclick="return confirmBatch('¿Otorgar badge a los usuarios seleccionados?')">🏆 Otorgar badge</button>

        <!-- Eliminar -->
        <button type="submit" name="accion" value="batch_eliminar" class="admin-btn admin-btn-sm admin-btn-danger"
                onclick="return confirmBatch('¿ELIMINAR los usuarios seleccionados? Esta acción NO se puede deshacer.')">🗑️ Eliminar</button>

        <button type="button" class="admin-btn admin-btn-sm admin-btn-ghost" onclick="deselectAll()">✕ Quitar selección</button>
      </div>

    <div class="admin-total"><?= $data['total'] ?> usuarios — página <?= $data['pagina'] ?> de <?= $data['paginas'] ?></div>

    <div style="overflow-x:auto">
      <table class="admin-table">
        <thead>
          <tr>
            <th style="width:32px"><input type="checkbox" id="check-all" title="Seleccionar todos" aria-label="Seleccionar todos"></th>
            <th><a href="?o=id&d=<?= $orden==='id'&&$dir==='DESC'?'ASC':'DESC' ?><?= $busqueda ? '&q='.urlencode($busqueda) : '' ?>" class="admin-sort">ID <?= $orden==='id' ? ($dir==='DESC'?'▼':'▲') : '' ?></a></th>
            <th><a href="?o=nombre_usuario&d=<?= $orden==='nombre_usuario'&&$dir==='DESC'?'ASC':'DESC' ?><?= $busqueda ? '&q='.urlencode($busqueda) : '' ?>" class="admin-sort">Usuario <?= $orden==='nombre_usuario' ? ($dir==='DESC'?'▼':'▲') : '' ?></a></th>
            <th>Correo</th>
            <th><a href="?o=puntos&d=<?= $orden==='puntos'&&$dir==='DESC'?'ASC':'DESC' ?><?= $busqueda ? '&q='.urlencode($busqueda) : '' ?>" class="admin-sort">Puntos <?= $orden==='puntos' ? ($dir==='DESC'?'▼':'▲') : '' ?></a></th>
            <th>Nivel</th>
            <th><a href="?o=tipo&d=<?= $orden==='tipo'&&$dir==='DESC'?'ASC':'DESC' ?><?= $busqueda ? '&q='.urlencode($busqueda) : '' ?>" class="admin-sort">Rol <?= $orden==='tipo' ? ($dir==='DESC'?'▼':'▲') : '' ?></a></th>
            <th>Verif.</th>
            <th>Último login</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($data['usuarios'] as $u): ?>
          <tr>
            <td><input type="checkbox" name="selected_users[]" value="<?= (int)$u['id'] ?>" class="row-check" aria-label="Seleccionar usuario <?= htmlspecialchars($u['nombre_usuario']) ?>"></td>
            <td class="admin-cell-mono"><?= (int)$u['id'] ?></td>
            <td><strong><?= htmlspecialchars($u['nombre_usuario']) ?></strong></td>
            <td class="admin-cell-mono"><?= htmlspecialchars($u['correo']) ?></td>
            <td><?= (int)$u['puntos'] ?></td>
            <td><?= (int)$u['nivel'] ?></td>
            <td><span class="admin-role admin-role-<?= htmlspecialchars($u['tipo']) ?>"><?= htmlspecialchars($u['tipo']) ?></span></td>
            <td><?= $u['email_verified'] ? '✅' : '❌' ?></td>
            <td class="admin-cell-mono"><?= $u['ultimo_login'] ? htmlspecialchars($u['ultimo_login']) : '—' ?></td>
            <td>
              <button class="admin-btn admin-btn-sm" onclick="toggleForm('rol-<?= (int)$u['id'] ?>')">Rol</button>
              <button class="admin-btn admin-btn-sm" onclick="toggleForm('pts-<?= (int)$u['id'] ?>')">XP</button>
              <button class="admin-btn admin-btn-sm" onclick="toggleForm('edit-<?= (int)$u['id'] ?>')">✏️</button>
              <button class="admin-btn admin-btn-sm" onclick="openProgressModal(<?= (int)$u['id'] ?>, <?= htmlspecialchars(json_encode($u['nombre_usuario'])) ?>)" title="Ver progreso de <?= htmlspecialchars($u['nombre_usuario']) ?>">📊</button>
              <?php if (!$u['email_verified']): ?>
              <form method="post" style="display:inline">
                <?= campoTokenCSRF() ?>
                <input type="hidden" name="accion" value="verificar_email">
                <input type="hidden" name="usuario_id" value="<?= (int)$u['id'] ?>">
                <button type="submit" class="admin-btn admin-btn-sm admin-btn-warn" onclick="return confirm('¿Verificar correo de <?= htmlspecialchars(addslashes($u['nombre_usuario'])) ?>?')">✅ Verif</button>
              </form>
              <?php endif; ?>
              <?php if ((int)$u['id'] !== (int)$_SESSION['usuario_id']): ?>
              <form method="post" style="display:inline" onsubmit="return confirm('¿Eliminar a <?= htmlspecialchars(addslashes($u['nombre_usuario'])) ?>? Esta acción no se puede deshacer.')">
                <?= campoTokenCSRF() ?>
                <input type="hidden" name="accion" value="eliminar">
                <input type="hidden" name="usuario_id" value="<?= (int)$u['id'] ?>">
                <button type="submit" class="admin-btn admin-btn-sm admin-btn-danger">🗑️</button>
              </form>
              <?php endif; ?>

              <!-- Rol form (hidden) -->
              <form method="post" id="rol-<?= (int)$u['id'] ?>" class="admin-inline-form" style="display:none" onsubmit="return confirm('¿Cambiar rol de <?= htmlspecialchars(addslashes($u['nombre_usuario'])) ?> a ' + this.rol.value + '?')">
                <?= campoTokenCSRF() ?>
                <input type="hidden" name="accion" value="cambiar_rol">
                <input type="hidden" name="usuario_id" value="<?= (int)$u['id'] ?>">
                <select name="rol">
                  <option value="student" <?= $u['tipo']==='student'?'selected':'' ?>>Student</option>
                  <option value="teacher" <?= $u['tipo']==='teacher'?'selected':'' ?>>Teacher</option>
                  <option value="admin" <?= $u['tipo']==='admin'?'selected':'' ?>>Admin</option>
                </select>
                <button type="submit" class="admin-btn admin-btn-sm">Guardar</button>
              </form>

              <!-- XP form (hidden) -->
              <form method="post" id="pts-<?= (int)$u['id'] ?>" class="admin-inline-form" style="display:none" onsubmit="return confirm('¿Ajustar XP de <?= htmlspecialchars(addslashes($u['nombre_usuario'])) ?> a ' + this.puntos.value + '?')">
                <?= campoTokenCSRF() ?>
                <input type="hidden" name="accion" value="ajustar_puntos">
                <input type="hidden" name="usuario_id" value="<?= (int)$u['id'] ?>">
                <input type="number" name="puntos" value="<?= (int)$u['puntos'] ?>" min="0" class="admin-input" style="width:80px">
                <button type="submit" class="admin-btn admin-btn-sm">Guardar</button>
              </form>

              <!-- Edit form (hidden) — Tasks 3 & 4: password + notas_admin -->
              <form method="post" id="edit-<?= (int)$u['id'] ?>" class="admin-inline-form" style="display:none">
                <?= campoTokenCSRF() ?>
                <input type="hidden" name="accion" value="editar_usuario">
                <input type="hidden" name="usuario_id" value="<?= (int)$u['id'] ?>">
                <input type="text" name="username" value="<?= htmlspecialchars($u['nombre_usuario']) ?>" required class="admin-input" style="width:120px" placeholder="Usuario">
                <input type="email" name="email" value="<?= htmlspecialchars($u['correo']) ?>" required class="admin-input" style="width:160px" placeholder="Correo">
                <input type="password" name="new_password" placeholder="Nueva contraseña (vacío=no cambiar)" class="admin-input" style="width:140px" minlength="6">
                <textarea name="notas_admin" placeholder="Notas internas…" class="admin-input" style="width:200px;height:60px;resize:vertical;vertical-align:top"><?= htmlspecialchars($u['notas_admin'] ?? '') ?></textarea>
                <button type="submit" class="admin-btn admin-btn-sm">Guardar</button>
              </form>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
    </form><!-- /batch-form -->

    <?php if ($data['paginas'] > 1): ?>
    <div class="admin-pages">
      <?php for ($i = 1; $i <= $data['paginas']; $i++): ?>
        <a href="?p=<?= $i ?><?= $busqueda ? '&q='.urlencode($busqueda) : '' ?>" class="admin-page <?= $i === $data['pagina'] ? 'active' : '' ?>"><?= $i ?></a>
      <?php endfor; ?>
    </div>
    <?php endif; ?>
  </main>
</div>

<!-- ─── Progress Modal (Task 2) ─────────────────────────────────────────── -->
<div id="progress-modal" style="display:none;position:fixed;inset:0;z-index:9999;background:rgba(0,0,0,.6);overflow-y:auto;" role="dialog" aria-modal="true" aria-labelledby="progress-modal-title">
  <div style="max-width:720px;margin:40px auto;background:var(--surface);border:1px solid var(--border);border-radius:12px;padding:24px;position:relative;">
    <button onclick="closeProgressModal()" style="position:absolute;top:12px;right:16px;background:none;border:none;color:var(--muted);font-size:1.4rem;cursor:pointer;line-height:1;" aria-label="Cerrar">✕</button>
    <h2 id="progress-modal-title" style="margin:0 0 16px;font-size:1.1rem;color:var(--cyan)">📊 Progreso de <span id="modal-username"></span></h2>

    <div id="progress-modal-body" style="min-height:80px">
      <p style="color:var(--muted);text-align:center;padding:24px 0">Cargando…</p>
    </div>
  </div>
</div>

<script>
// ── Toggle inline forms ──────────────────────────────────────────────────
function toggleForm(id) {
  var el = document.getElementById(id);
  if (el) el.style.display = el.style.display === 'none' ? 'block' : 'none';
}

// ── Batch selection ──────────────────────────────────────────────────────
(function() {
  var toolbar  = document.getElementById('batch-toolbar');
  var countEl  = document.getElementById('batch-count');
  var checkAll = document.getElementById('check-all');
  var rowChecks = document.querySelectorAll('.row-check');

  function updateToolbar() {
    var n = document.querySelectorAll('.row-check:checked').length;
    if (n > 0) {
      toolbar.style.display = 'flex';
      countEl.textContent = n + ' seleccionado' + (n > 1 ? 's' : '');
    } else {
      toolbar.style.display = 'none';
    }
  }

  if (checkAll) {
    checkAll.addEventListener('change', function() {
      rowChecks.forEach(function(cb) { cb.checked = checkAll.checked; });
      updateToolbar();
    });
  }
  rowChecks.forEach(function(cb) {
    cb.addEventListener('change', function() {
      var total = rowChecks.length;
      var selected = document.querySelectorAll('.row-check:checked').length;
      checkAll.checked = selected > 0 && selected === total;
      checkAll.indeterminate = selected > 0 && selected < total;
      updateToolbar();
    });
  });
})();

function deselectAll() {
  document.querySelectorAll('.row-check').forEach(function(cb) { cb.checked = false; });
  var ca = document.getElementById('check-all');
  if (ca) ca.checked = false;
  document.getElementById('batch-toolbar').style.display = 'none';
}

function confirmBatch(msg) {
  var n = document.querySelectorAll('.row-check:checked').length;
  if (n === 0) { alert('Selecciona al menos un usuario.'); return false; }
  return confirm(msg + '\n(' + n + ' usuario' + (n > 1 ? 's' : '') + ')');
}

// ── Progress Modal ───────────────────────────────────────────────────────
var _progressModal = document.getElementById('progress-modal');

function openProgressModal(uid, username) {
  document.getElementById('modal-username').textContent = username;
  document.getElementById('progress-modal-body').innerHTML = '<p style="color:var(--muted);text-align:center;padding:24px 0">Cargando…</p>';
  _progressModal.style.display = 'block';
  document.body.style.overflow = 'hidden';

  var csrfToken = document.querySelector('meta[name="csrf-token"]')?.content || '';
  fetch('api_user_progress.php?uid=' + uid, { credentials: 'same-origin' })
    .then(function(r) { return r.json(); })
    .then(function(data) {
      if (data.error) {
        document.getElementById('progress-modal-body').innerHTML = '<p style="color:var(--red)">' + escHtml(data.error) + '</p>';
        return;
      }
      renderProgressModal(data);
    })
    .catch(function(e) {
      document.getElementById('progress-modal-body').innerHTML = '<p style="color:var(--red)">Error al cargar datos.</p>';
    });
}

function closeProgressModal() {
  _progressModal.style.display = 'none';
  document.body.style.overflow = '';
}

_progressModal.addEventListener('click', function(e) {
  if (e.target === _progressModal) closeProgressModal();
});
document.addEventListener('keydown', function(e) {
  if (e.key === 'Escape') closeProgressModal();
});

function escHtml(str) {
  return String(str).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');
}

function renderProgressModal(data) {
  var s = data.stats;
  var html = '';

  // Quick stats
  html += '<div style="display:flex;gap:12px;flex-wrap:wrap;margin-bottom:16px;">';
  html += stat_card('📚', s.lecciones_completadas + ' / ' + s.lecciones_visitadas, 'Lecciones completadas');
  html += stat_card('🏆', s.badges_total, 'Badges');
  html += stat_card('📈', s.avg_score !== null ? s.avg_score + '%' : '—', 'Score promedio');
  html += stat_card('🔥', data.usuario.racha_actual, 'Racha actual');
  html += '</div>';

  // Badges section
  html += '<h3 style="font-size:0.85rem;color:var(--muted);margin:0 0 8px;text-transform:uppercase;letter-spacing:.05em">Badges obtenidos</h3>';
  if (data.badges.length > 0) {
    html += '<div style="display:flex;flex-wrap:wrap;gap:8px;margin-bottom:16px;">';
    data.badges.forEach(function(b) {
      html += '<span style="background:var(--surface2);border:1px solid var(--border);border-radius:6px;padding:4px 10px;font-size:0.75rem;" title="' + escHtml(b.fecha_obtencion || '') + '">' + escHtml(b.nombre) + '</span>';
    });
    html += '</div>';
  } else {
    html += '<p style="color:var(--muted);font-size:0.82rem;margin-bottom:16px">Sin badges aún.</p>';
  }

  // Progress table
  html += '<h3 style="font-size:0.85rem;color:var(--muted);margin:0 0 8px;text-transform:uppercase;letter-spacing:.05em">Progreso por lección</h3>';
  if (data.progreso.length > 0) {
    html += '<div style="overflow-x:auto;max-height:300px;overflow-y:auto;">';
    html += '<table class="admin-table" style="font-size:0.76rem">';
    html += '<thead><tr><th>Lección (slug)</th><th>Completada</th><th>Score</th><th>Última actividad</th></tr></thead><tbody>';
    data.progreso.forEach(function(p) {
      var completed = p.completed ? '<span style="color:var(--green)">✅</span>' : '<span style="color:var(--muted)">—</span>';
      var score = p.score !== null ? p.score + '%' : '—';
      var date = p.updated_at ? p.updated_at.substring(0, 16) : '—';
      html += '<tr><td class="admin-cell-mono">' + escHtml(p.leccion_slug) + '</td><td>' + completed + '</td><td>' + escHtml(score) + '</td><td class="admin-cell-mono">' + escHtml(date) + '</td></tr>';
    });
    html += '</tbody></table></div>';
  } else {
    html += '<p style="color:var(--muted);font-size:0.82rem">Sin progreso registrado.</p>';
  }

  document.getElementById('progress-modal-body').innerHTML = html;
}

function stat_card(icon, val, label) {
  return '<div style="flex:1;min-width:120px;background:var(--surface2);border:1px solid var(--border);border-radius:8px;padding:10px 14px;text-align:center;">' +
    '<div style="font-size:1.4rem">' + icon + '</div>' +
    '<div style="font-size:1.1rem;font-weight:700;color:var(--cyan)">' + escHtml(String(val)) + '</div>' +
    '<div style="font-size:0.72rem;color:var(--muted)">' + escHtml(label) + '</div>' +
    '</div>';
}
</script>

<?php require __DIR__ . '/../../src/Templates/page_end.php'; ?>
