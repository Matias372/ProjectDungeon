-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-07-2023 a las 21:58:41
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `project_dungeon`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partidas`
--

CREATE TABLE `partidas` (
  `Id` int(11) NOT NULL,
  `Cod_User` char(36) NOT NULL,
  `Nombre` varchar(20) NOT NULL,
  `Nivel` int(4) NOT NULL,
  `Fecha` date NOT NULL DEFAULT current_timestamp(),
  `Ubicacion` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `partidas`
--

INSERT INTO `partidas` (`Id`, `Cod_User`, `Nombre`, `Nivel`, `Fecha`, `Ubicacion`) VALUES
(1, 'd5d2306e-19fd-4bf5-8fc1-343f106df681', 'test', 4, '2023-07-24', 'prueba.ht');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personaje`
--

CREATE TABLE `personaje` (
  `Id` int(11) NOT NULL,
  `Cod_User` char(36) NOT NULL,
  `Nombre` varchar(20) NOT NULL,
  `Clase` varchar(12) NOT NULL,
  `Nivel` int(3) NOT NULL,
  `Fuerza_basic` int(4) NOT NULL,
  `Resistencia_basic` int(4) NOT NULL,
  `Destreza_basic` int(4) NOT NULL,
  `Magia_basic` int(4) NOT NULL,
  `Fuerza_bonif` int(4) NOT NULL,
  `Resistencia_bonif` int(4) NOT NULL,
  `Destreza_bonif` int(4) NOT NULL,
  `Magia_bonif` int(4) NOT NULL,
  `Stat_Point` int(4) NOT NULL,
  `HP_actual` int(10) NOT NULL,
  `MP_actual` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `personaje`
--

INSERT INTO `personaje` (`Id`, `Cod_User`, `Nombre`, `Clase`, `Nivel`, `Fuerza_basic`, `Resistencia_basic`, `Destreza_basic`, `Magia_basic`, `Fuerza_bonif`, `Resistencia_bonif`, `Destreza_bonif`, `Magia_bonif`, `Stat_Point`, `HP_actual`, `MP_actual`) VALUES
(1, 'd5d2306e-19fd-4bf5-8fc1-343f106df681', 'test', 'Ranger', 4, 5, 5, 5, 5, 0, 0, 0, 0, 0, 5, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `Id` char(36) NOT NULL,
  `Usuario` varchar(20) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Clave` varchar(80) NOT NULL,
  `User_Img` varchar(80) NOT NULL,
  `Fecha` date NOT NULL DEFAULT current_timestamp(),
  `Estado` varchar(20) NOT NULL DEFAULT 'DESBLOQUEADO'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`Id`, `Usuario`, `Email`, `Clave`, `User_Img`, `Fecha`, `Estado`) VALUES
('86257e0d-9169-46e7-916f-a6824be89ba2', 'T2D20M7', 'prueba@gmail.com', '$2y$10$n/Al4D0uX1i5si57P/cyweoxN2lt2aq9qDsAiQqceAqKasFLrJOeC', 'Logo_sesion.png', '2023-07-20', 'DESBLOQUEADO'),
('d5d2306e-19fd-4bf5-8fc1-343f106df681', 'test24', 'matias@gmail.com', '$2y$10$VBmWnYm.RnmS3UGif6gNoutTpw761C8I6EfLnWuJoLn5XqqNaSHVe', 'Logo_sesion.png', '2023-07-24', 'DESBLOQUEADO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_logros`
--

CREATE TABLE `usuarios_logros` (
  `Id` int(11) NOT NULL,
  `Id_Usuario` char(36) NOT NULL,
  `Logro_Id` varchar(10) NOT NULL,
  `Fecha` int(11) NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `usuarios_logros`
--

INSERT INTO `usuarios_logros` (`Id`, `Id_Usuario`, `Logro_Id`, `Fecha`) VALUES
(5, '86257e0d-9169-46e7-916f-a6824be89ba2', '1', 2147483647),
(6, 'd5d2306e-19fd-4bf5-8fc1-343f106df681', '1', 2147483647);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `partidas`
--
ALTER TABLE `partidas`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `personaje`
--
ALTER TABLE `personaje`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `usuarios_logros`
--
ALTER TABLE `usuarios_logros`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Relacion_user_logro` (`Id_Usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `partidas`
--
ALTER TABLE `partidas`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `personaje`
--
ALTER TABLE `personaje`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios_logros`
--
ALTER TABLE `usuarios_logros`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `usuarios_logros`
--
ALTER TABLE `usuarios_logros`
  ADD CONSTRAINT `Relacion_user_logro` FOREIGN KEY (`Id_Usuario`) REFERENCES `usuarios` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
