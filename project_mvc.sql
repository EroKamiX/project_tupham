-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 13, 2020 at 05:01 AM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_mvc`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL COMMENT 'Tên danh mục',
  `avatar` varchar(255) DEFAULT NULL COMMENT 'Tên file ảnh danh mục',
  `description` text DEFAULT NULL COMMENT 'Mô tả chi tiết cho danh mục',
  `status` tinyint(3) DEFAULT 0 COMMENT 'Trạng thái danh mục: 0 - Inactive, 1 - Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Ngày tạo danh mục',
  `updated_at` datetime DEFAULT NULL COMMENT 'Ngày cập nhật cuối'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `avatar`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'ĐIỆN THOẠI', '1594520678-pngtree-smartphone-icon-png-image_1003223.jpg', '', 0, '2020-07-12 02:24:38', '2020-07-12 10:36:45'),
(2, 'TABLET', '1594521282-31138.png', '', 0, '2020-07-12 02:34:32', '2020-07-12 09:59:34'),
(3, 'PHỤ KIỆN', '1594521597-e12156a72f9dc711a27c96ab6ee96298.png', '', 0, '2020-07-12 02:39:57', '2020-07-12 09:43:14');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL COMMENT 'Id của user trong trường hợp đã login và đặt hàng, là khóa ngoại liên kết với bảng users',
  `fullname` varchar(255) DEFAULT NULL COMMENT 'Tên khách hàng',
  `address` varchar(255) DEFAULT NULL COMMENT 'Địa chỉ khách hàng',
  `mobile` int(11) DEFAULT NULL COMMENT 'SĐT khách hàng',
  `email` varchar(255) DEFAULT NULL COMMENT 'Email khách hàng',
  `note` text DEFAULT NULL COMMENT 'Ghi chú từ khách hàng',
  `price_total` int(11) DEFAULT NULL COMMENT 'Tổng giá trị đơn hàng',
  `payment_status` tinyint(2) DEFAULT NULL COMMENT 'Trạng thái đơn hàng: 0 - Chưa thành toán, 1 - Đã thành toán',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Ngày tạo đơn',
  `updated_at` datetime DEFAULT NULL COMMENT 'Ngày cập nhật cuối'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `fullname`, `address`, `mobile`, `email`, `note`, `price_total`, `payment_status`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Việt Tú', 'Việt Nam', 966871026, 'tupham1120@gmail.com', '', 57470000, 0, '2020-07-12 11:04:02', NULL),
(2, NULL, 'Việt Tú', 'Việt Nam', 966871026, 'tupham1120@gmail.com', '', 27290000, 0, '2020-07-12 11:05:37', NULL),
(3, NULL, 'Việt Tú', 'Việt Nam', 966871026, 'tupham1120@gmail.com', '', 20990000, 0, '2020-07-12 11:06:13', NULL),
(4, 1, 'Việt Tú', 'Việt Nam', 966871026, 'tupham1120@gmail.com', '', 49680000, 0, '2020-07-13 00:21:39', NULL),
(5, 1, 'Việt Tú', 'Việt Nam', 966871026, 'tupham1120@gmail.com', '', 15490000, 0, '2020-07-13 00:23:06', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `order_id` int(11) DEFAULT NULL COMMENT 'Id của order tương ứng, là khóa ngoại liên kết với bảng orders',
  `product_id` int(11) DEFAULT NULL COMMENT 'Id của product tương ứng, là khóa ngoại liên kết với bảng products',
  `quality` int(11) DEFAULT NULL COMMENT 'Số sản phẩm đã đặt'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`order_id`, `product_id`, `quality`) VALUES
(1, 2, 2),
(1, 1, 1),
(2, 4, 1),
(3, 2, 1),
(4, 18, 1),
(4, 2, 2),
(5, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL COMMENT 'Id của danh mục mà sản phẩm thuộc về, là khóa ngoại liên kết với bảng categories',
  `title` varchar(255) NOT NULL COMMENT 'Tên sản phẩm',
  `avatar` varchar(255) DEFAULT NULL COMMENT 'Tên file ảnh sản phẩm',
  `price` int(11) DEFAULT NULL COMMENT 'Giá sản phẩm',
  `summary` varchar(255) DEFAULT NULL COMMENT 'Mô tả ngắn cho sản phẩm',
  `content` text DEFAULT NULL COMMENT 'Mô tả chi tiết cho sản phẩm',
  `status` tinyint(3) DEFAULT 0 COMMENT 'Trạng thái danh mục: 0 - Inactive, 1 - Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Ngày tạo',
  `updated_at` datetime DEFAULT NULL COMMENT 'Ngày cập nhật cuối'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `title`, `avatar`, `price`, `summary`, `content`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Samsung Galaxy S20+ (Plus)', '1594522350-product-637170945536714482_ss-s20-plus-den-1.png', 15490000, '', 'Samsung S20 Plus - Flagship màn hình lớn, cấu hình cao\r\nGalaxy S20 Plus được biết là phiên bản có cấu hình mạnh hơn của Samsung S20 và Samsung S20 Ultra. Samsung S20 Plus có kính thước màn hình lớn hơn và cấu hình khá tương đồng với người anh em Galaxy S20.\r\n\r\nThiết kế Samsung S20 Plus với màn hình đục lỗ, mặt lưng kính bóng bẩy\r\nSamsung Galaxy S20 Plus sở hữu thiết kế mặt trước tương tự các sản phẩm Samsung Galaxy S khác. Bạn vẫn có màn hình không viền với hai cạnh bên cong tràn. Tuy nhiên vị trí đặt camera trước đã chuyển ra trung tâm, điều này khá giống Galaxy Note 10. Phần lỗ camera này cũng được làm nhỏ hơn, kết hợp với phần viền siêu mỏng nên Samsung S20 Plus cho diện tích hiển thị gần như tuyệt đối. Giúp tăng không gian trải nghiệm cho người dùng.', 0, '2020-07-12 02:52:30', '2020-07-13 08:17:05'),
(2, 1, 'Samsung Galaxy S20 Ultra', '1594524318-product-637170935875912528_ss-s20-ultra-den-1.png', 20990000, '', '', 0, '2020-07-12 03:25:18', '2020-07-12 10:44:25'),
(3, 1, 'iPhone 11 Chính hãng (VN/A)', '1594526202-product-iphone11-purple-select-2019.jpg', 17690000, '', '', 0, '2020-07-12 03:56:42', NULL),
(4, 1, 'iPhone 11 Pro Max Chính hãng(VN/A)', '1594526301-product-iphone-11-pro-max-space-select-2019.jpg', 27290000, '', '', 0, '2020-07-12 03:58:21', '2020-07-12 10:58:43'),
(5, 1, 'Apple iPhone XR 64GB Chính hãng (VN/A)', '1594526454-product-iphone_xr_64gb.jpg', 14990000, '', '', 0, '2020-07-12 04:00:54', NULL),
(6, 1, 'Apple iPhone 7 Plus 32GB Chính hãng (Mã VN/A)', '1594526523-product-600_iphone_7_plus_silver_800x800_1_1.jpg', 8790000, '', '', 0, '2020-07-12 04:02:03', NULL),
(7, 2, 'Apple iPad 10.2 2019 Wi-Fi 32GB Chính Hãng', '1594526608-product-san-pham-apple-1.jpg', 7590000, '', '', 0, '2020-07-12 04:03:28', NULL),
(8, 1, 'Oppo Find X2', '1594552579-product-637191049692122812_oppo-find-x2-xanh-1.png', 17990000, '', '', 0, '2020-07-12 11:16:19', NULL),
(9, 1, 'Huawei P40 Pro', '1594553542-product-p40_pro_0000_layer_2.jpg', 21990000, '', '', 0, '2020-07-12 11:32:22', NULL),
(10, 1, 'Samsung Galaxy Note 10', '1594553679-product-637148757998466143_ss-note-10-do-1.png', 14600000, '', '', 0, '2020-07-12 11:34:39', NULL),
(11, 1, 'Samsung Galaxy Note 10+ (Plus)', '1594554089-product-note_10_plus_xanh.jpg', 16190000, '', '', 0, '2020-07-12 11:41:29', NULL),
(12, 1, 'Xiaomi Redmi Note 9s 4G 64GB', '1594554120-product-redmi_note_9s_0002_layer_1.jpg', 4800000, '', '', 0, '2020-07-12 11:42:00', NULL),
(13, 1, 'Vsmart Active 3 6GB Ram', '1594554226-product-vsmart-active-3-6gb-ram-1_6_2.jpg', 3990000, '', '', 0, '2020-07-12 11:43:46', NULL),
(14, 1, 'Xiaomi Redmi Note 9 Pro', '1594554251-product-1_65_5.jpg', 5950000, '', '', 0, '2020-07-12 11:44:11', NULL),
(15, 1, 'Oppo A92', '1594554279-product-oppo_a92.png', 5990000, '', '', 0, '2020-07-12 11:44:39', NULL),
(16, 1, 'Vsmart Joy 3 2GB', '1594554310-product-joy-3-1_7.png', 2290000, '', '', 0, '2020-07-12 11:45:10', NULL),
(17, 1, 'Vsmart Star 4', '1594554346-product-vsmart_star_4.jpg', 2490000, '', '', 0, '2020-07-12 11:45:46', NULL),
(18, 1, 'Oppo Reno 3', '1594554368-product-2_59_21.jpg', 7700000, '', '', 0, '2020-07-12 11:46:08', NULL),
(19, 1, 'Xiaomi Redmi Note 8 Pro', '1594554423-product-637060435932431657_xiaomi-redmi.jpg', 5050000, '', '', 0, '2020-07-12 11:47:03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `slides`
--

CREATE TABLE `slides` (
  `id` int(11) NOT NULL,
  `news_id` int(11) DEFAULT NULL COMMENT 'Id của tin tức sẽ hiển thị trong slide, là khóa ngoại liên kết với bảng news',
  `avatar` varchar(255) DEFAULT NULL COMMENT 'File ảnh slide',
  `position` tinyint(3) DEFAULT NULL COMMENT 'Vị trí hiển thị của slide, ví dụ: = 0 hiển thị đầu tiên...',
  `status` tinyint(3) DEFAULT 0 COMMENT 'Trạng thái danh mục: 0 - Inactive, 1 - Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Ngày tạo',
  `updated_at` datetime DEFAULT NULL COMMENT 'Ngày cập nhật cuối'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL COMMENT 'Tên đăng nhập',
  `password` varchar(255) NOT NULL COMMENT 'Mật khẩu đăng nhập',
  `first_name` varchar(255) DEFAULT NULL COMMENT 'Fist name',
  `last_name` varchar(255) DEFAULT NULL COMMENT 'Last name',
  `phone` int(11) DEFAULT NULL COMMENT 'SĐT user',
  `address` varchar(255) DEFAULT NULL COMMENT 'Địa chỉ user',
  `email` varchar(255) DEFAULT NULL COMMENT 'Email của user',
  `avatar` varchar(255) DEFAULT NULL COMMENT 'File ảnh đại diện',
  `jobs` varchar(255) DEFAULT NULL COMMENT 'Nghề nghiệp',
  `last_login` datetime DEFAULT NULL COMMENT 'Lần đăng nhập gần đây nhất',
  `facebook` varchar(255) DEFAULT NULL COMMENT 'Link facebook',
  `status` tinyint(3) DEFAULT 0 COMMENT 'Trạng thái danh mục: 0 - Inactive, 1 - Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Ngày tạo',
  `updated_at` datetime DEFAULT NULL COMMENT 'Ngày cập nhật cuối'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `first_name`, `last_name`, `phone`, `address`, `email`, `avatar`, `jobs`, `last_login`, `facebook`, `status`, `created_at`, `updated_at`) VALUES
(1, 'tupham1120@gmail.com', '25d55ad283aa400af464c76d713c07ad', '', '', 966871026, 'Việt Nam', 'tupham1120@gmail.com', '1594527983-user-4359e579e54c1e12475d.jpg', 'Sinh viên', NULL, '', 0, '2020-07-12 04:17:21', NULL),
(2, 'viettu01', '25d55ad283aa400af464c76d713c07ad', '', '', 0, '', '', '1594605200-user-5869d358d36d2833717c.jpg', '', NULL, '', 0, '2020-07-12 04:57:56', NULL),
(3, 'viettu@gmail.com', '202cb962ac59075b964b07152d234b70', '', '', 0, '', '', '1594555472-user-0f820e43e90e1164cc2be0a24e7138ce.jpg', '', NULL, '', 0, '2020-07-12 04:59:01', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slides`
--
ALTER TABLE `slides`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `slides`
--
ALTER TABLE `slides`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
