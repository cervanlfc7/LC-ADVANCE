<?php
require_once __DIR__ . '/testcase.php';
// This test requires the DB connection from config.php
// It does NOT require login - it tests the logging function directly
require_once __DIR__ . '/../src/Config/config.php';

function testSecurityLogs() {
    global $pdo;
    $tc = new TC();

    // Ensure security_logs table exists
    $tc->t($pdo !== null, 'PDO connection should exist');

    // Clean any previous test entries
    $pdo->prepare("DELETE FROM security_logs WHERE evento_tipo = ?")->execute(['TEST_UNIT']);

    // Log a test event
    logSeguridadEvento('TEST_UNIT', 'unit test - security_logs', 0);

    // Verify it was inserted
    $stmt = $pdo->prepare("SELECT evento_tipo, detalle, usuario_id, ip FROM security_logs WHERE evento_tipo = ? ORDER BY creado_en DESC LIMIT 1");
    $stmt->execute(['TEST_UNIT']);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $tc->t($row !== false, 'Log entry should exist');
    if ($row) {
        $tc->eq('TEST_UNIT', $row['evento_tipo']);
        $tc->eq('unit test - security_logs', $row['detalle']);
        $tc->eq(0, (int)$row['usuario_id']);
    }

    // Clean up
    $pdo->prepare("DELETE FROM security_logs WHERE evento_tipo = ?")->execute(['TEST_UNIT']);

    list($p,$f) = $tc->s();
    echo "SecurityLogs PASSED:$p FAILED:$f\n";
    return $f===0;
}

echo "=== Security Logs Tests ===\n";
$ok = testSecurityLogs();
echo $ok ? "PASS\n" : "FAIL\n";
exit($ok ? 0 : 1);
