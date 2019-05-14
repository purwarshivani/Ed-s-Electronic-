-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 13, 2019 at 12:47 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `assignment1`
--

-- --------------------------------------------------------

--
-- Table structure for table `catagories`
--

CREATE TABLE `catagories` (
  `cat_id` int(5) NOT NULL,
  `cat_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `catagories`
--

INSERT INTO `catagories` (`cat_id`, `cat_name`) VALUES
(8, 'TV'),
(9, 'computer'),
(10, 'phone'),
(11, ' gameing');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(6) NOT NULL,
  `item_no` varchar(255) DEFAULT NULL,
  `txn_id` varchar(255) DEFAULT NULL,
  `payment_status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(6) NOT NULL,
  `product_name` varchar(30) NOT NULL,
  `product_description` varchar(255) NOT NULL,
  `product_price` int(10) NOT NULL,
  `feature_status` char(1) NOT NULL DEFAULT '0',
  `cat_id` int(6) NOT NULL,
  `image_name` varchar(65) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_description`, `product_price`, `feature_status`, `cat_id`, `image_name`) VALUES
(8, ' LG ultra', ' LG ULTRa have 55 inch display screen, with ultra sound ', 60, '0', 8, 'TV lG.jpg'),
(9, ' iphone', ' with advance feature to make life more cozy', 5667, '0', 10, 'iphone.jpg'),
(11, ' Panasonic', 'Pansonic now available with an advance design, LED black lighting now with wider color range on TV screen', 600000, '1', 8, 'panasonic.jpg'),
(12, ' Sony ', ' Thing in which one can see everything beautiful, with ultra HD and LED screen also smart TVs', 94900, '0', 8, 'sonys85c-1l.jpg'),
(13, 'Samsung Galaxy s7', 'samsung smart phone, now with 5.10-inch touch screen and resolution of 1130 pixels', 25000, '0', 10, 'samsung.jpg'),
(14, 'Redmi Note 4', 'Redmin Note 4 is available special offer for this weekend with 20% discout having 5.5 inch touch screen and 64 GB memory', 35000, '0', 10, 'mi.jpg'),
(15, ' DELL', 'The worlds most selling brand, with i graphic and memory storage capacity, longlasting battery saver', 189000, '0', 9, 'dell.jpg'),
(16, '  DELL i5', 'embedded device security. HP boats an impressive and filled with attractive feature', 109000, '0', 9, 'Hp.jpg'),
(17, ' PS4', ' PS4 includes bundle jet back with 1TB playstation 4 system and wirless controller', 4, '1', 11, 'ps4.jpg'),
(18, ' Nintendo', ' The fastest selling vedio game system,which  tracks vedio games sales', 5, '1', 11, 'nin.jpg'),
(20, ' hilltop', ' wonderfull', 7888, '0', 11, 'phone.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `review_id` int(6) NOT NULL,
  `user_id` int(6) NOT NULL,
  `product_id` int(6) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `review_text` varchar(255) DEFAULT NULL,
  `approved` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`review_id`, `user_id`, `product_id`, `date`, `review_text`, `approved`) VALUES
(9, 10, 11, '2019-01-12 18:15:00', 'it nice', 1),
(10, 10, 11, '2019-01-12 18:15:00', 'its  best product', 1),
(11, 10, 9, '2019-01-12 18:15:00', 'aswome', 0);

-- --------------------------------------------------------

--
-- Table structure for table `shopping`
--

CREATE TABLE `shopping` (
  `shopping_id` int(6) NOT NULL,
  `user_id` int(6) DEFAULT NULL,
  `product_id` int(6) DEFAULT NULL,
  `amount` int(255) DEFAULT NULL,
  `quantity` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shopping`
--

INSERT INTO `shopping` (`shopping_id`, `user_id`, `product_id`, `amount`, `quantity`) VALUES
(1, 10, 8, 60, 1),
(14, 10, 8, 60, 1),
(15, 10, 8, 60, 1),
(16, 10, 11, 600000, 1),
(17, 10, 11, 600000, 1),
(18, 10, 11, 600000, 1),
(19, 10, 11, 600000, 1),
(20, 10, 9, 5667, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `firstname` varchar(15) NOT NULL,
  `lastname` varchar(15) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(66) NOT NULL,
  `gender` char(1) NOT NULL,
  `user_type` varchar(255) NOT NULL DEFAULT 'user',
  `user_id` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`firstname`, `lastname`, `email`, `password`, `gender`, `user_type`, `user_id`) VALUES
('SHIVANI', 'purwar', 'san@gmail.com', '$2y$10$dA6VBTlobvQASBJ8Gnz28Om9pXx3YcMZ1BekSmp8luci2R2tpYvDy', 'F', 'user', 10),
('image', 'bhandari', 'imagebhandari@gmail.', '$2y$10$t9TUjm.N2HHdkdiEAnyjZefsq6AXNEaXWmIIzG6EnmuGPX2QzyWlS', 'M', 'admin', 14),
('Ganesh', 'khatri', 'ganesh@34gmail.com', '$2y$10$f1oecSa9NRbsu0LxTVhieO2kaVDrWckym5f9FxoZb5Q4odKcM79s2', 'M', 'admin', 16),
('shivu', 'purwar', 'shivi@gmail.com', '$2y$10$SB6mVNFjmkIm9B4rbUT9xe8TObGLRememBH1yJS7UMncBs9bQbSR6', 'F', 'admin', 17);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `catagories`
--
ALTER TABLE `catagories`
  ADD PRIMARY KEY (`cat_id`),
  ADD KEY `cat_id` (`cat_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `cat_id` (`cat_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `shopping`
--
ALTER TABLE `shopping`
  ADD PRIMARY KEY (`shopping_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `catagories`
--
ALTER TABLE `catagories`
  MODIFY `cat_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `shopping`
--
ALTER TABLE `shopping`
  MODIFY `shopping_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `catagories` (`cat_id`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `shopping`
--
ALTER TABLE `shopping`
  ADD CONSTRAINT `shopping_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`),
  ADD CONSTRAINT `shopping_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
