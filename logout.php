<?php
// ==========================================
// LC-ADVANCE - logout.php
// ==========================================
// Autor: LC-TEAM
// Fecha: 2025-10-29
// Descripción: Cierra la sesión del usuario
// ==========================================

require_once 'config/config.php';
// Usamos la función central para cerrar sesión de forma segura
// Cerrar sesión
cerrarSesionSegura();

// Usar script intermedio para limpiar datos locales antes de volver a login
echo '<!DOCTYPE html><html><head><title>Saliendo...</title></head><body style="background:#000;color:#fff;font-family:sans-serif;display:flex;justify-content:center;align-items:center;height:100vh;">';
echo '<div><p>Cerrando sesión y limpiando mapa...</p>';
echo '<script>
    // Limpiar TODA posible clave de guardado del mapa
    for (let i = 0; i < localStorage.length; i++) {
        const key = localStorage.key(i);
        if (key && key.startsWith("map.player_pos")) {
            localStorage.removeItem(key);
            i--; // Ajustar índice tras remover
        }
    }
    // Redirigir
    window.location.href = "login.php";
</script></div></body></html>';
exit;
?>
