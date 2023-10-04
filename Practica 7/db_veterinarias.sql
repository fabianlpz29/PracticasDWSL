-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-10-2023 a las 04:43:09
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_veterinarias`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_especies`
--

CREATE TABLE `tbl_especies` (
  `id_especie` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `estado` tinyint(4) NOT NULL,
  `creado_por` int(11) NOT NULL,
  `actualizado_por` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `fecha_actualizacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_especies`
--

INSERT INTO `tbl_especies` (`id_especie`, `nombre`, `estado`, `creado_por`, `actualizado_por`, `fecha`, `fecha_creacion`, `fecha_actualizacion`) VALUES
(1, 'Perro', 1, 1, 1, '2023-09-21', '2023-09-21 22:04:01', '2023-09-21 22:04:01'),
(2, 'Delfin', 1, 1, 1, '2023-10-03', '2023-10-04 04:35:15', '2023-10-04 04:35:15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_razas`
--

CREATE TABLE `tbl_razas` (
  `id_raza` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `estado` tinyint(4) NOT NULL,
  `creado_por` int(11) NOT NULL,
  `actualizado_por` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `fecha_actualizacion` datetime NOT NULL,
  `id_especie` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_razas`
--

INSERT INTO `tbl_razas` (`id_raza`, `nombre`, `estado`, `creado_por`, `actualizado_por`, `fecha`, `fecha_creacion`, `fecha_actualizacion`, `id_especie`) VALUES
(1, 'Bulldog', 1, 1, 1, '2023-09-21', '2023-09-21 22:05:31', '2023-09-21 22:05:31', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_pacientes`
--

CREATE TABLE `tb_pacientes` (
  `id_paciente` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `enfermedades` text NOT NULL,
  `vacunas` text NOT NULL,
  `id_raza` int(11) NOT NULL,
  `imagen` text NOT NULL,
  `creado_en` datetime NOT NULL,
  `actualizado_en` datetime NOT NULL,
  `creado_por` int(11) NOT NULL,
  `actualizado_por` int(11) NOT NULL,
  `fecha_creacion` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_especies`
--
ALTER TABLE `tbl_especies`
  ADD PRIMARY KEY (`id_especie`);

--
-- Indices de la tabla `tbl_razas`
--
ALTER TABLE `tbl_razas`
  ADD PRIMARY KEY (`id_raza`),
  ADD KEY `id_especie` (`id_especie`);

--
-- Indices de la tabla `tb_pacientes`
--
ALTER TABLE `tb_pacientes`
  ADD PRIMARY KEY (`id_paciente`),
  ADD KEY `id_raza` (`id_raza`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_especies`
--
ALTER TABLE `tbl_especies`
  MODIFY `id_especie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tbl_razas`
--
ALTER TABLE `tbl_razas`
  MODIFY `id_raza` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tb_pacientes`
--
ALTER TABLE `tb_pacientes`
  MODIFY `id_paciente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tbl_razas`
--
ALTER TABLE `tbl_razas`
  ADD CONSTRAINT `tbl_razas_ibfk_1` FOREIGN KEY (`id_especie`) REFERENCES `tbl_especies` (`id_especie`);

--
-- Filtros para la tabla `tb_pacientes`
--
ALTER TABLE `tb_pacientes`
  ADD CONSTRAINT `tb_pacientes_ibfk_1` FOREIGN KEY (`id_raza`) REFERENCES `tbl_razas` (`id_raza`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
