-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-08-2024 a las 10:08:34
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
-- Base de datos: `inventarios`
--
CREATE DATABASE IF NOT EXISTS `inventarios` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `inventarios`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oc_cabecera`
--

CREATE TABLE `oc_cabecera` (
  `oc_id` int(11) NOT NULL,
  `proveedor_id` int(11) NOT NULL,
  `oc_fecha` date NOT NULL,
  `oc_subtotal` decimal(10,2) NOT NULL,
  `oc_impuesto` decimal(10,2) NOT NULL,
  `oc_total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `oc_cabecera`
--

INSERT INTO `oc_cabecera` (`oc_id`, `proveedor_id`, `oc_fecha`, `oc_subtotal`, `oc_impuesto`, `oc_total`) VALUES
(1, 1, '2024-08-14', 150.00, 22.50, 177.50),
(2, 2, '2024-08-14', 200.00, 30.00, 230.00),
(3, 1, '2024-08-14', 150.00, 22.50, 177.50),
(4, 2, '2024-08-14', 200.00, 30.00, 230.00),
(5, 1, '2024-08-15', 400.00, 60.00, 460.00),
(6, 2, '2024-08-15', 100.00, 15.00, 115.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oc_detalle`
--

CREATE TABLE `oc_detalle` (
  `numEntry` int(11) NOT NULL,
  `orden_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `cantidad` decimal(10,2) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `impuestoLinea` decimal(10,2) NOT NULL,
  `totalLinea` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `oc_detalle`
--

INSERT INTO `oc_detalle` (`numEntry`, `orden_id`, `producto_id`, `cantidad`, `precio`, `impuestoLinea`, `totalLinea`) VALUES
(1, 1, 1, 5.00, 9.00, 6.75, 51.75),
(2, 2, 2, 100.00, 0.20, 3.00, 23.00),
(3, 2, 2, 10.00, 0.20, 0.30, 2.30),
(4, 1, 1, 5.00, 9.00, 6.75, 51.75),
(5, 2, 2, 100.00, 0.20, 3.00, 23.00),
(6, 4, 3, 100.00, 0.20, 3.00, 23.00),
(7, 4, 2, 100.00, 0.20, 3.00, 23.00),
(8, 5, 4, 100.00, 0.20, 3.00, 23.00),
(9, 6, 5, 100.00, 0.20, 3.00, 23.00),
(10, 6, 6, 10.00, 0.20, 0.30, 2.30);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `producto_id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precioProm` decimal(10,2) NOT NULL,
  `precioUltCompra` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `estado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`producto_id`, `nombre`, `descripcion`, `precioProm`, `precioUltCompra`, `stock`, `estado`) VALUES
(1, 'FARMACO IBUPROFENO', 'IBUPROFENO 100mg', 8.20, 9.00, 500, 1),
(2, 'ACETAMINOFEN', 'ASPIRINA 50mg', 0.50, 0.20, 200, 1),
(3, 'FARMACO NIFURIL', 'NIFURIL 10mg', 8.20, 9.00, 500, 1),
(4, 'FARMACO PARACETAMOL', 'PARACETAMOL 120mg', 5.20, 4.00, 100, 1),
(5, 'FARMACO BACTRIM', 'BACTRIM 100mg', 5.20, 4.05, 800, 1),
(6, 'FARMACO DICLOFENACO', 'DICLOFENACO 50mg', 5.00, 3.00, 700, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `proveedor_id` int(11) NOT NULL,
  `dni` varchar(13) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `estado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`proveedor_id`, `dni`, `nombre`, `direccion`, `telefono`, `email`, `estado`) VALUES
(1, '1802460137001', 'WORMAN ANDRADE', 'SAN CARLOS', '0983074350', 'wormandrade@gmail.com', 1),
(2, '1802715571', 'ANITA ALVAREZ', 'SAN CARLOS', '0998490620', 'anitaalvareza@hotmail.com', 1),
(3, '1802460137001', 'JUAN ANDRADE', 'AMBATO', '0983074350', 'juanandrade@gmail.com', 1),
(4, '1805060137001', 'BRYAN ANDRADE', 'PUYO', '0983074350', 'bryandrade@gmail.com', 1),
(5, '1805560137001', 'MELANIE ANDRADE', 'TENA', '0983074350', 'melaandrade@gmail.com', 1),
(6, '1802715571001', 'ANGELITA ALVAREZ', 'SAN CARLOS', '0998490620', 'angelitaalvareza@hotmail.com', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `oc_cabecera`
--
ALTER TABLE `oc_cabecera`
  ADD PRIMARY KEY (`oc_id`),
  ADD KEY `proveedor_id` (`proveedor_id`);

--
-- Indices de la tabla `oc_detalle`
--
ALTER TABLE `oc_detalle`
  ADD PRIMARY KEY (`numEntry`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`producto_id`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`proveedor_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `oc_cabecera`
--
ALTER TABLE `oc_cabecera`
  MODIFY `oc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `oc_detalle`
--
ALTER TABLE `oc_detalle`
  MODIFY `numEntry` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `producto_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `proveedor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `oc_cabecera`
--
ALTER TABLE `oc_cabecera`
  ADD CONSTRAINT `oc_cabecera_ibfk_1` FOREIGN KEY (`proveedor_id`) REFERENCES `proveedores` (`proveedor_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
