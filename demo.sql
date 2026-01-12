-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 11, 2024 lúc 04:01 PM
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
-- Cơ sở dữ liệu: `demo`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `account`
--

CREATE TABLE `account` (
  `username` varchar(64) NOT NULL,
  `firstname` varchar(64) NOT NULL,
  `lastname` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `password` varchar(255) NOT NULL,
  `activate_token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `account`
--

INSERT INTO `account` (`username`, `firstname`, `lastname`, `email`, `password`, `activate_token`) VALUES
('admin', 'Quản', 'Trị Viên', 'admin@gmail.com', '$2y$10$UA6d8dqFhh5T1WWWNZGeDetmVrMw8rGwndxxQijdKfBdte8z4l9wm', '123456'),
('tdt', 'Tôn', 'Đức Thắng', 'tdt@tdtu.edu.vn', '$2y$10$UA6d8dqFhh5T1WWWNZGeDetmVrMw8rGwndxxQijdKfBdte8z4l9wm', '123456');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `menu`
--

CREATE TABLE `menu` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `type` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `description` varchar(500) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `price` float NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `menu`
--

INSERT INTO `menu` (`id`, `name`, `type`, `description`, `price`, `image`) VALUES
(1, 'Dynamite Chicken', 'tempura', 'Japanese food', 13.92, '1.png'),
(2, 'Wasabi Prawns', 'tempura', 'Japanese food', 18.72, '2.png'),
(3, 'Tempura Prawns', 'tempura', 'Japanese food', 14.88, '3.png'),
(4, 'Crispy California Maki', 'maki', 'Japanese food', 12, '4.png'),
(5, 'Dynamite Maki Rolls', 'maki', 'Japanese food', 22.8, '5.png'),
(6, 'Seoul Maki', 'maki', 'Japanese food', 15.3, '6.png'),
(7, 'Siracha Maki', 'maki', 'Japanese food', 20.59, '7.png'),
(8, 'Rainbow Maki', 'maki', 'Japanese food', 23.5, '8.png'),
(9, 'Volcano Maki Rolls', 'maki', 'Japanese food', 23.5, '9.png'),
(10, 'Dragon Maki', 'maki', 'Japanese food', 25.3, '10.png'),
(11, 'Salmon Nigiri', 'nigiri', 'Japanese food', 15.3, '11.png'),
(12, 'Tuna Nigiri', 'nigiri', 'Japanese food', 22.3, '12.png'),
(13, 'Crab Sticks Nigiri', 'nigiri', 'Japanese food', 25.3, '13.png'),
(14, 'Unagi Nigiri', 'nigiri', 'Japanese food', 30.3, '14.png'),
(15, 'Red Snapper Sashimi', 'nigiri', 'Japanese food', 20.3, '15.png');


CREATE TABLE `user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` nvarchar(200) NOT NULL,
  `phone` nvarchar(200) NOT NULL,
  `address` nvarchar(200) NOT NULL,
  `email` nvarchar(200) NOT NULL,
  `password` nvarchar(200) NOT NULL,
  CONSTRAINT `PK_user` PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=3;

--
-- Thêm dữ liệu vào bảng `user`
--

INSERT INTO `user` (`id`, `name`, `phone`, `address`, `email`, `password`) VALUES
(1, 'Hoang Van Minh', '0393699396', 'Le Thi Hong phuong 17 quan Go Vap Thanh Pho Ho Chi Minh', 'vamila2710@gmail.com', '123'),
(2, 'Ngo Nhat Chieu', '9988776655', 'Quang Trung phuong 9 quan Go Vap Thanh Pho Ho Chi Minh', 'nhatchieu@gmail.com', '123456');


--
-- Tạo bảng `cart`
--

CREATE TABLE `cart` (
  `userId` int(11) NOT NULL,
  `menuId` int(11) NOT NULL,
  `itemName` nvarchar(200) NOT NULL,
  `price` float(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` float(11) NOT NULL,
  CONSTRAINT `PK_cart` PRIMARY KEY (`userId`,`menuId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Thêm dữ liệu vào bảng `cart`
--

INSERT INTO `cart` (`userId`, `menuId`, `itemName`, `price`, `qty`, `total`) VALUES
(2, 2, 'Wasabi Prawns', 18.72, 1, 18.72),
(2, 1, 'Dynamite Chicken', 13.92, 1, 13.92);


-- --------------------------------------------------------

--
-- Tạo bảng `order`
--

CREATE TABLE `order` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `total` float(11) NOT NULL,
  `status` nvarchar(200) NOT NULL,
  `detail` nvarchar(200) NOT NULL,
  `note` nvarchar(200),
  `address` nvarchar(200) NOT NULL,
  `phone` nvarchar(200) NOT NULL,
  CONSTRAINT `PK_order` PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=13;

-- --------------------------------------------------------
--
-- Chỉ mục cho bảng `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Chỉ mục cho bảng `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
