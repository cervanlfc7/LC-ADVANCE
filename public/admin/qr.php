<?php
// QR proxy + cache — generates QR image via Google Charts and caches locally.
// This is a pragmatic local cache fallback when a native QR library isn't available.
require_once __DIR__ . '/../../src/Config/config.php';

// Expect 'd' base64-encoded provisioning URI
$data_b64 = $_GET['d'] ?? '';
if (empty($data_b64)) {
    http_response_code(400);
    echo 'Missing data';
    exit;
}
$provision = base64_decode($data_b64);
if ($provision === false) { http_response_code(400); echo 'Invalid data'; exit; }

$hash = 'qr_' . substr(md5($provision), 0, 20);
$cacheDir = __DIR__ . '/../../cache';
if (!is_dir($cacheDir)) mkdir($cacheDir, 0755, true);
$cacheFile = $cacheDir . DIRECTORY_SEPARATOR . $hash . '.png';

// Serve cached if exists
if (file_exists($cacheFile) && filemtime($cacheFile) > time() - 60*60*24*30) {
    header('Content-Type: image/png');
    header('Cache-Control: public, max-age=2592000');
    readfile($cacheFile);
    exit;
}

// Try to fetch from Google Charts as a one-time operation and cache
$googleUrl = 'https://chart.googleapis.com/chart?chs=300x300&chld=M|0&cht=qr&chl=' . urlencode($provision);
$img = false;

// Try curl
if (function_exists('curl_init')) {
    $ch = curl_init($googleUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    $img = curl_exec($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    if ($code !== 200) $img = false;
} elseif (ini_get('allow_url_fopen')) {
    $context = stream_context_create(['http' => ['timeout' => 10]]);
    $img = @file_get_contents($googleUrl, false, $context);
}

if ($img !== false && strlen($img) > 100) {
    // Save
    @file_put_contents($cacheFile, $img);
    header('Content-Type: image/png');
    header('Cache-Control: public, max-age=2592000');
    echo $img;
    exit;
}

// If fetching failed, return a simple SVG fallback with provisioning text (not a QR but useful)
$svg = '<svg xmlns="http://www.w3.org/2000/svg" width="300" height="300"><rect width="100%" height="100%" fill="#0f1423"/>'
    . '<text x="50%" y="50%" font-family="monospace" font-size="12" fill="#00e5ff" dominant-baseline="middle" text-anchor="middle">' . htmlspecialchars($provision) . '</text></svg>';
header('Content-Type: image/svg+xml');
header('Cache-Control: no-cache');
echo $svg;
exit;
?>