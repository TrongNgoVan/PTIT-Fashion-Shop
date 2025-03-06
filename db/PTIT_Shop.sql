-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th3 06, 2025 lúc 10:51 AM
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
(6, '20 Cách phối màu quần áo nam, nữ theo nguyên tắc bảng màu', 'uploads/news/67c030a76238bScreenshot 2025-02-27 162950.png', '20-c-ch-ph-i-m-u-qu-n-o-nam-n-theo-nguy-n-t-c-b-ng-m-u', '                                                Bạn sẽ mất bao lâu vào buổi sáng để chọn một bộ trang phục phù hợp với phong cách của mình để đón ngày mới? Nếu bạn đang băn khoăn không biết phối màu như thế nào để set đồ của mình hài hòa và ấn tượng thì hãy tham khảo ngay những cách phối màu quần áo dưới đây nhé!                                                ', '                                                Bánh xe màu sắc là gì?\r\nBánh xe màu sắc là một vòng tròn mô tả mối liên kết rõ ràng nhất giữa các màu cấp 1 (màu cơ bản), màu cấp 2 và cấp 3. \r\n\r\nVòng tròn màu được tạo thành từ 12 màu cơ bản. Nếu kết hợp bất kỳ hai màu nào trong số chúng sẽ tạo ra một màu mới. Đây là điểm xuất phát cho việc tạo ra tất cả các màu bổ sung.\r\n\r\nBánh xe màu gồm 12 ô màu, với mỗi ô vuông đại diện cho một màu cơ bản và được chia thành các nan đều nhau. Mỗi vòng cung màu có 8 cấp độ màu từ đậm đến nhạt.\r\nCấu tạo của bánh xe màu sắc\r\nMàu cơ bản (màu cấp 1)\r\nĐỏ, vàng và xanh (xanh dương) là những màu cơ bản. Đây là ba màu cơ bản tạo nên tất cả các màu hiện nay. Chúng được “trộn” với nhau theo một tỷ lệ nhất định để tạo ra các màu sắc khác. Đây cũng được coi là ba tông màu “dữ dội” nhất và đáng chú ý nhất, khó pha trộn và khó kết hợp với các tông màu khác.\r\nMàu cấp 2\r\nMàu cấp 2 bao gồm 3 màu: Cam, Xanh lá và Tím. Màu phụ được tạo ra bằng cách kết hợp hai màu cơ bản (màu cấp 1) theo đúng tỷ lệ: màu cam là sự kết hợp giữa màu đỏ và vàng, màu tím là sự kết hợp giữa màu xanh lam và màu đỏ, còn màu xanh lá cây là từ màu xanh lam và màu vàng. Các màu cấp 2 do là sự pha trộn nên sắc độ của chúng nhẹ nhàng hơn. \r\n\r\nMàu cấp 3\r\nBánh xe màu sắc có sáu màu cấp 3: Cam vàng, cam đỏ, Tím đỏ, Tím lam, Lục vàng và cuối cùng là lục lam. \r\n\r\nMàu cấp 3 được tạo ra bằng cách kết hợp màu cấp 1 với màu cấp 2 với tỷ lệ 1:1. Màu thứ ba, giống như màu thứ cấp, được xen kẽ giữa các màu, do đó độ lệch nhẹ hơn đáng kể.                                                ', 4, '2025-02-24 03:44:10', '2025-02-24 03:56:20'),
(7, 'Chương trình khuyến mãi tháng 2 – Valentine ngọt ngào 💖', 'uploads/news/67c3a796827f5Screenshot 2025-03-02 073240.png', 'ch-ng-tr-nh-khuy-n-m-i-th-ng-2-valentine-ng-t-ng-o-', '                        Giảm 14% cho đơn hàng từ 200K vào ngày 14/02                        ', '                        🌹 Thời gian áp dụng: 01/02 - 14/02\r\n🎁 Áp dụng cho tất cả khách hàng\r\n\r\n🎀 ƯU ĐÃI ĐẶC BIỆT CHO CẶP ĐÔI\r\n❤️ Mua 1 tặng 1 cho các sản phẩm đôi (áo đôi, cốc đôi, trang sức đôi, v.v.)\r\n💑 Giảm 14% cho đơn hàng từ 214K vào ngày 14/02\r\n\r\n💝 QUÀ TẶNG YÊU THƯƠNG\r\n🎁 Đơn hàng từ 500K: Tặng thiệp Valentine kèm lời nhắn miễn phí\r\n🎁 Đơn hàng từ 1 triệu: Nhận ngay hộp socola cao cấp\r\n\r\n🚚 MIỄN PHÍ VẬN CHUYỂN\r\n🚀 Freeship toàn quốc cho đơn hàng từ 200K\r\n\r\n🔥 Lưu ý: Chương trình có thể kết thúc sớm nếu số lượng quà tặng và ưu đãi hết hạn.\r\n\r\n💌 Nhanh tay đặt hàng ngay để chuẩn bị món quà hoàn hảo cho người thương!                        ', 1, '2025-02-24 03:44:10', '2025-02-24 03:57:10'),
(8, 'Chương Trình Khuyến Mãi Tháng 4 - Rộn Ràng Đón Hè, Ưu Đãi Cực Đã! ☀️', 'uploads/news/67c3a6b081cd7Screenshot 2025-03-02 072901.png', 'ch-ng-tr-nh-khuy-n-m-i-th-ng-4---r-n-r-ng-n-h-u-i-c-c-', '                                                                        Giảm đến 60% cho mỗi đơn hàng\r\n                                                                                                                                                                                                ', '                                                Thời gian áp dụng: 01/04 - 30/04\r\n\r\nTháng 4 về mang theo những chương trình ưu đãi siêu khủng! Cơ hội tuyệt vời để bạn sắm sửa cho mùa hè sôi động với giá cực sốc!\r\n\r\n🔥 Chương trình ưu đãi tháng 4:\r\n✅ Flash Sale mỗi ngày - Giảm đến 60% từ 12h - 14h.\r\n✅ Nhập mã \"HE2024\" giảm 15% cho đơn hàng từ 400K.\r\n✅ Mua combo - giá hời: Combo 2 sản phẩm giảm thêm 10%.\r\n✅ Tặng quà giá trị cho 100 khách hàng đầu tiên mỗi tuần.\r\n\r\n💥 Ưu đãi đặc biệt dịp 30/4 - 1/5:\r\n🎁 Quay số trúng thưởng với hóa đơn từ 1 triệu đồng.\r\n🚚 Miễn phí vận chuyển toàn quốc không giới hạn giá trị đơn hàng!\r\n\r\n📌 Mua sắm ngay tại [Tên Shop] để không bỏ lỡ các ưu đãi HOT nhất tháng 4!                                                ', 1, '2025-02-24 03:44:10', '2025-02-24 03:57:55'),
(9, 'Bộ sưu tập mới dành cho sinh viên – Đẹp, chất, giá sinh viên! 🎉', 'uploads/news/67c3a9588c6f0Screenshot 2025-03-02 074148.png', 'b-s-u-t-p-m-i-d-nh-cho-sinh-vi-n-p-ch-t-gi-sinh-vi-n-', '                        Phong cách trẻ trung, năng động, phù hợp cho mọi hoàn cảnh – từ đi học, đi chơi đến dạo phố.                        ', '👕 1. Áo thun basic – Must-have item!\r\n✔ Form rộng thoải mái, chất liệu cotton thoáng mát.\r\n✔ Đa dạng màu sắc dễ phối đồ, phù hợp mọi phong cách.\r\n✔ Mix & match cực dễ với quần jeans, quần jogger hay chân váy.\r\n\r\n🧥 2. Áo khoác trendy – Thời trang & tiện lợi\r\n✔ Áo khoác gió, hoodie, cardigan… vừa giữ ấm, vừa nâng tầm phong cách.\r\n✔ Thiết kế trẻ trung, phù hợp cả nam và nữ.\r\n✔ Có túi rộng đựng điện thoại, ví tiền tiện lợi.\r\n\r\n👖 3. Quần jeans, jogger – Cá tính & năng động\r\n✔ Quần jeans baggy, ống rộng, skinny phù hợp mọi dáng người.\r\n✔ Quần jogger thoải mái, dễ phối đồ, chuẩn style sinh viên.\r\n✔ Chất vải bền đẹp, mặc lâu không sờn, không bai nhão.\r\n\r\n🎀 4. Phụ kiện thời trang – Hoàn thiện outfit\r\n✔ Mũ lưỡi trai, túi tote, vớ cao cổ… giúp outfit thêm nổi bật.\r\n✔ Giá siêu mềm, dễ dàng sắm ngay mà không cần đắn đo.\r\n✔ Mẫu mã hot trend, theo kịp xu hướng.\r\n\r\n🔥 Ưu đãi đặc biệt dành cho sinh viên:\r\n✅ Giảm ngay 10% khi nhập mã STUDENT10.\r\n✅ Freeship toàn quốc cho đơn hàng từ 300K.\r\n✅ Mua ngay - Nhận quà hấp dẫn (Áp dụng cho 100 đơn hàng đầu tiên).\r\n\r\n📌 Sắm ngay hôm nay để không bỏ lỡ những item hot nhất mùa này! 🚀', 3, '2025-02-24 03:44:10', '2025-02-24 03:44:39'),
(10, 'Chương Trình Khuyến Mãi Tháng 3- Mua Sắm Tưng Bừng, Nhận Ngàn Ưu Đãi! 🎉', 'uploads/news/67c3a69f55c9eScreenshot 2025-03-02 073007.png', 'ch-ng-tr-nh-khuy-n-m-i-th-ng-3--mua-s-m-t-ng-b-ng-nh-n-ng-n-u-i-', '                                                       Giảm giá đến 50% cho hàng trăm sản phẩm hot.                                    ', '                                                Chào tháng 3 với hàng loạt ưu đãi siêu hấp dẫn! Đừng bỏ lỡ cơ hội mua sắm tiết kiệm và nhận nhiều quà tặng giá trị.\r\n  Thời gian áp dụng: 01/03 - 31/03   \r\n🔥 Ưu đãi HOT trong tháng 3:\r\n✅ Giảm giá đến 50% cho hàng trăm sản phẩm hot.\r\n✅ Mua 1 tặng 1 áp dụng cho các sản phẩm thời trang, phụ kiện.\r\n✅ Tặng voucher 100K khi đơn hàng từ 500K.\r\n✅ Freeship toàn quốc cho đơn từ 299K.\r\n\r\n💥 Ưu đãi đặc biệt vào ngày 8/3:\r\n🎁 Quà tặng đặc biệt cho khách hàng nữ khi mua sắm trong ngày Quốc tế Phụ nữ.\r\n💳 Tặng mã giảm 10% cho đơn hàng từ 300K trở lên.\r\n\r\n📌 Nhanh tay săn deal ngay tại [Tên Shop] để không bỏ lỡ!                                                ', 1, '2025-02-24 03:44:10', '2025-02-24 03:44:49'),
(11, 'Mẹo chọn sản phẩm thời trang cho sinh viên – Đẹp, tiện lợi, tiết kiệm! 💡', 'uploads/news/67c3aa8a75f2cScreenshot 2025-03-02 074655.png', 'm-o-ch-n-s-n-ph-m-th-i-trang-cho-sinh-vi-n-p-ti-n-l-i-ti-t-ki-m-', 'mẹo chọn đồ giúp bạn luôn tự tin với phong cách của mình mà không tốn quá nhiều chi phí!', '👕 1. Ưu tiên những món đồ basic – Dễ phối, không lỗi mốt\r\n🔹 Áo thun trơn, sơ mi đơn giản, quần jeans luôn là lựa chọn hàng đầu.\r\n🔹 Những item này dễ phối với mọi phong cách, giúp bạn tiết kiệm khi không cần mua quá nhiều đồ.\r\n🔹 Màu sắc trung tính như trắng, đen, xám, xanh navy rất dễ kết hợp với các món đồ khác.\r\n\r\n🎯 2. Chọn đồ theo mục đích sử dụng – Không mua theo cảm hứng\r\n🔹 Đừng mua chỉ vì thấy đẹp, hãy cân nhắc xem nó có phù hợp với nhu cầu hàng ngày không.\r\n🔹 Đi học: Ưu tiên áo thun, quần jeans, balo tiện dụng.\r\n🔹 Đi chơi, đi làm thêm: Sơ mi, áo khoác nhẹ, quần âu giúp bạn trông chỉn chu hơn.\r\n🔹 Tập thể dục: Chọn đồ thể thao co giãn, thoải mái để dễ vận động.\r\n\r\n🛍 3. Mua đồ theo set – Tiết kiệm & dễ phối hơn\r\n🔹 Mua một bộ trang phục đã được phối sẵn giúp bạn tiết kiệm thời gian suy nghĩ.\r\n🔹 Set đồ thường có giá tốt hơn so với mua lẻ từng món.\r\n🔹 Có thể kết hợp chéo giữa các set để tạo ra nhiều outfit khác nhau.\r\n\r\n💰 4. Cân đối ngân sách – Không cần đồ đắt, chỉ cần phù hợp\r\n🔹 Hãy đặt ngân sách cụ thể cho việc mua sắm, tránh chi tiêu quá tay.\r\n🔹 Tận dụng các chương trình giảm giá, ưu đãi sinh viên để mua được đồ chất lượng với giá rẻ hơn.\r\n🔹 Đầu tư vào những món đồ chất lượng tốt thay vì mua nhiều đồ rẻ nhưng nhanh hỏng.\r\n\r\n🎀 5. Đừng quên phụ kiện – Điểm nhấn cho outfit\r\n🔹 Một chiếc túi tote, mũ lưỡi trai, đồng hồ đơn giản có thể giúp bạn trông phong cách hơn.\r\n🔹 Giày sneaker trắng, giày lười hoặc sandal là những lựa chọn phù hợp cho sinh viên vì dễ phối đồ và thoải mái.\r\n🔹 Chỉ cần một vài món phụ kiện nhỏ, bạn có thể biến đổi hoàn toàn set đồ của mình.\r\n\r\n🔥 Tóm lại: Hãy chọn đồ đơn giản, dễ phối, phù hợp với mục đích sử dụng, cân đối ngân sách và tận dụng ưu đãi để mua được những sản phẩm thời trang đẹp – tiện lợi – tiết kiệm nhất!\r\n\r\n📌 Áp dụng ngay những mẹo này để có tủ đồ chuẩn sinh viên mà vẫn chất lừ nhé! 🚀', 4, '2025-02-24 03:44:10', '2025-02-24 03:45:01'),
(12, 'Bộ sưu tập mới: Thời trang cho sinh viên đi làm – Thanh lịch & năng động! ✨', 'uploads/news/67c3ab429b7abScreenshot 2025-03-02 074957.png', 'b-s-u-t-p-m-i-th-i-trang-cho-sinh-vi-n-i-l-m-thanh-l-ch-n-ng-ng-', 'Bộ sưu tập mới lần này mang đến những item phù hợp cho môi trường làm việc mà vẫn giúp bạn tự tin thể hiện phong cách! ', '👔 1. Sơ mi thanh lịch – Lịch sự nhưng không cứng nhắc\r\n✔ Chất vải cotton thoáng mát, không nhăn, phù hợp mặc cả ngày dài.\r\n✔ Thiết kế basic, dễ phối với quần jeans, quần tây hoặc chân váy.\r\n✔ Màu sắc nhã nhặn như trắng, xanh pastel, be giúp tạo cảm giác chuyên nghiệp.\r\n\r\n🧥 2. Blazer nhẹ – Nâng tầm phong cách\r\n✔ Không quá cứng nhắc như vest, blazer form rộng mang đến vẻ ngoài thanh lịch nhưng vẫn trẻ trung.\r\n✔ Phối dễ dàng với áo thun, sơ mi, hoặc váy để phù hợp mọi hoàn cảnh.\r\n✔ Chất vải nhẹ, dễ mặc, không tạo cảm giác gò bó khi di chuyển.\r\n\r\n👖 3. Quần âu & quần kaki – Thoải mái nhưng vẫn chuyên nghiệp\r\n✔ Quần ống suông, quần baggy giúp che khuyết điểm và tạo cảm giác thon gọn.\r\n✔ Chất vải mềm, co giãn nhẹ, phù hợp để di chuyển cả ngày mà không gây khó chịu.\r\n✔ Dễ phối với giày sneaker hoặc giày lười để tạo vẻ ngoài năng động.\r\n\r\n🎀 4. Phụ kiện tinh tế – Hoàn thiện diện mạo\r\n✔ Túi tote hoặc túi xách nhỏ gọn, tiện dụng cho laptop & tài liệu.\r\n✔ Đồng hồ tối giản giúp tăng thêm nét thanh lịch, chuyên nghiệp.\r\n✔ Giày loafer, giày mules hoặc sneaker trắng giúp outfit trở nên trẻ trung hơn.\r\n\r\n🔥 Ưu đãi đặc biệt dành cho sinh viên đi làm:\r\n✅ Giảm ngay 10% khi nhập mã WORK10.\r\n✅ Freeship toàn quốc cho đơn hàng từ 300K.\r\n✅ Mua ngay - Nhận quà hấp dẫn (Áp dụng cho 100 đơn hàng đầu tiên).\r\n\r\n📌 Sẵn sàng để tự tin đi làm với diện mạo hoàn hảo? Cập nhật ngay tủ đồ của bạn với bộ sưu tập mới này nhé! 🚀', 3, '2025-02-24 03:44:10', '2025-02-24 03:45:12');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `newscategories`
--

INSERT INTO `newscategories` (`id`, `name`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Danh mục A', 'danh-m-c-a', 'Active', NULL, NULL),
(3, 'Danh mục B', 'danh-m-c-b', 'Active', NULL, NULL),
(4, 'Danh mục C', 'danh-m-c-c', 'Active', NULL, NULL);

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
  `transport` enum('Vận Chuyển Thường','Vận Chuyển Hỏa Tốc') NOT NULL DEFAULT 'Vận Chuyển Thường',
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
(18, 1, 'Phạm Thị Nga', 'Số nhà 22 Thôn Ngọ Hạ, Thăng Bình, Nông Cống, Thanh Hóa', '090708498', 'vantrongngo1607@gmail.com', 'Processing', '2025-02-24 18:23:47', '2025-02-24 18:23:47', 200000, 'Vận Chuyển Thường', 'Thanh toán khi nhận hàng', 'Chưa thanh toán'),
(19, 1, 'Trịnh Tuấn', 'Số nhà 22 Thôn Ngọ Hạ, Thăng Bình, Nông Cống, Thanh Hóa', '0352987324', 'vantrongngo1607@gmail.com', 'Processing', '2025-02-28 19:16:36', '2025-02-28 19:16:36', 988888, 'Vận Chuyển Thường', 'Thanh toán khi nhận hàng', 'Chưa thanh toán'),
(20, 1, 'Ngọ Văn Trọng', 'Số nhà 22 Thôn Ngọ Hạ, Thăng Bình, Nông Cống, Thanh Hóa', '0352987324', 'vantrongngo1607@gmail.com', 'Confirmed', '2025-03-06 08:26:05', '2025-03-06 08:26:05', 1395000, 'Vận Chuyển Thường', 'Thanh toán khi nhận hàng', 'Chưa thanh toán');

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
(14, 18, 23, 100000, 2, 200000, '2025-02-24 18:23:47', '2025-02-24 18:23:47'),
(15, 19, 23, 100000, 1, 100000, '2025-02-28 19:16:36', '2025-02-28 19:16:36'),
(16, 19, 21, 888888, 1, 888888, '2025-02-28 19:16:36', '2025-02-28 19:16:36'),
(17, 20, 25, 1000000, 1, 1000000, '2025-03-06 08:26:05', '2025-03-06 08:26:05'),
(18, 20, 20, 35000, 1, 35000, '2025-03-06 08:26:05', '2025-03-06 08:26:05'),
(19, 20, 28, 120000, 3, 360000, '2025-03-06 08:26:05', '2025-03-06 08:26:05');

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
  `slug` varchar(255) NOT NULL,
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

INSERT INTO `products` (`id`, `name`, `slug`, `description`, `summary`, `stock`, `unit`, `price`, `disscounted_price`, `images`, `category_id`, `brand_id`, `status`, `created_at`, `updated_at`) VALUES
(12, 'Áo sơ mi trắng', '-o-s-mi-tr-ng', 'Chất liệu: Cotton 100%\r\nSize: 31-32-33\r\nCân nặng phù hợp: 55 - 60 - 65 kg\r\nChiều cao: 1m60 - 1m65 - 1m70\r\n', '    Áo sơ mi trắng dài tay cổ cao chất liệu mềm mịn, thoáng mát', 255, 'chục', 35000, 30000, 'uploads/67bb82d37f45b.jpg;uploads/67bb82d380827.jpg;uploads/67bb82d381018.jpg', 1, 5, 'Active', NULL, NULL),
(13, 'Áo Sơ mi kẻ sọc cộc tay', '-o-s-mi-k-s-c-c-c-tay', 'Chất liệu : Cotton 50%, Lụa 50%\r\nSize: 35-36-37', 'Áo Sơ mi kẻ sọc cộc tay chất liệu thoáng mát', 255, 'kí', 50000, 45000, 'uploads/67bb8556e34d6coctay.jpg', 1, 5, 'Active', NULL, NULL),
(14, 'Áo Sơ mi', '-o-s-mi', 'Chất liệu Thư giãn', 'Áo sơ mi thoáng mát dành cho nam và nữ đều mặc được', 255, 'kí', 60000, 50000, 'uploads/67bb85dca3401somi.jpg', 1, 5, 'Active', NULL, NULL),
(15, 'Quần bò ống suông', 'qu-n-b-ng-su-ng', '', '', 255, 'kí', 30000, 28000, 'uploads/67bb8658b18b0bo.jpg', 4, 5, 'Active', NULL, NULL),
(16, 'Áo gió mỏng', '-o-gi-m-ng', '', '', 255, 'kí', 129999, 99000, 'uploads/67bb863b411f2gio.jpg', 6, 5, 'Active', NULL, NULL),
(17, 'Áo sơ mi PTIT', '-o-s-mi-ptit', '', '', 255, 'kí', 129000, 12000, 'uploads/67bb86cc90081c4.jpg', 1, 5, 'Active', NULL, NULL),
(18, 'Áo sơ mi vải lụa ', '-o-s-mi-v-i-l-a-', '                        Đường Phèn Quảng Ngãi - Hương Vị Độc Đáo từ Miền Trung\r\n\r\nMiền Trung Việt Nam nổi tiếng với văn hóa ẩm thực đa dạng và độc đáo. \"Đường Phèn Quảng Ngãi\" là một món đặc sản truyền thống từ vùng đất Quảng Ngãi, nổi bật với hương vị độc đáo và giá trị lịch sử.\r\n\r\nĐặc Điểm Của Đường Phèn Quảng Ngãi:\r\n\r\n    Nguyên Liệu Chất Lượng: Đường Phèn Quảng Ngãi được sản xuất từ mía tươi, đường và nước cốt nước mía. Sự tươi mát và chất lượng của nguyên liệu là một trong những yếu tố quan trọng tạo nên hương vị đặc biệt của sản phẩm.\r\n\r\n    Cách Chế Biến Truyền Thống: Sản phẩm này thường được sản xuất bằng phương pháp thủ công truyền thống. Quá trình nấu đường phèn đòi hỏi sự khéo léo và kỹ thuật của người làm đường, đảm bảo hương vị và chất lượng tốt nhất.\r\n\r\n    Hương Vị Đặc Biệt: Đường Phèn Quảng Ngãi có hương vị độc đáo với vị ngọt tự nhiên từ đường và nước mía. Sự kết hợp này tạo nên một hương vị đặc biệt, không giống bất kỳ sản phẩm đường nào khác.\r\n\r\n    Sử Dụng Đa Dạng: Đường Phèn Quảng Ngãi có thể được sử dụng trong nhiều món ăn và đồ uống như trà, café, bánh ngọt, và nhiều món ăn khác. Sự đa dạng này tạo ra nhiều cơ hội để thưởng thức hương vị đặc biệt của đường phèn.\r\n\r\n    Giá Trị Lịch Sử và Văn Hóa: Đường Phèn Quảng Ngãi không chỉ là một sản phẩm ẩm thực mà còn có giá trị lịch sử và văn hóa lớn. Nó đã tồn tại và được sản xuất theo cách truyền thống trong nhiều thế hệ và là một phần không thể thiếu của văn hóa ẩm thực của Quảng Ngãi.\r\n\r\nThưởng Thức Đường Phèn Quảng Ngãi:\r\n\r\nĐường Phèn Quảng Ngãi là một sản phẩm đặc biệt và độc đáo của vùng đất Trung Việt. Hương vị đặc biệt và giá trị lịch sử của sản phẩm này làm cho nó trở thành một phần không thể thiếu của ẩm thực và văn hóa ẩm thực Quảng Ngãi. Hãy thưởng thức hương vị ngọt ngào của Đường Phèn Quảng Ngãi và khám phá sự đặc biệt của sản phẩm này, một phần không thể thiếu của hậu quảng đại của miền Trung.\r\n                                                ', '                        Đường Phèn Quảng Ngãi là một món đặc sản truyền thống có hương vị độc đáo từ vùng đất Quảng Ngãi, miền Trung Việt Nam. Hãy khám phá sự đặc biệt và giá trị của sản phẩm này trong bài viết dưới đây.\r\n                                                ', 255, 'kí', 87000, 80000, 'uploads/67bb86aa5625fquanau.jpg', 1, 5, 'Active', NULL, NULL),
(19, 'Áo Phao Dày dặn ', '-o-phao-d-y-d-n-', '', '', 255, 'kí', 90000, 80000, 'uploads/67bb8804339bdgio.jpg', 6, 5, 'Active', NULL, NULL),
(20, 'Quản tây lịch lãm ống rộng', 'qu-n-t-y-l-ch-l-m-ng-r-ng', '', '', 255, 'túi', 90000, 35000, 'uploads/67bb8827474b5quanau.jpg', 2, 5, 'Active', NULL, NULL),
(21, 'Áo Hoodie lông chuột ấm áp', '-o-hoodie-l-ng-chu-t-m-p', '                        Mạch nha là món ăn được làm nhiều tại huyện Mộ Đức, phía nam tỉnh Quảng Ngãi. Thích hợp ăn với bánh tráng vào những buổi trưa hay chiều. Ngoài ra mạch nha còn dùng làm nguyên liệu cho các thức ăn như ..\r\n                                                ', '                        Được làm từ lúa non, với vị ngọt và thơm của lúa, không làm từ đường\r\n                                                ', 255, 'lon', 8888888, 888888, 'uploads/67bb885047899hodi.jpg', 9, 5, 'Active', NULL, NULL),
(22, 'Áo Polo Bưu Chính', '-o-polo-b-u-ch-nh', '', '', 255, 'lít', 999999, 90000, 'uploads/67bb87c2d96bbpolo.jpg', 3, 5, 'Active', NULL, NULL),
(23, 'Áo Varsity Bưu Chính', '-o-varsity-b-u-ch-nh', '', '', 255, 'lít', 120000, 100000, 'uploads/67bb87e5653a3c3.jpg', 5, 5, 'Active', NULL, NULL),
(24, 'Quần jean Nam Nữ', 'qu-n-jean-nam-n-', '', '\r\n                                                ', 255, 'lạng', 90000, 80000, 'uploads/67bb860d57fc5bo.jpg', 4, 5, 'Active', NULL, NULL),
(25, 'Áo Bomber PTIT', '-o-bomber-ptit', '', '', 255, 'kí', 1200000, 1000000, 'uploads/67bb877e5a7c5c2.jpg', 5, 5, 'Active', NULL, NULL),
(26, 'Áo Hoodie Form rộng', '-o-hoodie-form-r-ng', '', '', 255, 'kí', 9999999, 8000000, 'uploads/67bb875ddfd12hodi.jpg', 9, 5, 'Active', NULL, NULL),
(27, 'Quần bò ống loe', 'qu-n-b-ng-loe', '\r\n                                                ', '', 255, 'kí', 80000, 75000, 'uploads/67bb87248d049bo.jpg', 4, 5, 'Active', NULL, NULL),
(28, 'Áo Jacket PTIT', '-o-jacket-ptit', '', '', 255, 'kí', 125000, 120000, 'uploads/67bb86fe106a0c1.jpg', 5, 5, 'Active', NULL, NULL),
(29, 'Áo Polo PTIT', '-o-polo-ptit', '', '', 255, 'kí', 99999, 99900, 'uploads/67bb8626e8fa9polo.jpg', 3, 5, 'Active', NULL, NULL),
(30, 'Quần Âu form Regular', 'qu-n-u-form-regular', '', '', 3, 'kí', 300, 300, 'uploads/67bb87a345754quanau.jpg', 2, 5, 'Active', NULL, NULL);

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
(4, 1, 25, 'không còn gì để bàn cãi, đúng chất hoàng gia', 5, '2025-02-24 04:49:48', NULL),
(5, 0, 0, 'oke', 4, '2025-02-27 18:10:21', NULL),
(6, 1, 25, 'oke đấy', 4, '2025-02-27 18:12:10', NULL),
(7, 1, 21, 'đẹp đó', 4, '2025-02-27 18:15:37', NULL),
(8, 1, 21, 'đẹp đó', 4, '2025-02-27 18:16:26', NULL),
(9, 1, 21, 'tuyệt', 5, '2025-02-27 18:16:57', NULL),
(10, 1, 20, 'uầy áo đẹp vãi chưởng', 1, '2025-02-27 18:19:05', NULL),
(11, 1, 20, 'sao lại có cái áo đép thế này', 3, '2025-02-27 18:21:35', NULL),
(15, 1, 23, 'tuyệt', 5, '2025-02-27 19:13:28', NULL),
(17, 1, 23, 'TẠM', 3, '2025-02-27 19:28:52', NULL),
(18, 1, 25, 'được', 4, '2025-02-28 08:37:59', NULL),
(19, 1, 23, 'hi', 4, '2025-02-28 20:48:38', NULL),
(20, 1, 23, 'bực', 1, '2025-02-28 20:50:09', NULL);

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
(4, 'Tạ Kiều Yến', 'tkyen@gmail.com', '123', '0234567123', 'Hà Đông, Hà Nội', 'img/icon-account.png', NULL, 'Active'),
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
  ADD UNIQUE KEY `products_slug_unique` (`slug`),
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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT cho bảng `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

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
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`),
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
