-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 09, 2018 at 09:45 AM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bmt_table`
--

-- --------------------------------------------------------

--
-- Table structure for table `t_autocomplete_tob`
--

CREATE TABLE `t_autocomplete_tob` (
  `tob_id` int(11) NOT NULL,
  `name` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `t_business_entity`
--

CREATE TABLE `t_business_entity` (
  `b_e_id` int(11) NOT NULL,
  `c_name` varchar(20) DEFAULT NULL,
  `c_status` int(11) NOT NULL DEFAULT '1',
  `c_date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `t_business_entity`
--

INSERT INTO `t_business_entity` (`b_e_id`, `c_name`, `c_status`, `c_date_added`) VALUES
(1, 'PT', 1, '2018-05-24 14:12:59'),
(2, 'Koperasi', 1, '2018-05-24 14:12:59'),
(3, 'CV', 1, '2018-05-24 14:12:59'),
(4, 'Perorangan', 1, '2018-05-24 14:12:59');

-- --------------------------------------------------------

--
-- Table structure for table `t_currency`
--

CREATE TABLE `t_currency` (
  `currency_id` int(11) NOT NULL,
  `c_title` varchar(32) DEFAULT NULL,
  `c_code` varchar(3) DEFAULT NULL,
  `c_symbol_left` varchar(12) DEFAULT NULL,
  `c_symbol_right` varchar(12) DEFAULT NULL,
  `c_decimal_place` char(1) CHARACTER SET latin1 NOT NULL,
  `c_value` float(15,8) NOT NULL,
  `c_status` tinyint(1) NOT NULL,
  `c_date_modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `t_currency`
--

INSERT INTO `t_currency` (`currency_id`, `c_title`, `c_code`, `c_symbol_left`, `c_symbol_right`, `c_decimal_place`, `c_value`, `c_status`, `c_date_modified`) VALUES
(1, 'Rupiah', 'IDR', 'Rp', ' ', '', 1.00000000, 1, '2018-06-09 14:19:07');

-- --------------------------------------------------------

--
-- Table structure for table `t_get_rest_api`
--

CREATE TABLE `t_get_rest_api` (
  `_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `t_promo`
--

CREATE TABLE `t_promo` (
  `promo_id` int(11) NOT NULL,
  `ref_merchant_id` int(11) DEFAULT NULL,
  `c_name` varchar(20) NOT NULL,
  `c_config_mdr_money` decimal(10,0) DEFAULT NULL,
  `c_config_mdr_percentage` decimal(10,0) DEFAULT NULL,
  `c_status` tinyint(4) DEFAULT NULL,
  `c_start_date` date DEFAULT NULL,
  `c_end_date` date DEFAULT NULL,
  `c_added_by` int(11) DEFAULT NULL,
  `c_date_added` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `t_promo`
--

INSERT INTO `t_promo` (`promo_id`, `ref_merchant_id`, `c_name`, `c_config_mdr_money`, `c_config_mdr_percentage`, `c_status`, `c_start_date`, `c_end_date`, `c_added_by`, `c_date_added`) VALUES
(1, 4, 'Promo lebaran', '4000', '0', 0, '2018-06-12', '2018-06-22', 1, '2018-06-09 14:04:59'),
(2, 6, 'Promo lebaran', '50000', '0', 1, '2018-06-13', '2018-06-21', 1, '2018-06-09 14:07:01');

-- --------------------------------------------------------

--
-- Table structure for table `t_user`
--

CREATE TABLE `t_user` (
  `user_id` int(11) NOT NULL,
  `c_username` varchar(20) NOT NULL,
  `c_password` varchar(50) NOT NULL,
  `c_email` varchar(200) DEFAULT NULL,
  `c_fullname` varchar(150) DEFAULT NULL,
  `c_salt` varchar(9) DEFAULT NULL,
  `c_status` tinyint(1) NOT NULL DEFAULT '0',
  `ref_group_id` int(11) NOT NULL,
  `c_approved` int(11) NOT NULL DEFAULT '0',
  `c_phone_number` varchar(20) DEFAULT NULL,
  `c_parent_id` int(11) NOT NULL DEFAULT '0',
  `c_date_added` datetime DEFAULT CURRENT_TIMESTAMP,
  `c_address` varchar(500) DEFAULT NULL,
  `ref_business_entity` int(11) NOT NULL,
  `c_type_of_business` text,
  `c_shop_logo` varchar(200) DEFAULT NULL,
  `c_document_cooperation` varchar(500) DEFAULT NULL,
  `c_name_pic` varchar(50) DEFAULT NULL,
  `c_identity_responsible` varchar(100) DEFAULT NULL,
  `c_identity_number` varchar(50) DEFAULT NULL,
  `c_config_mdr_money` decimal(10,0) NOT NULL DEFAULT '0',
  `c_config_mdr_percentage` decimal(10,0) NOT NULL DEFAULT '0',
  `c_business_field` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `t_user`
--

INSERT INTO `t_user` (`user_id`, `c_username`, `c_password`, `c_email`, `c_fullname`, `c_salt`, `c_status`, `ref_group_id`, `c_approved`, `c_phone_number`, `c_parent_id`, `c_date_added`, `c_address`, `ref_business_entity`, `c_type_of_business`, `c_shop_logo`, `c_document_cooperation`, `c_name_pic`, `c_identity_responsible`, `c_identity_number`, `c_config_mdr_money`, `c_config_mdr_percentage`, `c_business_field`) VALUES
(1, 'ibez', '40cbaeba92411e8b1b79133c83f88aa8047d6e23', 'sfdhdsfhdsfh@gmail.com', 'Muhammad Bestari', 'RyDxshc1y', 1, 1, 1, NULL, 1, '2018-05-18 11:23:41', 'zfdhgdfhsdfhsdfhdghsgdh', 2, '{\"selected\":{\"name\":\"online\",\"code\":\"1\"},\"type_business\":[{\"website\":[\"sdfhsdfhsdfh\"],\"instagram\":[\"wegsdrgdfh\"],\"bbm\":[\"sdfhsfhj\"],\"twitter\":[\"dfgjdfgj\"],\"facebook\":[\"sdgasdg\"],\"kaskus\":[\"\"]}]}', '1/420.png', '1/28058952_1994814377507078_7042548743190581592_n.jpg', 'ibez', 'halooo', '346346743', '70000', '0', 'dsfhsdfhsdfghfg'),
(2, 'joko', '731fb14676ee9c2528171410d9bd34391f8a1975', 'sfdhdsfhdsfh@gmail.com', 'joko', 'aUXIy48Np', 1, 2, 1, '456356356', 1, '2018-05-18 11:23:41', 'zfdhgdfhsdfhsdfhdghsgdh', 2, '{\"selected\":{\"name\":\"online\",\"code\":\"1\"},\"type_business\":[{\"website\":[\"sdfhsdfhsdfh\"],\"instagram\":[\"wegsdrgdfh\"],\"bbm\":[\"sdfhsfhj\"],\"twitter\":[\"dfgjdfgj\"],\"facebook\":[\"sdgasdg\"],\"kaskus\":[\"\"]}]}', '1/420.png', '1/28058952_1994814377507078_7042548743190581592_n.jpg', 'ibez', 'halooo', '346346743', '70000', '0', 'dsfhsdfhsdfghfg'),
(3, 'dona', '731fb14676ee9c2528171410d9bd34391f8a1975', 'sfdhdsfhdsfh@gmail.com', 'dona', 'aUXIy48Np', 1, 2, 1, '3656546547', 1, '2018-05-18 11:23:41', 'zfdhgdfhsdfhsdfhdghsgdh', 2, '{\"selected\":{\"name\":\"online\",\"code\":\"1\"},\"type_business\":[{\"website\":[\"sdfhsdfhsdfh\"],\"instagram\":[\"wegsdrgdfh\"],\"bbm\":[\"sdfhsfhj\"],\"twitter\":[\"dfgjdfgj\"],\"facebook\":[\"sdgasdg\"],\"kaskus\":[\"\"]}]}', '1/420.png', '1/28058952_1994814377507078_7042548743190581592_n.jpg', 'ibez', 'halooo', '346346743', '70000', '0', 'dsfhsdfhsdfghfg'),
(4, 'angga', '731fb14676ee9c2528171410d9bd34391f8a1975', 'sfdhdsfhdsfh@gmail.com', 'angga', 'aUXIy48Np', 0, 2, 1, NULL, 1, '2018-05-26 18:38:29', 'zfdhgdfhsdfhsdfhdghsgdh', 2, '{\"selected\":{\"name\":\"online\",\"code\":\"1\"},\"type_business\":[{\"website\":[\"sdfhsdfhsdfh\"],\"instagram\":[\"wegsdrgdfh\"],\"bbm\":[\"sdfhsfhj\"],\"twitter\":[\"dfgjdfgj\"],\"facebook\":[\"sdgasdg\"],\"kaskus\":[\"\"]}]}', '1/420.png', '1/28058952_1994814377507078_7042548743190581592_n.jpg', 'ibez', 'halooo', '346346743', '70000', '0', 'dsfhsdfhsdfghfg'),
(5, 'randi', '731fb14676ee9c2528171410d9bd34391f8a1975', 'sfdhdsfhdsfh@gmail.com', 'randi', 'aUXIy48Np', 0, 2, 1, NULL, 1, '2018-05-26 18:39:41', 'zfdhgdfhsdfhsdfhdghsgdh', 2, '{\"selected\":{\"name\":\"online\",\"code\":\"1\"},\"type_business\":[{\"website\":[\"sdfhsdfhsdfh\"],\"instagram\":[\"wegsdrgdfh\"],\"bbm\":[\"sdfhsfhj\"],\"twitter\":[\"dfgjdfgj\"],\"facebook\":[\"sdgasdg\"],\"kaskus\":[\"\"]}]}', '1/420.png', '1/28058952_1994814377507078_7042548743190581592_n.jpg', 'ibez', 'halooo', '346346743', '70000', '0', 'dsfhsdfhsdfghfg'),
(6, 'angga2', '731fb14676ee9c2528171410d9bd34391f8a1975', 'sfdhdsfhdsfh@gmail.com', 'angga2', 'aUXIy48Np', 0, 2, 1, NULL, 1, '2018-05-26 18:40:57', 'zfdhgdfhsdfhsdfhdghsgdh', 2, '{\"selected\":{\"name\":\"online\",\"code\":\"1\"},\"type_business\":[{\"website\":[\"sdfhsdfhsdfh\"],\"instagram\":[\"wegsdrgdfh\"],\"bbm\":[\"sdfhsfhj\"],\"twitter\":[\"dfgjdfgj\"],\"facebook\":[\"sdgasdg\"],\"kaskus\":[\"\"]}]}', '1/30715259_730903970446488_8296447012669227008_n.png', '1/28058952_1994814377507078_7042548743190581592_n.jpg', 'ibez', 'halooo', '346346743', '70000', '0', 'dsfhsdfhsdfghfg'),
(7, 'didik', 'a5ebe9d95dd8bd1ff5eac5d7732643159f742d9a', 'sfdhdsfhdsfh@gmail.com', 'didik', 'fzHG87bz8', 0, 2, 1, NULL, 1, '2018-05-27 10:23:16', 'zfdhgdfhsdfhsdfhdghsgdh', 2, '{\"selected\":{\"name\":\"online\",\"code\":\"1\"},\"type_business\":[{\"website\":[\"sdfhsdfhsdfh\"],\"instagram\":[\"wegsdrgdfh\"],\"bbm\":[\"sdfhsfhj\"],\"twitter\":[\"dfgjdfgj\"],\"facebook\":[\"sdgasdg\"],\"kaskus\":[\"\"]}]}', '1/30715259_730903970446488_8296447012669227008_n.png', '1/28058952_1994814377507078_7042548743190581592_n.jpg', 'ibez', 'mabuk', '346346743', '70000', '0', 'dsfhsdfhsdfghfg'),
(8, 'jsdhgjdsg', '19530bd1066d22420991d2c7173e03835ca0274d', 'jsdhgjdfshg@gjdhfg.com', 'hgsdhgfadgsh', '0KeyFwANJ', 1, 1, 1, '89786345', 0, '2018-06-05 20:30:02', NULL, 0, '', NULL, NULL, NULL, NULL, NULL, '0', '0', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t_user_group`
--

CREATE TABLE `t_user_group` (
  `group_id` int(11) NOT NULL,
  `c_name` varchar(20) DEFAULT NULL,
  `c_permission` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `t_user_group`
--

INSERT INTO `t_user_group` (`group_id`, `c_name`, `c_permission`) VALUES
(1, 'Merchant Acquirer', '{\"access\":[\"merchant\",\"cashier\",\"promo\",\"account\",\"report\"]}'),
(2, 'Merchant', '{\"access\":[\"cashier\",\"account\",\"report\"]}'),
(3, 'Cabang', NULL),
(4, 'Kasir', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t_autocomplete_tob`
--
ALTER TABLE `t_autocomplete_tob`
  ADD PRIMARY KEY (`tob_id`);

--
-- Indexes for table `t_business_entity`
--
ALTER TABLE `t_business_entity`
  ADD PRIMARY KEY (`b_e_id`);

--
-- Indexes for table `t_currency`
--
ALTER TABLE `t_currency`
  ADD PRIMARY KEY (`currency_id`);

--
-- Indexes for table `t_get_rest_api`
--
ALTER TABLE `t_get_rest_api`
  ADD PRIMARY KEY (`_id`);

--
-- Indexes for table `t_promo`
--
ALTER TABLE `t_promo`
  ADD PRIMARY KEY (`promo_id`);

--
-- Indexes for table `t_user`
--
ALTER TABLE `t_user`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `c_username` (`c_username`),
  ADD KEY `c_fullname` (`c_fullname`),
  ADD KEY `c_password` (`c_password`);

--
-- Indexes for table `t_user_group`
--
ALTER TABLE `t_user_group`
  ADD PRIMARY KEY (`group_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t_autocomplete_tob`
--
ALTER TABLE `t_autocomplete_tob`
  MODIFY `tob_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `t_business_entity`
--
ALTER TABLE `t_business_entity`
  MODIFY `b_e_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `t_currency`
--
ALTER TABLE `t_currency`
  MODIFY `currency_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `t_get_rest_api`
--
ALTER TABLE `t_get_rest_api`
  MODIFY `_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `t_promo`
--
ALTER TABLE `t_promo`
  MODIFY `promo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `t_user`
--
ALTER TABLE `t_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `t_user_group`
--
ALTER TABLE `t_user_group`
  MODIFY `group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
