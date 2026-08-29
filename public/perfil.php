<?php
require_once __DIR__ . '/../src/Config/config.php';
require_once __DIR__ . '/../src/Config/csrf.php';
requireLogin();

$t = [
    'title' => 'Mi Perfil',
    'stats' => 'Estadísticas',
    'account' => 'Cuenta',
    'password_section' => 'Cambiar Contraseña',
    'current_password' => 'Contraseña actual',
    'new_password' => 'Nueva contraseña',
    'confirm_password' => 'Confirmar contraseña',
    'change_password_btn' => 'Actualizar Contraseña',
    'email_section' => 'Cambiar Correo Electrónico',
    'new_email' => 'Nuevo correo',
    'change_email_btn' => 'Actualizar Correo',
    'back_dashboard' => 'Volver al Dashboard',
    'member_since' => 'Miembro desde',
    'level' => 'Nivel',
    'xp' => 'XP',
    'completed_lessons' => 'Lecciones completadas',
    'type' => 'Tipo de cuenta',
    'student' => 'Estudiante',
    'teacher' => 'Profesor',
];

$is_guest = !empty($_SESSION['usuario_es_invitado']);
$usuario_id = (int)$_SESSION['usuario_id'];
$mensaje = '';
$error = '';
$exito = false;

// ─── AUTO-MIGRATE avatar column ──────────────────────────────────────
try {
    $pdo->query("SELECT avatar FROM usuarios LIMIT 1");
} catch (Exception $e) {
    try { $pdo->exec("ALTER TABLE usuarios ADD COLUMN avatar VARCHAR(64) DEFAULT 'avatar_1' AFTER nombre_usuario"); } catch (Exception $ex) {}
}

// Available avatars (emoji-based or image names)
$avatares = ['🧑‍💻','👾','🦊','🐉','🌟','⚡','🔥','🧠','🎯','🚀','🦁','🐺','🦋','🌙','🎮'];

// ─── CAMBIAR NOMBRE DE USUARIO ───────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'cambiar_username') {
    protegerCSRF();
    $nuevo_username = trim($_POST['nuevo_username'] ?? '');
    if (strlen($nuevo_username) < 3 || strlen($nuevo_username) > 30) {
        $error = 'El nombre de usuario debe tener entre 3 y 30 caracteres.';
    } elseif (!preg_match('/^[a-zA-Z0-9_\-áéíóúÁÉÍÓÚñÑ ]+$/u', $nuevo_username)) {
        $error = 'El nombre de usuario contiene caracteres no permitidos.';
    } else {
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM usuarios WHERE nombre_usuario = ? AND id != ?");
        $stmt->execute([$nuevo_username, $usuario_id]);
        if ($stmt->fetchColumn() > 0) {
            $error = 'Ese nombre de usuario ya está en uso.';
        } else {
            $stmt = $pdo->prepare("UPDATE usuarios SET nombre_usuario = ? WHERE id = ?");
            $stmt->execute([$nuevo_username, $usuario_id]);
            $_SESSION['usuario_nombre'] = $nuevo_username;
            $mensaje = '✅ Nombre de usuario actualizado.';
        }
    }
}

// ─── CAMBIAR AVATAR ──────────────────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'cambiar_avatar') {
    protegerCSRF();
    $nuevo_avatar = $_POST['avatar'] ?? '';
    if (in_array($nuevo_avatar, $avatares, true)) {
        try {
            $stmt = $pdo->prepare("UPDATE usuarios SET avatar = ? WHERE id = ?");
            $stmt->execute([$nuevo_avatar, $usuario_id]);
            $mensaje = '✅ Avatar actualizado.';
        } catch (Exception $e) {
            $error = 'No se pudo actualizar el avatar.';
        }
    } else {
        $error = 'Avatar no válido.';
    }
}

// ─── RECUPERAR CONTRASEÑA (LOGUEADO) ────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'solicitar_reset') {
    protegerCSRF();
    // Get user's email
    $stmt = $pdo->prepare("SELECT correo, nombre_usuario FROM usuarios WHERE id = ?");
    $stmt->execute([$usuario_id]);
    $udata = $stmt->fetch();
    if ($udata && !empty($udata['correo'])) {
        // Create reset table if needed
        try {
            $pdo->exec("CREATE TABLE IF NOT EXISTS `password_resets` (
                `id` int NOT NULL AUTO_INCREMENT, `usuario_id` int NOT NULL, `token` varchar(128) NOT NULL,
                `expiracion` datetime NOT NULL, `usado` tinyint(1) NOT NULL DEFAULT 0,
                `creado_en` timestamp NOT NULL DEFAULT current_timestamp(),
                PRIMARY KEY (`id`), KEY `token` (`token`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");
        } catch (Exception $e) {}

        $token = bin2hex(random_bytes(64));
        $expiracion = date('Y-m-d H:i:s', strtotime('+1 hour'));
        $pdo->prepare("INSERT INTO password_resets (usuario_id, token, expiracion) VALUES (?, ?, ?)")
            ->execute([$usuario_id, $token, $expiracion]);

        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
        $base = $protocol . '://' . $_SERVER['HTTP_HOST'] . appRootPath();
        $url = $base . '/public/restablecer.php?token=' . urlencode($token);

        $asunto = 'Restablece tu contraseña — LC-ADVANCE';
        $nombre = htmlspecialchars($udata['nombre_usuario']);
        $cuerpo = emailTemplate('Recuperación de contraseña', "
            <p>Hola <strong>{$nombre}</strong>,</p>
            <p>Solicitaste restablecer tu contraseña. Haz clic en el botón:</p>
            <p style=\"text-align:center\"><a href=\"{$url}\" class=\"btn\">Restablecer Contraseña</a></p>
            <p style=\"color:#888fa0;font-size:0.82rem\">Este enlace expira en <strong>1 hora</strong>. Si no lo solicitaste, ignora este mensaje.</p>
        ");
        $sent = enviarEmail($udata['correo'], $asunto, $cuerpo);
        if ($sent) {
            $mensaje = '📧 Se envió un correo con instrucciones para restablecer tu contraseña.';
        } else {
            $error = 'No se pudo enviar el correo. Contacta al administrador.';
        }
    } else {
        $error = 'No se encontró tu correo electrónico.';
    }
}

// ─── CAMBIAR CONTRASEÑA ─────────────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'cambiar_password') {
    protegerCSRF();
    $actual = $_POST['password_actual'] ?? '';
    $nueva = $_POST['password_nueva'] ?? '';
    $confirmar = $_POST['password_confirmar'] ?? '';

    if (empty($actual) || empty($nueva) || empty($confirmar)) {
        $error = 'Todos los campos son obligatorios.';
    } elseif ($nueva !== $confirmar) {
        $error = 'Las contraseñas no coinciden.';
    } elseif (strlen($nueva) < 6) {
        $error = 'La nueva contraseña debe tener al menos 6 caracteres.';
    } else {
        $stmt = $pdo->prepare("SELECT contrasena_hash FROM usuarios WHERE id = ?");
        $stmt->execute([$usuario_id]);
        $hash = $stmt->fetchColumn();

        if (!password_verify($actual, $hash)) {
            $error = 'La contraseña actual no es correcta.';
        } else {
            $nuevo_hash = password_hash($nueva, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("UPDATE usuarios SET contrasena_hash = ? WHERE id = ?");
            $stmt->execute([$nuevo_hash, $usuario_id]);
            $mensaje = 'Contraseña actualizada correctamente.';
        }
    }
}

// ─── CAMBIAR EMAIL ───────────────────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'cambiar_email') {
    protegerCSRF();
    $nuevo_email = trim($_POST['nuevo_email'] ?? '');

    if (empty($nuevo_email) || !filter_var($nuevo_email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Correo electrónico no válido.';
    } else {
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM usuarios WHERE correo = ? AND id != ?");
        $stmt->execute([$nuevo_email, $usuario_id]);
        if ($stmt->fetchColumn() > 0) {
            $error = 'Ese correo ya está registrado por otro usuario.';
        } else {
            $stmt = $pdo->prepare("UPDATE usuarios SET correo = ? WHERE id = ?");
            $stmt->execute([$nuevo_email, $usuario_id]);
            $mensaje = 'Correo actualizado correctamente.';
        }
    }
}

// ─── DATOS DEL USUARIO ──────────────────────────────────────────────
$user = null;
if (!$is_guest) {
    $stmt = $pdo->prepare("SELECT nombre_usuario, correo, puntos, nivel, tipo, creado_en,
        COALESCE(avatar, '🧑‍💻') as avatar,
        (SELECT COUNT(*) FROM user_progress WHERE user_id = ? AND completed = 1) as lecciones_completadas,
        (SELECT COUNT(*) FROM user_progress WHERE user_id = ?) as lecciones_totales
        FROM usuarios WHERE id = ?");
    $stmt->execute([$usuario_id, $usuario_id, $usuario_id]);
    $user = $stmt->fetch();
    if (!$user) { redirigir('public/login.php'); }
}

$page_title = 'Mi Perfil | LC-ADVANCE';
$page_css_files = ['assets/css/dashboard.css'];
$page_show_bg_orb = false;
require __DIR__ . '/../src/Templates/page_start.php';
?>

<div class="perfil-container">
    <header class="perfil-header">
        <h1>👤 Mi Perfil</h1>
        <a href="dashboard.php" class="pf-btn pf-btn-secondary">← Volver al Dashboard</a>
    </header>

    <?php if ($mensaje): ?><div class="pf-alert pf-success"><?= htmlspecialchars($mensaje) ?></div><?php endif; ?>
    <?php if ($error): ?><div class="pf-alert pf-error"><?= htmlspecialchars($error) ?></div><?php endif; ?>

    <?php if ($is_guest): ?>

    <div class="pf-guest-card">
        <div class="pf-guest-glow"></div>
        <div class="pf-guest-icon">🔒</div>
        <h2>Acceso restringido</h2>
        <p>Estás navegando como invitado. Los perfiles solo están disponibles para usuarios registrados.</p>
        <form method="post" action="logout.php">
            <?= campoTokenCSRF() ?>
            <button type="submit" class="pf-guest-btn">🚪 Cerrar sesión e ir a Login</button>
        </form>
        <div class="pf-guest-lines">
            <span></span><span></span><span></span>
        </div>
    </div>

    <?php else: ?>

    <!-- Stats -->
    <section class="pf-card">
        <h2>📊 Estadísticas</h2>
        <div class="pf-avatar-display">
            <span class="pf-avatar-big"><?= htmlspecialchars($user['avatar']) ?></span>
            <div>
                <div style="font-family:'Syne',sans-serif;font-size:1.2rem;color:var(--text)"><?= htmlspecialchars($user['nombre_usuario']) ?></div>
                <div style="font-size:0.72rem;color:var(--muted);text-transform:uppercase;letter-spacing:.8px"><?= htmlspecialchars($user['tipo']) ?></div>
            </div>
        </div>
        <div class="pf-stats-grid">
            <div class="pf-stat">
                <span class="pf-stat-value"><?= (int)$user['nivel'] ?></span>
                <span class="pf-stat-label">Nivel</span>
            </div>
            <div class="pf-stat">
                <span class="pf-stat-value"><?= number_format((int)$user['puntos']) ?></span>
                <span class="pf-stat-label">XP Total</span>
            </div>
            <div class="pf-stat">
                <span class="pf-stat-value"><?= (int)$user['lecciones_completadas'] ?> / <?= (int)$user['lecciones_totales'] ?></span>
                <span class="pf-stat-label">Lecciones completadas</span>
            </div>
            <div class="pf-stat">
                <span class="pf-stat-value"><?= htmlspecialchars(date('d/m/Y', strtotime($user['creado_en']))) ?></span>
                <span class="pf-stat-label">Miembro desde</span>
            </div>
        </div>
    </section>

    <!-- Cambiar Avatar -->
    <section class="pf-card">
        <h2>🎨 Cambiar Avatar</h2>
        <form method="POST" class="pf-form">
            <?= campoTokenCSRF() ?>
            <input type="hidden" name="action" value="cambiar_avatar">
            <div class="pf-avatar-grid" id="avatarGrid">
                <?php foreach ($avatares as $av): ?>
                <label class="pf-avatar-option <?= $av === $user['avatar'] ? 'selected' : '' ?>">
                    <input type="radio" name="avatar" value="<?= htmlspecialchars($av) ?>" <?= $av === $user['avatar'] ? 'checked' : '' ?> style="display:none">
                    <span><?= $av ?></span>
                </label>
                <?php endforeach; ?>
            </div>
            <button type="submit" class="pf-btn pf-btn-primary">💾 Guardar Avatar</button>
        </form>
    </section>

    <!-- Cambiar Username -->
    <section class="pf-card">
        <h2>✏️ Cambiar Nombre de Usuario</h2>
        <p class="pf-current">Actual: <strong><?= htmlspecialchars($user['nombre_usuario']) ?></strong></p>
        <form method="POST" class="pf-form">
            <?= campoTokenCSRF() ?>
            <input type="hidden" name="action" value="cambiar_username">
            <input type="text" name="nuevo_username" class="pf-input" placeholder="Nuevo nombre de usuario"
                   value="<?= htmlspecialchars($user['nombre_usuario']) ?>" minlength="3" maxlength="30" required>
            <button type="submit" class="pf-btn pf-btn-primary">💾 Actualizar Usuario</button>
        </form>
    </section>

    <!-- Cambiar Email -->
    <section class="pf-card">
        <h2>📧 Cambiar Correo Electrónico</h2>
        <p class="pf-current">📧 <?= htmlspecialchars($user['correo'] ?: 'Sin correo registrado') ?></p>
        <form method="POST" class="pf-form">
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(csrfToken()) ?>">
            <input type="hidden" name="action" value="cambiar_email">
            <input type="email" name="nuevo_email" class="pf-input" placeholder="Nuevo correo electrónico" required>
            <button type="submit" class="pf-btn pf-btn-primary">💾 Actualizar Correo</button>
        </form>
    </section>

    <!-- Cambiar Contraseña -->
    <section class="pf-card">
        <h2>🔐 Cambiar Contraseña</h2>
        <form method="POST" class="pf-form">
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(csrfToken()) ?>">
            <input type="hidden" name="action" value="cambiar_password">
            <input type="password" name="password_actual" class="pf-input" placeholder="Contraseña actual" required>
            <input type="password" name="password_nueva" class="pf-input" placeholder="Nueva contraseña" minlength="6" required>
            <input type="password" name="password_confirmar" class="pf-input" placeholder="Confirmar contraseña" minlength="6" required>
            <div style="display:flex;gap:10px;align-items:center;flex-wrap:wrap;">
                <button type="submit" class="pf-btn pf-btn-primary">💾 Actualizar Contraseña</button>
                <form method="POST" style="margin:0">
                    <?= campoTokenCSRF() ?>
                    <input type="hidden" name="action" value="solicitar_reset">
                    <button type="submit" class="pf-btn pf-btn-ghost" onclick="return confirm('¿Enviar un correo de restablecimiento a tu email registrado?')">
                        📩 Olvidé mi contraseña
                    </button>
                </form>
            </div>
        </form>
    </section>

    <?php endif; ?>
</div>

<style>
body.theme-light { --bg:#f4f8ff; --surface:#ffffff; --surface2:#eef4ff; --text:#061523; --muted:rgba(20,35,55,0.65); --border:rgba(0,120,170,0.16); --border2:rgba(0,120,170,0.28); }
.perfil-container { max-width:700px; margin:0 auto; padding:24px 16px; }
.perfil-header { display:flex; justify-content:space-between; align-items:center; margin-bottom:24px; }
.perfil-header h1 { font-family:'Syne',sans-serif; font-size:1.5rem; background:linear-gradient(135deg,var(--cyan),var(--green)); -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text; margin:0; }
.pf-alert { padding:12px 16px; border-radius:10px; margin-bottom:16px; font-size:0.85rem; font-weight:500; }
.pf-success { background:rgba(0,255,135,0.1); color:var(--green); border:1px solid rgba(0,255,135,0.2); }
.pf-error { background:rgba(255,60,172,0.1); color:var(--pink); border:1px solid rgba(255,60,172,0.2); }

.pf-card { position:relative; background:var(--surface); border:1px solid var(--border); border-radius:16px; padding:24px; margin-bottom:20px; overflow:hidden; }
.pf-card::before { content:''; position:absolute; top:0; left:0; right:0; height:1px; background:linear-gradient(90deg,transparent,var(--cyan),transparent); opacity:0.3; }
.pf-card h2 { font-family:'Syne',sans-serif; font-size:0.95rem; color:var(--cyan); margin:0 0 16px; letter-spacing:0.3px; text-transform:uppercase; }

.pf-avatar-display { display:flex; align-items:center; gap:16px; margin-bottom:16px; }
.pf-avatar-big { font-size:3rem; line-height:1; filter:drop-shadow(0 0 16px rgba(0,229,255,.3)); }

.pf-stats-grid { display:grid; grid-template-columns:repeat(auto-fit,minmax(140px,1fr)); gap:10px; }
.pf-stat { position:relative; background:var(--surface2); border:1px solid var(--border); border-radius:12px; padding:16px 12px; text-align:center; transition:all 0.3s; }
.pf-stat:hover { border-color:rgba(0,229,255,0.3); transform:translateY(-1px); }
.pf-stat-value { display:block; font-family:'Syne',sans-serif; font-size:1.15rem; color:var(--cyan); }
.pf-stat-label { display:block; font-size:0.65rem; color:var(--muted); text-transform:uppercase; letter-spacing:0.8px; margin-top:6px; }

.pf-avatar-grid { display:flex; flex-wrap:wrap; gap:8px; margin-bottom:14px; }
.pf-avatar-option { width:44px; height:44px; display:flex; align-items:center; justify-content:center; font-size:1.6rem; border-radius:10px; border:2px solid var(--border); cursor:pointer; transition:all .2s; background:var(--surface2); }
.pf-avatar-option:hover { border-color:var(--cyan); transform:scale(1.1); }
.pf-avatar-option.selected { border-color:var(--cyan); background:rgba(0,229,255,.12); box-shadow:0 0 12px rgba(0,229,255,.25); }

.pf-current { font-family:'JetBrains Mono',monospace; font-size:0.8rem; color:var(--muted); padding:8px 12px; background:var(--surface2); border-radius:8px; margin-bottom:14px; display:inline-block; }

.pf-form { display:flex; flex-direction:column; gap:10px; }
.pf-input { background:var(--surface2); border:1px solid var(--border); border-radius:10px; padding:12px 16px; color:var(--text); font-family:'Space Grotesk',sans-serif; font-size:0.85rem; transition:border-color 0.3s; width:100%; box-sizing:border-box; }
.pf-input:focus { outline:none; border-color:var(--cyan); box-shadow:0 0 0 3px rgba(0,229,255,0.08); }

.pf-btn { border:none; border-radius:10px; padding:11px 22px; font-family:'Space Grotesk',sans-serif; font-size:0.8rem; font-weight:600; cursor:pointer; transition:all 0.3s; text-decoration:none; display:inline-flex; align-items:center; gap:6px; align-self:flex-start; }
.pf-btn-primary { background:linear-gradient(135deg,var(--cyan),rgba(0,229,255,0.7)); color:#000; }
.pf-btn-primary:hover { transform:translateY(-1px); box-shadow:0 4px 20px rgba(0,229,255,0.25); }
.pf-btn-secondary { background:rgba(0,229,255,0.06); color:var(--cyan); border:1px solid rgba(0,229,255,0.2); }
.pf-btn-secondary:hover { background:rgba(0,229,255,0.12); border-color:rgba(0,229,255,0.4); }
.pf-btn-ghost { background:rgba(255,255,255,0.05); color:var(--muted); border:1px solid var(--border); font-size:0.75rem; padding:9px 16px; }
.pf-btn-ghost:hover { color:var(--text); border-color:var(--cyan); }

.pf-guest-card { position:relative; overflow:hidden; text-align:center; padding:64px 24px 48px; background:var(--surface); border:1px solid var(--border); border-radius:16px; margin:20px 0; }
.pf-guest-card::before { content:''; position:absolute; top:0; left:0; right:0; height:1px; background:linear-gradient(90deg,transparent,var(--cyan),transparent); opacity:0.3; }
.pf-guest-glow { position:absolute; top:-50%; left:50%; transform:translateX(-50%); width:300px; height:300px; background:radial-gradient(circle,rgba(0,229,255,0.1),transparent 70%); pointer-events:none; }
.pf-guest-icon { position:relative; font-size:3.5rem; margin-bottom:16px; filter:drop-shadow(0 0 24px rgba(0,229,255,0.3)); }
.pf-guest-card h2 { position:relative; font-family:'Syne',sans-serif; font-size:1.3rem; background:linear-gradient(135deg,var(--cyan),var(--green)); -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text; margin:0 0 8px; }
.pf-guest-card p { position:relative; color:var(--muted); font-size:0.85rem; max-width:340px; margin:0 auto 28px; line-height:1.6; }
.pf-guest-btn { position:relative; border:none; border-radius:10px; padding:12px 28px; background:linear-gradient(135deg,var(--cyan),rgba(0,229,255,0.6)); color:#000; font-family:'Space Grotesk',sans-serif; font-size:0.85rem; font-weight:700; cursor:pointer; transition:all 0.3s; letter-spacing:0.3px; }
.pf-guest-btn:hover { transform:translateY(-2px); box-shadow:0 8px 30px rgba(0,229,255,0.3); }
.pf-guest-lines { position:absolute; bottom:16px; left:50%; transform:translateX(-50%); display:flex; gap:6px; }
.pf-guest-lines span { display:block; width:20px; height:2px; background:rgba(0,229,255,0.15); border-radius:1px; }

@media(max-width:500px) { .pf-stats-grid { grid-template-columns:repeat(2,1fr); } }
</style>

<script>
// Avatar selector highlight
document.querySelectorAll('.pf-avatar-option').forEach(opt => {
    opt.addEventListener('click', () => {
        document.querySelectorAll('.pf-avatar-option').forEach(o => o.classList.remove('selected'));
        opt.classList.add('selected');
    });
});
</script>

<?php require __DIR__ . '/../src/Templates/page_end.php'; ?>


$is_guest = !empty($_SESSION['usuario_es_invitado']);
$usuario_id = (int)$_SESSION['usuario_id'];
$mensaje = '';
$error = '';
$exito = false;

// ─── CAMBIAR CONTRASEÑA ─────────────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'cambiar_password') {
    protegerCSRF();
    $actual = $_POST['password_actual'] ?? '';
    $nueva = $_POST['password_nueva'] ?? '';
    $confirmar = $_POST['password_confirmar'] ?? '';

    if (empty($actual) || empty($nueva) || empty($confirmar)) {
        $error = 'Todos los campos son obligatorios.';
    } elseif ($nueva !== $confirmar) {
        $error = 'Las contraseñas no coinciden.';
    } elseif (strlen($nueva) < 6) {
        $error = 'La nueva contraseña debe tener al menos 6 caracteres.';
    } else {
        $stmt = $pdo->prepare("SELECT contrasena_hash FROM usuarios WHERE id = ?");
        $stmt->execute([$usuario_id]);
        $hash = $stmt->fetchColumn();

        if (!password_verify($actual, $hash)) {
            $error = 'La contraseña actual no es correcta.';
        } else {
            $nuevo_hash = password_hash($nueva, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("UPDATE usuarios SET contrasena_hash = ? WHERE id = ?");
            $stmt->execute([$nuevo_hash, $usuario_id]);
            $mensaje = 'Contraseña actualizada correctamente.';
        }
    }
}

// ─── CAMBIAR EMAIL ───────────────────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'cambiar_email') {
    protegerCSRF();
    $nuevo_email = trim($_POST['nuevo_email'] ?? '');

    if (empty($nuevo_email) || !filter_var($nuevo_email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Correo electrónico no válido.';
    } else {
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM usuarios WHERE correo = ? AND id != ?");
        $stmt->execute([$nuevo_email, $usuario_id]);
        if ($stmt->fetchColumn() > 0) {
            $error = 'Ese correo ya está registrado por otro usuario.';
        } else {
            $stmt = $pdo->prepare("UPDATE usuarios SET correo = ? WHERE id = ?");
            $stmt->execute([$nuevo_email, $usuario_id]);
            $mensaje = 'Correo actualizado correctamente.';
        }
    }
}

// ─── DATOS DEL USUARIO ──────────────────────────────────────────────
$user = null;
if (!$is_guest) {
    $stmt = $pdo->prepare("SELECT nombre_usuario, correo, puntos, nivel, tipo, creado_en,
        (SELECT COUNT(*) FROM user_progress WHERE user_id = ? AND completed = 1) as lecciones_completadas,
        (SELECT COUNT(*) FROM user_progress WHERE user_id = ?) as lecciones_totales
        FROM usuarios WHERE id = ?");
    $stmt->execute([$usuario_id, $usuario_id, $usuario_id]);
    $user = $stmt->fetch();
    if (!$user) { redirigir('public/login.php'); }
}

$page_title = $t['title'] . ' | LC-ADVANCE';
$page_css_files = ['assets/css/dashboard.css'];
$page_show_bg_orb = false;
require __DIR__ . '/../src/Templates/page_start.php';
?>

<div class="perfil-container">
    <header class="perfil-header">
        <h1><?= htmlspecialchars($t['title']) ?></h1>
        <a href="dashboard.php" class="pf-btn pf-btn-secondary"><?= htmlspecialchars($t['back_dashboard']) ?></a>
    </header>

    <?php if ($mensaje): ?><div class="pf-alert pf-success"><?= htmlspecialchars($mensaje) ?></div><?php endif; ?>
    <?php if ($error): ?><div class="pf-alert pf-error"><?= htmlspecialchars($error) ?></div><?php endif; ?>

    <?php if ($is_guest): ?>

    <div class="pf-guest-card">
        <div class="pf-guest-glow"></div>
        <div class="pf-guest-icon">🔒</div>
        <h2>Acceso restringido</h2>
        <p>Estás navegando como invitado. Los perfiles solo están disponibles para usuarios registrados.</p>
        <form method="post" action="logout.php">
            <?= campoTokenCSRF() ?>
            <button type="submit" class="pf-guest-btn">🚪 Cerrar sesión e ir a Login</button>
        </form>
        <div class="pf-guest-lines">
            <span></span><span></span><span></span>
        </div>
    </div>

    <?php else: ?>

    <!-- Stats -->
    <section class="pf-card">
        <h2><?= htmlspecialchars($t['stats']) ?></h2>
        <div class="pf-stats-grid">
            <div class="pf-stat">
                <span class="pf-stat-value"><?= htmlspecialchars($user['nombre_usuario']) ?></span>
                <span class="pf-stat-label">Usuario</span>
            </div>
            <div class="pf-stat">
                <span class="pf-stat-value"><?= (int)$user['nivel'] ?></span>
                <span class="pf-stat-label"><?= htmlspecialchars($t['level']) ?></span>
            </div>
            <div class="pf-stat">
                <span class="pf-stat-value"><?= (int)$user['puntos'] ?></span>
                <span class="pf-stat-label"><?= htmlspecialchars($t['xp']) ?></span>
            </div>
            <div class="pf-stat">
                <span class="pf-stat-value"><?= (int)$user['lecciones_completadas'] ?> / <?= (int)$user['lecciones_totales'] ?></span>
                <span class="pf-stat-label"><?= htmlspecialchars($t['completed_lessons']) ?></span>
            </div>
            <div class="pf-stat">
                <span class="pf-stat-value"><?= $user['tipo'] === 'teacher' ? '👨‍🏫' : '🎓' ?> <?= htmlspecialchars($t[$user['tipo']] ?? $t['student']) ?></span>
                <span class="pf-stat-label"><?= htmlspecialchars($t['type']) ?></span>
            </div>
            <div class="pf-stat">
                <span class="pf-stat-value"><?= htmlspecialchars(date('d/m/Y', strtotime($user['creado_en']))) ?></span>
                <span class="pf-stat-label"><?= htmlspecialchars($t['member_since']) ?></span>
            </div>
        </div>
    </section>

    <!-- Cambiar Email -->
    <section class="pf-card">
        <h2><?= htmlspecialchars($t['email_section']) ?></h2>
        <p class="pf-current">📧 <?= htmlspecialchars($user['correo'] ?: 'Sin correo registrado') ?></p>
        <form method="POST" class="pf-form">
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(csrfToken()) ?>">
            <input type="hidden" name="action" value="cambiar_email">
            <input type="email" name="nuevo_email" class="pf-input" placeholder="<?= htmlspecialchars($t['new_email']) ?>" required>
            <button type="submit" class="pf-btn pf-btn-primary"><?= htmlspecialchars($t['change_email_btn']) ?></button>
        </form>
    </section>

    <!-- Cambiar Contraseña -->
    <section class="pf-card">
        <h2><?= htmlspecialchars($t['password_section']) ?></h2>
        <form method="POST" class="pf-form">
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(csrfToken()) ?>">
            <input type="hidden" name="action" value="cambiar_password">
            <input type="password" name="password_actual" class="pf-input" placeholder="<?= htmlspecialchars($t['current_password']) ?>" required>
            <input type="password" name="password_nueva" class="pf-input" placeholder="<?= htmlspecialchars($t['new_password']) ?>" minlength="6" required>
            <input type="password" name="password_confirmar" class="pf-input" placeholder="<?= htmlspecialchars($t['confirm_password']) ?>" minlength="6" required>
            <button type="submit" class="pf-btn pf-btn-primary"><?= htmlspecialchars($t['change_password_btn']) ?></button>
        </form>
    </section>

    <?php endif; ?>
</div>

<style>
body.theme-light { --bg:#f4f8ff; --surface:#ffffff; --surface2:#eef4ff; --text:#061523; --muted:rgba(20,35,55,0.65); --border:rgba(0,120,170,0.16); --border2:rgba(0,120,170,0.28); }
.perfil-container { max-width:700px; margin:0 auto; padding:24px 16px; }
.perfil-header { display:flex; justify-content:space-between; align-items:center; margin-bottom:24px; }
.perfil-header h1 { font-family:'Syne',sans-serif; font-size:1.5rem; background:linear-gradient(135deg,var(--cyan),var(--green)); -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text; margin:0; }
.pf-alert { padding:12px 16px; border-radius:10px; margin-bottom:16px; font-size:0.85rem; font-weight:500; }
.pf-success { background:rgba(0,255,135,0.1); color:var(--green); border:1px solid rgba(0,255,135,0.2); }
.pf-error { background:rgba(255,60,172,0.1); color:var(--pink); border:1px solid rgba(255,60,172,0.2); }

.pf-card { position:relative; background:var(--surface); border:1px solid var(--border); border-radius:16px; padding:24px; margin-bottom:20px; overflow:hidden; }
.pf-card::before { content:''; position:absolute; top:0; left:0; right:0; height:1px; background:linear-gradient(90deg,transparent,var(--cyan),transparent); opacity:0.3; }
.pf-card h2 { font-family:'Syne',sans-serif; font-size:0.95rem; color:var(--cyan); margin:0 0 16px; letter-spacing:0.3px; text-transform:uppercase; }

.pf-stats-grid { display:grid; grid-template-columns:repeat(auto-fit,minmax(140px,1fr)); gap:10px; }
.pf-stat { position:relative; background:var(--surface2); border:1px solid var(--border); border-radius:12px; padding:16px 12px; text-align:center; transition:all 0.3s; }
.pf-stat:hover { border-color:rgba(0,229,255,0.3); transform:translateY(-1px); }
.pf-stat-value { display:block; font-family:'Syne',sans-serif; font-size:1.15rem; color:var(--cyan); }
.pf-stat-label { display:block; font-size:0.65rem; color:var(--muted); text-transform:uppercase; letter-spacing:0.8px; margin-top:6px; }

.pf-current { font-family:'JetBrains Mono',monospace; font-size:0.8rem; color:var(--muted); padding:8px 12px; background:var(--surface2); border-radius:8px; margin-bottom:14px; display:inline-block; }

.pf-form { display:flex; flex-direction:column; gap:10px; }
.pf-input { background:var(--surface2); border:1px solid var(--border); border-radius:10px; padding:12px 16px; color:var(--text); font-family:'Space Grotesk',sans-serif; font-size:0.85rem; transition:border-color 0.3s; }
.pf-input:focus { outline:none; border-color:var(--cyan); box-shadow:0 0 0 3px rgba(0,229,255,0.08); }

.pf-btn { border:none; border-radius:10px; padding:11px 22px; font-family:'Space Grotesk',sans-serif; font-size:0.8rem; font-weight:600; cursor:pointer; transition:all 0.3s; text-decoration:none; display:inline-flex; align-items:center; gap:6px; align-self:flex-start; }
.pf-btn-primary { background:linear-gradient(135deg,var(--cyan),rgba(0,229,255,0.7)); color:#000; }
.pf-btn-primary:hover { transform:translateY(-1px); box-shadow:0 4px 20px rgba(0,229,255,0.25); }
.pf-btn-secondary { background:rgba(0,229,255,0.06); color:var(--cyan); border:1px solid rgba(0,229,255,0.2); }
.pf-btn-secondary:hover { background:rgba(0,229,255,0.12); border-color:rgba(0,229,255,0.4); }

.pf-guest-card { position:relative; overflow:hidden; text-align:center; padding:64px 24px 48px; background:var(--surface); border:1px solid var(--border); border-radius:16px; margin:20px 0; }
.pf-guest-card::before { content:''; position:absolute; top:0; left:0; right:0; height:1px; background:linear-gradient(90deg,transparent,var(--cyan),transparent); opacity:0.3; }
.pf-guest-glow { position:absolute; top:-50%; left:50%; transform:translateX(-50%); width:300px; height:300px; background:radial-gradient(circle,rgba(0,229,255,0.1),transparent 70%); pointer-events:none; }
.pf-guest-icon { position:relative; font-size:3.5rem; margin-bottom:16px; filter:drop-shadow(0 0 24px rgba(0,229,255,0.3)); }
.pf-guest-card h2 { position:relative; font-family:'Syne',sans-serif; font-size:1.3rem; background:linear-gradient(135deg,var(--cyan),var(--green)); -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text; margin:0 0 8px; }
.pf-guest-card p { position:relative; color:var(--muted); font-size:0.85rem; max-width:340px; margin:0 auto 28px; line-height:1.6; }
.pf-guest-btn { position:relative; border:none; border-radius:10px; padding:12px 28px; background:linear-gradient(135deg,var(--cyan),rgba(0,229,255,0.6)); color:#000; font-family:'Space Grotesk',sans-serif; font-size:0.85rem; font-weight:700; cursor:pointer; transition:all 0.3s; letter-spacing:0.3px; }
.pf-guest-btn:hover { transform:translateY(-2px); box-shadow:0 8px 30px rgba(0,229,255,0.3); }
.pf-guest-lines { position:absolute; bottom:16px; left:50%; transform:translateX(-50%); display:flex; gap:6px; }
.pf-guest-lines span { display:block; width:20px; height:2px; background:rgba(0,229,255,0.15); border-radius:1px; }

@media(max-width:500px) { .pf-stats-grid { grid-template-columns:repeat(2,1fr); } }
</style>

<?php require __DIR__ . '/../src/Templates/page_end.php'; ?>
