<?php
// ==========================================
// LC-ADVANCE - csrf.php
// ==========================================
// Autor: LC-TEAM
// Fecha: 2025-10-29
// Descripción: Protección contra ataques CSRF
// ==========================================

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/**
 * Genera un token CSRF único por sesión.
 * Este token se guarda en $_SESSION y se debe
 * incluir en cada formulario o petición POST/AJAX.
 */
function generarTokenCSRF() {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

/**
 * Valida un token CSRF recibido en un formulario o AJAX.
 * Si el token no coincide o no existe, se rechaza la petición.
 */
function validarTokenCSRF($token) {
    if (!isset($_SESSION['csrf_token']) || !$token) {
        return false;
    }
    return hash_equals($_SESSION['csrf_token'], $token);
}

/**
 * Inserta automáticamente un campo oculto en formularios HTML.
 * Uso: <?= campoTokenCSRF() ?>
 */
function campoTokenCSRF() {
    $token = generarTokenCSRF();
    return '<input type="hidden" name="csrf_token" value="' . htmlspecialchars($token) . '">';
}

/**
 * Verifica automáticamente el token en peticiones POST.
 * Si el token no es válido, finaliza el script con un error 403.
 */
function protegerCSRF() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $token = $_POST['csrf_token'] ?? '';
        if (!validarTokenCSRF($token)) {
            http_response_code(403);
            die('⚠️ Petición inválida: error de validación CSRF.');
        }
    }
}
?>
