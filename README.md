# CBTIS168 - Study Game (CUCO Advance)

Resumen
-------
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
1. Copia el proyecto dentro de la carpeta pública de tu servidor (ej.: `c:\xampp\htdocs\CBTIS168-StudyGame`).
2. Importa la base de datos:
   mysql -u root -p < sql/schema.sql
3. Configura conexión DB en [config/config.php](config/config.php).
4. Inicia Apache + MySQL (XAMPP) y abre:
   http://localhost/CBTIS168-StudyGame/index.php

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