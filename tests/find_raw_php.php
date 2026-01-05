<?php
require_once __DIR__ . '/../src/content.php';
foreach ($lecciones as $idx => $l) {
    if (strpos($l['contenido'], '<?php') !== false) {
        echo "Found in slug: " . ($l['slug'] ?? "(no-slug)") . "\n";
    }
}
