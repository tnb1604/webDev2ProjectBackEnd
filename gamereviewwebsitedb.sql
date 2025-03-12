-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Mar 12, 2025 at 02:38 PM
-- Server version: 11.6.2-MariaDB-ubu2404
-- PHP Version: 8.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `developmentdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

CREATE TABLE `games` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `release_date` date NOT NULL,
  `genre` varchar(50) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `trailer_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `games`
--

INSERT INTO `games` (`id`, `title`, `description`, `release_date`, `genre`, `image_path`, `trailer_url`) VALUES
(2, 'Cyberpunk 2077', 'An open-world sci-fi RPG set in Night City, full of futuristic tech and action.', '2020-12-10', 'Sci-Fi RPG', '/images/cyberpunk2077.jpg', 'https://www.youtube.com/watch?v=8X2kIfS6fb8'),
(6, 'The Witcher 3: Wild Hunt', 'An open-world RPG where you play as Geralt of Rivia.', '2015-05-19', 'RPG', '/images/thewitcher3.jpg', 'https://www.youtube.com/watch?v=XHrskkHf958'),
(7, 'Minecraft', 'A sandbox game where you can build and explore procedurally generated worlds.', '2011-11-18', 'Sandbox', '/images/minecraft.jpg', 'https://www.youtube.com/watch?v=MmB9b5njVbA'),
(8, 'Red Dead Redemption 2', 'An open-world western action-adventure game by Rockstar.', '2018-10-26', 'Action-Adventure', '/images/rdr2.jpg', 'https://www.youtube.com/watch?v=gmA6MrX81z4'),
(9, 'Elden Ring', 'A dark fantasy action RPG developed by FromSoftware.', '2022-02-25', 'Action RPG', '/images/eldenring.jpg', 'https://www.youtube.com/watch?v=AKXiKBnzpBQ'),
(10, 'Hollow Knight', 'A beautifully crafted Metroidvania indie game with deep lore.', '2017-02-24', 'Metroidvania', '/images/hollowknight.jpg', 'https://www.youtube.com/watch?v=nSPJXlYjENE'),
(11, 'Stardew Valley', 'A farming simulation RPG with deep mechanics and relaxing gameplay.', '2016-02-26', 'Simulation RPG', '/images/stardewvalley.jpg', 'https://www.youtube.com/watch?v=ot7uXNQskhs'),
(12, 'DOOM Eternal', 'A fast-paced, demon-slaying FPS with intense combat.', '2020-03-20', 'FPS', '/images/doometernal.jpg', 'https://www.youtube.com/watch?v=_UuktemkCFI'),
(13, 'The Legend of Zelda: Breath of the Wild', 'An open-world Zelda adventure with complete freedom.', '2017-03-03', 'Adventure', '/images/botw.jpg', 'https://www.youtube.com/watch?v=1rPxiXXxftE'),
(14, 'Dark Souls III', 'A challenging dark fantasy action RPG by FromSoftware.', '2016-04-12', 'Action RPG', '/images/darksouls3.jpg', 'https://www.youtube.com/watch?v=cWBwFhUv1-8'),
(15, 'Grand Theft Auto V', 'An open-world crime simulation game set in Los Santos.', '2013-09-17', 'Open-World', '/images/gtav.jpg', 'https://www.youtube.com/watch?v=QkkoHAzjnUs'),
(16, 'Persona 5 Royal', 'A stylish turn-based JRPG with deep social mechanics.', '2019-10-31', 'JRPG', '/images/p5r.jpg', 'https://www.youtube.com/watch?v=SKpSpvFCZRw'),
(17, 'Super Mario Odyssey', 'A 3D platformer with unique mechanics and vast worlds.', '2017-10-27', 'Platformer', '/images/marioodyssey.jpg', 'https://www.youtube.com/watch?v=wGQHQc_3ycE'),
(18, 'God of War (2018)', 'A Norse mythology action-adventure game starring Kratos.', '2018-04-20', 'Action', '/images/gow.jpg', 'https://www.youtube.com/watch?v=K0u_kAWLJOA'),
(19, 'Celeste', 'A pixel-art platformer with an emotional story and tight controls.', '2018-01-25', 'Platformer', '/images/celeste.jpg', 'https://www.youtube.com/watch?v=70d9irlxiB4'),
(28, 'The Rizz God', 'I am Cool', '2002-12-31', 'I am Cool', '/images/1741488269_rizzySprite.webp', 'https://www.youtube.com/watch?v=PmD6ONQqi9Y');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `rating` int(11) DEFAULT NULL CHECK (`rating` between 1 and 5),
  `review_text` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `edited_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `game_id`, `rating`, `review_text`, `created_at`, `edited_at`) VALUES
(143, 21, 2, 5, 'Absolutely love Cyberpunk 2077! The world feels so alive.', '2025-03-12 02:36:34', NULL),
(144, 23, 2, 4, 'Great story, but still has some bugs.', '2025-03-12 02:36:34', NULL),
(145, 24, 2, 3, 'Good game, but not as revolutionary as I expected.', '2025-03-12 02:36:34', NULL),
(146, 25, 6, 5, 'The Witcher 3 is a masterpiece.', '2025-03-12 02:36:34', NULL),
(147, 26, 6, 4, 'Geralt is such a cool protagonist!', '2025-03-12 02:36:34', NULL),
(148, 27, 6, 5, 'This game set the standard for open-world RPGs.', '2025-03-12 02:36:34', NULL),
(149, 28, 7, 5, 'Minecraft is timeless. So much fun with friends!', '2025-03-12 02:36:34', NULL),
(150, 21, 7, 4, 'Creative mode is amazing, but survival gets repetitive.', '2025-03-12 02:36:34', NULL),
(151, 23, 7, 5, 'Nothing beats building a giant castle.', '2025-03-12 02:36:34', NULL),
(152, 24, 8, 5, 'The most immersive open world ever.', '2025-03-12 02:36:34', NULL),
(153, 25, 8, 4, 'A slow start, but the story is unforgettable.', '2025-03-12 02:36:34', NULL),
(154, 26, 8, 5, 'Arthur Morgan is one of the best protagonists in gaming.', '2025-03-12 02:36:34', NULL),
(155, 27, 9, 5, 'A true masterpiece! The open-world exploration is amazing.', '2025-03-12 02:36:34', NULL),
(156, 28, 9, 4, 'Tough but fair. The bosses are crazy good.', '2025-03-12 02:36:34', NULL),
(157, 21, 9, 5, 'Best game of the year, no contest.', '2025-03-12 02:36:34', NULL),
(158, 23, 10, 5, 'An indie gem! The gameplay and lore are fantastic.', '2025-03-12 02:36:34', NULL),
(159, 24, 10, 4, 'Very challenging but super rewarding.', '2025-03-12 02:36:34', NULL),
(160, 25, 10, 5, 'The art style and music are beautiful.', '2025-03-12 02:36:34', NULL),
(161, 26, 11, 5, 'Most relaxing game I’ve ever played.', '2025-03-12 02:36:34', NULL),
(162, 27, 11, 4, 'Farming is fun, but I wish there were more events.', '2025-03-12 02:36:34', NULL),
(163, 28, 11, 5, 'I love the cozy vibes.', '2025-03-12 02:36:34', NULL),
(164, 21, 12, 5, 'Non-stop action, and the soundtrack is fire!', '2025-03-12 02:36:34', NULL),
(165, 23, 12, 4, 'Doom Slayer is a beast. Loved the fast combat.', '2025-03-12 02:36:34', NULL),
(166, 24, 12, 5, 'Ripping and tearing has never been so fun.', '2025-03-12 02:36:34', NULL),
(167, 25, 13, 5, 'A magical open-world adventure.', '2025-03-12 02:36:34', NULL),
(168, 26, 13, 4, 'The physics system makes exploration amazing.', '2025-03-12 02:36:34', NULL),
(169, 27, 13, 5, 'Every moment in this game is memorable.', '2025-03-12 02:36:34', NULL),
(170, 28, 14, 5, 'A great conclusion to the Dark Souls series.', '2025-03-12 02:36:34', NULL),
(171, 21, 14, 4, 'Tough but rewarding. The boss fights are legendary.', '2025-03-12 02:36:34', NULL),
(172, 23, 14, 5, 'One of the best RPGs ever made.', '2025-03-12 02:36:34', NULL),
(173, 24, 15, 5, 'Los Santos feels so alive.', '2025-03-12 02:36:34', NULL),
(174, 25, 15, 4, 'The story mode is great, but online is a cash grab.', '2025-03-12 02:36:34', NULL),
(175, 26, 15, 5, 'Still one of the best open-world games out there.', '2025-03-12 02:36:34', NULL),
(176, 27, 16, 5, 'The best turn-based RPG I’ve ever played.', '2025-03-12 02:36:34', NULL),
(177, 28, 16, 4, 'The music and style are top-tier.', '2025-03-12 02:36:34', NULL),
(178, 21, 16, 5, 'A long game, but worth every second.', '2025-03-12 02:36:34', NULL),
(179, 23, 17, 5, 'Mario’s best 3D adventure to date.', '2025-03-12 02:36:34', NULL),
(180, 24, 17, 4, 'Very creative, but a bit too easy.', '2025-03-12 02:36:34', NULL),
(181, 25, 17, 5, 'Every level is a joy to explore.', '2025-03-12 02:36:34', NULL),
(182, 26, 18, 5, 'A masterpiece. Kratos’ character development is perfect.', '2025-03-12 02:36:34', NULL),
(183, 27, 18, 4, 'The combat is satisfying, but I wanted more enemy variety.', '2025-03-12 02:36:34', NULL),
(184, 28, 18, 5, 'One of the best stories in gaming.', '2025-03-12 02:36:34', NULL),
(185, 21, 19, 5, 'A beautiful game with an emotional story.', '2025-03-12 02:36:34', NULL),
(186, 23, 19, 4, 'Brutally difficult, but so rewarding.', '2025-03-12 02:36:34', NULL),
(187, 24, 19, 5, 'The platforming feels perfect.', '2025-03-12 02:36:34', NULL),
(188, 28, 2, 1, 'lol im a troll never played this but gonna hate for fun hahahahaha', '2025-03-12 02:52:39', NULL),
(189, 27, 2, 5, 'lol im a troll never played this but gonna hate for fun hahahahaha', '2025-03-12 02:53:13', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `review_likes`
--

CREATE TABLE `review_likes` (
  `id` int(11) NOT NULL,
  `review_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `type` enum('like','dislike') NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `role` enum('user','admin') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password_hash`, `role`) VALUES
(21, 'Mishi Mee', 'mishimee@gmail.com', '$2y$12$aLZwl10KcT8rErgsejMvIuagTIeeqoDehyzNP4o7NZ8flqKuMT1Im', 'user'),
(22, 'dnb', 'dnb@gmail.com', '$2y$12$rcw4xXTL/O6m3iWIYg27TepTNQHKljZ2vLNLkLJ4ZTQDuWEBY6uu2', 'admin'),
(23, 'dn2b', 'dn2b@gmail.com', '$2y$12$a.VCpeDwsgOV3dw1AxV9UOwHcQfysR53EkDu0ujBJL/7ClMGuzwfC', 'user'),
(24, 'hi', 'hi@gmail.com', '$2y$12$OxyEkKq.ZlnbuQnK.mw7mu5TTprpCPxopK2Knm57Kjz5pINz5WDUW', 'user'),
(25, '1234', 'hi2@gmail.com', '$2y$12$WVz8NnwnVebGerwlhRXG8OxWejzWWS8e0GysLKH6vJyzI7lCA68/G', 'user'),
(26, '12345', '12345@gmail.com', '$2y$12$IYgdAfIec9SqsYeJV3kA6u2k/pt1nUttLKIAX9OgxRI.qPqs1f2bS', 'user'),
(27, 'thainoodleboii', 'tnb@gmail.com', '$2y$12$uHMjWnV/vcIoEIDB8.XWZ.KC5WQs1NNFqCSUH/qKij6wuBIg74n5K', 'user'),
(28, 'daily gamer', 'game54@gmail.com', '$2y$12$0XCVfLUhgsuaGuGMOCAlhOb.dTFO51OEFJsBtlz7Av9SOYxF503k6', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`,`game_id`),
  ADD KEY `game_id` (`game_id`);

--
-- Indexes for table `review_likes`
--
ALTER TABLE `review_likes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `review_id` (`review_id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `games`
--
ALTER TABLE `games`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=190;

--
-- AUTO_INCREMENT for table `review_likes`
--
ALTER TABLE `review_likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`game_id`) REFERENCES `games` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `review_likes`
--
ALTER TABLE `review_likes`
  ADD CONSTRAINT `review_likes_ibfk_1` FOREIGN KEY (`review_id`) REFERENCES `reviews` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `review_likes_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
