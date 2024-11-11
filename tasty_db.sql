-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 11 nov. 2024 à 17:29
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `tasty_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `reservations`
--

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `booking_date` date NOT NULL,
  `booking_time` time NOT NULL,
  `num_guests` int(11) NOT NULL,
  `special_request` text DEFAULT NULL,
  `status` enum('pending','confirmed','cancelled') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `reservations`
--

INSERT INTO `reservations` (`id`, `full_name`, `email`, `phone`, `booking_date`, `booking_time`, `num_guests`, `special_request`, `status`, `created_at`) VALUES
(2, 'soaad', 'chaf@gmail.com', '989898666', '2025-03-04', '15:05:00', 4, 'table near to the window', 'confirmed', '2024-11-11 15:55:18'),
(3, 'user1', 'user1@gmail.com', '060606066', '2025-05-12', '16:09:00', 8, 'AAAAAAAAAAAAAAAAAAAAAA', 'pending', '2024-11-11 15:57:50'),
(4, 'user2', 'user2@gmail.com', '068585858', '2024-03-12', '10:15:00', 2, 'BBBBBBBBBBBBBBBBBBBBB', 'pending', '2024-11-11 15:59:39'),
(5, 'user3', 'user3@gmail.com', '1111111111', '2024-11-11', '17:01:00', 3, 'CCCCCCCCCCCCCCCCCCCCCC', 'pending', '2024-11-11 16:01:39');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
