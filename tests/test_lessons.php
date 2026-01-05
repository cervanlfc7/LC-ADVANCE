<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$base = getenv('TEST_BASE_URL') ?: 'http://localhost/LC-Advance/';
$cookieFile = __DIR__ . '/lessons_cookies.txt';
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

// Start a guest session so requireLogin(true) allows access
list($s,$r) = curl_get($base . 'guest_login.php', $cookieFile);
if ($s >= 400) {
    echo "FAIL: Could not start guest session (HTTP $s)\n";
    exit(2);
}

$slugs = [
    'b1-past-simple-2025',
    'a2-food-restaurant-shopping-cyberpunk',
    'derivadas-basicas-pendientes-dominio'
];

foreach ($slugs as $slug) {
    $url = $base . 'leccion_detalle.php?slug=' . urlencode($slug) . "&materia=Test";
    list($status, $html) = curl_get($url, $cookieFile);
    if ($status !== 200) {
        echo "FAIL: $slug returned HTTP $status\n";
        file_put_contents(__DIR__ . "/last_lesson_{$slug}.html", $html);
        exit(3);
    }

    // Check for common parse/fatal strings that would indicate server error
    $lower = strtolower($html);
    if (strpos($lower, 'parse error') !== false || strpos($lower, 'fatal error') !== false) {
        echo "FAIL: $slug page contains server errors\n";
        file_put_contents(__DIR__ . "/last_lesson_{$slug}.html", $html);
        exit(4);
    }

    // Ensure content contains expected container and does not include raw '<?php'
    if (strpos($html, '<div class="lesson-content"') === false) {
        echo "FAIL: $slug missing expected lesson content container\n";
        file_put_contents(__DIR__ . "/last_lesson_{$slug}.html", $html);
        exit(5);
    }
    if (strpos($html, '<?php') !== false) {
        echo "FAIL: $slug contains raw '<?php'\n";
        file_put_contents(__DIR__ . "/last_lesson_{$slug}.html", $html);
        exit(6);
    }
}

@unlink($cookieFile);
echo "OK: targeted lesson checks passed\n";
exit(0);
