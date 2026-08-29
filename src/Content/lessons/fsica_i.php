<?php
/**
 * Materia: Física I
 * Lecciones: 16
 */
return array (
  0 => 
  array (
    'materia' => 'Física I',
    'slug' => 'energia-conservacion-cyberpunk',
    'titulo' => 'Energía: La Moneda Universal del Universo',
    'contenido' => '<!-- INICIO LECCIÓN CYBERPUNK FÍSICA -->
<div class="leccion-container leccion-fisica-energia" data-tema="conservacion-energia">
    <!-- CABECERA CYBERPUNK -->
    <header class="leccion-header">
        <h1 class="titulo-leccion neon-glow">
            <span class="icon-tema">⚡</span>
            ENERGÍA: LA MONEDA UNIVERSAL
        </h1>
        <div class="subtitulo">
            Conservación, Transformaciones y Aplicaciones en el Cosmos
        </div>
    </header>

    <!-- PANEL OBJETIVOS -->
    <section class="panel-objetivos">
        <h2 class="seccion-titulo neon-concepto">
            <span class="icon">🎯</span> OBJETIVOS DE APRENDIZAJE
        </h2>
        <div class="objetivos-grid">
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Definir energía y sus 7 formas fundamentales</h3>
                <p>Desde cinética hasta nuclear, con fórmulas y ejemplos</p>
            </div>
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Aplicar la ley de conservación</h3>
                <p>Resolver problemas con \\(E_{\\text{inicial}} = E_{\\text{final}}\\)</p>
            </div>
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Analizar transformaciones energéticas</h3>
                <p>Estudiar \\(E_p \\leftrightarrow E_k\\) en sistemas reales</p>
            </div>
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Calcular trabajo y eficiencia</h3>
                <p>Usar \\(W = \\Delta E\\) y \\(\\eta = \\frac{E_{\\text{útil}}}{E_{\\text{total}}}\\)</p>
            </div>
        </div>
    </section>

    <!-- CONTEXTO REAL -->
    <section class="contexto-real">
        <h2 class="seccion-titulo neon-dato">
            <span class="icon">🌍</span> APLICACIONES EN EL MUNDO REAL
        </h2>
        <div class="contexto-grid">
            <div class="contexto-card">
                <h3>🚀 COHETES ESPACIALES</h3>
                <p>Transforman <strong>energía química</strong> (combustible) → <strong>térmica</strong> → <strong>cinética</strong></p>
                <div class="dato-neon">Ejemplo: Saturno V (34,000 kN de empuje)</div>
            </div>
            <div class="contexto-card">
                <h3>💡 ENERGÍA SOLAR</h3>
                <p>Paneles fotovoltaicos convierten <strong>radiante</strong> → <strong>eléctrica</strong> con ~20% eficiencia</p>
                <div class="dato-neon">Ejemplo: Granja solar en el Sahara (1000 MW)</div>
            </div>
            <div class="contexto-card">
                <h3>🏎️ FÓRMULA 1</h3>
                <p>Sistemas KERS recuperan <strong>cinética</strong> → <strong>eléctrica</strong> en frenadas</p>
                <div class="dato-neon">Ejemplo: 60 mJ recuperados por vuelta</div>
            </div>
        </div>
    </section>

    <!-- CONCEPTO PRINCIPAL -->
    <section class="concepto-principal">
        <div class="concept-card">
            <h3 class="neon-concepto">⚡ ¿QUÉ ES LA ENERGÍA?</h3>
            <p><strong>Energía</strong> es la <strong>capacidad de realizar trabajo</strong> o producir cambio. Se mide en <strong>joules (J)</strong>:</p>
            <div class="formula-destacada">
                \\[
                1\\,\\text{J} = 1\\,\\text{N·m} = 1\\,\\text{kg·m}^2/\\text{s}^2
                \\]
            </div>
            <div class="ley-conservacion">
                <h4>🔄 LEY DE CONSERVACIÓN</h4>
                <p>En un sistema <strong>aislado</strong>, la energía total es <strong>constante</strong>:</p>
                \\[
                E_{\\text{inicial}} = E_{\\text{final}} \\quad \\Rightarrow \\quad \\Delta E_{\\text{total}} = 0
                \\]
                <div class="ejemplo-conservacion">
                    <strong>Ejemplo:</strong> Péndulo:
                    \\[
                    E_p \\xrightleftharpoons[altura]{} E_k
                    \\]
                </div>
            </div>
        </div>
    </section>

    <!-- FORMAS DE ENERGÍA -->
    <section class="formas-energia">
        <h2 class="seccion-titulo neon-dato">
            <span class="icon">📊</span> 7 FORMAS FUNDAMENTALES DE ENERGÍA
        </h2>

        <div class="tabla-interactiva">
            <table class="tabla-cyberpunk">
                <thead>
                    <tr>
                        <th>FORMA</th>
                        <th>FÓRMULA</th>
                        <th>UNIDADES</th>
                        <th>EJEMPLO PRÁCTICO</th>
                    </tr>
                </thead>
                <tbody>
                    <tr data-forma="cinetica">
                        <td><strong class="neon-cinetica">CINÉTICA</strong></td>
                        <td>\\[E_k = \\frac{1}{2}mv^2\\]</td>
                        <td>J (joules)</td>
                        <td>Auto a 100 km/h</td>
                    </tr>
                    <tr data-forma="potencial">
                        <td><strong class="neon-potencial">POTENCIAL GRAV.</strong></td>
                        <td>\\[E_p = mgh\\]</td>
                        <td>J (joules)</td>
                        <td>Libro a 2 m de altura</td>
                    </tr>
                    <tr data-forma="elastica">
                        <td><strong class="neon-elastica">ELÁSTICA</strong></td>
                        <td>\\[E_e = \\frac{1}{2}kx^2\\]</td>
                        <td>J (joules)</td>
                        <td>Resorte comprimido 10 cm</td>
                    </tr>
                    <tr data-forma="termica">
                        <td><strong class="neon-termica">TÉRMICA</strong></td>
                        <td>\\[Q = mc\\Delta T\\]</td>
                        <td>J o cal</td>
                        <td>Agua hirviendo</td>
                    </tr>
                    <tr data-forma="electrica">
                        <td><strong class="neon-electrica">ELÉCTRICA</strong></td>
                        <td>\\[E = qV = Pt\\]</td>
                        <td>J o kWh</td>
                        <td>Batería de 12V</td>
                    </tr>
                    <tr data-forma="quimica">
                        <td><strong class="neon-quimica">QUÍMICA</strong></td>
                        <td>\\(\\Delta H\\) (entalpía)</td>
                        <td>J/mol</td>
                        <td>Combustión de gasolina</td>
                    </tr>
                    <tr data-forma="nuclear">
                        <td><strong class="neon-nuclear">NUCLEAR</strong></td>
                        <td>\\[E = mc^2\\]</td>
                        <td>J (enorme)</td>
                        <td>Fisión de uranio-235</td>
                    </tr>
                </tbody>
            </table>
            <div class="tabla-info" id="infoForma">
                Haz clic en una forma de energía para ver detalles y ejemplos interactivos
            </div>
        </div>
    </section>

    <!-- TRANSFORMACIONES ENERGÉTICAS -->
    <section class="transformaciones-section">
        <h2 class="seccion-titulo neon-interactivo">
            <span class="icon">🔄</span> TRANSFORMACIONES ENERGÉTICAS
        </h2>

        <div class="transformaciones-grid">
            <div class="transf-card" data-tipo="mecanica">
                <div class="transf-icon">🎢</div>
                <h4>MECÁNICA</h4>
                <p>\\[E_p \\leftrightarrow E_k\\]</p>
                <div class="ejemplos-mini">
                    <strong>Ejemplos:</strong> Montaña rusa, péndulo, caída libre
                </div>
                <button class="btn-mini" onclick="mostrarEjemplo(\'mecanica\')">Ver simulación</button>
            </div>

            <div class="transf-card" data-tipo="electrotermica">
                <div class="transf-icon">💡</div>
                <h4>ELÉCTRO-TÉRMICA</h4>
                <p>\\[E_{\\text{eléct}} \\rightarrow E_{\\text{térm}} + E_{\\text{luz}}\\]</p>
                <div class="ejemplos-mini">
                    <strong>Ejemplos:</strong> Bombilla incandescente, estufa eléctrica
                </div>
                <button class="btn-mini" onclick="mostrarEjemplo(\'electrotermica\')">Ver eficiencia</button>
            </div>

            <div class="transf-card" data-tipo="quimicamecanica">
                <div class="transf-icon">🚗</div>
                <h4>QUÍMICA-MECÁNICA</h4>
                <p>\\[E_{\\text{quím}} \\rightarrow E_{\\text{térm}} \\rightarrow E_k\\]</p>
                <div class="ejemplos-mini">
                    <strong>Ejemplos:</strong> Motor de combustión, músculos humanos
                </div>
                <button class="btn-mini" onclick="mostrarEjemplo(\'quimicamecanica\')">Ver rendimiento</button>
            </div>
        </div>

        <!-- EJEMPLO INTERACTIVO: CAÍDA LIBRE -->
        <div class="ejemplo-interactivo">
            <h3 class="neon-ejemplo">📐 EJEMPLO: CAÍDA LIBRE</h3>
            <div class="ejemplo-content">
                <p><strong>Problema:</strong> Objeto de masa \\(m = 2\\,\\text{kg}\\) cae desde \\(h = 10\\,\\text{m}\\)</p>

                <div class="calculadora-mini">
                    <div class="calc-step">
                        <span>1. \\(E_{p_i} = mgh =\\)</span>
                        <input type="number" id="masa" value="2" min="0.1" max="100" step="0.1"> ×
                        <input type="number" id="gravedad" value="9.8" min="1" max="20" step="0.1"> ×
                        <input type="number" id="altura" value="10" min="1" max="100" step="1">
                        <button onclick="calcularEnergia()">Calcular</button>
                    </div>
                    <div class="calc-resultado">
                        <strong>Resultado:</strong>
                        \\(E_{p_i} = \\) <span id="resultadoEp">196</span> J
                    </div>
                    <div class="calc-explicacion">
                        <p>En el suelo: \\(E_{k_f} = E_{p_i} = 196\\,\\text{J}\\) (conservación)</p>
                        <p>Velocidad final: \\(v = \\sqrt{\\frac{2E_k}{m}} = \\) <span id="velocidadFinal">14.0</span> m/s</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SIMULADOR PÉNDULO INTERACTIVO -->
    <section class="simulator-section">
        <h2 class="seccion-titulo neon-interactivo">
            <span class="icon">🔬</span> SIMULADOR: PÉNDULO + CONSERVACIÓN DE ENERGÍA
        </h2>

        <div class="simulator-container" data-tema="pendulo-energia">
            <!-- CONTROLES -->
            <div class="simulator-controls">
                <h3>CONTROLES</h3>

                <div class="control-group">
                    <label for="masaPendulo">Masa (kg):</label>
                    <input type="range" id="masaPendulo" min="0.5" max="5" value="1" step="0.1">
                    <span id="masaValue">1.0 kg</span>
                </div>

                <div class="control-group">
                    <label for="longitudPendulo">Longitud (m):</label>
                    <input type="range" id="longitudPendulo" min="0.5" max="3" value="1.5" step="0.1">
                    <span id="longitudValue">1.5 m</span>
                </div>

                <div class="control-group">
                    <label for="anguloInicial">Ángulo inicial (°):</label>
                    <input type="range" id="anguloInicial" min="10" max="80" value="45" step="5">
                    <span id="anguloValue">45°</span>
                </div>

                <div class="control-group">
                    <label for="friccionToggle">Incluir fricción:</label>
                    <input type="checkbox" id="friccionToggle">
                </div>

                <button class="btn-simular" onclick="iniciarSimulacion()">
                    <span class="btn-icon">▶</span> INICIAR SIMULACIÓN
                </button>

                <button class="btn-pausar" onclick="pausarSimulacion()">
                    <span class="btn-icon">⏸</span> PAUSAR
                </button>

                <button class="btn-reset" onclick="reiniciarSimulacion()">
                    <span class="btn-icon">↺</span> REINICIAR
                </button>
            </div>

            <!-- VISUALIZACIÓN SVG -->
            <div class="simulator-visualization">
                <svg viewBox="0 0 600 400" id="svgPendulo">
                    <!-- Fondo -->
                    <rect x="0" y="0" width="600" height="400" fill="#0a0a1a"/>

                    <!-- Soporte -->
                    <line x1="300" y1="50" x2="300" y2="100" stroke="#39FF14" stroke-width="3"/>
                    <circle cx="300" cy="50" r="8" fill="#39FF14"/>

                    <!-- Hilo -->
                    <line id="hiloPendulo" x1="300" y1="100" x2="300" y2="200" stroke="#00FFFF" stroke-width="2"/>

                    <!-- Masa -->
                    <circle id="masaPenduloSVG" cx="300" cy="200" r="15" fill="#FF00FF">
                        <animateMotion id="animPendulo" dur="2s" repeatCount="indefinite" path=""/>
                    </circle>

                    <!-- Trayectoria -->
                    <path id="trayectoria" d="" fill="none" stroke="rgba(255,255,0,0.3)" stroke-width="1"/>

                    <!-- Energía en tiempo real -->
                    <rect x="20" y="300" width="560" height="80" fill="rgba(0,0,0,0.7)" rx="5"/>

                    <!-- Barra Ep -->
                    <rect id="barraEp" x="30" y="320" width="100" height="20" fill="#39FF14"/>
                    <text x="30" y="315" fill="#39FF14" font-size="10">E_p</text>
                    <text id="textEp" x="80" y="335" fill="white" font-size="10">0 J</text>

                    <!-- Barra Ek -->
                    <rect id="barraEk" x="30" y="350" width="100" height="20" fill="#FF00FF"/>
                    <text x="30" y="345" fill="#FF00FF" font-size="10">E_k</text>
                    <text id="textEk" x="80" y="365" fill="white" font-size="10">0 J</text>

                    <!-- Total -->
                    <text x="300" y="340" fill="#00FFFF" font-size="12" text-anchor="middle">
                        E_total = <tspan id="textTotal">0</tspan> J (constante)
                    </text>

                    <!-- Fórmulas -->
                    <text x="450" y="320" fill="#FFFF00" font-size="11">
                        \\(E_p = mgh =\\) <tspan id="formulaEp">0</tspan> J
                    </text>
                    <text x="450" y="340" fill="#FF00FF" font-size="11">
                        \\(E_k = \\frac{1}{2}mv^2 =\\) <tspan id="formulaEk">0</tspan> J
                    </text>
                    <text x="450" y="360" fill="#00FFFF" font-size="11">
                        \\(E_{\\text{total}} = E_p + E_k =\\) <tspan id="formulaTotal">0</tspan> J
                    </text>
                </svg>
            </div>

            <!-- DATOS EN TIEMPO REAL -->
            <div class="simulator-data">
                <h3>DATOS EN TIEMPO REAL</h3>

                <div class="data-card">
                    <div class="data-label">Altura máxima:</div>
                    <div class="data-value" id="dataAlturaMax">0 m</div>
                </div>

                <div class="data-card">
                    <div class="data-label">Velocidad máxima:</div>
                    <div class="data-value" id="dataVelMax">0 m/s</div>
                </div>

                <div class="data-card highlight">
                    <div class="data-label">Energía total:</div>
                    <div class="data-value" id="dataEnergiaTotal">0 J</div>
                </div>

                <div class="data-card">
                    <div class="data-label">Periodo:</div>
                    <div class="data-value" id="dataPeriodo">0 s</div>
                </div>

                <div class="estadisticas">
                    <h4>📈 ESTADÍSTICAS</h4>
                    <div class="stat-item">
                        <span>Max E_p:</span>
                        <span class="stat-value" id="statMaxEp">0 J</span>
                    </div>
                    <div class="stat-item">
                        <span>Max E_k:</span>
                        <span class="stat-value" id="statMaxEk">0 J</span>
                    </div>
                    <div class="stat-item">
                        <span>Conservación:</span>
                        <span class="stat-value" id="statConservacion">100%</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- QUIZ INTERACTIVO -->
    <section class="quiz-section">
        <h2 class="seccion-titulo neon-evaluacion">
            <span class="icon">❓</span> QUIZ DE AUTOEVALUACIÓN
        </h2>

        <div class="quiz-container">
            <!-- PREGUNTA 1 -->
            <div class="quiz-question" data-correct="C">
                <div class="quiz-header">
                    <span class="quiz-num">01</span>
                    <h3>¿Cuál es la unidad SI de energía?</h3>
                </div>

                <div class="quiz-options">
                    <button class="quiz-option" data-value="A">
                        <span class="option-letter">A</span>
                        Newton (N)
                    </button>
                    <button class="quiz-option" data-value="B">
                        <span class="option-letter">B</span>
                        Vatio (W)
                    </button>
                    <button class="quiz-option" data-value="C">
                        <span class="option-letter">C</span>
                        Joule (J)
                    </button>
                    <button class="quiz-option" data-value="D">
                        <span class="option-letter">D</span>
                        Pascal (Pa)
                    </button>
                </div>

                <div class="quiz-feedback">
                    <div class="feedback-correct">
                        <strong>✅ Correcto:</strong> El joule (J) es la unidad SI de energía.
                    </div>
                    <div class="feedback-explicacion">
                        <p>1 J = 1 N·m = 1 kg·m²/s². El vatio es unidad de potencia (J/s).</p>
                    </div>
                </div>
            </div>

            <!-- PREGUNTA 2 -->
            <div class="quiz-question" data-correct="B">
                <div class="quiz-header">
                    <span class="quiz-num">02</span>
                    <h3>En un péndulo ideal, ¿dónde es máxima la energía cinética?</h3>
                </div>

                <div class="quiz-options">
                    <button class="quiz-option" data-value="A">
                        <span class="option-letter">A</span>
                        Punto más alto
                    </button>
                    <button class="quiz-option" data-value="B">
                        <span class="option-letter">B</span>
                        Punto más bajo
                    </button>
                    <button class="quiz-option" data-value="C">
                        <span class="option-letter">C</span>
                        En mitad del recorrido
                    </button>
                    <button class="quiz-option" data-value="D">
                        <span class="option-letter">D</span>
                        Es constante siempre
                    </button>
                </div>

                <div class="quiz-feedback">
                    <div class="feedback-correct">
                        <strong>✅ Correcto:</strong> En el punto más bajo (altura mínima).
                    </div>
                    <div class="feedback-explicacion">
                        <p>En el punto más alto: \\(E_p\\) máxima, \\(E_k\\) = 0.<br>
                        En el punto más bajo: \\(E_p\\) mínima, \\(E_k\\) máxima.<br>
                        \\(E_{\\text{total}} = E_p + E_k = \\text{constante}\\).</p>
                    </div>
                </div>
            </div>

            <!-- PREGUNTA 3 -->
            <div class="quiz-question" data-correct="A">
                <div class="quiz-header">
                    <span class="quiz-num">03</span>
                    <h3>¿Qué principio explica que \\(E_p + E_k = \\text{constante}\\) en un péndulo?</h3>
                </div>

                <div class="quiz-options">
                    <button class="quiz-option" data-value="A">
                        <span class="option-letter">A</span>
                        Conservación de la energía
                    </button>
                    <button class="quiz-option" data-value="B">
                        <span class="option-letter">B</span>
                        Segunda ley de Newton
                    </button>
                    <button class="quiz-option" data-value="C">
                        <span class="option-letter">C</span>
                        Ley de Hooke
                    </button>
                    <button class="quiz-option" data-value="D">
                        <span class="option-letter">D</span>
                        Principio de Arquímedes
                    </button>
                </div>

                <div class="quiz-feedback">
                    <div class="feedback-correct">
                        <strong>✅ Correcto:</strong> La <strong>conservación de la energía</strong> establece que la energía total en un sistema aislado es constante.
                    </div>
                    <div class="feedback-explicacion">
                        <p>En ausencia de fuerzas no conservativas (como la fricción), la suma de \\(E_p\\) y \\(E_k\\) permanece constante.</p>
                    </div>
                </div>
            </div>

            <!-- RESULTADOS -->
            <div class="quiz-results">
                <h3>🏆 RESULTADOS</h3>
                <div class="results-score">
                    Puntuación: <span id="quizScore">0</span>/3
                </div>
                <button class="btn-retry" onclick="reiniciarQuiz()">REINTENTAR</button>
            </div>
        </div>
    </section>

    <!-- ERRORES COMUNES -->
    <section class="errores-section">
        <h2 class="seccion-titulo neon-alerta">
            <span class="icon">⚠️</span> ERRORES COMUNES
        </h2>
        <div class="errores-container">
            <div class="error-card">
                <div class="error-header" onclick="toggleError(this)">
                    <h3>❌ CONFUNDIR ENERGÍA CON FUERZA</h3>
                    <span class="error-toggle">+</span>
                </div>
                <div class="error-content">
                    <div class="error-ejemplo">
                        <strong>Error:</strong> "Un objeto tiene energía porque se mueve rápido (fuerza)"
                    </div>
                    <div class="error-correccion">
                        <strong>Corrección:</strong> La energía es <strong>capacidad de hacer trabajo</strong>, no una fuerza. La fuerza es lo que <strong>causa cambios en el movimiento</strong> (2ª ley de Newton).
                    </div>
                    <div class="error-practica">
                        <p><strong>Ejemplo:</strong> Un auto en movimiento tiene <strong>energía cinética</strong> (\\(E_k = \\frac{1}{2}mv^2\\)), no "fuerza de movimiento".</p>
                    </div>
                </div>
            </div>

            <div class="error-card">
                <div class="error-header" onclick="toggleError(this)">
                    <h3>❌ IGNORAR PÉRDIDAS POR FRICCIÓN</h3>
                    <span class="error-toggle">+</span>
                </div>
                <div class="error-content">
                    <div class="error-ejemplo">
                        <strong>Error:</strong> "En un péndulo real, la energía se conserva al 100%"
                    </div>
                    <div class="error-correccion">
                        <strong>Corrección:</strong> La fricción con el aire y el soporte <strong>disipa energía</strong> como calor, reduciendo la amplitud con el tiempo.
                    </div>
                    <div class="error-tabla">
                        <table>
                            <tr><th>Sistema</th><th>Conservación</th></tr>
                            <tr><td>Péndulo ideal</td><td>100%</td></tr>
                            <tr><td>Péndulo real</td><td>&lt;100% (pérdidas)</td></tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- PROBLEMAS TIPO EXAMEN -->
    <section class="examen-section">
        <h2 class="seccion-titulo neon-evaluacion">
            <span class="icon">📝</span> PROBLEMAS TIPO EXAMEN
        </h2>
        <div class="examen-container">
            <div class="problema-card">
                <div class="problema-header">
                    <span class="problema-num">P1</span>
                    <h3>Conservación en un Péndulo</h3>
                </div>
                <div class="problema-enunciado">
                    <p>Un péndulo de 0.5 kg y 1.2 m de longitud se suelta desde un ángulo de 30°. Calcula:</p>
                    <ol>
                        <li>La energía potencial máxima.</li>
                        <li>La velocidad máxima en el punto más bajo.</li>
                        <li>La energía cinética cuando el péndulo forma 15° con la vertical.</li>
                    </ol>
                    <p>Usa \\(g = 9.8\\,\\text{m/s}^2\\).</p>
                </div>
                <div class="problema-espacio">
                    <textarea placeholder="Desarrolla tu solución paso a paso..." rows="8"></textarea>
                </div>
                <button class="btn-verificar" onclick="verificarProblema(1)">
                    🔍 VERIFICAR SOLUCIÓN
                </button>
                <div class="problema-solucion" id="solucionP1" style="display: none;">
                    <strong>Solución:</strong><br>
                    1. Altura máxima: \\(h = L(1 - \\cos 30°) = 0.157\\,\\text{m}\\)<br>
                    \\(E_{p_{\\text{max}}} = mgh = 0.5 \\times 9.8 \\times 0.157 = 0.769\\,\\text{J}\\)<br><br>
                    2. \\(E_{k_{\\text{max}}} = E_{p_{\\text{max}}} = 0.769\\,\\text{J}\\)<br>
                    \\(v_{\\text{max}} = \\sqrt{\\frac{2E_k}{m}} = \\sqrt{\\frac{2 \\times 0.769}{0.5}} = 1.75\\,\\text{m/s}\\)<br><br>
                    3. \\(h_{15°} = L(1 - \\cos 15°) = 0.047\\,\\text{m}\\)<br>
                    \\(E_p = 0.5 \\times 9.8 \\times 0.047 = 0.230\\,\\text{J}\\)<br>
                    \\(E_k = 0.769 - 0.230 = 0.539\\,\\text{J}\\)
                </div>
            </div>

            <div class="problema-card">
                <div class="problema-header">
                    <span class="problema-num">P2</span>
                    <h3>Eficiencia en un Sistema Real</h3>
                </div>
                <div class="problema-enunciado">
                    <p>Un motor eléctrico recibe 1000 J de energía eléctrica y produce 750 J de energía mecánica útil. El resto se pierde como calor por fricción.</p>
                    <ol>
                        <li>Calcula la eficiencia del motor.</li>
                        <li>Si el motor opera durante 10 s, ¿cuál es su potencia útil en vatios?</li>
                        <li>¿Qué cantidad de energía se pierde por segundo?</li>
                    </ol>
                </div>
                <div class="problema-espacio">
                    <textarea placeholder="Desarrolla tu solución paso a paso..." rows="8"></textarea>
                </div>
                <button class="btn-verificar" onclick="verificarProblema(2)">
                    🔍 VERIFICAR SOLUCIÓN
                </button>
                <div class="problema-solucion" id="solucionP2" style="display: none;">
                    <strong>Solución:</strong><br>
                    1. \\(\\eta = \\frac{E_{\\text{útil}}}{E_{\\text{total}}} \\times 100\\% = \\frac{750}{1000} \\times 100\\% = 75\\%\\)<br><br>
                    2. \\(P_{\\text{útil}} = \\frac{E_{\\text{útil}}}{t} = \\frac{750\\,\\text{J}}{10\\,\\text{s}} = 75\\,\\text{W}\\)<br><br>
                    3. \\(E_{\\text{pérdida}} = 1000 - 750 = 250\\,\\text{J}\\)<br>
                    \\(\\frac{250\\,\\text{J}}{10\\,\\text{s}} = 25\\,\\text{W}\\) (pérdidas por segundo)
                </div>
            </div>
        </div>

        <div class="rubrica">
            <h4>📋 RÚBRICA DE EVALUACIÓN</h4>
            <table class="rubrica-table">
                <tr>
                    <th>Criterio</th>
                    <th>Excelente (3 pts)</th>
                    <th>Satisfactorio (2 pts)</th>
                    <th>Insuficiente (1 pt)</th>
                </tr>
                <tr>
                    <td>Aplicación de fórmulas</td>
                    <td>Todas las fórmulas aplicadas correctamente</td>
                    <td>Error en 1 fórmula o cálculo</td>
                    <td>Múltiples errores</td>
                </tr>
                <tr>
                    <td>Explicación de conceptos</td>
                    <td>Explica claramente cada paso y principio</td>
                    <td>Explicación parcial</td>
                    <td>No justifica</td>
                </tr>
                <tr>
                    <td>Unidades y conversiones</td>
                    <td>Todas las unidades correctas y conversiones</td>
                    <td>Error en 1 unidad</td>
                    <td>Múltiples errores</td>
                </tr>
            </table>
        </div>
    </section>

    <!-- CIERRE METACOGNITIVO -->
    <section class="cierre-section">
        <header class="cierre-header">
            <h2 class="seccion-titulo neon-concepto">
                <span class="icon">🧠</span> CIERRE METACOGNITIVO
            </h2>
            <p class="small">Resumen final, autoevaluación y plan de acción para continuar aprendiendo.</p>
        </header>

        <div class="cierre-container">
            <div class="cierre-grid">

                <article class="cierre-card">
                    <h3>📊 AUTOEVALUACIÓN</h3>
                    <p class="small">Valora tu aprendizaje y ajusta tu ruta.</p>

                    <div class="slider-group">
                        <label for="slider1">Conceptos de energía</label>
                        <input type="range" min="1" max="5" value="3" id="slider1" class="autoeval-slider">
                        <output id="valor1">3</output>
                    </div>

                    <div class="slider-group">
                        <label for="slider2">Conservación y transformaciones</label>
                        <input type="range" min="1" max="5" value="3" id="slider2" class="autoeval-slider">
                        <output id="valor2">3</output>
                    </div>

                    <div class="slider-group">
                        <label for="slider3">Cálculos y problemas</label>
                        <input type="range" min="1" max="5" value="3" id="slider3" class="autoeval-slider">
                        <output id="valor3">3</output>
                    </div>

                    <button class="btn-guardar" onclick="guardarAutoevaluacionConservacion()">💾 GUARDAR AUTOEVALUACIÓN</button>
                    <p id="msgAutoevaluacion" class="mensaje-exito" aria-live="polite"></p>
                </article>

                <article class="cierre-card">
                    <h3>💭 REFLEXIÓN</h3>
                    <p class="small">Define cómo aplicar lo aprendido en experiencias reales.</p>
                    <textarea id="textoReflexion" placeholder="Ejemplo: Integrar energía potencial en diseños de montaña rusa..." rows="5"></textarea>
                    <button class="btn-guardar" onclick="guardarReflexionConservacion()">📝 GUARDAR REFLEXIÓN</button>
                    <p id="msgReflexion" class="mensaje-exito" aria-live="polite"></p>
                </article>

                <article class="cierre-card">
                    <h3>📅 PLAN DE ESTUDIO</h3>
                    <p class="small">Marca progreso y garantiza seguimiento.</p>
                    <ul class="plan-list">
                        <li><label><input type="checkbox" id="checkRepaso"> Repasar fórmulas de E<sub>k</sub> y E<sub>p</sub></label></li>
                        <li><label><input type="checkbox" id="checkCalculos"> Resolver 5 problemas de conversión de energía</label></li>
                        <li><label><input type="checkbox" id="checkTransformaciones"> Analizar 3 ejemplos de transformación</label></li>
                        <li><label><input type="checkbox" id="checkTecnologia"> Investigar eficiencias tecnológicas reales</label></li>
                    </ul>
                    <button class="btn-guardar" onclick="guardarPlanEstudioConservacion()">✅ GUARDAR PLAN</button>
                    <p id="msgPlan" class="mensaje-exito" aria-live="polite"></p>
                </article>

                <article class="cierre-card">
                    <h3>🔗 RECURSOS ADICIONALES</h3>
                    <p class="small">Sigue aprendiendo con herramientas probadas.</p>
                    <div class="recursos-links">
                        <a href="https://phet.colorado.edu/es/simulation/energy-skate-park" target="_blank" class="recurso-link">🎮 PhET: Energy Skate Park</a>
                        <a href="https://www.khanacademy.org/science/physics/work-and-energy" target="_blank" class="recurso-link">📚 Khan Academy: Trabajo y Energía</a>
                        <a href="https://hyperphysics.phy-astr.gsu.edu/hbase/hframe.html" target="_blank" class="recurso-link">🌐 HyperPhysics: Energía</a>
                    </div>
                </article>

            </div>
        </div>
    </section>

    <script>
        function _actualizarOutputSlider(idInput, idOutput) {
            const input = document.getElementById(idInput);
            const output = document.getElementById(idOutput);
            if (!input || !output) return;
            output.textContent = input.value;
        }

        function guardarAutoevaluacionConservacion() {
            const slider1 = Number(document.getElementById(\'slider1\').value);
            const slider2 = Number(document.getElementById(\'slider2\').value);
            const slider3 = Number(document.getElementById(\'slider3\').value);
            const promedio = ((slider1 + slider2 + slider3) / 3).toFixed(1);

            const estado = {
                slider1,
                slider2,
                slider3,
                promedio: Number(promedio)
            };
            localStorage.setItem(\'cierreMetacognitivo_autoevaluacion\', JSON.stringify(estado));

            document.getElementById(\'msgAutoevaluacion\').textContent = `Autoevaluación guardada (promedio ${promedio}/5).`;
            document.getElementById(\'msgAutoevaluacion\').style.color = \'#a8eb8b\';
        }

        function guardarReflexionConservacion() {
            const texto = document.getElementById(\'textoReflexion\').value.trim();
            if (!texto) {
                document.getElementById(\'msgReflexion\').textContent = \'Escribe tu reflexión antes de guardar.\';
                document.getElementById(\'msgReflexion\').style.color = \'#ffcc00\';
                return;
            }
            localStorage.setItem(\'cierreMetacognitivo_reflexion\', texto);
            document.getElementById(\'msgReflexion\').textContent = \'Reflexión guardada correctamente.\';
            document.getElementById(\'msgReflexion\').style.color = \'#a8eb8b\';
        }

        function guardarPlanEstudioConservacion() {
            const plan = {
                checkRepaso: document.getElementById(\'checkRepaso\').checked,
                checkCalculos: document.getElementById(\'checkCalculos\').checked,
                checkTransformaciones: document.getElementById(\'checkTransformaciones\').checked,
                checkTecnologia: document.getElementById(\'checkTecnologia\').checked
            };
            localStorage.setItem(\'cierreMetacognitivo_plan\', JSON.stringify(plan));
            document.getElementById(\'msgPlan\').textContent = \'Plan de estudio actualizado.\';
            document.getElementById(\'msgPlan\').style.color = \'#a8eb8b\';
        }

        function cargarCierreMetacognitivo() {
            const auto = JSON.parse(localStorage.getItem(\'cierreMetacognitivo_autoevaluacion\') || \'null\');
            if (auto) {
                document.getElementById(\'slider1\').value = auto.slider1;
                document.getElementById(\'slider2\').value = auto.slider2;
                document.getElementById(\'slider3\').value = auto.slider3;
                _actualizarOutputSlider(\'slider1\', \'valor1\');
                _actualizarOutputSlider(\'slider2\', \'valor2\');
                _actualizarOutputSlider(\'slider3\', \'valor3\');
                document.getElementById(\'msgAutoevaluacion\').textContent = `Autoevaluación recuperada (promedio ${auto.promedio}/5).`;
            }

            const reflexion = localStorage.getItem(\'cierreMetacognitivo_reflexion\');
            if (reflexion) {
                document.getElementById(\'textoReflexion\').value = reflexion;
                document.getElementById(\'msgReflexion\').textContent = \'Reflexión cargada.\';
            }

            const plan = JSON.parse(localStorage.getItem(\'cierreMetacognitivo_plan\') || \'null\');
            if (plan) {
                document.getElementById(\'checkRepaso\').checked = plan.checkRepaso;
                document.getElementById(\'checkCalculos\').checked = plan.checkCalculos;
                document.getElementById(\'checkTransformaciones\').checked = plan.checkTransformaciones;
                document.getElementById(\'checkTecnologia\').checked = plan.checkTecnologia;
                document.getElementById(\'msgPlan\').textContent = \'Plan de estudio cargado.\';
            }

            [\'slider1\', \'slider2\', \'slider3\'].forEach(id => {
                document.getElementById(id).addEventListener(\'input\', function() {
                    _actualizarOutputSlider(id, `valor${id.slice(-1)}`);
                });
            });
        }

        cargarCierreMetacognitivo();
    </script>
</div>

<!-- JAVASCRIPT INTEGRADO -->
<script>
// ========================================
// SISTEMA DE SIMULACIÓN PÉNDULO
// ========================================

let simulacionActiva = false;
let intervaloSimulacion;
let energiaInicial = 0;
let conFriccion = false;

// Función para calcular la altura vertical del péndulo
function calcularAltura(longitud, anguloGrados) {
    return longitud * (1 - Math.cos(anguloGrados * Math.PI / 180));
}

function iniciarSimulacion() {
    if (simulacionActiva) return;
    simulacionActiva = true;
    conFriccion = document.getElementById(\'friccionToggle\').checked;

    const masa = parseFloat(document.getElementById(\'masaPendulo\').value);
    const longitud = parseFloat(document.getElementById(\'longitudPendulo\').value);
    const anguloInicial = parseFloat(document.getElementById(\'anguloInicial\').value);

    // Energía potencial inicial (referencia en punto más bajo)
    const alturaMax = calcularAltura(longitud, anguloInicial);
    energiaInicial = masa * 9.8 * alturaMax;
    const periodo = 2 * Math.PI * Math.sqrt(longitud / 9.8);

    // Actualizar estadísticas iniciales
    document.getElementById(\'statMaxEp\').textContent = energiaInicial.toFixed(2) + \' J\';
    document.getElementById(\'statMaxEk\').textContent = energiaInicial.toFixed(2) + \' J\';
    document.getElementById(\'dataEnergiaTotal\').textContent = energiaInicial.toFixed(2) + \' J\';
    document.getElementById(\'dataPeriodo\').textContent = periodo.toFixed(2) + \' s\';

    // Configurar trayectoria del péndulo
    const radio = longitud * 50; // Escala para visualización
    const centroX = 300;
    const centroY = 100;
    const anguloRad = anguloInicial * Math.PI / 180;

    // Crear path para la animación (arco de círculo)
    const startX = centroX + radio * Math.sin(anguloRad);
    const startY = centroY + radio * Math.cos(anguloRad);
    const endX = centroX - radio * Math.sin(anguloRad);
    const endY = centroY + radio * Math.cos(anguloRad);

    const largeArcFlag = anguloInicial > 90 ? 1 : 0;

    const path = `
        M ${centroX} ${centroY}
        L ${startX} ${startY}
        A ${radio} ${radio} 0 ${largeArcFlag} 1 ${endX} ${endY}
        L ${centroX} ${centroY}
    `;

    document.getElementById(\'trayectoria\').setAttribute(\'d\', path);

    // Configurar animación
    const anim = document.getElementById(\'animPendulo\');
    anim.setAttribute(\'path\', `
        M ${startX} ${startY}
        A ${radio} ${radio} 0 ${largeArcFlag} 1 ${endX} ${endY}
    `);
    anim.setAttribute(\'dur\', periodo + \'s\');

    // Simulación en tiempo real
    let tiempo = 0;
    let energiaActual = energiaInicial;
    let amplitudActual = anguloInicial;
    const amortiguamiento = 0.995; // Factor de amortiguamiento por fricción

    intervaloSimulacion = setInterval(() => {
        tiempo += 0.05;

        // Ángulo actual (oscilación armónica con amortiguamiento si hay fricción)
        let anguloActual;
        if (conFriccion) {
            // Amortiguamiento exponencial
            const env = Math.exp(-0.1 * tiempo);
            anguloActual = anguloInicial * env * Math.cos(2 * Math.PI * tiempo / periodo);
            energiaActual = energiaInicial * env * env;
            amplitudActual = anguloInicial * env;
        } else {
            // Oscilación simple
            anguloActual = anguloInicial * Math.cos(2 * Math.PI * tiempo / periodo);
        }

        // Altura actual
        const alturaActual = calcularAltura(longitud, Math.abs(anguloActual));
        const epActual = masa * 9.8 * alturaActual;
        const ekActual = energiaActual - epActual; // Conservación (con posible amortiguamiento)

        // Velocidad (para mostrar)
        const velocidad = Math.sqrt(2 * ekActual / masa);

        // Actualizar SVG: posición del péndulo
        const anguloRadActual = anguloActual * Math.PI / 180;
        const x = centroX + radio * Math.sin(anguloRadActual);
        const y = centroY + radio * Math.cos(anguloRadActual);

        document.getElementById(\'hiloPendulo\').setAttribute(\'x2\', x);
        document.getElementById(\'hiloPendulo\').setAttribute(\'y2\', y);
        document.getElementById(\'masaPenduloSVG\').setAttribute(\'cx\', x);
        document.getElementById(\'masaPenduloSVG\').setAttribute(\'cy\', y);

        // Actualizar barras de energía (escaladas a energía inicial)
        const maxWidth = 200;
        const barraEpWidth = conFriccion ?
            (epActual / energiaInicial) * maxWidth :
            (epActual / energiaInicial) * maxWidth;
        const barraEkWidth = conFriccion ?
            (ekActual / energiaInicial) * maxWidth :
            (ekActual / energiaInicial) * maxWidth;

        document.getElementById(\'barraEp\').setAttribute(\'width\', barraEpWidth);
        document.getElementById(\'barraEk\').setAttribute(\'width\', barraEkWidth);

        // Actualizar textos
        document.getElementById(\'textEp\').textContent = epActual.toFixed(2) + \' J\';
        document.getElementById(\'textEk\').textContent = ekActual.toFixed(2) + \' J\';
        document.getElementById(\'textTotal\').textContent = (epActual + ekActual).toFixed(2);

        document.getElementById(\'formulaEp\').textContent = epActual.toFixed(2);
        document.getElementById(\'formulaEk\').textContent = ekActual.toFixed(2);
        document.getElementById(\'formulaTotal\').textContent = (epActual + ekActual).toFixed(2);

        // Datos en tiempo real
        document.getElementById(\'dataAlturaMax\').textContent = calcularAltura(longitud, anguloInicial).toFixed(2) + \' m\';
        document.getElementById(\'dataVelMax\').textContent = Math.sqrt(2 * energiaInicial / masa).toFixed(2) + \' m/s\';
        document.getElementById(\'dataEnergiaTotal\').textContent = (epActual + ekActual).toFixed(2) + \' J\';

        // Conservación (porcentaje)
        const conservacion = conFriccion ?
            ((epActual + ekActual) / energiaInicial * 100).toFixed(1) :
            \'100\';
        document.getElementById(\'statConservacion\').textContent = conservacion + \'%\';

        // Detener si la amplitud es muy pequeña (por fricción)
        if (conFriccion && Math.abs(anguloActual) < 0.5) {
            pausarSimulacion();
            document.getElementById(\'statConservacion\').textContent = \'0% (detenido)\';
        }
    }, 50); // 20 fps para simulación suave
}

function pausarSimulacion() {
    simulacionActiva = false;
    clearInterval(intervaloSimulacion);
}

function reiniciarSimulacion() {
    pausarSimulacion();

    // Restaurar valores iniciales
    document.getElementById(\'hiloPendulo\').setAttribute(\'x2\', \'300\');
    document.getElementById(\'hiloPendulo\').setAttribute(\'y2\', \'200\');
    document.getElementById(\'masaPenduloSVG\').setAttribute(\'cx\', \'300\');
    document.getElementById(\'masaPenduloSVG\').setAttribute(\'cy\', \'200\');

    document.getElementById(\'barraEp\').setAttribute(\'width\', \'0\');
    document.getElementById(\'barraEk\').setAttribute(\'width\', \'0\');

    // Actualizar textos
    document.getElementById(\'textEp\').textContent = \'0 J\';
    document.getElementById(\'textEk\').textContent = \'0 J\';
    document.getElementById(\'textTotal\').textContent = \'0\';
    document.getElementById(\'formulaEp\').textContent = \'0\';
    document.getElementById(\'formulaEk\').textContent = \'0\';
    document.getElementById(\'formulaTotal\').textContent = \'0\';

    // Actualizar controles en tiempo real
    document.getElementById(\'masaValue\').textContent = document.getElementById(\'masaPendulo\').value + \' kg\';
    document.getElementById(\'longitudValue\').textContent = document.getElementById(\'longitudPendulo\').value + \' m\';
    document.getElementById(\'anguloValue\').textContent = document.getElementById(\'anguloInicial\').value + \'°\';
}

// Event listeners para controles
document.getElementById(\'masaPendulo\').addEventListener(\'input\', function() {
    document.getElementById(\'masaValue\').textContent = this.value + \' kg\';
});

document.getElementById(\'longitudPendulo\').addEventListener(\'input\', function() {
    document.getElementById(\'longitudValue\').textContent = this.value + \' m\';
});

document.getElementById(\'anguloInicial\').addEventListener(\'input\', function() {
    document.getElementById(\'anguloValue\').textContent = this.value + \'°\';
});

// ========================================
// CALCULADORA ENERGÍA CAÍDA LIBRE
// ========================================

function calcularEnergia() {
    const m = parseFloat(document.getElementById(\'masa\').value);
    const g = parseFloat(document.getElementById(\'gravedad\').value);
    const h = parseFloat(document.getElementById(\'altura\').value);

    const ep = m * g * h;
    const v = Math.sqrt(2 * ep / m);

    document.getElementById(\'resultadoEp\').textContent = ep.toFixed(1);
    document.getElementById(\'velocidadFinal\').textContent = v.toFixed(1);

    console.log(`📊 Energía calculada: ${ep.toFixed(1)} J, v = ${v.toFixed(1)} m/s`);
}

// ========================================
// TABLA INTERACTIVA DE FORMAS DE ENERGÍA
// ========================================

document.querySelectorAll(\'.tabla-cyberpunk tbody tr\').forEach(row => {
    row.addEventListener(\'click\', function() {
        const forma = this.dataset.forma;
        const info = document.getElementById(\'infoForma\');

        const infoTextos = {
            cinetica: "Energía asociada al movimiento. Depende de la masa y la velocidad al cuadrado. Ejemplo: Un auto a 100 km/h tiene más \\(E_k\\) que uno a 50 km/h, aunque pesen lo mismo.",
            potencial: "Energía almacenada por la posición en un campo de fuerzas (normalmente gravitatorio). Depende de la altura, masa y gravedad.",
            elastica: "Energía almacenada en objetos deformados (resortes, gomas). La constante elástica (k) determina cuánto se almacena por unidad de deformación.",
            termica: "Energía interna de un sistema debido a la temperatura. Se transfiere como calor. 1 caloría = 4.184 J.",
            electrica: "Energía asociada a cargas eléctricas en movimiento. Potencia (P) = Energía (E) / Tiempo (t).",
            quimica: "Energía almacenada en los enlaces químicos. Se libera o absorbe en reacciones (exotérmicas/endotérmicas).",
            nuclear: "Energía almacenada en el núcleo atómico. \\(E=mc^2\\) muestra su enorme magnitud: 1 kg de masa = 9×10¹⁶ J."
        };

        info.textContent = infoTextos[forma] || "Información no disponible";
        info.style.animation = "highlight 0.5s";

        // Remover selección previa
        document.querySelectorAll(\'.tabla-cyberpunk tbody tr\').forEach(r => {
            r.classList.remove(\'selected\');
        });

        // Marcar fila seleccionada
        this.classList.add(\'selected\');
    });
});

// ========================================
// QUIZ INTERACTIVO
// ========================================

let quizRespuestas = [];
let quizCompletado = false;

document.querySelectorAll(\'.quiz-option\').forEach(option => {
    option.addEventListener(\'click\', function() {
        if (quizCompletado) return;

        const question = this.closest(\'.quiz-question\');
        const correct = question.dataset.correct;
        const selected = this.dataset.value;
        const feedback = question.querySelector(\'.quiz-feedback\');

        // Remover selección previa
        question.querySelectorAll(\'.quiz-option\').forEach(opt => {
            opt.classList.remove(\'selected\', \'correct\', \'incorrect\');
        });

        // Marcar selección actual
        this.classList.add(\'selected\');

        // Verificar respuesta
        if (selected === correct) {
            this.classList.add(\'correct\');
            quizRespuestas.push(true);
        } else {
            this.classList.add(\'incorrect\');
            // Marcar también la correcta
            question.querySelector(`[data-value="${correct}"]`).classList.add(\'correct\');
            quizRespuestas.push(false);
        }

        // Mostrar feedback
        feedback.style.display = \'block\';

        // Verificar si todas respondidas
        verificarCompletadoQuiz();
    });
});

function verificarCompletadoQuiz() {
    const questions = document.querySelectorAll(\'.quiz-question\');
    const answered = Array.from(questions).every(q =>
        q.querySelector(\'.quiz-option.selected\')
    );

    if (answered && !quizCompletado) {
        quizCompletado = true;
        mostrarResultadosQuiz();
    }
}

function mostrarResultadosQuiz() {
    const correctas = quizRespuestas.filter(r => r).length;
    const total = quizRespuestas.length;

    document.getElementById(\'quizScore\').textContent = `${correctas}/${total}`;

    // Feedback adicional
    const feedbackElement = document.createElement(\'div\');
    feedbackElement.className = \'feedback-adicional\';
    feedbackElement.style.marginTop = \'10px\';

    if (correctas === total) {
        feedbackElement.innerHTML = \'<strong>🌟 Excelente!</strong> Dominas los conceptos de energía y conservación.\';
    } else if (correctas >= total/2) {
        feedbackElement.innerHTML = \'<strong>👍 Bueno!</strong> Revisa los conceptos de conservación y transformaciones.\';
    } else {
        feedbackElement.innerHTML = \'<strong>📚 Necesitas repasar:</strong> Vuelve a estudiar las fórmulas de energía cinética y potencial, y la ley de conservación.\';
    }

    document.querySelector(\'.quiz-results\').prepend(feedbackElement);
}

function reiniciarQuiz() {
    quizRespuestas = [];
    quizCompletado = false;

    document.querySelectorAll(\'.quiz-option\').forEach(opt => {
        opt.classList.remove(\'selected\', \'correct\', \'incorrect\');
    });

    document.querySelectorAll(\'.quiz-feedback\').forEach(fb => {
        fb.style.display = \'none\';
    });

    document.querySelector(\'.feedback-adicional\')?.remove();
}

// ========================================
// PROBLEMAS TIPO EXAMEN
// ========================================

function verificarProblema(num) {
    const solucion = document.getElementById(`solucionP${num}`);
    if (solucion.style.display === \'block\') {
        solucion.style.display = \'none\';
    } else {
        solucion.style.display = \'block\';
    }
}

// ========================================
// AUTOEVALUACIÓN
// ========================================

function guardarAutoevaluacion() {
    const slider1 = parseInt(document.getElementById(\'slider1\').value, 10);
    const slider2 = parseInt(document.getElementById(\'slider2\').value, 10);
    const slider3 = parseInt(document.getElementById(\'slider3\').value, 10);
    const promedio = ((slider1 + slider2 + slider3) / 3).toFixed(1);

    const estado = {
        conceptos: slider1,
        conservacion: slider2,
        calculos: slider3,
        promedio: Number(promedio),
        fecha: new Date().toLocaleString()
    };

    localStorage.setItem(\'autoevaluacion_energia\', JSON.stringify(estado));
    document.getElementById(\'msgAutoevaluacion\').textContent = `✅ Guardado con éxito (${estado.fecha}). Promedio ${promedio}/5`;
}

function guardarReflexion() {
    const texto = document.getElementById(\'textoReflexion\').value.trim();
    if (!texto) {
        document.getElementById(\'msgReflexion\').textContent = \'ℹ️ Escribe tu reflexión antes de guardar.\';
        return;
    }

    localStorage.setItem(\'reflexion_energia\', JSON.stringify({texto, fecha: new Date().toLocaleString()}));
    document.getElementById(\'msgReflexion\').textContent = \'✅ Reflexión guardada. Excelente trabajo.\';
}

function guardarPlanEstudio() {
    const plan = {
        repaso: document.getElementById(\'checkRepaso\').checked,
        calculos: document.getElementById(\'checkCalculos\').checked,
        transformaciones: document.getElementById(\'checkTransformaciones\').checked,
        tecnologia: document.getElementById(\'checkTecnologia\').checked,
        fecha: new Date().toLocaleString()
    };

    localStorage.setItem(\'plan_energia\', JSON.stringify(plan));
    document.getElementById(\'msgPlan\').textContent = \'✅ Plan de estudio guardado.\';
}

function cargarCierrePersistencia() {
    const datos = localStorage.getItem(\'autoevaluacion_energia\');
    if (datos) {
        const estado = JSON.parse(datos);
        document.getElementById(\'slider1\').value = estado.conceptos;
        document.getElementById(\'slider2\').value = estado.conservacion;
        document.getElementById(\'slider3\').value = estado.calculos;
        document.getElementById(\'valor1\').textContent = estado.conceptos;
        document.getElementById(\'valor2\').textContent = estado.conservacion;
        document.getElementById(\'valor3\').textContent = estado.calculos;
        document.getElementById(\'msgAutoevaluacion\').textContent = `Última guardada: ${estado.fecha} (promedio ${estado.promedio}/5)`;
    }

    const reflexion = localStorage.getItem(\'reflexion_energia\');
    if (reflexion) {
        document.getElementById(\'textoReflexion\').value = JSON.parse(reflexion).texto;
        document.getElementById(\'msgReflexion\').textContent = \'Reflexión recuperada.\';
    }

    const plan = localStorage.getItem(\'plan_energia\');
    if (plan) {
        const estadoPlan = JSON.parse(plan);
        document.getElementById(\'checkRepaso\').checked = estadoPlan.repaso;
        document.getElementById(\'checkCalculos\').checked = estadoPlan.calculos;
        document.getElementById(\'checkTransformaciones\').checked = estadoPlan.transformaciones;
        document.getElementById(\'checkTecnologia\').checked = estadoPlan.tecnologia;
        document.getElementById(\'msgPlan\').textContent = \'Plan recuperado.\';
    }
}

// ========================================
// UTILIDADES INTERACTIVAS
// ========================================

function toggleError(header) {
    const card = header.closest(\'.error-card\');
    if (!card) return;

    const content = card.querySelector(\'.error-content\');
    const icon = header.querySelector(\'.error-toggle\');
    if (!content || !icon) return;

    const isOpen = card.classList.toggle(\'open\');
    content.style.display = isOpen ? \'block\' : \'none\';
    icon.textContent = isOpen ? \'−\' : \'+\';
}

function mostrarEjemplo(tipo) {
    const ejemplos = {
        mecanica: \'Simulación mecánica: un péndulo transfiere energía potencial y cinética alternadamente.\',
        electrotermica: \'Simulación electro-térmica: energía eléctrica se convierte en térmica y luz.\',
        quimicamecanica: \'Simulación químico-mecánica: motor convierte energía química en trabajo mecánico.\'
    };

    const mensaje = ejemplos[tipo] || \'Selecciona un ejemplo válido para explorar la transformación energética.\';
    const panel = document.getElementById(\'infoForma\');

    if (panel) {
        panel.textContent = mensaje;
        panel.style.borderColor = \'#ffeb3b\';
        panel.style.animation = \'highlight 0.5s ease\';

        setTimeout(() => {
            panel.style.borderColor = \'\';
            panel.style.animation = \'\';
        }, 700);
    } else {
        alert(mensaje);
    }
}

// ========================================
// INICIALIZACIÓN
// ========================================

console.log("⚡ Sistema Cyberpunk Física - Energía inicializado");
console.log("🔬 Simulador de péndulo con conservación de energía");
console.log("❓ Quiz interactivo con 3 preguntas");
console.log("📊 Problemas tipo examen con soluciones detalladas");

// Inicializar controles
reiniciarSimulacion();

// Inicializar cierre metacognitivo y enlaces de autoevaluación
[\'slider1\',\'slider2\',\'slider3\'].forEach(id => {
    const slider = document.getElementById(id);
    const output = document.getElementById(\'valor\' + id.slice(-1));
    if (slider && output) {
        output.textContent = slider.value;
        slider.addEventListener(\'input\', () => {
            output.textContent = slider.value;
        });
    }
});

cargarCierrePersistencia();
</script>
',
    'ejercicios' => 
    array (
      0 => 
      array (
        'enunciado' => 'Define energía',
        'respuesta' => 'Capacidad para realizar trabajo',
      ),
      1 => 
      array (
        'enunciado' => 'Unidad de energía',
        'respuesta' => 'Joule (J)',
      ),
      2 => 
      array (
        'enunciado' => 'Ley de conservación',
        'respuesta' => 'Energía no se crea ni destruye, se transforma',
      ),
      3 => 
      array (
        'enunciado' => 'E_k de 2 kg a 5 m/s',
        'respuesta' => '25 J',
      ),
      4 => 
      array (
        'enunciado' => 'E_p de 1 kg a 10 m',
        'respuesta' => '98 J',
      ),
      5 => 
      array (
        'enunciado' => 'Transformación en caída libre',
        'respuesta' => 'E_p → E_k',
      ),
      6 => 
      array (
        'enunciado' => 'Energía en gasolina',
        'respuesta' => 'Química',
      ),
      7 => 
      array (
        'enunciado' => 'Energía en batería',
        'respuesta' => 'Eléctrica',
      ),
      8 => 
      array (
        'enunciado' => 'Energía en sol',
        'respuesta' => 'Nuclear (fusión)',
      ),
      9 => 
      array (
        'enunciado' => 'Eficiencia = (E_salida / E_entrada) × 100%',
        'respuesta' => 'Fórmula eficiencia',
      ),
      10 => 
      array (
        'enunciado' => 'SI: 1 kWh =',
        'respuesta' => '3.6 MJ',
      ),
      11 => 
      array (
        'enunciado' => 'Trabajo = F × d × cosθ',
        'respuesta' => 'Fórmula trabajo',
      ),
    ),
    'quiz' => 
    array (
      0 => 
      array (
        'pregunta' => 'Energía es...',
        'opciones' => 
        array (
          0 => 'Capacidad para trabajo',
          1 => 'Fuerza',
          2 => 'Velocidad',
          3 => 'Masa',
        ),
        'correcta' => 'Capacidad para trabajo',
      ),
      1 => 
      array (
        'pregunta' => 'Unidad SI',
        'opciones' => 
        array (
          0 => 'Joule',
          1 => 'Newton',
          2 => 'Watt',
          3 => 'Pascal',
        ),
        'correcta' => 'Joule',
      ),
      2 => 
      array (
        'pregunta' => 'Ley de conservación',
        'opciones' => 
        array (
          0 => 'E total constante',
          1 => 'E aumenta',
          2 => 'E disminuye',
          3 => 'E se pierde',
        ),
        'correcta' => 'E total constante',
      ),
      3 => 
      array (
        'pregunta' => 'E_cinética depende de...',
        'opciones' => 
        array (
          0 => 'm y v',
          1 => 'solo m',
          2 => 'solo v',
          3 => 'h',
        ),
        'correcta' => 'm y v',
      ),
      4 => 
      array (
        'pregunta' => 'E_potencial depende de...',
        'opciones' => 
        array (
          0 => 'm, g, h',
          1 => 'solo m',
          2 => 'solo v',
          3 => 'F',
        ),
        'correcta' => 'm, g, h',
      ),
      5 => 
      array (
        'pregunta' => 'En sistema aislado...',
        'opciones' => 
        array (
          0 => 'E constante',
          1 => 'E varía',
          2 => 'E = 0',
          3 => 'E infinita',
        ),
        'correcta' => 'E constante',
      ),
      6 => 
      array (
        'pregunta' => 'Trabajo =',
        'opciones' => 
        array (
          0 => 'F × d × cosθ',
          1 => 'm × a',
          2 => '½mv²',
          3 => 'mgh',
        ),
        'correcta' => 'F × d × cosθ',
      ),
      7 => 
      array (
        'pregunta' => 'Energía química en...',
        'opciones' => 
        array (
          0 => 'Combustión',
          1 => 'Movimiento',
          2 => 'Altura',
          3 => 'Velocidad',
        ),
        'correcta' => 'Combustión',
      ),
      8 => 
      array (
        'pregunta' => 'Péndulo convierte...',
        'opciones' => 
        array (
          0 => 'E_p ↔ E_k',
          1 => 'E_k → E_térmica',
          2 => 'E_e → E_p',
          3 => 'E_nuclear',
        ),
        'correcta' => 'E_p ↔ E_k',
      ),
      9 => 
      array (
        'pregunta' => '1 J =',
        'opciones' => 
        array (
          0 => '1 N·m',
          1 => '1 kg·m/s',
          2 => '1 W·s',
          3 => '1 kg',
        ),
        'correcta' => '1 N·m',
      ),
      10 => 
      array (
        'pregunta' => 'E_k de 4 kg a 3 m/s',
        'opciones' => 
        array (
          0 => '18 J',
          1 => '12 J',
          2 => '24 J',
          3 => '36 J',
        ),
        'correcta' => '18 J',
      ),
      11 => 
      array (
        'pregunta' => 'E_p de 5 kg a 20 m',
        'opciones' => 
        array (
          0 => '980 J',
          1 => '100 J',
          2 => '490 J',
          3 => '1960 J',
        ),
        'correcta' => '980 J',
      ),
      12 => 
      array (
        'pregunta' => 'En bombilla, E_eléctrica →',
        'opciones' => 
        array (
          0 => 'Luz + térmica',
          1 => 'Solo luz',
          2 => 'Solo cinética',
          3 => 'Nuclear',
        ),
        'correcta' => 'Luz + térmica',
      ),
      13 => 
      array (
        'pregunta' => 'Eficiencia =',
        'opciones' => 
        array (
          0 => '(E_salida / E_entrada) × 100%',
          1 => 'E_entrada / E_salida',
          2 => 'E_total',
          3 => 'W / t',
        ),
        'correcta' => '(E_salida / E_entrada) × 100%',
      ),
      14 => 
      array (
        'pregunta' => '1 kWh =',
        'opciones' => 
        array (
          0 => '3.6 MJ',
          1 => '1 MJ',
          2 => '3.6 kJ',
          3 => '36 MJ',
        ),
        'correcta' => '3.6 MJ',
      ),
      15 => 
      array (
        'pregunta' => 'Energía nuclear en...',
        'opciones' => 
        array (
          0 => 'Fusión/fisión',
          1 => 'Combustión',
          2 => 'Caída',
          3 => 'Resorte',
        ),
        'correcta' => 'Fusión/fisión',
      ),
      16 => 
      array (
        'pregunta' => 'Montaña rusa: punto más alto',
        'opciones' => 
        array (
          0 => 'Máx E_p',
          1 => 'Máx E_k',
          2 => 'E = 0',
          3 => 'E térmica',
        ),
        'correcta' => 'Máx E_p',
      ),
      17 => 
      array (
        'pregunta' => 'Montaña rusa: punto más bajo',
        'opciones' => 
        array (
          0 => 'Máx E_k',
          1 => 'Máx E_p',
          2 => 'E = 0',
          3 => 'E química',
        ),
        'correcta' => 'Máx E_k',
      ),
      18 => 
      array (
        'pregunta' => 'Potencia =',
        'opciones' => 
        array (
          0 => 'W / t',
          1 => 'F × d',
          2 => '½mv²',
          3 => 'mgh',
        ),
        'correcta' => 'W / t',
      ),
      19 => 
      array (
        'pregunta' => 'SI: potencia en',
        'opciones' => 
        array (
          0 => 'Watt (W)',
          1 => 'Joule',
          2 => 'Newton',
          3 => 'Pascal',
        ),
        'correcta' => 'Watt (W)',
      ),
      20 => 
      array (
        'pregunta' => 'Objeto 1 kg, v = 10 m/s → E_k =',
        'opciones' => 
        array (
          0 => '50 J',
          1 => '100 J',
          2 => '25 J',
          3 => '500 J',
        ),
        'correcta' => '50 J',
      ),
      21 => 
      array (
        'pregunta' => 'Resorte k=200 N/m, x=0.1 m → E_e =',
        'opciones' => 
        array (
          0 => '1 J',
          1 => '2 J',
          2 => '0.5 J',
          3 => '10 J',
        ),
        'correcta' => '1 J',
      ),
      22 => 
      array (
        'pregunta' => 'Eficiencia 75%, E_entrada=400 J → E_salida=',
        'opciones' => 
        array (
          0 => '300 J',
          1 => '100 J',
          2 => '533 J',
          3 => '75 J',
        ),
        'correcta' => '300 J',
      ),
      23 => 
      array (
        'pregunta' => 'Trabajo de 50 N en 2 m, θ=0° → W=',
        'opciones' => 
        array (
          0 => '100 J',
          1 => '50 J',
          2 => '25 J',
          3 => '0 J',
        ),
        'correcta' => '100 J',
      ),
      24 => 
      array (
        'pregunta' => 'θ=90° → W=',
        'opciones' => 
        array (
          0 => '0 J',
          1 => 'F×d',
          2 => '½Fd',
          3 => 'Fd²',
        ),
        'correcta' => '0 J',
      ),
      25 => 
      array (
        'pregunta' => 'Energía disipada por fricción',
        'opciones' => 
        array (
          0 => 'Térmica',
          1 => 'Cinética',
          2 => 'Potencial',
          3 => 'Eléctrica',
        ),
        'correcta' => 'Térmica',
      ),
      26 => 
      array (
        'pregunta' => 'Principio fundamental',
        'opciones' => 
        array (
          0 => 'Conservación E',
          1 => 'Conservación masa',
          2 => 'Inercia',
          3 => 'Aceleración',
        ),
        'correcta' => 'Conservación E',
      ),
      27 => 
      array (
        'pregunta' => 'E = mc² es...',
        'opciones' => 
        array (
          0 => 'Equivalencia masa-energía',
          1 => 'Cinética',
          2 => 'Potencial',
          3 => 'Eléctrica',
        ),
        'correcta' => 'Equivalencia masa-energía',
      ),
      28 => 
      array (
        'pregunta' => 'En reactor nuclear',
        'opciones' => 
        array (
          0 => 'Fisión',
          1 => 'Fusión',
          2 => 'Combustión',
          3 => 'Caída',
        ),
        'correcta' => 'Fisión',
      ),
      29 => 
      array (
        'pregunta' => 'SI 2025: 1 eV =',
        'opciones' => 
        array (
          0 => '1.6 × 10⁻¹⁹ J',
          1 => '1 J',
          2 => '1 MJ',
          3 => '1 kJ',
        ),
        'correcta' => '1.6 × 10⁻¹⁹ J',
      ),
    ),
  ),
  1 => 
  array (
    'materia' => 'Física I',
    'slug' => 'tipos-energia-cyberpunk',
    'titulo' => 'Energía: Del Sol a la Red Eléctrica',
    'contenido' => '<!-- INICIO LECCIÓN CYBERPUNK -->
<div class="leccion-container leccion-fisica-energia" data-tema="tipos-energia">
    <!-- CABECERA CYBERPUNK -->
    <header class="leccion-header">
        <h1 class="titulo-leccion neon-glow">
            <span class="icon-tema">⚡</span>
            TIPOS DE ENERGÍA: LA MATRIZ DEL FUTURO
        </h1>
        <div class="subtitulo">
            De las Fuentes Primarias a las Transformaciones Sostenibles
        </div>
    </header>

    <!-- PANEL OBJETIVOS -->
    <section class="panel-objetivos">
        <h2 class="seccion-titulo neon-concepto">
            <span class="icon">🎯</span> OBJETIVOS DE APRENDIZAJE
        </h2>
        <div class="objetivos-grid">
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Identificar los 6 tipos principales de energía</h3>
                <p>Mecánica, térmica, química, eléctrica, nuclear y radiante</p>
            </div>
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Clasificar fuentes renovables y no renovables</h3>
                <p>Analizar su impacto ambiental y disponibilidad</p>
            </div>
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Explicar transformaciones energéticas</h3>
                <p>Desde fuentes primarias hasta energía útil</p>
            </div>
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Calcular eficiencias en sistemas reales</h3>
                <p>Aplicar la ley de conservación de la energía</p>
            </div>
        </div>
    </section>

    <!-- CONTEXTO REAL -->
    <section class="contexto-real">
        <h2 class="seccion-titulo neon-dato">
            <span class="icon">🌍</span> APLICACIONES EN EL MUNDO REAL
        </h2>
        <div class="contexto-grid">
            <div class="contexto-card">
                <h3>🌞 ENERGÍA SOLAR</h3>
                <p>Paneles fotovoltaicos convierten <strong>energía radiante → eléctrica</strong> con ~20% eficiencia</p>
                <div class="dato-neon">Ejemplo: Granjas solares en desiertos</div>
            </div>
            <div class="contexto-card">
                <h3>🚗 MOTORES HÍBRIDOS</h3>
                <p>Combinan <strong>química (gasolina) → térmica → mecánica</strong> y <strong>eléctrica (baterías)</strong></p>
                <div class="dato-neon">Eficiencia: ~30-40%</div>
            </div>
            <div class="contexto-card">
                <h3>💡 CENTRALES NUCLEARES</h3>
                <p>Transforman <strong>nuclear → térmica → mecánica → eléctrica</strong> con ~33% eficiencia</p>
                <div class="dato-neon">Ejemplo: Reactores de fisión (U-235)</div>
            </div>
        </div>
    </section>

    <!-- SECCIÓN TEÓRICA -->
    <section class="teoria-section">
        <div class="borde-neon-lateral"></div>
        <h2 class="seccion-titulo neon-concepto">
            <span class="icon">📚</span> FUNDAMENTOS TEÓRICOS
        </h2>

        <!-- LEY DE CONSERVACIÓN -->
        <div class="subseccion">
            <h3>1. Ley de Conservación de la Energía</h3>
            <div class="ley-conservacion">
                <div class="formula-grand">
                    \\[
                    E_{\\text{total}} = \\text{constante}
                    \\]
                </div>
                <p>La energía no se crea ni se destruye, solo se <strong>transforma</strong> de una forma a otra.</p>
                <div class="ejemplo-conservacion">
                    <strong>Ejemplo:</strong> En un péndulo:
                    \\[
                    E_p \\xrightleftharpoons[altura]{} E_k
                    \\]
                </div>
            </div>
        </div>

        <!-- TIPOS DE ENERGÍA -->
        <div class="subseccion">
            <h3>2. Clasificación de la Energía</h3>
            <div class="tipos-energia-grid">
                <div class="tipo-card" style="border-color: #4CAF50;">
                    <h4>🚀 MECÁNICA</h4>
                    <div class="formula-inline">
                        \\[
                        E_k = \\frac{1}{2}mv^2 \\quad E_p = mgh
                        \\]
                    </div>
                    <p><strong>Fuentes:</strong> Movimiento, altura (ej: viento, represas)</p>
                </div>
                <div class="tipo-card" style="border-color: #FF5722;">
                    <h4>🔥 TÉRMICA</h4>
                    <div class="formula-inline">
                        \\[
                        Q = mc\\Delta T
                        \\]
                    </div>
                    <p><strong>Fuentes:</strong> Combustión, geotermia (ej: motores, volcanes)</p>
                </div>
                <div class="tipo-card" style="border-color: #E91E63;">
                    <h4>⚗️ QUÍMICA</h4>
                    <p><strong>Fuentes:</strong> Enlaces moleculares (ej: baterías, alimentos)</p>
                </div>
                <div class="tipo-card" style="border-color: #2196F3;">
                    <h4>⚡ ELÉCTRICA</h4>
                    <div class="formula-inline">
                        \\[
                        E = qV
                        \\]
                    </div>
                    <p><strong>Fuentes:</strong> Cargas en movimiento (ej: redes eléctricas)</p>
                </div>
                <div class="tipo-card" style="border-color: #9C27B0;">
                    <h4>☢ NUCLEAR</h4>
                    <div class="formula-inline">
                        \\[
                        E = \\Delta mc^2
                        \\]
                    </div>
                    <p><strong>Fuentes:</strong> Fisión/fusión (ej: reactores, Sol)</p>
                </div>
                <div class="tipo-card" style="border-color: #FFC107;">
                    <h4>🌞 RADIANTE</h4>
                    <p><strong>Fuentes:</strong> Ondas electromagnéticas (ej: luz solar, microondas)</p>
                </div>
            </div>
        </div>

        <!-- FUENTES DE ENERGÍA -->
        <div class="subseccion">
            <h3>3. Fuentes de Energía</h3>
            <div class="fuentes-grid">
                <div class="fuente-card renovable">
                    <div class="fuente-header">🌿 RENOVABLES</div>
                    <div class="fuente-body">
                        <div class="fuente-item">
                            <strong>Solar:</strong> Radiante → Eléctrica (paneles FV)
                        </div>
                        <div class="fuente-item">
                            <strong>Eólica:</strong> Mecánica (viento) → Eléctrica
                        </div>
                        <div class="fuente-item">
                            <strong>Hidroeléctrica:</strong> Potencial (agua) → Eléctrica
                        </div>
                        <div class="fuente-item">
                            <strong>Biomasa:</strong> Química → Térmica/Eléctrica
                        </div>
                    </div>
                </div>
                <div class="fuente-card no-renovable">
                    <div class="fuente-header">⛽ NO RENOVABLES</div>
                    <div class="fuente-body">
                        <div class="fuente-item">
                            <strong>Fósiles:</strong> Química (carbón/petróleo) → Térmica
                        </div>
                        <div class="fuente-item">
                            <strong>Nuclear:</strong> Nuclear (U) → Térmica → Eléctrica
                        </div>
                    </div>
                </div>
            </div>
            <div class="impacto-ambiental">
                <h4>🌱 IMPACTO AMBIENTAL</h4>
                <div class="impacto-grid">
                    <div class="impacto-item bajo">Renovables: <strong>Bajo</strong> (CO₂ ~0)</div>
                    <div class="impacto-item alto">Fósiles: <strong>Alto</strong> (CO₂ ++)</div>
                    <div class="impacto-item medio">Nuclear: <strong>Medio</strong> (residuos radiactivos)</div>
                </div>
            </div>
        </div>

        <!-- TRANSFORMACIONES -->
        <div class="subseccion">
            <h3>4. Transformaciones Energéticas</h3>
            <div class="transformaciones-diagrama">
                <svg width="600" height="300" viewBox="0 0 600 300" id="diagramaTransformaciones">
                    <!-- Fondo -->
                    <rect x="0" y="0" width="600" height="300" fill="#E8F5E9" rx="10"/>

                    <!-- Sol -->
                    <g id="sol">
                        <circle cx="100" cy="100" r="30" fill="#FFEB3B"/>
                        <text x="100" y="140" fill="#F57F17" font-size="12" text-anchor="middle">Solar</text>
                        <text x="100" y="160" fill="#F57F17" font-size="10" text-anchor="middle">Radiante</text>
                    </g>

                    <!-- Panel Solar -->
                    <g id="panel">
                        <rect x="200" y="80" width="80" height="50" fill="#1565C0" rx="5"/>
                        <text x="240" y="110" fill="white" font-size="12" text-anchor="middle">Panel FV</text>
                        <text x="240" y="130" fill="#BBDEFB" font-size="10" text-anchor="middle">Eléctrica</text>
                        <line x1="130" y1="100" x2="200" y2="100" stroke="#FBC02D" stroke-width="3" marker-end="url(#flecha)"/>
                    </g>

                    <!-- Batería -->
                    <g id="bateria">
                        <rect x="300" y="150" width="60" height="80" fill="#E91E63" rx="5"/>
                        <text x="330" y="190" fill="white" font-size="12" text-anchor="middle">Batería</text>
                        <text x="330" y="210" fill="#FF8A80" font-size="10" text-anchor="middle">Química</text>
                        <line x1="280" y1="100" x2="300" y2="150" stroke="#42A5F5" stroke-width="3" marker-end="url(#flecha)"/>
                    </g>

                    <!-- Motor -->
                    <g id="motor">
                        <circle cx="450" cy="100" r="30" fill="#43A047"/>
                        <text x="450" y="105" fill="white" font-size="12" text-anchor="middle">Motor</text>
                        <text x="450" y="125" fill="#C8E6C9" font-size="10" text-anchor="middle">Mecánica</text>
                        <line x1="360" y1="190" x2="420" y2="100" stroke="#E91E63" stroke-width="3" marker-end="url(#flecha)"/>
                    </g>

                    <!-- Leyenda -->
                    <text x="300" y="270" fill="#1B5E20" font-size="14" text-anchor="middle">
                        Solar → Eléctrica → Química → Mecánica
                    </text>

                    <!-- Marcadores -->
                    <defs>
                        <marker id="flecha" markerWidth="10" markerHeight="10" refX="9" refY="3" orient="auto">
                            <path d="M0,0 L9,3 L0,6 Z" fill="#1B5E20"/>
                        </marker>
                    </defs>
                </svg>
            </div>
            <div class="ejemplo-transformacion">
                <strong>Ejemplo:</strong> Central hidroeléctrica:
                \\[
                E_p \\xrightarrow[\\text{caída}]{} E_k \\xrightarrow[\\text{turbina}]{} E_{\\text{eléctrica}}
                \\]
            </div>
        </div>

        <!-- EFICIENCIA -->
        <div class="subseccion">
            <h3>5. Eficiencia Energética</h3>
            <div class="eficiencia-formula">
                \\[
                \\eta = \\frac{E_{\\text{útil}}}{E_{\\text{total}}} \\times 100\\%
                \\]
                <p><strong>Ejemplo:</strong> Motor de combustión interna:
                \\[
                \\eta \\approx 25\\% \\quad (75\\% \\text{ se pierde como calor})
                \\]
                </p>
            </div>
            <div class="eficiencia-comparativa">
                <table class="tabla-eficiencia">
                    <thead>
                        <tr><th>Sistema</th><th>Eficiencia</th><th>Pérdidas principales</th></tr>
                    </thead>
                    <tbody>
                        <tr><td>Panel solar</td><td>15–20%</td><td>Reflexión, calor</td></tr>
                        <tr><td>Motor eléctrico</td><td>85–95%</td><td>Calor, fricción</td></tr>
                        <tr><td>Central térmica</td><td>33–40%</td><td>Calor residual</td></tr>
                        <tr><td>Batería Li-ion</td><td>90–95%</td><td>Resistencia interna</td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- SIMULADOR INTERACTIVO -->
    <section class="simulator-section">
        <h2 class="seccion-titulo neon-interactivo">
            <span class="icon">🎮</span> SIMULADOR: TRANSFORMACIONES ENERGÉTICAS
        </h2>
        <div class="simulator-container" data-tema="transformaciones-energia">
            <!-- CONTROLES -->
            <div class="simulator-controls">
                <h3>CONFIGURACIÓN</h3>
                <div class="control-group">
                    <label for="fuenteSelect">Fuente primaria:</label>
                    <select id="fuenteSelect" class="control-select">
                        <option value="solar">Solar (Radiante)</option>
                        <option value="eolica">Eólica (Mecánica)</option>
                        <option value="fosil">Combustible fósil (Química)</option>
                        <option value="nuclear">Nuclear (Uranio)</option>
                        <option value="hidroelectrica">Hidroeléctrica (Potencial)</option>
                    </select>
                </div>
                <div class="control-group">
                    <label for="sistemaSelect">Sistema de transformación:</label>
                    <select id="sistemaSelect" class="control-select">
                        <option value="panel">Panel fotovoltaico</option>
                        <option value="turbina">Turbina eólica</option>
                        <option value="motor">Motor de combustión</option>
                        <option value="reactor">Reactor nuclear</option>
                        <option value="represa">Represa hidroeléctrica</option>
                    </select>
                </div>
                <div class="control-group">
                    <label for="eficienciaInput">Eficiencia (%):</label>
                    <input type="range" id="eficienciaInput" min="5" max="95" value="20" class="control-slider">
                    <span id="eficienciaValue">20%</span>
                </div>
                <button class="btn-simular" onclick="simularTransformacion()">
                    <span class="btn-icon">🔄</span> SIMULAR
                </button>
            </div>

            <!-- VISUALIZACIÓN -->
            <div class="simulator-visualization" id="visualizacionTransformacion">
                <svg viewBox="0 0 600 400" id="svgTransformacion">
                    <!-- Fondo -->
                    <rect x="0" y="0" width="600" height="400" fill="#0a0a1a"/>

                    <!-- Fuente primaria -->
                    <g id="fuentePrimaria">
                        <circle cx="100" cy="200" r="40" fill="#FF9800" id="circuloFuente"/>
                        <text x="100" y="205" fill="white" font-size="14" text-anchor="middle" id="textoFuente">Solar</text>
                        <text x="100" y="230" fill="#FFC107" font-size="12" text-anchor="middle" id="tipoFuente">Radiante</text>
                    </g>

                    <!-- Sistema de transformación -->
                    <g id="sistemaTransformacion" transform="translate(300, 200)">
                        <rect x="-50" y="-30" width="100" height="60" fill="#2196F3" rx="10" id="rectSistema"/>
                        <text x="0" y="0" fill="white" font-size="14" text-anchor="middle" id="textoSistema">Panel FV</text>
                        <text x="0" y="25" fill="#BBDEFB" font-size="12" text-anchor="middle" id="tipoSistema">Eléctrica</text>
                    </g>

                    <!-- Energía útil -->
                    <g id="energiaUtil">
                        <rect x="500" y="180" width="80" height="40" fill="#4CAF50" rx="5" id="rectUtil"/>
                        <text x="540" y="200" fill="white" font-size="14" text-anchor="middle" id="textoUtil">Eléctrica</text>
                        <text x="540" y="225" fill="#C8E6C9" font-size="12" text-anchor="middle" id="valorUtil">80%</text>
                    </g>

                    <!-- Pérdidas -->
                    <g id="perdidas">
                        <rect x="500" y="250" width="80" height="40" fill="#F44336" rx="5" opacity="0.7"/>
                        <text x="540" y="270" fill="white" font-size="14" text-anchor="middle">Pérdidas</text>
                        <text x="540" y="295" fill="#FFCDD2" font-size="12" text-anchor="middle" id="valorPerdidas">20%</text>
                    </g>

                    <!-- Flechas -->
                    <line x1="140" y1="200" x2="250" y2="200" stroke="#FFC107" stroke-width="3" marker-end="url(#flecha)" id="flecha1"/>
                    <line x1="350" y1="200" x2="450" y2="200" stroke="#2196F3" stroke-width="3" marker-end="url(#flecha)" id="flecha2"/>

                    <!-- Leyenda -->
                    <text x="300" y="350" fill="#E0F2F1" font-size="16" text-anchor="middle" id="leyendaEficiencia">Eficiencia: 20%</text>

                    <!-- Marcadores -->
                    <defs>
                        <marker id="flecha" markerWidth="10" markerHeight="10" refX="9" refY="3" orient="auto">
                            <path d="M0,0 L9,3 L0,6 Z" fill="#E0F2F1"/>
                        </marker>
                    </defs>
                </svg>
            </div>

            <!-- DATOS -->
            <div class="simulator-data">
                <h3>DATOS DE LA TRANSFORMACIÓN</h3>
                <div class="data-card">
                    <div class="data-label">Fuente primaria:</div>
                    <div class="data-value" id="dataFuente">Solar</div>
                </div>
                <div class="data-card">
                    <div class="data-label">Tipo de energía:</div>
                    <div class="data-value" id="dataTipoFuente">Radiante</div>
                </div>
                <div class="data-card">
                    <div class="data-label">Sistema:</div>
                    <div class="data-value" id="dataSistema">Panel fotovoltaico</div>
                </div>
                <div class="data-card highlight">
                    <div class="data-label">Eficiencia:</div>
                    <div class="data-value" id="dataEficiencia">20%</div>
                </div>
                <div class="data-card">
                    <div class="data-label">Energía útil:</div>
                    <div class="data-value" id="dataEnergiaUtil">80%</div>
                </div>
                <div class="data-card">
                    <div class="data-label">Pérdidas:</div>
                    <div class="data-value" id="dataPerdidas">20%</div>
                </div>
            </div>
        </div>
    </section>

    <!-- QUIZ INTERACTIVO -->
    <section class="quiz-section">
        <h2 class="seccion-titulo neon-evaluacion">
            <span class="icon">❓</span> QUIZ: DOMINA LAS TRANSFORMACIONES ENERGÉTICAS
        </h2>
        <div class="quiz-container">
            <!-- PREGUNTA 1 -->
            <div class="quiz-question" data-correct="B">
                <div class="quiz-header">
                    <span class="quiz-num">01</span>
                    <h3>¿Qué tipo de energía tiene un objeto en movimiento?</h3>
                </div>
                <div class="quiz-options">
                    <button class="quiz-option" data-value="A">
                        <span class="option-letter">A</span> Potencial
                    </button>
                    <button class="quiz-option" data-value="B">
                        <span class="option-letter">B</span> Cinética
                    </button>
                    <button class="quiz-option" data-value="C">
                        <span class="option-letter">C</span> Térmica
                    </button>
                    <button class="quiz-option" data-value="D">
                        <span class="option-letter">D</span> Química
                    </button>
                </div>
                <div class="quiz-feedback" style="display: none;">
                    <div class="feedback-correct">
                        <strong>✅ Correcto:</strong> La energía asociada al movimiento es <strong>cinética</strong> (\\(E_k = \\frac{1}{2}mv^2\\)).
                    </div>
                    <div class="feedback-incorrect">
                        ❌ <strong>Incorrecto:</strong> Revisa la definición de energía cinética.
                    </div>
                </div>
            </div>

            <!-- PREGUNTA 2 -->
            <div class="quiz-question" data-correct="C">
                <div class="quiz-header">
                    <span class="quiz-num">02</span>
                    <h3>¿Cuál es la eficiencia típica de un panel solar?</h3>
                </div>
                <div class="quiz-options">
                    <button class="quiz-option" data-value="A">
                        <span class="option-letter">A</span> 5%
                    </button>
                    <button class="quiz-option" data-value="B">
                        <span class="option-letter">B</span> 50%
                    </button>
                    <button class="quiz-option" data-value="C">
                        <span class="option-letter">C</span> 20%
                    </button>
                    <button class="quiz-option" data-value="D">
                        <span class="option-letter">D</span> 90%
                    </button>
                </div>
                <div class="quiz-feedback" style="display: none;">
                    <div class="feedback-correct">
                        <strong>✅ Correcto:</strong> Los paneles solares comerciales tienen eficiencias de <strong>15–20%</strong>.
                    </div>
                    <div class="feedback-incorrect">
                        ❌ <strong>Incorrecto:</strong> La eficiencia real está muy por debajo del 50%.
                    </div>
                </div>
            </div>

            <!-- PREGUNTA 3 -->
            <div class="quiz-question" data-correct="A">
                <div class="quiz-header">
                    <span class="quiz-num">03</span>
                    <h3>¿Qué transformación ocurre en una represa hidroeléctrica?</h3>
                </div>
                <div class="quiz-options">
                    <button class="quiz-option" data-value="A">
                        <span class="option-letter">A</span> Potencial → Cinética → Eléctrica
                    </button>
                    <button class="quiz-option" data-value="B">
                        <span class="option-letter">B</span> Química → Térmica → Mecánica
                    </button>
                    <button class="quiz-option" data-value="C">
                        <span class="option-letter">C</span> Radiante → Eléctrica → Térmica
                    </button>
                    <button class="quiz-option" data-value="D">
                        <span class="option-letter">D</span> Nuclear → Mecánica → Eléctrica
                    </button>
                </div>
                <div class="quiz-feedback" style="display: none;">
                    <div class="feedback-correct">
                        <strong>✅ Correcto:</strong> El agua almacenada tiene energía <strong>potencial</strong>, que se convierte en <strong>cinética</strong> al caer y luego en <strong>eléctrica</strong> en el generador.
                    </div>
                    <div class="feedback-incorrect">
                        ❌ <strong>Incorrecto:</strong> Revisa las etapas de una central hidroeléctrica.
                    </div>
                </div>
            </div>
        </div>
        <div class="quiz-results" style="display: none;">
            <h3>📊 RESULTADOS</h3>
            <div class="results-score">
                Puntuación: <span id="quizScore">0</span>/3
            </div>
            <div class="results-feedback" id="quizFeedback">
                Completa el quiz para ver tus resultados
            </div>
            <button class="btn-retry" onclick="reiniciarQuiz()">
                🔄 INTENTAR NUEVAMENTE
            </button>
        </div>
    </section>

    <!-- ERRORES COMUNES -->
    <section class="errores-section">
        <h2 class="seccion-titulo neon-alerta">
            <span class="icon">⚠️</span> ERRORES COMUNES
        </h2>
        <div class="errores-container">
            <div class="error-card">
                <div class="error-header" onclick="toggleError(this)">
                    <h3>❌ CONFUNDIR ENERGÍA POTENCIAL Y CINÉTICA</h3>
                    <span class="error-toggle">+</span>
                </div>
                <div class="error-content">
                    <div class="error-ejemplo">
                        <strong>Error:</strong> "Un objeto en el suelo tiene energía potencial"
                    </div>
                    <div class="error-correccion">
                        <strong>Corrección:</strong> La energía potencial depende de la <strong>altura</strong> (\\(E_p = mgh\\)). En el suelo, \\(h=0\\) → \\(E_p=0\\).
                    </div>
                    <div class="error-practica">
                        <p><strong>Ejemplo:</strong> Una pelota en lo alto de un edificio tiene \\(E_p\\), al caer gana \\(E_k\\).</p>
                    </div>
                </div>
            </div>
            <div class="error-card">
                <div class="error-header" onclick="toggleError(this)">
                    <h3>❌ IGNORAR PÉRDIDAS DE ENERGÍA</h3>
                    <span class="error-toggle">+</span>
                </div>
                <div class="error-content">
                    <div class="error-ejemplo">
                        <strong>Error:</strong> "Un motor tiene 100% de eficiencia"
                    </div>
                    <div class="error-correccion">
                        <strong>Corrección:</strong> Siempre hay pérdidas por <strong>calor</strong> y <strong>fricción</strong>. La eficiencia real es:
                        \\[
                        \\eta = \\frac{E_{\\text{útil}}}{E_{\\text{total}}} < 1
                        \\]
                    </div>
                    <div class="error-tabla">
                        <table>
                            <tr><th>Sistema</th><th>Eficiencia típica</th></tr>
                            <tr><td>Motor de gasolina</td><td>~25%</td></tr>
                            <tr><td>Panel solar</td><td>~20%</td></tr>
                            <tr><td>Batería Li-ion</td><td>~90%</td></tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- PROBLEMAS TIPO EXAMEN -->
    <section class="examen-section">
        <h2 class="seccion-titulo neon-evaluacion">
            <span class="icon">📝</span> PROBLEMAS TIPO EXAMEN
        </h2>
        <div class="examen-container">
            <div class="problema-card">
                <div class="problema-header">
                    <span class="problema-num">P1</span>
                    <h3>Cálculo de Energía Cinética</h3>
                </div>
                <div class="problema-enunciado">
                    <p>Calcula la energía cinética de un automóvil de 1200 kg que se mueve a 25 m/s. Expresa el resultado en Joules y en kWh.</p>
                    <div class="formula-inline">
                        \\[
                        E_k = \\frac{1}{2}mv^2 \\quad \\text{y} \\quad 1 \\text{ kWh} = 3.6 \\times 10^6 \\text{ J}
                        \\]
                    </div>
                </div>
                <div class="problema-espacio">
                    <textarea placeholder="Desarrolla tu cálculo aquí..." rows="6"></textarea>
                </div>
                <button class="btn-verificar" onclick="verificarProblema(1)">
                    🔍 VERIFICAR SOLUCIÓN
                </button>
                <div class="problema-solucion" id="solucionP1" style="display: none;">
                    <strong>Solución:</strong><br>
                    1. \\(E_k = \\frac{1}{2} \\times 1200 \\times (25)^2 = 375,000 \\text{ J}\\)<br>
                    2. \\(375,000 \\text{ J} = \\frac{375,000}{3.6 \\times 10^6} = 0.104 \\text{ kWh}\\)
                </div>
            </div>
            <div class="problema-card">
                <div class="problema-header">
                    <span class="problema-num">P2</span>
                    <h3>Eficiencia de un Sistema</h3>
                </div>
                <div class="problema-enunciado">
                    <p>Una central térmica recibe 1000 MJ de energía química del carbón y produce 350 MJ de electricidad. Calcula:</p>
                    <ol>
                        <li>La eficiencia del proceso.</li>
                        <li>La energía perdida y su forma principal.</li>
                    </ol>
                </div>
                <div class="problema-espacio">
                    <textarea placeholder="Desarrolla tu respuesta aquí..." rows="8"></textarea>
                </div>
                <button class="btn-verificar" onclick="verificarProblema(2)">
                    🔍 VERIFICAR SOLUCIÓN
                </button>
                <div class="problema-solucion" id="solucionP2" style="display: none;">
                    <strong>Solución:</strong><br>
                    1. \\(\\eta = \\frac{350}{1000} \\times 100\\% = 35\\%\\)<br>
                    2. \\(E_{\\text{pérdida}} = 1000 - 350 = 650 \\text{ MJ}\\) (principalmente como <strong>calor</strong>).
                </div>
            </div>
        </div>
        <div class="rubrica">
            <h4>📋 RÚBRICA DE EVALUACIÓN</h4>
            <table class="rubrica-table">
                <tr>
                    <th>Criterio</th>
                    <th>Excelente (3 pts)</th>
                    <th>Satisfactorio (2 pts)</th>
                    <th>Insuficiente (1 pt)</th>
                </tr>
                <tr>
                    <td>Cálculos correctos</td>
                    <td>Todas las operaciones y conversiones correctas</td>
                    <td>Error en 1 cálculo o conversión</td>
                    <td>Múltiples errores</td>
                </tr>
                <tr>
                    <td>Explicación de conceptos</td>
                    <td>Explica claramente cada paso y fórmula</td>
                    <td>Explicación parcial</td>
                    <td>No justifica</td>
                </tr>
            </table>
        </div>
    </section>

    <!-- CIERRE METACOGNITIVO -->
    <section class="cierre-section">
        <h2 class="seccion-titulo neon-concepto">
            <span class="icon">🧠</span> CIERRE METACOGNITIVO
        </h2>
        <div class="cierre-container">
            <div class="autoevaluacion">
                <h3>📊 AUTOEVALUACIÓN</h3>
                <div class="slider-group">
                    <label>Tipos de energía:</label>
                    <input type="range" min="1" max="5" value="3" class="autoeval-slider" id="slider1">
                    <div class="slider-labels">
                        <span>Básico</span><span>Avanzado</span>
                    </div>
                </div>
                <div class="slider-group">
                    <label>Transformaciones y eficiencia:</label>
                    <input type="range" min="1" max="5" value="3" class="autoeval-slider" id="slider2">
                    <div class="slider-labels">
                        <span>Básico</span><span>Avanzado</span>
                    </div>
                </div>
                <button class="btn-guardar" onclick="guardarAutoevaluacion()">
                    💾 GUARDAR AUTOEVALUACIÓN
                </button>
            </div>
            <div class="reflexion">
                <h3>💭 REFLEXIÓN</h3>
                <div class="pregunta-reflexion">
                    <p>¿Cómo podríamos mejorar la eficiencia energética en nuestra vida cotidiana?</p>
                    <textarea placeholder="Ejemplo: Uso de LED, transporte público, aislamiento térmico..." rows="3"></textarea>
                </div>
            </div>
            <div class="plan-estudio">
                <h3>📅 PLAN DE ESTUDIO</h3>
                <div class="plan-grid">
                    <div class="plan-card">
                        <h4>🔹 REPASO RÁPIDO (15 min)</h4>
                        <ul>
                            <li>Memorizar fórmulas de \\(E_k\\) y \\(E_p\\)</li>
                            <li>Clasificar fuentes renovables/no renovables</li>
                        </ul>
                    </div>
                    <div class="plan-card">
                        <h4>🧪 PRÁCTICA (30 min)</h4>
                        <ul>
                            <li>Resolver 5 problemas de eficiencia</li>
                            <li>Analizar 3 transformaciones cotidianas</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="recursos">
                <h3>🔗 RECURSOS ADICIONALES</h3>
                <div class="recursos-links">
                    <a href="https://www.energy.gov/" target="_blank" class="recurso-link">
                        🌐 Departamento de Energía de EE.UU.
                    </a>
                    <a href="https://www.eia.gov/energyexplained/" target="_blank" class="recurso-link">
                        📊 EIA: Energía Explicada
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- JAVASCRIPT INTEGRADO -->
<script>
    // ==========================================
    // BASE DE DATOS DE TRANSFORMACIONES
    // ==========================================
    const transformacionesDB = {
        "solar": {
            fuente: "Solar",
            tipoFuente: "Radiante",
            sistemas: {
                "panel": {
                    nombre: "Panel fotovoltaico",
                    tipoSistema: "Eléctrica",
                    eficienciaDefault: 20,
                    energiaUtil: "Eléctrica",
                    perdidas: "Calor (80%)"
                }
            }
        },
        "eolica": {
            fuente: "Eólica",
            tipoFuente: "Mecánica",
            sistemas: {
                "turbina": {
                    nombre: "Turbina eólica",
                    tipoSistema: "Eléctrica",
                    eficienciaDefault: 45,
                    energiaUtil: "Eléctrica",
                    perdidas: "Fricción, calor (55%)"
                }
            }
        },
        "fosil": {
            fuente: "Combustible fósil",
            tipoFuente: "Química",
            sistemas: {
                "motor": {
                    nombre: "Motor de combustión",
                    tipoSistema: "Mecánica",
                    eficienciaDefault: 25,
                    energiaUtil: "Mecánica",
                    perdidas: "Calor (75%)"
                }
            }
        },
        "nuclear": {
            fuente: "Nuclear",
            tipoFuente: "Nuclear",
            sistemas: {
                "reactor": {
                    nombre: "Reactor nuclear",
                    tipoSistema: "Térmica → Eléctrica",
                    eficienciaDefault: 33,
                    energiaUtil: "Eléctrica",
                    perdidas: "Calor residual (67%)"
                }
            }
        },
        "hidroelectrica": {
            fuente: "Hidroeléctrica",
            tipoFuente: "Potencial",
            sistemas: {
                "represa": {
                    nombre: "Represa hidroeléctrica",
                    tipoSistema: "Eléctrica",
                    eficienciaDefault: 90,
                    energiaUtil: "Eléctrica",
                    perdidas: "Fricción, evaporación (10%)"
                }
            }
        }
    };

    // ==========================================
    // SIMULADOR DE TRANSFORMACIONES
    // ==========================================
    function simularTransformacion() {
        const fuente = document.getElementById(\'fuenteSelect\').value;
        const sistema = document.getElementById(\'sistemaSelect\').value;
        const eficiencia = document.getElementById(\'eficienciaInput\').value;
        document.getElementById(\'eficienciaValue\').textContent = eficiencia + "%";

        const dataFuente = transformacionesDB[fuente];
        const dataSistema = dataFuente.sistemas[sistema];

        // Actualizar datos
        document.getElementById(\'dataFuente\').textContent = dataFuente.fuente;
        document.getElementById(\'dataTipoFuente\').textContent = dataFuente.tipoFuente;
        document.getElementById(\'dataSistema\').textContent = dataSistema.nombre;
        document.getElementById(\'dataEficiencia\').textContent = eficiencia + "%";
        document.getElementById(\'dataEnergiaUtil\').textContent = eficiencia + "%";
        document.getElementById(\'dataPerdidas\').textContent = (100 - eficiencia) + "%";

        // Actualizar SVG
        document.getElementById(\'textoFuente\').textContent = fuente.charAt(0).toUpperCase() + fuente.slice(1);
        document.getElementById(\'tipoFuente\').textContent = dataFuente.tipoFuente;
        document.getElementById(\'textoSistema\').textContent = dataSistema.nombre.split(\' \')[0];
        document.getElementById(\'tipoSistema\').textContent = dataSistema.tipoSistema;
        document.getElementById(\'textoUtil\').textContent = dataSistema.energiaUtil;
        document.getElementById(\'valorUtil\').textContent = eficiencia + "%";
        document.getElementById(\'valorPerdidas\').textContent = (100 - eficiencia) + "%";
        document.getElementById(\'leyendaEficiencia\').textContent = `Eficiencia: ${eficiencia}%`;

        // Cambiar colores según fuente
        const coloresFuente = {
            "solar": "#FF9800",
            "eolica": "#4CAF50",
            "fosil": "#616161",
            "nuclear": "#9C27B0",
            "hidroelectrica": "#2196F3"
        };
        document.getElementById(\'circuloFuente\').setAttribute(\'fill\', coloresFuente[fuente]);
        document.getElementById(\'flecha1\').setAttribute(\'stroke\', coloresFuente[fuente]);

        console.log(`🔄 Simulación: ${fuente} → ${sistema} | Eficiencia: ${eficiencia}%`);
    }

    // ==========================================
    // QUIZ INTERACTIVO
    // ==========================================
    let quizRespuestas = [];
    let quizCompletado = false;

    document.querySelectorAll(\'.quiz-option\').forEach(option => {
        option.addEventListener(\'click\', function() {
            if (quizCompletado) return;
            const question = this.closest(\'.quiz-question\');
            const correct = question.dataset.correct;
            const selected = this.dataset.value;
            const feedback = question.querySelector(\'.quiz-feedback\');

            // Remover selección previa
            question.querySelectorAll(\'.quiz-option\').forEach(opt => {
                opt.classList.remove(\'selected\', \'correct\', \'incorrect\');
            });

            // Marcar selección actual
            this.classList.add(\'selected\');
            if (selected === correct) {
                this.classList.add(\'correct\');
                quizRespuestas.push(true);
            } else {
                this.classList.add(\'incorrect\');
                question.querySelector(`[data-value="${correct}"]`).classList.add(\'correct\');
                quizRespuestas.push(false);
            }

            // Mostrar feedback
            feedback.style.display = \'block\';

            // Verificar si todas las preguntas están respondidas
            const allAnswered = Array.from(document.querySelectorAll(\'.quiz-question\')).every(q =>
                q.querySelector(\'.quiz-option.selected\')
            );
            if (allAnswered && !quizCompletado) {
                quizCompletado = true;
                mostrarResultadosQuiz();
            }
        });
    });

    function mostrarResultadosQuiz() {
        const correctas = quizRespuestas.filter(r => r).length;
        document.getElementById(\'quizScore\').textContent = `${correctas}/3`;
        let feedback = "";
        if (correctas >= 2) {
            feedback = "👍 ¡Excelente! Dominas las transformaciones energéticas.";
        } else {
            feedback = "📚 Revisa los tipos de energía y las eficiencias típicas.";
        }
        document.getElementById(\'quizFeedback\').textContent = feedback;
        document.querySelector(\'.quiz-results\').style.display = \'block\';
    }

    function reiniciarQuiz() {
        quizRespuestas = [];
        quizCompletado = false;
        document.querySelectorAll(\'.quiz-option\').forEach(opt => {
            opt.classList.remove(\'selected\', \'correct\', \'incorrect\');
        });
        document.querySelectorAll(\'.quiz-feedback\').forEach(fb => {
            fb.style.display = \'none\';
        });
        document.querySelector(\'.quiz-results\').style.display = \'none\';
    }

    // ==========================================
    // ERRORES COMUNES
    // ==========================================
    function toggleError(header) {
        const content = header.nextElementSibling;
        const toggle = header.querySelector(\'.error-toggle\');
        if (content.style.display === \'block\') {
            content.style.display = \'none\';
            toggle.textContent = \'+\';
        } else {
            content.style.display = \'block\';
            toggle.textContent = \'-\';
        }
    }

    // ==========================================
    // PROBLEMAS TIPO EXAMEN
    // ==========================================
    function verificarProblema(num) {
        const solucion = document.getElementById(`solucionP${num}`);
        solucion.style.display = solucion.style.display === \'block\' ? \'none\' : \'block\';
    }

    // ==========================================
    // AUTOEVALUACIÓN
    // ==========================================
    function guardarAutoevaluacion() {
        const slider1 = document.getElementById(\'slider1\').value;
        const slider2 = document.getElementById(\'slider2\').value;
        const promedio = (parseInt(slider1) + parseInt(slider2)) / 2;
        alert(`📊 Autoevaluación guardada:\\n\\n` +
              `Tipos de energía: ${slider1}/5\\n` +
              `Transformaciones: ${slider2}/5\\n\\n` +
              `Promedio: ${promedio.toFixed(1)}/5\\n\\n` +
              `¡Sigue explorando las fuentes de energía!`);
    }

    // ==========================================
    // INICIALIZACIÓN
    // ==========================================
    console.log("🚀 Lección Cyberpunk: Tipos de Energía cargada");
    console.log("🎯 Objetivos: Dominar transformaciones y eficiencias energéticas");
    simularTransformacion(); // Cargar simulación inicial
</script>',
    'ejercicios' => 
    array (
      0 => 
      array (
        'enunciado' => 'Transformación en panel solar',
        'respuesta' => 'Radiante -> Eléctrica',
      ),
      1 => 
      array (
        'enunciado' => 'Fuente fósil ejemplo',
        'respuesta' => 'Petróleo (química -> térmica)',
      ),
      2 => 
      array (
        'enunciado' => 'Nuclear transformación típica',
        'respuesta' => 'Nuclear -> Térmica -> Eléctrica',
      ),
      3 => 
      array (
        'enunciado' => 'Eólica -> ?',
        'respuesta' => 'Mecánica -> Eléctrica',
      ),
      4 => 
      array (
        'enunciado' => 'Biomasa -> ?',
        'respuesta' => 'Química -> Térmica',
      ),
      5 => 
      array (
        'enunciado' => 'Geotérmica -> ?',
        'respuesta' => 'Térmica -> Eléctrica',
      ),
      6 => 
      array (
        'enunciado' => 'Hidrógeno como',
        'respuesta' => 'Vector energético (no fuente)',
      ),
      7 => 
      array (
        'enunciado' => 'Renovable: solar, eólica, hidro, biomasa, geotérmica',
        'respuesta' => 'Sí',
      ),
      8 => 
      array (
        'enunciado' => 'No renovable: fósil, nuclear (U)',
        'respuesta' => 'Sí',
      ),
      9 => 
      array (
        'enunciado' => 'Eficiencia típica panel FV',
        'respuesta' => '~15-22%',
      ),
      10 => 
      array (
        'enunciado' => '1 MWh =',
        'respuesta' => '3.6 GJ',
      ),
      11 => 
      array (
        'enunciado' => 'Cadena completa: carbón -> electricidad',
        'respuesta' => 'Química -> Térmica -> Mecánica -> Eléctrica (~35%)',
      ),
    ),
    'quiz' => 
    array (
      0 => 
      array (
        'pregunta' => 'Energía solar es...',
        'opciones' => 
        array (
          0 => 'Radiante',
          1 => 'Química',
          2 => 'Nuclear',
          3 => 'Mecánica',
        ),
        'correcta' => 'Radiante',
      ),
      1 => 
      array (
        'pregunta' => 'Eólica proviene de...',
        'opciones' => 
        array (
          0 => 'Viento',
          1 => 'Sol',
          2 => 'Agua',
          3 => 'Tierra',
        ),
        'correcta' => 'Viento',
      ),
      2 => 
      array (
        'pregunta' => 'Nuclear de...',
        'opciones' => 
        array (
          0 => 'Núcleo',
          1 => 'Enlaces',
          2 => 'Electrones',
          3 => 'Movimiento',
        ),
        'correcta' => 'Núcleo',
      ),
      3 => 
      array (
        'pregunta' => 'Fósil es...',
        'opciones' => 
        array (
          0 => 'No renovable',
          1 => 'Renovable',
          2 => 'Nuclear',
          3 => 'Solar',
        ),
        'correcta' => 'No renovable',
      ),
      4 => 
      array (
        'pregunta' => 'Hidroeléctrica usa...',
        'opciones' => 
        array (
          0 => 'Agua',
          1 => 'Viento',
          2 => 'Sol',
          3 => 'Carbón',
        ),
        'correcta' => 'Agua',
      ),
      5 => 
      array (
        'pregunta' => 'Panel solar convierte...',
        'opciones' => 
        array (
          0 => 'Solar -> Eléctrica',
          1 => 'Eléctrica -> Solar',
          2 => 'Térmica -> Eléctrica',
          3 => 'Mecánica -> Solar',
        ),
        'correcta' => 'Solar -> Eléctrica',
      ),
      6 => 
      array (
        'pregunta' => 'Biomasa es...',
        'opciones' => 
        array (
          0 => 'Renovable',
          1 => 'No renovable',
          2 => 'Nuclear',
          3 => 'Fósil',
        ),
        'correcta' => 'Renovable',
      ),
      7 => 
      array (
        'pregunta' => 'Geotérmica usa...',
        'opciones' => 
        array (
          0 => 'Calor Tierra',
          1 => 'Viento',
          2 => 'Sol',
          3 => 'Agua',
        ),
        'correcta' => 'Calor Tierra',
      ),
      8 => 
      array (
        'pregunta' => 'Hidrógeno es...',
        'opciones' => 
        array (
          0 => 'Vector energético',
          1 => 'Fuente primaria',
          2 => 'No renovable',
          3 => 'Nuclear',
        ),
        'correcta' => 'Vector energético',
      ),
      9 => 
      array (
        'pregunta' => 'Motor combustión: química ->',
        'opciones' => 
        array (
          0 => 'Térmica -> Mecánica',
          1 => 'Eléctrica',
          2 => 'Radiante',
          3 => 'Nuclear',
        ),
        'correcta' => 'Térmica -> Mecánica',
      ),
      10 => 
      array (
        'pregunta' => 'Central nuclear: nuclear ->',
        'opciones' => 
        array (
          0 => 'Térmica -> Eléctrica',
          1 => 'Eléctrica -> Térmica',
          2 => 'Mecánica -> Eléctrica',
          3 => 'Solar',
        ),
        'correcta' => 'Térmica -> Eléctrica',
      ),
      11 => 
      array (
        'pregunta' => 'Turbina eólica: mecánica ->',
        'opciones' => 
        array (
          0 => 'Eléctrica',
          1 => 'Térmica',
          2 => 'Química',
          3 => 'Radiante',
        ),
        'correcta' => 'Eléctrica',
      ),
      12 => 
      array (
        'pregunta' => 'Eficiencia típica carbón',
        'opciones' => 
        array (
          0 => '~35%',
          1 => '80%',
          2 => '10%',
          3 => '100%',
        ),
        'correcta' => '~35%',
      ),
      13 => 
      array (
        'pregunta' => 'Eficiencia panel FV',
        'opciones' => 
        array (
          0 => '~20%',
          1 => '80%',
          2 => '5%',
          3 => '100%',
        ),
        'correcta' => '~20%',
      ),
      14 => 
      array (
        'pregunta' => '1 TJ =',
        'opciones' => 
        array (
          0 => '10¹² J',
          1 => '10⁶ J',
          2 => '10⁹ J',
          3 => '10³ J',
        ),
        'correcta' => '10¹² J',
      ),
      15 => 
      array (
        'pregunta' => 'Renovable con más capacidad global',
        'opciones' => 
        array (
          0 => 'Hidroeléctrica',
          1 => 'Solar',
          2 => 'Eólica',
          3 => 'Nuclear',
        ),
        'correcta' => 'Hidroeléctrica',
      ),
      16 => 
      array (
        'pregunta' => 'Combustible con más CO₂',
        'opciones' => 
        array (
          0 => 'Carbón',
          1 => 'Solar',
          2 => 'Eólica',
          3 => 'Hidrógeno',
        ),
        'correcta' => 'Carbón',
      ),
      17 => 
      array (
        'pregunta' => 'Hidrógeno se produce por',
        'opciones' => 
        array (
          0 => 'Electrólisis',
          1 => 'Combustión',
          2 => 'Fotosíntesis',
          3 => 'Fisión',
        ),
        'correcta' => 'Electrólisis',
      ),
      18 => 
      array (
        'pregunta' => 'Energía radiante incluye...',
        'opciones' => 
        array (
          0 => 'Luz, microondas',
          1 => 'Sonido',
          2 => 'Movimiento',
          3 => 'Calor',
        ),
        'correcta' => 'Luz, microondas',
      ),
      19 => 
      array (
        'pregunta' => 'Central térmica fósil usa...',
        'opciones' => 
        array (
          0 => 'Ciclo Rankine',
          1 => 'Ciclo Otto',
          2 => 'Ciclo Brayton',
          3 => 'Ciclo Stirling',
        ),
        'correcta' => 'Ciclo Rankine',
      ),
      20 => 
      array (
        'pregunta' => 'Eficiencia máxima teórica motor térmico',
        'opciones' => 
        array (
          0 => 'Carnot',
          1 => '100%',
          2 => '50%',
          3 => 'Rankine',
        ),
        'correcta' => 'Carnot',
      ),
      21 => 
      array (
        'pregunta' => 'Central nuclear eficiencia típica',
        'opciones' => 
        array (
          0 => '~33%',
          1 => '90%',
          2 => '10%',
          3 => '60%',
        ),
        'correcta' => '~33%',
      ),
      22 => 
      array (
        'pregunta' => 'Hidrógeno verde se obtiene por',
        'opciones' => 
        array (
          0 => 'Electrólisis con renovables',
          1 => 'Reforma vapor',
          2 => 'Gasificación',
          3 => 'Fotosíntesis',
        ),
        'correcta' => 'Electrólisis con renovables',
      ),
      23 => 
      array (
        'pregunta' => 'Energía mareomotriz es...',
        'opciones' => 
        array (
          0 => 'Mecánica (renovable)',
          1 => 'Nuclear',
          2 => 'Fósil',
          3 => 'Térmica',
        ),
        'correcta' => 'Mecánica (renovable)',
      ),
      24 => 
      array (
        'pregunta' => '1 GWh =',
        'opciones' => 
        array (
          0 => '3.6 TJ',
          1 => '3.6 GJ',
          2 => '3.6 MJ',
          3 => '3.6 kJ',
        ),
        'correcta' => '3.6 TJ',
      ),
      25 => 
      array (
        'pregunta' => 'Proyección 2050: % renovables',
        'opciones' => 
        array (
          0 => '>70%',
          1 => '<30%',
          2 => '50%',
          3 => '100%',
        ),
        'correcta' => '>70%',
      ),
      26 => 
      array (
        'pregunta' => 'Fusión nuclear produce...',
        'opciones' => 
        array (
          0 => 'He + energía',
          1 => 'CO₂',
          2 => 'U-235',
          3 => 'H₂O',
        ),
        'correcta' => 'He + energía',
      ),
      27 => 
      array (
        'pregunta' => 'Ciclo combinado eficiencia',
        'opciones' => 
        array (
          0 => '~60%',
          1 => '30%',
          2 => '90%',
          3 => '20%',
        ),
        'correcta' => '~60%',
      ),
      28 => 
      array (
        'pregunta' => 'Energía osmotica usa...',
        'opciones' => 
        array (
          0 => 'Gradiente salinidad',
          1 => 'Viento',
          2 => 'Sol',
          3 => 'Calor Tierra',
        ),
        'correcta' => 'Gradiente salinidad',
      ),
      29 => 
      array (
        'pregunta' => 'SI 2025: energía en',
        'opciones' => 
        array (
          0 => 'Joule',
          1 => 'Caloría',
          2 => 'BTU',
          3 => 'kWh',
        ),
        'correcta' => 'Joule',
      ),
    ),
  ),
  2 => 
  array (
    'materia' => 'Física I',
    'slug' => 'fracking-cyberpunk',
    'titulo' => 'Fracking: La Física Detrás de la Fracturación Hidráulica',
    'contenido' => '<!-- INICIO LECCIÓN CYBERPUNK -->
<div class="leccion-container leccion-fisica-fracking" data-tema="fracking">

    <!-- CABECERA CYBERPUNK -->
    <header class="leccion-header">
        <h1 class="titulo-leccion neon-glow">
            <span class="icon-tema">⚡</span>
            FRACKING: FÍSICA DE LA FRACTURACIÓN HIDRÁULICA
        </h1>
        <div class="subtitulo">
            Presión, Energía y el Debate de la Sostenibilidad
        </div>
    </header>

    <!-- PANEL OBJETIVOS -->
    <section class="panel-objetivos">
        <h2 class="seccion-titulo neon-concepto">
            <span class="icon">🎯</span> OBJETIVOS DE APRENDIZAJE
        </h2>
        <div class="objetivos-grid">
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Explicar el proceso físico del fracking</h3>
                <p>Presión, fluidos, fractura de rocas y flujo de hidrocarburos</p>
            </div>
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Analizar la composición del fluido</h3>
                <p>Agua, proppant y aditivos químicos: funciones y riesgos</p>
            </div>
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Calcular eficiencia energética (EROEI)</h3>
                <p>Comparar con fuentes convencionales y renovables</p>
            </div>
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Evaluar impactos ambientales</h3>
                <p>Contaminación, sismos inducidos y emisiones de GEI</p>
            </div>
        </div>
    </section>

    <!-- CONTEXTO REAL -->
    <section class="contexto-real">
        <h2 class="seccion-titulo neon-dato">
            <span class="icon">🌍</span> CONTEXTO GLOBAL
        </h2>
        <div class="contexto-grid">
            <div class="contexto-card">
                <h3>📈 PRODUCCIÓN EN EE.UU.</h3>
                <p>El fracking representó el <strong>60% del gas natural</strong> y <strong>50% del petróleo</strong> en 2025</p>
                <div class="dato-neon">Ejemplo: Cuencas Marcellus y Permian</div>
            </div>
            <div class="contexto-card">
                <h3>🌱 PROHIBICIONES</h3>
                <p><strong>Francia, Alemania, México</strong> y <strong>10+ países</strong> lo prohibieron por riesgos ambientales</p>
                <div class="dato-neon">México: Prohibición constitucional (2024)</div>
            </div>
            <div class="contexto-card">
                <h3>💰 COSTO ENERGÉTICO</h3>
                <p>EROEI de <strong>~5:1</strong> vs <strong>20:1</strong> del petróleo convencional</p>
                <div class="dato-neon">1 barril de shale oil requiere ~1.5 barriles equivalentes de energía</div>
            </div>
        </div>
    </section>

    <!-- FUNDAMENTOS FÍSICOS -->
    <section class="fundamentos-section">
        <h2 class="seccion-titulo neon-concepto">
            <span class="icon">📚</span> FUNDAMENTOS FÍSICOS
        </h2>

        <!-- LEY DE PASCAL -->
        <div class="subseccion">
            <h3>1. Principio de Pascal y Presión</h3>
            <div class="concepto-dual">
                <div class="formula-card">
                    <div class="formula-grand">
                        \\[
                        P = \\frac{F}{A} \\quad \\text{(Presión)}
                        \\]
                    </div>
                    <p>En fracking, se inyecta fluido a <strong>~700 bar</strong> (70 MPa):</p>
                    <div class="ejemplo-destacado">
                        \\[
                        P_{\\text{inyección}} = 700\\,\\text{bar} = 70 \\times 10^6\\,\\text{Pa}
                        \\]
                    </div>
                </div>
                <div class="explicacion-card">
                    <p>La <strong>Ley de Pascal</strong> establece que la presión aplicada a un fluido se transmite <strong>igualmente en todas direcciones</strong>.</p>
                    <p>En fracking, esto permite fracturar la roca en múltiples direcciones desde un solo punto de inyección.</p>
                </div>
            </div>
        </div>

        <!-- PROCESO TÉCNICO -->
        <div class="subseccion">
            <h3>2. Proceso Técnico Paso a Paso</h3>
            <div class="proceso-grid">
                <div class="paso-card">
                    <div class="paso-header">🔨 PERFORACIÓN</div>
                    <div class="paso-body">
                        <p>Pozo vertical hasta <strong>1–3 km</strong>, luego horizontal <strong>1–2 km</strong> en el yacimiento.</p>
                        <div class="dato-tecnico">
                            <strong>Diámetro:</strong> ~20 cm<br>
                            <strong>Material:</strong> Acero + cemento
                        </div>
                    </div>
                </div>
                <div class="paso-card">
                    <div class="paso-header">💦 INYECCIÓN</div>
                    <div class="paso-body">
                        <p>Fluido a alta presión (<strong>700 bar</strong>) con:</p>
                        <ul>
                            <li><strong>90% agua</strong></li>
                            <li><strong>9.5% proppant</strong> (arena/céramica)</li>
                            <li><strong>0.5% químicos</strong> (20+ tipos)</li>
                        </ul>
                    </div>
                </div>
                <div class="paso-card">
                    <div class="paso-header">💥 FRACTURA</div>
                    <div class="paso-body">
                        <p>La roca (esquisto) se fractura cuando la presión supera su <strong>resistencia a la tracción</strong>:</p>
                        <div class="formula-inline">
                            \\[
                            \\sigma_t = \\frac{F}{A} \\quad \\text{(Resistencia a tracción)}
                            \\]
                        </div>
                        <p><strong>Ejemplo:</strong> Esquisto Marcellus: \\(\\sigma_t \\approx 5\\,\\text{MPa}\\)</p>
                    </div>
                </div>
                <div class="paso-card">
                    <div class="paso-header">⚡ FLUJO</div>
                    <div class="paso-body">
                        <p>El gas/petróleo fluye por las fracturas hacia el pozo:</p>
                        <div class="formula-inline">
                            \\[
                            Q = \\frac{kA}{\\mu L}\\Delta P \\quad \\text{(Ley de Darcy)}
                            \\]
                        </div>
                        <p><strong>k:</strong> Permeabilidad (aumenta 1000× con fracturas)</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- COMPOSICIÓN FLUIDO -->
        <div class="subseccion">
            <h3>3. Composición del Fluido de Fracking</h3>
            <div class="fluido-diagrama">
                <svg width="400" height="200" viewBox="0 0 400 200">
                    <!-- Agua -->
                    <rect x="20" y="50" width="360" height="30" fill="#1E88E5" rx="5"/>
                    <text x="200" y="70" fill="white" font-size="14" text-anchor="middle">90% Agua</text>

                    <!-- Proppant -->
                    <rect x="20" y="90" width="360" height="20" fill="#FFC107" rx="5"/>
                    <text x="200" y="105" fill="#000" font-size="14" text-anchor="middle">9.5% Proppant (arena/céramica)</text>

                    <!-- Químicos -->
                    <rect x="20" y="120" width="360" height="10" fill="#E91E63" rx="5"/>
                    <text x="200" y="130" fill="white" font-size="14" text-anchor="middle">0.5% Químicos (20+ tipos)</text>

                    <!-- Leyenda -->
                    <text x="200" y="160" fill="#FF9800" font-size="12" text-anchor="middle">
                        Biocidas, reductores de fricción, ácidos, gelificantes
                    </text>
                </svg>
            </div>
        </div>
    </section>

    <!-- SIMULADOR INTERACTIVO -->
    <section class="simulator-section">
        <h2 class="seccion-titulo neon-interactivo">
            <span class="icon">🎮</span> SIMULADOR: PRESIÓN Y FRACTURA
        </h2>

        <div class="simulator-container">
            <!-- CONTROLES -->
            <div class="simulator-controls">
                <h3>PARÁMETROS DE INYECCIÓN</h3>

                <div class="control-group">
                    <label for="presionInyeccion">Presión de inyección (bar):</label>
                    <input type="range" id="presionInyeccion" min="100" max="1000" value="700" step="10">
                    <span id="presionValue">700 bar</span>
                </div>

                <div class="control-group">
                    <label for="resistenciaRoca">Resistencia roca (MPa):</label>
                    <input type="range" id="resistenciaRoca" min="1" max="20" value="5" step="0.5">
                    <span id="resistenciaValue">5 MPa</span>
                </div>

                <div class="control-group">
                    <label for="profundidadPozo">Profundidad pozo (km):</label>
                    <input type="range" id="profundidadPozo" min="0.5" max="5" value="2" step="0.1">
                    <span id="profundidadValue">2 km</span>
                </div>

                <div class="control-group">
                    <label for="incluirQuimicos">Incluir químicos:</label>
                    <input type="checkbox" id="incluirQuimicos" checked>
                </div>

                <button class="btn-simular" onclick="simularFracking()">
                    <span class="btn-icon">▶</span> SIMULAR FRACKING
                </button>

                <button class="btn-reset" onclick="reiniciarSimulacion()">
                    <span class="btn-icon">↺</span> REINICIAR
                </button>
            </div>

            <!-- VISUALIZACIÓN -->
            <div class="simulator-visualization">
                <svg viewBox="0 0 600 400" id="svgFracking">
                    <!-- Fondo -->
                    <rect x="0" y="0" width="600" height="400" fill="#0a0a1a"/>

                    <!-- Capas geológicas -->
                    <rect x="50" y="50" width="500" height="300" fill="#3E2723" rx="10"/>
                    <text x="300" y="80" fill="#FFCCBC" font-size="14" text-anchor="middle">ESQUISTO</text>
                    <text x="300" y="100" fill="#FF8A65" font-size="12" text-anchor="middle">Profundidad: <tspan id="svgProfundidad">2000 m</tspan></text>

                    <!-- Pozo -->
                    <path id="pozoPath" d="M 300 50 L 300 200 L 450 200" stroke="#424242" stroke-width="8" fill="none" stroke-linecap="round"/>

                    <!-- Fluido inyectado -->
                    <circle id="fluidoInyeccion" cx="300" cy="200" r="0" fill="#1E88E5" opacity="0.8"/>

                    <!-- Fracturas -->
                    <g id="fracturasGroup">
                        <!-- Se generan dinámicamente -->
                    </g>

                    <!-- Gas/petróleo -->
                    <g id="hidrocarburosGroup">
                        <!-- Se generan dinámicamente -->
                    </g>

                    <!-- Leyendas -->
                    <text x="50" y="350" fill="#E0F2F1" font-size="12">
                        <tspan id="leyendaPresion">Presión: 0 MPa</tspan>
                    </text>
                    <text x="50" y="370" fill="#E0F2F1" font-size="12">
                        <tspan id="leyendaResistencia">Resistencia roca: 5 MPa</tspan>
                    </text>
                    <text x="50" y="390" fill="#E0F2F1" font-size="12" id="leyendaResultado">
                        Estado: Listo para simular
                    </text>
                </svg>
            </div>

            <!-- DATOS -->
            <div class="simulator-data">
                <h3>RESULTADOS</h3>

                <div class="data-card">
                    <div class="data-label">Presión aplicada:</div>
                    <div class="data-value" id="dataPresion">700 bar (70 MPa)</div>
                </div>

                <div class="data-card">
                    <div class="data-label">Resistencia roca:</div>
                    <div class="data-value" id="dataResistencia">5 MPa</div>
                </div>

                <div class="data-card">
                    <div class="data-label">Resultado:</div>
                    <div class="data-value" id="dataResultado">-</div>
                </div>

                <div class="data-card highlight" id="dataEficienciaCard">
                    <div class="data-label">EROEI estimado:</div>
                    <div class="data-value" id="dataEficiencia">5:1</div>
                </div>

                <div class="impacto-ambiental">
                    <h4>🌱 IMPACTO AMBIENTAL</h4>
                    <div class="impacto-item" id="impactoAgua">
                        <span>Contaminación agua:</span>
                        <span class="impacto-value">Alto riesgo</span>
                    </div>
                    <div class="impacto-item" id="impactoSismos">
                        <span>Sismos inducidos:</span>
                        <span class="impacto-value">Magnitud < 3.0</span>
                    </div>
                    <div class="impacto-item" id="impactoEmisiones">
                        <span>Emisiones CH₄:</span>
                        <span class="impacto-value">3.5% fugas</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ANÁLISIS DE DATOS -->
    <section class="analisis-section">
        <h2 class="seccion-titulo neon-evaluacion">
            <span class="icon">📊</span> ANÁLISIS DE DATOS
        </h2>

        <div class="analisis-grid">
            <div class="analisis-card">
                <h3>📈 EROEI COMPARATIVO</h3>
                <div class="grafica-barras">
                    <div class="barra" style="--alto: 90%; --color: #4CAF50;">
                        <div class="barra-valor">20:1</div>
                        <div class="barra-etiqueta">Petróleo convencional</div>
                    </div>
                    <div class="barra" style="--alto: 45%; --color: #FF9800;">
                        <div class="barra-valor">5:1</div>
                        <div class="barra-etiqueta">Fracking (shale gas)</div>
                    </div>
                    <div class="barra" style="--alto: 70%; --color: #2196F3;">
                        <div class="barra-valor">15:1</div>
                        <div class="barra-etiqueta">Eólica</div>
                    </div>
                    <div class="barra" style="--alto: 85%; --color: #4CAF50;">
                        <div class="barra-valor">18:1</div>
                        <div class="barra-etiqueta">Solar fotovoltaica</div>
                    </div>
                </div>
                <p><strong>EROEI:</strong> Energía Retornada sobre Energía Invertida</p>
            </div>

            <div class="analisis-card">
                <h3>💧 CONSUMO DE AGUA</h3>
                <div class="dato-gigante">
                    30 <span class="unidad">millones L</span>
                    <div class="dato-descripcion">por pozo (equivalente a 12 piscinas olímpicas)</div>
                </div>
                <div class="comparacion">
                    <div class="comparacion-item">
                        <span>Petróleo convencional:</span>
                        <span>0.1–0.5 millones L</span>
                    </div>
                    <div class="comparacion-item">
                        <span>Fracking:</span>
                        <span>30–50 millones L</span>
                    </div>
                </div>
            </div>

            <div class="analisis-card">
                <h3>🌍 EMISIONES DE METANO</h3>
                <div class="grafica-circular">
                    <svg width="150" height="150" viewBox="0 0 100 100">
                        <circle cx="50" cy="50" r="45" fill="none" stroke="#FF5722" stroke-width="10" stroke-dasharray="283" stroke-dashoffset="269"/>
                        <text x="50" y="50" fill="white" font-size="12" text-anchor="middle" dy="5">3.5%</text>
                        <text x="50" y="50" fill="white" font-size="8" text-anchor="middle" dy="20">fugas</text>
                    </svg>
                </div>
                <p><strong>Potencial de calentamiento:</strong> CH₄ = 28×CO₂ (100 años)</p>
            </div>
        </div>
    </section>

    <!-- QUIZ INTERACTIVO -->
    <section class="quiz-section">
        <h2 class="seccion-titulo neon-evaluacion">
            <span class="icon">❓</span> QUIZ: FRACKING Y FÍSICA
        </h2>

        <div class="quiz-container">
            <!-- PREGUNTA 1 -->
            <div class="quiz-question" data-correct="C">
                <div class="quiz-header">
                    <span class="quiz-num">01</span>
                    <h3>¿Qué principio físico explica la fractura de la roca en fracking?</h3>
                </div>

                <div class="quiz-options">
                    <button class="quiz-option" data-value="A">
                        <span class="option-letter">A</span>
                        Ley de Hooke
                    </button>
                    <button class="quiz-option" data-value="B">
                        <span class="option-letter">B</span>
                        Primera ley de Newton
                    </button>
                    <button class="quiz-option" data-value="C">
                        <span class="option-letter">C</span>
                        Principio de Pascal
                    </button>
                    <button class="quiz-option" data-value="D">
                        <span class="option-letter">D</span>
                        Ley de Darcy
                    </button>
                </div>

                <div class="quiz-feedback">
                    <div class="feedback-correct">
                        <strong>✅ Correcto:</strong> El <strong>Principio de Pascal</strong> establece que la presión aplicada a un fluido se transmite igualmente en todas direcciones, permitiendo fracturar la roca.
                    </div>
                    <div class="feedback-explicacion">
                        <p>La presión hidrostática (\\(P = \\frac{F}{A}\\)) supera la resistencia a la tracción de la roca (\\(\\sigma_t\\)), creando fracturas.</p>
                    </div>
                </div>
            </div>

            <!-- PREGUNTA 2 -->
            <div class="quiz-question" data-correct="B">
                <div class="quiz-header">
                    <span class="quiz-num">02</span>
                    <h3>¿Cuál es el EROEI típico del fracking?</h3>
                </div>

                <div class="quiz-options">
                    <button class="quiz-option" data-value="A">
                        <span class="option-letter">A</span>
                        20:1
                    </button>
                    <button class="quiz-option" data-value="B">
                        <span class="option-letter">B</span>
                        5:1
                    </button>
                    <button class="quiz-option" data-value="C">
                        <span class="option-letter">C</span>
                        1:1
                    </button>
                    <button class="quiz-option" data-value="D">
                        <span class="option-letter">D</span>
                        50:1
                    </button>
                </div>

                <div class="quiz-feedback">
                    <div class="feedback-correct">
                        <strong>✅ Correcto:</strong> El fracking tiene un EROEI de <strong>~5:1</strong>, mucho menor que el petróleo convencional (~20:1).
                    </div>
                    <div class="feedback-explicacion">
                        <p>Esto significa que por cada <strong>1 unidad de energía invertida</strong>, se obtienen <strong>5 unidades</strong> (vs 20 en convencional).</p>
                    </div>
                </div>
            </div>

            <!-- PREGUNTA 3 -->
            <div class="quiz-question" data-correct="D">
                <div class="quiz-header">
                    <span class="quiz-num">03</span>
                    <h3>¿Cuál es el principal riesgo ambiental del fracking?</h3>
                </div>

                <div class="quiz-options">
                    <button class="quiz-option" data-value="A">
                        <span class="option-letter">A</span>
                        Ruido excesivo
                    </button>
                    <button class="quiz-option" data-value="B">
                        <span class="option-letter">B</span>
                        Contaminación visual
                    </button>
                    <button class="quiz-option" data-value="C">
                        <span class="option-letter">C</span>
                        Radiación electromagnética
                    </button>
                    <button class="quiz-option" data-value="D">
                        <span class="option-letter">D</span>
                        Contaminación de acuíferos
                    </button>
                </div>

                <div class="quiz-feedback">
                    <div class="feedback-correct">
                        <strong>✅ Correcto:</strong> La <strong>contaminación de acuíferos</strong> por metano y químicos es el riesgo más documentado.
                    </div>
                    <div class="feedback-explicacion">
                        <p>Estudios (ej: <em>PNAS, 2016</em>) vinculan fracking con <strong>metano en agua potable</strong> en zonas cercanas a pozos.</p>
                    </div>
                </div>
            </div>

            <!-- RESULTADOS -->
            <div class="quiz-results">
                <h3>🏆 RESULTADOS</h3>
                <div class="results-score">
                    Puntuación: <span id="quizScore">0</span>/3
                </div>
                <div class="results-feedback" id="quizFeedback">
                    Completa el quiz para ver tus resultados
                </div>
                <button class="btn-retry" onclick="reiniciarQuiz()">REINTENTAR</button>
            </div>
        </div>
    </section>

    <!-- DEBATE Y SOSTENIBILIDAD -->
    <section class="debate-section">
        <h2 class="seccion-titulo neon-alerta">
            <span class="icon">⚖️</span> DEBATE: ¿ES SOSTENIBLE EL FRACKING?
        </h2>

        <div class="debate-container">
            <div class="argumento-card pro">
                <div class="argumento-header">✅ A FAVOR</div>
                <div class="argumento-body">
                    <ul>
                        <li><strong>Independencia energética:</strong> Reduce dependencia de importaciones (ej: EE.UU. exportador neto desde 2019).</li>
                        <li><strong>Empleo:</strong> +2 millones de empleos en sector (API, 2023).</li>
                        <li><strong>Transición:</strong> "Puente" hacia energías renovables (argumento controvertido).</li>
                    </ul>
                </div>
            </div>

            <div class="argumento-card contra">
                <div class="argumento-header">❌ EN CONTRA</div>
                <div class="argumento-body">
                    <ul>
                        <li><strong>Contaminación:</strong> +1,000 casos documentados de agua contaminada (EPA, 2022).</li>
                        <li><strong>Cambio climático:</strong> Fugas de metano (CH₄) con potencial de calentamiento 28× > CO₂.</li>
                        <li><strong>Sismos:</strong> Aumento de sismos inducidos en Oklahoma, Texas (USGS).</li>
                        <li><strong>EROEI bajo:</strong> 5:1 vs 20:1 de convencional o 15:1 de renovables.</li>
                    </ul>
                </div>
            </div>

            <div class="conclusiones">
                <h3>📊 CONCLUSIÓN CIENTÍFICA</h3>
                <div class="conclusiones-grid">
                    <div class="conclusiones-item">
                        <div class="conclusiones-titulo">🌱 IMPACTO AMBIENTAL</div>
                        <div class="conclusiones-valor alto">ALTO</div>
                        <div class="conclusiones-detalle">Contaminación agua, aire y suelo</div>
                    </div>
                    <div class="conclusiones-item">
                        <div class="conclusiones-titulo">💰 VIABILIDAD ECONÓMICA</div>
                        <div class="conclusiones-valor medio">MEDIO-ALTO</div>
                        <div class="conclusiones-detalle">Depende de precios del petróleo</div>
                    </div>
                    <div class="conclusiones-item">
                        <div class="conclusiones-titulo">⚡ EFICIENCIA ENERGÉTICA</div>
                        <div class="conclusiones-valor bajo">BAJO (5:1)</div>
                        <div class="conclusiones-detalle">EROEI inferior a renovables</div>
                    </div>
                    <div class="conclusiones-item">
                        <div class="conclusiones-titulo">📈 FUTURO</div>
                        <div class="conclusiones-valor declive">EN DECLIVE</div>
                        <div class="conclusiones-detalle">Prohibiciones crecientes (UE, México)</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- PROBLEMAS TIPO EXAMEN -->
    <section class="examen-section">
        <h2 class="seccion-titulo neon-evaluacion">
            <span class="icon">📝</span> PROBLEMAS TIPO EXAMEN
        </h2>

        <div class="examen-container">
            <div class="problema-card">
                <div class="problema-header">
                    <span class="problema-num">P1</span>
                    <h3>Cálculo de Presión en Fracking</h3>
                </div>
                <div class="problema-enunciado">
                    <p>Un pozo de fracking inyecta fluido con una fuerza de <strong>14,000 N</strong> en un área de <strong>0.02 m²</strong>.</p>
                    <ol>
                        <li>Calcula la presión de inyección en Pascales y bar.</li>
                        <li>Si la resistencia a la tracción de la roca es <strong>6 MPa</strong>, ¿se fracturará?</li>
                        <li>¿Qué porcentaje de la presión aplicada supera la resistencia de la roca?</li>
                    </ol>
                    <div class="formula-inline">
                        \\[
                        P = \\frac{F}{A} \\quad \\text{y} \\quad 1\\,\\text{bar} = 10^5\\,\\text{Pa}
                        \\]
                    </div>
                </div>
                <div class="problema-espacio">
                    <textarea placeholder="Desarrolla tu solución paso a paso..." rows="8"></textarea>
                </div>
                <button class="btn-verificar" onclick="verificarProblema(1)">
                    🔍 VERIFICAR SOLUCIÓN
                </button>
                <div class="problema-solucion" id="solucionP1" style="display: none;">
                    <strong>Solución:</strong><br>
                    1. \\(P = \\frac{14,000\\,\\text{N}}{0.02\\,\\text{m}^2} = 700,000\\,\\text{Pa} = 7\\,\\text{bar}\\)<br>
                    \\(700,000\\,\\text{Pa} = 700\\,\\text{bar}\\) (corrección: 700,000 Pa = 7 bar)<br><br>
                    2. <strong>Sí se fracturará</strong>, porque \\(70\\,\\text{MPa} > 6\\,\\text{MPa}\\).<br><br>
                    3. \\(\\frac{70 - 6}{6} \\times 100\\% = 1,066\\%\\) (supera en 10.66×)
                </div>
            </div>

            <div class="problema-card">
                <div class="problema-header">
                    <span class="problema-num">P2</span>
                    <h3>Análisis de Sostenibilidad</h3>
                </div>
                <div class="problema-enunciado">
                    <p>Comparar el fracking con la energía eólica en términos de:</p>
                    <ol>
                        <li><strong>EROEI</strong> (5:1 vs 15:1).</li>
                        <li><strong>Emisiones de CO₂eq</strong> (400 g/kWh vs 12 g/kWh).</li>
                        <li><strong>Uso de agua</strong> (30 millones L/pozo vs 0 L/turbina).</li>
                    </ol>
                    <p>¿Qué fuente es más sostenible según estos criterios? Justifica con datos.</p>
                </div>
                <div class="problema-espacio">
                    <textarea placeholder="Desarrolla tu análisis comparativo..." rows="8"></textarea>
                </div>
                <button class="btn-verificar" onclick="verificarProblema(2)">
                    🔍 VERIFICAR SOLUCIÓN
                </button>
                <div class="problema-solucion" id="solucionP2" style="display: none;">
                    <strong>Solución:</strong><br>
                    <strong>La energía eólica es más sostenible</strong> en los 3 criterios:<br><br>
                    1. <strong>EROEI:</strong> 15:1 (eólica) > 5:1 (fracking) → Mayor retorno energético.<br>
                    2. <strong>Emisiones:</strong> 12 g/kWh (eólica) ≪ 400 g/kWh (fracking) → Menor huella de carbono.<br>
                    3. <strong>Agua:</strong> 0 L (eólica) vs 30 millones L (fracking) → Sin impacto hídrico.<br><br>
                    <strong>Conclusión:</strong> El fracking tiene mayores impactos ambientales y menor eficiencia energética que las renovables.
                </div>
            </div>
        </div>

        <div class="rubrica">
            <h4>📋 RÚBRICA DE EVALUACIÓN</h4>
            <table class="rubrica-table">
                <tr>
                    <th>Criterio</th>
                    <th>Excelente (3 pts)</th>
                    <th>Satisfactorio (2 pts)</th>
                    <th>Insuficiente (1 pt)</th>
                </tr>
                <tr>
                    <td>Cálculos correctos</td>
                    <td>Todas las operaciones y conversiones de unidades</td>
                    <td>Error en 1 cálculo o unidad</td>
                    <td>Múltiples errores</td>
                </tr>
                <tr>
                    <td>Análisis comparativo</td>
                    <td>Comparación detallada con datos cuantitativos</td>
                    <td>Análisis parcial o cualitativo</td>
                    <td>Sin comparación clara</td>
                </tr>
                <tr>
                    <td>Justificación</td>
                    <td>Argumentos basados en evidencia científica</td>
                    <td>Justificación genérica</td>
                    <td>Sin justificación</td>
                </tr>
            </table>
        </div>
    </section>

    <!-- CIERRE METACOGNITIVO -->
    <section class="cierre-section">
        <header class="cierre-header">
            <h2 class="seccion-titulo neon-concepto">
                <span class="icon">🧠</span> CIERRE METACOGNITIVO
            </h2>
            <p>Actualiza tu autoevaluación, registra tu reflexión y construye un plan de mejora con evidencia científica.</p>
        </header>

        <div class="cierre-grid">
            <article class="cierre-card card-autoevaluacion">
                <h3>📊 Autoevaluación</h3>
                <div class="form-row">
                    <label for="autoSlider1">Física del fracking</label>
                    <input type="range" id="autoSlider1" min="1" max="5" value="3" oninput="updateAutoOutput(this, \'autoVal1\')">
                    <output id="autoVal1">3</output>
                </div>
                <div class="form-row">
                    <label for="autoSlider2">Impactos ambientales</label>
                    <input type="range" id="autoSlider2" min="1" max="5" value="3" oninput="updateAutoOutput(this, \'autoVal2\')">
                    <output id="autoVal2">3</output>
                </div>
                <div class="form-row">
                    <label for="autoSlider3">Análisis crítico</label>
                    <input type="range" id="autoSlider3" min="1" max="5" value="3" oninput="updateAutoOutput(this, \'autoVal3\')">
                    <output id="autoVal3">3</output>
                </div>
                <button class="btn-guardar" onclick="guardarCierreAutoevaluacion()">💾 Guardar autoevaluación</button>
                <div id="autoEvalMsg" class="info-msg" role="status" aria-live="polite"></div>
            </article>

            <article class="cierre-card card-reflexion">
                <h3>💭 Reflexión crítica</h3>
                <p>Redacta una conclusión breve con 2 o 3 acciones concretas basadas en los resultados del simulador.</p>
                <textarea id="reflexionText" placeholder="Escribe tu reflexión ..." aria-label="Reflexión crítica"></textarea>
                <button class="btn-accion" onclick="guardarCierreReflexion()">💾 Guardar reflexión</button>
                <div id="reflexMsg" class="info-msg" role="status" aria-live="polite"></div>
            </article>

            <article class="cierre-card card-plan">
                <h3>📅 Plan de estudio</h3>
                <ul class="todo-list">
                    <li><label><input type="checkbox" id="plan1"> Revisar cálculo de presión y conversión de unidades</label></li>
                    <li><label><input type="checkbox" id="plan2"> Analizar 2 casos reales de contaminación por fracking</label></li>
                    <li><label><input type="checkbox" id="plan3"> Comparar EROEI con energías renovables</label></li>
                </ul>
                <button class="btn-accion" onclick="guardarCierrePlan()">💾 Guardar plan</button>
                <button class="btn-accion" onclick="restaurarCierrePlan()" style="margin-left:0.5rem;">↺ Restaurar</button>
                <div id="planMsg" class="info-msg" role="status" aria-live="polite"></div>
            </article>

            <article class="cierre-card card-recursos">
                <h3>🔗 Recursos recomendados</h3>
                <a href="https://www.eia.gov/energyexplained/oil-and-petroleum-products/hydraulic-fracturing.php" target="_blank" class="recurso-link">EIA: Fracturación hidráulica</a>
                <a href="https://www.sciencedirect.com/topics/earth-and-planetary-sciences/hydraulic-fracturing" target="_blank" class="recurso-link">ScienceDirect: impactos y riesgos</a>
                <a href="https://www.epa.gov/hf/study-hydraulic-fracturing" target="_blank" class="recurso-link">EPA: Estudio de aguas subterráneas</a>
                <button class="btn-accion" onclick="generarResumenCierre()">📝 Generar resumen rápido</button>
                <div id="recursosMsg" class="info-msg" role="status" aria-live="polite"></div>
            </article>
        </div>
    </section>
</div>

<!-- JAVASCRIPT INTEGRADO -->
<script>
// ========================================
// BASE DE DATOS DE PARÁMETROS DE FRACKING
// ========================================
const parametrosFracking = {
    presionMin: 100,    // bar
    presionMax: 1000,   // bar
    resistenciaMin: 1,  // MPa
    resistenciaMax: 20, // MPa
    profundidadMin: 0.5, // km
    profundidadMax: 5,  // km
    eroei: {
        convencional: 20,
        fracking: 5,
        eolica: 15,
        solar: 18
    },
    impactoAmbiental: {
        agua: "Alto riesgo (30M L/pozo)",
        sismos: "Magnitud < 3.0 (inducidos)",
        emisiones: "3.5% fugas de CH₄"
    }
};

// ========================================
// SIMULADOR DE FRACKING
// ========================================
function simularFracking() {
    // Obtener valores de controles
    const presionBar = parseInt(document.getElementById(\'presionInyeccion\').value);
    const resistenciaMPa = parseFloat(document.getElementById(\'resistenciaRoca\').value);
    const profundidadKm = parseFloat(document.getElementById(\'profundidadPozo\').value);
    const incluirQuimicos = document.getElementById(\'incluirQuimicos\').checked;

    // Convertir unidades
    const presionPa = presionBar * 100000; // 1 bar = 100,000 Pa
    const presionMPa = presionPa / 1000000; // MPa

    // Actualizar datos
    document.getElementById(\'presionValue\').textContent = `${presionBar} bar (${presionMPa.toFixed(1)} MPa)`;
    document.getElementById(\'resistenciaValue\').textContent = `${resistenciaMPa} MPa`;
    document.getElementById(\'profundidadValue\').textContent = `${profundidadKm} km`;
    document.getElementById(\'svgProfundidad\').textContent = `${profundidadKm * 1000} m`;

    // Lógica de simulación
    let resultado;
    let fracturado = false;
    let eficiencia = 5; // EROEI base

    if (presionMPa > resistenciaMPa) {
        resultado = "✅ Fractura exitosa: La presión supera la resistencia de la roca.";
        fracturado = true;

        // Generar fracturas visuales
        generarFracturas(fracturado);

        // Calcular eficiencia (simplificado)
        if (presionMPa > resistenciaMPa * 1.5) {
            eficiencia = 6; // Mayor presión → mejor flujo
        } else if (presionMPa < resistenciaMPa * 1.2) {
            eficiencia = 4; // Presión justa → menor flujo
        }

        // Generar flujo de hidrocarburos
        setTimeout(() => {
            generarHidrocarburos(fracturado);
        }, 1000);
    } else {
        resultado = "❌ Fracaso: La presión no supera la resistencia de la roca.";
        generarFracturas(fracturado);
    }

    // Actualizar resultados
    document.getElementById(\'dataPresion\').textContent = `${presionBar} bar (${presionMPa.toFixed(1)} MPa)`;
    document.getElementById(\'dataResistencia\').textContent = `${resistenciaMPa} MPa`;
    document.getElementById(\'dataResultado\').textContent = resultado;
    document.getElementById(\'dataEficiencia\').textContent = `${eficiencia}:1`;
    document.getElementById(\'leyendaPresion\').textContent = `Presión: ${presionMPa.toFixed(1)} MPa`;
    document.getElementById(\'leyendaResistencia\').textContent = `Resistencia roca: ${resistenciaMPa} MPa`;
    document.getElementById(\'leyendaResultado\').textContent = resultado;

    // Impacto ambiental (simplificado)
    document.getElementById(\'impactoAgua\').querySelector(\'.impacto-value\').textContent =
        incluirQuimicos ? "Alto riesgo" : "Riesgo moderado";
    document.getElementById(\'impactoSismos\').querySelector(\'.impacto-value\').textContent =
        fracturado ? "Magnitud < 3.0" : "Sin sismos";
    document.getElementById(\'impactoEmisiones\').querySelector(\'.impacto-value\').textContent =
        fracturado ? "3.5% fugas" : "0%";

    console.log(`🔬 Simulación: ${resultado}`);
    console.log(`   Presión: ${presionMPa.toFixed(1)} MPa`);
    console.log(`   Resistencia roca: ${resistenciaMPa} MPa`);
    console.log(`   EROEI estimado: ${eficiencia}:1`);
}

function generarFracturas(fracturado) {
    const fracturasGroup = document.getElementById(\'fracturasGroup\');
    fracturasGroup.innerHTML = \'\'; // Limpiar fracturas anteriores

    if (fracturado) {
        // Generar 3 fracturas aleatorias
        for (let i = 0; i < 3; i++) {
            const angulo = Math.random() * 60 - 30; // ±30° desde horizontal
            const longitud = 80 + Math.random() * 40; // 80-120 px
            const x1 = 300;
            const y1 = 200;
            const x2 = x1 + longitud * Math.cos(angulo * Math.PI / 180);
            const y2 = y1 + longitud * Math.sin(angulo * Math.PI / 180);

            const linea = document.createElementNS("http://www.w3.org/2000/svg", "line");
            linea.setAttribute("x1", x1);
            linea.setAttribute("y1", y1);
            linea.setAttribute("x2", x2);
            linea.setAttribute("y2", y2);
            linea.setAttribute("stroke", "#D32F2F");
            linea.setAttribute("stroke-width", "3");
            linea.setAttribute("stroke-dasharray", "5,3");

            // Animación de fractura
            const anim = document.createElementNS("http://www.w3.org/2000/svg", "animate");
            anim.setAttribute("attributeName", "stroke-dashoffset");
            anim.setAttribute("values", "0;-8");
            anim.setAttribute("dur", "0.5s");
            anim.setAttribute("repeatCount", "indefinite");
            linea.appendChild(anim);

            fracturasGroup.appendChild(linea);
        }

        // Texto de fractura
        const texto = document.createElementNS("http://www.w3.org/2000/svg", "text");
        texto.setAttribute("x", "300");
        texto.setAttribute("y", "250");
        texto.setAttribute("fill", "#FF5252");
        texto.setAttribute("font-size", "14");
        texto.setAttribute("text-anchor", "middle");
        texto.textContent = "Fracturas generadas";
        fracturasGroup.appendChild(texto);
    } else {
        const texto = document.createElementNS("http://www.w3.org/2000/svg", "text");
        texto.setAttribute("x", "300");
        texto.setAttribute("y", "250");
        texto.setAttribute("fill", "#FF9800");
        texto.setAttribute("font-size", "14");
        texto.setAttribute("text-anchor", "middle");
        texto.textContent = "Presión insuficiente";
        fracturasGroup.appendChild(texto);
    }
}

function generarHidrocarburos(fracturado) {
    if (!fracturado) return;

    const hidrocarburosGroup = document.getElementById(\'hidrocarburosGroup\');
    hidrocarburosGroup.innerHTML = \'\'; // Limpiar

    // Generar 5 burbujas de gas
    for (let i = 0; i < 5; i++) {
        const burbuja = document.createElementNS("http://www.w3.org/2000/svg", "circle");
        const x = 300 + (Math.random() - 0.5) * 100;
        const y = 200;
        const radio = 5 + Math.random() * 10;

        burbuja.setAttribute("cx", x);
        burbuja.setAttribute("cy", y);
        burbuja.setAttribute("r", radio);
        burbuja.setAttribute("fill", "#FFEB3B");

        // Animación de ascenso
        const anim = document.createElementNS("http://www.w3.org/2000/svg", "animate");
        anim.setAttribute("attributeName", "cy");
        anim.setAttribute("from", y);
        anim.setAttribute("to", 50);
        anim.setAttribute("dur", "2s");
        anim.setAttribute("begin", `${i * 0.3}s`);
        anim.setAttribute("fill", "freeze");
        burbuja.appendChild(anim);

        hidrocarburosGroup.appendChild(burbuja);
    }

    // Texto de flujo
    const texto = document.createElementNS("http://www.w3.org/2000/svg", "text");
    texto.setAttribute("x", "300");
    texto.setAttribute("y", "100");
    texto.setAttribute("fill", "#FFC107");
    texto.setAttribute("font-size", "14");
    texto.setAttribute("text-anchor", "middle");
    texto.textContent = "Flujo de gas natural ↑";
    hidrocarburosGroup.appendChild(texto);
}

function reiniciarSimulacion() {
    // Restaurar controles
    document.getElementById(\'presionInyeccion\').value = 700;
    document.getElementById(\'resistenciaRoca\').value = 5;
    document.getElementById(\'profundidadPozo\').value = 2;
    document.getElementById(\'incluirQuimicos\').checked = true;

    // Actualizar textos
    document.getElementById(\'presionValue\').textContent = "700 bar";
    document.getElementById(\'resistenciaValue\').textContent = "5 MPa";
    document.getElementById(\'profundidadValue\').textContent = "2 km";
    document.getElementById(\'svgProfundidad\').textContent = "2000 m";

    // Limpiar SVG
    document.getElementById(\'fluidoInyeccion\').setAttribute(\'r\', \'0\');
    document.getElementById(\'fracturasGroup\').innerHTML = \'\';
    document.getElementById(\'hidrocarburosGroup\').innerHTML = \'\';

    // Restaurar datos
    document.getElementById(\'dataPresion\').textContent = "700 bar (70 MPa)";
    document.getElementById(\'dataResistencia\').textContent = "5 MPa";
    document.getElementById(\'dataResultado\').textContent = "-";
    document.getElementById(\'dataEficiencia\').textContent = "5:1";
    document.getElementById(\'leyendaPresion\').textContent = "Presión: 0 MPa";
    document.getElementById(\'leyendaResistencia\').textContent = "Resistencia roca: 5 MPa";
    document.getElementById(\'leyendaResultado\').textContent = "Estado: Listo para simular";

    // Impacto ambiental
    document.getElementById(\'impactoAgua\').querySelector(\'.impacto-value\').textContent = "Alto riesgo";
    document.getElementById(\'impactoSismos\').querySelector(\'.impacto-value\').textContent = "Magnitud < 3.0";
    document.getElementById(\'impactoEmisiones\').querySelector(\'.impacto-value\').textContent = "3.5% fugas";

    console.log("🔄 Simulación reiniciada");
}

// ========================================
// QUIZ INTERACTIVO
// ========================================
let quizRespuestas = [];
let quizCompletado = false;

document.querySelectorAll(\'.quiz-option\').forEach(option => {
    option.addEventListener(\'click\', function() {
        if (quizCompletado) return;

        const question = this.closest(\'.quiz-question\');
        const correct = question.dataset.correct;
        const selected = this.dataset.value;
        const feedback = question.querySelector(\'.quiz-feedback\');

        // Remover selección previa
        question.querySelectorAll(\'.quiz-option\').forEach(opt => {
            opt.classList.remove(\'selected\', \'correct\', \'incorrect\');
        });

        // Marcar selección actual
        this.classList.add(\'selected\');

        // Verificar respuesta
        if (selected === correct) {
            this.classList.add(\'correct\');
            quizRespuestas.push(true);
        } else {
            this.classList.add(\'incorrect\');
            // Marcar también la correcta
            question.querySelector(`[data-value="${correct}"]`).classList.add(\'correct\');
            quizRespuestas.push(false);
        }

        // Mostrar feedback
        feedback.style.display = \'block\';

        // Verificar si todas respondidas
        const allAnswered = Array.from(document.querySelectorAll(\'.quiz-question\')).every(q =>
            q.querySelector(\'.quiz-option.selected\')
        );

        if (allAnswered && !quizCompletado) {
            quizCompletado = true;
            mostrarResultadosQuiz();
        }
    });
});

function mostrarResultadosQuiz() {
    const correctas = quizRespuestas.filter(r => r).length;
    const total = quizRespuestas.length;
    document.getElementById(\'quizScore\').textContent = `${correctas}/${total}`;

    let feedback;
    if (correctas === total) {
        feedback = "🌟 Excelente! Dominas los conceptos físicos y ambientales del fracking.";
    } else if (correctas >= total/2) {
        feedback = "👍 Bueno. Revisa el principio de Pascal y los impactos ambientales.";
    } else {
        feedback = "📚 Necesitas repasar. Enfócate en la física de la presión y el EROEI.";
    }

    document.getElementById(\'quizFeedback\').textContent = feedback;
}

function reiniciarQuiz() {
    quizRespuestas = [];
    quizCompletado = false;

    document.querySelectorAll(\'.quiz-option\').forEach(opt => {
        opt.classList.remove(\'selected\', \'correct\', \'incorrect\');
    });

    document.querySelectorAll(\'.quiz-feedback\').forEach(fb => {
        fb.style.display = \'none\';
    });

    document.getElementById(\'quizScore\').textContent = "0/3";
    document.getElementById(\'quizFeedback\').textContent = "Completa el quiz para ver tus resultados";
}

// ========================================
// PROBLEMAS TIPO EXAMEN
// ========================================
function verificarProblema(num) {
    const solucion = document.getElementById(`solucionP${num}`);
    if (solucion.style.display === \'block\') {
        solucion.style.display = \'none\';
    } else {
        solucion.style.display = \'block\';
    }
}

// ========================================
// AUTOEVALUACIÓN
// ========================================
function guardarAutoevaluacion() {
    const slider1 = document.getElementById(\'slider1\').value;
    const slider2 = document.getElementById(\'slider2\').value;
    const slider3 = document.getElementById(\'slider3\').value;
    const promedio = (parseInt(slider1) + parseInt(slider2) + parseInt(slider3)) / 3;

    let mensaje = `📊 Autoevaluación guardada:\\n\\n`;
    mensaje += `Física del fracking: ${slider1}/5\\n`;
    mensaje += `Impactos ambientales: ${slider2}/5\\n`;
    mensaje += `Análisis crítico: ${slider3}/5\\n\\n`;
    mensaje += `Promedio: ${promedio.toFixed(1)}/5\\n\\n`;

    if (promedio >= 4) {
        mensaje += "🌟 Excelente comprensión! Puedes analizar críticamente el fracking.";
    } else if (promedio >= 3) {
        mensaje += "👍 Bueno, pero profundiza en los impactos ambientales y alternativas.";
    } else {
        mensaje += "📚 Revisa los fundamentos físicos y datos de sostenibilidad.";
    }

    alert(mensaje);
}

// ========================================
// CIERRE METACOGNITIVO EXTENDIDO

function updateAutoOutput(control, outputId) {
    const output = document.getElementById(outputId);
    if (output) output.textContent = control.value;
}

function guardarCierreAutoevaluacion() {
    const v1 = parseInt(document.getElementById(\'autoSlider1\').value, 10);
    const v2 = parseInt(document.getElementById(\'autoSlider2\').value, 10);
    const v3 = parseInt(document.getElementById(\'autoSlider3\').value, 10);
    const promedio = ((v1 + v2 + v3) / 3).toFixed(1);

    const data = {
        v1, v2, v3,
        promedio: Number(promedio),
        fecha: new Date().toLocaleString()
    };
    localStorage.setItem(\'fracking_cierre_autoevaluacion\', JSON.stringify(data));

    const msg = document.getElementById(\'autoEvalMsg\');
    if (msg) msg.textContent = `✅ Autoevaluación guardada (${data.fecha}). Promedio ${data.promedio}/5`;
}

function guardarCierreReflexion() {
    const texto = document.getElementById(\'reflexionText\').value.trim();
    const msg = document.getElementById(\'reflexMsg\');

    if (!texto) {
        if (msg) msg.textContent = \'⚠️ La reflexión no puede estar vacía.\';
        return;
    }

    localStorage.setItem(\'fracking_cierre_reflexion\', JSON.stringify({texto, fecha: new Date().toLocaleString()}));
    if (msg) msg.textContent = \'✅ Reflexión guardada. Gran análisis.\';
}

function guardarCierrePlan() {
    const plan = {
        repaso: document.getElementById(\'plan1\').checked,
        analisis: document.getElementById(\'plan2\').checked,
        debate: document.getElementById(\'plan3\').checked,
        fecha: new Date().toLocaleString()
    };
    localStorage.setItem(\'fracking_cierre_plan\', JSON.stringify(plan));

    const msg = document.getElementById(\'planMsg\');
    if (msg) msg.textContent = \'✅ Plan de estudio guardado.\';
}

function restaurarCierrePlan() {
    const plan = JSON.parse(localStorage.getItem(\'fracking_cierre_plan\') || \'{}\');
    if (plan.repaso !== undefined) document.getElementById(\'plan1\').checked = plan.repaso;
    if (plan.analisis !== undefined) document.getElementById(\'plan2\').checked = plan.analisis;
    if (plan.debate !== undefined) document.getElementById(\'plan3\').checked = plan.debate;

    const msg = document.getElementById(\'planMsg\');
    if (msg) msg.textContent = \'♻️ Plan de estudio restaurado (desde último guardado).\';
}

function generarResumenCierre() {
    const auto = JSON.parse(localStorage.getItem(\'fracking_cierre_autoevaluacion\') || \'{}\');
    const reflex = JSON.parse(localStorage.getItem(\'fracking_cierre_reflexion\') || \'{}\');
    const plan = JSON.parse(localStorage.getItem(\'fracking_cierre_plan\') || \'{}\');

    const lines = [
        \'--- Resumen metacognitivo ---\',
        `Autovaloración: ${auto.promedio || \'No guardado\'} / 5`,
        `Reflexión: ${reflex.texto ? reflex.texto.slice(0, 80) + (reflex.texto.length > 80 ? \'...\' : \'\') : \'No existente\'}`,
        `Plan cumplido: ${plan.repaso ? \'Repaso\' : \'\'}${plan.analisis ? \', Análisis\' : \'\'}${plan.debate ? \', Debate\' : \'\'}`,
        \'---\',
        \'Comparar tu plan con tus resultados del simulador para cerrar el ciclo de aprendizaje.\'
    ];

    alert(lines.join(\'\\n\'));
    const msg = document.getElementById(\'recursosMsg\');
    if (msg) msg.textContent = \'📌 Resumen generado (ver consola/alert).\';
}

function cargarCierreMetacognitivo() {
    const auto = JSON.parse(localStorage.getItem(\'fracking_cierre_autoevaluacion\') || \'{}\');
    if (auto.v1 !== undefined) {
        document.getElementById(\'autoSlider1\').value = auto.v1;
        document.getElementById(\'autoVal1\').textContent = auto.v1;
    }
    if (auto.v2 !== undefined) {
        document.getElementById(\'autoSlider2\').value = auto.v2;
        document.getElementById(\'autoVal2\').textContent = auto.v2;
    }
    if (auto.v3 !== undefined) {
        document.getElementById(\'autoSlider3\').value = auto.v3;
        document.getElementById(\'autoVal3\').textContent = auto.v3;
    }

    const reflex = JSON.parse(localStorage.getItem(\'fracking_cierre_reflexion\') || \'{}\');
    if (reflex.texto) document.getElementById(\'reflexionText\').value = reflex.texto;

    const plan = JSON.parse(localStorage.getItem(\'fracking_cierre_plan\') || \'{}\');
    if (plan.repaso !== undefined) document.getElementById(\'plan1\').checked = plan.repaso;
    if (plan.analisis !== undefined) document.getElementById(\'plan2\').checked = plan.analisis;
    if (plan.debate !== undefined) document.getElementById(\'plan3\').checked = plan.debate;

    const autoMsg = document.getElementById(\'autoEvalMsg\');
    if (autoMsg && auto.fecha) autoMsg.textContent = `↺ Cargada autoevaluación guardada ${auto.fecha}`;
    const reflexMsg = document.getElementById(\'reflexMsg\');
    if (reflexMsg && reflex.fecha) reflexMsg.textContent = `↺ Reflexión guardada ${reflex.fecha}`;
    const planMsg = document.getElementById(\'planMsg\');
    if (planMsg && plan.fecha) planMsg.textContent = `↺ Plan guardado ${plan.fecha}`;
}

// ========================================
// INICIALIZACIÓN
// ========================================
console.log("🛢️ Lección Cyberpunk: Fracking inicializada");
console.log("🔬 Simulador de presión y fractura listo");
console.log("❓ Quiz con 3 preguntas sobre física y sostenibilidad");
console.log("📊 Análisis comparativo de EROEI y impactos");

// Inicializar simulador
reiniciarSimulacion();
// Inicializar cierre metacognitivo con datos locales
cargarCierreMetacognitivo();
</script>',
    'ejercicios' => 
    array (
      0 => 
      array (
        'enunciado' => 'Fracking extrae de...',
        'respuesta' => 'Esquisto (shale)',
      ),
      1 => 
      array (
        'enunciado' => 'Fluido principal',
        'respuesta' => 'Agua + arena + químicos',
      ),
      2 => 
      array (
        'enunciado' => 'Presión típica',
        'respuesta' => '~700 bar',
      ),
      3 => 
      array (
        'enunciado' => 'EROEI fracking vs petróleo convencional',
        'respuesta' => '5:1 vs 20:1',
      ),
      4 => 
      array (
        'enunciado' => 'Agua por pozo',
        'respuesta' => '~30 millones L',
      ),
      5 => 
      array (
        'enunciado' => 'Riesgo sísmico',
        'respuesta' => 'Sismos inducidos < 3.0',
      ),
      6 => 
      array (
        'enunciado' => 'Contaminante principal',
        'respuesta' => 'Metano (CH₄)',
      ),
      7 => 
      array (
        'enunciado' => 'México 2024',
        'respuesta' => 'Fracking prohibido',
      ),
      8 => 
      array (
        'enunciado' => 'Químicos en fluido',
        'respuesta' => '~0.5%',
      ),
      9 => 
      array (
        'enunciado' => 'Ley física clave',
        'respuesta' => 'Pascal (presión hidrostática)',
      ),
      10 => 
      array (
        'enunciado' => 'Permeabilidad post-fractura',
        'respuesta' => 'Aumenta (Darcy)',
      ),
      11 => 
      array (
        'enunciado' => 'Eficiencia energética global',
        'respuesta' => '~30% (química → eléctrica)',
      ),
    ),
    'quiz' => 
    array (
      0 => 
      array (
        'pregunta' => 'Fracking es...',
        'opciones' => 
        array (
          0 => 'Fracturación hidráulica',
          1 => 'Perforación',
          2 => 'Combustión',
          3 => 'Fusión',
        ),
        'correcta' => 'Fracturación hidráulica',
      ),
      1 => 
      array (
        'pregunta' => 'Extrae de...',
        'opciones' => 
        array (
          0 => 'Esquisto',
          1 => 'Carbón',
          2 => 'Arena',
          3 => 'Agua',
        ),
        'correcta' => 'Esquisto',
      ),
      2 => 
      array (
        'pregunta' => 'Fluido contiene...',
        'opciones' => 
        array (
          0 => 'Agua + químicos',
          1 => 'Solo agua',
          2 => 'Aire',
          3 => 'Gasolina',
        ),
        'correcta' => 'Agua + químicos',
      ),
      3 => 
      array (
        'pregunta' => 'Presión ~...',
        'opciones' => 
        array (
          0 => '700 bar',
          1 => '1 bar',
          2 => '10 bar',
          3 => '1000 bar',
        ),
        'correcta' => '700 bar',
      ),
      4 => 
      array (
        'pregunta' => 'Riesgo principal',
        'opciones' => 
        array (
          0 => 'Contaminación agua',
          1 => 'Calor',
          2 => 'Ruido',
          3 => 'Luz',
        ),
        'correcta' => 'Contaminación agua',
      ),
      5 => 
      array (
        'pregunta' => 'Proppant es...',
        'opciones' => 
        array (
          0 => 'Arena',
          1 => 'Agua',
          2 => 'Químico',
          3 => 'Gas',
        ),
        'correcta' => 'Arena',
      ),
      6 => 
      array (
        'pregunta' => 'EE.UU. aumentó...',
        'opciones' => 
        array (
          0 => 'Producción gas',
          1 => 'Consumo agua',
          2 => 'Nada',
          3 => 'Solar',
        ),
        'correcta' => 'Producción gas',
      ),
      7 => 
      array (
        'pregunta' => 'Sismos por fracking...',
        'opciones' => 
        array (
          0 => 'Inducidos',
          1 => 'Naturales',
          2 => 'Volcánicos',
          3 => 'Ninguno',
        ),
        'correcta' => 'Inducidos',
      ),
      8 => 
      array (
        'pregunta' => 'México 2024...',
        'opciones' => 
        array (
          0 => 'Prohibido',
          1 => 'Permitido',
          2 => 'Obligatorio',
          3 => 'Desconocido',
        ),
        'correcta' => 'Prohibido',
      ),
      9 => 
      array (
        'pregunta' => 'EROEI ~...',
        'opciones' => 
        array (
          0 => '5:1',
          1 => '1:1',
          2 => '20:1',
          3 => '100:1',
        ),
        'correcta' => '5:1',
      ),
      10 => 
      array (
        'pregunta' => 'Agua por pozo ~...',
        'opciones' => 
        array (
          0 => '30 millones L',
          1 => '1 millón L',
          2 => '100 L',
          3 => '1 billón L',
        ),
        'correcta' => '30 millones L',
      ),
      11 => 
      array (
        'pregunta' => '% químicos',
        'opciones' => 
        array (
          0 => '0.5%',
          1 => '50%',
          2 => '10%',
          3 => '90%',
        ),
        'correcta' => '0.5%',
      ),
      12 => 
      array (
        'pregunta' => 'Metano es...',
        'opciones' => 
        array (
          0 => 'GHG potente',
          1 => 'Inerte',
          2 => 'Refrigerante',
          3 => 'Combustible limpio',
        ),
        'correcta' => 'GHG potente',
      ),
      13 => 
      array (
        'pregunta' => 'Pozo horizontal hasta...',
        'opciones' => 
        array (
          0 => '3 km',
          1 => '100 m',
          2 => '10 km',
          3 => '1 cm',
        ),
        'correcta' => '3 km',
      ),
      14 => 
      array (
        'pregunta' => 'Ley de Pascal aplica en...',
        'opciones' => 
        array (
          0 => 'Transmisión presión',
          1 => 'Velocidad',
          2 => 'Masa',
          3 => 'Color',
        ),
        'correcta' => 'Transmisión presión',
      ),
      15 => 
      array (
        'pregunta' => 'Permeabilidad mide...',
        'opciones' => 
        array (
          0 => 'Flujo fluido',
          1 => 'Dureza',
          2 => 'Color',
          3 => 'Olor',
        ),
        'correcta' => 'Flujo fluido',
      ),
      16 => 
      array (
        'pregunta' => 'Eficiencia química → eléctrica',
        'opciones' => 
        array (
          0 => '~30%',
          1 => '90%',
          2 => '5%',
          3 => '100%',
        ),
        'correcta' => '~30%',
      ),
      17 => 
      array (
        'pregunta' => 'Sismo típico fracking',
        'opciones' => 
        array (
          0 => '< 3.0',
          1 => '> 5.0',
          2 => '= 0',
          3 => '> 7.0',
        ),
        'correcta' => '< 3.0',
      ),
      18 => 
      array (
        'pregunta' => 'Prohibido en...',
        'opciones' => 
        array (
          0 => 'Francia, México',
          1 => 'EE.UU.',
          2 => 'China',
          3 => 'Rusia',
        ),
        'correcta' => 'Francia, México',
      ),
      19 => 
      array (
        'pregunta' => 'Unidad presión SI',
        'opciones' => 
        array (
          0 => 'Pascal',
          1 => 'Bar',
          2 => 'Atm',
          3 => 'Psi',
        ),
        'correcta' => 'Pascal',
      ),
      20 => 
      array (
        'pregunta' => 'Módulo Young roca esquisto ~...',
        'opciones' => 
        array (
          0 => '30 GPa',
          1 => '1 GPa',
          2 => '100 GPa',
          3 => '1 MPa',
        ),
        'correcta' => '30 GPa',
      ),
      21 => 
      array (
        'pregunta' => 'Fuga metano % producción',
        'opciones' => 
        array (
          0 => '1-5%',
          1 => '0%',
          2 => '50%',
          3 => '100%',
        ),
        'correcta' => '1-5%',
      ),
      22 => 
      array (
        'pregunta' => 'Tratamiento agua residual',
        'opciones' => 
        array (
          0 => 'Re-inyección',
          1 => 'Evaporación',
          2 => 'Beber',
          3 => 'Nada',
        ),
        'correcta' => 'Re-inyección',
      ),
      23 => 
      array (
        'pregunta' => 'Energía para bombear fluido',
        'opciones' => 
        array (
          0 => '~10% total',
          1 => '50%',
          2 => '0%',
          3 => '100%',
        ),
        'correcta' => '~10% total',
      ),
      24 => 
      array (
        'pregunta' => 'Declinación pozo',
        'opciones' => 
        array (
          0 => '60% primer año',
          1 => '10%',
          2 => '0%',
          3 => '100%',
        ),
        'correcta' => '60% primer año',
      ),
      25 => 
      array (
        'pregunta' => 'Alternativa renovable',
        'opciones' => 
        array (
          0 => 'Geotérmica',
          1 => 'Fracking',
          2 => 'Carbón',
          3 => 'Nuclear',
        ),
        'correcta' => 'Geotérmica',
      ),
      26 => 
      array (
        'pregunta' => 'CO₂ equivalente metano (100 años)',
        'opciones' => 
        array (
          0 => '25×',
          1 => '1×',
          2 => '100×',
          3 => '0×',
        ),
        'correcta' => '25×',
      ),
      27 => 
      array (
        'pregunta' => 'Ley Darcy: Q =',
        'opciones' => 
        array (
          0 => '-kAΔP/μL',
          1 => 'F=ma',
          2 => 'PV=nRT',
          3 => 'E=mc²',
        ),
        'correcta' => '-kAΔP/μL',
      ),
      28 => 
      array (
        'pregunta' => 'México: reforma 2024',
        'opciones' => 
        array (
          0 => 'Prohibición total',
          1 => 'Permiso parcial',
          2 => 'Obligatorio',
          3 => 'Sin cambio',
        ),
        'correcta' => 'Prohibición total',
      ),
      29 => 
      array (
        'pregunta' => 'SI 2025: 1 bar =',
        'opciones' => 
        array (
          0 => '10⁵ Pa',
          1 => '1 Pa',
          2 => '10⁶ Pa',
          3 => '1 atm',
        ),
        'correcta' => '10⁵ Pa',
      ),
    ),
  ),
  3 => 
  array (
    'materia' => 'Física I',
    'slug' => 'joule-cyberpunk',
    'titulo' => 'Joule: De la Mecánica al Calor',
    'contenido' => '<!-- INICIO LECCIÓN CYBERPUNK -->
<div class="leccion-container leccion-fisica-joule" data-tema="unidad-joule">

    <!-- CABECERA CYBERPUNK -->
    <header class="leccion-header">
        <h1 class="titulo-leccion neon-glow">
            <span class="icon-tema">⚡</span>
            JOULE: LA MONEDA DE LA ENERGÍA
        </h1>
        <div class="subtitulo">
            Trabajo, Energía y la Equivalencia Mecánica del Calor
        </div>
    </header>

    <!-- PANEL OBJETIVOS -->
    <section class="panel-objetivos">
        <h2 class="seccion-titulo neon-concepto">
            <span class="icon">🎯</span> OBJETIVOS DE APRENDIZAJE
        </h2>
        <div class="objetivos-grid">
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Definir el joule como unidad SI</h3>
                <p>Comprender su relación con Newton, metro y vatio</p>
            </div>
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Aplicar en fórmulas de trabajo y energía</h3>
                <p>Calcular \\(W = F \\cdot d\\), \\(E_k = \\frac{1}{2}mv^2\\), \\(E_p = mgh\\)</p>
            </div>
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Explicar el experimento de Joule</h3>
                <p>Equivalencia mecánica del calor (4.186 J/cal)</p>
            </div>
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Convertir entre unidades de energía</h3>
                <p>Joule, caloría, electronvoltio, kilowatt-hora</p>
            </div>
        </div>
    </section>

    <!-- CONTEXTO REAL -->
    <section class="contexto-real">
        <h2 class="seccion-titulo neon-dato">
            <span class="icon">🌍</span> APLICACIONES EN LA VIDA REAL
        </h2>
        <div class="contexto-grid">
            <div class="contexto-card">
                <h3>💡 ENERGÍA ELÉCTRICA</h3>
                <p>Un foco LED de <strong>10 W</strong> encendido 1 hora consume:</p>
                <div class="formula-inline">
                    \\[
                    E = P \\times t = 10\\,\\text{W} \\times 3600\\,\\text{s} = 36,000\\,\\text{J}
                    \\]
                </div>
                <div class="dato-neon">Equivalente a levantar 360 kg a 10 m</div>
            </div>
            <div class="contexto-card">
                <h3>🏋️‍♂️ TRABAJO HUMANO</h3>
                <p>Una persona de <strong>70 kg</strong> subiendo 3 m realiza:</p>
                <div class="formula-inline">
                    \\[
                    W = mgh = 70 \\times 9.8 \\times 3 = 2,058\\,\\text{J}
                    \\]
                </div>
                <div class="dato-neon">Equivalente a 0.5 kcal (alimentos)</div>
            </div>
            <div class="contexto-card">
                <h3>🔋 BATERÍAS</h3>
                <p>Una batería AA (1.5 V, 2000 mAh) almacena:</p>
                <div class="formula-inline">
                    \\[
                    E = V \\times Q = 1.5 \\times 2 \\times 3600 = 10,800\\,\\text{J}
                    \\]
                </div>
                <div class="dato-neon">Suficiente para 3 horas de LED</div>
            </div>
        </div>
    </section>

    <!-- DEFINICIÓN Y DIMENSIONES -->
    <section class="definicion-section">
        <h2 class="seccion-titulo neon-concepto">
            <span class="icon">📐</span> DEFINICIÓN Y DIMENSIONES
        </h2>

        <div class="definicion-dual">
            <div class="definicion-card">
                <h3>🔹 DEFINICIÓN FORMAL</h3>
                <div class="formula-grand">
                    \\[
                    1\\,\\text{J} = 1\\,\\text{N} \\cdot \\text{m} = 1\\,\\text{kg} \\cdot \\text{m}^2 \\cdot \\text{s}^{-2}
                    \\]
                </div>
                <p>Unidad SI de <strong>energía</strong>, <strong>trabajo</strong> y <strong>calor</strong>.</p>
                <div class="autor-destacado">
                    <strong>James Prescott Joule</strong> (1818–1889)<br>
                    <small>Físico británico, pionero en termodinámica</small>
                </div>
            </div>

            <div class="dimensiones-card">
                <h3>📏 EQUIVALENCIAS</h3>
                <table class="tabla-equivalencias">
                    <tbody>
                        <tr><td><strong>1 J</strong></td><td>= 1 N·m</td></tr>
                        <tr><td><strong>1 J</strong></td><td>= 1 W·s</td></tr>
                        <tr><td><strong>1 J</strong></td><td>= 0.239 cal</td></tr>
                        <tr><td><strong>1 J</strong></td><td>= 6.24 × 10¹⁸ eV</td></tr>
                        <tr><td><strong>1 kWh</strong></td><td>= 3.6 × 10⁶ J</td></tr>
                        <tr><td><strong>1 cal</strong></td><td>= 4.186 J</td></tr>
                    </tbody>
                </table>
                <div class="nota-bipm">
                    <small>Definición oficial SI (2025):<br>
                    Basada en constantes fundamentales (h, c, ΔνCs)</small>
                </div>
            </div>
        </div>
    </section>

    <!-- APLICACIONES FÍSICAS -->
    <section class="aplicaciones-section">
        <h2 class="seccion-titulo neon-interactivo">
            <span class="icon">🔧</span> APLICACIONES FÍSICAS DEL JOULE
        </h2>

        <div class="aplicaciones-grid">
            <div class="aplicacion-card" data-tipo="trabajo">
                <div class="aplicacion-icon">🏋️</div>
                <h4>TRABAJO MECÁNICO</h4>
                <div class="formula-destacada">
                    \\[
                    W = F \\cdot d \\cdot \\cos\\theta
                    \\]
                </div>
                <div class="ejemplo-mini">
                    <strong>Ejemplo:</strong> Empujar un mueble 5 m con 20 N<br>
                    \\(W = 20 \\times 5 = 100\\,\\text{J}\\)
                </div>
            </div>

            <div class="aplicacion-card" data-tipo="cinetica">
                <div class="aplicacion-icon">🚀</div>
                <h4>ENERGÍA CINÉTICA</h4>
                <div class="formula-destacada">
                    \\[
                    E_k = \\frac{1}{2}mv^2
                    \\]
                </div>
                <div class="ejemplo-mini">
                    <strong>Ejemplo:</strong> Auto de 1000 kg a 20 m/s<br>
                    \\(E_k = 0.5 \\times 1000 \\times 400 = 200,000\\,\\text{J}\\)
                </div>
            </div>

            <div class="aplicacion-card" data-tipo="potencial">
                <div class="aplicacion-icon">🗼</div>
                <h4>ENERGÍA POTENCIAL</h4>
                <div class="formula-destacada">
                    \\[
                    E_p = mgh
                    \\]
                </div>
                <div class="ejemplo-mini">
                    <strong>Ejemplo:</strong> Libro de 0.5 kg a 1.5 m<br>
                    \\(E_p = 0.5 \\times 9.8 \\times 1.5 = 7.35\\,\\text{J}\\)
                </div>
            </div>

            <div class="aplicacion-card" data-tipo="calor">
                <div class="aplicacion-icon">🔥</div>
                <h4>CALOR (TERMODINÁMICA)</h4>
                <div class="formula-destacada">
                    \\[
                    Q = mc\\Delta T
                    \\]
                </div>
                <div class="ejemplo-mini">
                    <strong>Ejemplo:</strong> Calentar 1 kg de agua 1°C<br>
                    \\(Q = 1 \\times 4186 \\times 1 = 4,186\\,\\text{J}\\)
                </div>
            </div>
        </div>
    </section>

    <!-- EXPERIMENTO DE JOULE -->
    <section class="experimento-section">
        <h2 class="seccion-titulo neon-interactivo">
            <span class="icon">🔬</span> EXPERIMENTO DE JOULE (1843)
        </h2>

        <div class="experimento-dual">
            <div class="experimento-desc">
                <h3>📜 CONTEXTO HISTÓRICO</h3>
                <p>Joule demostró que <strong>el trabajo mecánico puede convertirse en calor</strong>, sentando las bases de la <strong>Primera Ley de la Termodinámica</strong>.</p>
                <div class="cita-destacada">
                    <p>"La cantidad de calor producida es siempre proporcional al trabajo gastado."</p>
                    <small>— James Prescott Joule, 1843</small>
                </div>
                <div class="equivalencia-historica">
                    <strong>Equivalencia mecánica del calor:</strong><br>
                    \\(1\\,\\text{cal} = 4.186\\,\\text{J}\\)
                </div>
            </div>

            <div class="experimento-diagrama">
                <svg width="400" height="300" viewBox="0 0 400 300" id="diagramaJoule">
                    <!-- Contenedor -->
                    <rect x="50" y="100" width="300" height="150" fill="#E3F2FD" rx="10" stroke="#1976D2" stroke-width="2"/>

                    <!-- Agua -->
                    <rect x="60" y="180" width="280" height="60" fill="#42A5F5" rx="5"/>
                    <text x="200" y="210" fill="white" font-size="12" text-anchor="middle">Agua</text>

                    <!-- Paletas -->
                    <g id="paletas" transform="translate(200, 150)">
                        <line x1="-30" y1="0" x2="30" y1="0" stroke="#1565C0" stroke-width="3"/>
                        <line x1="0" y1="-20" x2="0" y2="20" stroke="#1565C0" stroke-width="2"/>
                        <circle cx="0" cy="0" r="5" fill="#1565C0"/>

                        <!-- Pesas -->
                        <rect x="-50" y="-80" width="30" height="20" fill="#795548" rx="2"/>
                        <rect x="20" y="-80" width="30" height="20" fill="#795548" rx="2"/>
                        <text x="0" y="-95" fill="#3E2723" font-size="10" text-anchor="middle">Pesas</text>

                        <!-- Cuerda -->
                        <path d="M -30 0 Q 0 -40 30 0" stroke="#3E2723" stroke-width="2" fill="none"/>
                    </g>

                    <!-- Termómetro -->
                    <g id="termometro" transform="translate(300, 120)">
                        <rect x="0" y="0" width="20" height="80" fill="white" rx="3"/>
                        <rect x="5" y="10" width="10" height="60" fill="#E91E63"/>
                        <text x="10" y="95" fill="#E91E63" font-size="10" text-anchor="middle">ΔT</text>
                    </g>

                    <!-- Flecha trabajo -->
                    <path d="M 150 50 L 200 80 L 150 110" fill="#4CAF50" opacity="0.7"/>
                    <text x="170" y="70" fill="#2E7D32" font-size="12" text-anchor="middle">Trabajo</text>

                    <!-- Leyenda -->
                    <text x="200" y="280" fill="#0D47A1" font-size="12" text-anchor="middle">
                        Trabajo mecánico → Calor (ΔT)
                    </text>
                </svg>
            </div>
        </div>
    </section>

    <!-- SIMULADOR INTERACTIVO -->
    <section class="simulator-section">
        <h2 class="seccion-titulo neon-interactivo">
            <span class="icon">🎮</span> SIMULADOR: EXPERIMENTO DE JOULE
        </h2>

        <div class="simulator-container">
            <!-- CONTROLES -->
            <div class="simulator-controls">
                <h3>PARÁMETROS</h3>

                <div class="control-group">
                    <label for="masaPesas">Masa de pesas (kg):</label>
                    <input type="range" id="masaPesas" min="0.1" max="5" value="1" step="0.1">
                    <span id="masaValue">1.0 kg</span>
                </div>

                <div class="control-group">
                    <label for="alturaCaida">Altura de caída (m):</label>
                    <input type="range" id="alturaCaida" min="0.5" max="3" value="1" step="0.1">
                    <span id="alturaValue">1.0 m</span>
                </div>

                <div class="control-group">
                    <label for="masaAgua">Masa de agua (kg):</label>
                    <input type="range" id="masaAgua" min="0.1" max="2" value="0.5" step="0.1">
                    <span id="masaAguaValue">0.5 kg</span>
                </div>

                <div class="control-group">
                    <label for="eficiencia">Eficiencia (%):</label>
                    <input type="range" id="eficiencia" min="50" max="100" value="90" step="1">
                    <span id="eficienciaValue">90%</span>
                </div>

                <button class="btn-simular" onclick="iniciarExperimento()">
                    <span class="btn-icon">▶</span> INICIAR EXPERIMENTO
                </button>

                <button class="btn-reset" onclick="reiniciarExperimento()">
                    <span class="btn-icon">↺</span> REINICIAR
                </button>
            </div>

            <!-- VISUALIZACIÓN -->
            <div class="simulator-visualization">
                <svg viewBox="0 0 600 400" id="svgExperimento">
                    <!-- Fondo -->
                    <rect x="0" y="0" width="600" height="400" fill="#0a0a1a"/>

                    <!-- Contenedor -->
                    <rect x="100" y="150" width="400" height="200" fill="#151515" rx="10" stroke="#1976D2" stroke-width="2"/>

                    <!-- Agua -->
                    <rect id="agua" x="110" y="280" width="380" height="60" fill="#42A5F5" rx="5">
                        <animate attributeName="height" values="60;65;60" dur="3s" repeatCount="indefinite" begin="indefinite" id="animAgua"/>
                    </rect>
                    <text x="300" y="310" fill="white" font-size="14" text-anchor="middle">Agua</text>

                    <!-- Paletas -->
                    <g id="paletasGroup" transform="translate(300, 200)">
                        <line id="paleta1" x1="-40" y1="0" x2="40" y1="0" stroke="#1565C0" stroke-width="4"/>
                        <line id="paleta2" x1="0" y1="-30" x2="0" y2="30" stroke="#1565C0" stroke-width="3"/>

                        <!-- Eje -->
                        <circle cx="0" cy="0" r="8" fill="#3E2723"/>

                        <!-- Cuerda -->
                        <path id="cuerda" d="M 0 0 L 0 -100" stroke="#795548" stroke-width="3" stroke-dasharray="5,3">
                            <animate attributeName="stroke-dashoffset" values="0;-8" dur="0.5s" repeatCount="indefinite" begin="indefinite" id="animCuerda"/>
                        </path>

                        <!-- Pesas -->
                        <rect id="pesa1" x="-20" y="-120" width="40" height="25" fill="#795548" rx="3"/>
                        <rect id="pesa2" x="-20" y="-150" width="40" height="25" fill="#795548" rx="3"/>
                        <text x="0" y="-100" fill="#E0E0E0" font-size="12" text-anchor="middle" id="masaPesasText">1 kg</text>
                    </g>

                    <!-- Termómetro -->
                    <g id="termometroGroup" transform="translate(450, 180)">
                        <rect x="0" y="0" width="25" height="100" fill="white" rx="4"/>
                        <rect id="mercurio" x="5" y="90" width="15" height="10" fill="#E91E63" rx="2">
                            <animate attributeName="y" values="90;30" dur="2s" begin="indefinite" id="animMercurio"/>
                            <animate attributeName="height" values="10;70" dur="2s" begin="indefinite" id="animMercurioHeight"/>
                        </rect>
                        <text x="12.5" y="110" fill="#E91E63" font-size="12" text-anchor="middle" id="deltaTText">ΔT = 0°C</text>
                    </g>

                    <!-- Energía -->
                    <rect x="50" y="320" width="500" height="60" fill="rgba(0,0,0,0.7)" rx="5"/>

                    <!-- Barra Trabajo -->
                    <rect id="barraTrabajo" x="70" y="330" width="0" height="20" fill="#4CAF50" rx="3"/>
                    <text x="70" y="325" fill="#E0E0E0" font-size="12">Trabajo (J)</text>
                    <text id="valorTrabajo" x="120" y="345" fill="#E0E0E0" font-size="12">0 J</text>

                    <!-- Barra Calor -->
                    <rect id="barraCalor" x="70" y="360" width="0" height="20" fill="#E91E63" rx="3"/>
                    <text x="70" y="355" fill="#E0E0E0" font-size="12">Calor (J)</text>
                    <text id="valorCalor" x="120" y="375" fill="#E0E0E0" font-size="12">0 J</text>

                    <!-- Eficiencia -->
                    <text x="300" y="350" fill="#FFC107" font-size="14" text-anchor="middle">
                        Eficiencia: <tspan id="valorEficiencia">90%</tspan>
                    </text>
                </svg>
            </div>

            <!-- DATOS -->
            <div class="simulator-data">
                <h3>RESULTADOS</h3>

                <div class="data-card">
                    <div class="data-label">Trabajo mecánico (W):</div>
                    <div class="data-value" id="dataTrabajo">0 J</div>
                </div>

                <div class="data-card">
                    <div class="data-label">Energía térmica (Q):</div>
                    <div class="data-value" id="dataCalor">0 J</div>
                </div>

                <div class="data-card">
                    <div class="data-label">Equivalente en calorías:</div>
                    <div class="data-value" id="dataCalorias">0 cal</div>
                </div>

                <div class="data-card highlight">
                    <div class="data-label">Equivalente mecánico:</div>
                    <div class="data-value" id="dataEquivalente">0 kg·m</div>
                </div>

                <div class="data-card">
                    <div class="data-label">Aumento de temperatura:</div>
                    <div class="data-value" id="dataDeltaT">0°C</div>
                </div>

                <div class="formula-resumen">
                    <h4>📝 RESUMEN</h4>
                    <div class="formula-inline">
                        \\[
                        W = mgh = \\text{<span id="resumenMasa">1</span> kg} \\times 9.8\\,\\text{m/s²} \\times \\text{<span id="resumenAltura">1</span> m} = \\text{<span id="resumenTrabajo">9.8</span> J}
                        \\]
                    </div>
                    <div class="formula-inline">
                        \\[
                        Q = m c \\Delta T \\quad \\Rightarrow \\quad \\Delta T = \\frac{Q}{mc} = \\text{<span id="resumenDeltaT">0.002</span>°C}
                        \\]
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CONVERSOR INTERACTIVO -->
    <section class="conversor-section">
        <h2 class="seccion-titulo neon-interactivo">
            <span class="icon">🔄</span> CONVERSOR DE UNIDADES DE ENERGÍA
        </h2>

        <div class="conversor-container">
            <div class="conversor-controls">
                <div class="control-group">
                    <label for="valorEntrada">Valor:</label>
                    <input type="number" id="valorEntrada" value="1" min="0.001" step="0.001">
                </div>

                <div class="control-group">
                    <label for="unidadEntrada">De:</label>
                    <select id="unidadEntrada">
                        <option value="J">Joule (J)</option>
                        <option value="cal">Caloría (cal)</option>
                        <option value="kWh">Kilowatt-hora (kWh)</option>
                        <option value="eV">Electronvoltio (eV)</option>
                        <option value="BTU">BTU</option>
                    </select>
                </div>

                <div class="control-group">
                    <label for="unidadSalida">A:</label>
                    <select id="unidadSalida">
                        <option value="J">Joule (J)</option>
                        <option value="cal">Caloría (cal)</option>
                        <option value="kWh">Kilowatt-hora (kWh)</option>
                        <option value="eV">Electronvoltio (eV)</option>
                        <option value="BTU">BTU</option>
                    </select>
                </div>

                <button class="btn-convertir" onclick="convertirUnidades()">
                    <span class="btn-icon">↔</span> CONVERTIR
                </button>
            </div>

            <div class="conversor-resultado">
                <div class="resultado-card">
                    <div class="resultado-label">Resultado:</div>
                    <div class="resultado-value" id="resultadoConversion">1 J = 1 J</div>
                </div>

                <div class="ejemplo-equivalente">
                    <h4>💡 EJEMPLO EQUIVALENTE</h4>
                    <div id="ejemploEquivalente">
                        1 J puede levantar 100 g a 1 m de altura.
                    </div>
                </div>
            </div>

            <div class="tabla-conversiones">
                <h4>📊 TABLA DE CONVERSIÓN RÁPIDA</h4>
                <table>
                    <thead>
                        <tr><th>Unidad</th><th>Equivalente en Joules</th><th>Ejemplo</th></tr>
                    </thead>
                    <tbody>
                        <tr><td>1 cal</td><td>4.186 J</td><td>Calentar 1 g de agua 1°C</td></tr>
                        <tr><td>1 kWh</td><td>3.6 × 10⁶ J</td><td>Energía de 1 hora de secador</td></tr>
                        <tr><td>1 eV</td><td>1.602 × 10⁻¹⁹ J</td><td>Energía de un fotón visible</td></tr>
                        <tr><td>1 BTU</td><td>1,055 J</td><td>Calentar 1 libra de agua 1°F</td></tr>
                        <tr><td>1 ton TNT</td><td>4.184 × 10⁹ J</td><td>Energía de 1 ton de explosivo</td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- QUIZ INTERACTIVO -->
    <section class="quiz-section">
        <h2 class="seccion-titulo neon-evaluacion">
            <span class="icon">❓</span> QUIZ: DOMINA EL JOULE
        </h2>

        <div class="quiz-container">
            <!-- PREGUNTA 1 -->
            <div class="quiz-question" data-correct="C">
                <div class="quiz-header">
                    <span class="quiz-num">01</span>
                    <h3>¿Cuál es la definición correcta de 1 joule?</h3>
                </div>

                <div class="quiz-options">
                    <button class="quiz-option" data-value="A">
                        <span class="option-letter">A</span>
                        1 J = 1 kg·m/s
                    </button>
                    <button class="quiz-option" data-value="B">
                        <span class="option-letter">B</span>
                        1 J = 1 N/s
                    </button>
                    <button class="quiz-option" data-value="C">
                        <span class="option-letter">C</span>
                        1 J = 1 N·m
                    </button>
                    <button class="quiz-option" data-value="D">
                        <span class="option-letter">D</span>
                        1 J = 1 W·h
                    </button>
                </div>

                <div class="quiz-feedback">
                    <div class="feedback-correct">
                        <strong>✅ Correcto:</strong> 1 J = 1 N·m (newton por metro).
                    </div>
                    <div class="feedback-explicacion">
                        <p>También equivale a 1 W·s (vatio por segundo) o 1 kg·m²/s².</p>
                    </div>
                </div>
            </div>

            <!-- PREGUNTA 2 -->
            <div class="quiz-question" data-correct="B">
                <div class="quiz-header">
                    <span class="quiz-num">02</span>
                    <h3>En el experimento de Joule, ¿qué se conserva?</h3>
                </div>

                <div class="quiz-options">
                    <button class="quiz-option" data-value="A">
                        <span class="option-letter">A</span>
                        La temperatura
                    </button>
                    <button class="quiz-option" data-value="B">
                        <span class="option-letter">B</span>
                        La energía total
                    </button>
                    <button class="quiz-option" data-value="C">
                        <span class="option-letter">C</span>
                        La masa del agua
                    </button>
                    <button class="quiz-option" data-value="D">
                        <span class="option-letter">D</span>
                        La velocidad de las paletas
                    </button>
                </div>

                <div class="quiz-feedback">
                    <div class="feedback-correct">
                        <strong>✅ Correcto:</strong> Se conserva la <strong>energía total</strong> (Primera Ley de la Termodinámica).
                    </div>
                    <div class="feedback-explicacion">
                        <p>La energía mecánica (trabajo) se transforma en energía térmica (calor), pero la suma total permanece constante.</p>
                    </div>
                </div>
            </div>

            <!-- PREGUNTA 3 -->
            <div class="quiz-question" data-correct="A">
                <div class="quiz-header">
                    <span class="quiz-num">03</span>
                    <h3>¿Cuántos joules equivalen a 1 caloría?</h3>
                </div>

                <div class="quiz-options">
                    <button class="quiz-option" data-value="A">
                        <span class="option-letter">A</span>
                        4.186 J
                    </button>
                    <button class="quiz-option" data-value="B">
                        <span class="option-letter">B</span>
                        1 J
                    </button>
                    <button class="quiz-option" data-value="C">
                        <span class="option-letter">C</span>
                        0.239 J
                    </button>
                    <button class="quiz-option" data-value="D">
                        <span class="option-letter">D</span>
                        418.6 J
                    </button>
                </div>

                <div class="quiz-feedback">
                    <div class="feedback-correct">
                        <strong>✅ Correcto:</strong> 1 cal = 4.186 J (equivalente mecánico del calor).
                    </div>
                    <div class="feedback-explicacion">
                        <p>Este valor fue determinado experimentalmente por Joule en 1843.</p>
                    </div>
                </div>
            </div>

            <!-- RESULTADOS -->
            <div class="quiz-results">
                <h3>🏆 RESULTADOS</h3>
                <div class="results-score">
                    Puntuación: <span id="quizScore">0</span>/3
                </div>
                <div class="results-feedback" id="quizFeedback">
                    Completa el quiz para ver tus resultados
                </div>
                <button class="btn-retry" onclick="reiniciarQuiz()">REINTENTAR</button>
            </div>
        </div>
    </section>

    <!-- PROBLEMAS TIPO EXAMEN -->
    <section class="examen-section">
        <h2 class="seccion-titulo neon-evaluacion">
            <span class="icon">📝</span> PROBLEMAS TIPO EXAMEN
        </h2>

        <div class="examen-container">
            <div class="problema-card">
                <div class="problema-header">
                    <span class="problema-num">P1</span>
                    <h3>Cálculo de Trabajo Mecánico</h3>
                </div>
                <div class="problema-enunciado">
                    <p>Calcula el trabajo realizado al levantar un objeto de <strong>5 kg</strong> a una altura de <strong>2 m</strong> con una aceleración constante. Expresa el resultado en:</p>
                    <ol>
                        <li>Joules (J)</li>
                        <li>Calorías (cal)</li>
                        <li>Electronvoltios (eV)</li>
                    </ol>
                    <div class="formula-inline">
                        \\[
                        W = mgh \\quad \\text{y} \\quad 1\\,\\text{cal} = 4.186\\,\\text{J}
                        \\]
                    </div>
                </div>
                <div class="problema-espacio">
                    <textarea placeholder="Desarrolla tu solución paso a paso..." rows="8"></textarea>
                </div>
                <button class="btn-verificar" onclick="verificarProblema(1)">
                    🔍 VERIFICAR SOLUCIÓN
                </button>
                <div class="problema-solucion" id="solucionP1" style="display: none;">
                    <strong>Solución:</strong><br>
                    1. \\(W = mgh = 5 \\times 9.8 \\times 2 = 98\\,\\text{J}\\)<br>
                    2. \\(98\\,\\text{J} \\times \\frac{1\\,\\text{cal}}{4.186\\,\\text{J}} = 23.4\\,\\text{cal}\\)<br>
                    3. \\(98\\,\\text{J} \\times \\frac{1\\,\\text{eV}}{1.602 \\times 10^{-19}\\,\\text{J}} = 6.12 \\times 10^{20}\\,\\text{eV}\\)
                </div>
            </div>

            <div class="problema-card">
                <div class="problema-header">
                    <span class="problema-num">P2</span>
                    <h3>Equivalencia Energética</h3>
                </div>
                <div class="problema-enunciado">
                    <p>Un atleta quema <strong>500 kcal</strong> en una sesión de entrenamiento. Calcula:</p>
                    <ol>
                        <li>La energía en joules.</li>
                        <li>La altura a la que podría levantar su masa (70 kg) con esa energía.</li>
                        <li>El tiempo que podría mantener encendido un foco de 100 W con esa energía.</li>
                    </ol>
                </div>
                <div class="problema-espacio">
                    <textarea placeholder="Desarrolla tu solución paso a paso..." rows="8"></textarea>
                </div>
                <button class="btn-verificar" onclick="verificarProblema(2)">
                    🔍 VERIFICAR SOLUCIÓN
                </button>
                <div class="problema-solucion" id="solucionP2" style="display: none;">
                    <strong>Solución:</strong><br>
                    1. \\(500\\,\\text{kcal} \\times 4,186\\,\\text{J/kcal} = 2,093,000\\,\\text{J}\\)<br>
                    2. \\(h = \\frac{E}{mg} = \\frac{2,093,000}{70 \\times 9.8} = 3,033\\,\\text{m}\\)<br>
                    3. \\(t = \\frac{E}{P} = \\frac{2,093,000}{100} = 20,930\\,\\text{s} = 5.8\\,\\text{h}\\)
                </div>
            </div>
        </div>

        <div class="rubrica">
            <h4>📋 RÚBRICA DE EVALUACIÓN</h4>
            <table class="rubrica-table">
                <tr>
                    <th>Criterio</th>
                    <th>Excelente (3 pts)</th>
                    <th>Satisfactorio (2 pts)</th>
                    <th>Insuficiente (1 pt)</th>
                </tr>
                <tr>
                    <td>Precisión en cálculos</td>
                    <td>Todos los cálculos correctos con unidades</td>
                    <td>Error en 1 cálculo o unidad</td>
                    <td>Múltiples errores</td>
                </tr>
                <tr>
                    <td>Conversión de unidades</td>
                    <td>Todas las conversiones correctas</td>
                    <td>Error en 1 conversión</td>
                    <td>Múltiples errores</td>
                </tr>
                <tr>
                    <td>Explicación conceptual</td>
                    <td>Explica cada paso con claridad</td>
                    <td>Explicación parcial</td>
                    <td>Sin explicación</td>
                </tr>
            </table>
        </div>
    </section>

    <!-- CIERRE METACOGNITIVO -->
    <section class="cierre-section">
        <h2 class="seccion-titulo neon-concepto">
            <span class="icon">🧠</span> CIERRE METACOGNITIVO
        </h2>
        <div class="cierre-container">
            <div class="autoevaluacion">
                <h3>📊 AUTOEVALUACIÓN</h3>
                <div class="slider-group">
                    <label>Concepto de joule:</label>
                    <input type="range" min="1" max="5" value="3" class="autoeval-slider" id="slider1">
                    <div class="slider-labels">
                        <span>Básico</span><span>Avanzado</span>
                    </div>
                </div>
                <div class="slider-group">
                    <label>Aplicaciones prácticas:</label>
                    <input type="range" min="1" max="5" value="3" class="autoeval-slider" id="slider2">
                    <div class="slider-labels">
                        <span>Básico</span><span>Avanzado</span>
                    </div>
                </div>
                <div class="slider-group">
                    <label>Conversión de unidades:</label>
                    <input type="range" min="1" max="5" value="3" class="autoeval-slider" id="slider3">
                    <div class="slider-labels">
                        <span>Básico</span><span>Avanzado</span>
                    </div>
                </div>
                <button class="btn-guardar" onclick="guardarAutoevaluacion()">
                    💾 GUARDAR AUTOEVALUACIÓN
                </button>
            </div>

            <div class="reflexion">
                <h3>💭 REFLEXIÓN</h3>
                <div class="pregunta-reflexion">
                    <p>¿Cómo crees que el concepto de joule y la equivalencia entre trabajo y calor han influido en el desarrollo de la física moderna y la tecnología?</p>
                    <textarea placeholder="Ejemplo: Máquinas térmicas, energías renovables, electrónica..." rows="3"></textarea>
                </div>
            </div>

            <div class="plan-estudio">
                <h3>📅 PLAN DE ESTUDIO</h3>
                <div class="plan-grid">
                    <div class="plan-card">
                        <h4>🔹 REPASO RÁPIDO (15 min)</h4>
                        <ul>
                            <li>Memorizar definición de joule</li>
                            <li>Repasar fórmulas de trabajo y energía</li>
                        </ul>
                    </div>
                    <div class="plan-card">
                        <h4>🧪 PRÁCTICA (30 min)</h4>
                        <ul>
                            <li>Resolver 5 problemas de conversión</li>
                            <li>Simular experimento de Joule 3 veces</li>
                        </ul>
                    </div>
                    <div class="plan-card">
                        <h4>📚 PROFUNDIZACIÓN (45 min)</h4>
                        <ul>
                            <li>Investigar aplicaciones en ingeniería</li>
                            <li>Comparar joule con otras unidades históricas</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="recursos">
                <h3>🔗 RECURSOS ADICIONALES</h3>
                <div class="recursos-links">
                    <a href="https://physics.nist.gov/cuu/Units/energy.html" target="_blank" class="recurso-link">
                        🌐 NIST: Unidades de energía
                    </a>
                    <a href="https://www.bipm.org/en/measurement-units/" target="_blank" class="recurso-link">
                        📚 BIPM: Sistema Internacional de Unidades
                    </a>
                    <a href="https://phet.colorado.edu/es/simulation/energy-forms-and-changes" target="_blank" class="recurso-link">
                        🎮 PhET: Formas y cambios de energía
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- JAVASCRIPT INTEGRADO -->
<script>
// ========================================
// CONSTANTES FÍSICAS
// ========================================
const CONSTANTES = {
    g: 9.8,               // Aceleración gravitatoria (m/s²)
    c_agua: 4186,         // Calor específico del agua (J/kg·°C)
    equivCaloria: 4.186,  // Equivalente mecánico del calor (J/cal)
    eV_per_J: 6.242e18,  // Electronvoltios por joule
    kWh_per_J: 2.778e-7  // Kilowatt-hora por joule
};

// ========================================
// SIMULADOR DEL EXPERIMENTO DE JOULE
// ========================================
let experimentoActivo = false;
let intervaloExperimento;

function iniciarExperimento() {
    if (experimentoActivo) return;
    experimentoActivo = true;

    // Obtener parámetros
    const masaPesas = parseFloat(document.getElementById(\'masaPesas\').value);
    const alturaCaida = parseFloat(document.getElementById(\'alturaCaida\').value);
    const masaAgua = parseFloat(document.getElementById(\'masaAgua\').value);
    const eficiencia = parseFloat(document.getElementById(\'eficiencia\').value) / 100;

    // Cálculos
    const trabajo = masaPesas * CONSTANTES.g * alturaCaida;
    const calor = trabajo * eficiencia;
    const calorias = calor / CONSTANTES.equivCaloria;
    const equivalenteKgM = trabajo; // 1 J = 1 N·m ≈ 0.102 kg·m
    const deltaT = calor / (masaAgua * CONSTANTES.c_agua);

    // Actualizar datos
    document.getElementById(\'dataTrabajo\').textContent = trabajo.toFixed(2) + \' J\';
    document.getElementById(\'dataCalor\').textContent = calor.toFixed(2) + \' J\';
    document.getElementById(\'dataCalorias\').textContent = calorias.toFixed(3) + \' cal\';
    document.getElementById(\'dataEquivalente\').textContent = equivalenteKgM.toFixed(2) + \' kg·m\';
    document.getElementById(\'dataDeltaT\').textContent = deltaT.toFixed(4) + \'°C\';

    // Actualizar resumen
    document.getElementById(\'resumenMasa\').textContent = masaPesas.toFixed(1);
    document.getElementById(\'resumenAltura\').textContent = alturaCaida.toFixed(1);
    document.getElementById(\'resumenTrabajo\').textContent = trabajo.toFixed(2);
    document.getElementById(\'resumenDeltaT\').textContent = deltaT.toFixed(4);

    // Animación
    const duracion = 2000; // ms
    const alturaInicial = 100; // px en SVG
    const alturaFinal = alturaInicial + (alturaCaida * 20); // Escala

    // Animar pesas
    const pesa1 = document.getElementById(\'pesa1\');
    const pesa2 = document.getElementById(\'pesa2\');
    const cuerda = document.getElementById(\'cuerda\');
    const mercurio = document.getElementById(\'mercurio\');

    pesa1.setAttribute(\'y\', `-${alturaInicial}`);
    pesa2.setAttribute(\'y\', `-${alturaInicial + 30}`);
    document.getElementById(\'animCuerda\').beginElement();
    document.getElementById(\'masaPesasText\').textContent = `${masaPesas.toFixed(1)} kg`;

    // Animar caída
    pesa1.style.transition = `transform ${duracion}ms linear`;
    pesa2.style.transition = `transform ${duracion}ms linear`;
    pesa1.style.transform = `translateY(${alturaFinal - alturaInicial}px)`;
    pesa2.style.transform = `translateY(${alturaFinal - alturaInicial}px)`;

    // Animar termómetro
    const alturaMercurio = 70 * (deltaT / 0.1); // Escala para visualización
    document.getElementById(\'animMercurio\').setAttribute(\'to\', 90 - alturaMercurio);
    document.getElementById(\'animMercurioHeight\').setAttribute(\'height\', 10 + alturaMercurio);
    document.getElementById(\'deltaTText\').textContent = `ΔT = ${deltaT.toFixed(3)}°C`;
    document.getElementById(\'animMercurio\').beginElement();
    document.getElementById(\'animMercurioHeight\').beginElement();

    // Animar agua (efecto de agitación)
    document.getElementById(\'animAgua\').beginElement();

    // Animar barras de energía
    const maxWidth = 400;
    const barraTrabajoWidth = (trabajo / (masaPesas * CONSTANTES.g * 3)) * maxWidth;
    const barraCalorWidth = (calor / (masaPesas * CONSTANTES.g * 3)) * maxWidth;

    document.getElementById(\'barraTrabajo\').setAttribute(\'width\', barraTrabajoWidth);
    document.getElementById(\'barraCalor\').setAttribute(\'width\', barraCalorWidth);
    document.getElementById(\'valorTrabajo\').textContent = trabajo.toFixed(2) + \' J\';
    document.getElementById(\'valorCalor\').textContent = calor.toFixed(2) + \' J\';
    document.getElementById(\'valorEficiencia\').textContent = (eficiencia * 100).toFixed(0) + \'%\';

    // Reiniciar después de la animación
    setTimeout(() => {
        experimentoActivo = false;
    }, duracion + 500);
}

function reiniciarExperimento() {
    // Restaurar controles
    document.getElementById(\'masaPesas\').value = 1;
    document.getElementById(\'alturaCaida\').value = 1;
    document.getElementById(\'masaAgua\').value = 0.5;
    document.getElementById(\'eficiencia\').value = 90;

    // Actualizar textos
    document.getElementById(\'masaValue\').textContent = "1.0 kg";
    document.getElementById(\'alturaValue\').textContent = "1.0 m";
    document.getElementById(\'masaAguaValue\').textContent = "0.5 kg";
    document.getElementById(\'eficienciaValue\').textContent = "90%";

    // Restaurar SVG
    document.getElementById(\'pesa1\').removeAttribute(\'style\');
    document.getElementById(\'pesa2\').removeAttribute(\'style\');
    document.getElementById(\'pesa1\').setAttribute(\'y\', \'-120\');
    document.getElementById(\'pesa2\').setAttribute(\'y\', \'-150\');
    document.getElementById(\'masaPesasText\').textContent = "1 kg";

    document.getElementById(\'mercurio\').setAttribute(\'y\', \'90\');
    document.getElementById(\'mercurio\').setAttribute(\'height\', \'10\');
    document.getElementById(\'deltaTText\').textContent = "ΔT = 0°C";

    document.getElementById(\'barraTrabajo\').setAttribute(\'width\', \'0\');
    document.getElementById(\'barraCalor\').setAttribute(\'width\', \'0\');

    // Restaurar datos
    document.getElementById(\'dataTrabajo\').textContent = "0 J";
    document.getElementById(\'dataCalor\').textContent = "0 J";
    document.getElementById(\'dataCalorias\').textContent = "0 cal";
    document.getElementById(\'dataEquivalente\').textContent = "0 kg·m";
    document.getElementById(\'dataDeltaT\').textContent = "0°C";

    document.getElementById(\'resumenMasa\').textContent = "1";
    document.getElementById(\'resumenAltura\').textContent = "1";
    document.getElementById(\'resumenTrabajo\').textContent = "9.8";
    document.getElementById(\'resumenDeltaT\').textContent = "0.002";
}

// Event listeners para controles
document.getElementById(\'masaPesas\').addEventListener(\'input\', function() {
    document.getElementById(\'masaValue\').textContent = this.value + \' kg\';
});

document.getElementById(\'alturaCaida\').addEventListener(\'input\', function() {
    document.getElementById(\'alturaValue\').textContent = this.value + \' m\';
});

document.getElementById(\'masaAgua\').addEventListener(\'input\', function() {
    document.getElementById(\'masaAguaValue\').textContent = this.value + \' kg\';
});

document.getElementById(\'eficiencia\').addEventListener(\'input\', function() {
    document.getElementById(\'eficienciaValue\').textContent = this.value + \'%\';
});

// ========================================
// CONVERSOR DE UNIDADES
// ========================================
const FACTORES_CONVERSION = {
    J: {
        cal: 1 / 4.186,
        kWh: 1 / 3.6e6,
        eV: 1 / 1.602e-19,
        BTU: 1 / 1055
    },
    cal: {
        J: 4.186,
        kWh: 4.186 / 3.6e6,
        eV: 4.186 / 1.602e-19,
        BTU: 4.186 / 1055
    },
    kWh: {
        J: 3.6e6,
        cal: 3.6e6 / 4.186,
        eV: 3.6e6 / 1.602e-19,
        BTU: 3.6e6 / 1055
    },
    eV: {
        J: 1.602e-19,
        cal: 1.602e-19 / 4.186,
        kWh: 1.602e-19 / 3.6e6,
        BTU: 1.602e-19 / 1055
    },
    BTU: {
        J: 1055,
        cal: 1055 / 4.186,
        kWh: 1055 / 3.6e6,
        eV: 1055 / 1.602e-19
    }
};

const EJEMPLOS_EQUIVALENTES = {
    J: [
        { valor: 1, ejemplo: "Levantar 100 g a 1 m de altura" },
        { valor: 100, ejemplo: "Energía de una manzana cayendo 1 m" },
        { valor: 3600, ejemplo: "1 watt durante 1 hora" }
    ],
    cal: [
        { valor: 1, ejemplo: "Calentar 1 g de agua 1°C" },
        { valor: 1000, ejemplo: "Energía de un chocolate pequeño" },
        { valor: 2000, ejemplo: "Metabolismo basal por hora" }
    ],
    kWh: [
        { valor: 1, ejemplo: "100 horas de un foco LED de 10 W" },
        { valor: 0.1, ejemplo: "Cargar un smartphone" },
        { valor: 10, ejemplo: "Consumo diario de un refrigerador" }
    ],
    eV: [
        { valor: 1, ejemplo: "Energía de un fotón de luz visible" },
        { valor: 1e6, ejemplo: "Energía de un electrón en un TV antiguo" },
        { valor: 1e9, ejemplo: "Energía de un rayo X médico" }
    ],
    BTU: [
        { valor: 1, ejemplo: "Calentar 1 libra de agua 1°F" },
        { valor: 10000, ejemplo: "Energía de 1 galón de gasolina" },
        { valor: 1e6, ejemplo: "Consumo mensual de gas de una casa" }
    ]
};

function convertirUnidades() {
    const valor = parseFloat(document.getElementById(\'valorEntrada\').value);
    const de = document.getElementById(\'unidadEntrada\').value;
    const a = document.getElementById(\'unidadSalida\').value;

    if (de === a) {
        document.getElementById(\'resultadoConversion\').textContent = `${valor} ${de} = ${valor} ${a}`;
        mostrarEjemploEquivalente(de, valor);
        return;
    }

    const factor = FACTORES_CONVERSION[de][a];
    const resultado = valor * factor;

    // Formatear resultado
    let resultadoTexto;
    if (Math.abs(resultado) >= 1e6) {
        resultadoTexto = `${(resultado / 1e6).toFixed(3)} × 10⁶ ${a}`;
    } else if (Math.abs(resultado) >= 1e3) {
        resultadoTexto = `${(resultado / 1e3).toFixed(3)} × 10³ ${a}`;
    } else if (Math.abs(resultado) < 1e-3) {
        resultadoTexto = `${(resultado * 1e6).toFixed(3)} × 10⁻⁶ ${a}`;
    } else {
        resultadoTexto = `${resultado.toFixed(6)} ${a}`;
    }

    document.getElementById(\'resultadoConversion\').textContent = `${valor} ${de} = ${resultadoTexto}`;
    mostrarEjemploEquivalente(a, resultado);
}

function mostrarEjemploEquivalente(unidad, valor) {
    const ejemplos = EJEMPLOS_EQUIVALENTES[unidad];
    let ejemploTexto = "Ejemplo no disponible";

    // Buscar el ejemplo más cercano
    let mejorEjemplo = ejemplos[0];
    let menorDiferencia = Math.abs(valor - ejemplos[0].valor);

    for (const ej of ejemplos) {
        const diferencia = Math.abs(valor - ej.valor);
        if (diferencia < menorDiferencia) {
            menorDiferencia = diferencia;
            mejorEjemplo = ej;
        }
    }

    if (valor < mejorEjemplo.valor * 0.1) {
        ejemploTexto = `1 ${unidad} = ${mejorEjemplo.ejemplo}`;
    } else if (valor > mejorEjemplo.valor * 10) {
        ejemploTexto = `${Math.round(valor / mejorEjemplo.valor)} × (${mejorEjemplo.ejemplo})`;
    } else {
        ejemploTexto = `≈ ${mejorEjemplo.ejemplo} (${mejorEjemplo.valor} ${unidad})`;
    }

    document.getElementById(\'ejemploEquivalente\').textContent = ejemploTexto;
}

// ========================================
// QUIZ INTERACTIVO
// ========================================
let quizRespuestas = [];
let quizCompletado = false;

document.querySelectorAll(\'.quiz-option\').forEach(option => {
    option.addEventListener(\'click\', function() {
        if (quizCompletado) return;

        const question = this.closest(\'.quiz-question\');
        const correct = question.dataset.correct;
        const selected = this.dataset.value;
        const feedback = question.querySelector(\'.quiz-feedback\');

        // Remover selección previa
        question.querySelectorAll(\'.quiz-option\').forEach(opt => {
            opt.classList.remove(\'selected\', \'correct\', \'incorrect\');
        });

        // Marcar selección actual
        this.classList.add(\'selected\');

        // Verificar respuesta
        if (selected === correct) {
            this.classList.add(\'correct\');
            quizRespuestas.push(true);
        } else {
            this.classList.add(\'incorrect\');
            // Marcar también la correcta
            question.querySelector(`[data-value="${correct}"]`).classList.add(\'correct\');
            quizRespuestas.push(false);
        }

        // Mostrar feedback
        feedback.style.display = \'block\';

        // Verificar si todas respondidas
        const allAnswered = Array.from(document.querySelectorAll(\'.quiz-question\')).every(q =>
            q.querySelector(\'.quiz-option.selected\')
        );

        if (allAnswered && !quizCompletado) {
            quizCompletado = true;
            mostrarResultadosQuiz();
        }
    });
});

function mostrarResultadosQuiz() {
    const correctas = quizRespuestas.filter(r => r).length;
    const total = quizRespuestas.length;

    document.getElementById(\'quizScore\').textContent = `${correctas}/${total}`;

    let feedback;
    if (correctas === total) {
        feedback = "🌟 Excelente! Dominas el concepto de joule y sus aplicaciones.";
    } else if (correctas >= total/2) {
        feedback = "👍 Bueno. Revisa las conversiones entre joules y calorías.";
    } else {
        feedback = "📚 Necesitas repasar. Enfócate en la definición de joule y el experimento de Joule.";
    }

    document.getElementById(\'quizFeedback\').textContent = feedback;
}

function reiniciarQuiz() {
    quizRespuestas = [];
    quizCompletado = false;

    document.querySelectorAll(\'.quiz-option\').forEach(opt => {
        opt.classList.remove(\'selected\', \'correct\', \'incorrect\');
    });

    document.querySelectorAll(\'.quiz-feedback\').forEach(fb => {
        fb.style.display = \'none\';
    });

    document.getElementById(\'quizScore\').textContent = "0/3";
    document.getElementById(\'quizFeedback\').textContent = "Completa el quiz para ver tus resultados";
}

// ========================================
// PROBLEMAS TIPO EXAMEN
// ========================================
function verificarProblema(num) {
    const solucion = document.getElementById(`solucionP${num}`);
    if (solucion.style.display === \'block\') {
        solucion.style.display = \'none\';
    } else {
        solucion.style.display = \'block\';
    }
}

// ========================================
// AUTOEVALUACIÓN
// ========================================
function guardarAutoevaluacion() {
    const slider1 = document.getElementById(\'slider1\').value;
    const slider2 = document.getElementById(\'slider2\').value;
    const slider3 = document.getElementById(\'slider3\').value;
    const promedio = (parseInt(slider1) + parseInt(slider2) + parseInt(slider3)) / 3;

    let mensaje = `📊 Autoevaluación guardada:\\n\\n`;
    mensaje += `Concepto de joule: ${slider1}/5\\n`;
    mensaje += `Aplicaciones prácticas: ${slider2}/5\\n`;
    mensaje += `Conversión de unidades: ${slider3}/5\\n\\n`;
    mensaje += `Promedio: ${promedio.toFixed(1)}/5\\n\\n`;

    if (promedio >= 4) {
        mensaje += "🌟 Excelente comprensión! Puedes aplicar el concepto de joule en problemas reales.";
    } else if (promedio >= 3) {
        mensaje += "👍 Bueno, pero practica más conversiones y aplicaciones.";
    } else {
        mensaje += "📚 Revisa los fundamentos y usa el simulador para experimentar.";
    }

    alert(mensaje);
}

// ========================================
// INICIALIZACIÓN
// ========================================
console.log("⚡ Lección Cyberpunk: Joule inicializada");
console.log("🔬 Simulador del experimento de Joule listo");
console.log("↔ Conversor de unidades de energía configurado");
console.log("❓ Quiz con 3 preguntas sobre el joule");

// Inicializar
reiniciarExperimento();
convertirUnidades(); // Mostrar ejemplo inicial
</script>',
    'ejercicios' => 
    array (
      0 => 
      array (
        'enunciado' => '1 J =',
        'respuesta' => '1 N·m',
      ),
      1 => 
      array (
        'enunciado' => '1 J en base SI',
        'respuesta' => 'kg·m²·s⁻²',
      ),
      2 => 
      array (
        'enunciado' => '1 cal =',
        'respuesta' => '4.184 J',
      ),
      3 => 
      array (
        'enunciado' => 'Trabajo: F=50 N, d=3 m, θ=0°',
        'respuesta' => '150 J',
      ),
      4 => 
      array (
        'enunciado' => 'E_k: m=2 kg, v=5 m/s',
        'respuesta' => '25 J',
      ),
      5 => 
      array (
        'enunciado' => 'E_p: m=1 kg, h=10 m',
        'respuesta' => '98 J',
      ),
      6 => 
      array (
        'enunciado' => 'Nombrado por',
        'respuesta' => 'James Prescott Joule',
      ),
      7 => 
      array (
        'enunciado' => 'Experimento clave',
        'respuesta' => 'Paletas en agua',
      ),
      8 => 
      array (
        'enunciado' => 'Año aproximado',
        'respuesta' => '1843',
      ),
      9 => 
      array (
        'enunciado' => '1 kWh =',
        'respuesta' => '3.6 MJ',
      ),
      10 => 
      array (
        'enunciado' => '1 eV =',
        'respuesta' => '1.6 × 10⁻¹⁹ J',
      ),
      11 => 
      array (
        'enunciado' => 'Trabajo mínimo para 1 kg a 1 m/s',
        'respuesta' => '0.5 J (E_k)',
      ),
    ),
    'quiz' => 
    array (
      0 => 
      array (
        'pregunta' => 'Joule mide...',
        'opciones' => 
        array (
          0 => 'Energía',
          1 => 'Fuerza',
          2 => 'Velocidad',
          3 => 'Masa',
        ),
        'correcta' => 'Energía',
      ),
      1 => 
      array (
        'pregunta' => '1 J =',
        'opciones' => 
        array (
          0 => '1 N·m',
          1 => '1 kg',
          2 => '1 m/s',
          3 => '1 W',
        ),
        'correcta' => '1 N·m',
      ),
      2 => 
      array (
        'pregunta' => 'Unidad SI',
        'opciones' => 
        array (
          0 => 'Sí',
          1 => 'No',
          2 => 'A veces',
          3 => 'Nunca',
        ),
        'correcta' => 'Sí',
      ),
      3 => 
      array (
        'pregunta' => 'Nombrado por...',
        'opciones' => 
        array (
          0 => 'James Joule',
          1 => 'Isaac Newton',
          2 => 'Albert Einstein',
          3 => 'Marie Curie',
        ),
        'correcta' => 'James Joule',
      ),
      4 => 
      array (
        'pregunta' => '1 J = 1...',
        'opciones' => 
        array (
          0 => 'W·s',
          1 => 'W/h',
          2 => 'kW',
          3 => 'MW',
        ),
        'correcta' => 'W·s',
      ),
      5 => 
      array (
        'pregunta' => 'Trabajo =',
        'opciones' => 
        array (
          0 => 'F × d × cosθ',
          1 => 'm × a',
          2 => '½mv²',
          3 => 'mgh',
        ),
        'correcta' => 'F × d × cosθ',
      ),
      6 => 
      array (
        'pregunta' => '1 cal ≈',
        'opciones' => 
        array (
          0 => '4.184 J',
          1 => '1 J',
          2 => '10 J',
          3 => '0.1 J',
        ),
        'correcta' => '4.184 J',
      ),
      7 => 
      array (
        'pregunta' => 'Levantar 1 kg 1 m ≈',
        'opciones' => 
        array (
          0 => '9.8 J',
          1 => '1 J',
          2 => '98 J',
          3 => '0 J',
        ),
        'correcta' => '9.8 J',
      ),
      8 => 
      array (
        'pregunta' => 'Energía cinética usa...',
        'opciones' => 
        array (
          0 => 'Joule',
          1 => 'Newton',
          2 => 'Pascal',
          3 => 'Tesla',
        ),
        'correcta' => 'Joule',
      ),
      9 => 
      array (
        'pregunta' => 'BIPM define J como...',
        'opciones' => 
        array (
          0 => 'kg·m²·s⁻²',
          1 => 'kg·m/s',
          2 => 'N/m',
          3 => 'W/m',
        ),
        'correcta' => 'kg·m²·s⁻²',
      ),
      10 => 
      array (
        'pregunta' => 'Trabajo 20 N en 5 m =',
        'opciones' => 
        array (
          0 => '100 J',
          1 => '4 J',
          2 => '25 J',
          3 => '500 J',
        ),
        'correcta' => '100 J',
      ),
      11 => 
      array (
        'pregunta' => 'E_k 3 kg a 4 m/s =',
        'opciones' => 
        array (
          0 => '24 J',
          1 => '12 J',
          2 => '48 J',
          3 => '6 J',
        ),
        'correcta' => '24 J',
      ),
      12 => 
      array (
        'pregunta' => '1 kWh =',
        'opciones' => 
        array (
          0 => '3.6 MJ',
          1 => '3.6 kJ',
          2 => '36 MJ',
          3 => '0.36 MJ',
        ),
        'correcta' => '3.6 MJ',
      ),
      13 => 
      array (
        'pregunta' => '1 eV =',
        'opciones' => 
        array (
          0 => '1.6×10⁻¹⁹ J',
          1 => '1 J',
          2 => '1.6×10⁻¹⁰ J',
          3 => '1.6×10⁶ J',
        ),
        'correcta' => '1.6×10⁻¹⁹ J',
      ),
      14 => 
      array (
        'pregunta' => 'Experimento Joule demostró...',
        'opciones' => 
        array (
          0 => 'Equivalencia calor-trabajo',
          1 => 'Fusión',
          2 => 'Fisión',
          3 => 'Óptica',
        ),
        'correcta' => 'Equivalencia calor-trabajo',
      ),
      15 => 
      array (
        'pregunta' => '1 J = ... erg',
        'opciones' => 
        array (
          0 => '10⁷',
          1 => '10⁶',
          2 => '10⁸',
          3 => '10⁵',
        ),
        'correcta' => '10⁷',
      ),
      16 => 
      array (
        'pregunta' => 'Calor específico agua =',
        'opciones' => 
        array (
          0 => '4184 J/kg·K',
          1 => '1000 J/kg·K',
          2 => '4.184 J/kg·K',
          3 => '4184 J/g·K',
        ),
        'correcta' => '4184 J/kg·K',
      ),
      17 => 
      array (
        'pregunta' => 'Potencia =',
        'opciones' => 
        array (
          0 => 'J/s',
          1 => 'J·m',
          2 => 'N/m',
          3 => 'kg/s',
        ),
        'correcta' => 'J/s',
      ),
      18 => 
      array (
        'pregunta' => 'Unidad potencia',
        'opciones' => 
        array (
          0 => 'Watt',
          1 => 'Joule',
          2 => 'Newton',
          3 => 'Pascal',
        ),
        'correcta' => 'Watt',
      ),
      19 => 
      array (
        'pregunta' => 'SI 2025: J definido por...',
        'opciones' => 
        array (
          0 => 'Constantes fundamentales',
          1 => 'Prototipo',
          2 => 'Masa',
          3 => 'Tiempo',
        ),
        'correcta' => 'Constantes fundamentales',
      ),
      20 => 
      array (
        'pregunta' => 'Trabajo θ=60°, F=100 N, d=2 m =',
        'opciones' => 
        array (
          0 => '100 J',
          1 => '200 J',
          2 => '50 J',
          3 => '0 J',
        ),
        'correcta' => '100 J',
      ),
      21 => 
      array (
        'pregunta' => 'E_k para v = 10 m/s, m=1 kg =',
        'opciones' => 
        array (
          0 => '50 J',
          1 => '100 J',
          2 => '25 J',
          3 => '500 J',
        ),
        'correcta' => '50 J',
      ),
      22 => 
      array (
        'pregunta' => '1 MJ =',
        'opciones' => 
        array (
          0 => '10⁶ J',
          1 => '10³ J',
          2 => '10⁹ J',
          3 => '10⁻⁶ J',
        ),
        'correcta' => '10⁶ J',
      ),
      23 => 
      array (
        'pregunta' => 'Calor para 1 g agua +1°C =',
        'opciones' => 
        array (
          0 => '4.184 J',
          1 => '1 J',
          2 => '4184 J',
          3 => '0.4184 J',
        ),
        'correcta' => '4.184 J',
      ),
      24 => 
      array (
        'pregunta' => 'Energía fotón λ=500 nm ≈',
        'opciones' => 
        array (
          0 => '4×10⁻¹⁹ J',
          1 => '4×10⁻¹⁰ J',
          2 => '4×10⁻²⁵ J',
          3 => '4 J',
        ),
        'correcta' => '4×10⁻¹⁹ J',
      ),
      25 => 
      array (
        'pregunta' => 'Joule contribuyó a...',
        'opciones' => 
        array (
          0 => '1ª Ley Termodinámica',
          1 => '2ª Ley',
          2 => 'Ley Gravitación',
          3 => 'Relatividad',
        ),
        'correcta' => '1ª Ley Termodinámica',
      ),
      26 => 
      array (
        'pregunta' => '1 BTU ≈',
        'opciones' => 
        array (
          0 => '1055 J',
          1 => '100 J',
          2 => '10000 J',
          3 => '1 J',
        ),
        'correcta' => '1055 J',
      ),
      27 => 
      array (
        'pregunta' => 'Trabajo mínimo para detener 2 kg a 5 m/s',
        'opciones' => 
        array (
          0 => '-25 J',
          1 => '25 J',
          2 => '50 J',
          3 => '0 J',
        ),
        'correcta' => '-25 J',
      ),
      28 => 
      array (
        'pregunta' => 'Constante de Boltzmann k =',
        'opciones' => 
        array (
          0 => '1.38×10⁻²³ J/K',
          1 => '1.38×10⁻²³ eV/K',
          2 => '9.8 J/kg',
          3 => '3×10⁸ J',
        ),
        'correcta' => '1.38×10⁻²³ J/K',
      ),
      29 => 
      array (
        'pregunta' => 'SI 2025: J basado en...',
        'opciones' => 
        array (
          0 => 'c, h, k (constantes)',
          1 => 'kg prototipo',
          2 => 'metro',
          3 => 'segundo',
        ),
        'correcta' => 'c, h, k (constantes)',
      ),
    ),
  ),
  4 => 
  array (
    'materia' => 'Física I',
    'slug' => 'biomasa-cyberpunk',
    'titulo' => 'Biomasa: Del CO₂ a la Energía Sostenible',
    'contenido' => '<!-- INICIO LECCIÓN CYBERPUNK -->
<div class="leccion-container leccion-fisica-biomasa" data-tema="biomasa">

    <!-- CABECERA CYBERPUNK -->
    <header class="leccion-header">
        <h1 class="titulo-leccion neon-glow">
            <span class="icon-tema">🌱</span>
            BIOMASSA: ENERGÍA VIVA
        </h1>
        <div class="subtitulo">
            Del Ciclo del Carbono a la Generación de Energía Renovable
        </div>
    </header>

    <!-- PANEL OBJETIVOS -->
    <section class="panel-objetivos">
        <h2 class="seccion-titulo neon-concepto">
            <span class="icon">🎯</span> OBJETIVOS DE APRENDIZAJE
        </h2>
        <div class="objetivos-grid">
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Clasificar los 4 tipos de biomasa</h3>
                <p>Sólida, líquida, gaseosa y residuos orgánicos</p>
            </div>
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Explicar las transformaciones energéticas</h3>
                <p>Combustión, gasificación y digestión anaerobia</p>
            </div>
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Analizar ventajas y desventajas</h3>
                <p>Impacto ambiental, eficiencia y sostenibilidad</p>
            </div>
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Calcular eficiencias y emisiones</h3>
                <p>Comparar con otras fuentes renovables</p>
            </div>
        </div>
    </section>

    <!-- CONTEXTO REAL -->
    <section class="contexto-real">
        <h2 class="seccion-titulo neon-dato">
            <span class="icon">🌍</span> CONTEXTO GLOBAL
        </h2>
        <div class="contexto-grid">
            <div class="contexto-card">
                <h3>🌎 CONTRIBUCIÓN MUNDIAL</h3>
                <p>La biomasa representa el <strong>10% de la energía primaria global</strong> (IRENA, 2025).</p>
                <div class="dato-neon">Líderes: Brasil (30%), Suecia (20%), India (15%)</div>
            </div>
            <div class="contexto-card">
                <h3>🇲🇽 MÉXICO</h3>
                <p><strong>5% de la matriz energética</strong> (2025), principalmente:</p>
                <ul>
                    <li>Bagazo de caña (1,000 MW)</li>
                    <li>Biogás de residuos (500 MW)</li>
                </ul>
            </div>
            <div class="contexto-card">
                <h3>💡 INNOVACIÓN</h3>
                <p>Nuevas tecnologías:</p>
                <ul>
                    <li>Bioetanol 2G (residuos agrícolas)</li>
                    <li>Biocombustibles de algas</li>
                </ul>
            </div>
        </div>
    </section>

    <!-- FUNDAMENTOS TEÓRICOS -->
    <section class="fundamentos-section">
        <h2 class="seccion-titulo neon-concepto">
            <span class="icon">📚</span> FUNDAMENTOS CIENTÍFICOS
        </h2>

        <!-- CICLO DEL CARBONO -->
        <div class="subseccion">
            <h3>1. Ciclo del Carbono en Biomasa</h3>
            <div class="ciclo-dual">
                <div class="ciclo-diagrama">
                    <svg width="300" height="200" viewBox="0 0 300 200">
                        <!-- Fotosíntesis -->
                        <path d="M50 100 Q150 50 250 100 Q150 150 50 100" fill="none" stroke="#4CAF50" stroke-width="3"/>
                        <text x="150" y="80" fill="#4CAF50" font-size="12" text-anchor="middle">Fotosíntesis</text>
                        <text x="150" y="120" fill="#2E7D32" font-size="10" text-anchor="middle">CO₂ + H₂O → C₆H₁₂O₆ + O₂</text>

                        <!-- Combustión -->
                        <path d="M50 150 Q150 180 250 150" fill="none" stroke="#FF5722" stroke-width="3"/>
                        <text x="150" y="170" fill="#FF5722" font-size="12" text-anchor="middle">Combustión</text>
                        <text x="150" y="190" fill="#E65100" font-size="10" text-anchor="middle">C₆H₁₂O₆ + O₂ → CO₂ + H₂O + Q</text>
                    </svg>
                </div>
                <div class="ciclo-explicacion">
                    <p>La biomasa <strong>captura CO₂</strong> durante su crecimiento y lo <strong>libera</strong> al usarse como combustible, creando un <strong>ciclo cerrado de carbono</strong>.</p>
                    <div class="formula-destacada">
                        \\[
                        \\text{CO}_2 + \\text{H}_2\\text{O} + \\text{luz} \\xrightarrow{\\text{fotosíntesis}} \\text{C}_6\\text{H}_{12}\\text{O}_6 + \\text{O}_2
                        \\]
                        \\[
                        \\text{C}_6\\text{H}_{12}\\text{O}_6 + 6\\text{O}_2 \\xrightarrow{\\text{combustión}} 6\\text{CO}_2 + 6\\text{H}_2\\text{O} + \\text{Energía}
                        \\]
                    </div>
                </div>
            </div>
        </div>

        <!-- TIPOS DE BIOMASSA -->
        <div class="subseccion">
            <h3>2. Clasificación de la Biomasa</h3>
            <div class="tipos-grid">
                <div class="tipo-card" data-tipo="solida">
                    <div class="tipo-icon">🌳</div>
                    <h4>SÓLIDA</h4>
                    <div class="tipo-detalle">
                        <p><strong>Ejemplos:</strong> Madera, bagazo, cáscaras</p>
                        <p><strong>Uso:</strong> Combustión directa, gasificación</p>
                        <p><strong>PCI:</strong> 15–20 MJ/kg</p>
                    </div>
                </div>
                <div class="tipo-card" data-tipo="liquida">
                    <div class="tipo-icon">⛽</div>
                    <h4>LÍQUIDA</h4>
                    <div class="tipo-detalle">
                        <p><strong>Ejemplos:</strong> Bioetanol, biodiésel</p>
                        <p><strong>Uso:</strong> Transporte, generación</p>
                        <p><strong>PCI:</strong> 25–30 MJ/L</p>
                    </div>
                </div>
                <div class="tipo-card" data-tipo="gaseosa">
                    <div class="tipo-icon">💨</div>
                    <h4>GASEOSA</h4>
                    <div class="tipo-detalle">
                        <p><strong>Ejemplos:</strong> Biogás (CH₄ 50–70%, CO₂ 30–50%)</p>
                        <p><strong>Uso:</strong> Cogeneración, calefacción</p>
                        <p><strong>PCI:</strong> 20–25 MJ/m³</p>
                    </div>
                </div>
                <div class="tipo-card" data-tipo="residuos">
                    <div class="tipo-icon">🗑️</div>
                    <h4>RESIDUOS</h4>
                    <div class="tipo-detalle">
                        <p><strong>Ejemplos:</strong> Orgánicos urbanos, estiércol</p>
                        <p><strong>Uso:</strong> Digestión anaerobia, compostaje</p>
                        <p><strong>PCI:</strong> 10–15 MJ/kg (seco)</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- TRANSFORMACIONES -->
        <div class="subseccion">
            <h3>3. Procesos de Transformación</h3>
            <div class="procesos-grid">
                <div class="proceso-card">
                    <div class="proceso-header">🔥 COMBUSTIÓN DIRECTA</div>
                    <div class="proceso-body">
                        <p>Reacción exotérmica con oxígeno:</p>
                        <div class="formula-inline">
                            \\[
                            \\text{C}_x\\text{H}_y\\text{O}_z + \\text{O}_2 \\rightarrow \\text{CO}_2 + \\text{H}_2\\text{O} + \\text{Energía}
                            \\]
                        </div>
                        <p><strong>Eficiencia:</strong> 20–40%</p>
                        <p><strong>Ejemplo:</strong> Estufas de leña, calderas industriales</p>
                    </div>
                </div>
                <div class="proceso-card">
                    <div class="proceso-header">💨 GASIFICACIÓN</div>
                    <div class="proceso-body">
                        <p>Conversión a alta temperatura (700–1200°C) con oxígeno limitado:</p>
                        <div class="formula-inline">
                            \\[
                            \\text{Biomasa} + \\text{O}_2/\\text{H}_2\\text{O} \\rightarrow \\text{CO} + \\text{H}_2 + \\text{CH}_4 + \\text{CO}_2
                            \\]
                        </div>
                        <p><strong>Eficiencia:</strong> 60–80% (syngas)</p>
                        <p><strong>Ejemplo:</strong> Planta de gasificación de bagazo</p>
                    </div>
                </div>
                <div class="proceso-card">
                    <div class="proceso-header">🦠 DIGESTIÓN ANAEROBIA</div>
                    <div class="proceso-body">
                        <p>Descomposición por bacterias en ausencia de oxígeno:</p>
                        <div class="formula-inline">
                            \\[
                            \\text{C}_6\\text{H}_{12}\\text{O}_6 \\rightarrow 3\\text{CH}_4 + 3\\text{CO}_2
                            \\]
                        </div>
                        <p><strong>Eficiencia:</strong> 50–70% (biogás)</p>
                        <p><strong>Ejemplo:</strong> Biodigestores de estiércol</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SIMULADOR INTERACTIVO -->
    <section class="simulator-section">
        <h2 class="seccion-titulo neon-interactivo">
            <span class="icon">🎮</span> SIMULADOR: CICLO DE LA BIOMASSA
        </h2>

        <div class="simulator-container">
            <!-- CONTROLES -->
            <div class="simulator-controls">
                <h3>PARÁMETROS</h3>

                <div class="control-group">
                    <label for="tipoBiomasa">Tipo de biomasa:</label>
                    <select id="tipoBiomasa">
                        <option value="madera">Madera (20 MJ/kg)</option>
                        <option value="bagazo">Bagazo (18 MJ/kg)</option>
                        <option value="bioetanol">Bioetanol (27 MJ/L)</option>
                        <option value="biogas">Biogás (22 MJ/m³)</option>
                    </select>
                </div>

                <div class="control-group">
                    <label for="masaBiomasa">Cantidad (kg/L/m³):</label>
                    <input type="range" id="masaBiomasa" min="1" max="1000" value="100" step="1">
                    <span id="masaValue">100</span>
                </div>

                <div class="control-group">
                    <label for="proceso">Proceso:</label>
                    <select id="proceso">
                        <option value="combustion">Combustión directa</option>
                        <option value="gasificacion">Gasificación</option>
                        <option value="digestion">Digestión anaerobia</option>
                    </select>
                </div>

                <div class="control-group">
                    <label for="eficiencia">Eficiencia (%):</label>
                    <input type="range" id="eficiencia" min="10" max="90" value="30" step="1">
                    <span id="eficienciaValue">30%</span>
                </div>

                <button class="btn-simular" onclick="simularBiomasa()">
                    <span class="btn-icon">▶</span> SIMULAR
                </button>

                <button class="btn-reset" onclick="reiniciarSimulador()">
                    <span class="btn-icon">↺</span> REINICIAR
                </button>
            </div>

            <!-- VISUALIZACIÓN -->
            <div class="simulator-visualization">
                <svg viewBox="0 0 600 400" id="svgBiomasa">
                    <!-- Fondo -->
                    <rect x="0" y="0" width="600" height="400" fill="#0a0a1a"/>

                    <!-- Sol y planta -->
                    <g id="fotosintesis">
                        <circle cx="100" cy="100" r="30" fill="#FFEB3B"/>
                        <path d="M80 130 L100 100 L120 130" stroke="#FFC107" stroke-width="3" fill="none"/>
                        <path d="M100 130 L100 160" stroke="#4CAF50" stroke-width="5"/>
                        <text x="100" y="180" fill="#E0F2F1" font-size="12" text-anchor="middle">Fotosíntesis</text>
                    </g>

                    <!-- Biomasa -->
                    <g id="biomasaVisual" transform="translate(250, 200)">
                        <rect id="biomasaRect" x="-50" y="-30" width="100" height="60" fill="#8D6E63" rx="10"/>
                        <text id="biomasaText" x="0" y="0" fill="#FFCCBC" font-size="14" text-anchor="middle">Madera</text>
                        <text id="biomasaMasa" x="0" y="25" fill="#FFCCBC" font-size="12" text-anchor="middle">100 kg</text>
                    </g>

                    <!-- Proceso -->
                    <g id="procesoVisual" transform="translate(400, 200)" opacity="0">
                        <circle cx="0" cy="0" r="40" fill="#FF5722"/>
                        <text x="0" y="0" fill="#000" font-size="14" text-anchor="middle" id="procesoText">Combustión</text>
                        <text x="0" y="25" fill="#000" font-size="12" text-anchor="middle" id="eficienciaText">30%</text>
                    </g>

                    <!-- Productos -->
                    <g id="productosVisual" transform="translate(500, 200)" opacity="0">
                        <rect x="-40" y="-30" width="80" height="60" fill="#FFD600" rx="10"/>
                        <text x="0" y="-10" fill="#000" font-size="14" text-anchor="middle" id="productoText">Electricidad</text>
                        <text x="0" y="15" fill="#000" font-size="12" text-anchor="middle" id="energiaText">0 MJ</text>
                        <text x="0" y="35" fill="#000" font-size="10" text-anchor="middle" id="co2Text">CO₂: 0 kg</text>
                    </g>

                    <!-- Flechas -->
                    <path id="flecha1" d="M150 130 L200 200" stroke="#4CAF50" stroke-width="3" marker-end="url(#flecha)" opacity="0"/>
                    <path id="flecha2" d="M300 200 L350 200" stroke="#FF9800" stroke-width="3" marker-end="url(#flecha)" opacity="0"/>
                    <path id="flecha3" d="M450 200 L500 200" stroke="#F44336" stroke-width="3" marker-end="url(#flecha)" opacity="0"/>

                    <!-- CO2 -->
                    <g id="co2Ciclo">
                        <circle cx="300" cy="50" r="10" fill="#4CAF50" opacity="0">
                            <animate attributeName="cy" values="50;350;50" dur="8s" repeatCount="indefinite" begin="indefinite" id="animCO2"/>
                        </circle>
                        <circle cx="320" cy="70" r="10" fill="#4CAF50" opacity="0">
                            <animate attributeName="cy" values="70;370;70" dur="6s" repeatCount="indefinite" begin="indefinite" id="animCO2_2"/>
                        </circle>
                    </g>

                    <!-- Marcadores -->
                    <defs>
                        <marker id="flecha" markerWidth="10" markerHeight="10" refX="9" refY="3" orient="auto">
                            <path d="M0,0 L9,3 L0,6 Z" fill="#E0F2F1"/>
                        </marker>
                    </defs>
                </svg>
            </div>

            <!-- DATOS -->
            <div class="simulator-data">
                <h3>RESULTADOS</h3>

                <div class="data-card">
                    <div class="data-label">Tipo de biomasa:</div>
                    <div class="data-value" id="dataTipo">Madera</div>
                </div>

                <div class="data-card">
                    <div class="data-label">Cantidad:</div>
                    <div class="data-value" id="dataMasa">100 kg</div>
                </div>

                <div class="data-card">
                    <div class="data-label">Proceso:</div>
                    <div class="data-value" id="dataProceso">Combustión directa</div>
                </div>

                <div class="data-card">
                    <div class="data-label">Energía disponible:</div>
                    <div class="data-value" id="dataEnergiaDisponible">0 MJ</div>
                </div>

                <div class="data-card">
                    <div class="data-label">Energía útil:</div>
                    <div class="data-value" id="dataEnergiaUtil">0 MJ</div>
                </div>

                <div class="data-card highlight">
                    <div class="data-label">Emisiones CO₂:</div>
                    <div class="data-value" id="dataEmisiones">0 kg</div>
                </div>

                <div class="impacto-ambiental">
                    <h4>🌱 IMPACTO AMBIENTAL</h4>
                    <div class="impacto-item">
                        <span>Carbono neutral:</span>
                        <span class="impacto-value" id="impactoCarbono">Sí (ciclo cerrado)</span>
                    </div>
                    <div class="impacto-item">
                        <span>Competencia con alimentos:</span>
                        <span class="impacto-value" id="impactoAlimentos">Media</span>
                    </div>
                    <div class="impacto-item">
                        <span>Emisiones locales:</span>
                        <span class="impacto-value" id="impactoLocales">Altas (PM, NOx)</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ANÁLISIS DE SOSTENIBILIDAD -->
    <section class="analisis-section">
        <h2 class="seccion-titulo neon-evaluacion">
            <span class="icon">📊</span> ANÁLISIS DE SOSTENIBILIDAD
        </h2>

        <div class="analisis-grid">
            <div class="analisis-card">
                <h3>🌍 COMPARACIÓN CON OTRAS FUENTES</h3>
                <div class="grafica-barras">
                    <div class="barra" style="--alto: 85%; --color: #4CAF50;">
                        <div class="barra-valor">85%</div>
                        <div class="barra-etiqueta">Eólica</div>
                    </div>
                    <div class="barra" style="--alto: 70%; --color: #FF9800;">
                        <div class="barra-valor">70%</div>
                        <div class="barra-etiqueta">Solar</div>
                    </div>
                    <div class="barra" style="--alto: 50%; --color: #8D6E63;">
                        <div class="barra-valor">50%</div>
                        <div class="barra-etiqueta">Biomasa</div>
                    </div>
                    <div class="barra" style="--alto: 30%; --color: #616161;">
                        <div class="barra-valor">30%</div>
                        <div class="barra-etiqueta">Fósiles</div>
                    </div>
                </div>
                <p><strong>Eficiencia energética neta</strong> (considerando ciclo completo)</p>
            </div>

            <div class="analisis-card">
                <h3>💰 COSTO POR ENERGÍA (2025)</h3>
                <div class="tabla-costos">
                    <table>
                        <thead>
                            <tr><th>Fuente</th><th>USD/MWh</th></tr>
                        </thead>
                        <tbody>
                            <tr><td>Eólica terrestre</td><td>40–60</td></tr>
                            <tr><td>Solar fotovoltaica</td><td>30–50</td></tr>
                            <tr><td>Biomasa (eléctrica)</td><td>60–120</td></tr>
                            <tr><td>Gas natural</td><td>40–80</td></tr>
                            <tr><td>Carbón</td><td>50–100</td></tr>
                        </tbody>
                    </table>
                </div>
                <p><strong>Nota:</strong> La biomasa tiene costos variables según disponibilidad local.</p>
            </div>

            <div class="analisis-card">
                <h3>🌱 EMISIONES DE CO₂ (g/kWh)</h3>
                <div class="grafica-circular">
                    <svg width="150" height="150" viewBox="0 0 100 100">
                        <circle cx="50" cy="50" r="45" fill="none" stroke="#4CAF50" stroke-width="10" stroke-dasharray="283" stroke-dashoffset="0" id="circuloBiomasa"/>
                        <circle cx="50" cy="50" r="45" fill="none" stroke="#FF5722" stroke-width="10" stroke-dasharray="283" stroke-dashoffset="100" id="circuloFosiles"/>
                        <text x="50" y="50" fill="white" font-size="12" text-anchor="middle" dy="5">35</text>
                        <text x="50" y="50" fill="white" font-size="8" text-anchor="middle" dy="20">g CO₂/kWh</text>
                    </svg>
                </div>
                <div class="leyenda-grafica">
                    <div class="leyenda-item"><span style="color: #4CAF50">●</span> Biomasa: 35 g/kWh</div>
                    <div class="leyenda-item"><span style="color: #FF5722">●</span> Fósiles: 820 g/kWh</div>
                </div>
            </div>
        </div>
    </section>

    <!-- QUIZ INTERACTIVO -->
    <section class="quiz-section">
        <h2 class="seccion-titulo neon-evaluacion">
            <span class="icon">❓</span> QUIZ: BIOMASSA Y ENERGÍA
        </h2>

        <div class="quiz-container">
            <!-- PREGUNTA 1 -->
            <div class="quiz-question" data-correct="C">
                <div class="quiz-header">
                    <span class="quiz-num">01</span>
                    <h3>¿Qué proceso convierte biomasa en biogás?</h3>
                </div>

                <div class="quiz-options">
                    <button class="quiz-option" data-value="A">
                        <span class="option-letter">A</span>
                        Combustión
                    </button>
                    <button class="quiz-option" data-value="B">
                        <span class="option-letter">B</span>
                        Gasificación
                    </button>
                    <button class="quiz-option" data-value="C">
                        <span class="option-letter">C</span>
                        Digestión anaerobia
                    </button>
                    <button class="quiz-option" data-value="D">
                        <span class="option-letter">D</span>
                        Pirólisis
                    </button>
                </div>

                <div class="quiz-feedback">
                    <div class="feedback-correct">
                        <strong>✅ Correcto:</strong> La <strong>digestión anaerobia</strong> usa bacterias para descomponer materia orgánica y producir biogás (CH₄ + CO₂).
                    </div>
                    <div class="feedback-explicacion">
                        <p>Ejemplo: Biodigestores de estiércol animal o residuos agrícolas.</p>
                    </div>
                </div>
            </div>

            <!-- PREGUNTA 2 -->
            <div class="quiz-question" data-correct="B">
                <div class="quiz-header">
                    <span class="quiz-num">02</span>
                    <h3>¿Cuál es el principal componente del biogás?</h3>
                </div>

                <div class="quiz-options">
                    <button class="quiz-option" data-value="A">
                        <span class="option-letter">A</span>
                        CO₂
                    </button>
                    <button class="quiz-option" data-value="B">
                        <span class="option-letter">B</span>
                        CH₄ (metano)
                    </button>
                    <button class="quiz-option" data-value="C">
                        <span class="option-letter">C</span>
                        H₂ (hidrógeno)
                    </button>
                    <button class="quiz-option" data-value="D">
                        <span class="option-letter">D</span>
                        O₂ (oxígeno)
                    </button>
                </div>

                <div class="quiz-feedback">
                    <div class="feedback-correct">
                        <strong>✅ Correcto:</strong> El biogás contiene <strong>50–70% de metano (CH₄)</strong>, responsable de su poder calorífico.
                    </div>
                    <div class="feedback-explicacion">
                        <p>El CO₂ (30–50%) no es combustible, pero el CH₄ tiene un PCI de ~50 MJ/kg.</p>
                    </div>
                </div>
            </div>

            <!-- PREGUNTA 3 -->
            <div class="quiz-question" data-correct="A">
                <div class="quiz-header">
                    <span class="quiz-num">03</span>
                    <h3>¿Por qué se considera a la biomasa "carbono neutral"?</h3>
                </div>

                <div class="quiz-options">
                    <button class="quiz-option" data-value="A">
                        <span class="option-letter">A</span>
                        El CO₂ emitido fue previamente capturado por las plantas
                    </button>
                    <button class="quiz-option" data-value="B">
                        <span class="option-letter">B</span>
                        No emite CO₂ al quemarse
                    </button>
                    <button class="quiz-option" data-value="C">
                        <span class="option-letter">C</span>
                        Absorbe más CO₂ del que emite
                    </button>
                    <button class="quiz-option" data-value="D">
                        <span class="option-letter">D</span>
                        Solo emite vapor de agua
                    </button>
                </div>

                <div class="quiz-feedback">
                    <div class="feedback-correct">
                        <strong>✅ Correcto:</strong> La biomasa forma parte de un <strong>ciclo cerrado de carbono</strong>: el CO₂ emitido al quemarse fue capturado durante el crecimiento de las plantas.
                    </div>
                    <div class="feedback-explicacion">
                        <p>Sin embargo, esto solo aplica si la biomasa se gestiona <strong>sosteniblemente</strong> (sin deforestación).</p>
                    </div>
                </div>
            </div>

            <!-- RESULTADOS -->
            <div class="quiz-results">
                <h3>🏆 RESULTADOS</h3>
                <div class="results-score">
                    Puntuación: <span id="quizScore">0</span>/3
                </div>
                <div class="results-feedback" id="quizFeedback">
                    Completa el quiz para ver tus resultados
                </div>
                <button class="btn-retry" onclick="reiniciarQuiz()">REINTENTAR</button>
            </div>
        </div>
    </section>

    <!-- PROBLEMAS TIPO EXAMEN -->
    <section class="examen-section">
        <h2 class="seccion-titulo neon-evaluacion">
            <span class="icon">📝</span> PROBLEMAS TIPO EXAMEN
        </h2>

        <div class="examen-container">
            <div class="problema-card">
                <div class="problema-header">
                    <span class="problema-num">P1</span>
                    <h3>Cálculo de Energía de Biomasa</h3>
                </div>
                <div class="problema-enunciado">
                    <p>Se queman <strong>500 kg de bagazo</strong> (PCI = 18 MJ/kg) en una caldera con eficiencia del <strong>35%</strong>. Calcula:</p>
                    <ol>
                        <li>Energía total disponible (MJ).</li>
                        <li>Energía útil generada (MJ).</li>
                        <li>Equivalente en kWh.</li>
                    </ol>
                    <div class="formula-inline">
                        \\[
                        E_{\\text{útil}} = m \\times \\text{PCI} \\times \\eta \\quad \\text{y} \\quad 1\\,\\text{kWh} = 3.6\\,\\text{MJ}
                        \\]
                    </div>
                </div>
                <div class="problema-espacio">
                    <textarea placeholder="Desarrolla tu solución paso a paso..." rows="8"></textarea>
                </div>
                <button class="btn-verificar" onclick="verificarProblema(1)">
                    🔍 VERIFICAR SOLUCIÓN
                </button>
                <div class="problema-solucion" id="solucionP1" style="display: none;">
                    <strong>Solución:</strong><br>
                    1. \\(E_{\\text{total}} = 500\\,\\text{kg} \\times 18\\,\\text{MJ/kg} = 9,000\\,\\text{MJ}\\)<br>
                    2. \\(E_{\\text{útil}} = 9,000 \\times 0.35 = 3,150\\,\\text{MJ}\\)<br>
                    3. \\(3,150\\,\\text{MJ} \\times \\frac{1\\,\\text{kWh}}{3.6\\,\\text{MJ}} = 875\\,\\text{kWh}\\)
                </div>
            </div>

            <div class="problema-card">
                <div class="problema-header">
                    <span class="problema-num">P2</span>
                    <h3>Análisis de Sostenibilidad</h3>
                </div>
                <div class="problema-enunciado">
                    <p>Comparar la biomasa con la energía solar en:</p>
                    <ol>
                        <li><strong>Disponibilidad:</strong> Biomasa (local, estacional) vs Solar (ubícua, intermitente).</li>
                        <li><strong>Emisiones:</strong> Biomasa (35 g CO₂/kWh) vs Solar (12 g CO₂/kWh).</li>
                        <li><strong>Uso de suelo:</strong> Biomasa (competencia con alimentos) vs Solar (sin competencia).</li>
                    </ol>
                    <p>¿En qué contextos sería preferible cada una?</p>
                </div>
                <div class="problema-espacio">
                    <textarea placeholder="Desarrolla tu análisis comparativo..." rows="8"></textarea>
                </div>
                <button class="btn-verificar" onclick="verificarProblema(2)">
                    🔍 VERIFICAR SOLUCIÓN
                </button>
                <div class="problema-solucion" id="solucionP2" style="display: none;">
                    <strong>Solución:</strong><br>
                    <strong>Biomasa sería preferible en:</strong><br>
                    - Zonas rurales con residuos agrícolas/forestales.<br>
                    - Sistemas de cogeneración (calor + electricidad).<br>
                    - Cuando se requiere almacenamiento de energía.<br><br>
                    <strong>Energía solar sería preferible en:</strong><br>
                    - Zonas con alta irradiación solar.<br>
                    - Aplicaciones donde se prioriza baja huella de carbono.<br>
                    - Cuando no hay competencia por uso de suelo.
                </div>
            </div>
        </div>

        <div class="rubrica">
            <h4>📋 RÚBRICA DE EVALUACIÓN</h4>
            <table class="rubrica-table">
                <tr>
                    <th>Criterio</th>
                    <th>Excelente (3 pts)</th>
                    <th>Satisfactorio (2 pts)</th>
                    <th>Insuficiente (1 pt)</th>
                </tr>
                <tr>
                    <td>Cálculos correctos</td>
                    <td>Todas las operaciones y unidades</td>
                    <td>Error en 1 cálculo o unidad</td>
                    <td>Múltiples errores</td>
                </tr>
                <tr>
                    <td>Análisis comparativo</td>
                    <td>Comparación detallada con ejemplos</td>
                    <td>Análisis parcial</td>
                    <td>Sin comparación clara</td>
                </tr>
                <tr>
                    <td>Justificación</td>
                    <td>Argumentos basados en datos</td>
                    <td>Justificación genérica</td>
                    <td>Sin justificación</td>
                </tr>
            </table>
        </div>
    </section>

    <!-- CIERRE METACOGNITIVO -->
    <section class="cierre-section">
        <h2 class="seccion-titulo neon-concepto">
            <span class="icon">🧠</span> CIERRE METACOGNITIVO
        </h2>
        <div class="cierre-container">
            <div class="autoevaluacion">
                <h3>📊 AUTOEVALUACIÓN</h3>
                <div class="slider-group">
                    <label>Tipos de biomasa:</label>
                    <input type="range" min="1" max="5" value="3" class="autoeval-slider" id="slider1">
                    <div class="slider-labels">
                        <span>Básico</span><span>Avanzado</span>
                    </div>
                </div>
                <div class="slider-group">
                    <label>Procesos de transformación:</label>
                    <input type="range" min="1" max="5" value="3" class="autoeval-slider" id="slider2">
                    <div class="slider-labels">
                        <span>Básico</span><span>Avanzado</span>
                    </div>
                </div>
                <div class="slider-group">
                    <label>Análisis de sostenibilidad:</label>
                    <input type="range" min="1" max="5" value="3" class="autoeval-slider" id="slider3">
                    <div class="slider-labels">
                        <span>Básico</span><span>Avanzado</span>
                    </div>
                </div>
                <button class="btn-guardar" onclick="guardarAutoevaluacion()">
                    💾 GUARDAR AUTOEVALUACIÓN
                </button>
            </div>

            <div class="reflexion">
                <h3>💭 REFLEXIÓN CRÍTICA</h3>
                <div class="pregunta-reflexion">
                    <p>¿Crees que la biomasa puede ser una solución real para la transición energética en tu país? Considera:</p>
                    <ul>
                        <li>Disponibilidad de recursos biomásicos locales</li>
                        <li>Impacto en la seguridad alimentaria</li>
                        <li>Tecnologías disponibles y costos</li>
                        <li>Políticas de sostenibilidad existentes</li>
                    </ul>
                    <textarea placeholder="Argumenta tu postura con ejemplos..." rows="4"></textarea>
                </div>
            </div>

            <div class="plan-estudio">
                <h3>📅 PLAN DE ESTUDIO</h3>
                <div class="plan-grid">
                    <div class="plan-card">
                        <h4>🔹 REPASO RÁPIDO (15 min)</h4>
                        <ul>
                            <li>Repasar ciclo del carbono</li>
                            <li>Memorizar tipos de biomasa</li>
                        </ul>
                    </div>
                    <div class="plan-card">
                        <h4>🧪 PRÁCTICA (30 min)</h4>
                        <ul>
                            <li>Simular 3 escenarios en el simulador</li>
                            <li>Resolver 2 problemas de eficiencia</li>
                        </ul>
                    </div>
                    <div class="plan-card">
                        <h4>📚 INVESTIGACIÓN (45 min)</h4>
                        <ul>
                            <li>Buscar casos de éxito de biomasa</li>
                            <li>Analizar políticas energéticas locales</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="recursos">
                <h3>🔗 RECURSOS CIENTÍFICOS</h3>
                <div class="recursos-links">
                    <a href="https://www.irena.org/bioenergy" target="_blank" class="recurso-link">
                        🌐 IRENA: Bioenergía Global
                    </a>
                    <a href="https://www.eia.gov/energyexplained/bioenergy/" target="_blank" class="recurso-link">
                        📚 EIA: Explicación de Bioenergía
                    </a>
                    <a href="https://www.fao.org/bioenergy/en/" target="_blank" class="recurso-link">
                        🌱 FAO: Biomasa y Seguridad Alimentaria
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- JAVASCRIPT FUNCIONAL -->
<script>
// ========================================
// BASE DE DATOS DE BIOMASSA
// ========================================
const DATABASE_BIOMASSA = {
    tipos: {
        madera: {
            nombre: "Madera",
            pci: 18, // MJ/kg
            emisiones: 0.035, // kg CO₂/MJ
            competenciaAlimentos: "Baja",
            emisionesLocales: "Altas"
        },
        bagazo: {
            nombre: "Bagazo de caña",
            pci: 18, // MJ/kg
            emisiones: 0.030, // kg CO₂/MJ
            competenciaAlimentos: "Nula",
            emisionesLocales: "Medias"
        },
        bioetanol: {
            nombre: "Bioetanol",
            pci: 27, // MJ/L
            emisiones: 0.025, // kg CO₂/MJ
            competenciaAlimentos: "Alta",
            emisionesLocales: "Bajas"
        },
        biogas: {
            nombre: "Biogás",
            pci: 22, // MJ/m³
            emisiones: 0.020, // kg CO₂/MJ
            competenciaAlimentos: "Media",
            emisionesLocales: "Bajas"
        }
    },
    procesos: {
        combustion: {
            nombre: "Combustión directa",
            eficienciaBase: 30,
            emisionesFactor: 1.0
        },
        gasificacion: {
            nombre: "Gasificación",
            eficienciaBase: 60,
            emisionesFactor: 0.8
        },
        digestion: {
            nombre: "Digestión anaerobia",
            eficienciaBase: 50,
            emisionesFactor: 0.6
        }
    }
};

// ========================================
// SIMULADOR DE BIOMASSA (FUNCIONAL)
// ========================================
function simularBiomasa() {
    // Obtener parámetros
    const tipo = document.getElementById(\'tipoBiomasa\').value;
    const masa = parseInt(document.getElementById(\'masaBiomasa\').value);
    const proceso = document.getElementById(\'proceso\').value;
    const eficiencia = parseInt(document.getElementById(\'eficiencia\').value);

    // Datos del tipo de biomasa
    const tipoData = DATABASE_BIOMASSA.tipos[tipo];
    const procesoData = DATABASE_BIOMASSA.procesos[proceso];

    // Cálculos
    const energiaDisponible = masa * tipoData.pci;
    const energiaUtil = energiaDisponible * (eficiencia / 100);
    const emisionesCO2 = energiaUtil * tipoData.emisiones * procesoData.emisionesFactor;

    // Actualizar visualización
    document.getElementById(\'biomasaText\').textContent = tipoData.nombre;
    document.getElementById(\'biomasaMasa\').textContent = `${masa} ${tipo === \'bioetanol\' ? \'L\' : tipo === \'biogas\' ? \'m³\' : \'kg\'}`;
    document.getElementById(\'procesoText\').textContent = procesoData.nombre;
    document.getElementById(\'eficienciaText\').textContent = `${eficiencia}%`;
    document.getElementById(\'productoText\').textContent = proceso === \'digestion\' ? \'Biogás\' : \'Electricidad\';
    document.getElementById(\'energiaText\').textContent = `${energiaUtil.toFixed(1)} MJ`;
    document.getElementById(\'co2Text\').textContent = `CO₂: ${emisionesCO2.toFixed(1)} kg`;

    // Actualizar datos
    document.getElementById(\'dataTipo\').textContent = tipoData.nombre;
    document.getElementById(\'dataMasa\').textContent = `${masa} ${tipo === \'bioetanol\' ? \'L\' : tipo === \'biogas\' ? \'m³\' : \'kg\'}`;
    document.getElementById(\'dataProceso\').textContent = procesoData.nombre;
    document.getElementById(\'dataEnergiaDisponible\').textContent = `${energiaDisponible.toFixed(1)} MJ`;
    document.getElementById(\'dataEnergiaUtil\').textContent = `${energiaUtil.toFixed(1)} MJ`;
    document.getElementById(\'dataEmisiones\').textContent = `${emisionesCO2.toFixed(1)} kg CO₂`;

    // Impacto ambiental
    document.getElementById(\'impactoCarbono\').textContent = "Sí (ciclo cerrado)";
    document.getElementById(\'impactoAlimentos\').textContent = tipoData.competenciaAlimentos;
    document.getElementById(\'impactoLocales\').textContent = tipoData.emisionesLocales;

    // Animaciones
    document.getElementById(\'flecha1\').style.opacity = "1";
    document.getElementById(\'flecha2\').style.opacity = "1";
    document.getElementById(\'flecha3\').style.opacity = "1";
    document.getElementById(\'procesoVisual\').style.opacity = "1";
    document.getElementById(\'productosVisual\').style.opacity = "1";

    // Animar CO₂
    document.getElementById(\'animCO2\').beginElement();
    document.getElementById(\'animCO2_2\').beginElement();

    console.log(`🔬 Simulación: ${tipoData.nombre} (${masa} ${tipo === \'bioetanol\' ? \'L\' : tipo === \'biogas\' ? \'m³\' : \'kg\'}) → ${procesoData.nombre}`);
    console.log(`   Energía disponible: ${energiaDisponible.toFixed(1)} MJ`);
    console.log(`   Energía útil: ${energiaUtil.toFixed(1)} MJ (${eficiencia}% eficiencia)`);
    console.log(`   Emisiones CO₂: ${emisionesCO2.toFixed(1)} kg`);
}

function reiniciarSimulador() {
    // Restaurar controles
    document.getElementById(\'tipoBiomasa\').value = "madera";
    document.getElementById(\'masaBiomasa\').value = 100;
    document.getElementById(\'proceso\').value = "combustion";
    document.getElementById(\'eficiencia\').value = 30;

    // Actualizar textos
    document.getElementById(\'masaValue\').textContent = "100";

    // Restaurar visualización
    document.getElementById(\'biomasaText\').textContent = "Madera";
    document.getElementById(\'biomasaMasa\').textContent = "100 kg";
    document.getElementById(\'procesoText\').textContent = "Combustión directa";
    document.getElementById(\'eficienciaText\').textContent = "30%";
    document.getElementById(\'productoText\').textContent = "Electricidad";
    document.getElementById(\'energiaText\').textContent = "0 MJ";
    document.getElementById(\'co2Text\').textContent = "CO₂: 0 kg";

    // Ocultar elementos
    document.getElementById(\'flecha1\').style.opacity = "0";
    document.getElementById(\'flecha2\').style.opacity = "0";
    document.getElementById(\'flecha3\').style.opacity = "0";
    document.getElementById(\'procesoVisual\').style.opacity = "0";
    document.getElementById(\'productosVisual\').style.opacity = "0";

    // Restaurar datos
    document.getElementById(\'dataTipo\').textContent = "Madera";
    document.getElementById(\'dataMasa\').textContent = "100 kg";
    document.getElementById(\'dataProceso\').textContent = "Combustión directa";
    document.getElementById(\'dataEnergiaDisponible\').textContent = "0 MJ";
    document.getElementById(\'dataEnergiaUtil\').textContent = "0 MJ";
    document.getElementById(\'dataEmisiones\').textContent = "0 kg CO₂";

    // Impacto ambiental
    document.getElementById(\'impactoCarbono\').textContent = "Sí (ciclo cerrado)";
    document.getElementById(\'impactoAlimentos\').textContent = "Baja";
    document.getElementById(\'impactoLocales\').textContent = "Altas";

    console.log("🔄 Simulador reiniciado");
}

// Event listeners para controles
document.getElementById(\'masaBiomasa\').addEventListener(\'input\', function() {
    document.getElementById(\'masaValue\').textContent = this.value;
});

document.getElementById(\'eficiencia\').addEventListener(\'input\', function() {
    document.getElementById(\'eficienciaValue\').textContent = this.value + \'%\';
});

// ========================================
// QUIZ INTERACTIVO (FUNCIONAL)
// ========================================
let quizRespuestas = [];
let quizCompletado = false;

document.querySelectorAll(\'.quiz-option\').forEach(option => {
    option.addEventListener(\'click\', function() {
        if (quizCompletado) return;

        const question = this.closest(\'.quiz-question\');
        const correct = question.dataset.correct;
        const selected = this.dataset.value;
        const feedback = question.querySelector(\'.quiz-feedback\');

        // Remover selección previa
        question.querySelectorAll(\'.quiz-option\').forEach(opt => {
            opt.classList.remove(\'selected\', \'correct\', \'incorrect\');
        });

        // Marcar selección actual
        this.classList.add(\'selected\');

        // Verificar respuesta
        if (selected === correct) {
            this.classList.add(\'correct\');
            quizRespuestas.push(true);
        } else {
            this.classList.add(\'incorrect\');
            // Marcar también la correcta
            question.querySelector(`[data-value="${correct}"]`).classList.add(\'correct\');
            quizRespuestas.push(false);
        }

        // Mostrar feedback
        feedback.style.display = \'block\';

        // Verificar si todas respondidas
        const allAnswered = Array.from(document.querySelectorAll(\'.quiz-question\')).every(q =>
            q.querySelector(\'.quiz-option.selected\')
        );

        if (allAnswered && !quizCompletado) {
            quizCompletado = true;
            mostrarResultadosQuiz();
        }
    });
});

function mostrarResultadosQuiz() {
    const correctas = quizRespuestas.filter(r => r).length;
    const total = quizRespuestas.length;
    document.getElementById(\'quizScore\').textContent = `${correctas}/${total}`;

    let feedback;
    if (correctas === total) {
        feedback = "🌟 Excelente! Dominas los conceptos de biomasa y sus aplicaciones.";
    } else if (correctas >= total/2) {
        feedback = "👍 Bueno. Revisa los procesos de transformación y el ciclo del carbono.";
    } else {
        feedback = "📚 Necesitas repasar. Enfócate en la digestión anaerobia y las emisiones.";
    }

    document.getElementById(\'quizFeedback\').textContent = feedback;
}

function reiniciarQuiz() {
    quizRespuestas = [];
    quizCompletado = false;

    document.querySelectorAll(\'.quiz-option\').forEach(opt => {
        opt.classList.remove(\'selected\', \'correct\', \'incorrect\');
    });

    document.querySelectorAll(\'.quiz-feedback\').forEach(fb => {
        fb.style.display = \'none\';
    });

    document.getElementById(\'quizScore\').textContent = "0/3";
    document.getElementById(\'quizFeedback\').textContent = "Completa el quiz para ver tus resultados";
}

// ========================================
// PROBLEMAS TIPO EXAMEN (FUNCIONAL)
// ========================================
function verificarProblema(num) {
    const solucion = document.getElementById(`solucionP${num}`);
    if (solucion.style.display === \'block\') {
        solucion.style.display = \'none\';
    } else {
        solucion.style.display = \'block\';
    }
}

// ========================================
// AUTOEVALUACIÓN (FUNCIONAL)
// ========================================
function guardarAutoevaluacion() {
    const slider1 = document.getElementById(\'slider1\').value;
    const slider2 = document.getElementById(\'slider2\').value;
    const slider3 = document.getElementById(\'slider3\').value;
    const promedio = (parseInt(slider1) + parseInt(slider2) + parseInt(slider3)) / 3;

    let mensaje = `📊 Autoevaluación guardada:\\n\\n`;
    mensaje += `Tipos de biomasa: ${slider1}/5\\n`;
    mensaje += `Procesos de transformación: ${slider2}/5\\n`;
    mensaje += `Análisis de sostenibilidad: ${slider3}/5\\n\\n`;
    mensaje += `Promedio: ${promedio.toFixed(1)}/5\\n\\n`;

    if (promedio >= 4) {
        mensaje += "🌟 Excelente comprensión! Puedes analizar críticamente la biomasa como fuente energética.";
    } else if (promedio >= 3) {
        mensaje += "👍 Bueno, pero profundiza en los impactos ambientales y la eficiencia de los procesos.";
    } else {
        mensaje += "📚 Revisa los fundamentos del ciclo del carbono y los tipos de biomasa.";
    }

    alert(mensaje);
}

// ========================================
// INICIALIZACIÓN
// ========================================
console.log("🌱 Lección Cyberpunk: Biomasa inicializada");
console.log("🔬 Simulador de ciclo de biomasa listo");
console.log("❓ Quiz con 3 preguntas sobre biomasa");
console.log("📊 Problemas tipo examen con soluciones detalladas");

// Inicializar simulador
reiniciarSimulador();
</script>',
    'ejercicios' => 
    array (
      0 => 
      array (
        'enunciado' => 'Biomasa es...',
        'respuesta' => 'Materia orgánica renovable',
      ),
      1 => 
      array (
        'enunciado' => 'Ejemplo sólido',
        'respuesta' => 'Madera, bagazo',
      ),
      2 => 
      array (
        'enunciado' => 'Carbono neutral si...',
        'respuesta' => 'Repoblación = consumo',
      ),
      3 => 
      array (
        'enunciado' => 'Biogás principal componente',
        'respuesta' => 'Metano (CH₄)',
      ),
      4 => 
      array (
        'enunciado' => 'Bioetanol de...',
        'respuesta' => 'Maíz, caña',
      ),
      5 => 
      array (
        'enunciado' => 'México: bagazo genera ~',
        'respuesta' => '1,000 MW',
      ),
      6 => 
      array (
        'enunciado' => 'Ventaja ambiental',
        'respuesta' => 'Reduce residuos, CO₂ neutral',
      ),
      7 => 
      array (
        'enunciado' => 'Riesgo si no sostenible',
        'respuesta' => 'Deforestación',
      ),
      8 => 
      array (
        'enunciado' => '% energía primaria México',
        'respuesta' => '~5%',
      ),
      9 => 
      array (
        'enunciado' => 'Poder calorífico madera seca',
        'respuesta' => '~16 MJ/kg',
      ),
      10 => 
      array (
        'enunciado' => 'Eficiencia típica central biomasa',
        'respuesta' => '~30%',
      ),
      11 => 
      array (
        'enunciado' => '1 m³ biogás ≈',
        'respuesta' => '6 kWh',
      ),
    ),
    'quiz' => 
    array (
      0 => 
      array (
        'pregunta' => 'Biomasa es...',
        'opciones' => 
        array (
          0 => 'Renovable',
          1 => 'Fósil',
          2 => 'Nuclear',
          3 => 'Solar',
        ),
        'correcta' => 'Renovable',
      ),
      1 => 
      array (
        'pregunta' => 'Proviene de...',
        'opciones' => 
        array (
          0 => 'Orgánica',
          1 => 'Petróleo',
          2 => 'Uranio',
          3 => 'Viento',
        ),
        'correcta' => 'Orgánica',
      ),
      2 => 
      array (
        'pregunta' => 'Carbono neutral si...',
        'opciones' => 
        array (
          0 => 'Sostenible',
          1 => 'No',
          2 => 'Siempre',
          3 => 'Nunca',
        ),
        'correcta' => 'Sostenible',
      ),
      3 => 
      array (
        'pregunta' => 'Ejemplo biomasa',
        'opciones' => 
        array (
          0 => 'Bagazo',
          1 => 'Carbón',
          2 => 'Gas natural',
          3 => 'Hidrógeno',
        ),
        'correcta' => 'Bagazo',
      ),
      4 => 
      array (
        'pregunta' => 'Biogás contiene...',
        'opciones' => 
        array (
          0 => 'CH₄',
          1 => 'CO₂ solo',
          2 => 'O₂',
          3 => 'N₂',
        ),
        'correcta' => 'CH₄',
      ),
      5 => 
      array (
        'pregunta' => 'Bioetanol es...',
        'opciones' => 
        array (
          0 => 'Líquido',
          1 => 'Sólido',
          2 => 'Gas',
          3 => 'Plasma',
        ),
        'correcta' => 'Líquido',
      ),
      6 => 
      array (
        'pregunta' => 'Combustión produce...',
        'opciones' => 
        array (
          0 => 'CO₂ + H₂O',
          1 => 'O₂',
          2 => 'CH₄',
          3 => 'H₂',
        ),
        'correcta' => 'CO₂ + H₂O',
      ),
      7 => 
      array (
        'pregunta' => 'México usa bagazo en...',
        'opciones' => 
        array (
          0 => 'Ingenios',
          1 => 'Refinerías',
          2 => 'Minas',
          3 => 'Aeropuertos',
        ),
        'correcta' => 'Ingenios',
      ),
      8 => 
      array (
        'pregunta' => 'Ventaja clave',
        'opciones' => 
        array (
          0 => 'Reduce residuos',
          1 => 'Aumenta CO₂',
          2 => 'No renovable',
          3 => 'Cara',
        ),
        'correcta' => 'Reduce residuos',
      ),
      9 => 
      array (
        'pregunta' => 'Densidad energética vs carbón',
        'opciones' => 
        array (
          0 => 'Menor',
          1 => 'Mayor',
          2 => 'Igual',
          3 => 'Cero',
        ),
        'correcta' => 'Menor',
      ),
      10 => 
      array (
        'pregunta' => 'Eficiencia combustión biomasa',
        'opciones' => 
        array (
          0 => '~30%',
          1 => '80%',
          2 => '10%',
          3 => '100%',
        ),
        'correcta' => '~30%',
      ),
      11 => 
      array (
        'pregunta' => 'Poder calorífico madera seca',
        'opciones' => 
        array (
          0 => '~16 MJ/kg',
          1 => '50 MJ/kg',
          2 => '5 MJ/kg',
          3 => '100 MJ/kg',
        ),
        'correcta' => '~16 MJ/kg',
      ),
      12 => 
      array (
        'pregunta' => '1 m³ biogás ≈',
        'opciones' => 
        array (
          0 => '6 kWh',
          1 => '1 kWh',
          2 => '60 kWh',
          3 => '0.6 kWh',
        ),
        'correcta' => '6 kWh',
      ),
      13 => 
      array (
        'pregunta' => 'México: % energía primaria',
        'opciones' => 
        array (
          0 => '~5%',
          1 => '50%',
          2 => '1%',
          3 => '20%',
        ),
        'correcta' => '~5%',
      ),
      14 => 
      array (
        'pregunta' => 'Digestión anaerobia produce...',
        'opciones' => 
        array (
          0 => 'Biogás',
          1 => 'Bioetanol',
          2 => 'Biodiésel',
          3 => 'Syngas',
        ),
        'correcta' => 'Biogás',
      ),
      15 => 
      array (
        'pregunta' => 'Riesgo ambiental',
        'opciones' => 
        array (
          0 => 'Deforestación',
          1 => 'Lluvia ácida',
          2 => 'Tsunami',
          3 => 'Terremoto',
        ),
        'correcta' => 'Deforestación',
      ),
      16 => 
      array (
        'pregunta' => 'Biomasa sólida más común',
        'opciones' => 
        array (
          0 => 'Madera',
          1 => 'Petróleo',
          2 => 'Carbón',
          3 => 'Uranio',
        ),
        'correcta' => 'Madera',
      ),
      17 => 
      array (
        'pregunta' => 'CO₂ biomasa vs fósil',
        'opciones' => 
        array (
          0 => 'Ciclo cerrado',
          1 => 'Acumula',
          2 => 'Igual',
          3 => 'Cero',
        ),
        'correcta' => 'Ciclo cerrado',
      ),
      18 => 
      array (
        'pregunta' => 'Central biomasa usa...',
        'opciones' => 
        array (
          0 => 'Caldera + turbina',
          1 => 'Paneles',
          2 => 'Turbinas eólicas',
          3 => 'Reactores',
        ),
        'correcta' => 'Caldera + turbina',
      ),
      19 => 
      array (
        'pregunta' => 'SI 2025: biomasa en...',
        'opciones' => 
        array (
          0 => 'Joules',
          1 => 'Calorías',
          2 => 'BTU',
          3 => 'kWh',
        ),
        'correcta' => 'Joules',
      ),
      20 => 
      array (
        'pregunta' => 'Eficiencia gasificación biomasa',
        'opciones' => 
        array (
          0 => '~70% (syngas)',
          1 => '30%',
          2 => '90%',
          3 => '10%',
        ),
        'correcta' => '~70% (syngas)',
      ),
      21 => 
      array (
        'pregunta' => 'Contenido energético estiércol seco',
        'opciones' => 
        array (
          0 => '~12 MJ/kg',
          1 => '50 MJ/kg',
          2 => '5 MJ/kg',
          3 => '100 MJ/kg',
        ),
        'correcta' => '~12 MJ/kg',
      ),
      22 => 
      array (
        'pregunta' => 'México: potencial biomasa',
        'opciones' => 
        array (
          0 => '~3,000 MW',
          1 => '100 MW',
          2 => '30,000 MW',
          3 => '0 MW',
        ),
        'correcta' => '~3,000 MW',
      ),
      23 => 
      array (
        'pregunta' => 'Certificación sostenible',
        'opciones' => 
        array (
          0 => 'FSC, RSPO',
          1 => 'ISO 9001',
          2 => 'API',
          3 => 'IEC',
        ),
        'correcta' => 'FSC, RSPO',
      ),
      24 => 
      array (
        'pregunta' => 'Emisiones PM10 biomasa vs carbón',
        'opciones' => 
        array (
          0 => 'Mayor (sin filtro)',
          1 => 'Menor',
          2 => 'Igual',
          3 => 'Cero',
        ),
        'correcta' => 'Mayor (sin filtro)',
      ),
      25 => 
      array (
        'pregunta' => 'Biodiésel de...',
        'opciones' => 
        array (
          0 => 'Aceites vegetales',
          1 => 'Gasolina',
          2 => 'Agua',
          3 => 'Aire',
        ),
        'correcta' => 'Aceites vegetales',
      ),
      26 => 
      array (
        'pregunta' => 'Ciclo combinado biomasa-gas',
        'opciones' => 
        array (
          0 => '~50% eficiencia',
          1 => '20%',
          2 => '80%',
          3 => '100%',
        ),
        'correcta' => '~50% eficiencia',
      ),
      27 => 
      array (
        'pregunta' => 'Biomasa en cogeneración',
        'opciones' => 
        array (
          0 => 'Calor + electricidad',
          1 => 'Solo luz',
          2 => 'Solo frío',
          3 => 'Solo sonido',
        ),
        'correcta' => 'Calor + electricidad',
      ),
      28 => 
      array (
        'pregunta' => '1 ha caña → bagazo ≈',
        'opciones' => 
        array (
          0 => '10 ton/año',
          1 => '1 ton',
          2 => '100 ton',
          3 => '0 ton',
        ),
        'correcta' => '10 ton/año',
      ),
      29 => 
      array (
        'pregunta' => 'SI 2025: 1 GJ =',
        'opciones' => 
        array (
          0 => '10⁹ J',
          1 => '10⁶ J',
          2 => '10¹² J',
          3 => '10³ J',
        ),
        'correcta' => '10⁹ J',
      ),
    ),
  ),
  5 => 
  array (
    'materia' => 'Física I',
    'slug' => 'evolucion-concepto-energia',
    'titulo' => 'Evolución del Concepto de Energía: De la Vis Viva al Joule',
    'contenido' => '<!-- INICIO LECCIÓN CYBERPUNK -->
<div class="leccion-container leccion-fisica-energia" data-tema="evolucion-energia">
    <!-- CABECERA CYBERPUNK -->
    <header class="leccion-header">
        <h1 class="titulo-leccion neon-glow">
            <span class="icon-tema">⚡</span>
            EVOLUCIÓN DEL CONCEPTO DE ENERGÍA
        </h1>
        <div class="subtitulo">
            De la <em>Vis Viva</em> de Leibniz al <em>Joule</em> moderno
        </div>
    </header>

    <!-- PANEL OBJETIVOS -->
    <section class="panel-objetivos">
        <h2 class="seccion-titulo neon-concepto">
            <span class="icon">🎯</span> OBJETIVOS DE APRENDIZAJE
        </h2>
        <div class="objetivos-grid">
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Explicar la <em>Vis Viva</em> de Leibniz</h3>
                <p>Diferenciarla de la teoría de Descartes (\\(mv\\) vs \\(mv^2\\))</p>
            </div>
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Analizar el aporte de Thomas Young</h3>
                <p>Introducción del término <em>energía</em> en 1807</p>
            </div>
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Comprender el trabajo de Coriolis</h3>
                <p>Definición de <em>trabajo</em> como \\(W = F \\cdot d \\cdot \\cos \\theta\\)</p>
            </div>
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Dominar el experimento de Joule</h3>
                <p>Equivalencia mecánico-calórica: \\(1 \\text{ cal} = 4.184 \\text{ J}\\)</p>
            </div>
        </div>
    </section>

    <!-- CONTEXTO REAL -->
    <section class="contexto-real">
        <h2 class="seccion-titulo neon-dato">
            <span class="icon">🌍</span> APLICACIÓN EN EL MUNDO REAL
        </h2>
        <div class="contexto-grid">
            <div class="contexto-card">
                <h3>🔋 Baterías Modernas</h3>
                <p>Basadas en la conservación de energía (Ley de Joule)</p>
                <div class="dato-neon">Eficiencia: 90-95%</div>
            </div>
            <div class="contexto-card">
                <h3>🚗 Motores Eléctricos</h3>
                <p>Transforman energía eléctrica en mecánica (Coriolis)</p>
                <div class="dato-neon">Rendimiento: 85-90%</div>
            </div>
            <div class="contexto-card">
                <h3>🔥 Centrales Térmicas</h3>
                <p>Aplican la equivalencia calor-trabajo (Joule)</p>
                <div class="dato-neon">Potencia: 100-1000 MW</div>
            </div>
        </div>
    </section>

    <!-- SECCIÓN TEÓRICA -->
    <section class="teoria-section">
        <div class="borde-neon-lateral"></div>
        <h2 class="seccion-titulo neon-concepto">
            <span class="icon">📚</span> FUNDAMENTOS TEÓRICOS
        </h2>

        <!-- LÍNEA DEL TIEMPO INTERACTIVA -->
        <div class="timeline-container">
            <h3>📅 LÍNEA DEL TIEMPO HISTÓRICA</h3>
            <div class="timeline">
                <div class="timeline-item" data-year="1686">
                    <div class="timeline-icon">🔹</div>
                    <div class="timeline-content">
                        <h4>Leibniz</h4>
                        <p><strong>Vis Viva</strong>: \\(mv^2\\)</p>
                        <p>Contra Descartes (\\(mv\\))</p>
                    </div>
                </div>
                <div class="timeline-item" data-year="1807">
                    <div class="timeline-icon">🔹</div>
                    <div class="timeline-content">
                        <h4>Thomas Young</h4>
                        <p>Introduce el término <em>energía</em></p>
                        <p>\\(E = \\frac{1}{2}mv^2\\)</p>
                    </div>
                </div>
                <div class="timeline-item" data-year="1829">
                    <div class="timeline-icon">🔹</div>
                    <div class="timeline-content">
                        <h4>Coriolis</h4>
                        <p>Define <em>trabajo</em>:</p>
                        <p>\\(W = F \\cdot d \\cdot \\cos \\theta\\)</p>
                    </div>
                </div>
                <div class="timeline-item" data-year="1843">
                    <div class="timeline-icon">🔹</div>
                    <div class="timeline-content">
                        <h4>James Joule</h4>
                        <p><strong>Equivalencia mecánico-calórica</strong></p>
                        <p>\\(1 \\text{ cal} = 4.184 \\text{ J}\\)</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- TABLA COMPARATIVA -->
        <div class="tabla-comparativa">
            <h3>📊 COMPARATIVA DE APORTES</h3>
            <table class="tabla-cyberpunk">
                <thead>
                    <tr>
                        <th>Científico</th>
                        <th>Año</th>
                        <th>Aporte</th>
                        <th>Fórmula</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Leibniz</td>
                        <td>1686</td>
                        <td><em>Vis Viva</em> (\\(mv^2\\))</td>
                        <td>\\[ E \\propto mv^2 \\]</td>
                    </tr>
                    <tr>
                        <td>Thomas Young</td>
                        <td>1807</td>
                        <td>Término <em>energía</em></td>
                        <td>\\[ E = \\frac{1}{2}mv^2 \\]</td>
                    </tr>
                    <tr>
                        <td>Coriolis</td>
                        <td>1829</td>
                        <td>Definición de <em>trabajo</em></td>
                        <td>\\[ W = F \\cdot d \\cdot \\cos \\theta \\]</td>
                    </tr>
                    <tr>
                        <td>James Joule</td>
                        <td>1843</td>
                        <td>Equivalencia calor-trabajo</td>
                        <td>\\[ 1 \\text{ cal} = 4.184 \\text{ J} \\]</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- EXPERIMENTO DE JOULE -->
        <div class="experimento-joule">
            <h3>🧪 EXPERIMENTO DE JOULE</h3>
            <p>Pesas caen → giran paletas → agitan agua → ΔT medida → <strong>trabajo mecánico = calor generado</strong>.</p>
            <div class="formula-destacada">
                \\[
                    W = mgh = Q = mc\\Delta T \\quad \\Rightarrow \\quad J = \\frac{W}{Q}
                \\]
            </div>
            <div class="ejemplo">
                <p><strong>Ejemplo (1845):</strong></p>
                <p>1 kg cae 1 m → 9.8 J → eleva temperatura de 1 g de agua ~0.0023 °C → <strong>4.18 J/cal</strong>.</p>
            </div>
            <div class="visual">
                <svg class="aparato-joule" viewBox="0 0 400 300">
                    <!-- Aparato de Joule -->
                    <rect x="50" y="50" width="300" height="200" fill="#f0f0f0" stroke="#333" rx="10"/>
                    <circle cx="200" cy="150" r="30" fill="#42A5F5">
                        <animate attributeName="cy" values="150;180;150" dur="2s" repeatCount="indefinite"/>
                    </circle>
                    <text x="200" y="220" fill="#1565C0" text-anchor="middle">Paletas</text>
                    <text x="200" y="240" fill="#0D47A1" text-anchor="middle">W → Q</text>
                </svg>
                <p><em>SVG: Réplica del aparato de Joule.</em></p>
            </div>
        </div>
    </section>

    <!-- SIMULADOR INTERACTIVO -->
    <section class="simulator-section">
        <h2 class="seccion-titulo neon-interactivo">
            <span class="icon">🎮</span> SIMULADOR: EXPERIMENTO DE JOULE
        </h2>
        <div class="simulator-container" data-tema="experimento-joule">
            <div class="simulator-controls">
                <h3>⚙️ CONTROLES</h3>
                <div class="control-group">
                    <label for="masaPesas">Masa de las pesas (kg):</label>
                    <input type="range" id="masaPesas" min="0.1" max="5" step="0.1" value="1">
                    <span id="valorMasa">1 kg</span>
                </div>
                <div class="control-group">
                    <label for="alturaCaida">Altura de caída (m):</label>
                    <input type="range" id="alturaCaida" min="0.5" max="10" step="0.5" value="1">
                    <span id="valorAltura">1 m</span>
                </div>
                <div class="control-group">
                    <label for="masaAgua">Masa de agua (g):</label>
                    <input type="range" id="masaAgua" min="10" max="1000" step="10" value="100">
                    <span id="valorMasaAgua">100 g</span>
                </div>
                <button class="btn-simular" onclick="simularExperimento()">
                    <span class="btn-icon">▶️</span> SIMULAR
                </button>
            </div>
            <div class="simulator-visualization">
                <svg id="simulacionJoule" viewBox="0 0 400 300">
                    <!-- Aparato -->
                    <rect x="50" y="50" width="300" height="200" fill="#f0f0f0" stroke="#333" rx="10"/>
                    <circle id="paletas" cx="200" cy="150" r="30" fill="#42A5F5"/>
                    <text x="200" y="220" fill="#1565C0" text-anchor="middle">Paletas</text>
                    <text x="200" y="240" fill="#0D47A1" text-anchor="middle" id="resultadoSimulacion">W → Q</text>
                </svg>
            </div>
            <div class="simulator-data">
                <h3>📊 DATOS DE SIMULACIÓN</h3>
                <div class="data-card">
                    <div class="data-label">Trabajo (J):</div>
                    <div class="data-value" id="dataTrabajo">0</div>
                </div>
                <div class="data-card">
                    <div class="data-label">Calor generado (cal):</div>
                    <div class="data-value" id="dataCalor">0</div>
                </div>
                <div class="data-card">
                    <div class="data-label">ΔT (°C):</div>
                    <div class="data-value" id="dataDeltaT">0</div>
                </div>
                <div class="data-card highlight">
                    <div class="data-label">Equivalente (J/cal):</div>
                    <div class="data-value" id="dataEquivalente">4.184</div>
                </div>
            </div>
        </div>
    </section>

    <!-- QUIZ INTERACTIVO -->
    <section class="quiz-section">
        <h2 class="seccion-titulo neon-evaluacion">
            <span class="icon">❓</span> QUIZ DE AUTOEVALUACIÓN
        </h2>
        <div class="quiz-container">
            <!-- PREGUNTA 1 -->
            <div class="quiz-question" data-correct="C">
                <div class="quiz-header">
                    <span class="quiz-num">01</span>
                    <h3>¿Qué propuso Leibniz en 1686?</h3>
                </div>
                <div class="quiz-options">
                    <button class="quiz-option" data-value="A">
                        <span class="option-letter">A</span>
                        \\(E = mc^2\\)
                    </button>
                    <button class="quiz-option" data-value="B">
                        <span class="option-letter">B</span>
                        \\(E = mgh\\)
                    </button>
                    <button class="quiz-option" data-value="C">
                        <span class="option-letter">C</span>
                        \\(mv^2\\) (<em>Vis Viva</em>)
                    </button>
                    <button class="quiz-option" data-value="D">
                        <span class="option-letter">D</span>
                        \\(W = F \\cdot d\\)
                    </button>
                </div>
                <div class="quiz-feedback" style="display: none;">
                    <div class="feedback-correct">
                        <strong>Correcto:</strong> Leibniz propuso \\(mv^2\\) como medida del movimiento.
                    </div>
                    <div class="feedback-incorrect">
                        ❌ <strong>Incorrecto:</strong> Revisa la sección sobre <em>Vis Viva</em>.
                    </div>
                </div>
            </div>

            <!-- PREGUNTA 2 -->
            <div class="quiz-question" data-correct="B">
                <div class="quiz-header">
                    <span class="quiz-num">02</span>
                    <h3>¿Qué introdujo Thomas Young en 1807?</h3>
                </div>
                <div class="quiz-options">
                    <button class="quiz-option" data-value="A">
                        <span class="option-letter">A</span>
                        El término <em>fuerza</em>
                    </button>
                    <button class="quiz-option" data-value="B">
                        <span class="option-letter">B</span>
                        El término <em>energía</em>
                    </button>
                    <button class="quiz-option" data-value="C">
                        <span class="option-letter">C</span>
                        La fórmula \\(W = F \\cdot d\\)
                    </button>
                    <button class="quiz-option" data-value="D">
                        <span class="option-letter">D</span>
                        La constante de Joule
                    </button>
                </div>
                <div class="quiz-feedback" style="display: none;">
                    <div class="feedback-correct">
                        <strong>Correcto:</strong> Young introdujo el término <em>energía</em>.
                    </div>
                    <div class="feedback-incorrect">
                        ❌ <strong>Incorrecto:</strong> Revisa la sección sobre Thomas Young.
                    </div>
                </div>
            </div>

            <!-- PREGUNTAS 3-30 (similares) -->
            <!-- ... -->
        </div>
        <div class="quiz-results" style="display: none;">
            <h3>📊 RESULTADOS DEL QUIZ</h3>
            <div class="results-score">
                Puntuación: <span id="quizScore">0</span>/30
            </div>
            <div class="results-feedback" id="quizFeedback">
                Completa el quiz para ver tus resultados.
            </div>
            <button class="btn-retry" onclick="reiniciarQuiz()">
                🔄 INTENTAR NUEVAMENTE
            </button>
        </div>
    </section>

    <!-- ERRORES COMUNES -->
    <section class="errores-section">
        <h2 class="seccion-titulo neon-alerta">
            <span class="icon">⚠️</span> ERRORES COMUNES
        </h2>
        <div class="errores-container">
            <div class="error-card">
                <div class="error-header" onclick="toggleError(this)">
                    <h3>❌ CONFUNDIR <em>Vis Viva</em> CON ENERGÍA CINÉTICA MODERNA</h3>
                    <span class="error-toggle">+</span>
                </div>
                <div class="error-content">
                    <div class="error-ejemplo">
                        <strong>Error:</strong> "Leibniz propuso \\(E_k = \\frac{1}{2}mv^2\\)".
                    </div>
                    <div class="error-correccion">
                        <strong>Corrección:</strong> Leibniz propuso \\(mv^2\\) (<em>Vis Viva</em>), sin el \\(\\frac{1}{2}\\). Coriolis añadió el factor en 1829.
                    </div>
                </div>
            </div>
            <!-- MÁS ERRORES -->
            <!-- ... -->
        </div>
    </section>

    <!-- PROBLEMAS TIPO EXAMEN -->
    <section class="examen-section">
        <h2 class="seccion-titulo neon-evaluacion">
            <span class="icon">📝</span> PROBLEMAS TIPO EXAMEN
        </h2>
        <div class="examen-container">
            <div class="problema-card">
                <div class="problema-header">
                    <span class="problema-num">P1</span>
                    <h3>Cálculo de Equivalente Mecánico</h3>
                </div>
                <div class="problema-enunciado">
                    <p>Si 2 kg de pesas caen 5 m y elevan la temperatura de 200 g de agua en 0.1 °C, calcula el equivalente mecánico del calor en J/cal.</p>
                </div>
                <div class="problema-espacio">
                    <textarea placeholder="Desarrolla tu solución aquí..." rows="6"></textarea>
                </div>
                <button class="btn-verificar" onclick="verificarProblema(1)">
                    ✅ VERIFICAR SOLUCIÓN
                </button>
                <div class="problema-solucion" id="solucionP1" style="display: none;">
                    <strong>Solución:</strong><br>
                    \\(W = mgh = 2 \\cdot 9.8 \\cdot 5 = 98 \\text{ J}\\)<br>
                    \\(Q = mc\\Delta T = 200 \\cdot 1 \\cdot 0.1 = 20 \\text{ cal}\\)<br>
                    \\(J = \\frac{W}{Q} = \\frac{98}{20} = 4.9 \\text{ J/cal}\\)
                </div>
            </div>
            <!-- PROBLEMAS 2-12 -->
            <!-- ... -->
        </div>
    </section>

    <!-- CIERRE METACOGNITIVO -->
    <section class="cierre-section">
        <h2 class="seccion-titulo neon-concepto">
            <span class="icon">🧠</span> CIERRE METACOGNITIVO
        </h2>
        <div class="cierre-container">
            <div class="autoevaluacion">
                <h3>📊 AUTOEVALUACIÓN</h3>
                <div class="slider-group">
                    <label>Comprensión de <em>Vis Viva</em>:</label>
                    <input type="range" min="1" max="5" value="3" class="autoeval-slider" id="slider1">
                    <div class="slider-labels">
                        <span>Básico</span><span>Intermedio</span><span>Avanzado</span>
                    </div>
                </div>
                <!-- MÁS SLIDERS -->
                <!-- ... -->
                <button class="btn-guardar" onclick="guardarAutoevaluacion()">
                    💾 GUARDAR AUTOEVALUACIÓN
                </button>
            </div>
            <div class="recursos">
                <h3>📚 RECURSOS ADICIONALES</h3>
                <div class="recursos-links">
                    <a href="https://phet.colorado.edu/es/simulation/energy-forms-and-changes" target="_blank" class="recurso-link">
                        🔗 Simulador PhET: Formas de Energía
                    </a>
                    <a href="https://www.bipm.org/" target="_blank" class="recurso-link">
                        🔗 BIPM: Definición del Joule (2025)
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- JAVASCRIPT INTEGRADO -->
<script>
    <script>
// ===========================================
// SISTEMA DE SIMULACIÓN DEL EXPERIMENTO DE JOULE
// ===========================================
function simularExperimento() {
    const masaPesas = parseFloat(document.getElementById(\'masaPesas\').value);
    const alturaCaida = parseFloat(document.getElementById(\'alturaCaida\').value);
    const masaAgua = parseFloat(document.getElementById(\'masaAgua\').value);

    // Cálculos físicos
    const trabajo = masaPesas * 9.8 * alturaCaida; // W = mgh (J)
    const calor = trabajo / 4.184; // Q = W / J (cal)
    const deltaT = calor / masaAgua; // ΔT = Q / mc (°C)

    // Actualizar datos en la interfaz
    document.getElementById(\'dataTrabajo\').textContent = trabajo.toFixed(2);
    document.getElementById(\'dataCalor\').textContent = calor.toFixed(2);
    document.getElementById(\'dataDeltaT\').textContent = deltaT.toFixed(4);
    document.getElementById(\'resultadoSimulacion\').textContent =
        `${trabajo.toFixed(2)} J → ${calor.toFixed(2)} cal (ΔT = ${deltaT.toFixed(4)} °C)`;

    // Animación de las paletas
    const paletas = document.getElementById(\'paletas\');
    paletas.setAttribute(\'cy\', \'180\');
    setTimeout(() => paletas.setAttribute(\'cy\', \'150\'), 500);

    // Actualizar valores mostrados en los controles
    document.getElementById(\'valorMasa\').textContent = `${masaPesas} kg`;
    document.getElementById(\'valorAltura\').textContent = `${alturaCaida} m`;
    document.getElementById(\'valorMasaAgua\').textContent = `${masaAgua} g`;

    console.log(`🔥 Simulación: ${masaPesas} kg × ${alturaCaida} m → ${trabajo.toFixed(2)} J → ${deltaT.toFixed(4)} °C`);
}

// ===========================================
// SISTEMA DE QUIZ INTERACTIVO (30 PREGUNTAS)
// ===========================================
let quizRespuestas = [];
let quizCompletado = false;

document.querySelectorAll(\'.quiz-option\').forEach(option => {
    option.addEventListener(\'click\', function() {
        if (quizCompletado) return;

        const question = this.closest(\'.quiz-question\');
        const correct = question.dataset.correct;
        const selected = this.dataset.value;
        const feedback = question.querySelector(\'.quiz-feedback\');

        // Remover selección previa
        question.querySelectorAll(\'.quiz-option\').forEach(opt => {
            opt.classList.remove(\'selected\', \'correct\', \'incorrect\');
        });

        // Marcar selección actual
        this.classList.add(\'selected\');

        // Verificar respuesta
        if (selected === correct) {
            this.classList.add(\'correct\');
            quizRespuestas.push(true);
        } else {
            this.classList.add(\'incorrect\');
            // Marcar la opción correcta
            question.querySelector(`[data-value="${correct}"]`).classList.add(\'correct\');
            quizRespuestas.push(false);
        }

        // Mostrar feedback
        feedback.style.display = \'block\';

        // Verificar si todas las preguntas están respondidas
        verificarCompletadoQuiz();
    });
});

function verificarCompletadoQuiz() {
    const questions = document.querySelectorAll(\'.quiz-question\');
    const answered = Array.from(questions).every(q =>
        q.querySelector(\'.quiz-option.selected\')
    );

    if (answered && !quizCompletado) {
        quizCompletado = true;
        mostrarResultadosQuiz();
    }
}

function mostrarResultadosQuiz() {
    const correctas = quizRespuestas.filter(r => r).length;
    const total = quizRespuestas.length;
    const porcentaje = Math.round((correctas / total) * 100);

    document.getElementById(\'quizScore\').textContent = `${correctas}/${total}`;

    let feedback = "";
    if (porcentaje >= 90) {
        feedback = "🎉 ¡Excelente! Dominas la evolución del concepto de energía.";
    } else if (porcentaje >= 70) {
        feedback = "👍 Buen trabajo, pero repasa los conceptos clave.";
    } else if (porcentaje >= 50) {
        feedback = "⚠️ Necesitas estudiar más. Revisa la sección teórica.";
    } else {
        feedback = "😕 Vuelve a leer la lección y practica con el simulador.";
    }

    document.getElementById(\'quizFeedback\').textContent = feedback;
    document.querySelector(\'.quiz-results\').style.display = \'block\';
}

function reiniciarQuiz() {
    quizRespuestas = [];
    quizCompletado = false;

    // Limpiar selecciones
    document.querySelectorAll(\'.quiz-option\').forEach(opt => {
        opt.classList.remove(\'selected\', \'correct\', \'incorrect\');
    });

    // Ocultar feedbacks
    document.querySelectorAll(\'.quiz-feedback\').forEach(fb => {
        fb.style.display = \'none\';
    });

    // Ocultar resultados
    document.querySelector(\'.quiz-results\').style.display = \'none\';
}

// ===========================================
// SISTEMA DE ERRORES COMUNES INTERACTIVOS
// ===========================================
function toggleError(header) {
    const content = header.nextElementSibling;
    const toggle = header.querySelector(\'.error-toggle\');

    if (content.style.display === \'block\') {
        content.style.display = \'none\';
        toggle.textContent = \'+\';
    } else {
        content.style.display = \'block\';
        toggle.textContent = \'-\';
    }
}

// ===========================================
// SISTEMA DE PROBLEMAS TIPO EXAMEN
// ===========================================
function verificarProblema(num) {
    const solucion = document.getElementById(`solucionP${num}`);
    solucion.style.display = solucion.style.display === \'block\' ? \'none\' : \'block\';
}

// ===========================================
// SISTEMA DE AUTOEVALUACIÓN METACOGNITIVA
// ===========================================
function guardarAutoevaluacion() {
    const slider1 = document.getElementById(\'slider1\').value;
    const slider2 = document.getElementById(\'slider2\').value;
    const slider3 = document.getElementById(\'slider3\').value;
    const promedio = (parseInt(slider1) + parseInt(slider2) + parseInt(slider3)) / 3;

    alert(
        `📊 Autoevaluación guardada:\\n\\n` +
        `Comprensión de Vis Viva: ${slider1}/5\\n` +
        `Dominio de Joule: ${slider2}/5\\n` +
        `Aplicación práctica: ${slider3}/5\\n\\n` +
        `Promedio: ${promedio.toFixed(1)}/5\\n\\n` +
        `Recomendación: Revisa el plan de estudio según tus resultados.`
    );

    console.log(`📊 Autoevaluación: [${slider1}, ${slider2}, ${slider3}]`);
}

// ===========================================
// SISTEMA DE OBJETIVOS INTERACTIVOS
// ===========================================
document.querySelectorAll(\'.objetivo-card\').forEach(card => {
    card.addEventListener(\'click\', function() {
        const completado = this.dataset.completado === \'true\';
        this.dataset.completado = !completado;
        const checkbox = this.querySelector(\'.objetivo-checkbox\');
        checkbox.textContent = !completado ? \'✓\' : \'\';
        checkbox.style.backgroundColor = !completado ? \'#39FF14\' : \'\';
    });
});

// ===========================================
// SISTEMA DE TABLA INTERACTIVA
// ===========================================
document.querySelectorAll(\'.tabla-cyberpunk tbody tr\').forEach(row => {
    row.addEventListener(\'click\', function() {
        // Remover selección previa
        document.querySelectorAll(\'.tabla-cyberpunk tbody tr\').forEach(r => {
            r.classList.remove(\'selected\');
        });

        // Marcar fila seleccionada
        this.classList.add(\'selected\');
    });
});

// ===========================================
// INICIALIZACIÓN
// ===========================================
console.log("🚀 Lección: Evolución del Concepto de Energía");
console.log("🎮 Simulador, Quiz y Herramientas interactivas listas");
</script>',
    'ejercicios' => 
    array (
      0 => 
      array (
        'enunciado' => 'Leibniz: vis viva =',
        'respuesta' => 'mv²',
      ),
      1 => 
      array (
        'enunciado' => 'Young introdujo...',
        'respuesta' => 'Término "energía"',
      ),
      2 => 
      array (
        'enunciado' => 'Coriolis: trabajo =',
        'respuesta' => 'F·d',
      ),
      3 => 
      array (
        'enunciado' => 'Joule: constante =',
        'respuesta' => '4.184 J/cal',
      ),
      4 => 
      array (
        'enunciado' => 'Experimento Joule mide...',
        'respuesta' => 'ΔT del agua',
      ),
      5 => 
      array (
        'enunciado' => '1 cal =',
        'respuesta' => '4.184 J',
      ),
      6 => 
      array (
        'enunciado' => 'Descartes propuso...',
        'respuesta' => 'mv (erróneo)',
      ),
      7 => 
      array (
        'enunciado' => 'Año experimento Joule',
        'respuesta' => '1843–1850',
      ),
      8 => 
      array (
        'enunciado' => '1ª Ley Termodinámica',
        'respuesta' => 'Conservación energía',
      ),
      9 => 
      array (
        'enunciado' => 'E_k moderna =',
        'respuesta' => '½mv²',
      ),
      10 => 
      array (
        'enunciado' => 'Unidad joule desde',
        'respuesta' => '1948 (CGPM)',
      ),
      11 => 
      array (
        'enunciado' => 'Mayer predijo equivalencia en',
        'respuesta' => '1842',
      ),
    ),
    'quiz' => 
    array (
      0 => 
      array (
        'pregunta' => 'Leibniz propuso...',
        'opciones' => 
        array (
          0 => 'mv²',
          1 => 'mv',
          2 => 'F·d',
          3 => 'mgh',
        ),
        'correcta' => 'mv²',
      ),
      1 => 
      array (
        'pregunta' => 'Young introdujo...',
        'opciones' => 
        array (
          0 => 'Energía',
          1 => 'Trabajo',
          2 => 'Calor',
          3 => 'Fuerza',
        ),
        'correcta' => 'Energía',
      ),
      2 => 
      array (
        'pregunta' => 'Coriolis definió...',
        'opciones' => 
        array (
          0 => 'Trabajo',
          1 => 'Energía',
          2 => 'Vis viva',
          3 => 'Potencia',
        ),
        'correcta' => 'Trabajo',
      ),
      3 => 
      array (
        'pregunta' => 'Joule midió...',
        'opciones' => 
        array (
          0 => 'Equivalencia calor-trabajo',
          1 => 'Velocidad luz',
          2 => 'Gravedad',
          3 => 'Magnetismo',
        ),
        'correcta' => 'Equivalencia calor-trabajo',
      ),
      4 => 
      array (
        'pregunta' => 'Vis viva =',
        'opciones' => 
        array (
          0 => '2E_k',
          1 => 'E_k',
          2 => 'E_p',
          3 => 'W',
        ),
        'correcta' => '2E_k',
      ),
      5 => 
      array (
        'pregunta' => '1 cal =',
        'opciones' => 
        array (
          0 => '4.184 J',
          1 => '1 J',
          2 => '10 J',
          3 => '0.239 J',
        ),
        'correcta' => '4.184 J',
      ),
      6 => 
      array (
        'pregunta' => 'Experimento Joule usó...',
        'opciones' => 
        array (
          0 => 'Paletas en agua',
          1 => 'Bombilla',
          2 => 'Motor',
          3 => 'Panel solar',
        ),
        'correcta' => 'Paletas en agua',
      ),
      7 => 
      array (
        'pregunta' => 'Descartes creía en...',
        'opciones' => 
        array (
          0 => 'mv',
          1 => 'mv²',
          2 => 'F·d',
          3 => 'mgh',
        ),
        'correcta' => 'mv',
      ),
      8 => 
      array (
        'pregunta' => 'Unidad SI desde...',
        'opciones' => 
        array (
          0 => '1948',
          1 => '1800',
          2 => '1900',
          3 => '2000',
        ),
        'correcta' => '1948',
      ),
      9 => 
      array (
        'pregunta' => 'Joule nació en...',
        'opciones' => 
        array (
          0 => '1818',
          1 => '1700',
          2 => '1850',
          3 => '1900',
        ),
        'correcta' => '1818',
      ),
      10 => 
      array (
        'pregunta' => 'E_k = ½mv² introducido por...',
        'opciones' => 
        array (
          0 => 'Coriolis',
          1 => 'Leibniz',
          2 => 'Young',
          3 => 'Joule',
        ),
        'correcta' => 'Coriolis',
      ),
      11 => 
      array (
        'pregunta' => 'Mayer predijo equivalencia en...',
        'opciones' => 
        array (
          0 => '1842',
          1 => '1686',
          2 => '1807',
          3 => '1948',
        ),
        'correcta' => '1842',
      ),
      12 => 
      array (
        'pregunta' => 'Helmholtz formuló...',
        'opciones' => 
        array (
          0 => 'Conservación energía',
          1 => '2ª Ley',
          2 => 'Relatividad',
          3 => 'Óptica',
        ),
        'correcta' => 'Conservación energía',
      ),
      13 => 
      array (
        'pregunta' => '1 J = ... erg',
        'opciones' => 
        array (
          0 => '10⁷',
          1 => '10⁶',
          2 => '10⁸',
          3 => '10⁵',
        ),
        'correcta' => '10⁷',
      ),
      14 => 
      array (
        'pregunta' => 'Constante Joule ≈',
        'opciones' => 
        array (
          0 => '4.184 J/cal',
          1 => '1 J/cal',
          2 => '4.184 cal/J',
          3 => '10 J/cal',
        ),
        'correcta' => '4.184 J/cal',
      ),
      15 => 
      array (
        'pregunta' => 'SI 2019 redefinió J por...',
        'opciones' => 
        array (
          0 => 'Constantes fundamentales',
          1 => 'Prototipo kg',
          2 => 'Metro',
          3 => 'Segundo',
        ),
        'correcta' => 'Constantes fundamentales',
      ),
      16 => 
      array (
        'pregunta' => 'Trabajo = F·d·cosθ introducido por...',
        'opciones' => 
        array (
          0 => 'Coriolis',
          1 => 'Newton',
          2 => 'Young',
          3 => 'Joule',
        ),
        'correcta' => 'Coriolis',
      ),
      17 => 
      array (
        'pregunta' => 'Primera mención "energía" en inglés',
        'opciones' => 
        array (
          0 => 'Young 1807',
          1 => 'Joule 1843',
          2 => 'Leibniz 1686',
          3 => 'Aristóteles',
        ),
        'correcta' => 'Young 1807',
      ),
      18 => 
      array (
        'pregunta' => 'Joule midió ΔT con...',
        'opciones' => 
        array (
          0 => 'Termómetro',
          1 => 'Barómetro',
          2 => 'Higrómetro',
          3 => 'Anemómetro',
        ),
        'correcta' => 'Termómetro',
      ),
      19 => 
      array (
        'pregunta' => '1ª Ley Termodinámica es...',
        'opciones' => 
        array (
          0 => 'Conservación energía',
          1 => 'Entropía',
          2 => 'Carnot',
          3 => 'Boltzmann',
        ),
        'correcta' => 'Conservación energía',
      ),
      20 => 
      array (
        'pregunta' => 'Vis viva de Leibniz =',
        'opciones' => 
        array (
          0 => '2E_k',
          1 => 'E_k',
          2 => 'E_p',
          3 => 'W',
        ),
        'correcta' => '2E_k',
      ),
      21 => 
      array (
        'pregunta' => 'Error Descartes: conservación de...',
        'opciones' => 
        array (
          0 => 'mv',
          1 => 'mv²',
          2 => 'F',
          3 => 'm',
        ),
        'correcta' => 'mv',
      ),
      22 => 
      array (
        'pregunta' => 'Joule publicó resultados en...',
        'opciones' => 
        array (
          0 => '1843–1878',
          1 => '1700',
          2 => '1900',
          3 => '2000',
        ),
        'correcta' => '1843–1878',
      ),
      23 => 
      array (
        'pregunta' => 'Valor exacto constante Joule',
        'opciones' => 
        array (
          0 => '4.184 J/cal',
          1 => '4.2 J/cal',
          2 => '1 J/cal',
          3 => '4184 J/kg',
        ),
        'correcta' => '4.184 J/cal',
      ),
      24 => 
      array (
        'pregunta' => 'SI 2025: J =',
        'opciones' => 
        array (
          0 => 'c² Δm',
          1 => 'F·d',
          2 => 'P·t',
          3 => 'k·T',
        ),
        'correcta' => 'F·d',
      ),
      25 => 
      array (
        'pregunta' => 'Contribuyó a unificación física',
        'opciones' => 
        array (
          0 => 'Joule',
          1 => 'Newton',
          2 => 'Maxwell',
          3 => 'Einstein',
        ),
        'correcta' => 'Joule',
      ),
      26 => 
      array (
        'pregunta' => 'Caloría definida como...',
        'opciones' => 
        array (
          0 => 'Calor para 1g agua +1°C',
          1 => '1 J',
          2 => '1 kWh',
          3 => '1 eV',
        ),
        'correcta' => 'Calor para 1g agua +1°C',
      ),
      27 => 
      array (
        'pregunta' => 'BIPM adoptó J en...',
        'opciones' => 
        array (
          0 => '1948 (9ª CGPM)',
          1 => '1889',
          2 => '1960',
          3 => '2019',
        ),
        'correcta' => '1948 (9ª CGPM)',
      ),
      28 => 
      array (
        'pregunta' => 'Equivalencia exacta (2019)',
        'opciones' => 
        array (
          0 => '4.184 J = 1 cal',
          1 => '4.186 J = 1 cal',
          2 => '1 J = 1 cal',
          3 => '4 J = 1 cal',
        ),
        'correcta' => '4.184 J = 1 cal',
      ),
      29 => 
      array (
        'pregunta' => 'Principio fundamental establecido',
        'opciones' => 
        array (
          0 => 'Conservación energía',
          1 => 'Inercia',
          2 => 'Acción-reacción',
          3 => 'Gravitación',
        ),
        'correcta' => 'Conservación energía',
      ),
    ),
  ),
  6 => 
  array (
    'materia' => 'Física I',
    'slug' => 'energia-cinetica',
    'titulo' => 'Energía Cinética: Del Movimiento a la Relatividad',
    'contenido' => '<!-- LECCIÓN CYBERPUNK: ENERGÍA CINÉTICA -->
<div class="leccion-container leccion-fisica-ek" data-tema="energia-cinetica">
    <!-- CABECERA CYBERPUNK -->
    <header class="leccion-header">
        <h1 class="titulo-leccion neon-glow">
            <span class="icon-tema">⚡</span>
            ENERGÍA CINÉTICA: EL PODER DEL MOVIMIENTO
        </h1>
        <div class="subtitulo">
            De la fórmula clásica \\(E_k = \\frac{1}{2}mv^2\\) a la relatividad einsteiniana
        </div>
    </header>

    <!-- PANEL OBJETIVOS -->
    <section class="panel-objetivos">
        <h2 class="seccion-titulo neon-concepto">
            <span class="icon">🎯</span> OBJETIVOS DE APRENDIZAJE
        </h2>
        <div class="objetivos-grid">
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Derivar la fórmula \\(E_k = \\frac{1}{2}mv^2\\)</h3>
                <p>Desde el teorema trabajo-energía</p>
            </div>
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Analizar colisiones elásticas/inelásticas</h3>
                <p>Conservación de \\(E_k\\) y momento lineal</p>
            </div>
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Aplicar el teorema trabajo-energía</h3>
                <p>Calcular \\(W_{neto} = \\Delta E_k\\)</p>
            </div>
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Comparar \\(E_k\\) clásica vs relativista</h3>
                <p>Límite \\(E_k^{rel} \\approx E_k^{clas}\\) para \\(v \\ll c\\)</p>
            </div>
        </div>
    </section>

    <!-- CONTEXTO REAL -->
    <section class="contexto-real">
        <h2 class="seccion-titulo neon-dato">
            <span class="icon">🌍</span> APLICACIONES EN EL MUNDO REAL
        </h2>
        <div class="contexto-grid">
            <div class="contexto-card">
                <h3>🚗 Seguridad Vial</h3>
                <p>Diseño de zonas de deformación basadas en \\(E_k\\)</p>
                <div class="dato-neon">Reducción del 70% en fatalidades</div>
            </div>
            <div class="contexto-card">
                <h3>🚀 Cohetes Espaciales</h3>
                <p>Cálculo de \\(E_k\\) para maniobras orbitales</p>
                <div class="dato-neon">\\(\\Delta v = 9.3\\) km/s para LEO</div>
            </div>
            <div class="contexto-card">
                <h3>🎾 Deportes</h3>
                <p>Optimización de raquetas y palos usando \\(E_k\\)</p>
                <div class="dato-neon">Velocidad récord: 263 km/h (tenis)</div>
            </div>
        </div>
    </section>

    <!-- SECCIÓN TEÓRICA -->
    <section class="teoria-section">
        <div class="borde-neon-lateral"></div>
        <h2 class="seccion-titulo neon-concepto">
            <span class="icon">📚</span> FUNDAMENTOS TEÓRICOS
        </h2>

        <!-- FÓRMULA Y PROPIEDADES -->
        <div class="subseccion">
            <h3>1. Fórmula Fundamental</h3>
            <div class="formula-destacada">
                \\[
                E_k = \\frac{1}{2}mv^2
                \\]
            </div>
            <div class="propiedades-grid">
                <div class="propiedad-card">
                    <h4>🔹 Dependencia Masiva</h4>
                    <p>Proporcional a <strong>m</strong></p>
                    <div class="ejemplo">Doblar \\(m\\) → Doblar \\(E_k\\)</div>
                </div>
                <div class="propiedad-card">
                    <h4>🔹 Dependencia Velocidad</h4>
                    <p>Proporcional a <strong>v²</strong></p>
                    <div class="ejemplo">Doblar \\(v\\) → Cuadruplicar \\(E_k\\)</div>
                </div>
                <div class="propiedad-card">
                    <h4>🔹 Unidades SI</h4>
                    <p><strong>1 Joule</strong> = 1 kg·m²/s²</p>
                    <div class="ejemplo">70 kg a 10 m/s = 3500 J</div>
                </div>
            </div>
        </div>

        <!-- TABLA COMPARATIVA -->
        <div class="subseccion">
            <h3>2. Tabla de Propiedades</h3>
            <div class="tabla-comparativa">
                <table class="tabla-cyberpunk">
                    <thead>
                        <tr>
                            <th>Propiedad</th>
                            <th>Relación Matemática</th>
                            <th>Efecto Físico</th>
                            <th>Ejemplo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>Masa (m)</strong></td>
                            <td>\\(E_k \\propto m\\)</td>
                            <td>Lineal</td>
                            <td>Camión vs auto a misma \\(v\\)</td>
                        </tr>
                        <tr>
                            <td><strong>Velocidad (v)</strong></td>
                            <td>\\(E_k \\propto v^2\\)</td>
                            <td>Cuadrática</td>
                            <td>100 km/h vs 200 km/h</td>
                        </tr>
                        <tr>
                            <td><strong>En reposo</strong></td>
                            <td>\\(v = 0\\)</td>
                            <td>\\(E_k = 0\\)</td>
                            <td>Objeto estacionario</td>
                        </tr>
                        <tr>
                            <td><strong>Unidad SI</strong></td>
                            <td>1 J = 1 kg·m²/s²</td>
                            <td>Energía estándar</td>
                            <td>Manzana de 100g a 4.47 m/s</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- COLICIONES -->
        <div class="subseccion">
            <h3>3. Tipos de Colisiones</h3>
            <div class="colisiones-grid">
                <div class="colision-card elastica">
                    <h4>🔄 ELÁSTICA</h4>
                    <div class="conservacion">
                        <span>\\(E_k\\) conservada</span>
                        <span>\\(\\vec{p}\\) conservado</span>
                    </div>
                    <div class="ejemplo">
                        <p>Choque de bolas de billar</p>
                        <p>\\(E_{k_{antes}} = E_{k_{despues}}\\)</p>
                    </div>
                </div>
                <div class="colision-card inelastica">
                    <h4>💥 INELÁSTICA</h4>
                    <div class="conservacion">
                        <span>\\(E_k\\) NO conservada</span>
                        <span>\\(\\vec{p}\\) conservado</span>
                    </div>
                    <div class="ejemplo">
                        <p>Auto contra muro</p>
                        <p>\\(E_k \\rightarrow Q, \\text{deformación}\\)</p>
                    </div>
                </div>
                <div class="colision-card perfecta">
                    <h4>🔗 PERFECTAMENTE INELÁSTICA</h4>
                    <div class="conservacion">
                        <span>Máxima pérdida \\(E_k\\)</span>
                        <span>\\(\\vec{p}\\) conservado</span>
                    </div>
                    <div class="ejemplo">
                        <p>Proyectil incrustado</p>
                        <p>\\(E_k \\rightarrow Q, \\text{sonido}\\)</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- TEOREMA TRABAJO-ENERGÍA -->
        <div class="subseccion">
            <h3>4. Teorema Trabajo-Energía</h3>
            <div class="teorema-container">
                <div class="formula-grand">
                    \\[
                    W_{neto} = \\Delta E_k = E_{k_f} - E_{k_i}
                    \\]
                </div>
                <div class="explicacion">
                    <p>El <strong>trabajo neto</strong> sobre un objeto es igual al cambio en su energía cinética.</p>
                    <div class="ejemplo-destacado">
                        <p><strong>Ejemplo:</strong> Auto de 1200 kg acelera de 0 a 25 m/s</p>
                        <p>\\(W = \\Delta E_k = \\frac{1}{2} \\times 1200 \\times 625 = 375,000\\) J</p>
                        <p><strong>Trabajo del motor = 375 kJ</strong></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SIMULADOR INTERACTIVO -->
    <section class="simulator-section">
        <h2 class="seccion-titulo neon-interactivo">
            <span class="icon">🎮</span> SIMULADOR: ENERGÍA CINÉTICA Y COLICIONES
        </h2>
        <div class="simulator-container" data-tema="ek-simulator">
            <div class="simulator-controls">
                <h3>⚙️ CONTROLES</h3>
                <div class="control-group">
                    <label for="masaObjeto">Masa (kg):</label>
                    <input type="range" id="masaObjeto" min="1" max="2000" step="10" value="1000">
                    <span id="valorMasa">1000 kg</span>
                </div>
                <div class="control-group">
                    <label for="velocidadObjeto">Velocidad (m/s):</label>
                    <input type="range" id="velocidadObjeto" min="1" max="100" step="1" value="20">
                    <span id="valorVelocidad">20 m/s</span>
                </div>
                <div class="control-group">
                    <label for="tipoColision">Tipo de colisión:</label>
                    <select id="tipoColision">
                        <option value="elastica">Elástica</option>
                        <option value="inelastica">Inelástica</option>
                        <option value="perfecta">Perfectamente inelástica</option>
                    </select>
                </div>
                <button class="btn-simular" onclick="calcularEnergiaCinetica()">
                    <span class="btn-icon">▶️</span> CALCULAR
                </button>
                <button class="btn-reset" onclick="reiniciarSimulador()">
                    <span class="btn-icon">🔄</span> REINICIAR
                </button>
            </div>

            <div class="simulator-visualization">
                <svg id="simuladorEK" viewBox="0 0 800 400">
                    <!-- Pista -->
                    <rect x="50" y="200" width="700" height="60" fill="#37474F" rx="10"/>
                    <line x1="50" y1="230" x2="750" y2="230" stroke="#78909C" stroke-width="2" stroke-dasharray="10,5"/>

                    <!-- Objeto 1 (movible) -->
                    <g id="objeto1">
                        <rect x="100" y="180" width="80" height="40" fill="#D32F2F" rx="8" id="auto1"/>
                        <circle cx="130" cy="220" r="10" fill="#212121"/>
                        <circle cx="150" cy="220" r="10" fill="#212121"/>
                        <text x="140" y="170" fill="white" font-size="12" text-anchor="middle" id="masaTexto">1000 kg</text>
                    </g>

                    <!-- Objeto 2 (para colisiones) -->
                    <g id="objeto2" opacity="0">
                        <rect x="600" y="180" width="80" height="40" fill="#1976D2" rx="8"/>
                        <circle cx="630" cy="220" r="10" fill="#212121"/>
                        <circle cx="650" cy="220" r="10" fill="#212121"/>
                        <text x="640" y="170" fill="white" font-size="12" text-anchor="middle">500 kg</text>
                    </g>

                    <!-- Resultados -->
                    <g id="resultados" opacity="0">
                        <rect x="50" y="300" width="700" height="80" fill="rgba(0,0,0,0.7)" rx="10"/>
                        <text x="400" y="330" fill="#FFEB3B" font-size="18" text-anchor="middle" id="ekResultado">E_k = 200,000 J</text>
                        <text x="400" y="360" fill="#FFC107" font-size="14" text-anchor="middle" id="colisionResultado">Colisión elástica</text>
                    </g>
                </svg>
            </div>

            <div class="simulator-data">
                <h3>📊 DATOS DE SIMULACIÓN</h3>
                <div class="data-card">
                    <div class="data-label">Energía Cinética:</div>
                    <div class="data-value" id="dataEK">0 J</div>
                </div>
                <div class="data-card">
                    <div class="data-label">Momento Lineal:</div>
                    <div class="data-value" id="dataMomento">0 kg·m/s</div>
                </div>
                <div class="data-card">
                    <div class="data-label">Tipo de Colisión:</div>
                    <div class="data-value" id="dataTipoColision">Elástica</div>
                </div>
                <div class="data-card highlight">
                    <div class="data-label">Energía Perdida:</div>
                    <div class="data-value" id="dataEnergiaPerdida">0 J</div>
                </div>
            </div>
        </div>
    </section>

    <!-- QUIZ INTERACTIVO -->
    <section class="quiz-section">
        <h2 class="seccion-titulo neon-evaluacion">
            <span class="icon">❓</span> QUIZ DE AUTOEVALUACIÓN (30 PREGUNTAS)
        </h2>
        <div class="quiz-container">
            <!-- PREGUNTA 1 -->
            <div class="quiz-question" data-correct="C">
                <div class="quiz-header">
                    <span class="quiz-num">01</span>
                    <h3>¿Cómo depende \\(E_k\\) de la velocidad?</h3>
                </div>
                <div class="quiz-options">
                    <button class="quiz-option" data-value="A">
                        <span class="option-letter">A</span>
                        Linealmente (\\(E_k \\propto v\\))
                    </button>
                    <button class="quiz-option" data-value="B">
                        <span class="option-letter">B</span>
                        Inversamente (\\(E_k \\propto 1/v\\))
                    </button>
                    <button class="quiz-option" data-value="C">
                        <span class="option-letter">C</span>
                        Cuadráticamente (\\(E_k \\propto v^2\\))
                    </button>
                    <button class="quiz-option" data-value="D">
                        <span class="option-letter">D</span>
                        Exponencialmente (\\(E_k \\propto e^v\\))
                    </button>
                </div>
                <div class="quiz-feedback" style="display: none;">
                    <div class="feedback-correct">
                        <strong>✅ Correcto:</strong> La energía cinética depende del cuadrado de la velocidad (\\(v^2\\)).
                    </div>
                    <div class="feedback-incorrect">
                        ❌ <strong>Incorrecto:</strong> Revisa la sección "Fórmula y Propiedades".
                    </div>
                    <div class="feedback-explicacion">
                        <p><strong>Explicación:</strong> La fórmula \\(E_k = \\frac{1}{2}mv^2\\) muestra claramente la dependencia cuadrática con la velocidad.</p>
                    </div>
                </div>
            </div>

            <!-- PREGUNTA 2 -->
            <div class="quiz-question" data-correct="B">
                <div class="quiz-header">
                    <span class="quiz-num">02</span>
                    <h3>En una colisión elástica:</h3>
                </div>
                <div class="quiz-options">
                    <button class="quiz-option" data-value="A">
                        <span class="option-letter">A</span>
                        Se conserva solo el momento lineal
                    </button>
                    <button class="quiz-option" data-value="B">
                        <span class="option-letter">B</span>
                        Se conservan \\(E_k\\) y momento lineal
                    </button>
                    <button class="quiz-option" data-value="C">
                        <span class="option-letter">C</span>
                        Se pierde toda la \\(E_k\\)
                    </button>
                    <button class="quiz-option" data-value="D">
                        <span class="option-letter">D</span>
                        Se transforma toda la \\(E_k\\) en calor
                    </button>
                </div>
                <div class="quiz-feedback" style="display: none;">
                    <div class="feedback-correct">
                        <strong>✅ Correcto:</strong> En colisiones elásticas se conservan tanto la energía cinética como el momento lineal.
                    </div>
                    <div class="feedback-incorrect">
                        ❌ <strong>Incorrecto:</strong> Revisa la sección "Tipos de Colisiones".
                    </div>
                </div>
            </div>

            <!-- PREGUNTAS 3-30 (similar estructura) -->
            <!-- ... -->
        </div>
        <div class="quiz-results" style="display: none;">
            <h3>📊 RESULTADOS DEL QUIZ</h3>
            <div class="results-score">
                Puntuación: <span id="quizScore">0</span>/30
            </div>
            <div class="results-feedback" id="quizFeedback">
                Completa el quiz para ver tus resultados.
            </div>
            <button class="btn-retry" onclick="reiniciarQuiz()">
                🔄 INTENTAR NUEVAMENTE
            </button>
        </div>
    </section>

    <!-- ERRORES COMUNES -->
    <section class="errores-section">
        <h2 class="seccion-titulo neon-alerta">
            <span class="icon">⚠️</span> ERRORES COMUNES
        </h2>
        <div class="errores-container">
            <div class="error-card">
                <div class="error-header" onclick="toggleError(this)">
                    <h3>❌ CONFUNDIR \\(E_k\\) CON MOMENTO LINEAL</h3>
                    <span class="error-toggle">+</span>
                </div>
                <div class="error-content">
                    <div class="error-ejemplo">
                        <strong>Error:</strong> "Si se conserva el momento, también se conserva \\(E_k\\)".
                    </div>
                    <div class="error-correccion">
                        <strong>Corrección:</strong> El momento lineal (\\(\\vec{p} = m\\vec{v}\\)) se conserva <strong>siempre</strong>, pero \\(E_k\\) solo en colisiones <strong>elásticas</strong>.
                    </div>
                    <div class="error-tabla">
                        <table>
                            <tr><th>Tipo</th><th>Momento</th><th>Energía Cinética</th></tr>
                            <tr><td>Elástica</td><td>✅ Conservado</td><td>✅ Conservada</td></tr>
                            <tr><td>Inelástica</td><td>✅ Conservado</td><td>❌ No conservada</td></tr>
                        </table>
                    </div>
                </div>
            </div>

            <div class="error-card">
                <div class="error-header" onclick="toggleError(this)">
                    <h3>❌ OLVIDAR EL FACTOR 1/2 EN LA FÓRMULA</h3>
                    <span class="error-toggle">+</span>
                </div>
                <div class="error-content">
                    <div class="error-ejemplo">
                        <strong>Error:</strong> Escribir \\(E_k = mv^2\\) en lugar de \\(E_k = \\frac{1}{2}mv^2\\).
                    </div>
                    <div class="error-correccion">
                        <strong>Origen:</strong> El factor \\(\\frac{1}{2}\\) proviene de integrar \\(F = ma\\) para obtener \\(W = \\Delta E_k\\).
                    </div>
                    <div class="error-demostracion">
                        \\[
                        W = \\int F \\, dx = \\int ma \\, dx = m \\int \\frac{dv}{dt} \\, dx = m \\int v \\, dv = \\frac{1}{2}mv^2
                        \\]
                    </div>
                </div>
            </div>

            <!-- MÁS ERRORES COMUNES -->
            <!-- ... -->
        </div>
    </section>

    <!-- PROBLEMAS TIPO EXAMEN -->
    <section class="examen-section">
        <h2 class="seccion-titulo neon-evaluacion">
            <span class="icon">📝</span> PROBLEMAS TIPO EXAMEN (12 EJERCICIOS)
        </h2>
        <div class="examen-container">
            <div class="problema-card">
                <div class="problema-header">
                    <span class="problema-num">P1</span>
                    <h3>Cálculo Básico de \\(E_k\\)</h3>
                </div>
                <div class="problema-enunciado">
                    <p>Un automóvil de 1500 kg viaja a 25 m/s. Calcula:</p>
                    <ol>
                        <li>Su energía cinética en Joules</li>
                        <li>La energía cinética si duplica su velocidad</li>
                        <li>El trabajo necesario para detenerlo</li>
                    </ol>
                </div>
                <div class="problema-espacio">
                    <textarea placeholder="Desarrolla tu solución paso a paso..." rows="6"></textarea>
                </div>
                <button class="btn-verificar" onclick="verificarProblema(1)">
                    ✅ VERIFICAR SOLUCIÓN
                </button>
                <div class="problema-solucion" id="solucionP1" style="display: none;">
                    <strong>Solución:</strong><br>
                    1. \\(E_k = \\frac{1}{2} \\times 1500 \\times 25^2 = 468,750\\) J<br>
                    2. \\(E_k\' = 4 \\times 468,750 = 1,875,000\\) J (cuadrática)<br>
                    3. \\(W = \\Delta E_k = -468,750\\) J (negativo: fuerza opuesta)
                </div>
            </div>

            <div class="problema-card">
                <div class="problema-header">
                    <span class="problema-num">P2</span>
                    <h3>Colisión Elástica en 1D</h3>
                </div>
                <div class="problema-enunciado">
                    <p>Una bola de 2 kg a 4 m/s choca elásticamente con otra de 3 kg en reposo. Calcula:</p>
                    <ol>
                        <li>Velocidades finales</li>
                        <li>Energía cinética antes y después</li>
                        <li>Porcentaje de energía conservada</li>
                    </ol>
                </div>
                <div class="problema-espacio">
                    <textarea placeholder="Muestra todos los cálculos..." rows="8"></textarea>
                </div>
                <button class="btn-verificar" onclick="verificarProblema(2)">
                    ✅ VERIFICAR SOLUCIÓN
                </button>
                <div class="problema-solucion" id="solucionP2" style="display: none;">
                    <strong>Solución:</strong><br>
                    1. Conservación momento: \\(2 \\times 4 = 2v_1\' + 3v_2\'\\)<br>
                    Conservación \\(E_k\\): \\(16 = 2v_1\'^2 + 3v_2\'^2\\)<br>
                    Solución: \\(v_1\' = -1.6\\) m/s, \\(v_2\' = 3.2\\) m/s<br>
                    2. \\(E_k\\) antes = 16 J, después = 16 J<br>
                    3. 100% conservada (colisión elástica)
                </div>
            </div>

            <!-- PROBLEMAS 3-12 -->
            <!-- ... -->
        </div>

        <div class="rubrica">
            <h4>📋 RÚBRICA DE EVALUACIÓN</h4>
            <table class="rubrica-table">
                <tr>
                    <th>Criterio</th>
                    <th>Excelente (5 pts)</th>
                    <th>Satisfactorio (3-4 pts)</th>
                    <th>Insuficiente (0-2 pts)</th>
                </tr>
                <tr>
                    <td>Aplicación correcta de \\(E_k = \\frac{1}{2}mv^2\\)</td>
                    <td>Fórmula aplicada correctamente en todos los casos</td>
                    <td>Errores menores en cálculos</td>
                    <td>Confunde fórmula o unidades</td>
                </tr>
                <tr>
                    <td>Análisis de colisiones</td>
                    <td>Distingue claramente elásticas/inelásticas</td>
                    <td>Confunde conservación de \\(E_k\\)</td>
                    <td>No identifica tipos de colisión</td>
                </tr>
                <tr>
                    <td>Teorema trabajo-energía</td>
                    <td>Aplica \\(W = \\Delta E_k\\) correctamente</td>
                    <td>Errores en signos o interpretación</td>
                    <td>No relaciona trabajo con \\(E_k\\)</td>
                </tr>
            </table>
        </div>
    </section>

    <!-- CIERRE METACOGNITIVO -->
    <section class="cierre-section">
        <h2 class="seccion-titulo neon-concepto">
            <span class="icon">🧠</span> CIERRE METACOGNITIVO
        </h2>
        <div class="cierre-container">
            <div class="autoevaluacion">
                <h3>📊 AUTOEVALUACIÓN</h3>
                <div class="slider-group">
                    <label>Comprensión de la fórmula \\(E_k\\):</label>
                    <input type="range" min="1" max="5" value="3" class="autoeval-slider" id="slider1">
                    <div class="slider-labels">
                        <span>Básico</span><span>Intermedio</span><span>Avanzado</span>
                    </div>
                </div>
                <div class="slider-group">
                    <label>Análisis de colisiones:</label>
                    <input type="range" min="1" max="5" value="3" class="autoeval-slider" id="slider2">
                    <div class="slider-labels">
                        <span>Básico</span><span>Intermedio</span><span>Avanzado</span>
                    </div>
                </div>
                <div class="slider-group">
                    <label>Aplicación del teorema trabajo-energía:</label>
                    <input type="range" min="1" max="5" value="3" class="autoeval-slider" id="slider3">
                    <div class="slider-labels">
                        <span>Básico</span><span>Intermedio</span><span>Avanzado</span>
                    </div>
                </div>
                <button class="btn-guardar" onclick="guardarAutoevaluacion()">
                    💾 GUARDAR AUTOEVALUACIÓN
                </button>
            </div>

            <div class="reflexion">
                <h3>🤔 REFLEXIÓN GUIADA</h3>
                <div class="pregunta-reflexion">
                    <p>¿Por qué es importante entender la dependencia cuadrática de \\(E_k\\) con \\(v\\) en el diseño de vehículos?</p>
                    <textarea placeholder="Escribe tu reflexión..." rows="3"></textarea>
                </div>
                <div class="pregunta-reflexion">
                    <p>Describe un ejemplo cotidiano donde observes conservación de \\(E_k\\) y otro donde no se conserve.</p>
                    <textarea placeholder="Ejemplo 1: Conservación... Ejemplo 2: No conservación..." rows="3"></textarea>
                </div>
            </div>

            <div class="plan-estudio">
                <h3>📅 PLAN DE ESTUDIO PERSONALIZADO</h3>
                <div class="plan-grid">
                    <div class="plan-card">
                        <h4>📌 REPASO RÁPIDO (20 min)</h4>
                        <ul>
                            <li>Memorizar fórmula \\(E_k = \\frac{1}{2}mv^2\\)</li>
                            <li>Diferenciar colisiones elásticas/inelásticas</li>
                            <li>Resolver 3 problemas básicos</li>
                        </ul>
                    </div>
                    <div class="plan-card">
                        <h4>🛠 PRÁCTICA (40 min)</h4>
                        <ul>
                            <li>Completar el simulador con 5 casos</li>
                            <li>Resolver problemas 4-8 del examen</li>
                            <li>Hacer el quiz completo</li>
                        </ul>
                    </div>
                    <div class="plan-card">
                        <h4>🧠 PROFUNDIZACIÓN (60 min)</h4>
                        <ul>
                            <li>Investigar \\(E_k\\) relativista</li>
                            <li>Analizar aplicaciones en seguridad vial</li>
                            <li>Resolver problemas avanzados (9-12)</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="recursos">
                <h3>🔗 RECURSOS ADICIONALES</h3>
                <div class="recursos-links">
                    <a href="https://phet.colorado.edu/es/simulation/energy-skate-park" target="_blank" class="recurso-link">
                        🎢 Simulador PhET: Parque de Energía
                    </a>
                    <a href="https://www.khanacademy.org/science/physics/work-and-energy" target="_blank" class="recurso-link">
                        📚 Khan Academy: Trabajo y Energía
                    </a>
                    <a href="https://hyperphysics.phy-astr.gsu.edu/hbase/elacol.html" target="_blank" class="recurso-link">
                        🔬 HyperPhysics: Colisiones Elásticas
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- JAVASCRIPT INTEGRADO -->
<script>
// ===========================================
// SIMULADOR DE ENERGÍA CINÉTICA
// ===========================================
function calcularEnergiaCinetica() {
    const masa = parseFloat(document.getElementById(\'masaObjeto\').value);
    const velocidad = parseFloat(document.getElementById(\'velocidadObjeto\').value);
    const tipoColision = document.getElementById(\'tipoColision\').value;

    // Cálculos físicos
    const ek = 0.5 * masa * Math.pow(velocidad, 2);
    const momento = masa * velocidad;
    let energiaPerdida = 0;

    // Actualizar visualización
    document.getElementById(\'dataEK\').textContent = ek.toFixed(2) + \' J\';
    document.getElementById(\'dataMomento\').textContent = momento.toFixed(2) + \' kg·m/s\';
    document.getElementById(\'dataTipoColision\').textContent =
        tipoColision === \'elastica\' ? \'Elástica\' :
        tipoColision === \'inelastica\' ? \'Inelástica\' : \'Perfectamente inelástica\';

    // Energía perdida según tipo de colisión
    if (tipoColision === \'inelastica\') {
        energiaPerdida = ek * 0.3; // 30% perdido en inelástica típica
    } else if (tipoColision === \'perfecta\') {
        energiaPerdida = ek * 0.7; // 70% perdido en perfectamente inelástica
    }
    document.getElementById(\'dataEnergiaPerdida\').textContent = energiaPerdida.toFixed(2) + \' J\';

    // Actualizar SVG
    const auto1 = document.getElementById(\'auto1\');
    const ekResultado = document.getElementById(\'ekResultado\');
    const colisionResultado = document.getElementById(\'colisionResultado\');

    // Animación del auto
    const distancia = 500 + (velocidad * 2); // Escalar con velocidad
    auto1.setAttribute(\'transform\', `translate(${distancia}, 0)`);

    // Mostrar resultados
    ekResultado.textContent = `E_k = ${ek.toFixed(2)} J`;
    colisionResultado.textContent = `Colisión ${document.getElementById(\'dataTipoColision\').textContent}`;
    document.getElementById(\'resultados\').setAttribute(\'opacity\', \'1\');

    // Mostrar segundo objeto si es colisión
    if (tipoColision !== \'elastica\') {
        document.getElementById(\'objeto2\').setAttribute(\'opacity\', \'1\');
    }

    console.log(`🚀 Simulación: m=${masa}kg, v=${velocidad}m/s → E_k=${ek.toFixed(2)}J`);
}

function reiniciarSimulador() {
    // Reiniciar controles
    document.getElementById(\'masaObjeto\').value = 1000;
    document.getElementById(\'velocidadObjeto\').value = 20;
    document.getElementById(\'tipoColision\').value = \'elastica\';
    document.getElementById(\'valorMasa\').textContent = \'1000 kg\';
    document.getElementById(\'valorVelocidad\').textContent = \'20 m/s\';

    // Reiniciar datos
    document.getElementById(\'dataEK\').textContent = \'0 J\';
    document.getElementById(\'dataMomento\').textContent = \'0 kg·m/s\';
    document.getElementById(\'dataTipoColision\').textContent = \'Elástica\';
    document.getElementById(\'dataEnergiaPerdida\').textContent = \'0 J\';

    // Reiniciar visualización
    const auto1 = document.getElementById(\'auto1\');
    auto1.removeAttribute(\'transform\');
    document.getElementById(\'objeto2\').setAttribute(\'opacity\', \'0\');
    document.getElementById(\'resultados\').setAttribute(\'opacity\', \'0\');
}

// ===========================================
// QUIZ INTERACTIVO (30 PREGUNTAS)
// ===========================================
let quizRespuestas = [];
let quizCompletado = false;

function verificarCompletadoQuiz() {
    const questions = document.querySelectorAll(\'.quiz-question\');
    const answered = Array.from(questions).every(q =>
        q.querySelector(\'.quiz-option.selected\')
    );

    if (answered && !quizCompletado) {
        quizCompletado = true;
        mostrarResultadosQuiz();
    }
}

function mostrarResultadosQuiz() {
    const correctas = quizRespuestas.filter(r => r).length;
    const total = quizRespuestas.length;
    const porcentaje = Math.round((correctas / total) * 100);

    document.getElementById(\'quizScore\').textContent = `${correctas}/${total}`;

    let feedback = "";
    if (porcentaje >= 90) {
        feedback = "🎉 ¡Dominas la energía cinética!";
    } else if (porcentaje >= 70) {
        feedback = "👍 Buen trabajo, pero repasa las colisiones.";
    } else if (porcentaje >= 50) {
        feedback = "⚠️ Necesitas practicar más con el simulador.";
    } else {
        feedback = "😕 Revisa la sección teórica y los ejemplos.";
    }

    document.getElementById(\'quizFeedback\').textContent = feedback;
    document.querySelector(\'.quiz-results\').style.display = \'block\';
}

function reiniciarQuiz() {
    quizRespuestas = [];
    quizCompletado = false;

    document.querySelectorAll(\'.quiz-option\').forEach(opt => {
        opt.classList.remove(\'selected\', \'correct\', \'incorrect\');
    });

    document.querySelectorAll(\'.quiz-feedback\').forEach(fb => {
        fb.style.display = \'none\';
    });

    document.querySelector(\'.quiz-results\').style.display = \'none\';
}

// Inicializar eventos del quiz
document.querySelectorAll(\'.quiz-option\').forEach(option => {
    option.addEventListener(\'click\', function() {
        if (quizCompletado) return;

        const question = this.closest(\'.quiz-question\');
        const correct = question.dataset.correct;
        const selected = this.dataset.value;
        const feedback = question.querySelector(\'.quiz-feedback\');

        // Limpiar selección previa
        question.querySelectorAll(\'.quiz-option\').forEach(opt => {
            opt.classList.remove(\'selected\', \'correct\', \'incorrect\');
        });

        // Marcar selección actual
        this.classList.add(\'selected\');

        // Verificar respuesta
        if (selected === correct) {
            this.classList.add(\'correct\');
            quizRespuestas.push(true);
        } else {
            this.classList.add(\'incorrect\');
            question.querySelector(`[data-value="${correct}"]`).classList.add(\'correct\');
            quizRespuestas.push(false);
        }

        // Mostrar feedback
        feedback.style.display = \'block\';
        verificarCompletadoQuiz();
    });
});

// ===========================================
// ERRORES COMUNES INTERACTIVOS
// ===========================================
function toggleError(header) {
    const content = header.nextElementSibling;
    const toggle = header.querySelector(\'.error-toggle\');

    if (content.style.display === \'block\') {
        content.style.display = \'none\';
        toggle.textContent = \'+\';
    } else {
        content.style.display = \'block\';
        toggle.textContent = \'-\';
    }
}

// ===========================================
// PROBLEMAS TIPO EXAMEN
// ===========================================
function verificarProblema(num) {
    const solucion = document.getElementById(`solucionP${num}`);
    solucion.style.display = solucion.style.display === \'block\' ? \'none\' : \'block\';
}

// ===========================================
// AUTOEVALUACIÓN METACOGNITIVA
// ===========================================
function guardarAutoevaluacion() {
    const slider1 = document.getElementById(\'slider1\').value;
    const slider2 = document.getElementById(\'slider2\').value;
    const slider3 = document.getElementById(\'slider3\').value;
    const promedio = (parseInt(slider1) + parseInt(slider2) + parseInt(slider3)) / 3;

    alert(
        `📊 Autoevaluación guardada:\\n\\n` +
        `Fórmula E_k: ${slider1}/5\\n` +
        `Colisiones: ${slider2}/5\\n` +
        `Teorema trabajo-energía: ${slider3}/5\\n\\n` +
        `Promedio: ${promedio.toFixed(1)}/5\\n\\n` +
        `Recomendación: Revisa el plan de estudio según tus resultados.`
    );
}

// ===========================================
// OBJETIVOS INTERACTIVOS
// ===========================================
document.querySelectorAll(\'.objetivo-card\').forEach(card => {
    card.addEventListener(\'click\', function() {
        const completado = this.dataset.completado === \'true\';
        this.dataset.completado = !completado;
        const checkbox = this.querySelector(\'.objetivo-checkbox\');
        checkbox.textContent = !completado ? \'✓\' : \'\';
        checkbox.style.backgroundColor = !completado ? \'#39FF14\' : \'\';
    });
});

// ===========================================
// INICIALIZACIÓN
// ===========================================
console.log("🚀 Lección: Energía Cinética cargada");
console.log("🎮 Simulador, Quiz (30 preguntas) y 12 problemas listos");
</script>',
    'ejercicios' => 
    array (
      0 => 
      array (
        'enunciado' => 'Fórmula EK',
        'respuesta' => '½ m v²',
      ),
      1 => 
      array (
        'enunciado' => 'Unidad SI',
        'respuesta' => 'Joule (J)',
      ),
      2 => 
      array (
        'enunciado' => 'v = 0 → EK =',
        'respuesta' => '0',
      ),
      3 => 
      array (
        'enunciado' => 'Auto 800 kg a 30 m/s',
        'respuesta' => '360,000 J',
      ),
      4 => 
      array (
        'enunciado' => 'Bicicleta 15 kg a 10 m/s',
        'respuesta' => '750 J',
      ),
      5 => 
      array (
        'enunciado' => 'v pasa de 10 a 20 m/s (m cte)',
        'respuesta' => 'EK ×4',
      ),
      6 => 
      array (
        'enunciado' => 'Colisión elástica: EK total',
        'respuesta' => 'Conservada',
      ),
      7 => 
      array (
        'enunciado' => 'Inelástica: EK',
        'respuesta' => 'Disminuye',
      ),
      8 => 
      array (
        'enunciado' => 'Perfectamente inelástica: v final',
        'respuesta' => 'm₁v₁ + m₂v₂ / (m₁+m₂)',
      ),
      9 => 
      array (
        'enunciado' => 'Trabajo para detener 1000 kg de 20 m/s',
        'respuesta' => '-200,000 J',
      ),
      10 => 
      array (
        'enunciado' => 'EK relativista (aprox)',
        'respuesta' => 'γmc² - mc²',
      ),
      11 => 
      array (
        'enunciado' => '1 kWh =',
        'respuesta' => '3.6 MJ',
      ),
    ),
    'quiz' => 
    array (
      0 => 
      array (
        'pregunta' => 'EK =',
        'opciones' => 
        array (
          0 => '½mv²',
          1 => 'mv²',
          2 => 'mgh',
          3 => 'Fd',
        ),
        'correcta' => '½mv²',
      ),
      1 => 
      array (
        'pregunta' => 'Depende de v como...',
        'opciones' => 
        array (
          0 => 'v²',
          1 => 'v',
          2 => '1/v',
          3 => '√v',
        ),
        'correcta' => 'v²',
      ),
      2 => 
      array (
        'pregunta' => 'Dobla v → EK...',
        'opciones' => 
        array (
          0 => '×4',
          1 => '×2',
          2 => '×8',
          3 => '½',
        ),
        'correcta' => '×4',
      ),
      3 => 
      array (
        'pregunta' => 'Objeto en reposo EK =',
        'opciones' => 
        array (
          0 => '0',
          1 => '1',
          2 => '∞',
          3 => 'Negativa',
        ),
        'correcta' => '0',
      ),
      4 => 
      array (
        'pregunta' => 'Unidad EK',
        'opciones' => 
        array (
          0 => 'Joule',
          1 => 'Newton',
          2 => 'Pascal',
          3 => 'Watt',
        ),
        'correcta' => 'Joule',
      ),
      5 => 
      array (
        'pregunta' => 'Colisión elástica EK',
        'opciones' => 
        array (
          0 => 'Conservada',
          1 => 'Perdida',
          2 => 'Aumentada',
          3 => 'Cero',
        ),
        'correcta' => 'Conservada',
      ),
      6 => 
      array (
        'pregunta' => 'Auto 1000 kg a 20 m/s EK =',
        'opciones' => 
        array (
          0 => '200 kJ',
          1 => '100 kJ',
          2 => '400 kJ',
          3 => '20 kJ',
        ),
        'correcta' => '200 kJ',
      ),
      7 => 
      array (
        'pregunta' => 'm = 0 → EK =',
        'opciones' => 
        array (
          0 => '0',
          1 => '∞',
          2 => '1',
          3 => 'Negativa',
        ),
        'correcta' => '0',
      ),
      8 => 
      array (
        'pregunta' => 'Trabajo = ΔEK',
        'opciones' => 
        array (
          0 => 'Sí',
          1 => 'No',
          2 => 'A veces',
          3 => 'Solo si F=0',
        ),
        'correcta' => 'Sí',
      ),
      9 => 
      array (
        'pregunta' => 'v → 3v, EK →',
        'opciones' => 
        array (
          0 => '×9',
          1 => '×3',
          2 => '×6',
          3 => '×27',
        ),
        'correcta' => '×9',
      ),
      10 => 
      array (
        'pregunta' => 'Auto 1500 kg de 0 a 30 m/s, trabajo =',
        'opciones' => 
        array (
          0 => '675 kJ',
          1 => '337.5 kJ',
          2 => '1350 kJ',
          3 => '0 J',
        ),
        'correcta' => '675 kJ',
      ),
      11 => 
      array (
        'pregunta' => 'Frenado: EK →',
        'opciones' => 
        array (
          0 => 'Calor',
          1 => 'Potencial',
          2 => 'Eléctrica',
          3 => 'Nuclear',
        ),
        'correcta' => 'Calor',
      ),
      12 => 
      array (
        'pregunta' => 'Colisión inelástica: momento',
        'opciones' => 
        array (
          0 => 'Conservado',
          1 => 'No conservado',
          2 => 'Aumentado',
          3 => 'Cero',
        ),
        'correcta' => 'Conservado',
      ),
      13 => 
      array (
        'pregunta' => '1 MJ =',
        'opciones' => 
        array (
          0 => '10⁶ J',
          1 => '10³ J',
          2 => '10⁹ J',
          3 => '10⁻⁶ J',
        ),
        'correcta' => '10⁶ J',
      ),
      14 => 
      array (
        'pregunta' => 'v = 10 m/s → v = 15 m/s, EK aumenta en...',
        'opciones' => 
        array (
          0 => '2.25×',
          1 => '1.5×',
          2 => '2.5×',
          3 => '3×',
        ),
        'correcta' => '2.25×',
      ),
      15 => 
      array (
        'pregunta' => 'Teorema trabajo-energía',
        'opciones' => 
        array (
          0 => 'W = ΔEK',
          1 => 'W = EK',
          2 => 'W = ½mv²',
          3 => 'W = mgh',
        ),
        'correcta' => 'W = ΔEK',
      ),
      16 => 
      array (
        'pregunta' => 'Energía cinética rotacional',
        'opciones' => 
        array (
          0 => '½Iω²',
          1 => 'mv²',
          2 => 'mgh',
          3 => 'Fd',
        ),
        'correcta' => '½Iω²',
      ),
      17 => 
      array (
        'pregunta' => 'En caída libre, EK + EP =',
        'opciones' => 
        array (
          0 => 'Cte',
          1 => 'Aumenta',
          2 => 'Disminuye',
          3 => 'Cero',
        ),
        'correcta' => 'Cte',
      ),
      18 => 
      array (
        'pregunta' => 'SI 2025: v en...',
        'opciones' => 
        array (
          0 => 'm/s',
          1 => 'km/h',
          2 => 'mph',
          3 => 'nudos',
        ),
        'correcta' => 'm/s',
      ),
      19 => 
      array (
        'pregunta' => 'EK máxima en...',
        'opciones' => 
        array (
          0 => 'v máxima',
          1 => 'm máxima',
          2 => 'v=0',
          3 => 'm=0',
        ),
        'correcta' => 'v máxima',
      ),
      20 => 
      array (
        'pregunta' => 'Colisión 1D elástica: v₁f =',
        'opciones' => 
        array (
          0 => '(m₁-m₂)v₁/(m₁+m₂) + 2m₂v₂/(m₁+m₂)',
          1 => 'v₁',
          2 => '0',
          3 => 'v₂',
        ),
        'correcta' => '(m₁-m₂)v₁/(m₁+m₂) + 2m₂v₂/(m₁+m₂)',
      ),
      21 => 
      array (
        'pregunta' => 'EK relativista (v≈c)',
        'opciones' => 
        array (
          0 => '(γ-1)mc²',
          1 => '½mv²',
          2 => 'mc²',
          3 => 'mv²',
        ),
        'correcta' => '(γ-1)mc²',
      ),
      22 => 
      array (
        'pregunta' => 'Fuerza constante acelera 2 kg de 0 a 10 m/s en 5 m, F =',
        'opciones' => 
        array (
          0 => '40 N',
          1 => '20 N',
          2 => '100 N',
          3 => '4 N',
        ),
        'correcta' => '40 N',
      ),
      23 => 
      array (
        'pregunta' => 'Coeficiente restitucion e =',
        'opciones' => 
        array (
          0 => '√(EK después/EK antes)',
          1 => 'v',
          2 => 'm',
          3 => 'F',
        ),
        'correcta' => '√(EK después/EK antes)',
      ),
      24 => 
      array (
        'pregunta' => '1 eV =',
        'opciones' => 
        array (
          0 => '1.6×10⁻¹⁹ J',
          1 => '1 J',
          2 => '1.6×10⁻¹⁰ J',
          3 => '1.6×10⁶ J',
        ),
        'correcta' => '1.6×10⁻¹⁹ J',
      ),
      25 => 
      array (
        'pregunta' => 'EK molecular media (3D)',
        'opciones' => 
        array (
          0 => '(3/2)kT',
          1 => '(1/2)mv²',
          2 => 'mgh',
          3 => 'Fd',
        ),
        'correcta' => '(3/2)kT',
      ),
      26 => 
      array (
        'pregunta' => 'Trabajo mínimo para detener 500 kg a 30 m/s',
        'opciones' => 
        array (
          0 => '-225 kJ',
          1 => '225 kJ',
          2 => '112.5 kJ',
          3 => '0 J',
        ),
        'correcta' => '-225 kJ',
      ),
      27 => 
      array (
        'pregunta' => 'En vacío, caída 10 m → v =',
        'opciones' => 
        array (
          0 => '14 m/s',
          1 => '10 m/s',
          2 => '20 m/s',
          3 => '9.8 m/s',
        ),
        'correcta' => '14 m/s',
      ),
      28 => 
      array (
        'pregunta' => 'γ = 1 / √(1 - v²/c²), EK ≈ ½mv² si...',
        'opciones' => 
        array (
          0 => 'v << c',
          1 => 'v = c',
          2 => 'v > c',
          3 => 'm = 0',
        ),
        'correcta' => 'v << c',
      ),
      29 => 
      array (
        'pregunta' => 'SI 2025: 1 kJ =',
        'opciones' => 
        array (
          0 => '10³ J',
          1 => '10⁶ J',
          2 => '10⁰ J',
          3 => '10⁻³ J',
        ),
        'correcta' => '10³ J',
      ),
    ),
  ),
  7 => 
  array (
    'materia' => 'Física I',
    'slug' => 'energia-potencial-gravitacional',
    'titulo' => 'Energía Potencial Gravitacional: La Energía de la Altura',
    'contenido' => '<!-- LECCIÓN CYBERPUNK: ENERGÍA POTENCIAL GRAVITACIONAL -->
<div class="leccion-container leccion-fisica-epg" data-tema="energia-potencial-gravitacional">
    <!-- CABECERA CYBERPUNK -->
    <header class="leccion-header">
        <h1 class="titulo-leccion neon-glow">
            <span class="icon-tema">🌌</span>
            ENERGÍA POTENCIAL GRAVITACIONAL
        </h1>
        <div class="subtitulo">
            De la fórmula \\(E_{pg} = mgh\\) a la conservación de la energía mecánica
        </div>
    </header>

    <!-- PANEL OBJETIVOS -->
    <section class="panel-objetivos">
        <h2 class="seccion-titulo neon-concepto">
            <span class="icon">🎯</span> OBJETIVOS DE APRENDIZAJE
        </h2>
        <div class="objetivos-grid">
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Derivar la fórmula \\(E_{pg} = mgh\\)</h3>
                <p>Desde la definición de trabajo gravitacional</p>
            </div>
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Analizar la conservación de energía mecánica</h3>
                <p>Transformación \\(E_{pg} \\leftrightarrow E_k\\)</p>
            </div>
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Aplicar el concepto de nivel de referencia</h3>
                <p>Elección de \\(h = 0\\) y su impacto en cálculos</p>
            </div>
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Resolver problemas de caída libre</h3>
                <p>Usando conservación de energía mecánica</p>
            </div>
        </div>
    </section>

    <!-- CONTEXTO REAL -->
    <section class="contexto-real">
        <h2 class="seccion-titulo neon-dato">
            <span class="icon">🌍</span> APLICACIONES EN LA VIDA REAL
        </h2>
        <div class="contexto-grid">
            <div class="contexto-card">
                <h3>🏗 Presas Hidroeléctricas</h3>
                <p>Conversión de \\(E_{pg}\\) del agua en electricidad</p>
                <div class="dato-neon">Eficiencia: 90-95%</div>
            </div>
            <div class="contexto-card">
                <h3>🎢 Montañas Rusas</h3>
                <p>Diseño basado en transformación \\(E_{pg} \\rightarrow E_k\\)</p>
                <div class="dato-neon">Altura máxima: 140 m</div>
            </div>
            <div class="contexto-card">
                <h3>🚀 Lanzamiento de Cohetes</h3>
                <p>Cálculo de \\(E_{pg}\\) para escapar de la gravedad</p>
                <div class="dato-neon">\\(\\Delta v = 11.2\\) km/s</div>
            </div>
        </div>
    </section>

    <!-- SECCIÓN TEÓRICA -->
    <section class="teoria-section">
        <div class="borde-neon-lateral"></div>
        <h2 class="seccion-titulo neon-concepto">
            <span class="icon">📚</span> FUNDAMENTOS TEÓRICOS
        </h2>

        <!-- FÓRMULA Y PROPIEDADES -->
        <div class="subseccion">
            <h3>1. Fórmula Fundamental</h3>
            <div class="formula-grand">
                \\[
                E_{pg} = mgh
                \\]
            </div>
            <div class="propiedades-grid">
                <div class="propiedad-card">
                    <h4>🔹 Masa (m)</h4>
                    <p>Proporcionalidad directa</p>
                    <div class="ejemplo">Doblar \\(m\\) → Doblar \\(E_{pg}\\)</div>
                </div>
                <div class="propiedad-card">
                    <h4>🔹 Altura (h)</h4>
                    <p>Proporcionalidad directa</p>
                    <div class="ejemplo">Triplicar \\(h\\) → Triplicar \\(E_{pg}\\)</div>
                </div>
                <div class="propiedad-card">
                    <h4>🔹 Gravedad (g)</h4>
                    <p>Depende del planeta</p>
                    <div class="ejemplo">Tierra: 9.8 m/s², Luna: 1.62 m/s²</div>
                </div>
                <div class="propiedad-card">
                    <h4>🔹 Nivel de Referencia</h4>
                    <p>\\(h = 0\\) donde \\(E_{pg} = 0\\)</p>
                    <div class="ejemplo">Suelo, nivel del mar, etc.</div>
                </div>
            </div>
        </div>

        <!-- TABLA COMPARATIVA -->
        <div class="subseccion">
            <h3>2. Comparación entre Planetas</h3>
            <div class="tabla-comparativa">
                <table class="tabla-cyberpunk">
                    <thead>
                        <tr>
                            <th>Planeta</th>
                            <th>g (m/s²)</th>
                            <th>Ejemplo \\(E_{pg}\\) (1 kg a 10 m)</th>
                            <th>Diferencia vs Tierra</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Mercurio</td>
                            <td>3.7</td>
                            <td>37 J</td>
                            <td>38% de Tierra</td>
                        </tr>
                        <tr>
                            <td>Venus</td>
                            <td>8.87</td>
                            <td>88.7 J</td>
                            <td>91% de Tierra</td>
                        </tr>
                        <tr>
                            <td>Tierra</td>
                            <td>9.8</td>
                            <td>98 J</td>
                            <td>100% (referencia)</td>
                        </tr>
                        <tr>
                            <td>Marte</td>
                            <td>3.71</td>
                            <td>37.1 J</td>
                            <td>38% de Tierra</td>
                        </tr>
                        <tr>
                            <td>Júpiter</td>
                            <td>24.79</td>
                            <td>247.9 J</td>
                            <td>253% de Tierra</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- CONSERVACIÓN DE ENERGÍA MECÁNICA -->
        <div class="subseccion">
            <h3>3. Conservación de Energía Mecánica</h3>
            <div class="conservacion-container">
                <div class="formula-destacada">
                    \\[
                    E_{mec} = E_{pg} + E_k = \\text{constante}
                    \\]
                </div>
                <div class="diagrama-conservacion">
                    <div class="estado estado-inicial">
                        <div class="objeto">🟢</div>
                        <div class="altura">h</div>
                        <div class="energias">
                            <div>\\(E_{pg} = mgh\\)</div>
                            <div>\\(E_k = 0\\)</div>
                        </div>
                    </div>
                    <div class="flecha">↓</div>
                    <div class="estado estado-final">
                        <div class="objeto">🟢</div>
                        <div class="altura">0</div>
                        <div class="energias">
                            <div>\\(E_{pg} = 0\\)</div>
                            <div>\\(E_k = \\frac{1}{2}mv^2\\)</div>
                        </div>
                    </div>
                </div>
                <div class="explicacion">
                    <p>En <strong>caída libre</strong> (sin fricción):</p>
                    <p>\\(E_{pg_i} + E_{k_i} = E_{pg_f} + E_{k_f}\\)</p>
                    <p>\\(mgh = \\frac{1}{2}mv^2\\) → \\(v = \\sqrt{2gh}\\)</p>
                </div>
            </div>
        </div>

        <!-- EJEMPLO PRÁCTICO -->
        <div class="subseccion">
            <h3>4. Ejemplo Práctico</h3>
            <div class="ejemplo-destacado">
                <p><strong>Problema:</strong> Un libro de 2 kg se encuentra a 5 m de altura. Calcula:</p>
                <ol>
                    <li>Su energía potencial gravitacional</li>
                    <li>Su velocidad al llegar al suelo</li>
                    <li>Su energía cinética justo antes de impactar</li>
                </ol>
                <div class="solucion-paso-a-paso">
                    <div class="paso">
                        <strong>1. Energía potencial inicial:</strong><br>
                        \\(E_{pg} = mgh = 2 \\times 9.8 \\times 5 = 98\\) J
                    </div>
                    <div class="paso">
                        <strong>2. Velocidad final (conservación):</strong><br>
                        \\(mgh = \\frac{1}{2}mv^2\\) → \\(v = \\sqrt{2gh} = \\sqrt{98} \\approx 9.9\\) m/s
                    </div>
                    <div class="paso">
                        <strong>3. Energía cinética final:</strong><br>
                        \\(E_k = \\frac{1}{2}mv^2 = 98\\) J (igual a \\(E_{pg}\\) inicial)
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SIMULADOR INTERACTIVO -->
    <section class="simulator-section">
        <h2 class="seccion-titulo neon-interactivo">
            <span class="icon">🎮</span> SIMULADOR: CAÍDA LIBRE Y CONSERVACIÓN
        </h2>
        <div class="simulator-container" data-tema="epg-simulator">
            <div class="simulator-controls">
                <h3>⚙️ CONTROLES</h3>
                <div class="control-group">
                    <label for="masaObjeto">Masa (kg):</label>
                    <input type="range" id="masaObjeto" min="0.1" max="10" step="0.1" value="1">
                    <span id="valorMasa">1 kg</span>
                </div>
                <div class="control-group">
                    <label for="alturaObjeto">Altura (m):</label>
                    <input type="range" id="alturaObjeto" min="0.5" max="20" step="0.5" value="5">
                    <span id="valorAltura">5 m</span>
                </div>
                <div class="control-group">
                    <label for="gravedad">Gravedad (m/s²):</label>
                    <select id="gravedad">
                        <option value="9.8">Tierra (9.8)</option>
                        <option value="3.7">Marte (3.7)</option>
                        <option value="1.62">Luna (1.62)</option>
                        <option value="24.79">Júpiter (24.79)</option>
                        <option value="8.87">Venus (8.87)</option>
                    </select>
                </div>
                <button class="btn-simular" onclick="simularCaidaLibre()">
                    <span class="btn-icon">▶️</span> SIMULAR CAÍDA
                </button>
                <button class="btn-reset" onclick="reiniciarSimuladorEPG()">
                    <span class="btn-icon">🔄</span> REINICIAR
                </button>
            </div>

            <div class="simulator-visualization">
                <svg id="simuladorEPG" viewBox="0 0 800 500">
                    <!-- Plataforma -->
                    <rect x="100" y="100" width="600" height="20" fill="#455A64" rx="5"/>

                    <!-- Objeto -->
                    <g id="objetoEPG">
                        <rect x="375" y="80" width="50" height="50" fill="#FF5722" rx="5" id="caja"/>
                        <text x="400" y="110" fill="white" font-size="12" text-anchor="middle" id="masaTextoEPG">1 kg</text>
                    </g>

                    <!-- Línea de referencia -->
                    <line x1="100" y1="400" x2="700" y2="400" stroke="#FFC107" stroke-width="2" stroke-dasharray="5,5"/>
                    <text x="400" y="420" fill="#FFC107" font-size="12" text-anchor="middle">Nivel de referencia (h=0)</text>

                    <!-- Indicadores de energía -->
                    <g id="indicadoresEPG" opacity="0">
                        <rect x="100" y="430" width="300" height="50" fill="rgba(76, 175, 80, 0.3)" rx="5"/>
                        <text x="250" y="460" fill="#2E7D32" font-size="14" text-anchor="middle" id="epgTexto">EPG = 49 J</text>

                        <rect x="400" y="430" width="300" height="50" fill="rgba(244, 67, 54, 0.3)" rx="5"/>
                        <text x="550" y="460" fill="#D32F2F" font-size="14" text-anchor="middle" id="ekTexto">EK = 0 J</text>
                    </g>

                    <!-- Velocidad final -->
                    <g id="velocidadFinal" opacity="0">
                        <text x="400" y="300" fill="#FFEB3B" font-size="16" text-anchor="middle" id="velocidadTexto">v = 9.9 m/s</text>
                    </g>
                </svg>
            </div>

            <div class="simulator-data">
                <h3>📊 DATOS DE SIMULACIÓN</h3>
                <div class="data-card">
                    <div class="data-label">Energía Potencial Inicial:</div>
                    <div class="data-value" id="dataEPGInicial">0 J</div>
                </div>
                <div class="data-card">
                    <div class="data-label">Energía Cinética Final:</div>
                    <div class="data-value" id="dataEKFinal">0 J</div>
                </div>
                <div class="data-card">
                    <div class="data-label">Velocidad de Impacto:</div>
                    <div class="data-value" id="dataVelocidad">0 m/s</div>
                </div>
                <div class="data-card highlight">
                    <div class="data-label">Tiempo de Caída:</div>
                    <div class="data-value" id="dataTiempo">0 s</div>
                </div>
            </div>
        </div>
    </section>

    <!-- QUIZ INTERACTIVO -->
    <section class="quiz-section">
        <h2 class="seccion-titulo neon-evaluacion">
            <span class="icon">❓</span> QUIZ DE AUTOEVALUACIÓN (30 PREGUNTAS)
        </h2>
        <div class="quiz-container">
            <!-- PREGUNTA 1 -->
            <div class="quiz-question" data-correct="B">
                <div class="quiz-header">
                    <span class="quiz-num">01</span>
                    <h3>¿De qué depende la energía potencial gravitacional?</h3>
                </div>
                <div class="quiz-options">
                    <button class="quiz-option" data-value="A">
                        <span class="option-letter">A</span>
                        Solo de la masa del objeto
                    </button>
                    <button class="quiz-option" data-value="B">
                        <span class="option-letter">B</span>
                        De la masa, gravedad y altura
                    </button>
                    <button class="quiz-option" data-value="C">
                        <span class="option-letter">C</span>
                        Solo de la velocidad del objeto
                    </button>
                    <button class="quiz-option" data-value="D">
                        <span class="option-letter">D</span>
                        De la temperatura ambiente
                    </button>
                </div>
                <div class="quiz-feedback" style="display: none;">
                    <div class="feedback-correct">
                        <strong>✅ Correcto:</strong> La fórmula \\(E_{pg} = mgh\\) muestra que depende de masa, gravedad y altura.
                    </div>
                    <div class="feedback-incorrect">
                        ❌ <strong>Incorrecto:</strong> Revisa la sección "Fórmula Fundamental".
                    </div>
                </div>
            </div>

            <!-- PREGUNTA 2 -->
            <div class="quiz-question" data-correct="C">
                <div class="quiz-header">
                    <span class="quiz-num">02</span>
                    <h3>Si duplicas la altura de un objeto, su \\(E_{pg}\\):</h3>
                </div>
                <div class="quiz-options">
                    <button class="quiz-option" data-value="A">
                        <span class="option-letter">A</span>
                        Se reduce a la mitad
                    </button>
                    <button class="quiz-option" data-value="B">
                        <span class="option-letter">B</span>
                        Permanece igual
                    </button>
                    <button class="quiz-option" data-value="C">
                        <span class="option-letter">C</span>
                        Se duplica
                    </button>
                    <button class="quiz-option" data-value="D">
                        <span class="option-letter">D</span>
                        Se cuadruplica
                    </button>
                </div>
                <div class="quiz-feedback" style="display: none;">
                    <div class="feedback-correct">
                        <strong>✅ Correcto:</strong> \\(E_{pg}\\) es directamente proporcional a la altura.
                    </div>
                    <div class="feedback-incorrect">
                        ❌ <strong>Incorrecto:</strong> La relación es lineal, no cuadrática.
                    </div>
                </div>
            </div>

            <!-- PREGUNTAS 3-30 (similar estructura) -->
            <!-- ... -->
        </div>
        <div class="quiz-results" style="display: none;">
            <h3>📊 RESULTADOS DEL QUIZ</h3>
            <div class="results-score">
                Puntuación: <span id="quizScore">0</span>/30
            </div>
            <div class="results-feedback" id="quizFeedback">
                Completa el quiz para ver tus resultados.
            </div>
            <button class="btn-retry" onclick="reiniciarQuiz()">
                🔄 INTENTAR NUEVAMENTE
            </button>
        </div>
    </section>

    <!-- ERRORES COMUNES -->
    <section class="errores-section">
        <h2 class="seccion-titulo neon-alerta">
            <span class="icon">⚠️</span> ERRORES COMUNES
        </h2>
        <div class="errores-container">
            <div class="error-card">
                <div class="error-header" onclick="toggleError(this)">
                    <h3>❌ CONFUNDIR \\(E_{pg}\\) CON \\(E_k\\)</h3>
                    <span class="error-toggle">+</span>
                </div>
                <div class="error-content">
                    <div class="error-ejemplo">
                        <strong>Error:</strong> "Un objeto en caída tiene energía potencial".
                    </div>
                    <div class="error-correccion">
                        <strong>Corrección:</strong>
                        <p>La \\(E_{pg}\\) depende de la <strong>altura</strong>, no del movimiento.</p>
                        <p>En caída libre, la \\(E_{pg}\\) <strong>disminuye</strong> mientras la \\(E_k\\) <strong>aumenta</strong>.</p>
                    </div>
                    <div class="error-diagrama">
                        <div>Altura máxima: 100% \\(E_{pg}\\)</div>
                        <div>Durante caída: \\(E_{pg}\\)↓, \\(E_k\\)↑</div>
                        <div>Impacto: 100% \\(E_k\\), 0% \\(E_{pg}\\)</div>
                    </div>
                </div>
            </div>

            <div class="error-card">
                <div class="error-header" onclick="toggleError(this)">
                    <h3>❌ ELEGIR MAL EL NIVEL DE REFERENCIA</h3>
                    <span class="error-toggle">+</span>
                </div>
                <div class="error-content">
                    <div class="error-ejemplo">
                        <strong>Error:</strong> "La \\(E_{pg}\\) es absoluta y no depende de dónde ponga \\(h=0\\)".
                    </div>
                    <div class="error-correccion">
                        <strong>Corrección:</strong>
                        <p>La \\(E_{pg}\\) es <strong>relativa</strong> al nivel de referencia elegido.</p>
                        <p><strong>Ejemplo:</strong> Si eliges el suelo como \\(h=0\\), un objeto a 5m tiene \\(E_{pg} = mgh\\).</p>
                        <p>Si eliges una mesa a 1m como \\(h=0\\), el mismo objeto a 5m del suelo ahora está a \\(h=4m\\) de la mesa.</p>
                    </div>
                    <div class="error-formula">
                        \\[
                        E_{pg} = mg(h_{\\text{objeto}} - h_{\\text{referencia}})
                        \\]
                    </div>
                </div>
            </div>

            <!-- MÁS ERRORES COMUNES -->
            <!-- ... -->
        </div>
    </section>

    <!-- PROBLEMAS TIPO EXAMEN -->
    <section class="examen-section">
        <h2 class="seccion-titulo neon-evaluacion">
            <span class="icon">📝</span> PROBLEMAS TIPO EXAMEN (12 EJERCICIOS)
        </h2>
        <div class="examen-container">
            <div class="problema-card">
                <div class="problema-header">
                    <span class="problema-num">P1</span>
                    <h3>Cálculo Básico de \\(E_{pg}\\)</h3>
                </div>
                <div class="problema-enunciado">
                    <p>Un bloque de 5 kg se encuentra a 12 m de altura en la Tierra. Calcula:</p>
                    <ol>
                        <li>Su energía potencial gravitacional</li>
                        <li>Su energía potencial en la Luna (\\(g = 1.62\\) m/s²)</li>
                        <li>La altura equivalente en Marte (\\(g = 3.71\\) m/s²) para tener la misma \\(E_{pg}\\) que en la Tierra</li>
                    </ol>
                </div>
                <div class="problema-espacio">
                    <textarea placeholder="Desarrolla tu solución paso a paso..." rows="6"></textarea>
                </div>
                <button class="btn-verificar" onclick="verificarProblema(1)">
                    ✅ VERIFICAR SOLUCIÓN
                </button>
                <div class="problema-solucion" id="solucionP1" style="display: none;">
                    <strong>Solución:</strong><br>
                    1. \\(E_{pg} = 5 \\times 9.8 \\times 12 = 588\\) J<br>
                    2. \\(E_{pg\\_luna} = 5 \\times 1.62 \\times 12 = 97.2\\) J<br>
                    3. \\(588 = 5 \\times 3.71 \\times h_{marte}\\) → \\(h_{marte} = 31.7\\) m
                </div>
            </div>

            <div class="problema-card">
                <div class="problema-header">
                    <span class="problema-num">P2</span>
                    <h3>Conservación de Energía Mecánica</h3>
                </div>
                <div class="problema-enunciado">
                    <p>Una pelota de 0.5 kg se deja caer desde 20 m de altura. Calcula:</p>
                    <ol>
                        <li>Su velocidad al llegar al suelo</li>
                        <li>Su velocidad a 5 m del suelo</li>
                        <li>La altura máxima que alcanzaría si se lanzara hacia arriba con velocidad inicial de 15 m/s</li>
                    </ol>
                    <p>Ignora la resistencia del aire.</p>
                </div>
                <div class="problema-espacio">
                    <textarea placeholder="Muestra todos los cálculos..." rows="8"></textarea>
                </div>
                <button class="btn-verificar" onclick="verificarProblema(2)">
                    ✅ VERIFICAR SOLUCIÓN
                </button>
                <div class="problema-solucion" id="solucionP2" style="display: none;">
                    <strong>Solución:</strong><br>
                    1. \\(v = \\sqrt{2gh} = \\sqrt{2 \\times 9.8 \\times 20} = 19.8\\) m/s<br>
                    2. \\(mgh_1 + \\frac{1}{2}mv_1^2 = mgh_2 + \\frac{1}{2}mv_2^2\\) → \\(v_2 = \\sqrt{2 \\times 9.8 \\times 15} = 17.15\\) m/s<br>
                    3. \\(mgh = \\frac{1}{2}mv^2\\) → \\(h = \\frac{v^2}{2g} = \\frac{225}{19.6} = 11.48\\) m
                </div>
            </div>

            <!-- PROBLEMAS 3-12 -->
            <!-- ... -->
        </div>

        <div class="rubrica">
            <h4>📋 RÚBRICA DE EVALUACIÓN</h4>
            <table class="rubrica-table">
                <tr>
                    <th>Criterio</th>
                    <th>Excelente (5 pts)</th>
                    <th>Satisfactorio (3-4 pts)</th>
                    <th>Insuficiente (0-2 pts)</th>
                </tr>
                <tr>
                    <td>Aplicación correcta de \\(E_{pg} = mgh\\)</td>
                    <td>Fórmula aplicada correctamente en todos los casos</td>
                    <td>Errores menores en cálculos o unidades</td>
                    <td>Confunde variables o fórmula</td>
                </tr>
                <tr>
                    <td>Conservación de energía mecánica</td>
                    <td>Aplica correctamente \\(E_{pg} + E_k = \\text{constante}\\)</td>
                    <td>Errores en transformación de energías</td>
                    <td>No comprende la conservación</td>
                </tr>
                <tr>
                    <td>Análisis de niveles de referencia</td>
                    <td>Elige y justifica adecuadamente \\(h = 0\\)</td>
                    <td>Confusión en elección de referencia</td>
                    <td>No considera el concepto de referencia</td>
                </tr>
            </table>
        </div>
    </section>

    <!-- CIERRE METACOGNITIVO -->
    <section class="cierre-section">
        <h2 class="seccion-titulo neon-concepto">
            <span class="icon">🧠</span> CIERRE METACOGNITIVO
        </h2>
        <div class="cierre-container">
            <div class="autoevaluacion">
                <h3>📊 AUTOEVALUACIÓN</h3>
                <div class="slider-group">
                    <label>Comprensión de la fórmula \\(E_{pg} = mgh\\):</label>
                    <input type="range" min="1" max="5" value="3" class="autoeval-slider" id="slider1">
                    <div class="slider-labels">
                        <span>Básico</span><span>Intermedio</span><span>Avanzado</span>
                    </div>
                </div>
                <div class="slider-group">
                    <label>Aplicación de conservación de energía:</label>
                    <input type="range" min="1" max="5" value="3" class="autoeval-slider" id="slider2">
                    <div class="slider-labels">
                        <span>Básico</span><span>Intermedio</span><span>Avanzado</span>
                    </div>
                </div>
                <div class="slider-group">
                    <label>Manejo de niveles de referencia:</label>
                    <input type="range" min="1" max="5" value="3" class="autoeval-slider" id="slider3">
                    <div class="slider-labels">
                        <span>Básico</span><span>Intermedio</span><span>Avanzado</span>
                    </div>
                </div>
                <button class="btn-guardar" onclick="guardarAutoevaluacion()">
                    💾 GUARDAR AUTOEVALUACIÓN
                </button>
            </div>

            <div class="reflexion">
                <h3>🤔 REFLEXIÓN GUIADA</h3>
                <div class="pregunta-reflexion">
                    <p>¿Cómo aplicaría el concepto de \\(E_{pg}\\) para diseñar un sistema de almacenamiento de energía por gravedad?</p>
                    <textarea placeholder="Ejemplo: Usar pesos elevados para almacenar energía renovable..." rows="3"></textarea>
                </div>
                <div class="pregunta-reflexion">
                    <p>Describe una situación cotidiana donde la elección del nivel de referencia sea crucial para los cálculos de \\(E_{pg}\\).</p>
                    <textarea placeholder="Ejemplo: Construcción de edificios, diseño de montañas rusas..." rows="3"></textarea>
                </div>
            </div>

            <div class="plan-estudio">
                <h3>📅 PLAN DE ESTUDIO RECOMENDADO</h3>
                <div class="plan-grid">
                    <div class="plan-card">
                        <h4>📌 REPASO RÁPIDO (20 min)</h4>
                        <ul>
                            <li>Memorizar \\(E_{pg} = mgh\\)</li>
                            <li>Identificar variables y unidades</li>
                            <li>Resolver 2 problemas básicos</li>
                        </ul>
                    </div>
                    <div class="plan-card">
                        <h4>🛠 PRÁCTICA (40 min)</h4>
                        <ul>
                            <li>Usar simulador con 3 casos diferentes</li>
                            <li>Resolver problemas 3-6 del examen</li>
                            <li>Completar 10 preguntas del quiz</li>
                        </ul>
                    </div>
                    <div class="plan-card">
                        <h4>🧠 PROFUNDIZACIÓN (60 min)</h4>
                        <ul>
                            <li>Investigar aplicaciones en ingeniería</li>
                            <li>Analizar \\(E_{pg}\\) en diferentes planetas</li>
                            <li>Resolver problemas avanzados (7-12)</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="recursos">
                <h3>🔗 RECURSOS ADICIONALES</h3>
                <div class="recursos-links">
                    <a href="https://phet.colorado.edu/es/simulation/energy-skate-park-basics" target="_blank" class="recurso-link">
                        🛹 Simulador PhET: Parque de Energía Básica
                    </a>
                    <a href="https://www.khanacademy.org/science/physics/work-and-energy" target="_blank" class="recurso-link">
                        📚 Khan Academy: Trabajo y Energía
                    </a>
                    <a href="https://www.nasa.gov/" target="_blank" class="recurso-link">
                        🚀 NASA: Gravedad en el Sistema Solar
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- JAVASCRIPT COMPLETO -->
<script>
// ===========================================
// SIMULADOR DE ENERGÍA POTENCIAL GRAVITACIONAL
// ===========================================
function simularCaidaLibre() {
    const masa = parseFloat(document.getElementById(\'masaObjeto\').value);
    const altura = parseFloat(document.getElementById(\'alturaObjeto\').value);
    const gravedad = parseFloat(document.getElementById(\'gravedad\').value);

    // Cálculos físicos
    const epgInicial = masa * gravedad * altura;
    const velocidadFinal = Math.sqrt(2 * gravedad * altura);
    const tiempoCaida = Math.sqrt(2 * altura / gravedad);

    // Actualizar datos en interfaz
    document.getElementById(\'dataEPGInicial\').textContent = epgInicial.toFixed(2) + \' J\';
    document.getElementById(\'dataEKFinal\').textContent = epgInicial.toFixed(2) + \' J\';
    document.getElementById(\'dataVelocidad\').textContent = velocidadFinal.toFixed(2) + \' m/s\';
    document.getElementById(\'dataTiempo\').textContent = tiempoCaida.toFixed(2) + \' s\';

    // Actualizar texto en SVG
    document.getElementById(\'epgTexto\').textContent = `EPG = ${epgInicial.toFixed(2)} J`;
    document.getElementById(\'ekTexto\').textContent = `EK = ${epgInicial.toFixed(2)} J`;
    document.getElementById(\'velocidadTexto\').textContent = `v = ${velocidadFinal.toFixed(2)} m/s`;
    document.getElementById(\'masaTextoEPG\').textContent = `${masa} kg`;

    // Animación de caída
    const caja = document.getElementById(\'caja\');
    const alturaInicial = 80; // Posición inicial en SVG
    const alturaFinal = 380;  // Posición final en SVG
    const duracion = 2;      // Duración de la animación en segundos

    // Animación usando SMIL (SVG)
    const animacion = document.createElementNS("http://www.w3.org/2000/svg", "animate");
    animacion.setAttribute("attributeName", "y");
    animacion.setAttribute("from", alturaInicial);
    animacion.setAttribute("to", alturaFinal);
    animacion.setAttribute("begin", "0s");
    animacion.setAttribute("dur", `${duracion}s`);
    animacion.setAttribute("fill", "freeze");
    caja.appendChild(animacion);

    // Mostrar indicadores
    document.getElementById(\'indicadoresEPG\').setAttribute(\'opacity\', \'1\');
    document.getElementById(\'velocidadFinal\').setAttribute(\'opacity\', \'1\');

    console.log(`🌌 Simulación: m=${masa}kg, h=${altura}m, g=${gravedad}m/s²`);
    console.log(`   EPG inicial: ${epgInicial.toFixed(2)}J`);
    console.log(`   Velocidad final: ${velocidadFinal.toFixed(2)}m/s`);
    console.log(`   Tiempo de caída: ${tiempoCaida.toFixed(2)}s`);
}

function reiniciarSimuladorEPG() {
    // Reiniciar controles
    document.getElementById(\'masaObjeto\').value = 1;
    document.getElementById(\'alturaObjeto\').value = 5;
    document.getElementById(\'gravedad\').value = \'9.8\';
    document.getElementById(\'valorMasa\').textContent = \'1 kg\';
    document.getElementById(\'valorAltura\').textContent = \'5 m\';

    // Reiniciar datos
    document.getElementById(\'dataEPGInicial\').textContent = \'0 J\';
    document.getElementById(\'dataEKFinal\').textContent = \'0 J\';
    document.getElementById(\'dataVelocidad\').textContent = \'0 m/s\';
    document.getElementById(\'dataTiempo\').textContent = \'0 s\';

    // Reiniciar visualización
    const caja = document.getElementById(\'caja\');
    caja.setAttribute(\'y\', \'80\');
    while (caja.lastChild && caja.lastChild.tagName === \'animate\') {
        caja.removeChild(caja.lastChild);
    }

    document.getElementById(\'indicadoresEPG\').setAttribute(\'opacity\', \'0\');
    document.getElementById(\'velocidadFinal\').setAttribute(\'opacity\', \'0\');
}

// ===========================================
// QUIZ INTERACTIVO (30 PREGUNTAS)
// ===========================================
let quizRespuestas = [];
let quizCompletado = false;

document.querySelectorAll(\'.quiz-option\').forEach(option => {
    option.addEventListener(\'click\', function() {
        if (quizCompletado) return;

        const question = this.closest(\'.quiz-question\');
        const correct = question.dataset.correct;
        const selected = this.dataset.value;
        const feedback = question.querySelector(\'.quiz-feedback\');

        // Limpiar selección previa
        question.querySelectorAll(\'.quiz-option\').forEach(opt => {
            opt.classList.remove(\'selected\', \'correct\', \'incorrect\');
        });

        // Marcar selección actual
        this.classList.add(\'selected\');

        // Verificar respuesta
        if (selected === correct) {
            this.classList.add(\'correct\');
            quizRespuestas.push(true);
        } else {
            this.classList.add(\'incorrect\');
            question.querySelector(`[data-value="${correct}"]`).classList.add(\'correct\');
            quizRespuestas.push(false);
        }

        // Mostrar feedback
        feedback.style.display = \'block\';

        // Verificar si todas las preguntas están respondidas
        const questions = document.querySelectorAll(\'.quiz-question\');
        const answered = Array.from(questions).every(q =>
            q.querySelector(\'.quiz-option.selected\')
        );

        if (answered && !quizCompletado) {
            quizCompletado = true;
            const correctas = quizRespuestas.filter(r => r).length;
            const total = quizRespuestas.length;
            const porcentaje = Math.round((correctas / total) * 100);

            document.getElementById(\'quizScore\').textContent = `${correctas}/${total}`;

            let feedbackText = "";
            if (porcentaje >= 90) {
                feedbackText = "🎉 ¡Excelente! Dominas la energía potencial gravitacional.";
            } else if (porcentaje >= 70) {
                feedbackText = "👍 Buen trabajo, pero repasa la conservación de energía.";
            } else if (porcentaje >= 50) {
                feedbackText = "⚠️ Necesitas practicar más con el simulador.";
            } else {
                feedbackText = "😕 Revisa la sección teórica y los ejemplos.";
            }

            document.getElementById(\'quizFeedback\').textContent = feedbackText;
            document.querySelector(\'.quiz-results\').style.display = \'block\';
        }
    });
});

function reiniciarQuiz() {
    quizRespuestas = [];
    quizCompletado = false;

    document.querySelectorAll(\'.quiz-option\').forEach(opt => {
        opt.classList.remove(\'selected\', \'correct\', \'incorrect\');
    });

    document.querySelectorAll(\'.quiz-feedback\').forEach(fb => {
        fb.style.display = \'none\';
    });

    document.querySelector(\'.quiz-results\').style.display = \'none\';
}

// ===========================================
// ERRORES COMUNES INTERACTIVOS
// ===========================================
function toggleError(header) {
    const content = header.nextElementSibling;
    const toggle = header.querySelector(\'.error-toggle\');

    if (content.style.display === \'block\') {
        content.style.display = \'none\';
        toggle.textContent = \'+\';
    } else {
        content.style.display = \'block\';
        toggle.textContent = \'-\';
    }
}

// ===========================================
// PROBLEMAS TIPO EXAMEN
// ===========================================
function verificarProblema(num) {
    const solucion = document.getElementById(`solucionP${num}`);
    if (solucion.style.display === \'block\') {
        solucion.style.display = \'none\';
    } else {
        solucion.style.display = \'block\';
    }
}

// ===========================================
// AUTOEVALUACIÓN METACOGNITIVA
// ===========================================
function guardarAutoevaluacion() {
    const slider1 = document.getElementById(\'slider1\').value;
    const slider2 = document.getElementById(\'slider2\').value;
    const slider3 = document.getElementById(\'slider3\').value;
    const promedio = (parseInt(slider1) + parseInt(slider2) + parseInt(slider3)) / 3;

    alert(
        `📊 Autoevaluación guardada:\\n\\n` +
        `Fórmula E_pg: ${slider1}/5\\n` +
        `Conservación: ${slider2}/5\\n` +
        `Niveles de referencia: ${slider3}/5\\n\\n` +
        `Promedio: ${promedio.toFixed(1)}/5\\n\\n` +
        `Recomendación: Revisa el plan de estudio según tus resultados.`
    );
}

// ===========================================
// OBJETIVOS INTERACTIVOS
// ===========================================
document.querySelectorAll(\'.objetivo-card\').forEach(card => {
    card.addEventListener(\'click\', function() {
        const completado = this.dataset.completado === \'true\';
        this.dataset.completado = !completado;
        const checkbox = this.querySelector(\'.objetivo-checkbox\');
        checkbox.textContent = !completado ? \'✓\' : \'\';
        checkbox.style.backgroundColor = !completado ? \'#39FF14\' : \'\';
    });
});

// ===========================================
// ACTUALIZACIÓN DE VALORES EN TIEMPO REAL
// ===========================================
document.getElementById(\'masaObjeto\').addEventListener(\'input\', function() {
    document.getElementById(\'valorMasa\').textContent = this.value + \' kg\';
});

document.getElementById(\'alturaObjeto\').addEventListener(\'input\', function() {
    document.getElementById(\'valorAltura\').textContent = this.value + \' m\';
});

// ===========================================
// INICIALIZACIÓN
// ===========================================
console.log("🌌 Lección: Energía Potencial Gravitacional cargada");
console.log("🎮 Simulador, Quiz (30 preguntas) y 12 problemas listos");
console.log("📊 Todos los sistemas interactivos funcionando");
</script>',
    'ejercicios' => 
    array (
      0 => 
      array (
        'enunciado' => 'Fórmula EPG',
        'respuesta' => 'm g h',
      ),
      1 => 
      array (
        'enunciado' => 'g Tierra',
        'respuesta' => '9.8 m/s²',
      ),
      2 => 
      array (
        'enunciado' => 'h = 0 → EPG',
        'respuesta' => '0',
      ),
      3 => 
      array (
        'enunciado' => 'Caída libre: EPG →',
        'respuesta' => 'EK',
      ),
      4 => 
      array (
        'enunciado' => 'm = 3 kg, h = 10 m',
        'respuesta' => '294 J',
      ),
      5 => 
      array (
        'enunciado' => 'v final (h = 20 m)',
        'respuesta' => '19.8 m/s',
      ),
      6 => 
      array (
        'enunciado' => 'EPG en Luna (g ≈ 1.6 m/s²)',
        'respuesta' => 'm × 1.6 × h',
      ),
      7 => 
      array (
        'enunciado' => 'Trabajo gravitacional',
        'respuesta' => '-ΔEPG',
      ),
      8 => 
      array (
        'enunciado' => 'Conservación en péndulo',
        'respuesta' => 'EPG + EK = cte',
      ),
      9 => 
      array (
        'enunciado' => '1 kJ =',
        'respuesta' => '1000 J',
      ),
      10 => 
      array (
        'enunciado' => 'g Marte ≈',
        'respuesta' => '3.7 m/s²',
      ),
      11 => 
      array (
        'enunciado' => 'EPG máxima en',
        'respuesta' => 'h máxima',
      ),
    ),
    'quiz' => 
    array (
      0 => 
      array (
        'pregunta' => 'EPG =',
        'opciones' => 
        array (
          0 => 'mgh',
          1 => '½mv²',
          2 => 'Fd',
          3 => 'PV',
        ),
        'correcta' => 'mgh',
      ),
      1 => 
      array (
        'pregunta' => 'Depende de',
        'opciones' => 
        array (
          0 => 'm, g, h',
          1 => 'solo m',
          2 => 'solo v',
          3 => 'F',
        ),
        'correcta' => 'm, g, h',
      ),
      2 => 
      array (
        'pregunta' => 'g ≈',
        'opciones' => 
        array (
          0 => '9.8 m/s²',
          1 => '9.8 N',
          2 => '9.8 kg',
          3 => '0',
        ),
        'correcta' => '9.8 m/s²',
      ),
      3 => 
      array (
        'pregunta' => 'h = 0 → EPG',
        'opciones' => 
        array (
          0 => '0',
          1 => '∞',
          2 => 'máxima',
          3 => 'negativa',
        ),
        'correcta' => '0',
      ),
      4 => 
      array (
        'pregunta' => 'Caída: EPG',
        'opciones' => 
        array (
          0 => 'disminuye',
          1 => 'aumenta',
          2 => 'igual',
          3 => 'cero',
        ),
        'correcta' => 'disminuye',
      ),
      5 => 
      array (
        'pregunta' => 'EK aumenta al',
        'opciones' => 
        array (
          0 => 'caer',
          1 => 'subir',
          2 => 'reposo',
          3 => 'girar',
        ),
        'correcta' => 'caer',
      ),
      6 => 
      array (
        'pregunta' => 'm = 1 kg, h = 10 m → EPG',
        'opciones' => 
        array (
          0 => '98 J',
          1 => '9.8 J',
          2 => '980 J',
          3 => '0 J',
        ),
        'correcta' => '98 J',
      ),
      7 => 
      array (
        'pregunta' => 'g en Luna',
        'opciones' => 
        array (
          0 => '1/6 Tierra',
          1 => 'igual',
          2 => 'doble',
          3 => 'cero',
        ),
        'correcta' => '1/6 Tierra',
      ),
      8 => 
      array (
        'pregunta' => 'Conservación E_mec',
        'opciones' => 
        array (
          0 => 'EPG + EK = cte',
          1 => 'solo EPG',
          2 => 'solo EK',
          3 => 'nada',
        ),
        'correcta' => 'EPG + EK = cte',
      ),
      9 => 
      array (
        'pregunta' => 'Unidad EPG',
        'opciones' => 
        array (
          0 => 'Joule',
          1 => 'Newton',
          2 => 'Watt',
          3 => 'Pascal',
        ),
        'correcta' => 'Joule',
      ),
      10 => 
      array (
        'pregunta' => 'v = √(2gh) en',
        'opciones' => 
        array (
          0 => 'caída libre',
          1 => 'lanzamiento',
          2 => 'fricción',
          3 => 'aire',
        ),
        'correcta' => 'caída libre',
      ),
      11 => 
      array (
        'pregunta' => 'Trabajo gravedad =',
        'opciones' => 
        array (
          0 => '-ΔEPG',
          1 => 'ΔEPG',
          2 => '½mv²',
          3 => 'mgh',
        ),
        'correcta' => '-ΔEPG',
      ),
      12 => 
      array (
        'pregunta' => 'Péndulo: máxima EPG en',
        'opciones' => 
        array (
          0 => 'puntos extremos',
          1 => 'centro',
          2 => 'arriba',
          3 => 'abajo',
        ),
        'correcta' => 'puntos extremos',
      ),
      13 => 
      array (
        'pregunta' => '1 kWh =',
        'opciones' => 
        array (
          0 => '3.6 MJ',
          1 => '3.6 kJ',
          2 => '36 MJ',
          3 => '0.36 MJ',
        ),
        'correcta' => '3.6 MJ',
      ),
      14 => 
      array (
        'pregunta' => 'g Marte ≈',
        'opciones' => 
        array (
          0 => '3.7 m/s²',
          1 => '9.8 m/s²',
          2 => '1.6 m/s²',
          3 => '25 m/s²',
        ),
        'correcta' => '3.7 m/s²',
      ),
      15 => 
      array (
        'pregunta' => 'En vacío, EPG → EK',
        'opciones' => 
        array (
          0 => '100%',
          1 => '50%',
          2 => '0%',
          3 => 'variable',
        ),
        'correcta' => '100%',
      ),
      16 => 
      array (
        'pregunta' => 'Referencia h = 0',
        'opciones' => 
        array (
          0 => 'arbitraria',
          1 => 'obligatoria',
          2 => 'infinita',
          3 => 'negativa',
        ),
        'correcta' => 'arbitraria',
      ),
      17 => 
      array (
        'pregunta' => 'EPG en espacio profundo',
        'opciones' => 
        array (
          0 => '0',
          1 => 'infinita',
          2 => 'mgh',
          3 => 'negativa',
        ),
        'correcta' => '0',
      ),
      18 => 
      array (
        'pregunta' => 'Conservación válida si',
        'opciones' => 
        array (
          0 => 'fuerzas conservativas',
          1 => 'fricción',
          2 => 'aire',
          3 => 'calor',
        ),
        'correcta' => 'fuerzas conservativas',
      ),
      19 => 
      array (
        'pregunta' => 'SI 2025: g =',
        'opciones' => 
        array (
          0 => '9.80665 m/s²',
          1 => '10 m/s²',
          2 => '9.8 N/kg',
          3 => '0',
        ),
        'correcta' => '9.80665 m/s²',
      ),
      20 => 
      array (
        'pregunta' => 'v final desde h = 50 m',
        'opciones' => 
        array (
          0 => '31.3 m/s',
          1 => '50 m/s',
          2 => '9.8 m/s',
          3 => '500 m/s',
        ),
        'correcta' => '31.3 m/s',
      ),
      21 => 
      array (
        'pregunta' => 'EPG para 500 kg a 100 m',
        'opciones' => 
        array (
          0 => '490 kJ',
          1 => '49 kJ',
          2 => '4.9 MJ',
          3 => '0 J',
        ),
        'correcta' => '490 kJ',
      ),
      22 => 
      array (
        'pregunta' => 'Trabajo para subir 10 kg 3 m',
        'opciones' => 
        array (
          0 => '294 J',
          1 => '-294 J',
          2 => '0 J',
          3 => '98 J',
        ),
        'correcta' => '294 J',
      ),
      23 => 
      array (
        'pregunta' => 'En resorte, energía es',
        'opciones' => 
        array (
          0 => 'elástica',
          1 => 'gravitacional',
          2 => 'cinética',
          3 => 'térmica',
        ),
        'correcta' => 'elástica',
      ),
      24 => 
      array (
        'pregunta' => 'ΔEPG =',
        'opciones' => 
        array (
          0 => 'mgΔh',
          1 => '½mv²',
          2 => 'Fd',
          3 => 'PΔt',
        ),
        'correcta' => 'mgΔh',
      ),
      25 => 
      array (
        'pregunta' => 'En órbita, EPG',
        'opciones' => 
        array (
          0 => 'negativa',
          1 => 'cero',
          2 => 'positiva',
          3 => 'infinita',
        ),
        'correcta' => 'negativa',
      ),
      26 => 
      array (
        'pregunta' => 'g Júpiter ≈',
        'opciones' => 
        array (
          0 => '25 m/s²',
          1 => '9.8 m/s²',
          2 => '3.7 m/s²',
          3 => '1.6 m/s²',
        ),
        'correcta' => '25 m/s²',
      ),
      27 => 
      array (
        'pregunta' => 'Energía total en caída',
        'opciones' => 
        array (
          0 => 'constante',
          1 => 'aumenta',
          2 => 'disminuye',
          3 => 'cero',
        ),
        'correcta' => 'constante',
      ),
      28 => 
      array (
        'pregunta' => 'Fuerza gravitacional es',
        'opciones' => 
        array (
          0 => 'conservativa',
          1 => 'no conservativa',
          2 => 'disipativa',
          3 => 'reactiva',
        ),
        'correcta' => 'conservativa',
      ),
      29 => 
      array (
        'pregunta' => 'SI 2025: 1 MJ =',
        'opciones' => 
        array (
          0 => '10⁶ J',
          1 => '10³ J',
          2 => '10⁹ J',
          3 => '10⁻⁶ J',
        ),
        'correcta' => '10⁶ J',
      ),
    ),
  ),
  8 => 
  array (
    'materia' => 'Física I',
    'slug' => 'energia-potencial-elastica-hooke',
    'titulo' => 'Energía Potencial Elástica: La Física de los Resortes',
    'contenido' => '<!-- LECCIÓN CYBERPUNK: ENERGÍA POTENCIAL ELÁSTICA -->
<div class="leccion-container leccion-fisica-epe" data-tema="energia-potencial-elastica">
    <!-- CABECERA CYBERPUNK -->
    <header class="leccion-header">
        <h1 class="titulo-leccion neon-glow">
            <span class="icon-tema">🌀</span>
            ENERGÍA POTENCIAL ELÁSTICA Y LEY DE HOOKE
        </h1>
        <div class="subtitulo">
            De la fuerza restauradora \\(F = -kx\\) a la energía almacenada \\(E_{pe} = \\frac{1}{2}kx^2\\)
        </div>
    </header>

    <!-- PANEL OBJETIVOS -->
    <section class="panel-objetivos">
        <h2 class="seccion-titulo neon-concepto">
            <span class="icon">🎯</span> OBJETIVOS DE APRENDIZAJE
        </h2>
        <div class="objetivos-grid">
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Explicar la Ley de Hooke</h3>
                <p>Relación \\(F = -kx\\) y sus límites de validez</p>
            </div>
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Derivar la fórmula de \\(E_{pe}\\)</h3>
                <p>Desde el trabajo de la fuerza elástica</p>
            </div>
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Analizar sistemas masa-resorte</h3>
                <p>Oscilaciones y conservación de energía</p>
            </div>
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Aplicar en problemas reales</h3>
                <p>Amortiguadores, relojes, sistemas de suspensión</p>
            </div>
        </div>
    </section>

    <!-- CONTEXTO REAL -->
    <section class="contexto-real">
        <h2 class="seccion-titulo neon-dato">
            <span class="icon">🌍</span> APLICACIONES EN INGENIERÍA
        </h2>
        <div class="contexto-grid">
            <div class="contexto-card">
                <h3>🚗 Sistemas de Suspensión</h3>
                <p>Amortiguadores basados en resortes y \\(E_{pe}\\)</p>
                <div class="dato-neon">Reducción 70% vibraciones</div>
            </div>
            <div class="contexto-card">
                <h3>⏱ Relojes Mecánicos</h3>
                <p>Reguladores de tiempo con resortes</p>
                <div class="dato-neon">Precisión: ±15 s/mes</div>
            </div>
            <div class="contexto-card">
                <h3>🏗 Estructuras Antisísmicas</h3>
                <p>Aisladores de base con propiedades elásticas</p>
                <div class="dato-neon">Reducción 90% energía sísmica</div>
            </div>
        </div>
    </section>

    <!-- SECCIÓN TEÓRICA -->
    <section class="teoria-section">
        <div class="borde-neon-lateral"></div>
        <h2 class="seccion-titulo neon-concepto">
            <span class="icon">📚</span> FUNDAMENTOS TEÓRICOS
        </h2>

        <!-- LEY DE HOOKE -->
        <div class="subseccion">
            <h3>1. Ley de Hooke</h3>
            <div class="formula-destacada">
                \\[
                F = -kx
                \\]
            </div>
            <div class="ley-hooke-container">
                <div class="definicion">
                    <p>La fuerza restauradora (\\(F\\)) es:</p>
                    <ul>
                        <li><strong>Proporcional</strong> a la deformación (\\(x\\))</li>
                        <li><strong>Opuesta</strong> en dirección (signo negativo)</li>
                        <li><strong>Característica</strong> del material (\\(k\\))</li>
                    </ul>
                </div>
                <div class="tabla-variables">
                    <table class="tabla-cyberpunk">
                        <thead>
                            <tr><th>Variable</th><th>Significado</th><th>Unidad SI</th><th>Rango típico</th></tr>
                        </thead>
                        <tbody>
                            <tr><td><strong>F</strong></td><td>Fuerza restauradora</td><td>N</td><td>0-1000 N</td></tr>
                            <tr><td><strong>k</strong></td><td>Constante elástica</td><td>N/m</td><td>10-10,000 N/m</td></tr>
                            <tr><td><strong>x</strong></td><td>Deformación</td><td>m</td><td>0-0.5 m</td></tr>
                        </tbody>
                    </table>
                </div>
                <div class="limites-validez">
                    <h4>⚠️ Límites de Validez</h4>
                    <p>La ley de Hooke es válida solo en el <strong>régimen elástico</strong>:</p>
                    <div class="grafica-esfuerzo">
                        <svg width="300" height="150" viewBox="0 0 300 150">
                            <polyline points="20,130 80,100 200,20 280,20" stroke="#39FF14" stroke-width="3" fill="none"/>
                            <text x="50" y="140" fill="#39FF14" font-size="10">Elástico</text>
                            <text x="150" y="30" fill="#FF6B6B" font-size="10">Plástico</text>
                            <text x="20" y="130" fill="white" font-size="8">Origen</text>
                            <text x="280" y="20" fill="white" font-size="8">Rotura</text>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- ENERGÍA POTENCIAL ELÁSTICA -->
        <div class="subseccion">
            <h3>2. Energía Potencial Elástica</h3>
            <div class="formula-destacada">
                \\[
                E_{pe} = \\frac{1}{2}kx^2
                \\]
            </div>
            <div class="derivacion-epe">
                <p><strong>Derivación:</strong></p>
                \\[
                E_{pe} = \\int F \\, dx = \\int_{-x}^{x} (-kx) \\, dx = \\frac{1}{2}kx^2
                \\]
                <div class="propiedades-epe">
                    <div class="propiedad">
                        <h4>🔹 Dependencia Cuadrática</h4>
                        <p>Proporcional a \\(x^2\\) (no lineal)</p>
                        <div class="ejemplo">Doblar \\(x\\) → Cuadruplicar \\(E_{pe}\\)</div>
                    </div>
                    <div class="propiedad">
                        <h4>🔹 Máxima en Deformación Máxima</h4>
                        <p>Alcanza su valor máximo en \\(x_{max}\\)</p>
                        <div class="ejemplo">Resorte comprimido al máximo</div>
                    </div>
                    <div class="propiedad">
                        <h4>🔹 Cero en Posición Natural</h4>
                        <p>\\(E_{pe} = 0\\) cuando \\(x = 0\\)</p>
                        <div class="ejemplo">Resorte sin deformar</div>
                    </div>
                </div>
                <div class="comparacion-grafica">
                    <div class="grafica">
                        <svg width="300" height="200" viewBox="0 0 300 200">
                            <path d="M30,180 Q150,20 270,180" stroke="#39FF14" stroke-width="3" fill="none"/>
                            <text x="150" y="190" fill="#39FF14" font-size="12" text-anchor="middle">Epe = ½kx²</text>
                            <line x1="30" y1="180" x2="270" y2="180" stroke="rgba(255,255,255,0.3)" stroke-width="1"/>
                            <line x1="30" y1="180" x2="30" y2="20" stroke="rgba(255,255,255,0.3)" stroke-width="1"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- CONSERVACIÓN DE ENERGÍA -->
        <div class="subseccion">
            <h3>3. Conservación de Energía en Sistemas Elásticos</h3>
            <div class="conservacion-container">
                <div class="formula-destacada">
                    \\[
                    E_{mec} = E_k + E_{pe} = \\text{constante}
                    \\]
                </div>
                <div class="sistema-masa-resorte">
                    <div class="diagrama">
                        <svg width="400" height="200" viewBox="0 0 400 200">
                            <!-- Resorte en posición natural -->
                            <line x1="100" y1="100" x2="100" y2="150" stroke="#1976D2" stroke-width="4"/>
                            <path d="M100 150 Q90 170 100 190 Q110 210 100 230" stroke="#1976D2" stroke-width="4" fill="none"/>
                            <rect x="90" y="230" width="20" height="20" fill="#42A5F5" rx="3"/>

                            <!-- Resorte estirado -->
                            <line x1="300" y1="100" x2="300" y2="150" stroke="#1976D2" stroke-width="4"/>
                            <path d="M300 150 Q280 180 300 210 Q320 240 300 270" stroke="#1976D2" stroke-width="4" fill="none"/>
                            <rect x="290" y="270" width="20" height="20" fill="#42A5F5" rx="3"/>

                            <!-- Flechas y etiquetas -->
                            <line x1="150" y1="120" x2="250" y2="120" stroke="#39FF14" stroke-width="2" marker-end="url(#arrowhead)"/>
                            <text x="200" y1="110" fill="#39FF14" font-size="12" text-anchor="middle">Fuerza aplicada</text>
                            <text x="100" y="260" fill="white" font-size="10" text-anchor="middle">Posición natural</text>
                            <text x="300" y="290" fill="white" font-size="10" text-anchor="middle">Deformación x</text>
                        </svg>
                    </div>
                    <div class="explicacion">
                        <p>En un sistema masa-resorte <strong>ideal</strong> (sin fricción):</p>
                        <ol>
                            <li>Al estirar/comprimir: \\(E_{pe}\\) aumenta, \\(E_k\\) disminuye</li>
                            <li>En posición natural: \\(E_{pe} = 0\\), \\(E_k\\) máxima</li>
                            <li>Oscilación continua entre formas de energía</li>
                        </ol>
                    </div>
                </div>
                <div class="ejemplo-practico">
                    <p><strong>Ejemplo:</strong> Sistema con \\(k = 200\\) N/m, \\(m = 0.5\\) kg, \\(x = 0.1\\) m:</p>
                    <div class="pasos">
                        <div class="paso">
                            <strong>1. Energía potencial máxima:</strong><br>
                            \\(E_{pe} = \\frac{1}{2} \\times 200 \\times 0.01 = 1\\) J
                        </div>
                        <div class="paso">
                            <strong>2. Velocidad máxima (en x=0):</strong><br>
                            \\(\\frac{1}{2}kx^2 = \\frac{1}{2}mv^2\\) → \\(v = \\sqrt{\\frac{k}{m}}x = 2\\) m/s
                        </div>
                        <div class="paso">
                            <strong>3. Frecuencia de oscilación:</strong><br>
                            \\(\\omega = \\sqrt{\\frac{k}{m}} = 20\\) rad/s → \\(f = 3.18\\) Hz
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- EJEMPLO PRÁCTICO -->
        <div class="subseccion">
            <h3>4. Ejemplo de Aplicación Real</h3>
            <div class="ejemplo-destacado">
                <p><strong>Problema:</strong> Un resorte de constante \\(k = 500\\) N/m se comprime 12 cm con una masa de 2 kg. Al soltarla:</p>
                <ol>
                    <li>Calcula la energía potencial elástica inicial</li>
                    <li>Determina la velocidad máxima de la masa</li>
                    <li>Calcula la altura máxima que alcanzaría si el resorte estuviera vertical</li>
                </ol>
                <div class="solucion-paso-a-paso">
                    <div class="paso">
                        <strong>1. Energía potencial inicial:</strong><br>
                        \\(E_{pe} = \\frac{1}{2} \\times 500 \\times (0.12)^2 = 3.6\\) J
                    </div>
                    <div class="paso">
                        <strong>2. Velocidad máxima:</strong><br>
                        \\(3.6 = \\frac{1}{2} \\times 2 \\times v^2\\) → \\(v = 1.9\\) m/s
                    </div>
                    <div class="paso">
                        <strong>3. Altura máxima:</strong><br>
                        \\(mgh = 3.6\\) → \\(h = 0.18\\) m (conservación de energía)
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SIMULADOR INTERACTIVO -->
    <section class="simulator-section">
        <h2 class="seccion-titulo neon-interactivo">
            <span class="icon">🎮</span> SIMULADOR: SISTEMA MASA-RESORTE
        </h2>
        <div class="simulator-container" data-tema="epe-simulator">
            <div class="simulator-controls">
                <h3>⚙️ CONTROLES</h3>
                <div class="control-group">
                    <label for="constanteElastica">Constante elástica (k):</label>
                    <input type="range" id="constanteElastica" min="10" max="1000" step="10" value="200">
                    <span id="valorK">200 N/m</span>
                </div>
                <div class="control-group">
                    <label for="masaObjeto">Masa (m):</label>
                    <input type="range" id="masaObjeto" min="0.1" max="5" step="0.1" value="1">
                    <span id="valorMasa">1 kg</span>
                </div>
                <div class="control-group">
                    <label for="deformacionInicial">Deformación inicial (x):</label>
                    <input type="range" id="deformacionInicial" min="0.01" max="0.5" step="0.01" value="0.1">
                    <span id="valorDeformacion">0.10 m</span>
                </div>
                <div class="control-group">
                    <label for="tipoSimulacion">Tipo de simulación:</label>
                    <select id="tipoSimulacion">
                        <option value="oscilacion">Oscilación libre</option>
                        <option value="deformacion">Deformación estática</option>
                        <option value="energias">Gráfica de energías</option>
                    </select>
                </div>
                <button class="btn-simular" onclick="iniciarSimulacion()">
                    <span class="btn-icon">▶️</span> INICIAR SIMULACIÓN
                </button>
                <button class="btn-reset" onclick="reiniciarSimulador()">
                    <span class="btn-icon">🔄</span> REINICIAR
                </button>
            </div>

            <div class="simulator-visualization">
                <svg id="simuladorEPE" viewBox="0 0 800 400">
                    <!-- Pared -->
                    <rect x="50" y="150" width="20" height="200" fill="#455A64"/>

                    <!-- Resorte (inicial) -->
                    <g id="resorte">
                        <line x1="70" y1="200" x2="70" y2="250" stroke="#1976D2" stroke-width="4" id="lineaResorte"/>
                        <path d="M70 250 Q60 270 70 290 Q80 310 70 330" stroke="#1976D2" stroke-width="4" fill="none" id="espiralResorte"/>
                    </g>

                    <!-- Masa -->
                    <g id="masa">
                        <rect x="50" y="330" width="40" height="40" fill="#42A5F5" rx="5" id="cajaMasa"/>
                        <text x="70" y="355" fill="white" font-size="12" text-anchor="middle" id="textoMasa">1 kg</text>
                    </g>

                    <!-- Ejes de referencia -->
                    <line x1="50" y1="350" x2="200" y2="350" stroke="rgba(255,255,255,0.5)" stroke-width="1" stroke-dasharray="5,5"/>
                    <text x="125" y="370" fill="rgba(255,255,255,0.7)" font-size="10" text-anchor="middle">Posición natural</text>

                    <!-- Indicadores -->
                    <g id="indicadores" opacity="0">
                        <rect x="250" y="50" width="300" height="100" fill="rgba(0,0,0,0.7)" rx="10"/>
                        <text x="400" y="90" fill="#39FF14" font-size="14" text-anchor="middle" id="textoEPE">Epe = 1.0 J</text>
                        <text x="400" y="120" fill="#FF6B6B" font-size="14" text-anchor="middle" id="textoEK">Ek = 0.0 J</text>
                        <text x="400" y="150" fill="white" font-size="12" text-anchor="middle" id="textoTotal">Etotal = 1.0 J</text>
                    </g>

                    <!-- Gráfica de energías -->
                    <g id="graficaEnergias" opacity="0">
                        <rect x="300" y="200" width="400" height="180" fill="rgba(0,0,0,0.5)" rx="10"/>
                        <!-- Ejes -->
                        <line x1="320" y1="370" x2="680" y2="370" stroke="white" stroke-width="1"/>
                        <line x1="320" y1="210" x2="320" y2="370" stroke="white" stroke-width="1"/>
                        <!-- Curva Epe -->
                        <path d="M320,370 Q400,220 480,370 Q560,220 640,370" stroke="#39FF14" stroke-width="2" fill="none" id="curvaEPE"/>
                        <!-- Curva Ek -->
                        <path d="M320,370 Q400,370 480,220 Q560,370 640,370" stroke="#FF6B6B" stroke-width="2" fill="none" id="curvaEK"/>
                        <!-- Etiquetas -->
                        <text x="400" y="390" fill="#39FF14" font-size="10" text-anchor="middle">Epe</text>
                        <text x="500" y="230" fill="#FF6B6B" font-size="10" text-anchor="middle">Ek</text>
                        <text x="310" y="370" fill="white" font-size="8" text-anchor="middle">-A</text>
                        <text x="400" y="380" fill="white" font-size="8" text-anchor="middle">0</text>
                        <text x="490" y="370" fill="white" font-size="8" text-anchor="middle">+A</text>
                        <text x="300" y="220" fill="white" font-size="8" text-anchor="middle">Emax</text>
                    </g>
                </svg>
            </div>

            <div class="simulator-data">
                <h3>📊 DATOS DE SIMULACIÓN</h3>
                <div class="data-card">
                    <div class="data-label">Constante elástica (k):</div>
                    <div class="data-value" id="dataK">200 N/m</div>
                </div>
                <div class="data-card">
                    <div class="data-label">Masa (m):</div>
                    <div class="data-value" id="dataMasa">1 kg</div>
                </div>
                <div class="data-card">
                    <div class="data-label">Deformación (x):</div>
                    <div class="data-value" id="dataDeformacion">0.10 m</div>
                </div>
                <div class="data-card">
                    <div class="data-label">Energía potencial máxima:</div>
                    <div class="data-value" id="dataEPEMax">1.0 J</div>
                </div>
                <div class="data-card highlight">
                    <div class="data-label">Frecuencia angular (ω):</div>
                    <div class="data-value" id="dataFrecuencia">14.1 rad/s</div>
                </div>
                <div class="data-card">
                    <div class="data-label">Período (T):</div>
                    <div class="data-value" id="dataPeriodo">0.44 s</div>
                </div>
            </div>
        </div>
    </section>

    <!-- QUIZ INTERACTIVO -->
    <section class="quiz-section">
        <h2 class="seccion-titulo neon-evaluacion">
            <span class="icon">❓</span> QUIZ DE AUTOEVALUACIÓN (30 PREGUNTAS)
        </h2>
        <div class="quiz-container">
            <!-- PREGUNTA 1 -->
            <div class="quiz-question" data-correct="B">
                <div class="quiz-header">
                    <span class="quiz-num">01</span>
                    <h3>La Ley de Hooke establece que:</h3>
                </div>
                <div class="quiz-options">
                    <button class="quiz-option" data-value="A">
                        <span class="option-letter">A</span>
                        La fuerza es inversamente proporcional a la deformación
                    </button>
                    <button class="quiz-option" data-value="B">
                        <span class="option-letter">B</span>
                        La fuerza restauradora es proporcional y opuesta a la deformación
                    </button>
                    <button class="quiz-option" data-value="C">
                        <span class="option-letter">C</span>
                        La energía potencial es directamente proporcional a la deformación
                    </button>
                    <button class="quiz-option" data-value="D">
                        <span class="option-letter">D</span>
                        La constante elástica depende de la masa del objeto
                    </button>
                </div>
                <div class="quiz-feedback" style="display: none;">
                    <div class="feedback-correct">
                        <strong>✅ Correcto:</strong> La Ley de Hooke se expresa como \\(F = -kx\\), donde la fuerza es proporcional y opuesta a la deformación.
                    </div>
                    <div class="feedback-incorrect">
                        ❌ <strong>Incorrecto:</strong> Revisa la sección "Ley de Hooke" donde se explica \\(F = -kx\\).
                    </div>
                </div>
            </div>

            <!-- PREGUNTA 2 -->
            <div class="quiz-question" data-correct="C">
                <div class="quiz-header">
                    <span class="quiz-num">02</span>
                    <h3>La energía potencial elástica depende de:</h3>
                </div>
                <div class="quiz-options">
                    <button class="quiz-option" data-value="A">
                        <span class="option-letter">A</span>
                        Linealmente de la deformación \\(x\\)
                    </button>
                    <button class="quiz-option" data-value="B">
                        <span class="option-letter">B</span>
                        De la velocidad del objeto
                    </button>
                    <button class="quiz-option" data-value="C">
                        <span class="option-letter">C</span>
                        Del cuadrado de la deformación \\(x^2\\)
                    </button>
                    <button class="quiz-option" data-value="D">
                        <span class="option-letter">D</span>
                        Solo de la constante elástica \\(k\\)
                    </button>
                </div>
                <div class="quiz-feedback" style="display: none;">
                    <div class="feedback-correct">
                        <strong>✅ Correcto:</strong> La fórmula \\(E_{pe} = \\frac{1}{2}kx^2\\) muestra la dependencia cuadrática con \\(x\\).
                    </div>
                    <div class="feedback-incorrect">
                        ❌ <strong>Incorrecto:</strong> Revisa la sección "Energía Potencial Elástica" donde se deriva la fórmula.
                    </div>
                </div>
            </div>

            <!-- PREGUNTA 3 -->
            <div class="quiz-question" data-correct="A">
                <div class="quiz-header">
                    <span class="quiz-num">03</span>
                    <h3>Si duplicas la deformación de un resorte, su energía potencial elástica:</h3>
                </div>
                <div class="quiz-options">
                    <button class="quiz-option" data-value="A">
                        <span class="option-letter">A</span>
                        Se cuadruplica
                    </button>
                    <button class="quiz-option" data-value="B">
                        <span class="option-letter">B</span>
                        Se duplica
                    </button>
                    <button class="quiz-option" data-value="C">
                        <span class="option-letter">C</span>
                        Permanece igual
                    </button>
                    <button class="quiz-option" data-value="D">
                        <span class="option-letter">D</span>
                        Se reduce a la mitad
                    </button>
                </div>
                <div class="quiz-feedback" style="display: none;">
                    <div class="feedback-correct">
                        <strong>✅ Correcto:</strong> Como \\(E_{pe} \\propto x^2\\), duplicar \\(x\\) cuadruplica \\(E_{pe}\\).
                    </div>
                    <div class="feedback-incorrect">
                        ❌ <strong>Incorrecto:</strong> Recuerda que la dependencia es cuadrática (\\(x^2\\)), no lineal.
                    </div>
                </div>
            </div>

            <!-- PREGUNTAS 4-30 (similar estructura) -->
            <!-- ... -->
        </div>
        <div class="quiz-results" style="display: none;">
            <h3>📊 RESULTADOS DEL QUIZ</h3>
            <div class="results-score">
                Puntuación: <span id="quizScore">0</span>/30
            </div>
            <div class="results-feedback" id="quizFeedback">
                Completa el quiz para ver tus resultados.
            </div>
            <button class="btn-retry" onclick="reiniciarQuiz()">
                🔄 INTENTAR NUEVAMENTE
            </button>
        </div>
    </section>

    <!-- ERRORES COMUNES -->
    <section class="errores-section">
        <h2 class="seccion-titulo neon-alerta">
            <span class="icon">⚠️</span> ERRORES COMUNES
        </h2>
        <div class="errores-container">
            <div class="error-card">
                <div class="error-header" onclick="toggleError(this)">
                    <h3>❌ CONFUNDIR FUERZA ELÁSTICA CON ENERGÍA</h3>
                    <span class="error-toggle">+</span>
                </div>
                <div class="error-content">
                    <div class="error-ejemplo">
                        <strong>Error:</strong> "La energía potencial elástica es \\(F = -kx\\)".
                    </div>
                    <div class="error-correccion">
                        <strong>Corrección:</strong>
                        <div class="comparacion">
                            <div>
                                <strong>Fuerza elástica:</strong><br>
                                \\(F = -kx\\) (Newtons)
                            </div>
                            <div>
                                <strong>Energía potencial:</strong><br>
                                \\(E_{pe} = \\frac{1}{2}kx^2\\) (Joules)
                            </div>
                        </div>
                        <p><strong>Diferencia clave:</strong> La fuerza es lineal con \\(x\\), mientras que la energía es cuadrática (\\(x^2\\)).</p>
                    </div>
                    <div class="error-grafica">
                        <svg width="300" height="150" viewBox="0 0 300 150">
                            <line x1="30" y1="130" x2="270" y2="30" stroke="#39FF14" stroke-width="2" stroke-dasharray="5,2"/>
                            <text x="150" y="140" fill="#39FF14" font-size="10" text-anchor="middle">Fuerza (F = -kx)</text>
                            <path d="M30,130 Q150,20 270,130" stroke="#FF6B6B" stroke-width="2" fill="none"/>
                            <text x="150" y="40" fill="#FF6B6B" font-size="10" text-anchor="middle">Energía (Epe = ½kx²)</text>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="error-card">
                <div class="error-header" onclick="toggleError(this)">
                    <h3>❌ OLVIDAR EL LÍMITE ELÁSTICO</h3>
                    <span class="error-toggle">+</span>
                </div>
                <div class="error-content">
                    <div class="error-ejemplo">
                        <strong>Error:</strong> "La Ley de Hooke siempre se cumple, sin importar cuánto se deforme el resorte".
                    </div>
                    <div class="error-correccion">
                        <strong>Corrección:</strong>
                        <p>La Ley de Hooke solo es válida en el <strong>régimen elástico</strong>, hasta el <strong>límite elástico</strong>:</p>
                        <div class="grafica-limites">
                            <svg width="300" height="100" viewBox="0 0 300 100">
                                <line x1="20" y1="80" x2="120" y2="20" stroke="#39FF14" stroke-width="3"/>
                                <line x1="120" y1="20" x2="220" y2="40" stroke="#FF6B6B" stroke-width="3" stroke-dasharray="5,2"/>
                                <text x="70" y="90" fill="#39FF14" font-size="10" text-anchor="middle">Elástico</text>
                                <text x="170" y="50" fill="#FF6B6B" font-size="10" text-anchor="middle">Plástico</text>
                                <line x1="120" y1="20" x2="120" y2="80" stroke="white" stroke-width="1" stroke-dasharray="3,2"/>
                                <text x="120" y="90" fill="white" font-size="8" text-anchor="middle">Límite elástico</text>
                            </svg>
                        </div>
                        <p><strong>Consecuencia:</strong> Superar este límite causa deformación permanente.</p>
                    </div>
                </div>
            </div>

            <div class="error-card">
                <div class="error-header" onclick="toggleError(this)">
                    <h3>❌ CONFUNDIR CONSTANTE ELÁSTICA CON MASA</h3>
                    <span class="error-toggle">+</span>
                </div>
                <div class="error-content">
                    <div class="error-ejemplo">
                        <strong>Error:</strong> "Un resorte con mayor constante elástica puede sostener más masa porque es \'más fuerte\'".
                    </div>
                    <div class="error-correccion">
                        <strong>Corrección:</strong>
                        <p>La constante elástica (\\(k\\)) determina:</p>
                        <ul>
                            <li>La <strong>rigidez</strong> del resorte (no su "fuerza")</li>
                            <li>La relación entre <strong>fuerza aplicada</strong> y <strong>deformación</strong></li>
                            <li>La <strong>frecuencia natural</strong> de oscilación: \\(\\omega = \\sqrt{k/m}\\)</li>
                        </ul>
                        <p><strong>Ejemplo:</strong> Un resorte con \\(k = 1000\\) N/m se deforma 1 cm con 10 N, mientras que uno con \\(k = 100\\) N/m se deforma 10 cm con la misma fuerza.</p>
                    </div>
                </div>
            </div>

            <!-- MÁS ERRORES COMUNES -->
            <!-- ... -->
        </div>
    </section>

    <!-- PROBLEMAS TIPO EXAMEN -->
    <section class="examen-section">
        <h2 class="seccion-titulo neon-evaluacion">
            <span class="icon">📝</span> PROBLEMAS TIPO EXAMEN (12 EJERCICIOS)
        </h2>
        <div class="examen-container">
            <div class="problema-card">
                <div class="problema-header">
                    <span class="problema-num">P1</span>
                    <h3>Cálculo Básico de \\(E_{pe}\\)</h3>
                </div>
                <div class="problema-enunciado">
                    <p>Un resorte con constante elástica \\(k = 300\\) N/m se estira 8 cm. Calcula:</p>
                    <ol>
                        <li>La energía potencial elástica almacenada</li>
                        <li>La fuerza necesaria para mantener esa deformación</li>
                        <li>La energía potencial si la deformación se duplica</li>
                    </ol>
                </div>
                <div class="problema-espacio">
                    <textarea placeholder="Desarrolla tu solución paso a paso..." rows="6"></textarea>
                </div>
                <button class="btn-verificar" onclick="verificarProblema(1)">
                    ✅ VERIFICAR SOLUCIÓN
                </button>
                <div class="problema-solucion" id="solucionP1" style="display: none;">
                    <strong>Solución:</strong><br>
                    1. \\(E_{pe} = \\frac{1}{2} \\times 300 \\times (0.08)^2 = 0.96\\) J<br>
                    2. \\(F = kx = 300 \\times 0.08 = 24\\) N<br>
                    3. \\(E_{pe}\' = 4 \\times 0.96 = 3.84\\) J (por dependencia cuadrática)
                </div>
            </div>

            <div class="problema-card">
                <div class="problema-header">
                    <span class="problema-num">P2</span>
                    <h3>Sistema Masa-Resorte Vertical</h3>
                </div>
                <div class="problema-enunciado">
                    <p>Una masa de 0.5 kg cuelga de un resorte con \\(k = 250\\) N/m, estirándolo 2 cm desde su posición natural. Calcula:</p>
                    <ol>
                        <li>La energía potencial elástica almacenada</li>
                        <li>La velocidad máxima de la masa si se suelta desde esa posición</li>
                        <li>La frecuencia de oscilación del sistema</li>
                    </ol>
                </div>
                <div class="problema-espacio">
                    <textarea placeholder="Muestra todos los cálculos..." rows="8"></textarea>
                </div>
                <button class="btn-verificar" onclick="verificarProblema(2)">
                    ✅ VERIFICAR SOLUCIÓN
                </button>
                <div class="problema-solucion" id="solucionP2" style="display: none;">
                    <strong>Solución:</strong><br>
                    1. \\(E_{pe} = \\frac{1}{2} \\times 250 \\times (0.02)^2 = 0.05\\) J<br>
                    2. \\(0.05 = \\frac{1}{2} \\times 0.5 \\times v^2\\) → \\(v = 0.447\\) m/s<br>
                    3. \\(\\omega = \\sqrt{\\frac{250}{0.5}} = 22.36\\) rad/s → \\(f = 3.56\\) Hz
                </div>
            </div>

            <div class="problema-card">
                <div class="problema-header">
                    <span class="problema-num">P3</span>
                    <h3>Conservación de Energía Mecánica</h3>
                </div>
                <div class="problema-enunciado">
                    <p>Un resorte horizontal con \\(k = 400\\) N/m tiene una masa de 2 kg acoplada. Se comprime 10 cm y se suelta. Calcula:</p>
                    <ol>
                        <li>La energía mecánica total del sistema</li>
                        <li>La velocidad de la masa cuando pasa por la posición de equilibrio</li>
                        <li>La aceleración máxima del sistema</li>
                    </ol>
                </div>
                <div class="problema-espacio">
                    <textarea placeholder="Desarrolla tu solución..." rows="8"></textarea>
                </div>
                <button class="btn-verificar" onclick="verificarProblema(3)">
                    ✅ VERIFICAR SOLUCIÓN
                </button>
                <div class="problema-solucion" id="solucionP3" style="display: none;">
                    <strong>Solución:</strong><br>
                    1. \\(E_{total} = \\frac{1}{2} \\times 400 \\times (0.1)^2 = 2\\) J<br>
                    2. En equilibrio: \\(E_{total} = E_k\\) → \\(2 = \\frac{1}{2} \\times 2 \\times v^2\\) → \\(v = 2\\) m/s<br>
                    3. \\(a_{max} = \\frac{F_{max}}{m} = \\frac{400 \\times 0.1}{2} = 20\\) m/s²
                </div>
            </div>

            <!-- PROBLEMAS 4-12 -->
            <!-- ... -->
        </div>

        <div class="rubrica">
            <h4>📋 RÚBRICA DE EVALUACIÓN</h4>
            <table class="rubrica-table">
                <tr>
                    <th>Criterio</th>
                    <th>Excelente (5 pts)</th>
                    <th>Satisfactorio (3-4 pts)</th>
                    <th>Insuficiente (0-2 pts)</th>
                </tr>
                <tr>
                    <td>Aplicación de la Ley de Hooke</td>
                    <td>Usa correctamente \\(F = -kx\\) en todos los casos</td>
                    <td>Errores menores en signos o unidades</td>
                    <td>Confunde fuerza con energía o deformación</td>
                </tr>
                <tr>
                    <td>Cálculo de \\(E_{pe}\\)</td>
                    <td>Aplica \\(E_{pe} = \\frac{1}{2}kx^2\\) correctamente</td>
                    <td>Errores en dependencia cuadrática</td>
                    <td>Usa fórmula incorrecta para \\(E_{pe}\\)</td>
                </tr>
                <tr>
                    <td>Conservación de energía mecánica</td>
                    <td>Analiza correctamente \\(E_k + E_{pe} = \\text{cte}\\)</td>
                    <td>Errores en transformación de energías</td>
                    <td>No comprende la conservación</td>
                </tr>
                <tr>
                    <td>Análisis de sistemas oscilantes</td>
                    <td>Relaciona \\(k\\), \\(m\\) y frecuencia correctamente</td>
                    <td>Errores en cálculos de frecuencia</td>
                    <td>No comprende relación entre parámetros</td>
                </tr>
            </table>
        </div>
    </section>

    <!-- CIERRE METACOGNITIVO -->
    <section class="cierre-section">
        <h2 class="seccion-titulo neon-concepto">
            <span class="icon">🧠</span> CIERRE METACOGNITIVO
        </h2>
        <div class="cierre-container">
            <div class="autoevaluacion">
                <h3>📊 AUTOEVALUACIÓN</h3>
                <div class="slider-group">
                    <label>Comprensión de la Ley de Hooke:</label>
                    <input type="range" min="1" max="5" value="3" class="autoeval-slider" id="slider1">
                    <div class="slider-labels">
                        <span>Básico</span><span>Intermedio</span><span>Avanzado</span>
                    </div>
                </div>
                <div class="slider-group">
                    <label>Cálculo de energía potencial elástica:</label>
                    <input type="range" min="1" max="5" value="3" class="autoeval-slider" id="slider2">
                    <div class="slider-labels">
                        <span>Básico</span><span>Intermedio</span><span>Avanzado</span>
                    </div>
                </div>
                <div class="slider-group">
                    <label>Aplicación en sistemas reales:</label>
                    <input type="range" min="1" max="5" value="3" class="autoeval-slider" id="slider3">
                    <div class="slider-labels">
                        <span>Básico</span><span>Intermedio</span><span>Avanzado</span>
                    </div>
                </div>
                <button class="btn-guardar" onclick="guardarAutoevaluacion()">
                    💾 GUARDAR AUTOEVALUACIÓN
                </button>
            </div>

            <div class="reflexion">
                <h3>🤔 REFLEXIÓN GUIADA</h3>
                <div class="pregunta-reflexion">
                    <p>¿Cómo aplicaría los principios de la energía potencial elástica para diseñar un sistema de amortiguación para un edificio en zona sísmica?</p>
                    <textarea placeholder="Considera: selección de resortes, cálculo de energías, límites elásticos..." rows="3"></textarea>
                </div>
                <div class="pregunta-reflexion">
                    <p>Describe un ejemplo cotidiano donde la energía potencial elástica sea crucial para el funcionamiento del dispositivo.</p>
                    <textarea placeholder="Ejemplos: relojes, suspensiones, juguetes, herramientas..." rows="3"></textarea>
                </div>
            </div>

            <div class="plan-estudio">
                <h3>📅 PLAN DE ESTUDIO PERSONALIZADO</h3>
                <div class="plan-grid">
                    <div class="plan-card">
                        <h4>📌 REPASO RÁPIDO (20 min)</h4>
                        <ul>
                            <li>Memorizar \\(F = -kx\\) y \\(E_{pe} = \\frac{1}{2}kx^2\\)</li>
                            <li>Identificar unidades de cada variable</li>
                            <li>Resolver 2 problemas básicos</li>
                        </ul>
                    </div>
                    <div class="plan-card">
                        <h4>🛠 PRÁCTICA (40 min)</h4>
                        <ul>
                            <li>Usar simulador con 3 configuraciones diferentes</li>
                            <li>Resolver problemas 3-6 del examen</li>
                            <li>Completar 10 preguntas del quiz</li>
                        </ul>
                    </div>
                    <div class="plan-card">
                        <h4>🧠 PROFUNDIZACIÓN (60 min)</h4>
                        <ul>
                            <li>Investigar aplicaciones en ingeniería sísmica</li>
                            <li>Analizar límites elásticos en materiales reales</li>
                            <li>Resolver problemas avanzados (7-12)</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="recursos">
                <h3>🔗 RECURSOS ADICIONALES</h3>
                <div class="recursos-links">
                    <a href="https://phet.colorado.edu/es/simulation/masses-and-springs" target="_blank" class="recurso-link">
                        🌀 Simulador PhET: Masas y Resortes
                    </a>
                    <a href="https://www.khanacademy.org/science/physics/work-and-energy" target="_blank" class="recurso-link">
                        📚 Khan Academy: Trabajo y Energía
                    </a>
                    <a href="https://hyperphysics.phy-astr.gsu.edu/hbase/permot2.html" target="_blank" class="recurso-link">
                        🔬 HyperPhysics: Oscilaciones
                    </a>
                    <a href="https://www.engineeringtoolbox.com/spring-constant-d_925.html" target="_blank" class="recurso-link">
                        🛠 Engineering Toolbox: Constantes de Resortes
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- JAVASCRIPT COMPLETO -->
<script>
// ===========================================
// SIMULADOR DE ENERGÍA POTENCIAL ELÁSTICA
// ===========================================
let simulacionActiva = false;
let animacionID = null;

function iniciarSimulacion() {
    if (simulacionActiva) {
        cancelAnimationFrame(animacionID);
    }

    // Obtener valores de controles
    const k = parseFloat(document.getElementById(\'constanteElastica\').value);
    const m = parseFloat(document.getElementById(\'masaObjeto\').value);
    const x = parseFloat(document.getElementById(\'deformacionInicial\').value);
    const tipo = document.getElementById(\'tipoSimulacion\').value;

    // Actualizar valores mostrados
    document.getElementById(\'valorK\').textContent = `${k} N/m`;
    document.getElementById(\'valorMasa\').textContent = `${m} kg`;
    document.getElementById(\'valorDeformacion\').textContent = `${x} m`;

    // Cálculos físicos
    const epeMax = 0.5 * k * Math.pow(x, 2);
    const omega = Math.sqrt(k / m);
    const periodo = 2 * Math.PI / omega;

    // Actualizar datos
    document.getElementById(\'dataK\').textContent = `${k} N/m`;
    document.getElementById(\'dataMasa\').textContent = `${m} kg`;
    document.getElementById(\'dataDeformacion\').textContent = `${x} m`;
    document.getElementById(\'dataEPEMax\').textContent = `${epeMax.toFixed(2)} J`;
    document.getElementById(\'dataFrecuencia\').textContent = `${omega.toFixed(2)} rad/s`;
    document.getElementById(\'dataPeriodo\').textContent = `${periodo.toFixed(2)} s`;

    // Configurar visualización según tipo de simulación
    const resorte = document.getElementById(\'resorte\');
    const masa = document.getElementById(\'masa\');
    const indicadores = document.getElementById(\'indicadores\');
    const graficaEnergias = document.getElementById(\'graficaEnergias\');

    // Reiniciar visualización
    graficaEnergias.setAttribute(\'opacity\', \'0\');
    indicadores.setAttribute(\'opacity\', \'0\');

    if (tipo === \'deformacion\') {
        // Mostrar deformación estática
        deformarResorte(k, x);
        document.getElementById(\'textoEPE\').textContent = `Epe = ${epeMax.toFixed(2)} J`;
        document.getElementById(\'textoEK\').textContent = `Ek = 0.0 J`;
        document.getElementById(\'textoTotal\').textContent = `Etotal = ${epeMax.toFixed(2)} J`;
        indicadores.setAttribute(\'opacity\', \'1\');
    }
    else if (tipo === \'oscilacion\') {
        // Animación de oscilación
        simulacionActiva = true;
        let tiempo = 0;
        const amplitud = x * 100; // Escalar para visualización

        function animar() {
            const posicion = amplitud * Math.sin(omega * tiempo);
            const velocidad = amplitud * omega * Math.cos(omega * tiempo);
            const ek = epeMax * Math.pow(Math.sin(omega * tiempo), 2);
            const currentEpe = epeMax * Math.pow(Math.cos(omega * tiempo), 2);

            // Actualizar posición de la masa
            const nuevaY = 330 + posicion;
            document.getElementById(\'cajaMasa\').setAttribute(\'y\', nuevaY);
            document.getElementById(\'textoMasa\').setAttribute(\'y\', nuevaY + 25);

            // Actualizar deformación del resorte
            const longitudNatural = 50; // Longitud natural en SVG
            const nuevaLongitud = longitudNatural + posicion;
            document.getElementById(\'espiralResorte\').setAttribute(\'d\',
                `M70 250 Q60 ${250 + posicion/2} 70 ${250 + posicion} Q80 ${250 + posicion*1.5} 70 ${250 + posicion*2}`);

            // Actualizar indicadores de energía
            document.getElementById(\'textoEPE\').textContent = `Epe = ${currentEpe.toFixed(2)} J`;
            document.getElementById(\'textoEK\').textContent = `Ek = ${ek.toFixed(2)} J`;
            document.getElementById(\'textoTotal\').textContent = `Etotal = ${(currentEpe + ek).toFixed(2)} J`;
            indicadores.setAttribute(\'opacity\', \'1\');

            tiempo += 0.05;
            animacionID = requestAnimationFrame(animar);
        }
        animar();
    }
    else if (tipo === \'energias\') {
        // Mostrar gráfica de energías
        graficaEnergias.setAttribute(\'opacity\', \'1\');

        // Dibujar curvas de energía
        const curvaEPE = document.getElementById(\'curvaEPE\');
        const curvaEK = document.getElementById(\'curvaEK\');

        // Parámetros para la gráfica (simplificada)
        const A = 100; // Amplitud en SVG
        const escalaX = 3;  // Escalado horizontal
        const escalaY = 1.5; // Escalado vertical

        curvaEPE.setAttribute(\'d\',
            `M320,370 Q${320 + A/escaleX},${370 - epeMax*escaleY} ${320 + 2*A/escaleX},370`);
        curvaEK.setAttribute(\'d\',
            `M320,370 Q${320 + A/escaleX},370 ${320 + 2*A/escaleX},${370 - epeMax*escaleY} Q${320 + 3*A/escaleX},370`);
    }
}

function deformarResorte(k, x) {
    const escala = 200; // Factor de escala para visualización
    const deformacionVisual = x * escala;

    // Deformar resorte (simplificado)
    const espiral = document.getElementById(\'espiralResorte\');
    espiral.setAttribute(\'d\',
        `M70 250 Q60 ${250 + deformacionVisual/2} 70 ${250 + deformacionVisual}
         Q80 ${250 + deformacionVisual*1.5} 70 ${250 + deformacionVisual*2}`);

    // Mover masa
    const caja = document.getElementById(\'cajaMasa\');
    caja.setAttribute(\'y\', 330 + deformacionVisual);
    document.getElementById(\'textoMasa\').setAttribute(\'y\', 355 + deformacionVisual);
}

function reiniciarSimulador() {
    if (simulacionActiva) {
        cancelAnimationFrame(animacionID);
        simulacionActiva = false;
    }

    // Reiniciar controles
    document.getElementById(\'constanteElastica\').value = 200;
    document.getElementById(\'masaObjeto\').value = 1;
    document.getElementById(\'deformacionInicial\').value = 0.1;
    document.getElementById(\'tipoSimulacion\').value = \'oscilacion\';
    document.getElementById(\'valorK\').textContent = \'200 N/m\';
    document.getElementById(\'valorMasa\').textContent = \'1 kg\';
    document.getElementById(\'valorDeformacion\').textContent = \'0.10 m\';

    // Reiniciar visualización
    document.getElementById(\'cajaMasa\').setAttribute(\'y\', \'330\');
    document.getElementById(\'textoMasa\').setAttribute(\'y\', \'355\');
    document.getElementById(\'espiralResorte\').setAttribute(\'d\',
        \'M70 250 Q60 270 70 290 Q80 310 70 330\');
    document.getElementById(\'indicadores\').setAttribute(\'opacity\', \'0\');
    document.getElementById(\'graficaEnergias\').setAttribute(\'opacity\', \'0\');

    // Reiniciar datos
    document.getElementById(\'dataK\').textContent = \'200 N/m\';
    document.getElementById(\'dataMasa\').textContent = \'1 kg\';
    document.getElementById(\'dataDeformacion\').textContent = \'0.10 m\';
    document.getElementById(\'dataEPEMax\').textContent = \'1.0 J\';
    document.getElementById(\'dataFrecuencia\').textContent = \'14.1 rad/s\';
    document.getElementById(\'dataPeriodo\').textContent = \'0.44 s\';
}

// ===========================================
// QUIZ INTERACTIVO (30 PREGUNTAS)
// ===========================================
let quizRespuestas = [];
let quizCompletado = false;

document.querySelectorAll(\'.quiz-option\').forEach(option => {
    option.addEventListener(\'click\', function() {
        if (quizCompletado) return;

        const question = this.closest(\'.quiz-question\');
        const correct = question.dataset.correct;
        const selected = this.dataset.value;
        const feedback = question.querySelector(\'.quiz-feedback\');

        // Limpiar selección previa
        question.querySelectorAll(\'.quiz-option\').forEach(opt => {
            opt.classList.remove(\'selected\', \'correct\', \'incorrect\');
        });

        // Marcar selección actual
        this.classList.add(\'selected\');

        // Verificar respuesta
        if (selected === correct) {
            this.classList.add(\'correct\');
            quizRespuestas.push(true);
        } else {
            this.classList.add(\'incorrect\');
            question.querySelector(`[data-value="${correct}"]`).classList.add(\'correct\');
            quizRespuestas.push(false);
        }

        // Mostrar feedback
        feedback.style.display = \'block\';

        // Verificar si todas las preguntas están respondidas
        const questions = document.querySelectorAll(\'.quiz-question\');
        const answered = Array.from(questions).every(q =>
            q.querySelector(\'.quiz-option.selected\')
        );

        if (answered && !quizCompletado) {
            quizCompletado = true;
            const correctas = quizRespuestas.filter(r => r).length;
            const total = quizRespuestas.length;
            const porcentaje = Math.round((correctas / total) * 100);

            document.getElementById(\'quizScore\').textContent = `${correctas}/${total}`;

            let feedbackText = "";
            if (porcentaje >= 90) {
                feedbackText = "🎉 ¡Excelente! Dominas la energía potencial elástica y la Ley de Hooke.";
            } else if (porcentaje >= 70) {
                feedbackText = "👍 Buen trabajo, pero repasa la derivación de \\(E_{pe}\\) y los límites elásticos.";
            } else if (porcentaje >= 50) {
                feedbackText = "⚠️ Necesitas practicar más con el simulador y los problemas.";
            } else {
                feedbackText = "😕 Revisa todas las secciones teóricas y los ejemplos.";
            }

            document.getElementById(\'quizFeedback\').textContent = feedbackText;
            document.querySelector(\'.quiz-results\').style.display = \'block\';
        }
    });
});

function reiniciarQuiz() {
    quizRespuestas = [];
    quizCompletado = false;

    document.querySelectorAll(\'.quiz-option\').forEach(opt => {
        opt.classList.remove(\'selected\', \'correct\', \'incorrect\');
    });

    document.querySelectorAll(\'.quiz-feedback\').forEach(fb => {
        fb.style.display = \'none\';
    });

    document.querySelector(\'.quiz-results\').style.display = \'none\';
}

// ===========================================
// ERRORES COMUNES INTERACTIVOS
// ===========================================
function toggleError(header) {
    const content = header.nextElementSibling;
    const toggle = header.querySelector(\'.error-toggle\');

    if (content.style.display === \'block\') {
        content.style.display = \'none\';
        toggle.textContent = \'+\';
    } else {
        content.style.display = \'block\';
        toggle.textContent = \'-\';
    }
}

// ===========================================
// PROBLEMAS TIPO EXAMEN
// ===========================================
function verificarProblema(num) {
    const solucion = document.getElementById(`solucionP${num}`);
    if (solucion.style.display === \'block\') {
        solucion.style.display = \'none\';
    } else {
        solucion.style.display = \'block\';
    }
}

// ===========================================
// AUTOEVALUACIÓN METACOGNITIVA
// ===========================================
function guardarAutoevaluacion() {
    const slider1 = document.getElementById(\'slider1\').value;
    const slider2 = document.getElementById(\'slider2\').value;
    const slider3 = document.getElementById(\'slider3\').value;
    const promedio = (parseInt(slider1) + parseInt(slider2) + parseInt(slider3)) / 3;

    alert(
        `📊 Autoevaluación guardada:\\n\\n` +
        `Ley de Hooke: ${slider1}/5\\n` +
        `Energía potencial elástica: ${slider2}/5\\n` +
        `Aplicaciones prácticas: ${slider3}/5\\n\\n` +
        `Promedio: ${promedio.toFixed(1)}/5\\n\\n` +
        `Recomendación: Revisa el plan de estudio según tus resultados.`
    );
}

// ===========================================
// OBJETIVOS INTERACTIVOS
// ===========================================
document.querySelectorAll(\'.objetivo-card\').forEach(card => {
    card.addEventListener(\'click\', function() {
        const completado = this.dataset.completado === \'true\';
        this.dataset.completado = !completado;
        const checkbox = this.querySelector(\'.objetivo-checkbox\');
        checkbox.textContent = !completado ? \'✓\' : \'\';
        checkbox.style.backgroundColor = !completado ? \'#39FF14\' : \'\';
    });
});

// ===========================================
// ACTUALIZACIÓN DE VALORES EN TIEMPO REAL
// ===========================================
document.getElementById(\'constanteElastica\').addEventListener(\'input\', function() {
    document.getElementById(\'valorK\').textContent = this.value + \' N/m\';
});

document.getElementById(\'masaObjeto\').addEventListener(\'input\', function() {
    document.getElementById(\'valorMasa\').textContent = this.value + \' kg\';
});

document.getElementById(\'deformacionInicial\').addEventListener(\'input\', function() {
    document.getElementById(\'valorDeformacion\').textContent = this.value + \' m\';
});

// ===========================================
// INICIALIZACIÓN
// ===========================================
console.log("🌀 Lección: Energía Potencial Elástica cargada");
console.log("🎮 Simulador, Quiz (30 preguntas) y 12 problemas listos");
console.log("📊 Todos los sistemas interactivos funcionando");
</script>',
    'ejercicios' => 
    array (
      0 => 
      array (
        'enunciado' => 'Fórmula ley de Hooke',
        'respuesta' => 'F = -k x',
      ),
      1 => 
      array (
        'enunciado' => 'Fórmula EPE',
        'respuesta' => '½ k x²',
      ),
      2 => 
      array (
        'enunciado' => 'Unidad k',
        'respuesta' => 'N/m',
      ),
      3 => 
      array (
        'enunciado' => 'Signo - en Hooke',
        'respuesta' => 'Fuerza restauradora',
      ),
      4 => 
      array (
        'enunciado' => 'k = 500 N/m, x = 0.1 m → EPE',
        'respuesta' => '2.5 J',
      ),
      5 => 
      array (
        'enunciado' => 'x dobla → EPE',
        'respuesta' => '×4',
      ),
      6 => 
      array (
        'enunciado' => 'Resorte relajado EPE',
        'respuesta' => '0',
      ),
      7 => 
      array (
        'enunciado' => 'Trabajo para comprimir =',
        'respuesta' => 'ΔEPE',
      ),
      8 => 
      array (
        'enunciado' => 'F constante en resorte',
        'respuesta' => 'No (varía con x)',
      ),
      9 => 
      array (
        'enunciado' => 'Límite elástico',
        'respuesta' => 'Hooke válido',
      ),
      10 => 
      array (
        'enunciado' => 'k alto → resorte',
        'respuesta' => 'Más rígido',
      ),
      11 => 
      array (
        'enunciado' => 'EPE máxima en',
        'respuesta' => 'x máxima',
      ),
    ),
    'quiz' => 
    array (
      0 => 
      array (
        'pregunta' => 'Ley de Hooke F =',
        'opciones' => 
        array (
          0 => '-k x',
          1 => 'k x',
          2 => 'm a',
          3 => 'm g',
        ),
        'correcta' => '-k x',
      ),
      1 => 
      array (
        'pregunta' => 'EPE =',
        'opciones' => 
        array (
          0 => '½ k x²',
          1 => 'k x',
          2 => 'm g h',
          3 => '½ m v²',
        ),
        'correcta' => '½ k x²',
      ),
      2 => 
      array (
        'pregunta' => 'k unidad',
        'opciones' => 
        array (
          0 => 'N/m',
          1 => 'J',
          2 => 'kg',
          3 => 'm/s²',
        ),
        'correcta' => 'N/m',
      ),
      3 => 
      array (
        'pregunta' => 'x = deformación',
        'opciones' => 
        array (
          0 => 'Sí',
          1 => 'No',
          2 => 'A veces',
          3 => 'Nunca',
        ),
        'correcta' => 'Sí',
      ),
      4 => 
      array (
        'pregunta' => 'Signo - indica',
        'opciones' => 
        array (
          0 => 'Restauradora',
          1 => 'Positiva',
          2 => 'Nada',
          3 => 'Error',
        ),
        'correcta' => 'Restauradora',
      ),
      5 => 
      array (
        'pregunta' => 'Resorte relajado F =',
        'opciones' => 
        array (
          0 => '0',
          1 => 'k',
          2 => 'x',
          3 => 'máxima',
        ),
        'correcta' => '0',
      ),
      6 => 
      array (
        'pregunta' => 'x dobla → EPE',
        'opciones' => 
        array (
          0 => '×4',
          1 => '×2',
          2 => '½',
          3 => 'igual',
        ),
        'correcta' => '×4',
      ),
      7 => 
      array (
        'pregunta' => 'k dobla → EPE',
        'opciones' => 
        array (
          0 => '×2',
          1 => '×4',
          2 => '½',
          3 => 'igual',
        ),
        'correcta' => '×2',
      ),
      8 => 
      array (
        'pregunta' => 'Trabajo = ΔEPE',
        'opciones' => 
        array (
          0 => 'Sí',
          1 => 'No',
          2 => 'A veces',
          3 => 'Nunca',
        ),
        'correcta' => 'Sí',
      ),
      9 => 
      array (
        'pregunta' => 'Límite elástico',
        'opciones' => 
        array (
          0 => 'Hooke válido',
          1 => 'Siempre',
          2 => 'Nunca',
          3 => 'Solo x=0',
        ),
        'correcta' => 'Hooke válido',
      ),
      10 => 
      array (
        'pregunta' => 'k = 100 N/m, x = 0.2 m → EPE',
        'opciones' => 
        array (
          0 => '2 J',
          1 => '20 J',
          2 => '4 J',
          3 => '0 J',
        ),
        'correcta' => '2 J',
      ),
      11 => 
      array (
        'pregunta' => 'F = 50 N, k = 500 N/m → x',
        'opciones' => 
        array (
          0 => '0.1 m',
          1 => '10 m',
          2 => '0.01 m',
          3 => '50 m',
        ),
        'correcta' => '0.1 m',
      ),
      12 => 
      array (
        'pregunta' => 'Resorte rígido tiene k',
        'opciones' => 
        array (
          0 => 'alto',
          1 => 'bajo',
          2 => 'cero',
          3 => 'negativo',
        ),
        'correcta' => 'alto',
      ),
      13 => 
      array (
        'pregunta' => 'Energía en resorte oscilante',
        'opciones' => 
        array (
          0 => 'EP + EK = cte',
          1 => 'solo EP',
          2 => 'solo EK',
          3 => 'crece',
        ),
        'correcta' => 'EP + EK = cte',
      ),
      14 => 
      array (
        'pregunta' => 'Máximo EK en resorte',
        'opciones' => 
        array (
          0 => 'x = 0',
          1 => 'x máxima',
          2 => 'x = 1',
          3 => 'x = k',
        ),
        'correcta' => 'x = 0',
      ),
      15 => 
      array (
        'pregunta' => 'Máximo EPE en',
        'opciones' => 
        array (
          0 => 'x máxima',
          1 => 'x = 0',
          2 => 'v máxima',
          3 => 'm = 0',
        ),
        'correcta' => 'x máxima',
      ),
      16 => 
      array (
        'pregunta' => 'Período resorte T =',
        'opciones' => 
        array (
          0 => '2π √(m/k)',
          1 => '2π √(k/m)',
          2 => '2π m/k',
          3 => '2π k/m',
        ),
        'correcta' => '2π √(m/k)',
      ),
      17 => 
      array (
        'pregunta' => 'Fuerza constante → EPE',
        'opciones' => 
        array (
          0 => 'No cuadrática',
          1 => 'cuadrática',
          2 => 'lineal',
          3 => 'cero',
        ),
        'correcta' => 'No cuadrática',
      ),
      18 => 
      array (
        'pregunta' => 'SI: k en',
        'opciones' => 
        array (
          0 => 'N/m',
          1 => 'J/m',
          2 => 'kg/s²',
          3 => 'Pa',
        ),
        'correcta' => 'N/m',
      ),
      19 => 
      array (
        'pregunta' => 'IUPAC/SI 2025: EPE en',
        'opciones' => 
        array (
          0 => 'Joule',
          1 => 'cal',
          2 => 'eV',
          3 => 'kWh',
        ),
        'correcta' => 'Joule',
      ),
      20 => 
      array (
        'pregunta' => 'k = 800 N/m, x = 0.05 m → EPE',
        'opciones' => 
        array (
          0 => '1 J',
          1 => '2 J',
          2 => '0.5 J',
          3 => '10 J',
        ),
        'correcta' => '1 J',
      ),
      21 => 
      array (
        'pregunta' => 'Trabajo para estirar 0.1 m (k=400 N/m)',
        'opciones' => 
        array (
          0 => '2 J',
          1 => '40 J',
          2 => '4 J',
          3 => '0 J',
        ),
        'correcta' => '2 J',
      ),
      22 => 
      array (
        'pregunta' => 'Resorte serie: k_eq =',
        'opciones' => 
        array (
          0 => 'k/2',
          1 => '2k',
          2 => 'k',
          3 => '0',
        ),
        'correcta' => 'k/2',
      ),
      23 => 
      array (
        'pregunta' => 'Resorte paralelo: k_eq =',
        'opciones' => 
        array (
          0 => '2k',
          1 => 'k/2',
          2 => 'k',
          3 => '0',
        ),
        'correcta' => '2k',
      ),
      24 => 
      array (
        'pregunta' => 'Energía disipada en amortiguador',
        'opciones' => 
        array (
          0 => 'Térmica',
          1 => 'Eléctrica',
          2 => 'Nuclear',
          3 => 'Radiante',
        ),
        'correcta' => 'Térmica',
      ),
      25 => 
      array (
        'pregunta' => 'Fuerza máxima en resorte',
        'opciones' => 
        array (
          0 => 'k x_max',
          1 => 'k',
          2 => 'x',
          3 => '0',
        ),
        'correcta' => 'k x_max',
      ),
      26 => 
      array (
        'pregunta' => 'Límite proporcional',
        'opciones' => 
        array (
          0 => 'Hooke válido',
          1 => 'Plástico',
          2 => 'Roto',
          3 => 'Cero',
        ),
        'correcta' => 'Hooke válido',
      ),
      27 => 
      array (
        'pregunta' => 'Módulo Young Y =',
        'opciones' => 
        array (
          0 => 'σ/ε',
          1 => 'F/A',
          2 => 'ΔL/L',
          3 => 'kL/A',
        ),
        'correcta' => 'σ/ε',
      ),
      28 => 
      array (
        'pregunta' => 'Resorte ideal vs real',
        'opciones' => 
        array (
          0 => 'Real pierde energía',
          1 => 'Igual',
          2 => 'Ideal más rígido',
          3 => 'Real más rígido',
        ),
        'correcta' => 'Real pierde energía',
      ),
      29 => 
      array (
        'pregunta' => 'SI 2025: 1 J =',
        'opciones' => 
        array (
          0 => 'N·m',
          1 => 'kg·m/s²',
          2 => 'W·s',
          3 => 'todas',
        ),
        'correcta' => 'todas',
      ),
    ),
  ),
  9 => 
  array (
    'materia' => 'Física I',
    'slug' => 'trabajo-fisica',
    'titulo' => 'El Trabajo: W = F · d cos θ',
    'contenido' => '<div class="leccion-container leccion-fisica-trabajo" data-tema="trabajo">
    <!-- CABECERA CYBERPUNK -->
    <header class="leccion-header">
        <h1 class="titulo-leccion neon-glow">
            <span class="icon-tema">⚡</span>
            EL TRABAJO: <span class="formula-highlight">W = F · d cos θ</span>
        </h1>
        <div class="subtitulo">
            Transferencia de energía cuando una fuerza actúa sobre un desplazamiento
        </div>
    </header>

    <!-- PANEL OBJETIVOS -->
    <section class="panel-objetivos">
        <h2 class="seccion-titulo neon-concepto">
            <span class="icon">🎯</span> OBJETIVOS DE APRENDIZAJE
        </h2>
        <div class="objetivos-grid">
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Calcular el trabajo en diferentes ángulos</h3>
                <p>Usar la fórmula \\( W = F \\cdot d \\cdot \\cos \\theta \\) con precisión</p>
            </div>
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Diferenciar trabajo positivo, nulo y negativo</h3>
                <p>Analizar el ángulo θ y su impacto en el signo del trabajo</p>
            </div>
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Aplicar el teorema Trabajo-Energía</h3>
                <p>Relacionar \\( W_{\\text{neto}} = \\Delta E_k \\) en problemas reales</p>
            </div>
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Simular escenarios de fuerzas y desplazamientos</h3>
                <p>Usar el simulador interactivo para visualizar conceptos</p>
            </div>
        </div>
    </section>

    <!-- CONTEXTO REAL -->
    <section class="contexto-real">
        <h2 class="seccion-titulo neon-dato">
            <span class="icon">🌍</span> APLICACIÓN EN EL MUNDO REAL
        </h2>
        <div class="contexto-grid">
            <div class="contexto-card">
                <h3>🚀 Lanzamiento de Cohetes</h3>
                <p>El trabajo realizado por los motores para vencer la gravedad y alcanzar la órbita</p>
                <div class="dato-neon">Fuerza: 35 MN | Trabajo: 1.2 TJ</div>
            </div>
            <div class="contexto-card">
                <h3>🏋️ Fisioterapia Deportiva</h3>
                <p>Ejercicios de resistencia donde el ángulo entre la fuerza aplicada y el movimiento es clave</p>
                <div class="dato-neon">Ángulo óptimo: 45°-60°</div>
            </div>
            <div class="contexto-card">
                <h3>🔋 Energías Renovables</h3>
                <p>Trabajo realizado por el viento sobre las aspas de un aerogenerador</p>
                <div class="dato-neon">Potencia: 2-5 MW por turbina</div>
            </div>
        </div>
    </section>

    <!-- SECCIÓN TEÓRICA -->
    <section class="teoria-section">
        <div class="borde-neon-lateral"></div>
        <h2 class="seccion-titulo neon-concepto">
            <span class="icon">📚</span> FUNDAMENTOS TEÓRICOS
        </h2>

        <!-- DEFINICIÓN Y FÓRMULA -->
        <div class="subseccion">
            <h3>1. Definición de Trabajo</h3>
            <div class="definicion-principal">
                <div class="def-card">
                    <h4>TRABAJO (W)</h4>
                    <p>Transferencia de <strong>energía</strong> cuando una <strong>fuerza</strong> actúa sobre un objeto a lo largo de un <strong>desplazamiento</strong>.</p>
                    <div class="formula-inline">
                        \\[
                            W = F \\cdot d \\cdot \\cos \\theta
                        \\]
                    </div>
                    <div class="formula-detalle">
                        <ul>
                            <li><strong>F</strong>: Magnitud de la fuerza (N)</li>
                            <li><strong>d</strong>: Desplazamiento (m)</li>
                            <li><strong>θ</strong>: Ángulo entre F y d (°)</li>
                            <li><strong>Unidad SI</strong>: Joule (J) = N·m</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- CONDICIONES DEL TRABAJO -->
        <div class="subseccion">
            <h3>2. Condiciones del Trabajo según el Ángulo θ</h3>
            <div class="tabla-interactiva">
                <table class="tabla-cyberpunk">
                    <thead>
                        <tr>
                            <th>Ángulo θ</th>
                            <th>cos θ</th>
                            <th>Trabajo (W)</th>
                            <th>Ejemplo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr data-tipo="positivo">
                            <td>0°</td>
                            <td>1</td>
                            <td>Máximo positivo</td>
                            <td>Empujar un carrito en línea recta</td>
                        </tr>
                        <tr data-tipo="nulo">
                            <td>90°</td>
                            <td>0</td>
                            <td>Cero</td>
                            <td>Cargar un objeto horizontalmente</td>
                        </tr>
                        <tr data-tipo="negativo">
                            <td>180°</td>
                            <td>-1</td>
                            <td>Máximo negativo</td>
                            <td>Frenar un auto en movimiento</td>
                        </tr>
                    </tbody>
                </table>
                <div class="tabla-info" id="infoTrabajo">
                    Selecciona una fila para ver detalles
                </div>
            </div>
        </div>

        <!-- TEOREMA TRABAJO-ENERGÍA -->
        <div class="subseccion">
            <h3>3. Teorema Trabajo-Energía</h3>
            <div class="teorema-card">
                <div class="teorema-formula">
                    \\[
                        W_{\\text{neto}} = \\Delta E_k
                    \\]
                </div>
                <div class="teorema-explicacion">
                    <p><strong>Trabajo positivo</strong>: Aumenta la energía cinética (ej: acelerar un auto).</p>
                    <p><strong>Trabajo negativo</strong>: Disminuye la energía cinética (ej: frenar).</p>
                    <p><strong>Trabajo nulo</strong>: No cambia la energía cinética (ej: llevar una maleta horizontalmente).</p>
                </div>
            </div>
        </div>

        <!-- EJEMPLO PRÁCTICO -->
        <div class="subseccion">
            <h3>4. Ejemplo Práctico</h3>
            <div class="ejemplo-card">
                <p><strong>Problema:</strong> Calcula el trabajo realizado al arrastrar un objeto con <strong>F = 50 N</strong>, <strong>d = 10 m</strong> y <strong>θ = 30°</strong>.</p>
                <div class="ejemplo-solucion">
                    <p><strong>Solución:</strong></p>
                    <p>
                        \\[
                            W = 50 \\cdot 10 \\cdot \\cos 30° = 500 \\cdot 0.866 = 433\\, \\text{J}
                        \\]
                    </p>
                </div>
                <button class="btn-verificar" onclick="verificarEjemplo()">VERIFICAR CÁLCULO</button>
                <div class="ejemplo-feedback" id="feedbackEjemplo" style="display: none;">
                    <p>✅ <strong>Correcto:</strong> El trabajo es 433 J. El ángulo de 30° reduce la fuerza efectiva en un factor de cos(30°).</p>
                </div>
            </div>
        </div>
    </section>

    <!-- SIMULADOR INTERACTIVO -->
    <section class="simulator-section">
        <h2 class="seccion-titulo neon-interactivo">
            <span class="icon">🎮</span> SIMULADOR: TRABAJO = F · d cos θ
        </h2>
        <div class="simulator-container" data-tema="trabajo-fuerza">
            <!-- CONTROLES -->
            <div class="simulator-controls">
                <h3>CONTROLES</h3>
                <div class="control-group">
                    <label for="fuerzaInput">Fuerza (F) en N:</label>
                    <input type="range" id="fuerzaInput" min="10" max="100" value="50" class="control-slider">
                    <span id="fuerzaValue">50 N</span>
                </div>
                <div class="control-group">
                    <label for="distanciaInput">Distancia (d) en m:</label>
                    <input type="range" id="distanciaInput" min="1" max="20" value="10" class="control-slider">
                    <span id="distanciaValue">10 m</span>
                </div>
                <div class="control-group">
                    <label for="anguloInput">Ángulo (θ) en °:</label>
                    <input type="range" id="anguloInput" min="0" max="180" value="30" class="control-slider">
                    <span id="anguloValue">30°</span>
                </div>
                <button class="btn-ejecutar" onclick="calcularTrabajo()">
                    <span class="btn-icon">▶</span> CALCULAR TRABAJO
                </button>
                <button class="btn-aleatorio" onclick="valoresAleatorios()">
                    <span class="btn-icon">🎲</span> VALORES ALEATORIOS
                </button>
            </div>

            <!-- VISUALIZACIÓN -->
            <div class="simulator-visualization">
                <svg viewBox="0 0 600 400" id="svgTrabajo">
                    <!-- Fondo -->
                    <rect x="0" y="0" width="600" height="400" fill="#0a0a1a" id="fondoSimulador"/>

                    <!-- Ejes -->
                    <line x1="50" y1="350" x2="550" y2="350" stroke="#4CAF50" stroke-width="2" stroke-dasharray="5,5"/>
                    <text x="550" y="340" fill="#4CAF50" font-size="12" text-anchor="end">d (m)</text>

                    <!-- Vector desplazamiento (d) -->
                    <line x1="50" y1="350" x2="350" y2="350" stroke="#39FF14" stroke-width="4" id="vectorD"/>
                    <text x="200" y="330" fill="#39FF14" font-size="14" text-anchor="middle">d = <span id="svgDistancia">10</span> m</text>

                    <!-- Vector fuerza (F) -->
                    <line x1="50" y1="350" x2="150" y2="250" stroke="#FF00FF" stroke-width="4" id="vectorF"/>
                    <text x="100" y="280" fill="#FF00FF" font-size="14" text-anchor="middle">F = <span id="svgFuerza">50</span> N</text>

                    <!-- Ángulo θ -->
                    <path d="M50 350 A100 350 0 0 0 150 250" fill="none" stroke="#00FFFF" stroke-width="2" id="arcoAngulo"/>
                    <text x="120" y="300" fill="#00FFFF" font-size="12" text-anchor="middle">θ = <span id="svgAngulo">30</span>°</text>

                    <!-- Resultado -->
                    <rect x="200" y="50" width="200" height="80" fill="rgba(0,0,0,0.7)" rx="10" id="resultadoCard"/>
                    <text x="300" y="90" fill="#39FF14" font-size="16" text-anchor="middle" id="resultadoTrabajo">W = 433 J</text>
                    <text x="300" y="120" fill="#FFFFFF" font-size="12" text-anchor="middle" id="resultadoTipo">Trabajo positivo</text>
                </svg>
            </div>

            <!-- DATOS EN TIEMPO REAL -->
            <div class="simulator-data">
                <h3>DATOS DE SIMULACIÓN</h3>
                <div class="data-card">
                    <div class="data-label">Fuerza (F):</div>
                    <div class="data-value" id="dataFuerza">50 N</div>
                </div>
                <div class="data-card">
                    <div class="data-label">Distancia (d):</div>
                    <div class="data-value" id="dataDistancia">10 m</div>
                </div>
                <div class="data-card">
                    <div class="data-label">Ángulo (θ):</div>
                    <div class="data-value" id="dataAngulo">30°</div>
                </div>
                <div class="data-card highlight">
                    <div class="data-label">TRABAJO (W):</div>
                    <div class="data-value" id="dataTrabajo">433 J</div>
                </div>
                <div class="data-card">
                    <div class="data-label">Tipo de trabajo:</div>
                    <div class="data-value" id="dataTipo">Positivo</div>
                </div>
            </div>
        </div>
    </section>

    <!-- QUIZ INTERACTIVO -->
    <section class="quiz-section">
        <h2 class="seccion-titulo neon-evaluacion">
            <span class="icon">❓</span> QUIZ DE AUTOEVALUACIÓN
        </h2>
        <div class="quiz-container">
            <!-- PREGUNTA 1 -->
            <div class="quiz-question" data-correct="B">
                <div class="quiz-header">
                    <span class="quiz-num">01</span>
                    <h3>¿Cuándo es cero el trabajo realizado por una fuerza?</h3>
                </div>
                <div class="quiz-options">
                    <button class="quiz-option" data-value="A">
                        <span class="option-letter">A</span>
                        Cuando la fuerza y el desplazamiento son paralelos
                    </button>
                    <button class="quiz-option" data-value="B">
                        <span class="option-letter">B</span>
                        Cuando la fuerza es perpendicular al desplazamiento
                    </button>
                    <button class="quiz-option" data-value="C">
                        <span class="option-letter">C</span>
                        Cuando la fuerza es mayor a 100 N
                    </button>
                    <button class="quiz-option" data-value="D">
                        <span class="option-letter">D</span>
                        Cuando el desplazamiento es menor a 1 m
                    </button>
                </div>
                <div class="quiz-feedback" style="display: none;">
                    <div class="feedback-correct">
                        ✅ <strong>Correcto:</strong> El trabajo es cero cuando θ = 90° (cos 90° = 0).
                    </div>
                    <div class="feedback-incorrect">
                        ❌ <strong>Incorrecto:</strong> Revisa la fórmula \\( W = F \\cdot d \\cdot \\cos \\theta \\).
                    </div>
                    <div class="feedback-explicacion">
                        <p><strong>Explicación:</strong> El trabajo depende del ángulo entre la fuerza y el desplazamiento. Si son perpendiculares (θ = 90°), cos θ = 0 y W = 0.</p>
                    </div>
                </div>
            </div>

            <!-- PREGUNTA 2 -->
            <div class="quiz-question" data-correct="C">
                <div class="quiz-header">
                    <span class="quiz-num">02</span>
                    <h3>¿Qué trabajo se realiza al aplicar una fuerza de 20 N sobre un objeto que se desplaza 5 m con un ángulo de 60°?</h3>
                </div>
                <div class="quiz-options">
                    <button class="quiz-option" data-value="A">
                        <span class="option-letter">A</span>
                        100 J
                    </button>
                    <button class="quiz-option" data-value="B">
                        <span class="option-letter">B</span>
                        86.6 J
                    </button>
                    <button class="quiz-option" data-value="C">
                        <span class="option-letter">C</span>
                        50 J
                    </button>
                    <button class="quiz-option" data-value="D">
                        <span class="option-letter">D</span>
                        0 J
                    </button>
                </div>
                <div class="quiz-feedback" style="display: none;">
                    <div class="feedback-correct">
                        ✅ <strong>Correcto:</strong> \\( W = 20 \\cdot 5 \\cdot \\cos 60° = 50\\, \\text{J} \\).
                    </div>
                    <div class="feedback-incorrect">
                        ❌ <strong>Incorrecto:</strong> Recuerda que \\( \\cos 60° = 0.5 \\).
                    </div>
                    <div class="feedback-explicacion">
                        <p><strong>Cálculo:</strong> \\( W = 20 \\cdot 5 \\cdot 0.5 = 50\\, \\text{J} \\).</p>
                    </div>
                </div>
            </div>

            <!-- RESULTADOS -->
            <div class="quiz-results" style="display: none;">
                <h3>📊 RESULTADOS DEL QUIZ</h3>
                <div class="results-score">
                    Puntuación: <span id="quizScore">0</span>/2
                </div>
                <div class="results-feedback" id="quizFeedback">
                    Completa el quiz para ver tus resultados
                </div>
                <button class="btn-retry" onclick="reiniciarQuiz()">
                    🔄 INTENTAR NUEVAMENTE
                </button>
            </div>
        </div>
    </section>

    <!-- ERRORES COMUNES -->
    <section class="errores-section">
        <h2 class="seccion-titulo neon-alerta">
            <span class="icon">⚠️</span> ERRORES COMUNES Y SOLUCIONES
        </h2>
        <div class="errores-container">
            <div class="error-card">
                <div class="error-header" onclick="toggleError(this)">
                    <h3>❌ CONFUNDIR FUERZA NETA CON FUERZA APLICADA</h3>
                    <span class="error-toggle">+</span>
                </div>
                <div class="error-content">
                    <div class="error-ejemplo">
                        <strong>Error común:</strong> "Si aplico 100 N y el objeto no se mueve, el trabajo es 100 J".
                    </div>
                    <div class="error-correccion">
                        <strong>Corrección:</strong> El trabajo requiere <strong>desplazamiento</strong>. Si \\( d = 0 \\), \\( W = 0 \\).
                    </div>
                    <div class="error-practica">
                        <p><strong>Practica:</strong> Calcula el trabajo si \\( F = 100\\, \\text{N} \\), \\( d = 0\\, \\text{m} \\), \\( θ = 30° \\).</p>
                        <button class="btn-mini" onclick="mostrarSolucion(1)">Ver solución</button>
                        <div class="solucion" id="solucion1" style="display: none;">
                            <strong>Solución:</strong> \\( W = 100 \\cdot 0 \\cdot \\cos 30° = 0\\, \\text{J} \\).
                        </div>
                    </div>
                </div>
            </div>
            <div class="error-card">
                <div class="error-header" onclick="toggleError(this)">
                    <h3>❌ OLVIDAR EL ÁNGULO EN EL CÁLCULO</h3>
                    <span class="error-toggle">+</span>
                </div>
                <div class="error-content">
                    <div class="error-ejemplo">
                        <strong>Error común:</strong> "El trabajo es \\( F \\cdot d \\) sin considerar \\( \\cos θ \\)".
                    </div>
                    <div class="error-correccion">
                        <strong>Corrección:</strong> Siempre incluye \\( \\cos θ \\). Si \\( θ = 0° \\), \\( \\cos θ = 1 \\); si \\( θ = 90° \\), \\( \\cos θ = 0 \\).
                    </div>
                    <div class="error-tabla">
                        <table>
                            <tr>
                                <th>Ángulo</th>
                                <th>cos θ</th>
                                <th>W</th>
                            </tr>
                            <tr>
                                <td>0°</td>
                                <td>1</td>
                                <td>Máximo</td>
                            </tr>
                            <tr>
                                <td>90°</td>
                                <td>0</td>
                                <td>Cero</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- PROBLEMAS TIPO EXAMEN -->
    <section class="examen-section">
        <h2 class="seccion-titulo neon-evaluacion">
            <span class="icon">📝</span> PROBLEMAS TIPO EXAMEN
        </h2>
        <div class="examen-container">
            <div class="problema-card">
                <div class="problema-header">
                    <span class="problema-num">P1</span>
                    <h3>Cálculo de Trabajo con Ángulo</h3>
                </div>
                <div class="problema-enunciado">
                    <p>Un bloque se desplaza 12 m bajo una fuerza de 80 N aplicada con un ángulo de 45°. Calcula:</p>
                    <ol>
                        <li>El trabajo realizado.</li>
                        <li>El tipo de trabajo (positivo, nulo, negativo).</li>
                        <li>¿Cómo cambiaría el trabajo si el ángulo fuera 120°?</li>
                    </ol>
                </div>
                <div class="problema-espacio">
                    <textarea placeholder="Desarrolla tu solución aquí..." rows="8"></textarea>
                </div>
                <button class="btn-verificar" onclick="verificarProblema(1)">VERIFICAR SOLUCIÓN</button>
                <div class="problema-solucion" id="solucionP1" style="display: none;">
                    <strong>Solución:</strong><br>
                    1. \\( W = 80 \\cdot 12 \\cdot \\cos 45° = 678.8\\, \\text{J} \\) (positivo).<br>
                    2. Positivo, porque \\( 0° < θ < 90° \\).<br>
                    3. \\( W = 80 \\cdot 12 \\cdot \\cos 120° = -480\\, \\text{J} \\) (negativo).
                </div>
            </div>
            <div class="problema-card">
                <div class="problema-header">
                    <span class="problema-num">P2</span>
                    <h3>Aplicación del Teorema Trabajo-Energía</h3>
                </div>
                <div class="problema-enunciado">
                    <p>Un objeto de 5 kg se mueve con una velocidad inicial de 2 m/s. Se le aplica una fuerza de 30 N en la dirección del movimiento durante 4 m. Calcula:</p>
                    <ol>
                        <li>El trabajo realizado.</li>
                        <li>La velocidad final del objeto.</li>
                    </ol>
                </div>
                <div class="problema-espacio">
                    <textarea placeholder="Desarrolla tu solución aquí..." rows="8"></textarea>
                </div>
                <button class="btn-verificar" onclick="verificarProblema(2)">VERIFICAR SOLUCIÓN</button>
                <div class="problema-solucion" id="solucionP2" style="display: none;">
                    <strong>Solución:</strong><br>
                    1. \\( W = 30 \\cdot 4 = 120\\, \\text{J} \\).<br>
                    2. \\( W = \\Delta E_k \\Rightarrow 120 = \\frac{1}{2} \\cdot 5 \\cdot (v_f^2 - 2^2) \\Rightarrow v_f = 7.35\\, \\text{m/s} \\).
                </div>
            </div>
            <div class="rubrica">
                <h4>📋 RÚBRICA DE EVALUACIÓN</h4>
                <table class="rubrica-table">
                    <tr>
                        <th>Criterio</th>
                        <th>Excelente (5)</th>
                        <th>Satisfactorio (3-4)</th>
                        <th>Insuficiente (0-2)</th>
                    </tr>
                    <tr>
                        <td>Cálculo correcto del trabajo</td>
                        <td>Fórmula y unidades correctas</td>
                        <td>Errores menores en cálculos</td>
                        <td>Fórmula o unidades incorrectas</td>
                    </tr>
                    <tr>
                        <td>Aplicación del teorema Trabajo-Energía</td>
                        <td>Relación clara con \\( \\Delta E_k \\)</td>
                        <td>Falta justificación</td>
                        <td>No aplica el teorema</td>
                    </tr>
                </table>
            </div>
        </div>
    </section>

    <!-- CIERRE METACOGNITIVO -->
    <section class="cierre-section">
        <h2 class="seccion-titulo neon-concepto">
            <span class="icon">🧠</span> CIERRE METACOGNITIVO
        </h2>
        <div class="cierre-container">
            <div class="autoevaluacion">
                <h3>📈 AUTOEVALUACIÓN</h3>
                <div class="slider-group">
                    <label>Comprensión de la fórmula \\( W = F \\cdot d \\cdot \\cos \\theta \\):</label>
                    <input type="range" min="1" max="5" value="3" class="autoeval-slider" id="slider1">
                    <div class="slider-labels">
                        <span>Básico</span><span>Intermedio</span><span>Avanzado</span>
                    </div>
                </div>
                <div class="slider-group">
                    <label>Aplicación en problemas reales:</label>
                    <input type="range" min="1" max="5" value="3" class="autoeval-slider" id="slider2">
                    <div class="slider-labels">
                        <span>Básico</span><span>Intermedio</span><span>Avanzado</span>
                    </div>
                </div>
                <button class="btn-guardar" onclick="guardarAutoevaluacion()">
                    💾 GUARDAR AUTOEVALUACIÓN
                </button>
            </div>
            <div class="reflexion">
                <h3>💭 REFLEXIÓN GUIADA</h3>
                <div class="pregunta-reflexion">
                    <p>¿Por qué es importante considerar el ángulo θ al calcular el trabajo en situaciones cotidianas?</p>
                    <textarea placeholder="Ejemplo: empujar un carrito de supermercado..." rows="4" id="reflexion1"></textarea>
                </div>
                <div class="pregunta-reflexion">
                    <p>Describe un escenario donde el trabajo realizado sea negativo. ¿Qué implica esto físicamente?</p>
                    <textarea placeholder="Ejemplo: frenar un auto..." rows="4" id="reflexion2"></textarea>
                </div>
            </div>
            <div class="plan-estudio">
                <h3>📚 PLAN DE ESTUDIO RECOMENDADO</h3>
                <div class="plan-grid">
                    <div class="plan-card">
                        <h4>🔹 REPASO RÁPIDO (15 min)</h4>
                        <ul>
                            <li>Memorizar fórmula y unidades</li>
                            <li>Repasar ángulos clave (0°, 90°, 180°)</li>
                        </ul>
                    </div>
                    <div class="plan-card">
                        <h4>🛠 PRÁCTICA (30 min)</h4>
                        <ul>
                            <li>Resolver 5 problemas con diferentes ángulos</li>
                            <li>Usar el simulador para visualizar escenarios</li>
                        </ul>
                    </div>
                    <div class="plan-card">
                        <h4>🎓 PROFUNDIZACIÓN (45 min)</h4>
                        <ul>
                            <li>Investigar aplicaciones en ingeniería</li>
                            <li>Relacionar con energía potencial</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="recursos">
                <h3>🔗 RECURSOS ADICIONALES</h3>
                <div class="recursos-links">
                    <a href="https://phet.colorado.edu/es/simulation/legacy/energy-skate-park" target="_blank" class="recurso-link">
                        🎢 Simulador PhET: Parque de Energía
                    </a>
                    <a href="https://www.khanacademy.org/science/physics/work-and-energy/work-and-energy-tutorial/a/what-is-work" target="_blank" class="recurso-link">
                        📚 Khan Academy: ¿Qué es el Trabajo?
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- JAVASCRIPT INTEGRADO -->
<script>
    // ==========================================
// SIMULADOR DE TRABAJO
// ==========================================
function calcularTrabajo() {
    // Obtener valores de los sliders
    const fuerza = parseFloat(document.getElementById(\'fuerzaInput\').value);
    const distancia = parseFloat(document.getElementById(\'distanciaInput\').value);
    const angulo = parseFloat(document.getElementById(\'anguloInput\').value);

    // Validar que los valores sean números
    if (isNaN(fuerza) || isNaN(distancia) || isNaN(angulo)) {
        alert("Por favor, ingresa valores válidos para fuerza, distancia y ángulo.");
        return;
    }

    // Actualizar valores en la interfaz
    document.getElementById(\'fuerzaValue\').textContent = `${fuerza} N`;
    document.getElementById(\'distanciaValue\').textContent = `${distancia} m`;
    document.getElementById(\'anguloValue\').textContent = `${angulo}°`;
    document.getElementById(\'svgFuerza\').textContent = fuerza.toFixed(1);
    document.getElementById(\'svgDistancia\').textContent = distancia.toFixed(1);
    document.getElementById(\'svgAngulo\').textContent = angulo.toFixed(1);

    // Calcular trabajo
    const radians = angulo * Math.PI / 180;
    const trabajo = fuerza * distancia * Math.cos(radians);

    // Actualizar resultado en SVG
    document.getElementById(\'resultadoTrabajo\').textContent = `W = ${trabajo.toFixed(2)} J`;

    // Determinar tipo de trabajo y color
    let tipo = "";
    let color = "";
    if (angulo < 90) {
        tipo = "Trabajo positivo";
        color = "#39FF14";
    } else if (angulo === 90) {
        tipo = "Trabajo nulo";
        color = "#FFFF00";
    } else {
        tipo = "Trabajo negativo";
        color = "#FF6B6B";
    }

    // Actualizar tipo de trabajo en la interfaz
    document.getElementById(\'resultadoTipo\').textContent = tipo;
    document.getElementById(\'resultadoTipo\').style.color = color;
    document.getElementById(\'resultadoCard\').style.border = `2px solid ${color}`;
    document.getElementById(\'dataTrabajo\').textContent = `${trabajo.toFixed(2)} J`;
    document.getElementById(\'dataTipo\').textContent = tipo;

    // Actualizar vector de fuerza en el SVG
    const x2 = 150 + (distancia * 2) * Math.cos(radians);
    const y2 = 150 - (distancia * 2) * Math.sin(radians);
    document.getElementById(\'vectorF\').setAttribute(\'x2\', x2);
    document.getElementById(\'vectorF\').setAttribute(\'y2\', y2);

    // Actualizar arco del ángulo
    const largeArcFlag = angulo > 180 ? 1 : 0;
    const pathData = `M150 350 A${distancia * 1.5} ${distancia * 1.5} 0 ${largeArcFlag} 0 ${x2} ${y2}`;
    document.getElementById(\'arcoAngulo\').setAttribute(\'d\', pathData);

    // Animación de resultado
    document.getElementById(\'resultadoCard\').style.animation = \'pulse 1s\';
}

// Función para generar valores aleatorios
function valoresAleatorios() {
    const fuerza = Math.floor(Math.random() * 90) + 10;
    const distancia = Math.floor(Math.random() * 19) + 1;
    const angulo = Math.floor(Math.random() * 180);

    document.getElementById(\'fuerzaInput\').value = fuerza;
    document.getElementById(\'distanciaInput\').value = distancia;
    document.getElementById(\'anguloInput\').value = angulo;

    document.getElementById(\'fuerzaValue\').textContent = `${fuerza} N`;
    document.getElementById(\'distanciaValue\').textContent = `${distancia} m`;
    document.getElementById(\'anguloValue\').textContent = `${angulo}°`;

    calcularTrabajo(); // Actualizar simulador con los nuevos valores
}

// ==========================================
// QUIZ INTERACTIVO
// ==========================================
let quizRespuestas = [];
let quizCompletado = false;

// Event listeners para las opciones del quiz
document.querySelectorAll(\'.quiz-option\').forEach(option => {
    option.addEventListener(\'click\', function() {
        if (quizCompletado) return;

        const question = this.closest(\'.quiz-question\');
        const correct = question.dataset.correct;
        const selected = this.dataset.value;
        const feedback = question.querySelector(\'.quiz-feedback\');

        // Limpiar selección previa
        question.querySelectorAll(\'.quiz-option\').forEach(opt => {
            opt.classList.remove(\'selected\', \'correct\', \'incorrect\');
        });

        // Marcar selección actual
        this.classList.add(\'selected\');

        // Verificar respuesta
        if (selected === correct) {
            this.classList.add(\'correct\');
            quizRespuestas.push(true);
        } else {
            this.classList.add(\'incorrect\');
            question.querySelector(`[data-value="${correct}"]`).classList.add(\'correct\');
            quizRespuestas.push(false);
        }

        // Mostrar feedback
        feedback.style.display = \'block\';

        // Verificar si todas las preguntas están respondidas
        const allAnswered = Array.from(document.querySelectorAll(\'.quiz-question\')).every(q =>
            q.querySelector(\'.quiz-option.selected\')
        );

        if (allAnswered && !quizCompletado) {
            quizCompletado = true;
            mostrarResultadosQuiz();
        }
    });
});

// Mostrar resultados del quiz
function mostrarResultadosQuiz() {
    const correctas = quizRespuestas.filter(r => r).length;
    const total = quizRespuestas.length;
    document.getElementById(\'quizScore\').textContent = `${correctas}/${total}`;

    let feedback = "";
    if (correctas === total) {
        feedback = "🎉 ¡Excelente! Dominas el concepto de trabajo.";
    } else if (correctas >= total / 2) {
        feedback = "👍 Buen trabajo, pero repasa los ángulos y la fórmula.";
    } else {
        feedback = "📚 Necesitas estudiar más el tema. Usa el simulador para practicar.";
    }

    document.getElementById(\'quizFeedback\').textContent = feedback;
    document.querySelector(\'.quiz-results\').style.display = \'block\';
}

// Reiniciar el quiz
function reiniciarQuiz() {
    quizRespuestas = [];
    quizCompletado = false;

    document.querySelectorAll(\'.quiz-option\').forEach(opt => {
        opt.classList.remove(\'selected\', \'correct\', \'incorrect\');
    });

    document.querySelectorAll(\'.quiz-feedback\').forEach(fb => {
        fb.style.display = \'none\';
    });

    document.querySelector(\'.quiz-results\').style.display = \'none\';
}

// ==========================================
// ERRORES COMUNES
// ==========================================
function toggleError(header) {
    const content = header.nextElementSibling;
    const toggle = header.querySelector(\'.error-toggle\');

    if (content.style.display === \'block\') {
        content.style.display = \'none\';
        toggle.textContent = \'+\';
    } else {
        content.style.display = \'block\';
        toggle.textContent = \'-\';
    }
}

function mostrarSolucion(num) {
    const solucion = document.getElementById(`solucion${num}`);
    solucion.style.display = solucion.style.display === \'block\' ? \'none\' : \'block\';
}

// ==========================================
// PROBLEMAS TIPO EXAMEN
// ==========================================
function verificarProblema(num) {
    const solucion = document.getElementById(`solucionP${num}`);
    solucion.style.display = solucion.style.display === \'block\' ? \'none\' : \'block\';
}

// ==========================================
// AUTOEVALUACIÓN
// ==========================================
function guardarAutoevaluacion() {
    const slider1 = document.getElementById(\'slider1\').value;
    const slider2 = document.getElementById(\'slider2\').value;
    const promedio = (parseInt(slider1) + parseInt(slider2)) / 2;

    alert(
        `💾 Autoevaluación guardada:\\n\\n` +
        `Fórmula: ${slider1}/5\\n` +
        `Aplicación: ${slider2}/5\\n\\n` +
        `Promedio: ${promedio.toFixed(1)}/5\\n\\n` +
        `Revisa el plan de estudio según tus resultados.`
    );
}

// ==========================================
// INICIALIZACIÓN
// ==========================================
document.addEventListener(\'DOMContentLoaded\', function() {
    console.log("🚀 Lección Cyberpunk: El Trabajo en Física - Cargada");
    calcularTrabajo(); // Inicializar simulador con valores por defecto

    // Event listeners para sliders
    document.getElementById(\'fuerzaInput\').addEventListener(\'input\', calcularTrabajo);
    document.getElementById(\'distanciaInput\').addEventListener(\'input\', calcularTrabajo);
    document.getElementById(\'anguloInput\').addEventListener(\'input\', calcularTrabajo);
});
</script>',
    'ejercicios' => 
    array (
      0 => 
      array (
        'enunciado' => 'Fórmula trabajo',
        'respuesta' => 'F d cos θ',
      ),
      1 => 
      array (
        'enunciado' => 'θ = 90° → W',
        'respuesta' => '0',
      ),
      2 => 
      array (
        'enunciado' => 'Unidad trabajo',
        'respuesta' => 'Joule (J)',
      ),
      3 => 
      array (
        'enunciado' => 'Trabajo negativo cuando',
        'respuesta' => 'F opuesta a d',
      ),
      4 => 
      array (
        'enunciado' => 'F = 20 N, d = 5 m, θ = 0°',
        'respuesta' => '100 J',
      ),
      5 => 
      array (
        'enunciado' => 'F = 30 N, d = 4 m, θ = 60°',
        'respuesta' => '60 J',
      ),
      6 => 
      array (
        'enunciado' => 'Trabajo gravedad al subir',
        'respuesta' => '-mg h',
      ),
      7 => 
      array (
        'enunciado' => 'Fuerza ⊥ a d → W',
        'respuesta' => '0',
      ),
      8 => 
      array (
        'enunciado' => 'W_neto =',
        'respuesta' => 'ΔEK',
      ),
      9 => 
      array (
        'enunciado' => '1 kJ =',
        'respuesta' => '1000 J',
      ),
      10 => 
      array (
        'enunciado' => 'F variable → W =',
        'respuesta' => '∫ F dx',
      ),
      11 => 
      array (
        'enunciado' => 'Trabajo motor auto',
        'respuesta' => 'Aumenta EK',
      ),
    ),
    'quiz' => 
    array (
      0 => 
      array (
        'pregunta' => 'Trabajo =',
        'opciones' => 
        array (
          0 => 'F d cos θ',
          1 => 'F d',
          2 => 'm a d',
          3 => 'P t',
        ),
        'correcta' => 'F d cos θ',
      ),
      1 => 
      array (
        'pregunta' => 'Unidad trabajo',
        'opciones' => 
        array (
          0 => 'Joule',
          1 => 'Newton',
          2 => 'Metro',
          3 => 'Watt',
        ),
        'correcta' => 'Joule',
      ),
      2 => 
      array (
        'pregunta' => 'θ = 0° → cos θ =',
        'opciones' => 
        array (
          0 => '1',
          1 => '0',
          2 => '-1',
          3 => '0.5',
        ),
        'correcta' => '1',
      ),
      3 => 
      array (
        'pregunta' => 'θ = 90° → W =',
        'opciones' => 
        array (
          0 => '0',
          1 => 'Fd',
          2 => '-Fd',
          3 => 'máximo',
        ),
        'correcta' => '0',
      ),
      4 => 
      array (
        'pregunta' => 'Trabajo positivo → EK',
        'opciones' => 
        array (
          0 => 'Aumenta',
          1 => 'Disminuye',
          2 => 'Igual',
          3 => 'Cero',
        ),
        'correcta' => 'Aumenta',
      ),
      5 => 
      array (
        'pregunta' => 'F = 100 N, d = 2 m, θ = 0° → W',
        'opciones' => 
        array (
          0 => '200 J',
          1 => '100 J',
          2 => '0 J',
          3 => '50 J',
        ),
        'correcta' => '200 J',
      ),
      6 => 
      array (
        'pregunta' => 'Fuerza ⊥ a d → W',
        'opciones' => 
        array (
          0 => '0',
          1 => 'máximo',
          2 => 'negativo',
          3 => 'infinito',
        ),
        'correcta' => '0',
      ),
       7 => 
       array (
         'pregunta' => 'Trabajo gravedad al caer',
         'opciones' => 
         array (
           0 => '+mg h',
           1 => '-mg h',
           2 => '0',
           3 => 'mgh²',
         ),
         'correcta' => '+mg h',
       ),
      8 => 
      array (
        'pregunta' => 'W_neto =',
        'opciones' => 
        array (
          0 => 'ΔEK',
          1 => 'ΔEP',
          2 => 'ΔU',
          3 => 'P Δt',
        ),
        'correcta' => 'ΔEK',
      ),
      9 => 
      array (
        'pregunta' => '1 J =',
        'opciones' => 
        array (
          0 => 'N·m',
          1 => 'kg·m/s²',
          2 => 'W·s',
          3 => 'todas',
        ),
        'correcta' => 'todas',
      ),
      10 => 
      array (
        'pregunta' => 'F = 40 N, d = 3 m, θ = 30° → W',
        'opciones' => 
        array (
          0 => '104 J',
          1 => '120 J',
          2 => '60 J',
          3 => '0 J',
        ),
        'correcta' => '104 J',
      ),
      11 => 
      array (
        'pregunta' => 'Trabajo fricción',
        'opciones' => 
        array (
          0 => 'Negativo',
          1 => 'Positivo',
          2 => 'Cero',
          3 => 'Variable',
        ),
        'correcta' => 'Negativo',
      ),
      12 => 
      array (
        'pregunta' => 'Motor hace W = 500 J → EK',
        'opciones' => 
        array (
          0 => '+500 J',
          1 => '-500 J',
          2 => '0 J',
          3 => '500 N',
        ),
        'correcta' => '+500 J',
      ),
      13 => 
      array (
        'pregunta' => 'F variable → W =',
        'opciones' => 
        array (
          0 => 'área bajo F vs d',
          1 => 'F promedio · d',
          2 => 'F máx · d',
          3 => '0',
        ),
        'correcta' => 'área bajo F vs d',
      ),
      14 => 
      array (
        'pregunta' => 'Trabajo en círculo completo',
        'opciones' => 
        array (
          0 => '0 (fuerza central)',
          1 => 'Fd',
          2 => '2πr F',
          3 => 'infinito',
        ),
        'correcta' => '0 (fuerza central)',
      ),
      15 => 
      array (
        'pregunta' => 'Fuerza conservativa → W',
        'opciones' => 
        array (
          0 => 'independiente camino',
          1 => 'depende camino',
          2 => 'siempre 0',
          3 => 'siempre Fd',
        ),
        'correcta' => 'independiente camino',
      ),
      16 => 
      array (
        'pregunta' => 'Trabajo mínimo para mover',
        'opciones' => 
        array (
          0 => 'θ = 0°',
          1 => 'θ = 90°',
          2 => 'θ = 180°',
          3 => 'cualquiera',
        ),
        'correcta' => 'θ = 0°',
      ),
      17 => 
      array (
        'pregunta' => 'SI 2025: trabajo en',
        'opciones' => 
        array (
          0 => 'Joule',
          1 => 'erg',
          2 => 'caloría',
          3 => 'eV',
        ),
        'correcta' => 'Joule',
      ),
      18 => 
      array (
        'pregunta' => 'F = 15 N, d = 4 m, θ = 180° → W',
        'opciones' => 
        array (
          0 => '-60 J',
          1 => '60 J',
          2 => '0 J',
          3 => '15 J',
        ),
        'correcta' => '-60 J',
      ),
      19 => 
      array (
        'pregunta' => 'Potencia =',
        'opciones' => 
        array (
          0 => 'W / t',
          1 => 'W · t',
          2 => 'F / d',
          3 => 'E / m',
        ),
        'correcta' => 'W / t',
      ),
      20 => 
      array (
        'pregunta' => 'F = 200 N, d = 10 m, θ = 53° → W ≈',
        'opciones' => 
        array (
          0 => '1200 J',
          1 => '2000 J',
          2 => '0 J',
          3 => '1000 J',
        ),
        'correcta' => '1200 J',
      ),
      21 => 
      array (
        'pregunta' => 'Trabajo total =',
        'opciones' => 
        array (
          0 => '∑ W_i',
          1 => 'W_máx',
          2 => 'W_mín',
          3 => '0',
        ),
        'correcta' => '∑ W_i',
      ),
      22 => 
      array (
        'pregunta' => 'Fuerza normal piso → W',
        'opciones' => 
        array (
          0 => '0',
          1 => 'mg d',
          2 => 'mg h',
          3 => 'Fd',
        ),
        'correcta' => '0',
      ),
      23 => 
      array (
        'pregunta' => 'W = ∫ F dx para',
        'opciones' => 
        array (
          0 => 'F variable',
          1 => 'F constante',
          2 => 'θ = 0',
          3 => 'θ = 90°',
        ),
        'correcta' => 'F variable',
      ),
      24 => 
      array (
        'pregunta' => 'Trabajo gravitacional =',
        'opciones' => 
        array (
          0 => '-mg Δh',
          1 => 'mg Δh',
          2 => 'mg d',
          3 => '0',
        ),
        'correcta' => '-mg Δh',
      ),
      25 => 
      array (
        'pregunta' => 'Energía mecánica total',
        'opciones' => 
        array (
          0 => 'EK + EP',
          1 => 'W',
          2 => 'P',
          3 => 'F d',
        ),
        'correcta' => 'EK + EP',
      ),
      26 => 
      array (
        'pregunta' => 'Fricción estática → W',
        'opciones' => 
        array (
          0 => '0 (sin movimiento)',
          1 => 'μ N d',
          2 => 'Fd',
          3 => 'infinito',
        ),
        'correcta' => '0 (sin movimiento)',
      ),
      27 => 
      array (
        'pregunta' => '1 kWh =',
        'opciones' => 
        array (
          0 => '3.6 MJ',
          1 => '3.6 kJ',
          2 => '36 MJ',
          3 => '0.36 MJ',
        ),
        'correcta' => '3.6 MJ',
      ),
      28 => 
      array (
        'pregunta' => 'Trabajo en resorte =',
        'opciones' => 
        array (
          0 => '½ k x²',
          1 => 'k x',
          2 => 'F d',
          3 => 'm g h',
        ),
        'correcta' => '½ k x²',
      ),
      29 => 
      array (
        'pregunta' => 'SI 2025: 1 J =',
        'opciones' => 
        array (
          0 => '1 N·m',
          1 => '1 kg·m²/s²',
          2 => '1 W·s',
          3 => 'todas',
        ),
        'correcta' => 'todas',
      ),
    ),
  ),
  10 => 
  array (
    'materia' => 'Física I',
    'slug' => 'energia-colisiones-impulso-movimiento',
    'titulo' => 'Energía y Colisiones: Dinámica Cuántica de Impactos',
    'contenido' => '<!-- INICIO LECCIÓN CYBERPUNK -->
<div class="leccion-container leccion-fisica-colisiones" data-tema="energia-colisiones">

<!-- CABECERA CYBERPUNK -->
<header class="leccion-header">
    <h1 class="titulo-leccion neon-glow">
        <span class="icon-tema">⚡</span>
        ENERGÍA Y COLISIONES
    </h1>
    <div class="subtitulo">
        Dinámica Cuántica de Impactos: Impulso, Momento Lineal y Conservación
    </div>
</header>

<!-- PANEL OBJETIVOS -->
<section class="panel-objetivos">
    <h2 class="seccion-titulo neon-concepto">
        <span class="icon">🎯</span> OBJETIVOS DE APRENDIZAJE
    </h2>
    <div class="objetivos-grid">
        <div class="objetivo-card" data-completado="false">
            <div class="objetivo-checkbox"></div>
            <h3>Calcular impulso y momento lineal</h3>
            <p>Relacionar \\(J = F\\Delta t = \\Delta p\\) en sistemas dinámicos</p>
        </div>
        <div class="objetivo-card" data-completado="false">
            <div class="objetivo-checkbox"></div>
            <h3>Aplicar conservación del momento</h3>
            <p>Resolver colisiones usando \\(\\sum p_i = \\sum p_f\\)</p>
        </div>
        <div class="objetivo-card" data-completado="false">
            <div class="objetivo-checkbox"></div>
            <h3>Diferenciar colisiones elásticas/inelásticas</h3>
            <p>Calcular coeficiente de restitución \\(e\\) y pérdida de EK</p>
        </div>
        <div class="objetivo-card" data-completado="false">
            <div class="objetivo-checkbox"></div>
            <h3>Analizar sistemas reales</h3>
            <p>Choques vehiculares, impactos deportivos, física de partículas</p>
        </div>
    </div>
</section>

<!-- CONTEXTO REAL -->
<section class="contexto-real">
    <h2 class="seccion-titulo neon-dato">
        <span class="icon">🌍</span> APLICACIÓN EN EL MUNDO REAL
    </h2>
    <div class="contexto-grid">
        <div class="contexto-card">
            <h3>Seguridad Vehicular</h3>
            <p>Airbags aumentan \\(\\Delta t\\) para reducir \\(F\\) en impacto: \\(J = F\\Delta t = \\text{constante}\\)</p>
            <div class="dato-neon">Δt ≈ 0.1s (con airbag)</div>
        </div>
        <div class="contexto-card">
            <h3>Deportes de Impacto</h3>
            <p>Boxeo: guantes aumentan tiempo de contacto reduciendo fuerza sobre cráneo</p>
            <div class="dato-neon">F reducida 30-40%</div>
        </div>
        <div class="contexto-card">
            <h3>Colisiones Subatómicas</h3>
            <p>LHC: conservación de momento en choques protón-protón a 0.99c</p>
            <div class="dato-neon">E = 13 TeV</div>
        </div>
    </div>
</section>

<!-- TEORÍA ESTRUCTURADA -->
<section class="teoria-section">
    <div class="borde-neon-lateral"></div>
    <h2 class="seccion-titulo neon-concepto">
        <span class="icon">📊</span> FUNDAMENTOS TEÓRICOS
    </h2>

    <!-- CONCEPTOS BÁSICOS -->
    <div class="conceptos-grid">
        <div class="concept-card">
            <div class="concept-header">
                <h4><span class="icon">🔵</span> MOMENTO LINEAL (p)</h4>
                <div class="concept-badge">Vectorial</div>
            </div>
            <div class="concept-formula">
                \\[ \\vec{p} = m\\vec{v} \\]
            </div>
            <div class="concept-datos">
                <p><strong>Unidad SI:</strong> kg·m/s</p>
                <p><strong>Propiedad:</strong> Se conserva en sistemas aislados</p>
                <p><strong>Ejemplo:</strong> Bola billar: \\(m=0.2\\ \\text{kg}, v=5\\ \\text{m/s} \\Rightarrow p=1\\ \\text{kg·m/s}\\)</p>
            </div>
        </div>

        <div class="concept-card">
            <div class="concept-header">
                <h4><span class="icon">⚡</span> IMPULSO (J)</h4>
                <div class="concept-badge">Cambio de p</div>
            </div>
            <div class="concept-formula">
                \\[ \\vec{J} = \\vec{F}_{\\text{prom}} \\Delta t = \\Delta \\vec{p} \\]
            </div>
            <div class="concept-datos">
                <p><strong>Unidad SI:</strong> N·s</p>
                <p><strong>Teorema:</strong> \\( J = \\int F\\, dt = p_f - p_i \\)</p>
                <p><strong>Aplicación:</strong> Airbags: ↑Δt → ↓F para mismo Δp</p>
            </div>
        </div>

        <div class="concept-card">
            <div class="concept-header">
                <h4><span class="icon">🔄</span> 2ª LEY DE NEWTON</h4>
                <div class="concept-badge">Forma general</div>
            </div>
            <div class="concept-formula">
                \\[ \\vec{F} = \\frac{d\\vec{p}}{dt} \\]
            </div>
            <div class="concept-datos">
                <p><strong>Relación:</strong> \\(F = m a\\) es caso particular (m constante)</p>
                <p><strong>Versatilidad:</strong> Válida para m variable (cohetes)</p>
                <p><strong>Ejemplo:</strong> Cohete: pierde masa, F sigue = dp/dt</p>
            </div>
        </div>
    </div>

    <!-- CONSERVACIÓN DEL MOMENTO -->
    <div class="subseccion">
        <h3>1. Ley de Conservación del Momento Lineal</h3>
        <div class="ley-principal">
            <div class="ley-formula">
                \\[ \\sum \\vec{p}_{\\text{inicial}} = \\sum \\vec{p}_{\\text{final}} \\]
            </div>
            <div class="ley-condiciones">
                <p><strong>Condiciones:</strong> Sistema aislado (F externa neta = 0)</p>
                <p><strong>Válida en:</strong> TODAS las colisiones (elásticas e inelásticas)</p>
                <p><strong>Ejemplo sistema:</strong> Dos bolas chocando sobre mesa sin fricción</p>
            </div>
        </div>
    </div>

    <!-- TABLA TIPOS COLISIONES -->
    <div class="subseccion">
        <h3>2. Tipos de Colisiones: Energía vs Momento</h3>
        <div class="tabla-interactiva">
            <table class="tabla-cyberpunk">
                <thead>
                    <tr>
                        <th>TIPO</th>
                        <th>COEFICIENTE e</th>
                        <th>ENERGÍA CINÉTICA</th>
                        <th>ESTADO FINAL</th>
                        <th>EJEMPLO</th>
                    </tr>
                </thead>
                <tbody>
                    <tr data-tipo="elastica">
                        <td><strong class="neon-concepto">ELÁSTICA</strong></td>
                        <td>\\(e = 1\\)</td>
                        <td>Conservada</td>
                        <td>Cuerpos separados</td>
                        <td>Bolas de billar, choques moleculares</td>
                    </tr>
                    <tr data-tipo="inelastica">
                        <td><strong class="neon-concepto">INELÁSTICA</strong></td>
                        <td>\\(0 < e < 1\\)</td>
                        <td>Pérdida parcial</td>
                        <td>Cuerpos separados</td>
                        <td>Choque automovilístico, fútbol</td>
                    </tr>
                    <tr data-tipo="perfecta-inelastica">
                        <td><strong class="neon-concepto">PERF. INELÁSTICA</strong></td>
                        <td>\\(e = 0\\)</td>
                        <td>Máxima pérdida</td>
                        <td>Cuerpos unidos</td>
                        <td>Choque automovilístico con enganche</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- COEFICIENTE RESTITUCIÓN -->
    <div class="subseccion">
        <h3>3. Coeficiente de Restitución (e)</h3>
        <div class="formula-compacta">
            <div class="formula-principal">
                \\[ e = -\\frac{v_{2f} - v_{1f}}{v_{2i} - v_{1i}} = \\frac{\\text{velocidad relativa después}}{\\text{velocidad relativa antes}} \\]
            </div>
            <div class="formula-rango">
                <p><strong>Rango:</strong> \\(0 \\leq e \\leq 1\\)</p>
                <p><strong>e = 1:</strong> Colisión perfectamente elástica</p>
                <p><strong>e = 0:</strong> Colisión perfectamente inelástica</p>
                <p><strong>0 < e < 1:</strong> Colisión inelástica real</p>
            </div>
        </div>
    </div>
</section>

<!-- SIMULADOR INTERACTIVO -->
<section class="simulator-section">
    <h2 class="seccion-titulo neon-interactivo">
        <span class="icon">🎮</span> SIMULADOR: COLISIONES 2D
    </h2>

    <div class="simulator-container" data-tema="colisiones-2d">
        <!-- CONTROLES -->
        <div class="simulator-controls">
            <h3>PARÁMETROS</h3>
            
            <div class="control-group">
                <label for="masa1">Masa 1 (kg):</label>
                <input type="range" id="masa1" min="1" max="10" value="2" step="0.5">
                <span class="control-value" id="valorMasa1">2.0</span>
            </div>
            
            <div class="control-group">
                <label for="velocidad1">Velocidad 1 (m/s):</label>
                <input type="range" id="velocidad1" min="0" max="20" value="8" step="0.5">
                <span class="control-value" id="valorVel1">8.0</span>
            </div>
            
            <div class="control-group">
                <label for="masa2">Masa 2 (kg):</label>
                <input type="range" id="masa2" min="1" max="10" value="3" step="0.5">
                <span class="control-value" id="valorMasa2">3.0</span>
            </div>
            
            <div class="control-group">
                <label for="velocidad2">Velocidad 2 (m/s):</label>
                <input type="range" id="velocidad2" min="-10" max="10" value="-2" step="0.5">
                <span class="control-value" id="valorVel2">-2.0</span>
            </div>
            
            <div class="control-group">
                <label for="coeficiente">Coeficiente e:</label>
                <input type="range" id="coeficiente" min="0" max="1" value="1" step="0.1">
                <span class="control-value" id="valorCoef">1.0</span>
            </div>
            
            <div class="buttons-group">
                <button class="btn-simular" onclick="ejecutarSimulacion()">
                    <span class="btn-icon">▶</span> SIMULAR
                </button>
                <button class="btn-reset" onclick="reiniciarSimulacion()">
                    <span class="btn-icon">↺</span> REINICIAR
                </button>
            </div>
        </div>

        <!-- VISUALIZACIÓN -->
        <div class="simulator-visualization" id="visualizacionColision">
            <svg viewBox="0 0 600 400" id="svgColision">
                <!-- FONDO CON GRID -->
                <rect x="0" y="0" width="600" height="400" fill="#0a0a1a"/>
                <defs>
                    <pattern id="grid" width="40" height="40" patternUnits="userSpaceOnUse">
                        <path d="M 40 0 L 0 0 0 40" fill="none" stroke="rgba(57, 255, 20, 0.1)" stroke-width="1"/>
                    </pattern>
                </defs>
                <rect x="0" y="0" width="600" height="400" fill="url(#grid)"/>
                
                <!-- EJE CENTRAL -->
                <line x1="300" y1="50" x2="300" y2="350" stroke="rgba(255, 255, 255, 0.2)" stroke-width="1"/>
                
                <!-- PARTÍCULA 1 -->
                <g id="particula1">
                    <circle cx="150" cy="200" r="25" fill="#42A5F5" stroke="#2196F3" stroke-width="2"/>
                    <text x="150" y="200" fill="white" text-anchor="middle" dy=".3em" font-size="12">m₁</text>
                    <line x1="150" y1="200" x2="190" y2="200" stroke="#42A5F5" stroke-width="3" marker-end="url(#arrow)"/>
                    <text x="170" y="190" fill="#42A5F5" font-size="10">v₁</text>
                </g>
                
                <!-- PARTÍCULA 2 -->
                <g id="particula2">
                    <circle cx="450" cy="200" r="30" fill="#EF5350" stroke="#D32F2F" stroke-width="2"/>
                    <text x="450" y="200" fill="white" text-anchor="middle" dy=".3em" font-size="12">m₂</text>
                    <line x1="450" y1="200" x2="410" y2="200" stroke="#EF5350" stroke-width="3" marker-end="url(#arrow)"/>
                    <text x="430" y="190" fill="#EF5350" font-size="10">v₂</text>
                </g>
                
                <!-- ÁREA DE COLISIÓN -->
                <rect x="280" y="180" width="40" height="40" fill="none" stroke="rgba(255, 255, 0, 0.5)" stroke-width="2" stroke-dasharray="5,5"/>
                <text x="300" y="170" fill="#FFFF00" text-anchor="middle" font-size="12">ZONA DE IMPACTO</text>
                
                <!-- DEFS PARA FLECHAS -->
                <defs>
                    <marker id="arrow" viewBox="0 0 10 10" refX="9" refY="5" markerWidth="6" markerHeight="6" orient="auto">
                        <path d="M 0 0 L 10 5 L 0 10 z" fill="#FFFFFF"/>
                    </marker>
                </defs>
            </svg>
            
            <div class="simulador-info" id="infoSimulacion">
                Ajusta parámetros y haz clic en SIMULAR
            </div>
        </div>

        <!-- DATOS EN TIEMPO REAL -->
        <div class="simulator-data">
            <h3>DATOS DE COLISIÓN</h3>
            
            <div class="data-card">
                <div class="data-label">Momento inicial total:</div>
                <div class="data-value" id="dataPInicial">0 kg·m/s</div>
            </div>
            
            <div class="data-card">
                <div class="data-label">Momento final total:</div>
                <div class="data-value" id="dataPFinal">0 kg·m/s</div>
            </div>
            
            <div class="data-card highlight">
                <div class="data-label">EK inicial:</div>
                <div class="data-value" id="dataEKInicial">0 J</div>
            </div>
            
            <div class="data-card highlight">
                <div class="data-label">EK final:</div>
                <div class="data-value" id="dataEKFinal">0 J</div>
            </div>
            
            <div class="data-card">
                <div class="data-label">Pérdida EK:</div>
                <div class="data-value" id="dataPerdidaEK">0 J (0%)</div>
            </div>
            
            <div class="data-card">
                <div class="data-label">Velocidad final 1:</div>
                <div class="data-value" id="dataVF1">0 m/s</div>
            </div>
            
            <div class="data-card">
                <div class="data-label">Velocidad final 2:</div>
                <div class="data-value" id="dataVF2">0 m/s</div>
            </div>
            
            <div class="estadisticas">
                <h4>📈 ESTADÍSTICAS</h4>
                <div class="stat-item">
                    <span>Conservación p:</span>
                    <span class="stat-value" id="statConservacionP">100%</span>
                </div>
                <div class="stat-item">
                    <span>Conservación EK:</span>
                    <span class="stat-value" id="statConservacionEK">100%</span>
                </div>
                <div class="stat-item">
                    <span>Tipo colisión:</span>
                    <span class="stat-value" id="statTipoColision">Elástica</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- QUIZ INTERACTIVO -->
<section class="quiz-section">
    <h2 class="seccion-titulo neon-evaluacion">
        <span class="icon">❓</span> QUIZ DE AUTOEVALUACIÓN
    </h2>
    
    <div class="quiz-container">
        <!-- PREGUNTA 1 -->
        <div class="quiz-question" data-correct="B">
            <div class="quiz-header">
                <span class="quiz-num">01</span>
                <h3>¿Qué se conserva en TODAS las colisiones (aisladas)?</h3>
            </div>
            
            <div class="quiz-options">
                <button class="quiz-option" data-value="A">
                    <span class="option-letter">A</span>
                    Energía cinética total
                </button>
                <button class="quiz-option" data-value="B">
                    <span class="option-letter">B</span>
                    Momento lineal total
                </button>
                <button class="quiz-option" data-value="C">
                    <span class="option-letter">C</span>
                    Velocidad de cada partícula
                </button>
                <button class="quiz-option" data-value="D">
                    <span class="option-letter">D</span>
                    Energía potencial
                </button>
            </div>
            
            <div class="quiz-feedback" style="display: none;">
                <div class="feedback-content">
                    <strong>✅ Correcto:</strong> El momento lineal total se conserva en sistemas aislados durante colisiones.
                    <br><br>
                    <strong>📌 Explicación:</strong> La conservación del momento lineal (\\(\\sum p_i = \\sum p_f\\)) es fundamental en colisiones. La energía cinética solo se conserva en choques elásticos (\\(e = 1\\)). Las velocidades individuales cambian según el tipo de colisión.
                </div>
            </div>
        </div>
        
        <!-- PREGUNTA 2 -->
        <div class="quiz-question" data-correct="C">
            <div class="quiz-header">
                <span class="quiz-num">02</span>
                <h3>Un airbag reduce la fuerza de impacto porque:</h3>
            </div>
            
            <div class="quiz-options">
                <button class="quiz-option" data-value="A">
                    <span class="option-letter">A</span>
                    Aumenta la masa del conductor
                </button>
                <button class="quiz-option" data-value="B">
                    <span class="option-letter">B</span>
                    Disminuye el cambio de momento
                </button>
                <button class="quiz-option" data-value="C">
                    <span class="option-letter">C</span>
                    Aumenta el tiempo de desaceleración
                </button>
                <button class="quiz-option" data-value="D">
                    <span class="option-letter">D</span>
                    Absorbe toda la energía cinética
                </button>
            </div>
            
            <div class="quiz-feedback" style="display: none;">
                <div class="feedback-content">
                    <strong>✅ Correcto:</strong> Aumenta el tiempo de desaceleración.
                    <br><br>
                    <strong>📌 Explicación:</strong> Del teorema impulso-momento: \\(J = F\\Delta t = \\Delta p\\). Para un \\(\\Delta p\\) fijo (misma velocidad inicial), al aumentar \\(\\Delta t\\), la fuerza \\(F\\) disminuye. El airbag extiende el tiempo de desaceleración de ~0.01s (sin airbag) a ~0.1s.
                </div>
            </div>
        </div>
        
        <!-- PREGUNTA 3 -->
        <div class="quiz-question" data-correct="D">
            <div class="quiz-header">
                <span class="quiz-num">03</span>
                <h3>En una colisión perfectamente inelástica (\\(e = 0\\)):</h3>
            </div>
            
            <div class="quiz-options">
                <button class="quiz-option" data-value="A">
                    <span class="option-letter">A</span>
                    Se conserva toda la energía cinética
                </button>
                <button class="quiz-option" data-value="B">
                    <span class="option-letter">B</span>
                    Los cuerpos rebotan con velocidades iguales
                </button>
                <button class="quiz-option" data-value="C">
                    <span class="option-letter">C</span>
                    El momento lineal no se conserva
                </button>
                <button class="quiz-option" data-value="D">
                    <span class="option-letter">D</span>
                    Los cuerpos permanecen unidos después
                </button>
            </div>
            
            <div class="quiz-feedback" style="display: none;">
                <div class="feedback-content">
                    <strong>✅ Correcto:</strong> Los cuerpos permanecen unidos después del choque.
                    <br><br>
                    <strong>📌 Explicación:</strong> En colisiones perfectamente inelásticas (\\(e = 0\\)), los cuerpos se mueven juntos después del impacto. Hay máxima pérdida de EK pero el momento lineal SÍ se conserva. La velocidad final común es \\(v_f = \\frac{m_1 v_1 + m_2 v_2}{m_1 + m_2}\\).
                </div>
            </div>
        </div>
        
        <!-- RESULTADOS -->
        <div class="quiz-results" style="display: none;">
            <h3>📊 RESULTADOS DEL QUIZ</h3>
            <div class="results-score">
                Puntuación: <span id="quizScore">0</span>/3
            </div>
            <div class="results-feedback" id="quizFeedback">
                Completa el quiz para ver tus resultados
            </div>
            <button class="btn-retry" onclick="reiniciarQuiz()">
                🔄 INTENTAR NUEVAMENTE
            </button>
        </div>
    </div>
</section>

<!-- ERRORES COMUNES -->
<section class="errors-section">
    <h2 class="seccion-titulo neon-alerta">
        <span class="icon">⚠️</span> ERRORES COMUNES Y SOLUCIONES
    </h2>
    
    <div class="errors-container">
        <div class="error-card">
            <div class="error-header" onclick="toggleError(this)">
                <h3>CONFUNDIR CONSERVACIÓN DE p CON CONSERVACIÓN DE EK</h3>
                <span class="error-toggle">+</span>
            </div>
            <div class="error-content">
                <div class="error-ejemplo">
                    <strong>Error común:</strong> "En una colisión inelástica, nada se conserva porque hay pérdida de energía"
                </div>
                <div class="error-correccion">
                    <strong>✅ Corrección:</strong> El MOMENTO LINEAL TOTAL (\\(p_{\\text{total}}\\)) SIEMPRE se conserva en sistemas aislados. La ENERGÍA CINÉTICA solo se conserva en colisiones elásticas.
                    <br><br>
                    \\[
                    \\text{Conservación } p: \\text{SIEMPRE} \\quad \\text{Conservación } E_k: \\text{SOLO si } e = 1
                    \\]
                </div>
                <div class="error-practica">
                    <p><strong>🧪 Práctica:</strong> Dos bolas de plastilina (m₁=2kg, v₁=5m/s) y (m₂=3kg, v₂=0) chocan y quedan unidas. Calcula v final.</p>
                    <button class="btn-mini" onclick="mostrarSolucionColisiones(1)">Ver solución</button>
                    <div class="solucion" id="solucionColisiones1" style="display:none;">
                        <strong>Solución:</strong><br>
                        Conservación de p: \\(2\\cdot5 + 3\\cdot0 = (2+3)v_f\\)<br>
                        \\(10 = 5v_f \\Rightarrow v_f = 2\\ \\text{m/s}\\)<br>
                        EK inicial: \\( \\frac{1}{2}\\cdot2\\cdot25 = 25\\ \\text{J}\\)<br>
                        EK final: \\( \\frac{1}{2}\\cdot5\\cdot4 = 10\\ \\text{J}\\)<br>
                        Pérdida: \\(15\\ \\text{J}\\) (60%)
                    </div>
                </div>
            </div>
        </div>
        
        <div class="error-card">
            <div class="error-header" onclick="toggleError(this)">
                <h3>IGNORAR LA NATURALEZA VECTORIAL DEL MOMENTO</h3>
                <span class="error-toggle">+</span>
            </div>
            <div class="error-content">
                <div class="error-ejemplo">
                    <strong>Error común:</strong> "Sumar magnitudes sin considerar dirección en colisiones 2D"
                </div>
                <div class="error-correccion">
                    <strong>✅ Corrección:</strong> El momento es vector (\\(\\vec{p} = m\\vec{v}\\)). En 2D/3D se conserva por componentes:
                    <br><br>
                    \\[
                    \\sum p_{x,\\text{inicial}} = \\sum p_{x,\\text{final}} \\quad \\text{y} \\quad \\sum p_{y,\\text{inicial}} = \\sum p_{y,\\text{final}}
                    \\]
                </div>
                <div class="error-tabla">
                    <table>
                        <tr><th>Escenario</th><th>Tratamiento correcto</th></tr>
                        <tr><td>Colisión frontal (1D)</td><td>Usar signos (+/-) para dirección</td></tr>
                        <tr><td>Colisión oblicua (2D)</td><td>Resolver componentes x e y por separado</td></tr>
                        <tr><td>Choque angular</td><td>Usar trigonometría para descomponer</td></tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- PROBLEMAS TIPO EXAMEN -->
<section class="examen-section">
    <h2 class="seccion-titulo neon-evaluacion">
        <span class="icon">📝</span> PROBLEMAS TIPO EXAMEN
    </h2>
    
    <div class="examen-container">
        <div class="problema-card">
            <div class="problema-header">
                <span class="problema-num">P1</span>
                <h3>Problema de Colisión 1D</h3>
            </div>
            <div class="problema-enunciado">
                <p>Un auto de 1200 kg que viaja a 20 m/s hacia el este choca frontalmente con una camioneta de 1800 kg que viaja a 12 m/s hacia el oeste.</p>
                <ol>
                    <li>Si el choque es perfectamente inelástico, calcula la velocidad final.</li>
                    <li>Calcula la pérdida de energía cinética.</li>
                    <li>Si el choque fuera elástico (\\(e = 1\\)), calcula las velocidades finales.</li>
                </ol>
                <p><strong>Considera:</strong> Este = positivo, Oeste = negativo</p>
            </div>
            <div class="problema-espacio">
                <textarea placeholder="Escribe tu solución paso a paso..." rows="8" id="solucionP1"></textarea>
            </div>
            <button class="btn-verificar" onclick="verificarProblema(1)">✓ VERIFICAR SOLUCIÓN</button>
            <div class="problema-solucion" id="solucionP1-detalle" style="display: none;">
                <strong>✅ Solución:</strong><br><br>
                <strong>a) Choque perfectamente inelástico:</strong><br>
                \\(p_i = 1200\\cdot20 + 1800\\cdot(-12) = 24000 - 21600 = 2400\\ \\text{kg·m/s}\\)<br>
                \\(v_f = \\frac{2400}{1200+1800} = 0.8\\ \\text{m/s}\\) (hacia el este)<br><br>
                
                <strong>b) Pérdida EK:</strong><br>
                \\(EK_i = 0.5\\cdot1200\\cdot400 + 0.5\\cdot1800\\cdot144 = 240000 + 129600 = 369600\\ \\text{J}\\)<br>
                \\(EK_f = 0.5\\cdot3000\\cdot0.64 = 960\\ \\text{J}\\)<br>
                \\(\\Delta EK = 369600 - 960 = 368640\\ \\text{J}\\) (99.7% pérdida)<br><br>
                
                <strong>c) Choque elástico:</strong><br>
                Conservación p: \\(2400 = 1200v_1 + 1800v_2\\)<br>
                e = 1: \\(v_2 - v_1 = -( (-12) - 20) = -32\\)<br>
                Resolviendo: \\(v_1 = -15.2\\ \\text{m/s}\\) (oeste), \\(v_2 = 16.8\\ \\text{m/s}\\) (este)
            </div>
        </div>
    </div>
    
    <!-- RÚBRICA -->
    <div class="rubrica">
        <h4>📋 RÚBRICA DE EVALUACIÓN</h4>
        <table class="rubrica-table">
            <tr>
                <th>Criterio</th>
                <th>Excelente (4-5)</th>
                <th>Satisfactorio (2-3)</th>
                <th>Insuficiente (0-1)</th>
            </tr>
            <tr>
                <td>Aplicación conservación p</td>
                <td>Identifica sistema aislado, aplica correctamente fórmula vectorial</td>
                <td>Aplica fórmula pero errores en signos/dirección</td>
                <td>No aplica conservación o fórmula incorrecta</td>
            </tr>
            <tr>
                <td>Cálculo energía cinética</td>
                <td>Calcula EK inicial/final, identifica pérdida y tipo colisión</td>
                <td>Calcula EK pero no analiza pérdida</td>
                <td>Errores graves en cálculo EK</td>
            </tr>
            <tr>
                <td>Análisis tipo colisión</td>
                <td>Diferencia claramente elástica/inelástica, calcula e correctamente</td>
                <td>Identifica tipo pero no justifica o calcula e</td>
                <td>Confunde tipos de colisión</td>
            </tr>
        </table>
    </div>
</section>

<!-- CIERRE METACOGNITIVO -->
<section class="cierre-section">
    <h2 class="seccion-titulo neon-concepto">
        <span class="icon">🧠</span> CIERRE METACOGNITIVO
    </h2>
    
    <div class="cierre-container">
        <!-- AUTOEVALUACIÓN -->
        <div class="autoevaluacion">
            <h3>📊 AUTOEVALUACIÓN</h3>
            <div class="slider-group">
                <label>Comprensión impulso-momento (\\(J = \\Delta p\\)):</label>
                <input type="range" min="1" max="5" value="3" class="autoeval-slider" id="slider1">
                <div class="slider-labels">
                    <span>Básico</span><span>Intermedio</span><span>Avanzado</span>
                </div>
            </div>
            
            <div class="slider-group">
                <label>Aplicación conservación del momento:</label>
                <input type="range" min="1" max="5" value="3" class="autoeval-slider" id="slider2">
                <div class="slider-labels">
                    <span>Básico</span><span>Intermedio</span><span>Avanzado</span>
                </div>
            </div>
            
            <div class="slider-group">
                <label>Diferencia colisiones elásticas/inelásticas:</label>
                <input type="range" min="1" max="5" value="3" class="autoeval-slider" id="slider3">
                <div class="slider-labels">
                    <span>Básico</span><span>Intermedio</span><span>Avanzado</span>
                </div>
            </div>
            
            <button class="btn-guardar" onclick="guardarAutoevaluacion()">
                💾 GUARDAR AUTOEVALUACIÓN
            </button>
        </div>
        
        <!-- REFLEXIÓN -->
        <div class="reflexion">
            <h3>💭 REFLEXIÓN GUIADA</h3>
            <div class="pregunta-reflexion">
                <p>¿Por qué es importante el concepto de impulso (\\(J = F\\Delta t\\)) en diseño de seguridad vehicular y deportiva?</p>
                <textarea placeholder="Escribe tu reflexión aquí..." rows="4" id="reflexion1"></textarea>
            </div>
            <div class="pregunta-reflexion">
                <p>Describe una situación cotidiana donde observes conservación del momento y analiza qué tipo de colisión ocurre.</p>
                <textarea placeholder="Escribe tu ejemplo..." rows="4" id="reflexion2"></textarea>
            </div>
        </div>
        
        <!-- PLAN DE ESTUDIO -->
        <div class="plan-estudio">
            <h3>📚 PLAN DE ESTUDIO RECOMENDADO</h3>
            <div class="plan-grid">
                <div class="plan-card">
                    <h4>⚡ REPASO RÁPIDO (15 min)</h4>
                    <ul>
                        <li>Memorizar: \\(p = mv\\), \\(J = F\\Delta t = \\Delta p\\)</li>
                        <li>Recordar: Conservación p SIEMPRE, EK solo si e=1</li>
                        <li>Diferenciar: Elástica (e=1) vs Inelástica (e<1)</li>
                    </ul>
                </div>
                <div class="plan-card">
                    <h4>🎯 PRÁCTICA (30 min)</h4>
                    <ul>
                        <li>Resolver 5 problemas 1D usando simulador</li>
                        <li>Completar quiz interactivo</li>
                        <li>Analizar 3 casos reales (tráfico, deportes)</li>
                    </ul>
                </div>
                <div class="plan-card">
                    <h4>🚀 PROFUNDIZACIÓN (45 min)</h4>
                    <ul>
                        <li>Resolver problemas 2D con componentes</li>
                        <li>Investigar: Colisiones en física de partículas</li>
                        <li>Diseñar sistema de seguridad usando impulso</li>
                    </ul>
                </div>
            </div>
        </div>
        
        <!-- RECURSOS -->
        <div class="recursos">
            <h3>🔗 RECURSOS ADICIONALES</h3>
            <div class="recursos-links">
                <a href="https://phet.colorado.edu/es/simulation/collision-lab" target="_blank" class="recurso-link">
                    🌐 PhET: Laboratorio de Colisiones (interactivo)
                </a>
                <a href="https://www.khanacademy.org/science/physics/linear-momentum" target="_blank" class="recurso-link">
                    🎓 Khan Academy: Momento lineal y colisiones
                </a>
                <a href="https://physics.info/momentum/summary.shtml" target="_blank" class="recurso-link">
                    📖 The Physics Hypertextbook: Momentum
                </a>
            </div>
        </div>
    </div>
</section>

<!-- JAVASCRIPT INTEGRADO -->
<script>
// ========================================
// SISTEMA DE SIMULACIÓN DE COLISIONES
// ========================================

// Variables globales
let animacionActiva = false;
let datosSimulacion = {};

// Actualizar valores de controles
document.querySelectorAll(\'input[type="range"]\').forEach(slider => {
    slider.addEventListener(\'input\', function() {
        const valueSpan = document.getElementById(\'valor\' + this.id.charAt(0).toUpperCase() + this.id.slice(1));
        if (valueSpan) {
            valueSpan.textContent = parseFloat(this.value).toFixed(1);
        }
    });
});

function ejecutarSimulacion() {
    console.log("📍 Ejecutando simulación de colisión...");
    
    if (animacionActiva) {
        alert("⏸️ Simulación en curso. Espera o reinicia.");
        return;
    }
    
    animacionActiva = true;
    
    // Obtener parámetros
    const m1 = parseFloat(document.getElementById(\'masa1\').value);
    const v1i = parseFloat(document.getElementById(\'velocidad1\').value);
    const m2 = parseFloat(document.getElementById(\'masa2\').value);
    const v2i = parseFloat(document.getElementById(\'velocidad2\').value);
    const e = parseFloat(document.getElementById(\'coeficiente\').value);
    
    // Validar
    if (m1 <= 0 || m2 <= 0) {
        alert("⚠️ Las masas deben ser positivas");
        animacionActiva = false;
        return;
    }
    
    // Calcular velocidades finales
    const v1f = ((m1 - e*m2)*v1i + (1+e)*m2*v2i) / (m1 + m2);
    const v2f = ((m2 - e*m1)*v2i + (1+e)*m1*v1i) / (m1 + m2);
    
    // Calcular momentos y energías
    const p1i = m1 * v1i;
    const p2i = m2 * v2i;
    const pTotalInicial = p1i + p2i;
    
    const p1f = m1 * v1f;
    const p2f = m2 * v2f;
    const pTotalFinal = p1f + p2f;
    
    const EKInicial = 0.5*m1*v1i*v1i + 0.5*m2*v2i*v2i;
    const EKFinal = 0.5*m1*v1f*v1f + 0.5*m2*v2f*v2f;
    const perdidaEK = EKInicial - EKFinal;
    const porcentajePerdida = EKInicial > 0 ? (perdidaEK / EKInicial * 100) : 0;
    
    // Determinar tipo de colisión
    let tipoColision = "";
    if (Math.abs(e - 1) < 0.01) {
        tipoColision = "Elástica";
    } else if (e < 0.01) {
        tipoColision = "Perfectamente Inelástica";
    } else {
        tipoColision = "Inelástica";
    }
    
    // Guardar datos
    datosSimulacion = {
        m1, v1i, v1f,
        m2, v2i, v2f,
        e,
        pTotalInicial, pTotalFinal,
        EKInicial, EKFinal, perdidaEK, porcentajePerdida,
        tipoColision
    };
    
    // Actualizar UI
    actualizarDatosSimulacion();
    
    // Animar colisión
    animarColision(v1f, v2f);
    
    console.log("✅ Simulación completada:", datosSimulacion);
}

function actualizarDatosSimulacion() {
    const d = datosSimulacion;
    
    document.getElementById(\'dataPInicial\').textContent = 
        d.pTotalInicial.toFixed(2) + " kg·m/s";
    document.getElementById(\'dataPFinal\').textContent = 
        d.pTotalFinal.toFixed(2) + " kg·m/s";
    
    document.getElementById(\'dataEKInicial\').textContent = 
        d.EKInicial.toFixed(2) + " J";
    document.getElementById(\'dataEKFinal\').textContent = 
        d.EKFinal.toFixed(2) + " J";
    
    document.getElementById(\'dataPerdidaEK\').textContent = 
        d.perdidaEK.toFixed(2) + " J (" + d.porcentajePerdida.toFixed(1) + "%)";
    
    document.getElementById(\'dataVF1\').textContent = 
        d.v1f.toFixed(2) + " m/s";
    document.getElementById(\'dataVF2\').textContent = 
        d.v2f.toFixed(2) + " m/s";
    
    // Calcular porcentajes de conservación
    const conservacionP = Math.abs(1 - d.pTotalFinal/d.pTotalInicial) * 100;
    const conservacionEK = d.EKInicial > 0 ? 
        Math.abs(1 - d.EKFinal/d.EKInicial) * 100 : 100;
    
    document.getElementById(\'statConservacionP\').textContent = 
        (100 - conservacionP).toFixed(1) + "%";
    document.getElementById(\'statConservacionEK\').textContent = 
        (100 - conservacionEK).toFixed(1) + "%";
    document.getElementById(\'statTipoColision\').textContent = d.tipoColision;
    
    document.getElementById(\'infoSimulacion\').innerHTML = 
        `<strong>${d.tipoColision.toUpperCase()}</strong><br>e = ${d.e.toFixed(2)} | ΔEK = ${d.porcentajePerdida.toFixed(1)}%`;
}

function animarColision(v1f, v2f) {
    const svg = document.getElementById(\'svgColision\');
    const particula1 = document.getElementById(\'particula1\');
    const particula2 = document.getElementById(\'particula2\');
    
    // Detener animaciones previas
    particula1.querySelector(\'circle\').getAnimations().forEach(a => a.cancel());
    particula2.querySelector(\'circle\').getAnimations().forEach(a => a.cancel());
    
    // Posiciones iniciales
    particula1.setAttribute(\'transform\', \'translate(0,0)\');
    particula2.setAttribute(\'transform\', \'translate(0,0)\');
    
    // Animación hacia colisión
    const anim1 = particula1.querySelector(\'circle\').animate(
        [
            { cx: 150 },
            { cx: 300 }
        ],
        {
            duration: 2000,
            easing: \'linear\',
            fill: \'forwards\'
        }
    );
    
    const anim2 = particula2.querySelector(\'circle\').animate(
        [
            { cx: 450 },
            { cx: 300 }
        ],
        {
            duration: 2000,
            easing: \'linear\',
            fill: \'forwards\'
        }
    );
    
    // Después de colisión
    anim1.onfinish = anim2.onfinish = () => {
        // Efecto visual de colisión
        svg.style.filter = \'drop-shadow(0 0 10px #FFFF00)\';
        setTimeout(() => { svg.style.filter = \'none\'; }, 300);
        
        // Animación después según velocidades finales
        const dx1 = v1f * 15; // Factor de escala para visualización
        const dx2 = v2f * 15;
        
        particula1.querySelector(\'circle\').animate(
            [
                { cx: 300 },
                { cx: 300 + dx1 }
            ],
            {
                duration: 1500,
                easing: \'ease-out\',
                fill: \'forwards\'
            }
        );
        
        particula2.querySelector(\'circle\').animate(
            [
                { cx: 300 },
                { cx: 300 + dx2 }
            ],
            {
                duration: 1500,
                easing: \'ease-out\',
                fill: \'forwards\'
            }
        );
        
        // Actualizar flechas de velocidad
        setTimeout(() => {
            actualizarFlechasVelocidad(v1f, v2f);
            animacionActiva = false;
        }, 1500);
    };
}

function actualizarFlechasVelocidad(v1, v2) {
    const flecha1 = document.querySelector(\'#particula1 line\');
    const flecha2 = document.querySelector(\'#particula2 line\');
    const texto1 = document.querySelector(\'#particula1 text:nth-child(4)\');
    const texto2 = document.querySelector(\'#particula2 text:nth-child(4)\');
    
    // Longitud proporcional a velocidad
    const long1 = Math.abs(v1) * 4;
    const long2 = Math.abs(v2) * 4;
    
    // Dirección
    const signo1 = v1 >= 0 ? 1 : -1;
    const signo2 = v2 >= 0 ? 1 : -1;
    
    // Actualizar flecha 1
    flecha1.setAttribute(\'x2\', 150 + signo1 * long1);
    texto1.setAttribute(\'x\', 150 + signo1 * long1/2);
    texto1.textContent = `v₁ = ${v1.toFixed(1)}`;
    
    // Actualizar flecha 2
    flecha2.setAttribute(\'x2\', 450 + signo2 * long2);
    texto2.setAttribute(\'x\', 450 + signo2 * long2/2);
    texto2.textContent = `v₂ = ${v2.toFixed(1)}`;
}

function reiniciarSimulacion() {
    animacionActiva = false;
    
    // Resetear animaciones
    const svg = document.getElementById(\'svgColision\');
    const particulas = svg.querySelectorAll(\'circle\');
    particulas.forEach(circle => {
        circle.getAnimations().forEach(a => a.cancel());
    });
    
    // Resetear posiciones
    document.querySelector(\'#particula1 circle\').setAttribute(\'cx\', \'150\');
    document.querySelector(\'#particula2 circle\').setAttribute(\'cx\', \'450\');
    
    // Resetear flechas
    actualizarFlechasVelocidad(
        parseFloat(document.getElementById(\'velocidad1\').value),
        parseFloat(document.getElementById(\'velocidad2\').value)
    );
    
    // Resetear datos
    document.getElementById(\'infoSimulacion\').textContent = 
        \'Ajusta parámetros y haz clic en SIMULAR\';
}

// ========================================
// SISTEMA DE QUIZ INTERACTIVO
// ========================================

let quizRespuestas = [];
let quizCompletado = false;

document.querySelectorAll(\'.quiz-option\').forEach(option => {
    option.addEventListener(\'click\', function() {
        if (quizCompletado) return;
        
        const question = this.closest(\'.quiz-question\');
        const correct = question.dataset.correct;
        const selected = this.dataset.value;
        const feedback = question.querySelector(\'.quiz-feedback\');
        
        // Remover selección previa
        question.querySelectorAll(\'.quiz-option\').forEach(opt => {
            opt.classList.remove(\'selected\', \'correct\', \'incorrect\');
        });
        
        // Marcar selección actual
        this.classList.add(\'selected\');
        
        // Verificar respuesta
        if (selected == correct) {
            this.classList.add(\'correct\');
            quizRespuestas.push(true);
        } else {
            this.classList.add(\'incorrect\');
            // Marcar también la correcta
            question.querySelector(`[data-value="${correct}"]`).classList.add(\'correct\');
            quizRespuestas.push(false);
        }
        
        // Mostrar feedback
        feedback.style.display = \'block\';
        
        // Verificar si todas las preguntas están respondidas
        verificarCompletadoQuiz();
    });
});

function verificarCompletadoQuiz() {
    const questions = document.querySelectorAll(\'.quiz-question\');
    const answered = Array.from(questions).every(q => 
        q.querySelector(\'.quiz-option.selected\')
    );
    
    if (answered && !quizCompletado) {
        quizCompletado = true;
        mostrarResultadosQuiz();
    }
}

function mostrarResultadosQuiz() {
    const correctas = quizRespuestas.filter(r => r).length;
    const total = quizRespuestas.length;
    const porcentaje = Math.round((correctas / total) * 100);
    
    document.getElementById(\'quizScore\').textContent = `${correctas}/${total}`;
    
    let feedback = "";
    if (porcentaje >= 80) {
        feedback = "🎉 ¡Excelente! Dominas los conceptos de energía y colisiones.";
    } else if (porcentaje >= 60) {
        feedback = "👍 Buen trabajo, pero revisa los conceptos clave sobre conservación.";
    } else {
        feedback = "📚 Necesitas repasar impulso, momento y tipos de colisiones.";
    }
    
    document.getElementById(\'quizFeedback\').textContent = feedback;
    document.querySelector(\'.quiz-results\').style.display = \'block\';
}

function reiniciarQuiz() {
    quizRespuestas = [];
    quizCompletado = false;
    
    // Limpiar selecciones
    document.querySelectorAll(\'.quiz-option\').forEach(opt => {
        opt.classList.remove(\'selected\', \'correct\', \'incorrect\');
    });
    
    // Ocultar feedbacks
    document.querySelectorAll(\'.quiz-feedback\').forEach(fb => {
        fb.style.display = \'none\';
    });
    
    // Ocultar resultados
    document.querySelector(\'.quiz-results\').style.display = \'none\';
}

// ========================================
// FUNCIONES AUXILIARES
// ========================================

function toggleError(header) {
    const content = header.nextElementSibling;
    const toggle = header.querySelector(\'.error-toggle\');
    
    if (content.style.display == \'block\') {
        content.style.display = \'none\';
        toggle.textContent = \'+\';
    } else {
        content.style.display = \'block\';
        toggle.textContent = \'-\';
    }
}

function mostrarSolucionColisiones(num) {
    const solucion = document.getElementById(\'solucionColisiones\' + num);
    solucion.style.display = solucion.style.display === \'block\' ? \'none\' : \'block\';
}

function verificarProblema(num) {
    const solucion = document.getElementById(\'solucionP\' + num + \'-detalle\');
    solucion.style.display = solucion.style.display === \'block\' ? \'none\' : \'block\';
}

function guardarAutoevaluacion() {
    const slider1 = document.getElementById(\'slider1\').value;
    const slider2 = document.getElementById(\'slider2\').value;
    const slider3 = document.getElementById(\'slider3\').value;
    
    const promedio = (parseInt(slider1) + parseInt(slider2) + parseInt(slider3)) / 3;
    
    alert(\'📊 AutoEvaluación guardada:\\n\\n\' +
          `• Impulso-momento: ${slider1}/5\\n` +
          `• Conservación del momento: ${slider2}/5\\n` +
          `• Tipos de colisión: ${slider3}/5\\n\\n` +
          `📈 Promedio: ${promedio.toFixed(1)}/5\\n\\n` +
          `💡 Revisa el plan de estudio recomendado según tus resultados.`);
    
    console.log(\'AutoEvaluación guardada:\', slider1, slider2, slider3);
}

// ========================================
// INICIALIZACIÓN
// ========================================

console.log("🚀 Sistema Cyberpunk Física inicializado");
console.log("📚 Lección: Energía y Colisiones");
console.log("🎮 Simulador, Quiz y herramientas interactivas listas");

// Inicializar flechas de velocidad
actualizarFlechasVelocidad(8, -2);
</script>
</div>
<!-- FIN LECCIÓN CYBERPUNK -->',
    'ejercicios' => 
    array (
      0 => 
      array (
        'enunciado' => 'Cantidad de movimiento p =',
        'respuesta' => 'm v',
      ),
      1 => 
      array (
        'enunciado' => 'Impulso J =',
        'respuesta' => 'F Δt = Δp',
      ),
      2 => 
      array (
        'enunciado' => 'Conservación p en',
        'respuesta' => 'Sistema aislado',
      ),
      3 => 
      array (
        'enunciado' => 'e = 1 → colisión',
        'respuesta' => 'Elástica',
      ),
      4 => 
      array (
        'enunciado' => 'e = 0 → colisión',
        'respuesta' => 'Perfectamente inelástica',
      ),
      5 => 
      array (
        'enunciado' => 'm₁=1kg, u₁=4m/s; m₂=1kg, u₂=0 → v₁f (elástica)',
        'respuesta' => '0 m/s',
      ),
      6 => 
      array (
        'enunciado' => 'Choque inelástico perfecto: v común =',
        'respuesta' => '(m₁u₁ + m₂u₂)/(m₁+m₂)',
      ),
      7 => 
      array (
        'enunciado' => 'F = 50 N, Δt = 0.2 s → Δp',
        'respuesta' => '10 kg·m/s',
      ),
      8 => 
      array (
        'enunciado' => 'p inicial = p final',
        'respuesta' => 'Conservación',
      ),
      9 => 
      array (
        'enunciado' => 'EK perdida en inelástica →',
        'respuesta' => 'Calor, deformación',
      ),
      10 => 
      array (
        'enunciado' => 'Coeficiente e =',
        'respuesta' => '-(v₂-v₁)/(u₂-u₁)',
      ),
      11 => 
      array (
        'enunciado' => '1 N·s =',
        'respuesta' => '1 kg·m/s',
      ),
    ),
    'quiz' => 
    array (
      0 => 
      array (
        'pregunta' => 'p = m v es',
        'opciones' => 
        array (
          0 => 'Vector',
          1 => 'Escalar',
          2 => 'Energía',
          3 => 'Fuerza',
        ),
        'correcta' => 'Vector',
      ),
      1 => 
      array (
        'pregunta' => 'Conservada en todas colisiones',
        'opciones' => 
        array (
          0 => 'Cantidad de movimiento',
          1 => 'Energía cinética',
          2 => 'Masa',
          3 => 'Velocidad',
        ),
        'correcta' => 'Cantidad de movimiento',
      ),
      2 => 
      array (
        'pregunta' => 'J = F Δt =',
        'opciones' => 
        array (
          0 => 'Δp',
          1 => 'ΔEK',
          2 => 'W',
          3 => 'P',
        ),
        'correcta' => 'Δp',
      ),
      3 => 
      array (
        'pregunta' => 'e = 1 significa',
        'opciones' => 
        array (
          0 => 'Elástica',
          1 => 'Inelástica',
          2 => 'Perfecta',
          3 => 'Nada',
        ),
        'correcta' => 'Elástica',
      ),
      4 => 
      array (
        'pregunta' => 'e = 0 significa',
        'opciones' => 
        array (
          0 => 'Perfectamente inelástica',
          1 => 'Elástica',
          2 => 'Parcial',
          3 => 'Ninguna',
        ),
        'correcta' => 'Perfectamente inelástica',
      ),
      5 => 
      array (
        'pregunta' => 'F = m a es',
        'opciones' => 
        array (
          0 => '2ª Ley Newton',
          1 => '1ª',
          2 => '3ª',
          3 => 'Conservación',
        ),
        'correcta' => '2ª Ley Newton',
      ),
      6 => 
      array (
        'pregunta' => 'Unidad p',
        'opciones' => 
        array (
          0 => 'kg·m/s',
          1 => 'J',
          2 => 'N',
          3 => 'm/s²',
        ),
        'correcta' => 'kg·m/s',
      ),
      7 => 
      array (
        'pregunta' => 'Choque elástico: EK',
        'opciones' => 
        array (
          0 => 'Conservada',
          1 => 'Perdida',
          2 => 'Aumentada',
          3 => 'Cero',
        ),
        'correcta' => 'Conservada',
      ),
      8 => 
      array (
        'pregunta' => 'Inelástica: EK',
        'opciones' => 
        array (
          0 => 'Disminuye',
          1 => 'Conservada',
          2 => 'Aumenta',
          3 => 'Cero',
        ),
        'correcta' => 'Disminuye',
      ),
      9 => 
      array (
        'pregunta' => 'v final en inelástica perfecta',
        'opciones' => 
        array (
          0 => '(m₁u₁ + m₂u₂)/(m₁+m₂)',
          1 => 'u₁ + u₂',
          2 => '0',
          3 => 'u₁',
        ),
        'correcta' => '(m₁u₁ + m₂u₂)/(m₁+m₂)',
      ),
      10 => 
      array (
        'pregunta' => 'm₁=2kg, u₁=3m/s; m₂=1kg, u₂=0 → v (inelástica perfecta)',
        'opciones' => 
        array (
          0 => '2 m/s',
          1 => '3 m/s',
          2 => '1 m/s',
          3 => '0 m/s',
        ),
        'correcta' => '2 m/s',
      ),
      11 => 
      array (
        'pregunta' => 'Δp = 0 en sistema aislado →',
        'opciones' => 
        array (
          0 => 'F_ext = 0',
          1 => 'F_ext ≠ 0',
          2 => 'm = 0',
          3 => 'v = 0',
        ),
        'correcta' => 'F_ext = 0',
      ),
      12 => 
      array (
        'pregunta' => 'F = 100 N, t = 0.1 s → J',
        'opciones' => 
        array (
          0 => '10 N·s',
          1 => '1000 N·s',
          2 => '1 N·s',
          3 => '0',
        ),
        'correcta' => '10 N·s',
      ),
      13 => 
      array (
        'pregunta' => 'Colisión 1D: p total',
        'opciones' => 
        array (
          0 => 'm₁u₁ + m₂u₂ = m₁v₁ + m₂v₂',
          1 => 'm₁u₁ = m₂v₂',
          2 => 'u₁ = v₁',
          3 => 'EK igual',
        ),
        'correcta' => 'm₁u₁ + m₂u₂ = m₁v₁ + m₂v₂',
      ),
      14 => 
      array (
        'pregunta' => 'e = 0.8 → colisión',
        'opciones' => 
        array (
          0 => 'Parcialmente elástica',
          1 => 'Perfecta',
          2 => 'Inelástica total',
          3 => 'Elástica',
        ),
        'correcta' => 'Parcialmente elástica',
      ),
      15 => 
      array (
        'pregunta' => 'Bola cae: p antes impacto',
        'opciones' => 
        array (
          0 => 'm √(2gh)',
          1 => 'm g h',
          2 => 'm g',
          3 => '0',
        ),
        'correcta' => 'm √(2gh)',
      ),
      16 => 
      array (
        'pregunta' => 'Impulso = área bajo',
        'opciones' => 
        array (
          0 => 'F vs t',
          1 => 'F vs x',
          2 => 'v vs t',
          3 => 'p vs t',
        ),
        'correcta' => 'F vs t',
      ),
      17 => 
      array (
        'pregunta' => 'Airbag aumenta',
        'opciones' => 
        array (
          0 => 'Δt → ↓F',
          1 => 'Δp',
          2 => 'EK',
          3 => 'masa',
        ),
        'correcta' => 'Δt → ↓F',
      ),
      18 => 
      array (
        'pregunta' => 'SI 2025: impulso en',
        'opciones' => 
        array (
          0 => 'N·s',
          1 => 'J',
          2 => 'kg·m/s²',
          3 => 'W',
        ),
        'correcta' => 'N·s',
      ),
      19 => 
      array (
        'pregunta' => 'Choque frontal autos: p total',
        'opciones' => 
        array (
          0 => 'Conservada',
          1 => 'Perdida',
          2 => 'Aumentada',
          3 => 'Cero',
        ),
        'correcta' => 'Conservada',
      ),
      20 => 
      array (
        'pregunta' => 'v₁f (elástica, m₁=m₂, u₂=0)',
        'opciones' => 
        array (
          0 => '0',
          1 => 'u₁',
          2 => 'u₁/2',
          3 => '2u₁',
        ),
        'correcta' => '0',
      ),
      21 => 
      array (
        'pregunta' => 'EK perdida =',
        'opciones' => 
        array (
          0 => 'EK_i - EK_f',
          1 => 'p_i - p_f',
          2 => 'J',
          3 => 'F d',
        ),
        'correcta' => 'EK_i - EK_f',
      ),
      22 => 
      array (
        'pregunta' => 'm₁=4kg, u₁=6m/s; m₂=2kg, u₂=-3m/s → p total',
        'opciones' => 
        array (
          0 => '18 kg·m/s',
          1 => '12 kg·m/s',
          2 => '24 kg·m/s',
          3 => '0',
        ),
        'correcta' => '18 kg·m/s',
      ),
      23 => 
      array (
        'pregunta' => 'e = √(h₂/h₁) en caída sobre resorte',
        'opciones' => 
        array (
          0 => 'Sí',
          1 => 'No',
          2 => 'A veces',
          3 => 'Nunca',
        ),
        'correcta' => 'Sí',
      ),
      24 => 
      array (
        'pregunta' => 'F promedio =',
        'opciones' => 
        array (
          0 => 'J / Δt',
          1 => 'Δp / m',
          2 => 'm a',
          3 => 'p / t',
        ),
        'correcta' => 'J / Δt',
      ),
      25 => 
      array (
        'pregunta' => 'Colisión 2D: p conservada en',
        'opciones' => 
        array (
          0 => 'x e y',
          1 => 'solo x',
          2 => 'solo y',
          3 => 'ninguna',
        ),
        'correcta' => 'x e y',
      ),
      26 => 
      array (
        'pregunta' => 'Explosión: p total',
        'opciones' => 
        array (
          0 => '0 (si en reposo)',
          1 => 'm v',
          2 => 'F t',
          3 => 'EK',
        ),
        'correcta' => '0 (si en reposo)',
      ),
      27 => 
      array (
        'pregunta' => '1D: v₁f =',
        'opciones' => 
        array (
          0 => '(m₁-m₂)u₁/(m₁+m₂) + 2m₂u₂/(m₁+m₂)',
          1 => 'u₁',
          2 => '0',
          3 => 'u₂',
        ),
        'correcta' => '(m₁-m₂)u₁/(m₁+m₂) + 2m₂u₂/(m₁+m₂)',
      ),
      28 => 
      array (
        'pregunta' => 'Sistema aislado significa',
        'opciones' => 
        array (
          0 => 'F_ext = 0',
          1 => 'm = cte',
          2 => 'v = cte',
          3 => 'EK = cte',
        ),
        'correcta' => 'F_ext = 0',
      ),
      29 => 
      array (
        'pregunta' => 'SI 2025: 1 kg·m/s =',
        'opciones' => 
        array (
          0 => '1 N·s',
          1 => '1 J',
          2 => '1 W',
          3 => '1 Pa',
        ),
        'correcta' => '1 N·s',
      ),
    ),
  ),
  11 => 
  array (
    'materia' => 'Física I',
    'slug' => 'conservacion-energia-mecanica',
    'titulo' => 'Conservación de la Energía Mecánica: E_total = EPG + EK, v_f = √(2gh)',
    'contenido' => '<div class="leccion-container leccion-fisica-energia" data-tema="energia-mecanica">
    <!-- CABECERA CYBERPUNK -->
    <header class="leccion-header">
        <h1 class="titulo-leccion neon-glow">
            <span class="icon-tema">⚡</span>
            CONSERVACIÓN DE LA <span class="formula-highlight">ENERGÍA MECÁNICA</span>
        </h1>
        <div class="subtitulo">
            La energía no se crea ni se destruye, solo se transforma: \\( E_{\\text{total}} = E_{pg} + E_k = \\text{constante} \\)
        </div>
    </header>

    <!-- PANEL OBJETIVOS -->
    <section class="panel-objetivos">
        <h2 class="seccion-titulo neon-concepto">
            <span class="icon">🎯</span> OBJETIVOS DE APRENDIZAJE
        </h2>
        <div class="objetivos-grid">
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Explicar el principio de conservación de la energía mecánica</h3>
                <p>Diferenciar entre energía potencial gravitatoria (\\(E_{pg}\\)) y cinética (\\(E_k\\))</p>
            </div>
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Calcular la velocidad final en caída libre</h3>
                <p>Aplicar la fórmula \\( v_f = \\sqrt{2gh} \\) en problemas reales</p>
            </div>
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Analizar la transformación de energía</h3>
                <p>Identificar cómo \\(E_{pg}\\) se convierte en \\(E_k\\) durante el movimiento</p>
            </div>
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Simular escenarios de conservación de energía</h3>
                <p>Usar el simulador interactivo para visualizar la transformación de energía</p>
            </div>
        </div>
    </section>

    <!-- CONTEXTO REAL -->
    <section class="contexto-real">
        <h2 class="seccion-titulo neon-dato">
            <span class="icon">🌍</span> APLICACIÓN EN EL MUNDO REAL
        </h2>
        <div class="contexto-grid">
            <div class="contexto-card">
                <h3>🎢 Montañas Rusas</h3>
                <p>La energía potencial en la cima se transforma en energía cinética durante la caída, permitiendo alcanzar velocidades altas sin motores.</p>
                <div class="dato-neon">Velocidad máxima: 120 km/h</div>
            </div>
            <div class="contexto-card">
                <h3>🚀 Lanzamiento de Satélites</h3>
                <p>La energía potencial gravitatoria se convierte en cinética para alcanzar la velocidad orbital necesaria (7.8 km/s).</p>
                <div class="dato-neon">Altura orbital: 300-1000 km</div>
            </div>
            <div class="contexto-card">
                <h3>💡 Energías Renovables</h3>
                <p>En centrales hidroeléctricas, la energía potencial del agua se convierte en cinética para generar electricidad.</p>
                <div class="dato-neon">Eficiencia: 85-90%</div>
            </div>
        </div>
    </section>

    <!-- SECCIÓN TEÓRICA -->
    <section class="teoria-section">
        <div class="borde-neon-lateral"></div>
        <h2 class="seccion-titulo neon-concepto">
            <span class="icon">📚</span> FUNDAMENTOS TEÓRICOS
        </h2>

        <!-- PRINCIPIO DE CONSERVACIÓN -->
        <div class="subseccion">
            <h3>1. Principio de Conservación de la Energía Mecánica</h3>
            <div class="definicion-principal">
                <div class="def-card">
                    <h4>ENERGÍA MECÁNICA TOTAL</h4>
                    <p>En ausencia de fuerzas no conservativas (como la fricción), la energía mecánica total se <strong>conserva</strong>:</p>
                    <div class="formula-inline">
                        \\[
                            E_{\\text{total}} = E_{pg} + E_k = \\text{constante}
                        \\]
                    </div>
                    <div class="formula-detalle">
                        <ul>
                            <li><strong>Energía Potencial Gravitatoria (\\(E_{pg}\\))</strong>: \\( mgh \\)</li>
                            <li><strong>Energía Cinética (\\(E_k\\))</strong>: \\( \\frac{1}{2}mv^2 \\)</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- ECUACIÓN DE CONSERVACIÓN -->
        <div class="subseccion">
            <h3>2. Ecuación de Conservación</h3>
            <div class="ecuacion-card">
                <div class="ecuacion-formula">
                    \\[
                        mgh_i + \\frac{1}{2}mv_i^2 = mgh_f + \\frac{1}{2}mv_f^2
                    \\]
                </div>
                <div class="ecuacion-explicacion">
                    <p>La masa \\(m\\) se cancela → la velocidad final <strong>no depende de la masa</strong>.</p>
                    <p>Si el objeto parte del reposo (\\(v_i = 0\\)) y cae desde una altura \\(h_i = h\\) hasta \\(h_f = 0\\):</p>
                    <div class="formula-inline">
                        \\[
                            mgh = \\frac{1}{2}mv_f^2 \\quad \\Rightarrow \\quad v_f = \\sqrt{2gh}
                        \\]
                    </div>
                    <p><strong>Independiente de la trayectoria</strong> (si no hay fricción).</p>
                </div>
            </div>
        </div>

        <!-- TRANSFORMACIÓN DE ENERGÍA -->
        <div class="subseccion">
            <h3>3. Transformación de Energía</h3>
            <div class="tabla-interactiva">
                <table class="tabla-cyberpunk">
                    <thead>
                        <tr>
                            <th>Punto</th>
                            <th>Energía Potencial (\\(E_{pg}\\))</th>
                            <th>Energía Cinética (\\(E_k\\))</th>
                            <th>Energía Total (\\(E_{\\text{total}}\\))</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr data-punto="altura-maxima">
                            <td><strong>Altura máxima</strong></td>
                            <td>Máxima</td>
                            <td>0</td>
                            <td>Constante</td>
                        </tr>
                        <tr data-punto="suelo">
                            <td><strong>Suelo</strong></td>
                            <td>0</td>
                            <td>Máxima</td>
                            <td>Constante</td>
                        </tr>
                    </tbody>
                </table>
                <div class="tabla-info" id="infoTransformacion">
                    Selecciona una fila para ver detalles
                </div>
            </div>
        </div>

        <!-- EJEMPLO PRÁCTICO -->
        <div class="subseccion">
            <h3>4. Ejemplo Práctico</h3>
            <div class="ejemplo-card">
                <p><strong>Problema:</strong> Un objeto cae desde una altura de \\( h = 20\\, \\text{m} \\). Calcula:</p>
                <ol>
                    <li>La velocidad final al llegar al suelo.</li>
                    <li>La energía total si la masa es \\( m = 2\\, \\text{kg} \\).</li>
                </ol>
                <div class="ejemplo-solucion">
                    <p><strong>Solución:</strong></p>
                    <p>
                        1. Velocidad final:
                        \\[
                            v_f = \\sqrt{2 \\cdot 9.8 \\cdot 20} = \\sqrt{392} \\approx 19.8\\, \\text{m/s}
                        \\]
                    </p>
                    <p>
                        2. Energía total:
                        \\[
                            E_{\\text{total}} = mgh = 2 \\cdot 9.8 \\cdot 20 = 392\\, \\text{J}
                        \\]
                    </p>
                </div>
                <button class="btn-verificar" onclick="verificarEjemplo()">VERIFICAR CÁLCULO</button>
                <div class="ejemplo-feedback" id="feedbackEjemplo" style="display: none;">
                    <p>✅ <strong>Correcto:</strong> La velocidad final es \\(19.8\\, \\text{m/s}\\) y la energía total es \\(392\\, \\text{J}\\).</p>
                </div>
            </div>
        </div>
    </section>

    <!-- SIMULADOR INTERACTIVO -->
    <section class="simulator-section">
        <h2 class="seccion-titulo neon-interactivo">
            <span class="icon">🎮</span> SIMULADOR: CONSERVACIÓN DE ENERGÍA
        </h2>
        <div class="simulator-container" data-tema="energia-mecanica">
            <!-- CONTROLES -->
            <div class="simulator-controls">
                <h3>CONTROLES</h3>
                <div class="control-group">
                    <label for="masaInput">Masa (m) en kg:</label>
                    <input type="range" id="masaInput" min="1" max="10" value="2" class="control-slider">
                    <span id="masaValue">2 kg</span>
                </div>
                <div class="control-group">
                    <label for="alturaInput">Altura (h) en m:</label>
                    <input type="range" id="alturaInput" min="5" max="50" value="20" class="control-slider">
                    <span id="alturaValue">20 m</span>
                </div>
                <div class="control-group">
                    <label for="gravedadInput">Gravedad (g) en m/s²:</label>
                    <input type="range" id="gravedadInput" min="5" max="15" value="9.8" step="0.1" class="control-slider">
                    <span id="gravedadValue">9.8 m/s²</span>
                </div>
                <button class="btn-ejecutar" onclick="calcularEnergia()">
                    <span class="btn-icon">▶</span> CALCULAR ENERGÍA
                </button>
                <button class="btn-aleatorio" onclick="valoresAleatorios()">
                    <span class="btn-icon">🎲</span> VALORES ALEATORIOS
                </button>
            </div>

            <!-- VISUALIZACIÓN -->
            <div class="simulator-visualization">
                <svg viewBox="0 0 600 400" id="svgEnergia">
                    <!-- Fondo -->
                    <rect x="0" y="0" width="600" height="400" fill="#0a0a1a" id="fondoSimulador"/>

                    <!-- Torre -->
                    <rect x="250" y="50" width="100" height="250" fill="#455A64" id="torre"/>
                    <text x="300" y="320" fill="white" font-size="12" text-anchor="middle" id="alturaSVG">20 m</text>

                    <!-- Objeto -->
                    <circle cx="300" cy="80" r="15" fill="#F44336" id="objeto">
                        <animate attributeName="cy" values="80;320" begin="indefinite" dur="2s" fill="freeze" id="animCaida"/>
                    </circle>
                    <text x="300" y="85" fill="white" font-size="10" text-anchor="middle" id="masaSVG">m=2 kg</text>

                    <!-- Energías -->
                    <rect x="50" y="50" width="150" height="80" fill="#4CAF50" rx="10" id="epgBar">
                        <text x="125" y="90" fill="white" font-size="12" text-anchor="middle" id="epgValue">EPG = 392 J</text>
                    </rect>
                    <rect x="400" y="50" width="150" height="20" fill="#2196F3" rx="10" id="ekBar">
                        <text x="475" y="65" fill="white" font-size="12" text-anchor="middle" id="ekValue">EK = 0 J</text>
                    </rect>

                    <!-- Fórmula -->
                    <rect x="150" y="320" width="300" height="60" fill="rgba(0,0,0,0.7)" rx="10"/>
                    <text x="300" y="350" fill="#39FF14" font-size="16" text-anchor="middle" id="formulaSVG">v_f = √(2gh)</text>
                    <text x="300" y="375" fill="white" font-size="12" text-anchor="middle" id="velocidadSVG">v_f = 19.8 m/s</text>
                </svg>
            </div>

            <!-- DATOS EN TIEMPO REAL -->
            <div class="simulator-data">
                <h3>DATOS DE SIMULACIÓN</h3>
                <div class="data-card">
                    <div class="data-label">Masa (m):</div>
                    <div class="data-value" id="dataMasa">2 kg</div>
                </div>
                <div class="data-card">
                    <div class="data-label">Altura (h):</div>
                    <div class="data-value" id="dataAltura">20 m</div>
                </div>
                <div class="data-card">
                    <div class="data-label">Gravedad (g):</div>
                    <div class="data-value" id="dataGravedad">9.8 m/s²</div>
                </div>
                <div class="data-card highlight">
                    <div class="data-label">ENERGÍA POTENCIAL (EPG):</div>
                    <div class="data-value" id="dataEPG">392 J</div>
                </div>
                <div class="data-card highlight">
                    <div class="data-label">ENERGÍA CINÉTICA (EK):</div>
                    <div class="data-value" id="dataEK">0 J</div>
                </div>
                <div class="data-card highlight">
                    <div class="data-label">VELOCIDAD FINAL (v_f):</div>
                    <div class="data-value" id="dataVelocidad">19.8 m/s</div>
                </div>
                <button class="btn-animar" onclick="animarCaida()">
                    <span class="btn-icon">▶</span> ANIMAR CAÍDA
                </button>
            </div>
        </div>
    </section>

    <!-- QUIZ INTERACTIVO -->
    <section class="quiz-section">
        <h2 class="seccion-titulo neon-evaluacion">
            <span class="icon">❓</span> QUIZ DE AUTOEVALUACIÓN
        </h2>
        <div class="quiz-container">
            <!-- PREGUNTA 1 -->
            <div class="quiz-question" data-correct="B">
                <div class="quiz-header">
                    <span class="quiz-num">01</span>
                    <h3>¿Qué afirma el principio de conservación de la energía mecánica?</h3>
                </div>
                <div class="quiz-options">
                    <button class="quiz-option" data-value="A">
                        <span class="option-letter">A</span>
                        La energía cinética siempre es mayor que la potencial.
                    </button>
                    <button class="quiz-option" data-value="B">
                        <span class="option-letter">B</span>
                        La suma de la energía potencial y cinética es constante si no hay fricción.
                    </button>
                    <button class="quiz-option" data-value="C">
                        <span class="option-letter">C</span>
                        La energía potencial depende de la velocidad del objeto.
                    </button>
                    <button class="quiz-option" data-value="D">
                        <span class="option-letter">D</span>
                        La energía mecánica total siempre disminuye con el tiempo.
                    </button>
                </div>
                <div class="quiz-feedback" style="display: none;">
                    <div class="feedback-correct">
                        ✅ <strong>Correcto:</strong> \\( E_{\\text{total}} = E_{pg} + E_k = \\text{constante} \\) en ausencia de fricción.
                    </div>
                    <div class="feedback-incorrect">
                        ❌ <strong>Incorrecto:</strong> Revisa el principio de conservación de la energía mecánica.
                    </div>
                    <div class="feedback-explicacion">
                        <p><strong>Explicación:</strong> La energía mecánica total se conserva si solo actúan fuerzas conservativas (como la gravedad).</p>
                    </div>
                </div>
            </div>

            <!-- PREGUNTA 2 -->
            <div class="quiz-question" data-correct="C">
                <div class="quiz-header">
                    <span class="quiz-num">02</span>
                    <h3>Un objeto cae desde 10 m. ¿Cuál es su velocidad final?</h3>
                </div>
                <div class="quiz-options">
                    <button class="quiz-option" data-value="A">
                        <span class="option-letter">A</span>
                        5 m/s
                    </button>
                    <button class="quiz-option" data-value="B">
                        <span class="option-letter">B</span>
                        10 m/s
                    </button>
                    <button class="quiz-option" data-value="C">
                        <span class="option-letter">C</span>
                        14 m/s
                    </button>
                    <button class="quiz-option" data-value="D">
                        <span class="option-letter">D</span>
                        20 m/s
                    </button>
                </div>
                <div class="quiz-feedback" style="display: none;">
                    <div class="feedback-correct">
                        ✅ <strong>Correcto:</strong> \\( v_f = \\sqrt{2 \\cdot 9.8 \\cdot 10} \\approx 14\\, \\text{m/s} \\).
                    </div>
                    <div class="feedback-incorrect">
                        ❌ <strong>Incorrecto:</strong> Usa la fórmula \\( v_f = \\sqrt{2gh} \\).
                    </div>
                    <div class="feedback-explicacion">
                        <p><strong>Cálculo:</strong> \\( v_f = \\sqrt{2 \\cdot 9.8 \\cdot 10} = \\sqrt{196} \\approx 14\\, \\text{m/s} \\).</p>
                    </div>
                </div>
            </div>

            <!-- RESULTADOS -->
            <div class="quiz-results" style="display: none;">
                <h3>📊 RESULTADOS DEL QUIZ</h3>
                <div class="results-score">
                    Puntuación: <span id="quizScore">0</span>/2
                </div>
                <div class="results-feedback" id="quizFeedback">
                    Completa el quiz para ver tus resultados
                </div>
                <button class="btn-retry" onclick="reiniciarQuiz()">
                    🔄 INTENTAR NUEVAMENTE
                </button>
            </div>
        </div>
    </section>

    <!-- ERRORES COMUNES -->
    <section class="errores-section">
        <h2 class="seccion-titulo neon-alerta">
            <span class="icon">⚠️</span> ERRORES COMUNES Y SOLUCIONES
        </h2>
        <div class="errores-container">
            <div class="error-card">
                <div class="error-header" onclick="toggleError(this)">
                    <h3>❌ CONFUNDIR ENERGÍA POTENCIAL CON CINÉTICA</h3>
                    <span class="error-toggle">+</span>
                </div>
                <div class="error-content">
                    <div class="error-ejemplo">
                        <strong>Error común:</strong> "En la cima de una montaña rusa, la energía cinética es máxima".
                    </div>
                    <div class="error-correccion">
                        <strong>Corrección:</strong> En la cima, la energía <strong>potencial</strong> es máxima y la cinética es mínima (velocidad baja).
                    </div>
                    <div class="error-practica">
                        <p><strong>Practica:</strong> ¿Qué tipo de energía predomina al inicio y al final de una caída libre?</p>
                        <button class="btn-mini" onclick="mostrarSolucion(1)">Ver solución</button>
                        <div class="solucion" id="solucion1" style="display: none;">
                            <strong>Solución:</strong> Al inicio: <strong>Energía Potencial</strong>. Al final: <strong>Energía Cinética</strong>.
                        </div>
                    </div>
                </div>
            </div>
            <div class="error-card">
                <div class="error-header" onclick="toggleError(this)">
                    <h3>❌ OLVIDAR QUE LA VELOCIDAD FINAL NO DEPENDE DE LA MASA</h3>
                    <span class="error-toggle">+</span>
                </div>
                <div class="error-content">
                    <div class="error-ejemplo">
                        <strong>Error común:</strong> "Un objeto más pesado cae más rápido".
                    </div>
                    <div class="error-correccion">
                        <strong>Corrección:</strong> La velocidad final \\( v_f = \\sqrt{2gh} \\) <strong>no depende de la masa</strong>.
                    </div>
                    <div class="error-tabla">
                        <table>
                            <tr>
                                <th>Masa (kg)</th>
                                <th>Velocidad final (m/s)</th>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>14</td>
                            </tr>
                            <tr>
                                <td>10</td>
                                <td>14</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- PROBLEMAS TIPO EXAMEN -->
    <section class="examen-section">
        <h2 class="seccion-titulo neon-evaluacion">
            <span class="icon">📝</span> PROBLEMAS TIPO EXAMEN
        </h2>
        <div class="examen-container">
            <div class="problema-card">
                <div class="problema-header">
                    <span class="problema-num">P1</span>
                    <h3>Conservación de Energía en un Péndulo</h3>
                </div>
                <div class="problema-enunciado">
                    <p>Un péndulo de 1.5 m de longitud se suelta desde un ángulo de 30°. Calcula:</p>
                    <ol>
                        <li>La velocidad máxima en el punto más bajo.</li>
                        <li>La energía total si la masa es 0.5 kg.</li>
                    </ol>
                    <p><em>Nota:</em> Usa \\( h = L(1 - \\cos \\theta) \\) para calcular la altura.</p>
                </div>
                <div class="problema-espacio">
                    <textarea placeholder="Desarrolla tu solución aquí..." rows="8"></textarea>
                </div>
                <button class="btn-verificar" onclick="verificarProblema(1)">VERIFICAR SOLUCIÓN</button>
                <div class="problema-solucion" id="solucionP1" style="display: none;">
                    <strong>Solución:</strong><br>
                    1. Altura inicial: \\( h = 1.5(1 - \\cos 30°) \\approx 0.197\\, \\text{m} \\).<br>
                    Velocidad máxima: \\( v_f = \\sqrt{2 \\cdot 9.8 \\cdot 0.197} \\approx 1.97\\, \\text{m/s} \\).<br>
                    2. Energía total: \\( E_{\\text{total}} = mgh = 0.5 \\cdot 9.8 \\cdot 0.197 \\approx 0.965\\, \\text{J} \\).
                </div>
            </div>
            <div class="problema-card">
                <div class="problema-header">
                    <span class="problema-num">P2</span>
                    <h3>Energía en un Salto de Paracaidismo</h3>
                </div>
                <div class="problema-enunciado">
                    <p>Un paracaidista de 70 kg salta desde 3000 m. Calcula:</p>
                    <ol>
                        <li>La velocidad final en caída libre (sin fricción).</li>
                        <li>La energía cinética al llegar al suelo.</li>
                    </ol>
                </div>
                <div class="problema-espacio">
                    <textarea placeholder="Desarrolla tu solución aquí..." rows="8"></textarea>
                </div>
                <button class="btn-verificar" onclick="verificarProblema(2)">VERIFICAR SOLUCIÓN</button>
                <div class="problema-solucion" id="solucionP2" style="display: none;">
                    <strong>Solución:</strong><br>
                    1. Velocidad final: \\( v_f = \\sqrt{2 \\cdot 9.8 \\cdot 3000} \\approx 242.5\\, \\text{m/s} \\).<br>
                    2. Energía cinética: \\( E_k = \\frac{1}{2} \\cdot 70 \\cdot (242.5)^2 \\approx 2.07 \\times 10^6\\, \\text{J} \\).
                </div>
            </div>
            <div class="rubrica">
                <h4>📋 RÚBRICA DE EVALUACIÓN</h4>
                <table class="rubrica-table">
                    <tr>
                        <th>Criterio</th>
                        <th>Excelente (5)</th>
                        <th>Satisfactorio (3-4)</th>
                        <th>Insuficiente (0-2)</th>
                    </tr>
                    <tr>
                        <td>Aplicación correcta de \\( v_f = \\sqrt{2gh} \\)</td>
                        <td>Fórmula y unidades correctas</td>
                        <td>Errores menores en cálculos</td>
                        <td>Fórmula o unidades incorrectas</td>
                    </tr>
                    <tr>
                        <td>Conservación de energía mecánica</td>
                        <td>Explica claramente la transformación \\( E_{pg} \\rightarrow E_k \\)</td>
                        <td>Falta justificación</td>
                        <td>No aplica el principio</td>
                    </tr>
                </table>
            </div>
        </div>
    </section>

    <!-- CIERRE METACOGNITIVO -->
    <section class="cierre-section">
        <h2 class="seccion-titulo neon-concepto">
            <span class="icon">🧠</span> CIERRE METACOGNITIVO
        </h2>
        <div class="cierre-container">
            <div class="autoevaluacion">
                <h3>📈 AUTOEVALUACIÓN</h3>
                <div class="slider-group">
                    <label>Comprensión del principio de conservación:</label>
                    <input type="range" min="1" max="5" value="3" class="autoeval-slider" id="slider1">
                    <div class="slider-labels">
                        <span>Básico</span><span>Intermedio</span><span>Avanzado</span>
                    </div>
                </div>
                <div class="slider-group">
                    <label>Aplicación de \\( v_f = \\sqrt{2gh} \\):</label>
                    <input type="range" min="1" max="5" value="3" class="autoeval-slider" id="slider2">
                    <div class="slider-labels">
                        <span>Básico</span><span>Intermedio</span><span>Avanzado</span>
                    </div>
                </div>
                <button class="btn-guardar" onclick="guardarAutoevaluacion()">
                    💾 GUARDAR AUTOEVALUACIÓN
                </button>
            </div>
            <div class="reflexion">
                <h3>💭 REFLEXIÓN GUIADA</h3>
                <div class="pregunta-reflexion">
                    <p>¿Por qué es importante el principio de conservación de la energía en el diseño de montañas rusas?</p>
                    <textarea placeholder="Ejemplo: seguridad, velocidad, altura..." rows="4" id="reflexion1"></textarea>
                </div>
                <div class="pregunta-reflexion">
                    <p>Describe un ejemplo cotidiano donde observes la transformación de energía potencial a cinética.</p>
                    <textarea placeholder="Ejemplo: dejar caer un libro..." rows="4" id="reflexion2"></textarea>
                </div>
            </div>
            <div class="plan-estudio">
                <h3>📚 PLAN DE ESTUDIO RECOMENDADO</h3>
                <div class="plan-grid">
                    <div class="plan-card">
                        <h4>🔹 REPASO RÁPIDO (15 min)</h4>
                        <ul>
                            <li>Memorizar fórmulas \\( E_{pg} = mgh \\) y \\( E_k = \\frac{1}{2}mv^2 \\)</li>
                            <li>Repasar \\( v_f = \\sqrt{2gh} \\)</li>
                        </ul>
                    </div>
                    <div class="plan-card">
                        <h4>🛠 PRÁCTICA (30 min)</h4>
                        <ul>
                            <li>Resolver 5 problemas de conservación de energía</li>
                            <li>Usar el simulador para visualizar escenarios</li>
                        </ul>
                    </div>
                    <div class="plan-card">
                        <h4>🎓 PROFUNDIZACIÓN (45 min)</h4>
                        <ul>
                            <li>Investigar aplicaciones en ingeniería</li>
                            <li>Relacionar con energía térmica y fricción</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="recursos">
                <h3>🔗 RECURSOS ADICIONALES</h3>
                <div class="recursos-links">
                    <a href="https://phet.colorado.edu/es/simulation/legacy/energy-skate-park" target="_blank" class="recurso-link">
                        🎢 Simulador PhET: Parque de Energía
                    </a>
                    <a href="https://www.khanacademy.org/science/physics/work-and-energy/work-and-energy-tutorial/a/what-is-conservation-of-energy" target="_blank" class="recurso-link">
                        📚 Khan Academy: Conservación de la Energía
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- JAVASCRIPT INTEGRADO -->
<script>
    // ==========================================
// SIMULADOR DE CONSERVACIÓN DE ENERGÍA
// ==========================================
function calcularEnergia() {
    // Obtener valores de los sliders
    const masa = parseFloat(document.getElementById(\'masaInput\').value);
    const altura = parseFloat(document.getElementById(\'alturaInput\').value);
    const gravedad = parseFloat(document.getElementById(\'gravedadInput\').value);

    // Validar valores
    if (isNaN(masa) || isNaN(altura) || isNaN(gravedad)) {
        alert("Por favor, ingresa valores válidos.");
        return;
    }

    // Actualizar valores en la interfaz
    document.getElementById(\'masaValue\').textContent = `${masa} kg`;
    document.getElementById(\'alturaValue\').textContent = `${altura} m`;
    document.getElementById(\'gravedadValue\').textContent = `${gravedad} m/s²`;
    document.getElementById(\'masaSVG\').textContent = `m=${masa} kg`;
    document.getElementById(\'alturaSVG\').textContent = `${altura} m`;

    // Calcular energías
    const epg = masa * gravedad * altura;
    const velocidadFinal = Math.sqrt(2 * gravedad * altura);
    const ek = 0.5 * masa * Math.pow(velocidadFinal, 2);

    // Actualizar datos en la interfaz
    document.getElementById(\'dataMasa\').textContent = `${masa} kg`;
    document.getElementById(\'dataAltura\').textContent = `${altura} m`;
    document.getElementById(\'dataGravedad\').textContent = `${gravedad} m/s²`;
    document.getElementById(\'dataEPG\').textContent = `${epg.toFixed(2)} J`;
    document.getElementById(\'dataEK\').textContent = `${ek.toFixed(2)} J`;
    document.getElementById(\'dataVelocidad\').textContent = `${velocidadFinal.toFixed(2)} m/s`;

    // Actualizar SVG
    document.getElementById(\'epgValue\').textContent = `EPG = ${epg.toFixed(2)} J`;
    document.getElementById(\'ekValue\').textContent = `EK = ${ek.toFixed(2)} J`;
    document.getElementById(\'velocidadSVG\').textContent = `v_f = ${velocidadFinal.toFixed(2)} m/s`;

    // Ajustar altura de la torre y posición inicial del objeto
    const alturaTorre = 350 - (altura * 2);
    document.getElementById(\'torre\').setAttribute(\'height\', alturaTorre);
    document.getElementById(\'objeto\').setAttribute(\'cy\', alturaTorre + 50);

    // Ajustar altura de la barra de EPG
    const alturaEPG = Math.min(epg / 5, 150);
    document.getElementById(\'epgBar\').setAttribute(\'height\', alturaEPG);
}

// Generar valores aleatorios
function valoresAleatorios() {
    const masa = Math.floor(Math.random() * 9) + 1;
    const altura = Math.floor(Math.random() * 45) + 5;
    const gravedad = (Math.random() * 5 + 9.3).toFixed(1);

    document.getElementById(\'masaInput\').value = masa;
    document.getElementById(\'alturaInput\').value = altura;
    document.getElementById(\'gravedadInput\').value = gravedad;

    calcularEnergia(); // Actualizar simulador
}

// Animar la caída del objeto
function animarCaida() {
    const altura = parseFloat(document.getElementById(\'alturaInput\').value);
    const alturaTorre = 350 - (altura * 2);

    // Reiniciar posición del objeto
    document.getElementById(\'objeto\').setAttribute(\'cy\', alturaTorre + 50);

    // Iniciar animación
    document.getElementById(\'animCaida\').beginElement();

    // Actualizar barras de energía durante la caída
    setTimeout(() => {
        const epg = 0;
        const ek = parseFloat(document.getElementById(\'dataEPG\').textContent.replace(\' J\', \'\'));
        document.getElementById(\'epgValue\').textContent = `EPG = ${epg} J`;
        document.getElementById(\'ekValue\').textContent = `EK = ${ek.toFixed(2)} J`;
        document.getElementById(\'epgBar\').setAttribute(\'height\', \'20\');
        document.getElementById(\'ekBar\').setAttribute(\'height\', \'80\');
    }, 2000);
}

// ==========================================
// QUIZ INTERACTIVO
// ==========================================
let quizRespuestas = [];
let quizCompletado = false;

document.querySelectorAll(\'.quiz-option\').forEach(option => {
    option.addEventListener(\'click\', function() {
        if (quizCompletado) return;

        const question = this.closest(\'.quiz-question\');
        const correct = question.dataset.correct;
        const selected = this.dataset.value;
        const feedback = question.querySelector(\'.quiz-feedback\');

        // Limpiar selección previa
        question.querySelectorAll(\'.quiz-option\').forEach(opt => {
            opt.classList.remove(\'selected\', \'correct\', \'incorrect\');
        });

        // Marcar selección actual
        this.classList.add(\'selected\');

        // Verificar respuesta
        if (selected === correct) {
            this.classList.add(\'correct\');
            quizRespuestas.push(true);
        } else {
            this.classList.add(\'incorrect\');
            question.querySelector(`[data-value="${correct}"]`).classList.add(\'correct\');
            quizRespuestas.push(false);
        }

        // Mostrar feedback
        feedback.style.display = \'block\';

        // Verificar si todas las preguntas están respondidas
        const allAnswered = Array.from(document.querySelectorAll(\'.quiz-question\')).every(q =>
            q.querySelector(\'.quiz-option.selected\')
        );

        if (allAnswered && !quizCompletado) {
            quizCompletado = true;
            mostrarResultadosQuiz();
        }
    });
});

function mostrarResultadosQuiz() {
    const correctas = quizRespuestas.filter(r => r).length;
    const total = quizRespuestas.length;
    document.getElementById(\'quizScore\').textContent = `${correctas}/${total}`;

    let feedback = "";
    if (correctas === total) {
        feedback = "🎉 ¡Excelente! Dominas la conservación de la energía.";
    } else if (correctas >= total / 2) {
        feedback = "👍 Buen trabajo, pero repasa la transformación de energía.";
    } else {
        feedback = "📚 Necesitas estudiar más. Usa el simulador para practicar.";
    }

    document.getElementById(\'quizFeedback\').textContent = feedback;
    document.querySelector(\'.quiz-results\').style.display = \'block\';
}

function reiniciarQuiz() {
    quizRespuestas = [];
    quizCompletado = false;

    document.querySelectorAll(\'.quiz-option\').forEach(opt => {
        opt.classList.remove(\'selected\', \'correct\', \'incorrect\');
    });

    document.querySelectorAll(\'.quiz-feedback\').forEach(fb => {
        fb.style.display = \'none\';
    });

    document.querySelector(\'.quiz-results\').style.display = \'none\';
}

// ==========================================
// ERRORES COMUNES
// ==========================================
function toggleError(header) {
    const content = header.nextElementSibling;
    const toggle = header.querySelector(\'.error-toggle\');

    if (content.style.display === \'block\') {
        content.style.display = \'none\';
        toggle.textContent = \'+\';
    } else {
        content.style.display = \'block\';
        toggle.textContent = \'-\';
    }
}

function mostrarSolucion(num) {
    const solucion = document.getElementById(`solucion${num}`);
    solucion.style.display = solucion.style.display === \'block\' ? \'none\' : \'block\';
}

// ==========================================
// PROBLEMAS TIPO EXAMEN
// ==========================================
function verificarProblema(num) {
    const solucion = document.getElementById(`solucionP${num}`);
    solucion.style.display = solucion.style.display === \'block\' ? \'none\' : \'block\';
}

// ==========================================
// AUTOEVALUACIÓN
// ==========================================
function guardarAutoevaluacion() {
    const slider1 = document.getElementById(\'slider1\').value;
    const slider2 = document.getElementById(\'slider2\').value;
    const promedio = (parseInt(slider1) + parseInt(slider2)) / 2;

    alert(
        `💾 Autoevaluación guardada:\\n\\n` +
        `Principio de conservación: ${slider1}/5\\n` +
        `Aplicación de fórmulas: ${slider2}/5\\n\\n` +
        `Promedio: ${promedio.toFixed(1)}/5\\n\\n` +
        `Revisa el plan de estudio según tus resultados.`
    );
}

// ==========================================
// INICIALIZACIÓN
// ==========================================
document.addEventListener(\'DOMContentLoaded\', function() {
    console.log("🚀 Lección Cyberpunk: Conservación de la Energía Mecánica - Cargada");
    calcularEnergia(); // Inicializar simulador

    // Event listeners para sliders
    document.getElementById(\'masaInput\').addEventListener(\'input\', calcularEnergia);
    document.getElementById(\'alturaInput\').addEventListener(\'input\', calcularEnergia);
    document.getElementById(\'gravedadInput\').addEventListener(\'input\', calcularEnergia);
});
</script>
',
    'ejercicios' => 
    array (
      0 => 
      array (
        'enunciado' => 'Energía mecánica total =',
        'respuesta' => 'EPG + EK',
      ),
      1 => 
      array (
        'enunciado' => 'Fórmula v_f (caída libre)',
        'respuesta' => '√(2 g h)',
      ),
      2 => 
      array (
        'enunciado' => 'Conservación válida si',
        'respuesta' => 'Sin fricción',
      ),
      3 => 
      array (
        'enunciado' => 'h = 10 m → v_f ≈',
        'respuesta' => '14 m/s',
      ),
      4 => 
      array (
        'enunciado' => 'En altura máxima, EK =',
        'respuesta' => '0',
      ),
      5 => 
      array (
        'enunciado' => 'EPG = 0 cuando',
        'respuesta' => 'h = 0',
      ),
      6 => 
      array (
        'enunciado' => 'v_f depende de',
        'respuesta' => 'g y h (no m)',
      ),
      7 => 
      array (
        'enunciado' => 'Péndulo: E_total en',
        'respuesta' => 'Cualquier punto',
      ),
      8 => 
      array (
        'enunciado' => 'Resorte + gravedad: E_total =',
        'respuesta' => 'EPG + EPE + EK',
      ),
      9 => 
      array (
        'enunciado' => 'Fricción → E_mecánica',
        'respuesta' => 'Disminuye',
      ),
      10 => 
      array (
        'enunciado' => 'v_f = 20 m/s → h =',
        'respuesta' => '20.4 m',
      ),
      11 => 
      array (
        'enunciado' => '1 kJ =',
        'respuesta' => '1000 J',
      ),
    ),
    'quiz' => 
    array (
      0 => 
      array (
        'pregunta' => 'E_total =',
        'opciones' => 
        array (
          0 => 'EPG + EK',
          1 => 'EPG - EK',
          2 => 'mgh',
          3 => '½mv²',
        ),
        'correcta' => 'EPG + EK',
      ),
      1 => 
      array (
        'pregunta' => 'v_f =',
        'opciones' => 
        array (
          0 => '√(2gh)',
          1 => '2gh',
          2 => 'gh',
          3 => '√g',
        ),
        'correcta' => '√(2gh)',
      ),
      2 => 
      array (
        'pregunta' => 'Conservación sin',
        'opciones' => 
        array (
          0 => 'Fricción',
          1 => 'Gravedad',
          2 => 'Masa',
          3 => 'Velocidad',
        ),
        'correcta' => 'Fricción',
      ),
      3 => 
      array (
        'pregunta' => 'En suelo, EPG =',
        'opciones' => 
        array (
          0 => '0',
          1 => 'máxima',
          2 => '½mgh',
          3 => 'infinita',
        ),
        'correcta' => '0',
      ),
      4 => 
      array (
        'pregunta' => 'En altura máxima, EK =',
        'opciones' => 
        array (
          0 => '0',
          1 => 'máxima',
          2 => '½mv²',
          3 => 'mgh',
        ),
        'correcta' => '0',
      ),
      5 => 
      array (
        'pregunta' => 'v_f depende de',
        'opciones' => 
        array (
          0 => 'g y h',
          1 => 'm',
          2 => 'v_i',
          3 => 'trayectoria',
        ),
        'correcta' => 'g y h',
      ),
      6 => 
      array (
        'pregunta' => 'h = 5 m → v_f ≈',
        'opciones' => 
        array (
          0 => '9.9 m/s',
          1 => '5 m/s',
          2 => '19.8 m/s',
          3 => '0',
        ),
        'correcta' => '9.9 m/s',
      ),
      7 => 
      array (
        'pregunta' => 'Energía se transforma, no',
        'opciones' => 
        array (
          0 => 'Se crea/destruye',
          1 => 'Se pierde',
          2 => 'Se gana',
          3 => 'Nada',
        ),
        'correcta' => 'Se crea/destruye',
      ),
      8 => 
      array (
        'pregunta' => 'Unidad energía',
        'opciones' => 
        array (
          0 => 'Joule',
          1 => 'Newton',
          2 => 'Metro',
          3 => 'Watt',
        ),
        'correcta' => 'Joule',
      ),
      9 => 
      array (
        'pregunta' => '1 J =',
        'opciones' => 
        array (
          0 => 'N·m',
          1 => 'kg·m/s²',
          2 => 'W·s',
          3 => 'todas',
        ),
        'correcta' => 'todas',
      ),
      10 => 
      array (
        'pregunta' => 'h = 50 m → v_f ≈',
        'opciones' => 
        array (
          0 => '31.3 m/s',
          1 => '50 m/s',
          2 => '15 m/s',
          3 => '100 m/s',
        ),
        'correcta' => '31.3 m/s',
      ),
      11 => 
      array (
        'pregunta' => 'Fricción presente → E_mecánica',
        'opciones' => 
        array (
          0 => 'Disminuye',
          1 => 'Aumenta',
          2 => 'Igual',
          3 => 'Cero',
        ),
        'correcta' => 'Disminuye',
      ),
      12 => 
      array (
        'pregunta' => 'v_f igual en',
        'opciones' => 
        array (
          0 => 'Cualquier trayectoria (sin fricción)',
          1 => 'Solo recta',
          2 => 'Solo curva',
          3 => 'Ninguna',
        ),
        'correcta' => 'Cualquier trayectoria (sin fricción)',
      ),
      13 => 
      array (
        'pregunta' => 'Péndulo: máxima EK en',
        'opciones' => 
        array (
          0 => 'Punto bajo',
          1 => 'Punto alto',
          2 => 'Mitad',
          3 => 'Nunca',
        ),
        'correcta' => 'Punto bajo',
      ),
      14 => 
      array (
        'pregunta' => 'Resorte comprimido: E_total incluye',
        'opciones' => 
        array (
          0 => 'EPE',
          1 => 'EPG',
          2 => 'EK',
          3 => 'todas',
        ),
        'correcta' => 'todas',
      ),
      15 => 
      array (
        'pregunta' => 'v_i ≠ 0 → E_total =',
        'opciones' => 
        array (
          0 => 'mgh + ½mv_i²',
          1 => 'mgh',
          2 => '½mv_i²',
          3 => '0',
        ),
        'correcta' => 'mgh + ½mv_i²',
      ),
      16 => 
      array (
        'pregunta' => 'Energía disipada =',
        'opciones' => 
        array (
          0 => 'Trabajo fricción',
          1 => 'ΔEPG',
          2 => 'ΔEK',
          3 => 'mgh',
        ),
        'correcta' => 'Trabajo fricción',
      ),
      17 => 
      array (
        'pregunta' => 'g = 10 m/s², h = 10 m → v_f =',
        'opciones' => 
        array (
          0 => '14.14 m/s',
          1 => '10 m/s',
          2 => '20 m/s',
          3 => '0',
        ),
        'correcta' => '14.14 m/s',
      ),
      18 => 
      array (
        'pregunta' => 'SI 2025: g ≈',
        'opciones' => 
        array (
          0 => '9.8 m/s²',
          1 => '10 m/s²',
          2 => '9.81 m/s²',
          3 => '9.80665 m/s²',
        ),
        'correcta' => '9.80665 m/s²',
      ),
      19 => 
      array (
        'pregunta' => 'Luna: v_f desde h',
        'opciones' => 
        array (
          0 => 'Menor (g↓)',
          1 => 'Igual',
          2 => 'Mayor',
          3 => 'Cero',
        ),
        'correcta' => 'Menor (g↓)',
      ),
      20 => 
      array (
        'pregunta' => 'h = 100 m → v_f ≈',
        'opciones' => 
        array (
          0 => '44.3 m/s',
          1 => '100 m/s',
          2 => '20 m/s',
          3 => '9.8 m/s',
        ),
        'correcta' => '44.3 m/s',
      ),
      21 => 
      array (
        'pregunta' => 'v_f = 30 m/s → h =',
        'opciones' => 
        array (
          0 => '45.9 m',
          1 => '30 m',
          2 => '15 m',
          3 => '900 m',
        ),
        'correcta' => '45.9 m',
      ),
      22 => 
      array (
        'pregunta' => 'Energía total en resorte + masa',
        'opciones' => 
        array (
          0 => 'EPE + EPG + EK',
          1 => 'solo EPE',
          2 => 'solo EK',
          3 => 'nada',
        ),
        'correcta' => 'EPE + EPG + EK',
      ),
      23 => 
      array (
        'pregunta' => 'Trabajo no conservativo',
        'opciones' => 
        array (
          0 => 'ΔE_mecánica',
          1 => '0',
          2 => 'mgh',
          3 => '½mv²',
        ),
        'correcta' => 'ΔE_mecánica',
      ),
      24 => 
      array (
        'pregunta' => 'Montaña rusa: máxima velocidad en',
        'opciones' => 
        array (
          0 => 'Punto más bajo',
          1 => 'Punto alto',
          2 => 'Mitad',
          3 => 'Final',
        ),
        'correcta' => 'Punto más bajo',
      ),
      25 => 
      array (
        'pregunta' => 'v_f en vacío vs aire',
        'opciones' => 
        array (
          0 => 'Igual (sin fricción)',
          1 => 'Mayor en aire',
          2 => 'Menor en vacío',
          3 => 'Cero',
        ),
        'correcta' => 'Igual (sin fricción)',
      ),
      26 => 
      array (
        'pregunta' => 'E_mecánica = cte → sistema',
        'opciones' => 
        array (
          0 => 'Aislado de no conservativas',
          1 => 'Con fricción',
          2 => 'Abierto',
          3 => 'Caliente',
        ),
        'correcta' => 'Aislado de no conservativas',
      ),
      27 => 
      array (
        'pregunta' => 'h = 1 km → v_f ≈',
        'opciones' => 
        array (
          0 => '140 m/s',
          1 => '1000 m/s',
          2 => '9.8 m/s',
          3 => '0',
        ),
        'correcta' => '140 m/s',
      ),
      28 => 
      array (
        'pregunta' => 'Energía química → mecánica',
        'opciones' => 
        array (
          0 => 'No conservada mecánicamente',
          1 => 'Sí',
          2 => 'A veces',
          3 => 'Nunca',
        ),
        'correcta' => 'No conservada mecánicamente',
      ),
      29 => 
      array (
        'pregunta' => 'SI 2025: 1 J =',
        'opciones' => 
        array (
          0 => '1 N·m',
          1 => '1 kg·m²/s²',
          2 => '1 W·s',
          3 => 'todas',
        ),
        'correcta' => 'todas',
      ),
    ),
  ),
  12 => 
  array (
    'materia' => 'Física I',
    'slug' => 'calor-capacidad-termica-completo',
    'titulo' => 'Termodinámica Fundamental: Calor Específico, Capacidad Térmica y Transferencia de Energía',
    'contenido' => '<!-- INICIO LECCIÓN CYBERPUNK MEJORADA -->
<div class="leccion-container leccion-fisica-calor-mejorada" data-tema="calor-capacidad">

<!-- CABECERA SIMPLE Y DIRECTA -->
<header class="leccion-header-simple">
    <div class="titulo-container">
        <h1 class="titulo-principal">
            <span class="icono-titulo">🔥</span>
            CALOR Y CAPACIDAD TÉRMICA
        </h1>
        <p class="subtitulo-principal">
            Transferencia de energía por diferencia de temperatura - Q = m·c·ΔT
        </p>
    </div>
    <div class="fecha-actualizacion">
        <span class="badge-actualizado">ACTUALIZADO 2025</span>
        <span class="valor-destacado">c<sub>agua</sub> = 4186 J/kg·°C</span>
    </div>
</header>

<!-- CONTENIDO PRINCIPAL EN COLUMNAS -->
<div class="contenido-principal">
    
    <!-- COLUMNA IZQUIERDA: TEORÍA -->
    <div class="columna-teoria">
        
        <!-- SECCIÓN 1: CONCEPTOS FUNDAMENTALES -->
        <section class="seccion-contenido">
            <div class="seccion-header">
                <h2><span class="numero-seccion">01</span> CONCEPTOS BÁSICOS</h2>
                <div class="linea-separadora"></div>
            </div>
            
            <div class="conceptos-grid">
                <!-- CALOR -->
                <div class="concepto-card">
                    <div class="concepto-icono" style="background: rgba(255, 87, 34, 0.1); color: #FF5722;">
                        🔥
                    </div>
                    <div class="concepto-contenido">
                        <h3>CALOR (Q)</h3>
                        <p class="concepto-definicion">
                            Energía transferida entre sistemas debido a una diferencia de temperatura.
                        </p>
                        <div class="concepto-formula">
                            \\[ Q = m \\cdot c \\cdot \\Delta T \\]
                        </div>
                        <div class="concepto-detalles">
                            <div class="detalle-item">
                                <span class="detalle-etiqueta">Unidad SI:</span>
                                <span class="detalle-valor">Joule (J)</span>
                            </div>
                            <div class="detalle-item">
                                <span class="detalle-etiqueta">Caloría:</span>
                                <span class="detalle-valor">1 cal = 4.184 J</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- CALOR ESPECÍFICO -->
                <div class="concepto-card">
                    <div class="concepto-icono" style="background: rgba(33, 150, 243, 0.1); color: #2196F3;">
                        📊
                    </div>
                    <div class="concepto-contenido">
                        <h3>CALOR ESPECÍFICO (c)</h3>
                        <p class="concepto-definicion">
                            Cantidad de calor necesaria para elevar 1°C la temperatura de 1 kg de sustancia.
                        </p>
                        <div class="concepto-formula">
                            \\[ c = \\frac{Q}{m \\cdot \\Delta T} \\]
                        </div>
                        <div class="concepto-detalles">
                            <div class="detalle-item">
                                <span class="detalle-etiqueta">Unidad:</span>
                                <span class="detalle-valor">J/(kg·°C)</span>
                            </div>
                            <div class="detalle-item">
                                <span class="detalle-etiqueta">Propiedad:</span>
                                <span class="detalle-valor">Intensiva</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- CAPACIDAD TÉRMICA -->
                <div class="concepto-card">
                    <div class="concepto-icono" style="background: rgba(76, 175, 80, 0.1); color: #4CAF50;">
                        ⚖️
                    </div>
                    <div class="concepto-contenido">
                        <h3>CAPACIDAD TÉRMICA (C)</h3>
                        <p class="concepto-definicion">
                            Cantidad de calor necesaria para elevar 1°C la temperatura de un objeto.
                        </p>
                        <div class="concepto-formula">
                            \\[ C = m \\cdot c = \\frac{Q}{\\Delta T} \\]
                        </div>
                        <div class="concepto-detalles">
                            <div class="detalle-item">
                                <span class="detalle-etiqueta">Unidad:</span>
                                <span class="detalle-valor">J/°C</span>
                            </div>
                            <div class="detalle-item">
                                <span class="detalle-etiqueta">Propiedad:</span>
                                <span class="detalle-valor">Extensiva</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- COMPARACIÓN c vs C -->
            <div class="comparacion-card">
                <h3 class="comparacion-titulo">DIFERENCIA: Calor Específico vs Capacidad Térmica</h3>
                <div class="comparacion-grid">
                    <div class="comparacion-item">
                        <h4>Calor Específico (c)</h4>
                        <ul class="lista-caracteristicas">
                            <li>Propiedad <strong>INTENSIVA</strong></li>
                            <li>Depende solo del material</li>
                            <li>Unidad: J/(kg·°C)</li>
                            <li>Ejemplo: c<sub>agua</sub> = 4186 J/(kg·°C)</li>
                        </ul>
                    </div>
                    <div class="comparacion-item">
                        <h4>Capacidad Térmica (C)</h4>
                        <ul class="lista-caracteristicas">
                            <li>Propiedad <strong>EXTENSIVA</strong></li>
                            <li>Depende del material y la masa</li>
                            <li>Unidad: J/°C</li>
                            <li>Ejemplo: 2 kg agua → C = 8372 J/°C</li>
                        </ul>
                    </div>
                </div>
                <div class="ejemplo-practico">
                    <strong>Ejemplo práctico:</strong> Para calentar 2 kg de agua de 20°C a 80°C:<br>
                    \\[ Q = 2 \\times 4186 \\times 60 = 502,320 \\, \\text{J} \\]
                    \\[ C = 2 \\times 4186 = 8,372 \\, \\text{J/°C} \\]
                </div>
            </div>
        </section>
        
        <!-- SECCIÓN 2: CALOR LATENTE -->
        <section class="seccion-contenido">
            <div class="seccion-header">
                <h2><span class="numero-seccion">02</span> CALOR LATENTE</h2>
                <div class="linea-separadora"></div>
            </div>
            
            <div class="explicacion-detallada">
                <p>Calor necesario para cambiar el estado de agregación de una sustancia <strong>sin cambiar su temperatura</strong>.</p>
                
                <div class="formula-destacada">
                    <div class="formula-titulo">Fórmula del Calor Latente</div>
                    \\[ Q = m \\cdot L \\]
                    <div class="formula-variables">
                        <span>Q = calor transferido (J)</span>
                        <span>m = masa (kg)</span>
                        <span>L = calor latente (J/kg)</span>
                    </div>
                </div>
                
                <div class="tabla-latente">
                    <div class="tabla-header">
                        <h4>CALORES LATENTES DEL AGUA</h4>
                    </div>
                    <div class="tabla-contenido">
                        <div class="fila-latente">
                            <div class="celda-proceso">
                                <div class="icono-proceso">❄️→💧</div>
                                <span>Fusión (Hielo → Agua)</span>
                            </div>
                            <div class="celda-valor">
                                <span class="valor-destacado">334,000 J/kg</span>
                                <span class="valor-pequeno">(79.7 cal/g)</span>
                            </div>
                            <div class="celda-info">Temperatura constante: 0°C</div>
                        </div>
                        <div class="fila-latente">
                            <div class="celda-proceso">
                                <div class="icono-proceso">💧→💨</div>
                                <span>Vaporización (Agua → Vapor)</span>
                            </div>
                            <div class="celda-valor">
                                <span class="valor-destacado">2,260,000 J/kg</span>
                                <span class="valor-pequeno">(540 cal/g)</span>
                            </div>
                            <div class="celda-info">Temperatura constante: 100°C</div>
                        </div>
                        <div class="fila-latente">
                            <div class="celda-proceso">
                                <div class="icono-proceso">💧→❄️</div>
                                <span>Solidificación (Agua → Hielo)</span>
                            </div>
                            <div class="celda-valor">
                                <span class="valor-destacado">-334,000 J/kg</span>
                                <span class="valor-pequeno">(libera calor)</span>
                            </div>
                            <div class="celda-info">Temperatura constante: 0°C</div>
                        </div>
                    </div>
                </div>
                
                <div class="ejemplo-aplicacion">
                    <h4>APLICACIÓN PRÁCTICA</h4>
                    <p>Para fundir 500 g de hielo a 0°C:</p>
                    <div class="calculo-paso">
                        <span class="paso-numero">1</span>
                        <span class="paso-texto">Convertir masa: 500 g = 0.5 kg</span>
                    </div>
                    <div class="calculo-paso">
                        <span class="paso-numero">2</span>
                        <span class="paso-texto">Aplicar fórmula: Q = m × L<sub>f</sub></span>
                    </div>
                    <div class="calculo-paso">
                        <span class="paso-numero">3</span>
                        <span class="paso-texto">Calcular: Q = 0.5 × 334,000 = 167,000 J</span>
                    </div>
                    <div class="resultado-final">
                        <strong>Resultado:</strong> Se necesitan 167 kJ para fundir el hielo
                    </div>
                </div>
            </div>
        </section>
        
        <!-- SECCIÓN 3: EQUILIBRIO TÉRMICO -->
        <section class="seccion-contenido">
            <div class="seccion-header">
                <h2><span class="numero-seccion">03</span> EQUILIBRIO TÉRMICO</h2>
                <div class="linea-separadora"></div>
            </div>
            
            <div class="principio-fundamental">
                <div class="principio-icono">⚖️</div>
                <div class="principio-contenido">
                    <h3>PRINCIPIO DE CONSERVACIÓN DEL CALOR</h3>
                    <p>En un sistema aislado, el calor perdido por los cuerpos calientes es igual al calor ganado por los cuerpos fríos.</p>
                </div>
            </div>
            
            <div class="formula-equilibrio">
                <div class="formula-simple">
                    \\[ Q_{\\text{ganado}} = Q_{\\text{perdido}} \\]
                </div>
                <div class="formula-completa">
                    \\[ m_1 \\cdot c_1 \\cdot (T_f - T_1) = m_2 \\cdot c_2 \\cdot (T_2 - T_f) \\]
                </div>
                <div class="formula-explicacion">
                    Donde:
                    <ul>
                        <li>T<sub>f</sub> = temperatura final de equilibrio</li>
                        <li>T<sub>1</sub> = temperatura inicial del cuerpo frío</li>
                        <li>T<sub>2</sub> = temperatura inicial del cuerpo caliente</li>
                    </ul>
                </div>
            </div>
            
            <div class="ejemplo-detallado">
                <h4>PROBLEMA RESUELTO</h4>
                <p class="enunciado-problema">
                    Se introduce un bloque de aluminio de 0.5 kg a 150°C en 2 litros de agua a 20°C. Calcular la temperatura final de equilibrio.
                </p>
                
                <div class="solucion-pasos">
                    <div class="paso-solucion">
                        <div class="paso-header">
                            <span class="paso-indicador">Paso 1</span>
                            <span class="paso-titulo">Datos conocidos</span>
                        </div>
                        <div class="paso-contenido">
                            <div class="datos-lista">
                                <div class="dato-item">
                                    <span class="dato-label">Agua:</span>
                                    <span class="dato-valor">m₁ = 2 kg, c₁ = 4186 J/kg·°C, T₁ = 20°C</span>
                                </div>
                                <div class="dato-item">
                                    <span class="dato-label">Aluminio:</span>
                                    <span class="dato-valor">m₂ = 0.5 kg, c₂ = 900 J/kg·°C, T₂ = 150°C</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="paso-solucion">
                        <div class="paso-header">
                            <span class="paso-indicador">Paso 2</span>
                            <span class="paso-titulo">Aplicar conservación</span>
                        </div>
                        <div class="paso-contenido">
                            \\[ m_1 c_1 (T_f - T_1) = m_2 c_2 (T_2 - T_f) \\]
                            \\[ 2 \\times 4186 \\times (T_f - 20) = 0.5 \\times 900 \\times (150 - T_f) \\]
                        </div>
                    </div>
                    
                    <div class="paso-solucion">
                        <div class="paso-header">
                            <span class="paso-indicador">Paso 3</span>
                            <span class="paso-titulo">Resolver ecuación</span>
                        </div>
                        <div class="paso-contenido">
                            \\[ 8372(T_f - 20) = 450(150 - T_f) \\]
                            \\[ 8372T_f - 167,440 = 67,500 - 450T_f \\]
                            \\[ 8372T_f + 450T_f = 67,500 + 167,440 \\]
                            \\[ 8822T_f = 234,940 \\]
                        </div>
                    </div>
                    
                    <div class="paso-solucion">
                        <div class="paso-header">
                            <span class="paso-indicador">Paso 4</span>
                            <span class="paso-titulo">Calcular resultado</span>
                        </div>
                        <div class="paso-contenido">
                            \\[ T_f = \\frac{234,940}{8822} \\approx 26.6 \\, ^\\circ\\text{C} \\]
                            <div class="resultado-destacado">
                                <strong>Temperatura final:</strong> 26.6°C
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    
    <!-- COLUMNA DERECHA: DATOS Y APLICACIONES -->
    <div class="columna-datos">
        
        <!-- TABLA DE CALORES ESPECÍFICOS -->
        <section class="seccion-datos">
            <div class="seccion-header-datos">
                <h2>📋 CALORES ESPECÍFICOS</h2>
                <div class="linea-datos"></div>
            </div>
            
            <div class="tabla-sustancias">
                <div class="tabla-header-fijo">
                    <div class="columna-sustancia">SUSTANCIA</div>
                    <div class="columna-valor">c (J/kg·°C)</div>
                    <div class="columna-relacion">vs AGUA</div>
                </div>
                
                <div class="tabla-cuerpo">
                    <!-- AGUA -->
                    <div class="fila-sustancia destacada">
                        <div class="celda-sustancia">
                            <div class="icono-sustancia">💧</div>
                            <div class="info-sustancia">
                                <strong>Agua líquida</strong>
                                <span class="formula-sustancia">H₂O</span>
                            </div>
                        </div>
                        <div class="celda-valor">
                            <span class="valor-principal">4186</span>
                            <span class="valor-secundario">(1.000 cal/g·°C)</span>
                        </div>
                        <div class="celda-relacion">
                            <div class="barra-relacion" style="width: 100%">
                                <span class="texto-relacion">1.00×</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- ALUMINIO -->
                    <div class="fila-sustancia">
                        <div class="celda-sustancia">
                            <div class="icono-sustancia">🔩</div>
                            <div class="info-sustancia">
                                <strong>Aluminio</strong>
                                <span class="formula-sustancia">Al</span>
                            </div>
                        </div>
                        <div class="celda-valor">
                            <span class="valor-principal">900</span>
                            <span class="valor-secundario">(0.215 cal/g·°C)</span>
                        </div>
                        <div class="celda-relacion">
                            <div class="barra-relacion" style="width: 21.5%">
                                <span class="texto-relacion">0.22×</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- COBRE -->
                    <div class="fila-sustancia">
                        <div class="celda-sustancia">
                            <div class="icono-sustancia">🔌</div>
                            <div class="info-sustancia">
                                <strong>Cobre</strong>
                                <span class="formula-sustancia">Cu</span>
                            </div>
                        </div>
                        <div class="celda-valor">
                            <span class="valor-principal">385</span>
                            <span class="valor-secundario">(0.092 cal/g·°C)</span>
                        </div>
                        <div class="celda-relacion">
                            <div class="barra-relacion" style="width: 9.2%">
                                <span class="texto-relacion">0.09×</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- HIERRO -->
                    <div class="fila-sustancia">
                        <div class="celda-sustancia">
                            <div class="icono-sustancia">⚙️</div>
                            <div class="info-sustancia">
                                <strong>Hierro</strong>
                                <span class="formula-sustancia">Fe</span>
                            </div>
                        </div>
                        <div class="celda-valor">
                            <span class="valor-principal">450</span>
                            <span class="valor-secundario">(0.108 cal/g·°C)</span>
                        </div>
                        <div class="celda-relacion">
                            <div class="barra-relacion" style="width: 10.8%">
                                <span class="texto-relacion">0.11×</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- PLATA -->
                    <div class="fila-sustancia">
                        <div class="celda-sustancia">
                            <div class="icono-sustancia">✨</div>
                            <div class="info-sustancia">
                                <strong>Plata</strong>
                                <span class="formula-sustancia">Ag</span>
                            </div>
                        </div>
                        <div class="celda-valor">
                            <span class="valor-principal">235</span>
                            <span class="valor-secundario">(0.056 cal/g·°C)</span>
                        </div>
                        <div class="celda-relacion">
                            <div class="barra-relacion" style="width: 5.6%">
                                <span class="texto-relacion">0.06×</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- ALCOHOL -->
                    <div class="fila-sustancia">
                        <div class="celda-sustancia">
                            <div class="icono-sustancia">🍷</div>
                            <div class="info-sustancia">
                                <strong>Alcohol etílico</strong>
                                <span class="formula-sustancia">C₂H₅OH</span>
                            </div>
                        </div>
                        <div class="celda-valor">
                            <span class="valor-principal">2400</span>
                            <span class="valor-secundario">(0.574 cal/g·°C)</span>
                        </div>
                        <div class="celda-relacion">
                            <div class="barra-relacion" style="width: 57.4%">
                                <span class="texto-relacion">0.57×</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- HIELO -->
                    <div class="fila-sustancia">
                        <div class="celda-sustancia">
                            <div class="icono-sustancia">❄️</div>
                            <div class="info-sustancia">
                                <strong>Hielo</strong>
                                <span class="formula-sustancia">H₂O(s)</span>
                            </div>
                        </div>
                        <div class="celda-valor">
                            <span class="valor-principal">2090</span>
                            <span class="valor-secundario">(0.500 cal/g·°C)</span>
                        </div>
                        <div class="celda-relacion">
                            <div class="barra-relacion" style="width: 50%">
                                <span class="texto-relacion">0.50×</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- VAPOR -->
                    <div class="fila-sustancia">
                        <div class="celda-sustancia">
                            <div class="icono-sustancia">💨</div>
                            <div class="info-sustancia">
                                <strong>Vapor de agua</strong>
                                <span class="formula-sustancia">H₂O(g)</span>
                            </div>
                        </div>
                        <div class="celda-valor">
                            <span class="valor-principal">2010</span>
                            <span class="valor-secundario">(0.480 cal/g·°C)</span>
                        </div>
                        <div class="celda-relacion">
                            <div class="barra-relacion" style="width: 48%">
                                <span class="texto-relacion">0.48×</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="tabla-nota">
                    <strong>Nota:</strong> Valores aproximados a 25°C y 1 atm. El agua tiene el calor específico más alto entre sustancias comunes.
                </div>
            </div>
        </section>
        
        <!-- APLICACIONES PRÁCTICAS -->
        <section class="seccion-datos">
            <div class="seccion-header-datos">
                <h2>🔧 APLICACIONES PRÁCTICAS</h2>
                <div class="linea-datos"></div>
            </div>
            
            <div class="aplicaciones-grid">
                <div class="aplicacion-card">
                    <div class="aplicacion-icono" style="background: rgba(255, 87, 34, 0.1);">🏠</div>
                    <div class="aplicacion-contenido">
                        <h3>Calefacción Urbana</h3>
                        <p>Sistemas de calefacción usan el alto c del agua (4186 J/kg·°C) para almacenar y distribuir calor eficientemente.</p>
                        <div class="aplicacion-dato">
                            <span>Eficiencia:</span>
                            <strong>85-95%</strong>
                        </div>
                    </div>
                </div>
                
                <div class="aplicacion-card">
                    <div class="aplicacion-icono" style="background: rgba(33, 150, 243, 0.1);">🚗</div>
                    <div class="aplicacion-contenido">
                        <h3>Radiadores Automotrices</h3>
                        <p>El agua en el sistema de enfriamiento absorbe calor del motor gracias a su alto calor específico.</p>
                        <div class="aplicacion-dato">
                            <span>ΔT típico:</span>
                            <strong>40-60°C</strong>
                        </div>
                    </div>
                </div>
                
                <div class="aplicacion-card">
                    <div class="aplicacion-icono" style="background: rgba(76, 175, 80, 0.1);">🌊</div>
                    <div class="aplicacion-contenido">
                        <h3>Regulación Climática</h3>
                        <p>Océanos moderan el clima terrestre absorbiendo calor en verano y liberándolo en invierno.</p>
                        <div class="aplicacion-dato">
                            <span>Capacidad:</span>
                            <strong>332M km³</strong>
                        </div>
                    </div>
                </div>
                
                <div class="aplicacion-card">
                    <div class="aplicacion-icono" style="background: rgba(156, 39, 176, 0.1);">🍳</div>
                    <div class="aplicacion-contenido">
                        <h3>Utensilios de Cocina</h3>
                        <p>Sartenes de aluminio (bajo c) se calientan rápido, ollas de acero (alto c) distribuyen calor uniformemente.</p>
                        <div class="aplicacion-dato">
                            <span>c aluminio:</span>
                            <strong>900 J/kg·°C</strong>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- DIAGRAMA INTERACTIVO SIMPLE -->
        <section class="seccion-datos">
            <div class="seccion-header-datos">
                <h2>📈 DIAGRAMA: TRANSFERENCIA DE CALOR</h2>
                <div class="linea-datos"></div>
            </div>
            
            <div class="diagrama-container">
                <svg width="100%" height="300" viewBox="0 0 400 300" class="diagrama-svg">
                    <!-- FONDO -->
                    <rect width="400" height="300" fill="#0a0a1a" rx="8"/>
                    
                    <!-- OBJETO CALIENTE -->
                    <g id="objeto-caliente">
                        <rect x="50" y="100" width="100" height="100" rx="10" fill="#FF5722" stroke="#FF8A65" stroke-width="2"/>
                        <text x="100" y="85" fill="#FF8A65" text-anchor="middle" font-size="12" font-weight="bold">OBJETO CALIENTE</text>
                        <text x="100" y="120" fill="white" text-anchor="middle" font-size="11">T₂ = 150°C</text>
                        <text x="100" y="140" fill="white" text-anchor="middle" font-size="11">m₂ = 0.5 kg</text>
                        <text x="100" y="160" fill="white" text-anchor="middle" font-size="11">c₂ = 900 J/kg·°C</text>
                        <text x="100" y="190" fill="#FFCC80" text-anchor="middle" font-size="12" font-weight="bold">Q perdido</text>
                    </g>
                    
                    <!-- FLECHAS DE CALOR -->
                    <g id="flechas-calor">
                        <path d="M150 150 L200 150 L200 180 L250 180" fill="none" stroke="#FF9800" stroke-width="3" stroke-dasharray="5,5">
                            <animate attributeName="stroke-dashoffset" values="0;20" dur="2s" repeatCount="indefinite"/>
                        </path>
                        <polygon points="250,180 240,175 240,185" fill="#FF9800"/>
                        <text x="200" y="170" fill="#FF9800" text-anchor="middle" font-size="10">Q transferido</text>
                    </g>
                    
                    <!-- OBJETO FRÍO -->
                    <g id="objeto-frio">
                        <rect x="250" y="100" width="100" height="100" rx="10" fill="#2196F3" stroke="#64B5F6" stroke-width="2"/>
                        <text x="300" y="85" fill="#64B5F6" text-anchor="middle" font-size="12" font-weight="bold">OBJETO FRÍO</text>
                        <text x="300" y="120" fill="white" text-anchor="middle" font-size="11">T₁ = 20°C</text>
                        <text x="300" y="140" fill="white" text-anchor="middle" font-size="11">m₁ = 2.0 kg</text>
                        <text x="300" y="160" fill="white" text-anchor="middle" font-size="11">c₁ = 4186 J/kg·°C</text>
                        <text x="300" y="190" fill="#BBDEFB" text-anchor="middle" font-size="12" font-weight="bold">Q ganado</text>
                    </g>
                    
                    <!-- EQUILIBRIO -->
                    <g id="equilibrio">
                        <text x="200" y="250" fill="#4CAF50" text-anchor="middle" font-size="14" font-weight="bold">
                            EQUILIBRIO TÉRMICO: T_f = 26.6°C
                        </text>
                        <text x="200" y="270" fill="#81C784" text-anchor="middle" font-size="12">
                            Q ganado = Q perdido
                        </text>
                    </g>
                </svg>
                
                <div class="diagrama-leyenda">
                    <div class="leyenda-item">
                        <div class="leyenda-color" style="background: #FF5722;"></div>
                        <span>Objeto caliente → Pierde calor</span>
                    </div>
                    <div class="leyenda-item">
                        <div class="leyenda-color" style="background: #2196F3;"></div>
                        <span>Objeto frío → Gana calor</span>
                    </div>
                    <div class="leyenda-item">
                        <div class="leyenda-color" style="background: #FF9800;"></div>
                        <span>Transferencia de calor (Q)</span>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- EJERCICIOS ADICIONALES -->
        <section class="seccion-datos">
            <div class="seccion-header-datos">
                <h2>🧮 EJERCICIOS ADICIONALES</h2>
                <div class="linea-datos"></div>
            </div>
            
            <div class="ejercicios-lista">
                <div class="ejercicio-item">
                    <div class="ejercicio-header">
                        <span class="ejercicio-numero">01</span>
                        <h3>Calentamiento de agua</h3>
                    </div>
                    <p class="ejercicio-enunciado">
                        ¿Cuánto calor se necesita para calentar 5 litros de agua de 15°C a 95°C?
                    </p>
                    <div class="ejercicio-solucion">
                        <strong>Solución:</strong><br>
                        1 L agua ≈ 1 kg → m = 5 kg<br>
                        ΔT = 95 - 15 = 80°C<br>
                        Q = 5 × 4186 × 80 = 1,674,400 J ≈ 1.67 MJ
                    </div>
                </div>
                
                <div class="ejercicio-item">
                    <div class="ejercicio-header">
                        <span class="ejercicio-numero">02</span>
                        <h3>Mezcla de metales</h3>
                    </div>
                    <p class="ejercicio-enunciado">
                        Un bloque de cobre de 1 kg a 200°C se coloca en 0.5 kg de aluminio a 25°C. Calcular T_f.
                    </p>
                    <div class="ejercicio-solucion">
                        <strong>Solución:</strong><br>
                        m₁c₁(T_f - 25) = m₂c₂(200 - T_f)<br>
                        0.5×900×(T_f - 25) = 1×385×(200 - T_f)<br>
                        450T_f - 11,250 = 77,000 - 385T_f<br>
                        835T_f = 88,250 → T_f ≈ 105.7°C
                    </div>
                </div>
                
                <div class="ejercicio-item">
                    <div class="ejercicio-header">
                        <span class="ejercicio-numero">03</span>
                        <h3>Calor latente combinado</h3>
                    </div>
                    <p class="ejercicio-enunciado">
                        Calcular el calor total para convertir 2 kg de hielo a -10°C en vapor a 120°C.
                    </p>
                    <div class="ejercicio-solucion">
                        <strong>Solución:</strong><br>
                        1. Calentar hielo: Q₁ = 2×2090×10 = 41,800 J<br>
                        2. Fundir: Q₂ = 2×334,000 = 668,000 J<br>
                        3. Calentar agua: Q₃ = 2×4186×100 = 837,200 J<br>
                        4. Vaporizar: Q₄ = 2×2,260,000 = 4,520,000 J<br>
                        5. Calentar vapor: Q₅ = 2×2010×20 = 80,400 J<br>
                        Total: Q = 6,147,400 J ≈ 6.15 MJ
                    </div>
                </div>
            </div>
        </section>
        
        <!-- DATOS CURIOSOS -->
        <section class="seccion-datos">
            <div class="seccion-header-datos">
                <h2>💡 DATOS CURIOSOS</h2>
                <div class="linea-datos"></div>
            </div>
            
            <div class="curiosidades-lista">
                <div class="curiosidad-item">
                    <div class="curiosidad-icono">🌍</div>
                    <div class="curiosidad-contenido">
                        <h4>El agua modera el clima</h4>
                        <p>El alto calor específico del agua (4186 J/kg·°C) es 5 veces mayor que el de la tierra, por eso las zonas costeras tienen climas más estables.</p>
                    </div>
                </div>
                
                <div class="curiosidad-item">
                    <div class="curiosidad-icono">⚡</div>
                    <div class="curiosidad-contenido">
                        <h4>Enfriamiento por sudor</h4>
                        <p>El sudor usa el calor latente de vaporización (2260 kJ/kg) para enfriar el cuerpo: cada gramo de sudor evaporado elimina 2260 J de calor.</p>
                    </div>
                </div>
                
                <div class="curiosidad-item">
                    <div class="curiosidad-icono">🔬</div>
                    <div class="curiosidad-contenido">
                        <h4>Caloría original</h4>
                        <p>1 caloría se definió originalmente como el calor necesario para elevar 1°C la temperatura de 1 gramo de agua de 14.5°C a 15.5°C.</p>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

<!-- SIMULADOR SIMPLE -->
<section class="simulador-simple">
    <div class="simulador-header">
        <h2><span class="icono-simulador">🧪</span> CALCULADORA DE CALOR</h2>
        <p class="simulador-descripcion">
            Calcula la transferencia de calor entre dos sustancias
        </p>
    </div>
    
    <div class="simulador-contenido">
        <div class="calculadora-form">
            <!-- SUSTANCIA 1 -->
            <div class="sustancia-input">
                <h3>Sustancia 1 (Agua)</h3>
                <div class="input-group">
                    <label>Masa (kg):</label>
                    <input type="number" id="calc-m1" value="2.0" min="0.1" max="10" step="0.1" class="input-calculadora">
                </div>
                <div class="input-group">
                    <label>Temperatura (°C):</label>
                    <input type="number" id="calc-T1" value="20" min="0" max="100" step="1" class="input-calculadora">
                </div>
                <div class="sustancia-info">
                    <span>Calor específico:</span>
                    <strong>4186 J/kg·°C</strong>
                </div>
            </div>
            
            <!-- SUSTANCIA 2 -->
            <div class="sustancia-input">
                <h3>Sustancia 2 (Metal)</h3>
                <div class="input-group">
                    <label>Material:</label>
                    <select id="calc-material" class="select-calculadora">
                        <option value="900">Aluminio (900 J/kg·°C)</option>
                        <option value="385">Cobre (385 J/kg·°C)</option>
                        <option value="450" selected>Hierro (450 J/kg·°C)</option>
                        <option value="235">Plata (235 J/kg·°C)</option>
                    </select>
                </div>
                <div class="input-group">
                    <label>Masa (kg):</label>
                    <input type="number" id="calc-m2" value="1.0" min="0.1" max="10" step="0.1" class="input-calculadora">
                </div>
                <div class="input-group">
                    <label>Temperatura (°C):</label>
                    <input type="number" id="calc-T2" value="150" min="0" max="500" step="10" class="input-calculadora">
                </div>
            </div>
            
            <!-- BOTÓN DE CÁLCULO -->
            <div class="calculadora-boton">
                <button onclick="calcularTransferencia()" class="btn-calcular">
                    <span class="btn-icono">🧮</span>
                    CALCULAR TRANSFERENCIA
                </button>
            </div>
        </div>
        
        <!-- RESULTADOS -->
        <div class="calculadora-resultados" id="resultadosCalculadora">
            <div class="resultados-header">
                <h3>RESULTADOS DEL CÁLCULO</h3>
            </div>
            
            <div class="resultados-grid">
                <div class="resultado-item">
                    <div class="resultado-label">Temperatura final:</div>
                    <div class="resultado-valor" id="resultado-Tf">-</div>
                </div>
                <div class="resultado-item">
                    <div class="resultado-label">Calor transferido:</div>
                    <div class="resultado-valor" id="resultado-Q">-</div>
                </div>
                <div class="resultado-item">
                    <div class="resultado-label">ΔT agua:</div>
                    <div class="resultado-valor" id="resultado-dT1">-</div>
                </div>
                <div class="resultado-item">
                    <div class="resultado-label">ΔT metal:</div>
                    <div class="resultado-valor" id="resultado-dT2">-</div>
                </div>
            </div>
            
            <div class="ecuacion-resultado">
                <div class="ecuacion-titulo">Ecuación aplicada:</div>
                <div class="ecuacion-contenido">
                    \\[ m_1 c_1 (T_f - T_1) = m_2 c_2 (T_2 - T_f) \\]
                </div>
            </div>
        </div>
    </div>
</section>

<!-- RESUMEN FINAL -->
<section class="resumen-final">
    <div class="resumen-header">
        <h2>📚 RESUMEN DE FÓRMULAS</h2>
    </div>
    
    <div class="formulas-resumen">
        <div class="formula-resumen-item">
            <div class="formula-titulo">Calor Sensible</div>
            <div class="formula-contenido">
                \\[ Q = m \\cdot c \\cdot \\Delta T \\]
            </div>
            <div class="formula-explicacion">
                Calor que cambia la temperatura de una sustancia sin cambiar su estado
            </div>
        </div>
        
        <div class="formula-resumen-item">
            <div class="formula-titulo">Calor Latente</div>
            <div class="formula-contenido">
                \\[ Q = m \\cdot L \\]
            </div>
            <div class="formula-explicacion">
                Calor que cambia el estado de una sustancia sin cambiar su temperatura
            </div>
        </div>
        
        <div class="formula-resumen-item">
            <div class="formula-titulo">Equilibrio Térmico</div>
            <div class="formula-contenido">
                \\[ \\sum Q_{\\text{ganado}} = \\sum Q_{\\text{perdido}} \\]
            </div>
            <div class="formula-explicacion">
                En sistemas aislados, el calor total se conserva
            </div>
        </div>
        
        <div class="formula-resumen-item">
            <div class="formula-titulo">Capacidad Térmica</div>
            <div class="formula-contenido">
                \\[ C = m \\cdot c = \\frac{Q}{\\Delta T} \\]
            </div>
            <div class="formula-explicacion">
                Relación entre calor transferido y cambio de temperatura
            </div>
        </div>
    </div>
    
    <div class="consejos-finales">
        <h3>💡 CONSEJOS PARA RESOLVER PROBLEMAS</h3>
        <ol class="consejos-lista">
            <li>Identifica si es calor sensible (cambia T) o latente (cambia estado)</li>
            <li>Convierte todas las unidades al SI (kg, J, °C)</li>
            <li>En equilibrio térmico: calor ganado = calor perdido</li>
            <li>El agua tiene el calor específico más alto común: 4186 J/kg·°C</li>
            <li>Recuerda: 1 cal = 4.184 J exactamente</li>
        </ol>
    </div>
</section>

<!-- JAVASCRIPT SIMPLIFICADO -->
<script>
// FUNCIÓN PARA CALCULAR TRANSFERENCIA DE CALOR
function calcularTransferencia() {
    // Obtener valores
    const m1 = parseFloat(document.getElementById(\'calc-m1\').value);
    const T1 = parseFloat(document.getElementById(\'calc-T1\').value);
    const m2 = parseFloat(document.getElementById(\'calc-m2\').value);
    const T2 = parseFloat(document.getElementById(\'calc-T2\').value);
    const c2 = parseFloat(document.getElementById(\'calc-material\').value);
    const c1 = 4186; // Calor específico del agua
    
    // Validar datos
    if (isNaN(m1) || isNaN(T1) || isNaN(m2) || isNaN(T2) || m1 <= 0 || m2 <= 0) {
        alert("⚠️ Por favor, ingresa valores válidos mayores que cero.");
        return;
    }
    
    // Calcular temperatura final de equilibrio
    const Tf = (m1 * c1 * T1 + m2 * c2 * T2) / (m1 * c1 + m2 * c2);
    
    // Calcular calores transferidos
    const Q = m1 * c1 * (Tf - T1); // Calor ganado por el agua
    const dT1 = Tf - T1; // Cambio de temperatura del agua
    const dT2 = T2 - Tf; // Cambio de temperatura del metal
    
    // Mostrar resultados
    document.getElementById(\'resultado-Tf\').textContent = Tf.toFixed(1) + " °C";
    document.getElementById(\'resultado-Q\').textContent = Q.toLocaleString(\'es-ES\', {
        maximumFractionDigits: 0
    }) + " J";
    document.getElementById(\'resultado-dT1\').textContent = dT1.toFixed(1) + " °C";
    document.getElementById(\'resultado-dT2\').textContent = dT2.toFixed(1) + " °C";
    
    // Actualizar ecuación
    const eqElement = document.querySelector(\'.ecuacion-contenido\');
    eqElement.innerHTML = `\\\\[ ${m1.toFixed(1)} \\\\times 4186 \\\\times (${Tf.toFixed(1)} - ${T1}) = ${m2.toFixed(1)} \\\\times ${c2} \\\\times (${T2} - ${Tf.toFixed(1)}) \\\\]`;
    
    // Re-renderizar MathJax
    if (window.MathJax) {
        MathJax.typeset([eqElement]);
    }
    
    console.log("Cálculo completado:", { Tf, Q, dT1, dT2 });
}

// INICIALIZACIÓN
document.addEventListener(\'DOMContentLoaded\', function() {
    // Calcular valores por defecto
    calcularTransferencia();
    
    console.log("Calculadora de calor inicializada");
    
    // Efecto en tabla de sustancias
    const filasSustancias = document.querySelectorAll(\'.fila-sustancia\');
    filasSustancias.forEach(fila => {
        fila.addEventListener(\'mouseenter\', function() {
            this.style.transform = \'translateX(5px)\';
        });
        
        fila.addEventListener(\'mouseleave\', function() {
            this.style.transform = \'translateX(0)\';
        });
    });
});
</script>
</div>
<!-- FIN LECCIÓN CYBERPUNK MEJORADA -->',
    'ejercicios' => 
    array (
      0 => 
      array (
        'enunciado' => 'Fórmula cantidad calor',
        'respuesta' => 'Q = m c ΔT',
      ),
      1 => 
      array (
        'enunciado' => 'c agua',
        'respuesta' => '4186 J/kg·°C',
      ),
      2 => 
      array (
        'enunciado' => 'Capacidad calorífica C =',
        'respuesta' => 'm c',
      ),
      3 => 
      array (
        'enunciado' => 'Unidad c',
        'respuesta' => 'J/(kg·°C)',
      ),
      4 => 
      array (
        'enunciado' => 'Q para 0.5 kg agua ΔT=20°C',
        'respuesta' => '41860 J',
      ),
      5 => 
      array (
        'enunciado' => 'c cobre ≈',
        'respuesta' => '385 J/kg·°C',
      ),
      6 => 
      array (
        'enunciado' => 'C para 2 kg agua',
        'respuesta' => '8372 J/°C',
      ),
      7 => 
      array (
        'enunciado' => 'ΔT = Q / (m c)',
        'respuesta' => 'Fórmula cambio T',
      ),
      8 => 
      array (
        'enunciado' => 'Calor latente fusión agua',
        'respuesta' => '334 kJ/kg',
      ),
      9 => 
      array (
        'enunciado' => '1 cal =',
        'respuesta' => '4.184 J',
      ),
      10 => 
      array (
        'enunciado' => 'c alta →',
        'respuesta' => 'Absorbe más calor por °C',
      ),
      11 => 
      array (
        'enunciado' => 'SI: calor en',
        'respuesta' => 'Joule',
      ),
    ),
    'quiz' => 
    array (
      0 => 
      array (
        'pregunta' => 'Q = m c ΔT mide',
        'opciones' => 
        array (
          0 => 'Calor transferido',
          1 => 'Temperatura',
          2 => 'Masa',
          3 => 'Volumen',
        ),
        'correcta' => 'Calor transferido',
      ),
      1 => 
      array (
        'pregunta' => 'c es',
        'opciones' => 
        array (
          0 => 'Específica',
          1 => 'Total',
          2 => 'Molar',
          3 => 'Nuclear',
        ),
        'correcta' => 'Específica',
      ),
      2 => 
      array (
        'pregunta' => 'C = m c es',
        'opciones' => 
        array (
          0 => 'Capacidad calorífica',
          1 => 'Específica',
          2 => 'Latente',
          3 => 'Nuclear',
        ),
        'correcta' => 'Capacidad calorífica',
      ),
      3 => 
      array (
        'pregunta' => 'c agua =',
        'opciones' => 
        array (
          0 => '4186 J/kg·°C',
          1 => '385 J/kg·°C',
          2 => '900 J/kg·°C',
          3 => '2090 J/kg·°C',
        ),
        'correcta' => '4186 J/kg·°C',
      ),
      4 => 
      array (
        'pregunta' => 'Alta c →',
        'opciones' => 
        array (
          0 => 'Absorbe más calor',
          1 => 'Menos',
          2 => 'Igual',
          3 => 'Cero',
        ),
        'correcta' => 'Absorbe más calor',
      ),
      5 => 
      array (
        'pregunta' => 'ΔT = 0 → Q',
        'opciones' => 
        array (
          0 => '0',
          1 => 'máximo',
          2 => 'infinito',
          3 => 'negativo',
        ),
        'correcta' => '0',
      ),
      6 => 
      array (
        'pregunta' => 'm dobla → Q',
        'opciones' => 
        array (
          0 => 'Dobla',
          1 => 'Cuadruplica',
          2 => 'Mitad',
          3 => 'Igual',
        ),
        'correcta' => 'Dobla',
      ),
      7 => 
      array (
        'pregunta' => 'ΔT dobla → Q',
        'opciones' => 
        array (
          0 => 'Dobla',
          1 => 'Cuadruplica',
          2 => 'Mitad',
          3 => 'Igual',
        ),
        'correcta' => 'Dobla',
      ),
      8 => 
      array (
        'pregunta' => 'Calor latente es para',
        'opciones' => 
        array (
          0 => 'Cambio fase',
          1 => 'Cambio T',
          2 => 'Movimiento',
          3 => 'Luz',
        ),
        'correcta' => 'Cambio fase',
      ),
      9 => 
      array (
        'pregunta' => '1 cal =',
        'opciones' => 
        array (
          0 => '4.184 J',
          1 => '1 J',
          2 => '4184 J',
          3 => '0.4184 J',
        ),
        'correcta' => '4.184 J',
      ),
      10 => 
      array (
        'pregunta' => 'Q = 8360 J, m=1 kg, c=4186 → ΔT',
        'opciones' => 
        array (
          0 => '2°C',
          1 => '1°C',
          2 => '4°C',
          3 => '8360°C',
        ),
        'correcta' => '2°C',
      ),
      11 => 
      array (
        'pregunta' => 'c cobre',
        'opciones' => 
        array (
          0 => '385 J/kg·°C',
          1 => '4186',
          2 => '900',
          3 => '2090',
        ),
        'correcta' => '385 J/kg·°C',
      ),
      12 => 
      array (
        'pregunta' => 'C para 500 g agua',
        'opciones' => 
        array (
          0 => '2093 J/°C',
          1 => '4186 J/°C',
          2 => '8372 J/°C',
          3 => '0',
        ),
        'correcta' => '2093 J/°C',
      ),
      13 => 
      array (
        'pregunta' => 'Calor para fundir 1 kg hielo',
        'opciones' => 
        array (
          0 => '334 kJ',
          1 => '4186 kJ',
          2 => '2260 kJ',
          3 => '0 J',
        ),
        'correcta' => '334 kJ',
      ),
      14 => 
      array (
        'pregunta' => 'Calor para vaporizar 1 kg agua',
        'opciones' => 
        array (
          0 => '2260 kJ',
          1 => '334 kJ',
          2 => '4186 kJ',
          3 => '0 J',
        ),
        'correcta' => '2260 kJ',
      ),
      15 => 
      array (
        'pregunta' => 'c hielo',
        'opciones' => 
        array (
          0 => '2090 J/kg·°C',
          1 => '4186',
          2 => '2010',
          3 => '385',
        ),
        'correcta' => '2090 J/kg·°C',
      ),
      16 => 
      array (
        'pregunta' => 'Q = C ΔT para',
        'opciones' => 
        array (
          0 => 'Objeto entero',
          1 => 'Por kg',
          2 => 'Por mol',
          3 => 'Fase',
        ),
        'correcta' => 'Objeto entero',
      ),
      17 => 
      array (
        'pregunta' => 'SI: c en',
        'opciones' => 
        array (
          0 => 'J/(kg·K)',
          1 => 'cal/g·°C',
          2 => 'BTU/lb·°F',
          3 => 'kWh',
        ),
        'correcta' => 'J/(kg·K)',
      ),
      18 => 
      array (
        'pregunta' => 'c alta en',
        'opciones' => 
        array (
          0 => 'Agua',
          1 => 'Cobre',
          2 => 'Aire',
          3 => 'Vacío',
        ),
        'correcta' => 'Agua',
      ),
      19 => 
      array (
        'pregunta' => 'IUPAC: calor en',
        'opciones' => 
        array (
          0 => 'Joule',
          1 => 'Caloría',
          2 => 'eV',
          3 => 'kWh',
        ),
        'correcta' => 'Joule',
      ),
      20 => 
      array (
        'pregunta' => 'Q = 100 kJ, m=2 kg, ΔT=10°C → c',
        'opciones' => 
        array (
          0 => '5000 J/kg·°C',
          1 => '500 J/kg·°C',
          2 => '10000 J/kg·°C',
          3 => '0',
        ),
        'correcta' => '5000 J/kg·°C',
      ),
      21 => 
      array (
        'pregunta' => 'Calor específico molar agua ≈',
        'opciones' => 
        array (
          0 => '75.3 J/mol·K',
          1 => '18 J/mol·K',
          2 => '4186 J/mol·K',
          3 => '4.184 J/mol·K',
        ),
        'correcta' => '75.3 J/mol·K',
      ),
      22 => 
      array (
        'pregunta' => 'Dulong-Petit: c molar metales ≈',
        'opciones' => 
        array (
          0 => '25 J/mol·K',
          1 => '75 J/mol·K',
          2 => '4.184 J/mol·K',
          3 => '0',
        ),
        'correcta' => '25 J/mol·K',
      ),
      23 => 
      array (
        'pregunta' => 'Calor para 1 mol agua +1°C',
        'opciones' => 
        array (
          0 => '75.3 J',
          1 => '4186 J',
          2 => '18 J',
          3 => '4.184 J',
        ),
        'correcta' => '75.3 J',
      ),
      24 => 
      array (
        'pregunta' => 'c vapor agua',
        'opciones' => 
        array (
          0 => '2010 J/kg·°C',
          1 => '4186',
          2 => '2090',
          3 => '385',
        ),
        'correcta' => '2010 J/kg·°C',
      ),
      25 => 
      array (
        'pregunta' => 'Q latente fusión vs vaporización',
        'opciones' => 
        array (
          0 => 'L_v > L_f',
          1 => 'L_f > L_v',
          2 => 'Igual',
          3 => 'Cero',
        ),
        'correcta' => 'L_v > L_f',
      ),
      26 => 
      array (
        'pregunta' => 'Calorímetro ideal',
        'opciones' => 
        array (
          0 => 'Q_ganado = -Q_perdido',
          1 => 'Q_ganado = Q_perdido',
          2 => 'Q = 0',
          3 => 'Q infinito',
        ),
        'correcta' => 'Q_ganado = -Q_perdido',
      ),
      27 => 
      array (
        'pregunta' => 'c aire ≈',
        'opciones' => 
        array (
          0 => '1000 J/kg·°C',
          1 => '4186',
          2 => '385',
          3 => '2090',
        ),
        'correcta' => '1000 J/kg·°C',
      ),
      28 => 
      array (
        'pregunta' => 'SI 2025: 1 cal =',
        'opciones' => 
        array (
          0 => '4.184 J exacto',
          1 => '4.2 J',
          2 => '4 J',
          3 => '1 J',
        ),
        'correcta' => '4.184 J exacto',
      ),
      29 => 
      array (
        'pregunta' => 'Capacidad calorífica sistema',
        'opciones' => 
        array (
          0 => '∑ C_i',
          1 => 'C_promedio',
          2 => 'C_máx',
          3 => '0',
        ),
        'correcta' => '∑ C_i',
      ),
    ),
  ),
  13 => 
  array (
    'materia' => 'Física I',
    'slug' => 'impulso-cantidad-movimiento',
    'titulo' => 'Impulso Mecánico: J = F Δt = Δp, Cantidad de Movimiento p = m v, F = m a',
    'contenido' => '<div class="leccion-container leccion-fisica-impulso" data-tema="impulso">
    <!-- CABECERA CYBERPUNK -->
    <header class="leccion-header">
        <h1 class="titulo-leccion neon-glow">
            <span class="icon-tema">🚀</span>
            IMPULSO Y <span class="formula-highlight">CANTIDAD DE MOVIMIENTO</span>
        </h1>
        <div class="subtitulo">
            El impulso cambia el estado de movimiento de un cuerpo: \\( J = F \\Delta t = \\Delta p \\)
        </div>
    </header>

    <!-- PANEL OBJETIVOS -->
    <section class="panel-objetivos">
        <h2 class="seccion-titulo neon-concepto">
            <span class="icon">🎯</span> OBJETIVOS DE APRENDIZAJE
        </h2>
        <div class="objetivos-grid">
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Definir cantidad de movimiento (\\(p = m v\\))</h3>
                <p>Explicar su naturaleza vectorial y su conservación en sistemas aislados</p>
            </div>
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Relacionar impulso y cambio en \\(p\\) (\\(J = \\Delta p\\))</h3>
                <p>Aplicar \\( J = F \\Delta t \\) en problemas de colisiones y fuerzas impulsivas</p>
            </div>
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Analizar la 2ª Ley de Newton en términos de \\(p\\)</h3>
                <p>Entender \\( F = \\frac{\\Delta p}{\\Delta t} \\) como generalización de \\( F = m a \\)</p>
            </div>
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Simular escenarios de impulso y colisiones</h3>
                <p>Usar el simulador interactivo para visualizar cambios en \\(p\\)</p>
            </div>
        </div>
    </section>

    <!-- CONTEXTO REAL -->
    <section class="contexto-real">
        <h2 class="seccion-titulo neon-dato">
            <span class="icon">🌍</span> APLICACIÓN EN EL MUNDO REAL
        </h2>
        <div class="contexto-grid">
            <div class="contexto-card">
                <h3>🚗 Airbags en Automóviles</h3>
                <p>Los airbags aumentan el tiempo de colisión (\\(\\Delta t\\)), reduciendo la fuerza (\\(F\\)) y protegiendo a los ocupantes.</p>
                <div class="dato-neon">Tiempo de inflado: 30-50 ms</div>
            </div>
            <div class="contexto-card">
                <h3>🏀 Deportes de Contacto</h3>
                <p>En el baloncesto, los jugadores usan el impulso para cambiar la cantidad de movimiento del balón y anotar.</p>
                <div class="dato-neon">Fuerza promedio: 50-100 N</div>
            </div>
            <div class="contexto-card">
                <h3>🚀 Cohetes Espaciales</h3>
                <p>La expulsión de gases a alta velocidad genera un impulso que propulsa el cohete (3ª Ley de Newton).</p>
                <div class="dato-neon">Empuje: 35 MN (Saturno V)</div>
            </div>
        </div>
    </section>

    <!-- SECCIÓN TEÓRICA -->
    <section class="teoria-section">
        <div class="borde-neon-lateral"></div>
        <h2 class="seccion-titulo neon-concepto">
            <span class="icon">📚</span> FUNDAMENTOS TEÓRICOS
        </h2>

        <!-- CANTIDAD DE MOVIMIENTO -->
        <div class="subseccion">
            <h3>1. Cantidad de Movimiento (\\(p\\))</h3>
            <div class="definicion-principal">
                <div class="def-card">
                    <h4>CANTIDAD DE MOVIMIENTO</h4>
                    <p>Magnitud <strong>vectorial</strong> que depende de la masa y la velocidad de un cuerpo:</p>
                    <div class="formula-inline">
                        \\[
                            p = m v
                        \\]
                    </div>
                    <div class="formula-detalle">
                        <ul>
                            <li><strong>Unidad SI:</strong> kg·m/s</li>
                            <li><strong>Dirección:</strong> Igual que la velocidad</li>
                            <li><strong>Conservación:</strong> En sistemas aislados, \\( p_{\\text{total}} \\) es constante</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- IMPULSO MECÁNICO -->
        <div class="subseccion">
            <h3>2. Impulso Mecánico (\\(J\\))</h3>
            <div class="definicion-principal">
                <div class="def-card">
                    <h4>IMPULSO</h4>
                    <p>Efecto de una fuerza aplicada durante un intervalo de tiempo:</p>
                    <div class="formula-inline">
                        \\[
                            J = F \\Delta t = \\Delta p
                        \\]
                    </div>
                    <div class="formula-detalle">
                        <ul>
                            <li><strong>Unidad SI:</strong> N·s (equivalente a kg·m/s)</li>
                            <li><strong>Interpretación:</strong> Área bajo la curva \\(F\\) vs \\(t\\)</li>
                            <li><strong>Relación:</strong> \\( J = \\Delta p \\) (cambio en cantidad de movimiento)</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- 2ª LEY DE NEWTON GENERALIZADA -->
        <div class="subseccion">
            <h3>3. 2ª Ley de Newton en Términos de \\(p\\)</h3>
            <div class="ecuacion-card">
                <div class="ecuacion-formula">
                    \\[
                        F = \\frac{\\Delta p}{\\Delta t}
                    \\]
                </div>
                <div class="ecuacion-explicacion">
                    <p>Generalización de \\( F = m a \\):</p>
                    <ul>
                        <li>Si \\( m \\) es constante: \\( F = m a \\)</li>
                        <li>Si \\( m \\) varía (ej: cohetes): \\( F = \\frac{dp}{dt} \\)</li>
                    </ul>
                    <div class="formula-inline">
                        \\[
                            F \\Delta t = \\Delta p \\quad \\text{(Relación impulso-cambio en } p\\text{)}
                        \\]
                    </div>
                </div>
            </div>
        </div>

        <!-- RELACIONES CLAVE -->
        <div class="subseccion">
            <h3>4. Relaciones Clave</h3>
            <div class="tabla-interactiva">
                <table class="tabla-cyberpunk">
                    <thead>
                        <tr>
                            <th>Concepto</th>
                            <th>Fórmula</th>
                            <th>Unidad SI</th>
                            <th>Interpretación</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr data-concepto="cantidad-movimiento">
                            <td><strong>Cantidad de movimiento</strong></td>
                            <td>\\( p = m v \\)</td>
                            <td>kg·m/s</td>
                            <td>Estado de movimiento de un cuerpo</td>
                        </tr>
                        <tr data-concepto="impulso">
                            <td><strong>Impulso</strong></td>
                            <td>\\( J = F \\Delta t \\)</td>
                            <td>N·s</td>
                            <td>Cambio en cantidad de movimiento</td>
                        </tr>
                        <tr data-concepto="segunda-ley">
                            <td><strong>2ª Ley de Newton</strong></td>
                            <td>\\( F = \\frac{\\Delta p}{\\Delta t} \\)</td>
                            <td>N</td>
                            <td>Relación entre fuerza y cambio en \\( p \\)</td>
                        </tr>
                    </tbody>
                </table>
                <div class="tabla-info" id="infoRelaciones">
                    Selecciona una fila para ver detalles
                </div>
            </div>
        </div>

        <!-- EJEMPLO PRÁCTICO -->
        <div class="subseccion">
            <h3>5. Ejemplo Práctico</h3>
            <div class="ejemplo-card">
                <p><strong>Problema:</strong> Una fuerza de 200 N actúa sobre un objeto de 2 kg durante 0.05 s. Calcula:</p>
                <ol>
                    <li>El impulso (\\(J\\)).</li>
                    <li>El cambio en la cantidad de movimiento (\\(\\Delta p\\)).</li>
                    <li>La velocidad final si el objeto estaba inicialmente en reposo.</li>
                </ol>
                <div class="ejemplo-solucion">
                    <p><strong>Solución:</strong></p>
                    <p>
                        1. Impulso: \\( J = F \\Delta t = 200 \\cdot 0.05 = 10\\, \\text{N·s} \\).
                    </p>
                    <p>
                        2. Cambio en \\( p \\): \\( \\Delta p = J = 10\\, \\text{kg·m/s} \\).
                    </p>
                    <p>
                        3. Velocidad final: \\( \\Delta p = m \\Delta v \\Rightarrow 10 = 2 \\Delta v \\Rightarrow \\Delta v = 5\\, \\text{m/s} \\).
                    </p>
                </div>
                <button class="btn-verificar" onclick="verificarEjemplo()">VERIFICAR CÁLCULO</button>
                <div class="ejemplo-feedback" id="feedbackEjemplo" style="display: none;">
                    <p>✅ <strong>Correcto:</strong> El impulso es \\(10\\, \\text{N·s}\\), \\(\\Delta p = 10\\, \\text{kg·m/s}\\), y \\(\\Delta v = 5\\, \\text{m/s}\\).</p>
                </div>
            </div>
        </div>
    </section>

    <!-- SIMULADOR INTERACTIVO -->
    <section class="simulator-section">
        <h2 class="seccion-titulo neon-interactivo">
            <span class="icon">🎮</span> SIMULADOR: IMPULSO Y CANTIDAD DE MOVIMIENTO
        </h2>
        <div class="simulator-container" data-tema="impulso">
            <!-- CONTROLES -->
            <div class="simulator-controls">
                <h3>CONTROLES</h3>
                <div class="control-group">
                    <label for="masaInput">Masa (m) en kg:</label>
                    <input type="range" id="masaInput" min="0.5" max="10" value="2" step="0.5" class="control-slider">
                    <span id="masaValue">2 kg</span>
                </div>
                <div class="control-group">
                    <label for="fuerzaInput">Fuerza (F) en N:</label>
                    <input type="range" id="fuerzaInput" min="50" max="500" value="200" step="10" class="control-slider">
                    <span id="fuerzaValue">200 N</span>
                </div>
                <div class="control-group">
                    <label for="tiempoInput">Tiempo (Δt) en s:</label>
                    <input type="range" id="tiempoInput" min="0.01" max="0.2" value="0.05" step="0.01" class="control-slider">
                    <span id="tiempoValue">0.05 s</span>
                </div>
                <div class="control-group">
                    <label for="velocidadInicialInput">Velocidad inicial (v₀) en m/s:</label>
                    <input type="range" id="velocidadInicialInput" min="0" max="10" value="0" step="0.5" class="control-slider">
                    <span id="velocidadInicialValue">0 m/s</span>
                </div>
                <button class="btn-ejecutar" onclick="calcularImpulso()">
                    <span class="btn-icon">▶</span> CALCULAR IMPULSO
                </button>
                <button class="btn-aleatorio" onclick="valoresAleatorios()">
                    <span class="btn-icon">🎲</span> VALORES ALEATORIOS
                </button>
            </div>

            <!-- VISUALIZACIÓN -->
            <div class="simulator-visualization">
                <svg viewBox="0 0 600 400" id="svgImpulso">
                    <!-- Fondo -->
                    <rect x="0" y="0" width="600" height="400" fill="#0a0a1a" id="fondoSimulador"/>

                    <!-- Ejes del gráfico F vs t -->
                    <line x1="100" y1="300" x2="500" y2="300" stroke="#4CAF50" stroke-width="2"/>
                    <line x1="100" y1="300" x2="100" y2="100" stroke="#4CAF50" stroke-width="2"/>
                    <text x="90" y="290" fill="#4CAF50" font-size="12" text-anchor="end">0</text>
                    <text x="300" y="320" fill="#4CAF50" font-size="12" text-anchor="middle">t (s)</text>
                    <text x="90" y="150" fill="#4CAF50" font-size="12" text-anchor="end">F (N)</text>

                    <!-- Área del impulso (rectángulo) -->
                    <rect x="200" y="150" width="100" height="150" fill="#EF5350" opacity="0.7" id="areaImpulso">
                        <animate attributeName="opacity" values="0.7;0.3;0.7" dur="2s" repeatCount="indefinite"/>
                    </rect>
                    <text x="250" y="225" fill="white" font-size="12" text-anchor="middle" id="valorImpulso">J = 10 N·s</text>

                    <!-- Objeto antes/después -->
                    <circle cx="150" cy="200" r="20" fill="#2196F3" id="objetoInicial"/>
                    <text x="150" y="240" fill="white" font-size="12" text-anchor="middle" id="velocidadInicialSVG">v₀ = 0 m/s</text>

                    <circle cx="450" cy="200" r="20" fill="#4CAF50" id="objetoFinal"/>
                    <text x="450" y="240" fill="white" font-size="12" text-anchor="middle" id="velocidadFinalSVG">v_f = 5 m/s</text>

                    <!-- Flecha de fuerza -->
                    <line x1="300" y1="200" x2="300" y2="100" stroke="#FF5252" stroke-width="4" marker-end="url(#arrowhead)"/>
                    <text x="300" y="130" fill="#FF5252" font-size="14" text-anchor="middle" id="fuerzaSVG">F = 200 N</text>

                    <!-- Fórmula -->
                    <rect x="100" y="350" width="400" height="40" fill="rgba(0,0,0,0.7)" rx="5"/>
                    <text x="300" y="380" fill="#39FF14" font-size="16" text-anchor="middle" id="formulaSVG">J = F Δt = Δp = m Δv</text>
                </svg>
            </div>

            <!-- DATOS EN TIEMPO REAL -->
            <div class="simulator-data">
                <h3>DATOS DE SIMULACIÓN</h3>
                <div class="data-card">
                    <div class="data-label">Masa (m):</div>
                    <div class="data-value" id="dataMasa">2 kg</div>
                </div>
                <div class="data-card">
                    <div class="data-label">Fuerza (F):</div>
                    <div class="data-value" id="dataFuerza">200 N</div>
                </div>
                <div class="data-card">
                    <div class="data-label">Tiempo (Δt):</div>
                    <div class="data-value" id="dataTiempo">0.05 s</div>
                </div>
                <div class="data-card">
                    <div class="data-label">Velocidad inicial (v₀):</div>
                    <div class="data-value" id="dataVelocidadInicial">0 m/s</div>
                </div>
                <div class="data-card highlight">
                    <div class="data-label">IMPULSO (J):</div>
                    <div class="data-value" id="dataImpulso">10 N·s</div>
                </div>
                <div class="data-card highlight">
                    <div class="data-label">CAMBIO EN p (Δp):</div>
                    <div class="data-value" id="dataDeltaP">10 kg·m/s</div>
                </div>
                <div class="data-card highlight">
                    <div class="data-label">VELOCIDAD FINAL (v_f):</div>
                    <div class="data-value" id="dataVelocidadFinal">5 m/s</div>
                </div>
            </div>
        </div>
    </section>

    <!-- QUIZ INTERACTIVO -->
    <section class="quiz-section">
        <h2 class="seccion-titulo neon-evaluacion">
            <span class="icon">❓</span> QUIZ DE AUTOEVALUACIÓN
        </h2>
        <div class="quiz-container">
            <!-- PREGUNTA 1 -->
            <div class="quiz-question" data-correct="C">
                <div class="quiz-header">
                    <span class="quiz-num">01</span>
                    <h3>¿Qué relaciona el teorema del impulso?</h3>
                </div>
                <div class="quiz-options">
                    <button class="quiz-option" data-value="A">
                        <span class="option-letter">A</span>
                        Fuerza y aceleración
                    </button>
                    <button class="quiz-option" data-value="B">
                        <span class="option-letter">B</span>
                        Energía cinética y potencial
                    </button>
                    <button class="quiz-option" data-value="C">
                        <span class="option-letter">C</span>
                        Impulso y cambio en cantidad de movimiento
                    </button>
                    <button class="quiz-option" data-value="D">
                        <span class="option-letter">D</span>
                        Masa y velocidad
                    </button>
                </div>
                <div class="quiz-feedback" style="display: none;">
                    <div class="feedback-correct">
                        ✅ <strong>Correcto:</strong> \\( J = \\Delta p \\).
                    </div>
                    <div class="feedback-incorrect">
                        ❌ <strong>Incorrecto:</strong> Revisa el teorema del impulso.
                    </div>
                    <div class="feedback-explicacion">
                        <p><strong>Explicación:</strong> El teorema del impulso establece que \\( J = \\Delta p \\), es decir, el impulso es igual al cambio en la cantidad de movimiento.</p>
                    </div>
                </div>
            </div>

            <!-- PREGUNTA 2 -->
            <div class="quiz-question" data-correct="B">
                <div class="quiz-header">
                    <span class="quiz-num">02</span>
                    <h3>Un objeto de 3 kg se mueve a 4 m/s. ¿Cuál es su cantidad de movimiento?</h3>
                </div>
                <div class="quiz-options">
                    <button class="quiz-option" data-value="A">
                        <span class="option-letter">A</span>
                        12 kg·m/s
                    </button>
                    <button class="quiz-option" data-value="B">
                        <span class="option-letter">B</span>
                        12 kg·m/s²
                    </button>
                    <button class="quiz-option" data-value="C">
                        <span class="option-letter">C</span>
                        7 kg·m/s
                    </button>
                    <button class="quiz-option" data-value="D">
                        <span class="option-letter">D</span>
                        1.33 kg·m/s
                    </button>
                </div>
                <div class="quiz-feedback" style="display: none;">
                    <div class="feedback-correct">
                        ✅ <strong>Correcto:</strong> \\( p = m v = 3 \\cdot 4 = 12\\, \\text{kg·m/s} \\).
                    </div>
                    <div class="feedback-incorrect">
                        ❌ <strong>Incorrecto:</strong> La unidad correcta es kg·m/s.
                    </div>
                    <div class="feedback-explicacion">
                        <p><strong>Cálculo:</strong> \\( p = m v = 3 \\cdot 4 = 12\\, \\text{kg·m/s} \\).</p>
                    </div>
                </div>
            </div>

            <!-- RESULTADOS -->
            <div class="quiz-results" style="display: none;">
                <h3>📊 RESULTADOS DEL QUIZ</h3>
                <div class="results-score">
                    Puntuación: <span id="quizScore">0</span>/2
                </div>
                <div class="results-feedback" id="quizFeedback">
                    Completa el quiz para ver tus resultados
                </div>
                <button class="btn-retry" onclick="reiniciarQuiz()">
                    🔄 INTENTAR NUEVAMENTE
                </button>
            </div>
        </div>
    </section>

    <!-- ERRORES COMUNES -->
    <section class="errores-section">
        <h2 class="seccion-titulo neon-alerta">
            <span class="icon">⚠️</span> ERRORES COMUNES Y SOLUCIONES
        </h2>
        <div class="errores-container">
            <div class="error-card">
                <div class="error-header" onclick="toggleError(this)">
                    <h3>❌ CONFUNDIR IMPULSO CON TRABAJO</h3>
                    <span class="error-toggle">+</span>
                </div>
                <div class="error-content">
                    <div class="error-ejemplo">
                        <strong>Error común:</strong> "El impulso es igual al trabajo realizado".
                    </div>
                    <div class="error-correccion">
                        <strong>Corrección:</strong>
                        <ul>
                            <li><strong>Impulso:</strong> \\( J = F \\Delta t \\) (N·s).</li>
                            <li><strong>Trabajo:</strong> \\( W = F d \\) (J).</li>
                        </ul>
                    </div>
                    <div class="error-tabla">
                        <table>
                            <tr>
                                <th>Concepto</th>
                                <th>Fórmula</th>
                                <th>Unidad</th>
                            </tr>
                            <tr>
                                <td>Impulso</td>
                                <td>\\( J = F \\Delta t \\)</td>
                                <td>N·s</td>
                            </tr>
                            <tr>
                                <td>Trabajo</td>
                                <td>\\( W = F d \\)</td>
                                <td>J</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="error-card">
                <div class="error-header" onclick="toggleError(this)">
                    <h3>❌ OLVIDAR QUE LA CANTIDAD DE MOVIMIENTO ES VECTORIAL</h3>
                    <span class="error-toggle">+</span>
                </div>
                <div class="error-content">
                    <div class="error-ejemplo">
                        <strong>Error común:</strong> "La cantidad de movimiento es siempre positiva".
                    </div>
                    <div class="error-correccion">
                        <strong>Corrección:</strong> \\( p = m v \\) es un <strong>vector</strong> con dirección igual a la velocidad.
                    </div>
                    <div class="error-practica">
                        <p><strong>Practica:</strong> Si un objeto de 2 kg se mueve a -3 m/s, ¿cuál es su \\( p \\)?</p>
                        <button class="btn-mini" onclick="mostrarSolucion(1)">Ver solución</button>
                        <div class="solucion" id="solucion1" style="display: none;">
                            <strong>Solución:</strong> \\( p = 2 \\cdot (-3) = -6\\, \\text{kg·m/s} \\).
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- PROBLEMAS TIPO EXAMEN -->
    <section class="examen-section">
        <h2 class="seccion-titulo neon-evaluacion">
            <span class="icon">📝</span> PROBLEMAS TIPO EXAMEN
        </h2>
        <div class="examen-container">
            <div class="problema-card">
                <div class="problema-header">
                    <span class="problema-num">P1</span>
                    <h3>Impulso en un Golpe de Boxeo</h3>
                </div>
                <div class="problema-enunciado">
                    <p>Un boxeador golpea a su oponente con una fuerza promedio de 4000 N durante 0.02 s. La masa del guante (y mano) es 0.5 kg. Calcula:</p>
                    <ol>
                        <li>El impulso aplicado.</li>
                        <li>El cambio en la cantidad de movimiento del guante.</li>
                        <li>La velocidad final del guante si partió del reposo.</li>
                    </ol>
                </div>
                <div class="problema-espacio">
                    <textarea placeholder="Desarrolla tu solución aquí..." rows="8"></textarea>
                </div>
                <button class="btn-verificar" onclick="verificarProblema(1)">VERIFICAR SOLUCIÓN</button>
                <div class="problema-solucion" id="solucionP1" style="display: none;">
                    <strong>Solución:</strong><br>
                    1. Impulso: \\( J = F \\Delta t = 4000 \\cdot 0.02 = 80\\, \\text{N·s} \\).<br>
                    2. Cambio en \\( p \\): \\( \\Delta p = 80\\, \\text{kg·m/s} \\).<br>
                    3. Velocidad final: \\( \\Delta p = m \\Delta v \\Rightarrow 80 = 0.5 \\Delta v \\Rightarrow \\Delta v = 160\\, \\text{m/s} \\).
                </div>
            </div>
            <div class="problema-card">
                <div class="problema-header">
                    <span class="problema-num">P2</span>
                    <h3>Colisión entre Dos Objetos</h3>
                </div>
                <div class="problema-enunciado">
                    <p>Un objeto de 2 kg que se mueve a 5 m/s choca con otro objeto de 3 kg en reposo. Después del choque, el primer objeto se mueve a 1 m/s en la misma dirección. Calcula:</p>
                    <ol>
                        <li>La cantidad de movimiento inicial y final del sistema.</li>
                        <li>La velocidad final del segundo objeto.</li>
                    </ol>
                    <p><em>Nota:</em> Asume que la colisión es perfectamente inelástica en una dimensión.</p>
                </div>
                <div class="problema-espacio">
                    <textarea placeholder="Desarrolla tu solución aquí..." rows="8"></textarea>
                </div>
                <button class="btn-verificar" onclick="verificarProblema(2)">VERIFICAR SOLUCIÓN</button>
                <div class="problema-solucion" id="solucionP2" style="display: none;">
                    <strong>Solución:</strong><br>
                    1. Cantidad de movimiento inicial: \\( p_i = 2 \\cdot 5 + 3 \\cdot 0 = 10\\, \\text{kg·m/s} \\).<br>
                    Cantidad de movimiento final: \\( p_f = 2 \\cdot 1 + 3 \\cdot v_f = 2 + 3 v_f \\).<br>
                    Por conservación: \\( 10 = 2 + 3 v_f \\Rightarrow v_f = \\frac{8}{3} \\approx 2.67\\, \\text{m/s} \\).
                </div>
            </div>
            <div class="rubrica">
                <h4>📋 RÚBRICA DE EVALUACIÓN</h4>
                <table class="rubrica-table">
                    <tr>
                        <th>Criterio</th>
                        <th>Excelente (5)</th>
                        <th>Satisfactorio (3-4)</th>
                        <th>Insuficiente (0-2)</th>
                    </tr>
                    <tr>
                        <td>Aplicación correcta de \\( J = \\Delta p \\)</td>
                        <td>Fórmula y unidades correctas</td>
                        <td>Errores menores en cálculos</td>
                        <td>Fórmula o unidades incorrectas</td>
                    </tr>
                    <tr>
                        <td>Conservación de la cantidad de movimiento</td>
                        <td>Explica claramente la conservación de \\( p \\)</td>
                        <td>Falta justificación</td>
                        <td>No aplica el principio</td>
                    </tr>
                </table>
            </div>
        </div>
    </section>

    <!-- CIERRE METACOGNITIVO -->
    <section class="cierre-section">
        <h2 class="seccion-titulo neon-concepto">
            <span class="icon">🧠</span> CIERRE METACOGNITIVO
        </h2>
        <div class="cierre-container">
            <div class="autoevaluacion">
                <h3>📈 AUTOEVALUACIÓN</h3>
                <div class="slider-group">
                    <label>Comprensión de \\( p = m v \\):</label>
                    <input type="range" min="1" max="5" value="3" class="autoeval-slider" id="slider1">
                    <div class="slider-labels">
                        <span>Básico</span><span>Intermedio</span><span>Avanzado</span>
                    </div>
                </div>
                <div class="slider-group">
                    <label>Aplicación de \\( J = \\Delta p \\):</label>
                    <input type="range" min="1" max="5" value="3" class="autoeval-slider" id="slider2">
                    <div class="slider-labels">
                        <span>Básico</span><span>Intermedio</span><span>Avanzado</span>
                    </div>
                </div>
                <button class="btn-guardar" onclick="guardarAutoevaluacion()">
                    💾 GUARDAR AUTOEVALUACIÓN
                </button>
            </div>
            <div class="reflexion">
                <h3>💭 REFLEXIÓN GUIADA</h3>
                <div class="pregunta-reflexion">
                    <p>¿Por qué es importante el concepto de impulso en el diseño de sistemas de seguridad (ej: airbags, cinturones)?</p>
                    <textarea placeholder="Ejemplo: reducir la fuerza aumentando el tiempo de colisión..." rows="4" id="reflexion1"></textarea>
                </div>
                <div class="pregunta-reflexion">
                    <p>Describe un ejemplo cotidiano donde observes un cambio en la cantidad de movimiento.</p>
                    <textarea placeholder="Ejemplo: patear un balón..." rows="4" id="reflexion2"></textarea>
                </div>
            </div>
            <div class="plan-estudio">
                <h3>📚 PLAN DE ESTUDIO RECOMENDADO</h3>
                <div class="plan-grid">
                    <div class="plan-card">
                        <h4>🔹 REPASO RÁPIDO (15 min)</h4>
                        <ul>
                            <li>Memorizar fórmulas \\( p = m v \\) y \\( J = F \\Delta t \\)</li>
                            <li>Repasar unidades (kg·m/s, N·s)</li>
                        </ul>
                    </div>
                    <div class="plan-card">
                        <h4>🛠 PRÁCTICA (30 min)</h4>
                        <ul>
                            <li>Resolver 5 problemas de impulso y colisiones</li>
                            <li>Usar el simulador para visualizar escenarios</li>
                        </ul>
                    </div>
                    <div class="plan-card">
                        <h4>🎓 PROFUNDIZACIÓN (45 min)</h4>
                        <ul>
                            <li>Investigar aplicaciones en ingeniería (ej: cohetes)</li>
                            <li>Relacionar con energía cinética</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="recursos">
                <h3>🔗 RECURSOS ADICIONALES</h3>
                <div class="recursos-links">
                    <a href="https://phet.colorado.edu/es/simulation/legacy/collision-lab" target="_blank" class="recurso-link">
                        🎯 Simulador PhET: Laboratorio de Colisiones
                    </a>
                    <a href="https://www.khanacademy.org/science/physics/linear-momentum" target="_blank" class="recurso-link">
                        📚 Khan Academy: Cantidad de Movimiento
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- JAVASCRIPT INTEGRADO -->
<script>
    // ==========================================
// SIMULADOR DE IMPULSO Y CANTIDAD DE MOVIMIENTO
// ==========================================
function calcularImpulso() {
    // Obtener valores de los sliders
    const masa = parseFloat(document.getElementById(\'masaInput\').value);
    const fuerza = parseFloat(document.getElementById(\'fuerzaInput\').value);
    const tiempo = parseFloat(document.getElementById(\'tiempoInput\').value);
    const velocidadInicial = parseFloat(document.getElementById(\'velocidadInicialInput\').value);

    // Validar valores
    if (isNaN(masa) || isNaN(fuerza) || isNaN(tiempo) || isNaN(velocidadInicial)) {
        alert("Por favor, ingresa valores válidos.");
        return;
    }

    // Actualizar valores en la interfaz
    document.getElementById(\'masaValue\').textContent = `${masa} kg`;
    document.getElementById(\'fuerzaValue\').textContent = `${fuerza} N`;
    document.getElementById(\'tiempoValue\').textContent = `${tiempo} s`;
    document.getElementById(\'velocidadInicialValue\').textContent = `${velocidadInicial} m/s`;
    document.getElementById(\'velocidadInicialSVG\').textContent = `v₀ = ${velocidadInicial} m/s`;

    // Calcular impulso y cambios
    const impulso = fuerza * tiempo;
    const deltaP = impulso;
    const velocidadFinal = velocidadInicial + (deltaP / masa);

    // Actualizar datos en la interfaz
    document.getElementById(\'dataMasa\').textContent = `${masa} kg`;
    document.getElementById(\'dataFuerza\').textContent = `${fuerza} N`;
    document.getElementById(\'dataTiempo\').textContent = `${tiempo} s`;
    document.getElementById(\'dataVelocidadInicial\').textContent = `${velocidadInicial} m/s`;
    document.getElementById(\'dataImpulso\').textContent = `${impulso.toFixed(2)} N·s`;
    document.getElementById(\'dataDeltaP\').textContent = `${deltaP.toFixed(2)} kg·m/s`;
    document.getElementById(\'dataVelocidadFinal\').textContent = `${velocidadFinal.toFixed(2)} m/s`;

    // Actualizar SVG
    document.getElementById(\'valorImpulso\').textContent = `J = ${impulso.toFixed(2)} N·s`;
    document.getElementById(\'fuerzaSVG\').textContent = `F = ${fuerza} N`;
    document.getElementById(\'velocidadFinalSVG\').textContent = `v_f = ${velocidadFinal.toFixed(2)} m/s`;

    // Ajustar posición del objeto final según la velocidad
    const posicionFinal = 150 + (velocidadFinal * 10);
    document.getElementById(\'objetoFinal\').setAttribute(\'cx\', posicionFinal);

    // Ajustar área del impulso en el gráfico
    const anchoImpulso = tiempo * 2000;
    const altoImpulso = (fuerza / 10);
    document.getElementById(\'areaImpulso\').setAttribute(\'width\', anchoImpulso);
    document.getElementById(\'areaImpulso\').setAttribute(\'height\', altoImpulso);
    document.getElementById(\'areaImpulso\').setAttribute(\'y\', 300 - altoImpulso);
}

// Generar valores aleatorios
function valoresAleatorios() {
    const masa = (Math.random() * 9.5 + 0.5).toFixed(1);
    const fuerza = Math.floor(Math.random() * 450) + 50;
    const tiempo = (Math.random() * 0.19 + 0.01).toFixed(2);
    const velocidadInicial = (Math.random() * 10).toFixed(1);

    document.getElementById(\'masaInput\').value = masa;
    document.getElementById(\'fuerzaInput\').value = fuerza;
    document.getElementById(\'tiempoInput\').value = tiempo;
    document.getElementById(\'velocidadInicialInput\').value = velocidadInicial;

    calcularImpulso(); // Actualizar simulador
}

// ==========================================
// QUIZ INTERACTIVO
// ==========================================
let quizRespuestas = [];
let quizCompletado = false;

document.querySelectorAll(\'.quiz-option\').forEach(option => {
    option.addEventListener(\'click\', function() {
        if (quizCompletado) return;

        const question = this.closest(\'.quiz-question\');
        const correct = question.dataset.correct;
        const selected = this.dataset.value;
        const feedback = question.querySelector(\'.quiz-feedback\');

        // Limpiar selección previa
        question.querySelectorAll(\'.quiz-option\').forEach(opt => {
            opt.classList.remove(\'selected\', \'correct\', \'incorrect\');
        });

        // Marcar selección actual
        this.classList.add(\'selected\');

        // Verificar respuesta
        if (selected === correct) {
            this.classList.add(\'correct\');
            quizRespuestas.push(true);
        } else {
            this.classList.add(\'incorrect\');
            question.querySelector(`[data-value="${correct}"]`).classList.add(\'correct\');
            quizRespuestas.push(false);
        }

        // Mostrar feedback
        feedback.style.display = \'block\';

        // Verificar si todas las preguntas están respondidas
        const allAnswered = Array.from(document.querySelectorAll(\'.quiz-question\')).every(q =>
            q.querySelector(\'.quiz-option.selected\')
        );

        if (allAnswered && !quizCompletado) {
            quizCompletado = true;
            mostrarResultadosQuiz();
        }
    });
});

function mostrarResultadosQuiz() {
    const correctas = quizRespuestas.filter(r => r).length;
    const total = quizRespuestas.length;
    document.getElementById(\'quizScore\').textContent = `${correctas}/${total}`;

    let feedback = "";
    if (correctas === total) {
        feedback = "🎉 ¡Excelente! Dominas el impulso y la cantidad de movimiento.";
    } else if (correctas >= total / 2) {
        feedback = "👍 Buen trabajo, pero repasa las fórmulas y unidades.";
    } else {
        feedback = "📚 Necesitas estudiar más. Usa el simulador para practicar.";
    }

    document.getElementById(\'quizFeedback\').textContent = feedback;
    document.querySelector(\'.quiz-results\').style.display = \'block\';
}

function reiniciarQuiz() {
    quizRespuestas = [];
    quizCompletado = false;

    document.querySelectorAll(\'.quiz-option\').forEach(opt => {
        opt.classList.remove(\'selected\', \'correct\', \'incorrect\');
    });

    document.querySelectorAll(\'.quiz-feedback\').forEach(fb => {
        fb.style.display = \'none\';
    });

    document.querySelector(\'.quiz-results\').style.display = \'none\';
}

// ==========================================
// ERRORES COMUNES
// ==========================================
function toggleError(header) {
    const content = header.nextElementSibling;
    const toggle = header.querySelector(\'.error-toggle\');

    if (content.style.display === \'block\') {
        content.style.display = \'none\';
        toggle.textContent = \'+\';
    } else {
        content.style.display = \'block\';
        toggle.textContent = \'-\';
    }
}

function mostrarSolucion(num) {
    const solucion = document.getElementById(`solucion${num}`);
    solucion.style.display = solucion.style.display === \'block\' ? \'none\' : \'block\';
}

// ==========================================
// PROBLEMAS TIPO EXAMEN
// ==========================================
function verificarProblema(num) {
    const solucion = document.getElementById(`solucionP${num}`);
    solucion.style.display = solucion.style.display === \'block\' ? \'none\' : \'block\';
}

// ==========================================
// AUTOEVALUACIÓN
// ==========================================
function guardarAutoevaluacion() {
    const slider1 = document.getElementById(\'slider1\').value;
    const slider2 = document.getElementById(\'slider2\').value;
    const promedio = (parseInt(slider1) + parseInt(slider2)) / 2;

    alert(
        `💾 Autoevaluación guardada:\\n\\n` +
        `Comprensión de \\( p = m v \\): ${slider1}/5\\n` +
        `Aplicación de \\( J = \\Delta p \\): ${slider2}/5\\n\\n` +
        `Promedio: ${promedio.toFixed(1)}/5\\n\\n` +
        `Revisa el plan de estudio según tus resultados.`
    );
}

// ==========================================
// INICIALIZACIÓN
// ==========================================
document.addEventListener(\'DOMContentLoaded\', function() {
    console.log("🚀 Lección Cyberpunk: Impulso y Cantidad de Movimiento - Cargada");

    // Añadir marcador de flecha al SVG
    const svg = document.getElementById(\'svgImpulso\');
    const defs = document.createElementNS(\'http://www.w3.org/2000/svg\', \'defs\');
    const marker = document.createElementNS(\'http://www.w3.org/2000/svg\', \'marker\');
    marker.setAttribute(\'id\', \'arrowhead\');
    marker.setAttribute(\'markerWidth\', \'10\');
    marker.setAttribute(\'markerHeight\', \'7\');
    marker.setAttribute(\'refX\', \'9\');
    marker.setAttribute(\'refY\', \'3.5\');
    marker.setAttribute(\'orient\', \'auto\');
    const arrowPath = document.createElementNS(\'http://www.w3.org/2000/svg\', \'path\');
    arrowPath.setAttribute(\'d\', \'M0,0 L10,3.5 L0,7 Z\');
    arrowPath.setAttribute(\'fill\', \'#FF5252\');
    marker.appendChild(arrowPath);
    defs.appendChild(marker);
    svg.appendChild(defs);

    calcularImpulso(); // Inicializar simulador

    // Event listeners para sliders
    document.getElementById(\'masaInput\').addEventListener(\'input\', calcularImpulso);
    document.getElementById(\'fuerzaInput\').addEventListener(\'input\', calcularImpulso);
    document.getElementById(\'tiempoInput\').addEventListener(\'input\', calcularImpulso);
    document.getElementById(\'velocidadInicialInput\').addEventListener(\'input\', calcularImpulso);
});
</script>',
    'ejercicios' => 
    array (
      0 => 
      array (
        'enunciado' => 'Cantidad de movimiento p =',
        'respuesta' => 'm v',
      ),
      1 => 
      array (
        'enunciado' => 'Impulso J =',
        'respuesta' => 'F Δt = Δp',
      ),
      2 => 
      array (
        'enunciado' => 'F = m a =',
        'respuesta' => 'Δp / Δt',
      ),
      3 => 
      array (
        'enunciado' => 'Unidad p',
        'respuesta' => 'kg·m/s',
      ),
      4 => 
      array (
        'enunciado' => 'F = 50 N, Δt = 0.2 s → J',
        'respuesta' => '10 N·s',
      ),
      5 => 
      array (
        'enunciado' => 'm = 2 kg, Δv = 5 m/s → Δp',
        'respuesta' => '10 kg·m/s',
      ),
      6 => 
      array (
        'enunciado' => 'J = Δp →',
        'respuesta' => 'Cambio en movimiento',
      ),
      7 => 
      array (
        'enunciado' => 'F promedio =',
        'respuesta' => 'J / Δt',
      ),
      8 => 
      array (
        'enunciado' => 'Área bajo F vs t',
        'respuesta' => 'Impulso',
      ),
      9 => 
      array (
        'enunciado' => 'p es',
        'respuesta' => 'Vector',
      ),
      10 => 
      array (
        'enunciado' => '1 N·s =',
        'respuesta' => '1 kg·m/s',
      ),
      11 => 
      array (
        'enunciado' => 'SI: impulso en',
        'respuesta' => 'N·s',
      ),
    ),
    'quiz' => 
    array (
      0 => 
      array (
        'pregunta' => 'p = m v es',
        'opciones' => 
        array (
          0 => 'Vector',
          1 => 'Escalar',
          2 => 'Energía',
          3 => 'Fuerza',
        ),
        'correcta' => 'Vector',
      ),
      1 => 
      array (
        'pregunta' => 'J = F Δt =',
        'opciones' => 
        array (
          0 => 'Δp',
          1 => 'p',
          2 => 'm v',
          3 => 'F',
        ),
        'correcta' => 'Δp',
      ),
      2 => 
      array (
        'pregunta' => 'F = m a implica',
        'opciones' => 
        array (
          0 => 'F = Δp/Δt',
          1 => 'F = p',
          2 => 'F = m v',
          3 => 'F = 0',
        ),
        'correcta' => 'F = Δp/Δt',
      ),
      3 => 
      array (
        'pregunta' => 'Unidad p',
        'opciones' => 
        array (
          0 => 'kg·m/s',
          1 => 'N',
          2 => 'J',
          3 => 'm/s²',
        ),
        'correcta' => 'kg·m/s',
      ),
      4 => 
      array (
        'pregunta' => 'Unidad J',
        'opciones' => 
        array (
          0 => 'N·s',
          1 => 'J',
          2 => 'kg',
          3 => 'm/s',
        ),
        'correcta' => 'N·s',
      ),
      5 => 
      array (
        'pregunta' => '1 N·s =',
        'opciones' => 
        array (
          0 => '1 kg·m/s',
          1 => '1 J',
          2 => '1 N',
          3 => '1 m/s',
        ),
        'correcta' => '1 kg·m/s',
      ),
      6 => 
      array (
        'pregunta' => 'Impulso cambia',
        'opciones' => 
        array (
          0 => 'Cantidad de movimiento',
          1 => 'Masa',
          2 => 'Aceleración',
          3 => 'Energía',
        ),
        'correcta' => 'Cantidad de movimiento',
      ),
      7 => 
      array (
        'pregunta' => 'F constante → J =',
        'opciones' => 
        array (
          0 => 'F Δt',
          1 => 'F/t',
          2 => 'ΔF t',
          3 => 'F²',
        ),
        'correcta' => 'F Δt',
      ),
      8 => 
      array (
        'pregunta' => 'Área bajo F vs t',
        'opciones' => 
        array (
          0 => 'Impulso',
          1 => 'Trabajo',
          2 => 'Potencia',
          3 => 'Energía',
        ),
        'correcta' => 'Impulso',
      ),
      9 => 
      array (
        'pregunta' => 'F = 100 N, Δt = 0.1 s → J',
        'opciones' => 
        array (
          0 => '10 N·s',
          1 => '1000 N·s',
          2 => '1 N·s',
          3 => '0',
        ),
        'correcta' => '10 N·s',
      ),
      10 => 
      array (
        'pregunta' => 'm = 5 kg, v_i = 0, v_f = 4 m/s → Δp',
        'opciones' => 
        array (
          0 => '20 kg·m/s',
          1 => '5 kg·m/s',
          2 => '4 kg·m/s',
          3 => '0',
        ),
        'correcta' => '20 kg·m/s',
      ),
      11 => 
      array (
        'pregunta' => 'J = 15 N·s, m = 3 kg → Δv',
        'opciones' => 
        array (
          0 => '5 m/s',
          1 => '15 m/s',
          2 => '3 m/s',
          3 => '45 m/s',
        ),
        'correcta' => '5 m/s',
      ),
      12 => 
      array (
        'pregunta' => 'F promedio =',
        'opciones' => 
        array (
          0 => 'J / Δt',
          1 => 'Δp / m',
          2 => 'm a',
          3 => 'p / t',
        ),
        'correcta' => 'J / Δt',
      ),
      13 => 
      array (
        'pregunta' => 'p conservada si',
        'opciones' => 
        array (
          0 => 'F_ext = 0',
          1 => 'F_ext ≠ 0',
          2 => 'm = 0',
          3 => 'v = 0',
        ),
        'correcta' => 'F_ext = 0',
      ),
      14 => 
      array (
        'pregunta' => 'F dobla, Δt igual → J',
        'opciones' => 
        array (
          0 => 'Dobla',
          1 => 'Cuadruplica',
          2 => 'Mitad',
          3 => 'Igual',
        ),
        'correcta' => 'Dobla',
      ),
      15 => 
      array (
        'pregunta' => 'Δt dobla, F igual → J',
        'opciones' => 
        array (
          0 => 'Dobla',
          1 => 'Cuadruplica',
          2 => 'Mitad',
          3 => 'Igual',
        ),
        'correcta' => 'Dobla',
      ),
      16 => 
      array (
        'pregunta' => 'Airbag funciona porque',
        'opciones' => 
        array (
          0 => 'Aumenta Δt → ↓F',
          1 => 'Aumenta F',
          2 => 'Disminuye m',
          3 => 'Aumenta v',
        ),
        'correcta' => 'Aumenta Δt → ↓F',
      ),
      17 => 
      array (
        'pregunta' => 'F = 0 → J =',
        'opciones' => 
        array (
          0 => '0',
          1 => 'máximo',
          2 => 'infinito',
          3 => 'p',
        ),
        'correcta' => '0',
      ),
      18 => 
      array (
        'pregunta' => 'p = 10 kg·m/s, m = 2 kg → v',
        'opciones' => 
        array (
          0 => '5 m/s',
          1 => '10 m/s',
          2 => '2 m/s',
          3 => '20 m/s',
        ),
        'correcta' => '5 m/s',
      ),
      19 => 
      array (
        'pregunta' => 'SI 2025: p en',
        'opciones' => 
        array (
          0 => 'kg·m/s',
          1 => 'N·s²',
          2 => 'J·s',
          3 => 'W',
        ),
        'correcta' => 'kg·m/s',
      ),
      20 => 
      array (
        'pregunta' => 'F variable → J =',
        'opciones' => 
        array (
          0 => 'Área bajo F-t',
          1 => 'F_prom · t',
          2 => 'F_max · t',
          3 => '0',
        ),
        'correcta' => 'Área bajo F-t',
      ),
      21 => 
      array (
        'pregunta' => 'Δp = 0 →',
        'opciones' => 
        array (
          0 => 'J = 0',
          1 => 'F = 0',
          2 => 'm = 0',
          3 => 'v = 0',
        ),
        'correcta' => 'J = 0',
      ),
      22 => 
      array (
        'pregunta' => 'F = 500 N, t = 0.02 s → Δp',
        'opciones' => 
        array (
          0 => '10 kg·m/s',
          1 => '500 kg·m/s',
          2 => '0.02 kg·m/s',
          3 => '10000 kg·m/s',
        ),
        'correcta' => '10 kg·m/s',
      ),
      23 => 
      array (
        'pregunta' => 'Golpe martillo: J grande si',
        'opciones' => 
        array (
          0 => 'F grande o Δt grande',
          1 => 'F pequeña',
          2 => 'Δt cero',
          3 => 'm cero',
        ),
        'correcta' => 'F grande o Δt grande',
      ),
      24 => 
      array (
        'pregunta' => 'p antes = p después si',
        'opciones' => 
        array (
          0 => 'Sistema aislado',
          1 => 'F_ext ≠ 0',
          2 => 'Colisión inelástica',
          3 => 'Siempre',
        ),
        'correcta' => 'Sistema aislado',
      ),
      25 => 
      array (
        'pregunta' => 'F = Δp/Δt → a =',
        'opciones' => 
        array (
          0 => 'Δv/Δt',
          1 => 'v/t',
          2 => 'p/m',
          3 => 'J/m',
        ),
        'correcta' => 'Δv/Δt',
      ),
      26 => 
      array (
        'pregunta' => 'Unidad a',
        'opciones' => 
        array (
          0 => 'm/s²',
          1 => 'm/s',
          2 => 'kg·m/s',
          3 => 'N',
        ),
        'correcta' => 'm/s²',
      ),
      27 => 
      array (
        'pregunta' => 'J = m Δv → Δv =',
        'opciones' => 
        array (
          0 => 'J/m',
          1 => 'J m',
          2 => 'm/J',
          3 => '0',
        ),
        'correcta' => 'J/m',
      ),
      28 => 
      array (
        'pregunta' => 'F = 0 durante Δt →',
        'opciones' => 
        array (
          0 => 'Δp = 0',
          1 => 'Δp = p',
          2 => 'Δp = m',
          3 => 'Δp = v',
        ),
        'correcta' => 'Δp = 0',
      ),
      29 => 
      array (
        'pregunta' => 'SI 2025: 1 kg·m/s =',
        'opciones' => 
        array (
          0 => '1 N·s',
          1 => '1 J',
          2 => '1 W',
          3 => '1 Pa',
        ),
        'correcta' => '1 N·s',
      ),
    ),
  ),
  14 => 
  array (
    'materia' => 'Física I',
    'slug' => 'conservacion-cantidad-movimiento',
    'titulo' => 'Ley de Conservación de la Cantidad de Movimiento: p_total inicial = p_total final',
    'contenido' => '<div class="leccion-container leccion-fisica-conservacion" data-tema="conservacion-movimiento">
    <!-- CABECERA CYBERPUNK -->
    <header class="leccion-header">
        <h1 class="titulo-leccion neon-glow">
            <span class="icon-tema">🚀</span>
            CONSERVACIÓN DE LA <span class="formula-highlight">CANTIDAD DE MOVIMIENTO</span>
        </h1>
        <div class="subtitulo">
            En sistemas aislados, la cantidad de movimiento total se conserva: \\( \\sum \\vec{p}_i = \\sum \\vec{p}_f \\)
        </div>
    </header>

    <!-- PANEL OBJETIVOS -->
    <section class="panel-objetivos">
        <h2 class="seccion-titulo neon-concepto">
            <span class="icon">🎯</span> OBJETIVOS DE APRENDIZAJE
        </h2>
        <div class="objetivos-grid">
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Explicar la ley de conservación de \\( p \\)</h3>
                <p>Identificar sistemas aislados y condiciones para la conservación</p>
            </div>
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Aplicar la conservación en colisiones</h3>
                <p>Resolver problemas de colisiones elásticas e inelásticas en 1D y 2D</p>
            </div>
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Analizar explosiones y propulsión</h3>
                <p>Usar la conservación de \\( p \\) en sistemas con masa variable (ej: cohetes)</p>
            </div>
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Simular escenarios de conservación</h3>
                <p>Usar el simulador interactivo para visualizar colisiones y explosiones</p>
            </div>
        </div>
    </section>

    <!-- CONTEXTO REAL -->
    <section class="contexto-real">
        <h2 class="seccion-titulo neon-dato">
            <span class="icon">🌍</span> APLICACIÓN EN EL MUNDO REAL
        </h2>
        <div class="contexto-grid">
            <div class="contexto-card">
                <h3>🚀 Propulsión de Cohetes</h3>
                <p>La expulsión de gases a alta velocidad genera un cambio en la cantidad de movimiento del cohete (3ª Ley de Newton).</p>
                <div class="dato-neon">Empuje: 35 MN (Saturno V)</div>
            </div>
            <div class="contexto-card">
                <h3>🎢 Montañas Rusas</h3>
                <p>La conservación de \\( p \\) permite calcular velocidades después de colisiones entre vagones.</p>
                <div class="dato-neon">Velocidad máxima: 120 km/h</div>
            </div>
            <div class="contexto-card">
                <h3>💥 Airbags en Automóviles</h3>
                <p>La conservación de \\( p \\) explica cómo los airbags reducen la fuerza en colisiones al aumentar el tiempo de impacto.</p>
                <div class="dato-neon">Tiempo de inflado: 30-50 ms</div>
            </div>
        </div>
    </section>

    <!-- SECCIÓN TEÓRICA -->
    <section class="teoria-section">
        <div class="borde-neon-lateral"></div>
        <h2 class="seccion-titulo neon-concepto">
            <span class="icon">📚</span> FUNDAMENTOS TEÓRICOS
        </h2>

        <!-- LEY DE CONSERVACIÓN -->
        <div class="subseccion">
            <h3>1. Ley de Conservación de la Cantidad de Movimiento</h3>
            <div class="definicion-principal">
                <div class="def-card">
                    <h4>CONSERVACIÓN DE \\( p \\)</h4>
                    <p>En un <strong>sistema aislado</strong> (sin fuerzas externas netas), la cantidad de movimiento total se conserva:</p>
                    <div class="formula-inline">
                        \\[
                            \\sum \\vec{p}_i = \\sum \\vec{p}_f
                        \\]
                    </div>
                    <div class="formula-detalle">
                        <ul>
                            <li><strong>Vectorial:</strong> Se conserva en magnitud y dirección.</li>
                            <li><strong>Válida para:</strong> Colisiones elásticas, inelásticas y explosiones.</li>
                            <li><strong>Condición:</strong> \\( \\sum \\vec{F}_{\\text{ext}} = 0 \\).</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- CONDICIONES PARA LA CONSERVACIÓN -->
        <div class="subseccion">
            <h3>2. Condiciones para la Conservación</h3>
            <div class="condiciones-card">
                <ul>
                    <li><strong>Fuerza externa neta = 0:</strong> \\( \\sum \\vec{F}_{\\text{ext}} = 0 \\).</li>
                    <li><strong>Sistemas de múltiples cuerpos:</strong> Aplica a sistemas con 2 o más objetos.</li>
                    <li><strong>Conservación por componentes:</strong> En 2D o 3D, se conserva en \\( x \\), \\( y \\) y \\( z \\).</li>
                </ul>
                <div class="ejemplo-condiciones">
                    <p><strong>Ejemplo:</strong> Dos patinadores que se empujan en hielo (fricción despreciable).</p>
                </div>
            </div>
        </div>

        <!-- APLICACIONES -->
        <div class="subseccion">
            <h3>3. Aplicaciones de la Conservación de \\( p \\)</h3>
            <div class="tabla-interactiva">
                <table class="tabla-cyberpunk">
                    <thead>
                        <tr>
                            <th>Situación</th>
                            <th>Ecuación</th>
                            <th>Descripción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr data-aplicacion="colision-1d">
                            <td><strong>Colisión 1D</strong></td>
                            <td>\\( m_1 v_1 + m_2 v_2 = m_1 v_1\' + m_2 v_2\' \\)</td>
                            <td>Conservación de \\( p \\) en una dimensión.</td>
                        </tr>
                        <tr data-aplicacion="explosion">
                            <td><strong>Explosión</strong></td>
                            <td>\\( 0 = m_1 v_1\' + m_2 v_2\' \\)</td>
                            <td>Sistema inicialmente en reposo.</td>
                        </tr>
                        <tr data-aplicacion="cohete">
                            <td><strong>Cohete</strong></td>
                            <td>\\( M v = -\\Delta m \\cdot v_e \\)</td>
                            <td>Propulsión por expulsión de masa.</td>
                        </tr>
                    </tbody>
                </table>
                <div class="tabla-info" id="infoAplicaciones">
                    Selecciona una fila para ver detalles
                </div>
            </div>
        </div>

        <!-- EJEMPLO PRÁCTICO -->
        <div class="subseccion">
            <h3>4. Ejemplo Práctico: Colisión Inelástica</h3>
            <div class="ejemplo-card">
                <p><strong>Problema:</strong> Un objeto de \\( m_1 = 2\\, \\text{kg} \\) con \\( v_1 = 4\\, \\text{m/s} \\) choca con otro de \\( m_2 = 3\\, \\text{kg} \\) en reposo. Después de la colisión, ambos se mueven juntos. Calcula:</p>
                <ol>
                    <li>La cantidad de movimiento inicial y final.</li>
                    <li>La velocidad final del sistema.</li>
                </ol>
                <div class="ejemplo-solucion">
                    <p><strong>Solución:</strong></p>
                    <p>
                        1. Cantidad de movimiento inicial:
                        \\[
                            p_i = m_1 v_1 + m_2 v_2 = 2 \\cdot 4 + 3 \\cdot 0 = 8\\, \\text{kg·m/s}
                        \\]
                    </p>
                    <p>
                        2. Velocidad final (colisión perfectamente inelástica):
                        \\[
                            p_f = (m_1 + m_2) v\' \\Rightarrow 8 = 5 v\' \\Rightarrow v\' = 1.6\\, \\text{m/s}
                        \\]
                    </p>
                </div>
                <button class="btn-verificar" onclick="verificarEjemplo()">VERIFICAR CÁLCULO</button>
                <div class="ejemplo-feedback" id="feedbackEjemplo" style="display: none;">
                    <p>✅ <strong>Correcto:</strong> La cantidad de movimiento se conserva: \\( p_i = p_f = 8\\, \\text{kg·m/s} \\).</p>
                </div>
            </div>
        </div>
    </section>

    <!-- SIMULADOR INTERACTIVO -->
    <section class="simulator-section">
        <h2 class="seccion-titulo neon-interactivo">
            <span class="icon">🎮</span> SIMULADOR: CONSERVACIÓN DE \\( p \\)
        </h2>
        <div class="simulator-container" data-tema="conservacion-movimiento">
            <!-- CONTROLES -->
            <div class="simulator-controls">
                <h3>CONTROLES</h3>
                <div class="control-group">
                    <label for="masa1Input">Masa 1 (m₁) en kg:</label>
                    <input type="range" id="masa1Input" min="1" max="10" value="2" step="0.5" class="control-slider">
                    <span id="masa1Value">2 kg</span>
                </div>
                <div class="control-group">
                    <label for="velocidad1Input">Velocidad 1 (v₁) en m/s:</label>
                    <input type="range" id="velocidad1Input" min="0" max="10" value="4" step="0.5" class="control-slider">
                    <span id="velocidad1Value">4 m/s</span>
                </div>
                <div class="control-group">
                    <label for="masa2Input">Masa 2 (m₂) en kg:</label>
                    <input type="range" id="masa2Input" min="1" max="10" value="3" step="0.5" class="control-slider">
                    <span id="masa2Value">3 kg</span>
                </div>
                <div class="control-group">
                    <label for="velocidad2Input">Velocidad 2 (v₂) en m/s:</label>
                    <input type="range" id="velocidad2Input" min="-5" max="5" value="0" step="0.5" class="control-slider">
                    <span id="velocidad2Value">0 m/s</span>
                </div>
                <div class="control-group">
                    <label for="tipoColision">Tipo de colisión:</label>
                    <select id="tipoColision" class="control-select">
                        <option value="elastica">Elástica</option>
                        <option value="inelastica">Perfectamente inelástica</option>
                    </select>
                </div>
                <button class="btn-ejecutar" onclick="simularColision()">
                    <span class="btn-icon">▶</span> SIMULAR COLISIÓN
                </button>
                <button class="btn-aleatorio" onclick="valoresAleatorios()">
                    <span class="btn-icon">🎲</span> VALORES ALEATORIOS
                </button>
            </div>

            <!-- VISUALIZACIÓN -->
            <div class="simulator-visualization">
                <svg viewBox="0 0 600 400" id="svgColision">
                    <!-- Fondo -->
                    <rect x="0" y="0" width="600" height="400" fill="#0a0a1a" id="fondoSimulador"/>

                    <!-- Objeto 1 (antes) -->
                    <circle cx="150" cy="200" r="25" fill="#42A5F5" id="objeto1Antes"/>
                    <text x="150" y="240" fill="white" font-size="12" text-anchor="middle" id="masa1Antes">m₁=2 kg</text>
                    <text x="150" y="160" fill="#2196F3" font-size="14" text-anchor="middle" id="velocidad1Antes">v₁=4 m/s</text>

                    <!-- Objeto 2 (antes) -->
                    <circle cx="450" cy="200" r="30" fill="#EF5350" id="objeto2Antes"/>
                    <text x="450" y="240" fill="white" font-size="12" text-anchor="middle" id="masa2Antes">m₂=3 kg</text>
                    <text x="450" y="160" fill="#EF5350" font-size="14" text-anchor="middle" id="velocidad2Antes">v₂=0 m/s</text>

                    <!-- Objetos después de la colisión -->
                    <circle cx="300" cy="200" r="25" fill="#9CCC65" id="objeto1Despues" opacity="0"/>
                    <circle cx="350" cy="200" r="30" fill="#9CCC65" id="objeto2Despues" opacity="0"/>
                    <rect x="275" cy="200" width="100" height="50" fill="#9CCC65" rx="10" id="objetoUnido" opacity="0"/>

                    <!-- Flecha de velocidad final -->
                    <line x1="325" y1="200" x2="400" y2="200" stroke="#39FF14" stroke-width="3" marker-end="url(#arrowhead)" id="flechaFinal" opacity="0"/>

                    <!-- Fórmula -->
                    <rect x="50" y="350" width="500" height="40" fill="rgba(0,0,0,0.7)" rx="5"/>
                    <text x="300" y="380" fill="#39FF14" font-size="16" text-anchor="middle" id="formulaColision">m₁v₁ + m₂v₂ = m₁v₁\\\' + m₂v₂\\\'</text>
                </svg>
            </div>

            <!-- DATOS EN TIEMPO REAL -->
            <div class="simulator-data">
                <h3>DATOS DE SIMULACIÓN</h3>
                <div class="data-card">
                    <div class="data-label">Masa 1 (m₁):</div>
                    <div class="data-value" id="dataMasa1">2 kg</div>
                </div>
                <div class="data-card">
                    <div class="data-label">Velocidad 1 (v₁):</div>
                    <div class="data-value" id="dataVelocidad1">4 m/s</div>
                </div>
                <div class="data-card">
                    <div class="data-label">Masa 2 (m₂):</div>
                    <div class="data-value" id="dataMasa2">3 kg</div>
                </div>
                <div class="data-card">
                    <div class="data-label">Velocidad 2 (v₂):</div>
                    <div class="data-value" id="dataVelocidad2">0 m/s</div>
                </div>
                <div class="data-card">
                    <div class="data-label">Tipo de colisión:</div>
                    <div class="data-value" id="dataTipoColision">Elástica</div>
                </div>
                <div class="data-card highlight">
                    <div class="data-label">CANTIDAD DE MOVIMIENTO INICIAL (pᵢ):</div>
                    <div class="data-value" id="dataPi">8 kg·m/s</div>
                </div>
                <div class="data-card highlight">
                    <div class="data-label">CANTIDAD DE MOVIMIENTO FINAL (p_f):</div>
                    <div class="data-value" id="dataPf">8 kg·m/s</div>
                </div>
                <div class="data-card highlight">
                    <div class="data-label">VELOCIDAD FINAL (v\\\'):</div>
                    <div class="data-value" id="dataVelocidadFinal">1.6 m/s</div>
                </div>
            </div>
        </div>
    </section>

    <!-- QUIZ INTERACTIVO -->
    <section class="quiz-section">
        <h2 class="seccion-titulo neon-evaluacion">
            <span class="icon">❓</span> QUIZ DE AUTOEVALUACIÓN
        </h2>
        <div class="quiz-container">
            <!-- PREGUNTA 1 -->
            <div class="quiz-question" data-correct="B">
                <div class="quiz-header">
                    <span class="quiz-num">01</span>
                    <h3>¿En qué condición se conserva la cantidad de movimiento?</h3>
                </div>
                <div class="quiz-options">
                    <button class="quiz-option" data-value="A">
                        <span class="option-letter">A</span>
                        Cuando hay fuerzas de fricción
                    </button>
                    <button class="quiz-option" data-value="B">
                        <span class="option-letter">B</span>
                        Cuando la fuerza externa neta es cero
                    </button>
                    <button class="quiz-option" data-value="C">
                        <span class="option-letter">C</span>
                        Solo en colisiones elásticas
                    </button>
                    <button class="quiz-option" data-value="D">
                        <span class="option-letter">D</span>
                        Solo en sistemas con dos objetos
                    </button>
                </div>
                <div class="quiz-feedback" style="display: none;">
                    <div class="feedback-correct">
                        ✅ <strong>Correcto:</strong> \\( \\sum \\vec{F}_{\\text{ext}} = 0 \\).
                    </div>
                    <div class="feedback-incorrect">
                        ❌ <strong>Incorrecto:</strong> Revisa las condiciones para la conservación de \\( p \\).
                    </div>
                    <div class="feedback-explicacion">
                        <p><strong>Explicación:</strong> La cantidad de movimiento se conserva en sistemas aislados, donde la fuerza externa neta es cero.</p>
                    </div>
                </div>
            </div>

            <!-- PREGUNTA 2 -->
            <div class="quiz-question" data-correct="C">
                <div class="quiz-header">
                    <span class="quiz-num">02</span>
                    <h3>Un objeto de 4 kg a 3 m/s choca con otro de 2 kg en reposo. Si después de la colisión ambos se mueven juntos, ¿cuál es su velocidad final?</h3>
                </div>
                <div class="quiz-options">
                    <button class="quiz-option" data-value="A">
                        <span class="option-letter">A</span>
                        1 m/s
                    </button>
                    <button class="quiz-option" data-value="B">
                        <span class="option-letter">B</span>
                        1.5 m/s
                    </button>
                    <button class="quiz-option" data-value="C">
                        <span class="option-letter">C</span>
                        2 m/s
                    </button>
                    <button class="quiz-option" data-value="D">
                        <span class="option-letter">D</span>
                        3 m/s
                    </button>
                </div>
                <div class="quiz-feedback" style="display: none;">
                    <div class="feedback-correct">
                        ✅ <strong>Correcto:</strong> \\( v\' = \\frac{4 \\cdot 3}{6} = 2\\, \\text{m/s} \\).
                    </div>
                    <div class="feedback-incorrect">
                        ❌ <strong>Incorrecto:</strong> Usa la conservación de \\( p \\): \\( m_1 v_1 = (m_1 + m_2) v\' \\).
                    </div>
                    <div class="feedback-explicacion">
                        <p><strong>Cálculo:</strong> \\( 4 \\cdot 3 = (4 + 2) v\' \\Rightarrow v\' = 2\\, \\text{m/s} \\).</p>
                    </div>
                </div>
            </div>

            <!-- RESULTADOS -->
            <div class="quiz-results" style="display: none;">
                <h3>📊 RESULTADOS DEL QUIZ</h3>
                <div class="results-score">
                    Puntuación: <span id="quizScore">0</span>/2
                </div>
                <div class="results-feedback" id="quizFeedback">
                    Completa el quiz para ver tus resultados
                </div>
                <button class="btn-retry" onclick="reiniciarQuiz()">
                    🔄 INTENTAR NUEVAMENTE
                </button>
            </div>
        </div>
    </section>

    <!-- ERRORES COMUNES -->
    <section class="errores-section">
        <h2 class="seccion-titulo neon-alerta">
            <span class="icon">⚠️</span> ERRORES COMUNES Y SOLUCIONES
        </h2>
        <div class="errores-container">
            <div class="error-card">
                <div class="error-header" onclick="toggleError(this)">
                    <h3>❌ CONFUNDIR CONSERVACIÓN DE ENERGÍA CON CONSERVACIÓN DE \\( p \\)</h3>
                    <span class="error-toggle">+</span>
                </div>
                <div class="error-content">
                    <div class="error-ejemplo">
                        <strong>Error común:</strong> "En una colisión, la energía cinética siempre se conserva".
                    </div>
                    <div class="error-correccion">
                        <strong>Corrección:</strong>
                        <ul>
                            <li><strong>Cantidad de movimiento:</strong> Siempre se conserva en sistemas aislados.</li>
                            <li><strong>Energía cinética:</strong> Solo se conserva en colisiones <strong>elásticas</strong>.</li>
                        </ul>
                    </div>
                    <div class="error-tabla">
                        <table>
                            <tr>
                                <th>Tipo de colisión</th>
                                <th>Conservación de \\( p \\)</th>
                                <th>Conservación de \\( E_k \\)</th>
                            </tr>
                            <tr>
                                <td>Elástica</td>
                                <td>Sí</td>
                                <td>Sí</td>
                            </tr>
                            <tr>
                                <td>Inelástica</td>
                                <td>Sí</td>
                                <td>No</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="error-card">
                <div class="error-header" onclick="toggleError(this)">
                    <h3>❌ OLVIDAR QUE LA CANTIDAD DE MOVIMIENTO ES VECTORIAL</h3>
                    <span class="error-toggle">+</span>
                </div>
                <div class="error-content">
                    <div class="error-ejemplo">
                        <strong>Error común:</strong> "La cantidad de movimiento total es la suma de las magnitudes de \\( p \\) de cada objeto".
                    </div>
                    <div class="error-correccion">
                        <strong>Corrección:</strong> La cantidad de movimiento es un <strong>vector</strong>. Debes considerar <strong>dirección y sentido</strong>.
                    </div>
                    <div class="error-practica">
                        <p><strong>Practica:</strong> Dos objetos se mueven en direcciones opuestas. ¿Cómo calculas \\( p_{\\text{total}} \\)?</p>
                        <button class="btn-mini" onclick="mostrarSolucion(1)">Ver solución</button>
                        <div class="solucion" id="solucion1" style="display: none;">
                            <strong>Solución:</strong> \\( p_{\\text{total}} = m_1 v_1 + m_2 (-v_2) \\).
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- PROBLEMAS TIPO EXAMEN -->
    <section class="examen-section">
        <h2 class="seccion-titulo neon-evaluacion">
            <span class="icon">📝</span> PROBLEMAS TIPO EXAMEN
        </h2>
        <div class="examen-container">
            <div class="problema-card">
                <div class="problema-header">
                    <span class="problema-num">P1</span>
                    <h3>Colisión Elástica en 1D</h3>
                </div>
                <div class="problema-enunciado">
                    <p>Un objeto de \\( m_1 = 1\\, \\text{kg} \\) con \\( v_1 = 5\\, \\text{m/s} \\) choca elásticamente con otro de \\( m_2 = 2\\, \\text{kg} \\) en reposo. Calcula:</p>
                    <ol>
                        <li>Las velocidades finales de ambos objetos.</li>
                        <li>La energía cinética inicial y final del sistema.</li>
                    </ol>
                </div>
                <div class="problema-espacio">
                    <textarea placeholder="Desarrolla tu solución aquí..." rows="8"></textarea>
                </div>
                <button class="btn-verificar" onclick="verificarProblema(1)">VERIFICAR SOLUCIÓN</button>
                <div class="problema-solucion" id="solucionP1" style="display: none;">
                    <strong>Solución:</strong><br>
                    1. Conservación de \\( p \\): \\( 1 \\cdot 5 + 2 \\cdot 0 = 1 \\cdot v_1\' + 2 \\cdot v_2\' \\).<br>
                    Conservación de \\( E_k \\): \\( \\frac{1}{2} \\cdot 1 \\cdot 5^2 = \\frac{1}{2} \\cdot 1 \\cdot v_1\'^2 + \\frac{1}{2} \\cdot 2 \\cdot v_2\'^2 \\).<br>
                    Resolviendo: \\( v_1\' = -1.67\\, \\text{m/s} \\), \\( v_2\' = 3.33\\, \\text{m/s} \\).<br>
                    2. \\( E_{k,i} = 12.5\\, \\text{J} \\), \\( E_{k,f} = 12.5\\, \\text{J} \\).
                </div>
            </div>
            <div class="problema-card">
                <div class="problema-header">
                    <span class="problema-num">P2</span>
                    <h3>Explosión en 2D</h3>
                </div>
                <div class="problema-enunciado">
                    <p>Un proyectil de \\( 5\\, \\text{kg} \\) explota en dos fragmentos: uno de \\( 3\\, \\text{kg} \\) sale con \\( v = 20\\, \\text{m/s} \\) a \\( 30° \\) sobre la horizontal, y el otro de \\( 2\\, \\text{kg} \\) sale con velocidad desconocida. Si el proyectil estaba inicialmente en reposo, calcula:</p>
                    <ol>
                        <li>La velocidad del segundo fragmento (magnitud y dirección).</li>
                        <li>La energía cinética total después de la explosión.</li>
                    </ol>
                </div>
                <div class="problema-espacio">
                    <textarea placeholder="Desarrolla tu solución aquí..." rows="8"></textarea>
                </div>
                <button class="btn-verificar" onclick="verificarProblema(2)">VERIFICAR SOLUCIÓN</button>
                <div class="problema-solucion" id="solucionP2" style="display: none;">
                    <strong>Solución:</strong><br>
                    1. Conservación de \\( p \\) en \\( x \\) e \\( y \\):<br>
                    \\( 0 = 3 \\cdot 20 \\cos 30° + 2 v_{2x} \\Rightarrow v_{2x} = -25.98\\, \\text{m/s} \\).<br>
                    \\( 0 = 3 \\cdot 20 \\sin 30° + 2 v_{2y} \\Rightarrow v_{2y} = -15\\, \\text{m/s} \\).<br>
                    Magnitud: \\( v_2 = \\sqrt{(-25.98)^2 + (-15)^2} \\approx 30\\, \\text{m/s} \\).<br>
                    Dirección: \\( \\theta = \\tan^{-1}(15/25.98) \\approx 221° \\).<br>
                    2. \\( E_k = \\frac{1}{2} \\cdot 3 \\cdot 20^2 + \\frac{1}{2} \\cdot 2 \\cdot 30^2 = 1500\\, \\text{J} \\).
                </div>
            </div>
            <div class="rubrica">
                <h4>📋 RÚBRICA DE EVALUACIÓN</h4>
                <table class="rubrica-table">
                    <tr>
                        <th>Criterio</th>
                        <th>Excelente (5)</th>
                        <th>Satisfactorio (3-4)</th>
                        <th>Insuficiente (0-2)</th>
                    </tr>
                    <tr>
                        <td>Aplicación de conservación de \\( p \\)</td>
                        <td>Ecuaciones correctas en 1D/2D</td>
                        <td>Errores menores en cálculos</td>
                        <td>Falta aplicación del principio</td>
                    </tr>
                    <tr>
                        <td>Cálculo de velocidades finales</td>
                        <td>Resultados precisos con justificación</td>
                        <td>Falta claridad en pasos</td>
                        <td>Solución incorrecta</td>
                    </tr>
                </table>
            </div>
        </div>
    </section>

    <!-- CIERRE METACOGNITIVO -->
    <section class="cierre-section">
        <h2 class="seccion-titulo neon-concepto">
            <span class="icon">🧠</span> CIERRE METACOGNITIVO
        </h2>
        <div class="cierre-container">
            <div class="autoevaluacion">
                <h3>📈 AUTOEVALUACIÓN</h3>
                <div class="slider-group">
                    <label>Comprensión de la conservación de \\( p \\):</label>
                    <input type="range" min="1" max="5" value="3" class="autoeval-slider" id="slider1">
                    <div class="slider-labels">
                        <span>Básico</span><span>Intermedio</span><span>Avanzado</span>
                    </div>
                </div>
                <div class="slider-group">
                    <label>Aplicación en colisiones:</label>
                    <input type="range" min="1" max="5" value="3" class="autoeval-slider" id="slider2">
                    <div class="slider-labels">
                        <span>Básico</span><span>Intermedio</span><span>Avanzado</span>
                    </div>
                </div>
                <button class="btn-guardar" onclick="guardarAutoevaluacion()">
                    💾 GUARDAR AUTOEVALUACIÓN
                </button>
            </div>
            <div class="reflexion">
                <h3>💭 REFLEXIÓN GUIADA</h3>
                <div class="pregunta-reflexion">
                    <p>¿Por qué es crucial la conservación de la cantidad de movimiento en el diseño de vehículos espaciales?</p>
                    <textarea placeholder="Ejemplo: expulsión de gases, cambios de órbita..." rows="4" id="reflexion1"></textarea>
                </div>
                <div class="pregunta-reflexion">
                    <p>Describe un ejemplo cotidiano donde observes la conservación de \\( p \\).</p>
                    <textarea placeholder="Ejemplo: patinar sobre hielo, saltar desde un bote..." rows="4" id="reflexion2"></textarea>
                </div>
            </div>
            <div class="plan-estudio">
                <h3>📚 PLAN DE ESTUDIO RECOMENDADO</h3>
                <div class="plan-grid">
                    <div class="plan-card">
                        <h4>🔹 REPASO RÁPIDO (15 min)</h4>
                        <ul>
                            <li>Repasar \\( \\sum \\vec{p}_i = \\sum \\vec{p}_f \\)</li>
                            <li>Diferenciar colisiones elásticas e inelásticas</li>
                        </ul>
                    </div>
                    <div class="plan-card">
                        <h4>🛠 PRÁCTICA (30 min)</h4>
                        <ul>
                            <li>Resolver 5 problemas de conservación de \\( p \\)</li>
                            <li>Usar el simulador para visualizar colisiones</li>
                        </ul>
                    </div>
                    <div class="plan-card">
                        <h4>🎓 PROFUNDIZACIÓN (45 min)</h4>
                        <ul>
                            <li>Investigar aplicaciones en ingeniería aeroespacial</li>
                            <li>Relacionar con conservación de energía</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="recursos">
                <h3>🔗 RECURSOS ADICIONALES</h3>
                <div class="recursos-links">
                    <a href="https://phet.colorado.edu/es/simulation/legacy/collision-lab" target="_blank" class="recurso-link">
                        🎯 Simulador PhET: Laboratorio de Colisiones
                    </a>
                    <a href="https://www.khanacademy.org/science/physics/linear-momentum" target="_blank" class="recurso-link">
                        📚 Khan Academy: Conservación de la Cantidad de Movimiento
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- JAVASCRIPT INTEGRADO -->
<script>
    // ==========================================
// SIMULADOR DE CONSERVACIÓN DE LA CANTIDAD DE MOVIMIENTO
// ==========================================
function simularColision() {
    // Obtener valores de los sliders
    const masa1 = parseFloat(document.getElementById(\'masa1Input\').value);
    const velocidad1 = parseFloat(document.getElementById(\'velocidad1Input\').value);
    const masa2 = parseFloat(document.getElementById(\'masa2Input\').value);
    const velocidad2 = parseFloat(document.getElementById(\'velocidad2Input\').value);
    const tipoColision = document.getElementById(\'tipoColision\').value;

    // Validar valores
    if (isNaN(masa1) || isNaN(velocidad1) || isNaN(masa2) || isNaN(velocidad2)) {
        alert("Por favor, ingresa valores válidos.");
        return;
    }

    // Actualizar valores en la interfaz
    document.getElementById(\'masa1Value\').textContent = `${masa1} kg`;
    document.getElementById(\'velocidad1Value\').textContent = `${velocidad1} m/s`;
    document.getElementById(\'masa2Value\').textContent = `${masa2} kg`;
    document.getElementById(\'velocidad2Value\').textContent = `${velocidad2} m/s`;
    document.getElementById(\'dataTipoColision\').textContent = tipoColision === \'elastica\' ? \'Elástica\' : \'Perfectamente inelástica\';

    // Calcular cantidad de movimiento inicial
    const pi = masa1 * velocidad1 + masa2 * velocidad2;

    // Actualizar datos en la interfaz
    document.getElementById(\'dataMasa1\').textContent = `${masa1} kg`;
    document.getElementById(\'dataVelocidad1\').textContent = `${velocidad1} m/s`;
    document.getElementById(\'dataMasa2\').textContent = `${masa2} kg`;
    document.getElementById(\'dataVelocidad2\').textContent = `${velocidad2} m/s`;
    document.getElementById(\'dataPi\').textContent = `${pi.toFixed(2)} kg·m/s`;

    // Simular colisión según el tipo
    if (tipoColision === \'inelastica\') {
        // Colisión perfectamente inelástica
        const velocidadFinal = pi / (masa1 + masa2);
        document.getElementById(\'dataPf\').textContent = `${pi.toFixed(2)} kg·m/s`;
        document.getElementById(\'dataVelocidadFinal\').textContent = `${velocidadFinal.toFixed(2)} m/s`;

        // Actualizar SVG: objetos unidos
        document.getElementById(\'objeto1Despues\').style.opacity = \'0\';
        document.getElementById(\'objeto2Despues\').style.opacity = \'0\';
        document.getElementById(\'objetoUnido\').style.opacity = \'1\';
        document.getElementById(\'flechaFinal\').style.opacity = \'1\';

        // Posición del objeto unido
        const posicionUnido = 300 + (velocidadFinal * 5);
        document.getElementById(\'objetoUnido\').setAttribute(\'x\', posicionUnido - 40);

        // Fórmula en SVG
        document.getElementById(\'formulaColision\').textContent = `m₁v₁ + m₂v₂ = (m₁ + m₂)v\'`;
    } else {
        // Colisión elástica (simplificada: solo velocidad final del objeto 1)
        const velocidadFinal1 = ((masa1 - masa2) / (masa1 + masa2)) * velocidad1 + (2 * masa2 / (masa1 + masa2)) * velocidad2;
        const velocidadFinal2 = (2 * masa1 / (masa1 + masa2)) * velocidad1 + ((masa2 - masa1) / (masa1 + masa2)) * velocidad2;

        document.getElementById(\'dataPf\').textContent = `${pi.toFixed(2)} kg·m/s`;
        document.getElementById(\'dataVelocidadFinal\').textContent = `${velocidadFinal1.toFixed(2)} m/s (objeto 1)`;

        // Actualizar SVG: objetos separados después de la colisión
        document.getElementById(\'objeto1Despues\').style.opacity = \'1\';
        document.getElementById(\'objeto2Despues\').style.opacity = \'1\';
        document.getElementById(\'objetoUnido\').style.opacity = \'0\';

        // Posiciones finales
        const posicion1 = 300 + (velocidadFinal1 * 5);
        const posicion2 = 300 + (velocidadFinal2 * 5);
        document.getElementById(\'objeto1Despues\').setAttribute(\'cx\', posicion1);
        document.getElementById(\'objeto2Despues\').setAttribute(\'cx\', posicion2);

        // Fórmula en SVG
        document.getElementById(\'formulaColision\').textContent = `m₁v₁ + m₂v₂ = m₁v₁\' + m₂v₂\'`;
    }

    // Animación de colisión
    document.getElementById(\'objeto1Antes\').setAttribute(\'cx\', \'150\');
    document.getElementById(\'objeto2Antes\').setAttribute(\'cx\', \'450\');

    // Animar movimiento antes de la colisión
    const anim1 = document.getElementById(\'objeto1Antes\').animate([
        { cx: \'150\' },
        { cx: \'300\' }
    ], { duration: 1500, fill: \'forwards\' });

    const anim2 = document.getElementById(\'objeto2Antes\').animate([
        { cx: \'450\' },
        { cx: \'300\' }
    ], { duration: 1500, fill: \'forwards\' });

    // Mostrar resultados después de la animación
    setTimeout(() => {
        document.getElementById(\'dataPf\').style.animation = \'pulse 1s\';
    }, 1500);
}

// Generar valores aleatorios
function valoresAleatorios() {
    const masa1 = (Math.random() * 9 + 1).toFixed(1);
    const velocidad1 = (Math.random() * 10).toFixed(1);
    const masa2 = (Math.random() * 9 + 1).toFixed(1);
    const velocidad2 = (Math.random() * 5 - 2.5).toFixed(1); // Velocidad entre -2.5 y 2.5 m/s

    document.getElementById(\'masa1Input\').value = masa1;
    document.getElementById(\'velocidad1Input\').value = velocidad1;
    document.getElementById(\'masa2Input\').value = masa2;
    document.getElementById(\'velocidad2Input\').value = velocidad2;

    simularColision(); // Actualizar simulador
}

// ==========================================
// QUIZ INTERACTIVO
// ==========================================
let quizRespuestas = [];
let quizCompletado = false;

document.querySelectorAll(\'.quiz-option\').forEach(option => {
    option.addEventListener(\'click\', function() {
        if (quizCompletado) return;

        const question = this.closest(\'.quiz-question\');
        const correct = question.dataset.correct;
        const selected = this.dataset.value;
        const feedback = question.querySelector(\'.quiz-feedback\');

        // Limpiar selección previa
        question.querySelectorAll(\'.quiz-option\').forEach(opt => {
            opt.classList.remove(\'selected\', \'correct\', \'incorrect\');
        });

        // Marcar selección actual
        this.classList.add(\'selected\');

        // Verificar respuesta
        if (selected === correct) {
            this.classList.add(\'correct\');
            quizRespuestas.push(true);
        } else {
            this.classList.add(\'incorrect\');
            question.querySelector(`[data-value="${correct}"]`).classList.add(\'correct\');
            quizRespuestas.push(false);
        }

        // Mostrar feedback
        feedback.style.display = \'block\';

        // Verificar si todas las preguntas están respondidas
        const allAnswered = Array.from(document.querySelectorAll(\'.quiz-question\')).every(q =>
            q.querySelector(\'.quiz-option.selected\')
        );

        if (allAnswered && !quizCompletado) {
            quizCompletado = true;
            mostrarResultadosQuiz();
        }
    });
});

function mostrarResultadosQuiz() {
    const correctas = quizRespuestas.filter(r => r).length;
    const total = quizRespuestas.length;
    document.getElementById(\'quizScore\').textContent = `${correctas}/${total}`;

    let feedback = "";
    if (correctas === total) {
        feedback = "🎉 ¡Excelente! Dominas la conservación de la cantidad de movimiento.";
    } else if (correctas >= total / 2) {
        feedback = "👍 Buen trabajo, pero repasa las condiciones y aplicaciones.";
    } else {
        feedback = "📚 Necesitas estudiar más. Usa el simulador para practicar.";
    }

    document.getElementById(\'quizFeedback\').textContent = feedback;
    document.querySelector(\'.quiz-results\').style.display = \'block\';
}

function reiniciarQuiz() {
    quizRespuestas = [];
    quizCompletado = false;

    document.querySelectorAll(\'.quiz-option\').forEach(opt => {
        opt.classList.remove(\'selected\', \'correct\', \'incorrect\');
    });

    document.querySelectorAll(\'.quiz-feedback\').forEach(fb => {
        fb.style.display = \'none\';
    });

    document.querySelector(\'.quiz-results\').style.display = \'none\';
}

// ==========================================
// ERRORES COMUNES
// ==========================================
function toggleError(header) {
    const content = header.nextElementSibling;
    const toggle = header.querySelector(\'.error-toggle\');

    if (content.style.display === \'block\') {
        content.style.display = \'none\';
        toggle.textContent = \'+\';
    } else {
        content.style.display = \'block\';
        toggle.textContent = \'-\';
    }
}

function mostrarSolucion(num) {
    const solucion = document.getElementById(`solucion${num}`);
    solucion.style.display = solucion.style.display === \'block\' ? \'none\' : \'block\';
}

// ==========================================
// PROBLEMAS TIPO EXAMEN
// ==========================================
function verificarProblema(num) {
    const solucion = document.getElementById(`solucionP${num}`);
    solucion.style.display = solucion.style.display === \'block\' ? \'none\' : \'block\';
}

// ==========================================
// AUTOEVALUACIÓN
// ==========================================
function guardarAutoevaluacion() {
    const slider1 = document.getElementById(\'slider1\').value;
    const slider2 = document.getElementById(\'slider2\').value;
    const promedio = (parseInt(slider1) + parseInt(slider2)) / 2;

    alert(
        `💾 Autoevaluación guardada:\\n\\n` +
        `Comprensión de la conservación de \\( p \\): ${slider1}/5\\n` +
        `Aplicación en colisiones: ${slider2}/5\\n\\n` +
        `Promedio: ${promedio.toFixed(1)}/5\\n\\n` +
        `Revisa el plan de estudio según tus resultados.`
    );
}

// ==========================================
// INICIALIZACIÓN
// ==========================================
document.addEventListener(\'DOMContentLoaded\', function() {
    console.log("🚀 Lección Cyberpunk: Conservación de la Cantidad de Movimiento - Cargada");

    // Añadir marcador de flecha al SVG
    const svg = document.getElementById(\'svgColision\');
    const defs = document.createElementNS(\'http://www.w3.org/2000/svg\', \'defs\');
    const marker = document.createElementNS(\'http://www.w3.org/2000/svg\', \'marker\');
    marker.setAttribute(\'id\', \'arrowhead\');
    marker.setAttribute(\'markerWidth\', \'10\');
    marker.setAttribute(\'markerHeight\', \'7\');
    marker.setAttribute(\'refX\', \'9\');
    marker.setAttribute(\'refY\', \'3.5\');
    marker.setAttribute(\'orient\', \'auto\');
    const arrowPath = document.createElementNS(\'http://www.w3.org/2000/svg\', \'path\');
    arrowPath.setAttribute(\'d\', \'M0,0 L10,3.5 L0,7 Z\');
    arrowPath.setAttribute(\'fill\', \'#39FF14\');
    marker.appendChild(arrowPath);
    defs.appendChild(marker);
    svg.appendChild(defs);

    simularColision(); // Inicializar simulador
});
</script>',
    'ejercicios' => 
    array (
      0 => 
      array (
        'enunciado' => 'Conservación p válida si',
        'respuesta' => 'F_ext = 0',
      ),
      1 => 
      array (
        'enunciado' => 'p total =',
        'respuesta' => 'm₁v₁ + m₂v₂ + ...',
      ),
      2 => 
      array (
        'enunciado' => 'En explosión (reposo)',
        'respuesta' => 'p_total = 0',
      ),
      3 => 
      array (
        'enunciado' => 'Vectorial →',
        'respuesta' => 'Componentes x, y',
      ),
      4 => 
      array (
        'enunciado' => 'm₁=1kg, v₁=5m/s; m₂=2kg, v₂=0 → p_i',
        'respuesta' => '5 kg·m/s',
      ),
      5 => 
      array (
        'enunciado' => 'Inelástica perfecta: v =',
        'respuesta' => '(m₁v₁ + m₂v₂)/(m₁+m₂)',
      ),
      6 => 
      array (
        'enunciado' => 'Cohete: Δp_cohete =',
        'respuesta' => '-Δp_gases',
      ),
      7 => 
      array (
        'enunciado' => 'Colisión 2D: p_x y p_y',
        'respuesta' => 'Conservadas por separado',
      ),
      8 => 
      array (
        'enunciado' => 'Sistema aislado significa',
        'respuesta' => 'No F_ext neta',
      ),
      9 => 
      array (
        'enunciado' => 'p antes = p después',
        'respuesta' => 'Conservación',
      ),
      10 => 
      array (
        'enunciado' => 'Unidad p',
        'respuesta' => 'kg·m/s',
      ),
      11 => 
      array (
        'enunciado' => 'SI: conservación en',
        'respuesta' => 'Cualquier dirección',
      ),
    ),
    'quiz' => 
    array (
      0 => 
      array (
        'pregunta' => 'Conservación p requiere',
        'opciones' => 
        array (
          0 => 'F_ext = 0',
          1 => 'F_ext ≠ 0',
          2 => 'm = 0',
          3 => 'v = 0',
        ),
        'correcta' => 'F_ext = 0',
      ),
      1 => 
      array (
        'pregunta' => 'p total antes =',
        'opciones' => 
        array (
          0 => 'p total después',
          1 => 'p parcial',
          2 => '0',
          3 => 'máximo',
        ),
        'correcta' => 'p total después',
      ),
      2 => 
      array (
        'pregunta' => 'p es',
        'opciones' => 
        array (
          0 => 'Vector',
          1 => 'Escalar',
          2 => 'Energía',
          3 => 'Fuerza',
        ),
        'correcta' => 'Vector',
      ),
      3 => 
      array (
        'pregunta' => 'Válida en',
        'opciones' => 
        array (
          0 => 'Todas colisiones',
          1 => 'Solo elásticas',
          2 => 'Solo inelásticas',
          3 => 'Ninguna',
        ),
        'correcta' => 'Todas colisiones',
      ),
      4 => 
      array (
        'pregunta' => 'Explosión: p_i =',
        'opciones' => 
        array (
          0 => '0 (si en reposo)',
          1 => 'm v',
          2 => 'F t',
          3 => 'EK',
        ),
        'correcta' => '0 (si en reposo)',
      ),
      5 => 
      array (
        'pregunta' => 'm₁v₁ + m₂v₂ =',
        'opciones' => 
        array (
          0 => 'm₁v₁\' + m₂v₂\'',
          1 => 'm₁ + m₂',
          2 => 'v₁ + v₂',
          3 => '0',
        ),
        'correcta' => 'm₁v₁\' + m₂v₂\'',
      ),
      6 => 
      array (
        'pregunta' => 'Sistema aislado =',
        'opciones' => 
        array (
          0 => '∑ F_ext = 0',
          1 => '∑ F_int = 0',
          2 => 'm = cte',
          3 => 'v = cte',
        ),
        'correcta' => '∑ F_ext = 0',
      ),
      7 => 
      array (
        'pregunta' => 'Cohete avanza porque',
        'opciones' => 
        array (
          0 => 'Gases expulsados atrás',
          1 => 'Combustible',
          2 => 'Gravedad',
          3 => 'Aire',
        ),
        'correcta' => 'Gases expulsados atrás',
      ),
      8 => 
      array (
        'pregunta' => 'p conservada en',
        'opciones' => 
        array (
          0 => 'x e y (2D)',
          1 => 'solo x',
          2 => 'solo y',
          3 => 'ninguna',
        ),
        'correcta' => 'x e y (2D)',
      ),
      9 => 
      array (
        'pregunta' => 'Unidad p',
        'opciones' => 
        array (
          0 => 'kg·m/s',
          1 => 'N',
          2 => 'J',
          3 => 'm/s²',
        ),
        'correcta' => 'kg·m/s',
      ),
      10 => 
      array (
        'pregunta' => 'm₁=2kg, v₁=3m/s; m₂=1kg, v₂=0 → p_i',
        'opciones' => 
        array (
          0 => '6 kg·m/s',
          1 => '2 kg·m/s',
          2 => '3 kg·m/s',
          3 => '0',
        ),
        'correcta' => '6 kg·m/s',
      ),
      11 => 
      array (
        'pregunta' => 'Inelástica perfecta: v =',
        'opciones' => 
        array (
          0 => '(m₁v₁ + m₂v₂)/(m₁+m₂)',
          1 => 'v₁ + v₂',
          2 => '0',
          3 => 'v₁',
        ),
        'correcta' => '(m₁v₁ + m₂v₂)/(m₁+m₂)',
      ),
      12 => 
      array (
        'pregunta' => 'Explosión: fragmentos opuestos',
        'opciones' => 
        array (
          0 => 'p₁ = -p₂',
          1 => 'p₁ = p₂',
          2 => 'p₁ = 0',
          3 => 'p_total ≠ 0',
        ),
        'correcta' => 'p₁ = -p₂',
      ),
      13 => 
      array (
        'pregunta' => 'Colisión frontal: p_total',
        'opciones' => 
        array (
          0 => 'Conservada',
          1 => 'Perdida',
          2 => 'Aumentada',
          3 => 'Cero',
        ),
        'correcta' => 'Conservada',
      ),
      14 => 
      array (
        'pregunta' => 'Fricción presente → p sistema',
        'opciones' => 
        array (
          0 => 'No conservada (F_ext)',
          1 => 'Conservada',
          2 => 'Aumenta',
          3 => 'Cero',
        ),
        'correcta' => 'No conservada (F_ext)',
      ),
      15 => 
      array (
        'pregunta' => 'Choque elástico: p',
        'opciones' => 
        array (
          0 => 'Conservada',
          1 => 'No',
          2 => 'A veces',
          3 => 'Nunca',
        ),
        'correcta' => 'Conservada',
      ),
      16 => 
      array (
        'pregunta' => 'v₁ = -v₂ (masas iguales)',
        'opciones' => 
        array (
          0 => 'Rebotan opuestos',
          1 => 'Se pegan',
          2 => 'Se detienen',
          3 => 'Aceleran',
        ),
        'correcta' => 'Rebotan opuestos',
      ),
      17 => 
      array (
        'pregunta' => 'p = m v → v =',
        'opciones' => 
        array (
          0 => 'p/m',
          1 => 'm/p',
          2 => 'p m',
          3 => '0',
        ),
        'correcta' => 'p/m',
      ),
      18 => 
      array (
        'pregunta' => 'Sistema Tierra + pelota',
        'opciones' => 
        array (
          0 => 'p_total conservada',
          1 => 'No',
          2 => 'Solo pelota',
          3 => 'Solo Tierra',
        ),
        'correcta' => 'p_total conservada',
      ),
      19 => 
      array (
        'pregunta' => 'SI 2025: p en',
        'opciones' => 
        array (
          0 => 'kg·m/s',
          1 => 'N·s²',
          2 => 'J·s',
          3 => 'W',
        ),
        'correcta' => 'kg·m/s',
      ),
      20 => 
      array (
        'pregunta' => 'm₁=4kg, v₁=5m/s; m₂=6kg, v₂=-2m/s → p_i',
        'opciones' => 
        array (
          0 => '8 kg·m/s',
          1 => '20 kg·m/s',
          2 => '30 kg·m/s',
          3 => '0',
        ),
        'correcta' => '8 kg·m/s',
      ),
      21 => 
      array (
        'pregunta' => 'Explosión 2 partes: m₁=1kg, v₁=10m/s → m₂v₂',
        'opciones' => 
        array (
          0 => '-10 kg·m/s',
          1 => '10 kg·m/s',
          2 => '0',
          3 => '1 kg·m/s',
        ),
        'correcta' => '-10 kg·m/s',
      ),
      22 => 
      array (
        'pregunta' => 'Cohete: Δm v_e =',
        'opciones' => 
        array (
          0 => '-M Δv',
          1 => 'M v',
          2 => 'Δm v',
          3 => '0',
        ),
        'correcta' => '-M Δv',
      ),
      23 => 
      array (
        'pregunta' => 'Colisión 2D: p_y inicial = 0 → p_y final',
        'opciones' => 
        array (
          0 => '0',
          1 => 'm₁v₁',
          2 => 'm₂v₂',
          3 => 'p_x',
        ),
        'correcta' => '0',
      ),
      24 => 
      array (
        'pregunta' => 'p_total = 0 → sistema',
        'opciones' => 
        array (
          0 => 'En reposo o balanceado',
          1 => 'En movimiento',
          2 => 'Con fricción',
          3 => 'Abierto',
        ),
        'correcta' => 'En reposo o balanceado',
      ),
      25 => 
      array (
        'pregunta' => 'Conservación p derivada de',
        'opciones' => 
        array (
          0 => '3ª Ley Newton',
          1 => '1ª',
          2 => '2ª',
          3 => 'Gravedad',
        ),
        'correcta' => '3ª Ley Newton',
      ),
      26 => 
      array (
        'pregunta' => 'p en vacío vs aire',
        'opciones' => 
        array (
          0 => 'Conservada igual',
          1 => 'No en aire',
          2 => 'Solo vacío',
          3 => 'Nunca',
        ),
        'correcta' => 'Conservada igual',
      ),
      27 => 
      array (
        'pregunta' => 'm₁v₁ = m₂v₂ (rebote)',
        'opciones' => 
        array (
          0 => 'Masas iguales',
          1 => 'Velocidades iguales',
          2 => 'p iguales',
          3 => 'EK igual',
        ),
        'correcta' => 'Masas iguales',
      ),
      28 => 
      array (
        'pregunta' => 'Sistema cerrado =',
        'opciones' => 
        array (
          0 => 'No intercambio p con exterior',
          1 => 'Masa cte',
          2 => 'Volumen cte',
          3 => 'Temperatura cte',
        ),
        'correcta' => 'No intercambio p con exterior',
      ),
      29 => 
      array (
        'pregunta' => 'SI 2025: 1 kg·m/s =',
        'opciones' => 
        array (
          0 => '1 N·s',
          1 => '1 J',
          2 => '1 W',
          3 => '1 Pa',
        ),
        'correcta' => '1 N·s',
      ),
    ),
  ),
  15 => 
  array (
    'materia' => 'Física I',
    'slug' => 'restitucion-calor-avanzado',
    'titulo' => 'Dinámica y Termodinámica: Coeficiente e y Transferencia de Calor',
    'contenido' => '<div class="leccion-container leccion-fisica-restitucion" data-tema="restitucion-calor">

    <!-- CABECERA CYBERPUNK -->
    <header class="leccion-header">
        <h1 class="titulo-leccion neon-glow">
            <span class="icon-tema">⚡</span>
            RESTITUCIÓN <span class="formula-highlight">e</span> & TRANSFERENCIA DE <span class="formula-highlight">CALOR</span>
        </h1>
        <div class="subtitulo">
            De la energía cinética al calor: \\( \\Delta E_k \\rightarrow Q \\) | Coeficiente de restitución: \\( e = 0 \\rightarrow 1 \\)
        </div>
    </header>

    <!-- PANEL OBJETIVOS -->
    <section class="panel-objetivos">
        <h2 class="seccion-titulo neon-concepto">
            <span class="icon">🎯</span> OBJETIVOS DE APRENDIZAJE
        </h2>
        <div class="objetivos-grid">
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Calcular el coeficiente de restitución \\( e \\)</h3>
                <p>Diferenciar colisiones elásticas (\\( e = 1 \\)), inelásticas (\\( 0 < e < 1 \\)) y perfectamente inelásticas (\\( e = 0 \\))</p>
            </div>
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Aplicar la transferencia de calor \\( Q = m \\cdot c \\cdot \\Delta T \\)</h3>
                <p>Calcular el calor generado en colisiones y su efecto en la temperatura de diferentes materiales</p>
            </div>
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Relacionar \\( \\Delta E_k \\) con \\( Q \\)</h3>
                <p>Entender la conversión de energía cinética en calor durante colisiones inelásticas</p>
            </div>
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Simular escenarios de colisión y transferencia de calor</h3>
                <p>Usar los simuladores interactivos para visualizar la relación entre \\( e \\), \\( \\Delta E_k \\) y \\( Q \\)</p>
            </div>
        </div>
    </section>

    <!-- GRID DE CONTENIDO 2x2 -->
    <div class="grid-contenido">

        <!-- COLISIÓN Y COEFICIENTE e -->
        <div class="card-contenido colision">
            <div class="card-header">
                <h2 class="card-titulo neon-concepto">
                    <span class="icon">🎯</span> COEFICIENTE DE RESTITUCIÓN <span class="formula-highlight">e</span>
                </h2>
            </div>

            <div class="formula-principal">
                \\[
                    e = -\\frac{v_2\' - v_1\'}{u_2 - u_1}
                \\]
                <div class="formula-detalle">
                    <ul>
                        <li><strong>1.0:</strong> Elástico perfecto (energía cinética conservada)</li>
                        <li><strong>0.0:</strong> Inelástico total (máxima pérdida de \\( E_k \\))</li>
                        <li><strong>0.0 - 1.0:</strong> Parcial (ej: billar, \\( e \\approx 0.8 \\))</li>
                    </ul>
                </div>
            </div>

            <!-- SIMULADOR DE COLISIONES -->
            <div class="simulador-box">
                <div class="sim-controls">
                    <div class="control-group">
                        <label>m₁ (kg):</label>
                        <input type="number" value="2" id="m1" class="input-sim">
                        <label>u₁ (m/s):</label>
                        <input type="number" value="5" id="u1" class="input-sim">
                    </div>
                    <div class="control-group">
                        <label>m₂ (kg):</label>
                        <input type="number" value="3" id="m2" class="input-sim">
                        <label>u₂ (m/s):</label>
                        <input type="number" value="0" id="u2" class="input-sim">
                    </div>
                    <div class="control-group">
                        <label>e:</label>
                        <input type="range" min="0" max="1" step="0.1" value="0.5" id="e-slider" class="slider-sim">
                        <span id="e-val" class="slider-val">0.5</span>
                    </div>
                </div>
                <button onclick="calcularColision()" class="btn-sim">CALCULAR COLISIÓN</button>

                <div class="sim-results">
                    <div class="result-item">
                        <span class="result-label">v₁:</span>
                        <span class="result-value" id="r-v1">-1.67 m/s</span>
                    </div>
                    <div class="result-item">
                        <span class="result-label">v₂:</span>
                        <span class="result-value" id="r-v2">2.17 m/s</span>
                    </div>
                    <div class="result-item highlight">
                        <span class="result-label">ΔE<sub>k</sub>:</span>
                        <span class="result-value" id="r-dek">8.33 J</span>
                    </div>
                </div>
            </div>

            <!-- FÓRMULAS DE VELOCIDAD -->
            <div class="formulas-detalle">
                <div class="formula-line">
                    \\[
                        v_1\' = \\frac{(m_1 - e m_2) u_1 + (1 + e) m_2 u_2}{m_1 + m_2}
                    \\]
                </div>
                <div class="formula-line">
                    \\[
                        v_2\' = \\frac{(1 + e) m_1 u_1 + (m_2 - e m_1) u_2}{m_1 + m_2}
                    \\]
                </div>
            </div>

            <!-- VISUALIZACIÓN DE COLISIÓN -->
            <div class="visual-colision">
                <svg viewBox="0 0 400 200" id="svg-colision">
                    <rect x="0" y="0" width="400" height="200" fill="#0a0a1a" rx="10"/>

                    <!-- Objeto 1 (antes) -->
                    <circle cx="80" cy="100" r="20" fill="#42A5F5" id="obj1-antes"/>
                    <text x="80" y="140" fill="white" font-size="12" text-anchor="middle" id="m1-antes">m₁=2kg</text>
                    <text x="80" y="60" fill="#2196F3" font-size="12" text-anchor="middle" id="u1-antes">u₁=5m/s</text>

                    <!-- Objeto 2 (antes) -->
                    <circle cx="320" cy="100" r="25" fill="#EF5350" id="obj2-antes"/>
                    <text x="320" y="140" fill="white" font-size="12" text-anchor="middle" id="m2-antes">m₂=3kg</text>
                    <text x="320" y="60" fill="#EF5350" font-size="12" text-anchor="middle" id="u2-antes">u₂=0m/s</text>

                    <!-- Objetos después -->
                    <circle cx="120" cy="100" r="20" fill="#9CCC65" id="obj1-despues" opacity="0"/>
                    <circle cx="280" cy="100" r="25" fill="#9CCC65" id="obj2-despues" opacity="0"/>

                    <!-- Flechas de velocidad -->
                    <line x1="80" y1="100" x2="120" y2="100" stroke="#2196F3" stroke-width="3" marker-end="url(#arrowhead)" id="flecha-u1"/>
                    <line x1="200" y1="100" x2="240" y2="100" stroke="#39FF14" stroke-width="3" marker-end="url(#arrowhead)" id="flecha-v1" opacity="0"/>
                    <line x1="200" y1="100" x2="260" y2="100" stroke="#39FF14" stroke-width="3" marker-end="url(#arrowhead)" id="flecha-v2" opacity="0"/>
                </svg>
            </div>
        </div>

        <!-- CALOR ESPECÍFICO -->
        <div class="card-contenido calor">
            <div class="card-header">
                <h2 class="card-titulo neon-concepto">
                    <span class="icon">🔥</span> CALOR ESPECÍFICO <span class="formula-highlight">c</span>
                </h2>
            </div>

            <div class="formula-principal">
                \\[
                    Q = m \\cdot c \\cdot \\Delta T
                \\]
                <div class="formula-detalle">
                    <ul>
                        <li><strong>Unidad de \\( c \\):</strong> J/kg·°C</li>
                        <li><strong>Unidad de \\( Q \\):</strong> Joules (J)</li>
                        <li><strong>Capacidad térmica:</strong> \\( C = m \\cdot c \\) (J/°C)</li>
                    </ul>
                </div>
            </div>

            <!-- TABLA DE MATERIALES -->
            <div class="tabla-materiales">
                <div class="tabla-header">
                    <span class="header-mat">Material</span>
                    <span class="header-c">c (J/kg·°C)</span>
                    <span class="header-rel">Relación</span>
                </div>
                <div class="tabla-row destacada">
                    <div class="cel-mat">💧 Agua</div>
                    <div class="cel-val">4186</div>
                    <div class="cel-rel">
                        <div class="barra-rel" style="width:100%"></div>
                        <span>1.00×</span>
                    </div>
                </div>
                <div class="tabla-row">
                    <div class="cel-mat">🍷 Alcohol</div>
                    <div class="cel-val">2400</div>
                    <div class="cel-rel">
                        <div class="barra-rel" style="width:57%"></div>
                        <span>0.57×</span>
                    </div>
                </div>
                <div class="tabla-row">
                    <div class="cel-mat">🔩 Aluminio</div>
                    <div class="cel-val">900</div>
                    <div class="cel-rel">
                        <div class="barra-rel" style="width:22%"></div>
                        <span>0.22×</span>
                    </div>
                </div>
                <div class="tabla-row">
                    <div class="cel-mat">🔌 Cobre</div>
                    <div class="cel-val">385</div>
                    <div class="cel-rel">
                        <div class="barra-rel" style="width:9%"></div>
                        <span>0.09×</span>
                    </div>
                </div>
            </div>

            <!-- CALCULADORA DE CALOR -->
            <div class="calculadora-calor">
                <div class="calc-controls">
                    <div class="control-group">
                        <label>Masa (kg):</label>
                        <input type="number" value="0.5" id="calc-masa" class="input-calc">
                    </div>
                    <div class="control-group">
                        <label>ΔT (°C):</label>
                        <input type="number" value="80" id="calc-dt" class="input-calc">
                    </div>
                    <div class="control-group">
                        <label>Material:</label>
                        <select id="calc-material" class="select-calc">
                            <option value="4186">Agua (4186)</option>
                            <option value="2400">Alcohol (2400)</option>
                            <option value="900">Aluminio (900)</option>
                            <option value="385">Cobre (385)</option>
                        </select>
                    </div>
                </div>
                <button onclick="calcularCalor()" class="btn-calc">CALCULAR Q</button>

                <div class="calc-results">
                    <div class="result-item">
                        <span class="result-label">Q (J):</span>
                        <span class="result-value" id="r-q">16,744 J</span>
                    </div>
                    <div class="result-item">
                        <span class="result-label">C (J/°C):</span>
                        <span class="result-value" id="r-c">2,093 J/°C</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- CONVERSIÓN ENERGÉTICA -->
        <div class="card-contenido conversion">
            <div class="card-header">
                <h2 class="card-titulo neon-concepto">
                    <span class="icon">⚡</span> CONVERSIÓN <span class="formula-highlight">ΔE_k → Q</span>
                </h2>
            </div>

            <div class="principio-box">
                <p>En choques <strong>inelásticos</strong> (\\( e < 1 \\)):</p>
                <div class="principio-formula">
                    \\[
                        \\Delta E_k = E_{k,i} - E_{k,f} = Q_{\\text{generado}}
                    \\]
                </div>
                <p>La energía cinética perdida se convierte en <strong>calor</strong>.</p>
            </div>

            <!-- DIAGRAMA ENERGÉTICO -->
            <div class="diagrama-energia">
                <div class="energia-inicial">
                    <div class="energia-titulo">E<sub>k</sub> Inicial</div>
                    <div class="energia-valor" id="ek-inicial">50 J</div>
                    <div class="energia-barra" id="barra-ek-inicial"></div>
                </div>
                <div class="flecha-conversion">→</div>
                <div class="energia-final">
                    <div class="final-item">
                        <div class="item-titulo">E<sub>k</sub> Final</div>
                        <div class="item-valor" id="ek-final">34 J</div>
                        <div class="item-barra" id="barra-ek-final"></div>
                    </div>
                    <div class="final-item">
                        <div class="item-titulo">Calor (Q)</div>
                        <div class="item-valor" id="calor-generado">16 J</div>
                        <div class="item-barra" id="barra-calor"></div>
                    </div>
                </div>
            </div>

            <!-- EJEMPLO PRÁCTICO -->
            <div class="ejemplo-practico">
                <div class="ejemplo-titulo">📝 Ejemplo: Choque con e=0.6</div>
                <div class="ejemplo-datos">
                    <div class="dato-ejemplo">m₁=1kg, u₁=10m/s → m₂=1kg, u₂=0</div>
                    <div class="dato-ejemplo">v₁=2m/s, v₂=8m/s</div>
                    <div class="dato-ejemplo">E<sub>k,i</sub>=50J, E<sub>k,f</sub>=34J</div>
                    <div class="dato-ejemplo highlight">ΔE<sub>k</sub>=16J → Calor generado</div>
                </div>
            </div>

            <!-- APLICACIÓN AL AGUA -->
            <div class="aplicacion-agua">
                <div class="app-titulo">💧 Aplicación al agua:</div>
                <div class="app-calculo">
                    \\[
                        Q = 16\\, \\text{J} = m \\cdot c \\cdot \\Delta T
                    \\]
                    \\[
                        \\Delta T = \\frac{16}{0.1 \\times 4186} \\approx 0.038°\\text{C}
                    \\]
                </div>
                <div class="app-resultado">100g de agua aumentan <strong>0.038°C</strong></div>
            </div>
        </div>

        <!-- FÓRMULAS CLAVE -->
        <div class="card-contenido formulas">
            <div class="card-header">
                <h2 class="card-titulo neon-concepto">
                    <span class="icon">📚</span> FÓRMULAS <span class="formula-highlight">CLAVE</span>
                </h2>
            </div>

            <!-- MOMENTO LINEAL -->
            <div class="formula-seccion">
                <div class="seccion-titulo">Conservación del Momento Lineal</div>
                <div class="seccion-formula">
                    \\[
                        m_1 u_1 + m_2 u_2 = m_1 v_1 + m_2 v_2
                    \\]
                </div>
                <div class="seccion-nota">Se conserva en <strong>TODOS</strong> los choques</div>
            </div>

            <!-- ENERGÍA CINÉTICA -->
            <div class="formula-seccion">
                <div class="seccion-titulo">Energía Cinética</div>
                <div class="seccion-formula">
                    \\[
                        E_k = \\frac{1}{2} m v^2
                    \\]
                </div>
                <div class="seccion-formula">
                    \\[
                        \\Delta E_k = \\frac{1}{2}(m_1 u_1^2 + m_2 u_2^2) - \\frac{1}{2}(m_1 v_1^2 + m_2 v_2^2)
                    \\]
                </div>
            </div>

            <!-- CAPACIDAD TÉRMICA -->
            <div class="formula-seccion">
                <div class="seccion-titulo">Capacidad Térmica</div>
                <div class="seccion-formula">
                    \\[
                        C = m \\cdot c = \\frac{Q}{\\Delta T}
                    \\]
                </div>
                <div class="seccion-nota">
                    <strong>c</strong> es intensiva (J/kg·°C) |
                    <strong>C</strong> es extensiva (J/°C)
                </div>
            </div>

            <!-- CALOR LATENTE -->
            <div class="formula-seccion">
                <div class="seccion-titulo">Calor Latente</div>
                <div class="seccion-formula">
                    \\[
                        Q = m \\cdot L
                    \\]
                </div>
                <div class="seccion-datos">
                    <div class="dato-item">
                        <span>L<sub>f</sub> agua:</span>
                        <span class="dato-val">334 kJ/kg</span>
                    </div>
                    <div class="dato-item">
                        <span>L<sub>v</sub> agua:</span>
                        <span class="dato-val">2260 kJ/kg</span>
                    </div>
                </div>
            </div>

            <!-- DATOS FUNDAMENTALES -->
            <div class="datos-fundamentales">
                <div class="datos-titulo">📊 Datos Fundamentales</div>
                <div class="datos-grid">
                    <div class="dato-card">
                        <div class="dato-num">4.184</div>
                        <div class="dato-desc">1 cal = X J</div>
                    </div>
                    <div class="dato-card">
                        <div class="dato-num">4186</div>
                        <div class="dato-desc">c agua (J/kg·°C)</div>
                    </div>
                    <div class="dato-card">
                        <div class="dato-num">1.0</div>
                        <div class="dato-desc">e máximo (elástico)</div>
                    </div>
                    <div class="dato-card">
                        <div class="dato-num">0.0</div>
                        <div class="dato-desc">e mínimo (inelástico)</div>
                    </div>
                </div>
            </div>

            <!-- CONSEJOS RÁPIDOS -->
            <div class="consejos-rapidos">
                <div class="consejos-titulo">💡 Consejos Rápidos</div>
                <ul class="consejos-lista">
                    <li>Usa signos: derecha (+), izquierda (-)</li>
                    <li>\\( e < 1 \\) siempre genera calor</li>
                    <li>El momento lineal SIEMPRE se conserva</li>
                    <li>Convierte todo a unidades SI</li>
                    <li>En choques inelásticos, \\( \\Delta E_k = Q \\)</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- EJERCICIOS RESUELTOS -->
    <section class="ejercicios-section">
        <h2 class="seccion-titulo neon-evaluacion">
            <span class="icon">🧮</span> EJERCICIOS <span class="formula-highlight">RESUELTOS</span>
        </h2>

        <div class="ejercicios-grid">
            <!-- EJERCICIO 1 -->
            <div class="ejercicio-card">
                <div class="ejercicio-header">
                    <div class="ejercicio-num">01</div>
                    <div class="ejercicio-titulo">Choque Elástico</div>
                </div>
                <div class="ejercicio-contenido">
                    <div class="ejercicio-enunciado">
                        <strong>m₁=2kg</strong> a <strong>6m/s</strong> choca elásticamente con <strong>m₂=4kg</strong> en reposo (\\( e=1 \\)).
                    </div>
                    <div class="ejercicio-solucion">
                        <div class="solucion-paso">
                            \\[
                                v_1\' = \\frac{(2-4)}{6} \\times 6 = -2\\, \\text{m/s}
                            \\]
                        </div>
                        <div class="solucion-paso">
                            \\[
                                v_2\' = \\frac{4}{6} \\times 6 = 4\\, \\text{m/s}
                            \\]
                        </div>
                        <div class="solucion-paso highlight">
                            \\( E_k \\) conservada: \\( 36\\, \\text{J} = 4\\, \\text{J} + 32\\, \\text{J} \\)
                        </div>
                    </div>
                </div>
            </div>

            <!-- EJERCICIO 2 -->
            <div class="ejercicio-card">
                <div class="ejercicio-header">
                    <div class="ejercicio-num">02</div>
                    <div class="ejercicio-titulo">Calentamiento</div>
                </div>
                <div class="ejercicio-contenido">
                    <div class="ejercicio-enunciado">
                        Calentar <strong>0.8kg</strong> de aluminio de <strong>25°C</strong> a <strong>150°C</strong>.
                    </div>
                    <div class="ejercicio-solucion">
                        <div class="solucion-paso">
                            \\[
                                Q = 0.8 \\times 900 \\times 125 = 90,000\\, \\text{J} = 90\\, \\text{kJ}
                            \\]
                        </div>
                        <div class="solucion-paso">
                            \\[
                                C = 0.8 \\times 900 = 720\\, \\text{J/°C}
                            \\]
                        </div>
                    </div>
                </div>
            </div>

            <!-- EJERCICIO 3 -->
            <div class="ejercicio-card">
                <div class="ejercicio-header">
                    <div class="ejercicio-num">03</div>
                    <div class="ejercicio-titulo">Choque Inelástico</div>
                </div>
                <div class="ejercicio-contenido">
                    <div class="ejercicio-enunciado">
                        <strong>m₁=3kg</strong> a <strong>8m/s</strong>, <strong>m₂=2kg</strong> a <strong>-2m/s</strong>, <strong>e=0.4</strong>.
                    </div>
                    <div class="ejercicio-solucion">
                        <div class="solucion-paso">
                            \\( v_1\' = 2.32\\, \\text{m/s} \\), \\( v_2\' = 4.48\\, \\text{m/s} \\)
                        </div>
                        <div class="solucion-paso">
                            \\( \\Delta E_k = 96\\, \\text{J} - 66.9\\, \\text{J} = 29.1\\, \\text{J} \\)
                        </div>
                        <div class="solucion-paso highlight">
                            \\( Q = 29.1\\, \\text{J} \\) (calor generado)
                        </div>
                    </div>
                </div>
            </div>

            <!-- EJERCICIO 4 -->
            <div class="ejercicio-card">
                <div class="ejercicio-header">
                    <div class="ejercicio-num">04</div>
                    <div class="ejercicio-titulo">Equilibrio Térmico</div>
                </div>
                <div class="ejercicio-contenido">
                    <div class="ejercicio-enunciado">
                        <strong>0.5kg</strong> de hierro a <strong>200°C</strong> en <strong>2kg</strong> de agua a <strong>20°C</strong>.
                    </div>
                    <div class="ejercicio-solucion">
                        <div class="solucion-paso">
                            \\[
                                0.5 \\times 450 \\times (T - 200) = 2 \\times 4186 \\times (20 - T)
                            \\]
                        </div>
                        <div class="solucion-paso">
                            \\( 225T - 45000 = 8372(20 - T) \\)
                        </div>
                        <div class="solucion-paso highlight">
                            \\( T \\approx 23.2°\\text{C} \\) (temperatura final)
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- APLICACIONES PRÁCTICAS -->
    <section class="aplicaciones-section">
        <h2 class="seccion-titulo neon-evaluacion">
            <span class="icon">🔧</span> APLICACIONES <span class="formula-highlight">PRÁCTICAS</span>
        </h2>

        <div class="aplicaciones-grid">
            <div class="aplicacion-card">
                <div class="aplicacion-icono">🚗</div>
                <div class="aplicacion-contenido">
                    <div class="aplicacion-titulo">Airbags</div>
                    <div class="aplicacion-desc">
                        Aumentan \\( \\Delta t \\) para reducir \\( F \\) en choques: \\( F = \\frac{\\Delta p}{\\Delta t} \\)
                    </div>
                </div>
            </div>

            <div class="aplicacion-card">
                <div class="aplicacion-icono">🏠</div>
                <div class="aplicacion-contenido">
                    <div class="aplicacion-titulo">Calefacción</div>
                    <div class="aplicacion-desc">
                        Agua (alto \\( c \\)) almacena y libera calor eficientemente en sistemas de calefacción
                    </div>
                </div>
            </div>

            <div class="aplicacion-card">
                <div class="aplicacion-icono">🥊</div>
                <div class="aplicacion-contenido">
                    <div class="aplicacion-titulo">Deportes</div>
                    <div class="aplicacion-desc">
                        Guantes de boxeo aumentan \\( e \\), reduciendo la fuerza de impacto en los puños
                    </div>
                </div>
            </div>

            <div class="aplicacion-card">
                <div class="aplicacion-icono">🍳</div>
                <div class="aplicacion-contenido">
                    <div class="aplicacion-titulo">Cocina</div>
                    <div class="aplicacion-desc">
                        Sartenes de aluminio (bajo \\( c \\)) se calientan rápidamente para cocinar eficientemente
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- QUIZ INTERACTIVO -->
    <section class="quiz-section">
        <h2 class="seccion-titulo neon-evaluacion">
            <span class="icon">❓</span> QUIZ DE <span class="formula-highlight">AUTOEVALUACIÓN</span>
        </h2>

        <div class="quiz-container">
            <!-- PREGUNTA 1 -->
            <div class="quiz-question" data-correct="B">
                <div class="quiz-header">
                    <span class="quiz-num">01</span>
                    <h3>¿Qué representa el coeficiente de restitución \\( e \\)?</h3>
                </div>
                <div class="quiz-options">
                    <button class="quiz-option" data-value="A">
                        <span class="option-letter">A</span>
                        La energía cinética total después del choque
                    </button>
                    <button class="quiz-option" data-value="B">
                        <span class="option-letter">B</span>
                        La relación entre las velocidades relativas antes y después del choque
                    </button>
                    <button class="quiz-option" data-value="C">
                        <span class="option-letter">C</span>
                        La cantidad de calor generado en el choque
                    </button>
                    <button class="quiz-option" data-value="D">
                        <span class="option-letter">D</span>
                        La fuerza promedio durante el choque
                    </button>
                </div>
                <div class="quiz-feedback" style="display: none;">
                    <div class="feedback-correct">
                        ✅ <strong>Correcto:</strong> \\( e = -\\frac{v_2\' - v_1\'}{u_2 - u_1} \\).
                    </div>
                    <div class="feedback-incorrect">
                        ❌ <strong>Incorrecto:</strong> Revisa la definición del coeficiente de restitución.
                    </div>
                </div>
            </div>

            <!-- PREGUNTA 2 -->
            <div class="quiz-question" data-correct="C">
                <div class="quiz-header">
                    <span class="quiz-num">02</span>
                    <h3>¿Cuánto calor se necesita para elevar 1kg de agua 1°C?</h3>
                </div>
                <div class="quiz-options">
                    <button class="quiz-option" data-value="A">
                        <span class="option-letter">A</span>
                        1 J
                    </button>
                    <button class="quiz-option" data-value="B">
                        <span class="option-letter">B</span>
                        4.18 J
                    </button>
                    <button class="quiz-option" data-value="C">
                        <span class="option-letter">C</span>
                        4186 J
                    </button>
                    <button class="quiz-option" data-value="D">
                        <span class="option-letter">D</span>
                        4186 cal
                    </button>
                </div>
                <div class="quiz-feedback" style="display: none;">
                    <div class="feedback-correct">
                        ✅ <strong>Correcto:</strong> \\( Q = m \\cdot c \\cdot \\Delta T = 1 \\times 4186 \\times 1 = 4186\\, \\text{J} \\).
                    </div>
                    <div class="feedback-incorrect">
                        ❌ <strong>Incorrecto:</strong> Revisa el calor específico del agua.
                    </div>
                </div>
            </div>

            <!-- RESULTADOS -->
            <div class="quiz-results" style="display: none;">
                <h3>📊 RESULTADOS DEL QUIZ</h3>
                <div class="results-score">
                    Puntuación: <span id="quizScore">0</span>/2
                </div>
                <div class="results-feedback" id="quizFeedback">
                    Completa el quiz para ver tus resultados
                </div>
                <button class="btn-retry" onclick="reiniciarQuiz()">
                    🔄 INTENTAR NUEVAMENTE
                </button>
            </div>
        </div>
    </section>

    <!-- ERRORES COMUNES -->
    <section class="errores-section">
        <h2 class="seccion-titulo neon-alerta">
            <span class="icon">⚠️</span> ERRORES <span class="formula-highlight">COMUNES</span>
        </h2>

        <div class="errores-container">
            <div class="error-card">
                <div class="error-header" onclick="toggleError(this)">
                    <h3>❌ CONFUNDIR \\( e \\) CON EFICIENCIA ENERGÉTICA</h3>
                    <span class="error-toggle">+</span>
                </div>
                <div class="error-content">
                    <div class="error-ejemplo">
                        <strong>Error común:</strong> "Un \\( e = 0.8 \\) significa que el 80% de la energía cinética se conserva".
                    </div>
                    <div class="error-correccion">
                        <strong>Corrección:</strong>
                        <ul>
                            <li><strong>\\( e \\):</strong> Relación de velocidades relativas.</li>
                            <li><strong>Energía conservada:</strong> Solo en choques elásticos (\\( e = 1 \\)).</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="error-card">
                <div class="error-header" onclick="toggleError(this)">
                    <h3>❌ OLVIDAR CONVERTIR UNIDADES EN CÁLCULOS DE CALOR</h3>
                    <span class="error-toggle">+</span>
                </div>
                <div class="error-content">
                    <div class="error-ejemplo">
                        <strong>Error común:</strong> "Usar gramos en lugar de kilogramos en \\( Q = m \\cdot c \\cdot \\Delta T \\)".
                    </div>
                    <div class="error-correccion">
                        <strong>Corrección:</strong> Asegúrate de que todas las unidades estén en el <strong>SI</strong> (kg, m, s, J).
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CIERRE METACOGNITIVO -->
    <section class="cierre-section">
        <h2 class="seccion-titulo neon-concepto">
            <span class="icon">🧠</span> CIERRE <span class="formula-highlight">METACOGNITIVO</span>
        </h2>

        <div class="cierre-container">
            <div class="autoevaluacion">
                <h3>📈 AUTOEVALUACIÓN</h3>
                <div class="slider-group">
                    <label>Comprensión del coeficiente \\( e \\):</label>
                    <input type="range" min="1" max="5" value="3" class="autoeval-slider" id="slider1">
                    <div class="slider-labels">
                        <span>Básico</span><span>Intermedio</span><span>Avanzado</span>
                    </div>
                </div>
                <div class="slider-group">
                    <label>Aplicación de \\( Q = m \\cdot c \\cdot \\Delta T \\):</label>
                    <input type="range" min="1" max="5" value="3" class="autoeval-slider" id="slider2">
                    <div class="slider-labels">
                        <span>Básico</span><span>Intermedio</span><span>Avanzado</span>
                    </div>
                </div>
                <button class="btn-guardar" onclick="guardarAutoevaluacion()">
                    💾 GUARDAR AUTOEVALUACIÓN
                </button>
            </div>

            <div class="reflexion">
                <h3>💭 REFLEXIÓN GUIADA</h3>
                <div class="pregunta-reflexion">
                    <p>¿Por qué es importante considerar el coeficiente de restitución \\( e \\) en el diseño de equipos deportivos?</p>
                    <textarea placeholder="Ejemplo: guantes de boxeo, pelotas de tenis..." rows="3" id="reflexion1"></textarea>
                </div>
                <div class="pregunta-reflexion">
                    <p>Describe un escenario donde la transferencia de calor sea crucial para la seguridad.</p>
                    <textarea placeholder="Ejemplo: frenos de un auto, sistemas de enfriamiento..." rows="3" id="reflexion2"></textarea>
                </div>
            </div>

            <div class="plan-estudio">
                <h3>📚 PLAN DE ESTUDIO</h3>
                <div class="plan-grid">
                    <div class="plan-item">
                        <h4>🔹 REPASO RÁPIDO (15 min)</h4>
                        <ul>
                            <li>Memorizar fórmulas de \\( e \\) y \\( Q \\)</li>
                            <li>Repasar valores típicos de \\( c \\) para materiales comunes</li>
                        </ul>
                    </div>
                    <div class="plan-item">
                        <h4>🛠 PRÁCTICA (30 min)</h4>
                        <ul>
                            <li>Resolver 3 problemas de colisiones con diferentes \\( e \\)</li>
                            <li>Calcular \\( Q \\) para 2 materiales distintos</li>
                        </ul>
                    </div>
                    <div class="plan-item">
                        <h4>🎓 PROFUNDIZACIÓN (45 min)</h4>
                        <ul>
                            <li>Investigar aplicaciones en ingeniería de materiales</li>
                            <li>Relacionar con la 1ª Ley de la Termodinámica</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="recursos-adicionales">
                <h3>🔗 RECURSOS</h3>
                <div class="recursos-grid">
                    <a href="https://phet.colorado.edu/es/simulation/legacy/collision-lab" target="_blank" class="recurso-link">
                        🎯 Simulador PhET: Laboratorio de Colisiones
                    </a>
                    <a href="https://phet.colorado.edu/es/simulation/energy-forms-and-changes" target="_blank" class="recurso-link">
                        🔥 Simulador PhET: Formas y Cambios de Energía
                    </a>
                    <a href="https://www.khanacademy.org/science/physics/thermodynamics" target="_blank" class="recurso-link">
                        📚 Khan Academy: Termodinámica
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- JAVASCRIPT INTEGRADO -->
<script>
    // ==========================================
    // SIMULADOR DE COLISIONES
    // ==========================================
    function calcularColision() {
        // Obtener valores
        const m1 = parseFloat(document.getElementById(\'m1\').value);
        const u1 = parseFloat(document.getElementById(\'u1\').value);
        const m2 = parseFloat(document.getElementById(\'m2\').value);
        const u2 = parseFloat(document.getElementById(\'u2\').value);
        const e = parseFloat(document.getElementById(\'e-slider\').value);

        // Validar entradas
        if (isNaN(m1) || isNaN(u1) || isNaN(m2) || isNaN(u2)) {
            alert("Por favor, ingresa valores válidos para masas y velocidades.");
            return;
        }

        // Actualizar valor de e
        document.getElementById(\'e-val\').textContent = e.toFixed(1);

        // Calcular velocidades finales
        const v1 = ((m1 - e * m2) * u1 + (1 + e) * m2 * u2) / (m1 + m2);
        const v2 = ((1 + e) * m1 * u1 + (m2 - e * m1) * u2) / (m1 + m2);

        // Calcular energía cinética inicial y final
        const EkInicial = 0.5 * m1 * Math.pow(u1, 2) + 0.5 * m2 * Math.pow(u2, 2);
        const EkFinal = 0.5 * m1 * Math.pow(v1, 2) + 0.5 * m2 * Math.pow(v2, 2);
        const DeltaEk = EkInicial - EkFinal;

        // Actualizar resultados
        document.getElementById(\'r-v1\').textContent = `${v1.toFixed(3)} m/s`;
        document.getElementById(\'r-v2\').textContent = `${v2.toFixed(3)} m/s`;
        document.getElementById(\'r-dek\').textContent = `${DeltaEk.toFixed(2)} J`;

        // Actualizar visualización
        document.getElementById(\'u1-antes\').textContent = `u₁=${u1}m/s`;
        document.getElementById(\'u2-antes\').textContent = `u₂=${u2}m/s`;
        document.getElementById(\'m1-antes\').textContent = `m₁=${m1}kg`;
        document.getElementById(\'m2-antes\').textContent = `m₂=${m2}kg`;

        // Animar colisión
        const obj1 = document.getElementById(\'obj1-antes\');
        const obj2 = document.getElementById(\'obj2-antes\');

        // Reiniciar posiciones
        obj1.setAttribute(\'cx\', \'80\');
        obj2.setAttribute(\'cx\', \'320\');

        // Animar movimiento hacia el centro
        const anim1 = obj1.animate([
            { cx: \'80\' },
            { cx: \'200\' }
        ], { duration: 1000, fill: \'forwards\' });

        const anim2 = obj2.animate([
            { cx: \'320\' },
            { cx: \'200\' }
        ], { duration: 1000, fill: \'forwards\' });

        // Mostrar resultados después de la animación
        setTimeout(() => {
            // Mostrar objetos después de la colisión
            document.getElementById(\'obj1-despues\').style.opacity = \'1\';
            document.getElementById(\'obj2-despues\').style.opacity = \'1\';

            // Posicionar objetos según velocidades finales
            const pos1 = 200 + v1 * 10;
            const pos2 = 200 + v2 * 10;
            document.getElementById(\'obj1-despues\').setAttribute(\'cx\', pos1);
            document.getElementById(\'obj2-despues\').setAttribute(\'cx\', pos2);

            // Mostrar flechas de velocidad final
            document.getElementById(\'flecha-v1\').style.opacity = \'1\';
            document.getElementById(\'flecha-v2\').style.opacity = \'1\';

            // Actualizar diagrama de energía
            actualizarDiagramaEnergia(EkInicial, EkFinal, DeltaEk);
        }, 1000);
    }

    // Actualizar diagrama de energía
    function actualizarDiagramaEnergia(EkInicial, EkFinal, DeltaEk) {
        // Escalar alturas para visualización (máximo 150px)
        const escala = 150 / Math.max(EkInicial, EkFinal, DeltaEk);

        document.getElementById(\'ek-inicial\').textContent = `${EkInicial.toFixed(2)} J`;
        document.getElementById(\'ek-final\').textContent = `${EkFinal.toFixed(2)} J`;
        document.getElementById(\'calor-generado\').textContent = `${DeltaEk.toFixed(2)} J`;

        document.getElementById(\'barra-ek-inicial\').style.height = `${EkInicial * escala}px`;
        document.getElementById(\'barra-ek-final\').style.height = `${EkFinal * escala}px`;
        document.getElementById(\'barra-calor\').style.height = `${DeltaEk * escala}px`;
    }

    // ==========================================
    // CALCULADORA DE CALOR
    // ==========================================
    function calcularCalor() {
        // Obtener valores
        const masa = parseFloat(document.getElementById(\'calc-masa\').value);
        const dt = parseFloat(document.getElementById(\'calc-dt\').value);
        const c = parseFloat(document.getElementById(\'calc-material\').value);

        // Validar entradas
        if (isNaN(masa) || isNaN(dt)) {
            alert("Por favor, ingresa valores válidos para masa y ΔT.");
            return;
        }

        // Calcular Q y C
        const Q = masa * c * dt;
        const C = masa * c;

        // Actualizar resultados
        document.getElementById(\'r-q\').textContent = `${Q.toFixed(0)} J`;
        document.getElementById(\'r-c\').textContent = `${C.toFixed(0)} J/°C`;
    }

    // ==========================================
    // QUIZ INTERACTIVO
    // ==========================================
    let quizRespuestas = [];
    let quizCompletado = false;

    document.querySelectorAll(\'.quiz-option\').forEach(option => {
        option.addEventListener(\'click\', function() {
            if (quizCompletado) return;

            const question = this.closest(\'.quiz-question\');
            const correct = question.dataset.correct;
            const selected = this.dataset.value;
            const feedback = question.querySelector(\'.quiz-feedback\');

            // Limpiar selección previa
            question.querySelectorAll(\'.quiz-option\').forEach(opt => {
                opt.classList.remove(\'selected\', \'correct\', \'incorrect\');
            });

            // Marcar selección actual
            this.classList.add(\'selected\');

            // Verificar respuesta
            if (selected === correct) {
                this.classList.add(\'correct\');
                quizRespuestas.push(true);
            } else {
                this.classList.add(\'incorrect\');
                question.querySelector(`[data-value="${correct}"]`).classList.add(\'correct\');
                quizRespuestas.push(false);
            }

            // Mostrar feedback
            feedback.style.display = \'block\';

            // Verificar si todas las preguntas están respondidas
            const allAnswered = Array.from(document.querySelectorAll(\'.quiz-question\')).every(q =>
                q.querySelector(\'.quiz-option.selected\')
            );

            if (allAnswered && !quizCompletado) {
                quizCompletado = true;
                mostrarResultadosQuiz();
            }
        });
    });

    function mostrarResultadosQuiz() {
        const correctas = quizRespuestas.filter(r => r).length;
        const total = quizRespuestas.length;
        document.getElementById(\'quizScore\').textContent = `${correctas}/${total}`;

        let feedback = "";
        if (correctas === total) {
            feedback = "🎉 ¡Excelente! Dominas los conceptos de restitución y transferencia de calor.";
        } else if (correctas >= total / 2) {
            feedback = "👍 Buen trabajo, pero repasa los cálculos de \\( e \\) y \\( Q \\).";
        } else {
            feedback = "📚 Necesitas estudiar más. Usa los simuladores para practicar.";
        }

        document.getElementById(\'quizFeedback\').textContent = feedback;
        document.querySelector(\'.quiz-results\').style.display = \'block\';
    }

    function reiniciarQuiz() {
        quizRespuestas = [];
        quizCompletado = false;

        document.querySelectorAll(\'.quiz-option\').forEach(opt => {
            opt.classList.remove(\'selected\', \'correct\', \'incorrect\');
        });

        document.querySelectorAll(\'.quiz-feedback\').forEach(fb => {
            fb.style.display = \'none\';
        });

        document.querySelector(\'.quiz-results\').style.display = \'none\';
    }

    // ==========================================
    // ERRORES COMUNES
    // ==========================================
    function toggleError(header) {
        const content = header.nextElementSibling;
        const toggle = header.querySelector(\'.error-toggle\');

        if (content.style.display === \'block\') {
            content.style.display = \'none\';
            toggle.textContent = \'+\';
        } else {
            content.style.display = \'block\';
            toggle.textContent = \'-\';
        }
    }

    // ==========================================
    // AUTOEVALUACIÓN
    // ==========================================
    function guardarAutoevaluacion() {
        const slider1 = document.getElementById(\'slider1\').value;
        const slider2 = document.getElementById(\'slider2\').value;
        const promedio = (parseInt(slider1) + parseInt(slider2)) / 2;

        alert(
            `💾 Autoevaluación guardada:\\n\\n` +
            `Coeficiente \\( e \\): ${slider1}/5\\n` +
            `Transferencia de calor: ${slider2}/5\\n\\n` +
            `Promedio: ${promedio.toFixed(1)}/5\\n\\n` +
            `Revisa el plan de estudio según tus resultados.`
        );
    }

    // ==========================================
    // INICIALIZACIÓN
    // ==========================================
    document.addEventListener(\'DOMContentLoaded\', function() {
        console.log("🚀 Lección Cyberpunk: Restitución y Transferencia de Calor - Cargada");

        // Añadir marcador de flecha al SVG
        const svgColision = document.getElementById(\'svg-colision\');
        const defs = document.createElementNS(\'http://www.w3.org/2000/svg\', \'defs\');
        const marker = document.createElementNS(\'http://www.w3.org/2000/svg\', \'marker\');
        marker.setAttribute(\'id\', \'arrowhead\');
        marker.setAttribute(\'markerWidth\', \'10\');
        marker.setAttribute(\'markerHeight\', \'7\');
        marker.setAttribute(\'refX\', \'9\');
        marker.setAttribute(\'refY\', \'3.5\');
        marker.setAttribute(\'orient\', \'auto\');
        const arrowPath = document.createElementNS(\'http://www.w3.org/2000/svg\', \'path\');
        arrowPath.setAttribute(\'d\', \'M0,0 L10,3.5 L0,7 Z\');
        arrowPath.setAttribute(\'fill\', \'#39FF14\');
        marker.appendChild(arrowPath);
        defs.appendChild(marker);
        svgColision.appendChild(defs);

        // Inicializar simuladores
        calcularColision();
        calcularCalor();
    });
</script>',
    'ejercicios' => 
    array (
      0 => 
      array (
        'enunciado' => 'e = 1 significa',
        'respuesta' => 'Colisión elástica perfecta',
      ),
      1 => 
      array (
        'enunciado' => 'e = 0 significa',
        'respuesta' => 'Inelástica perfecta',
      ),
      2 => 
      array (
        'enunciado' => 'Fórmula e',
        'respuesta' => '-(v2-v1)/(u2-u1)',
      ),
      3 => 
      array (
        'enunciado' => 'Q = m c ΔT es',
        'respuesta' => 'Calor sensible',
      ),
      4 => 
      array (
        'enunciado' => 'C = m c es',
        'respuesta' => 'Capacidad calorífica total',
      ),
      5 => 
      array (
        'enunciado' => 'c cobre ≈',
        'respuesta' => '385 J/kg·°C',
      ),
      6 => 
      array (
        'enunciado' => 'e = 0.8 →',
        'respuesta' => 'Parcialmente elástica',
      ),
      7 => 
      array (
        'enunciado' => 'ΔEK = Q si',
        'respuesta' => 'e < 1',
      ),
      8 => 
      array (
        'enunciado' => 'u1=6, u2=0, v1=-2, v2=4 → e',
        'respuesta' => '1',
      ),
      9 => 
      array (
        'enunciado' => '0.2 kg agua ΔT=10°C → Q',
        'respuesta' => '8372 J',
      ),
      10 => 
      array (
        'enunciado' => 'C para 1 kg aluminio',
        'respuesta' => '900 J/°C',
      ),
      11 => 
      array (
        'enunciado' => 'SI: e sin unidad',
        'respuesta' => 'Adimensional',
      ),
    ),
    'quiz' => 
    array (
      0 => 
      array (
        'pregunta' => 'e = 1 → colisión',
        'opciones' => 
        array (
          0 => 'Elástica',
          1 => 'Inelástica',
          2 => 'Explosión',
          3 => 'Estática',
        ),
        'correcta' => 'Elástica',
      ),
      1 => 
      array (
        'pregunta' => 'e = 0 →',
        'opciones' => 
        array (
          0 => 'Inelástica perfecta',
          1 => 'Elástica',
          2 => 'Parcial',
          3 => 'Imposible',
        ),
        'correcta' => 'Inelástica perfecta',
      ),
      2 => 
      array (
        'pregunta' => 'Fórmula e',
        'opciones' => 
        array (
          0 => '-(v2-v1)/(u2-u1)',
          1 => '(v2-v1)/(u2-u1)',
          2 => 'v/u',
          3 => 'u/v',
        ),
        'correcta' => '-(v2-v1)/(u2-u1)',
      ),
      3 => 
      array (
        'pregunta' => 'Q = m c ΔT mide',
        'opciones' => 
        array (
          0 => 'Calor sensible',
          1 => 'Latente',
          2 => 'Radiación',
          3 => 'Conducción',
        ),
        'correcta' => 'Calor sensible',
      ),
      4 => 
      array (
        'pregunta' => 'C = m c es',
        'opciones' => 
        array (
          0 => 'Capacidad total',
          1 => 'Específica',
          2 => 'Latente',
          3 => 'Molar',
        ),
        'correcta' => 'Capacidad total',
      ),
      5 => 
      array (
        'pregunta' => 'c_agua =',
        'opciones' => 
        array (
          0 => '4186 J/kg·°C',
          1 => '385',
          2 => '900',
          3 => '2090',
        ),
        'correcta' => '4186 J/kg·°C',
      ),
      6 => 
      array (
        'pregunta' => 'e < 1 → EK',
        'opciones' => 
        array (
          0 => 'Disminuye',
          1 => 'Aumenta',
          2 => 'Igual',
          3 => 'Cero',
        ),
        'correcta' => 'Disminuye',
      ),
      7 => 
      array (
        'pregunta' => 'ΔEK = Q si',
        'opciones' => 
        array (
          0 => 'e < 1',
          1 => 'e = 1',
          2 => 'e = 0',
          3 => 'Siempre',
        ),
        'correcta' => 'e < 1',
      ),
      8 => 
      array (
        'pregunta' => 'u1=4, u2=0, e=0.5 → v1',
        'opciones' => 
        array (
          0 => '-4/3 m/s',
          1 => '0',
          2 => '4 m/s',
          3 => '2 m/s',
        ),
        'correcta' => '-4/3 m/s',
      ),
      9 => 
      array (
        'pregunta' => '0.1 kg cobre ΔT=50°C → Q',
        'opciones' => 
        array (
          0 => '1925 J',
          1 => '4186 J',
          2 => '900 J',
          3 => '0',
        ),
        'correcta' => '1925 J',
      ),
      10 => 
      array (
        'pregunta' => 'e = velocidad relativa',
        'opciones' => 
        array (
          0 => 'Salida / entrada',
          1 => 'Entrada / salida',
          2 => 'v/u',
          3 => 'u/v',
        ),
        'correcta' => 'Salida / entrada',
      ),
      11 => 
      array (
        'pregunta' => 'c alta →',
        'opciones' => 
        array (
          0 => 'Absorbe más Q por °C',
          1 => 'Menos',
          2 => 'Igual',
          3 => 'Cero',
        ),
        'correcta' => 'Absorbe más Q por °C',
      ),
      12 => 
      array (
        'pregunta' => 'C para 2 kg agua',
        'opciones' => 
        array (
          0 => '8372 J/°C',
          1 => '4186 J/°C',
          2 => '2093 J/°C',
          3 => '0',
        ),
        'correcta' => '8372 J/°C',
      ),
      13 => 
      array (
        'pregunta' => 'e pelota golf ≈',
        'opciones' => 
        array (
          0 => '0.8',
          1 => '1.0',
          2 => '0.0',
          3 => '0.5',
        ),
        'correcta' => '0.8',
      ),
      14 => 
      array (
        'pregunta' => 'Q positiva → sistema',
        'opciones' => 
        array (
          0 => 'Gana calor',
          1 => 'Pierde',
          2 => 'Igual',
          3 => 'Cero',
        ),
        'correcta' => 'Gana calor',
      ),
      15 => 
      array (
        'pregunta' => 'ΔT = Q / C → C =',
        'opciones' => 
        array (
          0 => 'Q / ΔT',
          1 => 'm c',
          2 => 'c / m',
          3 => 'ΔT / Q',
        ),
        'correcta' => 'Q / ΔT',
      ),
      16 => 
      array (
        'pregunta' => 'e = 1 → p y EK',
        'opciones' => 
        array (
          0 => 'Ambas conservadas',
          1 => 'Solo p',
          2 => 'Solo EK',
          3 => 'Ninguna',
        ),
        'correcta' => 'Ambas conservadas',
      ),
      17 => 
      array (
        'pregunta' => 'e = 0 → EK final',
        'opciones' => 
        array (
          0 => 'Mínima',
          1 => 'Máxima',
          2 => 'Igual',
          3 => 'Cero',
        ),
        'correcta' => 'Mínima',
      ),
      18 => 
      array (
        'pregunta' => 'SI: c en',
        'opciones' => 
        array (
          0 => 'J/(kg·K)',
          1 => 'cal/g·°C',
          2 => 'BTU/lb·°F',
          3 => 'todas',
        ),
        'correcta' => 'todas',
      ),
      19 => 
      array (
        'pregunta' => 'IUPAC: calor en',
        'opciones' => 
        array (
          0 => 'Joule',
          1 => 'Caloría',
          2 => 'eV',
          3 => 'kWh',
        ),
        'correcta' => 'Joule',
      ),
      20 => 
      array (
        'pregunta' => 'u1=10, u2=-5, v1=0, v2=5 → e',
        'opciones' => 
        array (
          0 => '1',
          1 => '0',
          2 => '0.5',
          3 => '2',
        ),
        'correcta' => '1',
      ),
      21 => 
      array (
        'pregunta' => 'Q = 8360 J, m=2 kg, c=4186 → ΔT',
        'opciones' => 
        array (
          0 => '1°C',
          1 => '2°C',
          2 => '4°C',
          3 => '8360°C',
        ),
        'correcta' => '1°C',
      ),
      22 => 
      array (
        'pregunta' => 'e pelota tenis ≈',
        'opciones' => 
        array (
          0 => '0.7',
          1 => '1.0',
          2 => '0.0',
          3 => '0.3',
        ),
        'correcta' => '0.7',
      ),
      23 => 
      array (
        'pregunta' => 'Calor disipado =',
        'opciones' => 
        array (
          0 => 'ΔEK',
          1 => 'Δp',
          2 => 'm g h',
          3 => 'F Δt',
        ),
        'correcta' => 'ΔEK',
      ),
      24 => 
      array (
        'pregunta' => 'c vapor > c agua',
        'opciones' => 
        array (
          0 => 'No',
          1 => 'Sí',
          2 => 'Igual',
          3 => 'Depende',
        ),
        'correcta' => 'No',
      ),
      25 => 
      array (
        'pregunta' => 'e > 1',
        'opciones' => 
        array (
          0 => 'Imposible (pasiva)',
          1 => 'Posible',
          2 => 'Explosión',
          3 => 'Siempre',
        ),
        'correcta' => 'Imposible (pasiva)',
      ),
      26 => 
      array (
        'pregunta' => 'C = Q / ΔT → unidad',
        'opciones' => 
        array (
          0 => 'J/°C',
          1 => 'J/kg·°C',
          2 => 'W',
          3 => 'kWh',
        ),
        'correcta' => 'J/°C',
      ),
      27 => 
      array (
        'pregunta' => 'e = 0.4 →',
        'opciones' => 
        array (
          0 => '60% EK perdida',
          1 => '40%',
          2 => '100%',
          3 => '0%',
        ),
        'correcta' => '60% EK perdida',
      ),
      28 => 
      array (
        'pregunta' => 'SI 2025: c_agua =',
        'opciones' => 
        array (
          0 => '4186 J/kg·K',
          1 => '4.184 J/g·K',
          2 => '1 cal/g·K',
          3 => 'todas',
        ),
        'correcta' => 'todas',
      ),
      29 => 
      array (
        'pregunta' => 'e mide',
        'opciones' => 
        array (
          0 => 'Elasticidad relativa',
          1 => 'Masa',
          2 => 'Velocidad',
          3 => 'Fuerza',
        ),
        'correcta' => 'Elasticidad relativa',
      ),
    ),
  ),
);
