-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 16, 2023 at 03:24 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerceshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Active','Inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active',
  `type` enum('Admin','Staff') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Staff',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Active','Inactive') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 'LG', 'lg', 'Active', NULL, NULL),
(3, 'SAMSUNG', 'samsung', 'Active', NULL, NULL),
(4, 'APPLE', 'apple', 'Active', NULL, NULL),
(5, 'No brands', 'no-brands', 'Active', NULL, NULL),
(10, 'Demo 2222', 'demo-2222', 'Active', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Active','Inactive') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Bánh kẹo đường', 'may-tinh', 'Active', NULL, NULL),
(2, 'Rau biển', 'dien-thoai', 'Active', NULL, NULL),
(3, 'Đặc sản mắm', 'may-tinh-bang', 'Active', NULL, NULL),
(4, 'Hành - tỏi - quế', 'hanh-toi-que', 'Active', NULL, NULL),
(5, 'Đặc sản khô', 'dac-san-kho', 'Active', NULL, NULL),
(6, 'Nem chả Quảng Ngãi', 'nem-cha-quang-ngai', 'Active', NULL, NULL),
(9, 'Danh mục Demo', 'danh-m-c-demo', 'Active', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
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
-- Table structure for table `news`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `avatar`, `slug`, `sumary`, `description`, `newscategory_id`, `created_at`, `updated_at`) VALUES
(6, '4444', 'uploads/news/654b57b4d1aa8Kiến Thức Tin(15).png', '4444', '  444444\r\n                                                ', '444444444444\r\n                                                ', 1, '2023-11-08 16:40:51', '2023-11-08 16:41:08'),
(7, 'TIn tức demo 1', 'uploads/news/654c5e5de4b50blog-1.jpg', 'tin-t-c-demo-1', 'Tin tức demo1\r\n                        ', 'emoo 111 11\r\n                        ', 3, '2023-11-09 11:21:49', '2023-11-09 11:21:49'),
(8, 'TIn tức demo 3', 'uploads/news/654ccbff82f03blog-2.jpg', 'tin-t-c-demo-3', 'demo 3\r\n                        ', 'Demo 33\r\n                        ', 4, '2023-11-09 19:09:35', '2023-11-09 19:09:35'),
(9, 'Demo 4', 'uploads/news/654ccc17d2876blog-3.jpg', 'demo-4', 'Demo 4\r\n                        ', 'Demo 4\r\n                        ', 3, '2023-11-09 19:09:59', '2023-11-09 19:09:59'),
(10, 'Demo 5', 'uploads/news/654ccc33eecf7blog-4.jpg', 'demo-5', 'demo 5\r\n                        ', 'Demo 5\r\n                        ', 1, '2023-11-09 19:10:27', '2023-11-09 19:10:27'),
(11, 'Demo 6', 'uploads/news/654ccc530e5bdblog-5.jpg', 'demo-6', 'Demo 6', 'Demo 6\r\n                        ', 4, '2023-11-09 19:10:59', '2023-11-09 19:10:59'),
(12, 'Demo 7', 'uploads/news/654ccc6b90f70blog-6.jpg', 'demo-7', 'Demo 77', 'Demo 7\r\n                        ', 3, '2023-11-09 19:11:23', '2023-11-09 19:11:23');

-- --------------------------------------------------------

--
-- Table structure for table `newscategories`
--

CREATE TABLE `newscategories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `status` enum('Active','Innactive') NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `newscategories`
--

INSERT INTO `newscategories` (`id`, `name`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Danh mục A', 'danh-m-c-a', 'Active', NULL, NULL),
(3, 'Danh mục B', 'danh-m-c-b', 'Active', NULL, NULL),
(4, 'Danh mục C', 'danh-m-c-c', 'Active', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `firstname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Processing','Confirmed','Shipping','Delivered','Cancelled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Processing',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `firstname`, `lastname`, `address`, `phone`, `email`, `status`, `created_at`, `updated_at`) VALUES
(4, 0, 'Bui Cong', 'Thanh', '99 Hung Vuong', '09090909', 'congthanhbkit03@gmail.com', 'Cancelled', '2023-11-12 15:11:30', '2023-11-12 15:11:30'),
(5, 0, '666', '666', '6666', '6666', '6666', 'Cancelled', '2023-11-12 15:12:27', '2023-11-12 15:12:27'),
(6, 0, '8888', '8888', '88888', '888888', '88888888888', 'Processing', '2023-11-12 15:13:05', '2023-11-12 15:13:05'),
(7, 0, 'Cong Thanh', 'Bui', '77777', '777777777', '7777777777', 'Delivered', '2023-11-12 15:15:00', '2023-11-12 15:15:00'),
(8, 0, '555', '555', '5555', '555', '55555@gmail.com', 'Delivered', '2023-11-14 10:55:17', '2023-11-14 10:55:17');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
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
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `price`, `qty`, `total`, `created_at`, `updated_at`) VALUES
(1, 7, 17, 12000, 1, 12000, '2023-11-12 15:15:00', '2023-11-12 15:15:00'),
(2, 7, 14, 50000, 1, 50000, '2023-11-12 15:15:00', '2023-11-12 15:15:00'),
(3, 7, 18, 80000, 1, 80000, '2023-11-12 15:15:00', '2023-11-12 15:15:00'),
(4, 8, 21, 888888, 1, 888888, '2023-11-14 10:55:17', '2023-11-14 10:55:17');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `summary` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `stock` tinyint(3) UNSIGNED NOT NULL,
  `price` double NOT NULL,
  `disscounted_price` double NOT NULL,
  `images` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `brand_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('Active','Inactive') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `slug`, `description`, `summary`, `stock`, `price`, `disscounted_price`, `images`, `category_id`, `brand_id`, `status`, `created_at`, `updated_at`) VALUES
(12, 'Bánh ít lá gai', 'b-nh-t-l-gai', '\r\n                     Mô tả sản phẩm:\r\n\r\n    Bánh ít lá gai Quảng Ngãi có hình dáng tròn, mềm mịn và mỏng, với lớp vỏ ngoài làm từ lá gai tự nhiên, tạo nên một hương thơm độc đáo.\r\n    Lớp nhân bên trong bánh thường làm từ những nguyên liệu truyền thống như bột gạo, đậu xanh, đường, và một chút dầu mỡ, tạo ra một kết hợp hài hòa giữa vị ngọt và béo.\r\n    Bánh ít lá gai thường được đóng gói cẩn thận để đảm bảo sự tươi ngon và dẻo dai.\r\n    Sản phẩm này thường có màu xanh đậm của lá gai và hình dáng truyền thống, tạo nên sự hấp dẫn từ cái nhìn đầu tiên.\r\n\r\nBánh ít lá gai Quảng Ngãi không chỉ là một món ăn ngon mà còn mang trong mình giá trị văn hóa và truyền thống của vùng miền Trung. Sự kết hợp giữa hương vị thơm ngon và tình yêu của người làm bánh đã tạo nên một sản phẩm độc đáo và đáng giá để thưởng thức.   ', '\"Bánh ít lá gai Quảng Ngãi\" là một món ăn truyền thống độc đáo và ngon miệng của vùng Quảng Ngãi, miền Trung Việt Nam. Sản phẩm này thường được làm thủ công, kỹ lưỡng từ những nguyên liệu tự nhiên chất lượng, tạo nên một hương vị đặc trưng và độc đáo.\r\n                        ', 255, 35000, 30000, 'uploads/6546e20943f75banh-it-1.png;uploads/6546e20945994banh-it-2.png;uploads/6546e20946196banh-it-3.png', 1, 5, 'Active', NULL, NULL),
(13, 'Bánh Nổ Quảng Ngãi: Món Quà Độc Đáo Từ Miền Trung Việt Nam', 'b-nh-n-qu-ng-ng-i-m-n-qu-c-o-t-mi-n-trung-vi-t-nam', '\r\n                        Bánh nổ, hay còn gọi là \"bánh nổ Quảng Ngãi,\" là một món ăn truyền thống đặc biệt của vùng Quảng Ngãi, miền Trung Việt Nam. Được gọi là \"bánh nổ\" là vì khi bạn cắn nhẹ vào nó, bạn sẽ cảm nhận một trải nghiệm độc đáo, bắt đầu từ lớp vỏ mỏng mịn, tiếp theo là nhân bên trong, thường được làm từ các nguyên liệu tự nhiên chất lượng và tinh tế kết hợp để tạo nên một cảm giác \"nổ\" ngon lạ thường trong miệng.\r\n\r\nMô tả sản phẩm:\r\n\r\n    Lớp Vỏ Tinh Tế: Bánh nổ Quảng Ngãi có lớp vỏ mỏng và giòn, thường được làm từ bột gạo tinh túy. Lớp vỏ này thường được nướng hoặc rang chín tới màu vàng hấp dẫn, tạo nên một hương thơm đặc biệt và mùi vị độc đáo.\r\n\r\n    Nhân Đa Dạng: Là điểm đặc biệt của bánh nổ Quảng Ngãi, nhân bên trong bánh thường có nhiều loại như đậu xanh, lạc, hạt sen, đường, dầu mỡ, và một chút gia vị truyền thống. Sự kết hợp này tạo ra một hương vị độc đáo và hấp dẫn, hòa quyện giữa vị ngọt, mặn, và ngậy.\r\n\r\n    Hình Dáng Độc Đáo: Bánh nổ Quảng Ngãi thường có hình dáng hình tròn, nhỏ gọn và xinh xắn. Mỗi chiếc bánh thường được làm thủ công, đòi hỏi sự khéo léo và tình yêu của người làm bánh.\r\n\r\n    Các Dịp Sử Dụng: Bánh nổ Quảng Ngãi thường được dùng trong các dịp lễ, tết, kỷ niệm, hoặc đơn giản là để thưởng thức trong cuộc sống hàng ngày. Nó thường được đóng gói cẩn thận để đảm bảo sự tươi ngon và dẻo dai.\r\n\r\n    Kết Hợp Cùng Trà Hoặc Cà Phê: Bánh nổ Quảng Ngãi là món ăn hoàn hảo để kết hợp cùng trà hoặc cà phê trong những buổi chiều hay sáng mát. Hương thơm đặc trưng và vị ngon độc đáo của bánh này sẽ khiến bạn thích thú.\r\n\r\nBánh nổ Quảng Ngãi không chỉ là một món ăn ngon mà còn mang trong nó giá trị văn hóa và truyền thống của vùng miền Trung Việt Nam. Nó là một món quà độc đáo để thưởng thức hoặc tặng cho người thân yêu trong các dịp đặc biệt. Khám phá hương vị đặc biệt của miền Trung Việt Nam với bánh nổ Quảng Ngãi và tạo thêm những kỷ niệm đáng nhớ.', '\"Bánh Nổ Quảng Ngãi\" là một món quà độc đáo và thú vị từ vùng đất Quảng Ngãi, nổi tiếng với hương vị độc đáo và truyền thống lâu đời. Hãy khám phá cùng chúng tôi về loại bánh này và tại sao nó trở thành một phần không thể thiếu trong các dịp lễ và kỷ niệm tại miền Trung Việt Nam.\r\n                        ', 255, 50000, 45000, 'uploads/6546e2809b0e4banh-no.png', 1, 5, 'Active', NULL, NULL),
(14, 'Bánh Thuẩn Quảng Ngãi: Hương Vị Truyền Thống Từ Đất Quảng Ngãi', 'b-nh-thu-n-qu-ng-ng-i-h-ng-v-truy-n-th-ng-t-t-qu-ng-ng-i', '\r\n                        Bánh Thuẩn Quảng Ngãi - Hương Vị Truyền Thống\r\n\r\nBánh Thuẩn Quảng Ngãi là một biểu tượng ẩm thực đặc trưng của vùng đất Quảng Ngãi, nằm ở miền Trung Việt Nam. Với hương vị độc đáo và nguyên liệu tự nhiên chất lượng, loại bánh này là một phần quan trọng của di sản văn hóa ẩm thực của người dân Quảng Ngãi.\r\n\r\nĐặc Điểm Của Bánh Thuẩn Quảng Ngãi:\r\n\r\n    Hương Vị Độc Đáo: Bánh Thuẩn Quảng Ngãi thường được làm từ bột gạo và các nguyên liệu tự nhiên, tạo nên một hương vị độc đáo. Những người làm bánh có sự khéo léo trong việc kết hợp các thành phần này để tạo ra món bánh ngon đậm chất miền Trung.\r\n\r\n    Lớp Vỏ Mỏng Giòn: Lớp vỏ ngoài cùng của bánh được làm mỏng và giòn, thường được nướng hoặc rang chín tới màu vàng hấp dẫn, tạo nên một hương thơm đặc biệt và mùi vị độc đáo.\r\n\r\n    Nhân Bên Trong: Nhân của bánh thường được làm từ những nguyên liệu truyền thống như đậu xanh, đường, hạt sen, và một chút dầu mỡ, tạo ra một kết hợp hài hòa giữa vị ngọt, mặn, và ngậy.\r\n\r\n    Hình Dáng Truyền Thống: Bánh Thuẩn Quảng Ngãi thường có hình dáng tròn, nhỏ gọn và đáng yêu. Mỗi chiếc bánh thường được làm thủ công, đòi hỏi sự khéo léo và tình yêu của người làm bánh.\r\n\r\n    Sản Phẩm Truyền Thống: Bánh Thuẩn Quảng Ngãi thường được làm và truyền dọc theo thế hệ. Nó là một phần không thể thiếu trong các dịp lễ, tết, kỷ niệm và những buổi họp gia đình ấm áp.\r\n\r\nThưởng Thức Bánh Thuẩn Quảng Ngãi:\r\n\r\nBánh Thuẩn Quảng Ngãi không chỉ là một món ăn ngon mà còn là một phần của di sản văn hóa của người dân Quảng Ngãi. Hãy thưởng thức hương vị truyền thống này và tìm hiểu thêm về vùng đất Quảng Ngãi qua món bánh độc đáo này. Bánh Thuẩn Quảng Ngãi là sự kết hợp hoàn hảo của tài năng và tâm huyết trong nghệ thuật làm bánh, và nó đem đến niềm vui cho mọi người thưởng thức.', '\"Bánh Thuẩn Quảng Ngãi\" là một món ăn truyền thống độc đáo và ngon miệng, xuất phát từ vùng đất Quảng Ngãi. Hãy cùng tìm hiểu về hương vị đặc biệt và giá trị truyền thống của sản phẩm này trong bài viết dưới đây.\r\n                        ', 255, 60000, 50000, 'uploads/6546e3ecbd100banh-thuan.png;uploads/6546e3ecbdbabbanh-thuan-2.png', 1, 5, 'Active', NULL, NULL),
(15, 'Củ nén', 'c-n-n', 'Củ Nén Quảng Ngãi không chỉ là một loại thực phẩm ngon và bổ dưỡng mà còn là một biểu tượng của văn hóa và kỹ thuật nấu ăn truyền thống của vùng miền Trung Việt Nam. Loại cây này và các sản phẩm chế biến từ nó đang thu hút sự quan tâm của người yêu ẩm thực và đóng một vai trò quan trọng trong việc duy trì và phát triển di sản ẩm thực của khu vực này.\r\nNguồn Gốc:\r\n\r\n    Cây củ nén có nguồn gốc từ khu vực miền Trung Việt Nam, đặc biệt là vùng Quảng Ngãi.\r\n\r\nCách Sử Dụng:\r\n\r\n    Cây củ nén được sử dụng không chỉ về mục đích thực phẩm mà còn về mục đích y học. Củ nén là một phần quan trọng của ẩm thực truyền thống Quảng Ngãi và được chế biến thành nhiều món ăn ngon và bổ dưỡng như bánh, canh, món ăn kho, và món ăn nhậu.\r\n\r\nGiá Trị Dinh Dưỡng:\r\n\r\n    Củ Nén chứa nhiều chất xơ, vitamin, khoáng chất và chất dinh dưỡng quý báu. Nó có thể cung cấp nhiều lợi ích cho sức khỏe như giảm nguy cơ bệnh tật, tăng cường hệ tiêu hóa, và cung cấp năng lượng.\r\n\r\nDi Sản Văn Hóa:\r\n\r\n    Củ Nén là một phần không thể thiếu của di sản văn hóa ẩm thực của Quảng Ngãi và miền Trung Việt Nam nói chung. Nó thường xuất hiện trong các dịp lễ, tết, và các buổi họp gia đình truyền thống.\r\n\r\nChế Biến và Món Ăn Phổ Biến:\r\n\r\n    Củ Nén có thể được chế biến thành nhiều món ăn ngon như \"bánh bao củ nén,\" \"canh củ nén,\" \"món kho củ nén,\" và nhiều món ăn khác. Cách chế biến và kết hợp với các nguyên liệu khác tạo nên hương vị độc đáo và tinh tế của ẩm thực Quảng Ngãi.\r\n                        ', 'Củ nén có nguồn gốc ở khu vực ôn đới châu Âu, châu Á và Bắc Mỹ. Củ nén phát triển mạnh ở đất thoát nước tốt, giàu chất hữu cơ, độ pH từ 6 - 7 và có nắng đầy đủ. Chúng có thể được trồng từ hạt và trưởng thành vào mùa hè, hoặc đầu mùa xuân năm sau.\r\n                        ', 255, 30000, 28000, 'uploads/6546e5bd506c9cu-nen.png', 4, 5, 'Active', NULL, NULL),
(16, 'Chả cá Lý Sơn', 'ch-c-l-s-n', 'Chả Cá Lý Sơn - Hương Vị Biển Cả Trong Mỗi Miếng\r\n\r\nLý Sơn, hòn đảo nhỏ và xinh đẹp thuộc tỉnh Quảng Ngãi, nổi tiếng với cảnh biển đẹp và nguồn lợi thủy sản phong phú. Trong đó, \"Chả Cá Lý Sơn\" là một sản phẩm ẩm thực độc đáo và đặc biệt của đảo này. Hãy cùng khám phá hương vị biển cả tươi mát và giá trị dinh dưỡng của món ăn này.\r\n\r\nĐặc Điểm Của Chả Cá Lý Sơn:\r\n\r\n    Nguyên Liệu Tươi Mát: Chả Cá Lý Sơn được làm từ cá tươi ngon, đặc biệt là cá bớp, cá ngừ, hoặc cá chít. Sự tươi mát của nguyên liệu là một yếu tố quan trọng tạo nên hương vị đặc biệt của sản phẩm.\r\n\r\n    Cách Chế Biến Độc Đáo: Cá tươi được xay nhuyễn và sau đó trộn với gia vị tự nhiên, các loại thảo mộc, và một ít bột nghệ để tạo ra hỗn hợp thơm ngon và màu vàng tươi. Hỗn hợp này sau đó được nướng thành từng viên chả cá có màu vàng óng ánh.\r\n\r\n    Hương Vị Đặc Biệt: Chả Cá Lý Sơn có hương vị độc đáo, hòa quyện giữa vị biển cả mặn mòi và thơm ngon từ các loại gia vị tự nhiên. Mỗi miếng chả cá mang trong mình hương vị của biển cả mà bạn sẽ khó quên.\r\n\r\n    Cách Sử Dụng Đa Dạng: Chả Cá Lý Sơn có thể được sử dụng trong nhiều món ăn khác nhau như mì quảng, bún riêu cua, bánh mì sandwich, hoặc đơn giản là món nhậu thú vị. Sự đa dạng này tạo nên nhiều cơ hội để thưởng thức hương vị độc đáo của chả cá.\r\n\r\n    Kết Hợp Hoàn Hảo: Chả Cá Lý Sơn thường được kết hợp cùng với rau sống, bánh mì, và nước mắm pha chua ngọt để tạo ra một bữa ăn ngon miệng và bổ dưỡng.\r\n\r\nThưởng Thức Chả Cá Lý Sơn:\r\n\r\nChả Cá Lý Sơn không chỉ là một món ngon độc đáo mà còn là một cách để bạn kết nối với vùng biển đẹp của Lý Sơn và nguồn thủy sản phong phú của đảo này. Sản phẩm này thường được làm thủ công và đòi hỏi sự khéo léo trong việc chế biến. Hãy thưởng thức hương vị biển cả tươi mát của Chả Cá Lý Sơn và khám phá sự độc đáo của ẩm thực Lý Sơn thông qua món ăn này.\r\n                        ', '\"Chả Cá Lý Sơn\" là một món ngon độc đáo từ hòn đảo Lý Sơn ở Việt Nam. Sản phẩm này kết hợp hương vị tươi mát của biển cả và sự khéo léo trong chế biến. Hãy cùng tìm hiểu về món ăn đặc trưng của Lý Sơn qua bài viết này.', 255, 129999, 99000, 'uploads/6546e66f38639cha-ca-ly-son-1.png;uploads/6546e66f38f74cha-ca-ly-son-2.png', 6, 5, 'Active', NULL, NULL),
(17, 'Đường phổi Quảng Ngãi', '-ng-ph-i-qu-ng-ng-i', 'Đường Phổi Quảng Ngãi - Hương Vị Ngọt Độc Đáo\r\n\r\nQuảng Ngãi, một tỉnh nằm ở miền Trung Việt Nam, nổi tiếng không chỉ với cảnh đẹp tự nhiên mà còn với những sản phẩm ẩm thực truyền thống độc đáo. Trong số đó, \"Đường Phổi Quảng Ngãi\" là một sản phẩm đặc biệt với hương vị ngọt ngào và giá trị truyền thống.\r\n\r\nĐặc Điểm Của Đường Phổi Quảng Ngãi:\r\n\r\n    Nguyên Liệu Chất Lượng: Đường Phổi Quảng Ngãi thường được làm từ mật ong, đường mía, và các nguyên liệu tự nhiên chất lượng khác. Điều này đảm bảo sản phẩm cuối cùng không chỉ ngon miệng mà còn bổ dưỡng.\r\n\r\n    Chế Biến Thủ Công: Sản phẩm được sản xuất bằng phương pháp thủ công truyền thống, đòi hỏi sự khéo léo và tâm huyết của người làm đường. Điều này tạo ra một sản phẩm độc đáo và chất lượng cao.\r\n\r\n    Hương Vị Độc Đáo: Đường Phổi Quảng Ngãi có hương vị độc đáo với vị ngọt đặc trưng và một chút hương thơm từ mật ong. Sự kết hợp này tạo nên một hương vị ngọt tự nhiên, không quá ngấy, và hoàn hảo để thưởng thức trong nhiều món ăn và thức uống.\r\n\r\n    Sử Dụng Đa Dạng: Đường Phổi Quảng Ngãi có thể được sử dụng trong nhiều món ăn và đồ uống như trà, café, bánh ngọt, và mứt. Sự đa dạng này làm cho sản phẩm này trở thành một lựa chọn phổ biến cho nhiều người yêu ẩm thực.\r\n\r\n    Thực Phẩm Bổ Dưỡng: Đường Phổi Quảng Ngãi không chỉ là một sản phẩm thú vị mà còn có giá trị dinh dưỡng. Nó cung cấp năng lượng và các chất dinh dưỡng quý báu từ mật ong và đường mía.\r\n\r\nThưởng Thức Đường Phổi Quảng Ngãi:\r\n\r\nĐường Phổi Quảng Ngãi là một sản phẩm đặc biệt của vùng đất Trung Việt. Hương vị ngọt ngào và độc đáo của sản phẩm này làm cho nó trở thành một phần không thể thiếu của ẩm thực và văn hóa ẩm thực Quảng Ngãi. Hãy thưởng thức hương vị đặc biệt của Đường Phổi Quảng Ngãi và tạo thêm những trải nghiệm ngon miệng và đáng nhớ trong bữa ăn của bạn.\r\n                        ', '\"Đường Phổi Quảng Ngãi\" là một loại đường truyền thống nổi tiếng với hương vị ngọt độc đáo và chất lượng cao. Hãy khám phá sự đặc biệt của sản phẩm này và tại sao nó là một phần không thể thiếu của ẩm thực đặc sản Quảng Ngãi.\r\n                        ', 255, 129000, 12000, 'uploads/6546e6fc1e7f6duong_phoi.png;uploads/6546e6fc1efc9duong_phoi2.png;uploads/6546e6fc1f6deduong_phoi3.png;uploads/6546e6fc1fb6bduong_phoi4.png', 1, 5, 'Active', NULL, NULL),
(18, 'Đường phèn Quảng Ngãi', '-ng-ph-n-qu-ng-ng-i', 'Đường Phèn Quảng Ngãi - Hương Vị Độc Đáo từ Miền Trung\r\n\r\nMiền Trung Việt Nam nổi tiếng với văn hóa ẩm thực đa dạng và độc đáo. \"Đường Phèn Quảng Ngãi\" là một món đặc sản truyền thống từ vùng đất Quảng Ngãi, nổi bật với hương vị độc đáo và giá trị lịch sử.\r\n\r\nĐặc Điểm Của Đường Phèn Quảng Ngãi:\r\n\r\n    Nguyên Liệu Chất Lượng: Đường Phèn Quảng Ngãi được sản xuất từ mía tươi, đường và nước cốt nước mía. Sự tươi mát và chất lượng của nguyên liệu là một trong những yếu tố quan trọng tạo nên hương vị đặc biệt của sản phẩm.\r\n\r\n    Cách Chế Biến Truyền Thống: Sản phẩm này thường được sản xuất bằng phương pháp thủ công truyền thống. Quá trình nấu đường phèn đòi hỏi sự khéo léo và kỹ thuật của người làm đường, đảm bảo hương vị và chất lượng tốt nhất.\r\n\r\n    Hương Vị Đặc Biệt: Đường Phèn Quảng Ngãi có hương vị độc đáo với vị ngọt tự nhiên từ đường và nước mía. Sự kết hợp này tạo nên một hương vị đặc biệt, không giống bất kỳ sản phẩm đường nào khác.\r\n\r\n    Sử Dụng Đa Dạng: Đường Phèn Quảng Ngãi có thể được sử dụng trong nhiều món ăn và đồ uống như trà, café, bánh ngọt, và nhiều món ăn khác. Sự đa dạng này tạo ra nhiều cơ hội để thưởng thức hương vị đặc biệt của đường phèn.\r\n\r\n    Giá Trị Lịch Sử và Văn Hóa: Đường Phèn Quảng Ngãi không chỉ là một sản phẩm ẩm thực mà còn có giá trị lịch sử và văn hóa lớn. Nó đã tồn tại và được sản xuất theo cách truyền thống trong nhiều thế hệ và là một phần không thể thiếu của văn hóa ẩm thực của Quảng Ngãi.\r\n\r\nThưởng Thức Đường Phèn Quảng Ngãi:\r\n\r\nĐường Phèn Quảng Ngãi là một sản phẩm đặc biệt và độc đáo của vùng đất Trung Việt. Hương vị đặc biệt và giá trị lịch sử của sản phẩm này làm cho nó trở thành một phần không thể thiếu của ẩm thực và văn hóa ẩm thực Quảng Ngãi. Hãy thưởng thức hương vị ngọt ngào của Đường Phèn Quảng Ngãi và khám phá sự đặc biệt của sản phẩm này, một phần không thể thiếu của hậu quảng đại của miền Trung.\r\n                        ', 'Đường Phèn Quảng Ngãi là một món đặc sản truyền thống có hương vị độc đáo từ vùng đất Quảng Ngãi, miền Trung Việt Nam. Hãy khám phá sự đặc biệt và giá trị của sản phẩm này trong bài viết dưới đây.\r\n                        ', 255, 87000, 80000, 'uploads/6546e96beb3bdduong-phen.png;uploads/6546e96bec137duong-phen2.png;uploads/6546e96bec85cduong-phen3.png;uploads/6546e96bed07bduong-phen4.png', 1, 5, 'Active', NULL, NULL),
(19, 'Hành Tím Lý Sơn: Hương Vị Độc Đáo Từ Hòn Đảo Xinh Đẹp', 'h-nh-t-m-l-s-n-h-ng-v-c-o-t-h-n-o-xinh-p', 'Hành Tím Lý Sơn - Món Đặc Sản Độc Đáo\r\n\r\nLý Sơn, một hòn đảo nằm ngoài khơi Biển Đông thuộc tỉnh Quảng Ngãi, là một điểm đến nổi tiếng với cảnh biển đẹp và một loại đặc sản độc đáo - Hành Tím Lý Sơn. Được trồng trên hòn đảo xinh đẹp này, hành tím Lý Sơn không chỉ nổi tiếng với hương vị tươi ngon mà còn là một phần quan trọng của di sản ẩm thực của vùng miền Trung Việt Nam.\r\n\r\nĐặc Điểm Của Hành Tím Lý Sơn:\r\n\r\n    Khái Niệm Độc Đáo: Hành Tím Lý Sơn được gọi là \"Tím Lý Sơn\" bởi sự đặc biệt về màu sắc. Màu tím tự nhiên của hành tím này tạo nên một sự khác biệt và tạo cảm hứng cho nhiều món ăn.\r\n\r\n    Nguyên Liệu Tươi Mát: Hành Tím Lý Sơn được trồng trên đất đảo tự nhiên, nơi có khí hậu và đất đai lý tưởng. Điều này đảm bảo rằng hành tím có hương vị độc đáo và nguyên liệu tươi ngon.\r\n\r\n    Hương Vị Tươi Mát: Hành tím Lý Sơn có hương vị tươi mát, ngọt ngon và độc đáo. Mỗi củ hành tím mang trong mình hương thơm đặc trưng của đất đảo và biển cả xung quanh.\r\n\r\n    Sử Dụng Đa Dạng: Hành Tím Lý Sơn có thể được sử dụng trong nhiều món ăn và thực đơn, từ các món salad đơn giản đến các món hấp, xào, hoặc trở thành món gia vị cho các món nước.\r\n\r\n    Sản Phẩm Địa Phương Quan Trọng: Hành Tím Lý Sơn đóng một vai trò quan trọng trong nền kinh tế địa phương và cộng đồng trên hòn đảo này. Việc trồng và thu hoạch hành tím mang lại nguồn thu nhập cho nhiều gia đình và đóng góp vào sự phát triển bền vững của vùng Lý Sơn.\r\n\r\nThưởng Thức Hành Tím Lý Sơn:\r\n\r\nHành Tím Lý Sơn không chỉ là một loại hành tím độc đáo mà còn là một cách để bạn kết nối với vẻ đẹp thiên nhiên của Lý Sơn và nguồn lợi thực phẩm độc đáo của đảo này. Hãy thưởng thức hương vị tươi mát của Hành Tím Lý Sơn và khám phá sự độc đáo của ẩm thực Lý Sơn thông qua món ăn này.\r\n                        ', 'Hành Tím Lý Sơn là một loại hành tím đặc sản, nổi tiếng với hương vị độc đáo và chất lượng cao từ hòn đảo Lý Sơn ở Việt Nam. Hãy cùng khám phá về loại hành tím này và tại sao nó đang thu hút sự quan tâm của người yêu ẩm thực.\r\n                        ', 255, 90000, 80000, 'uploads/6546ea63c014dhanh-tim-ly-son.png', 4, 5, 'Active', NULL, NULL),
(20, 'Kẹo Gương Quảng Ngãi: Hương Vị Ngọt Ngào của xứ đường Quảng Ngãi', 'k-o-g-ng-qu-ng-ng-i-h-ng-v-ng-t-ng-o-c-a-x-ng-qu-ng-ng-i', 'Kẹo Gương Quảng Ngãi - Hương Vị Đặc Sản Độc Đáo\r\n\r\nQuảng Ngãi, một tỉnh nằm ở miền Trung Việt Nam, không chỉ nổi tiếng với cảnh thiên nhiên tươi đẹp mà còn với những sản phẩm ẩm thực đặc biệt, trong đó \"Kẹo Gương Quảng Ngãi\" là một loại kẹo đặc sản truyền thống với hương vị độc đáo và giá trị lịch sử.\r\n\r\nĐặc Điểm Của Kẹo Gương Quảng Ngãi:\r\n\r\n    Nguyên Liệu Tự Nhiên: Kẹo Gương Quảng Ngãi thường được làm từ các nguyên liệu tự nhiên như đường mía, nước cốt nước mía và một chút vani. Sự tươi mát và chất lượng của nguyên liệu là một yếu tố quan trọng tạo nên hương vị đặc biệt của sản phẩm.\r\n\r\n    Chế Biến Truyền Thống: Khi chế biến, kẹo gương được làm bằng phương pháp thủ công truyền thống. Quá trình nấu kẹo đòi hỏi sự khéo léo và kỹ thuật, đảm bảo hương vị và chất lượng tốt nhất.\r\n\r\n    Hương Vị Đặc Biệt: Kẹo Gương Quảng Ngãi có hương vị độc đáo với vị ngọt tự nhiên từ đường mía và nước cốt nước mía. Sự kết hợp này tạo nên một hương vị đặc biệt, không giống bất kỳ sản phẩm kẹo nào khác.\r\n\r\n    Sử Dụng Đa Dạng: Kẹo Gương Quảng Ngãi có thể được thưởng thức trong nhiều cách khác nhau, từ kẹo mút truyền thống cho đến các món ăn và thức uống sáng tạo. Sự đa dạng này tạo ra nhiều cơ hội để thưởng thức hương vị đặc biệt của kẹo gương.\r\n\r\n    Giá Trị Lịch Sử và Văn Hóa: Kẹo Gương Quảng Ngãi không chỉ là một sản phẩm ẩm thực mà còn có giá trị lịch sử và văn hóa lớn. Nó đã tồn tại và được sản xuất theo cách truyền thống trong nhiều thế hệ và là một phần quan trọng của văn hóa ẩm thực của Quảng Ngãi.\r\n\r\nThưởng Thức Kẹo Gương Quảng Ngãi:\r\n\r\nKẹo Gương Quảng Ngãi không chỉ là một loại kẹo đặc sản mà còn là một cách để bạn kết nối với vẻ đẹp của vùng đất Quảng Ngãi và nguồn lợi thực phẩm độc đáo của khu vực này. Hãy thưởng thức hương vị ngọt ngào của Kẹo Gương Quảng Ngãi và khám phá sự độc đáo của ẩm thực Quảng Ngãi thông qua món ăn này, một phần không thể thiếu của di sản ẩm thực của miền Trung Việt Nam.', '\"Kẹo Gương Quảng Ngãi\" là một loại kẹo đặc sản nổi tiếng với hương vị ngọt ngào và giá trị truyền thống từ vùng đất Quảng Ngãi, miền Trung Việt Nam. Hãy cùng khám phá sự đặc biệt của sản phẩm này trong bài viết dưới đây.\r\n                        ', 255, 90000, 35000, 'uploads/6546ead33188ekeo-guong-1.png;uploads/6546ead331f6ckeo-guong-2.png', 1, 5, 'Active', NULL, NULL),
(21, 'Mạch nha', 'm-ch-nha', 'Mạch nha là món ăn được làm nhiều tại huyện Mộ Đức, phía nam tỉnh Quảng Ngãi. Thích hợp ăn với bánh tráng vào những buổi trưa hay chiều. Ngoài ra mạch nha còn dùng làm nguyên liệu cho các thức ăn như ..\r\n                        ', 'Được làm từ lúa non, với vị ngọt và thơm của lúa, không làm từ đường\r\n                        ', 255, 8888888, 888888, 'uploads/654740797338bmach-nha-1.png;uploads/6547407974b92mach-nha-2.png', 1, 5, 'Active', NULL, NULL),
(22, 'Mắm nhĩ cá cơm', 'm-m-nh-c-c-m', 'Nước mắm Nhĩ Cá Cơm là một loại nước mắm đặc sản được sản xuất từ cá cơm biển đảo, và đang thu hút sự quan tâm của nhiều người yêu ẩm thực và đầu bếp trên khắp Việt Nam. Với hương vị độc đáo và giá trị lịch sử, nước mắm Nhĩ Cá Cơm đã trở thành một phần không thể thiếu trong nhiều món ăn ngon của người Việt.\r\n\r\nĐặc Điểm Của Nước Mắm Nhĩ Cá Cơm:\r\n\r\n    Nguyên Liệu Chất Lượng: Nước mắm Nhĩ Cá Cơm được làm từ cá cơm biển đảo, một loại cá nhỏ với thịt ngon và hương vị đặc biệt. Sự tươi mát và chất lượng của cá cơm đảm bảo rằng nước mắm có hương vị độc đáo.\r\n\r\n    Chế Biến Truyền Thống: Quá trình sản xuất nước mắm Nhĩ Cá Cơm đòi hỏi sự khéo léo và tâm huyết của người làm nước mắm. Cá cơm được ướp muối và ủ chín từ nhiều tháng đến nhiều năm, cho đến khi nước mắm có hương vị đậm đà và màu sắc đẹp.\r\n\r\n    Hương Vị Độc Đáo: Nước mắm Nhĩ Cá Cơm có hương vị độc đáo, hòa quyện giữa vị mặn tự nhiên và thơm ngon từ cá cơm biển đảo. Mỗi giọt nước mắm mang trong mình hương vị của biển cả mà bạn sẽ khó quên.\r\n\r\n    Sử Dụng Đa Dạng: Nước mắm Nhĩ Cá Cơm có thể được sử dụng trong nhiều món ăn và thực đơn, từ nước mắm chấm cho mì quảng, bún riêu cua, đến gia vị cho các món hấp, xào, hoặc mứt. Sự đa dạng này tạo ra nhiều cơ hội để thưởng thức hương vị đặc biệt của nước mắm Nhĩ Cá Cơm.\r\n\r\nThưởng Thức Nước Mắm Nhĩ Cá Cơm:\r\n\r\nNước Mắm Nhĩ Cá Cơm không chỉ là một sản phẩm ẩm thực đặc biệt mà còn là một cách để bạn kết nối với vẻ đẹp của biển cả và nguồn lợi thực phẩm độc đáo từ biển đảo Việt Nam. Hãy thưởng thức hương vị đặc biệt của Nước Mắm Nhĩ Cá Cơm và khám phá sự độc đáo của ẩm thực Việt thông qua món ăn này, một phần quan trọng\r\n                        ', '\"Nước Mắm Nhĩ Cá Cơm\" là một loại nước mắm đặc sản nổi tiếng với hương vị độc đáo từ cá cơm biển đảo. Hãy cùng khám phá sự đặc biệt và giá trị của sản phẩm này trong bài viết dưới đây.\r\n                        ', 255, 999999, 90000, 'uploads/6547472e932b2mam-ca-com-1.png;uploads/6547472e944ffmam-ca-com-2.png;uploads/6547472e952efmam-ca-com-3.png', 3, 5, 'Active', NULL, NULL),
(23, 'Mắm mực', 'm-m-m-c', 'Quảng Ngãi, một tỉnh nằm ở miền Trung Việt Nam, nổi tiếng với cảnh biển đẹp và một loại mắm đặc sản độc đáo - Mắm Mực Quảng Ngãi. Được sản xuất từ mực biển đảo vùng này, Mắm Mực Quảng Ngãi không chỉ nổi tiếng với hương vị độc đáo mà còn là một phần quan trọng của ẩm thực đặc sản của Việt Nam.\r\n\r\nĐặc Điểm Của Mắm Mực Quảng Ngãi:\r\n\r\n    Nguyên Liệu Chất Lượng: Mắm Mực Quảng Ngãi thường được làm từ mực biển đảo, một loại mực tươi ngon và giàu dinh dưỡng. Sự tươi mát và chất lượng của nguyên liệu đảm bảo rằng mắm mực có hương vị độc đáo.\r\n\r\n    Chế Biến Truyền Thống: Sản xuất mắm mực đòi hỏi sự khéo léo và kỹ thuật. Quá trình ủ mực mực để tạo ra mắm mực đậm đà và thơm ngon đòi hỏi kiên nhẫn và am hiểu.\r\n\r\n    Hương Vị Độc Đáo: Mắm Mực Quảng Ngãi có hương vị độc đáo, kết hợp giữa vị mặn tự nhiên và hương thơm ngon từ mực biển đảo. Mắm mực thường có màu đặc trưng và hương thơm độc đáo mà bạn sẽ không thể nhầm lẫn với bất kỳ sản phẩm mắm nào khác.\r\n\r\n    Sử Dụng Đa Dạng: Mắm Mực Quảng Ngãi có thể được sử dụng trong nhiều món ăn và thực đơn, từ mắm chấm cho các món ăn như bánh xèo, bún mắm, mì quảng, đến gia vị cho các món hấp, xào, hoặc nước lèo. Sự đa dạng này tạo ra nhiều cơ hội để thưởng thức hương vị đặc biệt của Mắm Mực Quảng Ngãi.\r\n\r\nThưởng Thức Mắm Mực Quảng Ngãi:\r\n\r\nMắm Mực Quảng Ngãi không chỉ là một sản phẩm mắm đặc biệt mà còn là cách để bạn kết nối với vẻ đẹp của biển cả và nguồn lợi thực phẩm độc đáo từ biển đảo Quảng Ngãi. Hãy thưởng thức hương vị đặc biệt của Mắm Mực Quảng Ngãi và khám phá sự độc đáo của ẩm thực Việt thông qua món ăn này, một phần quan trọng của di sản ẩm thực của miền Trung Việt Nam.\r\n                        ', '\"Mắm Mực Quảng Ngãi\" là một sản phẩm mắm đặc biệt nổi tiếng với hương vị thơm ngon và chất lượng cao từ vùng biển Quảng Ngãi. Hãy khám phá sự đặc biệt của sản phẩm này trong bài viết dưới đây.\r\n\r\n                        ', 255, 120000, 100000, 'uploads/654748a1074demam-muc-1.png;uploads/654748a107fc0mam-muc-2.png', 3, 5, 'Active', NULL, NULL),
(24, 'Bột quế Trà Bồng', 'b-t-qu-tr-b-ng', 'Nguyên Liệu Tự Nhiên và Truyền Thống\r\n\r\nQuế Trà Bồng được sản xuất từ cây quế, một loại cây thân gỗ cổ thụ có nguồn gốc từ vùng núi rừng Trà Bồng, tỉnh Quảng Ngãi. Cây quế thường mọc hoang dã trong môi trường thiên nhiên, và quá trình thu hái và chế biến quế Trà Bồng thường tuân theo các phương pháp truyền thống được lưu truyền từ đời này sang đời khác.\r\n\r\n2. Hương Vị Đặc Biệt và Hấp Dẫn\r\n\r\nHương vị của quế Trà Bồng là độc đáo và quyến rũ. Mỗi cây quế mang trong mình một hương thơm tinh tế, hòa quyện giữa vị ngọt và hơi cay, làm cho quế Trà Bồng trở thành một loại gia vị thú vị và không thể thiếu trong nhiều món ăn truyền thống và đặc sản.\r\n\r\n3. Sử Dụng Đa Dạng\r\n\r\nQuế Trà Bồng có thể được sử dụng trong nhiều món ăn khác nhau, từ món hấp, xào, đến các món tráng miệng và nước uống. Hương vị độc đáo của quế Trà Bồng có thể làm cho mọi món ăn trở nên thơm ngon và đặc biệt hơn\r\n                        ', 'Trà Bồng là một huyện phía tây Quảng Ngãi với sản phẩm nông nghiệp nổi tiếng là cây quế. Thân vỏ quế vừa là hương liệu vừa là phụ gia trong các món ăn thơm ngon, bổ dưỡng.\r\n                        ', 255, 90000, 80000, 'uploads/6547495a397ceque-1.png;uploads/6547495a3a6c9que-2.png', 4, 5, 'Active', NULL, NULL),
(25, 'Tỏi cô đơn Lý Sơn', 't-i-c-n-l-s-n', '. Xuất Xứ và Đặc Điểm:\r\nTỏi cô đơn Lý Sơn được trồng trên đảo Lý Sơn, nơi có điều kiện địa lý và hải sản độc đáo. Loại tỏi này thường có màu trắng bạc và cảm giác mặn, thơm và cay hơn so với tỏi truyền thống.\r\n\r\n2. Phương Pháp Trồng và Chế Biến:\r\nTỏi cô đơn Lý Sơn thường được trồng mùa Đông và thu hoạch vào mùa Hè. Cây tỏi trồng trên đất cát cỏ và dùng một hệ thống tưới tiêu tự động để đảm bảo rễ cây được cung cấp đủ nước. Sau đó, tỏi được chế biến và ngâm chua trong nước biển khoảng một tháng trước khi sấy khô.\r\n\r\n3. Hương Vị Độc Đáo:\r\nTỏi cô đơn Lý Sơn có hương vị đặc biệt, mặn mà, và cay nồng, với mùi thơm riêng biệt mà bạn khó có thể tìm thấy ở bất kỳ nơi nào khác. Hương vị này đã khiến cho tỏi cô đơn Lý Sơn trở thành một sản phẩm thú vị và độc đáo trong ẩm thực.\r\n\r\n4. Sử Dụng và Giá Trị Y Học:\r\nTỏi cô đơn Lý Sơn thường được sử dụng làm gia vị trong nhiều món ăn Việt Nam. Ngoài ra, nó cũng được coi là một loại thảo dược quý trong y học truyền thống và được sử dụng để điều trị một loạt tình trạng sức khỏe.\r\n\r\n5. Văn Hóa và Du Lịch:\r\nTỏi cô đơn Lý Sơn đã trở thành một phần của văn hóa và di sản của người dân Lý Sơn. Đảo này cũng là một điểm đến du lịch phổ biến cho những người muốn thưởng thức không chỉ vị ngon của tỏi cô đơn mà còn vẻ đẹp của biển cả và cuộc sống đảo ngọc.\r\n\r\nTỏi cô đơn Lý Sơn là một sản phẩm độc đáo của Việt Nam, đặc biệt với hương vị thơm và giá trị y học. Nó đã trở thành một biểu tượng của quần đảo Lý Sơn và được người dân địa phương tự hào bảo vệ và duy trì\r\n                        ', 'Đây là loại tỏi rất đặc biệt với chỉ 1 tép. Tỏi cô đơn Lý Sơn là một sản phẩm độc đáo và đặc biệt của quần đảo Lý Sơn, nằm ở tỉnh Quảng Ngãi, Việt Nam. Tỏi cô đơn Lý Sơn được tạo ra từ cây tỏi biển (Allium sativum var. ophioscorodon) mà chỉ có thể phát triển trên đảo này. Dưới đây là một số thông tin chi tiết về tỏi cô đơn Lý Sơn\r\n                        ', 255, 1200000, 1000000, 'uploads/654749fca69a1toi-co-don-1.png', 4, 5, 'Active', NULL, NULL),
(26, 'Tỏi đen cô đơn Lý Sơn', 't-i-en-c-n-l-s-n', '. Xuất Xứ và Đặc Điểm:\r\nTỏi cô đơn Lý Sơn được trồng trên đảo Lý Sơn, nơi có điều kiện địa lý và hải sản độc đáo. Loại tỏi này thường có màu trắng bạc và cảm giác mặn, thơm và cay hơn so với tỏi truyền thống.\r\n\r\n2. Phương Pháp Trồng và Chế Biến:\r\nTỏi cô đơn Lý Sơn thường được trồng mùa Đông và thu hoạch vào mùa Hè. Cây tỏi trồng trên đất cát cỏ và dùng một hệ thống tưới tiêu tự động để đảm bảo rễ cây được cung cấp đủ nước. Sau đó, tỏi được chế biến và ngâm chua trong nước biển khoảng một tháng trước khi sấy khô.\r\n\r\n3. Hương Vị Độc Đáo:\r\nTỏi cô đơn Lý Sơn có hương vị đặc biệt, mặn mà, và cay nồng, với mùi thơm riêng biệt mà bạn khó có thể tìm thấy ở bất kỳ nơi nào khác. Hương vị này đã khiến cho tỏi cô đơn Lý Sơn trở thành một sản phẩm thú vị và độc đáo trong ẩm thực.\r\n\r\n4. Sử Dụng và Giá Trị Y Học:\r\nTỏi cô đơn Lý Sơn thường được sử dụng làm gia vị trong nhiều món ăn Việt Nam. Ngoài ra, nó cũng được coi là một loại thảo dược quý trong y học truyền thống và được sử dụng để điều trị một loạt tình trạng sức khỏe.\r\n\r\n5. Văn Hóa và Du Lịch:\r\nTỏi cô đơn Lý Sơn đã trở thành một phần của văn hóa và di sản của người dân Lý Sơn. Đảo này cũng là một điểm đến du lịch phổ biến cho những người muốn thưởng thức không chỉ vị ngon của tỏi cô đơn mà còn vẻ đẹp của biển cả và cuộc sống đảo ngọc.\r\n\r\nTỏi cô đơn Lý Sơn là một sản phẩm độc đáo của Việt Nam, đặc biệt với hương vị thơm và giá trị y học. Nó đã trở thành một biểu tượng của quần đảo Lý Sơn và được người dân địa phương tự hào bảo vệ và duy trì\r\n                        ', 'Đây là giống tỏi cô đơn được chế biến thành tỏi đen. Tỏi này có nhiều tác dụng đối với sức khỏe người tiêu dùng, được ưa chuộng trong và ngoài nước.\r\n                        ', 255, 9999999, 8000000, 'uploads/65474a60e573btoi-den-co-don.png;uploads/65474a60e62f5toi-den-co-don-ly-son-2.png', 4, 5, 'Active', NULL, NULL),
(27, 'Tỏi Lý Sơn nhiều tép', 't-i-l-s-n-nhi-u-t-p', '    Tỏi Lý Sơn nhiều nhánh có cấu trúc cụm nhiều nhánh, khác biệt hoàn toàn so với tỏi truyền thống, mà thông thường chỉ có một củ tỏi mỗi cây.\r\n    Mỗi nhánh tỏi Lý Sơn nhiều nhánh có thể chứa nhiều củ tỏi nhỏ, tạo ra một hình ảnh độc đáo và thú vị.\r\n\r\n2. Xuất Xứ và Khái Quát:\r\n\r\n    Tỏi Lý Sơn nhiều nhánh là sản phẩm độc quyền của quần đảo Lý Sơn, một đảo biển nằm ngoài khơi Biển Đông.\r\n    Đảo này có điều kiện địa lý và hải sản độc đáo, tạo ra môi trường lý tưởng cho sự phát triển của loại tỏi đặc biệt này.\r\n\r\n3. Hương Vị Đặc Biệt:\r\n\r\n    Tỏi Lý Sơn nhiều nhánh có hương vị đặc biệt, mặn mà, thơm ngon, và độc đáo. Hương thơm của nó được cho là khác biệt và đặc biệt so với tỏi truyền thống.\r\n\r\n4. Sử Dụng Ẩm Thực:\r\n\r\n    Tỏi Lý Sơn nhiều nhánh thường được sử dụng trong nấu ăn và gia vị các món ăn, tương tự như tỏi truyền thống.\r\n    Mặc dù có thể sử dụng như tỏi thường, sự độc đáo và hình dáng của tỏi Lý Sơn nhiều nhánh đã khiến cho nó trở thành một sản phẩm ẩm thực thú vị và độc đáo trong bữa ăn.\r\n                        ', 'Đây là giống tỏi nhiều tép nhỏ, phổ biến và phổ dụng tại Lý Sơn nói riêng và Quảng Ngãi nói chung.\r\n                       ', 255, 80000, 75000, 'uploads/65474ac7a29e9toi-ly-son.png', 4, 5, 'Active', NULL, NULL),
(28, 'Tỏi lý sơn nhiều tép bóc vỏ', 't-i-l-s-n-nhi-u-t-p-b-c-v-', 'Đây là sản phẩm tỏi nhiều nhánh được chế biến, bóc vỏ giúp người dùng giảm công sức và thời gian trong việc chế biến.\r\n                        ', 'Tỏi bóc vỏ giúp giảm công sức trong việc chế biến mà vẫn đảm bảo hương vị của tỏi Lý Sơn nổi tiếng.\r\n                        ', 255, 125000, 120000, 'uploads/65474b330c4c6toi-ly-son-boc-vo.png;uploads/65474b330d58atoi-ly-son-boc-vo-2.png', 4, 5, 'Active', NULL, NULL),
(29, 'Cá bống sông Trà', 'c-b-ng-s-ng-tr-', 'Đây là món ăn đặc trưng, cá bống được đánh bắt ở sông về làm sạch và rim sau đó cho vào hộp để bán làm quà. Có nhiều loại cá bống như cá bống cát, cá bống tượng... \r\n                        ', 'Cá bống sông Trà là món ăn đặc trưng hay được sử dụng làm quà khi khách ghé thăm Quảng Ngãi.', 255, 99999, 99900, 'uploads/6547a7198a1f4ca_bong_song_tra.png', 3, 5, 'Active', NULL, NULL),
(30, 'Rau cau - chân vịt', 'rau-cau---ch-n-v-t', '\r\nsf\r\n3	3	4	5\r\n 	 	 	 \r\n5	 	5	 \r\n 	5	 	 \r\n 	5	 	5\r\n\r\n \r\ndfsdff\r\n\r\nsdfsf\r\n\r\nsdfsd\r\n\r\n    Con gì thế\r\n\r\n', 'Racc ff ', 3, 300, 300, 'uploads/654cb196e540arau-cau.png', 2, 5, 'Active', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Active','Inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `phone`, `address`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Bùi Công Thành', 'admin@gmail.com', '2023-10-17 01:30:09', '123456', NULL, '', '', 'Active', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `brands_slug_unique` (`slug`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newscategories`
--
ALTER TABLE `newscategories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_details_order_id_foreign` (`order_id`),
  ADD KEY `order_details_product_id_foreign` (`product_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_brand_id_foreign` (`brand_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_user_id_foreign` (`user_id`),
  ADD KEY `reviews_product_id_foreign` (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `newscategories`
--
ALTER TABLE `newscategories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`),
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
