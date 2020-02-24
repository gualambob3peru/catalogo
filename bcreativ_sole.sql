-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 26-01-2020 a las 01:48:57
-- Versión del servidor: 10.2.30-MariaDB
-- Versión de PHP: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bcreativ_sole`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `operador`
--

CREATE TABLE `operador` (
  `id` int(11) NOT NULL,
  `nombres` varchar(90) NOT NULL,
  `apellidoPaterno` varchar(90) NOT NULL,
  `apellidoMaterno` varchar(90) NOT NULL,
  `nombresCompletos` varchar(270) NOT NULL,
  `foto` varchar(30) NOT NULL,
  `fechaRegistro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `operador`
--

INSERT INTO `operador` (`id`, `nombres`, `apellidoPaterno`, `apellidoMaterno`, `nombresCompletos`, `foto`, `fechaRegistro`) VALUES
(1, 'Franz', 'Gualambo', 'Giraldo', 'Franz Gualambo Giraldo', '1.jpg', '2019-11-12 22:07:04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `id_tipo_producto` int(11) NOT NULL,
  `idLinea` int(11) NOT NULL,
  `sku` varchar(15) NOT NULL,
  `codigo` varchar(30) NOT NULL,
  `idMarcas` int(11) NOT NULL,
  `idModelos` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  `imagen` varchar(500) NOT NULL,
  `idEstados` int(11) NOT NULL,
  `fechaRegistro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `id_tipo_producto`, `idLinea`, `sku`, `codigo`, `idMarcas`, `idModelos`, `descripcion`, `imagen`, `idEstados`, `fechaRegistro`) VALUES
(1, 1, 1, '21474rrrrAAA', 'COSOL014', 1, 1, 'Campana Convencional Nueva Roma 90 cm 2 motores Acero Inoxidable', '1.jpg', 1, '2019-09-20 21:59:57'),
(2, 1, 1, '22424SDSFS35DF', 'COSOL017', 1, 1, 'Campana Convencional Electra 60 cm 1 motor Acero Inoxidable', '1.jpg', 1, '2019-09-20 21:59:57'),
(3, 1, 1, '22424SDSFS35DF', 'COSOL017', 1, 1, 'Campana Convencional Nueva Lazio 60 cm 1 motor Blanca', '1.jpg', 1, '2019-09-20 21:59:57'),
(4, 1, 1, '22424SDSFS35DF', 'COSOL017', 1, 1, 'Campana Convencional Nueva Lazio 60 cm 1 motor Negra Acero Inoxidable', '1.jpg', 1, '2019-09-20 21:59:57'),
(5, 1, 2, '22424SDSFS35DF', 'COSOL017', 1, 1, 'Cocina de Pie Punta Sal 50 cm GLP', '1.jpg', 1, '2019-09-20 21:59:57'),
(6, 1, 2, '22424SDSFS35DF', 'COSOL017', 1, 1, 'Cocina de Pie Dubai 76 cm GN', '1.jpg', 1, '2019-09-20 21:59:57'),
(7, 1, 2, '22424SDSFS35DF', 'COSOL017', 1, 1, 'Cocina de Pie Varadero 60 cm GLP', '1.jpg', 1, '2019-09-20 21:59:57'),
(8, 2, 8, '22424SDSFS35DF', 'COSOL017', 1, 1, 'Rapiducha Sole Elite 5500 W', '1.jpg', 1, '2019-09-20 21:59:57'),
(9, 2, 8, '22424SDSFS35DF', 'COSOL017', 1, 1, 'Rapiducha Nueva Perfect 5500 W', '1.jpg', 1, '2019-09-20 21:59:57'),
(10, 2, 8, '22424SDSFS35DF', 'COSOL017', 1, 1, 'Rapiducha Nueva Basic 4000W', '1.jpg', 1, '2019-09-20 21:59:57');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_usuario`
--

CREATE TABLE `producto_usuario` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `sku` varchar(30) NOT NULL,
  `fechaRegistro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `producto_usuario`
--

INSERT INTO `producto_usuario` (`id`, `id_usuario`, `id_producto`, `sku`, `fechaRegistro`) VALUES
(1, 1, 1, 'ST000001', '2019-11-28 17:51:30'),
(2, 1, 2, 'ST000002', '2019-11-28 18:16:18'),
(3, 1, 2, 'ST000078', '2019-12-01 06:47:36'),
(4, 9, 5, 'ST000028', '2019-12-10 23:19:58'),
(5, 1, 1, 'ST000047', '2019-12-20 04:22:36'),
(6, 1, 1, 'ST000067', '2019-12-20 04:25:52');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `repuestos`
--

CREATE TABLE `repuestos` (
  `id` int(11) NOT NULL,
  `x` int(11) NOT NULL,
  `y` int(11) NOT NULL,
  `codigo` varchar(30) NOT NULL,
  `descripcion` varchar(90) NOT NULL,
  `fechaRegistro` timestamp NOT NULL DEFAULT current_timestamp(),
  `idEstados` int(11) NOT NULL,
  `idProductos` int(11) NOT NULL,
  `idImagenes` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `repuestos`
--

INSERT INTO `repuestos` (`id`, `x`, `y`, `codigo`, `descripcion`, `fechaRegistro`, `idEstados`, `idProductos`, `idImagenes`, `cantidad`) VALUES
(1, 234, 53, 'algo1', 'descrip2', '2019-09-04 17:41:37', 1, 1, 1, 1),
(2, 761, 166, 'otro2', 'otro3', '2019-09-04 17:41:48', 1, 1, 1, 2),
(3, 473, 84, 'sdf', 'sdf', '2019-10-01 17:25:18', 1, 1, 1, 3),
(4, 681, 196, 'wrg', 'wrg', '2019-10-01 17:25:35', 1, 1, 1, 4),
(5, 55, 272, 'dghdh', 'dghdgh2', '2019-10-01 17:25:46', 1, 1, 1, 5),
(6, 370, 146, 'ryj', 'ryjryj', '2019-10-01 17:26:06', 1, 1, 2, 1),
(7, 597, 96, 'sfgsf', 'sadfs', '2019-10-01 17:30:51', 1, 1, 3, 1),
(8, 443, 166, 'ert', 'ert', '2019-10-01 17:32:08', 1, 1, 4, 1),
(9, 443, 100, 'ert', 'ert', '2019-10-01 19:52:41', 1, 1, 4, 0),
(10, 774, 211, 'fra', 'fra', '2019-10-01 20:48:11', 1, 1, 1, 6),
(11, 134, 118, 'wil', 'wil', '2019-10-01 20:48:27', 1, 1, 1, 7),
(12, 629, 61, 'nuevo', 'nuevo', '2019-10-01 22:27:07', 1, 1, 1, 0),
(13, 333, 53, 'algo1', 'descrip2', '2019-10-01 23:22:12', 1, 1, 1, 5),
(14, 234, 53, 'algo1', 'descrip2', '2019-10-01 23:23:06', 1, 1, 1, 5),
(15, 392, 273, '121212', 'ddddd', '2019-10-09 20:56:53', 1, 1, 1, 0),
(16, 124, 341, '', '', '2019-10-09 21:05:27', 1, 1, 1, 0),
(17, 124, 341, '', '', '2019-10-09 21:05:33', 1, 1, 1, 0),
(18, 377, 473, '123', 'abab', '2019-10-09 21:12:08', 1, 1, 1, 0),
(19, 503, 558, '222', 'dfsdf', '2019-10-09 21:12:23', 1, 1, 1, 0),
(20, 659, 422, '5555', 'franz', '2019-10-09 21:13:36', 1, 1, 1, 0),
(21, 380, 378, '343434', 'sfsdf', '2019-10-09 21:13:45', 1, 1, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud`
--

CREATE TABLE `solicitud` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `sku` varchar(30) DEFAULT NULL,
  `id_producto` int(11) NOT NULL,
  `id_tipo_servicio` int(11) NOT NULL,
  `fechaRegistro` timestamp NOT NULL DEFAULT current_timestamp(),
  `fechaVisita` datetime NOT NULL,
  `costo` decimal(10,2) NOT NULL,
  `id_tipo_turno` int(11) NOT NULL,
  `id_operador` int(11) NOT NULL,
  `id_estados_solicitud` int(11) NOT NULL,
  `correlativo` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `solicitud`
--

INSERT INTO `solicitud` (`id`, `id_usuario`, `sku`, `id_producto`, `id_tipo_servicio`, `fechaRegistro`, `fechaVisita`, `costo`, `id_tipo_turno`, `id_operador`, `id_estados_solicitud`, `correlativo`) VALUES
(1, 1, 'ST000001', 1, 1, '2019-11-12 21:44:09', '2019-11-13 00:00:00', 0.00, 1, 1, 1, '01'),
(2, 1, 'ST000002', 1, 2, '2019-11-20 21:44:09', '2019-11-22 00:00:00', 0.00, 1, 1, 2, '01'),
(73, 1, 'ST000001', 1, 2, '2019-11-29 17:51:06', '2019-11-28 00:00:00', 0.00, 0, 0, 1, '02'),
(74, 1, 'ST000078', 2, 2, '2019-12-01 06:47:36', '2019-11-29 00:00:00', 0.00, 0, 0, 1, '01'),
(75, 1, 'ST000078', 3, 2, '2019-12-01 06:48:09', '2019-12-04 00:00:00', 0.00, 0, 0, 1, '02'),
(76, 1, 'ST000001', 1, 2, '2019-12-10 05:06:25', '2019-11-29 00:00:00', 0.00, 0, 0, 1, '03'),
(77, 9, 'ST000028', 5, 1, '2019-12-10 23:19:59', '2019-11-29 00:00:00', 0.00, 0, 0, 1, '01'),
(78, 1, 'ST000047', 1, 1, '2019-12-20 04:22:36', '2019-12-25 00:00:00', 0.00, 0, 0, 1, '01'),
(79, 1, 'ST000067', 1, 1, '2019-12-20 04:25:53', '2019-12-23 00:00:00', 0.00, 0, 0, 1, '01'),
(80, 1, 'ST000001', 1, 2, '2019-12-20 16:41:49', '2019-12-25 00:00:00', 0.00, 0, 0, 1, '04'),
(81, 1, 'ST000001', 1, 2, '2020-01-06 21:18:37', '2020-01-12 00:00:00', 0.00, 0, 0, 1, '05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_comprobante`
--

CREATE TABLE `tipo_comprobante` (
  `id` int(11) NOT NULL,
  `codigo` varchar(3) NOT NULL,
  `descripcion` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_comprobante`
--

INSERT INTO `tipo_comprobante` (`id`, `codigo`, `descripcion`) VALUES
(1, '01', 'FACTURA'),
(2, '02', 'BOLETA DE VENTA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_documento`
--

CREATE TABLE `tipo_documento` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(10) NOT NULL,
  `codigo` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_documento`
--

INSERT INTO `tipo_documento` (`id`, `descripcion`, `codigo`) VALUES
(1, 'dni', '01'),
(2, 'ruc', '06'),
(3, 'CE', '04'),
(4, 'PAS', '07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_producto`
--

CREATE TABLE `tipo_producto` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(90) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_producto`
--

INSERT INTO `tipo_producto` (`id`, `descripcion`) VALUES
(1, 'COCINA'),
(2, 'BAÑO'),
(3, 'CLIMATIZACIÓN'),
(4, 'NEGOCIOS');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_recibo`
--

CREATE TABLE `tipo_recibo` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(90) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_recibo`
--

INSERT INTO `tipo_recibo` (`id`, `descripcion`) VALUES
(1, 'boleta'),
(2, 'factura');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_servicio`
--

CREATE TABLE `tipo_servicio` (
  `id` int(11) NOT NULL,
  `codigo` varchar(3) NOT NULL,
  `descripcion` varchar(60) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_servicio`
--

INSERT INTO `tipo_servicio` (`id`, `codigo`, `descripcion`, `estado`) VALUES
(1, '01', 'INSTALACION', 1),
(2, '02', 'REVISION', 1),
(3, '03', 'MANTENIMIENTO', 1),
(4, '04', 'EXHIBICION', 1),
(5, '05', 'VISITA ', 1),
(6, '06', 'REINSTALACION', 0),
(7, '07', 'DESINSTALACION', 0),
(8, '08', 'VERIFICACION DE AREA', 0),
(9, '09', 'ENTREGA PROD. TIENDA ', 0),
(10, '10', 'REPARACION', 0),
(11, '11', 'CONVERSION', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_turno`
--

CREATE TABLE `tipo_turno` (
  `id` int(11) NOT NULL,
  `codigo` varchar(3) NOT NULL,
  `descripcion` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_turno`
--

INSERT INTO `tipo_turno` (`id`, `codigo`, `descripcion`) VALUES
(1, '01', 'MAÑANA'),
(2, '02', 'TARDE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `usuario` varchar(60) NOT NULL,
  `contrasena` varchar(60) NOT NULL,
  `nombres` varchar(90) NOT NULL,
  `apellidoPaterno` varchar(90) NOT NULL,
  `apellidoMaterno` varchar(90) NOT NULL,
  `nombresCompletos` varchar(270) NOT NULL,
  `idTipoDocumentos` int(11) NOT NULL,
  `nroDocumento` int(11) NOT NULL,
  `idEstados` int(11) NOT NULL DEFAULT 1,
  `fechaRegistro` timestamp NOT NULL DEFAULT current_timestamp(),
  `telefono` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `usuario`, `contrasena`, `nombres`, `apellidoPaterno`, `apellidoMaterno`, `nombresCompletos`, `idTipoDocumentos`, `nroDocumento`, `idEstados`, `fechaRegistro`, `telefono`) VALUES
(1, 'miguel@b3peru.com', '4c344f65cbd6ae2713dadf34c707813a', 'Franz Wilder', 'Gualambo', 'Giraldo', 'Franz Wilder Gualambo Giraldo', 1, 44683254, 1, '2019-10-19 15:34:57', 997330442),
(2, 'sole@sole.com', 'a3c093d3c09de29709127f8155666aea', '', '', '', '', 0, 0, 0, '2019-10-19 15:34:57', 0),
(4, 'fgualambog@uni.pe', '8dd980296e5f49fc2bd713b5f0b10312', 'Franz Wilder', 'Giraldo', 'Gualambo', 'Franz Wilder Giraldo Gualambo', 1, 2147483647, 1, '2019-10-21 21:00:32', 2147483647),
(5, 'fgualambog1@uni.pe', '8dd980296e5f49fc2bd713b5f0b10312', 'Franz Wilder', 'Giraldo', 'Gualambo', 'Franz Wilder Giraldo Gualambo', 1, 2147483647, 1, '2019-10-21 21:02:43', 123123),
(6, 'miguel22@b3peru.com', '4c344f65cbd6ae2713dadf34c707813a', 'Franz', 'Gualambo', 'Giraldo', 'Franz Gualambo Giraldo', 1, 123123123, 1, '2019-12-01 21:40:22', 123123),
(7, 'gualambo@gmail.com', 'ca0c54a49b943283fbce6571219b0d5f', 'Frank', 'Gualambos', 'Giraldos', 'Frank Gualambos Giraldos', 1, 44683254, 1, '2019-12-02 20:03:35', 997330442),
(8, 'franz@gmail.com', 'ca0c54a49b943283fbce6571219b0d5f', 'fran', 'gugu', 'giugi', 'fran gugu giugi', 1, 44683255, 1, '2019-12-02 20:47:26', 997330442),
(9, 'miguel.mendoza@b3peru.com', 'ca0c54a49b943283fbce6571219b0d5f', 'Miguel', 'Mendoza', 'Guevara', 'Miguel Mendoza Guevara', 1, 7909987, 1, '2019-12-10 23:05:33', 994035519),
(10, 'nuevo@gmail.com', 'ca0c54a49b943283fbce6571219b0d5f', 'asfasf', 'adsas', 'dasdasd', 'asfasf adsas dasdasd', 1, 44683223, 1, '2020-01-06 19:25:29', 24234234),
(11, 'mmendozab3@gmail.com', 'ca0c54a49b943283fbce6571219b0d5f', 'Miguel', 'Mendoza', 'Guevara', 'Miguel Mendoza Guevara', 1, 9876543, 1, '2020-01-06 21:05:30', 99999999);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `operador`
--
ALTER TABLE `operador`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `producto_usuario`
--
ALTER TABLE `producto_usuario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `repuestos`
--
ALTER TABLE `repuestos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `solicitud`
--
ALTER TABLE `solicitud`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_comprobante`
--
ALTER TABLE `tipo_comprobante`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_documento`
--
ALTER TABLE `tipo_documento`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_producto`
--
ALTER TABLE `tipo_producto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_recibo`
--
ALTER TABLE `tipo_recibo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_servicio`
--
ALTER TABLE `tipo_servicio`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_turno`
--
ALTER TABLE `tipo_turno`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `operador`
--
ALTER TABLE `operador`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `producto_usuario`
--
ALTER TABLE `producto_usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `repuestos`
--
ALTER TABLE `repuestos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `solicitud`
--
ALTER TABLE `solicitud`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT de la tabla `tipo_comprobante`
--
ALTER TABLE `tipo_comprobante`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipo_documento`
--
ALTER TABLE `tipo_documento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tipo_producto`
--
ALTER TABLE `tipo_producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tipo_recibo`
--
ALTER TABLE `tipo_recibo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipo_servicio`
--
ALTER TABLE `tipo_servicio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `tipo_turno`
--
ALTER TABLE `tipo_turno`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
