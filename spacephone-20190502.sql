-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Värd: 127.0.0.1
-- Tid vid skapande: 02 maj 2019 kl 23:23
-- Serverversion: 10.1.38-MariaDB
-- PHP-version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databas: `spacephone`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `kategorier`
--

CREATE TABLE `kategorier` (
  `kat_id` int(8) NOT NULL,
  `kat_namn` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  `kat_beskrivning` varchar(255) COLLATE utf8_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumpning av Data i tabell `kategorier`
--

INSERT INTO `kategorier` (`kat_id`, `kat_namn`, `kat_beskrivning`) VALUES
(1, 'Webbprogrammering', 'Detta forum kommer du posta om programmering'),
(4, 'IT', 'Lite roligt'),
(5, 'Snor', 'Test'),
(6, 'André', 'Disskusioner om hur bra andré är!'),
(8, 'Skola', 'En kategori om skolan'),
(9, 'Oneplus 6T', 'En diskussion om oneplus 6T');

-- --------------------------------------------------------

--
-- Tabellstruktur `kommentarer`
--

CREATE TABLE `kommentarer` (
  `post_id` int(8) NOT NULL,
  `post_innehåll` text COLLATE utf8_swedish_ci NOT NULL,
  `post_datum` datetime NOT NULL,
  `post_ämne` int(8) NOT NULL,
  `post_av` varchar(50) COLLATE utf8_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumpning av Data i tabell `kommentarer`
--

INSERT INTO `kommentarer` (`post_id`, `post_innehåll`, `post_datum`, `post_ämne`, `post_av`) VALUES
(97630302, 'Test av en kommentar!', '2019-05-02 14:29:28', 0, 'André'),
(97630302, 'Test av en kommentar!', '2019-05-02 14:29:31', 0, 'André'),
(0, 'Test av en kommentar!', '2019-05-02 14:30:11', 0, 'André'),
(0, 'Test av en kommentar!', '2019-05-02 14:32:04', 0, 'André'),
(97630302, 'En till liten kommentar', '2019-05-02 14:32:16', 0, 'André'),
(97630302, '23123', '2019-05-02 14:54:41', 0, 'André'),
(1875701002, 'Jag tror att jag tror på det!', '2019-05-02 23:19:41', 0, 'André'),
(1146880613, 'Jajjemään!', '2019-05-02 23:20:36', 0, 'André');

-- --------------------------------------------------------

--
-- Tabellstruktur `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_datum` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `order_namn` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellstruktur `order_saker`
--

CREATE TABLE `order_saker` (
  `order_id` int(11) NOT NULL,
  `produkt_id` int(11) NOT NULL,
  `antal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellstruktur `posts`
--

CREATE TABLE `posts` (
  `post_id` int(8) NOT NULL,
  `post_innehåll` text COLLATE utf8_swedish_ci NOT NULL,
  `post_datum` datetime NOT NULL,
  `post_ämne` int(8) NOT NULL,
  `post_av` varchar(50) COLLATE utf8_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumpning av Data i tabell `posts`
--

INSERT INTO `posts` (`post_id`, `post_innehåll`, `post_datum`, `post_ämne`, `post_av`) VALUES
(7, 'Jag hatar matte, hjälp mig att få motivation!', '2019-04-10 14:01:25', 8, 'André'),
(8, 'Jag vill lära mig webbserver', '2019-04-10 14:03:20', 1, 'Jan'),
(9, 'Detta är mitt inlägg i Webbprogrammering', '2019-04-28 20:04:47', 1, 'André'),
(97630302, 'Detta är mitt inlägg i Webbprogrammering', '2019-04-28 20:19:49', 1, 'André'),
(1146880613, '123', '2019-04-28 20:20:00', 1, 'André'),
(1875701002, 'Tro det eller ej!', '2019-04-28 21:07:41', 1, 'André'),
(691985374, 'japp det är sant\r\n', '2019-04-29 20:33:30', 6, 'André');

-- --------------------------------------------------------

--
-- Tabellstruktur `produkter`
--

CREATE TABLE `produkter` (
  `produkt_id` int(11) NOT NULL,
  `produkt_namn` varchar(255) NOT NULL,
  `produkt_bild` varchar(255) DEFAULT NULL,
  `produkt_beskrivning` text,
  `produkt_pris` decimal(10,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumpning av Data i tabell `produkter`
--

INSERT INTO `produkter` (`produkt_id`, `produkt_namn`, `produkt_bild`, `produkt_beskrivning`, `produkt_pris`) VALUES
(1, 'SpacePhone Light', 'SpacePhone_Light.jpg', 'En billigare modell men fortfarande extrem för priset.', '5000.00'),
(2, 'SpacePhone', 'SpacePhone.jpg', 'Standardmodellen där du får lite av allt.', '8000.00'),
(3, 'SpacePhone Ultra', 'SpacePhone_Ultra.jpg', 'Detta är en lyxmodell där allting ingår, Den är till för dig som gillar lyx och prestanda.', '15000.00'),
(4, 'Laddningskabel', 'Laddning.jpg', 'En USB-C laddningskabel med transformator.', '299.00'),
(5, 'Hörlurar', 'Earphones.jpg', 'Helt vanliga marshall major 2 wireless.', '799.00'),
(6, 'Taco', 'Taco.jpg', 'Det ingår alltid en stor taco om du köper en SpacePhone telefon.', '39.00');

-- --------------------------------------------------------

--
-- Tabellstruktur `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `telefon` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `skapad` datetime NOT NULL,
  `changed` datetime NOT NULL,
  `status` enum('1','0') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumpning av Data i tabell `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `telefon`, `skapad`, `changed`, `status`) VALUES
(1, 'André', 'Sturesson', 'multispelare@gmail.com', '6647c2531da65b853cb4e5aca9afce818c1cf4c5e4dfe8440c0eab63c3da24d9', '0735357617', '2019-03-10 12:23:11', '2019-04-28 19:31:35', '1'),
(2, 'Alexander', 'Wa\'', 'alle@hoes.se', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', '12341234', '2019-04-10 13:42:41', '2019-04-10 13:42:41', '0'),
(3, 'Jan', 'åke', 'jan@sak.se', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', '1245433', '2019-04-10 14:02:52', '2019-04-10 14:02:52', '0');

-- --------------------------------------------------------

--
-- Tabellstruktur `ämne`
--

CREATE TABLE `ämne` (
  `topic_id` int(8) NOT NULL,
  `topic_subject` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  `topic_datum` datetime NOT NULL,
  `topic_kat` int(8) NOT NULL,
  `topic_av` varchar(25) COLLATE utf8_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumpning av Data i tabell `ämne`
--

INSERT INTO `ämne` (`topic_id`, `topic_subject`, `topic_datum`, `topic_kat`, `topic_av`) VALUES
(97630302, 'Mitt inlägg i Webbprogrammering', '2019-04-28 20:19:49', 1, 'André'),
(691985374, 'Andre är kung', '2019-04-29 20:33:30', 6, 'André'),
(1146880613, 'Test01', '2019-04-28 20:20:00', 1, 'André'),
(1875701002, 'Jag gillar faktiskt björnar', '2019-04-28 21:07:41', 1, 'André');

--
-- Index för dumpade tabeller
--

--
-- Index för tabell `kategorier`
--
ALTER TABLE `kategorier`
  ADD PRIMARY KEY (`kat_id`),
  ADD UNIQUE KEY `kat_namn_unique` (`kat_namn`);

--
-- Index för tabell `kommentarer`
--
ALTER TABLE `kommentarer`
  ADD KEY `post_id` (`post_id`);

--
-- Index för tabell `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `namn` (`order_namn`),
  ADD KEY `email` (`email`),
  ADD KEY `order_datum` (`order_datum`);

--
-- Index för tabell `order_saker`
--
ALTER TABLE `order_saker`
  ADD PRIMARY KEY (`order_id`,`produkt_id`);

--
-- Index för tabell `posts`
--
ALTER TABLE `posts`
  ADD KEY `post_id` (`post_id`);

--
-- Index för tabell `produkter`
--
ALTER TABLE `produkter`
  ADD PRIMARY KEY (`produkt_id`),
  ADD KEY `name` (`produkt_namn`);

--
-- Index för tabell `users`
--
ALTER TABLE `users`
  ADD KEY `id` (`id`) USING BTREE;

--
-- Index för tabell `ämne`
--
ALTER TABLE `ämne`
  ADD PRIMARY KEY (`topic_id`),
  ADD KEY `topic_kat` (`topic_kat`);

--
-- AUTO_INCREMENT för dumpade tabeller
--

--
-- AUTO_INCREMENT för tabell `kategorier`
--
ALTER TABLE `kategorier`
  MODIFY `kat_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT för tabell `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT för tabell `produkter`
--
ALTER TABLE `produkter`
  MODIFY `produkt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT för tabell `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restriktioner för dumpade tabeller
--

--
-- Restriktioner för tabell `order_saker`
--
ALTER TABLE `order_saker`
  ADD CONSTRAINT `order_saker_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`);

--
-- Restriktioner för tabell `ämne`
--
ALTER TABLE `ämne`
  ADD CONSTRAINT `ämne_ibfk_1` FOREIGN KEY (`topic_kat`) REFERENCES `kategorier` (`kat_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ämne_ibfk_2` FOREIGN KEY (`topic_kat`) REFERENCES `kategorier` (`kat_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
