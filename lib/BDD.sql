-- phpMyAdmin SQL Dump
-- version 4.4.13.1
-- http://www.phpmyadmin.net
--
-- Host: rockoderfobase.mysql.db
-- Generation Time: Jan 23, 2016 at 09:44 AM
-- Server version: 5.5.46-0+deb7u1-log
-- PHP Version: 5.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


-- --------------------------------------------------------
-- Database: `rockoderfobase`
-- --------------------------------------------------------


--
-- Table structure for table `CATEGORY`
--

CREATE TABLE IF NOT EXISTS `CATEGORY` (
  `CATEGORYID` int(11) NOT NULL,
  `PEREID` int(11) DEFAULT NULL,
  `CATEGORYNAME` varchar(100) DEFAULT NULL,
  `CATEGORYDESCRIPTION` varchar(255) DEFAULT NULL,
  `USERID` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `CATEGORY`
--

INSERT INTO `CATEGORY` (`CATEGORYID`, `PEREID`, `CATEGORYNAME`, `CATEGORYDESCRIPTION`, `USERID`) VALUES
(1, 0, 'Humour', 'Passé une mauvaise journée et envie de rire un bon coup, ou tout simplement à la recherche de nouvelles blagues?', NULL),
(2, 0, 'Sport', 'Le monde de toutes les disciplines sportives professionnelles ', NULL),
(3, 0, 'Musique', 'Actualités relatives à tout ce qui fait du bruit mais qui sonne bien aux oreilles.', NULL),
(4, 0, 'Cinéma', 'Sorties sur grand écran et scoops sur le septième art', NULL),
(5, 0, 'Littérature', 'Nouveautés et articles concernant les livres dans leur ensemble', NULL),
(6, 0, 'Jeu-vidéo', 'Exclusivités pour hardcores ou cazus sur tous les types de support!', NULL),
(7, 0, 'Sciences', 'Découvertes, avancées technologiques et publications d''articles', NULL),
(8, 0, 'Actualités internationales', 'Ce qui se passe dans le monde en ce moment même', NULL),
(9, 2, 'Football', 'Tout sur le ballon rond en France et à l''international', NULL),
(10, 2, 'Rugby', 'Tout sur le ballon ovale dans le monde', NULL),
(11, 2, 'Catch', '...and this is JOHN CEEEEENAAAAAAA', NULL),
(12, 8, 'Le Monde', 'Actualités géopolitiques du journal Le Monde', NULL),
(13, 8, 'Le Figaro', 'Actualités géopolitiques du journal Le Figaro', NULL),
(14, 1, 'Parodies', 'Oeuvres en tout genres parodiées dans un but comique', NULL),
(15, 1, 'Compilations', 'Montages de vidéos drôles', NULL),
(16, 6, 'Ventes', 'Neufs ou d''occasion, trouvez des bons plans pour acheter de nouveaux jeux', NULL),
(17, 7, 'Informatique', 'Pour les passionnés de hardware ou de software', NULL),
(18, 17, 'Hardware', 'Pour les fans de bidouille', NULL),
(19, 17, 'Software', 'Technos, logiciels, code, etc.', NULL),
(20, NULL, 'Sans Catégorie', 'Flux non catégorisés et sans contrainte de conformité', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `MEDIA`
--

CREATE TABLE IF NOT EXISTS `MEDIA` (
  `MEDIAADDRESS` varchar(255) NOT NULL,
  `NEWSLINK` varchar(255) NOT NULL,
  `TYPE` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `NEWS`
--

CREATE TABLE IF NOT EXISTS `NEWS` (
  `NEWSID` int(11) NOT NULL,
  `SOURCEID` int(11) DEFAULT NULL,
  `TITLE` varchar(255) DEFAULT NULL,
  `DESCRIPTION` varchar(255) DEFAULT NULL,
  `DATE` int(11) DEFAULT NULL,
  `LINK` varchar(255) NOT NULL,
  `CONTENT` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `SOURCE`
--

CREATE TABLE IF NOT EXISTS `SOURCE` (
  `SOURCEID` int(11) NOT NULL,
  `SOURCENAME` varchar(100) DEFAULT NULL,
  `SOURCEADDRESS` text
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `SOURCE`
--

INSERT INTO `SOURCE` (`SOURCEID`, `SOURCENAME`, `SOURCEADDRESS`) VALUES
(1, '01.net Sécurité', 'http://www.01net.com/rss/actualites/securite/');

-- --------------------------------------------------------

--
-- Table structure for table `SUBSCRIPTION`
--

CREATE TABLE IF NOT EXISTS `SUBSCRIPTION` (
  `USERID` int(11) NOT NULL DEFAULT '0',
  `SOURCEID` int(11) NOT NULL DEFAULT '0',
  `CATEGORYID` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `USER`
--

CREATE TABLE IF NOT EXISTS `USER` (
  `USERID` int(11) NOT NULL,
  `USERNAME` varchar(50) DEFAULT NULL,
  `MAIL` varchar(255) DEFAULT NULL,
  `PASSWORD` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `USER`
--

INSERT INTO `USER` (`USERID`, `USERNAME`, `MAIL`, `PASSWORD`)
VALUES (0, 'Public', NULL, NULL);


-- --------------------------------------------------------
-- Indexes for dumped tables
-- --------------------------------------------------------

ALTER TABLE `CATEGORY`
  ADD PRIMARY KEY (`CATEGORYID`),
  ADD KEY `USERID` (`USERID`);

ALTER TABLE `MEDIA`
  ADD PRIMARY KEY (`MEDIAADDRESS`,`NEWSLINK`),
  ADD KEY `NEWSLINK` (`NEWSLINK`);

ALTER TABLE `NEWS`
  ADD PRIMARY KEY (`LINK`),
  ADD UNIQUE KEY `ID` (`NEWSID`),
  ADD KEY `SOURCEID` (`SOURCEID`),
  ADD KEY `LINK` (`LINK`);

ALTER TABLE `SOURCE`
  ADD PRIMARY KEY (`SOURCEID`);

ALTER TABLE `SUBSCRIPTION`
  ADD PRIMARY KEY (`USERID`,`SOURCEID`),
  ADD KEY `SOURCEID` (`SOURCEID`),
  ADD KEY `CATEGORYID` (`CATEGORYID`);

ALTER TABLE `USER`
  ADD PRIMARY KEY (`USERID`);


-- --------------------------------------------------------
-- AUTO_INCREMENT for dumped tables
-- --------------------------------------------------------

ALTER TABLE `CATEGORY`
  MODIFY `CATEGORYID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;

ALTER TABLE `NEWS`
  MODIFY `NEWSID` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `SOURCE`
  MODIFY `SOURCEID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;

ALTER TABLE `USER`
  MODIFY `USERID` int(11) NOT NULL AUTO_INCREMENT;


-- --------------------------------------------------------
-- Constraints for dumped tables
-- --------------------------------------------------------

ALTER TABLE `CATEGORY`
  ADD CONSTRAINT `CATEGORY_ibfk_1` FOREIGN KEY (`USERID`) REFERENCES `USER` (`USERID`);

ALTER TABLE `MEDIA`
  ADD CONSTRAINT `MEDIA_ibfk_1` FOREIGN KEY (`NEWSLINK`) REFERENCES `NEWS` (`LINK`);

ALTER TABLE `NEWS`
  ADD CONSTRAINT `NEWS_ibfk_1` FOREIGN KEY (`SOURCEID`) REFERENCES `SOURCE` (`SOURCEID`);

ALTER TABLE `SUBSCRIPTION`
  ADD CONSTRAINT `SUBSCRIPTION_ibfk_1` FOREIGN KEY (`USERID`) REFERENCES `USER` (`USERID`),
  ADD CONSTRAINT `SUBSCRIPTION_ibfk_2` FOREIGN KEY (`SOURCEID`) REFERENCES `SOURCE` (`SOURCEID`),
  ADD CONSTRAINT `SUBSCRIPTION_ibfk_3` FOREIGN KEY (`CATEGORYID`) REFERENCES `CATEGORY` (`CATEGORYID`);

