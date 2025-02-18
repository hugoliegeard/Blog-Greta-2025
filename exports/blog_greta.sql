-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 17 fév. 2025 à 10:59
-- Version du serveur : 8.0.31
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `blog_greta`
--

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id_category` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL,
  `deletedAt` datetime DEFAULT NULL,
  PRIMARY KEY (`id_category`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id_category`, `name`, `slug`, `createdAt`, `updatedAt`, `deletedAt`) VALUES
(1, 'Politique', 'politique', '2025-02-17 11:38:40', '2025-02-17 11:38:40', NULL),
(2, 'Economie', 'economie', '2025-02-17 11:38:40', '2025-02-17 11:38:40', NULL),
(3, 'Culture', 'culture', '2025-02-17 11:38:40', '2025-02-17 11:38:40', NULL),
(4, 'Loisirs', 'loisirs', '2025-02-17 11:38:40', '2025-02-17 11:38:40', NULL),
(5, 'Sports', 'sports', '2025-02-17 11:38:40', '2025-02-17 11:38:40', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `id_comment` int NOT NULL AUTO_INCREMENT,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL,
  `deletedAt` datetime NOT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_post` int NOT NULL,
  `id_user` int DEFAULT NULL,
  PRIMARY KEY (`id_comment`),
  KEY `id_post` (`id_post`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `have`
--

DROP TABLE IF EXISTS `have`;
CREATE TABLE IF NOT EXISTS `have` (
  `id_post` int NOT NULL,
  `id_keyword` int NOT NULL,
  PRIMARY KEY (`id_post`,`id_keyword`),
  KEY `id_keyword` (`id_keyword`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `keyword`
--

DROP TABLE IF EXISTS `keyword`;
CREATE TABLE IF NOT EXISTS `keyword` (
  `id_keyword` int NOT NULL AUTO_INCREMENT,
  `name_keyword` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `slug_keyword` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL,
  `deletedAt` datetime DEFAULT NULL,
  PRIMARY KEY (`id_keyword`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `post`
--

DROP TABLE IF EXISTS `post`;
CREATE TABLE IF NOT EXISTS `post` (
  `id_post` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL,
  `deletedAt` datetime DEFAULT NULL,
  `id_category` int NOT NULL,
  `id_user` int NOT NULL,
  PRIMARY KEY (`id_post`),
  KEY `id_category` (`id_category`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `post`
--

INSERT INTO `post` (`id_post`, `title`, `slug`, `content`, `image`, `createdAt`, `updatedAt`, `deletedAt`, `id_category`, `id_user`) VALUES
(1, 'Les nouvelles alliances diplomatiques', 'alliances-diplomatiques', 'Un regard sur les relations internationales et les nouvelles alliances stratégiques...', 'image11.jpg', '2025-02-17 11:38:40', '2025-02-17 11:38:40', NULL, 1, 1),
(2, 'Réforme fiscale : impacts et controverses', 'reforme-fiscale', 'Décryptage des effets de la réforme fiscale sur l\'économie et la société...', 'image12.jpg', '2025-02-17 11:38:40', '2025-02-17 11:38:40', NULL, 1, 1),
(3, 'Cryptomonnaies : avenir de la finance ?', 'cryptomonnaies-finance', 'Analyse des opportunités et des risques des monnaies numériques...', 'image13.jpg', '2025-02-17 11:38:40', '2025-02-17 11:38:40', NULL, 2, 1),
(4, 'Start-ups et innovation en France', 'startups-innovation', 'Les jeunes entreprises qui révolutionnent les secteurs traditionnels...', 'image14.jpg', '2025-02-17 11:38:40', '2025-02-17 11:38:40', NULL, 2, 1),
(5, 'Festival du film francophone', 'festival-film-francophone', 'Une plongée dans le meilleur du cinéma francophone...', 'image15.jpg', '2025-02-17 11:38:40', '2025-02-17 11:38:40', NULL, 3, 1),
(6, 'Les nouvelles tendances en littérature', 'tendances-litterature', 'Les styles et auteurs émergents à suivre...', 'image16.jpg', '2025-02-17 11:38:40', '2025-02-17 11:38:40', NULL, 3, 1),
(7, 'Voyager autrement : l’éco-tourisme', 'eco-tourisme', 'Les nouvelles façons de voyager en respectant la planète...', 'image17.jpg', '2025-02-17 11:38:40', '2025-02-17 11:38:40', NULL, 4, 1),
(8, 'Les jeux de société modernes', 'jeux-societe-modernes', 'Retour sur l’essor des jeux de société innovants...', 'image18.jpg', '2025-02-17 11:38:40', '2025-02-17 11:38:40', NULL, 4, 1),
(9, 'La Coupe du Monde approche : enjeux et favoris', 'coupe-monde-enjeux', 'Tout savoir sur les équipes favorites de la prochaine Coupe du Monde...', 'image19.jpg', '2025-02-17 11:38:40', '2025-02-17 11:38:40', NULL, 5, 1),
(10, 'Les nouvelles techniques d’entraînement en sport', 'techniques-entrainement-sport', 'Les méthodes modernes pour améliorer les performances sportives...', 'image20.jpg', '2025-02-17 11:38:40', '2025-02-17 11:38:40', NULL, 5, 1),
(11, 'Les tensions géopolitiques actuelles', 'tensions-geopolitiques', 'Une analyse des conflits en cours et de leur impact international...', 'image21.jpg', '2025-02-17 11:39:52', '2025-02-17 11:39:52', NULL, 1, 1),
(12, 'Les nouvelles mesures écologiques du gouvernement', 'mesures-ecologiques', 'Zoom sur les politiques vertes mises en place récemment...', 'image22.jpg', '2025-02-17 11:39:52', '2025-02-17 11:39:52', NULL, 1, 1),
(13, 'L\'évolution du marché immobilier en France', 'marche-immobilier', 'Comment les prix évoluent et quelles sont les tendances actuelles...', 'image23.jpg', '2025-02-17 11:39:52', '2025-02-17 11:39:52', NULL, 2, 1),
(14, 'Les nouvelles technologies qui transforment l\'économie', 'technologies-economie', 'De l\'intelligence artificielle à la blockchain, comment l\'économie s\'adapte...', 'image24.jpg', '2025-02-17 11:39:52', '2025-02-17 11:39:52', NULL, 2, 1),
(15, 'Les tendances musicales de l\'année', 'tendances-musicales', 'Quels artistes et genres dominent actuellement la scène musicale...', 'image25.jpg', '2025-02-17 11:39:52', '2025-02-17 11:39:52', NULL, 3, 1),
(16, 'Les grandes expositions à ne pas manquer', 'grandes-expositions', 'Tour d\'horizon des événements artistiques incontournables...', 'image26.jpg', '2025-02-17 11:39:52', '2025-02-17 11:39:52', NULL, 3, 1),
(17, 'Les meilleures destinations pour un week-end détente', 'weekend-detente', 'Où partir pour se ressourcer et profiter d\'un bon moment de détente...', 'image27.jpg', '2025-02-17 11:39:52', '2025-02-17 11:39:52', NULL, 4, 1),
(18, 'Les nouvelles tendances dans l\'univers du gaming', 'tendances-gaming', 'Jeux vidéo et innovations à suivre cette année...', 'image28.jpg', '2025-02-17 11:39:52', '2025-02-17 11:39:52', NULL, 4, 1),
(19, 'Le top des compétitions sportives en 2025', 'competitions-sportives', 'Les événements à suivre pour les passionnés de sport...', 'image29.jpg', '2025-02-17 11:39:52', '2025-02-17 11:39:52', NULL, 5, 1),
(20, 'Les nouvelles techniques d’entraînement en sport', 'techniques-entrainement-sport', 'Les méthodes modernes pour améliorer les performances sportives...', 'image20.jpg', '2025-02-17 11:39:52', '2025-02-17 11:39:52', NULL, 5, 1);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `lastname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `roles` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL,
  `deletedAt` datetime DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id_user`, `firstname`, `lastname`, `username`, `email`, `password`, `roles`, `createdAt`, `updatedAt`, `deletedAt`) VALUES
(1, 'Jean', 'Dupont', 'jdupont', 'jean.dupont@example.com', 'password123', 'ROLE_USER', '2025-02-17 11:42:55', '2025-02-17 11:42:55', NULL);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`id_post`) REFERENCES `post` (`id_post`),
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Contraintes pour la table `have`
--
ALTER TABLE `have`
  ADD CONSTRAINT `have_ibfk_1` FOREIGN KEY (`id_post`) REFERENCES `post` (`id_post`),
  ADD CONSTRAINT `have_ibfk_2` FOREIGN KEY (`id_keyword`) REFERENCES `keyword` (`id_keyword`);

--
-- Contraintes pour la table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`id_category`) REFERENCES `category` (`id_category`),
  ADD CONSTRAINT `post_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
