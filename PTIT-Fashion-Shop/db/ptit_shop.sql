-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 11, 2025 lúc 04:58 PM
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
-- Cấu trúc bảng cho bảng `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `address` text NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `type` enum('Admin','Staff') NOT NULL DEFAULT 'Staff'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `email_verified_at`, `password`, `phone`, `address`, `status`, `type`) VALUES
(1, 'Ngọ Văn Trọng', 'ngovantrong1308@gmail.com', '2025-02-12 22:02:40', '123', '0904708498', 'Thanh Hóa', 'Active', 'Admin'),
(2, 'Nguyễn Hoàng Hải', 'nhhai@gmail.com', '2025-02-14 22:02:40', '123', '0909090909', 'Thanh Hóa', 'Active', 'Admin'),
(3, 'Tạ Kiều Yến', 'tkyen@gmail.com', '2025-02-14 22:02:40', '123', '0879675765', 'Hà Nội', 'Active', 'Admin');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `banner`
--

CREATE TABLE `banner` (
  `id` int(11) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `hot_text` varchar(255) NOT NULL,
  `link_url` varchar(255) DEFAULT '#',
  `status` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `banner`
--

INSERT INTO `banner` (`id`, `image_path`, `hot_text`, `link_url`, `status`) VALUES
(1, 'http://localhost/PTIT_SHOP/quantri/img/banner/banner.jpg', 'Giảm giá 50% cho đơn hàng đầu tiên! Mua ngay kẻo lỡ, sản phẩm hot nhất tháng 3!', '#', 0),
(2, 'http://localhost/PTIT_SHOP/quantri/img/banner/1744607703_Toa_nha_A2_PTIT.jpg', 'Sale sập sàn 30/4 - 1/5 cho các sản phẩm quần áo mùa hè!!!', '#', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `brands`
--

INSERT INTO `brands` (`id`, `name`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Jbaggy', 'lg', 'Active', NULL, NULL),
(3, 'Bitis Hunter', 'samsung', 'Active', NULL, NULL),
(4, 'Nike', 'apple', 'Active', NULL, NULL),
(5, 'PTIT', 'no-brands', 'Active', NULL, NULL),
(10, 'Clothing', 'Clothing', 'Active', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `img` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `img`) VALUES
(1, 'Áo Sơ Mi', 'may-tinh', 'img/categories/somi.jpg'),
(2, 'Quần Tây - Kaki', 'dien-thoai', 'img/categories/quanau.jpg'),
(3, 'Áo Polo', 'may-tinh-bang', 'img/categories/polo.jpg'),
(4, 'Quần Jeans', 'hanh-toi-que', 'img/categories/bo.jpg'),
(5, 'Áo Jacket - Bomber - Varsity', 'dac-san-kho', 'img/categories/c2.jpg'),
(6, 'Áo Gió - Phao', 'nem-cha-quang-ngai', 'img/categories/gio.jpg'),
(9, 'Áo Hoodie', 'danh-m-c-demo', 'img/categories/hodi.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `magiamgia`
--

CREATE TABLE `magiamgia` (
  `id` int(11) NOT NULL,
  `code` varchar(50) NOT NULL,
  `loai_giam_gia` enum('tien','phan_tram') NOT NULL,
  `gia_tri_giam` decimal(10,2) NOT NULL,
  `dieu_kien_giam` decimal(10,2) NOT NULL,
  `mo_ta` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `ngay_het_han` date DEFAULT NULL,
  `so_luot_su_dung` int(11) DEFAULT 0,
  `so_luot_gioi_han` int(11) DEFAULT 10
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `magiamgia`
--

INSERT INTO `magiamgia` (`id`, `code`, `loai_giam_gia`, `gia_tri_giam`, `dieu_kien_giam`, `mo_ta`, `image`, `ngay_het_han`, `so_luot_su_dung`, `so_luot_gioi_han`) VALUES
(1, 'PTIT30', 'tien', 30000.00, 99000.00, 'Mã giảm giá hot nhất dịp lễ 30/4', 'http://localhost/PTIT_SHOP/quantri/img/magiamgia/ptit.png', '2025-05-01', 6, 10),
(2, 'SALE50', 'phan_tram', 50.00, 150000.00, 'Giảm giá 50% cho đơn hàng trên 150k', 'http://localhost/PTIT_SHOP/quantri/img/magiamgia/ptit.png', '2025-05-05', 3, 20),
(3, 'NEWUSER10', 'phan_tram', 10.00, 0.00, 'Giảm 10% cho khách hàng mới', 'http://localhost/PTIT_SHOP/quantri/img/magiamgia/ptit.png', '2025-06-01', 16, 100),
(4, 'FREESHIP', 'tien', 20000.00, 50000.00, 'Giảm 20k phí vận chuyển cho đơn từ 50k', 'http://localhost/PTIT_SHOP/quantri/img/magiamgia/ptit.png', '2025-04-30', 6, 50),
(5, 'SUMMER15', 'phan_tram', 15.00, 100000.00, 'Ưu đãi hè: Giảm 15% đơn từ 100k', 'http://localhost/PTIT_SHOP/quantri/img/magiamgia/ptit.png', '2025-07-01', 12, 30),
(6, 'NEW001', 'tien', 20000.00, 0.00, 'Tưng bừng khai trương, giảm giá cho tất cả mặt hàng', 'http://localhost/PTIT_SHOP/quantri/img/magiamgia/1744636255_logo_cntt_ptit.png', '2025-03-15', 12, 50);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `news`
--

CREATE TABLE `news` (
  `id` bigint(20) NOT NULL,
  `title` tinytext NOT NULL,
  `avatar` varchar(200) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `sumary` mediumtext NOT NULL,
  `description` mediumtext NOT NULL,
  `newscategory_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `news`
--

INSERT INTO `news` (`id`, `title`, `avatar`, `slug`, `sumary`, `description`, `newscategory_id`, `created_at`, `updated_at`) VALUES
(16, 'Celebration of the 50th Anniversary of the Liberation of the South and National Reunification (April 30, 1975 / April 30, 2025)', 'uploads/news/news_681fa4041be19.jpg', 'celebration-of-the-50th-anniversary-of-the-liberation-of-the-south-and-national-reunification-april-30-1975-april-30-2025-', '<p><i><strong>On the morning of April 30, in Ho Chi Minh City, the Party Central Committee, the National Assembly, the President, the Government, the Central Committee of the Vietnam Fatherland Front and the People\'s Committee of Ho Chi Minh City solemnly held the ceremony to celebrate the 50th anniversary of the Liberation of the South and National Reunification (April 30, 1975 / April 30, 2025).</strong></i></p>', '<h2><i><strong>I. Attending the ceremony were:</strong></i></h2><ol><li>Attending the ceremony were: General Secretary To Lam; former General Secretary Nong Duc Manh; President Luong Cuong; former Presidents: Tran Duc Luong, Nguyen Minh Triet, Truong Tan Sang; Prime Minister Pham Minh Chinh; former Prime Minister Nguyen Tan Dung; National Assembly Chairman Tran Thanh Man; former National Assembly Chairmen: Nguyen Van An, Nguyen Thi Kim Ngan; Tran Cam Tu, Politburo member, Standing member of the Secretariat, Head of the Central Steering Committee for the celebration of major holidays and important events of the country; Do Van Chien, Politburo member, Secretary of the Party Central Committee, Chairman of the Central Committee of the Vietnam Fatherland Front; Nguyen Van Nen, Politburo member, Secretary of the Ho Chi Minh City Party Committee; Politburo members, former Politburo members; Party Central Committee Secretaries, former Party Central Committee Secretaries.</li></ol><figure class=\"image\"><img src=\"/PTIT_SHOP/quantri/upload/Screenshot 2025-05-11 014401.png\"></figure><p>&nbsp;</p><h2><i><strong>II. The leaders of the Ministry of National Defense attended the ceremony with the following comrades:&nbsp;</strong></i></h2><ol><li>The leaders of the Ministry of National Defense attended the ceremony with the following comrades: General Phan Van Giang, Politburo member, Deputy Secretary of the Central Military Commission, Minister of National Defense; Senior Lieutenant General Trinh Van Quyet, Secretary of the Party Central Committee, Standing Member of the Central Military Commission, Director of the General Department of Politics of the Vietnam People\'s Army (VPA); General Nguyen Tan Cuong, Party Central Committee member, Standing Member of the Central Military Commission, Chief of the General Staff of the Vietnam People\'s Army, Deputy Minister of National Defense; leaders and former leaders of the Ministry of National Defense. The ceremony was attended by leaders and former leaders of the Party and State; leaders of central ministries and branches; leaders of localities; veteran revolutionaries, Heroic Vietnamese Mothers, Heroes of the People\'s Armed Forces, Heroes of Labor, generals of the Army and Public Security; representatives of war veterans, former People\'s Public Security, former youth volunteers, former frontline workers, and forces participating in the Ho Chi Minh Campaign; representatives of martyrs\' relatives, families with meritorious services to the country, and many people from all walks of life.</li></ol><figure class=\"image\"><img src=\"/PTIT_SHOP/quantri/upload/Screenshot 2025-05-11 012503.png\"></figure><p>&nbsp;</p><blockquote><p>The ceremony was attended by leaders and former leaders of the Party and State; leaders of central ministries and branches; leaders of localities; veteran revolutionaries, Heroic Vietnamese Mothers, Heroes of the People\'s Armed Forces, Heroes of Labor, generals of the Army and Public Security; representatives of war veterans, former People\'s Public Security, former youth volunteers, former frontline workers, and forces participating in the Ho Chi Minh Campaign; representatives of martyrs\' relatives, families with meritorious services to the country, and many people from all walks of life.', 1, '2025-05-11 02:07:48', '2025-05-11 02:27:10');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `newscategories`
--

CREATE TABLE `newscategories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `status` enum('Active','Innactive') NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `newscategories`
--

INSERT INTO `newscategories` (`id`, `name`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Danh muc A', 'danh-m-c-a', 'Active', NULL, NULL),
(3, 'Danh muc B', 'danh-m-c-b', 'Active', NULL, NULL),
(4, 'Danh muc C', 'danh-m-c-c', 'Active', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT 0,
  `name` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `status` enum('Processing','Confirmed','Shipping','Delivered','Cancelled') NOT NULL DEFAULT 'Processing',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `total_price` double NOT NULL,
  `tiensanpham` double NOT NULL,
  `phivanchuyen` double NOT NULL DEFAULT 0,
  `giamgia` double NOT NULL DEFAULT 0,
  `tiendachuyen` double NOT NULL,
  `transport` enum('Nhận tại cửa hàng','Vận Chuyển Thường','Vận Chuyển Hỏa Tốc') NOT NULL DEFAULT 'Nhận tại cửa hàng',
  `pay` enum('Thanh toán khi nhận hàng','Thanh Toán Online','Thanh toán vnpay') NOT NULL DEFAULT 'Thanh toán khi nhận hàng',
  `status_pay` enum('Đã thanh toán','Chưa thanh toán','Thanh toán thiếu','Thanh toán thừa') NOT NULL DEFAULT 'Chưa thanh toán'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `address`, `phone`, `email`, `status`, `created_at`, `updated_at`, `total_price`, `tiensanpham`, `phivanchuyen`, `giamgia`, `tiendachuyen`, `transport`, `pay`, `status_pay`) VALUES
(55, 1, 'Phạm Trong', '13 Hồ Tùng Mậu, Phường Mai Dịch, Quận Cầu Giấy, Thành phố Hà Nội', '0342561234', 'vantrongngo1607@gmail.com', 'Delivered', '2025-04-13 01:10:59', '2025-04-13 01:10:59', 3075000, 3070000, 25000, 20000, 0, 'Vận Chuyển Hỏa Tốc', 'Thanh toán khi nhận hàng', 'Chưa thanh toán'),
(59, 5, 'Hải Hàm Rồng', '22 Phố Quang Trung, Phường Hàm Rồng, Thành phố Thanh Hóa, Tỉnh Thanh Hóa', '0823542765', 'ngovantrong1308@gmail.com', 'Processing', '2025-04-14 06:59:22', '2025-04-14 06:59:22', 115000, 100000, 35000, 20000, 0, 'Vận Chuyển Hỏa Tốc', 'Thanh Toán Online', 'Chưa thanh toán'),
(60, 5, 'VinhLV', '13 Đường Giải Phóng, Phường Thanh Trì, Quận Hoàng Mai, Thành phố Hà Nội', '09', 'ngovantrong1308@gmail.com', 'Processing', '2025-04-16 08:26:26', '2025-04-16 08:26:26', 95000, 100000, 15000, 20000, 0, 'Vận Chuyển Thường', 'Thanh Toán Online', 'Chưa thanh toán'),
(61, 5, 'Hải Hàm Rồng', '22 Phố Quang Trung, Phường Hàm Rồng, Thành phố Thanh Hóa, Tỉnh Thanh Hóa', '0823542765', 'ngovantrong1308@gmail.com', 'Processing', '2025-04-16 08:29:42', '2025-04-16 08:29:42', 883888, 888888, 25000, 30000, 0, 'Vận Chuyển Thường', 'Thanh toán khi nhận hàng', 'Chưa thanh toán'),
(62, 5, 'Hải Hàm Rồng', '22 Phố Quang Trung, Phường Hàm Rồng, Thành phố Thanh Hóa, Tỉnh Thanh Hóa', '0823542765', 'ngovantrong1308@gmail.com', 'Processing', '2025-04-16 08:31:30', '2025-04-16 08:31:30', 66500, 35000, 35000, 3500, 0, 'Vận Chuyển Hỏa Tốc', 'Thanh toán khi nhận hàng', 'Chưa thanh toán'),
(63, 5, 'VinhLV', '13 Đường Giải Phóng, Phường Thanh Trì, Quận Hoàng Mai, Thành phố Hà Nội', '09', 'ngovantrong1308@gmail.com', 'Delivered', '2025-04-16 08:32:19', '2025-04-16 08:32:19', 524444, 1023888, 25000, 524444, 0, 'Vận Chuyển Hỏa Tốc', 'Thanh toán khi nhận hàng', 'Chưa thanh toán'),
(64, 1, 'Ngọ Văn Trọng', 'số nhà 22 Thôn Ngọ Hạ, Xã Thăng Bình, Huyện Nông Cống, Tỉnh Thanh Hóa', '0904708498', 'vantrongngo1607@gmail.com', 'Processing', '2025-04-17 07:03:44', '2025-04-17 07:03:44', 9270, 10300, 0, 1030, 9270, 'Nhận tại cửa hàng', 'Thanh Toán Online', 'Đã thanh toán'),
(65, 1, 'Ngọ Văn Trọng', 'số nhà 22 Thôn Ngọ Hạ, Xã Thăng Bình, Huyện Nông Cống, Tỉnh Thanh Hóa', '0904708498', 'vantrongngo1607@gmail.com', 'Processing', '2025-04-17 07:06:03', '2025-04-17 07:06:03', 33000, 28000, 25000, 20000, 5000, 'Vận Chuyển Thường', 'Thanh Toán Online', 'Thanh toán thiếu'),
(66, 1, 'Ngọ Văn Trọng', 'số nhà 22 Thôn Ngọ Hạ, Xã Thăng Bình, Huyện Nông Cống, Tỉnh Thanh Hóa', '0904708498', 'vantrongngo1607@gmail.com', 'Processing', '2025-04-24 02:38:11', '2025-04-24 02:38:11', 9000, 10000, 0, 1000, 0, 'Nhận tại cửa hàng', 'Thanh toán khi nhận hàng', 'Chưa thanh toán'),
(67, 1, 'Ngọ Văn Trọng', 'số nhà 22 Thôn Ngọ Hạ, Xã Thăng Bình, Huyện Nông Cống, Tỉnh Thanh Hóa', '0904708498', 'vantrongngo1607@gmail.com', 'Processing', '2025-04-24 02:38:37', '2025-04-24 02:38:37', -1000, 0, 0, 1000, 0, 'Nhận tại cửa hàng', 'Thanh Toán Online', 'Chưa thanh toán'),
(68, 1, 'Ngọ Văn Trọng', 'số nhà 22 Thôn Ngọ Hạ, Xã Thăng Bình, Huyện Nông Cống, Tỉnh Thanh Hóa', '0904708498', 'vantrongngo1607@gmail.com', 'Processing', '2025-04-24 02:39:49', '2025-04-24 02:39:49', -2000, 0, 0, 2000, 0, 'Nhận tại cửa hàng', 'Thanh Toán Online', 'Chưa thanh toán'),
(69, 1, 'Ngọ Văn Trọng', 'số nhà 22 Thôn Ngọ Hạ, Xã Thăng Bình, Huyện Nông Cống, Tỉnh Thanh Hóa', '0904708498', 'vantrongngo1607@gmail.com', 'Processing', '2025-04-24 02:51:21', '2025-04-24 02:51:21', 0, 0, 0, 0, 0, 'Nhận tại cửa hàng', 'Thanh toán khi nhận hàng', 'Chưa thanh toán'),
(70, 1, 'Ngọ Văn Trọng', 'số nhà 22 Thôn Ngọ Hạ, Xã Thăng Bình, Huyện Nông Cống, Tỉnh Thanh Hóa', '0904708498', 'vantrongngo1607@gmail.com', 'Processing', '2025-04-24 02:51:32', '2025-04-24 02:51:32', 0, 0, 0, 0, 0, 'Nhận tại cửa hàng', 'Thanh Toán Online', 'Chưa thanh toán'),
(71, 1, 'Ngọ Văn Trọng', 'số nhà 22 Thôn Ngọ Hạ, Xã Thăng Bình, Huyện Nông Cống, Tỉnh Thanh Hóa', '0904708498', 'vantrongngo1607@gmail.com', 'Processing', '2025-04-24 02:56:29', '2025-04-24 02:56:29', 45000, 20000, 25000, 0, 0, 'Vận Chuyển Thường', 'Thanh Toán Online', 'Chưa thanh toán'),
(72, 1, 'Ngọ Văn Trọng', 'số nhà 22 Thôn Ngọ Hạ, Xã Thăng Bình, Huyện Nông Cống, Tỉnh Thanh Hóa', '0904708498', 'vantrongngo1607@gmail.com', 'Processing', '2025-04-24 02:57:28', '2025-04-24 02:57:28', -1000, 0, 0, 1000, 0, 'Nhận tại cửa hàng', 'Thanh Toán Online', 'Chưa thanh toán'),
(73, 1, 'Ngọ Văn Trọng', 'số nhà 22 Thôn Ngọ Hạ, Xã Thăng Bình, Huyện Nông Cống, Tỉnh Thanh Hóa', '0904708498', 'vantrongngo1607@gmail.com', 'Processing', '2025-04-24 02:57:45', '2025-04-24 02:57:45', 31500, 10000, 25000, 3500, 0, 'Vận Chuyển Thường', 'Thanh Toán Online', 'Chưa thanh toán'),
(74, 1, 'Ngọ Văn Trọng', 'số nhà 22 Thôn Ngọ Hạ, Xã Thăng Bình, Huyện Nông Cống, Tỉnh Thanh Hóa', '0904708498', 'vantrongngo1607@gmail.com', 'Processing', '2025-04-24 02:57:55', '2025-04-24 02:57:55', 6500, 10000, 0, 3500, 0, 'Nhận tại cửa hàng', 'Thanh Toán Online', 'Chưa thanh toán'),
(75, 1, 'Ngọ Văn Trọng', 'số nhà 22 Thôn Ngọ Hạ, Xã Thăng Bình, Huyện Nông Cống, Tỉnh Thanh Hóa', '0904708498', 'vantrongngo1607@gmail.com', 'Processing', '2025-04-24 03:15:10', '2025-04-24 03:15:10', -2000, 0, 0, 2000, 0, 'Nhận tại cửa hàng', 'Thanh Toán Online', 'Chưa thanh toán'),
(76, 1, 'Ngọ Văn Trọng', 'số nhà 22 Thôn Ngọ Hạ, Xã Thăng Bình, Huyện Nông Cống, Tỉnh Thanh Hóa', '0904708498', 'vantrongngo1607@gmail.com', 'Processing', '2025-04-24 03:16:45', '2025-04-24 03:16:45', 131750, 155000, 0, 23250, 0, 'Nhận tại cửa hàng', 'Thanh Toán Online', 'Chưa thanh toán'),
(77, 1, 'Ngọ Văn Trọng', 'số nhà 22 Thôn Ngọ Hạ, Xã Thăng Bình, Huyện Nông Cống, Tỉnh Thanh Hóa', '0904708498', 'vantrongngo1607@gmail.com', 'Processing', '2025-04-24 03:24:16', '2025-04-24 03:24:16', -5000, 0, 0, 5000, 0, 'Nhận tại cửa hàng', 'Thanh Toán Online', 'Chưa thanh toán'),
(78, 1, 'Ngọ Văn Trọng', 'số nhà 22 Thôn Ngọ Hạ, Xã Thăng Bình, Huyện Nông Cống, Tỉnh Thanh Hóa', '0904708498', 'vantrongngo1607@gmail.com', 'Processing', '2025-04-24 03:49:56', '2025-04-24 03:49:56', -30000, 0, 0, 30000, 0, 'Nhận tại cửa hàng', 'Thanh Toán Online', 'Chưa thanh toán'),
(79, 1, 'Ngọ Văn Trọng', 'số nhà 22 Thôn Ngọ Hạ, Xã Thăng Bình, Huyện Nông Cống, Tỉnh Thanh Hóa', '0904708498', 'vantrongngo1607@gmail.com', 'Processing', '2025-04-24 03:50:30', '2025-04-24 03:50:30', 191250, 200000, 25000, 33750, 0, 'Vận Chuyển Thường', 'Thanh Toán Online', 'Chưa thanh toán'),
(80, 1, 'Ngọ Văn Trọng', 'số nhà 22 Thôn Ngọ Hạ, Xã Thăng Bình, Huyện Nông Cống, Tỉnh Thanh Hóa', '0904708498', 'vantrongngo1607@gmail.com', 'Processing', '2025-04-24 03:56:48', '2025-04-24 03:56:48', 170000, 200000, 0, 30000, 0, 'Nhận tại cửa hàng', 'Thanh Toán Online', 'Chưa thanh toán'),
(81, 1, 'Ngọ Văn Trọng', 'số nhà 22 Thôn Ngọ Hạ, Xã Thăng Bình, Huyện Nông Cống, Tỉnh Thanh Hóa', '0904708498', 'vantrongngo1607@gmail.com', 'Processing', '2025-04-24 12:27:12', '2025-04-24 12:27:12', -15500, 0, 0, 15500, 0, 'Nhận tại cửa hàng', 'Thanh Toán Online', 'Chưa thanh toán'),
(82, 1, 'Ngọ Văn Trọng', 'số nhà 22 Thôn Ngọ Hạ, Xã Thăng Bình, Huyện Nông Cống, Tỉnh Thanh Hóa', '0904708498', 'vantrongngo1607@gmail.com', 'Processing', '2025-04-24 12:27:55', '2025-04-24 12:27:55', 171000, 155000, 35000, 19000, 0, 'Vận Chuyển Hỏa Tốc', 'Thanh Toán Online', 'Chưa thanh toán'),
(83, 1, 'Ngọ Văn Trọng', 'số nhà 22 Thôn Ngọ Hạ, Xã Thăng Bình, Huyện Nông Cống, Tỉnh Thanh Hóa', '0904708498', 'vantrongngo1607@gmail.com', 'Delivered', '2025-04-24 12:29:43', '2025-04-24 12:29:43', 136000, 155000, 0, 19000, 0, 'Nhận tại cửa hàng', 'Thanh Toán Online', 'Chưa thanh toán'),
(84, 1, 'Ngọ Văn Trọng', 'số nhà 22 Thôn Ngọ Hạ, Xã Thăng Bình, Huyện Nông Cống, Tỉnh Thanh Hóa', '0904708498', 'vantrongngo1607@gmail.com', 'Cancelled', '2025-04-24 12:30:18', '2025-04-24 12:30:18', 139500, 155000, 0, 15500, 0, 'Nhận tại cửa hàng', 'Thanh Toán Online', 'Đã thanh toán'),
(85, 1, 'Ngọ Văn Trọng', 'số nhà 22 Thôn Ngọ Hạ, Xã Thăng Bình, Huyện Nông Cống, Tỉnh Thanh Hóa', '0904708498', 'vantrongngo1607@gmail.com', 'Processing', '2025-04-24 12:30:48', '2025-04-24 12:30:48', -20000, 0, 0, 20000, 0, 'Nhận tại cửa hàng', 'Thanh Toán Online', 'Chưa thanh toán'),
(86, 1, 'Ngọ Văn Trọng', 'số nhà 22 Thôn Ngọ Hạ, Xã Thăng Bình, Huyện Nông Cống, Tỉnh Thanh Hóa', '0904708498', 'vantrongngo1607@gmail.com', 'Delivered', '2025-04-24 12:49:17', '2025-04-24 12:49:17', 139500, 155000, 0, 15500, 0, 'Nhận tại cửa hàng', 'Thanh Toán Online', 'Chưa thanh toán'),
(87, 1, 'Ngọ Văn Trọng', 'số nhà 22 Thôn Ngọ Hạ, Xã Thăng Bình, Huyện Nông Cống, Tỉnh Thanh Hóa', '0904708498', 'vantrongngo1607@gmail.com', 'Delivered', '2025-05-06 12:50:46', '2025-05-07 12:50:46', 108000, 120000, 0, 12000, 0, 'Nhận tại cửa hàng', 'Thanh Toán Online', 'Chưa thanh toán'),
(88, 1, 'Ngọ Văn Trọng', 'số nhà 22 Thôn Ngọ Hạ, Xã Thăng Bình, Huyện Nông Cống, Tỉnh Thanh Hóa', '0904708498', 'vantrongngo1607@gmail.com', 'Delivered', '2025-04-24 12:52:43', '2025-04-24 12:52:43', 102000, 120000, 0, 18000, 0, 'Nhận tại cửa hàng', 'Thanh Toán Online', 'Chưa thanh toán'),
(89, 1, 'Ngọ Văn Trọng', 'số nhà 22 Thôn Ngọ Hạ, Xã Thăng Bình, Huyện Nông Cống, Tỉnh Thanh Hóa', '0904708498', 'vantrongngo1607@gmail.com', 'Delivered', '2025-04-22 14:08:47', '2025-04-24 14:08:47', 155000, 155000, 0, 0, 0, 'Nhận tại cửa hàng', 'Thanh toán khi nhận hàng', 'Chưa thanh toán'),
(90, 1, 'Ngọ Văn Trọng', 'số nhà 22 Thôn Ngọ Hạ, Xã Thăng Bình, Huyện Nông Cống, Tỉnh Thanh Hóa', '0904708498', 'vantrongngo1607@gmail.com', 'Cancelled', '2025-04-24 14:08:59', '2025-04-24 14:08:59', 75000, 75000, 0, 0, 0, 'Nhận tại cửa hàng', 'Thanh Toán Online', 'Chưa thanh toán');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_details`
--

CREATE TABLE `order_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `price` double NOT NULL,
  `qty` tinyint(4) NOT NULL,
  `total` double NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `price`, `qty`, `total`, `status`, `created_at`, `updated_at`) VALUES
(57, 55, 25, 1000000, 3, 3000000, 1, '2025-04-13 01:10:59', '2025-04-13 01:10:59'),
(58, 55, 20, 35000, 2, 70000, 1, '2025-04-13 01:10:59', '2025-04-13 01:10:59'),
(62, 59, 23, 100000, 1, 100000, 0, '2025-04-14 06:59:22', '2025-04-14 06:59:22'),
(63, 60, 23, 100000, 1, 100000, 0, '2025-04-16 08:26:26', '2025-04-16 08:26:26'),
(64, 61, 21, 888888, 1, 888888, 0, '2025-04-16 08:29:42', '2025-04-16 08:29:42'),
(65, 62, 20, 35000, 1, 35000, 0, '2025-04-16 08:31:30', '2025-04-16 08:31:30'),
(66, 63, 23, 100000, 1, 100000, 0, '2025-04-16 08:32:19', '2025-04-16 08:32:19'),
(67, 63, 21, 888888, 1, 888888, 0, '2025-04-16 08:32:19', '2025-04-16 08:32:19'),
(68, 63, 20, 35000, 1, 35000, 0, '2025-04-16 08:32:19', '2025-04-16 08:32:19'),
(69, 64, 30, 300, 1, 300, 0, '2025-04-17 07:03:44', '2025-04-17 07:03:44'),
(70, 64, 13, 5000, 2, 10000, 0, '2025-04-17 07:03:44', '2025-04-17 07:03:44'),
(71, 65, 15, 28000, 1, 28000, 0, '2025-04-17 07:06:03', '2025-04-17 07:06:03'),
(72, 66, 13, 5000, 2, 10000, 0, '2025-04-24 02:38:11', '2025-04-24 02:38:11'),
(73, 67, 13, 5000, 2, 10000, 0, '2025-04-24 02:38:37', '2025-04-24 02:38:37'),
(74, 68, 13, 5000, 4, 20000, 0, '2025-04-24 02:39:49', '2025-04-24 02:39:49'),
(75, 69, 13, 5000, 4, 20000, 0, '2025-04-24 02:51:21', '2025-04-24 02:51:21'),
(76, 70, 13, 5000, 4, 20000, 0, '2025-04-24 02:51:32', '2025-04-24 02:51:32'),
(77, 71, 13, 5000, 4, 20000, 0, '2025-04-24 02:56:29', '2025-04-24 02:56:29'),
(78, 72, 13, 5000, 2, 10000, 0, '2025-04-24 02:57:28', '2025-04-24 02:57:28'),
(79, 75, 13, 5000, 4, 20000, 0, '2025-04-24 03:15:10', '2025-04-24 03:15:10'),
(80, 76, 13, 5000, 31, 155000, 0, '2025-04-24 03:16:45', '2025-04-24 03:16:45'),
(81, 77, 13, 5000, 10, 50000, 0, '2025-04-24 03:24:16', '2025-04-24 03:24:16'),
(82, 78, 23, 100000, 2, 200000, 0, '2025-04-24 03:49:56', '2025-04-24 03:49:56'),
(83, 81, 27, 75000, 1, 75000, 0, '2025-04-24 12:27:12', '2025-04-24 12:27:12'),
(84, 81, 24, 80000, 1, 80000, 0, '2025-04-24 12:27:12', '2025-04-24 12:27:12'),
(85, 82, 27, 75000, 1, 75000, 0, '2025-04-24 12:27:55', '2025-04-24 12:27:55'),
(86, 82, 24, 80000, 1, 80000, 0, '2025-04-24 12:27:55', '2025-04-24 12:27:55'),
(87, 83, 27, 75000, 1, 75000, 1, '2025-04-24 12:29:43', '2025-04-24 12:29:43'),
(88, 83, 24, 80000, 1, 80000, 1, '2025-04-24 12:29:43', '2025-04-24 12:29:43'),
(89, 84, 27, 75000, 1, 75000, 0, '2025-04-24 12:30:18', '2025-04-24 12:30:18'),
(90, 84, 24, 80000, 1, 80000, 0, '2025-04-24 12:30:18', '2025-04-24 12:30:18'),
(91, 85, 27, 75000, 1, 75000, 0, '2025-04-24 12:30:48', '2025-04-24 12:30:48'),
(92, 85, 24, 80000, 1, 80000, 0, '2025-04-24 12:30:48', '2025-04-24 12:30:48'),
(93, 86, 27, 75000, 1, 75000, 1, '2025-04-24 12:49:17', '2025-04-24 12:49:17'),
(94, 86, 24, 80000, 1, 80000, 1, '2025-04-24 12:49:17', '2025-04-24 12:49:17'),
(95, 87, 28, 120000, 1, 120000, 1, '2025-04-24 12:50:46', '2025-04-24 12:50:46'),
(96, 88, 28, 120000, 1, 120000, 1, '2025-04-24 12:52:43', '2025-04-24 12:52:43'),
(97, 89, 27, 75000, 1, 75000, 1, '2025-04-24 14:08:48', '2025-04-24 14:08:48'),
(98, 89, 24, 80000, 1, 80000, 1, '2025-04-24 14:08:48', '2025-04-24 14:08:48'),
(99, 90, 27, 75000, 1, 75000, 0, '2025-04-24 14:08:59', '2025-04-24 14:08:59');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_requests`
--

CREATE TABLE `order_requests` (
  `id` bigint(20) NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `type` enum('cancel','return','exchange') NOT NULL,
  `reason` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `order_requests`
--

INSERT INTO `order_requests` (`id`, `order_id`, `type`, `reason`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 89, 'cancel', 'khong co nhu cau', NULL, 'rejected', '2025-05-10 02:06:15', '2025-05-10 10:39:44'),
(2, 87, 'return', 'ao rach', 'uploads/requests/req_681f8d9194118.png', 'approved', '2025-05-11 00:32:01', '2025-05-11 00:37:03');

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
(15, 'Quần bò ống suông', 'qu-n-b-ng-su-ng', '', '', 254, 'kí', 30000, 28000, 'uploads/67bb8658b18b0bo.jpg', 4, 5, 'Active', NULL, NULL),
(16, 'Áo gió mỏng', '-o-gi-m-ng', '', '', 255, 'kí', 129999, 99000, 'uploads/67bb863b411f2gio.jpg', 6, 5, 'Active', NULL, NULL),
(17, 'Áo sơ mi PTIT', '-o-s-mi-ptit', '', '', 255, 'kí', 129000, 12000, 'uploads/67bb86cc90081c4.jpg', 1, 5, 'Active', NULL, NULL),
(18, 'Áo sơ mi vải lụa ', '-o-s-mi-v-i-l-a-', '', '', 255, 'kí', 87000, 80000, 'uploads/67bb86aa5625fquanau.jpg', 1, 5, 'Active', NULL, NULL),
(19, 'Áo Phao Dày dặn ', '-o-phao-d-y-d-n-', '', '', 255, 'kí', 90000, 80000, 'uploads/67bb8804339bdgio.jpg', 6, 5, 'Active', NULL, NULL),
(20, 'Quản tây lịch lãm ống rộng', 'qu-n-t-y-l-ch-l-m-ng-r-ng', '', '', 253, 'túi', 90000, 35000, 'uploads/67bb8827474b5quanau.jpg', 2, 5, 'Active', NULL, NULL),
(21, 'Áo Hoodie lông chuột ấm áp', '-o-hoodie-l-ng-chu-t-m-p', '', '', 254, 'lon', 8888888, 888888, 'uploads/67bb885047899hodi.jpg', 9, 5, 'Active', NULL, NULL),
(22, 'Áo Polo Bưu Chính', '-o-polo-b-u-ch-nh', '', '', 255, 'lít', 999999, 90000, 'uploads/67bb87c2d96bbpolo.jpg', 3, 5, 'Active', NULL, NULL),
(23, 'Áo Varsity Bưu Chính', '-o-varsity-b-u-ch-nh', '', '', 252, 'lít', 120000, 100000, 'uploads/67bb87e5653a3c3.jpg', 5, 5, 'Active', NULL, NULL),
(24, 'Quần jean Nam Nữ', 'qu-n-jean-nam-n-', '', '\r\n                                                ', 248, 'lạng', 90000, 80000, 'uploads/67bb860d57fc5bo.jpg', 4, 5, 'Active', NULL, NULL),
(25, 'Áo Bomber PTIT', '-o-bomber-ptit', '                                                ', '                                                ', 200, 'kí', 1200000, 1000000, 'uploads/67bb877e5a7c5c2.jpg', 5, 5, 'Active', NULL, NULL),
(26, 'Áo Hoodie Form rộng', '-o-hoodie-form-r-ng', '', '', 255, 'kí', 9999999, 8000000, 'uploads/67bb875ddfd12hodi.jpg', 9, 5, 'Active', NULL, NULL),
(27, 'Quần bò ống loe', 'qu-n-b-ng-loe', '\r\n                                                ', '', 247, 'kí', 80000, 75000, 'uploads/67bb87248d049bo.jpg', 4, 5, 'Active', NULL, NULL),
(28, 'Áo Jacket PTIT', '-o-jacket-ptit', '', '', 253, 'kí', 125000, 120000, 'uploads/67bb86fe106a0c1.jpg', 5, 5, 'Active', NULL, NULL),
(29, 'Áo Polo PTIT', '-o-polo-ptit', '', '', 255, 'kí', 99999, 99900, 'uploads/67bb8626e8fa9polo.jpg', 3, 5, 'Active', NULL, NULL),
(30, 'Quần Âu form Regular', 'qu-n-u-form-regular', '', '', 2, 'kí', 300, 300, 'uploads/67bb87a345754quanau.jpg', 2, 5, 'Active', NULL, NULL),
(31, 'áo AI PTIT', '-o-ai-ptit', '                        Áo unisex dành cho cả nam và nữ                        ', '                        Áo Polo khoa Trí tuệ nhân tạo PTIT                        ', 100, NULL, 250000, 210000, 'uploads/67fd428501345_AI_Logo.png', 3, 5, 'Active', NULL, NULL),
(32, 'Áo đôi tình nhân', '-o-i-t-nh-nh-n', 'Áo T--Shirt cọc tay unisex', 'Áo đôi cho các cặp nam nữ mặc đi biển', 250, NULL, 300000, 230000, 'uploads/67fd45d12fc0c_logoptit2.png', 1, 10, 'Active', NULL, NULL),
(33, 'Test', 'test', '<h2><i><strong>Thông số kỹ thuật</strong></i></h2><ol><li><strong>Chiều dài: 20cm</strong></li><li><strong>Chiều rộng: 40cm</strong></li></ol><figure class=\"image\"><img src=\"/PTIT_SHOP/quantri/upload/hd2.jpg\"></figure>', '', 255, NULL, 250000, 200000, 'uploads/681c966e32981_AI_Chalange.jpg', 4, 5, 'Active', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_details`
--

CREATE TABLE `product_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `size` varchar(20) DEFAULT NULL,
  `color` varchar(30) DEFAULT NULL,
  `price` double NOT NULL,
  `stock` int(10) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_detail_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `rating` tinyint(1) NOT NULL,
  `comment` mediumtext NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `reviews`
--

INSERT INTO `reviews` (`id`, `order_detail_id`, `user_id`, `product_id`, `rating`, `comment`, `image`, `created_at`, `updated_at`) VALUES
(4, 97, 1, 27, 4, 'dep qua', 'uploads/reviews/rev_681f6e8b2d8ff.jpg', '2025-05-09 23:47:13', '2025-05-10 08:19:39'),
(5, 98, 1, 24, 5, 'tuyet voi', 'uploads/reviews/rev_681f6bf0d324f.jpg', '2025-05-10 01:57:28', '2025-05-10 08:08:32'),
(6, 96, 1, 28, 3, 'hoi do', 'uploads/reviews/rev_681f753a26ceb.jpg', '2025-05-10 08:48:10', '2025-05-10 08:48:10'),
(7, 95, 1, 28, 5, 'cung dep day', 'uploads/reviews/rev_681f7552ec2ab.jpg', '2025-05-10 08:48:34', '2025-05-10 08:48:34'),
(8, 57, 1, 25, 5, 'dep tuyet', 'uploads/reviews/rev_681f75ef9c2da.png', '2025-05-10 08:51:11', '2025-05-10 08:51:11'),
(9, 58, 1, 20, 4, 'tam thoi', 'uploads/reviews/rev_681f762112c45.png', '2025-05-10 08:52:01', '2025-05-10 08:52:01'),
(10, 93, 1, 27, 1, 'qua te', 'uploads/reviews/rev_681f76a5db0bc.png', '2025-05-10 08:54:13', '2025-05-10 08:54:13'),
(11, 94, 1, 24, 3, 'táº¡m', 'uploads/reviews/rev_681f76c4ed9d1.png', '2025-05-10 08:54:44', '2025-05-10 08:54:44'),
(12, 87, 1, 27, 5, 'oke qua tot', 'uploads/reviews/rev_681f76e870329.png', '2025-05-10 08:55:20', '2025-05-10 08:55:20'),
(13, 88, 1, 24, 4, 'binh thuong', 'uploads/reviews/rev_681f770f311dc.png', '2025-05-10 08:55:59', '2025-05-10 08:55:59');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thongtinnhanhang`
--

CREATE TABLE `thongtinnhanhang` (
  `id` int(11) NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `tennguoinhan` varchar(100) NOT NULL,
  `sodienthoai` varchar(20) NOT NULL,
  `diachi` varchar(255) NOT NULL,
  `xa` varchar(100) NOT NULL,
  `huyen` varchar(100) NOT NULL,
  `tinh` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `thongtinnhanhang`
--

INSERT INTO `thongtinnhanhang` (`id`, `id_user`, `tennguoinhan`, `sodienthoai`, `diachi`, `xa`, `huyen`, `tinh`) VALUES
(3, 1, 'Ngọ Văn Trọng', '0904708498', 'số nhà 22 Thôn Ngọ Hạ', 'Xã Thăng Bình', 'Huyện Nông Cống', 'Tỉnh Thanh Hóa'),
(7, 5, 'Hải Hàm Rồng', '0823542765', '22 Phố Quang Trung', 'Phường Hàm Rồng', 'Thành phố Thanh Hóa', 'Tỉnh Thanh Hóa'),
(8, 5, 'VinhLV', '09', '13 Đường Giải Phóng', 'Phường Thanh Trì', 'Quận Hoàng Mai', 'Thành phố Hà Nội');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `address` text NOT NULL,
  `avatar` varchar(255) DEFAULT 'img/icon-account.png',
  `activation_code` varchar(255) DEFAULT NULL,
  `status` enum('Active','Inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `phone`, `address`, `avatar`, `activation_code`, `status`) VALUES
(1, 'Ngọ Văn Trọng', 'vantrongngo1607@gmail.com', '123', '0352987324', 'Số nhà 22 Thôn Ngọ Hạ, Thăng Bình, Nông Cống, Thanh Hóa', 'avt/anhthe.jpg', NULL, 'Active'),
(2, 'Nguyễn Hoàng Hải', 'hainh123@gmail.com', '123', '0352987645', '21 Quang Trung, Thành Phố TH, Tỉnh Thanh Hóa', 'img/icon-account.png', NULL, 'Active'),
(3, 'Phạm Thị Nga', 'ngapt@gmail.com', '123', '0352987324', 'Thôn Ngọ Hạ, Thăng Bình Nông Cống Thanh Hóa', 'img/icon-account.png', NULL, 'Active'),
(4, 'Tạ Kiều Yến', 'tkyen@gmail.com', '123', '0234567123', 'Hà Đông, Hà Nội', 'avt/meomeo.jpg', NULL, 'Active'),
(5, 'Trong ngo', 'ngovantrong1308@gmail.com', '123', '0987654321', 'Thanh Hóa', 'img/icon-account.png', NULL, 'Active'),
(6, 'Phạm Nga', 'TrongNV.B21CN726@stu.ptit.edu.vn', '123', '0876543123', 'Thanh', 'img/icon-account.png', '8b6b054282542a527c3e669ccc2cac13', 'Inactive'),
(7, 'trọng2808', 'vantrongngo2808@gmail.com', '123', '0987345123', 'Thanh', 'img/icon-account.png', '01af1456b69da869e2f743dec78a950e', 'Inactive');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Chỉ mục cho bảng `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `brands_slug_unique` (`slug`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Chỉ mục cho bảng `magiamgia`
--
ALTER TABLE `magiamgia`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Chỉ mục cho bảng `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `newscategories`
--
ALTER TABLE `newscategories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Chỉ mục cho bảng `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_details_order_id_foreign` (`order_id`),
  ADD KEY `order_details_product_id_foreign` (`product_id`);

--
-- Chỉ mục cho bảng `order_requests`
--
ALTER TABLE `order_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_brand_id_foreign` (`brand_id`);

--
-- Chỉ mục cho bảng `product_details`
--
ALTER TABLE `product_details`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ux_prod_size_color` (`product_id`,`size`,`color`);

--
-- Chỉ mục cho bảng `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_order_detail` (`order_detail_id`),
  ADD KEY `idx_user` (`user_id`),
  ADD KEY `idx_product` (`product_id`);

--
-- Chỉ mục cho bảng `thongtinnhanhang`
--
ALTER TABLE `thongtinnhanhang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `banner`
--
ALTER TABLE `banner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `magiamgia`
--
ALTER TABLE `magiamgia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `news`
--
ALTER TABLE `news`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT cho bảng `newscategories`
--
ALTER TABLE `newscategories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT cho bảng `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT cho bảng `order_requests`
--
ALTER TABLE `order_requests`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT cho bảng `product_details`
--
ALTER TABLE `product_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `thongtinnhanhang`
--
ALTER TABLE `thongtinnhanhang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Các ràng buộc cho bảng `order_requests`
--
ALTER TABLE `order_requests`
  ADD CONSTRAINT `order_requests_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`);

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`),
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Các ràng buộc cho bảng `product_details`
--
ALTER TABLE `product_details`
  ADD CONSTRAINT `product_details_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `fk_reviews_order_detail` FOREIGN KEY (`order_detail_id`) REFERENCES `order_details` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_reviews_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_reviews_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `thongtinnhanhang`
--
ALTER TABLE `thongtinnhanhang`
  ADD CONSTRAINT `thongtinnhanhang_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
