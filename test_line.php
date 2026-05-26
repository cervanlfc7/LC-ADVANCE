<?php
$lines = file('C:/xampp/htdocs/LC-ADVANCE/public/lab.php');
$line = $lines[3660-1];
echo "Line 3661 (" . strlen($line) . " chars):\n";
echo $line . "\n";
echo "Hex dump:\n";
echo bin2hex(substr($line, 0, 50));