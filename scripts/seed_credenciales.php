<?php
// ==========================================
// LC-ADVANCE - seed_credenciales.php
// Inserta las credenciales por defecto en la
// tabla `credenciales` para entornos de desarrollo.
// ==========================================

require_once __DIR__ . '/../src/Config/config.php';

try {
    $pdo->exec("CREATE TABLE IF NOT EXISTS `credenciales` (
        `clave` VARCHAR(100) PRIMARY KEY,
        `valor` TEXT NOT NULL,
        `descripcion` VARCHAR(255) DEFAULT NULL,
        `actualizado_en` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci");

    $credenciales = [
        ['google_client_id', '317866808413-8odsje97n8j7k150j3ag1lr89ughotb7.apps.googleusercontent.com', 'Google OAuth Client ID'],
        ['google_client_secret', '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', 'Google OAuth Client Secret'],
        ['github_client_id_dev', 'Ov23liR2ex0RxXcrUfAz', 'GitHub OAuth Client ID (dev)'],
        ['github_client_secret_dev', 'dc8524f64a5a4dff43d8aa1d6e9e7f01d57e968d', 'GitHub OAuth Client Secret (dev)'],
        ['github_client_id_prod', 'Ov23ligyvD096zr7u85V', 'GitHub OAuth Client ID (prod)'],
        ['github_client_secret_prod', '0c1a890c637e28fbf27579982b5b79c6a524d69e', 'GitHub OAuth Client Secret (prod)'],
        ['smtp_username', 'lcadvance40@gmail.com', 'SMTP Username'],
        ['smtp_password', 'jbgt frey azdf fsjo', 'SMTP Password'],
        ['smtp_from_email', 'lcadvance40@gmail.com', 'SMTP From Email'],
        ['openrouter_api_key', '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', 'OpenRouter API Key'],
    ];

    $stmt = $pdo->prepare("INSERT INTO `credenciales` (clave, valor, descripcion) VALUES (?, ?, ?)
        ON DUPLICATE KEY UPDATE valor = VALUES(valor), descripcion = VALUES(descripcion)");

    foreach ($credenciales as $c) {
        $stmt->execute($c);
        echo "OK: {$c[0]}\n";
    }

    echo "\n✅ Credenciales insertadas/actualizadas correctamente.\n";
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    exit(1);
}
