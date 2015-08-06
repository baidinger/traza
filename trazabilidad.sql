-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 06-08-2015 a las 19:28:00
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `camiones_distribuidor`
--

INSERT INTO `camiones_distribuidor` (`id_camion_distribuidor`, `placas_camion_distribuidor`, `nombre_chofer_camion_distribuidor`, `descripcion_camion_distribuidor`, `marca_camion_distribuidor`, `modelo_camion_distribuidor`, `id_distribuidor_fk`, `disponibilidad_camion_distribuidor`, `estado_camion_distribuidor`) VALUES
(1, 'XBHJ-56', 'ANACLETO', '', 'TOYOTA', '2015', 14, 0, 1),
(2, 'YTG6874', 'PANFILO GOMEZ', '', 'NISSAN', '2012', 14, 0, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `camiones_empaque`
--

INSERT INTO `camiones_empaque` (`id_camion`, `placas`, `nombre_chofer`, `descripcion_camion`, `marca`, `modelo`, `id_empaque_fk`, `disponibilidad_ce`, `estado_ce`) VALUES
(1, 'ACB-BCA', 'JOSE VASCONCELOS', 'ES UN CAMION NUEVO DE LA MARCA NISSAN', 'NISSAN', '2015', 14, 0, 1),
(2, 'JKL-3423', 'PANFILO JIMENEZ ALVARADO', 'kjhkjhjk', 'TOYOTA', '2014', 14, 0, 1),
(3, '3455HJ', 'CHOYO', 'nada', 'AUDI', '2010', 14, 0, 1),
(4, 'CHJDFG6', 'JAVIER', 'CARRO VIEJO', 'CHEVROLET', '2010', 14, 0, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=203 ;

--
-- Volcado de datos para la tabla `distribuidor_cajas_envio`
--

INSERT INTO `distribuidor_cajas_envio` (`id_distribuidor_cajas_envio`, `id_envio_fk`, `epc_caja`, `epc_tarima`, `enviado_dce`, `recibido_dce`) VALUES
(67, 5, '000000000000000000006217', '010000000000000000006203', 1, 0),
(68, 5, '000000000000000000006216', '010000000000000000006203', 1, 0),
(69, 5, '000000000000000000006214', '010000000000000000006203', 1, 0),
(70, 5, '000000000000000000006210', '010000000000000000006203', 1, 0),
(71, 5, '000000000000000000006211', '010000000000000000006203', 1, 0),
(72, 5, '000000000000000000006220', '010000000000000000006203', 1, 0),
(73, 5, '000000000000000000006208', '010000000000000000006203', 1, 0),
(74, 5, '000000000000000000006212', '010000000000000000006203', 1, 0),
(75, 5, '000000000000000000005842', '010000000000000000006203', 1, 0),
(76, 5, '000000000000000000006204', '010000000000000000006203', 1, 0),
(77, 5, '000000000000000000006289', '010000000000000000006203', 1, 0),
(78, 5, '000000000000000000006207', '010000000000000000006203', 1, 0),
(79, 5, '000000000000000000006209', '010000000000000000006203', 1, 0),
(80, 5, '000000000000000000006202', '010000000000000000006203', 1, 0),
(81, 5, '000000000000000000006218', '010000000000000000006203', 1, 0),
(82, 5, '000000000000000000006219', '010000000000000000006203', 1, 0),
(83, 5, '000000000000000000006213', '010000000000000000006203', 1, 0),
(84, 5, '000000000000000000006221', '010000000000000000006203', 1, 0),
(85, 5, '000000000000000000006205', '010000000000000000006203', 1, 0),
(86, 5, '000000000000000000005837', '010000000000000000006203', 1, 0),
(87, 5, '000000000000000000005843', '010000000000000000006203', 1, 0),
(88, 6, '000000000000000000006205', '010000000000000000006203', 1, 0),
(89, 6, '000000000000000000006289', '010000000000000000006203', 1, 0),
(90, 6, '000000000000000000006216', '010000000000000000006203', 1, 0),
(91, 6, '000000000000000000006204', '010000000000000000006203', 1, 0),
(92, 6, '000000000000000000006217', '010000000000000000006203', 1, 0),
(93, 6, '000000000000000000006207', '010000000000000000006203', 1, 0),
(94, 6, '000000000000000000006219', '010000000000000000006203', 1, 0),
(95, 6, '000000000000000000006218', '010000000000000000006203', 1, 0),
(96, 6, '000000000000000000006210', '010000000000000000006203', 1, 0),
(97, 6, '000000000000000000006208', '010000000000000000006203', 1, 0),
(98, 6, '000000000000000000006211', '010000000000000000006203', 1, 0),
(99, 6, '000000000000000000006214', '010000000000000000006203', 1, 0),
(100, 6, '000000000000000000006209', '010000000000000000006203', 1, 0),
(101, 6, '000000000000000000006213', '010000000000000000006203', 1, 0),
(102, 6, '000000000000000000006220', '010000000000000000006203', 1, 0),
(103, 6, '000000000000000000006212', '010000000000000000006203', 1, 0),
(104, 6, '000000000000000000006202', '010000000000000000006203', 1, 0),
(105, 6, '000000000000000000006221', '010000000000000000006203', 1, 0),
(106, 10, '000000000000000000006210', '010000000000000000005330', 1, 0),
(107, 10, '000000000000000000006213', '010000000000000000005330', 1, 0),
(108, 10, '000000000000000000005329', '010000000000000000005330', 1, 1),
(109, 10, '000000000000000000005328', '010000000000000000005330', 1, 1),
(110, 10, '000000000000000000006211', '010000000000000000005330', 1, 0),
(111, 10, '000000000000000000006212', '010000000000000000005330', 1, 0),
(112, 10, '000000000000000000005331', '010000000000000000005330', 1, 1),
(186, 10, '000000000000000000005337', '010000000000000000005330', 0, 1),
(187, 10, '000000000000000000005327', '010000000000000000005330', 0, 1),
(188, 10, '000000000000000000005321', '010000000000000000005330', 0, 1),
(189, 10, '000000000000000000005326', '010000000000000000005330', 0, 1),
(190, 10, '000000000000000000005323', '010000000000000000005330', 0, 1),
(191, 10, '000000000000000000005322', '010000000000000000005330', 0, 1),
(192, 10, '000000000000000000005335', '010000000000000000005330', 0, 1),
(193, 10, '000000000000000000005334', '010000000000000000005330', 0, 1),
(194, 10, '000000000000000000005325', '010000000000000000005330', 0, 1),
(195, 10, '000000000000000000005333', '010000000000000000005330', 0, 1),
(196, 10, '000000000000000000005332', '010000000000000000005330', 0, 1),
(197, 10, '000000000000000000005324', '010000000000000000005330', 0, 1),
(198, 10, '000000000000000500005320', '010000000000000000005330', 0, 1),
(199, 10, '000000000000000000005336', '010000000000000000005330', 0, 1),
(200, 10, '000000000000000000005338', '010000000000000000005330', 0, 1),
(201, 10, '000000000000000000004770', '010000000000000000005330', 0, 1),
(202, 10, '000000000000000000004780', '010000000000000000005330', 0, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=16 ;

--
-- Volcado de datos para la tabla `empresa_distribuidores`
--

INSERT INTO `empresa_distribuidores` (`id_distribuidor`, `nombre_distribuidor`, `rfc_distribuidor`, `pais_distribuidor`, `estado_distribuidor`, `ciudad_distribuidor`, `cp_distribuidor`, `email_distribuidor`, `tel1_distribuidor`, `tel2_distribuidor`, `direccion_distribuidor`, `id_usuario_que_registro`, `fecha_registro_dist`, `fecha_modificacion_dist`, `estado_d`) VALUES
(13, 'DISTRIBUIDOR BALTAZAR', 'BAAC920112CBA', '0', '13', 'APATZINGÃN', '60094', 'baltazar@distribuidor.com', '4535305394', '014535723280', 'LOS ALMENDROS NO 209', 1, '2015-07-24', '2015-07-24', 1),
(14, 'SIMPUS DISTRIBUIDOR', 'SIMP456567IJU', '0', '0', 'APATZINGAN', '61770', 'contacto@boodegaaurrera.com.mx', '5451343234', '', 'CONCIDO', 89, '2015-07-26', '2015-07-26', 1),
(15, 'DISTRIBUIDOR RIVERA', 'RFCE121212DE3', '0', '13', 'URUAPAN', '60600', 'correo@distri.com', '4531234123', '014531234567', 'AV. 5 DE MAYO #15', 1, '2015-08-06', '2015-08-06', 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=16 ;

--
-- Volcado de datos para la tabla `empresa_empaques`
--

INSERT INTO `empresa_empaques` (`id_empaque`, `nombre_empaque`, `rfc_empaque`, `pais_empaque`, `estado_empaque`, `ciudad_empaque`, `direccion_empaque`, `cp_empaque`, `email_empaque`, `telefono1_empaque`, `telefono2_empaque`, `id_usuario_que_registro`, `fecha_registro_emp`, `fecha_modificacion_emp`, `estado_e`) VALUES
(1, 'SIERVO DE LA NACION', 'SIRV900305KT0', '0', '13', 'EL CEÃ‘IDOR', 'EL CEÃ‘IDOR, MUGICA. CAR. 4 CAMINOS APATZINGÃN', '61770', 'contacto@siervodelanacion.com.mx', '4255925238', '', 1, '0000-00-00', '2015-07-24', 1),
(13, 'EMPAQUE MANGUEROS', 'SVON894532JH7', '2', '1', 'MORELIA', 'ASDKL', '54223', 'siervo@siervodelanacion.com', '4531065690', '', 1, '2015-07-24', '2015-07-24', 1),
(14, 'SIMPUS MANGOS VERDES', 'SIRV900305KT0', '1', '1', 'MORELIA', 'CONOIDO', '61770', 'siervo@siervodelanacion.com', '4531065690', '', 1, '2015-07-26', '2015-07-28', 1),
(15, 'EMPAQUE PRUEBA', 'RFCS122134DER', '0', '13', 'MORELIA', 'DIRECCIÃ³N', '60600', 'empaque@emp.com', '1234567890', '1234567890', 1, '2015-08-06', '2015-08-06', 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=20 ;

--
-- Volcado de datos para la tabla `empresa_productores`
--

INSERT INTO `empresa_productores` (`id_productor`, `nombre_productor`, `apellido_productor`, `telefono_productor`, `direccion_productor`, `rfc_productor`, `id_usuario_fk`, `id_usuario_que_registro`, `fecha_registro_prod`, `fecha_modificacion_prod`, `estado_p`) VALUES
(13, 'ANASTACIO', 'JIMENEZ', '4251074467', 'CONOCIDO\r\n', 'CACF909900HT6', 70, 1, '2015-07-24', '2015-07-24', 1),
(15, 'PANCRASIO', 'JIMENEZ', '4251074467', 'CEÑIDOR, CONOCIDO', 'CACF909900HT6', 73, 1, '2015-07-24', '2015-07-24', 1),
(16, 'ANASTACIO', 'JIMENEZ LOPEZ', '4532567876', 'NUEVO URECHO', 'ANAS900088HT4', 93, 89, '2015-07-27', '2015-07-27', 1),
(17, 'BRYAN ALEJANDRO', 'OREGEL CORTEZ', '4251007655', 'CONOCIDO EL CEÑIDOR', 'BRYA981221JYU', 94, 89, '2015-07-27', '2015-07-27', 1),
(18, 'ANACLETO', 'GARCIA MEDEROS', '4531064591', 'CONOCIDO EL LETRERO', 'ANAC781123HT5', 95, 89, '2015-07-27', '2015-07-27', 1),
(19, '', '', '', '', '', 96, 89, '2015-07-29', '2015-07-29', 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Volcado de datos para la tabla `empresa_punto_venta`
--

INSERT INTO `empresa_punto_venta` (`id_punto_venta`, `nombre_punto_venta`, `rfc_punto_venta`, `pais_punto_venta`, `estado_punto_venta`, `ciudad_punto_venta`, `telefono_punto_venta`, `cp_punto_venta`, `email_punto_venta`, `direccion_punto_venta`, `id_usuario_que_registro`, `fecha_registro_pv`, `fecha_modificacion_pv`, `estado_pv`) VALUES
(8, 'ALFONSO DISTRIBUIDOR', 'PTVB098855IU7', '0', '13', 'CEÃ‘IDOR', '4531209845', '61770', 'alfonso.calderon.chavez@gmail.com', 'AV. 5 DE MAYO #15', 1, '2015-07-24', '2015-07-24', 1),
(9, 'PUNTO DE VENTA BALTAZAR', 'PUVB122189GTA', '0', '13', 'URUAPAN', '014521234567', '60600', 'pvbaltazar@gmail.com', 'AV. FRANCISCO VILLA NO 15', 1, '2015-07-24', '2015-07-24', 1),
(10, 'MARGARITO', 'MGRT093456JUY', '2', '1', 'APATZINGÁN', '4531209845', '61770', 'alfonso.calderon.chavez@gmail.com', 'CONOCIDO', 89, '2015-07-26', '2015-07-26', 1),
(11, 'PUNTO DE VENTA PRUEBA', 'ABAC5665637T5', '0', '13', 'MORELIA', '014521234567', '63239', 'simpus2@gmail.com', 'DIRECCIÃ³N', 1, '2015-08-06', '2015-08-06', 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `entrada_distribuidor`
--

INSERT INTO `entrada_distribuidor` (`id_entrada`, `id_envio_fk`, `fecha_entrada`, `hora_entrada`, `id_usuario_distribuidor_fk`) VALUES
(1, 10, '2015-07-30', '10:30:00', 21);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `entrada_punto_venta`
--

INSERT INTO `entrada_punto_venta` (`id_entrada_punto_venta`, `id_envio_fk`, `fecha_entrada_punto_venta`, `hora_entrada_punto_venta`, `id_usuario_punto_venta_fk`) VALUES
(1, 7, '2015-07-30', '23:05:12', 10);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `envios_distribuidor`
--

INSERT INTO `envios_distribuidor` (`id_envio`, `fecha_envio`, `hora_envio`, `fecha_entrega_envio`, `id_camion_fk`, `id_usuario_distribuidor_fk`, `descripcion_envio`, `descripcion_cancelacion`, `descripcion_rechazo`, `estado_envio`, `id_punto_venta_fk`, `id_orden_dist_fk`) VALUES
(7, '2015-07-26', '22:40:01', '0000-00-00', 2, 22, 'descripcion', NULL, NULL, 3, 10, 2);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=14 ;

--
-- Volcado de datos para la tabla `envios_empaque`
--

INSERT INTO `envios_empaque` (`id_envio`, `fecha_envio`, `hora_envio`, `fecha_entrega_envio`, `id_camion_fk`, `id_receptor_fk`, `descripcion_envio`, `descripcion_cancelacion`, `descripcion_rechazo`, `estado_envio`, `id_distribuidor_fk`, `id_orden_fk`) VALUES
(1, '2015-07-24', '08:08:25', '0000-00-00', 4, 1, '', NULL, NULL, 5, 13, 14),
(4, '2015-07-26', '20:38:49', '0000-00-00', 1, 11, 'descripcion', NULL, NULL, 3, 14, 16),
(5, '2015-07-26', '22:48:31', '0000-00-00', 1, 12, 'descripcion', NULL, NULL, 5, 13, 18),
(6, '2015-07-26', '23:06:34', '0000-00-00', 1, 12, 'descripcion', NULL, NULL, 3, 14, 19),
(10, '2015-07-28', '00:59:43', '0000-00-00', 1, 12, 'descripcion', NULL, NULL, 3, 13, 20),
(13, '2015-07-29', '02:03:49', '0000-00-00', 1, 12, 'descripcion', NULL, NULL, 5, 13, 21);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `epc_caja`
--

CREATE TABLE IF NOT EXISTS `epc_caja` (
  `epc_caja` varchar(24) COLLATE utf8_spanish_ci NOT NULL,
  `id_lote_fk` int(11) NOT NULL,
  PRIMARY KEY (`epc_caja`),
  KEY `id_lote_fk` (`id_lote_fk`),
  KEY `id_lote_fk_2` (`id_lote_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `epc_caja`
--

INSERT INTO `epc_caja` (`epc_caja`, `id_lote_fk`) VALUES
('000000000000000000005328', 6),
('9731', 7),
('010000001000009000000001', 8),
('010000001000009000000002', 8),
('010000001000009000000003', 8),
('010000001000009000000004', 8),
('010000001000009000000005', 8),
('010000001000009000000006', 8),
('010000001000009000000007', 8),
('010000001000009000000008', 8),
('010000001000009000000009', 8),
('010000001000009000000010', 8),
('010000001000009000000011', 8),
('010000001000009000000012', 8),
('010000001000009000000013', 8),
('010000001000009000000014', 8),
('010000001000009000000015', 8),
('010000001000009000000016', 8),
('010000001000009000000017', 8),
('010000001000009000000018', 8),
('010000001000009000000019', 8),
('010000001000009000000020', 8),
('010000001000009000000021', 8),
('010000001000009000000022', 8),
('010000001000009000000023', 8),
('010000001000009000000024', 8),
('010000001000009000000025', 8),
('010000001000009000000026', 8),
('010000001000009000000027', 8),
('010000001000009000000028', 8),
('010000001000009000000029', 8),
('010000001000009000000030', 8),
('010000001000009000000031', 8),
('010000001000009000000032', 8),
('010000001000009000000033', 8),
('010000001000009000000034', 8),
('010000001000009000000035', 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `epc_tarima`
--

CREATE TABLE IF NOT EXISTS `epc_tarima` (
  `epc_tarima` char(24) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`epc_tarima`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=9 ;

--
-- Volcado de datos para la tabla `lotes`
--

INSERT INTO `lotes` (`id_lote`, `id_productos_productores_fk`, `cant_cajas_lote`, `cant_kilos_lote`, `remitente_lote`, `fecha_recibo_lote`, `hora_recibo_lote`, `costo_lote`, `fecha_recoleccion`, `hora_recoleccion`, `numero_peones`, `fecha_caducidad`, `rendimiento_kg`, `rendimiento_cajas`, `id_receptor_fk`, `id_empaque_fk`) VALUES
(6, 10, 1200, '219', 'JOSE PEREZ', '2015-07-29', '18:29:44', 12399, '2015-07-29', '9 AM', 2, '2015-07-30', 0, 0, 11, 14),
(7, 3, 100, '1000', 'JUANA ORTIZ DE DOMINGUEZ', '2015-07-30', '00:43:18', 10000, '2015-07-29', '9 AM', 4, '2015-08-01', 0, 0, 11, 14),
(8, 11, 180, '2800', 'ANACLETO GARCIA', '2015-08-06', '00:18:48', 8500, '2015-08-05', '12:00', 5, '2015-08-20', 600, 30, 1, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=23 ;

--
-- Volcado de datos para la tabla `ordenes_distribuidor`
--

INSERT INTO `ordenes_distribuidor` (`id_orden`, `fecha_orden`, `fecha_entrega_orden`, `costo_orden`, `descripcion_orden`, `descripcion_cancelacion`, `descripcion_rechazo`, `id_usuario_distribuidor_fk`, `id_empaque_fk`, `estado_orden`) VALUES
(14, '2015-07-23', '2015-07-31', '21300.00', 'DescripciÃ³n de la orden, favor de confirmar lo mas pronto posible. Saludos', '', 'Sea serio por favor', 20, 1, 2),
(15, '2015-07-24', '2015-08-03', '32710.00', 'Necesito una carga grande de limÃ³n persa, no importan mucho los calibres, sÃ³lo necesito que el peso mÃ­nimo del limÃ³n sea de 50 gramos.', 'Ya no necesito la orden, conseguÃ­ mejores precios. Gracias.', '', 20, 13, 5),
(16, '2015-07-26', '2015-07-27', '7500.00', 'Quiero que la envien lo mas rapido posivle', '', '', 22, 14, 3),
(17, '2015-07-01', '2015-07-28', '3000.00', 'k', 'No me gusto!', '', 22, 14, 5),
(18, '2015-07-26', '2015-07-27', '20392.80', 'Descripcion de la orden', 'Motivo de cancelacion', NULL, 20, 14, 5),
(19, '2015-07-26', '2015-07-28', '8108.00', 'Descripcion de la orden 19', NULL, NULL, 22, 14, 3),
(20, '2015-07-27', '2015-07-31', '3.60', '', NULL, NULL, 20, 14, 3),
(21, '2015-07-28', '2015-07-31', '3.60', 'soy javier 1', NULL, NULL, 20, 14, 5),
(22, '2015-08-05', '2015-08-28', '1990.00', 'DescripciÃ³n de la orden de limones', NULL, NULL, 24, 15, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=29 ;

--
-- Volcado de datos para la tabla `ordenes_distribuidor_detalles`
--

INSERT INTO `ordenes_distribuidor_detalles` (`id_orden_detalles`, `cantidad_producto_od`, `unidad_producto_od`, `costo_unitario_od`, `costo_producto_od`, `id_orden_fk`, `id_producto_fk`) VALUES
(1, 1000, 'KILOS', '8.50', '8500.00', 14, 1),
(2, 1000, 'KILOS', '12.80', '12800.00', 14, 2),
(3, 2500, 'KILOS', '7.30', '18250.00', 15, 4),
(4, 200, 'KILOS', '8.50', '1700.00', 15, 1),
(5, 1000, 'KILOS', '3.60', '3600.00', 15, 1),
(6, 1000, 'KILOS', '1.60', '1600.00', 15, 7),
(7, 1000, 'KILOS', '3.60', '3600.00', 15, 1),
(8, 1000, 'KILOS', '3.60', '3600.00', 15, 1),
(9, 100, 'KILOS', '3.60', '360.00', 15, 1),
(10, 1345, 'KILOS', '3.60', '4842.00', 15, 1),
(11, 1000, 'KILOS', '3.50', '3500.00', 16, 5),
(12, 2000, 'KILOS', '2.00', '4000.00', 16, 4),
(13, 100, 'kilos', '20.00', '2000.00', 17, 3),
(14, 1, 'KILOS', '3.60', '3.60', 17, 1),
(15, 2300, 'KILOS', '3.60', '8280.00', 17, 1),
(16, 12300, 'KILOS', '1.60', '19680.00', 17, 7),
(17, 198, 'KILOS', '3.60', '712.80', 17, 1),
(18, 12300, 'KILOS', '1.60', '19680.00', 18, 7),
(19, 198, 'KILOS', '3.60', '712.80', 18, 1),
(20, 1230, 'KILOS', '3.60', '4428.00', 19, 1),
(21, 2300, 'KILOS', '1.60', '3680.00', 19, 7),
(22, 1, 'KILOS', '3.60', '3.60', 20, 1),
(23, 1, 'KILOS', '3.60', '3.60', 21, 1),
(24, 100, 'KILOS', '5.10', '510.00', 22, 9),
(25, 100, 'KILOS', '2.00', '200.00', 22, 10),
(26, 100, 'KILOS', '2.50', '250.00', 22, 12),
(27, 100, 'KILOS', '3.00', '300.00', 22, 8),
(28, 100, 'KILOS', '7.30', '730.00', 22, 4);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `ordenes_punto_venta`
--

INSERT INTO `ordenes_punto_venta` (`id_orden`, `fecha_orden`, `fecha_entrega_orden`, `costo_orden`, `descripcion_orden`, `descripcion_cancelacion`, `descripcion_rechazo`, `id_usuario_punto_venta_fk`, `id_distribuidor_fk`, `estado_orden`) VALUES
(1, '2015-07-24', '2015-07-31', '1450.00', 'Sin descripciÃ³n.', 'Siempre no la quiero. Gracias.', '', 9, 13, 10),
(2, '2015-07-26', '2015-07-27', '1200.00', '', '', '', 10, 14, 3),
(3, '2015-08-05', '2015-08-19', '9000.00', 'Orden de plÃ¡tanos xD', NULL, NULL, 9, 15, 1),
(4, '2015-08-05', '2015-08-26', '3120.00', '', NULL, NULL, 11, 15, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `ordenes_punto_venta_detalles`
--

INSERT INTO `ordenes_punto_venta_detalles` (`id_orden_dist_detalles`, `cant_producto_odd`, `unidad_producto_odd`, `costo_unitario_odd`, `costo_producto_odd`, `id_orden_dist_fk`, `id_producto_fk`) VALUES
(1, 50, 'KILOS', '15.00', '750.00', 1, 1),
(2, 50, 'KILOS', '14.00', '700.00', 1, 2),
(3, 400, 'KILOS', '3.00', '1200.00', 2, 3),
(4, 300, 'KILOS', '14.00', '4200.00', 3, 16),
(5, 400, 'KILOS', '12.00', '4800.00', 3, 15),
(6, 400, 'KILOS', '0.00', '0.00', 3, 17),
(7, 120, 'KILOS', '12.00', '1440.00', 4, 15),
(8, 120, 'KILOS', '14.00', '1680.00', 4, 16),
(9, 120, 'KILOS', '0.00', '0.00', 4, 17);

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
(1, 13, 1, '0.00'),
(2, 13, 2, '0.00'),
(3, 13, 3, '0.00'),
(4, 13, 4, '0.00'),
(5, 13, 12, '0.00'),
(6, 14, 1, '0.00'),
(7, 14, 17, '0.00'),
(8, 15, 15, '12.00'),
(9, 15, 16, '14.00'),
(10, 15, 17, '13.00');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=22 ;

--
-- Volcado de datos para la tabla `productos_empaques`
--

INSERT INTO `productos_empaques` (`id_productos_empaque`, `id_empaque_fk`, `id_producto_fk`, `precio_venta`, `precio_compra`) VALUES
(5, 1, 1, '3.60', '234.00'),
(6, 1, 2, '12.90', '4.56'),
(7, 13, 4, '7.30', '2.20'),
(8, 13, 1, '8.50', '3.30'),
(9, 13, 2, '4.25', '12.80'),
(10, 14, 1, '1.57', '0.70'),
(13, 14, 7, '1.60', '1.40'),
(14, 14, 9, '5.10', '3.40'),
(16, 14, 4, '20.00', '0.00'),
(17, 15, 9, '1.00', '0.00'),
(18, 15, 10, '2.00', '0.00'),
(19, 15, 12, '2.50', '0.00'),
(20, 15, 8, '3.00', '0.00'),
(21, 15, 4, '3.50', '0.00');

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
(1, 13, 3, 'APATZINGAN', '10', 'descripcion'),
(3, 13, 3, 'PARACUARO', '2.5', 'descripcion'),
(4, 13, 4, 'EL CEÑIDOR', '1', 'descripcion'),
(5, 15, 4, 'EL CEÑIDOR', '1', 'descripcion'),
(6, 15, 4, 'APATZINGAN', '1', 'descripcion'),
(7, 15, 2, 'ANTUNEZ', '3', 'descripcion'),
(8, 16, 3, 'URUAPAN #34', '3', 'descripcion'),
(9, 16, 2, 'SAN JUAN NUEVO', '2', 'descripcion'),
(10, 17, 12, 'ubicacion', '1', 'descripcion'),
(11, 18, 9, 'APATZINGAN', '1', 'descripcion');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `punto_venta_cajas_envio`
--

CREATE TABLE IF NOT EXISTS `punto_venta_cajas_envio` (
  `id_punto_venta_cajas_envio` int(11) NOT NULL AUTO_INCREMENT,
  `id_envio_fk` int(11) NOT NULL,
  `epc_caja` varchar(24) CHARACTER SET utf8 NOT NULL,
  `id_camion_distribuidor_fk` int(11) NOT NULL,
  `enviado_dce` tinyint(1) NOT NULL,
  `recibido_dce` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_punto_venta_cajas_envio`),
  KEY `punto_venta_cajas_envio_ibfk_1` (`id_envio_fk`),
  KEY `id_camion_distribuidor_fk` (`id_camion_distribuidor_fk`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=85 ;

--
-- Volcado de datos para la tabla `punto_venta_cajas_envio`
--

INSERT INTO `punto_venta_cajas_envio` (`id_punto_venta_cajas_envio`, `id_envio_fk`, `epc_caja`, `id_camion_distribuidor_fk`, `enviado_dce`, `recibido_dce`) VALUES
(47, 7, '000000000000000000005834', 1, 1, 1),
(48, 7, '000000000000000000005842', 1, 1, 1),
(49, 7, '000000000000000000005839', 1, 1, 1),
(50, 7, '000000000000000000005843', 1, 1, 1),
(51, 7, '000000000000000000005835', 1, 1, 1),
(52, 7, '000000000000000000005845', 1, 1, 1),
(53, 7, '000000000000000000005837', 1, 1, 1),
(54, 7, '000000000000000000005852', 1, 1, 1),
(55, 7, '000000000000000000005841', 1, 1, 1),
(56, 7, '000000000000000000005846', 1, 1, 1),
(57, 7, '000000000000000000005838', 1, 1, 1),
(58, 7, '000000000000000000005853', 1, 1, 1),
(59, 7, '000000000000000000005851', 1, 1, 1),
(60, 7, '000000000000000000005848', 1, 1, 1),
(61, 7, '000000000000000000005836', 1, 1, 1),
(62, 7, '000000000000000000005850', 1, 1, 1),
(63, 7, '000000000000000000005849', 1, 1, 1),
(64, 7, '000000000000000000005847', 1, 1, 1),
(65, 7, '000000000000000000005844', 1, 1, 1),
(66, 7, '010000000000000000012341', 1, 1, 1),
(67, 7, '010000000000000000012342', 1, 1, 1),
(68, 7, '010000000000000000012343', 1, 1, 1),
(69, 7, '010000000000000000012344', 1, 1, 1),
(70, 7, '010000000000000000012345', 1, 1, 1),
(71, 7, '010000000000000000012346', 1, 1, 1),
(72, 7, '010000000000000000012347', 1, 1, 1),
(73, 7, '010000000000000000012348', 1, 1, 1),
(74, 7, '010000000000000000012349', 1, 1, 1),
(75, 7, '010000000000000000012350', 1, 1, 1),
(76, 7, '010000000000000000012351', 1, 1, 1),
(77, 7, '010000000000000000012352', 1, 1, 1),
(78, 7, '010000000000000000012353', 1, 1, 1),
(79, 7, '010000000000000000012354', 1, 1, 1),
(80, 7, '010000000000000000012355', 1, 1, 1),
(81, 7, '010000000000000000012356', 1, 1, 1),
(82, 7, '010000000000000000012357', 1, 1, 1),
(83, 7, '010000000000000000012358', 1, 1, 1),
(84, 7, '010000000000000000012359', 1, 1, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=101 ;

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
(87, 'PV', '99bea2cd698b56b1a3b8c1701bd51c67', 4, 1, '2015-07-24', '2015-07-30', 1),
(88, 'EMPAQUE', 'cefd04f07d55b35421c3fa1ed1abb530', 2, 2, '2015-07-24', '2015-07-24', 1),
(89, 'ADMIN', '21232f297a57a5a743894a0e4a801fc3', 2, 1, '2015-07-26', '2015-07-26', 1),
(90, 'SIMPUS1', '3b18aea56183f6bf684946b906fb773b', 3, 1, '2015-07-26', '2015-07-26', 1),
(91, 'PV1', '6ed8b2adaa76b60eeade01720e10fb77', 4, 1, '2015-07-26', '2015-07-26', 1),
(92, 'HH', '5e36941b3d856737e81516acd45edc50', 2, 2, '2015-07-26', '2015-07-26', 1),
(93, 'PRODUCTOR2', '93017c1e42e1cbd44cd5aed178aec7a9', 1, 1, '2015-07-27', '2015-07-27', 1),
(94, 'PRODUCTOR3', '2641bd673e5311f3172543a6658760ca', 1, 1, '2015-07-27', '2015-07-27', 1),
(95, 'PRODUCTOR4', 'd209d2824efe8a81b3d1e0f0702a43e8', 1, 1, '2015-07-27', '2015-07-27', 1),
(96, '', 'd41d8cd98f00b204e9800998ecf8427e', 1, 1, '2015-07-29', '2015-07-29', 1),
(97, 'simpu2', '2187f0469f2cb0dd845de85bd5f0ab4f', 3, 2, '2015-08-05', '2015-08-05', 1),
(98, 'DISTRI', '9704c78cc0e70224f1891d0c6534ce7a', 3, 1, '2015-08-06', '2015-08-06', 1),
(99, 'EMP', 'ac8be4aee61f5f6e21b8c5afffb52939', 2, 1, '2015-08-06', '2015-08-06', 1),
(100, 'PV3', '67d551b078d939f1a67a504e37f33158', 4, 1, '2015-08-06', '2015-08-06', 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=25 ;

--
-- Volcado de datos para la tabla `usuario_distribuidor`
--

INSERT INTO `usuario_distribuidor` (`id_usuario_distribuidor`, `nombre_usuario_distribuidor`, `apellido_usuario_distribuidor`, `direccion_usuario_distribuidor`, `telefono_usuario_distribuidor`, `entradas`, `pedidos`, `envios`, `id_usuario_fk`, `id_distribuidor_fk`) VALUES
(20, 'CHRISTOPHER', 'BALTAZAR AMBRIZ', 'Los Almendros No. 209', '4535305394', 1, 1, 1, 78, 13),
(21, 'JORGE EDUARDO', 'LEMUS BALTAZAR', 'Issac Arriaga No 97', '4521541118', 0, 1, 0, 86, 13),
(22, 'JAZMIN', 'CERVANTES LOPEZ', 'Conocido Pinzandaro', '4535305392', 1, 1, 1, 90, 14),
(23, 'JOSUE', 'CERVANTES LOPEZ', 'Conocido Pinzandaro S/N', '4531123412', 1, 1, 1, 97, 14),
(24, 'ADMIN', 'ADMIN', 'ADMIN', '0000000000', 1, 1, 1, 98, 15);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=14 ;

--
-- Volcado de datos para la tabla `usuario_empaque`
--

INSERT INTO `usuario_empaque` (`id_receptor`, `nombre_receptor`, `apellido_receptor`, `direccion_receptor`, `telefono_receptor`, `pedidos`, `lotes`, `envios`, `superusuario`, `id_usuario_fk`, `id_empaque_fk`) VALUES
(1, 'ALFONSO', 'CALDERÃ“N CHÃVEZ', 'APATZINGÃN, COL. 22 DE OCTUBRE, CALLE VENUZTIANO CARRANZA', '4531064590', 1, 1, 1, 1, 1, 1),
(9, 'ADMIN', 'ADMIN', 'ADMIN', '0000000000', 1, 1, 1, 0, 77, 13),
(10, 'NOMBRE', 'APELLIDOS', '152412', '45124512', 1, 0, 0, 0, 88, 1),
(11, 'PETRONILA', 'DE LA CRUZ', 'AGUASCALIENTES', '4255925238', 1, 1, 1, 0, 89, 14),
(12, 'JAVIER', 'CALDERON CHAVEZ', 'CONOCIDO EL CEÑIDOR', '4531064590', 1, 1, 1, 0, 92, 14),
(13, 'ADMIN', 'ADMIN', 'ADMIN', '0000000000', 1, 1, 1, 0, 99, 15);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=12 ;

--
-- Volcado de datos para la tabla `usuario_punto_venta`
--

INSERT INTO `usuario_punto_venta` (`id_usuario_pv`, `nombre_usuario_pv`, `apellidos_usuario_pv`, `telefono_usuario_pv`, `direccion_usuario_pv`, `id_usuario_fk`, `id_punto_venta_fk`) VALUES
(8, 'ADMIN', 'ADMIN', '0000000000', 'ADMIN', 85, 8),
(9, 'DAVID', 'CAZARES AGUILAR', '4531234567', 'Cuauhtemoc No 13, Colonia Centro', 87, 9),
(10, 'ADMIN', 'ADMIN', '000000000', 'CONOCIDO', 91, 10),
(11, 'ADMIN', 'ADMIN', '0000000000', 'ADMIN', 100, 11);

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
  ADD CONSTRAINT `punto_venta_cajas_envio_ibfk_2` FOREIGN KEY (`id_camion_distribuidor_fk`) REFERENCES `camiones_distribuidor` (`id_camion_distribuidor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `punto_venta_cajas_envio_ibfk_1` FOREIGN KEY (`id_envio_fk`) REFERENCES `envios_distribuidor` (`id_envio`) ON DELETE CASCADE ON UPDATE CASCADE;

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
