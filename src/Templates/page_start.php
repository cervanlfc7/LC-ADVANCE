<?php
/**
 * LC-ADVANCE Page Start Template
 * Sets: $page_title, $page_fonts, $page_css_files, $page_js_files, $page_show_bg_orb, $page_inline_css
 */
$page_title ??= 'LC-ADVANCE';
$page_fonts ??= 'Space+Grotesk:wght@300;400;500;600;700|JetBrains+Mono:wght@400;500;700|Syne:wght@700;800';
$page_css_files ??= [];
$page_js_files ??= [];
$page_show_bg_orb ??= false;
$page_inline_css ??= '';
$page_extra_head ??= '';
?><!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?= htmlspecialchars(csrfToken()) ?>">
    <script>try{var t=localStorage.getItem('lc_advance_theme');if(t==='light'){document.documentElement.classList.remove('dark');document.body.classList.add('theme-light')}else if(t==='dark'){document.documentElement.classList.add('dark')}else if(window.matchMedia('(prefers-color-scheme: light)').matches){document.body.classList.add('theme-light')}}catch(e){} window.__APP_ROOT__ = <?= json_encode(appRootPath()) ?>;</script>
    <link rel="manifest" href="<?= htmlspecialchars(appRootPath()) ?>/manifest.json">
    <title><?= htmlspecialchars($page_title) ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=<?= htmlspecialchars($page_fonts) ?>&display=swap" rel="stylesheet">
<?php foreach ($page_css_files as $f): ?>
    <link rel="stylesheet" href="<?= htmlspecialchars(assetUrl($f)) ?>">
<?php endforeach; ?>
<?= $page_extra_head ?>
<?php if ($page_inline_css): ?>
    <style><?= $page_inline_css ?></style>
<?php endif; ?>
</head>
<body>
<script>
if ('serviceWorker' in navigator) {
  var swPath = (window.__APP_ROOT__ || '') + '/service-worker.js';
  navigator.serviceWorker.register(swPath)['catch'](function(){});
}
</script>
<?php if ($page_show_bg_orb): ?>
<div class="grid-bg"></div>
<div class="bg-orb bg-orb-1"></div>
<div class="bg-orb bg-orb-2"></div>
<?php endif; ?>

<?php
// Admin breadcrumbs: show a compact breadcrumb bar for admin pages
$requestUri = $_SERVER['REQUEST_URI'] ?? '';
if (strpos($requestUri, '/admin/') !== false || strpos($requestUri, '/public/admin/') !== false) {
    $adminIndex = htmlspecialchars(appRootPath() . '/public/admin/index.php');
    $current = htmlspecialchars($page_title ?? 'Admin');
    echo '<div style="background:var(--surface2);border-bottom:1px solid var(--border);padding:10px 16px;color:var(--text-secondary);font-size:0.95rem">';
    echo "<a href=\"{$adminIndex}\" style=\"color:var(--cyan);text-decoration:none;margin-right:8px\">Admin</a> &rsaquo; <span style=\"color:var(--text);font-weight:600\">{$current}</span>";
    echo '</div>';
}
?>
