-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 20. Okt 2020 um 18:36
-- Server-Version: 10.4.14-MariaDB
-- PHP-Version: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `my_organizeriec`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `upload`
--

CREATE TABLE `upload` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `dir` varchar(255) NOT NULL,
  `docs` varchar(255) NOT NULL,
  `password` varchar(5000) NOT NULL,
  `matu` tinyint(4) NOT NULL,
  `vis` tinyint(4) NOT NULL,
  `id_writter` tinyint(4) NOT NULL,
  `format` text NOT NULL,
  `load_at` date NOT NULL DEFAULT current_timestamp(),
  `date` time NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `upload`
--

INSERT INTO `upload` (`id`, `title`, `dir`, `docs`, `password`, `matu`, `vis`, `id_writter`, `format`, `load_at`, `date`) VALUES
(1, 'Guida OneNote', './uploads/document', '8738-Guida OneNote.docx', '', 1, 2, 2, 'docx', '2020-10-19', '12:16:04'),
(2, 'Prova PopUp', './uploads/document', '5797-Word 3.docx', '', 1, 1, 2, 'pptx', '2020-10-18', '13:12:35'),
(4, '', './uploads/document', '8339-upload.sql', '', 1, 2, 2, 'pro', '2020-10-20', '20:45:09');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `upload`
--
ALTER TABLE `upload`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `upload`
--
ALTER TABLE `upload`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
