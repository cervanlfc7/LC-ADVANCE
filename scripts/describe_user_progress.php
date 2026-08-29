<?php
require_once __DIR__ . '/../src/Config/config.php';
try {
    $stmt = $pdo->query('DESCRIBE user_progress');
    if ($stmt === false) { $err = $pdo->errorInfo(); echo "DESCRIBE failed: " . ($err[2] ?? json_encode($err)) . "\n"; exit(1); }
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($rows as $r) { echo $r['Field'] . ' ' . $r['Type'] . "\n"; }
    echo "Done.\n";
} catch (Exception $e) { echo "Error: " . $e->getMessage() . "\n"; exit(1); }
