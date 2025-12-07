-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-11-2025 a las 22:31:12
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
-- Estructura de tabla para la tabla `idsmaestros`
--

CREATE TABLE `idsmaestros` (
  `PersonajeC` varchar(100) NOT NULL,
  `IDPersonajeC` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `idsmaestros`
--

INSERT INTO `idsmaestros` (`PersonajeC`, `IDPersonajeC`) VALUES
('Espindola', '1Es'),
('Miguel Márquez', '1Le'),
('Herson', '1He'),
('Carolina', '1Ca'),
('Enrique', '1Go'),
('Manuel', '1Ma'),
('M. Meza', '1Me'),
('Cuco', '1Cu'),
('R. Padilla', '1Pa');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
