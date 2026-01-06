<?php
// Creates a deterministic test user for CI or local testing if not present
$host = getenv('DB_HOST') ?: '127.0.0.1';
$db = getenv('DB_NAME') ?: 'lc_advance';
$user = getenv('DB_USER') ?: 'root';
$pass = getenv('DB_PASS') ?: '';

$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";
try {
    $pdo = new PDO($dsn, $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
} catch (Exception $e) {
    fwrite(STDERR, "Could not connect to DB: " . $e->getMessage() . "\n");
    exit(2);
}

$username = 'ci_test_user';
$email = 'ci_test@example.com';
$password = 'Test1234';

$stmt = $pdo->prepare('SELECT id FROM usuarios WHERE nombre_usuario = ? OR correo = ?');
$stmt->execute([$username, $email]);
if ($stmt->fetch()) {
    echo "User already exists, skipping seeding\n";
    exit(0);
}

$hash = password_hash($password, PASSWORD_DEFAULT);
$stmt = $pdo->prepare('INSERT INTO usuarios (nombre_usuario, correo, contrasena_hash, puntos, nivel) VALUES (?, ?, ?, 0, 1)');
$stmt->execute([$username, $email, $hash]);

echo "Seeded CI test user: {$username}\n";
exit(0);
