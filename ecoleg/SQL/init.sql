-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  ven. 16 mars 2018 à 10:15
-- Version du serveur :  5.7.19
-- Version de PHP :  5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `covoiturage`
--

-- --------------------------------------------------------

--
-- Structure de la table `covoiturage`
--

DROP TABLE IF EXISTS `covoiturage`;
CREATE TABLE IF NOT EXISTS `covoiturage` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ADRESSE` varchar(255) NOT NULL,
  `ID_GROUPE` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `FK_covoiturage_groupe` (`ID_GROUPE`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `covoiturage`
--

INSERT INTO `covoiturage` (`ID`, `ADRESSE`, `ID_GROUPE`) VALUES
(1, '81570 Fréjeville, France', 1),
(2, 'Route de Lautrec, 81100 Castres, France', 1);

-- --------------------------------------------------------

--
-- Structure de la table `groupe`
--

DROP TABLE IF EXISTS `groupe`;
CREATE TABLE IF NOT EXISTS `groupe` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `LIBELLE` varchar(255) NOT NULL,
  `DESTINATION` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `groupe`
--

INSERT INTO `groupe` (`ID`, `LIBELLE`, `DESTINATION`) VALUES
(1, 'Groupe a  3', '5 Rue Jean Borotra, 81000 Albi, France');

-- --------------------------------------------------------

--
-- Structure de la table `groupepassager`
--

DROP TABLE IF EXISTS `groupepassager`;
CREATE TABLE IF NOT EXISTS `groupepassager` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_PASSAGER` int(11) NOT NULL,
  `ID_GROUPE` int(11) NOT NULL,
  `COMPTEUR` int(11) DEFAULT '0',
  `KMS` int(11) DEFAULT '0',
  `DATE_CONDUCTEUR` date DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `indexGroupePassager` (`ID_GROUPE`,`ID_PASSAGER`),
  KEY `FK_groupePassager_passager` (`ID_PASSAGER`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `groupepassager`
--

INSERT INTO `groupepassager` (`ID`, `ID_PASSAGER`, `ID_GROUPE`, `COMPTEUR`, `KMS`, `DATE_CONDUCTEUR`) VALUES
(1, 1, 1, 0, 0, NULL),
(2, 2, 1, 0, 0, NULL),
(3, 3, 1, 0, 0, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `passager`
--

DROP TABLE IF EXISTS `passager`;
CREATE TABLE IF NOT EXISTS `passager` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NOM` varchar(100) NOT NULL,
  `PRENOM` varchar(100) NOT NULL,
  `ADRESSE` varchar(255) NOT NULL,
  `EMAIL` varchar(100) NOT NULL,
  `TELEPHONE` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `EMAIL` (`EMAIL`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `passager`
--

INSERT INTO `passager` (`ID`, `NOM`, `PRENOM`, `ADRESSE`, `EMAIL`, `TELEPHONE`) VALUES
(1, 'VALERY', 'Stephane', 'Chemin des Herissous, 81710 Saix, France', 'stephanevalery81@gmail.com', '06.87.80.58.35'),
(2, 'GAIGNARD', 'Rene-Louis', '81700 Puylaurens, France', 'stephanevalery82@gmail.com', '06.87.80.58.35'),
(3, 'FAURE', 'Thierry', 'En Priou, 81580 Cambounet-sur-le-Sor, France', 'stephanevalery83@gmail.com', '06.87.80.58.35');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
