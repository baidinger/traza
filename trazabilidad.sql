-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 08-08-2015 a las 23:35:32
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
  `id_camion_distribuidor` int(11) NOT NULL AUTO_INCREMENT,
  `placas_camion_distribuidor` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `nombre_chofer_camion_distribuidor` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion_camion_distribuidor` text COLLATE utf8_spanish_ci NOT NULL,
  `marca_camion_distribuidor` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `modelo_camion_distribuidor` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `id_distribuidor_fk` int(11) NOT NULL,
  `disponibilidad_camion_distribuidor` int(11) NOT NULL,
  `estado_camion_distribuidor` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_camion_distribuidor`),
  KEY `id_distribuidor_fk` (`id_distribuidor_fk`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `camiones_distribuidor`
--

INSERT INTO `camiones_distribuidor` (`id_camion_distribuidor`, `placas_camion_distribuidor`, `nombre_chofer_camion_distribuidor`, `descripcion_camion_distribuidor`, `marca_camion_distribuidor`, `modelo_camion_distribuidor`, `id_distribuidor_fk`, `disponibilidad_camion_distribuidor`, `estado_camion_distribuidor`) VALUES
(1, 'FGP-98-23', 'FROYLAN GONZALES PEDRIZCO', 'Blanco con verde', 'FORD', '2011', 1, 0, 1),
(2, 'RRP-67-45', 'RAFAEL ROJO PEREZ', 'Gris', 'FORD', '2012', 1, 0, 1),
(3, 'SCT-95-32', 'SEGIO COBIAN DEL TORO', 'Verde', 'CHEVROLET', '1995', 2, 0, 1),
(4, 'URD-76-99', 'UBER GERARDO REYES DUEÃ±AS', 'Rojo', 'CHEVROLET', '1999', 2, 0, 1);

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
  `disponibilidad_ce` int(11) NOT NULL,
  `estado_ce` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_camion`),
  KEY `id_empaque_fk` (`id_empaque_fk`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `camiones_empaque`
--

INSERT INTO `camiones_empaque` (`id_camion`, `placas`, `nombre_chofer`, `descripcion_camion`, `marca`, `modelo`, `id_empaque_fk`, `disponibilidad_ce`, `estado_ce`) VALUES
(1, 'ARM-12-45', 'ANDRES RIVERA MONTOYA', 'Color azul', 'FORD', '2010', 1, 1, 1),
(2, 'RBP-12-32', 'RICARDO BELTRAN PEÃ±ALOZA', 'Rojo', 'chevrolet', '2011', 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `distribuidor_cajas_envio`
--

CREATE TABLE IF NOT EXISTS `distribuidor_cajas_envio` (
  `id_distribuidor_cajas_envio` int(11) NOT NULL AUTO_INCREMENT,
  `id_envio_fk` int(11) NOT NULL,
  `epc_caja` varchar(24) COLLATE utf8_spanish_ci NOT NULL,
  `epc_tarima` varchar(24) COLLATE utf8_spanish_ci NOT NULL,
  `enviado_dce` tinyint(1) NOT NULL,
  `recibido_dce` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_distribuidor_cajas_envio`),
  KEY `id_orden_fk_idx` (`id_envio_fk`),
  KEY `id_orden_fk` (`id_envio_fk`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `distribuidor_cajas_envio`
--

INSERT INTO `distribuidor_cajas_envio` (`id_distribuidor_cajas_envio`, `id_envio_fk`, `epc_caja`, `epc_tarima`, `enviado_dce`, `recibido_dce`) VALUES
(1, 2, '000000001000009000000005', '010000000000000000006221', 1, 1),
(2, 2, '000000001000009000000003', '010000000000000000006221', 1, 1),
(3, 2, '000000001000009000000004', '010000000000000000006221', 1, 1),
(4, 2, '000000001000009000000001', '010000000000000000006221', 1, 1),
(5, 2, '000000001000009000000002', '010000000000000000006221', 1, 1),
(6, 3, '000000001000016000000001', '010000001000000000000001', 1, 1),
(7, 3, '000000001000016000000003', '010000001000000000000001', 1, 1),
(8, 3, '000000001000016000000004', '010000001000000000000001', 1, 1),
(9, 3, '000000001000016000000002', '010000001000000000000001', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa_distribuidores`
--

CREATE TABLE IF NOT EXISTS `empresa_distribuidores` (
  `id_distribuidor` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_distribuidor` varchar(200) CHARACTER SET utf8 NOT NULL,
  `rfc_distribuidor` varchar(15) CHARACTER SET utf8 NOT NULL,
  `pais_distribuidor` varchar(100) CHARACTER SET utf8 NOT NULL,
  `estado_distribuidor` varchar(100) CHARACTER SET utf8 NOT NULL,
  `ciudad_distribuidor` varchar(100) CHARACTER SET utf8 NOT NULL,
  `cp_distribuidor` varchar(10) CHARACTER SET utf8 NOT NULL,
  `email_distribuidor` varchar(45) CHARACTER SET utf8 NOT NULL,
  `tel1_distribuidor` varchar(20) CHARACTER SET utf8 NOT NULL,
  `tel2_distribuidor` varchar(20) CHARACTER SET utf8 NOT NULL,
  `direccion_distribuidor` text CHARACTER SET utf8 NOT NULL,
  `id_usuario_que_registro` int(11) NOT NULL,
  `fecha_registro_dist` date NOT NULL,
  `fecha_modificacion_dist` date NOT NULL,
  `estado_d` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_distribuidor`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `empresa_distribuidores`
--

INSERT INTO `empresa_distribuidores` (`id_distribuidor`, `nombre_distribuidor`, `rfc_distribuidor`, `pais_distribuidor`, `estado_distribuidor`, `ciudad_distribuidor`, `cp_distribuidor`, `email_distribuidor`, `tel1_distribuidor`, `tel2_distribuidor`, `direccion_distribuidor`, `id_usuario_que_registro`, `fecha_registro_dist`, `fecha_modificacion_dist`, `estado_d`) VALUES
(1, 'DISTRIBUIDOR BALTAZAR', 'BADI920112856', '0', '13', 'APATZINGAN', '60684', 'distribuidor@gmail.com', '4535305392', '014535723280', 'ALMENDROS NO 209', 1, '2015-08-06', '2015-08-06', 1),
(2, 'DISTRIBUIDOR PRADO', 'PRDI910621PR5', '0', '13', 'URUAPAN', '60600', 'distribuidor@hotmail.com', '4521142350', '014525191159', 'AV. 5 DE MAYO #15', 1, '2015-08-06', '2015-08-06', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa_empaques`
--

CREATE TABLE IF NOT EXISTS `empresa_empaques` (
  `id_empaque` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_empaque` varchar(200) CHARACTER SET utf8 NOT NULL,
  `rfc_empaque` varchar(15) CHARACTER SET utf8 NOT NULL,
  `pais_empaque` varchar(100) CHARACTER SET utf8 NOT NULL,
  `estado_empaque` varchar(100) CHARACTER SET utf8 NOT NULL,
  `ciudad_empaque` varchar(100) CHARACTER SET utf8 NOT NULL,
  `direccion_empaque` text CHARACTER SET utf8 NOT NULL,
  `cp_empaque` varchar(10) CHARACTER SET utf8 NOT NULL,
  `email_empaque` varchar(100) CHARACTER SET utf8 NOT NULL,
  `telefono1_empaque` varchar(20) CHARACTER SET utf8 NOT NULL,
  `telefono2_empaque` varchar(20) CHARACTER SET utf8 NOT NULL,
  `id_usuario_que_registro` int(11) NOT NULL,
  `fecha_registro_emp` date NOT NULL,
  `fecha_modificacion_emp` date NOT NULL,
  `estado_e` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_empaque`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `empresa_empaques`
--

INSERT INTO `empresa_empaques` (`id_empaque`, `nombre_empaque`, `rfc_empaque`, `pais_empaque`, `estado_empaque`, `ciudad_empaque`, `direccion_empaque`, `cp_empaque`, `email_empaque`, `telefono1_empaque`, `telefono2_empaque`, `id_usuario_que_registro`, `fecha_registro_emp`, `fecha_modificacion_emp`, `estado_e`) VALUES
(1, 'SIERVO DE LA NACION', 'SIRV900305KT0', '0', '13', 'EL CEÃ‘IDOR', 'EL CEÃ‘IDOR, MUGICA. CAR. 4 CAMINOS APATZINGÃN', '61770', 'contacto@siervodelanacion.com.mx', '4255925238', '', 1, '0000-00-00', '2015-07-24', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa_productores`
--

CREATE TABLE IF NOT EXISTS `empresa_productores` (
  `id_productor` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_productor` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `apellido_productor` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `telefono_productor` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `direccion_productor` text COLLATE utf8_spanish_ci NOT NULL,
  `rfc_productor` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `id_usuario_fk` int(11) NOT NULL,
  `id_usuario_que_registro` int(11) NOT NULL,
  `fecha_registro_prod` date NOT NULL,
  `fecha_modificacion_prod` date NOT NULL,
  `estado_p` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_productor`),
  KEY `id_usuario_fk` (`id_usuario_fk`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `empresa_productores`
--

INSERT INTO `empresa_productores` (`id_productor`, `nombre_productor`, `apellido_productor`, `telefono_productor`, `direccion_productor`, `rfc_productor`, `id_usuario_fk`, `id_usuario_que_registro`, `fecha_registro_prod`, `fecha_modificacion_prod`, `estado_p`) VALUES
(1, 'SERGIO', 'PARDO SANCHEZ', '4251119804', 'CONOCIDO EL CEÃ±IDOR S/N', 'PASS120775AS2', 2, 1, '2015-08-06', '2015-08-06', 1),
(2, 'GENARO', 'VILLANUEVA LOPEZ', '4531234493', 'CONOCIDO ANTUNEZ S/N', 'VILG051088R5J', 3, 1, '2015-08-06', '2015-08-06', 1),
(3, 'MIGUEL ANGEL', 'RODRIGUEZ AYALA', '4531089976', 'AV. 22 DE OCTUBRE NO. 13, APATZINGÃ¡N', 'ROAM300185AS2', 4, 1, '2015-08-06', '2015-08-06', 1);

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
  `estado_pv` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_punto_venta`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `empresa_punto_venta`
--

INSERT INTO `empresa_punto_venta` (`id_punto_venta`, `nombre_punto_venta`, `rfc_punto_venta`, `pais_punto_venta`, `estado_punto_venta`, `ciudad_punto_venta`, `telefono_punto_venta`, `cp_punto_venta`, `email_punto_venta`, `direccion_punto_venta`, `id_usuario_que_registro`, `fecha_registro_pv`, `fecha_modificacion_pv`, `estado_pv`) VALUES
(1, 'PUNTO DE VENTA CALDERON', 'CAPV921124RD4', '0', '13', 'URUAPAN', '4251074467', '60610', 'pv@gmail.com', 'ISSAC ARRIAGA NO 97', 1, '2015-08-06', '2015-08-06', 1),
(2, 'ABARROTES AMERICA', 'AMAB121288T3E', '0', '13', 'NUEVA ITALIA', '4255452213', '61760', 'abarrotes@gmail.com', 'NIÃ±OS HEROES NO 123', 1, '2015-08-06', '2015-08-06', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrada_distribuidor`
--

CREATE TABLE IF NOT EXISTS `entrada_distribuidor` (
  `id_entrada` int(11) NOT NULL AUTO_INCREMENT,
  `id_envio_fk` int(11) NOT NULL,
  `fecha_entrada` date NOT NULL,
  `hora_entrada` time NOT NULL,
  `id_usuario_distribuidor_fk` int(11) NOT NULL,
  PRIMARY KEY (`id_entrada`),
  KEY `id_usuario_distribuidor_fk` (`id_usuario_distribuidor_fk`),
  KEY `id_envio_fk` (`id_envio_fk`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `entrada_distribuidor`
--

INSERT INTO `entrada_distribuidor` (`id_entrada`, `id_envio_fk`, `fecha_entrada`, `hora_entrada`, `id_usuario_distribuidor_fk`) VALUES
(1, 2, '2015-08-06', '21:05:34', 2),
(2, 3, '2015-08-07', '22:00:58', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrada_punto_venta`
--

CREATE TABLE IF NOT EXISTS `entrada_punto_venta` (
  `id_entrada_punto_venta` int(11) NOT NULL AUTO_INCREMENT,
  `id_envio_fk` int(11) NOT NULL,
  `fecha_entrada_punto_venta` date NOT NULL,
  `hora_entrada_punto_venta` time NOT NULL,
  `id_usuario_punto_venta_fk` int(11) NOT NULL,
  PRIMARY KEY (`id_entrada_punto_venta`),
  KEY `id_envio_fk` (`id_envio_fk`),
  KEY `id_usuario_punto_venta_fk` (`id_usuario_punto_venta_fk`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `entrada_punto_venta`
--

INSERT INTO `entrada_punto_venta` (`id_entrada_punto_venta`, `id_envio_fk`, `fecha_entrada_punto_venta`, `hora_entrada_punto_venta`, `id_usuario_punto_venta_fk`) VALUES
(1, 1, '2015-08-06', '21:35:13', 1),
(2, 2, '2015-08-07', '22:10:36', 1);

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
  `id_usuario_distribuidor_fk` int(11) NOT NULL,
  `descripcion_envio` text COLLATE utf8_spanish_ci,
  `descripcion_cancelacion` text COLLATE utf8_spanish_ci,
  `descripcion_rechazo` text COLLATE utf8_spanish_ci,
  `estado_envio` int(11) NOT NULL,
  `id_punto_venta_fk` int(11) NOT NULL,
  `id_orden_dist_fk` int(11) NOT NULL,
  PRIMARY KEY (`id_envio`),
  KEY `id_orden_dist_fk` (`id_orden_dist_fk`),
  KEY `id_punto_venta_fk` (`id_punto_venta_fk`),
  KEY `id_usuario_distribuidor_fk` (`id_usuario_distribuidor_fk`),
  KEY `id_camion_fk` (`id_camion_fk`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `envios_distribuidor`
--

INSERT INTO `envios_distribuidor` (`id_envio`, `fecha_envio`, `hora_envio`, `fecha_entrega_envio`, `id_camion_fk`, `id_usuario_distribuidor_fk`, `descripcion_envio`, `descripcion_cancelacion`, `descripcion_rechazo`, `estado_envio`, `id_punto_venta_fk`, `id_orden_dist_fk`) VALUES
(1, '2015-08-06', '21:32:53', '0000-00-00', 3, 2, 'descripcion', NULL, NULL, 4, 1, 1),
(2, '2015-08-07', '22:07:55', '0000-00-00', 1, 1, 'descripcion', NULL, NULL, 4, 1, 2);

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
  `id_receptor_fk` int(11) NOT NULL,
  `descripcion_envio` text CHARACTER SET utf8,
  `descripcion_cancelacion` text CHARACTER SET utf8,
  `descripcion_rechazo` text CHARACTER SET utf8,
  `estado_envio` int(11) NOT NULL,
  `id_distribuidor_fk` int(11) NOT NULL,
  `id_orden_fk` int(11) NOT NULL,
  PRIMARY KEY (`id_envio`),
  KEY `id_distribuidor_fk_idx` (`id_distribuidor_fk`),
  KEY `id_orden_fk_idx` (`id_orden_fk`),
  KEY `id_camion_fk` (`id_camion_fk`),
  KEY `id_receptor_fk` (`id_receptor_fk`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `envios_empaque`
--

INSERT INTO `envios_empaque` (`id_envio`, `fecha_envio`, `hora_envio`, `fecha_entrega_envio`, `id_camion_fk`, `id_receptor_fk`, `descripcion_envio`, `descripcion_cancelacion`, `descripcion_rechazo`, `estado_envio`, `id_distribuidor_fk`, `id_orden_fk`) VALUES
(2, '2015-08-06', '20:56:40', '0000-00-00', 2, 1, 'descripcion', NULL, NULL, 4, 2, 1),
(3, '2015-08-07', '21:54:54', '0000-00-00', 1, 1, 'descripcion', NULL, NULL, 4, 1, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `epc_caja`
--

CREATE TABLE IF NOT EXISTS `epc_caja` (
  `epc_caja` varchar(24) COLLATE utf8_spanish_ci NOT NULL,
  `id_lote_fk` int(11) NOT NULL,
  PRIMARY KEY (`epc_caja`),
  KEY `id_lote_fk` (`id_lote_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `epc_caja`
--

INSERT INTO `epc_caja` (`epc_caja`, `id_lote_fk`) VALUES
('000000001000009000000001', 1),
('000000001000009000000002', 1),
('000000001000009000000003', 1),
('000000001000009000000004', 1),
('000000001000009000000005', 1),
('000000001000016000000001', 2),
('000000001000016000000002', 2),
('000000001000016000000003', 2),
('000000001000016000000004', 2),
('000000001000016000000005', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `epc_tarima`
--

CREATE TABLE IF NOT EXISTS `epc_tarima` (
  `epc_tarima` char(24) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`epc_tarima`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `epc_tarima`
--

INSERT INTO `epc_tarima` (`epc_tarima`) VALUES
('010000001000000000000001');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lotes`
--

CREATE TABLE IF NOT EXISTS `lotes` (
  `id_lote` int(11) NOT NULL AUTO_INCREMENT,
  `id_productos_productores_fk` int(11) NOT NULL,
  `cant_cajas_lote` int(45) NOT NULL,
  `cant_kilos_lote` decimal(45,0) NOT NULL,
  `remitente_lote` varchar(200) CHARACTER SET utf8 NOT NULL,
  `fecha_recibo_lote` date NOT NULL,
  `hora_recibo_lote` time NOT NULL,
  `costo_lote` int(11) NOT NULL,
  `fecha_recoleccion` date NOT NULL,
  `hora_recoleccion` varchar(10) CHARACTER SET utf8 NOT NULL,
  `numero_peones` int(11) NOT NULL,
  `fecha_caducidad` date NOT NULL,
  `rendimiento_kg` int(11) NOT NULL,
  `rendimiento_cajas` int(11) NOT NULL,
  `id_receptor_fk` int(11) NOT NULL,
  `id_empaque_fk` int(11) NOT NULL,
  PRIMARY KEY (`id_lote`),
  KEY `id_productor_fk_idx` (`id_productos_productores_fk`),
  KEY `id_receptor_fk` (`id_receptor_fk`),
  KEY `id_empaque_fk` (`id_empaque_fk`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `lotes`
--

INSERT INTO `lotes` (`id_lote`, `id_productos_productores_fk`, `cant_cajas_lote`, `cant_kilos_lote`, `remitente_lote`, `fecha_recibo_lote`, `hora_recibo_lote`, `costo_lote`, `fecha_recoleccion`, `hora_recoleccion`, `numero_peones`, `fecha_caducidad`, `rendimiento_kg`, `rendimiento_cajas`, `id_receptor_fk`, `id_empaque_fk`) VALUES
(1, 1, 300, '6200', 'SERGIO PARDO SANCHEZ', '2015-08-06', '20:48:38', 18600, '2015-08-06', '12:00', 10, '2015-08-27', 5800, 200, 1, 1),
(2, 9, 50, '1000', 'JOSE LUIS LOPEZ', '2015-08-07', '21:35:39', 3000, '2015-08-07', '16:35', 2, '2015-08-28', 40, 4, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ordenes_distribuidor`
--

CREATE TABLE IF NOT EXISTS `ordenes_distribuidor` (
  `id_orden` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_orden` date NOT NULL,
  `fecha_entrega_orden` date NOT NULL,
  `costo_orden` decimal(10,2) NOT NULL,
  `descripcion_orden` text CHARACTER SET utf8,
  `descripcion_cancelacion` text CHARACTER SET utf8,
  `descripcion_rechazo` text CHARACTER SET utf8,
  `id_usuario_distribuidor_fk` int(11) NOT NULL,
  `id_empaque_fk` int(11) NOT NULL,
  `estado_orden` int(11) NOT NULL,
  PRIMARY KEY (`id_orden`),
  KEY `id_usuario_distribuidor_fk_idx` (`id_usuario_distribuidor_fk`),
  KEY `id_empaque_fk_idx` (`id_empaque_fk`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `ordenes_distribuidor`
--

INSERT INTO `ordenes_distribuidor` (`id_orden`, `fecha_orden`, `fecha_entrega_orden`, `costo_orden`, `descripcion_orden`, `descripcion_cancelacion`, `descripcion_rechazo`, `id_usuario_distribuidor_fk`, `id_empaque_fk`, `estado_orden`) VALUES
(1, '2015-08-06', '2015-08-14', '51984.00', '', NULL, NULL, 2, 1, 4),
(2, '2015-08-06', '2015-08-20', '37490.00', 'Por favor enviarlos bien empacados', NULL, NULL, 1, 1, 6),
(3, '2015-08-07', '2015-08-21', '800.00', 'Por favor cumplir con los estÃ¡ndares establecidos.', NULL, NULL, 1, 1, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ordenes_distribuidor_detalles`
--

CREATE TABLE IF NOT EXISTS `ordenes_distribuidor_detalles` (
  `id_orden_detalles` int(11) NOT NULL AUTO_INCREMENT,
  `cantidad_producto_od` int(11) NOT NULL,
  `unidad_producto_od` varchar(45) CHARACTER SET utf8 NOT NULL,
  `costo_unitario_od` decimal(10,2) NOT NULL,
  `costo_producto_od` decimal(10,2) NOT NULL,
  `id_orden_fk` int(11) NOT NULL,
  `id_producto_fk` int(11) NOT NULL,
  PRIMARY KEY (`id_orden_detalles`),
  KEY `id_orden_fk_idx` (`id_orden_fk`),
  KEY `id_producto_fk_idx` (`id_producto_fk`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `ordenes_distribuidor_detalles`
--

INSERT INTO `ordenes_distribuidor_detalles` (`id_orden_detalles`, `cantidad_producto_od`, `unidad_producto_od`, `costo_unitario_od`, `costo_producto_od`, `id_orden_fk`, `id_producto_fk`) VALUES
(1, 5776, 'KILOS', '9.00', '51984.00', 1, 9),
(2, 1500, 'KILOS', '9.66', '14490.00', 2, 12),
(3, 2000, 'KILOS', '11.50', '23000.00', 2, 4),
(4, 100, 'KILOS', '8.00', '800.00', 3, 16);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ordenes_punto_venta`
--

CREATE TABLE IF NOT EXISTS `ordenes_punto_venta` (
  `id_orden` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_orden` date NOT NULL,
  `fecha_entrega_orden` date NOT NULL,
  `costo_orden` decimal(10,2) NOT NULL,
  `descripcion_orden` text CHARACTER SET utf8,
  `descripcion_cancelacion` text CHARACTER SET utf8,
  `descripcion_rechazo` text CHARACTER SET utf8,
  `id_usuario_punto_venta_fk` int(11) NOT NULL,
  `id_distribuidor_fk` int(11) NOT NULL,
  `estado_orden` int(11) NOT NULL,
  PRIMARY KEY (`id_orden`),
  KEY `id_usuario_punto_venta_idx` (`id_usuario_punto_venta_fk`),
  KEY `id_distribuidor_fk_idx` (`id_distribuidor_fk`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `ordenes_punto_venta`
--

INSERT INTO `ordenes_punto_venta` (`id_orden`, `fecha_orden`, `fecha_entrega_orden`, `costo_orden`, `descripcion_orden`, `descripcion_cancelacion`, `descripcion_rechazo`, `id_usuario_punto_venta_fk`, `id_distribuidor_fk`, `estado_orden`) VALUES
(1, '2015-08-06', '2015-08-28', '4750.00', 'DescripciÃ³n de la orden', '', NULL, 1, 2, 4),
(2, '2015-08-07', '2015-08-22', '1000.00', '', '', NULL, 1, 1, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ordenes_punto_venta_detalles`
--

CREATE TABLE IF NOT EXISTS `ordenes_punto_venta_detalles` (
  `id_orden_dist_detalles` int(11) NOT NULL AUTO_INCREMENT,
  `cant_producto_odd` int(11) NOT NULL,
  `unidad_producto_odd` varchar(45) CHARACTER SET utf8 NOT NULL,
  `costo_unitario_odd` decimal(10,2) NOT NULL,
  `costo_producto_odd` decimal(10,2) NOT NULL,
  `id_orden_dist_fk` int(11) NOT NULL,
  `id_producto_fk` int(11) NOT NULL,
  PRIMARY KEY (`id_orden_dist_detalles`),
  KEY `id_orden_dist_fk_idx` (`id_orden_dist_fk`),
  KEY `id_producto_fk_idx` (`id_producto_fk`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `ordenes_punto_venta_detalles`
--

INSERT INTO `ordenes_punto_venta_detalles` (`id_orden_dist_detalles`, `cant_producto_odd`, `unidad_producto_odd`, `costo_unitario_odd`, `costo_producto_odd`, `id_orden_dist_fk`, `id_producto_fk`) VALUES
(1, 250, 'KILOS', '19.00', '4750.00', 1, 9),
(2, 50, 'KILOS', '20.00', '1000.00', 2, 16);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE IF NOT EXISTS `productos` (
  `id_producto` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_producto` varchar(100) CHARACTER SET utf8 NOT NULL,
  `variedad_producto` varchar(100) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id_producto`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=18 ;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `nombre_producto`, `variedad_producto`) VALUES
(1, 'MANGO', 'ATAULFO'),
(2, 'MANGO', 'HADEN'),
(3, 'MANGO', 'TOMMY ATKINS'),
(4, 'LIMON', 'PERSA'),
(5, 'MANGO', 'KEITT'),
(6, 'MANGO', 'KENT'),
(7, 'MANGO', 'MANILA'),
(8, 'LIMON', 'MEYER'),
(9, 'LIMON', 'EUREKA'),
(10, 'LIMON', 'LISBON'),
(11, 'PAPAYA', 'CUBANA'),
(12, 'LIMON', 'MEXICANO'),
(13, 'MELON', 'VERDE'),
(14, 'MELON', 'CANTALUPO'),
(15, 'PLATANO', 'GUINEO'),
(16, 'PLATANO', 'DOMINICO'),
(17, 'PLATANO', 'MACHO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_distribuidores`
--

CREATE TABLE IF NOT EXISTS `productos_distribuidores` (
  `id_productos_distribuidor` int(11) NOT NULL AUTO_INCREMENT,
  `id_distribuidor_fk` int(11) NOT NULL,
  `id_producto_fk` int(11) NOT NULL,
  `precio_venta` decimal(10,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id_productos_distribuidor`),
  KEY `id_distribuidor_fk` (`id_distribuidor_fk`),
  KEY `id_producto_fk` (`id_producto_fk`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `productos_distribuidores`
--

INSERT INTO `productos_distribuidores` (`id_productos_distribuidor`, `id_distribuidor_fk`, `id_producto_fk`, `precio_venta`) VALUES
(1, 1, 4, '13.50'),
(2, 1, 12, '14.00'),
(3, 1, 17, '18.00'),
(4, 1, 16, '20.00'),
(5, 1, 1, '15.00'),
(6, 1, 2, '16.00'),
(7, 2, 11, '19.00'),
(8, 2, 13, '23.00'),
(9, 2, 14, '23.00'),
(10, 2, 9, '15.00');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=16 ;

--
-- Volcado de datos para la tabla `productos_empaques`
--

INSERT INTO `productos_empaques` (`id_productos_empaque`, `id_empaque_fk`, `id_producto_fk`, `precio_venta`, `precio_compra`) VALUES
(1, 1, 9, '9.00', '3.00'),
(2, 1, 10, '7.50', '2.50'),
(3, 1, 12, '9.66', '3.22'),
(4, 1, 8, '6.90', '2.30'),
(5, 1, 4, '11.50', '3.50'),
(6, 1, 1, '12.00', '4.00'),
(7, 1, 2, '12.00', '4.00'),
(8, 1, 5, '12.90', '4.30'),
(9, 1, 6, '12.00', '4.00'),
(10, 1, 7, '12.00', '4.00'),
(11, 1, 3, '12.00', '4.00'),
(12, 1, 14, '14.00', '7.00'),
(13, 1, 13, '16.50', '8.30'),
(14, 1, 11, '13.00', '6.00'),
(15, 1, 16, '8.00', '4.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_productores`
--

CREATE TABLE IF NOT EXISTS `productos_productores` (
  `id_productos_productores` int(11) NOT NULL AUTO_INCREMENT,
  `id_productor_fk` int(11) NOT NULL,
  `id_producto_fk` int(11) NOT NULL,
  `ubicacion_huerta` text CHARACTER SET utf8 NOT NULL,
  `hectareas` text CHARACTER SET utf8 NOT NULL,
  `descripcion_detalles_pp` text CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id_productos_productores`),
  KEY `id_productor_fk_idx` (`id_productor_fk`),
  KEY `id_producto_fk_idx` (`id_producto_fk`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=12 ;

--
-- Volcado de datos para la tabla `productos_productores`
--

INSERT INTO `productos_productores` (`id_productos_productores`, `id_productor_fk`, `id_producto_fk`, `ubicacion_huerta`, `hectareas`, `descripcion_detalles_pp`) VALUES
(1, 1, 9, 'CEÃ‘IDOR', '3', 'descripcion'),
(2, 1, 10, 'CEÃ‘IDOR', '2', 'descripcion'),
(3, 1, 12, 'NUEVA ITALIA', '8', 'descripcion'),
(4, 1, 8, 'NUEVA ITALIA', '2', 'descripcion'),
(5, 1, 4, 'CEÃ‘IDOR', '10', 'descripcion'),
(6, 2, 1, 'ANTUNEZ', '5', 'descripcion'),
(7, 2, 2, 'ANTUNEZ', '5', 'descripcion'),
(8, 2, 6, 'ANTUNEZ', '5', 'descripcion'),
(9, 3, 16, 'APATZINGAN', '10', 'descripcion'),
(10, 3, 15, 'APATZINGAN', '10', 'descripcion'),
(11, 3, 17, 'APATZINGAN', '10', 'descripcion');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `punto_venta_cajas_envio`
--

CREATE TABLE IF NOT EXISTS `punto_venta_cajas_envio` (
  `id_punto_venta_cajas_envio` int(11) NOT NULL AUTO_INCREMENT,
  `id_envio_fk` int(11) NOT NULL,
  `epc_caja` varchar(24) COLLATE utf8_spanish_ci NOT NULL,
  `id_camion_distribuidor_fk` int(11) NOT NULL,
  `enviado_dce` tinyint(1) NOT NULL,
  `recibido_dce` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_punto_venta_cajas_envio`),
  KEY `punto_venta_cajas_envio_ibfk_1` (`id_envio_fk`),
  KEY `id_camion_distribuidor_fk` (`id_camion_distribuidor_fk`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `punto_venta_cajas_envio`
--

INSERT INTO `punto_venta_cajas_envio` (`id_punto_venta_cajas_envio`, `id_envio_fk`, `epc_caja`, `id_camion_distribuidor_fk`, `enviado_dce`, `recibido_dce`) VALUES
(1, 1, '000000001000009000000001', 3, 1, 1),
(2, 1, '000000001000009000000003', 3, 1, 1),
(3, 1, '000000001000009000000004', 3, 1, 1),
(4, 1, '000000001000009000000002', 3, 1, 1),
(5, 1, '000000001000009000000005', 3, 1, 1),
(6, 2, '000000001000016000000001', 1, 1, 1),
(7, 2, '000000001000016000000003', 1, 1, 1),
(8, 2, '000000001000016000000002', 1, 1, 1),
(9, 2, '000000001000016000000004', 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_usuario` varchar(100) CHARACTER SET utf8 NOT NULL,
  `contrasena_usuario` varchar(45) CHARACTER SET utf8 NOT NULL,
  `tipo_socio_usuario` int(11) NOT NULL,
  `nivel_autorizacion_usuario` int(11) NOT NULL,
  `fecha_creacion_usuario` date NOT NULL,
  `fecha_modificacion_usuario` date NOT NULL,
  `estado_usuario` int(11) NOT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `nombre_usuario` (`nombre_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=9 ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre_usuario`, `contrasena_usuario`, `tipo_socio_usuario`, `nivel_autorizacion_usuario`, `fecha_creacion_usuario`, `fecha_modificacion_usuario`, `estado_usuario`) VALUES
(1, 'ADMINEMPAQUE', '05a7b54baab0eedc17c3217a3fcafbed', 2, 1, '2015-07-09', '2015-07-01', 1),
(2, 'PROD', 'd6e4a9b6646c62fc48baa6dd6150d1f7', 1, 1, '2015-08-06', '2015-08-06', 1),
(3, 'PROD2', '2e1d9317b801e76029454d3bd0d1f0e9', 1, 1, '2015-08-06', '2015-08-06', 1),
(4, 'PROD3', 'd39ea2961aa8bbcc478a8ad6271cc3df', 1, 1, '2015-08-06', '2015-08-06', 1),
(5, 'DIST', '2a6d07eef8b10b84129b42424ed99327', 3, 1, '2015-08-06', '2015-08-06', 1),
(6, 'DIST2', 'c766d78be1976b99bb2a40d1e5ce7367', 3, 1, '2015-08-06', '2015-08-06', 1),
(7, 'PV', '99bea2cd698b56b1a3b8c1701bd51c67', 4, 1, '2015-08-06', '2015-08-06', 1),
(8, 'PV2', 'c50056b80f6e06f1d535275d939688ca', 4, 1, '2015-08-06', '2015-08-06', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_distribuidor`
--

CREATE TABLE IF NOT EXISTS `usuario_distribuidor` (
  `id_usuario_distribuidor` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_usuario_distribuidor` varchar(100) CHARACTER SET utf8 NOT NULL,
  `apellido_usuario_distribuidor` varchar(100) CHARACTER SET utf8 NOT NULL,
  `direccion_usuario_distribuidor` text CHARACTER SET utf8 NOT NULL,
  `telefono_usuario_distribuidor` varchar(20) CHARACTER SET utf8 NOT NULL,
  `entradas` int(11) NOT NULL DEFAULT '0',
  `pedidos` int(11) NOT NULL DEFAULT '0',
  `envios` int(11) NOT NULL DEFAULT '0',
  `id_usuario_fk` int(11) NOT NULL,
  `id_distribuidor_fk` int(11) NOT NULL,
  PRIMARY KEY (`id_usuario_distribuidor`),
  KEY `id_usuario_fk_idx` (`id_usuario_fk`),
  KEY `id_distribuidor_fk_idx` (`id_distribuidor_fk`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `usuario_distribuidor`
--

INSERT INTO `usuario_distribuidor` (`id_usuario_distribuidor`, `nombre_usuario_distribuidor`, `apellido_usuario_distribuidor`, `direccion_usuario_distribuidor`, `telefono_usuario_distribuidor`, `entradas`, `pedidos`, `envios`, `id_usuario_fk`, `id_distribuidor_fk`) VALUES
(1, 'ADMIN', 'ADMIN', 'ADMIN', '0000000000', 1, 1, 1, 5, 1),
(2, 'ADMIN', 'ADMIN', 'ADMIN', '0000000000', 1, 1, 1, 6, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_empaque`
--

CREATE TABLE IF NOT EXISTS `usuario_empaque` (
  `id_receptor` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_receptor` varchar(100) CHARACTER SET utf8 NOT NULL,
  `apellido_receptor` varchar(100) CHARACTER SET utf8 NOT NULL,
  `direccion_receptor` varchar(100) CHARACTER SET utf8 NOT NULL,
  `telefono_receptor` varchar(20) CHARACTER SET utf8 NOT NULL,
  `pedidos` int(11) NOT NULL DEFAULT '0',
  `lotes` int(11) NOT NULL DEFAULT '0',
  `envios` int(11) NOT NULL DEFAULT '0',
  `superusuario` int(11) NOT NULL DEFAULT '0',
  `id_usuario_fk` int(11) NOT NULL,
  `id_empaque_fk` int(11) NOT NULL,
  PRIMARY KEY (`id_receptor`),
  KEY `id_usuario_fk_idx` (`id_usuario_fk`),
  KEY `id_empaque_fk_idx` (`id_empaque_fk`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `usuario_empaque`
--

INSERT INTO `usuario_empaque` (`id_receptor`, `nombre_receptor`, `apellido_receptor`, `direccion_receptor`, `telefono_receptor`, `pedidos`, `lotes`, `envios`, `superusuario`, `id_usuario_fk`, `id_empaque_fk`) VALUES
(1, 'ALFONSO', 'CALDERÃ“N CHÃVEZ', 'APATZINGÃN, COL. 22 DE OCTUBRE, CALLE VENUZTIANO CARRANZA', '4531064590', 1, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_punto_venta`
--

CREATE TABLE IF NOT EXISTS `usuario_punto_venta` (
  `id_usuario_pv` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_usuario_pv` varchar(45) CHARACTER SET utf8 NOT NULL,
  `apellidos_usuario_pv` varchar(45) CHARACTER SET utf8 NOT NULL,
  `telefono_usuario_pv` varchar(45) CHARACTER SET utf8 NOT NULL,
  `direccion_usuario_pv` varchar(45) CHARACTER SET utf8 NOT NULL,
  `id_usuario_fk` int(11) NOT NULL,
  `id_punto_venta_fk` int(11) NOT NULL,
  PRIMARY KEY (`id_usuario_pv`),
  KEY `id_usuario_fk_idx` (`id_usuario_fk`),
  KEY `id_usuario_punto_venta_idx` (`id_punto_venta_fk`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `usuario_punto_venta`
--

INSERT INTO `usuario_punto_venta` (`id_usuario_pv`, `nombre_usuario_pv`, `apellidos_usuario_pv`, `telefono_usuario_pv`, `direccion_usuario_pv`, `id_usuario_fk`, `id_punto_venta_fk`) VALUES
(1, 'ADMIN', 'ADMIN', '0000000000', 'ADMIN', 7, 1),
(2, 'ADMIN', 'ADMIN', '0000000000', 'ADMIN', 8, 2);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `camiones_distribuidor`
--
ALTER TABLE `camiones_distribuidor`
  ADD CONSTRAINT `camiones_distribuidor_ibfk_1` FOREIGN KEY (`id_distribuidor_fk`) REFERENCES `empresa_distribuidores` (`id_distribuidor`);

--
-- Filtros para la tabla `camiones_empaque`
--
ALTER TABLE `camiones_empaque`
  ADD CONSTRAINT `camiones_empaque_ibfk_1` FOREIGN KEY (`id_empaque_fk`) REFERENCES `empresa_empaques` (`id_empaque`);

--
-- Filtros para la tabla `distribuidor_cajas_envio`
--
ALTER TABLE `distribuidor_cajas_envio`
  ADD CONSTRAINT `distribuidor_cajas_envio_ibfk_1` FOREIGN KEY (`id_envio_fk`) REFERENCES `envios_empaque` (`id_envio`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `empresa_productores`
--
ALTER TABLE `empresa_productores`
  ADD CONSTRAINT `empresa_productores_ibfk_1` FOREIGN KEY (`id_usuario_fk`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `entrada_distribuidor`
--
ALTER TABLE `entrada_distribuidor`
  ADD CONSTRAINT `entrada_distribuidor_ibfk_1` FOREIGN KEY (`id_envio_fk`) REFERENCES `envios_empaque` (`id_envio`),
  ADD CONSTRAINT `entrada_distribuidor_ibfk_2` FOREIGN KEY (`id_usuario_distribuidor_fk`) REFERENCES `usuario_distribuidor` (`id_usuario_distribuidor`);

--
-- Filtros para la tabla `entrada_punto_venta`
--
ALTER TABLE `entrada_punto_venta`
  ADD CONSTRAINT `entrada_punto_venta_ibfk_1` FOREIGN KEY (`id_envio_fk`) REFERENCES `envios_distribuidor` (`id_envio`),
  ADD CONSTRAINT `entrada_punto_venta_ibfk_2` FOREIGN KEY (`id_usuario_punto_venta_fk`) REFERENCES `usuario_punto_venta` (`id_usuario_pv`);

--
-- Filtros para la tabla `envios_distribuidor`
--
ALTER TABLE `envios_distribuidor`
  ADD CONSTRAINT `envios_distribuidor_ibfk_1` FOREIGN KEY (`id_camion_fk`) REFERENCES `camiones_distribuidor` (`id_camion_distribuidor`),
  ADD CONSTRAINT `envios_distribuidor_ibfk_2` FOREIGN KEY (`id_usuario_distribuidor_fk`) REFERENCES `usuario_distribuidor` (`id_usuario_distribuidor`),
  ADD CONSTRAINT `envios_distribuidor_ibfk_3` FOREIGN KEY (`id_punto_venta_fk`) REFERENCES `empresa_punto_venta` (`id_punto_venta`),
  ADD CONSTRAINT `envios_distribuidor_ibfk_4` FOREIGN KEY (`id_orden_dist_fk`) REFERENCES `ordenes_punto_venta` (`id_orden`);

--
-- Filtros para la tabla `envios_empaque`
--
ALTER TABLE `envios_empaque`
  ADD CONSTRAINT `envios_empaque_ibfk_1` FOREIGN KEY (`id_distribuidor_fk`) REFERENCES `empresa_distribuidores` (`id_distribuidor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `envios_empaque_ibfk_2` FOREIGN KEY (`id_orden_fk`) REFERENCES `ordenes_distribuidor` (`id_orden`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `envios_empaque_ibfk_3` FOREIGN KEY (`id_receptor_fk`) REFERENCES `usuario_empaque` (`id_receptor`),
  ADD CONSTRAINT `envios_empaque_ibfk_4` FOREIGN KEY (`id_camion_fk`) REFERENCES `camiones_empaque` (`id_camion`);

--
-- Filtros para la tabla `epc_caja`
--
ALTER TABLE `epc_caja`
  ADD CONSTRAINT `epc_caja_ibfk_1` FOREIGN KEY (`id_lote_fk`) REFERENCES `lotes` (`id_lote`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `lotes`
--
ALTER TABLE `lotes`
  ADD CONSTRAINT `lotes_ibfk_1` FOREIGN KEY (`id_productos_productores_fk`) REFERENCES `productos_productores` (`id_productos_productores`),
  ADD CONSTRAINT `lotes_ibfk_2` FOREIGN KEY (`id_empaque_fk`) REFERENCES `empresa_empaques` (`id_empaque`),
  ADD CONSTRAINT `lotes_ibfk_3` FOREIGN KEY (`id_receptor_fk`) REFERENCES `usuario_empaque` (`id_receptor`);

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
-- Filtros para la tabla `productos_distribuidores`
--
ALTER TABLE `productos_distribuidores`
  ADD CONSTRAINT `productos_distribuidores_ibfk_1` FOREIGN KEY (`id_distribuidor_fk`) REFERENCES `empresa_distribuidores` (`id_distribuidor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `productos_distribuidores_ibfk_2` FOREIGN KEY (`id_producto_fk`) REFERENCES `productos` (`id_producto`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `punto_venta_cajas_envio_ibfk_1` FOREIGN KEY (`id_envio_fk`) REFERENCES `envios_distribuidor` (`id_envio`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `punto_venta_cajas_envio_ibfk_2` FOREIGN KEY (`id_camion_distribuidor_fk`) REFERENCES `camiones_distribuidor` (`id_camion_distribuidor`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `usuario_punto_venta_ibfk_1` FOREIGN KEY (`id_usuario_fk`) REFERENCES `usuarios` (`id_usuario`),
  ADD CONSTRAINT `usuario_punto_venta_ibfk_2` FOREIGN KEY (`id_punto_venta_fk`) REFERENCES `empresa_punto_venta` (`id_punto_venta`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
