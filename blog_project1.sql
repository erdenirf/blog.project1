-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 18, 2018 at 07:56 AM
-- Server version: 10.2.19-MariaDB-10.2.19+maria~xenial-log
-- PHP Version: 7.2.13-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog_project1`
--

-- --------------------------------------------------------

--
-- Table structure for table `confirm_emails`
--

CREATE TABLE `confirm_emails` (
  `id` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `email` varchar(72) NOT NULL,
  `date_expires` timestamp NOT NULL DEFAULT current_timestamp
) ;

--
-- Dumping data for table `confirm_emails`
--

INSERT INTO `confirm_emails` (`id`, `token`, `email`, `date_expires`) VALUES
(12, '$2y$10$cWzzoImOaLAXwaaDHBQM1OkQzi54cI8n8Ci/aryslIT5wbWd9w3pC', 'erdeni@test.ru', '2018-12-18 11:26:55'),
(14, '$2y$10$x1s7I4SWaIUgd9sVLmYSWO2tGbXWRqphkUGFgX37N.WPvlEirqASq', 'dog@mail.ru', '2018-12-18 11:44:03'),
(15, '$2y$10$dn2ItwzlZA4raz4NQqCdHeU58.C1klNs38B1e.deSwF5O8/5aI276', 'erdenirf@gmail.com', '2018-12-18 13:20:23'),
(16, '$2y$10$VV5V5odc38qKdH.rXVtJKevHjl.lWZ9zRoZuNRU/nqPcGin2sQ7cy', 'erdenirf@gmail.com', '2018-12-18 13:23:21'),
(17, '$2y$10$fVXG.bGZog3iMTJnrhuGYO8bc2BGtt9lMg254pGum3EsqKt.J8G.q', 'jest@test.ru', '2018-12-18 13:24:47'),
(18, '$2y$10$aW5E5THX/Mb9HUyq0pT17.igQ/USIR73s0j6f4Hn3s9Ew/I5BJYfm', 'kk@mail.ru', '2018-12-18 13:27:16');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(10) NOT NULL,
  `header` varchar(51) NOT NULL,
  `body` text NOT NULL,
  `login_author` varchar(100) NOT NULL,
  `time_created` timestamp NOT NULL DEFAULT current_timestamp
) ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `login` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `first_name` text NOT NULL,
  `last_name` text NOT NULL,
  `created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated` timestamp NOT NULL DEFAULT current_timestamp
) ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `login`, `email`, `password`, `first_name`, `last_name`, `created`, `updated`, `email_confirmed`) VALUES
(36, 'erdeni', 'erdeni@test.ru', '$2y$10$BO/0CIE4LLTW66WC/aZeBuYNqFmbbz6rvXwSdV.HHBngY1V0/5NHW', 'e', 'e', '2018-12-17 11:26:55', '2018-12-17 11:26:55', 1),
(39, 'dog', 'dog@mail.ru', '$2y$10$s.3qmEUKpTV6YLs9lunkvO89niTVOwwbtIVFaife9MoZnom6J6gka', 'dj', 'dj', '2018-12-17 11:44:03', '2018-12-17 11:44:03', 1),
(41, 'erdenirf', 'erdenirf@gmail.com', '$2y$10$8EOweMgNonEImrOwOr0H6udyVSkxn8MmAM8BAj6ZJuwJnSlDs1Qhm', 'dj', 'dj', '2018-12-17 13:23:21', '2018-12-17 13:23:21', 0),
(42, 'jest', 'jest@test.ru', '$2y$10$8RWXjxdbClWbHhyP4nQ4Bur3lb7XNnvSfTifx6AJQ0LVIHoF.klBy', 'dj', 'dj', '2018-12-17 13:24:47', '2018-12-17 13:24:47', 0),
(43, 'kk', 'kk@mail.ru', '$2y$10$x67CmSMx68XrCKagO8XMfeEt9nFQ62f421cCifNszNGsjfCUfIovW', 'kk', 'kk', '2018-12-17 13:27:16', '2018-12-17 13:27:16', 1);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `confirm_emails`
--
ALTER TABLE `confirm_emails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
