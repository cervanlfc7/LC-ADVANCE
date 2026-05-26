<?php
$lines = file('C:/xampp/htdocs/LC-ADVANCE/public/lab.php');
$script = '';
// Start from line 2978 (index 2977) which is the actual <script> line
for ($i = 2977; $i < 5562; $i++) {
    $script .= $lines[$i] . "\n";
}
// Remove PHP tags and script tags
$script = preg_replace('/<\?php.*?\?>/', '', $script);
$script = preg_replace('/<script>/', '', $script);
$script = preg_replace('/<\/script>/', '', $script);
file_put_contents('C:/xampp/htdocs/LC-ADVANCE/test_script.js', $script);
echo "Written - " . strlen($script) . " bytes";