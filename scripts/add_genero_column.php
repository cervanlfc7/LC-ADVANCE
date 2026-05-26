<?php
// Script para agregar columna genero a tabla usuarios
require_once __DIR__ . '/../src/Config/config.php';

try {
    $pdo->exec("ALTER TABLE usuarios ADD COLUMN genero ENUM('M', 'W') DEFAULT NULL AFTER github_id");
    echo "✅ Columna 'genero' agregada exitosamente";
} catch (Exception $e) {
    if (strpos($e->getMessage(), 'Duplicate column') !== false) {
        echo "ℹ️ La columna 'genero' ya existe";
    } else {
        echo "❌ Error: " . $e->getMessage();
    }
}
?>