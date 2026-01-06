# 🚀 QUICK START - LC-ADVANCE v2.1.0

**Última actualización**: 5 Enero 2026  
**Versión**: 2.1.0  
**Estado**: ✅ Operativa  

---

## ⚡ En 5 Minutos

```
1. Accede a http://localhost/LC-ADVANCE
2. Haz login (usuario: maria / password: [tu-password])
3. Ve a Dashboard → ¡TOP 10 funciona!
4. Espera 15 segundos → Ve actualizar automáticamente
5. ¡Listo!
```

---

## 📋 TOP 10 Ranking - Lo Nuevo en v2.1.0

### ✅ Qué funciona ahora

```
✅ TOP 10 se muestra con datos reales
✅ Actualiza automáticamente cada 15 segundos
✅ Muestra puntos, nivel y badges
✅ Sin errores en consola
✅ Compatible con todos los navegadores
```

### 📍 Dónde lo encuentro

1. Login a LC-ADVANCE
2. Dashboard → Sección "TOP 10 Ranking"
3. O en `dashboard.php` → elemento con `id="ranking-body"`

### 🔍 Usuarios de prueba

| Usuario | Contraseña | Puntos |
|---------|-----------|--------|
| maria | password | 40 |
| cervanlfc7 | password | 30 |

---

## 🛠️ Si algo no funciona

### TOP 10 sigue vacío

**Opción 1**: Verifica datos en BD
```php
// En phpMyAdmin:
SELECT id, usuario, puntos FROM usuarios LIMIT 10;

// Deberías ver:
// 26 | maria | 40
// 25 | cervanlfc7 | 30
```

**Opción 2**: Abre consola del navegador (F12)
```
Busca errores rojos
Si hay "api/ranking.php 404" → archivo no creado
Si hay "SyntaxError" → revisar app.js
Si hay "fetch error" → verificar servidor
```

**Opción 3**: Ve a TROUBLESHOOTING.md

### Consola dice "fetchAndUpdateDashboard not defined"

**Solución**: Verifica que `app.js` cargó
```javascript
// F12 → Console → escribe:
typeof fetchAndUpdateDashboard
// Debe retornar: "function"
```

### Errores de sintaxis en app.js

**Solución**: Ya está corregido en v2.1.0
- Línea 85-133 ✅ Cierre de llaves correcto
- Línea 268-352 ✅ Nueva función agregada

---

## 📚 Documentación Rápida

| Necesito... | Leo... | Tiempo |
|-------------|--------|--------|
| Resumen general | STATUS_FINAL_v2.1.0.md | 10 min |
| Instalar desde 0 | README.md | 20 min |
| Entender cambios | RELEASE_NOTES_v2.1.0.md | 10 min |
| Navegar docs | DOCS_MAP.md | 15 min |
| Problemas | TROUBLESHOOTING.md | Variable |
| Ranking específico | FIX_RANKING_v2.1.0.md | 12 min |
| Endpoints API | API.md | 15 min |
| Agregar código | DEVELOPMENT.md | 25 min |

---

## 💡 Tips Útiles

### Ver qué usuarios hay
```php
// phpMyAdmin → Ejecutar SQL:
SELECT usuario, puntos, nivel FROM usuarios ORDER BY puntos DESC;
```

### Ver logs del servidor
```bash
# En Windows (XAMPP):
# C:\xampp\apache\logs\error.log
# C:\xampp\php\logs\php_error.log

# En Linux:
# /var/log/apache2/error.log
# /var/log/php-errors.log
```

### Limpiar caché del navegador
```
F12 → Application → Clear Storage
O: Ctrl+Shift+Delete → Clear all
```

### Resetear datos de prueba
```sql
-- Ejecutar en phpMyAdmin:
UPDATE usuarios SET puntos = 0, nivel = 1 WHERE id IN (25, 26);
```

---

## 🎯 Próximos Pasos

### Opción 1: Usar el sistema
```
1. Crea más usuarios
2. Toma lecciones
3. Observa el ranking actualizar
4. Consigue badges
```

### Opción 2: Personalizar
```
1. Lee QUICK_REFERENCE.md
2. Agrega tus propias lecciones
3. Cambia colores en style.css
4. Personaliza según necesidad
```

### Opción 3: Agregar funcionalidad
```
1. Lee DEVELOPMENT.md
2. Crea una rama feature
3. Modifica code
4. Agrega tests
5. Haz merge
```

---

## 📞 Ayuda Rápida

### Buscar en documentación
```
Ctrl+F en cualquier .md file
Palabra clave: ranking, puntos, endpoint, error, etc.
```

### Abrir en navegador
```
http://localhost/LC-ADVANCE/         → Sistema
http://localhost/phpmyadmin/         → Base de datos
http://localhost/LC-ADVANCE/API.md   → Docs API
```

### Verificación rápida
```bash
# Verificar servidor
ping localhost

# Verificar PHP
php -v

# Verificar MySQL
mysql -u root -p -e "SELECT 1;"
```

---

## ✅ Checklist de Verificación

```
☐ Sistema accesible en http://localhost/LC-ADVANCE
☐ Puedo hacer login
☐ TOP 10 muestra usuarios con puntos
☐ Ranking se actualiza cada 15 segundos
☐ Consola del navegador sin errores (F12)
☐ Puntos y nivel muestran correctamente
☐ Badges calculados correctamente

Si todo está checked → ✅ Sistema funcionando
Si algo falla → Ve a TROUBLESHOOTING.md
```

---

## 🎓 Cómo Aprender Más

### Ruta Completa (2-4 horas)
```
1. STATUS_FINAL_v2.1.0.md → Entender qué cambió
2. README.md → Instalación y uso
3. DEVELOPMENT.md → Cómo funciona el código
4. API.md → Qué endpoints existen
5. FIX_RANKING_v2.1.0.md → Entender el fix
6. Revisar código fuente
```

### Ruta Rápida (30 minutos)
```
1. Este archivo (QUICK_START.md)
2. RELEASE_NOTES_v2.1.0.md
3. Verificación rápida del sistema
```

### Ruta de Admin (1 hora)
```
1. STATUS_FINAL_v2.1.0.md
2. TROUBLESHOOTING.md
3. Monitoreo de logs
4. Testing de usuarios
```

---

## 🔗 Links Útiles

| Link | Qué es | Dónde |
|------|--------|-------|
| http://localhost/LC-ADVANCE | Sistema principal | localhost |
| http://localhost/phpmyadmin | Base de datos | localhost |
| api/ranking.php | Endpoint ranking | /api/ |
| assets/js/app.js | JavaScript principal | /assets/js/ |
| dashboard.php | Dashboard usuario | / |
| DOCS_MAP.md | Navegación docs | / |

---

## 🎉 ¡Listo!

Ahora tienes LC-ADVANCE v2.1.0 completamente funcional.

**Próximo paso**: Ve a http://localhost/LC-ADVANCE y ¡comienza!

---

**Última actualización**: 5 Enero 2026  
**Versión**: 2.1.0  
**Estado**: ✅ COMPLETAMENTE OPERATIVA  

*Para más ayuda, consulta la documentación en la carpeta raíz.*
