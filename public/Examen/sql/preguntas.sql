-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-11-2025 a las 22:31:03
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dialogos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas`
--

CREATE TABLE `preguntas` (
  `IDPregunta` int(11) NOT NULL,
  `IDPersonajeC` varchar(10) DEFAULT NULL,
  `Pregunta` text NOT NULL,
  `TipoPreguntaC` varchar(100) NOT NULL,
  `Opcion1` varchar(255) NOT NULL,
  `Opcion2` varchar(255) NOT NULL,
  `Opcion3` varchar(255) NOT NULL,
  `RespuestaCorrecta` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `preguntas`
--

INSERT INTO `preguntas` (`IDPregunta`, `IDPersonajeC`, `Pregunta`, `TipoPreguntaC`, `Opcion1`, `Opcion2`, `Opcion3`, `RespuestaCorrecta`) VALUES
(1, '1Cu', '1. El bienestar social busca principalmente:', 'Continua', 'A) Que cada individuo compita por sus propios intereses', 'B) La satisfacción equilibrada de las necesidades colectivas e individuales', 'C) La acumulación de bienes materiales', 2),
(2, '1Cu', '2. Una norma jurídica se diferencia de una norma social porque:', 'Continua', 'A) No requiere sanción alguna', 'B) Se cumple solo si la persona quiere', 'C) Es obligatoria y respaldada por el poder del Estado', 3),
(3, '1Cu', '3. ¿Cuál de los siguientes elementos caracteriza al Estado moderno?', 'Continua', 'A) Población, territorio y soberanía', 'B) Multiplicidad de gobiernos', 'C) Falta de territorio definido', 1),
(4, '1Cu', '4. Cuando un grupo social ejerce influencia sobre las decisiones públicas mediante el voto o la opinión, está participando en:', 'Continua', 'A) La organización productiva', 'B) Las relaciones de poder político', 'C) El sistema educativo', 2),
(5, '1Cu', '5. Las normas sociales tienen como finalidad principal:5. Las normas sociales tienen como finalidad principal:', 'Dialogo', 'A) Proteger el patrimonio nacional', 'B) Regular la convivencia entre los miembros de una comunidad', 'C) Imponer sanciones económicas', 2),
(6, '1Cu', '6. Según Henry Fayol, las etapas del proceso administrativo son:', 'Continua', 'A) Planeación, control, evaluación y sanción', 'B) Planeación, organización, dirección y control', 'C) Diagnóstico, planeación, operación y medición', 2),
(7, '1Cu', '7. La eficiencia en la administración se refiere a:', 'Continua', 'A) Lograr las metas con el menor uso posible de recursos', 'B) Alcanzar los objetivos planeados sin importar los recursos usados', 'C) Cumplir con las normas jurídicas', 1),
(8, '1Cu', '8. ¿Cuál es el principal aporte de Frederick W. Taylor a la administración?', 'Continua', 'A) El concepto de motivación laboral', 'B) La teoría de sistemas', 'C) La administración científica basada en el estudio del trabajo', 3),
(9, '1Cu', '9. El valor instrumental de la administración significa que:', 'Continua', 'A) Es un medio para alcanzar los objetivos de una organización', 'B) Depende exclusivamente del capital financiero', 'C) Sirve solo en instituciones privadas', 1),
(10, '1Cu', '10. En el análisis transaccional, los estados del yo se dividen en:', 'Dialogo', 'A) Emocional, racional y espiritual', 'B) Padre, Adulto y Niño', 'C) Moral, lógico y empático', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  ADD PRIMARY KEY (`IDPregunta`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  MODIFY `IDPregunta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
