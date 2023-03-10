-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: 23.02.2023 klo 11:49
-- Palvelimen versio: 8.0.30
-- PHP Version: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `team10vieraskirja`
--

-- --------------------------------------------------------

--
-- Rakenne taululle `checkbox`
--

CREATE TABLE `checkbox` (
  `id` int NOT NULL,
  `nimi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Vedos taulusta `checkbox`
--

INSERT INTO `checkbox` (`id`, `nimi`) VALUES
(1, 'olen'),
(2, 'en ole');

-- --------------------------------------------------------

--
-- Rakenne taululle `gallery`
--

CREATE TABLE `gallery` (
  `idGallery` int NOT NULL,
  `titleGallery` longtext NOT NULL,
  `descGallery` longtext NOT NULL,
  `imgFullNameGallery` longtext NOT NULL,
  `orderGallery` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Vedos taulusta `gallery`
--

INSERT INTO `gallery` (`idGallery`, `titleGallery`, `descGallery`, `imgFullNameGallery`, `orderGallery`) VALUES
(1, 'puita', 'kuvassa liesjärven metsää', 'metsä.63f74c00370512.49310866.jpg', '1');

-- --------------------------------------------------------

--
-- Rakenne taululle `guestbook`
--

CREATE TABLE `guestbook` (
  `id` int NOT NULL,
  `name` varchar(60) NOT NULL DEFAULT ' ',
  `email` varchar(60) NOT NULL DEFAULT ' ',
  `message` text NOT NULL,
  `kaynyt` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Vedos taulusta `guestbook`
--

INSERT INTO `guestbook` (`id`, `name`, `email`, `message`, `kaynyt`) VALUES
(1, 'Linzku', 'sdfg', ' sdfg', 1);

-- --------------------------------------------------------

--
-- Rakenne taululle `poj_users`
--

CREATE TABLE `poj_users` (
  `tunnus` varchar(100) NOT NULL,
  `salasana` varchar(100) NOT NULL,
  `etunimi` varchar(100) NOT NULL,
  `sukunimi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Vedos taulusta `poj_users`
--

INSERT INTO `poj_users` (`tunnus`, `salasana`, `etunimi`, `sukunimi`) VALUES
('Pekka', '3f39d75d5d80221017f66db519bedb2ab2b34d2ea7774de00f4fc0c5a071ad96', 'Pekka', 'Pekkanen');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `checkbox`
--
ALTER TABLE `checkbox`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`idGallery`);

--
-- Indexes for table `guestbook`
--
ALTER TABLE `guestbook`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `poj_users`
--
ALTER TABLE `poj_users`
  ADD PRIMARY KEY (`tunnus`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `checkbox`
--
ALTER TABLE `checkbox`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `idGallery` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `guestbook`
--
ALTER TABLE `guestbook`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
