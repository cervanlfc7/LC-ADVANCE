// ========================================
// LC-ADVANCE — Loader Utility
// Shared loading indicators for AJAX calls.
// ========================================

(function () {
    var style = document.createElement('style');
    style.textContent = '.lc-loader-overlay{position:fixed;inset:0;z-index:99999;display:flex;align-items:center;justify-content:center;background:rgba(6,10,18,0.7);backdrop-filter:blur(4px);transition:opacity .2s}.lc-loader-spinner{width:40px;height:40px;border:4px solid rgba(0,229,255,0.15);border-top-color:#00e5ff;border-radius:50%;animation:lc-spin .7s linear infinite}.lc-loader-text{margin-top:12px;font-family:"Space Grotesk",sans-serif;font-size:0.85rem;color:#00e5ff;text-align:center}@keyframes lc-spin{to{transform:rotate(360deg)}}.lc-loader-btn{position:relative;pointer-events:none;opacity:0.7}.lc-loader-btn::after{content:"";position:absolute;inset:0;border-radius:inherit}';
    document.head.appendChild(style);

    window.lcLoader = {
        show: function (msg) {
            var existing = document.getElementById('lc-loader-overlay');
            if (existing) return existing;
            var overlay = document.createElement('div');
            overlay.id = 'lc-loader-overlay';
            overlay.className = 'lc-loader-overlay';
            overlay.innerHTML = '<div style="display:flex;flex-direction:column;align-items:center"><div class="lc-loader-spinner"></div><div class="lc-loader-text">' + (msg || 'Cargando...') + '</div></div>';
            document.body.appendChild(overlay);
            return overlay;
        },
        hide: function () {
            var el = document.getElementById('lc-loader-overlay');
            if (el) { el.style.opacity = '0'; setTimeout(function () { el.remove(); }, 200); }
        },
        wrap: function (promise, msg) {
            lcLoader.show(msg);
            return promise.then(function (r) { lcLoader.hide(); return r; })['catch'](function (e) { lcLoader.hide(); throw e; });
        },
        disableBtn: function (btn, label) {
            if (!btn) return function () {};
            btn._origLabel = btn.textContent || label;
            btn._origDisabled = btn.disabled;
            btn.disabled = true;
            btn.textContent = label || '...';
            return function () { btn.disabled = btn._origDisabled; btn.textContent = btn._origLabel; };
        }
    };
})();
