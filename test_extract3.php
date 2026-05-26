<?php
$content = file_get_contents('C:/xampp/htdocs/LC-ADVANCE/public/lab.php');
// Replace PHP short tags with placeholder
$content = preg_replace('/<\?=.*?\?>/', '/* PHP_DATA */', $content);
// Find the script block
$scriptStart = strpos($content, '<script>');
$scriptEnd = strrpos($content, '</script>');
$script = substr($content, $scriptStart + 8, $scriptEnd - $scriptStart - 8);
// Remove other PHP tags
$script = str_replace('<?php', '//', $script);
$script = str_replace('<?', '', $script);
$script = str_replace('?>', '', $script);
// Replace the placeholder with a mock
$script = str_replace('/* PHP_DATA */', '{}', $script);
file_put_contents('C:/xampp/htdocs/LC-ADVANCE/test_script.js', $script);

// Check the line numbers
$lines = explode("\n", $script);
echo "Total lines: " . count($lines) . "\n";
// Try to find a syntax error by searching for common issues
foreach ($lines as $i => $line) {
    if (strpos($line, '{') !== false && strpos($line, '}') !== false) {
        $opens = substr_count($line, '{');
        $closes = substr_count($line, '}');
        if ($opens !== $closes && strlen(trim($line)) > 10) {
            echo "Line " . ($i+1) . " brace mismatch: $opens opens, $closes closes\n";
            echo "  " . substr($line, 0, 60) . "\n";
        }
    }
}