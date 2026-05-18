








SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;








CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `genre_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `isbn` varchar(20) NOT NULL,
  `total_copies` int(11) NOT NULL CHECK (`total_copies` > 0),
  `shelf_location` varchar(100) NOT NULL,
  `published_year` year(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;




INSERT INTO `books` (`id`, `genre_id`, `title`, `author`, `isbn`, `total_copies`, `shelf_location`, `published_year`, `created_at`) VALUES
(2, 4, 'pink floyd', 'kahium ahamed fahim', '12312343534', 200, 'kuril', '2022', '2026-05-08 22:12:44'),
(3, 4, 'Guns n Roses the myth', 'Kahium Ahamed Fahim', '39847927498', 100, 'kuril', '2012', '2026-05-09 08:45:29'),
(4, 4, 'shek hasin the dictator', 'kahium ahamed fahim', '1234567890', 100, 'kuril', '2024', '2026-05-09 09:16:07'),
(5, 4, 'shek mujibure rahman', 'kahium ahamed fahim', '12312343534435234', 200, 'kuril', '2020', '2026-05-09 09:31:03'),
(6, 3, 'about robot', 'kahium ahamed fahim', '1232345235324', 100, 'kuril', '2022', '2026-05-09 15:24:12');





CREATE TABLE `borrow_records` (
  `id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `status` enum('Pending','Active','Returned') DEFAULT 'Pending',
  `borrow_date` date NOT NULL,
  `due_date` date NOT NULL,
  `return_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;




INSERT INTO `borrow_records` (`id`, `member_id`, `book_id`, `status`, `borrow_date`, `due_date`, `return_date`) VALUES
(1, 6, 2, 'Returned', '2026-05-09', '2026-05-16', '2026-05-09 15:39:06'),
(2, 6, 2, 'Returned', '2026-05-09', '2026-05-16', '2026-05-09 15:39:03'),
(3, 6, 2, 'Returned', '2026-05-09', '2026-05-16', '2026-05-09 00:00:00'),
(4, 6, 2, 'Returned', '2026-05-09', '2026-05-16', '2026-05-09 00:00:00'),
(5, 6, 2, 'Returned', '2026-05-09', '2026-05-16', '2026-05-09 00:00:00'),
(6, 6, 2, 'Returned', '2026-05-09', '2026-05-16', '2026-05-09 00:00:00'),
(7, 6, 3, 'Returned', '2026-05-09', '2026-05-16', '2026-05-09 00:00:00'),
(8, 7, 3, 'Returned', '2026-05-09', '2026-05-23', '2026-05-09 15:36:26'),
(9, 6, 3, 'Returned', '2026-05-09', '2026-05-23', '2026-05-09 15:36:28'),
(10, 6, 4, 'Returned', '2026-05-09', '2026-05-23', '2026-05-09 15:36:12'),
(12, 6, 5, 'Returned', '2026-05-09', '2026-05-23', '2026-05-09 15:36:00'),
(13, 6, 5, 'Active', '2026-05-09', '2026-05-23', NULL),
(14, 6, 4, 'Active', '2026-05-09', '2026-05-23', NULL),
(15, 6, 3, 'Active', '2025-05-08', '2026-04-02', NULL),
(16, 6, 2, 'Returned', '2025-05-07', '2026-03-03', '2026-05-09 21:25:18');





CREATE TABLE `fines` (
  `id` int(11) NOT NULL,
  `borrow_record_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `is_paid` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `overdue_days` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;




INSERT INTO `fines` (`id`, `borrow_record_id`, `member_id`, `amount`, `is_paid`, `created_at`, `overdue_days`) VALUES
(1, 15, 6, 185.00, 1, '2026-05-09 11:30:00', 37),
(2, 16, 6, 335.00, 1, '2026-05-09 11:31:07', 67);





CREATE TABLE `genres` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;




INSERT INTO `genres` (`id`, `name`) VALUES
(4, 'history'),
(5, 'music'),
(3, 'science fiction');





CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `role` enum('member','librarian','admin') DEFAULT 'member',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;




INSERT INTO `members` (`id`, `name`, `email`, `password_hash`, `phone`, `role`, `created_at`) VALUES
(1, 'ahamed fahim', 'kahiumahamedfahim@gmail.com', '$2y$10$isXw/q2M/I1mpsZOieiJW.wBrRdU8N4IQ5dkDT/28lhvM78ZqD.OC', '01841572001', 'librarian', '2026-05-08 17:34:31'),
(2, 'fahim', 'fahim@gmail.com', '$2y$10$0nAnTOqc1C.lk9u4rDCfQu9WE3TzmOmcyZt41qRSO63pWY34oJRJS', '01912594219', 'member', '2026-05-08 17:36:56'),
(4, 'librarian', 'librarian@gmail.com', '$2y$10$Rh3XyW44/dcU26JU3ZxNmuCUEmlnDKGxOaNGaVdp7meZlAQbjojVm', '01578232', 'librarian', '2026-05-08 21:01:05'),
(5, 'admin', 'admin@gmail.com', '$2y$10$naGmACr04ZvGWPV/0SHzj./79yXxN4XHXYl2OEF53iBPfm6FmrSk2', '01851', 'admin', '2026-05-08 21:02:54'),
(6, 'user', 'user@gmail.com', '$2y$10$dtZeP6WnuEvEdBgx2Z.a0ey.TD3Y3jnFAt1Hk3qViuRq1JtotkgPy', '01851572001', 'member', '2026-05-08 21:49:45'),
(7, 'user2', 'user2@gmail.com', '$2y$10$KpOliAGdWNkM0JDFxSQLg.2PfISq718jPh8lBOXgk37/wGbc5N3ku', '01644278261', 'admin', '2026-05-09 09:08:30'),
(8, 'librarian2', 'librarian2@gmail.com', '$2y$10$JoLHpRK8xOMIJBZwRVLAOearTXq0r5Ur1nZzQUCecqRzwj8LGL0tq', '01686139048', 'librarian', '2026-05-09 14:30:20');






ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `isbn` (`isbn`),
  ADD KEY `fk_books_genre` (`genre_id`),
  ADD KEY `idx_book_title` (`title`),
  ADD KEY `idx_book_author` (`author`);



ALTER TABLE `borrow_records`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_borrow_member` (`member_id`),
  ADD KEY `fk_borrow_book` (`book_id`),
  ADD KEY `idx_borrow_status` (`status`);



ALTER TABLE `fines`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_fine_borrow` (`borrow_record_id`),
  ADD KEY `fk_fine_member` (`member_id`),
  ADD KEY `idx_fine_paid` (`is_paid`);



ALTER TABLE `genres`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);



ALTER TABLE `members`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `unique_phone` (`phone`),
  ADD KEY `idx_member_email` (`email`);






ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;



ALTER TABLE `borrow_records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;



ALTER TABLE `fines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;



ALTER TABLE `genres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;



ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;






ALTER TABLE `books`
  ADD CONSTRAINT `fk_books_genre` FOREIGN KEY (`genre_id`) REFERENCES `genres` (`id`) ON UPDATE CASCADE;



ALTER TABLE `borrow_records`
  ADD CONSTRAINT `fk_borrow_book` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_borrow_member` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;



ALTER TABLE `fines`
  ADD CONSTRAINT `fk_fine_borrow` FOREIGN KEY (`borrow_record_id`) REFERENCES `borrow_records` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_fine_member` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
