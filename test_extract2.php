<?php
$content = file_get_contents('C:/xampp/htdocs/LC-ADVANCE/public/lab.php');
// Find the script block directly
$scriptStart = strpos($content, '<script>');
$scriptEnd = strrpos($content, '</script>');
$script = substr($content, $scriptStart + 8, $scriptEnd - $scriptStart - 8);
// Remove PHP tags
$script = str_replace('<?', '', $script);
$script = str_replace('?>', '', $script);
$script = str_replace('<?=', '//', $script);
file_put_contents('C:/xampp/htdocs/LC-ADVANCE/test_script.js', $script);
echo "Written - " . strlen($script) . " bytes";