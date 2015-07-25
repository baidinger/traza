-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 25-07-2015 a las 06:41:50
-- Versión del servidor: 5.5.16
-- Versión de PHP: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `trazabilidad`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `camiones_distribuidor`
--

CREATE TABLE IF NOT EXISTS `camiones_distribuidor` (
  `id_camion` int(11) NOT NULL AUTO_INCREMENT,
  `placas` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `nombre_chofer` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion_camion` text COLLATE utf8_spanish_ci NOT NULL,
  `marca` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `modelo` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `id_distribuidor_fk` int(11) NOT NULL,
  PRIMARY KEY (`id_camion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `camiones_empaque`
--

CREATE TABLE IF NOT EXISTS `camiones_empaque` (
  `id_camion` int(11) NOT NULL AUTO_INCREMENT,
  `placas` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `nombre_chofer` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion_camion` text COLLATE utf8_spanish_ci NOT NULL,
  `marca` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `modelo` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `id_empaque_fk` int(11) NOT NULL,
  PRIMARY KEY (`id_camion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `distribuidor_cajas_envio`
--

CREATE TABLE IF NOT EXISTS `distribuidor_cajas_envio` (
  `id_distribuidor_cajas_envio` int(11) NOT NULL AUTO_INCREMENT,
  `id_envio_fk` int(11) NOT NULL,
  `epc_caja` varchar(24) NOT NULL,
  `epc_tarima` varchar(24) NOT NULL,
  `enviado_dce` tinyint(1) NOT NULL,
  `recibido_dce` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_distribuidor_cajas_envio`),
  KEY `id_orden_fk_idx` (`id_envio_fk`),
  KEY `id_orden_fk` (`id_envio_fk`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

--
-- Volcado de datos para la tabla `distribuidor_cajas_envio`
--

INSERT INTO `distribuidor_cajas_envio` (`id_distribuidor_cajas_envio`, `id_envio_fk`, `epc_caja`, `epc_tarima`, `enviado_dce`, `recibido_dce`) VALUES
(14, 1, '00000000000000000001234', '00000000000000000007A2A', 1, 1),
(15, 1, '00000000000000000001235', '00000000000000000007A2A', 1, 0),
(16, 1, '00000000000000000001236', '00000000000000000007A2A', 1, 0),
(17, 1, '00000000000000000001237', '00000000000000000007A2A', 1, 0),
(18, 1, '00000000000000000001238', '00000000000000000007A2A', 1, 0),
(19, 1, '00000000000000000001239', '00000000000000000007A2A', 1, 0),
(20, 1, '00000000000000000001240', '00000000000000000007A2A', 1, 0),
(21, 1, '00000000000000000001241', '00000000000000000007A2A', 1, 0),
(22, 1, '00000000000000000001242', '00000000000000000007A2A', 1, 0),
(23, 1, '00000000000000000001243', '00000000000000000007A2A', 1, 0),
(24, 1, '00000000000000000001244', '00000000000000000007A2A', 1, 0),
(25, 1, '00000000000000000001245', '00000000000000000007A2A', 1, 0),
(26, 1, '00000000000000000001246', '00000000000000000007A2A', 1, 0),
(27, 1, '00000000000000000001247', '00000000000000000007A2A', 1, 0),
(28, 1, '00000000000000000001248', '00000000000000000007A2A', 1, 0),
(29, 1, '00000000000000000001249', '00000000000000000007A2A', 1, 0),
(30, 1, '00000000000000000001250', '00000000000000000007A2A', 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa_distribuidores`
--

CREATE TABLE IF NOT EXISTS `empresa_distribuidores` (
  `id_distribuidor` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_distribuidor` varchar(200) NOT NULL,
  `rfc_distribuidor` varchar(15) NOT NULL,
  `pais_distribuidor` varchar(100) NOT NULL,
  `estado_distribuidor` varchar(100) NOT NULL,
  `ciudad_distribuidor` varchar(100) NOT NULL,
  `cp_distribuidor` varchar(10) NOT NULL,
  `email_distribuidor` varchar(45) NOT NULL,
  `tel1_distribuidor` varchar(20) NOT NULL,
  `tel2_distribuidor` varchar(20) NOT NULL,
  `direccion_distribuidor` text NOT NULL,
  `id_usuario_que_registro` int(11) NOT NULL,
  `fecha_registro_dist` date NOT NULL,
  `fecha_modificacion_dist` date NOT NULL,
  `estado` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_distribuidor`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Volcado de datos para la tabla `empresa_distribuidores`
--

INSERT INTO `empresa_distribuidores` (`id_distribuidor`, `nombre_distribuidor`, `rfc_distribuidor`, `pais_distribuidor`, `estado_distribuidor`, `ciudad_distribuidor`, `cp_distribuidor`, `email_distribuidor`, `tel1_distribuidor`, `tel2_distribuidor`, `direccion_distribuidor`, `id_usuario_que_registro`, `fecha_registro_dist`, `fecha_modificacion_dist`, `estado`) VALUES
(13, 'DISTRIBUIDOR BALTAZAR', 'BAAC920112CBA', '0', '13', 'APATZINGÃN', '60094', 'baltazar@distribuidor.com', '4535305394', '014535723280', 'LOS ALMENDROS NO 209', 1, '2015-07-24', '2015-07-24', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa_empaques`
--

CREATE TABLE IF NOT EXISTS `empresa_empaques` (
  `id_empaque` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_empaque` varchar(200) NOT NULL,
  `rfc_empaque` varchar(15) NOT NULL,
  `pais_empaque` varchar(100) NOT NULL,
  `estado_empaque` varchar(100) NOT NULL,
  `ciudad_empaque` varchar(100) NOT NULL,
  `direccion_empaque` text NOT NULL,
  `cp_empaque` varchar(10) NOT NULL,
  `email_empaque` varchar(100) NOT NULL,
  `telefono1_empaque` varchar(20) NOT NULL,
  `telefono2_empaque` varchar(20) NOT NULL,
  `id_usuario_que_registro` int(11) NOT NULL,
  `fecha_registro_emp` date NOT NULL,
  `fecha_modificacion_emp` date NOT NULL,
  `estado` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_empaque`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Volcado de datos para la tabla `empresa_empaques`
--

INSERT INTO `empresa_empaques` (`id_empaque`, `nombre_empaque`, `rfc_empaque`, `pais_empaque`, `estado_empaque`, `ciudad_empaque`, `direccion_empaque`, `cp_empaque`, `email_empaque`, `telefono1_empaque`, `telefono2_empaque`, `id_usuario_que_registro`, `fecha_registro_emp`, `fecha_modificacion_emp`, `estado`) VALUES
(1, 'SIERVO DE LA NACION', 'SIRV900305KT0', '0', '13', 'EL CEÃ‘IDOR', 'EL CEÃ‘IDOR, MUGICA. CAR. 4 CAMINOS APATZINGÃN', '61770', 'contacto@siervodelanacion.com.mx', '4255925238', '', 1, '0000-00-00', '2015-07-24', 1),
(13, 'EMPAQUE MANGUEROS', 'SVON894532JH7', '2', '1', 'MORELIA', 'ASDKL', '54223', 'siervo@siervodelanacion.com', '4531065690', '', 1, '2015-07-24', '2015-07-24', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa_productores`
--

CREATE TABLE IF NOT EXISTS `empresa_productores` (
  `id_productor` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_productor` varchar(100) NOT NULL,
  `apellido_productor` varchar(100) NOT NULL,
  `telefono_productor` varchar(20) NOT NULL,
  `direccion_productor` text NOT NULL,
  `rfc_productor` varchar(15) NOT NULL,
  `id_usuario_fk` int(11) NOT NULL,
  `id_usuario_que_registro` int(11) NOT NULL,
  `fecha_registro_prod` date NOT NULL,
  `fecha_modificacion_prod` date NOT NULL,
  `estado` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_productor`),
  KEY `id_usuario_fk` (`id_usuario_fk`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Volcado de datos para la tabla `empresa_productores`
--

INSERT INTO `empresa_productores` (`id_productor`, `nombre_productor`, `apellido_productor`, `telefono_productor`, `direccion_productor`, `rfc_productor`, `id_usuario_fk`, `id_usuario_que_registro`, `fecha_registro_prod`, `fecha_modificacion_prod`, `estado`) VALUES
(13, 'ANASTACIO', 'JIMENEZ', '4251074467', 'CONOCIDO\r\n', 'CACF909900HT6', 70, 1, '2015-07-24', '2015-07-24', 1),
(15, 'PANCRASIO', 'JIMENEZ', '4251074467', 'CEÑIDOR, CONOCIDO', 'CACF909900HT6', 73, 1, '2015-07-24', '2015-07-24', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa_punto_venta`
--

CREATE TABLE IF NOT EXISTS `empresa_punto_venta` (
  `id_punto_venta` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_punto_venta` varchar(200) NOT NULL,
  `rfc_punto_venta` varchar(15) NOT NULL,
  `pais_punto_venta` varchar(100) NOT NULL,
  `estado_punto_venta` varchar(100) NOT NULL,
  `ciudad_punto_venta` varchar(100) NOT NULL,
  `telefono_punto_venta` varchar(15) NOT NULL,
  `cp_punto_venta` varchar(10) NOT NULL,
  `email_punto_venta` varchar(100) NOT NULL,
  `direccion_punto_venta` text NOT NULL,
  `id_usuario_que_registro` int(11) NOT NULL,
  `fecha_registro_pv` date NOT NULL,
  `fecha_modificacion_pv` date NOT NULL,
  `estado` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_punto_venta`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `empresa_punto_venta`
--

INSERT INTO `empresa_punto_venta` (`id_punto_venta`, `nombre_punto_venta`, `rfc_punto_venta`, `pais_punto_venta`, `estado_punto_venta`, `ciudad_punto_venta`, `telefono_punto_venta`, `cp_punto_venta`, `email_punto_venta`, `direccion_punto_venta`, `id_usuario_que_registro`, `fecha_registro_pv`, `fecha_modificacion_pv`, `estado`) VALUES
(8, 'ALFONSO DISTRIBUIDOR', 'PTVB098855IU7', '0', '13', 'CEÃ‘IDOR', '4531209845', '61770', 'alfonso.calderon.chavez@gmail.com', 'AV. 5 DE MAYO #15', 1, '2015-07-24', '2015-07-24', 1),
(9, 'PUNTO DE VENTA BALTAZAR', 'PUVB122189GTA', '0', '13', 'URUAPAN', '014521234567', '60600', 'pvbaltazar@gmail.com', 'AV. FRANCISCO VILLA NO 15', 1, '2015-07-24', '2015-07-24', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrada_distribuidor`
--

CREATE TABLE IF NOT EXISTS `entrada_distribuidor` (
  `id_entrada` int(11) NOT NULL,
  `id_orden_fk` int(11) NOT NULL,
  `fecha_entrada` date NOT NULL,
  `hora_entrada` time NOT NULL,
  `id_usuario_distribuidor_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `envios_distribuidor`
--

CREATE TABLE IF NOT EXISTS `envios_distribuidor` (
  `id_envio` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_envio` date NOT NULL,
  `hora_envio` time NOT NULL,
  `fecha_entrega_envio` date NOT NULL,
  `id_camion_fk` int(11) NOT NULL,
  `nombre_usuario_distribuidor` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion_envio` text COLLATE utf8_spanish_ci NOT NULL,
  `descripcion_cancelacion` text COLLATE utf8_spanish_ci NOT NULL,
  `descripcion_rechazo` text COLLATE utf8_spanish_ci NOT NULL,
  `estado_envio` int(11) NOT NULL,
  `id_punto_venta_fk` int(11) NOT NULL,
  `id_orden_dist_fk` int(11) NOT NULL,
  PRIMARY KEY (`id_envio`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `envios_empaque`
--

CREATE TABLE IF NOT EXISTS `envios_empaque` (
  `id_envio` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_envio` date NOT NULL,
  `hora_envio` time NOT NULL,
  `fecha_entrega_envio` date NOT NULL,
  `id_camion_fk` int(11) NOT NULL,
  `nombre_usuario_empaque` varchar(30) NOT NULL,
  `descripcion_envio` text NOT NULL,
  `estado_envio` int(11) NOT NULL,
  `id_distribuidor_fk` int(11) NOT NULL,
  `id_orden_fk` int(11) NOT NULL,
  PRIMARY KEY (`id_envio`),
  KEY `id_distribuidor_fk_idx` (`id_distribuidor_fk`),
  KEY `id_orden_fk_idx` (`id_orden_fk`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `envios_empaque`
--

INSERT INTO `envios_empaque` (`id_envio`, `fecha_envio`, `hora_envio`, `fecha_entrega_envio`, `id_camion_fk`, `nombre_usuario_empaque`, `descripcion_envio`, `estado_envio`, `id_distribuidor_fk`, `id_orden_fk`) VALUES
(1, '2015-07-24', '08:08:25', '0000-00-00', 0, '', '', 3, 13, 14);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `epc`
--

CREATE TABLE IF NOT EXISTS `epc` (
  `epc` varchar(24) COLLATE utf8_spanish_ci NOT NULL,
  `id_lote_fk` int(11) NOT NULL,
  PRIMARY KEY (`epc`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lotes`
--

CREATE TABLE IF NOT EXISTS `lotes` (
  `id_lote` int(11) NOT NULL AUTO_INCREMENT,
  `id_productor_fk` int(11) NOT NULL,
  `id_producto_fk` int(11) NOT NULL,
  `cant_cajas_lote` int(45) NOT NULL,
  `cant_kilos_lote` decimal(45,0) NOT NULL,
  `remitente_lote` varchar(200) NOT NULL,
  `fecha_recibo_lote` date NOT NULL,
  `hora_recibo_lote` time NOT NULL,
  `costo_lote` int(11) NOT NULL,
  `fecha_recoleccion` date NOT NULL,
  `hora_recoleccion` time NOT NULL,
  `numero_peones` int(11) NOT NULL,
  `fecha_caducidad` date NOT NULL,
  `rendimiento_kg` int(11) NOT NULL,
  `rendimiento_cajas` int(11) NOT NULL,
  `id_empaque_fk` int(11) NOT NULL,
  PRIMARY KEY (`id_lote`),
  KEY `id_productor_fk_idx` (`id_productor_fk`),
  KEY `id_producto_fk_idx` (`id_producto_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ordenes_distribuidor`
--

CREATE TABLE IF NOT EXISTS `ordenes_distribuidor` (
  `id_orden` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_orden` date NOT NULL,
  `fecha_entrega_orden` date NOT NULL,
  `costo_orden` decimal(10,2) NOT NULL,
  `descripcion_orden` text NOT NULL,
  `descripcion_cancelacion` text NOT NULL,
  `descripcion_rechazo` text NOT NULL,
  `id_usuario_distribuidor_fk` int(11) NOT NULL,
  `id_empaque_fk` int(11) NOT NULL,
  `estatus_orden` int(11) NOT NULL,
  PRIMARY KEY (`id_orden`),
  KEY `id_usuario_distribuidor_fk_idx` (`id_usuario_distribuidor_fk`),
  KEY `id_empaque_fk_idx` (`id_empaque_fk`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Volcado de datos para la tabla `ordenes_distribuidor`
--

INSERT INTO `ordenes_distribuidor` (`id_orden`, `fecha_orden`, `fecha_entrega_orden`, `costo_orden`, `descripcion_orden`, `descripcion_cancelacion`, `descripcion_rechazo`, `id_usuario_distribuidor_fk`, `id_empaque_fk`, `estatus_orden`) VALUES
(14, '2015-07-23', '2015-07-31', '21300.00', 'DescripciÃ³n de la orden, favor de confirmar lo mas pronto posible. Saludos', '', '', 20, 1, 3),
(15, '2015-07-24', '2015-08-03', '18250.00', 'Necesito una carga grande de limÃ³n persa, no importan mucho los calibres, sÃ³lo necesito que el peso mÃ­nimo del limÃ³n sea de 50 gramos.', 'Ya no necesito la orden, conseguÃ­ mejores precios. Gracias.', '', 20, 13, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ordenes_distribuidor_detalles`
--

CREATE TABLE IF NOT EXISTS `ordenes_distribuidor_detalles` (
  `id_orden_detalles` int(11) NOT NULL AUTO_INCREMENT,
  `cantidad_producto_od` int(11) NOT NULL,
  `unidad_producto_od` varchar(45) NOT NULL,
  `costo_unitario_od` decimal(10,2) NOT NULL,
  `costo_producto_od` decimal(10,2) NOT NULL,
  `id_orden_fk` int(11) NOT NULL,
  `id_producto_fk` int(11) NOT NULL,
  PRIMARY KEY (`id_orden_detalles`),
  KEY `id_orden_fk_idx` (`id_orden_fk`),
  KEY `id_producto_fk_idx` (`id_producto_fk`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `ordenes_distribuidor_detalles`
--

INSERT INTO `ordenes_distribuidor_detalles` (`id_orden_detalles`, `cantidad_producto_od`, `unidad_producto_od`, `costo_unitario_od`, `costo_producto_od`, `id_orden_fk`, `id_producto_fk`) VALUES
(1, 1000, 'KILOS', '8.50', '8500.00', 14, 1),
(2, 1000, 'KILOS', '12.80', '12800.00', 14, 2),
(3, 2500, 'KILOS', '7.30', '18250.00', 15, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ordenes_punto_venta`
--

CREATE TABLE IF NOT EXISTS `ordenes_punto_venta` (
  `id_orden` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_orden` date NOT NULL,
  `fecha_entrega_orden` date NOT NULL,
  `costo_orden` decimal(10,2) NOT NULL,
  `descripcion_orden` text NOT NULL,
  `descripcion_cancelacion` text NOT NULL,
  `descripcion_rechazo` text NOT NULL,
  `id_usuario_punto_venta_fk` int(11) NOT NULL,
  `id_distribuidor_fk` int(11) NOT NULL,
  `estado_orden` int(11) NOT NULL,
  PRIMARY KEY (`id_orden`),
  KEY `id_usuario_punto_venta_idx` (`id_usuario_punto_venta_fk`),
  KEY `id_distribuidor_fk_idx` (`id_distribuidor_fk`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `ordenes_punto_venta`
--

INSERT INTO `ordenes_punto_venta` (`id_orden`, `fecha_orden`, `fecha_entrega_orden`, `costo_orden`, `descripcion_orden`, `descripcion_cancelacion`, `descripcion_rechazo`, `id_usuario_punto_venta_fk`, `id_distribuidor_fk`, `estado_orden`) VALUES
(1, '2015-07-24', '2015-07-31', '1450.00', 'Sin descripciÃ³n.', 'Siempre no la quiero. Gracias.', '', 9, 13, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ordenes_punto_venta_detalles`
--

CREATE TABLE IF NOT EXISTS `ordenes_punto_venta_detalles` (
  `id_orden_dist_detalles` int(11) NOT NULL AUTO_INCREMENT,
  `id_orden_dist_fk` int(11) NOT NULL,
  `id_producto_fk` int(11) NOT NULL,
  `cant_producto_odd` int(11) NOT NULL,
  `unidad_producto_odd` varchar(45) NOT NULL,
  `costo_unitario_odd` decimal(10,2) NOT NULL,
  `costo_producto_odd` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id_orden_dist_detalles`),
  KEY `id_orden_dist_fk_idx` (`id_orden_dist_fk`),
  KEY `id_producto_fk_idx` (`id_producto_fk`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `ordenes_punto_venta_detalles`
--

INSERT INTO `ordenes_punto_venta_detalles` (`id_orden_dist_detalles`, `id_orden_dist_fk`, `id_producto_fk`, `cant_producto_odd`, `unidad_producto_odd`, `costo_unitario_odd`, `costo_producto_odd`) VALUES
(1, 1, 1, 50, 'KILOS', '15.00', '750.00'),
(2, 1, 2, 50, 'KILOS', '14.00', '700.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE IF NOT EXISTS `productos` (
  `id_producto` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_producto` varchar(100) NOT NULL,
  `variedad_producto` varchar(100) NOT NULL,
  PRIMARY KEY (`id_producto`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `nombre_producto`, `variedad_producto`) VALUES
(1, 'MANGO', 'ATAULFO'),
(2, 'MANGO', 'HEIDEN'),
(3, 'MANGO', 'TOMMY'),
(4, 'LIMON', 'PERSA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_distribuidores`
--

CREATE TABLE IF NOT EXISTS `productos_distribuidores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_distribuidor_fk` int(11) NOT NULL,
  `id_producto_fk` int(11) NOT NULL,
  `precio_venta` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_empaques`
--

CREATE TABLE IF NOT EXISTS `productos_empaques` (
  `id_productos_empaque` int(11) NOT NULL AUTO_INCREMENT,
  `id_empaque_fk` int(11) NOT NULL,
  `id_producto_fk` int(11) NOT NULL,
  `precio_venta` decimal(10,2) NOT NULL,
  `precio_compra` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id_productos_empaque`),
  KEY `id_producto_fk_idx` (`id_producto_fk`),
  KEY `id_empaque_fk_idx` (`id_empaque_fk`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `productos_empaques`
--

INSERT INTO `productos_empaques` (`id_productos_empaque`, `id_empaque_fk`, `id_producto_fk`, `precio_venta`, `precio_compra`) VALUES
(5, 1, 1, '8.50', '3.30'),
(6, 1, 2, '12.80', '4.25'),
(7, 13, 4, '7.30', '2.20'),
(8, 13, 1, '8.50', '3.30'),
(9, 13, 2, '4.25', '12.80');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_productores`
--

CREATE TABLE IF NOT EXISTS `productos_productores` (
  `id_productos_productores` int(11) NOT NULL AUTO_INCREMENT,
  `id_productor_fk` int(11) NOT NULL,
  `id_producto_fk` int(11) NOT NULL,
  `ubicacion_huerta` text NOT NULL,
  `hectareas` text NOT NULL,
  `descripcion_detalles_pp` text NOT NULL,
  PRIMARY KEY (`id_productos_productores`),
  KEY `id_productor_fk_idx` (`id_productor_fk`),
  KEY `id_producto_fk_idx` (`id_producto_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `punto_venta_cajas_envio`
--

CREATE TABLE IF NOT EXISTS `punto_venta_cajas_envio` (
  `id_punto_venta_cajas_envio` int(11) NOT NULL AUTO_INCREMENT,
  `id_envio_fk` int(11) NOT NULL,
  `epc_caja` varchar(24) NOT NULL,
  `epc_tarima` varchar(24) NOT NULL,
  `enviado_dce` tinyint(1) NOT NULL,
  `recibido_dce` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_punto_venta_cajas_envio`),
  KEY `punto_venta_cajas_envio_ibfk_1` (`id_envio_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_usuario` varchar(100) NOT NULL,
  `contrasena_usuario` varchar(45) NOT NULL,
  `tipo_socio_usuario` int(11) NOT NULL,
  `nivel_autorizacion_usuario` int(11) NOT NULL,
  `fecha_creacion_usuario` date NOT NULL,
  `fecha_modificacion_usuario` date NOT NULL,
  `estado_usuario` int(11) NOT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `nombre_usuario` (`nombre_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=89 ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre_usuario`, `contrasena_usuario`, `tipo_socio_usuario`, `nivel_autorizacion_usuario`, `fecha_creacion_usuario`, `fecha_modificacion_usuario`, `estado_usuario`) VALUES
(1, 'ADMINEMPAQUE', '05a7b54baab0eedc17c3217a3fcafbed', 2, 1, '2015-07-09', '2015-07-01', 1),
(67, 'PRODUCTOR1', 'b392dc4500d7490e52e44cc360a52db6', 1, 1, '2015-07-23', '2015-07-23', 1),
(68, 'ALFONSO1', '8bde3b962f1b08e54a32880e1dee5f3d', 1, 1, '2015-07-24', '2015-07-24', 1),
(70, 'PRODUCTOR', 'a01bf2fd9d9a9ecc2aebfe42ca55c4f0', 1, 1, '2015-07-24', '2015-07-24', 1),
(73, 'TONY', 'ddc5f5e86d2f85e1b1ff763aff13ce0a', 1, 1, '2015-07-24', '2015-07-24', 1),
(77, 'EMPA', '9bd58a8b026f60ac850ecb1cd0451468', 2, 1, '2015-07-24', '2015-07-24', 1),
(78, 'DIST', '2a6d07eef8b10b84129b42424ed99327', 3, 1, '2015-07-24', '2015-07-23', 1),
(85, 'ROOT2', '6a2cd24438d8a22f757a6a0d2f4e7a11', 4, 1, '2015-07-24', '2015-07-24', 1),
(86, 'dist2', '2a6d07eef8b10b84129b42424ed99327', 3, 2, '2015-07-24', '2015-07-25', 1),
(87, 'PV', '99bea2cd698b56b1a3b8c1701bd51c67', 4, 1, '2015-07-24', '2015-07-24', 1),
(88, 'EMPAQUE', 'cefd04f07d55b35421c3fa1ed1abb530', 2, 2, '2015-07-24', '2015-07-24', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_distribuidor`
--

CREATE TABLE IF NOT EXISTS `usuario_distribuidor` (
  `id_usuario_distribuidor` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_usuario_distribuidor` varchar(100) NOT NULL,
  `apellido_usuario_distribuidor` varchar(100) NOT NULL,
  `direccion_usuario_distribuidor` text NOT NULL,
  `telefono_usuario_distribuidor` varchar(20) NOT NULL,
  `entradas` int(11) NOT NULL DEFAULT '0',
  `pedidos` int(11) NOT NULL DEFAULT '0',
  `envios` int(11) NOT NULL DEFAULT '0',
  `id_usuario_fk` int(11) NOT NULL,
  `id_distribuidor_fk` int(11) NOT NULL,
  PRIMARY KEY (`id_usuario_distribuidor`),
  KEY `id_usuario_fk_idx` (`id_usuario_fk`),
  KEY `id_distribuidor_fk_idx` (`id_distribuidor_fk`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Volcado de datos para la tabla `usuario_distribuidor`
--

INSERT INTO `usuario_distribuidor` (`id_usuario_distribuidor`, `nombre_usuario_distribuidor`, `apellido_usuario_distribuidor`, `direccion_usuario_distribuidor`, `telefono_usuario_distribuidor`, `entradas`, `pedidos`, `envios`, `id_usuario_fk`, `id_distribuidor_fk`) VALUES
(20, 'CHRISTOPHER', 'BALTAZAR AMBRIZ', 'Los Almendros No. 209', '4535305394', 1, 1, 1, 78, 13),
(21, 'JORGE EDUARDO', 'LEMUS BALTAZAR', 'Issac Arriaga No 97', '4521541118', 0, 1, 0, 86, 13);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_empaque`
--

CREATE TABLE IF NOT EXISTS `usuario_empaque` (
  `id_receptor` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_receptor` varchar(100) NOT NULL,
  `apellido_receptor` varchar(100) NOT NULL,
  `direccion_receptor` varchar(100) NOT NULL,
  `telefono_receptor` varchar(20) NOT NULL,
  `pedidos` int(11) NOT NULL DEFAULT '0',
  `lotes` int(11) NOT NULL DEFAULT '0',
  `envios` int(11) NOT NULL DEFAULT '0',
  `superusuario` int(11) NOT NULL DEFAULT '0',
  `id_usuario_fk` int(11) NOT NULL,
  `id_empaque_fk` int(11) NOT NULL,
  PRIMARY KEY (`id_receptor`),
  KEY `id_usuario_fk_idx` (`id_usuario_fk`),
  KEY `id_empaque_fk_idx` (`id_empaque_fk`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `usuario_empaque`
--

INSERT INTO `usuario_empaque` (`id_receptor`, `nombre_receptor`, `apellido_receptor`, `direccion_receptor`, `telefono_receptor`, `pedidos`, `lotes`, `envios`, `superusuario`, `id_usuario_fk`, `id_empaque_fk`) VALUES
(1, 'ALFONSO', 'CALDERÃ“N CHÃVEZ', 'APATZINGÃN, COL. 22 DE OCTUBRE, CALLE VENUZTIANO CARRANZA', '4531064590', 1, 1, 1, 1, 1, 1),
(9, 'ADMIN', 'ADMIN', 'ADMIN', '0000000000', 1, 1, 1, 0, 77, 13),
(10, 'NOMBRE', 'APELLIDOS', '152412', '45124512', 0, 0, 0, 0, 88, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_punto_venta`
--

CREATE TABLE IF NOT EXISTS `usuario_punto_venta` (
  `id_usuario_pv` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario_punto_venta` int(11) NOT NULL,
  `id_usuario_fk` int(11) NOT NULL,
  `nombre_usuario_pv` varchar(45) NOT NULL,
  `apellidos_usuario_pv` varchar(45) NOT NULL,
  `telefono_usuario_pv` varchar(45) NOT NULL,
  `direccion_usuario_pv` varchar(45) NOT NULL,
  PRIMARY KEY (`id_usuario_pv`),
  KEY `id_usuario_fk_idx` (`id_usuario_fk`),
  KEY `id_usuario_punto_venta_idx` (`id_usuario_punto_venta`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `usuario_punto_venta`
--

INSERT INTO `usuario_punto_venta` (`id_usuario_pv`, `id_usuario_punto_venta`, `id_usuario_fk`, `nombre_usuario_pv`, `apellidos_usuario_pv`, `telefono_usuario_pv`, `direccion_usuario_pv`) VALUES
(8, 8, 85, 'ADMIN', 'ADMIN', '0000000000', 'ADMIN'),
(9, 9, 87, 'ADMIN', 'ADMIN', '0000000000', 'ADMIN');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `distribuidor_cajas_envio`
--
ALTER TABLE `distribuidor_cajas_envio`
  ADD CONSTRAINT `distribuidor_cajas_envio_ibfk_1` FOREIGN KEY (`id_envio_fk`) REFERENCES `envios_empaque` (`id_envio`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `empresa_productores`
--
ALTER TABLE `empresa_productores`
  ADD CONSTRAINT `empresa_productores_ibfk_1` FOREIGN KEY (`id_usuario_fk`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `envios_empaque`
--
ALTER TABLE `envios_empaque`
  ADD CONSTRAINT `envios_empaque_ibfk_1` FOREIGN KEY (`id_distribuidor_fk`) REFERENCES `empresa_distribuidores` (`id_distribuidor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `envios_empaque_ibfk_2` FOREIGN KEY (`id_orden_fk`) REFERENCES `ordenes_distribuidor` (`id_orden`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `lotes`
--
ALTER TABLE `lotes`
  ADD CONSTRAINT `lotes_ibfk_1` FOREIGN KEY (`id_productor_fk`) REFERENCES `empresa_productores` (`id_productor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lotes_ibfk_2` FOREIGN KEY (`id_producto_fk`) REFERENCES `productos` (`id_producto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ordenes_distribuidor`
--
ALTER TABLE `ordenes_distribuidor`
  ADD CONSTRAINT `ordenes_distribuidor_ibfk_1` FOREIGN KEY (`id_usuario_distribuidor_fk`) REFERENCES `usuario_distribuidor` (`id_usuario_distribuidor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ordenes_distribuidor_ibfk_2` FOREIGN KEY (`id_empaque_fk`) REFERENCES `empresa_empaques` (`id_empaque`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ordenes_distribuidor_detalles`
--
ALTER TABLE `ordenes_distribuidor_detalles`
  ADD CONSTRAINT `ordenes_distribuidor_detalles_ibfk_1` FOREIGN KEY (`id_orden_fk`) REFERENCES `ordenes_distribuidor` (`id_orden`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ordenes_distribuidor_detalles_ibfk_2` FOREIGN KEY (`id_producto_fk`) REFERENCES `productos` (`id_producto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ordenes_punto_venta`
--
ALTER TABLE `ordenes_punto_venta`
  ADD CONSTRAINT `ordenes_punto_venta_ibfk_1` FOREIGN KEY (`id_usuario_punto_venta_fk`) REFERENCES `usuario_punto_venta` (`id_usuario_pv`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ordenes_punto_venta_ibfk_2` FOREIGN KEY (`id_distribuidor_fk`) REFERENCES `empresa_distribuidores` (`id_distribuidor`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ordenes_punto_venta_detalles`
--
ALTER TABLE `ordenes_punto_venta_detalles`
  ADD CONSTRAINT `ordenes_punto_venta_detalles_ibfk_1` FOREIGN KEY (`id_orden_dist_fk`) REFERENCES `ordenes_punto_venta` (`id_orden`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ordenes_punto_venta_detalles_ibfk_2` FOREIGN KEY (`id_producto_fk`) REFERENCES `productos` (`id_producto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `productos_empaques`
--
ALTER TABLE `productos_empaques`
  ADD CONSTRAINT `productos_empaques_ibfk_1` FOREIGN KEY (`id_producto_fk`) REFERENCES `productos` (`id_producto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `productos_empaques_ibfk_2` FOREIGN KEY (`id_empaque_fk`) REFERENCES `empresa_empaques` (`id_empaque`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `productos_productores`
--
ALTER TABLE `productos_productores`
  ADD CONSTRAINT `productos_productores_ibfk_1` FOREIGN KEY (`id_productor_fk`) REFERENCES `empresa_productores` (`id_productor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `productos_productores_ibfk_2` FOREIGN KEY (`id_producto_fk`) REFERENCES `productos` (`id_producto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `punto_venta_cajas_envio`
--
ALTER TABLE `punto_venta_cajas_envio`
  ADD CONSTRAINT `punto_venta_cajas_envio_ibfk_1` FOREIGN KEY (`id_envio_fk`) REFERENCES `envios_distribuidor` (`id_envio`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario_distribuidor`
--
ALTER TABLE `usuario_distribuidor`
  ADD CONSTRAINT `usuario_distribuidor_ibfk_1` FOREIGN KEY (`id_usuario_fk`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuario_distribuidor_ibfk_2` FOREIGN KEY (`id_distribuidor_fk`) REFERENCES `empresa_distribuidores` (`id_distribuidor`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario_empaque`
--
ALTER TABLE `usuario_empaque`
  ADD CONSTRAINT `usuario_empaque_ibfk_1` FOREIGN KEY (`id_usuario_fk`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuario_empaque_ibfk_2` FOREIGN KEY (`id_empaque_fk`) REFERENCES `empresa_empaques` (`id_empaque`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario_punto_venta`
--
ALTER TABLE `usuario_punto_venta`
  ADD CONSTRAINT `usuario_punto_venta_ibfk_1` FOREIGN KEY (`id_usuario_fk`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuario_punto_venta_ibfk_2` FOREIGN KEY (`id_usuario_punto_venta`) REFERENCES `empresa_punto_venta` (`id_punto_venta`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
