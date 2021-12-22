-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3360
-- Tiempo de generación: 22-12-2021 a las 04:45:29
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyecto`
--
create database proyecto;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivados`
--

CREATE TABLE `archivados` (
  `usuarios_id` int(11) NOT NULL,
  `Titulo1` varchar(35) NOT NULL,
  `Contenido1` varchar(200) NOT NULL,
  `Fecha_Registro1` datetime NOT NULL,
  `Fecha_Vencimiento1` datetime NOT NULL,
  `Prioridad1` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tareas`
--

CREATE TABLE `tareas` (
  `usuarios_idusuario` int(15) NOT NULL,
  `Titulo` varchar(35) NOT NULL,
  `Contenido` varchar(200) NOT NULL,
  `Fecha_Registro` date NOT NULL,
  `Fecha_Vencimiento` date NOT NULL,
  `Prioridad` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tareas`
--

INSERT INTO `tareas` (`usuarios_idusuario`, `Titulo`, `Contenido`, `Fecha_Registro`, `Fecha_Vencimiento`, `Prioridad`) VALUES
(6, 'trabajo', 'procidimental', '2021-12-21', '2021-12-22', 'alta'),
(7, 'seguridad', ' datos', '2021-12-21', '2021-12-22', 'Baja'),
(7, 'trabajo', 'procidimental', '2021-12-21', '2021-12-22', 'alta'),
(7, 'trabajo', 'procidimental', '2021-12-21', '2021-12-22', 'alta');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(32) NOT NULL,
  `apellido` varchar(32) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `apellido`, `username`, `password`) VALUES
(6, 'yaser', 'mezares', 'yaser', '$2y$10$DCOhkjhwjegdqpY03tqRlOSpP4eIVBY1LfIKtDgAm/dxtP3CnyO2K'),
(7, 'armando', 'mezares', 'arma', '$2y$10$1/XlV15tKRhIKNtfgIbszO2WkIlZltSz3ZH4ujnFQahaHBlq58CPW'),
(9, 'daniel', 'mezares', 'daniel', '$2y$10$SdehQqrB2PTpILZPIahwFu2pRY7b.aEH8lOKazdbOheOlJ68LaP.i');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tareas`
--
ALTER TABLE `tareas`
  ADD KEY `fk_usuarios_id_usuario` (`usuarios_idusuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tareas`
--
ALTER TABLE `tareas`
  ADD CONSTRAINT `fk_usuarios_id_usuario` FOREIGN KEY (`usuarios_idusuario`) REFERENCES `usuarios` (`id_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

