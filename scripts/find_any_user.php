<?php
require_once __DIR__ . '/../src/Config/config.php';
$stmt = $pdo->query('SELECT id, usuario_tipo, nombre_usuario FROM usuarios LIMIT 1');
if ($stmt === false) {
    $err = $pdo->errorInfo();
    echo "Query failed: " . ($err[2] ?? json_encode($err)) . "\n";
    exit(1);
}
$u = $stmt->fetch(PDO::FETCH_ASSOC);
if ($u) {
    echo "FOUND:" . $u['id'] . "," . ($u['usuario_tipo'] ?? 'NULL') . "," . ($u['nombre_usuario'] ?? '') . "\n";
} else {
    echo "NO_USERS\n";
}
