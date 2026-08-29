<?php
$html = file_get_contents(__DIR__ . '/tmp_panel.html');
if ($html === false) { echo "tmp_panel.html not found\n"; exit(1); }
preg_match_all('/onclick=\"([^\"]*)\"/i', $html, $m);
foreach ($m[1] as $i => $attr) {
    $line = substr_count(substr($html,0,strpos($html,$m[0][$i])), "\n") + 1;
    echo "Line {$line}: {$attr}\n";
}
echo "Found " . count($m[1]) . " onclick attributes\n";
