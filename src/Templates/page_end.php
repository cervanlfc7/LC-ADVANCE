<?php
/**
 * LC-ADVANCE Page End Template
 * Sets: $page_volume (array with audioId, source, channel, defaultVol, autoplay, sliderId, btnId, containerId)
 *       $page_extra_js (string of extra script tags or inline JS)
 */
$page_volume ??= null;
$page_extra_js ??= '';
?>
<?php if ($page_volume): ?>
<script src="<?= assetUrl('assets/js/volume_control.js') ?>"></script>
<audio id="<?= htmlspecialchars($page_volume['audioId']) ?>" loop>
  <source src="<?= htmlspecialchars($page_volume['source']) ?>" type="audio/mpeg">
</audio>
<script>
initVolumeControl(<?= json_encode([
    'audioId' => $page_volume['audioId'],
    'sliderId' => $page_volume['sliderId'] ?? 'volPrincipalSlider',
    'btnId' => $page_volume['btnId'] ?? 'volBtn',
    'containerId' => $page_volume['containerId'] ?? 'volSlider',
    'channel' => $page_volume['channel'] ?? 'principal',
    'defaultVol' => $page_volume['defaultVol'] ?? 0.5,
    'autoplay' => $page_volume['autoplay'] ?? false,
], JSON_UNESCAPED_UNICODE) ?>);
</script>
<?php endif; ?>
<?= $page_extra_js ?>
<script>
// Intercept logout links and POST with CSRF token to avoid GET logout
(function(){
  try{
    var csrfMeta = document.querySelector('meta[name="csrf-token"]');
    var token = csrfMeta ? csrfMeta.getAttribute('content') : '';
    if(!token) return;
    document.addEventListener('click', function(e){
      var a = e.target.closest && e.target.closest('a');
      if(!a) return;
      var href = a.getAttribute('href') || '';
      if(!href) return;
      // Normalize path
      try { var u = new URL(href, window.location.href); } catch(x) { return; }
      if(u.pathname.endsWith('/logout.php') || u.pathname.endsWith('logout.php')){
        e.preventDefault();
        var form = document.createElement('form');
        form.method = 'POST';
        form.action = href;
        var inp = document.createElement('input');
        inp.type = 'hidden';
        inp.name = 'csrf_token';
        inp.value = token;
        form.appendChild(inp);
        document.body.appendChild(form);
        form.submit();
      }
    }, true);
  }catch(e){console.error('logout interceptor', e)}
})();

// Admin forms: show simple loading state and disable submit to avoid double submits
(function(){
  try{
    document.addEventListener('submit', function(e){
      var form = e.target;
      if(!form.closest) return;
      var isAdminForm = !!form.closest('.admin-main');
      if(!isAdminForm) return;
      // find the submit button
      var btn = form.querySelector('button[type="submit"], input[type="submit"]');
      if(!btn) return;
      // disable and add spinner
      btn.disabled = true;
      var originalText = btn.innerHTML;
      btn.setAttribute('data-original', originalText);
      btn.innerHTML = '<span style="display:inline-block;width:14px;height:14px;border:2px solid rgba(255,255,255,0.2);border-top-color:var(--cyan);border-radius:50%;margin-right:8px;vertical-align:middle;animation:spin 800ms linear infinite"></span>Procesando...';
    }, true);

    // small spinner animation
    var style = document.createElement('style');
    style.innerHTML = '@keyframes spin{to{transform:rotate(360deg)}}';
    document.head.appendChild(style);
  }catch(e){console.error('admin form loader', e)}
})();
</script>
</body>
</html>
