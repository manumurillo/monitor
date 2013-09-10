-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-08-2013 a las 00:22:34
-- Versión del servidor: 5.5.27
-- Versión de PHP: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `monitoreo_axa`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `monitor_frequency_content`
--

CREATE TABLE IF NOT EXISTS `monitor_frequency_content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  `frequency` int(11) NOT NULL DEFAULT '0',
  `column_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_column` (`column_id`),
  KEY `id_column_2` (`column_id`),
  KEY `column_id` (`column_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `monitor_lookup`
--

CREATE TABLE IF NOT EXISTS `monitor_lookup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `code` int(11) NOT NULL,
  `type` varchar(128) NOT NULL,
  `position` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `monitor_lookup`
--

INSERT INTO `monitor_lookup` (`id`, `name`, `code`, `type`, `position`) VALUES
(1, 'Borrador', 1, 'ReportStatus', 1),
(2, 'Publicado', 2, 'ReportStatus', 2),
(3, 'Archivado', 3, 'ReportStatus', 3),
(4, 'Tabla', 0, 'ReportItemType', 0),
(5, 'Texto', 1, 'ReportItemType', 1),
(6, 'Deshabilitado', 0, 'ReportTableStatus', 0),
(7, 'Habilitado', 1, 'ReportTableStatus', 1),
(8, 'No autocompletar', 0, 'ReportTableColumnAutocomplete', 0),
(9, 'Autocompletar', 1, 'ReportTableColumnAutocomplete', 1);
(10, 'Activo', 1, 'UserStatus', 1);
(11, 'Inactivo', 2, 'UserStatus', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `monitor_report`
--

CREATE TABLE IF NOT EXISTS `monitor_report` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `date_created` int(11) NOT NULL,
  `date_update` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `monitor_report_item`
--

CREATE TABLE IF NOT EXISTS `monitor_report_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `report_id` int(11) NOT NULL,
  `position` int(11) NOT NULL DEFAULT '0',
  `type` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_item_report` (`report_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `monitor_report_table`
--

CREATE TABLE IF NOT EXISTS `monitor_report_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `table_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_item_rtable` (`item_id`),
  KEY `FK_table_rtable` (`table_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `monitor_report_table_cell`
--

CREATE TABLE IF NOT EXISTS `monitor_report_table_cell` (
  `row_id` int(11) NOT NULL,
  `column_id` int(11) NOT NULL,
  `content` text,
  `color` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`row_id`,`column_id`),
  KEY `monitor_cell_column` (`column_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `monitor_report_table_row`
--

CREATE TABLE IF NOT EXISTS `monitor_report_table_row` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rtable_id` int(11) NOT NULL,
  `position` int(11) NOT NULL,
  `color` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `rtable_id` (`rtable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `monitor_report_text`
--

CREATE TABLE IF NOT EXISTS `monitor_report_text` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) DEFAULT NULL,
  `text` text,
  `rtable_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_item_text` (`item_id`),
  KEY `rtable_id` (`rtable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `monitor_table`
--

CREATE TABLE IF NOT EXISTS `monitor_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `description` text,
  `footer` text,
  `title` varchar(128) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `monitor_table`
--

INSERT INTO `monitor_table` (`id`, `name`, `description`, `footer`, `title`, `status`) VALUES
(1, 'Menciones directas', '', '<p><span style="font-family: arial; color: #333333; font-size: 12px;"><strong>ALCANCE</strong></span><br /> <span style="font-family: arial; color: #2d80a4; font-size: 12px;"><strong>TW:</strong></span>Suma del n&uacute;mero de seguidores.<br /> <span style="font-family: arial; color: #2d80a4; font-size: 12px;"><strong>FB:</strong></span> Suma del n&uacute;mero de fans.<br /> <span style="font-family: arial; color: #2d80a4; font-size: 12px;"><strong>Blog y News:</strong></span> N&uacute;mero backlinks que es la cantidad de p&aacute;ginas que la enlazan a trav&eacute;s de un v&iacute;nculo. Los backlinks son muy importantes para el posicionamiento en los buscadores y es indicativo de la relevancia o importancia de una web o blog.<br /> <span style="font-family: arial; color: #2d80a4; font-size: 12px;"><strong>Videos:</strong></span> N&uacute;mero de reproducciones.<br /> <span style="font-family: arial; color: #2d80a4; font-size: 12px;"><strong>Foros:</strong></span> N&uacute;mero de comentarios o respuestas a la publicaci&oacute;n.</p>', '', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `monitor_table_column`
--

CREATE TABLE IF NOT EXISTS `monitor_table_column` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `table_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `width` smallint(6) NOT NULL,
  `color` varchar(10) DEFAULT NULL,
  `position` tinyint(2) NOT NULL DEFAULT '0',
  `autocomplete` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_table_column` (`table_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `monitor_table_column`
--

INSERT INTO `monitor_table_column` (`id`, `table_id`, `title`, `width`, `color`, `position`, `autocomplete`) VALUES
(1, 1, 'SITIO', 100, '#333333', 1, 1),
(2, 1, 'POSITIVO', 100, '#669900', 2, 0),
(3, 1, 'ALCANCE', 100, '#669900', 3, 0),
(4, 1, 'NEUTRAL', 100, '#666666', 4, 0),
(5, 1, 'ALCANCE', 100, '#666666', 5, 0),
(6, 1, 'NEGATIVO', 100, '#990000', 6, 0),
(7, 1, 'ALCANCE', 100, '#990000', 7, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `monitor_user`
--

CREATE TABLE IF NOT EXISTS `monitor_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(128) NOT NULL,
  `password` varchar(128) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `salt` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `monitor_user`
--

INSERT INTO `monitor_user` (`id`, `username`, `password`, `email`, `status`, `salt`) VALUES
(1, 'admin', '2f3f6c4ef60b3c5716188e56dcc8e014', 'jmanumurillo@hotmail.com', 1, '50f07cc623da32.61980987');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `monitor_frequency_content`
--
ALTER TABLE `monitor_frequency_content`
  ADD CONSTRAINT `monitor_frequency_content_ibfk_1` FOREIGN KEY (`column_id`) REFERENCES `monitor_table_column` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `monitor_report_item`
--
ALTER TABLE `monitor_report_item`
  ADD CONSTRAINT `FK_item_report` FOREIGN KEY (`report_id`) REFERENCES `monitor_report` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `monitor_report_table`
--
ALTER TABLE `monitor_report_table`
  ADD CONSTRAINT `FK_item_rtable` FOREIGN KEY (`item_id`) REFERENCES `monitor_report_item` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_table_rtable` FOREIGN KEY (`table_id`) REFERENCES `monitor_table` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `monitor_report_table_cell`
--
ALTER TABLE `monitor_report_table_cell`
  ADD CONSTRAINT `FK_cell_row` FOREIGN KEY (`row_id`) REFERENCES `monitor_report_table_row` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `monitor_cell_column` FOREIGN KEY (`column_id`) REFERENCES `monitor_table_column` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `monitor_report_table_row`
--
ALTER TABLE `monitor_report_table_row`
  ADD CONSTRAINT `monitor_report_table_row_ibfk_1` FOREIGN KEY (`rtable_id`) REFERENCES `monitor_report_table` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `monitor_report_text`
--
ALTER TABLE `monitor_report_text`
  ADD CONSTRAINT `FK_item_text` FOREIGN KEY (`item_id`) REFERENCES `monitor_report_item` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `monitor_report_text_ibfk_1` FOREIGN KEY (`rtable_id`) REFERENCES `monitor_report_table` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `monitor_table_column`
--
ALTER TABLE `monitor_table_column`
  ADD CONSTRAINT `FK_table_column` FOREIGN KEY (`table_id`) REFERENCES `monitor_table` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
