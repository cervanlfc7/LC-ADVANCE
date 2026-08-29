<?php
require_once __DIR__ . '/../src/Config/config.php';
iniciarSesionSegura();

$token = $_GET['token'] ?? '';
$mensaje = '';
$exito = false;

if (!empty($token)) {
    $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE email_verify_token = ? AND email_verified = 0");
    $stmt->execute([$token]);
    $usuario_id = $stmt->fetchColumn();

    if ($usuario_id) {
        $pdo->prepare("UPDATE usuarios SET email_verified = 1, email_verify_token = NULL WHERE id = ?")->execute([$usuario_id]);
        logSeguridadEvento('EMAIL_VERIFIED', "Usuario ID: {$usuario_id}", $usuario_id);
        $exito = true;
        $mensaje = '✅ Correo verificado correctamente. ¡Ya puedes disfrutar de todas las funciones!';
    } else {
        $mensaje = '❌ El enlace de verificación es inválido o tu correo ya fue verificado.';
    }
} else {
    $mensaje = '❌ Token de verificación faltante.';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Verificar Correo | LC-ADVANCE</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&family=Syne:wght@700;800&display=swap" rel="stylesheet">
    <style>
        :root { --bg:#060a12; --surface:#0d1626; --surface2:#121d33; --border:rgba(0,230,255,0.16); --cyan:#00e5ff; --pink:#ff3cac; --green:#00ff87; --text:#e8f4ff; --muted:rgba(200,230,255,0.64); --font-display:"Syne",sans-serif; --font-body:"Space Grotesk",sans-serif; }
        *,*::before,*::after { box-sizing:border-box; }
        body { margin:0; min-height:100vh; display:flex; align-items:center; justify-content:center; font-family:var(--font-body); color:var(--text); background:radial-gradient(circle at 30% -10%, rgba(0,229,255,0.15), transparent 40%), radial-gradient(circle at 85% 100%, rgba(255,60,200,0.15), transparent 45%), var(--bg); }
        .card { background:var(--surface); border:1px solid var(--border); border-radius:16px; padding:36px; width:90%; max-width:420px; text-align:center; }
        .card h1 { font-family:var(--font-display); font-size:1.3rem; color:var(--cyan); margin:0 0 16px; }
        .msg { font-size:0.9rem; font-weight:500; }
        .success { color:var(--green); }
        .error { color:var(--pink); }
        .btn { display:inline-block; margin-top:16px; padding:12px 24px; background:var(--cyan); color:#000; border-radius:8px; text-decoration:none; font-weight:600; }
    </style>
</head>
<body>
    <div class="card">
        <h1>📧 Verificación de Correo</h1>
        <div class="msg <?= $exito ? 'success' : 'error' ?>"><?= htmlspecialchars($mensaje) ?></div>
        <a href="login.php" class="btn">Ir a Iniciar Sesión</a>
    </div>
</body>
</html>
