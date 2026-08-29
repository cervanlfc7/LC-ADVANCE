<?php
require_once __DIR__ . '/../../src/Config/config.php';
require_once __DIR__ . '/../../src/Config/csrf.php';
require_once __DIR__ . '/../../src/Core/admin.php';
requireAdmin();

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !validarCsrfToken($_POST['csrf_token'] ?? '')) {
    redirigir('usuarios.php');
}

$userId = $_SESSION['usuario_id'];
$stmt = $pdo->prepare("UPDATE usuarios SET twofa_enabled = 0, twofa_secret = NULL WHERE id = ?");
$stmt->execute([$userId]);
logSeguridadEvento('ADMIN_2FA_DISABLED', '2FA desactivado por admin', $userId);
redirigir('setup_2fa.php');
?>