# AGENTS.md — LC-ADVANCE

## Project

Gamified educational platform for DGETI (Mexican technical high school). PHP 8.1+ / MySQL 5.7+ / Vanilla JS. No framework, no autoloader. Composer only for PHPMailer (vendored at `src/Vendor/PHPMailer-6.9.1/`) and DomPDF.

## Commands

```bash
php -S localhost:8000 -t .                                           # dev server
php tests/run_all_tests.php                                          # all tests
php tests/test_lessons.php                                           # single test
php -l path/to/file.php                                              # lint
```

CI (`.github/workflows/ci.yml`): PHPLint all files → import SQL → seed → start server → run tests.

## Key files & directories

| Path | Purpose |
|------|---------|
| `public/` | All page files (login, register, dashboard, admin/, etc.) |
| `src/Config/config.php` | **Single config file** — imports by every page. DB, OAuth, SMTP, AI providers, session init, CSRF `csrfToken()`/`validarCsrfToken()`, lesson cache `compileLecciones()`, helpers `appRootPath()`, `assetUrl()`, `enviarEmail()`, auto-migrations. |
| `src/Config/csrf.php` | CSRF helpers (`campoTokenCSRF()`, `validarTokenCSRF()`) — used by older pages. Use `csrfToken()`/`validarCsrfToken()` from config for new code. |
| `src/Content/content.php` | ~1 KB loader: `require`s 9 per-subject files from `src/Content/lessons/` |
| `src/Content/lessons/` | 9 subject PHP files returning `$lecciones[]` entries with `materia`, `slug`, `titulo`, `icon`, `contenido`, `quiz` |
| `src/Core/funciones.php` | Single AJAX handler (POST only). Actions: `calificar_quiz`, `obtener_estado`, `completar`, `calificar_examen_final`, `reclamar_mision`, etc. CSRF-protected write actions. Rate limited (30 req/min). Returns JSON. |
| `src/Core/admin.php` | Admin helpers: `requireAdmin()` (role check + IP allowlisting + rate limit + 2FA), `obtenerStatsAdmin()`, CRUD for users/quizzes/settings. |
| `src/Core/block_renderer.php` | `renderBlocks($json)` — server-side block → HTML. `htmlToBlocks($html)` — legacy HTML → block array. |
| `src/Core/logros.php` | `verificarLogros($user_id, $pdo)` — checks & auto-awards 22 badges. |
| `src/Core/rachas.php` | `actualizarRacha($user_id, $pdo)` — streak tracking + bonus XP + protector system. |
| `src/Templates/page_start.php`/`page_end.php` | Shared template wrapper. Set `$page_title`, `$page_extra_head`, `$page_volume`, `$page_show_bg_orb`, etc. before requiring. |
| `src/Database/lc_advance.sql` | **Single DB dump** (CI YAML says `db/lc_advance.sql` — that path doesn't exist; CI only runs on main branch and fails gracefully). |
| `cache/lecciones_compiled.php` | Auto-generated JSON cache of `$lecciones` (keyed by file mtime from `compileLecciones()`). Delete to force rebuild. |
| `scripts/` | Utility scripts: `seed_test_data.php`, `seed_credenciales.php`, `split_lessons.php`, `minify.php`, `run_migration.php`, etc. |
| `public/admin/builder.php` | **Block-based lesson editor** — the main file you'll work on. |

## Admin Builder (`public/admin/builder.php`)

The block-based visual editor with these known gaps:

1. **`#inlineElementPanel` has CSS/HTML but no JS** — `renderProps()` at line 441 only shows block-level props (Fondo/Color/Alineación/Padding) in `#propsPanel`. The `#inlineElementPanel` (line 156, shown when `activeInlineEl` is set) is never populated. `activeInlineEl` is declared (line 286) and reset in `render()` but never assigned. To fix: when a user clicks an inline element inside a block (e.g., a heading text), detect the exact element (`inlineElementPanel` section lines 156-157), and populate style controls for that specific element (font size, bold, italic, color, etc.).

2. **No drag-and-drop** — blocks are added/sorted via palette clicks + ▲▼ buttons. Need HTML5 drag-and-drop: `draggable="true"` on blocks, `dragstart`/`dragover`/`drop` handlers to reorder `blocks[]`.

3. **Chat not resizable** — `.builder-chat` has `max-height:280px` (line 171). Add a resize handle (drag gripper) that adjusts max-height via mousedown/mousemove.

4. **AI assistant can't insert content** — `enviarChat()` (line 760) sends prompt + `blocks_json` to server AI handler (line 49-94 in PHP). Response is displayed as chat text only. The AI response should include `insertBlocks` or `insertHtml` so a button can insert suggested content into the canvas.

## Content dual-path

- **File-based (legacy):** `$lecciones` array in `src/Content/lessons/*.php`. Lesson content accessed via `buscarLeccion($slug)`.
- **DB-based (builder):** `lecciones_contenido` table stores JSON (blocks) or raw HTML per `slug`. `obtenerContenidoLeccion($pdo, $slug)` returns DB content if exists, else falls back to file.
- **Quiz can also be DB-driven:** `quiz_questions` table overrides file-based quiz when populated. `obtenerQuizParaLeccion($pdo, $slug, $leccion)` checks DB first.

## Config precedence

Env var → DB `credenciales` table → hardcoded default. For OAuth, prod/dev credentials auto-selected based on callback URL. Create `.env` from `.env.example` for local overrides.

## Auto-migrations

`inicializarMigraciones($pdo)` in config.php runs on every page load — adds columns, creates tables (`settings`, `announcements`, `quiz_questions`, `lecciones_contenido`, `password_resets`, `security_logs`, `group_lecciones`, etc.) if missing. Idempotent.

## CSRF pattern

- `$_SESSION['csrf_token']` set by `iniciarSesionSegura()`.
- `<meta name="csrf-token" content="...">` in `page_start.php`.
- Forms: add `<input type="hidden" name="csrf_token" value="<?= csrfToken() ?>">`.
- AJAX POST: `validarCsrfToken($_POST['csrf_token'])` for write actions.
- `funciones.php` line 30 defines `$csrf_write_actions` — add new write actions to this list.

## Templates

- `page_start.php` — open `<!DOCTYPE html>` ... `<body>`, admin breadcrumbs, CSRF meta, theme detection, service worker.
- `page_end.php` — close `</body></html>`, optional volume control, logout interceptor (POST via CSRF), admin form spinner.
- Set vars before requiring: `$page_title`, `$page_extra_head`, `$page_volume` (array), `$page_show_bg_orb`, `$page_inline_css`.

## Testing quirks

- Need running PHP server (`php -S ...`). Tests SKIP (not FAIL) if unreachable.
- Uses `TEST_BASE_URL` env var (default `http://127.0.0.1:80`).
- Cookie jars for session persistence.
- `scripts/seed_test_data.php` creates default test user.

## Security notes

- `DEBUG_MODE=false` by default. Set `true` only for local dev.
- `requireAdmin()` checks: role === 'admin', optional `ADMIN_ALLOWED_IPS` env var, rate limit (120/min), 2FA OTP check.
- `security_headers.php` applies CSP + HSTS + X-Frame-Options when `DEBUG_MODE=false`.
- `.htaccess` disables directory listing, sets security headers, long cache for static assets.
- Write actions require CSRF token. Add new forms' CSRF input.

## Asset pipeline

- `assetUrl($path)` (config.php:242) — prefers `.min.*` version, appends `?v=md5_hash` for cache busting.
- `scripts/minify.php` — minifies JS/CSS using UglifyJS/CleanCSS if available, fallback PHP minifier.

## One-time password (OTP) / 2FA

- `twofa_enabled` + `twofa_secret` columns in `usuarios` table.
- `verify_2fa.php`, `setup_2fa.php`, `qr.php`, `disable_2fa.php` in `public/admin/`.
- TOTP verification in `admin.php` (`verify_totp()`).
- OTP for login in `login.php` (also used for password reset verification via email).
