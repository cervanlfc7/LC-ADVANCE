# 🔧 Guía de Troubleshooting & Debugging

Soluciones a problemas comunes en LC-ADVANCE.

---

## 🚨 Problemas de Instalación

### ❌ "MySQL connection refused"

**Síntomas:**
```
Fatal error: Uncaught PDOException: SQLSTATE[HY000] [2002] Connection refused
```

**Causas posibles:**
- MySQL no está corriendo
- Credenciales incorrectas en `config/config.php`
- Host incorrecto (default: localhost)

**Solución:**

```bash
# 1. Verificar que MySQL está activo
# En XAMPP: Control Panel → "Start" MySQL

# 2. Verificar credenciales
cat config/config.php | grep DB_

# 3. Probar conexión manual
mysql -h localhost -u root -p
# Ingresa contraseña (vacía si no hay) y presiona Enter
# Si aparece: mysql> → ¡Conectado!

# 4. Si sigue fallando, resetea MySQL:
# XAMPP → "Stop" MySQL → espera 5s → "Start"
```

---

### ❌ "Table 'lc_advance.usuarios' doesn't exist"

**Síntomas:**
```
SQLSTATE[42S02]: Table 'lc_advance.usuarios' doesn't exist
```

**Causa:** La BD o tablas no fueron importadas correctamente.

**Solución:**

```bash
# 1. Verificar que la BD existe
mysql -u root -p -e "SHOW DATABASES LIKE 'lc_advance';"

# 2. Si no existe, importar dump
mysql -u root -p < sql/lc_advance.sql

# 3. Verificar tablas
mysql -u root -p
> USE lc_advance;
> SHOW TABLES;
# Deberías ver: usuarios, user_progress, preguntas, etc.

# 4. Si las tablas están vacías, verificar el import:
> SELECT COUNT(*) FROM usuarios;
# Debe devolver al menos 0 (aunque sea vacío)
```

---

### ❌ "Access denied for user 'root'@'localhost'"

**Síntomas:**
```
SQLSTATE[HY000] [1045] Access denied for user 'root'@'localhost'
```

**Causa:** Contraseña incorrecta.

**Solución:**

```bash
# 1. Si no recuerdas la contraseña de MySQL (XAMPP):
# Es generalmente vacía (""), ingresa sin contraseña:
mysql -u root
# Si funciona → no hay contraseña

# 2. Si tienes contraseña pero no la recuerdas:
# XAMPP Control Panel → "Stop" MySQL
# cd C:\xampp\mysql\bin
# mysqld --skip-grant-tables
# mysql -u root
# FLUSH PRIVILEGES;
# ALTER USER 'root'@'localhost' IDENTIFIED BY '';

# 3. Actualiza config/config.php
# define('DB_PASS', 'tu_contraseña_aquí');
```

---

## 🚨 Problemas de PHP

### ❌ "Parse error in src/content.php"

**Síntomas:**
```
Parse error: syntax error, unexpected token '<?php' in src/content.php
```

**Causa:** Raw `<?php` dentro de heredoc sin escapar.

**Solución:**

```bash
# 1. Verificar sintaxis
php -l src/content.php

# 2. Encontrar la línea problemática
# El error dirá: "Parse error ... on line X"

# 3. Editar src/content.php y buscar esa línea
# Cambiar: <?php
# Por:     &lt;?php

# 4. Guardar y verificar de nuevo
php -l src/content.php
# Salida esperada: "No syntax errors"
```

**Ejemplo correcto:**

```php
'contenido' => <<<'EOT'
<h2>Ejemplo de código</h2>
<p>Aquí puedes mostrar código:</p>
<code>&lt;?php echo "Hola"; ?&gt;</code>
<!-- CORRECTO: &lt;?php sin barras -->
EOT,
```

---

### ❌ "Undefined constant 'Math'"

**Síntomas:**
```
Uncaught Error: Undefined constant "Math"
```

**Causa:** PHP intenta parsear constantes que no existen (ej: `Math::sqrt()` sin escapar).

**Solución:**

```php
# En src/content.php, busca referencias a constantes no escapadas
# Cambiar: Math::sqrt()
# Por:     \Math::sqrt() o mostrar como texto: &lt;Math::sqrt()&gt;

# Si es código de ejemplo, escapa todo:
'contenido' => <<<'EOT'
<h3>Ejemplo de código PHP</h3>
<pre><code>&lt;?php
$resultado = sqrt(16);
echo $resultado; // Output: 4
?&gt;</code></pre>
EOT,
```

---

### ❌ "Unexpected token '??'"

**Síntomas:**
```
Parse error: syntax error, unexpected token '??'
```

**Causa:** Null-coalescing operator (`??`) no disponible en PHP < 7.0.

**Solución:**

```bash
# 1. Verificar versión PHP
php -v

# 2. Si es PHP 7.0+, el problema es otro
# Busca `??` sin escapar en src/content.php y reemplaza:

# Cambiar: $var ?? $default
# Por:     isset($var) ? $var : $default

# Ejemplo en contenido:
# Cambiar:
'contenido' => <<<'EOT'
<?php $titulo = $vars['title'] ?? 'Sin título'; ?>
EOT,

# Por:
'contenido' => <<<'EOT'
<p>Ejemplo de código:</p>
<code>&lt;?php $titulo = isset($vars['title']) ? $vars['title'] : 'Sin título'; ?&gt;</code>
EOT,
```

---

## 🚨 Problemas de Funcionalidad

### ❌ "Login no funciona / 'Usuario o contraseña incorrectos'"

**Síntomas:**
- Ingresas credenciales correctas → "Error"
- No aparece error específico

**Debuggeo:**

```bash
# 1. Verificar que el usuario existe
mysql -u root -p
> USE lc_advance;
> SELECT id, nombre_usuario, correo FROM usuarios;

# 2. Probar login con SQL
> SELECT * FROM usuarios WHERE nombre_usuario = 'tu_usuario';

# 3. Si no aparece, crear un usuario manualmente
> INSERT INTO usuarios (nombre_usuario, correo, contrasena_hash) 
  VALUES ('test', 'test@example.com', 
  '$2y$10$...' ); -- Hash bcrypt válido

# 4. Habilitar debug en login.php
# Agrega al inicio:
error_reporting(E_ALL);
ini_set('display_errors', 1);

# 5. Ver logs PHP
# XAMPP: C:\xampp\php\logs\php_error_log
# Linux: tail -f /var/log/php_error.log
```

---

### ❌ "Los puntos no se guardan después del quiz"

**Síntomas:**
- Completas un quiz → "¡Ganaste X puntos!"
- Pero en BD no aparecen registros

**Debuggeo:**

```bash
# 1. Verificar que el usuario está autenticado
# En leccion_detalle.php, agrega:
<?php var_dump($_SESSION); ?>

# 2. Ver si hay error en src/funciones.php
# Agrega debug en calificar_quiz():
error_log("Session user: " . $_SESSION['usuario_id'] ?? 'NO SET');

# 3. Verificar que la tabla existe
mysql -u root -p
> USE lc_advance;
> DESCRIBE user_progress;
# Debe mostrar columnas: id, user_id, slug, score, lesson_xp, completed

# 4. Ejecutar test manual
curl -X POST http://localhost:8000/src/funciones.php \
  -d "accion=obtener_estado"
# Si devuelve error, hay problema en funciones.php

# 5. Ver logs del navegador
# F12 → Console → Buscar errors rojos
# Network → Ver respuesta POST a funciones.php
```

---

### ❌ "Lección no aparece en Dashboard"

**Síntomas:**
- Agregas una lección a `src/content.php`
- Pero no aparece en el listado

**Debuggeo:**

```bash
# 1. Verificar sintaxis
php -l src/content.php

# 2. Verificar que el slug es único
# En src/content.php, busca el slug:
grep -n "'slug' => 'tu-slug'" src/content.php
# Si aparece más de una vez, hay duplicado

# 3. Verificar que la materia es correcta
# En src/content.php:
grep -n "'materia' => 'Inglés'" src/content.php

# 4. Recarga sin caché
# Navegador: Ctrl+Shift+R

# 5. Verifica que se está incluyendo content.php
# En dashboard.php, busca:
include 'src/content.php';
# Si no está, agrégalo
```

---

### ❌ "Página en blanco o solo dice 'Error desconocido'"

**Síntomas:**
- Abres URL → Página vacía
- O mensaje genérico de error

**Debuggeo:**

```bash
# 1. Habilitar display de errores
# En config/config.php, agrega al inicio:
ini_set('display_errors', 1);
error_reporting(E_ALL);

# 2. Ver logs PHP directos
php leccion_detalle.php 2>&1 | head -20

# 3. Ver logs del servidor
# XAMPP: C:\xampp\apache\logs\error.log
tail -f /var/log/apache2/error.log

# 4. Probar conexión básica
php -r "echo 'PHP funciona';"

# 5. Verificar que el archivo existe
ls -la leccion_detalle.php
# Debe existir y tener permisos de lectura
```

---

### ❌ "Mapa no carga / error 'maestroact table not found'"

**Síntomas:**
```
Table 'lc_advance.maestroact' doesn't exist
```

**Solución:**

```bash
# 1. Crear tabla manualmente
mysql -u root -p
> USE lc_advance;
> CREATE TABLE IF NOT EXISTS maestroact (
>   id INT AUTO_INCREMENT PRIMARY KEY,
>   IDPersonajeC VARCHAR(100) NOT NULL,
>   Maestro_Actual VARCHAR(255) NOT NULL,
>   updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
> );

# 2. O re-importar BD completa
# Nota: mapa/updateDB.php ya crea la tabla si falta
```

### ❌ "Mapa no carga / error "maestroact not found""

**Síntomas:**
```
Table 'lc_advance.maestroact' doesn't exist
```

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

## 🔍 Herramientas de Debug

### 🚀 Test Rápidos

```php
// En test_prof.php (ya incluido)
// Prueba de endpoints:
$_POST['accion'] = 'obtener_estado';
include 'src/funciones.php';
// Debería retornar: { usuario: ..., puntos: ..., nivel: ..., badges: [...], ranking: [...] }
```

---

## 🏆 Ranking - Solución de Problemas

### ❌ "El ranking no aparece en el dashboard"

**Posibles Causas:**
1. JavaScript no se ejecuta (errores en consola)
2. Usuario no está logueado (se oculta para anónimos)
3. AJAX no obtiene datos del servidor

**Solución:**

```javascript
// En assets/js/app.js, verifica que se ejecute al cargar:
document.addEventListener('DOMContentLoaded', function() {
  fetchAndUpdateDashboard(); // Primera llamada
  setInterval(fetchAndUpdateDashboard, 15000); // Cada 15 segundos
});

// Abre consola (F12) y ejecuta manualmente:
fetchAndUpdateDashboard();
// Debería ver la respuesta JSON en Console
```

### ❌ "El ranking muestra puntos incorrectos"

**Causa:** La función `obtener_estado` calcula mal el progreso

**Solución:**

```php
// src/funciones.php línea ~150
// La fórmula es:
// progreso = (puntos - nivel * 500) / 500 * 100

// Ejemplo:
// - nivel 1: necesita 500 puntos (500 - 0 = 500)
// - nivel 2: necesita otros 500 (1000 - 500 = 500)
// - En puntos = 750: progreso = (750 - 500) / 500 * 100 = 50%

// Verifica en base de datos:
SELECT nombre_usuario, puntos, 
       FLOOR(puntos / 500) AS nivel,
       (puntos - FLOOR(puntos / 500) * 500) / 500 * 100 AS progreso
FROM usuarios
ORDER BY puntos DESC
LIMIT 10;
```

### ❌ "El ranking no se actualiza en tiempo real"

**Solución:**

```javascript
// Asegúrate que el intervalo esté activo en app.js:
let updateInterval = setInterval(fetchAndUpdateDashboard, 15000);

// Si creas nuevas páginas, inicia el intervalo:
function startRankingUpdates() {
  if (typeof updateInterval === 'undefined') {
    updateInterval = setInterval(fetchAndUpdateDashboard, 15000);
  }
}

// Llama en cada página que lo necesite:
document.addEventListener('DOMContentLoaded', startRankingUpdates);
```

### ❌ "El usuario actual no se destaca en el ranking"

**Causa:** Sesión no iniciada o usuario no en top 10

**Solución:**

```php
// src/funciones.php verifica:
session_start();
if (!isset($_SESSION['nombre_usuario'])) {
  // Usuario anónimo: no ve ranking privado
  // Pero sí ve ranking público si lo permites
}

// Si el usuario está fuera del top 10:
// El ranking muestra top 10 solamente
// El usuario puede ver su propia posición en su dashboard

// Para ver posición completa:
SELECT COUNT(*) + 1 as posicion 
FROM usuarios 
WHERE puntos > (SELECT puntos FROM usuarios WHERE nombre_usuario = 'user');
```

---

## 🔍 Herramientas de Debug

### Verificar Sintaxis PHP

```bash
php -l archivo.php
# Salida: No syntax errors detected
```

### Ver Variables de la Sesión

```php
<?php
session_start();
echo '<pre>';
var_dump($_SESSION);
echo '</pre>';
?>
```

### Ejecutar Query SQL Manual

```bash
mysql -u root -p
> USE lc_advance;
> SELECT * FROM usuarios WHERE nombre_usuario = 'test';
```

### Ver Respuesta de Endpoint

```bash
curl -i -X POST http://localhost:8000/src/funciones.php \
  -d "accion=obtener_estado"
# -i muestra headers + body
```

### Ver Logs en Tiempo Real

```bash
# PHP Error Log
tail -f /var/log/php_error.log

# Apache Access Log
tail -f /var/log/apache2/access.log

# XAMPP MySQL Log
tail -f C:\xampp\mysql\data\mysql.log
```

---

## 📋 Checklist de Debug

Antes de reportar un bug, verifica:

- [ ] PHP version >= 8.1 (`php -v`)
- [ ] MySQL está corriendo (`mysql -u root -p`)
- [ ] `sql/lc_advance.sql` fue importado (`mysql> SHOW DATABASES;`)
- [ ] `config/config.php` tiene credenciales correctas
- [ ] `src/content.php` no tiene errores (`php -l src/content.php`)
- [ ] Página recargada sin caché (Ctrl+Shift+R)
- [ ] Sesión iniciada (`var_dump($_SESSION)`)
- [ ] Logs de PHP verificados

---

## 🎯 Flujo de Debug General

1. **¿Qué pasó?** - Describe el error exacto o comportamiento esperado vs actual
2. **¿Dónde pasó?** - URL, archivo, línea del error
3. **¿Cuándo?** - Primera vez o después de cambiar algo
4. **Reproduce** - ¿Puedes hacerlo pasar de nuevo?
5. **Verifica:** - PHP syntax, BD connection, sesión, logs
6. **Aísla** - Comenta código hasta encontrar la línea problemática
7. **Soluciona** - Fix + test
8. **Documenta** - Agrega el error a esta guía si es común

---

## 📞 Reportar un Bug

Si no puedes resolverlo, reporta en GitHub Issues con:

```markdown
**Descripción:**
Qué esperabas que pasara vs qué pasó realmente

**Pasos para reproducir:**
1. Hice login con usuario 'test'
2. Entré al quiz 'past-simple'
3. Respondí las preguntas
4. Clickeé "Terminar"

**Error:**
[Pega el mensaje de error exacto]

**Información del sistema:**
- PHP: 8.2
- MySQL: 5.7
- OS: Windows 10
- Navegador: Chrome 120

**Logs:**
[Pega logs relevantes]
```

---

**¡Espero que encuentres la solución!** 🚀
