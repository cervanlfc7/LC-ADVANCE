<?php
require_once __DIR__ . '/../src/Config/config.php';

try {
    $pdo->exec("ALTER TABLE usuarios ADD COLUMN otp_code VARCHAR(6) DEFAULT NULL");
    $pdo->exec("ALTER TABLE usuarios ADD COLUMN otp_expires TIMESTAMP NULL DEFAULT NULL");
    echo "OK: Columnas OTP agregadas a la tabla usuarios\n";
} catch (PDOException $e) {
    if (strpos($e->getMessage(), 'Duplicate column') !== false) {
        echo "SKIP: Las columnas ya existen\n";
    } else {
        echo "ERROR: " . $e->getMessage() . "\n";
    }
}