<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once __DIR__ . '/../src/Config/config.php';
// simulate session as user 1 (teacher)
if (session_status() === PHP_SESSION_NONE) session_start();
$_SESSION['usuario_id'] = 1;
$_SESSION['usuario_tipo'] = 'teacher';
// ensure server vars for path resolution when rendering via CLI
$_SERVER['REQUEST_METHOD'] = 'GET';
$_SERVER['SCRIPT_NAME'] = '/index.php';
// capture output
ob_start();
include __DIR__ . '/../public/panel_docente.php';
$out = ob_get_clean();
file_put_contents(__DIR__ . '/tmp_panel.html', $out);
echo "Rendered to scripts/tmp_panel.html\n";
