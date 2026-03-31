# Definitive and correct repair of Puntos Criticos lesson in src/content.php
$file = 'c:\xampp\htdocs\LC-ADVANCE\src\content.php'
$contentRaw = [System.IO.File]::ReadAllText($file, [System.Text.Encoding]::UTF8)

# Find markers
$startMarker = "'titulo'  => 'Puntos Críticos: Máximos y Mínimos Locales – Prueba de la Primera Derivada',"
$endMarker = "/* =====================================" # Start of quiz pool

$startIndex = $contentRaw.IndexOf($startMarker)
if ($startIndex -eq -1) { 
    Write-Host "Error: No se encontró el inicio de la lección."; exit 1 
}
$startIndex += $startMarker.Length

$endIndex = $contentRaw.IndexOf($endMarker, $startIndex)
if ($endIndex -eq -1) { 
    Write-Host "Error: No se encontró el fin de la lección."; exit 1 
}

$before = $contentRaw.Substring(0, $startIndex)
$after = $contentRaw.Substring($endIndex)

# Correct block content (using single quote heredoc to avoid $ interpolation)
$newContent = @'

    'contenido' => <<<'HTML'
<div class="leccion-matematicas-criticos">
    <!-- CABECERA CYBERPUNK -->
    <header class="leccion-header">
        <div class="header-badges">
            <span class="materia-badge">📐 PENSAMIENTO MATEMÁTICO III</span>
            <span class="nivel-badge">⚡ AVANZADO</span>
            <span class="tiempo-badge">⏱️ 45 MIN</span>
        </div>
        <h1 class="titulo-leccion">Puntos Críticos: Máximos y Mínimos</h1>
        <p class="leccion-subtitulo">Analizando el comportamiento de las funciones mediante el cambio instantáneo</p>
    </header>

    <!-- OBJETIVOS RÁPIDOS -->
    <div class="objetivos-rapidos">
        <div class="objetivo-card">
            <div class="obj-icon">🎯</div>
            <div class="obj-text">
                <h4>Definir puntos críticos</h4>
                <p>Identificar donde f'(x) es cero o no existe.</p>
            </div>
        </div>
        <div class="objetivo-card">
            <div class="obj-icon">🔍</div>
            <div class="obj-text">
                <h4>Prueba de la 1ª Derivada</h4>
                <p>Clasificar extremos comparando signos.</p>
            </div>
        </div>
        <div class="objetivo-card">
            <div class="obj-icon">📊</div>
            <div class="obj-text">
                <h4>Optimización</h4>
                <p>Aplicar hallazgos a problemas de la vida real.</p>
            </div>
        </div>
    </div>

    <!-- CONTEXTO REAL -->
    <section>
        <h2 class="seccion-titulo">🌍 ¿Por qué importa?</h2>
        <div class="context-card">
            <p>En ingeniería y economía, encontrar el "punto óptimo" (máximo o mínimo) es vital. Desde maximizar el volumen de un empaque con el mínimo material, hasta encontrar el momento de mayor velocidad en un motor.</p>
            <div class="real-data">
                <span class="data-tag">#Eficiencia</span>
                <span class="data-tag">#Ingeniería</span>
                <span class="data-tag">#Ahorro</span>
            </div>
        </div>
    </section>

    <!-- DESARROLLO TEÓRICO -->
    <section>
        <h2 class="seccion-titulo">📚 Fundamentos Teóricos</h2>
        <div class="concept-grid">
            <div class="concept-card">
                <h3>🔻 Puntos Críticos</h3>
                <p>Un valor $c$ es crítico si $f(c)$ está definida y:</p>
                <ul>
                    <li>$f'(c) = 0$ (Tangente horizontal)</li>
                    <li>$f'(c)$ no existe (Cúspide o vértice)</li>
                </ul>
                <div class="importante">Todo extremo local es un punto crítico, pero no todo punto crítico es extremo.</div>
            </div>
            <div class="concept-card">
                <h3>📈 Crecimiento</h3>
                <p>El signo de $f'(x)$ nos dice mucho:</p>
                <ul>
                    <li>$f'(x) > 0 \Rightarrow$ La función sube (creciente).</li>
                    <li>$f'(x) < 0 \Rightarrow$ La función baja (decreciente).</li>
                </ul>
            </div>
        </div>

        <h3 style="color:var(--neon-curva); font-family:var(--font-disp); margin-top:2rem;">📉 Criterio de la Primera Derivada</h3>
        <table class="tabla-signos">
            <thead>
                <tr>
                    <th>Antes de $c$</th>
                    <th>Después de $c$</th>
                    <th>Clasificación del Punto</th>
                </tr>
            </thead>
            <tbody>
                <tr class="max">
                    <td>Derivada (+)</td>
                    <td>Derivada (-)</td>
                    <td>MÁXIMO LOCAL</td>
                </tr>
                <tr class="min">
                    <td>Derivada (-)</td>
                    <td>Derivada (+)</td>
                    <td>MÍNIMO LOCAL</td>
                </tr>
                <tr>
                    <td>Sin cambio</td>
                    <td>Sin cambio</td>
                    <td>NADA (Posible inflexión)</td>
                </tr>
            </tbody>
        </table>
    </section>

    <section>
        <h2 class="seccion-titulo">🧪 Casos Especiales</h2>
        <div class="concept-grid">
            <div class="concept-card" style="border-left-color: var(--neon-alerta);">
                <h3>⚠️ El caso de $f(x)=x^3$</h3>
                <p>En $x=0$, la derivada $f'(0)=0$. Sin embargo, la función siempre es creciente. Es un punto crítico que **no es extremo**.</p>
            </div>
            <div class="concept-card" style="border-left-color: var(--neon-min);">
                <h3>✅ El caso de $f(x)=|x|$</h3>
                <p>En $x=0$, $f'(0)$ no existe (es un pico), pero claramente hay un **mínimo**. El criterio funciona igual analizando signos de derivadas laterales.</p>
            </div>
        </div>
    </section>

    <!-- SIMULADOR INTERACTIVO -->
    <section>
        <h2 class="seccion-titulo">⚡ Explorador de Puntos Críticos</h2>
        <div class="simulator-container">
            <div class="simulator-controls">
                <label>Función $f(x) =$</label>
                <input type="text" id="funcInputCrit" value="x**3 - 3*x">
                <div class="keypad-mini">
                    <button data-val="x">x</button>
                    <button data-val="**2">²</button>
                    <button data-val="**3">³</button>
                    <button data-val="Math.sin(">sin</button>
                    <button data-val="Math.cos(">cos</button>
                    <button data-val="Math.abs(">abs</button>
                    <button data-val="+">+</button>
                    <button data-val="-">-</button>
                    <button data-val="*">*</button>
                    <button data-val="/">/</button>
                    <button data-val="(">(</button>
                    <button data-val=")">)</button>
                    <button data-val=" ">C</button>
                </div>
                <button class="btn-actualizar" id="updateGraphCrit">ACTUALIZAR GRÁFICA</button>
                
                <div class="data-panel" style="margin-top:auto;">
                    <h4>📊 Estado</h4>
                    <div id="derivInfoCrit" style="font-size:0.75rem;">x = 0.00 | f'(x) ≈ 0.00</div>
                </div>
            </div>

            <div class="simulator-visualization">
                <svg id="critSVG" viewBox="0 0 900 400"></svg>
                <div class="sim-legend">
                    <div class="legend-item"><span class="legend-dot" style="background:var(--neon-max)"></span> Máximo</div>
                    <div class="legend-item"><span class="legend-dot" style="background:var(--neon-min)"></span> Mínimo</div>
                    <div class="legend-item"><span class="legend-dot" style="background:var(--neon-crit)"></span> Crítico (Inflexión)</div>
                </div>
            </div>

            <div class="simulator-data" style="grid-column: 1 / -1;">
                <div class="data-panel" id="critListPanel">
                    <h4>🔍 Análisis de Puntos Críticos</h4>
                    <ul id="critLabelsList">
                        <li>Cargando análisis...</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- ERRORES COMUNES -->
    <section>
        <h2 class="seccion-titulo">🛑 Errores Frecuentes</h2>
        <div class="errores-grid">
            <div class="error-card">
                <strong>Creer que f'(c)=0 siempre es extremo</strong>
                <div class="error-detail">Recuerda a $x^3$. Debes verificar el cambio de signo de la derivada.</div>
            </div>
            <div class="error-card">
                <strong>Ignorar donde la derivada no existe</strong>
                <div class="error-detail">Funciones como $|x|$ tienen extremos en puntos donde no hay derivada definida.</div>
            </div>
            <div class="error-card">
                <strong>No evaluar el dominio original</strong>
                <div class="error-detail">Un punto crítico debe pertenecer al dominio de la función original para ser considerado.</div>
            </div>
        </div>
    </section>

    <!-- PROBLEMAS TIPO EXAMEN -->
    <section>
        <h2 class="seccion-titulo">📝 Problemas de Práctica</h2>
        <div class="problema-lista">
            <div class="problema-item">
                <h3>Problema 1: Análisis Polinomial</h3>
                <p>Encuentra y clasifica los puntos críticos de $f(x) = 2x^3 - 3x^2 - 12x + 7$.</p>
                <button class="btn-solucion" data-target="sol1">VER RESOLUCIÓN</button>
                <div class="solucion-box" id="sol1">
                    1. Derivada: $f'(x) = 6x^2 - 6x - 12$<br>
                    2. Factorizar: $6(x^2 - x - 2) = 6(x-2)(x+1)$<br>
                    3. Críticos: $x=2, x=-1$<br>
                    4. Prueba: En $x=-1$, pasa de (+) a (-). **MÁXIMO**. En $x=2$, pasa de (-) a (+). **MÍNIMO**.
                </div>
            </div>
            <div class="problema-item">
                <h3>Problema 2: Optimización Básica</h3>
                <p>¿Qué número positivo sumado con su recíproco da la suma mínima?</p>
                <button class="btn-solucion" data-target="sol2">VER RESOLUCIÓN</button>
                <div class="solucion-box" id="sol2">
                    1. Función: $S(x) = x + 1/x$<br>
                    2. Derivada: $S'(x) = 1 - 1/x^2$<br>
                    3. Igualar a cero: $1 = 1/x^2 \Rightarrow x^2 = 1 \Rightarrow x = 1$ (positivo).<br>
                    4. Prueba: A la izq de 1 (ej 0.5) la derivada es negativa. A la derecha es positiva. **MÍNIMO**. El número es 1.
                </div>
            </div>
        </div>
    </section>

    <!-- QUIZ -->
    <section>
        <h2 class="seccion-titulo">🧠 Pon a prueba tu lógica</h2>
        <div class="quiz-container">
            <div id="quizCritContainer">
                <div class="quiz-pregunta">
                    <p>1. Si $f'(c) = 0$ y la derivada no cambia de signo en $c$, el punto es:</p>
                    <label><input type="radio" name="qc1" value="a"> Máximo</label>
                    <label><input type="radio" name="qc1" value="b"> Mínimo</label>
                    <label><input type="radio" name="qc1" value="c"> Un punto de inflexión horizontal</label>
                </div>
                <div class="quiz-pregunta">
                    <p>2. Un punto crítico donde la derivada NO existe se visualiza como:</p>
                    <label><input type="radio" name="qc2" value="a"> Una suave curva</label>
                    <label><input type="radio" name="qc2" value="b"> Un pico o esquina (v-shape)</label>
                    <label><input type="radio" name="qc2" value="c"> Una recta horizontal</label>
                </div>
                <div class="quiz-pregunta">
                    <p>3. Si $f' < 0$ a la izquierda de $c$ y $f' > 0$ a la derecha, $c$ es:</p>
                    <label><input type="radio" name="qc3" value="a"> Mínimo local</label>
                    <label><input type="radio" name="qc3" value="b"> Máximo local</label>
                    <label><input type="radio" name="qc3" value="c"> Punto de discontinuidad</label>
                </div>
                <button class="btn-evaluar" id="evalCritQuiz">EVALUAR RESPUESTAS</button>
            </div>
            <div id="quizCritFeedback" class="quiz-feedback" style="display:none;"></div>
        </div>
    </section>

    <!-- CIERRE -->
    <section>
        <h2 class="seccion-titulo">💭 Reflexión Final</h2>
        <div class="reflexion-box">
            <p>¿Podemos decir que una montaña rusa está llena de puntos críticos?</p>
            <textarea placeholder="Analiza el recorrido en términos de máximos y mínimos..."></textarea>
            <p class="sugerencia">💡 Piensa en los puntos más altos, los más bajos y las caídas.</p>
        </div>
        <div class="recursos">
            <h3>🔗 Enlaces de Interés</h3>
            <ul>
                <li><a href="#">Simulador de Geogebra: Extremos</a></li>
                <li><a href="https://www.google.com/search?q=aplicacion+derivada+optimizacion" target="_blank">Video: Optimización en la vida diaria</a></li>
            </ul>
        </div>
    </section>

    <script>
        (function() {
            // === SIMULADOR PUNTOS CRÍTICOS ===
            const svg = document.getElementById("critSVG");
            const input = document.getElementById("funcInputCrit");
            const btn = document.getElementById("updateGraphCrit");
            const info = document.getElementById("derivInfoCrit");
            const labelsList = document.getElementById("critLabelsList");

            if(!svg || !input || !btn) return;

            let currentExpr = "x**3 - 3*x";
            let xmin = -4, xmax = 4, ymin = -10, ymax = 10;

            function evalF(expr, x) {
                let e = expr.replace(/\^/g, '**').replace(/\b(sin|cos|tan|exp|log|abs|sqrt)\b/g, 'Math.$1');
                try { return new Function('x', 'return ' + e)(x); } catch { return NaN; }
            }

            function deriv(expr, x, h=0.001) {
                const f1 = evalF(expr, x+h), f2 = evalF(expr, x-h);
                return (isNaN(f1) || isNaN(f2)) ? NaN : (f1 - f2)/(2*h);
            }

            function draw() {
                const W = 900, H = 400, m = 60;
                const pw = W-m*2, ph = H-m*2;
                const sx = x => m + (x - xmin)/(xmax - xmin)*pw;
                const sy = y => (H-m) - (y - ymin)/(ymax - ymin)*ph;

                // Auto-scale Y
                let vals = [];
                for(let x=xmin; x<=xmax; x+=0.1) {
                    let y = evalF(currentExpr, x);
                    if(!isNaN(y) && isFinite(y)) vals.push(y);
                }
                if(vals.length) {
                    let minv = Math.min(...vals), maxv = Math.max(...vals);
                    let delta = (maxv - minv) * 0.2 || 2;
                    ymin = minv - delta; ymax = maxv + delta;
                }

                let d = "", lastY = null;
                for(let x=xmin; x<=xmax; x+=0.02) {
                    let y = evalF(currentExpr, x);
                    if(!isNaN(y) && isFinite(y)) {
                        let px = sx(x), py = sy(y);
                        if(py < -50 || py > H+50) { lastY = null; continue; }
                        d += (lastY===null ? "M" : "L") + px.toFixed(1) + " " + py.toFixed(1);
                        lastY = y;
                    } else { lastY = null; }
                }

                // Encontrar críticos
                let crits = [];
                for(let x=xmin+0.2; x<xmax-0.2; x+=0.05) {
                    let d1 = deriv(currentExpr, x-0.1), d2 = deriv(currentExpr, x+0.1);
                    if(d1 * d2 < 0) {
                        let a = x-0.1, b = x+0.1, c = x;
                        for(let i=0; i<10; i++) {
                            c = (a+b)/2;
                            if(deriv(currentExpr, a) * deriv(currentExpr, c) < 0) b = c; else a = c;
                        }
                        crits.push({x: c, type: (d1>0 ? 'max' : 'min')});
                    } else if(Math.abs(d1) < 0.05 && Math.abs(d2) < 0.05) {
                         if(Math.abs(deriv(currentExpr, x)) < 0.01) crits.push({x: x, type: 'infl'});
                    }
                }
                crits = crits.filter((v,i,a) => i===0 || Math.abs(v.x - a[i-1].x) > 0.3);

                let pointsHTML = "";
                let listHTML = "";
                crits.forEach(c => {
                    let y = evalF(currentExpr, c.x);
                    let color = c.type==='max' ? '#ff00ff' : (c.type==='min' ? '#39ff14' : '#ffff00');
                    pointsHTML += `<circle cx="${sx(c.x)}" cy="${sy(y)}" r="8" fill="${color}" stroke="white" stroke-width="1.5">
                        <title>x: ${c.x.toFixed(2)}, y: ${y.toFixed(2)}</title>
                    </circle>`;
                    let label = c.type==='max' ? 'Máximo' : (c.type==='min' ? 'Mínimo' : 'Inflexión');
                    let classT = 'tipo-' + c.type;
                    listHTML += `<li>Punto en x ≈ <strong>${c.x.toFixed(2)}</strong>: <span class="${classT}">${label}</span></li>`;
                });
                if(!crits.length) listHTML = "<li>No se detectaron extremos en este rango.</li>";

                svg.innerHTML = `
                    <line x1="${m}" y1="${sy(0)}" x2="${W-m}" y2="${sy(0)}" stroke="rgba(255,255,255,0.1)" />
                    <line x1="${sx(0)}" y1="${m}" x2="${sx(0)}" y2="${H-m}" stroke="rgba(255,255,255,0.1)" />
                    <path d="${d}" fill="none" stroke="#00ffff" stroke-width="3" stroke-linecap="round" />
                    ${pointsHTML}
                `;
                if(labelsList) labelsList.innerHTML = listHTML;
            }

            btn.addEventListener("click", () => { currentExpr = input.value || "0"; draw(); });
            
            svg.addEventListener("mousemove", (e) => {
                const rect = svg.getBoundingClientRect();
                const mx = (e.clientX - rect.left) * (900/rect.width);
                const x = xmin + (mx - 60)/780 * (xmax - xmin);
                if(x < xmin || x > xmax) return;
                const dVal = deriv(currentExpr, x);
                if(info) info.innerHTML = `x = ${x.toFixed(2)} | f'(x) ≈ ${dVal.toFixed(3)}`;
            });

            document.querySelectorAll(".keypad-mini button").forEach(b => {
                b.addEventListener("click", () => {
                    let v = b.getAttribute("data-val");
                    if(v===" ") input.value = ""; else input.value += v;
                    input.focus();
                });
            });

            draw();
        })();

        // Solving problems
        function toggleSolCustom(id, btn) {
            let target = document.getElementById(id);
            if(!target) return;
            target.classList.toggle("visible");
            btn.textContent = target.classList.contains("visible") ? "OCULTAR RESOLUCIÓN" : "VER RESOLUCIÓN";
        }

        document.querySelectorAll(".btn-solucion").forEach(b => {
             b.onclick = () => toggleSolCustom(b.getAttribute("data-target"), b);
        });

        document.querySelectorAll(".error-card").forEach(c => {
            c.onclick = () => c.classList.toggle("expandido");
        });

        const evalBtnCrit = document.getElementById("evalCritQuiz");
        if(evalBtnCrit) {
            evalBtnCrit.onclick = () => {
                const ans = { qc1: "c", qc2: "b", qc3: "a" };
                const explanations = {
                    qc1: "Si f'=0 pero no cambia de signo, la función sigue subiendo o bajando. Es una meseta horizontal.",
                    qc2: "Un cambio brusco de pendiente genera un 'pico' o esquina en la gráfica.",
                    qc3: "Baja y luego sube = Punto más bajo (mínimo)."
                };
                let score = 0, htmlText = "<h4>📊 Resultados</h4><ul>";
                for(let k in ans) {
                    let sel = document.querySelector(`input[name="${k}"]:checked`);
                    let isOk = sel && sel.value === ans[k];
                    if(isOk) score++;
                    
                    let radioButtons = document.querySelectorAll(`input[name="${k}"]`);
                    radioButtons.forEach(r => {
                        let lbl = r.parentElement;
                        if(r.value === ans[k]) lbl.classList.add("correct-ans");
                        else if(r.checked) lbl.classList.add("wrong-ans");
                    });

                    htmlText += `<li>Pregunta ${k.slice(-1)}: <span style="color:${isOk?'#39ff14':'#ff3366'}">${isOk?'¡Correcto!':'Incorrecto'}</span><br><small>${explanations[k]}</small></li>`;
                }
                htmlText += `</ul><p>Puntaje: ${score}/3</p>`;
                const feedbackDiv = document.getElementById("quizCritFeedback");
                feedbackDiv.innerHTML = htmlText; feedbackDiv.style.display = "block";
            };
        }
    </script>
</div>
HTML,
@'

$finalContent = $before + $newContent + $after
[System.IO.File]::WriteAllText($file, $finalContent, [System.Text.Encoding]::UTF8)
Write-Host "Lección Puntos Críticos REPARADA EXPLICITAMENTE."
