-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 09 okt 2023 om 09:40
-- Serverversie: 8.0.28
-- PHP-versie: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vote`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `party_leaders`
--

CREATE TABLE `party_leaders` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `party_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Gegevens worden geëxporteerd voor tabel `party_leaders`
--

INSERT INTO `party_leaders` (`id`, `name`, `party_name`) VALUES
(1, 'Geert Wilders', 'PVV'),
(2, 'Mark Rutte', 'VVD'),
(3, 'Lodewijk Asscher', 'PvdA'),
(4, 'Thierry Baudet', 'FVD'),
(5, 'Jesse Klaver', 'GroenLinks'),
(6, 'Sigrid Kaag', 'D66'),
(7, 'Lilian Marijnissen', 'SP'),
(8, 'Esther Ouwehand', 'Partij voor de Dieren'),
(9, 'Gert-Jan Segers', 'ChristenUnie'),
(10, 'Kees van der Staaij', 'SGP'),
(11, 'Rob Jetten', 'D66');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `political_parties`
--

CREATE TABLE `political_parties` (
  `id` int NOT NULL,
  `party_name` varchar(255) NOT NULL,
  `description` text,
  `image_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Gegevens worden geëxporteerd voor tabel `political_parties`
--

INSERT INTO `political_parties` (`id`, `party_name`, `description`, `image_path`) VALUES
(1, 'PVV', 'De Partij voor de Vrijheid (PVV) is een Nederlandse politieke partij die in 2006 werd opgericht door Geert Wilders. De partij staat bekend om haar standpunten met betrekking tot immigratie, integratie en de islam. De PVV pleit voor strengere immigratiewetten, het beperken van de invloed van de Europese Unie, en het handhaven van traditionele Nederlandse waarden en cultuur.\r\n\r\nKenmerkend voor de PVV is het streven naar een beperkte rol van de overheid, lagere belastingen, en een strengere aanpak van criminaliteit en terrorisme. De partij staat ook bekend om haar standpunt ten aanzien van de islam, waarbij ze pleit voor beperkingen op de bouw van moskeeën en het verbieden van bepaalde islamitische uitingen, zoals gezichtsbedekkende kleding.\r\n\r\nDe PVV heeft in Nederland wisselende successen behaald bij verkiezingen, en Geert Wilders is de belangrijkste speler binnen de partij. De partij is controversieel en heeft zowel voor- als tegenstanders vanwege haar standpunten over immigratie en islam. PVV is een partij die zichzelf positioneert als een stem voor behoud van de Nederlandse identiteit en cultuur, met een focus op nationale soevereiniteit en veiligheid.', 'https://th.bing.com/th/id/R.70ac2768540decfc7ee630771922ab43?rik=v%2b7PabnmFTW5dg&riu=http%3a%2f%2fimages.huffingtonpost.com%2f2016-02-22-1456168883-6503776-PVV.jpg&ehk=8LExuKsIXYn8aJpW5AAWkMpOVyVnkK5NY7AEzR%2bmIaY%3d&risl=&pid=ImgRaw&r=0');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password_hash`) VALUES
(1, '222', '122s@gmail.nl', '$2y$10$g3nBejNSOCm/JJ6xYZhe0.1q2tfcY7XRF3oj9NOEk.wzK4SQ8eT1u'),
(2, '11111', '1111@11.com', '1111'),
(3, '11111', '1111@11.com', '1111'),
(4, 'toby', 'sveng@mail.com', '$2y$10$7S2yVldEjuYiRjAQFuxow.TB8t6b.Lk8DzIUVofv5iB65grJjpzsq');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `votes`
--

CREATE TABLE `votes` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `candidate_id` int NOT NULL,
  `vote_timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Gegevens worden geëxporteerd voor tabel `votes`
--

INSERT INTO `votes` (`id`, `user_id`, `candidate_id`, `vote_timestamp`) VALUES
(1, 1, 1, '2023-10-05 14:29:34'),
(2, 1, 1, '2023-10-05 14:29:39'),
(3, 1, 1, '2023-10-05 14:34:03'),
(4, 1, 1, '2023-10-05 14:34:10'),
(5, 1, 1, '2023-10-05 14:36:02'),
(6, 1, 1, '2023-10-05 14:36:52'),
(7, 4, 1, '2023-10-05 14:50:27');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `party_leaders`
--
ALTER TABLE `party_leaders`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `political_parties`
--
ALTER TABLE `political_parties`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `party_leaders`
--
ALTER TABLE `party_leaders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT voor een tabel `political_parties`
--
ALTER TABLE `political_parties`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT voor een tabel `votes`
--
ALTER TABLE `votes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
