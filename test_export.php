<?php
$lines = file('C:/xampp/htdocs/LC-ADVANCE/public/lab.php');
$script = '';
for ($i = 2977; $i < 5562; $i++) {
    $script .= $lines[$i] . "\n";
}
$script = str_replace(array('<?php', '?>'), '', $script);
file_put_contents('C:/xampp/htdocs/LC-ADVANCE/test_script.js', "var window = {}; var document = { getElementById: () => ({ value: '', innerHTML: '', classList: { add: () => {}, remove: () => {}, toggle: () => {} }, style: {} }) }; var console = { log: () => {}, warn: () => {} }; var localStorage = { getItem: () => null, setItem: () => {} }; var math = { parse: () => ({ compile: () => ({ evaluate: () => 0 }) }), evaluate: () => 0, derivative: () => ({ toString: () => 'x' }) }; var Math = { PI: 3.14159, sqrt: Math.sqrt, cos: Math.cos, sin: Math.sin, pow: Math.pow, abs: Math.abs }; \n" . $script);
echo "Written to test_script.js - " . strlen($script) . " bytes";