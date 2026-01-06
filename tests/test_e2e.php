<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$envBase = getenv('TEST_BASE_URL');
$base = $envBase ? rtrim($envBase, '/') . '/' : 'http://localhost/LC-Advance/';
$lessonUrl = $base . 'leccion_detalle.php?slug=b1-past-simple-2025&materia=Ingl%C3%A9s';
$cookieFile = __DIR__ . '/e2e_cookies.txt';
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
    curl_close($ch);
    return $res;
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
    curl_close($ch);
    return $res;
}

$html = curl_get($lessonUrl, $cookieFile);

// If we're redirected to login/register, create a test user and login
if (strpos($html, 'class="auth-form"') !== false || strpos($html, 'Entrar') !== false) {
    // Register
    $regPage = curl_get($base . 'register.php', $cookieFile);
    if (!preg_match('/name="csrf_token"\s+value="([^"]+)"/', $regPage, $m)) {
        echo "FAIL: Could not find CSRF token on register page\n";
        file_put_contents(__DIR__ . '/last_e2e_response.html', $regPage);
        exit(4);
    }
    $token = $m[1];
    $ts = time();
    $username = "e2e_test_{$ts}";
    $email = "{$username}@example.com";
    $password = 'Test1234';

    $regResp = curl_post($base . 'register.php', [
        'csrf_token' => $token,
        'nombre_usuario' => $username,
        'correo' => $email,
        'contrasena' => $password,
        'confirmar' => $password
    ], $cookieFile);

    // Try to login
    $loginPage = curl_get($base . 'login.php', $cookieFile);
    if (!preg_match('/name="csrf_token"\s+value="([^"]+)"/', $loginPage, $m)) {
        echo "FAIL: Could not find CSRF token on login page\n";
        file_put_contents(__DIR__ . '/last_e2e_response.html', $loginPage);
        exit(5);
    }
    $token = $m[1];

    $loginResp = curl_post($base . 'login.php', [
        'csrf_token' => $token,
        'nombre_usuario' => $username,
        'contrasena' => $password
    ], $cookieFile);

    // Re-fetch lesson as authenticated user
    $html = curl_get($lessonUrl, $cookieFile);
}

if (strpos($html, 'PAST SIMPLE DOMINATION 2025') === false) {
    echo "FAIL: Expected lesson content marker not found in HTML\n";
    file_put_contents(__DIR__ . '/last_e2e_response.html', $html);
    exit(3);
}

// === QUIZ FLOW: submit answers using the server-provided `quizData` variable ===
// Fetch current estado (puntos) before quiz
$estadoBefore = json_decode(curl_post($base . 'src/funciones.php', ['accion' => 'obtener_estado'], $cookieFile), true);
$pointsBefore = isset($estadoBefore['puntos']) ? (int)$estadoBefore['puntos'] : 0;

// Extract `quizData` JSON from HTML
if (!preg_match('/const\s+quizData\s*=\s*(\[[\s\S]*?\]);/', $html, $qm)) {
    echo "FAIL: Could not extract quizData from lesson HTML\n";
    file_put_contents(__DIR__ . '/last_e2e_response.html', $html);
    exit(6);
}
$quizDataJson = $qm[1];
$quizData = json_decode($quizDataJson, true);
if (!is_array($quizData) || count($quizData) === 0) {
    echo "FAIL: quizData invalid or empty\n";
    exit(7);
}

// Build POST payload using correct answers
$payload = ['accion' => 'calificar_quiz', 'slug' => 'b1-past-simple-2025'];
foreach ($quizData as $i => $q) {
    $payload["q$i"] = $q['correcta'] ?? '';
}

$calRespRaw = curl_post($base . 'src/funciones.php', $payload, $cookieFile);
$calResp = json_decode($calRespRaw, true);
if (!is_array($calResp) || empty($calResp['ok'])) {
    echo "FAIL: calificar_quiz failed: " . substr($calRespRaw,0,400) . "\n";
    file_put_contents(__DIR__ . '/last_e2e_response.html', $calRespRaw);
    exit(8);
}

$xp = isset($calResp['xp_ganado']) ? (int)$calResp['xp_ganado'] : 0;
$newPointsFromResp = isset($calResp['new_puntos']) ? (int)$calResp['new_puntos'] : null;

// Verify state via obtener_estado
$estadoAfter = json_decode(curl_post($base . 'src/funciones.php', ['accion' => 'obtener_estado'], $cookieFile), true);
$pointsAfter = isset($estadoAfter['puntos']) ? (int)$estadoAfter['puntos'] : 0;

if ($pointsAfter !== $pointsBefore + $xp) {
    echo "FAIL: Points mismatch: before={$pointsBefore}, xp={$xp}, after={$pointsAfter}\n";
    exit(9);
}

if ($newPointsFromResp !== null && $newPointsFromResp !== $pointsAfter) {
    echo "FAIL: calificar_quiz returned new_puntos={$newPointsFromResp} but obtener_estado shows {$pointsAfter}\n";
    exit(10);
}

@unlink($cookieFile);

echo "OK: E2E page load and quiz submission check passed (xp={$xp})\n";
exit(0);

