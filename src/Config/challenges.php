<?php
return [
    'prog-sum-array' => [
        'materia' => 'Programación',
        'title' => 'Suma de elementos',
        'difficulty' => 'Fácil',
        'type' => 'code',
        'points' => 10,
        'description' => 'Crea una función que sume todos los elementos de un arreglo numérico.',
        'theory' => 'Arrays: estructuras que almacenan múltiples valores. Acceso por índice (comienza en 0).',
        'examples' => '[1,2,3] → 6 | [5,-2,7] → 10 | [0,0,0] → 0',
        'hint' => 'Usa un bucle for o el método reduce().',
        'starter' => "function solve(arr) {\n  // Suma todos los elementos\n  return 0;\n}",
        'tests' => [
            ['input' => [[1,2,3]], 'expected' => 6],
            ['input' => [[5,-2,7]], 'expected' => 10],
            ['input' => [[0,0,0]], 'expected' => 0],
            ['input' => [[100]], 'expected' => 100],
            ['input' => [[-5,-3,-2]], 'expected' => -10],
        ]
    ],
    'prog-palindromo' => [
        'materia' => 'Programación',
        'title' => 'Verificar palíndromo',
        'difficulty' => 'Medio',
        'type' => 'code',
        'points' => 15,
        'description' => 'Verifica si un texto es un palíndromo (se lee igual al derecho y al revés). Ignora espacios y mayúsculas.',
        'theory' => 'Palíndromos: textos que se leen igual en ambas direcciones después de normalizar.',
        'examples' => '"Anita lava la tina" → true | "Radar" → true | "Hola" → false',
        'hint' => 'Usa toLowerCase(), replace(/\\s+/g, "") y split("").reverse().join("")',
        'starter' => "function solve(text) {\n  // Normaliza y verifica si es palíndromo\n  return false;\n}",
        'tests' => [
            ['input' => ['Anita lava la tina'], 'expected' => true],
            ['input' => ['Radar'], 'expected' => true],
            ['input' => ['Hola mundo'], 'expected' => false],
            ['input' => ['A'], 'expected' => true],
            ['input' => ['Ab'], 'expected' => false],
        ]
    ],
    'prog-fizzbuzz' => [
        'materia' => 'Programación',
        'title' => 'FizzBuzz',
        'difficulty' => 'Fácil',
        'type' => 'code',
        'points' => 10,
        'description' => 'Múltiplo de 3→"Fizz", de 5→"Buzz", ambos→"FizzBuzz", ninguno→número como string',
        'theory' => 'Condicionales y operador módulo (%)',
        'examples' => 'solve(5) → ["1","2","Fizz","4","Buzz"]',
        'hint' => 'Usa un bucle y verifica: i%3===0, i%5===0',
        'starter' => "function solve(n) {\n  // Retorna array con FizzBuzz\n  return [];\n}",
        'tests' => [
            ['input' => [5], 'expected' => ['1','2','Fizz','4','Buzz']],
            ['input' => [15], 'expected' => ['1','2','Fizz','4','Buzz','Fizz','7','8','Fizz','Buzz','11','Fizz','13','14','FizzBuzz']],
        ]
    ],
    'prog-fibonacci' => [
        'materia' => 'Programación',
        'title' => 'Fibonacci',
        'difficulty' => 'Medio',
        'type' => 'code',
        'points' => 15,
        'description' => 'Genera los primeros n números de Fibonacci (comenzando con 1,1)',
        'theory' => 'Sucesión: 1,1,2,3,5,8... donde cada número es la suma de los dos anteriores.',
        'examples' => 'solve(6) → [1,1,2,3,5,8]',
        'hint' => 'Usa un bucle con dos variables para los últimos dos números',
        'starter' => "function solve(n) {\n  // Retorna array con n números de Fibonacci\n  return [];\n}",
        'tests' => [
            ['input' => [6], 'expected' => [1,1,2,3,5,8]],
            ['input' => [1], 'expected' => [1]],
            ['input' => [2], 'expected' => [1,1]],
            ['input' => [10], 'expected' => [1,1,2,3,5,8,13,21,34,55]],
        ]
    ],
    'prog-closure' => [
        'materia' => 'Programación',
        'title' => 'Closures',
        'difficulty' => 'Difícil',
        'type' => 'code',
        'points' => 20,
        'description' => 'Crea una función que retorna otra función multiplicadora',
        'theory' => 'Closures: función que recuerda el contexto donde fue creada',
        'examples' => 'solve(2)(5) → 10',
        'hint' => 'Función externa recibe factor, retorna función interna que multiplica',
        'starter' => "function solve(factor) {\n  // Retorna función multiplicadora\n  return function(x) { return 0; };\n}",
        'tests' => [
            ['input' => [2, 5], 'expected' => 10],
            ['input' => [3, 4], 'expected' => 12],
            ['input' => [5, 1], 'expected' => 5],
        ]
    ],
    'mat-derivada' => [
        'materia' => 'Pensamiento Matemático III',
        'title' => 'Derivada básica',
        'difficulty' => 'Medio',
        'type' => 'math',
        'points' => 12,
        'description' => 'Calcula la derivada de f(x)=ax²+bx+c en x=x₀',
        'theory' => 'La derivada mide la tasa de cambio instantánea. Regla: $$\\frac{d}{dx}[x^n] = nx^{n-1}$$',
        'examples' => 'f\'(x) = 2ax + b → f\'(x₀) = 2ax₀ + b',
        'hint' => 'Deriva cada término: ax²→2ax, bx→b, c→0',
        'input_type' => 'formula',
        'params' => [
            ['name' => 'a', 'label' => 'Coeficiente \(a\)', 'type' => 'slider', 'min' => -5, 'max' => 5, 'value' => 3],
            ['name' => 'b', 'label' => 'Coeficiente \(b\)', 'type' => 'slider', 'min' => -10, 'max' => 10, 'value' => 2],
            ['name' => 'x', 'label' => 'Evaluar en \(x_0\)', 'type' => 'slider', 'min' => -5, 'max' => 5, 'value' => 2],
        ],
        'calculate' => 'a * 2 * x + b',
        'answer' => 14,
        'formula' => 'f\'(x_0) = 2ax_0 + b',
        'visualize' => false,
    ],
    'mat-integral' => [
        'materia' => 'Pensamiento Matemático III',
        'title' => 'Integral definida',
        'difficulty' => 'Medio',
        'type' => 'math',
        'points' => 16,
        'description' => 'Calcula la integral definida \(\\int_a^b (mx + n) dx\)',
        'theory' => 'Integral definida: $$\\int_a^b f(x)dx = F(b) - F(a)$$ donde F es la antiderivada.',
        'examples' => '\\(\\int_0^2 (2x + 1)dx = [x^2 + x]_0^2 = 6\\)',
        'hint' => 'Antiderivada de mx es mx²/2, de n es nx',
        'input_type' => 'number',
        'params' => [
            ['name' => 'm', 'label' => 'Pendiente \(m\)', 'type' => 'slider', 'min' => 1, 'max' => 5, 'value' => 2],
            ['name' => 'n', 'label' => 'Intersección \(n\)', 'type' => 'slider', 'min' => 0, 'max' => 5, 'value' => 1],
            ['name' => 'a', 'label' => 'Límite inferior \(a\)', 'type' => 'slider', 'min' => 0, 'max' => 3, 'value' => 0],
            ['name' => 'b', 'label' => 'Límite superior \(b\)', 'type' => 'slider', 'min' => 1, 'max' => 5, 'value' => 2],
        ],
        'calculate' => '(m*b*b/2 + n*b) - (m*a*a/2 + n*a)',
        'answer' => 6,
        'visualize' => false,
    ],
    'mat-funcion' => [
        'materia' => 'Pensamiento Matemático III',
        'title' => 'Evaluar función cuadrática',
        'difficulty' => 'Fácil',
        'type' => 'math',
        'points' => 10,
        'description' => 'Evalúa la función cuadrática \(f(x) = ax^2 + bx + c\)',
        'theory' => 'Función cuadrática: $$f(x) = ax^2 + bx + c$$ donde a≠0',
        'examples' => 'f(2) con a=1,b=-3,c=2 → 1(4) -3(2) + 2 = 0',
        'hint' => 'Sustituye x en la fórmula',
        'input_type' => 'number',
        'params' => [
            ['name' => 'a', 'label' => 'a =', 'type' => 'slider', 'min' => -5, 'max' => 5, 'value' => 1],
            ['name' => 'b', 'label' => 'b =', 'type' => 'slider', 'min' => -10, 'max' => 10, 'value' => -3],
            ['name' => 'c', 'label' => 'c =', 'type' => 'slider', 'min' => -10, 'max' => 10, 'value' => 2],
            ['name' => 'x', 'label' => 'x =', 'type' => 'slider', 'min' => -5, 'max' => 5, 'value' => 2],
        ],
        'calculate' => 'a*x*x + b*x + c',
        'answer' => 0,
        'visualize' => true,
    ],
    'fis-velocidad' => [
        'materia' => 'Física I',
        'title' => 'Velocidad promedio',
        'difficulty' => 'Fácil',
        'type' => 'physics',
        'points' => 10,
        'description' => 'Calcula la velocidad promedio: $$v = \\frac{d}{t}$$',
        'theory' => 'Velocidad = distancia / tiempo. Unidad: km/h o m/s',
        'examples' => '120km en 2h → 60 km/h',
        'hint' => 'Simple: velocidad = distancia ÷ tiempo',
        'input_type' => 'number',
        'params' => [
            ['name' => 'distancia', 'label' => 'Distancia (km)', 'type' => 'slider', 'min' => 10, 'max' => 200, 'value' => 120],
            ['name' => 'tiempo', 'label' => 'Tiempo (horas)', 'type' => 'slider', 'min' => 0.5, 'max' => 5, 'step' => 0.5, 'value' => 2],
        ],
        'calculate' => 'distancia / tiempo',
        'answer' => 60,
    ],
    'fis-energia' => [
        'materia' => 'Física I',
        'title' => 'Energía cinética',
        'difficulty' => 'Medio',
        'type' => 'physics',
        'points' => 13,
        'description' => 'Calcula la energía cinética: $$E_c = \\frac{1}{2}mv^2$$',
        'theory' => 'Energía cinética: Ec = ½mv². Unidad: Joules (J)',
        'examples' => 'm=5kg, v=10m/s → Ec = 250 J',
        'hint' => 'No olvides el ½ y que v está al cuadrado',
        'input_type' => 'number',
        'params' => [
            ['name' => 'masa', 'label' => 'Masa (kg)', 'type' => 'slider', 'min' => 1, 'max' => 20, 'value' => 5],
            ['name' => 'velocidad', 'label' => 'Velocidad (m/s)', 'type' => 'slider', 'min' => 1, 'max' => 30, 'value' => 10],
        ],
        'calculate' => '0.5 * masa * velocidad * velocidad',
        'answer' => 250,
    ],
    'fis-fuerza' => [
        'materia' => 'Física I',
        'title' => 'Segunda ley de Newton',
        'difficulty' => 'Medio',
        'type' => 'physics',
        'points' => 12,
        'description' => 'Calcula la fuerza: $$F = ma$$',
        'theory' => 'Segunda Ley de Newton: F = m × a. Fuerza en Newtons (N)',
        'examples' => 'm=10kg, a=5m/s² → F = 50 N',
        'hint' => 'Multiplica masa por aceleración',
        'input_type' => 'number',
        'params' => [
            ['name' => 'masa', 'label' => 'Masa (kg)', 'type' => 'slider', 'min' => 1, 'max' => 50, 'value' => 10],
            ['name' => 'aceleracion', 'label' => 'Aceleración (m/s²)', 'type' => 'slider', 'min' => 1, 'max' => 20, 'value' => 5],
        ],
        'calculate' => 'masa * aceleracion',
        'answer' => 50,
    ],
    'quim-mol' => [
        'materia' => 'Química I',
        'title' => 'Cálculo de moles',
        'difficulty' => 'Fácil',
        'type' => 'chemistry',
        'points' => 10,
        'description' => 'Calcula moles: $$n = \\frac{m}{M}$$',
        'theory' => 'Moles = masa / masa molar. 1 mol = 6.022×10²³ partículas',
        'examples' => '18g de H₂O (M=18) → 1 mol',
        'hint' => 'Fórmula: moles = masa ÷ masa molar',
        'input_type' => 'number',
        'params' => [
            ['name' => 'masa', 'label' => 'Masa (g)', 'type' => 'slider', 'min' => 1, 'max' => 100, 'value' => 18],
            ['name' => 'molar', 'label' => 'Masa molar (g/mol)', 'type' => 'slider', 'min' => 1, 'max' => 200, 'value' => 18],
        ],
        'calculate' => 'masa / molar',
        'answer' => 1,
    ],
    'quim-ph' => [
        'materia' => 'Química I',
        'title' => 'pH de solución',
        'difficulty' => 'Medio',
        'type' => 'chemistry',
        'points' => 12,
        'description' => 'Calcula el pH: $$pH = -\\log[H^+]$$',
        'theory' => 'pH = -log₁₀[H⁺]. Escala: <7 ácido, =7 neutro, >7 básico',
        'examples' => '[H⁺]=10⁻³ → pH=3',
        'hint' => 'log₁₀(10ⁿ) = n',
        'input_type' => 'number',
        'params' => [
            ['name' => 'exponente', 'label' => 'Exponente de [H⁺] = 10^x', 'type' => 'slider', 'min' => -14, 'max' => 0, 'value' => -3],
        ],
        'calculate' => '-exponente',
        'answer' => 3,
    ],
    'quim-masa' => [
        'materia' => 'Química I',
        'title' => 'Masa molecular',
        'difficulty' => 'Fácil',
        'type' => 'chemistry',
        'points' => 10,
        'description' => 'Calcula la masa molecular: $$M = \\sum m_i n_i$$',
        'theory' => 'Masa molecular = Σ masas atómicas de los elementos',
        'examples' => 'H₂O: 2(1) + 16 = 18 g/mol',
        'hint' => 'Cuenta cuántos átomos de cada elemento',
        'input_type' => 'number',
        'params' => [
            ['name' => 'H', 'label' => 'Átomos de H (masa=1)', 'type' => 'slider', 'min' => 0, 'max' => 10, 'value' => 2],
            ['name' => 'O', 'label' => 'Átomos de O (masa=16)', 'type' => 'slider', 'min' => 0, 'max' => 5, 'value' => 1],
        ],
        'calculate' => 'H * 1 + O * 16',
        'answer' => 18,
    ],
    'eco-cadena' => [
        'materia' => 'Ecosistemas',
        'title' => 'Eficiencia energética',
        'difficulty' => 'Fácil',
        'type' => 'simulation',
        'points' => 10,
        'description' => '¿Cuánta energía se transfiere entre niveles tróficos?',
        'theory' => '~10% se transfiere, 90% se pierde como calor. Segunda Ley de Termodinámica.',
        'examples' => '1000kcal → 100kcal → 10kcal',
        'hint' => 'Regla del 10%',
        'input_type' => 'number',
        'params' => [
            ['name' => 'energia', 'label' => 'Energía nivel anterior (kcal)', 'type' => 'slider', 'min' => 100, 'max' => 10000, 'value' => 1000],
        ],
        'calculate' => 'energia * 0.1',
        'answer' => 100,
        'visualize' => true,
    ],
    'eco-fotosintesis' => [
        'materia' => 'Ecosistemas',
        'title' => 'Productores primarios',
        'difficulty' => 'Fácil',
        'type' => 'simulation',
        'points' => 10,
        'description' => 'Simula la producción de glucosa por fotosíntesis',
        'theory' => '6CO₂ + 6H₂O + luz → C₆H₁₂O₆ + 6O₂',
        'examples' => 'Luz → Glucosa + Oxígeno',
        'hint' => 'Las plantas son autótrofos',
        'input_type' => 'number',
        'params' => [
            ['name' => 'luz', 'label' => 'Intensidad de luz (%)', 'type' => 'slider', 'min' => 0, 'max' => 100, 'value' => 50],
        ],
        'calculate' => 'luz * 0.01 * 6',
    ],
    'eco-poblacion' => [
        'materia' => 'Ecosistemas',
        'title' => 'Crecimiento poblacional',
        'difficulty' => 'Medio',
        'type' => 'simulation',
        'points' => 12,
        'description' => 'Simula el crecimiento exponencial: $$P(t) = P_0 e^{rt}$$',
        'theory' => 'Crecimiento exponencial: P(t) = P₀ × e^(rt)',
        'examples' => '100 conejos, r=0.5 → ~270 en 2 años',
        'hint' => 'Población crece exponencialmente',
        'input_type' => 'number',
        'params' => [
            ['name' => 'P0', 'label' => 'Población inicial', 'type' => 'slider', 'min' => 10, 'max' => 500, 'value' => 100],
            ['name' => 'r', 'label' => 'Tasa de crecimiento r', 'type' => 'slider', 'min' => 0.1, 'max' => 1.0, 'step' => 0.1, 'value' => 0.5],
            ['name' => 't', 'label' => 'Tiempo (años)', 'type' => 'slider', 'min' => 1, 'max' => 5, 'value' => 2],
        ],
        'calculate' => 'P0 * Math.exp(r * t)',
        'answer' => 271,
    ],
    'prog-reverse' => array (
  'materia' => 'Programación',
  'title' => 'Invertir cadena',
  'difficulty' => 'Fácil',
  'type' => 'code',
  'points' => 10,
  'language' => 'javascript',
  'description' => 'Invierte una cadena de texto.',
  'theory' => 'Recorre la cadena desde el final o usa split/reverse/join.',
  'hint' => 'Usa .split().reverse().join() en JS.',
  'starter' => 'function solve(str) { return str; }',
  'starters' => 
  array (
    'javascript' => 'function solve(str) { return str; }',
    'python' => 'def solve(str): return str',
  ),
  'tests' => 
  array (
    0 => 
    array (
      'input' => 
      array (
        0 => 
        array (
          0 => 'hola',
        ),
      ),
      'expected' => 'aloh',
    ),
    1 => 
    array (
      'input' => 
      array (
        0 => 
        array (
          0 => 'radar',
        ),
      ),
      'expected' => 'radar',
    ),
    2 => 
    array (
      'input' => 
      array (
        0 => 
        array (
          0 => 'abc',
        ),
      ),
      'expected' => 'cba',
    ),
  ),
),
    'prog-fizzbuzz' => array (
  'materia' => 'Programación',
  'title' => 'FizzBuzz',
  'difficulty' => 'Fácil',
  'type' => 'code',
  'points' => 14,
  'language' => 'javascript',
  'description' => 'Devuelve Fizz si n es múltiplo de 3, Buzz si es múltiplo de 5, FizzBuzz si ambos.',
  'theory' => 'Usa el operador % (módulo) para verificar divisibilidad.',
  'hint' => 'Revisa primero si es múltiplo de 15.',
  'starter' => 'function solve(n) { return ""; }',
  'starters' => 
  array (
    'javascript' => 'function solve(n) { return ""; }',
    'python' => 'def solve(n): return ""',
  ),
  'tests' => 
  array (
    0 => 
    array (
      'input' => 
      array (
        0 => 3,
      ),
      'expected' => 'Fizz',
    ),
    1 => 
    array (
      'input' => 
      array (
        0 => 5,
      ),
      'expected' => 'Buzz',
    ),
    2 => 
    array (
      'input' => 
      array (
        0 => 15,
      ),
      'expected' => 'FizzBuzz',
    ),
    3 => 
    array (
      'input' => 
      array (
        0 => 2,
      ),
      'expected' => '2',
    ),
  ),
),
    'prog-prime' => array (
  'materia' => 'Programación',
  'title' => 'Número primo',
  'difficulty' => 'Medio',
  'type' => 'code',
  'points' => 18,
  'language' => 'javascript',
  'description' => 'Determina si un número es primo.',
  'theory' => 'Un número primo > 1 solo es divisible por 1 y sí mismo.',
  'hint' => 'Usa un bucle desde 2 hasta sqrt(n).',
  'starter' => 'function solve(n) { return false; }',
  'starters' => 
  array (
    'javascript' => 'function solve(n) { return false; }',
    'python' => 'def solve(n): return False',
  ),
  'tests' => 
  array (
    0 => 
    array (
      'input' => 
      array (
        0 => 7,
      ),
      'expected' => true,
    ),
    1 => 
    array (
      'input' => 
      array (
        0 => 4,
      ),
      'expected' => false,
    ),
    2 => 
    array (
      'input' => 
      array (
        0 => 2,
      ),
      'expected' => true,
    ),
    3 => 
    array (
      'input' => 
      array (
        0 => 13,
      ),
      'expected' => true,
    ),
  ),
),
    'prog-count-chars' => array (
  'materia' => 'Programación',
  'title' => 'Contar caracteres',
  'difficulty' => 'Fácil',
  'type' => 'code',
  'points' => 8,
  'language' => 'javascript',
  'description' => 'Devuelve el número de caracteres de una cadena.',
  'theory' => 'Usa .length.',
  'hint' => 'return str.length',
  'starter' => 'function solve(str) { return 0; }',
  'starters' => 
  array (
    'javascript' => 'function solve(str) { return 0; }',
    'python' => 'def solve(str): return 0',
  ),
  'tests' => 
  array (
    0 => 
    array (
      'input' => 
      array (
        0 => 
        array (
          0 => 'hola',
        ),
      ),
      'expected' => 4,
    ),
    1 => 
    array (
      'input' => 
      array (
        0 => 
        array (
          0 => '',
        ),
      ),
      'expected' => 0,
    ),
    2 => 
    array (
      'input' => 
      array (
        0 => 
        array (
          0 => 'abcdef',
        ),
      ),
      'expected' => 6,
    ),
  ),
),
    'prog-binary-search' => array (
  'materia' => 'Programación',
  'title' => 'Búsqueda binaria',
  'difficulty' => 'Difícil',
  'type' => 'code',
  'points' => 25,
  'language' => 'javascript',
  'description' => 'Implementa búsqueda binaria en arreglo ordenado.',
  'theory' => 'Divide y vencerás. O(log n).',
  'hint' => 'Mantén punteros left, right y calcula mid.',
  'starter' => 'function solve(arr, target) { return -1; }',
  'starters' => 
  array (
    'javascript' => 'function solve(arr, target) { return -1; }',
    'python' => 'def solve(arr, target): return -1',
  ),
  'tests' => 
  array (
    0 => 
    array (
      'input' => 
      array (
        0 => 
        array (
          0 => 
          array (
            0 => 1,
            1 => 3,
            2 => 5,
            3 => 7,
            4 => 9,
          ),
          1 => 5,
        ),
      ),
      'expected' => 2,
    ),
    1 => 
    array (
      'input' => 
      array (
        0 => 
        array (
          0 => 
          array (
            0 => 1,
            1 => 3,
            2 => 5,
            3 => 7,
            4 => 9,
          ),
          1 => 2,
        ),
      ),
      'expected' => -1,
    ),
    2 => 
    array (
      'input' => 
      array (
        0 => 
        array (
          0 => 
          array (
            0 => 1,
            1 => 3,
            2 => 5,
            3 => 7,
            4 => 9,
          ),
          1 => 9,
        ),
      ),
      'expected' => 4,
    ),
  ),
),
    'prog-anagram' => array (
  'materia' => 'Programación',
  'title' => 'Anagrama',
  'difficulty' => 'Medio',
  'type' => 'code',
  'points' => 16,
  'language' => 'javascript',
  'description' => 'Determina si dos cadenas son anagramas.',
  'theory' => 'Ordena ambas y compara.',
  'hint' => 'split.sort.join en ambas.',
  'starter' => 'function solve(a, b) { return false; }',
  'starters' => 
  array (
    'javascript' => 'function solve(a, b) { return false; }',
    'python' => 'def solve(a, b): return False',
  ),
  'tests' => 
  array (
    0 => 
    array (
      'input' => 
      array (
        0 => 
        array (
          0 => 'listen',
          1 => 'silent',
        ),
      ),
      'expected' => true,
    ),
    1 => 
    array (
      'input' => 
      array (
        0 => 
        array (
          0 => 'hola',
          1 => 'halo',
        ),
      ),
      'expected' => true,
    ),
    2 => 
    array (
      'input' => 
      array (
        0 => 
        array (
          0 => 'abc',
          1 => 'def',
        ),
      ),
      'expected' => false,
    ),
  ),
),
    'prog-remove-duplicates' => array (
  'materia' => 'Programación',
  'title' => 'Eliminar duplicados',
  'difficulty' => 'Medio',
  'type' => 'code',
  'points' => 14,
  'language' => 'javascript',
  'description' => 'Elimina elementos duplicados de un arreglo.',
  'theory' => 'Usa un Set.',
  'hint' => 'return [...new Set(arr)]',
  'starter' => 'function solve(arr) { return arr; }',
  'starters' => 
  array (
    'javascript' => 'function solve(arr) { return arr; }',
    'python' => 'def solve(arr): return arr',
  ),
  'tests' => 
  array (
    0 => 
    array (
      'input' => 
      array (
        0 => 
        array (
          0 => 
          array (
            0 => 1,
            1 => 2,
            2 => 2,
            3 => 3,
            4 => 3,
            5 => 3,
          ),
        ),
      ),
      'expected' => 
      array (
        0 => 1,
        1 => 2,
        2 => 3,
      ),
    ),
    1 => 
    array (
      'input' => 
      array (
        0 => 
        array (
          0 => 
          array (
            0 => 1,
            1 => 1,
            2 => 1,
          ),
        ),
      ),
      'expected' => 
      array (
        0 => 1,
      ),
    ),
  ),
),
    'prog-average' => array (
  'materia' => 'Programación',
  'title' => 'Promedio',
  'difficulty' => 'Fácil',
  'type' => 'code',
  'points' => 10,
  'language' => 'javascript',
  'description' => 'Calcula el promedio de un arreglo de números.',
  'theory' => 'Suma y divide entre cantidad.',
  'hint' => 'reduce + divide por length.',
  'starter' => 'function solve(arr) { return 0; }',
  'starters' => 
  array (
    'javascript' => 'function solve(arr) { return 0; }',
    'python' => 'def solve(arr): return 0',
  ),
  'tests' => 
  array (
    0 => 
    array (
      'input' => 
      array (
        0 => 
        array (
          0 => 
          array (
            0 => 1,
            1 => 2,
            2 => 3,
            3 => 4,
            4 => 5,
          ),
        ),
      ),
      'expected' => 3,
    ),
    1 => 
    array (
      'input' => 
      array (
        0 => 
        array (
          0 => 
          array (
            0 => 10,
            1 => 20,
            2 => 30,
          ),
        ),
      ),
      'expected' => 20,
    ),
  ),
),
    'prog-two-sum' => array (
  'materia' => 'Programación',
  'title' => 'Two Sum',
  'difficulty' => 'Medio',
  'type' => 'code',
  'points' => 20,
  'language' => 'javascript',
  'description' => 'Encuentra dos índices cuyos valores sumen target.',
  'theory' => 'Mapa número a índice. O(n).',
  'hint' => 'Por cada número busca complemento en mapa.',
  'starter' => 'function solve(nums, target) { return [0, 0]; }',
  'starters' => 
  array (
    'javascript' => 'function solve(nums, target) { return [0, 0]; }',
    'python' => 'def solve(nums, target): return [0, 0]',
  ),
  'tests' => 
  array (
    0 => 
    array (
      'input' => 
      array (
        0 => 
        array (
          0 => 
          array (
            0 => 2,
            1 => 7,
            2 => 11,
            3 => 15,
          ),
          1 => 9,
        ),
      ),
      'expected' => 
      array (
        0 => 0,
        1 => 1,
      ),
    ),
    1 => 
    array (
      'input' => 
      array (
        0 => 
        array (
          0 => 
          array (
            0 => 3,
            1 => 2,
            2 => 4,
          ),
          1 => 6,
        ),
      ),
      'expected' => 
      array (
        0 => 1,
        1 => 2,
      ),
    ),
  ),
),
    'mat-derivative-product' => array (
  'materia' => 'Pensamiento Matemático III',
  'title' => 'Regla del producto',
  'difficulty' => 'Difícil',
  'type' => 'calculator',
  'points' => 22,
  'category' => 'Cálculo Diferencial',
  'description' => 'Aplica la regla del producto.',
  'theory' => '**Regla del Producto:** $$\\frac{d}{dx}[f\\cdot g] = f\\cdot g + f\\cdot g$$',
  'hint' => 'Deriva cada factor por separado.',
  'input_type' => 'math',
  'params' => 
  array (
    0 => 
    array (
      'name' => 'a',
      'label' => 'a en ax³',
      'type' => 'slider',
      'min' => 1,
      'max' => 5,
      'value' => 2,
      'step' => 1,
    ),
    1 => 
    array (
      'name' => 'b',
      'label' => 'b en bx²',
      'type' => 'slider',
      'min' => 1,
      'max' => 5,
      'value' => 3,
      'step' => 1,
    ),
    2 => 
    array (
      'name' => 'x0',
      'label' => 'Evaluar en x₀',
      'type' => 'slider',
      'min' => 1,
      'max' => 5,
      'value' => 2,
      'step' => 0.5,
    ),
  ),
  'calculate' => '5*a*b*Math.pow(x0,4)',
  'formula_latex' => '\\frac{d}{dx}[ax^3\\cdot bx^2] = 5abx^4',
  'answer' => 480,
  'visualize' => true,
),
    'mat-logarithm' => array (
  'materia' => 'Pensamiento Matemático III',
  'title' => 'Calculadora de logaritmos',
  'difficulty' => 'Medio',
  'type' => 'calculator',
  'points' => 15,
  'category' => 'Álgebra',
  'description' => 'Calcula log_b(a).',
  'theory' => '**Logaritmo:** $$\\log_b(a)=x \\Leftrightarrow b^x=a$$',
  'input_type' => 'math',
  'params' => 
  array (
    0 => 
    array (
      'name' => 'a',
      'label' => 'Argumento a',
      'type' => 'slider',
      'min' => 1,
      'max' => 100,
      'value' => 8,
      'step' => 1,
    ),
    1 => 
    array (
      'name' => 'base',
      'label' => 'Base',
      'type' => 'slider',
      'min' => 2,
      'max' => 10,
      'value' => 2,
      'step' => 1,
    ),
  ),
  'calculate' => 'Math.log(a)/Math.log(base)',
  'formula_latex' => '\\log_{base}({a})',
  'answer' => 3,
),
    'mat-matrix-mult' => array (
  'materia' => 'Pensamiento Matemático III',
  'title' => 'Producto punto',
  'difficulty' => 'Medio',
  'type' => 'calculator',
  'points' => 16,
  'category' => 'Álgebra Lineal',
  'description' => 'Producto punto entre vectores en R³.',
  'theory' => '**Producto punto:** $$\\vec{u}\\cdot\\vec{v}=u_1v_1+u_2v_2+u_3v_3$$',
  'input_type' => 'math',
  'params' => 
  array (
    0 => 
    array (
      'name' => 'u1',
      'label' => 'u₁',
      'type' => 'slider',
      'min' => -5,
      'max' => 5,
      'value' => 2,
      'step' => 1,
    ),
    1 => 
    array (
      'name' => 'u2',
      'label' => 'u₂',
      'type' => 'slider',
      'min' => -5,
      'max' => 5,
      'value' => 3,
      'step' => 1,
    ),
    2 => 
    array (
      'name' => 'u3',
      'label' => 'u₃',
      'type' => 'slider',
      'min' => -5,
      'max' => 5,
      'value' => 1,
      'step' => 1,
    ),
    3 => 
    array (
      'name' => 'v1',
      'label' => 'v₁',
      'type' => 'slider',
      'min' => -5,
      'max' => 5,
      'value' => 4,
      'step' => 1,
    ),
    4 => 
    array (
      'name' => 'v2',
      'label' => 'v₂',
      'type' => 'slider',
      'min' => -5,
      'max' => 5,
      'value' => -1,
      'step' => 1,
    ),
    5 => 
    array (
      'name' => 'v3',
      'label' => 'v₃',
      'type' => 'slider',
      'min' => -5,
      'max' => 5,
      'value' => 2,
      'step' => 1,
    ),
  ),
  'calculate' => 'u1*v1+u2*v2+u3*v3',
  'formula_latex' => '\\vec{u}\\cdot\\vec{v}',
  'answer' => 7,
),
    'fis-work' => array (
  'materia' => 'Física I',
  'title' => 'Trabajo mecánico',
  'difficulty' => 'Medio',
  'type' => 'calculator',
  'points' => 15,
  'category' => 'Trabajo y Energía',
  'description' => 'W = F d cos(theta).',
  'theory' => '**Trabajo:** $$W=Fd\\cos\\theta$$',
  'input_type' => 'physics',
  'params' => 
  array (
    0 => 
    array (
      'name' => 'F',
      'label' => 'Fuerza (N)',
      'type' => 'slider',
      'min' => 1,
      'max' => 100,
      'value' => 50,
      'step' => 1,
    ),
    1 => 
    array (
      'name' => 'd',
      'label' => 'Distancia (m)',
      'type' => 'slider',
      'min' => 1,
      'max' => 50,
      'value' => 10,
      'step' => 1,
    ),
    2 => 
    array (
      'name' => 'theta',
      'label' => 'Ángulo θ',
      'type' => 'slider',
      'min' => 0,
      'max' => 90,
      'value' => 0,
      'step' => 5,
    ),
  ),
  'calculate' => 'F*d*Math.cos(theta*Math.PI/180)',
  'formula_latex' => 'W=Fd\\cos\\theta',
  'answer' => 500,
),
    'fis-power' => array (
  'materia' => 'Física I',
  'title' => 'Potencia',
  'difficulty' => 'Fácil',
  'type' => 'calculator',
  'points' => 12,
  'category' => 'Trabajo y Energía',
  'description' => 'P = W / t.',
  'theory' => '**Potencia:** $$P=W/t$$',
  'input_type' => 'physics',
  'params' => 
  array (
    0 => 
    array (
      'name' => 'trabajo',
      'label' => 'Trabajo (J)',
      'type' => 'slider',
      'min' => 100,
      'max' => 5000,
      'value' => 1000,
      'step' => 100,
    ),
    1 => 
    array (
      'name' => 'tiempo',
      'label' => 'Tiempo (s)',
      'type' => 'slider',
      'min' => 1,
      'max' => 60,
      'value' => 10,
      'step' => 1,
    ),
  ),
  'calculate' => 'trabajo/tiempo',
  'formula_latex' => 'P=W/t',
  'answer' => 100,
),
    'fis-density' => array (
  'materia' => 'Física I',
  'title' => 'Densidad',
  'difficulty' => 'Fácil',
  'type' => 'calculator',
  'points' => 10,
  'category' => 'Propiedades',
  'description' => 'rho = m / V.',
  'theory' => '**Densidad:** $$\\rho=m/V$$',
  'input_type' => 'physics',
  'params' => 
  array (
    0 => 
    array (
      'name' => 'masa',
      'label' => 'Masa (kg)',
      'type' => 'slider',
      'min' => 1,
      'max' => 100,
      'value' => 10,
      'step' => 1,
    ),
    1 => 
    array (
      'name' => 'volumen',
      'label' => 'Volumen (m³)',
      'type' => 'slider',
      'min' => 0.1,
      'max' => 10,
      'value' => 2,
      'step' => 0.1,
    ),
  ),
  'calculate' => 'masa/volumen',
  'formula_latex' => '\\rho=m/V',
  'answer' => 5,
),
    'fis-pressure' => array (
  'materia' => 'Física I',
  'title' => 'Presión hidrostática',
  'difficulty' => 'Medio',
  'type' => 'calculator',
  'points' => 15,
  'category' => 'Fluidos',
  'description' => 'P = rho g h.',
  'theory' => '**Presión:** $$P=\\rho g h$$',
  'input_type' => 'physics',
  'params' => 
  array (
    0 => 
    array (
      'name' => 'densidad',
      'label' => 'ρ (kg/m³)',
      'type' => 'slider',
      'min' => 500,
      'max' => 2000,
      'value' => 1000,
      'step' => 50,
    ),
    1 => 
    array (
      'name' => 'profundidad',
      'label' => 'h (m)',
      'type' => 'slider',
      'min' => 1,
      'max' => 50,
      'value' => 10,
      'step' => 1,
    ),
  ),
  'calculate' => 'densidad*9.81*profundidad',
  'formula_latex' => 'P=\\rho g h',
  'answer' => 98100,
),
    'fis-ohms' => array (
  'materia' => 'Física I',
  'title' => 'Ley de Ohm',
  'difficulty' => 'Fácil',
  'type' => 'calculator',
  'points' => 10,
  'category' => 'Electricidad',
  'description' => 'V = I R.',
  'theory' => '**Ley de Ohm:** $$V=IR$$',
  'input_type' => 'physics',
  'params' => 
  array (
    0 => 
    array (
      'name' => 'I',
      'label' => 'Corriente I (A)',
      'type' => 'slider',
      'min' => 0.1,
      'max' => 10,
      'value' => 2,
      'step' => 0.1,
    ),
    1 => 
    array (
      'name' => 'R',
      'label' => 'Resistencia R (Ω)',
      'type' => 'slider',
      'min' => 1,
      'max' => 100,
      'value' => 10,
      'step' => 1,
    ),
  ),
  'calculate' => 'I*R',
  'formula_latex' => 'V=IR',
  'answer' => 20,
),
    'fis-wave' => array (
  'materia' => 'Física I',
  'title' => 'Velocidad de onda',
  'difficulty' => 'Medio',
  'type' => 'calculator',
  'points' => 14,
  'category' => 'Ondas',
  'description' => 'v = lambda f.',
  'theory' => '**Onda:** $$v=\\lambda f$$',
  'input_type' => 'physics',
  'params' => 
  array (
    0 => 
    array (
      'name' => 'lambda',
      'label' => 'λ (m)',
      'type' => 'slider',
      'min' => 0.1,
      'max' => 10,
      'value' => 2,
      'step' => 0.1,
    ),
    1 => 
    array (
      'name' => 'f',
      'label' => 'f (Hz)',
      'type' => 'slider',
      'min' => 1,
      'max' => 100,
      'value' => 50,
      'step' => 1,
    ),
  ),
  'calculate' => 'lambda*f',
  'formula_latex' => 'v=\\lambda f',
  'answer' => 100,
),
    'qui-ph' => array (
  'materia' => 'Química I',
  'title' => 'Calculadora de pH',
  'difficulty' => 'Medio',
  'type' => 'calculator',
  'points' => 15,
  'category' => 'Ácido-Base',
  'description' => 'pH = -log[H+].',
  'theory' => '**pH:** $$\\text{pH}=-\\log_{10}[H^+]$$',
  'input_type' => 'chemistry',
  'params' => 
  array (
    0 => 
    array (
      'name' => 'conc',
      'label' => '[H+] (M)',
      'type' => 'slider',
      'min' => 1.0E-7,
      'max' => 0.1,
      'value' => 0.001,
      'step' => 0.0001,
    ),
  ),
  'calculate' => '-Math.log10(conc)',
  'formula_latex' => '\\text{pH}=-\\log_{10}({conc})',
  'answer' => 3,
),
    'qui-dilution' => array (
  'materia' => 'Química I',
  'title' => 'Dilución',
  'difficulty' => 'Medio',
  'type' => 'calculator',
  'points' => 16,
  'category' => 'Soluciones',
  'description' => 'C1V1 = C2V2.',
  'theory' => '**Dilución:** $$C_1V_1=C_2V_2$$',
  'input_type' => 'chemistry',
  'params' => 
  array (
    0 => 
    array (
      'name' => 'C1',
      'label' => 'C₁ (M)',
      'type' => 'slider',
      'min' => 1,
      'max' => 12,
      'value' => 6,
      'step' => 0.5,
    ),
    1 => 
    array (
      'name' => 'V1',
      'label' => 'V₁ (mL)',
      'type' => 'slider',
      'min' => 10,
      'max' => 200,
      'value' => 50,
      'step' => 5,
    ),
    2 => 
    array (
      'name' => 'V2',
      'label' => 'V₂ (mL)',
      'type' => 'slider',
      'min' => 50,
      'max' => 500,
      'value' => 200,
      'step' => 10,
    ),
  ),
  'calculate' => 'C1*V1/V2',
  'formula_latex' => 'C_2=C_1V_1/V_2',
  'answer' => 1.5,
),
    'qui-percent-mass' => array (
  'materia' => 'Química I',
  'title' => 'Composición porcentual',
  'difficulty' => 'Medio',
  'type' => 'calculator',
  'points' => 14,
  'category' => 'Estequiometría',
  'description' => '% masa de elemento en compuesto.',
  'theory' => '**% Composición:** $$\\%=\\frac{m_{elem}}{m_{total}}\\times100$$',
  'input_type' => 'chemistry',
  'params' => 
  array (
    0 => 
    array (
      'name' => 'masa_elem',
      'label' => 'Masa elemento (g)',
      'type' => 'slider',
      'min' => 1,
      'max' => 100,
      'value' => 32,
      'step' => 1,
    ),
    1 => 
    array (
      'name' => 'masa_total',
      'label' => 'Masa total (g)',
      'type' => 'slider',
      'min' => 10,
      'max' => 200,
      'value' => 80,
      'step' => 1,
    ),
  ),
  'calculate' => 'masa_elem/masa_total*100',
  'formula_latex' => '\\%=m_elem/m_total*100',
  'answer' => 40,
),
    'qui-calorimetry' => array (
  'materia' => 'Química I',
  'title' => 'Calorimetría',
  'difficulty' => 'Difícil',
  'type' => 'calculator',
  'points' => 20,
  'category' => 'Termoquímica',
  'description' => 'Q = m c deltaT.',
  'theory' => '**Calorimetría:** $$Q=mc\\Delta T$$',
  'input_type' => 'chemistry',
  'params' => 
  array (
    0 => 
    array (
      'name' => 'masa',
      'label' => 'Masa (g)',
      'type' => 'slider',
      'min' => 10,
      'max' => 500,
      'value' => 100,
      'step' => 10,
    ),
    1 => 
    array (
      'name' => 'calor_esp',
      'label' => 'c (J/g°C)',
      'type' => 'slider',
      'min' => 0.1,
      'max' => 5,
      'value' => 4.184,
      'step' => 0.1,
    ),
    2 => 
    array (
      'name' => 'deltaT',
      'label' => 'ΔT (°C)',
      'type' => 'slider',
      'min' => 1,
      'max' => 100,
      'value' => 25,
      'step' => 1,
    ),
  ),
  'calculate' => 'masa*calor_esp*deltaT',
  'formula_latex' => 'Q=mc\\Delta T',
  'answer' => 10460,
),
    'bio-diversity' => array (
  'materia' => 'Ecosistemas',
  'title' => 'Índice de biodiversidad',
  'difficulty' => 'Medio',
  'type' => 'calculator',
  'points' => 18,
  'category' => 'Ecología',
  'description' => 'Índice de Shannon-Wiener.',
  'theory' => '**Shannon:** $$H=-\\sum p_i\\ln(p_i)$$',
  'input_type' => 'biology',
  'params' => 
  array (
    0 => 
    array (
      'name' => 's1',
      'label' => 'Especie A',
      'type' => 'slider',
      'min' => 1,
      'max' => 50,
      'value' => 20,
      'step' => 1,
    ),
    1 => 
    array (
      'name' => 's2',
      'label' => 'Especie B',
      'type' => 'slider',
      'min' => 1,
      'max' => 50,
      'value' => 15,
      'step' => 1,
    ),
    2 => 
    array (
      'name' => 's3',
      'label' => 'Especie C',
      'type' => 'slider',
      'min' => 1,
      'max' => 50,
      'value' => 10,
      'step' => 1,
    ),
    3 => 
    array (
      'name' => 's4',
      'label' => 'Especie D',
      'type' => 'slider',
      'min' => 1,
      'max' => 50,
      'value' => 5,
      'step' => 1,
    ),
  ),
  'calculate' => '(s1+s2+s3+s4)',
  'formula_latex' => 'H=-\\sum p_i\\ln(p_i)',
  'visualize' => true,
),
    'bio-water-footprint' => array (
  'materia' => 'Ecosistemas',
  'title' => 'Huella hídrica',
  'difficulty' => 'Fácil',
  'type' => 'calculator',
  'points' => 10,
  'category' => 'Sostenibilidad',
  'description' => 'Consumo total de agua en L/día.',
  'theory' => 'Suma de duchas, alimentación y energía.',
  'input_type' => 'biology',
  'params' => 
  array (
    0 => 
    array (
      'name' => 'ducha',
      'label' => 'Ducha (L/día)',
      'type' => 'slider',
      'min' => 10,
      'max' => 100,
      'value' => 50,
      'step' => 5,
    ),
    1 => 
    array (
      'name' => 'comida',
      'label' => 'Alimentación (L/día)',
      'type' => 'slider',
      'min' => 500,
      'max' => 5000,
      'value' => 2000,
      'step' => 100,
    ),
    2 => 
    array (
      'name' => 'energia',
      'label' => 'Energía (L/día)',
      'type' => 'slider',
      'min' => 100,
      'max' => 2000,
      'value' => 500,
      'step' => 50,
    ),
  ),
  'calculate' => 'ducha+comida+energia',
  'formula_latex' => 'H2O = ducha + comida + energia',
),
    'bio-carbon' => array (
  'materia' => 'Ecosistemas',
  'title' => 'Huella de carbono',
  'difficulty' => 'Medio',
  'type' => 'calculator',
  'points' => 18,
  'category' => 'Sostenibilidad',
  'description' => 'Estima emisiones de CO2 kg/año.',
  'theory' => 'Multiplica actividad por factor de emisión.',
  'input_type' => 'biology',
  'params' => 
  array (
    0 => 
    array (
      'name' => 'electricidad',
      'label' => 'Electricidad (kWh/año)',
      'type' => 'slider',
      'min' => 500,
      'max' => 10000,
      'value' => 3000,
      'step' => 100,
    ),
    1 => 
    array (
      'name' => 'gasolina',
      'label' => 'Gasolina (L/año)',
      'type' => 'slider',
      'min' => 100,
      'max' => 3000,
      'value' => 1000,
      'step' => 50,
    ),
    2 => 
    array (
      'name' => 'gas',
      'label' => 'Gas natural (m³/año)',
      'type' => 'slider',
      'min' => 100,
      'max' => 3000,
      'value' => 500,
      'step' => 50,
    ),
  ),
  'calculate' => 'electricidad*0.5+gasolina*2.3+gas*2.0',
  'formula_latex' => 'CO2 = electricidad*0.5 + gasolina*2.3 + gas*2.0',
),
    'bio-predator-prey' => array (
  'materia' => 'Ecosistemas',
  'title' => 'Modelo depredador-presa',
  'difficulty' => 'Difícil',
  'type' => 'calculator',
  'points' => 25,
  'category' => 'Ecología',
  'description' => 'Simula Lotka-Volterra.',
  'theory' => '**Lotka-Volterra:** $$\\frac{dN}{dt}=rN-aNP,\\frac{dP}{dt}=baNP-mP$$',
  'input_type' => 'biology',
  'params' => 
  array (
    0 => 
    array (
      'name' => 'presas',
      'label' => 'Presas iniciales',
      'type' => 'slider',
      'min' => 50,
      'max' => 200,
      'value' => 100,
      'step' => 10,
    ),
    1 => 
    array (
      'name' => 'preds',
      'label' => 'Depredadores iniciales',
      'type' => 'slider',
      'min' => 5,
      'max' => 50,
      'value' => 20,
      'step' => 5,
    ),
    2 => 
    array (
      'name' => 'tiempo',
      'label' => 'Tiempo (días)',
      'type' => 'slider',
      'min' => 10,
      'max' => 100,
      'value' => 50,
      'step' => 5,
    ),
  ),
  'calculate' => 'presas+preds',
  'formula_latex' => 'dN/dt=rN-aNP dP/dt=baNP-mP',
  'visualize' => true,
),
];
