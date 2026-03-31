# Fix derivadas lesson: replace broken JS block (lines 253-665, indices 252-664)
# with the correct complete <script> block

$file = 'c:\xampp\htdocs\LC-ADVANCE\src\content.php'
$lines = Get-Content $file -Encoding UTF8
Write-Host ("Total lines before: " + $lines.Count)

# Lines 253-665 (0-indexed 252-664) are broken — replace them
$before = $lines[0..251]   # lines 1-252
$after  = $lines[665..($lines.Count - 1)]  # lines 666+

# The correct <script> block to insert
$newScript = @'

    <script>
        // ===== TANGENTE INTERACTIVA =====
        (function() {
            const svg = document.getElementById("tangentExplorer");
            if (!svg) return;
            const xmin = -3, xmax = 3, ymin = -8, ymax = 8;
            const f  = x => x**3 - 3*x;
            const fp = x => 3*x**2 - 3;

            const sx = x => 80 + (x - xmin)/(xmax - xmin) * 740;
            const sy = y => 370 - (y - ymin)/(ymax - ymin) * 310;

            let d = "";
            for(let x = xmin; x <= xmax; x += 0.02) {
                d += (x === xmin ? "M" : "L") + sx(x) + " " + sy(f(x));
            }
            svg.innerHTML = `
                <defs>
                    <marker id="arrowT" markerWidth="8" markerHeight="8" refX="6" refY="3" orient="auto">
                        <path d="M0,0 L0,6 L6,3 z" fill="#ff44ff" />
                    </marker>
                </defs>
                <line x1="80" y1="370" x2="820" y2="370" stroke="#333" stroke-width="1.5" />
                <line x1="80" y1="60"  x2="80"  y2="380" stroke="#333" stroke-width="1.5" />
                <path d="${d}" stroke="#0ff" stroke-width="2.5" fill="none" />
                <line id="tangLine" stroke="#ff44ff" stroke-width="2.5" marker-end="url(#arrowT)" />
                <circle id="hoverPoint" r="6" fill="#ff44ff" />
            `;

            svg.addEventListener("mousemove", (e) => {
                const rect = svg.getBoundingClientRect();
                const scaleX = 900 / rect.width;
                const mx = (e.clientX - rect.left) * scaleX;
                const x = xmin + (mx - 80)/740 * (xmax - xmin);
                if(x < xmin || x > xmax) return;
                const y = f(x), m = fp(x);
                document.getElementById("hoverPoint").setAttribute("cx", sx(x));
                document.getElementById("hoverPoint").setAttribute("cy", sy(y));
                const len = 60;
                const dx = len / Math.sqrt(1 + m*m);
                const line = document.getElementById("tangLine");
                line.setAttribute("x1", sx(x) - dx);
                line.setAttribute("y1", sy(y) - m*dx);
                line.setAttribute("x2", sx(x) + dx);
                line.setAttribute("y2", sy(y) + m*dx);
            });

            // Touch support
            svg.addEventListener("touchmove", (e) => {
                e.preventDefault();
                const touch = e.touches[0];
                const rect = svg.getBoundingClientRect();
                const scaleX = 900 / rect.width;
                const mx = (touch.clientX - rect.left) * scaleX;
                const x = xmin + (mx - 80)/740 * (xmax - xmin);
                if(x < xmin || x > xmax) return;
                const y = f(x), m = fp(x);
                document.getElementById("hoverPoint").setAttribute("cx", sx(x));
                document.getElementById("hoverPoint").setAttribute("cy", sy(y));
                const len = 60;
                const dx = len / Math.sqrt(1 + m*m);
                const line = document.getElementById("tangLine");
                line.setAttribute("x1", sx(x) - dx);
                line.setAttribute("y1", sy(y) - m*dx);
                line.setAttribute("x2", sx(x) + dx);
                line.setAttribute("y2", sy(y) + m*dx);
            }, { passive: false });
        })();

        // ===== SIMULADOR AVANZADO CON MODAL =====
        (function() {
            let currentFunc = null;
            let xmin = -4, xmax = 4, ymin = -10, ymax = 10;
            let modalOpen = false;
            const MAX_VALID = 1e10;

            const funcInput          = document.getElementById("funcInput");
            const slider             = document.getElementById("xSlider");
            const xValueDisplay      = document.getElementById("xValueDisplay");
            const derivInfo          = document.getElementById("derivInfo");
            const mainSVG            = document.getElementById("simuladorSVG");
            const showTangentCB      = document.getElementById("showTangentCheckbox");
            const resetViewBtn       = document.getElementById("resetViewBtn");
            const autoScaleBtn       = document.getElementById("autoScaleBtn");
            const modal              = document.getElementById("graphModal");
            const modalSVG           = document.getElementById("modalSVG");
            const closeModalBtn      = document.getElementById("closeModalBtn");

            if (!funcInput || !slider || !mainSVG || !modal) return;

            function evaluarExpresion(expr, xVal) {
                let e = expr.replace(/\^/g, '**')
                            .replace(/\b(sin|cos|tan|exp|log|log10|sqrt|abs|PI)\b/g, 'Math.$1');
                try {
                    const fn = new Function('x', 'return ' + e);
                    const r  = fn(xVal);
                    return (!isFinite(r) || Math.abs(r) > MAX_VALID) ? NaN : r;
                } catch(_) { return NaN; }
            }

            function derivadaNumerica(x, h = 0.001) {
                if (!currentFunc) return NaN;
                const f1 = evaluarExpresion(currentFunc, x + h);
                const f2 = evaluarExpresion(currentFunc, x - h);
                return (isNaN(f1) || isNaN(f2)) ? NaN : (f1 - f2) / (2 * h);
            }

            function calcularLimitesY() {
                if (!currentFunc) return { ymin: -10, ymax: 10 };
                let vals = [];
                const step = (xmax - xmin) / 300;
                for (let x = xmin; x <= xmax; x += step) {
                    let y = evaluarExpresion(currentFunc, x);
                    if (!isNaN(y) && isFinite(y)) vals.push(y);
                }
                if (!vals.length) return { ymin: -10, ymax: 10 };
                let lo = Math.min(...vals), hi = Math.max(...vals);
                let mg = (hi - lo) * 0.15 || 1;
                return { ymin: lo - mg, ymax: hi + mg };
            }

            function drawAxesLabels(svg, mLeft, mRight, mTop, mBottom, plotW, plotH) {
                // Eje X ticks
                let ticks = "";
                for (let xi = Math.ceil(xmin); xi <= Math.floor(xmax); xi++) {
                    const px = mLeft + (xi - xmin)/(xmax - xmin)*plotW;
                    const py = mBottom;
                    // zero line
                    if (xi === 0) {
                        ticks += `<line x1="${px}" y1="${mTop}" x2="${px}" y2="${mBottom}" stroke="rgba(255,255,255,0.15)" stroke-width="1"/>`;
                    }
                    ticks += `<line x1="${px}" y1="${py}" x2="${px}" y2="${py+5}" stroke="#555" stroke-width="1"/>`;
                    ticks += `<text x="${px}" y="${py+16}" fill="#888" font-size="11" text-anchor="middle">${xi}</text>`;
                }
                // Eje Y ticks — sample a few
                const yStep = Math.max(1, Math.round((ymax - ymin)/8));
                let yStart = Math.ceil(ymin / yStep) * yStep;
                for (let yi = yStart; yi <= ymax; yi += yStep) {
                    const py = mBottom - (yi - ymin)/(ymax - ymin)*plotH;
                    if (yi === 0) {
                        ticks += `<line x1="${mLeft}" y1="${py}" x2="${mRight}" y2="${py}" stroke="rgba(255,255,255,0.12)" stroke-width="1"/>`;
                    }
                    ticks += `<line x1="${mLeft-5}" y1="${py}" x2="${mLeft}" y2="${py}" stroke="#555" stroke-width="1"/>`;
                    ticks += `<text x="${mLeft-8}" y="${py+4}" fill="#888" font-size="11" text-anchor="end">${yi}</text>`;
                }
                return ticks;
            }

            function renderizarEnSVG(svgEl, xVal, showTangent) {
                if (!currentFunc) {
                    svgEl.innerHTML = "<text x='50%' y='50%' fill='#f66' text-anchor='middle' font-size='14'>Función no válida</text>";
                    return;
                }
                const vb     = svgEl.getAttribute("viewBox").split(" ");
                const W      = parseFloat(vb[2]) || 900;
                const H      = parseFloat(vb[3]) || 400;
                const mLeft  = 60, mRight = W - 30, mTop = 30, mBottom = H - 40;
                const plotW  = mRight - mLeft, plotH = mBottom - mTop;

                const sx = x => mLeft + (x - xmin)/(xmax - xmin)*plotW;
                const sy = y => mBottom - (y - ymin)/(ymax - ymin)*plotH;

                // Build curve path
                let d = "", lastY = null, pts = 0;
                const step = (xmax - xmin) / 800;
                for (let xi = xmin; xi <= xmax; xi += step) {
                    let y = evaluarExpresion(currentFunc, xi);
                    if (!isNaN(y) && isFinite(y)) {
                        const py = sy(y);
                        if (py < mTop - 20 || py > mBottom + 20) { lastY = null; continue; }
                        if (pts === 0) { d += "M" + sx(xi).toFixed(1) + " " + py.toFixed(1); }
                        else if (lastY === null || Math.abs(y - lastY) < (ymax - ymin) * 0.9) {
                            d += "L" + sx(xi).toFixed(1) + " " + py.toFixed(1);
                        } else { d += "M" + sx(xi).toFixed(1) + " " + py.toFixed(1); }
                        lastY = y; pts++;
                    } else { lastY = null; }
                }

                const axisLabels = drawAxesLabels(svgEl, mLeft, mRight, mTop, mBottom, plotW, plotH);
                const yVal = evaluarExpresion(currentFunc, xVal);
                const mVal = derivadaNumerica(xVal);

                // Tangent line coords
                let tangentSVG = "";
                if (showTangent && !isNaN(mVal) && isFinite(mVal) && !isNaN(yVal)) {
                    const dx = (xmax - xmin) * 0.18;
                    const tx1 = sx(xVal - dx), ty1 = sy(yVal - mVal * dx);
                    const tx2 = sx(xVal + dx), ty2 = sy(yVal + mVal * dx);
                    tangentSVG = `<line x1="${tx1.toFixed(1)}" y1="${ty1.toFixed(1)}" x2="${tx2.toFixed(1)}" y2="${ty2.toFixed(1)}" stroke="#f0f" stroke-width="2" stroke-dasharray="6,3" opacity="0.9"/>`;
                }

                // Moving point
                let pointSVG = "";
                if (!isNaN(yVal) && isFinite(yVal)) {
                    const cpx = sx(xVal).toFixed(1), cpy = sy(yVal).toFixed(1);
                    pointSVG = `<circle cx="${cpx}" cy="${cpy}" r="7" fill="#ff44ff" stroke="white" stroke-width="1.5"/>`;
                }

                svgEl.innerHTML = `
                    ${axisLabels}
                    <path d="${d}" stroke="#0ff" stroke-width="2.5" fill="none" stroke-linecap="round"/>
                    ${tangentSVG}
                    ${pointSVG}
                `;
            }

            function actualizarInfo() {
                const x = parseFloat(slider.value);
                xValueDisplay.textContent = x.toFixed(2);
                const y = currentFunc ? evaluarExpresion(currentFunc, x) : NaN;
                const m = currentFunc ? derivadaNumerica(x) : NaN;
                const yStr = isNaN(y) ? "indefinido" : y.toFixed(3);
                const mStr = isNaN(m) ? "indefinido" : m.toFixed(3);
                derivInfo.textContent = "x = " + x.toFixed(2) + "   |   f(x) = " + yStr + "   |   f'(x) ≈ " + mStr;
            }

            function actualizarAmbos() {
                if (!currentFunc) return;
                renderizarEnSVG(mainSVG, parseFloat(slider.value), showTangentCB.checked);
                if (modalOpen) renderizarEnSVG(modalSVG, parseFloat(slider.value), showTangentCB.checked);
            }

            function autoEscalarY() {
                if (!currentFunc) return;
                const lims = calcularLimitesY();
                ymin = lims.ymin; ymax = lims.ymax;
                actualizarAmbos();
            }

            function actualizarSimulador() {
                const expr = funcInput.value.trim();
                if (!expr) { currentFunc = null; derivInfo.textContent = "⚠️ Función vacía"; return; }
                // Quick validation
                let ok = true;
                try { evaluarExpresion(expr, 0); evaluarExpresion(expr, 1); }
                catch(_) { ok = false; }
                if (!ok || isNaN(evaluarExpresion(expr, 0))) {
                    if (!ok) { currentFunc = null; derivInfo.textContent = "⚠️ Expresión inválida"; return; }
                }
                currentFunc = expr;
                autoEscalarY();
                actualizarInfo();
                actualizarAmbos();
            }

            // Events
            document.getElementById("actualizarFunc").addEventListener("click", actualizarSimulador);
            slider.addEventListener("input", () => { actualizarInfo(); actualizarAmbos(); });
            showTangentCB.addEventListener("change", actualizarAmbos);
            resetViewBtn.addEventListener("click", () => { xmin=-4; xmax=4; autoEscalarY(); });
            autoScaleBtn.addEventListener("click", autoEscalarY);

            mainSVG.addEventListener("click", () => {
                modal.style.display = "flex";
                modalOpen = true;
                modalSVG.setAttribute("viewBox", "0 0 1000 580");
                renderizarEnSVG(modalSVG, parseFloat(slider.value), showTangentCB.checked);
            });
            closeModalBtn.addEventListener("click", () => { modal.style.display = "none"; modalOpen = false; });
            modal.addEventListener("click", (e) => { if (e.target === modal) { modal.style.display = "none"; modalOpen = false; } });

            // Keypad
            const keypad = document.getElementById("keypad");
            if (keypad) {
                keypad.addEventListener("click", (e) => {
                    if (!e.target.matches("button[data-val]")) return;
                    const val = e.target.getAttribute("data-val");
                    if (val === " ") funcInput.value = "";
                    else { funcInput.focus(); funcInput.value += val; }
                });
            }

            actualizarSimulador();
        })();

        // ===== QUIZ =====
        document.addEventListener("DOMContentLoaded", () => {
            const quizBtn = document.getElementById("corregirQuiz");
            if (!quizBtn) return;

            const answers = {
                q1: { correct: "b", exp: "La derivada en un punto es la pendiente de la recta tangente: razón de cambio instantánea." },
                q2: { correct: "b", exp: "Si f'(x) < 0 la función baja (decrece) en ese intervalo." },
                q3: { correct: "b", exp: "La derivada de cualquier constante es 0 — no cambia." },
                q4: { correct: "a", exp: "Regla de la potencia: d/dx[5x⁴] = 5·4·x³ = 20x³." },
                q5: { correct: "a", exp: "La derivada de sen(x) es cos(x) — derivada trigonométrica fundamental." },
                q6: { correct: "b", exp: "v(t)=s'(t)=2t+2; en t=3 → v=2(3)+2=8." }
            };

            quizBtn.addEventListener("click", () => {
                let score = 0;
                let html = "<h4>📊 Resultados</h4><ul>";
                for (let i = 1; i <= 6; i++) {
                    const key = "q" + i;
                    const sel = document.querySelector('input[name="' + key + '"]:checked');
                    const ok  = sel && sel.value === answers[key].correct;
                    if (ok) score++;
                    const ua  = sel ? sel.value.toUpperCase() : "Sin respuesta";
                    const ca  = answers[key].correct.toUpperCase();
                    html += `<li style="margin-bottom:.8rem;">
                        <strong>Pregunta ${i}:</strong>
                        <span style="color:${ok?'#39ff14':'#ff3366'}">${ok ? "✔ Correcta" : "❌ Incorrecta"}</span><br>
                        Tu respuesta: <strong>${ua}</strong> &nbsp;|&nbsp; Correcta: <strong>${ca}</strong><br>
                        <span style="color:#aac;font-size:.85em;">${answers[key].exp}</span>
                    </li>`;
                    // Highlight labels
                    document.querySelectorAll('input[name="' + key + '"]').forEach(r => {
                        const lbl = r.parentElement;
                        if (r.value === answers[key].correct) {
                            lbl.style.background = "rgba(57,255,20,0.1)";
                            lbl.style.borderLeft  = "3px solid #39ff14";
                        } else if (r.checked) {
                            lbl.style.background = "rgba(255,51,102,0.1)";
                            lbl.style.borderLeft  = "3px solid #ff3366";
                        }
                    });
                }
                const msg = score===6?"🏆 ¡Perfecto!":score>=4?"👍 Buen trabajo":"📘 Revisa la teoría";
                html += `</ul><p><strong>Puntaje: ${score}/6</strong> — ${msg}</p>`;
                document.getElementById("quizFeedback").innerHTML = html;
                document.getElementById("quizFeedback").scrollIntoView({ behavior:"smooth", block:"nearest" });
            });
        });
    </script>
</div>
'@

$newLines = $before + ($newScript -split "`n") + $after
Write-Host ("Total lines after: " + $newLines.Count)

$newContent = $newLines -join "`n"
[System.IO.File]::WriteAllText($file, $newContent, [System.Text.Encoding]::UTF8)
Write-Host "Done! Script block fixed."
