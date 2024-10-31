-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 31, 2024 at 05:19 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `peduli_rasa`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `name`) VALUES
(1, 'Makanan Basah'),
(2, 'Makanan Kering'),
(3, 'Minuman'),
(4, 'Jumat Berkah'),
(5, 'Peduli Sosial'),
(6, 'Bakti Sosial');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `description` text NOT NULL,
  `post_date` datetime NOT NULL,
  `location` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int NOT NULL,
  `category_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `title`, `description`, `post_date`, `location`, `created_at`, `user_id`, `category_id`) VALUES
(33, 'Makanan Berlebih dari Restoran A', 'Kami memiliki makanan berlebih dari acara pernikahan yang siap dibagikan kepada yang membutuhkan.', '2024-10-01 10:10:00', 'Jakarta', '2024-10-31 14:30:13', 4, 2),
(34, 'Roti dan Kue dari Bakery B', 'Roti dan kue yang tidak terjual dari bakery kami, siap untuk dibagikan.', '2024-10-02 09:10:00', 'Bandung', '2024-10-31 14:31:07', 4, 2),
(35, 'Sayuran Segar dari Petani C', 'Sayuran segar yang tidak terjual dan masih layak konsumsi, bisa diambil di lokasi kami.', '2024-10-12 12:02:00', 'Yogyakarta', '2024-10-31 14:32:33', 4, 1),
(36, 'Makanan Siap Saji dari Kantin D', 'Makanan siap saji yang berlebih dari kantin, kami ingin mendistribusikannya kepada yang membutuhkan.', '2024-10-04 08:12:00', 'Surabaya', '2024-10-31 14:38:20', 4, 2),
(37, 'Buah-Buahan dari Toko E', 'Buah-buahan yang sudah tidak terjual, masih dalam kondisi baik dan layak konsumsi.', '2024-10-31 21:39:00', 'Medan', '2024-10-31 14:40:00', 4, 2),
(38, 'Makanan Penutup dari Kafe F', 'Makanan penutup yang tersisa dari kafe kami, siap dibagikan.', '2024-10-31 21:40:00', 'Bali', '2024-10-31 14:40:38', 4, 2),
(39, 'Sisa Makanan dari Event G', 'Sisa makanan dari event yang kami adakan, semua dalam kondisi baik.', '2024-10-31 13:43:00', 'Semarang', '2024-10-31 14:41:31', 4, 2),
(40, 'Makanan Tradisional dari Komunitas H', 'Makanan tradisional yang dibuat oleh komunitas kami, siap untuk dibagikan.', '2024-10-31 09:41:00', 'Malang', '2024-10-31 14:42:21', 4, 2),
(41, 'Snack Sehat dari Produsen I', 'Snack sehat yang tidak terjual dari produsen kami, bisa diambil di lokasi kami.', '2024-10-31 18:43:00', 'Jakarta', '2024-10-31 14:43:43', 4, 2),
(42, 'Makanan Ringan dari Acara J', 'Makanan ringan yang tersisa dari acara, masih dalam kondisi baik.', '2024-10-31 08:44:00', 'Bandung', '2024-10-31 14:44:21', 4, 2),
(43, 'Daging Segar dari Peternakan K', 'Daging segar yang tidak terjual dan masih layak konsumsi.', '2024-10-31 18:44:00', 'Yogyakarta', '2024-10-31 14:44:58', 4, 2),
(44, 'Makanan Vegan dari Restoran L', 'Makanan vegan yang berlebih dari restoran kami, siap untuk dibagikan.', '2024-10-31 12:45:00', 'Surabaya', '2024-10-31 14:46:06', 4, 2),
(45, 'Kue Kering dari Bakery M', 'Kue kering yang tidak terjual, masih dalam kondisi baik dan siap untuk dibagikan.', '2024-10-31 18:35:00', 'Medan', '2024-10-31 14:46:43', 4, 2),
(46, 'Makanan Asia dari Restoran N', 'Makanan asia yang berlebih dari restoran kami, siap untuk dibagikan.', '2024-11-01 18:46:00', 'Bali', '2024-10-31 14:47:46', 4, 2),
(47, 'Buah-Buahan Segar dari Petani O', 'Buah-buahan segar yang tidak terjual dan masih layak konsumsi.', '2024-11-01 15:49:00', 'Jakarta', '2024-10-31 14:50:13', 4, 2),
(48, 'Makanan Berlebih dari Restoran P', 'Makanan berlebih dari restoran kami, siap untuk dibagikan.', '2024-11-02 16:51:00', 'Bandung', '2024-10-31 14:52:12', 4, 1),
(49, 'Roti dan Kue dari Bakery Q', 'Roti dan kue yang tidak terjual dari bakery kami, siap untuk dibagikan.', '2024-10-31 18:54:00', 'Yogyakarta', '2024-10-31 14:54:57', 4, 2),
(50, 'es teh gratiss', 'es teh gratis khusus mahasiswa sekitatan kalimanah blater', '2024-10-31 18:52:00', 'Purbalingga blater', '2024-10-31 15:00:25', 4, 3),
(51, 'Sayuran Segar dari Petani R', 'Sayuran segar yang tidak terjual dan masih layak konsumsi, bisa diambil di lokasi kami.', '2024-11-02 15:01:00', 'Purbalingga blater', '2024-10-31 15:01:28', 4, 1),
(52, 'Makanan Siap Saji dari Kantin S', 'Makanan siap saji yang berlebih dari kantin, kami ingin mendistribusikannya kepada yang membutuhkan.', '2024-11-02 19:02:00', 'Purbalingga blater', '2024-10-31 15:02:35', 4, 1),
(53, 'Buah-Buahan dari Toko T', 'Buah-buahan yang sudah tidak terjual, masih dalam kondisi baik dan layak konsumsi.', '2024-11-02 17:02:00', 'Purbalingga blater', '2024-10-31 15:03:13', 4, 1),
(54, 'Jumat Berkah - Makanan Gratis', 'Pembagian makanan gratis untuk masyarakat yang membutuhkan di sekitar masjid kalimanah ', '2024-11-04 14:03:00', 'kalimanah - purbalingga', '2024-10-31 15:04:55', 4, 4),
(55, 'Bakti Sosial - Bersih-Bersih Lingkungan', 'Kegiatan bersih-bersih lingkungan di area taman kota Bandung.', '2024-11-03 07:05:00', 'Bandung', '2024-10-31 15:07:25', 4, 6),
(56, 'Peduli Sosial - Donasi Pakaian', 'Pengumpulan pakaian layak pakai untuk disalurkan kepada yang membutuhkan.', '2024-11-05 22:07:00', 'Purbalingga blater', '2024-10-31 15:08:49', 4, 5),
(57, 'Jumat Berkah - Berbagi Sembako', 'Pembagian sembako untuk keluarga kurang mampu', '2024-11-14 13:09:00', 'Purbalingga blater', '2024-10-31 15:10:33', 4, 5),
(58, 'Peduli Sosial - Pembagian Alat Tulis', 'Pembagian alat tulis untuk anak-anak di sekolah-sekolah kurang mampu.', '2024-11-11 09:11:00', 'Jakarta', '2024-10-31 15:11:38', 4, 5),
(59, 'Peduli Sosial - Kegiatan Penghijauan', 'Menanam pohon di area publik untuk menjaga lingkungan.', '2024-11-09 15:12:00', 'Purbalingga blater', '2024-10-31 15:13:58', 4, 5),
(60, 'Jumat Berkah - Makanan Siap Saji', 'pembagian makanan siap saji untuk warga yang membutuhkan.', '2024-11-07 22:14:00', 'Surabaya', '2024-10-31 15:15:47', 4, 4),
(61, 'Peduli Sosial - Donasi Darah', 'Donasi darah untuk membantu pasien yang membutuhkan.', '2024-11-08 09:16:00', 'Bandung', '2024-10-31 15:17:04', 4, 5);

-- --------------------------------------------------------

--
-- Table structure for table `post_images`
--

CREATE TABLE `post_images` (
  `image_id` int NOT NULL,
  `post_id` int DEFAULT NULL,
  `image_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `post_images`
--

INSERT INTO `post_images` (`image_id`, `post_id`, `image_name`) VALUES
(42, 33, '672394754091b.jpg'),
(43, 33, '6723947541584.jpg'),
(44, 34, '672394aba9fee.jpg'),
(45, 34, '672394abaa7b6.jpg'),
(46, 35, '6723950147309.jpg'),
(47, 36, '6723965c7fbd5.jpg'),
(48, 36, '6723965c80393.jpg'),
(49, 37, '672396c0207c6.jpg'),
(50, 38, '672396e6b5199.jpg'),
(51, 38, '672396e6b57b5.jpg'),
(52, 39, '6723971b44afc.jpg'),
(53, 40, '6723974d33ab1.jpg'),
(54, 41, '6723979f1491a.jpg'),
(55, 42, '672397c51896a.jpg'),
(56, 43, '672397ea88884.jpg'),
(57, 44, '6723982eb8caf.jpg'),
(58, 44, '6723982eb9856.jpg'),
(59, 45, '67239853e24ac.jpg'),
(60, 46, '67239892ccb0a.jpg'),
(61, 46, '67239892cd3a2.jpg'),
(62, 47, '6723992513f4c.jpg'),
(63, 48, '6723999c3cfd8.jpg'),
(64, 48, '6723999c3d899.jpg'),
(65, 49, '67239a415318d.jpg'),
(66, 49, '67239a41536b1.jpg'),
(67, 50, '67239b89efcf3.jpg'),
(68, 51, '67239bc81a9f3.jpg'),
(69, 52, '67239c0bd416e.jpg'),
(70, 52, '67239c0bd4aa3.jpg'),
(71, 53, '67239c31f22fe.jpg'),
(72, 54, '67239c97ebe46.jpg'),
(73, 54, '67239c97ec47f.jpg'),
(74, 55, '67239d2d2d683.jpg'),
(75, 55, '67239d2d2df7e.jpg'),
(76, 56, '67239d8159e64.jpg'),
(77, 56, '67239d815a475.jpg'),
(78, 57, '67239de9d659a.jpg'),
(79, 58, '67239e2aa0d98.jpg'),
(80, 58, '67239e2aa1378.jpg'),
(81, 58, '67239e2aa1845.jpg'),
(82, 59, '67239eb60c920.jpg'),
(83, 59, '67239eb60ce67.jpg'),
(84, 60, '67239f231f140.jpg'),
(85, 60, '67239f231f770.jpg'),
(86, 60, '67239f231fc0d.jpg'),
(87, 61, '67239f70ba6bb.jpg'),
(88, 61, '67239f70bad3d.jpg'),
(89, 61, '67239f70bc93e.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `session_id` varchar(255) NOT NULL,
  `user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`session_id`, `user_id`) VALUES
('6723a4d67b0ca', 4),
('6723ac7b8a94e', 4),
('6723b1f4d48d9', 4),
('6723b81336935', 4),
('6723b728f018f', 5);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `profile_photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `phone_number`, `profile_photo`, `created_at`) VALUES
(4, 'dumy', 'dumy@dumy.com', '$2y$10$UOCAL5ub7ICkuyjuTPX/PelJ6.7LOmYUBKsSV4phhRI34CtPf/XRu', '+6281226998037', '6723ae92a1ec8.jpg', '2024-10-31 14:26:48'),
(5, 'Sulthon', 'sulthon@example.com', '$2y$10$XTIFm9fzMZFuUVJp.p8wJutZD8riFKr1xO.rMun8Z0rWFpxC//bs.', '+62812345654', NULL, '2024-10-31 16:58:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `fk_post_categories` (`category_id`),
  ADD KEY `fk_post_user` (`user_id`);

--
-- Indexes for table `post_images`
--
ALTER TABLE `post_images`
  ADD PRIMARY KEY (`image_id`),
  ADD KEY `fk_image_post` (`post_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`session_id`),
  ADD KEY `fk_sessions_user` (`user_id`);

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
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `post_images`
--
ALTER TABLE `post_images`
  MODIFY `image_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `fk_post_categories` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_post_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `post_images`
--
ALTER TABLE `post_images`
  ADD CONSTRAINT `fk_image_post` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`) ON DELETE CASCADE;

--
-- Constraints for table `sessions`
--
ALTER TABLE `sessions`
  ADD CONSTRAINT `fk_sessions_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
