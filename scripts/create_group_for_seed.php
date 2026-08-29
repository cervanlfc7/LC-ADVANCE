<?php
require_once __DIR__ . '/../src/Config/config.php';
try {
    $u = $pdo->query('SELECT id, nombre_usuario FROM usuarios LIMIT 1')->fetch(PDO::FETCH_ASSOC);
    if (!$u) { echo "No hay usuarios en la base de datos. Crea un usuario antes.\n"; exit(1); }
    $profesor_id = (int)$u['id'];
    $codigo = strtoupper(substr(bin2hex(random_bytes(3)),0,6));
    $nombre = 'Seed Group ' . date('Ymd_His');
    $ins = $pdo->prepare('INSERT INTO grupos (nombre, profesor_id, codigo_acceso, created_at) VALUES (?, ?, ?, NOW())');
    $ins->execute([$nombre, $profesor_id, $codigo]);
    $gid = $pdo->lastInsertId();
    echo "Grupo creado: id={$gid} nombre='{$nombre}' profesor_id={$profesor_id} codigo={$codigo}\n";
    // add first non-teacher user as student if available
    $student = $pdo->query("SELECT id FROM usuarios WHERE tipo IS NULL OR tipo != 'teacher' LIMIT 1")->fetch(PDO::FETCH_ASSOC);
    if ($student) {
        $pdo->prepare('INSERT IGNORE INTO grupo_usuarios (grupo_id, usuario_id) VALUES (?, ?)')->execute([$gid, $student['id']]);
        echo "Usuario {$student['id']} agregado al grupo como estudiante.\n";
    }
} catch (Exception $e) { echo "Error: " . $e->getMessage() . "\n"; exit(1); }
