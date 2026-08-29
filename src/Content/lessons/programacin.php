<?php
/**
 * Materia: Programación
 * Lecciones: 10
 */
return array (
  0 => 
  array (
    'materia' => 'Programación',
    'slug' => 'bases-datos-relacionales',
    'titulo' => 'Bases de Datos Relacionales: Arquitectura SQL, Normalización y Simulación Cuántica',
    'contenido' => '<!-- INICIO LECCIÓN CYBERPUNK PROGRAMACIÓN -->
<div class="leccion-container leccion-programacion-bases-datos" data-tema="bases-datos-relacionales">
    
    <!-- 1️⃣ INTRODUCCIÓN CONCEPTUAL CYBERPUNK -->
    <header class="leccion-header">
        <h1 class="titulo-leccion neon-glow">
            <span class="icon-tema">💾</span>
            BASES DE DATOS RELACIONALES
        </h1>
        <div class="subtitulo">
            SQL, Normalización y Arquitectura Cuántica de Datos
        </div>
    </header>
    <section class="panel-objetivos">
        <h2 class="seccion-titulo neon-concepto">
            <span class="icon">🎯</span> OBJETIVOS DE APRENDIZAJE
        </h2>
        <div class="objetivos-grid">
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Dominar sintaxis SQL básica y avanzada</h3>
                <p>SELECT, JOIN, WHERE, GROUP BY, ORDER BY, funciones agregadas</p>
            </div>
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Diseñar esquemas normalizados (1NF-3NF)</h3>
                <p>Aplicar reglas de normalización en modelos complejos</p>
            </div>
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Implementar relaciones 1:1, 1:N, N:N</h3>
                <p>Claves primarias, foráneas e integridad referencial</p>
            </div>
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Optimizar consultas SQL</h3>
                <p>Índices, subconsultas, vistas y procedimientos almacenados</p>
            </div>
        </div>
    </section>
    <section class="contexto-real">
        <h2 class="seccion-titulo neon-dato">
            <span class="icon">🌍</span> APLICACIÓN EN EL MUNDO REAL
        </h2>
        <div class="contexto-grid">
            <div class="contexto-card">
                <h3>🏦 Sistemas Bancarios</h3>
                <p>Transacciones ACID, claves foráneas para cuentas-clientes</p>
                <div class="dato-neon">99.999% disponibilidad</div>
            </div>
            <div class="contexto-card">
                <h3>🛒 E-commerce</h3>
                <p>JOINs masivos entre productos, usuarios, pedidos</p>
                <div class="dato-neon">10M+ consultas/día</div>
            </div>
            <div class="contexto-card">
                <h3>🏥 Historias Clínicas</h3>
                <p>Normalización extrema para evitar duplicados</p>
                <div class="dato-neon">HIPAA compliant</div>
            </div>
        </div>
        <div class="relacion-curricular">
            <h3>RELACIÓN CURRICULAR</h3>
            <div class="badges">
                <span class="badge">Competencia: Diseño de Sistemas de Información</span>
                <span class="badge">Contenido: Modelado de Datos</span>
                <span class="badge">Evaluación: Proyecto de BD Real</span>
            </div>
        </div>
    </section>

    <!-- 2️⃣ DESARROLLO TEÓRICO ESTRUCTURADO -->
    <section class="teoria-section">
        <div class="borde-neon-lateral"></div>
        <h2 class="seccion-titulo neon-concepto">
            <span class="icon">📚</span> ARQUITECTURA RELACIONAL
        </h2>
       
        <!-- INTRODUCCIÓN -->
        <div class="subseccion">
            <h3>1. Fundamentos Codd</h3>
            <div class="definicion-principal">
                <div class="def-card">
                    <h4>🗄️ BASE DE DATOS RELACIONAL</h4>
                    <p>Sistema que organiza datos en <strong>tablas</strong> (relaciones) interconectadas mediante <strong>claves</strong></p>
                    <div class="principios-grid">
                        <div class="principio">
                            <div class="principio-icon">🔑</div>
                            <h5>Integridad Referencial</h5>
                            <p>FK siempre apunta a PK existente</p>
                        </div>
                        <div class="principio">
                            <div class="principio-icon">🎯</div>
                            <h5>Normalización</h5>
                            <p>Eliminar redundancia y anomalías</p>
                        </div>
                        <div class="principio">
                            <div class="principio-icon">⚡</div>
                            <h5>ACID</h5>
                            <p>Atomicidad, Consistencia, Aislamiento, Durabilidad</p>
                        </div>
                    </div>
                </div>
            </div>
           
            <div class="clasificacion-doble">
                <div class="clas-card sql">
                    <h4>📝 SQL (Structured Query Language)</h4>
                    <ul>
                        <li><strong>DDL:</strong> CREATE, ALTER, DROP</li>
                        <li><strong>DML:</strong> SELECT, INSERT, UPDATE, DELETE</li>
                        <li><strong>DCL:</strong> GRANT, REVOKE</li>
                        <li><strong>TCL:</strong> COMMIT, ROLLBACK</li>
                    </ul>
                    <div class="ejemplos">
                        <strong>Dialectos:</strong> MySQL, PostgreSQL, SQL Server, Oracle
                    </div>
                </div>
               
                <div class="clas-card no-sql">
                    <h4>🚫 NoSQL (Contraste)</h4>
                    <ul>
                        <li><strong>Documentos:</strong> MongoDB, CouchDB</li>
                        <li><strong>Grafos:</strong> Neo4j</li>
                        <li><strong>Clave-Valor:</strong> Redis</li>
                        <li><strong>Columnar:</strong> Cassandra</li>
                    </ul>
                    <div class="ejemplos">
                        <strong>Ventaja:</strong> Escalabilidad horizontal
                    </div>
                </div>
            </div>
        </div>
        <!-- CLAVES Y RELACIONES -->
        <div class="subseccion">
            <h3>2. Sistema de Claves</h3>
            <div class="comparativa-grid">
                <div class="comp-card pk">
                    <div class="comp-header">
                        <h4>🔑 PRIMARY KEY (PK)</h4>
                        <div class="comp-badge">Identificador Único</div>
                    </div>
                    <div class="comp-caracteristicas">
                        <p><strong>Definición:</strong> Columna(s) que identifican única y exclusivamente cada fila</p>
                        <p><strong>Características:</strong></p>
                        <ul>
                            <li>NO NULL (no acepta valores nulos)</li>
                            <li>UNIQUE (valores únicos en toda la tabla)</li>
                            <li>Índice automático (búsqueda rápida)</li>
                            <li>Una sola por tabla (puede ser compuesta)</li>
                        </ul>
                    </div>
                    <div class="comp-ejemplos">
                        <div class="ejemplo-item">
                            <div class="codigo">id INT PRIMARY KEY</div>
                            <div class="desc">Entero auto-incremental</div>
                        </div>
                        <div class="ejemplo-item">
                            <div class="codigo">dni VARCHAR(20) PRIMARY KEY</div>
                            <div class="desc">Texto único (documento)</div>
                        </div>
                        <div class="ejemplo-item">
                            <div class="codigo">PRIMARY KEY (user_id, course_id)</div>
                            <div class="desc">Clave compuesta</div>
                        </div>
                    </div>
                </div>
               
                <div class="comp-card fk">
                    <div class="comp-header">
                        <h4>🔗 FOREIGN KEY (FK)</h4>
                        <div class="comp-badge">Referencia Relacional</div>
                    </div>
                    <div class="comp-caracteristicas">
                        <p><strong>Definición:</strong> Columna que referencia la PK de otra tabla</p>
                        <p><strong>Reglas de Integridad:</strong></p>
                        <ul>
                            <li>ON DELETE CASCADE (elimina filas relacionadas)</li>
                            <li>ON DELETE SET NULL (establece FK como NULL)</li>
                            <li>ON DELETE RESTRICT (previene eliminación)</li>
                            <li>ON UPDATE CASCADE (actualiza referencias)</li>
                        </ul>
                    </div>
                    <div class="comp-ejemplos">
                        <div class="ejemplo-item">
                            <div class="codigo">user_id INT REFERENCES users(id)</div>
                            <div class="desc">FK simple</div>
                        </div>
                        <div class="ejemplo-item">
                            <div class="codigo">FOREIGN KEY (dept_id) REFERENCES departments(id) ON DELETE CASCADE</div>
                            <div class="desc">Con acción en cascada</div>
                        </div>
                    </div>
                </div>
            </div>
           
            <div class="regla-oro">
                <h4>⚡ REGLA DE ORO: PK vs FK</h4>
                <div class="regla-content">
                    <div class="regla-item">
                        <div class="regla-icon">🔑</div>
                        <div class="regla-text">
                            <strong>PK:</strong> Una por tabla, identifica <strong>esta</strong> fila
                        </div>
                    </div>
                    <div class="regla-item">
                        <div class="regla-icon">🔗</div>
                        <div class="regla-text">
                            <strong>FK:</strong> Múltiples por tabla, apunta a <strong>otra</strong> tabla
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- TIPOS DE RELACIONES -->
        <div class="subseccion">
            <h3>3. Tipos de Relaciones</h3>
            <div class="tabla-interactiva">
                <table class="tabla-cyberpunk">
                    <thead>
                        <tr>
                            <th>TIPO</th>
                            <th>CARDINALIDAD</th>
                            <th>IMPLEMENTACIÓN</th>
                            <th>EJEMPLO REAL</th>
                            <th>PATRÓN SQL</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr data-tipo="uno-a-uno">
                            <td><strong class="neon-concepto">1:1</strong></td>
                            <td>Un registro → Un registro</td>
                            <td>FK UNIQUE en cualquiera de las tablas</td>
                            <td>Usuario ←→ Perfil</td>
                            <td><code>FK UNIQUE</code></td>
                        </tr>
                        <tr data-tipo="uno-a-muchos">
                            <td><strong class="neon-concepto">1:N</strong></td>
                            <td>Un registro → Muchos registros</td>
                            <td>FK en tabla "muchos"</td>
                            <td>Cliente ←→ Pedidos</td>
                            <td><code>FK sin UNIQUE</code></td>
                        </tr>
                        <tr data-tipo="muchos-a-muchos">
                            <td><strong class="neon-concepto">N:N</strong></td>
                            <td>Muchos registros → Muchos registros</td>
                            <td>Tabla intermedia con dos FK</td>
                            <td>Estudiantes ←→ Cursos</td>
                            <td><code>Tabla pivot</code></td>
                        </tr>
                    </tbody>
                </table>
                <div class="tabla-info" id="infoRelacion">
                    Selecciona un tipo de relación para ver detalles de implementación
                </div>
            </div>
           
            <div class="relacion-ejemplos">
                <div class="ejemplo-detalle" id="detalle11" style="display: none;">
                    <h4>🔍 Implementación 1:1</h4>
                    <div class="analisis-content">
                        <div class="analisis-item">
                            <h5>📝 SQL Ejemplo</h5>
                            <pre><code>
CREATE TABLE usuarios (
    id INT PRIMARY KEY,
    email VARCHAR(100) UNIQUE
);
CREATE TABLE perfiles (
    id INT PRIMARY KEY,
    usuario_id INT UNIQUE,
    bio TEXT,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);
                            </code></pre>
                        </div>
                        <div class="analisis-item">
                            <h5>🎯 Casos de Uso</h5>
                            <ul>
                                <li>Usuario → Perfil (datos extendidos)</li>
                                <li>Producto → Detalles técnicos</li>
                                <li>Empleado → Datos confidenciales</li>
                            </ul>
                        </div>
                    </div>
                </div>
               
                <div class="ejemplo-detalle" id="detalle1N" style="display: none;">
                    <h4>🔍 Implementación 1:N</h4>
                    <div class="analisis-content">
                        <div class="analisis-item">
                            <h5>📝 SQL Ejemplo</h5>
                            <pre><code>
CREATE TABLE departamentos (
    id INT PRIMARY KEY,
    nombre VARCHAR(100)
);
CREATE TABLE empleados (
    id INT PRIMARY KEY,
    nombre VARCHAR(100),
    dept_id INT,
    FOREIGN KEY (dept_id) REFERENCES departamentos(id)
);
                            </code></pre>
                        </div>
                        <div class="analisis-item">
                            <h5>🎯 Casos de Uso</h5>
                            <ul>
                                <li>Departamento → Empleados</li>
                                <li>Categoría → Productos</li>
                                <li>Autor → Libros</li>
                            </ul>
                        </div>
                    </div>
                </div>
               
                <div class="ejemplo-detalle" id="detalleNN" style="display: none;">
                    <h4>🔍 Implementación N:N</h4>
                    <div class="analisis-content">
                        <div class="analisis-item">
                            <h5>📝 SQL Ejemplo</h5>
                            <pre><code>
CREATE TABLE estudiantes (
    id INT PRIMARY KEY,
    nombre VARCHAR(100)
);
CREATE TABLE cursos (
    id INT PRIMARY KEY,
    nombre VARCHAR(100)
);
CREATE TABLE estudiantes_cursos (
    estudiante_id INT,
    curso_id INT,
    fecha_inscripcion DATE,
    PRIMARY KEY (estudiante_id, curso_id),
    FOREIGN KEY (estudiante_id) REFERENCES estudiantes(id),
    FOREIGN KEY (curso_id) REFERENCES cursos(id)
);
                            </code></pre>
                        </div>
                        <div class="analisis-item">
                            <h5>🎯 Casos de Uso</h5>
                            <ul>
                                <li>Etiquetas → Artículos</li>
                                <li>Doctores → Pacientes</li>
                                <li>Ingredientes → Recetas</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- NORMALIZACIÓN -->
        <div class="subseccion">
            <h3>4. Normalización: 1NF → 3NF</h3>
            <p class="principio-clave">
                <strong>Objetivo:</strong> Eliminar redundancia, prevenir anomalías de inserción/actualización/eliminación
            </p>
           
            <div class="normalizacion-grid">
                <div class="nf-card" data-nf="1nf">
                    <div class="nf-header">
                        <div class="nf-badge">1NF</div>
                        <h4>Primera Forma Normal</h4>
                    </div>
                    <div class="nf-content">
                        <p><strong>Reglas:</strong></p>
                        <ul>
                            <li>Valores atómicos (una celda = un valor)</li>
                            <li>Sin columnas repetidas</li>
                            <li>Identificador único por fila</li>
                        </ul>
                        <div class="nf-ejemplo">
                            <strong>❌ Antes:</strong> <code>telefonos: "555-1234, 555-5678"</code><br>
                            <strong>✅ Después:</strong> Tabla separada de teléfonos
                        </div>
                    </div>
                </div>
               
                <div class="nf-card" data-nf="2nf">
                    <div class="nf-header">
                        <div class="nf-badge">2NF</div>
                        <h4>Segunda Forma Normal</h4>
                    </div>
                    <div class="nf-content">
                        <p><strong>Reglas:</strong></p>
                        <ul>
                            <li>Cumple 1NF</li>
                            <li>Sin dependencias parciales</li>
                            <li>Todos los atributos dependen de TODA la PK</li>
                        </ul>
                        <div class="nf-ejemplo">
                            <strong>❌ Antes:</strong> PK compuesta, algunos datos solo dependen de parte de la PK<br>
                            <strong>✅ Después:</strong> Separar en tablas por dependencia completa
                        </div>
                    </div>
                </div>
               
                <div class="nf-card" data-nf="3nf">
                    <div class="nf-header">
                        <div class="nf-badge">3NF</div>
                        <h4>Tercera Forma Normal</h4>
                    </div>
                    <div class="nf-content">
                        <p><strong>Reglas:</strong></p>
                        <ul>
                            <li>Cumple 2NF</li>
                            <li>Sin dependencias transitivas</li>
                            <li>Atributos no-PK no dependen de otros no-PK</li>
                        </ul>
                        <div class="nf-ejemplo">
                            <strong>❌ Antes:</strong> <code>empleado → departamento → ciudad</code><br>
                            <strong>✅ Después:</strong> Ciudad en tabla departamentos
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 3️⃣ SIMULADOR INTERACTIVO (SQL + ER) -->
    <section class="interactivos-section">
        <h2 class="seccion-titulo neon-interactivo">
            <span class="icon">🎮</span> SIMULADOR SQL Y CONSTRUCTOR ER
        </h2>

<style>
*{box-sizing:border-box;margin:0;padding:0}
body{font-family:var(--font-sans,sans-serif)}
.sim-wrap{padding:1rem 0;display:flex;flex-direction:column;gap:2rem}

/* ─── TABS ─── */
.tabs{display:flex;gap:0;border-bottom:0.5px solid var(--color-border-tertiary);margin-bottom:1.5rem}
.tab{padding:8px 18px;font-size:13px;cursor:pointer;border:none;background:none;color:var(--color-text-secondary);border-bottom:2px solid transparent;transition:all .15s}
.tab.active{color:var(--color-text-primary);border-bottom:2px solid var(--color-text-primary);font-weight:500}

/* ─── ER DIAGRAM ─── */
#er-panel{display:flex;gap:12px;height:580px}
.er-sidebar{width:220px;flex-shrink:0;display:flex;flex-direction:column;gap:10px}
.er-sidebar h3{font-size:12px;font-weight:500;color:var(--color-text-secondary);text-transform:uppercase;letter-spacing:.05em;margin-bottom:2px}
.er-canvas{flex:1;background:var(--color-background-secondary);border:0.5px solid var(--color-border-tertiary);border-radius:var(--border-radius-lg);position:relative;overflow:hidden;cursor:default}
.er-canvas svg{position:absolute;top:0;left:0;width:100%;height:100%;pointer-events:none}
.er-canvas svg .rel-line{pointer-events:none}

/* Table cards on canvas */
.db-table{position:absolute;background:var(--color-background-primary);border:1.5px solid var(--color-border-secondary);border-radius:8px;min-width:160px;cursor:move;user-select:none;box-shadow:0 2px 8px rgba(0,0,0,.08);z-index:10;transition:box-shadow .15s}
.db-table:hover{box-shadow:0 4px 16px rgba(0,0,0,.13);z-index:20}
.db-table.selected{border-color:var(--color-text-info);box-shadow:0 0 0 3px rgba(59,139,212,.18)}
.db-table-head{padding:7px 10px;font-size:12px;font-weight:500;background:var(--color-background-info);color:var(--color-text-info);border-radius:6px 6px 0 0;display:flex;justify-content:space-between;align-items:center;cursor:move}
.db-table-head .tname{max-width:110px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap}
.db-table-head .del-btn{width:16px;height:16px;border-radius:3px;border:none;background:rgba(255,255,255,.3);color:inherit;cursor:pointer;font-size:10px;display:flex;align-items:center;justify-content:center;opacity:.7;transition:opacity .1s;flex-shrink:0}
.db-table-head .del-btn:hover{opacity:1}
.db-table-body{padding:0}
.db-field{display:flex;align-items:center;padding:5px 10px;font-size:11px;border-top:0.5px solid var(--color-border-tertiary);gap:6px;cursor:default}
.db-field.pk{background:rgba(250,206,66,.09)}
.db-field.fk{background:rgba(59,139,212,.07)}
.db-field .fi{width:14px;height:14px;border-radius:3px;display:flex;align-items:center;justify-content:center;font-size:9px;flex-shrink:0;font-weight:700}
.db-field .fi.pk{background:#FAEEDA;color:#854F0B}
.db-field .fi.fk{background:#E6F1FB;color:#185FA5}
.db-field .fi.idx{background:#F1EFE8;color:#5F5E5A}
.db-field .fname{flex:1;color:var(--color-text-primary);white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
.db-field .ftype{color:var(--color-text-tertiary);font-size:10px;flex-shrink:0}
.db-field .port{width:8px;height:8px;border-radius:50%;border:1.5px solid var(--color-border-secondary);margin-left:auto;cursor:crosshair;flex-shrink:0;transition:background .1s}
.db-field .port:hover,.db-field .port.active{background:var(--color-background-info);border-color:var(--color-text-info)}
.add-field-row{display:flex;align-items:center;padding:4px 10px;font-size:10px;color:var(--color-text-tertiary);cursor:pointer;border-top:0.5px dashed var(--color-border-tertiary);gap:4px}
.add-field-row:hover{color:var(--color-text-secondary);background:var(--color-background-secondary)}

/* Sidebar controls */
.er-ctrl-card{background:var(--color-background-primary);border:0.5px solid var(--color-border-tertiary);border-radius:var(--border-radius-md);padding:10px}
.er-ctrl-card label{font-size:11px;color:var(--color-text-secondary);display:block;margin-bottom:4px}
.er-ctrl-card input,.er-ctrl-card select{width:100%;font-size:12px;padding:5px 8px;border:0.5px solid var(--color-border-secondary);border-radius:6px;background:var(--color-background-secondary);color:var(--color-text-primary)}
.er-ctrl-card input:focus,.er-ctrl-card select:focus{outline:none;border-color:var(--color-border-primary)}
.er-btn{width:100%;padding:7px 0;font-size:12px;font-weight:500;border:0.5px solid var(--color-border-secondary);border-radius:6px;background:var(--color-background-primary);color:var(--color-text-primary);cursor:pointer;transition:background .12s}
.er-btn:hover{background:var(--color-background-secondary)}
.er-btn.primary{background:var(--color-background-info);color:var(--color-text-info);border-color:var(--color-border-info)}
.er-btn.primary:hover{opacity:.85}
.er-btn.danger{color:var(--color-text-danger);border-color:var(--color-border-danger)}
.er-btn.danger:hover{background:var(--color-background-danger)}
.rel-badge{display:inline-flex;align-items:center;gap:4px;padding:2px 7px;border-radius:4px;font-size:10px;font-weight:500;cursor:pointer;border:0.5px solid var(--color-border-tertiary);background:var(--color-background-secondary);color:var(--color-text-secondary);transition:all .12s}
.rel-badge.active{background:var(--color-background-info);color:var(--color-text-info);border-color:var(--color-border-info)}
.rel-badges{display:flex;gap:4px;flex-wrap:wrap}
.schema-legend{font-size:10px;color:var(--color-text-tertiary);line-height:1.7}
.schema-legend span{display:inline-flex;align-items:center;gap:4px;margin-right:8px}

/* ─── SQL SIMULATOR ─── */
#sql-panel{display:flex;flex-direction:column;gap:12px}
.sql-row{display:flex;gap:12px}
.sql-editor-box{flex:1;background:var(--color-background-primary);border:0.5px solid var(--color-border-tertiary);border-radius:var(--border-radius-lg);overflow:hidden}
.sql-editor-header{display:flex;justify-content:space-between;align-items:center;padding:8px 12px;border-bottom:0.5px solid var(--color-border-tertiary);background:var(--color-background-secondary)}
.sql-editor-header span{font-size:12px;font-weight:500;color:var(--color-text-secondary)}
.sql-editor-header .hbtns{display:flex;gap:6px}
.hbtn{padding:4px 10px;font-size:11px;border:0.5px solid var(--color-border-secondary);border-radius:5px;background:transparent;color:var(--color-text-secondary);cursor:pointer;transition:background .1s}
.hbtn:hover{background:var(--color-background-secondary)}
.sql-textarea{width:100%;padding:12px;font-family:var(--font-mono,monospace);font-size:12px;border:none;outline:none;background:transparent;color:var(--color-text-primary);resize:none;line-height:1.6;min-height:160px}
.sql-footer{display:flex;gap:8px;padding:8px 12px;border-top:0.5px solid var(--color-border-tertiary);background:var(--color-background-secondary)}
.sql-run{padding:6px 16px;font-size:12px;font-weight:500;background:var(--color-background-success);color:var(--color-text-success);border:0.5px solid var(--color-border-success);border-radius:6px;cursor:pointer}
.sql-run:hover{opacity:.85}
.sql-clear{padding:6px 12px;font-size:12px;border:0.5px solid var(--color-border-secondary);border-radius:6px;background:transparent;color:var(--color-text-secondary);cursor:pointer}
.sql-clear:hover{background:var(--color-background-secondary)}
.sql-shortcuts{width:200px;flex-shrink:0;display:flex;flex-direction:column;gap:6px}
.sql-shortcuts h4{font-size:11px;font-weight:500;color:var(--color-text-secondary);text-transform:uppercase;letter-spacing:.05em}
.sq-btn{padding:6px 8px;font-size:11px;border:0.5px solid var(--color-border-tertiary);border-radius:6px;background:var(--color-background-primary);color:var(--color-text-primary);cursor:pointer;text-align:left;transition:background .1s;font-family:var(--font-mono,monospace)}
.sq-btn:hover{background:var(--color-background-secondary)}
.sql-result-box{background:var(--color-background-primary);border:0.5px solid var(--color-border-tertiary);border-radius:var(--border-radius-lg);overflow:hidden}
.sql-result-header{display:flex;justify-content:space-between;align-items:center;padding:8px 12px;border-bottom:0.5px solid var(--color-border-tertiary);background:var(--color-background-secondary)}
.sql-result-header span{font-size:12px;font-weight:500;color:var(--color-text-secondary)}
.result-stats{font-size:11px;color:var(--color-text-tertiary)}
.result-table-wrap{overflow:auto;max-height:220px}
.result-table{width:100%;border-collapse:collapse;font-size:12px}
.result-table th{padding:6px 12px;text-align:left;background:var(--color-background-secondary);border-bottom:0.5px solid var(--color-border-tertiary);font-weight:500;color:var(--color-text-secondary);font-size:11px;white-space:nowrap}
.result-table td{padding:6px 12px;border-bottom:0.5px solid var(--color-border-tertiary);color:var(--color-text-primary);white-space:nowrap}
.result-table tr:hover td{background:var(--color-background-secondary)}
.result-table tr:last-child td{border-bottom:none}
.null-val{color:var(--color-text-tertiary);font-style:italic}
.result-placeholder{padding:2rem;text-align:center;color:var(--color-text-tertiary);font-size:13px}
.sql-analysis{display:flex;gap:10px;margin-top:0}
.analysis-card{flex:1;background:var(--color-background-primary);border:0.5px solid var(--color-border-tertiary);border-radius:var(--border-radius-md);padding:10px}
.analysis-card h4{font-size:11px;font-weight:500;color:var(--color-text-secondary);margin-bottom:8px;text-transform:uppercase;letter-spacing:.04em}
.plan-step{display:flex;align-items:flex-start;gap:6px;font-size:11px;padding:3px 0;color:var(--color-text-primary)}
.plan-num{width:16px;height:16px;border-radius:3px;background:var(--color-background-info);color:var(--color-text-info);display:flex;align-items:center;justify-content:center;font-size:9px;font-weight:700;flex-shrink:0;margin-top:1px}
.tip-item{display:flex;align-items:flex-start;gap:6px;font-size:11px;padding:3px 0;color:var(--color-text-primary)}
.tip-dot{width:6px;height:6px;border-radius:50%;background:var(--color-background-success);border:1.5px solid var(--color-border-success);flex-shrink:0;margin-top:3px}
.warn-dot{background:var(--color-background-warning);border-color:var(--color-border-warning)}
.metric-row{display:flex;justify-content:space-between;align-items:center;font-size:11px;padding:3px 0;border-bottom:0.5px solid var(--color-border-tertiary)}
.metric-row:last-child{border-bottom:none}
.metric-row .ml{color:var(--color-text-secondary)}
.metric-row .mv{font-weight:500;color:var(--color-text-primary);font-family:var(--font-mono,monospace);font-size:11px}
.db-selector{display:flex;gap:6px;flex-wrap:wrap}
.db-pill{padding:4px 10px;font-size:11px;border:0.5px solid var(--color-border-tertiary);border-radius:20px;cursor:pointer;background:var(--color-background-primary);color:var(--color-text-secondary);transition:all .12s}
.db-pill.active{background:var(--color-background-info);color:var(--color-text-info);border-color:var(--color-border-info)}
.error-msg{color:var(--color-text-danger);font-size:12px;padding:12px;font-family:var(--font-mono,monospace)}
</style>

<div class="sim-wrap">
  <div class="tabs">
    <button class="tab active" onclick="showTab(\'er\')">ER Diagram Builder</button>
    <button class="tab" onclick="showTab(\'sql\')">SQL Simulator</button>
  </div>

  <!-- ER PANEL -->
  <div id="er-panel">
    <div class="er-sidebar">
      <h3>Nueva Tabla</h3>
      <div class="er-ctrl-card">
        <label>Nombre de tabla</label>
        <input id="tbl-name" placeholder="ej. clientes" onkeydown="if(event.key===\'Enter\')addTable()">
        <div style="margin-top:8px">
          <button class="er-btn primary" onclick="addTable()">+ Agregar tabla</button>
        </div>
      </div>

      <h3 style="margin-top:4px">Relación</h3>
      <div class="er-ctrl-card">
        <label>Tipo</label>
        <div class="rel-badges" id="rel-type-badges">
          <span class="rel-badge active" onclick="setRelType(\'1:1\',this)">1:1</span>
          <span class="rel-badge" onclick="setRelType(\'1:N\',this)">1:N</span>
          <span class="rel-badge" onclick="setRelType(\'N:N\',this)">N:N</span>
        </div>
        <div style="margin-top:8px;font-size:11px;color:var(--color-text-tertiary)" id="rel-hint">Haz clic en el puerto (●) de un campo PK para iniciar una relación</div>
        <div style="margin-top:8px" id="rel-status"></div>
      </div>

      <div class="er-ctrl-card" style="margin-top:auto">
        <div class="schema-legend">
          <span><span style="background:#FAEEDA;color:#854F0B;padding:1px 4px;border-radius:3px;font-size:10px;font-weight:700">PK</span> Primary Key</span>
          <span><span style="background:#E6F1FB;color:#185FA5;padding:1px 4px;border-radius:3px;font-size:10px;font-weight:700">FK</span> Foreign Key</span>
          <span><span style="background:#F1EFE8;color:#5F5E5A;padding:1px 4px;border-radius:3px;font-size:10px;font-weight:700">IDX</span> Índice</span>
        </div>
        <div style="margin-top:8px">
          <button class="er-btn" onclick="loadPreset(\'ecommerce\')">Cargar E-commerce</button>
        </div>
        <div style="margin-top:6px">
          <button class="er-btn" onclick="loadPreset(\'universidad\')">Cargar Universidad</button>
        </div>
        <div style="margin-top:6px">
          <button class="er-btn danger" onclick="clearAll()">Limpiar todo</button>
        </div>
      </div>
    </div>

    <div class="er-canvas" id="er-canvas">
      <svg id="er-svg" xmlns="http://www.w3.org/2000/svg"></svg>
    </div>
  </div>

  <!-- SQL PANEL -->
  <div id="sql-panel" style="display:none">
    <div style="display:flex;gap:10px;align-items:center;flex-wrap:wrap">
      <span style="font-size:12px;font-weight:500;color:var(--color-text-secondary)">Base de datos:</span>
      <div class="db-selector">
        <span class="db-pill active" onclick="setDB(\'ecommerce\',this)">E-commerce</span>
        <span class="db-pill" onclick="setDB(\'universidad\',this)">Universidad</span>
        <span class="db-pill" onclick="setDB(\'hospital\',this)">Hospital</span>
        <span class="db-pill" onclick="setDB(\'banco\',this)">Banco</span>
      </div>
      <span style="font-size:11px;color:var(--color-text-tertiary);margin-left:4px" id="db-schema-label">Tablas: usuarios, productos, pedidos, categorias</span>
    </div>

    <div class="sql-row">
      <div class="sql-editor-box">
        <div class="sql-editor-header">
          <span>Editor SQL</span>
          <div class="hbtns">
            <button class="hbtn" onclick="formatSQL()">Formatear</button>
            <button class="hbtn" onclick="explainSQL()">Explicar</button>
          </div>
        </div>
        <textarea class="sql-textarea" id="sql-input" rows="8" spellcheck="false">SELECT * FROM usuarios LIMIT 10;</textarea>
        <div class="sql-footer">
          <button class="sql-run" onclick="runSQL()">▶ Ejecutar</button>
          <button class="sql-clear" onclick="clearSQL()">Limpiar</button>
        </div>
      </div>
      <div class="sql-shortcuts">
        <h4>Ejemplos</h4>
        <button class="sq-btn" onclick="loadQ(0)">SELECT básico</button>
        <button class="sq-btn" onclick="loadQ(1)">JOIN usuarios-pedidos</button>
        <button class="sq-btn" onclick="loadQ(2)">GROUP BY + HAVING</button>
        <button class="sq-btn" onclick="loadQ(3)">Subconsulta</button>
        <button class="sq-btn" onclick="loadQ(4)">Agregar registro</button>
        <button class="sq-btn" onclick="loadQ(5)">LEFT JOIN</button>
        <button class="sq-btn" onclick="loadQ(6)">ORDER + LIMIT</button>
        <button class="sq-btn" onclick="loadQ(7)">COUNT por grupo</button>
      </div>
    </div>

    <div class="sql-result-box">
      <div class="sql-result-header">
        <span>Resultados</span>
        <span class="result-stats" id="result-stats"></span>
      </div>
      <div class="result-table-wrap" id="result-area">
        <div class="result-placeholder">Escribe una consulta y pulsa Ejecutar</div>
      </div>
    </div>

    <div class="sql-analysis" id="sql-analysis">
      <div class="analysis-card" id="exec-plan-card">
        <h4>Plan de ejecución</h4>
        <div id="exec-plan"><span style="font-size:11px;color:var(--color-text-tertiary)">Esperando consulta...</span></div>
      </div>
      <div class="analysis-card">
        <h4>Métricas</h4>
        <div id="sql-metrics">
          <div class="metric-row"><span class="ml">Tiempo estimado</span><span class="mv" id="m-time">—</span></div>
          <div class="metric-row"><span class="ml">Filas escaneadas</span><span class="mv" id="m-rows">—</span></div>
          <div class="metric-row"><span class="ml">Índice usado</span><span class="mv" id="m-idx">—</span></div>
          <div class="metric-row"><span class="ml">Costo relativo</span><span class="mv" id="m-cost">—</span></div>
        </div>
      </div>
      <div class="analysis-card">
        <h4>Consejos</h4>
        <div id="sql-tips"><span style="font-size:11px;color:var(--color-text-tertiary)">Esperando consulta...</span></div>
      </div>
    </div>
  </div>
</div>
    </section>

    <!-- 4️⃣ QUIZ AUTOEVALUADO CON FEEDBACK -->
    <section class="quiz-section">
        <h2 class="seccion-titulo neon-evaluacion">
            <span class="icon">❓</span> QUIZ AUTOEVALUADO CON FEEDBACK
        </h2>
       
        <div class="quiz-container">
            <!-- PREGUNTA 1 -->
            <div class="quiz-question" data-correct="B">
                <div class="quiz-header">
                    <span class="quiz-num">01</span>
                    <h3>¿Cuál es el propósito principal de la normalización?</h3>
                </div>
               
                <div class="quiz-options">
                    <button class="quiz-option" data-value="A">
                        <span class="option-letter">A</span>
                        Hacer las consultas más lentas
                    </button>
                    <button class="quiz-option" data-value="B">
                        <span class="option-letter">B</span>
                        Eliminar redundancia y prevenir anomalías
                    </button>
                    <button class="quiz-option" data-value="C">
                        <span class="option-letter">C</span>
                        Aumentar el número de tablas innecesariamente
                    </button>
                    <button class="quiz-option" data-value="D">
                        <span class="option-letter">D</span>
                        Hacer que los datos sean más difíciles de entender
                    </button>
                </div>
               
                <div class="quiz-feedback" style="display: none;">
                    <div class="feedback-correct">
                        ✅ <strong>Correcto:</strong> La normalización elimina redundancia y previene anomalías.
                    </div>
                    <div class="feedback-incorrect">
                        ❌ <strong>Incorrecto:</strong> La normalización tiene objetivos específicos de diseño.
                    </div>
                    <div class="feedback-explicacion">
                        <p><strong>Explicación:</strong> La normalización (1NF-3NF) busca: 1) Eliminar duplicación de datos, 2) Prevenir anomalías de inserción/actualización/eliminación, 3) Garantizar dependencias lógicas adecuadas entre datos.</p>
                    </div>
                </div>
            </div>
           
            <!-- PREGUNTA 2 -->
            <div class="quiz-question" data-correct="C">
                <div class="quiz-header">
                    <span class="quiz-num">02</span>
                    <h3>En una relación 1:N, ¿dónde debe ir la FK?</h3>
                </div>
               
                <div class="quiz-options">
                    <button class="quiz-option" data-value="A">
                        <span class="option-letter">A</span>
                        En la tabla del "uno"
                    </button>
                    <button class="quiz-option" data-value="B">
                        <span class="option-letter">B</span>
                        En ambas tablas
                    </button>
                    <button class="quiz-option" data-value="C">
                        <span class="option-letter">C</span>
                        En la tabla del "muchos"
                    </button>
                    <button class="quiz-option" data-value="D">
                        <span class="option-letter">D</span>
                        En una tabla intermedia
                    </button>
                </div>
               
                <div class="quiz-feedback" style="display: none;">
                    <div class="feedback-correct">
                        ✅ <strong>Correcto:</strong> La FK va en la tabla que representa el lado "muchos".
                    </div>
                    <div class="feedback-incorrect">
                        ❌ <strong>Incorrecto:</strong> Revisa cómo se implementan las cardinalidades.
                    </div>
                    <div class="feedback-explicacion">
                        <p><strong>Regla:</strong> En 1:N, la tabla "muchos" contiene la FK que referencia a la PK de la tabla "uno". Ejemplo: En "Departamentos (1) ← Empleados (N)", la FK <code>dept_id</code> va en la tabla <code>empleados</code>.</p>
                    </div>
                </div>
            </div>
           
            <!-- PREGUNTA 3 -->
            <div class="quiz-question" data-correct="D">
                <div class="quiz-header">
                    <span class="quiz-num">03</span>
                    <h3>¿Qué SQL usa una subconsulta?</h3>
                </div>
               
                <div class="quiz-options">
                    <button class="quiz-option" data-value="A">
                        <span class="option-letter">A</span>
                        <code>SELECT * FROM (SELECT ...)</code>
                    </button>
                    <button class="quiz-option" data-value="B">
                        <span class="option-letter">B</span>
                        <code>WHERE id IN (SELECT ...)</code>
                    </button>
                    <button class="quiz-option" data-value="C">
                        <span class="option-letter">C</span>
                        <code>FROM (SELECT ...) AS subquery</code>
                    </button>
                    <button class="quiz-option" data-value="D">
                        <span class="option-letter">D</span>
                        Todas las anteriores
                    </button>
                </div>
               
                <div class="quiz-feedback" style="display: none;">
                    <div class="feedback-correct">
                        ✅ <strong>Correcto:</strong> Todas son formas válidas de usar subconsultas.
                    </div>
                    <div class="feedback-incorrect">
                        ❌ <strong>Incorrecto:</strong> Las subconsultas son versátiles y pueden usarse en varios lugares.
                    </div>
                    <div class="feedback-explicacion">
                        <p><strong>Tipos de subconsultas:</strong><br>
                        1. <strong>En FROM:</strong> <code>FROM (SELECT ...) AS sub</code><br>
                        2. <strong>En WHERE:</strong> <code>WHERE id IN (SELECT ...)</code><br>
                        3. <strong>En SELECT:</strong> <code>SELECT col, (SELECT ...) AS calc</code></p>
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

    <!-- 6️⃣ SECCIÓN "ERRORES COMUNES" INTERACTIVA -->
    <section class="errores-section">
        <h2 class="seccion-titulo neon-alerta">
            <span class="icon">⚠️</span> ERRORES COMUNES INTERACTIVOS
        </h2>
        <div class="errores-container">
            <div class="error-card collapsible">
                <div class="error-header">
                    <h3>Error 1: Olvidar Integridad Referencial</h3>
                    <div class="collapse-icon">+</div>
                </div>
                <div class="error-content" style="display: none;">
                    <div class="error-ejemplo">
                        <pre><code>
-- ❌ Mal
INSERT INTO pedidos (usuario_id) VALUES (999); -- Usuario no existe
                        </code></pre>
                    </div>
                    <div class="error-explicacion">
                        <p>Esto causa datos huérfanos. Solución: Usar FK con ON DELETE RESTRICT.</p>
                    </div>
                    <div class="error-practica">
                        <p>Prueba: Corrige el código</p>
                        <textarea class="practica-input" placeholder="Escribe la corrección..."></textarea>
                        <button class="btn-verificar" onclick="verificarError(1, this)">Verificar</button>
                        <div class="practica-feedback"></div>
                    </div>
                </div>
            </div>
            <div class="error-card collapsible">
                <div class="error-header">
                    <h3>Error 2: Normalización Insuficiente</h3>
                    <div class="collapse-icon">+</div>
                </div>
                <div class="error-content" style="display: none;">
                    <div class="error-ejemplo">
                        <pre><code>
-- ❌ Mal
CREATE TABLE empleados (
    id INT PRIMARY KEY,
    nombre VARCHAR(100),
    dept_nombre VARCHAR(100) -- Redundante si dept cambia
);
                        </code></pre>
                    </div>
                    <div class="error-explicacion">
                        <p>Causa anomalías de actualización. Solución: Separar en tabla departamentos.</p>
                    </div>
                    <div class="error-practica">
                        <p>Prueba: Corrige el esquema</p>
                        <textarea class="practica-input" placeholder="Escribe la corrección..."></textarea>
                        <button class="btn-verificar" onclick="verificarError(2, this)">Verificar</button>
                        <div class="practica-feedback"></div>
                    </div>
                </div>
            </div>
            <div class="error-card collapsible">
                <div class="error-header">
                    <h3>Error 3: JOIN sin WHERE</h3>
                    <div class="collapse-icon">+</div>
                </div>
                <div class="error-content" style="display: none;">
                    <div class="error-ejemplo">
                        <pre><code>
-- ❌ Mal
SELECT * FROM usuarios u JOIN pedidos p ON u.id = p.usuario_id; -- Producto cartesiano
                        </code></pre>
                    </div>
                    <div class="error-explicacion">
                        <p>Causa resultados masivos. Solución: Añadir filtros WHERE.</p>
                    </div>
                    <div class="error-practica">
                        <p>Prueba: Añade un filtro</p>
                        <textarea class="practica-input" placeholder="Escribe la corrección..."></textarea>
                        <button class="btn-verificar" onclick="verificarError(3, this)">Verificar</button>
                        <div class="practica-feedback"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 7️⃣ PROBLEMAS TIPO EXAMEN -->
    <section class="problemas-section">
        <h2 class="seccion-titulo neon-evaluacion">
            <span class="icon">📝</span> PROBLEMAS TIPO EXAMEN
        </h2>
        <div class="problemas-container">
            <div class="problema-card">
                <h3>Problema 1 (Desarrollo)</h3>
                <p>Diseña un esquema SQL para un sistema de e-commerce con usuarios, productos y pedidos. Incluye relaciones y normalización.</p>
                <textarea class="respuesta-area" placeholder="Escribe tu desarrollo..."></textarea>
                <div class="rubrica">
                    <p>Rúbrica: 40% Normalización, 30% Relaciones, 30% Sintaxis</p>
                </div>
            </div>
            <div class="problema-card">
                <h3>Problema 2 (Interpretación)</h3>
                <p>Dada la consulta: <code>SELECT COUNT(*) FROM pedidos GROUP BY usuario_id HAVING COUNT(*) > 5;</code> Interpreta qué hace y optimízala.</p>
                <textarea class="respuesta-area" placeholder="Escribe tu interpretación..."></textarea>
                <div class="rubrica">
                    <p>Rúbrica: 50% Interpretación, 50% Optimización</p>
                </div>
            </div>
            <div class="problema-card">
                <h3>Problema 3 (Razonamiento)</h3>
                <p>Justifica por qué usar N:N para estudiantes-cursos en lugar de 1:N.</p>
                <textarea class="respuesta-area" placeholder="Escribe tu justificación..."></textarea>
                <div class="rubrica">
                    <p>Rúbrica: 60% Lógica Relacional, 40% Ejemplos</p>
                </div>
            </div>
        </div>
    </section>

    <!-- 8️⃣ CIERRE METACOGNITIVO INTERACTIVO -->
    <section class="cierre-section">
        <h2 class="seccion-titulo neon-concepto">
            <span class="icon">🧠</span> CIERRE METACOGNITIVO INTERACTIVO
        </h2>
       
        <div class="cierre-container">
            <div class="autoevaluacion">
                <h3>📊 AUTOEVALUACIÓN DE HABILIDADES SQL</h3>
                <div class="skill-meter">
                    <div class="skill-item">
                        <span>Consultas SELECT básicas:</span>
                        <div class="skill-bar">
                            <div class="skill-fill" data-level="0" style="width: 0%"></div>
                        </div>
                        <input type="range" min="0" max="100" value="0" class="skill-slider" data-skill="select">
                    </div>
                   
                    <div class="skill-item">
                        <span>JOINs y relaciones:</span>
                        <div class="skill-bar">
                            <div class="skill-fill" data-level="0" style="width: 0%"></div>
                        </div>
                        <input type="range" min="0" max="100" value="0" class="skill-slider" data-skill="joins">
                    </div>
                   
                    <div class="skill-item">
                        <span>Normalización (1NF-3NF):</span>
                        <div class="skill-bar">
                            <div class="skill-fill" data-level="0" style="width: 0%"></div>
                        </div>
                        <input type="range" min="0" max="100" value="0" class="skill-slider" data-skill="normalizacion">
                    </div>
                   
                    <div class="skill-item">
                        <span>Diseño de esquemas:</span>
                        <div class="skill-bar">
                            <div class="skill-fill" data-level="0" style="width: 0%"></div>
                        </div>
                        <input type="range" min="0" max="100" value="0" class="skill-slider" data-skill="diseno">
                    </div>
                </div>
               
                <button class="btn-guardar" onclick="guardarHabilidades()">
                    💾 GUARDAR EVALUACIÓN
                </button>
            </div>
           
            <div class="reflexion">
                <h3>💭 REFLEXIÓN GUIADA</h3>
                <div class="pregunta-reflexion">
                    <p>¿Por qué es importante entender la normalización antes de escribir consultas SQL complejas?</p>
                    <textarea placeholder="Escribe tu reflexión aquí..." rows="3" id="reflexion1"></textarea>
                </div>
                <div class="pregunta-reflexion">
                    <p>Describe un caso real donde una mala elección de tipo de relación (1:1 vs 1:N) podría causar problemas.</p>
                    <textarea placeholder="Escribe tu ejemplo..." rows="3" id="reflexion2"></textarea>
                </div>
            </div>
        </div>
       
        <div class="proyecto-final">
            <h3>🎯 PROYECTO FINAL: SISTEMA DE BIBLIOTECA</h3>
            <div class="proyecto-enunciado">
                <p><strong>Objetivo:</strong> Diseñar e implementar una base de datos para una biblioteca con:</p>
                <ul>
                    <li>Libros (título, autor, ISBN, categoría, ejemplares)</li>
                    <li>Usuarios (nombre, email, tipo: estudiante/profesor)</li>
                    <li>Préstamos (libro_id, usuario_id, fecha_préstamo, fecha_devolución)</li>
                    <li>Multas (por retraso en devolución)</li>
                </ul>
                <p><strong>Requisitos:</strong> Normalización 3NF, relaciones apropiadas, al menos 5 consultas útiles.</p>
            </div>
            <button class="btn-proyecto" onclick="mostrarEsqueletoProyecto()">
                📝 VER ESQUELETO DEL PROYECTO
            </button>
            <div class="proyecto-solucion" id="proyectoSolucion" style="display: none;">
                <pre><code>
-- ESQUEMA COMPLETO BIBLIOTECA
CREATE TABLE libros (
    id INT PRIMARY KEY,
    titulo VARCHAR(200),
    autor VARCHAR(100),
    isbn VARCHAR(13) UNIQUE,
    categoria VARCHAR(50),
    ejemplares_disponibles INT
);
CREATE TABLE usuarios (
    id INT PRIMARY KEY,
    nombre VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    tipo ENUM(\'estudiante\', \'profesor\')
);
CREATE TABLE prestamos (
    id INT PRIMARY KEY,
    libro_id INT REFERENCES libros(id),
    usuario_id INT REFERENCES usuarios(id),
    fecha_prestamo DATE,
    fecha_devolucion_esperada DATE,
    fecha_devolucion_real DATE,
    INDEX idx_usuario (usuario_id),
    INDEX idx_libro (libro_id)
);
-- CONSULTAS ÚTILES:
-- 1. Libros prestados actualmente
-- 2. Usuarios con multas pendientes
-- 3. Libros más populares
-- 4. Tasa de devolución a tiempo
-- 5. Sugerencias por categoría
                </code></pre>
            </div>
        </div>
       
        <div class="recursos">
            <h3>🔗 RECURSOS ADICIONALES</h3>
            <div class="recursos-links">
                <a href="https://sqlbolt.com/" target="_blank" class="recurso-link">
                    ⚡ SQLBolt: Tutoriales interactivos SQL
                </a>
                <a href="https://www.db-fiddle.com/" target="_blank" class="recurso-link">
                    🎮 DB Fiddle: Sandbox SQL online
                </a>
                <a href="https://drawsql.app/" target="_blank" class="recurso-link">
                    📐 DrawSQL: Diseñador de diagramas ER
                </a>
                <a href="https://use-the-index-luke.com/" target="_blank" class="recurso-link">
                    🚀 Use The Index, Luke: Optimización SQL
                </a>
            </div>
        </div>
    </section>
</div>

<script>
console.log(\'🚀 Inicializando lección Bases de Datos Relacionales\');

// ══════════════════════════════════════════════
// STATE
// ══════════════════════════════════════════════
let tables = [];
let relations = [];
let tid = 0;
let relMode = \'1:1\';
let relSource = null; // {tableId, fieldName}
let dragging = null;
let dragOff = {x:0,y:0};
let currentDB = \'ecommerce\';

// ══════════════════════════════════════════════
// TAB SWITCHING
// ══════════════════════════════════════════════
function showTab(t){
  document.querySelectorAll(\'.tab\').forEach((b,i)=>b.classList.toggle(\'active\',[\'er\',\'sql\'][i]===t));
  document.getElementById(\'er-panel\').style.display = t===\'er\'?\'flex\':\'none\';
  document.getElementById(\'sql-panel\').style.display = t===\'sql\'?\'flex\':\'none\';
}

// ══════════════════════════════════════════════
// ER: DATA
// ══════════════════════════════════════════════
function setRelType(t,el){
  relMode = t;
  document.querySelectorAll(\'.rel-badge\').forEach(b=>b.classList.remove(\'active\'));
  el.classList.add(\'active\');
}

function addTable(name, fields, x, y){
  const n = name || document.getElementById(\'tbl-name\').value.trim();
  if(!n) return;
  if(!name) document.getElementById(\'tbl-name\').value=\'\';
  const defaultFields = fields || [
    {name:\'id\',type:\'INT\',key:\'pk\'},
    {name:\'nombre\',type:\'VARCHAR(100)\',key:\'\'},
    {name:\'created_at\',type:\'DATETIME\',key:\'\'},
  ];
  tables.push({id:tid++, name:n, fields:defaultFields, x:x||Math.random()*320+60, y:y||Math.random()*200+60});
  renderER();
}

function deleteTable(id){
  tables = tables.filter(t=>t.id!==id);
  relations = relations.filter(r=>r.from.tableId!==id && r.to.tableId!==id);
  renderER();
}

function addField(tableId){
  const t = tables.find(t=>t.id===tableId);
  if(!t) return;
  const name = prompt(\'Nombre del campo:\',\'campo_nuevo\');
  if(!name) return;
  const type = prompt(\'Tipo:\',\'VARCHAR(100)\');
  t.fields.push({name, type:type||\'VARCHAR(100)\', key:\'\'});
  renderER();
}

function clearAll(){
  tables=[];relations=[];tid=0;relSource=null;
  document.getElementById(\'rel-status\').innerHTML=\'\';
  renderER();
}

function loadPreset(p){
  clearAll();
  if(p===\'ecommerce\'){
    addTable(\'usuarios\',[
      {name:\'id\',type:\'INT\',key:\'pk\'},
      {name:\'email\',type:\'VARCHAR(100)\',key:\'idx\'},
      {name:\'nombre\',type:\'VARCHAR(100)\',key:\'\'},
      {name:\'created_at\',type:\'DATETIME\',key:\'\'},
    ],50,50);
    addTable(\'categorias\',[
      {name:\'id\',type:\'INT\',key:\'pk\'},
      {name:\'nombre\',type:\'VARCHAR(50)\',key:\'\'},
    ],360,50);
    addTable(\'productos\',[
      {name:\'id\',type:\'INT\',key:\'pk\'},
      {name:\'nombre\',type:\'VARCHAR(200)\',key:\'\'},
      {name:\'precio\',type:\'DECIMAL(10,2)\',key:\'\'},
      {name:\'categoria_id\',type:\'INT\',key:\'fk\'},
    ],360,250);
    addTable(\'pedidos\',[
      {name:\'id\',type:\'INT\',key:\'pk\'},
      {name:\'usuario_id\',type:\'INT\',key:\'fk\'},
      {name:\'total\',type:\'DECIMAL(10,2)\',key:\'\'},
      {name:\'fecha\',type:\'DATETIME\',key:\'idx\'},
    ],50,280);
    addTable(\'pedido_items\',[
      {name:\'id\',type:\'INT\',key:\'pk\'},
      {name:\'pedido_id\',type:\'INT\',key:\'fk\'},
      {name:\'producto_id\',type:\'INT\',key:\'fk\'},
      {name:\'cantidad\',type:\'INT\',key:\'\'},
      {name:\'precio\',type:\'DECIMAL(10,2)\',key:\'\'},
    ],200,480);
    relations = [
      {from:{tableId:1,fieldName:\'categoria_id\'},to:{tableId:0,fieldName:\'id\'},type:\'N:1\'},
      {from:{tableId:1,fieldName:\'id\'},to:{tableId:2,fieldName:\'categoria_id\'},type:\'1:N\'},
      {from:{tableId:2,fieldName:\'usuario_id\'},to:{tableId:0,fieldName:\'id\'},type:\'N:1\'},
      {from:{tableId:4,fieldName:\'pedido_id\'},to:{tableId:2,fieldName:\'id\'},type:\'N:1\'},
      {from:{tableId:4,fieldName:\'producto_id\'},to:{tableId:1,fieldName:\'id\'},type:\'N:1\'},
    ];
  } else {
    addTable(\'estudiantes\',[
      {name:\'id\',type:\'INT\',key:\'pk\'},
      {name:\'nombre\',type:\'VARCHAR(100)\',key:\'\'},
      {name:\'email\',type:\'VARCHAR(100)\',key:\'idx\'},
    ],50,80);
    addTable(\'profesores\',[
      {name:\'id\',type:\'INT\',key:\'pk\'},
      {name:\'nombre\',type:\'VARCHAR(100)\',key:\'\'},
      {name:\'depto\',type:\'VARCHAR(50)\',key:\'\'},
    ],360,80);
    addTable(\'cursos\',[
      {name:\'id\',type:\'INT\',key:\'pk\'},
      {name:\'nombre\',type:\'VARCHAR(150)\',key:\'\'},
      {name:\'profesor_id\',type:\'INT\',key:\'fk\'},
      {name:\'creditos\',type:\'INT\',key:\'\'},
    ],360,280);
    addTable(\'inscripciones\',[
      {name:\'estudiante_id\',type:\'INT\',key:\'fk\'},
      {name:\'curso_id\',type:\'INT\',key:\'fk\'},
      {name:\'nota\',type:\'DECIMAL(4,2)\',key:\'\'},
      {name:\'fecha\',type:\'DATE\',key:\'\'},
    ],50,280);
    relations = [
      {from:{tableId:2,fieldName:\'profesor_id\'},to:{tableId:1,fieldName:\'id\'},type:\'N:1\'},
      {from:{tableId:3,fieldName:\'estudiante_id\'},to:{tableId:0,fieldName:\'id\'},type:\'N:1\'},
      {from:{tableId:3,fieldName:\'curso_id\'},to:{tableId:2,fieldName:\'id\'},type:\'N:1\'},
    ];
  }
  renderER();
}

// ══════════════════════════════════════════════
// ER: RENDERING
// ══════════════════════════════════════════════
function renderER(){
  const canvas = document.getElementById(\'er-canvas\');
  const svg = document.getElementById(\'er-svg\');
  // remove old table divs
  canvas.querySelectorAll(\'.db-table\').forEach(e=>e.remove());
  // render tables
  tables.forEach(t=>{
    const div = document.createElement(\'div\');
    div.className = \'db-table\';
    div.id = \'tbl-\'+t.id;
    div.style.left = t.x+\'px\';
    div.style.top = t.y+\'px\';
    div.innerHTML = `
      <div class="db-table-head" onmousedown="startDrag(event,${t.id})">
        <span class="tname">${t.name}</span>
        <button class="del-btn" onclick="event.stopPropagation();deleteTable(${t.id})">✕</button>
      </div>
      <div class="db-table-body">
        ${t.fields.map(f=>`
          <div class="db-field ${f.key}">
            <span class="fi ${f.key||\'idx\'}">${f.key?f.key.toUpperCase():\'·\'}</span>
            <span class="fname">${f.name}</span>
            <span class="ftype">${f.type}</span>
            <span class="port" data-tid="${t.id}" data-field="${f.name}" onclick="handlePort(event,${t.id},\'${f.name}\')"></span>
          </div>`).join(\'\')}
        <div class="add-field-row" onclick="addField(${t.id})">+ añadir campo</div>
      </div>`;
    canvas.appendChild(div);
  });
  // draw SVG relations
  renderRelations();
  // placeholder
  if(tables.length===0){
    const info = document.createElement(\'div\');
    info.style.cssText=\'position:absolute;inset:0;display:flex;align-items:center;justify-content:center;color:var(--color-text-tertiary);font-size:13px;pointer-events:none;flex-direction:column;gap:8px\';
    info.innerHTML=\'<div style="font-size:24px;opacity:.3">⊡</div><div>Agrega tablas desde el panel o carga un preset</div>\';
    canvas.appendChild(info);
  }
}

function renderRelations(){
  const svg = document.getElementById(\'er-svg\');
  svg.innerHTML = `<defs>
    <marker id="arr-n" markerWidth="8" markerHeight="8" refX="7" refY="4" orient="auto">
      <path d="M1 1 L7 4 L1 7" fill="none" stroke="#378ADD" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
    </marker>
    <marker id="arr-1" markerWidth="8" markerHeight="8" refX="7" refY="4" orient="auto">
      <line x1="5" y1="1" x2="5" y2="7" stroke="#1D9E75" stroke-width="1.5" stroke-linecap="round"/>
      <path d="M1 1 L7 4 L1 7" fill="none" stroke="#1D9E75" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
    </marker>
    <marker id="arr-fork" markerWidth="12" markerHeight="8" refX="7" refY="4" orient="auto">
      <path d="M1 1 L7 4 L1 7M3 4 L1 4" fill="none" stroke="#BA7517" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
    </marker>
  </defs>`;
  relations.forEach((r,i)=>{
    const fromT = tables.find(t=>t.id===r.from.tableId);
    const toT = tables.find(t=>t.id===r.to.tableId);
    if(!fromT||!toT) return;
    const fromDiv = document.getElementById(\'tbl-\'+fromT.id);
    const toDiv = document.getElementById(\'tbl-\'+toT.id);
    if(!fromDiv||!toDiv) return;
    const fRect = fromDiv.getBoundingClientRect();
    const tRect = toDiv.getBoundingClientRect();
    const canvas = document.getElementById(\'er-canvas\');
    const cRect = canvas.getBoundingClientRect();
    // center of tables
    const fx = fromT.x + fromDiv.offsetWidth/2;
    const fy = fromT.y + fromDiv.offsetHeight/2;
    const tx = toT.x + toDiv.offsetWidth/2;
    const ty = toT.y + toDiv.offsetHeight/2;
    // pick edge connection points
    const dx = tx-fx, dy = ty-fy;
    let x1,y1,x2,y2;
    if(Math.abs(dx)>Math.abs(dy)){
      x1 = dx>0?fromT.x+fromDiv.offsetWidth:fromT.x; y1=fy;
      x2 = dx>0?toT.x:toT.x+toDiv.offsetWidth; y2=ty;
    } else {
      x1=fx; y1=dy>0?fromT.y+fromDiv.offsetHeight:fromT.y;
      x2=tx; y2=dy>0?toT.y:toT.y+toDiv.offsetHeight;
    }
    const mx1=(x1+x2)/2, my1=(y1+y2)/2;
    const colors = {\'1:N\':\'#378ADD\',\'N:1\':\'#378ADD\',\'1:1\':\'#1D9E75\',\'N:N\':\'#BA7517\'};
    const c = colors[r.type]||\'#378ADD\';
    const markEnd = r.type===\'1:1\'?\'arr-1\':r.type===\'N:N\'?\'arr-fork\':\'arr-n\';
    const markStart = (r.type===\'1:N\'||r.type===\'N:1\')?\'arr-1\':r.type===\'N:N\'?\'arr-fork\':\'arr-1\';
    const path = document.createElementNS(\'http://www.w3.org/2000/svg\',\'path\');
    path.setAttribute(\'d\',`M${x1} ${y1} C${x1+(x2-x1)*0.4} ${y1} ${x2-(x2-x1)*0.4} ${y2} ${x2} ${y2}`);
    path.setAttribute(\'fill\',\'none\');
    path.setAttribute(\'stroke\',c);
    path.setAttribute(\'stroke-width\',\'1.5\');
    path.setAttribute(\'stroke-dasharray\', r.type===\'N:N\'?\'6 3\':\'none\');
    path.setAttribute(\'marker-end\',`url(#${markEnd})`);
    path.setAttribute(\'marker-start\',`url(#${markStart})`);
    path.setAttribute(\'opacity\',\'0.75\');
    // label
    const lbl = document.createElementNS(\'http://www.w3.org/2000/svg\',\'text\');
    lbl.setAttribute(\'x\', mx1);
    lbl.setAttribute(\'y\', my1-5);
    lbl.setAttribute(\'text-anchor\',\'middle\');
    lbl.setAttribute(\'font-size\',\'10\');
    lbl.setAttribute(\'font-family\',\'var(--font-sans,sans-serif)\');
    lbl.setAttribute(\'fill\',c);
    lbl.setAttribute(\'font-weight\',\'600\');
    lbl.textContent = r.type;
    svg.appendChild(path);
    svg.appendChild(lbl);
  });
}

// ══════════════════════════════════════════════
// ER: DRAG
// ══════════════════════════════════════════════
function startDrag(e,id){
  if(e.target.classList.contains(\'del-btn\')||e.target.classList.contains(\'port\')) return;
  e.preventDefault();
  const t = tables.find(t=>t.id===id);
  const canvas = document.getElementById(\'er-canvas\');
  const cRect = canvas.getBoundingClientRect();
  dragging = id;
  dragOff = {x:e.clientX - cRect.left - t.x, y:e.clientY - cRect.top - t.y};
  document.addEventListener(\'mousemove\', onDrag);
  document.addEventListener(\'mouseup\', stopDrag);
}
function onDrag(e){
  if(dragging===null) return;
  const canvas = document.getElementById(\'er-canvas\');
  const cRect = canvas.getBoundingClientRect();
  const t = tables.find(t=>t.id===dragging);
  if(!t) return;
  t.x = Math.max(0, Math.min(e.clientX-cRect.left-dragOff.x, cRect.width-180));
  t.y = Math.max(0, Math.min(e.clientY-cRect.top-dragOff.y, cRect.height-100));
  const div = document.getElementById(\'tbl-\'+dragging);
  if(div){ div.style.left=t.x+\'px\'; div.style.top=t.y+\'px\'; }
  renderRelations();
}
function stopDrag(){
  dragging=null;
  document.removeEventListener(\'mousemove\',onDrag);
  document.removeEventListener(\'mouseup\',stopDrag);
}

// ══════════════════════════════════════════════
// ER: PORT / RELATION CREATION
// ══════════════════════════════════════════════
function handlePort(e,tid,fname){
  e.stopPropagation();
  if(!relSource){
    relSource = {tableId:tid, fieldName:fname};
    e.target.classList.add(\'active\');
    document.getElementById(\'rel-status\').innerHTML = `<span style="font-size:11px;color:var(--color-text-info)">Origen: <b>${tables.find(t=>t.id===tid)?.name}.${fname}</b><br>Haz clic en el puerto destino</span>`;
  } else {
    if(relSource.tableId===tid){ relSource=null; document.getElementById(\'rel-status\').innerHTML=\'\'; document.querySelectorAll(\'.port\').forEach(p=>p.classList.remove(\'active\')); return; }
    relations.push({from:relSource, to:{tableId:tid,fieldName:fname}, type:relMode});
    document.getElementById(\'rel-status\').innerHTML = `<span style="font-size:11px;color:var(--color-text-success)">Relación ${relMode} creada</span>`;
    setTimeout(()=>document.getElementById(\'rel-status\').innerHTML=\'\',2000);
    relSource=null;
    document.querySelectorAll(\'.port\').forEach(p=>p.classList.remove(\'active\'));
    renderRelations();
  }
}

// ══════════════════════════════════════════════
// SQL: DATABASES
// ══════════════════════════════════════════════
const DBS = {
  ecommerce:{
    label:\'Tablas: usuarios, productos, pedidos, categorias\',
    schemas:{
      usuarios:{cols:[\'id\',\'nombre\',\'email\',\'telefono\',\'pais\',\'created_at\']},
      categorias:{cols:[\'id\',\'nombre\',\'descripcion\']},
      productos:{cols:[\'id\',\'nombre\',\'precio\',\'stock\',\'categoria_id\']},
      pedidos:{cols:[\'id\',\'usuario_id\',\'total\',\'estado\',\'fecha\']},
    },
    data:{
      usuarios:[
        {id:1,nombre:\'Ana López\',email:\'ana@email.com\',telefono:\'555-1001\',pais:\'México\',created_at:\'2024-01-15\'},
        {id:2,nombre:\'Carlos Ruiz\',email:\'carlos@email.com\',telefono:\'555-1002\',pais:\'Colombia\',created_at:\'2024-02-20\'},
        {id:3,nombre:\'María García\',email:\'maria@email.com\',telefono:\'555-1003\',pais:\'España\',created_at:\'2024-03-10\'},
        {id:4,nombre:\'Luis Torres\',email:\'luis@email.com\',telefono:\'555-1004\',pais:\'México\',created_at:\'2024-03-22\'},
        {id:5,nombre:\'Sofia Chen\',email:\'sofia@email.com\',telefono:\'555-1005\',pais:\'Argentina\',created_at:\'2024-04-05\'},
      ],
      categorias:[
        {id:1,nombre:\'Electrónica\',descripcion:\'Gadgets y dispositivos\'},
        {id:2,nombre:\'Ropa\',descripcion:\'Prendas de vestir\'},
        {id:3,nombre:\'Hogar\',descripcion:\'Artículos para el hogar\'},
      ],
      productos:[
        {id:1,nombre:\'Laptop Pro\',precio:1299.99,stock:50,categoria_id:1},
        {id:2,nombre:\'Camisa Oxford\',precio:45.00,stock:200,categoria_id:2},
        {id:3,nombre:\'Smartphone X\',precio:899.99,stock:80,categoria_id:1},
        {id:4,nombre:\'Silla ergonómica\',precio:320.00,stock:30,categoria_id:3},
        {id:5,nombre:\'Teclado mecánico\',precio:129.99,stock:120,categoria_id:1},
        {id:6,nombre:\'Jeans slim\',precio:65.00,stock:180,categoria_id:2},
      ],
      pedidos:[
        {id:1,usuario_id:1,total:1299.99,estado:\'entregado\',fecha:\'2024-05-01\'},
        {id:2,usuario_id:2,total:45.00,estado:\'enviado\',fecha:\'2024-05-03\'},
        {id:3,usuario_id:1,total:899.99,estado:\'procesando\',fecha:\'2024-05-10\'},
        {id:4,usuario_id:3,total:385.00,estado:\'entregado\',fecha:\'2024-05-12\'},
        {id:5,usuario_id:4,total:65.00,estado:\'cancelado\',fecha:\'2024-05-15\'},
        {id:6,usuario_id:5,total:129.99,estado:\'enviado\',fecha:\'2024-05-18\'},
        {id:7,usuario_id:1,total:320.00,estado:\'procesando\',fecha:\'2024-05-20\'},
      ],
    }
  },
  universidad:{
    label:\'Tablas: estudiantes, profesores, cursos, inscripciones\',
    schemas:{
      estudiantes:{cols:[\'id\',\'nombre\',\'carrera\',\'semestre\',\'promedio\']},
      profesores:{cols:[\'id\',\'nombre\',\'departamento\',\'grado\']},
      cursos:{cols:[\'id\',\'nombre\',\'creditos\',\'profesor_id\']},
      inscripciones:{cols:[\'id\',\'estudiante_id\',\'curso_id\',\'nota\',\'periodo\']},
    },
    data:{
      estudiantes:[
        {id:1,nombre:\'Roberto Alva\',carrera:\'Sistemas\',semestre:4,promedio:8.7},
        {id:2,nombre:\'Daniela Mora\',carrera:\'Administración\',semestre:6,promedio:9.2},
        {id:3,nombre:\'Felipe Ríos\',carrera:\'Sistemas\',semestre:2,promedio:7.5},
        {id:4,nombre:\'Valentina Cruz\',carrera:\'Sistemas\',semestre:8,promedio:9.5},
      ],
      profesores:[
        {id:1,nombre:\'Dr. Ramírez\',departamento:\'Informática\',grado:\'Doctor\'},
        {id:2,nombre:\'Mtra. Soto\',departamento:\'Matemáticas\',grado:\'Maestría\'},
        {id:3,nombre:\'Ing. Vargas\',departamento:\'Electrónica\',grado:\'Ingeniería\'},
      ],
      cursos:[
        {id:1,nombre:\'Bases de Datos\',creditos:4,profesor_id:1},
        {id:2,nombre:\'Cálculo I\',creditos:5,profesor_id:2},
        {id:3,nombre:\'Programación Web\',creditos:3,profesor_id:1},
        {id:4,nombre:\'Electrónica Digital\',creditos:4,profesor_id:3},
      ],
      inscripciones:[
        {id:1,estudiante_id:1,curso_id:1,nota:9.0,periodo:\'2024-A\'},
        {id:2,estudiante_id:1,curso_id:3,nota:8.5,periodo:\'2024-A\'},
        {id:3,estudiante_id:2,curso_id:2,nota:9.8,periodo:\'2024-A\'},
        {id:4,estudiante_id:3,curso_id:1,nota:7.0,periodo:\'2024-A\'},
        {id:5,estudiante_id:4,curso_id:1,nota:10.0,periodo:\'2024-A\'},
        {id:6,estudiante_id:4,curso_id:3,nota:9.5,periodo:\'2024-A\'},
      ],
    }
  },
  hospital:{
    label:\'Tablas: pacientes, medicos, citas, diagnosticos\',
    schemas:{
      pacientes:{cols:[\'id\',\'nombre\',\'edad\',\'tipo_sangre\',\'telefono\']},
      medicos:{cols:[\'id\',\'nombre\',\'especialidad\',\'cedula\']},
      citas:{cols:[\'id\',\'paciente_id\',\'medico_id\',\'fecha\',\'estado\']},
      diagnosticos:{cols:[\'id\',\'cita_id\',\'descripcion\',\'tratamiento\']},
    },
    data:{
      pacientes:[
        {id:1,nombre:\'Carmen Vidal\',edad:45,tipo_sangre:\'O+\',telefono:\'555-2001\'},
        {id:2,nombre:\'Jorge Medina\',edad:62,tipo_sangre:\'A-\',telefono:\'555-2002\'},
        {id:3,nombre:\'Patricia Luna\',edad:33,tipo_sangre:\'B+\',telefono:\'555-2003\'},
      ],
      medicos:[
        {id:1,nombre:\'Dr. Salinas\',especialidad:\'Cardiología\',cedula:\'MED-001\'},
        {id:2,nombre:\'Dra. Fuentes\',especialidad:\'Pediatría\',cedula:\'MED-002\'},
        {id:3,nombre:\'Dr. Herrera\',especialidad:\'Medicina General\',cedula:\'MED-003\'},
      ],
      citas:[
        {id:1,paciente_id:1,medico_id:1,fecha:\'2024-05-10\',estado:\'completada\'},
        {id:2,paciente_id:2,medico_id:1,fecha:\'2024-05-12\',estado:\'completada\'},
        {id:3,paciente_id:3,medico_id:3,fecha:\'2024-05-15\',estado:\'pendiente\'},
        {id:4,paciente_id:1,medico_id:3,fecha:\'2024-05-20\',estado:\'pendiente\'},
      ],
      diagnosticos:[
        {id:1,cita_id:1,descripcion:\'Hipertensión leve\',tratamiento:\'Enalapril 5mg\'},
        {id:2,cita_id:2,descripcion:\'Arritmia sinusal\',tratamiento:\'Holter 24h\'},
      ],
    }
  },
  banco:{
    label:\'Tablas: clientes, cuentas, transacciones, prestamos\',
    schemas:{
      clientes:{cols:[\'id\',\'nombre\',\'rfc\',\'score_credito\']},
      cuentas:{cols:[\'id\',\'cliente_id\',\'tipo\',\'saldo\',\'activa\']},
      transacciones:{cols:[\'id\',\'cuenta_id\',\'monto\',\'tipo\',\'fecha\']},
      prestamos:{cols:[\'id\',\'cliente_id\',\'monto\',\'tasa\',\'estado\']},
    },
    data:{
      clientes:[
        {id:1,nombre:\'Eduardo Blanco\',rfc:\'BAED800101\',score_credito:780},
        {id:2,nombre:\'Lucía Moreno\',rfc:\'MOLL920515\',score_credito:650},
        {id:3,nombre:\'Ricardo Salas\',rfc:\'SARR751220\',score_credito:820},
      ],
      cuentas:[
        {id:1,cliente_id:1,tipo:\'ahorro\',saldo:45200.00,activa:true},
        {id:2,cliente_id:1,tipo:\'cheques\',saldo:12500.00,activa:true},
        {id:3,cliente_id:2,tipo:\'ahorro\',saldo:8750.00,activa:true},
        {id:4,cliente_id:3,tipo:\'inversión\',saldo:125000.00,activa:true},
      ],
      transacciones:[
        {id:1,cuenta_id:1,monto:5000.00,tipo:\'depósito\',fecha:\'2024-05-01\'},
        {id:2,cuenta_id:1,monto:-1500.00,tipo:\'retiro\',fecha:\'2024-05-03\'},
        {id:3,cuenta_id:2,monto:-800.00,tipo:\'pago\',fecha:\'2024-05-05\'},
        {id:4,cuenta_id:3,monto:2000.00,tipo:\'depósito\',fecha:\'2024-05-08\'},
        {id:5,cuenta_id:4,monto:50000.00,tipo:\'depósito\',fecha:\'2024-05-10\'},
      ],
      prestamos:[
        {id:1,cliente_id:1,monto:80000.00,tasa:9.5,estado:\'activo\'},
        {id:2,cliente_id:2,monto:25000.00,tasa:13.2,estado:\'atrasado\'},
      ],
    }
  }
};

function setDB(db,el){
  currentDB = db;
  document.querySelectorAll(\'.db-pill\').forEach(p=>p.classList.remove(\'active\'));
  el.classList.add(\'active\');
  document.getElementById(\'db-schema-label\').textContent = DBS[db].label;
}

// ══════════════════════════════════════════════
// SQL: QUERIES
// ══════════════════════════════════════════════
const QUERIES = {
  ecommerce:[
    \'SELECT * FROM usuarios LIMIT 10;\',
    `SELECT u.nombre, u.email, p.total, p.estado, p.fecha\\nFROM usuarios u\\nJOIN pedidos p ON u.id = p.usuario_id\\nORDER BY p.fecha DESC;`,
    `SELECT u.nombre, COUNT(p.id) AS num_pedidos, SUM(p.total) AS total_gastado\\nFROM usuarios u\\nJOIN pedidos p ON u.id = p.usuario_id\\nGROUP BY u.id, u.nombre\\nHAVING COUNT(p.id) > 1;`,
    `SELECT * FROM productos\\nWHERE id IN (\\n  SELECT DISTINCT producto_id FROM pedidos\\n);`,
    `INSERT INTO usuarios (id, nombre, email, telefono, pais, created_at)\\nVALUES (6, \'Nuevo Usuario\', \'nuevo@email.com\', \'555-9999\', \'México\', \'2024-05-25\');`,
    `SELECT u.nombre, u.pais, p.total, p.estado\\nFROM usuarios u\\nLEFT JOIN pedidos p ON u.id = p.usuario_id\\nWHERE p.id IS NULL OR p.estado != \'cancelado\';`,
    `SELECT nombre, precio FROM productos\\nWHERE stock > 50\\nORDER BY precio DESC\\nLIMIT 3;`,
    `SELECT c.nombre AS categoria, COUNT(p.id) AS num_productos, AVG(p.precio) AS precio_promedio\\nFROM categorias c\\nJOIN productos p ON c.id = p.categoria_id\\nGROUP BY c.id, c.nombre;`,
  ],
  universidad:[
    \'SELECT * FROM estudiantes;\',
    `SELECT e.nombre, c.nombre AS curso, i.nota\\nFROM estudiantes e\\nJOIN inscripciones i ON e.id = i.estudiante_id\\nJOIN cursos c ON i.curso_id = c.id\\nORDER BY i.nota DESC;`,
    `SELECT e.nombre, COUNT(i.id) AS cursos_inscritos, AVG(i.nota) AS promedio\\nFROM estudiantes e\\nJOIN inscripciones i ON e.id = i.estudiante_id\\nGROUP BY e.id\\nHAVING AVG(i.nota) > 8;`,
    `SELECT * FROM cursos\\nWHERE id IN (SELECT curso_id FROM inscripciones WHERE nota >= 9);`,
    `INSERT INTO estudiantes VALUES (5, \'Nuevo Alumno\', \'Sistemas\', 1, 0.0);`,
    `SELECT e.nombre, e.carrera\\nFROM estudiantes e\\nLEFT JOIN inscripciones i ON e.id = i.estudiante_id\\nWHERE i.id IS NULL;`,
    `SELECT nombre, promedio FROM estudiantes\\nORDER BY promedio DESC\\nLIMIT 3;`,
    `SELECT p.nombre, COUNT(i.id) AS alumnos\\nFROM profesores p\\nJOIN cursos c ON p.id = c.profesor_id\\nJOIN inscripciones i ON c.id = i.curso_id\\nGROUP BY p.id;`,
  ],
  hospital:[
    \'SELECT * FROM pacientes;\',
    `SELECT p.nombre, m.nombre AS medico, c.fecha, c.estado\\nFROM pacientes p\\nJOIN citas c ON p.id = c.paciente_id\\nJOIN medicos m ON c.medico_id = m.id;`,
    `SELECT m.nombre, COUNT(c.id) AS total_citas\\nFROM medicos m\\nJOIN citas c ON m.id = c.medico_id\\nGROUP BY m.id\\nHAVING COUNT(c.id) > 1;`,
    `SELECT * FROM pacientes WHERE id IN (SELECT paciente_id FROM citas WHERE estado=\'completada\');`,
    `INSERT INTO pacientes VALUES (4, \'Nuevo Paciente\', 28, \'AB+\', \'555-3000\');`,
    `SELECT p.nombre FROM pacientes p\\nLEFT JOIN citas c ON p.id = c.paciente_id AND c.estado=\'pendiente\'\\nWHERE c.id IS NULL;`,
    `SELECT nombre, edad FROM pacientes ORDER BY edad DESC LIMIT 2;`,
    `SELECT m.especialidad, COUNT(c.id) AS citas FROM medicos m JOIN citas c ON m.id=c.medico_id GROUP BY m.especialidad;`,
  ],
  banco:[
    \'SELECT * FROM clientes;\',
    `SELECT cl.nombre, cu.tipo, cu.saldo\\nFROM clientes cl\\nJOIN cuentas cu ON cl.id = cu.cliente_id\\nWHERE cu.activa = true;`,
    `SELECT cl.nombre, COUNT(cu.id) AS num_cuentas, SUM(cu.saldo) AS saldo_total\\nFROM clientes cl\\nJOIN cuentas cu ON cl.id = cu.cliente_id\\nGROUP BY cl.id\\nHAVING SUM(cu.saldo) > 10000;`,
    `SELECT * FROM cuentas WHERE cliente_id IN (SELECT id FROM clientes WHERE score_credito > 700);`,
    `INSERT INTO clientes VALUES (4, \'Cliente Nuevo\', \'CLNU900101\', 700);`,
    `SELECT cl.nombre FROM clientes cl\\nLEFT JOIN prestamos pr ON cl.id = pr.cliente_id\\nWHERE pr.id IS NULL;`,
    `SELECT tipo, saldo FROM cuentas ORDER BY saldo DESC LIMIT 3;`,
    `SELECT tipo, COUNT(*) AS total, AVG(saldo) AS saldo_promedio FROM cuentas GROUP BY tipo;`,
  ],
};

function loadQ(idx){
  const db = currentDB;
  const qs = QUERIES[db] || QUERIES.ecommerce;
  document.getElementById(\'sql-input\').value = qs[idx]||qs[0];
}

// ══════════════════════════════════════════════
// SQL: ENGINE
// ══════════════════════════════════════════════
function runSQL(){
  const raw = document.getElementById(\'sql-input\').value.trim();
  if(!raw){ showError(\'Escribe una consulta SQL para ejecutar.\'); return; }
  const t0 = performance.now();
  try{
    const result = executeSQL(raw, DBS[currentDB].data);
    const t1 = performance.now();
    showResult(result, raw, t1-t0);
    showAnalysis(raw, result, t1-t0);
  } catch(e){
    showError(e.message);
  }
}

function executeSQL(sql, data){
  const s = sql.trim().replace(/\\s+/g,\' \');
  const upper = s.toUpperCase();
  // INSERT
  if(upper.startsWith(\'INSERT\')){
    const m = upper.match(/INSERT INTO (\\w+)/);
    const tbl = m?m[1].toLowerCase():null;
    if(!tbl||!data[tbl]) throw new Error(`Tabla "${tbl}" no encontrada`);
    return {type:\'insert\', message:`1 fila insertada en "${tbl}" (simulado — datos en memoria)`};
  }
  // SELECT
  if(!upper.startsWith(\'SELECT\')) throw new Error(\'Solo se soportan SELECT e INSERT en este simulador\');
  return parseSelect(s, data);
}

function parseSelect(sql, data){
  const up = sql.toUpperCase();
  // FROM
  const fromMatch = up.match(/FROM\\s+(\\w+)(?:\\s+(?:AS\\s+)?(\\w+))?/i);
  if(!fromMatch) throw new Error(\'Falta cláusula FROM\');
  const mainTable = fromMatch[1].toLowerCase();
  const mainAlias = fromMatch[2]||mainTable;
  if(!data[mainTable]) throw new Error(`Tabla "${mainTable}" no existe. Tablas disponibles: ${Object.keys(data).join(\', \')}`);
  let rows = data[mainTable].map(r=>({...r,\'__tbl\':mainTable}));
  const aliases = {[mainAlias]:mainTable,[mainTable]:mainTable};

  // JOINs
  const joinRe = /(?:LEFT\\s+)?JOIN\\s+(\\w+)(?:\\s+(?:AS\\s+)?(\\w+))?\\s+ON\\s+(\\w+)\\.(\\w+)\\s*=\\s*(\\w+)\\.(\\w+)/gi;
  let jm;
  while((jm=joinRe.exec(sql))!==null){
    const jTbl=jm[1].toLowerCase(), jAlias=(jm[2]||jm[1]).toLowerCase();
    const isLeft=jm[0].toUpperCase().startsWith(\'LEFT\');
    aliases[jAlias]=jTbl; aliases[jTbl]=jTbl;
    if(!data[jTbl]) throw new Error(`Tabla "${jTbl}" no existe`);
    const la=jm[3].toLowerCase(), lf=jm[4].toLowerCase();
    const ra=jm[5].toLowerCase(), rf=jm[6].toLowerCase();
    const newRows=[];
    rows.forEach(row=>{
      const lTbl=aliases[la]||la;
      const lVal=row[lf];
      const matches=data[jTbl].filter(jr=>jr[rf]==lVal);
      if(matches.length>0) matches.forEach(jr=>newRows.push({...row,...Object.fromEntries(Object.entries(jr).map(([k,v])=>[k,v]))}));
      else if(isLeft) newRows.push({...row,...Object.fromEntries(Object.keys(data[jTbl][0]||{}).map(k=>[k,null]))});
    });
    rows=newRows;
  }

  // WHERE
  const whereMatch = sql.match(/WHERE\\s+(.+?)(?:\\s+GROUP BY|\\s+ORDER BY|\\s+HAVING|\\s+LIMIT|$)/i);
  if(whereMatch){
    const cond=whereMatch[1].trim();
    rows=rows.filter(row=>evalWhere(cond,row));
  }

  // GROUP BY
  const gbMatch = sql.match(/GROUP BY\\s+(.+?)(?:\\s+HAVING|\\s+ORDER BY|\\s+LIMIT|$)/i);
  if(gbMatch){
    const gbCols=gbMatch[1].split(\',\').map(c=>c.trim().split(\'.\').pop().toLowerCase());
    const groups={};
    rows.forEach(row=>{
      const key=gbCols.map(c=>row[c]).join(\'|\');
      if(!groups[key]) groups[key]={...row,__rows:[row],__count:0};
      groups[key].__rows.push(row);
      groups[key].__count++;
    });
    rows=Object.values(groups).map(g=>({...g,__count:g.__rows.length,__rows:g.__rows}));
    // HAVING
    const havMatch=sql.match(/HAVING\\s+(.+?)(?:\\s+ORDER BY|\\s+LIMIT|$)/i);
    if(havMatch){ rows=rows.filter(row=>evalHaving(havMatch[1].trim(),row)); }
  }

  // SELECT cols
  const selectPart=sql.match(/^SELECT\\s+(.+?)\\s+FROM/i)?.[1]||\'*\';
  if(selectPart.trim()===\'*\'){
    rows=rows.map(r=>{const o={};Object.entries(r).forEach(([k,v])=>{if(!k.startsWith(\'__\'))o[k]=v});return o;});
  } else {
    rows=rows.map(row=>buildSelectCols(selectPart,row));
  }

  // ORDER BY
  const obMatch=sql.match(/ORDER BY\\s+(.+?)(?:\\s+LIMIT|$)/i);
  if(obMatch){
    const parts=obMatch[1].split(\',\').map(p=>p.trim());
    rows.sort((a,b)=>{
      for(const part of parts){
        const [col,dir]=[part.split(\' \')[0].toLowerCase(),part.toUpperCase().includes(\'DESC\')?-1:1];
        const cn=col.split(\'.\').pop();
        if(a[cn]<b[cn]) return -dir; if(a[cn]>b[cn]) return dir;
      }
      return 0;
    });
  }

  // LIMIT
  const lmMatch=sql.match(/LIMIT\\s+(\\d+)/i);
  if(lmMatch) rows=rows.slice(0,parseInt(lmMatch[1]));

  if(rows.length===0) return {type:\'empty\',rows:[],cols:[]};
  const cols=Object.keys(rows[0]);
  return {type:\'rows\',rows,cols};
}

function evalWhere(cond,row){
  // simple AND/OR splitter
  if(/ AND /i.test(cond)) return cond.split(/ AND /i).every(c=>evalCond(c.trim(),row));
  if(/ OR /i.test(cond)) return cond.split(/ OR /i).some(c=>evalCond(c.trim(),row));
  return evalCond(cond,row);
}

function evalCond(c,row){
  // IS NULL / IS NOT NULL
  if(/IS\\s+NOT\\s+NULL/i.test(c)){ const col=c.split(/\\s/)[0].split(\'.\').pop().toLowerCase(); return row[col]!==null&&row[col]!==undefined; }
  if(/IS\\s+NULL/i.test(c)){ const col=c.split(/\\s/)[0].split(\'.\').pop().toLowerCase(); return row[col]===null||row[col]===undefined; }
  // IN
  const inM=c.match(/(\\w+(?:\\.\\w+)?)\\s+(?:NOT\\s+)?IN\\s*\\(([^)]+)\\)/i);
  if(inM){ const col=inM[1].split(\'.\').pop().toLowerCase(); const vals=inM[2].split(\',\').map(v=>v.trim().replace(/[\'"]/g,\'\')); const isIn=vals.includes(String(row[col])); return c.toUpperCase().includes(\'NOT IN\')?!isIn:isIn; }
  // Operators
  const opM=c.match(/^(.+?)\\s*(!=|<>|>=|<=|=|>|<)\\s*(.+)$/);
  if(!opM) return true;
  const col=opM[1].trim().split(\'.\').pop().toLowerCase().replace(/[\'"]/g,\'\');
  const op=opM[2], rawVal=opM[3].trim().replace(/[\'"]/g,\'\');
  const lv=row[col], rv=isNaN(rawVal)?rawVal:Number(rawVal);
  const l=typeof lv===\'number\'?lv:String(lv);
  if(op===\'=\'||op===\'==\') return String(l)===String(rv);
  if(op===\'!=\'||op===\'<>\') return String(l)!==String(rv);
  if(op===\'>\') return Number(l)>Number(rv);
  if(op===\'<\') return Number(l)<Number(rv);
  if(op===\'>=\') return Number(l)>=Number(rv);
  if(op===\'<=\') return Number(l)<=Number(rv);
  return true;
}

function evalHaving(cond,row){
  const m=cond.match(/COUNT\\(\\*?\\)\\s*(>|<|>=|<=|=|!=)\\s*(\\d+)/i);
  if(m){ const op=m[1],val=parseInt(m[2]); const cnt=row.__count||0; if(op===\'>\') return cnt>val; if(op===\'>=\') return cnt>=val; if(op===\'<\') return cnt<val; if(op===\'<=\') return cnt<=val; if(op===\'=\') return cnt===val; }
  const m2=cond.match(/AVG\\((\\w+)\\)\\s*(>|<|>=|<=|=)\\s*([\\d.]+)/i);
  if(m2){ const col=m2[1].toLowerCase(), op=m2[2], val=parseFloat(m2[3]); const avg=row.__rows?row.__rows.reduce((s,r)=>s+(r[col]||0),0)/row.__rows.length:0; if(op===\'>\') return avg>val; if(op===\'>=\') return avg>=val; if(op===\'<\') return avg<val; }
  return true;
}

function buildSelectCols(selectPart,row){
  const result={};
  const cols=selectPart.split(\',\').map(c=>c.trim());
  cols.forEach(col=>{
    // COUNT(*)
    if(/COUNT\\(\\*\\)/i.test(col)){
      const alias=col.match(/AS\\s+(\\w+)/i)?.[1]||\'COUNT(*)\';
      result[alias]=row.__count||1;
    } else if(/COUNT\\(/i.test(col)){
      const alias=col.match(/AS\\s+(\\w+)/i)?.[1]||col;
      result[alias]=row.__count||1;
    } else if(/SUM\\((.+?)\\)/i.test(col)){
      const fcol=col.match(/SUM\\((.+?)\\)/i)[1].trim().toLowerCase();
      const alias=col.match(/AS\\s+(\\w+)/i)?.[1]||`SUM(${fcol})`;
      result[alias]=row.__rows?row.__rows.reduce((s,r)=>s+(r[fcol]||0),0):row[fcol]||0;
    } else if(/AVG\\((.+?)\\)/i.test(col)){
      const fcol=col.match(/AVG\\((.+?)\\)/i)[1].trim().toLowerCase();
      const alias=col.match(/AS\\s+(\\w+)/i)?.[1]||`AVG(${fcol})`;
      result[alias]=row.__rows?parseFloat((row.__rows.reduce((s,r)=>s+(r[fcol]||0),0)/row.__rows.length).toFixed(2)):row[fcol]||0;
    } else {
      const parts=col.split(/\\s+AS\\s+/i);
      const rawCol=parts[0].trim().split(\'.\').pop().toLowerCase();
      const alias=parts[1]||rawCol;
      result[alias]=row.hasOwnProperty(rawCol)?row[rawCol]:null;
    }
  });
  return result;
}

// ══════════════════════════════════════════════
// SQL: DISPLAY
// ══════════════════════════════════════════════
function showResult(result, sql, ms){
  const area=document.getElementById(\'result-area\');
  const stats=document.getElementById(\'result-stats\');
  if(result.type===\'insert\'){
    area.innerHTML=`<div style="padding:16px;font-size:13px;color:var(--color-text-success)">${result.message}</div>`;
    stats.textContent=\'1 fila afectada\';
    return;
  }
  if(result.type===\'empty\'||result.rows.length===0){
    area.innerHTML=\'<div class="result-placeholder">0 resultados encontrados</div>\';
    stats.textContent=\'0 filas\';
    return;
  }
  const {rows,cols}=result;
  stats.textContent=`${rows.length} fila${rows.length!==1?\'s\':\'\'} × ${cols.length} col${cols.length!==1?\'s\':\'\'} · ${ms.toFixed(1)}ms`;
  let html=`<table class="result-table"><thead><tr>${cols.map(c=>`<th>${c}</th>`).join(\'\')}</tr></thead><tbody>`;
  rows.forEach(row=>{
    html+=`<tr>${cols.map(c=>{
      const v=row[c];
      if(v===null||v===undefined) return `<td><span class="null-val">NULL</span></td>`;
      return `<td>${v}</td>`;
    }).join(\'\')}</tr>`;
  });
  html+=\'</tbody></table>\';
  area.innerHTML=html;
}

function showError(msg){
  document.getElementById(\'result-area\').innerHTML=`<div class="error-msg">Error: ${msg}</div>`;
  document.getElementById(\'result-stats\').textContent=\'\';
}

function showAnalysis(sql, result, ms){
  const up=sql.toUpperCase();
  // Plan
  const planDiv=document.getElementById(\'exec-plan\');
  const steps=[];
  const fmatch=sql.match(/FROM\\s+(\\w+)/i);
  if(fmatch) steps.push({n:1,t:`Full scan en "${fmatch[1].toLowerCase()}" (${DBS[currentDB].data[fmatch[1].toLowerCase()]?.length||\'?\'} filas)`});
  if(up.includes(\'JOIN\')) steps.push({n:steps.length+1,t:\'Hash join con tabla secundaria\'});
  if(up.includes(\'WHERE\')) steps.push({n:steps.length+1,t:\'Filtro aplicado (WHERE)\'});
  if(up.includes(\'GROUP BY\')) steps.push({n:steps.length+1,t:\'Agrupación de resultados\'});
  if(up.includes(\'HAVING\')) steps.push({n:steps.length+1,t:\'Filtro post-agrupación (HAVING)\'});
  if(up.includes(\'ORDER BY\')) steps.push({n:steps.length+1,t:\'Ordenamiento de resultados\'});
  if(up.includes(\'LIMIT\')) steps.push({n:steps.length+1,t:\'Limitación de filas devueltas\'});
  planDiv.innerHTML=steps.map(s=>`<div class="plan-step"><span class="plan-num">${s.n}</span><span>${s.t}</span></div>`).join(\'\');

  // Metrics
  const rowCount=result.rows?.length||0;
  document.getElementById(\'m-time\').textContent=ms.toFixed(2)+\'ms\';
  document.getElementById(\'m-rows\').textContent=rowCount;
  const hasIdx=up.includes(\'WHERE\')&&(up.includes(\'= \')||up.includes(\'=\\n\'));
  document.getElementById(\'m-idx\').textContent=hasIdx?\'Posible\':\'No usado\';
  const cost=up.includes(\'JOIN\')?\'Alto\':up.includes(\'WHERE\')?\'Medio\':\'Bajo\';
  document.getElementById(\'m-cost\').textContent=cost;

  // Tips
  const tipsDiv=document.getElementById(\'sql-tips\');
  const tips=[];
  if(up.includes(\'SELECT *\')) tips.push({w:true,t:\'Evita SELECT * — especifica columnas necesarias para mejorar rendimiento\'});
  if(up.includes(\'JOIN\')&&!up.includes(\'WHERE\')) tips.push({w:true,t:\'JOIN sin WHERE puede retornar muchas filas — considera agregar filtros\'});
  if(up.includes(\'GROUP BY\')) tips.push({w:false,t:\'GROUP BY bien usado — asegúrate de tener índice en columna de agrupación\'});
  if(up.includes(\'LIMIT\')) tips.push({w:false,t:\'Buen uso de LIMIT — limita la carga en consultas de desarrollo\'});
  if(up.includes(\'ORDER BY\')&&!up.includes(\'LIMIT\')) tips.push({w:true,t:\'ORDER BY sin LIMIT puede ser costoso en tablas grandes\'});
  if(tips.length===0) tips.push({w:false,t:\'Consulta se ve bien estructurada\'});
  tipsDiv.innerHTML=tips.map(tip=>`<div class="tip-item"><span class="tip-dot ${tip.w?\'warn-dot\':\'\'}"></span><span>${tip.t}</span></div>`).join(\'\');
}

function formatSQL(){
  const ta=document.getElementById(\'sql-input\');
  let s=ta.value.trim();
  const kws=[\'SELECT\',\'FROM\',\'WHERE\',\'JOIN\',\'LEFT JOIN\',\'INNER JOIN\',\'GROUP BY\',\'HAVING\',\'ORDER BY\',\'LIMIT\',\'ON\',\'AND\',\'OR\',\'INSERT INTO\',\'VALUES\',\'UPDATE\',\'SET\',\'DELETE FROM\'];
  kws.forEach(k=>{ const re=new RegExp(\'\\\\b\'+k+\'\\\\b\',\'gi\'); s=s.replace(re,\'\\n\'+k); });
  s=s.replace(/\\n{2,}/g,\'\\n\').trim();
  ta.value=s;
}

function explainSQL(){
  const sql=document.getElementById(\'sql-input\').value.trim().toUpperCase();
  let ex=\'Esta consulta \';
  if(sql.includes(\'SELECT *\')) ex+=\'selecciona todas las columnas\';
  else ex+=\'selecciona columnas específicas\';
  ex+=\' de \'+((sql.match(/FROM\\s+(\\w+)/i)?.[1])||\'una tabla\');
  if(sql.includes(\'JOIN\')) ex+=\', hace un JOIN con otra tabla\';
  if(sql.includes(\'WHERE\')) ex+=\', filtra resultados con WHERE\';
  if(sql.includes(\'GROUP BY\')) ex+=\', agrupa los resultados\';
  if(sql.includes(\'ORDER BY\')) ex+=\', ordena los resultados\';
  if(sql.includes(\'LIMIT\')) ex+=\', y limita el número de filas devueltas\';
  ex+=\'.\';
  document.getElementById(\'result-area\').innerHTML=`<div style="padding:16px;font-size:13px;color:var(--color-text-secondary);line-height:1.6">${ex}</div>`;
}

function clearSQL(){
  document.getElementById(\'sql-input\').value=\'\';
  document.getElementById(\'result-area\').innerHTML=\'<div class="result-placeholder">Escribe una consulta y pulsa Ejecutar</div>\';
  document.getElementById(\'result-stats\').textContent=\'\';
}

// ══════════════════════════════════════════════
// INIT
// ══════════════════════════════════════════════
loadPreset(\'ecommerce\');

// Event listeners básicos
setTimeout(() => {
    document.querySelectorAll(\'.objetivo-card\').forEach(card => {
        card.addEventListener(\'click\', function() {
            const cb = this.querySelector(\'.objetivo-checkbox\');
            if (cb) cb.style.backgroundColor = cb.style.backgroundColor === \'\' ? \'#4CAF50\' : \'\';
        });
    });
}, 100);


</script>',
    'ejercicios' => 
    array (
      0 => 
      array (
        'enunciado' => 'SELECT todos los usuarios',
        'respuesta' => 'SELECT * FROM usuarios;',
      ),
      1 => 
      array (
        'enunciado' => '¿Qué es PK?',
        'respuesta' => 'Clave primaria: valor único por fila',
      ),
      2 => 
      array (
        'enunciado' => 'Relación N:N necesita...',
        'respuesta' => 'Tabla intermedia con dos FK',
      ),
      3 => 
      array (
        'enunciado' => 'JOIN básico',
        'respuesta' => 'SELECT * FROM A JOIN B ON A.id = B.a_id;',
      ),
      4 => 
      array (
        'enunciado' => 'Crear tabla con FK',
        'respuesta' => 'FOREIGN KEY (col) REFERENCES tabla(pk)',
      ),
      5 => 
      array (
        'enunciado' => 'Normalización 1NF',
        'respuesta' => 'Sin valores repetidos en columna',
      ),
      6 => 
      array (
        'enunciado' => 'INSERT ejemplo',
        'respuesta' => 'INSERT INTO usuarios (nombre) VALUES (\'Ana\');',
      ),
      7 => 
      array (
        'enunciado' => 'WHERE filtra',
        'respuesta' => 'WHERE id = 1',
      ),
      8 => 
      array (
        'enunciado' => 'ORDER BY ordena',
        'respuesta' => 'ORDER BY nombre ASC',
      ),
      9 => 
      array (
        'enunciado' => 'COUNT cuenta',
        'respuesta' => 'SELECT COUNT(*) FROM pedidos;',
      ),
      10 => 
      array (
        'enunciado' => 'INNER JOIN devuelve',
        'respuesta' => 'Solo coincidencias',
      ),
      11 => 
      array (
        'enunciado' => 'SI: % de BD relacionales',
        'respuesta' => '~80%',
      ),
    ),
    'quiz' => 
    array (
      0 => 
      array (
        'pregunta' => 'SQL significa',
        'opciones' => 
        array (
          0 => 'Structured Query Language',
          1 => 'Simple Query',
          2 => 'Standard Query',
          3 => 'Sequential',
        ),
        'correcta' => 'Structured Query Language',
      ),
      1 => 
      array (
        'pregunta' => 'PK es',
        'opciones' => 
        array (
          0 => 'Única por fila',
          1 => 'Repetible',
          2 => 'Opcional',
          3 => 'Texto',
        ),
        'correcta' => 'Única por fila',
      ),
      2 => 
      array (
        'pregunta' => 'FK referencia',
        'opciones' => 
        array (
          0 => 'PK de otra tabla',
          1 => 'Cualquier campo',
          2 => 'Índice',
          3 => 'Nada',
        ),
        'correcta' => 'PK de otra tabla',
      ),
      3 => 
      array (
        'pregunta' => '1:N ejemplo',
        'opciones' => 
        array (
          0 => 'Usuario → Pedidos',
          1 => 'Persona → Pasaporte',
          2 => 'Amigos',
          3 => 'Nada',
        ),
        'correcta' => 'Usuario → Pedidos',
      ),
      4 => 
      array (
        'pregunta' => 'N:N requiere',
        'opciones' => 
        array (
          0 => 'Tabla intermedia',
          1 => 'Una tabla',
          2 => 'Ninguna',
          3 => 'JSON',
        ),
        'correcta' => 'Tabla intermedia',
      ),
      5 => 
      array (
        'pregunta' => 'Normalización evita',
        'opciones' => 
        array (
          0 => 'Redundancia',
          1 => 'Datos',
          2 => 'Tablas',
          3 => 'Nada',
        ),
        'correcta' => 'Redundancia',
      ),
      6 => 
      array (
        'pregunta' => 'JOIN une',
        'opciones' => 
        array (
          0 => 'Tablas por clave común',
          1 => 'Todo',
          2 => 'Nada',
          3 => 'Solo PK',
        ),
        'correcta' => 'Tablas por clave común',
      ),
      7 => 
      array (
        'pregunta' => 'SELECT * FROM',
        'opciones' => 
        array (
          0 => 'Todos los datos',
          1 => 'Una fila',
          2 => 'Nada',
          3 => 'Error',
        ),
        'correcta' => 'Todos los datos',
      ),
      8 => 
      array (
        'pregunta' => 'WHERE filtra',
        'opciones' => 
        array (
          0 => 'Filas',
          1 => 'Columnas',
          2 => 'Tablas',
          3 => 'BD',
        ),
        'correcta' => 'Filas',
      ),
      9 => 
      array (
        'pregunta' => 'ORDER BY',
        'opciones' => 
        array (
          0 => 'Ordena resultados',
          1 => 'Filtra',
          2 => 'Crea',
          3 => 'Elimina',
        ),
        'correcta' => 'Ordena resultados',
      ),
      10 => 
      array (
        'pregunta' => 'CREATE TABLE',
        'opciones' => 
        array (
          0 => 'Define estructura',
          1 => 'Inserta',
          2 => 'Selecciona',
          3 => 'Elimina',
        ),
        'correcta' => 'Define estructura',
      ),
      11 => 
      array (
        'pregunta' => 'INSERT INTO',
        'opciones' => 
        array (
          0 => 'Agrega fila',
          1 => 'Selecciona',
          2 => 'Actualiza',
          3 => 'Elimina',
        ),
        'correcta' => 'Agrega fila',
      ),
      12 => 
      array (
        'pregunta' => 'UPDATE modifica',
        'opciones' => 
        array (
          0 => 'Datos existentes',
          1 => 'Estructura',
          2 => 'Tabla',
          3 => 'BD',
        ),
        'correcta' => 'Datos existentes',
      ),
      13 => 
      array (
        'pregunta' => 'DELETE FROM',
        'opciones' => 
        array (
          0 => 'Elimina filas',
          1 => 'Tablas',
          2 => 'Columnas',
          3 => 'BD',
        ),
        'correcta' => 'Elimina filas',
      ),
      14 => 
      array (
        'pregunta' => 'INNER JOIN',
        'opciones' => 
        array (
          0 => 'Solo coincidencias',
          1 => 'Todo',
          2 => 'Izquierda',
          3 => 'Derecha',
        ),
        'correcta' => 'Solo coincidencias',
      ),
      15 => 
      array (
        'pregunta' => 'LEFT JOIN',
        'opciones' => 
        array (
          0 => 'Todo de izquierda',
          1 => 'Solo coincidencias',
          2 => 'Derecha',
          3 => 'Nada',
        ),
        'correcta' => 'Todo de izquierda',
      ),
      16 => 
      array (
        'pregunta' => 'COUNT(*)',
        'opciones' => 
        array (
          0 => 'Cuenta filas',
          1 => 'Suma',
          2 => 'Promedio',
          3 => 'Máximo',
        ),
        'correcta' => 'Cuenta filas',
      ),
      17 => 
      array (
        'pregunta' => 'GROUP BY',
        'opciones' => 
        array (
          0 => 'Agrupa resultados',
          1 => 'Ordena',
          2 => 'Filtra',
          3 => 'Une',
        ),
        'correcta' => 'Agrupa resultados',
      ),
      18 => 
      array (
        'pregunta' => 'HAVING filtra',
        'opciones' => 
        array (
          0 => 'Grupos',
          1 => 'Filas',
          2 => 'Tablas',
          3 => 'Columnas',
        ),
        'correcta' => 'Grupos',
      ),
      19 => 
      array (
        'pregunta' => 'SI 2025: BD más usada',
        'opciones' => 
        array (
          0 => 'MySQL',
          1 => 'MongoDB',
          2 => 'Redis',
          3 => 'Excel',
        ),
        'correcta' => 'MySQL',
      ),
      20 => 
      array (
        'pregunta' => 'INDEX acelera',
        'opciones' => 
        array (
          0 => 'Búsquedas',
          1 => 'Inserciones',
          2 => 'Todo',
          3 => 'Nada',
        ),
        'correcta' => 'Búsquedas',
      ),
      21 => 
      array (
        'pregunta' => 'AUTO_INCREMENT',
        'opciones' => 
        array (
          0 => 'ID automático',
          1 => 'Manual',
          2 => 'Texto',
          3 => 'Fecha',
        ),
        'correcta' => 'ID automático',
      ),
      22 => 
      array (
        'pregunta' => 'UNIQUE',
        'opciones' => 
        array (
          0 => 'Valor no repetido',
          1 => 'Repetible',
          2 => 'Nulo',
          3 => 'PK',
        ),
        'correcta' => 'Valor no repetido',
      ),
      23 => 
      array (
        'pregunta' => 'NOT NULL',
        'opciones' => 
        array (
          0 => 'Campo obligatorio',
          1 => 'Opcional',
          2 => 'PK',
          3 => 'FK',
        ),
        'correcta' => 'Campo obligatorio',
      ),
      24 => 
      array (
        'pregunta' => 'VARCHAR(255)',
        'opciones' => 
        array (
          0 => 'Texto hasta 255',
          1 => 'Número',
          2 => 'Fecha',
          3 => 'Booleano',
        ),
        'correcta' => 'Texto hasta 255',
      ),
      25 => 
      array (
        'pregunta' => 'INT',
        'opciones' => 
        array (
          0 => 'Entero',
          1 => 'Decimal',
          2 => 'Texto',
          3 => 'Fecha',
        ),
        'correcta' => 'Entero',
      ),
      26 => 
      array (
        'pregunta' => 'DECIMAL(10,2)',
        'opciones' => 
        array (
          0 => '10 dígitos, 2 decimales',
          1 => 'Entero',
          2 => 'Texto',
          3 => 'Fecha',
        ),
        'correcta' => '10 dígitos, 2 decimales',
      ),
      27 => 
      array (
        'pregunta' => 'DATE',
        'opciones' => 
        array (
          0 => 'Fecha',
          1 => 'Hora',
          2 => 'Texto',
          3 => 'Número',
        ),
        'correcta' => 'Fecha',
      ),
      28 => 
      array (
        'pregunta' => 'SI 2025: PostgreSQL crece',
        'opciones' => 
        array (
          0 => '+30% anual',
          1 => '0%',
          2 => '-10%',
          3 => 'Estable',
        ),
        'correcta' => '+30% anual',
      ),
      29 => 
      array (
        'pregunta' => 'Transacción ACID',
        'opciones' => 
        array (
          0 => 'Atomicidad, Consistencia...',
          1 => 'Velocidad',
          2 => 'Seguridad',
          3 => 'Nada',
        ),
        'correcta' => 'Atomicidad, Consistencia...',
      ),
    ),
  ),
  1 => 
  array (
    'materia' => 'Programación',
    'slug' => 'python-sqlite',
    'titulo' => 'Python + SQLite: Bases de Datos en el Navegador',
    'contenido' => '<!-- INICIO LECCIÓN CYBERPUNK PROGRAMACIÓN -->
<div class="leccion-container leccion-programacion-python-sqlite" data-tema="python-sqlite">
    
    <!-- 1️⃣ INTRODUCCIÓN CONCEPTUAL CYBERPUNK -->
    <header class="leccion-header">
        <h1 class="titulo-leccion neon-glow">
            <span class="icon-tema">🐍</span>
            PYTHON + SQLITE
        </h1>
        <div class="subtitulo">
            Desarrollo Serverless en el Navegador con Pyodide
        </div>
    </header>
    <section class="panel-objetivos">
        <h2 class="seccion-titulo neon-concepto">
            <span class="icon">🎯</span> OBJETIVOS DE APRENDIZAJE
        </h2>
        <div class="objetivos-grid">
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Entender SQLite como DB embebida</h3>
                <p>Crear tablas, insertar datos, consultas básicas</p>
            </div>
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Integrar Python con SQLite</h3>
                <p>Usar sqlite3 module, cursores, commits</p>
            </div>
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Ejecutar Python en navegador</h3>
                <p>Pyodide para código client-side</p>
            </div>
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Manejar DB en memoria</h3>
                <p>Aplicaciones offline, prototipos rápidos</p>
            </div>
        </div>
    </section>
    <section class="contexto-real">
        <h2 class="seccion-titulo neon-dato">
            <span class="icon">🌍</span> APLICACIÓN EN EL MUNDO REAL
        </h2>
        <div class="contexto-grid">
            <div class="contexto-card">
                <h3>📱 Apps Móviles</h3>
                <p>Almacenamiento local sin servidor</p>
                <div class="dato-neon">Android usa SQLite</div>
            </div>
            <div class="contexto-card">
                <h3>🌐 Web Offline</h3>
                <p>DB en browser con Pyodide/WASM</p>
                <div class="dato-neon">Zero install</div>
            </div>
            <div class="contexto-card">
                <h3>🤖 IoT Devices</h3>
                <p>DB ligera en hardware limitado</p>
                <div class="dato-neon">NASA compliant</div>
            </div>
        </div>
        <div class="relacion-curricular">
            <h3>RELACIÓN CURRICULAR</h3>
            <div class="badges">
                <span class="badge">Competencia: Programación de Datos</span>
                <span class="badge">Contenido: DB Embebidas</span>
                <span class="badge">Evaluación: Proyecto Web DB</span>
            </div>
        </div>
    </section>

    <!-- 2️⃣ DESARROLLO TEÓRICO ESTRUCTURADO -->
    <section class="teoria-section">
        <div class="borde-neon-lateral"></div>
        <h2 class="seccion-titulo neon-concepto">
            <span class="icon">📚</span> FUNDAMENTOS PYTHON + SQLITE
        </h2>
       
        <!-- INTRODUCCIÓN -->
        <div class="subseccion">
            <h3>1. SQLite: DB Embebida</h3>
            <div class="definicion-principal">
                <div class="def-card">
                    <h4>🗄️ SQLITE</h4>
                    <p>Biblioteca C que proporciona DB relacional ligera, sin servidor, en un archivo o memoria.</p>
                    <div class="principios-grid">
                        <div class="principio">
                            <div class="principio-icon">⚡</div>
                            <h5>Ligera</h5>
                            <p>~500KB, cero config</p>
                        </div>
                        <div class="principio">
                            <div class="principio-icon">🔒</div>
                            <h5>ACID</h5>
                            <p>Transacciones atómicas</p>
                        </div>
                        <div class="principio">
                            <div class="principio-icon">🌐</div>
                            <h5>Cross-platform</h5>
                            <p>Browser, mobile, desktop</p>
                        </div>
                    </div>
                </div>
            </div>
           
            <div class="clasificacion-doble">
                <div class="clas-card sql">
                    <h4>📝 SQL en SQLite</h4>
                    <ul>
                        <li><strong>DDL:</strong> CREATE TABLE/VIEW/INDEX</li>
                        <li><strong>DML:</strong> INSERT/UPDATE/DELETE</li>
                        <li><strong>Query:</strong> SELECT con JOINs</li>
                        <li><strong>Especial:</strong> PRAGMA, VACUUM</li>
                    </ul>
                    <div class="ejemplos">
                        <strong>Límites:</strong> No RIGHT/FULL JOIN nativo
                    </div>
                </div>
               
                <div class="clas-card python">
                    <h4>🐍 Python Integration</h4>
                    <ul>
                        <li><strong>Module:</strong> import sqlite3</li>
                        <li><strong>Connection:</strong> conn = sqlite3.connect()</li>
                        <li><strong>Cursor:</strong> c = conn.cursor()</li>
                        <li><strong>Execute:</strong> c.execute(sql)</li>
                    </ul>
                    <div class="ejemplos">
                        <strong>Ventaja:</strong> Built-in en Python stdlib
                    </div>
                </div>
            </div>
        </div>
        <!-- CONEXIÓN Y OPERACIONES -->
        <div class="subseccion">
            <h3>2. Conexión y Operaciones Básicas</h3>
            <div class="comparativa-grid">
                <div class="comp-card pk">
                    <div class="comp-header">
                        <h4>🧠 DB en Memoria</h4>
                        <div class="comp-badge">Temporal</div>
                    </div>
                    <div class="comp-caracteristicas">
                        <p><strong>Definición:</strong> Datos en RAM, se pierden al cerrar</p>
                        <p><strong>Características:</strong></p>
                        <ul>
                            <li>Rápida (no I/O disco)</li>
                            <li>Ideal para tests/prototipos</li>
                            <li>connect(\':memory:\')</li>
                            <li>Size limitada por RAM</li>
                        </ul>
                    </div>
                    <div class="comp-ejemplos">
                        <div class="ejemplo-item">
                            <div class="codigo">conn = sqlite3.connect(\':memory:\')</div>
                            <div class="desc">DB volátil</div>
                        </div>
                    </div>
                </div>
               
                <div class="comp-card fk">
                    <div class="comp-header">
                        <h4>💾 DB en Archivo</h4>
                        <div class="comp-badge">Persistente</div>
                    </div>
                    <div class="comp-caracteristicas">
                        <p><strong>Definición:</strong> Datos en archivo .db</p>
                        <p><strong>Características:</strong></p>
                        <ul>
                            <li>Persiste entre sesiones</li>
                            <li>Portátil (un solo file)</li>
                            <li>connect(\'mi.db\')</li>
                            <li>Multi-thread safe</li>
                        </ul>
                    </div>
                    <div class="comp-ejemplos">
                        <div class="ejemplo-item">
                            <div class="codigo">conn = sqlite3.connect(\'data.db\')</div>
                            <div class="desc">DB permanente</div>
                        </div>
                    </div>
                </div>
            </div>
           
            <div class="regla-oro">
                <h4>⚡ REGLA DE ORO: Commit & Close</h4>
                <div class="regla-content">
                    <div class="regla-item">
                        <div class="regla-icon">💾</div>
                        <div class="regla-text">
                            <strong>Commit:</strong> conn.commit() para guardar cambios
                        </div>
                    </div>
                    <div class="regla-item">
                        <div class="regla-icon">🛑</div>
                        <div class="regla-text">
                            <strong>Close:</strong> conn.close() para liberar recursos
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- OPERACIONES SQL -->
        <div class="subseccion">
            <h3>3. Operaciones SQL en Python</h3>
            <div class="tabla-interactiva">
                <table class="tabla-cyberpunk">
                    <thead>
                        <tr>
                            <th>TIPO</th>
                            <th>EJEMPLO PYTHON</th>
                            <th>DESCRIPCIÓN</th>
                            <th>RETORNO</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr data-tipo="create">
                            <td><strong class="neon-concepto">CREATE</strong></td>
                            <td><code>c.execute(\'CREATE TABLE t (col INT)\')</code></td>
                            <td>Crea estructura</td>
                            <td>None</td>
                        </tr>
                        <tr data-tipo="insert">
                            <td><strong class="neon-concepto">INSERT</strong></td>
                            <td><code>c.executemany(\'INSERT INTO t VALUES (?)\', [(1,),(2,)])</code></td>
                            <td>Agrega datos</td>
                            <td>None</td>
                        </tr>
                        <tr data-tipo="select">
                            <td><strong class="neon-concepto">SELECT</strong></td>
                            <td><code>c.execute(\'SELECT * FROM t\'); rows = c.fetchall()</code></td>
                            <td>Consulta datos</td>
                            <td>List of tuples</td>
                        </tr>
                    </tbody>
                </table>
                <div class="tabla-info" id="infoOperacion">
                    Selecciona una operación para ver detalles
                </div>
            </div>
           
            <div class="operacion-ejemplos">
                <div class="ejemplo-detalle" id="detalleCreate" style="display: none;">
                    <h4>🔍 CREATE en Detalle</h4>
                    <div class="analisis-content">
                        <div class="analisis-item">
                            <h5>📝 Código Ejemplo</h5>
                            <pre><code>c.execute(\'\'\'CREATE TABLE stocks
(date text, trans text, symbol text, qty real, price real)\'\'\')</code></pre>
                        </div>
                        <div class="analisis-item">
                            <h5>🎯 Tipos de Datos</h5>
                            <ul>
                                <li>NULL</li>
                                <li>INTEGER</li>
                                <li>REAL</li>
                                <li>TEXT</li>
                                <li>BLOB</li>
                            </ul>
                        </div>
                    </div>
                </div>
               
                <div class="ejemplo-detalle" id="detalleInsert" style="display: none;">
                    <h4>🔍 INSERT en Detalle</h4>
                    <div class="analisis-content">
                        <div class="analisis-item">
                            <h5>📝 Código Ejemplo</h5>
                            <pre><code>purchases = [(\'2006-03-28\', \'BUY\', \'IBM\', 1000, 45.00),
             (\'2006-04-05\', \'BUY\', \'MSFT\', 1000, 72.00),
             (\'2006-04-06\', \'SELL\', \'IBM\', 500, 53.00),]
c.executemany(\'INSERT INTO stocks VALUES (?,?,?,?,?)\', purchases)</code></pre>
                        </div>
                        <div class="analisis-item">
                            <h5>🎯 Best Practices</h5>
                            <ul>
                                <li>Use placeholders ? para seguridad</li>
                                <li>executemany para batch inserts</li>
                                <li>Commit después de cambios</li>
                            </ul>
                        </div>
                    </div>
                </div>
               
                <div class="ejemplo-detalle" id="detalleSelect" style="display: none;">
                    <h4>🔍 SELECT en Detalle</h4>
                    <div class="analisis-content">
                        <div class="analisis-item">
                            <h5>📝 Código Ejemplo</h5>
                            <pre><code>for row in c.execute(\'SELECT * FROM stocks ORDER BY price\'):
    print(row)</code></pre>
                        </div>
                        <div class="analisis-item">
                            <h5>🎯 Métodos Cursor</h5>
                            <ul>
                                <li>fetchone(): Un row</li>
                                <li>fetchmany(size): Varios</li>
                                <li>fetchall(): Todos</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- PYODIDE INTEGRATION -->
        <div class="subseccion">
            <h3>4. Pyodide: Python en Browser</h3>
            <p class="principio-clave">
                <strong>Objetivo:</strong> Ejecutar Python nativo en WebAssembly, sin backend.
            </p>
           
            <div class="pyodide-grid">
                <div class="py-card" data-py="core">
                    <div class="py-header">
                        <div class="py-badge">Core</div>
                        <h4>Pyodide Base</h4>
                    </div>
                    <div class="py-content">
                        <p><strong>Reglas:</strong></p>
                        <ul>
                            <li>loadPyodide()</li>
                            <li>runPythonAsync(code)</li>
                            <li>Paquetes via loadPackage</li>
                        </ul>
                        <div class="py-ejemplo">
                            <strong>✅ Uso:</strong> <code>await pyodide.loadPackage(\'sqlite3\')</code>
                        </div>
                    </div>
                </div>
               
                <div class="py-card" data-py="limits">
                    <div class="py-header">
                        <div class="py-badge">Limits</div>
                        <h4>Límites</h4>
                    </div>
                    <div class="py-content">
                        <p><strong>Reglas:</strong></p>
                        <ul>
                            <li>No filesystem real</li>
                            <li>RAM browser-limited</li>
                            <li>No threads nativos</li>
                        </ul>
                        <div class="py-ejemplo">
                            <strong>❌ Evitar:</strong> Grandes datasets
                        </div>
                    </div>
                </div>
               
                <div class="py-card" data-py="best">
                    <div class="py-header">
                        <div class="py-badge">Best</div>
                        <h4>Best Practices</h4>
                    </div>
                    <div class="py-content">
                        <p><strong>Reglas:</strong></p>
                        <ul>
                            <li>Cargar una vez</li>
                            <li>Redirigir stdout</li>
                            <li>Manejar errors</li>
                        </ul>
                        <div class="py-ejemplo">
                            <strong>✅ Código:</strong> sys.stdout = StringIO()
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 3️⃣ VISUALIZACIÓN DIDÁCTICA INTERACTIVA -->
    <section class="visualizacion-section">
        <h2 class="seccion-titulo neon-interactivo">
            <span class="icon">📊</span> VISUALIZACIÓN DIDÁCTICA INTERACTIVA
        </h2>
        <div class="diagrama-container">
            <div class="diagrama-controls">
                <h3>🏗️ FLUJO PYTHON + SQLITE</h3>
            </div>
           
            <div class="diagrama-visual">
                <svg viewBox="0 0 800 500" id="svgDiagrama" class="er-diagram-interactive">
                    <defs>
                        <marker id="arrow" markerWidth="10" markerHeight="10" refX="9" refY="3" orient="auto">
                            <path d="M0,0 L0,6 L9,3 z" fill="#39FF14"/>
                        </marker>
                    </defs>
                    <rect width="800" height="500" fill="none"/>
                    
                    <!-- Python Box -->
                    <rect x="100" y="200" width="200" height="100" rx="10" fill="rgba(0,188,212,0.5)" stroke="#00ff00" stroke-width="3"/>
                    <text x="200" y="250" fill="#ffffff" text-anchor="middle" font-size="24" style="text-shadow: 0 0 5px #00ff00">Python Code</text>
                    
                    <!-- SQLite Box -->
                    <rect x="500" y="200" width="200" height="100" rx="10" fill="rgba(0,96,100,0.5)" stroke="#ff00ff" stroke-width="3"/>
                    <text x="600" y="250" fill="#ffffff" text-anchor="middle" font-size="24" style="text-shadow: 0 0 5px #ff00ff">SQLite DB</text>
                    
                    <!-- Connection -->
                    <line x1="300" y1="250" x2="500" y2="250" stroke="#ffff00" stroke-width="6" marker-end="url(#arrow)"/>
                    <text x="400" y="240" fill="#ffff00" text-anchor="middle" font-size="18" style="text-shadow: 0 0 5px #ffff00">sqlite3.connect()</text>
                    
                    <!-- Operations -->
                    <text x="400" y="280" fill="#ffffff" text-anchor="middle" font-size="16" style="text-shadow: 0 0 5px #00ffff">execute(), commit(), fetch()</text>
                    
                    <!-- Browser Note -->
                    <text x="400" y="350" fill="#00ff88" text-anchor="middle" font-size="20" style="text-shadow: 0 0 5px #00ff88">Pyodide: Python in WASM</text>
                </svg>
               
                <div class="diagrama-info" id="diagramInfo">
                    Diagrama de integración Python-SQLite en browser (colores ajustados para visibilidad)
                </div>
            </div>
        </div>
    </section>

    <!-- 4️⃣ BLOQUES INTERACTIVOS REALES -->
    <section class="interactivos-section">
        <h2 class="seccion-titulo neon-interactivo">
            <span class="icon">🎮</span> BLOQUES INTERACTIVOS REALES
        </h2>
        <!-- SIMULADOR INTERACTIVO (OBLIGATORIO) -->
        <div class="simulator-container" data-tema="python-sqlite">
            <style>
                .sim-wrap{padding:1rem 0;}
                .sim-tabs{display:flex;gap:8px;margin-bottom:12px;flex-wrap:wrap;}
                .sim-tab{padding:8px 16px;border:1px solid rgba(255,255,255,.12);border-radius:999px;background:rgba(255,255,255,.05);color:var(--color-text-secondary);cursor:pointer;transition:all .15s;}
                .sim-tab.active{background:var(--color-background-secondary);color:var(--color-text-primary);border-color:var(--color-border-primary);}
                .sim-tab:hover:not(.active){background:rgba(255,255,255,.1);}
                .snippets-bar{display:flex;gap:8px;flex-wrap:wrap;align-items:center;margin-bottom:14px;}
                .snippet-btn{padding:7px 14px;border:1px solid rgba(255,255,255,.12);border-radius:999px;background:transparent;color:var(--color-text-secondary);cursor:pointer;transition:all .15s;}
                .snippet-btn:hover{background:rgba(255,255,255,.08);}
                .editor-panel{display:grid;grid-template-columns:1fr 1fr;gap:14px;}
                @media(max-width:860px){.editor-panel{grid-template-columns:1fr;}}
                .panel-card{border:1px solid rgba(255,255,255,.12);border-radius:18px;overflow:hidden;background:var(--color-background-primary);}
                .panel-header{display:flex;align-items:center;justify-content:space-between;padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.08);background:var(--color-background-secondary);}
                .panel-title{font-size:12px;font-weight:600;color:var(--color-text-secondary);text-transform:uppercase;letter-spacing:.08em;}
                .editor-area{width:100%;min-height:320px;padding:16px;font-family:var(--font-mono);font-size:13px;line-height:1.7;color:var(--color-text-primary);background:transparent;border:none;outline:none;resize:vertical;}
                .output-area{min-height:320px;padding:16px;font-family:var(--font-mono);font-size:13px;line-height:1.6;white-space:pre-wrap;color:var(--color-text-primary);overflow:auto;background:transparent;}
                .output-placeholder{color:var(--color-text-tertiary);font-style:italic;}
                .toolbar{display:flex;align-items:center;gap:10px;padding:12px 16px;background:var(--color-background-secondary);border-top:1px solid rgba(255,255,255,.08);flex-wrap:wrap;}
                .btn-run,.btn-sm{padding:8px 16px;border-radius:999px;border:1px solid rgba(255,255,255,.12);background:transparent;color:var(--color-text-secondary);cursor:pointer;transition:all .15s;}
                .btn-run{background:var(--color-background-success);color:var(--color-text-success);border-color:var(--color-border-success);}
                .btn-run:hover,.btn-sm:hover{opacity:.92;}
                .status-pill{padding:6px 14px;border-radius:999px;font-size:11px;white-space:nowrap;}
                .status-idle{background:rgba(255,255,255,.05);color:var(--color-text-tertiary);}
                .status-running{background:rgba(8,182,255,.14);color:var(--color-text-info);}
                .status-done{background:rgba(56,227,68,.14);color:var(--color-text-success);}
                .status-error{background:rgba(255,77,79,.14);color:var(--color-text-danger);}
                .info-bar{display:grid;grid-template-columns:repeat(3,1fr);gap:10px;margin-top:14px;}
                .data-card{padding:14px;background:var(--color-background-secondary);border:1px solid rgba(255,255,255,.08);border-radius:16px;}
                .data-label{font-size:11px;color:var(--color-text-tertiary);margin-bottom:4px;}
                .data-value{font-size:14px;font-weight:700;color:var(--color-text-primary);}
                .consejos-sql{margin-top:16px;padding:14px;background:var(--color-background-secondary);border:1px solid rgba(255,255,255,.08);border-radius:16px;}
                .consejo-item{display:flex;align-items:flex-start;gap:10px;margin-top:10px;font-size:13px;color:var(--color-text-primary);}
                .loading-bar{height:2px;background:rgba(255,255,255,.08);overflow:hidden;display:none;}
                .loading-bar-fill{height:100%;width:0;background:var(--color-text-info);transition:width .3s;}
                .line-count{font-size:11px;color:var(--color-text-tertiary);padding:8px 16px;border-top:1px solid rgba(255,255,255,.08);}
            </style>
            <div class="sim-wrap">
                <div class="sim-tabs">
                    <button class="sim-tab active" onclick="setTab(0)">Libre</button>
                    <button class="sim-tab" onclick="setTab(1)">Crear tabla</button>
                    <button class="sim-tab" onclick="setTab(2)">Insert batch</button>
                    <button class="sim-tab" onclick="setTab(3)">Consulta SELECT</button>
                    <button class="sim-tab" onclick="setTab(4)">Transacción</button>
                </div>
                <div class="snippets-bar">
                    <span class="snippets-label">Insertar:</span>
                    <button class="snippet-btn" onclick="insertSnippet(\'conn\')">connect()</button>
                    <button class="snippet-btn" onclick="insertSnippet(\'create\')">CREATE TABLE</button>
                    <button class="snippet-btn" onclick="insertSnippet(\'insert\')">INSERT</button>
                    <button class="snippet-btn" onclick="insertSnippet(\'select\')">SELECT</button>
                    <button class="snippet-btn" onclick="insertSnippet(\'commit\')">commit()</button>
                    <button class="snippet-btn" onclick="insertSnippet(\'fetchall\')">fetchall()</button>
                </div>
                <div class="editor-panel">
                    <div class="panel-card">
                        <div class="panel-header">
                            <div class="panel-title">Editor — Python</div>
                        </div>
                        <div class="loading-bar" id="loadingBar"><div class="loading-bar-fill" id="loadingFill"></div></div>
                        <textarea id="codeEditor" class="editor-area" spellcheck="false" autocorrect="off" autocapitalize="off" onkeydown="handleTab(event)" oninput="updateLineCount()"></textarea>
                        <div class="line-count" id="lineCount">1 línea</div>
                        <div class="toolbar">
                            <button class="btn-run" id="runBtn" onclick="runCode()">▶ Ejecutar</button>
                            <button class="btn-sm" onclick="clearOutput()">Limpiar salida</button>
                            <button class="btn-sm" onclick="resetEditor()">Restablecer</button>
                            <span class="status-pill status-idle" id="statusPill">inactivo</span>
                        </div>
                    </div>
                    <div class="panel-card">
                        <div class="panel-header">
                            <div class="panel-title">Salida</div>
                        </div>
                        <div id="outputArea" class="output-area">
                            <span class="output-placeholder">Cargando Pyodide... (primera vez ~10s)</span>
                        </div>
                    </div>
                </div>
                <div class="info-bar">
                    <div class="data-card">
                        <div class="data-label">Motor</div>
                        <div class="data-value">Pyodide 0.26.1</div>
                    </div>
                    <div class="data-card">
                        <div class="data-label">Módulo</div>
                        <div class="data-value">sqlite3 built-in</div>
                    </div>
                    <div class="data-card">
                        <div class="data-label">Estado</div>
                        <div class="data-value" id="envChip">Cargando...</div>
                    </div>
                </div>
            </div>
            <div class="simulator-data">
                <h3>🔍 INFO EJECUCIÓN</h3>
                <div class="data-card">
                    <div class="data-label">Versión Pyodide:</div>
                    <div class="data-value">0.26.1</div>
                </div>
                <div class="data-card">
                    <div class="data-label">Paquetes Cargados:</div>
                    <div class="data-value">sqlite3</div>
                </div>
                <div class="consejos-sql">
                    <h4>💡 CONSEJOS</h4>
                    <div class="consejo-item">
                        <span class="consejo-icon">🎯</span>
                        <span class="consejo-text">Usa placeholders ? para SQL seguro</span>
                    </div>
                    <div class="consejo-item">
                        <span class="consejo-icon">⚡</span>
                        <span class="consejo-text">Commit después de cambios</span>
                    </div>
                    <div class="consejo-item">
                        <span class="consejo-icon">📊</span>
                        <span class="consejo-text">Close conn al finalizar</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 5️⃣ QUIZ AUTOEVALUADO CON FEEDBACK -->
    <section class="quiz-section">
        <h2 class="seccion-titulo neon-evaluacion">
            <span class="icon">❓</span> QUIZ PYTHON + SQLITE
        </h2>
       
        <div class="quiz-container">
            <!-- PREGUNTA 1 -->
            <div class="quiz-question" data-correct="B">
                <div class="quiz-header">
                    <span class="quiz-num">01</span>
                    <h3>¿Qué hace sqlite3.connect(\':memory:\')?</h3>
                </div>
               
                <div class="quiz-options">
                    <button class="quiz-option" data-value="A">
                        <span class="option-letter">A</span>
                        Conecta a archivo
                    </button>
                    <button class="quiz-option" data-value="B">
                        <span class="option-letter">B</span>
                        DB en RAM temporal
                    </button>
                    <button class="quiz-option" data-value="C">
                        <span class="option-letter">C</span>
                        Servidor remoto
                    </button>
                    <button class="quiz-option" data-value="D">
                        <span class="option-letter">D</span>
                        Lee CSV
                    </button>
                </div>
               
                <div class="quiz-feedback" style="display: none;">
                    <div class="feedback-correct">
                        ✅ <strong>Correcto:</strong> Crea DB en memoria.
                    </div>
                    <div class="feedback-incorrect">
                        ❌ <strong>Incorrecto:</strong> Revisa conexión.
                    </div>
                    <div class="feedback-explicacion">
                        <p><strong>Explicación:</strong> \':memory:\' es DB volátil en RAM, ideal para tests.</p>
                    </div>
                </div>
            </div>
           
            <!-- PREGUNTA 2 -->
            <div class="quiz-question" data-correct="C">
                <div class="quiz-header">
                    <span class="quiz-num">02</span>
                    <h3>¿Para qué sirve conn.commit()?</h3>
                </div>
               
                <div class="quiz-options">
                    <button class="quiz-option" data-value="A">
                        <span class="option-letter">A</span>
                        Cierra conexión
                    </button>
                    <button class="quiz-option" data-value="B">
                        <span class="option-letter">B</span>
                        Ejecuta query
                    </button>
                    <button class="quiz-option" data-value="C">
                        <span class="option-letter">C</span>
                        Guarda cambios
                    </button>
                    <button class="quiz-option" data-value="D">
                        <span class="option-letter">D</span>
                        Fetch rows
                    </button>
                </div>
               
                <div class="quiz-feedback" style="display: none;">
                    <div class="feedback-correct">
                        ✅ <strong>Correcto:</strong> Persiste transacciones.
                    </div>
                    <div class="feedback-incorrect">
                        ❌ <strong>Incorrecto:</strong> Revisa ACID.
                    </div>
                    <div class="feedback-explicacion">
                        <p><strong>Regla:</strong> Sin commit, cambios se pierden al cerrar conn.</p>
                    </div>
                </div>
            </div>
           
            <!-- PREGUNTA 3 -->
            <div class="quiz-question" data-correct="D">
                <div class="quiz-header">
                    <span class="quiz-num">03</span>
                    <h3>¿Qué método usa placeholders seguros?</h3>
                </div>
               
                <div class="quiz-options">
                    <button class="quiz-option" data-value="A">
                        <span class="option-letter">A</span>
                        execute(f-string)
                    </button>
                    <button class="quiz-option" data-value="B">
                        <span class="option-letter">B</span>
                        execute + concat
                    </button>
                    <button class="quiz-option" data-value="C">
                        <span class="option-letter">C</span>
                        execute % vars
                    </button>
                    <button class="quiz-option" data-value="D">
                        <span class="option-letter">D</span>
                        executemany con ?
                    </button>
                </div>
               
                <div class="quiz-feedback" style="display: none;">
                    <div class="feedback-correct">
                        ✅ <strong>Correcto:</strong> Previene SQL injection.
                    </div>
                    <div class="feedback-incorrect">
                        ❌ <strong>Incorrecto:</strong> Evita concatenación.
                    </div>
                    <div class="feedback-explicacion">
                        <p><strong>Tip:</strong> Siempre usa ? y tuples para params.</p>
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

    <!-- 6️⃣ SECCIÓN "ERRORES COMUNES" INTERACTIVA -->
    <section class="errores-section">
        <h2 class="seccion-titulo neon-alerta">
            <span class="icon">⚠️</span> ERRORES COMUNES INTERACTIVOS
        </h2>
        <div class="errores-container">
            <div class="error-card collapsible">
                <div class="error-header">
                    <h3>Error 1: Olvidar Commit</h3>
                    <div class="collapse-icon">+</div>
                </div>
                <div class="error-content" style="display: none;">
                    <div class="error-ejemplo">
                        <pre><code># ❌ Mal
c.execute("INSERT INTO t VALUES (1)")
# Sin conn.commit()</code></pre>
                    </div>
                    <div class="error-explicacion">
                        <p>Cambios no se guardan. Solución: Siempre commit después DML.</p>
                    </div>
                    <div class="error-practica">
                        <p>Prueba: Corrige el código</p>
                        <textarea class="practica-input" placeholder="Escribe la corrección..."></textarea>
                        <button class="btn-verificar" onclick="verificarError(1, this)">Verificar</button>
                        <div class="practica-feedback"></div>
                    </div>
                </div>
            </div>
            <div class="error-card collapsible">
                <div class="error-header">
                    <h3>Error 2: SQL Injection</h3>
                    <div class="collapse-icon">+</div>
                </div>
                <div class="error-content" style="display: none;">
                    <div class="error-ejemplo">
                        <pre><code># ❌ Mal
user = input()
c.execute(f"SELECT * FROM users WHERE name = \'{user}\'")</code></pre>
                    </div>
                    <div class="error-explicacion">
                        <p>Vulnerable a ataques. Solución: Usar placeholders.</p>
                    </div>
                    <div class="error-practica">
                        <p>Prueba: Corrige con ?</p>
                        <textarea class="practica-input" placeholder="Escribe la corrección..."></textarea>
                        <button class="btn-verificar" onclick="verificarError(2, this)">Verificar</button>
                        <div class="practica-feedback"></div>
                    </div>
                </div>
            </div>
            <div class="error-card collapsible">
                <div class="error-header">
                    <h3>Error 3: No Cerrar Conn</h3>
                    <div class="collapse-icon">+</div>
                </div>
                <div class="error-content" style="display: none;">
                    <div class="error-ejemplo">
                        <pre><code># ❌ Mal
conn = sqlite3.connect(\'db.db\')
# Código...
# Sin conn.close()</code></pre>
                    </div>
                    <div class="error-explicacion">
                        <p>Leaks recursos. Solución: Usar with o close.</p>
                    </div>
                    <div class="error-practica">
                        <p>Prueba: Añade close</p>
                        <textarea class="practica-input" placeholder="Escribe la corrección..."></textarea>
                        <button class="btn-verificar" onclick="verificarError(3, this)">Verificar</button>
                        <div class="practica-feedback"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 7️⃣ PROBLEMAS TIPO EXAMEN -->
    <section class="problemas-section">
        <h2 class="seccion-titulo neon-evaluacion">
            <span class="icon">📝</span> PROBLEMAS TIPO EXAMEN
        </h2>
        <div class="problemas-container">
            <div class="problema-card">
                <h3>Problema 1 (Desarrollo)</h3>
                <p>Crea DB SQLite en Python para tienda: productos, ventas. Inserta data y query total ventas.</p>
                <textarea class="respuesta-area" placeholder="Escribe tu código..."></textarea>
                <div class="rubrica">
                    <p>Rúbrica: 40% Estructura, 30% Queries, 30% Seguridad</p>
                </div>
            </div>
            <div class="problema-card">
                <h3>Problema 2 (Interpretación)</h3>
                <p>Explica: c.executemany(sql, params) vs execute loop. Ventajas?</p>
                <textarea class="respuesta-area" placeholder="Escribe tu interpretación..."></textarea>
                <div class="rubrica">
                    <p>Rúbrica: 50% Eficiencia, 50% Seguridad</p>
                </div>
            </div>
            <div class="problema-card">
                <h3>Problema 3 (Razonamiento)</h3>
                <p>¿Por qué SQLite sobre MySQL para app desktop?</p>
                <textarea class="respuesta-area" placeholder="Escribe tu justificación..."></textarea>
                <div class="rubrica">
                    <p>Rúbrica: 60% Ventajas, 40% Ejemplos</p>
                </div>
            </div>
        </div>
    </section>

    <!-- 8️⃣ CIERRE METACOGNITIVO INTERACTIVO -->
    <section class="cierre-section">
        <h2 class="seccion-titulo neon-concepto">
            <span class="icon">🧠</span> CIERRE METACOGNITIVO INTERACTIVO
        </h2>
       
        <div class="cierre-container">
            <div class="autoevaluacion">
                <h3>📊 AUTOEVALUACIÓN DE HABILIDADES</h3>
                <div class="skill-meter">
                    <div class="skill-item">
                        <span>Conexión DB:</span>
                        <div class="skill-bar">
                            <div class="skill-fill" data-level="0" style="width: 0%"></div>
                        </div>
                        <input type="range" min="0" max="100" value="0" class="skill-slider" data-skill="conexion">
                    </div>
                   
                    <div class="skill-item">
                        <span>Queries SQL:</span>
                        <div class="skill-bar">
                            <div class="skill-fill" data-level="0" style="width: 0%"></div>
                        </div>
                        <input type="range" min="0" max="100" value="0" class="skill-slider" data-skill="queries">
                    </div>
                   
                    <div class="skill-item">
                        <span>Pyodide Uso:</span>
                        <div class="skill-bar">
                            <div class="skill-fill" data-level="0" style="width: 0%"></div>
                        </div>
                        <input type="range" min="0" max="100" value="0" class="skill-slider" data-skill="pyodide">
                    </div>
                   
                    <div class="skill-item">
                        <span>Error Handling:</span>
                        <div class="skill-bar">
                            <div class="skill-fill" data-level="0" style="width: 0%"></div>
                        </div>
                        <input type="range" min="0" max="100" value="0" class="skill-slider" data-skill="errors">
                    </div>
                </div>
               
                <button class="btn-guardar" onclick="guardarHabilidades()">
                    💾 GUARDAR EVALUACIÓN
                </button>
            </div>
           
            <div class="reflexion">
                <h3>💭 REFLEXIÓN GUIADA</h3>
                <div class="pregunta-reflexion">
                    <p>¿Cómo cambia Pyodide el desarrollo web?</p>
                    <textarea placeholder="Escribe tu reflexión..." rows="3" id="reflexion1"></textarea>
                </div>
                <div class="pregunta-reflexion">
                    <p>Caso real donde SQLite es ideal vs server DB.</p>
                    <textarea placeholder="Escribe tu ejemplo..." rows="3" id="reflexion2"></textarea>
                </div>
            </div>
        </div>
       
        <div class="proyecto-final">
            <h3>🎯 PROYECTO FINAL: TODO APP</h3>
            <div class="proyecto-enunciado">
                <p><strong>Objetivo:</strong> Crea app TODO con SQLite en Python browser:</p>
                <ul>
                    <li>Tabla tasks (id, desc, done)</li>
                    <li>Funcs add, list, complete</li>
                    <li>Persist in memory</li>
                    <li>UI simple en console</li>
                </ul>
                <p><strong>Requisitos:</strong> Secure params, error handling, queries complejas.</p>
            </div>
            <button class="btn-proyecto" onclick="mostrarEsqueletoProyecto()">
                📝 VER ESQUELETO
            </button>
            <div class="proyecto-solucion" id="proyectoSolucion" style="display: none;">
                <pre><code>import sqlite3
conn = sqlite3.connect(\':memory:\')
c = conn.cursor()
c.execute(\'\'\'CREATE TABLE tasks (
    id INTEGER PRIMARY KEY,
    desc TEXT,
    done BOOLEAN
)\'\'\')
def add_task(desc):
    c.execute("INSERT INTO tasks (desc, done) VALUES (?, 0)", (desc,))
    conn.commit()
# Etc...</code></pre>
            </div>
        </div>
       
        <div class="recursos">
            <h3>🔗 RECURSOS</h3>
            <div class="recursos-links">
                <a href="https://docs.python.org/3/library/sqlite3.html" target="_blank" class="recurso-link">
                    ⚡ SQLite Docs Python
                </a>
                <a href="https://pyodide.org/" target="_blank" class="recurso-link">
                    🎮 Pyodide Site
                </a>
                <a href="https://sqlite.org/" target="_blank" class="recurso-link">
                    📐 SQLite Official
                </a>
                <a href="https://www.sqlitetutorial.net/" target="_blank" class="recurso-link">
                    🚀 SQLite Tutorial
                </a>
            </div>
        </div>
    </section>
</div>

<!-- Pyodide Script -->
<script src="https://cdn.jsdelivr.net/pyodide/v0.26.1/full/pyodide.js"></script>
<script>
// JS PARA LA LECCIÓN
console.log(\'Inicializando lección Programación - Python + SQLite\');

let pyodide = null;
let pyReady = false;
let execCount = 0;

const defaultCode = `import sqlite3
conn = sqlite3.connect(\':memory:\')
c = conn.cursor()
c.execute(\'\'\'CREATE TABLE usuarios (
      id   INTEGER PRIMARY KEY AUTOINCREMENT,
      nombre TEXT NOT NULL,
      edad   INTEGER,
      nivel  TEXT
  )\'\'\')
datos = [
      ("Ana Torres",     17, "Avanzado"),
      ("Luis Ramírez",   18, "Intermedio"),
      ("Sofía Mendoza",  16, "Principiante"),
      ("Marco Vargas",   19, "Avanzado"),
      ("Valeria Castro", 17, "Avanzado"),
  ]
c.executemany("INSERT INTO usuarios (nombre, edad, nivel) VALUES (?,?,?)", datos)
conn.commit()
print(f"{\'ID\':<4} {\'Nombre\':<20} {\'Edad\':<6} Nivel")
print("-" * 46)
for row in c.execute("SELECT * FROM usuarios ORDER BY id"):
      print(f"{row[0]:<4} {row[1]:<20} {row[2]:<6} {row[3]}")
c.execute("SELECT AVG(edad) FROM usuarios")
print(f"\\\\nEdad promedio: {c.fetchone()[0]:.1f} años")
c.execute("SELECT COUNT(*) FROM usuarios WHERE nivel=\'Avanzado\'")
print(f"Usuarios avanzado: {c.fetchone()[0]}")
conn.close()`;

const tabs = [
  defaultCode,
  `import sqlite3
conn = sqlite3.connect(\':memory:\')
c = conn.cursor()

# Crear tabla con restricciones
c.execute(\'\'\'
    CREATE TABLE productos (
          id       INTEGER PRIMARY KEY AUTOINCREMENT,
          nombre   TEXT NOT NULL UNIQUE,
          precio   REAL CHECK(precio > 0),
          stock    INTEGER DEFAULT 0
      )
  \'\'\')
conn.commit()

print("Tabla \'productos\' creada.")

# Verificar estructura con PRAGMA
for col in c.execute("PRAGMA table_info(productos)"):
      print(f"  col {col[1]:12} tipo={col[2]}")
conn.close()`,

  `import sqlite3
conn = sqlite3.connect(\':memory:\')
c = conn.cursor()
c.execute("CREATE TABLE ventas (id INTEGER PRIMARY KEY, producto TEXT, qty INT, total REAL)")

# Insert con executemany — eficiente para lotes
registros = [
      ("Laptop",   2, 2400.00),
      ("Monitor",  3,  900.00),
      ("Teclado",  5,  250.00),
      ("Mouse",   10,  150.00),
      ("Webcam",   4,  320.00),
  ]
c.executemany("INSERT INTO ventas (producto, qty, total) VALUES (?,?,?)", registros)
conn.commit()

print(f"{\'Producto\':<12} {\'Qty\':>5} {\'Total\':>10}")
print("-" * 30)
for row in c.execute("SELECT producto, qty, total FROM ventas ORDER BY total DESC"):
      print(f"{row[0]:<12} {row[1]:>5} \\${row[2]:>9,.2f}")

c.execute("SELECT SUM(total), SUM(qty) FROM ventas")
s = c.fetchone()
print(f"\\\\n{\'TOTAL\':<12} {s[1]:>5} \\${s[0]:>9,.2f}")
conn.close()`,

  `import sqlite3
conn = sqlite3.connect(\':memory:\')
c = conn.cursor()
c.execute("CREATE TABLE empleados (id INT, nombre TEXT, depto TEXT, salario REAL)")
c.executemany("INSERT INTO empleados VALUES (?,?,?,?)", [
      (1,"Ana","TI",   55000),
      (2,"Luis","HR",  42000),
      (3,"Sofía","TI", 61000),
      (4,"Marco","TI", 58000),
      (5,"Eva","HR",   47000),
  ])
conn.commit()

# Agrupación y filtrado
print("Resumen por departamento:")
q = """
      SELECT depto,
             COUNT(*) AS total,
             ROUND(AVG(salario),2) AS promedio,
             MAX(salario) AS maximo
      FROM empleados
      GROUP BY depto
      ORDER BY promedio DESC
  """
print(f"{\'Depto\':<8} {\'Total\':>6} {\'Promedio\':>12} {\'Máximo\':>10}")
print("-" * 40)
for row in c.execute(q):
      print(f"{row[0]:<8} {row[1]:>6} \\${row[2]:>11,.2f} \\${row[3]:>9,.2f}")

# WHERE + ORDER BY
print("\\\\nEmpleados de TI, mayor salario:")
for row in c.execute("SELECT nombre, salario FROM empleados WHERE depto=\'TI\' ORDER BY salario DESC"):
      print(f"  {row[0]}: \\${row[1]:,.2f}")
conn.close()`,

  `import sqlite3
conn = sqlite3.connect(\':memory:\')
c = conn.cursor()
c.execute("CREATE TABLE cuentas (id INT PRIMARY KEY, saldo REAL)")
c.executemany("INSERT INTO cuentas VALUES (?,?)", [(1, 5000.0),(2, 2000.0)])
conn.commit()

def transferir(origen, destino, monto):
      try:
          with conn:  # context manager — auto commit o rollback
              c.execute("SELECT saldo FROM cuentas WHERE id=?", (origen,))
              saldo = c.fetchone()[0]
              if saldo < monto:
                  raise ValueError(f"Fondos insuficientes (saldo: {saldo})")
              c.execute("UPDATE cuentas SET saldo = saldo - ? WHERE id=?", (monto, origen))
              c.execute("UPDATE cuentas SET saldo = saldo + ? WHERE id=?", (monto, destino))
          print(f"Transferencia \\${monto:,.2f} OK: cuenta {origen} → {destino}")
      except Exception as e:
          print(f"Rollback automático: {e}")

print("Saldos iniciales:")
for r in c.execute("SELECT * FROM cuentas"): print(f"  Cuenta {r[0]}: \\${r[1]:,.2f}")

transferir(1, 2, 1500)
transferir(2, 1, 9999)  # debe fallar

print("\\\\nSaldos finales:")
for r in c.execute("SELECT * FROM cuentas"): print(f"  Cuenta {r[0]}: \\${r[1]:,.2f}")
conn.close()`
];

const snippets = {
  conn:    "conn = sqlite3.connect(\':memory:\')\\nc = conn.cursor()\\n",
  create:  "c.execute(\'\'\'CREATE TABLE t (\\n    id INTEGER PRIMARY KEY,\\n    nombre TEXT\\n)\'\'\')\\n",
  insert:  "c.execute(\\"INSERT INTO t (nombre) VALUES (?)\\", (\'valor\',))\\nconn.commit()\\n",
  select:  "for row in c.execute(\'SELECT * FROM t\'):\\n    print(row)\\n",
  commit:  "conn.commit()\\n",
  fetchall:"rows = c.fetchall()\\nprint(rows)\\n"
};

document.getElementById(\'codeEditor\').value = defaultCode;
updateLineCount();

async function initPyodide() {
    const out = document.getElementById(\'outputArea\');
    setStatus(\'running\', \'iniciando\');
    showLoading(true);
    try {
        pyodide = await loadPyodide();
        await pyodide.loadPackage(\'sqlite3\');
        pyReady = true;
        out.innerHTML = \'<span class="output-success">Pyodide listo. Presiona Ejecutar.</span>\';
        document.getElementById(\'envChip\').textContent = \'Listo\';
        setStatus(\'done\', \'listo\');
    } catch (e) {
        out.innerHTML = \'<span class="output-error">Error al cargar Pyodide: \' + e.message + \'</span>\';
        document.getElementById(\'envChip\').textContent = \'Error\';
        setStatus(\'error\', \'error\');
    }
    showLoading(false);
}

async function runCode() {
    if (!pyReady) { alert(\'Pyodide aún cargando...\'); return; }
    const code = document.getElementById(\'codeEditor\').value;
    const out = document.getElementById(\'outputArea\');
    const btn = document.getElementById(\'runBtn\');
    btn.disabled = true;
    setStatus(\'running\', \'ejecutando\');
    showLoading(true);
    out.innerHTML = \'<span class="output-placeholder">Ejecutando...</span>\';
    try {
        await pyodide.runPythonAsync("import sys\\nfrom io import StringIO\\nsys.stdout = StringIO()\\nsys.stderr = sys.stdout");
        await pyodide.runPythonAsync(code);
        const stdout = pyodide.runPython(\'sys.stdout.getvalue()\');
        execCount++;
        out.textContent = stdout || \'(sin salida)\';
        out.className = \'output-area output-success\';
        setStatus(\'done\', \'ok · #\' + execCount);
    } catch (e) {
        out.textContent = e.message;
        out.className = \'output-area output-error\';
        setStatus(\'error\', \'error\');
    }
    btn.disabled = false;
    showLoading(false);
}

function clearOutput() {
    const out = document.getElementById(\'outputArea\');
    out.textContent = \'\';
    out.className = \'output-area\';
    setStatus(\'idle\', \'inactivo\');
}

function resetEditor() {
    const tab = document.querySelectorAll(\'.sim-tab\');
    let active = 0;
    tab.forEach((t, i) => { if (t.classList.contains(\'active\')) active = i; });
    document.getElementById(\'codeEditor\').value = tabs[active];
    updateLineCount();
    clearOutput();
}

function setTab(i) {
    document.querySelectorAll(\'.sim-tab\').forEach((t, j) => t.classList.toggle(\'active\', i === j));
    document.getElementById(\'codeEditor\').value = tabs[i];
    updateLineCount();
    clearOutput();
}

function insertSnippet(key) {
    const ta = document.getElementById(\'codeEditor\');
    const val = snippets[key];
    const start = ta.selectionStart;
    const end = ta.selectionEnd;
    ta.value = ta.value.slice(0, start) + val + ta.value.slice(end);
    ta.selectionStart = ta.selectionEnd = start + val.length;
    ta.focus();
    updateLineCount();
}

function handleTab(e) {
    if (e.key === \'Tab\') {
        e.preventDefault();
        const ta = e.target;
        const s = ta.selectionStart;
        ta.value = ta.value.slice(0, s) + \'    \' + ta.value.slice(ta.selectionEnd);
        ta.selectionStart = ta.selectionEnd = s + 4;
        updateLineCount();
    }
}

function updateLineCount() {
    const lines = document.getElementById(\'codeEditor\').value.split(\'\\n\').length;
    document.getElementById(\'lineCount\').textContent = lines + (lines === 1 ? \' línea\' : \' líneas\');
}

function setStatus(type, label) {
    const pill = document.getElementById(\'statusPill\');
    pill.className = \'status-pill status-\' + type;
    pill.textContent = label;
}

function showLoading(on) {
    const bar = document.getElementById(\'loadingBar\');
    const fill = document.getElementById(\'loadingFill\');
    if (on) {
        bar.style.display = \'block\';
        fill.style.width = \'0%\';
        setTimeout(() => fill.style.width = \'80%\', 50);
    } else {
        fill.style.width = \'100%\';
        setTimeout(() => { bar.style.display = \'none\'; fill.style.width = \'0%\'; }, 400);
    }
}

function cargarEjemplo(num) {
    const ejemplos = {
        1: `# Crear Tabla
import sqlite3
conn = sqlite3.connect(\':memory:\')
c = conn.cursor()
c.execute(\'\'\'CREATE TABLE test (id INT PRIMARY KEY, name TEXT)\'\'\')
print("Tabla creada")`,
        2: `# Insert Batch
import sqlite3
conn = sqlite3.connect(\':memory:\')
c = conn.cursor()
c.execute(\'CREATE TABLE t (val INT)\')
vals = [(1,),(2,),(3,)]
c.executemany(\'INSERT INTO t VALUES (?)\', vals)
conn.commit()
c.execute(\'SELECT * FROM t\')
print(c.fetchall())`,
        3: `# Query Avanzada
import sqlite3
conn = sqlite3.connect(\':memory:\')
c = conn.cursor()
c.execute(\'CREATE TABLE users (name TEXT, age INT)\')
c.executemany(\'INSERT INTO users VALUES (?, ?)\', [(\'A\', 20), (\'B\', 30), (\'C\', 25)])
conn.commit()
c.execute(\'SELECT AVG(age) FROM users WHERE age > 20\')
print("Promedio:", c.fetchone()[0])`,
        4: `# Transacción
import sqlite3
conn = sqlite3.connect(\':memory:\')
c = conn.cursor()
c.execute(\'CREATE TABLE t (val INT)\')
try:
    with conn:
        c.execute(\'INSERT INTO t VALUES (1)\')
        raise Exception("Rollback test")
except:
    print("Rollback ejecutado")
c.execute(\'SELECT * FROM t\')
print("Datos:", c.fetchall())`
    };
    document.getElementById(\'codeEditor\').value = ejemplos[num];
    updateLineCount();
    clearOutput();
}

initPyodide();

// Funciones para objetivos
document.querySelectorAll(\'.objetivo-card\').forEach(card => {
    card.addEventListener(\'click\', () => {
        const completado = card.dataset.completado === \'true\';
        card.dataset.completado = !completado;
        card.querySelector(\'.objetivo-checkbox\').style.background = !completado ? \'var(--neon-concepto)\' : \'\';
        console.log(\'Objetivo toggled:\', card.querySelector(\'h3\').textContent);
    });
});

// Funciones para operaciones
document.querySelectorAll(\'.tabla-cyberpunk tbody tr\').forEach(tr => {
    tr.addEventListener(\'click\', () => {
        const tipo = tr.dataset.tipo;
        document.querySelectorAll(\'.ejemplo-detalle\').forEach(det => det.style.display = \'none\');
        const detalleId = \'detalle\' + tipo.charAt(0).toUpperCase() + tipo.slice(1);
        document.getElementById(detalleId).style.display = \'block\';
        document.getElementById(\'infoOperacion\').textContent = `Detalles para ${tipo.toUpperCase()}`;
        console.log(\'Operación seleccionada:\', tipo);
    });
});

// Funciones para quiz
let quizCompletadas = 0;
document.querySelectorAll(\'.quiz-option\').forEach(option => {
    option.addEventListener(\'click\', () => {
        const question = option.closest(\'.quiz-question\');
        if (question.dataset.answered) return;
        question.dataset.answered = \'true\';
        const value = option.dataset.value;
        const correct = question.dataset.correct;
        const feedback = question.querySelector(\'.quiz-feedback\');
        feedback.style.display = \'block\';
        if (value === correct) {
            option.classList.add(\'correct\');
            feedback.querySelector(\'.feedback-correct\').style.display = \'block\';
            feedback.querySelector(\'.feedback-incorrect\').style.display = \'none\';
        } else {
            option.classList.add(\'incorrect\');
            feedback.querySelector(\'.feedback-correct\').style.display = \'none\';
            feedback.querySelector(\'.feedback-incorrect\').style.display = \'block\';
        }
        quizCompletadas++;
        if (quizCompletadas === 3) mostrarResultadosQuiz();
        console.log(\'Opción seleccionada:\', value, \'Correcta:\', correct === value);
    });
});

function mostrarResultadosQuiz() {
    const correctas = document.querySelectorAll(\'.quiz-option.correct\').length;
    document.getElementById(\'quizScore\').textContent = correctas;
    document.getElementById(\'quizFeedback\').textContent = correctas === 3 ? \'¡Excelente!\' : correctas === 2 ? \'Bien, revisa.\' : \'Practica más.\';
    document.querySelector(\'.quiz-results\').style.display = \'block\';
    console.log(\'Quiz completado, puntuación:\', correctas);
}

function reiniciarQuiz() {
    document.querySelectorAll(\'.quiz-question\').forEach(q => {
        q.dataset.answered = \'\';
        q.querySelector(\'.quiz-feedback\').style.display = \'none\';
        q.querySelectorAll(\'.quiz-option\').forEach(o => o.classList.remove(\'correct\', \'incorrect\'));
    });
    quizCompletadas = 0;
    document.querySelector(\'.quiz-results\').style.display = \'none\';
    console.log(\'Quiz reiniciado\');
}

// Funciones para errores comunes
document.querySelectorAll(\'.collapsible .error-header\').forEach(header => {
    header.addEventListener(\'click\', () => {
        const content = header.nextElementSibling;
        const icon = header.querySelector(\'.collapse-icon\');
        content.style.display = content.style.display === \'none\' ? \'block\' : \'none\';
        icon.textContent = content.style.display === \'block\' ? \'-\' : \'+\';
        console.log(\'Error colapsado toggled\');
    });
});

function verificarError(num, btn) {
    const input = btn.previousElementSibling.value.toLowerCase();
    const feedback = btn.nextElementSibling;
    let correct = false;
    if (num === 1) correct = input.includes(\'commit\');
    if (num === 2) correct = input.includes(\'?\') || input.includes(\'placeholder\');
    if (num === 3) correct = input.includes(\'close\') || input.includes(\'with conn\');
    feedback.textContent = correct ? \'✅ Correcto!\' : \'❌ Intenta de nuevo.\';
    feedback.style.color = correct ? \'var(--neon-concepto)\' : \'var(--neon-alerta)\';
    console.log(\'Verificación error\', num, \':\', correct);
}

// Funciones para cierre
document.querySelectorAll(\'.skill-slider\').forEach(slider => {
    slider.addEventListener(\'input\', () => {
        const fill = slider.previousElementSibling.querySelector(\'.skill-fill\');
        fill.style.width = slider.value + \'%\';
        fill.dataset.level = slider.value;
        console.log(\'Habilidad actualizada:\', slider.dataset.skill, slider.value);
    });
});

function guardarHabilidades() {
    const skills = {};
    document.querySelectorAll(\'.skill-slider\').forEach(sl => skills[sl.dataset.skill] = sl.value);
    localStorage.setItem(\'skills\', JSON.stringify(skills));
    alert(\'Habilidades guardadas\');
    console.log(\'Habilidades guardadas:\', skills);
}

function mostrarEsqueletoProyecto() {
    document.getElementById(\'proyectoSolucion\').style.display = \'block\';
    console.log(\'Esqueleto de proyecto mostrado\');
}
</script>',
    'ejercicios' => 
    array (
      0 => 
      array (
        'enunciado' => 'Conectar a SQLite',
        'respuesta' => 'conn = sqlite3.connect(\'db.db\')',
      ),
      1 => 
      array (
        'enunciado' => 'Crear tabla SQL',
        'respuesta' => 'CREATE TABLE usuarios (id INT PRIMARY KEY, nombre TEXT)',
      ),
      2 => 
      array (
        'enunciado' => 'INSERT en Python',
        'respuesta' => 'cursor.execute("INSERT INTO t (c) VALUES (?)", (val,))',
      ),
      3 => 
      array (
        'enunciado' => 'SELECT con fetchall()',
        'respuesta' => 'cursor.execute("SELECT * FROM t").fetchall()',
      ),
      4 => 
      array (
        'enunciado' => 'Commit cambios',
        'respuesta' => 'conn.commit()',
      ),
      5 => 
      array (
        'enunciado' => 'Cerrar conexión',
        'respuesta' => 'conn.close()',
      ),
      6 => 
      array (
        'enunciado' => 'Usar :memory:',
        'respuesta' => 'conn = sqlite3.connect(\':memory:\')',
      ),
      7 => 
      array (
        'enunciado' => 'IF NOT EXISTS',
        'respuesta' => 'CREATE TABLE IF NOT EXISTS ...',
      ),
      8 => 
      array (
        'enunciado' => 'Parámetros con ?',
        'respuesta' => 'cursor.execute(sql, (val1, val2))',
      ),
      9 => 
      array (
        'enunciado' => 'fetchone()',
        'respuesta' => 'Devuelve una fila',
      ),
      10 => 
      array (
        'enunciado' => 'rowcount',
        'respuesta' => 'cursor.rowcount → filas afectadas',
      ),
      11 => 
      array (
        'enunciado' => 'SI: apps con SQLite',
        'respuesta' => 'WhatsApp, Firefox, Android',
      ),
    ),
    'quiz' => 
    array (
      0 => 
      array (
        'pregunta' => 'Python es',
        'opciones' => 
        array (
          0 => 'Interpretado',
          1 => 'Compilado',
          2 => 'Híbrido',
          3 => 'Binario',
        ),
        'correcta' => 'Interpretado',
      ),
      1 => 
      array (
        'pregunta' => 'sqlite3 es',
        'opciones' => 
        array (
          0 => 'Módulo nativo',
          1 => 'Externo',
          2 => 'pip install',
          3 => 'Node.js',
        ),
        'correcta' => 'Módulo nativo',
      ),
      2 => 
      array (
        'pregunta' => 'SQLite necesita',
        'opciones' => 
        array (
          0 => 'Nada, solo archivo',
          1 => 'Servidor',
          2 => 'Cloud',
          3 => 'Docker',
        ),
        'correcta' => 'Nada, solo archivo',
      ),
      3 => 
      array (
        'pregunta' => 'connect(\':memory:\')',
        'opciones' => 
        array (
          0 => 'BD en RAM',
          1 => 'Archivo',
          2 => 'Cloud',
          3 => 'Temporal',
        ),
        'correcta' => 'BD en RAM',
      ),
      4 => 
      array (
        'pregunta' => 'execute() retorna',
        'opciones' => 
        array (
          0 => 'Cursor',
          1 => 'Lista',
          2 => 'Nada',
          3 => 'Error',
        ),
        'correcta' => 'Cursor',
      ),
      5 => 
      array (
        'pregunta' => 'fetchall()',
        'opciones' => 
        array (
          0 => 'Lista de tuplas',
          1 => 'Diccionario',
          2 => 'Texto',
          3 => 'Nada',
        ),
        'correcta' => 'Lista de tuplas',
      ),
      6 => 
      array (
        'pregunta' => 'commit()',
        'opciones' => 
        array (
          0 => 'Guarda cambios',
          1 => 'Cierra',
          2 => 'Lee',
          3 => 'Borra',
        ),
        'correcta' => 'Guarda cambios',
      ),
      7 => 
      array (
        'pregunta' => 'close()',
        'opciones' => 
        array (
          0 => 'Cierra conexión',
          1 => 'Borra BD',
          2 => 'Reinicia',
          3 => 'Nada',
        ),
        'correcta' => 'Cierra conexión',
      ),
      8 => 
      array (
        'pregunta' => 'CREATE TABLE IF NOT EXISTS',
        'opciones' => 
        array (
          0 => 'Evita error si existe',
          1 => 'Borra si existe',
          2 => 'Nada',
          3 => 'Error',
        ),
        'correcta' => 'Evita error si existe',
      ),
      9 => 
      array (
        'pregunta' => 'Parámetros con ?',
        'opciones' => 
        array (
          0 => 'Previenen inyección SQL',
          1 => 'Solo texto',
          2 => 'Solo números',
          3 => 'Nada',
        ),
        'correcta' => 'Previenen inyección SQL',
      ),
      10 => 
      array (
        'pregunta' => 'rowcount',
        'opciones' => 
        array (
          0 => 'Filas afectadas',
          1 => 'Columnas',
          2 => 'Tamaño BD',
          3 => 'Nada',
        ),
        'correcta' => 'Filas afectadas',
      ),
      11 => 
      array (
        'pregunta' => 'fetchone()',
        'opciones' => 
        array (
          0 => 'Una fila',
          1 => 'Todas',
          2 => 'Ninguna',
          3 => 'Error',
        ),
        'correcta' => 'Una fila',
      ),
      12 => 
      array (
        'pregunta' => 'executemany()',
        'opciones' => 
        array (
          0 => 'Múltiples INSERT',
          1 => 'Uno solo',
          2 => 'SELECT',
          3 => 'DELETE',
        ),
        'correcta' => 'Múltiples INSERT',
      ),
      13 => 
      array (
        'pregunta' => 'SQLite soporta',
        'opciones' => 
        array (
          0 => 'Transacciones ACID',
          1 => 'Solo lectura',
          2 => 'Nada',
          3 => 'NoSQL',
        ),
        'correcta' => 'Transacciones ACID',
      ),
      14 => 
      array (
        'pregunta' => 'Tamaño máx BD SQLite',
        'opciones' => 
        array (
          0 => '~281 TB',
          1 => '1 GB',
          2 => '100 MB',
          3 => 'Ilimitado',
        ),
        'correcta' => '~281 TB',
      ),
      15 => 
      array (
        'pregunta' => 'Apps famosas con SQLite',
        'opciones' => 
        array (
          0 => 'WhatsApp, Firefox',
          1 => 'Netflix',
          2 => 'Google',
          3 => 'Amazon',
        ),
        'correcta' => 'WhatsApp, Firefox',
      ),
      16 => 
      array (
        'pregunta' => 'Python en 2025',
        'opciones' => 
        array (
          0 => '#1 en popularidad',
          1 => '#5',
          2 => '#10',
          3 => 'Obsoleto',
        ),
        'correcta' => '#1 en popularidad',
      ),
      17 => 
      array (
        'pregunta' => 'SI 2025: % dispositivos con SQLite',
        'opciones' => 
        array (
          0 => '+90%',
          1 => '50%',
          2 => '10%',
          3 => '0%',
        ),
        'correcta' => '+90%',
      ),
      18 => 
      array (
        'pregunta' => 'SQLite es',
        'opciones' => 
        array (
          0 => 'Serverless',
          1 => 'Con servidor',
          2 => 'Cloud only',
          3 => 'Depende',
        ),
        'correcta' => 'Serverless',
      ),
      19 => 
      array (
        'pregunta' => 'Python + SQLite ideal para',
        'opciones' => 
        array (
          0 => 'Prototipos, apps móviles',
          1 => 'Big Data',
          2 => 'IA',
          3 => 'Web',
        ),
        'correcta' => 'Prototipos, apps móviles',
      ),
      20 => 
      array (
        'pregunta' => 'cursor es',
        'opciones' => 
        array (
          0 => 'Objeto para ejecutar SQL',
          1 => 'Conexión',
          2 => 'BD',
          3 => 'Tabla',
        ),
        'correcta' => 'Objeto para ejecutar SQL',
      ),
      21 => 
      array (
        'pregunta' => 'conn es',
        'opciones' => 
        array (
          0 => 'Conexión a BD',
          1 => 'Cursor',
          2 => 'Tabla',
          3 => 'SQL',
        ),
        'correcta' => 'Conexión a BD',
      ),
      22 => 
      array (
        'pregunta' => 'with sqlite3.connect() as conn',
        'opciones' => 
        array (
          0 => 'Cierra automáticamente',
          1 => 'Manual',
          2 => 'Error',
          3 => 'No cierra',
        ),
        'correcta' => 'Cierra automáticamente',
      ),
      23 => 
      array (
        'pregunta' => 'PRAGMA foreign_keys = ON',
        'opciones' => 
        array (
          0 => 'Activa FK',
          1 => 'Desactiva',
          2 => 'Nada',
          3 => 'Error',
        ),
        'correcta' => 'Activa FK',
      ),
      24 => 
      array (
        'pregunta' => 'SQLite en Android',
        'opciones' => 
        array (
          0 => 'Nativo',
          1 => 'Java',
          2 => 'Kotlin',
          3 => 'Swift',
        ),
        'correcta' => 'Nativo',
      ),
      25 => 
      array (
        'pregunta' => 'Python 3.12+',
        'opciones' => 
        array (
          0 => 'Mejor sqlite3',
          1 => 'Peor',
          2 => 'Igual',
          3 => 'Sin soporte',
        ),
        'correcta' => 'Mejor sqlite3',
      ),
      26 => 
      array (
        'pregunta' => 'DB Browser for SQLite',
        'opciones' => 
        array (
          0 => 'GUI gratuita',
          1 => 'Paga',
          2 => 'Web',
          3 => 'CLI',
        ),
        'correcta' => 'GUI gratuita',
      ),
      27 => 
      array (
        'pregunta' => 'SI 2025: Python en educación',
        'opciones' => 
        array (
          0 => 'Lenguaje #1',
          1 => '#3',
          2 => '#5',
          3 => 'No usado',
        ),
        'correcta' => 'Lenguaje #1',
      ),
      28 => 
      array (
        'pregunta' => 'sqlite3.Row',
        'opciones' => 
        array (
          0 => 'Acceso por nombre',
          1 => 'Solo índice',
          2 => 'Nada',
          3 => 'Error',
        ),
        'correcta' => 'Acceso por nombre',
      ),
      29 => 
      array (
        'pregunta' => 'Python + SQLite =',
        'opciones' => 
        array (
          0 => 'Desarrollo full-stack local',
          1 => 'Solo backend',
          2 => 'Solo frontend',
          3 => 'Nada',
        ),
        'correcta' => 'Desarrollo full-stack local',
      ),
    ),
  ),
  2 => 
  array (
    'materia' => 'Programación',
    'slug' => 'bases-datos-no-relacionales-mongodb',
    'titulo' => 'MongoDB + NoSQL: La Revolución de las Bases de Datos',
    'contenido' => '<!-- INICIO LECCIÓN CYBERPUNK PROGRAMACIÓN -->
<div class="leccion-container leccion-programacion-bases-datos-no-relacionales-mongodb" data-tema="bases-datos-no-relacionales-mongodb">
    
    <!-- 1️⃣ INTRODUCCIÓN CONCEPTUAL CYBERPUNK -->
    <header class="leccion-header">
        <h1 class="titulo-leccion neon-glow">
            <span class="icon-tema">📂</span>
            MONGODB + NOSQL
        </h1>
        <div class="subtitulo">
            La Revolución de las Bases de Datos Documentales
        </div>
    </header>
    <section class="panel-objetivos">
        <h2 class="seccion-titulo neon-concepto">
            <span class="icon">🎯</span> OBJETIVOS DE APRENDIZAJE
        </h2>
        <div class="objetivos-grid">
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Entender NoSQL vs SQL</h3>
                <p>Flexibilidad de esquemas, escalabilidad horizontal</p>
            </div>
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Dominar MongoDB basics</h3>
                <p>Colecciones, documentos, queries</p>
            </div>
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Implementar operaciones</h3>
                <p>Insert, find, update, aggregate</p>
            </div>
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Aplicar en escenarios reales</h3>
                <p>Apps escalables, big data</p>
            </div>
        </div>
    </section>
    <section class="contexto-real">
        <h2 class="seccion-titulo neon-dato">
            <span class="icon">🌍</span> APLICACIÓN EN EL MUNDO REAL
        </h2>
        <div class="contexto-grid">
            <div class="contexto-card">
                <h3>🎥 Streaming</h3>
                <p>Netflix maneja perfiles dinámicos</p>
                <div class="dato-neon">10B+ docs</div>
            </div>
            <div class="contexto-card">
                <h3>🚀 Tech Giants</h3>
                <p>Google, Uber para data flexible</p>
                <div class="dato-neon">70% apps modernas</div>
            </div>
            <div class="contexto-card">
                <h3>📱 Mobile</h3>
                <p>Realm (Mongo) para offline sync</p>
                <div class="dato-neon">Real-time</div>
            </div>
        </div>
        <div class="relacion-curricular">
            <h3>RELACIÓN CURRICULAR</h3>
            <div class="badges">
                <span class="badge">Competencia: Big Data Management</span>
                <span class="badge">Contenido: NoSQL Databases</span>
                <span class="badge">Evaluación: Proyecto Scalable DB</span>
            </div>
        </div>
    </section>

    <!-- 2️⃣ DESARROLLO TEÓRICO ESTRUCTURADO -->
    <section class="teoria-section">
        <div class="borde-neon-lateral"></div>
        <h2 class="seccion-titulo neon-concepto">
            <span class="icon">📚</span> FUNDAMENTOS NOSQL + MONGODB
        </h2>
       
        <!-- INTRODUCCIÓN -->
        <div class="subseccion">
            <h3>1. NoSQL: Beyond Relational</h3>
            <div class="definicion-principal">
                <div class="def-card">
                    <h4>🚫 NOSQL</h4>
                    <p>"Not Only SQL" - Bases de datos para data no estructurada, escalabilidad, flexibilidad.</p>
                    <div class="principios-grid">
                        <div class="principio">
                            <div class="principio-icon">📊</div>
                            <h5>Tipos</h5>
                            <p>Documental, Key-Value, Grafo, Columnar</p>
                        </div>
                        <div class="principio">
                            <div class="principio-icon">⚡</div>
                            <h5>Ventajas</h5>
                            <p>Esquema flexible, horizontal scale</p>
                        </div>
                        <div class="principio">
                            <div class="principio-icon">🔄</div>
                            <h5>BASICS</h5>
                            <p>Base Availability Soft-state Eventual consistency</p>
                        </div>
                    </div>
                </div>
            </div>
           
            <div class="clasificacion-doble">
                <div class="clas-card nosql">
                    <h4>📂 NoSQL Documental</h4>
                    <ul>
                        <li><strong>Modelo:</strong> JSON-like docs</li>
                        <li><strong>Queries:</strong> Rich, indexed</li>
                        <li><strong>Use:</strong> Content management</li>
                        <li><strong>Ej:</strong> MongoDB, CouchDB</li>
                    </ul>
                    <div class="ejemplos">
                        <strong>Ventaja:</strong> Schema-less
                    </div>
                </div>
               
                <div class="clas-card sql">
                    <h4>🗄️ SQL (Contrast)</h4>
                    <ul>
                        <li><strong>Modelo:</strong> Tablas, rows</li>
                        <li><strong>Queries:</strong> JOIN heavy</li>
                        <li><strong>Use:</strong> Transactions</li>
                        <li><strong>Ej:</strong> MySQL, PostgreSQL</li>
                    </ul>
                    <div class="ejemplos">
                        <strong>Ventaja:</strong> ACID full
                    </div>
                </div>
            </div>
        </div>
        <!-- MONGODB BASICS -->
        <div class="subseccion">
            <h3>2. MongoDB Estructura</h3>
            <div class="comparativa-grid">
                <div class="comp-card db">
                    <div class="comp-header">
                        <h4>🗃️ Database</h4>
                        <div class="comp-badge">Container</div>
                    </div>
                    <div class="comp-caracteristicas">
                        <p><strong>Definición:</strong> Grupo de collections</p>
                        <p><strong>Características:</strong></p>
                        <ul>
                            <li>use dbname</li>
                            <li>Multiple per instance</li>
                            <li>Sharded</li>
                            <li>Replica sets</li>
                        </ul>
                    </div>
                    <div class="comp-ejemplos">
                        <div class="ejemplo-item">
                            <div class="codigo">use mydb</div>
                            <div class="desc">Switch DB</div>
                        </div>
                    </div>
                </div>
               
                <div class="comp-card coll">
                    <div class="comp-header">
                        <h4>📁 Collection</h4>
                        <div class="comp-badge">Table-like</div>
                    </div>
                    <div class="comp-caracteristicas">
                        <p><strong>Definición:</strong> Grupo de docs</p>
                        <p><strong>Características:</strong></p>
                        <ul>
                            <li>db.createCollection</li>
                            <li>Schema flexible</li>
                            <li>Indexed</li>
                            <li>Capped</li>
                        </ul>
                    </div>
                    <div class="comp-ejemplos">
                        <div class="ejemplo-item">
                            <div class="codigo">db.users.insert({})</div>
                            <div class="desc">Auto create</div>
                        </div>
                    </div>
                </div>
            </div>
           
            <div class="regla-oro">
                <h4>⚡ REGLA DE ORO: Document vs Row</h4>
                <div class="regla-content">
                    <div class="regla-item">
                        <div class="regla-icon">📄</div>
                        <div class="regla-text">
                            <strong>Document:</strong> JSON con fields dinámicos
                        </div>
                    </div>
                    <div class="regla-item">
                        <div class="regla-icon">🗄️</div>
                        <div class="regla-text">
                            <strong>Row:</strong> Estructura fija
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- OPERACIONES -->
        <div class="subseccion">
            <h3>3. Operaciones Básicas</h3>
            <div class="tabla-interactiva">
                <table class="tabla-cyberpunk">
                    <thead>
                        <tr>
                            <th>TIPO</th>
                            <th>COMANDO</th>
                            <th>DESCRIPCIÓN</th>
                            <th>EJEMPLO</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr data-tipo="insert">
                            <td><strong class="neon-concepto">INSERT</strong></td>
                            <td>insertOne/insertMany</td>
                            <td>Agregar docs</td>
                            <td>db.coll.insertOne({key: val})</td>
                        </tr>
                        <tr data-tipo="find">
                            <td><strong class="neon-concepto">FIND</strong></td>
                            <td>find/findOne</td>
                            <td>Query docs</td>
                            <td>db.coll.find({field: value})</td>
                        </tr>
                        <tr data-tipo="update">
                            <td><strong class="neon-concepto">UPDATE</strong></td>
                            <td>updateOne/updateMany</td>
                            <td>Modificar</td>
                            <td>db.coll.updateOne({f: v}, {$set: {new: val}})</td>
                        </tr>
                    </tbody>
                </table>
                <div class="tabla-info" id="infoOperacion">
                    Selecciona una operación para ver detalles
                </div>
            </div>
           
            <div class="operacion-ejemplos">
                <div class="ejemplo-detalle" id="detalleInsert" style="display: none;">
                    <h4>🔍 INSERT en Detalle</h4>
                    <div class="analisis-content">
                        <div class="analisis-item">
                            <h5>📝 Código Ejemplo</h5>
                            <pre><code>db.users.insertMany([
  { name: "John", age: 30 },
  { name: "Jane", age: 25 }
])</code></pre>
                        </div>
                        <div class="analisis-item">
                            <h5>🎯 Opciones</h5>
                            <ul>
                                <li>ordered: false para continuar en error</li>
                                <li>writeConcern</li>
                            </ul>
                        </div>
                    </div>
                </div>
               
                <div class="ejemplo-detalle" id="detalleFind" style="display: none;">
                    <h4>🔍 FIND en Detalle</h4>
                    <div class="analisis-content">
                        <div class="analisis-item">
                            <h5>📝 Código Ejemplo</h5>
                            <pre><code>db.users.find({ age: { $gt: 20 } }).sort({ name: 1 }).limit(5)</code></pre>
                        </div>
                        <div class="analisis-item">
                            <h5>🎯 Operadores</h5>
                            <ul>
                                <li>$eq, $gt, $gte, $in</li>
                                <li>$and, $or, $not</li>
                                <li>$elemMatch para arrays</li>
                            </ul>
                        </div>
                    </div>
                </div>
               
                <div class="ejemplo-detalle" id="detalleUpdate" style="display: none;">
                    <h4>🔍 UPDATE en Detalle</h4>
                    <div class="analisis-content">
                        <div class="analisis-item">
                            <h5>📝 Código Ejemplo</h5>
                            <pre><code>db.users.updateMany(
  { age: { $lt: 30 } },
  { $set: { status: "young" } }
)</code></pre>
                        </div>
                        <div class="analisis-item">
                            <h5>🎯 Operadores</h5>
                            <ul>
                                <li>$set, $inc, $push</li>
                                <li>$unset, $rename</li>
                                <li>upsert: true</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ADVANCED -->
        <div class="subseccion">
            <h3>4. Operaciones Avanzadas</h3>
            <p class="principio-clave">
                <strong>Objetivo:</strong> Aggregations, indexes para performance.
            </p>
           
            <div class="advanced-grid">
                <div class="adv-card" data-adv="agg">
                    <div class="adv-header">
                        <div class="adv-badge">Agg</div>
                        <h4>Aggregation</h4>
                    </div>
                    <div class="adv-content">
                        <p><strong>Reglas:</strong></p>
                        <ul>
                            <li>Pipeline stages</li>
                            <li>$match, $group, $sort</li>
                            <li>$project, $unwind</li>
                        </ul>
                        <div class="adv-ejemplo">
                            <strong>✅ Ej:</strong> db.coll.aggregate([{$group: {_id: "$field", total: {$sum: 1}}}])
                        </div>
                    </div>
                </div>
               
                <div class="adv-card" data-adv="index">
                    <div class="adv-header">
                        <div class="adv-badge">Index</div>
                        <h4>Indexes</h4>
                    </div>
                    <div class="adv-content">
                        <p><strong>Reglas:</strong></p>
                        <ul>
                            <li>db.coll.createIndex({field: 1})</li>
                            <li>Compound, text, geo</li>
                            <li>TTL for expiration</li>
                        </ul>
                        <div class="adv-ejemplo">
                            <strong>✅ Ej:</strong> db.coll.createIndex({location: "2dsphere"})
                        </div>
                    </div>
                </div>
               
                <div class="adv-card" data-adv="scale">
                    <div class="adv-header">
                        <div class="adv-badge">Scale</div>
                        <h4>Sharding/Replica</h4>
                    </div>
                    <div class="adv-content">
                        <p><strong>Reglas:</strong></p>
                        <ul>
                            <li>Replica sets for HA</li>
                            <li>Sharding for distribution</li>
                            <li>Mongos router</li>
                        </ul>
                        <div class="adv-ejemplo">
                            <strong>✅ Ej:</strong> sh.enableSharding("db")
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 3️⃣ VISUALIZACIÓN DIDÁCTICA INTERACTIVA -->
    <section class="visualizacion-section">
        <h2 class="seccion-titulo neon-interactivo">
            <span class="icon">📊</span> VISUALIZACIÓN DIDÁCTICA INTERACTIVA
        </h2>
        <div class="diagrama-container">
            <div class="diagrama-controls">
                <h3>🏗️ DIAGRAMA MONGODB</h3>
            </div>
           
            <div class="diagrama-visual">
                <svg viewBox="0 0 1000 600" id="svgDiagrama" class="er-diagram-interactive">
                    <defs>
                        <marker id="arrow" markerWidth="10" markerHeight="10" refX="9" refY="3" orient="auto">
                            <path d="M0,0 L0,6 L9,3 z" fill="#39FF14"/>
                        </marker>
                    </defs>
                    <rect width="1000" height="600" fill="none"/>
                    
                    <!-- Database -->
                    <rect x="350" y="50" width="300" height="500" rx="20" fill="rgba(0,188,212,0.5)" stroke="#00ff00" stroke-width="3"/>
                    <text x="500" y="100" fill="#ffffff" text-anchor="middle" font-size="24" style="text-shadow: 0 0 5px #00ff00">Database</text>
                    
                    <!-- Collection 1 -->
                    <rect x="400" y="150" width="200" height="100" rx="10" fill="rgba(0,96,100,0.5)" stroke="#ff00ff" stroke-width="3"/>
                    <text x="500" y="200" fill="#ffffff" text-anchor="middle" font-size="20" style="text-shadow: 0 0 5px #ff00ff">Collection</text>
                    
                    <!-- Documents -->
                    <rect x="420" y="260" width="160" height="50" rx="5" fill="rgba(255,255,0,0.2)" stroke="#ffff00" stroke-width="2"/>
                    <text x="500" y="285" fill="#ffffff" text-anchor="middle" font-size="16" style="text-shadow: 0 0 5px #ffff00">Document {JSON}</text>
                    
                    <rect x="420" y="320" width="160" height="50" rx="5" fill="rgba(255,255,0,0.2)" stroke="#ffff00" stroke-width="2"/>
                    <text x="500" y="345" fill="#ffffff" text-anchor="middle" font-size="16" style="text-shadow: 0 0 5px #ffff00">Document {JSON}</text>
                    
                    <!-- Sharding Note -->
                    <text x="500" y="500" fill="#00ff88" text-anchor="middle" font-size="18" style="text-shadow: 0 0 5px #00ff88">Scalable & Flexible</text>
                </svg>
               
                <div class="diagrama-info" id="diagramInfo">
                    Diagrama de estructura MongoDB (visibilidad mejorada)
                </div>
            </div>
        </div>
    </section>

    <!-- 4️⃣ BLOQUES INTERACTIVOS REALES -->
    <section class="interactivos-section">
        <h2 class="seccion-titulo neon-interactivo">
            <span class="icon">🎮</span> BLOQUES INTERACTIVOS REALES
        </h2>
        <!-- SIMULADOR INTERACTIVO (OBLIGATORIO) -->
        <div class="simulator-container" data-tema="mongodb">
            <style>
                .mongo-sim-panel { display:grid; gap:16px; }
                .mongo-sim-top { display:flex; flex-wrap:wrap; gap:12px; justify-content:space-between; align-items:flex-end; margin-bottom:14px; }
                .mongo-sim-title { display:flex; flex-direction:column; gap:6px; }
                .mongo-sim-tabs { display:flex; flex-wrap:wrap; gap:8px; }
                .mongo-sim-tab { padding:8px 14px; border-radius:999px; border:1px solid rgba(255,255,255,.12); background:rgba(255,255,255,.05); color:var(--color-text-secondary); cursor:pointer; transition:all .18s; font-size:13px; }
                .mongo-sim-tab.active { background:var(--color-background-secondary); border-color:var(--color-border-primary); color:var(--color-text-primary); }
                .mongo-sim-body { display:grid; grid-template-columns: 1.8fr 1fr; gap:18px; }
                .mongo-sim-editor { display:flex; flex-direction:column; gap:10px; }
                .mongo-sim-editor textarea { width:100%; min-height:320px; padding:14px; border-radius:18px; border:1px solid rgba(255,255,255,.12); background:var(--color-background-primary); color:var(--color-text-primary); font-family:var(--font-mono); font-size:13px; resize:vertical; }
                .mongo-buttons { display:flex; flex-wrap:wrap; gap:10px; }
                .mongo-button { padding:10px 16px; border-radius:14px; border:1px solid rgba(255,255,255,.12); background:var(--color-background-secondary); color:var(--color-text-primary); cursor:pointer; transition:all .15s; }
                .mongo-button.primary { background:var(--color-background-info); color:var(--color-text-info); border-color:var(--color-border-info); }
                .mongo-button.danger { background:var(--color-background-danger); color:var(--color-text-danger); border-color:var(--color-border-danger); }
                .mongo-button:hover { transform:translateY(-1px); }
                .mongo-output-card, .mongo-panel-card { background:var(--color-background-primary); border:0.5px solid var(--color-border-tertiary); border-radius:18px; padding:16px; }
                .mongo-output-header { display:flex; justify-content:space-between; align-items:center; margin-bottom:10px; }
                .mongo-output-header span { font-size:13px; font-weight:600; color:var(--color-text-secondary); }
                .mongo-output { min-height:320px; max-height:340px; overflow:auto; padding:12px; border-radius:14px; background:var(--color-background-secondary); font-family:var(--font-mono); font-size:13px; color:var(--color-text-primary); white-space:pre-wrap; }
                .mongo-output.placeholder { color:var(--color-text-tertiary); }
                .mongo-summary { display:grid; gap:12px; }
                .mongo-summary .data-card { display:flex; flex-direction:column; gap:8px; border-radius:14px; padding:14px; background:rgba(255,255,255,.04); border:1px solid rgba(255,255,255,.1); }
                .mongo-summary .data-label { font-size:12px; color:var(--color-text-secondary); }
                .mongo-summary .data-value { font-size:18px; font-weight:600; color:var(--color-text-primary); }
                .mongo-snippet-bar { display:flex; flex-wrap:wrap; gap:8px; margin-bottom:12px; }
                .mongo-snippet-btn { padding:7px 12px; border-radius:12px; border:1px solid rgba(255,255,255,.12); background:rgba(255,255,255,.05); color:var(--color-text-secondary); font-size:12px; cursor:pointer; }
                .mongo-snippet-btn:hover { background:var(--color-background-secondary); color:var(--color-text-primary); }
                .mongo-status-pill { padding:6px 12px; border-radius:999px; font-size:12px; display:inline-flex; align-items:center; gap:8px; }
                .status-idle { background:rgba(255,255,255,.06); color:var(--color-text-secondary); }
                .status-running { background:rgba(0,188,212,.12); color:var(--color-text-info); }
                .status-success { background:rgba(57,255,20,.12); color:#b8ffcc; }
                .status-error { background:rgba(255,107,107,.12); color:#ffb8b8; }
                @media (max-width: 960px) { .mongo-sim-body { grid-template-columns: 1fr; } }
            </style>

            <div class="mongo-sim-panel">
                <div class="mongo-sim-top">
                    <div class="mongo-sim-title">
                        <h3>🎮 SIMULADOR INTERACTIVO MONGODB</h3>
                        <p>Practica comandos reales de MongoDB usando una base de datos simulada dentro del navegador.</p>
                    </div>
                    <div>
                        <span id="mongoStatus" class="mongo-status-pill status-idle">Listo</span>
                    </div>
                </div>

                <div class="mongo-sim-tabs" id="mongoTabs">
                    <button class="mongo-sim-tab active" onclick="setMongoTab(0)">Libre</button>
                    <button class="mongo-sim-tab" onclick="setMongoTab(1)">Insert Many</button>
                    <button class="mongo-sim-tab" onclick="setMongoTab(2)">Find</button>
                    <button class="mongo-sim-tab" onclick="setMongoTab(3)">Aggregate</button>
                    <button class="mongo-sim-tab" onclick="setMongoTab(4)">Update</button>
                </div>

                <div class="mongo-sim-body">
                    <div class="mongo-sim-editor">
                        <div class="mongo-snippet-bar">
                            <button class="mongo-snippet-btn" onclick="insertMongoSnippet(\'insertMany\')">insertMany</button>
                            <button class="mongo-snippet-btn" onclick="insertMongoSnippet(\'find\')">find</button>
                            <button class="mongo-snippet-btn" onclick="insertMongoSnippet(\'findOne\')">findOne</button>
                            <button class="mongo-snippet-btn" onclick="insertMongoSnippet(\'count\')">countDocuments</button>
                            <button class="mongo-snippet-btn" onclick="insertMongoSnippet(\'aggregate\')">aggregate</button>
                            <button class="mongo-snippet-btn" onclick="insertMongoSnippet(\'update\')">updateMany</button>
                        </div>
                        <textarea id="mongo-input" spellcheck="false" autocorrect="off" autocapitalize="off">db.alumnos.insertMany([
  { nombre: "Ana López", edad: 17, nivel: "Avanzado", ciudad: "CDMX" },
  { nombre: "Carlos Ruiz", edad: 19, nivel: "Intermedio" },
  { nombre: "Sofía Mendoza", edad: 16, nivel: "Principiante", ciudad: "Guadalajara" },
  { nombre: "Luis Torres", edad: 18, nivel: "Avanzado" }
])
db.alumnos.find({ nivel: "Avanzado" })
db.alumnos.find({ edad: { $gte: 18 } })
db.alumnos.countDocuments({ ciudad: "CDMX" })</textarea>
                        <div class="mongo-buttons">
                            <button class="mongo-button primary" onclick="ejecutarMongo()">▶ Ejecutar</button>
                            <button class="mongo-button" onclick="resetMongoCode()">🔄 Cargar ejemplo</button>
                            <button class="mongo-button danger" onclick="limpiarMongo()">🗑 Limpiar BD</button>
                        </div>
                    </div>

                    <div class="mongo-summary">
                        <div class="mongo-output-card">
                            <div class="mongo-output-header">
                                <span>📊 SALIDA MONGODB</span>
                                <span class="mongo-status-pill status-idle" id="mongoCommandState">esperando</span>
                            </div>
                            <div id="mongo-output" class="mongo-output placeholder">Listo para comandos MongoDB...</div>
                        </div>
                        <div class="mongo-panel-card">
                            <div class="data-card">
                                <span class="data-label">Colecciones</span>
                                <span class="data-value" id="collectionsCount">0</span>
                            </div>
                            <div class="data-card">
                                <span class="data-label">Documentos totales</span>
                                <span class="data-value" id="totalDocs">0</span>
                            </div>
                            <div class="data-card">
                                <span class="data-label">Última ejecución</span>
                                <span class="data-value" id="mongoLastCommand">-</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 5️⃣ QUIZ AUTOEVALUADO CON FEEDBACK -->
    <section class="quiz-section">
        <h2 class="seccion-titulo neon-evaluacion">
            <span class="icon">❓</span> QUIZ NOSQL MONGODB
        </h2>
       
        <div class="quiz-container">
            <!-- PREGUNTA 1 -->
            <div class="quiz-question" data-correct="C">
                <div class="quiz-header">
                    <span class="quiz-num">01</span>
                    <h3>¿Principal ventaja NoSQL?</h3>
                </div>
               
                <div class="quiz-options">
                    <button class="quiz-option" data-value="A">
                        <span class="option-letter">A</span>
                        ACID estricto
                    </button>
                    <button class="quiz-option" data-value="B">
                        <span class="option-letter">B</span>
                        Esquema fijo
                    </button>
                    <button class="quiz-option" data-value="C">
                        <span class="option-letter">C</span>
                        Escalabilidad horizontal
                    </button>
                    <button class="quiz-option" data-value="D">
                        <span class="option-letter">D</span>
                        JOINs complejos
                    </button>
                </div>
               
                <div class="quiz-feedback" style="display: none;">
                    <div class="feedback-correct">
                        ✅ <strong>Correcto:</strong> Scale out fácil.
                    </div>
                    <div class="feedback-incorrect">
                        ❌ <strong>Incorrecto:</strong> Revisa CAP.
                    </div>
                    <div class="feedback-explicacion">
                        <p><strong>Explicación:</strong> NoSQL para big data distribuida.</p>
                    </div>
                </div>
            </div>
           
            <!-- PREGUNTA 2 -->
            <div class="quiz-question" data-correct="A">
                <div class="quiz-header">
                    <span class="quiz-num">02</span>
                    <h3>Modelo MongoDB?</h3>
                </div>
               
                <div class="quiz-options">
                    <button class="quiz-option" data-value="A">
                        <span class="option-letter">A</span>
                        Documental
                    </button>
                    <button class="quiz-option" data-value="B">
                        <span class="option-letter">B</span>
                        Key-Value
                    </button>
                    <button class="quiz-option" data-value="C">
                        <span class="option-letter">C</span>
                        Grafo
                    </button>
                    <button class="quiz-option" data-value="D">
                        <span class="option-letter">D</span>
                        Columnar
                    </button>
                </div>
               
                <div class="quiz-feedback" style="display: none;">
                    <div class="feedback-correct">
                        ✅ <strong>Correcto:</strong> Docs BSON.
                    </div>
                    <div class="feedback-incorrect">
                        ❌ <strong>Incorrecto:</strong> Revisa tipos NoSQL.
                    </div>
                    <div class="feedback-explicacion">
                        <p><strong>Regla:</strong> JSON-like con queries ricas.</p>
                    </div>
                </div>
            </div>
           
            <!-- PREGUNTA 3 -->
            <div class="quiz-question" data-correct="B">
                <div class="quiz-header">
                    <span class="quiz-num">03</span>
                    <h3>Comando para query?</h3>
                </div>
               
                <div class="quiz-options">
                    <button class="quiz-option" data-value="A">
                        <span class="option-letter">A</span>
                        SELECT
                    </button>
                    <button class="quiz-option" data-value="B">
                        <span class="option-letter">B</span>
                        find
                    </button>
                    <button class="quiz-option" data-value="C">
                        <span class="option-letter">C</span>
                        get
                    </button>
                    <button class="quiz-option" data-value="D">
                        <span class="option-letter">D</span>
                        query
                    </button>
                </div>
               
                <div class="quiz-feedback" style="display: none;">
                    <div class="feedback-correct">
                        ✅ <strong>Correcto:</strong> db.coll.find().
                    </div>
                    <div class="feedback-incorrect">
                        ❌ <strong>Incorrecto:</strong> No es SQL.
                    </div>
                    <div class="feedback-explicacion">
                        <p><strong>Tip:</strong> Retorna cursor iterable.</p>
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

    <!-- 6️⃣ SECCIÓN "ERRORES COMUNES" INTERACTIVA -->
    <section class="errores-section">
        <h2 class="seccion-titulo neon-alerta">
            <span class="icon">⚠️</span> ERRORES COMUNES INTERACTIVOS
        </h2>
        <div class="errores-container">
            <div class="error-card collapsible">
                <div class="error-header">
                    <h3>Error 1: Esquema Rígido</h3>
                    <div class="collapse-icon">+</div>
                </div>
                <div class="error-content" style="display: none;">
                    <div class="error-ejemplo">
                        <pre><code>// ❌ Mal
// Asumir fields fijos como en SQL</code></pre>
                    </div>
                    <div class="error-explicacion">
                        <p>NoSQL es flexible. Solución: Docs dinámicos.</p>
                    </div>
                    <div class="error-practica">
                        <p>Prueba: Insert doc con new field</p>
                        <textarea class="practica-input" placeholder="Escribe comando..."></textarea>
                        <button class="btn-verificar" onclick="verificarError(1, this)">Verificar</button>
                        <div class="practica-feedback"></div>
                    </div>
                </div>
            </div>
            <div class="error-card collapsible">
                <div class="error-header">
                    <h3>Error 2: Sin Indexes</h3>
                    <div class="collapse-icon">+</div>
                </div>
                <div class="error-content" style="display: none;">
                    <div class="error-ejemplo">
                        <pre><code>// ❌ Mal
db.largeColl.find({field: val}) // Slow scan</code></pre>
                    </div>
                    <div class="error-explicacion">
                        <p>Queries lentas. Solución: Create index on field.</p>
                    </div>
                    <div class="error-practica">
                        <p>Prueba: Add index</p>
                        <textarea class="practica-input" placeholder="Escribe comando..."></textarea>
                        <button class="btn-verificar" onclick="verificarError(2, this)">Verificar</button>
                        <div class="practica-feedback"></div>
                    </div>
                </div>
            </div>
            <div class="error-card collapsible">
                <div class="error-header">
                    <h3>Error 3: Mal Aggregation</h3>
                    <div class="collapse-icon">+</div>
                </div>
                <div class="error-content" style="display: none;">
                    <div class="error-ejemplo">
                        <pre><code>// ❌ Mal
db.coll.aggregate([]) // Empty pipeline</code></pre>
                    </div>
                    <div class="error-explicacion">
                        <p>No resultados. Solución: Add stages como $match.</p>
                    </div>
                    <div class="error-practica">
                        <p>Prueba: Simple aggregate</p>
                        <textarea class="practica-input" placeholder="Escribe comando..."></textarea>
                        <button class="btn-verificar" onclick="verificarError(3, this)">Verificar</button>
                        <div class="practica-feedback"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 7️⃣ PROBLEMAS TIPO EXAMEN -->
    <section class="problemas-section">
        <h2 class="seccion-titulo neon-evaluacion">
            <span class="icon">📝</span> PROBLEMAS TIPO EXAMEN
        </h2>
        <div class="problemas-container">
            <div class="problema-card">
                <h3>Problema 1 (Desarrollo)</h3>
                <p>Diseña collection para e-commerce: products con embedded reviews. Insert sample, query avg rating.</p>
                <textarea class="respuesta-area" placeholder="Escribe comandos..."></textarea>
                <div class="rubrica">
                    <p>Rúbrica: 40% Modelado, 30% Insert, 30% Query</p>
                </div>
            </div>
            <div class="problema-card">
                <h3>Problema 2 (Interpretación)</h3>
                <p>Explica: { $gt: 18 } en find. Alternativas?</p>
                <textarea class="respuesta-area" placeholder="Escribe interpretación..."></textarea>
                <div class="rubrica">
                    <p>Rúbrica: 50% Operadores, 50% Ejemplos</p>
                </div>
            </div>
            <div class="problema-card">
                <h3>Problema 3 (Razonamiento)</h3>
                <p>¿Cuándo MongoDB sobre SQL? Caso real.</p>
                <textarea class="respuesta-area" placeholder="Escribe justificación..."></textarea>
                <div class="rubrica">
                    <p>Rúbrica: 60% Ventajas, 40% Caso</p>
                </div>
            </div>
        </div>
    </section>

    <!-- 8️⃣ CIERRE METACOGNITIVO INTERACTIVO -->
    <section class="cierre-section">
        <h2 class="seccion-titulo neon-concepto">
            <span class="icon">🧠</span> CIERRE METACOGNITIVO INTERACTIVO
        </h2>
       
        <div class="cierre-container">
            <div class="autoevaluacion">
                <h3>📊 AUTOEVALUACIÓN DE HABILIDADES</h3>
                <div class="skill-meter">
                    <div class="skill-item">
                        <span>NoSQL Concepts:</span>
                        <div class="skill-bar">
                            <div class="skill-fill" data-level="0" style="width: 0%"></div>
                        </div>
                        <input type="range" min="0" max="100" value="0" class="skill-slider" data-skill="nosql">
                    </div>
                   
                    <div class="skill-item">
                        <span>Mongo Queries:</span>
                        <div class="skill-bar">
                            <div class="skill-fill" data-level="0" style="width: 0%"></div>
                        </div>
                        <input type="range" min="0" max="100" value="0" class="skill-slider" data-skill="queries">
                    </div>
                   
                    <div class="skill-item">
                        <span>Aggregation:</span>
                        <div class="skill-bar">
                            <div class="skill-fill" data-level="0" style="width: 0%"></div>
                        </div>
                        <input type="range" min="0" max="100" value="0" class="skill-slider" data-skill="agg">
                    </div>
                   
                    <div class="skill-item">
                        <span>Scaling:</span>
                        <div class="skill-bar">
                            <div class="skill-fill" data-level="0" style="width: 0%"></div>
                        </div>
                        <input type="range" min="0" max="100" value="0" class="skill-slider" data-skill="scale">
                    </div>
                </div>
               
                <button class="btn-guardar" onclick="guardarHabilidades()">
                    💾 GUARDAR EVALUACIÓN
                </button>
            </div>
           
            <div class="reflexion">
                <h3>💭 REFLEXIÓN GUIADA</h3>
                <div class="pregunta-reflexion">
                    <p>¿Cómo NoSQL cambia app development?</p>
                    <textarea placeholder="Escribe tu reflexión..." rows="3" id="reflexion1"></textarea>
                </div>
                <div class="pregunta-reflexion">
                    <p>Caso donde Mongo es better than SQL.</p>
                    <textarea placeholder="Escribe tu ejemplo..." rows="3" id="reflexion2"></textarea>
                </div>
            </div>
        </div>
       
        <div class="proyecto-final">
            <h3>🎯 PROYECTO FINAL: BLOG DB</h3>
            <div class="proyecto-enunciado">
                <p><strong>Objetivo:</strong> Modela DB para blog: posts con embedded comments.</p>
                <ul>
                    <li>Collection posts</li>
                    <li>Insert post con comments</li>
                    <li>Query recent posts</li>
                    <li>Aggregate comment count</li>
                </ul>
                <p><strong>Requisitos:</strong> Flexible schema, queries eficientes.</p>
            </div>
            <button class="btn-proyecto" onclick="mostrarEsqueletoProyecto()">
                📝 VER ESQUELETO
            </button>
            <div class="proyecto-solucion" id="proyectoSolucion" style="display: none;">
                <pre><code>db.posts.insertOne({
  title: "Post 1",
  content: "Text",
  comments: [{user: "A", text: "Comment"}]
})
db.posts.aggregate([
  {$match: {title: /Post/}},
  {$project: {commentCount: {$size: "$comments"}}}
])</code></pre>
            </div>
        </div>
       
        <div class="recursos">
            <h3>🔗 RECURSOS</h3>
            <div class="recursos-links">
                <a href="https://www.mongodb.com/docs/manual/" target="_blank" class="recurso-link">
                    ⚡ MongoDB Docs
                </a>
                <a href="https://www.mongodb.com/try" target="_blank" class="recurso-link">
                    🎮 Mongo Atlas Free
                </a>
                <a href="https://university.mongodb.com/" target="_blank" class="recurso-link">
                    📐 Mongo University
                </a>
                <a href="https://www.nosqlbooster.com/" target="_blank" class="recurso-link">
                    🚀 NoSQLBooster Tool
                </a>
            </div>
        </div>
    </section>
</div>

<script>
// JS PARA LA LECCIÓN COMPLETA - MongoDB + NoSQL
console.log(\'Inicializando lección Programación - MongoDB + NoSQL\');

const mongoDB = { collections: {} };
const mongoDefaultCode = `db.alumnos.insertMany([
  { nombre: "Ana López", edad: 17, nivel: "Avanzado", ciudad: "CDMX" },
  { nombre: "Carlos Ruiz", edad: 19, nivel: "Intermedio" },
  { nombre: "Sofía Mendoza", edad: 16, nivel: "Principiante", ciudad: "Guadalajara" },
  { nombre: "Luis Torres", edad: 18, nivel: "Avanzado" }
])\\ndb.alumnos.find({ nivel: "Avanzado" })\\ndb.alumnos.find({ edad: { $gte: 18 } })\\ndb.alumnos.countDocuments({ ciudad: "CDMX" })`;
const mongoTabs = [
    { label: \'Libre\', code: mongoDefaultCode },
    { label: \'Insert Many\', code: `db.alumnos.insertMany([\\n  { nombre: "Alicia", edad: 20, nivel: "Intermedio", ciudad: "Monterrey" },\\n  { nombre: "Pedro", edad: 22, nivel: "Avanzado", ciudad: "CDMX" }\\n])` },
    { label: \'Find\', code: `db.alumnos.find({ nivel: "Avanzado" })` },
    { label: \'Aggregate\', code: `db.alumnos.aggregate([\\n  { $match: { edad: { $gte: 18 } } },\\n  { $group: { _id: "$nivel", total: { $sum: 1 } } }\\n])` },
    { label: \'Update\', code: `db.alumnos.updateMany({ nivel: "Intermedio" }, { $set: { ciudad: "Guadalajara" } })` }
];
const mongoSnippets = {
    insertMany: `db.alumnos.insertMany([\\n  { nombre: "Nombre", edad: 25, nivel: "Avanzado", ciudad: "CDMX" }\\n])\\n`,
    find: `db.alumnos.find({ nivel: "Avanzado" })\\n`,
    findOne: `db.alumnos.findOne({ nombre: "Ana López" })\\n`,
    count: `db.alumnos.countDocuments({ ciudad: "CDMX" })\\n`,
    aggregate: `db.alumnos.aggregate([\\n  { $match: { ciudad: "CDMX" } },\\n  { $group: { _id: "$nivel", total: { $sum: 1 } } }\\n])\\n`,
    update: `db.alumnos.updateMany({ nivel: "Intermedio" }, { $set: { ciudad: "Guadalajara" } })\\n`
};
let activeMongoTab = 0;

function setMongoTab(index) {
    activeMongoTab = index;
    document.querySelectorAll(\'.mongo-sim-tab\').forEach((tab, i) => tab.classList.toggle(\'active\', i === index));
    document.getElementById(\'mongo-input\').value = mongoTabs[index].code;
    document.getElementById(\'mongo-output\').innerHTML = \'<span style="color:#888;">Modo \' + mongoTabs[index].label + \' cargado</span>\';
    setMongoStatus(\'idle\', mongoTabs[index].label);
}

function insertMongoSnippet(key) {
    const ta = document.getElementById(\'mongo-input\');
    const snippet = mongoSnippets[key] || \'\';
    const start = ta.selectionStart;
    const end = ta.selectionEnd;
    ta.value = ta.value.slice(0, start) + snippet + ta.value.slice(end);
    ta.selectionStart = ta.selectionEnd = start + snippet.length;
    ta.focus();
    setMongoStatus(\'idle\', \'snippet\');
}

function setMongoStatus(type, label) {
    const status = document.getElementById(\'mongoStatus\');
    const commandState = document.getElementById(\'mongoCommandState\');
    status.className = `mongo-status-pill status-${type}`;
    status.textContent = label;
    commandState.className = `mongo-status-pill status-${type}`;
    commandState.textContent = label;
}

function safeParse(str) {
    try {
        return new Function(\'return (\' + str + \')\')();
    } catch (e) {
        throw new Error(\'JSON inválido: \' + e.message);
    }
}

function unirComandos(texto) {
    const comandos = [];
    let buffer = \'\';
    texto.split(\'\\n\').forEach(linea => {
        let raw = linea.trim();
        if (!raw || raw.startsWith(\'//\')) return;
        raw = raw.replace(/;$/, \'\');
        buffer += (buffer ? \' \' : \'\') + raw;
        if (raw.endsWith(\')\') || raw.endsWith(\']\')) {
            comandos.push(buffer.trim());
            buffer = \'\';
        }
    });
    if (buffer.trim()) comandos.push(buffer.trim());
    return comandos;
}

function formatResult(value) {
    if (typeof value === \'string\') return value;
    return JSON.stringify(value, null, 2);
}

function ejecutarMongo() {
    const input = document.getElementById(\'mongo-input\').value.trim();
    const output = document.getElementById(\'mongo-output\');
    setMongoStatus(\'running\', \'ejecutando\');
    if (!input) {
        output.innerHTML = \'<span style="color:#ff6666;">Escribe al menos un comando</span>\';
        setMongoStatus(\'error\', \'vacío\');
        return;
    }

    let resultado = \'\';
    try {
        const comandos = unirComandos(input);
        comandos.forEach(linea => {
            if (linea.includes(\'insertMany(\')) {
                const match = linea.match(/db\\.(\\w+)\\.insertMany\\(([\\s\\S]*)\\)$/);
                if (match) {
                    const coll = match[1];
                    const docs = safeParse(match[2]);
                    if (!Array.isArray(docs)) throw new Error(\'insertMany requiere un array\');
                    mongoDB.collections[coll] = mongoDB.collections[coll] || [];
                    docs.forEach(d => {
                        d._id = \'oid_\' + Date.now().toString(36) + Math.random().toString(36).substr(2, 5);
                        mongoDB.collections[coll].push(d);
                    });
                    resultado += `Insertados ${docs.length} documentos en ${coll}\\n`;
                    return;
                }
            }
            if (linea.includes(\'insertOne(\')) {
                const match = linea.match(/db\\.(\\w+)\\.insertOne\\(([\\s\\S]*)\\)$/);
                if (match) {
                    const coll = match[1];
                    const doc = safeParse(match[2]);
                    mongoDB.collections[coll] = mongoDB.collections[coll] || [];
                    doc._id = \'oid_\' + Date.now().toString(36);
                    mongoDB.collections[coll].push(doc);
                    resultado += `Insertado 1 documento → _id: ${doc._id}\\n`;
                    return;
                }
            }
            if (linea.includes(\'findOne(\') || (linea.includes(\'find(\') && !linea.includes(\'findOne\'))) {
                const esOne = linea.includes(\'findOne\');
                const match = linea.match(/db\\.(\\w+)\\.(findOne|find)\\(([\\s\\S]*)\\)$/);
                if (match) {
                    const coll = match[1];
                    const filtro = match[3] ? safeParse(match[3]) : {};
                    let lista = mongoDB.collections[coll] || [];
                    lista = lista.filter(doc => {
                        for (let k in filtro) {
                            const cond = filtro[k];
                            if (typeof cond === \'object\' && cond !== null) {
                                if (\'$gte\' in cond && !(doc[k] >= cond.$gte)) return false;
                                if (\'$gt\' in cond && !(doc[k] > cond.$gt)) return false;
                                if (\'$lt\' in cond && !(doc[k] < cond.$lt)) return false;
                                if (\'$lte\' in cond && !(doc[k] <= cond.$lte)) return false;
                            } else if (doc[k] !== cond) {
                                return false;
                            }
                        }
                        return true;
                    });
                    resultado += formatResult(esOne ? lista[0] || null : lista) + \'\\n\';
                    return;
                }
            }
            if (linea.includes(\'aggregate(\')) {
                const match = linea.match(/db\\.(\\w+)\\.aggregate\\(([\\s\\S]*)\\)$/);
                if (match) {
                    const coll = match[1];
                    const pipeline = safeParse(match[2]);
                    let lista = [...(mongoDB.collections[coll] || [])];
                    pipeline.forEach(stage => {
                        if (stage.$match) {
                            lista = lista.filter(doc => {
                                for (let key in stage.$match) {
                                    const cond = stage.$match[key];
                                    if (typeof cond === \'object\' && cond !== null) {
                                        if (\'$gte\' in cond && !(doc[key] >= cond.$gte)) return false;
                                        if (\'$lte\' in cond && !(doc[key] <= cond.$lte)) return false;
                                        if (\'$gt\' in cond && !(doc[key] > cond.$gt)) return false;
                                        if (\'$lt\' in cond && !(doc[key] < cond.$lt)) return false;
                                    } else if (doc[key] !== cond) {
                                        return false;
                                    }
                                }
                                return true;
                            });
                        }
                        if (stage.$group) {
                            const grouped = {};
                            lista.forEach(doc => {
                                const groupKey = stage.$group._id === null ? \'__all\' : doc[stage.$group._id.replace(/^\\$/, \'\')];
                                grouped[groupKey] = grouped[groupKey] || { _id: groupKey, __count: 0 };
                                grouped[groupKey].__count += 1;
                                for (let field in stage.$group) {
                                    if (field === \'_id\') continue;
                                    const expr = stage.$group[field];
                                    if (expr.$sum !== undefined) {
                                        const value = expr.$sum === 1 ? 1 : doc[expr.$sum.replace(/^\\$/, \'\')] || 0;
                                        grouped[groupKey][field] = (grouped[groupKey][field] || 0) + value;
                                    }
                                    if (expr.$avg !== undefined) {
                                        grouped[groupKey][field] = grouped[groupKey][field] || { total: 0, count: 0 };
                                        grouped[groupKey][field].total += doc[expr.$avg.replace(/^\\$/, \'\')] || 0;
                                        grouped[groupKey][field].count += 1;
                                    }
                                }
                            });
                            lista = Object.values(grouped).map(item => {
                                const row = { _id: item._id };
                                for (let key in item) {
                                    if (key === \'_id\' || key === \'__count\') continue;
                                    const value = item[key];
                                    row[key] = value && value.total !== undefined ? value.total / value.count : value;
                                }
                                return row;
                            });
                        }
                        if (stage.$project) {
                            lista = lista.map(doc => {
                                const projected = {};
                                for (let key in stage.$project) {
                                    if (stage.$project[key] === 1) projected[key] = doc[key];
                                    if (typeof stage.$project[key] === \'string\' && stage.$project[key].startsWith(\'$\')) {
                                        projected[key] = doc[stage.$project[key].substring(1)];
                                    }
                                }
                                return projected;
                            });
                        }
                    });
                    resultado += formatResult(lista) + \'\\n\';
                    return;
                }
            }
            if (linea.includes(\'countDocuments(\')) {
                const match = linea.match(/db\\.(\\w+)\\.countDocuments\\(([\\s\\S]*)\\)$/);
                if (match) {
                    const coll = match[1];
                    const filtro = match[2] ? safeParse(match[2]) : {};
                    const count = (mongoDB.collections[coll] || []).filter(doc => {
                        for (let key in filtro) {
                            if (doc[key] !== filtro[key]) return false;
                        }
                        return true;
                    }).length;
                    resultado += `${count}\\n`;
                    return;
                }
            }
            if (linea.includes(\'updateMany(\')) {
                const match = linea.match(/db\\.(\\w+)\\.updateMany\\(([^,]+),([\\s\\S]*)\\)$/);
                if (match) {
                    const coll = match[1];
                    const filtro = safeParse(match[2]);
                    const update = safeParse(match[3]);
                    let lista = mongoDB.collections[coll] || [];
                    let count = 0;
                    lista.forEach(doc => {
                        let ok = true;
                        for (let key in filtro) {
                            if (doc[key] !== filtro[key]) ok = false;
                        }
                        if (ok) {
                            count += 1;
                            if (update.$set) Object.assign(doc, update.$set);
                        }
                    });
                    resultado += `Actualizados ${count} documentos en ${coll}\\n`;
                    return;
                }
            }
            resultado += \'Comando no soportado: \' + linea + \'\\n\';
        });
        output.innerHTML = resultado.replace(/\\n/g, \'<br>\').replace(/ /g, \'&nbsp;\');
        setMongoStatus(\'success\', \'ok\');
    } catch (err) {
        output.innerHTML = `<span style=\'color:#ff4444;\'>ERROR: ${err.message}</span>`;
        setMongoStatus(\'error\', \'error\');
    }
    document.getElementById(\'collectionsCount\').textContent = Object.keys(mongoDB.collections).length;
    let total = 0;
    for (let c in mongoDB.collections) total += mongoDB.collections[c].length;
    document.getElementById(\'totalDocs\').textContent = total;
    document.getElementById(\'mongoLastCommand\').textContent = new Date().toLocaleTimeString();
}

function limpiarMongo() {
    mongoDB.collections = {};
    document.getElementById(\'mongo-output\').innerHTML = \'<span style="color:#00bcd4;">Base de datos limpiada</span>\';
    document.getElementById(\'collectionsCount\').textContent = 0;
    document.getElementById(\'totalDocs\').textContent = 0;
    document.getElementById(\'mongoLastCommand\').textContent = \'-\';
    setMongoStatus(\'idle\', \'limpio\');
}

function resetMongoCode() {
    document.getElementById(\'mongo-input\').value = mongoDefaultCode;
    document.getElementById(\'mongo-output\').innerHTML = \'<span style="color:#888;">Ejemplo cargado</span>\';
    setMongoStatus(\'idle\', \'ejemplo\');
}

setMongoTab(0);

function cargarEjemplo(num) {
    const ejemplos = {
        1: `db.test.insertMany([\\n  { item: "laptop", qty: 10 },\\n  { item: "mouse", qty: 50 }\\n])`,
        2: `db.test.find({ qty: { $gte: 20 } })`,
        3: `db.test.updateMany({ item: "mouse" }, { $set: { qty: 55 } })`,
        4: `db.test.aggregate([\\n  { $match: { qty: { $gte: 10 } } },\\n  { $group: { _id: "$item", totalQty: { $sum: "$qty" } } }\\n])`
    };
    document.getElementById(\'mongo-input\').value = ejemplos[num] || mongoDefaultCode;
    document.getElementById(\'mongo-output\').innerHTML = \'<span style="color:#00bcd4;">Ejemplo cargado</span>\';
    setMongoStatus(\'idle\', \'ejemplo\');
}

// Objetivos interactivos
document.querySelectorAll(\'.objetivo-card\').forEach(card => {
    card.addEventListener(\'click\', () => {
        const completado = card.dataset.completado === \'true\';
        card.dataset.completado = !completado;
        card.querySelector(\'.objetivo-checkbox\').style.background = !completado ? \'var(--neon-concepto)\' : \'\';
    });
});

// Operaciones tabla interactiva
document.querySelectorAll(\'.tabla-cyberpunk tbody tr\').forEach(tr => {
    tr.addEventListener(\'click\', () => {
        const tipo = tr.dataset.tipo;
        document.querySelectorAll(\'.ejemplo-detalle\').forEach(det => det.style.display = \'none\');
        const detalleId = \'detalle\' + tipo.charAt(0).toUpperCase() + tipo.slice(1);
        if (document.getElementById(detalleId)) {
            document.getElementById(detalleId).style.display = \'block\';
        }
        document.getElementById(\'infoOperacion\').textContent = `Detalles para ${tipo.toUpperCase()}`;
    });
});

// Quiz
let quizCompletadas = 0;
document.querySelectorAll(\'.quiz-option\').forEach(option => {
    option.addEventListener(\'click\', () => {
        const question = option.closest(\'.quiz-question\');
        if (question.dataset.answered) return;
        question.dataset.answered = \'true\';
        const value = option.dataset.value;
        const correct = question.dataset.correct;
        const feedback = question.querySelector(\'.quiz-feedback\');
        feedback.style.display = \'block\';
        if (value === correct) {
            option.classList.add(\'correct\');
            feedback.querySelector(\'.feedback-correct\').style.display = \'block\';
        } else {
            option.classList.add(\'incorrect\');
            feedback.querySelector(\'.feedback-incorrect\').style.display = \'block\';
        }
        quizCompletadas++;
        if (quizCompletadas === document.querySelectorAll(\'.quiz-question\').length) {
            mostrarResultadosQuiz();
        }
    });
});

function mostrarResultadosQuiz() {
    const correctas = document.querySelectorAll(\'.quiz-option.correct\').length;
    document.getElementById(\'quizScore\').textContent = correctas;
    document.getElementById(\'quizFeedback\').textContent = correctas === 3 ? \'¡Excelente dominio!\' : correctas === 2 ? \'Bien, revisa conceptos\' : \'Practica más\';
    document.querySelector(\'.quiz-results\').style.display = \'block\';
}

function reiniciarQuiz() {
    document.querySelectorAll(\'.quiz-question\').forEach(q => {
        q.dataset.answered = \'\';
        q.querySelector(\'.quiz-feedback\').style.display = \'none\';
        q.querySelectorAll(\'.quiz-option\').forEach(o => o.classList.remove(\'correct\', \'incorrect\'));
    });
    quizCompletadas = 0;
    document.querySelector(\'.quiz-results\').style.display = \'none\';
}

// Errores comunes (colapsables)
document.querySelectorAll(\'.collapsible .error-header\').forEach(header => {
    header.addEventListener(\'click\', () => {
        const content = header.nextElementSibling;
        const icon = header.querySelector(\'.collapse-icon\');
        content.style.display = content.style.display === \'none\' ? \'block\' : \'none\';
        icon.textContent = content.style.display === \'block\' ? \'-\' : \'+\';
    });
});

function verificarError(num, btn) {
    const input = btn.previousElementSibling.value.toLowerCase();
    const feedback = btn.nextElementSibling;
    let correct = false;
    if (num === 1) correct = input.includes(\'index\') || input.includes(\'createindex\');
    if (num === 2) correct = input.includes(\'$\') || input.includes(\'operator\');
    if (num === 3) correct = input.includes(\'aggregate\') || input.includes(\'$group\');
    feedback.textContent = correct ? \'Correcto!\' : \'Intenta de nuevo\';
    feedback.style.color = correct ? \'var(--neon-concepto)\' : \'var(--neon-alerta)\';
}

// Autoevaluación habilidades
document.querySelectorAll(\'.skill-slider\').forEach(slider => {
    slider.addEventListener(\'input\', () => {
        const fill = slider.previousElementSibling.querySelector(\'.skill-fill\');
        fill.style.width = slider.value + \'%\';
    });
});

function guardarHabilidades() {
    const skills = {};
    document.querySelectorAll(\'.skill-slider\').forEach(sl => skills[sl.dataset.skill] = sl.value);
    localStorage.setItem(\'mongoSkills\', JSON.stringify(skills));
    alert(\'Habilidades guardadas\');
}

function mostrarEsqueletoProyecto() {
    document.getElementById(\'proyectoSolucion\').style.display = \'block\';
}
</script>',
    'ejercicios' => 
    array (
      0 => 
      array (
        'enunciado' => 'Insertar documento',
        'respuesta' => 'db.coll.insertOne({campo: valor})',
      ),
      1 => 
      array (
        'enunciado' => 'Buscar todos',
        'respuesta' => 'db.coll.find()',
      ),
      2 => 
      array (
        'enunciado' => 'Buscar con filtro',
        'respuesta' => 'db.coll.find({campo: valor})',
      ),
      3 => 
      array (
        'enunciado' => 'Actualizar',
        'respuesta' => 'db.coll.updateOne(filtro, {$set: {campo: nuevo}})',
      ),
      4 => 
      array (
        'enunciado' => 'Eliminar',
        'respuesta' => 'db.coll.deleteOne({campo: valor})',
      ),
      5 => 
      array (
        'enunciado' => 'Schema-less significa',
        'respuesta' => 'Sin esquema fijo',
      ),
      6 => 
      array (
        'enunciado' => 'Colección =',
        'respuesta' => 'Grupo de documentos',
      ),
      7 => 
      array (
        'enunciado' => 'BSON es',
        'respuesta' => 'JSON binario',
      ),
      8 => 
      array (
        'enunciado' => '$gt significa',
        'respuesta' => 'Mayor que',
      ),
      9 => 
      array (
        'enunciado' => 'insertMany para',
        'respuesta' => 'Múltiples documentos',
      ),
      10 => 
      array (
        'enunciado' => 'findOne devuelve',
        'respuesta' => 'Primer documento',
      ),
      11 => 
      array (
        'enunciado' => 'SI: % apps con MongoDB',
        'respuesta' => '~70%',
      ),
    ),
    'quiz' => 
    array (
      0 => 
      array (
        'pregunta' => 'MongoDB es',
        'opciones' => 
        array (
          0 => 'Documental',
          1 => 'Relacional',
          2 => 'Grafos',
          3 => 'Columnas',
        ),
        'correcta' => 'Documental',
      ),
      1 => 
      array (
        'pregunta' => 'Almacena en',
        'opciones' => 
        array (
          0 => 'BSON',
          1 => 'SQL',
          2 => 'CSV',
          3 => 'XML',
        ),
        'correcta' => 'BSON',
      ),
      2 => 
      array (
        'pregunta' => 'Colección =',
        'opciones' => 
        array (
          0 => 'Tabla',
          1 => 'Fila',
          2 => 'BD',
          3 => 'Índice',
        ),
        'correcta' => 'Tabla',
      ),
      3 => 
      array (
        'pregunta' => 'Documento =',
        'opciones' => 
        array (
          0 => 'Fila JSON',
          1 => 'Columna',
          2 => 'Tabla',
          3 => 'BD',
        ),
        'correcta' => 'Fila JSON',
      ),
      4 => 
      array (
        'pregunta' => 'Schema-less',
        'opciones' => 
        array (
          0 => 'Flexible',
          1 => 'Rígido',
          2 => 'Binario',
          3 => 'Nulo',
        ),
        'correcta' => 'Flexible',
      ),
      5 => 
      array (
        'pregunta' => 'Escalabilidad',
        'opciones' => 
        array (
          0 => 'Horizontal',
          1 => 'Vertical',
          2 => 'Ninguna',
          3 => 'Cloud',
        ),
        'correcta' => 'Horizontal',
      ),
      6 => 
      array (
        'pregunta' => 'Sharding divide',
        'opciones' => 
        array (
          0 => 'Datos entre servidores',
          1 => 'Una tabla',
          2 => 'Nada',
          3 => 'RAM',
        ),
        'correcta' => 'Datos entre servidores',
      ),
      7 => 
      array (
        'pregunta' => 'Replica Set para',
        'opciones' => 
        array (
          0 => 'Alta disponibilidad',
          1 => 'Velocidad',
          2 => 'Nada',
          3 => 'Backup',
        ),
        'correcta' => 'Alta disponibilidad',
      ),
      8 => 
      array (
        'pregunta' => 'Atlas es',
        'opciones' => 
        array (
          0 => 'MongoDB Cloud',
          1 => 'Local',
          2 => 'CLI',
          3 => 'GUI',
        ),
        'correcta' => 'MongoDB Cloud',
      ),
      9 => 
      array (
        'pregunta' => 'insertOne devuelve',
        'opciones' => 
        array (
          0 => '_id insertado',
          1 => 'Documento',
          2 => 'Nada',
          3 => 'Error',
        ),
        'correcta' => '_id insertado',
      ),
      10 => 
      array (
        'pregunta' => 'find() sin filtro',
        'opciones' => 
        array (
          0 => 'Todos',
          1 => 'Uno',
          2 => 'Ninguno',
          3 => 'Error',
        ),
        'correcta' => 'Todos',
      ),
      11 => 
      array (
        'pregunta' => 'findOne()',
        'opciones' => 
        array (
          0 => 'Primer match',
          1 => 'Todos',
          2 => 'Último',
          3 => 'Error',
        ),
        'correcta' => 'Primer match',
      ),
      12 => 
      array (
        'pregunta' => 'updateOne modifica',
        'opciones' => 
        array (
          0 => 'Primer match',
          1 => 'Todos',
          2 => 'Ninguno',
          3 => 'Error',
        ),
        'correcta' => 'Primer match',
      ),
      13 => 
      array (
        'pregunta' => 'updateMany',
        'opciones' => 
        array (
          0 => 'Todos los match',
          1 => 'Uno',
          2 => 'Ninguno',
          3 => 'Error',
        ),
        'correcta' => 'Todos los match',
      ),
      14 => 
      array (
        'pregunta' => '$set en update',
        'opciones' => 
        array (
          0 => 'Asigna valor',
          1 => 'Elimina',
          2 => 'Busca',
          3 => 'Nada',
        ),
        'correcta' => 'Asigna valor',
      ),
      15 => 
      array (
        'pregunta' => '$gt',
        'opciones' => 
        array (
          0 => 'Mayor que',
          1 => 'Igual',
          2 => 'Menor',
          3 => 'Existe',
        ),
        'correcta' => 'Mayor que',
      ),
      16 => 
      array (
        'pregunta' => '$in',
        'opciones' => 
        array (
          0 => 'En lista',
          1 => 'No en lista',
          2 => 'Igual',
          3 => 'Nulo',
        ),
        'correcta' => 'En lista',
      ),
      17 => 
      array (
        'pregunta' => 'deleteOne',
        'opciones' => 
        array (
          0 => 'Primer match',
          1 => 'Todos',
          2 => 'Ninguno',
          3 => 'Error',
        ),
        'correcta' => 'Primer match',
      ),
      18 => 
      array (
        'pregunta' => 'countDocuments',
        'opciones' => 
        array (
          0 => 'Cuenta',
          1 => 'Suma',
          2 => 'Lista',
          3 => 'Nada',
        ),
        'correcta' => 'Cuenta',
      ),
      19 => 
      array (
        'pregunta' => 'aggregate para',
        'opciones' => 
        array (
          0 => 'Análisis complejo',
          1 => 'INSERT',
          2 => 'DELETE',
          3 => 'SELECT',
        ),
        'correcta' => 'Análisis complejo',
      ),
      20 => 
      array (
        'pregunta' => 'MongoDB soporta',
        'opciones' => 
        array (
          0 => 'Índices',
          1 => 'Solo PK',
          2 => 'Nada',
          3 => 'SQL',
        ),
        'correcta' => 'Índices',
      ),
      21 => 
      array (
        'pregunta' => 'Transacciones desde',
        'opciones' => 
        array (
          0 => 'v4.0',
          1 => 'v1.0',
          2 => 'v6.0',
          3 => 'Nunca',
        ),
        'correcta' => 'v4.0',
      ),
      22 => 
      array (
        'pregunta' => 'Compass es',
        'opciones' => 
        array (
          0 => 'GUI oficial',
          1 => 'CLI',
          2 => 'Cloud',
          3 => 'API',
        ),
        'correcta' => 'GUI oficial',
      ),
      23 => 
      array (
        'pregunta' => 'SI 2025: NoSQL crece',
        'opciones' => 
        array (
          0 => '+25% anual',
          1 => '0%',
          2 => '-10%',
          3 => 'Estable',
        ),
        'correcta' => '+25% anual',
      ),
      24 => 
      array (
        'pregunta' => 'MongoDB en',
        'opciones' => 
        array (
          0 => 'Netflix, Google',
          1 => 'Solo startups',
          2 => 'Nada',
          3 => 'SQL',
        ),
        'correcta' => 'Netflix, Google',
      ),
      25 => 
      array (
        'pregunta' => 'BSON permite',
        'opciones' => 
        array (
          0 => 'Tipos binarios',
          1 => 'Solo texto',
          2 => 'Nada',
          3 => 'XML',
        ),
        'correcta' => 'Tipos binarios',
      ),
      26 => 
      array (
        'pregunta' => 'ObjectId es',
        'opciones' => 
        array (
          0 => '12 bytes único',
          1 => 'Entero',
          2 => 'Texto',
          3 => 'Fecha',
        ),
        'correcta' => '12 bytes único',
      ),
      27 => 
      array (
        'pregunta' => 'SI 2025: % datos no estructurados',
        'opciones' => 
        array (
          0 => '+80%',
          1 => '50%',
          2 => '20%',
          3 => '0%',
        ),
        'correcta' => '+80%',
      ),
      28 => 
      array (
        'pregunta' => 'NoSQL ideal para',
        'opciones' => 
        array (
          0 => 'Datos variables',
          1 => 'Transacciones bancarias',
          2 => 'Todo',
          3 => 'Nada',
        ),
        'correcta' => 'Datos variables',
      ),
      29 => 
      array (
        'pregunta' => 'MongoDB vs SQL',
        'opciones' => 
        array (
          0 => 'Flexible > Rígido',
          1 => 'Igual',
          2 => 'Rígido > Flexible',
          3 => 'No compara',
        ),
        'correcta' => 'Flexible > Rígido',
      ),
    ),
  ),
  3 => 
  array (
    'materia' => 'Programación',
    'slug' => 'metodologias-scrum',
    'titulo' => 'SCRUM + Agile: Roles, Eventos, Simulador y Retos Interactivos 2025',
    'contenido' => '<!-- INICIO LECCIÓN CYBERPUNK PROGRAMACIÓN -->
<div class="leccion-container leccion-programacion-metodologias-scrum" data-tema="metodologias-scrum">
    
    <!-- 1️⃣ INTRODUCCIÓN CONCEPTUAL CYBERPUNK -->
    <header class="leccion-header">
        <h1 class="titulo-leccion neon-glow">
            <span class="icon-tema">⚡</span>
            SCRUM + AGILE
        </h1>
        <div class="subtitulo">
            Metodologías Ágiles: Roles, Eventos y Simulación 2025
        </div>
    </header>
    <section class="panel-objetivos">
        <h2 class="seccion-titulo neon-concepto">
            <span class="icon">🎯</span> OBJETIVOS DE APRENDIZAJE
        </h2>
        <div class="objetivos-grid">
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Dominar pilares y valores Agile</h3>
                <p>Transparencia, inspección, adaptación</p>
            </div>
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Conocer roles SCRUM</h3>
                <p>Product Owner, Scrum Master, Development Team</p>
            </div>
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Entender eventos y artefactos</h3>
                <p>Sprint, Daily, Review, Retro</p>
            </div>
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Simular sprints reales</h3>
                <p>Planning, ejecución y retros</p>
            </div>
        </div>
    </section>
    <section class="contexto-real">
        <h2 class="seccion-titulo neon-dato">
            <span class="icon">🌍</span> APLICACIÓN EN EL MUNDO REAL
        </h2>
        <div class="contexto-grid">
            <div class="contexto-card">
                <h3>🎵 Spotify</h3>
                <p>Squads autónomos</p>
                <div class="dato-neon">+30% velocidad</div>
            </div>
            <div class="contexto-card">
                <h3>📺 Netflix</h3>
                <p>Entregas continuas</p>
                <div class="dato-neon">Zero downtime</div>
            </div>
            <div class="contexto-card">
                <h3>🚀 Google</h3>
                <p>OKRs + SCRUM</p>
                <div class="dato-neon">78% equipos 2025</div>
            </div>
        </div>
        <div class="relacion-curricular">
            <h3>RELACIÓN CURRICULAR</h3>
            <div class="badges">
                <span class="badge">Competencia: Gestión de Proyectos</span>
                <span class="badge">Contenido: Metodologías Ágiles</span>
                <span class="badge">Evaluación: Simulación Sprint</span>
            </div>
        </div>
    </section>

    <!-- 2️⃣ DESARROLLO TEÓRICO ESTRUCTURADO -->
    <section class="teoria-section">
        <div class="borde-neon-lateral"></div>
        <h2 class="seccion-titulo neon-concepto">
            <span class="icon">📚</span> FUNDAMENTOS AGILE + SCRUM
        </h2>
       
        <!-- PILARES Y VALORES -->
        <div class="subseccion">
            <h3>1. Manifiesto Agile y Valores</h3>
            <div class="definicion-principal">
                <div class="def-card">
                    <h4>🧭 MANIFIESTO AGILE (2001)</h4>
                    <p>4 valores fundamentales:</p>
                    <div class="principios-grid">
                        <div class="principio">
                            <div class="principio-icon">👥</div>
                            <h5>Individuos e interacciones</h5>
                            <p>sobre procesos y herramientas</p>
                        </div>
                        <div class="principio">
                            <div class="principio-icon">⚙️</div>
                            <h5>Software funcionando</h5>
                            <p>sobre documentación extensiva</p>
                        </div>
                        <div class="principio">
                            <div class="principio-icon">🤝</div>
                            <h5>Colaboración con el cliente</h5>
                            <p>sobre negociación contractual</p>
                        </div>
                        <div class="principio">
                            <div class="principio-icon">🔄</div>
                            <h5>Respuesta al cambio</h5>
                            <p>sobre seguir un plan</p>
                        </div>
                    </div>
                </div>
            </div>
           
            <div class="clasificacion-doble">
                <div class="clas-card pilares">
                    <h4>🛡️ 3 Pilares SCRUM</h4>
                    <ul>
                        <li><strong>Transparencia:</strong> Visibilidad total</li>
                        <li><strong>Inspección:</strong> Revisión frecuente</li>
                        <li><strong>Adaptación:</strong> Ajuste inmediato</li>
                    </ul>
                </div>
               
                <div class="clas-card valores">
                    <h4>❤️ 5 Valores SCRUM</h4>
                    <ul>
                        <li>Compromiso</li>
                        <li>Coraje</li>
                        <li>Foco</li>
                        <li>Apertura</li>
                        <li>Respeto</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- ROLES -->
        <div class="subseccion">
            <h3>2. Roles SCRUM</h3>
            <div class="comparativa-grid">
                <div class="comp-card po">
                    <div class="comp-header">
                        <h4>👑 Product Owner</h4>
                        <div class="comp-badge">VOZ DEL CLIENTE</div>
                    </div>
                    <div class="comp-caracteristicas">
                        <p><strong>Responsabilidades:</strong></p>
                        <ul>
                            <li>Maximizar valor del producto</li>
                            <li>Gestionar Product Backlog</li>
                            <li>Priorizar features</li>
                            <li>Aceptar/rechazar incrementos</li>
                        </ul>
                    </div>
                </div>
               
                <div class="comp-card sm">
                    <div class="comp-header">
                        <h4>🛡️ Scrum Master</h4>
                        <div class="comp-badge">FACILITADOR</div>
                    </div>
                    <div class="comp-caracteristicas">
                        <p><strong>Responsabilidades:</strong></p>
                        <ul>
                            <li>Facilitar eventos</li>
                            <li>Eliminar impedimentos</li>
                            <li>Coaching Agile</li>
                            <li>Proteger al equipo</li>
                        </ul>
                    </div>
                </div>
               
                <div class="comp-card dev">
                    <div class="comp-header">
                        <h4>👥 Development Team</h4>
                        <div class="comp-badge">AUTOORGANIZADO</div>
                    </div>
                    <div class="comp-caracteristicas">
                        <p><strong>Características:</strong></p>
                        <ul>
                            <li>3-9 personas</li>
                            <li>Cross-functional</li>
                            <li>Sin jerarquías internas</li>
                            <li>Compromiso colectivo</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- EVENTOS -->
        <div class="subseccion">
            <h3>3. Eventos SCRUM</h3>
            <div class="tabla-interactiva">
                <table class="tabla-cyberpunk">
                    <thead>
                        <tr>
                            <th>EVENTO</th>
                            <th>DURACIÓN</th>
                            <th>OBJETIVO</th>
                            <th>TIMEBOX</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr data-tipo="planning">
                            <td><strong class="neon-concepto">Sprint Planning</strong></td>
                            <td>8h (sprint 1 mes)</td>
                            <td>¿Qué y cómo hacer?</td>
                            <td>Proporcional</td>
                        </tr>
                        <tr data-tipo="daily">
                            <td><strong class="neon-concepto">Daily Scrum</strong></td>
                            <td>15 min</td>
                            <td>Sincronización diaria</td>
                            <td>Fijo</td>
                        </tr>
                        <tr data-tipo="review">
                            <td><strong class="neon-concepto">Sprint Review</strong></td>
                            <td>4h</td>
                            <td>Demo y feedback</td>
                            <td>Proporcional</td>
                        </tr>
                        <tr data-tipo="retro">
                            <td><strong class="neon-concepto">Sprint Retrospective</strong></td>
                            <td>3h</td>
                            <td>Mejorar proceso</td>
                            <td>Proporcional</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- ARTEFACTOS -->
        <div class="subseccion">
            <h3>4. Artefactos SCRUM</h3>
            <div class="advanced-grid">
                <div class="adv-card" data-adv="backlog">
                    <div class="adv-header">
                        <div class="adv-badge">Backlog</div>
                        <h4>Product Backlog</h4>
                    </div>
                    <div class="adv-content">
                        <p>Lista ordenada de todo lo conocido</p>
                        <ul>
                            <li>User stories</li>
                            <li>Refinement continuo</li>
                            <li>DEEP: Detailed, Emergent, Estimated, Prioritized</li>
                        </ul>
                    </div>
                </div>
               
                <div class="adv-card" data-adv="sprint">
                    <div class="adv-header">
                        <div class="adv-badge">Sprint</div>
                        <h4>Sprint Backlog</h4>
                    </div>
                    <div class="adv-content">
                        <p>Plan para el sprint actual</p>
                        <ul>
                            <li>Tareas descompuestas</li>
                            <li>Propiedad del equipo</li>
                            <li>Forecast de entrega</li>
                        </ul>
                    </div>
                </div>
               
                <div class="adv-card" data-adv="increment">
                    <div class="adv-header">
                        <div class="adv-badge">Increment</div>
                        <h4>Increment</h4>
                    </div>
                    <div class="adv-content">
                        <p>Producto potencialmente entregable</p>
                        <ul>
                            <li>"Done" según DoD</li>
                            <li>Sumatorio de sprints</li>
                            <li>Inspeccionable</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 3️⃣ VISUALIZACIÓN DIDÁCTICA INTERACTIVA -->
    <section class="visualizacion-section">
        <h2 class="seccion-titulo neon-interactivo">
            <span class="icon">📊</span> VISUALIZACIÓN DIDÁCTICA INTERACTIVA
        </h2>
        <div class="diagrama-container">
            <div class="diagrama-visual">
                <svg viewBox="0 0 1000 600" id="svgDiagrama" class="er-diagram-interactive">
                    <defs>
                        <marker id="arrow" markerWidth="10" markerHeight="10" refX="9" refY="3" orient="auto">
                            <path d="M0,0 L0,6 L9,3 z" fill="#39FF14"/>
                        </marker>
                    </defs>
                    <rect width="1000" height="600" fill="none"/>
                    
                    <!-- Sprint Container -->
                    <rect x="100" y="100" width="800" height="400" rx="20" fill="rgba(0,188,212,0.3)" stroke="#00ff00" stroke-width="4"/>
                    <text x="500" y="80" fill="#00ff00" text-anchor="middle" font-size="32" style="text-shadow: 0 0 10px #00ff00">SPRINT (1-4 semanas)</text>
                    
                    <!-- Events -->
                    <g transform="translate(200,180)">
                        <circle cx="0" cy="0" r="60" fill="rgba(255,0,255,0.5)" stroke="#ff00ff" stroke-width="3"/>
                        <text x="0" y="-10" fill="white" text-anchor="middle" font-size="16">Planning</text>
                        <text x="0" y="10" fill="#bbdefb" text-anchor="middle" font-size="12">8h máx</text>
                    </g>
                    
                    <g transform="translate(500,150)">
                        <circle cx="0" cy="0" r="50" fill="rgba(255,255,0,0.5)" stroke="#ffff00" stroke-width="3"/>
                        <text x="0" y="-5" fill="black" text-anchor="middle" font-size="14">Daily Scrum</text>
                        <text x="0" y="15" fill="#bbdefb" text-anchor="middle" font-size="12">15 min</text>
                    </g>
                    
                    <g transform="translate(800,180)">
                        <circle cx="0" cy="0" r="60" fill="rgba(255,107,107,0.5)" stroke="#ff6b6b" stroke-width="3"/>
                        <text x="0" y="-10" fill="white" text-anchor="middle" font-size="16">Review</text>
                        <text x="0" y="10" fill="#bbdefb" text-anchor="middle" font-size="12">4h máx</text>
                    </g>
                    
                    <g transform="translate(500,350)">
                        <circle cx="0" cy="0" r="70" fill="rgba(0,150,136,0.5)" stroke="#00ff9d" stroke-width="3"/>
                        <text x="0" y="-10" fill="white" text-anchor="middle" font-size="16">Retrospective</text>
                        <text x="0" y="10" fill="#bbdefb" text-anchor="middle" font-size="12">3h máx</text>
                    </g>
                    
                    <g transform="translate(500,480)">
                        <rect x="-100" y="-30" width="200" height="60" rx="15" fill="rgba(57,255,20,0.5)" stroke="#39ff14" stroke-width="3"/>
                        <text x="0" y="0" fill="black" text-anchor="middle" font-size="18">INCREMENT</text>
                        <text x="0" y="20" fill="#bbdefb" text-anchor="middle" font-size="12">Potentially Shippable</text>
                    </g>
                    
                    <!-- Arrows -->
                    <path d="M260,180 Q350,150 440,150" fill="none" stroke="#ffff00" stroke-width="4" marker-end="url(#arrow)"/>
                    <path d="M560,150 Q650,150 740,180" fill="none" stroke="#ffff00" stroke-width="4" marker-end="url(#arrow)"/>
                    <path d="M800,240 Q650,300 560,350" fill="none" stroke="#ffff00" stroke-width="4" marker-end="url(#arrow)"/>
                    <path d="M500,280 Q500,320 500,450" fill="none" stroke="#ffff00" stroke-width="4" marker-end="url(#arrow)"/>
                    
                    <text x="500" y="550" fill="#00ff88" text-anchor="middle" font-size="20" style="text-shadow: 0 0 10px #00ff88">Ciclo Iterativo e Incremental</text>
                </svg>
            </div>
            <div class="diagrama-info">
                Ciclo completo SCRUM - Visibilidad mejorada para temas oscuros
            </div>
        </div>
    </section>

    <!-- 4️⃣ BLOQUES INTERACTIVOS REALES -->
    <section class="interactivos-section">
        <style>
            .scrum-topbar { display:flex; flex-wrap:wrap; justify-content:space-between; gap:14px; align-items:flex-start; margin-bottom:18px; }
            .scrum-actions { display:flex; flex-wrap:wrap; gap:10px; }
            .scrum-hint { font-size:13px; color:var(--color-text-secondary); max-width:560px; margin-top:8px; }
            .scrum-board { display:grid; grid-template-columns: repeat(4, minmax(0,1fr)); gap:14px; padding:16px; background:rgba(0,0,0,.15); border:1px solid rgba(255,255,255,.08); border-radius:18px; }
            .scrum-column { min-height:320px; background:rgba(10,22,34,.85); border:1px solid rgba(255,255,255,.08); border-radius:16px; padding:14px; display:flex; flex-direction:column; gap:12px; }
            .scrum-column h4 { margin-bottom:10px; font-size:14px; letter-spacing:.04em; text-transform:uppercase; color:var(--color-text-info); }
            .scrum-item { background:rgba(255,255,255,.06); border:1px solid rgba(255,255,255,.12); border-radius:12px; padding:12px 14px; cursor:grab; transition:transform .15s,box-shadow .15s,background .15s; color:var(--color-text-primary); }
            .scrum-item:active { transform:scale(.98); }
            .scrum-item strong { display:block; margin-bottom:6px; font-size:13px; }
            .scrum-item small { display:block; color:var(--color-text-secondary); font-size:12px; line-height:1.4; }
            .scrum-column.drag-target { box-shadow:0 0 0 2px rgba(0,255,136,.28); }
            .sprint-summary { margin-top:18px; display:grid; gap:16px; grid-template-columns: repeat(3, minmax(0,1fr)); }
            .stat-card { background:rgba(255,255,255,.05); border:1px solid rgba(255,255,255,.08); border-radius:14px; padding:12px 14px; }
            .stat-card .label { display:block; font-size:12px; color:var(--color-text-secondary); margin-bottom:6px; }
            .stat-card .value { font-size:18px; font-weight:700; color:var(--color-text-primary); }
            .capacity-bar { width:100%; background:rgba(255,255,255,.07); border-radius:999px; height:10px; margin-top:12px; overflow:hidden; }
            .capacity-fill { width:0; height:100%; background:linear-gradient(90deg,#39ff14,#00bcd4); transition:width .3s ease, background .3s ease; }
            #sprint-result { min-height:54px; margin-top:18px; padding:14px 16px; border-radius:14px; background:rgba(255,255,255,.03); border:1px solid rgba(255,255,255,.08); color:var(--color-text-primary); font-size:14px; line-height:1.5; }
            #sprint-result.success { border-color:#39ff14; color:#d4ffb8; }
            #sprint-result.warning { border-color:#ffb74d; color:#ffe1a0; }
            #sprint-result.danger { border-color:#ff6b6b; color:#ffb8b8; }
            .consejos-scrum { margin-top:16px; display:grid; gap:10px; }
            .consejo-item { display:flex; gap:10px; align-items:flex-start; }
            .consejo-icon { width:28px; height:28px; border-radius:10px; background:rgba(57,255,20,.12); display:flex; align-items:center; justify-content:center; color:#ccff8c; font-size:14px; }
            @media (max-width: 900px) { .scrum-board { grid-template-columns: 1fr; } .sprint-summary { grid-template-columns: 1fr; } }
        </style>
        <h2 class="seccion-titulo neon-interactivo">
            <span class="icon">🎮</span> SIMULADOR DE SPRINT INTERACTIVO
        </h2>
        <div class="simulator-container" data-tema="scrum">
            <div class="simulator-controls">
                <div class="scrum-topbar">
                    <div>
                        <h3>🎮 CONTROLES SPRINT</h3>
                        <p class="scrum-hint">Arrastra historias desde el backlog al sprint, progreso o hecho. El equipo tiene <strong>30 puntos</strong> de capacidad para este sprint.</p>
                    </div>
                    <div class="scrum-actions">
                        <button class="btn-ejemplo" onclick="autoFillSprint()">Auto-plan Sprint</button>
                        <button class="btn-ejemplo" onclick="resetSprint()">Reiniciar Sprint</button>
                    </div>
                </div>
            </div>
            <div class="simulator-visualization">
                <div class="scrum-board">
                    <div class="scrum-column" id="backlog">
                        <h4>Product Backlog</h4>
                        <div class="scrum-item" draggable="true" data-id="1" data-points="5">
                            <strong>US001:</strong> Login usuario
                            <small>5 pts • Autenticación segura</small>
                        </div>
                        <div class="scrum-item" draggable="true" data-id="2" data-points="8">
                            <strong>US002:</strong> Dashboard principal
                            <small>8 pts • Vista de métricas clave</small>
                        </div>
                        <div class="scrum-item" draggable="true" data-id="3" data-points="5">
                            <strong>US003:</strong> Notificaciones push
                            <small>5 pts • Alertas en tiempo real</small>
                        </div>
                        <div class="scrum-item" draggable="true" data-id="4" data-points="3">
                            <strong>US004:</strong> Perfil editable
                            <small>3 pts • Actualizar datos personales</small>
                        </div>
                        <div class="scrum-item" draggable="true" data-id="5" data-points="3">
                            <strong>US005:</strong> Exportar datos
                            <small>3 pts • Reporte en PDF</small>
                        </div>
                    </div>
                    <div class="scrum-column" id="sprint">
                        <h4>Sprint Backlog</h4>
                    </div>
                    <div class="scrum-column" id="progress">
                        <h4>En Progreso</h4>
                    </div>
                    <div class="scrum-column" id="done">
                        <h4>Hecho (DoD)</h4>
                    </div>
                </div>
                <div class="sprint-summary">
                    <div class="stat-card">
                        <span class="label">Capacidad total</span>
                        <span class="value">30 pts</span>
                    </div>
                    <div class="stat-card">
                        <span class="label">Puntos comprometidos</span>
                        <span class="value" id="committed">0</span>
                        <div class="capacity-bar"><div id="capacityBar" class="capacity-fill"></div></div>
                    </div>
                    <div class="stat-card">
                        <span class="label">Puntos completados</span>
                        <span class="value" id="completed">0</span>
                    </div>
                </div>
                <div id="sprint-result" class="resultado-content">Arrastra historias para comenzar el sprint.</div>
            </div>
            <div class="simulator-data">
                <h3>🔍 ESTADO DEL SPRINT</h3>
                <div class="data-card">
                    <div class="data-label">Capacidad equipo:</div>
                    <div class="data-value">30 puntos</div>
                </div>
                <div class="data-card">
                    <div class="data-label">Puntos comprometidos:</div>
                    <div class="data-value" id="committed-detail">0</div>
                </div>
                <div class="data-card">
                    <div class="data-label">Puntos completados:</div>
                    <div class="data-value" id="completed-detail">0</div>
                </div>
                <div class="consejos-scrum">
                    <h4>💡 CONSEJOS SCRUM</h4>
                    <div class="consejo-item">
                        <span class="consejo-icon">🎯</span>
                        <span class="consejo-text">No excedas capacidad</span>
                    </div>
                    <div class="consejo-item">
                        <span class="consejo-icon">⚡</span>
                        <span class="consejo-text">Definition of Done clara</span>
                    </div>
                    <div class="consejo-item">
                        <span class="consejo-icon">📊</span>
                        <span class="consejo-text">Daily para sincronizar</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 5️⃣ QUIZ AUTOEVALUADO CON FEEDBACK -->
    <section class="quiz-section">
        <h2 class="seccion-titulo neon-evaluacion">
            <span class="icon">❓</span> QUIZ SCRUM MASTER
        </h2>
       
        <div class="quiz-container">
            <!-- PREGUNTA 1 -->
            <div class="quiz-question" data-correct="B">
                <div class="quiz-header">
                    <span class="quiz-num">01</span>
                    <h3>¿Quién prioriza el Product Backlog?</h3>
                </div>
                <div class="quiz-options">
                    <button class="quiz-option" data-value="A">A) Scrum Master</button>
                    <button class="quiz-option" data-value="B">B) Product Owner</button>
                    <button class="quiz-option" data-value="C">C) Development Team</button>
                    <button class="quiz-option" data-value="D">D) Stakeholders</button>
                </div>
                <div class="quiz-feedback" style="display: none;">
                    <div class="feedback-correct">✅ Correcto: PO maximiza valor</div>
                    <div class="feedback-incorrect">❌ Incorrecto</div>
                    <div class="feedback-explicacion">El Product Owner es el único responsable de la priorización.</div>
                </div>
            </div>
           
            <!-- PREGUNTA 2 -->
            <div class="quiz-question" data-correct="C">
                <div class="quiz-header">
                    <span class="quiz-num">02</span>
                    <h3>¿Cuál es la duración máxima del Daily Scrum?</h3>
                </div>
                <div class="quiz-options">
                    <button class="quiz-option" data-value="A">A) 30 min</button>
                    <button class="quiz-option" data-value="B">B) 1 hora</button>
                    <button class="quiz-option" data-value="C">C) 15 min</button>
                    <button class="quiz-option" data-value="D">D) Sin límite</button>
                </div>
                <div class="quiz-feedback" style="display: none;">
                    <div class="feedback-correct">✅ Correcto: Timebox fijo</div>
                    <div class="feedback-incorrect">❌ Incorrecto</div>
                    <div class="feedback-explicacion">15 minutos para sincronización rápida.</div>
                </div>
            </div>
           
            <!-- PREGUNTA 3 -->
            <div class="quiz-question" data-correct="A">
                <div class="quiz-header">
                    <span class="quiz-num">03</span>
                    <h3>¿Qué artefacto es "potentially shippable"?</h3>
                </div>
                <div class="quiz-options">
                    <button class="quiz-option" data-value="A">A) Increment</button>
                    <button class="quiz-option" data-value="B">B) Sprint Backlog</button>
                    <button class="quiz-option" data-value="C">C) Product Backlog</button>
                    <button class="quiz-option" data-value="D">D) Burndown Chart</button>
                </div>
                <div class="quiz-feedback" style="display: none;">
                    <div class="feedback-correct">✅ Correcto: Cumple DoD</div>
                    <div class="feedback-incorrect">❌ Incorrecto</div>
                    <div class="feedback-explicacion">El Increment es el resultado usable del sprint.</div>
                </div>
            </div>
        </div>
       
        <div class="quiz-results" style="display: none;">
            <h3>📊 RESULTADOS DEL QUIZ</h3>
            <div class="results-score">
                Puntuación: <span id="quizScore">0</span>/3
            </div>
            <button class="btn-retry" onclick="reiniciarQuiz()">
                🔄 INTENTAR NUEVAMENTE
            </button>
        </div>
    </section>

    <!-- 6️⃣ SECCIÓN "ERRORES COMUNES" INTERACTIVA -->
    <section class="errores-section">
        <h2 class="seccion-titulo neon-alerta">
            <span class="icon">⚠️</span> ERRORES COMUNES EN SCRUM
        </h2>
        <div class="errores-container">
            <div class="error-card collapsible">
                <div class="error-header">
                    <h3>Error 1: Scrum Master como jefe</h3>
                    <div class="collapse-icon">+</div>
                </div>
                <div class="error-content" style="display: none;">
                    <div class="error-ejemplo">
                        <pre><code>// ❌ Mal
SM asigna tareas al equipo</code></pre>
                    </div>
                    <div class="error-explicacion">
                        <p>El equipo es autoorganizado. SM facilita, no manda.</p>
                    </div>
                </div>
            </div>
            <div class="error-card collapsible">
                <div class="error-header">
                    <h3>Error 2: Sprint sin Definition of Done</h3>
                    <div class="collapse-icon">+</div>
                </div>
                <div class="error-content" style="display: none;">
                    <div class="error-ejemplo">
                        <pre><code>// ❌ Mal
Tareas "hechas" sin testing</code></pre>
                    </div>
                    <div class="error-explicacion">
                        <p>Todo increment debe ser potencialmente entregable.</p>
                    </div>
                </div>
            </div>
            <div class="error-card collapsible">
                <div class="error-header">
                    <h3>Error 3: Planning sin estimación</h3>
                    <div class="collapse-icon">+</div>
                </div>
                <div class="error-content" style="display: none;">
                    <div class="error-ejemplo">
                        <pre><code>// ❌ Mal
Seleccionar historias "a ojo"</code></pre>
                    </div>
                    <div class="error-explicacion">
                        <p>Usa Planning Poker y puntos de historia.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 7️⃣ PROBLEMAS TIPO EXAMEN -->
    <section class="problemas-section">
        <h2 class="seccion-titulo neon-evaluacion">
            <span class="icon">📝</span> RETOS PRÁCTICOS
        </h2>
        <div class="problemas-container">
            <div class="problema-card">
                <h3>Reto 1: Planning Poker</h3>
                <p>Estima estas historias con Fibonacci:</p>
                <ul>
                    <li>Login básico</li>
                    <li>Dashboard con gráficos</li>
                    <li>Exportar PDF</li>
                </ul>
                <textarea class="respuesta-area" placeholder="Justifica tus puntos..."></textarea>
            </div>
            <div class="problema-card">
                <h3>Reto 2: Retrospective</h3>
                <p>Escribe una retro para sprint fallido (50% completado)</p>
                <textarea class="respuesta-area" placeholder="Start/Stop/Continue..."></textarea>
            </div>
        </div>
    </section>

    <!-- 8️⃣ CIERRE METACOGNITIVO INTERACTIVO -->
    <section class="cierre-section">
        <h2 class="seccion-titulo neon-concepto">
            <span class="icon">🧠</span> CIERRE METACOGNITIVO
        </h2>
        <div class="cierre-container">
            <div class="autoevaluacion">
                <h3>📊 AUTOEVALUACIÓN</h3>
                <div class="skill-meter">
                    <div class="skill-item">
                        <span>Roles SCRUM:</span>
                        <div class="skill-bar"><div class="skill-fill" style="width:0%"></div></div>
                        <input type="range" min="0" max="100" value="0" class="skill-slider">
                    </div>
                    <div class="skill-item">
                        <span>Eventos:</span>
                        <div class="skill-bar"><div class="skill-fill" style="width:0%"></div></div>
                        <input type="range" min="0" max="100" value="0" class="skill-slider">
                    </div>
                    <div class="skill-item">
                        <span>Simulación:</span>
                        <div class="skill-bar"><div class="skill-fill" style="width:0%"></div></div>
                        <input type="range" min="0" max="100" value="0" class="skill-slider">
                    </div>
                </div>
                <button class="btn-guardar" onclick="guardarHabilidades()">💾 Guardar</button>
            </div>
            <div class="recursos">
                <h3>🔗 RECURSOS 2025</h3>
                <div class="recursos-links">
                    <a href="https://scrumguides.org" target="_blank" class="recurso-link">Scrum Guide Oficial</a>
                    <a href="https://www.atlassian.com/agile/scrum" target="_blank" class="recurso-link">Atlassian Scrum</a>
                    <a href="https://www.scrum.org" target="_blank" class="recurso-link">Scrum.org</a>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
// JS COMPLETO PARA LA LECCIÓN SCRUM + AGILE
console.log(\'Inicializando lección Programación - Metodologías Ágiles SCRUM 2025\');

const columns = [\'backlog\', \'sprint\', \'progress\', \'done\'];
const SPRINT_CAPACITY = 30;
let originalTaskOrder = [];

// Inicializar drag & drop
function initDragAndDrop() {
    columns.forEach(colId => {
        const col = document.getElementById(colId);
        if (!col) return;

        col.addEventListener(\'dragover\', e => e.preventDefault());
        col.addEventListener(\'dragenter\', e => {
            e.preventDefault();
            col.classList.add(\'drag-target\');
        });
        col.addEventListener(\'dragleave\', () => {
            col.classList.remove(\'drag-target\');
        });
        col.addEventListener(\'drop\', e => {
            e.preventDefault();
            col.classList.remove(\'drag-target\');
            const id = e.dataTransfer.getData(\'text/plain\');
            const item = document.querySelector(`[data-id="${id}"]`);
            if (item && col !== item.parentElement) {
                col.appendChild(item);
                updateSprintStats();
            }
        });
    });

    document.querySelectorAll(\'.scrum-item\').forEach(item => {
        item.addEventListener(\'dragstart\', e => {
            e.dataTransfer.setData(\'text/plain\', item.dataset.id);
        });
        item.addEventListener(\'dragend\', () => {
            columns.forEach(colId => {
                const col = document.getElementById(colId);
                if (col) col.classList.remove(\'drag-target\');
            });
        });
    });
}

function setSprintMessage(message, status = \'info\') {
    const result = document.getElementById(\'sprint-result\');
    result.className = `resultado-content ${status}`;
    result.textContent = message;
}

// Actualizar estadísticas del sprint (puntos)
function updateSprintStats() {
    const sprintItems = document.getElementById(\'sprint\').querySelectorAll(\'.scrum-item\');
    const doneItems = document.getElementById(\'done\').querySelectorAll(\'.scrum-item\');
    let committed = 0;
    let completed = 0;

    sprintItems.forEach(item => {
        const points = parseInt(item.dataset.points || item.textContent.match(/\\((\\d+) pts\\)/)?.[1] || 0, 10);
        committed += points;
    });

    doneItems.forEach(item => {
        const points = parseInt(item.dataset.points || item.textContent.match(/\\((\\d+) pts\\)/)?.[1] || 0, 10);
        completed += points;
    });

    const capacityBar = document.getElementById(\'capacityBar\');
    const fillWidth = Math.min(100, (committed / SPRINT_CAPACITY) * 100);
    capacityBar.style.width = `${fillWidth}%`;
    capacityBar.style.background = committed > SPRINT_CAPACITY
        ? \'linear-gradient(90deg,#ff6b6b,#ff8f8f)\'
        : \'linear-gradient(90deg,#39ff14,#00bcd4)\';

    document.getElementById(\'committed\').textContent = committed;
    document.getElementById(\'committed-detail\').textContent = committed;
    document.getElementById(\'completed\').textContent = completed;
    document.getElementById(\'completed-detail\').textContent = completed;

    const totalItems = document.querySelectorAll(\'.scrum-item\').length;
    const doneCount = doneItems.length;

    if (committed > SPRINT_CAPACITY) {
        setSprintMessage(\'Capacidad excedida: devuelve tareas al backlog o reduce el sprint.\', \'danger\');
    } else if (doneCount === totalItems && totalItems > 0) {
        setSprintMessage(\'¡Sprint completado! Increment listo para revisión.\', \'success\');
    } else {
        setSprintMessage(`${doneCount}/${totalItems} tareas finalizadas • ${committed} pts comprometidos`, \'info\');
    }
}

// Reiniciar sprint
function resetSprint() {
    const backlog = document.getElementById(\'backlog\');
    originalTaskOrder.forEach(id => {
        const item = document.querySelector(`[data-id="${id}"]`);
        if (item) backlog.appendChild(item);
    });
    updateSprintStats();
    setSprintMessage(\'Sprint reiniciado. Arrastra historias para empezar.\', \'info\');
}

// Auto-plan ejemplo válido
function autoFillSprint() {
    resetSprint();
    const sprint = document.getElementById(\'sprint\');
    const selectedIds = [\'2\', \'1\', \'3\', \'4\', \'5\'];
    selectedIds.forEach(id => {
        const item = document.querySelector(`[data-id="${id}"]`);
        if (item) sprint.appendChild(item);
    });
    updateSprintStats();
    setSprintMessage(\'Sprint planificado con historias equilibradas según capacidad.\', \'success\');
}

// Objetivos interactivos (checkbox)
document.querySelectorAll(\'.objetivo-card\').forEach(card => {
    card.addEventListener(\'click\', () => {
        const completado = card.dataset.completado === \'true\';
        card.dataset.completado = !completado;
        card.querySelector(\'.objetivo-checkbox\').style.background = !completado ? \'var(--neon-concepto)\' : \'transparent\';
        console.log(\'Objetivo toggled:\', card.querySelector(\'h3\').textContent);
    });
});

// Quiz autoevaluado
let quizCompletadas = 0;
document.querySelectorAll(\'.quiz-option\').forEach(option => {
    option.addEventListener(\'click\', () => {
        const question = option.closest(\'.quiz-question\');
        if (question.dataset.answered) return;
        question.dataset.answered = \'true\';

        const value = option.dataset.value;
        const correct = question.dataset.correct;
        const feedback = question.querySelector(\'.quiz-feedback\');
        feedback.style.display = \'block\';

        if (value === correct) {
            option.classList.add(\'correct\');
            feedback.querySelector(\'.feedback-correct\').style.display = \'block\';
        } else {
            option.classList.add(\'incorrect\');
            feedback.querySelector(\'.feedback-incorrect\').style.display = \'block\';
        }

        quizCompletadas++;
        if (quizCompletadas === document.querySelectorAll(\'.quiz-question\').length) {
            mostrarResultadosQuiz();
        }
    });
});

function mostrarResultadosQuiz() {
    const correctas = document.querySelectorAll(\'.quiz-option.correct\').length;
    const total = document.querySelectorAll(\'.quiz-question\').length;
    document.getElementById(\'quizScore\').textContent = `${correctas}/${total}`;
    document.getElementById(\'quizFeedback\').textContent = correctas === total ? \'¡Excelente dominio de SCRUM!\' :
        correctas >= total * 0.66 ? \'Muy bien, conceptos sólidos\' : \'Repasa los pilares y roles\';
    document.querySelector(\'.quiz-results\').style.display = \'block\';
}

function reiniciarQuiz() {
    document.querySelectorAll(\'.quiz-question\').forEach(q => {
        q.dataset.answered = \'\';
        q.querySelector(\'.quiz-feedback\').style.display = \'none\';
        q.querySelectorAll(\'.quiz-option\').forEach(o => o.classList.remove(\'correct\', \'incorrect\'));
    });
    quizCompletadas = 0;
    document.querySelector(\'.quiz-results\').style.display = \'none\';
}

// Errores comunes (colapsables)
document.querySelectorAll(\'.collapsible .error-header\').forEach(header => {
    header.addEventListener(\'click\', () => {
        const content = header.nextElementSibling;
        const icon = header.querySelector(\'.collapse-icon\');
        content.style.display = content.style.display === \'none\' ? \'block\' : \'none\';
        icon.textContent = content.style.display === \'block\' ? \'-\' : \'+\';
    });
});

// Verificación errores prácticos (simple)
function verificarError(num, btn) {
    const input = btn.previousElementSibling.value.toLowerCase();
    const feedback = btn.nextElementSibling;
    let correct = false;

    if (num === 1) correct = input.includes(\'auto\') || input.includes(\'self\');
    if (num === 2) correct = input.includes(\'done\') || input.includes(\'dod\');
    if (num === 3) correct = input.includes(\'poker\') || input.includes(\'estim\');

    feedback.textContent = correct ? \'✅ ¡Correcto!\' : \'❌ Intenta de nuevo\';
    feedback.style.color = correct ? \'var(--neon-concepto)\' : \'var(--neon-alerta)\';
}

// Autoevaluación habilidades
document.querySelectorAll(\'.skill-slider\').forEach(slider => {
    slider.addEventListener(\'input\', () => {
        const fill = slider.previousElementSibling.querySelector(\'.skill-fill\');
        fill.style.width = slider.value + \'%\';
        fill.dataset.level = slider.value;
    });
});

function guardarHabilidades() {
    const skills = {};
    document.querySelectorAll(\'.skill-slider\').forEach(sl => {
        skills[sl.dataset.skill] = sl.value;
    });
    localStorage.setItem(\'scrumSkills2025\', JSON.stringify(skills));
    alert(\'Habilidades SCRUM guardadas\');
}

// Proyecto final (mostrar solución)
function mostrarEsqueletoProyecto() {
    document.getElementById(\'proyectoSolucion\').style.display = \'block\';
}

// Inicialización al cargar
document.addEventListener(\'DOMContentLoaded\', () => {
    originalTaskOrder = Array.from(document.querySelectorAll(\'.scrum-item\')).map(item => item.dataset.id);
    initDragAndDrop();
    updateSprintStats();
    console.log(\'Lección SCRUM cargada y lista\');
});
</script>',
    'ejercicios' => 
    array (
      0 => 
      array (
        'enunciado' => 'Rol del Product Owner',
        'respuesta' => 'Maximizar valor del producto',
      ),
      1 => 
      array (
        'enunciado' => 'Scrum Master elimina',
        'respuesta' => 'Impedimentos',
      ),
      2 => 
      array (
        'enunciado' => 'Duración típica sprint',
        'respuesta' => '2 semanas',
      ),
      3 => 
      array (
        'enunciado' => 'Daily Scrum responde',
        'respuesta' => '¿Qué hice? ¿Qué haré? ¿Bloqueos?',
      ),
      4 => 
      array (
        'enunciado' => 'Sprint Review muestra',
        'respuesta' => 'Incremento',
      ),
      5 => 
      array (
        'enunciado' => 'Retrospective busca',
        'respuesta' => 'Mejorar proceso',
      ),
      6 => 
      array (
        'enunciado' => 'Product Backlog es',
        'respuesta' => 'Lista priorizada',
      ),
      7 => 
      array (
        'enunciado' => 'Definition of Done',
        'respuesta' => 'Criterios de aceptación',
      ),
      8 => 
      array (
        'enunciado' => 'Velocity mide',
        'respuesta' => 'Puntos completados/sprint',
      ),
      9 => 
      array (
        'enunciado' => 'Burndown chart muestra',
        'respuesta' => 'Trabajo restante',
      ),
      10 => 
      array (
        'enunciado' => 'SI: % empresas con SCRUM',
        'respuesta' => '78%',
      ),
      11 => 
      array (
        'enunciado' => 'Herramienta popular',
        'respuesta' => 'Jira, Trello',
      ),
    ),
    'quiz' => 
    array (
      0 => 
      array (
        'pregunta' => 'SCRUM es un',
        'opciones' => 
        array (
          0 => 'Framework',
          1 => 'Metodología',
          2 => 'Herramienta',
          3 => 'Lenguaje',
        ),
        'correcta' => 'Framework',
      ),
      1 => 
      array (
        'pregunta' => 'Pilares SCRUM',
        'opciones' => 
        array (
          0 => '3',
          1 => '5',
          2 => '1',
          3 => '7',
        ),
        'correcta' => '3',
      ),
      2 => 
      array (
        'pregunta' => 'Product Owner define',
        'opciones' => 
        array (
          0 => 'Prioridades',
          1 => 'Código',
          2 => 'Diseño',
          3 => 'Pruebas',
        ),
        'correcta' => 'Prioridades',
      ),
      3 => 
      array (
        'pregunta' => 'Scrum Master es',
        'opciones' => 
        array (
          0 => 'Facilitador',
          1 => 'Jefe',
          2 => 'Tester',
          3 => 'Diseñador',
        ),
        'correcta' => 'Facilitador',
      ),
      4 => 
      array (
        'pregunta' => 'Equipo dev es',
        'opciones' => 
        array (
          0 => 'Autoorganizado',
          1 => 'Jerárquico',
          2 => 'Externo',
          3 => 'Temporal',
        ),
        'correcta' => 'Autoorganizado',
      ),
      5 => 
      array (
        'pregunta' => 'Sprint dura',
        'opciones' => 
        array (
          0 => '1-4 semanas',
          1 => '1 día',
          2 => '1 mes',
          3 => 'Ilimitado',
        ),
        'correcta' => '1-4 semanas',
      ),
      6 => 
      array (
        'pregunta' => 'Planning máximo',
        'opciones' => 
        array (
          0 => '8h',
          1 => '4h',
          2 => '15 min',
          3 => '1 día',
        ),
        'correcta' => '8h',
      ),
      7 => 
      array (
        'pregunta' => 'Daily dura',
        'opciones' => 
        array (
          0 => '15 min',
          1 => '1h',
          2 => '30 min',
          3 => '2h',
        ),
        'correcta' => '15 min',
      ),
      8 => 
      array (
        'pregunta' => 'Review máximo',
        'opciones' => 
        array (
          0 => '4h',
          1 => '8h',
          2 => '2h',
          3 => '1 día',
        ),
        'correcta' => '4h',
      ),
      9 => 
      array (
        'pregunta' => 'Retro máximo',
        'opciones' => 
        array (
          0 => '3h',
          1 => '4h',
          2 => '8h',
          3 => '1 día',
        ),
        'correcta' => '3h',
      ),
      10 => 
      array (
        'pregunta' => 'Increment debe ser',
        'opciones' => 
        array (
          0 => 'Potentially shippable',
          1 => 'En pruebas',
          2 => 'Parcial',
          3 => 'Diseño',
        ),
        'correcta' => 'Potentially shippable',
      ),
      11 => 
      array (
        'pregunta' => 'Backlog es',
        'opciones' => 
        array (
          0 => 'Dinámico',
          1 => 'Estático',
          2 => 'Secreto',
          3 => 'Temporal',
        ),
        'correcta' => 'Dinámico',
      ),
      12 => 
      array (
        'pregunta' => 'User Story formato',
        'opciones' => 
        array (
          0 => 'Como X, quiero Y, para Z',
          1 => 'Tarea técnica',
          2 => 'Bug',
          3 => 'Código',
        ),
        'correcta' => 'Como X, quiero Y, para Z',
      ),
      13 => 
      array (
        'pregunta' => 'Puntos de historia',
        'opciones' => 
        array (
          0 => 'Fibonacci',
          1 => 'Decimal',
          2 => 'Binario',
          3 => 'Letras',
        ),
        'correcta' => 'Fibonacci',
      ),
      14 => 
      array (
        'pregunta' => 'Velocity es',
        'opciones' => 
        array (
          0 => 'Promedio puntos/sprint',
          1 => 'Tiempo',
          2 => 'Errores',
          3 => 'Código',
        ),
        'correcta' => 'Promedio puntos/sprint',
      ),
      15 => 
      array (
        'pregunta' => 'Burndown ideal',
        'opciones' => 
        array (
          0 => 'Lineal descendente',
          1 => 'Ascendente',
          2 => 'Plano',
          3 => 'Caótico',
        ),
        'correcta' => 'Lineal descendente',
      ),
      16 => 
      array (
        'pregunta' => 'Definition of Done',
        'opciones' => 
        array (
          0 => 'Criterios compartidos',
          1 => 'Individual',
          2 => 'Secreto',
          3 => 'Opcional',
        ),
        'correcta' => 'Criterios compartidos',
      ),
      17 => 
      array (
        'pregunta' => 'Refinement es',
        'opciones' => 
        array (
          0 => 'Aclarar backlog',
          1 => 'Codificar',
          2 => 'Testear',
          3 => 'Deploy',
        ),
        'correcta' => 'Aclarar backlog',
      ),
      18 => 
      array (
        'pregunta' => 'Scrum of Scrums para',
        'opciones' => 
        array (
          0 => 'Equipos múltiples',
          1 => 'Un equipo',
          2 => 'PO',
          3 => 'Stakeholders',
        ),
        'correcta' => 'Equipos múltiples',
      ),
      19 => 
      array (
        'pregunta' => 'SAFe incluye',
        'opciones' => 
        array (
          0 => 'SCRUM a escala',
          1 => 'Solo un equipo',
          2 => 'Nada',
          3 => 'Waterfall',
        ),
        'correcta' => 'SCRUM a escala',
      ),
      20 => 
      array (
        'pregunta' => 'Jira es',
        'opciones' => 
        array (
          0 => 'Herramienta SCRUM',
          1 => 'Lenguaje',
          2 => 'BD',
          3 => 'IDE',
        ),
        'correcta' => 'Herramienta SCRUM',
      ),
      21 => 
      array (
        'pregunta' => 'Trello usa',
        'opciones' => 
        array (
          0 => 'Tableros Kanban',
          1 => 'Gantt',
          2 => 'Código',
          3 => 'SQL',
        ),
        'correcta' => 'Tableros Kanban',
      ),
      22 => 
      array (
        'pregunta' => 'SI 2025: SCRUM crece',
        'opciones' => 
        array (
          0 => '+15% anual',
          1 => '0%',
          2 => '-10%',
          3 => 'Obsoleto',
        ),
        'correcta' => '+15% anual',
      ),
      23 => 
      array (
        'pregunta' => 'Empresas con SCRUM',
        'opciones' => 
        array (
          0 => 'Netflix, Spotify',
          1 => 'Solo startups',
          2 => 'Gobierno',
          3 => 'Ninguna',
        ),
        'correcta' => 'Netflix, Spotify',
      ),
      24 => 
      array (
        'pregunta' => 'Híbrido SCRUM + Kanban',
        'opciones' => 
        array (
          0 => 'Scrumban',
          1 => 'Waterfall',
          2 => 'XP',
          3 => 'Lean',
        ),
        'correcta' => 'Scrumban',
      ),
      25 => 
      array (
        'pregunta' => 'Certificación popular',
        'opciones' => 
        array (
          0 => 'PSM I',
          1 => 'PMP',
          2 => 'ITIL',
          3 => 'COBIT',
        ),
        'correcta' => 'PSM I',
      ),
      26 => 
      array (
        'pregunta' => 'Scrum Guide 2020',
        'opciones' => 
        array (
          0 => 'Oficial',
          1 => 'Antiguo',
          2 => 'Falso',
          3 => 'Opcional',
        ),
        'correcta' => 'Oficial',
      ),
      27 => 
      array (
        'pregunta' => 'SI 2025: % remotos con SCRUM',
        'opciones' => 
        array (
          0 => '+90%',
          1 => '50%',
          2 => '20%',
          3 => '0%',
        ),
        'correcta' => '+90%',
      ),
      28 => 
      array (
        'pregunta' => 'SCRUM ideal para',
        'opciones' => 
        array (
          0 => 'Requisitos cambiantes',
          1 => 'Fijos',
          2 => 'Hardware',
          3 => 'Infra',
        ),
        'correcta' => 'Requisitos cambiantes',
      ),
      29 => 
      array (
        'pregunta' => 'Agile Manifesto prioriza',
        'opciones' => 
        array (
          0 => 'Individuos > Procesos',
          1 => 'Procesos > Personas',
          2 => 'Documentos',
          3 => 'Contrato',
        ),
        'correcta' => 'Individuos > Procesos',
      ),
    ),
  ),
  4 => 
  array (
    'materia' => 'Programación',
    'slug' => 'desarrollo-aplicaciones-web',
    'titulo' => 'Aplicaciones Web Full-Stack: Frontend, Backend, BD, Simulador y Retos 2025',
    'contenido' => '<!-- INICIO LECCIÓN CYBERPUNK PROGRAMACIÓN -->
<div class="leccion-container leccion-programacion-desarrollo-aplicaciones-web" data-tema="desarrollo-aplicaciones-web">
    
    <!-- 1️⃣ INTRODUCCIÓN CONCEPTUAL CYBERPUNK -->
    <header class="leccion-header">
        <h1 class="titulo-leccion neon-glow">
            <span class="icon-tema">🌐</span>
            FULL-STACK WEB
        </h1>
        <div class="subtitulo">
            Desarrollo Completo: Frontend + Backend + Base de Datos 2025
        </div>
    </header>
    <section class="panel-objetivos">
        <h2 class="seccion-titulo neon-concepto">
            <span class="icon">🎯</span> OBJETIVOS DE APRENDIZAJE
        </h2>
        <div class="objetivos-grid">
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Comprender arquitectura full-stack</h3>
                <p>Cliente, servidor, base de datos y DevOps</p>
            </div>
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Dominar capas del stack</h3>
                <p>Frontend (UI/UX), Backend (APIs), BD (persistencia)</p>
            </div>
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Implementar CRUD completo</h3>
                <p>Crear, leer, actualizar y eliminar datos</p>
            </div>
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Conocer stacks modernos 2025</h3>
                <p>MERN, LAMP, JAMstack, .NET</p>
            </div>
        </div>
    </section>
    <section class="contexto-real">
        <h2 class="seccion-titulo neon-dato">
            <span class="icon">🌍</span> APLICACIÓN EN EL MUNDO REAL
        </h2>
        <div class="contexto-grid">
            <div class="contexto-card">
                <h3>🛒 E-commerce</h3>
                <p>Amazon, Shopify</p>
                <div class="dato-neon">MERN + Microservicios</div>
            </div>
            <div class="contexto-card">
                <h3>📱 Apps Sociales</h3>
                <p>TikTok, Instagram</p>
                <div class="dato-neon">React + Node + Mongo</div>
            </div>
            <div class="contexto-card">
                <h3>🏦 Fintech</h3>
                <p>Revolut, Nubank</p>
                <div class="dato-neon">.NET + SQL + Docker</div>
            </div>
        </div>
        <div class="relacion-curricular">
            <h3>RELACIÓN CURRICULAR</h3>
            <div class="badges">
                <span class="badge">Competencia: Desarrollo Web</span>
                <span class="badge">Contenido: Full-Stack</span>
                <span class="badge">Evaluación: Proyecto App</span>
            </div>
        </div>
    </section>

    <!-- 2️⃣ DESARROLLO TEÓRICO ESTRUCTURADO -->
    <section class="teoria-section">
        <div class="borde-neon-lateral"></div>
        <h2 class="seccion-titulo neon-concepto">
            <span class="icon">📚</span> ARQUITECTURA FULL-STACK 2025
        </h2>
       
        <!-- CAPAS -->
        <div class="subseccion">
            <h3>1. Las 4 Capas del Full-Stack</h3>
            <div class="comparativa-grid">
                <div class="comp-card frontend">
                    <div class="comp-header">
                        <h4>🎨 Frontend</h4>
                        <div class="comp-badge">Cliente</div>
                    </div>
                    <div class="comp-caracteristicas">
                        <p><strong>Tecnologías 2025:</strong></p>
                        <ul>
                            <li>React, Vue, Svelte</li>
                            <li>Tailwind, CSS-in-JS</li>
                            <li>TypeScript</li>
                            <li>PWA, SSR</li>
                        </ul>
                    </div>
                </div>
               
                <div class="comp-card backend">
                    <div class="comp-header">
                        <h4>⚙️ Backend</h4>
                        <div class="comp-badge">Servidor</div>
                    </div>
                    <div class="comp-caracteristicas">
                        <p><strong>Tecnologías 2025:</strong></p>
                        <ul>
                            <li>Node.js, PHP, Python</li>
                            <li>Express, Laravel, FastAPI</li>
                            <li>REST + GraphQL</li>
                            <li>Auth JWT/OAuth</li>
                        </ul>
                    </div>
                </div>
               
                <div class="comp-card db">
                    <div class="comp-header">
                        <h4>🗄️ Base de Datos</h4>
                        <div class="comp-badge">Persistencia</div>
                    </div>
                    <div class="comp-caracteristicas">
                        <p><strong>Opciones 2025:</strong></p>
                        <ul>
                            <li>PostgreSQL, MySQL</li>
                            <li>MongoDB, Firebase</li>
                            <li>SQLite (local)</li>
                            <li>Redis (cache)</li>
                        </ul>
                    </div>
                </div>
               
                <div class="comp-card devops">
                    <div class="comp-header">
                        <h4>🚀 DevOps</h4>
                        <div class="comp-badge">Deploy</div>
                    </div>
                    <div class="comp-caracteristicas">
                        <p><strong>Herramientas 2025:</strong></p>
                        <ul>
                            <li>GitHub Actions</li>
                            <li>Docker, Kubernetes</li>
                            <li>Vercel, Render, AWS</li>
                            <li>CI/CD automático</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- STACKS POPULARES -->
        <div class="subseccion">
            <h3>2. Stacks Populares 2025</h3>
            <div class="tabla-interactiva">
                <table class="tabla-cyberpunk">
                    <thead>
                        <tr>
                            <th>STACK</th>
                            <th>COMPONENTES</th>
                            <th>USO PRINCIPAL</th>
                            <th>MERCADO 2025</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr data-tipo="mern">
                            <td><strong class="neon-concepto">MERN</strong></td>
                            <td>MongoDB, Express, React, Node.js</td>
                            <td>Apps SPA modernas</td>
                            <td>35%</td>
                        </tr>
                        <tr data-tipo="lamp">
                            <td><strong class="neon-concepto">LAMP</strong></td>
                            <td>Linux, Apache, MySQL, PHP</td>
                            <td>CMS, e-commerce</td>
                            <td>25%</td>
                        </tr>
                        <tr data-tipo="jam">
                            <td><strong class="neon-concepto">JAMstack</strong></td>
                            <td>JS, APIs, Markup</td>
                            <td>Sitios estáticos rápidos</td>
                            <td>20%</td>
                        </tr>
                        <tr data-tipo="net">
                            <td><strong class="neon-concepto">.NET</strong></td>
                            <td>C#, ASP.NET, SQL Server</td>
                            <td>Enterprise</td>
                            <td>15%</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- 3️⃣ VISUALIZACIÓN DIDÁCTICA INTERACTIVA -->
    <section class="visualizacion-section">
        <h2 class="seccion-titulo neon-interactivo">
            <span class="icon">📊</span> VISUALIZACIÓN DIDÁCTICA INTERACTIVA
        </h2>
        <div class="diagrama-container">
            <div class="diagrama-visual">
                <svg viewBox="0 0 1000 600" class="er-diagram-interactive">
                    <defs>
                        <marker id="arrow" markerWidth="10" markerHeight="10" refX="9" refY="3" orient="auto">
                            <path d="M0,0 L0,6 L9,3 z" fill="#39FF14"/>
                        </marker>
                    </defs>
                    <rect width="1000" height="600" fill="none"/>
                    
                    <!-- Cliente -->
                    <rect x="100" y="200" width="200" height="150" rx="15" fill="rgba(255,0,255,0.4)" stroke="#ff00ff" stroke-width="3"/>
                    <text x="200" y="260" fill="white" text-anchor="middle" font-size="20" style="text-shadow: 0 0 8px #ff00ff">Frontend</text>
                    <text x="200" y="290" fill="#e0f0ff" text-anchor="middle" font-size="14">React / Vue</text>
                    
                    <!-- Backend -->
                    <rect x="400" y="150" width="200" height="200" rx="15" fill="rgba(255,255,0,0.4)" stroke="#ffff00" stroke-width="3"/>
                    <text x="500" y="230" fill="black" text-anchor="middle" font-size="20" style="text-shadow: 0 0 8px #ffff00">Backend</text>
                    <text x="500" y="260" fill="#e0f0ff" text-anchor="middle" font-size="14">Node / PHP / Python</text>
                    <text x="500" y="290" fill="#e0f0ff" text-anchor="middle" font-size="12">API REST</text>
                    
                    <!-- BD -->
                    <rect x="700" y="200" width="200" height="150" rx="15" fill="rgba(0,255,157,0.4)" stroke="#00ff9d" stroke-width="3"/>
                    <text x="800" y="260" fill="black" text-anchor="middle" font-size="20" style="text-shadow: 0 0 8px #00ff9d">Base de Datos</text>
                    <text x="800" y="290" fill="#e0f0ff" text-anchor="middle" font-size="14">Mongo / PostgreSQL</text>
                    
                    <!-- Flechas -->
                    <line x1="300" y1="275" x2="400" y2="250" stroke="#ffff00" stroke-width="6" marker-end="url(#arrow)"/>
                    <text x="350" y="240" fill="#ffff00" text-anchor="middle" font-size="14">HTTP Request</text>
                    
                    <line x1="600" y1="275" x2="700" y2="275" stroke="#ffff00" stroke-width="6" marker-end="url(#arrow)"/>
                    <text x="650" y="240" fill="#ffff00" text-anchor="middle" font-size="14">SQL / NoSQL Query</text>
                    
                    <line x1="700" y1="325" x2="600" y2="350" stroke="#00ff9d" stroke-width="4" marker-end="url(#arrow)"/>
                    <line x1="400" y1="325" x2="300" y2="300" stroke="#ff00ff" stroke-width="4" marker-end="url(#arrow)"/>
                    
                    <text x="500" y="520" fill="#39ff14" text-anchor="middle" font-size="22" style="text-shadow: 0 0 10px #39ff14">Full-Stack 2025: 65% desarrolladores</text>
                </svg>
            </div>
            <div class="diagrama-info">
                Flujo completo de una aplicación web moderna
            </div>
        </div>
    </section>

    <!-- 4️⃣ BLOQUES INTERACTIVOS REALES -->
    <section class="interactivos-section">
        <h2 class="seccion-titulo neon-interactivo">
            <span class="icon">🎮</span> SIMULADOR FULL-STACK INTERACTIVO
        </h2>
        <div class="simulator-container" data-tema="fullstack">
            <div class="simulator-controls">
                <h3>🎮 GESTIÓN DE PRODUCTOS</h3>
                <div class="controles-form">
                    <input type="text" id="producto-nombre" placeholder="Nombre del producto" class="control-input">
                    <input type="number" id="producto-precio" placeholder="Precio (€)" min="0" step="0.01" class="control-input">
                    <button class="btn-ejecutar" onclick="agregarProducto()">➕ Agregar</button>
                    <button class="btn-limpiar" onclick="limpiarProductos()">🗑 Limpiar todo</button>
                </div>
            </div>
           
            <div class="simulator-visualization">
                <div class="productos-lista" id="productos-lista">
                    <p class="placeholder">No hay productos. Agrega uno arriba ↑</p>
                </div>
                <div id="web-output" class="resultado-content"></div>
            </div>
           
            <div class="simulator-data">
                <h3>🔍 ESTADO DE LA APP</h3>
                <div class="data-card">
                    <div class="data-label">Productos registrados:</div>
                    <div class="data-value" id="totalProductos">0</div>
                </div>
                <div class="data-card">
                    <div class="data-label">Valor total inventario:</div>
                    <div class="data-value" id="valorTotal">0 €</div>
                </div>
                <div class="consejos-fullstack">
                    <h4>💡 CONSEJOS FULL-STACK</h4>
                    <div class="consejo-item">
                        <span class="consejo-icon">🎯</span>
                        <span class="consejo-text">Valida datos en frontend y backend</span>
                    </div>
                    <div class="consejo-item">
                        <span class="consejo-icon">⚡</span>
                        <span class="consejo-text">Usa RESTful APIs</span>
                    </div>
                    <div class="consejo-item">
                        <span class="consejo-icon">📊</span>
                        <span class="consejo-text">Normaliza la BD</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 5️⃣ QUIZ AUTOEVALUADO CON FEEDBACK -->
    <section class="quiz-section">
        <h2 class="seccion-titulo neon-evaluacion">
            <span class="icon">❓</span> QUIZ FULL-STACK
        </h2>
       
        <div class="quiz-container">
            <div class="quiz-question" data-correct="B">
                <div class="quiz-header">
                    <span class="quiz-num">01</span>
                    <h3>¿Qué capa maneja la lógica del negocio?</h3>
                </div>
                <div class="quiz-options">
                    <button class="quiz-option" data-value="A">A) Frontend</button>
                    <button class="quiz-option" data-value="B">B) Backend</button>
                    <button class="quiz-option" data-value="C">C) Base de Datos</button>
                    <button class="quiz-option" data-value="D">D) DevOps</button>
                </div>
                <div class="quiz-feedback" style="display: none;">
                    <div class="feedback-correct">✅ Correcto: APIs y reglas</div>
                    <div class="feedback-incorrect">❌ Incorrecto</div>
                    <div class="feedback-explicacion">El backend procesa lógica, autenticación y validaciones.</div>
                </div>
            </div>
           
            <div class="quiz-question" data-correct="C">
                <div class="quiz-header">
                    <span class="quiz-num">02</span>
                    <h3>¿Qué stack usa React + Node + Mongo?</h3>
                </div>
                <div class="quiz-options">
                    <button class="quiz-option" data-value="A">A) LAMP</button>
                    <button class="quiz-option" data-value="B">B) JAMstack</button>
                    <button class="quiz-option" data-value="C">C) MERN</button>
                    <button class="quiz-option" data-value="D">D) .NET</button>
                </div>
                <div class="quiz-feedback" style="display: none;">
                    <div class="feedback-correct">✅ Correcto: MERN stack</div>
                    <div class="feedback-incorrect">❌ Incorrecto</div>
                    <div class="feedback-explicacion">MongoDB, Express, React, Node.js</div>
                </div>
            </div>
           
            <div class="quiz-question" data-correct="A">
                <div class="quiz-header">
                    <span class="quiz-num">03</span>
                    <h3>¿Dónde se valida entrada de usuario?</h3>
                </div>
                <div class="quiz-options">
                    <button class="quiz-option" data-value="A">A) Frontend y Backend</button>
                    <button class="quiz-option" data-value="B">B) Solo Frontend</button>
                    <button class="quiz-option" data-value="C">C) Solo Backend</button>
                    <button class="quiz-option" data-value="D">D) Base de Datos</button>
                </div>
                <div class="quiz-feedback" style="display: none;">
                    <div class="feedback-correct">✅ Correcto: Doble validación</div>
                    <div class="feedback-incorrect">❌ Incorrecto</div>
                    <div class="feedback-explicacion">UX en frontend, seguridad en backend.</div>
                </div>
            </div>
        </div>
       
        <div class="quiz-results" style="display: none;">
            <h3>📊 RESULTADOS DEL QUIZ</h3>
            <div class="results-score">
                Puntuación: <span id="quizScore">0</span>/3
            </div>
            <button class="btn-retry" onclick="reiniciarQuiz()">
                🔄 INTENTAR NUEVAMENTE
            </button>
        </div>
    </section>

    <!-- CIERRE Y RECURSOS -->
    <section class="cierre-section">
        <h2 class="seccion-titulo neon-concepto">
            <span class="icon">🧠</span> CIERRE METACOGNITIVO
        </h2>
        <div class="cierre-container">
            <div class="autoevaluacion">
                <h3>📊 AUTOEVALUACIÓN</h3>
                <div class="skill-meter">
                    <div class="skill-item">
                        <span>Frontend:</span>
                        <div class="skill-bar"><div class="skill-fill" style="width:0%"></div></div>
                        <input type="range" min="0" max="100" value="0" class="skill-slider">
                    </div>
                    <div class="skill-item">
                        <span>Backend:</span>
                        <div class="skill-bar"><div class="skill-fill" style="width:0%"></div></div>
                        <input type="range" min="0" max="100" value="0" class="skill-slider">
                    </div>
                    <div class="skill-item">
                        <span>Base de Datos:</span>
                        <div class="skill-bar"><div class="skill-fill" style="width:0%"></div></div>
                        <input type="range" min="0" max="100" value="0" class="skill-slider">
                    </div>
                    <div class="skill-item">
                        <span>DevOps:</span>
                        <div class="skill-bar"><div class="skill-fill" style="width:0%"></div></div>
                        <input type="range" min="0" max="100" value="0" class="skill-slider">
                    </div>
                </div>
                <button class="btn-guardar" onclick="guardarHabilidades()">💾 Guardar</button>
            </div>
            <div class="recursos">
                <h3>🔗 RECURSOS 2025</h3>
                <div class="recursos-links">
                    <a href="https://fullstackopen.com" target="_blank" class="recurso-link">Full Stack Open</a>
                    <a href="https://roadmap.sh/full-stack" target="_blank" class="recurso-link">Roadmap Full-Stack</a>
                    <a href="https://vercel.com" target="_blank" class="recurso-link">Vercel Deploy</a>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
// JS COMPLETO PARA LA LECCIÓN FULL-STACK WEB 2025
console.log(\'Inicializando lección Programación - Desarrollo de Aplicaciones Web Full-Stack 2025\');

let productos = [];
let idCounter = 1;

// Agregar producto con validación
function agregarProducto() {
    const nombre = document.getElementById("producto-nombre").value.trim();
    const precioInput = document.getElementById("producto-precio").value;
    const precio = parseFloat(precioInput);
    const output = document.getElementById("web-output");

    if (!nombre || precioInput === "" || isNaN(precio) || precio < 0) {
        output.innerHTML = "<span style=\'color:#ff6b6b;\'>⚠️ Nombre y precio válido requeridos</span>";
        return;
    }

    const producto = { id: idCounter++, nombre, precio };
    productos.push(producto);
    actualizarLista();
    output.innerHTML = `<span style=\'color:#39ff14;\'>Producto agregado: <strong>${nombre}</strong> (€${precio.toFixed(2)})</span>`;

    // Limpiar inputs
    document.getElementById("producto-nombre").value = "";
    document.getElementById("producto-precio").value = "";
}

// Actualizar lista y estadísticas
function actualizarLista() {
    const lista = document.getElementById("productos-lista");
    const totalProductos = document.getElementById("totalProductos");
    const valorTotal = document.getElementById("valorTotal");

    totalProductos.textContent = productos.length;
    const totalValor = productos.reduce((sum, p) => sum + p.precio, 0);
    valorTotal.textContent = totalValor.toFixed(2) + " €";

    if (productos.length === 0) {
        lista.innerHTML = "<p class=\'placeholder\'>No hay productos. Agrega uno arriba ↑</p>";
        return;
    }

    let html = `<table class="tabla-cyberpunk">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>`;
    productos.forEach(p => {
        html += `<tr>
            <td>${p.id}</td>
            <td>${p.nombre}</td>
            <td>€${p.precio.toFixed(2)}</td>
            <td><button class="btn-eliminar" onclick="eliminarProducto(${p.id})">🗑 Eliminar</button></td>
        </tr>`;
    });
    html += `</tbody></table>`;
    lista.innerHTML = html;
}

// Eliminar producto
function eliminarProducto(id) {
    productos = productos.filter(p => p.id !== id);
    actualizarLista();
    document.getElementById("web-output").innerHTML = `<span style=\'color:#ffff00;\'>Producto eliminado (ID ${id})</span>`;
}

// Limpiar todo el inventario
function limpiarProductos() {
    productos = [];
    idCounter = 1;
    actualizarLista();
    document.getElementById("web-output").innerHTML = "<span style=\'color:#00ff9d;\'>Inventario limpiado completamente</span>";
}

// Objetivos interactivos (checkbox)
document.querySelectorAll(\'.objetivo-card\').forEach(card => {
    card.addEventListener(\'click\', () => {
        const completado = card.dataset.completado === \'true\';
        card.dataset.completado = !completado;
        const checkbox = card.querySelector(\'.objetivo-checkbox\');
        checkbox.style.background = !completado ? \'var(--neon-concepto)\' : \'transparent\';
        checkbox.style.borderColor = !completado ? \'var(--neon-concepto)\' : \'#39ff14\';
        console.log(\'Objetivo toggled:\', card.querySelector(\'h3\').textContent);
    });
});

// Quiz autoevaluado
let quizCompletadas = 0;
const totalPreguntas = document.querySelectorAll(\'.quiz-question\').length;

document.querySelectorAll(\'.quiz-option\').forEach(option => {
    option.addEventListener(\'click\', () => {
        const question = option.closest(\'.quiz-question\');
        if (question.dataset.answered) return;
        question.dataset.answered = \'true\';

        const value = option.dataset.value;
        const correct = question.dataset.correct;
        const feedback = question.querySelector(\'.quiz-feedback\');
        feedback.style.display = \'block\';

        if (value === correct) {
            option.classList.add(\'correct\');
            feedback.querySelector(\'.feedback-correct\').style.display = \'block\';
        } else {
            option.classList.add(\'incorrect\');
            feedback.querySelector(\'.feedback-incorrect\').style.display = \'block\';
        }

        quizCompletadas++;
        if (quizCompletadas === totalPreguntas) {
            mostrarResultadosQuiz();
        }
    });
});

function mostrarResultadosQuiz() {
    const correctas = document.querySelectorAll(\'.quiz-option.correct\').length;
    document.getElementById(\'quizScore\').textContent = `${correctas}/${totalPreguntas}`;
    const feedbackText = correctas === totalPreguntas ? \'¡Dominio total del Full-Stack!\' :
        correctas >= totalPreguntas * 0.66 ? \'Muy bien, conceptos sólidos\' : \'Repasa las capas del stack\';
    document.getElementById(\'quizFeedback\').textContent = feedbackText;
    document.querySelector(\'.quiz-results\').style.display = \'block\';
}

function reiniciarQuiz() {
    document.querySelectorAll(\'.quiz-question\').forEach(q => {
        q.dataset.answered = \'\';
        q.querySelector(\'.quiz-feedback\').style.display = \'none\';
        q.querySelectorAll(\'.quiz-option\').forEach(o => o.classList.remove(\'correct\', \'incorrect\'));
    });
    quizCompletadas = 0;
    document.querySelector(\'.quiz-results\').style.display = \'none\';
}

// Errores comunes (colapsables)
document.querySelectorAll(\'.collapsible .error-header\').forEach(header => {
    header.addEventListener(\'click\', () => {
        const content = header.nextElementSibling;
        const icon = header.querySelector(\'.collapse-icon\');
        content.style.display = content.style.display === \'none\' ? \'block\' : \'none\';
        icon.textContent = content.style.display === \'block\' ? \'-\' : \'+\';
    });
});

// Autoevaluación de habilidades con sliders
document.querySelectorAll(\'.skill-slider\').forEach(slider => {
    slider.addEventListener(\'input\', () => {
        const fill = slider.closest(\'.skill-item\').querySelector(\'.skill-fill\');
        fill.style.width = slider.value + \'%\';
    });
});

function guardarHabilidades() {
    const skills = {};
    document.querySelectorAll(\'.skill-slider\').forEach(slider => {
        const label = slider.closest(\'.skill-item\').querySelector(\'span\').textContent.trim();
        skills[label] = slider.value;
    });
    localStorage.setItem(\'fullstackSkills2025\', JSON.stringify(skills));
    alert(\'Habilidades Full-Stack guardadas en localStorage\');
    console.log(\'Habilidades guardadas:\', skills);
}

// Proyecto final (mostrar solución)
function mostrarEsqueletoProyecto() {
    const solucion = document.getElementById(\'proyectoSolucion\');
    solucion.style.display = solucion.style.display === \'block\' ? \'none\' : \'block\';
}

// Inicialización al cargar la página
document.addEventListener(\'DOMContentLoaded\', () => {
    actualizarLista();
    console.log(\'Lección Full-Stack Web 2025 cargada correctamente\');
});
</script>',
    'ejercicios' => 
    array (
      0 => 
      array (
        'enunciado' => 'Frontend usa',
        'respuesta' => 'HTML, CSS, JavaScript',
      ),
      1 => 
      array (
        'enunciado' => 'Backend procesa',
        'respuesta' => 'Lógica, APIs, autenticación',
      ),
      2 => 
      array (
        'enunciado' => 'BD almacena',
        'respuesta' => 'Datos persistentes',
      ),
      3 => 
      array (
        'enunciado' => 'Full-Stack domina',
        'respuesta' => 'Frontend + Backend + BD',
      ),
      4 => 
      array (
        'enunciado' => 'API REST usa',
        'respuesta' => 'HTTP methods (GET, POST)',
      ),
      5 => 
      array (
        'enunciado' => 'Responsive con',
        'respuesta' => 'Media Queries, Flexbox',
      ),
      6 => 
      array (
        'enunciado' => 'Deploy en',
        'respuesta' => 'Vercel, Netlify, Heroku',
      ),
      7 => 
      array (
        'enunciado' => 'Stack MERN',
        'respuesta' => 'Mongo, Express, React, Node',
      ),
      8 => 
      array (
        'enunciado' => 'PWA permite',
        'respuesta' => 'Offline, notificaciones',
      ),
      9 => 
      array (
        'enunciado' => 'SSR es',
        'respuesta' => 'Server-Side Rendering',
      ),
      10 => 
      array (
        'enunciado' => 'SI: % apps con PWA',
        'respuesta' => '+70%',
      ),
      11 => 
      array (
        'enunciado' => 'Framework PHP',
        'respuesta' => 'Laravel',
      ),
    ),
    'quiz' => 
    array (
      0 => 
      array (
        'pregunta' => 'Frontend es',
        'opciones' => 
        array (
          0 => 'Interfaz',
          1 => 'Lógica',
          2 => 'BD',
          3 => 'Red',
        ),
        'correcta' => 'Interfaz',
      ),
      1 => 
      array (
        'pregunta' => 'Backend maneja',
        'opciones' => 
        array (
          0 => 'APIs',
          1 => 'Diseño',
          2 => 'HTML',
          3 => 'CSS',
        ),
        'correcta' => 'APIs',
      ),
      2 => 
      array (
        'pregunta' => 'Full-Stack incluye',
        'opciones' => 
        array (
          0 => 'Todo',
          1 => 'Solo front',
          2 => 'Solo back',
          3 => 'Diseño',
        ),
        'correcta' => 'Todo',
      ),
      3 => 
      array (
        'pregunta' => 'HTTP GET es para',
        'opciones' => 
        array (
          0 => 'Leer',
          1 => 'Crear',
          2 => 'Actualizar',
          3 => 'Eliminar',
        ),
        'correcta' => 'Leer',
      ),
      4 => 
      array (
        'pregunta' => 'POST para',
        'opciones' => 
        array (
          0 => 'Crear',
          1 => 'Leer',
          2 => 'Actualizar',
          3 => 'Eliminar',
        ),
        'correcta' => 'Crear',
      ),
      5 => 
      array (
        'pregunta' => 'Responsive adapta a',
        'opciones' => 
        array (
          0 => 'Dispositivos',
          1 => 'Solo PC',
          2 => 'Impresión',
          3 => 'Nada',
        ),
        'correcta' => 'Dispositivos',
      ),
      6 => 
      array (
        'pregunta' => 'PWA permite',
        'opciones' => 
        array (
          0 => 'Offline',
          1 => 'Solo online',
          2 => 'Nada',
          3 => 'Solo móvil',
        ),
        'correcta' => 'Offline',
      ),
      7 => 
      array (
        'pregunta' => 'SSR mejora',
        'opciones' => 
        array (
          0 => 'SEO',
          1 => 'Velocidad',
          2 => 'Diseño',
          3 => 'Nada',
        ),
        'correcta' => 'SEO',
      ),
      8 => 
      array (
        'pregunta' => 'Deploy en Vercel es',
        'opciones' => 
        array (
          0 => 'Gratis',
          1 => 'Solo pago',
          2 => 'Local',
          3 => 'Error',
        ),
        'correcta' => 'Gratis',
      ),
      9 => 
      array (
        'pregunta' => 'Git es para',
        'opciones' => 
        array (
          0 => 'Control versión',
          1 => 'Diseño',
          2 => 'BD',
          3 => 'Hosting',
        ),
        'correcta' => 'Control versión',
      ),
      10 => 
      array (
        'pregunta' => 'Stack LAMP',
        'opciones' => 
        array (
          0 => 'Linux, Apache, MySQL, PHP',
          1 => 'Windows',
          2 => 'Node',
          3 => 'React',
        ),
        'correcta' => 'Linux, Apache, MySQL, PHP',
      ),
      11 => 
      array (
        'pregunta' => 'MERN usa',
        'opciones' => 
        array (
          0 => 'MongoDB',
          1 => 'MySQL',
          2 => 'PostgreSQL',
          3 => 'SQLite',
        ),
        'correcta' => 'MongoDB',
      ),
      12 => 
      array (
        'pregunta' => 'Framework React',
        'opciones' => 
        array (
          0 => 'Next.js',
          1 => 'Laravel',
          2 => 'Django',
          3 => 'Flask',
        ),
        'correcta' => 'Next.js',
      ),
      13 => 
      array (
        'pregunta' => 'API REST devuelve',
        'opciones' => 
        array (
          0 => 'JSON',
          1 => 'HTML',
          2 => 'CSS',
          3 => 'XML',
        ),
        'correcta' => 'JSON',
      ),
      14 => 
      array (
        'pregunta' => 'CORS es para',
        'opciones' => 
        array (
          0 => 'Seguridad dominios',
          1 => 'Velocidad',
          2 => 'Diseño',
          3 => 'Nada',
        ),
        'correcta' => 'Seguridad dominios',
      ),
      15 => 
      array (
        'pregunta' => 'JWT para',
        'opciones' => 
        array (
          0 => 'Autenticación',
          1 => 'Diseño',
          2 => 'BD',
          3 => 'Hosting',
        ),
        'correcta' => 'Autenticación',
      ),
      16 => 
      array (
        'pregunta' => 'Docker',
        'opciones' => 
        array (
          0 => 'Contenedores',
          1 => 'VM',
          2 => 'Nube',
          3 => 'IDE',
        ),
        'correcta' => 'Contenedores',
      ),
      17 => 
      array (
        'pregunta' => 'CI/CD significa',
        'opciones' => 
        array (
          0 => 'Integración/Despliegue continuo',
          1 => 'Código',
          2 => 'Diseño',
          3 => 'Nada',
        ),
        'correcta' => 'Integración/Despliegue continuo',
      ),
      18 => 
      array (
        'pregunta' => 'SI 2025: % full-stack',
        'opciones' => 
        array (
          0 => '65%',
          1 => '30%',
          2 => '90%',
          3 => '10%',
        ),
        'correcta' => '65%',
      ),
      19 => 
      array (
        'pregunta' => 'App más usada',
        'opciones' => 
        array (
          0 => 'Web',
          1 => 'Móvil',
          2 => 'Desktop',
          3 => 'IoT',
        ),
        'correcta' => 'Web',
      ),
      20 => 
      array (
        'pregunta' => 'Frontend framework',
        'opciones' => 
        array (
          0 => 'React',
          1 => 'Laravel',
          2 => 'Express',
          3 => 'Django',
        ),
        'correcta' => 'React',
      ),
      21 => 
      array (
        'pregunta' => 'Backend PHP',
        'opciones' => 
        array (
          0 => 'Laravel',
          1 => 'React',
          2 => 'Vue',
          3 => 'Angular',
        ),
        'correcta' => 'Laravel',
      ),
      22 => 
      array (
        'pregunta' => 'BD NoSQL',
        'opciones' => 
        array (
          0 => 'MongoDB',
          1 => 'MySQL',
          2 => 'SQLite',
          3 => 'Oracle',
        ),
        'correcta' => 'MongoDB',
      ),
      23 => 
      array (
        'pregunta' => 'Cloud para web',
        'opciones' => 
        array (
          0 => 'AWS, Vercel',
          1 => 'Local',
          2 => 'USB',
          3 => 'CD',
        ),
        'correcta' => 'AWS, Vercel',
      ),
      24 => 
      array (
        'pregunta' => 'HTTPS es',
        'opciones' => 
        array (
          0 => 'Seguro',
          1 => 'Lento',
          2 => 'Opcional',
          3 => 'Error',
        ),
        'correcta' => 'Seguro',
      ),
      25 => 
      array (
        'pregunta' => 'Cache mejora',
        'opciones' => 
        array (
          0 => 'Velocidad',
          1 => 'Seguridad',
          2 => 'Diseño',
          3 => 'Nada',
        ),
        'correcta' => 'Velocidad',
      ),
      26 => 
      array (
        'pregunta' => 'Microservicios',
        'opciones' => 
        array (
          0 => 'Escalable',
          1 => 'Monolito',
          2 => 'Lento',
          3 => 'Simple',
        ),
        'correcta' => 'Escalable',
      ),
      27 => 
      array (
        'pregunta' => 'WebSocket para',
        'opciones' => 
        array (
          0 => 'Tiempo real',
          1 => 'Estático',
          2 => 'Archivos',
          3 => 'Email',
        ),
        'correcta' => 'Tiempo real',
      ),
      28 => 
      array (
        'pregunta' => 'SI 2025: % apps PWA',
        'opciones' => 
        array (
          0 => '+70%',
          1 => '30%',
          2 => '10%',
          3 => '0%',
        ),
        'correcta' => '+70%',
      ),
      29 => 
      array (
        'pregunta' => 'Full-Stack ideal para',
        'opciones' => 
        array (
          0 => 'Startups, MVP',
          1 => 'Bancos',
          2 => 'Gobierno',
          3 => 'Hardware',
        ),
        'correcta' => 'Startups, MVP',
      ),
    ),
  ),
  5 => 
  array (
    'materia' => 'Programación',
    'slug' => 'csharp-dotnet-2025',
    'titulo' => 'C# + .NET 2025: Consola, Frameworks, Simulador y Retos Interactivos',
    'contenido' => '<!-- INICIO LECCIÓN CYBERPUNK -->
<div class="leccion-container leccion-programacion-csharp" data-tema="csharp-dotnet">

    <!-- CABECERA CYBERPUNK -->
    <header class="leccion-header">
        <h1 class="titulo-leccion neon-glow">
            <span class="icon-tema">⚡</span>
            C# + .NET 2025
        </h1>
        <div class="subtitulo">
            Stack Empresarial: Consola, WinForms, ASP.NET, Simulador y Retos
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
                <h3>Dominar ecosistema .NET 2025</h3>
                <p>Entender Consola, WinForms, ASP.NET Core, Blazor, Unity, Azure</p>
            </div>
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Programar simulador interactivo</h3>
                <p>Ejecutar código C# en tiempo real con compilación virtual</p>
            </div>
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Resolver retos de programación</h3>
                <p>Calculadora, API REST, juegos con casos reales</p>
            </div>
            <div class="objetivo-card" data-completado="false">
                <div class="objetivo-checkbox"></div>
                <h3>Migrar a .NET 8+ y C# 12</h3>
                <p>Características modernas: records, pattern matching, minimal APIs</p>
            </div>
        </div>
    </section>

    <!-- CONTEXTO REAL -->
    <section class="contexto-real">
        <h2 class="seccion-titulo neon-dato">
            <span class="icon">🌍</span> MERCADO LABORAL 2025
        </h2>
        <div class="contexto-grid">
            <div class="contexto-card">
                <h3>🏢 Fortune 500</h3>
                <p>82% de empresas usan C#/.NET en sistemas críticos</p>
                <div class="dato-neon">Salario promedio: $95K</div>
            </div>
            <div class="contexto-card">
                <h3>☁️ Azure + Cloud</h3>
                <p>75% de APIs empresariales con ASP.NET Core</p>
                <div class="dato-neon">Crecimiento: +34% anual</div>
            </div>
            <div class="contexto-card">
                <h3>🎮 Gaming Industry</h3>
                <p>Unity (C#) domina 61% del mercado de juegos móviles</p>
                <div class="dato-neon">>4B descargas</div>
            </div>
        </div>
    </section>

    <!-- SECCIÓN TEÓRICA -->
    <section class="teoria-section">
        <div class="borde-neon-lateral"></div>
        <h2 class="seccion-titulo neon-concepto">
            <span class="icon">📚</span> ECOSISTEMA .NET 2025
        </h2>
        
        <!-- INTRODUCCIÓN -->
        <div class="subseccion">
            <h3>1. Arquitectura Moderna: C# + .NET 8+</h3>
            <div class="definicion-principal">
                <div class="def-card">
                    <h4>⚡ C# (C SHARP)</h4>
                    <p>Lenguaje <strong>tipado</strong>, <strong>orientado a objetos</strong>, <strong>multiparadigma</strong></p>
                    <div class="formula-inline">
                        \\[ \\text{C#} = \\text{Sintaxis limpia} + \\text{Tipado fuerte} + \\text{Async/Await} \\]
                    </div>
                </div>
            </div>
            
            <div class="clasificacion-doble">
                <div class="clas-card core">
                    <h4>🧠 .NET CORE / .NET 8+</h4>
                    <ul>
                        <li><strong>Multiplataforma:</strong> Windows, Linux, macOS</li>
                        <li><strong>Open Source:</strong> MIT License, comunidad activa</li>
                        <li><strong>Alto rendimiento:</strong> +40% vs .NET Framework</li>
                        <li><strong>Containers:</strong> Docker, Kubernetes nativos</li>
                    </ul>
                    <div class="ejemplos">
                        <strong>Versiones LTS:</strong> .NET 6, .NET 8, .NET 10 (2025)
                    </div>
                </div>
                
                <div class="clas-card frameworks">
                    <h4>🛠️ FRAMEWORKS PRINCIPALES</h4>
                    <ul>
                        <li><strong>ASP.NET Core:</strong> Web APIs, MVC, Razor Pages</li>
                        <li><strong>WinForms/WPF:</strong> Desktop Windows tradicional</li>
                        <li><strong>MAUI:</strong> Multiplataforma (iOS, Android, Windows)</li>
                        <li><strong>Blazor:</strong> C# en navegador (WebAssembly)</li>
                    </ul>
                    <div class="ejemplos">
                        <strong>Nicho:</strong> Unity (juegos), ML.NET (machine learning)
                    </div>
                </div>
            </div>
        </div>

        <!-- TABLA ECOSISTEMA -->
        <div class="subseccion">
            <h3>2. Tabla Comparativa: Stack Completo</h3>
            <div class="tabla-interactiva">
                <table class="tabla-cyberpunk">
                    <thead>
                        <tr>
                            <th>TIPO</th>
                            <th>FRAMEWORK</th>
                            <th>USO PRINCIPAL</th>
                            <th>RENDIMIENTO</th>
                            <th>CURVA APRENDIZAJE</th>
                            <th>SALARIO PROMEDIO</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr data-tipo="consola">
                            <td><strong class="neon-concepto">CONSOLA</strong></td>
                            <td>.NET Console</td>
                            <td>CLI, Tools, Backend Services</td>
                            <td>⭐️⭐️⭐️⭐️⭐️</td>
                            <td>Baja</td>
                            <td>$75K</td>
                        </tr>
                        <tr data-tipo="web">
                            <td><strong class="neon-concepto">WEB</strong></td>
                            <td>ASP.NET Core</td>
                            <td>APIs REST, MVC, Microservicios</td>
                            <td>⭐️⭐️⭐️⭐️</td>
                            <td>Media</td>
                            <td>$105K</td>
                        </tr>
                        <tr data-tipo="desktop">
                            <td><strong class="neon-concepto">DESKTOP</strong></td>
                            <td>WinForms / WPF</td>
                            <td>Aplicaciones Windows empresariales</td>
                            <td>⭐️⭐️⭐️</td>
                            <td>Media</td>
                            <td>$90K</td>
                        </tr>
                        <tr data-tipo="mobile">
                            <td><strong class="neon-concepto">MÓVIL</strong></td>
                            <td>.NET MAUI</td>
                            <td>iOS, Android, Windows multiplataforma</td>
                            <td>⭐️⭐️⭐️</td>
                            <td>Alta</td>
                            <td>$95K</td>
                        </tr>
                        <tr data-tipo="gaming">
                            <td><strong class="neon-concepto">GAMING</strong></td>
                            <td>Unity</td>
                            <td>Juegos 2D/3D, VR, Realidad Aumentada</td>
                            <td>⭐️⭐️⭐️⭐️</td>
                            <td>Alta</td>
                            <td>$85K</td>
                        </tr>
                    </tbody>
                </table>
                <div class="tabla-info" id="infoFramework">
                    Selecciona un tipo de aplicación para ver detalles
                </div>
            </div>
        </div>

        <!-- CARACTERÍSTICAS C# MODERNO -->
        <div class="subseccion">
            <h3>3. Características C# 12 (2025)</h3>
            <div class="metodos-grid">
                <div class="metodo-card" data-metodo="records">
                    <div class="metodo-icon">📝</div>
                    <h4>RECORDS</h4>
                    <div class="metodo-desc">
                        Inmutabilidad por defecto, value equality
                    </div>
                    <div class="metodo-datos">
                        <div class="dato"><strong>Versión:</strong> C# 9+</div>
                        <div class="dato"><strong>Ejemplo:</strong> <code>public record Person(string Name);</code></div>
                    </div>
                </div>
                
                <div class="metodo-card" data-metodo="patterns">
                    <div class="metodo-icon">🎯</div>
                    <h4>PATTERN MATCHING</h4>
                    <div class="metodo-desc">
                        Matching complejo en switch expressions
                    </div>
                    <div class="metodo-datos">
                        <div class="dato"><strong>Versión:</strong> C# 8+</div>
                        <div class="dato"><strong>Ejemplo:</strong> <code>obj is int x and > 0</code></div>
                    </div>
                </div>
                
                <div class="metodo-card" data-metodo="nullables">
                    <div class="metodo-icon">⚠️</div>
                    <h4>NULLABLE REFERENCE TYPES</h4>
                    <div class="metodo-desc">
                        Elimina NullReferenceException en compilación
                    </div>
                    <div class="metodo-datos">
                        <div class="dato"><strong>Versión:</strong> C# 8+</div>
                        <div class="dato"><strong>Ejemplo:</strong> <code>string? nullableString = null;</code></div>
                    </div>
                </div>
                
                <div class="metodo-card" data-metodo="async">
                    <div class="metodo-icon">⚡</div>
                    <h4>ASYNC/AWAIT</h4>
                    <div class="metodo-desc">
                        Programación asíncrona sin callbacks
                    </div>
                    <div class="metodo-datos">
                        <div class="dato"><strong>Versión:</strong> C# 5+</div>
                        <div class="dato"><strong>Ejemplo:</strong> <code>await httpClient.GetAsync(...)</code></div>
                    </div>
                </div>
                
                <div class="metodo-card" data-metodo="linq">
                    <div class="metodo-icon">🔍</div>
                    <h4>LINQ</h4>
                    <div class="metodo-desc">
                        Language Integrated Queries
                    </div>
                    <div class="metodo-datos">
                        <div class="dato"><strong>Versión:</strong> C# 3.5+</div>
                        <div class="dato"><strong>Ejemplo:</strong> <code>collection.Where(x => x > 0)</code></div>
                    </div>
                </div>
                
                <div class="metodo-card" data-metodo="generics">
                    <div class="metodo-icon">🎲</div>
                    <h4>GENERICS</h4>
                    <div class="metodo-desc">
                        Tipos parametrizados, reutilización de código
                    </div>
                    <div class="metodo-datos">
                        <div class="dato"><strong>Versión:</strong> C# 2.0+</div>
                        <div class="dato"><strong>Ejemplo:</strong> <code>List&lt;T&gt;, Dictionary&lt;K,V&gt;</code></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SIMULADOR INTERACTIVO -->
    <section class="simulator-section">
        <h2 class="seccion-titulo neon-interactivo">
            <span class="icon">🔄</span> SIMULADOR: C# EN TIEMPO REAL
        </h2>
        
        <div class="simulator-container" data-tema="csharp-simulator">
            <!-- PANEL DE CONTROLES -->
            <div class="simulator-controls">
                <h3>CONTROLES</h3>
                
                <div class="control-group">
                    <label for="ejemploSelect">Ejemplo rápido:</label>
                    <select id="ejemploSelect" class="control-select" onchange="cargarEjemplo()">
                        <option value="">-- Selecciona ejemplo --</option>
                        <option value="hola">Hola Mundo</option>
                        <option value="calculadora">Calculadora básica</option>
                        <option value="clases">Clases y objetos</option>
                        <option value="linq">LINQ y colecciones</option>
                        <option value="async">Async/Await</option>
                        <option value="api">API HTTP mínima</option>
                    </select>
                </div>
                
                <div class="control-group">
                    <label>Características:</label>
                    <div class="checkbox-group">
                        <label><input type="checkbox" name="caracteristicas" value="using" checked> Añadir using</label>
                        <label><input type="checkbox" name="caracteristicas" value="comments"> Comentarios</label>
                        <label><input type="checkbox" name="caracteristicas" value="errors"> Mostrar errores</label>
                        <label><input type="checkbox" name="caracteristicas" value="optimize"> Optimizar código</label>
                    </div>
                </div>
                
                <div class="control-group">
                    <label for="frameworkSelect">Framework:</label>
                    <select id="frameworkSelect" class="control-select">
                        <option value="net8">.NET 8</option>
                        <option value="net6">.NET 6</option>
                        <option value="netcore">.NET Core 3.1</option>
                        <option value="framework">.NET Framework 4.8</option>
                    </select>
                </div>
                
                <button class="btn-clasificar" onclick="ejecutarCS()">
                    <span class="btn-icon">▶</span> EJECUTAR CÓDIGO
                </button>
                
                <button class="btn-aleatorio" onclick="ejemploAleatorio()">
                    <span class="btn-icon">🎲</span> EJEMPLO ALEATORIO
                </button>
                
                <button class="btn-reset" onclick="reiniciarEditor()">
                    <span class="btn-icon">🔄</span> REINICIAR EDITOR
                </button>
            </div>
            
            <!-- EDITOR DE CÓDIGO -->
            <div class="simulator-visualization" id="editorContainer">
                <div class="editor-header">
                    <div class="editor-tabs">
                        <button class="editor-tab active" onclick="cambiarEditorTab(\'main\')">Program.cs</button>
                        <button class="editor-tab" onclick="cambiarEditorTab(\'helpers\')">Helpers.cs</button>
                        <button class="editor-tab" onclick="cambiarEditorTab(\'config\')">.csproj</button>
                    </div>
                    <div class="editor-info">
                        <span id="charCount">0 caracteres</span>
                        <span id="lineCount">1 línea</span>
                    </div>
                </div>
                
                <div class="editor-content">
                    <textarea id="csEditor" class="code-editor" spellcheck="false">using System;

namespace SimuladorCS
{
    public class Program
    {
        public static void Main()
        {
            Console.WriteLine("🚀 Bienvenido al Simulador C# 2025");
            Console.WriteLine("Escribe tu código y presiona \'EJECUTAR\'");
            Console.WriteLine("");
            Console.WriteLine($"📅 Fecha: {DateTime.Now:yyyy-MM-dd}");
            Console.WriteLine($"⚡ .NET: {Environment.Version}");
        }
    }
}</textarea>
                    
                    <div class="editor-console" id="csConsole">
                        <div class="console-header">CONSOLA</div>
                        <div class="console-output" id="consoleOutput">
                            // La salida aparecerá aquí
                        </div>
                        <div class="console-stats" id="consoleStats">
                            Esperando ejecución...
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- DATOS EN TIEMPO REAL -->
            <div class="simulator-data">
                <h3>DATOS DE EJECUCIÓN</h3>
                
                <div class="data-card">
                    <div class="data-label">Framework:</div>
                    <div class="data-value" id="dataFramework">.NET 8</div>
                </div>
                
                <div class="data-card">
                    <div class="data-label">Versión C#:</div>
                    <div class="data-value" id="dataVersion">C# 12</div>
                </div>
                
                <div class="data-card">
                    <div class="data-label">Líneas de código:</div>
                    <div class="data-value" id="dataLines">15</div>
                </div>
                
                <div class="data-card highlight">
                    <div class="data-label">ESTADO COMPILACIÓN:</div>
                    <div class="data-value" id="dataCompilation">Listo</div>
                </div>
                
                <div class="data-card">
                    <div class="data-label">Tiempo ejecución:</div>
                    <div class="data-value" id="dataTime">0 ms</div>
                </div>
                
                <div class="data-card">
                    <div class="data-label">Memoria usada:</div>
                    <div class="data-value" id="dataMemory">0 MB</div>
                </div>
                
                <div class="estadisticas">
                    <h4>📊 ESTADÍSTICAS C#</h4>
                    <div class="stat-item">
                        <span>Desarrolladores .NET:</span>
                        <span class="stat-value">6.5M</span>
                    </div>
                    <div class="stat-item">
                        <span>Paquetes NuGet:</span>
                        <span class="stat-value">>300K</span>
                    </div>
                    <div class="stat-item">
                        <span>Empresas Fortune 500:</span>
                        <span class="stat-value">82%</span>
                    </div>
                    <div class="stat-item">
                        <span>Salario promedio:</span>
                        <span class="stat-value">$95K</span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- EJEMPLOS DE CÓDIGO -->
        <div class="ejemplos-grid">
            <div class="ejemplo-card" onclick="cargarEjemploCode(\'hola\')">
                <h4>👋 HOLA MUNDO</h4>
                <pre><code>Console.WriteLine("Hola C#");</code></pre>
                <div class="ejemplo-tag">Básico</div>
            </div>
            
            <div class="ejemplo-card" onclick="cargarEjemploCode(\'calculadora\')">
                <h4>🧮 CALCULADORA</h4>
                <pre><code>public static int Sumar(int a, int b) => a + b;</code></pre>
                <div class="ejemplo-tag">Funciones</div>
            </div>
            
            <div class="ejemplo-card" onclick="cargarEjemploCode(\'clases\')">
                <h4>👥 CLASES</h4>
                <pre><code>public class Persona { public string Nombre; }</code></pre>
                <div class="ejemplo-tag">POO</div>
            </div>
            
            <div class="ejemplo-card" onclick="cargarEjemploCode(\'linq\')">
                <h4>🔍 LINQ</h4>
                <pre><code>var mayores = lista.Where(x => x > 18);</code></pre>
                <div class="ejemplo-tag">Colecciones</div>
            </div>
        </div>
    </section>

    <!-- QUIZ INTERACTIVO -->
    <section class="quiz-section">
        <h2 class="seccion-titulo neon-evaluacion">
            <span class="icon">❓</span> QUIZ: C# Y .NET
        </h2>
        
        <div class="quiz-container">
            <!-- PREGUNTA 1 -->
            <div class="quiz-question" data-correct="B">
                <div class="quiz-header">
                    <span class="quiz-num">01</span>
                    <h3>¿Cuál es la principal ventaja de .NET Core sobre .NET Framework?</h3>
                </div>
                
                <div class="quiz-options">
                    <button class="quiz-option" data-value="A">
                        <span class="option-letter">A</span>
                        Solo funciona en Windows
                    </button>
                    <button class="quiz-option" data-value="B">
                        <span class="option-letter">B</span>
                        Multiplataforma (Windows, Linux, macOS)
                    </button>
                    <button class="quiz-option" data-value="C">
                        <span class="option-letter">C</span>
                        No requiere compilación
                    </button>
                    <button class="quiz-option" data-value="D">
                        <span class="option-letter">D</span>
                        Es solo para aplicaciones web
                    </button>
                </div>
                
                <div class="quiz-feedback" style="display: none;">
                    <div class="feedback-correct">
                        ✅ <strong>Correcto:</strong> .NET Core es multiplataforma, a diferencia de .NET Framework.
                    </div>
                    <div class="feedback-incorrect">
                        ❌ <strong>Incorrecto:</strong> .NET Framework solo funciona en Windows.
                    </div>
                    <div class="feedback-explicacion">
                        <p><strong>Explicación:</strong> .NET Core (ahora .NET 5+) fue rediseñado para ser multiplataforma, open source y con mejor rendimiento. .NET Framework es Windows-only y está en modo mantenimiento.</p>
                    </div>
                </div>
            </div>
            
            <!-- PREGUNTA 2 -->
            <div class="quiz-question" data-correct="C">
                <div class="quiz-header">
                    <span class="quiz-num">02</span>
                    <h3>¿Qué característica de C# 8+ ayuda a prevenir NullReferenceException?</h3>
                </div>
                
                <div class="quiz-options">
                    <button class="quiz-option" data-value="A">
                        <span class="option-letter">A</span>
                        var keyword
                    </button>
                    <button class="quiz-option" data-value="B">
                        <span class="option-letter">B</span>
                        dynamic
                    </button>
                    <button class="quiz-option" data-value="C">
                        <span class="option-letter">C</span>
                        Nullable Reference Types
                    </button>
                    <button class="quiz-option" data-value="D">
                        <span class="option-letter">D</span>
                        Extension Methods
                    </button>
                </div>
                
                <div class="quiz-feedback" style="display: none;">
                    <div class="feedback-correct">
                        ✅ <strong>Correcto:</strong> Nullable Reference Types avisa en tiempo de compilación.
                    </div>
                    <div class="feedback-incorrect">
                        ❌ <strong>Incorrecto:</strong> Revisa las características modernas de C#.
                    </div>
                    <div class="feedback-explicacion">
                        <p><strong>Solución:</strong> Los Nullable Reference Types (desde C# 8) hacen que el compilador analice el flujo de nulls y emita advertencias cuando podría haber NullReferenceException.</p>
                    </div>
                </div>
            </div>
            
            <!-- PREGUNTA 3 -->
            <div class="quiz-question" data-correct="D">
                <div class="quiz-header">
                    <span class="quiz-num">03</span>
                    <h3>¿Qué framework usarías para crear una API REST en 2025?</h3>
                </div>
                
                <div class="quiz-options">
                    <button class="quiz-option" data-value="A">
                        <span class="option-letter">A</span>
                        WinForms
                    </button>
                    <button class="quiz-option" data-value="B">
                        <span class="option-letter">B</span>
                        WPF
                    </button>
                    <button class="quiz-option" data-value="C">
                        <span class="option-letter">C</span>
                        Windows Forms
                    </button>
                    <button class="quiz-option" data-value="D">
                        <span class="option-letter">D</span>
                        ASP.NET Core
                    </button>
                </div>
                
                <div class="quiz-feedback" style="display: none;">
                    <div class="feedback-correct">
                        ✅ <strong>Correcto:</strong> ASP.NET Core es el framework moderno para APIs web.
                    </div>
                    <div class="feedback-incorrect">
                        ❌ <strong>Incorrecto:</strong> WinForms y WPF son para aplicaciones de escritorio.
                    </div>
                    <div class="feedback-explicacion">
                        <p><strong>Dato:</strong> ASP.NET Core es el framework web moderno de Microsoft, multiplataforma, de alto rendimiento, usado para APIs REST, MVC, y aplicaciones web. WinForms/WPF son para aplicaciones de escritorio Windows.</p>
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

    <!-- RETOS INTERACTIVOS -->
    <section class="errores-section">
        <h2 class="seccion-titulo neon-alerta">
            <span class="icon">💻</span> RETOS DE PROGRAMACIÓN
        </h2>
        
        <div class="errores-container">
            <div class="error-card">
                <div class="error-header" onclick="toggleReto(this)">
                    <h3>🎯 RETO 1: Calculadora de Consola Interactiva</h3>
                    <span class="error-toggle">+</span>
                </div>
                <div class="error-content">
                    <div class="error-ejemplo">
                        <strong>Objetivo:</strong> Crear calculadora con:
                        <ul>
                            <li>Menú interactivo (sumar, restar, multiplicar, dividir, salir)</li>
                            <li>Validación de entrada (números válidos)</li>
                            <li>Manejo de división por cero</li>
                            <li>Historial de operaciones</li>
                            <li>Persistencia en archivo (opcional)</li>
                        </ul>
                    </div>
                    <div class="error-correccion">
                        <strong>Pistas:</strong>
                        <ol>
                            <li>Usar <code>Console.ReadLine()</code> para entrada</li>
                            <li>Implementar <code>switch</code> para menú</li>
                            <li>Usar <code>try-catch</code> para errores</li>
                            <li>Crear clase <code>Operacion</code> para historial</li>
                        </ol>
                    </div>
                    <div class="error-practica">
                        <button class="btn-mini" onclick="mostrarSolucionReto(1)">Ver solución sugerida</button>
                        <div class="solucion" id="solucionReto1" style="display: none;">
                            <pre><code>
public class Calculadora
{
    private List&lt;string&gt; historial = new();
    
    public void Iniciar()
    {
        while (true)
        {
            MostrarMenu();
            string opcion = Console.ReadLine();
            
            if (opcion == "5") break;
            
            Console.Write("Número 1: ");
            double a = double.Parse(Console.ReadLine());
            Console.Write("Número 2: ");
            double b = double.Parse(Console.ReadLine());
            
            double resultado = opcion switch
            {
                "1" => Sumar(a, b),
                "2" => Restar(a, b),
                "3" => Multiplicar(a, b),
                "4" => Dividir(a, b),
                _ => throw new InvalidOperationException()
            };
            
            Console.WriteLine($"Resultado: {resultado}");
            historial.Add($"{a} {Operador(opcion)} {b} = {resultado}");
        }
    }
    
    private double Dividir(double a, double b) => 
        b == 0 ? throw new DivideByZeroException() : a / b;
}
                            </code></pre>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="error-card">
                <div class="error-header" onclick="toggleReto(this)">
                    <h3>🎯 RETO 2: API REST con ASP.NET Core Minimal API</h3>
                    <span class="error-toggle">+</span>
                </div>
                <div class="error-content">
                    <div class="error-ejemplo">
                        <strong>Objetivo:</strong> Crear API REST para gestión de tareas:
                        <ul>
                            <li>GET /tareas → Listar todas</li>
                            <li>GET /tareas/{id} → Obtener por ID</li>
                            <li>POST /tareas → Crear nueva</li>
                            <li>PUT /tareas/{id} → Actualizar</li>
                            <li>DELETE /tareas/{id} → Eliminar</li>
                        </ul>
                    </div>
                    <div class="error-correccion">
                        <strong>Pistas:</strong>
                        <ol>
                            <li>Usar <code>WebApplication.CreateBuilder()</code></li>
                            <li>Implementar <code>app.MapGet/POST/PUT/DELETE</code></li>
                            <li>Usar <code>System.Text.Json</code> para JSON</li>
                            <li>Manejar códigos HTTP (200, 201, 404)</li>
                        </ol>
                    </div>
                    <div class="error-practica">
                        <button class="btn-mini" onclick="mostrarSolucionReto(2)">Ver estructura básica</button>
                        <div class="solucion" id="solucionReto2" style="display: none;">
                            <pre><code>
var builder = WebApplication.CreateBuilder();
var app = builder.Build();

var tareas = new List&lt;Tarea&gt;();

app.MapGet("/tareas", () => tareas);
app.MapGet("/tareas/{id}", (int id) => 
    tareas.FirstOrDefault(t => t.Id == id) 
    is Tarea tarea ? Results.Ok(tarea) : Results.NotFound());

app.MapPost("/tareas", (Tarea tarea) => {
    tarea.Id = tareas.Count + 1;
    tareas.Add(tarea);
    return Results.Created($"/tareas/{tarea.Id}", tarea);
});

app.MapPut("/tareas/{id}", (int id, Tarea tareaActualizada) => {
    var index = tareas.FindIndex(t => t.Id == id);
    if (index == -1) return Results.NotFound();
    
    tareaActualizada.Id = id;
    tareas[index] = tareaActualizada;
    return Results.NoContent();
});

app.Run();

record Tarea(int Id, string Titulo, bool Completada);
                            </code></pre>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- VISUALIZACIÓN SVG ANIMADA -->
    <section class="examen-section">
        <h2 class="seccion-titulo neon-interactivo">
            <span class="icon">📊</span> ARQUITECTURA .NET 2025
        </h2>
        
        <div class="examen-container">
            <div class="problema-card">
                <div class="problema-header">
                    <span class="problema-num">🏗️</span>
                    <h3>Flujo de Desarrollo C# Moderno</h3>
                </div>
                <div class="problema-enunciado">
                    <p>Interactúa con la arquitectura:</p>
                    
                    <div class="arquitectura-container">
                        <svg id="arquitecturaSVG" viewBox="0 0 1000 500" style="width:100%; height:auto; background:#0a0a1a; border-radius:8px;">
                            <!-- Fondo con grid -->
                            <defs>
                                <pattern id="gridPattern" width="40" height="40" patternUnits="userSpaceOnUse">
                                    <path d="M 40 0 L 0 0 0 40" fill="none" stroke="rgba(57,255,20,0.1)" stroke-width="1"/>
                                </pattern>
                                
                                <filter id="glowEffect" x="-50%" y="-50%" width="200%" height="200%">
                                    <feGaussianBlur stdDeviation="3" result="blur"/>
                                    <feMerge>
                                        <feMergeNode in="blur"/>
                                        <feMergeNode in="SourceGraphic"/>
                                    </feMerge>
                                </filter>
                            </defs>
                            
                            <rect width="100%" height="100%" fill="url(#gridPattern)"/>
                            
                            <!-- Nodos interactivos -->
                            <g id="nodoCodigo" class="nodo-arquitectura" onclick="seleccionarNodo(\'codigo\')">
                                <rect x="50" y="200" width="200" height="100" rx="10" fill="#1E88E5" filter="url(#glowEffect)"/>
                                <text x="150" y="240" fill="white" text-anchor="middle" font-size="18" font-weight="bold">CÓDIGO C#</text>
                                <text x="150" y="265" fill="#BBDEFB" text-anchor="middle" font-size="12">.cs files</text>
                            </g>
                            
                            <g id="nodoCompilacion" class="nodo-arquitectura" onclick="seleccionarNodo(\'compilacion\')">
                                <rect x="300" y="150" width="200" height="100" rx="10" fill="#43A047" filter="url(#glowEffect)"/>
                                <text x="400" y="190" fill="white" text-anchor="middle" font-size="18" font-weight="bold">COMPILACIÓN</text>
                                <text x="400" y="215" fill="#C8E6C9" text-anchor="middle" font-size="12">dotnet build</text>
                            </g>
                            
                            <g id="nodoIL" class="nodo-arquitectura" onclick="seleccionarNodo(\'il\')">
                                <rect x="300" y="280" width="200" height="100" rx="10" fill="#FB8C00" filter="url(#glowEffect)"/>
                                <text x="400" y="320" fill="white" text-anchor="middle" font-size="18" font-weight="bold">IL CODE</text>
                                <text x="400" y="345" fill="#FFE0B2" text-anchor="middle" font-size="12">Intermediate Language</text>
                            </g>
                            
                            <g id="nodoCLR" class="nodo-arquitectura" onclick="seleccionarNodo(\'clr\')">
                                <rect x="550" y="150" width="200" height="100" rx="10" fill="#8E24AA" filter="url(#glowEffect)"/>
                                <text x="650" y="190" fill="white" text-anchor="middle" font-size="18" font-weight="bold">CLR</text>
                                <text x="650" y="215" fill="#E1BEE7" text-anchor="middle" font-size="12">Common Language Runtime</text>
                            </g>
                            
                            <g id="nodoAplicacion" class="nodo-arquitectura" onclick="seleccionarNodo(\'aplicacion\')">
                                <rect x="800" y="200" width="200" height="100" rx="10" fill="#E53935" filter="url(#glowEffect)"/>
                                <text x="900" y="240" fill="white" text-anchor="middle" font-size="18" font-weight="bold">APLICACIÓN</text>
                                <text x="900" y="265" fill="#FFCDD2" text-anchor="middle" font-size="12">Console/Web/Desktop</text>
                            </g>
                            
                            <!-- Flechas -->
                            <path id="flecha1" d="M250 250 L300 200" stroke="#1E88E5" stroke-width="3" fill="none" marker-end="url(#arrowHead)"/>
                            <path id="flecha2" d="M250 250 L300 330" stroke="#1E88E5" stroke-width="3" fill="none" marker-end="url(#arrowHead)"/>
                            <path id="flecha3" d="M500 200 L550 200" stroke="#43A047" stroke-width="3" fill="none" marker-end="url(#arrowHead)"/>
                            <path id="flecha4" d="M500 330 L550 230" stroke="#FB8C00" stroke-width="3" fill="none" marker-end="url(#arrowHead)"/>
                            <path id="flecha5" d="M750 200 L800 250" stroke="#8E24AA" stroke-width="3" fill="none" marker-end="url(#arrowHead)"/>
                            
                            <defs>
                                <marker id="arrowHead" markerWidth="10" markerHeight="7" refX="9" refY="3.5" orient="auto">
                                    <polygon points="0 0, 10 3.5, 0 7" fill="#39FF14"/>
                                </marker>
                            </defs>
                            
                            <!-- Información dinámica -->
                            <foreignObject x="50" y="350" width="900" height="120">
                                <div xmlns="http://www.w3.org/1999/xhtml" id="arquitecturaInfo" style="color:#e0f0ff; font-family:monospace; padding:10px; background:rgba(0,0,0,0.7); border-radius:8px;">
                                    Haz clic en cualquier componente para ver detalles
                                </div>
                            </foreignObject>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CIERRE METACOGNITIVO -->
    <section class="cierre-section">
        <h2 class="seccion-titulo neon-concepto">
            <span class="icon">🧠</span> PLAN DE CARRERA C# 2025
        </h2>
        
        <div class="cierre-container">
            <div class="autoevaluacion">
                <h3>📊 AUTOEVALUACIÓN DE HABILIDADES</h3>
                <div class="slider-group">
                    <label>Sintaxis C# básica:</label>
                    <input type="range" min="1" max="5" value="3" class="autoeval-slider" id="slider1">
                    <div class="slider-labels">
                        <span>Básico</span><span>Intermedio</span><span>Avanzado</span>
                    </div>
                </div>
                
                <div class="slider-group">
                    <label>ASP.NET Core APIs:</label>
                    <input type="range" min="1" max="5" value="3" class="autoeval-slider" id="slider2">
                    <div class="slider-labels">
                        <span>Básico</span><span>Intermedio</span><span>Avanzado</span>
                    </div>
                </div>
                
                <div class="slider-group">
                    <label>Entity Framework Core:</label>
                    <input type="range" min="1" max="5" value="3" class="autoeval-slider" id="slider3">
                    <div class="slider-labels">
                        <span>Básico</span><span>Intermedio</span><span>Avanzado</span>
                    </div>
                </div>
                
                <button class="btn-guardar" onclick="guardarAutoevaluacionCS()">
                    💾 GUARDAR AUTOEVALUACIÓN
                </button>
            </div>
            
            <div class="reflexion">
                <h3>💭 REFLEXIÓN GUIADA</h3>
                <div class="pregunta-reflexion">
                    <p>¿Qué tipo de aplicación .NET te interesa más desarrollar y por qué?</p>
                    <textarea placeholder="Escribe tu reflexión aquí..." rows="4" id="reflexionCS1"></textarea>
                </div>
                <div class="pregunta-reflexion">
                    <p>Describe un proyecto real que podrías construir con C# y qué tecnologías usarías.</p>
                    <textarea placeholder="Escribe tu ejemplo..." rows="4" id="reflexionCS2"></textarea>
                </div>
            </div>
        </div>
        
        <div class="plan-estudio">
            <h3>📅 RUTA DE APRENDIZAJE 2025</h3>
            <div class="plan-grid">
                <div class="plan-card">
                    <h4>🔄 FUNDAMENTOS (1-2 meses)</h4>
                    <ul>
                        <li>C# sintaxis básica a avanzada</li>
                        <li>POO: clases, herencia, polimorfismo</li>
                        <li>Colecciones, LINQ, async/await</li>
                        <li>.NET CLI y Visual Studio</li>
                    </ul>
                </div>
                <div class="plan-card">
                    <h4>💪 BACKEND (2-3 meses)</h4>
                    <ul>
                        <li>ASP.NET Core Web APIs</li>
                        <li>Entity Framework Core</li>
                        <li>Autenticación (JWT, Identity)</li>
                        <li>Pruebas unitarias (xUnit)</li>
                    </ul>
                </div>
                <div class="plan-card">
                    <h4>🚀 ESPECIALIZACIÓN (3+ meses)</h4>
                    <ul>
                        <li>Microservicios con Docker</li>
                        <li>Azure/AWS Cloud</li>
                        <li>Blazor WebAssembly</li>
                        <li>Unity (desarrollo de juegos)</li>
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="recursos">
            <h3>🔗 RECURSOS ADICIONALES</h3>
            <div class="recursos-links">
                <a href="https://learn.microsoft.com/es-es/dotnet/csharp/" target="_blank" class="recurso-link">
                    🌐 Microsoft Learn: C# y .NET
                </a>
                <a href="https://dotnet.microsoft.com/es-es/" target="_blank" class="recurso-link">
                    📊 .NET Official Site
                </a>
                <a href="https://github.com/dotnet/" target="_blank" class="recurso-link">
                    💻 GitHub .NET Organization
                </a>
                <a href="https://stackoverflow.com/questions/tagged/c%23" target="_blank" class="recurso-link">
                    🆘 Stack Overflow C#
                </a>
            </div>
        </div>
    </section>

    <!-- JAVASCRIPT INTEGRADO -->
    <script>
    // ========================================
    // SIMULADOR C# INTERACTIVO
    // ========================================
    
    const ejemplosCS = {
        hola: {
            codigo: `using System;

namespace SimuladorCS
{
    public class Program
    {
        public static void Main()
        {
            Console.WriteLine("👋 ¡Hola desde C# 2025!");
            Console.WriteLine("Este es un ejemplo básico.");
            
            string nombre = "Desarrollador";
            int edad = 2025 - 1995;
            
            Console.WriteLine($\\\\"Nombre: {nombre}\\\\");
            Console.WriteLine($\\\\"Edad aproximada: {edad} años\\\\");
            Console.WriteLine($\\\\".NET Version: {Environment.Version}\\\\");
        }
    }
}`,
            descripcion: "Hola Mundo con interpolación de strings"
        },
        
        calculadora: {
            codigo: `using System;

namespace SimuladorCS
{
    public class Calculadora
    {
        public static double Sumar(double a, double b) => a + b;
        public static double Restar(double a, double b) => a - b;
        public static double Multiplicar(double a, double b) => a * b;
        public static double Dividir(double a, double b) => 
            b != 0 ? a / b : throw new DivideByZeroException();
    }
    
    public class Program
    {
        public static void Main()
        {
            Console.WriteLine("🧮 CALCULADORA C#");
            Console.WriteLine("=====================\\\\n");
            
            double x = 15.5;
            double y = 3.2;
            
            Console.WriteLine($\\\\"Operandos: {x} y {y}\\\\");
            Console.WriteLine($\\\\"Suma: {Calculadora.Sumar(x, y)}\\\\");
            Console.WriteLine($\\\\"Resta: {Calculadora.Restar(x, y)}\\\\");
            Console.WriteLine($\\\\"Multiplicación: {Calculadora.Multiplicar(x, y)}\\\\");
            
            try {
                Console.WriteLine($\\\\"División: {Calculadora.Dividir(x, y)}\\\\");
            } catch (DivideByZeroException) {
                Console.WriteLine("Error: División por cero");
            }
        }
    }
}`,
            descripcion: "Calculadora con métodos estáticos"
        },
        
        clases: {
            codigo: `using System;
using System.Collections.Generic;

namespace SimuladorCS
{
    // Clase base
    public abstract class Persona
    {
        public string Nombre { get; set; }
        public int Edad { get; set; }
        
        public abstract void Saludar();
    }
    
    // Clase derivada
    public class Desarrollador : Persona
    {
        public string Lenguaje { get; set; }
        
        public override void Saludar()
        {
            Console.WriteLine($\\\\"Hola, soy {Nombre}, tengo {Edad} años y programo en {Lenguaje}.\\\\");
        }
    }
    
    public class Program
    {
        public static void Main()
        {
            Console.WriteLine("👥 SISTEMA DE PERSONAS\\\\n");
            
            var dev = new Desarrollador {
                Nombre = "Ana",
                Edad = 28,
                Lenguaje = "C#"
            };
            
            dev.Saludar();
            
            // Lista genérica
            List<Persona> equipo = new() {
                new Desarrollador { Nombre = "Carlos", Edad = 32, Lenguaje = "JavaScript" },
                new Desarrollador { Nombre = "Beatriz", Edad = 25, Lenguaje = "Python" },
                dev
            };
            
            Console.WriteLine("\\\\n🧑‍💻 EQUIPO DE DESARROLLO:");
            foreach (var persona in equipo) {
                persona.Saludar();
            }
        }
    }
}`,
            descripcion: "POO: Herencia, clases abstractas, propiedades"
        },
        
        linq: {
            codigo: `using System;
using System.Collections.Generic;
using System.Linq;

namespace SimuladorCS
{
    public class Program
    {
        public static void Main()
        {
            Console.WriteLine("🔍 LINQ EN ACCIÓN\\\\n");
            
            // Colección inicial
            List<int> numeros = new() { 1, 2, 3, 4, 5, 6, 7, 8, 9, 10 };
            Console.WriteLine($"Numeros: [{string.Join(", ", numeros)}]\\\\n");
            
            // 1. Filtrar (WHERE)
            var pares = numeros.Where(n => n % 2 == 0);
            Console.WriteLine($"Pares: [{string.Join(", ", pares)}]");
            
            // 2. Transformar (SELECT)
            var cuadrados = numeros.Select(n => n * n);
            Console.WriteLine($"Cuadrados: [{string.Join(", ", cuadrados)}]");
            
            // 3. Agregar (SUM, AVERAGE)
            Console.WriteLine($"Suma total: {numeros.Sum()}");
            Console.WriteLine($"Promedio: {numeros.Average():F2}");
            
            // 4. Ordenar
            var descendente = numeros.OrderByDescending(n => n);
            Console.WriteLine($"Orden descendente: [{string.Join(", ", descendente)}]");
            
            // 5. Métodos complejos
            var mayoresQueCinco = numeros
                .Where(n => n > 5)
                .Select(n => n * 10)
                .OrderBy(n => n)
                .ToList();
                
            Console.WriteLine($"Mayores que 5 x10 ordenados: [{string.Join(", ", mayoresQueCinco)}]");
            
            // 6. GroupBy
            var grupos = numeros.GroupBy(n => n % 2 == 0 ? "Par" : "Impar");
            foreach (var grupo in grupos) {
                Console.WriteLine($"{grupo.Key}: [{string.Join(", ", grupo)}]");
            }
        }
    }
}`,
            descripcion: "Language Integrated Queries con colecciones"
        },
        
        async: {
            codigo: `using System;
using System.Net.Http;
using System.Threading.Tasks;

namespace SimuladorCS
{
    public class Program
    {
        public static async Task Main()
        {
            Console.WriteLine("⚡ ASYNC/AWAIT DEMO\\\\n");
            
            Console.WriteLine("1. Iniciando tareas asíncronas...");
            
            var tarea1 = TareaLenta("Tarea 1", 1000);
            var tarea2 = TareaLenta("Tarea 2", 500);
            var tarea3 = TareaLenta("Tarea 3", 800);
            
            Console.WriteLine("2. Tareas iniciadas, esperando...\\\\n");
            
            // Ejecutar en paralelo
            await Task.WhenAll(tarea1, tarea2, tarea3);
            
            Console.WriteLine("\\\\n3. Todas las tareas completadas!");
            
            // Ejemplo HTTP
            Console.WriteLine("\\\\n4. Descargando datos de internet...");
            try {
                string datos = await DescargarWebAsync("https://jsonplaceholder.typicode.com/posts/1");
                Console.WriteLine($"Datos descargados ({datos.Length} caracteres)");
            } catch (Exception ex) {
                Console.WriteLine($"Error: {ex.Message}");
            }
        }
        
        static async Task TareaLenta(string nombre, int delay)
        {
            Console.WriteLine($"   {nombre}: Iniciando...");
            await Task.Delay(delay);
            Console.WriteLine($"   {nombre}: Completada después de {delay}ms");
        }
        
        static async Task<string> DescargarWebAsync(string url)
        {
            using HttpClient client = new();
            return await client.GetStringAsync(url);
        }
    }
}`,
            descripcion: "Programación asíncrona con async/await"
        },
        
        api: {
            codigo: `using System;
using System.Text.Json;

namespace SimuladorCS
{
    // Record para datos (C# 9+)
    public record Producto(int Id, string Nombre, decimal Precio, int Stock);
    
    public class Program
    {
        public static void Main()
        {
            Console.WriteLine("🌐 API REST SIMULADA\\\\n");
            
            // "Base de datos" en memoria
            var productos = new List<Producto>
            {
                new(1, "Laptop", 1200.99m, 10),
                new(2, "Mouse", 25.50m, 50),
                new(3, "Teclado", 89.99m, 30)
            };
            
            // Simular endpoints
            Console.WriteLine("GET /api/productos");
            var json = JsonSerializer.Serialize(productos, new JsonSerializerOptions { WriteIndented = true });
            Console.WriteLine(json);
            
            Console.WriteLine("\\\\nGET /api/productos/2");
            var producto2 = productos.FirstOrDefault(p => p.Id == 2);
            Console.WriteLine(JsonSerializer.Serialize(producto2, new JsonSerializerOptions { WriteIndented = true }));
            
            Console.WriteLine("\\\\nPOST /api/productos");
            var nuevoProducto = new Producto(4, "Monitor", 299.99m, 15);
            productos.Add(nuevoProducto);
            Console.WriteLine($"Producto creado: {nuevoProducto.Nombre}");
            
            Console.WriteLine($"\\\\nTotal productos: {productos.Count}");
            Console.WriteLine($"Valor total inventario: {productos.Sum(p => p.Precio * p.Stock):C}");
        }
    }
}`,
            descripcion: "API REST simulada con records y JSON"
        }
    };
    
    function ejecutarCS() {
        console.log("▶ Ejecutando código C#...");
        
        const editor = document.getElementById(\'csEditor\');
        const output = document.getElementById(\'consoleOutput\');
        const stats = document.getElementById(\'consoleStats\');
        
        if (!editor || !output) return;
        
        const code = editor.value;
        const framework = document.getElementById(\'frameworkSelect\').value;
        
        // Actualizar datos
        document.getElementById(\'dataFramework\').textContent = 
            framework === \'net8\' ? \'.NET 8\' :
            framework === \'net6\' ? \'.NET 6\' :
            framework === \'netcore\' ? \'.NET Core 3.1\' : \'.NET Framework 4.8\';
        
        document.getElementById(\'dataVersion\').textContent = 
            framework === \'net8\' ? \'C# 12\' :
            framework === \'net6\' ? \'C# 10\' :
            framework === \'netcore\' ? \'C# 8\' : \'C# 7.3\';
        
        // Contar líneas
        const lines = code.split(\'\\\\n\').length;
        document.getElementById(\'dataLines\').textContent = lines;
        
        // Simular compilación
        document.getElementById(\'dataCompilation\').textContent = \'Compilando...\';
        document.getElementById(\'dataTime\').textContent = \'...\';
        
        // Limpiar consola
        output.innerHTML = \'\';
        stats.innerHTML = \'\';
        
        // Simular tiempo de compilación
        setTimeout(() => {
            document.getElementById(\'dataCompilation\').textContent = \'Compilación exitosa\';
            
            // Extraer salida de Console.WriteLine
            let consoleOutput = \'\';
            const matches = code.match(/Console\\.WriteLine\\(["\'](.*?)["\']\\)/g) || 
                           code.match(/Console\\.WriteLine\\(\\$["\'](.*?)["\']\\)/g) ||
                           [];
            
            matches.forEach(match => {
                // Extraer contenido dentro de las comillas
                const contentMatch = match.match(/["\'](.*?)["\']/);
                if (contentMatch) {
                    // Reemplazar interpolaciones básicas
                    let content = contentMatch[1];
                    content = content.replace(/\\\\{.*?\\\\}/g, \'[VARIABLE]\');
                    consoleOutput += content + \'\\\\n\';
                }
            });
            
            // Si no hay Console.WriteLine, mostrar mensaje
            if (!consoleOutput) {
                consoleOutput = "⚠️ No se encontraron Console.WriteLine\\\\n";
                consoleOutput += "El código se compiló pero no produce salida visible.\\\\n";
            }
            
            // Mostrar salida
            output.innerHTML = `<pre>${consoleOutput}</pre>`;
            
            // Estadísticas simuladas
            const time = Math.floor(Math.random() * 100) + 50;
            const memory = (Math.random() * 10 + 5).toFixed(2);
            
            document.getElementById(\'dataTime\').textContent = `${time} ms`;
            document.getElementById(\'dataMemory\').textContent = `${memory} MB`;
            
            stats.innerHTML = `
                <div class="stat-item">
                    <span>Tiempo compilación:</span>
                    <span class="stat-value">${time} ms</span>
                </div>
                <div class="stat-item">
                    <span>Memoria usada:</span>
                    <span class="stat-value">${memory} MB</span>
                </div>
                <div class="stat-item">
                    <span>Errores:</span>
                    <span class="stat-value">0</span>
                </div>
            `;
            
            console.log(`✅ Ejecución simulada: ${lines} líneas, ${time}ms`);
            
        }, 800);
    }
    
    function cargarEjemplo() {
        const select = document.getElementById(\'ejemploSelect\');
        const ejemplo = select.value;
        
        if (ejemplo && ejemplosCS[ejemplo]) {
            const editor = document.getElementById(\'csEditor\');
            editor.value = ejemplosCS[ejemplo].codigo;
            
            // Actualizar contadores
            actualizarContadores();
            
            // Mostrar descripción
            const output = document.getElementById(\'consoleOutput\');
            output.innerHTML = `<div class="cs-info">📋 Ejemplo cargado: ${ejemplosCS[ejemplo].descripcion}</div>`;
        }
    }
    
    function cargarEjemploCode(tipo) {
        if (ejemplosCS[tipo]) {
            const editor = document.getElementById(\'csEditor\');
            editor.value = ejemplosCS[tipo].codigo;
            actualizarContadores();
            
            const output = document.getElementById(\'consoleOutput\');
            output.innerHTML = `<div class="cs-info">✅ Ejemplo cargado: ${ejemplosCS[tipo].descripcion}</div>`;
        }
    }
    
    function ejemploAleatorio() {
        const keys = Object.keys(ejemplosCS);
        const randomKey = keys[Math.floor(Math.random() * keys.length)];
        cargarEjemploCode(randomKey);
    }
    
    function reiniciarEditor() {
        const editor = document.getElementById(\'csEditor\');
        editor.value = `using System;

namespace SimuladorCS
{
    public class Program
    {
        public static void Main()
        {
            Console.WriteLine("🔄 Editor reiniciado");
            Console.WriteLine("Escribe tu código C# aquí...");
        }
    }
}`;
        
        actualizarContadores();
        document.getElementById(\'consoleOutput\').innerHTML = \'<div class="cs-info">Editor reiniciado. Listo para programar.</div>\';
    }
    
    function actualizarContadores() {
        const editor = document.getElementById(\'csEditor\');
        const text = editor.value;
        
        const charCount = text.length;
        const lineCount = text.split(\'\\\\n\').length;
        
        document.getElementById(\'charCount\').textContent = `${charCount} caracteres`;
        document.getElementById(\'lineCount\').textContent = `${lineCount} líneas`;
    }
    
    // Configurar eventos del editor
    document.addEventListener(\'DOMContentLoaded\', function() {
        const editor = document.getElementById(\'csEditor\');
        editor.addEventListener(\'input\', actualizarContadores);
        actualizarContadores();
    });
    
    function cambiarEditorTab(tab) {
        // Cambiar pestañas activas
        document.querySelectorAll(\'.editor-tab\').forEach(t => t.classList.remove(\'active\'));
        event.target.classList.add(\'active\');
        
        // Aquí cambiarías el contenido del editor según la pestaña
        // Por simplicidad, solo cambiamos la clase activa
    }
    
    // ========================================
    // ARQUITECTURA INTERACTIVA
    // ========================================
    
    const infoArquitectura = {
        codigo: {
            titulo: "CÓDIGO C#",
            descripcion: "Archivos .cs con clases, métodos, propiedades. Sintaxis moderna: records, pattern matching, nullable reference types.",
            tecnologias: ["C# 12", ".csproj", "Namespaces", "Usings"]
        },
        compilacion: {
            titulo: "COMPILACIÓN",
            descripcion: "Proceso de transformar código C# a IL (Intermediate Language). Comando: dotnet build o dotnet publish.",
            tecnologias: ["Roslyn Compiler", "MSBuild", "NuGet Packages", "dotnet CLI"]
        },
        il: {
            titulo: "IL CODE",
            descripcion: "Intermediate Language - código de bytes independiente de plataforma. Es el resultado de la compilación.",
            tecnologias: [".dll/.exe", "Metadata", "IL Instructions", "JIT compatible"]
        },
        clr: {
            titulo: "COMMON LANGUAGE RUNTIME",
            descripcion: "Motor de ejecución que convierte IL a código nativo. Gestiona memoria (GC), excepciones, seguridad.",
            tecnologias: ["JIT Compiler", "Garbage Collector", "Type Safety", "Exception Handling"]
        },
        aplicacion: {
            titulo: "APLICACIÓN .NET",
            descripcion: "Resultado final: Console app, Web API (ASP.NET Core), Desktop (WinForms/WPF), o Mobile (MAUI).",
            tecnologias: ["ASP.NET Core", "WinForms", "Blazor", "Unity", "Azure Functions"]
        }
    };
    
    function seleccionarNodo(nodo) {
        const info = infoArquitectura[nodo];
        if (!info) return;
        
        const infoDiv = document.getElementById(\'arquitecturaInfo\');
        infoDiv.innerHTML = `
            <h4 style="color:#39FF14; margin-top:0;">${info.titulo}</h4>
            <p>${info.descripcion}</p>
            <div style="display:flex; gap:8px; flex-wrap:wrap; margin-top:10px;">
                ${info.tecnologias.map(t => `<span style="background:rgba(57,255,20,0.2); padding:4px 8px; border-radius:4px; border:1px solid #39FF14;">${t}</span>`).join(\'\')}
            </div>
        `;
        
        // Resaltar nodo seleccionado
        document.querySelectorAll(\'.nodo-arquitectura\').forEach(n => {
            n.style.opacity = \'0.7\';
        });
        
        const nodoSeleccionado = document.getElementById(`nodo${nodo.charAt(0).toUpperCase() + nodo.slice(1)}`);
        if (nodoSeleccionado) {
            nodoSeleccionado.style.opacity = \'1\';
            nodoSeleccionado.style.transform = \'scale(1.05)\';
        }
    }
    
    // ========================================
    // SISTEMA DE RETOS
    // ========================================
    
    function toggleReto(header) {
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
    
    function mostrarSolucionReto(num) {
        const solucion = document.getElementById(`solucionReto${num}`);
        solucion.style.display = solucion.style.display === \'block\' ? \'none\' : \'block\';
    }
    
    // ========================================
    // AUTOEVALUACIÓN
    // ========================================
    
    function guardarAutoevaluacionCS() {
        const slider1 = document.getElementById(\'slider1\').value;
        const slider2 = document.getElementById(\'slider2\').value;
        const slider3 = document.getElementById(\'slider3\').value;
        
        const promedio = (parseInt(slider1) + parseInt(slider2) + parseInt(slider3)) / 3;
        
        let nivel = \'\';
        if (promedio >= 4) nivel = \'🚀 Avanzado\';
        else if (promedio >= 2.5) nivel = \'💪 Intermedio\';
        else nivel = \'📚 Principiante\';
        
        alert(`📊 AutoEvaluación C# guardada:\\\\n\\\\n` +
              `Sintaxis C#: ${slider1}/5\\\\n` +
              `ASP.NET Core: ${slider2}/5\\\\n` +
              `Entity Framework: ${slider3}/5\\\\n\\\\n` +
              `Promedio: ${promedio.toFixed(1)}/5\\\\n` +
              `Nivel estimado: ${nivel}\\\\n\\\\n` +
              `Revisa la ruta de aprendizaje recomendada.`);
        
        console.log(`💾 AutoEvaluación C# guardada: ${slider1}, ${slider2}, ${slider3}`);
    }
    
    // ========================================
    // INICIALIZACIÓN
    // ========================================
    
    console.log("🚀 Sistema C#/.NET Cyberpunk inicializado");
    console.log("📚 Lección: C# + .NET 2025 - Stack completo empresarial");
    console.log("⚡ Simulador interactivo, retos y arquitectura listos");
    
    // Tabla interactiva
    document.querySelectorAll(\'.tabla-cyberpunk tbody tr\').forEach(row => {
        row.addEventListener(\'click\', function() {
            const tipo = this.dataset.tipo;
            const info = document.getElementById(\'infoFramework\');
            
            const infoTextos = {
                consola: "Consola: Aplicaciones CLI, servicios en segundo plano, herramientas de automatización. Alta velocidad, baja sobrecarga.",
                web: "Web: APIs REST, aplicaciones MVC, microservicios, Blazor WebAssembly. Escalabilidad horizontal, contenedores Docker.",
                desktop: "Desktop: Aplicaciones Windows empresariales, software de escritorio. WinForms (rápido), WPF (moderno).",
                mobile: "Mobile: .NET MAUI para iOS, Android, Windows desde un solo código base. Xamarin.Forms evolucionado.",
                gaming: "Gaming: Unity con C# para juegos 2D/3D, realidad virtual, aplicaciones AR. Dominante en mercado móvil."
            };
            
            info.textContent = infoTextos[tipo] || "Información no disponible";
            info.style.animation = "highlight 0.5s";
            
            // Remover selección previa
            document.querySelectorAll(\'.tabla-cyberpunk tbody tr\').forEach(r => {
                r.classList.remove(\'selected\');
            });
            
            // Marcar fila seleccionada
            this.classList.add(\'selected\');
        });
    });
    
    // Métodos de separación interactivos
    document.querySelectorAll(\'.metodo-card\').forEach(card => {
        card.addEventListener(\'click\', function() {
            const metodo = this.dataset.metodo;
            
            // Mostrar información detallada
            const metodosInfo = {
                records: "Records (C# 9+): Inmutabilidad por defecto, value equality, with-expressions. Ideal para DTOs, mensajes.",
                patterns: "Pattern Matching: Switch expressions, property patterns, tuple patterns. Código más expresivo y seguro.",
                nullables: "Nullable Reference Types: Advertencias en tiempo de compilación para posibles NullReferenceException.",
                async: "Async/Await: Programación asíncrona sin callbacks hell. Task Parallel Library (TPL) para paralelismo.",
                linq: "LINQ: Language Integrated Queries. Query syntax o method syntax. Compatible con SQL, XML, colecciones.",
                generics: "Generics: Reutilización de código con tipos parametrizados. List<T>, Dictionary<K,V>, métodos genéricos."
            };
            
            alert(`⚡ ${this.querySelector(\'h4\').textContent}\\\\n\\\\n${metodosInfo[metodo] || "Información no disponible"}`);
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
    
    // Animación SVG arquitectura
    function animarArquitectura() {
        const paths = document.querySelectorAll(\'#arquitecturaSVG path\');
        paths.forEach((path, index) => {
            path.style.animation = `dash 2s ${index * 0.3}s forwards`;
        });
    }
    
    // Ejecutar animación al cargar
    setTimeout(animarArquitectura, 1000);
    
    </script>
    
</div>
<!-- FIN LECCIÓN CYBERPUNK -->',
    'ejercicios' => 
    array (
      0 => 
      array (
        'enunciado' => 'Hello World C#',
        'respuesta' => 'Console.WriteLine("Hello");',
      ),
      1 => 
      array (
        'enunciado' => 'using System para',
        'respuesta' => 'Acceder a Console',
      ),
      2 => 
      array (
        'enunciado' => 'Main es',
        'respuesta' => 'Punto de entrada',
      ),
      3 => 
      array (
        'enunciado' => 'Framework web',
        'respuesta' => 'ASP.NET Core',
      ),
      4 => 
      array (
        'enunciado' => 'Desktop con',
        'respuesta' => 'WinForms, WPF, MAUI',
      ),
      5 => 
      array (
        'enunciado' => 'Juegos con',
        'respuesta' => 'Unity',
      ),
      6 => 
      array (
        'enunciado' => 'dotnet new console',
        'respuesta' => 'Crea app consola',
      ),
      7 => 
      array (
        'enunciado' => 'var infiere',
        'respuesta' => 'Tipo automáticamente',
      ),
      8 => 
      array (
        'enunciado' => 'string interpolation',
        'respuesta' => '$"texto {var}"',
      ),
      9 => 
      array (
        'enunciado' => 'try-catch para',
        'respuesta' => 'Manejo errores',
      ),
      10 => 
      array (
        'enunciado' => 'SI: % empresas C#',
        'respuesta' => '82%',
      ),
      11 => 
      array (
        'enunciado' => 'Blazor ejecuta',
        'respuesta' => 'C# en navegador',
      ),
    ),
    'quiz' => 
    array (
      0 => 
      array (
        'pregunta' => 'C# es',
        'opciones' => 
        array (
          0 => 'Tipado estático',
          1 => 'Dinámico',
          2 => 'Interpretado',
          3 => 'Script',
        ),
        'correcta' => 'Tipado estático',
      ),
      1 => 
      array (
        'pregunta' => '.NET es',
        'opciones' => 
        array (
          0 => 'Multiplataforma',
          1 => 'Solo Windows',
          2 => 'Solo Linux',
          3 => 'Móvil',
        ),
        'correcta' => 'Multiplataforma',
      ),
      2 => 
      array (
        'pregunta' => 'Console.WriteLine',
        'opciones' => 
        array (
          0 => 'Imprime',
          1 => 'Lee',
          2 => 'Borra',
          3 => 'Nada',
        ),
        'correcta' => 'Imprime',
      ),
      3 => 
      array (
        'pregunta' => 'Main retorna',
        'opciones' => 
        array (
          0 => 'void',
          1 => 'int',
          2 => 'string',
          3 => 'bool',
        ),
        'correcta' => 'void',
      ),
      4 => 
      array (
        'pregunta' => 'ASP.NET para',
        'opciones' => 
        array (
          0 => 'Web',
          1 => 'Consola',
          2 => 'Juegos',
          3 => 'BD',
        ),
        'correcta' => 'Web',
      ),
      5 => 
      array (
        'pregunta' => 'MAUI para',
        'opciones' => 
        array (
          0 => 'Apps nativas',
          1 => 'Web',
          2 => 'Juegos',
          3 => 'CLI',
        ),
        'correcta' => 'Apps nativas',
      ),
      6 => 
      array (
        'pregunta' => 'Blazor usa',
        'opciones' => 
        array (
          0 => 'WebAssembly',
          1 => 'Node.js',
          2 => 'PHP',
          3 => 'Python',
        ),
        'correcta' => 'WebAssembly',
      ),
      7 => 
      array (
        'pregunta' => 'Unity usa',
        'opciones' => 
        array (
          0 => 'C#',
          1 => 'C++',
          2 => 'Java',
          3 => 'JS',
        ),
        'correcta' => 'C#',
      ),
      8 => 
      array (
        'pregunta' => 'var x = 5; x es',
        'opciones' => 
        array (
          0 => 'int',
          1 => 'string',
          2 => 'double',
          3 => 'object',
        ),
        'correcta' => 'int',
      ),
      9 => 
      array (
        'pregunta' => 'try-catch maneja',
        'opciones' => 
        array (
          0 => 'Excepciones',
          1 => 'Errores',
          2 => 'Nada',
          3 => 'Todo',
        ),
        'correcta' => 'Excepciones',
      ),
      10 => 
      array (
        'pregunta' => 'dotnet run',
        'opciones' => 
        array (
          0 => 'Ejecuta',
          1 => 'Compila',
          2 => 'Instala',
          3 => 'Borra',
        ),
        'correcta' => 'Ejecuta',
      ),
      11 => 
      array (
        'pregunta' => 'List<T> es',
        'opciones' => 
        array (
          0 => 'Colección genérica',
          1 => 'Arreglo',
          2 => 'Diccionario',
          3 => 'String',
        ),
        'correcta' => 'Colección genérica',
      ),
      12 => 
      array (
        'pregunta' => 'LINQ para',
        'opciones' => 
        array (
          0 => 'Consultas',
          1 => 'Diseño',
          2 => 'Red',
          3 => 'Archivos',
        ),
        'correcta' => 'Consultas',
      ),
      13 => 
      array (
        'pregunta' => 'async/await para',
        'opciones' => 
        array (
          0 => 'Asincronía',
          1 => 'Sincronía',
          2 => 'Hilos',
          3 => 'Procesos',
        ),
        'correcta' => 'Asincronía',
      ),
      14 => 
      array (
        'pregunta' => 'record es',
        'opciones' => 
        array (
          0 => 'Inmutable',
          1 => 'Mutable',
          2 => 'Clase',
          3 => 'Interfaz',
        ),
        'correcta' => 'Inmutable',
      ),
      15 => 
      array (
        'pregunta' => 'Nullable<int> permite',
        'opciones' => 
        array (
          0 => 'null',
          1 => 'Solo 0',
          2 => 'Nada',
          3 => 'Error',
        ),
        'correcta' => 'null',
      ),
      16 => 
      array (
        'pregunta' => 'C# 13 incluye',
        'opciones' => 
        array (
          0 => 'Primary constructors',
          1 => 'C# 1',
          2 => 'Nada',
          3 => 'Errores',
        ),
        'correcta' => 'Primary constructors',
      ),
      17 => 
      array (
        'pregunta' => '.NET 9 es',
        'opciones' => 
        array (
          0 => 'LTS',
          1 => 'Preview',
          2 => 'Obsoleto',
          3 => 'Móvil',
        ),
        'correcta' => 'LTS',
      ),
      18 => 
      array (
        'pregunta' => 'SI 2025: C# en',
        'opciones' => 
        array (
          0 => 'Top 5 lenguajes',
          1 => 'Top 20',
          2 => 'Obsoleto',
          3 => 'Solo juegos',
        ),
        'correcta' => 'Top 5 lenguajes',
      ),
      19 => 
      array (
        'pregunta' => 'Empresas con C#',
        'opciones' => 
        array (
          0 => 'Microsoft, Stack Overflow',
          1 => 'Solo startups',
          2 => 'Ninguna',
          3 => 'Apple',
        ),
        'correcta' => 'Microsoft, Stack Overflow',
      ),
      20 => 
      array (
        'pregunta' => 'Visual Studio es',
        'opciones' => 
        array (
          0 => 'IDE oficial',
          1 => 'Editor texto',
          2 => 'Navegador',
          3 => 'BD',
        ),
        'correcta' => 'IDE oficial',
      ),
      21 => 
      array (
        'pregunta' => 'VS Code con',
        'opciones' => 
        array (
          0 => 'C# Dev Kit',
          1 => 'Python',
          2 => 'Java',
          3 => 'Nada',
        ),
        'correcta' => 'C# Dev Kit',
      ),
      22 => 
      array (
        'pregunta' => 'Azure para',
        'opciones' => 
        array (
          0 => 'Cloud Microsoft',
          1 => 'Local',
          2 => 'AWS',
          3 => 'Google',
        ),
        'correcta' => 'Cloud Microsoft',
      ),
      23 => 
      array (
        'pregunta' => 'Entity Framework',
        'opciones' => 
        array (
          0 => 'ORM',
          1 => 'Diseño',
          2 => 'Red',
          3 => 'Juegos',
        ),
        'correcta' => 'ORM',
      ),
      24 => 
      array (
        'pregunta' => 'xUnit para',
        'opciones' => 
        array (
          0 => 'Pruebas unitarias',
          1 => 'UI',
          2 => 'BD',
          3 => 'Red',
        ),
        'correcta' => 'Pruebas unitarias',
      ),
      25 => 
      array (
        'pregunta' => 'Minimal APIs',
        'opciones' => 
        array (
          0 => 'ASP.NET simple',
          1 => 'Complejas',
          2 => 'Consola',
          3 => 'Juegos',
        ),
        'correcta' => 'ASP.NET simple',
      ),
      26 => 
      array (
        'pregunta' => 'Hot Reload',
        'opciones' => 
        array (
          0 => 'Cambios en vivo',
          1 => 'Compilar',
          2 => 'Nada',
          3 => 'Error',
        ),
        'correcta' => 'Cambios en vivo',
      ),
      27 => 
      array (
        'pregunta' => 'SI 2025: % devs C#',
        'opciones' => 
        array (
          0 => '+12M',
          1 => '1M',
          2 => '100K',
          3 => '0',
        ),
        'correcta' => '+12M',
      ),
      28 => 
      array (
        'pregunta' => 'C# ideal para',
        'opciones' => 
        array (
          0 => 'Empresas, juegos, web',
          1 => 'Solo web',
          2 => 'Solo móvil',
          3 => 'Nada',
        ),
        'correcta' => 'Empresas, juegos, web',
      ),
      29 => 
      array (
        'pregunta' => 'Futuro C#',
        'opciones' => 
        array (
          0 => 'Cloud, IA, Web',
          1 => 'Obsoleto',
          2 => 'Solo desktop',
          3 => 'Móvil',
        ),
        'correcta' => 'Cloud, IA, Web',
      ),
    ),
  ),
  6 => 
  array (
    'materia' => 'Programación',
    'slug' => 'js-animaciones-avanzadas',
    'titulo' => 'JavaScript Animaciones Avanzadas: requestAnimationFrame, GSAP, Canvas y Física Digital',
    'contenido' => '<!-- INICIO LECCIÓN CYBERPUNK JS ANIMACIONES -->
<div class="leccion-container leccion-js-animaciones" data-tema="js-animaciones">

    <!-- HEADER COMPACTO -->
    <header class="leccion-header-compact">
        <h1 class="titulo-leccion neon-glow">
            <span class="icon-tema">🎮</span>
            ANIMACIONES JS 2025
        </h1>
        <div class="subtitulo-compact">
            requestAnimationFrame, GSAP, Canvas, Web Animations API
        </div>
    </header>

    <!-- ESTADÍSTICAS RÁPIDAS -->
    <div class="stats-bar">
        <div class="stat-item">
            <span class="stat-icon">⚡</span>
            <span class="stat-value">94%</span>
            <span class="stat-label">Sitios top usan JS anim</span>
        </div>
        <div class="stat-item">
            <span class="stat-icon">🎯</span>
            <span class="stat-value">60 FPS</span>
            <span class="stat-label">requestAnimationFrame</span>
        </div>
        <div class="stat-item">
            <span class="stat-icon">🚀</span>
            <span class="stat-value">+300%</span>
            <span class="stat-label">Performance vs CSS</span>
        </div>
    </div>

    <!-- SIMULADOR INTERACTIVO MEJORADO -->
    <section class="simulador-section">
        <h2 class="seccion-titulo neon-interactivo">
            <span class="icon">🔄</span> SIMULADOR FÍSICA EN TIEMPO REAL
        </h2>
        
        <div class="simulador-grid">
            <!-- PANEL DE CONTROLES -->
            <div class="controls-panel">
                <h3>CONTROLES FÍSICOS</h3>
                
                <div class="control-group">
                    <label for="gravity">Gravedad:</label>
                    <input type="range" id="gravity" min="0" max="2" step="0.1" value="0.5" class="control-slider">
                    <span class="slider-value" id="gravityValue">0.5</span>
                </div>
                
                <div class="control-group">
                    <label for="friction">Fricción:</label>
                    <input type="range" id="friction" min="0.7" max="0.99" step="0.01" value="0.9" class="control-slider">
                    <span class="slider-value" id="frictionValue">0.90</span>
                </div>
                
                <div class="control-group">
                    <label for="spring">Resorte:</label>
                    <input type="range" id="spring" min="0.01" max="0.3" step="0.01" value="0.1" class="control-slider">
                    <span class="slider-value" id="springValue">0.10</span>
                </div>
                
                <div class="buttons-grid">
                    <button class="btn-action" onclick="startAnimation()">
                        <span class="btn-icon">▶</span> Iniciar
                    </button>
                    <button class="btn-action secondary" onclick="pauseAnimation()">
                        <span class="btn-icon">⏸</span> Pausar
                    </button>
                    <button class="btn-action danger" onclick="resetAnimation()">
                        <span class="btn-icon">🔄</span> Reiniciar
                    </button>
                    <button class="btn-action info" onclick="randomizeParams()">
                        <span class="btn-icon">🎲</span> Aleatorio
                    </button>
                </div>
            </div>
            
            <!-- ÁREA DE SIMULACIÓN -->
            <div class="simulation-area">
                <div class="simulation-canvas" id="simCanvas">
                    <!-- Canvas será insertado aquí -->
                </div>
                <div class="simulation-info">
                    <div class="info-item">
                        <span class="info-label">FPS:</span>
                        <span class="info-value" id="fpsCounter">60</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Partículas:</span>
                        <span class="info-value" id="particleCount">1</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Energía:</span>
                        <span class="info-value" id="energyLevel">100%</span>
                    </div>
                </div>
            </div>
            
            <!-- DATOS EN TIEMPO REAL -->
            <div class="data-panel">
                <h3>DATOS FÍSICOS</h3>
                
                <div class="data-grid">
                    <div class="data-card">
                        <div class="data-icon">📊</div>
                        <div class="data-content">
                            <div class="data-label">Velocidad X</div>
                            <div class="data-value" id="velocityX">0.00</div>
                        </div>
                    </div>
                    
                    <div class="data-card">
                        <div class="data-icon">📈</div>
                        <div class="data-content">
                            <div class="data-label">Velocidad Y</div>
                            <div class="data-value" id="velocityY">0.00</div>
                        </div>
                    </div>
                    
                    <div class="data-card">
                        <div class="data-icon">🎯</div>
                        <div class="data-content">
                            <div class="data-label">Posición X</div>
                            <div class="data-value" id="positionX">50</div>
                        </div>
                    </div>
                    
                    <div class="data-card">
                        <div class="data-icon">📍</div>
                        <div class="data-content">
                            <div class="data-label">Posición Y</div>
                            <div class="data-value" id="positionY">150</div>
                        </div>
                    </div>
                    
                    <div class="data-card highlight">
                        <div class="data-icon">⚡</div>
                        <div class="data-content">
                            <div class="data-label">Energía cinética</div>
                            <div class="data-value" id="kineticEnergy">0.00</div>
                        </div>
                    </div>
                    
                    <div class="data-card">
                        <div class="data-icon">🔄</div>
                        <div class="data-content">
                            <div class="data-label">Frame actual</div>
                            <div class="data-value" id="frameCount">0</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- COMPARATIVA DE MÉTODOS -->
    <section class="comparativa-section">
        <h2 class="seccion-titulo neon-concepto">
            <span class="icon">📊</span> MÉTODOS DE ANIMACIÓN JS 2025
        </h2>
        
        <div class="metodos-grid">
            <div class="metodo-card" data-metodo="raf">
                <div class="metodo-header">
                    <h4>requestAnimationFrame</h4>
                    <span class="metodo-badge">60 FPS</span>
                </div>
                <div class="metodo-body">
                    <div class="metodo-icon">🎮</div>
                    <div class="metodo-desc">
                        Ciclo de animación nativo del navegador
                    </div>
                    <ul class="metodo-features">
                        <li>Sincronizado con refresh rate</li>
                        <li>Optimizado por GPU</li>
                        <li>Pausa en tabs ocultos</li>
                    </ul>
                </div>
                <div class="metodo-code">
                    <pre><code>function animate() {
    // Código de animación
    requestAnimationFrame(animate);
}
animate();</code></pre>
                </div>
            </div>
            
            <div class="metodo-card" data-metodo="gsap">
                <div class="metodo-header">
                    <h4>GSAP</h4>
                    <span class="metodo-badge">Premium</span>
                </div>
                <div class="metodo-body">
                    <div class="metodo-icon">🚀</div>
                    <div class="metodo-desc">
                        Biblioteca profesional para animaciones complejas
                    </div>
                    <ul class="metodo-features">
                        <li>Timelines y secuencias</li>
                        <li>Easing avanzado</li>
                        <li>Cross-browser</li>
                    </ul>
                </div>
                <div class="metodo-code">
                    <pre><code>gsap.to(".element", {
    duration: 1,
    x: 100,
    rotation: 360
});</code></pre>
                </div>
            </div>
            
            <div class="metodo-card" data-metodo="webapi">
                <div class="metodo-header">
                    <h4>Web Animations API</h4>
                    <span class="metodo-badge">Nativo</span>
                </div>
                <div class="metodo-body">
                    <div class="metodo-icon">⚡</div>
                    <div class="metodo-desc">
                        API moderna del navegador para animaciones
                    </div>
                    <ul class="metodo-features">
                        <li>Performance óptima</li>
                        <li>Control preciso</li>
                        <li>Built-in en navegadores</li>
                    </ul>
                </div>
                <div class="metodo-code">
                    <pre><code>element.animate([
    { transform: \'translateX(0)\' },
    { transform: \'translateX(100px)\' }
], 1000);</code></pre>
                </div>
            </div>
            
            <div class="metodo-card" data-metodo="canvas">
                <div class="metodo-header">
                    <h4>Canvas 2D</h4>
                    <span class="metodo-badge">Gráficos</span>
                </div>
                <div class="metodo-body">
                    <div class="metodo-icon">🎨</div>
                    <div class="metodo-desc">
                        Gráficos vectoriales y de partículas
                    </div>
                    <ul class="metodo-features">
                        <li>Juegos 2D</li>
                        <li>Visualizaciones de datos</li>
                        <li>Efectos de partículas</li>
                    </ul>
                </div>
                <div class="metodo-code">
                    <pre><code>function draw() {
    ctx.clearRect(0, 0, w, h);
    // Dibujar frame
    requestAnimationFrame(draw);
}</code></pre>
                </div>
            </div>
            
            <div class="metodo-card" data-metodo="css">
                <div class="metodo-header">
                    <h4>CSS Transitions</h4>
                    <span class="metodo-badge">Simple</span>
                </div>
                <div class="metodo-body">
                    <div class="metodo-icon">🎯</div>
                    <div class="metodo-desc">
                        Animaciones básicas con transiciones CSS
                    </div>
                    <ul class="metodo-features">
                        <li>Fácil implementación</li>
                        <li>GPU acelerado</li>
                        <li>Bajo overhead</li>
                    </ul>
                </div>
                <div class="metodo-code">
                    <pre><code>.element {
    transition: transform 0.3s ease;
}
.element:hover {
    transform: scale(1.1);
}</code></pre>
                </div>
            </div>
            
            <div class="metodo-card" data-metodo="threejs">
                <div class="metodo-header">
                    <h4>Three.js</h4>
                    <span class="metodo-badge">3D</span>
                </div>
                <div class="metodo-body">
                    <div class="metodo-icon">🌟</div>
                    <div class="metodo-desc">
                        Gráficos 3D en el navegador
                    </div>
                    <ul class="metodo-features">
                        <li>WebGL wrapper</li>
                        <li>Animaciones 3D</li>
                        <li>VR/AR compatible</li>
                    </ul>
                </div>
                <div class="metodo-code">
                    <pre><code>function render() {
    renderer.render(scene, camera);
    requestAnimationFrame(render);
}</code></pre>
                </div>
            </div>
        </div>
    </section>

    <!-- DEMOSTRACIONES INTERACTIVAS -->
    <section class="demos-section">
        <h2 class="seccion-titulo neon-ejemplo">
            <span class="icon">🎬</span> DEMOSTRACIONES INTERACTIVAS
        </h2>
        
        <div class="demos-container">
            <div class="demo-card" id="demoParticles">
                <div class="demo-header">
                    <h4>🎨 Sistema de Partículas</h4>
                    <button class="demo-toggle" onclick="toggleDemo(\'particles\')">▶</button>
                </div>
                <div class="demo-content">
                    <canvas id="particlesCanvas" width="400" height="200"></canvas>
                    <div class="demo-controls">
                        <button onclick="addParticle()">➕ Partícula</button>
                        <button onclick="clearParticles()">🗑️ Limpiar</button>
                        <span id="particleStats">0 partículas</span>
                    </div>
                </div>
            </div>
            
            <div class="demo-card" id="demoScroll">
                <div class="demo-header">
                    <h4>📜 Scroll Animations</h4>
                    <button class="demo-toggle" onclick="toggleDemo(\'scroll\')">▶</button>
                </div>
                <div class="demo-content">
                    <div class="scroll-demo">
                        <div class="scroll-item reveal">🎯 Elemento 1</div>
                        <div class="scroll-item reveal">🚀 Elemento 2</div>
                        <div class="scroll-item reveal">⚡ Elemento 3</div>
                        <div class="scroll-item reveal">🌟 Elemento 4</div>
                    </div>
                    <div class="demo-info">
                        <span id="scrollProgress">Scroll: 0%</span>
                    </div>
                </div>
            </div>
            
            <div class="demo-card" id="demoPhysics">
                <div class="demo-header">
                    <h4>⚛️ Física Realista</h4>
                    <button class="demo-toggle" onclick="toggleDemo(\'physics\')">▶</button>
                </div>
                <div class="demo-content">
                    <div class="physics-box" id="physicsBox">
                        <div class="physics-ball"></div>
                    </div>
                    <div class="demo-controls">
                        <button onclick="applyForce()">💥 Aplicar fuerza</button>
                        <button onclick="resetPhysics()">🔄 Reiniciar</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- RETOS DE PROGRAMACIÓN -->
    <section class="retos-section">
        <h2 class="seccion-titulo neon-alerta">
            <span class="icon">💻</span> RETOS DE ANIMACIÓN JS
        </h2>
        
        <div class="retos-container">
            <div class="reto-card">
                <div class="reto-header" onclick="toggleReto(this)">
                    <h3>🎯 RETO 1: Animación de Carga Fluida</h3>
                    <span class="reto-toggle">+</span>
                </div>
                <div class="reto-content">
                    <div class="reto-desc">
                        <p><strong>Objetivo:</strong> Crear un loader animado que:</p>
                        <ul>
                            <li>Use requestAnimationFrame para 60 FPS</li>
                            <li>Implemente easing functions personalizadas</li>
                            <li>Sea responsive y suave</li>
                            <li>Incluya progreso en tiempo real</li>
                        </ul>
                    </div>
                    <div class="reto-code">
                        <pre><code>// Esqueleto del reto
class ProgressLoader {
    constructor(element) {
        this.element = element;
        this.progress = 0;
        this.animate();
    }
    
    animate() {
        // Tu código aquí
    }
}</code></pre>
                    </div>
                    <button class="btn-mini" onclick="mostrarSolucionReto(1)">Ver solución</button>
                    <div class="solucion" id="solucionReto1" style="display: none;">
                        <pre><code>class ProgressLoader {
    constructor(element) {
        this.element = element;
        this.progress = 0;
        this.target = 1;
        this.easing = t => t * t * (3 - 2 * t);
        this.animate();
    }
    
    animate() {
        const delta = (this.target - this.progress) * 0.1;
        this.progress += delta;
        
        const eased = this.easing(this.progress);
        this.element.style.width = `${eased * 100}%`;
        
        if (Math.abs(delta) > 0.001) {
            requestAnimationFrame(() => this.animate());
        }
    }
}</code></pre>
                    </div>
                </div>
            </div>
            
            <div class="reto-card">
                <div class="reto-header" onclick="toggleReto(this)">
                    <h3>🎯 RETO 2: Scroll Reveal Avanzado</h3>
                    <span class="reto-toggle">+</span>
                </div>
                <div class="reto-content">
                    <div class="reto-desc">
                        <p><strong>Objetivo:</strong> Implementar sistema de revelado al scroll con:</p>
                        <ul>
                            <li>Intersection Observer API</li>
                            <li>Animaciones por pasos</li>
                            <li>Efectos parallax</li>
                            <li>Lazy loading de imágenes</li>
                        </ul>
                    </div>
                    <div class="reto-code">
                        <pre><code>// Esqueleto del reto
class ScrollReveal {
    constructor() {
        this.observer = new IntersectionObserver();
        this.init();
    }
    
    init() {
        // Tu código aquí
    }
}</code></pre>
                    </div>
                    <button class="btn-mini" onclick="mostrarSolucionReto(2)">Ver solución</button>
                    <div class="solucion" id="solucionReto2" style="display: none;">
                        <pre><code>class ScrollReveal {
    constructor() {
        this.observer = new IntersectionObserver(
            entries => entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = 1;
                    entry.target.style.transform = \'translateY(0)\';
                }
            }),
            { threshold: 0.1 }
        );
        this.init();
    }
    
    init() {
        document.querySelectorAll(\'.reveal\')
            .forEach(el => this.observer.observe(el));
    }
}</code></pre>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- JAVASCRIPT INTEGRADO -->
    <script>
    // ========================================
    // SISTEMA DE SIMULACIÓN FÍSICA
    // ========================================
    
    let animationId = null;
    let isAnimating = false;
    let frameCount = 0;
    let lastTime = 0;
    let fps = 60;
    
    // Parámetros físicos
    const params = {
        gravity: 0.5,
        friction: 0.9,
        spring: 0.1,
        targetX: 400,
        targetY: 150
    };
    
    // Estado de la partícula
    const particle = {
        x: 50,
        y: 150,
        vx: 0,
        vy: 0,
        radius: 15
    };
    
    // Configurar canvas
    function initCanvas() {
        const canvas = document.createElement(\'canvas\');
        canvas.width = 600;
        canvas.height = 300;
        canvas.style.borderRadius = \'8px\';
        canvas.style.background = \'#1a1a2e\';
        
        const container = document.getElementById(\'simCanvas\');
        container.innerHTML = \'\';
        container.appendChild(canvas);
        
        return canvas.getContext(\'2d\');
    }
    
    const ctx = initCanvas();
    
    // Actualizar controles
    document.querySelectorAll(\'.control-slider\').forEach(slider => {
        slider.addEventListener(\'input\', function() {
            const value = this.value;
            const display = this.id + \'Value\';
            document.getElementById(display).textContent = parseFloat(value).toFixed(2);
            params[this.id] = parseFloat(value);
        });
    });
    
    // Dibujar partícula
    function drawParticle() {
        ctx.clearRect(0, 0, 600, 300);
        
        // Dibujar área de simulación
        ctx.fillStyle = \'#1a1a2e\';
        ctx.fillRect(0, 0, 600, 300);
        
        // Dibujar grid
        ctx.strokeStyle = \'rgba(57, 255, 20, 0.1)\';
        ctx.lineWidth = 1;
        for (let x = 0; x < 600; x += 30) {
            ctx.beginPath();
            ctx.moveTo(x, 0);
            ctx.lineTo(x, 300);
            ctx.stroke();
        }
        for (let y = 0; y < 300; y += 30) {
            ctx.beginPath();
            ctx.moveTo(0, y);
            ctx.lineTo(600, y);
            ctx.stroke();
        }
        
        // Dibujar punto objetivo
        ctx.fillStyle = \'rgba(255, 0, 255, 0.3)\';
        ctx.beginPath();
        ctx.arc(params.targetX, params.targetY, 8, 0, Math.PI * 2);
        ctx.fill();
        
        // Dibujar partícula
        const gradient = ctx.createRadialGradient(
            particle.x, particle.y, 0,
            particle.x, particle.y, particle.radius
        );
        gradient.addColorStop(0, \'#39FF14\');
        gradient.addColorStop(1, \'#178600\');
        
        ctx.fillStyle = gradient;
        ctx.beginPath();
        ctx.arc(particle.x, particle.y, particle.radius, 0, Math.PI * 2);
        ctx.fill();
        
        // Dibujar vector de velocidad
        ctx.strokeStyle = \'#FF00FF\';
        ctx.lineWidth = 2;
        ctx.beginPath();
        ctx.moveTo(particle.x, particle.y);
        ctx.lineTo(
            particle.x + particle.vx * 10,
            particle.y + particle.vy * 10
        );
        ctx.stroke();
        
        // Dibujar información
        ctx.fillStyle = \'#00FFFF\';
        ctx.font = \'12px monospace\';
        ctx.fillText(`FPS: ${Math.round(fps)}`, 10, 20);
        ctx.fillText(`Frame: ${frameCount}`, 10, 40);
    }
    
    // Actualizar física
    function updatePhysics() {
        const dx = params.targetX - particle.x;
        const dy = params.targetY - particle.y;
        
        // Aplicar resorte
        particle.vx += dx * params.spring;
        particle.vy += dy * params.spring;
        
        // Aplicar gravedad
        particle.vy += params.gravity;
        
        // Aplicar fricción
        particle.vx *= params.friction;
        particle.vy *= params.friction;
        
        // Actualizar posición
        particle.x += particle.vx;
        particle.y += particle.vy;
        
        // Colisiones con bordes
        if (particle.x < particle.radius) {
            particle.x = particle.radius;
            particle.vx = -particle.vx * 0.8;
        }
        if (particle.x > 600 - particle.radius) {
            particle.x = 600 - particle.radius;
            particle.vx = -particle.vx * 0.8;
        }
        if (particle.y < particle.radius) {
            particle.y = particle.radius;
            particle.vy = -particle.vy * 0.8;
        }
        if (particle.y > 300 - particle.radius) {
            particle.y = 300 - particle.radius;
            particle.vy = -particle.vy * 0.8;
        }
        
        // Actualizar datos en pantalla
        updateDisplay();
    }
    
    // Actualizar display
    function updateDisplay() {
        document.getElementById(\'velocityX\').textContent = particle.vx.toFixed(2);
        document.getElementById(\'velocityY\').textContent = particle.vy.toFixed(2);
        document.getElementById(\'positionX\').textContent = Math.round(particle.x);
        document.getElementById(\'positionY\').textContent = Math.round(particle.y);
        document.getElementById(\'kineticEnergy\').textContent = 
            (0.5 * (particle.vx * particle.vx + particle.vy * particle.vy)).toFixed(2);
        document.getElementById(\'frameCount\').textContent = frameCount;
    }
    
    // Calcular FPS
    function calculateFPS(timestamp) {
        if (lastTime !== 0) {
            const delta = timestamp - lastTime;
            fps = 1000 / delta;
        }
        lastTime = timestamp;
        document.getElementById(\'fpsCounter\').textContent = Math.round(fps);
    }
    
    // Loop de animación
    function animate(timestamp) {
        if (!isAnimating) return;
        
        calculateFPS(timestamp);
        updatePhysics();
        drawParticle();
        frameCount++;
        
        animationId = requestAnimationFrame(animate);
    }
    
    // Controles de animación
    function startAnimation() {
        if (!isAnimating) {
            isAnimating = true;
            lastTime = 0;
            animationId = requestAnimationFrame(animate);
        }
    }
    
    function pauseAnimation() {
        isAnimating = false;
        if (animationId) {
            cancelAnimationFrame(animationId);
        }
    }
    
    function resetAnimation() {
        pauseAnimation();
        particle.x = 50;
        particle.y = 150;
        particle.vx = 0;
        particle.vy = 0;
        frameCount = 0;
        drawParticle();
        updateDisplay();
    }
    
    function randomizeParams() {
        params.gravity = Math.random() * 2;
        params.friction = 0.7 + Math.random() * 0.29;
        params.spring = 0.01 + Math.random() * 0.29;
        params.targetX = 100 + Math.random() * 400;
        params.targetY = 50 + Math.random() * 200;
        
        // Actualizar sliders
        document.getElementById(\'gravity\').value = params.gravity;
        document.getElementById(\'friction\').value = params.friction;
        document.getElementById(\'spring\').value = params.spring;
        
        document.getElementById(\'gravityValue\').textContent = params.gravity.toFixed(2);
        document.getElementById(\'frictionValue\').textContent = params.friction.toFixed(2);
        document.getElementById(\'springValue\').textContent = params.spring.toFixed(2);
    }
    
    // Inicializar
    drawParticle();
    updateDisplay();
    
    // ========================================
    // DEMOS INTERACTIVAS
    // ========================================
    
    // Sistema de partículas
    const particles = [];
    const particlesCtx = document.getElementById(\'particlesCanvas\').getContext(\'2d\');
    let particlesAnimating = false;
    
    function addParticle() {
        particles.push({
            x: Math.random() * 400,
            y: Math.random() * 200,
            vx: (Math.random() - 0.5) * 4,
            vy: (Math.random() - 0.5) * 4,
            radius: 5 + Math.random() * 10,
            color: `hsl(${Math.random() * 360}, 100%, 60%)`
        });
        
        updateParticleStats();
        
        if (!particlesAnimating && particles.length > 0) {
            particlesAnimating = true;
            animateParticles();
        }
    }
    
    function animateParticles() {
        if (!particlesAnimating || particles.length === 0) {
            particlesAnimating = false;
            return;
        }
        
        particlesCtx.clearRect(0, 0, 400, 200);
        particlesCtx.fillStyle = \'#1a1a2e\';
        particlesCtx.fillRect(0, 0, 400, 200);
        
        particles.forEach((p, i) => {
            // Actualizar posición
            p.x += p.vx;
            p.y += p.vy;
            
            // Colisiones con bordes
            if (p.x < p.radius || p.x > 400 - p.radius) p.vx *= -1;
            if (p.y < p.radius || p.y > 200 - p.radius) p.vy *= -1;
            
            // Dibujar partícula
            particlesCtx.fillStyle = p.color;
            particlesCtx.beginPath();
            particlesCtx.arc(p.x, p.y, p.radius, 0, Math.PI * 2);
            particlesCtx.fill();
        });
        
        requestAnimationFrame(animateParticles);
    }
    
    function clearParticles() {
        particles.length = 0;
        particlesCtx.clearRect(0, 0, 400, 200);
        particlesCtx.fillStyle = \'#1a1a2e\';
        particlesCtx.fillRect(0, 0, 400, 200);
        updateParticleStats();
        particlesAnimating = false;
    }
    
    function updateParticleStats() {
        document.getElementById(\'particleStats\').textContent = 
            `${particles.length} partículas`;
        document.getElementById(\'particleCount\').textContent = particles.length;
    }
    
    // Scroll animations
    const scrollItems = document.querySelectorAll(\'.scroll-item\');
    let scrollObserver;
    
    function initScrollAnimations() {
        scrollObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = 1;
                    entry.target.style.transform = \'translateY(0)\';
                }
            });
        }, { threshold: 0.2 });
        
        scrollItems.forEach(item => {
            item.style.opacity = 0;
            item.style.transform = \'translateY(30px)\';
            item.style.transition = \'all 0.6s ease\';
            scrollObserver.observe(item);
        });
        
        // Monitor de scroll
        window.addEventListener(\'scroll\', () => {
            const scrollPercent = 
                (window.scrollY / (document.body.scrollHeight - window.innerHeight)) * 100;
            document.getElementById(\'scrollProgress\').textContent = 
                `Scroll: ${Math.round(scrollPercent)}%`;
        });
    }
    
    // Física demo
    function applyForce() {
        const ball = document.querySelector(\'.physics-ball\');
        ball.style.transform = \'translateX(200px) rotate(360deg)\';
        setTimeout(() => {
            ball.style.transform = \'translateX(0) rotate(0deg)\';
        }, 800);
    }
    
    function resetPhysics() {
        const ball = document.querySelector(\'.physics-ball\');
        ball.style.transform = \'translateX(0) rotate(0deg)\';
    }
    
    // Toggle demos
    function toggleDemo(type) {
        const button = event.target;
        const demo = button.closest(\'.demo-card\');
        
        if (demo.classList.contains(\'active\')) {
            demo.classList.remove(\'active\');
            button.textContent = \'▶\';
            
            if (type === \'particles\') {
                particlesAnimating = false;
            }
        } else {
            demo.classList.add(\'active\');
            button.textContent = \'⏸\';
            
            if (type === \'particles\' && particles.length > 0) {
                particlesAnimating = true;
                animateParticles();
            }
            
            if (type === \'scroll\') {
                initScrollAnimations();
            }
        }
    }
    
    // ========================================
    // RETOS INTERACTIVOS
    // ========================================
    
    function toggleReto(header) {
        const content = header.nextElementSibling;
        const toggle = header.querySelector(\'.reto-toggle\');
        
        if (content.style.display === \'block\') {
            content.style.display = \'none\';
            toggle.textContent = \'+\';
        } else {
            content.style.display = \'block\';
            toggle.textContent = \'-\';
        }
    }
    
    function mostrarSolucionReto(num) {
        const solucion = document.getElementById(`solucionReto${num}`);
        solucion.style.display = solucion.style.display === \'block\' ? \'none\' : \'block\';
    }
    
    // ========================================
    // INICIALIZACIÓN
    // ========================================
    
    console.log("🎮 Sistema de Animaciones JS inicializado");
    console.log("📊 Simulador físico, partículas y demos listos");
    console.log("⚡ FPS: 60, Métodos: requestAnimationFrame, GSAP, Canvas, WAAPI");
    
    // Inicializar algunas partículas por defecto
    setTimeout(() => {
        for (let i = 0; i < 3; i++) {
            addParticle();
        }
    }, 1000);
    
    </script>

</div>
<!-- FIN LECCIÓN CYBERPUNK JS ANIMACIONES -->',
    'ejercicios' => 
    array (
      0 => 
      array (
        'enunciado' => 'Animar con JS puro',
        'respuesta' => 'requestAnimationFrame(callback)',
      ),
      1 => 
      array (
        'enunciado' => 'Transición CSS',
        'respuesta' => 'element.style.transition = \'1s\'',
      ),
      2 => 
      array (
        'enunciado' => 'Agregar clase animada',
        'respuesta' => 'element.classList.add(\'animate\')',
      ),
      3 => 
      array (
        'enunciado' => 'GSAP to()',
        'respuesta' => 'gsap.to(target, {props})',
      ),
      4 => 
      array (
        'enunciado' => 'Canvas contexto',
        'respuesta' => 'ctx = canvas.getContext(\'2d\')',
      ),
      5 => 
      array (
        'enunciado' => 'Web Animations API',
        'respuesta' => 'element.animate(keyframes, options)',
      ),
      6 => 
      array (
        'enunciado' => 'Scroll event',
        'respuesta' => 'window.addEventListener(\'scroll\', fn)',
      ),
      7 => 
      array (
        'enunciado' => 'IntersectionObserver',
        'respuesta' => 'new IntersectionObserver(callback)',
      ),
      8 => 
      array (
        'enunciado' => 'Lottie para',
        'respuesta' => 'Animaciones JSON (After Effects)',
      ),
      9 => 
      array (
        'enunciado' => 'Three.js para',
        'respuesta' => '3D en navegador',
      ),
      10 => 
      array (
        'enunciado' => 'SI: % sitios con anim',
        'respuesta' => '94%',
      ),
      11 => 
      array (
        'enunciado' => '60 FPS =',
        'respuesta' => '16.67ms por frame',
      ),
    ),
    'quiz' => 
    array (
      0 => 
      array (
        'pregunta' => 'requestAnimationFrame',
        'opciones' => 
        array (
          0 => '60 FPS',
          1 => '30 FPS',
          2 => '1 FPS',
          3 => 'Variable',
        ),
        'correcta' => '60 FPS',
      ),
      1 => 
      array (
        'pregunta' => 'GSAP es',
        'opciones' => 
        array (
          0 => 'Biblioteca',
          1 => 'Nativo',
          2 => 'CSS',
          3 => 'HTML',
        ),
        'correcta' => 'Biblioteca',
      ),
      2 => 
      array (
        'pregunta' => 'animate() es',
        'opciones' => 
        array (
          0 => 'Web Animations API',
          1 => 'jQuery',
          2 => 'PHP',
          3 => 'React',
        ),
        'correcta' => 'Web Animations API',
      ),
      3 => 
      array (
        'pregunta' => 'Canvas para',
        'opciones' => 
        array (
          0 => 'Dibujo 2D/3D',
          1 => 'Texto',
          2 => 'Imágenes',
          3 => 'Todo',
        ),
        'correcta' => 'Dibujo 2D/3D',
      ),
      4 => 
      array (
        'pregunta' => 'transition en',
        'opciones' => 
        array (
          0 => 'CSS',
          1 => 'JS',
          2 => 'HTML',
          3 => 'SVG',
        ),
        'correcta' => 'CSS',
      ),
      5 => 
      array (
        'pregunta' => 'transform modifica',
        'opciones' => 
        array (
          0 => 'Posición, escala',
          1 => 'Color',
          2 => 'Texto',
          3 => 'Fuente',
        ),
        'correcta' => 'Posición, escala',
      ),
      6 => 
      array (
        'pregunta' => 'opacity de 0 a 1',
        'opciones' => 
        array (
          0 => 'Fade in',
          1 => 'Fade out',
          2 => 'Slide',
          3 => 'Rotate',
        ),
        'correcta' => 'Fade in',
      ),
      7 => 
      array (
        'pregunta' => 'Scroll reveal usa',
        'opciones' => 
        array (
          0 => 'IntersectionObserver',
          1 => 'setInterval',
          2 => 'setTimeout',
          3 => 'PHP',
        ),
        'correcta' => 'IntersectionObserver',
      ),
      8 => 
      array (
        'pregunta' => 'Lottie anima',
        'opciones' => 
        array (
          0 => 'JSON',
          1 => 'GIF',
          2 => 'MP4',
          3 => 'SVG',
        ),
        'correcta' => 'JSON',
      ),
      9 => 
      array (
        'pregunta' => 'Three.js es',
        'opciones' => 
        array (
          0 => 'WebGL',
          1 => 'Canvas',
          2 => 'CSS',
          3 => 'DOM',
        ),
        'correcta' => 'WebGL',
      ),
      10 => 
      array (
        'pregunta' => 'GSAP timeline',
        'opciones' => 
        array (
          0 => 'Secuencia',
          1 => 'Paralelo',
          2 => 'Aleatorio',
          3 => 'Única',
        ),
        'correcta' => 'Secuencia',
      ),
      11 => 
      array (
        'pregunta' => 'ease: "bounce"',
        'opciones' => 
        array (
          0 => 'GSAP',
          1 => 'CSS',
          2 => 'JS',
          3 => 'HTML',
        ),
        'correcta' => 'GSAP',
      ),
      12 => 
      array (
        'pregunta' => 'stagger en GSAP',
        'opciones' => 
        array (
          0 => 'Retraso secuencial',
          1 => 'Color',
          2 => 'Tamaño',
          3 => 'Nada',
        ),
        'correcta' => 'Retraso secuencial',
      ),
      13 => 
      array (
        'pregunta' => 'ScrollTrigger',
        'opciones' => 
        array (
          0 => 'GSAP plugin',
          1 => 'Nativo',
          2 => 'CSS',
          3 => 'React',
        ),
        'correcta' => 'GSAP plugin',
      ),
      14 => 
      array (
        'pregunta' => 'MorphSVGPlugin',
        'opciones' => 
        array (
          0 => 'Transforma SVG',
          1 => 'Dibuja',
          2 => 'Colorea',
          3 => 'Elimina',
        ),
        'correcta' => 'Transforma SVG',
      ),
      15 => 
      array (
        'pregunta' => 'Canvas vs SVG',
        'opciones' => 
        array (
          0 => 'Canvas: píxeles | SVG: vector',
          1 => 'Igual',
          2 => 'Canvas: vector',
          3 => 'SVG: píxeles',
        ),
        'correcta' => 'Canvas: píxeles | SVG: vector',
      ),
      16 => 
      array (
        'pregunta' => 'SI 2025: animaciones',
        'opciones' => 
        array (
          0 => '94% sitios',
          1 => '50%',
          2 => '10%',
          3 => '0%',
        ),
        'correcta' => '94% sitios',
      ),
      17 => 
      array (
        'pregunta' => 'Mejor performance',
        'opciones' => 
        array (
          0 => 'requestAnimationFrame',
          1 => 'setInterval',
          2 => 'setTimeout',
          3 => 'CSS',
        ),
        'correcta' => 'requestAnimationFrame',
      ),
      18 => 
      array (
        'pregunta' => 'CSS preferido para',
        'opciones' => 
        array (
          0 => 'Transiciones simples',
          1 => 'Juegos',
          2 => 'Partículas',
          3 => '3D',
        ),
        'correcta' => 'Transiciones simples',
      ),
      19 => 
      array (
        'pregunta' => 'GSAP ideal para',
        'opciones' => 
        array (
          0 => 'Complejas, timelines',
          1 => 'Fade',
          2 => 'Hover',
          3 => 'Scroll',
        ),
        'correcta' => 'Complejas, timelines',
      ),
      20 => 
      array (
        'pregunta' => 'WebGL para',
        'opciones' => 
        array (
          0 => '3D acelerado',
          1 => '2D',
          2 => 'Texto',
          3 => 'Formularios',
        ),
        'correcta' => '3D acelerado',
      ),
      21 => 
      array (
        'pregunta' => 'Framer Motion',
        'opciones' => 
        array (
          0 => 'React',
          1 => 'Vue',
          2 => 'Angular',
          3 => 'Vanilla',
        ),
        'correcta' => 'React',
      ),
      22 => 
      array (
        'pregunta' => 'Anime.js',
        'opciones' => 
        array (
          0 => 'Ligero',
          1 => 'Pesado',
          2 => 'Solo SVG',
          3 => 'Solo Canvas',
        ),
        'correcta' => 'Ligero',
      ),
      23 => 
      array (
        'pregunta' => '60 FPS =',
        'opciones' => 
        array (
          0 => '16.67ms',
          1 => '100ms',
          2 => '1s',
          3 => '10ms',
        ),
        'correcta' => '16.67ms',
      ),
      24 => 
      array (
        'pregunta' => 'will-change',
        'opciones' => 
        array (
          0 => 'Optimiza GPU',
          1 => 'Color',
          2 => 'Tamaño',
          3 => 'Nada',
        ),
        'correcta' => 'Optimiza GPU',
      ),
      25 => 
      array (
        'pregunta' => 'transform: translateZ(0)',
        'opciones' => 
        array (
          0 => 'Forzar GPU',
          1 => '2D',
          2 => '3D',
          3 => 'Nada',
        ),
        'correcta' => 'Forzar GPU',
      ),
      26 => 
      array (
        'pregunta' => 'Parallax con JS',
        'opciones' => 
        array (
          0 => 'scrollY * factor',
          1 => 'click',
          2 => 'hover',
          3 => 'load',
        ),
        'correcta' => 'scrollY * factor',
      ),
      27 => 
      array (
        'pregunta' => 'SI 2025: % con GSAP',
        'opciones' => 
        array (
          0 => '+40% top sites',
          1 => '5%',
          2 => '90%',
          3 => '0%',
        ),
        'correcta' => '+40% top sites',
      ),
      28 => 
      array (
        'pregunta' => 'Animaciones mejoran',
        'opciones' => 
        array (
          0 => 'UX, engagement',
          1 => 'Velocidad',
          2 => 'SEO',
          3 => 'Nada',
        ),
        'correcta' => 'UX, engagement',
      ),
      29 => 
      array (
        'pregunta' => 'Futuro animaciones',
        'opciones' => 
        array (
          0 => 'IA, 3D, WebXR',
          1 => 'Flash',
          2 => 'GIF',
          3 => 'Static',
        ),
        'correcta' => 'IA, 3D, WebXR',
      ),
    ),
  ),
  7 => 
  array (
    'materia' => 'Programación',
    'slug' => 'html5-semantico-cyberpunk',
    'titulo' => 'HTML5 SEMÁNTICO: Dominando la Estructura Web del Futuro',
    'contenido' => '<!-- INICIO LECCIÓN CYBERPUNK OPTIMIZADA -->
<div class="leccion-container leccion-programacion-html5" data-tema="html5-semantico">

    <!-- CABECERA COMPACTA -->
    <header class="leccion-header compact">
        <div class="header-top">
            <span class="materia-badge">🌐 PROGRAMACIÓN</span>
            <span class="nivel-badge">⚡ NIVEL INTERMEDIO</span>
            <span class="tiempo-badge">⏱️ 45 MIN</span>
        </div>
        <h1 class="titulo-leccion">
            <span class="neon-icon">〈/〉</span>HTML5 SEMÁNTICO AVANZADO
        </h1>
        <p class="leccion-subtitulo">Estructura • Accesibilidad • SEO • Performance</p>
    </header>

    <!-- PANEL OBJETIVOS RÁPIDO -->
    <section class="objetivos-rapidos">
        <div class="objetivos-grid">
            <div class="objetivo-card">
                <div class="obj-icon">🎯</div>
                <div class="obj-text">
                    <h4>Dominar etiquetas semánticas</h4>
                    <p>Reemplazar divs por elementos con significado real</p>
                </div>
            </div>
            <div class="objetivo-card">
                <div class="obj-icon">🔧</div>
                <div class="obj-text">
                    <h4>Formularios HTML5 modernos</h4>
                    <p>Validación nativa y accesibilidad total</p>
                </div>
            </div>
            <div class="objetivo-card">
                <div class="obj-icon">📈</div>
                <div class="obj-text">
                    <h4>Mejorar SEO y performance</h4>
                    <p>Estructura óptima para motores de búsqueda</p>
                </div>
            </div>
        </div>
    </section>

    <!-- SECCIÓN PRINCIPAL: ETIQUETAS + SIMULADOR -->
    <div class="seccion-principal">

        <!-- ETIQUETAS SEMÁNTICAS -->
        <section class="etiquetas-section">
            <h2 class="seccion-titulo">
                <span class="neon-bullet">▶</span> ETIQUETAS SEMÁNTICAS HTML5
            </h2>
            
            <div class="etiquetas-grid-detalle">
                <div class="etiqueta-item" data-tag="header">
                    <div class="tag-header">
                        <code>&lt;header&gt;</code>
                        <span class="tag-importance">ALTA</span>
                    </div>
                    <div class="tag-desc">Cabecera de página o sección</div>
                    <div class="tag-uso"><strong>Uso:</strong> Logos, navegación principal, encabezados</div>
                    <div class="tag-ejemplo">&lt;header&gt;&lt;h1&gt;Mi Sitio&lt;/h1&gt;&lt;/header&gt;</div>
                </div>
                
                <div class="etiqueta-item" data-tag="nav">
                    <div class="tag-header">
                        <code>&lt;nav&gt;</code>
                        <span class="tag-importance">ALTA</span>
                    </div>
                    <div class="tag-desc">Navegación principal del sitio</div>
                    <div class="tag-uso"><strong>Uso:</strong> Menús, breadcrumbs, enlaces principales</div>
                    <div class="tag-ejemplo">&lt;nav&gt;&lt;a href="/"&gt;Inicio&lt;/a&gt;&lt;/nav&gt;</div>
                </div>
                
                <div class="etiqueta-item" data-tag="main">
                    <div class="tag-header">
                        <code>&lt;main&gt;</code>
                        <span class="tag-importance">CRÍTICA</span>
                    </div>
                    <div class="tag-desc">Contenido principal único</div>
                    <div class="tag-uso"><strong>Uso:</strong> Contenido central, solo uno por página</div>
                    <div class="tag-ejemplo">&lt;main&gt;&lt;article&gt;...&lt;/article&gt;&lt;/main&gt;</div>
                </div>
                
                <div class="etiqueta-item" data-tag="article">
                    <div class="tag-header">
                        <code>&lt;article&gt;</code>
                        <span class="tag-importance">MEDIA</span>
                    </div>
                    <div class="tag-desc">Contenido independiente y reutilizable</div>
                    <div class="tag-uso"><strong>Uso:</strong> Posts, noticias, comentarios, artículos</div>
                    <div class="tag-ejemplo">&lt;article&gt;&lt;h2&gt;Título&lt;/h2&gt;&lt;p&gt;...&lt;/p&gt;&lt;/article&gt;</div>
                </div>
                
                <div class="etiqueta-item" data-tag="section">
                    <div class="tag-header">
                        <code>&lt;section&gt;</code>
                        <span class="tag-importance">MEDIA</span>
                    </div>
                    <div class="tag-desc">Agrupación temática de contenido</div>
                    <div class="tag-uso"><strong>Uso:</strong> Capítulos, agrupaciones temáticas</div>
                    <div class="tag-ejemplo">&lt;section&gt;&lt;h2&gt;Capítulo 1&lt;/h2&gt;...&lt;/section&gt;</div>
                </div>
                
                <div class="etiqueta-item" data-tag="footer">
                    <div class="tag-header">
                        <code>&lt;footer&gt;</code>
                        <span class="tag-importance">ALTA</span>
                    </div>
                    <div class="tag-desc">Pie de página o sección</div>
                    <div class="tag-uso"><strong>Uso:</strong> Créditos, contacto, enlaces legales</div>
                    <div class="tag-ejemplo">&lt;footer&gt;&lt;p&gt;© 2024&lt;/p&gt;&lt;/footer&gt;</div>
                </div>
                
                <div class="etiqueta-item" data-tag="aside">
                    <div class="tag-header">
                        <code>&lt;aside&gt;</code>
                        <span class="tag-importance">BAJA</span>
                    </div>
                    <div class="tag-desc">Contenido relacionado indirectamente</div>
                    <div class="tag-uso"><strong>Uso:</strong> Barras laterales, publicidad, información relacionada</div>
                    <div class="tag-ejemplo">&lt;aside&gt;&lt;h3&gt;Relacionado&lt;/h3&gt;...&lt;/aside&gt;</div>
                </div>
                
                <div class="etiqueta-item" data-tag="figure">
                    <div class="tag-header">
                        <code>&lt;figure&gt;</code>
                        <span class="tag-importance">MEDIA</span>
                    </div>
                    <div class="tag-desc">Contenido multimedia con descripción</div>
                    <div class="tag-uso"><strong>Uso:</strong> Imágenes, gráficos, código con caption</div>
                    <div class="tag-ejemplo">&lt;figure&gt;&lt;img src="..."&gt;&lt;figcaption&gt;Descripción&lt;/figcaption&gt;&lt;/figure&gt;</div>
                </div>
            </div>
        </section>

        <!-- SIMULADOR DE ESTRUCTURA MEJORADO -->
        <section class="simulador-estructura">
            <h2 class="seccion-titulo">
                <span class="neon-bullet">⚡</span> SIMULADOR DE ESTRUCTURA SEMÁNTICA AVANZADO
            </h2>
            
            <!-- CONTROLES DEL SIMULADOR - MEJOR VISIBLES -->
            <div class="simulador-controls">
                <div class="controls-header">
                    <h3>🎮 CONTROLES DEL SIMULADOR</h3>
                    <p>Prueba las funciones principales del simulador:</p>
                </div>
                <div class="controls-buttons">
                    <button class="btn-control btn-analyze" onclick="analizarHTML()" title="Analizar estructura del código">
                        <span class="btn-icon">🔍</span> ANALIZAR ESTRUCTURA
                    </button>
                    <button class="btn-control btn-optimize" onclick="optimizarHTML()" title="Optimizar automáticamente">
                        <span class="btn-icon">⚡</span> OPTIMIZAR HTML
                    </button>
                    <button class="btn-control btn-reset" onclick="reiniciarEditor()" title="Reiniciar editor">
                        <span class="btn-icon">🔄</span> REINICIAR EDITOR
                    </button>
                </div>
                <div class="controls-info">
                    <p><strong>Nota:</strong> Los botones funcionan con el editor de código a continuación</p>
                </div>
            </div>
            
            <!-- EDITOR Y EJEMPLOS EN TODO EL ANCHO -->
            <div class="simulador-contenido-ancho">
                <div class="editor-y-ejemplos">
                    <!-- EDITOR HTML -->
                    <div class="editor-container">
                        <div class="simulador-editor">
                            <div class="editor-toolbar">
                                <div class="toolbar-left">
                                    <span class="file-name">estructura.html</span>
                                    <div class="file-stats">
                                        <span id="lineCount">24</span> líneas
                                    </div>
                                </div>
                                <div class="toolbar-right">
                                    <span class="editor-status">✏️ EDITANDO...</span>
                                </div>
                            </div>
                            
                            <div class="editor-content">
                                <div class="html-snippet-bar">
                                    <button class="btn-control btn-snippet" onclick="insertHTMLSnippet(\'header\')">&lt;header&gt;</button>
                                    <button class="btn-control btn-snippet" onclick="insertHTMLSnippet(\'nav\')">&lt;nav&gt;</button>
                                    <button class="btn-control btn-snippet" onclick="insertHTMLSnippet(\'main\')">&lt;main&gt;</button>
                                    <button class="btn-control btn-snippet" onclick="insertHTMLSnippet(\'article\')">&lt;article&gt;</button>
                                    <button class="btn-control btn-snippet" onclick="insertHTMLSnippet(\'section\')">&lt;section&gt;</button>
                                    <button class="btn-control btn-snippet" onclick="insertHTMLSnippet(\'footer\')">&lt;footer&gt;</button>
                                </div>
                                <textarea id="htmlEditor" class="code-editor" spellcheck="false" rows="20"><!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Sitio Web Moderno</title>
</head>
<body>
    <div id="container">
        <div class="header-area">
            <div class="logo">MiLogo</div>
            <div class="menu">
                <a href="#home">Inicio</a>
                <a href="#about">Acerca</a>
                <a href="#contact">Contacto</a>
            </div>
        </div>
        
        <div class="content">
            <div class="post">
                <div class="post-title">Bienvenido a mi sitio</div>
                <div class="post-content">
                    <p>Este es el contenido principal de mi página web.</p>
                    <p>Aquí va información importante para los usuarios.</p>
                </div>
            </div>
            
            <div class="sidebar">
                <div class="widget">
                    <div class="widget-title">Enlaces rápidos</div>
                    <div class="widget-content">
                        <a href="#link1">Enlace 1</a>
                        <a href="#link2">Enlace 2</a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="footer">
            <div class="copyright">© 2024 Mi Sitio Web</div>
        </div>
    </div>
</body>
</html></textarea>
                            </div>
                        </div>
                        
                        <!-- EJEMPLOS RÁPIDOS - MEJORADO -->
                        <div class="ejemplos-rapidos-mejorado">
                            <div class="ejemplos-header">
                                <h4>📋 EJEMPLOS RÁPIDOS PARA PROBAR:</h4>
                                <p class="ejemplos-desc">Selecciona un ejemplo para cargarlo en el editor</p>
                            </div>
                            <div class="ejemplos-buttons-mejorado">
                                <button class="btn-ejemplo-mejorado" onclick="cargarEjemplo(\'basico\')" data-tipo="basico">
                                    <span class="ejemplo-icon">🏗️</span>
                                    <span class="ejemplo-texto">Estructura básica</span>
                                    <span class="ejemplo-desc">HTML semántico simple</span>
                                </button>
                                <button class="btn-ejemplo-mejorado" onclick="cargarEjemplo(\'blog\')" data-tipo="blog">
                                    <span class="ejemplo-icon">📝</span>
                                    <span class="ejemplo-texto">Blog semántico</span>
                                    <span class="ejemplo-desc">Artículos y secciones</span>
                                </button>
                                <button class="btn-ejemplo-mejorado" onclick="cargarEjemplo(\'ecommerce\')" data-tipo="ecommerce">
                                    <span class="ejemplo-icon">🛒</span>
                                    <span class="ejemplo-texto">E-commerce</span>
                                    <span class="ejemplo-desc">Tienda online</span>
                                </button>
                                <button class="btn-ejemplo-mejorado" onclick="cargarEjemplo(\'malo\')" data-tipo="malo">
                                    <span class="ejemplo-icon">❌</span>
                                    <span class="ejemplo-texto">Código con problemas</span>
                                    <span class="ejemplo-desc">Ejemplo a corregir</span>
                                </button>
                            </div>
                            <div class="ejemplos-info">
                                <p><strong>💡 Consejo:</strong> Después de cargar un ejemplo, haz clic en "ANALIZAR ESTRUCTURA" para ver los resultados</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- ANÁLISIS SEMÁNTICO - MEJOR POSICIONADO -->
                    <div class="analisis-container">
                        <div class="analisis-header">
                            <div>
                                <h3>📊 ANÁLISIS SEMÁNTICO</h3>
                                <p class="analisis-subtitle">Revisa semántica, accesibilidad y estructura de tu HTML.</p>
                            </div>
                            <div class="analisis-meta" style="display:flex; gap:12px; align-items:center;">
                                <div class="analisis-score" id="semanticScore">
                                    <div class="score-circle">
                                        <span class="score-number">0%</span>
                                    </div>
                                    <div class="score-label">Puntaje semántico</div>
                                </div>
                                <span id="htmlSimStatus" class="status-pill status-idle" style="padding:6px 14px; border-radius:999px;">Listo</span>
                                <button class="btn-control btn-preview" onclick="previewHTML()" title="Actualizar vista previa">👁️ Vista previa</button>
                            </div>
                        </div>
                        
                        <div class="analisis-detalle">
                            <div class="metricas-grid-completo">
                                <div class="metrica-completa">
                                    <div class="metrica-header">
                                        <span class="metrica-icon">🏷️</span>
                                        <span class="metrica-title">Etiquetas semánticas</span>
                                    </div>
                                    <div class="metrica-content">
                                        <div class="metrica-value" id="semanticCount">0</div>
                                        <div class="metrica-bar-container">
                                            <div class="metrica-bar-bg">
                                                <div class="metrica-bar-fill" id="semanticBar" style="width: 0%"></div>
                                            </div>
                                            <div class="metrica-percentage">0%</div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="metrica-completa">
                                    <div class="metrica-header">
                                        <span class="metrica-icon">♿</span>
                                        <span class="metrica-title">Accesibilidad</span>
                                    </div>
                                    <div class="metrica-content">
                                        <div class="metrica-value" id="accessibilityScore">0%</div>
                                        <div class="metrica-bar-container">
                                            <div class="metrica-bar-bg">
                                                <div class="metrica-bar-fill" id="accessBar" style="width: 0%"></div>
                                            </div>
                                            <div class="metrica-percentage">0%</div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="metrica-completa">
                                    <div class="metrica-header">
                                        <span class="metrica-icon">📐</span>
                                        <span class="metrica-title">Nesting depth</span>
                                    </div>
                                    <div class="metrica-content">
                                        <div class="metrica-value" id="nestingDepth">0</div>
                                        <div class="metrica-bar-container">
                                            <div class="metrica-bar-bg">
                                                <div class="metrica-bar-fill" id="nestingBar" style="width: 0%"></div>
                                            </div>
                                            <div class="metrica-percentage">0 niveles</div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="metrica-completa">
                                    <div class="metrica-header">
                                        <span class="metrica-icon">🔍</span>
                                        <span class="metrica-title">SEO Score</span>
                                    </div>
                                    <div class="metrica-content">
                                        <div class="metrica-value" id="seoScore">0%</div>
                                        <div class="metrica-bar-container">
                                            <div class="metrica-bar-bg">
                                                <div class="metrica-bar-fill" id="seoBar" style="width: 0%"></div>
                                            </div>
                                            <div class="metrica-percentage">0%</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="preview-card" style="background:rgba(255,255,255,0.04); border:1px solid rgba(255,255,255,0.08); border-radius:18px; padding:16px; margin-top:18px;">
                                <div class="preview-header" style="display:flex; justify-content:space-between; align-items:center; gap:12px; margin-bottom:12px;">
                                    <h4>👁️ Vista previa renderizada</h4>
                                    <button class="btn-control btn-preview" onclick="previewHTML()">Actualizar vista</button>
                                </div>
                                <iframe id="htmlPreview" sandbox class="preview-frame" style="width:100%; min-height:320px; border-radius:14px; border:1px solid rgba(255,255,255,0.1); background:#0f1220;"></iframe>
                            </div>
                            
                            <div class="arbol-estructura-completo">
                                <div class="arbol-header">
                                    <h4>🌳 Árbol de estructura detectado:</h4>
                                    <button class="btn-expandir" onclick="toggleArbol()">Expandir/Contraer</button>
                                </div>
                                <div class="arbol-contenido">
                                    <div class="tree-container" id="treeContainer">
                                        <pre id="treeOutput">Cargando análisis...</pre>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="recomendaciones-completas">
                                <h4>💡 Recomendaciones de mejora:</h4>
                                <div class="recomendaciones-lista" id="recommendations">
                                    <div class="recomendacion-item">
                                        <div class="recomendacion-icon">ℹ️</div>
                                        <div class="recomendacion-text">
                                            Analiza el código HTML para ver recomendaciones personalizadas
                                        </div>
                                    </div>
                                </div>
                                <div class="recomendaciones-actions">
                                    <button class="btn-recomendacion" onclick="mostrarTodasRecomendaciones()">
                                        <span class="btn-icon">📋</span> Ver todas las recomendaciones
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- FORMULARIO HTML5 AVANZADO -->
        <section class="formulario-section">
            <h2 class="seccion-titulo">
                <span class="neon-bullet">📝</span> FORMULARIO HTML5 AVANZADO
            </h2>
            
            <div class="formulario-container">
                <form id="advancedForm" class="formulario-cyberpunk" novalidate>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="userEmail">
                                <span class="label-icon">📧</span> Email:
                            </label>
                            <input type="email" id="userEmail" required
                                   pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\\.[a-z]{2,}$"
                                   placeholder="usuario@dominio.com">
                            <div class="form-hint">Debe ser un email válido (ejemplo@dominio.com)</div>
                        </div>
                        
                        <div class="form-group">
                            <label for="userPassword">
                                <span class="label-icon">🔐</span> Contraseña:
                            </label>
                            <input type="password" id="userPassword" required
                                   minlength="8" 
                                   pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\\d).{8,}$"
                                   title="Mínimo 8 caracteres con mayúscula, minúscula y número">
                            <div class="form-hint">8+ caracteres, 1 mayúscula, 1 minúscula, 1 número</div>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="userURL">
                                <span class="label-icon">🔗</span> URL Personal:
                            </label>
                            <input type="url" id="userURL" 
                                   placeholder="https://tusitio.com">
                        </div>
                        
                        <div class="form-group">
                            <label for="userExperience">
                                <span class="label-icon">🎚️</span> Nivel de Experiencia:
                            </label>
                            <div class="range-container">
                                <input type="range" id="userExperience" min="1" max="10" value="5">
                                <output for="userExperience" id="experienceValue">5</output>
                            </div>
                            <div class="range-labels">
                                <span>Principiante</span>
                                <span>Intermedio</span>
                                <span>Experto</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group full-width">
                        <label for="userComments">
                            <span class="label-icon">💬</span> Comentarios:
                        </label>
                        <textarea id="userComments" minlength="10" maxlength="500"
                                  placeholder="Escribe tus comentarios aquí..." 
                                  data-counter="true"></textarea>
                        <div class="textarea-info">
                            <span class="char-count" id="charCount">0/500 caracteres</span>
                            <span class="min-chars">Mínimo 10 caracteres</span>
                        </div>
                    </div>
                    
                    <div class="form-group full-width">
                        <label>
                            <span class="label-icon">📅</span> Fecha de nacimiento:
                        </label>
                        <input type="date" id="birthDate" min="1900-01-01" max="2024-12-31">
                    </div>
                    
                    <div class="form-group full-width">
                        <label>
                            <span class="label-icon">🎨</span> Color favorito:
                        </label>
                        <input type="color" id="favColor" value="#00FFFF">
                    </div>
                    
                    <div class="form-actions">
                        <button type="submit" class="btn-submit">
                            <span class="btn-icon">🚀</span> ENVIAR FORMULARIO
                        </button>
                        <button type="reset" class="btn-reset">
                            <span class="btn-icon">🔄</span> LIMPIAR TODO
                        </button>
                        <div class="form-status" id="formStatus">
                            Completa todos los campos requeridos
                        </div>
                    </div>
                </form>
                
                <div class="form-validation-info">
                    <h4>✅ Validación HTML5 incluida:</h4>
                    <ul>
                        <li><code>required</code> - Campos obligatorios</li>
                        <li><code>pattern</code> - Validación con regex</li>
                        <li><code>minlength/maxlength</code> - Longitud controlada</li>
                        <li><code>type="email/url/date"</code> - Validación específica</li>
                        <li><code>min/max</code> - Rango de valores</li>
                    </ul>
                </div>
            </div>
        </section>

        <!-- ERRORES FRECUENTES - COMPLETOS Y EN COLUMNA -->
        <section class="errores-section">
            <h2 class="seccion-titulo">
                <span class="neon-bullet">⚠️</span> ERRORES FRECUENTES EN HTML5
            </h2>
            <p class="seccion-descripcion">4 errores comunes que debes evitar al usar HTML5 semántico:</p>
            
            <div class="errores-columna">
                <!-- ERROR 1: MÚLTIPLES MAIN -->
                <div class="error-completo">
                    <div class="error-header-completo">
                        <div class="error-icon">❌</div>
                        <div class="error-titulo">
                            <h3>ERROR 1: MÚLTIPLES ELEMENTOS &lt;main&gt;</h3>
                            <p class="error-subtitulo">Violación de estructura semántica</p>
                        </div>
                    </div>
                    <div class="error-contenido-completo">
                        <div class="error-explicacion">
                            <h4>¿Por qué es un problema?</h4>
                            <p>El elemento <code>&lt;main&gt;</code> debe usarse <strong>solo una vez por documento</strong>. Representa el contenido principal único de la página. Tener múltiples elementos <code>&lt;main&gt;</code> confunde a los lectores de pantalla y a los motores de búsqueda sobre cuál es el contenido principal.</p>
                        </div>
                        <div class="error-comparacion">
                            <div class="comparacion-item incorrecto">
                                <div class="comparacion-header">
                                    <span class="comparacion-badge incorrecto-badge">INCORRECTO</span>
                                    <span class="comparacion-desc">Múltiples elementos main</span>
                                </div>
                                <div class="comparacion-codigo">
                                    <pre><code>&lt;body&gt;
  &lt;main&gt;
    &lt;h1&gt;Título 1&lt;/h1&gt;
    &lt;p&gt;Contenido...&lt;/p&gt;
  &lt;/main&gt;
  
  &lt;main&gt;  &lt;!-- ¡ERROR! Segundo main --&gt;
    &lt;h2&gt;Título 2&lt;/h2&gt;
    &lt;p&gt;Más contenido...&lt;/p&gt;
  &lt;/main&gt;
&lt;/body&gt;</code></pre>
                                </div>
                                <div class="comparacion-problema">
                                    <p><strong>Problema:</strong> Dos elementos <code>&lt;main&gt;</code> en el mismo documento.</p>
                                </div>
                            </div>
                            
                            <div class="comparacion-item correcto">
                                <div class="comparacion-header">
                                    <span class="comparacion-badge correcto-badge">CORRECTO</span>
                                    <span class="comparacion-desc">Un solo main con secciones</span>
                                </div>
                                <div class="comparacion-codigo">
                                    <pre><code>&lt;body&gt;
  &lt;main&gt;
    &lt;section&gt;
      &lt;h1&gt;Título 1&lt;/h1&gt;
      &lt;p&gt;Contenido...&lt;/p&gt;
    &lt;/section&gt;
    
    &lt;section&gt;  &lt;!-- Usar section en lugar de otro main --&gt;
      &lt;h2&gt;Título 2&lt;/h2&gt;
      &lt;p&gt;Más contenido...&lt;/p&gt;
    &lt;/section&gt;
  &lt;/main&gt;
&lt;/body&gt;</code></pre>
                                </div>
                                <div class="comparacion-solucion">
                                    <p><strong>Solución:</strong> Usar un solo <code>&lt;main&gt;</code> y estructurar el contenido con <code>&lt;section&gt;</code> o <code>&lt;article&gt;</code>.</p>
                                </div>
                            </div>
                        </div>
                        <div class="error-consejo">
                            <p><strong>💡 Consejo:</strong> Siempre verifica que tengas solo un <code>&lt;main&gt;</code> por página. Usa <code>&lt;section&gt;</code> para dividir contenido dentro del main.</p>
                        </div>
                    </div>
                </div>
                
                <!-- ERROR 2: NAV MAL UBICADO -->
                <div class="error-completo">
                    <div class="error-header-completo">
                        <div class="error-icon">❌</div>
                        <div class="error-titulo">
                            <h3>ERROR 2: NAV MAL UBICADO O CONTENIDO INCORRECTO</h3>
                            <p class="error-subtitulo">Mal uso del elemento de navegación</p>
                        </div>
                    </div>
                    <div class="error-contenido-completo">
                        <div class="error-explicacion">
                            <h4>¿Por qué es un problema?</h4>
                            <p>El elemento <code>&lt;nav&gt;</code> debe usarse <strong>exclusivamente para bloques de navegación principales</strong>. No debe contener elementos que no sean de navegación como logos, títulos o contenido principal.</p>
                        </div>
                        <div class="error-comparacion">
                            <div class="comparacion-item incorrecto">
                                <div class="comparacion-header">
                                    <span class="comparacion-badge incorrecto-badge">INCORRECTO</span>
                                    <span class="comparacion-desc">Nav con contenido mixto</span>
                                </div>
                                <div class="comparacion-codigo">
                                    <pre><code>&lt;nav&gt;
  &lt;div class="logo"&gt;  &lt;!-- ¡ERROR! Logo no es navegación --&gt;
    &lt;img src="logo.png" alt="Logo"&gt;
  &lt;/div&gt;
  
  &lt;a href="#"&gt;Inicio&lt;/a&gt;
  &lt;a href="#"&gt;Acerca&lt;/a&gt;
  
  &lt;div class="search"&gt;  &lt;!-- ¡ERROR! Buscador tampoco es navegación principal --&gt;
    &lt;input type="search"&gt;
  &lt;/div&gt;
&lt;/nav&gt;</code></pre>
                                </div>
                                <div class="comparacion-problema">
                                    <p><strong>Problema:</strong> Elementos no relacionados dentro de <code>&lt;nav&gt;</code>.</p>
                                </div>
                            </div>
                            
                            <div class="comparacion-item correcto">
                                <div class="comparacion-header">
                                    <span class="comparacion-badge correcto-badge">CORRECTO</span>
                                    <span class="comparacion-desc">Nav solo para navegación</span>
                                </div>
                                <div class="comparacion-codigo">
                                    <pre><code>&lt;header&gt;
  &lt;div class="logo"&gt;
    &lt;img src="logo.png" alt="Logo"&gt;
  &lt;/div&gt;
  
  &lt;nav&gt;  &lt;!-- Solo enlaces de navegación --&gt;
    &lt;a href="#"&gt;Inicio&lt;/a&gt;
    &lt;a href="#"&gt;Acerca&lt;/a&gt;
    &lt;a href="#"&gt;Contacto&lt;/a&gt;
  &lt;/nav&gt;
  
  &lt;div class="search"&gt;  &lt;!-- Buscador fuera del nav --&gt;
    &lt;input type="search"&gt;
  &lt;/div&gt;
&lt;/header&gt;</code></pre>
                                </div>
                                <div class="comparacion-solucion">
                                    <p><strong>Solución:</strong> Usar <code>&lt;nav&gt;</code> solo para enlaces de navegación. Otros elementos deben ir fuera, típicamente dentro de <code>&lt;header&gt;</code> o <code>&lt;footer&gt;</code>.</p>
                                </div>
                            </div>
                        </div>
                        <div class="error-consejo">
                            <p><strong>💡 Consejo:</strong> Si tienes menos de 4-5 enlaces, considera si realmente necesitas un <code>&lt;nav&gt;</code>. Para pocos enlaces, puedes usar un <code>&lt;div&gt;</code> simple.</p>
                        </div>
                    </div>
                </div>
                
                <!-- ERROR 3: SECTION SIN HEADING -->
                <div class="error-completo">
                    <div class="error-header-completo">
                        <div class="error-icon">❌</div>
                        <div class="error-titulo">
                            <h3>ERROR 3: SECTION SIN ENCABEZADO (HEADING)</h3>
                            <p class="error-subtitulo">Falta de estructura jerárquica clara</p>
                        </div>
                    </div>
                    <div class="error-contenido-completo">
                        <div class="error-explicacion">
                            <h4>¿Por qué es un problema?</h4>
                            <p>Cada elemento <code>&lt;section&gt;</code> debe tener <strong>un encabezado (h1-h6)</strong> que identifique su contenido. Sin encabezado, la sección pierde significado semántico y dificulta la accesibilidad.</p>
                        </div>
                        <div class="error-comparacion">
                            <div class="comparacion-item incorrecto">
                                <div class="comparacion-header">
                                    <span class="comparacion-badge incorrecto-badge">INCORRECTO</span>
                                    <span class="comparacion-desc">Section sin heading</span>
                                </div>
                                <div class="comparacion-codigo">
                                    <pre><code>&lt;section&gt;
  &lt;div class="producto"&gt;
    &lt;img src="producto.jpg" alt="Producto"&gt;
    &lt;p&gt;Descripción del producto...&lt;/p&gt;
    &lt;button&gt;Comprar&lt;/button&gt;
  &lt;/div&gt;
  
  &lt;div class="producto"&gt;
    &lt;img src="producto2.jpg" alt="Producto 2"&gt;
    &lt;p&gt;Otra descripción...&lt;/p&gt;
    &lt;button&gt;Comprar&lt;/button&gt;
  &lt;/div&gt;
&lt;/section&gt;</code></pre>
                                </div>
                                <div class="comparacion-problema">
                                    <p><strong>Problema:</strong> No hay encabezado que describa el propósito de la sección.</p>
                                </div>
                            </div>
                            
                            <div class="comparacion-item correcto">
                                <div class="comparacion-header">
                                    <span class="comparacion-badge correcto-badge">CORRECTO</span>
                                    <span class="comparacion-desc">Section con heading apropiado</span>
                                </div>
                                <div class="comparacion-codigo">
                                    <pre><code>&lt;section&gt;
  &lt;h2&gt;Productos Destacados&lt;/h2&gt;  &lt;!-- ¡Heading obligatorio! --&gt;
  
  &lt;div class="producto"&gt;
    &lt;img src="producto.jpg" alt="Producto"&gt;
    &lt;p&gt;Descripción del producto...&lt;/p&gt;
    &lt;button&gt;Comprar&lt;/button&gt;
  &lt;/div&gt;
  
  &lt;div class="producto"&gt;
    &lt;img src="producto2.jpg" alt="Producto 2"&gt;
    &lt;p&gt;Otra descripción...&lt;/p&gt;
    &lt;button&gt;Comprar&lt;/button&gt;
  &lt;/div&gt;
&lt;/section&gt;</code></pre>
                                </div>
                                <div class="comparacion-solucion">
                                    <p><strong>Solución:</strong> Agregar un encabezado descriptivo que indique el tema de la sección. Usar <code>&lt;h2&gt;</code>, <code>&lt;h3&gt;</code>, etc., según la jerarquía.</p>
                                </div>
                            </div>
                        </div>
                        <div class="error-consejo">
                            <p><strong>💡 Consejo:</strong> Si no puedes pensar en un título para tu sección, probablemente no deberías usar <code>&lt;section&gt;</code>. Considera usar <code>&lt;div&gt;</code> o <code>&lt;article&gt;</code> en su lugar.</p>
                        </div>
                    </div>
                </div>
                
                <!-- ERROR 4: DIVITIS (ABUSO DE DIV) -->
                <div class="error-completo">
                    <div class="error-header-completo">
                        <div class="error-icon">❌</div>
                        <div class="error-titulo">
                            <h3>ERROR 4: DIVITIS (ABUSO DE ELEMENTOS &lt;div&gt;)</h3>
                            <p class="error-subtitulo">Falta de significado semántico</p>
                        </div>
                    </div>
                    <div class="error-contenido-completo">
                        <div class="error-explicacion">
                            <h4>¿Por qué es un problema?</h4>
                            <p>Usar <code>&lt;div&gt;</code> para todo hace que el HTML sea <strong>genérico y sin significado</strong>. Las etiquetas semánticas (header, nav, main, etc.) proporcionan significado estructural que mejora la accesibilidad, SEO y mantenibilidad.</p>
                        </div>
                        <div class="error-comparacion">
                            <div class="comparacion-item incorrecto">
                                <div class="comparacion-header">
                                    <span class="comparacion-badge incorrecto-badge">INCORRECTO</span>
                                    <span class="comparacion-desc">Abuso de divs</span>
                                </div>
                                <div class="comparacion-codigo">
                                    <pre><code>&lt;div id="page"&gt;
  &lt;div class="header"&gt;
    &lt;div class="logo"&gt;Logo&lt;/div&gt;
    &lt;div class="menu"&gt;
      &lt;a href="#"&gt;Inicio&lt;/a&gt;
    &lt;/div&gt;
  &lt;/div&gt;
  
  &lt;div class="main-content"&gt;
    &lt;div class="post"&gt;
      &lt;div class="title"&gt;Título&lt;/div&gt;
      &lt;div class="content"&gt;Texto...&lt;/div&gt;
    &lt;/div&gt;
  &lt;/div&gt;
  
  &lt;div class="footer"&gt;
    &lt;div class="copyright"&gt;© 2024&lt;/div&gt;
  &lt;/div&gt;
&lt;/div&gt;</code></pre>
                                </div>
                                <div class="comparacion-problema">
                                    <p><strong>Problema:</strong> Uso excesivo de <code>&lt;div&gt;</code> cuando hay etiquetas semánticas disponibles.</p>
                                </div>
                            </div>
                            
                            <div class="comparacion-item correcto">
                                <div class="comparacion-header">
                                    <span class="comparacion-badge correcto-badge">CORRECTO</span>
                                    <span class="comparacion-desc">HTML5 semántico</span>
                                </div>
                                <div class="comparacion-codigo">
                                    <pre><code>&lt;body&gt;
  &lt;header&gt;  &lt;!-- Semántico en lugar de div --&gt;
    &lt;div class="logo"&gt;Logo&lt;/div&gt;
    &lt;nav&gt;  &lt;!-- Semántico en lugar de div --&gt;
      &lt;a href="#"&gt;Inicio&lt;/a&gt;
    &lt;/nav&gt;
  &lt;/header&gt;
  
  &lt;main&gt;  &lt;!-- Semántico en lugar de div --&gt;
    &lt;article&gt;  &lt;!-- Semántico en lugar de div --&gt;
      &lt;h2&gt;Título&lt;/h2&gt;  &lt;!-- Heading en lugar de div --&gt;
      &lt;p&gt;Texto...&lt;/p&gt;  &lt;!-- Párrafo en lugar de div --&gt;
    &lt;/article&gt;
  &lt;/main&gt;
  
  &lt;footer&gt;  &lt;!-- Semántico en lugar de div --&gt;
    &lt;p&gt;© 2024&lt;/p&gt;  &lt;!-- Párrafo en lugar de div --&gt;
  &lt;/footer&gt;
&lt;/body&gt;</code></pre>
                                </div>
                                <div class="comparacion-solucion">
                                    <p><strong>Solución:</strong> Reemplazar divs genéricos por etiquetas semánticas apropiadas según el contenido.</p>
                                </div>
                            </div>
                        </div>
                        <div class="error-consejo">
                            <p><strong>💡 Consejo:</strong> Antes de usar un <code>&lt;div&gt;</code>, pregúntate: "¿Hay una etiqueta semántica que describa mejor este contenido?" Si la respuesta es sí, úsala.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- DESAFÍO PRÁCTICO -->
        <section class="desafio-section">
            <h2 class="seccion-titulo">
                <span class="neon-bullet">💻</span> DESAFÍO: REPARAR ESTRUCTURA HTML
            </h2>
            
            <div class="desafio-container">
                <div class="desafio-problema">
                    <h4>❌ CÓDIGO CON PROBLEMAS:</h4>
                    <div class="codigo-malo">
                        <pre><code>&lt;div id="page"&gt;
  &lt;div class="top"&gt;
    &lt;div&gt;Logo&lt;/div&gt;
    &lt;div class="links"&gt;
      &lt;a href="#"&gt;Home&lt;/a&gt;
      &lt;a href="#"&gt;About&lt;/a&gt;
    &lt;/div&gt;
  &lt;/div&gt;
  
  &lt;div class="middle"&gt;
    &lt;div class="post"&gt;
      &lt;div class="title"&gt;Título del Post&lt;/div&gt;
      &lt;div&gt;Contenido del artículo...&lt;/div&gt;
    &lt;/div&gt;
    
    &lt;div class="sidebar"&gt;
      &lt;div class="widget"&gt;
        &lt;div class="widget-title"&gt;Enlaces rápidos&lt;/div&gt;
        &lt;div class="widget-content"&gt;
          &lt;a href="#"&gt;Link 1&lt;/a&gt;
          &lt;a href="#"&gt;Link 2&lt;/a&gt;
        &lt;/div&gt;
      &lt;/div&gt;
    &lt;/div&gt;
  &lt;/div&gt;
  
  &lt;div class="bottom"&gt;
    &lt;div&gt;Copyright © 2024&lt;/div&gt;
  &lt;/div&gt;
&lt;/div&gt;</code></pre>
                    </div>
                    <div class="problema-desc">
                        <p><strong>Problemas identificados:</strong></p>
                        <ul>
                            <li>Abuso de elementos <code>&lt;div&gt;</code></li>
                            <li>Falta de etiquetas semánticas</li>
                            <li>Estructura poco clara</li>
                            <li>Baja accesibilidad</li>
                        </ul>
                    </div>
                </div>
                
                <div class="desafio-solucion">
                    <h4>✅ TU SOLUCIÓN:</h4>
                    <div class="editor-solucion">
                        <textarea id="solucionEditor" class="solucion-textarea" 
                                  placeholder="Escribe aquí la estructura semántica corregida..." 
                                  rows="20"></textarea>
                        <div class="editor-tools">
                            <button onclick="verificarSolucion()" class="btn-verificar">
                                <span class="btn-icon">🔍</span> VERIFICAR SOLUCIÓN
                            </button>
                            <button onclick="mostrarSolucion()" class="btn-mostrar">
                                <span class="btn-icon">👁️</span> VER SOLUCIÓN MODELO
                            </button>
                            <button onclick="limpiarSolucion()" class="btn-limpiar">
                                <span class="btn-icon">🗑️</span> LIMPIAR
                            </button>
                        </div>
                    </div>
                    
                    <div class="solucion-feedback" id="solucionFeedback">
                        <div class="feedback-initial">
                            <p>💡 <strong>Instrucciones:</strong> Corrige el código usando etiquetas semánticas apropiadas. Considera:</p>
                            <ul>
                                <li>Reemplazar divs por header, nav, main, article, aside, footer</li>
                                <li>Asegurar un solo elemento main</li>
                                <li>Agregar encabezados a las secciones</li>
                                <li>Mejorar la estructura jerárquica</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- SIMULADOR HTML 100% FUNCIONAL -->
        <section class="simulador-html-completo">
            <h2 class="seccion-titulo">
                <span class="neon-bullet">🚀</span> SIMULADOR HTML COMPLETO
            </h2>
            
            <div class="simulador-completo-container">
                <div class="simulador-tabs">
                    <div class="tabs-header">
                        <button class="tab-btn active" onclick="cambiarTab(\'editor\')">✏️ EDITOR</button>
                        <button class="tab-btn" onclick="cambiarTab(\'vista\')">👁️ VISTA PREVIA</button>
                        <button class="tab-btn" onclick="cambiarTab(\'consola\')">📊 CONSOLA</button>
                    </div>
                    
                    <div class="tabs-content">
                        <div class="tab-pane active" id="tab-editor">
                            <div class="editor-html">
                                <div class="editor-header">
                                    <span>index.html</span>
                                    <div class="editor-actions">
                                        <button onclick="ejecutarHTML()" class="btn-ejecutar">▶ EJECUTAR</button>
                                        <button onclick="guardarHTML()" class="btn-guardar">💾 GUARDAR</button>
                                        <button onclick="descargarHTML()" class="btn-descargar">📥 DESCARGAR</button>
                                    </div>
                                </div>
                                <textarea id="htmlCompleto" class="editor-html-textarea" spellcheck="false"><!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Página Web</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background: #0a0a1a;
            color: #e0f0ff;
        }
        header {
            background: linear-gradient(45deg, #00FFFF, #0097A7);
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
        }
        nav {
            background: rgba(0, 0, 0, 0.3);
            padding: 10px;
            border-radius: 5px;
            margin: 10px 0;
        }
        main {
            background: rgba(255, 255, 255, 0.05);
            padding: 20px;
            border-radius: 10px;
        }
        footer {
            margin-top: 20px;
            padding: 10px;
            text-align: center;
            background: rgba(0, 0, 0, 0.3);
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <header>
        <h1>🌐 Mi Sitio Web Semántico</h1>
        <nav>
            <a href="#inicio">Inicio</a> | 
            <a href="#acerca">Acerca</a> | 
            <a href="#contacto">Contacto</a>
        </nav>
    </header>
    
    <main>
        <article>
            <h2>¡Bienvenido!</h2>
            <p>Este es un ejemplo de estructura HTML5 semántica.</p>
            <p>Puedes editar este código y ver los cambios en tiempo real.</p>
        </article>
        
        <section>
            <h3>Características:</h3>
            <ul>
                <li>Estructura semántica correcta</li>
                <li>CSS integrado</li>
                <li>Totalmente editable</li>
                <li>Vista previa en tiempo real</li>
            </ul>
        </section>
    </main>
    
    <footer>
        <p>© 2024 - Simulador HTML Cyberpunk</p>
    </footer>
    
    <script>
        console.log("✅ Página cargada correctamente");
        document.addEventListener(\'click\', function() {
            console.log("🖱️ Click detectado");
        });
    </script>
</body>
</html></textarea>
                            </div>
                        </div>
                        
                        <div class="tab-pane" id="tab-vista">
                            <div class="vista-previa">
                                <div class="vista-header">
                                    <span>Vista previa (tiempo real)</span>
                                    <div class="vista-actions">
                                        <button onclick="actualizarVista()" class="btn-actualizar">🔄 ACTUALIZAR</button>
                                        <div class="vista-size">
                                            <select id="viewSize" onchange="cambiarTamanoVista()">
                                                <option value="100%">100%</option>
                                                <option value="75%">75%</option>
                                                <option value="50%">50%</option>
                                                <option value="mobile">Móvil</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <iframe id="htmlPreview" class="vista-iframe"></iframe>
                            </div>
                        </div>
                        
                        <div class="tab-pane" id="tab-consola">
                            <div class="consola-output">
                                <div class="consola-header">
                                    <span>📊 Consola de ejecución</span>
                                    <button onclick="limpiarConsola()" class="btn-limpiar">🗑️ LIMPIAR</button>
                                </div>
                                <div class="consola-content" id="consoleOutput">
                                    <div class="console-entry">🔄 Simulador HTML inicializado</div>
                                    <div class="console-entry">📝 Listo para ejecutar código</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="simulador-info">
                    <h4>ℹ️ Instrucciones del simulador:</h4>
                    <ol>
                        <li>Edita el código HTML en la pestaña "Editor"</li>
                        <li>Haz clic en "EJECUTAR" para ver los cambios</li>
                        <li>Usa "Vista previa" para ver el resultado</li>
                        <li>Revisa la "Consola" para mensajes y errores</li>
                        <li>Descarga tu código cuando termines</li>
                    </ol>
                </div>
            </div>
        </section>

        <!-- AUTOEVALUACIÓN Y RECURSOS (EN MISMA SECCIÓN) -->
        <section class="evaluacion-recursos">
            <div class="autoevaluacion-compact">
                <h2 class="seccion-titulo">
                    <span class="neon-bullet">📊</span> AUTOEVALUACIÓN
                </h2>
                
                <div class="eval-grid">
                    <div class="eval-item">
                        <div class="eval-header">
                            <span class="eval-label">Comprensión semántica</span>
                            <span class="eval-value" id="evalValue1">3/5</span>
                        </div>
                        <input type="range" min="1" max="5" value="3" class="eval-slider" 
                               oninput="actualizarEvaluacion(1, this.value)">
                        <div class="eval-labels">
                            <span>Básico</span>
                            <span>Intermedio</span>
                            <span>Avanzado</span>
                        </div>
                    </div>
                    
                    <div class="eval-item">
                        <div class="eval-header">
                            <span class="eval-label">Uso formularios HTML5</span>
                            <span class="eval-value" id="evalValue2">3/5</span>
                        </div>
                        <input type="range" min="1" max="5" value="3" class="eval-slider"
                               oninput="actualizarEvaluacion(2, this.value)">
                        <div class="eval-labels">
                            <span>Básico</span>
                            <span>Intermedio</span>
                            <span>Avanzado</span>
                        </div>
                    </div>
                    
                    <div class="eval-item">
                        <div class="eval-header">
                            <span class="eval-label">Detección de errores</span>
                            <span class="eval-value" id="evalValue3">3/5</span>
                        </div>
                        <input type="range" min="1" max="5" value="3" class="eval-slider"
                               oninput="actualizarEvaluacion(3, this.value)">
                        <div class="eval-labels">
                            <span>Básico</span>
                            <span>Intermedio</span>
                            <span>Avanzado</span>
                        </div>
                    </div>
                </div>
                
                <div class="eval-actions">
                    <button onclick="guardarEvaluacion()" class="btn-guardar-eval">
                        💾 GUARDAR AUTOEVALUACIÓN
                    </button>
                    <div class="eval-promedio">
                        <strong>Promedio actual:</strong> <span id="evalAverage">3.0</span>/5
                    </div>
                </div>
            </div>
            
            <div class="recursos-compact">
                <h2 class="seccion-titulo">
                    <span class="neon-bullet">🔗</span> RECURSOS ADICIONALES
                </h2>
                
                <div class="recursos-grid">
                    <a href="https://developer.mozilla.org/es/docs/Web/HTML/Element" 
                       target="_blank" class="recurso-card">
                        <div class="recurso-icon">📚</div>
                        <div class="recurso-content">
                            <h4>MDN HTML Reference</h4>
                            <p>Documentación completa de todas las etiquetas HTML</p>
                        </div>
                    </a>
                    
                    <a href="https://webaim.org/techniques/semanticstructure/" 
                       target="_blank" class="recurso-card">
                        <div class="recurso-icon">♿</div>
                        <div class="recurso-content">
                            <h4>WebAIM Semantic Structure</h4>
                            <p>Guía completa de accesibilidad y semántica</p>
                        </div>
                    </a>
                    
                    <a href="https://validator.w3.org/" 
                       target="_blank" class="recurso-card">
                        <div class="recurso-icon">✅</div>
                        <div class="recurso-content">
                            <h4>W3C Validator</h4>
                            <p>Validador oficial de código HTML</p>
                        </div>
                    </a>
                    
                    <a href="https://html.spec.whatwg.org/" 
                       target="_blank" class="recurso-card">
                        <div class="recurso-icon">📋</div>
                        <div class="recurso-content">
                            <h4>HTML Living Standard</h4>
                            <p>Especificación oficial de HTML</p>
                        </div>
                    </a>
                </div>
            </div>
        </section>
    </div>
</div>

<!-- JAVASCRIPT COMPLETO Y FUNCIONAL -->
<script>
// ========================================
// SISTEMA DE SIMULADOR DE ESTRUCTURA - MEJORADO
// ========================================
function analizarHTML() {
    const html = document.getElementById(\'htmlEditor\').value;
    console.log(\'🔍 Analizando estructura HTML...\');
    
    // Actualizar contador de líneas
    const lineCount = html.split(\'\\n\').length;
    document.getElementById(\'lineCount\').textContent = lineCount;
    setHTMLSimStatus(\'running\', \'analizando\');
    
    // Contadores
    let semanticTags = 0;
    let totalTags = 0;
    let divCount = 0;
    
    const semanticList = [\'header\', \'nav\', \'main\', \'article\', \'section\', \'aside\', \'footer\', \'figure\', \'figcaption\'];
    const tagRegex = /<([a-zA-Z0-9-]+)(\\s|>)/g;
    let match;
    const foundTags = [];
    while ((match = tagRegex.exec(html)) !== null) {
        const tag = match[1].toLowerCase();
        foundTags.push(tag);
        if (semanticList.includes(tag)) semanticTags += 1;
        if (tag === \'div\') divCount += 1;
    }
    totalTags = foundTags.length;
    
    const semanticScore = totalTags > 0 ? Math.round((semanticTags / totalTags) * 100) : 0;
    const accessibilityScore = semanticScore >= 80 ? 95 : semanticScore >= 60 ? 75 : semanticScore >= 40 ? 50 : 25;
    const nestingDepth = calcularProfundidad(html);
    const seoScore = calcularSEOScore(html);
    
    document.querySelector(\'#semanticScore .score-number\').textContent = `${semanticScore}%`;
    document.getElementById(\'semanticCount\').textContent = semanticTags;
    document.getElementById(\'accessibilityScore\').textContent = `${accessibilityScore}%`;
    document.getElementById(\'nestingDepth\').textContent = nestingDepth;
    document.getElementById(\'seoScore\').textContent = `${seoScore}%`;
    
    document.getElementById(\'semanticBar\').style.width = `${semanticScore}%`;
    document.getElementById(\'accessBar\').style.width = `${accessibilityScore}%`;
    document.getElementById(\'nestingBar\').style.width = `${Math.min(100, nestingDepth * 20)}%`;
    document.getElementById(\'seoBar\').style.width = `${seoScore}%`;
    
    document.querySelectorAll(\'.metrica-percentage\').forEach((el, index) => {
        const values = [semanticScore, accessibilityScore, Math.min(100, nestingDepth * 20), seoScore];
        el.textContent = `${values[index]}%`;
    });
    
    generarArbolEstructura(html);
    generarRecomendaciones(semanticTags, divCount, semanticScore, nestingDepth, html);
    setHTMLSimStatus(\'success\', \'analizado\');
    console.log(`📊 Análisis completado: ${semanticScore}% semántico`);
    mostrarNotificacion(`Análisis completado: ${semanticScore}% de semántica`, \'success\');
}

function calcularProfundidad(html) {
    const tags = html.match(/<\\/?[a-zA-Z][^>]*>/g) || [];
    let maxDepth = 0;
    let currentDepth = 0;

    tags.forEach(tag => {
        const trimmed = tag.trim();
        if (trimmed.startsWith(\'</\')) {
            currentDepth = Math.max(0, currentDepth - 1);
        } else if (trimmed.endsWith(\'/>\')) {
            // self-closing no cambia profundidad
        } else if (!trimmed.startsWith(\'<!--\')) {
            currentDepth += 1;
            maxDepth = Math.max(maxDepth, currentDepth);
        }
    });

    return maxDepth;
}

function calcularSEOScore(html) {
    let score = 50;
    
    // Verificar elementos importantes para SEO
    if (html.includes(\'<title>\')) score += 10;
    if (html.includes(\'<meta name="description"\')) score += 10;
    if (html.includes(\'<h1>\')) score += 10;
    if (html.includes(\'<main>\')) score += 10;
    if (html.match(/<h[2-6]/g)) score += 5;
    if (html.includes(\'lang="\')) score += 5;
    
    return Math.min(100, score);
}

function generarArbolEstructura(html) {
    const lines = html.split(\'\\n\');
    let treeOutput = \'\';
    let indent = 0;
    const displayLines = lines.slice(0, 30);
    
    displayLines.forEach((line) => {
        const trimmed = line.trim();
        if (trimmed === \'\') return;
        
        if (trimmed.startsWith(\'</\')) {
            indent = Math.max(0, indent - 1);
        }
        
        const indentSpaces = \'&nbsp;&nbsp;\'.repeat(Math.max(0, indent));
        let highlightedLine = escapeHTML(trimmed);
        const semanticTags = [\'header\', \'nav\', \'main\', \'article\', \'section\', \'aside\', \'footer\'];
        semanticTags.forEach(tag => {
            const regex = new RegExp(`(&lt;\\/?${tag}[^&]*&gt;)`, \'gi\');
            highlightedLine = highlightedLine.replace(regex, \'<span class="semantic-tag">$1</span>\');
        });
        highlightedLine = highlightedLine.replace(/(&lt;div[^&]*&gt;)/gi, \'<span class="div-tag">$1</span>\');
        
        treeOutput += `<div class="tree-line">${indentSpaces}${highlightedLine}</div>`;
        if (trimmed.match(/^<[^/!][^>]*>$/) && !trimmed.endsWith(\'/>\')) {
            indent += 1;
        }
    });
    
    if (lines.length > 30) {
        treeOutput += `<div class="tree-line" style="color: var(--text-dim); font-style: italic;">... y ${lines.length - 30} líneas más</div>`;
    }
    
    document.getElementById(\'treeOutput\').innerHTML = treeOutput;
}

function generarRecomendaciones(semanticTags, divCount, semanticScore, nestingDepth, html) {
    const recommendations = [];
    
    if (semanticTags === 0) {
        recommendations.push({
            icon: \'🔴\',
            text: \'No se encontraron etiquetas semánticas. Reemplaza divs por header, nav, main, etc.\',
            type: \'error\'
        });
    } else if (semanticScore < 50) {
        recommendations.push({
            icon: \'🟡\',
            text: \'Puntaje semántico bajo. Intenta usar más etiquetas con significado.\',
            type: \'warning\'
        });
    } else if (semanticScore >= 80) {
        recommendations.push({
            icon: \'🟢\',
            text: \'Excelente estructura semántica. ¡Buen trabajo!\',
            type: \'success\'
        });
    }
    
    if (divCount > 10) {
        recommendations.push({
            icon: \'🟡\',
            text: `Muchos divs (${divCount}). Considera reemplazarlos por etiquetas semánticas.`,
            type: \'warning\'
        });
    }
    
    if (nestingDepth > 6) {
        recommendations.push({
            icon: \'🟡\',
            text: `Anidamiento profundo (${nestingDepth} niveles). Simplifica la estructura.`,
            type: \'warning\'
        });
    }
    
    // Verificar elementos específicos
    if (!html.includes(\'<main>\')) {
        recommendations.push({
            icon: \'🔴\',
            text: \'Falta el elemento &lt;main&gt; para el contenido principal.\',
            type: \'error\'
        });
    }
    
    if (!html.includes(\'<header>\')) {
        recommendations.push({
            icon: \'🟡\',
            text: \'Considera agregar un &lt;header&gt; para la cabecera.\',
            type: \'warning\'
        });
    }
    
    // Verificar headings
    if (!html.includes(\'<h1>\') && !html.includes(\'<h2>\') && !html.includes(\'<h3>\')) {
        recommendations.push({
            icon: \'🔴\',
            text: \'Faltan elementos de encabezado (h1-h6). Agrega títulos a tus secciones.\',
            type: \'error\'
        });
    }
    
    // Mostrar recomendaciones
    const container = document.getElementById(\'recommendations\');
    container.innerHTML = \'\';
    
    if (recommendations.length === 0) {
        container.innerHTML = `
            <div class="recomendacion-item">
                <div class="recomendacion-icon">✅</div>
                <div class="recomendacion-text">
                    ¡Estructura HTML excelente! No se encontraron problemas significativos.
                </div>
            </div>
        `;
    } else {
        recommendations.forEach(rec => {
            const item = document.createElement(\'div\');
            item.className = \'recomendacion-item\';
            item.innerHTML = `
                <div class="recomendacion-icon">${rec.icon}</div>
                <div class="recomendacion-text">${rec.text}</div>
            `;
            container.appendChild(item);
        });
    }
}

function optimizarHTML() {
    let html = document.getElementById(\'htmlEditor\').value;
    let cambios = 0;
    const cambiosDetallados = [];
    
    // Reemplazos básicos de divs por etiquetas semánticas
    const replacements = [
        { 
            regex: /<div[^>]*class="header"[^>]*>/gi, 
            replacement: \'<header>\', 
            tipo: \'header\',
            desc: \'Reemplazado div.header por header\'
        },
        { 
            regex: /<div[^>]*class="menu"[^>]*>/gi, 
            replacement: \'<nav>\', 
            tipo: \'nav\',
            desc: \'Reemplazado div.menu por nav\'
        },
        { 
            regex: /<div[^>]*class="content"[^>]*>/gi, 
            replacement: \'<main>\', 
            tipo: \'main\',
            desc: \'Reemplazado div.content por main\'
        },
        { 
            regex: /<div[^>]*class="footer"[^>]*>/gi, 
            replacement: \'<footer>\', 
            tipo: \'footer\',
            desc: \'Reemplazado div.footer por footer\'
        },
        { 
            regex: /<div[^>]*class="post"[^>]*>/gi, 
            replacement: \'<article>\', 
            tipo: \'article\',
            desc: \'Reemplazado div.post por article\'
        },
        { 
            regex: /<div[^>]*class="sidebar"[^>]*>/gi, 
            replacement: \'<aside>\', 
            tipo: \'aside\',
            desc: \'Reemplazado div.sidebar por aside\'
        },
        { 
            regex: /<div[^>]*class="header-area"[^>]*>/gi, 
            replacement: \'<header>\', 
            tipo: \'header\',
            desc: \'Reemplazado div.header-area por header\'
        },
        { 
            regex: /<div[^>]*class="widget-title"[^>]*>(.*?)<\\/div>/gi, 
            replacement: \'<h3>$1</h3>\', 
            tipo: \'heading\',
            desc: \'Reemplazado div.widget-title por h3\'
        },
        { 
            regex: /<div[^>]*class="post-title"[^>]*>(.*?)<\\/div>/gi, 
            replacement: \'<h2>$1</h2>\', 
            tipo: \'heading\',
            desc: \'Reemplazado div.post-title por h2\'
        },
        { 
            regex: /<div[^>]*class="title"[^>]*>(.*?)<\\/div>/gi, 
            replacement: \'<h2>$1</h2>\', 
            tipo: \'heading\',
            desc: \'Reemplazado div.title por h2\'
        },
    ];
    
    replacements.forEach(rep => {
        const oldHtml = html;
        html = html.replace(rep.regex, rep.replacement);
        if (oldHtml !== html) {
            cambios++;
            cambiosDetallados.push(rep.desc);
        }
    });
    
    // Cerrar etiquetas semánticas correspondientes
    const cierreReplacements = [
        { regex: /<\\/div>\\s*<!--\\s*\\/header\\s*-->/gi, replacement: \'</header>\' },
        { regex: /<\\/div>\\s*<!--\\s*\\/nav\\s*-->/gi, replacement: \'</nav>\' },
        { regex: /<\\/div>\\s*<!--\\s*\\/main\\s*-->/gi, replacement: \'</main>\' },
        { regex: /<\\/div>\\s*<!--\\s*\\/footer\\s*-->/gi, replacement: \'</footer>\' },
        { regex: /<\\/div>\\s*<!--\\s*\\/article\\s*-->/gi, replacement: \'</article>\' },
        { regex: /<\\/div>\\s*<!--\\s*\\/aside\\s*-->/gi, replacement: \'</aside>\' },
    ];
    
    cierreReplacements.forEach(rep => {
        const oldHtml = html;
        html = html.replace(rep.regex, rep.replacement);
        if (oldHtml !== html) {
            cambios++;
        }
    });
    
    document.getElementById(\'htmlEditor\').value = html;
    
    // Mostrar resultados
    if (cambios > 0) {
        console.log(`⚡ HTML optimizado: ${cambios} cambios realizados`);
        
        // Mostrar resumen de cambios
        let mensaje = `Optimizado: ${cambios} cambios realizados`;
        if (cambiosDetallados.length > 0) {
            mensaje += \'\\n\\n\' + cambiosDetallados.slice(0, 3).join(\'\\n\');
            if (cambiosDetallados.length > 3) {
                mensaje += `\\n... y ${cambiosDetallados.length - 3} cambios más`;
            }
        }
        
        mostrarNotificacion(mensaje, \'success\');
        analizarHTML();
    } else {
        mostrarNotificacion(\'No se encontraron optimizaciones necesarias\', \'warning\');
    }
}

function reiniciarEditor() {
    document.getElementById(\'htmlEditor\').value = `<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Sitio Web Moderno</title>
</head>
<body>
    <div id="container">
        <div class="header-area">
            <div class="logo">MiLogo</div>
            <div class="menu">
                <a href="#home">Inicio</a>
                <a href="#about">Acerca</a>
                <a href="#contact">Contacto</a>
            </div>
        </div>
        
        <div class="content">
            <div class="post">
                <div class="post-title">Bienvenido a mi sitio</div>
                <div class="post-content">
                    <p>Este es el contenido principal de mi página web.</p>
                    <p>Aquí va información importante para los usuarios.</p>
                </div>
            </div>
            
            <div class="sidebar">
                <div class="widget">
                    <div class="widget-title">Enlaces rápidos</div>
                    <div class="widget-content">
                        <a href="#link1">Enlace 1</a>
                        <a href="#link2">Enlace 2</a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="footer">
            <div class="copyright">© 2024 Mi Sitio Web</div>
        </div>
    </div>
</body>
</html>`;
    console.log(\'🔄 Editor reiniciado\');
    mostrarNotificacion(\'Editor reiniciado a configuración inicial\', \'info\');
    analizarHTML();
    previewHTML();
    setHTMLSimStatus(\'idle\', \'reiniciado\');
}

function setHTMLSimStatus(type, label) {
    const status = document.getElementById(\'htmlSimStatus\');
    if (!status) return;
    status.className = `status-pill status-${type}`;
    status.textContent = label;
}

function escapeHTML(str) {
    return str
        .replace(/&/g, \'&amp;\')
        .replace(/</g, \'&lt;\')
        .replace(/>/g, \'&gt;\');
}

function insertHTMLSnippet(key) {
    const ta = document.getElementById(\'htmlEditor\');
    const snippets = {
        header: \'<header>\\n    <h1>Encabezado principal</h1>\\n</header>\\n\',
        nav: \'<nav>\\n    <a href="#">Inicio</a> | <a href="#">Servicios</a> | <a href="#">Contacto</a>\\n</nav>\\n\',
        main: \'<main>\\n    <section>\\n        <h2>Contenido principal</h2>\\n        <p>Texto descriptivo del sitio.</p>\\n    </section>\\n</main>\\n\',
        article: \'<article>\\n    <h2>Título del artículo</h2>\\n    <p>Texto del artículo con contenido relevante.</p>\\n</article>\\n\',
        section: \'<section>\\n    <h2>Sección temática</h2>\\n    <p>Descripción de la sección.</p>\\n</section>\\n\',
        footer: \'<footer>\\n    <p>© 2024 Mi Sitio Web</p>\\n</footer>\\n\'
    };
    const snippet = snippets[key] || \'\';
    const start = ta.selectionStart;
    const end = ta.selectionEnd;
    ta.value = ta.value.slice(0, start) + snippet + ta.value.slice(end);
    ta.selectionStart = ta.selectionEnd = start + snippet.length;
    ta.focus();
    setHTMLSimStatus(\'idle\', \'snippet\');
}

function previewHTML() {
    const iframe = document.getElementById(\'htmlPreview\');
    if (!iframe) return;
    iframe.srcdoc = document.getElementById(\'htmlEditor\').value;
    setHTMLSimStatus(\'success\', \'vista previa\');
    mostrarNotificacion(\'Vista previa renderizada\', \'info\');
}

function initSemanticHTMLSimulator() {
    const editor = document.getElementById(\'htmlEditor\');
    if (!editor) return;
    editor.addEventListener(\'input\', () => {
        const lineCount = editor.value.split(\'\\n\').length;
        document.getElementById(\'lineCount\').textContent = lineCount;
        setHTMLSimStatus(\'running\', \'editando...\');
    });
    analizarHTML();
    previewHTML();
}

// ========================================
// EJEMPLOS RÁPIDOS - MEJORADO
// ========================================
function cargarEjemplo(tipo) {
    const ejemplos = {
        basico: `<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Sitio Web Básico</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        header {
            background: #2c3e50;
            color: white;
            padding: 1rem;
            text-align: center;
        }
        nav {
            background: #34495e;
            padding: 0.5rem;
        }
        nav a {
            color: white;
            margin: 0 1rem;
            text-decoration: none;
        }
        main {
            padding: 2rem;
            max-width: 800px;
            margin: 0 auto;
        }
        article {
            background: #f9f9f9;
            padding: 1.5rem;
            border-radius: 5px;
            margin-bottom: 1.5rem;
        }
        footer {
            background: #2c3e50;
            color: white;
            text-align: center;
            padding: 1rem;
            margin-top: 2rem;
        }
    </style>
</head>
<body>
    <header>
        <h1>🏠 Mi Sitio Web</h1>
        <p>Un ejemplo básico de HTML5 semántico</p>
    </header>
    
    <nav>
        <a href="#inicio">Inicio</a>
        <a href="#acerca">Acerca</a>
        <a href="#servicios">Servicios</a>
        <a href="#contacto">Contacto</a>
    </nav>
    
    <main>
        <article>
            <h2>Bienvenido a mi sitio web</h2>
            <p>Este es un ejemplo básico de estructura HTML5 semántica.</p>
            <p>La semántica correcta mejora la accesibilidad y el SEO.</p>
        </article>
        
        <section>
            <h3>Características principales</h3>
            <ul>
                <li>Estructura semántica correcta</li>
                <li>Código limpio y organizado</li>
                <li>Accesibilidad mejorada</li>
                <li>SEO optimizado</li>
            </ul>
        </section>
    </main>
    
    <footer>
        <p>© 2024 Mi Sitio Web. Todos los derechos reservados.</p>
    </footer>
</body>
</html>`,

        blog: `<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Blog Personal</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: \'Segoe UI\', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background: #f5f5f5;
        }
        .blog-container {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 2rem;
            padding: 1rem;
        }
        header {
            grid-column: 1 / -1;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 2rem;
            border-radius: 10px;
            text-align: center;
            margin-bottom: 2rem;
        }
        nav {
            background: white;
            padding: 1rem;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        nav ul {
            list-style: none;
            display: flex;
            gap: 1rem;
            justify-content: center;
        }
        nav a {
            color: #667eea;
            text-decoration: none;
            font-weight: 500;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            transition: background 0.3s;
        }
        nav a:hover {
            background: #f0f0f0;
        }
        main {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 2px 15px rgba(0,0,0,0.1);
        }
        article {
            margin-bottom: 2rem;
            padding-bottom: 2rem;
            border-bottom: 1px solid #eee;
        }
        article:last-child {
            border-bottom: none;
        }
        article header {
            background: none;
            color: #333;
            padding: 0;
            text-align: left;
            margin-bottom: 1rem;
        }
        article h2 {
            color: #2d3748;
            margin-bottom: 0.5rem;
        }
        time {
            color: #718096;
            font-size: 0.9rem;
        }
        aside {
            background: white;
            padding: 1.5rem;
            border-radius: 10px;
            box-shadow: 0 2px 15px rgba(0,0,0,0.1);
        }
        footer {
            grid-column: 1 / -1;
            background: #2d3748;
            color: white;
            text-align: center;
            padding: 2rem;
            border-radius: 10px;
            margin-top: 2rem;
        }
        .post-tags {
            display: flex;
            gap: 0.5rem;
            margin-top: 1rem;
        }
        .tag {
            background: #edf2f7;
            color: #4a5568;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.85rem;
        }
    </style>
</head>
<body>
    <div class="blog-container">
        <header>
            <h1>📝 Mi Blog Personal</h1>
            <p>Compartiendo conocimiento sobre desarrollo web y tecnología</p>
        </header>
        
        <nav>
            <ul>
                <li><a href="#inicio">Inicio</a></li>
                <li><a href="#articulos">Artículos</a></li>
                <li><a href="#categorias">Categorías</a></li>
                <li><a href="#acerca">Acerca</a></li>
                <li><a href="#contacto">Contacto</a></li>
            </ul>
        </nav>
        
        <main>
            <article>
                <header>
                    <h2>La importancia del HTML5 semántico</h2>
                    <time datetime="2024-01-15">15 de Enero, 2024</time>
                </header>
                
                <p>El HTML5 semántico no es solo una tendencia, es una necesidad en el desarrollo web moderno. Las etiquetas semánticas como <code>&lt;header&gt;</code>, <code>&lt;nav&gt;</code>, <code>&lt;main&gt;</code>, <code>&lt;article&gt;</code>, <code>&lt;section&gt;</code>, y <code>&lt;footer&gt;</code> proporcionan significado estructural que va más allá de la presentación visual.</p>
                
                <section>
                    <h3>Beneficios principales</h3>
                    <ul>
                        <li><strong>Accesibilidad mejorada:</strong> Los lectores de pantalla pueden navegar más fácilmente.</li>
                        <li><strong>SEO optimizado:</strong> Los motores de búsqueda comprenden mejor la estructura.</li>
                        <li><strong>Código más mantenible:</strong> La estructura clara facilita la colaboración.</li>
                        <li><strong>Mejor experiencia de usuario:</strong> Navegación más intuitiva.</li>
                    </ul>
                </section>
                
                <footer>
                    <div class="post-tags">
                        <span class="tag">HTML5</span>
                        <span class="tag">Semántica</span>
                        <span class="tag">Accesibilidad</span>
                        <span class="tag">SEO</span>
                    </div>
                </footer>
            </article>
            
            <article>
                <header>
                    <h2>Formularios HTML5: Validación nativa</h2>
                    <time datetime="2024-01-10">10 de Enero, 2024</time>
                </header>
                
                <p>HTML5 introdujo una serie de atributos y tipos de input que permiten validación nativa sin necesidad de JavaScript. Esto no solo mejora la experiencia del usuario, sino que también reduce la carga de trabajo del desarrollador.</p>
                
                <p>Tipos de input como <code>email</code>, <code>url</code>, <code>date</code>, y atributos como <code>required</code>, <code>pattern</code>, <code>minlength</code>, y <code>maxlength</code> proporcionan validación robusta directamente en el navegador.</p>
                
                <footer>
                    <div class="post-tags">
                        <span class="tag">HTML5</span>
                        <span class="tag">Formularios</span>
                        <span class="tag">Validación</span>
                    </div>
                </footer>
            </article>
        </main>
        
        <aside>
            <h3>Artículos populares</h3>
            <ul>
                <li><a href="#">Introducción a CSS Grid</a></li>
                <li><a href="#">JavaScript Moderno: ES6+</a></li>
                <li><a href="#">Optimización de rendimiento web</a></li>
                <li><a href="#">Responsive Design avanzado</a></li>
            </ul>
            
            <h3>Categorías</h3>
            <ul>
                <li><a href="#">HTML/CSS</a></li>
                <li><a href="#">JavaScript</a></li>
                <li><a href="#">Accesibilidad</a></li>
                <li><a href="#">SEO</a></li>
                <li><a href="#">Herramientas</a></li>
            </ul>
        </aside>
        
        <footer>
            <p>© 2024 Mi Blog Personal. Todos los derechos reservados.</p>
            <p><a href="mailto:contacto@miblog.com" style="color: #a0aec0;">contacto@miblog.com</a> | Sígueme en redes sociales</p>
        </footer>
    </div>
</body>
</html>`,

        ecommerce: `<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechStore - Tu tienda de tecnología</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: \'Inter\', -apple-system, BlinkMacSystemFont, sans-serif;
            line-height: 1.6;
            color: #1a202c;
            background: #f7fafc;
        }
        .ecommerce-container {
            max-width: 1400px;
            margin: 0 auto;
        }
        header {
            background: white;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 100;
        }
        .logo {
            font-size: 1.5rem;
            font-weight: bold;
            color: #2d3748;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        nav ul {
            list-style: none;
            display: flex;
            gap: 2rem;
        }
        nav a {
            color: #4a5568;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
        }
        nav a:hover {
            color: #2b6cb0;
        }
        .cart-icon {
            position: relative;
            cursor: pointer;
        }
        .cart-count {
            position: absolute;
            top: -8px;
            right: -8px;
            background: #e53e3e;
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
        }
        main {
            padding: 2rem;
        }
        .hero {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 4rem 2rem;
            border-radius: 10px;
            text-align: center;
            margin-bottom: 3rem;
        }
        .hero h1 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }
        .product-card {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.15);
        }
        .product-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .product-info {
            padding: 1.5rem;
        }
        .product-title {
            font-size: 1.25rem;
            margin-bottom: 0.5rem;
            color: #2d3748;
        }
        .product-price {
            font-size: 1.5rem;
            font-weight: bold;
            color: #2b6cb0;
            margin-bottom: 1rem;
        }
        .product-description {
            color: #718096;
            margin-bottom: 1rem;
            font-size: 0.95rem;
        }
        .add-to-cart {
            background: #2b6cb0;
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 500;
            width: 100%;
            transition: background 0.3s;
        }
        .add-to-cart:hover {
            background: #2c5282;
        }
        aside {
            background: white;
            padding: 1.5rem;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .sidebar-section {
            margin-bottom: 2rem;
        }
        .sidebar-section h3 {
            color: #2d3748;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #e2e8f0;
        }
        .categories-list {
            list-style: none;
        }
        .categories-list li {
            margin-bottom: 0.75rem;
        }
        .categories-list a {
            color: #4a5568;
            text-decoration: none;
            transition: color 0.3s;
        }
        .categories-list a:hover {
            color: #2b6cb0;
        }
        footer {
            background: #2d3748;
            color: white;
            padding: 3rem 2rem;
            margin-top: 3rem;
        }
        .footer-content {
            max-width: 1400px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
        }
        .footer-section h4 {
            margin-bottom: 1rem;
            color: #cbd5e0;
        }
        .footer-section ul {
            list-style: none;
        }
        .footer-section li {
            margin-bottom: 0.5rem;
        }
        .footer-section a {
            color: #a0aec0;
            text-decoration: none;
            transition: color 0.3s;
        }
        .footer-section a:hover {
            color: white;
        }
        .copyright {
            text-align: center;
            padding-top: 2rem;
            margin-top: 2rem;
            border-top: 1px solid #4a5568;
            color: #a0aec0;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <div class="ecommerce-container">
        <header>
            <div class="logo">
                <span>🛒</span>
                <span>TechStore</span>
            </div>
            
            <nav aria-label="Navegación principal">
                <ul>
                    <li><a href="#inicio">Inicio</a></li>
                    <li><a href="#productos">Productos</a></li>
                    <li><a href="#categorias">Categorías</a></li>
                    <li><a href="#ofertas">Ofertas</a></li>
                    <li><a href="#contacto">Contacto</a></li>
                </ul>
            </nav>
            
            <div class="cart-icon">
                <span>🛍️</span>
                <span class="cart-count">3</span>
            </div>
        </header>
        
        <main>
            <section class="hero">
                <h1>Las mejores ofertas en tecnología</h1>
                <p>Encuentra los últimos productos al mejor precio</p>
            </section>
            
            <section aria-labelledby="productos-destacados">
                <h2 id="productos-destacados" style="margin-bottom: 2rem; color: #2d3748;">Productos Destacados</h2>
                
                <div class="products-grid">
                    <article class="product-card">
                        <img src="https://images.unsplash.com/photo-1498049794561-7780e7231661?ixlib=rb-1.2.1&auto=format&fit=crop&w=600&q=80" 
                             alt="Laptop Gaming" class="product-image">
                        <div class="product-info">
                            <h3 class="product-title">Laptop Gaming Pro</h3>
                            <div class="product-price">$1,299.99</div>
                            <p class="product-description">Laptop gaming con procesador i7, 16GB RAM, RTX 3060 y pantalla 144Hz.</p>
                            <button class="add-to-cart">Añadir al carrito</button>
                        </div>
                    </article>
                    
                    <article class="product-card">
                        <img src="https://images.unsplash.com/photo-1583394838336-acd977736f90?ixlib=rb-1.2.1&auto=format&fit=crop&w=600&q=80" 
                             alt="Smartphone Flagship" class="product-image">
                        <div class="product-info">
                            <h3 class="product-title">Smartphone Flagship</h3>
                            <div class="product-price">$899.99</div>
                            <p class="product-description">Smartphone con cámara triple de 108MP, 256GB almacenamiento y carga rápida.</p>
                            <button class="add-to-cart">Añadir al carrito</button>
                        </div>
                    </article>
                    
                    <article class="product-card">
                        <img src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixlib=rb-1.2.1&auto=format&fit=crop&w=600&q=80" 
                             alt="Auriculares Bluetooth" class="product-image">
                        <div class="product-info">
                            <h3 class="product-title">Auriculares Bluetooth</h3>
                            <div class="product-price">$199.99</div>
                            <p class="product-description">Auriculares con cancelación de ruido y 30 horas de batería.</p>
                            <button class="add-to-cart">Añadir al carrito</button>
                        </div>
                    </article>
                    
                    <article class="product-card">
                        <img src="https://images.unsplash.com/photo-1526170375885-4d8ecf77b99f?ixlib=rb-1.2.1&auto=format&fit=crop&w=600&q=80" 
                             alt="Cámara Mirrorless" class="product-image">
                        <div class="product-info">
                            <h3 class="product-title">Cámara Mirrorless</h3>
                            <div class="product-price">$1,599.99</div>
                            <p class="product-description">Cámara profesional con sensor full-frame y grabación 4K.</p>
                            <button class="add-to-cart">Añadir al carrito</button>
                        </div>
                    </article>
                </div>
            </section>
            
            <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 2rem;">
                <section aria-labelledby="nuevos-productos">
                    <h2 id="nuevos-productos" style="margin-bottom: 2rem; color: #2d3748;">Nuevos Productos</h2>
                    <p>Próximamente más productos innovadores...</p>
                </section>
                
                <aside>
                    <div class="sidebar-section">
                        <h3>Categorías</h3>
                        <ul class="categories-list">
                            <li><a href="#laptops">Laptops</a></li>
                            <li><a href="#smartphones">Smartphones</a></li>
                            <li><a href="#tablets">Tablets</a></li>
                            <li><a href="#accesorios">Accesorios</a></li>
                            <li><a href="#audio">Audio</a></li>
                            <li><a href="#fotografia">Fotografía</a></li>
                        </ul>
                    </div>
                    
                    <div class="sidebar-section">
                        <h3>Ofertas Especiales</h3>
                        <p>¡Black Friday está cerca! Prepárate para descuentos de hasta el 50%.</p>
                    </div>
                </aside>
            </div>
        </main>
        
        <footer>
            <div class="footer-content">
                <div class="footer-section">
                    <h4>TechStore</h4>
                    <p>Tu tienda de confianza para productos tecnológicos.</p>
                </div>
                
                <div class="footer-section">
                    <h4>Enlaces Rápidos</h4>
                    <ul>
                        <li><a href="#inicio">Inicio</a></li>
                        <li><a href="#productos">Productos</a></li>
                        <li><a href="#categorias">Categorías</a></li>
                        <li><a href="#contacto">Contacto</a></li>
                    </ul>
                </div>
                
                <div class="footer-section">
                    <h4>Contacto</h4>
                    <ul>
                        <li>Email: info@techstore.com</li>
                        <li>Teléfono: +1 (234) 567-890</li>
                        <li>Dirección: Calle Tecnología 123</li>
                    </ul>
                </div>
                
                <div class="footer-section">
                    <h4>Síguenos</h4>
                    <ul>
                        <li><a href="#twitter">Twitter</a></li>
                        <li><a href="#facebook">Facebook</a></li>
                        <li><a href="#instagram">Instagram</a></li>
                        <li><a href="#youtube">YouTube</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="copyright">
                <p>© 2024 TechStore. Todos los derechos reservados.</p>
                <p>Este es un ejemplo educativo de estructura HTML5 semántica.</p>
            </div>
        </footer>
    </div>
</body>
</html>`,

        malo: `<!DOCTYPE html>
<html>
<head>
    <title>Página con problemas estructurales</title>
    <style>
        #todo {
            width: 100%;
        }
        .arriba {
            background: #ccc;
            padding: 10px;
        }
        .medio {
            padding: 20px;
        }
        .abajo {
            background: #333;
            color: white;
            padding: 10px;
        }
        .links {
            display: flex;
            gap: 10px;
        }
        .contenido-principal {
            display: flex;
        }
        .principal {
            flex: 3;
        }
        .lateral {
            flex: 1;
            background: #f0f0f0;
            padding: 15px;
        }
    </style>
</head>
<body>
    <div id="todo">
        <div class="arriba">
            <div>
                <div>Mi Sitio Web</div>
            </div>
            <div class="links">
                <div><a href="#">Inicio</a></div>
                <div><a href="#">Acerca</a></div>
                <div><a href="#">Servicios</a></div>
                <div><a href="#">Contacto</a></div>
            </div>
        </div>
        
        <div class="medio">
            <div class="contenido-principal">
                <div class="principal">
                    <div>
                        <div>Título del Artículo</div>
                        <div>
                            <div>Contenido del artículo va aquí...</div>
                            <div>Más contenido y explicaciones.</div>
                            <div>Otro párrafo sin estructura clara.</div>
                        </div>
                    </div>
                    
                    <div>
                        <div>Otro Título</div>
                        <div>
                            <div>Contenido de otra sección...</div>
                            <div>Sin encabezados apropiados.</div>
                        </div>
                    </div>
                </div>
                
                <div class="lateral">
                    <div class="widget">
                        <div class="widget-titulo">Enlaces Útiles</div>
                        <div class="widget-contenido">
                            <div><a href="#">Enlace 1</a></div>
                            <div><a href="#">Enlace 2</a></div>
                            <div><a href="#">Enlace 3</a></div>
                        </div>
                    </div>
                    
                    <div class="widget">
                        <div class="widget-titulo">Información</div>
                        <div class="widget-contenido">
                            <div>Texto informativo sin estructura.</div>
                            <div>Más texto sin etiquetas adecuadas.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="abajo">
            <div>
                <div>© 2024 Mi Sitio Web</div>
                <div>
                    <div><a href="#">Política de Privacidad</a></div>
                    <div><a href="#">Términos de Uso</a></div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>`
    };
    
    if (ejemplos[tipo]) {
        document.getElementById(\'htmlEditor\').value = ejemplos[tipo];
        
        // Asegurar que el editor mantenga su tamaño
        const editor = document.getElementById(\'htmlEditor\');
        editor.style.height = \'400px\'; // Altura fija
        editor.style.minHeight = \'400px\';
        editor.style.maxHeight = \'400px\';
        
        // Actualizar contador de líneas
        const lineCount = ejemplos[tipo].split(\'\\n\').length;
        document.getElementById(\'lineCount\').textContent = lineCount;
        
        console.log(`📂 Ejemplo cargado: ${tipo}`);
        mostrarNotificacion(`Ejemplo "${tipo}" cargado correctamente`, \'success\');
        
        // Resaltar el botón seleccionado
        document.querySelectorAll(\'.btn-ejemplo-mejorado\').forEach(btn => {
            btn.classList.remove(\'selected\');
            if (btn.getAttribute(\'data-tipo\') === tipo) {
                btn.classList.add(\'selected\');
            }
        });
        
        // Analizar y previsualizar automáticamente después de cargar
        setTimeout(() => {
            analizarHTML();
            previewHTML();
            setHTMLSimStatus(\'idle\', \'ejemplo\');
        }, 500);
    }
}

initSemanticHTMLSimulator();

// ========================================
// FUNCIONES AUXILIARES
// ========================================
function toggleArbol() {
    const container = document.getElementById(\'treeContainer\');
    const btn = document.querySelector(\'.btn-expandir\');
    
    if (container.classList.contains(\'expandido\')) {
        container.classList.remove(\'expandido\');
        container.style.maxHeight = \'200px\';
        btn.textContent = \'Expandir\';
    } else {
        container.classList.add(\'expandido\');
        container.style.maxHeight = \'400px\';
        btn.textContent = \'Contraer\';
    }
}

function mostrarTodasRecomendaciones() {
    // En una implementación real, esto mostraría más recomendaciones
    mostrarNotificacion(\'Esta función mostraría recomendaciones detalladas en un futuro.\', \'info\');
}

function mostrarNotificacion(mensaje, tipo = \'info\') {
    // Crear notificación
    const notificacion = document.createElement(\'div\');
    notificacion.className = `notificacion notificacion-${tipo}`;
    
    // Dividir mensaje si es muy largo
    const lineas = mensaje.split(\'\\n\');
    const contenido = lineas.length > 1 ? lineas.slice(0, 3).join(\'<br>\') : mensaje;
    
    notificacion.innerHTML = `
        <div class="notificacion-contenido">
            <span class="notificacion-icon">${tipo === \'success\' ? \'✅\' : tipo === \'warning\' ? \'⚠️\' : \'ℹ️\'}</span>
            <span class="notificacion-mensaje">${contenido}</span>
        </div>
        <button class="notificacion-cerrar" onclick="this.parentElement.remove()">×</button>
    `;
    
    // Agregar al DOM
    document.body.appendChild(notificacion);
    
    // Auto-eliminar después de 5 segundos
    setTimeout(() => {
        if (notificacion.parentElement) {
            notificacion.remove();
        }
    }, 5000);
}

// ========================================
// FORMULARIO AVANZADO
// ========================================
document.getElementById(\'advancedForm\').addEventListener(\'submit\', function(e) {
    e.preventDefault();
    
    const form = this;
    const status = document.getElementById(\'formStatus\');
    
    if (form.checkValidity()) {
        status.textContent = \'✅ Formulario válido. Datos listos para enviar.\';
        status.style.color = \'#39FF14\';
        status.style.backgroundColor = \'rgba(57, 255, 20, 0.1)\';
        
        // Simular envío
        setTimeout(() => {
            alert(\'🚀 Formulario enviado correctamente!\\n\\nDatos procesados:\\n\' +
                  `Email: ${document.getElementById(\'userEmail\').value}\\n` +
                  `Experiencia: ${document.getElementById(\'experienceValue\').textContent}/10\\n` +
                  `Comentarios: ${document.getElementById(\'userComments\').value.length} caracteres`);
            form.reset();
            status.textContent = \'Completa todos los campos requeridos\';
            status.style.color = \'\';
            status.style.backgroundColor = \'\';
            document.getElementById(\'charCount\').textContent = \'0/500 caracteres\';
            document.getElementById(\'experienceValue\').textContent = \'5\';
        }, 1000);
    } else {
        status.textContent = \'⚠️ Por favor, corrige los errores en el formulario\';
        status.style.color = \'#FF6B6B\';
        status.style.backgroundColor = \'rgba(255, 107, 107, 0.1)\';
    }
});

// Contador de caracteres
document.getElementById(\'userComments\').addEventListener(\'input\', function() {
    const count = this.value.length;
    document.getElementById(\'charCount\').textContent = `${count}/500 caracteres`;
    
    if (count < 10) {
        this.style.borderColor = \'#FF6B6B\';
    } else if (count >= 10 && count <= 500) {
        this.style.borderColor = \'#39FF14\';
    } else {
        this.style.borderColor = \'#FFFF00\';
    }
});

// Actualizar valor del range
document.getElementById(\'userExperience\').addEventListener(\'input\', function() {
    document.getElementById(\'experienceValue\').textContent = this.value;
});

// ========================================
// DESAFÍO PRÁCTICO
// ========================================
function verificarSolucion() {
    const solucion = document.getElementById(\'solucionEditor\').value;
    const feedback = document.getElementById(\'solucionFeedback\');
    
    if (!solucion.trim()) {
        feedback.innerHTML = \'<div class="feedback-error">❌ Por favor, escribe tu solución primero.</div>\';
        return;
    }
    
    // Elementos requeridos en la solución
    const elementosRequeridos = [\'header\', \'nav\', \'main\', \'article\', \'footer\', \'aside\'];
    const encontrados = [];
    
    elementosRequeridos.forEach(el => {
        if (solucion.toLowerCase().includes(\'<\' + el)) {
            encontrados.push(el);
        }
    });
    
    // Contar divs (deberían ser pocos)
    const divCount = (solucion.match(/<div/g) || []).length;
    
    // Puntaje
    const score = encontrados.length / elementosRequeridos.length * 100;
    
    // Mostrar feedback
    let feedbackHTML = \'\';
    
    if (score === 100) {
        feedbackHTML = `
            <div class="feedback-excelente">
                <h4>🎉 ¡Excelente! Puntuación perfecta: 100%</h4>
                <p>Has usado correctamente todas las etiquetas semánticas requeridas.</p>
                <p><strong>Elementos encontrados:</strong> ${encontrados.join(\', \')}</p>
                ${divCount > 0 ? `<p>💡 Sugerencia: Podrías reducir los divs (actualmente: ${divCount})</p>` : \'\'}
            </div>
        `;
    } else if (score >= 70) {
        const faltantes = elementosRequeridos.filter(el => !encontrados.includes(el));
        feedbackHTML = `
            <div class="feedback-bueno">
                <h4>👍 Buen trabajo: ${Math.round(score)}%</h4>
                <p>Has usado la mayoría de etiquetas semánticas.</p>
                <p><strong>Elementos encontrados:</strong> ${encontrados.join(\', \')}</p>
                <p><strong>Te faltó:</strong> ${faltantes.join(\', \')}</p>
                <p>Sugerencia: Intenta reemplazar más divs por estas etiquetas.</p>
            </div>
        `;
    } else {
        feedbackHTML = `
            <div class="feedback-mejorable">
                <h4>📚 Necesitas mejorar: ${Math.round(score)}%</h4>
                <p>Te recomendamos revisar las etiquetas semánticas básicas.</p>
                <p><strong>Elementos encontrados:</strong> ${encontrados.length > 0 ? encontrados.join(\', \') : \'Ninguno\'}</p>
                <p><strong>Divs encontrados:</strong> ${divCount} (intenta reducirlos)</p>
                <p>💡 Usa el botón "VER SOLUCIÓN MODELO" para ver un ejemplo.</p>
            </div>
        `;
    }
    
    feedback.innerHTML = feedbackHTML;
}

function mostrarSolucion() {
    const solucionModelo = `<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Sitio Web Semántico</title>
</head>
<body>
    <header>
        <div class="logo">Logo</div>
        <nav class="links">
            <a href="#">Home</a>
            <a href="#">About</a>
        </nav>
    </header>
    
    <main>
        <article class="post">
            <h2 class="title">Título del Post</h2>
            <p>Contenido del artículo...</p>
        </article>
        
        <aside class="sidebar">
            <div class="widget">
                <h3 class="widget-title">Enlaces rápidos</h3>
                <div class="widget-content">
                    <a href="#">Link 1</a>
                    <a href="#">Link 2</a>
                </div>
            </div>
        </aside>
    </main>
    
    <footer>
        <p>Copyright © 2024</p>
    </footer>
</body>
</html>`;
    
    document.getElementById(\'solucionEditor\').value = solucionModelo;
    mostrarNotificacion(\'Solución modelo cargada\', \'info\');
}

function limpiarSolucion() {
    document.getElementById(\'solucionEditor\').value = \'\';
    document.getElementById(\'solucionFeedback\').innerHTML = `
        <div class="feedback-initial">
            <p>💡 <strong>Instrucciones:</strong> Corrige el código usando etiquetas semánticas apropiadas.</p>
        </div>
    `;
    mostrarNotificacion(\'Editor de solución limpiado\', \'info\');
}

// ========================================
// SIMULADOR HTML COMPLETO
// ========================================
function cambiarTab(tabName) {
    // Ocultar todas las pestañas
    document.querySelectorAll(\'.tab-pane\').forEach(tab => {
        tab.classList.remove(\'active\');
    });
    
    // Desactivar todos los botones
    document.querySelectorAll(\'.tab-btn\').forEach(btn => {
        btn.classList.remove(\'active\');
    });
    
    // Mostrar pestaña seleccionada
    document.getElementById(`tab-${tabName}`).classList.add(\'active\');
    
    // Activar botón correspondiente
    event.target.classList.add(\'active\');
    
    // Si es la pestaña de vista, actualizar
    if (tabName === \'vista\') {
        actualizarVista();
    }
}

function ejecutarHTML() {
    const code = document.getElementById(\'htmlCompleto\').value;
    
    // Actualizar vista previa
    const iframe = document.getElementById(\'htmlPreview\');
    const iframeDoc = iframe.contentDocument || iframe.contentWindow.document;
    iframeDoc.open();
    iframeDoc.write(code);
    iframeDoc.close();
    
    // Mostrar en consola
    agregarConsola(\'✅ Código HTML ejecutado correctamente\');
    agregarConsola(`📏 Longitud: ${code.length} caracteres`);
    
    // Analizar etiquetas
    const tags = code.match(/<[a-z][\\s>]/gi) || [];
    agregarConsola(`🏷️ Etiquetas detectadas: ${tags.length}`);
    
    // Verificar etiquetas semánticas
    const semanticTags = [\'header\', \'nav\', \'main\', \'article\', \'section\', \'aside\', \'footer\'];
    let semanticCount = 0;
    semanticTags.forEach(tag => {
        if (code.includes(\'<\' + tag)) {
            semanticCount++;
            agregarConsola(`✅ Encontrado: &lt;${tag}&gt;`);
        }
    });
    
    if (semanticCount === 0) {
        agregarConsola(\'⚠️ No se encontraron etiquetas semánticas\');
    }
    
    mostrarNotificacion(\'Código HTML ejecutado en vista previa\', \'success\');
}

function actualizarVista() {
    ejecutarHTML();
    agregarConsola(\'🔄 Vista previa actualizada\');
}

function cambiarTamanoVista() {
    const size = document.getElementById(\'viewSize\').value;
    const iframe = document.getElementById(\'htmlPreview\');
    
    if (size === \'mobile\') {
        iframe.style.width = \'375px\';
        iframe.style.height = \'667px\';
    } else {
        iframe.style.width = size;
        iframe.style.height = \'500px\';
    }
    
    agregarConsola(`📱 Tamaño de vista cambiado a: ${size}`);
}

function guardarHTML() {
    const code = document.getElementById(\'htmlCompleto\').value;
    localStorage.setItem(\'htmlCodeBackup\', code);
    agregarConsola(\'💾 Código guardado en almacenamiento local\');
    mostrarNotificacion(\'Código guardado en almacenamiento local\', \'success\');
}

function descargarHTML() {
    const code = document.getElementById(\'htmlCompleto\').value;
    const blob = new Blob([code], { type: \'text/html\' });
    const url = URL.createObjectURL(blob);
    const a = document.createElement(\'a\');
    a.href = url;
    a.download = \'mi-pagina-web.html\';
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
    URL.revokeObjectURL(url);
    
    agregarConsola(\'📥 Archivo HTML descargado: mi-pagina-web.html\');
    mostrarNotificacion(\'Archivo descargado: mi-pagina-web.html\', \'success\');
}

function agregarConsola(mensaje) {
    const consola = document.getElementById(\'consoleOutput\');
    const entry = document.createElement(\'div\');
    entry.className = \'console-entry\';
    entry.innerHTML = mensaje;
    consola.appendChild(entry);
    consola.scrollTop = consola.scrollHeight;
}

function limpiarConsola() {
    document.getElementById(\'consoleOutput\').innerHTML = \'\';
    agregarConsola(\'🗑️ Consola limpiada\');
    mostrarNotificacion(\'Consola limpiada\', \'info\');
}

// ========================================
// AUTOEVALUACIÓN
// ========================================
function actualizarEvaluacion(num, value) {
    document.getElementById(`evalValue${num}`).textContent = `${value}/5`;
    calcularPromedio();
}

function calcularPromedio() {
    const valores = [];
    
    for (let i = 1; i <= 3; i++) {
        const slider = document.querySelector(`#evalValue${i}`);
        if (slider) {
            const valor = parseInt(slider.textContent);
            valores.push(valor);
        }
    }
    
    if (valores.length > 0) {
        const promedio = (valores.reduce((a, b) => a + b) / valores.length).toFixed(1);
        document.getElementById(\'evalAverage\').textContent = promedio;
    }
}

function guardarEvaluacion() {
    const promedio = document.getElementById(\'evalAverage\').textContent;
    const evaluacion = {
        fecha: new Date().toISOString(),
        semantica: document.getElementById(\'evalValue1\').textContent,
        formularios: document.getElementById(\'evalValue2\').textContent,
        errores: document.getElementById(\'evalValue3\').textContent,
        promedio: promedio
    };
    
    localStorage.setItem(\'html5Evaluacion\', JSON.stringify(evaluacion));
    
    alert(`📊 Evaluación guardada:\\n\\n` +
          `Comprensión semántica: ${evaluacion.semantica}\\n` +
          `Formularios HTML5: ${evaluacion.formularios}\\n` +
          `Detección de errores: ${evaluacion.errores}\\n\\n` +
          `Promedio: ${evaluacion.promedio}/5\\n\\n` +
          `Los datos se han guardado en tu navegador.`);
    
    mostrarNotificacion(\'Autoevaluación guardada correctamente\', \'success\');
}

// ========================================
// INICIALIZACIÓN
// ========================================
document.addEventListener(\'DOMContentLoaded\', function() {
    // Inicializar simulador de estructura
    analizarHTML();
    
    // Inicializar simulador HTML completo
    ejecutarHTML();
    
    // Cargar evaluación guardada si existe
    const evaluacionGuardada = localStorage.getItem(\'html5Evaluacion\');
    if (evaluacionGuardada) {
        try {
            const evalData = JSON.parse(evaluacionGuardada);
            document.getElementById(\'evalValue1\').textContent = evalData.semantica;
            document.getElementById(\'evalValue2\').textContent = evalData.formularios;
            document.getElementById(\'evalValue3\').textContent = evalData.errores;
            document.getElementById(\'evalAverage\').textContent = evalData.promedio;
            
            // Establecer valores de sliders
            document.querySelectorAll(\'.eval-slider\').forEach((slider, index) => {
                const value = parseInt(evalData[[\'semantica\', \'formularios\', \'errores\'][index]]);
                slider.value = value;
            });
            
            mostrarNotificacion(\'Evaluación previa cargada\', \'info\');
        } catch (e) {
            console.log(\'No se pudo cargar evaluación previa\');
        }
    }
    
    // Configurar altura fija del editor
    const editor = document.getElementById(\'htmlEditor\');
    editor.style.height = \'400px\';
    editor.style.minHeight = \'400px\';
    editor.style.maxHeight = \'400px\';
    
    // Asegurar que el textarea mantenga su tamaño
    editor.addEventListener(\'input\', function() {
        this.style.height = \'400px\';
        this.style.minHeight = \'400px\';
        this.style.maxHeight = \'400px\';
    });
    
    console.log(\'🚀 Sistema HTML5 Cyberpunk inicializado completamente\');
    console.log(\'📚 Lección: HTML5 Semántico Avanzado\');
    console.log(\'⚡ Simuladores, formularios y evaluaciones listos\');
    
    // Mostrar notificación de bienvenida
    setTimeout(() => {
        mostrarNotificacion(\'🚀 Sistema HTML5 Cyberpunk listo. ¡Comienza a aprender!\', \'success\');
    }, 1000);
});
</script>
<!-- FIN LECCIÓN CYBERPUNK OPTIMIZADA -->',
    'ejercicios' => 
    array (
      0 => 
      array (
        'enunciado' => 'DOCTYPE HTML5',
        'respuesta' => '<!DOCTYPE html>',
      ),
      1 => 
      array (
        'enunciado' => 'Tag raíz',
        'respuesta' => '<html>',
      ),
      2 => 
      array (
        'enunciado' => 'Meta charset',
        'respuesta' => '<meta charset="UTF-8">',
      ),
      3 => 
      array (
        'enunciado' => 'Viewport meta',
        'respuesta' => '<meta name="viewport" content="width=device-width, initial-scale=1.0">',
      ),
      4 => 
      array (
        'enunciado' => 'Encabezado semántico',
        'respuesta' => '<header>',
      ),
      5 => 
      array (
        'enunciado' => 'Menú navegación',
        'respuesta' => '<nav>',
      ),
      6 => 
      array (
        'enunciado' => 'Contenido principal',
        'respuesta' => '<main>',
      ),
      7 => 
      array (
        'enunciado' => 'Artículo independiente',
        'respuesta' => '<article>',
      ),
      8 => 
      array (
        'enunciado' => 'Pie de página',
        'respuesta' => '<footer>',
      ),
      9 => 
      array (
        'enunciado' => 'Formulario input email',
        'respuesta' => '<input type="email">',
      ),
      10 => 
      array (
        'enunciado' => 'SI: % soporte HTML5',
        'respuesta' => '99.9%',
      ),
      11 => 
      array (
        'enunciado' => 'Canvas para',
        'respuesta' => 'Gráficos 2D',
      ),
    ),
    'quiz' => 
    array (
      0 => 
      array (
        'pregunta' => 'HTML5 es',
        'opciones' => 
        array (
          0 => 'Estándar actual',
          1 => 'Obsoleto',
          2 => 'Solo móvil',
          3 => 'Backend',
        ),
        'correcta' => 'Estándar actual',
      ),
      1 => 
      array (
        'pregunta' => 'Tag semántico para menú',
        'opciones' => 
        array (
          0 => '<nav>',
          1 => '<menu>',
          2 => '<ul>',
          3 => '<div>',
        ),
        'correcta' => '<nav>',
      ),
      2 => 
      array (
        'pregunta' => '<main> debe haber',
        'opciones' => 
        array (
          0 => 'Uno por página',
          1 => 'Varios',
          2 => 'Ninguno',
          3 => 'Opcional',
        ),
        'correcta' => 'Uno por página',
      ),
      3 => 
      array (
        'pregunta' => 'SEO mejora con',
        'opciones' => 
        array (
          0 => 'Tags semánticos',
          1 => 'Divs',
          2 => 'Span',
          3 => 'P',
        ),
        'correcta' => 'Tags semánticos',
      ),
      4 => 
      array (
        'pregunta' => 'Accesibilidad usa',
        'opciones' => 
        array (
          0 => 'ARIA, alt',
          1 => 'Solo CSS',
          2 => 'JS',
          3 => 'PHP',
        ),
        'correcta' => 'ARIA, alt',
      ),
      5 => 
      array (
        'pregunta' => 'Canvas API',
        'opciones' => 
        array (
          0 => '2D/3D',
          1 => 'Solo 2D',
          2 => 'Solo audio',
          3 => 'Texto',
        ),
        'correcta' => '2D/3D',
      ),
      6 => 
      array (
        'pregunta' => 'Video nativo',
        'opciones' => 
        array (
          0 => '<video>',
          1 => '<iframe>',
          2 => '<object>',
          3 => '<embed>',
        ),
        'correcta' => '<video>',
      ),
      7 => 
      array (
        'pregunta' => 'Form validation nativo',
        'opciones' => 
        array (
          0 => 'HTML5',
          1 => 'JS',
          2 => 'CSS',
          3 => 'PHP',
        ),
        'correcta' => 'HTML5',
      ),
      8 => 
      array (
        'pregunta' => 'LocalStorage guarda',
        'opciones' => 
        array (
          0 => 'Datos cliente',
          1 => 'Server',
          2 => 'Cookie',
          3 => 'DB',
        ),
        'correcta' => 'Datos cliente',
      ),
      9 => 
      array (
        'pregunta' => 'Geolocation API',
        'opciones' => 
        array (
          0 => 'navigator.geolocation',
          1 => 'window.location',
          2 => 'document.geo',
          3 => 'HTML',
        ),
        'correcta' => 'navigator.geolocation',
      ),
      10 => 
      array (
        'pregunta' => 'Tag para artículo',
        'opciones' => 
        array (
          0 => '<article>',
          1 => '<section>',
          2 => '<div>',
          3 => '<p>',
        ),
        'correcta' => '<article>',
      ),
      11 => 
      array (
        'pregunta' => 'Sidebar usa',
        'opciones' => 
        array (
          0 => '<aside>',
          1 => '<div>',
          2 => '<section>',
          3 => '<article>',
        ),
        'correcta' => '<aside>',
      ),
      12 => 
      array (
        'pregunta' => 'Input type="date"',
        'opciones' => 
        array (
          0 => 'Selector fecha',
          1 => 'Texto',
          2 => 'Número',
          3 => 'Email',
        ),
        'correcta' => 'Selector fecha',
      ),
      13 => 
      array (
        'pregunta' => 'required atributo',
        'opciones' => 
        array (
          0 => 'Validación',
          1 => 'Estilo',
          2 => 'Evento',
          3 => 'Nada',
        ),
        'correcta' => 'Validación',
      ),
      14 => 
      array (
        'pregunta' => 'placeholder es',
        'opciones' => 
        array (
          0 => 'Texto guía',
          1 => 'Valor',
          2 => 'Label',
          3 => 'Error',
        ),
        'correcta' => 'Texto guía',
      ),
      15 => 
      array (
        'pregunta' => 'autocomplete',
        'opciones' => 
        array (
          0 => 'off/on',
          1 => 'Siempre',
          2 => 'Nunca',
          3 => 'Error',
        ),
        'correcta' => 'off/on',
      ),
      16 => 
      array (
        'pregunta' => 'SI 2025: % HTML5',
        'opciones' => 
        array (
          0 => '99.9%',
          1 => '80%',
          2 => '50%',
          3 => '10%',
        ),
        'correcta' => '99.9%',
      ),
      17 => 
      array (
        'pregunta' => 'PWA necesita',
        'opciones' => 
        array (
          0 => 'HTML5 + Service Worker',
          1 => 'Solo HTML',
          2 => 'Flash',
          3 => 'Java',
        ),
        'correcta' => 'HTML5 + Service Worker',
      ),
      18 => 
      array (
        'pregunta' => 'Web Components',
        'opciones' => 
        array (
          0 => 'Custom Elements',
          1 => 'Divs',
          2 => 'React',
          3 => 'Vue',
        ),
        'correcta' => 'Custom Elements',
      ),
      19 => 
      array (
        'pregunta' => 'Shadow DOM',
        'opciones' => 
        array (
          0 => 'Encapsula estilos',
          1 => 'Global',
          2 => 'Nada',
          3 => 'Error',
        ),
        'correcta' => 'Encapsula estilos',
      ),
      20 => 
      array (
        'pregunta' => 'HTML es',
        'opciones' => 
        array (
          0 => 'Lenguaje marcado',
          1 => 'Programación',
          2 => 'Estilo',
          3 => 'BD',
        ),
        'correcta' => 'Lenguaje marcado',
      ),
      21 => 
      array (
        'pregunta' => 'CSS es para',
        'opciones' => 
        array (
          0 => 'Estilo',
          1 => 'Estructura',
          2 => 'Lógica',
          3 => 'Datos',
        ),
        'correcta' => 'Estilo',
      ),
      22 => 
      array (
        'pregunta' => 'JS es para',
        'opciones' => 
        array (
          0 => 'Comportamiento',
          1 => 'Estructura',
          2 => 'Estilo',
          3 => 'Server',
        ),
        'correcta' => 'Comportamiento',
      ),
      23 => 
      array (
        'pregunta' => 'Responsive con',
        'opciones' => 
        array (
          0 => 'Viewport + media queries',
          1 => 'Solo CSS',
          2 => 'JS',
          3 => 'PHP',
        ),
        'correcta' => 'Viewport + media queries',
      ),
      24 => 
      array (
        'pregunta' => 'alt atributo',
        'opciones' => 
        array (
          0 => 'Accesibilidad',
          1 => 'Estilo',
          2 => 'Tamaño',
          3 => 'Nada',
        ),
        'correcta' => 'Accesibilidad',
      ),
      25 => 
      array (
        'pregunta' => 'lang atributo',
        'opciones' => 
        array (
          0 => 'Idioma',
          1 => 'País',
          2 => 'Moneda',
          3 => 'Hora',
        ),
        'correcta' => 'Idioma',
      ),
      26 => 
      array (
        'pregunta' => 'manifest.json para',
        'opciones' => 
        array (
          0 => 'PWA',
          1 => 'SEO',
          2 => 'Estilo',
          3 => 'JS',
        ),
        'correcta' => 'PWA',
      ),
      27 => 
      array (
        'pregunta' => 'SI 2025: % PWA',
        'opciones' => 
        array (
          0 => '+70% apps',
          1 => '30%',
          2 => '10%',
          3 => '0%',
        ),
        'correcta' => '+70% apps',
      ),
      28 => 
      array (
        'pregunta' => 'HTML ideal para',
        'opciones' => 
        array (
          0 => 'Estructura, SEO, accesibilidad',
          1 => 'Diseño',
          2 => 'Lógica',
          3 => 'Backend',
        ),
        'correcta' => 'Estructura, SEO, accesibilidad',
      ),
      29 => 
      array (
        'pregunta' => 'Futuro HTML',
        'opciones' => 
        array (
          0 => 'Web Components, PWA, IA',
          1 => 'Flash',
          2 => 'Silverlight',
          3 => 'Static',
        ),
        'correcta' => 'Web Components, PWA, IA',
      ),
    ),
  ),
  8 => 
  array (
    'materia' => 'Programación',
    'slug' => 'css3-avanzado-cyberpunk',
    'titulo' => 'CSS3 AVANZADO: Flexbox, Grid, Animaciones y Simuladores Interactivos',
    'contenido' => '<!-- INICIO LECCIÓN CSS3 CYBERPUNK OPTIMIZADA -->
<div class="leccion-container leccion-programacion-css3" data-tema="css3-avanzado">

    <!-- CABECERA COMPACTA -->
    <header class="leccion-header compact">
        <div class="header-top">
            <span class="materia-badge">🎨 PROGRAMACIÓN CSS3</span>
            <span class="nivel-badge">⚡ NIVEL AVANZADO</span>
            <span class="tiempo-badge">⏱️ 50 MIN</span>
        </div>
        <h1 class="titulo-leccion">
            <span class="neon-icon">🎨</span>CSS3 AVANZADO 2025
        </h1>
        <p class="leccion-subtitulo">Flexbox • Grid • Variables • Animaciones • Simuladores Interactivos</p>
    </header>

    <!-- PANEL OBJETIVOS RÁPIDO -->
    <section class="objetivos-rapidos">
        <div class="objetivos-grid">
            <div class="objetivo-card">
                <div class="obj-icon">🎯</div>
                <div class="obj-text">
                    <h4>Dominar Flexbox & Grid</h4>
                    <p>Layouts 1D y 2D con sistemas modernos</p>
                </div>
            </div>
            <div class="objetivo-card">
                <div class="obj-icon">🔧</div>
                <div class="obj-text">
                    <h4>Animaciones avanzadas</h4>
                    <p>Keyframes, transformaciones 3D y transiciones</p>
                </div>
            </div>
            <div class="objetivo-card">
                <div class="obj-icon">📈</div>
                <div class="obj-text">
                    <h4>Simuladores en tiempo real</h4>
                    <p>Prueba CSS y ve resultados al instante</p>
                </div>
            </div>
        </div>
    </section>

    <!-- SECCIÓN PRINCIPAL -->
    <div class="seccion-principal">

        <!-- PANEL DE DATOS CSS3 -->
        <section class="datos-css3">
            <h2 class="seccion-titulo">
                <span class="neon-bullet">📊</span> CSS3 EN 2025: DATOS CLAVE
            </h2>
            
            <div class="datos-grid">
                <div class="dato-card">
                    <div class="dato-icon">🌐</div>
                    <div class="dato-content">
                        <h4>Soporte Global</h4>
                        <div class="dato-valor">98%</div>
                        <p>CanIUse - Compatibilidad mundial</p>
                    </div>
                </div>
                
                <div class="dato-card">
                    <div class="dato-icon">🚀</div>
                    <div class="dato-content">
                        <h4>Sitios Top 1000</h4>
                        <div class="dato-valor">95%</div>
                        <p>HTTP Archive - Adopción masiva</p>
                    </div>
                </div>
                
                <div class="dato-card">
                    <div class="dato-icon">⚡</div>
                    <div class="dato-content">
                        <h4>Performance</h4>
                        <div class="dato-valor">60 FPS</div>
                        <p>Renderizado GPU acelerado</p>
                    </div>
                </div>
                
                <div class="dato-card">
                    <div class="dato-icon">🎨</div>
                    <div class="dato-content">
                        <h4>Layouts Modernos</h4>
                        <div class="dato-valor">90%</div>
                        <p>Flexbox + Grid combinados</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- MÓDULOS CSS3 - TABLA INTERACTIVA -->
        <section class="modulos-css3">
            <h2 class="seccion-titulo">
                <span class="neon-bullet">📚</span> MÓDULOS CLAVE CSS3
            </h2>
            
            <div class="modulos-grid-interactivo">
                <div class="modulo-card" data-modulo="flexbox">
                    <div class="modulo-header">
                        <div class="modulo-icon">📏</div>
                        <h3>Flexbox</h3>
                        <span class="modulo-tag">Layout 1D</span>
                    </div>
                    <div class="modulo-content">
                        <p>Distribución flexible en una dimensión</p>
                        <code>display: flex;</code>
                        <div class="modulo-stats">
                            <span>Soporte: 99.5%</span>
                            <span>Desde: 2012</span>
                        </div>
                    </div>
                    <button class="modulo-btn" onclick="mostrarDemo(\'flexbox\')">Ver Demo</button>
                </div>
                
                <div class="modulo-card" data-modulo="grid">
                    <div class="modulo-header">
                        <div class="modulo-icon">🔳</div>
                        <h3>Grid</h3>
                        <span class="modulo-tag">Layout 2D</span>
                    </div>
                    <div class="modulo-content">
                        <p>Sistema bidimensional completo</p>
                        <code>display: grid;</code>
                        <div class="modulo-stats">
                            <span>Soporte: 97.5%</span>
                            <span>Desde: 2017</span>
                        </div>
                    </div>
                    <button class="modulo-btn" onclick="mostrarDemo(\'grid\')">Ver Demo</button>
                </div>
                
                <div class="modulo-card" data-modulo="variables">
                    <div class="modulo-header">
                        <div class="modulo-icon">🎨</div>
                        <h3>Variables CSS</h3>
                        <span class="modulo-tag">Custom Properties</span>
                    </div>
                    <div class="modulo-content">
                        <p>Variables reutilizables en CSS</p>
                        <code>--color: #43A047;</code>
                        <div class="modulo-stats">
                            <span>Soporte: 96%</span>
                            <span>Desde: 2017</span>
                        </div>
                    </div>
                    <button class="modulo-btn" onclick="mostrarDemo(\'variables\')">Ver Demo</button>
                </div>
                
                <div class="modulo-card" data-modulo="animaciones">
                    <div class="modulo-header">
                        <div class="modulo-icon">✨</div>
                        <h3>Animaciones</h3>
                        <span class="modulo-tag">Keyframes</span>
                    </div>
                    <div class="modulo-content">
                        <p>Secuencias de animación complejas</p>
                        <code>@keyframes</code>
                        <div class="modulo-stats">
                            <span>Soporte: 99%</span>
                            <span>Desde: 2012</span>
                        </div>
                    </div>
                    <button class="modulo-btn" onclick="mostrarDemo(\'animaciones\')">Ver Demo</button>
                </div>
                
                <div class="modulo-card" data-modulo="transiciones">
                    <div class="modulo-header">
                        <div class="modulo-icon">🔄</div>
                        <h3>Transiciones</h3>
                        <span class="modulo-tag">Efectos suaves</span>
                    </div>
                    <div class="modulo-content">
                        <p>Interpolación entre estados</p>
                        <code>transition: all 0.3s;</code>
                        <div class="modulo-stats">
                            <span>Soporte: 99.5%</span>
                            <span>Desde: 2012</span>
                        </div>
                    </div>
                    <button class="modulo-btn" onclick="mostrarDemo(\'transiciones\')">Ver Demo</button>
                </div>
                
                <div class="modulo-card" data-modulo="media">
                    <div class="modulo-header">
                        <div class="modulo-icon">📱</div>
                        <h3>Media Queries</h3>
                        <span class="modulo-tag">Responsive</span>
                    </div>
                    <div class="modulo-content">
                        <p>Adaptación a diferentes pantallas</p>
                        <code>@media (max-width: 768px)</code>
                        <div class="modulo-stats">
                            <span>Soporte: 99%</span>
                            <span>Desde: 2012</span>
                        </div>
                    </div>
                    <button class="modulo-btn" onclick="mostrarDemo(\'media\')">Ver Demo</button>
                </div>
            </div>
        </section>

        <!-- SIMULADOR CSS AVANZADO -->
        <section class="simulador-css-avanzado">
            <h2 class="seccion-titulo">
                <span class="neon-bullet">⚡</span> SIMULADOR CSS EN TIEMPO REAL
            </h2>
            
            <div class="simulador-container-completo">
                <div class="simulador-tabs">
                    <div class="tab-header">
                        <button class="tab-btn active" onclick="cambiarTabCss(\'editor\')">✏️ EDITOR</button>
                        <button class="tab-btn" onclick="cambiarTabCss(\'visual\')">👁️ VISTA</button>
                        <button class="tab-btn" onclick="cambiarTabCss(\'resultado\')">📊 RESULTADO</button>
                    </div>
                    
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab-editor-css">
                            <div class="editor-css-completo">
                                <div class="editor-header">
                                    <span>style.css</span>
                                    <div class="editor-actions">
                                        <button onclick="aplicarCSS()" class="btn-ejecutar">▶ APLICAR</button>
                                        <button onclick="guardarCSS()" class="btn-guardar">💾 GUARDAR</button>
                                        <button onclick="cargarEjemploCSS()" class="btn-ejemplo">📋 EJEMPLO</button>
                                    </div>
                                </div>
                                <textarea id="cssEditor" class="editor-css-textarea" spellcheck="false" rows="15">/* SIMULADOR CSS INTERACTIVO - EDITA Y VE RESULTADOS */

:root {
    --color-primario: #43A047;
    --color-secundario: #2E7D32;
    --sombra: 0 4px 12px rgba(0,0,0,0.4);
}

/* EJEMPLO FLEXBOX */
.container-flex {
    display: flex;
    gap: 1rem;
    padding: 1rem;
    background: rgba(255, 255, 255, 0.05);
    border-radius: 8px;
    margin: 1rem 0;
}

.flex-item {
    flex: 1;
    padding: 1.5rem;
    background: var(--color-primario);
    color: white;
    border-radius: 6px;
    text-align: center;
    transition: transform 0.3s ease;
}

.flex-item:hover {
    transform: translateY(-5px);
    background: var(--color-secundario);
}

/* EJEMPLO GRID */
.container-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1rem;
    padding: 1rem;
    background: rgba(255, 255, 255, 0.05);
    border-radius: 8px;
    margin: 1rem 0;
}

.grid-item {
    padding: 1.5rem;
    background: linear-gradient(135deg, #43A047, #66BB6A);
    color: white;
    border-radius: 8px;
    text-align: center;
    box-shadow: var(--sombra);
}

/* ANIMACIÓN */
@keyframes pulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.05); }
}

.animated-item {
    animation: pulse 2s infinite;
    padding: 1rem;
    background: #FF6B6B;
    color: white;
    border-radius: 6px;
    margin: 1rem 0;
}

/* TARJETA 3D */
.card-3d {
    width: 200px;
    height: 150px;
    perspective: 1000px;
    margin: 1rem auto;
}

.card-3d-inner {
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, #43A047, #66BB6A);
    border-radius: 12px;
    padding: 20px;
    color: white;
    text-align: center;
    transition: transform 0.6s, box-shadow 0.6s;
    transform-style: preserve-3d;
}

.card-3d:hover .card-3d-inner {
    transform: rotateX(10deg) rotateY(10deg);
    box-shadow: 0 20px 40px rgba(0,0,0,0.3);
}</textarea>
                            </div>
                        </div>
                        
                        <div class="tab-pane" id="tab-visual-css">
                            <div class="visual-html">
                                <div class="visual-header">
                                    <span>HTML de Referencia</span>
                                </div>
                                <pre class="html-preview"><code>&lt;div class="container-flex"&gt;
    &lt;div class="flex-item"&gt;Flex 1&lt;/div&gt;
    &lt;div class="flex-item"&gt;Flex 2&lt;/div&gt;
    &lt;div class="flex-item"&gt;Flex 3&lt;/div&gt;
&lt;/div&gt;

&lt;div class="container-grid"&gt;
    &lt;div class="grid-item"&gt;Grid 1&lt;/div&gt;
    &lt;div class="grid-item"&gt;Grid 2&lt;/div&gt;
    &lt;div class="grid-item"&gt;Grid 3&lt;/div&gt;
    &lt;div class="grid-item"&gt;Grid 4&lt;/div&gt;
&lt;/div&gt;

&lt;div class="animated-item"&gt;
    ✨ Elemento Animado
&lt;/div&gt;

&lt;div class="card-3d"&gt;
    &lt;div class="card-3d-inner"&gt;
        &lt;h4&gt;Tarjeta 3D&lt;/h4&gt;
        &lt;p&gt;Hover me!&lt;/p&gt;
    &lt;/div&gt;
&lt;/div&gt;</code></pre>
                            </div>
                        </div>
                        
                        <div class="tab-pane" id="tab-resultado-css">
                            <div class="resultado-live">
                                <div class="resultado-header">
                                    <span>Resultado en Vivo</span>
                                    <button onclick="aplicarCSS()" class="btn-actualizar">🔄 ACTUALIZAR</button>
                                </div>
                                <div class="resultado-contenido" id="cssResultado">
                                    <!-- Aquí se inyecta el resultado -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="simulador-controls">
                    <div class="controls-info">
                        <h4>🎮 Controles del Simulador</h4>
                        <div class="controls-buttons">
                            <button onclick="aplicarCSS()" class="btn-control">▶ EJECUTAR CSS</button>
                            <button onclick="resetCSS()" class="btn-control">🔄 REINICIAR</button>
                            <button onclick="descargarCSS()" class="btn-control">📥 DESCARGAR</button>
                        </div>
                        <p class="info-text">Edita el CSS en la pestaña "Editor" y haz clic en "EJECUTAR"</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- DEMOS INTERACTIVAS -->
        <section class="demos-interactivas">
            <h2 class="seccion-titulo">
                <span class="neon-bullet">🎮</span> DEMOS INTERACTIVAS
            </h2>
            
            <div class="demos-grid">
                <!-- DEMO FLEXBOX -->
                <div class="demo-container">
                    <div class="demo-header">
                        <h4>📏 Flexbox Playground</h4>
                        <div class="demo-controls">
                            <label>justify-content:</label>
                            <select id="flexJustify" onchange="actualizarFlexbox()">
                                <option value="flex-start">flex-start</option>
                                <option value="center" selected>center</option>
                                <option value="flex-end">flex-end</option>
                                <option value="space-between">space-between</option>
                                <option value="space-around">space-around</option>
                                <option value="space-evenly">space-evenly</option>
                            </select>
                        </div>
                    </div>
                    <div class="demo-content">
                        <div class="flex-playground" id="flexPlayground">
                            <div class="flex-demo-item">1</div>
                            <div class="flex-demo-item">2</div>
                            <div class="flex-demo-item">3</div>
                            <div class="flex-demo-item">4</div>
                        </div>
                        <div class="demo-code">
                            <code id="flexCode">display: flex;<br>justify-content: center;</code>
                        </div>
                    </div>
                </div>
                
                <!-- DEMO GRID -->
                <div class="demo-container">
                    <div class="demo-header">
                        <h4>🔳 Grid Generator</h4>
                        <div class="demo-controls">
                            <label>grid-template-columns:</label>
                            <select id="gridColumns" onchange="actualizarGrid()">
                                <option value="1fr">1fr</option>
                                <option value="1fr 1fr">1fr 1fr</option>
                                <option value="1fr 1fr 1fr" selected>1fr 1fr 1fr</option>
                                <option value="repeat(4, 1fr)">repeat(4, 1fr)</option>
                                <option value="2fr 1fr 1fr">2fr 1fr 1fr</option>
                            </select>
                        </div>
                    </div>
                    <div class="demo-content">
                        <div class="grid-playground" id="gridPlayground">
                            <div class="grid-demo-item">1</div>
                            <div class="grid-demo-item">2</div>
                            <div class="grid-demo-item">3</div>
                            <div class="grid-demo-item">4</div>
                            <div class="grid-demo-item">5</div>
                            <div class="grid-demo-item">6</div>
                        </div>
                        <div class="demo-code">
                            <code id="gridCode">display: grid;<br>grid-template-columns: 1fr 1fr 1fr;</code>
                        </div>
                    </div>
                </div>
                
                <!-- DEMO ANIMACIONES -->
                <div class="demo-container">
                    <div class="demo-header">
                        <h4>✨ Animaciones CSS</h4>
                        <div class="demo-controls">
                            <label>animation:</label>
                            <select id="animType" onchange="actualizarAnimacion()">
                                <option value="pulse">pulse</option>
                                <option value="bounce">bounce</option>
                                <option value="rotate" selected>rotate</option>
                                <option value="slide">slide</option>
                            </select>
                        </div>
                    </div>
                    <div class="demo-content">
                        <div class="anim-playground">
                            <div class="anim-demo-item" id="animDemo">
                                CSS3
                            </div>
                        </div>
                        <div class="demo-code">
                            <code id="animCode">@keyframes rotate {<br>  to { transform: rotate(360deg); }<br>}</code>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- RETOS AVANZADOS -->
        <section class="retos-css3">
            <h2 class="seccion-titulo">
                <span class="neon-bullet">💪</span> RETOS CSS3 AVANZADOS
            </h2>
            
            <div class="retos-grid">
                <div class="reto-card">
                    <div class="reto-header">
                        <span class="reto-dificultad">🟢 BÁSICO</span>
                        <h4>Reto 1: Tarjeta con Hover 3D</h4>
                    </div>
                    <div class="reto-description">
                        <p>Crea una tarjeta con efecto 3D realista usando transformaciones CSS.</p>
                        <div class="reto-preview">
                            <div class="preview-card-3d" onclick="toggleSolucion(1)">
                                <div class="preview-inner">
                                    <h5>Hover me!</h5>
                                    <p>Efecto 3D con CSS</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="reto-solucion" id="solucion1" style="display: none;">
                        <pre><code>.card-3d {
    width: 300px;
    height: 200px;
    perspective: 1000px;
}

.card-3d-inner {
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, #43A047, #66BB6A);
    border-radius: 12px;
    padding: 20px;
    color: white;
    text-align: center;
    transition: transform 0.6s, box-shadow 0.6s;
    transform-style: preserve-3d;
}

.card-3d:hover .card-3d-inner {
    transform: rotateX(15deg) rotateY(15deg);
    box-shadow: 0 20px 40px rgba(0,0,0,0.3);
}</code></pre>
                    </div>
                </div>
                
                <div class="reto-card">
                    <div class="reto-header">
                        <span class="reto-dificultad">🟡 INTERMEDIO</span>
                        <h4>Reto 2: Grid Responsive Completo</h4>
                    </div>
                    <div class="reto-description">
                        <p>Crea un layout responsive que cambie de 1 a 4 columnas automáticamente.</p>
                        <div class="reto-preview">
                            <div class="preview-grid-responsive" onclick="toggleSolucion(2)">
                                <div>1</div><div>2</div><div>3</div><div>4</div>
                            </div>
                        </div>
                    </div>
                    <div class="reto-solucion" id="solucion2" style="display: none;">
                        <pre><code>.container {
    display: grid;
    gap: 1rem;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    padding: 1rem;
}

.item {
    background: #43A047;
    padding: 2rem;
    border-radius: 8px;
    color: white;
    text-align: center;
}

/* Para móviles */
@media (max-width: 768px) {
    .container {
        grid-template-columns: 1fr;
    }
}</code></pre>
                    </div>
                </div>
                
                <div class="reto-card">
                    <div class="reto-header">
                        <span class="reto-dificultad">🔴 AVANZADO</span>
                        <h4>Reto 3: Animación Keyframes Compleja</h4>
                    </div>
                    <div class="reto-description">
                        <p>Crea una animación con múltiples pasos y propiedades.</p>
                        <div class="reto-preview">
                            <div class="preview-anim-compleja" onclick="toggleSolucion(3)">
                                <div class="anim-compleja">✨</div>
                            </div>
                        </div>
                    </div>
                    <div class="reto-solucion" id="solucion3" style="display: none;">
                        <pre><code>@keyframes complex-animation {
    0% {
        transform: translateY(0) rotate(0);
        background: #43A047;
    }
    25% {
        transform: translateY(-20px) rotate(90deg);
        background: #2E7D32;
    }
    50% {
        transform: translateY(0) rotate(180deg);
        background: #66BB6A;
        box-shadow: 0 0 20px rgba(0,255,0,0.5);
    }
    75% {
        transform: translateY(-10px) rotate(270deg);
        background: #388E3C;
    }
    100% {
        transform: translateY(0) rotate(360deg);
        background: #43A047;
    }
}

.element {
    animation: complex-animation 3s infinite ease-in-out;
}</code></pre>
                    </div>
                </div>
            </div>
        </section>

        <!-- SVG ANIMADO MEJORADO -->
        <section class="svg-animado-mejorado">
            <h2 class="seccion-titulo">
                <span class="neon-bullet">🎨</span> SVG INTERACTIVO: PROCESO CSS3
            </h2>
            
            <div class="svg-container">
                <div class="svg-controls">
                    <button onclick="iniciarAnimacionSVG()" class="btn-svg">▶ INICIAR ANIMACIÓN</button>
                    <button onclick="pausarAnimacionSVG()" class="btn-svg">⏸️ PAUSAR</button>
                    <button onclick="reiniciarSVG()" class="btn-svg">🔄 REINICIAR</button>
                </div>
                
                <div class="svg-wrapper">
                    <svg id="css3-svg-interactivo" viewBox="0 0 900 500" xmlns="http://www.w3.org/2000/svg">
                        <rect x="0" y="0" width="900" height="500" fill="#0D1117"/>
                        
                        <!-- Título animado -->
                        <text id="svg-title" x="450" y="50" fill="#43A047" font-size="28" text-anchor="middle" 
                              font-weight="bold" class="svg-text">
                            PROCESO CSS3 → RENDER 2025
                        </text>
                        
                        <!-- CSS Block -->
                        <g id="svg-css" class="svg-element">
                            <rect x="100" y="120" width="160" height="120" fill="#2E7D32" rx="20"/>
                            <text x="180" y="155" fill="white" font-size="18" text-anchor="middle">CSS3</text>
                            <text x="180" y="185" fill="#A5D6A7" font-size="14" text-anchor="middle">Flexbox, Grid</text>
                            <text x="180" y="210" fill="#A5D6A7" font-size="12" text-anchor="middle">Variables</text>
                        </g>
                        
                        <!-- Browser -->
                        <g id="svg-browser" class="svg-element">
                            <rect x="370" y="100" width="160" height="160" fill="#1B5E20" rx="20"/>
                            <text x="450" y="140" fill="white" font-size="18" text-anchor="middle">NAVEGADOR</text>
                            <text x="450" y="170" fill="#A5D6A7" font-size="14" text-anchor="middle">Parse</text>
                            <text x="450" y="190" fill="#A5D6A7" font-size="12" text-anchor="middle">Cascade</text>
                            <text x="450" y="210" fill="#A5D6A7" font-size="12" text-anchor="middle">Layout</text>
                        </g>
                        
                        <!-- Render -->
                        <g id="svg-render" class="svg-element">
                            <rect x="660" y="120" width="160" height="120" fill="#388E3C" rx="20"/>
                            <text x="740" y="155" fill="white" font-size="18" text-anchor="middle">RENDER</text>
                            <text x="740" y="185" fill="#C8E6C9" font-size="14" text-anchor="middle">GPU</text>
                            <text x="740" y="210" fill="#C8E6C9" font-size="12" text-anchor="middle">60 FPS</text>
                        </g>
                        
                        <!-- Flechas animadas -->
                        <defs>
                            <marker id="arrow-neon" markerWidth="12" markerHeight="12" refX="10" refY="3" orient="auto">
                                <path d="M0,0 L0,6 L9,3 z" fill="#43A047"/>
                            </marker>
                        </defs>
                        
                        <line id="arrow1" x1="260" y1="180" x2="370" y2="180" 
                              stroke="#43A047" stroke-width="5" marker-end="url(#arrow-neon)"
                              class="svg-arrow"/>
                        
                        <line id="arrow2" x1="530" y1="180" x2="660" y2="180" 
                              stroke="#43A047" stroke-width="5" marker-end="url(#arrow-neon)"
                              class="svg-arrow"/>
                        
                        <!-- Estadísticas -->
                        <g id="svg-stats" class="svg-element">
                            <rect x="100" y="300" width="700" height="150" fill="#1A2E1A" rx="15"/>
                            <text x="450" y="330" fill="#81C784" font-size="16" text-anchor="middle">
                                📊 Estadísticas 2025
                            </text>
                            <text x="450" y="360" fill="#C8E6C9" font-size="14" text-anchor="middle">
                                📈 98% soporte global | 95% sitios top 1000
                            </text>
                            <text x="450" y="390" fill="#81C784" font-size="14" text-anchor="middle">
                                ⚡ 90% layouts modernos usan Flexbox + Grid
                            </text>
                            <text x="450" y="420" fill="#C8E6C9" font-size="12" text-anchor="middle">
                                🚀 CSS Houdini: Custom Paint, Properties, Layout API
                            </text>
                        </g>
                    </svg>
                </div>
                
                <div class="svg-info">
                    <p><strong>💡 Información:</strong> Este SVG muestra el flujo completo de procesamiento CSS3 en el navegador.</p>
                    <p><strong>🎯 Interactividad:</strong> Usa los botones para controlar la animación del proceso.</p>
                </div>
            </div>
        </section>

        <!-- AUTOEVALUACIÓN -->
        <section class="autoevaluacion-css3">
            <h2 class="seccion-titulo">
                <span class="neon-bullet">📊</span> AUTOEVALUACIÓN CSS3
            </h2>
            
            <div class="eval-grid">
                <div class="eval-item">
                    <div class="eval-label">
                        <span>Comprensión Flexbox</span>
                        <span class="eval-value" id="evalFlex">3/5</span>
                    </div>
                    <input type="range" min="1" max="5" value="3" class="eval-slider" 
                           oninput="actualizarEval(\'Flex\', this.value)">
                    <div class="eval-labels">
                        <span>Básico</span>
                        <span>Intermedio</span>
                        <span>Avanzado</span>
                    </div>
                </div>
                
                <div class="eval-item">
                    <div class="eval-label">
                        <span>Dominio CSS Grid</span>
                        <span class="eval-value" id="evalGrid">3/5</span>
                    </div>
                    <input type="range" min="1" max="5" value="3" class="eval-slider"
                           oninput="actualizarEval(\'Grid\', this.value)">
                    <div class="eval-labels">
                        <span>Básico</span>
                        <span>Intermedio</span>
                        <span>Avanzado</span>
                    </div>
                </div>
                
                <div class="eval-item">
                    <div class="eval-label">
                        <span>Animaciones CSS</span>
                        <span class="eval-value" id="evalAnim">3/5</span>
                    </div>
                    <input type="range" min="1" max="5" value="3" class="eval-slider"
                           oninput="actualizarEval(\'Anim\', this.value)">
                    <div class="eval-labels">
                        <span>Básico</span>
                        <span>Intermedio</span>
                        <span>Avanzado</span>
                    </div>
                </div>
            </div>
            
            <div class="eval-acciones">
                <button onclick="guardarEvalCSS()" class="btn-guardar-eval">
                    💾 GUARDAR AUTOEVALUACIÓN
                </button>
                <div class="eval-promedio">
                    <strong>Promedio:</strong> <span id="evalPromedio">3.0</span>/5
                </div>
            </div>
        </section>

        <!-- RECURSOS -->
        <section class="recursos-css3">
            <h2 class="seccion-titulo">
                <span class="neon-bullet">🔗</span> RECURSOS CSS3 AVANZADOS
            </h2>
            
            <div class="recursos-grid">
                <a href="https://css-tricks.com/snippets/css/a-guide-to-flexbox/" 
                   target="_blank" class="recurso-card">
                    <div class="recurso-icon">📏</div>
                    <div class="recurso-content">
                        <h4>CSS-Tricks Flexbox Guide</h4>
                        <p>Guía completa de Flexbox con ejemplos interactivos</p>
                    </div>
                </a>
                
                <a href="https://cssgrid.io/" 
                   target="_blank" class="recurso-card">
                    <div class="recurso-icon">🔳</div>
                    <div class="recurso-content">
                        <h4>CSS Grid Course</h4>
                        <p>Curso gratuito de CSS Grid por Wes Bos</p>
                    </div>
                </a>
                
                <a href="https://developer.mozilla.org/en-US/docs/Web/CSS/CSS_Animations" 
                   target="_blank" class="recurso-card">
                    <div class="recurso-icon">✨</div>
                    <div class="recurso-content">
                        <h4>MDN CSS Animations</h4>
                        <p>Documentación oficial de animaciones CSS</p>
                    </div>
                </a>
                
                <a href="https://caniuse.com/" 
                   target="_blank" class="recurso-card">
                    <div class="recurso-icon">🌐</div>
                    <div class="recurso-content">
                        <h4>Can I Use</h4>
                        <p>Tablas de compatibilidad de características CSS</p>
                    </div>
                </a>
            </div>
        </section>
    </div>
</div>

<!-- JAVASCRIPT COMPLETO Y FUNCIONAL -->
<script>
// ========================================
// SISTEMA CSS3 INTERACTIVO
// ========================================

// VARIABLES GLOBALES
let animacionSVGActiva = false;
let intervaloAnimacion;

// SIMULADOR CSS
function aplicarCSS() {
    const css = document.getElementById(\'cssEditor\').value;
    const resultado = document.getElementById(\'cssResultado\');
    
    // Crear estilo dinámico
    let style = document.getElementById(\'dynamic-css-style\');
    if (!style) {
        style = document.createElement(\'style\');
        style.id = \'dynamic-css-style\';
        document.head.appendChild(style);
    }
    style.textContent = css;
    
    // Generar HTML de resultado
    resultado.innerHTML = `
        <div class="container-flex">
            <div class="flex-item">Flex 1</div>
            <div class="flex-item">Flex 2</div>
            <div class="flex-item">Flex 3</div>
        </div>
        
        <div class="container-grid">
            <div class="grid-item">Grid 1</div>
            <div class="grid-item">Grid 2</div>
            <div class="grid-item">Grid 3</div>
            <div class="grid-item">Grid 4</div>
        </div>
        
        <div class="animated-item">
            ✨ Elemento Animado
        </div>
        
        <div class="card-3d">
            <div class="card-3d-inner">
                <h4>Tarjeta 3D</h4>
                <p>¡Pasa el cursor aquí!</p>
            </div>
        </div>
    `;
    
    // Mostrar notificación
    mostrarNotificacionCSS(\'✅ CSS aplicado correctamente\', \'success\');
    console.log(\'🎨 CSS aplicado:\', css.length, \'caracteres\');
}

function resetCSS() {
    document.getElementById(\'cssEditor\').value = `/* SIMULADOR CSS INTERACTIVO - EDITA Y VE RESULTADOS */

:root {
    --color-primario: #43A047;
    --color-secundario: #2E7D32;
    --sombra: 0 4px 12px rgba(0,0,0,0.4);
}

/* EJEMPLO FLEXBOX */
.container-flex {
    display: flex;
    gap: 1rem;
    padding: 1rem;
    background: rgba(255, 255, 255, 0.05);
    border-radius: 8px;
    margin: 1rem 0;
}

.flex-item {
    flex: 1;
    padding: 1.5rem;
    background: var(--color-primario);
    color: white;
    border-radius: 6px;
    text-align: center;
    transition: transform 0.3s ease;
}

.flex-item:hover {
    transform: translateY(-5px);
    background: var(--color-secundario);
}

/* EJEMPLO GRID */
.container-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1rem;
    padding: 1rem;
    background: rgba(255, 255, 255, 0.05);
    border-radius: 8px;
    margin: 1rem 0;
}

.grid-item {
    padding: 1.5rem;
    background: linear-gradient(135deg, #43A047, #66BB6A);
    color: white;
    border-radius: 8px;
    text-align: center;
    box-shadow: var(--sombra);
}

/* ANIMACIÓN */
@keyframes pulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.05); }
}

.animated-item {
    animation: pulse 2s infinite;
    padding: 1rem;
    background: #FF6B6B;
    color: white;
    border-radius: 6px;
    margin: 1rem 0;
}

/* TARJETA 3D */
.card-3d {
    width: 200px;
    height: 150px;
    perspective: 1000px;
    margin: 1rem auto;
}

.card-3d-inner {
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, #43A047, #66BB6A);
    border-radius: 12px;
    padding: 20px;
    color: white;
    text-align: center;
    transition: transform 0.6s, box-shadow 0.6s;
    transform-style: preserve-3d;
}

.card-3d:hover .card-3d-inner {
    transform: rotateX(10deg) rotateY(10deg);
    box-shadow: 0 20px 40px rgba(0,0,0,0.3);
}`;
    
    aplicarCSS();
    mostrarNotificacionCSS(\'🔄 CSS reiniciado a valores iniciales\', \'info\');
}

function cargarEjemploCSS() {
    const ejemplos = [
        `/* EJEMPLO 1: FLEXBOX AVANZADO */
.container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    align-items: center;
    gap: 1rem;
    padding: 2rem;
    background: linear-gradient(45deg, #0a0a1a, #1a1a2e);
    border-radius: 12px;
}

.item {
    flex: 0 1 200px;
    padding: 1.5rem;
    background: rgba(67, 160, 71, 0.2);
    border: 2px solid #43A047;
    border-radius: 8px;
    color: #e0f0ff;
    text-align: center;
    transition: all 0.3s;
}

.item:hover {
    transform: scale(1.05);
    background: rgba(67, 160, 71, 0.4);
    box-shadow: 0 0 20px rgba(67, 160, 71, 0.3);
}`,
        
        `/* EJEMPLO 2: GRID COMPLEJO */
.grid-container {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    grid-template-rows: auto;
    gap: 1rem;
    padding: 1.5rem;
    background: rgba(255, 255, 255, 0.05);
    border-radius: 12px;
}

.grid-item {
    padding: 1rem;
    background: linear-gradient(135deg, #2E7D32, #43A047);
    color: white;
    border-radius: 8px;
    text-align: center;
}

.grid-item:nth-child(1) {
    grid-column: span 2;
    background: linear-gradient(135deg, #43A047, #66BB6A);
}

.grid-item:nth-child(2) {
    grid-row: span 2;
    background: linear-gradient(135deg, #2E7D32, #388E3C);
}

@media (max-width: 768px) {
    .grid-container {
        grid-template-columns: 1fr;
    }
    
    .grid-item:nth-child(1),
    .grid-item:nth-child(2) {
        grid-column: 1;
        grid-row: auto;
    }
}`,
        
        `/* EJEMPLO 3: ANIMACIONES COMPLEJAS */
@keyframes neon-glow {
    0%, 100% {
        box-shadow: 0 0 5px #43A047,
                    0 0 10px #43A047,
                    0 0 15px #43A047;
        transform: scale(1);
    }
    50% {
        box-shadow: 0 0 10px #00FFFF,
                    0 0 20px #00FFFF,
                    0 0 30px #00FFFF;
        transform: scale(1.1);
    }
}

.neon-element {
    padding: 1.5rem;
    background: rgba(67, 160, 71, 0.1);
    border: 2px solid #43A047;
    border-radius: 8px;
    color: #e0f0ff;
    text-align: center;
    animation: neon-glow 2s infinite alternate;
    font-size: 1.2rem;
    font-weight: bold;
}

/* 3D Transform */
.rotate-3d {
    width: 100px;
    height: 100px;
    margin: 2rem auto;
    transform-style: preserve-3d;
    animation: rotate3d 5s infinite linear;
}

@keyframes rotate3d {
    0% { transform: rotateX(0) rotateY(0); }
    100% { transform: rotateX(360deg) rotateY(360deg); }
}`
    ];
    
    const randomEjemplo = ejemplos[Math.floor(Math.random() * ejemplos.length)];
    document.getElementById(\'cssEditor\').value = randomEjemplo;
    aplicarCSS();
    mostrarNotificacionCSS(\'📋 Ejemplo CSS cargado\', \'success\');
}

function descargarCSS() {
    const css = document.getElementById(\'cssEditor\').value;
    const blob = new Blob([css], { type: \'text/css\' });
    const url = URL.createObjectURL(blob);
    const a = document.createElement(\'a\');
    a.href = url;
    a.download = \'estilos.css\';
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
    URL.revokeObjectURL(url);
    
    mostrarNotificacionCSS(\'📥 CSS descargado como estilos.css\', \'success\');
}

// DEMOS INTERACTIVAS
function actualizarFlexbox() {
    const justify = document.getElementById(\'flexJustify\').value;
    const flexPlayground = document.getElementById(\'flexPlayground\');
    const flexCode = document.getElementById(\'flexCode\');
    
    flexPlayground.style.justifyContent = justify;
    flexCode.textContent = `display: flex;\\njustify-content: ${justify};`;
    
    console.log(`📏 Flexbox actualizado: justify-content: ${justify}`);
}

function actualizarGrid() {
    const columns = document.getElementById(\'gridColumns\').value;
    const gridPlayground = document.getElementById(\'gridPlayground\');
    const gridCode = document.getElementById(\'gridCode\');
    
    gridPlayground.style.gridTemplateColumns = columns;
    gridCode.textContent = `display: grid;\\ngrid-template-columns: ${columns};`;
    
    console.log(`🔳 Grid actualizado: grid-template-columns: ${columns}`);
}

function actualizarAnimacion() {
    const type = document.getElementById(\'animType\').value;
    const animDemo = document.getElementById(\'animDemo\');
    const animCode = document.getElementById(\'animCode\');
    
    // Remover animaciones anteriores
    animDemo.style.animation = \'\';
    
    let animationCSS = \'\';
    
    switch(type) {
        case \'pulse\':
            animationCSS = `pulse 2s infinite`;
            animCode.textContent = `@keyframes pulse {\\n  0%, 100% { transform: scale(1); }\\n  50% { transform: scale(1.1); }\\n}`;
            break;
        case \'bounce\':
            animationCSS = `bounce 1s infinite`;
            animCode.textContent = `@keyframes bounce {\\n  0%, 100% { transform: translateY(0); }\\n  50% { transform: translateY(-20px); }\\n}`;
            break;
        case \'rotate\':
            animationCSS = `rotate 3s infinite linear`;
            animCode.textContent = `@keyframes rotate {\\n  to { transform: rotate(360deg); }\\n}`;
            break;
        case \'slide\':
            animationCSS = `slide 2s infinite alternate`;
            animCode.textContent = `@keyframes slide {\\n  0% { transform: translateX(0); }\\n  100% { transform: translateX(50px); }\\n}`;
            break;
    }
    
    animDemo.style.animation = animationCSS;
    console.log(`✨ Animación actualizada: ${type}`);
}

function mostrarDemo(modulo) {
    const demos = {
        flexbox: \'flexbox\',
        grid: \'grid\',
        variables: \'variables\',
        animaciones: \'animaciones\',
        transiciones: \'transiciones\',
        media: \'media\'
    };
    
    mostrarNotificacionCSS(`🎮 Abriendo demo de ${modulo}...`, \'info\');
    
    // En una implementación completa, aquí se abriría la demo específica
    aplicarCSS(); // Por ahora, solo aplicamos el CSS actual
}

// RETOS
function toggleSolucion(num) {
    const solucion = document.getElementById(`solucion${num}`);
    if (solucion.style.display === \'none\') {
        solucion.style.display = \'block\';
        mostrarNotificacionCSS(`✅ Mostrando solución del reto ${num}`, \'success\');
    } else {
        solucion.style.display = \'none\';
    }
}

// SVG INTERACTIVO
function iniciarAnimacionSVG() {
    if (animacionSVGActiva) return;
    
    animacionSVGActiva = true;
    const svg = document.getElementById(\'css3-svg-interactivo\');
    
    // Animar elementos secuencialmente
    const elementos = svg.querySelectorAll(\'.svg-element, .svg-arrow, .svg-text\');
    elementos.forEach((el, index) => {
        el.style.opacity = \'0\';
        setTimeout(() => {
            el.style.transition = \'opacity 0.5s ease, transform 0.5s ease\';
            el.style.opacity = \'1\';
            
            // Agregar animación de entrada
            if (el.classList.contains(\'svg-element\')) {
                el.style.transform = \'translateY(20px)\';
                setTimeout(() => {
                    el.style.transform = \'translateY(0)\';
                }, 100);
            }
        }, index * 300);
    });
    
    // Animar flechas
    const arrow1 = document.getElementById(\'arrow1\');
    const arrow2 = document.getElementById(\'arrow2\');
    
    let glowCount = 0;
    intervaloAnimacion = setInterval(() => {
        glowCount++;
        
        // Alternar brillo de flechas
        if (glowCount % 2 === 0) {
            arrow1.style.stroke = \'#43A047\';
            arrow2.style.stroke = \'#43A047\';
        } else {
            arrow1.style.stroke = \'#00FFFF\';
            arrow2.style.stroke = \'#00FFFF\';
        }
        
        // Animar título
        const title = document.getElementById(\'svg-title\');
        title.style.fill = glowCount % 2 === 0 ? \'#43A047\' : \'#00FFFF\';
        
    }, 1000);
    
    mostrarNotificacionCSS(\'🎬 Animación SVG iniciada\', \'success\');
}

function pausarAnimacionSVG() {
    if (!animacionSVGActiva) return;
    
    clearInterval(intervaloAnimacion);
    animacionSVGActiva = false;
    mostrarNotificacionCSS(\'⏸️ Animación SVG pausada\', \'info\');
}

function reiniciarSVG() {
    pausarAnimacionSVG();
    
    const svg = document.getElementById(\'css3-svg-interactivo\');
    const elementos = svg.querySelectorAll(\'*\');
    
    elementos.forEach(el => {
        el.style.opacity = \'1\';
        el.style.transform = \'none\';
        el.style.transition = \'none\';
    });
    
    const arrow1 = document.getElementById(\'arrow1\');
    const arrow2 = document.getElementById(\'arrow2\');
    const title = document.getElementById(\'svg-title\');
    
    arrow1.style.stroke = \'#43A047\';
    arrow2.style.stroke = \'#43A047\';
    title.style.fill = \'#43A047\';
    
    mostrarNotificacionCSS(\'🔄 SVG reiniciado\', \'info\');
}

// AUTOEVALUACIÓN
function actualizarEval(tipo, valor) {
    document.getElementById(`eval${tipo}`).textContent = `${valor}/5`;
    calcularPromedioCSS();
}

function calcularPromedioCSS() {
    const valores = [];
    
    const tipos = [\'Flex\', \'Grid\', \'Anim\'];
    tipos.forEach(tipo => {
        const elemento = document.getElementById(`eval${tipo}`);
        if (elemento) {
            const valor = parseInt(elemento.textContent);
            valores.push(valor);
        }
    });
    
    if (valores.length > 0) {
        const promedio = (valores.reduce((a, b) => a + b) / valores.length).toFixed(1);
        document.getElementById(\'evalPromedio\').textContent = promedio;
    }
}

function guardarEvalCSS() {
    const evaluacion = {
        fecha: new Date().toISOString(),
        flexbox: document.getElementById(\'evalFlex\').textContent,
        grid: document.getElementById(\'evalGrid\').textContent,
        animaciones: document.getElementById(\'evalAnim\').textContent,
        promedio: document.getElementById(\'evalPromedio\').textContent
    };
    
    localStorage.setItem(\'css3Evaluacion\', JSON.stringify(evaluacion));
    
    mostrarNotificacionCSS(\'📊 Evaluación guardada en localStorage\', \'success\');
    
    // Mostrar resumen
    setTimeout(() => {
        alert(`📊 EVALUACIÓN CSS3 GUARDADA\\n\\n` +
              `Flexbox: ${evaluacion.flexbox}\\n` +
              `Grid: ${evaluacion.grid}\\n` +
              `Animaciones: ${evaluacion.animaciones}\\n\\n` +
              `Promedio: ${evaluacion.promedio}/5\\n\\n` +
              `Datos guardados en tu navegador.`);
    }, 100);
}

// UTILIDADES
function mostrarNotificacionCSS(mensaje, tipo = \'info\') {
    const notificacion = document.createElement(\'div\');
    notificacion.className = `notificacion-css notificacion-${tipo}`;
    
    notificacion.innerHTML = `
        <div class="notificacion-contenido">
            <span class="notificacion-icon">${tipo === \'success\' ? \'✅\' : tipo === \'warning\' ? \'⚠️\' : \'ℹ️\'}</span>
            <span class="notificacion-mensaje">${mensaje}</span>
        </div>
        <button class="notificacion-cerrar" onclick="this.parentElement.remove()">×</button>
    `;
    
    document.body.appendChild(notificacion);
    
    setTimeout(() => {
        if (notificacion.parentElement) {
            notificacion.remove();
        }
    }, 3000);
}

function cambiarTabCss(tabName) {
    // Ocultar todas las pestañas
    document.querySelectorAll(\'.tab-pane\').forEach(tab => {
        tab.classList.remove(\'active\');
    });
    
    // Desactivar todos los botones
    document.querySelectorAll(\'.tab-btn\').forEach(btn => {
        btn.classList.remove(\'active\');
    });
    
    // Mostrar pestaña seleccionada
    document.getElementById(`tab-${tabName}-css`).classList.add(\'active\');
    
    // Activar botón correspondiente
    event.target.classList.add(\'active\');
}

// INICIALIZACIÓN
document.addEventListener(\'DOMContentLoaded\', function() {
    console.log(\'🚀 Sistema CSS3 Cyberpunk inicializado\');
    
    // Inicializar simulador
    aplicarCSS();
    
    // Inicializar demos
    actualizarFlexbox();
    actualizarGrid();
    actualizarAnimacion();
    
    // Cargar evaluación guardada si existe
    const evaluacionGuardada = localStorage.getItem(\'css3Evaluacion\');
    if (evaluacionGuardada) {
        try {
            const evalData = JSON.parse(evaluacionGuardada);
            document.getElementById(\'evalFlex\').textContent = evalData.flexbox;
            document.getElementById(\'evalGrid\').textContent = evalData.grid;
            document.getElementById(\'evalAnim\').textContent = evalData.animaciones;
            document.getElementById(\'evalPromedio\').textContent = evalData.promedio;
            
            // Establecer valores de sliders
            document.querySelectorAll(\'.eval-slider\').forEach((slider, index) => {
                const values = [evalData.flexbox, evalData.grid, evalData.animaciones];
                const value = parseInt(values[index]);
                slider.value = value;
            });
            
            mostrarNotificacionCSS(\'📊 Evaluación previa cargada\', \'info\');
        } catch (e) {
            console.log(\'No se pudo cargar evaluación previa\');
        }
    }
    
    // Iniciar animación SVG automáticamente después de 2 segundos
    setTimeout(() => {
        iniciarAnimacionSVG();
    }, 2000);
});
</script>

<!-- FIN LECCIÓN CSS3 CYBERPUNK OPTIMIZADA -->',
    'ejercicios' => 
    array (
      0 => 
      array (
        'enunciado' => 'Selector ID',
        'respuesta' => '#mi-id',
      ),
      1 => 
      array (
        'enunciado' => 'Selector clase',
        'respuesta' => '.mi-clase',
      ),
      2 => 
      array (
        'enunciado' => 'Flexbox display',
        'respuesta' => 'display: flex;',
      ),
      3 => 
      array (
        'enunciado' => 'Grid display',
        'respuesta' => 'display: grid;',
      ),
      4 => 
      array (
        'enunciado' => 'Variable CSS',
        'respuesta' => '--color: #43A047;',
      ),
      5 => 
      array (
        'enunciado' => 'Transición suave',
        'respuesta' => 'transition: all 0.3s ease;',
      ),
      6 => 
      array (
        'enunciado' => 'Media query móvil',
        'respuesta' => '@media (max-width: 768px)',
      ),
      7 => 
      array (
        'enunciado' => 'Centrar con Flex',
        'respuesta' => 'justify-content: center; align-items: center;',
      ),
      8 => 
      array (
        'enuncied' => 'Grid auto-fill',
        'respuesta' => 'repeat(auto-fill, minmax(200px, 1fr))',
      ),
      9 => 
      array (
        'enunciado' => 'Box shadow',
        'respuesta' => 'box-shadow: 0 4px 8px rgba(0,0,0,0.1);',
      ),
      10 => 
      array (
        'enunciado' => 'SI: % soporte CSS3',
        'respuesta' => '98%',
      ),
      11 => 
      array (
        'enunciado' => 'Container Queries',
        'respuesta' => '@container (min-width: 300px)',
      ),
    ),
    'quiz' => 
    array (
      0 => 
      array (
        'pregunta' => 'CSS significa',
        'opciones' => 
        array (
          0 => 'Cascading Style Sheets',
          1 => 'Creative Style Sheets',
          2 => 'Computer Style',
          3 => 'Color Style',
        ),
        'correcta' => 'Cascading Style Sheets',
      ),
      1 => 
      array (
        'pregunta' => 'display: flex;',
        'opciones' => 
        array (
          0 => 'Layout 1D',
          1 => '2D',
          2 => 'Bloque',
          3 => 'Inline',
        ),
        'correcta' => 'Layout 1D',
      ),
      2 => 
      array (
        'pregunta' => 'display: grid;',
        'opciones' => 
        array (
          0 => 'Layout 2D',
          1 => '1D',
          2 => 'Tabla',
          3 => 'Flex',
        ),
        'correcta' => 'Layout 2D',
      ),
      3 => 
      array (
        'pregunta' => 'Variable CSS',
        'opciones' => 
        array (
          0 => '--nombre: valor;',
          1 => ':nombre = valor;',
          2 => '$nombre: valor;',
          3 => '@nombre: valor;',
        ),
        'correcta' => '--nombre: valor;',
      ),
      4 => 
      array (
        'pregunta' => 'transition para',
        'opciones' => 
        array (
          0 => 'Cambios suaves',
          1 => 'Animación',
          2 => 'Layout',
          3 => 'Color',
        ),
        'correcta' => 'Cambios suaves',
      ),
      5 => 
      array (
        'pregunta' => '@keyframes define',
        'opciones' => 
        array (
          0 => 'Secuencia animación',
          1 => 'Transición',
          2 => 'Hover',
          3 => 'Media',
        ),
        'correcta' => 'Secuencia animación',
      ),
      6 => 
      array (
        'pregunta' => 'Media query',
        'opciones' => 
        array (
          0 => 'Responsive',
          1 => 'Impresión',
          2 => 'JS',
          3 => 'PHP',
        ),
        'correcta' => 'Responsive',
      ),
      7 => 
      array (
        'pregunta' => 'Specificity mayor',
        'opciones' => 
        array (
          0 => 'ID',
          1 => 'Clase',
          2 => 'Tag',
          3 => 'Universal',
        ),
        'correcta' => 'ID',
      ),
      8 => 
      array (
        'pregunta' => 'Box model incluye',
        'opciones' => 
        array (
          0 => 'content + padding + border + margin',
          1 => 'Solo content',
          2 => 'Solo margin',
          3 => 'Solo padding',
        ),
        'correcta' => 'content + padding + border + margin',
      ),
      9 => 
      array (
        'pregunta' => 'z-index controla',
        'opciones' => 
        array (
          0 => 'Apilamiento',
          1 => 'Tamaño',
          2 => 'Color',
          3 => 'Posición',
        ),
        'correcta' => 'Apilamiento',
      ),
      10 => 
      array (
        'pregunta' => 'justify-content: center;',
        'opciones' => 
        array (
          0 => 'Eje principal',
          1 => 'Eje secundario',
          2 => 'Ambos',
          3 => 'Ninguno',
        ),
        'correcta' => 'Eje principal',
      ),
      11 => 
      array (
        'pregunta' => 'align-items: center;',
        'opciones' => 
        array (
          0 => 'Eje secundario',
          1 => 'Eje principal',
          2 => 'Ambos',
          3 => 'Ninguno',
        ),
        'correcta' => 'Eje secundario',
      ),
      12 => 
      array (
        'pregunta' => 'gap en Grid/Flex',
        'opciones' => 
        array (
          0 => 'Espacio entre items',
          1 => 'Margen',
          2 => 'Padding',
          3 => 'Border',
        ),
        'correcta' => 'Espacio entre items',
      ),
      13 => 
      array (
        'pregunta' => 'grid-template-columns',
        'opciones' => 
        array (
          0 => 'Columnas',
          1 => 'Filas',
          2 => 'Área',
          3 => 'Todo',
        ),
        'correcta' => 'Columnas',
      ),
      14 => 
      array (
        'pregunta' => 'fr unidad',
        'opciones' => 
        array (
          0 => 'Fracción espacio',
          1 => 'Píxeles',
          2 => 'Porcentaje',
          3 => 'Em',
        ),
        'correcta' => 'Fracción espacio',
      ),
      15 => 
      array (
        'pregunta' => 'auto-fit vs auto-fill',
        'opciones' => 
        array (
          0 => 'fit: colapsa vacíos',
          1 => 'Igual',
          2 => 'fill: colapsa',
          3 => 'Nada',
        ),
        'correcta' => 'fit: colapsa vacíos',
      ),
      16 => 
      array (
        'pregunta' => 'SI 2025: % con Grid',
        'opciones' => 
        array (
          0 => '90% layouts',
          1 => '50%',
          2 => '10%',
          3 => '0%',
        ),
        'correcta' => '90% layouts',
      ),
      17 => 
      array (
        'pregunta' => ':hover es',
        'opciones' => 
        array (
          0 => 'Pseudo-clase',
          1 => 'Pseudo-elemento',
          2 => 'Clase',
          3 => 'ID',
        ),
        'correcta' => 'Pseudo-clase',
      ),
      18 => 
      array (
        'pregunta' => '::before es',
        'opciones' => 
        array (
          0 => 'Pseudo-elemento',
          1 => 'Pseudo-clase',
          2 => 'Clase',
          3 => 'ID',
        ),
        'correcta' => 'Pseudo-elemento',
      ),
      19 => 
      array (
        'pregunta' => 'CSS Houdini permite',
        'opciones' => 
        array (
          0 => 'Custom Paint API',
          1 => 'Solo colores',
          2 => 'Nada',
          3 => 'JS',
        ),
        'correcta' => 'Custom Paint API',
      ),
      20 => 
      array (
        'pregunta' => 'will-change',
        'opciones' => 
        array (
          0 => 'Optimiza GPU',
          1 => 'Color',
          2 => 'Tamaño',
          3 => 'Nada',
        ),
        'correcta' => 'Optimiza GPU',
      ),
      21 => 
      array (
        'pregunta' => 'contain: paint',
        'opciones' => 
        array (
          0 => 'Limita repintado',
          1 => 'Todo',
          2 => 'Nada',
          3 => 'Color',
        ),
        'correcta' => 'Limita repintado',
      ),
      22 => 
      array (
        'pregunta' => 'scroll-snap-type',
        'opciones' => 
        array (
          0 => 'Scroll suave',
          1 => 'Click',
          2 => 'Hover',
          3 => 'Nada',
        ),
        'correcta' => 'Scroll suave',
      ),
      23 => 
      array (
        'pregunta' => 'aspect-ratio',
        'opciones' => 
        array (
          0 => 'Proporción',
          1 => 'Tamaño',
          2 => 'Color',
          3 => 'Fuente',
        ),
        'correcta' => 'Proporción',
      ),
      24 => 
      array (
        'pregunta' => ':has() selector',
        'opciones' => 
        array (
          0 => 'Padre con hijo',
          1 => 'Hijo',
          2 => 'Hermano',
          3 => 'Nada',
        ),
        'correcta' => 'Padre con hijo',
      ),
      25 => 
      array (
        'pregunta' => 'Container Queries',
        'opciones' => 
        array (
          0 => '@container',
          1 => '@media',
          2 => '@supports',
          3 => '@keyframes',
        ),
        'correcta' => '@container',
      ),
      26 => 
      array (
        'pregunta' => 'SI 2025: % con Variables',
        'opciones' => 
        array (
          0 => '85% sitios',
          1 => '50%',
          2 => '20%',
          3 => '5%',
        ),
        'correcta' => '85% sitios',
      ),
      27 => 
      array (
        'pregunta' => 'Tailwind CSS es',
        'opciones' => 
        array (
          0 => 'Utility-first',
          1 => 'Component',
          2 => 'Framework',
          3 => 'Lenguaje',
        ),
        'correcta' => 'Utility-first',
      ),
      28 => 
      array (
        'pregunta' => 'CSS ideal para',
        'opciones' => 
        array (
          0 => 'Diseño, animación, responsive',
          1 => 'Lógica',
          2 => 'Datos',
          3 => 'Backend',
        ),
        'correcta' => 'Diseño, animación, responsive',
      ),
      29 => 
      array (
        'pregunta' => 'Futuro CSS',
        'opciones' => 
        array (
          0 => 'Houdini, Container Queries, Layers',
          1 => 'Flash',
          2 => 'Tablas',
          3 => 'Inline',
        ),
        'correcta' => 'Houdini, Container Queries, Layers',
      ),
    ),
  ),
  9 => 
  array (
    'materia' => 'Programación',
    'slug' => 'php-backend-cyberpunk',
    'titulo' => 'PHP8+: Backend Cyberpunk, PDO, API REST y Retos 2025',
    'contenido' => '    <div class="cyberpunk-lesson">

        <!-- ========== TÍTULO CON ESTILO CYBERPUNK ========== -->
        <div class="cyberpunk-header">
            <h2>🔥 PHP8+ BACKEND CYBERPUNK 2025</h2>
            <p class="subtitle">El lenguaje que domina el <strong>78% del backend global</strong> con <strong>JIT, PDO y APIs REST</strong>.</p>
            <div class="neon-divider"></div>
        </div>

        <!-- ========== INTRODUCCIÓN CON DATOS RELEVANTES ========== -->
        <div class="intro-section">
            <p><strong>PHP8.3+</strong> no es solo un lenguaje: es un <strong>ecosistema de velocidad, seguridad y escalabilidad</strong>. Con <strong>JIT (Just-In-Time)</strong>, <strong>Fibers</strong>, <strong>Enums</strong> y <strong>PDO</strong>, construye APIs REST que resisten ataques y escalan como skyscrapers de Neón.</p>
            <div class="stats-box">
                <ul>
                    <li>📈 <strong>3x más rápido</strong> que PHP7 con Opcache + JIT.</li>
                    <li>🔒 <strong>PDO</strong> bloquea el 99% de inyecciones SQL.</li>
                    <li>🌐 <strong>Laravel/Symfony</strong> dominan el 65% de frameworks PHP.</li>
                </ul>
            </div>
        </div>

        <hr class="neon-divider">

        <!-- ========== STACK PHP MODERNO 2025 (TABLA MEJORADA) ========== -->
        <h3>🛠 Stack PHP Cyberpunk 2025</h3>
        <table class="cyber-table">
            <thead>
                <tr>
                    <th>Componente</th>
                    <th>Función</th>
                    <th>Ejemplo Práctico</th>
                    <th>Impacto</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>PHP8.3+</strong></td>
                    <td>Motor con JIT y Fibers</td>
                    <td><code>match($status) { ... }</code></td>
                    <td>⚡ 300% más rápido en cálculos intensivos.</td>
                </tr>
                <tr>
                    <td><strong>PDO</strong></td>
                    <td>Conexión segura a BD</td>
                    <td><code>$pdo->prepare("SELECT * FROM users")</code></td>
                    <td>🛡 Bloquea inyecciones SQL.</td>
                </tr>
                <tr>
                    <td><strong>Composer</strong></td>
                    <td>Gestor de paquetes</td>
                    <td><code>composer require monolog/monolog</code></td>
                    <td>📦 +2 millones de librerías disponibles.</td>
                </tr>
                <tr>
                    <td><strong>API REST</strong></td>
                    <td>Comunicación JSON</td>
                    <td><code>json_encode($data, JSON_THROW_ON_ERROR)</code></td>
                    <td>🌍 Estándar para microservicios.</td>
                </tr>
                <tr>
                    <td><strong>Laravel/Symfony</strong></td>
                    <td>Frameworks MVC</td>
                    <td><code>php artisan make:controller UserController</code></td>
                    <td>🏗 Arquitectura limpia y escalable.</td>
                </tr>
            </tbody>
        </table>

        <hr class="neon-divider">

        <!-- ========== SIMULADOR PHP INTERACTIVO (MEJORADO) ========== -->
        <h3>💻 Simulador PHP en Tiempo Real</h3>
        <div class="php-simulator">
            <div class="simulator-columns">
                <div class="code-editor">
                    <div class="editor-header">
                        <span>📂 <strong>api.php</strong></span>
                        <button onclick="resetCode()" class="reset-btn">↻ Reset</button>
                    </div>
                    <textarea id="php-code" class="php-editor" rows="14">&lt;?php
// 🚀 API REST Cyberpunk 2025
header(\'Content-Type: application/json\');

$method = $_SERVER[\'REQUEST_METHOD\'] ?? \'GET\';
$path = parse_url($_SERVER[\'REQUEST_URI\'] ?? \'/\', PHP_URL_PATH);

if ($method === \'GET\' && $path === \'/api/users\') {
    $users = [
        [\'id\' => 1, \'name\' => \'Neo\', \'role\' => \'Hacker\', \'email\' => \'neo@matrix.com\'],
        [\'id\' => 2, \'name\' => \'Trinity\', \'role\' => \'Security\', \'email\' => \'trinity@matrix.com\']
    ];
    echo json_encode([\'success\' => true, \'data\' => $users]);
} elseif ($method === \'POST\' && $path === \'/api/users\') {
    $data = json_decode(file_get_contents(\'php://input\'), true);
    echo json_encode([\'success\' => true, \'message\' => \'Usuario creado: \' . $data[\'name\']]);
} else {
    http_response_code(404);
    echo json_encode([\'error\' => \'🚨 Ruta no encontrada en la Matrix\']);
}
?&gt;</textarea>
                </div>
                <div class="output-terminal">
                    <div class="terminal-header">
                        <span>🖥 <strong>Terminal de Respuesta</strong></span>
                    </div>
                    <div id="php-output" class="terminal-output">
                        <!-- Resultado dinámico -->
                    </div>
                </div>
            </div>
            <div class="simulator-controls">
                <button onclick="executePHP()" class="execute-btn">▶ Ejecutar Código</button>
                <div class="api-test-buttons">
                    <button onclick="testAPI(\'GET\', \'/api/users\')">📥 GET /api/users</button>
                    <button onclick="testAPI(\'POST\', \'/api/users\', {name: \'Morpheus\', role: \'Admin\'})">📤 POST /api/users</button>
                </div>
            </div>
            <p class="simulator-note"><em>⚠ Simulador frontend. Prueba rutas y métodos HTTP. El código "se ejecuta" en un entorno emulado.</em></p>
        </div>

        <script>
            // Función para ejecutar el simulador
            function executePHP() {
                const code = document.getElementById(\'php-code\').value;
                const output = document.getElementById(\'php-output\');
                output.innerHTML = \'<pre class="loading">🔄 Procesando solicitud en la Matrix...</pre>\';

                setTimeout(() => {
                    if (code.includes(\'GET\') && code.includes(\'/api/users\')) {
                        output.innerHTML = `<pre class="success-response">{
  "success": true,
  "data": [
    { "id": 1, "name": "Neo", "role": "Hacker", "email": "neo@matrix.com" },
    { "id": 2, "name": "Trinity", "role": "Security", "email": "trinity@matrix.com" }
  ]
}</pre>`;
                    } else if (code.includes(\'POST\') && code.includes(\'/api/users\')) {
                        output.innerHTML = `<pre class="success-response">{
  "success": true,
  "message": "Usuario creado: Morpheus"
}</pre>`;
                    } else {
                        output.innerHTML = `<pre class="error-response">{
  "error": "🚨 Ruta no encontrada en la Matrix"
}</pre>`;
                    }
                }, 800);
            }

            // Función para probar la API con botones
            function testAPI(method, path, data = null) {
                const output = document.getElementById(\'php-output\');
                output.innerHTML = `<pre class="loading">🔄 Enviando solicitud ${method} a ${path}...</pre>`;

                setTimeout(() => {
                    if (method === \'GET\' && path === \'/api/users\') {
                        output.innerHTML = `<pre class="success-response">{
  "success": true,
  "data": [
    { "id": 1, "name": "Neo", "role": "Hacker", "email": "neo@matrix.com" },
    { "id": 2, "name": "Trinity", "role": "Security", "email": "trinity@matrix.com" }
  ]
}</pre>`;
                    } else if (method === \'POST\' && path === \'/api/users\') {
                        output.innerHTML = `<pre class="success-response">{
  "success": true,
  "message": "Usuario creado: ${data.name}"
}</pre>`;
                    }
                }, 1000);
            }

            // Resetear código
            function resetCode() {
                document.getElementById(\'php-code\').value = `&lt;?php
// 🚀 API REST Cyberpunk 2025
header(\'Content-Type: application/json\');

$method = $_SERVER[\'REQUEST_METHOD\'] ?? \'GET\';
$path = parse_url($_SERVER[\'REQUEST_URI\'] ?? \'/\', PHP_URL_PATH);

if ($method === \'GET\' && $path === \'/api/users\') {
    $users = [
        [\'id\' => 1, \'name\' => \'Neo\', \'role\' => \'Hacker\', \'email\' => \'neo@matrix.com\'],
        [\'id\' => 2, \'name\' => \'Trinity\', \'role\' => \'Security\', \'email\' => \'trinity@matrix.com\']
    ];
    echo json_encode([\'success\' => true, \'data\' => $users]);
} else {
    http_response_code(404);
    echo json_encode([\'error\' => \'🚨 Ruta no encontrada en la Matrix\']);
}
?>`;
                document.getElementById(\'php-output\').innerHTML = \'\';
            }
        </script>

        <hr class="neon-divider">

        <!-- ========== RETO PRÁCTICO CON PDO ========== -->
        <h3>🎯 Reto Cyberpunk: API REST con PDO</h3>
        <div class="challenge-box">
            <p><strong>Misión:</strong> Crea un endpoint <code>GET /api/products</code> que devuelva productos de una base de datos usando PDO. Incluye manejo de errores y headers de seguridad.</p>
            <details class="solution-details">
                <summary>🔓 Ver solución (Código + Explicación)</summary>
                <div class="solution-content">
                    <pre><code>&lt;?php
// 🔒 Configuración segura
header(\'Content-Type: application/json\');
header(\'Access-Control-Allow-Origin: *\'); // ⚠ Solo para desarrollo

try {
    // 🛡 Conexión PDO con opciones de seguridad
    $pdo = new PDO(
        \'mysql:host=localhost;dbname=cyber_shop;charset=utf8mb4\',
        \'cyber_user\',
        \'S3cur3P@ss!2025\',
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]
    );

    // 📊 Consulta preparada (evita SQL Injection)
    $stmt = $pdo->prepare("
        SELECT id, name, price, stock
        FROM products
        WHERE stock > 0
        ORDER BY name ASC
        LIMIT 20
    ");
    $stmt->execute();
    $products = $stmt->fetchAll();

    // ✅ Respuesta exitosa
    echo json_encode([
        \'success\' => true,
        \'data\' => $products,
        \'meta\' => [
            \'count\' => count($products),
            \'timestamp\' => time()
        ]
    ]);

} catch (PDOException $e) {
    // ❌ Manejo de errores (no exponer detalles en producción)
    http_response_code(500);
    echo json_encode([
        \'success\' => false,
        \'error\' => \'Error en la base de datos\',
        \'code\' => $e->getCode()
    ]);
}
?&gt;</code></pre>
                    <div class="explanation">
                        <h4>🔍 ¿Por qué este código?</h4>
                        <ul>
                            <li><strong>PDO con atributos seguros:</strong> Desactiva emulación de prepares y fuerza modo de error a excepciones.</li>
                            <li><strong>Consulta parametrizada:</strong> Evita inyecciones SQL.</li>
                            <li><strong>Headers CORS:</strong> Solo para desarrollo. En producción, restringe a dominios específicos.</li>
                            <li><strong>Respuesta estructurada:</strong> Incluye metadatos y manejo de errores genéricos.</li>
                        </ul>
                    </div>
                </div>
            </details>
        </div>

        <hr class="neon-divider">

        <!-- ========== DIAGRAMA CYBERPUNK DEL FLUJO BACKEND ========== -->
        <h3>🌐 Arquitectura Backend Cyberpunk</h3>
        <div class="cyber-architecture">
            <svg id="cyber-php-svg" viewBox="0 0 900 500" xmlns="http://www.w3.org/2000/svg">
                <!-- Fondo cyberpunk -->
                <rect width="900" height="500" fill="#06061A"/>

                <!-- Título -->
                <text x="450" y="30" fill="#00FFAA" font-size="28" text-anchor="middle" font-weight="bold">
                    FLUJO BACKEND PHP8+ • 2025
                </text>
                <text x="450" y="60" fill="#FF00AA" font-size="16" text-anchor="middle">
                    De la solicitud HTTP a la respuesta JSON
                </text>

                <!-- Cliente (Dispositivo cyberpunk) -->
                <g id="client">
                    <rect x="100" y="100" width="200" height="120" rx="15" fill="#1A0635" stroke="#00FFAA" stroke-width="2"/>
                    <text x="200" y="140" fill="#00FFAA" font-size="18" text-anchor="middle">CLIENTE</text>
                    <text x="200" y="165" fill="#FFFFFF" font-size="14" text-anchor="middle">Browser / App</text>
                    <text x="200" y="190" fill="#00FFAA" font-size="12" text-anchor="middle">fetch() / Axios</text>
                    <path d="M120,230 L140,210 L160,230" stroke="#00FFAA" stroke-width="2" fill="none"/>
                    <path d="M240,230 L220,210 L200,230" stroke="#00FFAA" stroke-width="2" fill="none"/>
                </g>

                <!-- Servidor PHP (Nodo central) -->
                <g id="server">
                    <rect x="350" y="80" width="200" height="160" rx="15" fill="#3D061A" stroke="#FF00AA" stroke-width="2"/>
                    <text x="450" y="120" fill="#FF00AA" font-size="18" text-anchor="middle">SERVIDOR PHP</text>
                    <text x="450" y="150" fill="#FFFFFF" font-size="14" text-anchor="middle">Router • Middlewares</text>
                    <text x="450" y="175" fill="#FF00AA" font-size="12" text-anchor="middle">Controladores • Lógica</text>
                    <text x="450" y="200" fill="#FFFFFF" font-size="12" text-anchor="middle">PDO • Caching</text>
                </g>

                <!-- Base de Datos (Almacén de datos) -->
                <g id="database">
                    <rect x="600" y="100" width="200" height="120" rx="15" fill="#061A3D" stroke="#00AAFF" stroke-width="2"/>
                    <text x="700" y="140" fill="#00AAFF" font-size="18" text-anchor="middle">BASE DE DATOS</text>
                    <text x="700" y="165" fill="#FFFFFF" font-size="14" text-anchor="middle">MySQL • MariaDB</text>
                    <text x="700" y="190" fill="#00AAFF" font-size="12" text-anchor="middle">PDO • Transacciones</text>
                </g>

                <!-- Conexiones (Flechas animadas) -->
                <defs>
                    <marker id="arrow-head" markerWidth="10" markerHeight="10" refX="9" refY="3" orient="auto">
                        <path d="M0,0 L0,6 L9,3 z" fill="#FF00AA"/>
                    </marker>
                </defs>

                <!-- Flecha Cliente -> Servidor -->
                <line x1="300" y1="160" x2="350" y2="160" stroke="#00FFAA" stroke-width="3" marker-end="url(#arrow-head)" class="arrow"/>
                <text x="325" y="145" fill="#00FFAA" font-size="12" text-anchor="middle">HTTP Request</text>

                <!-- Flecha Servidor -> BD -->
                <line x1="550" y1="160" x2="600" y2="160" stroke="#FF00AA" stroke-width="3" marker-end="url(#arrow-head)" class="arrow"/>
                <text x="575" y="145" fill="#FF00AA" font-size="12" text-anchor="middle">Consulta PDO</text>

                <!-- Flecha BD -> Servidor -->
                <line x1="600" y1="200" x2="550" y2="200" stroke="#00AAFF" stroke-width="3" marker-end="url(#arrow-head)" class="arrow"/>
                <text x="575" y="215" fill="#00AAFF" font-size="12" text-anchor="middle">Datos</text>

                <!-- Flecha Servidor -> Cliente -->
                <line x1="350" y1="200" x2="300" y2="200" stroke="#00FFAA" stroke-width="3" marker-end="url(#arrow-head)" class="arrow"/>
                <text x="325" y="215" fill="#00FFAA" font-size="12" text-anchor="middle">JSON Response</text>

                <!-- Footer con datos clave -->
                <rect x="150" y="350" width="600" height="100" rx="15" fill="#0A0A2A" stroke="#FF00AA" stroke-width="1"/>
                <text x="450" y="380" fill="#FF00AA" font-size="16" text-anchor="middle">
                    🔥 PHP8.3+ • JIT • Fibers • Opcache • PDO
                </text>
                <text x="450" y="410" fill="#FFFFFF" font-size="14" text-anchor="middle">
                    📊 78% del backend web • 2025
                </text>
                <text x="450" y="440" fill="#00FFAA" font-size="12" text-anchor="middle">
                    🛡 Seguridad: Prepared Statements • CORS • JWT • Rate Limiting
                </text>
            </svg>
        </div>

        <!-- ========== CIERRE CON RECURSOS ADICIONALES ========== -->
        <div class="resources-section">
            <h3>📚 Recursos Cyberpunk para Dominar PHP8+</h3>
            <ul>
                <li><strong>📖 Documentación Oficial:</strong> <a href="https://www.php.net/manual/es/" target="_blank">PHP 8.3 Manual</a></li>
                <li><strong>🛠 Herramientas:</strong>
                    <ul>
                        <li><a href="https://getcomposer.org/" target="_blank">Composer</a> (Gestor de dependencias)</li>
                        <li><a href="https://www.postman.com/" target="_blank">Postman</a> (Testing de APIs)</li>
                        <li><a href="https://laravel.com/" target="_blank">Laravel</a> / <a href="https://symfony.com/" target="_blank">Symfony</a> (Frameworks)</li>
                    </ul>
                </li>
                <li><strong>🎓 Cursos:</strong>
                    <ul>
                        <li><a href="https://www.udemy.com/" target="_blank">Udemy: PHP8 + Laravel</a></li>
                        <li><a href="https://www.platzi.com/" target="_blank">Platzi: Backend con PHP</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>',
    'ejercicios' => 
    array (
      0 => 
      array (
        'enunciado' => 'Iniciar PHP',
        'respuesta' => '&lt;?php',
      ),
      1 => 
      array (
        'enunciado' => 'Variable',
        'respuesta' => '$nombre = "valor";',
      ),
      2 => 
      array (
        'enunciado' => 'Echo',
        'respuesta' => 'echo $var;',
      ),
      3 => 
      array (
        'enunciado' => 'Conexión PDO',
        'respuesta' => 'new PDO(dsn, user, pass)',
      ),
      4 => 
      array (
        'enunciado' => 'Prepare SQL',
        'respuesta' => '$stmt->prepare(query)',
      ),
      5 => 
      array (
        'enunciado' => 'JSON encode',
        'respuesta' => 'json_encode($data)',
      ),
      6 => 
      array (
        'enunciado' => 'Header JSON',
        'respuesta' => 'header("Content-Type: application/json")',
      ),
      7 => 
      array (
        'enunciado' => 'Match expression',
        'respuesta' => 'match($x) { ... }',
      ),
      8 => 
      array (
        'enunciado' => 'Enum PHP8',
        'respuesta' => 'enum Status: string',
      ),
      9 => 
      array (
        'enunciado' => 'Composer init',
        'respuesta' => 'composer init',
      ),
      10 => 
      array (
        'enunciado' => 'SI: % sitios PHP',
        'respuesta' => '78%',
      ),
      11 => 
      array (
        'enunciado' => 'Laravel ORM',
        'respuesta' => 'Eloquent',
      ),
    ),
    'quiz' => 
    array (
      0 => 
      array (
        'pregunta' => 'PHP es',
        'opciones' => 
        array (
          0 => 'Server-side',
          1 => 'Client-side',
          2 => 'Estilo',
          3 => 'DB',
        ),
        'correcta' => 'Server-side',
      ),
      1 => 
      array (
        'pregunta' => 'PHP8 incluye',
        'opciones' => 
        array (
          0 => 'JIT',
          1 => 'Canvas',
          2 => 'Flexbox',
          3 => 'Grid',
        ),
        'correcta' => 'JIT',
      ),
      2 => 
      array (
        'pregunta' => 'PDO previene',
        'opciones' => 
        array (
          0 => 'SQL Injection',
          1 => 'XSS',
          2 => 'CSRF',
          3 => 'DDoS',
        ),
        'correcta' => 'SQL Injection',
      ),
      3 => 
      array (
        'pregunta' => 'API REST usa',
        'opciones' => 
        array (
          0 => 'JSON',
          1 => 'XML',
          2 => 'HTML',
          3 => 'PHP',
        ),
        'correcta' => 'JSON',
      ),
      4 => 
      array (
        'pregunta' => 'Laravel es',
        'opciones' => 
        array (
          0 => 'Framework PHP',
          1 => 'JS',
          2 => 'CSS',
          3 => 'BD',
        ),
        'correcta' => 'Framework PHP',
      ),
      5 => 
      array (
        'pregunta' => 'Composer es',
        'opciones' => 
        array (
          0 => 'Gestor paquetes',
          1 => 'Servidor',
          2 => 'Editor',
          3 => 'Navegador',
        ),
        'correcta' => 'Gestor paquetes',
      ),
      6 => 
      array (
        'pregunta' => 'match reemplaza',
        'opciones' => 
        array (
          0 => 'switch',
          1 => 'if',
          2 => 'for',
          3 => 'while',
        ),
        'correcta' => 'switch',
      ),
      7 => 
      array (
        'pregunta' => 'enum define',
        'opciones' => 
        array (
          0 => 'Tipos enumerados',
          1 => 'Clases',
          2 => 'Funciones',
          3 => 'Variables',
        ),
        'correcta' => 'Tipos enumerados',
      ),
      8 => 
      array (
        'pregunta' => 'SI 2025: % PHP',
        'opciones' => 
        array (
          0 => '78%',
          1 => '50%',
          2 => '20%',
          3 => '5%',
        ),
        'correcta' => '78%',
      ),
      9 => 
      array (
        'pregunta' => 'PHP ideal para',
        'opciones' => 
        array (
          0 => 'Backend, API, CMS',
          1 => 'Frontend',
          2 => 'Diseño',
          3 => 'Móvil',
        ),
        'correcta' => 'Backend, API, CMS',
      ),
      10 => 
      array (
        'pregunta' => 'header() envía',
        'opciones' => 
        array (
          0 => 'Cabeceras HTTP',
          1 => 'HTML',
          2 => 'JS',
          3 => 'CSS',
        ),
        'correcta' => 'Cabeceras HTTP',
      ),
      11 => 
      array (
        'pregunta' => 'json_encode()',
        'opciones' => 
        array (
          0 => 'PHP → JSON',
          1 => 'JSON → PHP',
          2 => 'HTML → JSON',
          3 => 'CSS → JSON',
        ),
        'correcta' => 'PHP → JSON',
      ),
      12 => 
      array (
        'pregunta' => 'prepare() evita',
        'opciones' => 
        array (
          0 => 'Inyección SQL',
          1 => 'Errores',
          2 => 'Lentitud',
          3 => 'Nada',
        ),
        'correcta' => 'Inyección SQL',
      ),
      13 => 
      array (
        'pregunta' => 'bindParam()',
        'opciones' => 
        array (
          0 => 'Vincula parámetro',
          1 => 'Ejecuta',
          2 => 'Cierra',
          3 => 'Lee',
        ),
        'correcta' => 'Vincula parámetro',
      ),
      14 => 
      array (
        'pregunta' => 'fetchAll()',
        'opciones' => 
        array (
          0 => 'Todos los registros',
          1 => 'Uno',
          2 => 'Ninguno',
          3 => 'Error',
        ),
        'correcta' => 'Todos los registros',
      ),
      15 => 
      array (
        'pregunta' => 'http_response_code(404)',
        'opciones' => 
        array (
          0 => 'Not Found',
          1 => 'OK',
          2 => 'Error',
          3 => 'Redirect',
        ),
        'correcta' => 'Not Found',
      ),
      16 => 
      array (
        'pregunta' => 'SI 2025: Laravel',
        'opciones' => 
        array (
          0 => '65% market',
          1 => '30%',
          2 => '10%',
          3 => '0%',
        ),
        'correcta' => '65% market',
      ),
      17 => 
      array (
        'pregunta' => 'PHP con',
        'opciones' => 
        array (
          0 => 'MySQL, PostgreSQL',
          1 => 'Solo MySQL',
          2 => 'Mongo',
          3 => 'Firebase',
        ),
        'correcta' => 'MySQL, PostgreSQL',
      ),
      18 => 
      array (
        'pregunta' => 'WebSockets en PHP',
        'opciones' => 
        array (
          0 => 'Ratchet',
          1 => 'Socket.io',
          2 => 'WebRTC',
          3 => 'Ajax',
        ),
        'correcta' => 'Ratchet',
      ),
      19 => 
      array (
        'pregunta' => 'Microservicios PHP',
        'opciones' => 
        array (
          0 => 'Swoole',
          1 => 'Laravel',
          2 => 'React',
          3 => 'Vue',
        ),
        'correcta' => 'Swoole',
      ),
      20 => 
      array (
        'pregunta' => 'PHP8.3 mejora',
        'opciones' => 
        array (
          0 => 'Rendimiento',
          1 => 'Seguridad',
          2 => 'Diseño',
          3 => 'Todo',
        ),
        'correcta' => 'Rendimiento',
      ),
      21 => 
      array (
        'pregunta' => 'Attributes PHP8',
        'opciones' => 
        array (
          0 => 'Anotaciones',
          1 => 'Clases',
          2 => 'Funciones',
          3 => 'Variables',
        ),
        'correcta' => 'Anotaciones',
      ),
      22 => 
      array (
        'pregunta' => 'Readonly classes',
        'opciones' => 
        array (
          0 => 'PHP8.2+',
          1 => 'PHP7',
          2 => 'PHP5',
          3 => 'No existe',
        ),
        'correcta' => 'PHP8.2+',
      ),
      23 => 
      array (
        'pregunta' => 'Typed properties',
        'opciones' => 
        array (
          0 => 'PHP7.4+',
          1 => 'PHP8',
          2 => 'PHP5',
          3 => 'No',
        ),
        'correcta' => 'PHP7.4+',
      ),
      24 => 
      array (
        'pregunta' => 'PHP en cloud',
        'opciones' => 
        array (
          0 => 'AWS, GCP, Azure',
          1 => 'Solo local',
          2 => 'Solo XAMPP',
          3 => 'No',
        ),
        'correcta' => 'AWS, GCP, Azure',
      ),
      25 => 
      array (
        'pregunta' => 'Docker con PHP',
        'opciones' => 
        array (
          0 => 'php:fpm',
          1 => 'php:cli',
          2 => 'php:apache',
          3 => 'Todo',
        ),
        'correcta' => 'Todo',
      ),
      26 => 
      array (
        'pregunta' => 'SI 2025: API PHP',
        'opciones' => 
        array (
          0 => '+85% tráfico',
          1 => '50%',
          2 => '20%',
          3 => '0%',
        ),
        'correcta' => '+85% tráfico',
      ),
      27 => 
      array (
        'pregunta' => 'PHP futuro',
        'opciones' => 
        array (
          0 => 'Swoole, Fiber, JIT',
          1 => 'Flash',
          2 => 'CGI',
          3 => 'Static',
        ),
        'correcta' => 'Swoole, Fiber, JIT',
      ),
      28 => 
      array (
        'pregunta' => 'Framework más usado',
        'opciones' => 
        array (
          0 => 'Laravel',
          1 => 'Symfony',
          2 => 'CodeIgniter',
          3 => 'CakePHP',
        ),
        'correcta' => 'Laravel',
      ),
      29 => 
      array (
        'pregunta' => 'PHP domina en',
        'opciones' => 
        array (
          0 => 'CMS (WordPress)',
          1 => 'Frontend',
          2 => 'Móvil',
          3 => 'Juegos',
        ),
        'correcta' => 'CMS (WordPress)',
      ),
    ),
  ),
);
