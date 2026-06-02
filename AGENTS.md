# LC-ADVANCE — Agent Guide

PHP 8.1+ / MySQL / vanilla JS stack. No framework. XAMPP local dev.

## Entrypoints
- `index.php` — landing page (inline CSS+JS, no framework)
- `public/mapa/index.php` — canvas RPG map (Tiled JSON, localStorage saves)
- `public/dashboard.php` — main app after login
- `src/Config/config.php` — DB/SSO/SMTP config, session helpers, PDO init

## Key commands
```bash
php tests/run_all_tests.php          # full suite
php -l path/to/file.php              # syntax check (CI runs this on all .php)
php -S localhost:8000 -t .           # dev server
mysql -u root -p < db/lc_advance.sql # init DB
```

## Architecture facts
- Lessons live in `src/Content/content.php` as `$lecciones[]` arrays. No DB queries.
- DB config reads env vars `DB_HOST/DB_NAME/DB_USER/DB_PASS` with hardcoded fallbacks.
- Session: call `iniciarSesionSegura()` early, then `requireLogin($allowGuest=true)`.
- Map uses canvas 2D, tile-based collision, sprites per gender (`M_`/`W_` prefix in `public/mapa/`).
- Player position/NPC state persisted via `localStorage` (session-scoped keys).
- `cache/lecciones_compiled.php` — auto-generated JSON cache of lessons array.
- OAuth secrets and SMTP creds are hardcoded in config.php for dev (use env vars in prod).

## Test quirks
- CI imports `db/lc_advance.sql` then runs `scripts/seed_test_data.php`.
- `requireLogin()` redirects if no session — tests must run behind the PHP built-in server.
- No composer autoloader; PHPMailer required manually in `src/Vendor/`.

## Conventions
- All public pages use `require_once __DIR__ . '/../src/Config/config.php'` (mapa uses one more `../`).
- SQL dump is at `db/lc_advance.sql` (single file, includes schema+data).
- No package.json / npm / bundler — all JS is vanilla.
