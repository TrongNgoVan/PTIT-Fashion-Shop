-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 21, 2025 lúc 06:24 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `ptit_shop`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` mediumtext NOT NULL,
  `summary` mediumtext NOT NULL,
  `stock` tinyint(3) UNSIGNED NOT NULL,
  `unit` varchar(50) DEFAULT NULL,
  `price` double NOT NULL,
  `disscounted_price` double NOT NULL,
  `images` text NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `brand_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `name`, `slug`, `description`, `summary`, `stock`, `unit`, `price`, `disscounted_price`, `images`, `category_id`, `brand_id`, `status`, `created_at`, `updated_at`) VALUES
(12, 'Áo sơ mi trắng', '-o-s-mi-tr-ng', 'Chất liệu: Cotton 100%\r\nSize: 31-32-33\r\nCân nặng phù hợp: 55 - 60 - 65 kg\r\nChiều cao: 1m60 - 1m65 - 1m70\r\n', '    Áo sơ mi trắng dài tay cổ cao chất liệu mềm mịn, thoáng mát', 255, 'chục', 35000, 30000, 'uploads/67bb82d37f45b.jpg;uploads/67bb82d380827.jpg;uploads/67bb82d381018.jpg', 1, 5, 'Active', NULL, NULL),
(13, 'Áo Sơ mi kẻ sọc cộc tay', '-o-s-mi-k-s-c-c-c-tay', '                        Chất liệu : Cotton 50%, Lụa 50%\r\nSize: 35-36-37                        ', '                        Áo Sơ mi kẻ sọc cộc tay chất liệu thoáng mát                        ', 186, 'kí', 10000, 5000, 'uploads/67bb8556e34d6coctay.jpg', 1, 5, 'Active', NULL, NULL),
(14, 'Áo Sơ mi', '-o-s-mi', 'Chất liệu Thư giãn', 'Áo sơ mi thoáng mát dành cho nam và nữ đều mặc được', 255, 'kí', 60000, 50000, 'uploads/67bb85dca3401somi.jpg', 1, 5, 'Active', NULL, NULL),
(15, 'Quần bò ống suông', 'qu-n-b-ng-su-ng', '', '', 252, 'kí', 30000, 28000, 'uploads/67bb8658b18b0bo.jpg', 4, 5, 'Active', NULL, NULL),
(16, 'Áo gió mỏng', '-o-gi-m-ng', '', '', 255, 'kí', 129999, 99000, 'uploads/67bb863b411f2gio.jpg', 6, 5, 'Active', NULL, NULL),
(17, 'Áo sơ mi PTIT', '-o-s-mi-ptit', '', '', 255, 'kí', 129000, 12000, 'uploads/67bb86cc90081c4.jpg', 1, 5, 'Active', NULL, NULL),
(18, 'Áo sơ mi vải lụa ', '-o-s-mi-v-i-l-a-', '', '', 255, 'kí', 87000, 80000, 'uploads/67bb86aa5625fquanau.jpg', 1, 5, 'Active', NULL, NULL),
(19, 'Áo Phao Dày dặn ', '-o-phao-d-y-d-n-', '', '', 255, 'kí', 90000, 80000, 'uploads/67bb8804339bdgio.jpg', 6, 5, 'Active', NULL, NULL),
(20, 'Quản tây lịch lãm ống rộng', 'qu-n-t-y-l-ch-l-m-ng-r-ng', '', '', 251, 'túi', 90000, 35000, 'uploads/67bb8827474b5quanau.jpg', 2, 5, 'Active', NULL, NULL),
(21, 'Áo Hoodie lông chuột ấm áp', '-o-hoodie-l-ng-chu-t-m-p', '', '', 254, 'lon', 8888888, 888888, 'uploads/67bb885047899hodi.jpg', 9, 5, 'Active', NULL, NULL),
(22, 'Áo Polo Bưu Chính', '-o-polo-b-u-ch-nh', '', '', 255, 'lít', 999999, 90000, 'uploads/67bb87c2d96bbpolo.jpg', 3, 5, 'Active', NULL, NULL),
(23, 'Áo Varsity Bưu Chính', '-o-varsity-b-u-ch-nh', '', '', 252, 'lít', 120000, 100000, 'uploads/67bb87e5653a3c3.jpg', 5, 5, 'Active', NULL, NULL),
(24, 'Quần jean Nam Nữ', 'qu-n-jean-nam-n-', '', '\r\n                                                ', 248, 'lạng', 90000, 80000, 'uploads/67bb860d57fc5bo.jpg', 4, 5, 'Active', NULL, NULL),
(25, 'Áo Bomber PTIT', '-o-bomber-ptit', '                                                ', '                                                ', 196, 'kí', 1200000, 1000000, 'uploads/67bb877e5a7c5c2.jpg', 5, 5, 'Active', NULL, NULL),
(26, 'Áo Hoodie Form rộng', '-o-hoodie-form-r-ng', '', '', 255, 'kí', 9999999, 8000000, 'uploads/67bb875ddfd12hodi.jpg', 9, 5, 'Active', NULL, NULL),
(27, 'Quần bò ống loe', 'qu-n-b-ng-loe', '\r\n                                                ', '', 247, 'kí', 80000, 75000, 'uploads/67bb87248d049bo.jpg', 4, 5, 'Active', NULL, NULL),
(28, 'Áo Jacket PTIT', '-o-jacket-ptit', '', '', 251, 'kí', 125000, 120000, 'uploads/67bb86fe106a0c1.jpg', 5, 5, 'Active', NULL, NULL),
(29, 'Áo Polo PTIT', '-o-polo-ptit', '', '', 255, 'kí', 99999, 99900, 'uploads/67bb8626e8fa9polo.jpg', 3, 5, 'Active', NULL, NULL),
(30, 'Quần Âu form Regular', 'qu-n-u-form-regular', '', '', 2, 'kí', 300, 300, 'uploads/67bb87a345754quanau.jpg', 2, 5, 'Active', NULL, NULL),
(31, 'áo AI PTIT', '-o-ai-ptit', '                        Áo unisex dành cho cả nam và nữ                        ', '                        Áo Polo khoa Trí tuệ nhân tạo PTIT                        ', 100, NULL, 250000, 210000, 'uploads/67fd428501345_AI_Logo.png', 3, 5, 'Active', NULL, NULL),
(32, 'Áo đôi tình nhân', '-o-i-t-nh-nh-n', 'Áo T--Shirt cọc tay unisex', 'Áo đôi cho các cặp nam nữ mặc đi biển', 250, NULL, 300000, 230000, 'uploads/67fd45d12fc0c_logoptit2.png', 1, 10, 'Active', NULL, NULL),
(33, 'Test', 'test', '<h2><i><strong>Thông số kỹ thuật</strong></i></h2><ol><li><strong>Chiều dài: 20cm</strong></li><li><strong>Chiều rộng: 40cm</strong></li></ol><figure class=\"image\"><img src=\"/PTIT_SHOP/quantri/upload/hd2.jpg\"></figure>', '', 255, NULL, 250000, 200000, 'uploads/681c966e32981_AI_Chalange.jpg', 4, 5, 'Active', NULL, NULL);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_brand_id_foreign` (`brand_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`),
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
