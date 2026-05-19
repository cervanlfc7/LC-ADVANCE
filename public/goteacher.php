<?php
// ==========================================
// LC-ADVANCE - goteacher.php
// ==========================================
require_once __DIR__ . '/../src/Config/config.php';
requireLogin(true);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Go Teacher | LC-ADVANCE</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@700;800&family=JetBrains+Mono:wght@400;500;700&family=Space+Grotesk:wght@300;400;500;600&display=swap" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/marked@9/marked.min.js"></script>
    <script>MathJax = { tex: { inlineMath: [['$','$'],['\\(','\\)']] } };</script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>

    <!-- Existing lesson CSS (content styles) -->
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
    /* ════════════ CHAT ADAPTATIVO ════════════ */
    .lc-chat-widget {
        position: fixed;
        right: 24px;
        bottom: 24px;
        z-index: 10010;
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        gap: 12px;
    }
    .lc-chat-toggle {
        width: 62px;
        height: 62px;
        border-radius: 50%;
        border: none;
        background: linear-gradient(135deg, #00e5ff, #ff3cac);
        color: #06101a;
        font-size: 24px;
        box-shadow: 0 16px 40px rgba(0,229,255,0.25);
        cursor: pointer;
        transition: transform 0.2s var(--ease), box-shadow 0.2s;
    }
    .lc-chat-toggle:hover { transform: scale(1.08); box-shadow: 0 20px 50px rgba(0,229,255,0.35); }

    .lc-chat-panel {
        width: min(440px, calc(100vw - 48px));
        height: min(580px, calc(100vh - 120px));
        background: rgba(6,10,18,0.98);
        border: 1px solid rgba(0,229,255,0.22);
        border-radius: 20px;
        overflow: hidden;
        display: none;
        flex-direction: column;
        box-shadow: 0 32px 80px rgba(0,0,0,0.5), 0 0 0 1px rgba(0,229,255,0.05);
        animation: chatIn 0.28s var(--ease) both;
    }
    .lc-chat-panel.open { display: flex; }
    @keyframes chatIn { from { opacity:0; transform: translateY(16px) scale(0.97); } to { opacity:1; transform: translateY(0) scale(1); } }

    .lc-chat-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 14px 18px;
        background: linear-gradient(135deg, rgba(0,229,255,0.08), rgba(255,60,172,0.05));
        border-bottom: 1px solid rgba(0,229,255,0.12);
        flex-shrink: 0;
    }
    .lc-chat-header-info { display: flex; align-items: center; gap: 10px; }
    .lc-chat-avatar {
        width: 32px; height: 32px; border-radius: 50%;
        background: linear-gradient(135deg, #00e5ff, #ff3cac);
        display: flex; align-items: center; justify-content: center;
        font-size: 15px; flex-shrink: 0;
        box-shadow: 0 0 12px rgba(0,229,255,0.3);
    }
    .lc-chat-title {
        font-family: var(--font-display);
        font-size: 13px;
        font-weight: 700;
        color: var(--text);
    }
    .lc-chat-subtitle {
        font-family: var(--font-mono);
        font-size: 9px;
        color: var(--muted);
        margin-top: 1px;
    }
    .lc-chat-close {
        border: 1px solid var(--border);
        background: transparent;
        color: var(--muted);
        font-size: 15px;
        width: 28px; height: 28px;
        border-radius: 8px;
        cursor: pointer;
        display: flex; align-items: center; justify-content: center;
        transition: all 0.2s;
    }
    .lc-chat-close:hover { border-color: var(--pink); color: var(--pink); background: rgba(255,60,172,0.07); }

    .lc-chat-messages {
        flex: 1;
        padding: 16px;
        overflow-y: auto;
        display: flex;
        flex-direction: column;
        gap: 12px;
        scrollbar-width: thin;
        scrollbar-color: rgba(0,229,255,0.15) transparent;
    }
    .lc-chat-messages::-webkit-scrollbar { width: 3px; }
    .lc-chat-messages::-webkit-scrollbar-thumb { background: rgba(0,229,255,0.2); border-radius: 99px; }

    .lc-chat-message {
        max-width: 92%;
        padding: 11px 15px;
        border-radius: 16px;
        font-size: 13px;
        line-height: 1.55;
        position: relative;
    }
    .lc-chat-message.bot {
        background: rgba(0,229,255,0.07);
        border: 1px solid rgba(0,229,255,0.1);
        color: #e8f4ff;
        align-self: flex-start;
        border-bottom-left-radius: 4px;
    }
    .lc-chat-message.user {
        background: rgba(255,255,255,0.07);
        border: 1px solid rgba(255,255,255,0.08);
        color: #d8f6ff;
        align-self: flex-end;
        border-bottom-right-radius: 4px;
    }
    .lc-chat-message.thinking {
        background: rgba(0,229,255,0.04);
        border: 1px solid rgba(0,229,255,0.08);
        color: var(--muted);
        align-self: flex-start;
    }
    /* Typing dots */
    .lc-typing { display: flex; gap: 4px; align-items: center; padding: 4px 0; }
    .lc-typing span {
        width: 6px; height: 6px; border-radius: 50%;
        background: var(--cyan); opacity: 0.4;
        animation: typingBounce 1.2s ease-in-out infinite;
    }
    .lc-typing span:nth-child(2) { animation-delay: 0.2s; }
    .lc-typing span:nth-child(3) { animation-delay: 0.4s; }
    @keyframes typingBounce { 0%,60%,100%{transform:translateY(0); opacity:0.4;} 30%{transform:translateY(-5px); opacity:1;} }

    /* Markdown rendered inside bot messages */
    .lc-md h1,.lc-md h2,.lc-md h3 {
        font-family: var(--font-display);
        color: var(--cyan);
        margin: 12px 0 6px;
        line-height: 1.3;
    }
    .lc-md h1 { font-size: 15px; }
    .lc-md h2 { font-size: 14px; }
    .lc-md h3 { font-size: 13px; color: var(--yellow); }
    .lc-md p { margin: 6px 0; }
    .lc-md ul,.lc-md ol { padding-left: 18px; margin: 6px 0; }
    .lc-md li { margin: 3px 0; }
    .lc-md strong { color: #fffbe0; font-weight: 700; }
    .lc-md em { color: rgba(232,244,255,0.7); font-style: italic; }
    .lc-md code {
        font-family: var(--font-mono);
        font-size: 11px;
        background: rgba(0,229,255,0.1);
        border: 1px solid rgba(0,229,255,0.18);
        border-radius: 4px;
        padding: 1px 5px;
        color: #a8f0ff;
    }
    .lc-md pre {
        background: rgba(0,0,0,0.35);
        border: 1px solid rgba(0,229,255,0.15);
        border-radius: 10px;
        padding: 12px 14px;
        overflow-x: auto;
        margin: 10px 0;
    }
    .lc-md pre code {
        background: none; border: none; padding: 0;
        font-size: 12px; color: #c8f0ff;
    }
    .lc-md blockquote {
        border-left: 3px solid var(--cyan);
        margin: 8px 0;
        padding: 6px 12px;
        background: rgba(0,229,255,0.04);
        border-radius: 0 8px 8px 0;
        color: rgba(232,244,255,0.7);
        font-style: italic;
    }
    .lc-md hr { border: none; border-top: 1px solid var(--border); margin: 12px 0; }
    .lc-md a { color: var(--cyan); text-decoration: underline; }
    .lc-md table { width: 100%; border-collapse: collapse; font-size: 12px; margin: 8px 0; }
    .lc-md th { background: rgba(0,229,255,0.07); color: var(--cyan); padding: 6px 10px; text-align: left; font-family: var(--font-mono); font-size: 10px; }
    .lc-md td { padding: 5px 10px; border-bottom: 1px solid var(--border); color: rgba(232,244,255,0.8); }

    /* Input area */
    .lc-chat-form {
        display: flex;
        flex-direction: column;
        gap: 8px;
        padding: 12px 14px 14px;
        border-top: 1px solid rgba(0,229,255,0.08);
        background: rgba(0,0,0,0.15);
        flex-shrink: 0;
    }
    .lc-chat-input-row {
        display: flex;
        gap: 8px;
        align-items: flex-end;
    }
    .lc-chat-input {
        flex: 1;
        min-width: 0;
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: 12px;
        background: rgba(255,255,255,0.05);
        color: #f3fcff;
        padding: 10px 12px;
        font-family: var(--font-body);
        font-size: 13px;
        resize: none;
        min-height: 42px;
        max-height: 100px;
        line-height: 1.4;
        overflow-y: auto;
        transition: border-color 0.2s;
    }
    .lc-chat-input:focus { outline: none; border-color: rgba(0,229,255,0.3); background: rgba(0,229,255,0.04); }
    .lc-chat-input::placeholder { color: rgba(255,255,255,0.35); }
    .lc-chat-submit {
        border: none;
        border-radius: 12px;
        padding: 0 16px;
        height: 42px;
        background: linear-gradient(135deg, #00e5ff, #ff3cac);
        color: #06101a;
        font-weight: 700;
        font-size: 16px;
        cursor: pointer;
        flex-shrink: 0;
        transition: opacity 0.2s, transform 0.2s;
    }
    .lc-chat-submit:hover { opacity: 0.9; transform: scale(1.05); }
    .lc-chat-submit:disabled { opacity: 0.4; cursor: not-allowed; transform: none; }
    .lc-chat-hint {
        font-family: var(--font-mono);
        font-size: 9px;
        color: rgba(200,230,255,0.3);
        text-align: center;
    }
    @media (max-width: 480px) {
        .lc-chat-panel { width: calc(100vw - 32px); right: 16px; bottom: 16px; }
        .lc-chat-widget { right: 16px; bottom: 16px; }
    }
    </style>
</head>
<body>
<div class="grid-bg"></div>
<div class="bg-orb bg-orb-1"></div>
<div class="bg-orb bg-orb-2"></div>

<!-- ════ HEADER ════ -->
<header class="lc-header">
    <div class="header-brand">
        <span class="brand-logo">LC-ADVANCE</span>
        <div class="brand-dot"></div>
    </div>

    <nav class="header-crumb">
        <span class="crumb-active">Go Teacher</span>
    </nav>

    <div class="header-actions">
        <a href="dashboard.php" class="btn btn-ghost">← Dashboard</a>
        <a href="logout.php" class="btn btn-danger">Salir</a>
    </div>
</header>

<!-- ════ PAGE BODY ════ -->
<div class="page-body">
    <main class="lc-main">
        <div class="content-scroll">
            <div class="lesson-card">
                <div class="lesson-card-head">
                    <h1 class="lh-title">Go Teacher</h1>
                    <div class="lh-meta">
                        <span class="meta-chip status-pend">Herramientas para Profesores</span>
                    </div>
                </div>
                <div class="lesson-card-body">
                    <p>Bienvenido a la sección de Go Teacher. Aquí puedes acceder a herramientas avanzadas para la enseñanza.</p>
                </div>
            </div>
        </div>
    </main>
</div>

<!-- Chat adaptativo -->
<div id="lcChatWidget" class="lc-chat-widget">
    <button id="lcChatToggle" class="lc-chat-toggle" title="Abrir asistente">💬</button>
    <div id="lcChatPanel" class="lc-chat-panel" aria-hidden="true" aria-label="Asistente LC-Tutor">
        <div class="lc-chat-header">
            <div class="lc-chat-header-info">
                <div class="lc-chat-avatar">🤖</div>
                <div>
                    <div class="lc-chat-title">LC-Tutor</div>
                    <div class="lc-chat-subtitle">Asistente educativo · pregunta cualquier cosa</div>
                </div>
            </div>
            <button id="lcChatClose" class="lc-chat-close" type="button" aria-label="Cerrar chat">✕</button>
        </div>
        <div id="lcChatMessages" class="lc-chat-messages">
            <div class="lc-chat-message bot">
                <div class="lc-md">
                    <p>👋 Hola, soy <strong>LC-Tutor</strong>. Puedo ayudarte con dudas de cualquier tema: matemáticas, ciencias, programación, historia…</p>
                    <p>¿Qué quieres saber?</p>
                </div>
            </div>
        </div>
        <form id="lcChatForm" class="lc-chat-form" onsubmit="event.preventDefault(); sendChatQuestion(); return false;">
            <div class="lc-chat-input-row">
                <textarea id="lcChatInput" class="lc-chat-input" name="question"
                    placeholder="Pregunta lo que necesites…" autocomplete="off" rows="1"></textarea>
                <button id="lcChatSend" type="submit" class="lc-chat-submit" title="Enviar">➤</button>
            </div>
            <div class="lc-chat-options-row">
                <label for="lcChatProvider">IA:</label>
                <select id="lcChatProvider" name="provider" class="lc-chat-provider">
                    <option value="auto" selected>Auto (API/local)</option>
                    <option value="api">IA Remota</option>
                    <option value="local">IA Local</option>
                </select>
            </div>
            <div class="lc-chat-hint">Enter para enviar · Shift+Enter para nueva línea</div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const chatToggle   = document.getElementById('lcChatToggle');
    const chatPanel    = document.getElementById('lcChatPanel');
    const chatClose    = document.getElementById('lcChatClose');
    const chatForm     = document.getElementById('lcChatForm');
    const chatSend     = document.getElementById('lcChatSend');
    const chatInput    = document.getElementById('lcChatInput');
    const chatMessages = document.getElementById('lcChatMessages');

    // Configure marked
    if (window.marked) {
        marked.setOptions({
            breaks: true,
            gfm: true
        });
    }

    function renderMd(text) {
        if (!window.marked) return `<p>${text.replace(/\n/g, '<br>')}</p>`;
        try { return marked.parse(text); } catch(e) { return `<p>${text}</p>`; }
    }

    function appendChatMessage(text, sender = 'bot', isMarkdown = false) {
        const msg = document.createElement('div');
        msg.className = `lc-chat-message ${sender}`;
        if (sender === 'bot' && isMarkdown) {
            const inner = document.createElement('div');
            inner.className = 'lc-md';
            inner.innerHTML = renderMd(text);
            msg.appendChild(inner);
        } else {
            msg.textContent = text;
        }
        chatMessages.appendChild(msg);
        chatMessages.scrollTop = chatMessages.scrollHeight;
        return msg;
    }

    function showTyping() {
        const msg = document.createElement('div');
        msg.className = 'lc-chat-message bot thinking';
        msg.id = 'lcTyping';
        msg.innerHTML = '<div class="lc-typing"><span></span><span></span><span></span></div>';
        chatMessages.appendChild(msg);
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }

    function removeTyping() {
        document.getElementById('lcTyping')?.remove();
    }

    function createDraftMessage() {
        const msg = document.createElement('div');
        msg.className = 'lc-chat-message bot';
        const inner = document.createElement('div');
        inner.className = 'lc-md lc-chat-draft';
        inner.textContent = '';
        msg.appendChild(inner);
        chatMessages.appendChild(msg);
        chatMessages.scrollTop = chatMessages.scrollHeight;
        return inner;
    }

    function typeWriterEffect(text, target) {
        return new Promise(resolve => {
            const total = text.length;
            if (total === 0) {
                target.textContent = '';
                resolve();
                return;
            }
            const maxSteps = 120;
            const steps = Math.min(maxSteps, total);
            const chunk = Math.max(1, Math.ceil(total / steps));
            const duration = Math.min(2200, Math.max(900, Math.round(total * 10)));
            const interval = Math.max(10, Math.floor(duration / steps));
            let index = 0;
            const timer = setInterval(() => {
                index = Math.min(total, index + chunk);
                target.textContent = text.slice(0, index);
                chatMessages.scrollTop = chatMessages.scrollHeight;
                if (index >= total) {
                    clearInterval(timer);
                    resolve();
                }
            }, interval);
        });
    }

    function toggleChat(open) {
        if (!chatPanel) return;
        chatPanel.classList.toggle('open', open);
        chatPanel.setAttribute('aria-hidden', open ? 'false' : 'true');
        if (open) setTimeout(() => chatInput.focus(), 200);
    }

    chatToggle?.addEventListener('click', () => toggleChat(true));
    chatClose?.addEventListener('click',  () => toggleChat(false));

    // Auto-resize textarea
    chatInput?.addEventListener('input', function() {
        this.style.height = 'auto';
        this.style.height = Math.min(this.scrollHeight, 100) + 'px';
    });

    // Enter sends, Shift+Enter is newline
    chatInput?.addEventListener('keydown', function(e) {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            sendChatQuestion();
        }
    });

    async function sendChatQuestion() {
        const question = chatInput.value.trim();
        if (!question) return;

        appendChatMessage(question, 'user');
        chatInput.value = '';
        chatInput.style.height = 'auto';
        chatSend.disabled = true;
        showTyping();

        try {
            const response = await fetch('ai_tutor.php', {
                method: 'POST',
                credentials: 'same-origin',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                cache: 'no-store',
                body: new URLSearchParams({
                    slug: '',
                    lesson_title: 'Go Teacher',
                    lesson_subject: 'General',
                    correctas: 0,
                    total: 1,
                    question,
                    provider: document.getElementById('lcChatProvider')?.value || 'auto'
                })
            });

            const text = await response.text();
            let result;
            try {
                result = JSON.parse(text);
            } catch (parseError) {
                throw new Error(`Respuesta inválida del servidor (${response.status}): ${text.slice(0, 200)}`);
            }

            removeTyping();
            if (!response.ok || !result.ok) {
                const errorMsg = result.error || `HTTP ${response.status}`;
                appendChatMessage(`❌ Error del asistente: ${errorMsg}`, 'bot', true);
            } else {
                const draft = createDraftMessage();
                const aiText = result.ai_text || 'No se recibió respuesta del asistente.';
                await typeWriterEffect(aiText, draft);
                if (aiText && window.marked) {
                    draft.innerHTML = renderMd(aiText);
                }
            }
        } catch (err) {
            removeTyping();
            appendChatMessage(`❌ Error al conectar con el asistente: ${err.message}`, 'bot', true);
        } finally {
            chatSend.disabled = false;
            chatInput.focus();
        }
    }

    chatSend?.addEventListener('click', sendChatQuestion);
});
</script>

<script src="assets/js/app.js"></script>
</body>
</html>