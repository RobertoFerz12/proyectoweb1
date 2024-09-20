-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-09-2024 a las 01:35:41
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
-- Base de datos: `bd`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cotizaciones`
--

CREATE TABLE `cotizaciones` (
  `id` int(11) NOT NULL,
  `precio_total` decimal(10,2) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `articulo` varchar(50) DEFAULT NULL,
  `tela` varchar(50) DEFAULT NULL,
  `tiempo` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cotizaciones`
--

INSERT INTO `cotizaciones` (`id`, `precio_total`, `fecha`, `articulo`, `tela`, `tiempo`) VALUES
(1, 2500.00, '2024-09-20 09:57:56', NULL, NULL, NULL),
(2, 1500.00, '2024-09-20 10:23:01', 'sofa', 'cuero', '1_semana'),
(3, 1500.00, '2024-09-20 10:24:43', 'sofa', 'cuero', '1_semana'),
(4, 950.00, '2024-09-20 10:25:01', 'interior_auto', 'terciopelo', '2_dias'),
(5, 950.00, '2024-09-20 10:28:48', 'interior_auto', 'terciopelo', '2_dias'),
(6, 950.00, '2024-09-20 10:30:39', 'interior_auto', 'terciopelo', '2_dias'),
(7, 2150.00, '2024-09-20 10:31:10', 'sillon', 'terciopelo', '2_dias'),
(8, 1050.00, '2024-09-20 10:32:17', 'interior_auto', 'terciopelo', '1_semana'),
(9, 1800.00, '2024-09-20 10:34:01', 'sillon', 'algodon', '15_dias'),
(10, 1250.00, '2024-09-20 10:35:44', 'silla', 'terciopelo', '1_semana'),
(11, 0.00, '2024-09-20 12:12:58', 'Interior_de_auto', 'Cuero', 'Un_par_de_dias'),
(12, 0.00, '2024-09-20 12:23:44', '', '', ''),
(13, 0.00, '2024-09-20 12:28:35', '', '', ''),
(14, 0.00, '2024-09-20 12:32:16', 'Silla', 'Sintetico', 'Una_semana'),
(15, 0.00, '2024-09-20 12:38:47', '', '', ''),
(16, 0.00, '2024-09-20 12:43:05', '', '', ''),
(17, 0.00, '2024-09-20 12:44:29', '', '', ''),
(18, 0.00, '2024-09-20 12:46:05', '', '', ''),
(19, 0.00, '2024-09-20 12:54:15', 'Interior_de_auto', 'Terciopelo', '15_dias'),
(20, 1050.00, '2024-09-20 12:56:24', 'Interior_de_auto', 'Terciopelo', '15_dias'),
(21, 1500.00, '2024-09-20 12:57:11', 'Sofa', 'Algodon', 'Un_par_de_dias'),
(22, 1100.00, '2024-09-20 12:59:41', 'Silla', 'Sintetico', '15_dias'),
(23, 2000.00, '2024-09-20 20:30:32', 'Sillon', 'Cuero', '15_dias'),
(24, 3550.00, '2024-09-20 23:32:32', 'Sofa', 'Cuero', '10_dias');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `precios_servicios`
--

CREATE TABLE `precios_servicios` (
  `id` int(11) NOT NULL,
  `servicio` varchar(255) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `categoria` enum('articulo','tela','tiempo') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `precios_servicios`
--

INSERT INTO `precios_servicios` (`id`, `servicio`, `precio`, `categoria`) VALUES
(6, 'Sofa', 3000.00, 'articulo'),
(7, 'Silla', 700.00, 'articulo'),
(8, 'Sillon', 1500.00, 'articulo'),
(9, 'Interior_de_auto', 600.00, 'articulo'),
(10, 'Algodon', 300.00, 'tela'),
(11, 'Sintetico', 400.00, 'tela'),
(12, 'Cuero', 500.00, 'tela'),
(13, 'Terciopelo', 450.00, 'tela'),
(14, 'Un_par_de_dias', 200.00, 'tiempo'),
(15, 'Una_semana', 100.00, 'tiempo'),
(16, '10_dias', 50.00, 'tiempo'),
(17, '15_dias', 0.00, 'tiempo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `email`, `password`) VALUES
(1, 'admin@ejemplo.com', '1234');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cotizaciones`
--
ALTER TABLE `cotizaciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `precios_servicios`
--
ALTER TABLE `precios_servicios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cotizaciones`
--
ALTER TABLE `cotizaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `precios_servicios`
--
ALTER TABLE `precios_servicios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
