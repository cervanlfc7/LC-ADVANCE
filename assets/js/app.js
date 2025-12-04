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

    // 1. Efecto al poner el mouse (mouseenter)
    loginBtn.addEventListener('mouseenter', function() {
        if (camposVacios()) {
            // Añade la clase para disparar la animación de "cierre"
            authWrapper.classList.add('glitch-close');
            
            // Añade un mensaje temporal de "Error de Acceso"
            const errorMsg = document.createElement('div');
            errorMsg.className = 'mensaje error temp-error';
            errorMsg.innerHTML = '⚠️ ERROR DE ACCESO: DATOS INSUFICIENTES';
            authWrapper.prepend(errorMsg); // Muestra el mensaje antes del H1
            
            // Hace que el botón parezca desactivado (solo visualmente)
            loginBtn.dataset.originalText = loginBtn.textContent;
            loginBtn.textContent = 'REINTENTAR...';
        }
    });

    // 2. Restaurar al quitar el mouse (mouseleave)
    loginBtn.addEventListener('mouseleave', function() {
        if (authWrapper.classList.contains('glitch-close')) {
            // Quita la clase para restaurar la visualización normal
            authWrapper.classList.remove('glitch-close');
            
            // Quita el mensaje de error temporal
            const tempError = authWrapper.querySelector('.temp-error');
            if (tempError) {
                tempError.remove();
            }
            
            // Restaura el texto original del botón
            if (loginBtn.dataset.originalText) {
                loginBtn.textContent = loginBtn.dataset.originalText;
                delete loginBtn.dataset.originalText;
            }
        }
    });

    // 3. Evitar el envío si está la animación activa (doble seguridad visual)
    loginBtn.addEventListener('click', function(e) {
        if (authWrapper.classList.contains('glitch-close')) {
            e.preventDefault();
            // Opcional: Vibración o sonido de error
            console.log("Acceso Bloqueado temporalmente.");
        }
    });
}