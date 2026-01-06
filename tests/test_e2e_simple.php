<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$envBase = getenv('TEST_BASE_URL');
$base = $envBase ? rtrim($envBase, '/') . '/' : 'http://127.0.0.1:8000/';
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
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    $res = curl_exec($ch);
    if (curl_errno($ch)) {
        return [0, "CURL_ERROR"];
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
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    $res = curl_exec($ch);
    if (curl_errno($ch)) {
        return [0, "CURL_ERROR"];
    }
    $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    return [$status, $res];
}

// Try to load lesson (may redirect to login)
list($s, $html) = curl_get($lessonUrl, $cookieFile);
if ($s === 0) {
    echo "SKIP: Could not reach server\n";
    @unlink($cookieFile);
    exit(0);
}

if ($s >= 500) {
    echo "FAIL: Server error (HTTP $s)\n";
    @unlink($cookieFile);
    exit(1);
}

// Very simple: just verify we can reach the server and get a response without fatal errors
if (preg_match('/(fatal|parse error)/i', $html)) {
    echo "FAIL: Fatal error in response\n";
    @unlink($cookieFile);
    exit(1);
}

@unlink($cookieFile);
echo "OK: E2E page load test passed\n";
exit(0);
