-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th1 20, 2019 lúc 06:30 PM
-- Phiên bản máy phục vụ: 10.1.35-MariaDB
-- Phiên bản PHP: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `restaurant`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--
drop database restaurant;
create database restaurant;
use restaurant;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `cate_name` varchar(255) NOT NULL,
  `code` varchar(20) NOT NULL,
  `parentID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `cate_name`, `code`, `parentID`) VALUES
(1, 'Món ăn', 'MA', NULL),
(2, 'Món khai vị', 'KV', 1),
(3, 'Món nướng', 'MN', 1),
(4, 'Món gà', 'MG', 1),
(5, 'Món lẩu', 'ML', 1),
(6, 'Món chiên-xào-hấp', 'CXH', 1),
(7, 'Món tráng miệng', 'TM', 1),
(8, 'Đồ uống', 'DU', NULL),
(9, 'Bia', 'BA', 8),
(10, 'Nước ngọt', 'NN', 8),
(11, 'Rượi', 'RU', 8),
(12, 'Pizza', 'PZ', NULL),
(13, 'Pizza tròn', 'PZT', 12),
(14, 'Pizza bỏ khay', 'PZBK', 12),
(15, 'Pizza bầu dục', 'PZBD', 12),
(16, 'Burger', 'BG', NULL),
(17, 'Burger Ấn Độ', 'GHAD', 16),
(18, 'Burger Mĩ', 'GHM', 16);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `caption` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `link` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `images`
--

INSERT INTO `images` (`id`, `product_id`, `caption`, `status`, `link`) VALUES
(1, 12, NULL, 1, 'daubapluoc.jpg'),
(2, 1, NULL, 1, 'goibocay.jpg'),
(3, 2, NULL, 1, 'echrangtieuxanh.jpg'),
(4, 3, NULL, 1, 'khoaitaychien.jpg'),
(5, 4, NULL, 2, 'bapnonxao.jpg'),
(6, 5, NULL, 3, 'bachicuonlaxanh.jpg'),
(7, 6, NULL, 1, 'ngheuhap.jpg'),
(8, 7, NULL, 2, 'ngheuxao.jpg'),
(9, 8, NULL, 3, 'daubapluoc.jpg'),
(10, 9, NULL, 1, 'goisua.jpg'),
(11, 10, NULL, 1, 'cangcuatronhaisan.jpg'),
(12, 11, NULL, 2, 'bachtuocnuong.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_date` datetime NOT NULL,
  `order_update` datetime DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders_detail`
--

CREATE TABLE `orders_detail` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `prices` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `prices` int(11) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `codes` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `product_name`, `prices`, `description`, `category_id`, `status`, `codes`) VALUES
(1, 'Gỏi bò cay', 59000, 'Đây là món khai vị', 7, 1, 'GBC'),
(2, 'Ếch rang tiêu xanh', 59000, 'Đây là món ếch rang tiêu xanh', 2, 1, 'ERTX'),
(3, 'Khoai tây chiên', 29000, 'Đây là món khoai tây chiên', 3, 1, 'KTC'),
(4, 'Bắp non xào hành', 29000, 'Đây là món bắp xào hành', 4, 1, 'BNXH'),
(5, 'Nghêu hấp', 39000, 'Đây là món nghêu hấp', 4, 1, 'NH'),
(6, 'Ba chỉ cuộn lá xanh', 39000, 'Đây là món ba chỉ cuốn lá xanh', 3, 2, 'BCCLX'),
(7, 'Nghêu xào', 39000, 'Đây là món nghêu xào', 5, 2, 'NX'),
(8, 'Rau muống xào tỏi', 35000, 'Đây là món rau muống xào tỏi', 6, 1, 'RMXT'),
(9, 'Gỏi sứa', 39000, 'Đây là món gỏi sứa', 2, 1, 'GS'),
(10, 'Càng cua trộn hải sản', 49000, 'Đây là món càng cua trộn hải sản', 5, 1, 'CCTHS'),
(11, 'Bạch tuộc nướng', 49000, 'Đây là món bạch tuộc nướng', 7, 3, 'BTN'),
(12, 'Đậu bắp luộc', 19000, 'Đây là món đậu bắp luộc', 6, 1, 'DBL');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `role` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `role`
--

INSERT INTO `role` (`id`, `role`) VALUES
(1, 'user'),
(2, 'admin');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `phone` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `user_name`, `phone`, `email`, `password`, `role_id`) VALUES
(1, 'admin', 123456789, 'admin@gmail.com', '$2y$10$zioVCca3tJ/MJ5fstZ.6eO1JijZ7M3L05HlexumwfaYYckNwuErJy', 2),
(2, 'cungc', 989710452, 'cungnguyen112b3@gmail.com', '$2y$10$u09CBU3ckRD.E0/pXjh3U.BbcnUI7IIIA4uT/oBAYzi69YiIA35ce', 1),
(3, 'Hung', 965243205, 'tranngochung1302@gmail.com', '$2y$10$VQH/s8x6kS64Lchux3Ps/u8UH4sGoQGJmzM5Cn1yG1jnHR.DWc2MC', 1);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cate_name` (`cate_name`),
  ADD UNIQUE KEY `code` (`code`),
  ADD KEY `categories_ibfk_1` (`parentID`);

--
-- Chỉ mục cho bảng `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `orders_detail`
--
ALTER TABLE `orders_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Chỉ mục cho bảng `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_name` (`user_name`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `role_id` (`id`),
  ADD KEY `role_ibfk_1` (`role_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT cho bảng `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `orders_detail`
--
ALTER TABLE `orders_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT cho bảng `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_ibfk_1` FOREIGN KEY (`parentID`) REFERENCES `categories` (`id`);

--
-- Các ràng buộc cho bảng `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `orders_detail`
--
ALTER TABLE `orders_detail`
  ADD CONSTRAINT `orders_detail_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `orders_detail_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `categories_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Các ràng buộc cho bảng `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `role_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
