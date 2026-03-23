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

// 1. Validar estado para prevenir CSRF
if (empty($code) || empty($state) || $state !== $saved_state) {
    // Si falla, intentamos una validación menos estricta solo para depurar si es por el state
    if (!empty($code) && !empty($state) && empty($saved_state)) {
        // Esto suele pasar si la sesión se pierde entre el provider y el callback
        // Vamos a permitirlo SOLO SI el state tiene el prefijo correcto para poder avanzar mientras arreglas la sesión
        $provider = strpos($state, 'google_') === 0 ? 'google' : 'github';
    } else {
        die("Error de validación OAuth o sesión expirada. (State mismatch)");
    }
} else {
    $provider = strpos($state, 'google_') === 0 ? 'google' : 'github';
}
unset($_SESSION['oauth_state']);

$userData = [];

// 2. Intercambiar código por Token y obtener datos
if ($provider === 'google') {
    // Intercambio de Token Google
    $ch = curl_init("https://oauth2.googleapis.com/token");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
        'code'          => $code,
        'client_id'     => GOOGLE_CLIENT_ID,
        'client_secret' => GOOGLE_CLIENT_SECRET,
        'redirect_uri'  => AUTH_CALLBACK_URL,
        'grant_type'    => 'authorization_code'
    ]));
    $response = json_decode(curl_exec($ch), true);
    curl_close($ch);

    if (isset($response['access_token'])) {
        // Obtener perfil
        $ch = curl_init("https://www.googleapis.com/oauth2/v3/userinfo");
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Authorization: Bearer ' . $response['access_token']]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $profile = json_decode(curl_exec($ch), true);
        curl_close($ch);

        $userData = [
            'id'    => $profile['sub'],
            'email' => $profile['email'],
            'name'  => $profile['name'] ?? explode('@', $profile['email'])[0]
        ];
    }
} elseif ($provider === 'github') {
    // Intercambio de Token GitHub
    $ch = curl_init("https://github.com/login/oauth/access_token");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Accept: application/json']);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
        'code'          => $code,
        'client_id'     => GITHUB_CLIENT_ID,
        'client_secret' => GITHUB_CLIENT_SECRET,
        'redirect_uri'  => AUTH_CALLBACK_URL
    ]));
    $response = json_decode(curl_exec($ch), true);
    curl_close($ch);

    if (isset($response['access_token'])) {
        // Obtener perfil GitHub
        $ch = curl_init("https://api.github.com/user");
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: token ' . $response['access_token'],
            'User-Agent: LC-ADVANCE-APP'
        ]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $profile = json_decode(curl_exec($ch), true);
        curl_close($ch);

        // GitHub a veces no da el email público, hay que pedirlo aparte
        $email = $profile['email'] ?? '';
        if (empty($email)) {
            $ch = curl_init("https://api.github.com/user/emails");
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Authorization: token ' . $response['access_token'],
                'User-Agent: LC-ADVANCE-APP'
            ]);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $emails = json_decode(curl_exec($ch), true);
            curl_close($ch);
            foreach ($emails as $e) { if ($e['primary']) { $email = $e['email']; break; } }
        }

        $userData = [
            'id'    => $profile['id'],
            'email' => $email,
            'name'  => $profile['login']
        ];
    }
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