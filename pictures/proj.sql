-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 06, 2024 at 04:41 AM
-- Server version: 8.0.35
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `proj`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `DeleteArtist` (IN `p_artist_id` INT)   BEGIN
    DELETE FROM artist
    WHERE artist_id = p_artist_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `DeleteArtwork` (IN `p_artwork_id` INT)   BEGIN
    DELETE FROM artwork 
    WHERE artwork_id = p_artwork_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `DisplayArtist` ()   BEGIN
    SELECT * FROM artist;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `DisplayArtworks` ()   BEGIN
    SELECT * FROM artwork;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `DisplayExhibition` ()   BEGIN
    SELECT * FROM exhibition;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `DisplayGallery` ()   BEGIN
    SELECT * FROM gallery;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetOrders` ()   BEGIN
    SELECT * FROM orders;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertArtist` (IN `p_artist_name` VARCHAR(255), IN `p_style` VARCHAR(255), IN `p_address` VARCHAR(255))   BEGIN
    INSERT INTO artist (artist_name, style, address) VALUES (p_artist_name, p_style, p_address);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertArtwork` (IN `p_title` VARCHAR(255), IN `p_creation_date` DATE, IN `p_price` DECIMAL(10,2))   BEGIN
    INSERT INTO artwork (title, creation_date, price) VALUES (p_title, p_creation_date, p_price);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertExhibition` (IN `p_exhibition_title` VARCHAR(255), IN `p_start_date` DATE, IN `p_end_date` DATE, IN `p_artwork_id` INT, IN `p_gallery_id` INT)   BEGIN
    INSERT INTO exhibition (exhibition_title, start_date, end_date, artwork_id, gallery_id)
    VALUES (p_exhibition_title, p_start_date, p_end_date, p_artwork_id, p_gallery_id);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertGallery` (IN `p_gallery_name` VARCHAR(255), IN `p_location` VARCHAR(255))   BEGIN
    INSERT INTO gallery (gallery_name, location) VALUES (p_gallery_name, p_location);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertOrder` (IN `ord_date` DATE, IN `quantity` INT, IN `total_price` DECIMAL(10,2), IN `shipping_address` VARCHAR(255), IN `shipping_status` VARCHAR(50), IN `artwork_id` INT, IN `users_id` INT)   BEGIN
    INSERT INTO orders (ord_date, quantity, total_price, shipping_address, shipping_status, artwork_id, users_id) 
    VALUES (ord_date, quantity, total_price, shipping_address, shipping_status, artwork_id, users_id);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_user` (IN `p_username` VARCHAR(255), IN `p_first_name` VARCHAR(255), IN `p_last_name` VARCHAR(255), IN `p_email` VARCHAR(255), IN `p_password` VARCHAR(255))   BEGIN
    INSERT INTO users (username, first_name, last_name, email, password)
    VALUES (p_username, p_first_name, p_last_name, p_email, p_password);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `login_user` (IN `p_username` VARCHAR(255), IN `p_password` VARCHAR(255))   BEGIN
    SELECT * FROM users WHERE username = p_username AND password = p_password;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateArtist` (IN `p_artist_id` INT, IN `p_artist_name` VARCHAR(255), IN `p_style` VARCHAR(255), IN `p_address` VARCHAR(255))   BEGIN
    UPDATE artist
    SET artist_name = p_artist_name,
        style = p_style,
        address = p_address
    WHERE artist_id = p_artist_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateArtwork` (IN `p_artwork_id` INT, IN `p_title` VARCHAR(255), IN `p_creation_date` DATE, IN `p_price` DECIMAL(10,2))   BEGIN
    UPDATE artwork 
    SET title = p_title, creation_date = p_creation_date, price = p_price 
    WHERE artwork_id = p_artwork_id;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `artist`

CREATE TABLE `artist` (
  `artist_id` int NOT NULL,
  `artist_name` varchar(50) NOT NULL,
  `style` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `artist`
--

INSERT INTO `artist` (`artist_id`, `artist_name`, `style`, `address`) VALUES
(42, 'Leonardo da Vinci', 'Color Pallete', 'Italy'),
(43, 'Michelangelo', 'Renaissance polymath ', 'Italy'),
(44, 'Amrita Sher-Gil', 'Post-impressionism ', 'India'),
(46, 'Rembrandt', 'Baroque', 'Dutch'),
(47, 'Vincent van Gogh', 'spontaneous and instinctive', 'Dutch'),
(48, 'Ram Kumar', 'oil or acrylic.', 'India'),
(52, 'sak', 'simple', 'rajsthan');

-- --------------------------------------------------------

--
-- Table structure for table `artwork`
--

CREATE TABLE `artwork` (
  `artwork_id` int NOT NULL,
  `title` varchar(50) NOT NULL,
  `creation_date` date NOT NULL,
  `price` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `artwork`
--

INSERT INTO `artwork` (`artwork_id`, `title`, `creation_date`, `price`) VALUES
(1, 'rainbow', '2024-03-21', 5678),
(2, 'nature', '2024-03-14', 5678),
(3, 'oil_painting', '2019-09-23', 23456),
(4, 'ghj', '2021-05-14', 34567),
(5, 'butterfly', '2021-05-14', 3456);

-- --------------------------------------------------------

--
-- Table structure for table `exhibition`
--

CREATE TABLE `exhibition` (
  `exhibition_id` int NOT NULL,
  `exhibition_title` varchar(50) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `artwork_id` int NOT NULL,
  `gallery_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `exhibition`
--

INSERT INTO `exhibition` (`exhibition_id`, `exhibition_title`, `start_date`, `end_date`, `artwork_id`, `gallery_id`) VALUES
(1, 'Nature', '2018-09-25', '2019-09-27', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `gallery_id` int NOT NULL,
  `gallery_name` varchar(50) NOT NULL,
  `location` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`gallery_id`, `gallery_name`, `location`) VALUES
(1, 'Nature', 'Blue Valley'),
(2, 'Landscapes', 'Silicon');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `ord_id` int NOT NULL,
  `ord_date` date NOT NULL,
  `quantity` int NOT NULL,
  `total_price` int NOT NULL,
  `shipping_address` varchar(50) NOT NULL,
  `shipping_status` varchar(50) NOT NULL,
  `artwork_id` int NOT NULL,
  `users_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`ord_id`, `ord_date`, `quantity`, `total_price`, `shipping_address`, `shipping_status`, `artwork_id`, `users_id`) VALUES
(1, '2009-09-23', 5, 500, '0', 'jjj', 2, 1),
(2, '2019-07-23', 4, 600, '0', 'sdfvew', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sign_in`
--

CREATE TABLE `sign_in` (
  `users_id` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `users_id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`users_id`, `username`, `first_name`, `last_name`, `email`, `password`) VALUES
(1, 'sak', 'Sakshi ', 'Shankar Gumaste ', 'sss@gmail.com', '123'),
(2, 'sak', 'sakshi', 'gumaste', 'sak@gmail.com', 'sak123'),
(3, 'sak', 'Sakshi ', 'Shankar Gumaste ', 'sgs@gmail.com', 'sg123'),
(4, 'sak23', 'sak', 'gumaste', 'sss@gmail.com', 's123'),
(5, 'Sam', 'Samarth', 'Gumaste', 'samgumaste@gmail.com', 'sam12'),
(6, 'sg', 'sak', 'gumaste', 'sg@gmail.com', '123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `artist`
--
ALTER TABLE `artist`
  ADD PRIMARY KEY (`artist_id`);

--
-- Indexes for table `artwork`
--
ALTER TABLE `artwork`
  ADD PRIMARY KEY (`artwork_id`);

--
-- Indexes for table `exhibition`
--
ALTER TABLE `exhibition`
  ADD PRIMARY KEY (`exhibition_id`),
  ADD KEY `artwork_id` (`artwork_id`),
  ADD KEY `exhibition_ibfk_1` (`gallery_id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`gallery_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`ord_id`),
  ADD KEY `artwork_id` (`artwork_id`),
  ADD KEY `users_id` (`users_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`users_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `artist`
--
ALTER TABLE `artist`
  MODIFY `artist_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `artwork`
--
ALTER TABLE `artwork`
  MODIFY `artwork_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `exhibition`
--
ALTER TABLE `exhibition`
  MODIFY `exhibition_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `gallery_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `ord_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `users_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `exhibition`
--
ALTER TABLE `exhibition`
  ADD CONSTRAINT `exhibition_ibfk_1` FOREIGN KEY (`gallery_id`) REFERENCES `gallery` (`gallery_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`artwork_id`) REFERENCES `artwork` (`artwork_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`users_id`) REFERENCES `users` (`users_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
