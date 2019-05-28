-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Värd: 127.0.0.1
-- Tid vid skapande: 28 maj 2019 kl 18:44
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
(9, 'Oneplus 6T', 'En diskussion om oneplus 6T'),
(10, 'David', 'En kategori om david!'),
(11, 'Annat', 'Allt annat\r\n');

-- --------------------------------------------------------

--
-- Tabellstruktur `kommentarer`
--

CREATE TABLE `kommentarer` (
  `post_id` int(8) NOT NULL,
  `post_innehåll` text COLLATE utf8_swedish_ci NOT NULL,
  `post_datum` datetime NOT NULL,
  `user_id` int(8) NOT NULL,
  `post_av` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  `kommentar_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumpning av Data i tabell `kommentarer`
--

INSERT INTO `kommentarer` (`post_id`, `post_innehåll`, `post_datum`, `user_id`, `post_av`, `kommentar_id`) VALUES
(97630302, 'Test av en kommentar!', '2019-05-02 14:29:28', 1, 'André', 1),
(97630302, 'Då ska vi se.', '2019-05-05 19:55:31', 8, 'André ', 14),
(97630302, 'En till kommentar', '2019-05-12 13:57:33', 9, 'Kurt', 15),
(97630302, 'Jag igen', '2019-05-12 13:58:06', 8, 'Olof', 16),
(97630302, 'Undra om jag kan posta en till kommentar?', '2019-05-12 14:01:06', 8, 'Olof', 17),
(1255747522, 'Helt sjuka specifikationer!', '2019-05-12 14:11:53', 8, 'Olof', 18),
(1255747522, 'Ja jag håller med! Bra post!', '2019-05-12 14:12:13', 9, 'Kurt', 19),
(97630302, '0', '2019-05-12 14:16:17', 8, 'Olof', 20),
(97630302, 'SELECT schema_name FROM information_schema.schemata; — for MySQL >= v5.0 SELECT distinct(db) FROM mysql.db — priv', '2019-05-12 14:18:50', 8, 'Olof', 21),
(97630302, '\"SELECT schema_name FROM information_schema.schemata; — for MySQL >= v5.0 SELECT distinct(db) FROM mysql.db — priv\"', '2019-05-12 14:19:08', 8, 'Olof', 22),
(97630302, 'SHOW FULL COLUMNS FROM users;', '2019-05-12 14:19:38', 8, 'Olof', 23),
(97630302, 'gsdsef', '2019-05-12 14:25:44', 8, 'Olof', 24),
(1255747522, 'japp', '2019-05-12 14:26:07', 8, 'Olof', 25),
(97630302, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec gravida lorem sed neque lobortis sagittis. Phasellus id odio eget erat bibendum sodales eget viverra felis. Aliquam condimentum pulvinar sapien at porttitor. Praesent et enim lectus. Integer vel felis dictum, ultrices tellus at, laoreet lectus. Duis convallis posuere nunc quis placerat. Nulla imperdiet pharetra tellus sed sollicitudin. Praesent sit amet lorem ultricies, dictum augue sit amet, faucibus mauris. Nunc sodales auctor dolor. Mauris tristique tortor eleifend tincidunt hendrerit. Donec hendrerit blandit quam, in elementum nisi egestas at.  Aliquam vel venenatis eros. Integer vitae volutpat augue. In interdum mauris semper auctor lobortis. Nunc lobortis at orci et sodales. In dapibus dolor pulvinar, auctor justo a, dictum mauris. Nullam ac iaculis eros. Aenean consectetur purus orci, vel scelerisque enim lacinia nec. Maecenas bibendum, turpis at luctus tempus, neque ligula viverra neque, vel ultrices ex metus eu ipsum.  Ut ut arcu id nisl posuere placerat tempus sit amet nunc. Donec tincidunt quam dui, id tincidunt tortor suscipit in. Sed vel ex tempor, interdum sapien in, varius metus. Fusce tellus justo, maximus tempus odio non, facilisis mattis nibh. Nam a pretium risus. Nam pretium faucibus dui, eget suscipit nunc interdum et. Proin ac blandit nisi, eu volutpat arcu. Donec vel massa sed lectus sollicitudin pharetra. Nullam aliquet sem id nisi tristique, ut mollis erat accumsan.', '2019-05-12 14:39:18', 8, 'Olof', 26),
(97630302, 'asd', '2019-05-12 14:41:26', 8, 'Olof', 27),
(616127131, 'En kommentar', '2019-05-28 18:43:36', 8, 'Olof', 28);

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
  `user_id` int(8) NOT NULL,
  `post_av` varchar(50) COLLATE utf8_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumpning av Data i tabell `posts`
--

INSERT INTO `posts` (`post_id`, `post_innehåll`, `post_datum`, `user_id`, `post_av`) VALUES
(7, 'Jag hatar matte, hjälp mig att få motivation!', '2019-04-10 14:01:25', 8, 'André'),
(8, 'Jag vill lära mig webbserver', '2019-04-10 14:03:20', 1, 'Jan'),
(9, 'Detta är mitt inlägg i Webbprogrammering', '2019-04-28 20:04:47', 1, 'André'),
(97630302, 'Detta är mitt inlägg i Webbprogrammering', '2019-04-28 20:19:49', 1, 'André'),
(1146880613, '123', '2019-04-28 20:20:00', 1, 'André'),
(1875701002, 'Tro det eller ej!', '2019-04-28 21:07:41', 1, 'André'),
(691985374, 'japp det är sant\r\n', '2019-04-29 20:33:30', 6, 'André'),
(433864983, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec tristique erat sed magna facilisis fringilla. Donec suscipit ex ut lectus tempus, vitae rhoncus dolor ultricies. Praesent vitae elit velit. Quisque tellus nisi, hendrerit ut ornare id, auctor sed nibh. Suspendisse posuere porttitor ligula, quis dictum lorem imperdiet eu. Cras feugiat tempor nibh, id feugiat tellus suscipit quis. Nulla facilisi. Praesent non pretium risus. Mauris sollicitudin velit ac ornare rutrum. Sed at efficitur ligula. Vivamus quam nibh, sodales ut convallis quis, facilisis a nibh. Phasellus efficitur venenatis nunc, non laoreet libero efficitur non. Phasellus eu ex sit amet ligula faucibus luctus in et ligula. Donec quis nulla lorem.\r\n\r\nCras at rutrum dolor, at placerat est. Sed velit mauris, consequat nec lectus sit amet, malesuada rutrum elit. Cras at tincidunt ex. Donec nec lorem hendrerit, tincidunt nisi at, lobortis nulla. Donec in porta est. Ut at odio vitae mi commodo pellentesque in ut mi. Maecenas eros lorem, pretium sed odio a, hendrerit hendrerit ligula. Duis egestas pretium odio dictum commodo. Ut at lobortis est. Etiam consectetur nibh quis risus ornare commodo. Vestibulum vitae leo a lacus varius dictum non at risus. Nulla vel mauris imperdiet, cursus lorem in, vulputate quam. Integer convallis, purus in auctor hendrerit, leo elit convallis purus, quis dapibus dui dolor in odio.', '2019-05-05 18:55:46', 8, 'André '),
(1071630961, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec tristique erat sed magna facilisis fringilla. Donec suscipit ex ut lectus tempus, vitae rhoncus dolor ultricies. Praesent vitae elit velit. Quisque tellus nisi, hendrerit ut ornare id, auctor sed nibh. Suspendisse posuere porttitor ligula, quis dictum lorem imperdiet eu. Cras feugiat tempor nibh, id feugiat tellus suscipit quis. Nulla facilisi. Praesent non pretium risus. Mauris sollicitudin velit ac ornare rutrum. Sed at efficitur ligula. Vivamus quam nibh, sodales ut convallis quis, facilisis a nibh. Phasellus efficitur venenatis nunc, non laoreet libero efficitur non. Phasellus eu ex sit amet ligula faucibus luctus in et ligula. Donec quis nulla lorem.\r\n\r\nCras at rutrum dolor, at placerat est. Sed velit mauris, consequat nec lectus sit amet, malesuada rutrum elit. Cras at tincidunt ex. Donec nec lorem hendrerit, tincidunt nisi at, lobortis nulla. Donec in porta est. Ut at odio vitae mi commodo pellentesque in ut mi. Maecenas eros lorem, pretium sed odio a, hendrerit hendrerit ligula. Duis egestas pretium odio dictum commodo. Ut at lobortis est. Etiam consectetur nibh quis risus ornare commodo. Vestibulum vitae leo a lacus varius dictum non at risus. Nulla vel mauris imperdiet, cursus lorem in, vulputate quam. Integer convallis, purus in auctor hendrerit, leo elit convallis purus, quis dapibus dui dolor in odio.', '2019-05-05 18:56:55', 8, 'André '),
(1737914424, '001', '2019-05-05 18:58:36', 8, 'André '),
(166415085, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec tristique erat sed magna facilisis fringilla. Donec suscipit ex ut lectus tempus, vitae rhoncus dolor ultricies. Praesent vitae elit velit. Quisque tellus nisi, hendrerit ut ornare id, auctor sed nibh. Suspendisse posuere porttitor ligula, quis dictum lorem imperdiet eu. Cras feugiat tempor nibh, id feugiat tellus suscipit quis. Nulla facilisi. Praesent non pretium risus. Mauris sollicitudin velit ac ornare rutrum. Sed at efficitur ligula. Vivamus quam nibh, sodales ut convallis quis, facilisis a nibh. Phasellus efficitur venenatis nunc, non laoreet libero efficitur non. Phasellus eu ex sit amet ligula faucibus luctus in et ligula. Donec quis nulla lorem.\r\n\r\nCras at rutrum dolor, at placerat est. Sed velit mauris, consequat nec lectus sit amet, malesuada rutrum elit. Cras at tincidunt ex. Donec nec lorem hendrerit, tincidunt nisi at, lobortis nulla. Donec in porta est. Ut at odio vitae mi commodo pellentesque in ut mi. Maecenas eros lorem, pretium sed odio a, hendrerit hendrerit ligula. Duis egestas pretium odio dictum commodo. Ut at lobortis est. Etiam consectetur nibh quis risus ornare commodo. Vestibulum vitae leo a lacus varius dictum non at risus. Nulla vel mauris imperdiet, cursus lorem in, vulputate quam. Integer convallis, purus in auctor hendrerit, leo elit convallis purus, quis dapibus dui dolor in odio.', '2019-05-05 18:59:07', 8, 'André '),
(1255747522, 'Android 9 Pie with OxygenOS\r\n6.41in OLED, 19.5:9, 2340 x 1080, 402ppi\r\nIn-screen fingerprint sensor with biometric support\r\nQualcomm Snapdragon 845\r\n6/8GB RAM\r\n128/256GB storage\r\n16Mp and 20Mp rear cameras, f/1.7, support for 4K video at 60fps\r\n16Mp front camera, f/2.0\r\nBluetooth 5.0\r\n4G LTE (Cat 16)\r\nDual nano-SIM\r\nGPS\r\nNFC\r\n3700mAh battery\r\n157.5 x 74.8 x 8.2mm\r\n185g', '2019-05-12 14:11:33', 8, 'Olof'),
(616127131, 'Inläggets information\r\n', '2019-05-28 18:43:17', 8, 'Olof');

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
  `profilbild` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('1','0') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumpning av Data i tabell `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `telefon`, `skapad`, `changed`, `profilbild`, `status`) VALUES
(1, 'André', '123', 'multispelare@gmail.com', '7aa5630b48b2895a8a82d6bc451181270106c79d622f9a4284bdabc5c0d744d3', '0735357617', '2019-03-10 12:23:11', '2019-05-04 17:07:54', 'profil.jpg', '1'),
(2, 'Alexander', 'Wa\'', 'alle@hoes.se', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', '12341234', '2019-04-10 13:42:41', '2019-04-10 13:42:41', '', '0'),
(4, 'Sven', 'Åke', 'ajkke@gmail.com', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', '234435', '2019-05-03 17:39:44', '2019-05-03 17:40:28', 'mobil.png', '0'),
(5, 'André', 'Sturesson', 'carl@mail.com', 'bd01b0b648c2c64eb1bddd9361d9972ea684b344fedc4d166654a85e8919e7ad', '0735357617', '2019-05-03 18:42:07', '2019-05-03 18:42:07', '', '0'),
(6, 'André', 'Sturesson', 'multispelare1@gmail.com', '688787d8ff144c502c7f5cffaafe2cc588d86079f9de88304c26b0cb99ce91c6', '0735357617', '2019-05-04 17:11:46', '2019-05-04 17:12:07', 'mobil.png', '0'),
(7, 'Lars', 'Bengtsson', 'lars@mail.com', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', '0512512345123', '2019-05-04 17:33:18', '2019-05-04 17:34:14', 'Taco.jpg', '0'),
(8, 'Olof', 'Sturesson', 'admin@admin.com', '8a8b53dd046a36328b661315ffd6a594c9229ab4672fc6207c9f3ff8449516f0', '0735357617', '2019-05-05 16:59:18', '2019-05-05 20:16:10', 'Earphones.jpg', '0'),
(9, 'Kurt', 'Bengtsson', 'beng@email.com', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', '05234112', '2019-05-12 13:57:00', '2019-05-12 13:57:15', 'Laddning.jpg', '0');

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
(166415085, 'BÄSTA MOBILEN!', '2019-05-05 18:59:07', 9, 'André '),
(297661072, 'Funkar detta?', '2019-05-05 18:52:56', 5, 'André '),
(433864983, 'Funkar detta?', '2019-05-05 18:55:46', 5, 'André '),
(616127131, 'Hejsan', '2019-05-28 18:43:17', 11, 'Olof'),
(691985374, 'Andre är kung', '2019-04-29 20:33:30', 6, 'André'),
(1071630961, 'Funkar detta?', '2019-05-05 18:56:55', 5, 'André '),
(1146880613, 'Test01', '2019-04-28 20:20:00', 1, 'André'),
(1255747522, 'Specifikationer på Onplus 6T', '2019-05-12 14:11:33', 9, 'Olof'),
(1737914424, 'Test', '2019-05-05 18:58:36', 6, 'André '),
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
  ADD PRIMARY KEY (`kommentar_id`),
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
  MODIFY `kat_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT för tabell `kommentarer`
--
ALTER TABLE `kommentarer`
  MODIFY `kommentar_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
