# 📖 Documentación Completa - LC-ADVANCE

Bienvenido a la documentación de **LC-ADVANCE**, una plataforma educativa interactiva con lecciones, quizzes, puntos y ranking.

---

## 🎯 ¿Por Dónde Empiezo?

### 👤 Soy usuario (quiero usar la plataforma)

1. [README.md](README.md) → Instalación y primeros pasos
2. [QUICK_REFERENCE.md](QUICK_REFERENCE.md) → Tareas comunes (5 min)

**Pasos:**
```bash
# 1. Instalar
mysql -u root -p < sql/lc_advance.sql

# 2. Iniciar
php -S localhost:8000 -t .

# 3. Entrar
# http://localhost:8000/index.php
```

---

### 👨‍💻 Soy desarrollador (quiero modificar el código)

1. [README.md](README.md) → Requisitos y setup
2. [DEVELOPMENT.md](DEVELOPMENT.md) → Arquitectura y cómo funciona
3. [API.md](API.md) → Endpoints y ejemplos
4. [QUICK_REFERENCE.md](QUICK_REFERENCE.md) → Snippets y comandos útiles

**Tareas comunes:**
- [Agregar nueva lección](README.md#cómo-agregar-lecciones)
- [Agregar nueva funcionalidad](DEVELOPMENT.md#guía-paso-a-paso)
- [Ejecutar tests](README.md#testing--cicd)

---

### 🔧 Tengo un problema (algo no funciona)

1. [TROUBLESHOOTING.md](TROUBLESHOOTING.md) → Soluciones paso a paso
2. [QUICK_REFERENCE.md](QUICK_REFERENCE.md) → Errores comunes

**Errores frecuentes:**
- [MySQL connection refused](TROUBLESHOOTING.md#-mysql-connection-refused)
- [Parse error en PHP](TROUBLESHOOTING.md#-parse-error-en-srccontentphp)
- [Los puntos no se guardan](TROUBLESHOOTING.md#-los-puntos-no-se-guardan-después-del-quiz)
- [Lección no aparece](TROUBLESHOOTING.md#-lección-no-aparece-en-dashboard)

---

## 📚 Índice Completo de Documentación

### [README.md](README.md) - Guía General ⭐

**Para:** Todos  
**Tiempo:** 15 min de lectura

Contiene:
- ✅ Características principales (Ranking, Badges, Progreso)
- ✅ Requisitos del sistema
- ✅ Instalación paso a paso
- ✅ Getting Started (crear usuario, tomar lección, ver ranking)
- ✅ Estructura del proyecto
- ✅ Endpoints principales (con ranking data)
- ✅ Cómo agregar lecciones (paso a paso)
- ✅ Testing y CI/CD
- ✅ Troubleshooting básico

**Úsalo para:**
- Primera vez usando el proyecto
- Entender la estructura general
- Instalación y setup inicial
- Entender cómo funcionan los puntos y rankings

---

### [DEVELOPMENT.md](DEVELOPMENT.md) - Guía Técnica 🔧

**Para:** Desarrolladores  
**Tiempo:** 30 min de lectura

Contiene:
- ✅ Stack tecnológico explicado
- ✅ Ciclo de desarrollo (branching, commits, PRs)
- ✅ Estructura de código (por archivo)
- ✅ Cómo funciona cada módulo (incluido ranking)
- ✅ Flujos principales (login, quiz, dashboard con ranking)
- ✅ Guía completa: cómo agregar funcionalidad
- ✅ Performance y optimizaciones
- ✅ Seguridad (implementado + por hacer)
- ✅ FAQ de desarrollo

**Úsalo para:**
- Entender cómo funciona el código
- Agregar nuevas funcionalidades
- Mejorar performance o seguridad
- Contribuir al proyecto
- Entender cómo el ranking se actualiza en tiempo real

---

### [API.md](API.md) - Referencia de Endpoints 📡

**Para:** Desarrolladores y testers  
**Tiempo:** 20 min de lectura

Contiene:
- ✅ Base URL y autenticación
- ✅ Todos los endpoints (12+)
- ✅ Parámetros requeridos
- ✅ Respuestas JSON esperadas
- ✅ Códigos de error
- ✅ Ejemplos curl para cada endpoint
- ✅ Flujo completo (register → login → quiz → estado)
- ✅ Script bash de ejemplo

**Úsalo para:**
- Testear endpoints con curl
- Integrar con frontend
- Entender qué devuelve cada endpoint
- Debugging de problemas de datos

---

### [QUICK_REFERENCE.md](QUICK_REFERENCE.md) - Cheat Sheet ⚡

**Para:** Todos (referencia rápida)  
**Tiempo:** 5 min de consulta

Contiene:
- ✅ Comandos setup (1 minuto)
- ✅ Agregar lección (copy-paste)
- ✅ Comandos curl más comunes
- ✅ URLs principales
- ✅ Estructura de lección
- ✅ Tabla de errores comunes
- ✅ Tips prácticos
- ✅ Enlaces útiles

**Úsalo para:**
- Recordar cómo hacer cosas
- Copy-paste de templates
- Verificar URLs rápidamente
- Tips y tricks

---

### [TROUBLESHOOTING.md](TROUBLESHOOTING.md) - Solución de Problemas 🔍

**Para:** Usuarios y desarrolladores  
**Tiempo:** Variable (busca tu error)

Contiene:
- ✅ Problemas de instalación (MySQL, credenciales)
- ✅ Problemas de PHP (parse errors, undefined)
- ✅ Problemas de funcionalidad (login, quiz, puntos)
- ✅ Herramientas de debug (verificar sintaxis, logs)
- ✅ Checklist de debug
- ✅ Flujo de debug general
- ✅ Cómo reportar bugs

**Úsalo para:**
- Encontrar solución a un problema
- Entender qué está mal
- Ejecutar herramientas de debug
- Reportar bugs correctamente

---

## 🎓 Aprendizaje Progresivo

### Nivel 1: Principiante (Quiero usar la plataforma)

```
1. Lee: README.md (Requisitos + Instalación)
   ↓
2. Instala y configura la BD
   ↓
3. Lee: README.md (Getting Started)
   ↓
4. Crea un usuario y toma una lección
   ↓
✅ Listo! Puedes usar la plataforma
```

**Tiempo:** 15-30 minutos

---

### Nivel 2: Intermedio (Quiero agregar lecciones)

```
1. Completa Nivel 1
   ↓
2. Lee: README.md (Cómo agregar lecciones)
   ↓
3. Lee: QUICK_REFERENCE.md (Estructura de lección)
   ↓
4. Edita src/content.php y agrega tu lección
   ↓
5. Recarga la página y verifica que aparece
   ↓
✅ Listo! Puedes agregar lecciones
```

**Tiempo:** 30-45 minutos

---

### Nivel 3: Avanzado (Quiero modificar el código)

```
1. Completa Nivel 2
   ↓
2. Lee: DEVELOPMENT.md (Completo)
   ↓
3. Lee: API.md (Endpoints)
   ↓
4. Analiza: src/funciones.php (cómo funciona)
   ↓
5. Ejecuta: tests/run_all_tests.php (entiende los tests)
   ↓
6. Crea una rama: git checkout -b feature/mi-feature
   ↓
7. Modifica código, commit, push, PR
   ↓
8. Espera que pase CI y mergea
   ↓
✅ Listo! Puedes contribuir al proyecto
```

**Tiempo:** 2-4 horas

---

## 🗺️ Mapa Conceptual

```
┌─────────────────────────────────────────────────────┐
│                    LC-ADVANCE                        │
└─────────────────────────────────────────────────────┘
                           │
        ┌──────────────────┼──────────────────┐
        │                  │                  │
    📖 README          🔧 DEVELOPMENT       📡 API
    (Guía gral)        (Técnica)          (Endpoints)
        │                  │                  │
        ├─ Setup           ├─ Stack          ├─ GET /index.php
        ├─ Getting Start   ├─ Estructura     ├─ POST /login.php
        ├─ Agregar lección ├─ Módulos        ├─ POST /register.php
        ├─ Testing         ├─ Flujos         ├─ GET /dashboard.php
        └─ Troubleshooting ├─ Desarrollo     ├─ POST /funciones.php
                           ├─ Performance    └─ POST /mapa/updateDB.php
                           └─ Seguridad

        ⚡ QUICK_REFERENCE (Todo lo anterior resumido)
        🔍 TROUBLESHOOTING (Soluciones a problemas)
```

---

## 🚀 Flujos Comunes

### "Quiero empezar desde cero"

```
1. README.md: Instalación rápida
2. README.md: Getting Started
3. Crear usuario y explorar
```

**Documentos:** README.md  
**Tiempo:** 30 min

---

### "Quiero agregar una lección de Trigonometría"

```
1. QUICK_REFERENCE.md: Estructura de lección
2. README.md: Cómo agregar lecciones (código completo)
3. Editar src/content.php
4. Recargar navegador
```

**Documentos:** QUICK_REFERENCE.md, README.md  
**Tiempo:** 15 min

---

### "Quiero crear un nuevo endpoint para exportar datos"

```
1. DEVELOPMENT.md: Stack tecnológico
2. DEVELOPMENT.md: Estructura de código
3. API.md: Ver cómo funciona calificar_quiz
4. DEVELOPMENT.md: Guía paso a paso (nuevo endpoint)
5. Crear rama, código, test, commit, PR
6. Esperar CI y mergear
```

**Documentos:** DEVELOPMENT.md, API.md  
**Tiempo:** 2 horas

---

### "Mis puntos no se guardan después del quiz"

```
1. TROUBLESHOOTING.md: Buscar "puntos no se guardan"
2. Ejecutar pasos de debuggeo
3. Si no se resuelve → QUICK_REFERENCE.md: Errores comunes
4. Si aún no → TROUBLESHOOTING.md: Checklist de debug
```

**Documentos:** TROUBLESHOOTING.md, QUICK_REFERENCE.md  
**Tiempo:** 15-30 min

---

## 📞 Resumen de Documentos

| Documento | Audiencia | Casos de Uso | Tiempo |
|-----------|-----------|-------------|--------|
| [README.md](README.md) | Todos | Setup, primeros pasos | 15 min |
| [DEVELOPMENT.md](DEVELOPMENT.md) | Dev | Entender código, agregar features | 30 min |
| [API.md](API.md) | Dev/Tester | Endpoints, integración | 20 min |
| [QUICK_REFERENCE.md](QUICK_REFERENCE.md) | Todos | Referencia rápida, snippets | 5 min |
| [TROUBLESHOOTING.md](TROUBLESHOOTING.md) | Todos | Resolver problemas | Variable |

---

## ✅ Checklist: ¿Cuál documento necesito?

- [ ] **Quiero instalar el proyecto**  
  → [README.md](README.md)

- [ ] **Quiero saber cómo usar la plataforma**  
  → [README.md](README.md) + [QUICK_REFERENCE.md](QUICK_REFERENCE.md)

- [ ] **Quiero agregar una lección**  
  → [README.md: Cómo agregar lecciones](README.md#cómo-agregar-lecciones)

- [ ] **Quiero entender cómo funciona el código**  
  → [DEVELOPMENT.md](DEVELOPMENT.md)

- [ ] **Quiero ver ejemplos de endpoints**  
  → [API.md](API.md)

- [ ] **Tengo un error**  
  → [TROUBLESHOOTING.md](TROUBLESHOOTING.md)

- [ ] **Quiero una referencia rápida**  
  → [QUICK_REFERENCE.md](QUICK_REFERENCE.md)

---

## 📈 Estructura de Documentación

```
📁 LC-ADVANCE/
│
├── 📄 README.md                ← Lee primero (guía general)
├── 🔧 DEVELOPMENT.md           ← Para desarrollo
├── 📡 API.md                   ← Para integración
├── ⚡ QUICK_REFERENCE.md       ← Para referencia rápida
├── 🔍 TROUBLESHOOTING.md       ← Para resolver problemas
├── 📖 DOCS_INDEX.md            ← Este archivo (navegación)
│
├── src/
│   ├── content.php             ← Las 200+ lecciones
│   └── funciones.php           ← Endpoints AJAX
│
├── config/
│   └── config.php              ← Configuración BD
│
├── sql/
│   └── lc_advance.sql          ← Dump de BD
│
└── tests/
    └── run_all_tests.php       ← Suite de tests
```

---

## 🔗 Enlaces Directos

### Por Rol

**Estudiante:**
- [README: Getting Started](README.md#getting-started)
- [QUICK_REFERENCE: Primeros pasos](QUICK_REFERENCE.md#-iniciar-proyecto)

**Profesor/Creador de contenido:**
- [README: Agregar lecciones](README.md#cómo-agregar-lecciones)
- [QUICK_REFERENCE: Agregar lección](QUICK_REFERENCE.md#-agregar-lección)

**Desarrollador:**
- [DEVELOPMENT: Completo](DEVELOPMENT.md)
- [API: Referencia](API.md)
- [QUICK_REFERENCE: Snippets](QUICK_REFERENCE.md)

**DevOps/Operaciones:**
- [README: Instalación](README.md#instalación-rápida)
- [README: Deploying](README.md#-despliegue-a-producción)
- [TROUBLESHOOTING: Instalación](TROUBLESHOOTING.md#-problemas-de-instalación)

---

## 🎯 Preguntas Frecuentes Rápidas

**P: ¿Dónde agrego una lección?**  
R: [src/content.php](README.md#cómo-agregar-lecciones) - Ver [QUICK_REFERENCE.md](QUICK_REFERENCE.md#-agregar-lección) para template

**P: ¿Cómo funciona el login?**  
R: [DEVELOPMENT.md: Flujo de Login](DEVELOPMENT.md#1-flujo-de-login)

**P: ¿Qué endpoints existen?**  
R: [API.md](API.md) - Lista completa con ejemplos curl

**P: Tengo un error de Parse**  
R: [TROUBLESHOOTING.md: Parse error](TROUBLESHOOTING.md#-parse-error-en-srccontentphp)

**P: ¿Cómo agrego una funcionalidad nueva?**  
R: [DEVELOPMENT.md: Guía paso a paso](DEVELOPMENT.md#guía-paso-a-paso)

---

## 💡 Pro Tips

1. **Usa Ctrl+F en cada documento** para buscar palabras clave
2. **Los títulos con # son clickeables** en GitHub (puedes linkear)
3. **Guarda QUICK_REFERENCE.md en favoritos** para acceso rápido
4. **Si estás perdido, lee el orden sugerido en "¿Por Dónde Empiezo?"**

---

## 📞 Soporte

Si la documentación no responde tu pregunta:

1. Busca en [TROUBLESHOOTING.md](TROUBLESHOOTING.md)
2. Revisa en [API.md](API.md) o [DEVELOPMENT.md](DEVELOPMENT.md)
3. Abre un issue: https://github.com/cervanlfc7/LC-ADVANCE/issues
4. Incluye el documento que revisaste y qué falta

---

**¡Gracias por leer la documentación!** 📚✨

Última actualización: Enero 2026  
Documentos: 5 | Palabras: 15,000+ | Ejemplos: 50+
