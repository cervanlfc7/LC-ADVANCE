<?php
require_once __DIR__ . '/../src/Config/config.php';
requireLogin();

$page_title = '404 – Página no encontrada | LC-ADVANCE';
require __DIR__ . '/../src/Templates/page_start.php';
?>

<style>
html, body {
  background: #060a12 !important;
  color: #e8f4ff !important;
}
.error-page {
  min-height: calc(100vh - 80px);
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 40px 20px;
}
.error-page-inner {
  text-align: center;
  max-width: 480px;
}
.error-page-code {
  font-size: 6rem;
  font-family: 'Syne', 'Space Grotesk', sans-serif;
  font-weight: 800;
  background: linear-gradient(135deg, #00e5ff, #ff3cac);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
  line-height: 1.2;
}
.error-page-title {
  font-size: 1.4rem;
  font-family: 'Syne', 'Space Grotesk', sans-serif;
  color: #e8f4ff;
  margin: 8px 0 12px;
}
.error-page-desc {
  color: rgba(200, 230, 255, 0.5);
  font-size: 0.95rem;
  margin: 0 0 28px;
  line-height: 1.6;
}
.error-page-btn {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  padding: 12px 28px;
  font-size: 0.9rem;
  font-family: 'Space Grotesk', sans-serif;
  font-weight: 600;
  background: linear-gradient(135deg, #00e5ff, #00b8d4);
  color: #0a0a0f;
  border: none;
  border-radius: 12px;
  cursor: pointer;
  text-decoration: none;
  transition: opacity 0.2s, transform 0.1s;
}
.error-page-btn:hover {
  opacity: 0.9;
  transform: translateY(-1px);
}
</style>

<script>
// Force dark background and fix breadcrumb visibility
document.documentElement.style.background = '#060a12';
document.documentElement.style.color = '#e8f4ff';
document.addEventListener('DOMContentLoaded', function() {
  document.body.style.background = '#060a12';
  document.querySelectorAll('div[style*="surface2"], div[style*="border-bottom"]').forEach(function(el) {
    el.style.background = '#0c1220';
    el.style.color = 'rgba(200,230,255,0.5)';
    el.style.borderBottom = '1px solid rgba(0,230,255,0.12)';
    el.querySelectorAll('a').forEach(function(a) { a.style.color = '#00e5ff'; });
    el.querySelectorAll('span').forEach(function(s) { s.style.color = '#e8f4ff'; });
  });
});
</script>

<main class="error-page">
  <div class="error-page-inner">
    <div class="error-page-code">404</div>
    <h1 class="error-page-title">Página no encontrada</h1>
    <p class="error-page-desc">La página que buscas no existe, fue eliminada o la dirección es incorrecta.</p>
    <a href="<?= htmlspecialchars(getDashboardUrl()) ?>" class="error-page-btn">← Volver al Dashboard</a>
  </div>
</main>

<?php require __DIR__ . '/../src/Templates/page_end.php'; ?>
