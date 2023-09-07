-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-09-2023 a las 20:18:02
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
-- Estructura de tabla para la tabla `Usuarios`
--

CREATE TABLE `usuarios` (
  `Id` char(36) NOT NULL,
  `Usuario` varchar(20) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Clave` varchar(80) NOT NULL,
  `User_Img` varchar(150) NOT NULL,
  `Fecha` date NOT NULL DEFAULT current_timestamp(),
  `Estado` varchar(20) NOT NULL DEFAULT 'DESBLOQUEADO'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `Usuarios`
--

INSERT INTO `Usuarios` (`Id`, `Usuario`, `Email`, `Clave`, `User_Img`, `Fecha`, `Estado`) VALUES
('421b4bd3-dc12-41f2-aea3-48497e2e0026', 'test148', 'prueba@gmail.com', '$2y$10$AJtH9HQOIZ5JKywqE8Q6Ben6uPPWW2FSQB74FKYU6XGiY12PXNm1e', '1692040714_421b4bd3-dc12-41f2-aea3-48497e2e0026_test.jpg', '2023-08-14', 'DESBLOQUEADO'),
('d5d2306e-19fd-4bf5-8fc1-343f106df681', 'test24', 'matias@gmail.com', '$2y$10$VBmWnYm.RnmS3UGif6gNoutTpw761C8I6EfLnWuJoLn5XqqNaSHVe', 'test.jpg', '2023-07-24', 'DESBLOQUEADO'),
('fa53ae3f-2d7a-4a56-99ed-0c063db0400f', 'admin', 'admin@gmail.com', '$2y$10$PjaNFkL1TGPxkAbzw.3GKO5w2ICQnvchUCx9zCM266P5HyhiZ12vS', 'Logo_sesion.png', '2023-08-17', 'DESBLOQUEADO');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `Usuarios`
--
ALTER TABLE `Usuarios`
  ADD PRIMARY KEY (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
