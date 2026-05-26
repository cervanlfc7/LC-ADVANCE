<?php
$content = file_get_contents('C:/xampp/htdocs/LC-ADVANCE/public/lab.php');
$content = preg_replace('/<\?=.*?\?>/', '/* PHP_DATA */', $content);
$scriptStart = strpos($content, '<script>');
$scriptEnd = strrpos($content, '</script>');
$script = substr($content, $scriptStart + 8, $scriptEnd - $scriptStart - 8);
$script = str_replace('<?php', '//', $script);
$script = str_replace('<?', '', $script);
$script = str_replace('?>', '', $script);
$script = str_replace('/* PHP_DATA */', '{}', $script);
$lines = explode("\n", $script);

// Check around line 681
echo "Lines 675-690:\n";
for ($i = 674; $i < 690; $i++) {
    echo ($i+1) . ": " . substr($lines[$i], 0, 80) . "\n";
}