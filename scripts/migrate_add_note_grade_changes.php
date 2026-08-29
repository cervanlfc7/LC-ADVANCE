<?php
require_once __DIR__ . '/../src/Config/config.php';
try {
    $sql = "ALTER TABLE grade_changes ADD COLUMN IF NOT EXISTS note VARCHAR(255) NULL AFTER changed_by";
    $pdo->exec($sql);
    echo "Columna 'note' añadida (si no existía).\n";
} catch (PDOException $e) {
    echo "Error al alterar tabla: " . $e->getMessage() . "\n";
    exit(1);
}
