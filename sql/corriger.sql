-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 25 fév. 2019 à 13:22
-- Version du serveur :  5.7.21
-- Version de PHP :  5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `composer`
--

-- --------------------------------------------------------

--
-- Structure de la table `corriger`
--

DROP TABLE IF EXISTS `corriger`;
CREATE TABLE IF NOT EXISTS `corriger` (
  `vraie_rep` char(2) DEFAULT NULL,
  `id_mat` varchar(15) NOT NULL,
  `id_question` int(2) NOT NULL,
  PRIMARY KEY (`id_mat`,`id_question`),
  KEY `FK_corriger_question` (`id_question`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `corriger`
--

INSERT INTO `corriger` (`vraie_rep`, `id_mat`, `id_question`) VALUES
('b', 'edu001', 1),
('c', 'edu001', 2),
('c', 'edu001', 3),
('c', 'edu001', 4),
('b', 'edu001', 5),
('b', 'edu001', 6),
('b', 'edu001', 7),
('a', 'edu001', 8),
('c', 'edu001', 9),
('c', 'edu001', 10),
('b', 'edu002', 1),
('a', 'edu002', 2),
('a', 'edu002', 3),
('c', 'edu002', 4),
('b', 'edu002', 5),
('c', 'edu002', 6),
('b', 'edu002', 7),
('c', 'edu002', 8),
('b', 'edu002', 9),
('c', 'edu002', 10),
('b', 'edu004', 1),
('c', 'edu004', 2),
('c', 'edu004', 3),
('c', 'edu004', 4),
('c', 'edu004', 5),
('c', 'edu004', 6),
('c', 'edu004', 7),
('a', 'edu004', 8),
('c', 'edu004', 9),
('b', 'edu004', 10);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `corriger`
--
ALTER TABLE `corriger`
  ADD CONSTRAINT `corriger_ibfk_1` FOREIGN KEY (`id_mat`) REFERENCES `matiere` (`id_mat`),
  ADD CONSTRAINT `corriger_ibfk_2` FOREIGN KEY (`id_question`) REFERENCES `question` (`id_question`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
