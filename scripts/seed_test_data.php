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

$test_users = [
    ['ci_test_user', 'ci_test@example.com', 'Test1234', 'student', 0],
    ['admin', 'admin@lc-advance.test', 'Admin1234', 'admin', 99999],
    ['profesor', 'teacher@lc-advance.test', 'Teacher1234', 'teacher', 500],
];

$seeded = 0;
foreach ($test_users as [$username, $email, $password, $tipo, $puntos]) {
    $stmt = $pdo->prepare('SELECT id FROM usuarios WHERE nombre_usuario = ? OR correo = ?');
    $stmt->execute([$username, $email]);
    if ($stmt->fetch()) continue;

    $hash = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare('INSERT INTO usuarios (nombre_usuario, correo, contrasena_hash, puntos, nivel, tipo) VALUES (?, ?, ?, ?, ?, ?)');
    $nivel = floor($puntos / 500) + 1;
    $stmt->execute([$username, $email, $hash, $puntos, $nivel, $tipo]);
    echo "Seeded user: {$username} ({$tipo})\n";
    $seeded++;
}

if ($seeded === 0) echo "All users already exist, skipping seeding\n";
exit(0);
