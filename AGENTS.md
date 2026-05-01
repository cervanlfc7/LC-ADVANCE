# LC-ADVANCE - Agent Instructions

## Run Commands

```bash
# Start local server (XAMPP or PHP built-in)
php -S localhost:8000 -t .

# Run all tests
php tests/run_all_tests.php

# Run single test
php tests/test_lessons.php

# Verify PHP syntax
php -l src/content.php

# Add performance indexes to existing DB
php scripts/add_performance_indexes.php
```

## Key Files

| File | Purpose |
|------|---------|
| `config/config.php` | DB credentials, OAuth, AI config (env vars preferred) |
| `src/content.php` | Lessons array (127000+ lines) |
| `src/funciones.php` | AJAX endpoints with rate limiting |
| `db/lc_advance.sql` | Full database dump with indexes |
| `assets/js/app.js` | Frontend logic |
| `config/security_headers.php` | Security headers (CSP, X-Frame-Options) |

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
```

## Security Features

- **Rate limiting**: 5 failed logins = 5 min lockout; 30 API requests/min
- **OAuth secrets**: NO hardcoded - use env vars
- **Security headers**: X-Content-Type-Options, X-Frame-Options, CSP
- **Session**: Uses `iniciarSesionSegura()`
- **CSRF**: Via `csrfToken()` / `validarCsrfToken()`

## Development Flow

1. Edit lesson in `src/content.php` → dashboard shows it automatically
2. Add new endpoint in `src/funciones.php`
3. Use `requireLogin(true)` for guest-friendly routes
4. Test: `php tests/run_all_tests.php`

## Important Quirks

- **Lesson content**: Use `&lt;?php` (escaped) in HTML
- **slug**: Must be unique per lesson
- **Ranking**: Updates every 15s via `obtener_estado`
- **DB Indexes**: Already in `lc_advance.sql`, script available for existing DB

## Database Indexes

Run `php scripts/add_performance_indexes.php` on existing DB for:
- `user_progress(user_id, slug)`
- `usuarios(puntos DESC)`
- `usuarios(nivel)`

## CI Pipeline

- PHP 8.1 + 8.2
- Imports `db/lc_advance.sql`
- Executes `tests/run_all_tests.php`