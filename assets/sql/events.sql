-- phpMyAdmin SQL Dump
-- version 4.1.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 13, 2020 alle 09:16
-- Versione del server: 5.6.33-log
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `my_organizeriec`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `events`
--

CREATE TABLE IF NOT EXISTS `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `day` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `tag` text NOT NULL,
  `idate` date NOT NULL,
  `hschool` varchar(25) NOT NULL,
  `ename` text NOT NULL,
  `descr` varchar(255) NOT NULL,
  `prio` tinyint(4) NOT NULL,
  `vis` tinyint(4) NOT NULL,
  `matu` tinyint(4) NOT NULL,
  `checking` tinyint(4) NOT NULL,
  `id_writter` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=72 ;

--
-- Dump dei dati per la tabella `events`
--

INSERT INTO `events` (`id`, `day`, `tag`, `idate`, `hschool`, `ename`, `descr`, `prio`, `vis`, `matu`, `checking`, `id_writter`) VALUES
(54, '2020-10-27 12:07:24', 'M117', '2020-11-11', '13:05 - 14:35', 'Test Reti', '- Il modello ISO/OSI (teoria)\r\n- il MAC Adress (teoria)\r\n- Il frame ethernet (teoria ed esercizi)\r\n- Gli indirizzi IP (teoria ed esercizi)', 2, 1, 2, 0, 10),
(71, '2020-11-11 06:05:19', 'FISE', '2020-11-30', 'All Day', 'Test fise', 'Quello dell''ultima volta', 2, 1, 2, 0, 10),
(56, '2020-10-20 11:21:06', 'Ingle', '2020-11-26', 'Mattina', 'test ingle', 'argomenti non disponibili ', 2, 1, 1, 0, 10),
(70, '2020-11-06 09:12:48', 'Ingle', '2020-11-17', '', 'Scheda halloween', 'Fare i nomi al plurale', 4, 1, 1, 0, 10),
(11, '2020-10-10 20:00:00', 'Inglese', '2020-12-17', '5 Ora', 'Test di materia', 'Argomenti non disponibili', 1, 1, 0, 0, 1),
(14, '2020-10-10 20:00:00', 'Matematica', '2020-11-24', '1 Ora', 'Test Mate', 'Argomenti non disponibili', 2, 1, 0, 0, 27),
(15, '2020-10-10 20:00:00', 'Matematica', '2020-12-22', '1 Ora', 'Test Mate', 'Argomenti non disponibili', 1, 1, 0, 0, 27),
(16, '2020-10-10 20:00:00', 'Matematica', '2021-02-02', '1 Ora', 'Test Mate', 'Argomenti non disponibili', 2, 1, 0, 0, 27),
(17, '2020-10-10 20:00:00', 'Matematica', '2021-03-09', '1 Ora', 'Test Mate', 'Argomenti non disponibili', 2, 1, 0, 0, 27),
(18, '2020-10-10 20:00:00', 'Matematica', '2021-04-13', '1 Ora', 'Test Mate', 'Argomenti non disponibili', 2, 1, 0, 0, 27),
(19, '2020-10-10 20:00:00', 'Matematica', '2021-05-11', '1 Ora', 'Test Mate', 'Argomenti non disponibili', 1, 1, 0, 0, 27),
(65, '2020-10-28 13:29:21', 'Tedesco', '2020-11-17', '', 'Sapere verbi', 'Fascicolo', 2, 1, 0, 0, 8),
(63, '2020-10-28 07:25:01', 'Matematica', '2020-11-09', '', 'Portare un quaderno ', 'D sportate ', 4, 1, 0, 0, 8),
(64, '2020-10-28 11:15:26', 'Storia', '2020-11-19', '', 'Test storia', 'Test rivoluzione industriale ', 2, 1, 0, 0, 8),
(69, '2020-10-30 13:52:41', 'M214', '2020-11-20', '12:15', 'Guida OneNote', 'Consegnare guida di OneNote svolta in classe', 2, 1, 2, 0, 10),
(62, '2020-11-13 07:09:55', 'M104', '2020-11-18', 'All Day', 'Test DB', 'Schema ER, schema logico,...', 2, 1, 2, 0, 10),
(25, '2020-10-10 20:00:00', 'Tedesco', '2020-11-24', '1 Ora', 'Test tede', 'Da definire lettura o ascolto probabile', 2, 1, 0, 0, 26),
(26, '2020-10-10 20:00:00', 'Tedesco', '2020-12-15', '1 Ora', 'Test tede', 'Interrogazione orale ', 2, 1, 0, 0, 26),
(68, '2020-10-29 13:16:06', 'Fisica', '2020-12-15', '', 'test', 'awd', 2, 1, 0, 0, 8),
(66, '2020-10-29 13:15:12', 'Fisica', '2020-11-17', '', 'test', 'asd', 2, 1, 0, 0, 8),
(39, '2020-11-13 07:10:07', 'FISE', '2020-11-18', '1 Ora', 'Test su fascicolo', 'Tutto quello fatto in classe l''ultima volta', 2, 1, 2, 0, 10),
(67, '2020-10-29 13:15:40', 'Fisica', '2020-12-03', '', 'test', 'asd', 2, 1, 0, 0, 8),
(57, '2020-10-20 11:21:57', 'Ingle', '2020-12-15', 'Mattina', 'test ingle', 'argomenti non disponibili ', 1, 1, 1, 0, 10);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
