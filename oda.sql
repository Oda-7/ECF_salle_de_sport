-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : sam. 05 nov. 2022 à 20:16
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `oda`
--

-- --------------------------------------------------------

--
-- Structure de la table `modules`
--

DROP TABLE IF EXISTS `modules`;
CREATE TABLE IF NOT EXISTS `modules` (
  `id` int(11) NOT NULL,
  `name` int(11) NOT NULL,
  `description` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `salles`
--

DROP TABLE IF EXISTS `salles`;
CREATE TABLE IF NOT EXISTS `salles` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `adress` text NOT NULL,
  `description` text,
  `name_img` varchar(100) DEFAULT NULL,
  `size` bigint(250) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `bin` longblob,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `age` datetime DEFAULT NULL,
  `confirmed_at` datetime NOT NULL,
  `reset_token` varchar(60) NOT NULL,
  `reset_at` int(11) NOT NULL,
  `remember_token` int(250) NOT NULL,
  `roles` int(10) NOT NULL,
  `salle_id` int(100) DEFAULT NULL,
  `module_id` int(11) DEFAULT NULL,
  `user_secret` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `salle_id` (`salle_id`),
  KEY `module_id` (`module_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `surname`, `email`, `password`, `age`, `confirmed_at`, `reset_token`, `reset_at`, `remember_token`, `roles`, `salle_id`, `module_id`, `user_secret`) VALUES
(1, 'Fitness Core', 'PDG', 'pdg@fitnesscore.fr', '$2y$10$b/AcL0D7GNjmAQtruU4jQO5LAR4X5inZigoSh.FTHT70d/bqwCA5m', '2022-10-20 00:00:00', '2022-10-29 01:56:34', '', 0, 0, 6, NULL, 0, 7);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
