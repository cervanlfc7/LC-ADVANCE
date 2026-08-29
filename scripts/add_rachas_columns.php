<?php
// ================================================
// LC-ADVANCE — Migración de rachas
// Agrega columnas ultimo_login y racha_actual a
// la tabla usuarios para BD existentes.
// ================================================

require_once __DIR__ . '/../src/Config/config.php';

echo "Migrando rachas...\n";

// Verificar si las columnas ya existen
$stmt = $pdo->query("SHOW COLUMNS FROM usuarios LIKE 'ultimo_login'");
if ($stmt->fetch()) {
    echo "✓ Las columnas ya existen.\n";
} else {
    $pdo->exec("ALTER TABLE usuarios ADD COLUMN ultimo_login DATE DEFAULT NULL AFTER tipo");
    $pdo->exec("ALTER TABLE usuarios ADD COLUMN racha_actual INT NOT NULL DEFAULT 0 AFTER ultimo_login");
    echo "✓ Columnas agregadas correctamente.\n";
}

echo "Listo.\n";
