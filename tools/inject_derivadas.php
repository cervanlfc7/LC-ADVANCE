<?php
$file = 'c:\\xampp\\htdocs\\LC-ADVANCE\\src\\content.php';
$tmpFile = 'c:\\xampp\\htdocs\\LC-ADVANCE\\tmp_derivadas.html';

if (!file_exists($file)) die("File not found: $file\n");
if (!file_exists($tmpFile)) die("Tmp file not found: $tmpFile\n");

$contentRaw = file_get_contents($file);
$newBlock = file_get_contents($tmpFile);

// Markers for the first lesson (derivadas-basicas-pendientes-dominio)
$startMarker = "'titulo' => 'Derivadas Básicas: Pendiente, Cambio Instantáneo y Dominio',";
$endMarker = "/* ===========================\r\n       QUIZ (preguntas de opción múltiple)";

$startIndex = strpos($contentRaw, $startMarker);
if ($startIndex === false) die("Start marker not found.\n");
$startIndex += strlen($startMarker);

$endIndex = strpos($contentRaw, $endMarker, $startIndex);
if ($endIndex === false) {
    $endMarker = "/* ===========================\n       QUIZ (preguntas de opción múltiple)";
    $endIndex = strpos($contentRaw, $endMarker, $startIndex);
}

if ($endIndex === false) die("End marker not found.\n");

$before = substr($contentRaw, 0, $startIndex);
$after = substr($contentRaw, $endIndex);

$finalContent = $before . "\n" . $newBlock . "\n" . $after;

if (file_put_contents($file, $finalContent)) {
    echo "INJECTION SUCCESSFUL via PHP for Derivadas Basicas.\n";
} else {
    echo "INJECTION FAILED via PHP.\n";
}
?>
