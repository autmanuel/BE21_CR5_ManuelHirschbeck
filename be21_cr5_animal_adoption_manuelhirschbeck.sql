-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2024 at 03:06 AM
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
-- Database: `be21_cr5_animal_adoption_manuelhirschbeck`
--
CREATE DATABASE IF NOT EXISTS `be21_cr5_animal_adoption_manuelhirschbeck` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `be21_cr5_animal_adoption_manuelhirschbeck`;

-- --------------------------------------------------------

--
-- Table structure for table `animal`
--

CREATE TABLE `animal` (
  `animal_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `photo` varchar(255) NOT NULL DEFAULT 'https://rightclickit.com.au/wp-content/uploads/2018/09/IMAGE-COMING-SOON-1000.jpg',
  `location` varchar(255) NOT NULL,
  `description` varchar(150) DEFAULT NULL,
  `size` enum('small','medium','large') NOT NULL,
  `age` int(11) DEFAULT NULL,
  `vaccinated` enum('Yes','No') NOT NULL,
  `breed` varchar(100) NOT NULL,
  `availability` enum('Adopted','Available') NOT NULL DEFAULT 'Available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `animal`
--

INSERT INTO `animal` (`animal_id`, `name`, `gender`, `photo`, `location`, `description`, `size`, `age`, `vaccinated`, `breed`, `availability`) VALUES
(1, 'Buddy', 'Male', 'https://cdn.pixabay.com/photo/2016/02/19/15/46/labrador-retriever-1210559_1280.jpg', '123 Main Street', 'Buddy is a friendly and playful Labrador Retriever. He enjoys outdoor activities and loves to spend time with people.', 'medium', 4, 'Yes', 'Labrador Retriever Dog', 'Available'),
(3, 'Charlie', 'Male', 'https://cdn.pixabay.com/photo/2019/05/10/15/08/dog-4193723_1280.jpg', '789 Oak Street', 'Charlie is a small Jack Russell Terrier known for his high energy levels. He loves to play and explore new surroundings.', 'small', 2, 'No', 'Jack Russell Terrier Dog', 'Available'),
(4, 'Bella', 'Female', 'https://cdn.pixabay.com/photo/2017/02/15/12/12/cat-2068462_960_720.jpg', '321 Pine Street', 'Bella is a medium-sized Siamese cat who is shy but affectionate. Once she warms up to you, she enjoys snuggling and being pampered.', 'medium', 8, 'Yes', 'Siamese Cat', 'Available'),
(5, 'Lucy', 'Female', 'https://cdn.pixabay.com/photo/2021/11/21/22/08/british-shorthair-6815375_1280.jpg', '654 Cedar Street', 'Lucy is a small Tabby cat who craves attention. She loves to be petted and will purr contentedly when she is feeling loved.', 'small', 10, 'No', 'Tabby', 'Available'),
(6, 'Molly', '', 'https://cdn.pixabay.com/photo/2019/06/22/19/01/golden-retriever-4292254_1280.jpg', '987 Walnut Street', 'Molly is a gentle and calm Golden Retriever who gets along well with everyone. She enjoys leisurely walks and relaxing at home.', 'small', 5, 'Yes', 'Golden Retriever Dog', 'Available'),
(7, 'Daisy', 'Female', 'https://cdn.pixabay.com/photo/2023/12/22/05/55/dog-8463178_1280.jpg', '135 Maple Street', 'Daisy is a medium-sized Beagle known for her playful and friendly nature. She loves to chase after toys and explore her surroundings.', 'medium', 3, 'No', 'Beagle Dog', 'Available'),
(8, 'Rocky', 'Male', 'https://cdn.pixabay.com/photo/2020/11/22/20/11/rottweiler-5767821_1280.jpg', '246 Birch Street', 'Rocky is a loyal and protective Rottweiler who takes his job seriously. He is a big softie at heart and loves to be with his family.', 'large', 9, 'Yes', 'Rottweiler Dog', 'Available'),
(9, 'Luna', '', 'https://cdn.pixabay.com/photo/2023/02/02/13/23/cat-7762873_1280.jpg', '579 Ash Street', 'Luna is a medium-sized Maine Coon cat who is independent but affectionate. She enjoys lounging in sunny spots and chasing after toys.', 'small', 7, 'No', 'Maine Coon Cat', 'Available'),
(10, 'Cooper', 'Male', 'https://cdn.pixabay.com/photo/2024/01/07/08/06/french-bulldog-8492504_1280.jpg', '864 Spruce Street', 'Cooper is a curious and outgoing French Bulldog who loves to explore his surroundings. He enjoys meeting new people and making friends wherever he goe', 'small', 1, 'Yes', 'French Bulldog ', 'Available'),
(15, 'Bobby', 'Male', 'https://rightclickit.com.au/wp-content/uploads/2018/09/IMAGE-COMING-SOON-1000.jpg	', '43 Garden Street', 'Bobby is new here, he is really extroverted and playful, he needs an owner who has active time for him and is ready to play around.', 'small', 1, 'Yes', 'Chihuahua, dog', 'Adopted');

-- --------------------------------------------------------

--
-- Table structure for table `pet_adoption`
--

CREATE TABLE `pet_adoption` (
  `adoption_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `animal_id` int(11) DEFAULT NULL,
  `adoption_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pet_adoption`
--

INSERT INTO `pet_adoption` (`adoption_id`, `user_id`, `animal_id`, `adoption_date`) VALUES
(2, 3, 15, '2024-04-08 02:56:11');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(150) NOT NULL,
  `last_name` varchar(159) NOT NULL,
  `password` varchar(254) NOT NULL,
  `date_of_birth` date NOT NULL,
  `email` varchar(200) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `status` varchar(4) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `password`, `date_of_birth`, `email`, `picture`, `status`) VALUES
(1, 'Manuel', 'Hirschbeck', '937e8d5fbb48bd4949536cd65b8d35c426b80d2f830c5c308e2cdec422ae2244', '1997-02-28', 'manuel.hirschbeck@gmail.com', '661206d5942e3.jpg', 'adm'),
(2, 'John', 'Smith', 'b4b597c714a8f49103da4dab0266af0ee0ae4f8575250a84855c3d76941cd422', '1990-01-01', 'john@smith.com', 'avatar.png', 'user'),
(3, 'Ryan', 'Connor', '6fec2a9601d5b3581c94f2150fc07fa3d6e45808079428354b868e412b76e6bb', '1990-06-05', 'ryan@connor.com', '6611693217308.jpg', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `animal`
--
ALTER TABLE `animal`
  ADD PRIMARY KEY (`animal_id`);

--
-- Indexes for table `pet_adoption`
--
ALTER TABLE `pet_adoption`
  ADD PRIMARY KEY (`adoption_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `animal_id` (`animal_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `animal`
--
ALTER TABLE `animal`
  MODIFY `animal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `pet_adoption`
--
ALTER TABLE `pet_adoption`
  MODIFY `adoption_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pet_adoption`
--
ALTER TABLE `pet_adoption`
  ADD CONSTRAINT `pet_adoption_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `pet_adoption_ibfk_2` FOREIGN KEY (`animal_id`) REFERENCES `animal` (`animal_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
