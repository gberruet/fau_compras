-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 30-10-2021 a las 13:38:01
-- Versión del servidor: 5.7.31
-- Versión de PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `fau_compras_symfony`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hiring`
--

DROP TABLE IF EXISTS `hiring`;
CREATE TABLE IF NOT EXISTS `hiring` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `hiring`
--

INSERT INTO `hiring` (`id`, `name`) VALUES
(1, 'Compras, gastos y servicios');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `office`
--

DROP TABLE IF EXISTS `office`;
CREATE TABLE IF NOT EXISTS `office` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `office`
--

INSERT INTO `office` (`id`, `name`) VALUES
(1, 'Dirección de Obras y Proyectos'),
(2, 'Dirección Económico Financiera');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `operation`
--

DROP TABLE IF EXISTS `operation`;
CREATE TABLE IF NOT EXISTS `operation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `operation`
--

INSERT INTO `operation` (`id`, `name`) VALUES
(1, 'Compra Irrelevante'),
(2, 'Contratación Directa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `purchase_request`
--

DROP TABLE IF EXISTS `purchase_request`;
CREATE TABLE IF NOT EXISTS `purchase_request` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `operation_id` int(11) NOT NULL,
  `hiring_id` int(11) NOT NULL,
  `office_id` int(11) NOT NULL,
  `term_id` int(11) NOT NULL,
  `purchase_reason` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estimated_price` decimal(10,2) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_204D45E644AC3583` (`operation_id`),
  KEY `IDX_204D45E683E909A6` (`hiring_id`),
  KEY `IDX_204D45E6FFA0C224` (`office_id`),
  KEY `IDX_204D45E6E2C35FC` (`term_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `purchase_request`
--

INSERT INTO `purchase_request` (`id`, `operation_id`, `hiring_id`, `office_id`, `term_id`, `purchase_reason`, `estimated_price`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, 'Cambio de lamparas en Aula 1', '10000.00', '2021-09-24 12:30:00', NULL),
(2, 1, 1, 1, 1, 'Tareas de serenía', NULL, '2021-09-25 13:54:11', NULL),
(3, 2, 1, 2, 2, 'CLO PEDRO PEREZ', '150000.00', '2021-09-25 13:57:06', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `term`
--

DROP TABLE IF EXISTS `term`;
CREATE TABLE IF NOT EXISTS `term` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `term`
--

INSERT INTO `term` (`id`, `name`) VALUES
(1, 'Inmediato'),
(2, '60 días');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `purchase_request`
--
ALTER TABLE `purchase_request`
  ADD CONSTRAINT `FK_204D45E644AC3583` FOREIGN KEY (`operation_id`) REFERENCES `operation` (`id`),
  ADD CONSTRAINT `FK_204D45E683E909A6` FOREIGN KEY (`hiring_id`) REFERENCES `hiring` (`id`),
  ADD CONSTRAINT `FK_204D45E6E2C35FC` FOREIGN KEY (`term_id`) REFERENCES `term` (`id`),
  ADD CONSTRAINT `FK_204D45E6FFA0C224` FOREIGN KEY (`office_id`) REFERENCES `office` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
