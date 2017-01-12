-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 12, 2017 at 03:11 PM
-- Server version: 5.5.53-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `Therapeute`
--

-- --------------------------------------------------------

--
-- Table structure for table `CABINET`
--

CREATE TABLE IF NOT EXISTS `CABINET` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `adresse` varchar(60) NOT NULL,
  `ville` varchar(30) NOT NULL,
  `codePostal` int(10) NOT NULL,
  `acces` varchar(120) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `CABINET`
--

INSERT INTO `CABINET` (`id`, `nom`, `adresse`, `ville`, `codePostal`, `acces`) VALUES
(6, 'Cabinet des bgg', '10 rue du lol', 'mmmm', 25000, 'BUS TRAM'),
(7, 'Cabinet des bgg', '10 rue du lol', 'Besançon', 25000, 'BUS TRAM'),
(8, 'Bourvon', '10 rue du lol', 'Besançon', 25000, 'BUS TRAM'),
(9, 'Bourvon', '10 rue du lol', 'Besançon', 25000, 'BUS TRAM'),
(10, 'Bourvon', '10 rue du lol', 'Besançon', 25000, 'BUS TRAM'),
(11, 'Cabinet des bg', '10 rue de l''oiseau', 'Besançon', 25000, 'BUS TRAM'),
(12, 'Cabinet des bgg', '10 rue du lol', 'Besançon', 25000, 'BUS TRAM');

-- --------------------------------------------------------

--
-- Table structure for table `COULEUR`
--

CREATE TABLE IF NOT EXISTS `COULEUR` (
  `id` int(10) NOT NULL,
  `libelle` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `EXPERIENCE`
--

CREATE TABLE IF NOT EXISTS `EXPERIENCE` (
  `idExperience` int(10) NOT NULL,
  `idTherapeute` int(10) NOT NULL,
  `poste` varchar(50) NOT NULL,
  `dateDebut` int(10) NOT NULL,
  `dateFin` int(10) NOT NULL,
  `nomEntreprise` varchar(60) NOT NULL,
  `afficher` tinyint(1) NOT NULL,
  PRIMARY KEY (`idExperience`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `FORMATION`
--

CREATE TABLE IF NOT EXISTS `FORMATION` (
  `idFormation` int(10) NOT NULL AUTO_INCREMENT,
  `idTherapeute` int(10) NOT NULL,
  `nom` varchar(60) NOT NULL,
  `annee` int(10) NOT NULL,
  `etablissement` varchar(50) NOT NULL,
  `descriptif` varchar(250) NOT NULL,
  `afficher` tinyint(1) NOT NULL,
  PRIMARY KEY (`idFormation`),
  UNIQUE KEY `idTherapeute` (`idTherapeute`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `PHOTO`
--

CREATE TABLE IF NOT EXISTS `PHOTO` (
  `id` int(10) NOT NULL,
  `idCabinet` int(10) NOT NULL,
  `titre` varchar(50) NOT NULL,
  `texte` varchar(140) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `RESEAU`
--

CREATE TABLE IF NOT EXISTS `RESEAU` (
  `idReseau` int(10) NOT NULL,
  `libelle` varchar(20) NOT NULL,
  PRIMARY KEY (`idReseau`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `RESEAU`
--

INSERT INTO `RESEAU` (`idReseau`, `libelle`) VALUES
(1, 'Facebook'),
(2, 'Twitter'),
(3, 'Google+');

-- --------------------------------------------------------

--
-- Table structure for table `SKIN`
--

CREATE TABLE IF NOT EXISTS `SKIN` (
  `id` int(10) NOT NULL,
  `libelle` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `TARIF`
--

CREATE TABLE IF NOT EXISTS `TARIF` (
  `idTherapeute` int(11) NOT NULL,
  `idTarif` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(31) NOT NULL,
  `description` int(127) NOT NULL,
  `prix` varchar(7) NOT NULL,
  PRIMARY KEY (`idTarif`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `THERAPEUTE`
--

CREATE TABLE IF NOT EXISTS `THERAPEUTE` (
  `id` int(10) NOT NULL,
  `isAccepted` tinyint(1) NOT NULL,
  `cleLogiciel` varchar(50) DEFAULT NULL,
  `titre` varchar(60) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `isCertified` tinyint(1) DEFAULT NULL,
  `couleur` int(10) DEFAULT NULL,
  `skin` int(10) DEFAULT NULL,
  `lienPhoto` varchar(120) DEFAULT NULL,
  `isBlocked` tinyint(1) NOT NULL,
  `remerciements` varchar(255) DEFAULT NULL,
  `aboutme` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `skin` (`skin`),
  UNIQUE KEY `couleur` (`couleur`),
  KEY `id` (`id`),
  KEY `id_2` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `THERAPEUTE`
--

INSERT INTO `THERAPEUTE` (`id`, `isAccepted`, `cleLogiciel`, `titre`, `description`, `isCertified`, `couleur`, `skin`, `lienPhoto`, `isBlocked`, `remerciements`, `aboutme`) VALUES
(9, 0, 'jsais mm pas s que c', 'eeSalut la famille', 'Bonjour, selut, enchanté', NULL, 0, 0, 'trump.jpg', 1, NULL, NULL),
(10, 0, NULL, NULL, NULL, NULL, NULL, NULL, 'knock knock.jpg', 1, NULL, NULL),
(11, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL),
(12, 0, 'frais', 'Salut la famille', 'Comment aller vous eehgghg', NULL, NULL, NULL, 'trump.jpg', 1, NULL, NULL),
(13, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL),
(14, 0, 'lololol', 'La plus belle page', 'La plus belle description de tous les temps pour le plus grosse ours de la fac', NULL, NULL, NULL, 'issou.png', 0, 'Je remercie l''ensemble de mes collègues de l''université pour m''aider dans ma galère et remercie tout particulièrement les professeurs pour ne plus me laisser le temps de vivre', 'Je suis un beau bisontin de France, j''aime thérapeuter et boire beaucoup d''alcool, d''ici la fin de mes études j''aurai des ulcères à cause du café, des poumons noircis par le tabac et mon beau foie totalement démonter. lol');

-- --------------------------------------------------------

--
-- Table structure for table `THERA_CAB`
--

CREATE TABLE IF NOT EXISTS `THERA_CAB` (
  `idTherapeute` int(10) NOT NULL,
  `idCabinet` int(10) NOT NULL,
  `isPrincipal` tinyint(1) NOT NULL,
  PRIMARY KEY (`idTherapeute`,`idCabinet`),
  KEY `fk2` (`idCabinet`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `THERA_CAB`
--

INSERT INTO `THERA_CAB` (`idTherapeute`, `idCabinet`, `isPrincipal`) VALUES
(9, 6, 1),
(9, 10, 0),
(9, 12, 0),
(10, 6, 0),
(10, 10, 1),
(11, 11, 1),
(12, 12, 1),
(14, 6, 0);

-- --------------------------------------------------------

--
-- Table structure for table `THERA_RESEAU`
--

CREATE TABLE IF NOT EXISTS `THERA_RESEAU` (
  `idTherapeute` int(10) NOT NULL,
  `idReseau` int(10) NOT NULL,
  `URL` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `THERA_RESEAU`
--

INSERT INTO `THERA_RESEAU` (`idTherapeute`, `idReseau`, `URL`) VALUES
(14, 1, 'http://www.facebook.com');

-- --------------------------------------------------------

--
-- Table structure for table `USER`
--

CREATE TABLE IF NOT EXISTS `USER` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nom` varchar(60) NOT NULL,
  `prenom` varchar(60) NOT NULL,
  `pseudo` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL,
  `mail` varchar(70) NOT NULL,
  `telephone` varchar(20) NOT NULL,
  `isModerateur` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `USER`
--

INSERT INTO `USER` (`id`, `nom`, `prenom`, `pseudo`, `password`, `mail`, `telephone`, `isModerateur`) VALUES
(9, 'Bourvon', 'Guzalll', 'cobor', 'lol', 'lol@hotm.frrr', '0634233792', 3),
(10, 'BoubouLaMenace', 'Corentinn', 'cbourvon', 'lol', 'lol@hotm.fr', '0634233792', 0),
(11, 'Lol', 'cava', 'cava', 'lol', 'lol@hotm.fr', '0634233792', 1),
(12, 'Bourvv', 'Corentin', 'coubou', 'lol', 'lol@hotm.fr', '0634233793', 0),
(13, 'lol', 'eroieri', 'selut', '0tLO', 'lol@hotm.fr', '0634233792', 0),
(14, 'Kelekele', 'Ouziel le bg', 'okeleke', 'pNXO', 'okele@lol.fr', '0634233792', 4);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `FORMATION`
--
ALTER TABLE `FORMATION`
  ADD CONSTRAINT `FORMATION_ibfk_1` FOREIGN KEY (`idTherapeute`) REFERENCES `THERAPEUTE` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `THERAPEUTE`
--
ALTER TABLE `THERAPEUTE`
  ADD CONSTRAINT `THERAPEUTE_ibfk_1` FOREIGN KEY (`id`) REFERENCES `USER` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `THERA_CAB`
--
ALTER TABLE `THERA_CAB`
  ADD CONSTRAINT `THERA_CAB_ibfk_1` FOREIGN KEY (`idTherapeute`) REFERENCES `THERAPEUTE` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `THERA_CAB_ibfk_2` FOREIGN KEY (`idCabinet`) REFERENCES `CABINET` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
