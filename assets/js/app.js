/* =========================================
LC-ADVANCE - app.js
Funciones JS retro 8-bit para gamificación
========================================= */

document.addEventListener('DOMContentLoaded', function() {

    // ===============================
    // Completar lección (botón)
    // ===============================
    const completarBtns = document.querySelectorAll('.btn-completar');
    completarBtns.forEach(btn => {
        btn.addEventListener('click', function(e){
            e.preventDefault();
            const leccionId = this.dataset.leccion;

            fetch('src/funciones.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `accion=completar&leccion=${leccionId}`
            })
            .then(res => res.json())
            .then(data => {
                if(data.ok){
                    alert(`🎉 Lección completada! +${data.puntos} puntos`);
                    actualizarProgreso(data.nivel, data.puntos, data.badges);
                } else {
                    alert('Error al completar la lección');
                }
            });
        });
    });

    // ===============================
    // Actualizar barra de progreso y badges
    // ===============================
    function actualizarProgreso(nivel, puntos, badges){
        const progressFill = document.querySelector('.progress-fill');
        if(progressFill){
            let porcentaje = Math.min((puntos % 500) / 5, 100); // cada 500 puntos = nivel
            progressFill.style.width = porcentaje + '%';
        }

        const levelSpan = document.querySelector('.user-nivel');
        if(levelSpan) levelSpan.textContent = nivel;

        const badgeContainer = document.querySelector('.badges-section');
        if(badgeContainer && badges){
            badgeContainer.innerHTML = '';
            badges.forEach(b => {
                let span = document.createElement('span');
                span.className = 'badge ' + (b.tipo || '');
                span.textContent = b.nombre;
                badgeContainer.appendChild(span);
            });
        }
    }

    // ===============================
    // Animación retro (confeti pixel)
    // ===============================
    const animConfeti = () => {
        const confeti = document.createElement('div');
        confeti.className = 'confeti';
        confeti.style.left = Math.random()*window.innerWidth + 'px';
        document.body.appendChild(confeti);
        setTimeout(()=>confeti.remove(), 1500);
    };

    // Llama animación si hay elementos con clase .animate-confeti
    const confetiBtns = document.querySelectorAll('.animate-confeti');
    confetiBtns.forEach(btn => {
        btn.addEventListener('click', () => animConfeti());
    });

});
// ===============================================
// Nuevo: Efecto "Glitch Close" en el Login
// ===============================================
const authWrapper = document.querySelector('.auth-form-wrapper');
const loginBtn = document.querySelector('.btn-primary.animate-glitch');
const usernameInput = document.getElementById('nombre_usuario');
const passwordInput = document.getElementById('contrasena');

if (loginBtn && authWrapper && usernameInput && passwordInput) {
    
    // Función para verificar si los campos están vacíos
    const camposVacios = () => {
        return usernameInput.value.trim() === '' || passwordInput.value.trim() === '';
    };

    // SOLO AL HACER CLIC (submit)
    loginBtn.addEventListener('click', function(e) {
        if (camposVacios()) {
            e.preventDefault();
            
            // Añade la clase para disparar la animación de "cierre"
            authWrapper.classList.add('glitch-close');
            
            // Quita cualquier mensaje de error anterior
            const oldError = authWrapper.querySelector('.temp-error');
            if (oldError) oldError.remove();
            
            // Añade un mensaje temporal de "Error de Acceso"
            const errorMsg = document.createElement('div');
            errorMsg.className = 'mensaje error temp-error';
            errorMsg.innerHTML = '⚠️ ERROR DE ACCESO: DATOS INSUFICIENTES';
            authWrapper.prepend(errorMsg); // Muestra el mensaje antes del H1
            
            // Hace que el botón parezca desactivado (solo visualmente)
            loginBtn.dataset.originalText = loginBtn.textContent;
            loginBtn.textContent = 'REINTENTAR...';
            
            // Auto-restaurar después de 2 segundos
            setTimeout(() => {
                if (authWrapper.classList.contains('glitch-close')) {
                    authWrapper.classList.remove('glitch-close');
                    
                    const tempError = authWrapper.querySelector('.temp-error');
                    if (tempError) {
                        tempError.remove();
                    }
                    
                    if (loginBtn.dataset.originalText) {
                        loginBtn.textContent = loginBtn.dataset.originalText;
                        delete loginBtn.dataset.originalText;
                    }
                }
            }, 2000);
        }
    });
}

    /* ===============================
       Dark mode toggle + persistencia
       Uso: añadir un botón con clase `dark-toggle` para alternar
     =============================== */
    (function(){
        const THEME_KEY = 'lc_advance_theme';
        const root = document.documentElement || document.body;

        function applyTheme(theme){
            if(theme === 'dark') document.documentElement.classList.add('dark');
            else document.documentElement.classList.remove('dark');
        }

        // Aplicar preferencia guardada; no forzar tema por defecto (se usará la configuración del sistema o del CSS base)
        try{
            const saved = localStorage.getItem(THEME_KEY);
            if(saved){
                applyTheme(saved);
            } else {
                // No se aplica tema automáticamente; el sitio usa estilos base por defecto
                // Si necesitamos aplicar el recomendado por sistema: // if(window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) applyTheme('dark');
            }
        } catch(e){/* ignored */}

        // Exponer función global para alternar
        window.toggleDarkMode = function(){
            const isDark = document.documentElement.classList.toggle('dark');
            try{ localStorage.setItem(THEME_KEY, isDark ? 'dark' : 'light'); } catch(e){/* ignored */}
            return isDark;
        };

        // Delegación: botones con clase .dark-toggle alternan el tema
        document.addEventListener('click', function(e){
            const target = e.target.closest && e.target.closest('.dark-toggle');
            if(target){
                e.preventDefault();
                window.toggleDarkMode();
            }
        });
    })();

// ===== Global quiz delegation =====
// Ensures .quiz-option and .quiz-reset work regardless of script execution order
(function(){
    function disableQuestionOptions(q, clickedBtn, isCorrect){
        const options = q.querySelectorAll('.quiz-option');
        options.forEach(o => {
            o.disabled = true;
            o.classList.add('disabled');
            if(o.dataset.correct === 'true') o.classList.add('correct-selected');
            if(o === clickedBtn && !isCorrect) o.classList.add('incorrect-selected');
        });
    }

    document.addEventListener('click', function(e){
        const btn = e.target.closest && e.target.closest('.quiz-option');
        if(btn){
            const q = btn.closest('.quiz-question');
            const container = btn.closest('.quiz-container') || document;
            const isCorrect = btn.dataset.correct === 'true';
            const feedbackMsg = btn.dataset.feedback || (isCorrect ? '✅ Correcto' : '❌ Incorrecto');

            if(q) disableQuestionOptions(q, btn, isCorrect);

            // Show feedback (prefer container-local .quiz-feedback)
            let feedbackDiv = container.querySelector('.quiz-feedback');
            if(!feedbackDiv){
                feedbackDiv = document.createElement('div');
                feedbackDiv.className = 'quiz-feedback';
                container.appendChild(feedbackDiv);
            }

            // Update possible quiz-specific score if present
            if(container.querySelector('#pollutionQuizFeedback')){
                window.pollutionQuizScore = (window.pollutionQuizScore || 0) + (isCorrect ? 1 : 0);
                const answered = container.querySelectorAll('.quiz-option:disabled').length / (q ? q.querySelectorAll('.quiz-option').length : 1);
                feedbackDiv.innerHTML = `<div class="${isCorrect ? 'correct-feedback' : 'incorrect-feedback'}">${feedbackMsg}</div><p>Progreso: ${answered}</p><p>Puntuación: ${window.pollutionQuizScore}</p>`;
            } else {
                feedbackDiv.innerHTML = `<div class="${isCorrect ? 'correct-feedback' : 'incorrect-feedback'}">${feedbackMsg}</div>`;
            }

            return;
        }

        const resetBtn = e.target.closest && e.target.closest('.quiz-reset');
        if(resetBtn){
            const container = resetBtn.closest('.quiz-container');
            if(container){
                container.querySelectorAll('.quiz-option').forEach(button => {
                    button.disabled = false;
                    button.classList.remove('disabled','correct-selected','incorrect-selected');
                    button.style.backgroundColor = '';
                    button.style.color = '';
                });
                const feedback = container.querySelector('.quiz-feedback');
                if(feedback) feedback.innerHTML = '';
                // reset any quiz-specific counters
                if(window.pollutionQuizScore) window.pollutionQuizScore = 0;
            }
            return;
        }
    });

    // keyboard support: Enter / Space activates focused quiz-option
    document.addEventListener('keydown', function(e){
        if(e.key === 'Enter' || e.key === ' '){
            const active = document.activeElement;
            if(active && active.classList && active.classList.contains('quiz-option')){
                e.preventDefault();
                active.click();
            }
        }
    });
})();

// Ensure quiz buttons are reset and visible on DOMContentLoaded (recovery step)
document.addEventListener('DOMContentLoaded', function(){
    try{
        document.querySelectorAll('.quiz-option').forEach(btn => {
            btn.disabled = false;
            btn.classList.remove('disabled','correct-selected','incorrect-selected');
            btn.style.display = '';
            btn.style.visibility = '';
            if(btn.tagName === 'BUTTON') btn.type = 'button';
        });
        // remove empty feedback placeholders
        document.querySelectorAll('.quiz-feedback').forEach(f => { if(!f.textContent.trim()) f.remove(); });
    }catch(e){ /* no-op */ }
    
    // Iniciar ranking en dashboard
    fetchAndUpdateDashboard();
    setInterval(fetchAndUpdateDashboard, 15000);
});

document.addEventListener('DOMContentLoaded', function(){
    try {
        const hdr = document.querySelector('.header');
        if (hdr) {
            let btn = hdr.querySelector('.hamburger');
            const nav = hdr.querySelector('nav');
            if (!btn) {
                btn = document.createElement('button');
                btn.className = 'hamburger';
                btn.type = 'button';
                btn.setAttribute('aria-label', 'Menu');
                btn.textContent = '☰';
                hdr.insertBefore(btn, nav);
            }
            btn.addEventListener('click', function(){ hdr.classList.toggle('nav-open'); });
        }
        const mh = document.querySelector('.main-header');
        if (mh) {
            let btn2 = mh.querySelector('.hamburger');
            const nav2 = mh.querySelector('.header-nav');
            if (!btn2) {
                btn2 = document.createElement('button');
                btn2.className = 'hamburger';
                btn2.type = 'button';
                btn2.setAttribute('aria-label', 'Menu');
                btn2.textContent = '☰';
                mh.insertBefore(btn2, nav2);
            }
            btn2.addEventListener('click', function(){ mh.classList.toggle('nav-open'); });
        }
    } catch(e){}
});
// ========================================
// TOP 10 RANKING - Actualizar dashboard
// ========================================
function fetchAndUpdateDashboard() {
    fetch('api/ranking.php', {
        method: 'GET',
        headers: { 'Content-Type': 'application/json' }
    })
    .then(res => {
        if (!res.ok) {
            console.error('Response status:', res.status);
            throw new Error('HTTP error ' + res.status);
        }
        return res.json();
    })
    .then(data => {
        console.log('Datos recibidos del ranking:', data);
        if (!data.ok) {
            console.log('Error al obtener ranking:', data.error);
            return;
        }

        // ===== ACTUALIZAR PUNTOS Y NIVEL =====
        const puntosEl = document.getElementById('puntos-actuales');
        const nivelEl = document.getElementById('nivel-actual');
        const puntosProgressEl = document.getElementById('puntos-actuales-mini');
        const puntosNecesariosEl = document.getElementById('puntos-necesarios');

        if (puntosEl) puntosEl.textContent = data.puntos || 0;
        if (nivelEl) nivelEl.textContent = data.nivel || 1;
        if (puntosProgressEl) puntosProgressEl.textContent = data.puntos || 0;
        
        // Calcular puntos necesarios: (nivel+1) * 500
        const puntos_necesarios = ((data.nivel || 1) + 1) * 500;
        if (puntosNecesariosEl) puntosNecesariosEl.textContent = puntos_necesarios;

        // Actualizar barra de progreso
        const puntos_base = (data.nivel || 1) * 500;
        const progreso = Math.min(100, Math.max(0, ((data.puntos || 0) - puntos_base) / 500 * 100));
        const progressFill = document.getElementById('progress-fill');
        if (progressFill) progressFill.style.width = progreso + '%';

        // ===== ACTUALIZAR BADGES =====
        const badgesContainer = document.getElementById('badges-container');
        if (badgesContainer && data.badges) {
            if (data.badges.length === 0) {
                badgesContainer.innerHTML = '<p class="text-muted">¡Completa lecciones para obtener tu primer Badge (500 pts)!</p>';
            } else {
                badgesContainer.innerHTML = data.badges
                    .map(b => `<span class="badge ${b.tipo || 'bronze'}">${b.nombre}</span>`)
                    .join('');
            }
        }

        // ===== LLENAR TOP 10 RANKING =====
        const rankingBody = document.getElementById('ranking-body');
        console.log('rankingBody element:', rankingBody);
        console.log('data.ranking:', data.ranking);
        
        if (rankingBody && data.ranking) {
            if (data.ranking.length === 0) {
                rankingBody.innerHTML = '<tr><td colspan="3" class="text-muted">Sé el primero en el ranking 🏆</td></tr>';
            } else {
                rankingBody.innerHTML = data.ranking
                    .slice(0, 10)  // Solo top 10
                    .map((player, idx) => {
                        const isCurrent = player.es_actual ? 'ranking-current-user' : '';
                        return `
                            <tr class="${isCurrent}">
                                <td class="rank-number">${idx + 1}</td>
                                <td class="rank-player">${player.nombre_usuario || 'Anónimo'}</td>
                                <td class="rank-points">${player.puntos || 0} pts</td>
                            </tr>
                        `;
                    })
                    .join('');
                console.log('Ranking actualizado con ' + data.ranking.length + ' jugadores');
            }
        } else {
            console.warn('rankingBody no existe o data.ranking no tiene datos');
        }

    })
    .catch(err => console.error('Error al actualizar dashboard:', err));
}

