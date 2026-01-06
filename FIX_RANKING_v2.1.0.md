# 🆘 TOP 10 RANKING - Guía de Solución de Problemas (v2.1.0)

## ❌ Problema: TOP 10 Ranking no se muestra en Dashboard

### Síntomas
- ✗ El ranking flotante está vacío
- ✗ No aparecen jugadores en la tabla
- ✗ Consola muestra errores

### Causas Identificadas (y solucionadas)

| Causa | Síntoma | Solución |
|-------|---------|----------|
| Endpoint inaccesible | Error 404/403 | Crear `/api/ranking.php` ✅ |
| Función no definida | "is not defined" | Mover función a app.js ✅ |
| Error de sintaxis JS | "missing }" | Cerrar llaves en app.js ✅ |
| Sesión expirada | 401 Unauthorized | Re-login necesario |
| Caché del navegador | Datos antiguos | Ctrl+Shift+R |

---

## ✅ SOLUCIONES APLICADAS (Estado Final)

### 1. Nuevo Endpoint API ✅

**Archivo creado**: `/api/ranking.php`

```php
<?php
// GET /api/ranking.php
// Retorna: Top 10 ranking + datos del usuario
// Requiere: Sesión autenticada o modo invitado
```

**Status**: Funcionando correctamente

### 2. Función fetchAndUpdateDashboard() ✅

**Ubicación**: `assets/js/app.js` (líneas 268-352)

```javascript
function fetchAndUpdateDashboard() {
    fetch('api/ranking.php', {
        method: 'GET',
        headers: { 'Content-Type': 'application/json' }
    })
    .then(res => res.json())
    .then(data => {
        if (data.ok) {
            // Actualizar ranking, puntos, nivel, badges
        }
    });
}
```

**Se ejecuta**: Automáticamente cada 15 segundos en DOMContentLoaded

### 3. Sintaxis JavaScript ✅

**Error corregido**: Línea 85-133 en `app.js`

Faltaba cerrar la llave:
```javascript
if (loginBtn && authWrapper && ...) {
    // código...
}  // ← AGREGADO
```

---

## 🔍 Verificación: ¿Todo funciona?

### Checklist de validación

- [x] TOP 10 se muestra con usuarios reales
- [x] Puntos se actualizan automáticamente
- [x] Nivel y barras de progreso funcionan
- [x] Badges se calculan correctamente
- [x] Sin errores en consola (F12)
- [x] Modo invitado devuelve ranking vacío
- [x] API responde con JSON válido

### Test Manual

**Paso 1**: Abre el navegador
```
URL: http://localhost/LC-ADVANCE/dashboard.php
```

**Paso 2**: Presiona F12 para abrir consola
```
Ir a: Console tab
Busca: "Ranking actualizado con X jugadores"
```

**Paso 3**: Verifica el Network tab
```
Filter: api/ranking.php
Status: 200 (verde ✅)
```

**Paso 4**: Mira la tabla TOP 10
```
Debe mostrar:
1. Maria - 40 pts
2. cervanlfc7 - 30 pts
```

---

## 📋 Datos de Prueba

```
Total usuarios: 2
├── ID: 26 | Maria | 40 puntos | Nivel 1 | 0% progreso
└── ID: 25 | cervanlfc7 | 30 puntos | Nivel 1 | 0% progreso
```

### Badges

- ✗ Maria: No tiene badges (necesita 500 pts)
- ✗ cervanlfc7: No tiene badges (necesita 500 pts)

Para obtener badges:
```
500+ pts  → Nivel 1: Novato (bronze)
1000+ pts → Nivel 2: Explorador (silver)
2000+ pts → Nivel 3: Élite (gold)
```

---

## 🆘 Si aún NO funciona

### Debug Step 1: Verificar que el archivo existe

```bash
# Terminal/PowerShell
ls -la C:\xampp\htdocs\LC-ADVANCE\api\ranking.php

# Debe retornar:
# -rw-r--r-- ... ranking.php
```

### Debug Step 2: Verificar respuesta del API

```bash
# Con curl (requiere autenticación)
curl -b cookies.txt http://localhost/LC-ADVANCE/api/ranking.php

# Esperado:
# {"ok":true,"puntos":40,"nivel":1,...}
```

### Debug Step 3: Verificar JavaScript en consola

```javascript
// Pegar esto en la consola (F12)
typeof fetchAndUpdateDashboard
// Debe retornar: "function"

// Si retorna "undefined":
// - app.js no se cargó
// - Hay error de sintaxis
// - Ctrl+Shift+R para limpiar caché
```

### Debug Step 4: Revisar logs de error

```bash
# PHP error log
tail -f C:\xampp\apache\logs\error.log

# Browser console (F12)
# Busca cualquier error rojo
```

---

## 📞 Reportar Problema

Si nada funciona:

1. Verifica que estés logueado (no invitado)
2. Haz Ctrl+Shift+R para limpiar caché
3. Abre la consola (F12)
4. Copia el error exacto
5. Reporta con:
   - Navegador y versión
   - PHP version (`php -v`)
   - URL exacta donde ocurre
   - Error completo de consola

---

## 📝 Cambios en esta versión (2.1.0)

| Componente | Antes | Ahora |
|-----------|-------|-------|
| Endpoint ranking | src/funciones.php | **api/ranking.php** |
| Método HTTP | POST | GET |
| Función JS | No existía | fetchAndUpdateDashboard() |
| Sintaxis app.js | Error missing } | ✅ Corregido |
| Actualización | Manual | Automática (15s) |

---

**Estado actual**: ✅ COMPLETAMENTE FUNCIONAL

**Última actualización**: 5 Enero 2026
