-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2024 at 05:07 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `onlinelaptopshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `allorder`
--

CREATE TABLE `allorder` (
  `all_order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `allorder`
--

INSERT INTO `allorder` (`all_order_id`, `user_id`, `order_id`, `product_id`, `quantity`, `price`) VALUES
(2, 1, 20, 6, 1, 35.00),
(3, 1, 27, 14, 2, 32.00),
(5, 1, 29, 6, 1, 35.00),
(6, 1, 30, 8, 1, 34222.00),
(7, 1, 31, 6, 1, 35.00),
(8, 1, 32, 6, 1, 34.00),
(9, 1, 33, 6, 1, 34.00),
(10, 1, 34, 6, 1, 34.00),
(11, 1, 35, 6, 1, 34.00),
(12, 1, 36, 6, 1, 34.00),
(13, 1, 37, 6, 3, 34.00),
(14, 1, 38, 11, 2, 32000.00),
(15, 1, 39, 6, 1, 34.00),
(16, 1, 40, 6, 3, 34.00),
(17, 1, 41, 6, 1, 34.00),
(18, 1, 42, 6, 4, 34.00),
(19, 1, 43, 6, 2, 34.00),
(20, 1, 44, 6, 2, 34.00),
(21, 1, 45, 11, 2, 32000.00),
(22, 1, 46, 6, 1, 34.00),
(23, 1, 47, 6, 1, 34.00),
(24, 1, 48, 6, 1, 34.00),
(25, 1, 49, 6, 1, 34.00),
(26, 1, 50, 6, 1, 34.00),
(27, 1, 51, 11, 1, 32000.00),
(28, 1, 52, 6, 1, 34.00),
(29, 1, 53, 8, 2, 34222.00),
(30, 1, 54, 6, 1, 34.00),
(31, 1, 55, 6, 2, 34.00),
(32, 1, 56, 8, 2, 34222.00),
(33, 1, 57, 6, 5, 34.00),
(34, 1, 58, 6, 2, 34.00),
(35, 1, 59, 8, 2, 34222.00),
(36, 1, 60, 8, 6, 34222.00),
(37, 1, 61, 6, 2, 34.00),
(38, 1, 62, 8, 2, 34222.00);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `user_id`, `product_id`, `quantity`) VALUES
(8, 1, 6, 2),
(10, 1, 14, 4),
(11, 1, 16, 3),
(14, 1, 8, 1),
(15, 1, 19, 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `order_date` datetime DEFAULT current_timestamp(),
  `qty` int(255) NOT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `carrier` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `payment_option` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `product_id`, `order_date`, `qty`, `total_amount`, `carrier`, `status`, `payment_option`) VALUES
(20, 1, 6, '2024-11-26 00:24:12', 1, 35.00, '', 'Complete', 'Meet Up'),
(27, 1, 14, '2024-11-26 00:27:07', 2, 64.00, '', 'Complete', 'Meet Up'),
(28, 1, 9, '2024-11-26 20:59:55', 4, 84000.00, '', 'Pending', 'Meet Up'),
(29, 1, 6, '2024-11-28 13:57:12', 1, 35.00, '', 'Pending', 'Cash on Delivery'),
(30, 1, 8, '2024-11-28 13:58:20', 1, 34222.00, 'kasiaw gyud bai', 'Complete', 'Cash on Delivery'),
(31, 1, 6, '2024-11-28 14:11:00', 1, 35.00, 'Lalamove', 'Pending', 'Cash on Delivery'),
(32, 1, 6, '2024-12-06 22:07:13', 1, 34.00, 'LBC', 'Pending', 'Meet Up'),
(33, 1, 6, '2024-12-06 22:11:20', 1, 34.00, 'LBC', 'Pending', 'Meet Up'),
(34, 1, 6, '2024-12-06 22:45:07', 1, 34.00, 'LBC', 'Pending', 'Meet Up'),
(35, 1, 6, '2024-12-06 23:13:59', 1, 34.00, 'LBC', 'Pending', 'Meet Up'),
(36, 1, 6, '2024-12-07 00:11:13', 1, 34.00, 'LBC', 'Pending', 'Meet Up'),
(37, 1, 6, '2024-12-07 00:15:04', 3, 102.00, 'LBC', 'Pending', 'Meet Up'),
(38, 1, 11, '2024-12-07 00:21:21', 2, 64000.00, 'LBC', 'Pending', 'Meet Up'),
(39, 1, 6, '2024-12-07 00:24:46', 1, 34.00, 'LBC', 'Pending', 'Meet Up'),
(40, 1, 6, '2024-12-07 00:30:19', 3, 102.00, 'LBC', 'Pending', 'Meet Up'),
(41, 1, 6, '2024-12-07 00:38:45', 1, 34.00, 'Food Panda', 'Pending', 'Cash on Delivery'),
(42, 1, 6, '2024-12-09 22:04:07', 4, 136.00, 'LBC', 'Pending', 'Meet Up'),
(43, 1, 6, '2024-12-09 22:10:14', 2, 68.00, 'LBC', 'Pending', 'Meet Up'),
(44, 1, 6, '2024-12-09 22:12:47', 2, 34290.00, 'LBC', 'Pending', 'Meet Up'),
(45, 1, 11, '2024-12-09 22:32:20', 2, 64000.00, 'LBC', 'Pending', 'Meet Up'),
(46, 1, 6, '2024-12-09 22:42:13', 1, 34.00, 'LBC', 'Pending', 'Meet Up'),
(47, 1, 6, '2024-12-09 22:43:29', 1, 34256.00, 'LBC', 'Pending', 'Meet Up'),
(48, 1, 6, '2024-12-09 22:53:18', 1, 34256.00, 'Private Driver', 'Pending', 'Cash on Delivery'),
(49, 1, 6, '2024-12-09 23:13:13', 1, 34.00, 'LBC', 'Pending', 'Meet Up'),
(50, 1, 6, '2024-12-09 23:38:38', 1, 34.00, 'LBC', 'Pending', 'Meet Up'),
(51, 1, 11, '2024-12-09 23:41:08', 1, 32000.00, 'LBC', 'Pending', 'Meet Up'),
(52, 1, 6, '2024-12-10 00:14:39', 1, 68478.00, 'LBC', 'Pending', 'Meet Up'),
(53, 1, 8, '2024-12-10 00:14:39', 2, 68478.00, 'LBC', 'Pending', 'Meet Up'),
(54, 1, 6, '2024-12-10 00:31:54', 1, 34.00, 'LBC', 'Pending', 'Meet Up'),
(55, 1, 6, '2024-12-10 00:32:47', 2, 68512.00, 'LBC', 'Pending', 'Meet Up'),
(56, 1, 8, '2024-12-10 00:32:47', 2, 68512.00, 'LBC', 'Pending', 'Meet Up'),
(57, 1, 6, '2024-12-10 01:20:26', 5, 170.00, 'LBC', 'Pending', 'Meet Up'),
(58, 1, 6, '2024-12-10 01:21:15', 2, 68512.00, 'LBC', 'Pending', 'Cash on Delivery'),
(59, 1, 8, '2024-12-10 01:21:15', 2, 68512.00, 'LBC', 'Pending', 'Cash on Delivery'),
(60, 1, 8, '2024-12-10 01:25:32', 6, 205332.00, 'LBC', 'Pending', 'Meet Up'),
(61, 1, 6, '2024-12-10 01:28:10', 2, 68512.00, '--', 'Pending', 'Meet Up'),
(62, 1, 8, '2024-12-10 01:28:10', 2, 68512.00, '--', 'Pending', 'Meet Up');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `cpu` varchar(255) NOT NULL,
  `gpu` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `image_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `name`, `description`, `cpu`, `gpu`, `price`, `stock`, `image_url`) VALUES
(6, 'ASUS TUF i7 - 15th gen RTX 5090 bitter Lake', 'i7 - 15th gen RTX 5090 bitter Lake Kang Harley daw ni ana siya daw', 'i7 - 15th gen', 'RTX 5090 bitter Lake', 34.00, 5, '205270221-laptop sample.jpg'),
(8, 'Dell Latitude 5440 i5-13th Gen 16GB RAM 256GB SSD 14 inch IPS Display FHD 1080P Backlight Keyboard  ', 'i5-13th Gen 16GB RAM 256GB SSD 14 inch IPS Display FHD 1080P Backlight Keyboard  💻2ndhand, Pristine Condition warranty till yr 2027', 'i5-13th edited', 'intel Iris', 34222.00, 0, '1653695510-dell.jpg'),
(23, 'Acer Nitro 5 AN515-58-50YE', '5 AN515-58-50YE', 'i5-13th', 'intel Iris', 35.00, 7, '1317904949-images.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `phone_number` int(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `status` varchar(255) NOT NULL,
  `otp` int(11) NOT NULL,
  `is_admin` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `first_name`, `last_name`, `phone_number`, `location`, `email`, `status`, `otp`, `is_admin`) VALUES
(1, 'harveycasane', '$2y$10$ZRcZDgA9yRb4NNUQo90r0u/7URKTrB.17TU3tJVlG2FLFlpvaY9M.', 'Harvey', '0', 944988781, 'Cogon rako boss', 'harveycasane1@gmail.com', 'verified', 743146, 0),
(2, 'Admin', '$2y$10$2jNmAcm33sCnjKchuy9RbeWs7lT4PWHuL308oBYptaJJDeNw0DdOy', 'The', '0', 944988781, 'Cogon rako boss', 'harvey.casane@evsu.edu.ph', 'verified', 996861, 1),
(3, 'DomenickMahusay', '$2y$10$3UZ7Py.XvG10CazSB0Qh6.GQ9xUbXENrBK3JMReBUIyamRafYx6fG', 'Domenick', '0', 987654, 'Cebu. PH', 'harveycasane2@gmail.com', 'verified', 808640, 0),
(6, 'Christian', '$2y$10$1lsHd0Je9X3ILMAqEr5Jd.WBZtWzpY5XEktqNZ1RcwGm9RYQeZNhu', 'Christian', 'Dacera', 987654323, 'Lilia Avenue Cogon Combado, Ormoc City, Leyte, Philippines', 'harveycasane3@gmail.com', 'verified', 341198, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `allorder`
--
ALTER TABLE `allorder`
  ADD PRIMARY KEY (`all_order_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id_fk` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `allorder`
--
ALTER TABLE `allorder`
  MODIFY `all_order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `allorder`
--
ALTER TABLE `allorder`
  ADD CONSTRAINT `allorder_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `allorder_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`),
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
