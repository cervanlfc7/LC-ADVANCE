<?php
// Simple test to POST a maestro and ensure updateDB returns success
error_reporting(E_ALL);
ini_set('display_errors', 1);

$url = 'http://localhost/LC-Advance/mapa/updateDB.php';
$payload = [
    'maestro' => 'Miguel',
    'materia' => 'Inglés'
];

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
$resp = curl_exec($ch);
$err = curl_error($ch);
curl_close($ch);

if ($err) {
    echo "FAIL: curl error: $err\n";
    exit(2);
}

$json = json_decode($resp, true);
if (!is_array($json)) {
    echo "FAIL: Response not JSON: $resp\n";
    exit(3);
}
if (isset($json['success']) && $json['success'] === true) {
    echo "OK: updateDB returned success\n";
    exit(0);
}

echo "FAIL: updateDB returned: " . json_encode($json) . "\n";
exit(4);
