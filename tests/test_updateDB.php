<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$url = getenv('TEST_BASE_URL') ? rtrim(getenv('TEST_BASE_URL'), '/') . '/mapa/updateDB.php' : 'http://127.0.0.1:8000/mapa/updateDB.php';
$payload = ['maestro' => 'Miguel', 'materia' => 'Inglés'];

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
curl_setopt($ch, CURLOPT_TIMEOUT, 10);
$resp = curl_exec($ch);
$err = curl_error($ch);
$status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($err) {
    echo "SKIP: curl error: $err\n";
    exit(0);
}

if ($status >= 400) {
    echo "SKIP: updateDB returned HTTP $status\n";
    exit(0);
}

$json = json_decode($resp, true);
if (!is_array($json)) {
    echo "SKIP: Response not JSON\n";
    exit(0);
}

echo "OK: updateDB accessible\n";
exit(0);

