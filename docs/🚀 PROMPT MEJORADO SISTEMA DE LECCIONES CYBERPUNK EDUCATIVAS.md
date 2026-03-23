# 🚀 PROMPT MEJORADO: SISTEMA DE LECCIONES CYBERPUNK EDUCATIVAS

---

> Actúa como un diseñador instruccional experto, desarrollador web educativo y especialista en gamificación académica.

Necesito que generes una lección COMPLETA, AVANZADA e INTERACTIVA, aplicable a cualquier materia (Química, Física, Biología, Matemáticas, Historia, etc.), con rigor académico real y pensada para evaluación formal.

---

## 🔧 **REQUISITOS TÉCNICOS OBLIGATORIOS**

### **1. ESTRUCTURA PHP EXACTA**
```php
$lecciones[] = [
    'materia' => 'NOMBRE DE LA MATERIA',
    'slug' => 'slug-del-tema',
    'titulo' => 'TÍTULO COMPLETO DE LA LECCIÓN',
    'contenido' => <<<'HTML'
    <!-- TODO EL HTML + JS VA AQUÍ -->
    HTML
];
```

**REGLAS ESTRICTAS:**
- ✅ Siempre usar `<<<'HTML'` (heredoc con comillas simples)
- ❌ Nunca comillas simples ni dobles para contenido
- ✅ Cerrar correctamente con `HTML` en línea separada
- ✅ Indentación consistente dentro del heredoc

### **2. SEPARACIÓN CSS/JS/HTML**
```
ESTRUCTURA DE ENTREGA:
1. BLOQUE PHP COMPLETO (contenido HTML + JS)
2. BLOQUE CSS SEPARADO (estilos únicos para la lección)
3. NOTAS DE IMPLEMENTACIÓN
```

**CSS DEBE SER:**
- Único para esa lección (no colisionar)
- Optimizado para tamaño y performance
- Responsive por defecto
- Con naming específico (ej: `.leccion-fisica-{elemento}`)

### **4. JAVASCRIPT DIDÁCTICO**
- Funcionalidades reales (no placeholders).
- Feedback inmediato en interacciones.
- Manejo de estado claro y robusto.
- Sin dependencias externas innecesarias.
- Console.log para debugging educativo.
- **Interactividad Proactiva**: El JS debe anticipar errores comunes y ofrecer pistas dinámicas.

### **5. DISEÑO RESPONSIVE Y ACCESIBLE (NUEVO)**
- **Mobile First**: Estilos optimizados para pantallas pequeñas.
- **Accesibilidad (a11y)**: Uso de roles ARIA, etiquetas `label` correctas y contraste de color 4.5:1.
- **Performance**: Evitar layouts pesados que causen lag en dispositivos móviles.

### **4. MATHJAX CORRECTO**
```latex
\[ F = ma \]  <!-- Correcto -->
\( E = mc^2 \) <!-- Correcto para inline -->
\\( x = \\frac{-b \\pm \\sqrt{b^2-4ac}}{2a} \\) <!-- Escapado correcto -->
```

---

## 🧩 **ESTRUCTURA DIDÁCTICA CYBERPUNK OPTIMIZADA**

### **🎨 PALETA DE COLORES NEON EDUCATIVA**
```css
:root {
    /* COLORES TEMÁTICOS POR TIPO DE CONTENIDO */
    --neon-concepto: #39ff14;     /* Verde - Conceptos clave */
    --neon-interactivo: #ff00ff;   /* Rosa - Elementos interactivos */
    --neon-ejemplo: #00ffff;       /* Cian - Ejemplos y casos */
    --neon-alerta: #ffff00;        /* Amarillo - Advertencias/errores */
    --neon-evaluacion: #ff6b6b;    /* Rojo - Evaluación */
    --neon-dato: #00ff9d;          /* Verde datos - Información */
    
    /* FONDOS JERÁRQUICOS */
    --bg-leccion: #0a0a1a;         /* Fondo principal oscuro */
    --bg-seccion: rgba(0, 0, 0, 0.5); /* Fondo secciones */
    --bg-card: rgba(10, 10, 26, 0.8); /* Tarjetas semitransparentes */
    
    /* TAMAÑOS OPTIMIZADOS */
    --font-base: 1rem;            /* 16px base */
    --font-sm: 0.875rem;          /* 14px pequeño */
    --font-md: 1.125rem;          /* 18px medio */
    --font-lg: 1.25rem;           /* 20px grande */
    
    /* ESPACIADO CONTROLADO */
    --space-sm: 8px;
    --space-md: 16px;
    --space-lg: 24px;
}
```

### **1️⃣ INTRODUCCIÓN CONCEPTUAL CYBERPUNK**
```
[CONTENEDOR PRINCIPAL - Fondo con gridlines sutiles]
├── TÍTULO LECCIÓN (H1) - Glow animation + icono temático
├── PANEL OBJETIVOS - Lista neon con checkboxes interactivas
├── CONTEXTO REAL - Card con datos aplicados al mundo real
└── RELACIÓN CURRICULAR - Badges con competencias/contenidos oficiales
```

### **2️⃣ DESARROLLO TEÓRICO ESTRUCTURADO**
```
[SECCIÓN CON BORDE NEON LATERAL]
├── SUBTEMA 1 - Grid 2-4 columnas con tarjetas conceptuales
├── TABLA COMPARATIVA - Con hover effects y datos clave
├── ESQUEMA INTERACTIVO - SVG animado al hacer scroll
└── EJEMPLO PASO A PASO - Con MathJax y análisis destacado
```

### **3️⃣ VISUALIZACIÓN DIDÁCTICA INTERACTIVA**
```
[SIMULADOR PRINCIPAL - Contenedor con borde animado]
├── PANEL CONTROLES (izquierda) - Sliders/selects temáticos
├── VISUALIZACIÓN (centro) - SVG/Canvas con animaciones
├── DATOS EN TIEMPO REAL (derecha) - Valores dinámicos
└── BOTONES ACCIÓN - Iniciar/Pausar/Reiniciar con feedback
```

### **4️⃣ BLOQUES INTERACTIVOS REALES**

#### **🎮 SIMULADOR INTERACTIVO (OBLIGATORIO)**
```html
<div class="simulator-container" data-tema="nombre-tema">
    <div class="simulator-controls">
        <input type="range" id="parametro1" min="0" max="100" value="50">
        <select id="modo">
            <option value="basico">Básico</option>
            <option value="avanzado">Avanzado</option>
        </select>
        <button onclick="ejecutarSimulacion()">▶ Ejecutar</button>
    </div>
    <div class="simulator-visualization" id="visualizacion">
        <!-- SVG/Canvas dinámico -->
    </div>
    <div class="simulator-data">
        <div class="data-value" id="resultado1">0</div>
        <div class="data-value" id="resultado2">0</div>
    </div>
</div>
```

#### **🧠 QUIZ AUTOEVALUADO CON FEEDBACK**
```html
<div class="quiz-container">
    <div class="quiz-question" data-correct="opcion1">
        <p>Pregunta conceptual</p>
        <div class="quiz-options">
            <button class="quiz-option" data-value="opcion1">Opción correcta</button>
            <button class="quiz-option" data-value="opcion2">Opción incorrecta</button>
            <button class="quiz-option" data-value="opcion3">Opción incorrecta</button>
        </div>
        <div class="quiz-feedback" style="display: none;">
            Explicación detallada del porqué
        </div>
    </div>
</div>
```

### **5️⃣ ⚠️ SECCIÓN "ERRORES COMUNES" INTERACTIVA**
```
[CONTENEDOR CON BORDE NEON-ALERTA]
├── LISTA ERRORES - Cards colapsables
├── EJEMPLO ERRÓNEO - Con highlighting de error
├── EXPLICACIÓN CORRECCIÓN - Paso a paso
└── PRÁCTICA CORRECCIÓN - Mini-ejercicio interactivo
```

### **6️⃣ 📘 CONEXIÓN CON MATERIA BASE**
```
[PANEL CON BADGES Y REFERENCIAS]
├── COMPETENCIAS OFICIALES - Lista con iconos
├── CONTENIDOS CURRICULARES - Vinculación explícita
├── INDICADORES EVALUACIÓN - Qué se califica y cómo
└── PREGUNTAS TIPO PISA/ENLACE - Ejemplos reales
```

### **7️⃣ 📝 PROBLEMAS TIPO EXAMEN**
```
[CONTENEDOR ESTILO "HOJA DE EXAMEN"]
├── PROBLEMA 1 - Con espacio para desarrollo
├── PROBLEMA 2 - Con datos a interpretar
├── PROBLEMA 3 - De razonamiento/justificación
└── RÚBRICA EVALUACIÓN - Criterios de calificación
```

### **8️⃣ 🧠 CIERRE METACOGNITIVO INTERACTIVO**
```
[CHECKLIST INTERACTIVO + REFLEXIÓN]
├── AUTOEVALUACIÓN - Sliders de autopercepción
├── REFLEXIÓN GUIADA - Preguntas con textarea
├── PLAN DE ESTUDIO - Sugerencias personalizadas
└── RECURSOS ADICIONALES - Links/lecturas recomendadas
```

---

## 🎨 **ESTILO VISUAL CYBERPUNK EDUCATIVO**

### **PRINCIPIOS DE DISEÑO:**
1. **JERARQUÍA VISUAL CLARA** - Tamaños de fuente escalables
2. **CONTRASTE ADECUADO** - Texto legible sobre fondos oscuros
3. **ANIMACIONES CON PROPÓSITO** - Guían la atención, no distraen
4. **FEEDBACK VISUAL INMEDIATO** - Interacciones responden al instante
5. **RESPONSIVE POR DEFECTO** - Funciona en móvil/tablet/desktop

### **COMPONENTES REUTILIZABLES:**
```css
/* TARJETA CONCEPTUAL OPTIMIZADA */
.concept-card {
    padding: var(--space-lg);
    background: var(--bg-card);
    border: 2px solid var(--neon-concepto);
    border-radius: 8px;
    margin: var(--space-md) 0;
    transition: transform 0.2s ease;
}

.concept-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(57, 255, 20, 0.2);
}

/* SIMULADOR RESPONSIVE */
.simulator-container {
    display: grid;
    grid-template-columns: 1fr 2fr 1fr;
    gap: var(--space-lg);
    padding: var(--space-lg);
    background: rgba(0, 0, 0, 0.7);
    border: 2px solid var(--neon-interactivo);
    border-radius: 8px;
}

@media (max-width: 768px) {
    .simulator-container {
        grid-template-columns: 1fr;
    }
}

/* QUIZ INTERACTIVO */
.quiz-option {
    padding: var(--space-md);
    margin: var(--space-sm) 0;
    background: rgba(255, 255, 0, 0.05);
    border: 1px solid var(--neon-alerta);
    color: #e0f0ff;
    cursor: pointer;
    transition: all 0.2s ease;
}

.quiz-option:hover {
    background: rgba(255, 255, 0, 0.1);
    transform: translateX(4px);
}

.quiz-option.correct {
    background: rgba(57, 255, 20, 0.1);
    border-color: var(--neon-concepto);
}

.quiz-option.incorrect {
    background: rgba(255, 107, 107, 0.1);
    border-color: var(--neon-evaluacion);
}
```

### **EFECTOS CYBERPUNK SUTILES:**
```css
/* GRID BACKGROUND (sutil) */
.leccion-container::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-image: 
        linear-gradient(rgba(57, 255, 20, 0.02) 1px, transparent 1px),
        linear-gradient(90deg, rgba(57, 255, 20, 0.02) 1px, transparent 1px);
    background-size: 40px 40px;
    pointer-events: none;
    z-index: 0;
}

/* GLOW ANIMATION PARA TÍTULOS */
@keyframes glow {
    0%, 100% { 
        text-shadow: 0 0 5px currentColor;
    }
    50% { 
        text-shadow: 0 0 10px currentColor,
                     0 0 15px currentColor;
    }
}

.titulo-leccion {
    animation: glow 3s infinite;
}

/* SCANLINES (muy sutil) */
.leccion-container::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(
        to bottom,
        transparent 50%,
        rgba(0, 255, 255, 0.01) 51%
    );
    background-size: 100% 4px;
    pointer-events: none;
    z-index: 1;
    animation: scanline 8s linear infinite;
}
```

---

## ⚡ **OPTIMIZACIONES DE PERFORMANCE**

### **1. TAMAÑOS CONTROLADOS:**
```css
/* EVITAR ELEMENTOS DEMASIADO GRANDES */
.ph-display {
    font-size: 2.5rem; /* No 4rem */
    padding: 1rem; /* No 2rem */
}

/* ICONOS OPTIMIZADOS */
.icon-tema {
    font-size: 1.5rem; /* No 3rem */
    margin: 0.5rem;
}
```

### **2. ANIMACIONES GPU-ACELERADAS:**
```css
/* BUENAS PRÁCTICAS */
.elemento {
    transition: transform 0.2s ease; /* GPU acelerado */
}

/* MALAS PRÁCTICAS (evitar) */
.elemento {
    transition: width 0.2s ease; /* No GPU acelerado */
}
```

### **3. RESPONSIVE BREAKPOINTS ESTRATÉGICOS:**
```css
/* MOBILE FIRST */
.contenedor { padding: 1rem; }

/* TABLET */
@media (min-width: 768px) {
    .contenedor { padding: 1.5rem; }
    .grid-2cols { grid-template-columns: repeat(2, 1fr); }
}

/* DESKTOP */
@media (min-width: 1024px) {
    .contenedor { padding: 2rem; }
    .grid-4cols { grid-template-columns: repeat(4, 1fr); }
}
```

---

## 🎯 **CHECKLIST DE ENTREGA FINAL**

### **✅ ESTRUCTURA PHP CORRECTA**
- [ ] Heredoc `<<<'HTML'` utilizado correctamente
- [ ] Indentación consistente dentro del bloque
- [ ] Cierre `HTML` en línea separada
- [ ] Array `$lecciones[]` bien formado

### **✅ CSS ÚNICO Y OPTIMIZADO**
- [ ] Clases específicas (no genéricas como `.card`)
- [ ] Tamaños controlados (no elementos gigantes)
- [ ] Responsive por defecto
- [ ] Animaciones con propósito educativo
- [ ] Contraste adecuado para lectura

### **✅ JAVASCRIPT FUNCIONAL**
- [ ] Interacciones reales (no placeholders)
- [ ] Feedback inmediato al usuario
- [ ] Manejo de errores básico
- [ ] Console.log para debugging educativo
- [ ] Sin dependencias externas innecesarias

### **✅ CONTENIDO DIDÁCTICO COMPLETO**
- [ ] 8 secciones obligatorias incluidas
- [ ] Simulador interactivo real
- [ ] Quiz con retroalimentación
- [ ] Errores comunes interactivos
- [ ] Problemas tipo examen
- [ ] Cierre metacognitivo

### **✅ ESTILO CYBERPUNK CONSISTENTE**
- [ ] Paleta de colores neon aplicada
- [ ] Efectos sutiles (gridlines, scanlines)
- [ ] Tipografía monospace legible
- [ ] Bordes y glow temáticos
- [ ] Transiciones suaves

### **✅ ACCESIBILIDAD BÁSICA**
- [ ] Texto legible en todos los tamaños
- [ ] Contraste mínimo 4.5:1
- [ ] Elementos interactivos tamaño táctil (min 44px)
- [ ] Focus states visibles
- [ ] Sin scroll horizontal no deseado

---

## 📋 **FORMATO DE ENTREGA**

```
## 🚀 LECCIÓN: [NOMBRE MATERIA] - [TEMA]

### 📁 BLOQUE PHP COMPLETO
```php
$lecciones[] = [
    'materia' => '...',
    'slug' => '...',
    'titulo' => '...',
    'contenido' => <<<'HTML'
    <!-- CONTENIDO HTML + JS AQUÍ -->
    HTML
];
```

### 🎨 CSS ÚNICO (AÑADIR AL ARCHIVO CSS)
```css
/* ESTILOS ESPECÍFICOS PARA ESTA LECCIÓN */
.leccion-[materia]-[tema] { ... }
```

### ⚙️ NOTAS DE IMPLEMENTACIÓN
- Funcionalidades clave: ...
- Dependencias: ...
- Testing recomendado: ...
- Adaptaciones posibles: ...
  
  ## Estructura obligatoria:
```php
$lecciones[] = [
    'materia' => 'Programación',
    'slug' => 'html5-semantico-cyberpunk',
    'titulo' => 'HTML5 SEMÁNTICO: Dominando la Estructura Web del Futuro',
    'contenido' => <<<'HTML'
<!-- INICIO LECCIÓN CYBERPUNK OPTIMIZADA -->
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
                                <button class="btn-ejemplo-mejorado" onclick="cargarEjemplo('basico')" data-tipo="basico">
                                    <span class="ejemplo-icon">🏗️</span>
                                    <span class="ejemplo-texto">Estructura básica</span>
                                    <span class="ejemplo-desc">HTML semántico simple</span>
                                </button>
                                <button class="btn-ejemplo-mejorado" onclick="cargarEjemplo('blog')" data-tipo="blog">
                                    <span class="ejemplo-icon">📝</span>
                                    <span class="ejemplo-texto">Blog semántico</span>
                                    <span class="ejemplo-desc">Artículos y secciones</span>
                                </button>
                                <button class="btn-ejemplo-mejorado" onclick="cargarEjemplo('ecommerce')" data-tipo="ecommerce">
                                    <span class="ejemplo-icon">🛒</span>
                                    <span class="ejemplo-texto">E-commerce</span>
                                    <span class="ejemplo-desc">Tienda online</span>
                                </button>
                                <button class="btn-ejemplo-mejorado" onclick="cargarEjemplo('malo')" data-tipo="malo">
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
                            <h3>📊 ANÁLISIS SEMÁNTICO</h3>
                            <div class="analisis-score" id="semanticScore">
                                <div class="score-circle">
                                    <span class="score-number">0%</span>
                                </div>
                                <div class="score-label">Puntaje semántico</div>
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
                                   pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                                   placeholder="usuario@dominio.com">
                            <div class="form-hint">Debe ser un email válido (ejemplo@dominio.com)</div>
                        </div>
                        
                        <div class="form-group">
                            <label for="userPassword">
                                <span class="label-icon">🔐</span> Contraseña:
                            </label>
                            <input type="password" id="userPassword" required
                                   minlength="8" 
                                   pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$"
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
                        <button class="tab-btn active" onclick="cambiarTab('editor')">✏️ EDITOR</button>
                        <button class="tab-btn" onclick="cambiarTab('vista')">👁️ VISTA PREVIA</button>
                        <button class="tab-btn" onclick="cambiarTab('consola')">📊 CONSOLA</button>
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
        document.addEventListener('click', function() {
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
    const html = document.getElementById('htmlEditor').value;
    console.log('🔍 Analizando estructura HTML...');
    
    // Actualizar contador de líneas
    const lineCount = html.split('\n').length;
    document.getElementById('lineCount').textContent = lineCount;
    
    // Contadores
    let semanticTags = 0;
    let totalTags = 0;
    let divCount = 0;
    
    // Etiquetas semánticas principales
    const semanticList = ['header', 'nav', 'main', 'article', 'section', 'aside', 'footer', 'figure', 'figcaption'];
    
    // Contar etiquetas
    semanticList.forEach(tag => {
        const regex = new RegExp(`<${tag}[\\s>]`, 'gi');
        const matches = html.match(regex);
        if (matches) semanticTags += matches.length;
    });
    
    // Contar divs
    const divRegex = /<div[\s>]/gi;
    const divMatches = html.match(divRegex);
    divCount = divMatches ? divMatches.length : 0;
    
    // Contar todas las etiquetas
    const allTags = html.match(/<[a-z][\s>]/gi);
    totalTags = allTags ? allTags.length : 0;
    
    // Calcular scores
    const semanticScore = totalTags > 0 ? Math.round((semanticTags / totalTags) * 100) : 0;
    const accessibilityScore = semanticScore >= 80 ? 95 : semanticScore >= 60 ? 75 : semanticScore >= 40 ? 50 : 25;
    const nestingDepth = calcularProfundidad(html);
    const seoScore = calcularSEOScore(html);
    
    // Actualizar UI - Mejorado
    document.querySelector('#semanticScore .score-number').textContent = `${semanticScore}%`;
    document.getElementById('semanticCount').textContent = semanticTags;
    document.getElementById('accessibilityScore').textContent = `${accessibilityScore}%`;
    document.getElementById('nestingDepth').textContent = nestingDepth;
    document.getElementById('seoScore').textContent = `${seoScore}%`;
    
    // Actualizar barras con porcentajes
    document.getElementById('semanticBar').style.width = `${semanticScore}%`;
    document.getElementById('accessBar').style.width = `${accessibilityScore}%`;
    document.getElementById('nestingBar').style.width = `${Math.min(100, nestingDepth * 20)}%`;
    document.getElementById('seoBar').style.width = `${seoScore}%`;
    
    // Actualizar porcentajes en las barras
    document.querySelectorAll('.metrica-percentage').forEach((el, index) => {
        const values = [semanticScore, accessibilityScore, Math.min(100, nestingDepth * 20), seoScore];
        el.textContent = `${values[index]}%`;
    });
    
    // Generar árbol
    generarArbolEstructura(html);
    
    // Generar recomendaciones
    generarRecomendaciones(semanticTags, divCount, semanticScore, nestingDepth, html);
    
    console.log(`📊 Análisis completado: ${semanticScore}% semántico`);
    
    // Mostrar notificación
    mostrarNotificacion(`Análisis completado: ${semanticScore}% de semántica`, 'success');
}

function calcularProfundidad(html) {
    // Simulación simple de profundidad
    const lines = html.split('\n');
    let maxDepth = 0;
    let currentDepth = 0;
    
    lines.forEach(line => {
        if (line.includes('</') && !line.includes('</!')){
            currentDepth--;
        } else if (line.match(/<\w+[^>]*>/)) {
            currentDepth++;
            if (currentDepth > maxDepth) maxDepth = currentDepth;
        }
    });
    
    return maxDepth;
}

function calcularSEOScore(html) {
    let score = 50;
    
    // Verificar elementos importantes para SEO
    if (html.includes('<title>')) score += 10;
    if (html.includes('<meta name="description"')) score += 10;
    if (html.includes('<h1>')) score += 10;
    if (html.includes('<main>')) score += 10;
    if (html.match(/<h[2-6]/g)) score += 5;
    if (html.includes('lang="')) score += 5;
    
    return Math.min(100, score);
}

function generarArbolEstructura(html) {
    const lines = html.split('\n');
    let treeOutput = '';
    let indent = 0;
    
    // Limitar a las primeras 20 líneas para no saturar
    const displayLines = lines.slice(0, 30);
    
    displayLines.forEach((line, index) => {
        const trimmed = line.trim();
        
        if (trimmed === '') return;
        
        // Determinar si es etiqueta de cierre
        if (trimmed.startsWith('</')) {
            indent--;
        }
        
        // Mostrar línea con indentación
        const indentSpaces = '  '.repeat(Math.max(0, indent));
        
        // Resaltar etiquetas semánticas
        const semanticTags = ['header', 'nav', 'main', 'article', 'section', 'aside', 'footer'];
        let highlightedLine = trimmed;
        
        semanticTags.forEach(tag => {
            const regex = new RegExp(`(<\/?${tag}[^>]*>)`, 'gi');
            highlightedLine = highlightedLine.replace(regex, '<span class="semantic-tag">$1</span>');
        });
        
        // Resaltar divs (problemas)
        highlightedLine = highlightedLine.replace(/(<div[^>]*>)/gi, '<span class="div-tag">$1</span>');
        
        treeOutput += `<div class="tree-line">${indentSpaces}${highlightedLine}</div>`;
        
        // Determinar si es etiqueta de apertura
        if (trimmed.match(/^<[^/!][^>]*>$/)) {
            indent++;
        }
    });
    
    // Si hay más líneas, mostrar indicador
    if (lines.length > 30) {
        treeOutput += `<div class="tree-line" style="color: var(--text-dim); font-style: italic;">... y ${lines.length - 30} líneas más</div>`;
    }
    
    document.getElementById('treeOutput').innerHTML = treeOutput;
}

function generarRecomendaciones(semanticTags, divCount, semanticScore, nestingDepth, html) {
    const recommendations = [];
    
    if (semanticTags === 0) {
        recommendations.push({
            icon: '🔴',
            text: 'No se encontraron etiquetas semánticas. Reemplaza divs por header, nav, main, etc.',
            type: 'error'
        });
    } else if (semanticScore < 50) {
        recommendations.push({
            icon: '🟡',
            text: 'Puntaje semántico bajo. Intenta usar más etiquetas con significado.',
            type: 'warning'
        });
    } else if (semanticScore >= 80) {
        recommendations.push({
            icon: '🟢',
            text: 'Excelente estructura semántica. ¡Buen trabajo!',
            type: 'success'
        });
    }
    
    if (divCount > 10) {
        recommendations.push({
            icon: '🟡',
            text: `Muchos divs (${divCount}). Considera reemplazarlos por etiquetas semánticas.`,
            type: 'warning'
        });
    }
    
    if (nestingDepth > 6) {
        recommendations.push({
            icon: '🟡',
            text: `Anidamiento profundo (${nestingDepth} niveles). Simplifica la estructura.`,
            type: 'warning'
        });
    }
    
    // Verificar elementos específicos
    if (!html.includes('<main>')) {
        recommendations.push({
            icon: '🔴',
            text: 'Falta el elemento &lt;main&gt; para el contenido principal.',
            type: 'error'
        });
    }
    
    if (!html.includes('<header>')) {
        recommendations.push({
            icon: '🟡',
            text: 'Considera agregar un &lt;header&gt; para la cabecera.',
            type: 'warning'
        });
    }
    
    // Verificar headings
    if (!html.includes('<h1>') && !html.includes('<h2>') && !html.includes('<h3>')) {
        recommendations.push({
            icon: '🔴',
            text: 'Faltan elementos de encabezado (h1-h6). Agrega títulos a tus secciones.',
            type: 'error'
        });
    }
    
    // Mostrar recomendaciones
    const container = document.getElementById('recommendations');
    container.innerHTML = '';
    
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
            const item = document.createElement('div');
            item.className = 'recomendacion-item';
            item.innerHTML = `
                <div class="recomendacion-icon">${rec.icon}</div>
                <div class="recomendacion-text">${rec.text}</div>
            `;
            container.appendChild(item);
        });
    }
}

function optimizarHTML() {
    let html = document.getElementById('htmlEditor').value;
    let cambios = 0;
    const cambiosDetallados = [];
    
    // Reemplazos básicos de divs por etiquetas semánticas
    const replacements = [
        { 
            regex: /<div[^>]*class="header"[^>]*>/gi, 
            replacement: '<header>', 
            tipo: 'header',
            desc: 'Reemplazado div.header por header'
        },
        { 
            regex: /<div[^>]*class="menu"[^>]*>/gi, 
            replacement: '<nav>', 
            tipo: 'nav',
            desc: 'Reemplazado div.menu por nav'
        },
        { 
            regex: /<div[^>]*class="content"[^>]*>/gi, 
            replacement: '<main>', 
            tipo: 'main',
            desc: 'Reemplazado div.content por main'
        },
        { 
            regex: /<div[^>]*class="footer"[^>]*>/gi, 
            replacement: '<footer>', 
            tipo: 'footer',
            desc: 'Reemplazado div.footer por footer'
        },
        { 
            regex: /<div[^>]*class="post"[^>]*>/gi, 
            replacement: '<article>', 
            tipo: 'article',
            desc: 'Reemplazado div.post por article'
        },
        { 
            regex: /<div[^>]*class="sidebar"[^>]*>/gi, 
            replacement: '<aside>', 
            tipo: 'aside',
            desc: 'Reemplazado div.sidebar por aside'
        },
        { 
            regex: /<div[^>]*class="header-area"[^>]*>/gi, 
            replacement: '<header>', 
            tipo: 'header',
            desc: 'Reemplazado div.header-area por header'
        },
        { 
            regex: /<div[^>]*class="widget-title"[^>]*>(.*?)<\/div>/gi, 
            replacement: '<h3>$1</h3>', 
            tipo: 'heading',
            desc: 'Reemplazado div.widget-title por h3'
        },
        { 
            regex: /<div[^>]*class="post-title"[^>]*>(.*?)<\/div>/gi, 
            replacement: '<h2>$1</h2>', 
            tipo: 'heading',
            desc: 'Reemplazado div.post-title por h2'
        },
        { 
            regex: /<div[^>]*class="title"[^>]*>(.*?)<\/div>/gi, 
            replacement: '<h2>$1</h2>', 
            tipo: 'heading',
            desc: 'Reemplazado div.title por h2'
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
        { regex: /<\/div>\s*<!--\s*\/header\s*-->/gi, replacement: '</header>' },
        { regex: /<\/div>\s*<!--\s*\/nav\s*-->/gi, replacement: '</nav>' },
        { regex: /<\/div>\s*<!--\s*\/main\s*-->/gi, replacement: '</main>' },
        { regex: /<\/div>\s*<!--\s*\/footer\s*-->/gi, replacement: '</footer>' },
        { regex: /<\/div>\s*<!--\s*\/article\s*-->/gi, replacement: '</article>' },
        { regex: /<\/div>\s*<!--\s*\/aside\s*-->/gi, replacement: '</aside>' },
    ];
    
    cierreReplacements.forEach(rep => {
        const oldHtml = html;
        html = html.replace(rep.regex, rep.replacement);
        if (oldHtml !== html) {
            cambios++;
        }
    });
    
    document.getElementById('htmlEditor').value = html;
    
    // Mostrar resultados
    if (cambios > 0) {
        console.log(`⚡ HTML optimizado: ${cambios} cambios realizados`);
        
        // Mostrar resumen de cambios
        let mensaje = `Optimizado: ${cambios} cambios realizados`;
        if (cambiosDetallados.length > 0) {
            mensaje += '\n\n' + cambiosDetallados.slice(0, 3).join('\n');
            if (cambiosDetallados.length > 3) {
                mensaje += `\n... y ${cambiosDetallados.length - 3} cambios más`;
            }
        }
        
        mostrarNotificacion(mensaje, 'success');
        analizarHTML();
    } else {
        mostrarNotificacion('No se encontraron optimizaciones necesarias', 'warning');
    }
}

function reiniciarEditor() {
    document.getElementById('htmlEditor').value = `<!DOCTYPE html>
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
    console.log('🔄 Editor reiniciado');
    mostrarNotificacion('Editor reiniciado a configuración inicial', 'info');
    analizarHTML();
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
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
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
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
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
        document.getElementById('htmlEditor').value = ejemplos[tipo];
        
        // Asegurar que el editor mantenga su tamaño
        const editor = document.getElementById('htmlEditor');
        editor.style.height = '400px'; // Altura fija
        editor.style.minHeight = '400px';
        editor.style.maxHeight = '400px';
        
        // Actualizar contador de líneas
        const lineCount = ejemplos[tipo].split('\n').length;
        document.getElementById('lineCount').textContent = lineCount;
        
        console.log(`📂 Ejemplo cargado: ${tipo}`);
        mostrarNotificacion(`Ejemplo "${tipo}" cargado correctamente`, 'success');
        
        // Resaltar el botón seleccionado
        document.querySelectorAll('.btn-ejemplo-mejorado').forEach(btn => {
            btn.classList.remove('selected');
            if (btn.getAttribute('data-tipo') === tipo) {
                btn.classList.add('selected');
            }
        });
        
        // Analizar automáticamente después de cargar
        setTimeout(() => analizarHTML(), 500);
    }
}

// ========================================
// FUNCIONES AUXILIARES
// ========================================
function toggleArbol() {
    const container = document.getElementById('treeContainer');
    const btn = document.querySelector('.btn-expandir');
    
    if (container.classList.contains('expandido')) {
        container.classList.remove('expandido');
        container.style.maxHeight = '200px';
        btn.textContent = 'Expandir';
    } else {
        container.classList.add('expandido');
        container.style.maxHeight = '400px';
        btn.textContent = 'Contraer';
    }
}

function mostrarTodasRecomendaciones() {
    // En una implementación real, esto mostraría más recomendaciones
    mostrarNotificacion('Esta función mostraría recomendaciones detalladas en un futuro.', 'info');
}

function mostrarNotificacion(mensaje, tipo = 'info') {
    // Crear notificación
    const notificacion = document.createElement('div');
    notificacion.className = `notificacion notificacion-${tipo}`;
    
    // Dividir mensaje si es muy largo
    const lineas = mensaje.split('\n');
    const contenido = lineas.length > 1 ? lineas.slice(0, 3).join('<br>') : mensaje;
    
    notificacion.innerHTML = `
        <div class="notificacion-contenido">
            <span class="notificacion-icon">${tipo === 'success' ? '✅' : tipo === 'warning' ? '⚠️' : 'ℹ️'}</span>
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
document.getElementById('advancedForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const form = this;
    const status = document.getElementById('formStatus');
    
    if (form.checkValidity()) {
        status.textContent = '✅ Formulario válido. Datos listos para enviar.';
        status.style.color = '#39FF14';
        status.style.backgroundColor = 'rgba(57, 255, 20, 0.1)';
        
        // Simular envío
        setTimeout(() => {
            alert('🚀 Formulario enviado correctamente!\n\nDatos procesados:\n' +
                  `Email: ${document.getElementById('userEmail').value}\n` +
                  `Experiencia: ${document.getElementById('experienceValue').textContent}/10\n` +
                  `Comentarios: ${document.getElementById('userComments').value.length} caracteres`);
            form.reset();
            status.textContent = 'Completa todos los campos requeridos';
            status.style.color = '';
            status.style.backgroundColor = '';
            document.getElementById('charCount').textContent = '0/500 caracteres';
            document.getElementById('experienceValue').textContent = '5';
        }, 1000);
    } else {
        status.textContent = '⚠️ Por favor, corrige los errores en el formulario';
        status.style.color = '#FF6B6B';
        status.style.backgroundColor = 'rgba(255, 107, 107, 0.1)';
    }
});

// Contador de caracteres
document.getElementById('userComments').addEventListener('input', function() {
    const count = this.value.length;
    document.getElementById('charCount').textContent = `${count}/500 caracteres`;
    
    if (count < 10) {
        this.style.borderColor = '#FF6B6B';
    } else if (count >= 10 && count <= 500) {
        this.style.borderColor = '#39FF14';
    } else {
        this.style.borderColor = '#FFFF00';
    }
});

// Actualizar valor del range
document.getElementById('userExperience').addEventListener('input', function() {
    document.getElementById('experienceValue').textContent = this.value;
});

// ========================================
// DESAFÍO PRÁCTICO
// ========================================
function verificarSolucion() {
    const solucion = document.getElementById('solucionEditor').value;
    const feedback = document.getElementById('solucionFeedback');
    
    if (!solucion.trim()) {
        feedback.innerHTML = '<div class="feedback-error">❌ Por favor, escribe tu solución primero.</div>';
        return;
    }
    
    // Elementos requeridos en la solución
    const elementosRequeridos = ['header', 'nav', 'main', 'article', 'footer', 'aside'];
    const encontrados = [];
    
    elementosRequeridos.forEach(el => {
        if (solucion.toLowerCase().includes('<' + el)) {
            encontrados.push(el);
        }
    });
    
    // Contar divs (deberían ser pocos)
    const divCount = (solucion.match(/<div/g) || []).length;
    
    // Puntaje
    const score = encontrados.length / elementosRequeridos.length * 100;
    
    // Mostrar feedback
    let feedbackHTML = '';
    
    if (score === 100) {
        feedbackHTML = `
            <div class="feedback-excelente">
                <h4>🎉 ¡Excelente! Puntuación perfecta: 100%</h4>
                <p>Has usado correctamente todas las etiquetas semánticas requeridas.</p>
                <p><strong>Elementos encontrados:</strong> ${encontrados.join(', ')}</p>
                ${divCount > 0 ? `<p>💡 Sugerencia: Podrías reducir los divs (actualmente: ${divCount})</p>` : ''}
            </div>
        `;
    } else if (score >= 70) {
        const faltantes = elementosRequeridos.filter(el => !encontrados.includes(el));
        feedbackHTML = `
            <div class="feedback-bueno">
                <h4>👍 Buen trabajo: ${Math.round(score)}%</h4>
                <p>Has usado la mayoría de etiquetas semánticas.</p>
                <p><strong>Elementos encontrados:</strong> ${encontrados.join(', ')}</p>
                <p><strong>Te faltó:</strong> ${faltantes.join(', ')}</p>
                <p>Sugerencia: Intenta reemplazar más divs por estas etiquetas.</p>
            </div>
        `;
    } else {
        feedbackHTML = `
            <div class="feedback-mejorable">
                <h4>📚 Necesitas mejorar: ${Math.round(score)}%</h4>
                <p>Te recomendamos revisar las etiquetas semánticas básicas.</p>
                <p><strong>Elementos encontrados:</strong> ${encontrados.length > 0 ? encontrados.join(', ') : 'Ninguno'}</p>
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
    
    document.getElementById('solucionEditor').value = solucionModelo;
    mostrarNotificacion('Solución modelo cargada', 'info');
}

function limpiarSolucion() {
    document.getElementById('solucionEditor').value = '';
    document.getElementById('solucionFeedback').innerHTML = `
        <div class="feedback-initial">
            <p>💡 <strong>Instrucciones:</strong> Corrige el código usando etiquetas semánticas apropiadas.</p>
        </div>
    `;
    mostrarNotificacion('Editor de solución limpiado', 'info');
}

// ========================================
// SIMULADOR HTML COMPLETO
// ========================================
function cambiarTab(tabName) {
    // Ocultar todas las pestañas
    document.querySelectorAll('.tab-pane').forEach(tab => {
        tab.classList.remove('active');
    });
    
    // Desactivar todos los botones
    document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.classList.remove('active');
    });
    
    // Mostrar pestaña seleccionada
    document.getElementById(`tab-${tabName}`).classList.add('active');
    
    // Activar botón correspondiente
    event.target.classList.add('active');
    
    // Si es la pestaña de vista, actualizar
    if (tabName === 'vista') {
        actualizarVista();
    }
}

function ejecutarHTML() {
    const code = document.getElementById('htmlCompleto').value;
    
    // Actualizar vista previa
    const iframe = document.getElementById('htmlPreview');
    const iframeDoc = iframe.contentDocument || iframe.contentWindow.document;
    iframeDoc.open();
    iframeDoc.write(code);
    iframeDoc.close();
    
    // Mostrar en consola
    agregarConsola('✅ Código HTML ejecutado correctamente');
    agregarConsola(`📏 Longitud: ${code.length} caracteres`);
    
    // Analizar etiquetas
    const tags = code.match(/<[a-z][\s>]/gi) || [];
    agregarConsola(`🏷️ Etiquetas detectadas: ${tags.length}`);
    
    // Verificar etiquetas semánticas
    const semanticTags = ['header', 'nav', 'main', 'article', 'section', 'aside', 'footer'];
    let semanticCount = 0;
    semanticTags.forEach(tag => {
        if (code.includes('<' + tag)) {
            semanticCount++;
            agregarConsola(`✅ Encontrado: &lt;${tag}&gt;`);
        }
    });
    
    if (semanticCount === 0) {
        agregarConsola('⚠️ No se encontraron etiquetas semánticas');
    }
    
    mostrarNotificacion('Código HTML ejecutado en vista previa', 'success');
}

function actualizarVista() {
    ejecutarHTML();
    agregarConsola('🔄 Vista previa actualizada');
}

function cambiarTamanoVista() {
    const size = document.getElementById('viewSize').value;
    const iframe = document.getElementById('htmlPreview');
    
    if (size === 'mobile') {
        iframe.style.width = '375px';
        iframe.style.height = '667px';
    } else {
        iframe.style.width = size;
        iframe.style.height = '500px';
    }
    
    agregarConsola(`📱 Tamaño de vista cambiado a: ${size}`);
}

function guardarHTML() {
    const code = document.getElementById('htmlCompleto').value;
    localStorage.setItem('htmlCodeBackup', code);
    agregarConsola('💾 Código guardado en almacenamiento local');
    mostrarNotificacion('Código guardado en almacenamiento local', 'success');
}

function descargarHTML() {
    const code = document.getElementById('htmlCompleto').value;
    const blob = new Blob([code], { type: 'text/html' });
    const url = URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = 'mi-pagina-web.html';
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
    URL.revokeObjectURL(url);
    
    agregarConsola('📥 Archivo HTML descargado: mi-pagina-web.html');
    mostrarNotificacion('Archivo descargado: mi-pagina-web.html', 'success');
}

function agregarConsola(mensaje) {
    const consola = document.getElementById('consoleOutput');
    const entry = document.createElement('div');
    entry.className = 'console-entry';
    entry.innerHTML = mensaje;
    consola.appendChild(entry);
    consola.scrollTop = consola.scrollHeight;
}

function limpiarConsola() {
    document.getElementById('consoleOutput').innerHTML = '';
    agregarConsola('🗑️ Consola limpiada');
    mostrarNotificacion('Consola limpiada', 'info');
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
        document.getElementById('evalAverage').textContent = promedio;
    }
}

function guardarEvaluacion() {
    const promedio = document.getElementById('evalAverage').textContent;
    const evaluacion = {
        fecha: new Date().toISOString(),
        semantica: document.getElementById('evalValue1').textContent,
        formularios: document.getElementById('evalValue2').textContent,
        errores: document.getElementById('evalValue3').textContent,
        promedio: promedio
    };
    
    localStorage.setItem('html5Evaluacion', JSON.stringify(evaluacion));
    
    alert(`📊 Evaluación guardada:\n\n` +
          `Comprensión semántica: ${evaluacion.semantica}\n` +
          `Formularios HTML5: ${evaluacion.formularios}\n` +
          `Detección de errores: ${evaluacion.errores}\n\n` +
          `Promedio: ${evaluacion.promedio}/5\n\n` +
          `Los datos se han guardado en tu navegador.`);
    
    mostrarNotificacion('Autoevaluación guardada correctamente', 'success');
}

// ========================================
// INICIALIZACIÓN
// ========================================
document.addEventListener('DOMContentLoaded', function() {
    // Inicializar simulador de estructura
    analizarHTML();
    
    // Inicializar simulador HTML completo
    ejecutarHTML();
    
    // Cargar evaluación guardada si existe
    const evaluacionGuardada = localStorage.getItem('html5Evaluacion');
    if (evaluacionGuardada) {
        try {
            const evalData = JSON.parse(evaluacionGuardada);
            document.getElementById('evalValue1').textContent = evalData.semantica;
            document.getElementById('evalValue2').textContent = evalData.formularios;
            document.getElementById('evalValue3').textContent = evalData.errores;
            document.getElementById('evalAverage').textContent = evalData.promedio;
            
            // Establecer valores de sliders
            document.querySelectorAll('.eval-slider').forEach((slider, index) => {
                const value = parseInt(evalData[['semantica', 'formularios', 'errores'][index]]);
                slider.value = value;
            });
            
            mostrarNotificacion('Evaluación previa cargada', 'info');
        } catch (e) {
            console.log('No se pudo cargar evaluación previa');
        }
    }
    
    // Configurar altura fija del editor
    const editor = document.getElementById('htmlEditor');
    editor.style.height = '400px';
    editor.style.minHeight = '400px';
    editor.style.maxHeight = '400px';
    
    // Asegurar que el textarea mantenga su tamaño
    editor.addEventListener('input', function() {
        this.style.height = '400px';
        this.style.minHeight = '400px';
        this.style.maxHeight = '400px';
    });
    
    console.log('🚀 Sistema HTML5 Cyberpunk inicializado completamente');
    console.log('📚 Lección: HTML5 Semántico Avanzado');
    console.log('⚡ Simuladores, formularios y evaluaciones listos');
    
    // Mostrar notificación de bienvenida
    setTimeout(() => {
        mostrarNotificacion('🚀 Sistema HTML5 Cyberpunk listo. ¡Comienza a aprender!', 'success');
    }, 1000);
});
</script>

<!-- ESTILOS CSS COMPLETOS -->
<style>
/* VARIABLES PRINCIPALES */
:root {
    --neon-cyan: #00FFFF;
    --neon-green: #39FF14;
    --neon-pink: #FF00FF;
    --neon-yellow: #FFFF00;
    --neon-orange: #FF6B00;
    --bg-dark: #0a0a1a;
    --bg-darker: #050510;
    --bg-card: rgba(10, 10, 26, 0.85);
    --text-light: #e0f0ff;
    --text-dim: #a0b0c0;
    --border-glow: 1px solid rgba(0, 255, 255, 0.4);
    --shadow-neon: 0 0 10px rgba(0, 255, 255, 0.3);
}

/* RESET Y BASE */
.leccion-programacion-html5 * {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

.leccion-programacion-html5 {
    background: var(--bg-dark);
    color: var(--text-light);
    font-family: 'Segoe UI', 'Roboto', 'Consolas', monospace;
    padding: 1.5rem;
    max-width: 1200px;
    margin: 0 auto;
    line-height: 1.6;
    position: relative;
    min-height: 100vh;
}

/* FONDO CYBERPUNK SUTIL */
.leccion-programacion-html5::before {
    content: '';
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: 
        radial-gradient(circle at 20% 30%, rgba(0, 255, 255, 0.05) 0%, transparent 50%),
        radial-gradient(circle at 80% 70%, rgba(57, 255, 20, 0.03) 0%, transparent 50%);
    pointer-events: none;
    z-index: 0;
}

/* SIMULADOR DE ESTRUCTURA - NUEVO DISEÑO */
.simulador-contenido-ancho {
    width: 100%;
    margin-top: 1.5rem;
}

.editor-y-ejemplos {
    display: flex;
    flex-direction: column;
    gap: 2rem;
}

.editor-container {
    background: rgba(0, 0, 0, 0.5);
    border-radius: 12px;
    border: var(--border-glow);
    overflow: hidden;
}

.simulador-editor {
    background: #1a1a2e;
    border-radius: 0;
    border: none;
    border-bottom: 1px solid rgba(0, 255, 255, 0.2);
}

.editor-toolbar {
    background: #0f3460;
    padding: 1rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 1px solid rgba(0, 255, 255, 0.2);
}

.toolbar-left {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.file-name {
    font-family: 'Consolas', monospace;
    color: var(--neon-cyan);
    font-weight: bold;
}

.file-stats {
    font-size: 0.85rem;
    color: var(--text-dim);
    background: rgba(0, 0, 0, 0.3);
    padding: 0.25rem 0.75rem;
    border-radius: 4px;
}

.toolbar-right {
    display: flex;
    gap: 0.5rem;
}

.editor-status {
    font-size: 0.85rem;
    color: var(--neon-green);
    background: rgba(57, 255, 20, 0.1);
    padding: 0.25rem 0.75rem;
    border-radius: 4px;
}

.code-editor {
    width: 100%;
    height: 400px;
    background: #0a0a1a;
    color: #e0f0ff;
    border: none;
    padding: 1.5rem;
    font-family: 'Consolas', 'Monaco', monospace;
    font-size: 0.95rem;
    line-height: 1.5;
    resize: none;
    outline: none;
    overflow-y: auto;
    min-height: 400px;
    max-height: 400px;
}

/* EJEMPLOS RÁPIDOS MEJORADOS */
.ejemplos-rapidos-mejorado {
    padding: 1.5rem;
    background: rgba(0, 0, 0, 0.3);
}

.ejemplos-header {
    margin-bottom: 1.5rem;
    text-align: center;
}

.ejemplos-header h4 {
    color: var(--neon-pink);
    font-size: 1.2rem;
    margin-bottom: 0.5rem;
}

.ejemplos-desc {
    color: var(--text-dim);
    font-size: 0.9rem;
}

.ejemplos-buttons-mejorado {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1rem;
    margin-bottom: 1.5rem;
}

.btn-ejemplo-mejorado {
    background: rgba(255, 0, 255, 0.1);
    border: 1px solid rgba(255, 0, 255, 0.3);
    border-radius: 8px;
    padding: 1rem;
    cursor: pointer;
    transition: all 0.3s;
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    color: var(--text-light);
    height: 100%;
}

.btn-ejemplo-mejorado:hover {
    background: rgba(255, 0, 255, 0.2);
    transform: translateY(-3px);
    border-color: var(--neon-pink);
}

.btn-ejemplo-mejorado.selected {
    background: rgba(255, 0, 255, 0.25);
    border-color: var(--neon-pink);
    box-shadow: 0 0 15px rgba(255, 0, 255, 0.3);
}

.ejemplo-icon {
    font-size: 2rem;
    margin-bottom: 0.5rem;
}

.ejemplo-texto {
    font-weight: bold;
    margin-bottom: 0.25rem;
    font-size: 0.95rem;
}

.ejemplo-desc {
    font-size: 0.8rem;
    color: var(--text-dim);
}

.ejemplos-info {
    text-align: center;
    padding-top: 1rem;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
    color: var(--text-dim);
    font-size: 0.9rem;
}

/* ANÁLISIS SEMÁNTICO MEJORADO */
.analisis-container {
    background: var(--bg-card);
    border-radius: 12px;
    border: 1px solid rgba(57, 255, 20, 0.2);
    overflow: hidden;
}

.analisis-header {
    background: rgba(57, 255, 20, 0.1);
    padding: 1.5rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 1px solid rgba(57, 255, 20, 0.2);
}

.analisis-header h3 {
    color: var(--neon-green);
    font-size: 1.3rem;
}

.analisis-score {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.5rem;
}

.score-circle {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--neon-green), #2E7D32);
    display: flex;
    align-items: center;
    justify-content: center;
    border: 3px solid var(--neon-green);
    box-shadow: 0 0 20px rgba(57, 255, 20, 0.3);
}

.score-number {
    font-size: 1.8rem;
    font-weight: bold;
    color: white;
}

.score-label {
    font-size: 0.85rem;
    color: var(--text-dim);
}

.analisis-detalle {
    padding: 1.5rem;
}

.metricas-grid-completo {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.metrica-completa {
    background: rgba(0, 0, 0, 0.3);
    border-radius: 8px;
    padding: 1.5rem;
    border: 1px solid rgba(255, 255, 255, 0.1);
}

.metrica-header {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 1rem;
}

.metrica-icon {
    font-size: 1.5rem;
}

.metrica-title {
    font-weight: 600;
    color: var(--text-light);
    font-size: 1rem;
}

.metrica-content {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}

.metrica-value {
    font-size: 1.8rem;
    font-weight: bold;
    color: var(--neon-cyan);
    text-align: center;
}

.metrica-bar-container {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.metrica-bar-bg {
    flex: 1;
    height: 8px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 4px;
    overflow: hidden;
}

.metrica-bar-fill {
    height: 100%;
    background: linear-gradient(90deg, var(--neon-green), var(--neon-cyan));
    border-radius: 4px;
    transition: width 1s ease;
}

.metrica-percentage {
    font-size: 0.85rem;
    color: var(--text-dim);
    min-width: 50px;
    text-align: right;
}

/* ÁRBOL DE ESTRUCTURA COMPLETO */
.arbol-estructura-completo {
    background: rgba(0, 0, 0, 0.4);
    border-radius: 8px;
    border: 1px solid rgba(255, 255, 255, 0.1);
    margin-bottom: 1.5rem;
    overflow: hidden;
}

.arbol-header {
    background: rgba(0, 0, 0, 0.5);
    padding: 1rem 1.5rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.arbol-header h4 {
    color: var(--neon-yellow);
    margin: 0;
    font-size: 1rem;
}

.btn-expandir {
    background: rgba(0, 255, 255, 0.1);
    color: var(--text-light);
    border: 1px solid rgba(0, 255, 255, 0.3);
    padding: 0.5rem 1rem;
    border-radius: 4px;
    cursor: pointer;
    font-size: 0.85rem;
    transition: all 0.2s;
}

.btn-expandir:hover {
    background: rgba(0, 255, 255, 0.2);
}

.arbol-contenido {
    padding: 1rem;
}

.tree-container {
    background: #0a0a1a;
    padding: 1rem;
    border-radius: 6px;
    max-height: 200px;
    overflow-y: auto;
    font-family: 'Consolas', monospace;
    font-size: 0.85rem;
    transition: max-height 0.3s ease;
}

.tree-container.expandido {
    max-height: 400px;
}

.tree-line {
    padding: 0.1rem 0;
    white-space: pre;
    font-family: 'Consolas', monospace;
    font-size: 0.85rem;
    line-height: 1.4;
}

.semantic-tag {
    color: var(--neon-green);
    font-weight: bold;
}

.div-tag {
    color: #FF6B6B;
    font-weight: bold;
}

/* RECOMENDACIONES COMPLETAS */
.recomendaciones-completas {
    background: rgba(255, 193, 7, 0.05);
    border-radius: 8px;
    border: 1px solid rgba(255, 193, 7, 0.2);
    padding: 1.5rem;
}

.recomendaciones-completas h4 {
    color: var(--neon-yellow);
    margin-bottom: 1rem;
    font-size: 1.1rem;
}

.recomendaciones-lista {
    display: flex;
    flex-direction: column;
    gap: 1rem;
    margin-bottom: 1.5rem;
}

.recomendacion-item {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    padding: 1rem;
    background: rgba(0, 0, 0, 0.3);
    border-radius: 6px;
    border-left: 3px solid var(--neon-yellow);
}

.recomendacion-icon {
    font-size: 1.2rem;
    flex-shrink: 0;
}

.recomendacion-text {
    color: var(--text-light);
    font-size: 0.9rem;
    line-height: 1.5;
}

.recomendaciones-actions {
    display: flex;
    justify-content: center;
}

.btn-recomendacion {
    background: rgba(255, 193, 7, 0.1);
    color: var(--neon-yellow);
    border: 1px solid rgba(255, 193, 7, 0.3);
    padding: 0.75rem 1.5rem;
    border-radius: 6px;
    cursor: pointer;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.2s;
}

.btn-recomendacion:hover {
    background: rgba(255, 193, 7, 0.2);
    transform: translateY(-2px);
}

/* CONTROLES DEL SIMULADOR - MEJOR VISIBLES */
.simulador-controls {
    background: rgba(0, 0, 0, 0.5);
    border-radius: 12px;
    padding: 1.5rem;
    border: var(--border-glow);
    margin-bottom: 1.5rem;
}

.controls-header {
    margin-bottom: 1.5rem;
    text-align: center;
}

.controls-header h3 {
    color: var(--neon-pink);
    margin-bottom: 0.5rem;
    font-size: 1.3rem;
}

.controls-header p {
    color: var(--text-dim);
    font-size: 0.95rem;
}

.controls-buttons {
    display: flex;
    gap: 1rem;
    justify-content: center;
    flex-wrap: wrap;
    margin-bottom: 1rem;
}

.btn-control {
    padding: 1rem 1.5rem;
    border: none;
    border-radius: 8px;
    font-weight: bold;
    cursor: pointer;
    transition: all 0.3s;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    font-size: 1rem;
    min-width: 200px;
    justify-content: center;
}

.btn-analyze {
    background: linear-gradient(45deg, var(--neon-cyan), #0097A7);
    color: white;
}

.btn-optimize {
    background: linear-gradient(45deg, var(--neon-green), #2E7D32);
    color: white;
}

.btn-reset {
    background: linear-gradient(45deg, var(--neon-pink), #FF00AA);
    color: white;
}

.btn-control:hover {
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
}

.btn-control .btn-icon {
    font-size: 1.2rem;
}

.controls-info {
    text-align: center;
    color: var(--text-dim);
    font-size: 0.9rem;
    padding-top: 1rem;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
}

/* NOTIFICACIONES */
.notificacion {
    position: fixed;
    top: 20px;
    right: 20px;
    background: var(--bg-card);
    border-radius: 8px;
    padding: 1rem 1.5rem;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 1rem;
    min-width: 300px;
    max-width: 400px;
    z-index: 10000;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    animation: slideIn 0.3s ease;
    border-left: 4px solid;
}

@keyframes slideIn {
    from {
        transform: translateX(100%);
        opacity: 0;
    }
    to {
        transform: translateX(0);
        opacity: 1;
    }
}

.notificacion-success {
    border-left-color: var(--neon-green);
    background: rgba(57, 255, 20, 0.1);
}

.notificacion-warning {
    border-left-color: var(--neon-yellow);
    background: rgba(255, 193, 7, 0.1);
}

.notificacion-info {
    border-left-color: var(--neon-cyan);
    background: rgba(0, 255, 255, 0.1);
}

.notificacion-contenido {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    flex: 1;
}

.notificacion-icon {
    font-size: 1.2rem;
}

.notificacion-mensaje {
    color: var(--text-light);
    font-size: 0.95rem;
    line-height: 1.4;
}

.notificacion-cerrar {
    background: none;
    border: none;
    color: var(--text-dim);
    font-size: 1.5rem;
    cursor: pointer;
    padding: 0;
    line-height: 1;
    transition: color 0.2s;
}

.notificacion-cerrar:hover {
    color: var(--text-light);
}

/* RESPONSIVE */
@media (max-width: 768px) {
    .leccion-programacion-html5 {
        padding: 1rem;
    }
    
    .titulo-leccion {
        font-size: 1.8rem;
    }
    
    .simulador-contenido-ancho {
        margin-top: 1rem;
    }
    
    .editor-y-ejemplos {
        gap: 1rem;
    }
    
    .code-editor {
        height: 300px;
        min-height: 300px;
        max-height: 300px;
    }
    
    .ejemplos-buttons-mejorado {
        grid-template-columns: 1fr;
    }
    
    .metricas-grid-completo {
        grid-template-columns: 1fr;
    }
    
    .controls-buttons {
        flex-direction: column;
    }
    
    .btn-control {
        width: 100%;
    }
    
    .analisis-header {
        flex-direction: column;
        gap: 1rem;
        text-align: center;
    }
}

/* ANIMACIONES */
@keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.7; }
}

.neon-bullet {
    animation: pulse 2s infinite;
}

/* SCROLLBAR PERSONALIZADA */
::-webkit-scrollbar {
    width: 8px;
    height: 8px;
}

::-webkit-scrollbar-track {
    background: rgba(0, 0, 0, 0.3);
    border-radius: 4px;
}

::-webkit-scrollbar-thumb {
    background: rgba(0, 255, 255, 0.3);
    border-radius: 4px;
}

::-webkit-scrollbar-thumb:hover {
    background: rgba(0, 255, 255, 0.5);
}
</style>
<!-- FIN LECCIÓN CYBERPUNK OPTIMIZADA -->
HTML,
];
```
