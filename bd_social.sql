-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 22-Abr-2018 às 23:20
-- Versão do servidor: 10.1.30-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bd_social`
--
CREATE DATABASE IF NOT EXISTS `bd_social` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `bd_social`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_comments`
--

CREATE TABLE `tb_comments` (
  `id_comment` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_post` int(11) NOT NULL,
  `the_comment` varchar(240) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_posts`
--

CREATE TABLE `tb_posts` (
  `id_post` int(11) NOT NULL,
  `the_post` varchar(240) COLLATE utf8_unicode_ci NOT NULL,
  `date` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `tb_posts`
--

INSERT INTO `tb_posts` (`id_post`, `the_post`, `date`, `id_user`) VALUES
(1, 'Meu primeiro post! Uhull!!!', '18/04/2018', 1),
(2, 'Meu primeiro post tbm! lalala!', '18/04/2018', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_users`
--

CREATE TABLE `tb_users` (
  `id_user` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `user_name` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `profile_img` text COLLATE utf8_unicode_ci NOT NULL,
  `id_followers` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `tb_users`
--

INSERT INTO `tb_users` (`id_user`, `name`, `email`, `user_name`, `password`, `profile_img`, `id_followers`) VALUES
(1, 'Jason Sobreiro', 'jason.sobreiro@gmail.com', 'JaySobreiro', 'lalala123', 'foto1.jpg', '2,4'),
(2, 'Mariana Oliveira', 'mari@na.com', 'Mari@na', '1234', 'foto2.jpg', '1'),
(3, 'Jorge Felipe', 'jorge@gmail.com', 'JorJorge', 'qwerty', 'foto3.jpg', '2'),
(4, 'Dafne', 'dafne@dafne.com', 'Dafnewho', 'asdf', '819d6e474ff18a21c0a381634dec0877.jpg', '1,3'),
(5, 'Caio Roque pereira', 'caioroque879@gmail.com', 'caio', 'caio', 'f476b2ab86729f248015fa88ef34d20a.png', '1,3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_comments`
--
ALTER TABLE `tb_comments`
  ADD PRIMARY KEY (`id_comment`);

--
-- Indexes for table `tb_posts`
--
ALTER TABLE `tb_posts`
  ADD PRIMARY KEY (`id_post`);

--
-- Indexes for table `tb_users`
--
ALTER TABLE `tb_users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_comments`
--
ALTER TABLE `tb_comments`
  MODIFY `id_comment` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_posts`
--
ALTER TABLE `tb_posts`
  MODIFY `id_post` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tb_users`
--
ALTER TABLE `tb_users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
