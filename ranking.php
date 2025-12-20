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

// Si no hay sesión activa ni modo invitado, redirige al login
if (!isset($_SESSION['usuario_id']) && empty($_SESSION['usuario_es_invitado'])) {
    redirigir('login.php');
}

// Obtener los 10 mejores jugadores
$stmt = $pdo->query("SELECT nombre_usuario, puntos, nivel FROM usuarios ORDER BY puntos DESC LIMIT 10");
$ranking = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Obtener información del jugador actual (soporta invitado)
if (!empty($_SESSION['usuario_es_invitado'])) {
    $usuarioActual = [
        'nombre_usuario' => $_SESSION['usuario_nombre'] ?? 'Invitado',
        'puntos' => $_SESSION['usuario_puntos'] ?? 0,
        'nivel' => $_SESSION['usuario_nivel'] ?? 0
    ];
} else {
    $stmt2 = $pdo->prepare("SELECT nombre_usuario, puntos, nivel FROM usuarios WHERE id = ?");
    $stmt2->execute([$_SESSION['usuario_id']]);
    $usuarioActual = $stmt2->fetch();
    if (!$usuarioActual || !is_array($usuarioActual)) {
        $usuarioActual = ['nombre_usuario' => '—', 'puntos' => 0, 'nivel' => 0];
    }
}
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

    <?php
        $return_link = 'dashboard.php';
        // Preserve the current filter when returning from the ranking page
        $params = [];
        if (!empty($_GET['materia'])) {
            $params['materia'] = $_GET['materia'];
        } elseif (!empty($_GET['profesor'])) {
            $params['profesor'] = $_GET['profesor'];
        }
        if (!empty($params)) {
            $return_link .= '?' . http_build_query($params);
        }
    ?>
    <div class="menu">
        <button id="back-btn" class="btn" type="button" data-fallback="<?php echo htmlspecialchars($return_link, ENT_QUOTES, 'UTF-8'); ?>">⬅️ Volver al Panel</button>
        <a href="logout.php" class="btn logout">🚪 Cerrar Sesión</a>
    </div>
    <script>
    (function(){
      const btn = document.getElementById('back-btn');
      if (!btn) return;
      btn.addEventListener('click', function(e){
        e.preventDefault();
        try {
          const ref = document.referrer || '';
          if (ref) {
            try {
              const u = new URL(ref, location.href);
              const isSameOrigin = u.origin === location.origin;
              const isDashboard = u.pathname.endsWith('/dashboard.php') || u.href.indexOf('/dashboard.php') !== -1;
              if (isSameOrigin && isDashboard && window.history.length > 1) { history.back(); return; }
            } catch(err){}
          }
        } catch(e){}
        window.location.href = btn.dataset.fallback || '<?php echo addslashes($return_link); ?>';
      }, { passive: true });
    })();
    </script>
</div>

</body>
</html>
