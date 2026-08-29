<?php
/**
 * Materia: Pensamiento Matemático III
 * Lecciones: 2
 */
return array (
  0 => 
  array (
    'materia' => 'Pensamiento Matemático III',
    'slug' => 'derivadas-basicas-pendientes-dominio',
    'titulo' => 'Derivadas Básicas: Pendiente, Cambio Instantáneo y Dominio',
    'contenido' => '<div class="leccion-derivadas">

  <!-- HERO -->
  <div class="leccion-hero reveal">
    <div class="hero-badge">📐 Pensamiento Matemático III</div>
    <h1 class="hero-title">Derivadas: El arte de medir el cambio</h1>
    <p class="hero-subtitle">Pendiente instantánea, interpretación geométrica y aplicaciones reales</p>
  </div>

  <!-- OBJETIVOS -->
  <div class="obj-grid reveal">
    <div class="obj-card">
      <span class="obj-icon">🎯</span>
      <span class="obj-text"><strong>Interpretar</strong> la derivada como razón de cambio instantánea.</span>
    </div>
    <div class="obj-card">
      <span class="obj-icon">📈</span>
      <span class="obj-text"><strong>Calcular</strong> derivadas de funciones básicas usando reglas.</span>
    </div>
    <div class="obj-card">
      <span class="obj-icon">🖥️</span>
      <span class="obj-text"><strong>Visualizar</strong> la tangente y el comportamiento de la función.</span>
    </div>
  </div>

  <!-- 1. VIDA REAL -->
  <section class="seccion reveal">
    <h2>📌 1. La derivada en la vida real</h2>
    <p>Cuando manejas un auto, el velocímetro no te dice <em>dónde estás</em> sino <strong>cuán rápido cambia tu posición</strong>. Eso es una derivada: el cambio instantáneo de una cantidad respecto a otra.</p>
    <ul class="ejemplos-reales">
      <li>🚗 <strong>Velocidad</strong> → cambio de posición / tiempo</li>
      <li>📈 <strong>Crecimiento poblacional</strong> → cambio de individuos / tiempo</li>
      <li>💰 <strong>Costo marginal</strong> → cambio de costo / unidad producida</li>
    </ul>
    <blockquote class="definicion">
      La derivada \\( f\'(a) \\) es la <strong>pendiente de la recta tangente</strong> a la gráfica de \\( f \\) en \\( x = a \\).
    </blockquote>
  </section>

  <!-- 2. TEORÍA -->
  <section class="seccion reveal">
    <h2>📚 2. Desarrollo teórico</h2>
    <div class="teoria-grid">
      <div class="card-concepto">
        <h3>Definición formal</h3>
        <p>\\[ f\'(a) = \\lim_{h \\to 0} \\frac{f(a+h) - f(a)}{h} \\]</p>
        <p>Este límite, cuando existe, nos da la pendiente instantánea en cada punto.</p>
      </div>
      <div class="card-concepto">
        <h3>Reglas básicas de derivación</h3>
        <ul>
          <li>\\( \\frac{d}{dx}[c] = 0 \\)</li>
          <li>\\( \\frac{d}{dx}[x^n] = n \\, x^{n-1} \\)</li>
          <li>\\( \\frac{d}{dx}[e^x] = e^x \\)</li>
          <li>\\( \\frac{d}{dx}[\\ln x] = \\tfrac{1}{x} \\)</li>
          <li>\\( \\frac{d}{dx}[\\sin x] = \\cos x \\)</li>
        </ul>
      </div>
    </div>
    <table class="sign-table">
      <thead>
        <tr>
          <th>Signo de \\( f\'(x) \\)</th>
          <th>Comportamiento de \\( f \\)</th>
        </tr>
      </thead>
      <tbody>
        <tr><td>\\( f\'(x) > 0 \\)</td><td>Función <strong style="color:var(--green)">creciente</strong></td></tr>
        <tr><td>\\( f\'(x) < 0 \\)</td><td>Función <strong style="color:var(--red)">decreciente</strong></td></tr>
        <tr><td>\\( f\'(x) = 0 \\)</td><td>Posible extremo <span style="color:var(--yellow)">(máx / mín / inflexión)</span></td></tr>
      </tbody>
    </table>
  </section>

  <!-- 3. VISUALIZACIÓN TANGENTE -->
  <section class="seccion reveal">
    <h2>🖱️ 3. Visualización dinámica de la recta tangente</h2>
    <p>Mueve el cursor (o desliza en móvil) sobre la gráfica para ver cómo cambia la pendiente en cada punto.</p>
    <div class="svg-container">
      <svg id="tangentExplorer" viewBox="0 0 900 420" style="background:var(--surface2)"></svg>
    </div>
    <p class="caption">Función \\( f(x) = x^3 - 3x \\). La línea magenta es la tangente; su pendiente es \\( f\'(x) = 3x^2 - 3 \\).</p>
  </section>

  <!-- 4. SIMULADOR -->
  <section class="seccion reveal">
    <h2>⚙️ 4. Simulador interactivo de derivadas</h2>
    <p>Ingresa cualquier función en sintaxis JS. El eje Y se ajusta automáticamente. <strong>Clic en la gráfica</strong> para pantalla completa.</p>
    <div class="simulador">
      <div class="input-line">
        <label>\\( f(x) = \\)</label>
        <input type="text" id="funcInput" value="x**3 - 3*x">
        <button id="actualizarFunc" class="btn-secondary" style="padding:8px 14px">Graficar</button>
      </div>
      <div class="keypad" id="keypad">
        <button data-val="x">x</button>
        <button data-val="**2">x²</button>
        <button data-val="**3">x³</button>
        <button data-val="**">^</button>
        <button data-val="Math.sin(">sin</button>
        <button data-val="Math.cos(">cos</button>
        <button data-val="Math.tan(">tan</button>
        <button data-val="Math.exp(">eˣ</button>
        <button data-val="Math.log(">ln</button>
        <button data-val="Math.log10(">log₁₀</button>
        <button data-val="Math.sqrt(">√</button>
        <button data-val="Math.PI">π</button>
        <button data-val="(">(</button>
        <button data-val=")">)</button>
        <button data-val="+">+</button>
        <button data-val="-">−</button>
        <button data-val="*">×</button>
        <button data-val="/">/</button>
        <button data-val=" ">🗑 Clear</button>
      </div>
      <div class="slider-container">
        <label>Punto x :</label>
        <input type="range" id="xSlider" min="-4" max="4" step="0.01" value="0">
        <span id="xValueDisplay" class="value-display">0.00</span>
      </div>
      <div id="derivInfo" class="info-panel">
        x = 0.00 &nbsp;|&nbsp; f(x) = 0.00 &nbsp;|&nbsp; f\'(x) ≈ 0.00
      </div>
      <div class="toggle-options">
        <label><input type="checkbox" id="showTangentCheckbox" checked> Mostrar recta tangente</label>
        <button id="resetViewBtn"  class="btn-secondary">🔄 Resetear vista</button>
        <button id="autoScaleBtn"  class="btn-secondary">📏 Auto-escalar Y</button>
      </div>
      <svg id="simuladorSVG" class="interactive-graph" viewBox="0 0 900 380" style="background:var(--surface2)"></svg>
      <p class="caption caption-small">
        💡 El rango Y se ajusta automáticamente. Clic en la gráfica para pantalla completa.
      </p>
    </div>
  </section>

  <!-- MODAL FULLSCREEN -->
  <div id="graphModal" class="modal">
    <div class="modal-content">
      <button class="close-modal" id="closeModalBtn" aria-label="Cerrar">✕</button>
      <svg id="modalSVG" viewBox="0 0 1000 560" style="background:var(--surface2);border-radius:10px"></svg>
    </div>
  </div>

  <!-- 5. ERRORES COMUNES -->
  <section class="seccion reveal">
    <h2>⚠️ 5. Errores frecuentes</h2>
    <p>Haz clic en cada error para ver la explicación.</p>
    <div class="errores-lista">
      <div class="error-item" tabindex="0" role="button">
        <strong>1. Confundir derivada con cociente de diferencias finitas</strong>
        <div class="error-detail">La derivada NO es \\(\\frac{f(b)-f(a)}{b-a}\\); ese es el promedio. La derivada es el <em>límite</em> de ese cociente cuando \\(b \\to a\\).</div>
      </div>
      <div class="error-item" tabindex="0" role="button">
        <strong>2. No multiplicar por el exponente al derivar potencias</strong>
        <div class="error-detail">Correcto: \\(\\frac{d}{dx}[5x^3] = 5 \\cdot 3 \\cdot x^2 = 15x^2\\). Error frecuente: escribir \\(5x^2\\).</div>
      </div>
      <div class="error-item" tabindex="0" role="button">
        <strong>3. Derivar constantes como si fueran variables</strong>
        <div class="error-detail">\\(\\frac{d}{dx}[7] = 0\\), porque una constante no cambia — su "velocidad de cambio" es cero.</div>
      </div>
      <div class="error-item" tabindex="0" role="button">
        <strong>4. Ignorar puntos de no-derivabilidad</strong>
        <div class="error-detail">Ejemplo: \\(f(x) = |x|\\) no tiene derivada en \\(x=0\\) porque la "esquina" impide trazar una tangente única.</div>
      </div>
    </div>
  </section>

  <!-- 6. CONEXIÓN CURRICULAR -->
  <section class="seccion reveal">
    <h2>📘 6. Relación con el programa oficial</h2>
    <p>Este contenido pertenece al bloque <strong>"Introducción al Cálculo Diferencial"</strong> de Pensamiento Matemático III.</p>
    <ul>
      <li>✔️ Cálculo de derivadas de funciones polinomiales, exponenciales y trigonométricas.</li>
      <li>✔️ Interpretación geométrica y física de la derivada.</li>
      <li>✔️ Análisis de intervalos de crecimiento y decrecimiento.</li>
      <li>✔️ Resolución de problemas de optimización básicos.</li>
    </ul>
  </section>

  <!-- 7. PROBLEMAS TIPO EXAMEN -->
  <section class="seccion reveal">
    <h2>📝 7. Problemas tipo examen</h2>
    <ol class="problemas">
      <li>Calcula \\( f\'(x) \\) para \\( f(x) = 4x^5 - 3x^2 + 8x - 7 \\).</li>
      <li>La posición de una partícula es \\( s(t) = t^3 - 6t^2 + 9t \\). ¿Cuál es su velocidad en \\( t = 2 \\)? ¿Cuándo se detiene?</li>
      <li>Determina los intervalos donde \\( g(x) = x^3 - 12x \\) es creciente y decreciente.</li>
      <li>Un recipiente contiene \\( V(t) = t^3 - 9t^2 + 24t \\) litros. ¿En qué momento la tasa de cambio es máxima?</li>
    </ol>
  </section>

  <!-- 8. QUIZ -->
  <section class="seccion reveal">
    <h2>🧠 8. Autoevaluación</h2>
    <div class="quiz" id="quizContainer">

      <div class="pregunta">
        <p><strong>1.</strong> La derivada de una función en un punto representa:</p>
        <label><input type="radio" name="q1" value="a"> El valor de la función en ese punto.</label>
        <label><input type="radio" name="q1" value="b"> La pendiente de la recta tangente.</label>
        <label><input type="radio" name="q1" value="c"> El área bajo la curva.</label>
      </div>

      <div class="pregunta">
        <p><strong>2.</strong> Si \\( f\'(x) < 0 \\) en un intervalo, la función es:</p>
        <label><input type="radio" name="q2" value="a"> Creciente</label>
        <label><input type="radio" name="q2" value="b"> Decreciente</label>
        <label><input type="radio" name="q2" value="c"> Constante</label>
      </div>

      <div class="pregunta">
        <p><strong>3.</strong> La derivada de \\( f(x) = 7 \\) es:</p>
        <label><input type="radio" name="q3" value="a"> 7</label>
        <label><input type="radio" name="q3" value="b"> 0</label>
        <label><input type="radio" name="q3" value="c"> 1</label>
      </div>

      <div class="pregunta">
        <p><strong>4.</strong> ¿Cuál es la derivada de \\( f(x) = 5x^4 \\)?</p>
        <label><input type="radio" name="q4" value="a"> \\( 20x^3 \\)</label>
        <label><input type="radio" name="q4" value="b"> \\( 5x^3 \\)</label>
        <label><input type="radio" name="q4" value="c"> \\( 4x^5 \\)</label>
      </div>

      <div class="pregunta">
        <p><strong>5.</strong> ¿Cuál es la derivada de \\( f(x) = \\sin x \\)?</p>
        <label><input type="radio" name="q5" value="a"> \\( \\cos x \\)</label>
        <label><input type="radio" name="q5" value="b"> \\( -\\cos x \\)</label>
        <label><input type="radio" name="q5" value="c"> \\( \\sin x \\)</label>
      </div>

      <div class="pregunta">
        <p><strong>6.</strong> Velocidad de \\( s(t) = t^2 + 2t \\) en \\( t = 3 \\):</p>
        <label><input type="radio" name="q6" value="a"> 6</label>
        <label><input type="radio" name="q6" value="b"> 8</label>
        <label><input type="radio" name="q6" value="c"> 12</label>
      </div>

      <button id="corregirQuiz">✅ Corregir respuestas</button>
      <div id="quizFeedback" class="feedback" style="display:none"></div>
    </div>
  </section>

  <!-- 9. REFLEXIÓN -->
  <section class="seccion reveal">
    <h2>💭 9. Reflexiona sobre tu aprendizaje</h2>
    <div class="reflexion">
      <ol>
        <li>¿Cómo explicarías la "derivada" a un compañero que nunca la ha escuchado?</li>
        <li>¿Qué situación cotidiana podrías modelar con una derivada?</li>
        <li>¿Qué concepto te resultó más difícil y por qué?</li>
      </ol>
      <textarea rows="4" placeholder="Escribe aquí tus reflexiones..."></textarea>
    </div>
  </section>

</div><!-- /.leccion-derivadas -->

<!-- ====================== SCRIPTS ====================== -->
<script>
(function () {
  "use strict";

  /* ── TANGENT EXPLORER ─────────────────────── */
  (function () {
    const svg  = document.getElementById("tangentExplorer");
    if (!svg) return;
    const xmin = -3, xmax = 3, ymin = -8, ymax = 8;
    const f    = x => x ** 3 - 3 * x;
    const fp   = x => 3 * x ** 2 - 3;
    const W = 900, H = 420;
    const mL = 70, mR = W - 30, mT = 20, mB = H - 30;
    const pW = mR - mL, pH = mB - mT;
    const sx = x => mL + (x - xmin) / (xmax - xmin) * pW;
    const sy = y => mB - (y - ymin) / (ymax - ymin) * pH;

    /* draw static elements */
    let path = "";
    for (let x = xmin; x <= xmax; x += 0.015)
      path += (x === xmin ? "M" : "L") + sx(x).toFixed(1) + " " + sy(f(x)).toFixed(1);

    /* axes */
    let axes = "";
    for (let xi = xmin; xi <= xmax; xi++) {
      const px = sx(xi);
      axes += `<line x1="${px}" y1="${mT}" x2="${px}" y2="${mB}" stroke="rgba(255,255,255,0.04)" stroke-width="1"/>`;
      axes += `<text x="${px}" y="${mB + 16}" fill="#555" font-size="11" text-anchor="middle" font-family="JetBrains Mono,monospace">${xi}</text>`;
    }
    for (let yi = ymin; yi <= ymax; yi += 2) {
      const py = sy(yi);
      axes += `<line x1="${mL}" y1="${py}" x2="${mR}" y2="${py}" stroke="rgba(255,255,255,0.04)" stroke-width="1"/>`;
      if (yi !== 0) axes += `<text x="${mL - 8}" y="${py + 4}" fill="#555" font-size="11" text-anchor="end" font-family="JetBrains Mono,monospace">${yi}</text>`;
    }
    /* zero axes */
    const ax0 = sx(0), ay0 = sy(0);
    axes += `<line x1="${mL}" y1="${ay0}" x2="${mR}" y2="${ay0}" stroke="rgba(255,255,255,0.18)" stroke-width="1"/>`;
    axes += `<line x1="${ax0}" y1="${mT}" x2="${ax0}" y2="${mB}" stroke="rgba(255,255,255,0.18)" stroke-width="1"/>`;

    svg.innerHTML = `
      ${axes}
      <path d="${path}" stroke="#00e5ff" stroke-width="2.5" fill="none" stroke-linecap="round"/>
      <line id="tL" stroke="#ff3cac" stroke-width="2.5" stroke-linecap="round"/>
      <circle id="tP" r="7" fill="#ff3cac" stroke="rgba(255,255,255,0.5)" stroke-width="1.5"/>
    `;

    function update(mx) {
      const x = xmin + (mx - mL) / pW * (xmax - xmin);
      if (x < xmin || x > xmax) return;
      const y = f(x), m = fp(x);
      document.getElementById("tP").setAttribute("cx", sx(x).toFixed(1));
      document.getElementById("tP").setAttribute("cy", sy(y).toFixed(1));
      const len = 65, dn = len / Math.sqrt(1 + m * m);
      const line = document.getElementById("tL");
      line.setAttribute("x1", (sx(x) - dn).toFixed(1));
      line.setAttribute("y1", (sy(y) - m * dn).toFixed(1));
      line.setAttribute("x2", (sx(x) + dn).toFixed(1));
      line.setAttribute("y2", (sy(y) + m * dn).toFixed(1));
    }

    svg.addEventListener("mousemove", e => {
      const r = svg.getBoundingClientRect();
      update((e.clientX - r.left) * (W / r.width));
    });
    svg.addEventListener("touchmove", e => {
      e.preventDefault();
      const r = svg.getBoundingClientRect();
      update((e.touches[0].clientX - r.left) * (W / r.width));
    }, { passive: false });
  })();

  /* ── SIMULATOR ────────────────────────────── */
  (function () {
    const MAX = 1e10;
    let expr = null;
    let xmin = -4, xmax = 4, ymin = -10, ymax = 10;
    let modalOpen = false;

    const funcInput     = document.getElementById("funcInput");
    const slider        = document.getElementById("xSlider");
    const xDisp         = document.getElementById("xValueDisplay");
    const infoPanel     = document.getElementById("derivInfo");
    const mainSVG       = document.getElementById("simuladorSVG");
    const showTangentCB = document.getElementById("showTangentCheckbox");
    const modal         = document.getElementById("graphModal");
    const modalSVG      = document.getElementById("modalSVG");
    const closeBtn      = document.getElementById("closeModalBtn");
    if (!funcInput || !mainSVG) return;

    function evalF(ex, x) {
      try {
        const fn = new Function("x", "return " + ex.replace(/\\^/g, "**"));
        const r  = fn(x);
        return isFinite(r) && Math.abs(r) < MAX ? r : NaN;
      } catch (_) { return NaN; }
    }

    function deriv(x, h = 1e-4) {
      if (!expr) return NaN;
      const a = evalF(expr, x + h), b = evalF(expr, x - h);
      return isNaN(a) || isNaN(b) ? NaN : (a - b) / (2 * h);
    }

    function autoY() {
      if (!expr) return;
      const vals = [], step = (xmax - xmin) / 400;
      for (let x = xmin; x <= xmax; x += step) {
        const y = evalF(expr, x);
        if (!isNaN(y)) vals.push(y);
      }
      if (!vals.length) { ymin = -10; ymax = 10; return; }
      const lo = Math.min(...vals), hi = Math.max(...vals);
      const mg = (hi - lo) * 0.14 || 1;
      ymin = lo - mg; ymax = hi + mg;
    }

    function axesFor(W, H, mL, mR, mT, mB) {
      const pW = mR - mL, pH = mB - mT;
      const sx = x => mL + (x - xmin) / (xmax - xmin) * pW;
      const sy = y => mB - (y - ymin) / (ymax - ymin) * pH;
      let html = "";
      const yStep = Math.max(1, Math.round((ymax - ymin) / 8));
      for (let xi = Math.ceil(xmin); xi <= Math.floor(xmax); xi++) {
        const px = sx(xi);
        html += `<line x1="${px}" y1="${mT}" x2="${px}" y2="${mB}" stroke="rgba(255,255,255,0.04)" stroke-width="1"/>`;
        html += `<text x="${px}" y="${mB+15}" fill="#555" font-size="10" text-anchor="middle" font-family="JetBrains Mono,monospace">${xi}</text>`;
      }
      let ys = Math.ceil(ymin / yStep) * yStep;
      for (let yi = ys; yi <= ymax; yi += yStep) {
        const py = sy(yi);
        html += `<line x1="${mL}" y1="${py}" x2="${mR}" y2="${py}" stroke="rgba(255,255,255,0.04)" stroke-width="1"/>`;
        html += `<text x="${mL-6}" y="${py+4}" fill="#555" font-size="10" text-anchor="end" font-family="JetBrains Mono,monospace">${yi.toFixed(0)}</text>`;
      }
      /* zero lines */
      if (ymin <= 0 && ymax >= 0) {
        const py0 = sy(0);
        html += `<line x1="${mL}" y1="${py0}" x2="${mR}" y2="${py0}" stroke="rgba(255,255,255,0.15)" stroke-width="1"/>`;
      }
      if (xmin <= 0 && xmax >= 0) {
        const px0 = sx(0);
        html += `<line x1="${px0}" y1="${mT}" x2="${px0}" y2="${mB}" stroke="rgba(255,255,255,0.15)" stroke-width="1"/>`;
      }
      return html;
    }

    function render(svgEl, xVal, showTangent) {
      if (!expr) { svgEl.innerHTML = `<text x="50%" y="50%" fill="#f66" text-anchor="middle" font-size="13">Función no válida</text>`; return; }
      const vb = svgEl.getAttribute("viewBox").split(" ");
      const W  = +vb[2] || 900, H = +vb[3] || 380;
      const mL = 56, mR = W - 24, mT = 24, mB = H - 32;
      const pW = mR - mL, pH = mB - mT;
      const sx = x => mL + (x - xmin) / (xmax - xmin) * pW;
      const sy = y => mB - (y - ymin) / (ymax - ymin) * pH;

      let d = "", prevY = null;
      const step = (xmax - xmin) / 900;
      for (let xi = xmin; xi <= xmax; xi += step) {
        const y = evalF(expr, xi);
        if (isNaN(y)) { prevY = null; continue; }
        const py = sy(y);
        if (py < mT - 30 || py > mB + 30) { prevY = null; continue; }
        if (prevY === null || Math.abs(y - prevY) > (ymax - ymin) * 1.2)
          d += "M" + sx(xi).toFixed(1) + " " + py.toFixed(1);
        else
          d += "L" + sx(xi).toFixed(1) + " " + py.toFixed(1);
        prevY = y;
      }

      const yVal = evalF(expr, xVal);
      const mVal = deriv(xVal);
      let tang = "", point = "";

      if (showTangent && isFinite(mVal) && isFinite(yVal)) {
        const dx = (xmax - xmin) * 0.16;
        tang = `<line x1="${sx(xVal-dx).toFixed(1)}" y1="${sy(yVal-mVal*dx).toFixed(1)}"
                      x2="${sx(xVal+dx).toFixed(1)}" y2="${sy(yVal+mVal*dx).toFixed(1)}"
                      stroke="#ff3cac" stroke-width="2.2" stroke-dasharray="5,3" opacity="0.9"/>`;
      }
      if (isFinite(yVal)) {
        point = `<circle cx="${sx(xVal).toFixed(1)}" cy="${sy(yVal).toFixed(1)}" r="7"
                  fill="#ff3cac" stroke="rgba(255,255,255,0.5)" stroke-width="1.5"/>`;
      }

      svgEl.innerHTML = axesFor(W, H, mL, mR, mT, mB) +
        `<path d="${d}" stroke="#00e5ff" stroke-width="2.5" fill="none" stroke-linecap="round"/>` +
        tang + point;
    }

    function updateInfo() {
      const x  = parseFloat(slider.value);
      xDisp.textContent = x.toFixed(2);
      const y  = expr ? evalF(expr, x) : NaN;
      const m  = expr ? deriv(x) : NaN;
      infoPanel.textContent =
        "x = " + x.toFixed(2) + "   |   " +
        "f(x) = " + (isNaN(y) ? "—" : y.toFixed(3)) + "   |   " +
        "f\'(x) ≈ " + (isNaN(m) ? "—" : m.toFixed(3));
    }

    function renderAll() {
      const x = parseFloat(slider.value);
      render(mainSVG, x, showTangentCB.checked);
      if (modalOpen) render(modalSVG, x, showTangentCB.checked);
    }

    function load() {
      const raw = funcInput.value.trim();
      if (!raw) return;
      expr = raw;
      autoY();
      updateInfo();
      renderAll();
    }

    document.getElementById("actualizarFunc").addEventListener("click", load);
    slider.addEventListener("input", () => { updateInfo(); renderAll(); });
    showTangentCB.addEventListener("change", renderAll);
    document.getElementById("resetViewBtn").addEventListener("click",  () => { xmin=-4; xmax=4; autoY(); renderAll(); });
    document.getElementById("autoScaleBtn").addEventListener("click",  () => { autoY(); renderAll(); });

    mainSVG.addEventListener("click", () => {
      modal.style.display = "flex"; modalOpen = true;
      modalSVG.setAttribute("viewBox", "0 0 1000 560");
      render(modalSVG, parseFloat(slider.value), showTangentCB.checked);
    });
    closeBtn.addEventListener("click",   () => { modal.style.display = "none"; modalOpen = false; });
    modal.addEventListener("click",      e  => { if (e.target === modal) { modal.style.display = "none"; modalOpen = false; } });
    document.addEventListener("keydown", e  => { if (e.key === "Escape") { modal.style.display = "none"; modalOpen = false; } });

    /* keypad */
    document.getElementById("keypad").addEventListener("click", e => {
      const btn = e.target.closest("button[data-val]");
      if (!btn) return;
      const v = btn.dataset.val;
      funcInput.focus();
      if (v === " ") funcInput.value = "";
      else funcInput.value += v;
    });

    load();
  })();

  /* ── ERROR ITEMS keyboard ─────────────────── */
  document.querySelectorAll(".error-item").forEach(el => {
    el.addEventListener("keydown", e => { if (e.key === "Enter" || e.key === " ") el.classList.toggle("expandido"); });
    el.addEventListener("click",   () => el.classList.toggle("expandido"));
  });

  /* ── SCROLL REVEAL ────────────────────────── */
  const obs = new IntersectionObserver(entries => {
    entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add("visible"); obs.unobserve(e.target); } });
  }, { threshold: 0.06, rootMargin: "0px 0px -20px 0px" });
  document.querySelectorAll(".reveal").forEach(el => obs.observe(el));

  /* ── QUIZ ─────────────────────────────────── */
  const answers = {
    q1: { correct: "b", exp: "La derivada en un punto es la pendiente de la recta tangente: razón de cambio instantánea." },
    q2: { correct: "b", exp: "Si f\'(x) < 0 la función desciende (decrece) en ese intervalo." },
    q3: { correct: "b", exp: "La derivada de cualquier constante es 0 — no varía." },
    q4: { correct: "a", exp: "Regla de la potencia: d/dx[5x⁴] = 5·4·x³ = 20x³." },
    q5: { correct: "a", exp: "d/dx[sen x] = cos x. Derivada trigonométrica fundamental." },
    q6: { correct: "b", exp: "v(t)=s\'(t)=2t+2; en t=3 → v=2(3)+2=8." }
  };

  const resources = {
    repaso: [
      { title: "Guía rápida de derivadas básicas",      url: "#" },
      { title: "Video: Conceptos clave de la derivada", url: "#" },
      { title: "Cuaderno de ejercicios resueltos",      url: "#" }
    ],
    normal: [
      { title: "Ejercicios de aplicación en física",       url: "#" },
      { title: "Problemas de economía con derivadas",      url: "#" },
      { title: "Mini-proyecto: modelado de movimiento",    url: "#" }
    ],
    reto: [
      { title: "Reto: derivadas de funciones compuestas",   url: "#" },
      { title: "Optimización con derivadas",                url: "#" },
      { title: "Derivadas implícitas y paramétricas",       url: "#" }
    ]
  };

  const nextSlugs = {
    repaso: "derivadas-basicas-pendientes-dominio",
    normal: "puntos-criticos-maximos-minimos",
    reto:   "derivadas-implicitas-o-avanzadas"
  };

  const tutorMsg = (score) => {
    if (score <= 3) return "Necesitas repasar con profundidad. Revisa cada explicación, enfócate en las fórmulas y practica 12 ejercicios adicionales. Intenta explicar cada paso con tus propias palabras.";
    if (score <= 5) return "Buen progreso. Repasa las preguntas incorrectas, contrasta con las soluciones y crea un mapa mental de las reglas de derivación.";
    return "Excelente desempeño. Avanza a retos con derivadas compuestas y busca problemas de aplicación real en física y economía.";
  };

  const mode = s => s <= 3 ? "repaso" : s <= 5 ? "normal" : "reto";

  const resList = r => r.length
    ? \'<ul class="resource-list">\' + r.map(x => `<li><a href="${x.url}" target="_blank" rel="noopener">${x.title}</a></li>`).join("") + "</ul>"
    : "";

  const pathMsg = m =>
    m === "repaso" ? "Regresa a los fundamentos, usa la sección de Errores frecuentes y vuelve a intentar la autoevaluación."
    : m === "normal" ? "Aborda ejercicios extra de aplicaciones reales y vuelve al simulador con funciones no lineales."
    : "¡Acepta el reto! Avanza a lecciones de máximos/mínimos y derivadas implícitas.";

  document.getElementById("corregirQuiz").addEventListener("click", () => {
    let score = 0;
    let items = "";
    for (let i = 1; i <= 6; i++) {
      const k   = "q" + i;
      const sel = document.querySelector(`input[name="${k}"]:checked`);
      const ok  = sel && sel.value === answers[k].correct;
      if (ok) score++;
      const ua = sel ? sel.value.toUpperCase() : "—";
      const ca = answers[k].correct.toUpperCase();
      items += `<li class="quiz-result-item">
        <strong>Pregunta ${i}</strong>
        <span class="quiz-result-status ${ok ? "correct" : "wrong"}">${ok ? "✔ Correcta" : "✗ Incorrecta"}</span><br>
        Tu respuesta: <strong>${ua}</strong> &nbsp;·&nbsp; Correcta: <strong>${ca}</strong><br>
        <span class="quiz-result-explanation">${answers[k].exp}</span>
      </li>`;
      document.querySelectorAll(`input[name="${k}"]`).forEach(r => {
        const lbl = r.closest("label");
        if (!lbl) return;
        lbl.classList.remove("correct","wrong");
        if (r.value === answers[k].correct) lbl.classList.add("correct");
        else if (r.checked)                 lbl.classList.add("wrong");
      });
    }

    const m = mode(score);
    const emoji = score === 6 ? "🏆" : score >= 4 ? "🎯" : "📚";

    const feedback = document.getElementById("quizFeedback");
    feedback.innerHTML = `
      <h4>${emoji} Puntaje: ${score} / 6 — ${score===6?"¡Perfecto!":score>=4?"Buen trabajo":"Sigue practicando"}</h4>
      <ul>${items}</ul>
      <div class="adaptive-summary">
        <strong>Modo adaptativo:</strong> ${m.toUpperCase()} —
        ${pathMsg(m)}
      </div>
      <div class="recommended-resources">
        <h4>🔗 Recursos recomendados</h4>
        ${resList(resources[m])}
      </div>
      <div class="ai-tutor">
        <h4>🤖 Tutor AI</h4>
        <p>${tutorMsg(score)}</p>
        <button id="aiBtn" class="btn-small">Ver consejos detallados</button>
        <div id="aiExt" style="display:none" class="ai-extended">
          <ul>
            <li>Identifica y anota los errores conceptuales de tus respuestas incorrectas.</li>
            <li>Reformula cada explicación con un ejemplo propio diferente al del enunciado.</li>
            <li>Aplica las reglas de derivación a un problema adicional y verifica paso a paso.</li>
          </ul>
        </div>
      </div>
      <div class="next-path">
        <button id="nextBtn" class="btn-primary">Continuar →</button>
      </div>
    `;
    feedback.style.display = "block";

    document.getElementById("aiBtn").addEventListener("click", () => {
      const d = document.getElementById("aiExt");
      d.style.display = d.style.display === "none" ? "block" : "none";
    });
    document.getElementById("nextBtn").addEventListener("click", () => {
      window.location.href = `leccion_detalle.php?slug=${encodeURIComponent(nextSlugs[m])}`;
    });

    feedback.scrollIntoView({ behavior: "smooth", block: "nearest" });

    /* guardar progreso */
    const slug  = new URLSearchParams(window.location.search).get("slug") || (window.LC_LECCION_SLUG || "");
    const xp    = Math.min(100, Math.round((score / 6) * 50 + 10));
    if (slug && window.LC_CSRF_TOKEN) {
      fetch("update_progress.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: new URLSearchParams({ slug, correctas: score, xp, csrf_token: window.LC_CSRF_TOKEN })
      }).catch(console.error);
    }
  });

})();
</script>',
    'quiz' => 
    array (
      0 => 
      array (
        'pregunta' => '¿Cuál es la derivada de una función constante \\( f(x)=c \\)?',
        'opciones' => 
        array (
          0 => 'c',
          1 => '1',
          2 => '0',
          3 => 'Indefinida',
        ),
        'correcta' => '0',
      ),
      1 => 
      array (
        'pregunta' => 'Regla de la potencia: ¿derivada de \\( x^n \\)?',
        'opciones' => 
        array (
          0 => '\\( x^{n+1} \\)',
          1 => '\\( n x^{n-1} \\)',
          2 => '\\( nx^n \\)',
          3 => '\\( x^n/n \\)',
        ),
        'correcta' => '\\( n x^{n-1} \\)',
      ),
      2 => 
      array (
        'pregunta' => 'Interpretación geométrica: ¿qué representa \\( f\'(a) \\)?',
        'opciones' => 
        array (
          0 => 'Área bajo la curva',
          1 => 'Concavidad',
          2 => 'Pendiente de la tangente',
          3 => 'Valor de la función',
        ),
        'correcta' => 'Pendiente de la tangente',
      ),
      3 => 
      array (
        'pregunta' => 'Dominio natural de cualquier polinomio:',
        'opciones' => 
        array (
          0 => '\\( \\mathbb{R}^+ \\)',
          1 => '\\( \\mathbb{Z} \\)',
          2 => '\\( \\mathbb{R} \\)',
          3 => 'Depende del grado',
        ),
        'correcta' => '\\( \\mathbb{R} \\)',
      ),
      4 => 
      array (
        'pregunta' => 'Si \\( f\'(x) > 0 \\) en un intervalo, entonces \\( f \\):',
        'opciones' => 
        array (
          0 => 'Es constante',
          1 => 'Es decreciente',
          2 => 'Es creciente',
          3 => 'Tiene un máximo',
        ),
        'correcta' => 'Es creciente',
      ),
      5 => 
      array (
        'pregunta' => 'Derivada de \\( f(x)=5x^4 - 3x^2 + 7 \\)',
        'opciones' => 
        array (
          0 => '\\( 20x^3 - 6x \\)',
          1 => '\\( 20x^3 + 6x \\)',
          2 => '\\( 5x^3 - 3x \\)',
          3 => '\\( 20x^4 - 3x \\)',
        ),
        'correcta' => '\\( 20x^3 - 6x \\)',
      ),
      6 => 
      array (
        'pregunta' => 'Derivada de \\( g(x) = -2x^6 + 4x \\)',
        'opciones' => 
        array (
          0 => '\\( -12x^5 + 4 \\)',
          1 => '\\( -12x^5 \\)',
          2 => '\\( -2x^5 + 4 \\)',
          3 => '\\( 12x^5 + 4x \\)',
        ),
        'correcta' => '\\( -12x^5 + 4 \\)',
      ),
      7 => 
      array (
        'pregunta' => 'Pendiente de \\( f(x) = x^3 - 6x + 1 \\) en \\( x=2 \\)',
        'opciones' => 
        array (
          0 => '0',
          1 => '6',
          2 => '12',
          3 => '-6',
        ),
        'correcta' => '6',
      ),
      8 => 
      array (
        'pregunta' => 'Derivada usando regla del producto: \\( h(x)=(3x^2 - 1)(2x + 5) \\)',
        'opciones' => 
        array (
          0 => '\\( 18x^2 + 12x - 10 \\)',
          1 => '\\( 6x^2 + 15x - 2 \\)',
          2 => '\\( 12x + 15 \\)',
          3 => '\\( 18x^2 - 10 \\)',
        ),
        'correcta' => '\\( 18x^2 + 12x - 10 \\)',
      ),
      9 => 
      array (
        'pregunta' => 'Derivada de \\( p(x)=4(x^3 - 2x)^2 \\) (forma correcta)',
        'opciones' => 
        array (
          0 => '\\( 4(6x^2 - 4x) \\)',
          1 => '\\( 24x^2 - 16x \\)',
          2 => '\\( 8(x^3 - 2x)(3x^2 - 2) \\)',
          3 => 'Ambas formas son equivalentes',
        ),
        'correcta' => 'Ambas formas son equivalentes',
      ),
      10 => 
      array (
        'pregunta' => 'Si \\( s(t)=3t^2 - 4t + 1 \\), ¿cuál es su velocidad?',
        'opciones' => 
        array (
          0 => '\\( 3t - 4 \\)',
          1 => '\\( 6t - 4 \\)',
          2 => '\\( 3t^2 - 4t \\)',
          3 => '\\( 6t \\)',
        ),
        'correcta' => '\\( 6t - 4 \\)',
      ),
      11 => 
      array (
        'pregunta' => 'En economía, la derivada de \\( C(x) \\) (costo total) se interpreta como:',
        'opciones' => 
        array (
          0 => 'Costo fijo',
          1 => 'Costo medio',
          2 => 'Costo marginal',
          3 => 'Ingreso total',
        ),
        'correcta' => 'Costo marginal',
      ),
      12 => 
      array (
        'pregunta' => 'Si \\( f\'(x)=0 \\) en todo un intervalo, \\( f \\) es:',
        'opciones' => 
        array (
          0 => 'Creciente',
          1 => 'Decreciente',
          2 => 'Constante',
          3 => 'No diferenciable',
        ),
        'correcta' => 'Constante',
      ),
      13 => 
      array (
        'pregunta' => 'Puntos donde la tangente es horizontal para \\( f(x) = x^3 - 3x \\):',
        'opciones' => 
        array (
          0 => '\\( x=0 \\)',
          1 => '\\( x=1 \\)',
          2 => '\\( x=-1 \\)',
          3 => ' \\( x=1 \\) y \\( x=-1 \\)',
        ),
        'correcta' => ' \\( x=1 \\) y \\( x=-1 \\)',
      ),
      14 => 
      array (
        'pregunta' => 'Derivada de \\( f(x)=8 \\)',
        'opciones' => 
        array (
          0 => '8',
          1 => '0',
          2 => 'Indefinida',
          3 => 'No existe',
        ),
        'correcta' => '0',
      ),
      15 => 
      array (
        'pregunta' => 'Derivada de \\( f(x)=x \\)',
        'opciones' => 
        array (
          0 => '0',
          1 => '1',
          2 => '\\( x^0 \\)',
          3 => 'Todas las anteriores',
        ),
        'correcta' => 'Todas las anteriores',
      ),
      16 => 
      array (
        'pregunta' => 'Derivada de \\( k(x)=(x^2 + 2)(3x - 1) + 5x \\)',
        'opciones' => 
        array (
          0 => '\\( 9x^2 + 8x - 2 \\)',
          1 => '\\( 9x^2 - 2 \\)',
          2 => '\\( 6x + 5 \\)',
          3 => '\\( 9x^2 + 5 \\)',
        ),
        'correcta' => '\\( 9x^2 + 8x - 2 \\)',
      ),
      17 => 
      array (
        'pregunta' => 'Si \\( f(x) = x^4 - 4x^3 + 2 \\), ¿en cuántos puntos de [0,3] la tangente es horizontal?',
        'opciones' => 
        array (
          0 => 'Ninguno',
          1 => 'Uno',
          2 => 'Dos',
          3 => 'Tres',
        ),
        'correcta' => 'Dos',
      ),
      18 => 
      array (
        'pregunta' => 'Afirmación: \'La derivada de un polinomio es otro polinomio\' — ¿cierto o falso?',
        'opciones' => 
        array (
          0 => 'Cierto',
          1 => 'Falso',
        ),
        'correcta' => 'Cierto',
      ),
      19 => 
      array (
        'pregunta' => 'La derivada de segundo orden de \\( f(x)=2x^3 - 3x^2 + x \\) es:',
        'opciones' => 
        array (
          0 => '\\( 12x - 6 \\)',
          1 => '\\( 12x + 1 \\)',
          2 => '\\( 6x^2 - 6x + 1 \\)',
          3 => '\\( 6x - 6 \\)',
        ),
        'correcta' => '\\( 12x - 6 \\)',
      ),
    ),
  ),
  1 => 
  array (
    'materia' => 'Pensamiento Matemático III',
    'slug' => 'puntos-criticos-maximos-minimos',
    'titulo' => 'Puntos Críticos: Máximos y Mínimos Locales – Prueba de la Primera Derivada',
    'contenido' => '<body>
    <!-- BACKGROUNDS -->
    <div class="grid-bg"></div>
    <div class="bg-orb bg-orb-1"></div>
    <div class="bg-orb bg-orb-2"></div>
    <div class="bg-orb bg-orb-3"></div>

    <!-- HEADER -->
    <header class="site-header">
      <span class="logo-text">LC-ADVANCE</span>
      <nav class="header-nav">
        <a class="nav-badge" href="#teoria">TEORÍA</a>
        <a class="nav-badge" href="#simulador">SIMULADOR</a>
        <a class="nav-badge" href="#practica">PRÁCTICA</a>
        <a class="nav-badge active" href="#quiz">QUIZ</a>
      </nav>
    </header>

    <!-- BARRA DE PROGRESO -->
    <div class="progress-bar-wrap">
      <div class="progress-bar-fill" id="progressBar"></div>
    </div>

    <!-- CONTENIDO -->
    <div class="leccion-wrap">
      <!-- ─── HERO ─── -->
      <div class="leccion-hero reveal">
        <div class="hero-badges">
          <span class="hero-badge badge-mat"
            >📐 Pensamiento Matemático III</span
          >
          <span class="hero-badge badge-lvl">⚡ Avanzado</span>
          <span class="hero-badge badge-time">⏱ 50 min</span>
        </div>
        <h1 class="hero-title">
          Puntos Críticos<br />Máximos &amp; Mínimos Locales
        </h1>
        <p class="hero-subtitle">
          Prueba de la primera y segunda derivada · Análisis completo de
          comportamiento
        </p>
        <div class="hero-stats">
          <div class="hero-stat">
            <span class="hero-stat-num">3</span
            ><span class="hero-stat-label">Tests interactivos</span>
          </div>
          <div class="hero-stat">
            <span class="hero-stat-num">2</span
            ><span class="hero-stat-label">Simuladores</span>
          </div>
          <div class="hero-stat">
            <span class="hero-stat-num">8</span
            ><span class="hero-stat-label">Secciones</span>
          </div>
        </div>
      </div>

      <!-- ─── OBJETIVOS ─── -->
      <div class="obj-grid reveal">
        <div class="obj-card">
          <div class="obj-icon">🎯</div>
          <div class="obj-text">
            <h4>Definir puntos críticos</h4>
            <p>Identificar donde f\'(x) es cero o no existe.</p>
          </div>
        </div>
        <div class="obj-card">
          <div class="obj-icon">🔍</div>
          <div class="obj-text">
            <h4>Prueba 1ª Derivada</h4>
            <p>Clasificar extremos analizando cambio de signo.</p>
          </div>
        </div>
        <div class="obj-card">
          <div class="obj-icon">🧮</div>
          <div class="obj-text">
            <h4>Prueba 2ª Derivada</h4>
            <p>Confirmar naturaleza del punto con concavidad.</p>
          </div>
        </div>
        <div class="obj-card">
          <div class="obj-icon">📊</div>
          <div class="obj-text">
            <h4>Optimización real</h4>
            <p>Aplicar los hallazgos a problemas del mundo.</p>
          </div>
        </div>
      </div>

      <!-- ─── CONTEXTO ─── -->
      <section class="seccion reveal" id="contexto">
        <h2 class="seccion-titulo">
          <span class="titulo-icon">🌍</span> ¿Por qué importa?
        </h2>
        <div class="context-card">
          <p>
            En ingeniería, economía y ciencias, encontrar el "punto óptimo"
            —máximo o mínimo— es vital. Desde maximizar el volumen de un empaque
            con el mínimo material, hasta encontrar la velocidad máxima de un
            motor, o la tarifa que maximiza ingresos en una empresa.
          </p>
          <p>
            Los puntos críticos son la puerta de entrada a todos estos
            problemas.
          </p>
          <div class="real-data">
            <span class="data-tag">#Eficiencia</span>
            <span class="data-tag">#Ingeniería</span>
            <span class="data-tag">#Economía</span>
            <span class="data-tag">#Física</span>
          </div>
        </div>
      </section>

      <!-- ─── TEORÍA ─── -->
      <section class="seccion reveal" id="teoria">
        <h2 class="seccion-titulo">
          <span class="titulo-icon">📚</span> Fundamentos Teóricos
        </h2>

        <div class="definicion">
          <strong>Definición:</strong> Un número $c$ en el dominio de $f$ es un
          <em>punto crítico</em> si $f\'(c) = 0$ o si $f\'(c)$ no existe. El valor
          $f(c)$ es el <em>valor crítico</em>.
        </div>

        <div class="concept-grid">
          <div class="concept-card">
            <h3>🔻 Puntos Críticos</h3>
            <p>Se obtienen de la derivada $f\'(x)$. Hay dos tipos:</p>
            <ul>
              <li>$f\'(c) = 0$ → Tangente horizontal</li>
              <li>$f\'(c)$ no existe → Cúspide/vértice</li>
            </ul>
            <div class="importante">
              ⚠️ Todo extremo local es un punto crítico, pero NO todo punto
              crítico es un extremo.
            </div>
          </div>
          <div class="concept-card">
            <h3>📈 Crecimiento &amp; Decrecimiento</h3>
            <p>El <em>signo de f\'(x)</em> determina el comportamiento:</p>
            <ul>
              <li>$f\'(x) > 0 \\Rightarrow$ función creciente ↑</li>
              <li>$f\'(x) < 0 \\Rightarrow$ función decreciente ↓</li>
              <li>$f\'(x) = 0 \\Rightarrow$ estacionario →</li>
            </ul>
          </div>
        </div>

        <h3 class="h3-section">Criterio de la Primera Derivada</h3>
        <div class="tabla-wrap">
          <table class="tabla-signos">
            <thead>
              <tr>
                <th>Signo de f\'(x) ANTES de c</th>
                <th>Signo de f\'(x) DESPUÉS de c</th>
                <th>Clasificación</th>
              </tr>
            </thead>
            <tbody>
              <tr class="max">
                <td>$(+)$ — Creciente</td>
                <td>$(-)$ — Decreciente</td>
                <td>🔴 MÁXIMO LOCAL</td>
              </tr>
              <tr class="min">
                <td>$(-)$ — Decreciente</td>
                <td>$(+)$ — Creciente</td>
                <td>🟢 MÍNIMO LOCAL</td>
              </tr>
              <tr class="infl">
                <td>$(+)$ o $(-)$</td>
                <td>Mismo signo</td>
                <td>🟡 INFLEXIÓN (no es extremo)</td>
              </tr>
            </tbody>
          </table>
        </div>

        <!-- SIGNO CHART INTERACTIVO -->
        <div class="sign-chart-wrap">
          <p class="sign-chart-title">
            Diagrama de signo interactivo — Haz clic en los segmentos
          </p>
          <div class="sign-chart" id="signChart">
            <!-- Generado por JS -->
          </div>
          <p
            style="
              font-family: var(--font-mono);
              font-size: 11px;
              color: var(--muted);
              margin-top: 12px;
            "
            id="signChartMsg"
          >
            Haz clic en los segmentos para cambiar el signo de f\'(x) y ver qué
            tipo de punto se clasifica.
          </p>
        </div>
      </section>

      <!-- ─── SEGUNDA DERIVADA ─── -->
      <section class="seccion reveal" id="segunda-derivada">
        <h2 class="seccion-titulo">
          <span class="titulo-icon">🔬</span> Criterio de la Segunda Derivada
        </h2>
        <p>
          Una forma alternativa y muchas veces más rápida de clasificar puntos
          críticos es usar la segunda derivada $f\'\'(x)$. Solo funciona cuando
          <em>f\'\'(c) ≠ 0</em>.
        </p>

        <div class="dualtest-grid">
          <div class="dualtest-card max">
            <h4>🔴 MÁXIMO LOCAL</h4>
            <p style="font-size: 14px; color: var(--muted)">
              Si $f\'(c)=0$ y $f\'\'(c) < 0$:
            </p>
            <p
              style="
                font-size: 13px;
                color: rgba(220, 240, 255, 0.7);
                margin-top: 8px;
              "
            >
              La función es <strong>cóncava hacia abajo</strong> en $c$, como el
              tope de una colina.
            </p>
            <div style="text-align: center; padding: 10px; font-size: 22px">
              $f\'\'(c) < 0$ → ∩
            </div>
          </div>
          <div class="dualtest-card min">
            <h4>🟢 MÍNIMO LOCAL</h4>
            <p style="font-size: 14px; color: var(--muted)">
              Si $f\'(c)=0$ y $f\'\'(c) > 0$:
            </p>
            <p
              style="
                font-size: 13px;
                color: rgba(220, 240, 255, 0.7);
                margin-top: 8px;
              "
            >
              La función es <strong>cóncava hacia arriba</strong> en $c$, como
              el fondo de un valle.
            </p>
            <div style="text-align: center; padding: 10px; font-size: 22px">
              $f\'\'(c) > 0$ → ∪
            </div>
          </div>
        </div>

        <div class="importante" style="margin-top: 12px">
          ⚠️ Si $f\'\'(c) = 0$, la prueba no es concluyente. Debes regresar a la
          prueba de la primera derivada.
        </div>

        <!-- MINI APP SEGUNDA DERIVADA -->
        <div class="sd-tester">
          <h4>🧪 Probador de Criterio: Segunda Derivada</h4>
          <p style="font-size: 13px; color: var(--muted); margin-bottom: 14px">
            Ingresa la función y el punto crítico para ver el análisis
            automático.
          </p>
          <div class="sd-row">
            <label>f(x) =</label>
            <input class="sd-input" id="sdFunc" value="x**3 - 3*x" />
            <label>c =</label>
            <input
              class="sd-input"
              id="sdPoint"
              value="1"
              style="width: 80px"
            />
            <button class="btn-sd-test" onclick="runSD()">ANALIZAR</button>
          </div>
          <div class="sd-result" id="sdResult" style="display: none"></div>
        </div>
      </section>

      <!-- ─── CASOS ESPECIALES ─── -->
      <section class="seccion reveal" id="casos">
        <h2 class="seccion-titulo">
          <span class="titulo-icon">🧪</span> Casos Especiales
        </h2>
        <div class="concept-grid">
          <div class="concept-card alerta">
            <h3>⚠️ f(x) = x³ en x=0</h3>
            <p>
              $f\'(0)=0$, punto crítico. Sin embargo, $f\'(x)$ es siempre positiva
              a ambos lados.
              <strong>No hay cambio de signo → NO es extremo</strong>. Es un
              punto de inflexión horizontal.
            </p>
          </div>
          <div class="concept-card minimo">
            <h3>✅ f(x) = |x| en x=0</h3>
            <p>
              $f\'(0)$ <strong>no existe</strong> (esquina). Pero $f\'(x) < 0$
              antes y $f\'(x) > 0$ después. El criterio aplica igualmente →
              <strong>MÍNIMO</strong>.
            </p>
          </div>
          <div class="concept-card maximo">
            <h3>🔴 f(x) = −x⁴ en x=0</h3>
            <p>
              $f\'(0)=0$ y $f\'\'(0)=0$. La 2ª derivada falla. Usando 1ª: $f\'(x) >
              0$ antes, $f\'(x) < 0$ después → <strong>MÁXIMO</strong>.
            </p>
          </div>
          <div class="concept-card alerta">
            <h3>⚠️ Extremo sin punto crítico</h3>
            <p>
              En un <strong>intervalo cerrado</strong> $[a,b]$, los extremos
              absolutos pueden ocurrir en los <em>extremos del intervalo</em>,
              no solo en puntos críticos. Siempre evalúa $f(a)$ y $f(b)$.
            </p>
          </div>
        </div>
      </section>

      <!-- ─── SIMULADOR ─── -->
      <section class="seccion reveal" id="simulador">
        <h2 class="seccion-titulo">
          <span class="titulo-icon">⚡</span> Explorador de Puntos Críticos
        </h2>
        <p style="margin-bottom: 16px">
          Escribe cualquier función, ajusta el rango y mueve el mouse sobre la
          gráfica para ver valores.
        </p>

        <div class="simulator-shell">
          <!-- TOOLBAR -->
          <div class="sim-toolbar">
            <div class="sim-toolbar-left">
              <div class="sim-dots">
                <div class="sim-dot dot-red"></div>
                <div class="sim-dot dot-yellow"></div>
                <div class="sim-dot dot-green"></div>
              </div>
              <span class="sim-filename">criticos_explorer.js</span>
            </div>
            <span class="sim-status">● ACTIVO</span>
          </div>

          <!-- BODY -->
          <div class="sim-body">
            <!-- CONTROLS -->
            <div class="sim-controls">
              <div>
                <label>Función f(x) =</label>
                <input class="sim-input" id="funcInput" value="x**3 - 3*x" />
                <!-- PRESETS -->
                <div class="presets" id="presetBtns">
                  <button class="preset-btn" data-f="x**3 - 3*x">x³-3x</button>
                  <button class="preset-btn" data-f="x**4 - 2*x**2">
                    x⁴-2x²
                  </button>
                  <button class="preset-btn" data-f="Math.sin(x)">
                    sin(x)
                  </button>
                  <button class="preset-btn" data-f="Math.cos(x)">
                    cos(x)
                  </button>
                  <button class="preset-btn" data-f="x**2 * Math.exp(-x)">
                    x²e⁻ˣ
                  </button>
                  <button class="preset-btn" data-f="Math.abs(x)">|x|</button>
                  <button class="preset-btn" data-f="x**3">x³</button>
                </div>
              </div>
              <!-- KEYPAD -->
              <div>
                <label>Teclado rápido</label>
                <div class="keypad" id="simKeypad">
                  <button data-val="x">x</button>
                  <button data-val="**2">²</button>
                  <button data-val="**3">³</button>
                  <button data-val="**4">⁴</button>
                  <button data-val="Math.sin(">sin</button>
                  <button data-val="Math.cos(">cos</button>
                  <button data-val="Math.exp(">eˣ</button>
                  <button data-val="Math.sqrt(">√</button>
                  <button data-val="Math.abs(">|x|</button>
                  <button data-val="Math.log(">ln</button>
                  <button data-val="+">+</button>
                  <button data-val="-">-</button>
                  <button data-val="*">×</button>
                  <button data-val="/">/</button>
                  <button data-val="(">(</button>
                  <button data-val=")">)</button>
                  <button data-val="" class="key-clear">C</button>
                </div>
              </div>
              <!-- RANGE -->
              <div>
                <label
                  >Rango x: [<span id="xminLabel">-4</span>,
                  <span id="xmaxLabel">4</span>]</label
                >
                <div class="sim-range-row" style="margin-bottom: 6px">
                  <span
                    style="
                      font-family: var(--font-mono);
                      font-size: 10px;
                      color: var(--muted);
                      width: 30px;
                    "
                    >xₘᵢₙ</span
                  >
                  <input
                    type="range"
                    id="xminSlider"
                    min="-10"
                    max="-1"
                    value="-4"
                  />
                  <span class="sim-range-val" id="xminVal">-4</span>
                </div>
                <div class="sim-range-row">
                  <span
                    style="
                      font-family: var(--font-mono);
                      font-size: 10px;
                      color: var(--muted);
                      width: 30px;
                    "
                    >xₘₐₓ</span
                  >
                  <input
                    type="range"
                    id="xmaxSlider"
                    min="1"
                    max="10"
                    value="4"
                  />
                  <span class="sim-range-val" id="xmaxVal">4</span>
                </div>
              </div>
<!-- BTN -->
              <button class="btn-run" id="runBtn">▶ ACTUALIZAR GRÁFICA</button>

              <!-- MINI PANEL -->
              <div
                class="mt-auto"
                style="
                  background: var(--surface);
                  border: 1px solid var(--border);
                  border-radius: 8px;
                  padding: 10px;
                "
              >
                <div
                  style="
                    font-family: var(--font-mono);
                    font-size: 9px;
                    color: var(--muted);
                    letter-spacing: 1px;
                    margin-bottom: 6px;
                  "
                >
                  CURSOR
                </div>
                <div
                  id="cursorInfo"
                  style="
                    font-family: var(--font-mono);
                    font-size: 12px;
                    color: var(--cyan);
                  "
                >
                  Mueve sobre la gráfica
                </div>
              </div>
            </div>

            <!-- CANVAS -->
            <div class="sim-canvas-wrap">
              <svg id="mainSVG" viewBox="0 0 620 360"></svg>
              <div class="sim-legend">
                <div class="legend-item">
                  <div class="legend-dot maximo"></div>
                  Máximo local
                </div>
                <div class="legend-item">
                  <div class="legend-dot minimo"></div>
                  Mínimo local
                </div>
                <div class="legend-item">
                  <div class="legend-dot infl"></div>
                  Inflexión horizontal
                </div>
              </div>
            </div>
          </div>

          <!-- ANÁLISIS -->
          <div class="sim-analysis">
            <div class="analysis-title">Puntos críticos detectados</div>
            <ul class="crit-list" id="critListOutput">
              <li>Ejecuta la gráfica para ver el análisis.</li>
            </ul>
          </div>
        </div>
      </section>

      <!-- ─── PASO A PASO ─── -->
      <section class="seccion reveal" id="paso-a-paso">
        <h2 class="seccion-titulo">
          <span class="titulo-icon">🔧</span> Proceso Paso a Paso
        </h2>
        <p style="margin-bottom: 16px">
          Ejemplo completo: $f(x) = 2x^3 - 3x^2 - 12x + 7$
        </p>

        <div class="step-resolver" id="stepResolver">
          <div class="step-item">
            <div class="step-header" onclick="toggleStep(this)">
              <div class="step-num">1</div>
              <span class="step-title">Encontrar la derivada f\'(x)</span>
              <span class="step-arrow">▼</span>
            </div>
            <div class="step-body">
              Aplicamos la regla de la potencia término a término: $$f\'(x) =
              6x^2 - 6x - 12$$
              <div class="step-result">f\'(x) = 6x² - 6x - 12</div>
            </div>
          </div>
          <div class="step-item">
            <div class="step-header" onclick="toggleStep(this)">
              <div class="step-num">2</div>
              <span class="step-title">Igualar f\'(x) = 0 y resolver</span>
              <span class="step-arrow">▼</span>
            </div>
            <div class="step-body">
              $$6x^2 - 6x - 12 = 0 \\implies x^2 - x - 2 = 0 \\implies (x-2)(x+1)
              = 0$$
              <div class="step-result">Puntos críticos: x = 2 y x = −1</div>
            </div>
          </div>
          <div class="step-item">
            <div class="step-header" onclick="toggleStep(this)">
              <div class="step-num">3</div>
              <span class="step-title">Construir tabla de signos</span>
              <span class="step-arrow">▼</span>
            </div>
            <div class="step-body">
              Evaluamos $f\'(x)$ en intervalos $(-\\infty,-1)$, $(-1,2)$ y
              $(2,+\\infty)$:
              <ul
                style="
                  margin: 10px 0 0 20px;
                  font-size: 13px;
                  color: var(--muted);
                  line-height: 2;
                "
              >
                <li>$x=-2$: $f\'(-2)=6(4)+12-12=24>0$ → Creciente ↑</li>
                <li>$x=0$: $f\'(0)=-12<0$ → Decreciente ↓</li>
                <li>$x=3$: $f\'(3)=6(9)-18-12=24>0$ → Creciente ↑</li>
              </ul>
              <div class="step-result">+ | (−1) | − | (2) | +</div>
            </div>
          </div>
          <div class="step-item">
            <div class="step-header" onclick="toggleStep(this)">
              <div class="step-num">4</div>
              <span class="step-title">Clasificar los puntos críticos</span>
              <span class="step-arrow">▼</span>
            </div>
            <div class="step-body">
              Analizando cambios de signo:
              <ul
                style="
                  margin: 10px 0 0 20px;
                  font-size: 13px;
                  color: var(--muted);
                  line-height: 2;
                "
              >
                <li>
                  En $x=-1$: signo cambia de $(+)$ a $(-)$ →
                  <strong style="color: var(--pink)">MÁXIMO LOCAL</strong>
                </li>
                <li>
                  En $x=2$: signo cambia de $(-)$ a $(+)$ →
                  <strong style="color: var(--green)">MÍNIMO LOCAL</strong>
                </li>
              </ul>
              <div class="step-result">
                f(−1) = 14 (Máximo) · f(2) = −13 (Mínimo)
              </div>
            </div>
          </div>
          <div class="step-item">
            <div class="step-header" onclick="toggleStep(this)">
              <div class="step-num">5</div>
              <span class="step-title"
                >Verificar con 2ª Derivada (opcional)</span
              >
              <span class="step-arrow">▼</span>
            </div>
            <div class="step-body">
              $f\'\'(x) = 12x - 6$
              <ul
                style="
                  margin: 10px 0 0 20px;
                  font-size: 13px;
                  color: var(--muted);
                  line-height: 2;
                "
              >
                <li>
                  $f\'\'(-1) = -18 < 0$ → Cóncavo ↓ → Confirma
                  <strong style="color: var(--pink)">MÁXIMO</strong>
                </li>
                <li>
                  $f\'\'(2) = 18 > 0$ → Cóncavo ↑ → Confirma
                  <strong style="color: var(--green)">MÍNIMO</strong>
                </li>
              </ul>
              <div class="step-result">
                ✅ Ambos criterios coinciden. Análisis correcto.
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- ─── ERRORES COMUNES ─── -->
      <section class="seccion reveal" id="errores">
        <h2 class="seccion-titulo">
          <span class="titulo-icon">🛑</span> Errores Frecuentes
        </h2>
        <div class="errores-grid">
          <div class="error-card" onclick="this.classList.toggle(\'expandido\')">
            <strong>Error 1: Creer que f\'(c)=0 siempre es extremo</strong>
            <div class="error-detail">
              Recuerda $f(x)=x^3$ en $x=0$. La derivada es cero pero no hay
              cambio de signo. Siempre construye la tabla de signos o verifica
              el cambio explícitamente.
            </div>
          </div>
          <div class="error-card" onclick="this.classList.toggle(\'expandido\')">
            <strong>Error 2: Ignorar puntos donde la derivada no existe</strong>
            <div class="error-detail">
              Funciones como $f(x)=|x|$ o $f(x)=x^{2/3}$ tienen puntos críticos
              en esquinas o cúspides. Siempre verifica el dominio y los puntos
              de no-derivabilidad.
            </div>
          </div>
          <div class="error-card" onclick="this.classList.toggle(\'expandido\')">
            <strong>Error 3: Olvidar evaluar en extremos del intervalo</strong>
            <div class="error-detail">
              En problemas de intervalos cerrados $[a,b]$, el máximo o mínimo
              ABSOLUTO puede estar en $x=a$ o $x=b$, no en un punto crítico
              interior. Evalúa siempre los extremos.
            </div>
          </div>
          <div class="error-card" onclick="this.classList.toggle(\'expandido\')">
            <strong>Error 4: Usar 2ª derivada cuando f\'\'(c)=0</strong>
            <div class="error-detail">
              Si $f\'\'(c)=0$, la prueba no concluye nada. No asumir que es
              inflexión automáticamente. En ese caso, vuelve a la prueba de la
              primera derivada para determinar.
            </div>
          </div>
          <div class="error-card" onclick="this.classList.toggle(\'expandido\')">
            <strong>Error 5: No verificar que c está en el dominio</strong>
            <div class="error-detail">
              Si $f(c)$ no está definida, entonces $c$ no es un punto crítico de
              $f$. Por ejemplo, $f(x)=1/x$ tiene $f\'(x)=-1/x^2$, que nunca es
              cero, pero $x=0$ no está en el dominio.
            </div>
          </div>
        </div>
      </section>

      <!-- ─── PROBLEMAS ─── -->
      <section class="seccion reveal" id="practica">
        <h2 class="seccion-titulo">
          <span class="titulo-icon">📝</span> Problemas de Práctica
        </h2>
        <div class="problema-lista">
          <div class="problema-item">
            <h3>Problema 1 — Análisis Polinomial</h3>
            <p>
              Encuentra y clasifica todos los puntos críticos de $f(x) = 2x^3 -
              3x^2 - 12x + 7$.
            </p>
            <button
              class="btn-solucion"
              data-target="sol1"
              onclick="toggleSol(this)"
            >
              VER RESOLUCIÓN
            </button>
            <div class="solucion-box" id="sol1">
              <div class="solucion-step">
                <span class="solucion-num">①</span
                ><span>$f\'(x) = 6x^2 - 6x - 12 = 6(x-2)(x+1)$</span>
              </div>
              <div class="solucion-step">
                <span class="solucion-num">②</span
                ><span>Puntos críticos: $x=2$ y $x=-1$</span>
              </div>
              <div class="solucion-step">
                <span class="solucion-num">③</span
                ><span
                  >En $x=-1$: signo $(+)→(-)$ →
                  <strong style="color: var(--pink)">Máximo</strong>,
                  $f(-1)=14$</span
                >
              </div>
              <div class="solucion-step">
                <span class="solucion-num">④</span
                ><span
                  >En $x=2$: signo $(-)→(+)$ →
                  <strong style="color: var(--green)">Mínimo</strong>,
                  $f(2)=-13$</span
                >
              </div>
            </div>
          </div>

          <div class="problema-item">
            <h3>Problema 2 — Optimización</h3>
            <p>
              ¿Qué número positivo sumado con su recíproco da la suma mínima?
              Usa derivadas.
            </p>
            <button
              class="btn-solucion"
              data-target="sol2"
              onclick="toggleSol(this)"
            >
              VER RESOLUCIÓN
            </button>
            <div class="solucion-box" id="sol2">
              <div class="solucion-step">
                <span class="solucion-num">①</span
                ><span>Función: $S(x) = x + \\frac{1}{x}$, dominio $x > 0$</span>
              </div>
              <div class="solucion-step">
                <span class="solucion-num">②</span
                ><span>$S\'(x) = 1 - \\frac{1}{x^2} = \\frac{x^2-1}{x^2}$</span>
              </div>
              <div class="solucion-step">
                <span class="solucion-num">③</span
                ><span
                  >$S\'(x)=0 \\Rightarrow x^2=1 \\Rightarrow x=1$ (positivo)</span
                >
              </div>
              <div class="solucion-step">
                <span class="solucion-num">④</span
                ><span
                  >$S\'\'(x) = \\frac{2}{x^3}$, $S\'\'(1)=2>0$ →
                  <strong style="color: var(--green)">Mínimo</strong>. Suma
                  mínima = $1+1=2$</span
                >
              </div>
            </div>
          </div>

          <div class="problema-item">
            <h3>Problema 3 — Función Trigonométrica</h3>
            <p>
              Clasifica los puntos críticos de $f(x) = x - 2\\sin(x)$ en $[0,
              2\\pi]$.
            </p>
            <button
              class="btn-solucion"
              data-target="sol3"
              onclick="toggleSol(this)"
            >
              VER RESOLUCIÓN
            </button>
            <div class="solucion-box" id="sol3">
              <div class="solucion-step">
                <span class="solucion-num">①</span
                ><span>$f\'(x) = 1 - 2\\cos(x)$</span>
              </div>
              <div class="solucion-step">
                <span class="solucion-num">②</span
                ><span
                  >$f\'(x)=0 \\Rightarrow \\cos(x)=\\frac{1}{2} \\Rightarrow
                  x=\\frac{\\pi}{3}$ y $x=\\frac{5\\pi}{3}$</span
                >
              </div>
              <div class="solucion-step">
                <span class="solucion-num">③</span
                ><span
                  >$f\'\'(x) = 2\\sin(x)$. En $x=\\frac{\\pi}{3}$: $f\'\'=\\sqrt{3}>0$ →
                  <strong style="color: var(--green)">Mínimo</strong></span
                >
              </div>
              <div class="solucion-step">
                <span class="solucion-num">④</span
                ><span
                  >En $x=\\frac{5\\pi}{3}$: $f\'\'=-\\sqrt{3}<0$ →
                  <strong style="color: var(--pink)">Máximo</strong></span
                >
              </div>
            </div>
          </div>

          <div class="problema-item">
            <h3>Problema 4 — Caja Abierta (Optimización Clásica)</h3>
            <p>
              De una lámina cuadrada de 12 cm se recortan cuadrados iguales de
              lado $x$ en las esquinas para doblar y formar una caja abierta.
              ¿Qué valor de $x$ maximiza el volumen?
            </p>
            <button
              class="btn-solucion"
              data-target="sol4"
              onclick="toggleSol(this)"
            >
              VER RESOLUCIÓN
            </button>
            <div class="solucion-box" id="sol4">
              <div class="solucion-step">
                <span class="solucion-num">①</span
                ><span>Volumen: $V(x) = x(12-2x)^2$, dominio $0 < x < 6$</span>
              </div>
              <div class="solucion-step">
                <span class="solucion-num">②</span
                ><span
                  >$V\'(x) = (12-2x)^2 + x \\cdot 2(12-2x)(-2) = (12-2x)(12-2x-4x)
                  = (12-2x)(12-6x)$</span
                >
              </div>
              <div class="solucion-step">
                <span class="solucion-num">③</span
                ><span
                  >$V\'=0 \\Rightarrow x=6$ (fuera del dom.) o $x=2$. Solo $x=2$
                  es válido.</span
                >
              </div>
              <div class="solucion-step">
                <span class="solucion-num">④</span
                ><span
                  >$V(2)=2(8)^2=128 \\text{ cm}^3$ →
                  <strong style="color: var(--green)">MÁXIMO</strong>. El
                  volumen máximo es 128 cm³.</span
                >
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- ─── QUIZ ─── -->
      <section class="seccion reveal" id="quiz">
        <h2 class="seccion-titulo">
          <span class="titulo-icon">🧠</span> Autoevaluación
        </h2>
        <div class="quiz-container" id="quizContainer">
          <div class="quiz-pregunta">
            <p class="q-text">
              1. Si $f\'(c)=0$ y la derivada no cambia de signo en $c$, entonces
              el punto es:
            </p>
            <label
              ><input type="radio" name="q1" value="a" /> Máximo local</label
            >
            <label
              ><input type="radio" name="q1" value="b" /> Mínimo local</label
            >
            <label
              ><input type="radio" name="q1" value="c" /> Punto de inflexión
              horizontal (no extremo)</label
            >
            <label
              ><input type="radio" name="q1" value="d" /> Punto de
              discontinuidad</label
            >
          </div>

          <div class="quiz-pregunta">
            <p class="q-text">
              2. Para aplicar el criterio de la 2ª derivada, se requiere que:
            </p>
            <label
              ><input type="radio" name="q2" value="a" /> $f\'\'(c) = 0$</label
            >
            <label
              ><input type="radio" name="q2" value="b" /> $f\'(c) = 0$ y $f\'\'(c)
              \\neq 0$</label
            >
            <label
              ><input type="radio" name="q2" value="c" /> La función sea
              par</label
            >
            <label
              ><input type="radio" name="q2" value="d" /> El punto esté en un
              intervalo cerrado</label
            >
          </div>

          <div class="quiz-pregunta">
            <p class="q-text">
              3. Si $f\'(x) < 0$ antes de $c$ y $f\'(x) > 0$ después, $c$ es un:
            </p>
            <label
              ><input type="radio" name="q3" value="a" /> Máximo local</label
            >
            <label
              ><input type="radio" name="q3" value="b" /> Mínimo local</label
            >
            <label
              ><input type="radio" name="q3" value="c" /> Punto de
              inflexión</label
            >
            <label
              ><input type="radio" name="q3" value="d" /> No se puede
              clasificar</label
            >
          </div>

          <div class="quiz-pregunta">
            <p class="q-text">4. El punto $x=0$ en $f(x)=x^3$ es:</p>
            <label
              ><input type="radio" name="q4" value="a" /> Mínimo local porque
              $f(0)=0$</label
            >
            <label
              ><input type="radio" name="q4" value="b" /> Máximo local</label
            >
            <label
              ><input type="radio" name="q4" value="c" /> Un punto crítico pero
              NO es extremo (inflexión horizontal)</label
            >
            <label
              ><input type="radio" name="q4" value="d" /> No es un punto
              crítico</label
            >
          </div>

          <div class="quiz-pregunta">
            <p class="q-text">
              5. En la función $f(x)=|x|$, el punto $x=0$ es un mínimo local
              porque:
            </p>
            <label><input type="radio" name="q5" value="a" /> $f\'(0)=0$</label>
            <label
              ><input type="radio" name="q5" value="b" /> $f\'(0)$ no existe,
              pero la derivada cambia de $(-)$ a $(+)$</label
            >
            <label
              ><input type="radio" name="q5" value="c" /> $f\'\'(0) > 0$</label
            >
            <label
              ><input type="radio" name="q5" value="d" /> Es el punto más bajo
              de la función globalmente</label
            >
          </div>

          <button class="btn-evaluar" id="evalQuiz">EVALUAR RESPUESTAS</button>
        </div>

        <div class="quiz-feedback hidden" id="quizFeedback"></div>
      </section>

      <!-- ─── REFLEXIÓN ─── -->
      <section class="seccion reveal" id="reflexion">
        <h2 class="seccion-titulo">
          <span class="titulo-icon">💭</span> Reflexión Final
        </h2>
        <div class="reflexion-box">
          <p>
            ¿Una montaña rusa está llena de puntos críticos? Analiza el
            recorrido en términos de máximos, mínimos e inflexiones.
          </p>
          <textarea
            placeholder="Escribe tu análisis aquí... ¿Dónde están los máximos y mínimos? ¿Qué ocurre en los puntos de inflexión? ¿Cómo se relaciona con la velocidad?"
          ></textarea>
          <p class="sugerencia">
            💡 Piensa en los puntos más altos (máximos), los más bajos (mínimos)
            y los cambios de curvatura (inflexiones).
          </p>
        </div>
        <div class="recursos">
          <h3>🔗 Recursos Adicionales</h3>
          <ul>
            <li>
              <a href="https://www.geogebra.org/calculator" target="_blank"
                >GeoGebra — Graficador interactivo</a
              >
            </li>
            <li>
              <a href="https://www.wolframalpha.com" target="_blank"
                >Wolfram Alpha — Verificar derivadas</a
              >
            </li>
            <li>
              <a
                href="https://www.khanacademy.org/math/ap-calculus-ab"
                target="_blank"
                >Khan Academy — Cálculo AB</a
              >
            </li>
            <li>
              <a href="https://www.desmos.com/calculator" target="_blank"
                >Desmos — Graficadora visual</a
              >
            </li>
          </ul>
        </div>
      </section>
    </div>
    <!-- /leccion-wrap -->

    <!-- ============================================================
     JAVASCRIPT PRINCIPAL
     ============================================================ -->
    <script>
      (function () {
        "use strict";

        // ─── PROGRESS BAR ───────────────────────────────────────────
        const progressBar = document.getElementById("progressBar");
        function updateProgress() {
          const scrollTop = window.scrollY;
          const docHeight =
            document.documentElement.scrollHeight - window.innerHeight;
          progressBar.style.width = (scrollTop / docHeight) * 100 + "%";
        }
        window.addEventListener("scroll", updateProgress, { passive: true });

        // ─── SCROLL REVEAL ───────────────────────────────────────────
        const revealEls = document.querySelectorAll(".reveal");
        const observer = new IntersectionObserver(
          (entries) => {
            entries.forEach((e) => {
              if (e.isIntersecting) {
                e.target.classList.add("visible");
              }
            });
          },
          { threshold: 0.08 },
        );
        revealEls.forEach((el) => observer.observe(el));

        // ─── STEP RESOLVER ───────────────────────────────────────────
        window.toggleStep = function (header) {
          const item = header.parentElement;
          item.classList.toggle("open");
          // re-render MathJax
          if (item.classList.contains("open") && window.MathJax) {
            MathJax.typeset([item.querySelector(".step-body")]);
          }
        };

        // ─── TOGGLE SOLUCION ─────────────────────────────────────────
        window.toggleSol = function (btn) {
          const id = btn.getAttribute("data-target");
          const box = document.getElementById(id);
          if (!box) return;
          box.classList.toggle("visible");
          btn.textContent = box.classList.contains("visible")
            ? "OCULTAR"
            : "VER RESOLUCIÓN";
          if (box.classList.contains("visible") && window.MathJax) {
            MathJax.typeset([box]);
          }
        };

        // ─── SIGN CHART INTERACTIVO ───────────────────────────────────
        function buildSignChart() {
          const chart = document.getElementById("signChart");
          const msg = document.getElementById("signChartMsg");
          if (!chart) return;

          const critPoints = [
            { x: -1, type: "max", label: "c₁" },
            { x: 1, type: "min", label: "c₂" },
          ];
          let signs = ["pos", "neg", "pos"]; // default for illustration
          function renderChart() {
            const transitions = [
              "(-∞, c₁)",
              "c₁",
              "(c₁, c₂)",
              "c₂",
              "(c₂, +∞)",
            ];
            let html = \'<div class="sign-row">\';
            html += \'<span class="sign-row-label">f\\\'(x)</span>\';

            signs.forEach((s, i) => {
              const sym = s === "pos" ? "+" : s === "neg" ? "−" : "0";
              html += `<div class="sign-segment ${s}" onclick="toggleSignSeg(this,${i})" title="Clic para cambiar signo">${sym}</div>`;
              if (i < critPoints.length) {
                const pt = critPoints[i];
                html += `<div class="sign-point ${pt.type}-pt" title="${pt.label}">${pt.label}</div>`;
              }
            });
            html += "</div>";

            // Classification row
            html += \'<div class="sign-row" style="margin-top:8px;">\';
            html +=
              \'<span class="sign-row-label" style="font-size:10px;color:var(--muted);">tipo</span>\';

            critPoints.forEach((pt, i) => {
              const before = signs[i],
                after = signs[i + 1];
              let type, color, sym;
              if (before === "pos" && after === "neg") {
                type = "MÁXIMO";
                color = "var(--pink)";
                sym = "🔴";
              } else if (before === "neg" && after === "pos") {
                type = "MÍNIMO";
                color = "var(--green)";
                sym = "🟢";
              } else {
                type = "INFLEXIÓN";
                color = "var(--yellow)";
                sym = "🟡";
              }
              html += `<span style="flex:1;text-align:center;font-family:var(--font-mono);font-size:11px;color:${color};">${sym} ${type}</span>`;
            });
            html += "</div>";

            chart.innerHTML = html;

            // Generate message
            const types = critPoints.map((pt, i) => {
              const before = signs[i],
                after = signs[i + 1];
              if (before === "pos" && after === "neg") return "Máximo local";
              if (before === "neg" && after === "pos") return "Mínimo local";
              return "Inflexión horizontal";
            });
            msg.innerHTML = `Con esta configuración: c₁ es <strong style="color:var(--cyan);">${types[0]}</strong> y c₂ es <strong style="color:var(--cyan);">${types[1]}</strong>.`;
            if (window.MathJax) MathJax.typeset([chart, msg]);
          }

          window.toggleSignSeg = function (el, idx) {
            const map = { pos: "neg", neg: "pos" };
            signs[idx] = map[signs[idx]] || "pos";
            renderChart();
          };

          renderChart();
        }
        buildSignChart();

        // ─── EVALUACIÓN MATH ─────────────────────────────────────────
        function evalF(expr, x) {
          let e = expr
            .replace(/\\^/g, "**")
            .replace(/\\b(sin|cos|tan|exp|log|abs|sqrt)\\b/g, "Math.$1");
          try {
            return new Function("x", "return " + e)(x);
          } catch {
            return NaN;
          }
        }
        function deriv1(expr, x, h = 0.0005) {
          return (evalF(expr, x + h) - evalF(expr, x - h)) / (2 * h);
        }
        function deriv2(expr, x, h = 0.001) {
          return (
            (evalF(expr, x + h) - 2 * evalF(expr, x) + evalF(expr, x - h)) /
            (h * h)
          );
        }

        // ─── SEGUNDA DERIVADA TESTER ─────────────────────────────────
        window.runSD = function () {
          const expr = document.getElementById("sdFunc").value.trim();
          const cStr = document.getElementById("sdPoint").value.trim();
          const res = document.getElementById("sdResult");
          const c = parseFloat(cStr);
          if (isNaN(c)) {
            res.style.display = "block";
            res.innerHTML =
              \'<span style="color:var(--red)">Punto inválido.</span>\';
            return;
          }

          const fd = deriv1(expr, c);
          const fd2 = deriv2(expr, c);
          const fc = evalF(expr, c);

          let html = `<div style="margin-bottom:8px;color:var(--muted);font-size:11px;">x = ${c} | f(${c}) ≈ ${fc.toFixed(4)} | f\'(${c}) ≈ ${fd.toFixed(4)} | f\'\'(${c}) ≈ ${fd2.toFixed(4)}</div>`;

          if (Math.abs(fd) > 0.05) {
            html += `<span style="color:var(--yellow)">⚠️ x = ${c} no parece ser un punto crítico (f\' ≈ ${fd.toFixed(3)} ≠ 0). Intenta otro valor.</span>`;
          } else if (Math.abs(fd2) < 0.01) {
            html += `<span style="color:var(--yellow)">⚠️ f\'\'(${c}) ≈ 0. El criterio de la 2ª derivada no es concluyente. Usa la prueba de la 1ª derivada.</span>`;
          } else if (fd2 < 0) {
            html += `<span style="color:var(--pink)">🔴 MÁXIMO LOCAL: f\'\'(${c}) ≈ ${fd2.toFixed(3)} < 0 → Cóncavo hacia abajo.</span>`;
          } else {
            html += `<span style="color:var(--green)">🟢 MÍNIMO LOCAL: f\'\'(${c}) ≈ ${fd2.toFixed(3)} > 0 → Cóncavo hacia arriba.</span>`;
          }
          res.style.display = "block";
          res.innerHTML = html;
        };

        // ─── SIMULADOR PRINCIPAL ─────────────────────────────────────
        (function () {
          const svg = document.getElementById("mainSVG");
          const input = document.getElementById("funcInput");
          const runBtn = document.getElementById("runBtn");
          const xminSlider = document.getElementById("xminSlider");
          const xmaxSlider = document.getElementById("xmaxSlider");
          const xminVal = document.getElementById("xminVal");
          const xmaxVal = document.getElementById("xmaxVal");
          const cursorInfo = document.getElementById("cursorInfo");
          const critOut = document.getElementById("critListOutput");

          if (!svg || !input || !runBtn) return;

          const W = 620,
            H = 360,
            M = 52;
          let xmin = -4,
            xmax = 4,
            ymin = -10,
            ymax = 10;
          let currentExpr = "x**3 - 3*x";

          // Preset buttons
          document.querySelectorAll(".preset-btn").forEach((b) => {
            b.addEventListener("click", () => {
              document
                .querySelectorAll(".preset-btn")
                .forEach((x) => x.classList.remove("active"));
              b.classList.add("active");
              input.value = b.getAttribute("data-f");
              currentExpr = input.value;
              drawGraph();
            });
          });
          // Mark first preset active
          const firstPreset = document.querySelector(".preset-btn");
          if (firstPreset) firstPreset.classList.add("active");

          // Keypad
          document.querySelectorAll("#simKeypad button").forEach((b) => {
            b.addEventListener("click", () => {
              const v = b.getAttribute("data-val");
              if (v === "" || !v) {
                input.value = "";
              } else {
                input.value += v;
              }
              input.focus();
              document
                .querySelectorAll(".preset-btn")
                .forEach((x) => x.classList.remove("active"));
            });
          });

          // Range sliders
          xminSlider.addEventListener("input", () => {
            xmin = parseInt(xminSlider.value);
            xminVal.textContent = xmin;
          });
          xmaxSlider.addEventListener("input", () => {
            xmax = parseInt(xmaxSlider.value);
            xmaxVal.textContent = xmax;
          });

          runBtn.addEventListener("click", () => {
            currentExpr = input.value || "0";
            drawGraph();
          });

          function findCrits(expr, xmin, xmax) {
            const h = 0.005,
              step = 0.05;
            let crits = [];
            for (let x = xmin + 0.1; x < xmax - 0.1; x += step) {
              const d1 = deriv1(expr, x - step / 2),
                d2 = deriv1(expr, x + step / 2);
              // Zero crossing
              if (d1 * d2 < 0) {
                let a = x - step / 2,
                  b = x + step / 2;
                for (let i = 0; i < 15; i++) {
                  const m = (a + b) / 2;
                  if (deriv1(expr, a) * deriv1(expr, m) < 0) b = m;
                  else a = m;
                }
                const c = (a + b) / 2;
                const signBefore = deriv1(expr, c - 0.1) > 0 ? "pos" : "neg";
                const signAfter = deriv1(expr, c + 0.1) > 0 ? "pos" : "neg";
                let type;
                if (signBefore === "pos" && signAfter === "neg") type = "max";
                else if (signBefore === "neg" && signAfter === "pos")
                  type = "min";
                else type = "infl";
                crits.push({ x: c, type });
              }
              // Near zero (no sign change)
              else if (
                Math.abs(deriv1(expr, x)) < 0.03 &&
                Math.abs(d1) < 0.05 &&
                Math.abs(d2) < 0.05
              ) {
                const sb = deriv1(expr, x - 0.15),
                  sa = deriv1(expr, x + 0.15);
                if (Math.sign(sb) === Math.sign(sa)) {
                  crits.push({ x: x, type: "infl" });
                }
              }
            }
            // Deduplicate
            return crits.filter(
              (v, i, a) => i === 0 || Math.abs(v.x - a[i - 1].x) > 0.25,
            );
          }

          function drawGraph() {
            // Compute y range from samples
            let ys = [];
            const steps = 400;
            for (let i = 0; i <= steps; i++) {
              const x = xmin + ((xmax - xmin) * i) / steps;
              const y = evalF(currentExpr, x);
              if (isFinite(y) && !isNaN(y)) ys.push(y);
            }
            if (ys.length) {
              const mn = Math.min(...ys),
                mx = Math.max(...ys);
              const d = (mx - mn) * 0.18 || 2;
              ymin = mn - d;
              ymax = mx + d;
            }

            const sx = (x) => M + ((x - xmin) / (xmax - xmin)) * (W - M * 2);
            const sy = (y) =>
              H - M - ((y - ymin) / (ymax - ymin)) * (H - M * 2);

            // Build path
            let d = "";
            let lastGood = false;
            for (let i = 0; i <= steps; i++) {
              const x = xmin + ((xmax - xmin) * i) / steps;
              const y = evalF(currentExpr, x);
              if (isFinite(y) && !isNaN(y) && y > ymin - 5 && y < ymax + 5) {
                const px = sx(x).toFixed(1),
                  py = sy(y).toFixed(1);
                d += (lastGood ? "L" : "M") + px + " " + py;
                lastGood = true;
              } else {
                lastGood = false;
              }
            }

            // Crits
            const crits = findCrits(currentExpr, xmin, xmax);
            let pointsSVG = "";
            let listHTML = "";
            crits.forEach((c) => {
              const y = evalF(currentExpr, c.x);
              if (!isFinite(y) || isNaN(y)) return;
              const col =
                c.type === "max"
                  ? "var(--pink)"
                  : c.type === "min"
                    ? "var(--green)"
                    : "var(--yellow)";
              const px = sx(c.x),
                py = sy(y);
              pointsSVG += `<circle cx="${px.toFixed(1)}" cy="${py.toFixed(1)}" r="9" fill="${col}" stroke="rgba(255,255,255,0.8)" stroke-width="2" opacity="0.95"/>`;
              // Tooltip label
              const label =
                c.type === "max" ? "MÁX" : c.type === "min" ? "MÍN" : "INF";
              const ty = py < 50 ? py + 22 : py - 14;
              pointsSVG += `<text x="${px.toFixed(1)}" y="${ty.toFixed(1)}" fill="${col}" font-family="monospace" font-size="11" text-anchor="middle" font-weight="bold">${label}</text>`;
              const badge = `badge-${c.type === "infl" ? "infl" : c.type}`;
              listHTML += `<li>
          <span class="crit-badge ${badge}">${c.type === "max" ? "MÁXIMO" : c.type === "min" ? "MÍNIMO" : "INFLEXIÓN"}</span>
          x ≈ <strong>${c.x.toFixed(3)}</strong> | f(x) ≈ <strong>${y.toFixed(3)}</strong>
        </li>`;
            });
            if (!crits.length)
              listHTML =
                \'<li style="color:var(--muted)">No se detectaron extremos en el rango actual.</li>\';

            // Grid lines
            let grid = "";
            const gridStep = (xmax - xmin) / 8;
            for (
              let x = Math.ceil(xmin / gridStep) * gridStep;
              x <= xmax;
              x += gridStep
            ) {
              const px = sx(x).toFixed(1);
              grid += `<line x1="${px}" y1="${M}" x2="${px}" y2="${H - M}" stroke="rgba(255,255,255,0.04)"/>`;
              grid += `<text x="${px}" y="${H - M + 14}" fill="rgba(200,230,255,0.25)" font-family="monospace" font-size="9" text-anchor="middle">${x.toFixed(1)}</text>`;
            }
            const ystep = (ymax - ymin) / 6;
            for (
              let y = Math.ceil(ymin / ystep) * ystep;
              y <= ymax;
              y += ystep
            ) {
              const py = sy(y).toFixed(1);
              grid += `<line x1="${M}" y1="${py}" x2="${W - M}" y2="${py}" stroke="rgba(255,255,255,0.04)"/>`;
              grid += `<text x="${M - 5}" y="${py}" fill="rgba(200,230,255,0.25)" font-family="monospace" font-size="9" text-anchor="end" dominant-baseline="middle">${y.toFixed(1)}</text>`;
            }

            // Axes
            const axisX = Math.max(M, Math.min(H - M, sy(0)));
            const axisY = Math.max(M, Math.min(W - M, sx(0)));
            const axes = `
        <line x1="${M}" y1="${axisX}" x2="${W - M}" y2="${axisX}" stroke="rgba(255,255,255,0.15)" stroke-width="1.5"/>
        <line x1="${axisY}" y1="${M}" x2="${axisY}" y2="${H - M}" stroke="rgba(255,255,255,0.15)" stroke-width="1.5"/>
      `;

            // Cursor line (initially hidden)
            const cursorLine = `<line id="cursorLine" x1="-100" y1="${M}" x2="-100" y2="${H - M}" stroke="rgba(0,229,255,0.35)" stroke-width="1" stroke-dasharray="4 3"/>`;

            svg.innerHTML = `
        <rect width="${W}" height="${H}" fill="var(--surface2)" rx="0"/>
        ${grid}${axes}
        <path d="${d}" fill="none" stroke="var(--cyan)" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
        ${pointsSVG}
        ${cursorLine}
      `;

            critOut.innerHTML = listHTML;
            if (window.MathJax) MathJax.typeset([critOut]);
          }

          // Mouse move
          svg.addEventListener("mousemove", (e) => {
            const rect = svg.getBoundingClientRect();
            const mx = (e.clientX - rect.left) * (W / rect.width);
            const x = xmin + ((mx - M) / (W - M * 2)) * (xmax - xmin);
            if (x < xmin || x > xmax) {
              cursorInfo.textContent = "Mueve sobre la gráfica";
              return;
            }
            const y = evalF(currentExpr, x);
            const fd = deriv1(currentExpr, x);
            cursorInfo.innerHTML = `x=${x.toFixed(2)} | f(x)=${isFinite(y) ? y.toFixed(2) : "—"} | f\'(x)=${isFinite(fd) ? fd.toFixed(3) : "—"}`;
            const curLine = document.getElementById("cursorLine");
            if (curLine) {
              curLine.setAttribute("x1", mx.toFixed(1));
              curLine.setAttribute("x2", mx.toFixed(1));
            }
          });
          svg.addEventListener("mouseleave", () => {
            cursorInfo.textContent = "Mueve sobre la gráfica";
          });

          // Initial draw
          drawGraph();
        })();

        // ─── QUIZ ────────────────────────────────────────────────────
        const answers = { q1: "c", q2: "b", q3: "b", q4: "c", q5: "b" };
        const explanations = {
          q1: "Si f\'(x) no cambia de signo al cruzar c, la función no cambia de dirección. Es un punto de inflexión horizontal.",
          q2: "El criterio requiere que f\'(c)=0 para que c sea punto crítico, y f\'\'(c)≠0 para que el criterio sea concluyente.",
          q3: "Signo cambia de (−) a (+) indica que la función pasó de decrecer a crecer: mínimo local.",
          q4: "f\'(x)=3x²≥0 siempre. No hay cambio de signo en x=0. Es un punto crítico pero no es extremo.",
          q5: "En x=0 la derivada no existe (esquina). La derivada izquierda es −1 (negativa) y la derecha es +1 (positiva). Cambio (−)→(+) → mínimo.",
        };

        const evalBtn = document.getElementById("evalQuiz");
        const feedback = document.getElementById("quizFeedback");

        if (evalBtn) {
          evalBtn.addEventListener("click", () => {
            let score = 0;
            let html = "";

            for (const q in answers) {
              const selected = document.querySelector(
                `input[name="${q}"]:checked`,
              );
              const correct = answers[q];
              const ok = selected && selected.value === correct;
              if (ok) score++;

              // Style labels
              document.querySelectorAll(`input[name="${q}"]`).forEach((r) => {
                const lbl = r.parentElement;
                lbl.classList.remove("correct-ans", "wrong-ans");
                if (r.value === correct) lbl.classList.add("correct-ans");
                else if (r.checked && !ok) lbl.classList.add("wrong-ans");
              });

              const num = q.slice(1);
              const icon = ok ? "✅" : "❌";
              html += `<li>
          <strong>${icon} Pregunta ${num}:</strong> ${ok ? "Correcto" : "Incorrecto"}
          <div style="margin-top:4px;color:var(--muted);font-style:italic;">${explanations[q]}</div>
        </li>`;
            }

            const pct = Math.round((score / 5) * 100);
            const color =
              pct >= 80
                ? "var(--green)"
                : pct >= 60
                  ? "var(--yellow)"
                  : "var(--red)";
            const msg =
              pct === 100
                ? "¡Perfecto! Dominas los puntos críticos."
                : pct >= 80
                  ? "¡Excelente! Casi perfecto."
                  : pct >= 60
                    ? "Bien, pero revisa los errores."
                    : "Necesitas repasar los conceptos.";

            feedback.innerHTML = `
        <div class="quiz-score" style="color:${color};">${score}/5 — ${pct}%</div>
        <div style="text-align:center;font-size:14px;color:var(--muted);margin-bottom:16px;">${msg}</div>
        <ul>${html}</ul>
      `;
            feedback.classList.remove("hidden");
            feedback.scrollIntoView({ behavior: "smooth", block: "start" });
            if (window.MathJax) MathJax.typeset([feedback]);
          });
        }

        // ─── CONSOLE LOG EDUCATIVO ───────────────────────────────────
        console.log(
          "🚀 LC-ADVANCE | Lección: Puntos Críticos cargada correctamente",
        );
        console.log(
          "📐 Funcionalidades: Simulador, Prueba 1ª y 2ª Derivada, Sign Chart interactivo, Quiz con feedback",
        );
        console.log("⚡ Versión 2.0 — Rediseño completo 2025");
      })();
    </script>
  </body>',
    'quiz' => 
    array (
      0 => 
      array (
        'pregunta' => 'Un punto crítico ocurre cuando',
        'opciones' => 
        array (
          0 => 'f(x)=0',
          1 => 'f\'(x)=0 o no existe',
          2 => 'f\'\'(x)=0',
          3 => 'f(x)→∞',
        ),
        'correcta' => 'f\'(x)=0 o no existe',
      ),
      1 => 
      array (
        'pregunta' => 'Si f\' cambia de + a − en c, entonces es',
        'opciones' => 
        array (
          0 => 'mínimo',
          1 => 'máximo',
          2 => 'inflexión',
          3 => 'no crítico',
        ),
        'correcta' => 'máximo',
      ),
      2 => 
      array (
        'pregunta' => 'Si f\' no cambia de signo, el punto es',
        'opciones' => 
        array (
          0 => 'máximo',
          1 => 'mínimo',
          2 => 'inflexión',
          3 => 'sin clasificar',
        ),
        'correcta' => 'inflexión',
      ),
      3 => 
      array (
        'pregunta' => 'Para f(x)=x², x=0 es',
        'opciones' => 
        array (
          0 => 'máximo',
          1 => 'mínimo',
          2 => 'inflexión',
          3 => 'no crítico',
        ),
        'correcta' => 'mínimo',
      ),
      4 => 
      array (
        'pregunta' => 'Para f(x)=x³, x=0 es',
        'opciones' => 
        array (
          0 => 'máximo',
          1 => 'mínimo',
          2 => 'inflexión',
          3 => 'no crítico',
        ),
        'correcta' => 'inflexión',
      ),
      5 => 
      array (
        'pregunta' => 'En f(x)=|x|, x=0 es',
        'opciones' => 
        array (
          0 => 'máximo',
          1 => 'mínimo',
          2 => 'cúspide',
          3 => 'inflexión',
        ),
        'correcta' => 'mínimo',
      ),
      6 => 
      array (
        'pregunta' => '¿Cuántos puntos críticos tiene f(x)=x⁴?',
        'opciones' => 
        array (
          0 => '0',
          1 => '1',
          2 => '2',
          3 => '4',
        ),
        'correcta' => '1',
      ),
      7 => 
      array (
        'pregunta' => 'Si f\'>0 a ambos lados de c, c es',
        'opciones' => 
        array (
          0 => 'máximo',
          1 => 'mínimo',
          2 => 'inflexión',
          3 => 'crítico',
        ),
        'correcta' => 'inflexión',
      ),
      8 => 
      array (
        'pregunta' => 'La prueba basada en el signo de f\' se llama',
        'opciones' => 
        array (
          0 => 'segunda derivada',
          1 => 'primera derivada',
          2 => 'criterio básico',
          3 => 'test de Euler',
        ),
        'correcta' => 'primera derivada',
      ),
      9 => 
      array (
        'pregunta' => 'Un polinomio de grado n puede tener a lo sumo',
        'opciones' => 
        array (
          0 => 'n',
          1 => 'n−1',
          2 => 'n−2',
          3 => '2n',
        ),
        'correcta' => 'n−1',
      ),
      10 => 
      array (
        'pregunta' => 'x=1 en f(x)=(x−1)²(x+2) es',
        'opciones' => 
        array (
          0 => 'máximo',
          1 => 'mínimo',
          2 => 'inflexión',
          3 => 'cúspide',
        ),
        'correcta' => 'mínimo',
      ),
      11 => 
      array (
        'pregunta' => 'Máximo de sen(x) en [0,2π] ocurre en',
        'opciones' => 
        array (
          0 => '0',
          1 => 'π/2',
          2 => 'π',
          3 => '3π/2',
        ),
        'correcta' => 'π/2',
      ),
      12 => 
      array (
        'pregunta' => 'x=0 en x^{1/3} es',
        'opciones' => 
        array (
          0 => 'máximo',
          1 => 'mínimo',
          2 => 'cúspide',
          3 => 'inflexión',
        ),
        'correcta' => 'cúspide',
      ),
      13 => 
      array (
        'pregunta' => 'Si f\'<0 a la izquierda y >0 a la derecha de c',
        'opciones' => 
        array (
          0 => 'máximo',
          1 => 'mínimo',
          2 => 'inflexión',
          3 => 'no crítico',
        ),
        'correcta' => 'mínimo',
      ),
      14 => 
      array (
        'pregunta' => '¿Puede un punto crítico no ser extremo?',
        'opciones' => 
        array (
          0 => 'nunca',
          1 => 'solo en pares',
          2 => 'sí',
          3 => 'solo en cúspides',
        ),
        'correcta' => 'sí',
      ),
      15 => 
      array (
        'pregunta' => 'x=0 en e^{-x²} es',
        'opciones' => 
        array (
          0 => 'mínimo',
          1 => 'máximo global',
          2 => 'inflexión',
          3 => 'no crítico',
        ),
        'correcta' => 'máximo global',
      ),
      16 => 
      array (
        'pregunta' => '¿Cuántos mínimos tiene f(x)=(x²−1)²?',
        'opciones' => 
        array (
          0 => '0',
          1 => '1',
          2 => '2',
          3 => '3',
        ),
        'correcta' => '2',
      ),
      17 => 
      array (
        'pregunta' => 'En f(x)=x+1/x, x>0, mínimo en',
        'opciones' => 
        array (
          0 => '1',
          1 => '2',
          2 => '−1',
          3 => 'no existe',
        ),
        'correcta' => '1',
      ),
      18 => 
      array (
        'pregunta' => 'Un punto donde f\' no existe puede ser',
        'opciones' => 
        array (
          0 => 'solo máximo',
          1 => 'solo mínimo',
          2 => 'cúspide o vértice',
          3 => 'nunca extremo',
        ),
        'correcta' => 'cúspide o vértice',
      ),
      19 => 
      array (
        'pregunta' => 'x=0 en x^5 − 5x es',
        'opciones' => 
        array (
          0 => 'máximo',
          1 => 'mínimo',
          2 => 'inflexión',
          3 => 'cúspide',
        ),
        'correcta' => 'inflexión',
      ),
      20 => 
      array (
        'pregunta' => '¿Cuántos puntos críticos tiene x^6 − 15x^4 + 40?',
        'opciones' => 
        array (
          0 => '1',
          1 => '3',
          2 => '5',
          3 => '7',
        ),
        'correcta' => '5',
      ),
      21 => 
      array (
        'pregunta' => 'En f(x)=−x², x=0 es',
        'opciones' => 
        array (
          0 => 'mínimo',
          1 => 'máximo global',
          2 => 'inflexión',
          3 => 'no crítico',
        ),
        'correcta' => 'máximo global',
      ),
      22 => 
      array (
        'pregunta' => 'Si f\'(c)=0 y f\'\'(c)>0',
        'opciones' => 
        array (
          0 => 'máximo',
          1 => 'mínimo',
          2 => 'inflexión',
          3 => 'indeterminado',
        ),
        'correcta' => 'mínimo',
      ),
      23 => 
      array (
        'pregunta' => 'Un polinomio de grado 5 tiene a lo sumo',
        'opciones' => 
        array (
          0 => '3',
          1 => '4',
          2 => '5',
          3 => '6',
        ),
        'correcta' => '4',
      ),
      24 => 
      array (
        'pregunta' => '¿x=0 crítico en tan(x)? (−π/2,π/2)',
        'opciones' => 
        array (
          0 => 'sí',
          1 => 'no',
          2 => 'solo en 0',
          3 => 'indeterminado',
        ),
        'correcta' => 'no',
      ),
      25 => 
      array (
        'pregunta' => 'En √x, x=0 es',
        'opciones' => 
        array (
          0 => 'máximo',
          1 => 'mínimo',
          2 => 'cúspide',
          3 => 'no crítico',
        ),
        'correcta' => 'mínimo',
      ),
      26 => 
      array (
        'pregunta' => 'Un punto crítico donde f es continua pero no derivable puede ser',
        'opciones' => 
        array (
          0 => 'singular',
          1 => 'cúspide',
          2 => 'vértice',
          3 => 'todas',
        ),
        'correcta' => 'todas',
      ),
      27 => 
      array (
        'pregunta' => 'x=±2 en x^4 − 8x² + 16 son',
        'opciones' => 
        array (
          0 => 'mínimos',
          1 => 'máximos',
          2 => 'inflexión',
          3 => 'no críticos',
        ),
        'correcta' => 'máximos',
      ),
      28 => 
      array (
        'pregunta' => 'Cambio de signo de f\' es condición',
        'opciones' => 
        array (
          0 => 'suficiente',
          1 => 'necesaria',
          2 => 'ambas',
          3 => 'ninguna',
        ),
        'correcta' => 'suficiente',
      ),
      29 => 
      array (
        'pregunta' => '¿Cuántos máximos puede tener un cúbico?',
        'opciones' => 
        array (
          0 => '0',
          1 => '1',
          2 => '2',
          3 => '3',
        ),
        'correcta' => '1',
      ),
    ),
  ),
);
