# LC-ADVANCE — Agent Instructions

## Run Commands

```bash
php -S localhost:8000 -t .                     # Dev server (doc root = project root)
php tests/run_all_tests.php                     # Full suite (separate PHP process per test)
php tests/test_lessons.php                      # Quick lesson structure check
php tests/test_integration.php                  # Endpoint smoke tests (needs server running)
php tests/test_unit_config.php                  # Config constants + math validation
php tests/test_e2e_simple.php                   # Public page E2E (needs server + DB)
php -l <file>.php                               # PHP lint (CI runs on all *.php files)
php scripts/add_performance_indexes.php         # DB optimization indexes
mysql -u root < src/Database/lc_advance.sql     # Rebuild DB
```

CI expects `TEST_BASE_URL=http://127.0.0.1:8000/` and MySQL at `127.0.0.1:3306` user `root` pass `root`.

## Entry Point & Initialization

- **Main entry point**: `index.php` (project root) handles frontend routing, language detection, and base URL calculation
- **Initialization flow**: 
  1. Loads `src/Config/config.php` (DB, OAuth, AI config)
  2. Calls `iniciarSesionSegura()` (session management with 30-min timeout)
  3. Sets `$baseUrl` from `dirname($_SERVER['SCRIPT_NAME'])` for proper asset/link routing
  4. Loads language translations (`$t` array) from session or defaults to 'es'
  5. **Note**: `src/Core/funciones.php` is NOT loaded in index.php - it's loaded individually by pages that need AJAX endpoints

## Path Conventions (gotchas)

- **funciones.php**: Always `src/Core/funciones.php` (NOT `src/funciones.php`)
  - From `public/*.php`: `require_once '../src/Core/funciones.php'`
  - From `public/mapa/*` or `public/Examen/*`: `require_once '../../src/Core/funciones.php'`
- **Redirects**: Must include `public/` prefix, e.g. `redirigir('public/dashboard.php')`
- **Login redirect**: After login → `public/mapa/index.php` (game map), not dashboard
- **Dashboard guard**: No `selected_materia` in session → redirects to `index.php?seleccionar_materia=1`
- **Timeout redirect** from `public/mapa/`: `../login.php?timeout=1` (resolves to `public/login.php`)
- **Footer links in index.php**: Must use `$baseUrl` prefix like other site links
  - Logged-in user links: 
    - `<a href="<?= $baseUrl ?>/public/mapa/index.php">Mapa Interactivo</a>`
    - `<a href="<?= $baseUrl ?>/public/dashboard.php">Dashboard</a>`
    - `<a href="<?= $baseUrl ?>/public/ranking.php">Ranking Global</a>`
  - Guest user links:
    - `<a href="<?= $baseUrl ?>/public/gatekeeper.php?redirect=mapa/index.php">Mapa Interactivo</a>`
    - `<a href="<?= $baseUrl ?>/public/gatekeeper.php?redirect=dashboard.php">Dashboard</a>`
    - `<a href="<?= $baseUrl ?>/public/gatekeeper.php?redirect=ranking.php">Ranking Global</a>`
  - Missing `$baseUrl` causes broken links when site is not at document root
- **Lab dashboard button**: Must preserve current filters when returning to dashboard
  - Use `$return_params` built from both `profesor` and `materia` GET parameters
  - Fix: Build params array and implode with '&' to support both parameters
  - Example: `dashboard.php?profesor=Herson&materia=Física I`
- **Dashboard access requires materia selection**: 
  - All dashboard access points (index.php buttons, lab.php button, etc.) must require materia selection
  - Enforced in dashboard.php: if no `selected_materia` in session AND no `profesor` in GET → redirect to `index.php?seleccionar_materia=1`
  - Do not bypass this check by linking directly to dashboard.php without parameters

## Key Files

| File                              | Purpose                                                                |
| --------------------------------- | ---------------------------------------------------------------------- |
| `src/Config/config.php`           | DB, OAuth, AI config (env vars in prod, hardcoded dev fallbacks)       |
| `src/Content/content.php`         | Lessons array (127K, ~200+ lessons) — add or edit here                 |
| `src/Core/funciones.php`          | AJAX endpoints with rate limiting                                      |
| `src/Config/challenges.php`       | Lab coding challenges array                                            |
| `public/lab.php`                  | Lab: code challenges + Wolfram calculator (139KB, all inline CSS/JS)   |
| `public/ai_tutor.php`             | AI tutor endpoint (OpenRouter free model router → LM Studio → offline) |
| `public/leccion_detalle.php`      | Lesson viewer + quiz + AI chat widget (all inline CSS/JS)              |
| `src/Database/lc_advance.sql`     | Full database dump                                                     |
| `public/assets/css/style.css`     | Global retro-pixel theme (2253KB, includes embedded assets)            |
| `public/assets/css/dashboard.css` | Dashboard-specific dark theme (2119 lines)                             |

## AI API Architecture

**Chain of providers** (in `public/ai_tutor.php`):

1. `openrouter/free` — auto-router to best free model on OpenRouter (no cost)
2. 2nd/3rd fallback models: `gemma-2-9b-it:free`, `phi-3-mini:free`
3. LM Studio at `http://localhost:1234/v1` (local, requires LM Studio running)
4. `localFallbackAnswer()` — hardcoded offline mode (⚠️ "Sin conexión al servicio de IA")

**Config** (`src/Config/config.php`):

- `OPENROUTER_API_KEY` — env var, fallback to hardcoded dev key
- `OPENROUTER_MODEL` = `openrouter/free`
- `OPENROUTER_FALLBACK_MODELS` = array of 3 models tried in sequence
- Rate limits on OpenRouter free tier: 20 req/min, 200 req/day

**Frontend fetch calls** all use relative URL `ai_tutor.php` with `provider=auto`, POST with `application/x-www-form-urlencoded`.

## LC-ADVANCE CSS Architecture (must follow)

Every page defines its own CSS variables in a `<style>` block. The **canonical variable set** (from `lab.php`, `leccion_detalle.php`, `dashboard.css`):

```css
:root {
  --bg: #060a12;
  --surface: #0c1220;
  --surface2: #101828;
  --border: rgba(0, 230, 255, 0.12);
  --border2: rgba(0, 230, 255, 0.22);
  --cyan: #00e5ff;
  --cyan-dim: rgba(0, 229, 255, 0.12);
  --pink: #ff3cac;
  --green: #00ff87;
  --yellow: #ffd23f;
  --red: #ff4d6d;
  --text: #e8f4ff;
  --text-secondary: rgba(200, 230, 255, 0.75);
  --muted: rgba(200, 230, 255, 0.5);
  --font-display: "Syne", sans-serif;
  --font-body: "Space Grotesk", sans-serif;
  --font-mono: "JetBrains Mono", monospace;
  --transition: all 0.22s ease;
  --radius: 12px;
}
```

**Rules:**

- Always use `var(--cyan)` for accent, `var(--pink)` as secondary, `var(--green)` for success
- Gradients: `linear-gradient(135deg, var(--cyan), var(--pink))` for primary buttons
- Hover: `var(--cyan-dim)` background, `var(--cyan)` border/text color
- Cards: `background: var(--surface2); border: 1px solid var(--border); border-radius: var(--radius)`
- Inputs: `background: var(--surface2); border: 1px solid var(--border2); color: var(--text)`
- NEVEr use hardcoded light-theme colors (#fff, #ddd, #333, #aaa, etc.) — use CSS variables
- Grid background: always the `.grid-bg` pattern with `rgba(0,229,255,0.025)` lines
- Animated orbs: `.bg-orb` with `filter: blur(90px)` and cyan/pink radial gradients

**Style delivery**: CSS is NOT modular — each page embeds its own `<style>` block with the variable set included. The global `style.css` (retro-pixel theme) loads alongside but the dark-cyber grid theme in each page overrides it.

## Wolfram Calculator (`public/lab.php:484+`)

- **6 mode tabs**: Matemáticas, Física, Química, Ecosistemas, Programación, IA General
- **Local solvers** dispatch via `tryLocalSolvers()` using `math.js` (derivatives, integrals, quadratic, limits, physics formulas, chemistry, biology)
- **AI fallback**: When local solver fails → fetch to `ai_tutor.php` → renders via `marked.parse()` + KaTeX `$$...$$`
- **State machine**: `wolframMode` tracks tab; adding a solver = add to `wolframExamples`, `wolframKeyboardKeys`, and `tryLocalSolvers()`
- **Virtual keyboard**: per-mode toolbar (`waToolbarDefs`), inserts at cursor via `waInsert()`
- **WA-style input**: `.wa-input-box` — hidden text input + KaTeX render display + cursor blink

## JS/LaTeX Brace Collision

Never use literal `{` or `}` in JS template literals containing LaTeX. Use concatenation:

```js
// BAD: `T = 2\\pi\\sqrt{\frac{${L}}{${g}}}`
// GOOD: 'T = 2π√(L/g) = ' + periodStr + ' s'
```

## CI Pipeline (`.github/workflows/ci.yml`)

- PHP 8.1 + 8.2 matrix, MySQL 5.7 service
- PHPLint all `*.php` files (excludes vendor/, cache/, tests/tmp/)
- Imports `db/lc_advance.sql` or `src/Database/lc_advance.sql`, seeds via `scripts/seed_test_data.php`
- Starts PHP built-in server on port 8000 with `-t .` (doc root = project root)
- Runs `php tests/run_all_tests.php` with `TEST_BASE_URL=http://127.0.0.1:8000/`

## Security Features

- Rate limiting: 5 failed logins → 5 min lockout; 30 API requests/min in `src/Core/funciones.php`
- OAuth: Google + GitHub (credentials in env vars, dev fallbacks in `config.php:168-176`)
- Security headers via `src/Config/security_headers.php` (only in production, not DEBUG_MODE)
- Session via `iniciarSesionSegura()` (30 min timeout, CSRF tokens via `csrfToken()`/`validarCsrfToken()`)
- Guest-accessible routes use `requireLogin(true)` — redirects to login if not guest

## Content Editing

- **Lessons** (`src/Content/content.php`): each needs unique `slug`. Use `&lt;?php` (escaped) for PHP in lesson HTML.
- **Challenges** (`src/Config/challenges.php`): each needs unique key. Types: `code`, `math`, `physics`, `chemistry`, `simulation`, `calculator`. Code challenges use `solve()` function pattern.
