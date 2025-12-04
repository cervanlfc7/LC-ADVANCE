<?php
// ==========================================
// LC-ADVANCE - ranking.php
// ==========================================
// Autor: LC-TEAM
// Fecha: 2025-10-29
// Descripción: Muestra el Top 10 de usuarios por puntos
// ==========================================

session_start();
require_once 'config/config.php';

// Si no hay sesión activa, redirige al login
if (!isset($_SESSION['usuario_id'])) {
    redirigir('login.php');
}

// Obtener los 10 mejores jugadores
$stmt = $pdo->query("SELECT nombre_usuario, puntos, nivel FROM usuarios ORDER BY puntos DESC LIMIT 10");
$ranking = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Obtener información del jugador actual
$stmt2 = $pdo->prepare("SELECT nombre_usuario, puntos, nivel FROM usuarios WHERE id = ?");
$stmt2->execute([$_SESSION['usuario_id']]);
$usuarioActual = $stmt2->fetch();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leaderboard - LC-ADVANCE</title>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<div class="ranking-container">
    <h1>🏅 Leaderboard LC-ADVANCE</h1>
    <table class="ranking-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Jugador</th>
                <th>Puntos</th>
                <th>Nivel</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($ranking as $i => $jugador): ?>
                <tr class="<?php echo ($jugador['nombre_usuario'] === $usuarioActual['nombre_usuario']) ? 'actual-user' : ''; ?>">
                    <td><?php echo $i + 1; ?></td>
                    <td><?php echo htmlspecialchars($jugador['nombre_usuario']); ?></td>
                    <td><?php echo (int)$jugador['puntos']; ?></td>
                    <td><?php echo (int)$jugador['nivel']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="user-section">
        <p>🎮 Tú: <strong><?php echo htmlspecialchars($usuarioActual['nombre_usuario']); ?></strong></p>
        <p>⭐ Puntos: <?php echo (int)$usuarioActual['puntos']; ?> | 🏆 Nivel: <?php echo (int)$usuarioActual['nivel']; ?></p>
    </div>

    <div class="menu">
        <a href="dashboard.php" class="btn">⬅️ Volver al Panel</a>
        <a href="logout.php" class="btn logout">🚪 Cerrar Sesión</a>
    </div>
</div>

</body>
</html>
