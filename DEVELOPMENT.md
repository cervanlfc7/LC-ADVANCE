# 🔧 Guía de Desarrollo

Documentación técnica para desarrolladores que quieran modificar, extender o mantener LC-ADVANCE.

---

## 📚 Tabla de Contenidos

1. [Stack tecnológico](#stack-tecnológico)
2. [Ciclo de desarrollo](#ciclo-de-desarrollo)
3. [Estructura de código](#estructura-de-código)
4. [Cómo funciona cada módulo](#cómo-funciona-cada-módulo)
5. [Guía paso a paso](#guía-paso-a-paso)
6. [Testing](#testing)
7. [Performance](#performance)
8. [Seguridad](#seguridad)

---

## Stack Tecnológico

| Capa | Tecnología | Versión |
|------|-----------|---------|
| **Backend** | PHP | 8.1+ |
| **Base de datos** | MySQL/MariaDB | 5.7+ |
| **Servidor web** | Apache/PHP built-in | - |
| **Frontend** | HTML5 + CSS + Vanilla JS | ES6+ |
| **CI/CD** | GitHub Actions | - |
| **Testing** | PHP custom runner | - |

---

## Ciclo de Desarrollo

### 1. Rama de desarrollo

```bash
# Clonar repo
git clone https://github.com/cervanlfc7/LC-ADVANCE.git
cd LC-ADVANCE

# Crear rama para feature
git checkout -b feature/mi-nueva-funcion
```

### 2. Hacer cambios

```bash
# Editar archivos
# Probar localmente
php -l src/content.php  # Verificar sintaxis
php tests/run_all_tests.php  # Ejecutar tests
```

### 3. Commit y push

```bash
git add .
git commit -m "feat: agregar nueva lección de trigonometría"
git push origin feature/mi-nueva-funcion
```

### 4. Pull request

- Ve a GitHub → New Pull Request
- Selecciona `feature/mi-nueva-funcion` → `main`
- Completa descripción
- GitHub Actions ejecutará tests automáticamente

### 5. Merge

Una vez aprobado:
```bash
git checkout main
git pull origin main
```

---

## Estructura de Código

### `config/config.php` - Configuración global

```php
<?php
// Credenciales BD (override por env vars)
define('DB_HOST', getenv('DB_HOST') ?: 'localhost');
define('DB_NAME', getenv('DB_NAME') ?: 'lc_advance');
define('DB_USER', getenv('DB_USER') ?: 'root');
define('DB_PASS', getenv('DB_PASS') ?: '');

// Inicializar sesión
session_start();

// Conectar a BD
try {
    $pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4",
        DB_USER,
        DB_PASS,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>
```

**Casos de uso:**
- Importado por TODOS los archivos PHP
- Define conexión PDO para BD
- Inicia sesión del usuario

---

### `src/content.php` - Base de datos de lecciones

Estructura de 4000+ líneas con array `$lecciones`:

```php
$lecciones[] = [
    'materia'   => 'Inglés',
    'slug'      => 'b1-past-simple-2025',
    'titulo'    => 'PAST SIMPLE DOMINATION 2025',
    'icon'      => '📖',
    'contenido' => <<<'EOT'
<h2>Contenido HTML aquí</h2>
<p>Sin &lt;?php sin escapar</p>
EOT,
    'quiz'      => [
        ['pregunta' => '...', 'correcta' => '...', 'opciones' => [...]],
        // Máx 10 preguntas por lección
    ]
];
```

**Importante:**
- NUNCA uses `<?php` sin escapar → `&lt;?php`
- Usa heredoc `<<<'EOT' ... EOT;` para HTML
- Cada `slug` debe ser ÚNICO
- Las opciones se mezclan automáticamente al cargar

---

### `src/funciones.php` - Endpoints AJAX

Acciones disponibles vía POST:

#### `calificar_quiz`
```php
// Request
POST /src/funciones.php
accion=calificar_quiz
slug=b1-past-simple-2025
q0=answer1&q1=answer2...

// Response (JSON)
{
  "ok": true,
  "score": 8,
  "xp_ganado": 80,
  "new_puntos": 580,
  "details": [...]
}

// Lógica:
// 1. Valida que usuario esté autenticado
// 2. Obtiene lección de $lecciones
// 3. Compara respuestas con claves correctas
// 4. Calcula puntos (score * 10)
// 5. Actualiza BD: user_progress + usuarios.puntos
// 6. Verifica badges completados
```

#### `obtener_estado`
```php
// Devuelve puntos, nivel, badges, ranking del usuario actual
// Usado por dashboard para actualizar UI

// Response
{
  "ok": true,
  "puntos": 580,
  "nivel": 2,
  "progreso": 30,
  "badges": [{"nombre": "Nivel 1", "tipo": "bronze"}],
  "ranking": [...]
}
```

#### `completar`
```php
// Marca una lección como completada (alternativa a calificar_quiz)
// Usado por modo invitado
```

---

### `leccion_detalle.php` - Vista de lección

Renderiza la lección + quiz en HTML:

```php
<?php
include 'config/config.php';
include 'src/content.php';

// GET params
$slug   = $_GET['slug'] ?? null;
$materia = $_GET['materia'] ?? null;

// Busca lección en $lecciones
$leccion = null;
foreach ($lecciones as $l) {
    if ($l['slug'] === $slug) {
        $leccion = $l;
        break;
    }
}

// Renderiza HTML + quiz
?>
<div class="contenido">
    <?php echo $leccion['contenido']; ?>
</div>
<div class="quiz">
    <!-- Quiz JS rendering aquí -->
</div>
```

---

### `assets/js/app.js` - Lógica del cliente

Listeners principales:

```javascript
// 1. Clic "Ir al quiz"
document.querySelector('.btn-ir-quiz').addEventListener('click', () => {
    // Scroll a sección de quiz
    document.querySelector('.quiz').scrollIntoView();
});

// 2. Clic respuesta multiple choice
document.querySelectorAll('.opcion').forEach(opcion => {
    opcion.addEventListener('click', (e) => {
        // Marca como seleccionada
        e.target.classList.add('selected');
    });
});

// 3. Clic "Siguiente" o "Terminar"
document.querySelector('.btn-siguiente').addEventListener('click', () => {
    const respuestas = recolectarRespuestas();
    enviarQuiz(respuestas);
});

// 4. Enviar quiz al servidor
function enviarQuiz(respuestas) {
    const slug = new URLSearchParams(location.search).get('slug');
    
    fetch('/src/funciones.php', {
        method: 'POST',
        body: new URLSearchParams({
            accion: 'calificar_quiz',
            slug: slug,
            ...respuestas
        })
    })
    .then(r => r.json())
    .then(data => {
        if (data.ok) {
            alert(`¡Conseguiste ${data.score} puntos!`);
            location.reload();
        }
    });
}
```

---

### Base de Datos - Schema

#### Tabla `usuarios`
```sql
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_usuario VARCHAR(100) UNIQUE NOT NULL,
    correo VARCHAR(100) UNIQUE NOT NULL,
    contrasena_hash VARCHAR(255) NOT NULL,
    puntos INT DEFAULT 0,
    nivel INT DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

#### Tabla `user_progress`
```sql
CREATE TABLE user_progress (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    slug VARCHAR(255) NOT NULL,
    score INT DEFAULT 0,
    lesson_xp INT DEFAULT 0,
    completed BOOLEAN DEFAULT FALSE,
    completed_at TIMESTAMP NULL,
    FOREIGN KEY (user_id) REFERENCES usuarios(id),
    UNIQUE KEY user_lesson (user_id, slug)
);
```

---

## Cómo Funciona Cada Módulo

### 1. Flujo de Login

```
usuario.php → llenar form (usuario + contraseña)
    ↓
login.php POST
    ↓
config.php (sesión)
    ↓
validar en BD: SELECT * FROM usuarios WHERE nombre_usuario = ?
    ↓
password_verify() → OK?
    ↓
$_SESSION['usuario_id'] = $id
    ↓
Redirect a dashboard.php
```

### 2. Flujo de Quiz

```
leccion_detalle.php (GET slug, materia)
    ↓
Busca en $lecciones[slug]
    ↓
Renderiza HTML + JS
    ↓
Usuario responde preguntas
    ↓
JS: Envía respuestas a src/funciones.php (POST)
    ↓
funciones.php: calificar_quiz()
    ├─ Obtiene lección de $lecciones
    ├─ Compara respuestas
    ├─ Calcula score
    ├─ INSERT INTO user_progress
    └─ UPDATE usuarios SET puntos = puntos + score
    ↓
Devuelve JSON con resultado
    ↓
JS: Muestra "¡Ganaste X puntos!" + reload
```

### 3. Flujo de Dashboard

```
dashboard.php
    ↓
Session check: $_SESSION['usuario_id']?
    ↓
SELECT usuarios.* WHERE id = session_user_id
    ↓
SELECT user_progress WHERE user_id = session_user_id
    ↓
Renderiza:
├─ Puntos actuales
├─ Nivel
├─ Lista de lecciones completadas
├─ Badges
└─ Top 10 ranking global
```

---

## Guía Paso a Paso

### Agregar nueva funcionalidad

#### Ejemplo: "Boton para descargar certificado"

**1. Backend (PHP)**

En `src/funciones.php`:
```php
case 'descargar_certificado':
    if (!isset($_SESSION['usuario_id'])) {
        echo json_encode(['ok' => false, 'error' => 'No autenticado']);
        exit;
    }
    
    $sql = "SELECT nombre_usuario, puntos FROM usuarios WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$_SESSION['usuario_id']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // Generar PDF o download
    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename="certificado.pdf"');
    // ... lógica PDF (usar TCPDF o similar)
    
    break;
```

**2. Frontend (JS)**

En `assets/js/app.js`:
```javascript
document.querySelector('.btn-certificado').addEventListener('click', () => {
    fetch('/src/funciones.php', {
        method: 'POST',
        body: new URLSearchParams({ accion: 'descargar_certificado' })
    })
    .then(r => r.blob())
    .then(blob => {
        const url = window.URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = 'certificado.pdf';
        a.click();
    });
});
```

**3. HTML**

En `dashboard.php`:
```html
<button class="btn-certificado">📄 Descargar Certificado</button>
```

**4. Test (opcional)**

En `tests/test_certificado.php`:
```php
$response = curl('POST', '/src/funciones.php', [
    'accion' => 'descargar_certificado'
]);
assert($response['status'] === 200, 'Certificado generado');
```

---

## Testing

### Tests disponibles

```bash
# Todos
php tests/run_all_tests.php

# Individual
php tests/test_lessons.php       # Verifica lecciones cargan sin errores
php tests/test_integration.php   # Verifica endpoints funcionan
php tests/test_updateDB.php      # Verifica mapa/updateDB.php
php tests/test_e2e_simple.php    # E2E básico (load + no fatal errors)
```

### Escribir un test nuevo

```php
<?php
// tests/test_mi_feature.php

$base_url = getenv('TEST_BASE_URL') ?: 'http://127.0.0.1:8000';

echo "Running: tests/test_mi_feature.php\n";

// Test 1: Verifica que endpoint existe
$response = curl('GET', "$base_url/index.php");
if ($response['status'] !== 200) {
    echo "FAIL: index.php no accesible\n";
    exit(1);
}

// Test 2: Verifica que quiz carga
$response = curl('GET', "$base_url/leccion_detalle.php?slug=b1-past-simple-2025&materia=Inglés");
if (strpos($response['body'], 'PHP Fatal') !== false) {
    echo "FAIL: quiz tiene fatal error\n";
    exit(1);
}

echo "PASS: tests/test_mi_feature.php\n";
?>
```

Ejecutar:
```bash
php tests/test_mi_feature.php
```

---

## Performance

### Optimizaciones implementadas

1. **Heredoc strings** - Evita parsing de PHP en contenido
2. **Placeholder injection** - HTML dinámico sin eval()
3. **Session reuse** - Una conexión PDO por request
4. **Query caching** - Resultados cacheados en variables

### Mejoras futuras

```php
// Agregar Redis para caché de lecciones
$cache_key = "leccion:{$slug}";
$cached = $redis->get($cache_key);
if ($cached) {
    return json_decode($cached);
}

// Lazy load de lecciones (cargar solo las activas)
$lecciones = array_filter($lecciones, fn($l) => $l['activa'] ?? true);

// Índices BD
ALTER TABLE user_progress ADD INDEX (user_id);
ALTER TABLE user_progress ADD INDEX (slug);
```

---

## Seguridad

### Implementado ✅

- ✅ **Hashing de contraseñas**: `password_hash()` + `password_verify()`
- ✅ **Sesiones seguras**: `session_start()` + `$_SESSION`
- ✅ **CSRF protection**: Token en `config/csrf.php`
- ✅ **SQL Injection prevention**: Prepared statements con PDO
- ✅ **HTML escaping**: `htmlspecialchars()` en output
- ✅ **Input validation**: Validación de `slug`, `materia`, etc.

### Por implementar 🔐

```php
// 1. Rate limiting en login
if ($failed_attempts > 5) {
    sleep(2 ** $failed_attempts);  // Exponential backoff
}

// 2. HTTPS obligatorio
if (empty($_SERVER['HTTPS'])) {
    header('Location: https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
}

// 3. Headers de seguridad
header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: DENY');
header('Content-Security-Policy: default-src \'self\'');

// 4. Autenticación 2FA
// Implementar con TOTP (Google Authenticator)

// 5. Logging y monitoreo
error_log("Login attempt: user={$user}, success={$ok}, ip={$_SERVER['REMOTE_ADDR']}");
```

---

## Preguntas Frecuentes Dev

**P: ¿Cómo agregar una nueva materia?**

R: Edita `src/content.php` y en el array `$lecciones`, cambia el valor de `'materia'` a tu nueva materia. El dashboard agrupa automáticamente por materia.

**P: ¿Cómo cambiar el puntaje por pregunta?**

R: En `src/funciones.php`, busca `$points_per_question = 10;` y cambia.

**P: ¿Cómo agregar badges nuevos?**

R: Edita la tabla `badges` en BD y luego agrega lógica en `src/funciones.php` para otorgarlos.

**P: ¿Por qué mi lección no aparece en el dashboard?**

R: Verifica que el `slug` es único y que `materia` está bien escrito. Recarga sin caché (Ctrl+Shift+R).

**P: ¿Cómo agregar imágenes a las lecciones?**

R: Copia imágenes a `assets/img/` y en el `contenido` agrega:
```html
<img src="/LC-ADVANCE/assets/img/mi-imagen.avif" alt="Descripción">
```

---

**¡Gracias por contribuir a LC-ADVANCE!** 🚀
