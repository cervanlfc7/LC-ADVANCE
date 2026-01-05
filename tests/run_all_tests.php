<?php
// Simple test runner that executes each test script in a separate PHP process
$tests = [
    __DIR__ . '/test_include_content.php',
    __DIR__ . '/find_raw_php.php',
    __DIR__ . '/test_content_parsing.php',
    __DIR__ . '/test_lessons.php',
    __DIR__ . '/test_integration.php',
    __DIR__ . '/test_updateDB.php',
    __DIR__ . '/test_e2e.php',
];

$php = defined('PHP_BINARY') ? PHP_BINARY : 'php';
$allOk = true;
foreach ($tests as $test) {
    if (!file_exists($test)) {
        echo "SKIP: Test file not found: $test\n";
        continue;
    }
    echo "Running: $test\n";
    $cmd = escapeshellarg($php) . ' ' . escapeshellarg($test);
    system($cmd, $ret);
    if ($ret !== 0) {
        echo "FAIL: $test exited with status $ret\n";
        $allOk = false;
    } else {
        echo "PASS: $test\n";
    }
    echo "---\n";
}

if ($allOk) {
    echo "ALL TESTS PASSED\n";
    exit(0);
}

echo "SOME TESTS FAILED\n";
exit(1);
