-- Database: pkaltim_contoh
-- Mini Project Contoh - Wisata Kaltim

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- --------------------------------------------------------

-- Table: users
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

-- Data users
-- Password: admin123 (hashed)
INSERT INTO `users` (`id`, `username`, `password`, `email`, `full_name`, `role`) VALUES
(1, 'admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin@wisatakaltim.com', 'Administrator', 'admin');

-- --------------------------------------------------------

-- Table: categories
CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Data categories
INSERT INTO `categories` (`id`, `name`, `description`) VALUES
(1, 'Wisata Alam', 'Destinasi alam seperti pantai, gunung, air terjun'),
(2, 'Wisata Budaya', 'Tempat budaya dan sejarah Kaltim'),
(3, 'Kuliner', 'Makanan dan minuman khas Kaltim');

-- --------------------------------------------------------

-- Table: destinations
CREATE TABLE `destinations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL,
  `name` varchar(200) NOT NULL,
  `description` text,
  `location` varchar(200) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `rating` decimal(2,1) DEFAULT 0.0,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `destinations_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Data destinations (Kalimantan Timur)
INSERT INTO `destinations` (`id`, `category_id`, `name`, `description`, `location`, `image`, `rating`) VALUES
(1, 1, 'Pulau Derawan', 'Pulau eksotis dengan pantai pasir putih dan biota laut yang indah. Destinasi favorit untuk diving dan snorkeling dengan penyu hijau.', 'Kabupaten Berau, Kalimantan Timur', NULL, 4.8),
(2, 1, 'Danau Kakaban', 'Danau air asin dengan ubur-ubur yang tidak menyengat. Keajaiban alam yang unik di dunia, hanya ada beberapa tempat seperti ini.', 'Kabupaten Berau, Kalimantan Timur', NULL, 4.7),
(3, 1, 'Pulau Sangalaki', 'Pulau kecil dengan penyu hijau dan manta ray. Surga bagi penyelam dengan terumbu karang yang masih terjaga.', 'Kabupaten Berau, Kalimantan Timur', NULL, 4.6),
(4, 2, 'Rumah Lamin Adat', 'Rumah adat tradisional suku Dayak yang masih terawat dengan baik. Tempat belajar budaya dan tradisi Dayak Kaltim.', 'Kutai Barat, Kalimantan Timur', NULL, 4.3),
(5, 2, 'Islamic Center Samarinda', 'Masjid megah dengan arsitektur modern dan fasilitas lengkap. Landmark kota Samarinda.', 'Samarinda, Kalimantan Timur', NULL, 4.5),
(6, 3, 'Amplang Khas Samarinda', 'Kerupuk ikan khas Samarinda yang renyah dan gurih. Oleh-oleh wajib dari Kaltim!', 'Samarinda, Kalimantan Timur', NULL, 4.4);

-- --------------------------------------------------------

ALTER TABLE `users` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
ALTER TABLE `categories` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
ALTER TABLE `destinations` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

COMMIT;
