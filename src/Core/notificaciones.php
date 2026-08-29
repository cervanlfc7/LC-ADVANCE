<?php
/**
 * LC-ADVANCE Notification System
 */

function verificarSubidaNivel(int $usuario_id, int $puntos_antes, int $puntos_despues): void {
    $nivel_antes = (int)($puntos_antes / 500) + 1;
    $nivel_despues = (int)($puntos_despues / 500) + 1;
    if ($nivel_despues > $nivel_antes) {
        crearNotificacion(
            $usuario_id,
            'level_up',
            "¡Subiste al Nivel {$nivel_despues}!",
            "Sigue así, has ganado {$puntos_despues} puntos en total."
        );
    }
}

function crearNotificacion(int $usuario_id, string $tipo, string $titulo, string $mensaje = ''): void {
    global $pdo;
    try {
        $pdo->prepare(
            "INSERT INTO notificaciones (usuario_id, tipo, titulo, mensaje) VALUES (?, ?, ?, ?)"
        )->execute([$usuario_id, $tipo, $titulo, $mensaje]);
    } catch (Exception $e) {
        error_log("Error creating notification: " . $e->getMessage());
    }
}

function obtenerNotificaciones(int $usuario_id, int $limite = 20): array {
    global $pdo;
    $stmt = $pdo->prepare(
        "SELECT id, tipo, titulo, mensaje, leida, created_at
         FROM notificaciones WHERE usuario_id = ?
         ORDER BY created_at DESC LIMIT ?"
    );
    $stmt->execute([$usuario_id, $limite]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function contarNotificacionesNoLeidas(int $usuario_id): int {
    global $pdo;
    $stmt = $pdo->prepare(
        "SELECT COUNT(*) FROM notificaciones WHERE usuario_id = ? AND leida = 0"
    );
    $stmt->execute([$usuario_id]);
    return (int)$stmt->fetchColumn();
}

function marcarNotificacionLeida(int $notificacion_id, int $usuario_id): void {
    global $pdo;
    $pdo->prepare(
        "UPDATE notificaciones SET leida = 1 WHERE id = ? AND usuario_id = ?"
    )->execute([$notificacion_id, $usuario_id]);
}

function marcarTodasLeidas(int $usuario_id): void {
    global $pdo;
    $pdo->prepare(
        "UPDATE notificaciones SET leida = 1 WHERE usuario_id = ? AND leida = 0"
    )->execute([$usuario_id]);
}
