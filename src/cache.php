<?php
// ================================
// LC-ADVANCE - Cache Utility
// ================================
// Caching simple basado en archivos para lecciones

define('CACHE_DIR', __DIR__ . '/../cache');
define('CACHE_TTL', 300); // 5 minutos

function getCache($key) {
    if (!is_dir(CACHE_DIR)) {
        @mkdir(CACHE_DIR, 0755, true);
    }
    $file = CACHE_DIR . '/' . md5($key) . '.cache';
    if (!file_exists($file)) return null;
    
    $data = json_decode(file_get_contents($file), true);
    if (!$data || $data['expires'] < time()) {
        @unlink($file);
        return null;
    }
    return $data['value'];
}

function setCache($key, $value) {
    if (!is_dir(CACHE_DIR)) {
        @mkdir(CACHE_DIR, 0755, true);
    }
    $file = CACHE_DIR . '/' . md5($key) . '.cache';
    $data = [
        'value' => $value,
        'expires' => time() + CACHE_TTL
    ];
    @file_put_contents($file, json_encode($data));
}

function clearCache($key = null) {
    if ($key) {
        $file = CACHE_DIR . '/' . md5($key) . '.cache';
        @unlink($file);
    } else {
        $files = glob(CACHE_DIR . '/*.cache');
        foreach ($files as $f) @unlink($f);
    }
}