-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 13 déc. 2024 à 15:58
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `projetphp`
--

-- --------------------------------------------------------

--
-- Structure de la table `avis`
--

CREATE TABLE `avis` (
  `id` int(11) NOT NULL,
  `note` varchar(50) NOT NULL,
  `type_avis` varchar(100) NOT NULL,
  `date_avis` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `avis`
--

INSERT INTO `avis` (`id`, `note`, `type_avis`, `date_avis`) VALUES
(3, '1', 'asasa', '2024-12-02'),
(7, '7/9', 'positif', '2024-11-03'),
(15, '4', 'azzzz', '2024-12-02'),
(16, '3', 'bien', '2024-12-02'),
(17, '3', 'bien', '2024-12-02'),
(18, '3', 'tres bien', '2024-12-02'),
(19, '2', 'tres bien slouma', '2024-12-02'),
(21, '5', 'le produit est bon', '2024-12-02'),
(23, '3', 'edited', '2024-12-13'),
(26, '5', 'positif', '2024-12-13'),
(29, '3', 'motazzz', '2024-12-13'),
(30, '5', 'bil', '2024-12-13'),
(31, '4', 'motaz', '2024-12-13');

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

CREATE TABLE `commentaire` (
  `id` int(11) NOT NULL,
  `contenu` varchar(50) NOT NULL,
  `datec` date NOT NULL,
  `idAvis` int(11) NOT NULL,
  `likee` int(11) DEFAULT 0,
  `dislike` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `commentaire`
--

INSERT INTO `commentaire` (`id`, `contenu`, `datec`, `idAvis`, `likee`, `dislike`) VALUES
(12, 'jujuyju', '2024-12-23', 7, 1, 1),
(13, 'dadaddadad', '2024-12-01', 7, 0, 1),
(22, 'asasa commentaire', '2024-12-13', 3, 0, 0),
(23, 'zzzzz', '2024-12-13', 15, 0, 0),
(24, 'slouma', '2024-12-13', 19, 0, 0),
(25, 'al\r\n', '2024-12-13', 30, 1, 0),
(26, 'ghv', '2024-12-13', 3, 0, 0),
(27, 'ahah', '2024-12-13', 3, 0, 0),
(28, 'photoshop\r\n', '2024-12-13', 23, 0, 0),
(29, 'fsdf', '2024-12-13', 16, 0, 0),
(30, 'nasfi', '2024-12-13', 31, 3, 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `avis`
--
ALTER TABLE `avis`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idAvis` (`idAvis`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `avis`
--
ALTER TABLE `avis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT pour la table `commentaire`
--
ALTER TABLE `commentaire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD CONSTRAINT `commentaire_ibfk_1` FOREIGN KEY (`idAvis`) REFERENCES `avis` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
