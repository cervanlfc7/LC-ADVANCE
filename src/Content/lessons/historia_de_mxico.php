<?php
/**
 * Materia: Historia de México
 * Lecciones: 7
 */
return array (
  0 => 
  array (
    'materia' => 'Historia de México',
    'slug' => 'mexico-prehispanico',
    'titulo' => 'México Prehispánico: El Legado de Cuatro Civilizaciones',
    'contenido' => '<!-- INICIO LECCIÓN CYBERPUNK -->
<div class="leccion-container leccion-historia-mexico-prehispanico" data-tema="mexico-prehispanico">
    
    <!-- CABECERA CYBERPUNK -->
    <header class="leccion-header">
        <h1 class="titulo-leccion neon-glow">
            <span class="icon-tema">🌄</span>
            MÉXICO PREHISPÁNICO
        </h1>
        <div class="subtitulo">
            Olmecas, Teotihuacán, Maya y Azteca: Las Cuatro Columnas de Mesoamérica
        </div>
        <div class="badge-tiempo">
            <span class="badge">1500 a.C. - 1521 d.C.</span>
            <span class="badge">Mesoamérica</span>
            <span class="badge">4 Civilizaciones</span>
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
                <h3>Identificar características clave</h3>
                <p>Diferenciar las 4 civilizaciones por ubicación, periodo y aportes</p>
            </div>
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Analizar legados culturales</h3>
                <p>Reconocer elementos comunes: calendarios, escritura, agricultura</p>
            </div>
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Interpretar línea del tiempo</h3>
                <p>Comprender la secuencia cronológica y evolución cultural</p>
            </div>
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Evaluar impacto actual</h3>
                <p>Conectar civilizaciones prehispánicas con México contemporáneo</p>
            </div>
        </div>
    </section>

    <!-- CONTEXTO REAL -->
    <section class="contexto-real">
        <h2 class="seccion-titulo neon-dato">
            <span class="icon">🌍</span> CONEXIÓN CON EL PRESENTE
        </h2>
        <div class="contexto-grid">
            <div class="contexto-card">
                <h3>🏛️ Patrimonio Mundial UNESCO</h3>
                <p>35 sitios arqueológicos mexicanos reconocidos como Patrimonio de la Humanidad</p>
                <div class="dato-neon">>189 zonas arqueológicas abiertas</div>
            </div>
            <div class="contexto-card">
                <h3>🗣️ Lenguas Vivas</h3>
                <p>68 lenguas indígenas con 7 millones de hablantes en México actual</p>
                <div class="dato-neon">Raíz náhuatl-maya</div>
            </div>
            <div class="contexto-card">
                <h3>🌽 Agricultura Milenaria</h3>
                <p>Maíz, frijol, chile, calabaza domesticados y base alimentaria actual</p>
                <div class="dato-neon">5000 años de cultivo</div>
            </div>
        </div>
    </section>

    <!-- SECCIÓN TEÓRICA -->
    <section class="teoria-section">
        <div class="borde-neon-lateral"></div>
        <h2 class="seccion-titulo neon-concepto">
            <span class="icon">📚</span> LAS CUATRO COLUMNAS DE MESOAMÉRICA
        </h2>
        
        <!-- INTRODUCCIÓN -->
        <div class="subseccion">
            <h3>1. El Mosaico Cultural Prehispánico</h3>
            <div class="definicion-principal">
                <div class="def-card">
                    <h4>🌎 MESOAMÉRICA</h4>
                    <p>Región cultural que abarcó desde centro de México hasta Centroamérica, caracterizada por:</p>
                    <div class="caracteristicas-grid">
                        <div class="caracteristica">
                            <span class="caracteristica-icon">📅</span>
                            <span class="caracteristica-texto">Calendarios complejos</span>
                        </div>
                        <div class="caracteristica">
                            <span class="caracteristica-icon">🏛️</span>
                            <span class="caracteristica-texto">Arquitectura monumental</span>
                        </div>
                        <div class="caracteristica">
                            <span class="caracteristica-icon">📜</span>
                            <span class="caracteristica-texto">Sistemas de escritura</span>
                        </div>
                        <div class="caracteristica">
                            <span class="caracteristica-icon">🌽</span>
                            <span class="caracteristica-texto">Agricultura intensiva</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- TABLA COMPARATIVA INTERACTIVA -->
        <div class="subseccion">
            <h3>2. Civilizaciones en Perspectiva Comparada</h3>
            <div class="tabla-interactiva">
                <table class="tabla-cyberpunk">
                    <thead>
                        <tr>
                            <th>CIVILIZACIÓN</th>
                            <th>PERIODO</th>
                            <th>UBICACIÓN</th>
                            <th>APORTES CLAVE</th>
                            <th>SITIO ICÓNICO</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr data-civilizacion="olmeca" onclick="mostrarDetalleCivilizacion(\'olmeca\')">
                            <td><strong class="civilizacion-tag olmeca">OLMECAS</strong></td>
                            <td>1500-400 a.C.</td>
                            <td>Golfo de México (Veracruz, Tabasco)</td>
                            <td>Cabezas colosales, cultura madre, culto al jaguar</td>
                            <td>San Lorenzo, La Venta</td>
                        </tr>
                        <tr data-civilizacion="teotihuacan" onclick="mostrarDetalleCivilizacion(\'teotihuacan\')">
                            <td><strong class="civilizacion-tag teotihuacan">TEOTIHUACÁN</strong></td>
                            <td>200 a.C. - 650 d.C.</td>
                            <td>Valle de México</td>
                            <td>Urbanismo planificado, pirámides monumentales</td>
                            <td>Pirámide del Sol, Calzada de los Muertos</td>
                        </tr>
                        <tr data-civilizacion="maya" onclick="mostrarDetalleCivilizacion(\'maya\')">
                            <td><strong class="civilizacion-tag maya">MAYA</strong></td>
                            <td>250-900 d.C. (Clásico)</td>
                            <td>Penisínsula de Yucatán, Guatemala, Belice</td>
                            <td>Escritura jeroglífica, astronomía, matemáticas</td>
                            <td>Chichén Itzá, Palenque, Tikal</td>
                        </tr>
                        <tr data-civilizacion="azteca" onclick="mostrarDetalleCivilizacion(\'azteca\')">
                            <td><strong class="civilizacion-tag azteca">AZTECAS</strong></td>
                            <td>1325-1521 d.C.</td>
                            <td>Lago de Texcoco (Valle de México)</td>
                            <td>Tenochtitlán, chinampas, imperio tributario</td>
                            <td>Templo Mayor, Gran Tenochtitlán</td>
                        </tr>
                    </tbody>
                </table>
                <div class="tabla-info" id="infoCivilizacion">
                    Selecciona una civilización para ver detalles ampliados
                </div>
            </div>
            
            <!-- DETALLES DE CIVILIZACIONES -->
            <div class="civilizaciones-detalles">
                <div class="detalle-civilizacion" id="detalleOlmeca" style="display: none;">
                    <h4>🔍 Análisis Profundo: Cultura Olmeca</h4>
                    <div class="detalle-content">
                        <div class="detalle-columna">
                            <h5>🪨 Cabezas Colosales</h5>
                            <p>17 esculturas de basalto de 1.5 a 3.4 metros, pesan hasta 50 toneladas</p>
                            <div class="dato">Transporte: 100 km desde canteras</div>
                        </div>
                        <div class="detalle-columna">
                            <h5>🐆 Culto al Jaguar</h5>
                            <p>Deidad principal, símbolo de poder y conexión entre mundos</p>
                            <div class="dato">"Hombre-jaguar": transformación chamánica</div>
                        </div>
                        <div class="detalle-columna">
                            <h5>🌱 Legado Cultural</h5>
                            <p>Juego de pelota, escritura incipiente, calendario ritual</p>
                            <div class="dato">Influencia en todas las culturas posteriores</div>
                        </div>
                    </div>
                </div>
                
                <div class="detalle-civilizacion" id="detalleTeotihuacan" style="display: none;">
                    <h4>🔍 Análisis Profundo: Teotihuacán</h4>
                    <div class="detalle-content">
                        <div class="detalle-columna">
                            <h5>🏙️ Urbanismo Avanzado</h5>
                            <p>Ciudad planificada en cuadrícula, 20 km², 125,000-200,000 habitantes</p>
                            <div class="dato">Primera metrópolis de América</div>
                        </div>
                        <div class="detalle-columna">
                            <h5>☀️ Pirámide del Sol</h5>
                            <p>65 metros altura, 225 metros base, volumen: 1 millón m³</p>
                            <div class="dato">Alineada con puesta solar 29 de abril</div>
                        </div>
                        <div class="detalle-columna">
                            <h5>🎭 Multiculturalidad</h5>
                            <p>Barrios zapotecas, mayas, mixtecas; centro cosmopolita</p>
                            <div class="dato">Comercio a larga distancia: obsidiana, cacao</div>
                        </div>
                    </div>
                </div>
                
                <div class="detalle-civilizacion" id="detalleMaya" style="display: none;">
                    <h4>🔍 Análisis Profundo: Civilización Maya</h4>
                    <div class="detalle-content">
                        <div class="detalle-columna">
                            <h5>🔢 Matemáticas y Astronomía</h5>
                            <p>Sistema vigesimal, concepto del cero, observatorios astronómicos</p>
                            <div class="dato">Calendario: error 1 día cada 4000 años</div>
                        </div>
                        <div class="detalle-columna">
                            <h5>📜 Escritura Jeroglífica</h5>
                            <p>800 glifos, códices de amate, estelas narrativas</p>
                            <div class="dato">Único sistema de escritura completo de América</div>
                        </div>
                        <div class="detalle-columna">
                            <h5>⚽ Juego de Pelota</h5>
                            <p>Cancha I-shaped, pelota de hule, significado ritual y político</p>
                            <div class="dato">Representación del movimiento solar</div>
                        </div>
                    </div>
                </div>
                
                <div class="detalle-civilizacion" id="detalleAzteca" style="display: none;">
                    <h4>🔍 Análisis Profundo: Imperio Azteca</h4>
                    <div class="detalle-content">
                        <div class="detalle-columna">
                            <h5>🏙️ Tenochtitlán</h5>
                            <p>Ciudad lacustre, 13 km², 200,000 habitantes, acueductos, calzadas</p>
                            <div class="dato">Más poblada que París en 1500</div>
                        </div>
                        <div class="detalle-columna">
                            <h5>🛶 Chinampas</h5>
                            <p>Sistema agrícola intensivo: islas artificiales, 7 cosechas/año</p>
                            <div class="dato">Productividad: 20 toneladas/ha (maíz)</div>
                        </div>
                        <div class="detalle-columna">
                            <h5>📊 Sistema Tributario</h5>
                            <p>38 provincias tributarias, Triple Alianza (Tenochtitlán, Texcoco, Tlacopan)</p>
                            <div class="dato">Códice Mendosa: lista de tributos detallada</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- LEGADOS COMUNES -->
        <div class="subseccion">
            <h3>3. Legados Transculturales de Mesoamérica</h3>
            <div class="legados-grid">
                <div class="legado-card">
                    <div class="legado-icon">📅</div>
                    <h4>SISTEMAS CALENDÁRICOS</h4>
                    <div class="legado-desc">
                        Calendario ritual (260 días) + solar (365 días) = Rueda calendárica (52 años)
                    </div>
                    <div class="legado-datos">
                        <div class="dato"><strong>Precisión:</strong> Maya: 365.2420 días (real: 365.2422)</div>
                        <div class="dato"><strong>Ciclo:</strong> 18 meses × 20 días + 5 días "nefastos"</div>
                        <div class="dato"><strong>Uso:</strong> Agricultura, rituales, historia</div>
                    </div>
                </div>
                
                <div class="legado-card">
                    <div class="legado-icon">🌽</div>
                    <h4>REVOLUCIÓN AGRÍCOLA</h4>
                    <div class="legado-desc">
                        Domesticación de plantas que alimentaron al mundo
                    </div>
                    <div class="legado-datos">
                        <div class="dato"><strong>Maíz:</strong> Teosinte → 10,000 variedades</div>
                        <div class="dato"><strong>Técnicas:</strong> Chinampas, terrazas, irrigación</div>
                        <div class="dato"><strong>Dieta:</strong> Maíz, frijol, calabaza, chile</div>
                    </div>
                </div>
                
                <div class="legado-card">
                    <div class="legado-icon">🏛️</div>
                    <h4>ARQUITECTURA Y URBANISMO</h4>
                    <div class="legado-desc">
                        Pirámides escalonadas, observatorios, planificación urbana
                    </div>
                    <div class="legado-datos">
                        <div class="dato"><strong>Materiales:</strong> Piedra, estuco, pintura mural</div>
                        <div class="dato"><strong>Alineación:</strong> Solsticios, equinoccios</div>
                        <div class="dato"><strong>Funsión:</strong> Ceremonial, administrativa, residencial</div>
                    </div>
                </div>
                
                <div class="legado-card">
                    <div class="legado-icon">📜</div>
                    <h4>SISTEMAS DE REGISTRO</h4>
                    <div class="legado-desc">
                        Escritura, códices, glifos para historia, astronomía, tributos
                    </div>
                    <div class="legado-datos">
                        <div class="dato"><strong>Soportes:</strong> Piedra, piel, papel amate</div>
                        <div class="dato"><strong>Temas:</strong> Historia, genealogía, astronomía</div>
                        <div class="dato"><strong>Ejemplos:</strong> Códice Borgia, Dresden, Mendoza</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SIMULADOR INTERACTIVO: LÍNEA DEL TIEMPO -->
    <section class="simulator-section">
        <h2 class="seccion-titulo neon-interactivo">
            <span class="icon">🔄</span> SIMULADOR: LÍNEA DEL TIEMPO INTERACTIVA
        </h2>
        
        <div class="simulator-container" data-tema="linea-tiempo-prehispanica">
            <!-- PANEL DE CONTROLES -->
            <div class="simulator-controls">
                <h3>CONTROLES TEMPORALES</h3>
                
                <div class="control-group">
                    <label for="yearSlider">Año:</label>
                    <input type="range" id="yearSlider" min="-1500" max="1521" value="-1500" class="control-slider">
                    <div class="slider-value" id="yearValue">1500 a.C.</div>
                </div>
                
                <div class="control-group">
                    <label for="civilizacionSelect">Civilización:</label>
                    <select id="civilizacionSelect" class="control-select">
                        <option value="todas">Todas las civilizaciones</option>
                        <option value="olmeca">Olmecas (1500-400 a.C.)</option>
                        <option value="teotihuacan">Teotihuacán (200 a.C.-650 d.C.)</option>
                        <option value="maya">Maya Clásico (250-900 d.C.)</option>
                        <option value="azteca">Aztecas (1325-1521 d.C.)</option>
                    </select>
                </div>
                
                <div class="control-group">
                    <label for="tipoInfo">Información a mostrar:</label>
                    <div class="checkbox-group">
                        <label><input type="checkbox" name="tipoInfo" value="eventos" checked> Eventos históricos</label>
                        <label><input type="checkbox" name="tipoInfo" value="construcciones"> Construcciones</label>
                        <label><input type="checkbox" name="tipoInfo" value="logros"> Logros culturales</label>
                        <label><input type="checkbox" name="tipoInfo" value="conexiones"> Conexiones comerciales</label>
                    </div>
                </div>
                
                <button class="btn-animar" onclick="animarLineaTiempo()">
                    <span class="btn-icon">▶</span> ANIMAR LÍNEA
                </button>
                
                <button class="btn-reset" onclick="reiniciarLineaTiempo()">
                    <span class="btn-icon">🔄</span> REINICIAR
                </button>
            </div>
            
            <!-- VISUALIZACIÓN DE LÍNEA DEL TIEMPO -->
            <div class="simulator-visualization" id="visualizacionTiempo">
                <div class="timeline-container">
                    <svg viewBox="0 0 800 500" id="svgTimeline">
                        <!-- Fondo -->
                        <rect x="0" y="0" width="800" height="500" fill="#0a0a1a" id="fondoTimeline"/>
                        
                        <!-- Eje temporal -->
                        <line x1="50" y1="400" x2="750" y2="400" stroke="#39FF14" stroke-width="3" id="ejeTemporal"/>
                        
                        <!-- Marcas temporales -->
                        <g id="marcasTemporales">
                            <!-- Marcas cada 500 años -->
                            <line x1="100" y1="395" x2="100" y2="405" stroke="#39FF14" stroke-width="2"/>
                            <text x="100" y="425" fill="#39FF14" text-anchor="middle" font-size="12">1500 a.C.</text>
                            
                            <line x1="250" y1="395" x2="250" y2="405" stroke="#39FF14" stroke-width="2"/>
                            <text x="250" y="425" fill="#39FF14" text-anchor="middle" font-size="12">1000 a.C.</text>
                            
                            <line x1="400" y1="395" x2="400" y2="405" stroke="#39FF14" stroke-width="2"/>
                            <text x="400" y="425" fill="#39FF14" text-anchor="middle" font-size="12">500 a.C.</text>
                            
                            <line x1="550" y1="395" x2="550" y2="405" stroke="#39FF14" stroke-width="2"/>
                            <text x="550" y="425" fill="#39FF14" text-anchor="middle" font-size="12">0</text>
                            
                            <line x1="700" y1="395" x2="700" y2="405" stroke="#39FF14" stroke-width="2"/>
                            <text x="700" y="425" fill="#39FF14" text-anchor="middle" font-size="12">500 d.C.</text>
                        </g>
                        
                        <!-- Olmecas -->
                        <g id="periodoOlmeca" class="periodo-civilizacion" data-civilizacion="olmeca">
                            <rect x="100" y="350" width="150" height="40" rx="5" fill="#FF9800" opacity="0.7"/>
                            <text x="175" y="370" fill="white" text-anchor="middle" font-size="10">OLMECAS</text>
                            <text x="175" y="385" fill="#FFE0B2" text-anchor="middle" font-size="8">1500-400 a.C.</text>
                        </g>
                        
                        <!-- Teotihuacán -->
                        <g id="periodoTeotihuacan" class="periodo-civilizacion" data-civilizacion="teotihuacan">
                            <rect x="300" y="300" width="250" height="40" rx="5" fill="#2196F3" opacity="0.7"/>
                            <text x="425" y="320" fill="white" text-anchor="middle" font-size="10">TEOTIHUACÁN</text>
                            <text x="425" y="335" fill="#BBDEFB" text-anchor="middle" font-size="8">200 a.C.-650 d.C.</text>
                        </g>
                        
                        <!-- Maya Clásico -->
                        <g id="periodoMaya" class="periodo-civilizacion" data-civilizacion="maya">
                            <rect x="450" y="250" width="200" height="40" rx="5" fill="#F44336" opacity="0.7"/>
                            <text x="550" y="270" fill="white" text-anchor="middle" font-size="10">MAYA CLÁSICO</text>
                            <text x="550" y="285" fill="#FFCDD2" text-anchor="middle" font-size="8">250-900 d.C.</text>
                        </g>
                        
                        <!-- Aztecas -->
                        <g id="periodoAzteca" class="periodo-civilizacion" data-civilizacion="azteca">
                            <rect x="650" y="200" width="100" height="40" rx="5" fill="#9C27B0" opacity="0.7"/>
                            <text x="700" y="220" fill="white" text-anchor="middle" font-size="10">AZTECAS</text>
                            <text x="700" y="235" fill="#E1BEE7" text-anchor="middle" font-size="8">1325-1521 d.C.</text>
                        </g>
                        
                        <!-- Marcador de tiempo actual -->
                        <circle id="marcadorActual" cx="100" cy="400" r="8" fill="#FFFF00" stroke="#FF9800" stroke-width="2">
                            <animate id="animMarcador" attributeName="cx" dur="30s" fill="freeze"/>
                        </circle>
                        
                        <!-- Eventos clave -->
                        <g id="eventosTimeline" opacity="0.8">
                            <!-- Evento Olmeca -->
                            <g id="eventoOlmeca" data-year="-1200" data-civilizacion="olmeca">
                                <circle cx="130" cy="350" r="5" fill="#FF9800"/>
                                <text x="130" y="340" fill="#FF9800" text-anchor="middle" font-size="8">Cabezas colosales</text>
                            </g>
                            
                            <!-- Evento Teotihuacán -->
                            <g id="eventoTeotihuacan" data-year="150" data-civilizacion="teotihuacan">
                                <circle cx="350" cy="300" r="5" fill="#2196F3"/>
                                <text x="350" y="290" fill="#2196F3" text-anchor="middle" font-size="8">Pirámide del Sol</text>
                            </g>
                            
                            <!-- Evento Maya -->
                            <g id="eventoMaya" data-year="600" data-civilizacion="maya">
                                <circle cx="500" cy="250" r="5" fill="#F44336"/>
                                <text x="500" y="240" fill="#F44336" text-anchor="middle" font-size="8">Observatorio</text>
                            </g>
                            
                            <!-- Evento Azteca -->
                            <g id="eventoAzteca" data-year="1325" data-civilizacion="azteca">
                                <circle cx="680" cy="200" r="5" fill="#9C27B0"/>
                                <text x="680" y="190" fill="#9C27B0" text-anchor="middle" font-size="8">Fundación Tenochtitlán</text>
                            </g>
                        </g>
                        
                        <!-- Info en tiempo real -->
                        <rect x="50" y="50" width="700" height="100" rx="10" fill="rgba(0,0,0,0.8)" stroke="#39FF14" stroke-width="2"/>
                        <text x="400" y="80" fill="#39FF14" text-anchor="middle" font-size="16" id="textoPeriodo">1500 a.C.: Inicio Olmeca</text>
                        <text x="400" y="100" fill="#E0F7FA" text-anchor="middle" font-size="12" id="textoEvento">Cultura madre mesoamericana</text>
                        <text x="400" y="120" fill="#B2EBF2" text-anchor="middle" font-size="10" id="textoDetalle">Primeras cabezas colosales</text>
                    </svg>
                </div>
                <div class="timeline-info" id="infoTimeline">
                    Usa el slider o haz clic en "ANIMAR LÍNEA" para recorrer la historia
                </div>
            </div>
            
            <!-- DATOS EN TIEMPO REAL -->
            <div class="simulator-data">
                <h3>DATOS HISTÓRICOS</h3>
                
                <div class="data-card">
                    <div class="data-label">Año seleccionado:</div>
                    <div class="data-value" id="dataYear">1500 a.C.</div>
                </div>
                
                <div class="data-card">
                    <div class="data-label">Civilización activa:</div>
                    <div class="data-value" id="dataCivilizacion">Olmecas</div>
                </div>
                
                <div class="data-card">
                    <div class="data-label">Evento clave:</div>
                    <div class="data-value" id="dataEvento">Cabezas colosales</div>
                </div>
                
                <div class="data-card highlight">
                    <div class="data-label">APORTE CULTURAL:</div>
                    <div class="data-value" id="dataAporte">Escultura monumental</div>
                </div>
                
                <div class="data-card">
                    <div class="data-label">Sitio arqueológico:</div>
                    <div class="data-value" id="dataSitio">San Lorenzo</div>
                </div>
                
                <div class="data-card">
                    <div class="data-label">Población estimada:</div>
                    <div class="data-value" id="dataPoblacion">8,000 habitantes</div>
                </div>
                
                <div class="estadisticas">
                    <h4>📊 ESTADÍSTICAS COMPARATIVAS</h4>
                    <div class="stat-item">
                        <span>Duración Olmecas:</span>
                        <span class="stat-value">1100 años</span>
                    </div>
                    <div class="stat-item">
                        <span>Apogeo Teotihuacán:</span>
                        <span class="stat-value">200,000 hab</span>
                    </div>
                    <div class="stat-item">
                        <span>Ciudades mayas:</span>
                        <span class="stat-value">>40 ciudades-estado</span>
                    </div>
                    <div class="stat-item">
                        <span>Tenochtitlán 1519:</span>
                        <span class="stat-value">200,000 hab</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- QUIZ INTERACTIVO -->
    <section class="quiz-section">
        <h2 class="seccion-titulo neon-evaluacion">
            <span class="icon">❓</span> QUIZ: CONOCIMIENTO PREHISPÁNICO
        </h2>
        
        <div class="quiz-container">
            <!-- PREGUNTA 1 -->
            <div class="quiz-question" data-correct="C">
                <div class="quiz-header">
                    <span class="quiz-num">01</span>
                    <h3>¿Cuál fue el principal aporte cultural de los olmecas?</h3>
                </div>
                
                <div class="quiz-options">
                    <button class="quiz-option" data-value="A">
                        <span class="option-letter">A</span>
                        La chinampa como sistema agrícola
                    </button>
                    <button class="quiz-option" data-value="B">
                        <span class="option-letter">B</span>
                        El calendario solar de 365 días
                    </button>
                    <button class="quiz-option" data-value="C">
                        <span class="option-letter">C</span>
                        La escultura monumental y culto al jaguar
                    </button>
                    <button class="quiz-option" data-value="D">
                        <span class="option-letter">D</span>
                        La escritura jeroglífica completa
                    </button>
                </div>
                
                <div class="quiz-feedback" style="display: none;">
                    <div class="feedback-correct">
                        ✅ <strong>Correcto:</strong> Los olmecas destacaron por sus cabezas colosales y el culto al jaguar.
                    </div>
                    <div class="feedback-incorrect">
                        ❌ <strong>Incorrecto:</strong> Las chinampas son aztecas, el calendario solar es maya/azteca, la escritura completa es maya.
                    </div>
                    <div class="feedback-explicacion">
                        <p><strong>Explicación:</strong> Los olmecas (1500-400 a.C.) son considerados la "cultura madre" mesoamericana. Sus cabezas colosales de basalto (hasta 3.4 m, 50 toneladas) representan gobernantes y muestran avanzadas técnicas escultóricas.</p>
                    </div>
                </div>
            </div>
            
            <!-- PREGUNTA 2 -->
            <div class="quiz-question" data-correct="B">
                <div class="quiz-header">
                    <span class="quiz-num">02</span>
                    <h3>¿Qué civilización desarrolló el sistema de escritura más completo de Mesoamérica?</h3>
                </div>
                
                <div class="quiz-options">
                    <button class="quiz-option" data-value="A">
                        <span class="option-letter">A</span>
                        Olmeca
                    </button>
                    <button class="quiz-option" data-value="B">
                        <span class="option-letter">B</span>
                        Maya
                    </button>
                    <button class="quiz-option" data-value="C">
                        <span class="option-letter">C</span>
                        Teotihuacana
                    </button>
                    <button class="quiz-option" data-value="D">
                        <span class="option-letter">D</span>
                        Azteca
                    </button>
                </div>
                
                <div class="quiz-feedback" style="display: none;">
                    <div class="feedback-correct">
                        ✅ <strong>Correcto:</strong> Los mayas desarrollaron el único sistema de escritura completo de América.
                    </div>
                    <div class="feedback-incorrect">
                        ❌ <strong>Incorrecto:</strong> Los olmecas tenían glifos incipientes, teotihuacanos símbolos, aztecas pictografía.
                    </div>
                    <div class="feedback-explicacion">
                        <p><strong>Dato:</strong> La escritura maya incluía más de 800 glifos y podía representar cualquier idea. Se usaba en códices, estelas y cerámica para registrar historia, astronomía y genealogías reales.</p>
                    </div>
                </div>
            </div>
            
            <!-- PREGUNTA 3 -->
            <div class="quiz-question" data-correct="D">
                <div class="quiz-header">
                    <span class="quiz-num">03</span>
                    <h3>¿Cuál era la función principal de las chinampas aztecas?</h3>
                </div>
                
                <div class="quiz-options">
                    <button class="quiz-option" data-value="A">
                        <span class="option-letter">A</span>
                        Defensa militar de Tenochtitlán
                    </button>
                    <button class="quiz-option" data-value="B">
                        <span class="option-letter">B</span>
                        Sistema de drenaje del lago
                    </button>
                    <button class="quiz-option" data-value="C">
                        <span class="option-letter">C</span>
                        Cementerios para la nobleza
                    </button>
                    <button class="quiz-option" data-value="D">
                        <span class="option-letter">D</span>
                        Agricultura intensiva en el lago
                    </button>
                </div>
                
                <div class="quiz-feedback" style="display: none;">
                    <div class="feedback-correct">
                        ✅ <strong>Correcto:</strong> Las chinampas eran islas artificiales para cultivo intensivo.
                    </div>
                    <div class="feedback-incorrect">
                        ❌ <strong>Incorrecto:</strong> La defensa eran calzadas y canales, drenaje con diques, cementerios en templos.
                    </div>
                    <div class="feedback-explicacion">
                        <p><strong>Solución:</strong> Las chinampas permitían 7 cosechas anuales de maíz, frijol y flores. Su productividad (20 toneladas/ha) alimentaba a 200,000 habitantes de Tenochtitlán.</p>
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

    <!-- PROBLEMAS TIPO EXAMEN -->
    <section class="examen-section">
        <h2 class="seccion-titulo neon-evaluacion">
            <span class="icon">📝</span> ANÁLISIS HISTÓRICO
        </h2>
        
        <div class="examen-container">
            <div class="problema-card">
                <div class="problema-header">
                    <span class="problema-num">P1</span>
                    <h3>Análisis Comparativo de Civilizaciones</h3>
                </div>
                <div class="problema-enunciado">
                    <p>Completa la siguiente tabla comparativa con al menos tres características distintivas de cada civilización:</p>
                    
                    <table class="tabla-analisis">
                        <thead>
                            <tr>
                                <th>Civilización</th>
                                <th>Organización Política</th>
                                <th>Aporte Tecnológico</th>
                                <th>Legado Cultural</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>Olmecas</strong></td>
                                <td><textarea placeholder="Describe..." rows="2"></textarea></td>
                                <td><textarea placeholder="Describe..." rows="2"></textarea></td>
                                <td><textarea placeholder="Describe..." rows="2"></textarea></td>
                            </tr>
                            <tr>
                                <td><strong>Teotihuacán</strong></td>
                                <td><textarea placeholder="Describe..." rows="2"></textarea></td>
                                <td><textarea placeholder="Describe..." rows="2"></textarea></td>
                                <td><textarea placeholder="Describe..." rows="2"></textarea></td>
                            </tr>
                            <tr>
                                <td><strong>Mayas</strong></td>
                                <td><textarea placeholder="Describe..." rows="2"></textarea></td>
                                <td><textarea placeholder="Describe..." rows="2"></textarea></td>
                                <td><textarea placeholder="Describe..." rows="2"></textarea></td>
                            </tr>
                            <tr>
                                <td><strong>Aztecas</strong></td>
                                <td><textarea placeholder="Describe..." rows="2"></textarea></td>
                                <td><textarea placeholder="Describe..." rows="2"></textarea></td>
                                <td><textarea placeholder="Describe..." rows="2"></textarea></td>
                            </tr>
                        </tbody>
                    </table>
                    
                    <p><strong>Pregunta de reflexión:</strong> ¿Qué elemento cultural consideras que tuvo mayor impacto en el México actual y por qué?</p>
                </div>
                <div class="problema-espacio">
                    <textarea placeholder="Escribe tu reflexión aquí..." rows="4"></textarea>
                </div>
                <button class="btn-verificar" onclick="verificarProblema(1)">VERIFICAR SOLUCIÓN</button>
                <div class="problema-solucion" id="solucionP1" style="display: none;">
                    <strong>Posible solución:</strong><br>
                    • <strong>Olmecas:</strong> Jefaturas - Escultura monumental - Cultura madre mesoamericana<br>
                    • <strong>Teotihuacán:</strong> Estado teocrático - Urbanismo planificado - Primer metrópolis<br>
                    • <strong>Mayas:</strong> Ciudades-estado - Escritura y matemáticas - Calendario preciso<br>
                    • <strong>Aztecas:</strong> Imperio tributario - Chinampas - Tenochtitlán como modelo urbano<br><br>
                    <strong>Reflexión:</strong> La agricultura (maíz, chinampas) sostuvo poblaciones grandes y sigue siendo base alimentaria.
                </div>
            </div>
            
            <div class="problema-card">
                <div class="problema-header">
                    <span class="problema-num">P2</span>
                    <h3>Línea del Tiempo y Continuidad Cultural</h3>
                </div>
                <div class="problema-enunciado">
                    <p>Construye una línea del tiempo que muestre:</p>
                    <ol>
                        <li>Superposición temporal de las 4 civilizaciones</li>
                        <li>3 eventos clave de cada una</li>
                        <li>2 elementos de continuidad cultural entre ellas</li>
                    </ol>
                    
                    <div class="espacio-dibujo">
                        <p><em>Dibuja o describe tu línea del tiempo aquí:</em></p>
                        <textarea placeholder="Describe tu línea del tiempo con fechas y eventos..." rows="8"></textarea>
                    </div>
                    
                    <p><strong>Pregunta crítica:</strong> ¿Por qué algunas civilizaciones coexistieron temporalmente pero no desarrollaron contacto directo significativo?</p>
                </div>
                <div class="problema-espacio">
                    <textarea placeholder="Escribe tu análisis aquí..." rows="4"></textarea>
                </div>
                <button class="btn-verificar" onclick="verificarProblema(2)">VERIFICAR ANÁLISIS</button>
                <div class="problema-solucion" id="solucionP2" style="display: none;">
                    <strong>Línea del tiempo sugerida:</strong><br>
                    1500-400 a.C.: Olmecas (cabezas colosales, La Venta)<br>
                    200 a.C.-650 d.C.: Teotihuacán (pirámides, red comercial)<br>
                    250-900 d.C.: Maya clásico (escritura, ciudades)<br>
                    1325-1521 d.C.: Aztecas (Tenochtitlán, imperio)<br><br>
                    <strong>Continuidad:</strong> Calendario, juego de pelota, cultivo maíz<br>
                    <strong>Análisis:</strong> Distancias geográficas, especialización ecológica, diferencias temporales en auge.
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
                    <td>Precisión histórica</td>
                    <td>Datos exactos, fechas correctas, ejemplos específicos</td>
                    <td>Mayoría de datos correctos, algunos errores menores</td>
                    <td>Errores graves en información básica</td>
                </tr>
                <tr>
                    <td>Análisis comparativo</td>
                    <td>Identifica claramente similitudes y diferencias clave</td>
                    <td>Compara algunas características correctamente</td>
                    <td>No logra establecer comparaciones válidas</td>
                </tr>
                <tr>
                    <td>Reflexión crítica</td>
                    <td>Ofrece análisis profundo con conexiones al presente</td>
                    <td>Menciona algunas conexiones actuales</td>
                    <td>No relaciona pasado con presente</td>
                </tr>
            </table>
        </div>
    </section>

    <!-- CIERRE METACOGNITIVO -->
    <section class="cierre-section">
        <h2 class="seccion-titulo neon-concepto">
            <span class="icon">🧠</span> REFLEXIÓN Y CONEXIÓN CULTURAL
        </h2>
        
        <div class="cierre-container">
            <div class="autoevaluacion">
                <h3>📊 AUTOEVALUACIÓN DE CONOCIMIENTOS</h3>
                <div class="slider-group">
                    <label>Conocimiento de cronologías:</label>
                    <input type="range" min="1" max="5" value="3" class="autoeval-slider" id="slider1">
                    <div class="slider-labels">
                        <span>Básico</span><span>Intermedio</span><span>Avanzado</span>
                    </div>
                </div>
                
                <div class="slider-group">
                    <label>Diferenciación de civilizaciones:</label>
                    <input type="range" min="1" max="5" value="3" class="autoeval-slider" id="slider2">
                    <div class="slider-labels">
                        <span>Básico</span><span>Intermedio</span><span>Avanzado</span>
                    </div>
                </div>
                
                <div class="slider-group">
                    <label>Conexión pasado-presente:</label>
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
                    <p>¿Qué elemento del México prehispánico consideras que tiene mayor presencia en la cultura mexicana actual?</p>
                    <textarea placeholder="Escribe tu reflexión aquí..." rows="4" id="reflexion1"></textarea>
                </div>
                <div class="pregunta-reflexion">
                    <p>¿Cómo explicarías a alguien la importancia de estudiar estas civilizaciones antiguas?</p>
                    <textarea placeholder="Escribe tu explicación..." rows="4" id="reflexion2"></textarea>
                </div>
            </div>
        </div>
        
        <div class="plan-estudio">
            <h3>📅 PLAN DE ESTUDIO RECOMENDADO</h3>
            <div class="plan-grid">
                <div class="plan-card">
                    <h4>🔄 REPASO RÁPIDO (15 min)</h4>
                    <ul>
                        <li>Memorizar períodos clave de las 4 civilizaciones</li>
                        <li>Recordar 3 aportes distintivos de cada una</li>
                        <li>Identificar ubicaciones geográficas</li>
                    </ul>
                </div>
                <div class="plan-card">
                    <h4>💪 PRÁCTICA (30 min)</h4>
                    <ul>
                        <li>Completar línea del tiempo interactiva</li>
                        <li>Resolver el quiz de autoevaluación</li>
                        <li>Comparar sistemas políticos</li>
                    </ul>
                </div>
                <div class="plan-card">
                    <h4>🚀 PROFUNDIZACIÓN (45 min)</h4>
                    <ul>
                        <li>Investigar un sitio arqueológico específico</li>
                        <li>Analizar un códice prehispánico</li>
                        <li>Estudiar continuidades culturales actuales</li>
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="recursos">
            <h3>🔗 RECURSOS ADICIONALES</h3>
            <div class="recursos-links">
                <a href="https://www.inah.gob.mx/" target="_blank" class="recurso-link">
                    🏛️ INAH: Instituto Nacional de Antropología e Historia
                </a>
                <a href="https://www.mna.inah.gob.mx/" target="_blank" class="recurso-link">
                    🏺 Museo Nacional de Antropología (visita virtual)
                </a>
                <a href="https://www.azteccalendar.com/" target="_blank" class="recurso-link">
                    📅 Calculadora del calendario azteca
                </a>
                <a href="https://www.mayavase.com/" target="_blank" class="recurso-link">
                    🎨 Base de datos de cerámica maya
                </a>
            </div>
        </div>
    </section>

    <!-- JAVASCRIPT INTEGRADO -->
    <script>
    // ========================================
    // SISTEMA DE LÍNEA DEL TIEMPO INTERACTIVA
    // ========================================
    
    const timelineData = {
        "-1500": {
            civilizacion: "olmeca",
            evento: "Inicio cultura olmeca",
            detalle: "Primeras cabezas colosales en San Lorenzo",
            aporte: "Escultura monumental",
            sitio: "San Lorenzo",
            poblacion: "8,000 habitantes",
            color: "#FF9800"
        },
        "-1200": {
            civilizacion: "olmeca",
            evento: "Apogeo olmeca",
            detalle: "Cabezas colosales, culto al jaguar",
            aporte: "Cultura madre mesoamericana",
            sitio: "La Venta",
            poblacion: "18,000 habitantes",
            color: "#FF9800"
        },
        "-400": {
            civilizacion: "olmeca",
            evento: "Declive olmeca",
            detalle: "Abandono de centros ceremoniales",
            aporte: "Legado a culturas posteriores",
            sitio: "Tres Zapotes",
            poblacion: "5,000 habitantes",
            color: "#FF9800"
        },
        "200": {
            civilizacion: "teotihuacan",
            evento: "Fundación Teotihuacán",
            detalle: "Inicio construcción Pirámide del Sol",
            aporte: "Urbanismo planificado",
            sitio: "Teotihuacán",
            poblacion: "60,000 habitantes",
            color: "#2196F3"
        },
        "150": {
            civilizacion: "teotihuacan",
            evento: "Pirámide del Sol completada",
            detalle: "65 m altura, 225 m base",
            aporte: "Arquitectura monumental",
            sitio: "Teotihuacán",
            poblacion: "125,000 habitantes",
            color: "#2196F3"
        },
        "450": {
            civilizacion: "teotihuacan",
            evento: "Apogeo Teotihuacán",
            detalle: "200,000 habitantes, ciudad cosmopolita",
            aporte: "Red comercial mesoamericana",
            sitio: "Teotihuacán",
            poblacion: "200,000 habitantes",
            color: "#2196F3"
        },
        "250": {
            civilizacion: "maya",
            evento: "Inicio período clásico maya",
            detalle: "Desarrollo ciudades-estado",
            aporte: "Escritura jeroglífica",
            sitio: "Tikal",
            poblacion: "50,000 habitantes",
            color: "#F44336"
        },
        "600": {
            civilizacion: "maya",
            evento: "Apogeo astronómico maya",
            detalle: "Observatorios, calendario preciso",
            aporte: "Matemáticas y astronomía",
            sitio: "Palenque",
            poblacion: "100,000 habitantes",
            color: "#F44336"
        },
        "900": {
            civilizacion: "maya",
            evento: "Colapso clásico maya",
            detalle: "Abandono ciudades del sur",
            aporte: "Conocimiento preservado en códices",
            sitio: "Chichén Itzá",
            poblacion: "35,000 habitantes",
            color: "#F44336"
        },
        "1325": {
            civilizacion: "azteca",
            evento: "Fundación Tenochtitlán",
            detalle: "Señal del águila y el nopal",
            aporte: "Ciudad lacustre",
            sitio: "Tenochtitlán",
            poblacion: "20,000 habitantes",
            color: "#9C27B0"
        },
        "1428": {
            civilizacion: "azteca",
            evento: "Triple Alianza",
            detalle: "Tenochtitlán, Texcoco, Tlacopan",
            aporte: "Formación del imperio",
            sitio: "Tenochtitlán",
            poblacion: "150,000 habitantes",
            color: "#9C27B0"
        },
        "1500": {
            civilizacion: "azteca",
            evento: "Máxima expansión azteca",
            detalle: "38 provincias tributarias",
            aporte: "Sistema tributario complejo",
            sitio: "Gran Tenochtitlán",
            poblacion: "200,000 habitantes",
            color: "#9C27B0"
        },
        "1521": {
            civilizacion: "azteca",
            evento: "Caída de Tenochtitlán",
            detalle: "Conquista española, fin del imperio",
            aporte: "Síntesis cultural mestiza",
            sitio: "México-Tenochtitlán",
            poblacion: "30,000 habitantes",
            color: "#9C27B0"
        }
    };
    
    function actualizarTimeline() {
        const yearSlider = document.getElementById(\'yearSlider\');
        const year = parseInt(yearSlider.value);
        const yearDisplay = year < 0 ? `${Math.abs(year)} a.C.` : `${year} d.C.`;
        
        // Encontrar el dato más cercano
        let closestYear = Object.keys(timelineData)
            .map(y => parseInt(y))
            .reduce((prev, curr) => Math.abs(curr - year) < Math.abs(prev - year) ? curr : prev);
        
        const data = timelineData[closestYear] || timelineData["-1500"];
        
        // Actualizar marcador
        const marcador = document.getElementById(\'marcadorActual\');
        const xPos = 50 + ((year + 1500) / 3021) * 700; // Escala de -1500 a 1521
        marcador.setAttribute(\'cx\', xPos);
        
        // Actualizar textos
        document.getElementById(\'textoPeriodo\').textContent = `${yearDisplay}: ${data.evento}`;
        document.getElementById(\'textoEvento\').textContent = data.detalle;
        document.getElementById(\'textoDetalle\').textContent = `Civilización: ${data.civilizacion.toUpperCase()}`;
        
        // Actualizar datos en tiempo real
        document.getElementById(\'dataYear\').textContent = yearDisplay;
        document.getElementById(\'dataCivilizacion\').textContent = data.civilizacion.charAt(0).toUpperCase() + data.civilizacion.slice(1);
        document.getElementById(\'dataEvento\').textContent = data.evento;
        document.getElementById(\'dataAporte\').textContent = data.aporte;
        document.getElementById(\'dataSitio\').textContent = data.sitio;
        document.getElementById(\'dataPoblacion\').textContent = data.poblacion;
        
        // Resaltar civilización activa
        document.querySelectorAll(\'.periodo-civilizacion\').forEach(periodo => {
            periodo.setAttribute(\'opacity\', \'0.3\');
        });
        
        if (document.getElementById(`periodo${data.civilizacion.charAt(0).toUpperCase() + data.civilizacion.slice(1)}`)) {
            document.getElementById(`periodo${data.civilizacion.charAt(0).toUpperCase() + data.civilizacion.slice(1)}`).setAttribute(\'opacity\', \'1\');
        }
        
        document.getElementById(\'yearValue\').textContent = yearDisplay;
        
        console.log(`📅 Timeline actualizado: ${yearDisplay} - ${data.evento}`);
    }
    
    function animarLineaTiempo() {
        const yearSlider = document.getElementById(\'yearSlider\');
        const marcador = document.getElementById(\'marcadorActual\');
        
        // Animación del slider
        let year = -1500;
        const interval = setInterval(() => {
            year += 50;
            if (year > 1521) {
                clearInterval(interval);
                return;
            }
            
            yearSlider.value = year;
            actualizarTimeline();
        }, 100);
        
        console.log("🎬 Animando línea del tiempo...");
    }
    
    function reiniciarLineaTiempo() {
        console.log("🔄 Reiniciando línea del tiempo...");
        
        document.getElementById(\'yearSlider\').value = -1500;
        actualizarTimeline();
        
        document.getElementById(\'infoTimeline\').textContent = 
            "Línea del tiempo reiniciada al 1500 a.C. Usa el slider para explorar.";
    }
    
    // ========================================
    // SISTEMA DE DETALLES DE CIVILIZACIONES
    // ========================================
    
    function mostrarDetalleCivilizacion(civilizacion) {
        // Ocultar todos los detalles
        document.querySelectorAll(\'.detalle-civilizacion\').forEach(detalle => {
            detalle.style.display = \'none\';
        });
        
        // Mostrar el detalle seleccionado
        const detalle = document.getElementById(`detalle${civilizacion.charAt(0).toUpperCase() + civilizacion.slice(1)}`);
        if (detalle) {
            detalle.style.display = \'block\';
        }
        
        // Actualizar información de la tabla
        const infoTextos = {
            olmeca: "OLMECAS: Cultura madre (1500-400 a.C.). Cabezas colosales de basalto, culto al jaguar, influencia en todas las culturas posteriores. Sitios: San Lorenzo, La Venta, Tres Zapotes.",
            teotihuacan: "TEOTIHUACÁN: Primera metrópolis (200 a.C.-650 d.C.). Pirámides del Sol (65m) y la Luna, urbanismo planificado, población multiétnica. Red comercial continental.",
            maya: "MAYA: Civilización del clásico (250-900 d.C.). Única escritura completa de América, matemáticas con cero, calendario de precisión excepcional. Ciudades: Tikal, Palenque, Chichén Itzá.",
            azteca: "AZTECAS: Imperio tardío (1325-1521 d.C.). Tenochtitlán ciudad lacustre, chinampas agrícolas, sistema tributario complejo. 38 provincias bajo Triple Alianza."
        };
        
        document.getElementById(\'infoCivilizacion\').textContent = infoTextos[civilizacion] || "Información no disponible";
        document.getElementById(\'infoCivilizacion\').style.animation = "highlight 0.5s";
        
        // Remover selección previa
        document.querySelectorAll(\'.tabla-cyberpunk tbody tr\').forEach(tr => {
            tr.classList.remove(\'selected\');
        });
        
        // Marcar fila seleccionada
        document.querySelector(`[data-civilizacion="${civilizacion}"]`).classList.add(\'selected\');
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
            feedback = "🎉 ¡Excelente! Dominas el México prehispánico.";
        } else if (porcentaje >= 60) {
            feedback = "👍 Buen trabajo, pero revisa las diferencias clave entre civilizaciones.";
        } else {
            feedback = "📚 Necesitas repasar las características de cada civilización.";
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
    // SISTEMA DE AUTOEVALUACIÓN
    // ========================================
    
    function guardarAutoevaluacion() {
        const slider1 = document.getElementById(\'slider1\').value;
        const slider2 = document.getElementById(\'slider2\').value;
        const slider3 = document.getElementById(\'slider3\').value;
        
        const promedio = (parseInt(slider1) + parseInt(slider2) + parseInt(slider3)) / 3;
        
        alert(`📊 AutoEvaluación guardada:\\n\\n` +
              `Cronologías: ${slider1}/5\\n` +
              `Diferenciación: ${slider2}/5\\n` +
              `Conexión cultural: ${slider3}/5\\n\\n` +
              `Promedio: ${promedio.toFixed(1)}/5\\n\\n` +
              `Revisa el plan de estudio recomendado según tus resultados.`);
        
        console.log(`💾 AutoEvaluación guardada: ${slider1}, ${slider2}, ${slider3}`);
    }
    
    // ========================================
    // INICIALIZACIÓN
    // ========================================
    
    console.log("🚀 Sistema Cyberpunk Histórico inicializado");
    console.log("📚 Lección: México Prehispánico");
    console.log("⚡ Timeline interactiva, Quiz y Herramientas listas");
    
    // Inicializar timeline
    document.getElementById(\'yearSlider\').addEventListener(\'input\', actualizarTimeline);
    actualizarTimeline();
    
    // Tabla interactiva
    document.querySelectorAll(\'.tabla-cyberpunk tbody tr\').forEach(row => {
        row.addEventListener(\'click\', function() {
            const civilizacion = this.dataset.civilizacion;
            mostrarDetalleCivilizacion(civilizacion);
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
    
    // Problemas de examen
    function verificarProblema(num) {
        const solucion = document.getElementById(`solucionP${num}`);
        solucion.style.display = solucion.style.display === \'block\' ? \'none\' : \'block\';
    }
    </script>
</div>
<!-- FIN LECCIÓN CYBERPUNK -->',
    'ejercicios' => 
    array (
      0 => 
      array (
        'enunciado' => 'Civilización "cultura madre"',
        'respuesta' => 'Olmecas',
      ),
      1 => 
      array (
        'enunciado' => 'Pirámide del Sol en',
        'respuesta' => 'Teotihuacán',
      ),
      2 => 
      array (
        'enunciado' => 'Maya: escritura',
        'respuesta' => 'Jeroglífica',
      ),
      3 => 
      array (
        'enunciado' => 'Capital azteca',
        'respuesta' => 'Tenochtitlán',
      ),
      4 => 
      array (
        'enunciado' => 'Chinampas eran',
        'respuesta' => 'Agricultura flotante',
      ),
      5 => 
      array (
        'enunciado' => 'Calendario solar 365 días',
        'respuesta' => 'Azteca',
      ),
      6 => 
      array (
        'enunciado' => 'Teotihuacán: población estimada',
        'respuesta' => '~200,000',
      ),
      7 => 
      array (
        'enunciado' => 'Olmecas: símbolo',
        'respuesta' => 'Jaguar',
      ),
      8 => 
      array (
        'enunciado' => 'Maya: ciudad famosa',
        'respuesta' => 'Chichén Itzá',
      ),
      9 => 
      array (
        'enunciado' => 'Azteca: dios principal',
        'respuesta' => 'Huitzilopochtli',
      ),
      10 => 
      array (
        'enunciado' => 'Mesoamérica incluye',
        'respuesta' => 'Centro y sur de México',
      ),
      11 => 
      array (
        'enunciado' => 'SI: INAH protege',
        'respuesta' => '189 zonas arqueológicas',
      ),
    ),
    'quiz' => 
    array (
      0 => 
      array (
        'pregunta' => 'Cultura madre',
        'opciones' => 
        array (
          0 => 'Olmecas',
          1 => 'Maya',
          2 => 'Azteca',
          3 => 'Toltecas',
        ),
        'correcta' => 'Olmecas',
      ),
      1 => 
      array (
        'pregunta' => 'Pirámide del Sol',
        'opciones' => 
        array (
          0 => 'Teotihuacán',
          1 => 'Tenochtitlán',
          2 => 'Palenque',
          3 => 'Tikal',
        ),
        'correcta' => 'Teotihuacán',
      ),
      2 => 
      array (
        'pregunta' => 'Escritura jeroglífica',
        'opciones' => 
        array (
          0 => 'Maya',
          1 => 'Azteca',
          2 => 'Olmeca',
          3 => 'Teotihuacán',
        ),
        'correcta' => 'Maya',
      ),
      3 => 
      array (
        'pregunta' => 'Tenochtitlán sobre',
        'opciones' => 
        array (
          0 => 'Lago',
          1 => 'Montaña',
          2 => 'Desierto',
          3 => 'Costa',
        ),
        'correcta' => 'Lago',
      ),
      4 => 
      array (
        'pregunta' => 'Chinampas',
        'opciones' => 
        array (
          0 => 'Agricultura flotante',
          1 => 'Pirámides',
          2 => 'Escritura',
          3 => 'Guerra',
        ),
        'correcta' => 'Agricultura flotante',
      ),
      5 => 
      array (
        'pregunta' => 'Calendario 365 días',
        'opciones' => 
        array (
          0 => 'Azteca',
          1 => 'Maya',
          2 => 'Olmeca',
          3 => 'Inca',
        ),
        'correcta' => 'Azteca',
      ),
      6 => 
      array (
        'pregunta' => 'Cabezas colosales',
        'opciones' => 
        array (
          0 => 'Olmecas',
          1 => 'Maya',
          2 => 'Azteca',
          3 => 'Teotihuacán',
        ),
        'correcta' => 'Olmecas',
      ),
      7 => 
      array (
        'pregunta' => 'Teotihuacán: población',
        'opciones' => 
        array (
          0 => '~200,000',
          1 => '10,000',
          2 => '1M',
          3 => '500',
        ),
        'correcta' => '~200,000',
      ),
      8 => 
      array (
        'pregunta' => 'Maya: error calendario',
        'opciones' => 
        array (
          0 => '1 día/4000 años',
          1 => '1 día/año',
          2 => '1 día/mes',
          3 => 'Ninguno',
        ),
        'correcta' => '1 día/4000 años',
      ),
      9 => 
      array (
        'pregunta' => 'SI 2025: lenguas indígenas',
        'opciones' => 
        array (
          0 => '68',
          1 => '10',
          2 => '100',
          3 => '1',
        ),
        'correcta' => '68',
      ),
      10 => 
      array (
        'pregunta' => 'Olmecas en',
        'opciones' => 
        array (
          0 => 'Golfo',
          1 => 'Yucatán',
          2 => 'CDMX',
          3 => 'Oaxaca',
        ),
        'correcta' => 'Golfo',
      ),
      11 => 
      array (
        'pregunta' => 'Teotihuacán: pirámide mayor',
        'opciones' => 
        array (
          0 => 'Sol',
          1 => 'Luna',
          2 => 'Serpiente',
          3 => 'Jaguar',
        ),
        'correcta' => 'Sol',
      ),
      12 => 
      array (
        'pregunta' => 'Maya: Chichén Itzá',
        'opciones' => 
        array (
          0 => 'Yucatán',
          1 => 'Chiapas',
          2 => 'Tabasco',
          3 => 'Veracruz',
        ),
        'correcta' => 'Yucatán',
      ),
      13 => 
      array (
        'pregunta' => 'Azteca: dios guerra',
        'opciones' => 
        array (
          0 => 'Huitzilopochtli',
          1 => 'Quetzalcóatl',
          2 => 'Tlaloc',
          3 => 'Tezcatlipoca',
        ),
        'correcta' => 'Huitzilopochtli',
      ),
      14 => 
      array (
        'pregunta' => 'Calendario ritual',
        'opciones' => 
        array (
          0 => '260 días',
          1 => '365',
          2 => '52',
          3 => '18',
        ),
        'correcta' => '260 días',
      ),
      15 => 
      array (
        'pregunta' => 'Códices mayas',
        'opciones' => 
        array (
          0 => 'Dresde, Madrid, París',
          1 => 'Florentino',
          2 => 'Borbónico',
          3 => 'Mendoza',
        ),
        'correcta' => 'Dresde, Madrid, París',
      ),
      16 => 
      array (
        'pregunta' => 'Tenochtitlán > París',
        'opciones' => 
        array (
          0 => 'Sí (1500)',
          1 => 'No',
          2 => 'Igual',
          3 => 'Menos',
        ),
        'correcta' => 'Sí (1500)',
      ),
      17 => 
      array (
        'pregunta' => 'INAH: zonas abiertas',
        'opciones' => 
        array (
          0 => '189',
          1 => '50',
          2 => '500',
          3 => '10',
        ),
        'correcta' => '189',
      ),
      18 => 
      array (
        'pregunta' => 'Juego de pelota',
        'opciones' => 
        array (
          0 => 'Ritual',
          1 => 'Deporte',
          2 => 'Guerra',
          3 => 'Comercio',
        ),
        'correcta' => 'Ritual',
      ),
      19 => 
      array (
        'pregunta' => 'SI 2025: maíz domesticado',
        'opciones' => 
        array (
          0 => '9000 años México',
          1 => '500',
          2 => '100',
          3 => 'Europa',
        ),
        'correcta' => '9000 años México',
      ),
      20 => 
      array (
        'pregunta' => 'Olmecas: jaguar',
        'opciones' => 
        array (
          0 => 'Símbolo poder',
          1 => 'Comida',
          2 => 'Mascota',
          3 => 'Nada',
        ),
        'correcta' => 'Símbolo poder',
      ),
      21 => 
      array (
        'pregunta' => 'Teotihuacán: comercio',
        'opciones' => 
        array (
          0 => 'Obsidiana',
          1 => 'Oro',
          2 => 'Plata',
          3 => 'Cacao',
        ),
        'correcta' => 'Obsidiana',
      ),
      22 => 
      array (
        'pregunta' => 'Maya: cero matemático',
        'opciones' => 
        array (
          0 => 'Sí',
          1 => 'No',
          2 => 'Solo romanos',
          3 => 'Chinos',
        ),
        'correcta' => 'Sí',
      ),
      23 => 
      array (
        'pregunta' => 'Azteca: tributos',
        'opciones' => 
        array (
          0 => 'Plumas, cacao',
          1 => 'Oro',
          2 => 'Plata',
          3 => 'Caballos',
        ),
        'correcta' => 'Plumas, cacao',
      ),
      24 => 
      array (
        'pregunta' => 'Mesoamérica sin',
        'opciones' => 
        array (
          0 => 'Rueda (transporte)',
          1 => 'Caballos',
          2 => 'Hierro',
          3 => 'Todas',
        ),
        'correcta' => 'Todas',
      ),
      25 => 
      array (
        'pregunta' => 'Pirámide escalonada',
        'opciones' => 
        array (
          0 => 'Común',
          1 => 'Rara',
          2 => 'Solo maya',
          3 => 'Egipcia',
        ),
        'correcta' => 'Común',
      ),
      26 => 
      array (
        'pregunta' => 'Quetzalcóatl',
        'opciones' => 
        array (
          0 => 'Serpiente emplumada',
          1 => 'Sol',
          2 => 'Lluvia',
          3 => 'Guerra',
        ),
        'correcta' => 'Serpiente emplumada',
      ),
      27 => 
      array (
        'pregunta' => 'SI 2025: códices originales',
        'opciones' => 
        array (
          0 => '4 mayas',
          1 => '100',
          2 => '0',
          3 => '1000',
        ),
        'correcta' => '4 mayas',
      ),
      28 => 
      array (
        'pregunta' => 'Chichén Itzá: equinoccio',
        'opciones' => 
        array (
          0 => 'Serpiente baja',
          1 => 'Sube',
          2 => 'Nada',
          3 => 'Eclipse',
        ),
        'correcta' => 'Serpiente baja',
      ),
      29 => 
      array (
        'pregunta' => 'Mesoamérica: maíz, frijol, chile',
        'opciones' => 
        array (
          0 => 'Trilogía',
          1 => 'Solo maíz',
          2 => 'Arroz',
          3 => 'Trigo',
        ),
        'correcta' => 'Trilogía',
      ),
    ),
  ),
  1 => 
  array (
    'materia' => 'Historia de México',
    'slug' => 'la-conquista-cyberpunk',
    'titulo' => 'La Conquista: Cortés, Malinche y la Caída de Tenochtitlán (1519-1521)',
    'contenido' => '<!-- INICIO LECCIÓN CYBERPUNK -->
<div class="leccion-container leccion-historia-conquista" data-tema="conquista-mexico">
    <!-- CABECERA CYBERPUNK -->
    <header class="leccion-header">
        <h1 class="titulo-leccion neon-glow">
            <span class="icon-tema">⚔️</span> LA CONQUISTA CYBERPUNK
        </h1>
        <div class="subtitulo">
            Estrategias, alianzas y tecnología que cambiaron un imperio (1519-1521)
        </div>
    </header>

    <!-- PANEL OBJETIVOS -->
    <section class="panel-objetivos">
        <h2 class="seccion-titulo neon-concepto">
            <span class="icon">🎯</span> OBJETIVOS DE MISIÓN
        </h2>
        <div class="objetivos-grid">
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Analizar las etapas clave</h3>
                <p>Identificar fechas, eventos y actores principales.</p>
            </div>
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Evaluar factores de la victoria</h3>
                <p>Tecnología, alianzas, enfermedades y estrategia.</p>
            </div>
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Simular la ruta de Cortés</h3>
                <p>Usar el mapa interactivo para recrear la conquista.</p>
            </div>
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Reflexionar sobre el impacto</h3>
                <p>Consecuencias históricas y culturales.</p>
            </div>
        </div>
    </section>

    <!-- CONTEXTO REAL -->
    <section class="contexto-real">
        <h2 class="seccion-titulo neon-dato">
            <span class="icon">🌍</span> CONTEXTO HISTÓRICO (2025)
        </h2>
        <div class="contexto-grid">
            <div class="contexto-card">
                <h3>📊 Datos Clave</h3>
                <p><strong>504 años</strong> de la caída de Tenochtitlán (2025).</p>
                <p><strong>11 barcos</strong>, <strong>500 españoles</strong>, <strong>16 caballos</strong> vs. <strong>200,000 mexicas</strong>.</p>
                <div class="dato-neon">Epidemia de viruela: 50% mortalidad</div>
            </div>
            <div class="contexto-card">
                <h3>🔍 Controversias Modernas</h3>
                <p>Debate sobre el papel de <strong>Malinche</strong> (traición vs. supervivencia).</p>
                <p>Revisión crítica de fuentes: <strong>Códices vs. Cartas de Relación</strong>.</p>
                <div class="dato-neon">65% mexicanos con ascendencia indígena</div>
            </div>
            <div class="contexto-card">
                <h3>🎭 Representaciones Culturales</h3>
                <p>Películas, series y videojuegos que recrean la conquista.</p>
                <p>Ejemplo: <strong>"Assassin\'s Creed: Liberation"</strong> (Ubisoft).</p>
                <div class="dato-neon">+100 obras artísticas inspiradas</div>
            </div>
        </div>
    </section>

    <!-- SECCIÓN TEÓRICA -->
    <section class="teoria-section">
        <div class="borde-neon-lateral"></div>
        <h2 class="seccion-titulo neon-concepto">
            <span class="icon">📜</span> CRONOLOGÍA DE LA CONQUISTA
        </h2>

        <!-- ETAPAS CLAVE -->
        <div class="subseccion">
            <h3>1. Etapas de la Conquista (1519-1521)</h3>
            <div class="timeline-cyberpunk">
                <div class="timeline-item" data-fecha="feb-1519">
                    <div class="timeline-marker"></div>
                    <div class="timeline-content">
                        <h4>🌊 Febrero 1519: Llegada a Cozumel</h4>
                        <p>Primer contacto con mayas. Cortés recibe a <strong>Jerónimo de Aguilar</strong> (náufrago).</p>
                        <div class="timeline-dato">📅 18 Feb 1519</div>
                    </div>
                </div>
                <div class="timeline-item" data-fecha="abr-1519">
                    <div class="timeline-marker"></div>
                    <div class="timeline-content">
                        <h4>🏙️ Abril 1519: Fundación de Veracruz</h4>
                        <p>Primer asentamiento español. Cortés <strong>quema sus naves</strong> para evitar deserciones.</p>
                        <div class="timeline-dato">📅 21 Abr 1519</div>
                    </div>
                </div>
                <div class="timeline-item" data-fecha="nov-1519">
                    <div class="timeline-marker"></div>
                    <div class="timeline-content">
                        <h4>🏛️ Noviembre 1519: Entrada a Tenochtitlán</h4>
                        <p>Moctezuma recibe a Cortés. <strong>Malinche</strong> traduce y negocia.</p>
                        <div class="timeline-dato">📅 8 Nov 1519</div>
                    </div>
                </div>
                <div class="timeline-item" data-fecha="jun-1520">
                    <div class="timeline-marker"></div>
                    <div class="timeline-content">
                        <h4>💀 30 Junio 1520: Noche Triste</h4>
                        <p>Masacre en el Templo Mayor. <strong>600 españoles</strong> y miles de aliados mueren.</p>
                        <div class="timeline-dato">📅 30 Jun 1520</div>
                    </div>
                </div>
                <div class="timeline-item" data-fecha="ago-1521">
                    <div class="timeline-marker"></div>
                    <div class="timeline-content">
                        <h4>🔥 13 Agosto 1521: Caída de Tenochtitlán</h4>
                        <p>Tras <strong>75 días de sitio</strong>, Cuauhtémoc es capturado. Fin del imperio mexica.</p>
                        <div class="timeline-dato">📅 13 Ago 1521</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- FACTORES DE LA VICTORIA -->
        <div class="subseccion">
            <h3>2. Factores de la Victoria Española</h3>
            <div class="factores-grid">
                <div class="factor-card tecnologia">
                    <div class="factor-icon">🔫</div>
                    <h4>Tecnología Superior</h4>
                    <ul>
                        <li><strong>Armas de fuego</strong> (arcabuces).</li>
                        <li><strong>Acero</strong> (espadas vs. obsidiana).</li>
                        <li><strong>Caballos</strong> (impacto psicológico).</li>
                        <li><strong>Bergantines</strong> (control del lago).</li>
                    </ul>
                    <div class="factor-dato">📉 Ventaja: 90% en combate</div>
                </div>
                <div class="factor-card alianzas">
                    <div class="factor-icon">🤝</div>
                    <h4>Alianzas Indígenas</h4>
                    <ul>
                        <li><strong>Tlaxcala</strong> (enemigos de Tenochtitlán).</li>
                        <li><strong>Texcoco</strong> y <strong>Huejotzingo</strong>.</li>
                        <li><strong>200,000 aliados</strong> vs. 500 españoles.</li>
                    </ul>
                    <div class="factor-dato">🔄 80% del ejército de Cortés</div>
                </div>
                <div class="factor-card enfermedades">
                    <div class="factor-icon">🦠</div>
                    <h4>Enfermedades</h4>
                    <ul>
                        <li><strong>Viruela</strong> (1520): mató a <strong>Cuitláhuac</strong>.</li>
                        <li><strong>50% mortalidad</strong> en Tenochtitlán.</li>
                        <li>Debilitó resistencia mexica.</li>
                    </ul>
                    <div class="factor-dato">☠️ 3 millones de muertes</div>
                </div>
                <div class="factor-card estrategia">
                    <div class="factor-icon">🎯</div>
                    <h4>Estrategia Militar</h4>
                    <ul>
                        <li><strong>Sitio de 75 días</strong> (1521).</li>
                        <li>Destrucción de <strong>acueductos</strong>.</li>
                        <li>Uso de <strong>bergantines</strong> en el lago.</li>
                    </ul>
                    <div class="factor-dato">🏆 Victoria táctica</div>
                </div>
            </div>
        </div>

        <!-- PERSONAJES CLAVE -->
        <div class="subseccion">
            <h3>3. Personajes Clave</h3>
            <div class="personajes-grid">
                <div class="personaje-card cortes">
                    <div class="personaje-header">
                        <div class="personaje-icon">👑</div>
                        <h4>Hernán Cortés</h4>
                        <div class="personaje-subtitulo">Conquistador Extremeño</div>
                    </div>
                    <div class="personaje-datos">
                        <p><strong>Estratega</strong>: Usó división entre pueblos indígenas.</p>
                        <p><strong>Ambición</strong>: Buscaba oro y gloria.</p>
                        <p><strong>Controversia</strong>: ¿Héroe o villano?</p>
                    </div>
                    <div class="personaje-dato">📜 Cartas de Relación</div>
                </div>
                <div class="personaje-card malinche">
                    <div class="personaje-header">
                        <div class="personaje-icon">🗣️</div>
                        <h4>La Malinche</h4>
                        <div class="personaje-subtitulo">Intérprete y Consejera</div>
                    </div>
                    <div class="personaje-datos">
                        <p><strong>Nahua</strong>: Hablaba maya y náhuatl.</p>
                        <p><strong>Clave</strong>: Traductora y negociadora.</p>
                        <p><strong>Legado</strong>: Símbolo de mestizaje.</p>
                    </div>
                    <div class="personaje-dato">🌎 "La Lengua de Cortés"</div>
                </div>
                <div class="personaje-card moctezuma">
                    <div class="personaje-header">
                        <div class="personaje-icon">👑</div>
                        <h4>Moctezuma Xocoyotzin</h4>
                        <div class="personaje-subtitulo">Huey Tlatoani</div>
                    </div>
                    <div class="personaje-datos">
                        <p><strong>Gobernante</strong>: Reinó durante la llegada de Cortés.</p>
                        <p><strong>Duda</strong>: ¿Creía que Cortés era Quetzalcóatl?</p>
                        <p><strong>Fin</strong>: Muere en 1520 (asesinado).</p>
                    </div>
                    <div class="personaje-dato">🏛️ Último gran tlatoani</div>
                </div>
                <div class="personaje-card cuauhtemoc">
                    <div class="personaje-header">
                        <div class="personaje-icon">⚔️</div>
                        <h4>Cuauhtémoc</h4>
                        <div class="personaje-subtitulo">Último Tlatoani</div>
                    </div>
                    <div class="personaje-datos">
                        <p><strong>Resistencia</strong>: Lideró la defensa final.</p>
                        <p><strong>Captura</strong>: Torturado por Cortés.</p>
                        <p><strong>Legado</strong>: Símbolo de resistencia.</p>
                    </div>
                    <div class="personaje-dato">🔥 "El Águila que Cayó"</div>
                </div>
            </div>
        </div>
    </section>

    <!-- SIMULADOR INTERACTIVO -->
    <section class="simulator-section">
        <h2 class="seccion-titulo neon-interactivo">
            <span class="icon">🎮</span> SIMULADOR: RUTA DE CORTÉS
        </h2>
        <div class="simulator-container" data-tema="ruta-conquista">
            <!-- PANEL DE CONTROLES -->
            <div class="simulator-controls">
                <h3>⚙️ CONTROLES</h3>
                <div class="control-group">
                    <label for="etapaSelect">Etapa:</label>
                    <select id="etapaSelect" class="control-input">
                        <option value="cozumel">Feb 1519: Cozumel</option>
                        <option value="veracruz">Abr 1519: Veracruz</option>
                        <option value="tlaxcala">Sep 1519: Tlaxcala</option>
                        <option value="tenochtitlan">Nov 1519: Tenochtitlán</option>
                        <option value="noche-triste">Jun 1520: Noche Triste</option>
                        <option value="sitio">May 1521: Sitio Final</option>
                        <option value="caida">Ago 1521: Caída</option>
                    </select>
                </div>
                <div class="control-group">
                    <label for="velocidad">Velocidad:</label>
                    <input type="range" id="velocidad" min="1" max="10" value="5" class="control-slider">
                </div>
                <button class="btn-iniciar" onclick="iniciarSimulacion()">
                    <span class="btn-icon">▶️</span> INICIAR SIMULACIÓN
                </button>
                <button class="btn-reiniciar" onclick="reiniciarSimulacion()">
                    <span class="btn-icon">🔄</span> REINICIAR
                </button>
            </div>

            <!-- VISUALIZACIÓN -->
            <div class="simulator-visualization">
                <div class="mapa-container">
                    <svg id="mapaConquista" viewBox="0 0 800 500" xmlns="http://www.w3.org/2000/svg">
                        <!-- Fondo -->
                        <rect x="0" y="0" width="800" height="500" fill="#0a0a1a"/>

                        <!-- Ruta base -->
                        <path id="rutaBase" d="M100,300 Q250,250 400,300 Q550,350 700,300" fill="none" stroke="#444" stroke-width="30" opacity="0.3"/>

                        <!-- Puntos clave -->
                        <g id="cozumel" class="punto-mapa" data-etapa="cozumel">
                            <circle cx="100" cy="300" r="15" fill="#FF5252" opacity="0.5"/>
                            <text x="100" y="270" fill="#FFCDD2" font-size="12" text-anchor="middle">Cozumel</text>
                            <text x="100" y="340" fill="#FFCDD2" font-size="10" text-anchor="middle">Feb 1519</text>
                        </g>
                        <g id="veracruz" class="punto-mapa" data-etapa="veracruz">
                            <circle cx="200" cy="250" r="15" fill="#4CAF50" opacity="0.5"/>
                            <text x="200" y="220" fill="#A5D6A7" font-size="12" text-anchor="middle">Veracruz</text>
                            <text x="200" y="290" fill="#A5D6A7" font-size="10" text-anchor="middle">Abr 1519</text>
                        </g>
                        <g id="tlaxcala" class="punto-mapa" data-etapa="tlaxcala">
                            <circle cx="400" cy="200" r="15" fill="#FF9800" opacity="0.5"/>
                            <text x="400" y="170" fill="#FFE0B2" font-size="12" text-anchor="middle">Tlaxcala</text>
                            <text x="400" y="240" fill="#FFE0B2" font-size="10" text-anchor="middle">Sep 1519</text>
                        </g>
                        <g id="tenochtitlan" class="punto-mapa" data-etapa="tenochtitlan">
                            <circle cx="600" cy="300" r="20" fill="#D32F2F" opacity="0.5"/>
                            <text x="600" y="270" fill="#FFCDD2" font-size="12" text-anchor="middle">Tenochtitlán</text>
                            <text x="600" y="340" fill="#FFCDD2" font-size="10" text-anchor="middle">Nov 1519</text>
                        </g>
                        <g id="noche-triste" class="punto-mapa" data-etapa="noche-triste">
                            <circle cx="550" cy="350" r="15" fill="#7B1FA2" opacity="0.5"/>
                            <text x="550" y="320" fill="#CE93D8" font-size="12" text-anchor="middle">Noche Triste</text>
                            <text x="550" y="390" fill="#CE93D8" font-size="10" text-anchor="middle">Jun 1520</text>
                        </g>
                        <g id="sitio" class="punto-mapa" data-etapa="sitio">
                            <circle cx="650" cy="250" r="15" fill="#FF5252" opacity="0.5"/>
                            <text x="650" y="220" fill="#FFCDD2" font-size="12" text-anchor="middle">Sitio</text>
                            <text x="650" y="290" fill="#FFCDD2" font-size="10" text-anchor="middle">May 1521</text>
                        </g>
                        <g id="caida" class="punto-mapa" data-etapa="caida">
                            <circle cx="700" cy="300" r="20" fill="#B71C1C" opacity="0.5"/>
                            <text x="700" y="270" fill="#FFCDD2" font-size="12" text-anchor="middle">Caída</text>
                            <text x="700" y="340" fill="#FFCDD2" font-size="10" text-anchor="middle">Ago 1521</text>
                        </g>

                        <!-- Ruta animada -->
                        <path id="rutaAnimada" d="M100,300 Q250,250 400,300 Q550,350 700,300" fill="none" stroke="#39FF14" stroke-width="5" stroke-dasharray="1000" stroke-dashoffset="1000">
                            <animate id="animRuta" attributeName="stroke-dashoffset" values="1000;0" dur="10s" begin="indefinite" fill="freeze"/>
                        </path>

                        <!-- Leyenda -->
                        <rect x="50" y="400" width="700" height="80" fill="rgba(0,0,0,0.7)" rx="10"/>
                        <text x="400" y="430" fill="#39FF14" font-size="16" text-anchor="middle">RUTA DE LA CONQUISTA (1519-1521)</text>
                        <text x="400" y="460" fill="#E0E0E0" font-size="12" text-anchor="middle" id="leyendaTexto">Selecciona una etapa y haz clic en "INICIAR SIMULACIÓN"</text>
                    </svg>
                </div>
            </div>

            <!-- DATOS EN TIEMPO REAL -->
            <div class="simulator-data">
                <h3>📊 DATOS HISTÓRICOS</h3>
                <div class="data-card">
                    <div class="data-label">Etapa:</div>
                    <div class="data-value" id="dataEtapa">—</div>
                </div>
                <div class="data-card">
                    <div class="data-label">Fecha:</div>
                    <div class="data-value" id="dataFecha">—</div>
                </div>
                <div class="data-card">
                    <div class="data-label">Evento:</div>
                    <div class="data-value" id="dataEvento">—</div>
                </div>
                <div class="data-card highlight">
                    <div class="data-label">Impacto:</div>
                    <div class="data-value" id="dataImpacto">—</div>
                </div>
                <div class="data-card">
                    <div class="data-label">Fuerzas:</div>
                    <div class="data-value" id="dataFuerzas">—</div>
                </div>
                <div class="data-card">
                    <div class="data-label">Aliados:</div>
                    <div class="data-value" id="dataAliados">—</div>
                </div>
            </div>
        </div>
    </section>

    <!-- QUIZ INTERACTIVO -->
    <section class="quiz-section">
        <h2 class="seccion-titulo neon-evaluacion">
            <span class="icon">❓</span> QUIZ: ¿CUÁNTO SABES?
        </h2>
        <div class="quiz-container">
            <!-- PREGUNTA 1 -->
            <div class="quiz-question" data-correct="B">
                <div class="quiz-header">
                    <span class="quiz-num">01</span>
                    <h3>¿Qué evento marcó el inicio del sitio a Tenochtitlán?</h3>
                </div>
                <div class="quiz-options">
                    <button class="quiz-option" data-value="A">
                        <span class="option-letter">A</span>
                        Llegada a Cozumel
                    </button>
                    <button class="quiz-option" data-value="B">
                        <span class="option-letter">B</span>
                        Noche Triste
                    </button>
                    <button class="quiz-option" data-value="C">
                        <span class="option-letter">C</span>
                        Fundación de Veracruz
                    </button>
                    <button class="quiz-option" data-value="D">
                        <span class="option-letter">D</span>
                        Alianza con Tlaxcala
                    </button>
                </div>
                <div class="quiz-feedback" style="display: none;">
                    <div class="feedback-correct">
                        <strong>✅ Correcto:</strong> La Noche Triste (30 jun 1520) fue el detonante del sitio final.
                    </div>
                    <div class="feedback-incorrect">
                        ❌ <strong>Incorrecto:</strong> Revisa la cronología en el simulador.
                    </div>
                    <div class="feedback-explicacion">
                        <p>Tras la Noche Triste, Cortés reorganizó sus fuerzas y regresó con refuerzos de Cuba y más aliados indígenas.</p>
                    </div>
                </div>
            </div>

            <!-- PREGUNTA 2 -->
            <div class="quiz-question" data-correct="C">
                <div class="quiz-header">
                    <span class="quiz-num">02</span>
                    <h3>¿Cuál fue el papel de La Malinche?</h3>
                </div>
                <div class="quiz-options">
                    <button class="quiz-option" data-value="A">
                        <span class="option-letter">A</span>
                        Líder militar
                    </button>
                    <button class="quiz-option" data-value="B">
                        <span class="option-letter">B</span>
                        Espía de Moctezuma
                    </button>
                    <button class="quiz-option" data-value="C">
                        <span class="option-letter">C</span>
                        Intérprete y consejera
                    </button>
                    <button class="quiz-option" data-value="D">
                        <span class="option-letter">D</span>
                        Sacerdotisa mexica
                    </button>
                </div>
                <div class="quiz-feedback" style="display: none;">
                    <div class="feedback-correct">
                        <strong>✅ Correcto:</strong> Malinche fue clave como traductora y mediadora cultural.
                    </div>
                    <div class="feedback-incorrect">
                        ❌ <strong>Incorrecto:</strong> Investiga su biografía en la sección de personajes.
                    </div>
                </div>
            </div>

            <!-- PREGUNTA 3 -->
            <div class="quiz-question" data-correct="A">
                <div class="quiz-header">
                    <span class="quiz-num">03</span>
                    <h3>¿Qué ventaja tecnológica NO tenían los mexicas?</h3>
                </div>
                <div class="quiz-options">
                    <button class="quiz-option" data-value="A">
                        <span class="option-letter">A</span>
                        Armas de fuego
                    </button>
                    <button class="quiz-option" data-value="B">
                        <span class="option-letter">B</span>
                        Chinampas
                    </button>
                    <button class="quiz-option" data-value="C">
                        <span class="option-letter">C</span>
                        Calendarios
                    </button>
                    <button class="quiz-option" data-value="D">
                        <span class="option-letter">D</span>
                        Medicina herbal
                    </button>
                </div>
                <div class="quiz-feedback" style="display: none;">
                    <div class="feedback-correct">
                        <strong>✅ Correcto:</strong> Los arcabuces y cañones fueron decisivos.
                    </div>
                    <div class="feedback-incorrect">
                        ❌ <strong>Incorrecto:</strong> Revisa la sección de "Factores de la Victoria".
                    </div>
                </div>
            </div>

            <!-- RESULTADOS -->
            <div class="quiz-results" style="display: none;">
                <h3>📊 RESULTADOS</h3>
                <div class="results-score">
                    Puntuación: <span id="quizScore">0</span>/3
                </div>
                <div class="results-feedback" id="quizFeedback">
                    Completa el quiz para ver tu desempeño.
                </div>
                <button class="btn-retry" onclick="reiniciarQuiz()">
                    🔄 VOLVER A INTENTAR
                </button>
            </div>
        </div>
    </section>

    <!-- ERRORES COMUNES -->
    <section class="errores-section">
        <h2 class="seccion-titulo neon-alerta">
            <span class="icon">⚠️</span> MITOS Y ERRORES
        </h2>
        <div class="errores-container">
            <div class="error-card">
                <div class="error-header" onclick="toggleError(this)">
                    <h3>❌ "Cortés conquistó México solo"</h3>
                    <span class="error-toggle">+</span>
                </div>
                <div class="error-content">
                    <div class="error-ejemplo">
                        <strong>Error:</strong> "Los españoles ganaron por su superioridad numérica."
                    </div>
                    <div class="error-correccion">
                        <strong>Realidad:</strong> Cortés tuvo <strong>500 españoles</strong> vs. <strong>200,000 mexicas</strong>, pero contó con <strong>200,000 aliados indígenas</strong> (Tlaxcala, Texcoco).
                    </div>
                    <div class="error-grafica">
                        <div class="grafica-barras">
                            <div class="barra española" style="width: 5%;">Españoles (500)</div>
                            <div class="barra mexica" style="width: 90%;">Mexicas (200,000)</div>
                            <div class="barra aliados" style="width: 95%;">Aliados (200,000)</div>
                        </div>
                        <div class="grafica-leyenda">
                            <span class="leyenda-española">🟥 Españoles</span>
                            <span class="leyenda-mexica">🟩 Mexicas</span>
                            <span class="leyenda-aliados">🟨 Aliados</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="error-card">
                <div class="error-header" onclick="toggleError(this)">
                    <h3>❌ "La viruela fue traída por Cortés"</h3>
                    <span class="error-toggle">+</span>
                </div>
                <div class="error-content">
                    <div class="error-ejemplo">
                        <strong>Error:</strong> "Cortés usó la viruela como arma biológica."
                    </div>
                    <div class="error-correccion">
                        <strong>Realidad:</strong> La viruela llegó con <strong>un esclavo africano</strong> en 1520 (Narváez). Cortés no la controlaba.
                        <div class="error-dato">🦠 Primer registro en Tenochtitlán: Octubre 1520.</div>
                    </div>
                    <div class="error-mapa">
                        <svg width="100%" height="150" viewBox="0 0 300 100">
                            <rect x="0" y="0" width="300" height="100" fill="#0a0a1a"/>
                            <circle cx="50" cy="50" r="10" fill="#FF5252"/>
                            <text x="50" y="80" fill="#FFCDD2" font-size="8" text-anchor="middle">Cuba</text>
                            <circle cx="250" cy="50" r="10" fill="#FF5252"/>
                            <text x="250" y="80" fill="#FFCDD2" font-size="8" text-anchor="middle">Tenochtitlán</text>
                            <path d="M50,50 L250,50" stroke="#FF9800" stroke-width="2" stroke-dasharray="5,2"/>
                            <text x="150" y="30" fill="#FFE0B2" font-size="10" text-anchor="middle">Ruta de la viruela (1520)</text>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="error-card">
                <div class="error-header" onclick="toggleError(this)">
                    <h3>❌ "Moctezuma creyó que Cortés era Quetzalcóatl"</h3>
                    <span class="error-toggle">+</span>
                </div>
                <div class="error-content">
                    <div class="error-ejemplo">
                        <strong>Error:</strong> "Moctezuma rindió Tenochtitlán por superstición."
                    </div>
                    <div class="error-correccion">
                        <strong>Realidad:</strong> Los mexicas <strong>no asociaban a Cortés con Quetzalcóatl</strong> (dios blanco y barbado). Moctezuma actuó por <strong>cálculo político</strong>.
                        <div class="error-cita">
                            <p>"Los españoles eran <strong>hombres, no dioses</strong>." — <em>Códice Florentino</em></p>
                        </div>
                    </div>
                    <div class="error-imagen">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/5a/Codex_Florentino_Book_12_folio_54r.jpg/300px-Codex_Florentino_Book_12_folio_54r.jpg" alt="Códice Florentino" width="100%">
                        <p><em>Representación mexica de los españoles. Fuente: Wikipedia.</em></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- PROBLEMAS TIPO EXAMEN -->
    <section class="examen-section">
        <h2 class="seccion-titulo neon-evaluacion">
            <span class="icon">📝</span> MISIÓN FINAL: ANÁLISIS CRÍTICO
        </h2>
        <div class="examen-container">
            <div class="problema-card">
                <div class="problema-header">
                    <span class="problema-num">P1</span>
                    <h3>Análisis de Fuentes</h3>
                </div>
                <div class="problema-enunciado">
                    <p>Compara los relatos de la conquista en:</p>
                    <ol>
                        <li><strong>Cartas de Relación</strong> (Cortés).</li>
                        <li><strong>Códice Florentino</strong> (Sahagún).</li>
                        <li><strong>Crónicas indígenas</strong> (ej. Chimalpahin).</li>
                    </ol>
                    <p>Identifica <strong>3 diferencias clave</strong> en la narrativa y explica su importancia histórica.</p>
                </div>
                <div class="problema-espacio">
                    <textarea placeholder="Ejemplo: Cortés omite la ayuda de Tlaxcala para..." rows="8"></textarea>
                </div>
                <button class="btn-verificar" onclick="verificarProblema(1)">VER SOLUCIÓN</button>
                <div class="problema-solucion" id="solucionP1" style="display: none;">
                    <strong>Solución:</strong>
                    <ol>
                        <li><strong>Cortés:</strong> Exagera su heroísmo y minimiza el papel de los aliados indígenas.</li>
                        <li><strong>Códice Florentino:</strong> Muestra la conquista como una <strong>catástrofe</strong> (epidemias, destrucción).</li>
                        <li><strong>Chimalpahin:</strong> Destaca la <strong>resistencia mexica</strong> y la traición de Tlaxcala.</li>
                    </ol>
                    <p><strong>Importancia:</strong> Las fuentes reflejan <strong>perspectivas distintas</strong> (europea vs. indígena) y sesgos históricos.</p>
                </div>
            </div>

            <div class="problema-card">
                <div class="problema-header">
                    <span class="problema-num">P2</span>
                    <h3>Debate: ¿Fue inevitable la conquista?</h3>
                </div>
                <div class="problema-enunciado">
                    <p>Argumenta a favor o en contra de la siguiente afirmación:</p>
                    <blockquote>
                        "La caída de Tenochtitlán fue inevitable debido a la superioridad tecnológica y las divisiones internas en el imperio mexica."
                    </blockquote>
                    <p>Usa al menos <strong>3 evidencias históricas</strong> del simulador o las secciones anteriores.</p>
                </div>
                <div class="problema-espacio">
                    <textarea placeholder="Ejemplo: La viruela debilitó a Tenochtitlán, pero..." rows="10"></textarea>
                </div>
                <button class="btn-verificar" onclick="verificarProblema(2)">VER ARGUMENTOS</button>
                <div class="problema-solucion" id="solucionP2" style="display: none;">
                    <strong>Argumentos a favor de la inevitabilidad:</strong>
                    <ul>
                        <li><strong>Tecnología:</strong> Armas de fuego y caballos (ventaja del 90% en combate).</li>
                        <li><strong>Enfermedades:</strong> Viruela mató al 50% de la población.</li>
                        <li><strong>Alianzas:</strong> 200,000 aliados vs. 500 españoles.</li>
                    </ul>
                    <strong>Argumentos en contra:</strong>
                    <ul>
                        <li><strong>Resistencia:</strong> Cuauhtémoc lideró una defensa épica.</li>
                        <li><strong>Errores españoles:</strong> Derrota en la Noche Triste (1520).</li>
                        <li><strong>Azar:</strong> Si no llega la viruela, el resultado podría ser distinto.</li>
                    </ul>
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
                    <td>Análisis de fuentes</td>
                    <td>Identifica 3 diferencias con explicación crítica.</td>
                    <td>Menciona diferencias sin profundizar.</td>
                    <td>No compara fuentes.</td>
                </tr>
                <tr>
                    <td>Uso de evidencias</td>
                    <td>Argumenta con 3+ evidencias históricas.</td>
                    <td>Usa 1-2 evidencias sin contexto.</td>
                    <td>No usa evidencias.</td>
                </tr>
                <tr>
                    <td>Reflexión crítica</td>
                    <td>Evalúa perspectivas múltiples (europea/indígena).</td>
                    <td>Analiza solo una perspectiva.</td>
                    <td>Repite información sin reflexión.</td>
                </tr>
            </table>
        </div>
    </section>

    <!-- CIERRE METACOGNITIVO -->
    <section class="cierre-section">
        <h2 class="seccion-titulo neon-concepto">
            <span class="icon">🧠</span> CIERRE: REFLEXIÓN HISTÓRICA
        </h2>
        <div class="cierre-container">
            <div class="autoevaluacion">
                <h3>📊 AUTOEVALUACIÓN</h3>
                <div class="slider-group">
                    <label>Conozco las etapas de la conquista:</label>
                    <input type="range" min="1" max="5" value="3" class="autoeval-slider" id="slider1">
                    <div class="slider-labels">
                        <span>Básico</span><span>Intermedio</span><span>Avanzado</span>
                    </div>
                </div>
                <div class="slider-group">
                    <label>Analizo factores de la victoria española:</label>
                    <input type="range" min="1" max="5" value="3" class="autoeval-slider" id="slider2">
                    <div class="slider-labels">
                        <span>Básico</span><span>Intermedio</span><span>Avanzado</span>
                    </div>
                </div>
                <div class="slider-group">
                    <label>Uso el simulador para entender la ruta:</label>
                    <input type="range" min="1" max="5" value="3" class="autoeval-slider" id="slider3">
                    <div class="slider-labels">
                        <span>Básico</span><span>Intermedio</span><span>Avanzado</span>
                    </div>
                </div>
                <button class="btn-guardar" onclick="guardarAutoevaluacion()">
                    💾 GUARDAR PROGRESO
                </button>
            </div>

            <div class="reflexion">
                <h3>💭 REFLEXIÓN FINAL</h3>
                <div class="pregunta-reflexion">
                    <p>¿Cómo crees que habría sido México si los mexicas hubieran vencido a Cortés? Considera aspectos culturales, políticos y tecnológicos.</p>
                    <textarea placeholder="Ejemplo: Sin la colonización, el náhuatl sería..." rows="5" id="reflexion1"></textarea>
                </div>
                <div class="pregunta-reflexion">
                    <p>Investiga un personaje de la conquista (ej. Pedro de Alvarado, Cacama de Texcoco) y describe su papel en 3 líneas.</p>
                    <textarea placeholder="Ejemplo: Alvarado masacró a nobles mexicas en..." rows="4" id="reflexion2"></textarea>
                </div>
            </div>

            <div class="plan-estudio">
                <h3>📅 PLAN DE ESTUDIO</h3>
                <div class="plan-grid">
                    <div class="plan-card">
                        <h4>🔹 REPASO RÁPIDO (20 min)</h4>
                        <ul>
                            <li>Repasar fechas y personajes clave.</li>
                            <li>Memorizar factores de la victoria.</li>
                            <li>Ver el mapa interactivo 2 veces.</li>
                        </ul>
                    </div>
                    <div class="plan-card">
                        <h4>🔹 PROFUNDIZACIÓN (40 min)</h4>
                        <ul>
                            <li>Leer un fragmento de las <strong>Cartas de Relación</strong>.</li>
                            <li>Comparar con el <strong>Códice Florentino</strong>.</li>
                            <li>Escribir un párrafo sobre diferencias.</li>
                        </ul>
                    </div>
                    <div class="plan-card">
                        <h4>🔹 DEBATE (30 min)</h4>
                        <ul>
                            <li>Preparar argumentos sobre: ¿Fue Malinche una traidora?</li>
                            <li>Debatir en clase con evidencias.</li>
                            <li>Reflexionar sobre el concepto de "traición" en guerra.</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="recursos">
                <h3>🌐 RECURSOS EXTERNOS</h3>
                <div class="recursos-links">
                    <a href="https://www.loc.gov/collections/hernan-cortes-papers/" target="_blank" class="recurso-link">
                        📜 Cartas de Relación (Library of Congress)
                    </a>
                    <a href="https://www.mna.inah.gob.mx/" target="_blank" class="recurso-link">
                        🏛️ Museo Nacional de Antropología (INAH)
                    </a>
                    <a href="https://www.khanacademy.org/humanities/whp-origins" target="_blank" class="recurso-link">
                        🎓 Khan Academy: Conquista de México
                    </a>
                    <a href="https://www.youtube.com/watch?v=..." target="_blank" class="recurso-link">
                        🎥 Documental: "La Otra Conquista" (IMDb)
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- JAVASCRIPT INTEGRADO -->
<script>
// ===========================================
// BASE DE DATOS DEL SIMULADOR
// ===========================================
const etapasConquista = {
    "cozumel": {
        fecha: "Febrero 1519",
        evento: "Llegada a Cozumel",
        descripcion: "Primer contacto con mayas. Cortés recibe a Jerónimo de Aguilar (náufrago que hablaba maya).",
        impacto: "Obtención de información sobre el imperio mexica.",
        fuerzas: "500 españoles",
        aliados: "Ninguno (primer contacto)",
        color: "#FF5252",
        icono: "🌊"
    },
    "veracruz": {
        fecha: "21 Abril 1519",
        evento: "Fundación de Veracruz",
        descripcion: "Cortés establece el primer asentamiento español y quema sus naves para evitar deserciones.",
        impacto: "Punto de partida para la conquista. Cortés se declara independiente de Velázquez (Cuba).",
        fuerzas: "500 españoles",
        aliados: "Totonacas (primeros aliados)",
        color: "#4CAF50",
        icono: "🏙️"
    },
    "tlaxcala": {
        fecha: "Septiembre 1519",
        evento: "Alianza con Tlaxcala",
        descripcion: "Cortés forma alianza con los tlaxcaltecas, enemigos de Tenochtitlán. Recibe regalos y apoyo militar.",
        impacto: "Fuerzas combinadas: 500 españoles + 6,000 tlaxcaltecas.",
        fuerzas: "500 españoles + 6,000 tlaxcaltecas",
        aliados: "Tlaxcala",
        color: "#FF9800",
        icono: "🤝"
    },
    "tenochtitlan": {
        fecha: "8 Noviembre 1519",
        evento: "Entrada a Tenochtitlán",
        descripcion: "Moctezuma recibe a Cortés. Malinche traduce. Cortés toma a Moctezuma como rehén.",
        impacto: "Cortés controla a Moctezuma, pero la tensión crece.",
        fuerzas: "500 españoles + aliados",
        aliados: "Tlaxcala, totonacas",
        color: "#D32F2F",
        icono: "🏛️"
    },
    "noche-triste": {
        fecha: "30 Junio 1520",
        evento: "Noche Triste",
        descripcion: "Tras la masacre en el Templo Mayor (Alvarado), los mexicas atacan. Cortés huye por la calzada de Tacuba.",
        impacto: "Derrota temporal: 600 españoles y miles de aliados mueren. Cortés se reagrupa en Tlaxcala.",
        fuerzas: "400 españoles sobrevivientes",
        aliados: "Tlaxcala (refugio)",
        color: "#7B1FA2",
        icono: "💀"
    },
    "sitio": {
        fecha: "Mayo 1521",
        evento: "Sitio a Tenochtitlán",
        descripcion: "Cortés regresa con refuerzos de Cuba y más aliados. Construye bergantines para controlar el lago.",
        impacto: "Bloqueo total: 75 días de sitio. Destrucción de acueductos y hambruna.",
        fuerzas: "900 españoles + 100,000 aliados",
        aliados: "Tlaxcala, Texcoco, Huejotzingo",
        color: "#FF5252",
        icono: "🔥"
    },
    "caida": {
        fecha: "13 Agosto 1521",
        evento: "Caída de Tenochtitlán",
        descripcion: "Cuauhtémoc es capturado. Fin del imperio mexica. Cortés inicia la construcción de la Ciudad de México.",
        impacto: "Inicio del virreinato. 200,000 muertos (guerra + viruela).",
        fuerzas: "900 españoles + aliados",
        aliados: "Todas las ciudades enemigas de Tenochtitlán",
        color: "#B71C1C",
        icono: "☠️"
    }
};

// ===========================================
// SIMULADOR: RUTA DE CORTÉS
// ===========================================
function iniciarSimulacion() {
    const etapa = document.getElementById(\'etapaSelect\').value;
    const velocidad = document.getElementById(\'velocidad\').value;
    const datos = etapasConquista[etapa];

    // Actualizar datos
    document.getElementById(\'dataEtapa\').textContent = datos.evento;
    document.getElementById(\'dataFecha\').textContent = datos.fecha;
    document.getElementById(\'dataEvento\').textContent = datos.descripcion;
    document.getElementById(\'dataImpacto\').textContent = datos.impacto;
    document.getElementById(\'dataFuerzas\').textContent = datos.fuerzas;
    document.getElementById(\'dataAliados\').textContent = datos.aliados;

    // Actualizar leyenda
    document.getElementById(\'leyendaTexto\').textContent = `${datos.icono} ${datos.evento} (${datos.fecha})`;

    // Animar ruta
    const anim = document.getElementById(\'animRuta\');
    anim.beginElement();

    // Resaltar punto en el mapa
    document.querySelectorAll(\'.punto-mapa\').forEach(p => {
        p.setAttribute(\'opacity\', \'0.3\');
    });
    document.getElementById(etapa).setAttribute(\'opacity\', \'1\');

    // Cambiar color de la ruta animada
    document.getElementById(\'rutaAnimada\').setAttribute(\'stroke\', datos.color);

    console.log(`🚀 Simulación iniciada: ${datos.evento} (${datos.fecha})`);
}

function reiniciarSimulacion() {
    document.getElementById(\'etapaSelect\').value = "cozumel";
    document.getElementById(\'velocidad\').value = "5";
    document.getElementById(\'leyendaTexto\').textContent = "Selecciona una etapa y haz clic en \'INICIAR SIMULACIÓN\'";

    // Reiniciar datos
    document.querySelectorAll(\'.data-value\').forEach(d => {
        d.textContent = "—";
    });

    // Reiniciar mapa
    document.querySelectorAll(\'.punto-mapa\').forEach(p => {
        p.setAttribute(\'opacity\', \'0.5\');
    });
    document.getElementById(\'rutaAnimada\').setAttribute(\'stroke\', \'#39FF14\');

    console.log("🔄 Simulación reiniciada");
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
        feedback = "🌟 ¡Excelente! Dominas los detalles clave de la conquista.";
    } else if (porcentaje >= 50) {
        feedback = "👍 Buen trabajo, pero repasa los factores de la victoria española.";
    } else {
        feedback = "📚 Necesitas estudiar más la cronología y personajes.";
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
// ERRORES COMUNES (MITOS)
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
// AUTOEVALUACIÓN
// ===========================================
function guardarAutoevaluacion() {
    const slider1 = document.getElementById(\'slider1\').value;
    const slider2 = document.getElementById(\'slider2\').value;
    const slider3 = document.getElementById(\'slider3\').value;
    const promedio = (parseInt(slider1) + parseInt(slider2) + parseInt(slider3)) / 3;

    alert(`💾 Autoevaluación guardada:\\n\\n` +
          `Cronología: ${slider1}/5\\n` +
          `Factores de victoria: ${slider2}/5\\n` +
          `Uso del simulador: ${slider3}/5\\n\\n` +
          `Promedio: ${promedio.toFixed(1)}/5\\n\\n` +
          `📌 Recomendación: Revisa el plan de estudio según tus resultados.`);
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
console.log("🚀 Lección Cyberpunk: La Conquista de México - Cargada");
console.log("🎮 Simulador, Quiz y Herramientas interactivas listas");
</script>',
    'ejercicios' => 
    array (
      0 => 
      array (
        'enunciado' => 'Año llegada Cortés',
        'respuesta' => '1519',
      ),
      1 => 
      array (
        'enunciado' => 'Intérprete de Cortés',
        'respuesta' => 'Malinche',
      ),
      2 => 
      array (
        'enunciado' => 'Aliados clave',
        'respuesta' => 'Tlaxcaltecas',
      ),
      3 => 
      array (
        'enunciado' => 'Enfermedad decisiva',
        'respuesta' => 'Viruela',
      ),
      4 => 
      array (
        'enunciado' => 'Caída Tenochtitlán',
        'respuesta' => '13 agosto 1521',
      ),
      5 => 
      array (
        'enunciado' => 'Noche Triste',
        'respuesta' => '30 junio 1520',
      ),
      6 => 
      array (
        'enunciado' => 'Emperador al llegar Cortés',
        'respuesta' => 'Moctezuma II',
      ),
      7 => 
      array (
        'enunciado' => 'Sucesor muerto por viruela',
        'respuesta' => 'Cuitláhuac',
      ),
      8 => 
      array (
        'enunciado' => 'Último emperador',
        'respuesta' => 'Cuauhtémoc',
      ),
      9 => 
      array (
        'enunciado' => 'Fundación Veracruz',
        'respuesta' => '22 abril 1519',
      ),
      10 => 
      array (
        'enunciado' => 'Bergantines en sitio',
        'respuesta' => '13',
      ),
      11 => 
      array (
        'enunciado' => 'SI: años de conquista',
        'respuesta' => '2 años 3 meses',
      ),
    ),
    'quiz' => 
    array (
      0 => 
      array (
        'pregunta' => 'Líder conquista',
        'opciones' => 
        array (
          0 => 'Cortés',
          1 => 'Pizarro',
          2 => 'Colón',
          3 => 'Velázquez',
        ),
        'correcta' => 'Cortés',
      ),
      1 => 
      array (
        'pregunta' => 'Malinche fue',
        'opciones' => 
        array (
          0 => 'Intérprete',
          1 => 'Reina',
          2 => 'Sacerdotisa',
          3 => 'Espía',
        ),
        'correcta' => 'Intérprete',
      ),
      2 => 
      array (
        'pregunta' => 'Alianza clave',
        'opciones' => 
        array (
          0 => 'Tlaxcala',
          1 => 'Tenochtitlán',
          2 => 'Maya',
          3 => 'Inca',
        ),
        'correcta' => 'Tlaxcala',
      ),
      3 => 
      array (
        'pregunta' => 'Enfermedad',
        'opciones' => 
        array (
          0 => 'Viruela',
          1 => 'Gripe',
          2 => 'Cólera',
          3 => 'Peste',
        ),
        'correcta' => 'Viruela',
      ),
      4 => 
      array (
        'pregunta' => 'Caída Tenochtitlán',
        'opciones' => 
        array (
          0 => '13 Ago 1521',
          1 => '12 Oct 1492',
          2 => '1 Ene 1500',
          3 => '20 Nov 1910',
        ),
        'correcta' => '13 Ago 1521',
      ),
      5 => 
      array (
        'pregunta' => 'Noche Triste',
        'opciones' => 
        array (
          0 => '30 Jun 1520',
          1 => '1 Ene',
          2 => '25 Dic',
          3 => '15 Sep',
        ),
        'correcta' => '30 Jun 1520',
      ),
      6 => 
      array (
        'pregunta' => 'Emperador inicial',
        'opciones' => 
        array (
          0 => 'Moctezuma II',
          1 => 'Cuauhtémoc',
          2 => 'Cuitláhuac',
          3 => 'Nezahualcóyotl',
        ),
        'correcta' => 'Moctezuma II',
      ),
      7 => 
      array (
        'pregunta' => 'Muerto por viruela',
        'opciones' => 
        array (
          0 => 'Cuitláhuac',
          1 => 'Moctezuma',
          2 => 'Cuauhtémoc',
          3 => 'Cortés',
        ),
        'correcta' => 'Cuitláhuac',
      ),
      8 => 
      array (
        'pregunta' => 'Último tlatoani',
        'opciones' => 
        array (
          0 => 'Cuauhtémoc',
          1 => 'Moctezuma',
          2 => 'Cuitláhuac',
          3 => 'Itzcóatl',
        ),
        'correcta' => 'Cuauhtémoc',
      ),
      9 => 
      array (
        'pregunta' => 'SI 2025: años caída',
        'opciones' => 
        array (
          0 => '504',
          1 => '500',
          2 => '600',
          3 => '400',
        ),
        'correcta' => '504',
      ),
      10 => 
      array (
        'pregunta' => 'Llegada Cozumel',
        'opciones' => 
        array (
          0 => 'Feb 1519',
          1 => 'Abr 1519',
          2 => 'Nov 1519',
          3 => '1521',
        ),
        'correcta' => 'Feb 1519',
      ),
      11 => 
      array (
        'pregunta' => 'Fundación Veracruz',
        'opciones' => 
        array (
          0 => '22 Abr 1519',
          1 => '1 Ene',
          2 => '12 Oct',
          3 => '20 Nov',
        ),
        'correcta' => '22 Abr 1519',
      ),
      12 => 
      array (
        'pregunta' => 'Entrada Tenochtitlán',
        'opciones' => 
        array (
          0 => '8 Nov 1519',
          1 => '1 Ene',
          2 => '25 Dic',
          3 => '15 Sep',
        ),
        'correcta' => '8 Nov 1519',
      ),
      13 => 
      array (
        'pregunta' => 'Matanza Templo Mayor',
        'opciones' => 
        array (
          0 => 'Mayo 1520',
          1 => '1519',
          2 => '1521',
          3 => '1522',
        ),
        'correcta' => 'Mayo 1520',
      ),
      14 => 
      array (
        'pregunta' => 'Sitio duró',
        'opciones' => 
        array (
          0 => '75 días',
          1 => '1 año',
          2 => '1 día',
          3 => '1 mes',
        ),
        'correcta' => '75 días',
      ),
      15 => 
      array (
        'pregunta' => 'Bergantines',
        'opciones' => 
        array (
          0 => '13',
          1 => '1',
          2 => '100',
          3 => '0',
        ),
        'correcta' => '13',
      ),
      16 => 
      array (
        'pregunta' => 'Caballos en 1519',
        'opciones' => 
        array (
          0 => '16',
          1 => '100',
          2 => '0',
          3 => '1000',
        ),
        'correcta' => '16',
      ),
      17 => 
      array (
        'pregunta' => 'Población Tenochtitlán',
        'opciones' => 
        array (
          0 => '~200,000',
          1 => '10,000',
          2 => '1M',
          3 => '500',
        ),
        'correcta' => '~200,000',
      ),
      18 => 
      array (
        'pregunta' => 'Cuauhtémoc ejecutado',
        'opciones' => 
        array (
          0 => '1525',
          1 => '1521',
          2 => '1519',
          3 => '1530',
        ),
        'correcta' => '1525',
      ),
      19 => 
      array (
        'pregunta' => 'SI 2025: Malinche símbolo',
        'opciones' => 
        array (
          0 => 'Traición y mediación',
          1 => 'Solo traición',
          2 => 'Solo heroína',
          3 => 'Nada',
        ),
        'correcta' => 'Traición y mediación',
      ),
      20 => 
      array (
        'pregunta' => 'Moctezuma muerto',
        'opciones' => 
        array (
          0 => 'Julio 1520',
          1 => '1519',
          2 => '1521',
          3 => '1525',
        ),
        'correcta' => 'Julio 1520',
      ),
      21 => 
      array (
        'pregunta' => 'Cuitláhuac reinó',
        'opciones' => 
        array (
          0 => '4 meses',
          1 => '10 años',
          2 => '1 día',
          3 => '20 años',
        ),
        'correcta' => '4 meses',
      ),
      22 => 
      array (
        'pregunta' => 'Tenochtitlán destruida',
        'opciones' => 
        array (
          0 => 'Sobre ruinas CDMX',
          1 => 'Desapareció',
          2 => 'Se mudó',
          3 => 'Nada',
        ),
        'correcta' => 'Sobre ruinas CDMX',
      ),
      23 => 
      array (
        'pregunta' => 'Cartas de Relación',
        'opciones' => 
        array (
          0 => 'Cortés a Carlos V',
          1 => 'Moctezuma',
          2 => 'Malinche',
          3 => 'Tlaxcala',
        ),
        'correcta' => 'Cortés a Carlos V',
      ),
      24 => 
      array (
        'pregunta' => 'Viruela llegó con',
        'opciones' => 
        array (
          0 => 'Españoles (Narváez)',
          1 => 'Cortés',
          2 => 'Nativos',
          3 => 'África',
        ),
        'correcta' => 'Españoles (Narváez)',
      ),
      25 => 
      array (
        'pregunta' => 'Pánfilo de Narváez',
        'opciones' => 
        array (
          0 => 'Enviado a arrestar Cortés',
          1 => 'Aliado',
          2 => 'Rey',
          3 => 'Nada',
        ),
        'correcta' => 'Enviado a arrestar Cortés',
      ),
      26 => 
      array (
        'pregunta' => 'Batalla Otumba',
        'opciones' => 
        array (
          0 => 'Victoria tras Noche Triste',
          1 => 'Derrota',
          2 => 'Paz',
          3 => 'Nada',
        ),
        'correcta' => 'Victoria tras Noche Triste',
      ),
      27 => 
      array (
        'pregunta' => 'SI 2025: sitio recordado',
        'opciones' => 
        array (
          0 => '500 años en 2021',
          1 => '2025',
          2 => '2030',
          3 => 'Nunca',
        ),
        'correcta' => '500 años en 2021',
      ),
      28 => 
      array (
        'pregunta' => 'Conquista fue',
        'opciones' => 
        array (
          0 => 'Guerra + alianzas + enfermedad',
          1 => 'Solo guerra',
          2 => 'Solo paz',
          3 => 'Nada',
        ),
        'correcta' => 'Guerra + alianzas + enfermedad',
      ),
      29 => 
      array (
        'pregunta' => 'México mestizo desde',
        'opciones' => 
        array (
          0 => '1521',
          1 => '1821',
          2 => '1910',
          3 => '2025',
        ),
        'correcta' => '1521',
      ),
    ),
  ),
  2 => 
  array (
    'materia' => 'Historia de México',
    'slug' => 'virreinato-nueva-espana',
    'titulo' => 'Virreinato de Nueva España: Poder, Explotación y Evangelización (1521-1821)',
    'contenido' => '<!-- INICIO LECCIÓN CYBERPUNK -->
<div class="leccion-container leccion-historia-virreinato" data-tema="virreinato-nueva-espana">
    
    <!-- CABECERA CYBERPUNK -->
    <header class="leccion-header">
        <h1 class="titulo-leccion neon-glow">
            <span class="icon-tema">🏛️</span>
            VIRREINATO DE NUEVA ESPAÑA
        </h1>
        <div class="subtitulo">
            El Orden Colonial: Encomienda, Virreyes y Control Eclesiástico (1521-1821)
        </div>
        <div class="badge-tiempo">
            <span class="badge">1521-1821</span>
            <span class="badge">300 años</span>
            <span class="badge">63 virreyes</span>
            <span class="badge">Castas sociales</span>
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
                <h3>Analizar estructura de poder</h3>
                <p>Comprender jerarquía: Rey → Virrey → Audiencias → Cabildos</p>
            </div>
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Evaluar sistema económico</h3>
                <p>Examinar encomienda, minería, haciendas y comercio</p>
            </div>
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Identificar sistema de castas</h3>
                <p>Diferenciar españoles, criollos, mestizos, indígenas, negros</p>
            </div>
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Examinar control eclesiástico</h3>
                <p>Analizar evangelización, Inquisición y poder de la Iglesia</p>
            </div>
        </div>
    </section>

    <!-- CONTEXTO REAL -->
    <section class="contexto-real">
        <h2 class="seccion-titulo neon-dato">
            <span class="icon">🌍</span> LEGADO COLONIAL EN MÉXICO ACTUAL
        </h2>
        <div class="contexto-grid">
            <div class="contexto-card">
                <h3>🏛️ Arquitectura Colonial</h3>
                <p>1,200 sitios coloniales protegidos por INAH, 15 Patrimonios UNESCO</p>
                <div class="dato-neon">Catedral Metropolitana: 240 años construcción</div>
            </div>
            <div class="contexto-card">
                <h3>🗣️ Lengua y Religión</h3>
                <p>Español como lengua oficial, 82% población católica (INEGI 2020)</p>
                <div class="dato-neon">Sistema de castas → desigualdad moderna</div>
            </div>
            <div class="contexto-card">
                <h3>💰 Economía Minera</h3>
                <p>México sigue siendo primer productor mundial de plata (2024)</p>
                <div class="dato-neon">Continuidad de zonas mineras históricas</div>
            </div>
        </div>
    </section>

    <!-- SECCIÓN TEÓRICA -->
    <section class="teoria-section">
        <div class="borde-neon-lateral"></div>
        <h2 class="seccion-titulo neon-concepto">
            <span class="icon">📚</span> ESTRUCTURA DEL PODER COLONIAL
        </h2>
        
        <!-- INTRODUCCIÓN -->
        <div class="subseccion">
            <h3>1. Fundación y Justificación del Virreinato</h3>
            <div class="definicion-principal">
                <div class="def-card">
                    <h4>🏛️ VIRREINATO DE NUEVA ESPAÑA</h4>
                    <p>Entidad política y territorial creada por España tras la conquista de Tenochtitlán (1521). Capital: <strong>Ciudad de México</strong></p>
                    <div class="caracteristicas-grid">
                        <div class="caracteristica">
                            <span class="caracteristica-icon">👑</span>
                            <span class="caracteristica-texto">Justificación: Derecho de conquista</span>
                        </div>
                        <div class="caracteristica">
                            <span class="caracteristica-icon">⛪</span>
                            <span class="caracteristica-texto">Propósito: Evangelización indígena</span>
                        </div>
                        <div class="caracteristica">
                            <span class="caracteristica-icon">💰</span>
                            <span class="caracteristica-texto">Objetivo: Explotación económica</span>
                        </div>
                        <div class="caracteristica">
                            <span class="caracteristica-icon">⚖️</span>
                            <span class="caracteristica-texto">Duración: 300 años (1521-1821)</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- JERARQUÍA DE PODER -->
        <div class="subseccion">
            <h3>2. Jerarquía Política y Administrativa</h3>
            <div class="tabla-interactiva">
                <table class="tabla-cyberpunk">
                    <thead>
                        <tr>
                            <th>NIVEL</th>
                            <th>FIGURA/INSTITUCIÓN</th>
                            <th>FUNCIÓN PRINCIPAL</th>
                            <th>PERIODO/CARACTERÍSTICAS</th>
                            <th>EJEMPLO</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr data-nivel="rey" onclick="mostrarDetalleNivel(\'rey\')">
                            <td><strong class="nivel-tag rey">REY</strong></td>
                            <td>Monarca español</td>
                            <td>Autoridad suprema, emite cédulas reales</td>
                            <td>Carlos V, Felipe II, Borbones</td>
                            <td>Leyes de Indias (1542)</td>
                        </tr>
                        <tr data-nivel="virrey" onclick="mostrarDetalleNivel(\'virrey\')">
                            <td><strong class="nivel-tag virrey">VIRREY</strong></td>
                            <td>Representante real</td>
                            <td>Gobierno, justicia, guerra, hacienda</td>
                            <td>63 virreyes (1535-1821)</td>
                            <td>Antonio de Mendoza (1º virrey)</td>
                        </tr>
                        <tr data-nivel="audiencia" onclick="mostrarDetalleNivel(\'audiencia\')">
                            <td><strong class="nivel-tag audiencia">AUDIENCIAS</strong></td>
                            <td>Tribunal y consejo</td>
                            <td>Control judicial, asesoría al virrey</td>
                            <td>México (1527), Guadalajara (1548)</td>
                            <td>Residencia (juicio de cuentas)</td>
                        </tr>
                        <tr data-nivel="cabildo" onclick="mostrarDetalleNivel(\'cabildo\')">
                            <td><strong class="nivel-tag cabildo">CABILDOS</strong></td>
                            <td>Ayuntamientos</td>
                            <td>Administración local, obras públicas</td>
                            <td>Regidores, alcaldes ordinarios</td>
                            <td>Cabildo de la Ciudad de México</td>
                        </tr>
                    </tbody>
                </table>
                <div class="tabla-info" id="infoNivel">
                    Selecciona un nivel de la jerarquía para ver detalles ampliados
                </div>
            </div>
            
            <!-- DETALLES DE NIVELES -->
            <div class="niveles-detalles">
                <div class="detalle-nivel" id="detalleRey" style="display: none;">
                    <h4>👑 El Poder Real: Legislación desde España</h4>
                    <div class="detalle-content">
                        <div class="detalle-columna">
                            <h5>📜 Cédulas Reales</h5>
                            <p>Órdenes directas del rey que debían obedecerse en la Nueva España</p>
                            <div class="dato">Ejemplo: Prohibición de esclavitud indígena (1542)</div>
                        </div>
                        <div class="detalle-columna">
                            <h5>🏛️ Consejo de Indias</h5>
                            <p>Creado en 1524, supervisaba todo lo relacionado con las colonias</p>
                            <div class="dato">Funciones: legislativa, judicial, administrativa</div>
                        </div>
                        <div class="detalle-columna">
                            <h5>⚖️ Leyes de Indias</h5>
                            <p>Recopilación de 1680 con 6,400 leyes sobre gobierno colonial</p>
                            <div class="dato">Intentaban proteger indígenas (aplicación limitada)</div>
                        </div>
                    </div>
                </div>
                
                <div class="detalle-nivel" id="detalleVirrey" style="display: none;">
                    <h4>🏛️ Los Virreyes: Gobierno en la Distancia</h4>
                    <div class="detalle-content">
                        <div class="detalle-columna">
                            <h5>📊 Cifras Históricas</h5>
                            <p>63 virreyes en 286 años, promedio: 4.5 años en el cargo</p>
                            <div class="dato">Primer virrey: Antonio de Mendoza (1535-1550)</div>
                        </div>
                        <div class="detalle-columna">
                            <h5>⚖️ Funciones Clave</h5>
                            <p>Gobernador, capitán general, vicepatrono real, superintendente</p>
                            <div class="dato">Poder casi absoluto pero limitado por audiencias</div>
                        </div>
                        <div class="detalle-columna">
                            <h5>💰 Intereses en Conflicto</h5>
                            <p>Balance entre corona (impuestos), colonos (riqueza), Iglesia (almas)</p>
                            <div class="dato">Juicio de residencia al finalizar mandato</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- SISTEMA ECONÓMICO -->
        <div class="subseccion">
            <h3>3. Economía Colonial: Extracción y Explotación</h3>
            <div class="sistemas-grid">
                <div class="sistema-card" data-sistema="encomienda">
                    <div class="sistema-icon">⛓️</div>
                    <h4>ENCOMIENDA</h4>
                    <div class="sistema-desc">
                        "Encomendar" indígenas a españoles para trabajo y evangelización
                    </div>
                    <div class="sistema-datos">
                        <div class="dato"><strong>Derecho:</strong> Tributo indígena + trabajo</div>
                        <div class="dato"><strong>Obligación:</strong> Protección + evangelización</div>
                        <div class="dato"><strong>Realidad:</strong> Explotación y abusos</div>
                    </div>
                </div>
                
                <div class="sistema-card" data-sistema="mineria">
                    <div class="sistema-icon">⛏️</div>
                    <h4>MINERÍA</h4>
                    <div class="sistema-desc">
                        Principal fuente de riqueza, 80% plata mundial del siglo XVIII
                    </div>
                    <div class="sistema-datos">
                        <div class="dato"><strong>Principales:</strong> Zacatecas, Guanajuato</div>
                        <div class="dato"><strong>Técnica:</strong> Patio (amalgama mercurio)</div>
                        <div class="dato"><strong>Quinto real:</strong> 20% para la corona</div>
                    </div>
                </div>
                
                <div class="sistema-card" data-sistema="hacienda">
                    <div class="sistema-icon">🌾</div>
                    <h4>HACIENDAS</h4>
                    <div class="sistema-desc">
                        Latifundios para agricultura, ganadería y producción local
                    </div>
                    <div class="sistema-datos">
                        <div class="dato"><strong>Productos:</strong> Trigo, maíz, ganado</div>
                        <div class="dato"><strong>Sistema:</strong> Peonaje por deudas</div>
                        <div class="dato"><strong>Legado:</strong> Desigualdad agraria</div>
                    </div>
                </div>
                
                <div class="sistema-card" data-sistema="comercio">
                    <div class="sistema-icon">🚢</div>
                    <h4>COMERCIO</h4>
                    <div class="sistema-desc">
                        Monopolio español mediante flotas y puertos únicos
                    </div>
                    <div class="sistema-datos">
                        <div class="dato"><strong>Exportación:</strong> Plata, cochinilla, cacao</div>
                        <div class="dato"><strong>Importación:</strong> Manufacturas europeas</div>
                        <div class="dato"><strong>Ruta:</strong> Veracruz-Sevilla/Cádiz</div>
                    </div>
                </div>
            </div>
            
            <!-- DATOS ECONÓMICOS -->
            <div class="datos-economicos">
                <h4>📊 IMPACTO ECONÓMICO EN CIFRAS</h4>
                <div class="datos-grid">
                    <div class="dato-card">
                        <div class="dato-valor">80%</div>
                        <div class="dato-label">Plata mundial siglo XVIII</div>
                    </div>
                    <div class="dato-card">
                        <div class="dato-valor">48M</div>
                        <div class="dato-label">Pesos oro (remesas 1521-1821)</div>
                    </div>
                    <div class="dato-card">
                        <div class="dato-valor">20%</div>
                        <div class="dato-label">Quinto real (impuesto minero)</div>
                    </div>
                    <div class="dato-card">
                        <div class="dato-valor">90%</div>
                        <div class="dato-label">Mortalidad indígena siglo XVI</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- SISTEMA DE CASTAS -->
        <div class="subseccion">
            <h3>4. Sociedad Colonial: La Pirámide de las Castas</h3>
            <div class="piramide-container">
                <div class="piramide-niveles">
                    <div class="nivel-casta" data-casta="espanoles">
                        <div class="casta-header">
                            <h5>ESPAÑOLES PENINSULARES</h5>
                            <div class="casta-porcentaje">0.2%</div>
                        </div>
                        <div class="casta-desc">Nacidos en España, monopolio cargos altos</div>
                        <div class="casta-derechos">Todos los derechos políticos</div>
                    </div>
                    
                    <div class="nivel-casta" data-casta="criollos">
                        <div class="casta-header">
                            <h5>CRIOLLOS</h5>
                            <div class="casta-porcentaje">22.8%</div>
                        </div>
                        <div class="casta-desc">Hijos de españoles nacidos en América</div>
                        <div class="casta-derechos">Riqueza pero no poder político</div>
                    </div>
                    
                    <div class="nivel-casta" data-casta="mestizos">
                        <div class="casta-header">
                            <h5>MESTIZOS</h5>
                            <div class="casta-porcentaje">7.3%</div>
                        </div>
                        <div class="casta-desc">Mezcla español-indígena, artesanos, pequeños comerciantes</div>
                        <div class="casta-derechos">Derechos limitados, no pagaban tributo</div>
                    </div>
                    
                    <div class="nivel-casta" data-casta="indigenas">
                        <div class="casta-header">
                            <h5>INDÍGENAS</h5>
                            <div class="casta-porcentaje">60%</div>
                        </div>
                        <div class="casta-desc">Población originaria, mano de obra forzada</div>
                        <div class="casta-derechos">"Protegidos" pero explotados, pagaban tributo</div>
                    </div>
                    
                    <div class="nivel-casta" data-casta="negros">
                        <div class="casta-header">
                            <h5>AFROMESTIZOS/NEGROS</h5>
                            <div class="casta-porcentaje">9.7%</div>
                        </div>
                        <div class="casta-desc">Esclavos africanos y sus descendientes</div>
                        <div class="casta-derechos">Esclavitud, trabajos más duros</div>
                    </div>
                </div>
                
                <div class="castas-info">
                    <p><strong>💡 Clasificación de castas compleja:</strong> Mulatos (español+negro), Zambos (indígena+negro), Castizos, Moriscos, etc.</p>
                    <p><strong>📜 Sistema de "pureza de sangre":</strong> Determinaba derechos y acceso a cargos</p>
                </div>
            </div>
        </div>

        <!-- CONTROL ECLESIÁSTICO -->
        <div class="subseccion">
            <h3>5. Iglesia Colonial: Evangelización y Poder</h3>
            <div class="iglesia-grid">
                <div class="iglesia-card">
                    <div class="iglesia-icon">⛪</div>
                    <h4>EVANGELIZACIÓN</h4>
                    <div class="iglesia-desc">
                        Conversión masiva mediante reducciones, colegios y teatro evangelizador
                    </div>
                    <div class="iglesia-datos">
                        <div class="dato"><strong>Órdenes:</strong> Franciscanos, Dominicos, Jesuitas</div>
                        <div class="dato"><strong>Métodos:</strong> Lenguas indígenas, sincretismo</div>
                        <div class="dato"><strong>Logro:</strong> 9 millones bautizados 1524-1572</div>
                    </div>
                </div>
                
                <div class="iglesia-card">
                    <div class="iglesia-icon">🔥</div>
                    <h4>INQUISICIÓN</h4>
                    <div class="iglesia-desc">
                        Tribunal del Santo Oficio (1571-1820): control ideológico y moral
                    </div>
                    <div class="iglesia-datos">
                        <div class="dato"><strong>Delitos:</strong> Herejía, brujería, bigamia</div>
                        <div class="dato"><strong>Procesos:</strong> 3,000 en Nueva España</div>
                        <div class="dato"><strong>Ejecuciones:</strong> 50 autos de fe públicos</div>
                    </div>
                </div>
                
                <div class="iglesia-card">
                    <div class="iglesia-icon">💒</div>
                    <h4>PATRIMONIO</h4>
                    <div class="iglesia-desc">
                        Mayor terrateniente: 50% tierras, diezmo, capellanías, obras pías
                    </div>
                    <div class="iglesia-datos">
                        <div class="dato"><strong>Ingresos:</strong> Diezmo (10% producción)</div>
                        <div class="dato"><strong>Bienes:</strong> Conventos, colegios, hospitales</div>
                        <div class="dato"><strong>Poder:</strong> Banco, educación, salud</div>
                    </div>
                </div>
                
                <div class="iglesia-card">
                    <div class="iglesia-icon">⚖️</div>
                    <h4>VICEPATRONATO</h4>
                    <div class="iglesia-desc">
                        Control real sobre Iglesia: nombramiento obispos, administración diezmo
                    </div>
                    <div class="iglesia-datos">
                        <div class="dato"><strong>Derecho:</strong> Patronato regio (1508)</div>
                        <div class="dato"><strong>Poder:</strong> Rey nombraba autoridades</div>
                        <div class="dato"><strong>Control:</strong> Estado sobre Iglesia</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SIMULADOR INTERACTIVO: ESTRUCTURA DE PODER -->
    <section class="simulator-section">
        <h2 class="seccion-titulo neon-interactivo">
            <span class="icon">🔄</span> SIMULADOR: JERARQUÍA COLONIAL INTERACTIVA
        </h2>
        
        <div class="simulator-container" data-tema="jerarquia-colonial">
            <!-- PANEL DE CONTROLES -->
            <div class="simulator-controls">
                <h3>EXPLORADOR DE PODER</h3>
                
                <div class="control-group">
                    <label for="poderSelect">Nivel de Poder:</label>
                    <select id="poderSelect" class="control-select" onchange="cambiarNivelPoder()">
                        <option value="rey">Rey (España)</option>
                        <option value="virrey">Virrey (México)</option>
                        <option value="audiencia">Audiencia</option>
                        <option value="encomendero">Encomendero</option>
                        <option value="iglesia">Iglesia</option>
                        <option value="cabildo">Cabildo</option>
                    </select>
                </div>
                
                <div class="control-group">
                    <label for="periodoSelect">Periodo Histórico:</label>
                    <select id="periodoSelect" class="control-select" onchange="cambiarPeriodo()">
                        <option value="sigloXVI">Siglo XVI (Conquista)</option>
                        <option value="sigloXVII">Siglo XVII (Consolidación)</option>
                        <option value="sigloXVIII">Siglo XVIII (Reformas Borbónicas)</option>
                        <option value="sigloXIX">Siglo XIX (Crisis final)</option>
                    </select>
                </div>
                
                <div class="control-group">
                    <label>Recursos de Poder:</label>
                    <div class="checkbox-group">
                        <label><input type="checkbox" name="recursos" value="legitimidad" checked> Legitimidad</label>
                        <label><input type="checkbox" name="recursos" value="economico"> Poder económico</label>
                        <label><input type="checkbox" name="recursos" value="militar"> Fuerza militar</label>
                        <label><input type="checkbox" name="recursos" value="ideologico"> Control ideológico</label>
                    </div>
                </div>
                
                <button class="btn-comparar" onclick="compararPoderes()">
                    <span class="btn-icon">⚖️</span> COMPARAR PODERES
                </button>
                
                <button class="btn-timeline" onclick="mostrarLineaVirreyes()">
                    <span class="btn-icon">📅</span> LÍNEA DE VIRREYES
                </button>
            </div>
            
            <!-- VISUALIZACIÓN DE JERARQUÍA -->
            <div class="simulator-visualization" id="visualizacionJerarquia">
                <div class="jerarquia-container">
                    <svg viewBox="0 0 600 500" id="svgJerarquia">
                        <!-- Fondo -->
                        <rect x="0" y="0" width="600" height="500" fill="#0a0a1a" id="fondoJerarquia"/>
                        
                        <!-- Pirámide de poder -->
                        <polygon points="300,50 100,200 500,200" fill="rgba(255, 193, 7, 0.1)" stroke="#FFC107" stroke-width="2"/>
                        <polygon points="150,220 450,220 300,350" fill="rgba(33, 150, 243, 0.1)" stroke="#2196F3" stroke-width="2"/>
                        <polygon points="200,370 400,370 300,450" fill="rgba(76, 175, 80, 0.1)" stroke="#4CAF50" stroke-width="2"/>
                        
                        <!-- Nivel 1: Rey -->
                        <g id="nodoRey" class="nodo-poder" data-poder="rey">
                            <circle cx="300" cy="80" r="30" fill="#FFC107" opacity="0.8"/>
                            <text x="300" y="80" fill="white" text-anchor="middle" font-size="12">REY</text>
                            <text x="300" y="100" fill="#FFECB3" text-anchor="middle" font-size="8">España</text>
                        </g>
                        
                        <!-- Nivel 2: Virrey -->
                        <g id="nodoVirrey" class="nodo-poder" data-poder="virrey">
                            <rect x="275" y="180" width="50" height="40" rx="5" fill="#2196F3" opacity="0.7"/>
                            <text x="300" y="200" fill="white" text-anchor="middle" font-size="10">VIRREY</text>
                            <text x="300" y="215" fill="#BBDEFB" text-anchor="middle" font-size="7">Nueva España</text>
                        </g>
                        
                        <!-- Nivel 3: Instituciones -->
                        <g id="nodoAudiencia" class="nodo-poder" data-poder="audiencia">
                            <rect x="180" y="250" width="80" height="35" rx="4" fill="#4CAF50" opacity="0.6"/>
                            <text x="220" y="270" fill="white" text-anchor="middle" font-size="9">AUDIENCIA</text>
                        </g>
                        
                        <g id="nodoIglesia" class="nodo-poder" data-poder="iglesia">
                            <rect x="340" y="250" width="80" height="35" rx="4" fill="#9C27B0" opacity="0.6"/>
                            <text x="380" y="270" fill="white" text-anchor="middle" font-size="9">IGLESIA</text>
                        </g>
                        
                        <!-- Nivel 4: Base -->
                        <g id="nodoEncomienda" class="nodo-poder" data-poder="encomendero">
                            <rect x="120" y="330" width="90" height="35" rx="4" fill="#FF9800" opacity="0.6"/>
                            <text x="165" y="350" fill="white" text-anchor="middle" font-size="8">ENCOMIENDA</text>
                        </g>
                        
                        <g id="nodoMineria" class="nodo-poder" data-poder="mineria">
                            <rect x="240" y="330" width="70" height="35" rx="4" fill="#795548" opacity="0.6"/>
                            <text x="275" y="350" fill="white" text-anchor="middle" font-size="8">MINERÍA</text>
                        </g>
                        
                        <g id="nodoCabildo" class="nodo-poder" data-poder="cabildo">
                            <rect x="340" y="330" width="70" height="35" rx="4" fill="#607D8B" opacity="0.6"/>
                            <text x="375" y="350" fill="white" text-anchor="middle" font-size="8">CABILDO</text>
                        </g>
                        
                        <!-- Base: Sociedad -->
                        <rect x="100" y="400" width="400" height="40" rx="5" fill="rgba(255, 255, 255, 0.05)" stroke="#9E9E9E" stroke-width="1"/>
                        <text x="300" y="420" fill="#BDBDBD" text-anchor="middle" font-size="9">SOCIEDAD COLONIAL: Castas y Trabajadores</text>
                        
                        <!-- Conexiones -->
                        <line x1="300" y1="110" x2="300" y2="180" stroke="#FFC107" stroke-width="2" stroke-dasharray="5,5"/>
                        <line x1="300" y1="220" x2="220" y2="250" stroke="#2196F3" stroke-width="1.5"/>
                        <line x1="300" y1="220" x2="380" y2="250" stroke="#2196F3" stroke-width="1.5"/>
                        <line x1="220" y1="285" x2="165" y2="330" stroke="#4CAF50" stroke-width="1"/>
                        <line x1="380" y1="285" x2="375" y2="330" stroke="#9C27B0" stroke-width="1"/>
                        
                        <!-- Nodo destacado -->
                        <g id="nodoDestacado" opacity="0">
                            <circle id="glowCircle" r="35" fill="none" stroke="#FFFF00" stroke-width="3" stroke-dasharray="5,5">
                                <animate attributeName="opacity" values="0.5;0.2;0.5" dur="2s" repeatCount="indefinite"/>
                            </circle>
                        </g>
                    </svg>
                </div>
                <div class="jerarquia-info" id="infoJerarquia">
                    Selecciona un nivel de poder para explorar sus características
                </div>
            </div>
            
            <!-- DATOS EN TIEMPO REAL -->
            <div class="simulator-data">
                <h3>DATOS DE PODER COLONIAL</h3>
                
                <div class="data-card">
                    <div class="data-label">Nivel seleccionado:</div>
                    <div class="data-value" id="dataNivel">Rey</div>
                </div>
                
                <div class="data-card">
                    <div class="data-label">Poder formal:</div>
                    <div class="data-value" id="dataPoderFormal">Absoluto</div>
                </div>
                
                <div class="data-card">
                    <div class="data-label">Poder real:</div>
                    <div class="data-value" id="dataPoderReal">Limitado por distancia</div>
                </div>
                
                <div class="data-card highlight">
                    <div class="data-label">RECURSOS PRINCIPALES:</div>
                    <div class="data-value" id="dataRecursos">Legitimidad divina</div>
                </div>
                
                <div class="data-card">
                    <div class="data-label">Limitaciones:</div>
                    <div class="data-value" id="dataLimitaciones">Distancia, información tardía</div>
                </div>
                
                <div class="data-card">
                    <div class="data-label">Ejemplo histórico:</div>
                    <div class="data-value" id="dataEjemplo">Carlos V</div>
                </div>
                
                <div class="estadisticas">
                    <h4>📊 ESTADÍSTICAS VIRREINALES</h4>
                    <div class="stat-item">
                        <span>Duración virreinato:</span>
                        <span class="stat-value">300 años</span>
                    </div>
                    <div class="stat-item">
                        <span>Total virreyes:</span>
                        <span class="stat-value">63</span>
                    </div>
                    <div class="stat-item">
                        <span>Plata exportada:</span>
                        <span class="stat-value">48M pesos oro</span>
                    </div>
                    <div class="stat-item">
                        <span>Población 1810:</span>
                        <span class="stat-value">6M habitantes</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- QUIZ INTERACTIVO -->
    <section class="quiz-section">
        <h2 class="seccion-titulo neon-evaluacion">
            <span class="icon">❓</span> QUIZ: CONOCIMIENTO COLONIAL
        </h2>
        
        <div class="quiz-container">
            <!-- PREGUNTA 1 -->
            <div class="quiz-question" data-correct="B">
                <div class="quiz-header">
                    <span class="quiz-num">01</span>
                    <h3>¿Cuál era la principal función económica del Virreinato para España?</h3>
                </div>
                
                <div class="quiz-options">
                    <button class="quiz-option" data-value="A">
                        <span class="option-letter">A</span>
                        Producir alimentos para la península
                    </button>
                    <button class="quiz-option" data-value="B">
                        <span class="option-letter">B</span>
                        Extraer metales preciosos (plata y oro)
                    </button>
                    <button class="quiz-option" data-value="C">
                        <span class="option-letter">C</span>
                        Desarrollar industria manufacturera
                    </button>
                    <button class="quiz-option" data-value="D">
                        <span class="option-letter">D</span>
                        Crear centros de investigación científica
                    </button>
                </div>
                
                <div class="quiz-feedback" style="display: none;">
                    <div class="feedback-correct">
                        ✅ <strong>Correcto:</strong> La minería de plata fue el motor económico colonial.
                    </div>
                    <div class="feedback-incorrect">
                        ❌ <strong>Incorrecto:</strong> La Nueva España era principalmente extractiva, no industrial.
                    </div>
                    <div class="feedback-explicacion">
                        <p><strong>Explicación:</strong> El 80% de la plata mundial del siglo XVIII provenía de Nueva España. El "quinto real" (20% impuesto) financió el imperio español. Zacatecas y Guanajuato eran los principales centros mineros.</p>
                    </div>
                </div>
            </div>
            
            <!-- PREGUNTA 2 -->
            <div class="quiz-question" data-correct="C">
                <div class="quiz-header">
                    <span class="quiz-num">02</span>
                    <h3>¿Qué diferencia clave existía entre peninsulares y criollos?</h3>
                </div>
                
                <div class="quiz-options">
                    <button class="quiz-option" data-value="A">
                        <span class="option-letter">A</span>
                        Los criollos no podían tener propiedades
                    </button>
                    <button class="quiz-option" data-value="B">
                        <span class="option-letter">B</span>
                        Los peninsulares no podían participar en comercio
                    </button>
                    <button class="quiz-option" data-value="C">
                        <span class="option-letter">C</span>
                        Los peninsulares monopolizaban los altos cargos
                    </button>
                    <button class="quiz-option" data-value="D">
                        <span class="option-letter">D</span>
                        Los criollos no podían recibir educación
                    </button>
                </div>
                
                <div class="quiz-feedback" style="display: none;">
                    <div class="feedback-correct">
                        ✅ <strong>Correcto:</strong> Los peninsulares (0.2% población) controlaban los cargos más importantes.
                    </div>
                    <div class="feedback-incorrect">
                        ❌ <strong>Incorrecto:</strong> Los criollos (22.8%) podían tener propiedades y comerciar, pero no gobernar.
                    </div>
                    <div class="feedback-explicacion">
                        <p><strong>Dato:</strong> Esta discriminación política hacia los criollos (nacidos en América de padres españoles) fue una causa importante del movimiento de independencia. Los "gachupines" mantenían el control administrativo.</p>
                    </div>
                </div>
            </div>
            
            <!-- PREGUNTA 3 -->
            <div class="quiz-question" data-correct="D">
                <div class="quiz-header">
                    <span class="quiz-num">03</span>
                    <h3>¿Qué institución limitaba el poder del virrey y podía juzgarlo?</h3>
                </div>
                
                <div class="quiz-options">
                    <button class="quiz-option" data-value="A">
                        <span class="option-letter">A</span>
                        Los cabildos municipales
                    </button>
                    <button class="quiz-option" data-value="B">
                        <span class="option-letter">B</span>
                        Los encomenderos
                    </button>
                    <button class="quiz-option" data-value="C">
                        <span class="option-letter">C</span>
                        Las órdenes religiosas
                    </button>
                    <button class="quiz-option" data-value="D">
                        <span class="option-letter">D</span>
                        Las audiencias
                    </button>
                </div>
                
                <div class="quiz-feedback" style="display: none;">
                    <div class="feedback-correct">
                        ✅ <strong>Correcto:</strong> Las audiencias funcionaban como contrapeso al poder virreinal.
                    </div>
                    <div class="feedback-incorrect">
                        ❌ <strong>Incorrecto:</strong> Otras instituciones tenían poder, pero las audiencias tenían autoridad judicial sobre el virrey.
                    </div>
                    <div class="feedback-explicacion">
                        <p><strong>Solución:</strong> La Audiencia de México (1527) y luego la de Guadalajara (1548) podían enviar informes directos al rey, asesorar al virrey y realizar el "juicio de residencia" al final de su mandato.</p>
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

    <!-- PROBLEMAS TIPO EXAMEN -->
    <section class="examen-section">
        <h2 class="seccion-titulo neon-evaluacion">
            <span class="icon">📝</span> ANÁLISIS HISTÓRICO COLONIAL
        </h2>
        
        <div class="examen-container">
            <div class="problema-card">
                <div class="problema-header">
                    <span class="problema-num">P1</span>
                    <h3>Análisis del Sistema de Encomienda</h3>
                </div>
                <div class="problema-enunciado">
                    <p>Analiza el sistema de encomienda respondiendo:</p>
                    <ol>
                        <li>¿Cuál era su justificación legal y religiosa?</li>
                        <li>¿Qué derechos y obligaciones teóricas tenía el encomendero?</li>
                        <li>¿Cómo funcionaba en la práctica y qué abusos se cometían?</li>
                        <li>¿Qué medidas intentó tomar la corona para limitar estos abusos?</li>
                    </ol>
                    
                    <div class="tabla-analisis">
                        <table>
                            <tr>
                                <th>Aspecto</th>
                                <th>Teoría (legal)</th>
                                <th>Práctica (realidad)</th>
                            </tr>
                            <tr>
                                <td><strong>Derechos encomendero</strong></td>
                                <td><textarea placeholder="Según las leyes..." rows="3"></textarea></td>
                                <td><textarea placeholder="En la realidad..." rows="3"></textarea></td>
                            </tr>
                            <tr>
                                <td><strong>Obligaciones indígenas</strong></td>
                                <td><textarea placeholder="Según las leyes..." rows="3"></textarea></td>
                                <td><textarea placeholder="En la realidad..." rows="3"></textarea></td>
                            </tr>
                            <tr>
                                <td><strong>Protección y evangelización</strong></td>
                                <td><textarea placeholder="Según las leyes..." rows="3"></textarea></td>
                                <td><textarea placeholder="En la realidad..." rows="3"></textarea></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <button class="btn-verificar" onclick="verificarProblema(1)">VERIFICAR ANÁLISIS</button>
                <div class="problema-solucion" id="solucionP1" style="display: none;">
                    <strong>Análisis sugerido:</strong><br>
                    1. <strong>Justificación:</strong> Derecho de conquista + obligación evangelizadora (Requerimiento 1513)<br>
                    2. <strong>Derechos teóricos:</strong> Tributo indígena + trabajo moderado<br>
                    3. <strong>Obligaciones teóricas:</strong> Protección militar + evangelización<br>
                    4. <strong>Realidad:</strong> Trabajo forzado, abusos, enfermedades, alta mortalidad<br>
                    5. <strong>Medidas corona:</strong> Leyes Nuevas (1542), visitas, juicios de residencia<br><br>
                    <strong>Contradicción:</strong> Intereses económicos vs. protección indígena
                </div>
            </div>
            
            <div class="problema-card">
                <div class="problema-header">
                    <span class="problema-num">P2</span>
                    <h3>Comparativa: Poder Civil vs. Poder Eclesiástico</h3>
                </div>
                <div class="problema-enunciado">
                    <p>Compara el poder de las instituciones civiles y eclesiásticas en la Nueva España:</p>
                    
                    <div class="comparativa-doble">
                        <div class="columna">
                            <h4>🏛️ PODER CIVIL (Virrey/Audiencias)</h4>
                            <ul>
                                <li>Fuentes de legitimidad:</li>
                                <textarea placeholder="Describe..." rows="2"></textarea>
                                <li>Recursos económicos:</li>
                                <textarea placeholder="Describe..." rows="2"></textarea>
                                <li>Instrumentos de control:</li>
                                <textarea placeholder="Describe..." rows="2"></textarea>
                                <li>Limitaciones:</li>
                                <textarea placeholder="Describe..." rows="2"></textarea>
                            </ul>
                        </div>
                        
                        <div class="columna">
                            <h4>⛪ PODER ECLESIÁSTICO (Iglesia)</h4>
                            <ul>
                                <li>Fuentes de legitimidad:</li>
                                <textarea placeholder="Describe..." rows="2"></textarea>
                                <li>Recursos económicos:</li>
                                <textarea placeholder="Describe..." rows="2"></textarea>
                                <li>Instrumentos de control:</li>
                                <textarea placeholder="Describe..." rows="2"></textarea>
                                <li>Limitaciones:</li>
                                <textarea placeholder="Describe..." rows="2"></textarea>
                            </ul>
                        </div>
                    </div>
                    
                    <p><strong>Pregunta crítica:</strong> ¿Qué institución tenía mayor poder real en la vida cotidiana de los habitantes y por qué?</p>
                    <textarea placeholder="Escribe tu análisis comparativo..." rows="4"></textarea>
                </div>
                <button class="btn-verificar" onclick="verificarProblema(2)">VERIFICAR COMPARATIVA</button>
                <div class="problema-solucion" id="solucionP2" style="display: none;">
                    <strong>Comparativa sugerida:</strong><br>
                    <strong>Poder Civil:</strong> Legitimidad real, impuestos, ejército, burocracia. Limitaciones: distancia, corrupción.<br>
                    <strong>Poder Eclesiástico:</strong> Legitimidad divina, diezmo, Inquisición, educación, sacramentos. Limitaciones: vicepatronato real.<br><br>
                    <strong>Análisis:</strong> La Iglesia tenía mayor penetración social (bautizos, matrimonios, educación, muerte). Controlaba la moral y creencias. El vicepatronato daba al rey control sobre nombramientos, pero la Iglesia mantenía influencia cotidiana.
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
                    <td>Comprensión estructural</td>
                    <td>Explica claramente jerarquía y relaciones de poder</td>
                    <td>Describe mayoría de instituciones correctamente</td>
                    <td>Confunde instituciones y sus funciones</td>
                </tr>
                <tr>
                    <td>Análisis crítico</td>
                    <td>Compara teoría vs. práctica, identifica contradicciones</td>
                    <td>Menciona algunas diferencias teoría/práctica</td>
                    <td>No distingue entre discurso oficial y realidad</td>
                </tr>
                <tr>
                    <td>Conexión histórica</td>
                    <td>Relaciona estructuras coloniales con México actual</td>
                    <td>Menciona algunos legados coloniales</td>
                    <td>No establece conexiones con el presente</td>
                </tr>
            </table>
        </div>
    </section>

    <!-- CIERRE METACOGNITIVO -->
    <section class="cierre-section">
        <h2 class="seccion-titulo neon-concepto">
            <span class="icon">🧠</span> REFLEXIÓN SOBRE EL LEGADO COLONIAL
        </h2>
        
        <div class="cierre-container">
            <div class="autoevaluacion">
                <h3>📊 AUTOEVALUACIÓN DE CONOCIMIENTOS</h3>
                <div class="slider-group">
                    <label>Entendimiento estructura de poder:</label>
                    <input type="range" min="1" max="5" value="3" class="autoeval-slider" id="slider1">
                    <div class="slider-labels">
                        <span>Básico</span><span>Intermedio</span><span>Avanzado</span>
                    </div>
                </div>
                
                <div class="slider-group">
                    <label>Análisis sistema económico:</label>
                    <input type="range" min="1" max="5" value="3" class="autoeval-slider" id="slider2">
                    <div class="slider-labels">
                        <span>Básico</span><span>Intermedio</span><span>Avanzado</span>
                    </div>
                </div>
                
                <div class="slider-group">
                    <label>Comprensión sistema de castas:</label>
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
                    <p>¿Qué elementos del sistema colonial consideras que siguen influyendo en la sociedad mexicana actual?</p>
                    <textarea placeholder="Escribe tu reflexión aquí..." rows="4" id="reflexion1"></textarea>
                </div>
                <div class="pregunta-reflexion">
                    <p>¿Cómo explicas la contradicción entre el discurso evangelizador/protector y la realidad de explotación?</p>
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
                        <li>Memorizar estructura jerárquica colonial</li>
                        <li>Recordar diferencias entre sistemas económicos</li>
                        <li>Identificar los 5 niveles del sistema de castas</li>
                    </ul>
                </div>
                <div class="plan-card">
                    <h4>💪 PRÁCTICA (30 min)</h4>
                    <ul>
                        <li>Explorar simulador de jerarquía de poder</li>
                        <li>Completar el quiz de autoevaluación</li>
                        <li>Analizar tabla teoría vs. práctica en encomienda</li>
                    </ul>
                </div>
                <div class="plan-card">
                    <h4>🚀 PROFUNDIZACIÓN (45 min)</h4>
                    <ul>
                        <li>Investigar un virrey específico y sus políticas</li>
                        <li>Analizar documentos de la Inquisición</li>
                        <li>Estudiar continuidades coloniales en México actual</li>
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="recursos">
            <h3>🔗 RECURSOS ADICIONALES</h3>
            <div class="recursos-links">
                <a href="https://www.cervantesvirtual.com/portales/nueva_espana/" target="_blank" class="recurso-link">
                    📜 Biblioteca Virtual Cervantes: Nueva España
                </a>
                <a href="https://www.inah.gob.mx/" target="_blank" class="recurso-link">
                    🏛️ INAH: Archivo General de la Nación
                </a>
                <a href="https://mediateca.inah.gob.mx/repositorio/islandora/object/coleccion%3A70" target="_blank" class="recurso-link">
                    🖼️ Mediateca INAH: Imágenes coloniales
                </a>
                <a href="https://www.historicas.unam.mx/publicaciones/publicadigital/libros/ virreinato.html" target="_blank" class="recurso-link">
                    📚 UNAM: Estudios sobre el virreinato
                </a>
            </div>
        </div>
    </section>

    <!-- JAVASCRIPT INTEGRADO -->
    <script>
    // ========================================
    // SIMULADOR DE JERARQUÍA COLONIAL
    // ========================================
    
    const datosPoder = {
        rey: {
            nombre: "Rey de España",
            poderFormal: "Absoluto (monarquía absoluta)",
            poderReal: "Limitado por distancia (6 meses comunicación)",
            recursos: "Legitimidad divina, ejército, legislación",
            limitaciones: "Información tardía, dependencia de funcionarios",
            ejemplo: "Felipe II (1556-1598)",
            color: "#FFC107"
        },
        virrey: {
            nombre: "Virrey",
            poderFormal: "Vicepatrono real, gobierno pleno",
            poderReal: "Autonomía limitada por audiencias",
            recursos: "Ejército colonial, administración, justicia",
            limitaciones: "Juicio de residencia, informes a audiencia",
            ejemplo: "Antonio de Mendoza (1535-1550)",
            color: "#2196F3"
        },
        audiencia: {
            nombre: "Audiencia",
            poderFormal: "Tribunal supremo, asesoría",
            poderReal: "Contrapeso al virrey, informes directos al rey",
            recursos: "Autoridad judicial, revisión de cuentas",
            limitaciones: "Conflictos con virrey, corrupción",
            ejemplo: "Audiencia de México (1527)",
            color: "#4CAF50"
        },
        encomendero: {
            nombre: "Encomendero",
            poderFormal: "Derecho a tributo indígena",
            poderReal: "Poder local casi feudal",
            recursos: "Mano de obra indígena, producción agrícola",
            limitaciones: "Leyes Nuevas (1542), visitas reales",
            ejemplo: "Hernán Cortés (Marqués del Valle)",
            color: "#FF9800"
        },
        iglesia: {
            nombre: "Iglesia",
            poderFormal: "Evangelización, sacramentos",
            poderReal: "Control ideológico, educación, salud",
            recursos: "Diezmo, propiedades, Inquisición",
            limitaciones: "Vicepatronato real, conflictos con autoridades",
            ejemplo: "Arzobispo-virrey (Juan de Palafox)",
            color: "#9C27B0"
        },
        cabildo: {
            nombre: "Cabildo Municipal",
            poderFormal: "Gobierno local, obras públicas",
            poderReal: "Poder urbano, representación criolla",
            recursos: "Impuestos locales, reglamentos municipales",
            limitaciones: "Control virreinal, recursos limitados",
            ejemplo: "Cabildo de la Ciudad de México",
            color: "#607D8B"
        },
        mineria: {
            nombre: "Minería",
            poderFormal: "Extracción de plata (quinto real)",
            poderReal: "Poder económico, influencia política",
            recursos: "Riqueza, empleo, desarrollo regional",
            limitaciones: "Tecnología, mano de obra, precios",
            ejemplo: "Minas de Zacatecas (1548)",
            color: "#795548"
        }
    };
    
    function cambiarNivelPoder() {
        const nivel = document.getElementById(\'poderSelect\').value;
        const data = datosPoder[nivel];
        
        if (!data) return;
        
        // Actualizar datos en tiempo real
        document.getElementById(\'dataNivel\').textContent = data.nombre;
        document.getElementById(\'dataPoderFormal\').textContent = data.poderFormal;
        document.getElementById(\'dataPoderReal\').textContent = data.poderReal;
        document.getElementById(\'dataRecursos\').textContent = data.recursos;
        document.getElementById(\'dataLimitaciones\').textContent = data.limitaciones;
        document.getElementById(\'dataEjemplo\').textContent = data.ejemplo;
        
        // Resaltar nodo en SVG
        resaltarNodoJerarquia(nivel, data.color);
        
        // Actualizar información
        const infoTextos = {
            rey: "👑 REY: Autoridad suprema desde España. Poder teóricamente absoluto pero limitado por la distancia (6 meses para recibir órdenes). Controlaba mediante cédulas reales y el Consejo de Indias.",
            virrey: "🏛️ VIRREY: Representante directo del rey en Nueva España. Gobierno, justicia, guerra. 63 virreyes en 300 años. Juicio de residencia al finalizar mandato.",
            audiencia: "⚖️ AUDIENCIA: Tribunal supremo y consejo. Contrapeso al poder virreinal. Podía enviar informes directos al rey. Ejemplo: Audiencia de México (1527).",
            encomendero: "⛓️ ENCOMENDERO: Sistema de explotación indígena. Derecho a tributo y trabajo a cambio de protección y evangelización. Abusos generalizados.",
            iglesia: "⛪ IGLESIA: Poder ideológico y económico. Controlaba educación, salud, moral. Mayor terrateniente. Inquisición (1571-1820) para control religioso.",
            cabildo: "🏙️ CABILDO: Gobierno municipal. Espacio de poder criollo. Administración local, obras públicas. Semilla del gobierno representativo.",
            mineria: "⛏️ MINERÍA: Motor económico colonial. 80% plata mundial siglo XVIII. Quinto real (20% para corona). Zacatecas, Guanajuato principales centros."
        };
        
        document.getElementById(\'infoJerarquia\').textContent = infoTextos[nivel] || "Información no disponible";
        document.getElementById(\'infoJerarquia\').style.animation = "highlight 0.5s";
        
        console.log(`🏛️ Nivel de poder seleccionado: ${data.nombre}`);
    }
    
    function resaltarNodoJerarquia(nivel, color) {
        const nodoDestacado = document.getElementById(\'nodoDestacado\');
        const nodo = document.getElementById(`nodo${nivel.charAt(0).toUpperCase() + nivel.slice(1)}`);
        
        if (!nodo) return;
        
        const bbox = nodo.getBBox();
        const circle = document.getElementById(\'glowCircle\');
        
        // Posicionar círculo de resaltado
        circle.setAttribute(\'cx\', bbox.x + bbox.width/2);
        circle.setAttribute(\'cy\', bbox.y + bbox.height/2);
        circle.setAttribute(\'stroke\', color);
        
        nodoDestacado.setAttribute(\'opacity\', \'1\');
        
        // Animar todos los nodos
        document.querySelectorAll(\'.nodo-poder\').forEach(n => {
            n.setAttribute(\'opacity\', \'0.4\');
        });
        
        nodo.setAttribute(\'opacity\', \'1\');
        nodo.setAttribute(\'filter\', \'url(#glowFilter)\');
    }
    
    function compararPoderes() {
        const checkboxes = document.querySelectorAll(\'input[name="recursos"]:checked\');
        const recursos = Array.from(checkboxes).map(cb => cb.value);
        
        let comparativa = "🔍 COMPARATIVA DE RECURSOS DE PODER:\\n\\n";
        
        if (recursos.includes(\'legitimidad\')) {
            comparativa += "👑 Legitimidad: Rey (divina) > Iglesia (religiosa) > Virrey (delegada)\\n";
        }
        if (recursos.includes(\'economico\')) {
            comparativa += "💰 Económico: Minería > Iglesia > Encomienda > Haciendas\\n";
        }
        if (recursos.includes(\'militar\')) {
            comparativa += "⚔️ Militar: Virrey > Rey (distante) > Encomenderos (local)\\n";
        }
        if (recursos.includes(\'ideologico\')) {
            comparativa += "🧠 Ideológico: Iglesia > Rey > Audiencia (justicia)\\n";
        }
        
        comparativa += "\\n💡 El poder real dependía de alianzas y contextos específicos.";
        
        alert(comparativa);
    }
    
    function mostrarLineaVirreyes() {
        const periodo = document.getElementById(\'periodoSelect\').value;
        let virreyes = "";
        
        const ejemplos = {
            sigloXVI: "Antonio de Mendoza (1535-1550), Luis de Velasco (1550-1564), Martín Enríquez (1568-1580)",
            sigloXVII: "Diego Fernández de Córdoba (1612-1621), Juan de Palafox (1642), Francisco Fernández de la Cueva (1653-1660)",
            sigloXVIII: "Juan de Acuña (1722-1734), Antonio María de Bucareli (1771-1779), Revillagigedo (1789-1794)",
            sigloXIX: "Félix Berenguer (1800-1803), José de Iturrigaray (1803-1808), Juan O\'Donojú (1821)"
        };
        
        virreyes = `VIRREYES DESTACADOS (${periodo.replace(\'siglo\', \'Siglo \').toUpperCase()}):\\n\\n${ejemplos[periodo]}`;
        
        alert(virreyes);
    }
    
    // ========================================
    // SISTEMA DE DETALLES DE NIVELES
    // ========================================
    
    function mostrarDetalleNivel(nivel) {
        // Ocultar todos los detalles
        document.querySelectorAll(\'.detalle-nivel\').forEach(detalle => {
            detalle.style.display = \'none\';
        });
        
        // Mostrar el detalle seleccionado
        const detalle = document.getElementById(`detalle${nivel.charAt(0).toUpperCase() + nivel.slice(1)}`);
        if (detalle) {
            detalle.style.display = \'block\';
        }
        
        // Actualizar información de la tabla
        const infoTextos = {
            rey: "👑 REY: Máxima autoridad. Gobernaba mediante cédulas reales. Consejo de Indias (1524) supervisaba colonias. Legislación: Leyes de Indias (1680) con 6,400 leyes.",
            virrey: "🏛️ VIRREY: Poder ejecutivo, judicial y militar. 63 en total. Promedio: 4.5 años. Juicio de residencia obligatorio. Funciones: gobierno, justicia, guerra, hacienda.",
            audiencia: "⚖️ AUDIENCIA: Tribunal y consejo. Control judicial, asesoría al virrey. Podía enviar informes secretos al rey. Juicio de residencia a virreyes.",
            cabildo: "🏙️ CABILDO: Gobierno municipal. Regidores y alcaldes. Representación local, obras públicas, administración diaria. Espacio de poder criollo."
        };
        
        document.getElementById(\'infoNivel\').textContent = infoTextos[nivel] || "Información no disponible";
        document.getElementById(\'infoNivel\').style.animation = "highlight 0.5s";
        
        // Remover selección previa
        document.querySelectorAll(\'.tabla-cyberpunk tbody tr\').forEach(tr => {
            tr.classList.remove(\'selected\');
        });
        
        // Marcar fila seleccionada
        document.querySelector(`[data-nivel="${nivel}"]`).classList.add(\'selected\');
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
            feedback = "🎉 ¡Excelente! Dominas la estructura colonial.";
        } else if (porcentaje >= 60) {
            feedback = "👍 Buen trabajo, pero revisa las diferencias entre instituciones.";
        } else {
            feedback = "📚 Necesitas repasar la organización del virreinato.";
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
    // SISTEMA DE AUTOEVALUACIÓN
    // ========================================
    
    function guardarAutoevaluacion() {
        const slider1 = document.getElementById(\'slider1\').value;
        const slider2 = document.getElementById(\'slider2\').value;
        const slider3 = document.getElementById(\'slider3\').value;
        
        const promedio = (parseInt(slider1) + parseInt(slider2) + parseInt(slider3)) / 3;
        
        alert(`📊 AutoEvaluación guardada:\\n\\n` +
              `Estructura de poder: ${slider1}/5\\n` +
              `Sistema económico: ${slider2}/5\\n` +
              `Sistema de castas: ${slider3}/5\\n\\n` +
              `Promedio: ${promedio.toFixed(1)}/5\\n\\n` +
              `Revisa el plan de estudio recomendado según tus resultados.`);
        
        console.log(`💾 AutoEvaluación guardada: ${slider1}, ${slider2}, ${slider3}`);
    }
    
    // ========================================
    // INICIALIZACIÓN
    // ========================================
    
    console.log("🚀 Sistema Cyberpunk Colonial inicializado");
    console.log("📚 Lección: Virreinato de Nueva España");
    console.log("⚡ Simulador de jerarquía, Quiz y Herramientas listas");
    
    // Inicializar simulador
    cambiarNivelPoder();
    
    // Tabla interactiva
    document.querySelectorAll(\'.tabla-cyberpunk tbody tr\').forEach(row => {
        row.addEventListener(\'click\', function() {
            const nivel = this.dataset.nivel;
            mostrarDetalleNivel(nivel);
        });
    });
    
    // Sistemas económicos interactivos
    document.querySelectorAll(\'.sistema-card\').forEach(card => {
        card.addEventListener(\'click\', function() {
            const sistema = this.dataset.sistema;
            
            const sistemasInfo = {
                encomienda: "ENCOMIENDA: Sistema de explotación indígena (1521-1720). \'Encomendar\' indígenas a españoles para trabajo y evangelización. En teoría: protección a cambio de tributo. En práctica: trabajo forzado, abusos. Regulada por Leyes Nuevas (1542).",
                mineria: "MINERÍA: Principal actividad económica. Método del patio (amalgama con mercurio). Quinto real: 20% para corona. Zacatecas (1548), Guanajuato, Pachuca. 80% plata mundial siglo XVIII.",
                hacienda: "HACIENDAS: Latifundios para agricultura y ganadería. Sistema de peonaje por deudas. Autosuficientes: producían alimentos, textiles, herramientas. Base de desigualdad agraria moderna.",
                comercio: "COMERCIO: Monopolio español. Flotas anuales Veracruz-Sevilla. Exportación: plata, cochinilla, cacao. Importación: manufacturas. Contrabando común. Reformas borbónicas liberalizaron parcialmente."
            };
            
            alert(`💰 ${this.querySelector(\'h4\').textContent}\\n\\n${sistemasInfo[sistema] || "Información no disponible"}`);
        });
    });
    
    // Piramide de castas interactiva
    document.querySelectorAll(\'.nivel-casta\').forEach(nivel => {
        nivel.addEventListener(\'click\', function() {
            const casta = this.dataset.casta;
            
            const castasInfo = {
                espanoles: "ESPAÑOLES PENINSULARES (0.2%): Nacidos en España. Monopolio cargos altos: virrey, obispos, audiencias. \'Gachupines\'. Todos derechos políticos.",
                criollos: "CRIOLLOS (22.8%): Hijos de españoles nacidos en América. Riqueza (haciendas, minas) pero no poder político. Resentimiento hacia peninsulares → independencia.",
                mestizos: "MESTIZOS (7.3%): Mezcla español-indígena. Artesanos, pequeños comerciantes. No pagaban tributo pero derechos limitados. Creciente población.",
                indigenas: "INDÍGENAS (60%): Población originaria. Tributo obligatorio. Trabajo forzado en minas/encomiendas. \'Protegidos\' por ley pero explotados. Alta mortalidad.",
                negros: "AFROMESTIZOS/NEGROS (9.7%): Esclavos africanos y descendientes. Trabajos más duros: minas, plantaciones. Sistema de castas complejo: mulatos, zambos."
            };
            
            this.style.animation = "highlight 1s";
            setTimeout(() => {
                this.style.animation = "";
            }, 1000);
            
            console.log(`👥 Casta seleccionada: ${casta.toUpperCase()}`);
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
    
    // Problemas de examen
    function verificarProblema(num) {
        const solucion = document.getElementById(`solucionP${num}`);
        solucion.style.display = solucion.style.display === \'block\' ? \'none\' : \'block\';
    }
    
    // Agregar filtro glow al SVG
    const svg = document.getElementById(\'svgJerarquia\');
    const defs = document.createElementNS(\'http://www.w3.org/2000/svg\', \'defs\');
    const filter = document.createElementNS(\'http://www.w3.org/2000/svg\', \'filter\');
    filter.setAttribute(\'id\', \'glowFilter\');
    filter.setAttribute(\'x\', \'-50%\');
    filter.setAttribute(\'y\', \'-50%\');
    filter.setAttribute(\'width\', \'200%\');
    filter.setAttribute(\'height\', \'200%\');
    
    const feGaussianBlur = document.createElementNS(\'http://www.w3.org/2000/svg\', \'feGaussianBlur\');
    feGaussianBlur.setAttribute(\'stdDeviation\', \'3.5\');
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
        'enunciado' => 'Representante del rey',
        'respuesta' => 'Virrey',
      ),
      1 => 
      array (
        'enunciado' => 'Sistema de trabajo indígena',
        'respuesta' => 'Encomienda',
      ),
      2 => 
      array (
        'enunciado' => 'Iglesia: función principal',
        'respuesta' => 'Evangelización',
      ),
      3 => 
      array (
        'enunciado' => 'Capital virreinal',
        'respuesta' => 'Ciudad de México',
      ),
      4 => 
      array (
        'enunciado' => 'Primer virrey',
        'respuesta' => 'Antonio de Mendoza',
      ),
      5 => 
      array (
        'enunciado' => 'Producto clave',
        'respuesta' => 'Plata',
      ),
      6 => 
      array (
        'enunciado' => 'Universidad fundada',
        'respuesta' => '1551 (Real y Pontificia)',
      ),
      7 => 
      array (
        'enunciado' => 'Nuevas Leyes',
        'respuesta' => '1542, protegen indígenas',
      ),
      8 => 
      array (
        'enunciado' => 'Catedral iniciada',
        'respuesta' => '1573',
      ),
      9 => 
      array (
        'enunciado' => 'Número de virreyes',
        'respuesta' => '63',
      ),
      10 => 
      array (
        'enunciado' => 'Castas: grupo superior',
        'respuesta' => 'Peninsulares',
      ),
      11 => 
      array (
        'enunciado' => 'SI: años virreinato',
        'respuesta' => '300',
      ),
    ),
    'quiz' => 
    array (
      0 => 
      array (
        'pregunta' => 'Virrey era',
        'opciones' => 
        array (
          0 => 'Representante del rey',
          1 => 'Rey',
          2 => 'Indígena',
          3 => 'Sacerdote',
        ),
        'correcta' => 'Representante del rey',
      ),
      1 => 
      array (
        'pregunta' => 'Encomienda era',
        'opciones' => 
        array (
          0 => 'Trabajo forzado',
          1 => 'Escuela',
          2 => 'Iglesia',
          3 => 'Comercio',
        ),
        'correcta' => 'Trabajo forzado',
      ),
      2 => 
      array (
        'pregunta' => 'Iglesia controlaba',
        'opciones' => 
        array (
          0 => 'Educación y evangelización',
          1 => 'Ejército',
          2 => 'Minas',
          3 => 'Nada',
        ),
        'correcta' => 'Educación y evangelización',
      ),
      3 => 
      array (
        'pregunta' => 'Capital',
        'opciones' => 
        array (
          0 => 'Ciudad de México',
          1 => 'Madrid',
          2 => 'Veracruz',
          3 => 'Guadalajara',
        ),
        'correcta' => 'Ciudad de México',
      ),
      4 => 
      array (
        'pregunta' => 'Primer virrey',
        'opciones' => 
        array (
          0 => 'Antonio de Mendoza',
          1 => 'Cortés',
          2 => 'Hidalgo',
          3 => 'Juárez',
        ),
        'correcta' => 'Antonio de Mendoza',
      ),
      5 => 
      array (
        'pregunta' => 'Economía principal',
        'opciones' => 
        array (
          0 => 'Plata',
          1 => 'Maíz',
          2 => 'Petróleo',
          3 => 'Turismo',
        ),
        'correcta' => 'Plata',
      ),
      6 => 
      array (
        'pregunta' => 'Universidad 1551',
        'opciones' => 
        array (
          0 => 'Real y Pontificia',
          1 => 'UNAM',
          2 => 'Harvard',
          3 => 'Ninguna',
        ),
        'correcta' => 'Real y Pontificia',
      ),
      7 => 
      array (
        'pregunta' => 'Nuevas Leyes',
        'opciones' => 
        array (
          0 => '1542',
          1 => '1492',
          2 => '1821',
          3 => '1910',
        ),
        'correcta' => '1542',
      ),
      8 => 
      array (
        'pregunta' => 'Catedral terminada',
        'opciones' => 
        array (
          0 => '1813',
          1 => '1521',
          2 => '1821',
          3 => '1910',
        ),
        'correcta' => '1813',
      ),
      9 => 
      array (
        'pregunta' => 'SI 2025: sitios coloniales',
        'opciones' => 
        array (
          0 => '1,200 INAH',
          1 => '100',
          2 => '10,000',
          3 => '0',
        ),
        'correcta' => '1,200 INAH',
      ),
      10 => 
      array (
        'pregunta' => 'Virreyes totales',
        'opciones' => 
        array (
          0 => '63',
          1 => '10',
          2 => '100',
          3 => '1',
        ),
        'correcta' => '63',
      ),
      11 => 
      array (
        'pregunta' => 'Palacio Nacional era',
        'opciones' => 
        array (
          0 => 'Sede virreinal',
          1 => 'Iglesia',
          2 => 'Mercado',
          3 => 'Prisión',
        ),
        'correcta' => 'Sede virreinal',
      ),
      12 => 
      array (
        'pregunta' => 'Encomenderos recibían',
        'opciones' => 
        array (
          0 => 'Tributos indígenas',
          1 => 'Salario',
          2 => 'Tierras',
          3 => 'Nada',
        ),
        'correcta' => 'Tributos indígenas',
      ),
      13 => 
      array (
        'pregunta' => 'Hacienda producía',
        'opciones' => 
        array (
          0 => 'Trigo, ganado',
          1 => 'Tecnología',
          2 => 'Coches',
          3 => 'Aviones',
        ),
        'correcta' => 'Trigo, ganado',
      ),
      14 => 
      array (
        'pregunta' => 'Zacatecas famosa por',
        'opciones' => 
        array (
          0 => 'Plata',
          1 => 'Oro',
          2 => 'Cobre',
          3 => 'Petróleo',
        ),
        'correcta' => 'Plata',
      ),
      15 => 
      array (
        'pregunta' => 'Castas: abajo',
        'opciones' => 
        array (
          0 => 'Indígenas y negros',
          1 => 'Criollos',
          2 => 'Peninsulares',
          3 => 'Mestizos',
        ),
        'correcta' => 'Indígenas y negros',
      ),
      16 => 
      array (
        'pregunta' => 'Inquisición llegó',
        'opciones' => 
        array (
          0 => '1571',
          1 => '1521',
          2 => '1821',
          3 => '1910',
        ),
        'correcta' => '1571',
      ),
      17 => 
      array (
        'pregunta' => 'Virrey nombraba',
        'opciones' => 
        array (
          0 => 'Por el rey',
          1 => 'Por indígenas',
          2 => 'Por voto',
          3 => 'Por Iglesia',
        ),
        'correcta' => 'Por el rey',
      ),
      18 => 
      array (
        'pregunta' => 'Real Audiencia',
        'opciones' => 
        array (
          0 => 'Control judicial',
          1 => 'Ejército',
          2 => 'Comercio',
          3 => 'Educación',
        ),
        'correcta' => 'Control judicial',
      ),
      19 => 
      array (
        'pregunta' => 'SI 2025: plata extraída',
        'opciones' => 
        array (
          0 => '~3,000 toneladas',
          1 => '100',
          2 => '1M',
          3 => '0',
        ),
        'correcta' => '~3,000 toneladas',
      ),
      20 => 
      array (
        'pregunta' => 'Mestizaje comenzó',
        'opciones' => 
        array (
          0 => 'Siglo XVI',
          1 => 'XVIII',
          2 => 'XX',
          3 => 'XXI',
        ),
        'correcta' => 'Siglo XVI',
      ),
      21 => 
      array (
        'pregunta' => 'Barroco novohispano',
        'opciones' => 
        array (
          0 => 'Arte colonial',
          1 => 'Indígena',
          2 => 'Moderno',
          3 => 'Abstracto',
        ),
        'correcta' => 'Arte colonial',
      ),
      22 => 
      array (
        'pregunta' => 'Virrey más famoso',
        'opciones' => 
        array (
          0 => 'Juan Vicente Güémez',
          1 => 'Mendoza',
          2 => 'Cortés',
          3 => 'Hidalgo',
        ),
        'correcta' => 'Juan Vicente Güémez',
      ),
      23 => 
      array (
        'pregunta' => 'Población 1800',
        'opciones' => 
        array (
          0 => '~6 millones',
          1 => '1M',
          2 => '20M',
          3 => '100K',
        ),
        'correcta' => '~6 millones',
      ),
      24 => 
      array (
        'pregunta' => 'Camino Real',
        'opciones' => 
        array (
          0 => 'México-Veracruz',
          1 => 'Madrid',
          2 => 'China',
          3 => 'Europa',
        ),
        'correcta' => 'México-Veracruz',
      ),
      25 => 
      array (
        'pregunta' => 'Galeón de Manila',
        'opciones' => 
        array (
          0 => 'Comercio Asia',
          1 => 'Guerra',
          2 => 'Evangelización',
          3 => 'Nada',
        ),
        'correcta' => 'Comercio Asia',
      ),
      26 => 
      array (
        'pregunta' => 'SI 2025: UNAM sucesora',
        'opciones' => 
        array (
          0 => 'Real y Pontificia',
          1 => 'Ninguna',
          2 => 'Harvard',
          3 => 'Oxford',
        ),
        'correcta' => 'Real y Pontificia',
      ),
      27 => 
      array (
        'pregunta' => 'Virreinato terminó',
        'opciones' => 
        array (
          0 => '1821',
          1 => '1521',
          2 => '1910',
          3 => '1810',
        ),
        'correcta' => '1821',
      ),
      28 => 
      array (
        'pregunta' => 'Reforma Borbónica',
        'opciones' => 
        array (
          0 => 'Siglo XVIII',
          1 => 'XVI',
          2 => 'XIX',
          3 => 'XX',
        ),
        'correcta' => 'Siglo XVIII',
      ),
      29 => 
      array (
        'pregunta' => 'Virreinato fue',
        'opciones' => 
        array (
          0 => '300 años',
          1 => '100',
          2 => '50',
          3 => '500',
        ),
        'correcta' => '300 años',
      ),
    ),
  ),
  3 => 
  array (
    'materia' => 'Historia de México',
    'slug' => 'independencia-mexico-cyberpunk',
    'titulo' => 'Independencia de México: De Hidalgo a Iturbide (1810-1821)',
    'contenido' => '<!-- INICIO LECCIÓN CYBERPUNK -->
<div class="leccion-container leccion-historia-independencia" data-tema="independencia-mexico">
    <!-- CABECERA CYBERPUNK -->
    <header class="leccion-header">
        <h1 class="titulo-leccion neon-glow">
            <span class="icon-tema">🎖️</span> INDEPENDENCIA CYBERPUNK
        </h1>
        <div class="subtitulo">
            La lucha por la libertad: <strong>11 años, 4 etapas, 1 nación</strong>
        </div>
    </header>

    <!-- PANEL OBJETIVOS -->
    <section class="panel-objetivos">
        <h2 class="seccion-titulo neon-concepto">
            <span class="icon">🎯</span> OBJETIVOS DE MISIÓN
        </h2>
        <div class="objetivos-grid">
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Identificar las 4 etapas</h3>
                <p>Iniciación, organización, resistencia y consumación.</p>
            </div>
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Analizar causas y consecuencias</h3>
                <p>Factores internos y externos del movimiento.</p>
            </div>
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Simular el Plan de Iguala</h3>
                <p>Usar el simulador de las Tres Garantías.</p>
            </div>
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Reflexionar sobre el legado</h3>
                <p>Impacto en la identidad nacional.</p>
            </div>
        </div>
    </section>

    <!-- CONTEXTO REAL -->
    <section class="contexto-real">
        <h2 class="seccion-titulo neon-dato">
            <span class="icon">🌍</span> CONTEXTO HISTÓRICO (2025)
        </h2>
        <div class="contexto-grid">
            <div class="contexto-card">
                <h3>📅 215 Años del Grito</h3>
                <p>En 2025 se conmemoran <strong>215 años</strong> del inicio de la Independencia.</p>
                <div class="dato-neon">16 de septiembre de 1810</div>
            </div>
            <div class="contexto-card">
                <h3>💥 Impacto Demográfico</h3>
                <p>La guerra causó <strong>600,000 muertos</strong> (10% de la población).</p>
                <div class="dato-neon">Crisis económica post-independencia</div>
            </div>
            <div class="contexto-card">
                <h3>🎭 Representaciones Modernas</h3>
                <p>Películas como <strong>"Hidalgo: La Mirada del Águila"</strong> (1998).</p>
                <div class="dato-neon">+50 obras artísticas inspiradas</div>
            </div>
        </div>
    </section>

    <!-- SECCIÓN TEÓRICA -->
    <section class="teoria-section">
        <div class="borde-neon-lateral"></div>
        <h2 class="seccion-titulo neon-concepto">
            <span class="icon">📜</span> CRONOLOGÍA DE LA INDEPENDENCIA
        </h2>

        <!-- ETAPAS -->
        <div class="subseccion">
            <h3>1. Las 4 Etapas (1810-1821)</h3>
            <div class="etapas-timeline">
                <div class="etapa-card" data-etapa="iniciacion">
                    <div class="etapa-header">
                        <div class="etapa-icon">🔥</div>
                        <h4>Iniciación (1810-1811)</h4>
                    </div>
                    <div class="etapa-content">
                        <p><strong>Líder:</strong> Miguel Hidalgo.</p>
                        <p><strong>Evento:</strong> Grito de Dolores (16 sep 1810).</p>
                        <p><strong>Logros:</strong> Toma de Guanajuato, Valladolid.</p>
                        <p><strong>Fin:</strong> Captura y ejecución de Hidalgo (1811).</p>
                    </div>
                    <div class="etapa-dato">📅 16 sep 1810 - 1811</div>
                </div>
                <div class="etapa-card" data-etapa="organizacion">
                    <div class="etapa-header">
                        <div class="etapa-icon">📜</div>
                        <h4>Organización (1811-1815)</h4>
                    </div>
                    <div class="etapa-content">
                        <p><strong>Líder:</strong> José María Morelos.</p>
                        <p><strong>Evento:</strong> Congreso de Chilpancingo (1813).</p>
                        <p><strong>Logros:</strong> Constitución de Apatzingán.</p>
                        <p><strong>Fin:</strong> Captura y ejecución de Morelos (1815).</p>
                    </div>
                    <div class="etapa-dato">📅 1811 - 22 dic 1815</div>
                </div>
                <div class="etapa-card" data-etapa="resistencia">
                    <div class="etapa-header">
                        <div class="etapa-icon">⚔️</div>
                        <h4>Resistencia (1815-1820)</h4>
                    </div>
                    <div class="etapa-content">
                        <p><strong>Líderes:</strong> Vicente Guerrero, Guadalupe Victoria.</p>
                        <p><strong>Evento:</strong> Guerra de guerrillas.</p>
                        <p><strong>Logros:</strong> Mantener viva la lucha.</p>
                        <p><strong>Fin:</strong> Abrazo de Acatempan (1821).</p>
                    </div>
                    <div class="etapa-dato">📅 1815 - 1820</div>
                </div>
                <div class="etapa-card" data-etapa="consumacion">
                    <div class="etapa-header">
                        <div class="etapa-icon">🎖️</div>
                        <h4>Consumación (1821)</h4>
                    </div>
                    <div class="etapa-content">
                        <p><strong>Líder:</strong> Agustín de Iturbide.</p>
                        <p><strong>Evento:</strong> Plan de Iguala (24 feb 1821).</p>
                        <p><strong>Logros:</strong> Ejército Trigarante, entrada a CDMX.</p>
                        <p><strong>Fin:</strong> Firma del Acta de Independencia (28 sep 1821).</p>
                    </div>
                    <div class="etapa-dato">📅 24 feb - 28 sep 1821</div>
                </div>
            </div>
        </div>

        <!-- CAUSAS -->
        <div class="subseccion">
            <h3>2. Causas de la Independencia</h3>
            <div class="causas-grid">
                <div class="causa-card externa">
                    <div class="causa-header">
                        <div class="causa-icon">🌍</div>
                        <h4>Externas</h4>
                    </div>
                    <div class="causa-content">
                        <ul>
                            <li><strong>Invasión napoleónica a España (1808).</strong></li>
                            <li><strong>Revolución Francesa (1789).</strong></li>
                            <li><strong>Independencia de EE.UU. (1776).</strong></li>
                        </ul>
                    </div>
                    <div class="causa-dato">🔗 Influencia global</div>
                </div>
                <div class="causa-card interna">
                    <div class="causa-header">
                        <div class="causa-icon">🏛️</div>
                        <h4>Internas</h4>
                    </div>
                    <div class="causa-content">
                        <ul>
                            <li><strong>Descontento criollo.</strong></li>
                            <li><strong>Crisis económica.</strong></li>
                            <li><strong>Represión colonial.</strong></li>
                            <li><strong>Ideas ilustradas.</strong></li>
                        </ul>
                    </div>
                    <div class="causa-dato">📉 Desigualdad social</div>
                </div>
            </div>
        </div>

        <!-- DOCUMENTOS CLAVE -->
        <div class="subseccion">
            <h3>3. Documentos Clave</h3>
            <div class="documentos-grid">
                <div class="documento-card gritodolores">
                    <div class="documento-header">
                        <div class="documento-icon">📢</div>
                        <h4>Grito de Dolores</h4>
                    </div>
                    <div class="documento-content">
                        <p><strong>Autor:</strong> Miguel Hidalgo.</p>
                        <p><strong>Fecha:</strong> 16 sep 1810.</p>
                        <p><strong>Contenido:</strong> Llamado a la rebelión contra el "mal gobierno".</p>
                        <p><strong>Frase:</strong> "¡Viva la Virgen de Guadalupe! ¡Abajo el mal gobierno!".</p>
                    </div>
                    <div class="documento-dato">📜 Primer acto de independencia</div>
                </div>
                <div class="documento-card chilpancingo">
                    <div class="documento-header">
                        <div class="documento-icon">📜</div>
                        <h4>Sentimientos de la Nación</h4>
                    </div>
                    <div class="documento-content">
                        <p><strong>Autor:</strong> José María Morelos.</p>
                        <p><strong>Fecha:</strong> 14 sep 1813.</p>
                        <p><strong>Contenido:</strong> Primer documento constitucional.</p>
                        <p><strong>Ideas:</strong> Soberanía popular, abolición de la esclavitud.</p>
                    </div>
                    <div class="documento-dato">🏛️ Primera constitución</div>
                </div>
                <div class="documento-card iguala">
                    <div class="documento-header">
                        <div class="documento-icon">🎖️</div>
                        <h4>Plan de Iguala</h4>
                    </div>
                    <div class="documento-content">
                        <p><strong>Autor:</strong> Agustín de Iturbide y Vicente Guerrero.</p>
                        <p><strong>Fecha:</strong> 24 feb 1821.</p>
                        <p><strong>Contenido:</strong> Tres garantías: religión, independencia, unión.</p>
                        <p><strong>Resultado:</strong> Creación del Ejército Trigarante.</p>
                    </div>
                    <div class="documento-dato">🤝 Unión de insurgentes y realistas</div>
                </div>
            </div>
        </div>
    </section>

    <!-- SIMULADOR INTERACTIVO -->
    <section class="simulator-section">
        <h2 class="seccion-titulo neon-interactivo">
            <span class="icon">🎮</span> SIMULADOR: PLAN DE IGUALA
        </h2>
        <div class="simulator-container" data-tema="plan-iguala">
            <!-- PANEL DE CONTROLES -->
            <div class="simulator-controls">
                <h3>⚙️ CONTROLES</h3>
                <div class="control-group">
                    <label for="garantiaSelect">Selecciona una garantía:</label>
                    <select id="garantiaSelect" class="control-input">
                        <option value="religion">Religión (Católica)</option>
                        <option value="independencia">Independencia</option>
                        <option value="union">Unión (Igualdad)</option>
                    </select>
                </div>
                <div class="control-group">
                    <label for="anioSimulacion">Año:</label>
                    <input type="range" id="anioSimulacion" min="1810" max="1821" value="1821" class="control-slider">
                    <div class="slider-labels">
                        <span>1810</span>
                        <span>1821</span>
                    </div>
                </div>
                <button class="btn-iniciar" onclick="iniciarSimulacion()">
                    <span class="btn-icon">▶️</span> INICIAR SIMULACIÓN
                </button>
                <button class="btn-reiniciar" onclick="reiniciarSimulacion()">
                    <span class="btn-icon">🔄</span> REINICIAR
                </button>
            </div>

            <!-- VISUALIZACIÓN -->
            <div class="simulator-visualization">
                <div class="plan-iguala-container">
                    <svg id="svgPlanIguala" viewBox="0 0 800 500" xmlns="http://www.w3.org/2000/svg">
                        <!-- Fondo -->
                        <rect x="0" y="0" width="800" height="500" fill="#0a0a1a"/>

                        <!-- Título -->
                        <text x="400" y="50" fill="#4CAF50" font-size="28" text-anchor="middle" font-weight="bold">PLAN DE IGUALA (1821)</text>

                        <!-- Tres Garantías -->
                        <g id="garantiaReligion" class="garantia-card" data-garantia="religion">
                            <rect x="150" y="120" width="200" height="120" fill="#7B1FA2" rx="15" opacity="0.5"/>
                            <text x="250" y="160" fill="white" font-size="16" text-anchor="middle">RELIGIÓN</text>
                            <text x="250" y="190" fill="white" font-size="12" text-anchor="middle">Católica</text>
                            <text x="250" y="220" fill="white" font-size="10" text-anchor="middle">Única oficial</text>
                        </g>

                        <g id="garantiaIndependencia" class="garantia-card" data-garantia="independencia">
                            <rect x="400" y="120" width="200" height="120" fill="#D32F2F" rx="15" opacity="0.5"/>
                            <text x="500" y="160" fill="white" font-size="16" text-anchor="middle">INDEPENDENCIA</text>
                            <text x="500" y="190" fill="white" font-size="12" text-anchor="middle">De España</text>
                            <text x="500" y="220" fill="white" font-size="10" text-anchor="middle">Monarquía moderada</text>
                        </g>

                        <g id="garantiaUnion" class="garantia-card" data-garantia="union">
                            <rect x="275" y="300" width="250" height="120" fill="#1976D2" rx="15" opacity="0.5"/>
                            <text x="400" y="340" fill="white" font-size="16" text-anchor="middle">UNIÓN</text>
                            <text x="400" y="370" fill="white" font-size="12" text-anchor="middle">Igualdad</text>
                            <text x="400" y="400" fill="white" font-size="10" text-anchor="middle">Criollos = Españoles</text>
                        </g>

                        <!-- Flechas -->
                        <line x1="350" y1="240" x2="450" y2="300" stroke="#4CAF50" stroke-width="3" marker-end="url(#flecha)"/>
                        <line x1="250" y1="240" x2="350" y2="300" stroke="#4CAF50" stroke-width="3" marker-end="url(#flecha)"/>

                        <!-- Bandera Trigarante -->
                        <g id="banderaTrigarante" opacity="0">
                            <rect x="50" y="400" width="700" height="80" fill="url(#gradienteTrigarante)" rx="5"/>
                            <text x="400" y="440" fill="white" font-size="14" text-anchor="middle">EJÉRCITO TRIGARANTE</text>
                            <text x="400" y="465" fill="white" font-size="12" text-anchor="middle">Iturbide + Guerrero</text>
                        </g>

                        <!-- Leyenda -->
                        <rect x="50" y="420" width="700" height="60" fill="rgba(0,0,0,0.7)" rx="10" id="leyendaPlanIguala"/>
                        <text x="400" y="450" fill="#4CAF50" font-size="16" text-anchor="middle" id="textoLeyenda">Selecciona una garantía</text>
                    </svg>
                </div>
            </div>

            <!-- DATOS EN TIEMPO REAL -->
            <div class="simulator-data">
                <h3>📊 DATOS HISTÓRICOS</h3>
                <div class="data-card">
                    <div class="data-label">Garantía:</div>
                    <div class="data-value" id="dataGarantia">—</div>
                </div>
                <div class="data-card">
                    <div class="data-label">Año:</div>
                    <div class="data-value" id="dataAnio">—</div>
                </div>
                <div class="data-card">
                    <div class="data-label">Contexto:</div>
                    <div class="data-value" id="dataContexto">—</div>
                </div>
                <div class="data-card highlight">
                    <div class="data-label">Impacto:</div>
                    <div class="data-value" id="dataImpacto">—</div>
                </div>
                <div class="data-card">
                    <div class="data-label">Personajes:</div>
                    <div class="data-value" id="dataPersonajes">—</div>
                </div>
            </div>
        </div>
    </section>

    <!-- QUIZ INTERACTIVO -->
    <section class="quiz-section">
        <h2 class="seccion-titulo neon-evaluacion">
            <span class="icon">❓</span> QUIZ: ¿CUÁNTO SABES?
        </h2>
        <div class="quiz-container">
            <!-- PREGUNTA 1 -->
            <div class="quiz-question" data-correct="C">
                <div class="quiz-header">
                    <span class="quiz-num">01</span>
                    <h3>¿Qué documento proclamó la abolición de la esclavitud?</h3>
                </div>
                <div class="quiz-options">
                    <button class="quiz-option" data-value="A">
                        <span class="option-letter">A</span>
                        Grito de Dolores
                    </button>
                    <button class="quiz-option" data-value="B">
                        <span class="option-letter">B</span>
                        Plan de Iguala
                    </button>
                    <button class="quiz-option" data-value="C">
                        <span class="option-letter">C</span>
                        Sentimientos de la Nación
                    </button>
                    <button class="quiz-option" data-value="D">
                        <span class="option-letter">D</span>
                        Acta de Independencia
                    </button>
                </div>
                <div class="quiz-feedback" style="display: none;">
                    <div class="feedback-correct">
                        <strong>✅ Correcto:</strong> Los <strong>Sentimientos de la Nación</strong> (1813) abolieron la esclavitud.
                    </div>
                    <div class="feedback-incorrect">
                        ❌ <strong>Incorrecto:</strong> Revisa la sección de "Documentos Clave".
                    </div>
                </div>
            </div>

            <!-- PREGUNTA 2 -->
            <div class="quiz-question" data-correct="B">
                <div class="quiz-header">
                    <span class="quiz-num">02</span>
                    <h3>¿Quién lideró la etapa de Resistencia (1815-1820)?</h3>
                </div>
                <div class="quiz-options">
                    <button class="quiz-option" data-value="A">
                        <span class="option-letter">A</span>
                        Miguel Hidalgo
                    </button>
                    <button class="quiz-option" data-value="B">
                        <span class="option-letter">B</span>
                        Vicente Guerrero
                    </button>
                    <button class="quiz-option" data-value="C">
                        <span class="option-letter">C</span>
                        Agustín de Iturbide
                    </button>
                    <button class="quiz-option" data-value="D">
                        <span class="option-letter">D</span>
                        José María Morelos
                    </button>
                </div>
                <div class="quiz-feedback" style="display: none;">
                    <div class="feedback-correct">
                        <strong>✅ Correcto:</strong> <strong>Vicente Guerrero</strong> lideró la resistencia con guerra de guerrillas.
                    </div>
                    <div class="feedback-incorrect">
                        ❌ <strong>Incorrecto:</strong> Revisa la sección de "Etapas".
                    </div>
                </div>
            </div>

            <!-- PREGUNTA 3 -->
            <div class="quiz-question" data-correct="A">
                <div class="quiz-header">
                    <span class="quiz-num">03</span>
                    <h3>¿Qué propuso el Plan de Iguala?</h3>
                </div>
                <div class="quiz-options">
                    <button class="quiz-option" data-value="A">
                        <span class="option-letter">A</span>
                        Tres garantías
                    </button>
                    <button class="quiz-option" data-value="B">
                        <span class="option-letter">B</span>
                        República federal
                    </button>
                    <button class="quiz-option" data-value="C">
                        <span class="option-letter">C</span>
                        Monarquía absoluta
                    </button>
                    <button class="quiz-option" data-value="D">
                        <span class="option-letter">D</span>
                        División de poderes
                    </button>
                </div>
                <div class="quiz-feedback" style="display: none;">
                    <div class="feedback-correct">
                        <strong>✅ Correcto:</strong> Las <strong>Tres Garantías</strong>: religión, independencia y unión.
                    </div>
                    <div class="feedback-incorrect">
                        ❌ <strong>Incorrecto:</strong> Usa el simulador del Plan de Iguala para repasar.
                    </div>
                </div>
            </div>

            <!-- RESULTADOS -->
            <div class="quiz-results" style="display: none;">
                <h3>📊 RESULTADOS</h3>
                <div class="results-score">
                    Puntuación: <span id="quizScore">0</span>/3
                </div>
                <div class="results-feedback" id="quizFeedback">
                    Completa el quiz para ver tu desempeño.
                </div>
                <button class="btn-retry" onclick="reiniciarQuiz()">
                    🔄 VOLVER A INTENTAR
                </button>
            </div>
        </div>
    </section>

    <!-- ERRORES COMUNES -->
    <section class="errores-section">
        <h2 class="seccion-titulo neon-alerta">
            <span class="icon">⚠️</span> MITOS Y REALIDADES
        </h2>
        <div class="errores-container">
            <div class="error-card">
                <div class="error-header" onclick="toggleError(this)">
                    <h3>❌ "Hidalgo gritó \'¡Viva México!\'"</h3>
                    <span class="error-toggle">+</span>
                </div>
                <div class="error-content">
                    <div class="error-ejemplo">
                        <strong>Mito:</strong> "El 16 de septiembre de 1810, Hidalgo gritó \'¡Viva México!\'".
                    </div>
                    <div class="error-correccion">
                        <strong>Realidad:</strong> Hidalgo mencionó a la <strong>Virgen de Guadalupe</strong> y al <strong>rey Fernando VII</strong>, no a "México".
                        <div class="error-cita">
                            <p>"¡Viva la Virgen de Guadalupe! ¡Abajo el mal gobierno!" — <em>Testimonios históricos</em></p>
                        </div>
                    </div>
                    <div class="error-imagen">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/5a/Miguel_Hidalgo_y_Costilla.jpg/300px-Miguel_Hidalgo_y_Costilla.jpg" alt="Hidalgo" width="100%">
                        <p><em>Retrato de Hidalgo. Fuente: Wikipedia.</em></p>
                    </div>
                </div>
            </div>

            <div class="error-card">
                <div class="error-header" onclick="toggleError(this)">
                    <h3>❌ "Iturbide fue un héroe sin manchas"</h3>
                    <span class="error-toggle">+</span>
                </div>
                <div class="error-content">
                    <div class="error-ejemplo">
                        <strong>Mito:</strong> "Iturbide fue un libertador desinteresado".
                    </div>
                    <div class="error-correccion">
                        <strong>Realidad:</strong> Iturbide buscaba <strong>poder personal</strong> y fue <strong>emperador</strong> (1822-1823).
                        <div class="error-dato">👑 Abdicó tras 10 meses de gobierno.</div>
                    </div>
                    <div class="error-grafica">
                        <div class="grafica-barras">
                            <div class="barra apoyo" style="width: 60%;">Apoyo inicial (1821)</div>
                            <div class="barra rechazo" style="width: 80%;">Rechazo (1823)</div>
                        </div>
                        <div class="grafica-leyenda">
                            <span class="leyenda-apoyo">🟩 Apoyo</span>
                            <span class="leyenda-rechazo">🟥 Rechazo</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="error-card">
                <div class="error-header" onclick="toggleError(this)">
                    <h3>❌ "La independencia fue solo de los criollos"</h3>
                    <span class="error-toggle">+</span>
                </div>
                <div class="error-content">
                    <div class="error-ejemplo">
                        <strong>Mito:</strong> "Solo los criollos se beneficiaron".
                    </div>
                    <div class="error-correccion">
                        <strong>Realidad:</strong> Participaron <strong>indígenas</strong> (ej. <strong>Vicente Guerrero</strong> era mestizo) y <strong>afromexicanos</strong>.
                        <div class="error-mapa">
                            <svg width="100%" height="150" viewBox="0 0 300 100">
                                <rect x="0" y="0" width="300" height="100" fill="#0a0a1a"/>
                                <circle cx="50" cy="50" r="10" fill="#4CAF50"/>
                                <text x="50" y="85" fill="#E8F5E9" font-size="8" text-anchor="middle">Criollos</text>
                                <circle cx="150" cy="30" r="10" fill="#FF9800"/>
                                <text x="150" y="65" fill="#FFF8E1" font-size="8" text-anchor="middle">Indígenas</text>
                                <circle cx="250" cy="70" r="10" fill="#7B1FA2"/>
                                <text x="250" y="105" fill="#F3E5F5" font-size="8" text-anchor="middle">Afro</text>
                                <path d="M50,50 L150,30 L250,70" stroke="#4CAF50" stroke-width="2" stroke-dasharray="5,2"/>
                                <text x="150" y="20" fill="#E8F5E9" font-size="10" text-anchor="middle">Alianzas independentistas</text>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- PROBLEMAS TIPO EXAMEN -->
    <section class="examen-section">
        <h2 class="seccion-titulo neon-evaluacion">
            <span class="icon">📝</span> MISIÓN FINAL: ANÁLISIS CRÍTICO
        </h2>
        <div class="examen-container">
            <div class="problema-card">
                <div class="problema-header">
                    <span class="problema-num">P1</span>
                    <h3>Comparación de Líderes</h3>
                </div>
                <div class="problema-enunciado">
                    <p>Compara a <strong>Hidalgo</strong>, <strong>Morelos</strong> e <strong>Iturbide</strong> en:</p>
                    <ol>
                        <li><strong>Origen social.</strong></li>
                        <li><strong>Estrategia militar.</strong></li>
                        <li><strong>Legado histórico.</strong></li>
                    </ol>
                    <p>Incluye <strong>2 diferencias clave</strong> entre sus proyectos políticos.</p>
                </div>
                <div class="problema-espacio">
                    <textarea placeholder="Ejemplo: Hidalgo era cura y buscaba justicia social, mientras que Iturbide..." rows="8"></textarea>
                </div>
                <button class="btn-verificar" onclick="verificarProblema(1)">VER SOLUCIÓN</button>
                <div class="problema-solucion" id="solucionP1" style="display: none;">
                    <strong>Solución:</strong>
                    <table class="comparativa-table">
                        <tr>
                            <th></th>
                            <th>Hidalgo</th>
                            <th>Morelos</th>
                            <th>Iturbide</th>
                        </tr>
                        <tr>
                            <td><strong>Origen</strong></td>
                            <td>Criollo (cura)</td>
                            <td>Mestizo (cura)</td>
                            <td>Criollo (militar)</td>
                        </tr>
                        <tr>
                            <td><strong>Estrategia</strong></td>
                            <td>Rebelión popular</td>
                            <td>Guerra organizada</td>
                            <td>Alianzas con realistas</td>
                        </tr>
                        <tr>
                            <td><strong>Legado</strong></td>
                            <td>Padre de la Patria</td>
                            <td>Constitución de 1814</td>
                            <td>Primer emperador</td>
                        </tr>
                    </table>
                    <p><strong>Diferencias clave:</strong></p>
                    <ol>
                        <li><strong>Hidalgo/Morelos:</strong> Buscaban justicia social; <strong>Iturbide</strong> quería monarquía.</li>
                        <li><strong>Morelos:</strong> Abolición de la esclavitud; <strong>Iturbide</strong> mantuvo privilegios.</li>
                    </ol>
                </div>
            </div>

            <div class="problema-card">
                <div class="problema-header">
                    <span class="problema-num">P2</span>
                    <h3>Debate: ¿Fue la independencia una revolución social?</h3>
                </div>
                <div class="problema-enunciado">
                    <p>Argumenta si la Independencia de México (1810-1821) puede considerarse una <strong>revolución social</strong>, usando:</p>
                    <ol>
                        <li>El <strong>Grito de Dolores</strong> (1810).</li>
                        <li>Los <strong>Sentimientos de la Nación</strong> (1813).</li>
                        <li>El <strong>Plan de Iguala</strong> (1821).</li>
                    </ol>
                    <p>Concluye con tu postura y <strong>2 evidencias</strong> del simulador.</p>
                </div>
                <div class="problema-espacio">
                    <textarea placeholder="Ejemplo: El Grito de Dolores sí tenía un componente social al mencionar..." rows="10"></textarea>
                </div>
                <button class="btn-verificar" onclick="verificarProblema(2)">VER ARGUMENTOS</button>
                <div class="problema-solucion" id="solucionP2" style="display: none;">
                    <strong>Argumentos a favor (revolución social):</strong>
                    <ul>
                        <li><strong>Grito de Dolores:</strong> Llamado a acabar con el "mal gobierno" y la esclavitud.</li>
                        <li><strong>Sentimientos de la Nación:</strong> Abolición de castas y privilegios (Art. 12, 15).</li>
                        <li><strong>Participación popular:</strong> Indígenas y mestizos en el ejército insurgente.</li>
                    </ul>
                    <strong>Argumentos en contra:</strong>
                    <ul>
                        <li><strong>Plan de Iguala:</strong> Mantuvo la religión católica como oficial y privilegios criollos.</li>
                        <li><strong>Iturbide:</strong> Estableció una monarquía, no una república democrática.</li>
                        <li><strong>Elite criolla:</strong> Tomó el poder tras 1821, excluyendo a indígenas.</li>
                    </ul>
                    <p><strong>Conclusión:</strong> Fue un movimiento <strong>político-militar</strong> con elementos sociales, pero <strong>no una revolución completa</strong>.</p>
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
                    <td>Comparación de líderes</td>
                    <td>Analiza 3 aspectos con 2 diferencias clave.</td>
                    <td>Menciona aspectos sin profundizar.</td>
                    <td>Omite diferencias o aspectos.</td>
                </tr>
                <tr>
                    <td>Uso de evidencias</td>
                    <td>Argumenta con 3+ documentos históricos.</td>
                    <td>Usa 1-2 evidencias sin contexto.</td>
                    <td>No usa evidencias.</td>
                </tr>
                <tr>
                    <td>Reflexión crítica</td>
                    <td>Evalúa perspectivas múltiples (social/política).</td>
                    <td>Analiza solo una perspectiva.</td>
                    <td>Repite información sin análisis.</td>
                </tr>
            </table>
        </div>
    </section>

    <!-- CIERRE METACOGNITIVO -->
    <section class="cierre-section">
        <h2 class="seccion-titulo neon-concepto">
            <span class="icon">🧠</span> CIERRE: REFLEXIÓN HISTÓRICA
        </h2>
        <div class="cierre-container">
            <div class="autoevaluacion">
                <h3>📊 AUTOEVALUACIÓN</h3>
                <div class="slider-group">
                    <label>Conozco las etapas de la independencia:</label>
                    <input type="range" min="1" max="5" value="3" class="autoeval-slider" id="slider1">
                    <div class="slider-labels">
                        <span>Básico</span><span>Intermedio</span><span>Avanzado</span>
                    </div>
                </div>
                <div class="slider-group">
                    <label>Analizo causas y consecuencias:</label>
                    <input type="range" min="1" max="5" value="3" class="autoeval-slider" id="slider2">
                    <div class="slider-labels">
                        <span>Básico</span><span>Intermedio</span><span>Avanzado</span>
                    </div>
                </div>
                <div class="slider-group">
                    <label>Uso el simulador del Plan de Iguala:</label>
                    <input type="range" min="1" max="5" value="3" class="autoeval-slider" id="slider3">
                    <div class="slider-labels">
                        <span>Básico</span><span>Intermedio</span><span>Avanzado</span>
                    </div>
                </div>
                <button class="btn-guardar" onclick="guardarAutoevaluacion()">
                    💾 GUARDAR PROGRESO
                </button>
            </div>

            <div class="reflexion">
                <h3>💭 REFLEXIÓN FINAL</h3>
                <div class="pregunta-reflexion">
                    <p>¿Cómo crees que sería México si la Independencia hubiera sido liderada solo por <strong>indígenas y mestizos</strong> (sin criollos como Iturbide)?</p>
                    <textarea placeholder="Ejemplo: Quizás habría una república con mayor justicia social, pero..." rows="5" id="reflexion1"></textarea>
                </div>
                <div class="pregunta-reflexion">
                    <p>Investiga sobre <strong>Leona Vicario</strong> o <strong>Josefa Ortiz de Domínguez</strong> y describe su papel en 3 líneas.</p>
                    <textarea placeholder="Ejemplo: Leona Vicario fue una insurgente que..." rows="4" id="reflexion2"></textarea>
                </div>
            </div>

            <div class="plan-estudio">
                <h3>📅 PLAN DE ESTUDIO</h3>
                <div class="plan-grid">
                    <div class="plan-card">
                        <h4>🔹 REPASO RÁPIDO (20 min)</h4>
                        <ul>
                            <li>Memorizar fechas y líderes de cada etapa.</li>
                            <li>Repasar documentos clave (Grito, Sentimientos, Plan de Iguala).</li>
                            <li>Identificar causas internas/externas.</li>
                        </ul>
                    </div>
                    <div class="plan-card">
                        <h4>🔹 ANÁLISIS (30 min)</h4>
                        <ul>
                            <li>Comparar los proyectos políticos de Hidalgo, Morelos e Iturbide.</li>
                            <li>Reflexionar: ¿Por qué fracasó el proyecto de Morelos?</li>
                            <li>Escribir un párrafo sobre el legado de la Independencia.</li>
                        </ul>
                    </div>
                    <div class="plan-card">
                        <h4>🔹 DEBATE (45 min)</h4>
                        <ul>
                            <li>Preparar argumentos: ¿Fue Iturbide un héroe o un traidor?</li>
                            <li>Investigar sobre la participación de mujeres en la Independencia.</li>
                            <li>Debatir en clase con evidencias históricas.</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="recursos">
                <h3>🌐 RECURSOS EXTERNOS</h3>
                <div class="recursos-links">
                    <a href="https://www.inehrm.gob.mx/" target="_blank" class="recurso-link">
                        📜 Instituto Nacional de Estudios Históricos (INEHRM)
                    </a>
                    <a href="https://www.biblioteca.tv/artman2/publish/1810_1821" target="_blank" class="recurso-link">
                        📚 Biblioteca TV: Independencia de México
                    </a>
                    <a href="https://www.khanacademy.org/humanities/whp-origins" target="_blank" class="recurso-link">
                        🎓 Khan Academy: Revoluciones Latinoamericanas
                    </a>
                    <a href="https://www.youtube.com/watch?v=..." target="_blank" class="recurso-link">
                        🎥 Documental: "Los Caudillos" (History Channel)
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- JAVASCRIPT INTEGRADO -->
<script>
// ===========================================
// BASE DE DATOS DEL SIMULADOR
// ===========================================
const garantiasData = {
    "religion": {
        nombre: "Religión",
        ano: "1821",
        contexto: "La religión católica fue declarada como la única oficial en el Plan de Iguala, buscando unidad y apoyo de la Iglesia.",
        impacto: "Garantizó el apoyo del clero, pero limitó la libertad religiosa.",
        personajes: "Iturbide, Iglesia Católica",
        color: "#7B1FA2",
        icono: "⛪"
    },
    "independencia": {
        nombre: "Independencia",
        ano: "1821",
        contexto: "México se independizaría de España, pero bajo una monarquía moderada (no república).",
        impacto: "Atrajo a realistas y criollos, pero postergó la democracia.",
        personajes: "Iturbide, Guerrero, O\'Donojú",
        color: "#D32F2F",
        icono: "🇲🇽"
    },
    "union": {
        nombre: "Unión",
        ano: "1821",
        contexto: "Igualdad entre criollos, españoles y castas, para evitar divisiones.",
        impacto: "Unió a grupos rivales, pero no eliminó las desigualdades sociales.",
        personajes: "Iturbide, Criollos, Españoles",
        color: "#1976D2",
        icono: "🤝"
    }
};

// ===========================================
// SIMULADOR: PLAN DE IGUALA
// ===========================================
function iniciarSimulacion() {
    const garantia = document.getElementById(\'garantiaSelect\').value;
    const ano = document.getElementById(\'anioSimulacion\').value;
    const datos = garantiasData[garantia];

    // Actualizar datos
    document.getElementById(\'dataGarantia\').textContent = `${datos.icono} ${datos.nombre}`;
    document.getElementById(\'dataAnio\').textContent = datos.ano;
    document.getElementById(\'dataContexto\').textContent = datos.contexto;
    document.getElementById(\'dataImpacto\').textContent = datos.impacto;
    document.getElementById(\'dataPersonajes\').textContent = datos.personajes;

    // Actualizar leyenda
    document.getElementById(\'textoLeyenda\').textContent = `📜 ${datos.nombre} (${datos.ano}): ${datos.contexto}`;

    // Resaltar garantía en SVG
    document.querySelectorAll(\'.garantia-card\').forEach(card => {
        card.setAttribute(\'opacity\', \'0.5\');
    });
    document.getElementById(`garantia${datos.nombre.charAt(0).toUpperCase() + datos.nombre.slice(1)}`).setAttribute(\'opacity\', \'1\');

    // Mostrar bandera trigarante si es 1821
    if (ano >= 1821) {
        document.getElementById(\'banderaTrigarante\').setAttribute(\'opacity\', \'1\');
    } else {
        document.getElementById(\'banderaTrigarante\').setAttribute(\'opacity\', \'0\');
    }

    console.log(`🚀 Simulación: ${datos.nombre} (${datos.ano})`);
}

function reiniciarSimulacion() {
    document.getElementById(\'garantiaSelect\').value = "religion";
    document.getElementById(\'anioSimulacion\').value = "1821";

    // Reiniciar datos
    document.querySelectorAll(\'.data-value\').forEach(d => {
        d.textContent = "—";
    });

    // Reiniciar SVG
    document.querySelectorAll(\'.garantia-card\').forEach(card => {
        card.setAttribute(\'opacity\', \'0.5\');
    });
    document.getElementById(\'banderaTrigarante\').setAttribute(\'opacity\', \'0\');
    document.getElementById(\'textoLeyenda\').textContent = "Selecciona una garantía";

    console.log("🔄 Simulación reiniciada");
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
        feedback = "🌟 ¡Excelente! Dominas los detalles clave de la Independencia.";
    } else if (porcentaje >= 50) {
        feedback = "👍 Buen trabajo, pero repasa los documentos y líderes.";
    } else {
        feedback = "📚 Necesitas estudiar más las etapas y el Plan de Iguala.";
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
// ERRORES COMUNES (MITOS)
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
// AUTOEVALUACIÓN
// ===========================================
function guardarAutoevaluacion() {
    const slider1 = document.getElementById(\'slider1\').value;
    const slider2 = document.getElementById(\'slider2\').value;
    const slider3 = document.getElementById(\'slider3\').value;
    const promedio = (parseInt(slider1) + parseInt(slider2) + parseInt(slider3)) / 3;

    alert(`💾 Autoevaluación guardada:\\n\\n` +
          `Etapas: ${slider1}/5\\n` +
          `Causas/consecuencias: ${slider2}/5\\n` +
          `Simulador: ${slider3}/5\\n\\n` +
          `Promedio: ${promedio.toFixed(1)}/5\\n\\n` +
          `📌 Recomendación: Revisa el plan de estudio según tus resultados.`);
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
        checkbox.style.backgroundColor = !completado ? \'#4CAF50\' : \'\';
    });
});

// ===========================================
// INICIALIZACIÓN: AGREGAR GRADIENTE A LA BANDERA
// ===========================================
const svg = document.getElementById(\'svgPlanIguala\');
const defs = document.createElementNS(\'http://www.w3.org/2000/svg\', \'defs\');

const gradiente = document.createElementNS(\'http://www.w3.org/2000/svg\', \'linearGradient\');
gradiente.setAttribute(\'id\', \'gradienteTrigarante\');
gradiente.setAttribute(\'x1\', \'0%\');
gradiente.setAttribute(\'y1\', \'0%\');
gradiente.setAttribute(\'x2\', \'100%\');
gradiente.setAttribute(\'y2\', \'0%\');

const stop1 = document.createElementNS(\'http://www.w3.org/2000/svg\', \'stop\');
stop1.setAttribute(\'offset\', \'0%\');
stop1.setAttribute(\'stop-color\', \'#4CAF50\');

const stop2 = document.createElementNS(\'http://www.w3.org/2000/svg\', \'stop\');
stop2.setAttribute(\'offset\', \'50%\');
stop2.setAttribute(\'stop-color\', \'white\');

const stop3 = document.createElementNS(\'http://www.w3.org/2000/svg\', \'stop\');
stop3.setAttribute(\'offset\', \'100%\');
stop3.setAttribute(\'stop-color\', \'#D32F2F\');

gradiente.appendChild(stop1);
gradiente.appendChild(stop2);
gradiente.appendChild(stop3);
defs.appendChild(gradiente);
svg.appendChild(defs);

// Flecha para SVG
const marker = document.createElementNS(\'http://www.w3.org/2000/svg\', \'marker\');
marker.setAttribute(\'id\', \'flecha\');
marker.setAttribute(\'viewBox\', \'0 0 10 10\');
marker.setAttribute(\'refX\', \'5\');
marker.setAttribute(\'refY\', \'5\');
marker.setAttribute(\'markerWidth\', \'6\');
marker.setAttribute(\'markerHeight\', \'6\');
marker.setAttribute(\'orient\', \'auto\');

const path = document.createElementNS(\'http://www.w3.org/2000/svg\', \'path\');
path.setAttribute(\'d\', \'M 0 0 L 10 5 L 0 10 z\');
path.setAttribute(\'fill\', \'#4CAF50\');

marker.appendChild(path);
defs.appendChild(marker);
svg.appendChild(defs);

console.log("🚀 Lección Cyberpunk: Independencia de México - Cargada");
console.log("🎮 Simulador, Quiz y Herramientas interactivas listas");
</script>',
    'ejercicios' => 
    array (
      0 => 
      array (
        'enunciado' => 'Grito de Dolores',
        'respuesta' => '16 septiembre 1810',
      ),
      1 => 
      array (
        'enunciado' => 'Líder inicial',
        'respuesta' => 'Miguel Hidalgo',
      ),
      2 => 
      array (
        'enunciado' => 'Congreso de Chilpancingo',
        'respuesta' => '1813',
      ),
      3 => 
      array (
        'enunciado' => 'Autor Sentimientos Nación',
        'respuesta' => 'Morelos',
      ),
      4 => 
      array (
        'enunciado' => 'Plan de Iguala',
        'respuesta' => '1821',
      ),
      5 => 
      array (
        'enunciado' => 'Tres garantías',
        'respuesta' => 'Religión, independencia, unión',
      ),
      6 => 
      array (
        'enunciado' => 'Entrada CDMX',
        'respuesta' => '27 septiembre 1821',
      ),
      7 => 
      array (
        'enunciado' => 'Ejecutado en 1811',
        'respuesta' => 'Hidalgo',
      ),
      8 => 
      array (
        'enunciado' => 'Ejecutado en 1815',
        'respuesta' => 'Morelos',
      ),
      9 => 
      array (
        'enunciado' => 'Trigarante significa',
        'respuesta' => 'Tres garantías',
      ),
      10 => 
      array (
        'enunciado' => 'Causa francesa',
        'respuesta' => 'Invasión napoleónica 1808',
      ),
      11 => 
      array (
        'enunciado' => 'SI: años independencia',
        'respuesta' => '11',
      ),
    ),
    'quiz' => 
    array (
      0 => 
      array (
        'pregunta' => 'Grito de Dolores',
        'opciones' => 
        array (
          0 => '16 Sep 1810',
          1 => '15 Sep 1821',
          2 => '20 Nov 1910',
          3 => '5 May 1862',
        ),
        'correcta' => '16 Sep 1810',
      ),
      1 => 
      array (
        'pregunta' => 'Líder Grito',
        'opciones' => 
        array (
          0 => 'Hidalgo',
          1 => 'Morelos',
          2 => 'Iturbide',
          3 => 'Guerrero',
        ),
        'correcta' => 'Hidalgo',
      ),
      2 => 
      array (
        'pregunta' => 'Congreso Chilpancingo',
        'opciones' => 
        array (
          0 => '1813',
          1 => '1810',
          2 => '1821',
          3 => '1910',
        ),
        'correcta' => '1813',
      ),
      3 => 
      array (
        'pregunta' => 'Sentimientos Nación',
        'opciones' => 
        array (
          0 => 'Morelos',
          1 => 'Hidalgo',
          2 => 'Iturbide',
          3 => 'Juárez',
        ),
        'correcta' => 'Morelos',
      ),
      4 => 
      array (
        'pregunta' => 'Plan de Iguala',
        'opciones' => 
        array (
          0 => '24 Feb 1821',
          1 => '16 Sep 1810',
          2 => '27 Sep 1821',
          3 => '20 Nov 1910',
        ),
        'correcta' => '24 Feb 1821',
      ),
      5 => 
      array (
        'pregunta' => 'Tres garantías',
        'opciones' => 
        array (
          0 => 'Religión, independencia, unión',
          1 => 'Libertad, igualdad, fraternidad',
          2 => 'Fe, esperanza, caridad',
          3 => 'Nada',
        ),
        'correcta' => 'Religión, independencia, unión',
      ),
      6 => 
      array (
        'pregunta' => 'Entrada CDMX',
        'opciones' => 
        array (
          0 => '27 Sep 1821',
          1 => '16 Sep 1810',
          2 => '24 Feb 1821',
          3 => '15 Sep 1821',
        ),
        'correcta' => '27 Sep 1821',
      ),
      7 => 
      array (
        'pregunta' => 'Ejecutado 1811',
        'opciones' => 
        array (
          0 => 'Hidalgo',
          1 => 'Morelos',
          2 => 'Iturbide',
          3 => 'Allende',
        ),
        'correcta' => 'Hidalgo',
      ),
      8 => 
      array (
        'pregunta' => 'Ejecutado 1815',
        'opciones' => 
        array (
          0 => 'Morelos',
          1 => 'Hidalgo',
          2 => 'Guerrero',
          3 => 'Iturbide',
        ),
        'correcta' => 'Morelos',
      ),
      9 => 
      array (
        'pregunta' => 'SI 2025: años Grito',
        'opciones' => 
        array (
          0 => '215',
          1 => '200',
          2 => '300',
          3 => '100',
        ),
        'correcta' => '215',
      ),
      10 => 
      array (
        'pregunta' => 'Causa principal',
        'opciones' => 
        array (
          0 => 'Invasión napoleónica',
          1 => 'Terremoto',
          2 => 'Hambre',
          3 => 'Plaga',
        ),
        'correcta' => 'Invasión napoleónica',
      ),
      11 => 
      array (
        'pregunta' => 'Querétaro conspiración',
        'opciones' => 
        array (
          0 => 'Allende, Aldama',
          1 => 'Hidalgo solo',
          2 => 'Morelos',
          3 => 'Iturbide',
        ),
        'correcta' => 'Allende, Aldama',
      ),
      12 => 
      array (
        'pregunta' => 'Batalla Monte de las Cruces',
        'opciones' => 
        array (
          0 => 'Victoria insurgente',
          1 => 'Derrota',
          2 => 'Empate',
          3 => 'Paz',
        ),
        'correcta' => 'Victoria insurgente',
      ),
      13 => 
      array (
        'pregunta' => 'Guadalajara tomada',
        'opciones' => 
        array (
          0 => '1811',
          1 => '1810',
          2 => '1821',
          3 => '1813',
        ),
        'correcta' => '1811',
      ),
      14 => 
      array (
        'pregunta' => 'Morelos capturado',
        'opciones' => 
        array (
          0 => '1815',
          1 => '1811',
          2 => '1821',
          3 => '1810',
        ),
        'correcta' => '1815',
      ),
      15 => 
      array (
        'pregunta' => 'Ejército Trigarante',
        'opciones' => 
        array (
          0 => 'Iturbide + Guerrero',
          1 => 'Solo Iturbide',
          2 => 'Solo Guerrero',
          3 => 'Hidalgo',
        ),
        'correcta' => 'Iturbide + Guerrero',
      ),
      16 => 
      array (
        'pregunta' => 'Bandera trigarante',
        'opciones' => 
        array (
          0 => 'Blanco, verde, rojo',
          1 => 'Verde, blanco, rojo',
          2 => 'Rojo, blanco, azul',
          3 => 'Negro',
        ),
        'correcta' => 'Blanco, verde, rojo',
      ),
      17 => 
      array (
        'pregunta' => 'Tratado de Córdoba',
        'opciones' => 
        array (
          0 => '24 Ago 1821',
          1 => '24 Feb',
          2 => '27 Sep',
          3 => '16 Sep',
        ),
        'correcta' => '24 Ago 1821',
      ),
      18 => 
      array (
        'pregunta' => 'Muertos estimados',
        'opciones' => 
        array (
          0 => '~600,000',
          1 => '10,000',
          2 => '1M',
          3 => '100',
        ),
        'correcta' => 
        array (
          0 => '~600,000',
        ),
      ),
      19 => 
      array (
        'pregunta' => 'SI 2025: años consumación',
        'opciones' => 
        array (
          0 => '204',
          1 => '200',
          2 => '215',
          3 => '300',
        ),
        'correcta' => '204',
      ),
      20 => 
      array (
        'pregunta' => 'Hidalgo abolió',
        'opciones' => 
        array (
          0 => 'Esclavitud',
          1 => 'Impuestos',
          2 => 'Virrey',
          3 => 'Iglesia',
        ),
        'correcta' => 'Esclavitud',
      ),
      21 => 
      array (
        'pregunta' => 'Morelos propuso',
        'opciones' => 
        array (
          0 => 'República',
          1 => 'Monarquía',
          2 => 'Dictadura',
          3 => 'Anarquía',
        ),
        'correcta' => 'República',
      ),
      22 => 
      array (
        'pregunta' => 'Iturbide fue',
        'opciones' => 
        array (
          0 => 'Militar realista → independentista',
          1 => 'Insurgente',
          2 => 'Sacerdote',
          3 => 'Indígena',
        ),
        'correcta' => 'Militar realista → independentista',
      ),
      23 => 
      array (
        'pregunta' => 'Virrey al final',
        'opciones' => 
        array (
          0 => 'Juan O\'Donojú',
          1 => 'Iturbide',
          2 => 'Morelos',
          3 => 'Hidalgo',
        ),
        'correcta' => 'Juan O\'Donojú',
      ),
      24 => 
      array (
        'pregunta' => 'Independencia costó',
        'opciones' => 
        array (
          0 => '11 años',
          1 => '1 año',
          2 => '100 años',
          3 => '1 día',
        ),
        'correcta' => '11 años',
      ),
      25 => 
      array (
        'pregunta' => 'Primera constitución',
        'opciones' => 
        array (
          0 => 'Sentimientos Nación',
          1 => 'Plan Iguala',
          2 => 'Tratado Córdoba',
          3 => 'Constitución 1824',
        ),
        'correcta' => 'Sentimientos Nación',
      ),
      26 => 
      array (
        'pregunta' => 'SI 2025: día feriado',
        'opciones' => 
        array (
          0 => '16 Sep',
          1 => '15 Sep',
          2 => '27 Sep',
          3 => '24 Feb',
        ),
        'correcta' => '16 Sep',
      ),
      27 => 
      array (
        'pregunta' => 'Independencia fue',
        'opciones' => 
        array (
          0 => 'Guerra civil',
          1 => 'Paz',
          2 => 'Revolución pacífica',
          3 => 'Nada',
        ),
        'correcta' => 'Guerra civil',
      ),
      28 => 
      array (
        'pregunta' => 'México nació como',
        'opciones' => 
        array (
          0 => 'Imperio (Iturbide)',
          1 => 'República',
          2 => 'Colonia',
          3 => 'Virreinato',
        ),
        'correcta' => 'Imperio (Iturbide)',
      ),
      29 => 
      array (
        'pregunta' => 'Independencia inspirada en',
        'opciones' => 
        array (
          0 => 'Ilustración + Francia',
          1 => 'España',
          2 => 'EE.UU.',
          3 => 'Inglaterra',
        ),
        'correcta' => 'Ilustración + Francia',
      ),
    ),
  ),
  4 => 
  array (
    'materia' => 'Historia de México',
    'slug' => 'mexico-independiente',
    'titulo' => 'México Independiente: Caos, Reforma y Modernización (1821-1910)',
    'contenido' => '<!-- INICIO LECCIÓN CYBERPUNK -->
<div class="leccion-container leccion-historia-independiente" data-tema="mexico-independiente">
    
    <!-- CABECERA CYBERPUNK -->
    <header class="leccion-header">
        <h1 class="titulo-leccion neon-glow">
            <span class="icon-tema">⚔️</span>
            MÉXICO INDEPENDIENTE
        </h1>
        <div class="subtitulo">
            Del Imperio Efímero al Porfiriato: 89 Años de Búsqueda Nacional (1821-1910)
        </div>
        <div class="badge-tiempo">
            <span class="badge">1821-1910</span>
            <span class="badge">89 años</span>
            <span class="badge">50 gobiernos</span>
            <span class="badge">3 constituciones</span>
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
                <h3>Secuenciar etapas históricas</h3>
                <p>Identificar Imperio, República, Reforma, Intervención, Porfiriato</p>
            </div>
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Analizar crisis territoriales</h3>
                <p>Examinar pérdida del 55% territorio con EE.UU. (1848)</p>
            </div>
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Evaluar reformas liberales</h3>
                <p>Comprender impacto de Leyes de Reforma y Constitución 1857</p>
            </div>
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Examinar modernización porfirista</h3>
                <p>Analizar contradicción: desarrollo económico vs. desigualdad social</p>
            </div>
        </div>
    </section>

    <!-- CONTEXTO REAL -->
    <section class="contexto-real">
        <h2 class="seccion-titulo neon-dato">
            <span class="icon">🌍</span> CONSECUENCIAS EN EL MÉXICO ACTUAL
        </h2>
        <div class="contexto-grid">
            <div class="contexto-card">
                <h3>🗺️ Pérdida Territorial</h3>
                <p>2.3 millones km² perdidos hoy son 7 estados de EE.UU. con 60 millones de habitantes</p>
                <div class="dato-neon">55% territorio original</div>
            </div>
            <div class="contexto-card">
                <h3>⚖️ Estado Laico</h3>
                <p>Leyes de Reforma establecieron separación Iglesia-Estado vigente hoy</p>
                <div class="dato-neon">Registro civil, matrimonio civil, educación laica</div>
            </div>
            <div class="contexto-card">
                <h3>🚂 Infraestructura</h3>
                <p>Ferrocarriles porfiristas son base del sistema ferroviario actual</p>
                <div class="dato-neon">20,000 km vías 1876-1910</div>
            </div>
        </div>
    </section>

    <!-- SECCIÓN TEÓRICA -->
    <section class="teoria-section">
        <div class="borde-neon-lateral"></div>
        <h2 class="seccion-titulo neon-concepto">
            <span class="icon">📚</span> LAS SIETE ETAPAS FUNDACIONALES
        </h2>
        
        <!-- INTRODUCCIÓN -->
        <div class="subseccion">
            <h3>1. El Caótico Siglo XIX Mexicano</h3>
            <div class="definicion-principal">
                <div class="def-card">
                    <h4>⚡ 1821-1910: SIGLO DE CRISIS Y TRANSFORMACIÓN</h4>
                    <p>Período marcado por inestabilidad política, intervenciones extranjeras y búsqueda de identidad nacional</p>
                    <div class="caracteristicas-grid">
                        <div class="caracteristica">
                            <span class="caracteristica-icon">👑</span>
                            <span class="caracteristica-texto">50 gobiernos en 89 años</span>
                        </div>
                        <div class="caracteristica">
                            <span class="caracteristica-icon">🗺️</span>
                            <span class="caracteristica-texto">55% territorio perdido</span>
                        </div>
                        <div class="caracteristica">
                            <span class="caracteristica-icon">⚖️</span>
                            <span class="caracteristica-texto">3 constituciones (1824, 1857, 1917)</span>
                        </div>
                        <div class="caracteristica">
                            <span class="caracteristica-icon">💥</span>
                            <span class="caracteristica-texto">7 intervenciones extranjeras</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- LINEA DE TIEMPO INTERACTIVA -->
        <div class="subseccion">
            <h3>2. Línea de Tiempo Interactiva</h3>
            <div class="timeline-interactiva">
                <div class="timeline-controls">
                    <button class="timeline-btn" data-etapa="imperio">IMPERIO</button>
                    <button class="timeline-btn" data-etapa="republica">REPÚBLICA</button>
                    <button class="timeline-btn" data-etapa="centralismo">CENTRALISMO</button>
                    <button class="timeline-btn" data-etapa="guerra-eeuu">GUERRA EE.UU.</button>
                    <button class="timeline-btn" data-etapa="reforma">REFORMA</button>
                    <button class="timeline-btn" data-etapa="intervencion">INTERVENCIÓN</button>
                    <button class="timeline-btn" data-etapa="porfiriato">PORFIRIATO</button>
                </div>
                
                <div class="timeline-visual">
                    <div class="timeline-bar">
                        <div class="timeline-marker" data-year="1821" style="left: 0%;">1821</div>
                        <div class="timeline-marker" data-year="1836" style="left: 16%;">1836</div>
                        <div class="timeline-marker" data-year="1848" style="left: 30%;">1848</div>
                        <div class="timeline-marker" data-year="1857" style="left: 40%;">1857</div>
                        <div class="timeline-marker" data-year="1867" style="left: 51%;">1867</div>
                        <div class="timeline-marker" data-year="1876" style="left: 61%;">1876</div>
                        <div class="timeline-marker" data-year="1910" style="left: 100%;">1910</div>
                        
                        <!-- Etapas -->
                        <div class="etapa-bar imperio" style="left: 0%; width: 2%;" data-etapa="imperio"></div>
                        <div class="etapa-bar republica" style="left: 2%; width: 14%;" data-etapa="republica"></div>
                        <div class="etapa-bar centralismo" style="left: 16%; width: 14%;" data-etapa="centralismo"></div>
                        <div class="etapa-bar guerra-eeuu" style="left: 30%; width: 10%;" data-etapa="guerra-eeuu"></div>
                        <div class="etapa-bar reforma" style="left: 40%; width: 11%;" data-etapa="reforma"></div>
                        <div class="etapa-bar intervencion" style="left: 51%; width: 10%;" data-etapa="intervencion"></div>
                        <div class="etapa-bar porfiriato" style="left: 61%; width: 39%;" data-etapa="porfiriato"></div>
                    </div>
                </div>
                
                <div class="timeline-info" id="timelineInfo">
                    Haz clic en una etapa para ver detalles históricos
                </div>
            </div>
        </div>

        <!-- ETAPAS DETALLADAS -->
        <div class="subseccion">
            <h3>3. Análisis por Etapa Histórica</h3>
            
            <!-- IMPERIO -->
            <div class="etapa-detalle" id="detalleImperio" style="display: none;">
                <div class="etapa-header">
                    <h4>👑 IMPERIO MEXICANO (1822-1823)</h4>
                    <div class="etapa-badge">11 meses</div>
                </div>
                <div class="etapa-content">
                    <div class="etapa-columna">
                        <h5>📜 Contexto</h5>
                        <p>Tras independencia, México busca modelo político. Iturbide se corona Agustín I</p>
                        <div class="dato">Ejército Trigarante → Imperio</div>
                    </div>
                    <div class="etapa-columna">
                        <h5>⚖️ Organización</h5>
                        <p>Monarquía constitucional, poder dividido entre emperador y congreso</p>
                        <div class="dato">Constitución de Apatzingán influencia liberal</div>
                    </div>
                    <div class="etapa-columna">
                        <h5>💥 Caída</h5>
                        <p>Oposición republicana, crisis económica, Plan de Casa Mata (1823)</p>
                        <div class="dato">Iturbide abdica y es exiliado</div>
                    </div>
                </div>
            </div>
            
            <!-- REPÚBLICA FEDERAL -->
            <div class="etapa-detalle" id="detalleRepublica" style="display: none;">
                <div class="etapa-header">
                    <h4>🏛️ PRIMERA REPÚBLICA FEDERAL (1824-1835)</h4>
                    <div class="etapa-badge">11 años</div>
                </div>
                <div class="etapa-content">
                    <div class="etapa-columna">
                        <h5>📜 Constitución 1824</h5>
                        <p>Primera constitución formal. República representativa, popular, federal</p>
                        <div class="dato">19 estados, 4 territorios, Distrito Federal</div>
                    </div>
                    <div class="etapa-columna">
                        <h5>👥 Presidentes</h5>
                        <p>Guadalupe Victoria (1824-1829) primer presidente</p>
                        <div class="dato">Vicente Guerrero (1829), Anastasio Bustamante</div>
                    </div>
                    <div class="etapa-columna">
                        <h5>💥 Conflictos</h5>
                        <p>Centralistas vs. federalistas, Masones Yorkinos vs. Escoceses</p>
                        <div class="dato">Primeros intentos separatistas en Yucatán, Texas</div>
                    </div>
                </div>
            </div>
            
            <!-- GUERRA EE.UU. -->
            <div class="etapa-detalle" id="detalleGuerraEeuu" style="display: none;">
                <div class="etapa-header">
                    <h4>💥 GUERRA MÉXICO-EE.UU. (1846-1848)</h4>
                    <div class="etapa-badge">2 años</div>
                </div>
                <div class="etapa-content">
                    <div class="etapa-columna">
                        <h5>🗺️ Causas</h5>
                        <p>Expansionismo estadounidense ("Destino Manifiesto"), anexión de Texas (1845)</p>
                        <div class="dato">Disputa frontera Río Nueces vs. Río Grande</div>
                    </div>
                    <div class="etapa-columna">
                        <h5>⚔️ Batallas</h5>
                        <p>Cerro Gordo, Chapultepec, Molino del Rey</p>
                        <div class="dato">Niños Héroes: 6 cadetes muertos en Chapultepec</div>
                    </div>
                    <div class="etapa-columna">
                        <h5>📜 Tratado Guadalupe Hidalgo</h5>
                        <p>México pierde 2.3 millones km² (55% territorio)</p>
                        <div class="dato">$15 millones compensación, línea fronteriza actual</div>
                    </div>
                </div>
            </div>
            
            <!-- REFORMA -->
            <div class="etapa-detalle" id="detalleReforma" style="display: none;">
                <div class="etapa-header">
                    <h4>⚖️ REFORMA LIBERAL (1855-1861)</h4>
                    <div class="etapa-badge">6 años intensos</div>
                </div>
                <div class="etapa-content">
                    <div class="etapa-columna">
                        <h5>📜 Leyes de Reforma</h5>
                        <p>Juárez (fueros eclesiásticos), Lerdo (desamortización), Iglesias (aranceles)</p>
                        <div class="dato">Separación Iglesia-Estado, nacionalización bienes</div>
                    </div>
                    <div class="etapa-columna">
                        <h5>📖 Constitución 1857</h5>
                        <p>Garantías individuales, enseñanza laica, libertad de imprenta</p>
                        <div class="dato">No reelección, juicio de amparo, derechos sociales</div>
                    </div>
                    <div class="etapa-columna">
                        <h5>💥 Guerra de Reforma</h5>
                        <p>Liberales (Juárez) vs. Conservadores (Miramón)</p>
                        <div class="dato">Gobierno itinerante de Juárez por el país</div>
                    </div>
                </div>
            </div>
            
            <!-- PORFIRIATO -->
            <div class="etapa-detalle" id="detallePorfiriato" style="display: none;">
                <div class="etapa-header">
                    <h4>🏗️ PORFIRIATO (1876-1911)</h4>
                    <div class="etapa-badge">35 años</div>
                </div>
                <div class="etapa-content">
                    <div class="etapa-columna">
                        <h5>🚂 Modernización</h5>
                        <p>20,000 km ferrocarril, telégrafo, electricidad, puertos, industria</p>
                        <div class="dato">"Orden y Progreso": estabilidad para inversión</div>
                    </div>
                    <div class="etapa-columna">
                        <h5>💰 Economía</h5>
                        <p>Inversión extranjera (EE.UU., UK, Francia), desarrollo minero, haciendas</p>
                        <div class="dato">Moneda estable, presupuesto equilibrado</div>
                    </div>
                    <div class="etapa-columna">
                        <h5>⚖️ Contradicciones</h5>
                        <p>Crecimiento económico + desigualdad social, represión, caciquismo</p>
                        <div class="dato">Huelgas de Cananea (1906) y Río Blanco (1907)</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ANÁLISIS COMPARATIVO -->
        <div class="subseccion">
            <h3>4. Modelos de Gobierno en Conflicto</h3>
            <div class="comparativa-grid">
                <div class="modelo-card">
                    <div class="modelo-icon">👑</div>
                    <h4>CONSERVADORES</h4>
                    <div class="modelo-desc">
                        Mantener privilegios coloniales: Iglesia, ejército, centralismo
                    </div>
                    <div class="modelo-datos">
                        <div class="dato"><strong>Líderes:</strong> Lucas Alamán, Miramón</div>
                        <div class="dato"><strong>Objetivo:</strong> Monarquía/centralismo</div>
                        <div class="dato"><strong>Apoyo:</strong> Iglesia, terratenientes</div>
                    </div>
                </div>
                
                <div class="modelo-card">
                    <div class="modelo-icon">⚖️</div>
                    <h4>LIBERALES MODERADOS</h4>
                    <div class="modelo-desc">
                        Reformas graduales, equilibrio entre tradición y cambio
                    </div>
                    <div class="modelo-datos">
                        <div class="dato"><strong>Líderes:</strong> Gómez Farías, Comonfort</div>
                        <div class="dato"><strong>Objetivo:</strong> República federal</div>
                        <div class="dato"><strong>Apoyo:</strong> Clase media urbana</div>
                    </div>
                </div>
                
                <div class="modelo-card">
                    <div class="modelo-icon">🔥</div>
                    <h4>LIBERALES PUROS</h4>
                    <div class="modelo-desc">
                        Transformación radical: Estado laico, federalismo, derechos
                    </div>
                    <div class="modelo-datos">
                        <div class="dato"><strong>Líderes:</strong> Juárez, Ocampo, Lerdo</div>
                        <div class="dato"><strong>Objetivo:</strong> República laica social</div>
                        <div class="dato"><strong>Apoyo:</strong> Intelectuales, artesanos</div>
                    </div>
                </div>
                
                <div class="modelo-card">
                    <div class="modelo-icon">🏗️</div>
                    <h4>CIENTÍFICOS</h4>
                    <div class="modelo-desc">
                        Modernización autoritaria: desarrollo económico sobre democracia
                    </div>
                    <div class="modelo-datos">
                        <div class="dato"><strong>Líderes:</strong> Díaz, Limantour</div>
                        <div class="dato"><strong>Objetivo:</strong> "Orden y Progreso"</div>
                        <div class="dato"><strong>Apoyo:</strong> Empresarios, extranjeros</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- DATOS ESTADÍSTICOS -->
        <div class="subseccion">
            <h3>5. México en Cifras: 1821-1910</h3>
            <div class="estadisticas-grid">
                <div class="estadistica-card">
                    <div class="estadistica-valor">50</div>
                    <div class="estadistica-label">Gobiernos</div>
                    <div class="estadistica-desc">89 años de inestabilidad</div>
                </div>
                
                <div class="estadistica-card">
                    <div class="estadistica-valor">55%</div>
                    <div class="estadistica-label">Territorio perdido</div>
                    <div class="estadistica-desc">2.3 millones km² (1848)</div>
                </div>
                
                <div class="estadistica-card">
                    <div class="estadistica-valor">3</div>
                    <div class="estadistica-label">Constituciones</div>
                    <div class="estadistica-desc">1824, 1857, 1917</div>
                </div>
                
                <div class="estadistica-card">
                    <div class="estadistica-valor">20,000</div>
                    <div class="estadistica-label">km ferrocarril</div>
                    <div class="estadistica-desc">Construidos 1876-1910</div>
                </div>
                
                <div class="estadistica-card">
                    <div class="estadistica-valor">35</div>
                    <div class="estadistica-label">Años Porfiriato</div>
                    <div class="estadistica-desc">Estabilidad autoritaria</div>
                </div>
                
                <div class="estadistica-card">
                    <div class="estadistica-valor">90%</div>
                    <div class="estadistica-label">Analfabetismo 1910</div>
                    <div class="estadistica-desc">A pesar de modernización</div>
                </div>
            </div>
        </div>
    </section>

    <!-- SIMULADOR INTERACTIVO: CONSTITUCIONES COMPARADAS -->
    <section class="simulator-section">
        <h2 class="seccion-titulo neon-interactivo">
            <span class="icon">🔄</span> SIMULADOR: EVOLUCIÓN CONSTITUCIONAL
        </h2>
        
        <div class="simulator-container" data-tema="constituciones-mexico">
            <!-- PANEL DE CONTROLES -->
            <div class="simulator-controls">
                <h3>COMPARADOR CONSTITUCIONAL</h3>
                
                <div class="control-group">
                    <label for="constitucionSelect">Constitución:</label>
                    <select id="constitucionSelect" class="control-select" onchange="cambiarConstitucion()">
                        <option value="1824">1824 (Primera República)</option>
                        <option value="1836">1836 (Siete Leyes - Centralista)</option>
                        <option value="1857">1857 (Reforma Liberal)</option>
                        <option value="1917">1917 (Revolucionaria)</option>
                    </select>
                </div>
                
                <div class="control-group">
                    <label>Temas a comparar:</label>
                    <div class="checkbox-group">
                        <label><input type="checkbox" name="temas" value="forma-gobierno" checked> Forma de gobierno</label>
                        <label><input type="checkbox" name="temas" value="religion"> Religión</label>
                        <label><input type="checkbox" name="temas" value="derechos"> Derechos</label>
                        <label><input type="checkbox" name="temas" value="reeleccion"> Reelección</label>
                        <label><input type="checkbox" name="temas" value="propiedad"> Propiedad</label>
                    </div>
                </div>
                
                <button class="btn-comparar" onclick="compararConstituciones()">
                    <span class="btn-icon">⚖️</span> COMPARAR MÚLTIPLES
                </button>
                
                <button class="btn-linea" onclick="mostrarEvolucion()">
                    <span class="btn-icon">📈</span> LÍNEA EVOLUTIVA
                </button>
            </div>
            
            <!-- VISUALIZACIÓN CONSTITUCIONAL -->
            <div class="simulator-visualization" id="visualizacionConstitucion">
                <div class="constitucion-container">
                    <div class="constitucion-header">
                        <h3 id="tituloConstitucion">CONSTITUCIÓN DE 1824</h3>
                        <div class="constitucion-subtitulo" id="subtituloConstitucion">Primera República Federal</div>
                    </div>
                    
                    <div class="constitucion-articulos">
                        <div class="articulo-card">
                            <div class="articulo-numero">Art. 1</div>
                            <div class="articulo-contenido" id="articulo1">
                                La Nación Mexicana es para siempre libre e independiente
                            </div>
                        </div>
                        
                        <div class="articulo-card">
                            <div class="articulo-numero">Art. 4</div>
                            <div class="articulo-contenido" id="articulo4">
                                La Nación adopta como forma de gobierno una república representativa popular federal
                            </div>
                        </div>
                        
                        <div class="articulo-card">
                            <div class="articulo-numero">Art. 3</div>
                            <div class="articulo-contenido" id="articulo3">
                                La religión de la Nación es la Católica, Apostólica, Romana
                            </div>
                        </div>
                        
                        <div class="articulo-card highlight">
                            <div class="articulo-numero">Art. 50</div>
                            <div class="articulo-contenido" id="articulo50">
                                Se divide el Supremo Poder de la Federación para su ejercicio en Legislativo, Ejecutivo y Judicial
                            </div>
                        </div>
                    </div>
                    
                    <div class="constitucion-estadisticas">
                        <div class="estadistica">
                            <span class="estadistica-label">Artículos:</span>
                            <span class="estadistica-valor" id="totalArticulos">171</span>
                        </div>
                        <div class="estadistica">
                            <span class="estadistica-label">Vigencia:</span>
                            <span class="estadistica-valor" id="vigenciaConstitucion">1824-1835</span>
                        </div>
                        <div class="estadistica">
                            <span class="estadistica-label">Carácter:</span>
                            <span class="estadistica-valor" id="caracterConstitucion">Federalista</span>
                        </div>
                    </div>
                </div>
                <div class="constitucion-info" id="infoConstitucion">
                    Selecciona una constitución para analizar sus características
                </div>
            </div>
            
            <!-- DATOS COMPARATIVOS -->
            <div class="simulator-data">
                <h3>DATOS CONSTITUCIONALES</h3>
                
                <div class="data-card">
                    <div class="data-label">Constitución:</div>
                    <div class="data-value" id="dataConstitucion">1824</div>
                </div>
                
                <div class="data-card">
                    <div class="data-label">Forma de gobierno:</div>
                    <div class="data-value" id="dataGobierno">República federal</div>
                </div>
                
                <div class="data-card">
                    <div class="data-label">Religión oficial:</div>
                    <div class="data-value" id="dataReligion">Católica</div>
                </div>
                
                <div class="data-card highlight">
                    <div class="data-label">INNOVACIÓN PRINCIPAL:</div>
                    <div class="data-value" id="dataInnovacion">División de poderes</div>
                </div>
                
                <div class="data-card">
                    <div class="data-label">Derechos reconocidos:</div>
                    <div class="data-value" id="dataDerechos">Limitados</div>
                </div>
                
                <div class="data-card">
                    <div class="data-label">Duración:</div>
                    <div class="data-value" id="dataDuracion">11 años</div>
                </div>
                
                <div class="estadisticas">
                    <h4>📊 COMPARATIVA HISTÓRICA</h4>
                    <div class="stat-item">
                        <span>1824 (Federal):</span>
                        <span class="stat-value">19 estados</span>
                    </div>
                    <div class="stat-item">
                        <span>1836 (Centralista):</span>
                        <span class="stat-value">24 departamentos</span>
                    </div>
                    <div class="stat-item">
                        <span>1857 (Liberal):</span>
                        <span class="stat-value">Garantías individuales</span>
                    </div>
                    <div class="stat-item">
                        <span>1917 (Social):</span>
                        <span class="stat-value">Derechos sociales</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- QUIZ INTERACTIVO -->
    <section class="quiz-section">
        <h2 class="seccion-titulo neon-evaluacion">
            <span class="icon">❓</span> QUIZ: MÉXICO SIGLO XIX
        </h2>
        
        <div class="quiz-container">
            <!-- PREGUNTA 1 -->
            <div class="quiz-question" data-correct="C">
                <div class="quiz-header">
                    <span class="quiz-num">01</span>
                    <h3>¿Qué porcentaje del territorio perdió México en la guerra con EE.UU. (1848)?</h3>
                </div>
                
                <div class="quiz-options">
                    <button class="quiz-option" data-value="A">
                        <span class="option-letter">A</span>
                        25%
                    </button>
                    <button class="quiz-option" data-value="B">
                        <span class="option-letter">B</span>
                        40%
                    </button>
                    <button class="quiz-option" data-value="C">
                        <span class="option-letter">C</span>
                        55%
                    </button>
                    <button class="quiz-option" data-value="D">
                        <span class="option-letter">D</span>
                        70%
                    </button>
                </div>
                
                <div class="quiz-feedback" style="display: none;">
                    <div class="feedback-correct">
                        ✅ <strong>Correcto:</strong> México perdió 55% de su territorio original (2.3 millones km²).
                    </div>
                    <div class="feedback-incorrect">
                        ❌ <strong>Incorrecto:</strong> La pérdida fue catastrófica: California, Nuevo México, Arizona, Nevada, Utah, partes de otros estados.
                    </div>
                    <div class="feedback-explicacion">
                        <p><strong>Dato:</strong> El Tratado de Guadalupe Hidalgo (1848) estableció la frontera actual. México recibió $15 millones como compensación. Población afectada: 80,000 mexicanos en territorios perdidos.</p>
                    </div>
                </div>
            </div>
            
            <!-- PREGUNTA 2 -->
            <div class="quiz-question" data-correct="B">
                <div class="quiz-header">
                    <span class="quiz-num">02</span>
                    <h3>¿Cuál fue la principal innovación de la Constitución de 1857?</h3>
                </div>
                
                <div class="quiz-options">
                    <button class="quiz-option" data-value="A">
                        <span class="option-letter">A</span>
                        Establecer el centralismo
                    </button>
                    <button class="quiz-option" data-value="B">
                        <span class="option-letter">B</span>
                        Garantías individuales y Estado laico
                    </button>
                    <button class="quiz-option" data-value="C">
                        <span class="option-letter">C</span>
                        Restaurar la monarquía
                    </button>
                    <button class="quiz-option" data-value="D">
                        <span class="option-letter">D</span>
                        Permitir la reelección indefinida
                    </button>
                </div>
                
                <div class="quiz-feedback" style="display: none;">
                    <div class="feedback-correct">
                        ✅ <strong>Correcto:</strong> La Constitución de 1857 estableció garantías individuales y separó Iglesia-Estado.
                    </div>
                    <div class="feedback-incorrect">
                        ❌ <strong>Incorrecto:</strong> Fue precisamente lo contrario: federalismo, laicismo, y prohibición de reelección.
                    </div>
                    <div class="feedback-explicacion">
                        <p><strong>Explicación:</strong> La Constitución de 1857 incluyó: libertad de enseñanza, trabajo, imprenta; juicio de amparo; prohibición de fueros; registro civil; matrimonio civil; nacionalización de bienes eclesiásticos.</p>
                    </div>
                </div>
            </div>
            
            <!-- PREGUNTA 3 -->
            <div class="quiz-question" data-correct="D">
                <div class="quiz-header">
                    <span class="quiz-num">03</span>
                    <h3>¿Qué caracterizó la política económica del Porfiriato?</h3>
                </div>
                
                <div class="quiz-options">
                    <button class="quiz-option" data-value="A">
                        <span class="option-letter">A</span>
                        Nacionalización de industrias
                    </button>
                    <button class="quiz-option" data-value="B">
                        <span class="option-letter">B</span>
                        Redistribución de tierras
                    </button>
                    <button class="quiz-option" data-value="C">
                        <span class="option-letter">C</span>
                        Aislamiento económico
                    </button>
                    <button class="quiz-option" data-value="D">
                        <span class="option-letter">D</span>
                        Inversión extranjera y desarrollo infraestructura
                    </button>
                </div>
                
                <div class="quiz-feedback" style="display: none;">
                    <div class="feedback-correct">
                        ✅ <strong>Correcto:</strong> "Orden y Progreso" se basó en inversión extranjera y modernización.
                    </div>
                    <div class="feedback-incorrect">
                        ❌ <strong>Incorrecto:</strong> El Porfiriato fue precisamente lo contrario: privatización, concentración de tierras, apertura al exterior.
                    </div>
                    <div class="feedback-explicacion">
                        <p><strong>Solución:</strong> Se construyeron 20,000 km de ferrocarril, se desarrolló minería, petróleo, industria. Pero la riqueza se concentró: 1% población controlaba 97% tierras cultivables. Salario real cayó 20% 1877-1910.</p>
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

    <!-- PROBLEMAS TIPO EXAMEN -->
    <section class="examen-section">
        <h2 class="seccion-titulo neon-evaluacion">
            <span class="icon">📝</span> ANÁLISIS HISTÓRICO COMPARATIVO
        </h2>
        
        <div class="examen-container">
            <div class="problema-card">
                <div class="problema-header">
                    <span class="problema-num">P1</span>
                    <h3>Análisis: Liberalismo vs. Conservadurismo</h3>
                </div>
                <div class="problema-enunciado">
                    <p>Compara los proyectos de nación de liberales y conservadores en el siglo XIX:</p>
                    
                    <div class="tabla-comparativa">
                        <table>
                            <tr>
                                <th>Aspecto</th>
                                <th>PROYECTO LIBERAL</th>
                                <th>PROYECTO CONSERVADOR</th>
                            </tr>
                            <tr>
                                <td><strong>Forma de gobierno</strong></td>
                                <td><textarea placeholder="Describe el modelo liberal..." rows="3"></textarea></td>
                                <td><textarea placeholder="Describe el modelo conservador..." rows="3"></textarea></td>
                            </tr>
                            <tr>
                                <td><strong>Relación Iglesia-Estado</strong></td>
                                <td><textarea placeholder="Postura liberal..." rows="3"></textarea></td>
                                <td><textarea placeholder="Postura conservadora..." rows="3"></textarea></td>
                            </tr>
                            <tr>
                                <td><strong>Organización territorial</strong></td>
                                <td><textarea placeholder="Federalismo/centralismo liberal..." rows="3"></textarea></td>
                                <td><textarea placeholder="Federalismo/centralismo conservador..." rows="3"></textarea></td>
                            </tr>
                            <tr>
                                <td><strong>Modelo económico</strong></td>
                                <td><textarea placeholder="Economía liberal..." rows="3"></textarea></td>
                                <td><textarea placeholder="Economía conservadora..." rows="3"></textarea></td>
                            </tr>
                        </table>
                    </div>
                    
                    <p><strong>Pregunta de síntesis:</strong> ¿Por qué el proyecto liberal terminó imponiéndose a pesar de la resistencia conservadora?</p>
                    <textarea placeholder="Escribe tu análisis..." rows="4"></textarea>
                </div>
                <button class="btn-verificar" onclick="verificarProblema(1)">VERIFICAR ANÁLISIS</button>
                <div class="problema-solucion" id="solucionP1" style="display: none;">
                    <strong>Análisis sugerido:</strong><br>
                    <strong>Liberales:</strong> República federal, Estado laico, división de poderes, garantías individuales, libre comercio, propiedad privada.<br>
                    <strong>Conservadores:</strong> Centralismo/monarquía, unión Iglesia-Estado, fueros, proteccionismo, mantenimiento privilegios coloniales.<br><br>
                    <strong>Ventaja liberal:</strong> Adaptación al mundo moderno, apoyo de clases medias emergentes, legitimidad de soberanía popular, capacidad de movilización social. La derrota conservadora en la Intervención Francesa (1867) consolidó el proyecto liberal.
                </div>
            </div>
            
            <div class="problema-card">
                <div class="problema-header">
                    <span class="problema-num">P2</span>
                    <h3>Evaluación Crítica del Porfiriato</h3>
                </div>
                <div class="problema-enunciado">
                    <p>Evalúa críticamente el Porfiriato (1876-1911) considerando:</p>
                    
                    <div class="balanza-evaluativa">
                        <div class="balanza-lado positivo">
                            <h4>✅ LOGROS Y AVANCES</h4>
                            <ul>
                                <li>Estabilidad política después de décadas de caos</li>
                                <textarea placeholder="Describe otros logros..." rows="2"></textarea>
                                <li>Crecimiento económico e inversión</li>
                                <textarea placeholder="Especifica cifras o ejemplos..." rows="2"></textarea>
                                <li>Modernización infraestructura</li>
                                <textarea placeholder="Menciona obras específicas..." rows="2"></textarea>
                            </ul>
                        </div>
                        
                        <div class="balanza-lado negativo">
                            <h4>❌ COSTOS Y LIMITACIONES</h4>
                            <ul>
                                <li>Autoritarismo y falta de democracia</li>
                                <textarea placeholder="Describe mecanismos de control..." rows="2"></textarea>
                                <li>Desigualdad social extrema</li>
                                <textarea placeholder="Menciona datos de concentración..." rows="2"></textarea>
                                <li>Dependencia del capital extranjero</li>
                                <textarea placeholder="Analiza consecuencias..." rows="2"></textarea>
                            </ul>
                        </div>
                    </div>
                    
                    <p><strong>Pregunta de valoración:</strong> ¿Fue el Porfiriato necesario para el desarrollo de México o podía haberse logrado el progreso con democracia?</p>
                    <textarea placeholder="Escribe tu valoración argumentada..." rows="4"></textarea>
                </div>
                <button class="btn-verificar" onclick="verificarProblema(2)">VERIFICAR EVALUACIÓN</button>
                <div class="problema-solucion" id="solucionP2" style="display: none;">
                    <strong>Evaluación balanceada:</strong><br>
                    <strong>Logros:</strong> Estabilidad (35 años sin guerras), 20,000 km ferrocarril, industria, minería, educación (aunque limitada), finanzas ordenadas.<br>
                    <strong>Costos:</strong> Dictadura, represión (Rurales), concentración tierra (97% en 1%), salarios bajos, analfabetismo 90%, dependencia económica.<br><br>
                    <strong>Valoración:</strong> El Porfiriato demostró que México podía modernizarse, pero a un costo social intolerable. La Revolución fue la respuesta a esta contradicción. Sí era posible desarrollo con mayor justicia social.
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
                    <td>Comprensión histórica</td>
                    <td>Analiza causas y consecuencias de cada etapa</td>
                    <td>Describe eventos principales correctamente</td>
                    <td>Confunde etapas o personajes históricos</td>
                </tr>
                <tr>
                    <td>Análisis comparativo</td>
                    <td>Contrasta efectivamente modelos en conflicto</td>
                    <td>Identifica algunas diferencias entre proyectos</td>
                    <td>No logra establecer comparaciones válidas</td>
                </tr>
                <tr>
                    <td>Evaluación crítica</td>
                    <td>Valora logros y límites con argumentos sólidos</td>
                    <td>Menciona algunos aspectos positivos y negativos</td>
                    <td>Ofrece juicios simplistas o no fundamentados</td>
                </tr>
            </table>
        </div>
    </section>

    <!-- CIERRE METACOGNITIVO -->
    <section class="cierre-section">
        <h2 class="seccion-titulo neon-concepto">
            <span class="icon">🧠</span> REFLEXIÓN SOBRE LA CONSTRUCCIÓN NACIONAL
        </h2>
        
        <div class="cierre-container">
            <div class="autoevaluacion">
                <h3>📊 AUTOEVALUACIÓN DE CONOCIMIENTOS</h3>
                <div class="slider-group">
                    <label>Conocimiento de etapas históricas:</label>
                    <input type="range" min="1" max="5" value="3" class="autoeval-slider" id="slider1">
                    <div class="slider-labels">
                        <span>Básico</span><span>Intermedio</span><span>Avanzado</span>
                    </div>
                </div>
                
                <div class="slider-group">
                    <label>Análisis de conflictos ideológicos:</label>
                    <input type="range" min="1" max="5" value="3" class="autoeval-slider" id="slider2">
                    <div class="slider-labels">
                        <span>Básico</span><span>Intermedio</span><span>Avanzado</span>
                    </div>
                </div>
                
                <div class="slider-group">
                    <label>Evaluación de proyectos nacionales:</label>
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
                    <p>¿Qué lecciones del México independiente (1821-1910) consideras relevantes para los desafíos actuales del país?</p>
                    <textarea placeholder="Escribe tu reflexión aquí..." rows="4" id="reflexion1"></textarea>
                </div>
                <div class="pregunta-reflexion">
                    <p>¿Cómo explicas que un país con tanto potencial (recursos, territorio) tuviera tantas dificultades para consolidarse en el siglo XIX?</p>
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
                        <li>Memorizar las 7 etapas clave 1821-1910</li>
                        <li>Recordar fechas de constituciones</li>
                        <li>Identificar líderes principales por etapa</li>
                    </ul>
                </div>
                <div class="plan-card">
                    <h4>💪 PRÁCTICA (30 min)</h4>
                    <ul>
                        <li>Explorar simulador constitucional</li>
                        <li>Completar el quiz de autoevaluación</li>
                        <li>Comparar proyectos liberal vs. conservador</li>
                    </ul>
                </div>
                <div class="plan-card">
                    <h4>🚀 PROFUNDIZACIÓN (45 min)</h4>
                    <ul>
                        <li>Analizar un documento histórico específico</li>
                        <li>Investigar consecuencias de la pérdida territorial</li>
                        <li>Estudiar continuidades porfiristas en México actual</li>
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="recursos">
            <h3>🔗 RECURSOS ADICIONALES</h3>
            <div class="recursos-links">
                <a href="https://www.diputados.gob.mx/biblioteca/bibdig/const_mex/const_1824.pdf" target="_blank" class="recurso-link">
                    📜 Constitución de 1824 (texto original)
                </a>
                <a href="https://www.diputados.gob.mx/biblioteca/bibdig/const_mex/const_1857.pdf" target="_blank" class="recurso-link">
                    📖 Constitución de 1857 (texto original)
                </a>
                <a href="https://www.inehrm.gob.mx/" target="_blank" class="recurso-link">
                    🏛️ INEHRM: Instituto de Estudios Históricos
                </a>
                <a href="https://archivohistorico2010.sre.gob.mx/" target="_blank" class="recurso-link">
                    🗃️ Archivo Histórico de la Secretaría de Relaciones Exteriores
                </a>
            </div>
        </div>
    </section>

    <!-- JAVASCRIPT INTEGRADO -->
    <script>
    // ========================================
    // SIMULADOR CONSTITUCIONAL
    // ========================================
    
    const constituciones = {
        "1824": {
            nombre: "Constitución Federal de 1824",
            subtitulo: "Primera República Federal",
            articulo1: "La Nación Mexicana es para siempre libre e independiente del gobierno español y de cualquier otra potencia.",
            articulo3: "La religión de la Nación Mexicana es y será perpetuamente la católica, apostólica, romana. La Nación la protege por leyes sabias y justas.",
            articulo4: "La Nación Mexicana adopta para su gobierno la forma de república representativa popular federal.",
            articulo50: "Se divide el supremo poder de la federación para su ejercicio en legislativo, ejecutivo y judicial.",
            totalArticulos: "171",
            vigencia: "1824-1835",
            caracter: "Federalista",
            formaGobierno: "República federal representativa",
            religion: "Católica (oficial y única)",
            derechos: "Limitados, sin garantías individuales explícitas",
            innovacion: "División de poderes y federalismo",
            color: "#1976D2"
        },
        "1836": {
            nombre: "Siete Leyes Constitucionales",
            subtitulo: "Régimen Centralista (1836-1846)",
            articulo1: "La Nación Mexicana se compone de todos los mexicanos. Es libre e independiente.",
            articulo3: "La religión de la Nación Mexicana es la católica, apostólica, romana. El Estado la protege.",
            articulo4: "El gobierno de la Nación será popular, representativo, alternativo y responsable.",
            articulo50: "El Supremo Poder Conservador vigila que los otros poderes no excedan sus límites.",
            totalArticulos: "7 leyes (no artículos)",
            vigencia: "1836-1846",
            caracter: "Centralista",
            formaGobierno: "República central representativa",
            religion: "Católica (oficial y única)",
            derechos: "Muy limitados, supremacía del Estado",
            innovacion: "Supremo Poder Conservador (4º poder)",
            color: "#D32F2F"
        },
        "1857": {
            nombre: "Constitución Federal de 1857",
            subtitulo: "Reforma Liberal",
            articulo1: "El pueblo mexicano reconoce que los derechos del hombre son la base y el objeto de las instituciones sociales.",
            articulo3: "La enseñanza es libre. La ley determinará qué profesiones necesitan título para su ejercicio.",
            articulo4: "Todo hombre es libre para abrazar la profesión, industria o trabajo que le acomode.",
            articulo50: "El Supremo Poder de la Federación se divide para su ejercicio en Legislativo, Ejecutivo y Judicial.",
            totalArticulos: "128",
            vigencia: "1857-1917",
            caracter: "Liberal federalista",
            formaGobierno: "República federal representativa",
            religion: "Libertad de cultos (Estado laico)",
            derechos: "Garantías individuales extensas",
            innovacion: "Juicio de amparo, Estado laico",
            color: "#388E3C"
        },
        "1917": {
            nombre: "Constitución Política de 1917",
            subtitulo: "Revolucionaria (vigente)",
            articulo1: "En los Estados Unidos Mexicanos todas las personas gozarán de los derechos humanos reconocidos en esta Constitución.",
            articulo3: "La educación será laica y gratuita. La educación preescolar, primaria y secundaria conforman la educación básica obligatoria.",
            articulo4: "El varón y la mujer son iguales ante la ley. Toda persona tiene derecho a la protección de la salud.",
            articulo50: "El Supremo Poder de la Unión se divide para su ejercicio en Legislativo, Ejecutivo y Judicial.",
            totalArticulos: "136",
            vigencia: "1917-actualidad",
            caracter: "Social revolucionaria",
            formaGobierno: "República federal representativa",
            religion: "Libertad de cultos (Estado laico)",
            derechos: "Derechos humanos y sociales",
            innovacion: "Derechos sociales (trabajo, tierra, educación)",
            color: "#FF6F00"
        }
    };
    
    function cambiarConstitucion() {
        const constitucionId = document.getElementById(\'constitucionSelect\').value;
        const constitucion = constituciones[constitucionId];
        
        if (!constitucion) return;
        
        // Actualizar interfaz
        document.getElementById(\'tituloConstitucion\').textContent = constitucion.nombre;
        document.getElementById(\'subtituloConstitucion\').textContent = constitucion.subtitulo;
        document.getElementById(\'articulo1\').textContent = constitucion.articulo1;
        document.getElementById(\'articulo3\').textContent = constitucion.articulo3;
        document.getElementById(\'articulo4\').textContent = constitucion.articulo4;
        document.getElementById(\'articulo50\').textContent = constitucion.articulo50;
        document.getElementById(\'totalArticulos\').textContent = constitucion.totalArticulos;
        document.getElementById(\'vigenciaConstitucion\').textContent = constitucion.vigencia;
        document.getElementById(\'caracterConstitucion\').textContent = constitucion.caracter;
        
        // Actualizar datos
        document.getElementById(\'dataConstitucion\').textContent = constitucionId;
        document.getElementById(\'dataGobierno\').textContent = constitucion.formaGobierno;
        document.getElementById(\'dataReligion\').textContent = constitucion.religion;
        document.getElementById(\'dataInnovacion\').textContent = constitucion.innovacion;
        document.getElementById(\'dataDerechos\').textContent = constitucion.derechos;
        document.getElementById(\'dataDuracion\').textContent = constitucion.vigencia.split(\'-\')[1] === "actualidad" ? "100+ años" : constitucion.vigencia;
        
        // Actualizar información
        const infoTextos = {
            "1824": "📜 CONSTITUCIÓN DE 1824: Primera constitución formal. República federal (19 estados). Religión católica oficial. Influencia de la Constitución de EE.UU. Vigente 1824-1835.",
            "1836": "📜 SIETE LEYES (1836): Constitución centralista. Creó el Supremo Poder Conservador (4º poder). 24 departamentos en lugar de estados. Mayor poder ejecutivo. Vigente 1836-1846.",
            "1857": "📜 CONSTITUCIÓN DE 1857: Triunfo liberal. Garantías individuales, Estado laico, juicio de amparo. Prohibición de fueros, libertad de enseñanza. Vigente 1857-1917.",
            "1917": "📜 CONSTITUCIÓN DE 1917: Primera constitución social del mundo. Art. 27 (tierra), 123 (trabajo), 3 (educación). Mantiene estructura de 1857 con derechos sociales. Vigente hoy."
        };
        
        document.getElementById(\'infoConstitucion\').textContent = infoTextos[constitucionId] || "Información no disponible";
        document.getElementById(\'infoConstitucion\').style.animation = "highlight 0.5s";
        
        console.log(`📜 Constitución seleccionada: ${constitucion.nombre}`);
    }
    
    function compararConstituciones() {
        const checkboxes = document.querySelectorAll(\'input[name="temas"]:checked\');
        const temas = Array.from(checkboxes).map(cb => cb.value);
        const constitucionId = document.getElementById(\'constitucionSelect\').value;
        const constitucion = constituciones[constitucionId];
        
        let comparativa = `🔍 COMPARATIVA CONSTITUCIONAL (${constitucion.nombre}):\\n\\n`;
        
        if (temas.includes(\'forma-gobierno\')) {
            comparativa += `🏛️ FORMA DE GOBIERNO: ${constitucion.formaGobierno}\\n`;
        }
        if (temas.includes(\'religion\')) {
            comparativa += `⛪ RELIGIÓN: ${constitucion.religion}\\n`;
        }
        if (temas.includes(\'derechos\')) {
            comparativa += `⚖️ DERECHOS: ${constitucion.derechos}\\n`;
        }
        if (temas.includes(\'reeleccion\')) {
            comparativa += `🔄 REELEXIÓN: ${constitucionId === "1857" ? "Prohibida" : "No regulada"}\\n`;
        }
        if (temas.includes(\'propiedad\')) {
            comparativa += `🏠 PROPIEDAD: ${constitucionId === "1917" ? "Función social" : "Propiedad privada"}\\n`;
        }
        
        comparativa += "\\n💡 Cada constitución refleja el contexto histórico de su época.";
        
        alert(comparativa);
    }
    
    function mostrarEvolucion() {
        const evolucion = `
📈 EVOLUCIÓN CONSTITUCIONAL MEXICANA:

1824: 👶 NACIMIENTO
• Primer intento organizativo
• Federalismo copiado de EE.UU.
• Religión católica oficial

1836: 🔄 REACCIÓN
• Centralismo conservador
• Supremo Poder Conservador
• Mayor control estatal

1857: ⚖️ RUPTURA
• Estado laico
• Garantías individuales
• Liberalismo triunfante

1917: 🚀 REVOLUCIÓN
• Derechos sociales
• Soberanía sobre recursos
• Educación laica y gratuita

📊 TENDENCIA: Mayor inclusión de derechos y participación popular.
        `;
        
        alert(evolucion);
    }
    
    // ========================================
    // LÍNEA DE TIEMPO INTERACTIVA
    // ========================================
    
    const etapasInfo = {
        imperio: {
            nombre: "IMPERIO MEXICANO",
            periodo: "1822-1823",
            duracion: "11 meses",
            descripcion: "Iturbide se corona Agustín I. Monarquía constitucional efímera.",
            color: "#FFB300"
        },
        republica: {
            nombre: "REPÚBLICA FEDERAL",
            periodo: "1824-1835",
            duracion: "11 años",
            descripcion: "Constitución de 1824. Guadalupe Victoria primer presidente.",
            color: "#1976D2"
        },
        centralismo: {
            nombre: "CENTRALISMO",
            periodo: "1835-1846",
            duracion: "11 años",
            descripcion: "Siete Leyes de 1836. 24 departamentos en lugar de estados.",
            color: "#D32F2F"
        },
        "guerra-eeuu": {
            nombre: "GUERRA MÉXICO-EE.UU.",
            periodo: "1846-1848",
            duracion: "2 años",
            descripcion: "Pérdida del 55% territorio. Tratado Guadalupe Hidalgo.",
            color: "#7B1FA2"
        },
        reforma: {
            nombre: "REFORMA LIBERAL",
            periodo: "1855-1861",
            duracion: "6 años",
            descripcion: "Leyes de Reforma, Constitución 1857, Estado laico.",
            color: "#388E3C"
        },
        intervencion: {
            nombre: "INTERVENCIÓN FRANCESA",
            periodo: "1862-1867",
            duracion: "5 años",
            descripcion: "Segundo Imperio con Maximiliano. Batalla del 5 de Mayo.",
            color: "#0097A7"
        },
        porfiriato: {
            nombre: "PORFIRIATO",
            periodo: "1876-1911",
            duracion: "35 años",
            descripcion: "Dictadura de Porfirio Díaz. Modernización y desigualdad.",
            color: "#FF6F00"
        }
    };
    
    document.querySelectorAll(\'.timeline-btn\').forEach(btn => {
        btn.addEventListener(\'click\', function() {
            const etapa = this.dataset.etapa;
            mostrarDetalleEtapa(etapa);
            
            // Resaltar en timeline
            document.querySelectorAll(\'.etapa-bar\').forEach(bar => {
                bar.classList.remove(\'active\');
            });
            document.querySelector(`.etapa-bar[data-etapa="${etapa}"]`).classList.add(\'active\');
        });
    });
    
    function mostrarDetalleEtapa(etapa) {
        const info = etapasInfo[etapa];
        if (!info) return;
        
        // Ocultar todos los detalles
        document.querySelectorAll(\'.etapa-detalle\').forEach(detalle => {
            detalle.style.display = \'none\';
        });
        
        // Mostrar el detalle correspondiente
        const detalle = document.getElementById(`detalle${etapa.charAt(0).toUpperCase() + etapa.slice(1)}`);
        if (detalle) {
            detalle.style.display = \'block\';
        }
        
        // Actualizar información
        document.getElementById(\'timelineInfo\').innerHTML = `
            <strong>${info.nombre}</strong> (${info.periodo})<br>
            ${info.descripcion}<br>
            <small>Duración: ${info.duracion}</small>
        `;
        document.getElementById(\'timelineInfo\').style.animation = "highlight 0.5s";
        
        // Cambiar color de la barra
        document.querySelectorAll(\'.timeline-btn\').forEach(btn => {
            btn.style.background = \'\';
        });
        document.querySelector(`[data-etapa="${etapa}"]`).style.background = info.color;
        
        console.log(`📅 Etapa seleccionada: ${info.nombre}`);
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
            feedback = "🎉 ¡Excelente! Dominas el México independiente.";
        } else if (porcentaje >= 60) {
            feedback = "👍 Buen trabajo, pero revisa las etapas de crisis.";
        } else {
            feedback = "📚 Necesitas repasar el siglo XIX mexicano.";
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
    // SISTEMA DE AUTOEVALUACIÓN
    // ========================================
    
    function guardarAutoevaluacion() {
        const slider1 = document.getElementById(\'slider1\').value;
        const slider2 = document.getElementById(\'slider2\').value;
        const slider3 = document.getElementById(\'slider3\').value;
        
        const promedio = (parseInt(slider1) + parseInt(slider2) + parseInt(slider3)) / 3;
        
        alert(`📊 AutoEvaluación guardada:\\n\\n` +
              `Etapas históricas: ${slider1}/5\\n` +
              `Conflictos ideológicos: ${slider2}/5\\n` +
              `Evaluación proyectos: ${slider3}/5\\n\\n` +
              `Promedio: ${promedio.toFixed(1)}/5\\n\\n` +
              `Revisa el plan de estudio recomendado según tus resultados.`);
        
        console.log(`💾 AutoEvaluación guardada: ${slider1}, ${slider2}, ${slider3}`);
    }
    
    // ========================================
    // INICIALIZACIÓN
    // ========================================
    
    console.log("🚀 Sistema Cyberpunk Independiente inicializado");
    console.log("📚 Lección: México Independiente (1821-1910)");
    console.log("⚡ Simulador constitucional, Timeline y Quiz listos");
    
    // Inicializar simulador
    cambiarConstitucion();
    mostrarDetalleEtapa(\'imperio\');
    
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
    
    // Modelos interactivos
    document.querySelectorAll(\'.modelo-card\').forEach(card => {
        card.addEventListener(\'click\', function() {
            const modelo = this.querySelector(\'h4\').textContent;
            
            const modelosInfo = {
                "CONSERVADORES": "👑 CONSERVADORES: Mantener privilegios coloniales. Monarquía/centralismo. Unión Iglesia-Estado. Proteccionismo económico. Base social: Iglesia, ejército, terratenientes.",
                "LIBERALES MODERADOS": "⚖️ LIBERALES MODERADOS: Reformas graduales. República federal. Separación relativa Iglesia-Estado. Libre comercio moderado. Base: clase media urbana.",
                "LIBERALES PUROS": "🔥 LIBERALES PUROS: Transformación radical. República laica federal. Separación total Iglesia-Estado. Libre comercio absoluto. Garantías individuales. Base: intelectuales, artesanos.",
                "CIENTÍFICOS": "🏗️ CIENTÍFICOS: Modernización autoritaria. República centralizada de facto. Estado fuerte, Iglesia controlada. Capitalismo dependiente. \'Orden y Progreso\'. Base: empresarios, extranjeros."
            };
            
            alert(`${modelo}\\n\\n${modelosInfo[modelo] || "Información no disponible"}`);
        });
    });
    
    // Problemas de examen
    function verificarProblema(num) {
        const solucion = document.getElementById(`solucionP${num}`);
        solucion.style.display = solucion.style.display === \'block\' ? \'none\' : \'block\';
    }
    
    // Estadísticas interactivas
    document.querySelectorAll(\'.estadistica-card\').forEach(card => {
        card.addEventListener(\'click\', function() {
            const valor = this.querySelector(\'.estadistica-valor\').textContent;
            const label = this.querySelector(\'.estadistica-label\').textContent;
            
            const datosInfo = {
                "50": "50 gobiernos en 89 años (1821-1910). Promedio: 1.8 años por gobierno. Inestabilidad crónica.",
                "55%": "55% territorio perdido (2.3 millones km²). Incluye California, Texas, Arizona, Nuevo México, Nevada, Utah, Colorado, Wyoming.",
                "3": "3 constituciones en siglo XIX: 1824 (federal), 1836 (centralista), 1857 (liberal). La de 1917 completa el ciclo.",
                "20,000": "20,000 km de ferrocarril construidos 1876-1910. Red que integró económicamente al país.",
                "35": "35 años de Porfiriato (1876-1911). Estabilidad autoritaria más larga en México independiente.",
                "90%": "90% analfabetismo en 1910. A pesar de modernización, educación solo para elites."
            };
            
            this.style.animation = "pulse 0.5s";
            setTimeout(() => {
                this.style.animation = "";
            }, 500);
            
            console.log(`📊 Dato estadístico: ${valor} ${label}`);
        });
    });
    
    // Efecto de pulse para animaciones
    const style = document.createElement(\'style\');
    style.textContent = `
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
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
        'enunciado' => 'Duración Imperio Iturbide',
        'respuesta' => '1 año (1822-1823)',
      ),
      1 => 
      array (
        'enunciado' => 'Pérdida territorial 1848',
        'respuesta' => '2.3 millones km²',
      ),
      2 => 
      array (
        'enunciado' => 'Autor Leyes de Reforma',
        'respuesta' => 'Benito Juárez',
      ),
      3 => 
      array (
        'enunciado' => 'Duración Porfiriato',
        'respuesta' => '35 años (1876-1911)',
      ),
      4 => 
      array (
        'enunciado' => 'Constitución federal',
        'respuesta' => '1824',
      ),
      5 => 
      array (
        'enunciado' => 'Batalla 5 de Mayo',
        'respuesta' => '1862, Puebla',
      ),
      6 => 
      array (
        'enunciado' => 'Emperador francés',
        'respuesta' => 'Maximiliano',
      ),
      7 => 
      array (
        'enunciado' => 'Lema Porfiriato',
        'respuesta' => 'Orden y Progreso',
      ),
      8 => 
      array (
        'enunciado' => 'Tratado final guerra EE.UU.',
        'respuesta' => 'Guadalupe Hidalgo',
      ),
      9 => 
      array (
        'enunciado' => 'Ley Lerdo',
        'respuesta' => 'Desamortización 1856',
      ),
      10 => 
      array (
        'enunciado' => 'Número de gobiernos 1821-1910',
        'respuesta' => '~50',
      ),
      11 => 
      array (
        'enunciado' => 'SI: años República Restaurada',
        'respuesta' => '1867-1876',
      ),
    ),
    'quiz' => 
    array (
      0 => 
      array (
        'pregunta' => 'Primer emperador',
        'opciones' => 
        array (
          0 => 'Iturbide',
          1 => 'Santa Anna',
          2 => 'Juárez',
          3 => 'Díaz',
        ),
        'correcta' => 'Iturbide',
      ),
      1 => 
      array (
        'pregunta' => 'Constitución 1824',
        'opciones' => 
        array (
          0 => 'Federal',
          1 => 'Centralista',
          2 => 'Imperial',
          3 => 'Socialista',
        ),
        'correcta' => 'Federal',
      ),
      2 => 
      array (
        'pregunta' => 'Guerra EE.UU.',
        'opciones' => 
        array (
          0 => '1846-1848',
          1 => '1862-1867',
          2 => '1910-1920',
          3 => '1810-1821',
        ),
        'correcta' => '1846-1848',
      ),
      3 => 
      array (
        'pregunta' => 'Pérdida territorial',
        'opciones' => 
        array (
          0 => '55%',
          1 => '10%',
          2 => '80%',
          3 => '0%',
        ),
        'correcta' => '55%',
      ),
      4 => 
      array (
        'pregunta' => 'Leyes de Reforma',
        'opciones' => 
        array (
          0 => '1857-1860',
          1 => '1824',
          2 => '1917',
          3 => '1521',
        ),
        'correcta' => '1857-1860',
      ),
      5 => 
      array (
        'pregunta' => '5 de Mayo',
        'opciones' => 
        array (
          0 => '1862',
          1 => '1867',
          2 => '1847',
          3 => '1910',
        ),
        'correcta' => '1862',
      ),
      6 => 
      array (
        'pregunta' => 'Emperador ejecutado',
        'opciones' => 
        array (
          0 => 'Maximiliano',
          1 => 'Iturbide',
          2 => 'Díaz',
          3 => 'Juárez',
        ),
        'correcta' => 'Maximiliano',
      ),
      7 => 
      array (
        'pregunta' => 'Porfiriato inició',
        'opciones' => 
        array (
          0 => '1876',
          1 => '1821',
          2 => '1857',
          3 => '1910',
        ),
        'correcta' => '1876',
      ),
      8 => 
      array (
        'pregunta' => 'Lema Díaz',
        'opciones' => 
        array (
          0 => 'Orden y Progreso',
          1 => 'Tierra y Libertad',
          2 => 'Sufragio efectivo',
          3 => 'Paz',
        ),
        'correcta' => 'Orden y Progreso',
      ),
      9 => 
      array (
        'pregunta' => 'SI 2025: años Independencia',
        'opciones' => 
        array (
          0 => '204',
          1 => '200',
          2 => '215',
          3 => '300',
        ),
        'correcta' => '204',
      ),
      10 => 
      array (
        'pregunta' => 'Santa Anna presidente',
        'opciones' => 
        array (
          0 => '11 veces',
          1 => '1',
          2 => '2',
          3 => '7',
        ),
        'correcta' => '11 veces',
      ),
      11 => 
      array (
        'pregunta' => 'Constitución 1857',
        'opciones' => 
        array (
          0 => 'Liberal',
          1 => 'Conservadora',
          2 => 'Imperial',
          3 => 'Social',
        ),
        'correcta' => 'Liberal',
      ),
      12 => 
      array (
        'pregunta' => 'Juárez indígena',
        'opciones' => 
        array (
          0 => 'Zapoteco',
          1 => 'Maya',
          2 => 'Azteca',
          3 => 'Español',
        ),
        'correcta' => 'Zapoteco',
      ),
      13 => 
      array (
        'pregunta' => 'Ferrocarriles Porfiriato',
        'opciones' => 
        array (
          0 => '24,000 km',
          1 => '1,000',
          2 => '100,000',
          3 => '0',
        ),
        'correcta' => '24,000 km',
      ),
      14 => 
      array (
        'pregunta' => 'Hacienda en Porfiriato',
        'opciones' => 
        array (
          0 => 'Latifundio',
          1 => 'Ejido',
          2 => 'Comunidad',
          3 => 'Fábrica',
        ),
        'correcta' => 'Latifundio',
      ),
      15 => 
      array (
        'pregunta' => 'Inversión extranjera',
        'opciones' => 
        array (
          0 => 'EE.UU., Inglaterra',
          1 => 'Solo México',
          2 => 'Francia',
          3 => 'España',
        ),
        'correcta' => 'EE.UU., Inglaterra',
      ),
      16 => 
      array (
        'pregunta' => 'Batalla de Puebla',
        'opciones' => 
        array (
          0 => 'Victoria mexicana',
          1 => 'Derrota',
          2 => 'Empate',
          3 => 'No ocurrió',
        ),
        'correcta' => 'Victoria mexicana',
      ),
      17 => 
      array (
        'pregunta' => 'Tratado McLane-Ocampo',
        'opciones' => 
        array (
          0 => '1859 (no ratificado)',
          1 => '1848',
          2 => '1821',
          3 => '1917',
        ),
        'correcta' => '1859 (no ratificado)',
      ),
      18 => 
      array (
        'pregunta' => 'República Restaurada',
        'opciones' => 
        array (
          0 => '1867-1876',
          1 => '1824-1835',
          2 => '1911-1917',
          3 => '1857',
        ),
        'correcta' => '1867-1876',
      ),
      19 => 
      array (
        'pregunta' => 'SI 2025: estados en 1824',
        'opciones' => 
        array (
          0 => '19',
          1 => '31',
          2 => '32',
          3 => '24',
        ),
        'correcta' => '19',
      ),
      20 => 
      array (
        'pregunta' => 'Grito de Dolores',
        'opciones' => 
        array (
          0 => '1810',
          1 => '1821',
          2 => '1910',
          3 => '1857',
        ),
        'correcta' => '1810',
      ),
      21 => 
      array (
        'pregunta' => 'Plan de Iguala',
        'opciones' => 
        array (
          0 => '1821',
          1 => '1810',
          2 => '1911',
          3 => '1857',
        ),
        'correcta' => '1821',
      ),
      22 => 
      array (
        'pregunta' => 'Texas se independizó',
        'opciones' => 
        array (
          0 => '1836',
          1 => '1821',
          2 => '1845',
          3 => '1910',
        ),
        'correcta' => '1836',
      ),
      23 => 
      array (
        'pregunta' => 'Gadsden Purchase',
        'opciones' => 
        array (
          0 => '1853',
          1 => '1848',
          2 => '1821',
          3 => '1917',
        ),
        'correcta' => '1853',
      ),
      24 => 
      array (
        'pregunta' => 'Intervención francesa',
        'opciones' => 
        array (
          0 => '1862-1867',
          1 => '1846-1848',
          2 => '1910-1920',
          3 => '1810-1821',
        ),
        'correcta' => '1862-1867',
      ),
      25 => 
      array (
        'pregunta' => 'Ejecutado en Querétaro',
        'opciones' => 
        array (
          0 => 'Maximiliano',
          1 => 'Iturbide',
          2 => 'Díaz',
          3 => 'Madero',
        ),
        'correcta' => 'Maximiliano',
      ),
      26 => 
      array (
        'pregunta' => 'Porfiriato terminó',
        'opciones' => 
        array (
          0 => '1911',
          1 => '1910',
          2 => '1920',
          3 => '1876',
        ),
        'correcta' => '1911',
      ),
      27 => 
      array (
        'pregunta' => 'Científicos',
        'opciones' => 
        array (
          0 => 'Asesores Díaz',
          1 => 'Revolucionarios',
          2 => 'Indígenas',
          3 => 'Sacerdotes',
        ),
        'correcta' => 'Asesores Díaz',
      ),
      28 => 
      array (
        'pregunta' => 'SI 2025: años Reforma',
        'opciones' => 
        array (
          0 => '168',
          1 => '200',
          2 => '100',
          3 => '50',
        ),
        'correcta' => '168',
      ),
      29 => 
      array (
        'pregunta' => 'México 1910',
        'opciones' => 
        array (
          0 => 'Centenario + Revolución',
          1 => 'Independencia',
          2 => 'Reforma',
          3 => 'Nada',
        ),
        'correcta' => 'Centenario + Revolución',
      ),
    ),
  ),
  5 => 
  array (
    'materia' => 'Historia de México',
    'slug' => 'revolucion-mexicana-cyberpunk',
    'titulo' => 'Revolución Mexicana: Madero, Villa, Zapata y la Constitución de 1917 (1910-1920)',
    'contenido' => '<!-- INICIO LECCIÓN CYBERPUNK -->
<div class="leccion-container leccion-historia-revolucion" data-tema="revolucion-mexicana">
    <!-- CABECERA CYBERPUNK -->
    <header class="leccion-header">
        <h1 class="titulo-leccion neon-glow">
            <span class="icon-tema">⚡</span> REVOLUCIÓN MEXICANA CYBERPUNK
        </h1>
        <div class="subtitulo">
            <strong>10 años de lucha</strong> que transformaron a México: <strong>1.5M de muertos</strong>, <strong>20M de hectáreas repartidas</strong> y una <strong>Constitución social</strong>
        </div>
    </header>

    <!-- PANEL OBJETIVOS -->
    <section class="panel-objetivos">
        <h2 class="seccion-titulo neon-concepto">
            <span class="icon">🎯</span> OBJETIVOS DE MISIÓN
        </h2>
        <div class="objetivos-grid">
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Identificar facciones y líderes</h3>
                <p>Madero, Villa, Zapata, Carranza y sus proyectos políticos.</p>
            </div>
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Analizar la Constitución de 1917</h3>
                <p>Artículos 3, 27 y 123: educación, tierra y trabajo.</p>
            </div>
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Simular el Plan de Ayala</h3>
                <p>Usar el mapa interactivo de la reforma agraria.</p>
            </div>
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Reflexionar sobre el legado</h3>
                <p>Impacto en la México moderno y el muralismo.</p>
            </div>
        </div>
    </section>

    <!-- CONTEXTO REAL (2025) -->
    <section class="contexto-real">
        <h2 class="seccion-titulo neon-dato">
            <span class="icon">🌍</span> CONTEXTO HISTÓRICO (2025)
        </h2>
        <div class="contexto-grid">
            <div class="contexto-card">
                <h3>📅 115 Años del Inicio</h3>
                <p>En <strong>2025</strong> se conmemoran <strong>115 años</strong> del inicio de la Revolución (20 nov 1910).</p>
                <div class="dato-neon">1.5 millones de muertos (10% de la población)</div>
            </div>
            <div class="contexto-card">
                <h3>🌾 Reforma Agraria</h3>
                <p><strong>20 millones de hectáreas</strong> repartidas entre 1915-1940.</p>
                <div class="dato-neon">90% de la población era rural en 1910</div>
            </div>
            <div class="contexto-card">
                <h3>🎨 Legado Cultural</h3>
                <p>Inspiró al <strong>muralismo</strong> (Rivera, Orozco, Siqueiros) y al cine revolucionario.</p>
                <div class="dato-neon">+100 películas sobre la Revolución</div>
            </div>
        </div>
    </section>

    <!-- SECCIÓN TEÓRICA -->
    <section class="teoria-section">
        <div class="borde-neon-lateral"></div>
        <h2 class="seccion-titulo neon-concepto">
            <span class="icon">📜</span> CRONOLOGÍA REVOLUCIONARIA
        </h2>

        <!-- FACCIONES Y LÍDERES -->
        <div class="subseccion">
            <h3>1. Facciones y Líderes (1910-1920)</h3>
            <div class="facciones-grid">
                <div class="faccion-card maderista">
                    <div class="faccion-header">
                        <div class="faccion-icon">🗳️</div>
                        <h4>MADERISTAS</h4>
                        <div class="faccion-subtitulo">"Sufragio efectivo, no reelección"</div>
                    </div>
                    <div class="faccion-datos">
                        <p><strong>Líder:</strong> Francisco I. Madero.</p>
                        <p><strong>Base:</strong> Clase media, intelectuales.</p>
                        <p><strong>Objetivo:</strong> Democracia, fin al porfiriato.</p>
                        <p><strong>Fin:</strong> Asesinado en 1913 (Decena Trágica).</p>
                    </div>
                    <div class="faccion-dato">📅 1910-1913</div>
                </div>
                <div class="faccion-card villista">
                    <div class="faccion-header">
                        <div class="faccion-icon">🐎</div>
                        <h4>VILLISTAS</h4>
                        <div class="faccion-subtitulo">División del Norte</div>
                    </div>
                    <div class="faccion-datos">
                        <p><strong>Líder:</strong> Francisco Villa.</p>
                        <p><strong>Base:</strong> Campesinos del norte (Chihuahua, Durango).</p>
                        <p><strong>Objetivo:</strong> Justicia social, reparto de tierras.</p>
                        <p><strong>Fin:</strong> Derrotado en 1915, asesinado en 1923.</p>
                    </div>
                    <div class="faccion-dato">🏜️ Norte de México</div>
                </div>
                <div class="faccion-card zapatista">
                    <div class="faccion-header">
                        <div class="faccion-icon">🌾</div>
                        <h4>ZAPATISTAS</h4>
                        <div class="faccion-subtitulo">Ejército Libertador del Sur</div>
                    </div>
                    <div class="faccion-datos">
                        <p><strong>Líder:</strong> Emiliano Zapata.</p>
                        <p><strong>Base:</strong> Campesinos de Morelos.</p>
                        <p><strong>Objetivo:</strong> "Tierra y Libertad" (Plan de Ayala).</p>
                        <p><strong>Fin:</strong> Asesinado en 1919 (traición en Chinameca).</p>
                    </div>
                    <div class="faccion-dato">🌿 Morelos</div>
                </div>
                <div class="faccion-card carrancista">
                    <div class="faccion-header">
                        <div class="faccion-icon">📜</div>
                        <h4>CARRANCISTAS</h4>
                        <div class="faccion-subtitulo">Constitucionalistas</div>
                    </div>
                    <div class="faccion-datos">
                        <p><strong>Líder:</strong> Venustiano Carranza.</p>
                        <p><strong>Base:</strong> Burguesía, clase media, intelectuales.</p>
                        <p><strong>Objetivo:</strong> Orden constitucional, modernización.</p>
                        <p><strong>Fin:</strong> Promulgó Constitución de 1917, asesinado en 1920.</p>
                    </div>
                    <div class="faccion-dato">🏛️ Gobierno constitucional</div>
                </div>
            </div>
        </div>

        <!-- LINEA DEL TIEMPO INTERACTIVA -->
        <div class="subseccion">
            <h3>2. Línea del Tiempo (1910-1920)</h3>
            <div class="timeline-revolucion">
                <div class="timeline-item" data-ano="1910">
                    <div class="timeline-marker"></div>
                    <div class="timeline-content">
                        <h4>🔥 20 Nov 1910: Inicio de la Revolución</h4>
                        <p>Madero lanza el <strong>Plan de San Luis</strong> contra Porfirio Díaz.</p>
                        <div class="timeline-dato">📜 "Sufragio efectivo, no reelección"</div>
                    </div>
                </div>
                <div class="timeline-item" data-ano="1911">
                    <div class="timeline-marker"></div>
                    <div class="timeline-content">
                        <h4>🏛️ May 1911: Caída de Díaz</h4>
                        <p>Porfirio Díaz renuncia y huye a Francia. <strong>Madero asume la presidencia</strong>.</p>
                        <div class="timeline-dato">🎖️ Triunfo maderista</div>
                    </div>
                </div>
                <div class="timeline-item" data-ano="1913">
                    <div class="timeline-marker"></div>
                    <div class="timeline-content">
                        <h4>☠️ Feb 1913: Decena Trágica</h4>
                        <p>Madero es <strong>asesinado</strong> por Victoriano Huerta. Inicia la lucha armada.</p>
                        <div class="timeline-dato">💀 Fin del maderismo</div>
                    </div>
                </div>
                <div class="timeline-item" data-ano="1914">
                    <div class="timeline-marker"></div>
                    <div class="timeline-content">
                        <h4>🤝 1914: Alianza Villa-Zapata</h4>
                        <p>Villa y Zapata toman la <strong>Ciudad de México</strong>. Huerta huye.</p>
                        <div class="timeline-dato">🏆 Victoria temporal</div>
                    </div>
                </div>
                <div class="timeline-item" data-ano="1915">
                    <div class="timeline-marker"></div>
                    <div class="timeline-content">
                        <h4>💥 1915: Batalla de Celaya</h4>
                        <p>Carranza derrota a Villa con apoyo de <strong>Álvaro Obregón</strong>.</p>
                        <div class="timeline-dato">🎯 Fin del villismo</div>
                    </div>
                </div>
                <div class="timeline-item" data-ano="1917">
                    <div class="timeline-marker"></div>
                    <div class="timeline-content">
                        <h4>📜 5 Feb 1917: Constitución</h4>
                        <p>Se promulga la <strong>Constitución de 1917</strong> en Querétaro.</p>
                        <div class="timeline-dato">🏛️ Art. 3, 27, 123</div>
                    </div>
                </div>
                <div class="timeline-item" data-ano="1919">
                    <div class="timeline-marker"></div>
                    <div class="timeline-content">
                        <h4>☠️ 10 Abr 1919: Muerte de Zapata</h4>
                        <p>Emiliano Zapata es <strong>asesinado</strong> en Chinameca por Carranza.</p>
                        <div class="timeline-dato">🌾 Fin del zapatismo</div>
                    </div>
                </div>
                <div class="timeline-item" data-ano="1920">
                    <div class="timeline-marker"></div>
                    <div class="timeline-content">
                        <h4>🏁 1920: Fin de la Revolución</h4>
                        <p>Carranza es derrotado y asesinado. <strong>Álvaro Obregón</strong> asume la presidencia.</p>
                        <div class="timeline-dato">🎖️ Inicio de la reconstrucción</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- CONSTITUCIÓN DE 1917 -->
        <div class="subseccion">
            <h3>3. Constitución de 1917: Logros Sociales</h3>
            <div class="constitucion-grid">
                <div class="articulo-card art3">
                    <div class="articulo-header">
                        <div class="articulo-icon">🎓</div>
                        <h4>Artículo 3</h4>
                    </div>
                    <div class="articulo-content">
                        <p><strong>Educación:</strong> Laica, gratuita y obligatoria.</p>
                        <p><strong>Objetivo:</strong> Combatir el analfabetismo (70% en 1910).</p>
                        <p><strong>Impacto:</strong> Base del sistema educativo actual.</p>
                    </div>
                    <div class="articulo-dato">📚 70% → 30% analfabetismo (1940)</div>
                </div>
                <div class="articulo-card art27">
                    <div class="articulo-header">
                        <div class="articulo-icon">🌾</div>
                        <h4>Artículo 27</h4>
                    </div>
                    <div class="articulo-content">
                        <p><strong>Tierra:</strong> Nación dueña del subsuelo, creación de <strong>ejidos</strong>.</p>
                        <p><strong>Objetivo:</strong> Acabar con los latifundios (1% poseía 97% de la tierra).</p>
                        <p><strong>Impacto:</strong> 20M de hectáreas repartidas.</p>
                    </div>
                    <div class="articulo-dato">🌍 97% → 40% latifundios (1940)</div>
                </div>
                <div class="articulo-card art123">
                    <div class="articulo-header">
                        <div class="articulo-icon">⚒️</div>
                        <h4>Artículo 123</h4>
                    </div>
                    <div class="articulo-content">
                        <p><strong>Trabajo:</strong> Jornada de 8 horas, derecho a huelga, salario mínimo.</p>
                        <p><strong>Objetivo:</strong> Mejorar condiciones laborales (12-16 horas diarias).</p>
                        <p><strong>Impacto:</strong> Base de los derechos laborales actuales.</p>
                    </div>
                    <div class="articulo-dato">⏰ 16h → 8h jornada laboral</div>
                </div>
            </div>
        </div>

        <!-- PLAN DE AYALA -->
        <div class="subseccion">
            <h3>4. Plan de Ayala (28 Nov 1911)</h3>
            <div class="plan-ayala-container">
                <div class="plan-ayala-texto">
                    <p><strong>Autor:</strong> Emiliano Zapata.</p>
                    <p><strong>Contexto:</strong> Madero no cumplió con el reparto de tierras.</p>
                    <p><strong>Demandas:</strong></p>
                    <ul>
                        <li><strong>Restitución de tierras</strong> a pueblos (despojadas por hacendados).</li>
                        <li><strong>Expropiación</strong> de tierras a enemigos de la Revolución.</li>
                        <li><strong>Muerte a traidores</strong> (incluyendo a Madero).</li>
                    </ul>
                    <p><strong>Legado:</strong> Inspiró el <strong>Artículo 27</strong> constitucional.</p>
                </div>
                <div class="plan-ayala-visual">
                    <svg viewBox="0 0 300 200" xmlns="http://www.w3.org/2000/svg">
                        <rect x="0" y="0" width="300" height="200" fill="#1B5E20"/>
                        <text x="150" y="30" fill="white" font-size="16" text-anchor="middle" font-weight="bold">PLAN DE AYALA</text>
                        <text x="150" y="55" fill="#E8F5E9" font-size="12" text-anchor="middle">28 NOV 1911</text>

                        <!-- Tierra -->
                        <rect x="50" y="80" width="200" height="30" fill="#388E3C" rx="5"/>
                        <text x="150" y="100" fill="white" font-size="12" text-anchor="middle">TIERRA</text>
                        <text x="150" y="120" fill="#E8F5E9" font-size="10" text-anchor="middle">Restitución a pueblos</text>

                        <!-- Expropiación -->
                        <rect x="50" y="130" width="200" height="30" fill="#D32F2F" rx="5"/>
                        <text x="150" y="150" fill="white" font-size="12" text-anchor="middle">EXPROPIACIÓN</text>
                        <text x="150" y="170" fill="#FFCDD2" font-size="10" text-anchor="middle">A hacendados</text>
                    </svg>
                </div>
            </div>
        </div>
    </section>

    <!-- SIMULADOR INTERACTIVO: REPARTO AGRARIO -->
    <section class="simulator-section">
        <h2 class="seccion-titulo neon-interactivo">
            <span class="icon">🎮</span> SIMULADOR: REPARTO AGRARIO (1915-1940)
        </h2>
        <div class="simulator-container" data-tema="reparto-agrario">
            <!-- PANEL DE CONTROLES -->
            <div class="simulator-controls">
                <h3>⚙️ CONTROLES</h3>
                <div class="control-group">
                    <label for="regionSelect">Región:</label>
                    <select id="regionSelect" class="control-input">
                        <option value="morelos">Morelos (Zapata)</option>
                        <option value="chihuahua">Chihuahua (Villa)</option>
                        <option value="nacional">Nacional (Carranza)</option>
                        <option value="ejido">Ejido modelo</option>
                    </select>
                </div>
                <div class="control-group">
                    <label for="anioReparto">Año:</label>
                    <input type="range" id="anioReparto" min="1910" max="1940" value="1917" class="control-slider">
                    <div class="slider-labels">
                        <span>1910</span>
                        <span>1940</span>
                    </div>
                </div>
                <button class="btn-iniciar" onclick="iniciarSimuladorReparto()">
                    <span class="btn-icon">▶️</span> INICIAR SIMULACIÓN
                </button>
                <button class="btn-reiniciar" onclick="reiniciarSimuladorReparto()">
                    <span class="btn-icon">🔄</span> REINICIAR
                </button>
            </div>

            <!-- VISUALIZACIÓN -->
            <div class="simulator-visualization">
                <div class="mapa-reparto-container">
                    <svg id="svgRepartoAgrario" viewBox="0 0 800 500" xmlns="http://www.w3.org/2000/svg">
                        <!-- Fondo -->
                        <rect x="0" y="0" width="800" height="500" fill="#0a0a1a"/>

                        <!-- Título -->
                        <text x="400" y="40" fill="#4CAF50" font-size="24" text-anchor="middle" font-weight="bold">REPARTO AGRARIO (1915-1940)</text>

                        <!-- Leyenda -->
                        <rect x="50" y="450" width="700" height="40" fill="rgba(0,0,0,0.7)" rx="5"/>
                        <text x="400" y="475" fill="#E0E0E0" font-size="14" text-anchor="middle" id="leyendaReparto">Selecciona una región y año</text>

                        <!-- Hacienda (antes) -->
                        <g id="hacienda" class="reparto-elemento">
                            <rect x="100" y="100" width="200" height="150" fill="#D32F2F" rx="10" opacity="0.7"/>
                            <text x="200" y="140" fill="white" font-size="16" text-anchor="middle">HACIENDA</text>
                            <text x="200" y="170" fill="#FFCDD2" font-size="12" text-anchor="middle">1 familia</text>
                            <text x="200" y="200" fill="#FFCDD2" font-size="10" text-anchor="middle">10,000 hectáreas</text>
                        </g>

                        <!-- Pueblo (después) -->
                        <g id="pueblo" class="reparto-elemento" opacity="0">
                            <rect x="300" y="100" width="200" height="150" fill="#388E3C" rx="10" opacity="0.7"/>
                            <text x="400" y="140" fill="white" font-size="16" text-anchor="middle">EJIDO</text>
                            <text x="400" y="170" fill="#E8F5E9" font-size="12" text-anchor="middle">100 familias</text>
                            <text x="400" y="200" fill="#E8F5E9" font-size="10" text-anchor="middle">1,000 hectáreas</text>
                        </g>

                        <!-- Datos -->
                        <g id="datosReparto" class="reparto-elemento" opacity="0">
                            <rect x="550" y="100" width="200" height="200" fill="rgba(0,0,0,0.5)" rx="10"/>
                            <text x="650" y="130" fill="#4CAF50" font-size="16" text-anchor="middle" id="textoRegion">—</text>
                            <text x="650" y="160" fill="#E0E0E0" font-size="14" text-anchor="middle" id="textoAnio">—</text>
                            <text x="650" y="190" fill="#E0E0E0" font-size="12" text-anchor="middle" id="textoHectareas">—</text>
                            <text x="650" y="220" fill="#E0E0E0" font-size="12" text-anchor="middle" id="textoBeneficiarios">—</text>
                            <text x="650" y="250" fill="#FF9800" font-size="14" text-anchor="middle" id="textoImpacto">—</text>
                        </g>

                        <!-- Flecha de transformación -->
                        <path id="flechaReparto" d="M300,175 L350,175" stroke="#4CAF50" stroke-width="4" marker-end="url(#flecha)" opacity="0">
                            <animate attributeName="opacity" values="0;1" dur="1s" begin="indefinite" fill="freeze"/>
                        </path>
                    </svg>
                </div>
            </div>

            <!-- DATOS EN TIEMPO REAL -->
            <div class="simulator-data">
                <h3>📊 DATOS DEL REPARTO</h3>
                <div class="data-card">
                    <div class="data-label">Región:</div>
                    <div class="data-value" id="dataRegion">—</div>
                </div>
                <div class="data-card">
                    <div class="data-label">Año:</div>
                    <div class="data-value" id="dataAnioSim">—</div>
                </div>
                <div class="data-card">
                    <div class="data-label">Hectáreas repartidas:</div>
                    <div class="data-value" id="dataHectareas">—</div>
                </div>
                <div class="data-card highlight">
                    <div class="data-label">Beneficiarios:</div>
                    <div class="data-value" id="dataBeneficiarios">—</div>
                </div>
                <div class="data-card">
                    <div class="data-label">Impacto:</div>
                    <div class="data-value" id="dataImpactoSim">—</div>
                </div>
            </div>
        </div>
    </section>

    <!-- QUIZ INTERACTIVO -->
    <section class="quiz-section">
        <h2 class="seccion-titulo neon-evaluacion">
            <span class="icon">❓</span> QUIZ: ¿CUÁNTO SABES?
        </h2>
        <div class="quiz-container">
            <!-- PREGUNTA 1 -->
            <div class="quiz-question" data-correct="B">
                <div class="quiz-header">
                    <span class="quiz-num">01</span>
                    <h3>¿Qué lema asociamos con Emiliano Zapata?</h3>
                </div>
                <div class="quiz-options">
                    <button class="quiz-option" data-value="A">
                        <span class="option-letter">A</span>
                        "Sufragio efectivo, no reelección"
                    </button>
                    <button class="quiz-option" data-value="B">
                        <span class="option-letter">B</span>
                        "Tierra y Libertad"
                    </button>
                    <button class="quiz-option" data-value="C">
                        <span class="option-letter">C</span>
                        "La tierra es de quien la trabaja"
                    </button>
                    <button class="quiz-option" data-value="D">
                        <span class="option-letter">D</span>
                        "Viva México, hijos de la chingada"
                    </button>
                </div>
                <div class="quiz-feedback" style="display: none;">
                    <div class="feedback-correct">
                        <strong>✅ Correcto:</strong> "Tierra y Libertad" fue el lema zapatista, inspirado en el <strong>Plan de Ayala (1911)</strong>.
                    </div>
                    <div class="feedback-incorrect">
                        ❌ <strong>Incorrecto:</strong> Revisa la sección de "Facciones y Líderes".
                    </div>
                    <div class="feedback-explicacion">
                        <p><strong>Contexto:</strong> Zapata exigía la <strong>restitución de tierras</strong> a los pueblos, despojadas durante el porfiriato. Su lema reflejaba la demanda campesina por <strong>justicia agraria</strong>.</p>
                    </div>
                </div>
            </div>

            <!-- PREGUNTA 2 -->
            <div class="quiz-question" data-correct="C">
                <div class="quiz-header">
                    <span class="quiz-num">02</span>
                    <h3>¿Qué estableció el Artículo 27 de la Constitución de 1917?</h3>
                </div>
                <div class="quiz-options">
                    <button class="quiz-option" data-value="A">
                        <span class="option-letter">A</span>
                        Educación laica
                    </button>
                    <button class="quiz-option" data-value="B">
                        <span class="option-letter">B</span>
                        Derecho a huelga
                    </button>
                    <button class="quiz-option" data-value="C">
                        <span class="option-letter">C</span>
                        Propiedad nacional de tierras y subsuelo
                    </button>
                    <button class="quiz-option" data-value="D">
                        <span class="option-letter">D</span>
                        Jornada laboral de 12 horas
                    </button>
                </div>
                <div class="quiz-feedback" style="display: none;">
                    <div class="feedback-correct">
                        <strong>✅ Correcto:</strong> El <strong>Artículo 27</strong> declaró que la tierra y el subsuelo son propiedad de la nación, permitiendo la <strong>expropiación</strong> para reparto agrario.
                    </div>
                    <div class="feedback-incorrect">
                        ❌ <strong>Incorrecto:</strong> Revisa la sección "Constitución de 1917".
                    </div>
                    <div class="feedback-explicacion">
                        <p><strong>Impacto:</strong> Este artículo fue la base legal para el <strong>reparto de 20 millones de hectáreas</strong> a campesinos (1915-1940).</p>
                    </div>
                </div>
            </div>

            <!-- PREGUNTA 3 -->
            <div class="quiz-question" data-correct="A">
                <div class="quiz-header">
                    <span class="quiz-num">03</span>
                    <h3>¿Qué evento marcó el fin de la Revolución?</h3>
                </div>
                <div class="quiz-options">
                    <button class="quiz-option" data-value="A">
                        <span class="option-letter">A</span>
                        Asesinato de Carranza (1920)
                    </button>
                    <button class="quiz-option" data-value="B">
                        <span class="option-letter">B</span>
                        Muerte de Zapata (1919)
                    </button>
                    <button class="quiz-option" data-value="C">
                        <span class="option-letter">C</span>
                        Promulgación de la Constitución (1917)
                    </button>
                    <button class="quiz-option" data-value="D">
                        <span class="option-letter">D</span>
                        Toma de la CDMX por Villa y Zapata (1914)
                    </button>
                </div>
                <div class="quiz-feedback" style="display: none;">
                    <div class="feedback-correct">
                        <strong>✅ Correcto:</strong> El asesinato de <strong>Carranza en 1920</strong> marcó el fin de la etapa armada y el inicio de la <strong>reconstrucción nacional</strong> con Obregón.
                    </div>
                    <div class="feedback-incorrect">
                        ❌ <strong>Incorrecto:</strong> Consulta la línea del tiempo en la sección teórica.
                    </div>
                </div>
            </div>

            <!-- RESULTADOS -->
            <div class="quiz-results" style="display: none;">
                <h3>📊 RESULTADOS</h3>
                <div class="results-score">
                    Puntuación: <span id="quizScore">0</span>/3
                </div>
                <div class="results-feedback" id="quizFeedback">
                    Completa el quiz para ver tu desempeño.
                </div>
                <button class="btn-retry" onclick="reiniciarQuiz()">
                    🔄 VOLVER A INTENTAR
                </button>
            </div>
        </div>
    </section>

    <!-- ERRORES COMUNES -->
    <section class="errores-section">
        <h2 class="seccion-titulo neon-alerta">
            <span class="icon">⚠️</span> MITOS Y REALIDADES
        </h2>
        <div class="errores-container">
            <div class="error-card">
                <div class="error-header" onclick="toggleError(this)">
                    <h3>❌ "La Revolución fue solo contra Porfirio Díaz"</h3>
                    <span class="error-toggle">+</span>
                </div>
                <div class="error-content">
                    <div class="error-ejemplo">
                        <strong>Mito:</strong> "Todo terminó cuando Díaz renunció en 1911".
                    </div>
                    <div class="error-correccion">
                        <strong>Realidad:</strong> La Revolución <strong>continuó hasta 1920</strong> porque:
                        <ul>
                            <li><strong>Madero no cumplió</strong> con el reparto de tierras.</li>
                            <li><strong>Huerta traicionó</strong> a Madero (1913).</li>
                            <li>Los <strong>campesinos</strong> seguían sin tierra.</li>
                            <li>Los <strong>obreros</strong> exigían derechos laborales.</li>
                        </ul>
                    </div>
                    <div class="error-grafica">
                        <div class="grafica-barras">
                            <div class="barra etapa1" style="width: 10%;">1910-1911</div>
                            <div class="barra etapa2" style="width: 90%;">1913-1920</div>
                        </div>
                        <div class="grafica-leyenda">
                            <span class="leyenda-etapa1">🟩 Contra Díaz</span>
                            <span class="leyenda-etapa2">🟥 Revolución Social</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="error-card">
                <div class="error-header" onclick="toggleError(this)">
                    <h3>❌ "Villa y Zapata eran aliados siempre"</h3>
                    <span class="error-toggle">+</span>
                </div>
                <div class="error-content">
                    <div class="error-ejemplo">
                        <strong>Mito:</strong> "Villa y Zapata lucharon juntos hasta el final".
                    </div>
                    <div class="error-correccion">
                        <strong>Realidad:</strong> Solo fueron aliados <strong>brevemente (1914)</strong>:
                        <ul>
                            <li><strong>1914:</strong> Toman la CDMX juntos.</li>
                            <li><strong>1915:</strong> Carranza los derrota por separado.</li>
                            <li><strong>Zapata:</strong> Seguía luchando en Morelos.</li>
                            <li><strong>Villa:</strong> Se retiró a Chihuahua.</li>
                        </ul>
                    </div>
                    <div class="error-mapa">
                        <svg width="100%" height="150" viewBox="0 0 300 100">
                            <rect x="0" y="0" width="300" height="100" fill="#0a0a1a"/>
                            <!-- Villa -->
                            <circle cx="80" cy="50" r="15" fill="#D32F2F"/>
                            <text x="80" y="90" fill="#FFCDD2" font-size="10" text-anchor="middle">Villa</text>
                            <text x="80" y="30" fill="#FFCDD2" font-size="8" text-anchor="middle">Chihuahua</text>
                            <!-- Zapata -->
                            <circle cx="220" cy="50" r="15" fill="#388E3C"/>
                            <text x="220" y="90" fill="#E8F5E9" font-size="10" text-anchor="middle">Zapata</text>
                            <text x="220" y="30" fill="#E8F5E9" font-size="8" text-anchor="middle">Morelos</text>
                            <!-- CDMX -->
                            <circle cx="150" cy="50" r="10" fill="#FF9800"/>
                            <text x="150" y="90" fill="#FFE0B2" font-size="10" text-anchor="middle">CDMX</text>
                            <text x="150" y="30" fill="#FFE0B2" font-size="8" text-anchor="middle">1914</text>
                            <!-- Líneas -->
                            <path d="M80,50 L140,50" stroke="#D32F2F" stroke-width="2" stroke-dasharray="3,1"/>
                            <path d="M220,50 L160,50" stroke="#388E3C" stroke-width="2" stroke-dasharray="3,1"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="error-card">
                <div class="error-header" onclick="toggleError(this)">
                    <h3>❌ "La Constitución de 1917 se aplicó de inmediato"</h3>
                    <span class="error-toggle">+</span>
                </div>
                <div class="error-content">
                    <div class="error-ejemplo">
                        <strong>Mito:</strong> "Desde 1917, todos los mexicanos tuvieron derechos laborales y tierra".
                    </div>
                    <div class="error-correccion">
                        <strong>Realidad:</strong> La aplicación fue <strong>lenta y desigual</strong>:
                        <ul>
                            <li><strong>Art. 27:</strong> El reparto agrario tomó <strong>25 años</strong> (hasta 1940).</li>
                            <li><strong>Art. 123:</strong> Muchos patrones <strong>ignoraron</strong> las leyes laborales.</li>
                            <li><strong>Ejidos:</strong> Muchos fueron <strong>mal administrados</strong> o revertidos.</li>
                        </ul>
                        <div class="error-dato">⚖️ Solo el 30% de las tierras prometidas se repartieron antes de 1930.</div>
                    </div>
                    <div class="error-grafica">
                        <div class="grafica-barras">
                            <div class="barra aplicado" style="width: 30%;">1917-1930</div>
                            <div class="barra pendiente" style="width: 70%;">1930-1940</div>
                        </div>
                        <div class="grafica-leyenda">
                            <span class="leyenda-aplicado">🟩 Aplicado</span>
                            <span class="leyenda-pendiente">🟥 Pendiente</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- PROBLEMAS TIPO EXAMEN -->
    <section class="examen-section">
        <h2 class="seccion-titulo neon-evaluacion">
            <span class="icon">📝</span> MISIÓN FINAL: ANÁLISIS CRÍTICO
        </h2>
        <div class="examen-container">
            <div class="problema-card">
                <div class="problema-header">
                    <span class="problema-num">P1</span>
                    <h3>Comparación de Proyectos Políticos</h3>
                </div>
                <div class="problema-enunciado">
                    <p>Compara los proyectos políticos de <strong>Zapata</strong> (Plan de Ayala) y <strong>Carranza</strong> (Constitución de 1917) en:</p>
                    <ol>
                        <li><strong>Base social.</strong></li>
                        <li><strong>Demandas principales.</strong></li>
                        <li><strong>Métodos para lograrlo.</strong></li>
                    </ol>
                    <p>Incluye <strong>2 diferencias clave</strong> y explica cuál consideras más justo.</p>
                </div>
                <div class="problema-espacio">
                    <textarea placeholder="Ejemplo: Zapata representaba a los campesinos de Morelos y exigía la restitución inmediata de tierras, mientras que Carranza..." rows="8"></textarea>
                </div>
                <button class="btn-verificar" onclick="verificarProblema(1)">VER SOLUCIÓN</button>
                <div class="problema-solucion" id="solucionP1" style="display: none;">
                    <strong>Solución:</strong>
                    <table class="comparativa-table">
                        <tr>
                            <th></th>
                            <th>Emiliano Zapata (1911)</th>
                            <th>Venustiano Carranza (1917)</th>
                        </tr>
                        <tr>
                            <td><strong>Base social</strong></td>
                            <td>Campesinos pobres de Morelos</td>
                            <td>Burguesía, clase media, intelectuales</td>
                        </tr>
                        <tr>
                            <td><strong>Demandas</strong></td>
                            <td>Restitución <strong>inmediata</strong> de tierras (Plan de Ayala)</td>
                            <td>Reforma agraria <strong>gradual</strong> (Art. 27)</td>
                        </tr>
                        <tr>
                            <td><strong>Métodos</strong></td>
                            <td>Guerra de guerrillas, expropiación directa</td>
                            <td>Leyes, instituciones, ejército constitucionalista</td>
                        </tr>
                    </table>
                    <p><strong>Diferencias clave:</strong></p>
                    <ol>
                        <li><strong>Inmediatez:</strong> Zapata quería tierras <strong>ya</strong>; Carranza propuso un proceso legal.</li>
                        <li><strong>Enfoque:</strong> Zapata era <strong>radical</strong> (expropiación); Carranza, <strong>institucional</strong>.</li>
                    </ol>
                    <p><strong>Justicia:</strong> El proyecto de Zapata era más justo para los campesinos, pero menos viable políticamente. Carranza logró <strong>estabilidad</strong>, pero con menos impacto social.</p>
                </div>
            </div>

            <div class="problema-card">
                <div class="problema-header">
                    <span class="problema-num">P2</span>
                    <h3>Debate: ¿Fue la Revolución un éxito?</h3>
                </div>
                <div class="problema-enunciado">
                    <p>Argumenta si la Revolución Mexicana (1910-1920) cumplió sus objetivos originales, considerando:</p>
                    <ol>
                        <li>El <strong>Plan de Ayala</strong> (1911).</li>
                        <li>La <strong>Constitución de 1917</strong>.</li>
                        <li>El <strong>reparto agrario real</strong> (1915-1940).</li>
                    </ol>
                    <p>Usa <strong>3 evidencias</strong> del simulador o las secciones anteriores y concluye con tu postura.</p>
                </div>
                <div class="problema-espacio">
                    <textarea placeholder="Ejemplo: Aunque la Constitución de 1917 estableció derechos laborales y agrarios, en la práctica..." rows="10"></textarea>
                </div>
                <button class="btn-verificar" onclick="verificarProblema(2)">VER ARGUMENTOS</button>
                <div class="problema-solucion" id="solucionP2" style="display: none;">
                    <strong>Argumentos a favor (éxito parcial):</strong>
                    <ul>
                        <li><strong>Constitución de 1917:</strong> Estableció derechos <strong>laborales</strong> (Art. 123) y <strong>agrarios</strong> (Art. 27).</li>
                        <li><strong>Fin del porfiriato:</strong> Terminó con <strong>30 años de dictadura</strong>.</li>
                        <li><strong>Reforma agraria:</strong> Se repartieron <strong>20M de hectáreas</strong> (aunque lento).</li>
                    </ul>
                    <strong>Argumentos en contra (fracaso parcial):</strong>
                    <ul>
                        <li><strong>Plan de Ayala:</strong> Zapata exigía <strong>restitución inmediata</strong>; solo se logró parcialmente.</li>
                        <li><strong>Desigualdad:</strong> Los <strong>latifundios</strong> persistieron en muchas regiones.</li>
                        <li><strong>Violencia:</strong> <strong>1.5M de muertos</strong> y destrucción económica.</li>
                        <li><strong>Aplicación lenta:</strong> Muchos derechos constitucionales se aplicaron hasta <strong>décadas después</strong>.</li>
                    </ul>
                    <p><strong>Conclusión:</strong> La Revolución fue un <strong>éxito político</strong> (fin de Díaz, Constitución), pero un <strong>fracaso social</strong> a corto plazo (pobreza, desigualdad persistente).</p>
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
                    <td>Comparación de proyectos</td>
                    <td>Analiza 3 aspectos con 2 diferencias clave y juicio crítico.</td>
                    <td>Menciona aspectos sin profundizar o sin juicio.</td>
                    <td>Omite diferencias o aspectos clave.</td>
                </tr>
                <tr>
                    <td>Uso de evidencias</td>
                    <td>Argumenta con 3+ evidencias históricas (simulador, líneas del tiempo).</td>
                    <td>Usa 1-2 evidencias sin contexto claro.</td>
                    <td>No usa evidencias o las usa incorrectamente.</td>
                </tr>
                <tr>
                    <td>Reflexión crítica</td>
                    <td>Evalúa éxito/fracaso con perspectivas múltiples (social, política, económica).</td>
                    <td>Analiza solo una perspectiva sin profundizar.</td>
                    <td>Repite información sin análisis crítico.</td>
                </tr>
            </table>
        </div>
    </section>

    <!-- CIERRE METACOGNITIVO -->
    <section class="cierre-section">
        <h2 class="seccion-titulo neon-concepto">
            <span class="icon">🧠</span> CIERRE: REFLEXIÓN HISTÓRICA
        </h2>
        <div class="cierre-container">
            <div class="autoevaluacion">
                <h3>📊 AUTOEVALUACIÓN</h3>
                <div class="slider-group">
                    <label>Conozco las facciones y líderes:</label>
                    <input type="range" min="1" max="5" value="3" class="autoeval-slider" id="slider1">
                    <div class="slider-labels">
                        <span>Básico</span><span>Intermedio</span><span>Avanzado</span>
                    </div>
                </div>
                <div class="slider-group">
                    <label>Analizo la Constitución de 1917:</label>
                    <input type="range" min="1" max="5" value="3" class="autoeval-slider" id="slider2">
                    <div class="slider-labels">
                        <span>Básico</span><span>Intermedio</span><span>Avanzado</span>
                    </div>
                </div>
                <div class="slider-group">
                    <label>Uso el simulador de reparto agrario:</label>
                    <input type="range" min="1" max="5" value="3" class="autoeval-slider" id="slider3">
                    <div class="slider-labels">
                        <span>Básico</span><span>Intermedio</span><span>Avanzado</span>
                    </div>
                </div>
                <button class="btn-guardar" onclick="guardarAutoevaluacion()">
                    💾 GUARDAR PROGRESO
                </button>
            </div>

            <div class="reflexion">
                <h3>💭 REFLEXIÓN FINAL</h3>
                <div class="pregunta-reflexion">
                    <p>Si hubieras sido un <strong>campesino en 1915</strong>, ¿te habrías unido a <strong>Villa</strong>, <strong>Zapata</strong> o <strong>Carranza</strong>? Justifica tu elección con <strong>2 razones</strong> basadas en sus proyectos políticos.</p>
                    <textarea placeholder="Ejemplo: Me uniría a Zapata porque su Plan de Ayala prometía la restitución inmediata de tierras, y como campesino de Morelos..." rows="5" id="reflexion1"></textarea>
                </div>
                <div class="pregunta-reflexion">
                    <p>Investiga sobre <strong>una mujer revolucionaria</strong> (ej. <strong>Carmen Serdán</strong>, <strong>Juana Belén Gutiérrez</strong>) y describe su papel en 3 líneas.</p>
                    <textarea placeholder="Ejemplo: Carmen Serdán fue una de las primeras en tomar las armas en Puebla en 1910. Organizó..." rows="4" id="reflexion2"></textarea>
                </div>
            </div>

            <div class="plan-estudio">
                <h3>📅 PLAN DE ESTUDIO</h3>
                <div class="plan-grid">
                    <div class="plan-card">
                        <h4>🔹 REPASO RÁPIDO (20 min)</h4>
                        <ul>
                            <li>Memorizar líderes, lemas y regiones.</li>
                            <li>Repasar artículos 3, 27 y 123 de la Constitución.</li>
                            <li>Identificar fechas clave (1910, 1917, 1920).</li>
                        </ul>
                    </div>
                    <div class="plan-card">
                        <h4>🔹 ANÁLISIS (40 min)</h4>
                        <ul>
                            <li>Comparar el <strong>Plan de Ayala</strong> y la <strong>Constitución de 1917</strong>.</li>
                            <li>Reflexionar: ¿Por qué Carranza derrotó a Villa y Zapata?</li>
                            <li>Escribir un párrafo sobre el legado de la Revolución.</li>
                        </ul>
                    </div>
                    <div class="plan-card">
                        <h4>🔹 DEBATE (45 min)</h4>
                        <ul>
                            <li>Preparar argumentos: ¿Fue Villa un héroe o un bandido?</li>
                            <li>Investigar sobre el <strong>muralismo</strong> (Rivera, Orozco).</li>
                            <li>Debatir en clase con evidencias históricas.</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="recursos">
                <h3>🌐 RECURSOS EXTERNOS</h3>
                <div class="recursos-links">
                    <a href="https://www.inehrm.gob.mx/" target="_blank" class="recurso-link">
                        📜 Instituto Nacional de Estudios Históricos (INEHRM)
                    </a>
                    <a href="https://www.biblioteca.tv/artman2/publish/1910_1920" target="_blank" class="recurso-link">
                        📚 Biblioteca TV: Revolución Mexicana
                    </a>
                    <a href="https://www.khanacademy.org/humanities/whp-origins" target="_blank" class="recurso-link">
                        🎓 Khan Academy: Revoluciones en América Latina
                    </a>
                    <a href="https://www.youtube.com/watch?v=..." target="_blank" class="recurso-link">
                        🎥 Documental: "La Revolución Mexicana" (History Channel)
                    </a>
                    <a href="https://museomuraldiego.com/" target="_blank" class="recurso-link">
                        🎨 Museo Mural Diego Rivera
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- JAVASCRIPT INTEGRADO -->
<script>
// ===========================================
// BASE DE DATOS DEL SIMULADOR DE REPARTO AGRARIO
// ===========================================
const datosRepartoAgrario = {
    "morelos": {
        region: "Morelos",
        ano: {
            "1915": {
                hectareas: "50,000",
                beneficiarios: "10,000 familias",
                impacto: "Zapata repartió tierras directamente a campesinos. Primeros ejidos en México.",
                color: "#388E3C"
            },
            "1917": {
                hectareas: "100,000",
                beneficiarios: "20,000 familias",
                impacto: "Con la Constitución, se legalizó el reparto, pero con resistencia de hacendados.",
                color: "#4CAF50"
            },
            "1920": {
                hectareas: "150,000",
                beneficiarios: "30,000 familias",
                impacto: "Carranza aceleró el reparto para ganar apoyo, pero con corrupción.",
                color: "#2E7D32"
            },
            "1940": {
                hectareas: "200,000",
                beneficiarios: "40,000 familias",
                impacto: "Cárdenas completó el reparto en Morelos, creando ejidos modelo.",
                color: "#1B5E20"
            }
        }
    },
    "chihuahua": {
        region: "Chihuahua",
        ano: {
            "1915": {
                hectareas: "200,000",
                beneficiarios: "5,000 familias",
                impacto: "Villa expropió haciendas para sus tropas, no siempre para campesinos.",
                color: "#D32F2F"
            },
            "1917": {
                hectareas: "300,000",
                beneficiarios: "10,000 familias",
                impacto: "Carranza revirtió algunos repartos villistas, causando conflictos.",
                color: "#FF5252"
            },
            "1920": {
                hectareas: "500,000",
                beneficiarios: "20,000 familias",
                impacto: "Obregón promovió el reparto para pacificar el norte, pero con límites.",
                color: "#FF8A65"
            },
            "1940": {
                hectareas: "1,000,000",
                beneficiarios: "50,000 familias",
                impacto: "Chihuahua tuvo uno de los mayores repartos, pero con desigualdades.",
                color: "#FFCCBC"
            }
        }
    },
    "nacional": {
        region: "Nacional (Promedio)",
        ano: {
            "1915": {
                hectareas: "500,000",
                beneficiarios: "50,000 familias",
                impacto: "Inicio del reparto, principalmente en zonas de conflicto (Morelos, Chihuahua).",
                color: "#FF9800"
            },
            "1917": {
                hectareas: "2,000,000",
                beneficiarios: "200,000 familias",
                impacto: "La Constitución dio marco legal, pero la aplicación fue lenta.",
                color: "#F57C00"
            },
            "1920": {
                hectareas: "5,000,000",
                beneficiarios: "500,000 familias",
                impacto: "Obregón impulsó el reparto para consolidar su gobierno.",
                color: "#EF6C00"
            },
            "1940": {
                hectareas: "20,000,000",
                beneficiarios: "2,000,000 familias",
                impacto: "Cárdenas completó el reparto masivo, creando el México rural moderno.",
                color: "#E65100"
            }
        }
    },
    "ejido": {
        region: "Ejido Modelo (Ejemplo)",
        ano: {
            "1917": {
                hectareas: "1,000",
                beneficiarios: "100 familias",
                impacto: "Ejido típico: tierras comunales para cultivo, con apoyo gubernamental.",
                color: "#4DB6AC"
            },
            "1920": {
                hectareas: "1,500",
                beneficiarios: "150 familias",
                impacto: "Algunos ejidos recibieron créditos y semillas, pero otros fueron abandonados.",
                color: "#009688"
            },
            "1930": {
                hectareas: "2,000",
                beneficiarios: "200 familias",
                impacto: "La crisis de 1929 afectó a los ejidos, pero Cárdenas los revitalizó.",
                color: "#00897B"
            },
            "1940": {
                hectareas: "2,500",
                beneficiarios: "250 familias",
                impacto: "Ejido consolidado: escuela, clínica y tierras productivas.",
                color: "#00796B"
            }
        }
    }
};

// ===========================================
// SIMULADOR: REPARTO AGRARIO (1915-1940)
// ===========================================
function iniciarSimuladorReparto() {
    const region = document.getElementById(\'regionSelect\').value;
    const ano = document.getElementById(\'anioReparto\').value;
    const datos = datosRepartoAgrario[region].ano[ano];

    // Redondear año a década (para simplificar)
    let anoRedondeado;
    if (ano < 1915) anoRedondeado = "1915";
    else if (ano < 1920) anoRedondeado = "1917";
    else if (ano < 1930) anoRedondeado = "1920";
    else anoRedondeado = "1940";

    const datosMostrar = datosRepartoAgrario[region].ano[anoRedondeado];

    // Actualizar datos en pantalla
    document.getElementById(\'dataRegion\').textContent = datosMostrar.region;
    document.getElementById(\'dataAnioSim\').textContent = anoRedondeado;
    document.getElementById(\'dataHectareas\').textContent = datosMostrar.hectareas + " hectáreas";
    document.getElementById(\'dataBeneficiarios\').textContent = datosMostrar.beneficiarios;
    document.getElementById(\'dataImpactoSim\').textContent = datosMostrar.impacto;

    // Actualizar SVG
    document.getElementById(\'textoRegion\').textContent = datosMostrar.region;
    document.getElementById(\'textoAnio\').textContent = "Año: " + anoRedondeado;
    document.getElementById(\'textoHectareas\').textContent = datosMostrar.hectareas + " ha repartidas";
    document.getElementById(\'textoBeneficiarios\').textContent = datosMostrar.beneficiarios;
    document.getElementById(\'textoImpacto\').textContent = datosMostrar.impacto;
    document.getElementById(\'leyendaReparto\').textContent = `Reparto agrario en ${datosMostrar.region} (${anoRedondeado})`;

    // Animar flecha
    document.getElementById(\'flechaReparto\').beginElement();

    // Resaltar elementos
    document.getElementById(\'hacienda\').setAttribute(\'opacity\', \'0.3\');
    document.getElementById(\'pueblo\').setAttribute(\'opacity\', \'1\');
    document.getElementById(\'datosReparto\').setAttribute(\'opacity\', \'1\');

    // Cambiar colores según región
    document.getElementById(\'pueblo\').querySelector(\'rect\').setAttribute(\'fill\', datosMostrar.color);
    document.getElementById(\'flechaReparto\').setAttribute(\'stroke\', datosMostrar.color);

    console.log(`🌾 Simulación: ${datosMostrar.region} (${anoRedondeado}) - ${datosMostrar.hectareas} ha`);
}

function reiniciarSimuladorReparto() {
    // Reiniciar controles
    document.getElementById(\'regionSelect\').value = "morelos";
    document.getElementById(\'anioReparto\').value = "1917";

    // Reiniciar datos
    document.querySelectorAll(\'.data-value\').forEach(d => {
        d.textContent = "—";
    });

    // Reiniciar SVG
    document.getElementById(\'hacienda\').setAttribute(\'opacity\', \'0.7\');
    document.getElementById(\'pueblo\').setAttribute(\'opacity\', \'0\');
    document.getElementById(\'datosReparto\').setAttribute(\'opacity\', \'0\');
    document.getElementById(\'leyendaReparto\').textContent = "Selecciona una región y año";

    console.log("🔄 Simulador de reparto agrario reiniciado");
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
        feedback = "🌟 ¡Excelente! Dominas los detalles clave de la Revolución Mexicana.";
    } else if (porcentaje >= 50) {
        feedback = "👍 Buen trabajo, pero repasa los artículos de la Constitución y el Plan de Ayala.";
    } else {
        feedback = "📚 Necesitas estudiar más las facciones, líderes y documentos clave.";
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
// ERRORES COMUNES (MITOS)
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
// AUTOEVALUACIÓN
// ===========================================
function guardarAutoevaluacion() {
    const slider1 = document.getElementById(\'slider1\').value;
    const slider2 = document.getElementById(\'slider2\').value;
    const slider3 = document.getElementById(\'slider3\').value;
    const promedio = (parseInt(slider1) + parseInt(slider2) + parseInt(slider3)) / 3;

    alert(`💾 Autoevaluación guardada:\\n\\n` +
          `Facciones/líderes: ${slider1}/5\\n` +
          `Constitución de 1917: ${slider2}/5\\n` +
          `Simulador agrario: ${slider3}/5\\n\\n` +
          `Promedio: ${promedio.toFixed(1)}/5\\n\\n` +
          `📌 Recomendación: Revisa el plan de estudio según tus resultados.`);
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
        checkbox.style.backgroundColor = !completado ? \'#4CAF50\' : \'\';
    });
});

// ===========================================
// INICIALIZACIÓN: AGREGAR FLECHA AL SVG
// ===========================================
const svgReparto = document.getElementById(\'svgRepartoAgrario\');
const defs = document.createElementNS(\'http://www.w3.org/2000/svg\', \'defs\');

const marker = document.createElementNS(\'http://www.w3.org/2000/svg\', \'marker\');
marker.setAttribute(\'id\', \'flecha\');
marker.setAttribute(\'viewBox\', \'0 0 10 10\');
marker.setAttribute(\'refX\', \'9\');
marker.setAttribute(\'refY\', \'5\');
marker.setAttribute(\'markerWidth\', \'6\');
marker.setAttribute(\'markerHeight\', \'6\');
marker.setAttribute(\'orient\', \'auto\');

const path = document.createElementNS(\'http://www.w3.org/2000/svg\', \'path\');
path.setAttribute(\'d\', \'M 0 0 L 10 5 L 0 10 z\');
path.setAttribute(\'fill\', \'#4CAF50\');

marker.appendChild(path);
defs.appendChild(marker);
svgReparto.appendChild(defs);

console.log("🚀 Lección Cyberpunk: Revolución Mexicana - Cargada");
console.log("🎮 Simulador de reparto agrario, Quiz y Herramientas interactivas listas");
</script>',
    'ejercicios' => 
    array (
      0 => 
      array (
        'enunciado' => 'Derrocó a Díaz',
        'respuesta' => 'Madero',
      ),
      1 => 
      array (
        'enunciado' => 'Lema de Zapata',
        'respuesta' => 'Tierra y Libertad',
      ),
      2 => 
      array (
        'enunciado' => 'Constitución promulgada',
        'respuesta' => '5 febrero 1917',
      ),
      3 => 
      array (
        'enunciado' => 'Artículo educación laica',
        'respuesta' => 'Artículo 3',
      ),
      4 => 
      array (
        'enunciado' => 'Plan de Ayala',
        'respuesta' => '1911',
      ),
      5 => 
      array (
        'enunciado' => 'Asesinato Madero',
        'respuesta' => '1913 (Decena Trágica)',
      ),
      6 => 
      array (
        'enunciado' => 'Villa región',
        'respuesta' => 'Norte (Chihuahua)',
      ),
      7 => 
      array (
        'enunciado' => 'Artículo 27',
        'respuesta' => 'Nación dueña subsuelo',
      ),
      8 => 
      array (
        'enunciado' => 'Jornada laboral',
        'respuesta' => '8 horas (Art. 123)',
      ),
      9 => 
      array (
        'enunciado' => 'Convención de Aguascalientes',
        'respuesta' => '1914',
      ),
      10 => 
      array (
        'enunciado' => 'Muertos estimados',
        'respuesta' => '~1.5 millones',
      ),
      11 => 
      array (
        'enunciado' => 'SI: años Constitución',
        'respuesta' => '108',
      ),
    ),
    'quiz' => 
    array (
      0 => 
      array (
        'pregunta' => 'Inicio Revolución',
        'opciones' => 
        array (
          0 => '1910',
          1 => '1821',
          2 => '1857',
          3 => '1920',
        ),
        'correcta' => '1910',
      ),
      1 => 
      array (
        'pregunta' => 'Líder inicial',
        'opciones' => 
        array (
          0 => 'Madero',
          1 => 'Villa',
          2 => 'Zapata',
          3 => 'Carranza',
        ),
        'correcta' => 'Madero',
      ),
      2 => 
      array (
        'pregunta' => 'Lema Zapata',
        'opciones' => 
        array (
          0 => 'Tierra y Libertad',
          1 => 'No reelección',
          2 => 'Orden y Progreso',
          3 => 'Paz',
        ),
        'correcta' => 'Tierra y Libertad',
      ),
      3 => 
      array (
        'pregunta' => 'Constitución',
        'opciones' => 
        array (
          0 => '1917',
          1 => '1824',
          2 => '1857',
          3 => '1910',
        ),
        'correcta' => '1917',
      ),
      4 => 
      array (
        'pregunta' => 'Art. 3',
        'opciones' => 
        array (
          0 => 'Educación laica',
          1 => 'Tierra',
          2 => 'Trabajo',
          3 => 'Subsuelo',
        ),
        'correcta' => 'Educación laica',
      ),
      5 => 
      array (
        'pregunta' => 'Art. 27',
        'opciones' => 
        array (
          0 => 'Nación dueña subsuelo',
          1 => 'Educación',
          2 => 'Trabajo',
          3 => 'Huelga',
        ),
        'correcta' => 'Nación dueña subsuelo',
      ),
      6 => 
      array (
        'pregunta' => 'Art. 123',
        'opciones' => 
        array (
          0 => 'Derechos laborales',
          1 => 'Educación',
          2 => 'Tierra',
          3 => 'Religión',
        ),
        'correcta' => 'Derechos laborales',
      ),
      7 => 
      array (
        'pregunta' => 'Madero asesinado',
        'opciones' => 
        array (
          0 => '1913',
          1 => '1910',
          2 => '1917',
          3 => '1920',
        ),
        'correcta' => '1913',
      ),
      8 => 
      array (
        'pregunta' => 'Zapata asesinado',
        'opciones' => 
        array (
          0 => '1919',
          1 => '1913',
          2 => '1923',
          3 => '1920',
        ),
        'correcta' => '1919',
      ),
      9 => 
      array (
        'pregunta' => 'SI 2025: años Revolución',
        'opciones' => 
        array (
          0 => '115',
          1 => '100',
          2 => '200',
          3 => '50',
        ),
        'correcta' => '115',
      ),
      10 => 
      array (
        'pregunta' => 'Plan de San Luis',
        'opciones' => 
        array (
          0 => 'Madero 1910',
          1 => 'Zapata 1911',
          2 => 'Villa 1913',
          3 => 'Carranza 1913',
        ),
        'correcta' => 'Madero 1910',
      ),
      11 => 
      array (
        'pregunta' => 'Decena Trágica',
        'opciones' => 
        array (
          0 => '1913',
          1 => '1910',
          2 => '1917',
          3 => '1919',
        ),
        'correcta' => '1913',
      ),
      12 => 
      array (
        'pregunta' => 'Huerta presidente',
        'opciones' => 
        array (
          0 => '1913-1914',
          1 => '1911-1913',
          2 => '1917-1920',
          3 => '1920-1924',
        ),
        'correcta' => '1913-1914',
      ),
      13 => 
      array (
        'pregunta' => 'Batalla de Zacatecas',
        'opciones' => 
        array (
          0 => 'Villa 1914',
          1 => 'Zapata 1911',
          2 => 'Madero 1911',
          3 => 'Carranza 1915',
        ),
        'correcta' => 'Villa 1914',
      ),
      14 => 
      array (
        'pregunta' => 'Convención Aguascalientes',
        'opciones' => 
        array (
          0 => '1914',
          1 => '1910',
          2 => '1917',
          3 => '1920',
        ),
        'correcta' => '1914',
      ),
      15 => 
      array (
        'pregunta' => 'Carranza presidente',
        'opciones' => 
        array (
          0 => '1917-1920',
          1 => '1911-1913',
          2 => '1913-1914',
          3 => '1920-1924',
        ),
        'correcta' => '1917-1920',
      ),
      16 => 
      array (
        'pregunta' => 'Obregón presidente',
        'opciones' => 
        array (
          0 => '1920-1924',
          1 => '1917-1920',
          2 => '1913-1914',
          3 => '1911-1913',
        ),
        'correcta' => '1920-1924',
      ),
      17 => 
      array (
        'pregunta' => 'Hectáreas repartidas',
        'opciones' => 
        array (
          0 => '~20M (1915-1940)',
          1 => '1M',
          2 => '100M',
          3 => '0',
        ),
        'correcta' => '~20M (1915-1940)',
      ),
      18 => 
      array (
        'pregunta' => 'Muralismo',
        'opciones' => 
        array (
          0 => 'Rivera, Orozco',
          1 => 'Picasso',
          2 => 'Dalí',
          3 => 'Van Gogh',
        ),
        'correcta' => 'Rivera, Orozco',
      ),
      19 => 
      array (
        'pregunta' => 'SI 2025: ejidos activos',
        'opciones' => 
        array (
          0 => '~30,000',
          1 => '100',
          2 => '1M',
          3 => '0',
        ),
        'correcta' => '~30,000',
      ),
      20 => 
      array (
        'pregunta' => 'Tierra y Libertad',
        'opciones' => 
        array (
          0 => 'Plan de Ayala',
          1 => 'Plan de San Luis',
          2 => 'Plan de Guadalupe',
          3 => 'Constitución',
        ),
        'correcta' => 'Plan de Ayala',
      ),
      21 => 
      array (
        'pregunta' => 'División del Norte',
        'opciones' => 
        array (
          0 => 'Villa',
          1 => 'Zapata',
          2 => 'Madero',
          3 => 'Carranza',
        ),
        'correcta' => 'Villa',
      ),
      22 => 
      array (
        'pregunta' => 'Ejército Libertador Sur',
        'opciones' => 
        array (
          0 => 'Zapata',
          1 => 'Villa',
          2 => 'Madero',
          3 => 'Obregón',
        ),
        'correcta' => 'Zapata',
      ),
      23 => 
      array (
        'pregunta' => 'Constituyente en',
        'opciones' => 
        array (
          0 => 'Querétaro',
          1 => 'CDMX',
          2 => 'Guadalajara',
          3 => 'Monterrey',
        ),
        'correcta' => 'Querétaro',
      ),
      24 => 
      array (
        'pregunta' => '5 de febrero',
        'opciones' => 
        array (
          0 => '1917',
          1 => '1910',
          2 => '1920',
          3 => '1810',
        ),
        'correcta' => '1917',
      ),
      25 => 
      array (
        'pregunta' => 'Cristeros',
        'opciones' => 
        array (
          0 => '1926-1929',
          1 => '1910-1920',
          2 => '1857',
          3 => '1867',
        ),
        'correcta' => '1926-1929',
      ),
      26 => 
      array (
        'pregunta' => 'Calles presidente',
        'opciones' => 
        array (
          0 => '1924-1928',
          1 => '1920-1924',
          2 => '1917-1920',
          3 => '1913-1914',
        ),
        'correcta' => '1924-1928',
      ),
      27 => 
      array (
        'pregunta' => 'PNR fundado',
        'opciones' => 
        array (
          0 => '1929',
          1 => '1917',
          2 => '1910',
          3 => '1946',
        ),
        'correcta' => '1929',
      ),
      28 => 
      array (
        'pregunta' => 'SI 2025: años Constitución',
        'opciones' => 
        array (
          0 => '108',
          1 => '100',
          2 => '115',
          3 => '200',
        ),
        'correcta' => '108',
      ),
      29 => 
      array (
        'pregunta' => 'Revolución fue',
        'opciones' => 
        array (
          0 => 'Social y agraria',
          1 => 'Solo política',
          2 => 'Industrial',
          3 => 'Religiosa',
        ),
        'correcta' => 'Social y agraria',
      ),
    ),
  ),
  6 => 
  array (
    'materia' => 'Historia de México',
    'slug' => 'mexico-contemporaneo',
    'titulo' => 'México Contemporáneo: Revolución Institucionalizada, Milagro y Transición (1934-2000)',
    'contenido' => '<!-- INICIO LECCIÓN CYBERPUNK -->
<div class="leccion-container leccion-historia-contemporaneo" data-tema="mexico-contemporaneo">
    
    <!-- CABECERA CYBERPUNK -->
    <header class="leccion-header">
        <h1 class="titulo-leccion neon-glow">
            <span class="icon-tema">🚀</span>
            MÉXICO CONTEMPORÁNEO
        </h1>
        <div class="subtitulo">
            Del Cardenismo Revolucionario a la Alternancia Democrática (1934-2000)
        </div>
        <div class="badge-tiempo">
            <span class="badge">1934-2000</span>
            <span class="badge">66 años</span>
            <span class="badge">4 etapas clave</span>
            <span class="badge">Revolución → Democracia</span>
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
                <h3>Analizar el proyecto cardenista</h3>
                <p>Evaluar reforma agraria, expropiación petrolera y nacionalismo revolucionario</p>
            </div>
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Examinar el Milagro Mexicano</h3>
                <p>Comprender crecimiento económico, desarrollo estabilizador y sus límites</p>
            </div>
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Evaluar 1968 como punto de quiebre</h3>
                <p>Analizar movimiento estudiantil, represión y apertura política gradual</p>
            </div>
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Comprender transición democrática</h3>
                <p>Examinar reformas electorales y alternancia del 2000</p>
            </div>
        </div>
    </section>

    <!-- CONTEXTO REAL -->
    <section class="contexto-real">
        <h2 class="seccion-titulo neon-dato">
            <span class="icon">🌍</span> HUELLAS EN EL MÉXICO ACTUAL
        </h2>
        <div class="contexto-grid">
            <div class="contexto-card">
                <h3>🛢️ PEMEX 87 Años Después</h3>
                <p>La expropiación petrolera sigue definiendo política energética y soberanía</p>
                <div class="dato-neon">Producción 2024: 1.6M barriles/día</div>
            </div>
            <div class="contexto-card">
                <h3>🗳️ Sistema Electoral Actual</h3>
                <p>INE hereda 40 años de reformas electorales desde 1977</p>
                <div class="dato-neon">Elecciones más competidas desde 2000</div>
            </div>
            <div class="contexto-card">
                <h3>🏙️ Urbanización Acelerada</h3>
                <p>El Milagro Mexicano urbanizó el país: 35% urbano 1940 → 80% 2000</p>
                <div class="dato-neon">ZMG: 5M habitantes (2025)</div>
            </div>
        </div>
    </section>

    <!-- SECCIÓN TEÓRICA -->
    <section class="teoria-section">
        <div class="borde-neon-lateral"></div>
        <h2 class="seccion-titulo neon-concepto">
            <span class="icon">📚</span> LAS CUATRO COLUMNAS DEL MÉXICO MODERNO
        </h2>
        
        <!-- INTRODUCCIÓN -->
        <div class="subseccion">
            <h3>1. Del Caudillismo a las Instituciones (1934-2000)</h3>
            <div class="definicion-principal">
                <div class="def-card">
                    <h4>🏛️ REVOLUCIÓN INSTITUCIONALIZADA</h4>
                    <p>Periodo de consolidación del Estado posrevolucionario, crecimiento económico acelerado y lenta transición democrática</p>
                    <div class="caracteristicas-grid">
                        <div class="caracteristica">
                            <span class="caracteristica-icon">🛢️</span>
                            <span class="caracteristica-texto">Nacionalismo económico</span>
                        </div>
                        <div class="caracteristica">
                            <span class="caracteristica-icon">📈</span>
                            <span class="caracteristica-texto">6% crecimiento anual (1940-70)</span>
                        </div>
                        <div class="caracteristica">
                            <span class="caracteristica-icon">🎓</span>
                            <span class="caracteristica-texto">Movimiento estudiantil 1968</span>
                        </div>
                        <div class="caracteristica">
                            <span class="caracteristica-icon">🗳️</span>
                            <span class="caracteristica-texto">Alternancia democrática 2000</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- TIMELINE INTERACTIVA -->
        <div class="subseccion">
            <h3>2. Línea de Tiempo Interactiva 1934-2000</h3>
            <div class="timeline-interactiva">
                <div class="timeline-controls">
                    <button class="timeline-btn" data-etapa="cardenismo">CARDENISMO</button>
                    <button class="timeline-btn" data-etapa="milagro">MILAGRO</button>
                    <button class="timeline-btn" data-etapa="desarrollo">DESARROLLO</button>
                    <button class="timeline-btn" data-etapa="crisis">CRISIS</button>
                    <button class="timeline-btn" data-etapa="transicion">TRANSICIÓN</button>
                    <button class="timeline-btn" data-etapa="alternancia">ALTERNANCIA</button>
                </div>
                
                <div class="timeline-visual">
                    <div class="timeline-bar">
                        <div class="timeline-marker" data-year="1934" style="left: 0%;">1934</div>
                        <div class="timeline-marker" data-year="1940" style="left: 9%;">1940</div>
                        <div class="timeline-marker" data-year="1954" style="left: 30%;">1954</div>
                        <div class="timeline-marker" data-year="1968" style="left: 51%;">1968</div>
                        <div class="timeline-marker" data-year="1982" style="left: 72%;">1982</div>
                        <div class="timeline-btn" data-year="1988" style="left: 81%;">1988</div>
                        <div class="timeline-marker" data-year="2000" style="left: 100%;">2000</div>
                        
                        <!-- Etapas -->
                        <div class="etapa-bar cardenismo" style="left: 0%; width: 9%;" data-etapa="cardenismo"></div>
                        <div class="etapa-bar milagro" style="left: 9%; width: 21%;" data-etapa="milagro"></div>
                        <div class="etapa-bar desarrollo" style="left: 30%; width: 21%;" data-etapa="desarrollo"></div>
                        <div class="etapa-bar crisis" style="left: 51%; width: 21%;" data-etapa="crisis"></div>
                        <div class="etapa-bar transicion" style="left: 72%; width: 9%;" data-etapa="transicion"></div>
                        <div class="etapa-bar alternancia" style="left: 81%; width: 19%;" data-etapa="alternancia"></div>
                    </div>
                </div>
                
                <div class="timeline-info" id="timelineInfo">
                    Haz clic en una etapa para explorar sus características
                </div>
            </div>
        </div>

        <!-- ETAPAS DETALLADAS -->
        <div class="subseccion">
            <h3>3. Análisis por Periodo Histórico</h3>
            
            <!-- CARDENISMO -->
            <div class="etapa-detalle" id="detalleCardenismo" style="display: none;">
                <div class="etapa-header">
                    <h4>⚒️ CARDENISMO (1934-1940)</h4>
                    <div class="etapa-badge">Revolución social</div>
                </div>
                <div class="etapa-content">
                    <div class="etapa-columna">
                        <h5>🌾 Reforma Agraria Radical</h5>
                        <p>18 millones hectáreas repartidas, ejidos, Confederación Nacional Campesina</p>
                        <div class="dato">Culminación del reparto revolucionario</div>
                    </div>
                    <div class="etapa-columna">
                        <h5>🛢️ Expropiación Petrolera 1938</h5>
                        <p>17 empresas extranjeras nacionalizadas, creación de PEMEX, soberanía energética</p>
                        <div class="dato">Apoyo popular masivo: "El petróleo es nuestro"</div>
                    </div>
                    <div class="etapa-columna">
                        <h5>🏛️ Institucionalización</h5>
                        <p>CTM, PRI como partido oficial, educación socialista, nacionalismo cultural</p>
                        <div class="dato">Revolución convertida en sistema político</div>
                    </div>
                </div>
            </div>
            
            <!-- MILAGRO MEXICANO -->
            <div class="etapa-detalle" id="detalleMilagro" style="display: none;">
                <div class="etapa-header">
                    <h4>📈 MILAGRO MEXICANO (1940-1970)</h4>
                    <div class="etapa-badge">30 años de crecimiento</div>
                </div>
                <div class="etapa-content">
                    <div class="etapa-columna">
                        <h5>🏭 Industrialización por Sustitución</h5>
                        <p>Proteccionismo, desarrollo manufacturero, empresa paraestatal</p>
                        <div class="dato">Crecimiento promedio 6% anual</div>
                    </div>
                    <div class="etapa-columna">
                        <h5>🏙️ Urbanización Masiva</h5>
                        <p>Población urbana: 35% → 65%, migración campo-ciudad, ciudades nuevas</p>
                        <div class="dato">CDMX: 1.5M (1940) → 8.8M (1970)</div>
                    </div>
                    <div class="etapa-columna">
                        <h5>👨‍👩‍👧‍👦 Cambio Demográfico</h5>
                        <p>Población: 20M → 50M, tasa natalidad 45‰, clase media emergente</p>
                        <div class="dato">"Desarrollo estabilizador": estabilidad macroeconómica</div>
                    </div>
                </div>
            </div>
            
            <!-- 1968 -->
            <div class="etapa-detalle" id="detalleCrisis" style="display: none;">
                <div class="etapa-header">
                    <h4>🎓 1968: PUNTO DE QUIEBRE</h4>
                    <div class="etapa-badge">Fin de la inocencia</div>
                </div>
                <div class="etapa-content">
                    <div class="etapa-columna">
                        <h5>📢 Movimiento Estudiantil</h5>
                        <p>Demandas: libertad políticos, diálogo público, fin represión</p>
                        <div class="dato">CNH: Consejo Nacional de Huelga</div>
                    </div>
                    <div class="etapa-columna">
                        <h5>💥 Matanza de Tlatelolco</h5>
                        <p>2 octubre 1968, Plaza de las Tres Culturas, 300-500 muertos estimados</p>
                        <div class="dato">Batallón Olimpia, Ejército, Grupo paramilitar</div>
                    </div>
                    <div class="etapa-columna">
                        <h5>🔓 Apertura Gradual</h5>
                        <p>Reformas políticas 1977, partidos de oposición, fin presidencialismo absoluto</p>
                        <div class="dato">Inicio de transición democrática de 30 años</div>
                    </div>
                </div>
            </div>
            
            <!-- ALTERNANCIA 2000 -->
            <div class="etapa-detalle" id="detalleAlternancia" style="display: none;">
                <div class="etapa-header">
                    <h4>🗳️ ALTERNANCIA DEMOCRÁTICA 2000</h4>
                    <div class="etapa-badge">Fin de la hegemonía PRI</div>
                </div>
                <div class="etapa-content">
                    <div class="etapa-columna">
                        <h5>📊 Reformas Electorales</h5>
                        <p>IFE 1990, Tribunal Electoral, credencial con foto, equidad en medios</p>
                        <div class="dato">Confianza en proceso electoral</div>
                    </div>
                    <div class="etapa-columna">
                        <h5>🏆 Victoria de Vicente Fox</h5>
                        <p>PAN gana con 42.5% votos, PRI 36.1%, PRD 16.6%</p>
                        <div class="dato">"Ya cambió México" - lema de campaña</div>
                    </div>
                    <div class="etapa-columna">
                        <h5>⚖️ Nuevo Sistema Político</h5>
                        <p>Gobierno dividido, congreso plural, contrapesos reales, medios críticos</p>
                        <div class="dato">Fin del presidencialismo imperial</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- DATOS ESTADÍSTICOS COMPARATIVOS -->
        <div class="subseccion">
            <h3>4. México en Cifras: Transformación Acelerada</h3>
            <div class="estadisticas-grid">
                <div class="estadistica-card">
                    <div class="estadistica-valor">20M → 100M</div>
                    <div class="estadistica-label">Población</div>
                    <div class="estadistica-desc">1934-2000 (x5 crecimiento)</div>
                </div>
                
                <div class="estadistica-card">
                    <div class="estadistica-valor">35% → 80%</div>
                    <div class="estadistica-label">Urbanización</div>
                    <div class="estadistica-desc">Población en ciudades</div>
                </div>
                
                <div class="estadistica-card">
                    <div class="estadistica-valor">6%</div>
                    <div class="estadistica-label">Crecimiento anual</div>
                    <div class="estadistica-desc">Promedio 1940-1970</div>
                </div>
                
                <div class="estadistica-card">
                    <div class="estadistica-valor">18M</div>
                    <div class="estadistica-label">Hectáreas repartidas</div>
                    <div class="estadistica-desc">Reforma agraria cardenista</div>
                </div>
                
                <div class="estadistica-card">
                    <div class="estadistica-valor">71 años</div>
                    <div class="estadistica-label">Hegemonía PRI</div>
                    <div class="estadistica-desc">1929-2000</div>
                </div>
                
                <div class="estadistica-card">
                    <div class="estadistica-valor">42.5%</div>
                    <div class="estadistica-label">Votos Fox 2000</div>
                    <div class="estadistica-desc">Primer presidente no PRI</div>
                </div>
            </div>
        </div>

        <!-- MODELOS ECONÓMICOS -->
        <div class="subseccion">
            <h3>5. Evolución del Modelo Económico</h3>
            <div class="modelos-grid">
                <div class="modelo-card">
                    <div class="modelo-icon">🌾</div>
                    <h4>ECONOMÍA AGRARIA (1934)</h4>
                    <div class="modelo-desc">
                        65% población rural, exportación materias primas
                    </div>
                    <div class="modelo-datos">
                        <div class="dato"><strong>Base:</strong> Agricultura, minería</div>
                        <div class="dato"><strong>Política:</strong> Nacionalismo económico</div>
                        <div class="dato"><strong>Estado:</strong> Intervencionista</div>
                    </div>
                </div>
                
                <div class="modelo-card">
                    <div class="modelo-icon">🏭</div>
                    <h4>SUSTITUCIÓN IMPORTACIONES (1940-70)</h4>
                    <div class="modelo-desc">
                        Industrialización protegida, empresa estatal
                    </div>
                    <div class="modelo-datos">
                        <div class="dato"><strong>Base:</strong> Manufactura protegida</div>
                        <div class="dato"><strong>Política:</strong> Proteccionismo</div>
                        <div class="dato"><strong>Estado:</strong> Empresario</div>
                    </div>
                </div>
                
                <div class="modelo-card">
                    <div class="modelo-icon">💥</div>
                    <h4>CRISIS Y AJUSTE (1970-82)</h4>
                    <div class="modelo-desc">
                        Petrodólares, deuda externa, populismo económico
                    </div>
                    <div class="modelo-datos">
                        <div class="dato"><strong>Base:</strong> Petróleo, deuda</div>
                        <div class="dato"><strong>Política:</strong> Desarrollismo</div>
                        <div class="dato"><strong>Estado:</strong> Endeudado</div>
                    </div>
                </div>
                
                <div class="modelo-card">
                    <div class="modelo-icon">🌐</div>
                    <h4>NEOLIBERALISMO (1982-2000)</h4>
                    <div class="modelo-desc">
                        Apertura comercial, privatizaciones, TLCAN
                    </div>
                    <div class="modelo-datos">
                        <div class="dato"><strong>Base:</strong> Exportaciones, FDI</div>
                        <div class="dato"><strong>Política:</strong> Libre comercio</div>
                        <div class="dato"><strong>Estado:</strong> Regulador</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SIMULADOR INTERACTIVO: CRECIMIENTO ECONÓMICO -->
    <section class="simulator-section">
        <h2 class="seccion-titulo neon-interactivo">
            <span class="icon">🔄</span> SIMULADOR: EL MILAGRO MEXICANO Y SUS CONSECUENCIAS
        </h2>
        
        <div class="simulator-container" data-tema="milagro-mexicano">
            <!-- PANEL DE CONTROLES -->
            <div class="simulator-controls">
                <h3>CONFIGURADOR ECONÓMICO</h3>
                
                <div class="control-group">
                    <label for="periodoSelect">Periodo histórico:</label>
                    <select id="periodoSelect" class="control-select" onchange="cambiarPeriodoEconomico()">
                        <option value="1940-1950">1940-1950 (Inicio Milagro)</option>
                        <option value="1950-1960">1950-1960 (Auge Industrial)</option>
                        <option value="1960-1970">1960-1970 (Culminación)</option>
                        <option value="1970-1980">1970-1980 (Crisis inicial)</option>
                        <option value="1980-1990">1980-1990 (Neoliberalismo)</option>
                        <option value="1990-2000">1990-2000 (TLCAN)</option>
                    </select>
                </div>
                
                <div class="control-group">
                    <label for="politicaSelect">Política económica:</label>
                    <select id="politicaSelect" class="control-select" onchange="cambiarPolitica()">
                        <option value="sustitucion">Sustitución importaciones</option>
                        <option value="estabilizador">Desarrollo estabilizador</option>
                        <option value="desarrollismo">Desarrollismo (petróleo)</option>
                        <option value="ajuste">Ajuste estructural</option>
                        <option value="librecomercio">Libre comercio</option>
                    </select>
                </div>
                
                <div class="control-group">
                    <label>Indicadores a visualizar:</label>
                    <div class="checkbox-group">
                        <label><input type="checkbox" name="indicadores" value="pib" checked> Crecimiento PIB</label>
                        <label><input type="checkbox" name="indicadores" value="inflacion"> Inflación</label>
                        <label><input type="checkbox" name="indicadores" value="deuda"> Deuda externa</label>
                        <label><input type="checkbox" name="indicadores" value="desigualdad"> Desigualdad</label>
                    </div>
                </div>
                
                <button class="btn-simular" onclick="simularEfectos()">
                    <span class="btn-icon">📊</span> SIMULAR CONSECUENCIAS
                </button>
                
                <button class="btn-comparar" onclick="compararPeriodos()">
                    <span class="btn-icon">⚖️</span> COMPARAR PERIODOS
                </button>
            </div>
            
            <!-- VISUALIZACIÓN DE DATOS -->
            <div class="simulator-visualization" id="visualizacionEconomica">
                <div class="grafico-container">
                    <div class="grafico-header">
                        <h3 id="tituloGrafico">CRECIMIENTO ECONÓMICO 1940-1970</h3>
                        <div class="grafico-subtitulo" id="subtituloGrafico">"Milagro Mexicano" - Desarrollo Estabilizador</div>
                    </div>
                    
                    <div class="grafico-barras">
                        <div class="eje-y">
                            <div>10%</div>
                            <div>8%</div>
                            <div>6%</div>
                            <div>4%</div>
                            <div>2%</div>
                            <div>0%</div>
                            <div>-2%</div>
                        </div>
                        
                        <div class="barras-container">
                            <div class="barra-anio" data-anio="1940-1950">
                                <div class="barra-pib" style="height: 65%;" data-value="6.5%"></div>
                                <div class="barra-label">1940-50</div>
                            </div>
                            <div class="barra-anio" data-anio="1950-1960">
                                <div class="barra-pib" style="height: 75%;" data-value="7.5%"></div>
                                <div class="barra-label">1950-60</div>
                            </div>
                            <div class="barra-anio" data-anio="1960-1970">
                                <div class="barra-pib" style="height: 70%;" data-value="7.0%"></div>
                                <div class="barra-label">1960-70</div>
                            </div>
                            <div class="barra-anio" data-anio="1970-1980">
                                <div class="barra-pib" style="height: 50%;" data-value="5.0%"></div>
                                <div class="barra-label">1970-80</div>
                            </div>
                            <div class="barra-anio" data-anio="1980-1990">
                                <div class="barra-pib" style="height: 10%;" data-value="1.0%"></div>
                                <div class="barra-label">1980-90</div>
                            </div>
                            <div class="barra-anio" data-anio="1990-2000">
                                <div class="barra-pib" style="height: 35%;" data-value="3.5%"></div>
                                <div class="barra-label">1990-00</div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="grafico-leyenda">
                        <div class="leyenda-item">
                            <div class="leyenda-color pib"></div>
                            <span>Crecimiento PIB anual promedio</span>
                        </div>
                        <div class="leyenda-item">
                            <div class="leyenda-color inflacion"></div>
                            <span>Inflación anual (aparece al seleccionar)</span>
                        </div>
                    </div>
                </div>
                <div class="grafico-info" id="infoGrafico">
                    Selecciona un periodo para analizar su desempeño económico
                </div>
            </div>
            
            <!-- DATOS EN TIEMPO REAL -->
            <div class="simulator-data">
                <h3>INDICADORES ECONÓMICOS</h3>
                
                <div class="data-card">
                    <div class="data-label">Periodo seleccionado:</div>
                    <div class="data-value" id="dataPeriodo">1940-1970</div>
                </div>
                
                <div class="data-card">
                    <div class="data-label">Crecimiento PIB promedio:</div>
                    <div class="data-value" id="dataPIB">6.5% anual</div>
                </div>
                
                <div class="data-card">
                    <div class="data-label">Inflación promedio:</div>
                    <div class="data-value" id="dataInflacion">5.2% anual</div>
                </div>
                
                <div class="data-card highlight">
                    <div class="data-label">MODELO ECONÓMICO:</div>
                    <div class="data-value" id="dataModelo">Sustitución importaciones</div>
                </div>
                
                <div class="data-card">
                    <div class="data-label">Deuda externa/PIB:</div>
                    <div class="data-value" id="dataDeuda">15%</div>
                </div>
                
                <div class="data-card">
                    <div class="data-label">Inversión extranjera:</div>
                    <div class="data-value" id="dataInversion">Baja</div>
                </div>
                
                <div class="estadisticas">
                    <h4>📊 IMPACTOS SOCIALES</h4>
                    <div class="stat-item">
                        <span>Población urbana:</span>
                        <span class="stat-value">35% → 65%</span>
                    </div>
                    <div class="stat-item">
                        <span>Analfabetismo:</span>
                        <span class="stat-value">42% → 25%</span>
                    </div>
                    <div class="stat-item">
                        <span>Esperanza vida:</span>
                        <span class="stat-value">38 → 65 años</span>
                    </div>
                    <div class="stat-item">
                        <span>Coef. Gini (desigualdad):</span>
                        <span class="stat-value">0.53 (alto)</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- QUIZ INTERACTIVO -->
    <section class="quiz-section">
        <h2 class="seccion-titulo neon-evaluacion">
            <span class="icon">❓</span> QUIZ: MÉXICO CONTEMPORÁNEO
        </h2>
        
        <div class="quiz-container">
            <!-- PREGUNTA 1 -->
            <div class="quiz-question" data-correct="C">
                <div class="quiz-header">
                    <span class="quiz-num">01</span>
                    <h3>¿Qué caracterizó principalmente al "Milagro Mexicano" (1940-1970)?</h3>
                </div>
                
                <div class="quiz-options">
                    <button class="quiz-option" data-value="A">
                        <span class="option-letter">A</span>
                        Apertura comercial y privatizaciones masivas
                    </button>
                    <button class="quiz-option" data-value="B">
                        <span class="option-letter">B</span>
                        Revolución socialista y expropiaciones
                    </button>
                    <button class="quiz-option" data-value="C">
                        <span class="option-letter">C</span>
                        Crecimiento económico acelerado con industrialización protegida
                    </button>
                    <button class="quiz-option" data-value="D">
                        <span class="option-letter">D</span>
                        Estancamiento económico y alta inflación
                    </button>
                </div>
                
                <div class="quiz-feedback" style="display: none;">
                    <div class="feedback-correct">
                        ✅ <strong>Correcto:</strong> El Milagro Mexicano fue un período de crecimiento acelerado basado en industrialización por sustitución de importaciones.
                    </div>
                    <div class="feedback-incorrect">
                        ❌ <strong>Incorrecto:</strong> La apertura comercial fue posterior (años 80-90), la revolución socialista fue cardenista (años 30), y el estancamiento llegó después de 1970.
                    </div>
                    <div class="feedback-explicacion">
                        <p><strong>Explicación:</strong> Entre 1940-1970 México creció a un promedio del 6% anual. Se industrializó mediante protección arancelaria, creó empresas paraestatales, urbanizó masivamente y mantuvo estabilidad macroeconómica ("desarrollo estabilizador").</p>
                    </div>
                </div>
            </div>
            
            <!-- PREGUNTA 2 -->
            <div class="quiz-question" data-correct="B">
                <div class="quiz-header">
                    <span class="quiz-num">02</span>
                    <h3>¿Qué consecuencia política tuvo el movimiento estudiantil de 1968?</h3>
                </div>
                
                <div class="quiz-options">
                    <button class="quiz-option" data-value="A">
                        <span class="option-letter">A</span>
                        Inmediata democratización y caída del PRI
                    </button>
                    <button class="quiz-option" data-value="B">
                        <span class="option-letter">B</span>
                        Inicio de reformas políticas graduales y apertura del sistema
                    </button>
                    <button class="quiz-option" data-value="C">
                        <span class="option-letter">C</span>
                        Fortalecimiento del autoritarismo priísta por 20 años más
                    </button>
                    <button class="quiz-option" data-value="D">
                        <span class="option-letter">D</span>
                        Intervención militar permanente en la política
                    </button>
                </div>
                
                <div class="quiz-feedback" style="display: none;">
                    <div class="feedback-correct">
                        ✅ <strong>Correcto:</strong> 1968 inició un proceso de reformas graduales que llevaría a la democratización.
                    </div>
                    <div class="feedback-incorrect">
                        ❌ <strong>Incorrecto:</strong> La caída del PRI tardó 32 años más, el autoritarismo se debilitó tras 1968, y no hubo intervención militar permanente.
                    </div>
                    <div class="feedback-explicacion">
                        <p><strong>Dato:</strong> Tras 1968 vino la reforma política de 1977 que legalizó partidos de izquierda, las sucesivas reformas electorales (1986, 1990, 1994, 1996) que crearon el IFE, y finalmente la alternancia en 2000.</p>
                    </div>
                </div>
            </div>
            
            <!-- PREGUNTA 3 -->
            <div class="quiz-question" data-correct="D">
                <div class="quiz-header">
                    <span class="quiz-num">03</span>
                    <h3>¿Qué permitió la alternancia democrática del año 2000?</h3>
                </div>
                
                <div class="quiz-options">
                    <button class="quiz-option" data-value="A">
                        <span class="option-letter">A</span>
                        Un golpe de estado que derrocó al PRI
                    </button>
                    <button class="quiz-option" data-value="B">
                        <span class="option-letter">B</span>
                        Una revolución armada popular
                    </button>
                    <button class="quiz-option" data-value="C">
                        <span class="option-letter">C</span>
                        Presión internacional y sanciones económicas
                    </button>
                    <button class="quiz-option" data-value="D">
                        <span class="option-letter">D</span>
                        Reformas electorales que garantizaron elecciones limpias
                    </button>
                </div>
                
                <div class="quiz-feedback" style="display: none;">
                    <div class="feedback-correct">
                        ✅ <strong>Correcto:</strong> Las reformas electorales (especialmente la de 1996) crearon condiciones para elecciones creíbles.
                    </div>
                    <div class="feedback-incorrect">
                        ❌ <strong>Incorrecto:</strong> No hubo golpe ni revolución, y la presión internacional fue secundaria.
                    </div>
                    <div class="feedback-explicacion">
                        <p><strong>Solución:</strong> La creación del IFE autónomo (1996), credencial con foto, Tribunal Electoral, acceso equitativo a medios y fiscalización fueron claves. En 2000, por primera vez, los mexicanos confiaron en que su voto sería respetado.</p>
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

    <!-- PROBLEMAS TIPO EXAMEN -->
    <section class="examen-section">
        <h2 class="seccion-titulo neon-evaluacion">
            <span class="icon">📝</span> ANÁLISIS DEL MÉXICO MODERNO
        </h2>
        
        <div class="examen-container">
            <div class="problema-card">
                <div class="problema-header">
                    <span class="problema-num">P1</span>
                    <h3>Evaluación del Cardenismo: ¿Revolución o Institucionalización?</h3>
                </div>
                <div class="problema-enunciado">
                    <p>Analiza críticamente el gobierno de Lázaro Cárdenas (1934-1940):</p>
                    
                    <div class="analisis-dimensiones">
                        <div class="dimension">
                            <h5>🌾 REFORMA AGRARIA</h5>
                            <p><strong>Logro:</strong> 18M hectáreas repartidas, ejidos, CNC</p>
                            <textarea placeholder="Evalúa impacto real y límites..." rows="3"></textarea>
                        </div>
                        
                        <div class="dimension">
                            <h5>🛢️ EXPROPIACIÓN PETROLERA</h5>
                            <p><strong>Logro:</strong> Soberanía nacional, PEMEX, apoyo popular</p>
                            <textarea placeholder="Analiza consecuencias económicas..." rows="3"></textarea>
                        </div>
                        
                        <div class="dimension">
                            <h5>🏛️ INSTITUCIONALIZACIÓN</h5>
                            <p><strong>Logro:</strong> CTM, PRI, educación socialista</p>
                            <textarea placeholder="Examina efectos políticos a largo plazo..." rows="3"></textarea>
                        </div>
                    </div>
                    
                    <p><strong>Pregunta de síntesis:</strong> ¿Fue el cardenismo la culminación de la Revolución Mexicana o su institucionalización/autorización?</p>
                    <textarea placeholder="Desarrolla tu argumento..." rows="4"></textarea>
                </div>
                <button class="btn-verificar" onclick="verificarProblema(1)">VERIFICAR ANÁLISIS</button>
                <div class="problema-solucion" id="solucionP1" style="display: none;">
                    <strong>Análisis sugerido:</strong><br>
                    <strong>Logros:</strong> Mayor redistribución tierra en historia mexicana, soberanía energética, organización popular, nacionalismo cultural.<br>
                    <strong>Límites:</strong> Ejidos poco productivos, burocracia sindical, PRI como partido oficial (inicio del autoritarismo), educación socialista efímera.<br><br>
                    <strong>Veredicto:</strong> Cardenismo fue ambas cosas: <strong>culminación</strong> del proyecto social revolucionario (agrario, nacionalista) pero también <strong>institucionalización</strong> del sistema político autoritario (PRI, corporativismo). Sentó bases para desarrollo posterior pero también para el presidencialismo autoritario.
                </div>
            </div>
            
            <div class="problema-card">
                <div class="problema-header">
                    <span class="problema-num">P2</span>
                    <h3>1968-2000: ¿Transición Democrática o Modernización Autoritaria?</h3>
                </div>
                <div class="problema-enunciado">
                    <p>Examina el periodo 1968-2000 como proceso de transición política:</p>
                    
                    <div class="linea-transicion">
                        <div class="punto-transicion">
                            <h5>1968</h5>
                            <p>Matanza Tlatelolco, crisis de legitimidad</p>
                            <textarea placeholder="¿Punto de quiebre?" rows="2"></textarea>
                        </div>
                        
                        <div class="punto-transicion">
                            <h5>1977</h5>
                            <p>Reforma política, partidos legales</p>
                            <textarea placeholder="¿Apertura controlada?" rows="2"></textarea>
                        </div>
                        
                        <div class="punto-transicion">
                            <h5>1988</h5>
                            <p>"Caída del sistema", fraude electoral</p>
                            <textarea placeholder="¿Presión democratizadora?" rows="2"></textarea>
                        </div>
                        
                        <div class="punto-transicion">
                            <h5>1994-96</h5>
                            <p>IFE autónomo, reforma electoral</p>
                            <textarea placeholder="¿Instituciones democráticas?" rows="2"></textarea>
                        </div>
                        
                        <div class="punto-transicion">
                            <h5>2000</h5>
                            <p>Alternancia, Fox presidente</p>
                            <textarea placeholder="¿Consolidación democrática?" rows="2"></textarea>
                        </div>
                    </div>
                    
                    <p><strong>Pregunta crítica:</strong> ¿Fue esta una transición democrática genuina o simplemente una modernización del autoritarismo priísta para sobrevivir?</p>
                    <textarea placeholder="Argumenta tu posición..." rows="4"></textarea>
                </div>
                <button class="btn-verificar" onclick="verificarProblema(2)">VERIFICAR EVALUACIÓN</button>
                <div class="problema-solucion" id="solucionP2" style="display: none;">
                    <strong>Evaluación del proceso:</strong><br>
                    <strong>1968:</strong> Quiebre de legitimidad, sociedad civil despierta.<br>
                    <strong>1977:</strong> Apertura controlada desde arriba, cooptación.<br>
                    <strong>1988:</strong> Presión desde abajo (Cárdenas), resistencia del sistema.<br>
                    <strong>1994-96:</strong> Reformas reales por presión interna/externa, instituciones autónomas.<br>
                    <strong>2000:</strong> Alternancia posible por instituciones creíbles.<br><br>
                    <strong>Conclusión:</strong> Fue una <strong>transición híbrida</strong>: combinó modernización autoritaria (reformas graduales controladas) con presión democratizadora real (sociedad civil, oposición). Las reformas electorales fueron tanto concesiones para mantener poder como respuesta genuina a demandas democráticas.
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
                    <td>Comprensión histórica</td>
                    <td>Analiza causas y consecuencias de cada etapa</td>
                    <td>Describe eventos principales correctamente</td>
                    <td>Confunde periodos o procesos históricos</td>
                </tr>
                <tr>
                    <td>Análisis crítico</td>
                    <td>Evalúa logros y límites con argumentos sólidos</td>
                    <td>Identifica algunos aspectos positivos y negativos</td>
                    <td>Ofrece juicios simplistas sin fundamentar</td>
                </tr>
                <tr>
                    <td>Conexión presente-pasado</td>
                    <td>Relaciona procesos históricos con México actual</td>
                    <td>Menciona algunas continuidades históricas</td>
                    <td>No establece conexiones con el presente</td>
                </tr>
            </table>
        </div>
    </section>

    <!-- CIERRE METACOGNITIVO -->
    <section class="cierre-section">
        <h2 class="seccion-titulo neon-concepto">
            <span class="icon">🧠</span> REFLEXIÓN SOBRE EL MÉXICO MODERNO
        </h2>
        
        <div class="cierre-container">
            <div class="autoevaluacion">
                <h3>📊 AUTOEVALUACIÓN DE CONOCIMIENTOS</h3>
                <div class="slider-group">
                    <label>Comprensión del cardenismo:</label>
                    <input type="range" min="1" max="5" value="3" class="autoeval-slider" id="slider1">
                    <div class="slider-labels">
                        <span>Básico</span><span>Intermedio</span><span>Avanzado</span>
                    </div>
                </div>
                
                <div class="slider-group">
                    <label>Análisis del Milagro Mexicano:</label>
                    <input type="range" min="1" max="5" value="3" class="autoeval-slider" id="slider2">
                    <div class="slider-labels">
                        <span>Básico</span><span>Intermedio</span><span>Avanzado</span>
                    </div>
                </div>
                
                <div class="slider-group">
                    <label>Evaluación transición democrática:</label>
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
                    <p>¿Qué elementos del México contemporáneo (1934-2000) consideras que explican mejor los desafíos actuales del país?</p>
                    <textarea placeholder="Escribe tu reflexión aquí..." rows="4" id="reflexion1"></textarea>
                </div>
                <div class="pregunta-reflexion">
                    <p>¿Cómo valoras la transición democrática mexicana comparada con otros países de América Latina?</p>
                    <textarea placeholder="Escribe tu análisis comparativo..." rows="4" id="reflexion2"></textarea>
                </div>
            </div>
        </div>
        
        <div class="plan-estudio">
            <h3>📅 PLAN DE ESTUDIO RECOMENDADO</h3>
            <div class="plan-grid">
                <div class="plan-card">
                    <h4>🔄 REPASO RÁPIDO (15 min)</h4>
                    <ul>
                        <li>Memorizar fechas clave: 1938, 1968, 2000</li>
                        <li>Recordar cifras del Milagro Mexicano</li>
                        <li>Identificar reformas electorales clave</li>
                    </ul>
                </div>
                <div class="plan-card">
                    <h4>💪 PRÁCTICA (30 min)</h4>
                    <ul>
                        <li>Explorar simulador económico</li>
                        <li>Completar el quiz de autoevaluación</li>
                        <li>Analizar línea de tiempo interactiva</li>
                    </ul>
                </div>
                <div class="plan-card">
                    <h4>🚀 PROFUNDIZACIÓN (45 min)</h4>
                    <ul>
                        <li>Investigar documentos del 68</li>
                        <li>Analizar discursos de expropiación petrolera</li>
                        <li>Comparar transiciones democráticas en AL</li>
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="recursos">
            <h3>🔗 RECURSOS ADICIONALES</h3>
            <div class="recursos-links">
                <a href="https://www.archivocardenas.org/" target="_blank" class="recurso-link">
                    📜 Archivo Lázaro Cárdenas
                </a>
                <a href="https://www.m68.mx/" target="_blank" class="recurso-link">
                    🎓 M68: Archivo digital del movimiento estudiantil
                </a>
                <a href="https://www.ine.mx/" target="_blank" class="recurso-link">
                    🗳️ INE: Instituto Nacional Electoral
                </a>
                <a href="https://www.inegi.org.mx/" target="_blank" class="recurso-link">
                    📊 INEGI: Estadísticas históricas
                </a>
                <a href="https://pemex.com/acerca/informacion-financiera/Paginas/historia.aspx" target="_blank" class="recurso-link">
                    🛢️ PEMEX: Historia institucional
                </a>
            </div>
        </div>
    </section>

    <!-- JAVASCRIPT INTEGRADO -->
    <script>
    // ========================================
    // SIMULADOR ECONÓMICO INTERACTIVO
    // ========================================
    
    const datosEconomicos = {
        "1940-1950": {
            periodo: "1940-1950",
            crecimiento: "6.5%",
            inflacion: "5.2%",
            modelo: "Sustitución importaciones (inicio)",
            deuda: "8%",
            inversion: "Muy baja",
            descripcion: "Inicio del Milagro Mexicano. Industrialización protegida, inversión pública, Segunda Guerra Mundial beneficia exportaciones.",
            color: "#43A047"
        },
        "1950-1960": {
            periodo: "1950-1960",
            crecimiento: "7.5%",
            inflacion: "6.1%",
            modelo: "Desarrollo estabilizador (auge)",
            deuda: "12%",
            inversion: "Moderada",
            descripcion: "Auge del Milagro. Crecimiento acelerado, estabilidad monetaria, inversión en infraestructura, urbanización masiva.",
            color: "#388E3C"
        },
        "1960-1970": {
            periodo: "1960-1970",
            crecimiento: "7.0%",
            inflacion: "3.8%",
            modelo: "Desarrollo estabilizador (culminación)",
            deuda: "15%",
            inversion: "Alta",
            descripcion: "Culminación del Milagro. Industrialización avanzada, clase media consolidada, Juegos Olímpicos 1968, pero desigualdad persistente.",
            color: "#2E7D32"
        },
        "1970-1980": {
            periodo: "1970-1980",
            crecimiento: "5.0%",
            inflacion: "18.5%",
            modelo: "Desarrollismo petrolero",
            deuda: "35%",
            inversion: "Petróleo",
            descripcion: "Fin del Milagro. Petrodólares, gasto público expansivo, inflación creciente, deuda externa se dispara.",
            color: "#FF9800"
        },
        "1980-1990": {
            periodo: "1980-1990",
            crecimiento: "1.0%",
            inflacion: "65.3%",
            modelo: "Crisis y ajuste estructural",
            deuda: "60%",
            inversion: "Fuga capitales",
            descripcion: "Década perdida. Nacionalización de la banca (1982), crisis de deuda, hiperinflación, programas de ajuste del FMI.",
            color: "#F44336"
        },
        "1990-2000": {
            periodo: "1990-2000",
            crecimiento: "3.5%",
            inflacion: "20.1%",
            modelo: "Neoliberalismo y TLCAN",
            deuda: "25%",
            inversion: "Alta (FDI)",
            descripcion: "Recuperación parcial. TLCAN (1994), privatizaciones, crisis de 1994-95 (\'Error de diciembre\'), dependencia de EE.UU.",
            color: "#2196F3"
        }
    };
    
    function cambiarPeriodoEconomico() {
        const periodoId = document.getElementById(\'periodoSelect\').value;
        const datos = datosEconomicos[periodoId];
        
        if (!datos) return;
        
        // Actualizar gráfico
        document.getElementById(\'tituloGrafico\').textContent = `DESEMPEÑO ECONÓMICO ${datos.periodo}`;
        document.getElementById(\'subtituloGrafico\').textContent = `Modelo: ${datos.modelo}`;
        
        // Actualizar datos
        document.getElementById(\'dataPeriodo\').textContent = datos.periodo;
        document.getElementById(\'dataPIB\').textContent = datos.crecimiento + " anual";
        document.getElementById(\'dataInflacion\').textContent = datos.inflacion + " anual";
        document.getElementById(\'dataModelo\').textContent = datos.modelo;
        document.getElementById(\'dataDeuda\').textContent = datos.deuda + " del PIB";
        document.getElementById(\'dataInversion\').textContent = datos.inversion;
        
        // Actualizar información
        document.getElementById(\'infoGrafico\').textContent = datos.descripcion;
        document.getElementById(\'infoGrafico\').style.animation = "highlight 0.5s";
        
        // Resaltar barra correspondiente
        document.querySelectorAll(\'.barra-anio\').forEach(barra => {
            barra.classList.remove(\'active\');
            if (barra.dataset.anio === periodoId) {
                barra.classList.add(\'active\');
            }
        });
        
        console.log(`📈 Periodo económico seleccionado: ${datos.periodo}`);
    }
    
    function simularEfectos() {
        const periodoId = document.getElementById(\'periodoSelect\').value;
        const politica = document.getElementById(\'politicaSelect\').value;
        const checkboxes = document.querySelectorAll(\'input[name="indicadores"]:checked\');
        const indicadores = Array.from(checkboxes).map(cb => cb.value);
        
        const datos = datosEconomicos[periodoId];
        
        let simulacion = `🔮 SIMULACIÓN ECONÓMICA (${datos.periodo})\\n\\n`;
        simulacion += `Modelo aplicado: ${politica.toUpperCase()}\\n\\n`;
        
        if (indicadores.includes(\'pib\')) {
            simulacion += `📈 CRECIMIENTO PIB: ${datos.crecimiento}\\n`;
            simulacion += `   • Empleo: ${parseFloat(datos.crecimiento) > 5 ? "Generación alta" : "Moderado/escaso"}\\n`;
            simulacion += `   • Ingresos: ${parseFloat(datos.crecimiento) > 5 ? "Creciendo" : "Estancados"}\\n`;
        }
        
        if (indicadores.includes(\'inflacion\')) {
            simulacion += `💰 INFLACIÓN: ${datos.inflacion}\\n`;
            simulacion += `   • Poder adquisitivo: ${parseFloat(datos.inflacion) > 10 ? "Erosionándose" : "Estable"}\\n`;
            simulacion += `   • Pobreza: ${parseFloat(datos.inflacion) > 20 ? "Aumentando" : "Estable"}\\n`;
        }
        
        if (indicadores.includes(\'deuda\')) {
            simulacion += `🏦 DEUDA EXTERNA: ${datos.deuda} del PIB\\n`;
            simulacion += `   • Dependencia: ${parseFloat(datos.deuda) > 30 ? "Alta (crisis posible)" : "Manejo prudente"}\\n`;
            simulacion += `   • Autonomía: ${parseFloat(datos.deuda) > 40 ? "Limitada" : "Relativa"}\\n`;
        }
        
        if (indicadores.includes(\'desigualdad\')) {
            const desigualdad = periodoId === "1990-2000" ? "Aumentando" : 
                              periodoId.includes("197") ? "Estable/alta" : 
                              periodoId.includes("196") ? "Persistente" : "Moderada";
            simulacion += `⚖️ DESIGUALDAD: ${desigualdad}\\n`;
            simulacion += `   • Coef. Gini estimado: ${periodoId.includes("199") ? "0.55" : "0.50-0.53"}\\n`;
        }
        
        simulacion += `\\n💎 CONCLUSIÓN: ${periodoId.includes("198") ? "CRISIS" : periodoId.includes("199") ? "RECUPERACIÓN INCOMPLETA" : "CRECIMIENTO CON LIMITACIONES"}`;
        
        alert(simulacion);
    }
    
    function compararPeriodos() {
        const periodo1 = document.getElementById(\'periodoSelect\').value;
        const politica = document.getElementById(\'politicaSelect\').value;
        
        // Encontrar otro periodo para comparar
        let periodo2;
        if (periodo1 === "1940-1950") periodo2 = "1990-2000";
        else if (periodo1 === "1990-2000") periodo2 = "1940-1950";
        else if (periodo1.includes("196")) periodo2 = "1980-1990";
        else periodo2 = "1960-1970";
        
        const datos1 = datosEconomicos[periodo1];
        const datos2 = datosEconomicos[periodo2];
        
        const comparacion = `
🔍 COMPARATIVA ECONÓMICA HISTÓRICA

📅 ${periodo1} vs ${periodo2}

📈 CRECIMIENTO PIB:
• ${periodo1}: ${datos1.crecimiento}
• ${periodo2}: ${datos2.crecimiento}
• Diferencia: ${(parseFloat(datos1.crecimiento) - parseFloat(datos2.crecimiento)).toFixed(1)} puntos

💰 INFLACIÓN:
• ${periodo1}: ${datos1.inflacion}
• ${periodo2}: ${datos2.inflacion}
• ${parseFloat(datos1.inflacion) > parseFloat(datos2.inflacion) ? "Más" : "Menos"} estable

🏦 DEUDA/PIB:
• ${periodo1}: ${datos1.deuda}
• ${periodo2}: ${datos2.deuda}
• ${parseFloat(datos1.deuda) > parseFloat(datos2.deuda) ? "Mayor" : "Menor"} vulnerabilidad

🎯 MODELOS:
• ${periodo1}: ${datos1.modelo}
• ${periodo2}: ${datos2.modelo}

📊 CONCLUSIÓN:
${periodo1} fue de ${parseFloat(datos1.crecimiento) > 5 ? "ALTO CRECIMIENTO" : "CRECIMIENTO MODESTO"}
${periodo2} fue de ${parseFloat(datos2.crecimiento) > 5 ? "ALTO CRECIMIENTO" : "CRECIMIENTO MODESTO"}

💡 LECCIÓN: Cada modelo económico genera diferentes resultados sociales.
        `;
        
        alert(comparacion);
    }
    
    // ========================================
    // LÍNEA DE TIEMPO INTERACTIVA
    // ========================================
    
    const etapasContemporaneas = {
        cardenismo: {
            nombre: "CARDENISMO",
            periodo: "1934-1940",
            descripcion: "Reforma agraria radical, expropiación petrolera 1938, nacionalismo revolucionario.",
            color: "#D32F2F"
        },
        milagro: {
            nombre: "MILAGRO MEXICANO",
            periodo: "1940-1970",
            descripcion: "Crecimiento 6% anual, industrialización, urbanización, desarrollo estabilizador.",
            color: "#388E3C"
        },
        desarrollo: {
            nombre: "DESARROLLISMO",
            periodo: "1970-1982",
            descripcion: "Petrodólares, gasto público expansivo, inicio de crisis económica.",
            color: "#FF9800"
        },
        crisis: {
            nombre: "1968 Y CRISIS",
            periodo: "1968-1982",
            descripcion: "Movimiento estudiantil, Tlatelolco, reformas políticas, crisis económica.",
            color: "#7B1FA2"
        },
        transicion: {
            nombre: "TRANSICIÓN",
            periodo: "1982-1994",
            descripcion: "Neoliberalismo, reformas electorales, TLCAN, crisis 1994.",
            color: "#2196F3"
        },
        alternancia: {
            nombre: "ALTERNANCIA",
            periodo: "1994-2000",
            descripcion: "IFE autónomo, elecciones competitivas, victoria de Fox 2000.",
            color: "#9C27B0"
        }
    };
    
    document.querySelectorAll(\'.timeline-btn\').forEach(btn => {
        btn.addEventListener(\'click\', function() {
            const etapa = this.dataset.etapa;
            mostrarDetalleEtapa(etapa);
            
            // Resaltar en timeline
            document.querySelectorAll(\'.etapa-bar\').forEach(bar => {
                bar.classList.remove(\'active\');
            });
            document.querySelector(`.etapa-bar[data-etapa="${etapa}"]`).classList.add(\'active\');
            
            // Resaltar botón
            document.querySelectorAll(\'.timeline-btn\').forEach(b => {
                b.style.background = \'\';
            });
            this.style.background = etapasContemporaneas[etapa].color;
        });
    });
    
    function mostrarDetalleEtapa(etapa) {
        const info = etapasContemporaneas[etapa];
        if (!info) return;
        
        // Ocultar todos los detalles
        document.querySelectorAll(\'.etapa-detalle\').forEach(detalle => {
            detalle.style.display = \'none\';
        });
        
        // Mostrar el detalle correspondiente
        const detalle = document.getElementById(`detalle${etapa.charAt(0).toUpperCase() + etapa.slice(1)}`);
        if (detalle) {
            detalle.style.display = \'block\';
        }
        
        // Actualizar información
        document.getElementById(\'timelineInfo\').innerHTML = `
            <strong>${info.nombre}</strong> (${info.periodo})<br>
            ${info.descripcion}
        `;
        document.getElementById(\'timelineInfo\').style.animation = "highlight 0.5s";
        
        console.log(`📅 Etapa contemporánea seleccionada: ${info.nombre}`);
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
            feedback = "🎉 ¡Excelente! Dominas el México contemporáneo.";
        } else if (porcentaje >= 60) {
            feedback = "👍 Buen trabajo, pero revisa la transición democrática.";
        } else {
            feedback = "📚 Necesitas repasar el México del siglo XX.";
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
    // SISTEMA DE AUTOEVALUACIÓN
    // ========================================
    
    function guardarAutoevaluacion() {
        const slider1 = document.getElementById(\'slider1\').value;
        const slider2 = document.getElementById(\'slider2\').value;
        const slider3 = document.getElementById(\'slider3\').value;
        
        const promedio = (parseInt(slider1) + parseInt(slider2) + parseInt(slider3)) / 3;
        
        alert(`📊 AutoEvaluación guardada:\\n\\n` +
              `Cardenismo: ${slider1}/5\\n` +
              `Milagro Mexicano: ${slider2}/5\\n` +
              `Transición democrática: ${slider3}/5\\n\\n` +
              `Promedio: ${promedio.toFixed(1)}/5\\n\\n` +
              `Revisa el plan de estudio según tus resultados.`);
        
        console.log(`💾 AutoEvaluación guardada: ${slider1}, ${slider2}, ${slider3}`);
    }
    
    // ========================================
    // INICIALIZACIÓN
    // ========================================
    
    console.log("🚀 Sistema Cyberpunk Contemporáneo inicializado");
    console.log("📚 Lección: México Contemporáneo (1934-2000)");
    console.log("⚡ Simulador económico, Timeline y Quiz listos");
    
    // Inicializar simulador
    cambiarPeriodoEconomico();
    mostrarDetalleEtapa(\'cardenismo\');
    
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
    
    // Modelos económicos interactivos
    document.querySelectorAll(\'.modelo-card\').forEach(card => {
        card.addEventListener(\'click\', function() {
            const modelo = this.querySelector(\'h4\').textContent;
            
            const modelosInfo = {
                "ECONOMÍA AGRARIA (1934)": "🌾 AGRARIA (1934): 65% población rural. Exportación materias primas. Reforma agraria cardenista. Nacionalismo económico. Industrialización incipiente.",
                "SUSTITUCIÓN IMPORTACIONES (1940-70)": "🏭 SUSTITUCIÓN IMPORTACIONES: Industrialización protegida. Empresa paraestatal. Mercado interno protegido. \'Desarrollo estabilizador\'. Crecimiento 6% anual.",
                "CRISIS Y AJUSTE (1970-82)": "💥 CRISIS Y AJUSTE: Petrodólares, gasto público expansivo. Deuda externa explosiva. Nacionalización banca 1982. Inflación descontrolada.",
                "NEOLIBERALISMO (1982-2000)": "🌐 NEOLIBERALISMO: Apertura comercial. Privatizaciones. TLCAN 1994. Reducción Estado. Dependencia exportaciones/EE.UU."
            };
            
            alert(`${modelo}\\n\\n${modelosInfo[modelo] || "Información no disponible"}`);
        });
    });
    
    // Estadísticas interactivas
    document.querySelectorAll(\'.estadistica-card\').forEach(card => {
        card.addEventListener(\'click\', function() {
            const valor = this.querySelector(\'.estadistica-valor\').textContent;
            const label = this.querySelector(\'.estadistica-label\').textContent;
            
            const datosInfo = {
                "20M → 100M": "Población: 20 millones (1934) → 100 millones (2000). Crecimiento x5 en 66 años. Transición demográfica acelerada.",
                "35% → 80%": "Urbanización: 35% (1940) → 80% (2000). Migración masiva campo-ciudad. CDMX de 1.5M a 20M en área metropolitana.",
                "6%": "Crecimiento anual promedio 1940-1970. \'Milagro Mexicano\'. Industrialización acelerada. Estabilidad macroeconómica.",
                "18M": "Hectáreas repartidas por Cárdenas (1934-1940). 800,000 campesinos beneficiados. Culminación reforma agraria revolucionaria.",
                "71 años": "Hegemonía PRI (1929-2000). Partido oficial, corporativismo, presidencialismo autoritario. Alternancia en 2000.",
                "42.5%": "Votos de Vicente Fox en 2000. Primera derrota presidencial del PRI. Coalición PAN-PVEM. \'Ya cambió México\'."
            };
            
            this.style.animation = "pulse 0.5s";
            setTimeout(() => {
                this.style.animation = "";
            }, 500);
            
            console.log(`📊 Dato contemporáneo: ${valor} ${label}`);
        });
    });
    
    // Gráfico interactivo
    document.querySelectorAll(\'.barra-anio\').forEach(barra => {
        barra.addEventListener(\'click\', function() {
            const anio = this.dataset.anio;
            document.getElementById(\'periodoSelect\').value = anio;
            cambiarPeriodoEconomico();
        });
    });
    
    // Problemas de examen
    function verificarProblema(num) {
        const solucion = document.getElementById(`solucionP${num}`);
        solucion.style.display = solucion.style.display === \'block\' ? \'none\' : \'block\';
    }
    
    // Efecto de pulse para animaciones
    const style = document.createElement(\'style\');
    style.textContent = `
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
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
        'enunciado' => 'Expropiación petrolera',
        'respuesta' => '18 marzo 1938',
      ),
      1 => 
      array (
        'enunciado' => 'Presidente Cardenismo',
        'respuesta' => 'Lázaro Cárdenas',
      ),
      2 => 
      array (
        'enunciado' => 'Milagro Mexicano',
        'respuesta' => '1940-1970',
      ),
      3 => 
      array (
        'enunciado' => 'Crecimiento anual promedio',
        'respuesta' => '~6%',
      ),
      4 => 
      array (
        'enunciado' => 'Masacre estudiantil',
        'respuesta' => '2 octubre 1968',
      ),
      5 => 
      array (
        'enunciado' => 'Lugar de Tlatelolco',
        'respuesta' => 'CDMX',
      ),
      6 => 
      array (
        'enunciado' => 'Primer presidente no PRI',
        'respuesta' => 'Vicente Fox',
      ),
      7 => 
      array (
        'enunciado' => 'Partido de Fox',
        'respuesta' => 'PAN',
      ),
      8 => 
      array (
        'enunciado' => 'Hectáreas repartidas Cárdenas',
        'respuesta' => '18 millones',
      ),
      9 => 
      array (
        'enunciado' => 'Empresa creada 1938',
        'respuesta' => 'PEMEX',
      ),
      10 => 
      array (
        'enunciado' => 'Población 1970',
        'respuesta' => '~50 millones',
      ),
      11 => 
      array (
        'enunciado' => 'SI: años alternancia',
        'respuesta' => '25',
      ),
    ),
    'quiz' => 
    array (
      0 => 
      array (
        'pregunta' => 'Expropiación',
        'opciones' => 
        array (
          0 => '1938',
          1 => '1917',
          2 => '1968',
          3 => '2000',
        ),
        'correcta' => '1938',
      ),
      1 => 
      array (
        'pregunta' => 'Cárdenas repartió',
        'opciones' => 
        array (
          0 => '18M ha',
          1 => '1M',
          2 => '100M',
          3 => '0',
        ),
        'correcta' => '18M ha',
      ),
      2 => 
      array (
        'pregunta' => 'Milagro Mexicano',
        'opciones' => 
        array (
          0 => '1940-1970',
          1 => '1930-1940',
          2 => '1970-2000',
          3 => '2000-2025',
        ),
        'correcta' => '1940-1970',
      ),
      3 => 
      array (
        'pregunta' => 'Crecimiento PIB',
        'opciones' => 
        array (
          0 => '~6%',
          1 => '1%',
          2 => '10%',
          3 => '0%',
        ),
        'correcta' => '~6%',
      ),
      4 => 
      array (
        'pregunta' => 'Tlatelolco',
        'opciones' => 
        array (
          0 => '2 Oct 1968',
          1 => '18 Mar 1938',
          2 => '2 Jul 2000',
          3 => '5 Feb 1917',
        ),
        'correcta' => '2 Oct 1968',
      ),
      5 => 
      array (
        'pregunta' => 'Muertos 68',
        'opciones' => 
        array (
          0 => '~300',
          1 => '30',
          2 => '3,000',
          3 => '0',
        ),
        'correcta' => '~300',
      ),
      6 => 
      array (
        'pregunta' => 'Alternancia',
        'opciones' => 
        array (
          0 => '2000',
          1 => '1968',
          2 => '1938',
          3 => '1910',
        ),
        'correcta' => '2000',
      ),
      7 => 
      array (
        'pregunta' => 'Fox partido',
        'opciones' => 
        array (
          0 => 'PAN',
          1 => 'PRI',
          2 => 'PRD',
          3 => 'MORENA',
        ),
        'correcta' => 'PAN',
      ),
      8 => 
      array (
        'pregunta' => 'PEMEX significa',
        'opciones' => 
        array (
          0 => 'Petróleos Mexicanos',
          1 => 'Poder Ejecutivo',
          2 => 'Partido Mexicano',
          3 => 'Nada',
        ),
        'correcta' => 'Petróleos Mexicanos',
      ),
      9 => 
      array (
        'pregunta' => 'SI 2025: años PEMEX',
        'opciones' => 
        array (
          0 => '87',
          1 => '100',
          2 => '50',
          3 => '25',
        ),
        'correcta' => '87',
      ),
      10 => 
      array (
        'pregunta' => 'Cárdenas creó',
        'opciones' => 
        array (
          0 => 'PEMEX',
          1 => 'INE',
          2 => 'CFE',
          3 => 'IMSS',
        ),
        'correcta' => 'PEMEX',
      ),
      11 => 
      array (
        'pregunta' => 'Milagro basado en',
        'opciones' => 
        array (
          0 => 'ISI',
          1 => 'Neoliberalismo',
          2 => 'Comunismo',
          3 => 'Nada',
        ),
        'correcta' => 'ISI',
      ),
      12 => 
      array (
        'pregunta' => '68 antes de',
        'opciones' => 
        array (
          0 => 'Juegos Olímpicos',
          1 => 'Mundial 70',
          2 => 'Independencia',
          3 => 'Reforma',
        ),
        'correcta' => 'Juegos Olímpicos',
      ),
      13 => 
      array (
        'pregunta' => 'PRI gobernó',
        'opciones' => 
        array (
          0 => '71 años',
          1 => '20',
          2 => '100',
          3 => '10',
        ),
        'correcta' => '71 años',
      ),
      14 => 
      array (
        'pregunta' => '2000 votación',
        'opciones' => 
        array (
          0 => '58%',
          1 => '30%',
          2 => '80%',
          3 => '10%',
        ),
        'correcta' => '58%',
      ),
      15 => 
      array (
        'pregunta' => 'IFE fundado',
        'opciones' => 
        array (
          0 => '1990',
          1 => '1938',
          2 => '1968',
          3 => '2000',
        ),
        'correcta' => '1990',
      ),
      16 => 
      array (
        'pregunta' => 'INE desde',
        'opciones' => 
        array (
          0 => '2014',
          1 => '2000',
          2 => '1990',
          3 => '1968',
        ),
        'correcta' => '2014',
      ),
      17 => 
      array (
        'pregunta' => 'Población 1940',
        'opciones' => 
        array (
          0 => '~20M',
          1 => '50M',
          2 => '100M',
          3 => '10M',
        ),
        'correcta' => '~20M',
      ),
      18 => 
      array (
        'pregunta' => 'Población 1970',
        'opciones' => 
        array (
          0 => '~50M',
          1 => '20M',
          2 => '100M',
          3 => '10M',
        ),
        'correcta' => '~50M',
      ),
      19 => 
      array (
        'pregunta' => 'SI 2025: años Tlatelolco',
        'opciones' => 
        array (
          0 => '57',
          1 => '50',
          2 => '60',
          3 => '70',
        ),
        'correcta' => '57',
      ),
      20 => 
      array (
        'pregunta' => 'Cárdenas sindicato',
        'opciones' => 
        array (
          0 => 'CTM',
          1 => 'SNTMMRM',
          2 => 'SNTE',
          3 => 'CFE',
        ),
        'correcta' => 'CTM',
      ),
      21 => 
      array (
        'pregunta' => 'Milagro terminó con',
        'opciones' => 
        array (
          0 => 'Crisis 1970s',
          1 => '68',
          2 => '2000',
          3 => '1938',
        ),
        'correcta' => 'Crisis 1970s',
      ),
      22 => 
      array (
        'pregunta' => '68 líder estudiantil',
        'opciones' => 
        array (
          0 => 'CNH',
          1 => 'PRI',
          2 => 'PAN',
          3 => 'UNAM',
        ),
        'correcta' => 'CNH',
      ),
      23 => 
      array (
        'pregunta' => '2000 candidato PRI',
        'opciones' => 
        array (
          0 => 'Labastida',
          1 => 'Fox',
          2 => 'Cárdenas',
          3 => 'Madrazo',
        ),
        'correcta' => 'Labastida',
      ),
      24 => 
      array (
        'pregunta' => 'Fox campaña',
        'opciones' => 
        array (
          0 => '¡Ya!',
          1 => 'Sí se puede',
          2 => 'Vive México',
          3 => 'Cambio',
        ),
        'correcta' => '¡Ya!',
      ),
      25 => 
      array (
        'pregunta' => 'PEMEX exporta',
        'opciones' => 
        array (
          0 => 'Crudo',
          1 => 'Gasolina',
          2 => 'Electricidad',
          3 => 'Nada',
        ),
        'correcta' => 'Crudo',
      ),
      26 => 
      array (
        'pregunta' => 'Milagro: carreteras',
        'opciones' => 
        array (
          0 => '15,000 km',
          1 => '1,000',
          2 => '100,000',
          3 => '0',
        ),
        'correcta' => '15,000 km',
      ),
      27 => 
      array (
        'pregunta' => '68: Batallón Olimpia',
        'opciones' => 
        array (
          0 => 'Represión',
          1 => 'Deporte',
          2 => 'Paz',
          3 => 'Nada',
        ),
        'correcta' => 'Represión',
      ),
      28 => 
      array (
        'pregunta' => 'SI 2025: alternancia',
        'opciones' => 
        array (
          0 => '25 años',
          1 => '10',
          2 => '50',
          3 => '71',
        ),
        'correcta' => '25 años',
      ),
      29 => 
      array (
        'pregunta' => 'México 2000',
        'opciones' => 
        array (
          0 => 'Democracia plena',
          1 => 'Dictadura',
          2 => 'Monarquía',
          3 => 'Colonia',
        ),
        'correcta' => 'Democracia plena',
      ),
    ),
  ),
);
