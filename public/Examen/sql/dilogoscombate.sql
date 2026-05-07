-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-11-2025 a las 22:31:22
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
-- Estructura de tabla para la tabla `dilogoscombate`
--

CREATE TABLE `dilogoscombate` (
  `IDPersonajeC` varchar(100) NOT NULL,
  `IDDialogoC` varchar(100) NOT NULL,
  `TipodialogoC` varchar(100) NOT NULL,
  `DialogoC` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `dilogoscombate`
--

INSERT INTO `dilogoscombate` (`IDPersonajeC`, `IDDialogoC`, `TipodialogoC`, `DialogoC`) VALUES
('1Cu', '1', 'Continuo', '¡Quiubo, compadre! ¿Cómo anda? Lo veo con los mjmmm en el piso, ¿qué trae?'),
('1Cu', '2', 'Continuo', '¿El marranito que traían? ¡Jajajaja! No, compadre, no me digas que se peló…'),
('1Cu', '3', 'Pregunta', 'Híjole, compadre… pues ojalá lo encuentres, porque esos animalitos luego son más listos que los alumnos, ¡ja! Pero bueno, ni modo, la vida sigue. Y hablando de cosas importantes… ¿ya te chutaste el examen que te dejé? Porque ese sí no se va a escapar como el cochino, ¿eh?'),
('1Cu', '4', 'Pregunta', 'Falta poco compadre'),
('1Cu', '5', 'Final', 'Ya acabaste? eso es todo compadre');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
