# LC-ADVANCE - Agent Instructions

## Run Commands

```bash
# Start local server (XAMPP o PHP built-in en puerto 80)
php -S localhost:80 -t .
# O si usas XAMPP, simplemente inicia Apache en el Panel de Control

# Run all tests
php tests/run_all_tests.php

# Run single test
php tests/test_lessons.php

# Verify PHP syntax
php -l src/Content/content.php

# Add performance indexes to existing DB
php scripts/add_performance_indexes.php
```

## Project Structure

```
LC-ADVANCE/
├── index.php                     # Landing page (root)
├── public/                       # Web root
│   ├── login.php, register.php, logout.php
│   ├── dashboard.php, ranking.php, quiz.php
│   ├── leccion_detalle.php, guest_login.php
│   ├── gatekeeper.php, docs.php
│   ├── ai_tutor.php, coding_challenges.php, lab.php, community.php
│   ├── auth_provider.php, auth_callback.php
│   ├── update_progress.php
│   ├── assets/                   # CSS, JS, images
│   │   ├── css/
│   │   ├── js/
│   │   └── img/
│   ├── api/
│   │   └── ranking.php
│   ├── mapa/                     # Interactive map
│   │   ├── index.php, sistemC.php, updateDB.php
│   │   ├── img/, tilesets/, *.gif, Mapa.json
│   └── Examen/                   # Exam/combat system
│       ├── sistemC.php, 1*.png
│       └── sql/
│
├── src/                          # Server-side code
│   ├── Config/                   # Configuration
│   │   ├── config.php            # DB, OAuth, AI config
│   │   ├── security_headers.php
│   │   ├── csrf.php
│   │   └── challenges.php
│   ├── Core/                     # Core logic
│   │   ├── funciones.php         # AJAX endpoints
│   │   └── cache.php             # Lesson caching
│   ├── Content/                  # Content
│   │   └── content.php          # Lessons array
│   └── Database/                 # SQL dumps
│       ├── lc_advance.sql
│       └── fix_maestros.sql
│
├── scripts/                      # Utility scripts
│   ├── add_performance_indexes.php
│   ├── seed_test_data.php, seed_test_users.php
│   └── test_cache.php
│
├── tests/                        # Test suite
│   ├── run_all_tests.php
│   ├── test_lessons.php, test_integration.php
│   └── test_e2e.php, test_e2e_simple.php
│
├── docs/                         # Documentation
└── AGENTS.md, LICENSE, manifest.webmanifest
```

## Key Files

| File | Purpose |
|------|---------|
| `src/Config/config.php` | DB credentials, OAuth, AI config (env vars preferred) |
| `src/Content/content.php` | Lessons array - edit here to add lessons |
| `src/Core/funciones.php` | AJAX endpoints with rate limiting |
| `src/Database/lc_advance.sql` | Full database dump |

## Environment Variables (Production)

```bash
# Database
export DB_HOST=localhost
export DB_NAME=lc_advance
export DB_USER=root
export DB_PASS=your_password

# AI Backends
export OLLAMA_API_URL=http://localhost:11434/v1
export OLLAMA_MODEL=llama3.2:3b

# OAuth (REQUIRED in production)
export GOOGLE_CLIENT_ID=your-client-id
export GOOGLE_CLIENT_SECRET=your-client-secret
export GITHUB_CLIENT_ID=your-client-id
export GITHUB_CLIENT_SECRET=your-client-secret
export OPENROUTER_API_KEY=your-key

# OAuth Redirect URL (auto-detected or set explicitly)
export AUTH_CALLBACK_URL=http://localhost/LC-Advance/public/auth_callback.php
```

## Testing OAuth Locally

Para probar OAuth en local, puedes hardcodear las credenciales temporalmente en `src/Config/config.php`:

```php
define('GOOGLE_CLIENT_ID', '317866808413-8odsje97n8j7k150j3ag1lr89ughotb7.apps.googleusercontent.com');
define('GOOGLE_CLIENT_SECRET', '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');
define('GITHUB_CLIENT_ID', 'Ov23liR2ex0RxXcrUfAz');
define('GITHUB_CLIENT_SECRET', 'dc8524f64a5a4dff43d8aa1d6e9e7f01d57e968d');
```

**Nota:** No hagas commit de secrets. En producción usa variables de entorno.
- La API key de OpenRouter actual está hardcodeada en `src/Config/config.php` para desarrollo. En producción usar `OPENROUTER_API_KEY` env var.

## Security Features

- **Rate limiting**: 5 failed logins = 5 min lockout; 30 API requests/min
- **OAuth secrets**: NO hardcoded - use env vars
- **Security headers**: X-Content-Type-Options, X-Frame-Options, CSP
- **Session**: Uses `iniciarSesionSegura()`
- **CSRF**: Via `csrfToken()` / `validarCsrfToken()`

## Development Flow

1. Edit lesson in `src/Content/content.php` → dashboard shows it automatically
2. Add new endpoint in `src/Core/funciones.php`
3. Use `requireLogin(true)` for guest-friendly routes
4. Test: `php tests/run_all_tests.php`

## Important Quirks

- **Lesson content**: Use `&lt;?php` (escaped) in HTML
- **slug**: Must be unique per lesson
- **Ranking**: Updates every 15s via `obtener_estado`
- **Lesson CSS**: Individual lesson styles in `public/assets/css/leccion-*.css`
- **AI Tutor**: Use `public/ai_tutor.php` endpoint for AI chat; "Preguntar al Maestro" per-teacher chat at `public/maestro_chat.php?materia=XXX`
- **Maestro Chat**: Each teacher has their own chat with materia-specific context, history stored per-materia in session (`$_SESSION['maestro_chat_'.$materia]`), and a salon image background (`public/assets/img/salon_*.png`)
- **Maestro Chat access**: Via dashboard filter - select a subject/teacher → "Preguntar al Maestro" button appears in the combat card
- **Volume control consistency**: All pages use the same `.header-volume`, `.vol-btn`, `.vol-slider` CSS. If styling differs, check `margin-left: 15px` vs `margin-right: 15px` in `.header-volume` (dashboard uses margin-left, others should match)

## Common Path Issues

- **funciones.php location**: The AJAX endpoint is at `src/Core/funciones.php` (NOT `src/funciones.php`). Always use the full path:
  - From `public/*.php`: `'../src/Core/funciones.php'`
  - From `public/mapa/*.php` or `public/Examen/*.php`: `'../src/Core/funciones.php'`
  - From tests (HTTP): `src/Core/funciones.php`

- **Redirect paths**: Always include `public/` prefix in redirect paths:
  - Correct: `public/dashboard.php`, `public/mapa/index.php`
  - Wrong: `dashboard.php`, `mapa/index.php` (missing `public/` prefix)
  - The `redirigir()` function prepends the app root (e.g., `/LC-Advance/`), so paths must include `public/` when redirecting to pages inside the public folder

- **OAuth redirects**: After Google/GitHub login, users should go to `public/dashboard.php`, not directly to `mapa/index.php`

- **Timeout redirect**: When session expires in `public/mapa/` subfolder, the redirect uses `../login.php?timeout=1` which correctly resolves to `public/login.php?timeout=1`

## Music & Volume System

### Music Files
Located in `public/assets/music/`:

| Section | Music Files | Behavior |
|---------|-------------|----------|
| `public/mapa/` (map) | `cuco_día_alt.mp3`, `cuco_dia.mp3`, `cuco-lost.mp3` | Alternating playback with crossfade |
| `public/quiz.php` (quiz per theme) | `cuco_examen.mp3` | Single track |
| `public/Examen/` (combat system) | `cuco_examen_final.mp3` | Single track |
| Rest of app (login, dashboard, etc.) | `cuco_pantalla_inicio.mp3` | Single track |

### Volume System
- **Storage key**: `'lc_volume_settings'` in localStorage
- **Default values**: `{ principal: 0.1, ambiental: 0.8, examenes: 0.8 }`
- **Volume types**:
  - `principal` - Main menu music
  - `ambiental` - Map background music
  - `examenes` - Quiz/combat music

**Implementation pattern** (used in all pages):
```javascript
const STORAGE_KEY = 'lc_volume_settings';
function getStoredVolumes() {
  const stored = localStorage.getItem(STORAGE_KEY);
  if (stored) return JSON.parse(stored);
  return { principal: 0.1, ambiental: 0.8, examenes: 0.8 };
}
const volumes = getStoredVolumes();
```

**Volume control UI**: Only in `public/mapa/index.php` (lines 178-192) - has three range sliders for all volume types. Other pages read but don't display controls.

## CI Pipeline

- PHP 8.1 + 8.2
- Imports `src/Database/lc_advance.sql`
- Executes `tests/run_all_tests.php`
- PHPLint all PHP files