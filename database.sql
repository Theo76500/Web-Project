-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 18 nov. 2019 à 13:23
-- Version du serveur :  5.7.26
-- Version de PHP :  7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `bdecesi`
--
CREATE DATABASE IF NOT EXISTS `bdecesi` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `bdecesi`;

-- --------------------------------------------------------

--
-- Structure de la table `categorize`
--

DROP TABLE IF EXISTS `categorize`;
CREATE TABLE IF NOT EXISTS `categorize` (
  `CAT_id` int(11) NOT NULL,
  `PRO_id` int(11) NOT NULL,
  KEY `CAT_id` (`CAT_id`),
  KEY `PRO_id` (`PRO_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `compose`
--

DROP TABLE IF EXISTS `compose`;
CREATE TABLE IF NOT EXISTS `compose` (
  `PRO_id` int(11) NOT NULL,
  `ORD_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  KEY `PRO_id` (`PRO_id`),
  KEY `ORD_id` (`ORD_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `compose`
--

INSERT INTO `compose` (`PRO_id`, `ORD_id`, `quantity`) VALUES
(1, 1, 2),
(4, 2, 4),
(6, 4, 7),
(8, 5, 8),
(9, 6, 28),
(1, 7, 8);

-- --------------------------------------------------------

--
-- Structure de la table `order`
--

DROP TABLE IF EXISTS `order`;
CREATE TABLE IF NOT EXISTS `order` (
  `ORD_id` int(11) NOT NULL,
  `USE_id` int(11) NOT NULL,
  KEY `ORD_id` (`ORD_id`),
  KEY `USE_id` (`USE_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `register`
--

DROP TABLE IF EXISTS `register`;
CREATE TABLE IF NOT EXISTS `register` (
  `ACT_id` int(11) NOT NULL,
  `USE_id` int(11) NOT NULL,
  KEY `ACT_id` (`ACT_id`),
  KEY `USE_id` (`USE_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `register`
--

INSERT INTO `register` (`ACT_id`, `USE_id`) VALUES
(1, 1),
(1, 1),
(1, 1),
(1, 1),
(1, 1),
(1, 1),
(1, 1),
(8, 1);

-- --------------------------------------------------------

--
-- Structure de la table `t_activities`
--

DROP TABLE IF EXISTS `t_activities`;
CREATE TABLE IF NOT EXISTS `t_activities` (
  `ACT_id` int(11) NOT NULL AUTO_INCREMENT,
  `ACT_name` varchar(100) NOT NULL,
  `ACT_price` decimal(10,0) DEFAULT NULL,
  `ACT_description` text,
  `ACT_date` timestamp NULL DEFAULT NULL,
  `ACT_likes` int(11) DEFAULT NULL,
  `ACT_place` varchar(255) DEFAULT NULL,
  `ACT_created_at` timestamp NULL DEFAULT NULL,
  `ACT_updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ACT_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `t_activities`
--

INSERT INTO `t_activities` (`ACT_id`, `ACT_name`, `ACT_price`, `ACT_description`, `ACT_date`, `ACT_likes`, `ACT_place`, `ACT_created_at`, `ACT_updated_at`) VALUES
(1, 'Football', '100', 'Tournoi de foot', '2019-11-20 11:19:47', 134, 'Terrain de foot', '2019-11-12 22:00:00', '2019-11-19 22:00:00'),
(2, 'Rugby', '30', 'Tournoi de rugby', '2019-11-13 22:00:00', 14, 'Terrain de rugby', NULL, NULL),
(3, 'Handball', '5', 'Tournoi de handball', '2019-11-12 22:00:00', 42, 'Satde municipal', NULL, NULL),
(4, 'Tennis', '4', 'Tournoi de tennis', '2019-11-20 22:00:00', 20, 'Terrain de tennis', NULL, NULL),
(5, 'Natation', '8', 'Cours de natation', '2019-11-22 22:00:00', 31, 'Piscine municipal', NULL, NULL),
(6, 'Beer-Pong', '6', 'Battle de beer-pong', '2019-11-21 22:00:00', 126, 'Bar d\'à coté', NULL, NULL),
(7, 'PHP', '3', 'Cours de PHP : Les bases', '2019-11-24 22:00:00', 50, 'Salle 112', NULL, NULL),
(8, 'Drift', NULL, 'Concour de drift', '2019-11-28 22:00:00', 78, 'Sur le parking', NULL, NULL),
(10, 'Diffusion Football', '4', 'Diffusion LDC + pizza', '2019-11-18 22:00:00', 214, 'Amphi Marconi', NULL, NULL),
(11, 'CCTL', '0', 'CCTL de la semaine', '2019-11-17 23:00:00', 1, 'Amphi Marconi', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `t_campus`
--

DROP TABLE IF EXISTS `t_campus`;
CREATE TABLE IF NOT EXISTS `t_campus` (
  `CAM_id` int(11) NOT NULL AUTO_INCREMENT,
  `CAM_name` varchar(50) NOT NULL,
  PRIMARY KEY (`CAM_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `t_campus`
--

INSERT INTO `t_campus` (`CAM_id`, `CAM_name`) VALUES
(1, 'Lille'),
(2, 'Arras'),
(3, 'Rouen'),
(4, 'Caen'),
(5, 'Nice'),
(6, 'Reims'),
(7, 'Brest'),
(8, 'Paris Nanterre'),
(9, 'Nancy'),
(10, 'Strasbourg'),
(11, 'Le Mans'),
(12, 'Saint-Nazaire'),
(13, 'Orléans'),
(14, 'Nantes'),
(15, 'Châteauroux'),
(16, 'Dijon'),
(17, 'La Rochelle'),
(18, 'Angoulême'),
(19, 'Lyon'),
(20, 'Grenoble'),
(21, 'Bordeaux'),
(22, 'Toulouse'),
(23, 'Montpellier'),
(24, 'Pau'),
(25, 'Aix-en-Provence');

-- --------------------------------------------------------

--
-- Structure de la table `t_categories`
--

DROP TABLE IF EXISTS `t_categories`;
CREATE TABLE IF NOT EXISTS `t_categories` (
  `CAT_id` int(11) NOT NULL AUTO_INCREMENT,
  `CAT_name` varchar(100) NOT NULL,
  PRIMARY KEY (`CAT_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `t_categories`
--

INSERT INTO `t_categories` (`CAT_id`, `CAT_name`) VALUES
(1, 'Vêtement'),
(2, 'Goodie');

-- --------------------------------------------------------

--
-- Structure de la table `t_comments`
--

DROP TABLE IF EXISTS `t_comments`;
CREATE TABLE IF NOT EXISTS `t_comments` (
  `COM_id` int(11) NOT NULL AUTO_INCREMENT,
  `COM_content` text NOT NULL,
  `COM_created_at` timestamp NULL DEFAULT NULL,
  `USE_id` int(11) NOT NULL,
  `ACT_id` int(11) NOT NULL,
  PRIMARY KEY (`COM_id`),
  KEY `USE_id` (`USE_id`),
  KEY `ACT_id` (`ACT_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `t_comments`
--

INSERT INTO `t_comments` (`COM_id`, `COM_content`, `COM_created_at`, `USE_id`, `ACT_id`) VALUES
(10, 'test !', '2019-11-16 00:47:45', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `t_orders`
--

DROP TABLE IF EXISTS `t_orders`;
CREATE TABLE IF NOT EXISTS `t_orders` (
  `ORD_id` int(11) NOT NULL AUTO_INCREMENT,
  `ORD_date` timestamp NOT NULL,
  PRIMARY KEY (`ORD_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `t_orders`
--

INSERT INTO `t_orders` (`ORD_id`, `ORD_date`) VALUES
(1, '2019-11-06 23:00:00'),
(2, '2019-11-06 23:00:00'),
(3, '2019-11-06 23:00:00'),
(4, '2019-11-06 23:00:00'),
(5, '2019-11-06 23:00:00'),
(6, '2019-11-06 23:00:00'),
(7, '2019-11-06 23:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `t_pictures`
--

DROP TABLE IF EXISTS `t_pictures`;
CREATE TABLE IF NOT EXISTS `t_pictures` (
  `PIC_id` int(11) NOT NULL AUTO_INCREMENT,
  `PIC_name` varchar(255) NOT NULL,
  `PIC_created_at` timestamp NULL DEFAULT NULL,
  `PIC_updated_at` timestamp NULL DEFAULT NULL,
  `USE_id` int(11) DEFAULT NULL,
  `ACT_id` int(11) DEFAULT NULL,
  `PRO_id` int(11) DEFAULT NULL,
  `PIC_main` tinyint(4) NOT NULL,
  PRIMARY KEY (`PIC_id`),
  KEY `USE_id` (`USE_id`),
  KEY `ACT_id` (`ACT_id`),
  KEY `PRO_id` (`PRO_id`),
  KEY `USE_id_T_USERS` (`USE_id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `t_pictures`
--

INSERT INTO `t_pictures` (`PIC_id`, `PIC_name`, `PIC_created_at`, `PIC_updated_at`, `USE_id`, `ACT_id`, `PRO_id`, `PIC_main`) VALUES
(1, 'default.jpg', '2019-11-13 21:30:43', '2019-11-13 21:30:43', NULL, NULL, NULL, 1),
(4, 'event1.jpg', '2019-11-13 21:30:43', '2019-11-13 21:30:43', NULL, 1, NULL, 1),
(5, 'event2.jpg', '2019-11-13 21:30:43', '2019-11-13 21:30:43', NULL, 2, NULL, 1),
(6, 'handball.jpg', '2019-11-13 21:30:43', '2019-11-13 21:30:43', NULL, 3, NULL, 1),
(7, 'tennis.jpg', '2019-11-13 21:30:43', '2019-11-13 21:30:43', NULL, 4, NULL, 1),
(8, 'natation.jpg', '2019-11-13 21:30:43', '2019-11-13 21:30:43', NULL, 5, NULL, 1),
(9, 'beerpong.jpg', '2019-11-13 21:30:43', '2019-11-13 21:30:43', NULL, 6, NULL, 1),
(10, 'php.jpg', '2019-11-13 21:30:43', '2019-11-13 21:30:43', NULL, 7, NULL, 1),
(11, 'drift.jpg', '2019-11-13 21:30:43', '2019-11-13 21:30:43', NULL, 8, NULL, 1),
(13, 'tv.jpg', '2019-11-13 21:30:43', '2019-11-13 21:30:43', NULL, 10, NULL, 1),
(14, 'cctl.jpg', '2019-11-13 21:30:43', '2019-11-13 21:30:43', NULL, 11, NULL, 1),
(20, 'event2.jpg', NULL, NULL, NULL, NULL, NULL, 0),
(27, 'cool.jpg', '2019-11-18 07:36:33', '2019-11-18 07:36:33', NULL, 2, NULL, 0),
(28, 'ok2.jpeg', '2019-11-18 07:36:47', '2019-11-18 07:36:47', NULL, 2, NULL, 0),
(29, 'cool.jpg', NULL, NULL, NULL, NULL, NULL, 1),
(30, 'pull.png', NULL, NULL, NULL, NULL, 8, 1),
(31, 'pull-2.png', NULL, NULL, NULL, NULL, 9, 1),
(32, 'bonnet.png', NULL, NULL, NULL, NULL, 1, 1),
(33, 'ok3.jpeg', '2019-11-18 13:03:05', '2019-11-18 13:03:05', NULL, 3, NULL, 0);

-- --------------------------------------------------------

--
-- Structure de la table `t_products`
--

DROP TABLE IF EXISTS `t_products`;
CREATE TABLE IF NOT EXISTS `t_products` (
  `PRO_id` int(11) NOT NULL AUTO_INCREMENT,
  `PRO_name` varchar(100) NOT NULL,
  `PRO_description` text,
  `PRO_price` decimal(10,0) NOT NULL,
  `PRO_quantity` int(11) NOT NULL,
  `PRO_solde` int(11) DEFAULT NULL,
  `PRO_created_at` timestamp NULL DEFAULT NULL,
  `PRO_updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`PRO_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `t_products`
--

INSERT INTO `t_products` (`PRO_id`, `PRO_name`, `PRO_description`, `PRO_price`, `PRO_quantity`, `PRO_solde`, `PRO_created_at`, `PRO_updated_at`) VALUES
(1, 'Bonnet', 'Bonnet CESI \r\nCouleur : Bordeaux, Bleu', '11', 1, 0, '2019-11-20 22:00:00', '2019-11-14 22:00:00'),
(4, 'factice', 'factice', '54', 21, 1, '2019-11-28 23:00:00', NULL),
(6, 'factice', 'factice', '100', 1, NULL, NULL, NULL),
(8, 'pull', 'pull cesi', '100', 4, NULL, NULL, NULL),
(9, 'pull ', 'pull CESI', '45', 7, NULL, NULL, NULL),
(10, 'nom_article', 'description', '100', 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `t_roles`
--

DROP TABLE IF EXISTS `t_roles`;
CREATE TABLE IF NOT EXISTS `t_roles` (
  `ROL_id` int(11) NOT NULL AUTO_INCREMENT,
  `ROL_name` varchar(100) NOT NULL,
  `ROL_power_level` int(11) NOT NULL,
  PRIMARY KEY (`ROL_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `t_roles`
--

INSERT INTO `t_roles` (`ROL_id`, `ROL_name`, `ROL_power_level`) VALUES
(1, 'student', 1),
(2, 'cesi staff', 2),
(3, 'bde member', 3);

-- --------------------------------------------------------

--
-- Structure de la table `t_specialities`
--

DROP TABLE IF EXISTS `t_specialities`;
CREATE TABLE IF NOT EXISTS `t_specialities` (
  `SPE_id` int(11) NOT NULL AUTO_INCREMENT,
  `SPE_name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`SPE_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `t_specialities`
--

INSERT INTO `t_specialities` (`SPE_id`, `SPE_name`) VALUES
(1, 'exar'),
(2, 'ei'),
(3, 'alternance');

-- --------------------------------------------------------

--
-- Structure de la table `t_users`
--

DROP TABLE IF EXISTS `t_users`;
CREATE TABLE IF NOT EXISTS `t_users` (
  `USE_id` int(11) NOT NULL AUTO_INCREMENT,
  `USE_username` varchar(50) NOT NULL,
  `USE_password` varchar(255) NOT NULL,
  `USE_email` varchar(180) NOT NULL,
  `USE_description` text,
  `USE_created_at` timestamp NULL DEFAULT NULL,
  `USE_updated_at` timestamp NULL DEFAULT NULL,
  `PIC_id` int(11) DEFAULT NULL,
  `SPE_id` int(11) DEFAULT NULL,
  `CAM_id` int(11) NOT NULL,
  `ROL_id` int(11) NOT NULL,
  PRIMARY KEY (`USE_id`),
  KEY `SPE_id` (`SPE_id`),
  KEY `CAM_id` (`CAM_id`),
  KEY `ROL_id` (`ROL_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `t_users`
--

INSERT INTO `t_users` (`USE_id`, `USE_username`, `USE_password`, `USE_email`, `USE_description`, `USE_created_at`, `USE_updated_at`, `PIC_id`, `SPE_id`, `CAM_id`, `ROL_id`) VALUES
(1, 'Pain_Du27/', '$6$rounds=5000$scdsjdcnjsdbcshb$3phQ8yc1qMxmqH8Us6o.53hIqiaRWCedke.1NahLhzb521t3qdQ1WS/Be88ARowo8DjTI034z1zc8bjBWlcyZ0/', 'valentin.pain@hotmail.fr/', NULL, '2019-11-13 23:01:45', '2019-11-13 23:01:45', 1, 1, 1, 3);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `categorize`
--
ALTER TABLE `categorize`
  ADD CONSTRAINT `categorize_ibfk_1` FOREIGN KEY (`CAT_id`) REFERENCES `t_categories` (`CAT_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `categorize_ibfk_2` FOREIGN KEY (`PRO_id`) REFERENCES `t_products` (`PRO_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `compose`
--
ALTER TABLE `compose`
  ADD CONSTRAINT `compose_ibfk_1` FOREIGN KEY (`PRO_id`) REFERENCES `t_products` (`PRO_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `compose_ibfk_2` FOREIGN KEY (`ORD_id`) REFERENCES `t_orders` (`ORD_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`ORD_id`) REFERENCES `t_orders` (`ORD_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_ibfk_2` FOREIGN KEY (`USE_id`) REFERENCES `t_users` (`USE_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `register`
--
ALTER TABLE `register`
  ADD CONSTRAINT `register_ibfk_1` FOREIGN KEY (`ACT_id`) REFERENCES `t_activities` (`ACT_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `register_ibfk_2` FOREIGN KEY (`USE_id`) REFERENCES `t_users` (`USE_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `t_comments`
--
ALTER TABLE `t_comments`
  ADD CONSTRAINT `t_comments_ibfk_1` FOREIGN KEY (`USE_id`) REFERENCES `t_users` (`USE_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `t_comments_ibfk_2` FOREIGN KEY (`ACT_id`) REFERENCES `t_activities` (`ACT_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `t_pictures`
--
ALTER TABLE `t_pictures`
  ADD CONSTRAINT `t_pictures_ibfk_1` FOREIGN KEY (`USE_id`) REFERENCES `t_users` (`USE_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `t_pictures_ibfk_2` FOREIGN KEY (`ACT_id`) REFERENCES `t_activities` (`ACT_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `t_pictures_ibfk_3` FOREIGN KEY (`PRO_id`) REFERENCES `t_products` (`PRO_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `t_users`
--
ALTER TABLE `t_users`
  ADD CONSTRAINT `t_users_ibfk_1` FOREIGN KEY (`SPE_id`) REFERENCES `t_specialities` (`SPE_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `t_users_ibfk_2` FOREIGN KEY (`CAM_id`) REFERENCES `t_campus` (`CAM_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `t_users_ibfk_3` FOREIGN KEY (`ROL_id`) REFERENCES `t_roles` (`ROL_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
