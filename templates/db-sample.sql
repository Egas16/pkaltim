-- phpMyAdmin SQL Dump
-- Database: pkaltim
-- Table structure untuk Mini Web Pariwisata Kaltim
-- 
-- Instructions:
-- 1. Create database: CREATE DATABASE pkaltim_tim1;
-- 2. Import file ini via phpMyAdmin
-- 3. Edit data sesuai subtema tim kalian

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- Database: `pkaltim`

-- --------------------------------------------------------

--
-- Table structure for table `users`
-- Admin accounts untuk login
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `role` enum('admin','user') DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
-- Password: admin123 (hashed with password_hash)
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `full_name`, `role`) VALUES
(1, 'admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin@pkaltim.com', 'Administrator', 'admin'),
(2, 'user1', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user@pkaltim.com', 'User Demo', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
-- Kategori untuk destinasi/kuliner/event
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text,
  `icon` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
-- Edit sesuai subtema kalian
--

INSERT INTO `categories` (`id`, `name`, `description`, `icon`) VALUES
(1, 'Wisata Alam', 'Destinasi alam seperti pantai, gunung, air terjun', 'fa-mountain'),
(2, 'Wisata Budaya', 'Tempat budaya dan sejarah Kaltim', 'fa-landmark'),
(3, 'Kuliner', 'Makanan dan minuman khas Kaltim', 'fa-utensils'),
(4, 'Transportasi', 'Ferry, speedboat, dan transportasi wisata', 'fa-ship'),
(5, 'Event', 'Festival dan event pariwisata', 'fa-calendar');

-- --------------------------------------------------------

--
-- Table structure for table `destinations`
-- Main table: Ganti nama sesuai subtema
-- Alternatif: menus, events, ferries, homestays, dll
--

CREATE TABLE `destinations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL,
  `name` varchar(200) NOT NULL,
  `description` text,
  `location` varchar(200) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `rating` decimal(2,1) DEFAULT 0.0,
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL,
  `contact` varchar(50) DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `destinations_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `destinations`
-- Sample data Kalimantan Timur - GANTI dengan data tim kalian!
--

INSERT INTO `destinations` (`id`, `category_id`, `name`, `description`, `location`, `price`, `image`, `rating`, `latitude`, `longitude`, `contact`) VALUES
(1, 1, 'Pulau Derawan', 'Pulau eksotis dengan pantai pasir putih dan biota laut yang indah. Destinasi favorit untuk diving dan snorkeling.', 'Kabupaten Berau, Kalimantan Timur', 500000.00, 'derawan.jpg', 4.8, 2.28333300, 118.25000000, '081234567890'),
(2, 1, 'Danau Kakaban', 'Danau air asin dengan ubur-ubur yang tidak menyengat. Keajaiban alam yang unik di dunia.', 'Kabupaten Berau, Kalimantan Timur', 450000.00, 'kakaban.jpg', 4.7, 2.29166700, 118.36666700, '081234567891'),
(3, 1, 'Air Terjun Tanah Merah', 'Air terjun spektakuler dengan ketinggian 50 meter di tengah hutan tropis Kaltim.', 'Kabupaten Tanah Bumbu, Kalimantan Timur', 200000.00, 'tanah-merah.jpg', 4.5, -3.20000000, 115.83333300, '081234567892'),
(4, 2, 'Rumah Betang Lamin', 'Rumah adat tradisional suku Dayak yang masih terawat dengan baik.', 'Kutai Barat, Kalimantan Timur', 150000.00, 'lamin.jpg', 4.3, -0.50000000, 116.00000000, '081234567893'),
(5, 3, 'Amplang Samarinda', 'Kerupuk ikan khas Samarinda yang renyah dan gurih. Oleh-oleh wajib!', 'Samarinda, Kalimantan Timur', 50000.00, 'amplang.jpg', 4.6, -0.50194400, 117.15377800, '081234567894'),
(6, 3, 'Patin Balikpapan', 'Ikan patin segar dari perairan Balikpapan, diolah dengan bumbu khas.', 'Balikpapan, Kalimantan Timur', 85000.00, 'patin.jpg', 4.4, -1.26753900, 116.82887800, '081234567895'),
(7, 4, 'Ferry Mahakam', 'Kapal ferry yang menghubungkan Samarinda dan Balikpapan via Sungai Mahakam.', 'Samarinda - Balikpapan', 75000.00, 'ferry.jpg', 4.2, -0.50000000, 117.00000000, '081234567896'),
(8, 5, 'Festival Erau', 'Festival budaya tahunan yang menampilkan tarian, musik, dan kuliner Kutai.', 'Tenggarong, Kutai Kartanegara', 0.00, 'erau.jpg', 4.9, -0.40926000, 117.00000000, '081234567897'),
(9, 1, 'Pulau Sangalaki', 'Pulau kecil dengan penyu hijau dan manta ray. Surga bagi penyelam.', 'Kabupaten Berau, Kalimantan Timur', 550000.00, 'sangalaki.jpg', 4.8, 2.13333300, 118.36666700, '081234567898'),
(10, 2, 'Islamic Center Samarinda', 'Masjid megah dengan arsitektur modern dan fasilitas lengkap.', 'Samarinda, Kalimantan Timur', 0.00, 'islamic-center.jpg', 4.7, -0.48388900, 117.15388900, '081234567899');

-- --------------------------------------------------------

--
-- Table structure for table `bookings` (Optional - untuk fitur booking)
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `destination_id` int(11) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `booking_date` date NOT NULL,
  `num_people` int(11) DEFAULT 1,
  `total_price` decimal(10,2) DEFAULT NULL,
  `status` enum('pending','confirmed','cancelled') DEFAULT 'pending',
  `notes` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `destination_id` (`destination_id`),
  CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`destination_id`) REFERENCES `destinations` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `destination_id`, `customer_name`, `email`, `phone`, `booking_date`, `num_people`, `total_price`, `status`) VALUES
(1, 1, 'Budi Santoso', 'budi@email.com', '081234567800', '2026-01-15', 2, 1000000.00, 'confirmed'),
(2, 2, 'Siti Aminah', 'siti@email.com', '081234567801', '2026-01-20', 4, 1800000.00, 'pending');

-- --------------------------------------------------------

--
-- Indexes for dumped tables
--

ALTER TABLE `destinations`
  ADD FULLTEXT KEY `name` (`name`,`description`);

--
-- AUTO_INCREMENT for dumped tables
--

ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

ALTER TABLE `destinations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

COMMIT;

-- --------------------------------------------------------
-- NOTES:
-- 1. Username: admin | Password: admin123
-- 2. Ganti semua data destinations dengan data subtema tim kalian
-- 3. Tambah tabel lain jika diperlukan (reviews, ratings, etc)
-- 4. Pastikan semua data 100% tentang Kalimantan Timur!
-- --------------------------------------------------------
