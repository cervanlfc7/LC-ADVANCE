// ========================================
// MATERIA: TEMAS SELECTOS DE MATEMÁTICAS I Y II
// TEMA: DERIVADAS COMPLETAS + SIMULADOR REAL (ln(x) 100% FUNCIONAL)
// ========================================
$lecciones[] = [
    'materia' => 'Temas Selectos de Matemáticas I y II',
    'slug' => 'derivadas-todo-tipo',
    'titulo' => 'Derivadas: Reglas, Implícitas, Parciales, Simulador Real y Retos Épicos',
    'contenido' => <<<HTML
<div class="derivadas-master">
    <h3 class="derivadas-main-title">DERIVADAS: La Tasa de Cambio Instantánea</h3>
    <p class="derivadas-intro">
        La derivada mide <strong>cómo cambia una función en un instante</strong>. Base del cálculo, física y machine learning.
    </p>
</div>

<hr class="derivadas-separator">

<h4 class="derivadas-section">1. Tabla Completa de Derivadas Básicas</h4>
<table class="derivadas-table">
    <thead><tr><th>Función</th><th>Derivada</th></tr></thead>
    <tbody>
        <tr><td>\( x^n \)</td><td>\( n x^{n-1} \)</td></tr>
        <tr><td>\( \\sin x \)</td><td>\( \\cos x \)</td></tr>
        <tr><td>\( \\cos x \)</td><td>\( -\\sin x \)</td></tr>
        <tr><td>\( e^x \)</td><td>\( e^x \)</td></tr>
        <tr><td>\( \\ln x \)</td><td>\( \\frac{1}{x} \)</td></tr>
        <tr><td>\( \\tan x \)</td><td>\( \\sec^2 x \)</td></tr>
        <tr><td>\( \\sec x \)</td><td>\( \\sec x \\tan x \)</td></tr>
        <tr><td>\( \\arcsin x \)</td><td>\( \\frac{1}{\\sqrt{1-x^2}} \)</td></tr>
    </tbody>
</table>

<hr class="derivadas-separator">

<h4 class="derivadas-section">2. Simulador Real de Derivadas (ln(x), log, todo funciona)</h4>
<div class="simulador-container">
    <p class="simulador-info">Ingresa cualquier función → soporta: <code>ln(x)</code>, <code>log(x)</code>, <code>sin(2x)</code>, <code>e^(x^2)</code>, etc.</p>
    
    <input type="text" id="funcion-input" class="derivadas-input" value="ln(x) + x^3 + sin(2x)" placeholder="Ej: ln(5x) + e^(x^2)">
    
    <div class="simulador-controls">
        <button onclick="calcularDerivada()" class="btn-calcular">CALCULAR DERIVADA</button>
        <button onclick="ejemploAleatorio()" class="btn-ejemplo">Ejemplo Aleatorio</button>
    </div>

    <div id="resultado-simulador" class="resultado-box">
        Resultado aparecerá aquí
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/mathjs/11.11.2/math.min.js"></script>
<script>
// PREPROCESADOR: convierte ln(x) → log(x) para que Math.js lo entienda siempre
function preprocessFunction(input) {
    return input
        .replace(/\\b(ln)\(/gi, 'log(')        // ln(x) → log(x)
        .replace(/\\bln\\b/gi, 'log')          // ln → log (por si está solo)
        .replace(/\\bLn\\b/gi, 'log')          // Ln → log
        .replace(/\\bLN\\b/gi, 'log');         // LN → log
}

function calcularDerivada() {
    let input = document.getElementById("funcion-input").value.trim();
    const output = document.getElementById("resultado-simulador");
    
    if (!input) {
        output.innerHTML = '<div class="error-text">Ingresa una función válida</div>';
        return;
    }

    // MOSTRAMOS la función original tal como el usuario la escribió
    const funcionOriginal = input;

    // Preprocesamos para que Math.js entienda ln(x)
    input = preprocessFunction(input);

    try {
        const node = math.parse(input);
        const derivada = math.derivative(node, 'x');

        output.innerHTML = 
            '<div class="funcion-texto">f(x) = ' + funcionOriginal + '</div>' +
            '<div class="derivada-texto">f\'(x) = <strong>' + derivada.toString() + '</strong></div>';
    } catch (err) {
        output.innerHTML = '<div class="error-text">Error:<br>' + err.message + '</div>';
    }
}

function ejemploAleatorio() {
    const ejemplos = [
        "ln(x) + x^2",
        "ln(5x) + sin(x)",
        "e^x + ln(x^3)",
        "(x^2 + 1)^5",
        "sin(3x) + cos(2x)",
        "x * ln(x)",
        "ln(x^2 + 1) * e^x",
        "sqrt(x) + 1/x"
    ];
    const random = ejemplos[Math.floor(Math.random() * ejemplos.length)];
    document.getElementById("funcion-input").value = random;
    calcularDerivada();
}

// Ejecutar al cargar
document.addEventListener("DOMContentLoaded", calcularDerivada);
</script>

<hr class="derivadas-separator">

<h4 class="derivadas-section">3. SVG Animado: Regla de la Cadena</h4>
<div class="svg-master">
    <svg viewBox="0 0 1000 650" xmlns="http://www.w3.org/2000/svg">
        <defs>
            <linearGradient id="bgGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                <stop offset="0%" stop-color="#0D0000"/>
                <stop offset="100%" stop-color="#2D0000"/>
            </linearGradient>
            <filter id="glow"><feGaussianBlur stdDeviation="10" result="blur"/><feMerge><feMergeNode in="blur"/><feMergeNode in="SourceGraphic"/></feMerge></filter>
        </defs>
        <rect width="1000" height="650" fill="url(#bgGrad)"/>
        <text x="500" y="80" fill="#FF1744" font-size="48" text-anchor="middle" font-weight="bold" filter="url(#glow)">REGLA DE LA CADENA</text>
        <text x="500" y="130" fill="#FF8A80" font-size="28" text-anchor="middle">(f ∘ g)'(x) = f'(g(x)) · g'(x)</text>

        <g opacity="0"><animate attributeName="opacity" values="0;1" begin="0.5s" dur="1s" fill="freeze"/>
            <circle cx="250" cy="320" r="100" fill="#D50000" stroke="#FF1744" stroke-width="8"/>
            <text x="250" y="300" fill="white" font-size="32" text-anchor="middle" font-weight="bold">g(x)</text>
            <text x="250" y="350" fill="#FF8A80" font-size="20" text-anchor="middle">Ej: 3x + 2</text>
        </g>

        <g opacity="0"><animate attributeName="opacity" values="0;1" begin="1.8s" dur="1s" fill="freeze"/>
            <circle cx="750" cy="320" r="110" fill="#B71C1C" stroke="#FF1744" stroke-width="8"/>
            <text x="750" y="295" fill="white" font-size="32" text-anchor="middle" font-weight="bold">f(u)</text>
            <text x="750" y="345" fill="#FF8A80" font-size="20" text-anchor="middle">Ej: u⁵</text>
        </g>

        <defs><marker id="arrow" markerWidth="20" markerHeight="20" refX="15" refY="6" orient="auto">
            <path d="M0,0 L0,12 L18,6 z" fill="#FF1744"/>
        </marker></defs>

        <path d="M350,320 Q500,250 650,320" fill="none" stroke="#FF1744" stroke-width="10" marker-end="url(#arrow)">
            <animate attributeName="stroke-dasharray" from="0,1000" to="1000,0" dur="2s" begin="2.5s"/>
        </path>
        <text x="500" y="230" fill="#FF5252" font-size="20" text-anchor="middle">g'(x)</text>
    </svg>
</div>

<hr class="derivadas-separator">

<h4 class="derivadas-section">4. Reto: Derivada Implícita</h4>
<div class="reto-master">
    <p class="reto-text"><strong>Ecuación:</strong> \( x^2 + y^2 = 25 \)</p>
    <p class="reto-text">¿Cuál es \( \\frac{dy}{dx} \)?</p>
    <details class="reto-details">
        <summary class="reto-summary">Ver solución</summary>
        <div class="reto-solucion">
            2x + 2y · (dy/dx) = 0<br>
            dy/dx = -x/y
        </div>
    </details>
</div>
HTML
,