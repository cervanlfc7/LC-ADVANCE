<?php
require_once __DIR__ . '/../../src/Config/config.php';
require_once __DIR__ . '/../../src/Config/csrf.php';
require_once __DIR__ . '/../../src/Core/admin.php';
requireAdmin();

$mensaje = '';
$error = '';

// Handle actions
if ($_SERVER['REQUEST_METHOD'] === 'POST' && validarCsrfToken($_POST['csrf_token'] ?? '')) {
    $accion = $_POST['accion'] ?? '';

    if ($accion === 'crear_badge') {
        $nombre = trim($_POST['nombre'] ?? '');
        $desc = trim($_POST['descripcion'] ?? '');
        $icono = trim($_POST['icono'] ?? '🏅');
        if (strlen($nombre) < 2) {
            $error = 'El nombre debe tener al menos 2 caracteres.';
        } else {
            $pdo->prepare("INSERT INTO badges (nombre_badge, descripcion, icono) VALUES (?, ?, ?)")->execute([$nombre, $desc, $icono]);
            logSeguridadEvento('ADMIN_BADGE_CREATE', "Badge creado: {$nombre}", $_SESSION['usuario_id']);
            $mensaje = "Badge <strong>" . htmlspecialchars($nombre) . "</strong> creado.";
        }
    } elseif ($accion === 'editar_badge') {
        $bid = (int)($_POST['badge_id'] ?? 0);
        $nombre = trim($_POST['nombre'] ?? '');
        $desc = trim($_POST['descripcion'] ?? '');
        $icono = trim($_POST['icono'] ?? '🏅');
        if ($bid > 0 && strlen($nombre) >= 2) {
            $pdo->prepare("UPDATE badges SET nombre_badge = ?, descripcion = ?, icono = ? WHERE id = ?")->execute([$nombre, $desc, $icono, $bid]);
            logSeguridadEvento('ADMIN_BADGE_EDIT', "Badge ID {$bid}: {$nombre}", $_SESSION['usuario_id']);
            $mensaje = "Badge actualizado.";
        } else {
            $error = 'Nombre inválido.';
        }
    } elseif ($accion === 'eliminar_badge') {
        $bid = (int)($_POST['badge_id'] ?? 0);
        if ($bid > 0) {
            $stmt = $pdo->prepare("SELECT nombre_badge FROM badges WHERE id = ?");
            $stmt->execute([$bid]);
            $nombre = $stmt->fetchColumn();
            $pdo->prepare("DELETE FROM badges WHERE id = ?")->execute([$bid]);
            logSeguridadEvento('ADMIN_BADGE_DELETE', "Badge ID {$bid}: {$nombre}", $_SESSION['usuario_id']);
            $mensaje = "Badge <strong>" . htmlspecialchars($nombre) . "</strong> eliminado (asignaciones eliminadas en cascada).";
        }
    } elseif ($accion === 'otorgar') {
        $uid = (int)($_POST['usuario_id'] ?? 0);
        $bid = (int)($_POST['badge_id'] ?? 0);
        if ($uid > 0 && $bid > 0) {
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM usuarios_badges WHERE usuario_id = ? AND badge_id = ?");
            $stmt->execute([$uid, $bid]);
            if ($stmt->fetchColumn() == 0) {
                otorgarBadge($uid, $bid, $pdo);
                $stmt = $pdo->prepare("SELECT nombre_badge FROM badges WHERE id = ?");
                $stmt->execute([$bid]);
                $nombre = $stmt->fetchColumn();
                logSeguridadEvento('ADMIN_BADGE_GRANT', "Usuario ID: {$uid} | Badge: {$nombre} (ID: {$bid})", $_SESSION['usuario_id']);
                if (function_exists('crearNotificacion')) {
                    crearNotificacion($uid, "🏆 Logro desbloqueado: $nombre", "¡Un administrador te ha otorgado la insignia '$nombre'!", $pdo);
                }
                $mensaje = 'Badge otorgado.';
            } else {
                $error = 'El usuario ya tiene este badge.';
            }
        }
    } elseif ($accion === 'revocar') {
        $uid = (int)($_POST['usuario_id'] ?? 0);
        $bid = (int)($_POST['badge_id'] ?? 0);
        if ($uid > 0 && $bid > 0) {
            $pdo->prepare("DELETE FROM usuarios_badges WHERE usuario_id = ? AND badge_id = ?")->execute([$uid, $bid]);
            $stmt = $pdo->prepare("SELECT nombre_badge FROM badges WHERE id = ?");
            $stmt->execute([$bid]);
            $nombre = $stmt->fetchColumn();
            logSeguridadEvento('ADMIN_BADGE_REVOKE', "Usuario ID: {$uid} | Badge: {$nombre} (ID: {$bid})", $_SESSION['usuario_id']);
            $mensaje = 'Badge revocado.';
        }
    } elseif ($accion === 'reordenar_badges') {
        $ids_json = $_POST['orden_ids'] ?? '';
        $ids = json_decode($ids_json, true);
        if (is_array($ids)) {
            try {
                $pdo->beginTransaction();
                foreach ($ids as $index => $id) {
                    $stmt = $pdo->prepare("UPDATE badges SET orden = ? WHERE id = ?");
                    $stmt->execute([$index, (int)$id]);
                }
                $pdo->commit();
                echo json_encode(['ok' => true]);
                exit;
            } catch (Exception $e) {
                $pdo->rollBack();
                echo json_encode(['ok' => false, 'error' => $e->getMessage()]);
                exit;
            }
        } else {
            echo json_encode(['ok' => false, 'error' => 'IDs inválidos']);
            exit;
        }
    }
}

// Load all badge definitions for CRUD
$todos_badges = $pdo->query("SELECT id, nombre_badge, descripcion, icono FROM badges ORDER BY orden ASC, id ASC")->fetchAll(PDO::FETCH_ASSOC);

// Badge being edited
$edit_badge = null;
$edit_bid = (int)($_GET['edit_badge'] ?? 0);
if ($edit_bid > 0) {
    foreach ($todos_badges as $b) {
        if ((int)$b['id'] === $edit_bid) { $edit_badge = $b; break; }
    }
}

// Search user by username/id
$usuario_badge = null;
$busq = trim($_POST['q'] ?? $_GET['q'] ?? '');
if ($busq) {
    $like = '%' . $busq . '%';
    $stmt = $pdo->prepare("SELECT id, nombre_usuario, correo, tipo FROM usuarios WHERE id = ? OR nombre_usuario LIKE ? OR correo LIKE ? LIMIT 20");
    $stmt->execute([is_numeric($busq) ? (int)$busq : 0, $like, $like]);
    $resultados_usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    $resultados_usuarios = [];
}

// If single user selected, show their badges
$usuario_seleccionado = (int)($_GET['uid'] ?? $_POST['uid'] ?? 0);
$badges_usuario = [];
$badges_disponibles = [];
if ($usuario_seleccionado) {
    $stmt = $pdo->prepare("SELECT id, nombre_usuario FROM usuarios WHERE id = ?");
    $stmt->execute([$usuario_seleccionado]);
    $usuario_badge = $stmt->fetch(PDO::FETCH_ASSOC);

    $stmt = $pdo->query("SELECT id, nombre_badge, descripcion, icono FROM badges ORDER BY id");
    $todos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $stmt = $pdo->prepare("SELECT badge_id FROM usuarios_badges WHERE usuario_id = ?");
    $stmt->execute([$usuario_seleccionado]);
    $obtenidos = $stmt->fetchAll(PDO::FETCH_COLUMN);

    foreach ($todos as $b) {
        $ob = in_array((int)$b['id'], $obtenidos);
        $icono_raw = $b['icono'];
        if ($icono_raw && preg_match('/\.(png|jpg|jpeg|gif|svg)$/i', $icono_raw)) {
            $icono_display = '🏅';
        } else {
            $icono_display = $icono_raw ?: '🏅';
        }
        $entry = [
            'id' => (int)$b['id'],
            'nombre' => $b['nombre_badge'],
            'descripcion' => $b['descripcion'],
            'icono' => $icono_display,
            'obtenido' => $ob,
        ];
        if ($ob) {
            $badges_usuario[] = $entry;
        } else {
            $badges_disponibles[] = $entry;
        }
    }
}

$page_title = 'Logros | Admin | LC-ADVANCE';
$page_js_files = ['assets/js/loader.js'];
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
    <a href="usuarios.php">Usuarios</a>
    <a href="logros.php" class="active">Logros</a>
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
    <h1>Gestión de Logros</h1>

    <?php if ($mensaje): ?><div class="admin-msg admin-msg-ok"><?= $mensaje ?></div><?php endif; ?>
    <?php if ($error): ?><div class="admin-msg admin-msg-err"><?= htmlspecialchars($error) ?></div><?php endif; ?>

    <!-- ═══════ Badge CRUD ═══════ -->
    <section class="admin-section" style="margin-bottom:24px">
      <h2>Gestionar Badges</h2>

      <?php if ($edit_badge): ?>
      <!-- Edit form -->
      <form method="post" class="admin-search" style="margin-bottom:12px">
        <?= campoTokenCSRF() ?>
        <input type="hidden" name="accion" value="editar_badge">
        <input type="hidden" name="badge_id" value="<?= (int)$edit_badge['id'] ?>">
        <input type="text" name="nombre" value="<?= htmlspecialchars($edit_badge['nombre_badge']) ?>" required class="admin-input" style="flex:1;min-width:140px" placeholder="Nombre">
        <input type="text" name="descripcion" value="<?= htmlspecialchars($edit_badge['descripcion']) ?>" class="admin-input" style="flex:2;min-width:200px" placeholder="Descripción">
        <input type="text" name="icono" value="<?= htmlspecialchars($edit_badge['icono']) ?>" class="admin-input" style="width:80px" placeholder="Ícono (🏅)">
        <button type="submit" class="admin-btn admin-btn-sm">Guardar</button>
        <a href="logros.php" class="admin-btn admin-btn-sm admin-btn-ghost">✕ Cancelar</a>
      </form>
      <?php endif; ?>

      <details <?= $edit_badge ? '' : 'open' ?> style="margin-bottom:12px">
        <summary style="cursor:pointer;font-weight:600;font-size:0.82rem;color:var(--cyan);padding:4px 0;">➕ Nuevo badge</summary>
        <form method="post" class="admin-search" style="margin-top:8px">
          <?= campoTokenCSRF() ?>
          <input type="hidden" name="accion" value="crear_badge">
          <input type="text" name="nombre" placeholder="Nombre" required class="admin-input" style="flex:1;min-width:140px">
          <input type="text" name="descripcion" placeholder="Descripción" class="admin-input" style="flex:2;min-width:200px">
          <input type="text" name="icono" placeholder="🏅" class="admin-input" style="width:80px">
          <button type="submit" class="admin-btn admin-btn-sm">Crear</button>
        </form>
      </details>

      <div style="overflow-x:auto">
        <table class="admin-table">
          <thead><tr><th>ID</th><th>Nombre</th><th>Descripción</th><th>Icono</th><th>Acciones</th></tr></thead>
          <tbody>
            <?php foreach ($todos_badges as $b): ?>
            <tr draggable="true" data-id="<?= (int)$b['id'] ?>" class="draggable-badge-row" style="cursor: grab;">
              <td class="admin-cell-mono"><?= (int)$b['id'] ?></td>
              <td><strong><?= htmlspecialchars($b['nombre_badge']) ?></strong></td>
              <td style="color:var(--muted);font-size:0.75rem"><?= htmlspecialchars($b['descripcion']) ?></td>
              <td style="font-size:1.2rem; text-align:center; vertical-align:middle;"><?php
                $ico = $b['icono'] ?: '🏅';
                if (preg_match('/\.(png|jpg|jpeg|gif|svg)$/i', $ico)) {
                    echo '<img src="' . htmlspecialchars(appRootPath()) . '/public/assets/img/badges/' . htmlspecialchars($ico) . '" style="width:30px;height:30px;object-fit:contain;vertical-align:middle;" alt="">';
                } else {
                    echo htmlspecialchars($ico);
                }
              ?></td>
              <td>
                <a href="logros.php?edit_badge=<?= (int)$b['id'] ?>" class="admin-btn admin-btn-sm">✏️</a>
                <form method="post" style="display:inline" onsubmit="return confirm('¿Eliminar badge «<?= htmlspecialchars(addslashes($b['nombre_badge'])) ?>»? Se eliminarán todas las asignaciones.')">
                  <?= campoTokenCSRF() ?>
                  <input type="hidden" name="accion" value="eliminar_badge">
                  <input type="hidden" name="badge_id" value="<?= (int)$b['id'] ?>">
                  <button type="submit" class="admin-btn admin-btn-sm admin-btn-danger">🗑️</button>
                </form>
              </td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </section>

    <section class="admin-section" style="margin-bottom:24px">
      <h2>Buscar Usuario</h2>
      <form method="post" class="admin-search">
        <?= campoTokenCSRF() ?>
        <input type="text" name="q" placeholder="ID, nombre de usuario o correo…" value="<?= htmlspecialchars($busq) ?>" class="admin-input" style="flex:1;max-width:400px">
        <button type="submit" class="admin-btn">🔍 Buscar</button>
      </form>

      <?php if ($resultados_usuarios && !$usuario_seleccionado): ?>
      <div style="margin-top:12px">
        <?php foreach ($resultados_usuarios as $u): ?>
        <a href="logros.php?uid=<?= (int)$u['id'] ?>" class="admin-user-chip"><?= htmlspecialchars($u['nombre_usuario']) ?> <span class="admin-cell-mono">(<?= htmlspecialchars($u['correo']) ?>)</span> <span class="admin-role admin-role-<?= htmlspecialchars($u['tipo']) ?>"><?= htmlspecialchars($u['tipo']) ?></span></a>
        <?php endforeach; ?>
      </div>
      <?php elseif (!$resultados_usuarios && $busq): ?>
      <p style="color:var(--muted);font-size:0.82rem">Sin resultados.</p>
      <?php endif; ?>
    </section>

    <?php if ($usuario_badge): ?>
    <div class="admin-section">
      <h2>Logros de: <?= htmlspecialchars($usuario_badge['nombre_usuario']) ?></h2>
      <p style="font-size:0.82rem;color:var(--muted)"><?= count($badges_usuario) ?> / <?= count($badges_usuario) + count($badges_disponibles) ?> obtenidos</p>

      <div style="margin-bottom:12px;font-size:0.85rem;font-weight:600;color:var(--text)">Obtenidos</div>
      <div class="admin-badge-grid">
        <?php foreach ($badges_usuario as $b): ?>
        <div class="admin-badge-card obtenido">
          <div class="admin-badge-icon"><?= htmlspecialchars($b['icono'] ?: '🏅') ?></div>
          <div class="admin-badge-name"><?= htmlspecialchars($b['nombre']) ?></div>
          <form method="post" onsubmit="return confirm('¿Revocar badge?')">
            <?= campoTokenCSRF() ?>
            <input type="hidden" name="accion" value="revocar">
            <input type="hidden" name="uid" value="<?= $usuario_seleccionado ?>">
            <input type="hidden" name="usuario_id" value="<?= $usuario_seleccionado ?>">
            <input type="hidden" name="badge_id" value="<?= (int)$b['id'] ?>">
            <button type="submit" class="admin-btn admin-btn-sm admin-btn-danger">Revocar</button>
          </form>
        </div>
        <?php endforeach; ?>
        <?php if (!$badges_usuario): ?><p style="color:var(--muted);font-size:0.82rem">Sin logros aún.</p><?php endif; ?>
      </div>

      <div style="margin-top:20px;margin-bottom:12px;font-size:0.85rem;font-weight:600;color:var(--muted)">Disponibles</div>
      <div class="admin-badge-grid">
        <?php foreach ($badges_disponibles as $b): ?>
        <div class="admin-badge-card disponible">
          <div class="admin-badge-icon muted"><?= htmlspecialchars($b['icono'] ?: '🏅') ?></div>
          <div class="admin-badge-name"><?= htmlspecialchars($b['nombre']) ?></div>
          <form method="post">
            <?= campoTokenCSRF() ?>
            <input type="hidden" name="accion" value="otorgar">
            <input type="hidden" name="uid" value="<?= $usuario_seleccionado ?>">
            <input type="hidden" name="usuario_id" value="<?= $usuario_seleccionado ?>">
            <input type="hidden" name="badge_id" value="<?= (int)$b['id'] ?>">
            <button type="submit" class="admin-btn admin-btn-sm">Otorgar</button>
          </form>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
    <?php endif; ?>
  </main>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const tbody = document.querySelector('.admin-table tbody');
    let dragEl = null;

    if (tbody) {
        tbody.addEventListener('dragstart', function(e) {
            const tr = e.target.closest('tr');
            if (tr && tr.classList.contains('draggable-badge-row')) {
                dragEl = tr;
                tr.style.opacity = '0.5';
                tr.style.cursor = 'grabbing';
                e.dataTransfer.effectAllowed = 'move';
            }
        });

        tbody.addEventListener('dragend', function(e) {
            if (dragEl) {
                dragEl.style.opacity = '1';
                dragEl.style.cursor = 'grab';
            }
            saveNewBadgeOrder();
        });

        tbody.addEventListener('dragover', function(e) {
            e.preventDefault();
            const tr = e.target.closest('tr');
            if (tr && tr !== dragEl && tr.classList.contains('draggable-badge-row')) {
                const rect = tr.getBoundingClientRect();
                const next = (e.clientY - rect.top) / (rect.bottom - rect.top) > 0.5;
                tbody.insertBefore(dragEl, next ? tr.nextSibling : tr);
            }
        });
    }

    function saveNewBadgeOrder() {
        const rows = document.querySelectorAll('.draggable-badge-row');
        const ids = Array.from(rows).map(row => row.dataset.id);
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content || '';

        if (typeof lcLoader !== 'undefined') {
            lcLoader.show();
        }

        fetch('logros.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: new URLSearchParams({
                accion: 'reordenar_badges',
                csrf_token: csrfToken,
                orden_ids: JSON.stringify(ids)
            })
        })
        .then(res => res.json())
        .then(data => {
            if (typeof lcLoader !== 'undefined') {
                lcLoader.hide();
            }
            if (data.ok) {
                console.log('Orden de insignias guardado correctamente');
            } else {
                alert('Error al guardar el nuevo orden de logros: ' + (data.error || ''));
            }
        })
        .catch(err => {
            if (typeof lcLoader !== 'undefined') {
                lcLoader.hide();
            }
            console.error(err);
        });
    }
});
</script>

<?php require __DIR__ . '/../../src/Templates/page_end.php'; ?>
