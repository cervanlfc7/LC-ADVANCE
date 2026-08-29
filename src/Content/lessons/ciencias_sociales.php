<?php
/**
 * Materia: Ciencias Sociales
 * Lecciones: 5
 */
return array (
  0 => 
  array (
    'materia' => 'Ciencias Sociales',
    'slug' => 'bienestar-satisfaccion-necesidades',
    'titulo' => 'El Bienestar y la Pirámide de Maslow',
    'contenido' => '<!-- INICIO LECCIÓN CYBERPUNK -->
<div class="leccion-container leccion-ciencias-sociales-bienestar" data-tema="piramide-maslow">
    <!-- CABECERA CYBERPUNK -->
    <header class="leccion-header">
        <h1 class="titulo-leccion neon-glow">
            <span class="icon-tema">🔺</span>
            PIRÁMIDE DE MASLOW: EL CAMINO AL BIENESTAR
        </h1>
        <div class="subtitulo">
            De la supervivencia a la autorrealización en la sociedad digital
        </div>
    </header>

    <!-- PANEL OBJETIVOS -->
    <section class="panel-objetivos">
        <h2 class="seccion-titulo neon-concepto">
            <span class="icon">@</span> OBJETIVOS DE APRENDIZAJE
        </h2>
        <div class="objetivos-grid">
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Identificar los 5 niveles de la pirámide</h3>
                <p>Diferenciar necesidades fisiológicas, de seguridad, sociales, de estima y de autorrealización</p>
            </div>
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Analizar la jerarquía de necesidades</h3>
                <p>Explicar por qué se satisfacen niveles inferiores antes que superiores</p>
            </div>
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Aplicar la teoría a casos reales</h3>
                <p>Relacionar la pirámide con situaciones cotidianas y profesionales</p>
            </div>
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Evaluar el impacto cultural</h3>
                <p>Comparar cómo varía la aplicación de la pirámide en diferentes culturas</p>
            </div>
        </div>
    </section>

    <!-- CONTEXTO REAL -->
    <section class="contexto-real">
        <h2 class="seccion-titulo neon-dato">
            <span class="icon">⓪</span> APLICACIÓN EN EL MUNDO REAL
        </h2>
        <div class="contexto-grid">
            <div class="contexto-card">
                <h3>🏥 Salud Pública</h3>
                <p>Programas sociales priorizan necesidades fisiológicas (alimentación) antes que de estima (reconocimiento)</p>
                <div class="dato-neon">82% de países usan este modelo</div>
            </div>
            <div class="contexto-card">
                <h3>💼 Recursos Humanos</h3>
                <p>Empresas tecnológicas diseñan beneficios según la pirámide: seguro médico (nivel 2) → bonos (nivel 4)</p>
                <div class="dato-neon">+30% retención de talento</div>
            </div>
            <div class="contexto-card">
                <h3>🎓 Educación</h3>
                <p>Escuelas implementan programas de pertenencia (nivel 3) para mejorar rendimiento académico (nivel 4)</p>
                <div class="dato-neon">15% aumento en calificaciones</div>
            </div>
        </div>
    </section>

    <!-- TEORÍA INTERACTIVA -->
    <section class="teoria-section">
        <div class="borde-neon-lateral"></div>
        <h2 class="seccion-titulo neon-concepto">
            <span class="icon">📚</span> FUNDAMENTOS TEÓRICOS
        </h2>

        <!-- PIRÁMIDE ANIMADA INTERACTIVA -->
        <div class="piramide-container">
            <div class="piramide-svg">
                <svg viewBox="0 0 800 500" id="piramideMaslow">
                    <!-- Fondo -->
                    <rect x="0" y="0" width="800" height="500" fill="#0a0a1a"/>

                    <!-- Nivel 1: Fisiológicas -->
                    <g id="nivel1" class="nivel-piramide" data-nivel="1" data-nombre="Fisiológicas" data-ejemplo="Aire, agua, comida" data-color="#2196F3">
                        <polygon points="200,400 600,400 400,300" fill="#2196F3" class="nivel-polygon"/>
                        <text x="400" y="360" fill="white" font-size="16" text-anchor="middle" class="nivel-text">FISIOLÓGICAS</text>
                        <text x="400" y="380" fill="white" font-size="12" text-anchor="middle" class="nivel-subtext">Supervivencia básica</text>
                    </g>

                    <!-- Nivel 2: Seguridad -->
                    <g id="nivel2" class="nivel-piramide" data-nivel="2" data-nombre="Seguridad" data-ejemplo="Empleo, vivienda, salud" data-color="#4CAF50">
                        <polygon points="220,300 580,300 400,220" fill="#4CAF50" class="nivel-polygon"/>
                        <text x="400" y="265" fill="white" font-size="16" text-anchor="middle" class="nivel-text">SEGURIDAD</text>
                        <text x="400" y="285" fill="white" font-size="12" text-anchor="middle" class="nivel-subtext">Estabilidad y protección</text>
                    </g>

                    <!-- Nivel 3: Sociales -->
                    <g id="nivel3" class="nivel-piramide" data-nivel="3" data-nombre="Sociales" data-ejemplo="Amistad, familia, amor" data-color="#FF9800">
                        <polygon points="240,220 560,220 400,150" fill="#FF9800" class="nivel-polygon"/>
                        <text x="400" y="190" fill="white" font-size="16" text-anchor="middle" class="nivel-text">SOCIALES</text>
                        <text x="400" y="210" fill="white" font-size="12" text-anchor="middle" class="nivel-subtext">Pertenencia y afecto</text>
                    </g>

                    <!-- Nivel 4: Estima -->
                    <g id="nivel4" class="nivel-piramide" data-nivel="4" data-nombre="Estima" data-ejemplo="Reconocimiento, logros" data-color="#F44336">
                        <polygon points="260,150 540,150 400,90" fill="#F44336" class="nivel-polygon"/>
                        <text x="400" y="125" fill="white" font-size="16" text-anchor="middle" class="nivel-text">ESTIMA</text>
                        <text x="400" y="145" fill="white" font-size="12" text-anchor="middle" class="nivel-subtext">Respeto y autoestima</text>
                    </g>

                    <!-- Nivel 5: Autorrealización -->
                    <g id="nivel5" class="nivel-piramide" data-nivel="5" data-nombre="Autorrealización" data-ejemplo="Creatividad, crecimiento personal" data-color="#FFD700">
                        <polygon points="280,90 520,90 400,40" fill="#FFD700" class="nivel-polygon"/>
                        <text x="400" y="70" fill="#212121" font-size="16" text-anchor="middle" class="nivel-text">AUTORREALIZACIÓN</text>
                        <text x="400" y="90" fill="#212121" font-size="12" text-anchor="middle" class="nivel-subtext">Crecimiento y potencial</text>
                    </g>

                    <!-- Base informativa -->
                    <rect x="100" y="420" width="600" height="60" fill="rgba(0,0,0,0.7)" rx="10"/>
                    <text x="400" y="450" fill="#E0F0FF" font-size="14" text-anchor="middle" class="base-text">Satisfacer niveles inferiores → Acceso a superiores</text>
                    <text x="400" y="475" fill="#BBDEFB" font-size="12" text-anchor="middle" class="base-text">Teoría de Abraham Maslow (1943) adaptada a contextos modernos</text>
                </svg>
            </div>

            <!-- Panel de información -->
            <div class="piramide-info">
                <h3 id="info-titulo">Selecciona un nivel de la pirámide</h3>
                <div id="info-contenido">
                    <p><strong>Nivel:</strong> <span id="info-nivel">-</span></p>
                    <p><strong>Nombre:</strong> <span id="info-nombre">-</span></p>
                    <p><strong>Ejemplos:</strong> <span id="info-ejemplo">-</span></p>
                    <p><strong>Estado actual:</strong> <span id="info-estado">No seleccionado</span></p>
                </div>
            </div>
        </div>

        <!-- PRINCIPIOS CLAVE -->
        <div class="principios-section">
            <h3 class="subseccion-titulo">⚡ PRINCIPIOS FUNDAMENTALES</h3>
            <div class="principios-grid">
                <div class="principio-card">
                    <div class="principio-icon">🔄</div>
                    <h4>JERARQUÍA</h4>
                    <p>Las necesidades inferiores deben satisfacerse antes que las superiores. Ejemplo: No puedes buscar reconocimiento (nivel 4) si tienes hambre (nivel 1).</p>
                </div>
                <div class="principio-card">
                    <div class="principio-icon">🎯</div>
                    <h4>MOTIVACIÓN</h4>
                    <p>Una necesidad satisfecha deja de ser motivadora. Ejemplo: Al conseguir un empleo estable (nivel 2), buscas amistad (nivel 3).</p>
                </div>
                <div class="principio-card">
                    <div class="principio-icon">🌍</div>
                    <h4>CULTURAL</h4>
                    <p>Aplicación universal con variaciones locales. Ejemplo: En Japón, el nivel 3 (social) incluye "armonía grupal"; en Occidente, "individualidad".</p>
                </div>
            </div>
        </div>

        <!-- EJEMPLO INTERACTIVO -->
        <div class="ejemplo-interactivo">
            <h3 class="subseccion-titulo">💡 EJEMPLO PRÁCTICO: ESTUDIANTE UNIVERSITARIO</h3>
            <div class="ejemplo-pasos">
                <div class="paso-card" data-paso="1">
                    <div class="paso-header">
                        <span class="paso-num">01</span>
                        <h4>Nivel 1: Fisiológicas</h4>
                    </div>
                    <p>El estudiante tiene hambre. <strong>No puede concentrarse</strong> en estudiar hasta que come.</p>
                    <div class="paso-icon">🍔</div>
                </div>
                <div class="paso-card" data-paso="2">
                    <div class="paso-header">
                        <span class="paso-num">02</span>
                        <h4>Nivel 2: Seguridad</h4>
                    </div>
                    <p>Con el estómago lleno, busca <strong>estabilidad económica</strong> (beca o trabajo parcial).</p>
                    <div class="paso-icon">💰</div>
                </div>
                <div class="paso-card" data-paso="3">
                    <div class="paso-header">
                        <span class="paso-num">03</span>
                        <h4>Nivel 3: Sociales</h4>
                    </div>
                    <p>Con seguridad económica, busca <strong>amistades</strong> en la universidad y grupos de estudio.</p>
                    <div class="paso-icon">👥</div>
                </div>
                <div class="paso-card" data-paso="4">
                    <div class="paso-header">
                        <span class="paso-num">04</span>
                        <h4>Nivel 4: Estima</h4>
                    </div>
                    <p>Con apoyo social, busca <strong>reconocimiento</strong> (buenas calificaciones, liderazgo).</p>
                    <div class="paso-icon">🏆</div>
                </div>
                <div class="paso-card" data-paso="5">
                    <div class="paso-header">
                        <span class="paso-num">05</span>
                        <h4>Nivel 5: Autorrealización</h4>
                    </div>
                    <p>Finalmente, explora su <strong>creatividad</strong> (proyectos personales, investigación).</p>
                    <div class="paso-icon">🎨</div>
                </div>
            </div>
        </div>
    </section>

    <!-- SIMULADOR INTERACTIVO -->
    <section class="simulator-section">
        <h2 class="seccion-titulo neon-interactivo">
            <span class="icon">🎮</span> SIMULADOR: CONSTRUYE TU PIRÁMIDE
        </h2>
        <div class="simulator-container" data-tema="piramide-maslow">
            <div class="simulator-controls">
                <h3>📋 CONTROLES</h3>
                <div class="control-group">
                    <label for="personaSelect">Selecciona un perfil:</label>
                    <select id="personaSelect" class="control-select">
                        <option value="estudiante">Estudiante universitario</option>
                        <option value="emprendedor">Emprendedor</option>
                        <option value="padre">Padre/madre de familia</option>
                        <option value="artista">Artista</option>
                        <option value="personalizado">Personalizado</option>
                    </select>
                </div>
                <div class="control-group" id="niveles-container">
                    <label>Niveles satisfechos:</label>
                    <div class="checkbox-group">
                        <label><input type="checkbox" name="nivel" value="1" checked> Nivel 1 (Fisiológicas)</label>
                        <label><input type="checkbox" name="nivel" value="2"> Nivel 2 (Seguridad)</label>
                        <label><input type="checkbox" name="nivel" value="3"> Nivel 3 (Sociales)</label>
                        <label><input type="checkbox" name="nivel" value="4"> Nivel 4 (Estima)</label>
                        <label><input type="checkbox" name="nivel" value="5"> Nivel 5 (Autorrealización)</label>
                    </div>
                </div>
                <button class="btn-simular" onclick="simularPiramide()">
                    <span class="btn-icon">🔄</span> SIMULAR
                </button>
                <button class="btn-aleatorio" onclick="perfilAleatorio()">
                    <span class="btn-icon">🎲</span> PERFIL ALEATORIO
                </button>
            </div>

            <!-- Visualización -->
            <div class="simulator-visualization">
                <div class="piramide-simulada" id="piramideSimulada">
                    <!-- Se generará dinámicamente -->
                </div>
                <div class="simulacion-info" id="simulacionInfo">
                    Selecciona un perfil y haz clic en "SIMULAR"
                </div>
            </div>

            <!-- Datos en tiempo real -->
            <div class="simulator-data">
                <h3>📊 DATOS DE SIMULACIÓN</h3>
                <div class="data-card">
                    <div class="data-label">Perfil:</div>
                    <div class="data-value" id="dataPerfil">-</div>
                </div>
                <div class="data-card">
                    <div class="data-label">Nivel actual:</div>
                    <div class="data-value" id="dataNivelActual">-</div>
                </div>
                <div class="data-card">
                    <div class="data-label">Nivel bloqueado:</div>
                    <div class="data-value" id="dataNivelBloqueado">-</div>
                </div>
                <div class="data-card highlight">
                    <div class="data-label">RECOMENDACIÓN:</div>
                    <div class="data-value" id="dataRecomendacion">-</div>
                </div>
                <div class="estadisticas">
                    <h4>📈 ESTADÍSTICAS</h4>
                    <div class="stat-item">
                        <span>Perfiles simulados:</span>
                        <span class="stat-value" id="statPerfiles">0</span>
                    </div>
                    <div class="stat-item">
                        <span>Simulaciones totales:</span>
                        <span class="stat-value" id="statSimulaciones">0</span>
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
            <div class="quiz-question" data-correct="B">
                <div class="quiz-header">
                    <span class="quiz-num">01</span>
                    <h3>¿Cuál es la base de la pirámide de Maslow?</h3>
                </div>
                <div class="quiz-options">
                    <button class="quiz-option" data-value="A">
                        <span class="option-letter">A</span>
                        Necesidades de estima
                    </button>
                    <button class="quiz-option" data-value="B">
                        <span class="option-letter">B</span>
                        Necesidades fisiológicas
                    </button>
                    <button class="quiz-option" data-value="C">
                        <span class="option-letter">C</span>
                        Necesidades sociales
                    </button>
                    <button class="quiz-option" data-value="D">
                        <span class="option-letter">D</span>
                        Autorrealización
                    </button>
                </div>
                <div class="quiz-feedback" style="display: none;">
                    <div class="feedback-correct">
                        <strong>✅ Correcto:</strong> Las necesidades fisiológicas (comida, agua, aire) son la base de la pirámide.
                    </div>
                    <div class="feedback-incorrect">
                        ❌ <strong>Incorrecto:</strong> Revisa la estructura jerárquica de la pirámide.
                    </div>
                    <div class="feedback-explicacion">
                        <p><strong>Explicación:</strong> Según Maslow, las necesidades más básicas (fisiológicas) deben satisfacerse primero. Solo entonces se activan necesidades superiores como seguridad, sociales, estima y autorrealización.</p>
                    </div>
                </div>
            </div>

            <div class="quiz-question" data-correct="C">
                <div class="quiz-header">
                    <span class="quiz-num">02</span>
                    <h3>¿Qué sucede cuando se satisface una necesidad?</h3>
                </div>
                <div class="quiz-options">
                    <button class="quiz-option" data-value="A">
                        <span class="option-letter">A</span>
                        Se vuelve más intensa
                    </button>
                    <button class="quiz-option" data-value="B">
                        <span class="option-letter">B</span>
                        Desaparece de la pirámide
                    </button>
                    <button class="quiz-option" data-value="C">
                        <span class="option-letter">C</span>
                        Deja de ser motivadora
                    </button>
                    <button class="quiz-option" data-value="D">
                        <span class="option-letter">D</span>
                        Se convierte en un lujo
                    </button>
                </div>
                <div class="quiz-feedback" style="display: none;">
                    <div class="feedback-correct">
                        <strong>✅ Correcto:</strong> Una necesidad satisfecha deja de motivar el comportamiento.
                    </div>
                    <div class="feedback-incorrect">
                        ❌ <strong>Incorrecto:</strong> La teoría de Maslow establece que las necesidades satisfechas no generan motivación.
                    </div>
                    <div class="feedback-explicacion">
                        <p><strong>Ejemplo:</strong> Si tienes sed (nivel 1) y bebes agua, la sed deja de motivarte. Entonces, puedes enfocarte en necesidades de seguridad (nivel 2).</p>
                    </div>
                </div>
            </div>

            <div class="quiz-question" data-correct="A">
                <div class="quiz-header">
                    <span class="quiz-num">03</span>
                    <h3>¿Qué nivel NO puede alcanzarse si el nivel 3 (social) no está satisfecho?</h3>
                </div>
                <div class="quiz-options">
                    <button class="quiz-option" data-value="A">
                        <span class="option-letter">A</span>
                        Autorrealización (nivel 5)
                    </button>
                    <button class="quiz-option" data-value="B">
                        <span class="option-letter">B</span>
                        Seguridad (nivel 2)
                    </button>
                    <button class="quiz-option" data-value="C">
                        <span class="option-letter">C</span>
                        Fisiológicas (nivel 1)
                    </button>
                    <button class="quiz-option" data-value="D">
                        <span class="option-letter">D</span>
                        Todas las anteriores
                    </button>
                </div>
                <div class="quiz-feedback" style="display: none;">
                    <div class="feedback-correct">
                        <strong>✅ Correcto:</strong> Los niveles superiores (4 y 5) requieren que los inferiores (1, 2, 3) estén satisfechos.
                    </div>
                    <div class="feedback-incorrect">
                        ❌ <strong>Incorrecto:</strong> La jerarquía de Maslow es progresiva: primero 1 → 2 → 3 → 4 → 5.
                    </div>
                    <div class="feedback-explicacion">
                        <p><strong>Contexto:</strong> Si una persona no tiene relaciones sociales satisfactorias (nivel 3), difícilmente buscará reconocimiento (nivel 4) o autorrealización (nivel 5).</p>
                    </div>
                </div>
            </div>

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
    <section class="errores-section">
        <h2 class="seccion-titulo neon-alerta">
            <span class="icon">⚠️</span> ERRORES COMUNES Y SOLUCIONES
        </h2>
        <div class="errores-container">
            <div class="error-card">
                <div class="error-header" onclick="toggleError(this)">
                    <h3>❌ CONFUNDIR "NECESIDAD" CON "DESEO"</h3>
                    <span class="error-toggle">+</span>
                </div>
                <div class="error-content">
                    <div class="error-ejemplo">
                        <strong>Error común:</strong> "Un iPhone nuevo es una necesidad fisiológica".
                    </div>
                    <div class="error-correccion">
                        <strong>Corrección:</strong> Un iPhone es un <strong>deseo</strong> (nivel 4: estima). Una necesidad fisiológica es <strong>agua</strong> o <strong>comida</strong>.
                    </div>
                    <div class="error-practica">
                        <p><strong>Practica:</strong> Clasifica: ¿Necesidad o deseo? <strong>Vivienda</strong>, <strong>Netflix</strong>, <strong>Aire</strong>, <strong>Ropa de marca</strong>.</p>
                        <button class="btn-mini" onclick="mostrarSolucion(1)">Ver solución</button>
                        <div class="solucion" id="solucion1" style="display: none;">
                            <strong>Vivienda:</strong> Necesidad (seguridad)<br>
                            <strong>Netflix:</strong> Deseo (entretenimiento)<br>
                            <strong>Aire:</strong> Necesidad (fisiológica)<br>
                            <strong>Ropa de marca:</strong> Deseo (estima)
                        </div>
                    </div>
                </div>
            </div>

            <div class="error-card">
                <div class="error-header" onclick="toggleError(this)">
                    <h3>❌ IGNORAR EL CONTEXTO CULTURAL</h3>
                    <span class="error-toggle">+</span>
                </div>
                <div class="error-content">
                    <div class="error-ejemplo">
                        <strong>Error común:</strong> "La pirámide es igual en todas las culturas".
                    </div>
                    <div class="error-correccion">
                        <strong>Corrección:</strong> El <strong>orden</strong> es universal, pero los <strong>ejemplos</strong> varían:
                        <div class="error-tabla">
                            <table>
                                <tr><th>Cultura</th><th>Nivel 3 (Social)</th></tr>
                                <tr><td>Occidental</td><td>Amistades individuales</td></tr>
                                <tr><td>Japonesa</td><td>Armonía grupal (wa)</td></tr>
                                <tr><td>Latina</td><td>Familia extendida</td></tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="error-card">
                <div class="error-header" onclick="toggleError(this)">
                    <h3>❌ OLVIDAR LA DINÁMICA DE LA PIRÁMIDE</h3>
                    <span class="error-toggle">+</span>
                </div>
                <div class="error-content">
                    <div class="error-ejemplo">
                        <strong>Error común:</strong> "Si satisfago el nivel 1, el nivel 2 se satisface automáticamente".
                    </div>
                    <div class="error-correccion">
                        <strong>Corrección:</strong> Cada nivel requiere <strong>acción consciente</strong>. Ejemplo:
                        <ul>
                            <li><strong>Nivel 1 → Nivel 2:</strong> Conseguir comida no garantiza empleo estable.</li>
                            <li><strong>Nivel 3 → Nivel 4:</strong> Tener amigos no asegura autoestima.</li>
                        </ul>
                    </div>
                    <div class="error-practica">
                        <p><strong>Reflexión:</strong> ¿Qué acciones específicas necesitas para avanzar del nivel 3 al 4 en tu vida?</p>
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
                    <h3>Análisis de caso: Emprendedor</h3>
                </div>
                <div class="problema-enunciado">
                    <p>Un emprendedor tiene:</p>
                    <ul>
                        <li>Ingresos estables (nivel 2: seguridad).</li>
                        <li>Pocos amigos (nivel 3: social no satisfecho).</li>
                        <li>Desea ganar un premio (nivel 4: estima).</li>
                    </ul>
                    <p><strong>Preguntas:</strong></p>
                    <ol>
                        <li>¿Qué nivel debe priorizar según Maslow? <strong>Justifica</strong>.</li>
                        <li>Propón <strong>3 acciones concretas</strong> para satisfacer el nivel 3.</li>
                        <li>Explica cómo afectaría esto a su motivación para el nivel 4.</li>
                    </ol>
                </div>
                <div class="problema-espacio">
                    <textarea placeholder="Desarrolla tu respuesta aquí..." rows="8"></textarea>
                </div>
                <button class="btn-verificar" onclick="verificarProblema(1)">🔍 VERIFICAR SOLUCIÓN</button>
                <div class="problema-solucion" id="solucionP1" style="display: none;">
                    <strong>Solución:</strong>
                    <ol>
                        <li><strong>Priorizar nivel 3 (social).</strong> Según Maslow, no puede alcanzar el nivel 4 (estima) sin satisfacer el 3.</li>
                        <li><strong>Acciones para nivel 3:</strong>
                            <ul>
                                <li>Unirse a grupos de emprendedores (ej: Meetup).</li>
                                <li>Participar en eventos de networking.</li>
                                <li>Crear un equipo de trabajo colaborativo.</li>
                            </ul>
                        </li>
                        <li><strong>Impacto en nivel 4:</strong> Al satisfacer el nivel 3, su motivación por el reconocimiento (premio) aumentará, ya que las necesidades sociales ya no competirán por su atención.</li>
                    </ol>
                </div>
            </div>

            <div class="problema-card">
                <div class="problema-header">
                    <span class="problema-num">P2</span>
                    <h3>Comparación cultural</h3>
                </div>
                <div class="problema-enunciado">
                    <p>Compara cómo se manifiesta el <strong>nivel 3 (social)</strong> en:</p>
                    <ol>
                        <li>Una familia japonesa tradicional.</li>
                        <li>Un joven occidental en una gran ciudad.</li>
                    </ol>
                    <p>Incluye:</p>
                    <ul>
                        <li>Diferencias en <strong>comportamientos</strong>.</li>
                        <li>Ejemplos <strong>concretos</strong>.</li>
                        <li>Cómo afecta esto a los niveles superiores (4 y 5).</li>
                    </ul>
                </div>
                <div class="problema-espacio">
                    <textarea placeholder="Desarrolla tu comparación aquí..." rows="10"></textarea>
                </div>
                <button class="btn-verificar" onclick="verificarProblema(2)">🔍 VERIFICAR SOLUCIÓN</button>
                <div class="problema-solucion" id="solucionP2" style="display: none;">
                    <strong>Respuesta modelo:</strong>
                    <div class="comparacion-tabla">
                        <table>
                            <tr>
                                <th>Contexto</th>
                                <th>Manifestación nivel 3</th>
                                <th>Ejemplo</th>
                                <th>Impacto en niveles 4-5</th>
                            </tr>
                            <tr>
                                <td><strong>Familia japonesa</strong></td>
                                <td>Enfasis en <strong>armonía grupal</strong> (wa) y roles familiares definidos.</td>
                                <td>Participación en ceremonias familiares y decisiones colectivas.</td>
                                <td>La estima (nivel 4) se logra mediante el <strong>reconocimiento grupal</strong> (ej: honor familiar). La autorrealización (nivel 5) suele alinearse con metas colectivas.</td>
                            </tr>
                            <tr>
                                <td><strong>Joven occidental</strong></td>
                                <td>Búsqueda de <strong>relaciones individuales</strong> y redes diversas.</td>
                                <td>Amistades en redes sociales, grupos de interés (deportes, arte).</td>
                                <td>La estima (nivel 4) se centra en <strong>logros personales</strong> (ej: carrera profesional). La autorrealización (nivel 5) prioriza proyectos individuales.</td>
                            </tr>
                        </table>
                    </div>
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
                        <td><strong>Identificación de niveles</strong></td>
                        <td>Clasifica correctamente todos los niveles con justificación sólida basada en la teoría.</td>
                        <td>Clasifica la mayoría correctamente, con alguna confusión en niveles intermedios.</td>
                        <td>Errores graves en la clasificación o justificación ausente.</td>
                    </tr>
                    <tr>
                        <td><strong>Aplicación a casos reales</strong></td>
                        <td>Propone acciones específicas y realistas para cada nivel, con conexión clara a la teoría.</td>
                        <td>Propone acciones genéricas o con alguna desconexión teórica.</td>
                        <td>Acciones irrelevantes o sin relación con los niveles de la pirámide.</td>
                    </tr>
                    <tr>
                        <td><strong>Análisis cultural</strong></td>
                        <td>Diferencia claramente manifestaciones culturales, con ejemplos precisos y análisis de impacto en niveles superiores.</td>
                        <td>Identifica diferencias culturales, pero con ejemplos vagos o análisis superficial.</td>
                        <td>No reconoce variaciones culturales o las confunde.</td>
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
                <h3>📊 AUTOEVALUACIÓN</h3>
                <div class="slider-group">
                    <label>Comprensión de los niveles de la pirámide:</label>
                    <input type="range" min="1" max="5" value="3" class="autoeval-slider" id="slider1">
                    <div class="slider-labels">
                        <span>Básico</span><span>Intermedio</span><span>Avanzado</span>
                    </div>
                </div>
                <div class="slider-group">
                    <label>Aplicación a casos prácticos:</label>
                    <input type="range" min="1" max="5" value="3" class="autoeval-slider" id="slider2">
                    <div class="slider-labels">
                        <span>Básico</span><span>Intermedio</span><span>Avanzado</span>
                    </div>
                </div>
                <div class="slider-group">
                    <label>Análisis de variaciones culturales:</label>
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
                    <p>¿Cómo aplicas (o aplicarías) la pirámide de Maslow en tu <strong>vida diaria</strong>? Describe un ejemplo concreto donde hayas priorizado necesidades según este modelo.</p>
                    <textarea placeholder="Ejemplo: \'Cuando tenía hambre (nivel 1), primero comí antes de estudiar (nivel 4)...\'" rows="4" id="reflexion1"></textarea>
                </div>
                <div class="pregunta-reflexion">
                    <p>En tu <strong>entorno cultural</strong>, ¿qué diferencia observas en cómo se satisfacen las necesidades sociales (nivel 3) comparado con otras culturas que conozcas?</p>
                    <textarea placeholder="Ejemplo: \'En mi familia, el nivel 3 se centra en la familia extendida, mientras que en Europa..." rows="4" id="reflexion2"></textarea>
                </div>
            </div>

            <div class="plan-estudio">
                <h3>📅 PLAN DE ESTUDIO RECOMENDADO</h3>
                <div class="plan-grid">
                    <div class="plan-card">
                        <h4>🔹 REPASO RÁPIDO (15 min)</h4>
                        <ul>
                            <li>Memorizar los 5 niveles y sus ejemplos.</li>
                            <li>Repasar los 3 principios clave.</li>
                            <li>Completar el quiz interactivo.</li>
                        </ul>
                    </div>
                    <div class="plan-card">
                        <h4>🛠 PRÁCTICA (30 min)</h4>
                        <ul>
                            <li>Analizar 3 casos reales (ej: un deportista, un artista, un científico).</li>
                            <li>Usar el simulador para diferentes perfiles.</li>
                            <li>Resolver los problemas tipo examen.</li>
                        </ul>
                    </div>
                    <div class="plan-card">
                        <h4>🌐 PROFUNDIZACIÓN (45 min)</h4>
                        <ul>
                            <li>Investigar cómo aplican la pirámide en psicología organizacional.</li>
                            <li>Comparar con otras teorías motivacionales (ej: Herzberg).</li>
                            <li>Reflexionar sobre críticas a Maslow (ej: ¿es realmente jerárquica?).</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="recursos">
                <h3>🔗 RECURSOS ADICIONALES</h3>
                <div class="recursos-links">
                    <a href="https://www.simplypsychology.org/maslow.html" target="_blank" class="recurso-link">
                        📖 Simply Psychology: Explicación detallada de Maslow
                    </a>
                    <a href="https://positivepsychology.com/maslows-hierarchy-of-needs/" target="_blank" class="recurso-link">
                        🧠 PositivePsychology: Aplicaciones modernas
                    </a>
                    <a href="https://www.ted.com/talks/dan_pink_the_puzzle_of_motivation" target="_blank" class="recurso-link">
                        🎤 TED Talk: "The puzzle of motivation" (Dan Pink)
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- JAVASCRIPT INTEGRADO -->
<script>
// ==========================================
// SISTEMA DE PIRÁMIDE INTERACTIVA
// ==========================================
const nivelesPiramide = {
    1: { nombre: "Fisiológicas", ejemplo: "Aire, agua, comida, sueño", color: "#2196F3" },
    2: { nombre: "Seguridad", ejemplo: "Empleo, salud, vivienda, protección", color: "#4CAF50" },
    3: { nombre: "Sociales", ejemplo: "Amistad, familia, amor, pertenencia", color: "#FF9800" },
    4: { nombre: "Estima", ejemplo: "Reconocimiento, logros, autoestima", color: "#F44336" },
    5: { nombre: "Autorrealización", ejemplo: "Creatividad, crecimiento personal, potencial", color: "#FFD700" }
};

// Inicializar interacción con la pirámide estática
document.addEventListener(\'DOMContentLoaded\', function() {
    document.querySelectorAll(\'.nivel-piramide\').forEach(nivel => {
        nivel.addEventListener(\'click\', function() {
            const nivelNum = this.id.replace(\'nivel\', \'\');
            const data = nivelesPiramide[nivelNum];

            // Actualizar panel de información
            document.getElementById(\'info-titulo\').textContent = `Nivel ${nivelNum}: ${data.nombre}`;
            document.getElementById(\'info-nivel\').textContent = nivelNum;
            document.getElementById(\'info-nombre\').textContent = data.nombre;
            document.getElementById(\'info-ejemplo\').textContent = data.ejemplo;
            document.getElementById(\'info-estado\').textContent = "Seleccionado";

            // Resaltar nivel seleccionado
            document.querySelectorAll(\'.nivel-polygon\').forEach(poly => {
                poly.style.filter = \'brightness(1)\';
            });
            this.querySelector(\'.nivel-polygon\').style.filter = \'brightness(1.3)\';

            // Animación
            this.style.animation = \'pulse 1s\';
        });
    });
});

// ==========================================
// SIMULADOR DE PIRÁMIDE DINÁMICA
// ==========================================
const perfiles = {
    estudiante: {
        nombre: "Estudiante universitario",
        niveles: [true, true, false, false, false],
        recomendacion: "Enfócate en construir relaciones sociales (nivel 3) para luego buscar reconocimiento académico (nivel 4).",
        bloqueado: 3
    },
    emprendedor: {
        nombre: "Emprendedor",
        niveles: [true, true, false, false, false],
        recomendacion: "Prioriza redes de contacto (nivel 3) antes de buscar premios o reconocimiento público (nivel 4).",
        bloqueado: 3
    },
    padre: {
        nombre: "Padre/madre de familia",
        niveles: [true, true, true, false, false],
        recomendacion: "Con las necesidades sociales cubiertas, ahora puedes trabajar en tu autoestima (nivel 4) y proyectos personales (nivel 5).",
        bloqueado: 4
    },
    artista: {
        nombre: "Artista",
        niveles: [true, false, true, false, false],
        recomendacion: "Asegura tu estabilidad económica (nivel 2) para poder dedicarte plenamente a tu creatividad (nivel 5).",
        bloqueado: 2
    },
    personalizado: {
        nombre: "Perfil personalizado",
        niveles: [false, false, false, false, false],
        recomendacion: "Personaliza tu camino según tus necesidades actuales.",
        bloqueado: 1
    }
};

let simulaciones = 0;
let perfilesSimulados = new Set();

function simularPiramide() {
    const perfilSelect = document.getElementById(\'personaSelect\').value;
    const checkboxes = document.querySelectorAll(\'input[name="nivel"]:checked\');
    const nivelesCheckbox = Array.from(checkboxes).map(cb => parseInt(cb.value));

    // Determinar niveles según el perfil o personalización
    let perfil;
    if (perfilSelect === \'personalizado\') {
        perfil = { ...perfiles.personalizado };
        perfil.niveles = [false, false, false, false, false];
        nivelesCheckbox.forEach(n => {
            perfil.niveles[n - 1] = true;
        });
        // Determinar nivel bloqueado
        perfil.bloqueado = 1;
        for (let i = 0; i < perfil.niveles.length; i++) {
            if (!perfil.niveles[i]) {
                perfil.bloqueado = i + 1;
                break;
            }
        }
        if (perfil.bloqueado > 5) perfil.bloqueado = 5;
    } else {
        perfil = perfiles[perfilSelect];
    }

    // Actualizar datos en la interfaz
    document.getElementById(\'dataPerfil\').textContent = perfil.nombre;
    document.getElementById(\'simulacionInfo\').innerHTML = `
        <strong>Simulación para:</strong> ${perfil.nombre}<br>
        <strong>Niveles satisfechos:</strong> ${nivelesCheckbox.join(\', \')}
    `;

    // Determinar nivel actual y bloqueado
    let nivelActual = 0;
    for (let i = 0; i < perfil.niveles.length; i++) {
        if (perfil.niveles[i]) {
            nivelActual = i + 1;
        } else {
            break;
        }
    }

    let nivelBloqueado = nivelActual < 5 ? nivelActual + 1 : "Ninguno (¡autorrealización alcanzada!)";
    if (nivelActual === 5) nivelBloqueado = "Ninguno (¡autorrealización alcanzada!)";

    document.getElementById(\'dataNivelActual\').textContent = `Nivel ${nivelActual} (${nivelesPiramide[nivelActual].nombre})`;
    document.getElementById(\'dataNivelBloqueado\').textContent = nivelBloqueado;
    document.getElementById(\'dataRecomendacion\').textContent = perfil.recomendacion;

    // Generar pirámide visual
    generarPiramideVisual(perfil.niveles);

    // Actualizar estadísticas
    simulaciones++;
    if (perfilSelect !== \'personalizado\') {
        perfilesSimulados.add(perfilSelect);
    }
    document.getElementById(\'statSimulaciones\').textContent = simulaciones;
    document.getElementById(\'statPerfiles\').textContent = perfilesSimulados.size;

    console.log(`📊 Simulación ${simulaciones}: ${perfil.nombre} - Nivel actual: ${nivelActual}, Bloqueado: ${nivelBloqueado}`);
}

function generarPiramideVisual(niveles) {
    const container = document.getElementById(\'piramideSimulada\');
    container.innerHTML = \'\';

    const svgNS = "http://www.w3.org/2000/svg";
    const svg = document.createElementNS(svgNS, "svg");
    svg.setAttribute("viewBox", "0 0 300 400");
    svg.setAttribute("width", "100%");
    svg.setAttribute("height", "300");

    // Fondo
    const fondo = document.createElementNS(svgNS, "rect");
    fondo.setAttribute("x", "0");
    fondo.setAttribute("y", "0");
    fondo.setAttribute("width", "300");
    fondo.setAttribute("height", "400");
    fondo.setAttribute("fill", "#0a0a1a");
    svg.appendChild(fondo);

    // Posiciones y tamaños de los niveles
    const yPositions = [350, 280, 210, 140, 70];
    const widths = [280, 240, 200, 160, 120];

    niveles.forEach((satisfecho, index) => {
        const nivelNum = index + 1;
        const y = yPositions[index];
        const width = widths[index];
        const x = (300 - width) / 2;
        const color = satisfecho ? nivelesPiramide[nivelNum].color : "rgba(100,100,100,0.3)";

        // Polígono del nivel
        const polygon = document.createElementNS(svgNS, "polygon");
        const points = `${x},${y} ${x + width},${y} ${150},${y - 70}`;
        polygon.setAttribute("points", points);
        polygon.setAttribute("fill", color);
        polygon.setAttribute("stroke", satisfecho ? "#fff" : "#555");
        polygon.setAttribute("stroke-width", "1");
        svg.appendChild(polygon);

        // Texto del nivel
        const text = document.createElementNS(svgNS, "text");
        text.setAttribute("x", "150");
        text.setAttribute("y", y - 35);
        text.setAttribute("fill", nivelNum === 5 && satisfecho ? "#212121" : "white");
        text.setAttribute("font-size", "12");
        text.setAttribute("text-anchor", "middle");
        text.setAttribute("font-weight", "bold");
        text.textContent = nivelesPiramide[nivelNum].nombre.substring(0, 3).toUpperCase();
        svg.appendChild(text);
    });

    container.appendChild(svg);
}

function perfilAleatorio() {
    const perfilesKeys = Object.keys(perfiles).filter(key => key !== \'personalizado\');
    const randomKey = perfilesKeys[Math.floor(Math.random() * perfilesKeys.length)];
    document.getElementById(\'personaSelect\').value = randomKey;

    // Marcar checkboxes según el perfil aleatorio
    const niveles = perfiles[randomKey].niveles;
    document.querySelectorAll(\'input[name="nivel"]\').forEach((cb, index) => {
        cb.checked = niveles[index];
    });

    document.getElementById(\'simulacionInfo\').textContent = `Perfil aleatorio: ${perfiles[randomKey].nombre}. Haz clic en "SIMULAR".`;
}

// ==========================================
// SISTEMA DE QUIZ INTERACTIVO
// ==========================================
let quizRespuestas = [];
let quizCompletado = false;

function inicializarQuiz() {
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

            // Verificar si todas las preguntas están respondidas
            verificarCompletadoQuiz();
        });
    });
}

function verificarCompletadoQuiz() {
    const questions = document.querySelectorAll(\'.quiz-question\');
    const answered = Array.from(questions).every(q => q.querySelector(\'.quiz-option.selected\'));

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
        feedback = "👍 Excelente! Dominas la pirámide de Maslow y su aplicación.";
    } else if (porcentaje >= 60) {
        feedback = "👌 Buen trabajo, pero repasa los principios clave y ejemplos.";
    } else {
        feedback = "📚 Necesitas estudiar más la jerarquía y casos prácticos.";
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

// ==========================================
// SISTEMA DE ERRORES COMUNES
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
// SISTEMA DE PROBLEMAS TIPO EXAMEN
// ==========================================
function verificarProblema(num) {
    const solucion = document.getElementById(`solucionP${num}`);
    solucion.style.display = solucion.style.display === \'block\' ? \'none\' : \'block\';
}

// ==========================================
// SISTEMA DE AUTOEVALUACIÓN
// ==========================================
function guardarAutoevaluacion() {
    const slider1 = document.getElementById(\'slider1\').value;
    const slider2 = document.getElementById(\'slider2\').value;
    const slider3 = document.getElementById(\'slider3\').value;
    const promedio = (parseInt(slider1) + parseInt(slider2) + parseInt(slider3)) / 3;

    const reflexion1 = document.getElementById(\'reflexion1\').value;
    const reflexion2 = document.getElementById(\'reflexion2\').value;

    alert(`💾 Autoevaluación guardada:\\n\\n` +
          `Comprensión de niveles: ${slider1}/5\\n` +
          `Aplicación práctica: ${slider2}/5\\n` +
          `Análisis cultural: ${slider3}/5\\n\\n` +
          `Promedio: ${promedio.toFixed(1)}/5\\n\\n` +
          `Reflexiones guardadas. Revisa el plan de estudio según tus resultados.`);
}

// ==========================================
// SISTEMA DE OBJETIVOS INTERACTIVOS
// ==========================================
function inicializarObjetivos() {
    document.querySelectorAll(\'.objetivo-card\').forEach(card => {
        card.addEventListener(\'click\', function() {
            const completado = this.dataset.completado === \'true\';
            this.dataset.completado = !completado;
            const checkbox = this.querySelector(\'.objetivo-checkbox\');
            checkbox.textContent = !completado ? \'✓\' : \'\';
            checkbox.style.backgroundColor = !completado ? \'#39FF14\' : \'\';
        });
    });
}

// ==========================================
// SISTEMA DE EJEMPLOS INTERACTIVOS
// ==========================================
function inicializarEjemplos() {
    document.querySelectorAll(\'.paso-card\').forEach(card => {
        card.addEventListener(\'click\', function() {
            this.style.transform = \'scale(1.02)\';
            setTimeout(() => {
                this.style.transform = \'scale(1)\';
            }, 300);
        });
    });
}

// ==========================================
// INICIALIZACIÓN COMPLETA
// ==========================================
document.addEventListener(\'DOMContentLoaded\', function() {
    inicializarQuiz();
    inicializarObjetivos();
    inicializarEjemplos();
    console.log("🚀 Sistema Cyberpunk Educativo: Pirámide de Maslow - Todo listo para interactuar");
});
</script>
',
    'ejercicios' => 
    array (
      0 => 
      array (
        'enunciado' => 'Nombre los 5 niveles de Maslow',
        'respuesta' => 'Fisiológicas, Seguridad, Sociales, Estima, Autorrealización',
      ),
      1 => 
      array (
        'enunciado' => 'Nivel base',
        'respuesta' => 'Fisiológicas',
      ),
      2 => 
      array (
        'enunciado' => 'Nivel superior',
        'respuesta' => 'Autorrealización',
      ),
      3 => 
      array (
        'enunciado' => 'Necesidad de estima',
        'respuesta' => 'Respeto, logros',
      ),
      4 => 
      array (
        'enunciado' => 'Si falta comida →',
        'respuesta' => 'Bloquea niveles superiores',
      ),
      5 => 
      array (
        'enunciado' => 'Teoría de',
        'respuesta' => 'Abraham Maslow',
      ),
      6 => 
      array (
        'enunciado' => 'Bienestar =',
        'respuesta' => 'Equilibrio en todos los niveles',
      ),
      7 => 
      array (
        'enunciado' => 'Ejemplo nivel 3',
        'respuesta' => 'Amistad, familia',
      ),
      8 => 
      array (
        'enunciado' => 'Jerarquía significa',
        'respuesta' => 'Orden de prioridad',
      ),
      9 => 
      array (
        'enunciado' => 'Autorrealización incluye',
        'respuesta' => 'Creatividad, potencial',
      ),
      10 => 
      array (
        'enunciado' => 'México: necesidad clave',
        'respuesta' => 'Seguridad (empleo, salud)',
      ),
      11 => 
      array (
        'enunciado' => 'SI: bienestar en',
        'respuesta' => 'Desarrollo humano',
      ),
    ),
    'quiz' => 
    array (
      0 => 
      array (
        'pregunta' => 'Nivel base pirámide',
        'opciones' => 
        array (
          0 => 'Fisiológicas',
          1 => 'Autorrealización',
          2 => 'Estima',
          3 => 'Sociales',
        ),
        'correcta' => 'Fisiológicas',
      ),
      1 => 
      array (
        'pregunta' => 'Nivel superior',
        'opciones' => 
        array (
          0 => 'Autorrealización',
          1 => 'Fisiológicas',
          2 => 'Seguridad',
          3 => 'Estima',
        ),
        'correcta' => 'Autorrealización',
      ),
      2 => 
      array (
        'pregunta' => 'Teoría de',
        'opciones' => 
        array (
          0 => 'Maslow',
          1 => 'Freud',
          2 => 'Piaget',
          3 => 'Skinner',
        ),
        'correcta' => 'Maslow',
      ),
      3 => 
      array (
        'pregunta' => 'Bienestar requiere',
        'opciones' => 
        array (
          0 => 'Equilibrio en necesidades',
          1 => 'Solo dinero',
          2 => 'Solo comida',
          3 => 'Nada',
        ),
        'correcta' => 'Equilibrio en necesidades',
      ),
      4 => 
      array (
        'pregunta' => 'Necesidades fisiológicas',
        'opciones' => 
        array (
          0 => 'Comida, agua',
          1 => 'Amigos',
          2 => 'Logros',
          3 => 'Arte',
        ),
        'correcta' => 'Comida, agua',
      ),
      5 => 
      array (
        'pregunta' => 'Estima incluye',
        'opciones' => 
        array (
          0 => 'Respeto, confianza',
          1 => 'Comida',
          2 => 'Seguridad',
          3 => 'Amor',
        ),
        'correcta' => 'Respeto, confianza',
      ),
       6 => 
       array (
         'pregunta' => 'Si falta seguridad →',
         'opciones' => 
         array (
           0 => 'Dificulta estima',
           1 => 'No afecta',
           2 => 'Mejora',
           3 => 'Es independiente',
         ),
         'correcta' => 'Dificulta estima',
       ),
      7 => 
      array (
        'pregunta' => 'Jerarquía significa',
        'opciones' => 
        array (
          0 => 'Orden de prioridad',
          1 => 'Igualdad',
          2 => 'Aleatorio',
          3 => 'Opcional',
        ),
        'correcta' => 'Orden de prioridad',
      ),
      8 => 
      array (
        'pregunta' => 'Autorrealización es',
        'opciones' => 
        array (
          0 => 'Realizar potencial',
          1 => 'Comer',
          2 => 'Dormir',
          3 => 'Trabajar',
        ),
        'correcta' => 'Realizar potencial',
      ),
      9 => 
      array (
        'pregunta' => 'México 2025: prioridad',
        'opciones' => 
        array (
          0 => 'Seguridad y salud',
          1 => 'Lujo',
          2 => 'Viajes',
          3 => 'Tecnología',
        ),
        'correcta' => 'Seguridad y salud',
      ),
      10 => 
      array (
        'pregunta' => 'Necesidades sociales',
        'opciones' => 
        array (
          0 => 'Amistad, pertenencia',
          1 => 'Comida',
          2 => 'Dinero',
          3 => 'Fama',
        ),
        'correcta' => 'Amistad, pertenencia',
      ),
      11 => 
      array (
        'pregunta' => 'Sin comida → motivación',
        'opciones' => 
        array (
          0 => 'Solo fisiológica',
          1 => 'Estima',
          2 => 'Creatividad',
          3 => 'Nada',
        ),
        'correcta' => 'Solo fisiológica',
      ),
      12 => 
      array (
        'pregunta' => 'Pirámide es',
        'opciones' => 
        array (
          0 => 'Jerárquica',
          1 => 'Circular',
          2 => 'Lineal',
          3 => 'Plana',
        ),
        'correcta' => 'Jerárquica',
      ),
      13 => 
      array (
        'pregunta' => 'Bienestar =',
        'opciones' => 
        array (
          0 => 'Satisfacción progresiva',
          1 => 'Solo nivel 1',
          2 => 'Solo nivel 5',
          3 => 'Dinero',
        ),
        'correcta' => 'Satisfacción progresiva',
      ),
      14 => 
      array (
        'pregunta' => 'Maslow publicó en',
        'opciones' => 
        array (
          0 => '1943',
          1 => '1900',
          2 => '2000',
          3 => '2025',
        ),
        'correcta' => '1943',
      ),
      15 => 
      array (
        'pregunta' => 'Crítica a Maslow',
        'opciones' => 
        array (
          0 => 'No universal',
          1 => 'Perfecta',
          2 => 'Científica',
          3 => 'Física',
        ),
        'correcta' => 'No universal',
      ),
      16 => 
      array (
        'pregunta' => 'México: nivel crítico',
        'opciones' => 
        array (
          0 => 'Seguridad',
          1 => 'Autorrealización',
          2 => 'Estima',
          3 => 'Sociales',
        ),
        'correcta' => 'Seguridad',
      ),
      17 => 
      array (
        'pregunta' => 'Bienestar social incluye',
        'opciones' => 
        array (
          0 => 'Nivel 3',
          1 => 'Solo 1',
          2 => 'Solo 5',
          3 => 'Ninguno',
        ),
        'correcta' => 'Nivel 3',
      ),
      18 => 
      array (
        'pregunta' => 'SI 2025: desarrollo humano mide',
        'opciones' => 
        array (
          0 => 'IDH (PNUD)',
          1 => 'PIB',
          2 => 'Solo dinero',
          3 => 'Nada',
        ),
        'correcta' => 'IDH (PNUD)',
      ),
      19 => 
      array (
        'pregunta' => 'Necesidad satisfecha →',
        'opciones' => 
        array (
          0 => 'Deja de motivar',
          1 => 'Aumenta',
          2 => 'Igual',
          3 => 'Desaparece',
        ),
        'correcta' => 'Deja de motivar',
      ),
      20 => 
      array (
        'pregunta' => 'Estudiante con hambre',
        'opciones' => 
        array (
          0 => 'No aprende bien',
          1 => 'Mejor',
          2 => 'Igual',
          3 => 'Más creativo',
        ),
        'correcta' => 'No aprende bien',
      ),
      21 => 
      array (
        'pregunta' => 'Empresa: motivación',
        'opciones' => 
        array (
          0 => 'Salario + reconocimiento',
          1 => 'Solo salario',
          2 => 'Solo amigos',
          3 => 'Nada',
        ),
        'correcta' => 'Salario + reconocimiento',
      ),
      22 => 
      array (
        'pregunta' => 'México: bienestar juvenil',
        'opciones' => 
        array (
          0 => 'Educación + empleo',
          1 => 'Lujo',
          2 => 'Viajes',
          3 => 'Tecnología',
        ),
        'correcta' => 'Educación + empleo',
      ),
      23 => 
      array (
        'pregunta' => 'Pirámide dinámica',
        'opciones' => 
        array (
          0 => 'Sí, cambia con contexto',
          1 => 'No',
          2 => 'Fija',
          3 => 'Estática',
        ),
        'correcta' => 'Sí, cambia con contexto',
      ),
      24 => 
      array (
        'pregunta' => 'Autorrealización ejemplo',
        'opciones' => 
        array (
          0 => 'Pintar, inventar',
          1 => 'Comer',
          2 => 'Dormir',
          3 => 'Trabajar',
        ),
        'correcta' => 'Pintar, inventar',
      ),
      25 => 
      array (
        'pregunta' => 'Crítica cultural',
        'opciones' => 
        array (
          0 => 'Colectivismo vs individualismo',
          1 => 'Universal',
          2 => 'Física',
          3 => 'Matemática',
        ),
        'correcta' => 'Colectivismo vs individualismo',
      ),
      26 => 
      array (
        'pregunta' => 'Bienestar objetivo',
        'opciones' => 
        array (
          0 => 'Progreso en todos los niveles',
          1 => 'Solo base',
          2 => 'Solo cima',
          3 => 'Dinero',
        ),
        'correcta' => 'Progreso en todos los niveles',
      ),
      27 => 
      array (
        'pregunta' => 'México 2025: política pública',
        'opciones' => 
        array (
          0 => 'Salud, educación, empleo',
          1 => 'Lujo',
          2 => 'Tecnología',
          3 => 'Nada',
        ),
        'correcta' => 'Salud, educación, empleo',
      ),
      28 => 
      array (
        'pregunta' => 'SI 2025: bienestar en',
        'opciones' => 
        array (
          0 => 'ODS 3, 4, 8',
          1 => 'Solo 1',
          2 => 'Solo 17',
          3 => 'Ninguno',
        ),
        'correcta' => 'ODS 3, 4, 8',
      ),
      29 => 
      array (
        'pregunta' => 'Maslow: motivación humana',
        'opciones' => 
        array (
          0 => 'Jerárquica y progresiva',
          1 => 'Aleatoria',
          2 => 'Estática',
          3 => 'Negativa',
        ),
        'correcta' => 'Jerárquica y progresiva',
      ),
    ),
  ),
  1 => 
  array (
    'materia' => 'Ciencias Sociales',
    'slug' => 'organizacion-sociedad',
    'titulo' => 'La Organización de la Sociedad: Niveles Micro, Meso y Macro',
    'contenido' => '<!-- INICIO LECCIÓN CYBERPUNK -->
<div class="leccion-container leccion-sociales-organizacion" data-tema="organizacion-sociedad">
    
    <!-- CABECERA CYBERPUNK -->
    <header class="leccion-header">
        <h1 class="titulo-leccion neon-glow">
            <span class="icon-tema">🏛️</span>
            LA ORGANIZACIÓN DE LA SOCIEDAD
        </h1>
        <div class="subtitulo">
            Niveles Micro, Meso y Macro: Estructuras que Tejen el Tejido Social
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
                <h3>Diferenciar los tres niveles sociales</h3>
                <p>Identificar características distintivas de micro, meso y macro estructura social</p>
            </div>
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Analizar instituciones clave</h3>
                <p>Comprender el rol de familia, educación, economía y gobierno en la organización social</p>
            </div>
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Visualizar interdependencias</h3>
                <p>Mapear conexiones entre niveles y su impacto en la vida cotidiana</p>
            </div>
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Aplicar en casos reales</h3>
                <p>Analizar fenómenos sociales actuales usando el modelo tridimensional</p>
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
                <h3>🏥 Sistema de Salud Pública</h3>
                <p>Micro: consulta individual → Meso: hospital → Macro: políticas nacionales de salud</p>
                <div class="dato-neon">3 niveles interconectados</div>
            </div>
            <div class="contexto-card">
                <h3>🏫 Sistema Educativo Nacional</h3>
                <p>Micro: estudiante en aula → Meso: escuela → Macro: secretaría de educación</p>
                <div class="dato-neon">Recursos: $15,000M anuales</div>
            </div>
            <div class="contexto-card">
                <h3>💼 Mercado Laboral</h3>
                <p>Micro: trabajador → Meso: empresa → Macro: economía nacional globalizada</p>
                <div class="dato-neon">PIB México: $1.46 billones USD</div>
            </div>
        </div>
    </section>

    <!-- INTRODUCCIÓN CONCEPTUAL -->
    <section class="teoria-section">
        <div class="borde-neon-lateral"></div>
        <h2 class="seccion-titulo neon-concepto">
            <span class="icon">📚</span> FUNDAMENTOS TEÓRICOS
        </h2>
        
        <!-- DEFINICIÓN PRINCIPAL -->
        <div class="subseccion">
            <div class="definicion-principal">
                <div class="def-card">
                    <h4>🏛️ ORGANIZACIÓN SOCIAL</h4>
                    <p>Conjunto de <strong>estructuras, relaciones e instituciones</strong> que permiten el funcionamiento colectivo de los individuos en una comunidad.</p>
                    <div class="formula-inline">
                        \\[ \\text{Organización Social} = \\text{Estructuras} + \\text{Relaciones} + \\text{Instituciones} \\]
                    </div>
                </div>
            </div>
            
            <div class="principios-trio">
                <div class="principio-card">
                    <div class="principio-icon">🔍</div>
                    <h5>Estructura</h5>
                    <p>Patrones estables de relaciones sociales</p>
                </div>
                <div class="principio-card">
                    <div class="principio-icon">🔄</div>
                    <h5>Función</h5>
                    <p>Propósito que cumple cada componente</p>
                </div>
                <div class="principio-card">
                    <div class="principio-icon">⚡</div>
                    <h5>Cambio</h5>
                    <p>Transformación a través del tiempo</p>
                </div>
            </div>
        </div>

        <!-- NIVELES DE ORGANIZACIÓN -->
        <div class="subseccion">
            <h3>1. Los Tres Niveles de Organización Social</h3>
            
            <div class="niveles-comparativa">
                <div class="nivel-card" data-nivel="micro">
                    <div class="nivel-header">
                        <h4>👤 NIVEL MICRO</h4>
                        <div class="nivel-badge">Individuo</div>
                    </div>
                    <div class="nivel-caracteristicas">
                        <p><strong>Escala:</strong> Individuos y relaciones cara a cara</p>
                        <p><strong>Enfoque:</strong> Interacciones personales directas</p>
                        <p><strong>Unidad básica:</strong> Persona y relaciones primarias</p>
                    </div>
                    <div class="nivel-ejemplos">
                        <div class="ejemplo-item">
                            <div class="ejemplo-icon">👨‍👩‍👧</div>
                            <div class="ejemplo-text">
                                <strong>Familia</strong><br>
                                Relaciones de parentesco
                            </div>
                        </div>
                        <div class="ejemplo-item">
                            <div class="ejemplo-icon">👥</div>
                            <div class="ejemplo-text">
                                <strong>Grupos de amigos</strong><br>
                                Vínculos afectivos
                            </div>
                        </div>
                        <div class="ejemplo-item">
                            <div class="ejemplo-icon">🤝</div>
                            <div class="ejemplo-text">
                                <strong>Relaciones laborales directas</strong><br>
                                Jefe-empleado
                            </div>
                        </div>
                    </div>
                    <div class="nivel-estadistica">
                        <span>Interacciones/día:</span>
                        <span class="stat-value">50-100</span>
                    </div>
                </div>
                
                <div class="nivel-card" data-nivel="meso">
                    <div class="nivel-header">
                        <h4>🏢 NIVEL MESO</h4>
                        <div class="nivel-badge">Instituciones</div>
                    </div>
                    <div class="nivel-caracteristicas">
                        <p><strong>Escala:</strong> Grupos e instituciones intermedias</p>
                        <p><strong>Enfoque:</strong> Organizaciones y comunidades</p>
                        <p><strong>Unidad básica:</strong> Organización formal/informal</p>
                    </div>
                    <div class="nivel-ejemplos">
                        <div class="ejemplo-item">
                            <div class="ejemplo-icon">🏫</div>
                            <div class="ejemplo-text">
                                <strong>Escuelas</strong><br>
                                Sistema educativo formal
                            </div>
                        </div>
                        <div class="ejemplo-item">
                            <div class="ejemplo-icon">💼</div>
                            <div class="ejemplo-text">
                                <strong>Empresas</strong><br>
                                Organizaciones económicas
                            </div>
                        </div>
                        <div class="ejemplo-item">
                            <div class="ejemplo-icon">⛪</div>
                            <div class="ejemplo-text">
                                <strong>Iglesias</strong><br>
                                Instituciones religiosas
                            </div>
                        </div>
                    </div>
                    <div class="nivel-estadistica">
                        <span>Instituciones en México:</span>
                        <span class="stat-value">4.5M+</span>
                    </div>
                </div>
                
                <div class="nivel-card" data-nivel="macro">
                    <div class="nivel-header">
                        <h4>🌐 NIVEL MACRO</h4>
                        <div class="nivel-badge">Sociedad</div>
                    </div>
                    <div class="nivel-caracteristicas">
                        <p><strong>Escala:</strong> Sociedad global, estructuras amplias</p>
                        <p><strong>Enfoque:</strong> Sistemas y estructuras sociales</p>
                        <p><strong>Unidad básica:</strong> Sociedad, civilización</p>
                    </div>
                    <div class="nivel-ejemplos">
                        <div class="ejemplo-item">
                            <div class="ejemplo-icon">🏛️</div>
                            <div class="ejemplo-text">
                                <strong>Estado</strong><br>
                                Sistema político nacional
                            </div>
                        </div>
                        <div class="ejemplo-item">
                            <div class="ejemplo-icon">📈</div>
                            <div class="ejemplo-text">
                                <strong>Economía nacional</strong><br>
                                Sistema económico
                            </div>
                        </div>
                        <div class="ejemplo-item">
                            <div class="ejemplo-icon">🎭</div>
                            <div class="ejemplo-text">
                                <strong>Cultura nacional</strong><br>
                                Valores y tradiciones
                            </div>
                        </div>
                    </div>
                    <div class="nivel-estadistica">
                        <span>Población México:</span>
                        <span class="stat-value">130M</span>
                    </div>
                </div>
            </div>
            
            <div class="interdependencia">
                <h4>🔄 INTERDEPENDENCIA ENTRE NIVELES</h4>
                <div class="interdependencia-content">
                    <div class="inter-item">
                        <div class="inter-icon">⬆️</div>
                        <div class="inter-text">
                            <strong>Micro → Macro:</strong> Las acciones individuales colectivamente forman tendencias sociales
                        </div>
                    </div>
                    <div class="inter-item">
                        <div class="inter-icon">⬇️</div>
                        <div class="inter-text">
                            <strong>Macro → Micro:</strong> Las estructuras sociales condicionan oportunidades individuales
                        </div>
                    </div>
                    <div class="inter-item">
                        <div class="inter-icon">↔️</div>
                        <div class="inter-text">
                            <strong>Meso como puente:</strong> Las instituciones median entre individuo y sociedad
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ELEMENTOS CLAVE -->
        <div class="subseccion">
            <h3>2. Elementos Fundamentales de la Organización Social</h3>
            
            <div class="elementos-grid">
                <div class="elemento-card" data-elemento="roles">
                    <div class="elemento-icon">🎭</div>
                    <h4>ROLES SOCIALES</h4>
                    <div class="elemento-desc">
                        Comportamientos esperados según posición social
                    </div>
                    <div class="elemento-datos">
                        <div class="dato"><strong>Ejemplos:</strong> Padre, Estudiante, Trabajador</div>
                        <div class="dato"><strong>Conflictos:</strong> Rol de género, laboral-familiar</div>
                        <div class="dato"><strong>Adquisición:</strong> Socialización primaria/secundaria</div>
                    </div>
                </div>
                
                <div class="elemento-card" data-elemento="instituciones">
                    <div class="elemento-icon">🏛️</div>
                    <h4>INSTITUCIONES</h4>
                    <div class="elemento-desc">
                        Estructuras sociales estables con funciones específicas
                    </div>
                    <div class="elemento-datos">
                        <div class="dato"><strong>Tipos:</strong> Familia, Educación, Gobierno</div>
                        <div class="dato"><strong>Función:</strong> Orden, estabilidad, reproducción social</div>
                        <div class="dato"><strong>Cambio:</strong> Evolución histórica continua</div>
                    </div>
                </div>
                
                <div class="elemento-card" data-elemento="estratos">
                    <div class="elemento-icon">📊</div>
                    <h4>ESTRATOS SOCIALES</h4>
                    <div class="elemento-desc">
                        Grupos diferenciados por recursos, poder y prestigio
                    </div>
                    <div class="elemento-datos">
                        <div class="dato"><strong>Bases:</strong> Ingreso, educación, ocupación</div>
                        <div class="dato"><strong>Movilidad:</strong> Ascenso/descenso social</div>
                        <div class="dato"><strong>Desigualdad:</strong> Gini México: 0.415</div>
                    </div>
                </div>
                
                <div class="elemento-card" data-elemento="poder">
                    <div class="elemento-icon">⚖️</div>
                    <h4>PODER Y AUTORIDAD</h4>
                    <div class="elemento-desc">
                        Capacidad de influir y control legitimado
                    </div>
                    <div class="elemento-datos">
                        <div class="dato"><strong>Tipos:</strong> Legítima, coercitiva, experta</div>
                        <div class="dato"><strong>Distribución:</strong> Concentrada/dispersa</div>
                        <div class="dato"><strong>Legitimación:</strong> Tradición, ley, carisma</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- TABLA COMPARATIVA DETALLADA -->
        <div class="subseccion">
            <h3>3. Análisis Comparativo de Niveles Sociales</h3>
            <div class="tabla-interactiva">
                <table class="tabla-cyberpunk">
                    <thead>
                        <tr>
                            <th>NIVEL</th>
                            <th>ESCALA</th>
                            <th>UNIDAD BÁSICA</th>
                            <th>TIEMPO CARACTERÍSTICO</th>
                            <th>ANÁLISIS TÍPICO</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr data-nivel="micro">
                            <td><strong class="neon-concepto">MICRO</strong></td>
                            <td>Individuos y dyadas</td>
                            <td>Persona, relación cara a cara</td>
                            <td>Minutos - Días</td>
                            <td>Interaccionismo simbólico, Etnometodología</td>
                        </tr>
                        <tr data-nivel="meso">
                            <td><strong class="neon-concepto">MESO</strong></td>
                            <td>Grupos, organizaciones</td>
                            <td>Institución, comunidad</td>
                            <td>Semanas - Años</td>
                            <td>Teoría de organizaciones, Ecología humana</td>
                        </tr>
                        <tr data-nivel="macro">
                            <td><strong class="neon-concepto">MACRO</strong></td>
                            <td>Sociedades, civilizaciones</td>
                            <td>Sistema social, estructura</td>
                            <td>Años - Siglos</td>
                            <td>Estructural-funcionalismo, Marxismo</td>
                        </tr>
                    </tbody>
                </table>
                <div class="tabla-info" id="infoNivel">
                    Selecciona un nivel para ver ejemplos específicos
                </div>
            </div>
        </div>
    </section>

    <!-- SIMULADOR INTERACTIVO -->
    <section class="simulator-section">
        <h2 class="seccion-titulo neon-interactivo">
            <span class="icon">🔄</span> SIMULADOR: NIVELES SOCIALES INTERCONECTADOS
        </h2>
        
        <div class="simulator-container" data-tema="niveles-sociales">
            <!-- PANEL DE CONTROLES -->
            <div class="simulator-controls">
                <h3>CONTROLES</h3>
                
                <div class="control-group">
                    <label for="fenomenoInput">Fenómeno social:</label>
                    <input type="text" id="fenomenoInput" class="control-input" 
                           placeholder="Ej: Educación, Salud, Empleo" 
                           list="fenomenosList">
                    <datalist id="fenomenosList">
                        <option value="Educación pública">Educación pública</option>
                        <option value="Sistema de salud">Sistema de salud</option>
                        <option value="Mercado laboral">Mercado laboral</option>
                        <option value="Movilidad social">Movilidad social</option>
                        <option value="Participación política">Participación política</option>
                        <option value="Cultura digital">Cultura digital</option>
                        <option value="Desigualdad económica">Desigualdad económica</option>
                        <option value="Cambio climático">Cambio climático</option>
                        <option value="Migración">Migración</option>
                        <option value="Innovación tecnológica">Innovación tecnológica</option>
                    </datalist>
                </div>
                
                <div class="control-group">
                    <label for="nivelEnfoque">Nivel de análisis:</label>
                    <select id="nivelEnfoque" class="control-select">
                        <option value="micro">Micro (Individual)</option>
                        <option value="meso">Meso (Institucional)</option>
                        <option value="macro">Macro (Social)</option>
                        <option value="todos">Todos los niveles</option>
                    </select>
                </div>
                
                <div class="control-group">
                    <label>Dimensiones a visualizar:</label>
                    <div class="checkbox-group">
                        <label><input type="checkbox" name="dimensiones" value="actores" checked> Actores</label>
                        <label><input type="checkbox" name="dimensiones" value="instituciones" checked> Instituciones</label>
                        <label><input type="checkbox" name="dimensiones" value="recursos"> Recursos</label>
                        <label><input type="checkbox" name="dimensiones" value="poder"> Relaciones de poder</label>
                    </div>
                </div>
                
                <button class="btn-clasificar" onclick="analizarFenomeno()">
                    <span class="btn-icon">🔍</span> ANALIZAR
                </button>
                
                <button class="btn-aleatorio" onclick="fenomenoAleatorio()">
                    <span class="btn-icon">🎲</span> FENÓMENO ALEATORIO
                </button>
                
                <button class="btn-reset" onclick="reiniciarAnalizador()">
                    <span class="btn-icon">🔄</span> REINICIAR
                </button>
            </div>
            
            <!-- VISUALIZACIÓN DEL SISTEMA SOCIAL -->
            <div class="simulator-visualization" id="visualizacionSocial">
                <div class="sistema-container">
                    <svg viewBox="0 0 600 500" id="svgSistema">
                        <!-- Fondo -->
                        <rect x="0" y="0" width="600" height="500" fill="#0a0a1a" id="fondoSistema"/>
                        
                        <!-- MACRO -->
                        <g id="nodoMacro">
                            <ellipse cx="300" cy="100" rx="180" ry="50" fill="#7B1FA2" opacity="0.7"/>
                            <text x="300" y="100" fill="white" text-anchor="middle" font-size="14">SISTEMA MACRO</text>
                            <text x="300" y="120" fill="#E1BEE7" text-anchor="middle" font-size="10">Estado, Economía, Cultura</text>
                        </g>
                        
                        <!-- MESO -->
                        <g id="nodoMeso">
                            <circle cx="300" cy="250" r="120" fill="#9C27B0" opacity="0.7"/>
                            <text x="300" y="250" fill="white" text-anchor="middle" font-size="14">SISTEMA MESO</text>
                            <text x="300" y="270" fill="#F3E5F5" text-anchor="middle" font-size="10">Instituciones, Organizaciones</text>
                        </g>
                        
                        <!-- MICRO -->
                        <g id="nodoMicro">
                            <rect x="180" y="350" width="240" height="80" rx="15" fill="#E1BEE7" opacity="0.7"/>
                            <text x="300" y="380" fill="#4A148C" text-anchor="middle" font-size="14">SISTEMA MICRO</text>
                            <text x="300" y="400" fill="#7B1FA2" text-anchor="middle" font-size="10">Individuos, Familias, Grupos</text>
                        </g>
                        
                        <!-- CONEXIONES -->
                        <path id="conexionMacroMeso" d="M300 150 Q300 200 300 230" stroke="#FF9800" stroke-width="2" fill="none"/>
                        <path id="conexionMesoMicro" d="M300 300 Q300 330 300 350" stroke="#FF9800" stroke-width="2" fill="none"/>
                        <path id="conexionMicroMacro" d="M300 430 Q300 450 300 100" stroke="#4CAF50" stroke-width="2" fill="none" stroke-dasharray="5,5"/>
                        
                        <!-- NODOS DINÁMICOS -->
                        <g id="actoresDinamicos"></g>
                        
                        <!-- FENÓMENO ANALIZADO -->
                        <g id="fenomenoAnalizado" opacity="0">
                            <rect x="150" y="450" width="300" height="40" rx="10" fill="#FF9800"/>
                            <text x="300" y="470" fill="white" text-anchor="middle" font-size="12" id="textoFenomeno">FENÓMENO</text>
                        </g>
                    </svg>
                </div>
                <div class="sistema-info" id="infoSistema">
                    Selecciona un fenómeno social y haz clic en "ANALIZAR"
                </div>
            </div>
            
            <!-- DATOS DE ANÁLISIS -->
            <div class="simulator-data">
                <h3>DATOS DE ANÁLISIS</h3>
                
                <div class="data-card">
                    <div class="data-label">Fenómeno:</div>
                    <div class="data-value" id="dataFenomeno">-</div>
                </div>
                
                <div class="data-card">
                    <div class="data-label">Nivel principal:</div>
                    <div class="data-value" id="dataNivelPrincipal">-</div>
                </div>
                
                <div class="data-card">
                    <div class="data-label">Actores clave:</div>
                    <div class="data-value" id="dataActores">-</div>
                </div>
                
                <div class="data-card highlight">
                    <div class="data-label">INSTITUCIONES INVOLUCRADAS:</div>
                    <div class="data-value" id="dataInstituciones">-</div>
                </div>
                
                <div class="data-card">
                    <div class="data-label">Recursos movilizados:</div>
                    <div class="data-value" id="dataRecursos">-</div>
                </div>
                
                <div class="data-card">
                    <div class="data-label">Impacto social:</div>
                    <div class="data-value" id="dataImpacto">-</div>
                </div>
                
                <div class="estadisticas">
                    <h4>📊 ESTADÍSTICAS SOCIALES MÉXICO</h4>
                    <div class="stat-item">
                        <span>Población total:</span>
                        <span class="stat-value">130M</span>
                    </div>
                    <div class="stat-item">
                        <span>Hogares:</span>
                        <span class="stat-value">35.2M</span>
                    </div>
                    <div class="stat-item">
                        <span>Escuelas:</span>
                        <span class="stat-value">265K</span>
                    </div>
                    <div class="stat-item">
                        <span>Empresas registradas:</span>
                        <span class="stat-value">4.5M</span>
                    </div>
                    <div class="stat-item">
                        <span>Coeficiente Gini:</span>
                        <span class="stat-value">0.415</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- EJEMPLO INTEGRADO -->
    <section class="ejemplo-integrado">
        <h2 class="seccion-titulo neon-ejemplo">
            <span class="icon">🔍</span> EJEMPLO INTEGRADO: SISTEMA EDUCATIVO
        </h2>
        
        <div class="ejemplo-container">
            <div class="ejemplo-niveles">
                <div class="nivel-ejemplo" data-nivel="micro">
                    <div class="nivel-header">
                        <h4>👨‍🎓 MICRO: ESTUDIANTE INDIVIDUAL</h4>
                    </div>
                    <div class="nivel-content">
                        <p><strong>Actores:</strong> María, 15 años, estudiante de secundaria</p>
                        <p><strong>Acciones:</strong> Asiste a clases, hace tareas, interactúa con compañeros</p>
                        <p><strong>Recursos:</strong> Tiempo, esfuerzo, apoyo familiar</p>
                        <div class="nivel-metrica">
                            <span>Horas estudio/semana:</span>
                            <span class="metrica-valor">25</span>
                        </div>
                    </div>
                </div>
                
                <div class="nivel-ejemplo" data-nivel="meso">
                    <div class="nivel-header">
                        <h4>🏫 MESO: ESCUELA SECUNDARIA</h4>
                    </div>
                    <div class="nivel-content">
                        <p><strong>Institución:</strong> Escuela Secundaria Técnica #45</p>
                        <p><strong>Estructura:</strong> Directivo, docentes, administrativos</p>
                        <p><strong>Recursos:</strong> Infraestructura, materiales, presupuesto</p>
                        <div class="nivel-metrica">
                            <span>Alumnos:</span>
                            <span class="metrica-valor">720</span>
                        </div>
                    </div>
                </div>
                
                <div class="nivel-ejemplo" data-nivel="macro">
                    <div class="nivel-header">
                        <h4>🏛️ MACRO: SISTEMA EDUCATIVO NACIONAL</h4>
                    </div>
                    <div class="nivel-content">
                        <p><strong>Política:</strong> Secretaría de Educación Pública (SEP)</p>
                        <p><strong>Recursos:</strong> Presupuesto nacional: $15,000M USD</p>
                        <p><strong>Objetivos:</strong> Cobertura universal, calidad, equidad</p>
                        <div class="nivel-metrica">
                            <span>Escuelas en México:</span>
                            <span class="metrica-valor">265,000</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="conexiones-ejemplo">
                <h4>🔄 CONEXIONES E INTERDEPENDENCIAS</h4>
                <div class="conexiones-grid">
                    <div class="conexion">
                        <div class="conexion-icon">⬆️</div>
                        <div class="conexion-text">
                            <strong>Micro → Macro:</strong> El desempeño individual de María afecta estadísticas nacionales de rendimiento
                        </div>
                    </div>
                    <div class="conexion">
                        <div class="conexion-icon">⬇️</div>
                        <div class="conexion-text">
                            <strong>Macro → Micro:</strong> Políticas nacionales definen el currículum que estudia María
                        </div>
                    </div>
                    <div class="conexion">
                        <div class="conexion-icon">↔️</div>
                        <div class="conexion-text">
                            <strong>Meso como mediador:</strong> La escuela implementa políticas nacionales y atiende necesidades individuales
                        </div>
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
                    <h3>¿Qué nivel social se enfoca en instituciones como escuelas y empresas?</h3>
                </div>
                
                <div class="quiz-options">
                    <button class="quiz-option" data-value="A">
                        <span class="option-letter">A</span>
                        Nivel Micro
                    </button>
                    <button class="quiz-option" data-value="B">
                        <span class="option-letter">B</span>
                        Nivel Meso
                    </button>
                    <button class="quiz-option" data-value="C">
                        <span class="option-letter">C</span>
                        Nivel Macro
                    </button>
                    <button class="quiz-option" data-value="D">
                        <span class="option-letter">D</span>
                        Nivel Global
                    </button>
                </div>
                
                <div class="quiz-feedback" style="display: none;">
                    <div class="feedback-correct">
                        ✅ <strong>Correcto:</strong> El nivel Meso analiza instituciones intermedias.
                    </div>
                    <div class="feedback-incorrect">
                        ❌ <strong>Incorrecto:</strong> Revisa las características distintivas de cada nivel.
                    </div>
                    <div class="feedback-explicacion">
                        <p><strong>Explicación:</strong> El nivel Meso (del griego "mesos" = medio) se sitúa entre el nivel Micro (individuos) y Macro (sociedad total). Incluye organizaciones formales como escuelas, empresas, iglesias, y comunidades locales.</p>
                    </div>
                </div>
            </div>
            
            <!-- PREGUNTA 2 -->
            <div class="quiz-question" data-correct="C">
                <div class="quiz-header">
                    <span class="quiz-num">02</span>
                    <h3>¿Cuál es un ejemplo de interdependencia Micro → Macro?</h3>
                </div>
                
                <div class="quiz-options">
                    <button class="quiz-option" data-value="A">
                        <span class="option-letter">A</span>
                        Leyes nacionales que regulan el matrimonio
                    </button>
                    <button class="quiz-option" data-value="B">
                        <span class="option-letter">B</span>
                        Reglamentos escolares sobre asistencia
                    </button>
                    <button class="quiz-option" data-value="C">
                        <span class="option-letter">C</span>
                        Decisiones individuales de consumo que forman tendencias económicas
                    </button>
                    <button class="quiz-option" data-value="D">
                        <span class="option-letter">D</span>
                        Tradiciones familiares transmitidas por generaciones
                    </button>
                </div>
                
                <div class="quiz-feedback" style="display: none;">
                    <div class="feedback-correct">
                        ✅ <strong>Correcto:</strong> Las acciones micro se agregan para formar patrones macro.
                    </div>
                    <div class="feedback-incorrect">
                        ❌ <strong>Incorrecto:</strong> La interdependencia Micro→Macro muestra cómo lo individual afecta lo social.
                    </div>
                    <div class="feedback-explicacion">
                        <p><strong>Dato:</strong> La sociología estudia cómo millones de decisiones individuales (micro) generan fenómenos sociales como tendencias económicas, movimientos culturales o patrones políticos (macro). Ejemplo: el consumo individual masivo define mercados nacionales.</p>
                    </div>
                </div>
            </div>
            
            <!-- PREGUNTA 3 -->
            <div class="quiz-question" data-correct="D">
                <div class="quiz-header">
                    <span class="quiz-num">03</span>
                    <h3>¿Qué elemento de organización social se refiere a comportamientos esperados según posición?</h3>
                </div>
                
                <div class="quiz-options">
                    <button class="quiz-option" data-value="A">
                        <span class="option-letter">A</span>
                        Instituciones
                    </button>
                    <button class="quiz-option" data-value="B">
                        <span class="option-letter">B</span>
                        Estratos sociales
                    </button>
                    <button class="quiz-option" data-value="C">
                        <span class="option-letter">C</span>
                        Poder y autoridad
                    </button>
                    <button class="quiz-option" data-value="D">
                        <span class="option-letter">D</span>
                        Roles sociales
                    </button>
                </div>
                
                <div class="quiz-feedback" style="display: none;">
                    <div class="feedback-correct">
                        ✅ <strong>Correcto:</strong> Los roles sociales definen expectativas de comportamiento.
                    </div>
                    <div class="feedback-incorrect">
                        ❌ <strong>Incorrecto:</strong> Revisa la definición de cada elemento organizacional.
                    </div>
                    <div class="feedback-explicacion">
                        <p><strong>Solución:</strong> Los roles sociales (ej: "madre", "estudiante", "empleado") son conjuntos de comportamientos, derechos y obligaciones asociados a una posición social. Las instituciones son estructuras más amplias (familia, educación), los estratos son grupos jerárquicos, y el poder es capacidad de influencia.</p>
                    </div>
                </div>
            </div>
        </div>
        
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
    </section>

    <!-- ERRORES COMUNES -->
    <section class="errores-section">
        <h2 class="seccion-titulo neon-alerta">
            <span class="icon">⚠️</span> ERRORES COMUNES Y SOLUCIONES
        </h2>
        
        <div class="errores-container">
            <div class="error-card">
                <div class="error-header" onclick="toggleError(this)">
                    <h3>❌ CONFUNDIR NIVELES DE ANÁLISIS</h3>
                    <span class="error-toggle">+</span>
                </div>
                <div class="error-content">
                    <div class="error-ejemplo">
                        <strong>Error común:</strong> "La familia es una institución del nivel Macro"
                    </div>
                    <div class="error-correccion">
                        <strong>Corrección:</strong> La familia como institución es MACRO, pero las relaciones familiares concretas son MICRO. La familia individual (padres-hijos) es micro; la institución "familia" en abstracto es macro.
                        \\[
                        \\text{Familia concreta (Micro)} \\quad \\text{Institución familiar (Macro)}
                        \\]
                    </div>
                    <div class="error-practica">
                        <p><strong>Practica:</strong> Clasifica: 1) Juan y su esposa, 2) Matrimonio como institución legal, 3) Empresa donde trabajan, 4) Sistema económico nacional</p>
                        <button class="btn-mini" onclick="mostrarSolucion(1)">Ver solución</button>
                        <div class="solucion" id="solucion1" style="display: none;">
                            <strong>1) Juan y esposa:</strong> Micro (relación interpersonal)<br>
                            <strong>2) Matrimonio institucional:</strong> Macro (institución social)<br>
                            <strong>3) Empresa:</strong> Meso (organización)<br>
                            <strong>4) Sistema económico:</strong> Macro (estructura social)
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="error-card">
                <div class="error-header" onclick="toggleError(this)">
                    <h3>❌ OLVIDAR LA INTERDEPENDENCIA ENTRE NIVELES</h3>
                    <span class="error-toggle">+</span>
                </div>
                <div class="error-content">
                    <div class="error-ejemplo">
                        <strong>Error común:</strong> "Los niveles son compartimentos estancos sin conexión"
                    </div>
                    <div class="error-correccion">
                        <strong>Corrección:</strong> Los niveles son ANALÍTICAMENTE separables pero EMPÍRICAMENTE interconectados:
                        <ul>
                            <li><strong>Efecto ascenso:</strong> Acciones micro → patrones macro (ej: votaciones individuales → gobierno nacional)</li>
                            <li><strong>Efecto descenso:</strong> Estructuras macro → oportunidades micro (ej: leyes → derechos individuales)</li>
                        </ul>
                    </div>
                    <div class="error-tabla">
                        <table>
                            <tr><th>Dirección</th><th>Ejemplo educativo</th></tr>
                            <tr><td>Micro → Macro</td><td>Desempeño estudiantil individual → estadísticas nacionales de educación</td></tr>
                            <tr><td>Macro → Micro</td><td>Políticas educativas nacionales → currículum que estudia cada alumno</td></tr>
                            <tr><td>Meso como puente</td><td>Escuela implementa políticas y atiende necesidades individuales</td></tr>
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
                    <h3>Análisis Multinivel de un Fenómeno Social</h3>
                </div>
                <div class="problema-enunciado">
                    <p>Analiza el fenómeno de la <strong>migración interna en México</strong> desde los tres niveles de organización social:</p>
                    <ol>
                        <li>Nivel Micro: Decisiones individuales/familiares de migrar</li>
                        <li>Nivel Meso: Redes sociales e instituciones que facilitan/obstaculizan</li>
                        <li>Nivel Macro: Políticas nacionales, tendencias económicas, desigualdades regionales</li>
                    </ol>
                    <p>Identifica para cada nivel:</p>
                    <ul>
                        <li>Actores principales</li>
                        <li>Recursos movilizados</li>
                        <li>Instituciones involucradas</li>
                        <li>Conexiones con otros niveles</li>
                    </ul>
                </div>
                <div class="problema-espacio">
                    <textarea placeholder="Escribe tu análisis multinivel aquí..." rows="10"></textarea>
                </div>
                <button class="btn-verificar" onclick="verificarProblema(1)">VERIFICAR SOLUCIÓN</button>
                <div class="problema-solucion" id="solucionP1" style="display: none;">
                    <strong>Solución modelo:</strong><br><br>
                    <strong>Nivel Micro:</strong><br>
                    • Actores: Individuos y familias que deciden migrar<br>
                    • Recursos: Ahorros, habilidades, redes personales<br>
                    • Motivaciones: Empleo, educación, seguridad<br>
                    • Conexión meso: Usan redes de parientes ya establecidos<br><br>
                    
                    <strong>Nivel Meso:</strong><br>
                    • Instituciones: Agencias de empleo, transporte, albergues<br>
                    • Redes: Comunidades de origen en destino (paisanos)<br>
                    • Organizaciones: ONGs, iglesias que apoyan migrantes<br>
                    • Conexión macro: Implementan/afectan políticas nacionales<br><br>
                    
                    <strong>Nivel Macro:</strong><br>
                    • Políticas: Programas de desarrollo regional, políticas laborales<br>
                    • Estructuras: Desigualdad norte-sur, concentración económica<br>
                    • Estadísticas: 5.4 millones de migrantes internos (2020)<br>
                    • Conexión micro: Condicionan oportunidades individuales
                </div>
            </div>
            
            <div class="problema-card">
                <div class="problema-header">
                    <span class="problema-num">P2</span>
                    <h3>Diseño de Intervención Social</h3>
                </div>
                <div class="problema-enunciado">
                    <p>Diseña una intervención para mejorar <strong>el acceso a educación superior en comunidades rurales</strong> considerando los tres niveles:</p>
                    <ol>
                        <li>Micro: ¿Cómo motivar a jóvenes individuales?</li>
                        <li>Meso: ¿Qué instituciones deben involucrarse?</li>
                        <li>Macro: ¿Qué políticas públicas se requieren?</li>
                    </ol>
                    <p>Tu diseño debe incluir:</p>
                    <ul>
                        <li>Acciones específicas por nivel</li>
                        <li>Recursos necesarios</li>
                        <li>Indicadores de éxito</li>
                        <li>Posibles conflictos entre niveles</li>
                    </ul>
                </div>
                <div class="problema-espacio">
                    <textarea placeholder="Describe tu diseño de intervención..." rows="10"></textarea>
                </div>
                <button class="btn-verificar" onclick="verificarProblema(2)">VERIFICAR PROCEDIMIENTO</button>
                <div class="problema-solucion" id="solucionP2" style="display: none;">
                    <strong>Intervención modelo:</strong><br><br>
                    <strong>Nivel Micro (Motivación individual):</strong><br>
                    • Mentorías personalizadas con universitarios de origen rural<br>
                    • Talleres de orientación vocacional en preparatorias<br>
                    • Visitas a universidades para familiarización<br>
                    • <em>Indicador:</em> % de estudiantes que aplican a universidad<br><br>
                    
                    <strong>Nivel Meso (Instituciones intermedias):</strong><br>
                    • Alianzas escuela-preparatoria-universidad<br>
                    • Programas de transporte y alojamiento subsidiado<br>
                    • Becas gestionadas por organizaciones comunitarias<br>
                    • <em>Indicador:</em> Número de alianzas institucionales<br><br>
                    
                    <strong>Nivel Macro (Políticas públicas):</strong><br>
                    • Política nacional de educación rural inclusiva<br>
                    • Presupuesto específico para transporte rural<br>
                    • Cuotas diferenciadas en universidades públicas<br>
                    • <em>Indicador:</em> Presupuesto asignado, leyes aprobadas<br><br>
                    
                    <strong>Posibles conflictos:</strong> Recursos macro pueden no llegar a micro si meso es ineficiente; políticas nacionales pueden no considerar realidades locales.
                </div>
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
                    <td>Diferenciación niveles</td>
                    <td>Clara distinción micro/meso/macro con ejemplos precisos</td>
                    <td>Diferenciación básica con algún solapamiento</td>
                    <td>Confusión entre niveles o omisión de alguno</td>
                </tr>
                <tr>
                    <td>Análisis interdependencia</td>
                    <td>Identifica conexiones bidireccionales entre niveles</td>
                    <td>Menciona algunas conexiones unidireccionales</td>
                    <td>Trata niveles como compartimentos estancos</td>
                </tr>
                <tr>
                    <td>Aplicación a casos reales</td>
                    <td>Propone intervenciones viables con recursos identificados</td>
                    <td>Sugiere intervenciones genéricas</td>
                    <td>No aplica teoría a casos concretos</td>
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
                    <label>Comprensión niveles micro/meso/macro:</label>
                    <input type="range" min="1" max="5" value="3" class="autoeval-slider" id="slider1">
                    <div class="slider-labels">
                        <span>Básico</span><span>Intermedio</span><span>Avanzado</span>
                    </div>
                </div>
                
                <div class="slider-group">
                    <label>Análisis interdependencia entre niveles:</label>
                    <input type="range" min="1" max="5" value="3" class="autoeval-slider" id="slider2">
                    <div class="slider-labels">
                        <span>Básico</span><span>Intermedio</span><span>Avanzado</span>
                    </div>
                </div>
                
                <div class="slider-group">
                    <label>Aplicación a fenómenos sociales reales:</label>
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
                <h3>💭 REFLEXIÓN GUIADA</h3>
                <div class="pregunta-reflexion">
                    <p>¿Cómo afectan las estructuras macro (leyes, economía) a tus decisiones micro (estudios, trabajo, familia)?</p>
                    <textarea placeholder="Escribe tu reflexión aquí..." rows="4" id="reflexion1"></textarea>
                </div>
                <div class="pregunta-reflexion">
                    <p>Describe una institución meso (escuela, empresa, iglesia) en la que participas y analiza cómo conecta tu vida individual con la sociedad.</p>
                    <textarea placeholder="Escribe tu análisis..." rows="4" id="reflexion2"></textarea>
                </div>
            </div>
        </div>
        
        <div class="plan-estudio">
            <h3>📅 PLAN DE ESTUDIO RECOMENDADO</h3>
            <div class="plan-grid">
                <div class="plan-card">
                    <h4>🔄 REPASO RÁPIDO (15 min)</h4>
                    <ul>
                        <li>Memorizar definiciones de micro/meso/macro</li>
                        <li>Recordar 4 elementos clave de organización social</li>
                        <li>Repasar ejemplos de cada nivel</li>
                    </ul>
                </div>
                <div class="plan-card">
                    <h4>💪 PRÁCTICA (30 min)</h4>
                    <ul>
                        <li>Analizar 5 fenómenos sociales usando los 3 niveles</li>
                        <li>Completar el simulador con diferentes casos</li>
                        <li>Resolver el quiz interactivo</li>
                    </ul>
                </div>
                <div class="plan-card">
                    <h4>🚀 PROFUNDIZACIÓN (45 min)</h4>
                    <ul>
                        <li>Investigar teorías sociológicas específicas</li>
                        <li>Analizar datos estadísticos nacionales</li>
                        <li>Diseñar intervenciones sociales multinivel</li>
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="recursos">
            <h3>🔗 RECURSOS ADICIONALES</h3>
            <div class="recursos-links">
                <a href="https://www.inegi.org.mx/" target="_blank" class="recurso-link">
                    📊 INEGI: Estadísticas sociales de México
                </a>
                <a href="https://www.jstor.org/" target="_blank" class="recurso-link">
                    📚 JSTOR: Artículos académicos de sociología
                </a>
                <a href="https://es.khanacademy.org/test-prep/mcat/society-and-culture/social-structures" target="_blank" class="recurso-link">
                    🎓 Khan Academy: Estructuras sociales
                </a>
                <a href="https://www.thoughtco.com/micro-meso-and-macro-levels-3026398" target="_blank" class="recurso-link">
                    🧠 ThoughtCo: Niveles de análisis sociológico
                </a>
            </div>
        </div>
    </section>

    <!-- JAVASCRIPT INTEGRADO -->
    <script>
    // ========================================
    // SISTEMA DE ANÁLISIS SOCIAL INTERACTIVO
    // ========================================
    
    // Base de datos de fenómenos sociales
    const fenomenosDB = {
        "Educación pública": {
            nivelPrincipal: "MESO",
            actores: "Estudiantes, Docentes, Padres, Administradores",
            instituciones: "SEP, Escuelas, Universidades, Sindicatos",
            recursos: "Presupuesto: $15,000M USD, Infraestructura, Materiales",
            impacto: "Alfabetización: 94.9%, Movilidad social, Desarrollo económico",
            ejemplos: "Escuelas rurales, Educación técnica, Universidad pública",
            color: "#7B1FA2"
        },
        "Sistema de salud": {
            nivelPrincipal: "MACRO",
            actores: "Pacientes, Médicos, Enfermeras, Administradores",
            instituciones: "IMSS, ISSSTE, Hospitales, Clínicas",
            recursos: "Presupuesto: $75,000M MXN, Hospitales: 4,800, Personal: 800K",
            impacto: "Esperanza vida: 75.1 años, Mortalidad infantil: 12.3/1000",
            ejemplos: "Seguro Popular, Hospitales generales, Campañas vacunación",
            color: "#9C27B0"
        },
        "Mercado laboral": {
            nivelPrincipal: "MACRO",
            actores: "Trabajadores, Empleadores, Desempleados, Subempleados",
            instituciones: "STPS, Empresas, Sindicatos, Bolsas de trabajo",
            recursos: "Población económicamente activa: 57M, Salario promedio: $11,200 MXN",
            impacto: "Desempleo: 3.4%, Informalidad: 56.2%, Productividad",
            ejemplos: "Empleo formal, Trabajo informal, Subempleo, Teletrabajo",
            color: "#E1BEE7"
        },
        "Movilidad social": {
            nivelPrincipal: "MICRO-MACRO",
            actores: "Individuos, Familias, Generaciones",
            instituciones: "Educación, Mercado laboral, Políticas redistributivas",
            recursos: "Educación, Capital social, Herencia, Oportunidades",
            impacto: "Coeficiente movilidad: 0.34, Reproducción desigualdad",
            ejemplos: "Ascenso educativo, Movilidad ocupacional, Herencia riqueza",
            color: "#4A148C"
        },
        "Participación política": {
            nivelPrincipal: "MESO-MACRO",
            actores: "Ciudadanos, Partidos, Movimientos, Gobierno",
            instituciones: "INE, Partidos políticos, Congreso, Gobierno",
            recursos: "Participación electoral: 63%, Presupuesto partidos: $4,500M MXN",
            impacto: "Legitimidad democrática, Representación, Políticas públicas",
            ejemplos: "Votaciones, Protestas, Activismo, Lobby",
            color: "#7B1FA2"
        },
        "Cultura digital": {
            nivelPrincipal: "MICRO-MACRO",
            actores: "Usuarios, Plataformas, Creadores, Reguladores",
            instituciones: "Redes sociales, Plataformas, Gobierno digital",
            recursos: "Usuarios internet: 82M, Penetración: 65%, Contenido generado",
            impacto: "Comunicación, Información, Economía digital, Privacidad",
            ejemplos: "Redes sociales, E-commerce, Teletrabajo, Educación online",
            color: "#9C27B0"
        }
    };
    
    // Matriz de interdependencias
    const interdependencias = {
        "Educación pública": {
            micro: "Decisiones individuales de estudiar",
            meso: "Escuelas que implementan currículum",
            macro: "Políticas nacionales de educación",
            conexiones: "Micro→Meso: Asistencia; Meso→Macro: Resultados; Macro→Micro: Oportunidades"
        },
        "Sistema de salud": {
            micro: "Hábitos saludables individuales",
            meso: "Hospitales que atienden pacientes",
            macro: "Políticas nacionales de salud",
            conexiones: "Micro→Macro: Enfermedades crónicas; Macro→Micro: Acceso a servicios"
        }
    };
    
    function analizarFenomeno() {
        console.log("🔍 Analizando fenómeno social...");
        
        const input = document.getElementById(\'fenomenoInput\').value.trim();
        if (!input) {
            alert("⚠️ Por favor, ingresa un fenómeno social");
            return;
        }
        
        // Buscar coincidencia aproximada
        let fenomenoEncontrado = null;
        for (const [key, value] of Object.entries(fenomenosDB)) {
            if (input.toLowerCase().includes(key.toLowerCase()) || 
                key.toLowerCase().includes(input.toLowerCase())) {
                fenomenoEncontrado = { nombre: key, ...value };
                break;
            }
        }
        
        if (!fenomenoEncontrado) {
            // Si no se encuentra, crear análisis basado en nivel seleccionado
            const nivel = document.getElementById(\'nivelEnfoque\').value;
            const checkboxes = document.querySelectorAll(\'input[name="dimensiones"]:checked\');
            const dimensiones = Array.from(checkboxes).map(cb => cb.value);
            
            fenomenoEncontrado = analizarPorNivel(input, nivel, dimensiones);
        }
        
        // Actualizar visualización
        actualizarVisualizacionSocial(fenomenoEncontrado);
        
        // Actualizar datos de análisis
        document.getElementById(\'dataFenomeno\').textContent = fenomenoEncontrado.nombre;
        document.getElementById(\'dataNivelPrincipal\').textContent = fenomenoEncontrado.nivelPrincipal;
        document.getElementById(\'dataActores\').textContent = fenomenoEncontrado.actores;
        document.getElementById(\'dataInstituciones\').textContent = fenomenoEncontrado.instituciones;
        document.getElementById(\'dataRecursos\').textContent = fenomenoEncontrado.recursos;
        document.getElementById(\'dataImpacto\').textContent = fenomenoEncontrado.impacto;
        
        document.getElementById(\'infoSistema\').textContent = 
            `Análisis: ${fenomenoEncontrado.nombre} → Nivel principal: ${fenomenoEncontrado.nivelPrincipal}`;
        
        console.log(`📊 Analizado: ${fenomenoEncontrado.nombre} en nivel ${fenomenoEncontrado.nivelPrincipal}`);
    }
    
    function analizarPorNivel(nombre, nivel, dimensiones) {
        let nivelPrincipal = nivel.toUpperCase();
        let actores = "Actores relevantes según nivel";
        let instituciones = "Instituciones involucradas";
        let recursos = "Recursos movilizados";
        let impacto = "Impacto social esperado";
        let ejemplos = "Ejemplos relacionados";
        let color = "#7B1FA2";
        
        // Configurar según nivel
        if (nivel === "micro") {
            actores = "Individuos, Familias, Relaciones cara a cara";
            instituciones = "Familia, Grupos primarios, Redes personales";
            recursos = "Tiempo, Esfuerzo, Capital social personal";
            impacto = "Decisiones individuales, Bienestar personal";
            color = "#E1BEE7";
        } else if (nivel === "meso") {
            actores = "Organizaciones, Comunidades, Grupos formales";
            instituciones = "Escuelas, Empresas, Iglesias, ONGs";
            recursos = "Presupuesto organizacional, Infraestructura, Personal";
            impacto = "Eficiencia organizacional, Servicios a comunidad";
            color = "#9C27B0";
        } else if (nivel === "macro") {
            actores = "Sociedad, Estado, Clases sociales, Movimientos";
            instituciones = "Gobierno, Sistema económico, Cultura nacional";
            recursos = "Presupuesto nacional, Políticas, Leyes, Tradiciones";
            impacto = "Desarrollo nacional, Equidad, Cohesión social";
            color = "#7B1FA2";
        }
        
        return { nombre, nivelPrincipal, actores, instituciones, recursos, impacto, ejemplos, color };
    }
    
    function actualizarVisualizacionSocial(fenomeno) {
        const svg = document.getElementById(\'svgSistema\');
        const color = fenomeno.color;
        
        // Reiniciar visualización
        document.querySelectorAll(\'#svgSistema g[id^="nodo"]\').forEach(nodo => {
            nodo.setAttribute(\'opacity\', \'0.3\');
        });
        
        document.querySelectorAll(\'#svgSistema path\').forEach(path => {
            path.style.stroke = \'\';
            path.style.strokeWidth = \'\';
        });
        
        // Resaltar según nivel principal
        if (fenomeno.nivelPrincipal.includes("MICRO")) {
            document.getElementById(\'nodoMicro\').setAttribute(\'opacity\', \'1\');
            document.getElementById(\'conexionMesoMicro\').style.stroke = color;
            document.getElementById(\'conexionMesoMicro\').style.strokeWidth = \'3\';
        }
        
        if (fenomeno.nivelPrincipal.includes("MESO")) {
            document.getElementById(\'nodoMeso\').setAttribute(\'opacity\', \'1\');
            document.getElementById(\'conexionMacroMeso\').style.stroke = color;
            document.getElementById(\'conexionMacroMeso\').style.strokeWidth = \'3\';
            document.getElementById(\'conexionMesoMicro\').style.stroke = color;
            document.getElementById(\'conexionMesoMicro\').style.strokeWidth = \'3\';
        }
        
        if (fenomeno.nivelPrincipal.includes("MACRO")) {
            document.getElementById(\'nodoMacro\').setAttribute(\'opacity\', \'1\');
            document.getElementById(\'conexionMacroMeso\').style.stroke = color;
            document.getElementById(\'conexionMacroMeso\').style.strokeWidth = \'3\';
            document.getElementById(\'conexionMicroMacro\').style.stroke = color;
            document.getElementById(\'conexionMicroMacro\').style.strokeWidth = \'2\';
        }
        
        // Mostrar fenómeno analizado
        const fenomenoElem = document.getElementById(\'fenomenoAnalizado\');
        fenomenoElem.style.opacity = \'1\';
        fenomenoElem.querySelector(\'rect\').setAttribute(\'fill\', color);
        document.getElementById(\'textoFenomeno\').textContent = fenomeno.nombre;
        
        // Agregar nodos dinámicos para actores
        const actoresDinamicos = document.getElementById(\'actoresDinamicos\');
        actoresDinamicos.innerHTML = \'\';
        
        // Crear pequeños círculos para representar actores
        const niveles = fenomeno.nivelPrincipal.split(\'-\');
        niveles.forEach((nivel, index) => {
            const x = 100 + (index * 200);
            const y = nivel.includes("MICRO") ? 380 : 
                     nivel.includes("MESO") ? 250 : 100;
            
            const circle = document.createElementNS(\'http://www.w3.org/2000/svg\', \'circle\');
            circle.setAttribute(\'cx\', x);
            circle.setAttribute(\'cy\', y);
            circle.setAttribute(\'r\', \'8\');
            circle.setAttribute(\'fill\', color);
            circle.setAttribute(\'opacity\', \'0.8\');
            circle.setAttribute(\'class\', \'actor-dinamico\');
            
            actoresDinamicos.appendChild(circle);
        });
        
        // Animación
        fenomenoElem.style.animation = \'pulse 2s\';
    }
    
    function fenomenoAleatorio() {
        const fenomenos = Object.keys(fenomenosDB);
        const aleatorio = fenomenos[Math.floor(Math.random() * fenomenos.length)];
        document.getElementById(\'fenomenoInput\').value = aleatorio;
        
        document.getElementById(\'infoSistema\').textContent = 
            `Fenómeno aleatorio seleccionado: ${aleatorio}. Haz clic en "ANALIZAR".`;
    }
    
    function reiniciarAnalizador() {
        console.log("🔄 Reiniciando analizador social...");
        
        document.getElementById(\'fenomenoInput\').value = \'\';
        document.getElementById(\'nivelEnfoque\').value = \'todos\';
        
        // Reiniciar checkboxes
        document.querySelectorAll(\'input[name="dimensiones"]\').forEach(cb => {
            cb.checked = true;
        });
        
        // Reiniciar visualización
        document.querySelectorAll(\'#svgSistema g[id^="nodo"]\').forEach(nodo => {
            nodo.setAttribute(\'opacity\', \'0.7\');
        });
        
        document.querySelectorAll(\'#svgSistema path\').forEach(path => {
            path.style.stroke = \'\';
            path.style.strokeWidth = \'\';
        });
        
        document.getElementById(\'fenomenoAnalizado\').style.opacity = \'0\';
        document.getElementById(\'actoresDinamicos\').innerHTML = \'\';
        
        // Reiniciar datos
        document.getElementById(\'dataFenomeno\').textContent = \'-\';
        document.getElementById(\'dataNivelPrincipal\').textContent = \'-\';
        document.getElementById(\'dataActores\').textContent = \'-\';
        document.getElementById(\'dataInstituciones\').textContent = \'-\';
        document.getElementById(\'dataRecursos\').textContent = \'-\';
        document.getElementById(\'dataImpacto\').textContent = \'-\';
        
        document.getElementById(\'infoSistema\').textContent = 
            "Selecciona un fenómeno social y haz clic en \'ANALIZAR\'";
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
            feedback = "🎉 ¡Excelente! Dominas los niveles de organización social.";
        } else if (porcentaje >= 60) {
            feedback = "👍 Buen trabajo, pero revisa las interdependencias entre niveles.";
        } else {
            feedback = "📚 Necesitas repasar la diferenciación micro/meso/macro.";
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
    // SISTEMA DE ERRORES COMUNES
    // ========================================
    
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
    
    // ========================================
    // SISTEMA DE PROBLEMAS TIPO EXAMEN
    // ========================================
    
    function verificarProblema(num) {
        const solucion = document.getElementById(`solucionP${num}`);
        solucion.style.display = solucion.style.display === \'block\' ? \'none\' : \'block\';
    }
    
    // ========================================
    // SISTEMA DE AUTOEVALUACIÓN
    // ========================================
    
    function guardarAutoevaluacion() {
        const slider1 = document.getElementById(\'slider1\').value;
        const slider2 = document.getElementById(\'slider2\').value;
        const slider3 = document.getElementById(\'slider3\').value;
        
        const promedio = (parseInt(slider1) + parseInt(slider2) + parseInt(slider3)) / 3;
        
        alert(`📊 AutoEvaluación guardada:\\n\\n` +
              `Comprensión niveles: ${slider1}/5\\n` +
              `Análisis interdependencia: ${slider2}/5\\n` +
              `Aplicación a casos reales: ${slider3}/5\\n\\n` +
              `Promedio: ${promedio.toFixed(1)}/5\\n\\n` +
              `Revisa el plan de estudio recomendado según tus resultados.`);
        
        console.log(`💾 AutoEvaluación guardada: ${slider1}, ${slider2}, ${slider3}`);
    }
    
    // ========================================
    // INICIALIZACIÓN
    // ========================================
    
    console.log("🚀 Sistema Cyberpunk Educativo inicializado");
    console.log("🏛️ Lección: Organización de la Sociedad");
    console.log("⚡ Simulador social, Quiz y Herramientas interactivas listas");
    
    // Tabla interactiva de niveles
    document.querySelectorAll(\'.tabla-cyberpunk tbody tr\').forEach(row => {
        row.addEventListener(\'click\', function() {
            const nivel = this.dataset.nivel;
            const info = document.getElementById(\'infoNivel\');
            
            const infoTextos = {
                micro: "Nivel Micro: Análisis de individuos y relaciones cara a cara. Teorías: Interaccionismo simbólico, Etnometodología. Ejemplos: relaciones familiares, amistades, interacciones cotidianas.",
                meso: "Nivel Meso: Análisis de organizaciones e instituciones. Teorías: Teoría de organizaciones, Ecología humana. Ejemplos: escuelas, empresas, iglesias, comunidades locales.",
                macro: "Nivel Macro: Análisis de sistemas sociales completos. Teorías: Estructural-funcionalismo, Marxismo, Teoría de sistemas. Ejemplos: Estado, economía nacional, cultura, estratificación social."
            };
            
            info.textContent = infoTextos[nivel] || "Información no disponible";
            info.style.animation = "highlight 0.5s";
            
            // Remover selección previa
            document.querySelectorAll(\'.tabla-cyberpunk tbody tr\').forEach(r => {
                r.classList.remove(\'selected\');
            });
            
            // Marcar fila seleccionada
            this.classList.add(\'selected\');
        });
    });
    
    // Elementos interactivos
    document.querySelectorAll(\'.elemento-card\').forEach(card => {
        card.addEventListener(\'click\', function() {
            const elemento = this.dataset.elemento;
            
            // Mostrar información detallada
            const elementosInfo = {
                roles: "Roles sociales: Comportamientos esperados según posición. Conflictos de rol: cuando expectativas son contradictorias. Socialización: proceso de aprendizaje de roles.",
                instituciones: "Instituciones: Estructuras sociales estables. Funciones: Orden, estabilidad, reproducción social. Tipos: Familia, Educación, Religión, Gobierno, Economía.",
                estratos: "Estratos sociales: Grupos jerárquicos. Bases: Ingreso, educación, ocupación, prestigio. Movilidad social: Ascenso/descenso entre estratos. Desigualdad: Coeficiente Gini.",
                poder: "Poder y autoridad: Capacidad de influir y control legitimado. Tipos según Weber: Tradicional, legal-racional, carismática. Distribución: Concentrada vs. dispersa."
            };
            
            alert(`⚖️ ${this.querySelector(\'h4\').textContent}\\n\\n${elementosInfo[elemento] || "Información no disponible"}`);
        });
    });
    
    // Objetivos interactivos
    document.querySelectorAll(\'.objetivo-card\').forEach(card => {
        card.addEventListener(\'click\', function() {
            const completado = this.dataset.completado === \'true\';
            this.dataset.completado = !completado;
            const checkbox = this.querySelector(\'.objetivo-checkbox\');
            checkbox.textContent = !completado ? \'✓\' : \'\';
            checkbox.style.backgroundColor = !completado ? \'#39FF14\' : \'\';
        });
    });
    
    // Ejemplos de niveles interactivos
    document.querySelectorAll(\'.nivel-ejemplo\').forEach(nivel => {
        nivel.addEventListener(\'click\', function() {
            const nivelTipo = this.dataset.nivel;
            const titulo = this.querySelector(\'h4\').textContent;
            const contenido = this.querySelector(\'.nivel-content\').innerHTML;
            
            alert(`🔍 ${titulo}\\n\\n${contenido.replace(/<[^>]*>/g, \'\\n\')}`);
        });
    });
    
    // Agregar filtro glow al SVG
    const svg = document.getElementById(\'svgSistema\');
    const defs = document.createElementNS(\'http://www.w3.org/2000/svg\', \'defs\');
    const filter = document.createElementNS(\'http://www.w3.org/2000/svg\', \'filter\');
    filter.setAttribute(\'id\', \'glow\');
    filter.setAttribute(\'x\', \'-50%\');
    filter.setAttribute(\'y\', \'-50%\');
    filter.setAttribute(\'width\', \'200%\');
    filter.setAttribute(\'height\', \'200%\');
    
    const feGaussianBlur = document.createElementNS(\'http://www.w3.org/2000/svg\', \'feGaussianBlur\');
    feGaussianBlur.setAttribute(\'stdDeviation\', \'4\');
    feGaussianBlur.setAttribute(\'result\', \'coloredBlur\');
    
    const feMerge = document.createElementNS(\'http://www.w3.org/2000/svg\', \'feMerge\');
    const feMergeNode1 = document.createElementNS(\'http://www.w3.org/2000/svg\', \'feMergeNode\');
    feMergeNode1.setAttribute(\'in\', \'coloredBlur\');
    const feMergeNode2 = document.createElementNS(\'http://www.w3.org/2000/svg\', \'feMergeNode\');
    feMergeNode2.setAttribute(\'in\', \'SourceGraphic\');
    
    feMerge.appendChild(feMergeNode1);
    feMerge.appendChild(feMergeNode2);
    filter.appendChild(feGaussianBlur);
    filter.appendChild(feMerge);
    defs.appendChild(filter);
    svg.appendChild(defs);
    </script>
    
</div>
<!-- FIN LECCIÓN CYBERPUNK -->',
    'ejercicios' => 
    array (
      0 => 
      array (
        'enunciado' => 'Tres niveles de organización social',
        'respuesta' => 'Micro, meso, macro',
      ),
      1 => 
      array (
        'enunciado' => 'Nivel micro incluye',
        'respuesta' => 'Familia, individuos',
      ),
      2 => 
      array (
        'enunciado' => 'Nivel meso incluye',
        'respuesta' => 'Escuelas, empresas',
      ),
      3 => 
      array (
        'enunciado' => 'Nivel macro incluye',
        'respuesta' => 'Estado, economía nacional',
      ),
      4 => 
      array (
        'enunciado' => 'Ejemplo de rol social',
        'respuesta' => 'Maestro, padre, ciudadano',
      ),
      5 => 
      array (
        'enunciado' => 'Institución clave en México',
        'respuesta' => 'INE, IMSS, SEP',
      ),
      6 => 
      array (
        'enunciado' => 'Estratificación social mide',
        'respuesta' => 'Desigualdad por ingreso, educación',
      ),
      7 => 
      array (
        'enunciado' => 'Poder legítimo es',
        'respuesta' => 'Autoridad',
      ),
      8 => 
      array (
        'enunciado' => 'Familia → escuela → gobierno',
        'respuesta' => 'Micro → meso → macro',
      ),
      9 => 
      array (
        'enunciado' => 'México: macro ejemplo',
        'respuesta' => 'Constitución, PIB',
      ),
      10 => 
      array (
        'enunciado' => 'Interdependencia significa',
        'respuesta' => 'Niveles se afectan mutuamente',
      ),
      11 => 
      array (
        'enunciado' => 'SI: sociedad compleja',
        'respuesta' => 'Alta división del trabajo',
      ),
    ),
    'quiz' => 
    array (
      0 => 
      array (
        'pregunta' => 'Nivel micro',
        'opciones' => 
        array (
          0 => 'Individuos y familia',
          1 => 'Estado',
          2 => 'Empresas',
          3 => 'Global',
        ),
        'correcta' => 'Individuos y familia',
      ),
      1 => 
      array (
        'pregunta' => 'Nivel meso',
        'opciones' => 
        array (
          0 => 'Grupos e instituciones',
          1 => 'Individuos',
          2 => 'Nación',
          3 => 'Mundo',
        ),
        'correcta' => 'Grupos e instituciones',
      ),
      2 => 
      array (
        'pregunta' => 'Nivel macro',
        'opciones' => 
        array (
          0 => 'Sociedad global',
          1 => 'Familia',
          2 => 'Escuela',
          3 => 'Amigos',
        ),
        'correcta' => 'Sociedad global',
      ),
      3 => 
      array (
        'pregunta' => 'Organización social permite',
        'opciones' => 
        array (
          0 => 'Cooperación y orden',
          1 => 'Caos',
          2 => 'Aislamiento',
          3 => 'Nada',
        ),
        'correcta' => 'Cooperación y orden',
      ),
      4 => 
      array (
        'pregunta' => 'Rol social es',
        'opciones' => 
        array (
          0 => 'Comportamiento esperado',
          1 => 'Trabajo',
          2 => 'Dinero',
          3 => 'Ley',
        ),
        'correcta' => 'Comportamiento esperado',
      ),
      5 => 
      array (
        'pregunta' => 'Institución es',
        'opciones' => 
        array (
          0 => 'Estructura estable',
          1 => 'Persona',
          2 => 'Evento',
          3 => 'Objeto',
        ),
        'correcta' => 'Estructura estable',
      ),
      6 => 
      array (
        'pregunta' => 'Estratos sociales miden',
        'opciones' => 
        array (
          0 => 'Desigualdad',
          1 => 'Igualdad',
          2 => 'Población',
          3 => 'Territorio',
        ),
        'correcta' => 'Desigualdad',
      ),
      7 => 
      array (
        'pregunta' => 'México: institución macro',
        'opciones' => 
        array (
          0 => 'INE',
          1 => 'Familia',
          2 => 'Escuela',
          3 => 'Amigos',
        ),
        'correcta' => 'INE',
      ),
      8 => 
      array (
        'pregunta' => 'Interdependencia',
        'opciones' => 
        array (
          0 => 'Niveles se influyen',
          1 => 'Independientes',
          2 => 'Separados',
          3 => 'Iguales',
        ),
        'correcta' => 'Niveles se influyen',
      ),
      9 => 
      array (
        'pregunta' => 'SI 2025: México población',
        'opciones' => 
        array (
          0 => '~130 millones',
          1 => '100M',
          2 => '200M',
          3 => '50M',
        ),
        'correcta' => '~130 millones',
      ),
      10 => 
      array (
        'pregunta' => 'Familia es nivel',
        'opciones' => 
        array (
          0 => 'Micro',
          1 => 'Meso',
          2 => 'Macro',
          3 => 'Ninguno',
        ),
        'correcta' => 'Micro',
      ),
      11 => 
      array (
        'pregunta' => 'SEP es nivel',
        'opciones' => 
        array (
          0 => 'Meso',
          1 => 'Micro',
          2 => 'Macro',
          3 => 'Ninguno',
        ),
        'correcta' => 'Meso',
      ),
      12 => 
      array (
        'pregunta' => 'Constitución es nivel',
        'opciones' => 
        array (
          0 => 'Macro',
          1 => 'Micro',
          2 => 'Meso',
          3 => 'Ninguno',
        ),
        'correcta' => 'Macro',
      ),
      13 => 
      array (
        'pregunta' => 'Poder legítimo',
        'opciones' => 
        array (
          0 => 'Autoridad',
          1 => 'Fuerza',
          2 => 'Dinero',
          3 => 'Fama',
        ),
        'correcta' => 'Autoridad',
      ),
      14 => 
      array (
        'pregunta' => 'Clase social depende de',
        'opciones' => 
        array (
          0 => 'Ingreso, educación',
          1 => 'Edad',
          2 => 'Género',
          3 => 'Color',
        ),
        'correcta' => 'Ingreso, educación',
      ),
      15 => 
      array (
        'pregunta' => 'México: estratificación alta',
        'opciones' => 
        array (
          0 => 'Sí (índice Gini)',
          1 => 'No',
          2 => 'Igual',
          3 => 'Perfecta',
        ),
        'correcta' => 'Sí (índice Gini)',
      ),
      16 => 
      array (
        'pregunta' => 'Escuela socializa en',
        'opciones' => 
        array (
          0 => 'Normas y valores',
          1 => 'Solo matemáticas',
          2 => 'Nada',
          3 => 'Juegos',
        ),
        'correcta' => 'Normas y valores',
      ),
      17 => 
      array (
        'pregunta' => 'Empresa es',
        'opciones' => 
        array (
          0 => 'Institución meso',
          1 => 'Micro',
          2 => 'Macro',
          3 => 'Personal',
        ),
        'correcta' => 'Institución meso',
      ),
      18 => 
      array (
        'pregunta' => 'Globalización afecta',
        'opciones' => 
        array (
          0 => 'Nivel macro',
          1 => 'Solo micro',
          2 => 'Nada',
          3 => 'Meso',
        ),
        'correcta' => 'Nivel macro',
      ),
      19 => 
      array (
        'pregunta' => 'SI 2025: sociedad digital',
        'opciones' => 
        array (
          0 => 'Redes conectan niveles',
          1 => 'Solo micro',
          2 => 'Solo macro',
          3 => 'Nada',
        ),
        'correcta' => 'Redes conectan niveles',
      ),
      20 => 
      array (
        'pregunta' => 'Individuo → grupo → estado',
        'opciones' => 
        array (
          0 => 'Micro → meso → macro',
          1 => 'Macro → meso → micro',
          2 => 'Aleatorio',
          3 => 'Igual',
        ),
        'correcta' => 'Micro → meso → macro',
      ),
      21 => 
      array (
        'pregunta' => 'Cambio en micro afecta',
        'opciones' => 
        array (
          0 => 'Puede escalar a macro',
          1 => 'Solo micro',
          2 => 'Nada',
          3 => 'Meso',
        ),
        'correcta' => 'Puede escalar a macro',
      ),
      22 => 
      array (
        'pregunta' => 'Protesta social inicia en',
        'opciones' => 
        array (
          0 => 'Micro/meso',
          1 => 'Macro',
          2 => 'Gobierno',
          3 => 'Exterior',
        ),
        'correcta' => 'Micro/meso',
      ),
      23 => 
      array (
        'pregunta' => 'Ley educativa es',
        'opciones' => 
        array (
          0 => 'Macro',
          1 => 'Meso',
          2 => 'Micro',
          3 => 'Ninguno',
        ),
        'correcta' => 'Macro',
      ),
      24 => 
      array (
        'pregunta' => 'Amistad es',
        'opciones' => 
        array (
          0 => 'Relación micro',
          1 => 'Meso',
          2 => 'Macro',
          3 => 'Institución',
        ),
        'correcta' => 'Relación micro',
      ),
      25 => 
      array (
        'pregunta' => 'INEGI mide',
        'opciones' => 
        array (
          0 => 'Nivel macro',
          1 => 'Micro',
          2 => 'Meso',
          3 => 'Personal',
        ),
        'correcta' => 'Nivel macro',
      ),
      26 => 
      array (
        'pregunta' => 'Familia nuclear es',
        'opciones' => 
        array (
          0 => 'Microestructura',
          1 => 'Meso',
          2 => 'Macro',
          3 => 'Global',
        ),
        'correcta' => 'Microestructura',
      ),
      27 => 
      array (
        'pregunta' => 'México: federalismo',
        'opciones' => 
        array (
          0 => 'Organización macro',
          1 => 'Micro',
          2 => 'Meso',
          3 => 'Local',
        ),
        'correcta' => 'Organización macro',
      ),
      28 => 
      array (
        'pregunta' => 'SI 2025: sociedad inclusiva',
        'opciones' => 
        array (
          0 => 'Equidad en todos niveles',
          1 => 'Solo macro',
          2 => 'Solo micro',
          3 => 'Nada',
        ),
        'correcta' => 'Equidad en todos niveles',
      ),
      29 => 
      array (
        'pregunta' => 'Organización social es',
        'opciones' => 
        array (
          0 => 'Dinámica y cambiante',
          1 => 'Estática',
          2 => 'Fija',
          3 => 'Inmutable',
        ),
        'correcta' => 'Dinámica y cambiante',
      ),
    ),
  ),
  2 => 
  array (
    'materia' => 'Ciencias Sociales',
    'slug' => 'normas-sociales-juridicas',
    'titulo' => 'Normas Sociales vs. Jurídicas: El Código de la Convivencia',
    'contenido' => '<!-- INICIO LECCIÓN CYBERPUNK -->
<div class="leccion-container leccion-ciencias-sociales-normas" data-tema="normas-sociales-juridicas">
    <!-- CABECERA CYBERPUNK -->
    <header class="leccion-header">
        <h1 class="titulo-leccion neon-glow">
            <span class="icon-tema">⚖️</span> NORMAS SOCIALES Y JURÍDICAS
        </h1>
        <div class="subtitulo">
            El equilibrio entre lo informal y lo formal en la sociedad
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
                <h3>Diferenciar normas sociales y jurídicas</h3>
                <p>Identificar características, ejemplos y sanciones de cada tipo.</p>
            </div>
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Analizar conflictos entre normas</h3>
                <p>Evaluar casos donde normas sociales y jurídicas chocan.</p>
            </div>
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Aplicar el conocimiento a situaciones reales</h3>
                <p>Resolver casos prácticos y reflexionar sobre su impacto.</p>
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
                <h3>📱 Leyes de Privacidad Digital (2025)</h3>
                <p>Normas jurídicas que regulan el uso de datos personales en redes sociales.</p>
                <div class="dato-neon">180 países con leyes de protección de datos</div>
            </div>
            <div class="contexto-card">
                <h3>👗 Normas de Género en Escuelas</h3>
                <p>Conflicto entre costumbres sociales y leyes de inclusión.</p>
                <div class="dato-neon">65% de escuelas con políticas de género</div>
            </div>
            <div class="contexto-card">
                <h3>🚗 Leyes de Movilidad (CDMX 2024)</h3>
                <p>Normas jurídicas que buscan cambiar hábitos sociales de transporte.</p>
                <div class="dato-neon">Reducción del 30% en accidentes</div>
            </div>
        </div>
    </section>

    <!-- SECCIÓN TEÓRICA -->
    <section class="teoria-section">
        <div class="borde-neon-lateral"></div>
        <h2 class="seccion-titulo neon-concepto">
            <span class="icon">📚</span> FUNDAMENTOS TEÓRICOS
        </h2>

        <!-- TIPOS DE NORMAS -->
        <div class="subseccion">
            <h3>1. Tipos de Normas</h3>
            <div class="comparativa-grid">
                <div class="comp-card social">
                    <div class="comp-header">
                        <h4>👥 NORMAS SOCIALES</h4>
                        <div class="comp-badge">Informales | Culturales</div>
                    </div>
                    <div class="comp-caracteristicas">
                        <p><strong>Definición:</strong> Reglas no escritas basadas en costumbres y tradiciones.</p>
                        <p><strong>Origen:</strong> Consenso comunitario.</p>
                        <p><strong>Sanción:</strong> Rechazo social, exclusión.</p>
                    </div>
                    <div class="comp-ejemplos">
                        <div class="ejemplo-item">
                            <div class="simbolo">🤝</div>
                            <div class="nombre">Saludar al entrar a un lugar</div>
                        </div>
                        <div class="ejemplo-item">
                            <div class="simbolo">⏰</div>
                            <div class="nombre">Ser puntual en reuniones</div>
                        </div>
                    </div>
                </div>
                <div class="comp-card juridica">
                    <div class="comp-header">
                        <h4>⚖️ NORMAS JURÍDICAS</h4>
                        <div class="comp-badge">Formales | Estatales</div>
                    </div>
                    <div class="comp-caracteristicas">
                        <p><strong>Definición:</strong> Reglas escritas y obligatorias creadas por el Estado.</p>
                        <p><strong>Origen:</strong> Poder legislativo.</p>
                        <p><strong>Sanción:</strong> Multas, prisión, juicios.</p>
                    </div>
                    <div class="comp-ejemplos">
                        <div class="ejemplo-item">
                            <div class="simbolo">📜</div>
                            <div class="nombre">Código Penal (Art. 171: Conducir ebrio)</div>
                        </div>
                        <div class="ejemplo-item">
                            <div class="simbolo">🏛️</div>
                            <div class="nombre">Constitución (Derechos humanos)</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- RELACIÓN ENTRE NORMAS -->
        <div class="subseccion">
            <h3>2. Relación entre Normas Sociales y Jurídicas</h3>
            <div class="regla-oro">
                <h4>🔄 DINÁMICA DE INTERACCIÓN</h4>
                <div class="regla-content">
                    <div class="regla-item">
                        <div class="regla-icon">↗️</div>
                        <div class="regla-text">
                            <strong>De Social a Jurídica:</strong> Cuando una norma social se institucionaliza (ej. matrimonio igualitario).
                        </div>
                    </div>
                    <div class="regla-item">
                        <div class="regla-icon">↘️</div>
                        <div class="regla-text">
                            <strong>De Jurídica a Social:</strong> Cuando una ley cambia costumbres (ej. prohibición de fumar en lugares públicos).
                        </div>
                    </div>
                    <div class="regla-item">
                        <div class="regla-icon">⚠️</div>
                        <div class="regla-text">
                            <strong>Conflicto:</strong> Cuando ley y costumbre chocan (ej. derechos indígenas vs. leyes estatales).
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- SVG INTERACTIVO -->
        <div class="subseccion">
            <h3>3. Evolución de las Normas</h3>
            <div class="svg-diagram">
                <svg viewBox="0 0 800 500" id="svgNormas">
                    <!-- Fondo -->
                    <rect x="0" y="0" width="800" height="500" fill="#0a0a1a" id="fondoNormas"/>
                    <!-- Norma Social -->
                    <g id="normaSocial">
                        <rect x="100" y="150" width="250" height="150" fill="#FF00FF" rx="15" opacity="0.8"/>
                        <text x="225" y="200" fill="white" font-size="16" text-anchor="middle">NORMAS SOCIALES</text>
                        <text x="225" y="230" fill="white" font-size="12" text-anchor="middle">Informales | Costumbres</text>
                        <text x="225" y="260" fill="white" font-size="12" text-anchor="middle">Sanción: Rechazo</text>
                    </g>
                    <!-- Norma Jurídica -->
                    <g id="normaJuridica">
                        <rect x="450" y="150" width="250" height="150" fill="#7B1FA2" rx="15" opacity="0.8"/>
                        <text x="575" y="200" fill="white" font-size="16" text-anchor="middle">NORMAS JURÍDICAS</text>
                        <text x="575" y="230" fill="white" font-size="12" text-anchor="middle">Formales | Leyes</text>
                        <text x="575" y="260" fill="white" font-size="12" text-anchor="middle">Sanción: Legal</text>
                    </g>
                    <!-- Flecha de interacción -->
                    <line x1="375" y1="225" x2="450" y2="225" stroke="#00FFAA" stroke-width="3" marker-end="url(#flecha)"/>
                    <text x="412" y="210" fill="#00FFAA" font-size="14" text-anchor="middle">↔ CONFLICTO/ARMONÍA</text>
                    <!-- Evolución -->
                    <g id="evolucionSocial">
                        <path d="M200 350 Q250 300 300 350 Q250 400 200 350" fill="none" stroke="#FF9800" stroke-width="3">
                            <animate attributeName="d" values="M200 350 Q250 300 300 350 Q250 400 200 350; M200 350 Q250 280 300 350 Q250 420 200 350; M200 350 Q250 300 300 350 Q250 400 200 350" dur="2s" repeatCount="indefinite"/>
                        </path>
                        <text x="250" y="380" fill="#FF9800" font-size="14" text-anchor="middle">Social → Jurídica</text>
                        <text x="250" y="400" fill="white" font-size="12" text-anchor="middle">Ej: Matrimonio igualitario</text>
                    </g>
                    <g id="evolucionJuridica">
                        <path d="M500 350 Q550 300 600 350 Q550 400 500 350" fill="none" stroke="#4CAF50" stroke-width="3">
                            <animate attributeName="d" values="M500 350 Q550 300 600 350 Q550 400 500 350; M500 350 Q550 280 600 350 Q550 420 500 350; M500 350 Q550 300 600 350 Q550 400 500 350" dur="2s" repeatCount="indefinite"/>
                        </path>
                        <text x="550" y="380" fill="#4CAF50" font-size="14" text-anchor="middle">Jurídica → Social</text>
                        <text x="550" y="400" fill="white" font-size="12" text-anchor="middle">Ej: Prohibición de fumar</text>
                    </g>
                </svg>
            </div>
        </div>
    </section>

    <!-- SIMULADOR INTERACTIVO -->
    <section class="simulator-section">
        <h2 class="seccion-titulo neon-interactivo">
            <span class="icon">🎮</span> SIMULADOR: CONFLICTOS NORMATIVOS
        </h2>
        <div class="simulator-container" data-tema="conflictos-normativos">
            <!-- PANEL DE CONTROLES -->
            <div class="simulator-controls">
                <h3>📋 CASOS DE ESTUDIO</h3>
                <div class="control-group">
                    <label for="casoInput">Selecciona un caso:</label>
                    <select id="casoInput" class="control-input">
                        <option value="matrimonio-igualitario">Matrimonio Igualitario</option>
                        <option value="derechos-indigenas">Derechos Indígenas vs. Leyes Estatales</option>
                        <option value="privacidad-digital">Privacidad Digital</option>
                        <option value="movilidad-urbana">Movilidad Urbana</option>
                    </select>
                </div>
                <div class="control-group">
                    <label for="contexto">Contexto:</label>
                    <select id="contexto" class="control-input">
                        <option value="mexico">México (2025)</option>
                        <option value="espana">España</option>
                        <option value="eeuu">EE.UU.</option>
                    </select>
                </div>
                <button class="btn-analizar" onclick="analizarCaso()">
                    <span class="btn-icon">🔍</span> ANALIZAR CASO
                </button>
            </div>
            <!-- VISUALIZACIÓN -->
            <div class="simulator-visualization">
                <div class="caso-detalle" id="detalleCaso">
                    <h4>📄 DETALLES DEL CASO</h4>
                    <div class="caso-contenido">
                        <p id="casoDescripcion">Selecciona un caso y haz clic en "ANALIZAR CASO".</p>
                        <div class="caso-datos">
                            <div class="dato-item">
                                <span class="dato-label">Norma Social:</span>
                                <span class="dato-value" id="normaSocial">—</span>
                            </div>
                            <div class="dato-item">
                                <span class="dato-label">Norma Jurídica:</span>
                                <span class="dato-value" id="normaJuridica">—</span>
                            </div>
                            <div class="dato-item">
                                <span class="dato-label">Conflicto:</span>
                                <span class="dato-value" id="conflicto">—</span>
                            </div>
                            <div class="dato-item">
                                <span class="dato-label">Solución:</span>
                                <span class="dato-value" id="solucion">—</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- DATOS EN TIEMPO REAL -->
            <div class="simulator-data">
                <h3>📊 DATOS LEGALES</h3>
                <div class="data-card">
                    <div class="data-label">País:</div>
                    <div class="data-value" id="dataPais">—</div>
                </div>
                <div class="data-card">
                    <div class="data-label">Año:</div>
                    <div class="data-value" id="dataAnio">—</div>
                </div>
                <div class="data-card">
                    <div class="data-label">Ley Aplicable:</div>
                    <div class="data-value" id="dataLey">—</div>
                </div>
                <div class="data-card highlight">
                    <div class="data-label">Impacto Social:</div>
                    <div class="data-value" id="dataImpacto">—</div>
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
                    <h3>¿Cuál es una sanción típica de una norma social?</h3>
                </div>
                <div class="quiz-options">
                    <button class="quiz-option" data-value="A">
                        <span class="option-letter">A</span>
                        Multa económica
                    </button>
                    <button class="quiz-option" data-value="B">
                        <span class="option-letter">B</span>
                        Rechazo social
                    </button>
                    <button class="quiz-option" data-value="C">
                        <span class="option-letter">C</span>
                        Prisión
                    </button>
                </div>
                <div class="quiz-feedback" style="display: none;">
                    <div class="feedback-correct">
                        <strong>Correcto:</strong> El rechazo social es la sanción más común para normas sociales.
                    </div>
                    <div class="feedback-incorrect">
                        ❌ <strong>Incorrecto:</strong> Las multas y la prisión son sanciones jurídicas.
                    </div>
                </div>
            </div>
            <!-- PREGUNTA 2 -->
            <div class="quiz-question" data-correct="C">
                <div class="quiz-header">
                    <span class="quiz-num">02</span>
                    <h3>¿Qué norma es formal y escrita?</h3>
                </div>
                <div class="quiz-options">
                    <button class="quiz-option" data-value="A">
                        <span class="option-letter">A</span>
                        Saludar al entrar
                    </button>
                    <button class="quiz-option" data-value="B">
                        <span class="option-letter">B</span>
                        Ser puntual
                    </button>
                    <button class="quiz-option" data-value="C">
                        <span class="option-letter">C</span>
                        Código Penal
                    </button>
                </div>
                <div class="quiz-feedback" style="display: none;">
                    <div class="feedback-correct">
                        <strong>Correcto:</strong> El Código Penal es una norma jurídica formal.
                    </div>
                    <div class="feedback-incorrect">
                        ❌ <strong>Incorrecto:</strong> Las otras opciones son normas sociales informales.
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
                    Completa el quiz para ver tus resultados.
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
            <span class="icon">⚠️</span> ERRORES COMUNES
        </h2>
        <div class="errores-container">
            <div class="error-card">
                <div class="error-header" onclick="toggleError(this)">
                    <h3>❌ CONFUNDIR NORMAS SOCIALES CON JURÍDICAS</h3>
                    <span class="error-toggle">+</span>
                </div>
                <div class="error-content">
                    <div class="error-ejemplo">
                        <strong>Error:</strong> "El Código Penal es una norma social porque todos lo conocen."
                    </div>
                    <div class="error-correccion">
                        <strong>Corrección:</strong> El Código Penal es una <strong>norma jurídica</strong> porque está escrita, es obligatoria y tiene sanciones legales.
                    </div>
                    <div class="error-practica">
                        <p><strong>Practica:</strong> Clasifica: Saludar, Código Civil, Vestir de luto.</p>
                        <button class="btn-mini" onclick="mostrarSolucion(1)">Ver solución</button>
                        <div class="solucion" id="solucion1" style="display: none;">
                            <strong>Saludar:</strong> Norma social<br>
                            <strong>Código Civil:</strong> Norma jurídica<br>
                            <strong>Vestir de luto:</strong> Norma social
                        </div>
                    </div>
                </div>
            </div>
            <div class="error-card">
                <div class="error-header" onclick="toggleError(this)">
                    <h3>❌ IGNORAR LA EVOLUCIÓN DE LAS NORMAS</h3>
                    <span class="error-toggle">+</span>
                </div>
                <div class="error-content">
                    <div class="error-ejemplo">
                        <strong>Error:</strong> "Las normas sociales nunca cambian."
                    </div>
                    <div class="error-correccion">
                        <strong>Corrección:</strong> Las normas sociales <strong>evolucionan</strong> con la sociedad (ej. roles de género, uso de tecnología).
                    </div>
                    <div class="error-tabla">
                        <table>
                            <tr>
                                <th>Norma Social Antigua</th>
                                <th>Norma Social Actual</th>
                            </tr>
                            <tr>
                                <td>Solo hombres podían votar</td>
                                <td>Derecho al voto universal</td>
                            </tr>
                            <tr>
                                <td>Matrimonio solo heterosexual</td>
                                <td>Matrimonio igualitario</td>
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
                    <h3>Análisis de Caso: Matrimonio Igualitario</h3>
                </div>
                <div class="problema-enunciado">
                    <p>Analiza cómo el matrimonio igualitario pasó de ser una <strong>norma social marginal</strong> a una <strong>norma jurídica</strong> en México (2022).</p>
                    <ol>
                        <li>Describe el conflicto inicial entre normas sociales y jurídicas.</li>
                        <li>Explica el proceso de cambio legal.</li>
                        <li>Evalúa el impacto social actual.</li>
                    </ol>
                </div>
                <div class="problema-espacio">
                    <textarea placeholder="Escribe tu análisis aquí..." rows="8"></textarea>
                </div>
                <button class="btn-verificar" onclick="verificarProblema(1)">VERIFICAR SOLUCIÓN</button>
                <div class="problema-solucion" id="solucionP1" style="display: none;">
                    <strong>Solución:</strong><br>
                    1. <strong>Conflicto inicial:</strong> La norma social tradicional solo aceptaba el matrimonio heterosexual, mientras que grupos LGBT+ exigían igualdad.<br>
                    2. <strong>Proceso legal:</strong> En 2015, la SCJN declaró inconstitucional prohibir el matrimonio igualitario. Para 2022, 30 estados lo reconocieron.<br>
                    3. <strong>Impacto social:</strong> Reducción de la discriminación y mayor visibilidad de derechos LGBT+.
                </div>
            </div>
            <div class="problema-card">
                <div class="problema-header">
                    <span class="problema-num">P2</span>
                    <h3>Propuesta de Ley: Uso de Cubrebocas</h3>
                </div>
                <div class="problema-enunciado">
                    <p>Durante la pandemia (2020-2022), el uso de cubrebocas pasó de ser una <strong>recomendación social</strong> a una <strong>obligación jurídica</strong> en muchos países.</p>
                    <ol>
                        <li>¿Qué factores sociales impulsaron este cambio?</li>
                        <li>¿Qué sanciones jurídicas se aplicaron?</li>
                        <li>¿Cómo afectó esto a la convivencia?</li>
                    </ol>
                </div>
                <div class="problema-espacio">
                    <textarea placeholder="Describe tu análisis..." rows="8"></textarea>
                </div>
                <button class="btn-verificar" onclick="verificarProblema(2)">VERIFICAR SOLUCIÓN</button>
                <div class="problema-solucion" id="solucionP2" style="display: none;">
                    <strong>Solución:</strong><br>
                    1. <strong>Factores sociales:</strong> Aumento de contagios y presión de la comunidad científica.<br>
                    2. <strong>Sanciones jurídicas:</strong> Multas por no usar cubrebocas en espacios públicos (ej. $500-$2000 MXN).<br>
                    3. <strong>Impacto en convivencia:</strong> Polarización entre quienes apoyaban la medida y quienes la veían como una violación a libertades.
                </div>
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
                    <td>Análisis de conflicto</td>
                    <td>Explica claramente el conflicto con ejemplos.</td>
                    <td>Describe el conflicto sin profundizar.</td>
                    <td>No identifica el conflicto.</td>
                </tr>
                <tr>
                    <td>Proceso de cambio</td>
                    <td>Detalla pasos legales y sociales del cambio.</td>
                    <td>Menciona algunos pasos sin claridad.</td>
                    <td>Omite el proceso de cambio.</td>
                </tr>
                <tr>
                    <td>Impacto social</td>
                    <td>Evalúa consecuencias sociales con datos.</td>
                    <td>Menciona consecuencias sin sustento.</td>
                    <td>No analiza el impacto.</td>
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
                    <label>Diferenciar normas sociales y jurídicas:</label>
                    <input type="range" min="1" max="5" value="3" class="autoeval-slider" id="slider1">
                    <div class="slider-labels">
                        <span>Básico</span><span>Intermedio</span><span>Avanzado</span>
                    </div>
                </div>
                <div class="slider-group">
                    <label>Analizar conflictos normativos:</label>
                    <input type="range" min="1" max="5" value="3" class="autoeval-slider" id="slider2">
                    <div class="slider-labels">
                        <span>Básico</span><span>Intermedio</span><span>Avanzado</span>
                    </div>
                </div>
                <div class="slider-group">
                    <label>Aplicar a situaciones reales:</label>
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
                <h3>💭 REFLEXIÓN GUIADA</h3>
                <div class="pregunta-reflexion">
                    <p>¿Cómo crees que las redes sociales han acelerado el cambio de normas sociales a jurídicas? Da un ejemplo.</p>
                    <textarea placeholder="Escribe tu reflexión..." rows="4" id="reflexion1"></textarea>
                </div>
                <div class="pregunta-reflexion">
                    <p>Propón una norma social actual que consideres debería convertirse en jurídica. Justifica tu respuesta.</p>
                    <textarea placeholder="Ejemplo..." rows="4" id="reflexion2"></textarea>
                </div>
            </div>
            <div class="plan-estudio">
                <h3>📅 PLAN DE ESTUDIO RECOMENDADO</h3>
                <div class="plan-grid">
                    <div class="plan-card">
                        <h4>🔹 REPASO RÁPIDO (20 min)</h4>
                        <ul>
                            <li>Repasar diferencias clave entre normas.</li>
                            <li>Memorizar ejemplos de cada tipo.</li>
                            <li>Identificar sanciones típicas.</li>
                        </ul>
                    </div>
                    <div class="plan-card">
                        <h4>🔹 PRÁCTICA (30 min)</h4>
                        <ul>
                            <li>Analizar 3 casos de conflicto normativo.</li>
                            <li>Completar el quiz interactivo.</li>
                            <li>Resolver problemas tipo examen.</li>
                        </ul>
                    </div>
                    <div class="plan-card">
                        <h4>🔹 PROFUNDIZACIÓN (45 min)</h4>
                        <ul>
                            <li>Investigar un caso real de cambio normativo.</li>
                            <li>Debatir en clase sobre normas controvertidas.</li>
                            <li>Reflexionar sobre el impacto de las redes sociales.</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="recursos">
                <h3>🌐 RECURSOS ADICIONALES</h3>
                <div class="recursos-links">
                    <a href="https://www.scjn.gob.mx/" target="_blank" class="recurso-link">
                        📜 Suprema Corte de Justicia (México)
                    </a>
                    <a href="https://www.ohchr.org/es" target="_blank" class="recurso-link">
                        🌍 ONU Derechos Humanos
                    </a>
                    <a href="https://www.inegi.org.mx/" target="_blank" class="recurso-link">
                        📊 INEGI: Estadísticas Sociales
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- JAVASCRIPT INTEGRADO -->
<script>
// ===========================================
// BASE DE DATOS DE CASOS
// ===========================================
const casosDB = {
    "matrimonio-igualitario": {
        descripcion: "El matrimonio igualitario en México pasó de ser un tema social a una norma jurídica reconocida en 30 estados para 2022.",
        normaSocial: "Aceptación progresiva en la sociedad (2010-2020).",
        normaJuridica: "Reforma al Código Civil y sentencias de la SCJN (2015-2022).",
        conflicto: "Resistencia de grupos conservadores vs. derechos LGBT+.",
        solucion: "Leyes estatales y federales que garantizan el derecho.",
        pais: "México",
        anio: "2022",
        ley: "Art. 4 Constitucional + Códigos Civiles Estatales",
        impacto: "Mayor inclusión y reducción de discriminación."
    },
    "derechos-indigenas": {
        descripcion: "Conflicto entre leyes estatales y sistemas normativos indígenas en temas como justicia y territorio.",
        normaSocial: "Usos y costumbres de pueblos originarios.",
        normaJuridica: "Leyes federales y tratados internacionales.",
        conflicto: "Despojo de tierras y falta de reconocimiento legal.",
        solucion: "Reformas constitucionales (ej. Art. 2 Constitucional).",
        pais: "México",
        anio: "2021",
        ley: "Ley de Derechos de Pueblos Indígenas",
        impacto: "Reconocimiento parcial de autonomía."
    },
    "privacidad-digital": {
        descripcion: "Normas jurídicas para proteger datos personales en internet, frente a prácticas sociales de compartir información.",
        normaSocial: "Uso masivo de redes sociales sin privacidad.",
        normaJuridica: "Ley General de Protección de Datos (2020).",
        conflicto: "Empresas vs. derechos de usuarios.",
        solucion: "Regulaciones y multas a plataformas digitales.",
        pais: "México",
        anio: "2020",
        ley: "LGPDP",
        impacto: "Mayor conciencia sobre privacidad."
    },
    "movilidad-urbana": {
        descripcion: "Leyes de movilidad que buscan cambiar hábitos de transporte (ej. uso de auto particular).",
        normaSocial: "Preferencia por el automóvil privado.",
        normaJuridica: "Ley de Movilidad de CDMX (2020).",
        conflicto: "Resistencia al uso de transporte público.",
        solucion: "Incentivos fiscales y restricciones al auto.",
        pais: "México",
        anio: "2020",
        ley: "Ley de Movilidad CDMX",
        impacto: "Reducción del 15% en emisiones."
    }
};

// ===========================================
// SIMULADOR: ANALIZAR CASOS
// ===========================================
function analizarCaso() {
    const casoSeleccionado = document.getElementById(\'casoInput\').value;
    const contexto = document.getElementById(\'contexto\').value;
    const caso = casosDB[casoSeleccionado];

    // Actualizar detalles del caso
    document.getElementById(\'casoDescripcion\').textContent = caso.descripcion;
    document.getElementById(\'normaSocial\').textContent = caso.normaSocial;
    document.getElementById(\'normaJuridica\').textContent = caso.normaJuridica;
    document.getElementById(\'conflicto\').textContent = caso.conflicto;
    document.getElementById(\'solucion\').textContent = caso.solucion;

    // Actualizar datos legales
    document.getElementById(\'dataPais\').textContent = caso.pais;
    document.getElementById(\'dataAnio\').textContent = caso.anio;
    document.getElementById(\'dataLey\').textContent = caso.ley;
    document.getElementById(\'dataImpacto\').textContent = caso.impacto;

    console.log(`📊 Caso analizado: ${casoSeleccionado} en ${contexto}`);
}

// ===========================================
// QUIZ INTERACTIVO
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
    const porcentaje = Math.round((correctas / total) * 100);

    document.getElementById(\'quizScore\').textContent = `${correctas}/${total}`;

    let feedback = "";
    if (porcentaje >= 80) {
        feedback = "🌟 Excelente! Dominas las diferencias entre normas sociales y jurídicas.";
    } else if (porcentaje >= 60) {
        feedback = "👍 Buen trabajo, pero repasa los ejemplos de sanciones.";
    } else {
        feedback = "📚 Necesitas estudiar más las características de cada tipo de norma.";
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
// ERRORES COMUNES
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

function mostrarSolucion(num) {
    const solucion = document.getElementById(`solucion${num}`);
    solucion.style.display = solucion.style.display === \'block\' ? \'none\' : \'block\';
}

// ===========================================
// PROBLEMAS TIPO EXAMEN
// ===========================================
function verificarProblema(num) {
    const solucion = document.getElementById(`solucionP${num}`);
    solucion.style.display = solucion.style.display === \'block\' ? \'none\' : \'block\';
}

// ===========================================
// AUTOEVALUACIÓN
// ===========================================
function guardarAutoevaluacion() {
    const slider1 = document.getElementById(\'slider1\').value;
    const slider2 = document.getElementById(\'slider2\').value;
    const slider3 = document.getElementById(\'slider3\').value;
    const promedio = (parseInt(slider1) + parseInt(slider2) + parseInt(slider3)) / 3;

    alert(`💾 Autoevaluación guardada:\\n\\n` +
          `Diferenciación: ${slider1}/5\\n` +
          `Análisis de conflictos: ${slider2}/5\\n` +
          `Aplicación práctica: ${slider3}/5\\n\\n` +
          `Promedio: ${promedio.toFixed(1)}/5\\n\\n` +
          `Revisa el plan de estudio según tus resultados.`);
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
console.log("🚀 Lección Cyberpunk: Normas Sociales y Jurídicas - Cargada");
console.log("🎮 Simulador, Quiz y Herramientas interactivas listas");
</script>',
    'ejercicios' => 
    array (
      0 => 
      array (
        'enunciado' => 'Normas sociales son',
        'respuesta' => 'Informales, basadas en costumbres',
      ),
      1 => 
      array (
        'enunciado' => 'Normas jurídicas son',
        'respuesta' => 'Formales, con sanción legal',
      ),
      2 => 
      array (
        'enunciado' => 'Sanción social',
        'respuesta' => 'Rechazo, crítica',
      ),
      3 => 
      array (
        'enunciado' => 'Sanción jurídica',
        'respuesta' => 'Multa, cárcel',
      ),
      4 => 
      array (
        'enunciado' => 'Ejemplo norma social',
        'respuesta' => 'No hablar con la boca llena',
      ),
      5 => 
      array (
        'enunciado' => 'Ejemplo norma jurídica',
        'respuesta' => 'No robar (Código Penal)',
      ),
      6 => 
      array (
        'enunciado' => 'Norma social → jurídica',
        'respuesta' => 'Ej. no discriminación',
      ),
      7 => 
      array (
        'enunciado' => 'Conflicto norma vs ley',
        'respuesta' => 'Ej. matrimonio igualitario',
      ),
      8 => 
      array (
        'enunciado' => 'Estado crea',
        'respuesta' => 'Normas jurídicas',
      ),
      9 => 
      array (
        'enunciado' => 'México: ley clave',
        'respuesta' => 'Constitución Política',
      ),
      10 => 
      array (
        'enunciado' => 'Costumbre → ley',
        'respuesta' => 'Proceso legislativo',
      ),
      11 => 
      array (
        'enunciado' => 'SI: cumplimiento normativo',
        'respuesta' => 'Base de convivencia',
      ),
    ),
    'quiz' => 
    array (
      0 => 
      array (
        'pregunta' => 'Normas sociales',
        'opciones' => 
        array (
          0 => 'Informales',
          1 => 'Formales',
          2 => 'Escritas',
          3 => 'Obligatorias',
        ),
        'correcta' => 'Informales',
      ),
      1 => 
      array (
        'pregunta' => 'Normas jurídicas',
        'opciones' => 
        array (
          0 => 'Formales con sanción',
          1 => 'Informales',
          2 => 'Opcionales',
          3 => 'Morales',
        ),
        'correcta' => 'Formales con sanción',
      ),
      2 => 
      array (
        'pregunta' => 'Sanción social',
        'opciones' => 
        array (
          0 => 'Rechazo social',
          1 => 'Cárcel',
          2 => 'Multa',
          3 => 'Juicio',
        ),
        'correcta' => 'Rechazo social',
      ),
      3 => 
      array (
        'pregunta' => 'Sanción jurídica',
        'opciones' => 
        array (
          0 => 'Legal (multa, cárcel)',
          1 => 'Crítica',
          2 => 'Ignorancia',
          3 => 'Nada',
        ),
        'correcta' => 'Legal (multa, cárcel)',
      ),
      4 => 
      array (
        'pregunta' => 'Ejemplo social',
        'opciones' => 
        array (
          0 => 'Ser puntual',
          1 => 'Pagar impuestos',
          2 => 'Firmar contrato',
          3 => 'Votar',
        ),
        'correcta' => 'Ser puntual',
      ),
      5 => 
      array (
        'pregunta' => 'Ejemplo jurídico',
        'opciones' => 
        array (
          0 => 'No conducir ebrio',
          1 => 'Decir gracias',
          2 => 'Vestir formal',
          3 => 'Sonreír',
        ),
        'correcta' => 'No conducir ebrio',
      ),
      6 => 
      array (
        'pregunta' => 'Social → jurídica',
        'opciones' => 
        array (
          0 => 'Sí, por aceptación',
          1 => 'No',
          2 => 'Siempre',
          3 => 'Nunca',
        ),
        'correcta' => 'Sí, por aceptación',
      ),
      7 => 
      array (
        'pregunta' => 'Estado crea',
        'opciones' => 
        array (
          0 => 'Normas jurídicas',
          1 => 'Sociales',
          2 => 'Morales',
          3 => 'Religiosas',
        ),
        'correcta' => 'Normas jurídicas',
      ),
      8 => 
      array (
        'pregunta' => 'México: máxima norma',
        'opciones' => 
        array (
          0 => 'Constitución',
          1 => 'Código Civil',
          2 => 'Biblia',
          3 => 'Costumbre',
        ),
        'correcta' => 'Constitución',
      ),
      9 => 
      array (
        'pregunta' => 'Conflicto norma vs ley',
        'opciones' => 
        array (
          0 => 'Cambio social',
          1 => 'Armonía',
          2 => 'Igualdad',
          3 => 'Nada',
        ),
        'correcta' => 'Cambio social',
      ),
      10 => 
      array (
        'pregunta' => 'No saludar es',
        'opciones' => 
        array (
          0 => 'Falta social',
          1 => 'Delito',
          2 => 'Multa',
          3 => 'Cárcel',
        ),
        'correcta' => 'Falta social',
      ),
      11 => 
      array (
        'pregunta' => 'No pagar impuestos es',
        'opciones' => 
        array (
          0 => 'Delito fiscal',
          1 => 'Falta social',
          2 => 'Etiqueta',
          3 => 'Nada',
        ),
        'correcta' => 'Delito fiscal',
      ),
      12 => 
      array (
        'pregunta' => 'Ley contra discriminación',
        'opciones' => 
        array (
          0 => 'Social → jurídica',
          1 => 'Solo jurídica',
          2 => 'Solo social',
          3 => 'Religiosa',
        ),
        'correcta' => 'Social → jurídica',
      ),
      13 => 
      array (
        'pregunta' => 'Costumbre puede',
        'opciones' => 
        array (
          0 => 'Convertirse en ley',
          1 => 'No',
          2 => 'Desaparecer',
          3 => 'Ignorarse',
        ),
        'correcta' => 'Convertirse en ley',
      ),
      14 => 
      array (
        'pregunta' => 'Matrimonio igualitario',
        'opciones' => 
        array (
          0 => 'Ley vs tradición',
          1 => 'Siempre aceptado',
          2 => 'Solo social',
          3 => 'Nada',
        ),
        'correcta' => 'Ley vs tradición',
      ),
      15 => 
      array (
        'pregunta' => 'Código Penal es',
        'opciones' => 
        array (
          0 => 'Norma jurídica',
          1 => 'Social',
          2 => 'Moral',
          3 => 'Religiosa',
        ),
        'correcta' => 'Norma jurídica',
      ),
      16 => 
      array (
        'pregunta' => 'No decir groserías',
        'opciones' => 
        array (
          0 => 'Norma social',
          1 => 'Jurídica',
          2 => 'Económica',
          3 => 'Política',
        ),
        'correcta' => 'Norma social',
      ),
      17 => 
      array (
        'pregunta' => 'SI 2025: leyes federales',
        'opciones' => 
        array (
          0 => '~18,000',
          1 => '100',
          2 => '1M',
          3 => '0',
        ),
        'correcta' => '~18,000',
      ),
      18 => 
      array (
        'pregunta' => 'Cumplir normas permite',
        'opciones' => 
        array (
          0 => 'Convivencia pacífica',
          1 => 'Conflicto',
          2 => 'Caos',
          3 => 'Guerra',
        ),
        'correcta' => 'Convivencia pacífica',
      ),
      19 => 
      array (
        'pregunta' => 'México: Art. 1 Constitución',
        'opciones' => 
        array (
          0 => 'Prohíbe discriminación',
          1 => 'Permite',
          2 => 'Ignora',
          3 => 'Nada',
        ),
        'correcta' => 'Prohíbe discriminación',
      ),
      20 => 
      array (
        'pregunta' => 'Norma moral vs jurídica',
        'opciones' => 
        array (
          0 => 'Moral interna, jurídica externa',
          1 => 'Iguales',
          2 => 'Opuestas',
          3 => 'Ninguna',
        ),
        'correcta' => 'Moral interna, jurídica externa',
      ),
      21 => 
      array (
        'pregunta' => 'Ley de tránsito',
        'opciones' => 
        array (
          0 => 'Jurídica',
          1 => 'Social',
          2 => 'Religiosa',
          3 => 'Personal',
        ),
        'correcta' => 'Jurídica',
      ),
      22 => 
      array (
        'pregunta' => 'Decir "por favor"',
        'opciones' => 
        array (
          0 => 'Norma social',
          1 => 'Jurídica',
          2 => 'Económica',
          3 => 'Política',
        ),
        'correcta' => 'Norma social',
      ),
      23 => 
      array (
        'pregunta' => 'Reforma legal refleja',
        'opciones' => 
        array (
          0 => 'Cambio social',
          1 => 'Estática',
          2 => 'Tradición',
          3 => 'Nada',
        ),
        'correcta' => 'Cambio social',
      ),
      24 => 
      array (
        'pregunta' => 'Incumplir ley →',
        'opciones' => 
        array (
          0 => 'Proceso judicial',
          1 => 'Solo crítica',
          2 => 'Nada',
          3 => 'Premio',
        ),
        'correcta' => 'Proceso judicial',
      ),
      25 => 
      array (
        'pregunta' => 'Incumplir costumbre →',
        'opciones' => 
        array (
          0 => 'Rechazo social',
          1 => 'Cárcel',
          2 => 'Multa',
          3 => 'Juicio',
        ),
        'correcta' => 'Rechazo social',
      ),
      26 => 
      array (
        'pregunta' => 'Normas evolucionan con',
        'opciones' => 
        array (
          0 => 'Sociedad',
          1 => 'Tiempo',
          2 => 'Tecnología',
          3 => 'Todas',
        ),
        'correcta' => 'Todas',
      ),
      27 => 
      array (
        'pregunta' => 'México: ley clave 2025',
        'opciones' => 
        array (
          0 => 'Reforma judicial',
          1 => 'Ninguna',
          2 => 'Antigua',
          3 => 'Secreta',
        ),
        'correcta' => 'Reforma judicial',
      ),
      28 => 
      array (
        'pregunta' => 'SI 2025: estado de derecho',
        'opciones' => 
        array (
          0 => 'Supremacía de la ley',
          1 => 'Fuerza',
          2 => 'Tradición',
          3 => 'Religión',
        ),
        'correcta' => 'Supremacía de la ley',
      ),
      29 => 
      array (
        'pregunta' => 'Normas garantizan',
        'opciones' => 
        array (
          0 => 'Orden y predictibilidad',
          1 => 'Caos',
          2 => 'Libertad total',
          3 => 'Nada',
        ),
        'correcta' => 'Orden y predictibilidad',
      ),
    ),
  ),
  3 => 
  array (
    'materia' => 'Ciencias Sociales',
    'slug' => 'el-estado',
    'titulo' => 'El Estado: Territorio, Población, Gobierno y Soberanía',
    'contenido' => '<!-- INICIO LECCIÓN CYBERPUNK -->
<div class="leccion-container leccion-sociales-estado" data-tema="el-estado">
    
    <!-- CABECERA CYBERPUNK -->
    <header class="leccion-header">
        <h1 class="titulo-leccion neon-glow">
            <span class="icon-tema">🏛️</span>
            EL ESTADO: LA ESTRUCTURA DEL PODER
        </h1>
        <div class="subtitulo">
            Territorio, Población, Gobierno y Soberanía - Los Cuatro Pilares del Estado Moderno
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
                <h3>Identificar los 4 elementos del Estado</h3>
                <p>Territorio, población, gobierno y soberanía según la Convención de Montevideo</p>
            </div>
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Analizar la separación de poderes</h3>
                <p>Comprender las funciones de legislativo, ejecutivo y judicial (Art. 49 CPEUM)</p>
            </div>
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Diferenciar formas de gobierno</h3>
                <p>República vs Monarquía, Federal vs Unitario, Presidencial vs Parlamentario</p>
            </div>
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Evaluar funciones estatales</h3>
                <p>Regular, proveer, representar y garantizar bienestar social</p>
            </div>
        </div>
    </section>

    <!-- CONTEXTO REAL -->
    <section class="contexto-real">
        <h2 class="seccion-titulo neon-dato">
            <span class="icon">🌍</span> DATOS ESTATALES DE MÉXICO
        </h2>
        <div class="contexto-grid">
            <div class="contexto-card">
                <h3>🗺️ Territorio Nacional</h3>
                <p>1,964,375 km² (14° más grande del mundo) + 200 millas marítimas</p>
                <div class="dato-neon">32 estados + CDMX</div>
            </div>
            <div class="contexto-card">
                <h3>👥 Población</h3>
                <p>130 millones de habitantes (10° más poblado) + 11.8M mexicanos en el exterior</p>
                <div class="dato-neon">Densidad: 66 hab/km²</div>
            </div>
            <div class="contexto-card">
                <h3>⚖️ Sistema de Gobierno</h3>
                <p>República Federal Presidencialista + División tripartita de poderes</p>
                <div class="dato-neon">PIB: $1.46 billones USD</div>
            </div>
        </div>
    </section>

    <!-- FUNDAMENTOS TEÓRICOS -->
    <section class="teoria-section">
        <div class="borde-neon-lateral"></div>
        <h2 class="seccion-titulo neon-concepto">
            <span class="icon">📚</span> FUNDAMENTOS TEÓRICOS
        </h2>
        
        <!-- DEFINICIÓN PRINCIPAL -->
        <div class="subseccion">
            <div class="definicion-principal">
                <div class="def-card">
                    <h4>🏛️ EL ESTADO SEGÚN MONTECIVIDEO</h4>
                    <p>Entidad política <strong>soberana</strong> que ejerce autoridad sobre un <strong>territorio definido</strong>, con <strong>población permanente</strong> y <strong>gobierno organizado</strong>.</p>
                    <div class="formula-inline">
                        \\[ \\text{Estado} = \\text{Territorio} + \\text{Población} + \\text{Gobierno} + \\text{Soberanía} \\]
                    </div>
                    <div class="referencia-legal">
                        <strong>Art. 1, Convención de Montevideo (1933):</strong> Reconocimiento internacional de estados
                    </div>
                </div>
            </div>
        </div>

        <!-- ELEMENTOS DEL ESTADO -->
        <div class="subseccion">
            <h3>1. Los Cuatro Elementos Constitutivos del Estado</h3>
            
            <div class="elementos-estado">
                <div class="elemento-estado-card" data-elemento="territorio">
                    <div class="elemento-estado-icon">🗺️</div>
                    <h4>TERRITORIO</h4>
                    <div class="elemento-estado-desc">
                        Espacio físico delimitado donde el Estado ejerce soberanía
                    </div>
                    <div class="elemento-estado-datos">
                        <div class="dato"><strong>Componentes:</strong> Tierra, mar, espacio aéreo, subsuelo</div>
                        <div class="dato"><strong>Fronteras:</strong> Límites reconocidos internacionalmente</div>
                        <div class="dato"><strong>México:</strong> 1.96M km² + ZEE de 3.15M km²</div>
                    </div>
                    <div class="elemento-estado-ejemplo">
                        <strong>Ejemplo:</strong> Disputa del Chamizal (México-EEUU, resuelta 1963)
                    </div>
                </div>
                
                <div class="elemento-estado-card" data-elemento="poblacion">
                    <div class="elemento-estado-icon">👥</div>
                    <h4>POBLACIÓN</h4>
                    <div class="elemento-estado-desc">
                        Conjunto de personas sujetas a la autoridad estatal
                    </div>
                    <div class="elemento-estado-datos">
                        <div class="dato"><strong>Ciudadanía:</strong> Vínculo jurídico-politico individuo-Estado</div>
                        <div class="dato"><strong>Derechos:</strong> Civiles, políticos, sociales</div>
                        <div class="dato"><strong>México:</strong> 130M hab. (52% mujeres, 48% hombres)</div>
                    </div>
                    <div class="elemento-estado-ejemplo">
                        <strong>Ejemplo:</strong> Censo 2020: 7.4M hablantes de lenguas indígenas
                    </div>
                </div>
                
                <div class="elemento-estado-card" data-elemento="gobierno">
                    <div class="elemento-estado-icon">⚖️</div>
                    <h4>GOBIERNO</h4>
                    <div class="elemento-estado-desc">
                        Conjunto de instituciones que ejercen el poder político
                    </div>
                    <div class="elemento-estado-datos">
                        <div class="dato"><strong>Formas:</strong> República, Monarquía, Dictadura</div>
                        <div class="dato"><strong>División poderes:</strong> Legislativo, Ejecutivo, Judicial</div>
                        <div class="dato"><strong>México:</strong> República Federal Presidencialista</div>
                    </div>
                    <div class="elemento-estado-ejemplo">
                        <strong>Ejemplo:</strong> Sistema político mexicano con elecciones cada 6 años
                    </div>
                </div>
                
                <div class="elemento-estado-card" data-elemento="soberania">
                    <div class="elemento-estado-icon">🏴</div>
                    <h4>SOBERANÍA</h4>
                    <div class="elemento-estado-desc">
                        Poder supremo e independiente en asuntos internos y externos
                    </div>
                    <div class="elemento-estado-datos">
                        <div class="dato"><strong>Interna:</strong> Autoridad sobre territorio y población</div>
                        <div class="dato"><strong>Externa:</strong> Independencia en relaciones internacionales</div>
                        <div class="dato"><strong>México:</strong> Miembro ONU, OEA, OCDE, T-MEC</div>
                    </div>
                    <div class="elemento-estado-ejemplo">
                        <strong>Ejemplo:</strong> Política exterior de no intervención (Doctrina Estrada)
                    </div>
                </div>
            </div>
        </div>

        <!-- FUNCIONES DEL ESTADO -->
        <div class="subseccion">
            <h3>2. Funciones Esenciales del Estado Moderno</h3>
            
            <div class="funciones-grid">
                <div class="funcion-card" data-funcion="reguladora">
                    <div class="funcion-icon">📜</div>
                    <h4>FUNCIÓN REGULADORA</h4>
                    <div class="funcion-desc">
                        Establece normas que rigen la convivencia social
                    </div>
                    <div class="funcion-detalle">
                        <p><strong>Legislativo:</strong> Crea leyes (Congreso de la Unión)</p>
                        <p><strong>Ejecutivo:</strong> Promulga y ejecuta leyes</p>
                        <p><strong>Judicial:</strong> Interpreta y aplica leyes</p>
                    </div>
                    <div class="funcion-ejemplo">
                        <strong>Ejemplo:</strong> Constitución Política (1917) + 200,000 leyes federales
                    </div>
                </div>
                
                <div class="funcion-card" data-funcion="provisora">
                    <div class="funcion-icon">🏥</div>
                    <h4>FUNCIÓN PROVISORA</h4>
                    <div class="funcion-desc">
                        Provee servicios públicos esenciales a la población
                    </div>
                    <div class="funcion-detalle">
                        <p><strong>Educación:</strong> SEP, 265,000 escuelas públicas</p>
                        <p><strong>Salud:</strong> IMSS, ISSSTE, INSABI</p>
                        <p><strong>Infraestructura:</strong> Carreteras, agua, energía</p>
                    </div>
                    <div class="funcion-ejemplo">
                        <strong>Ejemplo:</strong> Presupuesto educativo 2024: $15,000M USD
                    </div>
                </div>
                
                <div class="funcion-card" data-funcion="representativa">
                    <div class="funcion-icon">🌐</div>
                    <h4>FUNCIÓN REPRESENTATIVA</h4>
                    <div class="funcion-desc">
                        Representa a la nación en el ámbito internacional
                    </div>
                    <div class="funcion-detalle">
                        <p><strong>Diplomacia:</strong> 80 embajadas, 67 consulados</p>
                        <p><strong>Tratados:</strong> 2,500 tratados internacionales vigentes</p>
                        <p><strong>Organismos:</strong> ONU, OEA, APEC, Alianza del Pacífico</p>
                    </div>
                    <div class="funcion-ejemplo">
                        <strong>Ejemplo:</strong> Presidencia pro tempore CELAC 2020
                    </div>
                </div>
                
                <div class="funcion-card" data-funcion="garantizadora">
                    <div class="funcion-icon">🛡️</div>
                    <h4>FUNCIÓN GARANTIZADORA</h4>
                    <div class="funcion-desc">
                        Garantiza orden, seguridad y bienestar social
                    </div>
                    <div class="funcion-detalle">
                        <p><strong>Seguridad:</strong> Ejército, Marina, Policías</p>
                        <p><strong>Justicia:</strong> SCJN, Tribunales, MP</p>
                        <p><strong>Bienestar:</strong> Programas sociales, pensiones</p>
                    </div>
                    <div class="funcion-ejemplo">
                        <strong>Ejemplo:</strong> Guardia Nacional (2019) con 120,000 elementos
                    </div>
                </div>
            </div>
        </div>

        <!-- SEPARACIÓN DE PODERES -->
        <div class="subseccion">
            <h3>3. Separación de Poderes: El Modelo Tripartito</h3>
            <div class="principio-constitucional">
                <p><strong>Artículo 49 Constitucional:</strong> "El Supremo Poder de la Federación se divide, para su ejercicio, en Legislativo, Ejecutivo y Judicial."</p>
            </div>
            
            <div class="poderes-comparativa">
                <div class="poder-card" data-poder="legislativo">
                    <div class="poder-header">
                        <h4>📜 PODER LEGISLATIVO</h4>
                        <div class="poder-badge">Congreso de la Unión</div>
                    </div>
                    <div class="poder-caracteristicas">
                        <p><strong>Función:</strong> Crear, modificar y derogar leyes</p>
                        <p><strong>Órgano:</strong> Cámara de Diputados + Cámara de Senadores</p>
                        <p><strong>Integrantes:</strong> 500 diputados + 128 senadores</p>
                    </div>
                    <div class="poder-atribuciones">
                        <div class="atribucion-item">
                            <div class="atribucion-icon">💼</div>
                            <div class="atribucion-text">
                                <strong>Aprobar Presupuesto</strong><br>
                                Ley de Ingresos y Presupuesto de Egresos
                            </div>
                        </div>
                        <div class="atribucion-item">
                            <div class="atribucion-icon">🤝</div>
                            <div class="atribucion-text">
                                <strong>Ratificar Tratados</strong><br>
                                Acuerdos internacionales (Senado)
                            </div>
                        </div>
                        <div class="atribucion-item">
                            <div class="atribucion-icon">⚖️</div>
                            <div class="atribucion-text">
                                <strong>Fiscalizar al Ejecutivo</strong><br>
                                Comparecencias, investigaciones
                            </div>
                        </div>
                    </div>
                    <div class="poder-estadistica">
                        <span>Leyes aprobadas/año:</span>
                        <span class="stat-value">150-200</span>
                    </div>
                </div>
                
                <div class="poder-card" data-poder="ejecutivo">
                    <div class="poder-header">
                        <h4>🏛️ PODER EJECUTIVO</h4>
                        <div class="poder-badge">Presidencia de la República</div>
                    </div>
                    <div class="poder-caracteristicas">
                        <p><strong>Función:</strong> Dirigir la administración pública</p>
                        <p><strong>Órgano:</strong> Presidente + Secretarías de Estado</p>
                        <p><strong>Duración:</strong> 6 años (no reelección)</p>
                    </div>
                    <div class="poder-atribuciones">
                        <div class="atribucion-item">
                            <div class="atribucion-icon">🎖️</div>
                            <div class="atribucion-text">
                                <strong>Comandante Supremo</strong><br>
                                Fuerzas Armadas (Ejército, Marina, Fuerza Aérea)
                            </div>
                        </div>
                        <div class="atribucion-item">
                            <div class="atribucion-icon">💵</div>
                            <div class="atribucion-text">
                                <strong>Ejecutar Presupuesto</strong><br>
                                19 secretarías + organismos descentralizados
                            </div>
                        </div>
                        <div class="atribucion-item">
                            <div class="atribucion-icon">🌍</div>
                            <div class="atribucion-text">
                                <strong>Política Exterior</strong><br>
                                Representación internacional, tratados
                            </div>
                        </div>
                    </div>
                    <div class="poder-estadistica">
                        <span>Presupuesto 2024:</span>
                        <span class="stat-value">$8.9 billones MXN</span>
                    </div>
                </div>
                
                <div class="poder-card" data-poder="judicial">
                    <div class="poder-header">
                        <h4>⚖️ PODER JUDICIAL</h4>
                        <div class="poder-badge">Suprema Corte de Justicia</div>
                    </div>
                    <div class="poder-caracteristicas">
                        <p><strong>Función:</strong> Administrar justicia e interpretar leyes</p>
                        <p><strong>Órgano:</strong> SCJN + Tribunales Federales + Locales</p>
                        <p><strong>Integrantes:</strong> 11 ministros (designados por Senado)</p>
                    </div>
                    <div class="poder-atribuciones">
                        <div class="atribucion-item">
                            <div class="atribucion-icon">🧑‍⚖️</div>
                            <div class="atribucion-text">
                                <strong>Control Constitucional</strong><br>
                                Juicios de amparo, controversias constitucionales
                            </div>
                        </div>
                        <div class="atribucion-item">
                            <div class="atribucion-icon">📋</div>
                            <div class="atribucion-text">
                                <strong>Interpretar Leyes</strong><br>
                                Jurisprudencia, tesis aisladas
                            </div>
                        </div>
                        <div class="atribucion-item">
                            <div class="atribucion-icon">⚖️</div>
                            <div class="atribucion-text">
                                <strong>Impartir Justicia</strong><br>
                                Resolver conflictos entre particulares y Estado
                            </div>
                        </div>
                    </div>
                    <div class="poder-estadistica">
                        <span>Amparos resueltos/año:</span>
                        <span class="stat-value">~250,000</span>
                    </div>
                </div>
            </div>
            
            <div class="checks-balances">
                <h4>🔄 SISTEMA DE CONTROLES Y EQUILIBRIOS (CHECKS AND BALANCES)</h4>
                <div class="checks-content">
                    <div class="check-item">
                        <div class="check-icon">↔️</div>
                        <div class="check-text">
                            <strong>Ejecutivo → Legislativo:</strong> Veto presidencial a leyes
                        </div>
                    </div>
                    <div class="check-item">
                        <div class="check-icon">↔️</div>
                        <div class="check-text">
                            <strong>Legislativo → Ejecutivo:</strong> Juicio político, aprobación presupuesto
                        </div>
                    </div>
                    <div class="check-item">
                        <div class="check-icon">↔️</div>
                        <div class="check-text">
                            <strong>Judicial → Ambos:</strong> Declarar inconstitucionalidad de leyes y actos
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SIMULADOR INTERACTIVO -->
    <section class="simulator-section">
        <h2 class="seccion-titulo neon-interactivo">
            <span class="icon">🔄</span> SIMULADOR: ESTRUCTURA DEL ESTADO MEXICANO
        </h2>
        
        <div class="simulator-container" data-tema="estructura-estado">
            <!-- PANEL DE CONTROLES -->
            <div class="simulator-controls">
                <h3>CONTROLES DE ANÁLISIS</h3>
                
                <div class="control-group">
                    <label for="poderSelect">Poder a analizar:</label>
                    <select id="poderSelect" class="control-select">
                        <option value="todos">Todos los poderes</option>
                        <option value="legislativo">Poder Legislativo</option>
                        <option value="ejecutivo">Poder Ejecutivo</option>
                        <option value="judicial">Poder Judicial</option>
                        <option value="federalismo">Sistema Federal</option>
                    </select>
                </div>
                
                <div class="control-group">
                    <label for="nivelGobierno">Nivel de gobierno:</label>
                    <select id="nivelGobierno" class="control-select">
                        <option value="federal">Federal</option>
                        <option value="estatal">Estatal (32 entidades)</option>
                        <option value="municipal">Municipal (2,463 municipios)</option>
                    </select>
                </div>
                
                <div class="control-group">
                    <label>Mostrar detalles:</label>
                    <div class="checkbox-group">
                        <label><input type="checkbox" name="detalles" value="atribuciones" checked> Atribuciones</label>
                        <label><input type="checkbox" name="detalles" value="organigrama"> Organigrama</label>
                        <label><input type="checkbox" name="detalles" value="presupuesto"> Presupuesto</label>
                        <label><input type="checkbox" name="detalles" value="funcionarios"> Funcionarios</label>
                    </div>
                </div>
                
                <button class="btn-clasificar" onclick="analizarEstructura()">
                    <span class="btn-icon">🔍</span> ANALIZAR ESTRUCTURA
                </button>
                
                <button class="btn-aleatorio" onclick="poderAleatorio()">
                    <span class="btn-icon">🎲</span> PODER ALEATORIO
                </button>
                
                <button class="btn-reset" onclick="reiniciarAnalisis()">
                    <span class="btn-icon">🔄</span> REINICIAR
                </button>
            </div>
            
            <!-- VISUALIZACIÓN DE LA ESTRUCTURA -->
            <div class="simulator-visualization" id="visualizacionEstado">
                <div class="estructura-container">
                    <svg viewBox="0 0 600 500" id="svgEstado">
                        <!-- Fondo -->
                        <rect x="0" y="0" width="600" height="500" fill="#0a0a1a" id="fondoEstado"/>
                        
                        <!-- ESTADO MEXICANO -->
                        <g id="nodoEstado">
                            <ellipse cx="300" cy="80" rx="180" ry="40" fill="#43A047" opacity="0.8"/>
                            <text x="300" y="75" fill="white" text-anchor="middle" font-size="16">ESTADO MEXICANO</text>
                            <text x="300" y="95" fill="#C8E6C9" text-anchor="middle" font-size="10">República Federal Presidencialista</text>
                        </g>
                        
                        <!-- PODER LEGISLATIVO -->
                        <g id="nodoLegislativo" opacity="0.7">
                            <rect x="50" y="150" width="150" height="70" rx="8" fill="#1976D2"/>
                            <text x="125" y="175" fill="white" text-anchor="middle" font-size="12">LEGISLATIVO</text>
                            <text x="125" y="195" fill="#BBDEFB" text-anchor="middle" font-size="9">Congreso de la Unión</text>
                        </g>
                        
                        <!-- PODER EJECUTIVO -->
                        <g id="nodoEjecutivo" opacity="0.7">
                            <rect x="225" y="150" width="150" height="70" rx="8" fill="#D32F2F"/>
                            <text x="300" y="175" fill="white" text-anchor="middle" font-size="12">EJECUTIVO</text>
                            <text x="300" y="195" fill="#FFCDD2" text-anchor="middle" font-size="9">Presidencia</text>
                        </g>
                        
                        <!-- PODER JUDICIAL -->
                        <g id="nodoJudicial" opacity="0.7">
                            <rect x="400" y="150" width="150" height="70" rx="8" fill="#7B1FA2"/>
                            <text x="475" y="175" fill="white" text-anchor="middle" font-size="12">JUDICIAL</text>
                            <text x="475" y="195" fill="#E1BEE7" text-anchor="middle" font-size="9">Suprema Corte</text>
                        </g>
                        
                        <!-- CONEXIONES -->
                        <path id="conexionEstadoLegislativo" d="M300 120 Q300 140 125 150" stroke="#43A047" stroke-width="2" fill="none"/>
                        <path id="conexionEstadoEjecutivo" d="M300 120 Q300 140 300 150" stroke="#43A047" stroke-width="2" fill="none"/>
                        <path id="conexionEstadoJudicial" d="M300 120 Q300 140 475 150" stroke="#43A047" stroke-width="2" fill="none"/>
                        
                        <!-- SISTEMA FEDERAL -->
                        <g id="nodoFederalismo" opacity="0.7">
                            <rect x="150" y="250" width="300" height="60" rx="8" fill="#FF9800"/>
                            <text x="300" y="275" fill="white" text-anchor="middle" font-size="12">SISTEMA FEDERAL</text>
                            <text x="300" y="295" fill="#FFECB3" text-anchor="middle" font-size="9">32 estados + CDMX</text>
                        </g>
                        
                        <!-- MUNICIPIOS -->
                        <g id="nodoMunicipios" opacity="0.7">
                            <rect x="200" y="340" width="200" height="50" rx="8" fill="#0097A7"/>
                            <text x="300" y="360" fill="white" text-anchor="middle" font-size="11">2,463 MUNICIPIOS</text>
                            <text x="300" y="375" fill="#B2EBF2" text-anchor="middle" font-size="8">Gobiernos locales</text>
                        </g>
                        
                        <!-- CONEXIONES VERTICALES -->
                        <line x1="125" y1="220" x2="125" y2="250" stroke="#1976D2" stroke-width="2"/>
                        <line x1="300" y1="220" x2="300" y2="250" stroke="#D32F2F" stroke-width="2"/>
                        <line x1="475" y1="220" x2="475" y2="250" stroke="#7B1FA2" stroke-width="2"/>
                        <line x1="300" y1="310" x2="300" y2="340" stroke="#FF9800" stroke-width="2"/>
                        
                        <!-- PODER SELECCIONADO -->
                        <g id="poderSeleccionado" opacity="0">
                            <rect x="200" y="420" width="200" height="50" rx="10" fill="#9C27B0"/>
                            <text x="300" y="445" fill="white" text-anchor="middle" font-size="12" id="textoPoder">PODER</text>
                            <text x="300" y="460" fill="#F3E5F5" text-anchor="middle" font-size="9" id="textoDetallePoder">Detalles</text>
                        </g>
                    </svg>
                </div>
                <div class="estructura-info" id="infoEstado">
                    Selecciona un poder y haz clic en "ANALIZAR ESTRUCTURA"
                </div>
            </div>
            
            <!-- DATOS DE ANÁLISIS -->
            <div class="simulator-data">
                <h3>DATOS INSTITUCIONALES</h3>
                
                <div class="data-card">
                    <div class="data-label">Poder analizado:</div>
                    <div class="data-value" id="dataPoder">-</div>
                </div>
                
                <div class="data-card">
                    <div class="data-label">Órgano principal:</div>
                    <div class="data-value" id="dataOrgano">-</div>
                </div>
                
                <div class="data-card">
                    <div class="data-label">Funcionarios:</div>
                    <div class="data-value" id="dataFuncionarios">-</div>
                </div>
                
                <div class="data-card highlight">
                    <div class="data-label">PRESUPUESTO 2024:</div>
                    <div class="data-value" id="dataPresupuesto">-</div>
                </div>
                
                <div class="data-card">
                    <div class="data-label">Atribuciones clave:</div>
                    <div class="data-value" id="dataAtribuciones">-</div>
                </div>
                
                <div class="data-card">
                    <div class="data-label">Control sobre otros poderes:</div>
                    <div class="data-value" id="dataControles">-</div>
                </div>
                
                <div class="estadisticas">
                    <h4>📊 ESTADÍSTICAS DEL ESTADO MEXICANO</h4>
                    <div class="stat-item">
                        <span>Países reconocidos por ONU:</span>
                        <span class="stat-value">193</span>
                    </div>
                    <div class="stat-item">
                        <span>Tratados internacionales:</span>
                        <span class="stat-value">2,500+</span>
                    </div>
                    <div class="stat-item">
                        <span>Servidores públicos federales:</span>
                        <span class="stat-value">1.2M</span>
                    </div>
                    <div class="stat-item">
                        <span>Presupuesto federal 2024:</span>
                        <span class="stat-value">$8.9 billones</span>
                    </div>
                    <div class="stat-item">
                        <span>Leyes federales vigentes:</span>
                        <span class="stat-value">200,000+</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- EJEMPLO COMPARATIVO: FORMAS DE GOBIERNO -->
    <section class="ejemplo-comparativo">
        <h2 class="seccion-titulo neon-ejemplo">
            <span class="icon">🔍</span> ANÁLISIS COMPARATIVO: FORMAS DE GOBIERNO
        </h2>
        
        <div class="comparativo-container">
            <div class="forma-gobierno" data-forma="republica">
                <div class="forma-header">
                    <h4>🏛️ REPÚBLICA FEDERAL PRESIDENCIALISTA (MÉXICO)</h4>
                </div>
                <div class="forma-content">
                    <div class="forma-caracteristicas">
                        <p><strong>Jefe de Estado:</strong> Presidente elegido popularmente</p>
                        <p><strong>División territorial:</strong> Federal (32 estados autónomos)</p>
                        <p><strong>Separación de poderes:</strong> Estricta (Art. 49)</p>
                        <p><strong>Elecciones:</strong> Cada 6 años (presidente), 3 años (diputados)</p>
                    </div>
                    <div class="forma-ventajas">
                        <h5>✅ Ventajas:</h5>
                        <ul>
                            <li>Representación directa del pueblo</li>
                            <li>Equilibrio entre unidad nacional y autonomía local</li>
                            <li>Mayor estabilidad del ejecutivo</li>
                        </ul>
                    </div>
                    <div class="forma-desventajas">
                        <h5>⚠️ Desafíos:</h5>
                        <ul>
                            <li>Riesgo de concentración de poder</li>
                            <li>Posibles conflictos federación-estados</li>
                            <li>Rigidez en períodos fijos</li>
                        </ul>
                    </div>
                    <div class="forma-ejemplos">
                        <strong>Otros ejemplos:</strong> Estados Unidos, Brasil, Argentina
                    </div>
                </div>
            </div>
            
            <div class="forma-gobierno" data-forma="monarquia">
                <div class="forma-header">
                    <h4>👑 MONARQUÍA CONSTITUCIONAL PARLAMENTARIA (ESPAÑA)</h4>
                </div>
                <div class="forma-content">
                    <div class="forma-caracteristicas">
                        <p><strong>Jefe de Estado:</strong> Rey (hereditario, vitalicio)</p>
                        <p><strong>División territorial:</strong> Estado autonómico (17 comunidades)</p>
                        <p><strong>Separación de poderes:</strong> Parlamentaria (ejecutivo surge del legislativo)</p>
                        <p><strong>Elecciones:</strong> Cada 4 años (Cortes Generales)</p>
                    </div>
                    <div class="forma-ventajas">
                        <h5>✅ Ventajas:</h5>
                        <ul>
                            <li>Continuidad y estabilidad institucional</li>
                            <li>Jefe de Estado apolítico</li>
                            <li>Mayor flexibilidad política</li>
                        </ul>
                    </div>
                    <div class="forma-desventajas">
                        <h5>⚠️ Desafíos:</h5>
                        <ul>
                            <li>Legitimidad democrática cuestionada</li>
                            <li>Costo de la familia real</li>
                            <li>Posible crisis de sucesión</li>
                        </ul>
                    </div>
                    <div class="forma-ejemplos">
                        <strong>Otros ejemplos:</strong> Reino Unido, Japón, Suecia
                    </div>
                </div>
            </div>
            
            <div class="forma-gobierno" data-forma="parlamentaria">
                <div class="forma-header">
                    <h4>🏛️ REPÚBLICA PARLAMENTARIA (ALEMANIA)</h4>
                </div>
                <div class="forma-content">
                    <div class="forma-caracteristicas">
                        <p><strong>Jefe de Estado:</strong> Presidente (electo indirectamente)</p>
                        <p><strong>División territorial:</strong> Federal (16 Länder)</p>
                        <p><strong>Separación de poderes:</strong> Ejecutivo depende del legislativo</p>
                        <p><strong>Elecciones:</strong> Cada 4 años (Bundestag)</p>
                    </div>
                    <div class="forma-ventajas">
                        <h5>✅ Ventajas:</h5>
                        <ul>
                            <li>Mayor cooperación entre poderes</li>
                            <li>Gobierno de coalición más común</li>
                            <li>Facilidad para cambiar gobierno sin elecciones</li>
                        </ul>
                    </div>
                    <div class="forma-desventajas">
                        <h5>⚠️ Desafíos:</h5>
                        <ul>
                            <li>Inestabilidad potencial de gobierno</li>
                            <li>Menor claridad en responsabilidades</li>
                            <li>Poder ejecutivo más débil</li>
                        </ul>
                    </div>
                    <div class="forma-ejemplos">
                        <strong>Otros ejemplos:</strong> Italia, India, Israel
                    </div>
                </div>
            </div>
        </div>
        
        <div class="conclusion-comparativa">
            <h4>📋 CONCLUSIÓN COMPARATIVA</h4>
            <p>No existe un sistema de gobierno "perfecto". Cada modelo refleja la historia, cultura y necesidades específicas de cada nación. México optó por el <strong>presidencialismo federal</strong> para balancear unidad nacional con autonomía regional, mientras que España privilegia <strong>continuidad monárquica</strong> y Alemania la <strong>estabilidad parlamentaria</strong>.</p>
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
                    <h3>¿Qué elemento del Estado se refiere al espacio físico delimitado?</h3>
                </div>
                
                <div class="quiz-options">
                    <button class="quiz-option" data-value="A">
                        <span class="option-letter">A</span>
                        Población
                    </button>
                    <button class="quiz-option" data-value="B">
                        <span class="option-letter">B</span>
                        Territorio
                    </button>
                    <button class="quiz-option" data-value="C">
                        <span class="option-letter">C</span>
                        Gobierno
                    </button>
                    <button class="quiz-option" data-value="D">
                        <span class="option-letter">D</span>
                        Soberanía
                    </button>
                </div>
                
                <div class="quiz-feedback" style="display: none;">
                    <div class="feedback-correct">
                        ✅ <strong>Correcto:</strong> El territorio es el espacio físico donde el Estado ejerce soberanía.
                    </div>
                    <div class="feedback-incorrect">
                        ❌ <strong>Incorrecto:</strong> Revisa los cuatro elementos constitutivos del Estado.
                    </div>
                    <div class="feedback-explicacion">
                        <p><strong>Explicación:</strong> Según la Convención de Montevideo (1933), el Estado requiere: 1) Territorio definido, 2) Población permanente, 3) Gobierno organizado, 4) Capacidad de relacionarse con otros Estados (soberanía). México tiene 1.96M km² de territorio.</p>
                    </div>
                </div>
            </div>
            
            <!-- PREGUNTA 2 -->
            <div class="quiz-question" data-correct="C">
                <div class="quiz-header">
                    <span class="quiz-num">02</span>
                    <h3>¿Qué artículo constitucional establece la separación de poderes en México?</h3>
                </div>
                
                <div class="quiz-options">
                    <button class="quiz-option" data-value="A">
                        <span class="option-letter">A</span>
                        Artículo 27
                    </button>
                    <button class="quiz-option" data-value="B">
                        <span class="option-letter">B</span>
                        Artículo 39
                    </button>
                    <button class="quiz-option" data-value="C">
                        <span class="option-letter">C</span>
                        Artículo 49
                    </button>
                    <button class="quiz-option" data-value="D">
                        <span class="option-letter">D</span>
                        Artículo 123
                    </button>
                </div>
                
                <div class="quiz-feedback" style="display: none;">
                    <div class="feedback-correct">
                        ✅ <strong>Correcto:</strong> El Artículo 49 establece la división tripartita del poder.
                    </div>
                    <div class="feedback-incorrect">
                        ❌ <strong>Incorrecto:</strong> Revisa los artículos fundamentales de la organización política.
                    </div>
                    <div class="feedback-explicacion">
                        <p><strong>Texto constitucional:</strong> Art. 49: "El Supremo Poder de la Federación se divide, para su ejercicio, en Legislativo, Ejecutivo y Judicial. No podrán reunirse dos o más de estos Poderes en una sola persona o corporación..."</p>
                    </div>
                </div>
            </div>
            
            <!-- PREGUNTA 3 -->
            <div class="quiz-question" data-correct="D">
                <div class="quiz-header">
                    <span class="quiz-num">03</span>
                    <h3>¿Cuál es la principal función del Poder Judicial?</h3>
                </div>
                
                <div class="quiz-options">
                    <button class="quiz-option" data-value="A">
                        <span class="option-letter">A</span>
                        Crear nuevas leyes
                    </button>
                    <button class="quiz-option" data-value="B">
                        <span class="option-letter">B</span>
                        Dirigir la política exterior
                    </button>
                    <button class="quiz-option" data-value="C">
                        <span class="option-letter">C</span>
                        Ejecutar el presupuesto nacional
                    </button>
                    <button class="quiz-option" data-value="D">
                        <span class="option-letter">D</span>
                        Administrar justicia e interpretar leyes
                    </button>
                </div>
                
                <div class="quiz-feedback" style="display: none;">
                    <div class="feedback-correct">
                        ✅ <strong>Correcto:</strong> El Poder Judicial interpreta y aplica las leyes.
                    </div>
                    <div class="feedback-incorrect">
                        ❌ <strong>Incorrecto:</strong> Cada poder tiene funciones específicas que no deben confundirse.
                    </div>
                    <div class="feedback-explicacion">
                        <p><strong>División de funciones:</strong> Legislativo: crea leyes; Ejecutivo: ejecuta leyes y administra; Judicial: interpreta leyes y administra justicia. La Suprema Corte (11 ministros) es el máximo órgano judicial.</p>
                    </div>
                </div>
            </div>
        </div>
        
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
    </section>

    <!-- ERRORES COMUNES -->
    <section class="errores-section">
        <h2 class="seccion-titulo neon-alerta">
            <span class="icon">⚠️</span> ERRORES COMUNES Y SOLUCIONES
        </h2>
        
        <div class="errores-container">
            <div class="error-card">
                <div class="error-header" onclick="toggleError(this)">
                    <h3>❌ CONFUNDIR ESTADO, GOBIERNO Y NACIÓN</h3>
                    <span class="error-toggle">+</span>
                </div>
                <div class="error-content">
                    <div class="error-ejemplo">
                        <strong>Error común:</strong> "El Estado es lo mismo que el gobierno actual"
                    </div>
                    <div class="error-correccion">
                        <strong>Corrección:</strong> El Estado es la estructura permanente; el gobierno es su administración temporal; la nación es la comunidad cultural.
                        \\[
                        \\begin{aligned}
                        \\text{Estado} &= \\text{Estructura política permanente} \\\\
                        \\text{Gobierno} &= \\text{Administración temporal (cambia)} \\\\
                        \\text{Nación} &= \\text{Comunidad cultural/histórica}
                        \\end{aligned}
                        \\]
                    </div>
                    <div class="error-practica">
                        <p><strong>Practica:</strong> Clasifica: 1) "México tiene 130 millones de habitantes", 2) "El presidente actual gobierna desde 2018", 3) "Los mexicanos comparten historia y cultura"</p>
                        <button class="btn-mini" onclick="mostrarSolucion(1)">Ver solución</button>
                        <div class="solucion" id="solucion1" style="display: none;">
                            <strong>1) México tiene 130M hab:</strong> ESTADO (elemento población)<br>
                            <strong>2) Presidente gobierna desde 2018:</strong> GOBIERNO (administración temporal)<br>
                            <strong>3) Mexicanos comparten cultura:</strong> NACIÓN (comunidad cultural)
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="error-card">
                <div class="error-header" onclick="toggleError(this)">
                    <h3>❌ MALENTENDER LA SEPARACIÓN DE PODERES</h3>
                    <span class="error-toggle">+</span>
                </div>
                <div class="error-content">
                    <div class="error-ejemplo">
                        <strong>Error común:</strong> "La separación de poderes significa que no se relacionan"
                    </div>
                    <div class="error-correccion">
                        <strong>Corrección:</strong> Es "separación" pero con "colaboración y control mutuo" (checks and balances):
                        <ul>
                            <li><strong>Separación orgánica:</strong> Diferentes instituciones</li>
                            <li><strong>Separación funcional:</strong> Diferentes funciones</li>
                            <li><strong>Colaboración:</strong> Trabajan conjuntamente</li>
                            <li><strong>Control mutuo:</strong> Se limitan entre sí</li>
                        </ul>
                    </div>
                    <div class="error-tabla">
                        <table>
                            <tr><th>Poder</th><th>Controla a...</th><th>Medio de control</th></tr>
                            <tr><td>Legislativo</td><td>Ejecutivo</td><td>Aprobación presupuesto, juicio político</td></tr>
                            <tr><td>Ejecutivo</td><td>Legislativo</td><td>Veto a leyes, iniciativa preferente</td></tr>
                            <tr><td>Judicial</td><td>Ambos</td><td>Declarar inconstitucionalidad</td></tr>
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
                    <h3>Análisis de Elementos del Estado</h3>
                </div>
                <div class="problema-enunciado">
                    <p>Analiza el caso de <strong>Taiwán (República de China)</strong> aplicando los cuatro elementos del Estado según la Convención de Montevideo:</p>
                    <ul>
                        <li><strong>Territorio:</strong> Isla de Taiwán + islas menores (36,193 km²)</li>
                        <li><strong>Población:</strong> 23.6 millones de habitantes</li>
                        <li><strong>Gobierno:</strong> República semipresidencialista con elecciones democráticas</li>
                        <li><strong>Soberanía:</strong> Reconocido por 13 países, no es miembro de ONU</li>
                    </ul>
                    <p>¿Consideras que Taiwán cumple con todos los elementos para ser considerado un Estado según el derecho internacional? Justifica tu respuesta indicando:</p>
                    <ol>
                        <li>Qué elementos cumple plenamente</li>
                        <li>Qué elementos presenta controversia</li>
                        <li>Cómo afecta el principio de "Una sola China"</li>
                        <li>Ejemplos de casos similares en la historia</li>
                    </ol>
                </div>
                <div class="problema-espacio">
                    <textarea placeholder="Escribe tu análisis jurídico-político aquí..." rows="10"></textarea>
                </div>
                <button class="btn-verificar" onclick="verificarProblema(1)">VERIFICAR SOLUCIÓN</button>
                <div class="problema-solucion" id="solucionP1" style="display: none;">
                    <strong>Análisis modelo:</strong><br><br>
                    <strong>1. Elementos cumplidos:</strong><br>
                    • Territorio: Sí (delimitado y controlado efectivamente)<br>
                    • Población: Sí (permanente y organizada)<br>
                    • Gobierno: Sí (organizado, elecciones democráticas desde 1996)<br><br>
                    
                    <strong>2. Elemento controversial:</strong><br>
                    • Soberanía: Parcial. Tiene capacidad de relaciones internacionales limitadas (13 reconocimientos vs 181 de China). No es miembro de ONU.<br><br>
                    
                    <strong>3. Principio "Una sola China":</strong><br>
                    • 1971: ONU reconoce a República Popular China como legítima representante<br>
                    • La mayoría de países mantienen relaciones con Pekín, no con Taiwán<br>
                    • Estatus político: "Entidad separada" no Estado soberano<br><br>
                    
                    <strong>4. Casos similares:</strong><br>
                    • Kosovo: Reconocido por 101 países pero no por ONU<br>
                    • Sahara Occidental: Reconocido por 84 países, ocupado por Marruecos<br>
                    • Palestina: Estado observador en ONU desde 2012<br><br>
                    
                    <strong>Conclusión:</strong> Taiwán cumple elementos materiales pero carece de reconocimiento soberano pleno, siendo un "Estado de facto" pero no "de jure" según mayoría de comunidad internacional.
                </div>
            </div>
            
            <div class="problema-card">
                <div class="problema-header">
                    <span class="problema-num">P2</span>
                    <h3>Diseño de Reforma Institucional</h3>
                </div>
                <div class="problema-enunciado">
                    <p>Diseña una propuesta de reforma al <strong>sistema de separación de poderes en México</strong> para fortalecer los controles mutuos entre ellos:</p>
                    <p>Tu propuesta debe incluir para cada poder:</p>
                    <ol>
                        <li>Fortalezas actuales que deben conservarse</li>
                        <li>Debilidades que deben corregirse</li>
                        <li>Propuestas concretas de mejora</li>
                        <li>Mecanismos de implementación</li>
                    </ol>
                    <p>Considera especialmente:</p>
                    <ul>
                        <li>Equilibrio entre eficiencia y control</li>
                        <li>Experiencias comparadas (otros países)</li>
                        <li>Viabilidad política y constitucional</li>
                        <li>Impacto en la calidad democrática</li>
                    </ul>
                </div>
                <div class="problema-espacio">
                    <textarea placeholder="Describe tu propuesta de reforma institucional..." rows="10"></textarea>
                </div>
                <button class="btn-verificar" onclick="verificarProblema(2)">VERIFICAR PROCEDIMIENTO</button>
                <div class="problema-solucion" id="solucionP2" style="display: none;">
                    <strong>Propuesta de reforma modelo:</strong><br><br>
                    <strong>1. Poder Ejecutivo (fortalecer controles):</strong><br>
                    • <em>Debilidad actual:</em> Concentración excesiva de poder presidencial<br>
                    • <em>Propuesta:</em> Establecer gabinete parlamentario (ministros requieren aval legislativo)<br>
                    • <em>Mecanismo:</em> Reforma Art. 89 constitucional<br><br>
                    
                    <strong>2. Poder Legislativo (mejorar eficiencia):</strong><br>
                    • <em>Debilidad actual:</em> Excesivo número de partidos, bloqueos frecuentes<br>
                    • <em>Propuesta:</em> Umbral electoral más alto (5% a 7%) + segunda vuelta legislativa<br>
                    • <em>Mecanismo:</em> Reforma electoral + reglamentos internos<br><br>
                    
                    <strong>3. Poder Judicial (fortalecer independencia):</strong><br>
                    • <em>Debilidad actual:</em> Designación politizada de ministros<br>
                    • <em>Propuesta:</em> Comisiones ciudadanas para evaluar candidatos<br>
                    • <em>Mecanismo:</em> Ley orgánica del Poder Judicial<br><br>
                    
                    <strong>4. Mecanismos transversales:</strong><br>
                    • <em>Auditoría superior:</em> Autonomía constitucional plena<br>
                    • <em>Rendición de cuentas:</strong> Comparecencias obligatorias trimestrales<br>
                    • <em>Participación ciudadana:</em> Iniciativa popular con 500,000 firmas<br><br>
                    
                    <strong>Experiencia comparada:</strong> Modelo alemán (gabinete parlamentario), francés (segunda vuelta), español (Consejo General del Poder Judicial autónomo).<br><br>
                    
                    <strong>Viabilidad:</strong> Requeriría reforma constitucional (2/3 del Congreso + mayoría estatales), proceso de 2-3 años.
                </div>
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
                    <td>Comprensión elementos Estado</td>
                    <td>Analiza correctamente los 4 elementos con ejemplos precisos</td>
                    <td>Identifica mayoría de elementos con algún error</td>
                    <td>Confunde elementos u omite alguno esencial</td>
                </tr>
                <tr>
                    <td>Análisis casos complejos</td>
                    <td>Evalúa matices y contradicciones en casos controversiales</td>
                    <td>Identifica aspectos principales del caso</td>
                    <td>Análisis superficial o incorrecto</td>
                </tr>
                <tr>
                    <td>Propuestas de reforma</td>
                    <td>Propone reformas viables, fundamentadas y con mecanismos claros</td>
                    <td>Sugiere reformas generales sin mecanismos específicos</td>
                    <td>Propuestas inviables o contradictorias</td>
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
                    <label>Comprensión elementos del Estado:</label>
                    <input type="range" min="1" max="5" value="3" class="autoeval-slider" id="slider1">
                    <div class="slider-labels">
                        <span>Básico</span><span>Intermedio</span><span>Avanzado</span>
                    </div>
                </div>
                
                <div class="slider-group">
                    <label>Análisis separación de poderes:</label>
                    <input type="range" min="1" max="5" value="3" class="autoeval-slider" id="slider2">
                    <div class="slider-labels">
                        <span>Básico</span><span>Intermedio</span><span>Avanzado</span>
                    </div>
                </div>
                
                <div class="slider-group">
                    <label>Comparación formas de gobierno:</label>
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
                <h3>💭 REFLEXIÓN GUIADA</h3>
                <div class="pregunta-reflexion">
                    <p>¿Por qué es importante la separación de poderes en una democracia? ¿Qué pasaría si un solo poder controlara todo?</p>
                    <textarea placeholder="Escribe tu reflexión aquí..." rows="4" id="reflexion1"></textarea>
                </div>
                <div class="pregunta-reflexion">
                    <p>Compara el sistema presidencial mexicano con otra forma de gobierno. ¿Qué ventajas y desventajas ves en cada uno?</p>
                    <textarea placeholder="Escribe tu comparación..." rows="4" id="reflexion2"></textarea>
                </div>
            </div>
        </div>
        
        <div class="plan-estudio">
            <h3>📅 PLAN DE ESTUDIO RECOMENDADO</h3>
            <div class="plan-grid">
                <div class="plan-card">
                    <h4>🔄 REPASO RÁPIDO (15 min)</h4>
                    <ul>
                        <li>Memorizar 4 elementos del Estado (Convención Montevideo)</li>
                        <li>Recordar 3 poderes y sus funciones (Art. 49)</li>
                        <li>Diferenciar Estado, gobierno y nación</li>
                    </ul>
                </div>
                <div class="plan-card">
                    <h4>💪 PRÁCTICA (30 min)</h4>
                    <ul>
                        <li>Analizar 5 casos de estados controversiales</li>
                    <li>Completar el simulador con diferentes poderes</li>
                        <li>Resolver el quiz interactivo</li>
                    </ul>
                </div>
                <div class="plan-card">
                    <h4>🚀 PROFUNDIZACIÓN (45 min)</h4>
                    <ul>
                        <li>Investigar casos de separación de poderes en otros países</li>
                        <li>Analizar reformas políticas recientes en México</li>
                        <li>Diseñar propuestas de mejora institucional</li>
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="recursos">
            <h3>🔗 RECURSOS ADICIONALES</h3>
            <div class="recursos-links">
                <a href="https://www.diputados.gob.mx/LeyesBiblio/" target="_blank" class="recurso-link">
                    📜 Cámara de Diputados: Leyes y Constitución
                </a>
                <a href="https://www.scjn.gob.mx/" target="_blank" class="recurso-link">
                    ⚖️ Suprema Corte: Jurisprudencia y sentencias
                </a>
                <a href="https://www.gob.mx/" target="_blank" class="recurso-link">
                    🏛️ Portal de Gobierno: Transparencia y servicios
                </a>
                <a href="https://es.khanacademy.org/humanities/us-government-and-civics" target="_blank" class="recurso-link">
                    🎓 Khan Academy: Gobierno y civismo
                </a>
                <a href="https://www.economist.com/democracy-index" target="_blank" class="recurso-link">
                    📊 The Economist: Índice de Democracia 2023
                </a>
            </div>
        </div>
    </section>

    <!-- JAVASCRIPT INTEGRADO -->
    <script>
    // ========================================
    // SISTEMA DE ANÁLISIS DEL ESTADO
    // ========================================
    
    // Base de datos de poderes y estructuras
    const estructurasDB = {
        "legislativo": {
            nombre: "Poder Legislativo",
            organo: "Congreso de la Unión",
            funcionarios: "628 (500 diputados + 128 senadores)",
            presupuesto: "$14,500M MXN (2024)",
            atribuciones: "Crear leyes, aprobar presupuesto, ratificar tratados",
            controles: "Juicio político, comparecencias, aprobación presupuesto",
            color: "#1976D2",
            detalles: "Bicameral: Cámara de Diputados (3 años) y Senado (6 años)"
        },
        "ejecutivo": {
            nombre: "Poder Ejecutivo",
            organo: "Presidencia de la República",
            funcionarios: "1.2M servidores públicos federales",
            presupuesto: "$8.9 billones MXN (presupuesto federal)",
            atribuciones: "Administración pública, política exterior, seguridad",
            controles: "Veto legislativo, designación funcionarios, mando militar",
            color: "#D32F2F",
            detalles: "19 secretarías de Estado + organismos descentralizados"
        },
        "judicial": {
            nombre: "Poder Judicial",
            organo: "Suprema Corte de Justicia",
            funcionarios: "11 ministros + 90,000 empleados judiciales",
            presupuesto: "$45,000M MXN (sistema judicial completo)",
            atribuciones: "Impartir justicia, interpretar leyes, control constitucional",
            controles: "Declarar inconstitucionalidad, amparo, controversias",
            color: "#7B1FA2",
            detalles: "SCJN (11 ministros) + tribunales federales + locales"
        },
        "federalismo": {
            nombre: "Sistema Federal",
            organo: "32 entidades federativas",
            funcionarios: "Gobernadores + legislativos locales",
            presupuesto: "$2.1 billones MXN (presupuestos estatales)",
            atribuciones: "Competencias concurrentes con federación",
            controles: "Soberanía estatal limitada, coordinación fiscal",
            color: "#FF9800",
            detalles: "Cada estado tiene constitución, congreso y gobierno propios"
        }
    };
    
    // Datos por nivel de gobierno
    const nivelesGobierno = {
        "federal": {
            desc: "Gobierno central con competencias nacionales",
            ejemplos: "SEP, SEDENA, SRE, SHCP",
            presupuesto: "$8.9 billones MXN"
        },
        "estatal": {
            desc: "32 gobiernos estatales con autonomía limitada",
            ejemplos: "Gobiernos de Jalisco, Nuevo León, CDMX",
            presupuesto: "Variable por estado ($50-500 mil millones)"
        },
        "municipal": {
            desc: "2,463 gobiernos locales (mayores y ayuntamientos)",
            ejemplos: "Alcaldías, servicios públicos locales",
            presupuesto: "Promedio $500M MXN por municipio"
        }
    };
    
    function analizarEstructura() {
        console.log("🔍 Analizando estructura estatal...");
        
        const poder = document.getElementById(\'poderSelect\').value;
        const nivel = document.getElementById(\'nivelGobierno\').value;
        const checkboxes = document.querySelectorAll(\'input[name="detalles"]:checked\');
        const detalles = Array.from(checkboxes).map(cb => cb.value);
        
        if (poder === "todos") {
            // Análisis completo del Estado
            mostrarAnalisisCompleto(nivel, detalles);
        } else {
            // Análisis específico de un poder
            const estructura = estructurasDB[poder];
            const nivelInfo = nivelesGobierno[nivel];
            
            // Actualizar visualización
            actualizarVisualizacionEstado(poder, estructura.color);
            
            // Actualizar datos de análisis
            document.getElementById(\'dataPoder\').textContent = estructura.nombre;
            document.getElementById(\'dataOrgano\').textContent = estructura.organo;
            document.getElementById(\'dataFuncionarios\').textContent = estructura.funcionarios;
            document.getElementById(\'dataPresupuesto\').textContent = estructura.presupuesto;
            document.getElementById(\'dataAtribuciones\').textContent = estructura.atribuciones;
            document.getElementById(\'dataControles\').textContent = estructura.controles;
            
            // Información adicional según detalles seleccionados
            let infoAdicional = `Nivel: ${nivelInfo.desc}`;
            if (detalles.includes("organigrama")) {
                infoAdicional += ` | ${estructura.detalles}`;
            }
            if (detalles.includes("presupuesto")) {
                infoAdicional += ` | Presupuesto nivel ${nivel}: ${nivelInfo.presupuesto}`;
            }
            
            document.getElementById(\'infoEstado\').textContent = 
                `Análisis: ${estructura.nombre} → ${infoAdicional}`;
            
            console.log(`📊 Analizado: ${estructura.nombre} en nivel ${nivel}`);
        }
    }
    
    function mostrarAnalisisCompleto(nivel, detalles) {
        // Mostrar todos los poderes
        actualizarVisualizacionEstado("todos", "#43A047");
        
        // Resumir información de todos los poderes
        let resumen = "ANÁLISIS COMPLETO DEL ESTADO MEXICANO<br><br>";
        let funcionariosTotal = 0;
        
        for (const [key, value] of Object.entries(estructurasDB)) {
            resumen += `<strong>${value.nombre}:</strong> ${value.organo}<br>`;
            funcionariosTotal += key === "ejecutivo" ? 1200000 : 
                                key === "judicial" ? 90000 : 628;
        }
        
        resumen += `<br><strong>Total funcionarios públicos federales:</strong> ~${funcionariosTotal.toLocaleString()}`;
        resumen += `<br><strong>Presupuesto federal total 2024:</strong> $8.9 billones MXN`;
        resumen += `<br><strong>Sistema:</strong> ${nivelesGobierno[nivel].desc}`;
        
        document.getElementById(\'dataPoder\').textContent = "ANÁLISIS COMPLETO";
        document.getElementById(\'dataOrgano\').textContent = "Estado Mexicano completo";
        document.getElementById(\'dataFuncionarios\').textContent = `~${funcionariosTotal.toLocaleString()}`;
        document.getElementById(\'dataPresupuesto\').textContent = "$8.9 billones MXN";
        document.getElementById(\'dataAtribuciones\').textContent = "Todas las funciones estatales";
        document.getElementById(\'dataControles\').textContent = "Sistema completo de checks and balances";
        
        document.getElementById(\'infoEstado\').innerHTML = resumen;
        
        console.log(`📊 Análisis completo del Estado en nivel ${nivel}`);
    }
    
    function actualizarVisualizacionEstado(poder, color) {
        const svg = document.getElementById(\'svgEstado\');
        
        // Reiniciar visualización
        document.querySelectorAll(\'#svgEstado g[id^="nodo"]\').forEach(nodo => {
            nodo.setAttribute(\'opacity\', \'0.7\');
            nodo.setAttribute(\'filter\', \'none\');
        });
        
        document.querySelectorAll(\'#svgEstado path, #svgEstado line\').forEach(elemento => {
            elemento.style.stroke = \'\';
            elemento.style.strokeWidth = \'\';
        });
        
        // Estado siempre visible
        document.getElementById(\'nodoEstado\').setAttribute(\'opacity\', \'1\');
        
        if (poder === "todos") {
            // Resaltar todo
            document.getElementById(\'nodoLegislativo\').setAttribute(\'opacity\', \'1\');
            document.getElementById(\'nodoEjecutivo\').setAttribute(\'opacity\', \'1\');
            document.getElementById(\'nodoJudicial\').setAttribute(\'opacity\', \'1\');
            document.getElementById(\'nodoFederalismo\').setAttribute(\'opacity\', \'1\');
            document.getElementById(\'nodoMunicipios\').setAttribute(\'opacity\', \'1\');
            
            // Resaltar conexiones
            document.getElementById(\'conexionEstadoLegislativo\').style.stroke = color;
            document.getElementById(\'conexionEstadoEjecutivo\').style.stroke = color;
            document.getElementById(\'conexionEstadoJudicial\').style.stroke = color;
            
        } else if (poder === "legislativo") {
            document.getElementById(\'nodoLegislativo\').setAttribute(\'opacity\', \'1\');
            document.getElementById(\'nodoLegislativo\').setAttribute(\'filter\', \'url(#glow)\');
            document.getElementById(\'conexionEstadoLegislativo\').style.stroke = color;
            document.getElementById(\'conexionEstadoLegislativo\').style.strokeWidth = \'3\';
            
        } else if (poder === "ejecutivo") {
            document.getElementById(\'nodoEjecutivo\').setAttribute(\'opacity\', \'1\');
            document.getElementById(\'nodoEjecutivo\').setAttribute(\'filter\', \'url(#glow)\');
            document.getElementById(\'conexionEstadoEjecutivo\').style.stroke = color;
            document.getElementById(\'conexionEstadoEjecutivo\').style.strokeWidth = \'3\';
            
        } else if (poder === "judicial") {
            document.getElementById(\'nodoJudicial\').setAttribute(\'opacity\', \'1\');
            document.getElementById(\'nodoJudicial\').setAttribute(\'filter\', \'url(#glow)\');
            document.getElementById(\'conexionEstadoJudicial\').style.stroke = color;
            document.getElementById(\'conexionEstadoJudicial\').style.strokeWidth = \'3\';
            
        } else if (poder === "federalismo") {
            document.getElementById(\'nodoFederalismo\').setAttribute(\'opacity\', \'1\');
            document.getElementById(\'nodoFederalismo\').setAttribute(\'filter\', \'url(#glow)\');
            document.getElementById(\'nodoMunicipios\').setAttribute(\'opacity\', \'1\');
        }
        
        // Mostrar poder seleccionado
        const poderSeleccionado = document.getElementById(\'poderSeleccionado\');
        if (poder !== "todos" && estructurasDB[poder]) {
            poderSeleccionado.style.opacity = \'1\';
            poderSeleccionado.querySelector(\'rect\').setAttribute(\'fill\', color);
            document.getElementById(\'textoPoder\').textContent = estructurasDB[poder].nombre;
            document.getElementById(\'textoDetallePoder\').textContent = estructurasDB[poder].organo;
        } else {
            poderSeleccionado.style.opacity = \'0\';
        }
        
        // Animación
        if (poder !== "todos") {
            poderSeleccionado.style.animation = \'pulse 2s\';
        }
    }
    
    function poderAleatorio() {
        const poderes = Object.keys(estructurasDB);
        const aleatorio = poderes[Math.floor(Math.random() * poderes.length)];
        document.getElementById(\'poderSelect\').value = aleatorio;
        
        document.getElementById(\'infoEstado\').textContent = 
            `Poder aleatorio seleccionado: ${estructurasDB[aleatorio].nombre}. Haz clic en "ANALIZAR ESTRUCTURA".`;
    }
    
    function reiniciarAnalisis() {
        console.log("🔄 Reiniciando análisis estatal...");
        
        document.getElementById(\'poderSelect\').value = \'todos\';
        document.getElementById(\'nivelGobierno\').value = \'federal\';
        
        // Reiniciar checkboxes
        document.querySelectorAll(\'input[name="detalles"]\').forEach(cb => {
            cb.checked = true;
        });
        
        // Reiniciar visualización
        actualizarVisualizacionEstado("todos", "#43A047");
        
        // Reiniciar datos
        document.getElementById(\'dataPoder\').textContent = \'-\';
        document.getElementById(\'dataOrgano\').textContent = \'-\';
        document.getElementById(\'dataFuncionarios\').textContent = \'-\';
        document.getElementById(\'dataPresupuesto\').textContent = \'-\';
        document.getElementById(\'dataAtribuciones\').textContent = \'-\';
        document.getElementById(\'dataControles\').textContent = \'-\';
        
        document.getElementById(\'infoEstado\').textContent = 
            "Selecciona un poder y haz clic en \'ANALIZAR ESTRUCTURA\'";
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
            feedback = "🎉 ¡Excelente! Dominas la estructura del Estado.";
        } else if (porcentaje >= 60) {
            feedback = "👍 Buen trabajo, pero revisa la separación de poderes.";
        } else {
            feedback = "📚 Necesitas repasar los elementos del Estado según Montevideo.";
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
    // SISTEMA DE ERRORES COMUNES
    // ========================================
    
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
    
    // ========================================
    // SISTEMA DE PROBLEMAS TIPO EXAMEN
    // ========================================
    
    function verificarProblema(num) {
        const solucion = document.getElementById(`solucionP${num}`);
        solucion.style.display = solucion.style.display === \'block\' ? \'none\' : \'block\';
    }
    
    // ========================================
    // SISTEMA DE AUTOEVALUACIÓN
    // ========================================
    
    function guardarAutoevaluacion() {
        const slider1 = document.getElementById(\'slider1\').value;
        const slider2 = document.getElementById(\'slider2\').value;
        const slider3 = document.getElementById(\'slider3\').value;
        
        const promedio = (parseInt(slider1) + parseInt(slider2) + parseInt(slider3)) / 3;
        
        alert(`📊 AutoEvaluación guardada:\\n\\n` +
              `Elementos del Estado: ${slider1}/5\\n` +
              `Separación de poderes: ${slider2}/5\\n` +
              `Formas de gobierno: ${slider3}/5\\n\\n` +
              `Promedio: ${promedio.toFixed(1)}/5\\n\\n` +
              `Revisa el plan de estudio recomendado según tus resultados.`);
        
        console.log(`💾 AutoEvaluación guardada: ${slider1}, ${slider2}, ${slider3}`);
    }
    
    // ========================================
    // INICIALIZACIÓN
    // ========================================
    
    console.log("🚀 Sistema Cyberpunk Educativo inicializado");
    console.log("🏛️ Lección: El Estado - Territorio, Población, Gobierno y Soberanía");
    console.log("⚡ Simulador estatal, Quiz y Herramientas interactivas listas");
    
    // Elementos del Estado interactivos
    document.querySelectorAll(\'.elemento-estado-card\').forEach(card => {
        card.addEventListener(\'click\', function() {
            const elemento = this.dataset.elemento;
            
            // Mostrar información detallada
            const elementosInfo = {
                territorio: "Territorio: Espacio físico donde se ejerce soberanía. Componentes: terrestre, marítimo, aéreo, fluvial. Límites: fronteras naturales o artificiales reconocidas. Caso México: 1.96M km² + 200 millas ZEE.",
                poblacion: "Población: Conjunto de personas sujetas a la jurisdicción estatal. Ciudadanía: vínculo jurídico-político. Nacionalidad: vínculo jurídico. México: 130M hab., 52% mujeres, densidad 66 hab/km².",
                gobierno: "Gobierno: Conjunto de instituciones que ejercen el poder. Formas: República (electiva) vs Monarquía (hereditaria). Sistemas: Presidencial vs Parlamentario. México: República Federal Presidencialista.",
                soberania: "Soberanía: Poder supremo e independiente. Interna: sobre territorio y población. Externa: en relaciones internacionales. Limitaciones: derecho internacional, tratados, derechos humanos."
            };
            
            alert(`🏛️ ${this.querySelector(\'h4\').textContent}\\n\\n${elementosInfo[elemento] || "Información no disponible"}`);
        });
    });
    
    // Formas de gobierno interactivas
    document.querySelectorAll(\'.forma-gobierno\').forEach(forma => {
        forma.addEventListener(\'click\', function() {
            const tipo = this.dataset.forma;
            const titulo = this.querySelector(\'h4\').textContent;
            const contenido = this.querySelector(\'.forma-content\').innerHTML;
            
            alert(`🌍 ${titulo}\\n\\n${contenido.replace(/<[^>]*>/g, \'\\n\')}`);
        });
    });
    
    // Objetivos interactivos
    document.querySelectorAll(\'.objetivo-card\').forEach(card => {
        card.addEventListener(\'click\', function() {
            const completado = this.dataset.completado === \'true\';
            this.dataset.completado = !completado;
            const checkbox = this.querySelector(\'.objetivo-checkbox\');
            checkbox.textContent = !completado ? \'✓\' : \'\';
            checkbox.style.backgroundColor = !completado ? \'#39FF14\' : \'\';
        });
    });
    
    // Agregar filtro glow al SVG
    const svg = document.getElementById(\'svgEstado\');
    const defs = document.createElementNS(\'http://www.w3.org/2000/svg\', \'defs\');
    const filter = document.createElementNS(\'http://www.w3.org/2000/svg\', \'filter\');
    filter.setAttribute(\'id\', \'glow\');
    filter.setAttribute(\'x\', \'-50%\');
    filter.setAttribute(\'y\', \'-50%\');
    filter.setAttribute(\'width\', \'200%\');
    filter.setAttribute(\'height\', \'200%\');
    
    const feGaussianBlur = document.createElementNS(\'http://www.w3.org/2000/svg\', \'feGaussianBlur\');
    feGaussianBlur.setAttribute(\'stdDeviation\', \'4\');
    feGaussianBlur.setAttribute(\'result\', \'coloredBlur\');
    
    const feMerge = document.createElementNS(\'http://www.w3.org/2000/svg\', \'feMerge\');
    const feMergeNode1 = document.createElementNS(\'http://www.w3.org/2000/svg\', \'feMergeNode\');
    feMergeNode1.setAttribute(\'in\', \'coloredBlur\');
    const feMergeNode2 = document.createElementNS(\'http://www.w3.org/2000/svg\', \'feMergeNode\');
    feMergeNode2.setAttribute(\'in\', \'SourceGraphic\');
    
    feMerge.appendChild(feMergeNode1);
    feMerge.appendChild(feMergeNode2);
    filter.appendChild(feGaussianBlur);
    filter.appendChild(feMerge);
    defs.appendChild(filter);
    svg.appendChild(defs);
    </script>
</div>
<!-- FIN LECCIÓN CYBERPUNK -->',
    'ejercicios' => 
    array (
      0 => 
      array (
        'enunciado' => 'Cuatro elementos del Estado',
        'respuesta' => 'Territorio, población, gobierno, soberanía',
      ),
      1 => 
      array (
        'enunciado' => 'Función principal del Estado',
        'respuesta' => 'Regular sociedad y proveer servicios',
      ),
      2 => 
      array (
        'enunciado' => 'Poder que crea leyes',
        'respuesta' => 'Legislativo',
      ),
      3 => 
      array (
        'enunciado' => 'Poder que ejecuta leyes',
        'respuesta' => 'Ejecutivo',
      ),
      4 => 
      array (
        'enunciado' => 'Poder que interpreta leyes',
        'respuesta' => 'Judicial',
      ),
      5 => 
      array (
        'enunciado' => 'México: jefe del ejecutivo',
        'respuesta' => 'Presidente',
      ),
      6 => 
      array (
        'enunciado' => 'SCJN significa',
        'respuesta' => 'Suprema Corte de Justicia de la Nación',
      ),
      7 => 
      array (
        'enunciado' => 'Soberanía permite',
        'respuesta' => 'Relaciones internacionales',
      ),
      8 => 
      array (
        'enunciado' => 'México: territorio en km²',
        'respuesta' => '~1.96 millones',
      ),
      9 => 
      array (
        'enunciado' => 'Convención de Montevideo',
        'respuesta' => '1933, define Estado',
      ),
      10 => 
      array (
        'enunciado' => 'Estado moderno incluye',
        'respuesta' => 'Servicios públicos',
      ),
      11 => 
      array (
        'enunciado' => 'SI: México en ONU desde',
        'respuesta' => '1945',
      ),
    ),
    'quiz' => 
    array (
      0 => 
      array (
        'pregunta' => 'Elemento del Estado',
        'opciones' => 
        array (
          0 => 'Territorio',
          1 => 'Clima',
          2 => 'Religión',
          3 => 'Idioma',
        ),
        'correcta' => 'Territorio',
      ),
      1 => 
      array (
        'pregunta' => 'Población es',
        'opciones' => 
        array (
          0 => 'Permanente',
          1 => 'Turistas',
          2 => 'Visitantes',
          3 => 'Animales',
        ),
        'correcta' => 'Permanente',
      ),
      2 => 
      array (
        'pregunta' => 'Gobierno es',
        'opciones' => 
        array (
          0 => 'Instituciones de poder',
          1 => 'Pueblo',
          2 => 'Empresas',
          3 => 'ONG',
        ),
        'correcta' => 'Instituciones de poder',
      ),
      3 => 
      array (
        'pregunta' => 'Soberanía implica',
        'opciones' => 
        array (
          0 => 'Independencia externa',
          1 => 'Dependencia',
          2 => 'Aislamiento',
          3 => 'Nada',
        ),
        'correcta' => 'Independencia externa',
      ),
      4 => 
      array (
        'pregunta' => 'Legislativo hace',
        'opciones' => 
        array (
          0 => 'Leyes',
          1 => 'Ejecuta',
          2 => 'Juzga',
          3 => 'Nada',
        ),
        'correcta' => 'Leyes',
      ),
      5 => 
      array (
        'pregunta' => 'Ejecutivo encabezado por',
        'opciones' => 
        array (
          0 => 'Presidente',
          1 => 'Congreso',
          2 => 'Corte',
          3 => 'Pueblo',
        ),
        'correcta' => 'Presidente',
      ),
      6 => 
      array (
        'pregunta' => 'Judicial resuelve',
        'opciones' => 
        array (
          0 => 'Disputas legales',
          1 => 'Presupuestos',
          2 => 'Elecciones',
          3 => 'Guerra',
        ),
        'correcta' => 'Disputas legales',
      ),
      7 => 
      array (
        'pregunta' => 'México: poderes',
        'opciones' => 
        array (
          0 => '3',
          1 => '1',
          2 => '2',
          3 => '5',
        ),
        'correcta' => '3',
      ),
      8 => 
      array (
        'pregunta' => 'Art. 49 CPEUM',
        'opciones' => 
        array (
          0 => 'Separación de poderes',
          1 => 'Derechos',
          2 => 'Territorio',
          3 => 'Población',
        ),
        'correcta' => 'Separación de poderes',
      ),
      9 => 
      array (
        'pregunta' => 'SI 2025: estados en México',
        'opciones' => 
        array (
          0 => '32 + CDMX',
          1 => '31',
          2 => '33',
          3 => '30',
        ),
        'correcta' => '32 + CDMX',
      ),
      10 => 
      array (
        'pregunta' => 'Estado sin territorio',
        'opciones' => 
        array (
          0 => 'No existe',
          1 => 'Sí',
          2 => 'Virtual',
          3 => 'Espacial',
        ),
        'correcta' => 'No existe',
      ),
      11 => 
      array (
        'pregunta' => 'ONU reconoce',
        'opciones' => 
        array (
          0 => '193 estados',
          1 => '100',
          2 => '200',
          3 => '150',
        ),
        'correcta' => '193 estados',
      ),
      12 => 
      array (
        'pregunta' => 'México: capital',
        'opciones' => 
        array (
          0 => 'CDMX',
          1 => 'Guadalajara',
          2 => 'Monterrey',
          3 => 'Puebla',
        ),
        'correcta' => 'CDMX',
      ),
      13 => 
      array (
        'pregunta' => 'Poder que nombra ministros',
        'opciones' => 
        array (
          0 => 'Ejecutivo',
          1 => 'Legislativo',
          2 => 'Judicial',
          3 => 'Pueblo',
        ),
        'correcta' => 'Ejecutivo',
      ),
      14 => 
      array (
        'pregunta' => 'Congreso es',
        'opciones' => 
        array (
          0 => 'Legislativo',
          1 => 'Ejecutivo',
          2 => 'Judicial',
          3 => 'Ninguno',
        ),
        'correcta' => 'Legislativo',
      ),
      15 => 
      array (
        'pregunta' => 'SCJN es parte de',
        'opciones' => 
        array (
          0 => 'Poder Judicial',
          1 => 'Ejecutivo',
          2 => 'Legislativo',
          3 => 'Ninguno',
        ),
        'correcta' => 'Poder Judicial',
      ),
      16 => 
      array (
        'pregunta' => 'Estado federal como México',
        'opciones' => 
        array (
          0 => '32 entidades',
          1 => '1 solo',
          2 => '2',
          3 => '100',
        ),
        'correcta' => '32 entidades',
      ),
      17 => 
      array (
        'pregunta' => 'Soberanía interna',
        'opciones' => 
        array (
          0 => 'Autoridad sobre población',
          1 => 'Externa',
          2 => 'Nada',
          3 => 'Ambas',
        ),
        'correcta' => 'Autoridad sobre población',
      ),
      18 => 
      array (
        'pregunta' => 'Tratado internacional',
        'opciones' => 
        array (
          0 => 'Ejercicio soberanía',
          1 => 'Pérdida',
          2 => 'Nada',
          3 => 'Interno',
        ),
        'correcta' => 'Ejercicio soberanía',
      ),
      19 => 
      array (
        'pregunta' => 'SI 2025: México PIB lugar',
        'opciones' => 
        array (
          0 => '~15 mundial',
          1 => '1',
          2 => '50',
          3 => '100',
        ),
        'correcta' => '~15 mundial',
      ),
      20 => 
      array (
        'pregunta' => 'Estado fallido',
        'opciones' => 
        array (
          0 => 'Sin control efectivo',
          1 => 'Fuerte',
          2 => 'Democrático',
          3 => 'Rico',
        ),
        'correcta' => 'Sin control efectivo',
      ),
      21 => 
      array (
        'pregunta' => 'Ciudad del Vaticano',
        'opciones' => 
        array (
          0 => 'Estado soberano',
          1 => 'No',
          2 => 'Parte Italia',
          3 => 'Virtual',
        ),
        'correcta' => 'Estado soberano',
      ),
      22 => 
      array (
        'pregunta' => 'Poder que declara guerra',
        'opciones' => 
        array (
          0 => 'Congreso',
          1 => 'Presidente',
          2 => 'Corte',
          3 => 'Pueblo',
        ),
        'correcta' => 'Congreso',
      ),
      23 => 
      array (
        'pregunta' => 'Impuestos son función',
        'opciones' => 
        array (
          0 => 'Estado',
          1 => 'Empresa',
          2 => 'Familia',
          3 => 'Iglesia',
        ),
        'correcta' => 'Estado',
      ),
      24 => 
      array (
        'pregunta' => 'México: moneda',
        'opciones' => 
        array (
          0 => 'Peso',
          1 => 'Dólar',
          2 => 'Euro',
          3 => 'Bitcoin',
        ),
        'correcta' => 'Peso',
      ),
      25 => 
      array (
        'pregunta' => 'Estado de derecho',
        'opciones' => 
        array (
          0 => 'Supremacía de la ley',
          1 => 'Fuerza',
          2 => 'Tradición',
          3 => 'Religión',
        ),
        'correcta' => 'Supremacía de la ley',
      ),
      26 => 
      array (
        'pregunta' => 'México: himno',
        'opciones' => 
        array (
          0 => 'Himno Nacional Mexicano',
          1 => 'Ninguno',
          2 => 'Internacional',
          3 => 'Popular',
        ),
        'correcta' => 'Himno Nacional Mexicano',
      ),
      27 => 
      array (
        'pregunta' => 'SI 2025: INEGI mide',
        'opciones' => 
        array (
          0 => 'Población, PIB',
          1 => 'Clima',
          2 => 'Deportes',
          3 => 'Música',
        ),
        'correcta' => 'Población, PIB',
      ),
      28 => 
      array (
        'pregunta' => 'Estado laico',
        'opciones' => 
        array (
          0 => 'México (Art. 130)',
          1 => 'Religioso',
          2 => 'Católico',
          3 => 'Protestante',
        ),
        'correcta' => 'México (Art. 130)',
      ),
      29 => 
      array (
        'pregunta' => 'Estado es',
        'opciones' => 
        array (
          0 => 'Persona jurídica',
          1 => 'Física',
          2 => 'Animal',
          3 => 'Cosa',
        ),
        'correcta' => 'Persona jurídica',
      ),
    ),
  ),
  4 => 
  array (
    'materia' => 'Ciencias Sociales',
    'slug' => 'relaciones-poderes',
    'titulo' => 'Relaciones de Poder: Dominación, Resistencia y Negociación',
    'contenido' => '<!-- INICIO LECCIÓN CYBERPUNK -->
<div class="leccion-container leccion-sociales-poder" data-tema="relaciones-poder">
    
    <!-- CABECERA CYBERPUNK -->
    <header class="leccion-header">
        <h1 class="titulo-leccion neon-glow">
            <span class="icon-tema">⚡</span>
            RELACIONES DE PODER: LA RED SOCIAL DEL CONTROL
        </h1>
        <div class="subtitulo">
            Dominación, Resistencia y Negociación en el Tejido Social Contemporáneo
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
                <h3>Identificar tipos y fuentes de poder</h3>
                <p>Político, económico, social-cultural y personal según Weber, Foucault y Bourdieu</p>
            </div>
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Analizar dinámicas relacionales</h3>
                <p>Dominación, resistencia, negociación y sus manifestaciones en distintos contextos</p>
            </div>
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Mapear redes de poder</h3>
                <p>Visualizar interconexiones entre actores y formas de ejercicio del poder</p>
            </div>
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Evaluar casos contemporáneos</h3>
                <p>Aplicar teoría a conflictos laborales, movimientos sociales y relaciones institucionales</p>
            </div>
        </div>
    </section>

    <!-- CONTEXTO REAL -->
    <section class="contexto-real">
        <h2 class="seccion-titulo neon-dato">
            <span class="icon">🌍</span> CASOS REALES DE EJERCICIO DE PODER
        </h2>
        <div class="contexto-grid">
            <div class="contexto-card">
                <h3>💼 Relaciones Laborales</h3>
                <p>Patrón-empleado: jerarquía → sindicato: resistencia → negociación colectiva: equilibrio</p>
                <div class="dato-neon">30% trabajadores sindicalizados México</div>
            </div>
            <div class="contexto-card">
                <h3>🏛️ Movimientos Sociales</h3>
                <p>Protestas ciudadanas → presión mediática → respuesta institucional → reformas</p>
                <div class="dato-neon">#YoSoy132 (2012): 132 marchas simultáneas</div>
            </div>
            <div class="contexto-card">
                <h3>📱 Poder Digital</h3>
                <p>Plataformas tecnológicas → control datos → influencia política → regulación estatal</p>
                <div class="dato-neon">Meta: 2.9B usuarios, más que cualquier país</div>
            </div>
        </div>
    </section>

    <!-- FUNDAMENTOS TEÓRICOS -->
    <section class="teoria-section">
        <div class="borde-neon-lateral"></div>
        <h2 class="seccion-titulo neon-concepto">
            <span class="icon">📚</span> TEORÍAS FUNDAMENTALES DEL PODER
        </h2>
        
        <!-- DEFINICIÓN PRINCIPAL -->
        <div class="subseccion">
            <div class="definicion-principal">
                <div class="def-card">
                    <h4>⚡ EL PODER SEGÚN FOUCAULT</h4>
                    <p>"<strong>El poder está en todas partes</strong> porque viene de todas partes" - <em>Microfísica del poder</em></p>
                    <div class="formula-inline">
                        \\[ \\text{Poder} \\neq \\text{Posesión} \\quad \\text{Poder} = \\text{Relación} \\]
                    </div>
                    <div class="teorias-contraste">
                        <div class="teoria-item">
                            <strong>Weber:</strong> Poder como probabilidad de imponer voluntad
                        </div>
                        <div class="teoria-item">
                            <strong>Foucault:</strong> Poder relacional, productivo, en red
                        </div>
                        <div class="teoria-item">
                            <strong>Bourdieu:</strong> Capital simbólico y violencia simbólica
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- TIPOS DE PODER -->
        <div class="subseccion">
            <h3>1. Tipologías y Fuentes del Poder</h3>
            
            <div class="tipos-poder-grid">
                <div class="tipo-poder-card" data-tipo="politico">
                    <div class="tipo-poder-icon">🏛️</div>
                    <h4>PODER POLÍTICO</h4>
                    <div class="tipo-poder-desc">
                        Capacidad de tomar decisiones vinculantes para la colectividad
                    </div>
                    <div class="tipo-poder-caracteristicas">
                        <p><strong>Fuentes:</strong> Autoridad legítima, monopolio violencia legítima (Weber)</p>
                        <p><strong>Formas:</strong> Estado, partidos, gobierno, instituciones públicas</p>
                        <p><strong>Legitimación:</strong> Tradicional, carismática, legal-racional</p>
                    </div>
                    <div class="tipo-poder-ejemplos">
                        <div class="ejemplo-item">
                            <div class="ejemplo-icon">👑</div>
                            <div class="ejemplo-text">
                                <strong>Estado Mexicano</strong><br>
                                Monopolio violencia legítima
                            </div>
                        </div>
                        <div class="ejemplo-item">
                            <div class="ejemplo-icon">🗳️</div>
                            <div class="ejemplo-text">
                                <strong>Partidos políticos</strong><br>
                                Competencia electoral, representación
                            </div>
                        </div>
                        <div class="ejemplo-item">
                            <div class="ejemplo-icon">👮</div>
                            <div class="ejemplo-text">
                                <strong>Fuerzas de seguridad</strong><br>
                                Ejercicio coactivo regulado
                            </div>
                        </div>
                    </div>
                    <div class="tipo-poder-dato">
                        <span>Presupuesto seguridad 2024:</span>
                        <span class="stat-value">$320,000M MXN</span>
                    </div>
                </div>
                
                <div class="tipo-poder-card" data-tipo="economico">
                    <div class="tipo-poder-icon">💰</div>
                    <h4>PODER ECONÓMICO</h4>
                    <div class="tipo-poder-desc">
                        Control sobre recursos materiales y medios de producción
                    </div>
                    <div class="tipo-poder-caracteristicas">
                        <p><strong>Fuentes:</strong> Capital, propiedad, control recursos estratégicos</p>
                        <p><strong>Formas:</strong> Empresas, bancos, monopolios, corporaciones transnacionales</p>
                        <p><strong>Mecanismos:</strong> Acumulación, inversión, control mercados</p>
                    </div>
                    <div class="tipo-poder-ejemplos">
                        <div class="ejemplo-item">
                            <div class="ejemplo-icon">🏢</div>
                            <div class="ejemplo-text">
                                <strong>Empresas transnacionales</strong><br>
                                Walmart, Amazon, Tesla
                            </div>
                        </div>
                        <div class="ejemplo-item">
                            <div class="ejemplo-icon">🏦</div>
                            <div class="ejemplo-text">
                                <strong>Instituciones financieras</strong><br>
                                Banco de México, bancos comerciales
                            </div>
                        </div>
                        <div class="ejemplo-item">
                            <div class="ejemplo-icon">🛢️</div>
                            <div class="ejemplo-text">
                                <strong>Control recursos</strong><br>
                                Pemex, mineras, energéticas
                            </div>
                        </div>
                    </div>
                    <div class="tipo-poder-dato">
                        <span>10% más rico concentra:</span>
                        <span class="stat-value">64% riqueza nacional</span>
                    </div>
                </div>
                
                <div class="tipo-poder-card" data-tipo="social">
                    <div class="tipo-poder-icon">🎭</div>
                    <h4>PODER SOCIAL-CULTURAL</h4>
                    <div class="tipo-poder-desc">
                        Influencia sobre valores, normas, conocimiento y significados sociales
                    </div>
                    <div class="tipo-poder-caracteristicas">
                        <p><strong>Fuentes:</strong> Capital cultural, simbólico, medios comunicación</p>
                        <p><strong>Formas:</strong> Medios, educación, religión, instituciones culturales</p>
                        <p><strong>Mecanismos:</strong> Socialización, hegemonía cultural (Gramsci)</p>
                    </div>
                    <div class="tipo-poder-ejemplos">
                        <div class="ejemplo-item">
                            <div class="ejemplo-icon">📺</div>
                            <div class="ejemplo-text">
                                <strong>Medios de comunicación</strong><br>
                                Televisa, TV Azteca, redes sociales
                            </div>
                        </div>
                        <div class="ejemplo-item">
                            <div class="ejemplo-icon">🏫</div>
                            <div class="ejemplo-text">
                                <strong>Sistema educativo</strong><br>
                                Currículum, valores transmitidos
                            </div>
                        </div>
                        <div class="ejemplo-item">
                            <div class="ejemplo-icon">⛪</div>
                            <div class="ejemplo-text">
                                <strong>Instituciones religiosas</strong><br>
                                Iglesia Católica (82.7% población)
                            </div>
                        </div>
                    </div>
                    <div class="tipo-poder-dato">
                        <span>Audiencia TV abierta:</span>
                        <span class="stat-value">45M personas/día</span>
                    </div>
                </div>
                
                <div class="tipo-poder-card" data-tipo="personal">
                    <div class="tipo-poder-icon">🧠</div>
                    <h4>PODER PERSONAL</h4>
                    <div class="tipo-poder-desc">
                        Capacidad individual basada en características personales y conocimientos
                    </div>
                    <div class="tipo-poder-caracteristicas">
                        <p><strong>Fuentes:</strong> Carisma, conocimiento experto, habilidades sociales</p>
                        <p><strong>Formas:</strong> Liderazgo, influencia interpersonal, autoridad moral</p>
                        <p><strong>Mecanismos:</strong> Persuasión, ejemplo, capacidad convocatoria</p>
                    </div>
                    <div class="tipo-poder-ejemplos">
                        <div class="ejemplo-item">
                            <div class="ejemplo-icon">🌟</div>
                            <div class="ejemplo-text">
                                <strong>Líderes carismáticos</strong><br>
                                Figuras políticas, sociales
                            </div>
                        </div>
                        <div class="ejemplo-item">
                            <div class="ejemplo-icon">👨‍🔬</div>
                            <div class="ejemplo-text">
                                <strong>Expertos y científicos</strong><br>
                                Autoridad basada en conocimiento
                            </div>
                        </div>
                        <div class="ejemplo-item">
                            <div class="ejemplo-icon">🗣️</div>
                            <div class="ejemplo-text">
                                <strong>Influencers</strong><br>
                                Poder de convocatoria en redes
                            </div>
                        </div>
                    </div>
                    <div class="tipo-poder-dato">
                        <span>Mayor influencer MX:</span>
                        <span class="stat-value">25M seguidores</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- DINÁMICAS DEL PODER -->
        <div class="subseccion">
            <h3>2. Dinámicas Relacionales del Poder</h3>
            
            <div class="dinamicas-grid">
                <div class="dinamica-card" data-dinamica="dominacion">
                    <div class="dinamica-icon">👑</div>
                    <h4>DOMINACIÓN</h4>
                    <div class="dinamica-desc">
                        Ejercicio unilateral de poder sin consentimiento del sometido
                    </div>
                    <div class="dinamica-detalle">
                        <p><strong>Características:</strong> Asimétrica, coercitiva, jerárquica</p>
                        <p><strong>Tipos según Weber:</strong> Tradicional, carismática, legal-racional</p>
                        <p><strong>Ejemplos:</strong> Dictaduras, relaciones patriarcales, explotación laboral</p>
                    </div>
                    <div class="dinamica-formas">
                        <div class="forma-item">
                            <div class="forma-icon">⚖️</div>
                            <div class="forma-text">
                                <strong>Dominación legal</strong><br>
                                Burocracia, normas institucionales
                            </div>
                        </div>
                        <div class="forma-item">
                            <div class="forma-icon">💪</div>
                            <div class="forma-text">
                                <strong>Dominación coercitiva</strong><br>
                                Fuerza, amenaza, violencia
                            </div>
                        </div>
                        <div class="forma-item">
                            <div class="forma-icon">🎭</div>
                            <div class="forma-text">
                                <strong>Dominación simbólica</strong><br>
                                Naturalización desigualdades (Bourdieu)
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="dinamica-card" data-dinamica="resistencia">
                    <div class="dinamica-icon">✊</div>
                    <h4>RESISTENCIA</h4>
                    <div class="dinamica-desc">
                        Acciones que cuestionan, limitan o rechazan relaciones de poder establecidas
                    </div>
                    <div class="dinamica-detalle">
                        <p><strong>Características:</strong> Reactiva/proactiva, individual/colectiva, visible/oculta</p>
                        <p><strong>Formas:</strong> Protestas, desobediencia, creación alternativa</p>
                        <p><strong>Ejemplos:</strong> Movimientos sociales, huelgas, arte subversivo</p>
                    </div>
                    <div class="dinamica-formas">
                        <div class="forma-item">
                            <div class="forma-icon">🚶</div>
                            <div class="forma-text">
                                <strong>Resistencia abierta</strong><br>
                                Protestas, manifestaciones, huelgas
                            </div>
                        </div>
                        <div class="forma-item">
                            <div class="forma-icon">🕵️</div>
                            <div class="forma-text">
                                <strong>Resistencia cotidiana</strong><br>
                                Sabotaje sutil, incumplimiento tácito
                            </div>
                        </div>
                        <div class="forma-item">
                            <div class="forma-icon">🎨</div>
                            <div class="forma-text">
                                <strong>Resistencia cultural</strong><br>
                                Contracultura, arte político
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="dinamica-card" data-dinamica="negociacion">
                    <div class="dinamica-icon">🤝</div>
                    <h4>NEGOCIACIÓN</h4>
                    <div class="dinamica-desc">
                        Proceso interactivo donde actores con intereses diferentes buscan acuerdos
                    </div>
                    <div class="dinamica-detalle">
                        <p><strong>Características:</strong> Interactiva, dialógica, busca equilibrio</p>
                        <p><strong>Mecanismos:</strong> Diálogo, concesiones mutuas, mediación</p>
                        <p><strong>Ejemplos:</strong> Negociación colectiva, acuerdos políticos, tratados</p>
                    </div>
                    <div class="dinamica-formas">
                        <div class="forma-item">
                            <div class="forma-icon">📝</div>
                            <div class="forma-text">
                                <strong>Negociación formal</strong><br>
                                Contratos colectivos, tratados
                            </div>
                        </div>
                        <div class="forma-item">
                            <div class="forma-icon">🗣️</div>
                            <div class="forma-text">
                                <strong>Negociación informal</strong><br>
                                Acuerdos tácitos, entendimientos
                            </div>
                        </div>
                        <div class="forma-item">
                            <div class="forma-icon">⚖️</div>
                            <div class="forma-text">
                                <strong>Mediación institucional</strong><br>
                                Juntas de conciliación, árbitros
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="ciclo-poder">
                <h4>🔄 CICLO DINÁMICO DEL PODER</h4>
                <div class="ciclo-content">
                    <div class="ciclo-item">
                        <div class="ciclo-icon">👑</div>
                        <div class="ciclo-text">
                            <strong>Dominación</strong><br>
                            Establece relaciones asimétricas
                        </div>
                    </div>
                    <div class="ciclo-flecha">→</div>
                    <div class="ciclo-item">
                        <div class="ciclo-icon">✊</div>
                        <div class="ciclo-text">
                            <strong>Resistencia</strong><br>
                            Cuestiona y desafía el poder
                        </div>
                    </div>
                    <div class="ciclo-flecha">→</div>
                    <div class="ciclo-item">
                        <div class="ciclo-icon">🤝</div>
                        <div class="ciclo-text">
                            <strong>Negociación</strong><br>
                            Busca nuevos equilibrios
                        </div>
                    </div>
                    <div class="ciclo-flecha">↻</div>
                </div>
                <p class="ciclo-explicacion">El poder nunca es estático: toda dominación genera resistencia, que a su vez puede llevar a negociación y reconfiguración de relaciones.</p>
            </div>
        </div>

        <!-- MATRIZ DE PODER -->
        <div class="subseccion">
            <h3>3. Matriz de Poder: Intersecciones y Superposiciones</h3>
            <div class="principio-foucault">
                <p><strong>Michel Foucault:</strong> "El poder no es un atributo, no es una \'posesión\' que se conquista, se arranca, se comparte... el poder se ejerce a partir de innumerables puntos."</p>
            </div>
            
            <div class="matriz-interactiva">
                <table class="matriz-poder">
                    <thead>
                        <tr>
                            <th>ÁMBITO</th>
                            <th>DOMINACIÓN</th>
                            <th>RESISTENCIA</th>
                            <th>NEGOCIACIÓN</th>
                            <th>EJEMPLO CONCRETO</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr data-ambito="laboral">
                            <td><strong class="neon-concepto">LABORAL</strong></td>
                            <td>Jerarquía empresarial, control patronal</td>
                            <td>Sindicatos, huelgas, organización obrera</td>
                            <td>Contrato colectivo, comisiones mixtas</td>
                            <td>Empresa maquiladora vs sindicato independiente</td>
                        </tr>
                        <tr data-ambito="politico">
                            <td><strong class="neon-concepto">POLÍTICO</strong></td>
                            <td>Estado autoritario, control medios</td>
                            <td>Movimientos sociales, protestas</td>
                            <td>Diálogo nacional, pactos políticos</td>
                            <td>Movimiento estudiantil 1968 vs Estado mexicano</td>
                        </tr>
                        <tr data-ambito="social">
                            <td><strong class="neon-concepto">SOCIAL</strong></td>
                            <td>Discriminación, exclusión sistémica</td>
                            <td>Movimientos identitarios, visibilización</td>
                            <td>Políticas inclusivas, reconocimiento derechos</td>
                            <td>Feminismo vs patriarcado: #NiUnaMenos</td>
                        </tr>
                        <tr data-ambito="cultural">
                            <td><strong class="neon-concepto">CULTURAL</strong></td>
                            <td>Hegemonía cultural, control narrativas</td>
                            <td>Contracultura, arte subversivo</td>
                            <td>Pluralismo, diálogo intercultural</td>
                            <td>Movimiento zapatista: "Mandar obedeciendo"</td>
                        </tr>
                    </tbody>
                </table>
                <div class="matriz-info" id="infoMatriz">
                    Selecciona un ámbito para ver análisis detallado
                </div>
            </div>
        </div>
    </section>

    <!-- SIMULADOR INTERACTIVO -->
    <section class="simulator-section">
        <h2 class="seccion-titulo neon-interactivo">
            <span class="icon">🔄</span> SIMULADOR: RED DE PODER DINÁMICA
        </h2>
        
        <div class="simulator-container" data-tema="red-poder">
            <!-- PANEL DE CONTROLES -->
            <div class="simulator-controls">
                <h3>CONTROLES DE SIMULACIÓN</h3>
                
                <div class="control-group">
                    <label for="escenarioSelect">Escenario de poder:</label>
                    <select id="escenarioSelect" class="control-select">
                        <option value="empresa">Empresa industrial</option>
                        <option value="universidad">Universidad pública</option>
                        <option value="comunidad">Comunidad rural</option>
                        <option value="ciudad">Ciudad metropolitana</option>
                        <option value="online">Espacio digital</option>
                    </select>
                </div>
                
                <div class="control-group">
                    <label for="dinamicaSelect">Dinámica predominante:</label>
                    <select id="dinamicaSelect" class="control-select">
                        <option value="dominacion">Dominación</option>
                        <option value="resistencia">Resistencia</option>
                        <option value="negociacion">Negociación</option>
                        <option value="mixta">Mixta (todas)</option>
                    </select>
                </div>
                
                <div class="control-group">
                    <label>Actores a visualizar:</label>
                    <div class="checkbox-group">
                        <label><input type="checkbox" name="actores" value="institucionales" checked> Institucionales</label>
                        <label><input type="checkbox" name="actores" value="colectivos" checked> Colectivos</label>
                        <label><input type="checkbox" name="actores" value="individuales"> Individuales</label>
                        <label><input type="checkbox" name="actores" value="informales"> Informales</label>
                    </div>
                </div>
                
                <div class="slider-control">
                    <label for="intensidadPoder">Intensidad de poder:</label>
                    <input type="range" id="intensidadPoder" min="1" max="10" value="5">
                    <div class="slider-labels">
                        <span>Baja</span><span>Media</span><span>Alta</span>
                    </div>
                </div>
                
                <button class="btn-clasificar" onclick="simularRedPoder()">
                    <span class="btn-icon">⚡</span> SIMULAR RED
                </button>
                
                <button class="btn-aleatorio" onclick="escenarioAleatorio()">
                    <span class="btn-icon">🎲</span> ESCENARIO ALEATORIO
                </button>
                
                <button class="btn-reset" onclick="reiniciarSimulacion()">
                    <span class="btn-icon">🔄</span> REINICIAR
                </button>
            </div>
            
            <!-- VISUALIZACIÓN DE LA RED -->
            <div class="simulator-visualization" id="visualizacionRed">
                <div class="red-container">
                    <svg viewBox="0 0 600 500" id="svgRed">
                        <!-- Fondo de red -->
                        <rect x="0" y="0" width="600" height="500" fill="#0a0a1a" id="fondoRed"/>
                        
                        <!-- RED DE PODER DINÁMICA -->
                        <g id="redPoder">
                            <!-- Nodos dinámicos se agregarán aquí -->
                        </g>
                        
                        <!-- CONEXIONES DINÁMICAS -->
                        <g id="conexionesRed"></g>
                        
                        <!-- LEGENDA INTERACTIVA -->
                        <g id="leyendaRed">
                            <rect x="400" y="400" width="180" height="90" fill="rgba(0,0,0,0.7)" rx="5"/>
                            <text x="490" y="420" fill="#39FF14" text-anchor="middle" font-size="11">LEGENDAS</text>
                            
                            <!-- Dominación -->
                            <circle cx="410" cy="435" r="4" fill="#D32F2F"/>
                            <text x="425" y="438" fill="#FFCDD2" font-size="9">Dominación</text>
                            
                            <!-- Resistencia -->
                            <circle cx="410" cy="450" r="4" fill="#FF9800"/>
                            <text x="425" y="453" fill="#FFECB3" font-size="9">Resistencia</text>
                            
                            <!-- Negociación -->
                            <circle cx="410" cy="465" r="4" fill="#2196F3"/>
                            <text x="425" y="468" fill="#BBDEFB" font-size="9">Negociación</text>
                            
                            <!-- Poder mixto -->
                            <circle cx="410" cy="480" r="4" fill="#9C27B0"/>
                            <text x="425" y="483" fill="#E1BEE7" font-size="9">Mixto</text>
                        </g>
                        
                        <!-- INFO NODO SELECCIONADO -->
                        <g id="infoNodo" opacity="0">
                            <rect x="50" y="400" width="300" height="80" rx="8" fill="rgba(0,0,0,0.8)"/>
                            <text x="200" y="425" fill="white" text-anchor="middle" font-size="11" id="textoNodo">NODO</text>
                            <text x="200" y="445" fill="#BBDEFB" text-anchor="middle" font-size="9" id="tipoNodo">Tipo</text>
                            <text x="200" y="465" fill="#FFECB3" text-anchor="middle" font-size="9" id="poderNodo">Poder: 0</text>
                        </g>
                    </svg>
                </div>
                <div class="red-info" id="infoRed">
                    Selecciona un escenario y haz clic en "SIMULAR RED"
                </div>
            </div>
            
            <!-- DATOS DE LA SIMULACIÓN -->
            <div class="simulator-data">
                <h3>DATOS DE LA RED</h3>
                
                <div class="data-card">
                    <div class="data-label">Escenario:</div>
                    <div class="data-value" id="dataEscenario">-</div>
                </div>
                
                <div class="data-card">
                    <div class="data-label">Actores principales:</div>
                    <div class="data-value" id="dataActores">-</div>
                </div>
                
                <div class="data-card">
                    <div class="data-label">Dinámica predominante:</div>
                    <div class="data-value" id="dataDinamica">-</div>
                </div>
                
                <div class="data-card highlight">
                    <div class="data-label">NIVEL CONFLICTO:</div>
                    <div class="data-value" id="dataConflicto">-</div>
                </div>
                
                <div class="data-card">
                    <div class="data-label">Mecanismos de poder:</div>
                    <div class="data-value" id="dataMecanismos">-</div>
                </div>
                
                <div class="data-card">
                    <div class="data-label">Potencial transformación:</div>
                    <div class="data-value" id="dataTransformacion">-</div>
                </div>
                
                <div class="estadisticas">
                    <h4>📊 ESTADÍSTICAS DE PODER</h4>
                    <div class="stat-item">
                        <span>Sindicatos en México:</span>
                        <span class="stat-value">35,000+</span>
                    </div>
                    <div class="stat-item">
                        <span>Protestas sociales/año:</span>
                        <span class="stat-value">3,500+</span>
                    </div>
                    <div class="stat-item">
                        <span>Contratos colectivos:</span>
                        <span class="stat-value">110,000</span>
                    </div>
                    <div class="stat-item">
                        <span>Huelgas 2023:</span>
                        <span class="stat-value">42</span>
                    </div>
                    <div class="stat-item">
                        <span>ONGs registradas:</span>
                        <span class="stat-value">45,000</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CASO DE ESTUDIO: RELACIONES LABORALES -->
    <section class="caso-estudio">
        <h2 class="seccion-titulo neon-ejemplo">
            <span class="icon">🔍</span> CASO DE ESTUDIO: RELACIONES LABORALES EN MAQUILADORA
        </h2>
        
        <div class="caso-container">
            <div class="linea-tiempo">
                <h4>📅 EVOLUCIÓN TEMPORAL DEL CONFLICTO</h4>
                
                <div class="evento-tiempo" data-fase="dominacion">
                    <div class="evento-fecha">2015-2018</div>
                    <div class="evento-contenido">
                        <h5>👑 FASE DE DOMINACIÓN</h5>
                        <p><strong>Empresa:</strong> Maquiladora transnacional en frontera norte</p>
                        <p><strong>Prácticas:</strong> Jornadas 12h, salarios mínimos, sindicato charro</p>
                        <p><strong>Mecanismos:</strong> Control férreo, amenazas de despido, vigilancia</p>
                        <div class="evento-dato">
                            <span>Rotación anual:</span>
                            <span class="dato-valor">85%</span>
                        </div>
                    </div>
                </div>
                
                <div class="evento-tiempo" data-fase="resistencia">
                    <div class="evento-fecha">2019-2020</div>
                    <div class="evento-contenido">
                        <h5>✊ FASE DE RESISTENCIA</h5>
                        <p><strong>Acciones trabajadoras:</strong> Organización clandestina, denuncias anónimas</p>
                        <p><strong>Puntos de quiebre:</strong> Accidentes laborales, demandas colectivas</p>
                        <p><strong>Alianzas:</strong> ONGs de derechos humanos, medios independientes</p>
                        <div class="evento-dato">
                            <span>Denuncias presentadas:</span>
                            <span class="dato-valor">47</span>
                        </div>
                    </div>
                </div>
                
                <div class="evento-tiempo" data-fase="negociacion">
                    <div class="evento-fecha">2021-2023</div>
                    <div class="evento-contenido">
                        <h5>🤝 FASE DE NEGOCIACIÓN</h5>
                        <p><strong>Proceso:</strong> Mediación de PROFEDET, presión internacional</p>
                        <p><strong>Resultados:</strong> Nuevo contrato colectivo, aumento salarial 22%</p>
                        <p><strong>Cambios:</strong> Comisión de seguridad, capacitación sindical</p>
                        <div class="evento-dato">
                            <span>Aumento salarial:</span>
                            <span class="dato-valor">22%</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="analisis-caso">
                <h4>📊 ANÁLISIS DE PODER EN EL CASO</h4>
                <div class="analisis-grid">
                    <div class="analisis-item">
                        <h5>⚡ TIPOS DE PODER EJERCIDOS</h5>
                        <ul>
                            <li><strong>Económico:</strong> Control salarios, empleo</li>
                            <li><strong>Político:</strong> Relaciones con autoridades locales</li>
                            <li><strong>Simbólico:</strong> Discursos de "oportunidad laboral"</li>
                        </ul>
                    </div>
                    
                    <div class="analisis-item">
                        <h5>🔄 DINÁMICAS IDENTIFICADAS</h5>
                        <ul>
                            <li><strong>Dominación:</strong> Control patronal absoluto inicial</li>
                            <li><strong>Resistencia:</strong> Organización subterránea gradual</li>
                            <li><strong>Negociación:</strong> Diálogo forzado por presión externa</li>
                        </ul>
                    </div>
                    
                    <div class="analisis-item">
                        <h5>🎯 FACTORES DE CAMBIO</h5>
                        <ul>
                            <li><strong>Internos:</strong> Solidaridad trabajadora</li>
                            <li><strong>Externos:</strong> Presión mediática internacional</li>
                            <li><strong>Institucionales:</strong> Intervención PROFEDET</li>
                        </ul>
                    </div>
                </div>
                
                <div class="lecciones-caso">
                    <h5>💡 LECCIONES APRENDIDAS</h5>
                    <p>1. El poder nunca es absoluto: toda dominación genera resistencia.</p>
                    <p>2. La resistencia efectiva requiere organización y alianzas estratégicas.</p>
                    <p>3. La negociación exitosa necesita presión externa y debilidad interna del poder dominante.</p>
                    <p>4. Los cambios en relaciones de poder son procesos, no eventos aislados.</p>
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
                    <h3>Según Michel Foucault, ¿cuál es la naturaleza del poder?</h3>
                </div>
                
                <div class="quiz-options">
                    <button class="quiz-option" data-value="A">
                        <span class="option-letter">A</span>
                        Es una posesión que se adquiere y mantiene
                    </button>
                    <button class="quiz-option" data-value="B">
                        <span class="option-letter">B</span>
                        Se concentra exclusivamente en el Estado
                    </button>
                    <button class="quiz-option" data-value="C">
                        <span class="option-letter">C</span>
                        Es relacional y se ejerce en múltiples puntos
                    </button>
                    <button class="quiz-option" data-value="D">
                        <span class="option-letter">D</span>
                        Es esencialmente económico y material
                    </button>
                </div>
                
                <div class="quiz-feedback" style="display: none;">
                    <div class="feedback-correct">
                        ✅ <strong>Correcto:</strong> Foucault concibe el poder como relacional y difuso.
                    </div>
                    <div class="feedback-incorrect">
                        ❌ <strong>Incorrecto:</strong> Revisa la concepción foucaultiana del poder.
                    </div>
                    <div class="feedback-explicacion">
                        <p><strong>Explicación:</strong> Para Foucault, el poder "está en todas partes" porque "viene de todas partes". No es algo que se posee, sino que se ejerce en relaciones. Se manifiesta en instituciones, discursos y prácticas cotidianas, no solo en el Estado.</p>
                    </div>
                </div>
            </div>
            
            <!-- PREGUNTA 2 -->
            <div class="quiz-question" data-correct="D">
                <div class="quiz-header">
                    <span class="quiz-num">02</span>
                    <h3>¿Cuál es un ejemplo de "dominación simbólica" según Bourdieu?</h3>
                </div>
                
                <div class="quiz-options">
                    <button class="quiz-option" data-value="A">
                        <span class="option-letter">A</span>
                        Un ejército ocupando un territorio
                    </button>
                    <button class="quiz-option" data-value="B">
                        <span class="option-letter">B</span>
                        Un contrato laboral firmado
                    </button>
                    <button class="quiz-option" data-value="C">
                        <span class="option-letter">C</span>
                        Una protesta con enfrentamientos
                    </button>
                    <button class="quiz-option" data-value="D">
                        <span class="option-letter">D</span>
                        La naturalización de desigualdades sociales
                    </button>
                </div>
                
                <div class="quiz-feedback" style="display: none;">
                    <div class="feedback-correct">
                        ✅ <strong>Correcto:</strong> La dominación simbólica naturaliza las desigualdades.
                    </div>
                    <div class="feedback-incorrect">
                        ❌ <strong>Incorrecto:</strong> La dominación simbólica opera a nivel cultural.
                    </div>
                    <div class="feedback-explicacion">
                        <p><strong>Solución:</strong> La "violencia simbólica" de Bourdieu se refiere a la imposición de sistemas de significados que hacen parecer naturales las relaciones de dominación. Ejemplos: la meritocracia que justifica desigualdades, estereotipos de género que naturalizan roles, etc.</p>
                    </div>
                </div>
            </div>
            
            <!-- PREGUNTA 3 -->
            <div class="quiz-question" data-correct="B">
                <div class="quiz-header">
                    <span class="quiz-num">03</span>
                    <h3>En el ciclo dinámico del poder, ¿qué sucede usualmente después de la dominación?</h3>
                </div>
                
                <div class="quiz-options">
                    <button class="quiz-option" data-value="A">
                        <span class="option-letter">A</span>
                        Consolidación permanente del poder
                    </button>
                    <button class="quiz-option" data-value="B">
                        <span class="option-letter">B</span>
                        Emergencia de formas de resistencia
                    </button>
                    <button class="quiz-option" data-value="C">
                        <span class="option-letter">C</span>
                        Desaparición de las relaciones de poder
                    </button>
                    <button class="quiz-option" data-value="D">
                        <span class="option-letter">D</span>
                        Automatización de la obediencia
                    </button>
                </div>
                
                <div class="quiz-feedback" style="display: none;">
                    <div class="feedback-correct">
                        ✅ <strong>Correcto:</strong> Toda dominación genera resistencia.
                    </div>
                    <div class="feedback-incorrect">
                        ❌ <strong>Incorrecto:</strong> Revisa la dinámica relacional del poder.
                    </div>
                    <div class="feedback-explicacion">
                        <p><strong>Dato:</strong> Según la teoría crítica del poder, el ejercicio de dominación casi inevitablemente genera respuestas de resistencia, que pueden ser abiertas (protestas) o encubiertas (sabotaje cotidiano). Esta resistencia puede llevar posteriormente a negociación y reconfiguración de relaciones.</p>
                    </div>
                </div>
            </div>
        </div>
        
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
    </section>

    <!-- ERRORES COMUNES -->
    <section class="errores-section">
        <h2 class="seccion-titulo neon-alerta">
            <span class="icon">⚠️</span> ERRORES COMUNES Y SOLUCIONES
        </h2>
        
        <div class="errores-container">
            <div class="error-card">
                <div class="error-header" onclick="toggleError(this)">
                    <h3>❌ REDUCIR EL PODER A "DOMINACIÓN"</h3>
                    <span class="error-toggle">+</span>
                </div>
                <div class="error-content">
                    <div class="error-ejemplo">
                        <strong>Error común:</strong> "El poder es siempre opresivo y negativo"
                    </div>
                    <div class="error-correccion">
                        <strong>Corrección:</strong> Foucault distingue entre "poder" (relacional) y "dominación" (estructuras fijas). El poder también puede ser:
                        \\[
                        \\begin{aligned}
                        \\text{Poder productivo} &: \\text{Crea realidades, saberes, sujetos} \\\\
                        \\text{Poder pastoral} &: \\text{Cuidado, guía (ej: educación, salud)} \\\\
                        \\text{Poder biopolítico} &: \\text{Gestión de poblaciones (estadísticas, políticas)}
                        \\end{aligned}
                        \\]
                    </div>
                    <div class="error-practica">
                        <p><strong>Practica:</strong> Identifica ejemplos de poder: 1) Maestro que enseña, 2) Médico que cura, 3) Activista que organiza comunidad</p>
                        <button class="btn-mini" onclick="mostrarSolucion(1)">Ver solución</button>
                        <div class="solucion" id="solucion1" style="display: none;">
                            <strong>1) Maestro:</strong> Poder productivo (produce conocimiento, forma sujetos)<br>
                            <strong>2) Médico:</strong> Poder pastoral (cuidado, pero también control biopolítico)<br>
                            <strong>3) Activista:</strong> Poder contra-hegemónico (resiste pero también propone alternativas)
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="error-card">
                <div class="error-header" onclick="toggleError(this)">
                    <h3>❌ CONCEBIR LA RESISTENCIA COMO SIEMPRE "HEROICA" Y VISIBLE</h3>
                    <span class="error-toggle">+</span>
                </div>
                <div class="error-content">
                    <div class="error-ejemplo">
                        <strong>Error común:</strong> "Solo hay resistencia cuando hay protestas masivas o revoluciones"
                    </div>
                    <div class="error-correccion">
                        <strong>Corrección:</strong> James Scott identifica las "armas de los débiles":
                        <ul>
                            <li><strong>Resistencia cotidiana:</strong> Incumplimiento tácito, trabajo lento, "malentendidos"</li>
                            <li><strong>Transcripción oculta:</strong> Crítica fuera de la vista del poderoso</li>
                            <li><strong>Sabotaje sutil:</strong> Daños pequeños, pérdida de productividad</li>
                        </ul>
                    </div>
                    <div class="error-tabla">
                        <table>
                            <tr><th>Tipo resistencia</th><th>Ejemplo en fábrica</th><th>Ejemplo en escuela</th></tr>
                            <tr><td>Abierta/organizada</td><td>Huelga, paro</td><td>Protesta estudiantil</td></tr>
                            <tr><td>Cotidiana/individual</td><td>Trabajo lento, "errores"</td><td>Llegar tarde, "olvidar" tareas</td></tr>
                            <tr><td>Cultural/simbólica</td><td>Cultura obrera alternativa</td><td>Contracultura estudiantil</td></tr>
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
                    <h3>Análisis de Red de Poder en Universidad</h3>
                </div>
                <div class="problema-enunciado">
                    <p>Analiza las relaciones de poder en una <strong>universidad pública mexicana</strong> identificando:</p>
                    <ol>
                        <li><strong>Actores principales:</strong> Rectoría, consejo universitario, sindicato académico, sindicato administrativo, estudiantes, gobierno federal</li>
                        <li><strong>Tipos de poder ejercidos:</strong> Para cada actor, especifica si ejerce poder político, económico, cultural y/o personal</li>
                        <li><strong>Dinámicas predominantes:</strong> Identifica relaciones de dominación, resistencia y negociación entre actores</li>
                        <li><strong>Mecanismos específicos:</strong> Presupuesto, evaluaciones, acreditaciones, movilizaciones, negociaciones salariales</li>
                    </ol>
                    <p>Presenta tu análisis en forma de matriz y propón un diagrama de red de poder.</p>
                </div>
                <div class="problema-espacio">
                    <textarea placeholder="Escribe tu análisis de red de poder universitaria..." rows="10"></textarea>
                </div>
                <button class="btn-verificar" onclick="verificarProblema(1)">VERIFICAR SOLUCIÓN</button>
                <div class="problema-solucion" id="solucionP1" style="display: none;">
                    <strong>Análisis modelo universidad pública:</strong><br><br>
                    <strong>1. Matriz de actores y poder:</strong><br>
                    • <em>Rectoría:</em> Poder político (decisiones), económico (presupuesto), simbólico (representación)<br>
                    • <em>Consejo universitario:</em> Poder político colegiado, toma decisiones estratégicas<br>
                    • <em>Sindicato académico:</em> Poder de resistencia (huelgas), negociación (salarios)<br>
                    • <em>Estudiantes:</em> Poder de movilización, presión mediática, representación en consejos<br>
                    • <em>Gobierno federal (SEP):</em> Poder económico (subsidios), político (normatividad)<br><br>
                    
                    <strong>2. Dinámicas identificadas:</strong><br>
                    • <em>Dominación:</em> Rectoría sobre currículum, gobierno sobre presupuesto<br>
                    • <em>Resistencia:</em> Sindicatos contra recortes, estudiantes por derechos<br>
                    • <em>Negociación:</em> Contratos colectivos, aumento de matrícula, reformas estatutarias<br><br>
                    
                    <strong>3. Mecanismos clave:</strong><br>
                    • <em>Evaluación:</em> Control sobre académicos (SNI, PROMEP)<br>
                    • <em>Presupuesto:</em> Dependencia gubernamental limita autonomía<br>
                    • <em>Acreditación:</em> Poder de organismos externos (CENEVAL, COPAES)<br><br>
                    
                    <strong>4. Propuesta diagrama:</strong> Red centralizada con rectoría en centro, múltiples conexiones conflictivas y colaborativas según temas específicos.
                </div>
            </div>
            
            <div class="problema-card">
                <div class="problema-header">
                    <span class="problema-num">P2</span>
                    <h3>Diseño de Estrategia de Transformación de Poder</h3>
                </div>
                <div class="problema-enunciado">
                    <p>Diseña una estrategia para transformar relaciones de poder <strong>en una comunidad indígena marginalizada</strong> considerando:</p>
                    <ol>
                        <li><strong>Diagnóstico:</strong> Identifica actores, tipos de poder y dinámicas existentes</li>
                        <li><strong>Objetivos de transformación:</strong> Qué relaciones cambiar y hacia dónde</li>
                        <li><strong>Estrategias específicas:</strong> Por tipo de poder (político, económico, cultural)</li>
                        <li><strong>Actores aliados y opositores:</strong> Quiénes apoyarían u obstaculizarían</li>
                        <li><strong>Indicadores de éxito:</strong> Cómo medir cambios en relaciones de poder</li>
                    </ol>
                    <p>Considera especialmente mecanismos de resistencia y negociación efectivos.</p>
                </div>
                <div class="problema-espacio">
                    <textarea placeholder="Describe tu estrategia de transformación de poder..." rows="10"></textarea>
                </div>
                <button class="btn-verificar" onclick="verificarProblema(2)">VERIFICAR PROCEDIMIENTO</button>
                <div class="problema-solucion" id="solucionP2" style="display: none;">
                    <strong>Estrategia de transformación modelo:</strong><br><br>
                    <strong>1. Diagnóstico comunitario:</strong><br>
                    • <em>Actores externos dominantes:</em> Gobierno municipal, empresas extractivas, iglesias<br>
                    • <em>Actores internos:</em> Autoridades tradicionales, jóvenes, mujeres, ancianos<br>
                    • <em>Dinámicas:</em> Dependencia económica, discriminación cultural, exclusión política<br><br>
                    
                    <strong>2. Objetivos transformadores:</strong><br>
                    • De dominación externa a autonomía comunitaria<br>
                    • De exclusión a participación efectiva<br>
                    • De discriminación a reconocimiento cultural<br><br>
                    
                    <strong>3. Estrategias por tipo de poder:</strong><br>
                    • <em>Político:</em> Formación de líderes comunitarios, incidencia en políticas públicas<br>
                    • <em>Económico:</em> Cooperativas autogestivas, comercio justo, economía solidaria<br>
                    • <em>Cultural:</strong> Escuelas bilingües, revitalización lengua, turismo comunitario<br><br>
                    
                    <strong>4. Actores estratégicos:</strong><br>
                    • <em>Aliados:</em> ONGs de derechos humanos, universidades, medios alternativos<br>
                    • <em>Opositores:</em> Intereses empresariales, autoridades corruptas, grupos conservadores<br><br>
                    
                    <strong>5. Indicadores de cambio:</strong><br>
                    • Participación mujeres en decisiones: de 10% a 40%<br>
                    • Ingresos comunitarios autónomos: de 20% a 60%<br>
                    • Reconocimiento derechos en leyes locales<br>
                    • Reducción migración forzada juvenil<br><br>
                    
                    <strong>Mecanismos clave:</strong> Asambleas comunitarias, defensa legal estratégica, alianzas nacionales/internacionales, comunicación alternativa.
                </div>
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
                    <td>Identificación actores y poder</td>
                    <td>Reconoce actores formales e informales, múltiples tipos de poder</td>
                    <td>Identifica actores principales y algunos tipos de poder</td>
                    <td>Análisis superficial o incorrecto de actores/poder</td>
                </tr>
                <tr>
                    <td>Análisis dinámicas relacionales</td>
                    <td>Analiza dominación, resistencia y negociación con ejemplos concretos</td>
                    <td>Identifica algunas dinámicas pero sin profundizar</td>
                    <td>No diferencia dinámicas o las confunde</td>
                </tr>
                <tr>
                    <td>Propuestas transformación</td>
                    <td>Propone estrategias viables, diferenciadas por tipo de poder</td>
                    <td>Sugiere cambios generales sin mecanismos específicos</td>
                    <td>Propuestas inviables o contradictorias</td>
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
                    <label>Comprensión tipos de poder (Weber, Foucault, Bourdieu):</label>
                    <input type="range" min="1" max="5" value="3" class="autoeval-slider" id="slider1">
                    <div class="slider-labels">
                        <span>Básico</span><span>Intermedio</span><span>Avanzado</span>
                    </div>
                </div>
                
                <div class="slider-group">
                    <label>Análisis dinámicas (dominación, resistencia, negociación):</label>
                    <input type="range" min="1" max="5" value="3" class="autoeval-slider" id="slider2">
                    <div class="slider-labels">
                        <span>Básico</span><span>Intermedio</span><span>Avanzado</span>
                    </div>
                </div>
                
                <div class="slider-group">
                    <label>Aplicación a casos reales (laborales, sociales, políticos):</label>
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
                <h3>💭 REFLEXIÓN GUIADA</h3>
                <div class="pregunta-reflexion">
                    <p>Identifica tres relaciones de poder en tu vida cotidiana (familia, escuela, trabajo, etc.) y analiza qué tipo de poder se ejerce y qué dinámica predomina.</p>
                    <textarea placeholder="Escribe tu análisis aquí..." rows="4" id="reflexion1"></textarea>
                </div>
                <div class="pregunta-reflexion">
                    <p>¿Qué formas de resistencia son posibles cuando enfrentas relaciones de poder que consideras injustas? ¿Cuáles serían efectivas y por qué?</p>
                    <textarea placeholder="Escribe tu reflexión sobre resistencia..." rows="4" id="reflexion2"></textarea>
                </div>
            </div>
        </div>
        
        <div class="plan-estudio">
            <h3>📅 PLAN DE ESTUDIO RECOMENDADO</h3>
            <div class="plan-grid">
                <div class="plan-card">
                    <h4>🔄 REPASO RÁPIDO (15 min)</h4>
                    <ul>
                        <li>Memorizar 4 tipos de poder (político, económico, social, personal)</li>
                        <li>Recordar 3 dinámicas (dominación, resistencia, negociación)</li>
                        <li>Diferenciar Foucault, Weber, Bourdieu</li>
                    </ul>
                </div>
                <div class="plan-card">
                    <h4>💪 PRÁCTICA (30 min)</h4>
                    <ul>
                        <li>Analizar 5 casos de relaciones de poder cotidianas</li>
                        <li>Completar el simulador con diferentes escenarios</li>
                        <li>Resolver el quiz interactivo</li>
                    </ul>
                </div>
                <div class="plan-card">
                    <h4>🚀 PROFUNDIZACIÓN (45 min)</h4>
                    <ul>
                        <li>Leer textos clave: Foucault "Microfísica del poder"</li>
                        <li>Investigar movimientos sociales contemporáneos</li>
                        <li>Diseñar estrategias de transformación para casos específicos</li>
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="recursos">
            <h3>🔗 RECURSOS ADICIONALES</h3>
            <div class="recursos-links">
                <a href="https://www.marxists.org/espanol/foucault/" target="_blank" class="recurso-link">
                    📚 Foucault: Microfísica del poder (textos completos)
                </a>
                <a href="https://www.youtube.com/watch?v=0R2K_6ZkM8Q" target="_blank" class="recurso-link">
                    🎥 Bourdieu: Violencia simbólica (explicación animada)
                </a>
                <a href="https://www.jstor.org/journal/power" target="_blank" class="recurso-link">
                    📊 Journal of Power (artículos académicos)
                </a>
                <a href="https://powercube.net/" target="_blank" class="recurso-link">
                    🧩 Powercube: Herramientas para análisis de poder
                </a>
                <a href="https://www.aljazeera.com/program/featured-documentaries/" target="_blank" class="recurso-link">
                    📽️ Documentales: Movimientos sociales y resistencia
                </a>
            </div>
        </div>
    </section>

    <!-- JAVASCRIPT INTEGRADO -->
    <script>
    // ========================================
    // SIMULADOR DE REDES DE PODER DINÁMICAS
    // ========================================
    
    // Base de datos de escenarios
    const escenariosDB = {
        "empresa": {
            nombre: "Empresa Industrial",
            actores: ["Gerencia", "Sindicato", "Trabajadores", "Gobierno", "Clientes"],
            dinamica: "Mixta (predomina negociación con resistencia)",
            conflicto: "Moderado",
            mecanismos: "Contrato colectivo, huelgas, negociación salarial",
            transformacion: "Alta - Cambios contractuales frecuentes",
            nodos: [
                {id: "gerencia", x: 300, y: 100, tipo: "institucional", poder: 9, color: "#D32F2F"},
                {id: "sindicato", x: 150, y: 250, tipo: "colectivo", poder: 7, color: "#FF9800"},
                {id: "trabajadores", x: 300, y: 300, tipo: "colectivo", poder: 6, color: "#FF9800"},
                {id: "gobierno", x: 450, y: 250, tipo: "institucional", poder: 8, color: "#1976D2"},
                {id: "clientes", x: 300, y: 400, tipo: "individual", poder: 5, color: "#4CAF50"}
            ],
            conexiones: [
                {from: "gerencia", to: "trabajadores", tipo: "dominacion", fuerza: 8},
                {from: "sindicato", to: "gerencia", tipo: "resistencia", fuerza: 7},
                {from: "gobierno", to: "gerencia", tipo: "negociacion", fuerza: 6},
                {from: "trabajadores", to: "sindicato", tipo: "negociacion", fuerza: 8},
                {from: "clientes", to: "gerencia", tipo: "negociacion", fuerza: 5}
            ]
        },
        "universidad": {
            nombre: "Universidad Pública",
            actores: ["Rectoría", "Consejo Univ", "Sindicato Acad", "Estudiantes", "SEP"],
            dinamica: "Negociación institucionalizada",
            conflicto: "Bajo-Moderado",
            mecanismos: "Asambleas, contratos, evaluaciones, movilizaciones",
            transformacion: "Media - Cambios graduales",
            nodos: [
                {id: "rectoria", x: 300, y: 100, tipo: "institucional", poder: 8, color: "#D32F2F"},
                {id: "consejo", x: 150, y: 200, tipo: "institucional", poder: 7, color: "#1976D2"},
                {id: "sindicato", x: 450, y: 200, tipo: "colectivo", poder: 6, color: "#FF9800"},
                {id: "estudiantes", x: 300, y: 300, tipo: "colectivo", poder: 5, color: "#4CAF50"},
                {id: "sep", x: 300, y: 400, tipo: "institucional", poder: 9, color: "#9C27B0"}
            ],
            conexiones: [
                {from: "rectoria", to: "estudiantes", tipo: "dominacion", fuerza: 6},
                {from: "sep", to: "rectoria", tipo: "dominacion", fuerza: 7},
                {from: "sindicato", to: "rectoria", tipo: "negociacion", fuerza: 6},
                {from: "estudiantes", to: "rectoria", tipo: "resistencia", fuerza: 5},
                {from: "consejo", to: "rectoria", tipo: "negociacion", fuerza: 7}
            ]
        },
        "comunidad": {
            nombre: "Comunidad Rural",
            actores: ["Autoridades Trad", "Jóvenes", "Mujeres", "Empresa Externa", "Gob Mun"],
            dinamica: "Resistencia a dominación externa",
            conflicto: "Alto",
            mecanismos: "Asambleas, protestas, defensa legal, alianzas",
            transformacion: "Variable - Depende de organización",
            nodos: [
                {id: "autoridades", x: 300, y: 150, tipo: "institucional", poder: 7, color: "#9C27B0"},
                {id: "jovenes", x: 150, y: 250, tipo: "colectivo", poder: 5, color: "#FF9800"},
                {id: "mujeres", x: 300, y: 300, tipo: "colectivo", poder: 6, color: "#E91E63"},
                {id: "empresa", x: 450, y: 150, tipo: "institucional", poder: 8, color: "#D32F2F"},
                {id: "gobmun", x: 300, y: 400, tipo: "institucional", poder: 7, color: "#1976D2"}
            ],
            conexiones: [
                {from: "empresa", to: "autoridades", tipo: "dominacion", fuerza: 8},
                {from: "gobmun", to: "autoridades", tipo: "dominacion", fuerza: 7},
                {from: "jovenes", to: "empresa", tipo: "resistencia", fuerza: 6},
                {from: "mujeres", to: "autoridades", tipo: "resistencia", fuerza: 5},
                {from: "autoridades", to: "empresa", tipo: "negociacion", fuerza: 4}
            ]
        },
        "ciudad": {
            nombre: "Ciudad Metropolitana",
            actores: ["Gobierno Local", "Empresarios", "Medios", "ONGs", "Ciudadanos"],
            dinamica: "Compleja red de influencias",
            conflicto: "Moderado-Alto",
            mecanismos: "Lobby, medios, protestas, elecciones, corrupción",
            transformacion: "Baja-Media - Inercia institucional",
            nodos: [
                {id: "goblocal", x: 300, y: 100, tipo: "institucional", poder: 8, color: "#1976D2"},
                {id: "empresarios", x: 150, y: 200, tipo: "institucional", poder: 9, color: "#D32F2F"},
                {id: "medios", x: 450, y: 200, tipo: "institucional", poder: 7, color: "#FF9800"},
                {id: "ongs", x: 200, y: 350, tipo: "colectivo", poder: 6, color: "#4CAF50"},
                {id: "ciudadanos", x: 400, y: 350, tipo: "colectivo", poder: 5, color: "#9C27B0"}
            ],
            conexiones: [
                {from: "empresarios", to: "goblocal", tipo: "dominacion", fuerza: 8},
                {from: "medios", to: "goblocal", tipo: "negociacion", fuerza: 7},
                {from: "ongs", to: "empresarios", tipo: "resistencia", fuerza: 6},
                {from: "ciudadanos", to: "goblocal", tipo: "resistencia", fuerza: 5},
                {from: "goblocal", to: "medios", tipo: "negociacion", fuerza: 6}
            ]
        }
    };
    
    function simularRedPoder() {
        console.log("⚡ Simulando red de poder...");
        
        const escenario = document.getElementById(\'escenarioSelect\').value;
        const dinamica = document.getElementById(\'dinamicaSelect\').value;
        const intensidad = document.getElementById(\'intensidadPoder\').value;
        const checkboxes = document.querySelectorAll(\'input[name="actores"]:checked\');
        const actoresVisibles = Array.from(checkboxes).map(cb => cb.value);
        
        const data = escenariosDB[escenario];
        if (!data) {
            alert("⚠️ Escenario no encontrado");
            return;
        }
        
        // Filtrar nodos según actores visibles
        const nodosFiltrados = data.nodos.filter(nodo => {
            return actoresVisibles.includes(nodo.tipo);
        });
        
        // Actualizar visualización
        actualizarVisualizacionRed(nodosFiltrados, data.conexiones, dinamica, intensidad);
        
        // Actualizar datos de simulación
        document.getElementById(\'dataEscenario\').textContent = data.nombre;
        document.getElementById(\'dataActores\').textContent = data.actores.join(", ");
        document.getElementById(\'dataDinamica\').textContent = data.dinamica;
        document.getElementById(\'dataConflicto\').textContent = data.conflicto;
        document.getElementById(\'dataMecanismos\').textContent = data.mecanismos;
        document.getElementById(\'dataTransformacion\').textContent = data.transformacion;
        
        // Info adicional según dinámica
        let infoDinamica = "";
        if (dinamica === "dominacion") {
            infoDinamica = "Simulación con predominio de relaciones jerárquicas y control unilateral.";
        } else if (dinamica === "resistencia") {
            infoDinamica = "Simulación con alta conflictividad y acciones de oposición.";
        } else if (dinamica === "negociacion") {
            infoDinamica = "Simulación centrada en diálogo y búsqueda de acuerdos.";
        } else {
            infoDinamica = "Simulación con mezcla de todas las dinámicas relacionales.";
        }
        
        document.getElementById(\'infoRed\').textContent = 
            `Simulación: ${data.nombre} | ${infoDinamica} Intensidad: ${intensidad}/10`;
        
        console.log(`📊 Simulado: ${data.nombre} con dinámica ${dinamica}`);
    }
    
    function actualizarVisualizacionRed(nodos, conexiones, dinamica, intensidad) {
        const svg = document.getElementById(\'svgRed\');
        const redPoder = document.getElementById(\'redPoder\');
        const conexionesRed = document.getElementById(\'conexionesRed\');
        
        // Limpiar visualización anterior
        redPoder.innerHTML = \'\';
        conexionesRed.innerHTML = \'\';
        
        // Colores según dinámica
        const coloresDinamica = {
            "dominacion": "#D32F2F",
            "resistencia": "#FF9800",
            "negociacion": "#2196F3",
            "mixta": "#9C27B0"
        };
        const colorPrincipal = coloresDinamica[dinamica] || "#9C27B0";
        
        // Dibujar conexiones primero (para que queden detrás)
        conexiones.forEach(conexion => {
            const fromNode = nodos.find(n => n.id === conexion.from);
            const toNode = nodos.find(n => n.id === conexion.to);
            
            if (fromNode && toNode) {
                const line = document.createElementNS(\'http://www.w3.org/2000/svg\', \'line\');
                line.setAttribute(\'x1\', fromNode.x);
                line.setAttribute(\'y1\', fromNode.y);
                line.setAttribute(\'x2\', toNode.x);
                line.setAttribute(\'y2\', toNode.y);
                
                // Estilo según tipo de conexión
                let strokeColor = "#666";
                let strokeWidth = 1;
                
                if (conexion.tipo === "dominacion") {
                    strokeColor = "#D32F2F";
                    strokeWidth = conexion.fuerza / 3;
                } else if (conexion.tipo === "resistencia") {
                    strokeColor = "#FF9800";
                    strokeWidth = conexion.fuerza / 3;
                    // Línea discontinua para resistencia
                    line.setAttribute(\'stroke-dasharray\', \'5,3\');
                } else if (conexion.tipo === "negociacion") {
                    strokeColor = "#2196F3";
                    strokeWidth = conexion.fuerza / 3;
                }
                
                line.setAttribute(\'stroke\', strokeColor);
                line.setAttribute(\'stroke-width\', strokeWidth);
                line.setAttribute(\'opacity\', intensidad / 10);
                
                conexionesRed.appendChild(line);
            }
        });
        
        // Dibujar nodos
        nodos.forEach(nodo => {
            // Círculo del nodo
            const circle = document.createElementNS(\'http://www.w3.org/2000/svg\', \'circle\');
            circle.setAttribute(\'cx\', nodo.x);
            circle.setAttribute(\'cy\', nodo.y);
            circle.setAttribute(\'r\', 8 + (nodo.poder / 2)); // Tamaño según poder
            circle.setAttribute(\'fill\', nodo.color);
            circle.setAttribute(\'opacity\', \'0.8\');
            circle.setAttribute(\'class\', \'nodo-poder\');
            circle.setAttribute(\'data-id\', nodo.id);
            circle.setAttribute(\'data-tipo\', nodo.tipo);
            circle.setAttribute(\'data-poder\', nodo.poder);
            
            // Brillo según intensidad
            if (intensidad > 7) {
                circle.setAttribute(\'filter\', \'url(#glow)\');
            }
            
            // Texto del nodo
            const text = document.createElementNS(\'http://www.w3.org/2000/svg\', \'text\');
            text.setAttribute(\'x\', nodo.x);
            text.setAttribute(\'y\', nodo.y + 20);
            text.setAttribute(\'text-anchor\', \'middle\');
            text.setAttribute(\'fill\', \'white\');
            text.setAttribute(\'font-size\', \'9\');
            text.textContent = nodo.id.charAt(0).toUpperCase() + nodo.id.slice(1);
            
            // Valor de poder
            const powerText = document.createElementNS(\'http://www.w3.org/2000/svg\', \'text\');
            powerText.setAttribute(\'x\', nodo.x);
            powerText.setAttribute(\'y\', nodo.y - 15);
            powerText.setAttribute(\'text-anchor\', \'middle\');
            powerText.setAttribute(\'fill\', \'#39FF14\');
            powerText.setAttribute(\'font-size\', \'8\');
            powerText.setAttribute(\'font-weight\', \'bold\');
            powerText.textContent = nodo.poder;
            
            // Agrupar elementos del nodo
            const group = document.createElementNS(\'http://www.w3.org/2000/svg\', \'g\');
            group.appendChild(circle);
            group.appendChild(text);
            group.appendChild(powerText);
            
            // Evento click para mostrar info
            group.addEventListener(\'click\', function() {
                mostrarInfoNodo(nodo);
            });
            
            redPoder.appendChild(group);
        });
        
        // Animación de pulsación según intensidad
        if (intensidad > 5) {
            const circles = document.querySelectorAll(\'.nodo-poder\');
            circles.forEach((circle, index) => {
                circle.style.animation = `pulse ${2 - (index * 0.2)}s infinite`;
            });
        }
    }
    
    function mostrarInfoNodo(nodo) {
        const infoNodo = document.getElementById(\'infoNodo\');
        const tipos = {
            "institucional": "Institución formal",
            "colectivo": "Grupo organizado",
            "individual": "Actor individual",
            "informal": "Red informal"
        };
        
        document.getElementById(\'textoNodo\').textContent = 
            nodo.id.charAt(0).toUpperCase() + nodo.id.slice(1);
        document.getElementById(\'tipoNodo\').textContent = 
            `Tipo: ${tipos[nodo.tipo] || nodo.tipo}`;
        document.getElementById(\'poderNodo\').textContent = 
            `Poder: ${nodo.poder}/10`;
        
        infoNodo.style.opacity = \'1\';
        infoNodo.style.animation = \'pulse 2s\';
        
        // Ocultar después de 5 segundos
        setTimeout(() => {
            infoNodo.style.opacity = \'0\';
        }, 5000);
    }
    
    function escenarioAleatorio() {
        const escenarios = Object.keys(escenariosDB);
        const aleatorio = escenarios[Math.floor(Math.random() * escenarios.length)];
        document.getElementById(\'escenarioSelect\').value = aleatorio;
        
        // Configurar dinámica aleatoria
        const dinamicas = ["dominacion", "resistencia", "negociacion", "mixta"];
        const dinamicaAleatoria = dinamicas[Math.floor(Math.random() * dinamicas.length)];
        document.getElementById(\'dinamicaSelect\').value = dinamicaAleatoria;
        
        // Intensidad aleatoria
        const intensidadAleatoria = Math.floor(Math.random() * 10) + 1;
        document.getElementById(\'intensidadPoder\').value = intensidadAleatoria;
        
        document.getElementById(\'infoRed\').textContent = 
            `Escenario aleatorio: ${escenariosDB[aleatorio].nombre}. Haz clic en "SIMULAR RED".`;
    }
    
    function reiniciarSimulacion() {
        console.log("🔄 Reiniciando simulación de poder...");
        
        document.getElementById(\'escenarioSelect\').value = \'empresa\';
        document.getElementById(\'dinamicaSelect\').value = \'mixta\';
        document.getElementById(\'intensidadPoder\').value = 5;
        
        // Marcar todos los checkboxes
        document.querySelectorAll(\'input[name="actores"]\').forEach(cb => {
            cb.checked = true;
        });
        
        // Limpiar visualización
        document.getElementById(\'redPoder\').innerHTML = \'\';
        document.getElementById(\'conexionesRed\').innerHTML = \'\';
        document.getElementById(\'infoNodo\').style.opacity = \'0\';
        
        // Reiniciar datos
        document.getElementById(\'dataEscenario\').textContent = \'-\';
        document.getElementById(\'dataActores\').textContent = \'-\';
        document.getElementById(\'dataDinamica\').textContent = \'-\';
        document.getElementById(\'dataConflicto\').textContent = \'-\';
        document.getElementById(\'dataMecanismos\').textContent = \'-\';
        document.getElementById(\'dataTransformacion\').textContent = \'-\';
        
        document.getElementById(\'infoRed\').textContent = 
            "Selecciona un escenario y haz clic en \'SIMULAR RED\'";
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
            feedback = "🎉 ¡Excelente! Dominas las teorías del poder.";
        } else if (porcentaje >= 60) {
            feedback = "👍 Buen trabajo, pero revisa las diferencias entre Foucault, Weber y Bourdieu.";
        } else {
            feedback = "📚 Necesitas repasar los tipos y dinámicas del poder.";
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
    // SISTEMA DE ERRORES COMUNES
    // ========================================
    
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
    
    // ========================================
    // SISTEMA DE PROBLEMAS TIPO EXAMEN
    // ========================================
    
    function verificarProblema(num) {
        const solucion = document.getElementById(`solucionP${num}`);
        solucion.style.display = solucion.style.display === \'block\' ? \'none\' : \'block\';
    }
    
    // ========================================
    // SISTEMA DE AUTOEVALUACIÓN
    // ========================================
    
    function guardarAutoevaluacion() {
        const slider1 = document.getElementById(\'slider1\').value;
        const slider2 = document.getElementById(\'slider2\').value;
        const slider3 = document.getElementById(\'slider3\').value;
        
        const promedio = (parseInt(slider1) + parseInt(slider2) + parseInt(slider3)) / 3;
        
        alert(`📊 AutoEvaluación guardada:\\n\\n` +
              `Teorías del poder: ${slider1}/5\\n` +
              `Dinámicas relacionales: ${slider2}/5\\n` +
              `Aplicación a casos: ${slider3}/5\\n\\n` +
              `Promedio: ${promedio.toFixed(1)}/5\\n\\n` +
              `Revisa el plan de estudio recomendado según tus resultados.`);
        
        console.log(`💾 AutoEvaluación guardada: ${slider1}, ${slider2}, ${slider3}`);
    }
    
    // ========================================
    // INICIALIZACIÓN
    // ========================================
    
    console.log("🚀 Sistema Cyberpunk Educativo inicializado");
    console.log("⚡ Lección: Relaciones de Poder - Dominación, Resistencia y Negociación");
    console.log("🔄 Simulador de redes, Quiz y Herramientas interactivas listas");
    
    // Tipos de poder interactivos
    document.querySelectorAll(\'.tipo-poder-card\').forEach(card => {
        card.addEventListener(\'click\', function() {
            const tipo = this.dataset.tipo;
            
            // Mostrar información detallada
            const tiposInfo = {
                politico: "Poder político: Capacidad de tomar decisiones vinculantes. Según Weber, se basa en monopolio de violencia legítima. Tipos de dominación: tradicional (costumbres), carismática (líder), legal-racional (leyes).",
                economico: "Poder económico: Control sobre recursos materiales. Marx: poder de clase basado en propiedad medios producción. En capitalismo, poder empresarial sobre trabajadores, bancos sobre deudores, corporaciones sobre mercados.",
                social: "Poder social-cultural: Influencia sobre valores y significados. Bourdieu: capital cultural (educación) y simbólico (prestigio). Gramsci: hegemonía cultural (consenso más que coerción). Medios: agenda setting, framing.",
                personal: "Poder personal: Basado en características individuales. Weber: carisma como fuente de autoridad. Conocimiento experto: poder técnico-científico. Liderazgo: capacidad de convocatoria y persuasión."
            };
            
            alert(`⚡ ${this.querySelector(\'h4\').textContent}\\n\\n${tiposInfo[tipo] || "Información no disponible"}`);
        });
    });
    
    // Dinámicas del poder interactivas
    document.querySelectorAll(\'.dinamica-card\').forEach(card => {
        card.addEventListener(\'click\', function() {
            const dinamica = this.dataset.dinamica;
            
            // Mostrar información detallada
            const dinamicasInfo = {
                dominacion: "Dominación: Ejercicio unilateral de poder. Según Weber, dominación legítima requiere obediencia voluntaria. Tipos: tradicional (costumbres), carismática (líder), legal-racional (normas). Foucault: disciplina y biopoder.",
                resistencia: "Resistencia: Acciones que cuestionan poder establecido. James Scott: \'armas de los débiles\' (resistencia cotidiana). Foucault: donde hay poder hay resistencia. Formas: abierta (protestas), encubierta (sabotaje), cultural (contra-hegemonía).",
                negociacion: "Negociación: Proceso interactivo hacia acuerdos. Requiere reconocimiento mutuo de poder. Mecanismos: diálogo, mediación, concesiones. Contextos: relaciones laborales (contratos), políticas (pactos), internacionales (tratados)."
            };
            
            alert(`🔄 ${this.querySelector(\'h4\').textContent}\\n\\n${dinamicasInfo[dinamica] || "Información no disponible"}`);
        });
    });
    
    // Matriz interactiva
    document.querySelectorAll(\'.matriz-poder tbody tr\').forEach(row => {
        row.addEventListener(\'click\', function() {
            const ambito = this.dataset.ambito;
            const info = document.getElementById(\'infoMatriz\');
            
            const infoTextos = {
                laboral: "Ámbito laboral: Relaciones patrón-trabajador. Históricamente marcado por lucha de clases. Mecanismos actuales: contratos colectivos, huelgas, outsourcing, flexibilización laboral. Caso México: 35,000 sindicatos, tasa sindicalización 30%.",
                politico: "Ámbito político: Estado-ciudadanía. Weber: monopolio violencia legítima. Foucault: biopolítica y gubernamentalidad. Mecanismos: elecciones, protestas, medios, corrupción. México: transición democrática desde 2000, pero persistencia autoritarismos locales.",
                social: "Ámbito social: Relaciones entre grupos sociales. Bourdieu: reproducción desigualdades. Interseccionalidad: género, raza, clase. Movimientos: feminismo, antiracismo, diversidad sexual. México: discriminación estructural, movimientos como #NiUnaMenos.",
                cultural: "Ámbito cultural: Producción significados y valores. Gramsci: hegemonía cultural. Escuelas de Frankfurt: industria cultural. Resistencia: contracultura, arte político, medios alternativos. México: Movimiento zapatista como ejemplo de contra-hegemonía."
            };
            
            info.textContent = infoTextos[ambito] || "Información no disponible";
            info.style.animation = "highlight 0.5s";
            
            // Remover selección previa
            document.querySelectorAll(\'.matriz-poder tbody tr\').forEach(r => {
                r.classList.remove(\'selected\');
            });
            
            // Marcar fila seleccionada
            this.classList.add(\'selected\');
        });
    });
    
    // Caso de estudio interactivo
    document.querySelectorAll(\'.evento-tiempo\').forEach(evento => {
        evento.addEventListener(\'click\', function() {
            const fase = this.dataset.fase;
            const fecha = this.querySelector(\'.evento-fecha\').textContent;
            const titulo = this.querySelector(\'h5\').textContent;
            const contenido = this.querySelector(\'.evento-contenido\').innerHTML;
            
            alert(`📅 ${fecha}: ${titulo}\\n\\n${contenido.replace(/<[^>]*>/g, \'\\n\')}`);
        });
    });
    
    // Objetivos interactivos
    document.querySelectorAll(\'.objetivo-card\').forEach(card => {
        card.addEventListener(\'click\', function() {
            const completado = this.dataset.completado === \'true\';
            this.dataset.completado = !completado;
            const checkbox = this.querySelector(\'.objetivo-checkbox\');
            checkbox.textContent = !completado ? \'✓\' : \'\';
            checkbox.style.backgroundColor = !completado ? \'#39FF14\' : \'\';
        });
    });
    
    // Agregar filtro glow al SVG
    const svg = document.getElementById(\'svgRed\');
    const defs = document.createElementNS(\'http://www.w3.org/2000/svg\', \'defs\');
    const filter = document.createElementNS(\'http://www.w3.org/2000/svg\', \'filter\');
    filter.setAttribute(\'id\', \'glow\');
    filter.setAttribute(\'x\', \'-50%\');
    filter.setAttribute(\'y\', \'-50%\');
    filter.setAttribute(\'width\', \'200%\');
    filter.setAttribute(\'height\', \'200%\');
    
    const feGaussianBlur = document.createElementNS(\'http://www.w3.org/2000/svg\', \'feGaussianBlur\');
    feGaussianBlur.setAttribute(\'stdDeviation\', \'4\');
    feGaussianBlur.setAttribute(\'result\', \'coloredBlur\');
    
    const feMerge = document.createElementNS(\'http://www.w3.org/2000/svg\', \'feMerge\');
    const feMergeNode1 = document.createElementNS(\'http://www.w3.org/2000/svg\', \'feMergeNode\');
    feMergeNode1.setAttribute(\'in\', \'coloredBlur\');
    const feMergeNode2 = document.createElementNS(\'http://www.w3.org/2000/svg\', \'feMergeNode\');
    feMergeNode2.setAttribute(\'in\', \'SourceGraphic\');
    
    feMerge.appendChild(feMergeNode1);
    feMerge.appendChild(feMergeNode2);
    filter.appendChild(feGaussianBlur);
    filter.appendChild(feMerge);
    defs.appendChild(filter);
    svg.appendChild(defs);
    
    // Animación de pulsación para nodos
    const style = document.createElement(\'style\');
    style.textContent = `
    @keyframes pulse {
        0%, 100% { opacity: 0.8; }
        50% { opacity: 1; }
    }
    `;
    document.head.appendChild(style);
    </script>
</div>
<!-- FIN LECCIÓN CYBERPUNK -->',
    'ejercicios' => 
    array (
      0 => 
      array (
        'enunciado' => 'Poder es',
        'respuesta' => 'Capacidad de influir en otros',
      ),
      1 => 
      array (
        'enunciado' => 'Poder político ejemplo',
        'respuesta' => 'Gobierno, leyes',
      ),
      2 => 
      array (
        'enunciado' => 'Poder económico ejemplo',
        'respuesta' => 'Empresas, bancos',
      ),
      3 => 
      array (
        'enunciado' => 'Foucault: poder es',
        'respuesta' => 'Relacional y omnipresente',
      ),
      4 => 
      array (
        'enunciado' => 'Dominación es',
        'respuesta' => 'Control unilateral',
      ),
      5 => 
      array (
        'enunciado' => 'Resistencia es',
        'respuesta' => 'Oposición al poder',
      ),
      6 => 
      array (
        'enunciado' => 'Negociación es',
        'respuesta' => 'Acuerdo mutuo',
      ),
      7 => 
      array (
        'enunciado' => 'Ejemplo resistencia social',
        'respuesta' => 'Marchas, huelgas',
      ),
      8 => 
      array (
        'enunciado' => 'Poder cultural incluye',
        'respuesta' => 'Medios, educación',
      ),
      9 => 
      array (
        'enunciado' => 'México: poder empresarial',
        'respuesta' => 'CEMEX, Televisa',
      ),
      10 => 
      array (
        'enunciado' => 'Poder personal',
        'respuesta' => 'Liderazgo, conocimiento',
      ),
      11 => 
      array (
        'enunciado' => 'SI: poder blando',
        'respuesta' => 'Cultura, diplomacia',
      ),
    ),
    'quiz' => 
    array (
      0 => 
      array (
        'pregunta' => 'Poder es',
        'opciones' => 
        array (
          0 => 'Relacional',
          1 => 'Fijo',
          2 => 'Solo fuerza',
          3 => 'Nada',
        ),
        'correcta' => 'Relacional',
      ),
      1 => 
      array (
        'pregunta' => 'Foucault dice',
        'opciones' => 
        array (
          0 => 'Poder en todas partes',
          1 => 'Solo en gobierno',
          2 => 'Nada',
          3 => 'Solo dinero',
        ),
        'correcta' => 'Poder en todas partes',
      ),
      2 => 
      array (
        'pregunta' => 'Poder político',
        'opciones' => 
        array (
          0 => 'Estado',
          1 => 'Empresa',
          2 => 'Familia',
          3 => 'Amigos',
        ),
        'correcta' => 'Estado',
      ),
      3 => 
      array (
        'pregunta' => 'Poder económico',
        'opciones' => 
        array (
          0 => 'Monopolios',
          1 => 'Voto',
          2 => 'Cultura',
          3 => 'Religión',
        ),
        'correcta' => 'Monopolios',
      ),
      4 => 
      array (
        'pregunta' => 'Resistencia es',
        'opciones' => 
        array (
          0 => 'Oposición',
          1 => 'Apoyo',
          2 => 'Obediencia',
          3 => 'Silencio',
        ),
        'correcta' => 'Oposición',
      ),
      5 => 
      array (
        'pregunta' => 'Negociación busca',
        'opciones' => 
        array (
          0 => 'Equilibrio',
          1 => 'Dominación',
          2 => 'Guerra',
          3 => 'Nada',
        ),
        'correcta' => 'Equilibrio',
      ),
      6 => 
      array (
        'pregunta' => 'Poder productivo',
        'opciones' => 
        array (
          0 => 'Foucault',
          1 => 'Marx',
          2 => 'Weber',
          3 => 'Hobbes',
        ),
        'correcta' => 'Foucault',
      ),
      7 => 
      array (
        'pregunta' => 'Sindicato ejerce',
        'opciones' => 
        array (
          0 => 'Poder de resistencia',
          1 => 'Dominación',
          2 => 'Nada',
          3 => 'Gobierno',
        ),
        'correcta' => 'Poder de resistencia',
      ),
      8 => 
      array (
        'pregunta' => 'Medios tienen poder',
        'opciones' => 
        array (
          0 => 'Cultural',
          1 => 'Político',
          2 => 'Económico',
          3 => 'Personal',
        ),
        'correcta' => 'Cultural',
      ),
      9 => 
      array (
        'pregunta' => 'México: poder blando',
        'opciones' => 
        array (
          0 => 'Cultura (cine, música)',
          1 => 'Ejército',
          2 => 'Armas',
          3 => 'Nada',
        ),
        'correcta' => 'Cultura (cine, música)',
      ),
      10 => 
      array (
        'pregunta' => 'Dominación total',
        'opciones' => 
        array (
          0 => 'Rara (siempre resistencia)',
          1 => 'Común',
          2 => 'Ideal',
          3 => 'Necesaria',
        ),
        'correcta' => 'Rara (siempre resistencia)',
      ),
      11 => 
      array (
        'pregunta' => 'Poder legítimo',
        'opciones' => 
        array (
          0 => 'Weber: autoridad',
          1 => 'Fuerza',
          2 => 'Dinero',
          3 => 'Miedo',
        ),
        'correcta' => 'Weber: autoridad',
      ),
      12 => 
      array (
        'pregunta' => 'Huelga es',
        'opciones' => 
        array (
          0 => 'Resistencia',
          1 => 'Apoyo',
          2 => 'Obediencia',
          3 => 'Nada',
        ),
        'correcta' => 'Resistencia',
      ),
      13 => 
      array (
        'pregunta' => 'Contrato laboral',
        'opciones' => 
        array (
          0 => 'Negociación',
          1 => 'Dominación',
          2 => 'Guerra',
          3 => 'Silencio',
        ),
        'correcta' => 'Negociación',
      ),
      14 => 
      array (
        'pregunta' => 'Poder carismático',
        'opciones' => 
        array (
          0 => 'Líder personal',
          1 => 'Institución',
          2 => 'Dinero',
          3 => 'Ley',
        ),
        'correcta' => 'Líder personal',
      ),
      15 => 
      array (
        'pregunta' => 'Red de poder incluye',
        'opciones' => 
        array (
          0 => 'Todos los actores',
          1 => 'Solo gobierno',
          2 => 'Solo ricos',
          3 => 'Nada',
        ),
        'correcta' => 'Todos los actores',
      ),
      16 => 
      array (
        'pregunta' => 'México: poder sindical',
        'opciones' => 
        array (
          0 => 'CTM, SNTE',
          1 => 'Ninguno',
          2 => 'Solo empresas',
          3 => 'Gobierno',
        ),
        'correcta' => 'CTM, SNTE',
      ),
      17 => 
      array (
        'pregunta' => 'Poder disciplinario',
        'opciones' => 
        array (
          0 => 'Foucault (escuelas, cárceles)',
          1 => 'Marx',
          2 => 'Weber',
          3 => 'Hobbes',
        ),
        'correcta' => 'Foucault (escuelas, cárceles)',
      ),
      18 => 
      array (
        'pregunta' => 'SI 2025: poder digital',
        'opciones' => 
        array (
          0 => 'Redes sociales',
          1 => 'Solo TV',
          2 => 'Radio',
          3 => 'Periódicos',
        ),
        'correcta' => 'Redes sociales',
      ),
      19 => 
      array (
        'pregunta' => 'Poder es',
        'opciones' => 
        array (
          0 => 'Dinámico',
          1 => 'Estático',
          2 => 'Fijo',
          3 => 'Inmutable',
        ),
        'correcta' => 'Dinámico',
      ),
      20 => 
      array (
        'pregunta' => 'Resistencia pasiva',
        'opciones' => 
        array (
          0 => 'Desobediencia civil',
          1 => 'Violencia',
          2 => 'Guerra',
          3 => 'Apoyo',
        ),
        'correcta' => 'Desobediencia civil',
      ),
      21 => 
      array (
        'pregunta' => 'Poder simbólico',
        'opciones' => 
        array (
          0 => 'Bourdieu',
          1 => 'Foucault',
          2 => 'Marx',
          3 => 'Weber',
        ),
        'correcta' => 'Bourdieu',
      ),
      22 => 
      array (
        'pregunta' => 'México: reforma 2018',
        'opciones' => 
        array (
          0 => 'Cambio en relaciones de poder',
          1 => 'Igual',
          2 => 'Nada',
          3 => 'Retroceso',
        ),
        'correcta' => 'Cambio en relaciones de poder',
      ),
      23 => 
      array (
        'pregunta' => 'Movimiento #YoSoy132',
        'opciones' => 
        array (
          0 => 'Resistencia juvenil',
          1 => 'Apoyo',
          2 => 'Gobierno',
          3 => 'Empresa',
        ),
        'correcta' => 'Resistencia juvenil',
      ),
      24 => 
      array (
        'pregunta' => 'Poder económico global',
        'opciones' => 
        array (
          0 => 'Multinacionales',
          1 => 'Gobiernos locales',
          2 => 'Familias',
          3 => 'Escuelas',
        ),
        'correcta' => 'Multinacionales',
      ),
      25 => 
      array (
        'pregunta' => 'Negociación tripartita',
        'opciones' => 
        array (
          0 => 'Gobierno, empresa, sindicato',
          1 => 'Solo dos',
          2 => 'Uno',
          3 => 'Ninguno',
        ),
        'correcta' => 'Gobierno, empresa, sindicato',
      ),
      26 => 
      array (
        'pregunta' => 'Poder panóptico',
        'opciones' => 
        array (
          0 => 'Vigilancia constante',
          1 => 'Libertad',
          2 => 'Igualdad',
          3 => 'Nada',
        ),
        'correcta' => 'Vigilancia constante',
      ),
      27 => 
      array (
        'pregunta' => 'SI 2025: poder IA',
        'opciones' => 
        array (
          0 => 'Algoritmos influyen',
          1 => 'Nada',
          2 => 'Solo humanos',
          3 => 'Robots',
        ),
        'correcta' => 'Algoritmos influyen',
      ),
      28 => 
      array (
        'pregunta' => 'Equilibrio de poder',
        'opciones' => 
        array (
          0 => 'Estabilidad social',
          1 => 'Conflicto',
          2 => 'Guerra',
          3 => 'Caos',
        ),
        'correcta' => 'Estabilidad social',
      ),
      29 => 
      array (
        'pregunta' => 'Poder es',
        'opciones' => 
        array (
          0 => 'Productivo y represivo',
          1 => 'Solo represivo',
          2 => 'Solo bueno',
          3 => 'Nada',
        ),
        'correcta' => 'Productivo y represivo',
      ),
    ),
  ),
);
