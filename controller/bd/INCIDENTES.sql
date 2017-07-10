-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 09-07-2017 a las 20:40:26
-- Versión del servidor: 5.6.12-log
-- Versión de PHP: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `incidentes`
--
CREATE DATABASE IF NOT EXISTS `incidentes` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `incidentes`;

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `INSERTAR_MASIVO`(IN `anio` INT)
insert into TVACGEN(TVACPER,TVACANI,TVACACU,TVACLAB,TVACNLA)
select CODPER,year(PERFIG)+anio,30,0,0 from TSOLIC inner join tpers on percod=CODPER INNER JOIN TVACGEN ON  TVACPER=CODPER WHERE PEREST='' AND PERFCS IS NULL AND YEAR(PERFIG)+anio BETWEEN 1900 AND 2012 AND TVACANI BETWEEN 2013 AND 2014 AND TVACPER=CODPER GROUP BY 1,2$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `INSERTAR_NUEVOS_ATRASADOS`(IN `dias` INT)
INSERT INTO TVACGEN(TVACPER,TVACANI,TVACACU,TVACLAB,TVACNLA) SELECT PERCOD,YEAR(CURDATE()),30,0,0
FROM TPERS WHERE DATE_ADD(CURDATE(),INTERVAL -dias DAY)=DATE_ADD(PERFIG, INTERVAL 1 * 
(YEAR(CURDATE())-YEAR(PERFIG)) YEAR) AND PERFCS IS NULL AND PEREST=''$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `accionpantalla`
--

CREATE TABLE IF NOT EXISTS `accionpantalla` (
  `IdAccionPantalla` int(11) NOT NULL AUTO_INCREMENT,
  `NombreAccion` varchar(30) DEFAULT NULL,
  `IdPantalla` int(11) DEFAULT NULL,
  PRIMARY KEY (`IdAccionPantalla`),
  KEY `R_14` (`IdPantalla`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE IF NOT EXISTS `categoria` (
  `IdCategoria` int(11) NOT NULL AUTO_INCREMENT,
  `NombreCategoria` varchar(30) DEFAULT NULL,
  `Estado` bit(1) DEFAULT NULL,
  PRIMARY KEY (`IdCategoria`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`IdCategoria`, `NombreCategoria`, `Estado`) VALUES
(1, 'EJEMPLO', b'1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detpertip`
--

CREATE TABLE IF NOT EXISTS `detpertip` (
  `codtipdet` int(11) NOT NULL AUTO_INCREMENT,
  `nomtipdet` varchar(20) NOT NULL,
  `destipdet` varchar(100) NOT NULL,
  `CODTIPFK` int(11) NOT NULL,
  PRIMARY KEY (`codtipdet`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Volcado de datos para la tabla `detpertip`
--

INSERT INTO `detpertip` (`codtipdet`, `nomtipdet`, `destipdet`, `CODTIPFK`) VALUES
(1, 'La Molina', '', 1),
(2, 'Sta. Catalina', '', 1),
(3, 'Cliente', '', 1),
(4, 'Viaje de Trabajo', '', 1),
(5, 'Otros', '', 1),
(6, 'Salud', 'Presentar constancia de atencion medica.', 2),
(7, 'Estudios', '', 2),
(8, 'Asunto Personal', '', 2),
(9, 'Otros', 'Presentar constancia de atencion medica.', 2),
(10, 'Sta. Anita', '', 1),
(11, 'La Molina', '', 1),
(12, 'Puente Piedra', '', 1),
(13, 'Los Olivos', '', 1),
(14, 'Puente Piedra', '', 1),
(15, 'Callao', '', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE IF NOT EXISTS `empresa` (
  `IdEmpresa` int(11) NOT NULL AUTO_INCREMENT,
  `RucEmpresa` varchar(11) DEFAULT NULL,
  `RazonSocialEmpresa` varchar(50) DEFAULT NULL,
  `IdUsuario` int(11) DEFAULT NULL,
  `Estado` bit(1) DEFAULT NULL,
  PRIMARY KEY (`IdEmpresa`),
  KEY `R_8` (`IdUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE IF NOT EXISTS `estado` (
  `IdEstado` int(11) NOT NULL AUTO_INCREMENT,
  `NombreEstado` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`IdEstado`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `incidencia`
--

CREATE TABLE IF NOT EXISTS `incidencia` (
  `IdIncidencia` int(11) NOT NULL AUTO_INCREMENT,
  `Ticket` int(11) DEFAULT NULL,
  `NombreIncidencia` varchar(30) DEFAULT NULL,
  `Descripcion` varchar(500) DEFAULT NULL,
  `FechaRegistro` datetime DEFAULT NULL,
  `Prioridad` char(1) DEFAULT NULL,
  `Calificacion` int(11) DEFAULT NULL,
  `IdCategoria` int(11) DEFAULT NULL,
  `IdLugarIncidencia` int(11) DEFAULT NULL,
  `IdEstado` int(11) DEFAULT NULL,
  `IdUsuarioAsignado` int(11) DEFAULT NULL,
  `IdUsuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`IdIncidencia`),
  KEY `R_3` (`IdCategoria`),
  KEY `R_5` (`IdLugarIncidencia`),
  KEY `R_6` (`IdEstado`),
  KEY `R_10` (`IdUsuarioAsignado`),
  KEY `R_13` (`IdUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `incidenciaadjunto`
--

CREATE TABLE IF NOT EXISTS `incidenciaadjunto` (
  `IdAdjunto` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(40) DEFAULT NULL,
  `Descripcion` varchar(200) DEFAULT NULL,
  `Peso` decimal(7,2) DEFAULT NULL,
  `IdIncidencia` int(11) DEFAULT NULL,
  PRIMARY KEY (`IdAdjunto`),
  KEY `R_4` (`IdIncidencia`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lugarincidencia`
--

CREATE TABLE IF NOT EXISTS `lugarincidencia` (
  `IdLugarIncidencia` int(11) NOT NULL AUTO_INCREMENT,
  `CodLugarIncidencia` varchar(20) DEFAULT NULL,
  `NombreLugarIncidencia` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`IdLugarIncidencia`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pantalla`
--

CREATE TABLE IF NOT EXISTS `pantalla` (
  `IdPantalla` int(11) NOT NULL AUTO_INCREMENT,
  `NombrePantalla` varchar(50) DEFAULT NULL,
  `TituloPantalla` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`IdPantalla`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil`
--

CREATE TABLE IF NOT EXISTS `perfil` (
  `IdPerfil` int(11) NOT NULL AUTO_INCREMENT,
  `NombrePerfil` varchar(30) DEFAULT NULL,
  `Estado` bit(1) DEFAULT NULL,
  PRIMARY KEY (`IdPerfil`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil_accionpantalla`
--

CREATE TABLE IF NOT EXISTS `perfil_accionpantalla` (
  `IdPerfil_AccionPantalla` int(11) NOT NULL AUTO_INCREMENT,
  `IdPerfil` int(11) DEFAULT NULL,
  `IdAccionPantalla` int(11) DEFAULT NULL,
  PRIMARY KEY (`IdPerfil_AccionPantalla`),
  KEY `R_15` (`IdPerfil`),
  KEY `R_16` (`IdAccionPantalla`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE IF NOT EXISTS `permisos` (
  `fksubpro` int(11) NOT NULL,
  `fkusecod` int(11) NOT NULL,
  `estper` int(11) NOT NULL,
  PRIMARY KEY (`fksubpro`,`fkusecod`),
  KEY `codspro` (`fksubpro`),
  KEY `usecod` (`fkusecod`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`fksubpro`, `fkusecod`, `estper`) VALUES
(1, 1, 1),
(2, 1, 1),
(3, 1, 1),
(4, 1, 1),
(5, 1, 1),
(6, 1, 1),
(7, 1, 1),
(8, 1, 1),
(9, 1, 1),
(10, 1, 1),
(11, 1, 1),
(12, 1, 1),
(13, 1, 1),
(14, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programa`
--

CREATE TABLE IF NOT EXISTS `programa` (
  `codpro` int(11) NOT NULL AUTO_INCREMENT,
  `pronom` varchar(50) NOT NULL,
  `prodes` varchar(100) NOT NULL,
  PRIMARY KEY (`codpro`,`pronom`),
  KEY `codpro` (`codpro`,`pronom`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `programa`
--

INSERT INTO `programa` (`codpro`, `pronom`, `prodes`) VALUES
(1, 'MANTENIMIENTO', 'Permite tener Eliminacion, Modificacion y Registro'),
(2, 'ADMINISTRADOR SISTEMA', 'Brindar Privilegios del Sistema'),
(3, 'CONSULTA', 'Realizar consultas de acuerdo a lo solicitado en la empresa'),
(4, 'REPORTE', 'Unicamente exportar a Excel, Word, PDF'),
(5, 'AUDITORIA', 'Supervision de lo que se va eliminando, modificando y registrando'),
(6, 'MIS DATOS', 'Datos personales del usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seguimientoincidencia`
--

CREATE TABLE IF NOT EXISTS `seguimientoincidencia` (
  `IdIncidencia` int(11) DEFAULT NULL,
  `IdSeguimientoIncidencia` int(11) NOT NULL AUTO_INCREMENT,
  `IdTransaccion` int(11) DEFAULT NULL,
  `CampoModificado` varchar(30) DEFAULT NULL,
  `ValorAnterior` varchar(500) DEFAULT NULL,
  `ValorNuevo` varchar(500) DEFAULT NULL,
  `Fecha` datetime DEFAULT NULL,
  `Observacion` varchar(500) DEFAULT NULL,
  `IdUsuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`IdSeguimientoIncidencia`),
  KEY `R_7` (`IdIncidencia`),
  KEY `R_11` (`IdUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tsubpro`
--

CREATE TABLE IF NOT EXISTS `tsubpro` (
  `codspro` int(11) NOT NULL AUTO_INCREMENT,
  `nomspro` varchar(50) NOT NULL,
  `rutaspr` varchar(100) NOT NULL,
  `codprofk` int(11) NOT NULL,
  PRIMARY KEY (`codspro`),
  KEY `codprofk` (`codprofk`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=48 ;

--
-- Volcado de datos para la tabla `tsubpro`
--

INSERT INTO `tsubpro` (`codspro`, `nomspro`, `rutaspr`, `codprofk`) VALUES
(1, 'Categoria', 'categoria', 1),
(2, 'Empresa', 'empresa', 1),
(3, 'Estado', 'estado', 1),
(4, 'Incidente', 'incidencia', 1),
(5, 'Perfil', 'perfil', 1),
(6, 'Lugar Incidente', 'lugarIncidencia', 1),
(7, 'Seguimiento Incidente', 'seguimiento', 1),
(8, 'Usuario', 'usuario', 2),
(9, 'Programa', 'programas', 2),
(10, 'Permisos', 'permisos', 2),
(11, 'Sub Programa', 'subprograma', 2),
(12, 'Personal', 'personal', 5),
(13, 'Usuarios', 'usuario', 5),
(14, 'Cambiar Clave', 'clave', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tuser`
--

CREATE TABLE IF NOT EXISTS `tuser` (
  `usecod` int(11) NOT NULL AUTO_INCREMENT,
  `useali` varchar(100) NOT NULL,
  `usecla` varchar(20) NOT NULL,
  `useest` varchar(1) NOT NULL,
  `coduseper` int(11) NOT NULL,
  PRIMARY KEY (`usecod`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `tuser`
--

INSERT INTO `tuser` (`usecod`, `useali`, `usecla`, `useest`, `coduseper`) VALUES
(1, 'gurbano@softwarecamp.com', 'sistemas2013', '1', 612),
(2, 'localhost@softwarecamp.com', 'localhost', '1', 0),
(3, 'fhuaman@softwarecamp.com', '123456', '1', 0),
(4, 'caugusto@softwarecamp.com', '123456', '1', 0),
(5, 'jayala@softwarecamp.com', '123456', '1', 0),
(6, 'mvillar@softwarecamp.com', '123456', '1', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `IdUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `NombreUsuario` varchar(30) DEFAULT NULL,
  `NombreCompleto` varchar(50) DEFAULT NULL,
  `Correo` varchar(30) DEFAULT NULL,
  `Telefono` varchar(20) DEFAULT NULL,
  `Estado` bit(1) DEFAULT NULL,
  `IdPerfil` int(11) DEFAULT NULL,
  PRIMARY KEY (`IdUsuario`),
  KEY `R_9` (`IdPerfil`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `accionpantalla`
--
ALTER TABLE `accionpantalla`
  ADD CONSTRAINT `accionpantalla_ibfk_1` FOREIGN KEY (`IdPantalla`) REFERENCES `pantalla` (`IdPantalla`);

--
-- Filtros para la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD CONSTRAINT `empresa_ibfk_1` FOREIGN KEY (`IdUsuario`) REFERENCES `usuario` (`IdUsuario`);

--
-- Filtros para la tabla `incidencia`
--
ALTER TABLE `incidencia`
  ADD CONSTRAINT `incidencia_ibfk_1` FOREIGN KEY (`IdCategoria`) REFERENCES `categoria` (`IdCategoria`),
  ADD CONSTRAINT `incidencia_ibfk_2` FOREIGN KEY (`IdLugarIncidencia`) REFERENCES `lugarincidencia` (`IdLugarIncidencia`),
  ADD CONSTRAINT `incidencia_ibfk_3` FOREIGN KEY (`IdEstado`) REFERENCES `estado` (`IdEstado`),
  ADD CONSTRAINT `incidencia_ibfk_4` FOREIGN KEY (`IdUsuarioAsignado`) REFERENCES `usuario` (`IdUsuario`),
  ADD CONSTRAINT `incidencia_ibfk_5` FOREIGN KEY (`IdUsuario`) REFERENCES `usuario` (`IdUsuario`);

--
-- Filtros para la tabla `incidenciaadjunto`
--
ALTER TABLE `incidenciaadjunto`
  ADD CONSTRAINT `incidenciaadjunto_ibfk_1` FOREIGN KEY (`IdIncidencia`) REFERENCES `incidencia` (`IdIncidencia`);

--
-- Filtros para la tabla `perfil_accionpantalla`
--
ALTER TABLE `perfil_accionpantalla`
  ADD CONSTRAINT `perfil_accionpantalla_ibfk_1` FOREIGN KEY (`IdPerfil`) REFERENCES `perfil` (`IdPerfil`),
  ADD CONSTRAINT `perfil_accionpantalla_ibfk_2` FOREIGN KEY (`IdAccionPantalla`) REFERENCES `accionpantalla` (`IdAccionPantalla`);

--
-- Filtros para la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD CONSTRAINT `permisos_ibfk_1` FOREIGN KEY (`fksubpro`) REFERENCES `tsubpro` (`codspro`),
  ADD CONSTRAINT `permisos_ibfk_2` FOREIGN KEY (`fkusecod`) REFERENCES `tuser` (`usecod`);

--
-- Filtros para la tabla `programa`
--
ALTER TABLE `programa`
  ADD CONSTRAINT `programa_ibfk_1` FOREIGN KEY (`codpro`) REFERENCES `tsubpro` (`codspro`);

--
-- Filtros para la tabla `seguimientoincidencia`
--
ALTER TABLE `seguimientoincidencia`
  ADD CONSTRAINT `seguimientoincidencia_ibfk_1` FOREIGN KEY (`IdIncidencia`) REFERENCES `incidencia` (`IdIncidencia`),
  ADD CONSTRAINT `seguimientoincidencia_ibfk_2` FOREIGN KEY (`IdUsuario`) REFERENCES `usuario` (`IdUsuario`);

--
-- Filtros para la tabla `tsubpro`
--
ALTER TABLE `tsubpro`
  ADD CONSTRAINT `tsubpro_ibfk_1` FOREIGN KEY (`codprofk`) REFERENCES `programa` (`codpro`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`IdPerfil`) REFERENCES `perfil` (`IdPerfil`);

DELIMITER $$
--
-- Eventos
--
CREATE DEFINER=`root`@`localhost` EVENT `INSERT_GENERAR_VACACIONES` ON SCHEDULE EVERY 1 DAY STARTS '2014-11-26 09:00:00' ON COMPLETION NOT PRESERVE ENABLE COMMENT 'INSERCION DE PERSONAL EN VACACIONES PROXIMAS' DO INSERT INTO TVACGEN(TVACPER,TVACANI,TVACACU,TVACTOM) 
SELECT PERCOD,YEAR(CURDATE()),30,0 FROM TPERS WHERE CURDATE()=DATE_ADD(PERFIG, INTERVAL 1 * (YEAR(CURDATE())-YEAR(PERFIG)) YEAR) AND PERFCS IS NULL AND PEREST=''$$

DELIMITER ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
