<?php
/**
 * Script para crear usuarios de prueba con puntos para demostrar el ranking
 * Uso: php scripts/seed_test_users.php
 */

require_once __DIR__ . '/../src/Config/config.php';

// Usuarios de prueba con sus puntos
$test_users = [
    ['nombre_usuario' => 'Admin', 'correo' => 'admin@test.com', 'contrasena' => 'Test1234', 'puntos' => 5000, 'tipo' => 'admin'],
    ['nombre_usuario' => 'Campeón', 'correo' => 'campeon@test.com', 'contrasena' => 'Test1234', 'puntos' => 4200, 'tipo' => 'teacher'],
    ['nombre_usuario' => 'Estudiante1', 'correo' => 'est1@test.com', 'contrasena' => 'Test1234', 'puntos' => 3500, 'tipo' => 'student'],
    ['nombre_usuario' => 'Estudiante2', 'correo' => 'est2@test.com', 'contrasena' => 'Test1234', 'puntos' => 3000, 'tipo' => 'student'],
    ['nombre_usuario' => 'Aprendiz', 'correo' => 'aprendiz@test.com', 'contrasena' => 'Test1234', 'puntos' => 2100, 'tipo' => 'student'],
    ['nombre_usuario' => 'Novato', 'correo' => 'novato@test.com', 'contrasena' => 'Test1234', 'puntos' => 1500, 'tipo' => 'student'],
    ['nombre_usuario' => 'Principiante', 'correo' => 'principiante@test.com', 'contrasena' => 'Test1234', 'puntos' => 800, 'tipo' => 'student'],
    ['nombre_usuario' => 'Recién_llegado', 'correo' => 'nuevo@test.com', 'contrasena' => 'Test1234', 'puntos' => 300, 'tipo' => 'student'],
    ['nombre_usuario' => 'Explorador', 'correo' => 'explorador@test.com', 'contrasena' => 'Test1234', 'puntos' => 1200, 'tipo' => 'student'],
    ['nombre_usuario' => 'Investigador', 'correo' => 'investigador@test.com', 'contrasena' => 'Test1234', 'puntos' => 2800, 'tipo' => 'student'],
];

echo "🌱 Creando usuarios de prueba...\n\n";

$created = 0;
$skipped = 0;

foreach ($test_users as $user) {
    // Verificar si ya existe
    $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE nombre_usuario = ? OR correo = ?");
    $stmt->execute([$user['nombre_usuario'], $user['correo']]);
    
    if ($stmt->fetch()) {
        echo "⏭️  Usuario '{$user['nombre_usuario']}' ya existe, saltando...\n";
        $skipped++;
        continue;
    }
    
    // Crear usuario
    try {
        $hash = password_hash($user['contrasena'], PASSWORD_BCRYPT);
        $nivel = max(1, (int)($user['puntos'] / 500));
        
        $stmt = $pdo->prepare("
            INSERT INTO usuarios (nombre_usuario, correo, contrasena_hash, puntos, nivel, tipo)
            VALUES (?, ?, ?, ?, ?, ?)
        ");
        
        $stmt->execute([
            $user['nombre_usuario'],
            $user['correo'],
            $hash,
            $user['puntos'],
            $nivel,
            $user['tipo'] ?? 'student'
        ]);
        
        echo "✅ Usuario '{$user['nombre_usuario']}' creado con {$user['puntos']} puntos (Nivel {$nivel})\n";
        $created++;
        
    } catch (Exception $e) {
        echo "❌ Error al crear '{$user['nombre_usuario']}': {$e->getMessage()}\n";
    }
}

echo "\n" . str_repeat("=", 50) . "\n";
echo "📊 Resumen:\n";
echo "✅ Creados: {$created}\n";
echo "⏭️  Saltados: {$skipped}\n";
echo "📈 Total en BD: " . getCountUsers() . "\n";
echo str_repeat("=", 50) . "\n";

// Mostrar top 10
echo "\n🏆 TOP 10 ACTUAL:\n";
$stmt = $pdo->query("SELECT nombre_usuario, puntos, nivel FROM usuarios ORDER BY puntos DESC LIMIT 10");
$ranking = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($ranking as $idx => $user) {
    $pos = $idx + 1;
    $medal = match($pos) {
        1 => '🥇',
        2 => '🥈',
        3 => '🥉',
        default => "  "
    };
    printf("%s %2d. %-20s %5d pts (Nivel %d)\n", 
        $medal, $pos, $user['nombre_usuario'], $user['puntos'], $user['nivel']);
}

function getCountUsers() {
    global $pdo;
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM usuarios");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['count'] ?? 0;
}

echo "\n✨ ¡Usuarios de prueba creados exitosamente!\n";
echo "Ahora puedes hacer login con cualquiera de estos usuarios.\n";
echo "Contraseña para todos: Test1234\n";
?>
