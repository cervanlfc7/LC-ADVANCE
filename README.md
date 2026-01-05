# LC-ADVANCE

[![CI](https://github.com/OWNER/REPO/actions/workflows/ci.yml/badge.svg)](https://github.com/OWNER/REPO/actions/workflows/ci.yml)

Resumen
-------

> Note: Replace the `OWNER/REPO` part of the badge URL with your repository owner/name to enable the badge.


Aplicación web educativa (PHP + MySQL + JS) para lecciones interactivas, quizzes con cálculo de puntaje, progreso de usuario, badges y ranking.

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
