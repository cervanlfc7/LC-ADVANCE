<?php
session_start();
require_once 'config/config.php';

if (!isset($_SESSION['usuario_id'])) {
    die('No autorizado');
}

$user_id = $_SESSION['usuario_id'];
$slug = $_POST['slug'] ?? '';
$correctas = (int)($_POST['correctas'] ?? 0);
$xp = (int)($_POST['xp'] ?? 0);

if (empty($slug) || $correctas < 0) {
    die('Datos inválidos');
}

try {
    // Iniciar transacción
    $pdo->beginTransaction();

    // Verificar si ya existe progreso para esta lección
    $stmt = $pdo->prepare("SELECT * FROM user_progress WHERE user_id = ? AND slug = ?");
    $stmt->execute([$user_id, $slug]);
    $progress = $stmt->fetch();

    if ($progress) {
        // Siempre actualizar el progreso y sumar XP
        $pdo->prepare("UPDATE user_progress SET score = ?, lesson_xp = ?, completed = 1 WHERE user_id = ? AND slug = ?")
            ->execute([$correctas, $xp, $user_id, $slug]);
        
        $pdo->prepare("UPDATE usuarios SET puntos = puntos + ? WHERE id = ?")
            ->execute([$xp, $user_id]);
    } else {
        // Primera vez
        $pdo->prepare("INSERT INTO user_progress (user_id, slug, score, lesson_xp, completed) VALUES (?, ?, ?, ?, 1)")
            ->execute([$user_id, $slug, $correctas, $xp]);
        
        $pdo->prepare("UPDATE usuarios SET puntos = puntos + ? WHERE id = ?")
            ->execute([$xp, $user_id]);
    }

    // Confirmar transacción
    $pdo->commit();
    echo 'OK';
} catch (Exception $e) {
    $pdo->rollBack();
    error_log("Error en update_progress.php: " . $e->getMessage());
    echo "Error al actualizar progreso";
}