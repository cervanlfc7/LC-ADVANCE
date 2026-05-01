<?php
// Script para agregar índices de rendimiento a base de datos existente
// Uso: php scripts/add_performance_indexes.php

require_once __DIR__ . '/../config/config.php';

echo "Agregando índices de rendimiento...\n";

$indexes = [
    "ALTER TABLE user_progress ADD INDEX IF NOT EXISTS idx_user_progress_user_id (user_id)",
    "ALTER TABLE user_progress ADD INDEX IF NOT EXISTS idx_user_progress_slug (slug)",
    "ALTER TABLE usuarios ADD INDEX IF NOT EXISTS idx_usuarios_puntos (puntos DESC)",
    "ALTER TABLE usuarios ADD INDEX IF NOT EXISTS idx_usuarios_nivel (nivel)"
];

foreach ($indexes as $sql) {
    try {
        $pdo->exec($sql);
        echo "✓ $sql\n";
    } catch (PDOException $e) {
        echo "✗ " . $e->getMessage() . "\n";
    }
}

echo "¡完成! Índices agregados.\n";