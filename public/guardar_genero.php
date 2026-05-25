<?php
// ==========================================
// LC-ADVANCE - guardar_genero.php
// Guarda el género seleccionado por el usuario
// ==========================================

require_once __DIR__ . '/../src/Config/config.php';
iniciarSesionSegura();

header('Content-Type: application/json');

$response = ['success' => false];

try {
    $genero = $_POST['genero'] ?? '';
    $es_invitado = isset($_POST['invitado']) && $_POST['invitado'] === '1';
    
    if (!in_array($genero, ['M', 'W'])) {
        $response['error'] = 'Género inválido';
        echo json_encode($response);
        exit;
    }
    
    $usuario_id = $_SESSION['usuario_id'] ?? 0;
    
    if ($es_invitado || $usuario_id <= 0) {
        $_SESSION['genero'] = $genero;
        $_SESSION['genero_temp'] = $genero;
        $response['success'] = true;
        $response['mode'] = 'invitado';
    } else {
        $stmt = $pdo->prepare("UPDATE usuarios SET genero = ? WHERE id = ?");
        $stmt->execute([$genero, $usuario_id]);
        $_SESSION['genero'] = $genero;
        $response['success'] = true;
        $response['mode'] = 'usuario';
    }
    
} catch (Exception $e) {
    $response['error'] = $e->getMessage();
}

echo json_encode($response);