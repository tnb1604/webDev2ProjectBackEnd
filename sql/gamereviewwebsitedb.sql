-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Apr 06, 2025 at 12:45 AM
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
(2, 'Cyberpunk 2077', 'Cyberpunk 2077 is an open-world, action-adventure RPG set in the dystopian Night City. Players assume the role of V, a mercenary with customizable abilities, navigating through a world full of futuristic technology, neon lights, and political intrigue. The game features a branching storyline, impactful player choices, and an immersive experience in a highly detailed and dynamic environment. Whether it’s combat, hacking, or building relationships with characters, Cyberpunk 2077 offers a wide range of gameplay options in a gritty, high-tech world.', '2020-12-10', 'Sci-Fi RPG', '/images/1743819243_artur-tarnowski-malemain.jpg', 'https://www.youtube.com/watch?v=8X2kIfS6fb8'),
(6, 'The Witcher 3: Wild Hunt', 'The Witcher 3: Wild Hunt is an expansive open-world RPG that follows Geralt of Rivia, a monster hunter, on his quest to find his adopted daughter Ciri. Set in a dark fantasy world filled with mythical creatures, political intrigue, and moral dilemmas, the game features a deeply immersive story, dynamic combat, and meaningful choices that affect the world around you. With hundreds of quests, detailed side stories, and vast landscapes to explore, The Witcher 3 is considered one of the best RPGs of all time.', '2015-05-19', 'RPG', '/images/thewitcher3.jpg', 'https://www.youtube.com/watch?v=XHrskkHf958'),
(7, 'Minecraft', 'Minecraft is a sandbox game that allows players to build and explore vast, procedurally generated worlds made of blocks. Players can gather resources, craft tools, and create structures in a variety of game modes, including Survival, Creative, and Adventure. The game encourages creativity, exploration, and collaboration, with endless possibilities for creating and modifying the world. Over the years, Minecraft has become a cultural phenomenon with a dedicated fanbase, educational uses, and a constantly evolving set of features and mods.', '2011-11-18', 'Sandbox', '/images/minecraft.jpg', 'https://www.youtube.com/watch?v=MmB9b5njVbA'),
(8, 'Red Dead Redemption 2', 'Red Dead Redemption 2 is an open-world action-adventure game set in the dying days of the American Wild West. Players control Arthur Morgan, a member of the Van der Linde gang, as they navigate a world filled with complex characters, morality, and the impending collapse of the outlaw lifestyle. The game features deep storytelling, realistic gameplay, and an incredibly detailed world where every decision has consequences. From hunting wildlife to engaging in intense shootouts, Red Dead Redemption 2 offers an unforgettable experience in a beautifully crafted historical setting.', '2018-10-26', 'Action-Adventure', '/images/1743900175_rdr2-1280-1540463019272_160w.jpg', 'https://www.youtube.com/watch?v=gmA6MrX81z4'),
(10, 'Hollow Knight', 'Hollow Knight is a Metroidvania-style action-platformer set in a beautifully hand-drawn, interconnected world known as Hallownest. Players control the silent protagonist, the Knight, as they venture through this decaying world, battling enemies, solving puzzles, and uncovering secrets. With tight platforming mechanics, intense boss battles, and a rich, atmospheric world filled with lore, Hollow Knight offers one of the most rewarding and challenging experiences in the genre.', '2017-02-24', 'Metroidvania', '/images/hollowknight.jpg', 'https://www.youtube.com/watch?v=nSPJXlYjENE'),
(13, 'The Legend of Zelda: Breath of the Wild', 'The Legend of Zelda: Breath of the Wild is an open-world adventure game set in the iconic Zelda universe. Players control Link as they explore the vast kingdom of Hyrule, solving puzzles, battling enemies, and discovering secrets. The game emphasizes freedom, with a non-linear approach to exploration and multiple ways to tackle challenges. Breath of the Wild redefined the open-world genre with its physics-based puzzles, survival mechanics, and a beautifully detailed world. affffggsdgs', '2017-03-03', 'Adventure', '/images/zeldabotw.jpg', 'https://www.youtube.com/watch?v=zw47_q9wbBE&t=2s'),
(14, 'Dark Souls III', 'Dark Souls III is an action RPG that concludes the Dark Souls series, known for its deep lore, challenging combat, and intricate world design. Set in a decaying world filled with powerful enemies, players take on the role of the Ashen One, tasked with relighting the flame and saving the world from darkness. Dark Souls III features intense battles, rewarding exploration, and a dark narrative that unfolds through environmental storytelling and item descriptions. It’s renowned for its difficulty and its ability to immerse players in a dark, unforgiving world.', '0001-04-12', 'Action RPG', '/images/darksouls3.jpg', 'https://www.youtube.com/watch?v=cWBwFhUv1-8'),
(15, 'Grand Theft Auto V', 'Grand Theft Auto V is an open-world action-adventure game set in the fictional city of Los Santos. Players control three different characters—Michael, Trevor, and Franklin—each with their own storylines that intertwine in a world full of crime, heists, and chaos. The game features a vast open world with a variety of activities, from driving and shooting to playing sports or participating in side missions. Grand Theft Auto V also introduced GTA Online, an ever-evolving multiplayer world with new content and heists.', '2013-09-17', 'Open-World', '/images/gtav.jpg', 'https://www.youtube.com/watch?v=QkkoHAzjnUs'),
(16, 'Persona 5 Royal', 'Persona 5 Royal is an enhanced version of the original Persona 5, a turn-based JRPG set in modern Tokyo. Players control a high school student who leads a double life as the leader of the Phantom Thieves, a group dedicated to reforming corrupt individuals through supernatural means. The game features a rich story, deep social mechanics, dungeon crawling, and stylish visuals. Persona 5 Royal introduces new characters, storylines, and expanded gameplay elements, making it a must-play for fans of the series. fs', '2019-10-31', 'JRPG', '/images/p5r.jpg', 'https://www.youtube.com/watch?v=SKpSpvFCZRw'),
(17, 'Super Mario Odyssey', 'Super Mario Odyssey is a 3D platformer that follows Mario as he travels through various kingdoms to rescue Princess Peach from Bowser. Featuring a wide variety of imaginative worlds and new mechanics, like Mario’s ability to possess enemies and objects, Super Mario Odyssey offers a fun, action-packed adventure. The game also features multiplayer, allowing players to team up and explore together. Super Mario Odyssey was widely praised for its creativity, fun gameplay, and attention to detail.', '2017-10-27', 'Platformer', '/images/marioodyssey.jpg', 'https://www.youtube.com/watch?v=wGQHQc_3ycE'),
(18, 'God of War (2018)', 'God of War (2018) reimagines the God of War series, shifting from Greek to Norse mythology. Players control Kratos, now a father, as he embarks on a journey with his son Atreus to scatter his wife’s ashes atop the highest peak. The game features stunning visuals, deep storytelling, and brutal combat, where players battle gods, monsters, and mythological beings. With a focus on family and redemption, God of War (2018) revitalized the franchise, offering a fresh and engaging experience.', '2018-04-20', 'Action', '/images/gow.jpg', 'https://www.youtube.com/watch?v=K0u_kAWLJOA'),
(19, 'Celeste', 'Celeste is a challenging, pixel-art platformer that tells the emotional story of Madeline as she climbs the titular mountain. The game features tight platforming mechanics, precise movement, and a powerful narrative that deals with mental health, self-discovery, and perseverance. Celeste has been praised for its difficulty, rewarding gameplay, and how it handles sensitive topics with care. It’s a deeply personal journey that combines both gameplay and story in a unique and impactful way.', '2018-01-25', 'Platformer', '/images/celeste.jpg', 'https://www.youtube.com/watch?v=70d9irlxiB4'),
(28, 'The Rizz God', 'The Rizz God is an enigmatic character whose past is filled with mystery and power. Known for his charisma and ability to influence those around him, the Rizz God stands at the intersection of myth and reality. His journey explores themes of self-discovery, personal growth, and confronting the darker aspects of his own nature. The game challenges players to navigate a world where choices matter, relationships are key, and the line between hero and villain is often blurred.', '9999-09-09', 'Action-Adventure', '/images/rizzgod.jpg', 'https://www.youtube.com/watch?v=oucsuzBk3A8'),
(130, 'Baldur\'s Gate 3', 'Baldur\'s Gate 3 is a turn-based RPG set in the Dungeons & Dragons universe. Players create characters, make impactful choices, and explore a rich world with a deep narrative.', '2023-08-03', 'RPG', '/images/1743899971_bg3cover.jpg', 'https://www.youtube.com/watch?v=1T22wNvoNiU'),
(131, 'MINI BOSS MINI BOSS', 'MINION MINI BOSS MINION MINI BOSS MINION MINI BOSS MINION MINI BOSS MINION MINI BOSS MINION MINI BOSS MINION MINI BOSS MINION MINI BOSS MINION MINI BOSS MINION MINI BOSS MINION MINI BOSS MINION MINI BOSS MINION MINI BOSS MINION MINI BOSS MINION MINI BOSS MINION MINI BOSS MINION MINI BOSS MINION MINI BOSS MINION MINI BOSS MINION MINI BOSS MINION MINI BOSS MINION MINI BOSS MINION MINI BOSS MINION MINI BOSS MINION MINI BOSS MINION MINI BOSS MINION MINI BOSS MINION MINI BOSS MINION MINI BOSS MINION MINI BOSS MINION MINI BOSS MINION MINI BOSS MINION MINI BOSS MINION MINI BOSS MINION MINI BOSS', '5555-02-26', 'MINION OVERTAKING THE WORLD', '/images/1743898780_muscleminion.webp', 'https://www.youtube.com/watch?v=NC6xA8Nj-bk'),
(139, 'The Last of Us Part II Remastered', 'The Last of Us Part II is a gripping narrative-driven action-adventure that follows Ellie in a post-apocalyptic world filled with danger, moral dilemmas, and heartbreaking choices.', '2020-06-19', 'Action-Adventure', '/images/1743898943_lou2.jpg', 'https://www.youtube.com/watch?v=Tg1oRHd5zlw'),
(145, 'League Of Legends', 'League of Legends is a free-to-play multiplayer online battle arena (MOBA) game by Riot Games. Two teams of five players choose unique champions and battle to destroy the enemy Nexus on a map called Summoner’s Rift. With over 160 champions, strategic gameplay, and a massive global esports scene, LoL is one of the most popular games in the world. It also expanded into media like music and the hit animated series Arcane.', '2009-10-27', 'MOBA', '/images/1743900219_image_2025-04-06_024338536.png', 'https://www.youtube.com/watch?v=BzecKdr_E04');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `rating` int(11) DEFAULT NULL CHECK (`rating` between 1 and 5),
  `review_text` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `edited_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `game_id`, `title`, `rating`, `review_text`, `created_at`, `edited_at`) VALUES
(220, 21, 7, 'Minecraft Review', 5, 'Fantastisch spel om te bouwen en te verkennen.', '2025-03-25 23:11:41', NULL),
(222, 21, 10, 'Hollow Knight Review', 4, 'Uitdagend en goed ontworpen platformspel, maar soms frustrerend.', '2025-03-25 23:11:41', NULL),
(225, 21, 13, 'The Legend of Zelda: Breath of the Wild Review', 5, 'Fantastische open-wereld ervaring met veel vrijheid.', '2025-03-25 23:11:41', NULL),
(226, 21, 14, 'Dark Souls III Review', 5, 'Intens en moeilijk, maar de voldoening is enorm.', '2025-03-25 23:11:41', NULL),
(227, 21, 15, 'Grand Theft Auto V Review', 4, 'Leuk voor af en toe, maar de missie-gebaseerde gameplay kan repetitief zijn.', '2025-03-25 23:11:41', NULL),
(228, 21, 16, 'Persona 5 Royal Review', 5, 'Een meeslepend verhaal en geweldige personages.', '2025-03-25 23:11:41', NULL),
(229, 21, 17, 'Super Mario Odyssey Review', 4, 'Leuk platformspel met veel creativiteit.', '2025-03-25 23:11:41', NULL),
(231, 21, 19, 'Celeste Review', 5, 'Prachtig spel dat diepgang heeft naast het uitdagende platformen.', '2025-03-25 23:11:41', NULL),
(273, 24, 16, '24', 4, '2', '2025-04-03 02:37:09', NULL),
(275, 34, 16, 'Yaya', 5, 'yeahhhhhhhhhhhhhhhhhhhhhhhhhayeahhhhhhhhhhhhhhhhhhhhhhhhhayeahhhhhhhhhhhhhhhhhhhhhhhhha', '2025-04-03 02:55:55', NULL),
(276, 35, 19, 'Its pretty cool!', 4, 'Awesome, could be improved in small aspects though but great!', '2025-04-03 23:21:43', NULL),
(305, 24, 28, 'Masterpiece.', 5, 'This fella has unspoken rizz, I am baffled. 10/10 story and execution. Need more games like this!', '2025-04-05 20:08:21', NULL),
(307, 48, 131, 'MUHAHAHAHAHAHAHAHAHAHAHAHAHAHAHAHAHAHAHAHAHAHAHAHA', 1, 'I HAVE HACKED YOUR WEBSITE AND YOU SHALL ONLY SEE MINIONS!!!!!!!! TRY STOP ME PAL!!!! HAHAHAHAAHAHAHAHAHHAAHAH', '2025-04-06 00:24:15', NULL),
(308, 49, 28, 'Beautiful game!', 5, 'Awesome!!', '2025-04-06 00:28:36', NULL),
(309, 49, 131, 'What is this?', 3, 'I will contact the administrators of this website, unacceptable that this has not been taken down yet... interesting trailer clip tho.', '2025-04-06 00:29:53', NULL),
(310, 49, 13, 'Cool', 4, 'Quite interesting to play, would defeniteleyel recomoned!! ', '2025-04-06 00:32:09', NULL);

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

--
-- Dumping data for table `review_likes`
--

INSERT INTO `review_likes` (`id`, `review_id`, `user_id`, `type`, `created_at`) VALUES
(15, 220, 21, 'like', '2025-04-03 03:48:35'),
(43, 225, 24, 'like', '2025-04-03 04:10:58'),
(63, 231, 24, 'like', '2025-04-03 04:24:15'),
(64, 225, 34, 'dislike', '2025-04-03 04:24:35'),
(67, 225, 22, 'like', '2025-04-03 23:24:19'),
(92, 273, 22, 'dislike', '2025-04-03 23:42:00'),
(107, 228, 22, 'like', '2025-04-03 23:46:23'),
(108, 275, 22, 'like', '2025-04-03 23:47:59'),
(111, 275, 24, 'like', '2025-04-03 23:48:51'),
(113, 276, 24, 'like', '2025-04-03 23:59:58'),
(114, 228, 24, 'like', '2025-04-04 00:00:03'),
(115, 273, 24, 'dislike', '2025-04-04 00:00:07'),
(119, 226, 24, 'like', '2025-04-04 22:26:27'),
(123, 226, 22, 'like', '2025-04-05 00:44:44'),
(166, 220, 24, 'like', '2025-04-05 18:20:01'),
(169, 305, 49, 'like', '2025-04-06 00:28:39'),
(170, 308, 49, 'like', '2025-04-06 00:28:39'),
(171, 307, 49, 'dislike', '2025-04-06 00:31:28'),
(172, 225, 49, 'like', '2025-04-06 00:31:40'),
(174, 228, 49, 'like', '2025-04-06 00:33:48'),
(175, 273, 49, 'dislike', '2025-04-06 00:33:58');

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
(24, 'hi', 'hi@gmail.com', '$2y$12$OxyEkKq.ZlnbuQnK.mw7mu5TTprpCPxopK2Knm57Kjz5pINz5WDUW', 'user'),
(34, 'mishi', 'mishi@gmail.com', '$2y$12$CVtiWenafvXY8vnb4.qHCuq9r62Y0lCvKRLSYXI/MOgee/2/kIbXO', 'user'),
(35, 'sigma', 'sigma@gmail.com', '$2y$12$MIFblg.WScb4oNr/G1ZZLuh.PliGhyyqYqsllb1Lwpu5Ad9zVPOIC', 'user'),
(48, 'minionman', 'minionthedestroyer@gmail.com', '$2y$12$9vqBfAy3lxgthw.9t2qGceaHYvOZLez89WHjP5xzFIaB4L1HYnBKu', 'user'),
(49, 'ilovekittycats', 'ilovekittycats@gmail.com', '$2y$12$.YKJVWWIpr/meiGI00QrBuOJ6RAqcZXOwcQ6ST6Zv6ib/s9NKmpr.', 'user');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=146;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=311;

--
-- AUTO_INCREMENT for table `review_likes`
--
ALTER TABLE `review_likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=176;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

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
