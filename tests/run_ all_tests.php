<?php
// LC-ADVANCE - Test runner (all test suites)
$tests = [
    __DIR__ . '/test_lessons.php',
    __DIR__ . '/test_integration.php',
    __DIR__ . '/test_updateDB.php',
    __DIR__ . '/test_e2e_simple.php',
    __DIR__ . '/test_ unit_ config.php',  // unit tests
];
$php = defined('PHP_BINARY') ? PHP_BINARY : 'php';
$allOk = true;
foreach ($tests as $test) {
    if (!file_exists($test)) {
        echo "SKIP: $test\n"; continue;
    }
    echo "Running: $test\n";
    $cmd = escapeshellarg($php) . ' ' . escapeshellarg($test);
    system($cmd, $ret);
    if ($ret !== 0) {
        echo "FAIL: $test exited $ret\n"; $allOk = false;
    } else { echo "PASS: $test\n"; }
    echo "---\n";
}
echo $allOk ? "ALL TESTS PASSED\n" : "SOME TESTS FAILED\n";
exit($allOk ? 0 : 1);