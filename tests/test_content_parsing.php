<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once __DIR__ . '/../src/content.php';

$expected_slugs = ['b1-past-simple-2025','derivadas-basicas-pendientes-dominio','a2-food-restaurant-shopping-cyberpunk'];
$found = [];
foreach ($lecciones as $l) {
    $found[] = $l['slug'] ?? null;
}
$missing = array_diff($expected_slugs, $found);
if (!empty($missing)) {
    echo "FAIL: missing slugs: " . implode(', ', $missing) . "\n";
    exit(2);
}

// Check that specific lesson contains expected marker
$target = null;
foreach ($lecciones as $l) if (($l['slug'] ?? '') === 'b1-past-simple-2025') $target = $l;
if (!$target) { echo "FAIL: target lesson not found\n"; exit(3); }
if (strpos($target['titulo'], 'PAST SIMPLE') === false) { echo "FAIL: target title wrong\n"; exit(4); }
if (strpos($target['contenido'], 'PAST SIMPLE DOMINATION 2025') === false) { echo "FAIL: content seems truncated or malformed\n"; exit(5); }

// Basic sanity: no raw '<?php' inside content blocks
foreach ($lecciones as $l) {
    if (strpos($l['contenido'], "<?php") !== false) {
        echo "FAIL: found raw '<?php' inside lesson content (should be escaped)\n";
        exit(6);
    }
}

echo "OK: content parsing smoke tests passed\n";
exit(0);
