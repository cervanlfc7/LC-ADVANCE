# 📖 Referencia Rápida

Cheat sheet para las tareas más comunes en LC-ADVANCE.

---

## 🚀 Iniciar Proyecto

```bash
# 1. Clonar
git clone https://github.com/cervanlfc7/LC-ADVANCE.git
cd LC-ADVANCE

# 2. Importar BD
mysql -u root -p < sql/lc_advance.sql

# 3. Configurar credenciales
# Edita config/config.php

# 4. Iniciar servidor
php -S localhost:8000 -t .

# 5. Abrir navegador
# http://localhost:8000/index.php
```

---

## 📚 Agregar Lección

**Archivo:** `src/content.php`

```php
$lecciones[] = [
    'materia'   => 'Inglés',              // ← Nombre de materia
    'slug'      => 'my-first-lesson',     // ← ID único (sin espacios)
    'titulo'    => 'My First Lesson',     // ← Título visible
    'icon'      => '📖',                  // ← Emoji
    'contenido' => <<<'EOT'
<h2>Contenido aquí</h2>
<p>Usa HTML normal</p>
EOT,
    'quiz'      => [
        [
            'pregunta'  => '¿Pregunta 1?',
            'correcta'  => 'Respuesta correcta',
            'opciones'  => ['Respuesta correcta', 'Incorrecto', 'También incorrecto']
        ],
        // Máx 10 preguntas
    ]
];
```

**Importante:**
- `slug` → único, sin espacios, minúsculas
- Escapar `<?php` → `&lt;?php`
- Usar `<<<'EOT' ... EOT;` para HTML

---

## 🔑 Login de Usuario

```bash
curl -X POST http://localhost:8000/login.php \
  -d "nombre_usuario=test&contrasena=Test1234"
```

---

## 🧠 Tomar un Quiz

```bash
# 1. Cargar página de lección
curl "http://localhost:8000/leccion_detalle.php?slug=b1-past-simple-2025&materia=Inglés"

# 2. Enviar respuestas
curl -X POST http://localhost:8000/src/funciones.php \
  -d "accion=calificar_quiz&slug=b1-past-simple-2025&q0=option1&q1=option2..."
```

---

## 📊 Endpoint de Estado (con TOP 10)

```bash
# Obtener puntos, nivel, badges y ranking del usuario
curl -X POST http://localhost:8000/src/funciones.php \
  -d "accion=obtener_estado"
```

**Respuesta:**
```json
{
  "ok": true,
  "puntos": 580,
  "nivel": 2,
  "progreso": 30,
  "badges": [{"nombre": "Nivel 1: Novato", "tipo": "bronze"}],
  "ranking": [
    {"nombre_usuario": "Admin", "puntos": 5000, "es_actual": false},
    {"nombre_usuario": "Estudiante1", "puntos": 580, "es_actual": true}
  ]
}
```

---

## 🧪 Ejecutar Tests

```bash
# Todos
php tests/run_all_tests.php

# Específico
php tests/test_lessons.php
php tests/test_integration.php
php tests/test_e2e_simple.php
```

---

## 🔍 Verificar BD

```sql
-- Ver usuarios
mysql> USE lc_advance;
mysql> SELECT id, nombre_usuario, puntos, nivel FROM usuarios;

-- Ver progreso de un usuario
mysql> SELECT u.nombre_usuario, up.slug, up.score, up.completed
       FROM user_progress up
       JOIN usuarios u ON u.id = up.user_id
       WHERE u.nombre_usuario = 'test';

-- Ranking
mysql> SELECT nombre_usuario, puntos FROM usuarios ORDER BY puntos DESC LIMIT 10;
```

---

## 🐛 Verificar Sintaxis PHP

```bash
# Verifica que no hay errores de parsing
php -l src/content.php
php -l src/funciones.php
php -l leccion_detalle.php
```

---

## 📁 Estructura Clave

```
config/config.php       ← BD credentials + session
src/content.php         ← Todas las lecciones ($lecciones)
src/funciones.php       ← AJAX endpoints (calificar_quiz, etc.)
leccion_detalle.php     ← Vista de lección + quiz
dashboard.php           ← Panel del usuario
assets/js/app.js        ← Lógica cliente (listeners)
assets/css/style.css    ← Estilos
sql/lc_advance.sql      ← BD dump (importar aquí)
```

---

## 🌐 URLs Principales

| URL | Descripción |
|-----|-----------|
| `/index.php` | Landing page |
| `/login.php` | Login |
| `/register.php` | Registro |
| `/dashboard.php` | Panel usuario (requiere login) |
| `/leccion_detalle.php?slug=X&materia=Y` | Lección + quiz |
| `/mapa/index.html` | Mapa interactivo |
| `/src/funciones.php` | Endpoints AJAX |

---

## ⚙️ Configuración

**Archivo:** `config/config.php`

```php
define('DB_HOST', 'localhost');     // Host MySQL
define('DB_NAME', 'lc_advance');    // Nombre BD
define('DB_USER', 'root');          // Usuario MySQL
define('DB_PASS', '');              // Contraseña
```

**Variables de entorno (override):**
```bash
export DB_HOST=prod-server.com
export DB_NAME=lc_prod
export DB_USER=lcuser
export DB_PASS=securepass123
```

---

## 🔐 Seguridad

- ✅ Contraseñas: `password_hash()` + `password_verify()`
- ✅ SQL Injection: Prepared statements con PDO
- ✅ CSRF: Token en formularios (`config/csrf.php`)
- ✅ HTML Escaping: `htmlspecialchars()`
- ✅ Sesiones: `$_SESSION['usuario_id']`

---

## 📝 Estructura de Lección

```php
$lecciones[] = [
    'materia'   => 'string',        // Nombre de materia
    'slug'      => 'string',        // ID único
    'titulo'    => 'string',        // Título visible
    'icon'      => 'string|emoji',  // Icono
    'contenido' => 'string (HTML)', // Contenido
    'quiz'      => [                // Array de preguntas
        [
            'pregunta'  => 'string',
            'correcta'  => 'string', // (debe coincidir con una opción)
            'opciones'  => ['string', ...]
        ]
    ]
];
```

---

## 📤 Enviar Respuestas de Quiz

**Request:**
```
POST /src/funciones.php
accion=calificar_quiz
slug=b1-past-simple-2025
q0=opcion1
q1=opcion2
q2=opcion3
...
```

**Response:**
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

---

## 🎯 Flujos Principales

### 1. Usuario Nuevo → Quiz → Puntos

```
Register → Login → Dashboard 
  → Selecciona Lección 
  → Lee Contenido 
  → Responde Quiz 
  → Recibe Puntos 
  → Aparece en Ranking
```

### 2. Acceso Invitado

```
"Entrar como invitado" 
  → Lee lecciones 
  → Puede responder quiz (sin guardar) 
  → Logout automático al cerrar
```

### 3. Admin (futuro)

```
/admin/dashboard.php 
  → Ver analytics 
  → Agregar lecciones 
  → Ver reporte de usuarios
```

---

## 🚨 Errores Comunes

| Error | Solución |
|-------|----------|
| "Table not found" | `mysql -u root -p < sql/lc_advance.sql` |
| "Access denied" | Verifica DB_USER/DB_PASS en `config/config.php` |
| "Parse error in src/content.php" | Busca `<?php` sin escapar o `<<<EOT` sin cerrar |
| "Login no funciona" | Verifica sesión y tabla `usuarios` |
| "Puntos no se guardan" | Verifica `user_progress` table y conexión PDO |

---

## 💡 Tips

1. **Recarga sin caché:** Ctrl+Shift+R
2. **Ver logs PHP:** `tail -f /var/log/php_error.log`
3. **Debug SQL:** Agrega `echo $sql;` antes de `execute()`
4. **Test endpoint:** Usa `curl` para verificar que responde
5. **Verificar permisos:** `chmod 755 /var/www/html/LC-ADVANCE`

---

## 🔗 Enlaces Útiles

- 📚 README completo: [README.md](README.md)
- 🔧 Guía de desarrollo: [DEVELOPMENT.md](DEVELOPMENT.md)
- 📝 SQL schema: [sql/lc_advance.sql](sql/lc_advance.sql)
- 🧪 Tests: [tests/run_all_tests.php](tests/run_all_tests.php)
- 📦 GitHub: https://github.com/cervanlfc7/LC-ADVANCE

---

**Última actualización:** Enero 2026
