-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 11 fév. 2021 à 16:56
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

--
-- Déchargement des données de la table `appointment`
--

INSERT INTO `appointment` (`id`, `date`, `start_time`, `end_time`, `canceled`, `created_at`, `deleted_at`, `customer_id`, `barber_id`, `service_id`) VALUES
(2, '2021-02-12', '14:00:00', '14:30:00', 0, '2021-02-05 18:58:22', NULL, 1, 1, 1),
(3, '2021-02-10', '14:00:00', '14:30:00', 0, '2021-02-05 18:59:41', NULL, 1, 1, 3),
(4, '2021-02-09', '14:00:00', '14:30:00', 0, '2021-02-09 00:00:00', NULL, 1, 1, 3),
(5, '2021-02-09', '16:00:00', '16:30:00', 0, '2021-02-09 00:00:00', NULL, 1, 1, 8);

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
(1, 0);

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

--
-- Déchargement des données de la table `customer`
--

INSERT INTO `customer` (`id`, `last_name`, `address`, `city`, `zipcode`) VALUES
(1, 'park', '1 rue blaise pascal', 'houilles', '78800');

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
  `price` double NOT NULL,
  `created_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `service`
--

INSERT INTO `service` (`id`, `title`, `description`, `time`, `price`, `created_at`, `deleted_at`, `category`) VALUES
(1, 'Chewbacca Men', 'shampooing, coupe, coiffage', '00:30:00', 36, '2021-02-03 19:13:27', NULL, 'chewbacca hair cut \"autour des cheveux\"'),
(2, 'Little Chewbacca', '-20ans', '00:30:00', 28, '2021-02-03 19:13:27', NULL, 'chewbacca hair cut \"autour des cheveux\"'),
(3, 'Baby Chewbacca', '-12ans', '00:30:00', 25, '2021-02-03 19:13:27', NULL, 'chewbacca hair cut \"autour des cheveux\"'),
(4, 'No Hair', 'rasage du crâne au coupe-chou', '00:45:00', 41, '2021-02-03 19:13:27', NULL, 'chewbacca hair cut \"autour des cheveux\"'),
(5, 'Clippers Cut', 'coupe à la tondeuse', '00:30:00', 29, '2021-02-03 19:13:27', NULL, 'chewbacca hair cut \"autour des cheveux\"'),
(6, 'Fresh Beard', 'taille de barbe simple', '00:30:00', 24, '2021-02-03 19:13:27', NULL, 'the chewbacca beard \"autour de la barbe\"'),
(7, 'Chewbacca Beard', 'taille de barbe, finitions au coupe-chou', '00:15:00', 32, '2021-02-03 19:13:27', NULL, 'the chewbacca beard \"autour de la barbe\"'),
(8, 'Best Mustache', 'taille de moustache', '00:15:00', 8, '2021-02-03 19:13:27', NULL, 'the chewbacca beard \"autour de la barbe\"'),
(9, 'Dandy Beard', 'rasage à l\'ancienne à la vapeur', '01:00:00', 50, '2021-02-03 19:13:27', NULL, 'the chewbacca beard \"autour de la barbe\"'),
(10, 'Styling Beard', 'brushing de barbe', '00:10:00', 12, '2021-02-03 19:13:27', NULL, 'the chewbacca beard \"autour de la barbe\"'),
(11, 'Perfect Chewbacca', 'chewbacca men + chewbacca beard', '01:00:00', 62, '2021-02-03 19:13:27', NULL, 'combos'),
(12, 'Gentlemen Chewbacca', 'chewbacca men + dandy beard', '01:30:00', 80, '2021-02-03 19:13:27', NULL, 'combos'),
(13, 'Father & Son', 'coupe père & fils', '01:00:00', 55, '2021-02-03 19:13:28', NULL, 'combos'),
(14, 'test hair', 'test', '00:30:00', 36, '2021-02-11 00:00:00', NULL, 'hair'),
(15, 'test beard', 'beard', '00:30:00', 28, '2021-02-11 16:28:15', NULL, 'beard');

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `first_name`, `phone`, `created_at`, `deleted_at`, `type`) VALUES
(1, 'seohypark@gmail.com', '[]', 'seohyun', 'Seohyun', '0613570437', '2021-02-04 22:15:00', NULL, 'barber');

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
