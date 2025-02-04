-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-01-2025 a las 19:38:57
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
-- Base de datos: `encuesta`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuestas`
--

CREATE TABLE `respuestas` (
  `id` int(11) NOT NULL,
  `sexo` varchar(50) NOT NULL,
  `edad` varchar(50) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `campo1` varchar(10) NOT NULL,
  `campo2` varchar(10) NOT NULL,
  `campo3` varchar(50) NOT NULL,
  `campo4` varchar(10) NOT NULL,
  `campo5` varchar(10) NOT NULL,
  `campo6` varchar(10) NOT NULL,
  `campo7` varchar(10) NOT NULL,
  `campo8` varchar(10) NOT NULL,
  `campo9` varchar(10) NOT NULL,
  `campo10` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `respuestas`
--

INSERT INTO `respuestas` (`id`, `sexo`, `edad`, `direccion`, `campo1`, `campo2`, `campo3`, `campo4`, `campo5`, `campo6`, `campo7`, `campo8`, `campo9`, `campo10`) VALUES
(1, 'Masculino', '20', 'Yaritagua', 'No', 'No', 'Centro de salud', 'No', 'No', 'Sí', 'No', 'Sí', 'Sí', 'Sí'),
(2, 'Masculino', '20', 'el ', 'Sí', 'Sí', 'Amigos', 'Sí', 'No', 'No', 'Sí', 'Sí', 'No', 'Sí'),
(3, 'Masculino', '20', 'Yaritagua', 'No', 'No', 'Por su cuenta', 'No', 'Sí', 'No', 'Sí', 'No', 'Sí', 'No'),
(4, 'Masculino', '16', 'Barquisimeto', 'Sí', 'No', 'Amigos', 'No', 'Sí', 'No', 'Sí', 'No', 'Sí', 'No');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `respuestas`
--
ALTER TABLE `respuestas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `respuestas`
--
ALTER TABLE `respuestas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
