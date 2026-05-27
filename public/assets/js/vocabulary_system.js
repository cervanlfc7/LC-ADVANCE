// ========================================
// SISTEMA DE VOCABULARIO — CORREGIDO
// ========================================

// ---- VOZ: caché y selección de voz ----
let _voiceCache = null;

function getBestEnglishVoice() {
  if (_voiceCache) return _voiceCache;
  const voices = window.speechSynthesis
    ? window.speechSynthesis.getVoices()
    : [];
  const preferred = [
    "Google US English",
    "Microsoft David Desktop",
    "Microsoft Zira Desktop",
    "Samantha",
    "Alex",
  ];
  const byName = voices.find((v) => preferred.some((p) => v.name.includes(p)));
  if (byName) {
    _voiceCache = byName;
    return byName;
  }
  const byLang = voices.find((v) => /^en(-|_)(US|GB)/i.test(v.lang));
  if (byLang) {
    _voiceCache = byLang;
    return byLang;
  }
  _voiceCache = voices.find((v) => /^en/i.test(v.lang)) || null;
  return _voiceCache;
}

if (window.speechSynthesis) {
  window.speechSynthesis.getVoices();
  window.speechSynthesis.addEventListener("voiceschanged", () => {
    _voiceCache = null;
    getBestEnglishVoice();
  });
}

// Función central de síntesis
function speakText(text, opts = {}) {
  if (!window.speechSynthesis) return;
  window.speechSynthesis.cancel();
  const utter = new SpeechSynthesisUtterance(text);
  utter.lang = "en-US";
  utter.rate = opts.rate ?? 0.9;
  utter.pitch = opts.pitch ?? 1.0;
  utter.volume = 1.0;
  const voice = getBestEnglishVoice();
  if (voice) utter.voice = voice;
  if (opts.onStart) utter.onstart = opts.onStart;
  if (opts.onEnd) utter.onend = opts.onEnd;
  if (opts.onError) utter.onerror = opts.onError;
  window.speechSynthesis.speak(utter);
}

// ========================================
// DATOS DE VOCABULARIO
// ========================================

const vocabularyData = {
  family: [
    {
      english: "mother",
      spanish: "madre",
      emoji: "👩",
      phonetic: "/ˈmʌð.ər/",
      example: "My mother cooks delicious food.",
    },
    {
      english: "father",
      spanish: "padre",
      emoji: "👨",
      phonetic: "/ˈfɑː.ðər/",
      example: "My father works in an office.",
    },
    {
      english: "brother",
      spanish: "hermano",
      emoji: "👦",
      phonetic: "/ˈbrʌð.ər/",
      example: "My brother plays soccer.",
    },
    {
      english: "sister",
      spanish: "hermana",
      emoji: "👧",
      phonetic: "/ˈsɪs.tər/",
      example: "My sister studies at university.",
    },
    {
      english: "grandmother",
      spanish: "abuela",
      emoji: "👵",
      phonetic: "/ˈɡræn.mʌð.ər/",
      example: "My grandmother tells stories.",
    },
    {
      english: "grandfather",
      spanish: "abuelo",
      emoji: "👴",
      phonetic: "/ˈɡræn.fɑː.ðər/",
      example: "My grandfather likes gardening.",
    },
    {
      english: "uncle",
      spanish: "tío",
      emoji: "👨",
      phonetic: "/ˈʌŋ.kəl/",
      example: "My uncle lives in another city.",
    },
    {
      english: "aunt",
      spanish: "tía",
      emoji: "👩",
      phonetic: "/ɑːnt/",
      example: "My aunt is a doctor.",
    },
    {
      english: "cousin",
      spanish: "primo/a",
      emoji: "👫",
      phonetic: "/ˈkʌz.ən/",
      example: "I have three cousins.",
    },
    {
      english: "son",
      spanish: "hijo",
      emoji: "👶",
      phonetic: "/sʌn/",
      example: "Their son is two years old.",
    },
    {
      english: "daughter",
      spanish: "hija",
      emoji: "👧",
      phonetic: "/ˈdɔː.tər/",
      example: "Their daughter goes to school.",
    },
    {
      english: "baby",
      spanish: "bebé",
      emoji: "👶",
      phonetic: "/ˈbeɪ.bi/",
      example: "The baby is sleeping.",
    },
    {
      english: "parents",
      spanish: "padres",
      emoji: "👨‍👩‍👧",
      phonetic: "/ˈpeə.rənts/",
      example: "My parents are teachers.",
    },
    {
      english: "children",
      spanish: "hijos",
      emoji: "👨‍👩‍👧‍👦",
      phonetic: "/ˈtʃɪl.drən/",
      example: "They have two children.",
    },
    {
      english: "pet",
      spanish: "mascota",
      emoji: "🐶",
      phonetic: "/pet/",
      example: "We have a pet dog.",
    },
    {
      english: "dog",
      spanish: "perro",
      emoji: "🐕",
      phonetic: "/dɒɡ/",
      example: "The dog is playing in the garden.",
    },
    {
      english: "cat",
      spanish: "gato",
      emoji: "🐈",
      phonetic: "/kæt/",
      example: "The cat is sleeping on the chair.",
    },
  ],
  objects: [
    {
      english: "backpack",
      spanish: "mochila",
      emoji: "🎒",
      phonetic: "/ˈbæk.pæk/",
      example: "I carry my books in my backpack.",
    },
    {
      english: "book",
      spanish: "libro",
      emoji: "📚",
      phonetic: "/bʊk/",
      example: "I read a book every day.",
    },
    {
      english: "pencil",
      spanish: "lápiz",
      emoji: "✏️",
      phonetic: "/ˈpen.səl/",
      example: "Can I borrow your pencil?",
    },
    {
      english: "phone",
      spanish: "teléfono",
      emoji: "📱",
      phonetic: "/fəʊn/",
      example: "My phone is new.",
    },
    {
      english: "desk",
      spanish: "escritorio",
      emoji: "🪑",
      phonetic: "/desk/",
      example: "My desk is in my room.",
    },
    {
      english: "chair",
      spanish: "silla",
      emoji: "💺",
      phonetic: "/tʃeər/",
      example: "Please sit on the chair.",
    },
    {
      english: "notebook",
      spanish: "cuaderno",
      emoji: "📓",
      phonetic: "/ˈnəʊt.bʊk/",
      example: "I write notes in my notebook.",
    },
    {
      english: "pen",
      spanish: "pluma",
      emoji: "🖊️",
      phonetic: "/pen/",
      example: "I need a blue pen.",
    },
    {
      english: "ruler",
      spanish: "regla",
      emoji: "📏",
      phonetic: "/ˈruː.lər/",
      example: "Use the ruler to draw a line.",
    },
    {
      english: "eraser",
      spanish: "borrador",
      emoji: "🧼",
      phonetic: "/ɪˈreɪ.zər/",
      example: "Can I use your eraser?",
    },
  ],
};

// ========================================
// ESTADO GLOBAL
// ========================================

let practiceWords = ["mother", "father", "brother", "sister"];
let currentWordIndex = 0;
let speechRecognition = null;
let isRecording = false;
let examAnswers = {};
let examScore = 0;
let examTimer = 600;
let timerInterval = null;
let practiceStats = { wordsPracticed: 0, correctPronunciations: 0 };

// ========================================
// INICIALIZACIÓN
// ========================================

function initializeVocabulary() {
  renderVocabGrid("familyGrid", vocabularyData.family);
  renderVocabGrid("objectsGrid", vocabularyData.objects);
  initializeFamilyTree();
  initializeSentenceBuilder();
  updatePracticeChips();
  if (practiceWords.length > 0) updateCurrentWordDisplay();
  console.log("✅ Vocabulary system initialized");
}

function renderVocabGrid(containerId, data) {
  const grid = document.getElementById(containerId);
  if (!grid) return;
  grid.innerHTML = data
    .map(
      (item) => `
        <div class="vocab-card" data-word="${item.english}" onclick="speakWord('${item.english}')">
            <div class="card-emoji">${item.emoji}</div>
            <div class="card-content">
                <div class="word-english">${item.english}</div>
                <div class="word-spanish">${item.spanish}</div>
                <div class="word-phonetic">${item.phonetic}</div>
            </div>
            <div class="card-actions">
                <button class="card-btn add-btn"     onclick="event.stopPropagation(); addToPractice('${item.english}')"  title="Add to practice">➕</button>
                <button class="card-btn example-btn" onclick="event.stopPropagation(); showExample('${item.english}')"    title="Show example">💡</button>
                <button class="card-btn audio-btn"   onclick="event.stopPropagation(); speakWord('${item.english}')"      title="Listen">🔊</button>
            </div>
        </div>
    `,
    )
    .join("");
}

// ========================================
// PRONUNCIACIÓN
// ========================================

function speakWord(word) {
  if (!window.speechSynthesis) {
    showNotification("Text-to-speech not supported in this browser", "error");
    return;
  }

  const card = document.querySelector(`.vocab-card[data-word="${word}"]`);
  if (card) card.classList.add("speaking");

  speakText(word, {
    rate: 0.9,
    onEnd: () => card && card.classList.remove("speaking"),
    onError: () => card && card.classList.remove("speaking"),
  });

  practiceStats.wordsPracticed++;
  updateStatsDisplay();
}

function speakCurrentWord() {
  if (!practiceWords.length) {
    showNotification("No words in practice list", "error");
    return;
  }
  updateCurrentWordDisplay();
  speakWord(practiceWords[currentWordIndex]);
  setFeedback("Listen carefully to the pronunciation", "info");
}

function speakDialogue(text) {
  speakText(text, { rate: 0.9 });
}

function speakExample(example) {
  speakText(example, { rate: 0.85 });
}

function speakBuiltSentence() {
  const container = document.getElementById("sentenceContainer");
  if (!container) return;
  const words = Array.from(container.querySelectorAll(".sentence-word")).map(
    (s) => s.textContent,
  );
  if (!words.length) {
    showNotification("Build a sentence first", "error");
    return;
  }
  speakText(words.join(" "), { rate: 0.9 });
}

function pronounceAllFamily() {
  vocabularyData.family.forEach((item, i) =>
    setTimeout(() => speakWord(item.english), i * 1500),
  );
  showNotification("Pronouncing all family members...", "info");
}

function pronounceAllObjects() {
  vocabularyData.objects.forEach((item, i) =>
    setTimeout(() => speakWord(item.english), i * 1500),
  );
  showNotification("Pronouncing all daily objects...", "info");
}

function pronounceAllFamilyTree() {
  [
    "mother",
    "father",
    "brother",
    "sister",
    "grandmother",
    "grandfather",
  ].forEach((w, i) => setTimeout(() => speakWord(w), i * 1500));
  showNotification("Pronouncing all family relations...", "info");
}

// Audio de errores comunes — usa speakText en lugar de archivos inexistentes
function playAudio(audioId) {
  const map = {
    mother_incorrect: "moder", // pronunciación incorrecta simulada
    mother_correct: "mother",
    father_correct: "father",
    brother_incorrect: "broder",
    brother_correct: "brother",
    daughter_incorrect: "dauter",
    daughter_correct: "daughter",
  };
  const text = map[audioId];
  if (text) speakText(text, { rate: 0.8 });
}

// ========================================
// RECONOCIMIENTO DE VOZ
// ========================================

function startListening() {
  const SpeechRec = window.SpeechRecognition || window.webkitSpeechRecognition;
  if (!SpeechRec) {
    showNotification(
      "Speech recognition not supported. Use Chrome or Edge.",
      "error",
    );
    return;
  }
  if (!practiceWords.length) {
    showNotification("Add words to practice first", "error");
    return;
  }

  if (speechRecognition) speechRecognition.stop();

  speechRecognition = new SpeechRec();
  speechRecognition.lang = "en-US";
  speechRecognition.interimResults = false;
  speechRecognition.continuous = false;
  speechRecognition.maxAlternatives = 3;

  const currentWord = practiceWords[currentWordIndex];

  setFeedback(`Listening... Say: <strong>${currentWord}</strong>`, "listening");
  isRecording = true;
  updateRecordingVisualizer(true);
  speechRecognition.start();

  speechRecognition.onresult = function (event) {
    isRecording = false;
    updateRecordingVisualizer(false);

    const spoken = event.results[0][0].transcript.toLowerCase().trim();
    const similarity = calculateSimilarity(spoken, currentWord);
    let accuracy, message, type;

    if (spoken === currentWord) {
      accuracy = 95;
      type = "success";
      message = `✅ Excellent! Perfect pronunciation: "${spoken}"`;
      practiceStats.correctPronunciations++;
    } else if (similarity > 0.7) {
      accuracy = Math.min(85, Math.max(70, similarity * 100));
      type = "success";
      message = `👍 Good! You said: "${spoken}" — Correct: "${currentWord}"`;
      practiceStats.correctPronunciations++;
    } else {
      accuracy = Math.min(50, similarity * 100);
      type = "error";
      message = `📝 Try again. You said: "${spoken}" — Should be: "${currentWord}"`;
    }

    setFeedback(message, type);
    updateConfidenceMeter(accuracy);
    updateStatsDisplay();
  };

  speechRecognition.onerror = function (e) {
    isRecording = false;
    updateRecordingVisualizer(false);
    setFeedback("Recognition error: " + e.error, "error");
  };

  speechRecognition.onend = function () {
    isRecording = false;
    updateRecordingVisualizer(false);
  };
}

function calculateSimilarity(s1, s2) {
  if (s1 === s2) return 1.0;
  const [longer, shorter] = s1.length >= s2.length ? [s1, s2] : [s2, s1];
  if (!longer.length) return 1.0;
  const costs = Array.from({ length: shorter.length + 1 }, (_, i) => i);
  for (let i = 1; i <= longer.length; i++) {
    let prev = i;
    for (let j = 1; j <= shorter.length; j++) {
      const val =
        longer[i - 1] === shorter[j - 1]
          ? costs[j - 1]
          : 1 + Math.min(costs[j - 1], prev, costs[j]);
      costs[j - 1] = prev;
      prev = val;
    }
    costs[shorter.length] = prev;
  }
  return (longer.length - costs[shorter.length]) / longer.length;
}

// ========================================
// GESTIÓN DE LISTA DE PRÁCTICA
// ========================================

function nextWord() {
  if (!practiceWords.length) {
    showNotification("No words in practice list", "error");
    return;
  }
  currentWordIndex = (currentWordIndex + 1) % practiceWords.length;
  updateCurrentWordDisplay();
  updateConfidenceMeter(0);
  setFeedback("Next word loaded", "info");
}

function repeatPractice() {
  if (!practiceWords.length) return;
  currentWordIndex = 0;
  updateCurrentWordDisplay();
  updateConfidenceMeter(0);
  speakCurrentWord();
}

function addToPractice(word) {
  if (!practiceWords.includes(word)) {
    practiceWords.push(word);
    updatePracticeChips();
    showNotification(`"${word}" added to practice list`, "success");
    if (practiceWords.length === 1) {
      currentWordIndex = 0;
      updateCurrentWordDisplay();
    }
  } else {
    showNotification(`"${word}" already in practice list`, "info");
  }
}

function removeFromPractice(word) {
  const idx = practiceWords.indexOf(word);
  if (idx > -1) {
    practiceWords.splice(idx, 1);
    if (currentWordIndex >= practiceWords.length) currentWordIndex = 0;
    updatePracticeChips();
    practiceWords.length
      ? updateCurrentWordDisplay()
      : clearCurrentWordDisplay();
    showNotification(`"${word}" removed from practice list`, "info");
  }
}

function addAllToPractice(category) {
  const words = (
    category === "family" ? vocabularyData.family : vocabularyData.objects
  ).map((i) => i.english);
  let added = 0;
  words.forEach((w) => {
    if (!practiceWords.includes(w)) {
      practiceWords.push(w);
      added++;
    }
  });
  if (added) {
    updatePracticeChips();
    showNotification(`${added} words added to practice list`, "success");
    if (practiceWords.length === added) {
      currentWordIndex = 0;
      updateCurrentWordDisplay();
    }
  } else {
    showNotification("All words already in practice list", "info");
  }
}

function clearPracticeList() {
  if (!practiceWords.length) {
    showNotification("Practice list is already empty", "info");
    return;
  }
  practiceWords = [];
  currentWordIndex = 0;
  updatePracticeChips();
  clearCurrentWordDisplay();
  updateConfidenceMeter(0);
  setFeedback("Practice list cleared. Add words to start practicing.", "info");
  showNotification("Practice list cleared", "success");
}

function showWordSelector() {
  const available = [...vocabularyData.family, ...vocabularyData.objects]
    .map((i) => i.english)
    .filter((w) => !practiceWords.includes(w));
  if (!available.length) {
    showNotification("All words already in practice list", "info");
    return;
  }

  const modal = document.createElement("div");
  modal.className = "word-selector-modal";
  modal.style.cssText =
    "position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.7);display:flex;justify-content:center;align-items:center;z-index:10000;";

  const content = document.createElement("div");
  content.style.cssText =
    "background:var(--bg-card);padding:2rem;border-radius:12px;max-width:500px;max-height:80vh;overflow-y:auto;border:2px solid var(--neon-cyan);";
  content.innerHTML = `
        <h3 style="color:var(--neon-cyan);margin-bottom:1.5rem;">Select Words to Practice</h3>
        <div style="max-height:300px;overflow-y:auto;margin-bottom:1.5rem;">
            ${available
              .map((w) => {
                const d = findWordData(w);
                return `<div style="display:flex;justify-content:space-between;align-items:center;padding:0.75rem;border-bottom:1px solid rgba(255,255,255,0.1);">
                    <div><strong>${w}</strong><div style="font-size:0.9rem;color:var(--text-dim);">${d.spanish}</div></div>
                    <button onclick="addToPractice('${w}');this.disabled=true;this.textContent='Added';"
                            style="padding:0.5rem 1rem;background:var(--neon-green);color:black;border:none;border-radius:4px;cursor:pointer;">Add</button>
                </div>`;
              })
              .join("")}
        </div>
        <button onclick="this.closest('.word-selector-modal').remove()"
                style="padding:0.75rem 1.5rem;background:#f44336;color:white;border:none;border-radius:6px;cursor:pointer;width:100%;">Close</button>
    `;
  modal.appendChild(content);
  document.body.appendChild(modal);
  modal.addEventListener("click", (e) => {
    if (e.target === modal) modal.remove();
  });
}

function practiceWord(word) {
  addToPractice(word);
  currentWordIndex = practiceWords.indexOf(word);
  updateCurrentWordDisplay();
  speakCurrentWord();
}

// ========================================
// ÁRBOL FAMILIAR (SVG)
// ========================================

function initializeFamilyTree() {
  const container = document.getElementById("familyTreeContainer");
  if (!container) return;

  const svgNS = "http://www.w3.org/2000/svg";
  const svg = document.createElementNS(svgNS, "svg");
  svg.setAttribute("viewBox", "0 0 1000 700");
  svg.setAttribute("class", "family-tree-svg");

  // Fondo
  const bg = document.createElementNS(svgNS, "rect");
  bg.setAttribute("width", "1000");
  bg.setAttribute("height", "700");
  bg.setAttribute("fill", "#f8f9fa");
  svg.appendChild(bg);

  // Título
  const title = document.createElementNS(svgNS, "text");
  title.setAttribute("x", "500");
  title.setAttribute("y", "50");
  title.setAttribute("text-anchor", "middle");
  title.setAttribute("font-size", "32");
  title.setAttribute("font-weight", "bold");
  title.setAttribute("fill", "#333");
  title.textContent = "My Family Tree";
  svg.appendChild(title);

  const connections = [
    [500, 250, 350, 305],
    [500, 250, 650, 305],
    [350, 395, 250, 460],
    [350, 395, 450, 460],
    [650, 395, 550, 460],
    [650, 395, 750, 460],
    [500, 150, 400, 165],
    [500, 150, 600, 165],
  ];
  connections.forEach(([x1, y1, x2, y2]) => {
    const line = document.createElementNS(svgNS, "line");
    ["x1", "y1", "x2", "y2"].forEach((a, i) =>
      line.setAttribute(a, [x1, y1, x2, y2][i]),
    );
    line.setAttribute("stroke", "#795548");
    line.setAttribute("stroke-width", "2");
    svg.appendChild(line);
  });

  const nodes = [
    {
      id: "student",
      cx: 500,
      cy: 200,
      r: 50,
      label: "ME",
      sub: "Student",
      color: "#2196F3",
      word: "student",
    },
    {
      id: "mother",
      cx: 350,
      cy: 350,
      r: 45,
      label: "Mother",
      sub: "Maria",
      color: "#E91E63",
      word: "mother",
    },
    {
      id: "father",
      cx: 650,
      cy: 350,
      r: 45,
      label: "Father",
      sub: "José",
      color: "#2196F3",
      word: "father",
    },
    {
      id: "grandmother1",
      cx: 250,
      cy: 500,
      r: 40,
      label: "Grandma",
      sub: "Ana",
      color: "#9C27B0",
      word: "grandmother",
    },
    {
      id: "grandfather1",
      cx: 450,
      cy: 500,
      r: 40,
      label: "Grandpa",
      sub: "Carlos",
      color: "#3F51B5",
      word: "grandfather",
    },
    {
      id: "grandmother2",
      cx: 550,
      cy: 500,
      r: 40,
      label: "Grandma",
      sub: "Elena",
      color: "#9C27B0",
      word: "grandmother",
    },
    {
      id: "grandfather2",
      cx: 750,
      cy: 500,
      r: 40,
      label: "Grandpa",
      sub: "Miguel",
      color: "#3F51B5",
      word: "grandfather",
    },
    {
      id: "brother",
      cx: 400,
      cy: 200,
      r: 35,
      label: "Brother",
      sub: "Luis",
      color: "#4CAF50",
      word: "brother",
    },
    {
      id: "sister",
      cx: 600,
      cy: 200,
      r: 35,
      label: "Sister",
      sub: "Sofia",
      color: "#FF9800",
      word: "sister",
    },
  ];

  nodes.forEach((n) => {
    const g = document.createElementNS(svgNS, "g");
    g.setAttribute("class", "tree-node");
    g.setAttribute("data-role", n.id);
    g.setAttribute("onclick", `speakWord('${n.word}')`);
    g.style.cursor = "pointer";

    const circle = document.createElementNS(svgNS, "circle");
    circle.setAttribute("cx", n.cx);
    circle.setAttribute("cy", n.cy);
    circle.setAttribute("r", n.r);
    circle.setAttribute("fill", n.color);
    g.appendChild(circle);

    const lbl = document.createElementNS(svgNS, "text");
    lbl.setAttribute("x", n.cx);
    lbl.setAttribute("y", n.cy - 5);
    lbl.setAttribute("text-anchor", "middle");
    lbl.setAttribute("fill", "white");
    lbl.setAttribute("font-size", n.r > 40 ? "16" : "14");
    lbl.setAttribute("font-weight", "bold");
    lbl.textContent = n.label;
    g.appendChild(lbl);

    const sub = document.createElementNS(svgNS, "text");
    sub.setAttribute("x", n.cx);
    sub.setAttribute("y", n.cy + 15);
    sub.setAttribute("text-anchor", "middle");
    sub.setAttribute("fill", "white");
    sub.setAttribute("font-size", n.r > 40 ? "12" : "10");
    sub.textContent = n.sub;
    g.appendChild(sub);

    svg.appendChild(g);
  });

  container.appendChild(svg);
  initializeRelationshipsList();
}

function initializeRelationshipsList() {
  const list = document.getElementById("relationshipsList");
  if (!list) return;
  list.innerHTML = [
    { relation: "Mother and Father", description: "Parents of the student" },
    { relation: "Brother and Sister", description: "Siblings of the student" },
    {
      relation: "Grandmother and Grandfather",
      description: "Parents of the parents",
    },
    { relation: "Uncle and Aunt", description: "Siblings of the parents" },
    { relation: "Cousin", description: "Children of uncles and aunts" },
  ]
    .map(
      (r) => `<div class="relationship-item">
                    <div class="relationship-title">${r.relation}</div>
                    <div class="relationship-desc">${r.description}</div>
                </div>`,
    )
    .join("");
}

function showFamilyRelations() {
  setFeedback(
    `<strong>Family Relationships:</strong><br>
        • Mother + Father = Parents<br>
        • Parents + Children = Family<br>
        • Brother + Sister = Siblings<br>
        • Grandmother + Grandfather = Grandparents<br>
        • Uncle + Aunt = Parents' siblings`,
    "info",
  );
}

function resetFamilyTree() {
  document.querySelectorAll(".tree-node").forEach((n) => {
    n.style.opacity = "1";
    n.style.transform = "scale(1)";
  });
  setFeedback("Family tree highlights reset", "info");
}

// ========================================
// CONSTRUCTOR DE FRASES (DRAG & DROP)
// ========================================

function initializeSentenceBuilder() {
  const pool = document.getElementById("wordPool");
  if (!pool) return;

  const words = [
    { word: "My", type: "pronoun", translation: "Mi" },
    { word: "mother", type: "noun", translation: "madre" },
    { word: "father", type: "noun", translation: "padre" },
    { word: "has", type: "verb", translation: "tiene" },
    { word: "a", type: "article", translation: "un/una" },
    { word: "new", type: "adjective", translation: "nuevo/a" },
    { word: "phone", type: "noun", translation: "teléfono" },
    { word: "book", type: "noun", translation: "libro" },
    { word: "backpack", type: "noun", translation: "mochila" },
    { word: "and", type: "conjunction", translation: "y" },
  ];

  pool.innerHTML = words
    .map(
      (item, idx) => `
        <div class="word-item" draggable="true" data-word="${item.word}" data-index="${idx}">
            <span class="word-text">${item.word}</span>
            <span class="word-translation">${item.translation}</span>
        </div>
    `,
    )
    .join("");

  pool
    .querySelectorAll(".word-item")
    .forEach((el) => el.addEventListener("dragstart", handleDragStart));

  const container = document.getElementById("sentenceContainer");
  if (container) {
    container.addEventListener("dragover", handleDragOver);
    container.addEventListener("drop", handleDrop);
    container.addEventListener("dragleave", (e) =>
      e.currentTarget.classList.remove("drag-over"),
    );
  }
}

function handleDragStart(e) {
  e.dataTransfer.setData("text/plain", e.target.dataset.word);
  e.dataTransfer.setData("index", e.target.dataset.index);
}
function handleDragOver(e) {
  e.preventDefault();
  e.currentTarget.classList.add("drag-over");
}
function handleDrop(e) {
  e.preventDefault();
  e.currentTarget.classList.remove("drag-over");
  const word = e.dataTransfer.getData("text/plain");
  const container = document.getElementById("sentenceContainer");
  if (!container) return;
  const span = document.createElement("span");
  span.className = "sentence-word";
  span.textContent = word;
  span.draggable = true;
  span.dataset.word = word;
  span.addEventListener("dragstart", handleDragStart);
  span.addEventListener("click", function () {
    this.remove();
    updateSentenceFeedback();
  });
  container.appendChild(span);
  updateSentenceFeedback();
}

function updateSentenceFeedback() {
  const container = document.getElementById("sentenceContainer");
  const feedback = document.getElementById("sentenceFeedback");
  if (!container || !feedback) return;
  const words = Array.from(container.querySelectorAll(".sentence-word")).map(
    (s) => s.textContent,
  );
  if (!words.length) {
    feedback.textContent = "Drag words here to build your sentence";
    feedback.className = "sentence-feedback";
    return;
  }
  feedback.textContent = `Current: "${words.join(" ")}"`;
  feedback.className = "sentence-feedback active";
}

function checkSentence() {
  const container = document.getElementById("sentenceContainer");
  const feedback = document.getElementById("sentenceFeedback");
  if (!container || !feedback) return;
  const words = Array.from(container.querySelectorAll(".sentence-word")).map(
    (s) => s.textContent,
  );
  if (!words.length) {
    feedback.textContent = "Please build a sentence first";
    feedback.className = "sentence-feedback error";
    return;
  }

  const sentence = words.join(" ").toLowerCase();
  const correct = [
    "my mother has a new phone",
    "my father has a new phone",
    "i have a book and a pencil",
    "the chair is next to the desk",
  ];
  let best = 0;
  let bestMatch = "";
  correct.forEach((c) => {
    const s = calculateSimilarity(sentence, c);
    if (s > best) {
      best = s;
      bestMatch = c;
    }
  });

  if (best > 0.8) {
    feedback.innerHTML = `✅ <strong>Correct!</strong> Good sentence: "${words.join(" ")}"`;
    feedback.className = "sentence-feedback success";
    showNotification("Excellent sentence construction!", "success");
  } else {
    feedback.innerHTML = `📝 <strong>Almost!</strong> Try: "${bestMatch.charAt(0).toUpperCase() + bestMatch.slice(1)}."`;
    feedback.className = "sentence-feedback warning";
  }
}

function showSentenceHint() {
  const hints = [
    'Start with "My" or "The"',
    "Add a family member or object",
    'Use "has" or "is" as your verb',
    "Finish with more details",
  ];
  setFeedback(
    `💡 Hint: ${hints[Math.floor(Math.random() * hints.length)]}`,
    "info",
  );
}

function resetSentenceBuilder() {
  const container = document.getElementById("sentenceContainer");
  const feedback = document.getElementById("sentenceFeedback");
  if (container) container.innerHTML = "";
  if (feedback) {
    feedback.textContent = "Drag words here to build your sentence";
    feedback.className = "sentence-feedback";
  }
  document.querySelectorAll(".word-item").forEach((i) => {
    i.style.opacity = "1";
  });
  showNotification("Sentence builder reset", "info");
}

// ========================================
// CONVERSACIÓN
// ========================================

function changeConversationTab(tabName) {
  document
    .querySelectorAll(".tab-pane")
    .forEach((t) => t.classList.remove("active"));
  document
    .querySelectorAll(".tab-btn")
    .forEach((b) => b.classList.remove("active"));
  const tab = document.getElementById(`tab-${tabName}`);
  if (tab) tab.classList.add("active");
  if (event?.target) event.target.classList.add("active");
}

function practiceFullConversation() {
  const active = document.querySelector(".tab-pane.active");
  if (!active) return;
  const lines = Array.from(active.querySelectorAll(".bubble-content p"))
    .map((p) => p.textContent.trim())
    .filter(Boolean);
  let idx = 0;
  function next() {
    if (idx >= lines.length) {
      setFeedback(
        "Conversation completed! Try recording your responses.",
        "success",
      );
      return;
    }
    setFeedback(`Say: "${lines[idx]}"`, "listening");
    speakText(lines[idx], {
      rate: 0.9,
      onEnd: () => {
        idx++;
        setTimeout(next, 1200);
      },
    });
  }
  next();
}

function startConversationRecording() {
  const btnRecord = document.getElementById("btnRecord");
  const feedbackEl = document.getElementById("recordingFeedback");
  if (!isRecording) {
    isRecording = true;
    if (btnRecord) {
      btnRecord.innerHTML =
        '<span class="record-icon">⏹️</span> STOP RECORDING';
      btnRecord.style.background = "var(--neon-evaluacion)";
    }
    if (feedbackEl) {
      feedbackEl.textContent = "Recording... Speak now!";
      feedbackEl.style.color = "var(--neon-pink)";
    }
    updateRecordingVisualizer(true);
    setTimeout(() => {
      if (isRecording) stopConversationRecording();
    }, 3000);
  } else {
    stopConversationRecording();
  }
}

function stopConversationRecording() {
  isRecording = false;
  const btnRecord = document.getElementById("btnRecord");
  const feedbackEl = document.getElementById("recordingFeedback");
  if (btnRecord) {
    btnRecord.innerHTML = '<span class="record-icon">●</span> START RECORDING';
    btnRecord.style.background = "var(--neon-green)";
  }
  updateRecordingVisualizer(false);
  const fb = [
    "Good pronunciation! Keep practicing.",
    "Try to speak a little louder next time.",
    "Excellent clarity in your speech!",
    "Work on your vowel sounds for better accuracy.",
  ];
  if (feedbackEl) {
    feedbackEl.textContent = fb[Math.floor(Math.random() * fb.length)];
    feedbackEl.style.color = "var(--neon-cyan)";
  }
}

function showConversationTips() {
  setFeedback(
    `<strong>Conversation Tips:</strong><br>
        1. Speak slowly and clearly<br>2. Focus on correct vowel sounds<br>
        3. Practice difficult words multiple times<br>4. Listen to native speakers and imitate<br>
        5. Record yourself and compare`,
    "info",
  );
}

// ========================================
// EXAMEN
// ========================================

function selectAnswer(questionNum, element) {
  document
    .getElementById(`pregunta${questionNum}`)
    ?.querySelectorAll(".opcion-item")
    .forEach((i) => i.classList.remove("selected"));
  element.classList.add("selected");
  examAnswers[questionNum] =
    element.querySelector(".opcion-texto")?.textContent;
  const isCorrect = element.dataset.correct === "true";
  const feedbackEl = document.getElementById(`feedback${questionNum}`);
  if (feedbackEl) {
    feedbackEl.innerHTML = isCorrect
      ? "✅ Correct answer!"
      : "Keep thinking...";
    feedbackEl.className = `pregunta-feedback${isCorrect ? " correct" : ""}`;
  }
  updateExamScore();
}

function updateExamScore() {
  let score = 0;
  for (let i = 1; i <= 4; i++) {
    if (
      document.querySelector(`#pregunta${i} .opcion-item.selected`)?.dataset
        .correct === "true"
    )
      score++;
  }
  examScore = score;
  const el = document.getElementById("currentScore");
  if (el) el.textContent = score;
}

function startExamRecording() {
  const feedbackEl = document.getElementById("audioFeedback");
  const waveEl = document.getElementById("audioWave");
  if (feedbackEl) feedbackEl.textContent = 'Listening... Say the word "family"';
  if (waveEl) {
    waveEl.innerHTML = "";
    for (let i = 0; i < 15; i++) {
      const bar = document.createElement("div");
      bar.style.cssText = `width:4px;background:var(--neon-pink);margin:0 1px;animation:pulse ${0.3 + Math.random() * 0.4}s infinite alternate;animation-delay:${i * 0.05}s;`;
      waveEl.appendChild(bar);
    }
  }
  setTimeout(() => {
    if (waveEl) waveEl.innerHTML = "";
    if (feedbackEl) {
      feedbackEl.innerHTML = '✅ Good pronunciation! Word recognized: "family"';
      feedbackEl.style.color = "var(--neon-green)";
    }
    examAnswers[5] = "correct";
    updateExamScore();
    const qf = document.getElementById("feedback5");
    if (qf) {
      qf.innerHTML = "✅ Excellent pronunciation!";
      qf.className = "pregunta-feedback correct";
    }
  }, 2000);
}

function submitExam() {
  if (timerInterval) clearInterval(timerInterval);
  updateExamScore();
  const total = 5;
  const pct = Math.round((examScore / total) * 100);
  const resultsEl = document.getElementById("examResults");
  const detailsEl = document.querySelector(".results-details");
  if (!resultsEl || !detailsEl) return;

  let html = `<div class="result-summary">
        <div class="result-score">${examScore}/${total}</div>
        <div class="result-percentage">${pct}%</div>
        <div class="result-status ${pct >= 80 ? "pass" : "fail"}">${pct >= 80 ? "PASSED" : "NOT PASSED"}</div>
    </div><div class="result-breakdown"><h5>Question Breakdown:</h5>`;

  for (let i = 1; i <= 4; i++) {
    const ok =
      document.querySelector(`#pregunta${i} .opcion-item.selected`)?.dataset
        .correct === "true";
    html += `<div class="result-question"><span class="question-num">${i}.</span>
            <span class="question-result ${ok ? "correct" : "incorrect"}">${ok ? "✅ Correct" : "❌ Incorrect"}</span></div>`;
  }
  const p5ok = examAnswers[5] === "correct";
  html += `<div class="result-question"><span class="question-num">5.</span>
        <span class="question-result ${p5ok ? "correct" : "incorrect"}">${p5ok ? "✅ Pronunciation Good" : "❌ Needs Practice"}</span></div></div>`;

  const rec =
    pct >= 80
      ? `<div class="result-recommendation success"><strong>Excellent work!</strong> You have a good understanding of family and object vocabulary.</div>`
      : pct >= 60
        ? `<div class="result-recommendation warning"><strong>Good effort!</strong> Focus on the words you missed and practice again.</div>`
        : `<div class="result-recommendation error"><strong>Keep practicing!</strong> Review vocabulary cards and pronunciation exercises.</div>`;

  detailsEl.innerHTML = html + rec;
  resultsEl.style.display = "block";
  resultsEl.scrollIntoView({ behavior: "smooth" });
  showNotification(
    `Exam submitted! Score: ${examScore}/${total} (${pct}%)`,
    pct >= 80 ? "success" : "warning",
  );
}

function resetExam() {
  examAnswers = {};
  examScore = 0;
  document
    .querySelectorAll(".opcion-item")
    .forEach((i) => i.classList.remove("selected"));
  document.querySelectorAll(".pregunta-feedback").forEach((f) => {
    f.innerHTML = "";
    f.className = "pregunta-feedback";
  });
  const af = document.getElementById("audioFeedback");
  const aw = document.getElementById("audioWave");
  if (af) {
    af.textContent = 'Click "Record Answer" to record your pronunciation';
    af.style.color = "";
  }
  if (aw) aw.innerHTML = "";
  const cs = document.getElementById("currentScore");
  if (cs) cs.textContent = "0";
  const re = document.getElementById("examResults");
  if (re) re.style.display = "none";
  examTimer = 600;
  updateExamTimerDisplay();
  showNotification("Exam reset. Ready to start again.", "info");
}

function startExamTimer() {
  if (timerInterval) clearInterval(timerInterval);
  timerInterval = setInterval(() => {
    examTimer--;
    updateExamTimerDisplay();
    if (examTimer <= 0) {
      clearInterval(timerInterval);
      showNotification("Time is up! Submitting exam...", "warning");
      setTimeout(submitExam, 1000);
    }
  }, 1000);
}

function updateExamTimerDisplay() {
  const el = document.getElementById("timerText");
  if (!el) return;
  const m = Math.floor(examTimer / 60)
    .toString()
    .padStart(2, "0");
  const s = (examTimer % 60).toString().padStart(2, "0");
  el.textContent = `${m}:${s}`;
  if (examTimer <= 60) el.style.color = "var(--neon-evaluacion)";
}

// ========================================
// AUTOEVALUACIÓN
// ========================================

function updateEvaluation(num, value) {
  const el = document.getElementById(`evalValue${num}`);
  if (el) el.textContent = `${value}/5`;
  calculateAverageEvaluation();
}

function calculateAverageEvaluation() {
  const vals = [1, 2, 3, 4].map((i) => {
    const el = document.getElementById(`evalValue${i}`);
    return el ? parseInt(el.textContent) : 0;
  });
  const avg = (vals.reduce((a, b) => a + b, 0) / vals.length).toFixed(1);
  const el = document.getElementById("evalAverageIngles");
  if (el) el.textContent = avg;
}

function saveEnglishEvaluation() {
  const g = (id) => document.getElementById(id)?.textContent ?? "0";
  const ev = {
    date: new Date().toISOString(),
    family: g("evalValue1"),
    objects: g("evalValue2"),
    pronunciation: g("evalValue3"),
    sentences: g("evalValue4"),
    average: g("evalAverageIngles"),
  };
  localStorage.setItem("englishEvaluation", JSON.stringify(ev));
  alert(
    `Self-evaluation saved:\n\nFamily: ${ev.family}\nObjects: ${ev.objects}\nPronunciation: ${ev.pronunciation}\nSentences: ${ev.sentences}\n\nAverage: ${ev.average}/5`,
  );
  showNotification("Self-evaluation saved successfully", "success");
}

// ========================================
// UI HELPERS
// ========================================

function updateCurrentWordDisplay() {
  if (!practiceWords.length) {
    clearCurrentWordDisplay();
    return;
  }
  const data = findWordData(practiceWords[currentWordIndex]);
  if (!data) return;
  const set = (id, val) => {
    const el = document.getElementById(id);
    if (el) el.textContent = val;
  };
  set("currentWordEnglish", data.english);
  set("currentWordSpanish", data.spanish);
  set("currentWordPhonetic", data.phonetic || "");
  set("exampleText", data.example || "");
}

function clearCurrentWordDisplay() {
  const set = (id, val) => {
    const el = document.getElementById(id);
    if (el) el.textContent = val;
  };
  set("currentWordEnglish", "Practice list empty");
  set("currentWordSpanish", "Add words to practice");
  set("currentWordPhonetic", "");
  set("exampleText", 'Use the "Add Words" button to start');
}

function updatePracticeChips() {
  const container = document.getElementById("practiceChips");
  if (!container) return;
  container.innerHTML = "";
  practiceWords.forEach((word, idx) => {
    const chip = document.createElement("div");
    chip.className = `word-chip${idx === currentWordIndex ? " current" : ""}`;
    chip.innerHTML = `<span class="chip-word">${word}</span>
                          <button class="chip-remove" onclick="removeFromPractice('${word}')">×</button>`;
    container.appendChild(chip);
  });
}

function updateConfidenceMeter(value) {
  const fill = document.getElementById("confidenceFill");
  const pct = document.getElementById("confidencePercent");
  if (fill) {
    fill.style.width = `${value}%`;
    fill.style.background =
      value >= 80
        ? "var(--neon-green)"
        : value >= 60
          ? "var(--neon-yellow)"
          : "var(--neon-evaluacion)";
  }
  if (pct) pct.textContent = `${Math.round(value)}%`;
}

function updateStatsDisplay() {
  const set = (id, val) => {
    const el = document.getElementById(id);
    if (el) el.textContent = val;
  };
  set("wordsPracticed", practiceStats.wordsPracticed);
  set("correctPronunciations", practiceStats.correctPronunciations);
  const acc = practiceStats.wordsPracticed
    ? Math.round(
        (practiceStats.correctPronunciations / practiceStats.wordsPracticed) *
          100,
      )
    : 0;
  set("accuracyRate", `${acc}%`);
}

function setFeedback(message, type = "info") {
  const el = document.getElementById("feedbackMessage");
  if (!el) return;
  const icons = {
    info: "💡",
    success: "✅",
    error: "❌",
    listening: "🎤",
    warning: "⚠️",
  };
  el.innerHTML = `<div class="feedback-icon">${icons[type] || "💡"}</div><div class="feedback-text">${message}</div>`;
  el.className = `feedback-message ${type}`;
}

function updateRecordingVisualizer(active) {
  const el = document.getElementById("recordingVisualizer");
  if (!el) return;
  el.innerHTML = "";
  if (!active) return;
  for (let i = 0; i < 20; i++) {
    const bar = document.createElement("div");
    bar.className = "visualizer-bar";
    bar.style.cssText = `width:3px;background:var(--neon-pink);margin:0 1px;animation:pulse ${0.5 + Math.random() * 0.5}s infinite alternate;animation-delay:${i * 0.05}s;`;
    el.appendChild(bar);
  }
}

function showExample(word) {
  showNotification(`Example: ${findWordData(word).example}`, "info");
}

function findWordData(word) {
  return (
    vocabularyData.family.find((i) => i.english === word) ||
    vocabularyData.objects.find((i) => i.english === word) || {
      english: word,
      spanish: "Not found",
      emoji: "❓",
      phonetic: "",
      example: "Not available",
    }
  );
}

function showNotification(message, type = "info") {
  let container = document.getElementById("notification-container-ingles");
  if (!container) {
    container = document.createElement("div");
    container.id = "notification-container-ingles";
    container.style.cssText =
      "position:fixed;top:20px;right:20px;z-index:10000;max-width:300px;";
    document.body.appendChild(container);
  }
  const colors = {
    success: "var(--neon-green)",
    error: "var(--neon-evaluacion)",
    warning: "var(--neon-yellow)",
    info: "var(--neon-cyan)",
  };
  const n = document.createElement("div");
  n.style.cssText = `background:${colors[type] || colors.info};color:${type === "success" || type === "warning" ? "black" : "white"};padding:12px 16px;margin:8px 0;border-radius:8px;box-shadow:0 4px 12px rgba(0,0,0,0.3);opacity:0;transform:translateX(100px);transition:all 0.3s ease;cursor:pointer;font-weight:500;`;
  n.textContent = message;
  container.appendChild(n);
  setTimeout(() => {
    n.style.opacity = "1";
    n.style.transform = "translateX(0)";
  }, 10);
  const remove = () => {
    n.style.opacity = "0";
    n.style.transform = "translateX(100px)";
    setTimeout(() => n.parentNode?.removeChild(n), 300);
  };
  setTimeout(remove, 4000);
  n.addEventListener("click", remove);
}

// ========================================
// INICIALIZACIÓN
// ========================================

document.addEventListener("DOMContentLoaded", function () {
  initializeVocabulary();

  // Cargar evaluación guardada
  try {
    const saved = localStorage.getItem("englishEvaluation");
    if (saved) {
      const d = JSON.parse(saved);
      const keys = ["family", "objects", "pronunciation", "sentences"];
      keys.forEach((k, i) => {
        const el = document.getElementById(`evalValue${i + 1}`);
        if (el) el.textContent = d[k];
      });
      const avg = document.getElementById("evalAverageIngles");
      if (avg) avg.textContent = d.average;
      document.querySelectorAll(".eval-slider").forEach((slider, i) => {
        slider.value = parseInt(d[keys[i]]) || 3;
      });
      showNotification("Previous evaluation loaded", "info");
    }
  } catch (e) {
    console.log("No previous evaluation found");
  }

  updateExamTimerDisplay();

  if (!window.speechSynthesis)
    showNotification(
      "Speech synthesis not supported. Use Chrome or Edge.",
      "warning",
    );
  if (!window.SpeechRecognition && !window.webkitSpeechRecognition)
    showNotification(
      "Speech recognition not supported. Use Chrome or Edge.",
      "warning",
    );

  setTimeout(
    () =>
      showNotification(
        "🚀 English A1 System ready. Start learning!",
        "success",
      ),
    800,
  );
  console.log("✅ vocabulary_system_fixed.js loaded");
});

// Exponer funciones al scope global
const _export = [
  "speakWord",
  "speakCurrentWord",
  "startListening",
  "nextWord",
  "repeatPractice",
  "addToPractice",
  "removeFromPractice",
  "addAllToPractice",
  "clearPracticeList",
  "showWordSelector",
  "showExample",
  "pronounceAllFamily",
  "pronounceAllObjects",
  "pronounceAllFamilyTree",
  "showFamilyRelations",
  "resetFamilyTree",
  "changeConversationTab",
  "speakDialogue",
  "practiceFullConversation",
  "startConversationRecording",
  "showConversationTips",
  "playAudio",
  "practiceWord",
  "checkSentence",
  "showSentenceHint",
  "resetSentenceBuilder",
  "speakBuiltSentence",
  "speakExample",
  "selectAnswer",
  "startExamRecording",
  "submitExam",
  "resetExam",
  "startExamTimer",
  "updateEvaluation",
  "saveEnglishEvaluation",
];
_export.forEach((fn) => {
  if (typeof eval(fn) === "function") window[fn] = eval(fn);
});
