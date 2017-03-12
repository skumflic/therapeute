-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Мар 12 2017 г., 12:23
-- Версия сервера: 5.7.9
-- Версия PHP: 5.6.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `therapeute`
--

-- --------------------------------------------------------

--
-- Структура таблицы `cabinet`
--

DROP TABLE IF EXISTS `cabinet`;
CREATE TABLE IF NOT EXISTS `cabinet` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `adresse` varchar(100) NOT NULL,
  `ville` varchar(100) NOT NULL,
  `codePostal` int(10) DEFAULT NULL,
  `acces` varchar(600) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `cabinet`
--

INSERT INTO `cabinet` (`id`, `nom`, `adresse`, `ville`, `codePostal`, `acces`) VALUES
(58, 'AAA', '16 route de Gray', 'Besancon', 25000, ''),
(59, 'Faculte de besanon', '16 Route de Gray', 'Besancon', 25000, ''),
(62, 'Beau cabinet', '38 Rue de Belfort', 'Besancon', 25000, ''),
(63, 'Un beau cabinet', '16 Route de Gray', 'Besancon', 25000, '');

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` smallint(6) NOT NULL,
  `name` varchar(256) NOT NULL,
  `description` text NOT NULL,
  `position` smallint(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `position`) VALUES
(1, 'AAA', 'erezrz', 1),
(2, 'la plus belle des categories', '', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `couleur`
--

DROP TABLE IF EXISTS `couleur`;
CREATE TABLE IF NOT EXISTS `couleur` (
  `id` int(10) NOT NULL,
  `libelle` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `couleur`
--

INSERT INTO `couleur` (`id`, `libelle`) VALUES
(1, 'bleu'),
(2, 'jaune'),
(3, 'orange'),
(4, 'rose'),
(5, 'rouge'),
(6, 'vert');

-- --------------------------------------------------------

--
-- Структура таблицы `experience`
--

DROP TABLE IF EXISTS `experience`;
CREATE TABLE IF NOT EXISTS `experience` (
  `idExperience` int(10) NOT NULL AUTO_INCREMENT,
  `idTherapeute` int(10) NOT NULL,
  `poste` varchar(100) NOT NULL,
  `dateDebut` varchar(10) NOT NULL,
  `dateFin` varchar(10) DEFAULT NULL,
  `nomEntreprise` varchar(100) NOT NULL,
  `afficher` tinyint(1) NOT NULL,
  PRIMARY KEY (`idExperience`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `experience`
--

INSERT INTO `experience` (`idExperience`, `idTherapeute`, `poste`, `dateDebut`, `dateFin`, `nomEntreprise`, `afficher`) VALUES
(5, 9, 'gjkjfbvdrnf', '2016-12-22', '2016-12-11', 'hrtyu,hg', 0),
(7, 10, 'qdbnhbdsqcv', '2017-01-18', '2017-01-01', 'sggdhbgd', 1),
(8, 14, 'gfhdfgdfhgd', '2016-12-19', '2017-01-01', 'fhgdh', 0),
(9, 14, 'fdgdfhgd', '2017-01-16', '2017-01-15', 'dfhdfhggd', 0),
(10, 17, 'hjvhsdqjkvih', '2017-01-17', '2017-01-08', 'dghjhgiumlkjhgfvbhnj,klm', 0),
(12, 21, 'd', '12/01/2000', '', 'dfhgdshdhgfjfhdz', 1),
(13, 26, 'rtre', '12/2/2000', '2/2/2011', 'retze', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `formation`
--

DROP TABLE IF EXISTS `formation`;
CREATE TABLE IF NOT EXISTS `formation` (
  `idFormation` int(10) NOT NULL AUTO_INCREMENT,
  `idTherapeute` int(10) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `annee` int(4) NOT NULL,
  `etablissement` varchar(100) NOT NULL,
  `descriptif` varchar(600) DEFAULT NULL,
  `afficher` tinyint(1) NOT NULL,
  PRIMARY KEY (`idFormation`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `formation`
--

INSERT INTO `formation` (`idFormation`, `idTherapeute`, `nom`, `annee`, `etablissement`, `descriptif`, `afficher`) VALUES
(13, 9, 'Formation therapeutique', 2016, 'UniversitÃƒï¿½Ã‚Â©', 'Blablas Blablas Blablas Blablas Blablas Blablas Blablas Blablas Blablas Blablas Blablas Blablas', 1),
(14, 9, 'Relaxation via massage', 2014, 'UniversitÃƒï¿½Ã‚Â©', 'TTuydtfislg,nvblxwnfljkhlmbkv; lbfgkjshd:b ,;b,sdkfjsdfmlb, ;bwdflrfjb!:xcn,bi hjdgbsdvbgdsh', 0),
(15, 9, 'Relaxation', 2014, 'UniversitÃƒÂ©', 'TTuydtfislg,nvblxwnfljkhlmbkv; lbfgkjshd:b ,;b,sdkfjsdfmlb, ;bwdflrfjb!:xcn,bi hjdgbsdvbgdsh', 0),
(16, 9, 'Relaxation', 2014, 'UniversitÃƒÂ©', 'TTuydtfislg,nvblxwnfljkhlmbkv; lbfgkjshd:b ,;b,sdkfjsdfmlb, ;bwdflrfjb!:xcn,bi hjdgbsdvbgdsh', 0),
(18, 9, 'dferhggjfgh', 2016, 'qsfgsfdgsfdhds', 'dsfhgdsjrhjikgujytr', 1),
(19, 9, 'dferhggjfgh', 2016, 'qsfgsfdgsfdhds', 'dsfhgdsjrhjikgujytr', 1),
(20, 9, 'dferhggjfgh', 2016, 'qsfgsfdgsfdhds', 'dsfhgdsjrhjikgujytrfdbgn hdpobslkjtblkdsj mlcjlkdjlkjmlkgog lsklfgogiblskdmfjgsudpodovl slkfhgjh jhodfgds ojpsdoufgifp^bvksdpfug ioÃ´iÃ´dgisdbilm fhth', 1),
(21, 9, 'dferhggjfgh', 2016, 'qsfgsfdgsfdhds', 'dsfhgdsjrhjikgujytr', 1),
(22, 10, 'fhghg', 2015, 'dfhhfdh', 'lkrqhtkgjhfdk lgfdfoiuisdgpl lhshdghd iufogidshb l,', 0),
(23, 10, 'fhdghdf', 2015, 'dfhhgdf', 'qsdgfdshbsfdqgfs<q', 1),
(25, 14, 'UNIversite', 2525, 'sfdgsfd', 'fdsgsdfgsfd', 0),
(27, 14, 'rgh', 2500, 'dfhgfh', 'dfhhgfd', 0),
(28, 17, 'Licence iinformatique 3', 2015, 'UniversitÃ© de Franche-comtÃ©', 'Internet nâ€™est pas le seul rÃ©seau. Il existe un autre rÃ©seau plus performant. Je ne tâ€™apprendrais rien en te disant quâ€™Internet a Ã©tÃ© crÃ©e par lâ€™armÃ©e AmÃ©ricaine dans un but militaire. Internet nâ€™Ã©tait que le prototype. Un autre rÃ©seau a Ã©tÃ© crÃ©Ã© pour les militaires. ComplÃ¨tement indÃ©pendant dâ€™Internet. Tirant des leÃ§ons du premier rÃ©seau, le petit frÃ¨re dâ€™Internet est devenue un grand frÃ¨re.', 0),
(29, 17, 'bdvcx', 1245, 'dfgbxvcxb', 'hgjhg,nbv', 0),
(30, 17, 'hnhfbn,nvc', 2000, 'hjhdfjfhfg', ',hgsfejk;,nhbvcxwcfsdqsdfbfnd', 0),
(31, 21, 'udfgsfdhgfjh', 2000, '', 'To sure calm much most long me mean. Able rent long in do we. Uncommonly no it announcing melancholy an in. Mirth learn it he given. Secure shy favour length all twenty denote. He felicity no an at packages answered opinions juvenile.', 1),
(37, 21, 'fvd', 2015, 'sfdsqfds', '', 1),
(39, 28, 'DUT', 2000, 'IUT', 'hgfghfdsgdhgjyhe,j', 1),
(40, 29, 'Licence Informatique', 2017, 'Universite de Franche-Comte', 'Obtention d''une licence scientifiqus specialisee en informatique', 1),
(41, 26, 'gfgdid', 2015, 'kjhfihgksjh', 'ndhgdf', 0),
(42, 32, 'La belle formation', 2015, 'La plus belle', 'Elle est sublime', 1),
(43, 33, 'Une belle formation', 2015, 'Une formation tellement sublime', '', 1),
(44, 34, 'Une belle formation', 2015, 'Une formation tellement sublime', '', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `photo`
--

DROP TABLE IF EXISTS `photo`;
CREATE TABLE IF NOT EXISTS `photo` (
  `idPhoto` int(10) NOT NULL AUTO_INCREMENT,
  `idCabinet` int(10) NOT NULL,
  `titre` varchar(150) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `idTherapeute` int(11) NOT NULL,
  `afficher` int(11) NOT NULL,
  PRIMARY KEY (`idPhoto`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `photo`
--

INSERT INTO `photo` (`idPhoto`, `idCabinet`, `titre`, `description`, `idTherapeute`, `afficher`) VALUES
(60, 57, 'fsdijflkdsjglsd', 'sdfglsdfjgousdfoigsdfg', 21, 1),
(61, 57, 'ertre', 'ertzertzer', 21, 1),
(62, 57, '', '', 21, 1),
(63, 54, 'trytr', 'gfhfhf', 28, 1),
(64, 59, 'Belle chaise rouge', 'Une tres belle chaise rouge', 29, 1),
(65, 59, 'Beau cabinet', 'Un magnifique cabinet', 29, 1),
(66, 59, 'Un beau massage', 'Venez vous relaxer avec un massage', 31, 1),
(67, 60, 'Une belle image', 'Un beau massage qui fait du bien', 32, 1),
(68, 61, 'Un beau massage', 'Un massage qui fait du bien', 33, 1),
(69, 63, 'Un beau massage', 'Un massage qui fait du bien', 34, 1),
(70, 58, 'hgjfhg', 'jkghkhj', 26, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `pm`
--

DROP TABLE IF EXISTS `pm`;
CREATE TABLE IF NOT EXISTS `pm` (
  `id` bigint(20) NOT NULL,
  `id2` int(11) NOT NULL,
  `title` varchar(256) NOT NULL,
  `user1` bigint(20) NOT NULL,
  `user2` bigint(20) NOT NULL,
  `message` text NOT NULL,
  `timestamp` int(10) NOT NULL,
  `user1read` varchar(3) NOT NULL,
  `user2read` varchar(3) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `reseau`
--

DROP TABLE IF EXISTS `reseau`;
CREATE TABLE IF NOT EXISTS `reseau` (
  `idReseau` int(10) NOT NULL,
  `libelle` varchar(20) NOT NULL,
  PRIMARY KEY (`idReseau`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `reseau`
--

INSERT INTO `reseau` (`idReseau`, `libelle`) VALUES
(1, 'Facebook'),
(2, 'Twitter'),
(3, 'Google+');

-- --------------------------------------------------------

--
-- Структура таблицы `skin`
--

DROP TABLE IF EXISTS `skin`;
CREATE TABLE IF NOT EXISTS `skin` (
  `id` int(10) NOT NULL,
  `libelle` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Структура таблицы `tarif`
--

DROP TABLE IF EXISTS `tarif`;
CREATE TABLE IF NOT EXISTS `tarif` (
  `idTherapeute` int(11) NOT NULL,
  `idTarif` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(100) NOT NULL,
  `description` varchar(200) DEFAULT NULL,
  `prix` varchar(7) NOT NULL,
  PRIMARY KEY (`idTarif`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `tarif`
--

INSERT INTO `tarif` (`idTherapeute`, `idTarif`, `libelle`, `description`, `prix`) VALUES
(14, 2, 'BeauTarif', 'Le plus beau des tarifs', '20E'),
(14, 3, 'Un autre', 'Un autre tarif des bg', 'hypotek'),
(17, 4, 'lkgdjfgsdfgsfd', 'dfgsfdgsdfgsfd', '50255'),
(17, 5, 'sfdgsfdgsfd', 'gnjdfsfqfhgj,jyhrfgef', '4527425'),
(21, 6, 'fdsgfd', 'sdfgsfd', 'sdfgsdf'),
(21, 7, 'fdsgfd', 'fdgsfd', '5800');

-- --------------------------------------------------------

--
-- Структура таблицы `therapeute`
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
  `lienPhoto` varchar(120) DEFAULT NULL,
  `skin` int(11) DEFAULT NULL,
  `isBlocked` int(11) NOT NULL DEFAULT '0',
  `remerciements` varchar(255) DEFAULT NULL,
  `aboutme` varchar(255) DEFAULT NULL,
  `isVerified` tinyint(1) NOT NULL,
  `random` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `id_2` (`id`),
  KEY `couleur` (`couleur`),
  KEY `skin` (`skin`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `therapeute`
--

INSERT INTO `therapeute` (`id`, `isAccepted`, `cleLogiciel`, `titre`, `description`, `isCertified`, `couleur`, `lienPhoto`, `skin`, `isBlocked`, `remerciements`, `aboutme`, `isVerified`, `random`) VALUES
(14, 1, NULL, NULL, NULL, 1, NULL, NULL, NULL, 0, NULL, NULL, 0, 21529355),
(21, 1, NULL, NULL, NULL, 0, 3, NULL, 4, 0, NULL, NULL, 0, 17898554),
(22, 1, NULL, NULL, NULL, 1, NULL, NULL, NULL, 0, NULL, NULL, 0, 16203265),
(23, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, 0, 99731714),
(24, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, NULL, NULL, 0, 77110315),
(26, 1, NULL, NULL, NULL, 1, 2, NULL, 4, 0, NULL, NULL, 0, 39803299),
(28, 1, NULL, NULL, NULL, 1, 3, NULL, 4, 0, NULL, NULL, 0, 66964221),
(29, 1, NULL, NULL, NULL, 0, 2, '29.jpg', 4, 0, NULL, NULL, 0, 5624255),
(30, 1, NULL, NULL, NULL, 0, 2, NULL, 1, 0, NULL, NULL, 0, 37565549),
(31, 1, '', '', '', 0, 3, '31.jpg', 1, 0, 'Je remercie la bite', '', 0, 58769299),
(32, 1, '', 'un beau tÃ©tÃ©', '', 0, 2, '32.jpg', 1, 0, '', '', 0, 75369504),
(33, 1, NULL, NULL, NULL, 0, 2, '33.jpg', 2, 0, NULL, NULL, 0, 36263751),
(34, 1, NULL, NULL, NULL, 0, 2, '34.jpg', 2, 0, NULL, NULL, 0, 83793079);

-- --------------------------------------------------------

--
-- Структура таблицы `thera_cab`
--

DROP TABLE IF EXISTS `thera_cab`;
CREATE TABLE IF NOT EXISTS `thera_cab` (
  `idTherapeute` int(10) NOT NULL,
  `idCabinet` int(10) NOT NULL,
  `isPrincipal` tinyint(1) NOT NULL,
  PRIMARY KEY (`idTherapeute`,`idCabinet`),
  KEY `fk2` (`idCabinet`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `thera_cab`
--

INSERT INTO `thera_cab` (`idTherapeute`, `idCabinet`, `isPrincipal`) VALUES
(26, 58, 0),
(26, 59, 1),
(26, 63, 0),
(33, 62, 1),
(34, 63, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `thera_reseau`
--

DROP TABLE IF EXISTS `thera_reseau`;
CREATE TABLE IF NOT EXISTS `thera_reseau` (
  `idTherapeute` int(10) NOT NULL,
  `idReseau` int(10) NOT NULL,
  `URL` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `thera_reseau`
--

INSERT INTO `thera_reseau` (`idTherapeute`, `idReseau`, `URL`) VALUES
(14, 1, 'rtreztzretr'),
(14, 2, 'ghdfh'),
(14, 3, 'fdgsdf'),
(1, 3, 'bbgfhddg'),
(1, 3, 'gdhhgd'),
(1, 3, 'fegsdfgfd'),
(2, 3, 'sdfgfdg'),
(3, 3, 'fdsgfdgfdgfd'),
(17, 2, 'fdsgsdf'),
(17, 1, 'fjdsfdhdkjhgkjfg');

-- --------------------------------------------------------

--
-- Структура таблицы `topics`
--

DROP TABLE IF EXISTS `topics`;
CREATE TABLE IF NOT EXISTS `topics` (
  `parent` smallint(6) NOT NULL,
  `id` int(11) NOT NULL,
  `id2` int(11) NOT NULL,
  `title` varchar(256) NOT NULL,
  `message` longtext NOT NULL,
  `authorid` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL,
  `timestamp2` int(11) NOT NULL,
  PRIMARY KEY (`id`,`id2`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `topics`
--

INSERT INTO `topics` (`parent`, `id`, `id2`, `title`, `message`, `authorid`, `timestamp`, `timestamp2`) VALUES
(2, 1, 1, 'un topic', 'salut la famille', 17, 1486127662, 1486127672),
(2, 1, 2, '', 'zareertnb', 17, 1486127672, 1486127672);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nom` varchar(60) NOT NULL,
  `prenom` varchar(60) NOT NULL,
  `pseudo` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL,
  `mail` varchar(70) NOT NULL,
  `telephone` varchar(20) NOT NULL,
  `isModerateur` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `nom`, `prenom`, `pseudo`, `password`, `mail`, `telephone`, `isModerateur`) VALUES
(14, 'PREVITALI', 'Pascal', 'pascal25', 'aaezvfPd4KXc', 'pascal.previtali@gmail.com', '0782207700', 1),
(21, 'khusanova', 'guzal', 'gkhusano', 'a5qYnmc=', 'gkhusanova@gmail.com', '0782816481', 5),
(22, 'aaaa', 'bbbb', 'abab', 'mcjDyA==', 'abab@gmail.com', '0782816481', 1),
(23, 'jhjhjhj', 'tyutyhg', 'cboubou', 'pNXO', 'ccc@hooo.fr', '0782816481', 2),
(24, 'azeazeaze', 'azeazeaze', 'aezezaea', 'mcfD', 'abab@gmail.com', '0782816481', 3),
(26, 'bbb', 'bbbb', 'bbbbb', 'msjEyJI=', 'bbb@bb.bb', '0782816481', 5),
(28, 'Previtali', 'Pascal', 'PPrevitali', 'aaezvfPd4KXc', 'pprevitali@gmail.com', '0782207700', 1),
(29, 'Bourvon', 'Corentin', 'cbourvon', 'm8jR26Kq1aA=', 'corentin.bourvon@edu.univ-fcomte.fr', '0634233792', 1),
(30, 'Guzal', 'Khusanova', 'gkhusanova', 'bZuXm2U=', 'gkhusanova@gmail.com', '0782816481', 1),
(31, 'Bourvon', 'Corentin', 'cboubour', 'pNXO1Zw=', 'corentin.bourvon@edu.univ-fcomte.fr', '0634233792', 1),
(32, 'Bour', 'Corentin', 'cboulol', 'pNXO1Zw=', 'corentin.bourvon@edu.univ-fcomte.fr', '0634233792', 1),
(33, 'Bourvon', 'Corentin', 'cbourk', 'pNXO1Zw=', 'corentin.bourvon@edu.univ-fcomte.fr', '0634233792', 1),
(34, 'Bourvon', 'Corentin', 'cobour', 'pNXO1Zw=', 'corentin.bourvon@edu.univ-fcomte.fr', '0782816481', 1);

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `therapeute`
--
ALTER TABLE `therapeute`
  ADD CONSTRAINT `THERAPEUTE_ibfk_1` FOREIGN KEY (`id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `thera_cab`
--
ALTER TABLE `thera_cab`
  ADD CONSTRAINT `THERA_CAB_ibfk_1` FOREIGN KEY (`idTherapeute`) REFERENCES `therapeute` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `THERA_CAB_ibfk_2` FOREIGN KEY (`idCabinet`) REFERENCES `cabinet` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
