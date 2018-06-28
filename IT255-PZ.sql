-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 28, 2018 at 09:59 PM
-- Server version: 5.7.22-0ubuntu0.16.04.1
-- PHP Version: 7.0.30-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `IT255-PZ`
--

-- --------------------------------------------------------

--
-- Table structure for table `ADMINISTRATOR`
--

CREATE TABLE `ADMINISTRATOR` (
  `ADMIN_ID` int(11) NOT NULL,
  `ADMIN_USERNAME` text NOT NULL,
  `ADMIN_SIFRA` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ADMINISTRATOR`
--

INSERT INTO `ADMINISTRATOR` (`ADMIN_ID`, `ADMIN_USERNAME`, `ADMIN_SIFRA`) VALUES
(3, 'admin', '$2y$10$Xir6T9iga.8y9w7IZzW0MeJncLv9o2ilHvndYWWSo6hoJiPbW7WNW');

-- --------------------------------------------------------

--
-- Table structure for table `KREATOR`
--

CREATE TABLE `KREATOR` (
  `KREATOR_ID` int(11) NOT NULL,
  `KREATOR_IME` text NOT NULL,
  `KREATOR_PREZIME` text NOT NULL,
  `KREATOR_ZARADA` decimal(5,0) NOT NULL,
  `KREATOR_USERNAME` text NOT NULL,
  `KREATOR_EMAIL` text NOT NULL,
  `KREATOR_SIFRA` text NOT NULL,
  `KREATOR_PAYPAL` text,
  `KREATOR_SLIKA` text,
  `KREATOR_TEXT` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `KREATOR`
--

INSERT INTO `KREATOR` (`KREATOR_ID`, `KREATOR_IME`, `KREATOR_PREZIME`, `KREATOR_ZARADA`, `KREATOR_USERNAME`, `KREATOR_EMAIL`, `KREATOR_SIFRA`, `KREATOR_PAYPAL`, `KREATOR_SLIKA`, `KREATOR_TEXT`) VALUES
(1, 'nikola', 'mitrovic', '12', 'nikola', 'nikola@gmail.com', '$2y$10$A7s06DXLDPVvknnSFmMWBuAT3L2uKNTewue7aZa0uxQZHN7PW3FwO', 'nikola@gmail.com', 'uploads/nikola.jpg', 'Devdevdev'),
(19, 'kreatorime', 'kreatorprezime', '0', 'kreator1', 'kreator1@gmail.com', '$2y$10$SvLM342WJkUQvSYR4rabTeZT0SiLgvZsq6H4oQ9qlUVkje5iIclZW', 'kreator@gmail.com', 'uploads/kreator1.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas ac augue et urna consectetur fermentum. Cras sed purus nec dui finibus aliquam vitae eget arcu. Sed congue tortor ex, at laoreet nisi aliquet ac. Pellentesque non felis porta, rhoncus massa efficitur, luctus neque. Nullam lacinia, mauris non volutpat ornare, odio nunc efficitur ipsum, at sollicitudin ante turpis sit amet tortor.'),
(20, 'Jovan', 'Jovic', '0', 'JovanJova', 'jova@gmail.com', '$2y$10$pJGXrWRSLmPxhQi/E7JVZuwU.Wp93uF.v./clsOtgcAktJudkf5CC', 'jovan@gmail.com', 'uploads/JovanJova.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas ac augue et urna consectetur fermentum. Cras sed purus nec dui finibus aliquam vitae eget arcu. Sed congue tortor ex, at laoreet nisi aliquet ac. Pellentesque non felis porta, rhoncus massa efficitur, luctus neque. Nullam lacinia, mauris non volutpat ornare, odio nunc efficitur ipsum, at sollicitudin ante turpis sit amet tortor.');

-- --------------------------------------------------------

--
-- Table structure for table `LAJKOVI`
--

CREATE TABLE `LAJKOVI` (
  `LAJKOVI_ID` int(11) NOT NULL,
  `PESMA_ID` int(11) NOT NULL,
  `LAJKOVI_IP` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `LAJKOVI`
--

INSERT INTO `LAJKOVI` (`LAJKOVI_ID`, `PESMA_ID`, `LAJKOVI_IP`) VALUES
(37, 46, '87.116.179.227');

-- --------------------------------------------------------

--
-- Table structure for table `PESMA`
--

CREATE TABLE `PESMA` (
  `PESMA_ID` int(11) NOT NULL,
  `ZANR_ID` int(11) NOT NULL,
  `KREATOR_ID` int(11) NOT NULL,
  `PESMA_NAZIV` text NOT NULL,
  `PESMA_TRAJANJE` int(11) NOT NULL,
  `PESMA_CENA` decimal(5,0) DEFAULT NULL,
  `PESMA_DATUM` date NOT NULL,
  `PESMA_BR_KUPOVINA` int(11) DEFAULT NULL,
  `PESMA_OPIS` text,
  `PESMA_PATH` text NOT NULL,
  `PESMA_PATH_ZIG` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `PESMA`
--

INSERT INTO `PESMA` (`PESMA_ID`, `ZANR_ID`, `KREATOR_ID`, `PESMA_NAZIV`, `PESMA_TRAJANJE`, `PESMA_CENA`, `PESMA_DATUM`, `PESMA_BR_KUPOVINA`, `PESMA_OPIS`, `PESMA_PATH`, `PESMA_PATH_ZIG`) VALUES
(46, 7, 1, 'JazzySong', 105, '3', '2018-06-28', 1, 'Such jazz, very jazzy lorem lorem ipsum ipsum', 'uploads/hsongs/$2y$10$khOybErI11vkhORtvVoafuisBT.UloPEhRR0kYV.fENP3Wjxd5UC.mp3', 'uploads/songs/nikola-JazzySong.mp3'),
(47, 4, 19, 'Chill Song', 148, '5', '2018-06-28', 0, 'Very chill song, i like it a lot.', 'uploads/hsongs/$2y$10$JIJR7pvmpDGIb3dY1GiKE.aRjgfAc04V7hrGUj9pNOyPKQ6LXvmS.mp3', 'uploads/songs/kreator1-Chill Song.mp3'),
(48, 1, 20, 'Happy Rock', 106, '3', '2018-06-28', 0, 'Happy rock all day!', 'uploads/hsongs/$2y$10$qHDUoYDlEJS.W.66CJquwhWPdv.RtQbJP538mmPhQisuJnJLiNu.mp3', 'uploads/songs/JovanJova-Happy Rock.mp3');

-- --------------------------------------------------------

--
-- Table structure for table `PRIJAVA`
--

CREATE TABLE `PRIJAVA` (
  `PRIJAVA_ID` int(11) NOT NULL,
  `PRIJAVA_RAZLOG` text NOT NULL,
  `PRIJAVA_PESMA` text NOT NULL,
  `PRIJAVA_KREATOR` text NOT NULL,
  `PRIJAVA_PRIJAVIO` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `PRIJAVA`
--

INSERT INTO `PRIJAVA` (`PRIJAVA_ID`, `PRIJAVA_RAZLOG`, `PRIJAVA_PESMA`, `PRIJAVA_KREATOR`, `PRIJAVA_PRIJAVIO`) VALUES
(3, 'Stolen chord progression, for sure...', 'Happy Rock', 'JovanJova', 'nikola');

-- --------------------------------------------------------

--
-- Table structure for table `ZANR`
--

CREATE TABLE `ZANR` (
  `ZANR_ID` int(11) NOT NULL,
  `ZANR_NAZIV` text NOT NULL,
  `ZANR_OPIS` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ZANR`
--

INSERT INTO `ZANR` (`ZANR_ID`, `ZANR_NAZIV`, `ZANR_OPIS`) VALUES
(1, 'Rock', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec euismod sem vel nunc fringilla, vel venenatis metus posuere. Mauris eu euismod ex. Curabitur erat erat, mollis ac dictum quis, iaculis eget purus. '),
(2, 'Pop', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec euismod sem vel nunc fringilla, vel venenatis metus posuere. Mauris eu euismod ex. Curabitur erat erat, mollis ac dictum quis, iaculis eget purus. '),
(3, 'Soul & RNB', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec euismod sem vel nunc fringilla, vel venenatis metus posuere. Mauris eu euismod ex. Curabitur erat erat, mollis ac dictum quis, iaculis eget purus. '),
(4, 'Corporate', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec euismod sem vel nunc fringilla, vel venenatis metus posuere. Mauris eu euismod ex. Curabitur erat erat, mollis ac dictum quis, iaculis eget purus. '),
(5, 'Electronica', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec euismod sem vel nunc fringilla, vel venenatis metus posuere. Mauris eu euismod ex. Curabitur erat erat, mollis ac dictum quis, iaculis eget purus. '),
(6, 'Classical', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec euismod sem vel nunc fringilla, vel venenatis metus posuere. Mauris eu euismod ex. Curabitur erat erat, mollis ac dictum quis, iaculis eget purus. '),
(7, 'Jazz', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec euismod sem vel nunc fringilla, vel venenatis metus posuere. Mauris eu euismod ex. Curabitur erat erat, mollis ac dictum quis, iaculis eget purus. '),
(8, 'Metal', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec euismod sem vel nunc fringilla, vel venenatis metus posuere. Mauris eu euismod ex. Curabitur erat erat, mollis ac dictum quis, iaculis eget purus. '),
(9, 'Djent', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec euismod sem vel nunc fringilla, vel venenatis metus posuere. Mauris eu euismod ex. Curabitur erat erat, mollis ac dictum quis, iaculis eget purus. '),
(10, 'Folk', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec euismod sem vel nunc fringilla, vel venenatis metus posuere. Mauris eu euismod ex. Curabitur erat erat, mollis ac dictum quis, iaculis eget purus. '),
(11, 'Dnb', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec euismod sem vel nunc fringilla, vel venenatis metus posuere. Mauris eu euismod ex. Curabitur erat erat, mollis ac dictum quis, iaculis eget purus. '),
(12, 'Country', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec euismod sem vel nunc fringilla, vel venenatis metus posuere. Mauris eu euismod ex. Curabitur erat erat, mollis ac dictum quis, iaculis eget purus. '),
(16, 'loremipsum', 'loremipsumloremipsumloremipsum'),
(17, 'loremipsum', 'loremipsumloremipsumloremipsum'),
(18, 'loremipsum', 'loremipsumloremipsumloremipsum'),
(19, 'loremipsum', 'loremipsumloremipsumloremipsum'),
(20, 'loremipsum', 'loremipsumloremipsumloremipsum'),
(21, 'loremipsum', 'loremipsumloremipsumloremipsum'),
(22, 'loremipsum', 'loremipsumloremipsumloremipsum'),
(23, 'loremipsum', 'loremipsumloremipsumloremipsum'),
(24, 'loremipsum', 'loremipsumloremipsumloremipsum'),
(25, 'loremipsum', 'loremipsumloremipsumloremipsum'),
(26, 'loremipsum', 'loremipsumloremipsumloremipsum'),
(27, 'loremipsum', 'loremipsumloremipsumloremipsum'),
(28, 'loremipsum', 'loremipsumloremipsumloremipsum'),
(29, 'loremipsum', 'loremipsumloremipsumloremipsum'),
(30, 'loremipsum', 'loremipsumloremipsumloremipsum'),
(31, 'loremipsum', 'loremipsumloremipsumloremipsum'),
(32, 'loremipsum', 'loremipsumloremipsumloremipsum'),
(33, 'loremipsum', 'loremipsumloremipsumloremipsum'),
(34, 'loremipsum', 'loremipsumloremipsumloremipsum'),
(35, 'loremipsum', 'loremipsumloremipsumloremipsum'),
(36, 'loremipsum', 'loremipsumloremipsumloremipsum'),
(37, 'loremipsum', 'loremipsumloremipsumloremipsum'),
(38, 'loremipsum', 'loremipsumloremipsumloremipsum'),
(39, 'loremipsum', 'loremipsumloremipsumloremipsum'),
(40, 'loremipsum', 'loremipsumloremipsumloremipsum'),
(41, 'loremipsum', 'loremipsumloremipsumloremipsum'),
(42, 'loremipsum', 'loremipsumloremipsumloremipsum'),
(43, 'loremipsum', 'loremipsumloremipsumloremipsum'),
(44, 'loremipsum', 'loremipsumloremipsumloremipsum'),
(45, 'loremipsum', 'loremipsumloremipsumloremipsum'),
(46, 'loremipsum', 'loremipsum'),
(47, 'loremipsum', 'loremipsum');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ADMINISTRATOR`
--
ALTER TABLE `ADMINISTRATOR`
  ADD PRIMARY KEY (`ADMIN_ID`);

--
-- Indexes for table `KREATOR`
--
ALTER TABLE `KREATOR`
  ADD PRIMARY KEY (`KREATOR_ID`);

--
-- Indexes for table `LAJKOVI`
--
ALTER TABLE `LAJKOVI`
  ADD PRIMARY KEY (`LAJKOVI_ID`),
  ADD KEY `FK_RELATIONSHIP_5` (`PESMA_ID`);

--
-- Indexes for table `PESMA`
--
ALTER TABLE `PESMA`
  ADD PRIMARY KEY (`PESMA_ID`),
  ADD KEY `FK_RELATIONSHIP_2` (`KREATOR_ID`),
  ADD KEY `FK_RELATIONSHIP_3` (`ZANR_ID`);

--
-- Indexes for table `PRIJAVA`
--
ALTER TABLE `PRIJAVA`
  ADD PRIMARY KEY (`PRIJAVA_ID`);

--
-- Indexes for table `ZANR`
--
ALTER TABLE `ZANR`
  ADD PRIMARY KEY (`ZANR_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ADMINISTRATOR`
--
ALTER TABLE `ADMINISTRATOR`
  MODIFY `ADMIN_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `KREATOR`
--
ALTER TABLE `KREATOR`
  MODIFY `KREATOR_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `LAJKOVI`
--
ALTER TABLE `LAJKOVI`
  MODIFY `LAJKOVI_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `PESMA`
--
ALTER TABLE `PESMA`
  MODIFY `PESMA_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT for table `PRIJAVA`
--
ALTER TABLE `PRIJAVA`
  MODIFY `PRIJAVA_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `ZANR`
--
ALTER TABLE `ZANR`
  MODIFY `ZANR_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `LAJKOVI`
--
ALTER TABLE `LAJKOVI`
  ADD CONSTRAINT `FK_RELATIONSHIP_5` FOREIGN KEY (`PESMA_ID`) REFERENCES `PESMA` (`PESMA_ID`);

--
-- Constraints for table `PESMA`
--
ALTER TABLE `PESMA`
  ADD CONSTRAINT `FK_RELATIONSHIP_2` FOREIGN KEY (`KREATOR_ID`) REFERENCES `KREATOR` (`KREATOR_ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_RELATIONSHIP_3` FOREIGN KEY (`ZANR_ID`) REFERENCES `ZANR` (`ZANR_ID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
