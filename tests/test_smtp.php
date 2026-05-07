<?php
require_once __DIR__ . '/../src/Config/config.php';

echo "=== Test SMTP ===\n";
echo "SMTP_HOST: " . SMTP_HOST . "\n";
echo "SMTP_PORT: " . SMTP_PORT . "\n";
echo "SMTP_USERNAME: " . SMTP_USERNAME . "\n";
echo "SMTP_PASSWORD: " . (SMTP_PASSWORD ? '***' : 'EMPTY') . "\n";
echo "SMTP_FROM_EMAIL: " . SMTP_FROM_EMAIL . "\n";
echo "\n";

$result = enviarEmail('luisfcc08@gmail.com', 'Test LC-Advance', '<h1>Test</h1><p>Este es un test.</p>');
echo "Resultado: " . ($result ? 'OK' : 'FALLÓ') . "\n";