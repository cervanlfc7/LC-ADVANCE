<?php
require_once __DIR__ . '/../config/config.php';

function testNivel(){ 
$v0 = calcularNivel(0);
echo "v0=$v0 type=" . gettype($v0) . "\n";
$v499 = calcularNivel(499);
echo "v499=$v499\n";
echo ($v0 === 1) ? "PASS strict\n" : "FAIL strict\n";
echo ($v0 == 1) ? "PASS loose\n" : "FAIL loose\n";
}

testNivel();