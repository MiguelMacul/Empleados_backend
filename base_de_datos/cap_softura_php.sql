-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-03-2022 a las 06:10:38
-- Versión del servidor: 10.4.20-MariaDB
-- Versión de PHP: 7.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cap_softura_php`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `catalogo_tipo_contacto`
--

CREATE TABLE `catalogo_tipo_contacto` (
  `id` int(10) UNSIGNED NOT NULL,
  `tipo_contacto` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `catalogo_tipo_contacto`
--

INSERT INTO `catalogo_tipo_contacto` (`id`, `tipo_contacto`) VALUES
(1, 'Telefono'),
(2, 'Correo'),
(3, 'Whatsapp');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contacto_empleado`
--

CREATE TABLE `contacto_empleado` (
  `id` int(10) UNSIGNED NOT NULL,
  `dato_contacto` varchar(250) NOT NULL,
  `catalogo_tipo_contacto_id` int(10) UNSIGNED NOT NULL,
  `empleado_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(80) NOT NULL,
  `paterno` varchar(45) NOT NULL,
  `materno` varchar(45) DEFAULT NULL,
  `direccion` tinytext NOT NULL,
  `genero` enum('h','m') DEFAULT NULL,
  `fecha_nacimiento` date NOT NULL,
  `estado_civil` enum('s','c','d','v') DEFAULT NULL COMMENT 's = soltero\nc = casado\nd = divorciado\nv = viudo',
  `seguro_social` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`id`, `nombre`, `paterno`, `materno`, `direccion`, `genero`, `fecha_nacimiento`, `estado_civil`, `seguro_social`) VALUES
(1, 'Miguel', 'Macuil', 'Angelñ es', 'los rojas', 'h', '2022-02-09', 'c', '244514894158'),
(5, 'gato', 'perez', NULL, '', NULL, '0000-00-00', NULL, NULL),
(6, 'Miguel', 'Gonzalez', NULL, '', NULL, '0000-00-00', NULL, NULL),
(8, 'Luis', 'perez', NULL, '', NULL, '0000-00-00', NULL, NULL),
(9, 'Juan', 'perez', NULL, '', NULL, '0000-00-00', NULL, NULL),
(10, 'Juan', 'perez', NULL, '', NULL, '0000-00-00', NULL, NULL),
(11, 'Miguel', 'Gonzalez', NULL, '', NULL, '0000-00-00', NULL, NULL),
(12, 'Miguel', 'Gonzalez', NULL, '', NULL, '0000-00-00', NULL, NULL),
(13, 'Miguel', 'Gonzalez', NULL, '', NULL, '0000-00-00', NULL, NULL),
(14, 'Miguel', 'Gonzalez', NULL, '', NULL, '0000-00-00', NULL, NULL),
(15, 'Miguel', 'Gonzalez', NULL, '', NULL, '0000-00-00', NULL, NULL),
(16, 'Miguel', 'Gonzalez', NULL, '', NULL, '0000-00-00', NULL, NULL),
(17, 'Miguel', 'Gonzalez', NULL, '', NULL, '0000-00-00', NULL, NULL),
(18, 'Miguel', 'Gonzalez', NULL, '', NULL, '0000-00-00', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `email`, `password`) VALUES
(1, 'miguelmacuil@outlook.es', '12456789'),
(2, 'miguelmacuil@outlook.es', '12456789');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `catalogo_tipo_contacto`
--
ALTER TABLE `catalogo_tipo_contacto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `contacto_empleado`
--
ALTER TABLE `contacto_empleado`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `catalogo_tipo_contacto`
--
ALTER TABLE `catalogo_tipo_contacto`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `contacto_empleado`
--
ALTER TABLE `contacto_empleado`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `empleado`
--
ALTER TABLE `empleado`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
