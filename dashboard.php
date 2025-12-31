<?php
// ==========================================
// LC-ADVANCE - dashboard.php (VERSIÓN FINAL CON DISTINCIÓN MANUEL/MEZA)
// ==========================================

require_once 'config/config.php';
requireLogin(true); // permite también invitados
require_once 'src/content.php';

// ------------------ AUTENTICACIÓN Y CONTEXTO DE MATERIA ------------------
// Requerimos que el usuario tenga una materia seleccionada para ver el dashboard completo
$filter_materia = requireMateriaContext();


// ------------------ USUARIO ------------------
if (!empty($_SESSION['usuario_es_invitado'])) {
    $usuario = [
        'id' => 0,
        'nombre_usuario' => $_SESSION['usuario_nombre'] ?? 'Invitado',
        'puntos' => $_SESSION['usuario_puntos'] ?? 0,
        'nivel' => $_SESSION['usuario_nivel'] ?? 1,
        'avatar' => 'default.png'
    ];
} else {
    $stmt = $pdo->prepare("SELECT id, nombre_usuario, puntos, nivel FROM usuarios WHERE id = ?");
    $stmt->execute([(int)($_SESSION['usuario_id'] ?? 0)]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$usuario) {
        // Si no existe usuario en sesión, redirigimos a login por seguridad
        session_destroy();
        header('Location: login.php');
        exit;
    }
}

// ------------------ PROGRESO ------------------
$puntos_por_nivel = 500;
$puntos_necesarios = ($usuario['nivel'] + 1) * $puntos_por_nivel;
$puntos_base = $usuario['nivel'] * $puntos_por_nivel;
$progreso = max(0, min(100, (($usuario['puntos'] - $puntos_base) / $puntos_por_nivel) * 100));

// ------------------ BADGES ------------------
$badges = [];
if ($usuario['puntos'] >= 500) $badges[] = ['nombre'=>'Nivel 1: Novato','tipo'=>'bronze'];
if ($usuario['puntos'] >= 1000) $badges[] = ['nombre'=>'Nivel 2: Explorador','tipo'=>'silver'];
if ($usuario['puntos'] >= 2000) $badges[] = ['nombre'=>'Nivel 3: Élite','tipo'=>'gold'];

$filter_profesor  = empty($filter_materia) && isset($_GET['profesor']) ? trim($_GET['profesor']) : null;
$filter_materias  = [];
$highlight_materia = null;

// Inicializaciones necesarias para filtros y agrupación de lecciones
$lecciones_agrupadas = [];
$materias_disponibles = []; // usada por el filtro por profesor más abajo (evita warnings)

// Agrupar lecciones por materia. Evitar duplicados por 'slug' y por título dentro de la misma materia.
$seen_slugs = [];
$seen_titles = [];
foreach ($lecciones as $le) {
    $slug = $le['slug'] ?? null;
    if ($slug !== null) {
        if (isset($seen_slugs[$slug])) continue; // ya agregado por slug
        $seen_slugs[$slug] = true;
    }

    $m = $le['materia'] ?? 'Sin Materia';
    $titulo_norm = norm($le['titulo'] ?? '');
    if (isset($seen_titles[$m][$titulo_norm])) continue; // ya agregado por título en la misma materia
    $seen_titles[$m][$titulo_norm] = true;

    $materias_disponibles[] = $m;
    $lecciones_agrupadas[$m][] = $le;
}
$materias_disponibles = array_unique($materias_disponibles); 

// ---- MAPEO PROFESOR -> MATERIAS ----
$profesor_materia_map = [
    'Miguel Marquez' => ['Temas Selectos de Matemáticas I y II'],
    'Enrique' => ['Inglés'],
    'Espindola' => ['Pensamiento Matemático III'],
    'Manuel' => ['Programación'],
    'Meza' => ['Programación'],
    'Herson' => ['Física','Química'],
    'Carolina' => ['Ecosistemas'],
    'Refugio & Padilla' => ['Ciencias Sociales'],
    'Armando' => ['Historia']
];

// ==================== MAPEO MATERIA → ID PROFESOR (por defecto) ====================
$materia_a_profesor_id = [
    'Temas Selectos de Matemáticas I y II' => '1Le',   // Miguel Márquez
    'Inglés'                                      => '1Go',   // Enrique
    'Pensamiento Matemático III'                  => '1Es',   // Espindola
    'Programación'                                => '1Ma',   // Manuel por defecto
    'Física'                                      => '1He',   // Herson
    'Química'                                     => '1He',   // Herson
    'Ecosistemas'                                 => '1Ca',   // Carolina
    'Ciencias Sociales'                           => '1Pa',   // Refugio & Padilla
    'Historia'                                    => '1Ar',   // Armando
];

// ==================== MAPEO DIRECTO PROFESOR → ID (prioridad máxima) ====================
$profesor_a_id = [
    'Miguel Marquez'    => '1Le',
    'Enrique'           => '1Go',
    'Espindola'         => '1Es',
    'Manuel'            => '1Ma',
    'Meza'              => '1Me',  // ¡Distinción clave!
    'Herson'            => '1He',
    'Carolina'          => '1Ca',
    'Refugio & Padilla' => '1Pa',
    'Armando'           => '1Ar'
];

function norm($s){
    return mb_strtolower(trim(strtr($s,[
        'á'=>'a','é'=>'e','í'=>'i','ó'=>'o','ú'=>'u','ñ'=>'n','&'=>'y'
    ])), 'UTF-8');
}

// ---- FILTRO DIRECTO POR MATERIA ----
if ($filter_materia) {
    $filter_materias[] = $filter_materia;
    $highlight_materia = $filter_materia;
}

// ---- FILTRO POR PROFESOR ----
elseif ($filter_profesor) {
    $nf = norm($filter_profesor);
    foreach ($profesor_materia_map as $prof => $mats) {
        $np = norm($prof);
        if ($np === $nf || strpos($np, $nf) !== false || strpos($nf, $np) !== false) {
            foreach ($mats as $mat) {
                foreach ($materias_disponibles as $real) {
                    if (norm($real) === norm($mat) || str_contains(norm($real), norm($mat))) {
                        $filter_materias[] = $real;
                    }
                }
            }
            break;
        }
    }
    $filter_materias = array_unique($filter_materias);
    $highlight_materia = $filter_materias[0] ?? null;
}

// ---- APLICAR FILTRO ----
if ($filter_materias) {
    $lecciones_agrupadas = array_filter(
        $lecciones_agrupadas,
        fn($k)=> in_array(norm($k), array_map('norm',$filter_materias)),
        ARRAY_FILTER_USE_KEY
    );
}

// ------------------ PROGRESO LECCIONES ------------------
$completadas = $_SESSION['completadas'] ?? [];

if (empty($_SESSION['usuario_es_invitado'])) {
    try {
        $stmt = $pdo->prepare("SELECT slug FROM user_progress WHERE user_id=? AND completed=1");
        $stmt->execute([$usuario['id']]);
        $completadas = $stmt->fetchAll(PDO::FETCH_COLUMN);
    } catch(Exception $e){}
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DASHBOARD | LC-ADVANCE</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
</head>
<body>

<header class="header">
    <h1>LC-ADVANCE <span style="color: #00ff00;">// ACCESS: ONLINE</span></h1>
    <?php
        $ranking_href = 'ranking.php';
        if (!empty($filter_materia)) $ranking_href .= '?materia=' . urlencode($filter_materia);
    ?>
    <nav>
        <a href="index.php" class="btn btn-dashboard">🏠 Inicio</a>
        <a href="mapa/index.html" class="btn btn-dashboard">🎮 Ir al Mapa</a>
        <a href="<?php echo $ranking_href; ?>" class="btn btn-dashboard">🏆 Ranking</a>
        <a href="#" id="goToLessonsBtn" class="btn btn-dashboard">📚 Ir a Lección</a>
        <a href="logout.php" class="btn btn-logout">🚪 SALIR</a>
    </nav>
</header>

<div class="container">
    <div class="dashboard-container">
    
        <h1 class="auth-title">💻 PANEL DE JUGADOR</h1>
        
        <div class="ranking-floating" id="ranking-floating">
            <h3>🔝 TOP 10</h3>
            <div class="ranking-scroll-area">
                <table class="ranking-table">
                    <thead>
                        <tr><th>#</th><th>JUGADOR</th><th>PUNTOS</th></tr>
                    </thead>
                    <tbody id="ranking-body"></tbody>
                </table>
            </div>
        </div>
        <div class="profile-summary"> 
            <h2 class="profile-name">¡Bienvenido, <span class="username-glow"><?php echo htmlspecialchars($usuario['nombre_usuario']); ?></span>!</h2>
            
            <div class="stats-grid">
                <div class="stat-card level-card">
                    <h4>NIVEL ACTUAL</h4>
                    <span class="big-stat user-nivel" id="nivel-actual"><?php echo $usuario['nivel']; ?></span>
                </div>
                <div class="stat-card points-card">
                    <h4>PUNTOS (XP)</h4>
                    <span class="big-stat" id="puntos-actuales"><?php echo $usuario['puntos']; ?></span>
                </div>
            </div>

            <div class="progress-section">
                <h3>PROGRESO AL NIVEL <span id="nivel-siguiente"><?php echo $usuario['nivel'] + 1; ?></span></h3>
                <div class="progress-bar">
                    <div id="progress-fill" class="progress-fill" style="width: <?php echo $progreso; ?>%;"></div>
                </div>
                <p class="progress-info">
                    <span id="puntos-actuales-mini"><?php echo $usuario['puntos']; ?></span> / 
                    <span id="puntos-necesarios"><?php echo $puntos_necesarios; ?></span> PUNTOS REQUERIDOS
                </p>
                
                <div class="badges-section">
                    <h3>🏆 INSIGNIAS OBTENIDAS</h3>
                    <div id="badges-container" class="badges-list">
                        <?php if (empty($badges)): ?>
                            <p class="text-muted">¡Completa lecciones para obtener tu primer Badge (500 pts)!</p>
                        <?php else: ?>
                            <?php foreach ($badges as $b): ?>
                                <span class="badge <?php echo $b['tipo']; ?>"><?php echo $b['nombre']; ?></span>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>

            </div>
            </div>
            <div class="lessons-area">
                <h3>📖 MÓDULOS DE ESTUDIO DISPONIBLES</h3>
                <?php if (empty($lecciones_agrupadas)): ?>
                    <p class="text-muted">No hay lecciones disponibles. Asegúrate de agregar lecciones en content.php para las materias mapeadas.</p>
                <?php else: ?>
                    <?php foreach ($lecciones_agrupadas as $materia => $temas): ?>
                        <div class="materia-group mb-4" id="materia-<?php echo urlencode($materia); ?>"> 
                            <h4 class="materia-title"><?php echo htmlspecialchars($materia); ?></h4>
                            <div class="leccion-list">
                                <?php foreach ($temas as $tema): 
                                    $es_completada = in_array($tema['slug'], $completadas);
                                    // Siempre añadimos la materia al enlace de la lección para preservar el contexto al volver
                                    $leccion_href = 'leccion_detalle.php?slug=' . urlencode($tema['slug']) . '&materia=' . urlencode($materia);
                                    // Si el dashboard está filtrado por profesor (ej. ?profesor=Herson), pasar ese parámetro para preservar el filtro al volver
                                    if (!empty($filter_profesor)) {
                                        $leccion_href .= '&profesor=' . urlencode($filter_profesor);
                                    }
                                ?>
                                    <div class="leccion-item <?php echo $es_completada ? 'leccion-completed' : 'leccion-pending'; ?>">
                                        <span class="leccion-status">
                                            <?php echo $es_completada ? '✅' : '▶️'; ?> 
                                        </span>
                                        <span class="leccion-name">
                                            <?php echo htmlspecialchars($tema['titulo']); ?>
                                        </span>
                                        <div class="leccion-actions">
                                            <a href="<?php echo $leccion_href; ?>" 
                                                class="btn btn-small <?php echo $es_completada ? 'btn-repeat' : 'btn-play'; ?>">
                                                <?php echo $es_completada ? 'REPETIR' : 'JUGAR'; ?>
                                            </a>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

        <!-- Bloque duplicado de lecciones eliminado intencionalmente: la lista de módulos se muestra una sola vez arriba -->
    </div>
</div>

<!-- Modal: Ir a Lección -->
<div id="lessons-modal" class="lessons-modal" aria-hidden="true" role="dialog" aria-labelledby="lessons-modal-title">
  <div class="modal-backdrop" id="lessons-backdrop"></div>
  <div class="modal-content" role="document">
    <button class="modal-close btn btn-guest" id="lessons-close">✖</button>
    <h2 id="lessons-modal-title">📚 Ir a Lección</h2>
    <div class="modal-controls">
      <input type="search" id="lessons-search" placeholder="Buscar lección o materia..." aria-label="Buscar lección">
    </div>
    <div class="lessons-list" id="lessons-list" aria-live="polite"></div>
  </div>
</div>

<script>
  const ALL_LECCIONES = <?php echo json_encode($lecciones, JSON_HEX_TAG|JSON_HEX_AMP|JSON_HEX_APOS|JSON_HEX_QUOT); ?>;
  const CURRENT_MATERIA = <?php echo json_encode($filter_materia); ?>;
  const CURRENT_PROFESOR = <?php echo json_encode($filter_profesor); ?>;
  const COMPLETED_SLUGS = <?php echo json_encode(array_values($completadas ?? []), JSON_HEX_TAG|JSON_HEX_AMP|JSON_HEX_APOS|JSON_HEX_QUOT); ?>;
  const PROFESOR_MAP = <?php echo json_encode($profesor_materia_map ?? [], JSON_HEX_TAG|JSON_HEX_AMP|JSON_HEX_APOS|JSON_HEX_QUOT); ?>;

  (function(){
    function openModal(){ document.getElementById('lessons-modal').classList.add('open'); document.getElementById('lessons-modal').setAttribute('aria-hidden','false'); document.getElementById('lessons-search').focus(); }
    function closeModal(){ document.getElementById('lessons-modal').classList.remove('open'); document.getElementById('lessons-modal').setAttribute('aria-hidden','true'); }
    document.getElementById('goToLessonsBtn')?.addEventListener('click', function(e){ e.preventDefault(); openModal(); });

    document.getElementById('lessons-close')?.addEventListener('click', closeModal);
    document.getElementById('lessons-backdrop')?.addEventListener('click', closeModal);
    document.addEventListener('keydown', function(e){ if(e.key === 'Escape') closeModal(); });

    const listEl = document.getElementById('lessons-list');
    const search = document.getElementById('lessons-search');

    function norm(s){ return (s||'').toString().toLowerCase().trim(); }

    function getAllowedMateriasFromProfesor(prof){
      if(!prof) return null;
      const nf = norm(prof);
      for(const k in PROFESOR_MAP){
        if(norm(k) === nf || norm(k).indexOf(nf)!==-1 || nf.indexOf(norm(k))!==-1){
          return PROFESOR_MAP[k] || [];
        }
      }
      return null;
    }

    function renderList(filterText=''){
      const q = (filterText||'').toLowerCase().trim();
      const currentMat = norm(CURRENT_MATERIA);
      const currentProf = CURRENT_PROFESOR ? CURRENT_PROFESOR.toString() : null;
      const allowedMateriasFromProf = getAllowedMateriasFromProfesor(currentProf);

      const items = ALL_LECCIONES
        .filter(l => {
          const hay = (l.titulo || l.titulo_corto || '').toString().toLowerCase();
          const mat = (l.materia || '').toString().toLowerCase();

          // Si hay una materia activa, sólo mostrar lecciones de esa materia
          if (currentMat && mat.indexOf(currentMat) === -1) return false;

          // Si hay un profesor activo, limitar a las materias mapeadas a ese profesor
          if (allowedMateriasFromProf && !allowedMateriasFromProf.some(am => mat.indexOf(am.toString().toLowerCase()) !== -1)) return false;

          // Filtro de búsqueda (por título o materia)
          return !q || hay.indexOf(q) !== -1 || mat.indexOf(q) !== -1;
        })
        .slice(0,250);

      if(!items.length){ listEl.innerHTML = '<p class="text-muted">No se encontraron lecciones.</p>'; return; }

      // Nota de filtro por materia o profesor si aplica
      const headerParts = [];
      if (CURRENT_MATERIA) headerParts.push(`Mostrando lecciones para: <strong>${escapeHtml(CURRENT_MATERIA)}</strong>`);
      if (CURRENT_PROFESOR) headerParts.push(`Filtrado por profesor: <strong>${escapeHtml(CURRENT_PROFESOR)}</strong>`);
      const header = headerParts.length ? `<div class="lessons-filter-note">${headerParts.join(' • ')}</div>` : '';

      listEl.innerHTML = header + items.map(l=>{
        const slugVal = l.slug || '';
        const slug = encodeURIComponent(slugVal);
        const isCompleted = COMPLETED_SLUGS.includes(slugVal);
        const statusIcon = isCompleted ? '✅' : '▶️';
        const materiaParam = CURRENT_MATERIA ? '&materia=' + encodeURIComponent(CURRENT_MATERIA) : '&materia=' + encodeURIComponent(l.materia || '');
        const profesorParam = CURRENT_PROFESOR ? '&profesor=' + encodeURIComponent(CURRENT_PROFESOR) : '';
        const href = 'leccion_detalle.php?slug=' + slug + materiaParam + profesorParam;
        return `<a class="lesson-link" href="${href}"><span class="lesson-left"><span class="lesson-status" aria-hidden="true">${statusIcon}</span><strong>${escapeHtml(l.titulo || l.titulo_corto || l.slug)}</strong></span><span class="lesson-meta">${escapeHtml(l.materia || '')}</span></a>`;
      }).join('');
    }

    function escapeHtml(s){ return String(s).replace(/[&<>\"']/g, function(c){return {'&':'&amp;','<':'&lt;','>':'&gt;','\"':'&quot;',"'":'&#39;'}[c]; }); }

    search.addEventListener('input', function(){ renderList(this.value); });

    // Inicializar
    renderList('');
  })();
</script>

<button id="scrollToTopBtn" class="scroll-to-top-btn" title="Ir arriba">
    <span class="arrow-up">▲</span>
</button>

<!-- ==================== BOTONES DE EXAMEN CON ID CORRECTO ==================== -->
<?php if ($filter_materia || !empty($filter_materias)): ?>
    <?php
    $id_profesor_final = '1Cu'; // fallback

    // Prioridad 1: Filtro por profesor directo
    if ($filter_profesor) {
        $nf = norm($filter_profesor);
        foreach ($profesor_a_id as $prof => $id) {
            if (norm($prof) === $nf || strpos(norm($prof), $nf) !== false || strpos($nf, norm($prof)) !== false) {
                $id_profesor_final = $id;
                break;
            }
        }
    }
    // Prioridad 2: Filtro por materia
    else {
        $materia_usada = $filter_materia ?: ($filter_materias[0] ?? '');
        $materia_norm = norm($materia_usada);
        foreach ($materia_a_profesor_id as $mat_map => $id) {
            if (norm($mat_map) === $materia_norm || str_contains($materia_norm, norm($mat_map))) {
                $id_profesor_final = $id;
                break;
            }
        }
    }
    ?>

    <div class="exam-cta" style="margin-top:18px; text-align:center;">
        <?php if ($filter_materia): ?>
            <a href="Examen/sistemC.php?personaje=<?= $id_profesor_final ?>&dialogo=1&pregunta=0" 
               class="btn btn-exam">
                📝 Ir al Examen de <?= htmlspecialchars($filter_materia) ?>
            </a>
        <?php endif; ?>

        <?php if (!empty($filter_materias) && empty($filter_materia)): ?>
            <?php foreach ($filter_materias as $fm): ?>
                <?php
                $materia_norm = norm($fm);
                $id_temp = '1Cu';
                foreach ($materia_a_profesor_id as $mat_map => $id) {
                    if (norm($mat_map) === $materia_norm || str_contains($materia_norm, norm($mat_map))) {
                        $id_temp = $id;
                        break;
                    }
                }
                ?>
                <a href="Examen/sistemC.php?personaje=<?= $id_temp ?>&dialogo=1&pregunta=0" 
                   class="btn btn-exam" style="margin:6px;">
                    📝 Examen: <?= htmlspecialchars($fm) ?>
                </a>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
<?php endif; ?>

<script src="assets/js/app.js"></script>
<script>
    // ... (todo el JavaScript original que ya tenías, sin cambios) ...
    // (fetchAndUpdateDashboard, scrollToTop, highlight al volver, etc.)
    // Lo mantengo igual para no alargar el código, pero debes pegarlo tal como estaba.

    document.addEventListener('DOMContentLoaded', () => {
        const scrollToTopBtn = document.getElementById('scrollToTopBtn');
        window.onscroll = function() {
            if (document.body.scrollTop > 300 || document.documentElement.scrollTop > 300) {
                scrollToTopBtn.style.display = "block";
            } else {
                scrollToTopBtn.style.display = "none";
            }
        };
        scrollToTopBtn.onclick = function() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        };
        fetchAndUpdateDashboard();
        if (localStorage.getItem('needsUpdate') === 'true') {
            fetchAndUpdateDashboard();
            localStorage.removeItem('needsUpdate');
        }

        <?php if (!empty($highlight_materia) || $filter_materia): ?>
            (function(){
                const name = <?php echo json_encode($filter_materia ?: $highlight_materia); ?>;
                const targetId = 'materia-' + encodeURIComponent(name);
                const target = document.getElementById(targetId);
                if (target) {
                    target.classList.add('materia-highlight');
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    setTimeout(() => target.classList.remove('materia-highlight'), 1800);
                }
            })();
        <?php endif; ?>
    });

    // Manejo de highlight al volver de lección (tu código original)
    document.addEventListener('DOMContentLoaded', function () {
      function handleLesson(slug) {
        if (!slug) return false;
        const id = 'leccion-' + slug;
        const el = document.getElementById(id);
        if (!el) return false;

        const saved = sessionStorage.getItem('scrollPos_leccion_' + slug);
        setTimeout(() => {
          if (saved !== null) {
            window.scrollTo({ top: parseInt(saved, 10), behavior: 'smooth' });
            sessionStorage.removeItem('scrollPos_leccion_' + slug);
          } else {
            el.scrollIntoView({ behavior: 'smooth', block: 'start' });
          }
          el.classList.add('highlight-return');
          setTimeout(() => el.classList.remove('highlight-return'), 3000);
        }, 200);

        sessionStorage.removeItem('last_leccion_slug');
        return true;
      }
      el.classList.add('highlight-return');
      setTimeout(() => el.classList.remove('highlight-return'), 3000);
    }, 200);

    sessionStorage.removeItem('last_leccion_slug');
    return true;
  }

  const hash = window.location.hash;
  if (hash && hash.startsWith('#leccion-')) {
    handleLesson(decodeURIComponent(hash.replace('#leccion-','')));
  } else {
    const last = sessionStorage.getItem('last_leccion_slug');
    if (last) handleLesson(last);
  }
});

// Insertar en dashboard (script al final) para ocultar otras materias si hay ?materia= o ?profesor=
document.addEventListener('DOMContentLoaded', () => {
  const params = new URLSearchParams(window.location.search);
  const materia = params.get('materia');
  const profesor = params.get('profesor');

  // Manejo por `materia` (comportamiento existente)
  if (materia) {
    // Compatibilidad: algunas vistas usan `.materia-group` y otras `.materia-section`
    document.querySelectorAll('.materia-group, .materia-section').forEach(sec => {
      const title = sec.querySelector('.materia-title')?.textContent || '';
      if (!title || title.toLowerCase().indexOf(materia.toLowerCase()) === -1) {
        sec.style.display = 'none';
      } else {
        const last = sessionStorage.getItem('last_leccion_slug');
        if (last) handleLesson(last);
      }
    });

    // Asegurar que los enlaces a lecciones mantengan el parámetro `materia`
    document.querySelectorAll('.leccion-list a').forEach(a => {
      try {
        const url = new URL(a.href, window.location.origin);
        if (!url.searchParams.get('materia')) {
          url.searchParams.set('materia', materia);
          a.href = url.pathname + '?' + url.searchParams.toString() + (url.hash || '');
        }
      } catch(e){ /* no hacer nada si la URL es relativa o inválida */ }
    });

    // Si hay un hash a una lección, desplazar suavemente hacia ella después de filtrar
    if (location.hash && location.hash.startsWith('#leccion-')) {
      setTimeout(() => {
        const target = document.getElementById(location.hash.replace('#',''));
        if (target) {
          target.scrollIntoView({ behavior: 'smooth', block: 'start' });
          target.classList.add('highlight-return');
          setTimeout(() => target.classList.remove('highlight-return'), 1800);
        }
      }, 200);
    }

    return; // ya no procesar `profesor` cuando hay `materia` explícita
  }

  // Manejo por `profesor` (nuevo): mostrar las materias mapeadas y asegurarse de propagar el parámetro a los enlaces
  if (profesor) {
    // Mapear profesor -> materias (mantener sincronizado con PHP `$profesor_materia_map`)
    const profesorMateriaMap = {
      'Miguel Marquez': ['Temas Selectos de Matemáticas I y II'],
      'Enrique': ['Inglés'],
      'Espindola': ['Pensamiento Matemático III'],
      'Manuel': ['Programación'],
      'Meza': ['Programación'],
      'Herson': ['Física','Química'],
      'Carolina': ['Ecosistemas'],
      'Refugio & Padilla': ['Ciencias Sociales'],
      'Armando': ['Historia']
    };

    // Buscar la clave del mapa de profesor ignorando mayúsculas y acentos
    function normJs(s){ return String(s || '').toLowerCase().normalize('NFD').replace(/\p{Diacritic}/gu, '').replace(/&/g,'y').trim(); }
    let profKey = Object.keys(profesorMateriaMap).find(k => {
      return normJs(k).includes(normJs(profesor)) || normJs(profesor).includes(normJs(k));
    });
    const wanted = (profesorMateriaMap[profKey] || []).map(s => normJs(s));

    document.querySelectorAll('.materia-group, .materia-section').forEach(sec => {
      const title = sec.querySelector('.materia-title')?.textContent || '';
      const keep = wanted.some(w => normJs(title).indexOf(w) !== -1);
      if (!keep) sec.style.display = 'none'; else { sec.style.display = 'block'; sec.classList.add('materia-highlight'); }
    });

    // Asegurar que los enlaces a lecciones mantengan el parámetro `profesor`
    document.querySelectorAll('.leccion-list a').forEach(a => {
      try {
        const url = new URL(a.href, window.location.origin);
        if (!url.searchParams.get('profesor')) {
          url.searchParams.set('profesor', profesor);
          a.href = url.pathname + '?' + url.searchParams.toString() + (url.hash || '');
        }
      } catch(e){ /* no hacer nada si la URL es relativa o inválida */ }
    });

    // Si hay #leccion, desplazar hacia la lección destacada
    if (location.hash && location.hash.startsWith('#leccion-')) {
      setTimeout(() => {
        const target = document.getElementById(location.hash.replace('#',''));
        if (target) {
          target.scrollIntoView({ behavior: 'smooth', block: 'start' });
          target.classList.add('highlight-return');
          setTimeout(() => target.classList.remove('highlight-return'), 1800);
        }
      }, 200);
    }
  }
});

</script>

<!-- Bloque duplicado de examen eliminado: el CTA al examen se renderiza previamente en la parte superior para evitar duplicados. -->

<script>
document.addEventListener('DOMContentLoaded', () => {
    <?php if (!empty($highlight_materia) || $filter_materia): ?>
        (function(){
            const name = <?php echo json_encode($filter_materia ?: $highlight_materia); ?>;
            const targetId = 'materia-' + encodeURIComponent(name);
            const target = document.getElementById(targetId);
            if (target) {
                target.classList.add('materia-highlight');
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                setTimeout(() => target.classList.remove('materia-highlight'), 1800);
            }
        })();
    <?php endif; ?>

    // ============================================
    // SCROLL REVEAL ANIMATIONS
    // Mostrar lecciones y grupos conforme hace scroll
    // ============================================
    (function() {
        // Seleccionar todos los elementos que deben animarse
        const elementsToAnimate = document.querySelectorAll('.leccion-item, .materia-group');
        
        // Configurar Intersection Observer
        const observerOptions = {
            threshold: 0.1,  // Activar cuando 10% del elemento es visible
            rootMargin: '0px 0px -50px 0px'  // Empezar la animación 50px antes
        };
        
        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    // Agregar clase para activar animación
                    entry.target.classList.add('visible');
                    // Dejar de observar para mejorar rendimiento
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);
        
        // Observar cada elemento
        elementsToAnimate.forEach(element => {
            observer.observe(element);
        });
    })();
});
</script>

</body>
</html>