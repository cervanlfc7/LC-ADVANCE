# Lección: Ley de Shelford - Mejoras Implementadas

**Sistema Educativo Cyberpunk**  
**Ecosistemas - Nivel Avanzado**  
**Última actualización: 2026-03-23**

---

## 📋 Descripción General

La lección "Ley de Shelford: La Ley de la Tolerancia y los Límites Ambientales de la Vida" ha sido completamente rediseñada aplicando el estándar **Cyberpunk Educativo** con estructura profesional, simuladores interactivos y evaluaciones robustas.

**Slug:** `ley-shelford`  
**Materia:** Ecosistemas  
**Competencias:** Análisis ecológico, comprensión de tolerancia ambiental, predicción de vulnerabilidad  

---

## ✨ Mejoras Implementadas

### 1. **Restructuración Completa (7 Secciones Pedagógicas)**

```
I.    Introducción + Fórmula matemática
II.   Principios teóricos (5 zonas de tolerancia)
III.  Visualización SVG (Curva de tolerancia)
IV.   Simulador interactivo (Curva dinámica)
V.    Mini-laboratorio (Estenoicas vs Eurioicas)
VI.   Quiz autoevaluado (4 preguntas)
VII.  Errores comunes (3 items expandibles)
VIII. Cierre (Conexión curricular + Problemas + Reflexión)
```

### 2. **CSS Profesional Independiente**

**Archivo:** `assets/css/leccion-ley-shelford.css` (800+ líneas)

**Características:**
- ✅ Tema neon cyberpunk consistente
- ✅ Variables CSS para theming (colores, espaciado, transiciones)
- ✅ Simulador con slider gradiente 5 colores
- ✅ Responsive (desktop, tablet, mobile)
- ✅ Accesibilidad WCAG AA
- ✅ Animaciones suaves y GPU-accelerated

### 3. **JavaScript Global & Seguro**

#### Quiz Mejorado:
```javascript
window.shelfordQuizState = { score: 0, total: 4, answered: new Set() }
window.checkShelfordQuiz = function(button) { ... }
```

**Características:**
- ✅ Prevención de doble-respuesta
- ✅ Validación null-safe
- ✅ Retroalimentación inmediata
- ✅ Botones disabled tras respuesta
- ✅ Puntuación en tiempo real

#### Errores Comunes:
```javascript
window.toggleShelfordError = function(checkbox) { ... }
```

### 4. **Simulador Interactivo**

**Características:**
- **Slider Dinámico:** Rango 0-100% con gradiente 5 colores
  - Rojo: Zona letal (0-15%, > 85-100%)
  - Naranja: Estrés (15-30%, 85%)
  - Verde: Óptima (30-70%)
- **Barra de Progreso:** Visual time-real de la zona actual
- **Retroalimentación Inmediata:**
  - Zona letal mínima / máxima
  - Estrés mínimo / máximo
  - Zona óptima
- **Mensajes Contextuales:** Explicación del efecto biológico

**Lógica Pedagógica:**
```
Estudiante mueve slider → Sistema detecta zona
Barra se llena con color de zona → Resultado se actualiza
Texto explica efecto biológico de esa zona
```

### 5. **Mini-Laboratorio: Estenoica vs Eurioica**

**Dos Selectores:**
- **Tipo de Especie:** Estenoica (rango estrecho) / Eurioica (rango amplio)
- **Cambio Ambiental:** Aumento T° +4°C / Acidificación pH -0.3 / Aumento salinidad +5 ppt

**Salida Dinámica:**
```
Riesgo de impacto: ALTO RIESGO / BAJO A MEDIO RIESGO
Análisis: Explicación científica
Ejemplo real: Corales en blanqueamiento / Ratas urbanas
```

### 6. **Quiz Robusto (4 Preguntas)**

**Preguntas:**
1. Ley de Shelford enfatiza → Tanto déficit como exceso limitan ✓
2. En zona óptima → Máximo rendimiento biológico ✓
3. Especies estenoicas son → Especialistas con rangos estrechos ✓
4. Más vulnerables en cambio climático → Especies estenoicas ✓

**UX Mejorado:**
- Botones con barra lateral animada (before pseudo-element)
- Retroalimentación color-coded (✅ verde / ❌ rojo)
- Respuesta correcta siempre visible si fallas
- Score con gradiente neon
- Panel score con sombra/texto glow

### 7. **Sección de Errores Comunes**

**3 Errores Típicos:**
1. **Confusión Liebig-Shelford** → Shelford incluye máximo
2. **Rangos similares** → Varían ampliamente entre especies
3. **Ignorar exceso** → Eutrofización por nutrientes excesivos

**Interacción:**
- Checkboxes para revelar explicación
- Animación slideDown suave
- Explicación con borde y padding

### 8. **Tabla Teórica Profesional**

**5 Zonas de Tolerancia:**
- Letal mínima (F < F_min)
- Estrés mínimo (F_min – F_opt_min)
- Óptima (F_opt_min – F_opt_max)
- Estrés máximo (F_opt_max – F_max)
- Letal máxima (F > F_max)

---

## 📊 Componentes Técnicos

### Estructura HTML
```html
<p class="intro">                         <!-- Intro con estilo -->
<p class="formula-neon">                  <!-- Fórmula MathJax -->
<h3 class="section-title">                <!-- Títulos neon -->
<table class="neon-table">                <!-- Tabla con bordes glow -->
<svg class="shelford-svg">                <!-- Diagrama SVG -->
<div class="shelford-sim">                <!-- Simulador interactivo -->
<div class="mini-lab">                    <!-- Mini-lab dinámico -->
<div class="quiz-shelford-container">     <!-- Quiz con estado global -->
<div class="errors-shelford-container">   <!-- Errores expandibles -->
```

### CSS Variables (47 líneas)
```css
--neon-biosfera: #39ff14
--neon-interactivo: #00ffff
--neon-alerta: #ff3366
--neon-exito: #00e676
--neon-critico: #ff1744
--neon-secundario: #ffff00
--neon-naranja: #ff9800
--space-*, --font-*, --transition-*
```

### Simulador Slider Gradiente
```css
background: linear-gradient(90deg, 
    #ff1744 0%,      /* Rojo letal */
    #ff9800 25%,     /* Naranja estrés */
    #00e676 50%,     /* Verde óptimo */
    #ff9800 75%,     /* Naranja estrés */
    #ff1744 100%     /* Rojo letal */
)
```

---

## 🔧 Integración y Configuración

### 1. **CSS Linking** (Ya configurado)
```php
<!-- En leccion_detalle.php, línea ~109 -->
<link rel="stylesheet" href="assets/css/leccion-ley-shelford.css">
```

### 2. **MathJax** (Global)
```
\[ R(F) = \begin{cases} 0 & \text{si } F < F_{\min} \text{ o } F > F_{\max} \\ >0 & \text{si } F_{\min} \leq F \leq F_{\max} \end{cases} \]
```

### 3. **JavaScript Global**
- `window.checkShelfordQuiz()` - Function para quiz
- `window.toggleShelfordError()` - Función para errores
- `window.shelfordQuizState` - Estado global del quiz

---

## ✅ Testing Checklist

### Funcionalidad
- [x] Slider se mueve suavemente
- [x] Barra de progreso actualiza color dinámicamente
- [x] Resultado muestra zona correcta y mensaje
- [x] Quiz registra respuestas sin duplicar
- [x] Errores se expanden/contraen
- [x] Mini-lab cambia contenido en selects
- [x] Tablas renderizan con estilos

### Responsividad
- [x] Desktop: Todos elementos visibles
- [x] Tablet (768px): Stackeable
- [x] Mobile (480px): Single column

### Accesibilidad
- [x] Focus states visibles
- [x] Contraste ≥ 4.5:1 WCAG AA
- [x] Navegación por teclado funciona
- [x] Descripciones alt en SVG

---

## 🚀 Mejoras Futuras (Opcional)

1. **Simulador Avanzado:**
   - Múltiples factores simultáneos
   - Predador-presa interactivo
   - Gráficos históricos

2. **Gamificación:**
   - Badges por completar secciones
   - Leaderboard quiz
   - Modo "speedrun"

3. **Integración:**
   - Google Classroom API
   - Exportar reporte PDF
   - Analytics de estudiantes

---

## 📝 Notas Importantes

### Scope Global
Las funciones `window.checkShelfordQuiz` y `window.toggleShelfordError` **DEBEN** ser globales para onclick handlers. Esto es seguro porque:
1. Prefijo "Shelford" evita conflictos
2. Encapsulación con closures
3. State aislado (shelfordQuizState)

### CSS Específico
Un archivo CSS por lección permite:
- Theming independiente
- Sin conflictos de especificidad
- Fácil mantenimiento
- Carga bajo demanda

### Slider Gradiente
El gradiente 5 colores simula visualmente las 5 zonas de tolerancia en una sola dimensión.

---

## 🛠️ Troubleshooting

### Quiz no funciona
**Solución:** Verificar `window.checkShelfordQuiz` en console  
```javascript
console.log(window.checkShelfordQuiz)  // Debe mostrar función
```

### CSS no carga
**Verificación:** DevTools Network → `leccion-ley-shelford.css`

### Slider lento
**Causa:** Navegador mobile con muchos listeners  
**Solución:** Usar `requestAnimationFrame` (mejora futura)

### Simulador no actualiza
**Verificación:** Abrir console, mover slider, ver si hay errores

---

## 📚 Recursos Pedagógicos

### Teórico
- Shelford, V. E. (1913). Animal Communities in Temperate America
- Niche theory and tolerance curves
- Speciation and environmental specialization

### Práctico
- Análisis de vulnerabilidad a cambio climático
- Distribución de especies endémicas
- Restauración de ecosistemas

---

## 📞 Contacto & Soporte

**Sistema:** LC-ADVANCE Cyberpunk Educativo  
**Materia:** Ecosistemas Avanzados  
**Versión:** 2.0 Premium  
**Estado:** ✅ Producción

---

**¡Disfruta la lección! 🌍✨**
