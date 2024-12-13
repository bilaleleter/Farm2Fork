-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 13, 2024 at 10:25 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gestionproduit`
--

-- --------------------------------------------------------

--
-- Table structure for table `gerer_categorie`
--

CREATE TABLE `gerer_categorie` (
  `id_categorie` int(11) NOT NULL,
  `nom_categorie` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gerer_categorie`
--

INSERT INTO `gerer_categorie` (`id_categorie`, `nom_categorie`) VALUES
(1, 'Fruits et Légumes'),
(2, 'Produits Laitiers'),
(3, 'Viandes');

-- --------------------------------------------------------

--
-- Table structure for table `gerer_p`
--

CREATE TABLE `gerer_p` (
  `id_produit` int(11) NOT NULL,
  `nom_produit` varchar(30) DEFAULT NULL,
  `image_produit` varchar(50) DEFAULT NULL,
  `description_produit` varchar(100) NOT NULL,
  `prix` float DEFAULT NULL,
  `quantite_produit` int(11) DEFAULT NULL,
  `stock_produit` int(11) DEFAULT NULL,
  `categorie` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gerer_p`
--

INSERT INTO `gerer_p` (`id_produit`, `nom_produit`, `image_produit`, `description_produit`, `prix`, `quantite_produit`, `stock_produit`, `categorie`) VALUES
(131, 'Brie', 'uploads/fromage brie.jpeg', 'Fromage crémeux et doux, parfait pour les plateaux de fromage et les repas gourmands.', 20, 1, 20, 2),
(132, 'Camembert', 'uploads/camembert.jpg', ' Fromage au goût riche et savoureux, idéal pour les amateurs de saveurs authentiques.', 25, 1, 30, 2),
(133, 'Beaufort', 'uploads/fromage beaufort.jpeg', 'Fromage au goût fruité et robuste, parfait pour fondre dans des plats savoyards ou savourer seul.', 25, 1, 22, 2),
(134, 'Beurre', 'uploads/beurre.jpeg', 'Beurre frais et onctueux, parfait pour tartiner ou cuisiner avec une touche de douceur.', 14, 2, 21, 2),
(135, 'Mergez', 'uploads/mergez agneau.jpg', ' Saucisses épicées et savoureuses, parfaites pour les barbecues et les plats méditerranéens.', 8, 15, 20, 3),
(136, 'Makanek', 'uploads/makanek.jpeg', ' Saucisses libanaises épicées et parfumées, idéales pour les grillades, les mezzés et les plats trad', 16, 11, 15, 3),
(137, 'Viande de Canard', 'uploads/viande canard.jpeg', 'Tendre et savoureuse, parfaite pour des plats raffinés, rôtis ou confits, apportant une touche gourm', 44, 2, 12, 3),
(138, 'Viande de Boeuf', 'uploads/viande de boeuf.jpg', 'Délicate et savoureuse, parfaite pour les steaks, ragoûts, et grillades, offrant une texture tendre ', 12, 11, 33, 3),
(139, 'Viande de Dinde', 'uploads/viande dinde.jpg', 'Léger et savoureux, idéal pour des plats sains, grillades ou rôtis, offrant une alternative maigre', 16, 2, 12, 3),
(140, 'Grenadine', 'uploads/grenadine.jpg', 'freg', 0.5, 12, 21, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gerer_categorie`
--
ALTER TABLE `gerer_categorie`
  ADD PRIMARY KEY (`id_categorie`);

--
-- Indexes for table `gerer_p`
--
ALTER TABLE `gerer_p`
  ADD PRIMARY KEY (`id_produit`),
  ADD KEY `fk_produit_categorie` (`categorie`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gerer_categorie`
--
ALTER TABLE `gerer_categorie`
  MODIFY `id_categorie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `gerer_p`
--
ALTER TABLE `gerer_p`
  MODIFY `id_produit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `gerer_p`
--
ALTER TABLE `gerer_p`
  ADD CONSTRAINT `fk_produit_categorie` FOREIGN KEY (`categorie`) REFERENCES `gerer_categorie` (`id_categorie`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
