-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 13 déc. 2024 à 10:25
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gestion_commande`
--

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `ID_commande` int(11) NOT NULL,
  `date_commande` date DEFAULT NULL,
  `etat` varchar(50) DEFAULT NULL,
  `id_produit` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `id_utilisateur` int(11) DEFAULT NULL,
  `idLivraison` int(11) DEFAULT NULL,
  `ref_commande` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`ID_commande`, `date_commande`, `etat`, `id_produit`, `quantite`, `id_utilisateur`, `idLivraison`, `ref_commande`) VALUES
(81, '2024-12-06', 'en attente', 2, 1, 1, NULL, 'REF0081'),
(82, '2024-12-07', 'en attente', 2, 5, 1, NULL, 'REF0082'),
(83, '2024-12-07', 'en attente', 1, 6, 1, NULL, 'REF0083'),
(84, '2024-12-07', 'en attente', 1, 3, 1, NULL, 'REF0084'),
(85, '2024-12-07', 'en attente', 1, 1, 1, NULL, 'REF0085'),
(86, '2024-12-07', 'en attente', 2, 2, 1, NULL, 'REF0086');

-- --------------------------------------------------------

--
-- Structure de la table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `rating` int(11) NOT NULL CHECK (`rating` between 1 and 5),
  `comment` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `admin_response` text DEFAULT NULL,
  `client_response` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `feedback`
--

INSERT INTO `feedback` (`id`, `rating`, `comment`, `created_at`, `admin_response`, `client_response`) VALUES
(15, 2, 'hii', '2024-12-08 17:42:19', 'hello', 'ok'),
(23, 1, 'merci', '2024-12-08 23:32:53', 'okkk', 'ok'),
(24, 2, 'parfait', '2024-12-09 08:42:05', 'merci', NULL),
(25, 2, 'parfait', '2024-12-09 08:42:49', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `livraison`
--

CREATE TABLE `livraison` (
  `ID_livraison` int(11) NOT NULL,
  `ville` varchar(255) NOT NULL,
  `codePostal` int(11) NOT NULL,
  `Adresse_de_Livraison` varchar(255) DEFAULT NULL,
  `Date_d_envoi` date DEFAULT NULL,
  `Statut_de_Livraison` varchar(50) DEFAULT NULL,
  `Date_de_Livraison_Estimee` date DEFAULT NULL,
  `idUser` int(11) NOT NULL,
  `ref_commande` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `livraison`
--

INSERT INTO `livraison` (`ID_livraison`, `ville`, `codePostal`, `Adresse_de_Livraison`, `Date_d_envoi`, `Statut_de_Livraison`, `Date_de_Livraison_Estimee`, `idUser`, `ref_commande`) VALUES
(110, 'tunisie', 1234, 'ariana', NULL, NULL, NULL, 1, 'REF0081'),
(112, 'ariana', 1234, 'aaaaaaaa', NULL, NULL, NULL, 1, 'REF0083'),
(113, 'ariana', 1234, 'aaaaaaaa', NULL, NULL, NULL, 1, 'REF0083'),
(114, 'ariana', 1234, 'aaaaaaaa', NULL, NULL, NULL, 1, 'REF0083'),
(115, 'ariana', 1234, 'aaaaaaaa', NULL, NULL, NULL, 1, 'REF0083'),
(116, 'ariana', 1234, 'aaaaaaaa', NULL, NULL, NULL, 1, 'REF0083'),
(117, 'ariana', 1234, 'aaaaaaaa', NULL, NULL, NULL, 1, 'REF0083'),
(118, 'ariana', 1234, 'aaaaaaaa', NULL, NULL, NULL, 1, 'REF0083'),
(160, 'sousse', 2154, 'ariana', NULL, NULL, NULL, 1, 'REF0083');

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `idProduit` int(11) NOT NULL,
  `NomProduit` varchar(255) NOT NULL,
  `prix` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`idProduit`, `NomProduit`, `prix`) VALUES
(1, 'produit1', 100),
(2, 'produit2', 15);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id_utilisateur` int(11) NOT NULL,
  `nom` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `mdp` varchar(255) DEFAULT NULL,
  `adresse` varchar(255) DEFAULT NULL,
  `telephone` varchar(15) DEFAULT NULL,
  `date_naissance` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id_utilisateur`, `nom`, `email`, `mdp`, `adresse`, `telephone`, `date_naissance`) VALUES
(1, 'aaa', 'aa@gmail.com', 'aaaa', 'aaa', '6666666', '2024-11-05');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`ID_commande`),
  ADD KEY `id_utilisateur` (`id_utilisateur`),
  ADD KEY `idLivraison` (`idLivraison`),
  ADD KEY `idProduit` (`id_produit`),
  ADD KEY `ref_commande` (`ref_commande`);

--
-- Index pour la table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `livraison`
--
ALTER TABLE `livraison`
  ADD PRIMARY KEY (`ID_livraison`),
  ADD KEY `idUser` (`idUser`),
  ADD KEY `ref_commande` (`ref_commande`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`idProduit`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id_utilisateur`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `ID_commande` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT pour la table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT pour la table `livraison`
--
ALTER TABLE `livraison`
  MODIFY `ID_livraison` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=180;

--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
  MODIFY `idProduit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id_utilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `commande_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`),
  ADD CONSTRAINT `idLivraison` FOREIGN KEY (`idLivraison`) REFERENCES `livraison` (`ID_livraison`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `idProduit` FOREIGN KEY (`id_produit`) REFERENCES `produit` (`idProduit`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `livraison`
--
ALTER TABLE `livraison`
  ADD CONSTRAINT `idUser` FOREIGN KEY (`idUser`) REFERENCES `utilisateur` (`id_utilisateur`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
