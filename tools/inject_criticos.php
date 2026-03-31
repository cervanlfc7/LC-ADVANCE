<?php
$file = 'c:\\xampp\\htdocs\\LC-ADVANCE\\src\\content.php';
$tmpFile = 'c:\\xampp\\htdocs\\LC-ADVANCE\\tmp_criticos.html';

if (!file_exists($file)) die("File not found: $file\n");
if (!file_exists($tmpFile)) die("Tmp file not found: $tmpFile\n");

$contentRaw = file_get_contents($file);
$newBlock = file_get_contents($tmpFile);

// Markers used in the corrupted file
$startMarker = "'titulo' => 'Puntos Críticos: Máximos y Mínimos Locales – Prueba de la Primera Derivada',";
$endMarker = "/* =====================================\r\n       QUIZ AMPLIADO (FORMAL)";

$startIndex = strpos($contentRaw, $startMarker);
if ($startIndex === false) {
    // Try with different indentation or slightly different title
    $startMarker = "'titulo'  => 'Puntos Críticos: Máximos y Mínimos Locales – Prueba de la Primera Derivada',";
    $startIndex = strpos($contentRaw, $startMarker);
}

if ($startIndex === false) die("Start marker not found.\n");
$startIndex += strlen($startMarker);

$endIndex = strpos($contentRaw, $endMarker, $startIndex);
if ($endIndex === false) {
    // Try without \r\n
    $endMarker = "/* =====================================\n       QUIZ AMPLIADO (FORMAL)";
    $endIndex = strpos($contentRaw, $endMarker, $startIndex);
}

if ($endIndex === false) die("End marker not found.\n");

$before = substr($contentRaw, 0, $startIndex);
$after = substr($contentRaw, $endIndex);

// The new block already contains 'contenido' => <<<'HTML' at the top
$finalContent = $before . "\n" . $newBlock . "\n" . $after;

if (file_put_contents($file, $finalContent)) {
    echo "INJECTION SUCCESSFUL via PHP.\n";
} else {
    echo "INJECTION FAILED via PHP.\n";
}
?>
