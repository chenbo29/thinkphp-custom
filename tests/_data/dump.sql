-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 2018-09-28 08:50:59
-- 服务器版本： 5.7.21
-- PHP Version: 7.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- 表的结构 `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `create_time` int(10) NOT NULL,
  `update_time` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `comment`
--

INSERT INTO `comment` (`id`, `content`, `create_time`, `update_time`) VALUES
(1, '这篇文章文章标题1写的真不错', 1538104270, 1538104270),
(2, '这篇文章文章标题1写的真不错', 1538104285, 1538104285),
(3, '这篇文章文章标题1写的真不错', 1538104502, 1538104502),
(4, '这篇文章文章标题1写的真不错', 1538105129, 1538105129),
(5, '这篇文章文章标题12018-09-28 11:26:24写的真不错', 1538105184, 1538105184),
(6, '这篇文章<<文章标题12018-09-28 11:27:27>>写的真不错', 1538105247, 1538105247),
(7, '这篇文章<<davert2018-09-28 15:17:35>>写的真不错', 1538119056, 1538119056),
(8, '这篇文章<<davert2018-09-28 15:18:52>>写的真不错', 1538119132, 1538119132),
(9, '这篇文章<<davert2018-09-28 15:19:06>>写的真不错', 1538119146, 1538119146),
(10, '这篇文章<<davert2018-09-28 15:19:16>>写的真不错', 1538119156, 1538119156),
(11, '这篇文章<<davert2018-09-28 15:21:20>>写的真不错', 1538119280, 1538119280),
(12, '这篇文章<<davert2018-09-28 15:30:40>>写的真不错', 1538119840, 1538119840),
(13, '这篇文章<<davert2018-09-28 15:32:37>>写的真不错', 1538119957, 1538119957),
(14, '这篇文章<<2018-09-28 07:34:33标题2018-09-28 15:34:33>>写的真不错', 1538120073, 1538120073),
(15, '这篇文章<<2018-09-28 07:50:23标题2018-09-28 15:50:23>>写的真不错', 1538121023, 1538121023),
(16, '这篇文章<<2018-09-28 08:09:32标题2018-09-28 16:09:32>>写的真不错', 1538122173, 1538122173),
(17, '这篇文章<<2018-09-28 08:09:47标题2018-09-28 16:09:47>>写的真不错', 1538122187, 1538122187),
(18, '这篇文章<<2018-09-28 08:11:26标题2018-09-28 16:11:26>>写的真不错', 1538122286, 1538122286),
(19, '这篇文章<<2018-09-28 08:11:47标题2018-09-28 16:11:47>>写的真不错', 1538122307, 1538122307),
(20, '这篇文章<<2018-09-28 08:17:43标题2018-09-28 16:17:44>>写的真不错', 1538122664, 1538122664),
(21, '这篇文章<<2018-09-28 08:18:54标题2018-09-28 16:18:54>>写的真不错', 1538122734, 1538122734),
(22, '这篇文章<<2018-09-28 08:19:46标题2018-09-28 16:19:46>>写的真不错', 1538122786, 1538122786),
(23, '这篇文章<<2018-09-28 08:23:17标题2018-09-28 16:23:17>>写的真不错', 1538122997, 1538122997),
(24, '这篇文章<<2018-09-28 08:23:34标题2018-09-28 16:23:34>>写的真不错', 1538123014, 1538123014),
(25, '这篇文章<<2018-09-28 08:24:04标题2018-09-28 16:24:04>>写的真不错', 1538123044, 1538123044),
(26, '这篇文章<<2018-09-28 08:25:39标题2018-09-28 16:25:39>>写的真不错', 1538123139, 1538123139),
(27, '这篇文章<<2018-09-28 08:26:04标题2018-09-28 16:26:04>>写的真不错', 1538123164, 1538123164),
(28, '这篇文章<<2018-09-28 08:27:09标题2018-09-28 16:27:09>>写的真不错', 1538123229, 1538123229),
(29, '这篇文章<<2018-09-28 08:30:13标题2018-09-28 16:30:13>>写的真不错', 1538123413, 1538123413),
(30, '这篇文章<<2018-09-28 08:30:52标题2018-09-28 16:30:52>>写的真不错', 1538123452, 1538123452),
(31, '这篇文章<<2018-09-28 08:31:24标题2018-09-28 16:31:24>>写的真不错', 1538123484, 1538123484),
(32, '这篇文章<<2018-09-28 08:32:41标题2018-09-28 16:32:41>>写的真不错', 1538123561, 1538123561);

-- --------------------------------------------------------

--
-- 表的结构 `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `version` varchar(255) NOT NULL,
  `migration_name` varchar(100) DEFAULT NULL,
  `breakpoint` tinyint(1) NOT NULL DEFAULT '0',
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `migrations`
--

INSERT INTO `migrations` (`version`, `migration_name`, `breakpoint`, `start_time`, `end_time`) VALUES
('20180925034358', 'User', 0, '2018-09-25 16:27:18', '2018-09-25 16:27:18'),
('20180925082743', 'Post', 0, '2018-09-28 11:05:42', '2018-09-28 11:05:42'),
('20180928030431', 'Comment', 0, '2018-09-28 11:05:42', '2018-09-28 11:05:42');

-- --------------------------------------------------------

--
-- 表的结构 `news`
--

DROP TABLE IF EXISTS `news`;
CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(8) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `news`
--

INSERT INTO `news` (`id`, `title`, `content`) VALUES
(1, 'a', 'b'),
(2, 'a', 'b'),
(3, 'a', 'b'),
(4, 'a', 'b'),
(5, 'a', 'b'),
(6, 'a', 'b'),
(7, 'a', 'b'),
(8, 'a', 'b'),
(9, 'a', 'b'),
(10, 'a', 'b'),
(11, 'a', 'b'),
(12, 'a', 'b'),
(13, 'a', 'b'),
(14, 'a', 'b'),
(15, 'a', 'b'),
(16, 'a', 'b'),
(17, 'a', 'b'),
(18, 'a', 'b'),
(19, 'a', 'b'),
(20, 'a', 'b'),
(21, 'a', 'b'),
(22, 'a', 'b'),
(23, 'a', 'b'),
(24, 'a', 'b'),
(25, 'a', 'b'),
(26, 'a', 'b'),
(27, 'a', 'b'),
(28, 'a', 'b'),
(29, 'a', 'b'),
(30, 'a', 'b'),
(31, 'a', 'b'),
(32, 'a', 'b'),
(33, 'a', 'b'),
(34, 'a', 'b'),
(35, 'a', 'b');

-- --------------------------------------------------------

--
-- 表的结构 `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `post`
--

DROP TABLE IF EXISTS `post`;
CREATE TABLE IF NOT EXISTS `post` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `create_time` int(10) NOT NULL,
  `update_time` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- 表的结构 `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(8) NOT NULL,
  `password` varchar(60) NOT NULL,
  `create_time` int(10) NOT NULL,
  `update_time` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `create_time`, `update_time`) VALUES
(1, 'chenbo', '$2y$10$ua9XQRpx/JmP5YswaMEw9ebMBQkizTSBONd97gkQ.8UVnZLx10aOK', 1537864041, 1537864041);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
