<?php
require_once __DIR__ . '/../src/Config/config.php';
try {
    $stmt = $pdo->query('DESCRIBE usuarios');
    if ($stmt === false) { $err = $pdo->errorInfo(); echo "DESCRIBE failed: " . ($err[2] ?? json_encode($err)) . "\n"; exit(1); }
    $cols = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($cols as $c) { echo $c['Field'] . ' ' . $c['Type'] . "\n"; }
    echo "Done.\n";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n"; exit(1);
}
