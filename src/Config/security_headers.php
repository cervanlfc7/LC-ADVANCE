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
        header("Content-Security-Policy: default-src 'self'; script-src 'self' 'unsafe-inline' 'unsafe-eval' https://cdnjs.cloudflare.com https://cdn.jsdelivr.net; style-src 'self' 'unsafe-inline' https://fonts.googleapis.com https://cdnjs.cloudflare.com https://cdn.jsdelivr.net; font-src 'self' https://fonts.gstatic.com https://fonts.googleapis.com https://cdn.jsdelivr.net; img-src 'self' data: blob: https:; connect-src 'self' https://openrouter.ai https://fonts.googleapis.com https://fonts.gstatic.com https://cdn.jsdelivr.net; frame-src 'self' https://www.youtube.com;");
        
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