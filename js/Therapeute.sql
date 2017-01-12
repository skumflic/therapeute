-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Dim 04 Décembre 2016 à 15:59
-- Version du serveur :  5.7.9
-- Version de PHP :  5.6.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `therapeute`
--

-- --------------------------------------------------------

--
-- Structure de la table `cabinet`
--

DROP TABLE IF EXISTS `cabinet`;
CREATE TABLE IF NOT EXISTS `cabinet` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `adresse` varchar(60) NOT NULL,
  `acces` varchar(120) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `cabinet`
--

INSERT INTO `cabinet` (`id`, `nom`, `adresse`, `acces`) VALUES
(1, 'Bourvon', '10 rue du lol', 'BUS TRAM'),
(2, 'Bourvon', '10 rue du lol', 'BUS TRAM'),
(3, 'Bourvon', '10 rue du lol', 'BUS TRAM');

-- --------------------------------------------------------

--
-- Structure de la table `couleur`
--

DROP TABLE IF EXISTS `couleur`;
CREATE TABLE IF NOT EXISTS `couleur` (
  `id` int(10) NOT NULL,
  `libelle` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `experience`
--

DROP TABLE IF EXISTS `experience`;
CREATE TABLE IF NOT EXISTS `experience` (
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
-- Structure de la table `formation`
--

DROP TABLE IF EXISTS `formation`;
CREATE TABLE IF NOT EXISTS `formation` (
  `idFormation` int(10) NOT NULL,
  `idTherapeute` int(10) NOT NULL,
  `libelle` varchar(120) NOT NULL,
  `nom` varchar(60) NOT NULL,
  `annee` int(10) NOT NULL,
  `etablissement` varchar(50) NOT NULL,
  `descriptif` varchar(250) NOT NULL,
  `afficher` tinyint(1) NOT NULL,
  PRIMARY KEY (`idFormation`),
  UNIQUE KEY `idTherapeute` (`idTherapeute`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `photo`
--

DROP TABLE IF EXISTS `photo`;
CREATE TABLE IF NOT EXISTS `photo` (
  `id` int(10) NOT NULL,
  `idCabinet` int(10) NOT NULL,
  `titre` varchar(50) NOT NULL,
  `texte` varchar(140) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `reseau`
--

DROP TABLE IF EXISTS `reseau`;
CREATE TABLE IF NOT EXISTS `reseau` (
  `idReseau` int(10) NOT NULL,
  `libelle` varchar(20) NOT NULL,
  PRIMARY KEY (`idReseau`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `skin`
--

DROP TABLE IF EXISTS `skin`;
CREATE TABLE IF NOT EXISTS `skin` (
  `id` int(10) NOT NULL,
  `libelle` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `therapeute`
--

DROP TABLE IF EXISTS `therapeute`;
CREATE TABLE IF NOT EXISTS `therapeute` (
  `id` int(10) NOT NULL,
  `isAccepted` tinyint(1) NOT NULL,
  `cleLogiciel` varchar(50) DEFAULT NULL,
  `titre` varchar(60) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `isCertified` tinyint(1) DEFAULT NULL,
  `couleur` int(10) DEFAULT NULL,
  `skin` int(10) DEFAULT NULL,
  `lienPhoto` varchar(120) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `skin` (`skin`),
  UNIQUE KEY `couleur` (`couleur`),
  KEY `id` (`id`),
  KEY `id_2` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `therapeute`
--

INSERT INTO `therapeute` (`id`, `isAccepted`, `cleLogiciel`, `titre`, `description`, `isCertified`, `couleur`, `skin`, `lienPhoto`) VALUES
(8, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `thera_cab`
--

DROP TABLE IF EXISTS `thera_cab`;
CREATE TABLE IF NOT EXISTS `thera_cab` (
  `idTherapeute` int(10) NOT NULL,
  `idCabinet` int(10) NOT NULL,
  `isPrincipal` tinyint(1) NOT NULL,
  PRIMARY KEY (`idTherapeute`,`idCabinet`),
  KEY `fk2` (`idCabinet`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `thera_reseau`
--

DROP TABLE IF EXISTS `thera_reseau`;
CREATE TABLE IF NOT EXISTS `thera_reseau` (
  `idTherapeute` int(10) NOT NULL,
  `idReseau` int(10) NOT NULL,
  `URL` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nom` varchar(60) NOT NULL,
  `prenom` varchar(60) NOT NULL,
  `pseudo` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL,
  `adresse` varchar(100) NOT NULL,
  `mail` varchar(70) NOT NULL,
  `telephone` varchar(20) NOT NULL,
  `isModerateur` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `nom`, `prenom`, `pseudo`, `password`, `adresse`, `mail`, `telephone`, `isModerateur`) VALUES
(6, 'Bourvon', 'Corentin', 'cobor', 'lol', '10 rue du lol', 'corentin_25@hotmail.fr', '0634233792', 0),
(7, 'Bourvon', 'Corentin', 'Rcobor', 'lol', '10 rue du lol', 'corentin_25@hotmail.fr', '0634233792', 0),
(8, 'Bourvon', 'Corentin', 'ckeleklkre', 'lol', '10 rue du lol', 'corentin_25@hotmail.fr', '0634233792', 0);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `formation`
--
ALTER TABLE `formation`
  ADD CONSTRAINT `FORMATION_ibfk_1` FOREIGN KEY (`idTherapeute`) REFERENCES `therapeute` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `therapeute`
--
ALTER TABLE `therapeute`
  ADD CONSTRAINT `THERAPEUTE_ibfk_1` FOREIGN KEY (`id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `THERAPEUTE_ibfk_2` FOREIGN KEY (`couleur`) REFERENCES `couleur` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `thera_cab`
--
ALTER TABLE `thera_cab`
  ADD CONSTRAINT `fk` FOREIGN KEY (`idTherapeute`) REFERENCES `therapeute` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk2` FOREIGN KEY (`idCabinet`) REFERENCES `cabinet` (`id`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
