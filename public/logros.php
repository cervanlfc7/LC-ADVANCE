<?php
require_once __DIR__ . '/../src/Config/config.php';
require_once __DIR__ . '/../src/Core/logros.php';
requireLogin();

$usuario_id = (int)$_SESSION['usuario_id'];
$badges = obtenerLogrosUsuario($usuario_id, $pdo);
$total = count($badges);
$obtenidos = count(array_filter($badges, fn($b) => $b['obtenido']));

$page_title = 'Logros | LC-ADVANCE';
require __DIR__ . '/../src/Templates/page_start.php';
?>

<div class="logros-container">
    <header class="logros-header">
        <div>
            <h1>🏆 Logros</h1>
            <p class="logros-subtitle"><?= $obtenidos ?> / <?= $total ?> desbloqueados</p>
        </div>
        <a href="dashboard.php" class="lg-btn lg-btn-secondary">← Dashboard</a>
    </header>

    <div class="logros-progress-bar">
        <div class="logros-progress-fill" style="width:<?= $total > 0 ? round(100 * $obtenidos / $total) : 0 ?>%"></div>
    </div>

    <div class="logros-grid">
        <?php foreach ($badges as $b): ?>
            <div class="logro-card <?= $b['obtenido'] ? 'obtenido' : 'bloqueado' ?>">
                <div class="logro-icon">
                    <?php
                    $ico = $b['icono'] ?: '🏅';
                    if (preg_match('/\.(png|jpg|jpeg|gif|svg)$/i', $ico)): ?>
                        <img src="<?= htmlspecialchars(appRootPath()) ?>/public/assets/img/badges/<?= htmlspecialchars($ico) ?>" alt="<?= htmlspecialchars($b['nombre']) ?>" style="width: 42px; height: 42px; object-fit: contain;">
                    <?php else: ?>
                        <?= htmlspecialchars($ico) ?>
                    <?php endif; ?>
                </div>
                <div class="logro-info">
                    <div class="logro-nombre"><?= htmlspecialchars($b['nombre']) ?></div>
                    <div class="logro-desc"><?= htmlspecialchars($b['descripcion']) ?></div>
                </div>
                <div class="logro-status">
                    <?php if ($b['obtenido']): ?>
                        <span class="logro-check">✅</span>
                    <?php else: ?>
                        <span class="logro-lock">🔒</span>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<style>
.logros-container { max-width:800px; margin:0 auto; padding:24px 16px; }
.logros-header { display:flex; justify-content:space-between; align-items:center; margin-bottom:8px; }
.logros-header h1 { font-family:'Syne',sans-serif; font-size:1.5rem; color:var(--cyan); margin:0; }
.logros-subtitle { color:var(--muted); font-size:0.85rem; margin:4px 0 0; }
.logros-progress-bar { height:8px; background:var(--surface2); border-radius:4px; overflow:hidden; margin-bottom:24px; }
.logros-progress-fill { height:100%; background:linear-gradient(90deg,var(--cyan),var(--green)); border-radius:4px; transition:width 0.5s ease; }
.logros-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(280px,1fr)); gap:10px; }
.logro-card { display:flex; align-items:center; gap:12px; background:var(--surface); border:1px solid var(--border); border-radius:12px; padding:14px; transition:all 0.3s; }
.logro-card.obtenido { border-color:rgba(0,255,135,0.2); }
.logro-card.bloqueado { opacity:0.5; filter:grayscale(0.6); }
.logro-card.bloqueado:hover { opacity:0.7; filter:grayscale(0.3); }
.logro-icon { font-size:2rem; width:48px; text-align:center; flex-shrink:0; }
.logro-info { flex:1; min-width:0; }
.logro-nombre { font-size:0.85rem; font-weight:600; color:var(--text); }
.logro-desc { font-size:0.75rem; color:var(--muted); margin-top:2px; }
.logro-status { flex-shrink:0; font-size:1.2rem; }
.lg-btn { border:none; border-radius:8px; padding:10px 18px; font-family:'Space Grotesk',sans-serif; font-size:0.8rem; font-weight:600; cursor:pointer; transition:all 0.3s; text-decoration:none; }
.lg-btn-secondary { background:rgba(0,229,255,0.1); color:var(--cyan); border:1px solid rgba(0,229,255,0.3); }
.lg-btn-secondary:hover { background:rgba(0,229,255,0.2); }
@media(max-width:500px) { .logros-grid { grid-template-columns:1fr; } }
</style>

<?php require __DIR__ . '/../src/Templates/page_end.php'; ?>
