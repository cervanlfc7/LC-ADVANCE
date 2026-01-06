# LC-ADVANCE

[![CI](https://github.com/cervanlfc7/LC-ADVANCE/actions/workflows/ci.yml/badge.svg)](https://github.com/cervanlfc7/LC-ADVANCE/actions/workflows/ci.yml)

**Plataforma educativa interactiva** con lecciones, quizzes adaptativos, sistema de puntos, badges, ranking en tiempo real y mapa de combate interactivo.

## 📋 Contenido Rápido

- **[Requisitos](#requisitos)** | **[Instalación](#instalación-rápida)** | **[Getting Started](#getting-started)** | **[Agregar Lecciones](#cómo-agregar-lecciones)** | **[Troubleshooting](#troubleshooting)**

**Documentación complementaria:**
- [DEVELOPMENT.md](DEVELOPMENT.md) - Arquitectura y desarrollo
- [API.md](API.md) - Endpoints y referencias
- [TROUBLESHOOTING.md](TROUBLESHOOTING.md) - Soluciones a problemas

---

## ✨ Características Principales

### 🎓 Lecciones Interactivas
- ✅ 200+ lecciones en múltiples materias
- ✅ Contenido estructurado con quizzes integrados
- ✅ Progreso guardado automáticamente
- ✅ Acceso invitado (lectura sin guardar)

### 🏆 Sistema de Puntos y Ranking
- ✅ **Top 10 Ranking en vivo** - Se actualiza automáticamente cada 15 segundos
- ✅ Puntos por respuesta correcta
- ✅ Cálculo automático de niveles
- ✅ Badges (insignias) por logros
- ✅ Solo usuarios logueados aparecen en ranking

### 🗺️ Mapa Interactivo
- ✅ Combate educativo con maestros
- ✅ Selección dinámica de personajes
- ✅ Sistema de diálogos inmersivo

### 🔐 Autenticación y Seguridad
- ✅ Login/Register con hashing bcrypt
- ✅ Sesiones seguras
- ✅ Protección CSRF
- ✅ Validación de entrada

### 📱 Responsive Design
- ✅ Funciona en desktop y mobile
- ✅ Diseño retro 8-bit moderno
- ✅ Efectos visuales y animaciones

### 🚀 Performance
- ✅ Tests automatizados
- ✅ CI/CD con GitHub Actions
- ✅ Carga rápida de contenido
- ✅ Actualizaciones en tiempo real

---

## Requisitos

- **PHP** 8.1+ (8.2 recomendado)
- **MySQL/MariaDB** 5.7+
- **Servidor web**: Apache, Nginx, o PHP built-in
- **Extensiones PHP**: PDO, pdo_mysql, curl, mbstring
- **Navegador moderno** (Chrome, Firefox, Safari, Edge)

**Instalación local (XAMPP):**
- Windows: XAMPP (https://www.apachefriends.org)
- macOS/Linux: XAMPP o docker

---

## Instalación Rápida

### 1️⃣ Clonar/Descargar el proyecto

```bash
git clone https://github.com/cervanlfc7/LC-ADVANCE.git
cd LC-ADVANCE
```

### 2️⃣ Configurar base de datos

#### Opción A: Base de datos unificada (recomendado) ⭐

```bash
# Windows (XAMPP)
c:\xampp\mysql\bin\mysql.exe -u root -p < db\lc_advance.sql

# macOS/Linux
mysql -u root -p < db/lc_advance.sql
```

**Nota:** El archivo `db/lc_advance.sql` incluye automáticamente:
- Tabla `usuarios` (login y progreso)
- Tabla `user_progress` (puntos y lecciones completadas)
- Tabla `lecciones_completadas` (tracking)
- Tabla `badges` (logros)
- Tabla `preguntas` (banco de preguntas del sistema de combate)
- Tabla `dialogosmapa` (diálogos del mapa)
- Tabla `maestroact` (maestros actuales en mapa)

### 3️⃣ Configurar credenciales

Edita `config/config.php`:

```php
define('DB_HOST', 'localhost');     // Tu host MySQL
define('DB_NAME', 'lc_advance');    // Nombre BD (por defecto: lc_advance)
define('DB_USER', 'root');          // Usuario MySQL
define('DB_PASS', '');              // Contraseña MySQL (vacía si no hay)
```

### 4️⃣ Iniciar servidor local

**Con XAMPP:** Abre XAMPP Control Panel → Apache + MySQL "Start"

**O usa PHP built-in:**
```bash
php -S localhost:8000 -t .
```

**Abre en navegador:**
- 🏠 Landing: http://localhost/LC-ADVANCE/index.php
- 🗺️ Mapa: http://localhost/LC-ADVANCE/mapa/index.html
- 📊 Dashboard: http://localhost/LC-ADVANCE/dashboard.php (requiere login)

---

## Getting Started

### Crear tu primer usuario

1. Ve a http://localhost/LC-ADVANCE/index.php
2. Click en **"🆕 Crear cuenta"**
3. Llena:
   - 👤 Usuario: `estudiante_prueba`
   - 📧 Correo: `estudiante@example.com`
   - 🔑 Contraseña: Mínimo 6 caracteres (ej: `Test1234`)
4. Click **"Registrar"**
5. Ve a **Login** → Ingresa credenciales

### Tomar una lección y subir en el ranking

1. Haz login
2. Ve a **Dashboard** (automático después de login)
3. Selecciona una materia (Inglés, Matemáticas, etc.)
4. Click en una lección (ej: "PAST SIMPLE DOMINATION 2025")
5. Lee el contenido y click **"🧠 Ir al Quiz"**
6. Responde las preguntas (máximo 10)
7. ¡Recibirás puntos! 🎉

### Ver tu posición en el ranking

- ✅ El **TOP 10** aparece en el lado derecho del Dashboard
- ✅ Tu usuario se destaca en **verde neón** si estás en el top 10
- ✅ Se actualiza cada 15 segundos automáticamente
- ✅ Solo usuarios logueados aparecen en el ranking

### Subir de nivel

- **Cada 500 puntos = 1 Nivel**
- **500 pts** → Nivel 1: Novato (Badge bronze)
- **1000 pts** → Nivel 2: Explorador (Badge silver)
- **2000 pts** → Nivel 3: Élite (Badge gold)

### Verificar progreso en BD

```sql
USE lc_advance;

-- Ver todos los usuarios y sus puntos
SELECT nombre_usuario, puntos, nivel FROM usuarios ORDER BY puntos DESC;

-- Ver progreso de un usuario específico
SELECT u.nombre_usuario, up.slug, up.score, up.completed 
FROM user_progress up 
JOIN usuarios u ON u.id = up.user_id 
WHERE u.nombre_usuario = 'estudiante_prueba';

-- Top 10 ranking
SELECT nombre_usuario, puntos, nivel FROM usuarios ORDER BY puntos DESC LIMIT 10;
```

---

## Estructura del Proyecto

```
LC-ADVANCE/
├── index.php                 # Landing page
├── login.php                 # Formulario login
├── register.php              # Formulario registro
├── dashboard.php             # Panel principal (después de login)
├── leccion_detalle.php       # Vista de lección + quiz
├── guest_login.php           # Acceso como invitado (lectura)
├── update_progress.php       # Endpoint para actualizar puntos
├── logout.php                # Cerrar sesión
│
├── config/
│   ├── config.php            # 🔑 Credenciales BD (EDITAR AQUÍ)
│   └── csrf.php              # Protección CSRF
│
├── src/
│   ├── content.php           # 📚 Array de lecciones ($lecciones)
│   └── funciones.php         # Acciones AJAX (calificar_quiz, etc.)
│
├── assets/
│   ├── css/style.css         # Estilos
│   └── js/app.js             # JavaScript cliente
│
├── mapa/                     # 🗺️ Sistema de combate interactivo
│   ├── index.html
│   ├── updateDB.php          # Endpoint para actualizar maestros
│   ├── sistemC.php
│   └── imagenes/
│
├── db/
│   └── lc_advance.sql        # 🔑 Dump unificado (USAR ESTE)
│
├── scripts/
│   └── seed_test_data.php    # Crear usuario de prueba CI
│
├── tests/
│   ├── test_lessons.php      # Verificar lecciones
│   ├── test_integration.php  # Verificar endpoints
│   ├── test_e2e_simple.php   # E2E básico
│   ├── test_updateDB.php     # Verificar mapa
│   └── run_all_tests.php     # 🧪 Ejecutor de tests
│
└── .github/workflows/
    └── ci.yml                # ✅ Pipeline CI (GitHub Actions)
```

---

## Endpoints & API

**Ver documentación completa en [API.md](API.md)**

**Endpoints principales:**
- `POST /login.php` - Autenticación
- `GET /leccion_detalle.php?slug=...&materia=...` - Ver lección
- `POST /src/funciones.php` - Calificar quiz (accion=calificar_quiz)
- `POST /src/funciones.php` - Obtener estado (accion=obtener_estado)
- `POST /mapa/updateDB.php` - Actualizar maestro del mapa

Ver [API.md](API.md) para ejemplos curl y respuestas JSON detalladas.

---

## Cómo Agregar Lecciones

### 1️⃣ Editar `src/content.php`

Localiza el array `$lecciones` y agrega una nueva entrada:

```php
$lecciones[] = [
    'materia'   => 'Inglés',
    'slug'      => 'mi-primera-leccion',
    'titulo'    => 'Mi Primera Lección',
    'icon'      => '📖',
    'contenido' => <<<'EOT'
<h2>Título de la lección</h2>
<p>Contenido aquí...</p>
<p>Puedes usar HTML normal, <strong>no uses &lt;?php sin escapar</strong></p>
EOT,
    'quiz'      => [
        [
            'pregunta'  => '¿Cuál es la respuesta correcta?',
            'correcta'  => 'La respuesta 1',
            'opciones'  => ['La respuesta 1', 'Opción falsa', 'Otra opción']
        ],
        [
            'pregunta'  => '¿Y esta?',
            'correcta'  => 'Correcto',
            'opciones'  => ['Incorrecto', 'Correcto', 'Muy incorrecto']
        ]
    ]
];
```

### 2️⃣ Estructura de cada lección

| Campo | Tipo | Descripción | Ejemplo |
|-------|------|-------------|---------|
| `materia` | string | Nombre de la materia | `'Inglés'` |
| `slug` | string | ID único (sin espacios) | `'past-simple-2025'` |
| `titulo` | string | Título visible | `'PAST SIMPLE DOMINATION 2025'` |
| `icon` | string | Emoji o HTML | `'📖'` o `'<span class="icon">📖</span>'` |
| `contenido` | string (HTML) | Contenido de la lección | `'<h2>...</h2><p>...</p>'` |
| `quiz` | array | Preguntas del quiz | `[['pregunta'=>'...', ...], ...]` |

### 3️⃣ Estructura de cada pregunta

```php
[
    'pregunta'  => 'Texto de la pregunta',
    'correcta'  => 'Respuesta correcta (texto exacto)',
    'opciones'  => [
        'Opción 1',
        'Opción 2',
        'Opción 3',
        'Opción 4'
    ]
]
```

### 4️⃣ Ejemplo completo

```php
$lecciones[] = [
    'materia'   => 'Matemáticas',
    'slug'      => 'ecuaciones-cuadraticas-2025',
    'titulo'    => 'Ecuaciones Cuadráticas',
    'icon'      => '∑',
    'contenido' => <<<'EOT'
<h2>Ecuaciones Cuadráticas</h2>
<p>Una ecuación cuadrática tiene la forma: <strong>ax² + bx + c = 0</strong></p>
<h3>Fórmula General</h3>
<p>x = (-b ± √(b² - 4ac)) / 2a</p>
<h3>Ejemplo</h3>
<p>Resuelve: x² + 3x + 2 = 0</p>
<p>Respuesta: x = -1 o x = -2</p>
EOT,
    'quiz'      => [
        [
            'pregunta'  => 'Resuelve x² - 5x + 6 = 0',
            'correcta'  => 'x = 2, x = 3',
            'opciones'  => ['x = 2, x = 3', 'x = 1, x = 6', 'x = -2, x = -3']
        ],
        [
            'pregunta'  => '¿Cuál es el discriminante de x² + 4x + 4 = 0?',
            'correcta'  => '0',
            'opciones'  => ['0', '4', '-4', '16']
        ]
    ]
];
```

### 5️⃣ Probar la lección

1. Guarda `src/content.php`
2. Recarga la página (sin caché: Ctrl+Shift+R)
3. Ve a Dashboard → Selecciona "Matemáticas"
4. Tu nueva lección debería aparecer

---

## Testing & CI/CD

### Ejecutar tests localmente

```bash
# Todos los tests
php tests/run_all_tests.php

# Test específico
php tests/test_lessons.php
php tests/test_integration.php
php tests/test_e2e_simple.php
```

**Salida esperada:**
```
Running: tests/test_lessons.php
OK: targeted lesson checks passed
PASS: tests/test_lessons.php
---
Running: tests/test_integration.php
OK: integration endpoint tests passed
PASS: tests/test_integration.php
---
ALL TESTS PASSED
```

### CI/CD con GitHub Actions

Cada push a `main` o PR ejecuta automáticamente:
- ✅ PHP 8.1 y 8.2
- ✅ Importa BD (`sql/lc_advance.sql`)
- ✅ Ejecuta suite de tests
- ✅ Reporta resultados

Ver estado en: https://github.com/cervanlfc7/LC-ADVANCE/actions

---

## Troubleshooting

**Ver soluciones detalladas en [TROUBLESHOOTING.md](TROUBLESHOOTING.md)**

**Problemas comunes rápidos:**

| Problema | Solución |
|----------|----------|
| Error BD | Verifica `config/config.php` y que MySQL está activo |
| "Tabla no existe" | Ejecuta: `mysql -u root -p < db/lc_advance.sql` |
| Parse error en PHP | Ejecuta: `php -l src/content.php` |
| Login no funciona | Verifica `session_start()` en el top de los archivos |
| Puntos no se actualizan | Verifica respuesta del endpoint con curl |

Ver [TROUBLESHOOTING.md](TROUBLESHOOTING.md) para soluciones completas.

## 🚀 Despliegue a Producción

1. Ejecuta tests: `php tests/run_all_tests.php`
2. Haz backup: `mysqldump -u root -p lc_advance > backup.sql`
3. Actualiza `config/config.php` con credenciales de producción
4. Habilita HTTPS
5. Asegura permisos: `chmod 600 config/config.php`

Ver [DEVELOPMENT.md](DEVELOPMENT.md) para más detalles de arquitectura y deployment.

---

## � Documentación Completa

| Documento | Para Qué |
|-----------|----------|
| **README.md** (este archivo) | Instalación, instalación y uso básico |
| **[DEVELOPMENT.md](DEVELOPMENT.md)** | Arquitectura, cómo agregar funcionalidades |
| **[API.md](API.md)** | Endpoints, ejemplos curl, respuestas JSON |
| **[QUICK_REFERENCE.md](QUICK_REFERENCE.md)** | Cheat sheet y comandos rápidos |
| **[TROUBLESHOOTING.md](TROUBLESHOOTING.md)** | Soluciones a problemas comunes |

---

## �📞 Soporte

- 🐛 Reporta bugs en Issues: https://github.com/cervanlfc7/LC-ADVANCE/issues
- 💡 Solicita features en Discussions: https://github.com/cervanlfc7/LC-ADVANCE/discussions
- 📧 Contacta al equipo: lcadvance40@gmail.com

---

**¡Gracias por usar LC-ADVANCE!** 🎓✨