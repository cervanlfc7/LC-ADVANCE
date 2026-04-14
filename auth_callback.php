<?php
/**
 * LC-ADVANCE Auth Callback
 * Handles the response from OAuth providers
 */

require_once 'config/config.php';
iniciarSesionSegura();

// --- DEBUG TEMPORAL (Borrar después de arreglar) ---
/*
echo "DEBUG OAUTH:<br>";
echo "GET State: " . ($_GET['state'] ?? 'N/A') . "<br>";
echo "SESSION State: " . ($_SESSION['oauth_state'] ?? 'N/A') . "<br>";
echo "SESSION ID: " . session_id() . "<br>";
*/
// --------------------------------------------------

$code = $_GET['code'] ?? '';
$state = $_GET['state'] ?? '';
$saved_state = $_SESSION['oauth_state'] ?? '';

// Si la sesión se perdió, intentamos restaurar el state desde la cookie temporal.
if (empty($saved_state) && !empty($_COOKIE['oauth_state'])) {
    $saved_state = $_COOKIE['oauth_state'];
    $_SESSION['oauth_state'] = $saved_state;
    if (empty($_SESSION['oauth_redirect']) && !empty($_COOKIE['oauth_redirect'])) {
        $_SESSION['oauth_redirect'] = $_COOKIE['oauth_redirect'];
    }
}

if (!empty($_GET['error'])) {
    $errorDescription = $_GET['error_description'] ?? '';
    die('Error OAuth: ' . htmlspecialchars($_GET['error']) . '. ' . htmlspecialchars($errorDescription));
}

// 1. Validar estado para prevenir CSRF
if (empty($code) || empty($state) || empty($saved_state) || $state !== $saved_state) {
    logSeguridadEvento('OAUTH_STATE_MISMATCH', "Callback state mismatch. returned={$state}; saved={$saved_state}");
    die('Error de validación OAuth o sesión expirada. (State mismatch). Asegúrate de permitir cookies de sesión y usa el mismo navegador para iniciar sesión.');
}

$provider = strpos($state, 'google_') === 0 ? 'google' : 'github';
unset($_SESSION['oauth_state']);
setcookie('oauth_state', '', time() - 3600, '/');
setcookie('oauth_provider', '', time() - 3600, '/');
setcookie('oauth_redirect', '', time() - 3600, '/');

function oauth_curl_exec($ch) {
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

    // En desarrollo local, algunos entornos Windows pueden fallar por CA/SSL.
    if (preg_match('/^http:\/\/localhost|^http:\/\/127\.0\.0\.1/', AUTH_CALLBACK_URL)) {
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    }

    $result = curl_exec($ch);
    if ($result === false) {
        $error = curl_error($ch);
        curl_close($ch);
        return ['ok' => false, 'error' => $error];
    }

    $info = curl_getinfo($ch);
    curl_close($ch);
    return ['ok' => true, 'response' => $result, 'info' => $info];
}

$userData = [];

// 2. Intercambiar código por Token y obtener datos
if ($provider === 'google') {
    // Intercambio de Token Google
    $ch = curl_init("https://oauth2.googleapis.com/token");
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded']);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
        'code'          => $code,
        'client_id'     => GOOGLE_CLIENT_ID,
        'client_secret' => GOOGLE_CLIENT_SECRET,
        'redirect_uri'  => AUTH_CALLBACK_URL,
        'grant_type'    => 'authorization_code'
    ]));
    $result = oauth_curl_exec($ch);
    if (!$result['ok']) {
        die('No se pudieron obtener los datos del usuario desde Google. Error de conexión: ' . htmlspecialchars($result['error']));
    }
    $response = json_decode($result['response'], true);
    if (empty($response['access_token'])) {
        $error = $response['error_description'] ?? $response['error'] ?? 'Token no recibido desde Google.';
        die('No se pudieron obtener los datos del usuario desde Google. ' . htmlspecialchars($error));
    }

    // Obtener perfil
    $ch = curl_init("https://www.googleapis.com/oauth2/v3/userinfo");
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Authorization: Bearer ' . $response['access_token']]);
    $profileResult = oauth_curl_exec($ch);
    if (!$profileResult['ok']) {
        die('No se pudieron obtener los datos del usuario desde Google. Error de conexión: ' . htmlspecialchars($profileResult['error']));
    }
    $profile = json_decode($profileResult['response'], true);

    $userData = [
        'id'    => $profile['sub'] ?? '',
        'email' => $profile['email'] ?? '',
        'name'  => $profile['name'] ?? explode('@', $profile['email'] ?? 'usuario')[0]
    ];
} elseif ($provider === 'github') {
    // Intercambio de Token GitHub
    $ch = curl_init("https://github.com/login/oauth/access_token");
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Accept: application/json',
        'Content-Type: application/x-www-form-urlencoded'
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
        'code'          => $code,
        'client_id'     => GITHUB_CLIENT_ID,
        'client_secret' => GITHUB_CLIENT_SECRET,
        'redirect_uri'  => AUTH_CALLBACK_URL
    ]));
    $result = oauth_curl_exec($ch);
    if (!$result['ok']) {
        die('No se pudieron obtener los datos del usuario desde GitHub. Error de conexión: ' . htmlspecialchars($result['error']));
    }
    $response = json_decode($result['response'], true);
    if (empty($response['access_token'])) {
        $error = $response['error_description'] ?? $response['error'] ?? 'Token no recibido desde GitHub.';
        die('No se pudieron obtener los datos del usuario desde GitHub. ' . htmlspecialchars($error));
    }

    $accessToken = $response['access_token'];
    // Obtener perfil GitHub
    $ch = curl_init("https://api.github.com/user");
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Authorization: token ' . $accessToken,
        'User-Agent: LC-ADVANCE-APP'
    ]);
    $profileResult = oauth_curl_exec($ch);
    if (!$profileResult['ok']) {
        die('No se pudieron obtener los datos del usuario desde GitHub. Error de conexión: ' . htmlspecialchars($profileResult['error']));
    }
    $profile = json_decode($profileResult['response'], true);

    // GitHub a veces no da el email público, hay que pedirlo aparte
    $email = $profile['email'] ?? '';
    if (empty($email)) {
        $ch = curl_init("https://api.github.com/user/emails");
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: token ' . $accessToken,
            'User-Agent: LC-ADVANCE-APP'
        ]);
        $emailsResult = oauth_curl_exec($ch);
        if (!$emailsResult['ok']) {
            die('No se pudieron obtener los datos del usuario desde GitHub. Error de conexión: ' . htmlspecialchars($emailsResult['error']));
        }
        $emails = json_decode($emailsResult['response'], true);
        foreach ($emails as $e) { if (!empty($e['primary'])) { $email = $e['email']; break; } }
    }

    $userData = [
        'id'    => $profile['id'] ?? '',
        'email' => $email,
        'name'  => $profile['login'] ?? 'github_user'
    ];
}

// 3. Procesar en Base de Datos
if (!empty($userData)) {
    $col_id = ($provider === 'google') ? 'google_id' : 'github_id';
    
    // Buscar si ya existe por ID social
    $stmt = $pdo->prepare("SELECT id, nombre_usuario, puntos, nivel FROM usuarios WHERE $col_id = ?");
    $stmt->execute([$userData['id']]);
    $user = $stmt->fetch();

    if (!$user) {
        // Buscar por email (vincular cuenta existente)
        $stmt = $pdo->prepare("SELECT id, nombre_usuario, puntos, nivel FROM usuarios WHERE correo = ?");
        $stmt->execute([$userData['email']]);
        $user = $stmt->fetch();

        if ($user) {
            // Vincular ID social a cuenta existente
            $stmt = $pdo->prepare("UPDATE usuarios SET $col_id = ? WHERE id = ?");
            $stmt->execute([$userData['id'], $user['id']]);
        } else {
            // Crear nuevo usuario
            $username = $userData['name'] . '_' . rand(100, 999);
            $stmt = $pdo->prepare("INSERT INTO usuarios (nombre_usuario, correo, $col_id, contrasena_hash) VALUES (?, ?, ?, ?)");
            $stmt->execute([$username, $userData['email'], $userData['id'], password_hash(bin2hex(random_bytes(16)), PASSWORD_DEFAULT)]);
            
            $new_id = $pdo->lastInsertId();
            $user = ['id' => $new_id, 'nombre_usuario' => $username, 'puntos' => 0, 'nivel' => 1];
        }
    }

    // 4. Loguear al usuario
    $_SESSION['usuario_id'] = $user['id'];
    $_SESSION['usuario_nombre'] = $user['nombre_usuario'];
    $_SESSION['usuario_puntos'] = $user['puntos'];
    $_SESSION['usuario_nivel'] = $user['nivel'];
    $_SESSION['last_activity'] = time();

    $final_redirect = $_SESSION['oauth_redirect'] ?? 'mapa/index.php';
    unset($_SESSION['oauth_redirect']);
    redirigir($final_redirect);
} else {
    die("No se pudieron obtener los datos del usuario desde $provider.");
}
?>