<?php
require __DIR__ . '/src/Content/content.php';
$count = count($lecciones);
$slugs = array_map(fn($l) => $l['slug'], $lecciones);
echo "OK: $count lessons loaded\n";
echo "Unique slugs: " . count(array_unique($slugs)) . "\n";
echo "First slug: " . $slugs[0] . "\n";
echo "Last slug: " . end($slugs) . "\n";
echo "File: " . __FILE__ . "\n";
