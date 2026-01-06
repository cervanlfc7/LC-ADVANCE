# LC-ADVANCE

[![CI](https://github.com/cervanlfc7/LC-ADVANCE/actions/workflows/ci.yml/badge.svg)](https://github.com/cervanlfc7/LC-ADVANCE/actions/workflows/ci.yml)

**Plataforma educativa interactiva** con lecciones, quizzes adaptativos, sistema de puntos, badges, ranking en tiempo real y mapa de combate interactivo.

---

## 📋 Tabla de Contenidos

### 📚 Documentación Principal

1. **Este archivo (README.md)** - Guía general, instalación y uso
2. **[DEVELOPMENT.md](DEVELOPMENT.md)** - 🔧 Guía de desarrollo para programadores
3. **[API.md](API.md)** - 📡 Documentación completa de endpoints
4. **[QUICK_REFERENCE.md](QUICK_REFERENCE.md)** - ⚡ Cheat sheet para tareas comunes
5. **[TROUBLESHOOTING.md](TROUBLESHOOTING.md)** - 🔍 Soluciones a problemas comunes

### En este archivo

1. [Requisitos](#requisitos)
2. [Instalación rápida](#instalación-rápida)
3. [Getting Started (Primeros pasos)](#getting-started)
4. [Características Principales](#características-principales)
5. [Estructura del proyecto](#estructura-del-proyecto)
6. [Guía de API & Endpoints](#guía-de-api--endpoints)
7. [Cómo agregar lecciones](#cómo-agregar-lecciones)
8. [Testing & CI/CD](#testing--cicd)
9. [Troubleshooting](#troubleshooting)

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

#### Opción B: Importar esquemas por separado (antiguo)

> ℹ️ **Nota:** Esta opción es para compatibilidad con versiones antiguas. Se recomienda usar la **Opción A**.

```bash
# Base de datos principal (deprecado)
mysql -u root -p < sql/schema.sql

# Sistema de combate (deprecado)
mysql -u root -p -e "CREATE DATABASE dialogos;"
mysql -u root -p dialogos < sql/Sistema-combate/dialogosmapa.sql
mysql -u root -p dialogos < sql/Sistema-combate/preguntas.sql
```

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
├── sql/
│   ├── schema.sql            # Schema básico (deprecado)
│   └── Sistema-combate/      # Dumps adicionales (deprecado)
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

## Guía de API & Endpoints

### 🔐 Autenticación

#### Login
```bash
curl -X POST http://localhost/LC-ADVANCE/login.php \
  -d "nombre_usuario=estudiante_prueba&contrasena=Test1234"
```

#### Logout
```bash
curl -X GET http://localhost/LC-ADVANCE/logout.php
```

---

### 📚 Lecciones

#### Ver lección específica
```bash
# Parámetros GET
# slug: identificador único de la lección
# materia: nombre de la materia

curl "http://localhost/LC-ADVANCE/leccion_detalle.php?slug=b1-past-simple-2025&materia=Inglés"
```

**Lecciones disponibles (algunos ejemplos):**
- `b1-past-simple-2025` → Inglés
- `a2-food-restaurant-shopping-cyberpunk` → Inglés
- `derivadas-basicas-pendientes-dominio` → Matemáticas

---

### 🧠 Quizzes & Progreso

#### Calificar un quiz
```bash
curl -X POST http://localhost/LC-ADVANCE/src/funciones.php \
  -H "Content-Type: application/x-www-form-urlencoded" \
  -d "accion=calificar_quiz&slug=b1-past-simple-2025&q0=answer1&q1=answer2&q2=answer3..."
```

**Respuesta (JSON):**
```json
{
  "ok": true,
  "score": 8,
  "xp_ganado": 80,
  "new_puntos": 580,
  "new_nivel": 2,
  "details": [
    {"pregunta": "...", "correcta": "...", "respuesta": "...", "acertada": true}
  ]
}
```

#### Obtener estado del usuario (con ranking)
```bash
curl -X POST http://localhost/LC-ADVANCE/src/funciones.php \
  -d "accion=obtener_estado"
```

**Respuesta (JSON):**
```json
{
  "ok": true,
  "puntos": 580,
  "nivel": 2,
  "progreso": 30,
  "badges": [
    {"nombre": "Nivel 1: Novato", "tipo": "bronze"}
  ],
  "ranking": [
    {"nombre_usuario": "usuario1", "puntos": 1500, "es_actual": false},
    {"nombre_usuario": "estudiante_prueba", "puntos": 580, "es_actual": true}
  ]
}
```

#### Actualizar progreso
```bash
curl -X POST http://localhost/LC-ADVANCE/update_progress.php \
  -d "slug=b1-past-simple-2025&correctas=8&xp=80"
```

---

### 🗺️ Mapa / Sistema de Combate

#### Actualizar maestro actual
```bash
curl -X POST http://localhost/LC-ADVANCE/mapa/updateDB.php \
  -H "Content-Type: application/json" \
  -d '{"maestro":"Miguel","materia":"Inglés"}'
```

**Respuesta:**
```json
{
  "success": true,
  "message": "Registro insertado",
  "maestro": "Miguel",
  "materia": "Inglés"
}
```

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

### ❌ "Error de conexión a BD"

**Solución:**
```bash
# Verifica que MySQL está activo
# XAMPP: abre Control Panel y haz click "Start" en MySQL

# Verifica credenciales en config/config.php
cat config/config.php | grep DB_

# Prueba conexión:
mysql -h localhost -u root -p
# Ingresa contraseña (vacía si no hay) y presiona Enter
```

### ❌ "Tabla 'lc_advance.usuarios' no existe"

**Solución:**
```bash
# Re-importa la BD
mysql -u root -p < sql/lc_advance.sql

# Verifica que se importó correctamente
mysql -u root -p
> USE lc_advance;
> SHOW TABLES;
> SELECT COUNT(*) FROM usuarios;
```

### ❌ "Parse error en src/content.php"

**Solución:**
```bash
# Verifica sintaxis
php -l src/content.php

# Si hay error, busca caracteres problemáticos:
# - Asegúrate de usar <<<'EOT' (no <<<EOT)
# - No escapes <?php dentro de los heredocs
# - Cierra cada EOT; en nueva línea
```

### ❌ "Login no funciona"

**Solución:**
```bash
# Verifica que las sesiones están habilitadas
# En config/config.php, busca session_start()
# Debe estar en el top del archivo

# Verifica tabla usuarios
mysql -u root -p
> USE lc_advance;
> SELECT id, nombre_usuario, correo FROM usuarios;
```

### ❌ "Los puntos no se actualizan"

**Solución:**
```bash
# 1. Verifica que el usuario tiene sesión activa
# 2. Revisa la respuesta del endpoint
curl -X POST http://localhost/LC-ADVANCE/src/funciones.php \
  -d "accion=obtener_estado"

# 3. Mira los logs de PHP
# XAMPP: C:\xampp\php\logs\php_error_log

# 4. Verifica tabla user_progress
mysql -u root -p
> USE lc_advance;
> SELECT * FROM user_progress;
```

### ❌ "Mapa no carga / error "maestroact not found"

**Solución:**
```bash
# mapa/updateDB.php ya crea la tabla si no existe
# Pero puedes crearla manualmente:

mysql -u root -p
> USE lc_advance;
> CREATE TABLE IF NOT EXISTS maestroact (
>   id INT AUTO_INCREMENT PRIMARY KEY,
>   IDPersonajeC VARCHAR(100) NOT NULL,
>   Maestro_Actual VARCHAR(255) NOT NULL,
>   updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
> );
```

---

## 🚀 Despliegue a Producción

### Antes de publicar:

```bash
# 1. Verifica tests pasan
php tests/run_all_tests.php

# 2. Haz backup de BD
mysqldump -u root -p lc_advance > backup_lc_advance.sql

# 3. Actualiza config/config.php con credenciales de producción
define('DB_HOST', 'prod-server.com');
define('DB_USER', 'prod_user');
define('DB_PASS', 'secure_password');

# 4. Habilita HTTPS en tu servidor web
# 5. Asegura que las credenciales estén en variables de entorno (.env)
# 6. Configura permisos de archivos (config.php debe ser 600)
chmod 600 config/config.php
```

### Con Docker (opcional):

```bash
# Crea un Dockerfile en la raíz del proyecto:
FROM php:8.2-apache
RUN docker-php-ext-install pdo_mysql
COPY . /var/www/html/
EXPOSE 80
CMD ["apache2-foreground"]

# Construir y correr:
docker build -t lc-advance .
docker run -p 80:80 -e DB_HOST=mysql lc-advance
```

---

## 📞 Soporte

- 🐛 Reporta bugs en Issues: https://github.com/cervanlfc7/LC-ADVANCE/issues
- 💡 Solicita features en Discussions: https://github.com/cervanlfc7/LC-ADVANCE/discussions
- 📧 Contacta al equipo: lcadvance40@gmail.com

---

**¡Gracias por usar LC-ADVANCE!** 🎓✨