-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 17, 2022 at 09:31 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `image` varchar(200) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `quantity`, `image`, `date_added`) VALUES
(1, 'Lenovo V15 82NB003LGE - 15,6\" FHD, Intel Core i5-10210U, 8GB RAM, 256GB SSD...', 'Der Lenovo V15-IML ist ein schlanker Laptop, der nicht die Welt kostet. Dennoch wartet er mit einer starken Ausstattung auf: Schneller Arbeitsspeicher trifft auf eine zeitgerechte SSD, ein Full-HD IPS Display und Intels kraftvollem Comet-Lake-Prozessor. Wir wollten herausfinden, ob der Lenovo V15-IML auch abseits des Datenblatts überzeugen kann:', '590.00', 3, 'https://media.nbb-cdn.de/images/products/740000/747092/Lenovo_V15_IIL_CT1_01.png.jpg?size=400', '2022-06-14 16:32:36'),
(2, 'Apple Watch S7 Aluminium 41mm Cellular Sternenlicht (Sportarmband sternenlicht)', 'Überall, wo du bist.  Mach Anrufe und sende Nachrichten ohne dein Telefon mit optionalem Mobilfunk.◊ Lass dir mit Karten den Weg zeigen. Verwende Wallet als Schlüssel, Bordkarte oder zum Bezahlen. Und entdecke Tausende Apps im App Store.◊', '512.00', 9, 'https://media.nbb-cdn.de/images/products/730000/739733/Watch_S7Cellular41Starlight1.jpg?size=400', '2022-06-17 15:58:36'),
(3, 'Apple iPad Pro 12.9 Wi-Fi 512GB spacegrau (5.Gen. 2021)', 'Superschnelle Verbindungen.\r\nMit Kabel und ohne.\r\n\r\nÜber Thunderbolt verbindest du Pro Zubehör wie Displays und externe Festplatten. Und mit 5G Cellular Modellen bekommst du unglaubliche Geschwin­digkeiten, wenn kein WLAN verfügbar ist.', '1421.00', 12, 'https://media.nbb-cdn.de/images/products/710000/714726/1292Grau_1.jpg?size=400', '2022-06-17 16:17:10');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vorname` varchar(70) NOT NULL,
  `nachname` varchar(70) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(150) NOT NULL,
  `initialPass` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `vorname`, `nachname`, `email`, `password`, `initialPass`) VALUES
(15, 'Mansour', 'Tumeh', '88mansor@gmail.com', 'c73b1fde92a42647015064959c49d6027811bee12567a3ec4d6329c849488f18853550df7e70014129099ac269254da091533052bfc5a979341f85f204f2f1fa', 'U5GYX9jI');

-- --------------------------------------------------------

--
-- Table structure for table `warenkorb`
--

CREATE TABLE `warenkorb` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_image` varchar(200) NOT NULL,
  `quantity` int(10) NOT NULL,
  `price` int(10) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `warenkorb`
--

INSERT INTO `warenkorb` (`id`, `product_id`, `user_id`, `product_name`, `product_image`, `quantity`, `price`, `total_amount`) VALUES
(34, 3, 15, 'Apple iPad Pro 12.9 Wi-Fi 512GB spacegrau (5.Gen. 2021)', 'https://media.nbb-cdn.de/images/products/710000/714726/1292Grau_1.jpg?size=400', 3, 1421, '4263.00'),
(35, 2, 15, 'Apple Watch S7 Aluminium 41mm Cellular Sternenlicht (Sportarmband sternenlicht)', 'https://media.nbb-cdn.de/images/products/730000/739733/Watch_S7Cellular41Starlight1.jpg?size=400', 6, 512, '3072.00'),
(36, 1, 15, 'Lenovo V15 82NB003LGE - 15,6\" FHD, Intel Core i5-10210U, 8GB RAM, 256GB SSD...', 'https://media.nbb-cdn.de/images/products/740000/747092/Lenovo_V15_IIL_CT1_01.png.jpg?size=400', 1, 590, '590.00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `warenkorb`
--
ALTER TABLE `warenkorb`
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `warenkorb`
--
ALTER TABLE `warenkorb`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
