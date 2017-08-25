-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th8 25, 2017 lúc 11:51 AM
-- Phiên bản máy phục vụ: 5.7.14
-- Phiên bản PHP: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `nihongo`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lesson`
--

CREATE TABLE `lesson` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `lesson`
--

INSERT INTO `lesson` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Từ mới bài 1', '2017-08-22 02:14:13', '2017-08-22 02:14:13'),
(2, 'Từ mới bài 2', '2017-08-22 02:14:13', '2017-08-22 02:20:25');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `class` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `student`
--

INSERT INTO `student` (`id`, `name`, `class`, `created_at`, `updated_at`) VALUES
(1, 'Hà Văn Triển', 'SC10', '2017-08-24 02:45:39', '2017-08-24 02:45:39'),
(2, 'Mai Văn Hiệp', 'SC10', '2017-08-24 02:46:22', '2017-08-24 02:46:22'),
(3, 'Hà Quốc Huy', 'SC09', '2017-08-24 02:46:22', '2017-08-24 02:46:22'),
(4, 'Nguyễn Thị Trang', 'SC10', '2017-08-24 02:47:21', '2017-08-24 02:47:21'),
(5, 'Nguyễn Văn Hoàng', 'SC10', '2017-08-24 08:25:24', '2017-08-24 08:25:24');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `vocabulary`
--

CREATE TABLE `vocabulary` (
  `id` int(11) NOT NULL,
  `kanji_word` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `kana_word` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `viet_word` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lesson_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `vocabulary`
--

INSERT INTO `vocabulary` (`id`, `kanji_word`, `kana_word`, `viet_word`, `lesson_id`, `created_at`, `updated_at`) VALUES
(1, NULL, 'はじめまして!', 'Xin chào!', 1, '2017-08-22 02:15:45', '2017-08-22 02:15:45'),
(2, '私', 'わたし', 'Tôi', 1, '2017-08-22 02:15:45', '2017-08-22 02:17:14'),
(3, '', 'コンピューター', 'Máy tính để bàn', 2, '2017-08-22 10:00:27', '2017-08-22 10:00:27');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `lesson`
--
ALTER TABLE `lesson`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `vocabulary`
--
ALTER TABLE `vocabulary`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `lesson`
--
ALTER TABLE `lesson`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT cho bảng `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT cho bảng `vocabulary`
--
ALTER TABLE `vocabulary`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
