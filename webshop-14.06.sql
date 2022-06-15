-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 14, 2022 at 07:03 PM
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
  `name` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `quantity` int(11) NOT NULL,
  `image` varchar(200) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`name`, `description`, `price`, `quantity`, `image`, `date_added`) VALUES
('Lenovo V15 82NB003LGE - 15,6\" FHD, Intel Core i5-10210U, 8GB RAM, 256GB SSD...', 'Der Lenovo V15-IML ist ein schlanker Laptop, der nicht die Welt kostet. Dennoch wartet er mit einer starken Ausstattung auf: Schneller Arbeitsspeicher trifft auf eine zeitgerechte SSD, ein Full-HD IPS Display und Intels kraftvollem Comet-Lake-Prozessor. Wir wollten herausfinden, ob der Lenovo V15-IML auch abseits des Datenblatts überzeugen kann:', '590', 3, 'https://media.nbb-cdn.de/images/products/740000/747092/Lenovo_V15_IIL_CT1_01.png.jpg?size=400', '2022-06-14 16:32:36');

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
(13, 'Mansour', 'Tumeh', 'mansor.dci@gmail.com', '53f98bd88cc383f9adf736f9880e95fa33a72537215ea4b119d92c4912269887ca444d6b255fe6cb20fb159fc08ad9e9fda9f375551d735559ae46224aceffb6', '$gwVAT1iY'),
(14, 'Hubert', 'Thie', 'hub@gmail.com', '5a341c028c89716e62e9025cdd7492745b371f50d7ce2802f37ef61643b70dce6c8a177a33fba76b1d52ce635b0bed0dcf8a7fb08970b29d8bd7e74b3664db55', '$nUp7Npgg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
