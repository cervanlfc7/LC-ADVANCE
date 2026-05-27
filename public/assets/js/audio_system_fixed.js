// ========================================
// SISTEMA DE VOZ Y PRONUNCIACIÓN — CORREGIDO
// ========================================

// ---- Voz: obtener la mejor voz en inglés ----
let _voiceCache = null;

function getBestEnglishVoice() {
    if (_voiceCache) return _voiceCache;
    const voices = window.speechSynthesis ? window.speechSynthesis.getVoices() : [];
    const preferred = [
        'Google US English',
        'Microsoft David Desktop',
        'Microsoft Zira Desktop',
        'Samantha',
        'Alex'
    ];
    const byName = voices.find(v => preferred.some(p => v.name.includes(p)));
    if (byName) { _voiceCache = byName; return byName; }
    const byLang = voices.find(v => /^en(-|_)(US|GB)/i.test(v.lang));
    if (byLang) { _voiceCache = byLang; return byLang; }
    const anyEn = voices.find(v => /^en/i.test(v.lang));
    _voiceCache = anyEn || null;
    return _voiceCache;
}

// Llamar getVoices() temprano y cachear al evento voiceschanged
if (window.speechSynthesis) {
    window.speechSynthesis.getVoices();
    window.speechSynthesis.addEventListener('voiceschanged', () => {
        _voiceCache = null;
        getBestEnglishVoice();
    });
}

// ---- Función central de síntesis de voz ----
function speakText(text, opts = {}) {
    if (!window.speechSynthesis) {
        console.warn('SpeechSynthesis no disponible');
        return;
    }
    window.speechSynthesis.cancel();

    const utter = new SpeechSynthesisUtterance(text);
    utter.lang    = 'en-US';
    utter.rate    = opts.rate  ?? 0.9;
    utter.pitch   = opts.pitch ?? 1.0;
    utter.volume  = 1.0;

    const voice = getBestEnglishVoice();
    if (voice) utter.voice = voice;

    if (opts.onStart) utter.onstart = opts.onStart;
    if (opts.onEnd)   utter.onend   = opts.onEnd;
    if (opts.onError) utter.onerror  = opts.onError;

    window.speechSynthesis.speak(utter);
}

// ========================================
// GRID DE NÚMEROS 1-100
// ========================================

const _numWords = {
    1:'one',2:'two',3:'three',4:'four',5:'five',6:'six',7:'seven',
    8:'eight',9:'nine',10:'ten',11:'eleven',12:'twelve',13:'thirteen',
    14:'fourteen',15:'fifteen',16:'sixteen',17:'seventeen',18:'eighteen',
    19:'nineteen',20:'twenty',30:'thirty',40:'forty',50:'fifty',
    60:'sixty',70:'seventy',80:'eighty',90:'ninety',100:'one hundred'
};

function getNumWord(n) {
    if (_numWords[n]) return _numWords[n];
    const tens = Math.floor(n / 10) * 10;
    const unit = n % 10;
    return `${_numWords[tens]}-${_numWords[unit]}`;
}

function generarNumerosGrid() {
    let html = '';
    for (let i = 1; i <= 100; i++) {
        const word = getNumWord(i);
        html += `<button onclick="speakNumber(${i},'${word}')" class="numero-btn" data-number="${i}">
                    <span class="number-digit">${i}</span>
                    <span class="number-word">${word}</span>
                 </button>`;
    }

    const grid = document.getElementById('numerosGrid');
    if (!grid) return;
    grid.innerHTML = html;

    let clickedCount = 0;
    grid.querySelectorAll('.numero-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            clickedCount++;
            const counter = document.getElementById('numbersClicked');
            if (counter) counter.textContent = clickedCount;
            this.classList.add('clicked');
        });
    });
}

function speakNumber(num, word) {
    const btn = document.querySelector(`[data-number="${num}"]`);
    if (btn) btn.classList.add('speaking');

    speakText(word, {
        rate: parseFloat(document.getElementById('speedControl')?.value ?? 1),
        onEnd: () => btn && btn.classList.remove('speaking')
    });

    mostrarNotificacion(`🔢 Número ${num}: "${word}"`, 'info');
}

function playAllNumbers() {
    const speed = parseFloat(document.getElementById('speedControl')?.value ?? 1);
    let delay = 0;
    for (let i = 1; i <= 10; i++) {
        const word = getNumWord(i);
        setTimeout(() => speakNumber(i, word), delay);
        delay += Math.round(900 / speed);
    }
    mostrarNotificacion('Reproduciendo números 1-10...', 'success');
}

function updateSpeed(value) {
    const el = document.getElementById('speedValue');
    if (el) el.textContent = `${value}x`;
    mostrarNotificacion(`Velocidad: ${value}x`, 'info');
}

function practiceNumbers() {
    const n = Math.floor(Math.random() * 100) + 1;
    const word = getNumWord(n);
    const cp = document.getElementById('currentPhrase');
    const tip = document.getElementById('pronunciationTip');
    if (cp)  cp.textContent  = `Say: ${n} (${word})`;
    if (tip) tip.textContent = `Di "${word}" en voz alta y haz clic en HABLAR para verificar`;
    mostrarNotificacion('Modo práctica activado. ¡Habla el número!', 'info');
}

// ========================================
// SALUDOS — BOTONES DE PRONUNCIAR
// ========================================

function speakGreeting(phrase, buttonElement) {
    if (!buttonElement) { speakText(phrase); return; }
    setBtnState(buttonElement, 'loading');

    // Pequeño delay para que las voces estén listas si la página acaba de cargar
    setTimeout(() => {
        if (!window.speechSynthesis) {
            setBtnState(buttonElement, 'error');
            return;
        }
        setBtnState(buttonElement, 'playing');
        speakText(phrase, {
            rate: 0.88,
            onEnd:   () => setBtnState(buttonElement, 'idle'),
            onError: () => setBtnState(buttonElement, 'error')
        });
    }, 80);
}

function setBtnState(btn, state) {
    btn.classList.remove('loading', 'playing', 'error');
    btn.disabled = false;
    const icon   = btn.querySelector('.btn-icon');
    const text   = btn.querySelector('.btn-text');
    const status = btn.querySelector('.btn-status');

    switch (state) {
        case 'loading':
            btn.disabled = true;
            if (icon)   icon.textContent   = '⏳';
            if (status) status.textContent = 'Cargando...';
            break;
        case 'playing':
            btn.classList.add('playing');
            btn.disabled = true;
            if (icon)   icon.textContent   = '🔊';
            if (status) status.textContent = 'Reproduciendo...';
            break;
        case 'error':
            btn.classList.add('error');
            if (icon)   icon.textContent   = '❌';
            if (text)   text.textContent   = 'Error';
            if (status) status.textContent = 'Intenta de nuevo';
            break;
        default: // idle
            if (icon)   icon.textContent   = '🔊';
            if (text)   text.textContent   = 'Pronunciar';
            if (status) status.textContent = '';
    }
}

// ========================================
// SIMULADOR DE VOZ — RECONOCIMIENTO
// ========================================

const frasesConfig = {
    "Hello! My name is [Your Name].": {
        patterns: ['hello my name', 'hi my name', 'my name is'],
        phonetics: '/həˈloʊ maɪ neɪm ɪz/',
        tips: ["Pronuncia la H en 'hello'", "Enfatiza 'my name is' claramente"]
    },
    "Hi! How are you?": {
        patterns: ['hi how are you', 'hello how are you', 'how are you'],
        phonetics: '/haɪ haʊ ɑːr juː/',
        tips: ["Sube el tono al final para la pregunta"]
    },
    "I am 17 years old.": {
        patterns: ['i am seventeen', "i'm seventeen", 'seventeen years old'],
        phonetics: '/aɪ æm ˈsɛvənˌtiːn jɪrz oʊld/',
        tips: ["'Seventeen' tiene acento en la primera sílaba"]
    },
    "Nice to meet you!": {
        patterns: ['nice to meet you', 'pleased to meet you'],
        phonetics: '/naɪs tə miːt juː/',
        tips: ["Pronuncia 'meet' claramente"]
    }
};

let recognition = null;

function playPhrase() {
    const frase = document.getElementById('fraseSelect')?.value;
    if (!frase) return;

    const cp = document.getElementById('currentPhrase');
    const st = document.getElementById('pronunciationStatus');
    const tip = document.getElementById('pronunciationTip');
    if (cp) cp.textContent = frase;
    if (st) { st.textContent = 'Escuchando pronunciación...'; st.style.color = '#00cc88'; }

    animateWaveform();

    speakText(frase, {
        rate: 0.85,
        onEnd: () => {
            if (st)  st.textContent  = 'Pronunciación completada';
            if (tip) tip.textContent = 'Ahora intenta decirlo tú mismo. Haz clic en HABLAR.';
        }
    });

    mostrarNotificacion(`Reproduciendo: "${frase}"`, 'success');
}

function startRecording() {
    const SpeechRec = window.SpeechRecognition || window.webkitSpeechRecognition;
    if (!SpeechRec) {
        mostrarNotificacion('Tu navegador no soporta reconocimiento de voz. Usa Chrome o Edge.', 'error');
        return;
    }

    const fraseOriginal = document.getElementById('fraseSelect')?.value ?? '';
    const config = frasesConfig[fraseOriginal] || {
        patterns: [fraseOriginal.toLowerCase()],
        tips: ['Pronuncia claramente cada palabra']
    };

    recognition = new SpeechRec();
    recognition.lang            = 'en-US';
    recognition.interimResults  = false;
    recognition.maxAlternatives = 1;
    recognition.continuous      = false;

    const statusEl  = document.getElementById('pronunciationStatus');
    const recStatus = document.getElementById('recorderStatus');

    if (statusEl)  { statusEl.textContent = '🎤 Escuchando... ¡Habla ahora!'; statusEl.style.color = '#ffee44'; }
    if (recStatus) recStatus.innerHTML = '<span class="status-icon">🎤</span><span class="status-text">Grabando...</span>';

    animateWaveform(true);
    recognition.start();

    recognition.onresult = function (event) {
        const dicho  = event.results[0][0].transcript.toLowerCase().trim();
        const acierto = config.patterns.some(p => dicho.includes(p));
        const score  = acierto ? 100 : calcularSimilitud(dicho, fraseOriginal.toLowerCase());

        const userEl   = document.getElementById('userSpeech');
        const scoreEl  = document.getElementById('pronunciationScore');
        const tipEl    = document.getElementById('pronunciationTip');

        if (userEl)  userEl.textContent  = `"${dicho}"`;
        if (statusEl) {
            statusEl.textContent = acierto ? '✅ ¡PERFECTO!' : '⚠️ Puede mejorar';
            statusEl.style.color = acierto ? '#00cc88' : '#ffaa00';
        }
        if (tipEl)   tipEl.textContent   = config.tips?.[0] ?? 'Sigue practicando';
        updateScoreDisplay(score);

        mostrarNotificacion(
            acierto ? '🎉 ¡Pronunciación perfecta! 100%' : `Pronunciación: ${score}%. Sigue practicando.`,
            acierto ? 'success' : 'warning'
        );
    };

    recognition.onerror = function () {
        mostrarNotificacion('Error de micrófono. Permite el acceso e inténtalo de nuevo.', 'error');
        if (statusEl) { statusEl.textContent = '❌ Error de micrófono'; statusEl.style.color = '#ff4444'; }
    };

    recognition.onend = function () {
        if (recStatus) recStatus.innerHTML = '<span class="status-icon">⏸️</span><span class="status-text">Grabación finalizada</span>';
    };
}

function calcularSimilitud(a, b) {
    const wa = a.split(' ');
    const wb = b.split(' ');
    let hits = 0;
    wa.forEach(w => { if (w.length > 2 && wb.some(x => x.includes(w) || w.includes(x))) hits++; });
    return Math.min(100, Math.floor(hits / Math.max(wa.length, wb.length) * 100));
}

function updateScoreDisplay(score) {
    const el = document.getElementById('pronunciationScore');
    if (!el) return;
    el.textContent = `${score}%`;
    el.style.color = score >= 80 ? '#00cc88' : score >= 60 ? '#ffee44' : '#ff4444';
}

function showPhonetics() {
    const display = document.getElementById('phoneticsDisplay');
    if (!display) return;
    display.style.display = display.style.display === 'none' ? 'block' : 'none';

    const frase  = document.getElementById('fraseSelect')?.value ?? '';
    const config = frasesConfig[frase];
    const content = display.querySelector('.phonetics-content');
    if (config && content) {
        content.innerHTML = `<p><strong>Frase:</strong> ${frase}</p>
                             <p><strong>Fonética:</strong> ${config.phonetics}</p>
                             <p><strong>Consejo:</strong> ${config.tips?.[0] ?? ''}</p>`;
    }
}

function animateWaveform(continuous = false) {
    const waveform = document.getElementById('waveform');
    if (!waveform) return;
    waveform.innerHTML = '';
    const bars = 20;
    for (let i = 0; i < bars; i++) {
        const bar = document.createElement('div');
        bar.className = 'wave-bar';
        bar.style.height = `${Math.random() * 60 + 20}%`;
        bar.style.animationDelay = `${i * 0.05}s`;
        waveform.appendChild(bar);
    }
    if (!continuous) setTimeout(() => { waveform.innerHTML = ''; }, 2000);
}

// ========================================
// DIÁLOGO INTERACTIVO
// ========================================

function speakDialogue(text) {
    speakText(text, { rate: 0.9 });
}

function selectDialogue(type) {
    const lines = {
        greeting:     { you: "Hello! How are you?",                       ana: "Hi! I'm good, thank you! And you?" },
        introduction: { you: "I'm [Your Name]. I study at CBTis 168.",    ana: "Nice to meet you! I'm Ana." },
        age:          { you: "I am 17 years old.",                        ana: "I'm 16. It's nice to meet students from CBTis!" },
        farewell:     { you: "See you later!",                            ana: "Bye! Have a nice day!" }
    };
    const pair = lines[type];
    if (!pair) return;

    const byEl = document.getElementById('bubbleYou');
    const anaEl = document.getElementById('bubbleAna');

    if (byEl)  byEl.querySelector('.bubble-content p').textContent  = pair.you;
    if (anaEl) anaEl.querySelector('.bubble-content p').textContent = pair.ana;

    animateBubble('bubbleYou');
    setTimeout(() => animateBubble('bubbleAna'), 500);

    speakDialogue(pair.you);
    setTimeout(() => speakDialogue(pair.ana), 1800);

    mostrarNotificacion(`Diálogo: ${pair.you}`, 'info');
}

function animateBubble(id) {
    const el = document.getElementById(id);
    if (!el) return;
    el.style.transform = 'scale(0.85)';
    el.style.opacity   = '0.5';
    setTimeout(() => { el.style.transform = 'scale(1)'; el.style.opacity = '1'; }, 120);
}

function playFullDialogue() {
    const script = [
        { side: 'you',  text: "Hello! My name is [Your Name]. I am 17 years old. I study at CBTis 168." },
        { side: 'ana',  text: "Hi! I'm Ana. Nice to meet you! I'm 16 years old." },
        { side: 'you',  text: "Nice to meet you too! See you later!" },
        { side: 'ana',  text: "Bye! Have a nice day!" }
    ];
    let delay = 0;
    script.forEach(({ side, text }) => {
        setTimeout(() => {
            const id = side === 'you' ? 'bubbleYou' : 'bubbleAna';
            const el = document.getElementById(id);
            if (el) el.querySelector('.bubble-content p').textContent = text;
            animateBubble(id);
            speakDialogue(text);
        }, delay);
        delay += 3200;
    });
    mostrarNotificacion('Reproduciendo diálogo completo...', 'success');
}

function resetDialogue() {
    const byEl  = document.getElementById('bubbleYou');
    const anaEl = document.getElementById('bubbleAna');
    if (byEl)  byEl.querySelector('.bubble-content p').textContent  = "Hello! My name is [Your Name].";
    if (anaEl) anaEl.querySelector('.bubble-content p').textContent = "Hi! I'm Ana. Nice to meet you!";
    mostrarNotificacion('Diálogo reiniciado', 'info');
}

// ========================================
// DESAFÍO DE CONVERSACIÓN (GRABACIÓN)
// ========================================

let conversationRecorder = null;
let conversationChunks   = [];
let conversationTimer    = null;
let timeLeft             = 60;

function startConversation() {
    if (!navigator.mediaDevices?.getUserMedia) {
        mostrarNotificacion('Tu navegador no soporta grabación de audio.', 'error');
        return;
    }
    navigator.mediaDevices.getUserMedia({ audio: true })
        .then(stream => {
            conversationChunks   = [];
            conversationRecorder = new MediaRecorder(stream);

            conversationRecorder.ondataavailable = e => conversationChunks.push(e.data);
            conversationRecorder.onstop = () => {
                const blob = new Blob(conversationChunks, { type: 'audio/webm' });
                const url  = URL.createObjectURL(blob);
                const playBtn = document.querySelector('.btn-play');
                if (playBtn) playBtn.dataset.audioUrl = url;
                evaluateConversation();
            };

            conversationRecorder.start();
            startTimer();

            setConvUI({ start: true, pause: false, stop: false, play: true });
            setRecStatus('🎤', 'Grabando...');
            animateConversationWaveform(true);
            mostrarNotificacion('🎤 Grabación iniciada. ¡Habla ahora!', 'success');
        })
        .catch(err => mostrarNotificacion('Error al acceder al micrófono: ' + err.message, 'error'));
}

function pauseConversation() {
    if (conversationRecorder?.state === 'recording') {
        conversationRecorder.pause();
        clearInterval(conversationTimer);
        setConvUI({ start: false, pause: true, stop: false, play: true });
        setRecStatus('⏸️', 'Pausado');
        mostrarNotificacion('Grabación pausada', 'info');
    }
}

function stopConversation() {
    if (conversationRecorder && ['recording','paused'].includes(conversationRecorder.state)) {
        conversationRecorder.stop();
        conversationRecorder.stream.getTracks().forEach(t => t.stop());
        clearInterval(conversationTimer);
        setConvUI({ start: false, pause: true, stop: true, play: false });
        setRecStatus('⏹️', 'Grabación completada');
        animateConversationWaveform(false);
        mostrarNotificacion('Grabación finalizada. Haz clic en ESCUCHAR para revisar.', 'success');
    }
}

function playConversation() {
    const url = document.querySelector('.btn-play')?.dataset?.audioUrl;
    if (url) { new Audio(url).play(); mostrarNotificacion('Reproduciendo tu conversación...', 'info'); }
}

function setConvUI({ start, pause, stop, play }) {
    const get = sel => document.querySelector(sel);
    if (get('.btn-start')) get('.btn-start').disabled = start;
    if (get('.btn-pause')) get('.btn-pause').disabled = pause;
    if (get('.btn-stop'))  get('.btn-stop').disabled  = stop;
    if (get('.btn-play'))  get('.btn-play').disabled  = play;
}

function setRecStatus(icon, text) {
    const el = document.getElementById('recorderStatus');
    if (el) el.innerHTML = `<span class="status-icon">${icon}</span><span class="status-text">${text}</span>`;
}

function startTimer() {
    timeLeft = 60;
    updateTimerDisplay();
    conversationTimer = setInterval(() => {
        timeLeft--;
        updateTimerDisplay();
        if (timeLeft <= 0) { stopConversation(); mostrarNotificacion('⏰ ¡Tiempo terminado!', 'warning'); }
    }, 1000);
}

function updateTimerDisplay() {
    const el = document.getElementById('conversationTimer');
    if (!el) return;
    const m = Math.floor(timeLeft / 60).toString().padStart(2, '0');
    const s = (timeLeft % 60).toString().padStart(2, '0');
    el.textContent = `${m}:${s}`;
}

function evaluateConversation() {
    const rand = (min, range) => Math.floor(Math.random() * range) + min;
    const p = rand(70, 30), g = rand(75, 25), f = rand(80, 20), c = rand(85, 15);
    const total = Math.round((p + g + f + c) / 4);

    const setBar = (id, val) => {
        const bar = document.getElementById(id);
        const lbl = document.getElementById(id.replace('Result', 'Value'));
        if (bar) bar.style.width = `${val}%`;
        if (lbl) lbl.textContent = `${val}%`;
    };
    setBar('pronunciationResult', p);
    setBar('grammarResult',       g);
    setBar('fluencyResult',       f);
    setBar('completenessResult',  c);

    const totalEl = document.getElementById('totalScore');
    if (totalEl) totalEl.textContent = total;

    const evRes = document.getElementById('evaluationResults');
    if (evRes) evRes.style.display = 'block';

    const msg = total >= 85 ? '🎉 ¡EXCELENTE! Tu conversación es casi perfecta.'
              : total >= 70 ? '👍 BUEN TRABAJO. Sigue practicando la pronunciación.'
              :               '📚 NECESITAS MÁS PRÁCTICA. Revisa los errores comunes.';

    const fb = document.getElementById('recorderFeedback');
    if (fb) fb.innerHTML = `<div class="feedback-result">
        <h5>📋 FEEDBACK:</h5><p>${msg}</p>
        <p><strong>Recomendación:</strong> Practica los saludos y la entonación de preguntas.</p>
    </div>`;
}

function animateConversationWaveform(animate) {
    const wf = document.getElementById('conversationWaveform');
    if (!wf) return;
    wf.innerHTML = '';
    if (!animate) return;
    for (let i = 0; i < 40; i++) {
        const bar = document.createElement('div');
        bar.className = 'conversation-wave-bar';
        bar.style.cssText = `height:${Math.random() * 80 + 10}%;animation:wavePulse ${0.5 + Math.random() * 0.5}s infinite alternate;animation-delay:${i * 0.05}s`;
        wf.appendChild(bar);
    }
}

// ========================================
// AUTOEVALUACIÓN
// ========================================

function actualizarEvaluacion(num, value) {
    const el = document.getElementById(`evalValue${num}`);
    if (el) el.textContent = `${value}/5`;
    calcularPromedioIngles();
}

function calcularPromedioIngles() {
    const vals = [1, 2, 3].map(i => {
        const el = document.getElementById(`evalValue${i}`);
        return el ? parseInt(el.textContent) : 0;
    }).filter(v => !isNaN(v));

    if (vals.length) {
        const avg = (vals.reduce((a, b) => a + b, 0) / vals.length).toFixed(1);
        const el = document.getElementById('evalAverage');
        if (el) el.textContent = avg;
    }
}

function guardarEvaluacionIngles() {
    const get = id => document.getElementById(id)?.textContent ?? '0';
    const evaluacion = {
        fecha:         new Date().toISOString(),
        saludos:       get('evalValue1'),
        presentacion:  get('evalValue2'),
        numeros:       get('evalValue3'),
        promedio:      get('evalAverage')
    };
    localStorage.setItem('inglesA1Evaluacion', JSON.stringify(evaluacion));
    alert(`📊 Evaluación guardada:\n\nSaludos: ${evaluacion.saludos}\nPresentación: ${evaluacion.presentacion}\nNúmeros: ${evaluacion.numeros}\nPromedio: ${evaluacion.promedio}/5`);
    mostrarNotificacion('Autoevaluación guardada correctamente', 'success');
}

// ========================================
// NOTIFICACIONES
// ========================================

function mostrarNotificacion(mensaje, tipo = 'info') {
    const iconos = { success: '✅', warning: '⚠️', error: '❌', info: 'ℹ️' };
    const n = document.createElement('div');
    n.className = `notificacion notificacion-${tipo}`;
    n.innerHTML = `<div class="notificacion-contenido">
                     <span class="notificacion-icon">${iconos[tipo] ?? 'ℹ️'}</span>
                     <span class="notificacion-mensaje">${mensaje}</span>
                   </div>
                   <button class="notificacion-cerrar" onclick="this.parentElement.remove()">×</button>`;
    document.body.appendChild(n);
    setTimeout(() => n.parentElement && n.remove(), 5000);
}

// ========================================
// INICIALIZACIÓN
// ========================================

document.addEventListener('DOMContentLoaded', function () {
    generarNumerosGrid();

    // Cargar evaluación previa
    try {
        const saved = localStorage.getItem('inglesA1Evaluacion');
        if (saved) {
            const d = JSON.parse(saved);
            const set = (id, val) => { const el = document.getElementById(id); if (el) el.textContent = val; };
            set('evalValue1', d.saludos);
            set('evalValue2', d.presentacion);
            set('evalValue3', d.numeros);
            set('evalAverage', d.promedio);
            document.querySelectorAll('.eval-slider').forEach((slider, i) => {
                const vals = [d.saludos, d.presentacion, d.numeros];
                slider.value = parseInt(vals[i]) || 3;
            });
            mostrarNotificacion('Evaluación previa cargada', 'info');
        }
    } catch (e) { console.log('Sin evaluación previa'); }

    // Avisar si no hay APIs de voz
    if (!window.speechSynthesis) {
        mostrarNotificacion('Tu navegador no soporta síntesis de voz. Usa Chrome o Edge.', 'warning');
    }
    if (!window.SpeechRecognition && !window.webkitSpeechRecognition) {
        mostrarNotificacion('Reconocimiento de voz no disponible. Usa Chrome o Edge.', 'warning');
    }

    setTimeout(() => mostrarNotificacion('🚀 Sistema Inglés A1 listo. ¡Comienza a aprender!', 'success'), 800);
    console.log('✅ audio_system_fixed.js cargado correctamente');
});