# 📡 API Documentation

Referencia completa de todos los endpoints disponibles en LC-ADVANCE.

---

## Base URL

```
http://localhost:8000
```

---

## Autenticación

La mayoría de endpoints requieren sesión activa (`$_SESSION['usuario_id']`).

**Para testear con curl:**
```bash
# Primero, hacer login y guardar cookies
curl -c cookies.txt -X POST http://localhost:8000/login.php \
  -d "nombre_usuario=test&contrasena=Test1234"

# Luego usar -b cookies.txt en otras peticiones
curl -b cookies.txt -X POST http://localhost:8000/src/funciones.php \
  -d "accion=obtener_estado"
```

---

## Endpoints Públicos

### 1. GET `/index.php`

Landing page pública.

**Respuesta:**
- HTTP 200: HTML de landing

**Ejemplo:**
```bash
curl http://localhost:8000/index.php
```

---

### 2. GET `/login.php`

Formulario de login (GET) o procesamiento (POST).

**POST `/login.php`**

| Parámetro | Tipo | Requerido | Descripción |
|-----------|------|----------|-----------|
| `nombre_usuario` | string | Sí | Nombre de usuario |
| `contrasena` | string | Sí | Contraseña sin encriptar |

**Respuesta:**
- HTTP 302 Redirect → `/dashboard.php` (si OK)
- HTTP 200 con mensaje error (si fallo)

**Ejemplo:**
```bash
curl -c cookies.txt -X POST http://localhost:8000/login.php \
  -d "nombre_usuario=test&contrasena=Test1234"
```

---

### 3. GET `/register.php`

Formulario de registro (GET) o procesamiento (POST).

**POST `/register.php`**

| Parámetro | Tipo | Requerido | Descripción |
|-----------|------|----------|-----------|
| `nombre_usuario` | string | Sí | Nombre único (3-100 chars) |
| `correo` | string | Sí | Email válido |
| `contrasena` | string | Sí | Mín 6 caracteres |
| `confirmar_contrasena` | string | Sí | Debe coincidir |

**Respuesta:**
- HTTP 200: Usuario creado + redirige a login
- HTTP 200: Error si usuario/email existe

**Ejemplo:**
```bash
curl -X POST http://localhost:8000/register.php \
  -d "nombre_usuario=newuser&correo=new@example.com&contrasena=Test1234&confirmar_contrasena=Test1234"
```

---

### 4. GET `/guest_login.php`

Acceso como invitado (sin crear cuenta).

**Respuesta:**
- HTTP 302 Redirect → `/dashboard.php` (sesión de invitado)

**Características invitado:**
- ✅ Leer lecciones
- ✅ Responder quizzes
- ❌ NO se guardan puntos
- ❌ NO aparece en ranking

**Ejemplo:**
```bash
curl -c cookies.txt http://localhost:8000/guest_login.php
```

---

## Endpoints Autenticados

### 5. GET `/dashboard.php`

Panel principal del usuario (requiere sesión).

**Respuesta:**
- HTTP 200: HTML del dashboard
- HTTP 302 Redirect → `/login.php` (sin sesión)

**Muestra:**
- Perfil del usuario
- Puntos y nivel actual
- Lecciones disponibles por materia
- Top 10 ranking
- Badges obtenidos

**Ejemplo:**
```bash
curl -b cookies.txt http://localhost:8000/dashboard.php
```

---

### 6. GET `/leccion_detalle.php`

Ver contenido de lección específica.

**Parámetros GET:**

| Parámetro | Tipo | Requerido | Descripción |
|-----------|------|----------|-----------|
| `slug` | string | Sí | ID único de lección |
| `materia` | string | Sí | Nombre de materia |

**Respuesta:**
- HTTP 200: Lección + quiz
- HTTP 302 Redirect → `/login.php` (sin sesión)

**Ejemplo:**
```bash
curl -b cookies.txt "http://localhost:8000/leccion_detalle.php?slug=b1-past-simple-2025&materia=Inglés"
```

---

### 7. GET `/logout.php`

Cerrar sesión actual.

**Respuesta:**
- HTTP 302 Redirect → `/index.php`
- Sesión destruida

**Ejemplo:**
```bash
curl -b cookies.txt http://localhost:8000/logout.php
```

---

## AJAX Endpoints

### 8. POST `/src/funciones.php?accion=calificar_quiz`

Enviar respuestas de quiz y obtener puntos.

**Parámetros POST:**

| Parámetro | Tipo | Requerido | Descripción |
|-----------|------|----------|-----------|
| `accion` | string | Sí | Valor: `calificar_quiz` |
| `slug` | string | Sí | ID de lección |
| `q0, q1, q2...` | string | Sí | Respuestas (texto exacto) |

**Respuesta JSON:**

```json
{
  "ok": true,
  "score": 8,
  "xp_ganado": 80,
  "new_puntos": 580,
  "new_nivel": 2,
  "nuevo_badge": null,
  "details": [
    {
      "pregunta": "¿Pregunta 1?",
      "correcta": "Respuesta A",
      "respuesta": "Respuesta A",
      "acertada": true
    },
    {
      "pregunta": "¿Pregunta 2?",
      "correcta": "Respuesta B",
      "respuesta": "Respuesta C",
      "acertada": false
    }
  ]
}
```

**Códigos de error:**

```json
{
  "ok": false,
  "error": "Lección no encontrada" | "Usuario no autenticado" | "Error BD"
}
```

**Ejemplo:**
```bash
curl -b cookies.txt -X POST http://localhost:8000/src/funciones.php \
  -d "accion=calificar_quiz&slug=b1-past-simple-2025&q0=The+students+studied&q1=Yesterday&q2=Yes"
```

---

### 9. POST `/src/funciones.php?accion=obtener_estado`

Obtener estado actual del usuario (puntos, nivel, badges).

**Parámetros POST:**

| Parámetro | Tipo | Requerido | Descripción |
|-----------|------|----------|-----------|
| `accion` | string | Sí | Valor: `obtener_estado` |

**Respuesta JSON:**

```json
{
  "ok": true,
  "usuario_id": 1,
  "nombre_usuario": "test",
  "puntos": 580,
  "nivel": 2,
  "progreso": 30,
  "badges": [
    {
      "id": 1,
      "nombre": "Primer Paso",
      "descripcion": "Completa tu primera lección",
      "tipo": "bronze",
      "otorgado_en": "2025-01-05 10:30:00"
    }
  ],
  "ranking": [
    {
      "rank": 1,
      "nombre_usuario": "usuario1",
      "puntos": 1500,
      "es_actual": false
    },
    {
      "rank": 2,
      "nombre_usuario": "test",
      "puntos": 580,
      "es_actual": true
    }
  ]
}
```

**Ejemplo:**
```bash
curl -b cookies.txt -X POST http://localhost:8000/src/funciones.php \
  -d "accion=obtener_estado"
```

---

### 10. POST `/src/funciones.php?accion=completar`

Marcar lección como completada (alternativa a quiz).

**Parámetros POST:**

| Parámetro | Tipo | Requerido | Descripción |
|-----------|------|----------|-----------|
| `accion` | string | Sí | Valor: `completar` |
| `slug` | string | Sí | ID de lección |
| `xp` | integer | No | XP a otorgar (default: 50) |

**Respuesta JSON:**

```json
{
  "ok": true,
  "completed": true,
  "xp_ganado": 50,
  "new_puntos": 630
}
```

**Ejemplo:**
```bash
curl -b cookies.txt -X POST http://localhost:8000/src/funciones.php \
  -d "accion=completar&slug=b1-past-simple-2025&xp=50"
```

---

## Mapa / Game Endpoints

### 11. GET `/mapa/index.html`

Mapa interactivo (HTML estático).

**Respuesta:**
- HTTP 200: Mapa con tilesets y controles

**Ejemplo:**
```bash
curl http://localhost:8000/mapa/index.html
```

---

### 12. POST `/mapa/updateDB.php`

Actualizar estado del maestro actual en mapa.

**Content-Type:** `application/json`

**Body JSON:**

```json
{
  "maestro": "Miguel",
  "materia": "Inglés"
}
```

**Respuesta JSON:**

```json
{
  "success": true,
  "message": "Registro insertado",
  "maestro": "Miguel",
  "materia": "Inglés"
}
```

**Errores:**

```json
{
  "success": false,
  "error": "Parámetros requeridos faltantes"
}
```

**Ejemplo:**
```bash
curl -X POST http://localhost:8000/mapa/updateDB.php \
  -H "Content-Type: application/json" \
  -d '{"maestro":"Miguel","materia":"Inglés"}'
```

---

## Endpoints de Progreso

### 13. POST `/update_progress.php`

Actualizar progreso de usuario (alternativa a funciones.php).

**Parámetros POST:**

| Parámetro | Tipo | Requerido | Descripción |
|-----------|------|----------|-----------|
| `slug` | string | Sí | ID de lección |
| `correctas` | integer | Sí | Número de respuestas correctas |
| `xp` | integer | No | XP a otorgar |

**Respuesta:**
- HTTP 200: JSON con confirmación
- HTTP 400: Error de parámetros

**Ejemplo:**
```bash
curl -b cookies.txt -X POST http://localhost:8000/update_progress.php \
  -d "slug=b1-past-simple-2025&correctas=8&xp=80"
```

---

## Error Handling

### Códigos HTTP

| Código | Significado | Acción |
|--------|-----------|--------|
| 200 | OK | Solicitud exitosa |
| 302 | Redirect | Redirigido (login requerido) |
| 400 | Bad Request | Parámetros inválidos |
| 401 | Unauthorized | Sesión no activa |
| 404 | Not Found | Recurso no existe |
| 500 | Server Error | Error de BD o PHP |

### Estructura de Errores JSON

```json
{
  "ok": false,
  "error": "Mensaje descriptivo del error"
}
```

---

## Ejemplos Completos

### Flujo: Register → Login → Quiz → Ver Estado

```bash
#!/bin/bash

BASE="http://localhost:8000"
COOKIE_JAR="cookies.txt"

# 1. Registrar nuevo usuario
echo "1. Registrando usuario..."
curl -X POST "$BASE/register.php" \
  -d "nombre_usuario=newuser&correo=new@example.com&contrasena=Test1234&confirmar_contrasena=Test1234"

# 2. Login
echo "2. Haciendo login..."
curl -c "$COOKIE_JAR" -X POST "$BASE/login.php" \
  -d "nombre_usuario=newuser&contrasena=Test1234"

# 3. Ver dashboard
echo "3. Viendo dashboard..."
curl -b "$COOKIE_JAR" "$BASE/dashboard.php"

# 4. Cargar lección
echo "4. Cargando lección..."
curl -b "$COOKIE_JAR" "$BASE/leccion_detalle.php?slug=b1-past-simple-2025&materia=Inglés"

# 5. Responder quiz
echo "5. Respondiendo quiz..."
curl -b "$COOKIE_JAR" -X POST "$BASE/src/funciones.php" \
  -d "accion=calificar_quiz&slug=b1-past-simple-2025&q0=The+students&q1=Yesterday&q2=Yes"

# 6. Obtener estado
echo "6. Obteniendo estado..."
curl -b "$COOKIE_JAR" -X POST "$BASE/src/funciones.php" \
  -d "accion=obtener_estado" | jq .

# 7. Logout
echo "7. Saliendo..."
curl -b "$COOKIE_JAR" "$BASE/logout.php"
```

**Ejecutar:**
```bash
bash api_test.sh
```

---

## Rate Limiting

Actualmente **no hay rate limiting implementado**. Próximas versiones incluirán:
- Máx 10 intentos de login por IP
- Máx 30 quizzes por hora por usuario
- Throttling de API calls

---

## Versionado

Versión actual: **1.0**

- `1.0` - Release inicial con endpoints básicos

Próximas versiones incluirán:
- Endpoint `/api/v2/...` para cambios compatibles hacia atrás
- Mejor paginación en ranking

---

## Changelog

**2025-01-05:**
- ✅ Documentación API completa
- ✅ Ejemplos curl para cada endpoint
- ✅ Estructura de respuesta estándar

---

## Soporte

¿Preguntas sobre la API? Reporta un issue:
https://github.com/cervanlfc7/LC-ADVANCE/issues

---

**Última actualización:** Enero 2025
