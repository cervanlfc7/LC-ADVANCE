<?php
/**
 * LC-ADVANCE Auth Provider
 * Redirects the user to Google or GitHub for authentication
 */

require_once 'config/config.php';
iniciarSesionSegura();

$provider = $_GET['provider'] ?? '';
$redirect_to = $_GET['redirect'] ?? 'mapa/index.php';

// Guardar el destino final en la sesión para usarlo después del callback
$_SESSION['oauth_redirect'] = $redirect_to;

function guardarOauthCookies($state, $provider, $redirect_to) {
    $cookieOptions = [
        'expires'  => time() + 300,
        'path'     => '/',
        'domain'   => '',
        'secure'   => (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off'),
        'httponly' => true,
        'samesite' => 'Lax'
    ];
    setcookie('oauth_state', $state, $cookieOptions);
    setcookie('oauth_provider', $provider, $cookieOptions);
    setcookie('oauth_redirect', $redirect_to, $cookieOptions);
}

if ($provider === 'google') {
    $params = [
        'client_id'     => GOOGLE_CLIENT_ID,
        'redirect_uri'  => AUTH_CALLBACK_URL,
        'response_type' => 'code',
        'scope'         => 'openid email profile',
        'state'         => 'google_' . bin2hex(random_bytes(16))
    ];
    $_SESSION['oauth_state'] = $params['state'];
    guardarOauthCookies($params['state'], 'google', $redirect_to);
    $url = "https://accounts.google.com/o/oauth2/v2/auth?" . http_build_query($params);
    header("Location: $url");
    exit;

} elseif ($provider === 'github') {
    $params = [
        'client_id'    => GITHUB_CLIENT_ID,
        'redirect_uri' => AUTH_CALLBACK_URL,
        'scope'        => 'user:email',
        'state'        => 'github_' . bin2hex(random_bytes(16))
    ];
    $_SESSION['oauth_state'] = $params['state'];
    guardarOauthCookies($params['state'], 'github', $redirect_to);
    $url = "https://github.com/login/oauth/authorize?" . http_build_query($params);
    header("Location: $url");
    exit;
}

die("Proveedor de autenticación no válido.");
?>