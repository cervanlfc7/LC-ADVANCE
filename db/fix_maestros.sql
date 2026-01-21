-- LC-ADVANCE unified dump - FIXED VERSION
-- Agregados todos los maestros faltantes

-- ===== LIMPIAR E INSERTAR MAESTROS COMPLETOS =====
DELETE FROM idsmaestros;
INSERT INTO `idsmaestros` (`PersonajeC`, `IDPersonajeC`) VALUES
('Cuco', '1Cu'),
('Espindola', '1Es'),
('Miguel Márquez', '1Le'),
('Herson', '1He'),
('Carolina', '1Ca'),
('Enrique', '1Go'),
('Manuel', '1Ma'),
('M. Meza', '1Me'),
('R. Padilla', '1Pa'),
('Armando', '1Ar');

-- ===== LIMPIAR E INSERTAR DIÁLOGOS COMPLETOS =====
DELETE FROM dilogoscombate;

-- CUCO (1Cu) - Ciencias Sociales
INSERT INTO `dilogoscombate` (`IDPersonajeC`, `IDDialogoC`, `TipodialogoC`, `DialogoC`) VALUES
('1Cu', '1', 'Continuo', '¡Quiubo, compadre! ¿Cómo anda? Lo veo con los mjmmm en el piso, ¿qué trae?'),
('1Cu', '2', 'Continuo', '¿El marranito que traían? ¡Jajajaja! No, compadre, no me digas que se peló…'),
('1Cu', '3', 'Pregunta', 'Híjole, compadre… pues ojalá lo encuentres, porque esos animalitos luego son más listos que los alumnos, ¡ja! Pero bueno, ni modo, la vida sigue. Y hablando de cosas importantes… ¿ya te chutaste el examen que te dejé? Porque ese sí no se va a escapar como el cochino, ¿eh?'),
('1Cu', '4', 'Pregunta', 'Falta poco compadre'),
('1Cu', '5', 'Final', 'Ya acabaste? eso es todo compadre');

-- ESPINDOLA (1Es) - Cálculo/Derivadas
INSERT INTO `dilogoscombate` (`IDPersonajeC`, `IDDialogoC`, `TipodialogoC`, `DialogoC`) VALUES
('1Es', '1', 'Continuo', 'Bienvenido estudiante, hoy practicaremos cálculo diferencial'),
('1Es', '2', 'Continuo', 'Las derivadas son fundamentales en matemáticas avanzadas'),
('1Es', '3', 'Pregunta', 'Ahora resolvamos unos problemas de derivadas'),
('1Es', '4', 'Pregunta', 'Vas bien, continúa'),
('1Es', '5', 'Final', 'Excelente trabajo, has dominado las derivadas correctamente');

-- MIGUEL MÁRQUEZ (1Le) - Teoría de Números
INSERT INTO `dilogoscombate` (`IDPersonajeC`, `IDDialogoC`, `TipodialogoC`, `DialogoC`) VALUES
('1Le', '1', 'Continuo', 'Hola compadre, hoy exploraremos los números primos'),
('1Le', '2', 'Continuo', 'La teoría de números es fascinante y desafiante'),
('1Le', '3', 'Pregunta', '¿Estás listo para resolver estos problemas?'),
('1Le', '4', 'Pregunta', 'Muy bien, casi terminas'),
('1Le', '5', 'Final', 'Bravo, demostraste entender bien la teoría de números');

-- HERSON (1He) - Física/Química
INSERT INTO `dilogoscombate` (`IDPersonajeC`, `IDDialogoC`, `TipodialogoC`, `DialogoC`) VALUES
('1He', '1', 'Continuo', 'Hola estudiante, ¿listos para física y química?'),
('1He', '2', 'Pregunta', 'Recuerden que deben dominar estos conceptos fundamentales'),
('1He', '3', 'Pregunta', 'Ya casi terminas, vamos bien'),
('1He', '4', 'Final', 'Excelente desempeño en ciencias exactas');

-- CAROLINA (1Ca) - Biología/Ecología
INSERT INTO `dilogoscombate` (`IDPersonajeC`, `IDDialogoC`, `TipodialogoC`, `DialogoC`) VALUES
('1Ca', '1', 'Continuo', 'Bienvenido a la clase de biología'),
('1Ca', '2', 'Pregunta', 'La ecología es vital para entender nuestro planeta'),
('1Ca', '3', 'Pregunta', 'Sigue adelante, te va muy bien'),
('1Ca', '4', 'Final', 'Perfecto, comprendes bien los conceptos biológicos');

-- ENRIQUE/GO (1Go) - English/Inglés
INSERT INTO `dilogoscombate` (`IDPersonajeC`, `IDDialogoC`, `TipodialogoC`, `DialogoC`) VALUES
('1Go', '1', 'Continuo', '¡How are you today?'),
('1Go', '2', 'Pregunta', 'Ready for English practice?'),
('1Go', '3', 'Pregunta', 'Keep going, you are doing great'),
('1Go', '4', 'Final', 'Congratulations, excellent English level');

-- MANUEL (1Ma) - Programación/Algoritmos
INSERT INTO `dilogoscombate` (`IDPersonajeC`, `IDDialogoC`, `TipodialogoC`, `DialogoC`) VALUES
('1Ma', '1', 'Continuo', 'Hola, bienvenido a programación'),
('1Ma', '2', 'Pregunta', 'Aprenderemos algoritmos y estructuras de datos'),
('1Ma', '3', 'Pregunta', 'Excelente, sigue así'),
('1Ma', '4', 'Final', 'Perfecto, dominas la programación');

-- M. MEZA (1Me) - Base de Datos/SQL
INSERT INTO `dilogoscombate` (`IDPersonajeC`, `IDDialogoC`, `TipodialogoC`, `DialogoC`) VALUES
('1Me', '1', 'Continuo', 'Hola estudiante, hoy practicaremos SQL'),
('1Me', '2', 'Pregunta', 'Las bases de datos son esenciales en informática'),
('1Me', '3', 'Pregunta', 'Casi terminas, vamos bien'),
('1Me', '4', 'Final', 'Excelente, dominas SQL correctamente');

-- R. PADILLA (1Pa) - Derecho/Constitucional
INSERT INTO `dilogoscombate` (`IDPersonajeC`, `IDDialogoC`, `TipodialogoC`, `DialogoC`) VALUES
('1Pa', '1', 'Continuo', '¡Qué onda joven como esta!'),
('1Pa', '2', 'Pregunta', 'Vamos al salón que les toca examen'),
('1Pa', '3', 'Pregunta', 'Ándele ya casi acaba'),
('1Pa', '4', 'Final', '¡Hasta luego joven!');

-- ARMANDO (1Ar) - Historia de México
INSERT INTO `dilogoscombate` (`IDPersonajeC`, `IDDialogoC`, `TipodialogoC`, `DialogoC`) VALUES
('1Ar', '1', 'Continuo', 'Hola estudiante, hoy hablaremos de la historia de México'),
('1Ar', '2', 'Pregunta', 'Estamos en un momento crucial de nuestro pasado'),
('1Ar', '3', 'Pregunta', 'Vas muy bien, continuemos'),
('1Ar', '4', 'Final', 'Excelente, has demostrado conocer nuestra historia');

-- ===== CORRECCIONES EN TABLA PREGUNTAS =====
UPDATE `preguntas` SET `TipoPreguntaC` = 'Continua' WHERE `TipoPreguntaC` = 'Dialogo';
