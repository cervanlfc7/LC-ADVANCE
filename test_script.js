
    // Data
    const challenges = {};
    marked.setOptions({
        gfm: true,
        breaks: true,
        headerIds: false,
        mangle: false
    });
    let currentChallenge = '{}';
    let editor = null;
    let currentOutput = 'console';
    let consoleOutput = [];
    let chatHistory = [];

    // Progress
    function loadProgress() {
        try { return JSON.parse(localStorage.getItem('lab_progress') || '{}'); } 
        catch { return {}; }
    }

    function saveProgress(id, completed) {
        try {
            const p = loadProgress();
            p[id] = { completed, timestamp: Date.now() };
            localStorage.setItem('lab_progress', JSON.stringify(p));
        } catch {}
    }

    function isCompleted(id) {
        return loadProgress()[id]?.completed === true;
    }

    function refreshBadges() {
        Object.keys(challenges).forEach(id => {
            const el = document.getElementById(`done-${id}`);
            if (el && isCompleted(id)) el.classList.add('visible');
        });
    }

    // VS Code Style Resize functionality - declare first
    let isResizingSidebar = false;
    let isResizingRightPanel = false;
    let isResizingOutput = false;
    let startX, startY, startWidth, startHeight;

    // Init
    document.addEventListener('DOMContentLoaded', () => {
        initEditor();
        refreshBadges();
        loadChallenge(currentChallenge);
        initResizers();
        restoreSidebarState();
    });

    function initEditor() {
        editor = CodeMirror.fromTextArea(document.getElementById('codeEditor'), {
            mode: 'javascript',
            theme: 'dracula',
            lineNumbers: true,
            autoCloseBrackets: true,
            matchBrackets: true,
            styleActiveLine: true,
            indentUnit: 2,
            tabSize: 2,
            lineWrapping: true,
            foldGutter: true,
            gutters: ['CodeMirror-linenumbers', 'CodeMirror-foldgutter'],
            extraKeys: {
                'Ctrl-S': function() { /* Save shortcut - could be implemented */ },
                'F11': function(cm) { cm.setOption('fullScreen', !cm.getOption('fullScreen')); },
                'Esc': function(cm) { if (cm.getOption('fullScreen')) cm.setOption('fullScreen', false); }
            }
        });

        // Set initial value
        editor.setValue(challenges[currentChallenge]?.starter || '');

        // Update status bar on cursor activity
        editor.on('cursorActivity', function() {
            updateStatusBar();
        });
    }

    function updateStatusBar() {
        if (!editor) return;
        const cursor = editor.getCursor();
        const line = cursor.line + 1;
        const col = cursor.ch + 1;

        const statusItems = document.querySelectorAll('.status-item');
        if (statusItems.length >= 3) {
            statusItems[1].textContent = `Ln ${line}, Col ${col}`;
        }
    }

    // Wolfram Alpha Functions
    function switchMode(mode) {
        const wolframMode = document.getElementById('wolframMode');
        const codeMode = document.getElementById('codeMode');
        const wolframTab = document.querySelector('[data-mode="wolfram"]');
        const codeTab = document.querySelector('[data-mode="code"]');
        
        if (mode === 'wolfram') {
            wolframMode.style.display = 'block';
            codeMode.style.display = 'none';
            wolframTab.classList.add('active');
            codeTab.classList.remove('active');
            
            // Update main panel for Wolfram mode
            document.getElementById('codeSection').innerHTML = `
                <div class="wolfram-result-section" id="wolframResult">
                    <div class="result-placeholder">
                        <div class="result-icon">🔬</div>
                        <div>Escribe un problema matemático y presiona Resolver</div>
                    </div>
                </div>
            `;
        } else if (mode === 'code') {
            wolframMode.style.display = 'none';
            codeMode.style.display = 'block';
            wolframTab.classList.remove('active');
            codeTab.classList.add('active');
            
            // Restore original code mode
            loadChallenge(currentChallenge || 'prog-sum-array');
        }
    }

    function loadExample(example) {
        const input = document.getElementById('wolframInput');
        if (input) {
            input.value = example;
            input.focus();
        }
    }

    function handleWolframKeypress(event) {
        if (event.key === 'Enter' && event.ctrlKey) {
            event.preventDefault();
            solveWolfram();
        }
    }

    function solveWolfram() {
        const input = document.getElementById('wolframInput').value.trim();
        if (!input) return;
        
        const resultSection = document.getElementById('wolframResult');
        
        // Show loading state
        resultSection.innerHTML = `
            <div class="result-loading">
                <div class="spinner"></div>
                <div>Resolviendo problema...</div>
            </div>
        `;
        
        // Simulate processing time
        setTimeout(() => {
            const result = processWolframQuery(input);
            displayWolframResult(result);
        }, 1500);
    }

    function processWolframQuery(query) {
        const lowerQuery = query.toLowerCase();
        
        // Mathematical operations
        if (lowerQuery.includes('derivada') || lowerQuery.includes('derivative')) {
            return solveDerivative(query);
        }
        if (lowerQuery.includes('integral')) {
            return solveIntegral(query);
        }
        if (lowerQuery.includes('resolver') || lowerQuery.includes('solve')) {
            return solveEquation(query);
        }
        if (lowerQuery.includes('límite') || lowerQuery.includes('limit')) {
            return solveLimit(query);
        }
        
        // Physics operations
        if (lowerQuery.includes('energía cinética') || lowerQuery.includes('kinetic energy')) {
            return solveKineticEnergy(query);
        }
        if (lowerQuery.includes('fuerza') || lowerQuery.includes('force')) {
            return solveForce(query);
        }
        if (lowerQuery.includes('péndulo') || lowerQuery.includes('pendulum')) {
            return solvePendulum(query);
        }
        if (lowerQuery.includes('proyectil') || lowerQuery.includes('projectile')) {
            return solveProjectile(query);
        }
        
        // Chemistry operations
        if (lowerQuery.includes('balancear') || lowerQuery.includes('balance')) {
            return balanceChemicalEquation(query);
        }
        if (lowerQuery.includes('masa molar') || lowerQuery.includes('molar mass')) {
            return calculateMolarMass(query);
        }
        if (lowerQuery.includes('ph')) {
            return calculatePH(query);
        }
        if (lowerQuery.includes('gas ideal') || lowerQuery.includes('ideal gas')) {
            return solveIdealGas(query);
        }
        
        // Geometry operations
        if (lowerQuery.includes('área') || lowerQuery.includes('area')) {
            return calculateArea(query);
        }
        if (lowerQuery.includes('volumen') || lowerQuery.includes('volume')) {
            return calculateVolume(query);
        }
        if (lowerQuery.includes('triángulo') || lowerQuery.includes('triangle')) {
            return solveTriangle(query);
        }
        if (lowerQuery.includes('pitágoras') || lowerQuery.includes('pythagorean')) {
            return solvePythagorean(query);
        }
        
        // Default - try to evaluate as math expression with math.js
        try {
            const cleaned = query.replace(/÷/g, '/').replace(/×/g, '*').replace(/π/gi, 'pi').trim();
            const result = math.evaluate(cleaned);
            const numResult = Number(result);
            
            if (!isNaN(numResult) && isFinite(numResult)) {
                const formatted = Number.isInteger(numResult) ? numResult : parseFloat(numResult.toFixed(6));
                return {
                    type: 'math',
                    query: query,
                    result: formatted,
                    formula: `${query} = ${formatted}`,
                    steps: [
                        `Evaluar: ${cleaned}`,
                        `Resultado: ${formatted}`
                    ],
                    explanation: `${query} = ${formatted}`
                };
            }
            
            const strResult = String(result);
            return {
                type: 'math',
                query: query,
                result: strResult,
                formula: `${query} = ${strResult}`,
                steps: [`Calcular: ${cleaned}`, `Resultado: ${strResult}`],
                explanation: strResult
            };
        } catch (e) {
            const suggestions = [
                'evalúa: 2+2, sqrt(16), sin(pi/2), 5!',
                'derivada: derivada x^2 respect to x', 
                'resolver: x^2 + 5 = 10',
                'sqrt: sqrt(81)',
                'potencia: 2^10'
            ];
            return {
                type: 'general',
                query: query,
                result: 'No reconocí la expresión. Prueba:',
                steps: suggestions,
                formula: null
            };
        }
    }

    function displayWolframResult(result) {
        const resultSection = document.getElementById('wolframResult');
        
        let html = `
            <div class="result-display">
                <div class="result-header">
                    <div class="result-status-icon">${getStatusIcon(result.type)}</div>
                    <div class="result-label">${result.type === 'error' ? 'Error' : 'Resultado'}</div>
                </div>
        `;
        
        if (result.formula) {
            html += `
                <div class="formula-container">
                    <div class="formula-label">Fórmula</div>
                    <div class="formula-math" id="wolframFormula">${result.formula}</div>
                </div>
            `;
        }
        
        if (result.result) {
            html += `
                <div class="result-value">${result.result}</div>
            `;
        }
        
        if (result.steps && result.steps.length > 0) {
            html += `
                <div class="steps-container">
                    <div class="steps-title">📋 Pasos</div>
                    ${result.steps.map((step, i) => `
                        <div class="step-item">
                            <div class="step-number">${i + 1}</div>
                            <div class="step-content">${step}</div>
                        </div>
                    `).join('')}
                </div>
            `;
        }
        
        if (result.explanation) {
            html += `
                <div class="theory-box">
                    <div class="theory-title">📚 Explicación</div>
                    <div class="theory-content">${result.explanation}</div>
                </div>
            `;
        }
        
        html += '</div>';
        resultSection.innerHTML = html;
        
        // Render math formulas if any
        if (result.formula && window.katex) {
            const formulaElement = document.getElementById('wolframFormula');
            if (formulaElement) {
                try {
                    katex.render(result.formula, formulaElement, {
                        displayMode: true,
                        throwOnError: false,
                        strict: false
                    });
                } catch (e) {
                    formulaElement.innerHTML = `<span style="font-family: 'Times New Roman', serif; font-style: italic; color: var(--cyan);">${result.formula}</span>`;
                }
            }
        }
    }

    function getStatusIcon(type) {
        const icons = {
            'math': '📐',
            'physics': '⚛️',
            'chemistry': '⚗️',
            'geometry': '📏',
            'error': '❌',
            'success': '✅'
        };
        return icons[type] || '📊';
    }

    // Mathematical solving functions with math.js
    function solveDerivative(query) {
        const lowerQuery = query.toLowerCase();
        
        const varMatch = query.match(/respect to (\w+)/i);
        const variable = varMatch ? varMatch[1] : 'x';
        
        let func = query.replace(/^(?:derivada|derivative)\s+(?:of\s+)?/i, '').replace(/\s*with respect to \w+/i, '').trim();
        
        if (!func || func.length < 2 || func.length > 100) {
            return { type: 'error', query, result: 'Sintaxis: derivada de función o derivada [función] respect to [variable]', formula: null };
        }
        
        try {
            const h = math.derivative(func, variable);
            const result = h.toString();
            
            return {
                type: 'math',
                query: query,
                result: result,
                formula: `\\frac{d}{d${variable}}[${func}] = ${result}`,
                steps: [
                    `Función original: ${func}`,
                    `Derivar con respecto a ${variable}`,
                    `Resultado: ${result}`
                ],
                explanation: `La derivada de ${func} con respecto a ${variable} es ${result}`
            };
        } catch (e) {
            return {
                type: 'error',
                query: query,
                result: 'No se pudo derivar. Verifica la sintaxis.',
                formula: null,
                steps: ['Ejemplos: derivada x^2+3*x', 'derivada sin(x) respect to x']
            };
        }
    }

    function solveIntegral(query) {
        let func = query.replace(/^(?:integral|integrar)\s+(?:of\s+)?/i, '').replace(/\s*dx$/i, '').trim();
        
        if (!func) {
            return { type: 'error', query, result: 'Sintaxis: integral [función] dx', formula: null };
        }
        
        try {
            const node = math.parse(func);
            const simplified = node.compile().evaluate();
            
            return {
                type: 'math',
                query: query,
                result: `∫${func} dx (usa tablas de integrales)`,
                formula: `\\int ${func} \\, dx`,
                steps: [
                    `Función: ${func}`,
                    'Consulta tablas de integrales comunes',
                    `Resultado requiere integración simbólica`
                ],
                explanation: `Para integrar ${func}, consulta integrales conocidas`
            };
        } catch (e) {
            return {
                type: 'error',
                query,
                result: 'No se pudo procesar',
                formula: null
            };
        }
    }
                    'Agregar constante de integración + C',
                    `Resultado: ${integral} + C`
                ],
                explanation: `La integral de ${func} es ${integral} + C`
            };
        } catch (e) {
            return {
                type: 'error',
                query: query,
                result: 'No se pudo integrar. Verifica la sintaxis.',
                formula: null
            };
        }
    }

    function solveEquation(query) {
        const lowerQuery = query.toLowerCase();
        
        const eqMatch = query.match(/(.+?)\s*=\s*(.+)/);
        if (!eqMatch) {
            return { type: 'error', query, result: 'Usa formato: expresión = valor (ej: x^2 + 5 = 10)', formula: null };
        }
        
        const lhs = eqMatch[1].trim();
        const rhs = eqMatch[2].trim();
        
        try {
            const sol = math.parse(`${lhs}-(${rhs})`);
            const simplified = sol.compile().evaluate();
            
            return {
                type: 'math',
                query: query,
                result: `${lhs} = ${rhs}`,
                formula: `${lhs} = ${rhs}`,
                steps: [
                    `Ecuación: ${lhs} = ${rhs}`,
                    'Resolver para x',
                    `Resultado`
                ],
                explanation: `${lhs} = ${rhs}`
            };
        } catch (e) {
            return {
                type: 'error',
                query: query,
                result: 'No se pudo resolver',
                formula: null
            };
        }
    }
            type: 'math',
            query: query,
            result: 'No pude encontrar la función para integrar',
            steps: ['Verifica la sintaxis de la función'],
            formula: null
        };
    }

    function solveEquation(query) {
        // Extract equation
        const match = query.match(/(?:resolver|solve)\s+(.+?)(?:\s*=\s*(.+))?/i);
        if (match) {
            const equation = match[1].trim();
            
            // Check if it's quadratic
            if (equation.includes('x^2') || equation.includes('x²')) {
                return solveQuadratic(equation);
            }
            
            return {
                type: 'math',
                query: query,
                result: `Resolver: ${equation}`,
                formula: equation,
                steps: [
                    'Identificar el tipo de ecuación',
                    'Aplicar método apropiado',
                    'Encontrar soluciones'
                ],
                explanation: `Resolviendo la ecuación: ${equation}`
            };
        }
        
        return {
            type: 'math',
            query: query,
            result: 'No pude identificar la ecuación',
            steps: ['Proporciona una ecuación clara'],
            formula: null
        };
    }

    function solveQuadratic(equation) {
        // Extract coefficients from ax^2 + bx + c = 0
        const coeffs = equation.match(/([+-]?\d*\.?\d*)x\^2\s*([+-]\s*\d*\.?\d*)x\s*([+-]\s*\d+)?/);
        if (coeffs) {
            const a = parseFloat(coeffs[1].replace(/[^\d.-]/g, '')) || 1;
            const b = parseFloat(coeffs[2].replace(/[^\d.-]/g, '')) || 0;
            const c = parseFloat(coeffs[3] ? coeffs[3].replace(/[^\d.-]/g, '') : '0') || 0;
            
            const discriminant = b*b - 4*a*c;
            const sqrtDiscriminant = Math.sqrt(Math.abs(discriminant));
            
            if (discriminant >= 0) {
                const x1 = (-b + sqrtDiscriminant) / (2*a);
                const x2 = (-b - sqrtDiscriminant) / (2*a);
                
                return {
                    type: 'math',
                    query: equation,
                    result: discriminant === 0 ? `x = ${x1}` : `x₁ = ${x1}, x₂ = ${x2}`,
                    formula: discriminant === 0 ? 
                        `x = \\frac{-${b}}{2${a}}` : 
                        `x_{1,2} = \\frac{-${b} \\pm \\sqrt{${discriminant}}}{2${a}}`,
                    steps: [
                        `Identificar coeficientes: a = ${a}, b = ${b}, c = ${c}`,
                        `Calcular discriminante: Δ = b² - 4ac = ${discriminant}`,
                        discriminant === 0 ? 
                            `Como Δ = 0, hay una solución real doble` :
                            `Como Δ > 0, hay dos soluciones reales`,
                        `Aplicar fórmula cuadrática`
                    ],
                    explanation: discriminant === 0 ? 
                        `La ecuación tiene una solución real doble` :
                        discriminant > 0 ? 
                            `La ecuación tiene dos soluciones reales distintas` :
                            `La ecuación tiene dos soluciones complejas conjugadas`
                };
            } else {
                return {
                    type: 'math',
                    query: equation,
                    result: 'No hay soluciones reales',
                    formula: `x = \\frac{-${b} \\pm i\\sqrt{${-discriminant}}}{2${a}}`,
                    steps: [
                        `El discriminante es negativo: Δ = ${discriminant} < 0`,
                        'Las soluciones son complejas'
                    ],
                    explanation: 'La ecuación no tiene soluciones reales'
                };
            }
        }
        
        return {
            type: 'math',
            query: equation,
            result: 'No pude extraer los coeficientes',
            steps: ['Verifica el formato de la ecuación cuadrática'],
            formula: null
        };
    }

    function solveLimit(query) {
        const match = query.match(/(?:límite|limit)\s+(?:x\s*->\s*([^of]+?)(?:\s+of\s+(.+?))?)/i);
        if (match) {
            const point = match[1] ? match[1].trim() : '0';
            const func = match[2] ? match[2].trim() : 'sin(x)/x';
            
            return {
                type: 'math',
                query: query,
                result: `lim_{x→${point}} ${func}`,
                formula: `\\lim_{x \\to ${point}} ${func}`,
                steps: [
                    `Evaluar el comportamiento de ${func} cuando x se acerca a ${point}`,
                    'Aplicar límite correspondiente'
                ],
                explanation: `El límite de ${func} cuando x tiende a ${point}`
            };
        }
        
        return {
            type: 'math',
            query: query,
            result: 'No pude identificar el límite',
            steps: ['Especifica la función y el punto de aproximación'],
            formula: null
        };
    }

    // Physics solving functions
    function solveKineticEnergy(query) {
        const match = query.match(/(?:energía cinética|kinetic energy).*?m\s*=\s*(\d+\.?\d*).*?v\s*=\s*(\d+\.?\d*)/i);
        if (match) {
            const m = parseFloat(match[1]);
            const v = parseFloat(match[2]);
            const energy = 0.5 * m * v * v;
            
            return {
                type: 'physics',
                query: query,
                result: `${energy.toFixed(2)} J`,
                formula: `E_c = \\frac{1}{2}mv^2 = \\frac{1}{2}(${m})(${v})^2 = ${energy.toFixed(2)} \\text{J}`,
                steps: [
                    `Identificar masa: m = ${m} kg`,
                    `Identificar velocidad: v = ${v} m/s`,
                    `Aplicar fórmula: E_c = ½mv²`,
                    `Calcular: E_c = ½ × ${m} × ${v}² = ${energy.toFixed(2)} J`
                ],
                explanation: `La energía cinética es ${energy.toFixed(2)} julios cuando una masa de ${m} kg se mueve a ${v} m/s`
            };
        }
        
        return {
            type: 'physics',
            query: query,
            result: 'No pude extraer masa y velocidad',
            steps: ['Especifica los valores de masa (m) y velocidad (v)'],
            formula: 'E_c = ½mv²'
        };
    }

    function solveForce(query) {
        const match = query.match(/(?:fuerza|force).*?m\s*=\s*(\d+\.?\d*).*?a\s*=\s*(\d+\.?\d*)/i);
        if (match) {
            const m = parseFloat(match[1]);
            const a = parseFloat(match[2]);
            const force = m * a;
            
            return {
                type: 'physics',
                query: query,
                result: `${force.toFixed(2)} N`,
                formula: `F = ma = (${m})(${a}) = ${force.toFixed(2)} \\text{N}`,
                steps: [
                    `Segunda ley de Newton: F = ma`,
                    `Masa: m = ${m} kg`,
                    `Aceleración: a = ${a} m/s²`,
                    `Calcular: F = ${m} × ${a} = ${force.toFixed(2)} N`
                ],
                explanation: `La fuerza resultante es ${force.toFixed(2)} newtons cuando se aplica una aceleración de ${a} m/s² a una masa de ${m} kg`
            };
        }
        
        return {
            type: 'physics',
            query: query,
            result: 'No pude extraer masa y aceleración',
            steps: ['Especifica los valores de masa (m) y aceleración (a)'],
            formula: 'F = ma'
        };
    }

function solvePendulum(query) {
        const match = query.match(/(?:péndulo|pendulum).*?L\s*=\s*(\d+\.?\d*)/i);
        if (match) {
            const L = parseFloat(match[1]);
            const g = 9.8;
            const period = 2 * Math.PI * Math.sqrt(L / g);
            
            return {
                type: 'physics',
                query: query,
                result: `${period.toFixed(3)} s`,
                formula: `T = 2\\pi\\sqrt{\frac{${L}}{${g}} = ${period.toFixed(3)} \\text{s}`,
                steps: [
                    'Fórmula del péndulo simple: T = 2π√(L/g)',
                    `Longitud: L = ${L} m`,
                    `Gravedad: g = ${g} m/s²`,
                    `Calcular: T = 2π√(${L}/${g}) = ${period.toFixed(3)} s`
                ],
                explanation: `El período del péndulo es ${period.toFixed(3)} segundos para una longitud de ${L} metros`
            };
        }
        
        return {
            type: 'physics',
            query: query,
            result: 'No spesifiklongitud del péndulo',
            steps: ['Usa formato: péndulo L=2'],
            formula: 'T = 2π√(L/g)'
        };
    }

    function solveProjectile(query) {
        const match = query.match(/(?:movimiento parabólico|projectile).*?v0\s*=\s*(\d+\.?\d*).*?angle\s*=\s*(\d+\.?\d*)/i);
        if (match) {
            const v0 = parseFloat(match[1]);
            const angle = parseFloat(match[2]);
            const angleRad = angle * Math.PI / 180;
            const g = 9.8;
            
            const vx = v0 * Math.cos(angleRad);
            const vy = v0 * Math.sin(angleRad);
            const maxHeight = (vy * vy) / (2 * g);
            const range = (v0 * v0 * Math.sin(2 * angleRad)) / g;
            const timeOfFlight = (2 * vy) / g;
            
            return {
                type: 'physics',
                query: query,
                result: `Altura máx: ${maxHeight.toFixed(2)}m, Alcance: ${range.toFixed(2)}m`,
                formula: `h_{max} = \\frac{v_0^2 \\sin^2(\\theta)}{2g}, R = \\frac{v_0^2 \\sin(2\\theta)}{g}`,
                steps: [
                    `Velocidad inicial: v₀ = ${v0} m/s`,
                    `Ángulo: θ = ${angle}°`,
                    `Componentes: vₓ = ${vx.toFixed(2)} m/s, vᵧ = ${vy.toFixed(2)} m/s`,
                    `Altura máxima: h_max = ${maxHeight.toFixed(2)} m`,
                    `Alcance: R = ${range.toFixed(2)} m`,
                    `Tiempo de vuelo: t = ${timeOfFlight.toFixed(2)} s`
                ],
                explanation: `El proyectil alcanza una altura máxima de ${maxHeight.toFixed(2)} metros y un alcance de ${range.toFixed(2)} metros`
            };
        }
        
        return {
            type: 'physics',
            query: query,
            result: 'No pude extraer velocidad inicial y ángulo',
            steps: ['Especifica la velocidad inicial (v0) y el ángulo de lanzamiento'],
            formula: 'h_max = v₀²sin²(θ)/(2g), R = v₀²sin(2θ)/g'
        };
    }

    // Chemistry solving functions
    function balanceChemicalEquation(query) {
        const match = query.match(/(?:balancear|balance)\s*(.+)?\s*->\s*(.+)/i);
        if (match) {
            const reactants = match[1] ? match[1].trim() : '';
            const products = match[2] ? match[2].trim() : '';
            
            // Simple balancing for common reactions
            if (reactants.includes('H2') && reactants.includes('O2') && products.includes('H2O')) {
                return {
                    type: 'chemistry',
                    query: query,
                    result: '2H₂ + O₂ → 2H₂O',
                    formula: `2H_2 + O_2 \\rightarrow 2H_2O`,
                    steps: [
                        'Reacción de formación de agua',
                        'Balancear hidrógeno y oxígeno',
                        'Coeficientes estequiométricos: 2:1:2'
                    ],
                    explanation: 'La reacción balanceada muestra la formación de agua a partir de hidrógeno y oxígeno'
                };
            }
            
            return {
                type: 'chemistry',
                query: query,
                result: 'Ecuación balanceada',
                formula: reactants + ' → ' + products,
                steps: [
                    'Analizar reactivos y productos',
                    'Balancear átomos',
                    'Ajustar coeficientes'
                ],
                explanation: `Reacción química: ${reactants} → ${products}`
            };
        }
        
        return {
            type: 'chemistry',
            query: query,
            result: 'No pude identificar la reacción química',
            steps: ['Especifica la ecuación química con reactivos y productos'],
            formula: null
        };
    }

    function calculateMolarMass(query) {
        const match = query.match(/(?:masa molar|molar mass).*?(\w+)/i);
        if (match) {
            const formula = match[1].toUpperCase();
            
            // Simple molar mass calculations for common compounds
            const molarMasses = {
                'H2O': 18.015,
                'CO2': 44.01,
                'NH3': 17.031,
                'CH4': 16.04,
                'H2': 2.016,
                'O2': 31.998,
                'N2': 28.014
            };
            
            const mass = molarMasses[formula];
            if (mass) {
                return {
                    type: 'chemistry',
                    query: query,
                    result: `${mass.toFixed(3)} g/mol`,
                    formula: formula,
                    steps: [
                        `Fórmula química: ${formula}`,
                        'Sumar masas atómicas',
                        `Resultado: ${mass.toFixed(3)} g/mol`
                    ],
                    explanation: `La masa molar de ${formula} es ${mass.toFixed(3)} gramos por mol`
                };
            }
        }
        
        return {
            type: 'chemistry',
            query: query,
            result: 'No pude identificar el compuesto químico',
            steps: ['Especifica la fórmula química correcta'],
            formula: null
        };
    }

    function calculatePH(query) {
        const match = query.match(/(?:ph)?\s*([a-z]+)\s*(\d+\.?\d*)/i);
        if (match) {
            const acid = match[1].toUpperCase();
            const concentration = parseFloat(match[2]);
            
            // Simple pH calculation for strong acids
            const acidConstants = {
                'HCL': -7,
                'HNO3': -1,
                'H2SO4': 0,
                'H3PO4': 2.15
            };
            
            const pKa = acidConstants[acid];
            if (pKa !== undefined) {
                const pH = pKa - Math.log10(concentration);
                return {
                    type: 'chemistry',
                    query: query,
                    result: `${pH.toFixed(2)}`,
                    formula: `pH = pK_a - \\log_{10}[C] = ${pH.toFixed(2)}`,
                    steps: [
                        `Ácido: ${acid}`,
                        `Concentración: ${concentration} M`,
                        'Aplicar fórmula de pH',
                        `Resultado: ${pH.toFixed(2)}`
                    ],
                    explanation: `El pH de la solución de ${acid} ${concentration} M es ${pH.toFixed(2)}`
                };
            }
        }
        
        return {
            type: 'chemistry',
            query: query,
            result: 'No pude calcular el pH',
            steps: ['Especifica el ácido y la concentración'],
            formula: 'pH = -log₁₀[H⁺]'
        };
    }

    function solveIdealGas(query) {
        // PV = nRT
        const match = query.match(/(?:gas ideal|ideal gas)/i);
        if (match) {
            return {
                type: 'chemistry',
                query: query,
                result: 'PV = nRT',
                formula: 'PV = nRT',
                steps: [
                    'Ley de los gases ideales',
                    'P = presión, V = volumen',
                    'n = moles, R = constante de gases, T = temperatura'
                ],
                explanation: 'La ley de los gases ideales relaciona presión, volumen, moles y temperatura'
            };
        }
        
        return {
            type: 'chemistry',
            query: query,
            result: 'Proporciona valores para P, V, n, o T',
            steps: ['Especifica presión, volumen, moles y temperatura'],
            formula: 'PV = nRT'
        };
    }

    // Geometry solving functions
    function calculateArea(query) {
        const match = query.match(/(?:área|area).*?(\w+)\s+radius\s+(\d+\.?\d*)/i);
        if (match) {
            const shape = match[1].toLowerCase();
            const radius = parseFloat(match[2]);
            
            if (shape.includes('circle') || shape.includes('círculo')) {
                const area = Math.PI * radius * radius;
                return {
                    type: 'geometry',
                    query: query,
                    result: `${area.toFixed(2)} m²`,
                    formula: `A = \\pi r^2 = \\pi(${radius})^2 = ${area.toFixed(2)} \\text{m}^2`,
                    steps: [
                        'Fórmula del área del círculo: A = πr²',
                        `Radio: r = ${radius} m`,
                        `Calcular: A = π × ${radius}² = ${area.toFixed(2)} m²`
                    ],
                    explanation: `El área del círculo con radio ${radius} metros es ${area.toFixed(2)} metros cuadrados`
                };
            }
        }
        
        return {
            type: 'geometry',
            query: query,
            result: 'No pude identificar la figura geométrica',
            steps: ['Especifica la figura (círculo, cuadrado, triángulo, etc.) y las dimensiones'],
            formula: null
        };
    }

    function calculateVolume(query) {
        const match = query.match(/(?:volumen|volume).*?(\w+)\s+radius\s+(\d+\.?\d*)/i);
        if (match) {
            const shape = match[1].toLowerCase();
            const radius = parseFloat(match[2]);
            
            if (shape.includes('sphere') || shape.includes('esfera')) {
                const volume = (4/3) * Math.PI * Math.pow(radius, 3);
                return {
                    type: 'geometry',
                    query: query,
                    result: `${volume.toFixed(2)} m³`,
                    formula: `V = \\frac{4}{3}\\pi r^3 = \\frac{4}{3}\\pi(${radius})^3 = ${volume.toFixed(2)} \\text{m}^3`,
                    steps: [
                        'Fórmula del volumen de la esfera: V = (4/3)πr³',
                        `Radio: r = ${radius} m`,
                        `Calcular: V = (4/3)π × ${radius}³ = ${volume.toFixed(2)} m³`
                    ],
                    explanation: `El volumen de la esfera con radio ${radius} metros es ${volume.toFixed(2)} metros cúbicos`
                };
            }
        }
        
        return {
            type: 'geometry',
            query: query,
            result: 'No pude identificar la figura geométrica',
            steps: ['Especifica la figura (esfera, cubo, cilindro, etc.) y las dimensiones'],
            formula: null
        };
    }

    function solveTriangle(query) {
        const match = query.match(/(?:triángulo|triangle).*?sides\s+(\d+\.?\d*)\s*,\s*(\d+\.?\d*)\s*,\s*(\d+\.?\d*)/i);
        if (match) {
            const a = parseFloat(match[1]);
            const b = parseFloat(match[2]);
            const c = parseFloat(match[3]);
            
            // Check if it's a right triangle
            const isRight = Math.abs(a*a + b*b - c*c) < 0.001;
            
            if (isRight) {
                const area = (a * b) / 2;
                const perimeter = a + b + c;
                return {
                    type: 'geometry',
                    query: query,
                    result: `Área: ${area.toFixed(2)} m², Perímetro: ${perimeter.toFixed(2)} m`,
                    formula: `A = \\frac{ab}{2}, P = a + b + c`,
                    steps: [
                        'Triángulo rectángulo identificado',
                        `Lados: a = ${a} m, b = ${b} m, c = ${c} m`,
                        `Área: A = (a × b) / 2 = ${area.toFixed(2)} m²`,
                        `Perímetro: P = ${a + b + c} = ${perimeter.toFixed(2)} m`,
                        'Verificar: a² + b² = c²'
                    ],
                    explanation: `Triángulo rectángulo con área ${area.toFixed(2)} m² y perímetro ${perimeter.toFixed(2)} m`
                };
            } else {
                const s = perimeter / 2;
                const area = Math.sqrt(s * (s - a) * (s - b) * (s - c));
                return {
                    type: 'geometry',
                    query: query,
                    result: `Área: ${area.toFixed(2)} m², Perímetro: ${perimeter.toFixed(2)} m`,
                    formula: 'A = √[s(s-a)(s-b)(s-c)], P = a + b + c',
                    steps: [
                        'Triángulo escaleno identificado',
                        `Lados: a = ${a} m, b = ${b} m, c = ${c} m`,
                        `Semiperímetro: s = (a + b + c) / 2`,
                        `Área por Herón: A = √[s(s-a)(s-b)(s-c)] = ${area.toFixed(2)} m²`
                    ],
                    explanation: `Triángulo con área ${area.toFixed(2)} m² y perímetro ${perimeter.toFixed(2)} m`
                };
            }
        }
        
        return {
            type: 'geometry',
            query: query,
            result: 'No pude identificar los lados del triángulo',
            steps: ['Especifica los tres lados del triángulo'],
            formula: null
        };
    }

    function solvePythagorean(query) {
        const match = query.match(/(?:pitágoras|pythagorean).*?a\s*=\s*(\d+\.?\d*).*?b\s*=\s*(\d+\.?\d*)/i);
        if (match) {
            const a = parseFloat(match[1]);
            const b = parseFloat(match[2]);
            const c = Math.sqrt(a*a + b*b);
            
            return {
                type: 'geometry',
                query: query,
                result: `c = ${c.toFixed(2)}`,
                formula: `c = \\sqrt{a^2 + b^2} = \\sqrt{${a}^2 + ${b}^2} = ${c.toFixed(2)}`,
                steps: [
                    'Teorema de Pitágoras: c² = a² + b²',
                    `Cateto a: a = ${a}`,
                    `Cateto b: b = ${b}`,
                    `Hipotenusa: c = √(a² + b²) = ${c.toFixed(2)}`
                ],
                explanation: `La hipotenusa es ${c.toFixed(2)} cuando los catetos son ${a} y ${b}`
            };
        }
        
        return {
            type: 'geometry',
            query: query,
            result: 'No pude identificar los catetos',
            steps: ['Especifica los valores de a y b'],
            formula: 'c² = a² + b²'
        };
    }

    // Original loadChallenge function
    function loadChallenge(id) {
        if (!challenges[id]) return;
        currentChallenge = id;
        const ch = challenges[id];

        // Update sidebar selection
        document.querySelectorAll('.challenge-item').forEach(el => el.classList.remove('active'));
        const activeItem = document.querySelector(`.challenge-item[data-challenge="${id}"]`);
        if (activeItem) activeItem.classList.add('active');

        // Reset code and results
        if (editor) {
            editor.setValue(ch.starter || '');
            editor.refresh && editor.refresh();
        }
        consoleOutput = [];
        renderConsole();

        if (ch.type === 'code') {
            showCodeEditor();
        } else {
            showCalculatorPanel(ch);
        }

        // Show description by default
        switchOutput('description');
        showDescription(ch);

        window.history.replaceState({}, '', `?challenge=${encodeURIComponent(id)}`);
    }

    function showCodeEditor() {
        document.getElementById('codeSection').classList.remove('hidden');
        document.getElementById('exerciseSection').classList.add('hidden');
        document.getElementById('exerciseSection').setAttribute('aria-hidden', 'true');
        document.getElementById('runBtn').textContent = '▶ Ejecutar Código';
        document.getElementById('runBtn').disabled = false;
        document.getElementById('resetBtn').disabled = false;
    }

    function showCalculatorPanel(ch) {
        document.getElementById('codeSection').classList.add('hidden');
        document.getElementById('exerciseSection').classList.remove('hidden');
        document.getElementById('exerciseSection').setAttribute('aria-hidden', 'false');
        renderCalculatorContents(ch);
    }

    function renderCalculatorContents(ch) {
        const section = document.getElementById('exerciseSection');

        // Determine exercise type based on materia/category
        const materia = (ch.materia || ch.category || '').toLowerCase();
        let exerciseType = 'calculator';
        let visualizerType = 'default';

        if (materia.includes('matematic') || materia.includes('calculo') || materia.includes('algebra')) {
            exerciseType = 'math';
            visualizerType = ch.graph ? 'graph' : 'formula';
        } else if (materia.includes('fisica') || materia.includes('mecanica')) {
            exerciseType = 'physics';
            visualizerType = ch.simulation ? 'simulation' : 'formula';
        } else if (materia.includes('quimica')) {
            exerciseType = 'chemistry';
            visualizerType = 'molecule';
        } else if (materia.includes('geometria') || materia.includes('trigonometria')) {
            exerciseType = 'geometry';
            visualizerType = 'shape';
        }

        // Generate icon based on type
        const icons = {
            math: '📐',
            physics: '⚛️',
            chemistry: '⚗️',
            geometry: '📏',
            calculator: '🧮'
        };
        const icon = icons[exerciseType] || '🧠';

        // Render formula with KaTeX - simple and direct approach
        const formulaHtml = ch.formula_latex
            ? `<div class="formula-container"><div class="formula-label">Fórmula</div><div class="formula-math" id="mainFormula">${escHtml(ch.formula_latex)}</div></div>`
            : '';

        // Enhanced parameters with visual feedback
        const paramsHtml = Array.isArray(ch.params) && ch.params.length > 0
            ? ch.params.map((param, idx) => `
                <div class="param-item" data-param="${param.name}">
                    <div class="param-header">
                        <label for="param-${param.name}">${escHtml(param.label)}</label>
                        <div class="param-value-badge" id="param-${param.name}-value">${param.value}${param.unit || ''}</div>
                    </div>
                    <div class="param-slider-container">
                        <input type="range" class="param-slider"
                            id="param-${param.name}"
                            name="${escHtml(param.name)}"
                            min="${param.min}"
                            max="${param.max}"
                            step="${param.step}"
                            value="${param.value}"
                            oninput="updateParamValue('${param.name}', '${param.unit || ''}')"
                            style="--progress: ${((param.value - param.min) / (param.max - param.min)) * 100}%">
                        <div class="param-range">
                            <span>${param.min}${param.unit || ''}</span>
                            <span>${param.max}${param.unit || ''}</span>
                        </div>
                    </div>
                </div>
            `).join('')
            : '';

        // Visualization area based on type
        const visualizerHtml = generateVisualizer(ch, visualizerType);

        // Steps or hints section - now with Markdown support for formulas
        const stepsHtml = ch.steps ? `
            <div class="steps-container">
                <div class="steps-title">📋 Pasos para resolver</div>
                ${ch.steps.map((step, i) => `
                    <div class="step-item" data-step="${i}">
                        <div class="step-number">${i + 1}</div>
                        <div class="step-content">${renderMarkdown(step)}</div>
                    </div>
                `).join('')}
            </div>
        ` : '';

        // Theory section
        const theoryHtml = ch.theory ? `
            <div class="theory-box">
                <div class="theory-title">📚 Teoría</div>
                <div class="theory-content">${renderMarkdown(ch.theory)}</div>
            </div>
        ` : '';

        section.innerHTML = `
            <div class="exercise-card exercise-type-${exerciseType}">
                <div class="exercise-header">
                    <div class="exercise-icon">${icon}</div>
                    <div class="exercise-meta">
                        <div class="exercise-title">${escHtml(ch.title)}</div>
                        <div class="exercise-subtitle">${escHtml(ch.category || ch.materia)} · ${escHtml(ch.difficulty || 'Práctica')}</div>
                            <span class="mode-label">Código</span>
                        </button>
                    </div>
                            <div class="result-icon">🎯</div>
                            <div>Ajusta los parámetros y presiona Calcular para ver el resultado</div>
                        </div>
                    </div>
                </div>
            </div>
        `;

        // Initialize visualizer if needed
        if (ch.graph && window.initGraphVisualizer) {
            setTimeout(() => window.initGraphVisualizer(ch), 100);
        }
    }

    // Steps or hints section - now with Markdown support for formulas
    const stepsHtml = ch.steps ? `
        <div class="steps-container">
            <div class="steps-title">📋 Pasos para resolver</div>
            ${ch.steps.map((step, i) => `
                <div class="step-item" data-step="${i}">
                    <div class="step-number">${i + 1}</div>
                    <div class="step-content">${renderMarkdown(step)}</div>
                </div>
            `).join('')}
        </div>
    ` : '';

    // Theory section
    const theoryHtml = ch.theory ? `
        <div class="theory-box">
            <div class="theory-title">📚 Teoría</div>
            <div class="theory-content">${renderMarkdown(ch.theory)}</div>
        </div>
    ` : '';

    section.innerHTML = `
        <div class="exercise-card exercise-type-${exerciseType}">
            <div class="exercise-header">
                <div class="exercise-icon">${icon}</div>
                <div class="exercise-meta">
                    <div class="exercise-title">${escHtml(ch.title)}</div>
                    <div class="exercise-subtitle">${escHtml(ch.category || ch.materia)} · ${escHtml(ch.difficulty || 'Práctica')}</div>
                </div>
            </div>

            <div class="exercise-content">
                <div class="exercise-description">${escHtml(ch.description)}</div>

                ${theoryHtml}
                ${formulaHtml}
                ${stepsHtml}

                <div class="params-section">
                    <div class="params-title">⚙️ Parámetros</div>
                    <div class="calculator-params">${paramsHtml}</div>
                </div>

                ${visualizerHtml}

                <div class="exercise-actions">
                    <button class="btn btn-run" onclick="runCalculator()">
                        <span>▶</span> Calcular
                    </button>
                    <button class="btn btn-secondary" onclick="resetExercise()">
                        <span>🔄</span> Restablecer
                    </button>
                    ${ch.hint ? `<button class="btn btn-hint" onclick="toggleHint()">
                        <span>💡</span> Pista
                    </button>` : ''}
                </div>

                ${ch.hint ? `<div class="hint-box hidden" id="hintBox">${renderMarkdown(ch.hint)}</div>` : ''}

                <div class="exercise-result" id="exerciseResult">
                    <div class="result-placeholder">
                        <div class="result-icon">🎯</div>
                        <div>Ajusta los parámetros y presiona Calcular para ver el resultado</div>
                    </div>
                </div>
            </div>
        </div>
    `;

    // Initialize visualizer if needed
    if (ch.graph && window.initGraphVisualizer) {
        setTimeout(() => window.initGraphVisualizer(ch), 100);
    }

    // Render main formula immediately if exists
    if (ch.formula_latex) {
        const formulaElement = section.querySelector('#mainFormula');
        if (formulaElement) {
            // Try KaTeX first with enhanced configuration
            if (window.katex) {
                try {
                    katex.render(ch.formula_latex, formulaElement, {
                        displayMode: true,
                        throwOnError: false,
                        strict: false,
                        macros: {
                            '\\E': '\\mathcal{E}',
                            '\\c': '\\mathcal{c}',
                            '\\m': '\\mathcal{m}',
                            '\\v': '\\mathbf{v}',
                            '\\masa': '\\text{masa}',
                            '\\velocidad': '\\text{velocidad}'
                        }
                    });
                } catch (e) {
                    console.error('KaTeX render error:', e);
                    // Fallback to plain text
                    formulaElement.innerHTML = `<span style="font-family: 'Times New Roman', serif; font-style: italic; color: var(--cyan); font-size: 18px; white-space: nowrap;">${escHtml(ch.formula_latex)}</span>`;
                }
            } else {
                // No KaTeX loaded
                formulaElement.innerHTML = `<span style="font-family: 'Times New Roman', serif; font-style: italic; color: var(--cyan); font-size: 18px; white-space: nowrap;">${escHtml(ch.formula_latex)}</span>`;
            }
        }
    }

    function renderFormula(formula, element, displayMode = false) {
        if (!window.katex || !element) return;
        try {
            katex.render(formula, element, {
                displayMode: displayMode,
                throwOnError: false,
                strict: false,
                macros: {
                    '\\lim': '\\lim\\limits',
                    '\\to': '\\rightarrow'
                }
            });
            return true;
        } catch (e) {
            console.error('KaTeX render error:', e);
            element.innerHTML = `<code style="color:#ff3cac">${escHtml(formula)}</code>`;
            return false;
        }
    }

    function generateVisualizer(ch, type) {
        if (type === 'graph' && ch.graph) {
            return `
                <div class="visualizer-container">
                    <div class="visualizer-title">📊 Gráfico</div>
                    <canvas id="graphCanvas" class="graph-canvas" width="600" height="300"></canvas>
                    <div class="graph-controls">
                        <button onclick="zoomGraph(1.2)">+</button>
                        <button onclick="zoomGraph(0.8)">-</button>
                        <button onclick="resetGraph()">⟲</button>
                    </div>
                </div>
            `;
        }
        if (type === 'simulation' && ch.simulation) {
            return `
                <div class="visualizer-container">
                    <div class="visualizer-title">🔬 Simulación</div>
                    <canvas id="simCanvas" class="sim-canvas" width="600" height="300"></canvas>
                    <div class="sim-controls">
                        <button onclick="toggleSimulation()" id="simToggle">▶ Play</button>
                        <button onclick="resetSimulation()">⟲ Reset</button>
                    </div>
                </div>
            `;
        }
        if (type === 'shape' && ch.shape) {
            return `
                <div class="visualizer-container">
                    <div class="visualizer-title">📐 Visualización Geométrica</div>
                    <canvas id="geoCanvas" class="geo-canvas" width="400" height="400"></canvas>
                    <div class="geo-labels" id="geoLabels"></div>
                </div>
            `;
        }
        return '';
    }

    function updateParamValue(name, unit = '') {
        const input = document.getElementById(`param-${name}`);
        const output = document.getElementById(`param-${name}-value`);
        if (input && output) {
            const value = input.value;
            output.textContent = value + unit;

            // Update slider progress visual
            const min = Number(input.min);
            const max = Number(input.max);
            const progress = ((value - min) / (max - min)) * 100;
            input.style.setProperty('--progress', `${progress}%`);
        }
    }

    function toggleHint() {
        const hintBox = document.getElementById('hintBox');
        if (hintBox) {
            hintBox.classList.toggle('hidden');
            if (!hintBox.classList.contains('hidden')) {
                hintBox.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            }
        }
    }

    function runCalculator() {
        const ch = challenges[currentChallenge];
        if (!ch || ch.type === 'code') return;

        const resultContainer = document.getElementById('exerciseResult');
        resultContainer.innerHTML = '<div class="result-loading"><div class="spinner"></div>Calculando...</div>';

        const params = {};
        if (Array.isArray(ch.params)) {
            ch.params.forEach(param => {
                const input = document.getElementById(`param-${param.name}`);
                params[param.name] = input ? Number(input.value) : param.value || 0;
            });
        }

        let result = null;
        try {
            const keys = Object.keys(params);
            const values = Object.values(params);
            const expression = ch.calculate || '';
            if (!expression) throw new Error('No se encontró expresión para calcular.');

            const fn = new Function(...keys, `return ${expression};`);
            result = fn(...values);
            const formatted = typeof result === 'number' ? Number(result.toFixed(6)) : result;

            // Determine result status
            let status = 'success';
            let statusIcon = '✅';
            if (ch.answer != null) {
                const tolerance = ch.tolerance || 0.01;
                const diff = Math.abs(result - ch.answer);
                if (diff <= tolerance) {
                    status = 'success';
                    statusIcon = '🎉';
                } else {
                    status = 'warning';
                    statusIcon = '⚠️';
                }
            }

            // Build params summary
            const paramsSummary = Object.entries(params)
                .map(([k, v]) => `<span class="param-tag">${escHtml(k)} = ${v}</span>`)
                .join('');

            resultContainer.innerHTML = `
                <div class="result-display result-${status}">
                    <div class="result-header">
                        <span class="result-status-icon">${statusIcon}</span>
                        <span class="result-label">Resultado</span>
                    </div>
                    <div class="result-value">${formatted}${ch.resultUnit || ''}</div>
                    ${ch.answer != null ? `
                        <div class="result-expected">
                            Valor esperado: ${ch.answer}${ch.resultUnit || ''}
                            ${status === 'success' ? '<span class="result-check">¡Correcto!</span>' : ''}
                        </div>
                    ` : ''}
                    <div class="result-params">${paramsSummary}</div>
                </div>
            `;

            // Update graph/visualization if exists
            if (ch.graph && window.updateGraph) {
                window.updateGraph(params, result);
            }

        } catch (err) {
            const ch = challenges[currentChallenge];
            resultContainer.innerHTML = `
                <div class="result-display result-error">
                    <div class="result-header">
                        <span class="result-status-icon">❌</span>
                        <span class="result-label">Error</span>
                    </div>
                    <div class="result-error-message">${escHtml(err.message)}</div>
                </div>
            `;
        }
    }

    function resetExercise() {
        const ch = challenges[currentChallenge];
        if (!ch || ch.type === 'code') return;
        renderCalculatorContents(ch);
    }

    function showDescription(ch) {
        const content = document.getElementById('outputContent');
        const testsHtml = ch.tests && ch.tests.length > 0
            ? ch.tests.map((t, i) => `
                <div class="test-result" style="background:var(--surface);padding:12px;border-radius:8px;margin:8px 0;">
                    <div class="test-header">
                        <span class="test-icon">🧪</span>
                        <span class="test-name">Test ${i+1}</span>
                    </div>
                    <div style="font-size:12px;color:var(--muted);margin-top:8px;line-height:1.5;">
                        Input: <code>${escHtml(JSON.stringify(t.input))}</code><br>
                        Esperado: <code>${escHtml(JSON.stringify(t.expected))}</code>
                    </div>
                </div>
            `).join('')
            : '<div style="color:var(--muted);font-size:12px;">No hay tests definidos para este desafío.</div>';

        content.innerHTML = `
            <div style="padding:16px;border-bottom:1px solid var(--border);">
                <div style="display:flex;align-items:center;gap:10px;margin-bottom:12px;flex-wrap:wrap;">
                    <div>
                        <h2 style="font-size:18px;font-weight:700;margin-bottom:6px;">${escHtml(ch.title)}</h2>
                        <div style="display:flex;gap:8px;flex-wrap:wrap;align-items:center;">
                            <span class="problem-badge">${escHtml(ch.difficulty)}</span>
                            <span style="background:var(--green);color:var(--bg);padding:4px 10px;border-radius:10px;font-size:11px;font-weight:600;">${ch.points} pts</span>
                        </div>
                    </div>
                </div>
                <div style="color:var(--text-secondary);font-size:13px;line-height:1.7;">${renderMarkdown(ch.description || 'Descripción no disponible.')}</div>
            </div>
            <div style="padding:16px;border-bottom:1px solid var(--border);">
                <h4 style="font-size:12px;color:var(--muted);margin-bottom:10px;text-transform:uppercase;">💡 Pista</h4>
                <div class="hint-box">${renderMarkdown(ch.hint || 'Sin pista disponible. Escribe "ayuda" al chatbot para más orientación.')}</div>
            </div>
            <div style="padding:16px;border-bottom:1px solid var(--border);">
                <h4 style="font-size:12px;color:var(--muted);margin-bottom:10px;text-transform:uppercase;">📖 Teoría</h4>
                <div class="theory-box">${renderMarkdown(ch.theory || 'Sin teoría disponible.')}</div>
            </div>
            <div style="padding:16px;">
                <h4 style="font-size:12px;color:var(--muted);margin-bottom:10px;text-transform:uppercase;">📝 Ejemplos y Tests</h4>
                ${testsHtml}
            </div>
        `;
    }

    function switchOutput(tab, evt) {
        currentOutput = tab;
        document.querySelectorAll('.output-tab').forEach(t => t.classList.remove('active'));
        if (evt && evt.target) evt.target.classList.add('active');

        if (tab === 'console') renderConsole();
        else if (tab === 'tests') {
            const ch = challenges[currentChallenge];
            if (ch.tests && ch.tests.length > 0) {
                document.getElementById('outputContent').innerHTML = ch.tests.map((t, i) => `
                    <div class="test-result" style="background:var(--surface);border:1px solid var(--border);">
                        <div class="test-header">
                            <span class="test-icon">⏳</span>
                            <span class="test-name">Test ${i+1}</span>
                        </div>
                        <div style="font-size:11px;color:var(--muted);margin-top:4px;">
                            Input: ${JSON.stringify(t.input)} → Expected: ${JSON.stringify(t.expected)}
                        </div>
                    </div>
                `).join('');
            }
        }
        else if (tab === 'description') showDescription(challenges[currentChallenge]);
    }

    // Console
    function logToConsole(type, msg) {
        consoleOutput.push({ type, message: msg, time: Date.now() });
        if (currentOutput === 'console') renderConsole();
    }

    function renderConsole() {
        const content = document.getElementById('outputContent');
        if (consoleOutput.length === 0) {
            content.innerHTML = `
                <div style="padding:16px;">
                    <h3 style="color:var(--cyan);margin-bottom:12px;">🎮 Consola de Código</h3>
                    <p style="color:var(--muted);font-size:12px;margin-bottom:16px;">
                        Escribe tu código en el editor y presiona <strong style="color:var(--green)">▶ Ejecutar Código</strong>
                    </p>
                    <div style="background:var(--surface2);padding:12px;border-radius:8px;font-size:12px;">
                        <div style="color:var(--yellow);margin-bottom:8px;">📋 Instrucciones:</div>
                        <ul style="color:var(--text-secondary);padding-left:16px;line-height:1.8;">
                            <li>Escribe una función llamada <code style="color:var(--cyan)">solve(input)</code></li>
                            <li>Usa <code style="color:var(--cyan)">console.log()</code> para depurar</li>
                            <li>Presiona "Ejecutar Código" para probar</li>
                            <li>Revisa los resultados en esta consola</li>
                        </ul>
                    </div>
                </div>
            `;
            return;
        }
        content.innerHTML = consoleOutput.map(c => 
            `<div class="console-line ${c.type}">${escHtml(String(c.message))}</div>`
        ).join('');
    }

    // Store last test results for display
    let lastTestResults = null;
    let lastCodeResult = null;
    let aiRecommendations = [];

    // Run Code with real-time results
    function runCode() {
        const ch = challenges[currentChallenge];
        if (!ch || ch.type !== 'code') {
            logToConsole('warn', 'Este desafío no usa editor de código. Selecciona un desafío de programación.');
            return;
        }

        const code = editor.getValue();
        clearConsole();
        logToConsole('log', '▶ Ejecutando código...');

        // Update status bar
        updateOutputStatus('running');

        const customConsole = {
            log: (...args) => logToConsole('log', args.map(a => typeof a === 'object' ? JSON.stringify(a, null, 2) : String(a)).join(' ')),
            error: (...args) => logToConsole('error', args.join(' ')),
            warn: (...args) => logToConsole('warn', args.join(' ')),
            info: (...args) => logToConsole('info', args.join(' '))
        };

        let fn = null;
        try {
            fn = new Function('console', `"use strict"; ${code}; return typeof solve !== 'undefined' ? solve : null;`)(customConsole);
            if (typeof fn === 'function') {
                logToConsole('success', '✓ Código compilado correctamente');
                runTests(fn);
            } else {
                logToConsole('error', '⚠️ No se encontró la función solve()');
                updateOutputStatus('error', 'No se encontró la función solve()');
                showResultPanel('error', 'No se encontró la función solve()');
            }
        } catch (e) {
            logToConsole('error', '❌ Error de sintaxis: ' + e.message);
            updateOutputStatus('error', 'Error de sintaxis');
            showResultPanel('error', e.message);
            // Generate AI recommendation for syntax error
            generateAIRecommendations('syntax_error', e.message, code);
        }

        // Switch to result tab to show output
        switchOutputTab('result');
    }

    function runTests(fn) {
        const ch = challenges[currentChallenge];
        const tests = ch.tests || [];

        if (tests.length === 0) {
            logToConsole('info', 'No hay tests definidos para este desafío.');
            updateOutputStatus('info', 'Sin tests');
            return;
        }

        let passed = 0;
        const results = [];
        let firstResult = null;

        tests.forEach((t, i) => {
            try {
                let result = fn(...t.input);
                let pass;
                if (Array.isArray(result)) {
                    pass = JSON.stringify(result) === JSON.stringify(t.expected);
                } else {
                    pass = result === t.expected || JSON.stringify(result) === JSON.stringify(t.expected);
                }
                if (pass) passed++;

                // Store first result for display
                if (i === 0) {
                    firstResult = result;
                    lastCodeResult = result;
                }

                results.push({ pass, result, expected: t.expected, input: t.input, index: i });
            } catch (e) {
                results.push({ pass: false, error: e.message, input: t.input, index: i });
            }
        });

        lastTestResults = results;

        // Update console with test results
        renderTestResultsToConsole(results);

        // Show detailed result in result panel
        showResultPanel(passed === tests.length ? 'success' : 'partial', firstResult, passed, tests.length, results);

        // Update status bar
        updateOutputStatus(passed === tests.length ? 'pass' : 'fail', `${passed}/${tests.length}`);

        // Generate AI recommendations based on results
        generateAIRecommendations(passed === tests.length ? 'success' : 'failure', null, editor.getValue(), results, ch);

        if (passed === tests.length && tests.length > 0) {
            logToConsole('success', `🎉 ¡Todos los tests pasaron! (${passed}/${tests.length})`);
            if (!isCompleted(currentChallenge)) {
                showXP(ch.points);
                saveProgress(currentChallenge, true);
                refreshBadges();
            }
        } else {
            logToConsole('error', `❌ ${passed}/${tests.length} tests pasaron`);
        }
    }

    function renderTestResultsToConsole(results) {
        results.forEach((r, i) => {
            if (r.pass) {
                logToConsole('success', `✓ Test ${i+1}: PASSED`);
            } else {
                logToConsole('error', `✗ Test ${i+1}: FAILED`);
                logToConsole('info', `  Input: ${JSON.stringify(r.input)}`);
                logToConsole('info', `  Expected: ${JSON.stringify(r.expected)}`);
                logToConsole('info', `  Got: ${r.error ? r.error : JSON.stringify(r.result)}`);
            }
        });
    }

    function showResultPanel(status, result, passed, total, allResults) {
        const content = document.getElementById('outputContent');

        if (status === 'error') {
            content.innerHTML = `
                <div class="result-container">
                    <div class="result-label">Error de ejecución:</div>
                    <div class="result-value result-error">${escHtml(String(result))}</div>
                </div>
            `;
            return;
        }

        const resultStr = typeof result === 'object' ? JSON.stringify(result, null, 2) : String(result);
        const statusClass = status === 'success' ? 'result-success' : (status === 'partial' ? '' : '');
        const statusIcon = status === 'success' ? '✅' : (status === 'partial' ? '⚠️' : '❌');

        let testDetailsHtml = '';
        if (allResults) {
            testDetailsHtml = allResults.map((r, i) => `
                <div style="margin-top: 8px; padding: 8px; background: var(--vscode-sidebar); border-radius: 4px; border-left: 3px solid ${r.pass ? 'var(--vscode-green)' : 'var(--vscode-red)'};">
                    <div style="font-size: 11px; color: ${r.pass ? 'var(--vscode-green)' : 'var(--vscode-red)'}; font-weight: 600;">
                        ${r.pass ? '✓' : '✗'} Test ${i+1}
                    </div>
                    <div style="font-size: 11px; color: var(--vscode-text-inactive); margin-top: 4px;">
                        Input: <code>${JSON.stringify(r.input)}</code>
                    </div>
                    ${!r.pass ? `
                    <div style="font-size: 11px; color: var(--vscode-text-inactive); margin-top: 2px;">
                        Expected: <code style="color: var(--vscode-green)">${JSON.stringify(r.expected)}</code>
                    </div>
                    <div style="font-size: 11px; color: var(--vscode-text-inactive); margin-top: 2px;">
                        Got: <code style="color: var(--vscode-red)">${r.error ? r.error : JSON.stringify(r.result)}</code>
                    </div>
                    ` : `
                    <div style="font-size: 11px; color: var(--vscode-text-inactive); margin-top: 2px;">
                        Result: <code style="color: var(--vscode-green)">${JSON.stringify(r.result)}</code>
                    </div>
                    `}
                </div>
            `).join('');
        }

        content.innerHTML = `
            <div class="result-container">
                <div class="result-label">${statusIcon} Resultado del código:</div>
                <div class="result-value ${statusClass}"><code>${escHtml(resultStr)}</code></div>
                ${passed !== undefined ? `
                <div style="margin-top: 16px; padding-top: 12px; border-top: 1px solid var(--vscode-border);">
                    <div class="result-label">Resumen de tests:</div>
                    <div style="font-size: 14px; margin-top: 8px;">
                        <span style="color: ${passed === total ? 'var(--vscode-green)' : 'var(--vscode-yellow)'}; font-weight: 600;">
                            ${passed}/${total} tests pasaron
                        </span>
                    </div>
                    <div style="margin-top: 12px;">
                        ${testDetailsHtml}
                    </div>
                </div>
                ` : ''}
            </div>
        `;
    }

    function updateOutputStatus(status, message) {
        const statusResult = document.getElementById('statusResult');
        const statusTests = document.getElementById('statusTests');

        if (!statusResult) return;

        const statusMap = {
            'running': { text: '⏳ Ejecutando...', class: '' },
            'pass': { text: '✓ Tests pasados', class: 'status-pass' },
            'fail': { text: `✗ ${message || 'Tests fallaron'}`, class: 'status-fail' },
            'error': { text: `❌ ${message || 'Error'}`, class: 'status-fail' },
            'info': { text: `ℹ ${message || 'Info'}`, class: '' }
        };

        const s = statusMap[status] || statusMap['info'];
        statusResult.textContent = s.text;
        statusResult.className = 'status-item ' + s.class;

        if (statusTests && message && (status === 'pass' || status === 'fail')) {
            statusTests.textContent = `Tests: ${message}`;
        }
    }

    // AI Recommendations in real-time
    async function generateAIRecommendations(status, errorMessage, code, testResults, challenge) {
        const ch = challenge || challenges[currentChallenge];

        // Show loading state in AI tab
        showAILoading();

        // Build context for AI
        let context = `Desafío: ${ch.title}\n`;
        context += `Descripción: ${ch.description}\n`;
        context += `Dificultad: ${ch.difficulty}\n`;

        if (testResults) {
            context += `\nResultados de tests:\n`;
            testResults.forEach((r, i) => {
                context += `Test ${i+1}: ${r.pass ? 'PASSED' : 'FAILED'}\n`;
                if (!r.pass) {
                    context += `  - Input: ${JSON.stringify(r.input)}\n`;
                    context += `  - Esperado: ${JSON.stringify(r.expected)}\n`;
                    context += `  - Obtenido: ${r.error ? r.error : JSON.stringify(r.result)}\n`;
                }
            });
        }

        if (errorMessage) {
            context += `\nError: ${errorMessage}\n`;
        }

        context += `\nCódigo actual:\n\`\`\`javascript\n${code}\n\`\`\``;

        try {
            const formData = new FormData();
            formData.append('question', `Dame recomendaciones específicas para mejorar este código. Sé conciso y da 3-4 puntos clave. Contexto:\n${context}`);
            formData.append('lesson_title', ch.title || 'Laboratorio');
            formData.append('lesson_subject', ch.materia || 'Programación');
            formData.append('slug', currentChallenge);
            formData.append('correctas', testResults ? String(testResults.filter(r => r.pass).length) : '0');
            formData.append('total', testResults ? String(testResults.length) : '1');
            formData.append('provider', 'auto');

            const response = await fetch('ai_tutor.php', {
                method: 'POST',
                body: formData
            });

            const data = await response.json();

            if (data.ok && data.ai_text) {
                // Parse recommendations from AI response
                const recs = parseRecommendations(data.ai_text);
                aiRecommendations = recs;
                showAIRecommendations(recs);
            } else {
                // Fallback recommendations based on status
                showFallbackRecommendations(status, testResults);
            }
        } catch (e) {
            console.error('Error getting AI recommendations:', e);
            showFallbackRecommendations(status, testResults);
        }
    }

    function parseRecommendations(aiText) {
        // Try to extract structured recommendations from AI text
        const recs = [];
        const lines = aiText.split('\n');

        let currentRec = null;
        lines.forEach(line => {
            // Look for numbered items or bullet points
            const match = line.match(/^(\d+)[.\)]\s*\*\*(.+?)\*\*[:\s]*(.+)?$/) ||
                         line.match(/^[-•]\s*\*\*(.+?)\*\*[:\s]*(.+)?$/) ||
                         line.match(/^(\d+)[.\)]\s*(.+)$/);

            if (match) {
                if (currentRec) recs.push(currentRec);
                currentRec = {
                    title: match[2] || match[1],
                    content: match[3] || ''
                };
            } else if (currentRec && line.trim()) {
                currentRec.content += ' ' + line.trim();
            }
        });

        if (currentRec) recs.push(currentRec);

        // If no structured recommendations found, create generic ones from text
        if (recs.length === 0) {
            const paragraphs = aiText.split('\n\n').filter(p => p.trim().length > 20);
            paragraphs.slice(0, 4).forEach((p, i) => {
                recs.push({
                    title: `Recomendación ${i+1}`,
                    content: p.replace(/\*\*/g, '').trim()
                });
            });
        }

        return recs.slice(0, 4); // Max 4 recommendations
    }

    function showAIRecommendations(recs) {
        const content = document.getElementById('outputContent');
        if (currentOutput !== 'ai') return;

        const recsHtml = recs.length > 0 ? recs.map((r, i) => `
            <div class="ai-recommendation-item">
                <div class="rec-title">${escHtml(r.title)}</div>
                <div class="rec-content">${renderMarkdown(r.content)}</div>
            </div>
        `).join('') : `
            <div style="padding: 12px; color: var(--vscode-text-inactive); font-size: 12px;">
                No hay recomendaciones disponibles.
            </div>
        `;

        content.innerHTML = `
            <div class="ai-recommendations">
                <div class="ai-header">
                    <span>🤖</span>
                    <span style="font-weight: 600; color: var(--vscode-cyan);">Recomendaciones de IA</span>
                    <span class="ai-status">● Análisis completo</span>
                </div>
                ${recsHtml}
                <div style="margin-top: 12px; padding-top: 12px; border-top: 1px solid var(--vscode-border); font-size: 11px; color: var(--vscode-text-inactive);">
                    💡 Tip: Escribe en el chat para preguntas específicas sobre tu código.
                </div>
            </div>
        `;
    }

    function showAILoading() {
        if (currentOutput !== 'ai') return;
        const content = document.getElementById('outputContent');
        content.innerHTML = `
            <div class="ai-recommendations">
                <div class="ai-header">
                    <span>🤖</span>
                    <span style="font-weight: 600; color: var(--vscode-cyan);">Recomendaciones de IA</span>
                </div>
                <div class="ai-loading">
                    <div class="spinner"></div>
                    <span>Analizando tu código y generando recomendaciones...</span>
                </div>
            </div>
        `;
    }

    function showFallbackRecommendations(status, testResults) {
        const recs = [];

        if (status === 'syntax_error') {
            recs.push({
                title: 'Revisa la sintaxis',
                content: 'Hay un error de sintaxis en tu código. Verifica que todas las llaves, paréntesis y comillas estén cerrados correctamente.'
            });
            recs.push({
                title: 'Función solve',
                content: 'Asegúrate de que tu función se llame exactamente `solve` y que reciba los parámetros correctos.'
            });
        } else if (status === 'success') {
            recs.push({
                title: '¡Excelente trabajo!',
                content: 'Tu código pasa todos los tests. Considera si hay formas de optimizarlo o hacerlo más legible.'
            });
        } else if (status === 'failure' && testResults) {
            const failedTests = testResults.filter(r => !r.pass);
            recs.push({
                title: `Revisa ${failedTests.length} test(s) fallido(s)`,
                content: 'Compara cuidadosamente el resultado esperado con el que obtuviste. Presta atención a los tipos de datos (números vs strings).'
            });
            recs.push({
                title: 'Debugging',
                content: 'Usa console.log() dentro de tu función para ver qué valores tienes en cada paso.'
            });
        }

        recs.push({
            title: 'Documentación',
            content: 'Agrega comentarios explicando tu lógica. Esto ayuda a entender el código después.'
        });

        aiRecommendations = recs;
        showAIRecommendations(recs);
    }

    function switchOutputTab(tab) {
        currentOutput = tab;

        // Update tab UI
        document.querySelectorAll('.output-tab').forEach(t => t.classList.remove('active'));
        const tabEl = document.querySelector(`.output-tab[onclick*="'${tab}'"]`);
        if (tabEl) tabEl.classList.add('active');

        // Render appropriate content
        const content = document.getElementById('outputContent');
        if (tab === 'console') {
            renderConsole();
        } else if (tab === 'result') {
            if (lastTestResults) {
                const passed = lastTestResults.filter(r => r.pass).length;
                const total = lastTestResults.length;
                const status = passed === total ? 'success' : 'partial';
                showResultPanel(status, lastCodeResult, passed, total, lastTestResults);
            } else {
                content.innerHTML = `
                    <div class="result-container">
                        <div class="result-label">Aún no hay resultados</div>
                        <div style="font-size: 12px; color: var(--vscode-text-inactive); margin-top: 8px;">
                            Presiona "Ejecutar Código" para ver los resultados aquí.
                        </div>
                    </div>
                `;
            }
        } else if (tab === 'ai') {
            if (aiRecommendations.length > 0) {
                showAIRecommendations(aiRecommendations);
            } else {
                content.innerHTML = `
                    <div class="ai-recommendations">
                        <div class="ai-header">
                            <span>🤖</span>
                            <span style="font-weight: 600; color: var(--vscode-cyan);">Recomendaciones de IA</span>
                        </div>
                        <div style="padding: 12px; color: var(--vscode-text-inactive); font-size: 12px;">
                            Ejecuta tu código para obtener recomendaciones de la IA en tiempo real.
                        </div>
                    </div>
                `;
            }
        } else if (tab === 'tests') {
            showTestPanel();
        } else if (tab === 'description') {
            showDescription(challenges[currentChallenge]);
        }
    }

    function showTestPanel() {
        const ch = challenges[currentChallenge];
        const content = document.getElementById('outputContent');

        if (!ch.tests || ch.tests.length === 0) {
            content.innerHTML = `
                <div style="padding: 16px; color: var(--vscode-text-inactive); font-size: 13px;">
                    No hay tests definidos para este desafío.
                </div>
            `;
            return;
        }

        content.innerHTML = `
            <div style="padding: 12px;">
                <div style="font-size: 12px; color: var(--vscode-text-inactive); margin-bottom: 12px;">
                    ${ch.tests.length} test(s) definido(s):
                </div>
                ${ch.tests.map((t, i) => `
                    <div class="test-result" style="margin-bottom: 8px; ${lastTestResults && lastTestResults[i] ? (lastTestResults[i].pass ? 'border-color: rgba(78, 201, 176, 0.3);' : 'border-color: rgba(244, 135, 113, 0.3);') : ''}">
                        <div class="test-header">
                            <span class="test-icon">${lastTestResults && lastTestResults[i] ? (lastTestResults[i].pass ? '✅' : '❌') : '⏳'}</span>
                            <span class="test-name" style="color: ${lastTestResults && lastTestResults[i] ? (lastTestResults[i].pass ? 'var(--vscode-green)' : 'var(--vscode-red)') : 'var(--vscode-text)'};">Test ${i+1}</span>
                        </div>
                        <div style="font-size: 11px; color: var(--vscode-text-inactive); margin-top: 6px;">
                            <div>Input: <code>${JSON.stringify(t.input)}</code></div>
                            <div style="margin-top: 2px;">Expected: <code>${JSON.stringify(t.expected)}</code></div>
                        </div>
                    </div>
                `).join('')}
            </div>
        `;
    }

    // Override the original switchOutput function
    function switchOutput(tab, evt) {
        switchOutputTab(tab);
        if (evt && evt.target) {
            document.querySelectorAll('.output-tab').forEach(t => t.classList.remove('active'));
            evt.target.classList.add('active');
        }
    }

    function resetCode() {
        const ch = challenges[currentChallenge];
        if (!ch || ch.type !== 'code') return;
        editor.setValue(ch.starter || '');
        clearConsole();
    }

    function clearConsole() {
        consoleOutput = [];
        renderConsole();
    }

    // Chat
    async function sendMessage() {
        try {
            const input = document.getElementById('chatInput');
            if (!input) return;
            
            const msg = input.value.trim();
            if (!msg) return;

            // Add user message
            addMessage('user', msg);
            input.value = '';
            input.disabled = true;

            // Show typing indicator
            const messages = document.getElementById('chatMessages');
            const typingDiv = document.createElement('div');
            typingDiv.className = 'chat-message';
            typingDiv.id = 'typingIndicator';
            typingDiv.innerHTML = `
                <div class="message-avatar ai">🤖</div>
                <div class="typing-indicator"><span></span><span></span><span></span></div>
            `;
            messages.appendChild(typingDiv);
            messages.scrollTop = messages.scrollHeight;

            // Try to call the AI API
            try {
                const ch = challenges[currentChallenge] || {title: 'Laboratorio', materia: 'Programación', slug: currentChallenge};
                
                const formData = new FormData();
                formData.append('question', msg);
                formData.append('lesson_title', ch.title || 'Laboratorio de Código');
                formData.append('lesson_subject', ch.materia || 'Programación');
                formData.append('slug', currentChallenge);
                formData.append('correctas', '5');
                formData.append('total', '6');
                formData.append('provider', 'auto');

                const response = await fetch('ai_tutor.php', {
                    method: 'POST',
                    body: formData
                });

                const data = await response.json();
                
                typingDiv.remove();
                
                if (data.ok && data.ai_text) {
                    addMessage('ai', data.ai_text);
                } else {
                    // Fallback to local response
                    const localResponse = generateResponse(msg, ch);
                    addMessage('ai', localResponse + '\n\n⚠️ *La IA principal no respondió, pero aquí tienes información relevante.*');
                }
            } catch (apiError) {
                console.error('API Error:', apiError);
                // Fallback to local response
                typingDiv.remove();
                const ch = challenges[currentChallenge] || {title: 'Laboratorio', materia: 'Programación'};
                const localResponse = generateResponse(msg, ch);
                addMessage('ai', localResponse + '\n\n💡 *Respuesta local (la API no está disponible)*');
            }
            
            input.disabled = false;
            input.focus();
        } catch (e) {
            console.error('Error en sendMessage:', e);
            const messages = document.getElementById('chatMessages');
            const typingEl = document.getElementById('typingIndicator');
            if (typingEl) typingEl.remove();
            addMessage('ai', '❌ Error: ' + e.message);
            document.getElementById('chatInput').disabled = false;
        }
    }

    function addMessage(role, content) {
        const messages = document.getElementById('chatMessages');
        const div = document.createElement('div');
        div.className = `chat-message ${role}`;
        
        const renderedContent = role === 'ai' ? renderMarkdown(content) : escHtml(content);
        
        div.innerHTML = `
            <div class="message-avatar ${role === 'ai' ? 'ai' : ''}">${role === 'ai' ? '🤖' : '👤'}</div>
            <div class="message-content">
                ${renderedContent}
            </div>
        `;

        // Render math formulas in chat messages
        if (window.renderMathInElement && role === 'ai') {
            setTimeout(() => {
                try {
                    renderMathInElement(div.querySelector('.message-content'), {
                        delimiters: [
                            {left: '$$', right: '$$', display: true},
                            {left: '$', right: '$', display: false}
                        ],
                        throwOnError: false,
                        errorColor: '#ff3cac',
                        strict: false,
                        macros: {
                            '\\E': '\\mathcal{E}',
                            '\\c': '\\mathcal{c}',
                            '\\m': '\\mathcal{m}',
                            '\\v': '\\mathbf{v}',
                            '\\masa': '\\text{masa}',
                            '\\velocidad': '\\text{velocidad}',
                            '\\lim': '\\lim\\limits',
                            '\\to': '\\rightarrow',
                            '\\cdot': '\\cdot'
                        }
                    });
                } catch (e) {
                    console.warn('Chat KaTeX render warning:', e);
                }
            }, 50);
        }
        messages.appendChild(div);
        messages.scrollTop = messages.scrollHeight;
    }

    function generateResponse(msg, ch) {
        const lower = msg.toLowerCase();
        
        // Help command
        if (lower === 'ayuda' || lower === 'help' || lower === 'comandos') {
            return `**📚 Comandos disponibles:**

- **test** o **ejemplos**: Ver los casos de prueba
- **pista** o **hint**: Obtener una pista
- **teoría**: Explicación del tema
- **ejemplos**: Casos de uso
- **problema**: Descripción del ejercicio
- **solución**: Pista sobre cómo resolverlo
- **código**: Ver código de ejemplo

También puedes preguntarme cualquier cosa sobre el desafío: *"¿Cómo funciona el array?"*, *"¿qué hace esta función?"*, etc.`;
        }
        
        // Show test requirements
        if (lower.includes('test') || lower.includes('prueba') || lower.includes('ejemplo')) {
            const tests = ch.tests || [];
            if (tests.length > 0) {
                return `**📝 Tests definidos:**\n\n${tests.map((t, i) => `**Test ${i+1}:**\n- Input: \`${JSON.stringify(t.input)}\`\n- Expected: \`${JSON.stringify(t.expected)}\``).join('\n\n')}\n\n*Tu función debe devolver estos valores para pasar los tests.*`;
            }
            return '⚠️ No hay tests definidos para este desafío.';
        }
        
        // Show hint
        if (lower.includes('pista') || lower.includes('hint')) {
            return `💡 **Pista:**\n\n${ch.hint || 'No hay pista disponible. Intenta revisar la teoría o los ejemplos.'}`;
        }
        
        // Show theory
        if (lower.includes('teoría') || lower.includes('explica') || lower.includes('concepto')) {
            return `📖 **Teoría:**\n\n${ch.theory || 'No hay teoría disponible para este tema.'}`;
        }
        
        // Show examples
        if (lower.includes('ejemplo')) {
            return `📝 **Ejemplos:**\n\n${ch.examples || 'No hay ejemplos disponibles.'}`;
        }
        
        // Show problem description
        if (lower.includes('problema') || lower.includes('qué hay') || lower.includes('instrucción')) {
            return `📋 **Problema:**\n\n${ch.description || 'Sin descripción.'}`;
        }
        
        // Code help
        if (lower.includes('código') || lower.includes('solución')) {
            return `💡 **Acerca de la solución:**\n\nEste desafío requiere que implements una función \`solve(input)\` que procese el valor de entrada y devuelva el resultado esperado.\n\nPuedes usar:\n- Condicionales (if/else)\n- Ciclos (for/while)\n- Funciones de array (map, filter, reduce)\n- Cualquier operación matemática\n\n*Intenta resolverlo por tu cuenta primero!*`;
        }
        
        // Default - provide helpful info
        return `**📋 Desafío: "${ch.title}"**\n\n` +
            `**Materia:** ${ch.materia}\n` +
            `**Dificultad:** ${ch.difficulty}\n` +
            `**Puntos:** ${ch.points}\n\n` +
            `**Puedes preguntarme:**\n` +
            `- "test" - Ver los casos de prueba\n` +
            `- "pista" - Obtener una pista\n` +
            `- "teoría" - Explicación del tema\n` +
            `- "problema" - Descripción completa\n` +
            `- "código" - Ayuda sobre la solución\n\n` +
            `¿Qué necesitas saber?`;
    }

    // Filter
    function filterChallenges() {
        const search = document.getElementById('searchInput').value.toLowerCase();
        document.querySelectorAll('.challenge-item').forEach(item => {
            const name = item.querySelector('.challenge-name').textContent.toLowerCase();
            item.style.display = name.includes(search) ? 'flex' : 'none';
        });
    }

    // Toggle Panels - Desktop and Mobile
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const windowWidth = window.innerWidth;

        // On mobile/tablet, use mobile toggle
        if (windowWidth <= 991) {
            toggleMobileSidebar();
            return;
        }

        // On desktop, toggle collapsed state with animation
        const isCollapsed = sidebar.classList.toggle('collapsed');

        // Store user preference
        try {
            localStorage.setItem('sidebarCollapsed', isCollapsed ? '1' : '0');
        } catch (e) {
            console.warn('Could not save sidebar state:', e);
        }
    }

    // Restore sidebar state on load
    function restoreSidebarState() {
        const sidebar = document.getElementById('sidebar');
        if (!sidebar) return;

        try {
            const isCollapsed = localStorage.getItem('sidebarCollapsed') === '1';
            if (isCollapsed && window.innerWidth > 991) {
                sidebar.classList.add('collapsed');
            }
        } catch (e) {
            console.warn('Could not restore sidebar state:', e);
        }
    }

    function toggleRightPanel() {
        document.getElementById('rightPanel').classList.toggle('collapsed');
    }

    function toggleOutput() {
        document.getElementById('outputPanel').classList.toggle('collapsed');
    }

    function initResizers() {
        // Sidebar resize
        const sidebarResize = document.getElementById('sidebarResize');
        if (sidebarResize) {
            sidebarResize.addEventListener('mousedown', (e) => {
                isResizingSidebar = true;
                sidebarResize.classList.add('resizing');
                startX = e.clientX;
                const sidebar = document.getElementById('sidebar');
                startWidth = sidebar.offsetWidth;
                e.preventDefault();
                document.body.style.cursor = 'col-resize';
                document.body.style.userSelect = 'none';
            });
        }

        // Right panel resize (before the panel)
        const rightPanelResize = document.querySelector('.resize-handle-v');
        if (rightPanelResize) {
            rightPanelResize.addEventListener('mousedown', (e) => {
                isResizingRightPanel = true;
                rightPanelResize.classList.add('resizing');
                startX = e.clientX;
                const rightPanel = document.getElementById('rightPanel');
                startWidth = rightPanel.offsetWidth;
                e.preventDefault();
                document.body.style.cursor = 'col-resize';
                document.body.style.userSelect = 'none';
            });
        }

        // Output panel resize - horizontal handle (resizes height)
        const outputResize = document.querySelector('.resize-handle-h');
        if (outputResize) {
            outputResize.addEventListener('mousedown', (e) => {
                isResizingOutput = true;
                outputResize.classList.add('resizing');
                startY = e.clientY;
                const outputPanel = document.getElementById('outputPanel');
                startHeight = parseInt(outputPanel.style.height) || outputPanel.offsetHeight;
                e.preventDefault();
                document.body.style.cursor = 'row-resize';
                document.body.style.userSelect = 'none';
            });
        }

        // Global mouse move
        document.addEventListener('mousemove', (e) => {
            if (isResizingSidebar) {
                const newWidth = startWidth + (e.clientX - startX);
                if (newWidth >= 180 && newWidth <= 500) {
                    document.getElementById('sidebar').style.width = newWidth + 'px';
                }
            }
            if (isResizingRightPanel) {
                // Moving left reduces width
                const delta = startX - e.clientX;
                const newWidth = startWidth + delta;
                if (newWidth >= 250 && newWidth <= 600) {
                    document.getElementById('rightPanel').style.width = newWidth + 'px';
                }
            }
            if (isResizingOutput) {
                // Moving down increases height
                const delta = e.clientY - startY;
                const newHeight = startHeight - delta; // Subtract because we're dragging from top
                const outputPanel = document.getElementById('outputPanel');
                if (newHeight >= 100 && newHeight <= 500) {
                    outputPanel.style.height = newHeight + 'px';
                }
            }
        });

        // Global mouse up
        document.addEventListener('mouseup', () => {
            if (isResizingSidebar) {
                isResizingSidebar = false;
                document.getElementById('sidebarResize')?.classList.remove('resizing');
            }
            if (isResizingRightPanel) {
                isResizingRightPanel = false;
                document.querySelector('.resize-handle-v')?.classList.remove('resizing');
            }
            if (isResizingOutput) {
                isResizingOutput = false;
                document.querySelector('.resize-handle-h')?.classList.remove('resizing');
            }
            document.body.style.cursor = '';
            document.body.style.userSelect = '';
        });

        // Double click on resize handles to reset
        document.getElementById('sidebarResize')?.addEventListener('dblclick', () => {
            document.getElementById('sidebar').style.width = '280px';
        });

        document.querySelector('.resize-handle-v')?.addEventListener('dblclick', () => {
            document.getElementById('rightPanel').style.width = '320px';
        });

        document.querySelector('.resize-handle-h')?.addEventListener('dblclick', () => {
            document.getElementById('outputPanel').style.height = '200px';
        });
    }

    // Mobile menu functions with improved state management
    function toggleMobileSidebar() {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebarOverlay');
        const rightPanel = document.getElementById('rightPanel');
        const rightOverlay = document.getElementById('rightpanelOverlay');

        // Close chat panel if open
        if (rightPanel.classList.contains('open')) {
            rightPanel.classList.remove('open');
            rightOverlay.classList.remove('show');
        }

        // Toggle sidebar
        const isOpen = sidebar.classList.toggle('open');
        overlay.classList.toggle('show', isOpen);

        // Update button visibility
        const menuBtn = document.getElementById('mobileMenuBtn');
        const chatBtn = document.getElementById('mobileChatBtn');
        if (menuBtn) menuBtn.classList.toggle('hidden', isOpen);
        if (chatBtn && isOpen) chatBtn.classList.remove('hidden');
    }

    function toggleMobileChat() {
        const rightPanel = document.getElementById('rightPanel');
        const overlay = document.getElementById('rightpanelOverlay');
        const sidebar = document.getElementById('sidebar');
        const sidebarOverlay = document.getElementById('sidebarOverlay');

        // Close sidebar if open
        if (sidebar.classList.contains('open')) {
            sidebar.classList.remove('open');
            sidebarOverlay.classList.remove('show');
        }

        // Toggle chat panel
        const isOpen = rightPanel.classList.toggle('open');
        overlay.classList.toggle('show', isOpen);

        // Update button visibility
        const menuBtn = document.getElementById('mobileMenuBtn');
        const chatBtn = document.getElementById('mobileChatBtn');
        if (chatBtn) chatBtn.classList.toggle('hidden', isOpen);
        if (menuBtn && isOpen) menuBtn.classList.remove('hidden');
    }

    function closeMobileMenus() {
        const sidebar = document.getElementById('sidebar');
        const rightPanel = document.getElementById('rightPanel');
        const sidebarOverlay = document.getElementById('sidebarOverlay');
        const rightpanelOverlay = document.getElementById('rightpanelOverlay');
        const menuBtn = document.getElementById('mobileMenuBtn');
        const chatBtn = document.getElementById('mobileChatBtn');

        sidebar.classList.remove('open');
        rightPanel.classList.remove('open');
        sidebarOverlay.classList.remove('show');
        rightpanelOverlay.classList.remove('show');

        // Restore buttons
        if (menuBtn) menuBtn.classList.remove('hidden');
        if (chatBtn) chatBtn.classList.remove('hidden');
    }

    // Close mobile menus on window resize to desktop
    let lastWindowWidth = window.innerWidth;
    window.addEventListener('resize', () => {
        const currentWidth = window.innerWidth;
        // If transitioning from mobile to desktop (>991px)
        if (lastWindowWidth <= 991 && currentWidth > 991) {
            closeMobileMenus();
        }
        lastWindowWidth = currentWidth;
    });

    // Close mobile menus on escape key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            closeMobileMenus();
        }
    });

    // Chat improvements - Simple Markdown rendering with math support
    function renderMarkdown(text) {
        if (!text) return '';
        const source = String(text).trim();

        // Simple markdown parser that preserves math
        let html = escHtml(source)
            // Display math: $$...$$
            .replace(/\$\$([^$]+?)\$\$/g, (_, expr) => {
                return `$$${expr.trim()}$$`;
            })
            // Inline math: $...$ (avoid matching $$)
            .replace(/(?!\$\$)\$([^$\n]+?)\$(?!\$)/g, (_, expr) => {
                return `$${expr.trim()}$`;
            })
            // Bold
            .replace(/\*\*(.+?)\*\*/g, '<strong>$1</strong>')
            // Italic
            .replace(/\*(.+?)\*/g, '<em>$1</em>')
            // Inline code
            .replace(/`([^`]+)`/g, '<code>$1</code>')
            // Code blocks
            .replace(/```([\s\S]*?)```/g, '<pre><code>$1</code></pre>')
            // Headers
            .replace(/^###\s+(.+)$/gm, '<h4>$1</h4>')
            .replace(/^##\s+(.+)$/gm, '<h3>$1</h3>')
            .replace(/^#\s+(.+)$/gm, '<h2>$1</h2>')
            // Lists
            .replace(/^\s*[-*]\s+(.+)$/gm, '<li>$1</li>')
            // Links
            .replace(/\[([^\]]+)\]\(([^)]+)\)/g, '<a href="$2" target="_blank">$1</a>');

        // Wrap consecutive li elements in ul
        html = html.replace(/(<li>[^<]+<\/li>\s*)+/g, match => `<ul>${match}</ul>`);

        // Convert double newlines to paragraphs
        const paragraphs = html.split(/\n\n+/);
        const wrapped = paragraphs.map(p => {
            if (p.trim().startsWith('<') && !p.trim().startsWith('<li>')) return p;
            return `<p>${p.replace(/\n/g, '<br>')}</p>`;
        });

        return `<div class="markdown-content">${wrapped.join('\n')}</div>`;
    }

    // Utils
    function escHtml(str) {
        return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
    }

    function showXP(points) {
        document.getElementById('xpAmount').textContent = points;
        const toast = document.getElementById('xpToast');
        toast.classList.add('show');
        setTimeout(() => toast.classList.remove('show'), 3000);
    }

    // Initialize resizers is now called in the main DOMContentLoaded above
    