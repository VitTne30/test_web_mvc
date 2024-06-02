-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 02, 2024 at 07:09 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mvc`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `tentaikhoan` varchar(100) NOT NULL,
  `matkhau` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `sdt` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `tentaikhoan`, `matkhau`, `email`, `sdt`) VALUES
(1, 'admin', 'admin', 'admin@gmail.com', '0373605557');

-- --------------------------------------------------------

--
-- Table structure for table `cauhoi`
--

CREATE TABLE `cauhoi` (
  `id` int(11) NOT NULL,
  `title` varchar(1000) NOT NULL,
  `cau_a` varchar(1000) NOT NULL,
  `cau_b` varchar(1000) NOT NULL,
  `cau_c` varchar(1000) NOT NULL,
  `cau_d` varchar(1000) NOT NULL,
  `cau_dung` varchar(1000) NOT NULL,
  `id_danhmuc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cauhoi`
--

INSERT INTO `cauhoi` (`id`, `title`, `cau_a`, `cau_b`, `cau_c`, `cau_d`, `cau_dung`, `id_danhmuc`) VALUES
(1, 'Quốc gia nào có quốc kì hình ngôi sao vàng ở giữa nền đỏ thẫm', 'Việt Nam', 'Tàu', 'Nhật Bản', 'Hàn Quốc', 'cau_a', 1),
(2, 'Có bao nhiêu quốc gia được công nhận trên thế giới', '198 ', '194', '193', '196', 'cau_c', 1),
(6, 'Con nào sau đây đi bằng 2 chân', 'con chó', 'con lợn', 'con trâu', 'con gà', 'cau_d', 3),
(7, 'Con nào sau đây đi bằng 4 chân', 'con chó', 'con vịt', 'con người', 'con vượn', 'cau_a', 3),
(9, 'Việt Nam có bao nhiêu dân tộc anh em', '56 dân tộc', '54 dân tộc', '55 dân tộc', '52 dân tộc', 'cau_b', 2),
(10, 'Tác phẩm “Hịch tướng sĩ” của tác giả', 'Nguyễn Trãi', 'Ngô Quyền ', 'Trần Hưng Đạo', 'Đinh Bộ Lĩnh', 'cau_c', 2),
(11, 'Người đàn ông duy nhất trên thế giới có…sữa là ai?', 'Ông thọ', 'Ông nội', 'Ông Cao Thắng', 'Ông già Noel', 'cau_a', 3),
(12, 'Có ba quả táo trên bàn và bạn lấy đi hai quả. Hỏi bạn còn bao nhiêu quả táo?', '1 quả', '2 quả', 'Không có quả nào', '3 quả', 'cau_b', 3),
(13, 'Đâu là quốc gia có diện tích lớn nhất thế giới?', 'Trung Quốc', 'Việt Nam', 'Mỹ', 'Nga', 'cau_d', 2),
(14, 'Câu ca dao nào nói về tình cảm anh em?', '\"Anh em như thể tay chân\r\nRách lành đùm bọc, dở hay đỡ đần.\"', '\"Nhiễu điều phủ lấy giá gương\r\nNgười trong một nước phải thương nhau cùng.\"', '\"Cây có cội, nước có nguồn\r\nChữ tâm kia mới bằng non nước.\"', '\"Ăn quả nhớ kẻ trồng cây\r\nCó lòng xin tạc đá vàng.\"', 'cau_a', 2),
(16, 'Thủ đô của Việt Nam là gì?', 'Ninh Bình', 'Đà Nẵng', 'Hà Nội', 'TP Hồ Chí Minh', 'cau_c', 1),
(17, 'Bệnh gì bác sĩ bó tay?', 'Bệnh tình', 'Gãy tay', 'Gãy chân', 'Đau đầu', 'cau_b', 3),
(18, 'Cái gì bằng cái vung, vùng xuống ao. Đào chẳng thấy, lấy chẳng được?', 'Mặt trăng', 'Mặt trời', 'Cái mâm', 'Con cá', 'cau_a', 3),
(19, 'Tác giả của tác phẩm \"Bình Ngô đại cáo\"?', 'Nguyễn Du', 'Nguyễn Bỉnh Khiêm', 'Nguyễn Trãi', 'Nguyễn Nhạc', 'cau_c', 2),
(20, 'Tác giả của tác phẩm Tắt đèn là ai?', 'Ngô Quyền', 'Ngô Bảo Châu', 'Ngô Thuỵ Lương', 'Ngô Tất Tố', 'cau_d', 2),
(22, 'Thủ đô của Hàn Quốc là gì?', 'Seoul', 'BangKok', 'Kyoto', 'Mas-cơ-va', 'cau_a', 1),
(28, 'Con gì đầu dê mình ốc?', 'Con khỉ', 'Con dê', 'Con dốc', 'Con đường', 'cau_c', 3),
(29, 'Vựa sen lớn nhất miền Bắc nằm ở đâu?', 'Hà Nam', 'Hà Nội', 'Nghệ An', 'Ninh Bình', 'cau_a', 1),
(30, 'Địa phương nào mang tên một người phụ nữ?', 'Thành phố Huế', 'Tỉnh Bà Rịa', 'Huyện Cô Tô', 'Núi Bà Đen', 'cau_b', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cauhoi_dalay`
--

CREATE TABLE `cauhoi_dalay` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cauhoi_dalay`
--

INSERT INTO `cauhoi_dalay` (`id`) VALUES
(1),
(14);

-- --------------------------------------------------------

--
-- Table structure for table `danhmuc`
--

CREATE TABLE `danhmuc` (
  `id` int(11) NOT NULL,
  `tendanhmuc` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `danhmuc`
--

INSERT INTO `danhmuc` (`id`, `tendanhmuc`) VALUES
(1, 'Địa lí'),
(2, 'Xã hội'),
(3, 'Đố vui');

-- --------------------------------------------------------

--
-- Table structure for table `lichsudau`
--

CREATE TABLE `lichsudau` (
  `id` int(11) NOT NULL,
  `tentaikhoan` varchar(1000) NOT NULL,
  `thoigian` varchar(1000) NOT NULL,
  `diemso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lichsudau`
--

INSERT INTO `lichsudau` (`id`, `tentaikhoan`, `thoigian`, `diemso`) VALUES
(1, '1', '2024-04-02T17:27:17.051Z', 3),
(2, '1', '2024-04-02T17:27:51.824Z', 3),
(3, '1', '2024-04-02T17:34:30.090Z', 2),
(4, '1', '2024-04-02T17:46:57.490Z', 1),
(5, 'asd', '2024-04-03T01:04:20.533Z', 1),
(6, 'admin', '2024-04-03T02:11:49.106Z', 4),
(7, 'admin', '2024-04-03T02:12:16.629Z', 5),
(8, 'admin', '2024-04-03T02:19:48.117Z', 5),
(9, '1', '2024-04-03T14:51:53.790Z', 3),
(10, '1', '2024-04-03T14:55:45.349Z', 4),
(11, '1', '4/3/2024 9:58:58 PM', 5),
(12, '1', '4/3/2024 10:00:24 PM', 3),
(13, '123', '4/4/2024 11:14:45 AM', 5),
(14, '123', '4/4/2024 11:15:41 AM', 5),
(15, 'asd', '4/18/2024 5:11:23 PM', 5),
(16, 'asd', '4/18/2024 5:11:40 PM', 5),
(17, 'asd', '4/19/2024 3:30:26 PM', 5);

-- --------------------------------------------------------

--
-- Table structure for table `taikhoan`
--

CREATE TABLE `taikhoan` (
  `id` int(11) NOT NULL,
  `tentaikhoan` varchar(100) NOT NULL,
  `matkhau` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `taikhoan`
--

INSERT INTO `taikhoan` (`id`, `tentaikhoan`, `matkhau`, `email`) VALUES
(1, '1', '1', 'vanhpham3009@gmail.com'),
(2, 'asd', 'asd', 'vanhpham3009@gmail.com'),
(4, '123', '123', 'vanhpham3009@gmail.com'),
(56, 'admin', 'admin', 'admin@gmail.com'),
(83, 'an', 'an', 'an@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cauhoi`
--
ALTER TABLE `cauhoi`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title` (`title`) USING HASH;

--
-- Indexes for table `cauhoi_dalay`
--
ALTER TABLE `cauhoi_dalay`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `danhmuc`
--
ALTER TABLE `danhmuc`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tendanhmuc` (`tendanhmuc`) USING HASH;

--
-- Indexes for table `lichsudau`
--
ALTER TABLE `lichsudau`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tentaikhoan` (`tentaikhoan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cauhoi`
--
ALTER TABLE `cauhoi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `danhmuc`
--
ALTER TABLE `danhmuc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `lichsudau`
--
ALTER TABLE `lichsudau`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `taikhoan`
--
ALTER TABLE `taikhoan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
