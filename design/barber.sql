-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 23 fév. 2021 à 13:25
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `barber`
--

-- --------------------------------------------------------

--
-- Structure de la table `appointment`
--

DROP TABLE IF EXISTS `appointment`;
CREATE TABLE IF NOT EXISTS `appointment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `canceled` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `customer_id` int(11) NOT NULL,
  `barber_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_FE38F8449395C3F3` (`customer_id`),
  KEY `IDX_FE38F844BFF2FEF2` (`barber_id`),
  KEY `IDX_FE38F844ED5CA9E6` (`service_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `availability`
--

DROP TABLE IF EXISTS `availability`;
CREATE TABLE IF NOT EXISTS `availability` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `day` enum('Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi') COLLATE utf8mb4_unicode_ci NOT NULL,
  `timeOfDay` enum('Matin','Après-midi') COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `barber_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_3FB7A2BFBFF2FEF2` (`barber_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `barber`
--

DROP TABLE IF EXISTS `barber`;
CREATE TABLE IF NOT EXISTS `barber` (
  `id` int(11) NOT NULL,
  `is_admin` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `barber`
--

INSERT INTO `barber` (`id`, `is_admin`) VALUES
(3, 0),
(4, 0),
(6, 0),
(7, 0);

-- --------------------------------------------------------

--
-- Structure de la table `barber_service`
--

DROP TABLE IF EXISTS `barber_service`;
CREATE TABLE IF NOT EXISTS `barber_service` (
  `barber_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  PRIMARY KEY (`barber_id`,`service_id`),
  KEY `IDX_B6C881ABBFF2FEF2` (`barber_id`),
  KEY `IDX_B6C881ABED5CA9E6` (`service_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `barber_service`
--

INSERT INTO `barber_service` (`barber_id`, `service_id`) VALUES
(3, 7),
(3, 8),
(3, 10),
(3, 12),
(3, 13),
(3, 17),
(3, 18),
(3, 19),
(4, 4),
(4, 5),
(4, 6),
(4, 7),
(4, 8),
(4, 17),
(4, 18),
(4, 19),
(6, 10),
(6, 11),
(6, 13),
(6, 17),
(6, 18),
(6, 19),
(7, 7),
(7, 8),
(7, 9),
(7, 12),
(7, 17),
(7, 18),
(7, 19);

-- --------------------------------------------------------

--
-- Structure de la table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `id` int(11) NOT NULL,
  `last_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zipcode` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20210124174204', '2021-01-24 17:44:45', 316),
('DoctrineMigrations\\Version20210124175210', '2021-01-24 17:52:22', 104),
('DoctrineMigrations\\Version20210124175529', '2021-01-24 17:55:41', 107),
('DoctrineMigrations\\Version20210128175032', '2021-01-28 17:51:13', 362),
('DoctrineMigrations\\Version20210128175822', '2021-01-28 17:58:32', 51),
('DoctrineMigrations\\Version20210128182137', '2021-01-28 18:21:41', 405),
('DoctrineMigrations\\Version20210129085519', '2021-01-29 08:55:41', 619);

-- --------------------------------------------------------

--
-- Structure de la table `service`
--

DROP TABLE IF EXISTS `service`;
CREATE TABLE IF NOT EXISTS `service` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `time` time NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `service`
--

INSERT INTO `service` (`id`, `title`, `description`, `time`, `price`, `created_at`, `deleted_at`, `category`) VALUES
(4, 'No Hair', 'rasage du crâne au coupe-chou', '00:45:00', '41.00', '2021-02-03 19:13:27', NULL, 'chewbacca hair cut \"autour des cheveux\"'),
(5, 'Clippers Cut', 'coupe à la tondeuse', '00:30:00', '29.00', '2021-02-03 19:13:27', NULL, 'chewbacca hair cut \"autour des cheveux\"'),
(6, 'Fresh Beard', 'taille de barbe simple', '00:30:00', '24.00', '2021-02-03 19:13:27', NULL, 'the chewbacca beard \"autour de la barbe\"'),
(7, 'Chewbacca Beard', 'taille de barbe, finitions au coupe-chou', '00:15:00', '32.00', '2021-02-03 19:13:27', NULL, 'the chewbacca beard \"autour de la barbe\"'),
(8, 'Best Mustache', 'taille de moustache', '00:15:00', '8.00', '2021-02-03 19:13:27', NULL, 'the chewbacca beard \"autour de la barbe\"'),
(9, 'Dandy Beard', 'rasage à l\'ancienne à la vapeur', '01:00:00', '50.00', '2021-02-03 19:13:27', NULL, 'the chewbacca beard \"autour de la barbe\"'),
(10, 'Styling Beard', 'brushing de barbe', '00:10:00', '12.00', '2021-02-03 19:13:27', NULL, 'the chewbacca beard \"autour de la barbe\"'),
(11, 'Perfect Chewbacca', 'chewbacca men + chewbacca beard', '01:00:00', '62.00', '2021-02-03 19:13:27', NULL, 'combos'),
(12, 'Gentlemen Chewbacca', 'chewbacca men + dandy beard', '01:30:00', '80.00', '2021-02-03 19:13:27', NULL, 'combos'),
(13, 'Father & Son', 'coupe père & fils', '01:00:00', '55.00', '2021-02-03 19:13:28', NULL, 'combos'),
(17, 'Chewbacca Men', 'shampoing, coupe, coiffage', '00:30:00', '36.00', '2021-02-23 13:21:30', NULL, 'chewbacca hair cut \"autour des cheveux\"'),
(18, 'Little Chewbacca', '-20ans', '00:30:00', '25.00', '2021-02-23 13:22:19', NULL, 'chewbacca hair cut \"autour des cheveux\"'),
(19, 'Baby Chewbacca', '-12ans', '00:30:00', '25.00', '2021-02-23 13:22:40', NULL, 'chewbacca hair cut \"autour des cheveux\"');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `first_name`, `phone`, `created_at`, `deleted_at`, `type`) VALUES
(3, 'lea@chewbacca.fr', '[]', 'lea', 'Lea', '0123456789', '2021-02-23 11:50:00', NULL, 'barber'),
(4, 'eviatar@chewbacca.fr', '[]', 'eviatar', 'Eviatar', '0123456789', '2021-02-23 11:59:00', NULL, 'barber'),
(6, 'simon@chewbacca.fr', '[]', 'simon', 'Simon', '0123456789', '2021-02-23 12:16:00', NULL, 'barber'),
(7, 'seohyun@chewbacca.fr', '[]', 'seohyun', 'Seohyun', '0123456789', '2021-02-23 12:58:00', NULL, 'barber');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `FK_FE38F8449395C3F3` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`),
  ADD CONSTRAINT `FK_FE38F844BFF2FEF2` FOREIGN KEY (`barber_id`) REFERENCES `barber` (`id`),
  ADD CONSTRAINT `FK_FE38F844ED5CA9E6` FOREIGN KEY (`service_id`) REFERENCES `service` (`id`);

--
-- Contraintes pour la table `availability`
--
ALTER TABLE `availability`
  ADD CONSTRAINT `FK_3FB7A2BFBFF2FEF2` FOREIGN KEY (`barber_id`) REFERENCES `barber` (`id`);

--
-- Contraintes pour la table `barber`
--
ALTER TABLE `barber`
  ADD CONSTRAINT `FK_7C48A9A4BF396750` FOREIGN KEY (`id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `barber_service`
--
ALTER TABLE `barber_service`
  ADD CONSTRAINT `FK_B6C881ABBFF2FEF2` FOREIGN KEY (`barber_id`) REFERENCES `barber` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_B6C881ABED5CA9E6` FOREIGN KEY (`service_id`) REFERENCES `service` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `FK_81398E09BF396750` FOREIGN KEY (`id`) REFERENCES `user` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
