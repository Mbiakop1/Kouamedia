-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 05, 2021 at 06:13 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `social`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `post_body` text NOT NULL,
  `posted_by` varchar(60) NOT NULL,
  `posted_to` varchar(60) NOT NULL,
  `date_added` datetime NOT NULL,
  `removed` varchar(60) NOT NULL,
  `post_id` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_body`, `posted_by`, `posted_to`, `date_added`, `removed`, `post_id`) VALUES
(1, 'welcome', 'mbutiji_emanuel', 'mogo_mouce_1', '2021-06-18 02:00:37', 'no', '24'),
(2, 'hi', 'mbutiji_emanuel', 'mbutiji_emanuel', '2021-06-18 02:01:24', 'no', '9'),
(3, 'yo', 'mbutiji_emanuel', 'mogo_mouce_1', '2021-06-19 02:12:07', 'no', '24'),
(4, 'hi', 'mbutiji_emanuel', 'mogo_mouce_1', '2021-06-19 02:12:17', 'no', '24'),
(5, 'na so', 'mbutiji_emanuel', 'mogo_mouce_1', '2021-06-19 02:12:30', 'no', '23'),
(6, 'na fo dey e don happen', 'mbutiji_emanuel', 'mogo_mouce_1', '2021-06-19 02:22:01', 'no', '23'),
(7, 'jesus it works', 'mbutiji_emanuel', 'mogo_mouce_1', '2021-06-19 02:22:09', 'no', '23'),
(8, 'great work', 'mbutiji_emanuel', 'mogo_mouce_1', '2021-06-19 02:22:15', 'no', '23'),
(9, 'hello', 'mbutiji_emanuel', 'mogo_mouce_1', '2021-06-19 03:05:20', 'no', '24'),
(10, '', 'mbutiji_emanuel', 'mogo_mouce_1', '2021-06-19 03:12:23', 'no', '24'),
(11, '', 'mbutiji_emanuel', 'mogo_mouce_1', '2021-06-19 03:12:34', 'no', '24'),
(12, '', 'mbutiji_emanuel', 'mogo_mouce_1', '2021-06-19 03:14:31', 'no', '24'),
(13, '', 'mbutiji_emanuel', 'mogo_mouce_1', '2021-06-19 03:14:38', 'no', '24'),
(14, '', 'mbutiji_emanuel', 'mogo_mouce_1', '2021-06-19 03:20:28', 'no', '24'),
(15, ',mlkerkl\r\n2erwe\r\nwer\r\nwerw\r\nwerfw2\r\n', 'mbutiji_emanuel', 'mogo_mouce_1', '2021-06-19 03:23:22', 'no', '24'),
(16, 'no\r\n', 'mbutiji_emanuel', 'mbutiji_emanuel', '2021-06-19 04:17:14', 'no', '5'),
(17, 'yo', 'mbutiji_emanuel', 'mbutiji_emanuel', '2021-06-19 04:18:06', 'no', '13'),
(18, 'hahahahahahahahahah', 'mbutiji_emanuel', 'mogo_mouce_1', '2021-06-21 02:57:41', 'no', '24'),
(19, 'hffrg', 'mbutiji_emanuel', 'mogo_mouce_1', '2021-06-21 20:24:04', 'no', '24'),
(20, 'sdgrgrthtr', 'mbutiji_emanuel', 'mogo_mouce_1', '2021-06-21 20:24:49', 'no', '24'),
(21, 're5ty54y56y5', 'mbutiji_emanuel', 'mogo_mouce_1', '2021-06-21 20:25:22', 'no', '23'),
(22, 'mhubhi', 'mbutiji_emanuel', 'mogo_mouce_1', '2021-06-22 17:13:22', 'no', '23'),
(23, 'ce comment\r\n', 'dev_pro', 'mbutiji_emanuel', '2021-06-27 05:23:41', 'no', '13'),
(24, '', 'mbutiji_emanuel', 'mogo_mouce', '2021-07-18 23:58:50', 'no', '22'),
(25, 'hi\r\n', 'mbutiji_emanuel', 'mogo_mouce', '2021-08-28 20:14:43', 'no', '22'),
(26, 'na how noh big man', 'miki_mouce', 'mbutiji_emanuel', '2021-08-30 16:32:52', 'no', '33'),
(27, 'hafa', 'miki_mouce', 'mbutiji_emanuel', '2021-08-30 16:33:33', 'no', '33'),
(28, 'yo', 'miki_mouce', 'mbutiji_emanuel', '2021-08-30 16:35:09', 'no', '33'),
(29, 'yessssss', 'miki_mouce', 'miki_mouce', '2021-08-30 16:36:06', 'no', '35'),
(30, 'wow this works well', 'miki_mouce', 'miki_mouce', '2021-08-30 16:36:19', 'no', '35'),
(31, 'Testing notifications', 'miki_mouce', 'mbutiji_emanuel', '2021-08-30 16:41:34', 'no', '10'),
(32, 'new comment', 'miki_mouce', 'mbutiji_emanuel', '2021-08-30 17:14:42', 'no', '12'),
(33, 'how far', 'mbutiji_emanuel', 'mbutiji_emanuel', '2021-09-01 20:58:18', 'no', '40');

-- --------------------------------------------------------

--
-- Table structure for table `friend_requests`
--

CREATE TABLE `friend_requests` (
  `id` int(11) NOT NULL,
  `user_to` varchar(50) NOT NULL,
  `user_from` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `friend_requests`
--

INSERT INTO `friend_requests` (`id`, `user_to`, `user_from`) VALUES
(1, 'mogo_mouce_1', 'mbutiji_emanuel'),
(10, 'momo_me', 'mogo_mouce'),
(12, 'mogo_mouce_1', 'clinton_clinton'),
(15, 'mbutiji_emanuel_1', 'mbutiji_emanuel'),
(17, 'momo_me', 'mbutiji_emanuel'),
(18, 'mogo_mouce', 'miki_mouce');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `username` varchar(60) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `username`, `post_id`) VALUES
(50, 'mbutiji_emanuel', 13),
(52, 'mbutiji_emanuel', 23),
(53, 'mbutiji_emanuel', 24),
(54, 'dev_pro', 11),
(55, 'momo_me', 26),
(62, 'miki_mouce', 11),
(64, 'miki_mouce', 12),
(65, 'miki_mouce', 33),
(66, 'miki_mouce', 35),
(67, 'miki_mouce', 36),
(68, 'miki_mouce', 10),
(69, 'miki_mouce', 9),
(70, 'mbutiji_emanuel', 9),
(71, 'mbutiji_emanuel', 10),
(78, 'miki_mouce', 44);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `user_to` varchar(50) NOT NULL,
  `user_from` varchar(50) NOT NULL,
  `body` text NOT NULL,
  `date` datetime NOT NULL,
  `opened` varchar(3) NOT NULL,
  `viewed` varchar(3) NOT NULL,
  `deleted` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `user_to`, `user_from`, `body`, `date`, `opened`, `viewed`, `deleted`) VALUES
(4, 'mogo_mouce', 'mbutiji_emanuel', 'hey ho far', '2021-07-10 11:07:10', 'yes', 'yes', 'no'),
(5, 'mogo_mouce', 'mbutiji_emanuel', 'ghtfj\r\ngjryku\r\n', '2021-07-10 11:17:28', 'yes', 'yes', 'no'),
(6, 'mogo_mouce', 'mbutiji_emanuel', 'fjmnfkmuykm', '2021-07-10 11:17:31', 'yes', 'yes', 'no'),
(7, 'mogo_mouce', 'mbutiji_emanuel', 'fgmnfmytm', '2021-07-10 11:17:35', 'yes', 'yes', 'no'),
(8, 'mogo_mouce', 'mbutiji_emanuel', 'dfnhfmjymm', '2021-07-10 11:17:38', 'yes', 'yes', 'no'),
(9, 'mogo_mouce', 'mbutiji_emanuel', 'sdfndnmmu', '2021-07-10 11:17:41', 'yes', 'yes', 'no'),
(10, 'mogo_mouce', 'mbutiji_emanuel', 'xfnbteyjhj  uiui', '2021-07-10 11:17:44', 'yes', 'yes', 'no'),
(11, 'mogo_mouce', 'mbutiji_emanuel', 'hh56iui,m  dty', '2021-07-10 11:17:49', 'yes', 'yes', 'no'),
(12, 'mogo_mouce', 'mbutiji_emanuel', 'fntjyuyyymyry', '2021-07-10 11:17:52', 'yes', 'yes', 'no'),
(13, 'mbutiji_emanuel', 'mogo_mouce', 'gcjcghjhdt', '2021-07-10 11:30:29', 'yes', 'yes', 'no'),
(14, 'mbutiji_emanuel', 'mogo_mouce', 'djyhdty', '2021-07-10 11:30:31', 'yes', 'yes', 'no'),
(15, 'mbutiji_emanuel', 'mogo_mouce', 'djmndt', '2021-07-10 11:30:32', 'yes', 'yes', 'no'),
(16, 'mbutiji_emanuel', 'mogo_mouce', 'dfgyjmnd', '2021-07-10 11:30:33', 'yes', 'yes', 'no'),
(17, 'mogo_mouce', 'mbutiji_emanuel', 'njhyh', '2021-07-13 02:05:14', 'yes', 'yes', 'no'),
(18, 'mogo_mouce', 'mbutiji_emanuel', 'njhyh', '2021-07-13 02:05:39', 'yes', 'yes', 'no'),
(19, 'mogo_mouce', 'mbutiji_emanuel', 'bhjh', '2021-07-13 02:05:46', 'yes', 'yes', 'no'),
(20, 'mogo_mouce', 'mbutiji_emanuel', 'hey', '2021-07-13 07:14:37', 'yes', 'yes', 'no'),
(21, 'mogo_mouce', 'mbutiji_emanuel', 'ho', '2021-07-13 07:14:42', 'yes', 'yes', 'no'),
(22, 'mogo_mouce', 'mbutiji_emanuel', 'lopor', '2021-07-16 05:46:47', 'yes', 'yes', 'no'),
(23, 'miki_mouce', 'mbutiji_emanuel', 'nhn', '2021-07-27 15:13:44', 'yes', 'yes', 'no'),
(24, 'mbutiji_emanuel', 'mogo_mouce', 'hi', '2021-08-19 13:17:09', 'yes', 'yes', 'no'),
(25, 'mbutiji_emanuel', 'mogo_mouce', 'hi', '2021-08-19 13:17:21', 'yes', 'yes', 'no'),
(26, 'mbutiji_emanuel', 'mogo_mouce', 'hi', '2021-08-19 13:17:26', 'yes', 'yes', 'no'),
(27, 'mbutiji_emanuel', 'mogo_mouce', 'hi', '2021-08-19 13:44:48', 'yes', 'yes', 'no'),
(28, 'mbutiji_emanuel', 'mogo_mouce', 'helloo', '2021-08-19 13:45:01', 'yes', 'yes', 'no'),
(29, 'mbutiji_emanuel', 'mogo_mouce', 'hello', '2021-08-19 13:46:07', 'yes', 'yes', 'no'),
(30, 'mbutiji_emanuel', 'mogo_mouce', 'hello', '2021-08-19 13:46:20', 'yes', 'yes', 'no'),
(31, 'mbutiji_emanuel', 'mogo_mouce', 'hey dude', '2021-08-19 13:46:28', 'yes', 'yes', 'no'),
(32, 'mogo_mouce', 'mbutiji_emanuel', 'kjlk', '2021-08-28 22:23:57', 'yes', 'yes', 'no'),
(33, 'mogo_mouce', 'mbutiji_emanuel', 'nkjk', '2021-08-28 22:24:04', 'yes', 'yes', 'no'),
(34, 'mogo_mouce', 'mbutiji_emanuel', 'hi', '2021-09-01 21:20:22', 'yes', 'yes', 'no'),
(35, 'mbutiji_emanuel', 'mogo_mouce', 'yes', '2021-09-01 21:20:59', 'yes', 'yes', 'no'),
(36, 'mbutiji_emanuel', 'miki_mouce', 'hi man', '2021-09-03 11:48:47', 'yes', 'yes', 'no'),
(37, 'mbutiji_emanuel', 'miki_mouce', 'yo', '2021-09-03 11:48:54', 'yes', 'yes', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `user_to` varchar(50) NOT NULL,
  `user_from` varchar(50) NOT NULL,
  `message` text NOT NULL,
  `link` varchar(100) NOT NULL,
  `datetime` datetime NOT NULL,
  `opened` varchar(3) NOT NULL,
  `viewed` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_to`, `user_from`, `message`, `link`, `datetime`, `opened`, `viewed`) VALUES
(1, '', 'miki_mouce', 'Miki Mouce liked on your post ', 'post.php?id=12', '2021-08-30 16:41:04', 'no', 'no'),
(2, '', 'miki_mouce', 'Miki Mouce liked on your post ', 'post.php?id=33', '2021-08-30 16:41:06', 'no', 'no'),
(3, 'mbutiji_emanuel', 'miki_mouce', 'Miki Mouce commented on your post ', 'post.php?id=10', '2021-08-30 16:41:34', 'no', 'yes'),
(4, 'mbutiji_emanuel', 'miki_mouce', 'Miki Mouceposted on your profile ', 'post.php?id=39', '2021-08-30 17:14:23', 'no', 'yes'),
(5, 'mbutiji_emanuel', 'miki_mouce', 'Miki Mouce commented on your post ', 'post.php?id=12', '2021-08-30 17:14:42', 'no', 'yes'),
(6, 'mbutiji_emanuel', 'miki_mouce', 'Miki Mouce liked on your post ', 'post.php?id=10', '2021-08-30 17:14:48', 'no', 'yes'),
(7, 'mbutiji_emanuel', 'miki_mouce', 'Miki Mouce liked on your post ', 'post.php?id=9', '2021-08-30 17:14:52', 'yes', 'yes'),
(8, 'mogo_mouce', 'mbutiji_emanuel', 'Mbutiji Emanuel posted on your profile ', 'post.php?id=40', '2021-09-01 20:58:11', 'yes', 'yes'),
(9, 'mogo_mouce', 'mbutiji_emanuel', 'Mbutiji Emanuel commented on your profile post ', 'post.php?id=40', '2021-09-01 20:58:19', 'yes', 'yes'),
(10, 'momo_me', 'mbutiji_emanuel', 'Mbutiji Emanuel posted on your profile ', 'post.php?id=44', '2021-09-03 11:47:21', 'no', 'no'),
(11, 'mbutiji_emanuel', 'miki_mouce', 'Miki Mouce liked on your post ', 'post.php?id=44', '2021-09-03 11:49:18', 'no', 'yes'),
(12, 'miki_mouce', 'mbutiji_emanuel', 'Mbutiji Emanuel posted on your profile ', 'post.php?id=67', '2021-09-05 13:55:56', 'no', 'no'),
(13, 'miki_mouce', 'mbutiji_emanuel', 'Mbutiji Emanuel posted on your profile ', 'post.php?id=73', '2021-09-05 14:57:16', 'no', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `body` text NOT NULL,
  `added_by` varchar(60) NOT NULL,
  `user_to` varchar(60) NOT NULL,
  `date_added` datetime NOT NULL,
  `user_closed` varchar(3) NOT NULL,
  `deleted` varchar(3) NOT NULL,
  `likes` int(11) NOT NULL,
  `image` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `body`, `added_by`, `user_to`, `date_added`, `user_closed`, `deleted`, `likes`, `image`) VALUES
(1, 'this is a post', 'mbutiji_emanuel', 'none', '2021-06-10 17:33:55', 'no', 'no', 0, ''),
(2, 'new post made', 'mbutiji_emanuel', 'none', '2021-06-10 17:34:13', 'no', 'no', 0, ''),
(3, 'new post made', 'mbutiji_emanuel', 'none', '2021-06-11 00:53:38', 'no', 'no', 0, ''),
(4, 'new post made', 'mbutiji_emanuel', 'none', '2021-06-11 00:53:45', 'no', 'no', 0, ''),
(5, 'new post made', 'mbutiji_emanuel', 'none', '2021-06-11 01:25:26', 'no', 'no', 0, ''),
(6, 'juyfyiyfyit\n', 'mbutiji_emanuel', 'none', '2021-06-11 05:26:58', 'no', 'no', 0, ''),
(7, 'hello am new herewhats up', 'mogo_mouce', 'none', '2021-06-11 15:18:40', 'no', 'no', 0, ''),
(8, 'any new stuffs\n', 'mogo_mouce', 'none', '2021-06-11 15:19:01', 'no', 'no', 0, ''),
(9, 'hello', 'mbutiji_emanuel', 'none', '2021-06-14 02:56:34', 'no', 'no', 2, ''),
(10, 'hi\n', 'mbutiji_emanuel', 'none', '2021-06-14 02:58:16', 'no', 'no', 2, ''),
(11, 'welcome to the new world\n', 'mbutiji_emanuel', 'none', '2021-06-15 01:30:36', 'no', 'no', 2, ''),
(12, 'a beautiful place to be ', 'mbutiji_emanuel', 'none', '2021-06-15 01:30:56', 'no', 'no', 1, ''),
(13, 'love is very beautiful\n', 'mbutiji_emanuel', 'none', '2021-06-15 01:31:17', 'no', 'yes', 1, ''),
(14, 'cameroon is a bilingual country', 'mogo_mouce', 'none', '2021-06-15 01:32:57', 'no', 'no', 0, ''),
(15, 'i am a software developer', 'mogo_mouce', 'none', '2021-06-15 01:33:15', 'no', 'no', 0, ''),
(16, 'yop yop yop mogo is in the building', 'mogo_mouce', 'none', '2021-06-15 01:33:43', 'no', 'no', 0, ''),
(17, 'african nations cup on their way to cameroon', 'mogo_mouce', 'none', '2021-06-15 01:34:17', 'no', 'no', 0, ''),
(18, 'who wants some bread', 'mogo_mouce', 'none', '2021-06-15 01:34:31', 'no', 'no', 0, ''),
(19, 'my bike is bad', 'mogo_mouce', 'none', '2021-06-15 01:34:39', 'no', 'no', 0, ''),
(20, 'i need 10k now', 'mogo_mouce', 'none', '2021-06-15 01:34:50', 'no', 'no', 0, ''),
(21, 'I learn from youtube a lot', 'mogo_mouce', 'none', '2021-06-15 01:35:18', 'no', 'no', 0, ''),
(22, 'new post by mogo', 'mogo_mouce', 'none', '2021-06-15 04:59:06', 'no', 'no', 0, ''),
(23, 'hey guys this  is my first post', 'mogo_mouce_1', 'none', '2021-06-17 03:43:47', 'no', 'no', 1, ''),
(24, 'am just starting  to post here', 'mogo_mouce_1', 'none', '2021-06-17 03:44:03', 'no', 'no', 1, ''),
(25, 'hello guys am new here whats up. \njust for introduction', 'mbutiji_emanuel_1', 'none', '2021-06-27 00:45:07', 'no', 'no', 0, ''),
(26, 'jlknix;oiaNB sDOCNoivnioew', 'momo_me', 'mbutiji_emanuel', '2021-06-28 02:18:35', 'no', 'yes', 1, ''),
(27, 'happy!', 'momo_me', 'none', '2021-06-28 02:33:07', 'no', 'yes', 0, ''),
(28, 'new day\n', 'momo_me', 'none', '2021-06-28 04:17:24', 'no', 'yes', 0, ''),
(29, 'well done\n', 'momo_me', 'none', '2021-06-28 04:17:31', 'no', 'yes', 0, ''),
(30, 'kjmkjuiouoe', 'momo_me', 'none', '2021-06-28 13:53:52', 'no', 'yes', 0, ''),
(31, 'nkjsHIUDfbcaiuvcaweaifipw3', 'momo_me', 'none', '2021-06-28 15:56:30', 'no', 'yes', 0, ''),
(32, 'kjBSdfviuqeygvfgf9i', 'momo_me', 'none', '2021-06-28 15:56:33', 'no', 'yes', 0, ''),
(33, 'kjuiukj', 'mbutiji_emanuel', 'none', '2021-06-29 11:57:46', 'no', 'no', 3, ''),
(34, 'nk', 'mbutiji_emanuel', 'none', '2021-07-27 17:06:36', 'no', 'yes', 0, ''),
(35, 'hi mbitiji', 'miki_mouce', 'mbutiji_emanuel', '2021-08-30 16:32:26', 'no', 'no', 1, ''),
(36, 'greetings friend', 'miki_mouce', 'mbutiji_emanuel', '2021-08-30 16:38:30', 'no', 'no', 1, ''),
(37, 'this is to test notifications', 'miki_mouce', 'mbutiji_emanuel', '2021-08-30 16:41:54', 'no', 'no', 0, ''),
(38, 'lets see', 'miki_mouce', 'mbutiji_emanuel', '2021-08-30 16:53:57', 'no', 'no', 0, ''),
(39, 'this is another test', 'miki_mouce', 'mbutiji_emanuel', '2021-08-30 17:14:23', 'no', 'no', 0, ''),
(40, 'hi', 'mbutiji_emanuel', 'mogo_mouce', '2021-09-01 20:58:11', 'no', 'no', 0, ''),
(41, 'hey guys i love this video <br><iframe width=\'420\' height=\'315\' src=\'https://www.youtube.com/embed/IzpqvggsBXc\'></iframe><br>', 'mbutiji_emanuel', 'none', '2021-09-03 11:38:00', 'no', 'no', 0, ''),
(42, 'lets check this out <br><iframe width=\'420\' height=\'315\' src=\'https://www.youtube.com/embed/QjMJsQx_O7o\n\'></iframe><br>', 'mbutiji_emanuel', 'none', '2021-09-03 11:39:14', 'no', 'no', 0, ''),
(43, 'hey <br><iframe width=\'420\' height=\'315\' src=\'https://www.youtube.com/embed/Zn_f6el0TKw\'></iframe><br>', 'mbutiji_emanuel', 'none', '2021-09-03 11:40:16', 'no', 'no', 0, ''),
(44, 'hi man', 'mbutiji_emanuel', 'momo_me', '2021-09-03 11:47:21', 'no', 'no', 1, ''),
(45, ' \n', 'miki_mouce', 'none', '2021-09-03 12:12:19', 'no', 'no', 0, ''),
(46, '<br><iframe width=\'420\' height=\'315\' src=\'https://www.youtube.com/embed/CEw-7cMnBDY\'></iframe><br>', 'miki_mouce', 'none', '2021-09-03 12:19:34', 'no', 'no', 0, ''),
(47, 'Hello guys am looking foward to start university', 'miki_mouce', 'none', '2021-09-03 13:06:06', 'no', 'no', 0, ''),
(48, 'good morning everyone', 'miki_mouce', 'none', '2021-09-03 13:07:25', 'no', 'yes', 0, ''),
(49, 'ji', 'miki_mouce', 'none', '2021-09-03 14:45:20', 'no', 'yes', 0, 'Assets/images/posts613226f0cfdad2.jpg'),
(50, 'this is cool', 'miki_mouce', 'none', '2021-09-03 14:46:20', 'no', 'yes', 0, ''),
(51, '', 'miki_mouce', 'none', '2021-09-03 14:57:23', 'no', 'yes', 0, 'Assets/images/posts613229c39aeb76.jpg'),
(52, '', 'miki_mouce', 'none', '2021-09-03 14:57:33', 'no', 'yes', 0, 'Assets/images/posts613229cdc1f5b6.jpg'),
(53, '', 'miki_mouce', 'none', '2021-09-03 14:58:13', 'no', 'yes', 0, 'Assets/images/posts613229f5391036.jpg'),
(54, '', 'miki_mouce', 'none', '2021-09-03 14:58:24', 'no', 'yes', 0, 'Assets/images/posts61322a00d22d75.jpg'),
(55, '', 'miki_mouce', 'none', '2021-09-03 14:58:39', 'no', 'yes', 0, 'Assets/images/posts61322a0f4c3835.jpg'),
(56, 'hey man how are you doing', 'miki_mouce', 'none', '2021-09-03 14:58:51', 'no', 'yes', 0, ''),
(57, 'hey man how are you doing', 'miki_mouce', 'none', '2021-09-03 14:59:43', 'no', 'yes', 0, ''),
(58, 'hey man how are you doing', 'miki_mouce', 'none', '2021-09-03 15:03:01', 'no', 'yes', 0, ''),
(59, 'hey man how are you doing', 'miki_mouce', 'none', '2021-09-03 15:03:11', 'no', 'yes', 0, ''),
(60, 'hey man how are you doing', 'miki_mouce', 'none', '2021-09-03 15:03:14', 'no', 'yes', 0, ''),
(61, 'hey man how are you doing', 'miki_mouce', 'none', '2021-09-03 15:04:52', 'no', 'yes', 0, ''),
(62, '', 'mbutiji_emanuel', 'none', '2021-09-03 15:53:28', 'no', 'no', 0, 'Assets/images/posts613236e8d405f1.jpg'),
(63, 'what is happening', 'mbutiji_emanuel', 'none', '2021-09-03 15:54:33', 'no', 'no', 0, ''),
(64, 'i love coki ', 'mbutiji_emanuel', 'none', '2021-09-03 16:03:22', 'no', 'no', 0, 'Assets/images/posts6132393a34d8d6.jpg'),
(65, 'cava bien', 'mbutiji_emanuel', 'none', '2021-09-04 12:10:38', 'no', 'no', 0, 'Assets/images/posts6133542e80f70Screenshot (7).png'),
(66, 'good morning guys have a blessed sunday', 'mbutiji_emanuel', 'none', '2021-09-05 12:39:51', 'no', 'no', 0, 'Assets/images/posts6134ac87b558bFINDAM_lego.png'),
(67, 'jjj', 'mbutiji_emanuel', 'miki_mouce', '2021-09-05 13:55:56', 'no', 'no', 0, ''),
(68, 'kkkk', 'mbutiji_emanuel', 'none', '2021-09-05 13:56:16', 'no', 'no', 0, ''),
(69, 'lets do this', 'mbutiji_emanuel', 'none', '2021-09-05 14:32:35', 'no', 'no', 0, 'Assets/images/posts6134c6f3438deimage results.PNG'),
(70, 'k ohhhhhhhh', 'mbutiji_emanuel', 'none', '2021-09-05 14:33:12', 'no', 'no', 0, 'Assets/images/posts6134c718041f1google search.png'),
(71, 'cool', 'mbutiji_emanuel', 'none', '2021-09-05 14:43:07', 'no', 'no', 0, ''),
(72, 'je confirme', 'mbutiji_emanuel', 'none', '2021-09-05 14:56:33', 'no', 'no', 0, 'Assets/images/posts6134cc9129caatesla search.png'),
(73, 'hehehehe', 'mbutiji_emanuel', 'miki_mouce', '2021-09-05 14:57:16', 'no', 'no', 0, 'Assets/images/posts6134ccbcbdba4findam1.PNG');

-- --------------------------------------------------------

--
-- Table structure for table `trends`
--

CREATE TABLE `trends` (
  `title` varchar(50) NOT NULL,
  `hits` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `trends`
--

INSERT INTO `trends` (`title`, `hits`) VALUES
('Hello', 1),
('Guys', 1),
('Looking', 1),
('Foward', 1),
('Start', 1),
('University', 1),
('Morning', 1),
('Ji', 1),
('Cool', 2),
('Doing', 6),
('Happening', 1),
('Love', 1),
('Coki', 1),
('Cava', 1),
('Bien', 1),
('Blessed', 1),
('Sunday', 1),
('Jjj', 1),
('Kkkk', 1),
('Ohhhhhhhh', 1),
('Je', 1),
('Confirme', 1),
('Hehehehe', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(25) NOT NULL,
  `last_name` varchar(25) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `Upassword` varchar(255) NOT NULL,
  `signup_date` date NOT NULL,
  `profile_pic` varchar(255) NOT NULL,
  `num_posts` int(11) NOT NULL,
  `num_likes` int(11) NOT NULL,
  `user_closed` varchar(3) NOT NULL,
  `friend_array` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `username`, `email`, `Upassword`, `signup_date`, `profile_pic`, `num_posts`, `num_likes`, `user_closed`, `friend_array`) VALUES
(2, 'Mbutiji', 'Emanuel', 'mbutiji_emanuel', 'mbutiji1@gmail.com', 'b248e08d5c23541514558eea059c08cf', '2021-06-08', 'Assets/images/profile_pics/mbutiji_emanueld2a3f99baf89e2a3bd4feeaf6118bce6n.jpeg', 29, 12, 'no', ',mogo_mouce,dev_pro,clinton_clinton,miki_mouce,'),
(3, 'Mbutiji', 'Emanuel', 'mbutiji_emanuel_1', 'Manube@gmail.com', 'b248e08d5c23541514558eea059c08cf', '2021-06-08', 'Assets/images/profile_pics/defaults/head_pete_river.png', 1, 0, 'no', ',mogo_mouce,'),
(5, 'Miki', 'Mouce', 'miki_mouce', 'Miki@gmail.com', 'b248e08d5c23541514558eea059c08cf', '2021-06-08', 'Assets/images/profile_pics/defaults/head_deep_blue.png', 13, 2, 'no', ',momo_me,clinton_clinton,mbutiji_emanuel,'),
(6, 'Mogo', 'Mouce', 'mogo_mouce', 'Mogo@gmail.com', 'b248e08d5c23541514558eea059c08cf', '2021-06-08', 'Assets/images/profile_pics/mogo_moucee94e9c1c62be8c346254c3236a6b7aadn.jpeg', 11, 0, 'no', ',mbutiji_emanuel,mbutiji_emanuel_1,clinton_clinton,'),
(7, 'Mogo', 'Mouce', 'mogo_mouce_1', 'Mog@gmail.com', 'b248e08d5c23541514558eea059c08cf', '2021-06-08', 'Assets/images/profile_pics/defaults/head_deep_blue.png', 2, 2, 'no', ',mogo_mouce,'),
(8, 'Momo', 'Me', 'momo_me', 'Momome@gmail.com', 'b248e08d5c23541514558eea059c08cf', '2021-06-27', 'Assets/images/profile_pics/defaults/head_pete_river.png', 7, 1, 'no', ',miki_mouce,'),
(9, 'Dev', 'Pro', 'dev_pro', 'Devpro@gmail.com', 'b248e08d5c23541514558eea059c08cf', '2021-06-27', 'Assets/images/profile_pics/defaults/head_pete_river.png', 0, 0, 'no', ',mbutiji_emanuel,'),
(10, 'Clinton', 'Clinton', 'clinton_clinton', 'Clinton@gmail.com', 'b248e08d5c23541514558eea059c08cf', '2021-09-01', 'Assets/images/profile_pics/defaults/head_deep_blue.png', 0, 0, 'no', ',mbutiji_emanuel,mogo_mouce,miki_mouce,');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `friend_requests`
--
ALTER TABLE `friend_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
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
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `friend_requests`
--
ALTER TABLE `friend_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
