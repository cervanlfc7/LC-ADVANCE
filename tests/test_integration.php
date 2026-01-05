<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$base = getenv('TEST_BASE_URL') ?: 'http://localhost/LC-Advance/';
$cookieFile = __DIR__ . '/integration_cookies.txt';
@unlink($cookieFile);

function curl_get($url, $cookieFile) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_COOKIEJAR, $cookieFile);
    curl_setopt($ch, CURLOPT_COOKIEFILE, $cookieFile);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $res = curl_exec($ch);
    if (curl_errno($ch)) {
        echo "FAIL: curl error: " . curl_error($ch) . "\n";
        exit(2);
    }
    $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    return [$status, $res];
}

function curl_post($url, $data, $cookieFile) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_COOKIEJAR, $cookieFile);
    curl_setopt($ch, CURLOPT_COOKIEFILE, $cookieFile);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $res = curl_exec($ch);
    if (curl_errno($ch)) {
        echo "FAIL: curl error: " . curl_error($ch) . "\n";
        exit(2);
    }
    $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    return [$status, $res];
}

// 1) Guest attempt to update_progress should be blocked (403)
list($s, $r) = curl_get($base . 'guest_login.php', $cookieFile);
list($s2, $r2) = curl_post($base . 'update_progress.php', ['slug' => 'b1-past-simple-2025', 'correctas' => 1, 'xp' => 10], $cookieFile);
if ($s2 !== 403 && strpos($r2, 'No autorizado') === false) {
    echo "FAIL: guest update_progress did not block (HTTP $s2)\n";
    exit(3);
}

// Clean guest session cookies before registering a test user
@unlink($cookieFile);
$cookieFile = __DIR__ . '/integration_cookies_auth.txt';

// 2) Register and login a fresh test user
$ts = time();
$username = "int_test_{$ts}";
$email = "{$username}@example.com";
$password = 'Passw0rd!';

// register
$regPage = curl_get($base . 'register.php', $cookieFile)[1];
if (!preg_match('/name="csrf_token"\s+value="([^"]+)"/', $regPage, $m)) { echo "FAIL: missing token on register\n"; exit(4); }
$token = $m[1];
list($s3, $r3) = curl_post($base . 'register.php', ['csrf_token' => $token, 'nombre_usuario' => $username, 'correo' => $email, 'contrasena' => $password, 'confirmar' => $password], $cookieFile);
// login
$loginPage = curl_get($base . 'login.php', $cookieFile)[1];
if (!preg_match('/name="csrf_token"\s+value="([^"]+)"/', $loginPage, $m)) { echo "FAIL: missing token on login\n"; exit(5); }
$token = $m[1];
list($s4, $r4) = curl_post($base . 'login.php', ['csrf_token' => $token, 'nombre_usuario' => $username, 'contrasena' => $password], $cookieFile);

// 3) Fetch state before update
$estadoBefore = json_decode(curl_post($base . 'src/funciones.php', ['accion' => 'obtener_estado'], $cookieFile)[1], true);
$pointsBefore = isset($estadoBefore['puntos']) ? (int)$estadoBefore['puntos'] : 0;

// 4) Call update_progress.php to add xp
list($s5, $r5) = curl_post($base . 'update_progress.php', ['slug' => 'b1-past-simple-2025', 'correctas' => 5, 'xp' => 50], $cookieFile);
if ($s5 !== 200 || trim($r5) !== 'OK') { echo "FAIL: update_progress did not return OK (HTTP $s5) Response: $r5\n"; exit(6); }

// 5) Verify state after update
$estadoAfter = json_decode(curl_post($base . 'src/funciones.php', ['accion' => 'obtener_estado'], $cookieFile)[1], true);
$pointsAfter = isset($estadoAfter['puntos']) ? (int)$estadoAfter['puntos'] : 0;
if ($pointsAfter !== $pointsBefore + 50) { echo "FAIL: update_progress didn't increase points correctly (before=$pointsBefore, after=$pointsAfter)\n"; exit(7); }

@unlink($cookieFile);

echo "OK: integration endpoint tests passed\n";
exit(0);
