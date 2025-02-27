-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th2 27, 2025 lúc 02:14 PM
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
(1, 'Ngọ Văn Trọng', 'ngovantrong1308@gmail.com', '2025-02-13 05:02:40', '123', '0904708498', 'Thanh Hóa', 'Active', 'Admin'),
(2, 'Nguyễn Hoàng Hải', 'nhhai@gmail.com', '2025-02-15 05:02:40', '123', '0909090909', 'Thanh Hóa', 'Active', 'Admin'),
(3, 'Tạ Kiều Yến', 'tkyen@gmail.com', '2025-02-15 05:02:40', '123', '0879675765', 'Hà Nội', 'Active', 'Admin');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `brands`
--

INSERT INTO `brands` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Jbaggy', 'Active', NULL, NULL),
(3, 'Bitis Hunter', 'Active', NULL, NULL),
(4, 'Nike', 'Active', NULL, NULL),
(5, 'PTIT', 'Active', NULL, NULL),
(10, 'Clothing', 'Active', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `img` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `name`, `img`) VALUES
(1, 'Áo Sơ Mi', 'img/categories/somi.jpg'),
(2, 'Quần Tây - Kaki', 'img/categories/quanau.jpg'),
(3, 'Áo Polo', 'img/categories/polo.jpg'),
(4, 'Quần Jeans', 'img/categories/bo.jpg'),
(5, 'Áo Jacket - Bomber - Varsity', 'img/categories/c2.jpg'),
(6, 'Áo Gió - Phao', 'img/categories/gio.jpg'),
(9, 'Áo Hoodie', 'img/categories/hodi.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_10_03_123426_create_admins_table', 1),
(6, '2023_10_03_130747_create_categories_table', 2),
(7, '2023_10_03_130946_create_brands_table', 2),
(8, '2023_10_03_132635_create_products_table', 3),
(9, '2023_10_03_135606_create_reviews_table', 4),
(10, '2023_10_04_080710_create_orders_table', 5),
(11, '2023_10_04_081411_create_order_details_table', 6);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `news`
--

CREATE TABLE `news` (
  `id` bigint(20) NOT NULL,
  `title` varchar(100) NOT NULL,
  `avatar` varchar(200) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `sumary` text NOT NULL,
  `description` text NOT NULL,
  `newscategory_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `news`
--

INSERT INTO `news` (`id`, `title`, `avatar`, `slug`, `sumary`, `description`, `newscategory_id`, `created_at`, `updated_at`) VALUES
(6, 'Thông báo chương trình khuyến mãi tháng 1', 'uploads/news/67bb80d1e58f3THONGBAO.jpg', 'th-ng-b-o-ch-ng-tr-nh-khuy-n-m-i-th-ng-1', 'Khuyến mãi 10% mặt hàng quần Jean\r\n                                                                                                                                                ', '                                                Thông báo chương trình khuyến mãi\r\n                                                                                                                                                ', 1, '2025-02-24 03:44:10', '2025-02-24 03:56:20'),
(7, 'Thông báo chương trình khuyến mãi tháng 2', 'uploads/news/67bb80e2e5c2eTHONGBAO.jpg', 'th-ng-b-o-ch-ng-tr-nh-khuy-n-m-i-th-ng-2', 'Khuyến mãi 20% thời trang Áo Jacket-Bomber-Varsity', '                        Thông báo chương trình khuyến mãi\r\n                                                                                                ', 3, '2025-02-24 03:44:10', '2025-02-24 03:57:10'),
(8, 'Thông báo chương trình khuyến mãi tháng 3', 'uploads/news/67bb80efd536fTHONGBAO.jpg', 'th-ng-b-o-ch-ng-tr-nh-khuy-n-m-i-th-ng-3', 'Khuyến mãi 15% khi mua combo 2 áo SƠ MI trở lên\r\n                                                                                                                        ', '                        Thông báo chương trình khuyến mãi\r\n                                                                                                                        ', 4, '2025-02-24 03:44:10', '2025-02-24 03:57:55'),
(9, 'Thông báo chương trình khuyến mãi', 'uploads/news/67bb80f7e0109THONGBAO.jpg', 'th-ng-b-o-ch-ng-tr-nh-khuy-n-m-i', 'Thông báo chương trình khuyến mãi\r\n                                                                        ', 'Thông báo chương trình khuyến mãi', 3, '2025-02-24 03:44:10', '2025-02-24 03:44:39'),
(10, 'Thông báo chương trình khuyến mãi', 'uploads/news/67bb81001bf8eTHONGBAO.jpg', 'th-ng-b-o-ch-ng-tr-nh-khuy-n-m-i', 'Thông báo chương trình khuyến mãi\r\n                                                                        ', 'Thông báo chương trình khuyến mãi\r\n                                                                        ', 1, '2025-02-24 03:44:10', '2025-02-24 03:44:49'),
(11, 'Thông báo chương trình khuyến mãi', 'uploads/news/67bb810889a04THONGBAO.jpg', 'th-ng-b-o-ch-ng-tr-nh-khuy-n-m-i', 'Thông báo chương trình khuyến mãi', 'Thông báo chương trình khuyến mãi', 4, '2025-02-24 03:44:10', '2025-02-24 03:45:01'),
(12, 'Thông báo chương trình khuyến mãi', 'uploads/news/67bb8110b2387THONGBAO.jpg', 'th-ng-b-o-ch-ng-tr-nh-khuy-n-m-i', 'Thông báo chương trình khuyến mãi', 'Thông báo chương trình khuyến mãi', 3, '2025-02-24 03:44:10', '2025-02-24 03:45:12');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `newscategories`
--

CREATE TABLE `newscategories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` enum('Active','Innactive') NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `newscategories`
--

INSERT INTO `newscategories` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Danh mục A', 'Active', NULL, NULL),
(3, 'Danh mục B', 'Active', NULL, NULL),
(4, 'Danh mục C', 'Active', NULL, NULL);

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
  `transport` enum('Vận Chuyển Thường','Vận Chuyển Hỏa Tốc','Nhận tại cửa hàng') NOT NULL DEFAULT 'Vận Chuyển Thường',
  `pay` enum('Thanh toán khi nhận hàng','Thanh Toán Online') NOT NULL DEFAULT 'Thanh toán khi nhận hàng',
  `status_pay` enum('Đã thanh toán','Chưa thanh toán') NOT NULL DEFAULT 'Chưa thanh toán'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `address`, `phone`, `email`, `status`, `created_at`, `updated_at`, `total_price`, `transport`, `pay`, `status_pay`) VALUES
(12, 0, 'Trong', '22, thôn Ngọ Hạ, huyện Nông Cống, tỉnh Thanh Hóa', '0904708498', 'ngovantrong1308@gmail.com', 'Confirmed', '2025-02-22 17:29:40', '2025-02-22 17:29:40', 8000000, 'Vận Chuyển Thường', 'Thanh toán khi nhận hàng', 'Chưa thanh toán'),
(13, 0, 'Hải', '21 Quang Trung, Thành Phố TH, Tỉnh Thanh Hóa', '0354678901', 'hainh123@gmail.com', 'Shipping', '2025-02-22 21:10:15', '2025-02-22 21:10:15', 330000, 'Vận Chuyển Thường', 'Thanh toán khi nhận hàng', 'Chưa thanh toán'),
(14, 1, 'Ngọ Văn Trọng', '22 Thôn Ngọ Hạ ,Thăng Bình, Nông Cống ,Thanh Hóa', '0352987324', 'vantrongngo1607@gmail.com', 'Processing', '2025-02-23 07:01:23', '2025-02-23 07:01:23', 160000, 'Vận Chuyển Thường', 'Thanh toán khi nhận hàng', 'Chưa thanh toán'),
(15, 1, 'Ngọ Văn Trọng', '22 Thôn Ngọ Hạ ,Thăng Bình, Nông Cống ,Thanh Hóa', '0352987324', 'vantrongngo1607@gmail.com', 'Confirmed', '2025-02-23 07:13:03', '2025-02-23 07:13:03', 198000, 'Vận Chuyển Thường', 'Thanh toán khi nhận hàng', 'Chưa thanh toán'),
(16, 1, 'Ngọ Văn Trọng', 'Thăng Bình, Nông Cống ,Thanh Hóa', '0352987324', 'vantrongngo1607@gmail.com', 'Confirmed', '2025-02-23 08:48:40', '2025-02-23 08:48:40', 180000, 'Vận Chuyển Thường', 'Thanh toán khi nhận hàng', 'Chưa thanh toán'),
(17, 1, 'Ngọ Văn Trọng', 'Số nhà 24 Thôn Ngọ Hạ, Thăng Bình, Nông Cống, Thanh Hóa', '0352987324', 'vantrongngo1607@gmail.com', 'Confirmed', '2025-02-23 19:30:22', '2025-02-23 19:30:22', 900, 'Vận Chuyển Thường', 'Thanh toán khi nhận hàng', 'Chưa thanh toán'),
(18, 1, 'Phạm Thị Nga', 'Số nhà 22 Thôn Ngọ Hạ, Thăng Bình, Nông Cống, Thanh Hóa', '090708498', 'vantrongngo1607@gmail.com', 'Processing', '2025-02-24 18:23:47', '2025-02-24 18:23:47', 200000, 'Vận Chuyển Thường', 'Thanh toán khi nhận hàng', 'Chưa thanh toán');

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `price`, `qty`, `total`, `created_at`, `updated_at`) VALUES
(7, 12, 26, 8000000, 1, 8000000, '2025-02-22 17:29:40', '2025-02-22 17:29:40'),
(8, 13, 30, 300, 100, 30000, '2025-02-22 21:10:15', '2025-02-22 21:10:15'),
(9, 13, 12, 30000, 10, 300000, '2025-02-22 21:10:15', '2025-02-22 21:10:15'),
(10, 14, 24, 80000, 2, 160000, '2025-02-23 07:01:23', '2025-02-23 07:01:23'),
(11, 15, 16, 99000, 2, 198000, '2025-02-23 07:13:03', '2025-02-23 07:13:03'),
(12, 16, 13, 45000, 4, 180000, '2025-02-23 08:48:40', '2025-02-23 08:48:40'),
(13, 17, 30, 300, 3, 900, '2025-02-23 19:30:22', '2025-02-23 19:30:22'),
(14, 18, 23, 100000, 2, 200000, '2025-02-24 18:23:47', '2025-02-24 18:23:47');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `summary` text NOT NULL,
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

INSERT INTO `products` (`id`, `name`, `description`, `summary`, `stock`, `unit`, `price`, `disscounted_price`, `images`, `category_id`, `brand_id`, `status`, `created_at`, `updated_at`) VALUES
(12, 'Áo sơ mi trắng', 'Chất liệu: Cotton 100%\r\nSize: 31-32-33\r\nCân nặng phù hợp: 55 - 60 - 65 kg\r\nChiều cao: 1m60 - 1m65 - 1m70\r\n', '    Áo sơ mi trắng dài tay cổ cao chất liệu mềm mịn, thoáng mát', 255, 'chục', 35000, 30000, 'uploads/67bb82d37f45b.jpg;uploads/67bb82d380827.jpg;uploads/67bb82d381018.jpg', 1, 5, 'Active', NULL, NULL),
(13, 'Áo Sơ mi kẻ sọc cộc tay', 'Chất liệu : Cotton 50%, Lụa 50%\r\nSize: 35-36-37', 'Áo Sơ mi kẻ sọc cộc tay chất liệu thoáng mát', 255, 'kí', 50000, 45000, 'uploads/67bb8556e34d6coctay.jpg', 1, 5, 'Active', NULL, NULL),
(14, 'Áo Sơ mi', 'Chất liệu Thư giãn', 'Áo sơ mi thoáng mát dành cho nam và nữ đều mặc được', 255, 'kí', 60000, 50000, 'uploads/67bb85dca3401somi.jpg', 1, 5, 'Active', NULL, NULL),
(15, 'Quần bò ống suông', '', '', 255, 'kí', 30000, 28000, 'uploads/67bb8658b18b0bo.jpg', 4, 5, 'Active', NULL, NULL),
(16, 'Áo gió mỏng', '', '', 255, 'kí', 129999, 99000, 'uploads/67bb863b411f2gio.jpg', 6, 5, 'Active', NULL, NULL),
(17, 'Áo sơ mi PTIT', '', '', 255, 'kí', 129000, 12000, 'uploads/67bb86cc90081c4.jpg', 1, 5, 'Active', NULL, NULL),
(18, 'Áo sơ mi vải lụa ', '                        Đường Phèn Quảng Ngãi - Hương Vị Độc Đáo từ Miền Trung\r\n\r\nMiền Trung Việt Nam nổi tiếng với văn hóa ẩm thực đa dạng và độc đáo. \"Đường Phèn Quảng Ngãi\" là một món đặc sản truyền thống từ vùng đất Quảng Ngãi, nổi bật với hương vị độc đáo và giá trị lịch sử.\r\n\r\nĐặc Điểm Của Đường Phèn Quảng Ngãi:\r\n\r\n    Nguyên Liệu Chất Lượng: Đường Phèn Quảng Ngãi được sản xuất từ mía tươi, đường và nước cốt nước mía. Sự tươi mát và chất lượng của nguyên liệu là một trong những yếu tố quan trọng tạo nên hương vị đặc biệt của sản phẩm.\r\n\r\n    Cách Chế Biến Truyền Thống: Sản phẩm này thường được sản xuất bằng phương pháp thủ công truyền thống. Quá trình nấu đường phèn đòi hỏi sự khéo léo và kỹ thuật của người làm đường, đảm bảo hương vị và chất lượng tốt nhất.\r\n\r\n    Hương Vị Đặc Biệt: Đường Phèn Quảng Ngãi có hương vị độc đáo với vị ngọt tự nhiên từ đường và nước mía. Sự kết hợp này tạo nên một hương vị đặc biệt, không giống bất kỳ sản phẩm đường nào khác.\r\n\r\n    Sử Dụng Đa Dạng: Đường Phèn Quảng Ngãi có thể được sử dụng trong nhiều món ăn và đồ uống như trà, café, bánh ngọt, và nhiều món ăn khác. Sự đa dạng này tạo ra nhiều cơ hội để thưởng thức hương vị đặc biệt của đường phèn.\r\n\r\n    Giá Trị Lịch Sử và Văn Hóa: Đường Phèn Quảng Ngãi không chỉ là một sản phẩm ẩm thực mà còn có giá trị lịch sử và văn hóa lớn. Nó đã tồn tại và được sản xuất theo cách truyền thống trong nhiều thế hệ và là một phần không thể thiếu của văn hóa ẩm thực của Quảng Ngãi.\r\n\r\nThưởng Thức Đường Phèn Quảng Ngãi:\r\n\r\nĐường Phèn Quảng Ngãi là một sản phẩm đặc biệt và độc đáo của vùng đất Trung Việt. Hương vị đặc biệt và giá trị lịch sử của sản phẩm này làm cho nó trở thành một phần không thể thiếu của ẩm thực và văn hóa ẩm thực Quảng Ngãi. Hãy thưởng thức hương vị ngọt ngào của Đường Phèn Quảng Ngãi và khám phá sự đặc biệt của sản phẩm này, một phần không thể thiếu của hậu quảng đại của miền Trung.\r\n                                                ', '                        Đường Phèn Quảng Ngãi là một món đặc sản truyền thống có hương vị độc đáo từ vùng đất Quảng Ngãi, miền Trung Việt Nam. Hãy khám phá sự đặc biệt và giá trị của sản phẩm này trong bài viết dưới đây.\r\n                                                ', 255, 'kí', 87000, 80000, 'uploads/67bb86aa5625fquanau.jpg', 1, 5, 'Active', NULL, NULL),
(19, 'Áo Phao Dày dặn ', '', '', 255, 'kí', 90000, 80000, 'uploads/67bb8804339bdgio.jpg', 6, 5, 'Active', NULL, NULL),
(20, 'Quản tây lịch lãm ống rộng', '', '', 255, 'túi', 90000, 35000, 'uploads/67bb8827474b5quanau.jpg', 2, 5, 'Active', NULL, NULL),
(21, 'Áo Hoodie lông chuột ấm áp', '                        Mạch nha là món ăn được làm nhiều tại huyện Mộ Đức, phía nam tỉnh Quảng Ngãi. Thích hợp ăn với bánh tráng vào những buổi trưa hay chiều. Ngoài ra mạch nha còn dùng làm nguyên liệu cho các thức ăn như ..\r\n                                                ', '                        Được làm từ lúa non, với vị ngọt và thơm của lúa, không làm từ đường\r\n                                                ', 255, 'lon', 8888888, 888888, 'uploads/67bb885047899hodi.jpg', 9, 5, 'Active', NULL, NULL),
(22, 'Áo Polo Bưu Chính', '', '', 255, 'lít', 999999, 90000, 'uploads/67bb87c2d96bbpolo.jpg', 3, 5, 'Active', NULL, NULL),
(23, 'Áo Varsity Bưu Chính', '', '', 255, 'lít', 120000, 100000, 'uploads/67bb87e5653a3c3.jpg', 5, 5, 'Active', NULL, NULL),
(24, 'Quần jean Nam Nữ', '', '\r\n                                                ', 255, 'lạng', 90000, 80000, 'uploads/67bb860d57fc5bo.jpg', 4, 5, 'Active', NULL, NULL),
(25, 'Áo Bomber PTIT', '', '', 255, 'kí', 1200000, 1000000, 'uploads/67bb877e5a7c5c2.jpg', 5, 5, 'Active', NULL, NULL),
(26, 'Áo Hoodie Form rộng', '', '', 255, 'kí', 9999999, 8000000, 'uploads/67bb875ddfd12hodi.jpg', 9, 5, 'Active', NULL, NULL),
(27, 'Quần bò ống loe', '\r\n                                                ', '', 255, 'kí', 80000, 75000, 'uploads/67bb87248d049bo.jpg', 4, 5, 'Active', NULL, NULL),
(28, 'Áo Jacket PTIT', '', '', 255, 'kí', 125000, 120000, 'uploads/67bb86fe106a0c1.jpg', 5, 5, 'Active', NULL, NULL),
(29, 'Áo Polo PTIT', '', '', 255, 'kí', 99999, 99900, 'uploads/67bb8626e8fa9polo.jpg', 3, 5, 'Active', NULL, NULL),
(30, 'Quần Âu form Regular', '', '', 3, 'kí', 300, 300, 'uploads/67bb87a345754quanau.jpg', 2, 5, 'Active', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `comment` text NOT NULL,
  `rating` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `product_id`, `comment`, `rating`, `created_at`, `updated_at`) VALUES
(1, 1, 20, 'quần đẹp, vừa form', 5, '2025-02-27 04:45:09', NULL),
(2, 2, 25, 'đúng áo của học viên hoàng gia có khác, mặc vào như vua', 4, '2025-02-26 04:48:00', NULL),
(3, 3, 25, 'áo đẹp, không mỏng cũng k quá dày, form vừa vặn', 5, '2025-02-25 04:49:05', NULL),
(4, 1, 25, 'không còn gì để bàn cãi, đúng chất hoàng gia', 5, '2025-02-24 04:49:48', NULL);

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
  `avatar` varchar(255) DEFAULT 'Không'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `phone`, `address`, `avatar`) VALUES
(1, 'Ngọ Văn Trọng', 'vantrongngo1607@gmail.com', '123', '0352987324', 'Số nhà 22 Thôn Ngọ Hạ, Thăng Bình, Nông Cống, Thanh Hóa', 'avt/anhthe.jpg'),
(2, 'Nguyễn Hoàng Hải', 'hainh123@gmail.com', '123', '0352987645', '21 Quang Trung, Thành Phố TH, Tỉnh Thanh Hóa', 'Không'),
(3, 'Phạm Thị Nga', 'ngapt@ptit.edu.vn', '123', '0358543775', 'Thăng Bình, Nông Cống, Thanh Hóa', 'Không');

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
-- Chỉ mục cho bảng `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

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
-- Chỉ mục cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Chỉ mục cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_brand_id_foreign` (`brand_id`);

--
-- Chỉ mục cho bảng `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_user_id_foreign` (`user_id`),
  ADD KEY `reviews_product_id_foreign` (`product_id`);

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
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `news`
--
ALTER TABLE `news`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `newscategories`
--
ALTER TABLE `newscategories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT cho bảng `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT cho bảng `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`),
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Các ràng buộc cho bảng `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
