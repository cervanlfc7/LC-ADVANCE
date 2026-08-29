<?php
require_once __DIR__ . '/../src/Config/config.php';

$sqlFile = __DIR__ . '/../src/Database/lc_advance.sql';
if (!file_exists($sqlFile)) {
    echo "SQL file not found: {$sqlFile}\n";
    exit(1);
}
$sql = file_get_contents($sqlFile);
if ($sql === false) {
    echo "Failed to read SQL file.\n";
    exit(1);
}
try {
    $pdo->exec($sql);
    echo "Migration applied successfully.\n";
} catch (PDOException $e) {
    echo "Migration failed: " . $e->getMessage() . "\n";
    exit(1);
}
