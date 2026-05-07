<?php
// ================================
// LC-ADVANCE - Security Headers
// ================================

function applySecurityHeaders() {
    if (!headers_sent()) {
        header('X-Content-Type-Options: nosniff');
        header('X-Frame-Options: DENY');
        header('X-XSS-Protection: 1; mode=block');
        header('Referrer-Policy: strict-origin-when-cross-origin');
        header('Permissions-Policy: geolocation=(), microphone=(), camera=()');
        
        // CSP (Content Security Policy)
        header("Content-Security-Policy: default-src 'self'; script-src 'self' 'unsafe-inline' 'unsafe-eval' https://fonts.googleapis.com; style-src 'self' 'unsafe-inline' https://fonts.googleapis.com https://fonts.gstatic.com; font-src 'self' https://fonts.gstatic.com; img-src 'self' data: blob:; connect-src 'self' https://*.google.com https://*.github.com;");
        
        // HTTPS enforcement (solo si no es desarrollo local)
        if (defined('APP_URL') && !empty(APP_URL) && strpos(APP_URL, 'localhost') === false && strpos(APP_URL, '127.0.0.1') === false) {
            if (!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === 'off') {
                $redirect = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
                header("Location: $redirect");
                exit;
            }
        }
    }
}