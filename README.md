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
c:\xampp\mysql\bin\mysql.exe -u root -p < sql\lc_advance.sql

# macOS/Linux
mysql -u root -p < sql/lc_advance.sql
```

**Nota:** El archivo `sql/lc_advance.sql` incluye automáticamente:
- Tabla `usuarios` (login y progreso)
- Tabla `user_progress` (puntos y lecciones completadas)
- Tabla `lecciones_completadas` (tracking)
- Tabla `badges` (logros)
- Tabla `preguntas` (banco de preguntas del sistema de combate)
- Tabla `dialogosmapa` (diálogos del mapa)
- Tabla `maestroact` (maestros actuales en mapa)

#### Opción B: Importar esquemas por separado

```bash
# Base de datos principal
mysql -u root -p < sql/schema.sql

# Sistema de combate (opcional)
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
├── sql/
│   ├── lc_advance.sql        # 🔑 Dump unificado (USAR ESTE)
│   ├── schema.sql            # Schema básico (alternativa)
│   └── Sistema-combate/      # Dumps adicionales (opcional)
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
# 4. Habilita HTTPS
# 5. Configura variables de entorno para DB_HOST, DB_USER, DB_PASS
# 6. Cambia DEBUG_MODE a false en config/config.php
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
- 📧 Contacta al equipo: (agregar contacto)

---

**¡Gracias por usar LC-ADVANCE!** 🎓✨

Estructura principal
--------------------
- [dashboard.php](dashboard.php) — Panel principal del usuario.
- [index.php](index.php) — Landing / acceso rápido al dashboard.
- [leccion_detalle.php](leccion_detalle.php) — Vista y UI del quiz / lección.
- [update_progress.php](update_progress.php) — Endpoint para actualizar puntos/progreso.
- [src/content.php](src/content.php) — Contenido: array principal de lecciones (`$lecciones`) y quizzes.
  - Símbolo clave: [`$lecciones`](src/content.php)
- [src/funciones.php](src/funciones.php) — Acciones AJAX y utilidades (ej. acción `calificar_quiz`, `completar`, `obtener_estado`).
  - Símbolos clave: [`calificar_quiz`](src/funciones.php), [`completar`](src/funciones.php)
- [assets/js/app.js](assets/js/app.js) — JS cliente, listeners (p. ej. `.btn-completar`).
  - Selector importante: [`.btn-completar`](assets/js/app.js)
- [assets/css/style.css](assets/css/style.css) — Estilos del proyecto.
- [sql/schema.sql](sql/schema.sql) — DDL y datos de ejemplo (tablas `usuarios`, `user_progress`, `lecciones_completadas`, `badges`).
  - Tabla de progreso: [`user_progress`](sql/schema.sql)

Requisitos
---------
- PHP 7.4+ (o 8.x)
- MySQL / MariaDB
- Servidor local (XAMPP / WAMP / Laragon)
- Extensiones PDO (pdo_mysql)

Instalación rápida
------------------
1. Copia el proyecto dentro de la carpeta pública de tu servidor (ej.: `c:\xampp\htdocs\LC-ADVANCE`).

2. Importación de bases de datos (detallado) 🔧

   Requisitos: MySQL / MariaDB en ejecución y un usuario con permisos para crear/crear tablas.

   - Importar esquema principal (crea DB `cbtis168_study_game` y tablas principales):

     - Desde línea de comandos (Windows con XAMPP):
       ```
       c:\xampp\mysql\bin\mysql.exe -u root -p < sql\schema.sql
       ```
     - O (si `mysql` está en PATH):
       ```
       mysql -u root -p < sql/schema.sql
       ```

   - Crear la base de datos del mapa/diálogos (`dialogos`) e importar tablas necesarias:

     - Crear DB (si no existe):
       ```
       mysql -u root -p -e "CREATE DATABASE dialogos CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;"
       ```

     - Importar los dumps del mapa/combate (orden recomendado):
       ```
       mysql -u root -p dialogos < sql/Sistema-combate/dialogosmapa.sql
       mysql -u root -p dialogos < sql/Sistema-combate/dilogoscombate.sql
       mysql -u root -p dialogos < sql/Sistema-combate/idsmaestros.sql
       mysql -u root -p dialogos < sql/Sistema-combate/imgcombate.sql
       mysql -u root -p dialogos < sql/Sistema-combate/preguntas.sql
       mysql -u root -p dialogos < sql/Sistema-combate/preguntas-maestrp_nuevo.sql
       ```

     - Nota: algunos dumps pueden no contener la instrucción `CREATE DATABASE` ni `USE`; por eso es importante importar seleccionando la BD `dialogos` o ejecutando los comandos anteriores.

     - Si prefieres phpMyAdmin: crea la BD `dialogos`, selecciónala y usa la opción "Importar" para cargar cada archivo SQL (asegúrate de seleccionar la BD destino antes de importar).

   - Duplicados: hay copias de estos archivos en `Examen/Base de datos/`. Usa preferentemente los archivos en `sql/Sistema-combate/`.

   - Si quieres usar otro nombre de BD: actualiza `config/config.php` (DB_NAME) y, si corresponde, la conexión en `mapa/updateDB.php`.

> Nota: en esta rama se ha unificado la BD en `lc_advance` y `mapa/updateDB.php` ya apunta a `lc_advance` (antes usaba `dialogos`).

**Unificación a `lc_advance` (nuevo):**

Si prefieres un único dump que contenga el esquema principal y los diálogos/preguntas, hay un archivo unificado:

- Importar el dump unificado (contiene `CREATE DATABASE lc_advance`):
  ```
  c:\xampp\mysql\bin\mysql.exe -u root -p < sql\lc_advance.sql
  ```
- **Seed para CI / pruebas:** hemos añadido `scripts/seed_test_data.php` que crea un usuario de prueba (`ci_test_user` / `ci_test@example.com` con contraseña `Test1234`) si no existe. Esto es invocado por el workflow de CI justo después de importar `sql/lc_advance.sql`.

- Tras importar, ajusta `config/config.php` para usar `DB_NAME = 'lc_advance'` (ya está preconfigurado en este repositorio).

- Verifica rápida la importación:
  ```sql
  USE lc_advance; SHOW TABLES; SELECT COUNT(*) FROM preguntas; SELECT COUNT(*) FROM dilogoscombate;
  ```



3. Configura conexión DB en [config/config.php](config/config.php) (DB_HOST, DB_NAME, DB_USER, DB_PASS).

4. Inicia Apache + MySQL (XAMPP) y abre:
   - Modo mapa: http://localhost/LC-ADVANCE/mapa/index.html
   - Landing: http://localhost/LC-ADVANCE/index.php

Verificación rápida ✅
- En consola mysql:
  ```sql
  USE cbtis168_study_game; SHOW TABLES; SELECT COUNT(*) FROM usuarios;
  USE dialogos; SHOW TABLES; SELECT COUNT(*) FROM dialogosmapa;
  ```

Tablas faltantes / errores comunes ⚠️
- Si recibes el error "Table 'dialogos.maestroact' doesn't exist": crea la tabla manualmente (ejemplo):
  ```sql
  CREATE TABLE maestroact (
    id INT AUTO_INCREMENT PRIMARY KEY,
    IDPersonajeC VARCHAR(100) NOT NULL,
    Maestro_Actual VARCHAR(255) NOT NULL,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
  );
  ```

  Nota: en esta rama hemos añadido una comprobación en `mapa/updateDB.php` que crea la tabla `maestroact` si no existe, para evitar este error en instalaciones nuevas o incompletas.

- Integración CI: se añadió un workflow de GitHub Actions en `/.github/workflows/ci.yml` que levanta una DB MySQL, importa `sql/lc_advance.sql` si está presente, arranca un servidor PHP y ejecuta la suite de tests (incluye verificación de contenido y un test E2E que realiza registro/login automático si la ruta requiere autenticación). Puedes anular la URL de pruebas con la variable de entorno `TEST_BASE_URL` si el servidor está en otra ruta.

- Si aparece "Access denied" o problemas de credenciales:
  ```sql
  CREATE USER 'lcuser'@'localhost' IDENTIFIED BY 'tu_pass';
  GRANT ALL PRIVILEGES ON cbtis168_study_game.* TO 'lcuser'@'localhost';
  GRANT ALL PRIVILEGES ON dialogos.* TO 'lcuser'@'localhost';
  FLUSH PRIVILEGES;
  ```

Consejos de debugging
---------------------
- Comprueba que `config/config.php` tiene los datos correctos.
- Si `mapa/updateDB.php` no inserta nada, asegúrate de que la BD `dialogos` existe y que el usuario usado en `mysqli` tiene permisos, o modifica la conexión con tus credenciales.
- Verifica que las tablas están en `InnoDB` y con `utf8mb4` para evitar errores de claves foráneas o codificación.
- Revisa logs Apache/PHP (`php_error_log`, `xampp\apache\logs\error.log`) y la consola del navegador para errores de red al cargar `Mapa.json` / tilesets.


Configuración importante
-----------------------
- [config/config.php](config/config.php): define `$pdo` (PDO) y credenciales DB.
- Asegurar que session_start() funciona (revisar permisos y headers).
- Revisa las rutas relativas en `leccion_detalle.php`, `dashboard.php` y `assets/`.

Cómo funciona el progreso y puntaje
----------------------------------
- Los quizzes están en [`src/content.php`](src/content.php) dentro de `$lecciones`.
- Al completar un quiz se envía petición a:
  - [`src/funciones.php`](src/funciones.php) (acción `calificar_quiz`) o
  - [`update_progress.php`](update_progress.php) (según implementación).
- Se registra en la tabla [`user_progress`](sql/schema.sql) y se actualiza `usuarios.puntos`.
- Si no se registran puntos:
  - Verifica que la sesión (`$_SESSION['usuario_id']`) exista.
  - Revisa las consultas SQL en [`src/funciones.php`](src/funciones.php) y en [update_progress.php](update_progress.php).
  - Confirma que la tabla [`user_progress`](sql/schema.sql) tiene columnas `user_id, slug, score, lesson_xp, completed`.

Agregar o editar lecciones
-------------------------
- Edita o añade entradas al array `$lecciones` en [src/content.php](src/content.php).
- Cada lección necesita al menos:
  - 'materia', 'slug', 'titulo', 'contenido', 'quiz' (array de preguntas).
- Después de cambiar `$lecciones`, refresca/limpia caches del servidor.

Front-end relevante
-------------------
- Interacciones principales en [assets/js/app.js](assets/js/app.js) (listeners de botones, fetch a `src/funciones.php`).
- UI del quiz y control (preguntas, botones de opción, botón "Siguiente") en [leccion_detalle.php](leccion_detalle.php).
- Estilos en [assets/css/style.css](assets/css/style.css).

Errores comunes y troubleshooting
--------------------------------
- "Error desconocido del servidor." al guardar:
  - Revisa logs PHP / Apache (error_log).  
  - Habilita temporalmente `error_log` y `error_reporting(E_ALL)` en [config/config.php](config/config.php).
  - Asegura que `$usuario_id` / sesión esté presente antes de ejecutar queries.
- Puntos no suman / lecciones no marcadas como completadas:
  - Verificar `UPDATE usuarios SET puntos = puntos + ?` fue ejecutado.
  - Verificar `INSERT/UPDATE user_progress` y el flag `completed = 1`.
  - Revisa permisos del usuario DB y transacciones (commit/rollback).
- Botones del quiz no responden:
  - Confirma que [assets/js/app.js](assets/js/app.js) está incluido en la página y que no hay errores JS en consola.
  - Comprueba que los selectores (clases/IDs) coinciden con HTML en [leccion_detalle.php](leccion_detalle.php).

Endpoints y acciones AJAX
-------------------------
- [`src/funciones.php`](src/funciones.php) soporta acciones POST:
  - `accion=completar` — marcar lección como completada (llamado desde [assets/js/app.js](assets/js/app.js)).
  - `accion=calificar_quiz` — califica y guarda resultados del quiz.
  - `accion=obtener_estado` — devuelve puntos/progreso/ranking para actualizar dashboard.
- También está disponible [update_progress.php](update_progress.php) para updates directos.

Buenas prácticas / notas de desarrollo
-------------------------------------
- Mantener `$lecciones` en [src/content.php](src/content.php) ordenado y con `slug` único.
- Usar transacciones PDO para operaciones que afecten varias tablas.
- Sanitizar/validar input en server-side (evitar confiar solo en JS).
- Mantener copias de seguridad de la DB antes de importar `sql/schema.sql`.

Contribuir
----------
- Añadir nuevas lecciones en [src/content.php](src/content.php).
- Añadir estilos en [assets/css/style.css](assets/css/style.css).
- Añadir utilidades en [src/funciones.php](src/funciones.php) respetando sesiones y seguridad CSRF (revisar [csrf.php](config/csrf.php) si existe).

Referencias rápidas
------------------
- Contenido principal: [`src/content.php`](src/content.php) — array `$lecciones`
- Lógica servidor para quizzes / progreso: [`src/funciones.php`](src/funciones.php)
- Endpoint de guardado: [`update_progress.php`](update_progress.php)
- Dashboard: [`dashboard.php`](dashboard.php)
- Vista lección/quiz: [`leccion_detalle.php`](leccion_detalle.php)
- Scripts cliente: [`assets/js/app.js`](assets/js/app.js)
- Estilos: [`assets/css/style.css`](assets/css/style.css)
- Esquema DB: [`sql/schema.sql`](sql/schema.sql)

Novedades
---------
- Acceso invitado: ahora puedes entrar como invitado desde la landing (botón "Entrar como invitado"). 
  - Modo invitado: lectura y pruebas locales permitidas; NO se guarda progreso ni puntos.
  - Archivos relevantes: [guest_login.php](guest_login.php), [src/funciones.php](src/funciones.php), [leccion_detalle.php](leccion_detalle.php).

---

## Checklist de lanzamiento (rápido) ✅

- [ ] Confirmar que `sql/lc_advance.sql` está actualizado y probado localmente (importar y verificar tablas y conteos).  
- [ ] Ejecutar `php scripts/seed_test_data.php` si deseas un usuario de prueba (`ci_test_user`).  
- [ ] Ejecutar tests locales:
  - php tests/run_all_tests.php  
- [ ] Subir rama con cambios y abrir PR; verificar que GitHub Actions pase (workflow `CI`).  
- [ ] Hacer una prueba manual rápida: crear usuario, tomar un quiz, confirmar `user_progress` y `usuarios.puntos`.  
- [ ] Mergear y cerrar versión.

Si quieres, puedo preparar la PR y los pasos finales (branch + PR + descripción) y dejar todo listo para merge.
