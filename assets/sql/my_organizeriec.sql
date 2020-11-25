-- phpMyAdmin SQL Dump
-- version 4.1.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 12, 2020 alle 13:37
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
-- Struttura della tabella `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `roleid` tinyint(4) DEFAULT NULL,
  `isActive` tinyint(4) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=9 ;

--
-- Dump dei dati per la tabella `admin`
--

INSERT INTO `admin` (`id`, `name`, `lname`, `email`, `username`, `password`, `roleid`, `isActive`, `created_at`, `updated_at`) VALUES
(1, 'Angelo', 'Rigoni', 'angelo.rigoni05@gmail.com', 'angelo', '017f94ada91f1168a89ba4555540adc4b4f27f25', 1, 0, '2020-09-25 18:57:34', '2020-09-25 18:57:34'),
(7, 'Angelo', 'Rigoni', 'prova@gmail.com', 'prova', 'bced2dcac84908cac0c328008c7bb6f66f8ab3cf', 4, 0, '2020-09-30 17:23:24', '2020-09-30 17:23:24');

-- --------------------------------------------------------

--
-- Struttura della tabella `aule`
--

CREATE TABLE IF NOT EXISTS `aule` (
  `id` int(11) NOT NULL,
  `aula` varchar(25) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `aule`
--

INSERT INTO `aule` (`id`, `aula`) VALUES
(1, '014'),
(2, '112'),
(3, '113'),
(4, '106'),
(5, '111'),
(6, '017'),
(7, '203'),
(8, '201'),
(9, '015'),
(10, 'P2'),
(11, '206'),
(12, '016'),
(13, '204'),
(14, '107'),
(15, ''),
(16, '018'),
(17, '201'),
(18, 'P1');

-- --------------------------------------------------------

--
-- Struttura della tabella `bloccoa`
--

CREATE TABLE IF NOT EXISTS `bloccoa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `blocco` text NOT NULL,
  `giorno` text NOT NULL,
  `materia_1` varchar(100) NOT NULL,
  `materia_2` varchar(100) NOT NULL,
  `materia_3` varchar(100) NOT NULL,
  `materia_4` varchar(100) NOT NULL,
  `materia_5` varchar(100) NOT NULL,
  `materia_6` varchar(100) NOT NULL,
  `materia_7` varchar(100) NOT NULL,
  `materia_8` varchar(100) NOT NULL,
  `materia_9` varchar(100) NOT NULL,
  `materia_10` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=21 ;

--
-- Dump dei dati per la tabella `bloccoa`
--

INSERT INTO `bloccoa` (`id`, `blocco`, `giorno`, `materia_1`, `materia_2`, `materia_3`, `materia_4`, `materia_5`, `materia_6`, `materia_7`, `materia_8`, `materia_9`, `materia_10`) VALUES
(1, 'A', 'Lunedì', 'M114', 'M114', 'M404', 'M404', 'M404', 'PRANZO', 'ITA', 'ITA', 'STO', 'STO'),
(2, 'A', 'Martedì', 'FISE', 'FISE', 'M431', 'M431', 'M431', 'PRANZO', 'M117', 'M117', 'M104', 'M104'),
(3, 'A', 'Mercoledì', 'MATE', 'MATE', 'MATE', 'MATE', 'STO', 'PRANZO', 'TEDE', 'TEDE', 'ITA', 'ITA'),
(4, 'A', 'Giovedì', 'ECD', 'ECD', 'M403', 'M403', 'M114', 'PRANZO', 'FIS2', 'FIS2', 'INGLE', 'INGLE'),
(5, 'A', 'Venerdì', 'EF', 'EF', 'EF', 'EF', 'EF', 'PRANZO', 'EA', 'EA', 'M214', 'M214'),
(6, 'B', 'Lunedì', 'APPR', 'APPR', 'APPR', 'APPR', 'PRANZO', 'M213', 'M213', 'M214', 'M213', 'M213'),
(7, 'B', 'Martedì', 'M214', 'M214', 'M104', 'M104', 'PRANZO', 'FISE', 'FISE', 'FISE', 'FISE', 'FISE'),
(8, 'B', 'Mercoledì', 'M100', 'M100', 'M403', 'M403', 'PRANZO', 'M431', 'M431', 'M117', 'M117', 'M117'),
(9, 'B', 'Giovedì', 'M123', 'M123', 'EF', 'EF', 'PRANZO', 'M114', 'M114', 'M100', 'M403', 'M403'),
(10, 'B', 'Venerdì', 'M100', 'M100', 'M431', 'M431', 'PRANZO', 'M431', 'M431', 'M431', 'EF', 'EF'),
(11, 'C', 'Lunedì', 'M404', 'M404', 'M404', 'M404', 'M404', 'PRANZO', 'M123', 'M123', 'M117', 'M117'),
(12, 'C', 'Martedì', 'ITA', 'ITA', 'TEDE', 'TEDE', 'TEDE', 'PRANZO', 'STO', 'STO', 'FIS2', 'FIS2'),
(13, 'C', 'Mercoledì', 'MATE', 'MATE', 'MATE', 'M104', 'M104', 'PRANZO', 'EA', 'EA', 'FISE', 'FISE'),
(14, 'C', 'Giovedì', 'ECD', 'ECD', 'STO', 'STO', 'PRANZO', 'INGLE', 'INGLE', 'INGLE', 'M123', 'M123'),
(15, 'C', 'Venerdì', 'M403', 'M403', 'M403', 'M214', 'M214', 'PRANZO', 'EF', 'EF', 'EF', 'EF'),
(16, 'D', 'Lunedì', 'M117', 'M117', 'M431', 'M100', 'M100', 'PRANZO', 'M114', 'M114', 'M123', 'M123'),
(17, 'D', 'Martedì', 'MATE', 'MATE', 'MATE', 'MATE', 'ECD', 'PRANZO', 'TEDE', 'TEDE', 'ECD', 'ECD'),
(18, 'D', 'Mercoledì', 'INGLE', 'INGLE', 'M431', 'M214', 'M214', 'PRANZO', 'EF', 'EF', 'EF', 'EF'),
(19, 'D', 'Giovedì', 'ITA', 'ITA', 'FISE', 'ITA', 'ITA', 'PRANZO', 'ECD', 'ECD', 'STO', 'STO'),
(20, 'D', 'Venerdì', 'M213', 'M213', 'M100', 'M100', 'PRANZO', 'EA', 'EA', 'EA', 'M214', 'M214');

-- --------------------------------------------------------

--
-- Struttura della tabella `block`
--

CREATE TABLE IF NOT EXISTS `block` (
  `id` int(11) NOT NULL,
  `bl` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `block`
--

INSERT INTO `block` (`id`, `bl`) VALUES
(1, 'A'),
(2, 'B'),
(3, 'C'),
(4, 'D');

-- --------------------------------------------------------

--
-- Struttura della tabella `docenti`
--

CREATE TABLE IF NOT EXISTS `docenti` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `sigla` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `matu` tinyint(4) NOT NULL,
  `lmoodle` varchar(1024) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=16 ;

--
-- Dump dei dati per la tabella `docenti`
--

INSERT INTO `docenti` (`id`, `name`, `lname`, `sigla`, `email`, `matu`, `lmoodle`) VALUES
(1, 'Gionata', 'Genazzi', 'GeG', 'gionata.genazzi@edu.ti.ch', 2, 'https://moodle.edu.ti.ch/cptlocarno/course/view.php?id=491'),
(2, 'Reto', 'Repetti', 'ReR', 'reto.repetti@edu.ti.ch', 2, ''),
(3, 'Rossella', 'Blewitt', 'Ble', 'rossella.blewitt@edu.ti.ch', 0, ''),
(4, 'Fertile', 'Michelangelo', 'FeM', 'fertile.michelangelo@edu.ti.ch', 2, ''),
(5, 'Mauro', 'Euro', 'Eur', 'mauro.euro@edu.ti.ch', 0, ''),
(6, 'Domenico', 'Sciulli', 'ScD', 'sciulli.domenico@edu.ti.ch', 2, ''),
(7, 'Onorio', 'Iannarelli', 'IaO', 'onorio.iannarelli@edu.ti.ch', 0, ''),
(8, 'Patrick', 'Fornera', 'For', 'patrick.fornera@edu.ti.ch', 2, ''),
(9, 'Tatiana', 'Da cambiare', 'PiT', 'tatiana.cambiare@edu.ti.ch', 0, ''),
(10, 'Da cambiare', 'Da cambiare', 'ScL', 'da.da@edu.ti.ch', 0, ''),
(11, 'Nicola', 'De Carli', 'DeN', 'nicola.decarli@edu.ti.ch', 2, ''),
(12, 'Rossano', 'Dell''avo', 'DeR', 'rossano.dellavo@edu.ti.ch', 2, ''),
(13, 'Da cambiare', 'Bizzarri', 'Biz', 'm431@edu.ti.ch', 2, ''),
(14, 'Ronny', 'Esposito Cornelio', 'EsR', 'ronny.esposito@edu.ti.ch', 0, ''),
(15, 'Da cambiare', 'Da cambiare', 'Gia', 'ginna3@edu.ti.ch', 2, '');

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
(62, '2020-11-11 06:04:15', 'M104', '2020-11-10', 'All Day', 'Test DB', 'Schema ER, schema logico,...', 2, 1, 2, 0, 10),
(25, '2020-10-10 20:00:00', 'Tedesco', '2020-11-24', '1 Ora', 'Test tede', 'Da definire lettura o ascolto probabile', 2, 1, 0, 0, 26),
(26, '2020-10-10 20:00:00', 'Tedesco', '2020-12-15', '1 Ora', 'Test tede', 'Interrogazione orale ', 2, 1, 0, 0, 26),
(68, '2020-10-29 13:16:06', 'Fisica', '2020-12-15', '', 'test', 'awd', 2, 1, 0, 0, 8),
(66, '2020-10-29 13:15:12', 'Fisica', '2020-11-17', '', 'test', 'asd', 2, 1, 0, 0, 8),
(39, '2020-10-24 07:08:26', 'FISE', '2020-11-10', '1 Ora', 'Test su fascicolo', 'Tutto quello fatto in classe l''ultima volta', 2, 1, 2, 0, 10),
(67, '2020-10-29 13:15:40', 'Fisica', '2020-12-03', '', 'test', 'asd', 2, 1, 0, 0, 8),
(57, '2020-10-20 11:21:57', 'Ingle', '2020-12-15', 'Mattina', 'test ingle', 'argomenti non disponibili ', 1, 1, 1, 0, 10);

-- --------------------------------------------------------

--
-- Struttura della tabella `giorno`
--

CREATE TABLE IF NOT EXISTS `giorno` (
  `id` int(11) NOT NULL,
  `day` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `giorno`
--

INSERT INTO `giorno` (`id`, `day`) VALUES
(1, 'Lunedì'),
(2, 'Martedì'),
(3, 'Mercoledì'),
(4, 'Giovedì'),
(5, 'Venerdì');

-- --------------------------------------------------------

--
-- Struttura della tabella `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `roleid` tinyint(4) DEFAULT NULL,
  `matu` tinyint(4) NOT NULL,
  `isActive` tinyint(4) DEFAULT '0',
  `qta` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=13 ;

--
-- Dump dei dati per la tabella `login`
--

INSERT INTO `login` (`id`, `name`, `lname`, `email`, `username`, `password`, `roleid`, `matu`, `isActive`, `qta`, `created_at`, `updated_at`) VALUES
(5, 'Matteo', 'Ruggeri', 'matteoruggeri1234@gmail.com', 'Mattè', 'cd07dad99aba4322d4a62bad935298b1f8abf0bc', 1, 0, 0, 0, '2020-09-30 16:57:17', '2020-09-30 16:57:17'),
(7, 'Angelo', 'Rigoni', 'base@gmail.com', 'base', '329248a63e57d8194f49a7e4436c82fb294ce32b', 1, 0, 0, 0, '2020-10-01 15:21:16', '2020-10-01 15:21:16'),
(8, 'Simon', 'Maggini', 'simonmaggini@gmail.com', 'saphitv', '36eabef7ea1f83a7531170596b6b266c1ef883b3', 1, 0, 0, 0, '2020-10-03 10:00:17', '2020-10-03 10:00:17'),
(10, 'Angelo', 'Rigoni', 'angelo.rigoni05@gmail.com', 'eclipse', 'cbbe937b8ac3d664b03dc107e6c6b5c4e4a062e5', 1, 1, 0, 0, '2020-10-05 08:22:32', '2020-10-05 08:22:32'),
(12, 'Barbara', 'Rigoni', 'greenline_2456@bluewin.ch', 'Barb70', 'e4750141a786c6bccec71d1171855ed300e47638', 1, 1, 0, 0, '2020-10-08 18:39:59', '2020-10-08 18:39:59');

-- --------------------------------------------------------

--
-- Struttura della tabella `materie`
--

CREATE TABLE IF NOT EXISTS `materie` (
  `id` int(11) NOT NULL,
  `mat` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `materie`
--

INSERT INTO `materie` (`id`, `mat`) VALUES
(1, 'M100'),
(2, 'M104'),
(3, 'M114'),
(4, 'M117'),
(5, 'M123'),
(6, 'M213'),
(7, 'M214'),
(8, 'M403'),
(9, 'M404'),
(10, 'M431'),
(11, 'ITA'),
(12, 'TEDE'),
(13, 'INGLE'),
(14, 'FISE'),
(15, 'FIS2'),
(16, 'EA'),
(17, 'ECD'),
(18, 'APPR'),
(19, 'EF'),
(20, 'MATE'),
(21, 'STO');

-- --------------------------------------------------------

--
-- Struttura della tabella `moderatori`
--

CREATE TABLE IF NOT EXISTS `moderatori` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `roleid` tinyint(4) DEFAULT NULL,
  `isActive` tinyint(4) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=27 ;

--
-- Dump dei dati per la tabella `moderatori`
--

INSERT INTO `moderatori` (`id`, `name`, `lname`, `email`, `username`, `password`, `roleid`, `isActive`, `created_at`, `updated_at`) VALUES
(25, 'prova', 'prova', 'prova@gmail.com', 'prova', 'bced2dcac84908cac0c328008c7bb6f66f8ab3cf', 2, 0, '2020-09-16 18:46:34', '2020-09-16 18:46:34'),
(26, 'Peova', 'Peova', 'provalo@gmail.com', 'Provola', 'bced2dcac84908cac0c328008c7bb6f66f8ab3cf', 2, 1, '2020-09-17 07:55:35', '2020-09-17 07:55:35');

-- --------------------------------------------------------

--
-- Struttura della tabella `oss`
--

CREATE TABLE IF NOT EXISTS `oss` (
  `id` int(11) NOT NULL,
  `blocco` text NOT NULL,
  `sig_doc` varchar(25) NOT NULL,
  `materia` varchar(100) NOT NULL,
  `data` date NOT NULL,
  `text` text NOT NULL,
  `id_writter` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `oss`
--

INSERT INTO `oss` (`id`, `blocco`, `sig_doc`, `materia`, `data`, `text`, `id_writter`) VALUES
(1, 'D', 'Cas', 'M431', '2020-09-29', '', 1),
(2, 'C', 'For', 'ITA', '2020-09-24', '2', 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `plus`
--

CREATE TABLE IF NOT EXISTS `plus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `day` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_events` int(11) NOT NULL,
  `tag` text NOT NULL,
  `idate` date NOT NULL,
  `hschool` varchar(25) NOT NULL,
  `ename` text NOT NULL,
  `descr` text NOT NULL,
  `prio` tinyint(4) NOT NULL,
  `vis` tinyint(4) NOT NULL,
  `matu` tinyint(4) NOT NULL,
  `id_plus` int(11) NOT NULL,
  `checking` tinyint(4) NOT NULL,
  `id_writter` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=30 ;

--
-- Dump dei dati per la tabella `plus`
--

INSERT INTO `plus` (`id`, `day`, `id_events`, `tag`, `idate`, `hschool`, `ename`, `descr`, `prio`, `vis`, `matu`, `id_plus`, `checking`, `id_writter`) VALUES
(28, '2020-10-30 14:04:51', 56, 'Ingle', '2020-11-26', 'Mattina', 'test ingle', 'argomenti non disponibili ', 2, 1, 1, 10, 0, 10),
(27, '2020-10-30 14:04:49', 69, 'M214', '2020-11-20', '12:15', 'Guida OneNote', 'Consegnare guida di OneNote svolta in classe', 2, 1, 2, 10, 0, 10),
(17, '2020-10-19 11:45:01', 13, 'Matematica', '2020-10-20', '1 Ora', 'Test Mate', 'Argomenti non disponibili', 2, 1, 0, 8, 0, 27),
(18, '2020-10-19 11:45:03', 24, 'Tedesco', '2020-10-20', '1 Ora', 'Test tede', 'Coniugazione verbi, struttura frase, wfragen, declinazione articoli determinativo indeterminativo, numeri, accusativo dativo nominativo, declinazione articoli a memoria, pronomi possessivi', 2, 1, 0, 8, 0, 26),
(19, '2020-10-19 11:45:05', 32, 'M214', '2020-10-21', '4 Ora', 'Test Word', 'Lezioni Word per la guida utente', 2, 1, 2, 8, 0, 6),
(20, '2020-10-19 11:45:10', 48, 'Storia', '2020-10-26', '', 'Test storia illuminismo', 'Sapere schede illuminismo   vocaboli ', 2, 1, 0, 8, 0, 8),
(29, '2020-11-06 09:12:55', 70, 'Ingle', '2020-11-17', '', 'Scheda halloween', 'Fare i nomi al plurale', 4, 1, 1, 10, 0, 10);

-- --------------------------------------------------------

--
-- Struttura della tabella `priority`
--

CREATE TABLE IF NOT EXISTS `priority` (
  `id` int(11) NOT NULL,
  `det` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `priority`
--

INSERT INTO `priority` (`id`, `det`) VALUES
(1, 'Test semestrale'),
(2, 'Test'),
(3, 'Compito con valutazione / lavoro di gruppo'),
(4, 'Compito'),
(5, 'Priorità esterna');

-- --------------------------------------------------------

--
-- Struttura della tabella `sessions`
--

CREATE TABLE IF NOT EXISTS `sessions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sessions_userid` varchar(256) NOT NULL,
  `sessions_name` varchar(256) NOT NULL,
  `sessions_hash` varchar(256) NOT NULL,
  `session_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dump dei dati per la tabella `sessions`
--

INSERT INTO `sessions` (`id`, `sessions_userid`, `sessions_name`, `sessions_hash`, `session_date`) VALUES
(4, '23c2170e341809f9d23ceba4c6102ecffef6148bef87fc96d3826ed40578b5d05f1f0b8395e42f24c67eb553745b5a65bf7329e7fff82d77b0cfe23a880b8658', '6a63a54d735a6c314d4e3297ac290f7ab1bea8c559742e8df6c3e1978bac9f0dd9e28b675cb73ca8ab29238a7a4e5c23d0f47d7e7b631b7f4895feb230cc64f4', '8fb29448faee18b656030e8f5a8b9e9a695900f36a3b7d7ebb0d9d51e06c8569d81a55e39b481cf50546d697e7bde1715aa6badede8ddc801c739777be77f166', '2020-10-23 12:20:34'),
(3, '23c2170e341809f9d23ceba4c6102ecffef6148bef87fc96d3826ed40578b5d05f1f0b8395e42f24c67eb553745b5a65bf7329e7fff82d77b0cfe23a880b8658', '6a63a54d735a6c314d4e3297ac290f7ab1bea8c559742e8df6c3e1978bac9f0dd9e28b675cb73ca8ab29238a7a4e5c23d0f47d7e7b631b7f4895feb230cc64f4', '8fb29448faee18b656030e8f5a8b9e9a695900f36a3b7d7ebb0d9d51e06c8569d81a55e39b481cf50546d697e7bde1715aa6badede8ddc801c739777be77f166', '2020-10-23 12:20:33'),
(5, '23c2170e341809f9d23ceba4c6102ecffef6148bef87fc96d3826ed40578b5d05f1f0b8395e42f24c67eb553745b5a65bf7329e7fff82d77b0cfe23a880b8658', '6a63a54d735a6c314d4e3297ac290f7ab1bea8c559742e8df6c3e1978bac9f0dd9e28b675cb73ca8ab29238a7a4e5c23d0f47d7e7b631b7f4895feb230cc64f4', '8fb29448faee18b656030e8f5a8b9e9a695900f36a3b7d7ebb0d9d51e06c8569d81a55e39b481cf50546d697e7bde1715aa6badede8ddc801c739777be77f166', '2020-10-23 12:20:34'),
(6, '23c2170e341809f9d23ceba4c6102ecffef6148bef87fc96d3826ed40578b5d05f1f0b8395e42f24c67eb553745b5a65bf7329e7fff82d77b0cfe23a880b8658', '6a63a54d735a6c314d4e3297ac290f7ab1bea8c559742e8df6c3e1978bac9f0dd9e28b675cb73ca8ab29238a7a4e5c23d0f47d7e7b631b7f4895feb230cc64f4', '8fb29448faee18b656030e8f5a8b9e9a695900f36a3b7d7ebb0d9d51e06c8569d81a55e39b481cf50546d697e7bde1715aa6badede8ddc801c739777be77f166', '2020-10-23 12:20:35'),
(7, '23c2170e341809f9d23ceba4c6102ecffef6148bef87fc96d3826ed40578b5d05f1f0b8395e42f24c67eb553745b5a65bf7329e7fff82d77b0cfe23a880b8658', '6a63a54d735a6c314d4e3297ac290f7ab1bea8c559742e8df6c3e1978bac9f0dd9e28b675cb73ca8ab29238a7a4e5c23d0f47d7e7b631b7f4895feb230cc64f4', '8fb29448faee18b656030e8f5a8b9e9a695900f36a3b7d7ebb0d9d51e06c8569d81a55e39b481cf50546d697e7bde1715aa6badede8ddc801c739777be77f166', '2020-10-23 12:20:35'),
(8, '23c2170e341809f9d23ceba4c6102ecffef6148bef87fc96d3826ed40578b5d05f1f0b8395e42f24c67eb553745b5a65bf7329e7fff82d77b0cfe23a880b8658', '6a63a54d735a6c314d4e3297ac290f7ab1bea8c559742e8df6c3e1978bac9f0dd9e28b675cb73ca8ab29238a7a4e5c23d0f47d7e7b631b7f4895feb230cc64f4', '8fb29448faee18b656030e8f5a8b9e9a695900f36a3b7d7ebb0d9d51e06c8569d81a55e39b481cf50546d697e7bde1715aa6badede8ddc801c739777be77f166', '2020-10-23 12:20:36'),
(9, '23c2170e341809f9d23ceba4c6102ecffef6148bef87fc96d3826ed40578b5d05f1f0b8395e42f24c67eb553745b5a65bf7329e7fff82d77b0cfe23a880b8658', '6a63a54d735a6c314d4e3297ac290f7ab1bea8c559742e8df6c3e1978bac9f0dd9e28b675cb73ca8ab29238a7a4e5c23d0f47d7e7b631b7f4895feb230cc64f4', '8fb29448faee18b656030e8f5a8b9e9a695900f36a3b7d7ebb0d9d51e06c8569d81a55e39b481cf50546d697e7bde1715aa6badede8ddc801c739777be77f166', '2020-10-23 12:20:37'),
(11, '23c2170e341809f9d23ceba4c6102ecffef6148bef87fc96d3826ed40578b5d05f1f0b8395e42f24c67eb553745b5a65bf7329e7fff82d77b0cfe23a880b8658', '6a63a54d735a6c314d4e3297ac290f7ab1bea8c559742e8df6c3e1978bac9f0dd9e28b675cb73ca8ab29238a7a4e5c23d0f47d7e7b631b7f4895feb230cc64f4', '989aba441a5dc5820bffdf20023961687cff3dccda30f06c3ea9a894c63726e10c8a284495cfebbe4734fc046c6f6c34d3d66054d50b4716834ebac6bfa5d3c4', '2020-11-08 09:13:59'),
(12, '23c2170e341809f9d23ceba4c6102ecffef6148bef87fc96d3826ed40578b5d05f1f0b8395e42f24c67eb553745b5a65bf7329e7fff82d77b0cfe23a880b8658', '6a63a54d735a6c314d4e3297ac290f7ab1bea8c559742e8df6c3e1978bac9f0dd9e28b675cb73ca8ab29238a7a4e5c23d0f47d7e7b631b7f4895feb230cc64f4', '989aba441a5dc5820bffdf20023961687cff3dccda30f06c3ea9a894c63726e10c8a284495cfebbe4734fc046c6f6c34d3d66054d50b4716834ebac6bfa5d3c4', '2020-11-08 09:14:01'),
(13, '23c2170e341809f9d23ceba4c6102ecffef6148bef87fc96d3826ed40578b5d05f1f0b8395e42f24c67eb553745b5a65bf7329e7fff82d77b0cfe23a880b8658', '6a63a54d735a6c314d4e3297ac290f7ab1bea8c559742e8df6c3e1978bac9f0dd9e28b675cb73ca8ab29238a7a4e5c23d0f47d7e7b631b7f4895feb230cc64f4', '989aba441a5dc5820bffdf20023961687cff3dccda30f06c3ea9a894c63726e10c8a284495cfebbe4734fc046c6f6c34d3d66054d50b4716834ebac6bfa5d3c4', '2020-11-08 09:14:02');

-- --------------------------------------------------------

--
-- Struttura della tabella `sigle`
--

CREATE TABLE IF NOT EXISTS `sigle` (
  `id` int(11) NOT NULL,
  `sig` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `sigle`
--

INSERT INTO `sigle` (`id`, `sig`) VALUES
(1, 'GeG'),
(2, 'FeM'),
(3, 'ScL'),
(4, 'Eur'),
(5, 'Biz'),
(6, 'ReR'),
(7, 'For'),
(8, 'EsR'),
(9, 'PiT'),
(10, 'ScD'),
(11, 'IaO'),
(12, 'Ble'),
(13, 'DeR'),
(14, 'DeN'),
(15, 'Gia'),
(16, ''),
(17, ''),
(18, ''),
(19, ''),
(21, 'Cas');

-- --------------------------------------------------------

--
-- Struttura della tabella `tbl_roles`
--

CREATE TABLE IF NOT EXISTS `tbl_roles` (
  `id` int(11) NOT NULL COMMENT 'role_id',
  `role` varchar(255) DEFAULT NULL COMMENT 'role_text'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `tbl_roles`
--

INSERT INTO `tbl_roles` (`id`, `role`) VALUES
(1, 'Admin'),
(2, 'Editor'),
(3, 'User');

-- --------------------------------------------------------

--
-- Struttura della tabella `tips`
--

CREATE TABLE IF NOT EXISTS `tips` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `vis` text NOT NULL,
  `matu` tinyint(4) NOT NULL,
  `id_writter` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=28 ;

--
-- Dump dei dati per la tabella `tips`
--

INSERT INTO `tips` (`id`, `title`, `vis`, `matu`, `id_writter`) VALUES
(1, 'M114', '1', 2, 27),
(2, 'Matematica', '1', 0, 27),
(3, 'Fisica', '1', 0, 27),
(4, 'M213', '1', 2, 27),
(5, 'M403', '1', 2, 27),
(6, 'Inglese', '1', 0, 27),
(7, 'Tedesco', '1', 0, 27),
(8, 'Affari privati', '1', 2, 27),
(9, 'Storia', '1', 0, 27),
(11, 'M117', '1', 2, 27),
(14, 'Matematica Riva', '2', 2, 6),
(15, 'M214', '1', 2, 6),
(17, 'FISE', '1', 2, 6),
(18, 'Uccelli acquatici dei laghi, degli stagni e dei fiumi', '2', 1, 12),
(22, 'FIS2', '1', 2, 10),
(21, 'CG', '1', 1, 10),
(23, 'Mate', '1', 1, 10),
(24, 'Ingle', '1', 1, 10),
(25, 'Fisica', '1', 1, 10),
(26, 'EA', '1', 2, 10),
(27, 'M104', '1', 2, 10);

-- --------------------------------------------------------

--
-- Struttura della tabella `upload`
--

CREATE TABLE IF NOT EXISTS `upload` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `dir` varchar(255) NOT NULL,
  `docs` varchar(255) NOT NULL,
  `matu` tinyint(4) NOT NULL,
  `vis` tinyint(4) NOT NULL,
  `id_writter` tinyint(4) NOT NULL,
  `format` text NOT NULL,
  `load_at` date NOT NULL,
  `date` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `visibility`
--

CREATE TABLE IF NOT EXISTS `visibility` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vis` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=4 ;

--
-- Dump dei dati per la tabella `visibility`
--

INSERT INTO `visibility` (`id`, `vis`) VALUES
(1, 'Pubblico'),
(2, 'Privato');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
