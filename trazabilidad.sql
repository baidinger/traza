-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 23, 2015 at 06:04 PM
-- Server version: 5.5.40
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `trazabilidad`
--
CREATE DATABASE IF NOT EXISTS `trazabilidad` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE `trazabilidad`;

-- --------------------------------------------------------

--
-- Table structure for table `distribuidor_cajas_envio`
--

CREATE TABLE IF NOT EXISTS `distribuidor_cajas_envio` (
  `id_distribuidor_cajas_envio` int(11) NOT NULL AUTO_INCREMENT,
  `id_orden_fk` int(11) NOT NULL,
  `epc_caja` varchar(16) NOT NULL,
  `epc_tarima` varchar(16) NOT NULL,
  `numero_carro` int(11) NOT NULL,
  `enviado_dce` tinyint(1) NOT NULL,
  `recibido_dce` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_distribuidor_cajas_envio`),
  KEY `id_orden_fk_idx` (`id_orden_fk`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

-- --------------------------------------------------------

--
-- Table structure for table `empresa_distribuidores`
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

-- --------------------------------------------------------

--
-- Table structure for table `empresa_empaques`
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `empresa_empaques`
--

INSERT INTO `empresa_empaques` (`id_empaque`, `nombre_empaque`, `rfc_empaque`, `pais_empaque`, `estado_empaque`, `ciudad_empaque`, `direccion_empaque`, `cp_empaque`, `email_empaque`, `telefono1_empaque`, `telefono2_empaque`, `id_usuario_que_registro`, `fecha_registro_emp`, `fecha_modificacion_emp`, `estado`) VALUES
(1, 'SIERVO DE LA NACIÓN', 'SIRV900305KT0', '0', '13', 'EL CEÑIDOR', 'EL CEÑIDOR, MUGICA. CAR. 4 CAMINOS APATZINGÁN', '61770', 'contacto@siervodelanacion.com.mx', '4255925238', '', 1, '0000-00-00', '0000-00-00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `empresa_productores`
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

-- --------------------------------------------------------

--
-- Table structure for table `empresa_punto_venta`
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Table structure for table `entrada_distribuidor`
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
-- Table structure for table `envios_distribuidor`
--

CREATE TABLE IF NOT EXISTS `envios_distribuidor` (
  `id_envio` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_envio` date NOT NULL,
  `hora_envio` time NOT NULL,
  `fecha_entrega_envio` date NOT NULL,
  `descripcion_envio` text COLLATE utf8_spanish_ci NOT NULL,
  `estado_envio` int(11) NOT NULL,
  `id_punto_venta_fk` int(11) NOT NULL,
  `id_orden_dist_fk` int(11) NOT NULL,
  PRIMARY KEY (`id_envio`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `envios_empaque`
--

CREATE TABLE IF NOT EXISTS `envios_empaque` (
  `id_envio` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_envio` date NOT NULL,
  `hora_envio` time NOT NULL,
  `fecha_entrega_envio` date NOT NULL,
  `descripcion_envio` text NOT NULL,
  `estado_envio` int(11) NOT NULL,
  `id_distribuidor_fk` int(11) NOT NULL,
  `id_orden_fk` int(11) NOT NULL,
  PRIMARY KEY (`id_envio`),
  KEY `id_distribuidor_fk_idx` (`id_distribuidor_fk`),
  KEY `id_orden_fk_idx` (`id_orden_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `epc`
--

CREATE TABLE IF NOT EXISTS `epc` (
  `epc` varchar(24) COLLATE utf8_spanish_ci NOT NULL,
  `id_lote_fk` int(11) NOT NULL,
  PRIMARY KEY (`epc`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lotes`
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
-- Table structure for table `ordenes_distribuidor`
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

-- --------------------------------------------------------

--
-- Table structure for table `ordenes_distribuidor_detalles`
--

CREATE TABLE IF NOT EXISTS `ordenes_distribuidor_detalles` (
  `id_orden_detalles` int(11) NOT NULL AUTO_INCREMENT,
  `cantidad_producto_od` int(11) NOT NULL,
  `unidad_producto_od` varchar(45) NOT NULL,
  `costo_producto_od` decimal(10,2) NOT NULL,
  `id_orden_fk` int(11) NOT NULL,
  `id_producto_fk` int(11) NOT NULL,
  PRIMARY KEY (`id_orden_detalles`),
  KEY `id_orden_fk_idx` (`id_orden_fk`),
  KEY `id_producto_fk_idx` (`id_producto_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ordenes_punto_venta`
--

CREATE TABLE IF NOT EXISTS `ordenes_punto_venta` (
  `id_orden` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_orden` date NOT NULL,
  `fecha_entrega_orden` date NOT NULL,
  `costo_orden` decimal(10,2) NOT NULL,
  `descripcion_orden` text NOT NULL,
  `id_usuario_punto_venta_fk` int(11) NOT NULL,
  `id_distribuidor_fk` int(11) NOT NULL,
  `estado_orden` int(11) NOT NULL,
  PRIMARY KEY (`id_orden`),
  KEY `id_usuario_punto_venta_idx` (`id_usuario_punto_venta_fk`),
  KEY `id_distribuidor_fk_idx` (`id_distribuidor_fk`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `ordenes_punto_venta_detalles`
--

CREATE TABLE IF NOT EXISTS `ordenes_punto_venta_detalles` (
  `id_orden_dist_detalles` int(11) NOT NULL AUTO_INCREMENT,
  `id_orden_dist_fk` int(11) NOT NULL,
  `id_producto_fk` int(11) NOT NULL,
  `cant_producto_odd` int(11) NOT NULL,
  `unidad_producto_odd` varchar(45) NOT NULL,
  `costo_producto_odd` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id_orden_dist_detalles`),
  KEY `id_orden_dist_fk_idx` (`id_orden_dist_fk`),
  KEY `id_producto_fk_idx` (`id_producto_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `productos`
--

CREATE TABLE IF NOT EXISTS `productos` (
  `id_producto` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_producto` varchar(100) NOT NULL,
  `variedad_producto` varchar(100) NOT NULL,
  PRIMARY KEY (`id_producto`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `productos`
--

INSERT INTO `productos` (`id_producto`, `nombre_producto`, `variedad_producto`) VALUES
(1, 'MANGO', 'ATAULFO'),
(2, 'MANGO', 'HEIDEN'),
(3, 'MANGO', 'TOMMY'),
(4, 'LIMON', 'PERSA');

-- --------------------------------------------------------

--
-- Table structure for table `productos_empaques`
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `productos_productores`
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
-- Table structure for table `usuarios`
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=68 ;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre_usuario`, `contrasena_usuario`, `tipo_socio_usuario`, `nivel_autorizacion_usuario`, `fecha_creacion_usuario`, `fecha_modificacion_usuario`, `estado_usuario`) VALUES
(1, 'ADMINEMPAQUE', '05a7b54baab0eedc17c3217a3fcafbed', 2, 1, '2015-07-09', '2015-07-01', 1),
(67, 'PRODUCTOR1', 'b392dc4500d7490e52e44cc360a52db6', 1, 1, '2015-07-23', '2015-07-23', 1);

-- --------------------------------------------------------

--
-- Table structure for table `usuario_distribuidor`
--

CREATE TABLE IF NOT EXISTS `usuario_distribuidor` (
  `id_usuario_distribuidor` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_usuario_distribuidor` varchar(100) NOT NULL,
  `apellido_usuario_distribuidor` varchar(100) NOT NULL,
  `direccion_usuario_distribuidor` text NOT NULL,
  `telefono_usuario_distribuidor` varchar(20) NOT NULL,
  `id_usuario_fk` int(11) NOT NULL,
  `id_distribuidor_fk` int(11) NOT NULL,
  PRIMARY KEY (`id_usuario_distribuidor`),
  KEY `id_usuario_fk_idx` (`id_usuario_fk`),
  KEY `id_distribuidor_fk_idx` (`id_distribuidor_fk`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

-- --------------------------------------------------------

--
-- Table structure for table `usuario_empaque`
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `usuario_empaque`
--

INSERT INTO `usuario_empaque` (`id_receptor`, `nombre_receptor`, `apellido_receptor`, `direccion_receptor`, `telefono_receptor`, `pedidos`, `lotes`, `envios`, `superusuario`, `id_usuario_fk`, `id_empaque_fk`) VALUES
(1, 'ALFONSO', 'CALDERÓN CHÁEZ', 'APATZINGÁN, COL. 22 DE OCTUBRE, CALLE VENUZTIANO CARRANZA', '4531064590', 1, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `usuario_punto_venta`
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `distribuidor_cajas_envio`
--
ALTER TABLE `distribuidor_cajas_envio`
  ADD CONSTRAINT `distribuidor_cajas_envio_ibfk_1` FOREIGN KEY (`id_orden_fk`) REFERENCES `ordenes_distribuidor` (`id_orden`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `empresa_productores`
--
ALTER TABLE `empresa_productores`
  ADD CONSTRAINT `empresa_productores_ibfk_1` FOREIGN KEY (`id_usuario_fk`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `envios_empaque`
--
ALTER TABLE `envios_empaque`
  ADD CONSTRAINT `envios_empaque_ibfk_1` FOREIGN KEY (`id_distribuidor_fk`) REFERENCES `empresa_distribuidores` (`id_distribuidor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `envios_empaque_ibfk_2` FOREIGN KEY (`id_orden_fk`) REFERENCES `ordenes_distribuidor` (`id_orden`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lotes`
--
ALTER TABLE `lotes`
  ADD CONSTRAINT `lotes_ibfk_1` FOREIGN KEY (`id_productor_fk`) REFERENCES `empresa_productores` (`id_productor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lotes_ibfk_2` FOREIGN KEY (`id_producto_fk`) REFERENCES `productos` (`id_producto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ordenes_distribuidor`
--
ALTER TABLE `ordenes_distribuidor`
  ADD CONSTRAINT `ordenes_distribuidor_ibfk_1` FOREIGN KEY (`id_usuario_distribuidor_fk`) REFERENCES `usuario_distribuidor` (`id_usuario_distribuidor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ordenes_distribuidor_ibfk_2` FOREIGN KEY (`id_empaque_fk`) REFERENCES `empresa_empaques` (`id_empaque`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ordenes_distribuidor_detalles`
--
ALTER TABLE `ordenes_distribuidor_detalles`
  ADD CONSTRAINT `ordenes_distribuidor_detalles_ibfk_1` FOREIGN KEY (`id_orden_fk`) REFERENCES `ordenes_distribuidor` (`id_orden`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ordenes_distribuidor_detalles_ibfk_2` FOREIGN KEY (`id_producto_fk`) REFERENCES `productos` (`id_producto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ordenes_punto_venta`
--
ALTER TABLE `ordenes_punto_venta`
  ADD CONSTRAINT `ordenes_punto_venta_ibfk_1` FOREIGN KEY (`id_usuario_punto_venta_fk`) REFERENCES `usuario_punto_venta` (`id_usuario_pv`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ordenes_punto_venta_ibfk_2` FOREIGN KEY (`id_distribuidor_fk`) REFERENCES `empresa_distribuidores` (`id_distribuidor`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ordenes_punto_venta_detalles`
--
ALTER TABLE `ordenes_punto_venta_detalles`
  ADD CONSTRAINT `ordenes_punto_venta_detalles_ibfk_1` FOREIGN KEY (`id_orden_dist_fk`) REFERENCES `ordenes_punto_venta` (`id_orden`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ordenes_punto_venta_detalles_ibfk_2` FOREIGN KEY (`id_producto_fk`) REFERENCES `productos` (`id_producto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `productos_empaques`
--
ALTER TABLE `productos_empaques`
  ADD CONSTRAINT `productos_empaques_ibfk_1` FOREIGN KEY (`id_producto_fk`) REFERENCES `productos` (`id_producto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `productos_empaques_ibfk_2` FOREIGN KEY (`id_empaque_fk`) REFERENCES `empresa_empaques` (`id_empaque`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `productos_productores`
--
ALTER TABLE `productos_productores`
  ADD CONSTRAINT `productos_productores_ibfk_1` FOREIGN KEY (`id_productor_fk`) REFERENCES `empresa_productores` (`id_productor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `productos_productores_ibfk_2` FOREIGN KEY (`id_producto_fk`) REFERENCES `productos` (`id_producto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `usuario_distribuidor`
--
ALTER TABLE `usuario_distribuidor`
  ADD CONSTRAINT `usuario_distribuidor_ibfk_1` FOREIGN KEY (`id_usuario_fk`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuario_distribuidor_ibfk_2` FOREIGN KEY (`id_distribuidor_fk`) REFERENCES `empresa_distribuidores` (`id_distribuidor`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `usuario_empaque`
--
ALTER TABLE `usuario_empaque`
  ADD CONSTRAINT `usuario_empaque_ibfk_1` FOREIGN KEY (`id_usuario_fk`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuario_empaque_ibfk_2` FOREIGN KEY (`id_empaque_fk`) REFERENCES `empresa_empaques` (`id_empaque`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `usuario_punto_venta`
--
ALTER TABLE `usuario_punto_venta`
  ADD CONSTRAINT `usuario_punto_venta_ibfk_1` FOREIGN KEY (`id_usuario_fk`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuario_punto_venta_ibfk_2` FOREIGN KEY (`id_usuario_punto_venta`) REFERENCES `empresa_punto_venta` (`id_punto_venta`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
