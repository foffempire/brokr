-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 26, 2024 at 10:16 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crypto_broker_2`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_user`
--

CREATE TABLE `admin_user` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_user`
--

INSERT INTO `admin_user` (`id`, `email`, `password`, `level`) VALUES
(1, 'mo6014245571@gmail.com', 'science', 0),
(2, 'info@adminarea.com', 'password@1', 0);

-- --------------------------------------------------------

--
-- Table structure for table `coins`
--

CREATE TABLE `coins` (
  `id` int(11) NOT NULL,
  `coin_name` varchar(255) DEFAULT NULL,
  `coin_slug` varchar(255) DEFAULT NULL,
  `coin_img` varchar(255) DEFAULT NULL,
  `is_active` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coins`
--

INSERT INTO `coins` (`id`, `coin_name`, `coin_slug`, `coin_img`, `is_active`) VALUES
(1, 'Bitcoin', 'btc', 'btc.png', 1),
(2, 'Ethereum', 'eth', 'eth.png', 1),
(3, 'Litecoin', 'ltc', 'ltc.png', 0),
(4, 'Ripple', 'xrp', 'xrp.png', 0),
(5, 'Bitcoin Cash', 'bch', 'bch.png', 0),
(6, 'USD Coin', 'usdc', 'usdc.png', 0),
(8, 'Tether (USDT)', 'usdt', 'usdt.png', 0);

-- --------------------------------------------------------

--
-- Table structure for table `deposit`
--

CREATE TABLE `deposit` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `transaction_id` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `amount` double NOT NULL,
  `fee` double NOT NULL,
  `status` varchar(255) NOT NULL,
  `gateway` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `datetime` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `deposit`
--

INSERT INTO `deposit` (`id`, `email`, `transaction_id`, `type`, `amount`, `fee`, `status`, `gateway`, `image`, `datetime`) VALUES
(1, 'mo6014245571@gmail.com', 'JJHMVL0OAO', 'Deposit', 50000, 0, 'pending', 'BTC', 'BTC1719179072.jpg', 'Jun 23, 2024 05:44 pm'),
(2, 'mo6014245571@gmail.com', '5SIPQCOK62', 'Deposit', 100, 0, 'pending', 'Ethereum', 'Ethereum1719179156.jpg', 'Jun 23, 2024 05:45 pm'),
(6, 'salt.ogbuji@saltmts.com', '0CSEHUNMRQ', 'Deposit', 133, 0, 'completed', 'Ethereum', 'Ethereum1719216148.jpg', 'Jun 24, 2024 04:02 am');

-- --------------------------------------------------------

--
-- Table structure for table `investments`
--

CREATE TABLE `investments` (
  `id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `transaction_id` varchar(255) DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `package` varchar(255) DEFAULT NULL,
  `rate` double DEFAULT NULL,
  `gateway` varchar(255) DEFAULT NULL,
  `status` enum('pending','completed','running') NOT NULL DEFAULT 'pending',
  `date_added` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `investments`
--

INSERT INTO `investments` (`id`, `email`, `transaction_id`, `amount`, `package`, `rate`, `gateway`, `status`, `date_added`) VALUES
(15, 'mo6014245571@gmail.com', 'NJVHF3UQZR', 200, 'Starter Plan', 15, 'profit', 'running', 'Jun 18, 2024 06:14 pm'),
(16, 'mo6014245571@gmail.com', 'BNKO8CHLUP', 6000, 'Advance Plan', 27.5, 'main', 'running', 'Jun 18, 2024 06:16 pm'),
(17, 'foffempire@gmail.com', 'A0Y4ODVLFX', 16000, 'Pro Plan', 35.5, 'gateway', 'pending', 'Jun 19, 2024 08:19 am'),
(19, 'salt.ogbuji@saltmts.com', 'RTPVNMW8JY', 600, 'Starter Plan', 15, 'main', 'completed', 'Jun 24, 2024 02:32 am');

-- --------------------------------------------------------

--
-- Table structure for table `kyc`
--

CREATE TABLE `kyc` (
  `id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `verify_type` varchar(255) DEFAULT NULL,
  `fullnames` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` enum('Under review','Approved','Rejected','') NOT NULL DEFAULT 'Under review'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kyc`
--

INSERT INTO `kyc` (`id`, `email`, `verify_type`, `fullnames`, `image`, `status`) VALUES
(2, 'mo6014245571@gmail.com', 'Drivers License', 'John Kachibo', 'John Kachibo1718621277.jpg', 'Rejected'),
(4, 'mo6014245571@gmail.com', 'Drivers License', 'John Kachibo', 'John Kachibo1718622882.jpg', 'Under review'),
(5, 'salt.ogbuji@saltmts.com', 'Drivers License', 'Salt Ogbuji', 'Salt Ogbuji1719219892.png', 'Approved');

-- --------------------------------------------------------

--
-- Table structure for table `plans`
--

CREATE TABLE `plans` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `min` varchar(255) NOT NULL,
  `max` varchar(255) DEFAULT NULL,
  `percentage` varchar(255) DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `plans`
--

INSERT INTO `plans` (`id`, `name`, `min`, `max`, `percentage`, `note`) VALUES
(1, 'Starter Plan', '200', '999', '15', 'Saturday, Sunday are Holidays'),
(2, 'Standard Plan', '1000', '4999', '25.4', 'No Profit Holidays'),
(3, 'Advance Plan', '5000', '9999', '27.5', 'No Profit Holidays'),
(4, 'Pro Plan', '10000', '30000', '35.5', 'No Profit Holidays');

-- --------------------------------------------------------

--
-- Table structure for table `send_money`
--

CREATE TABLE `send_money` (
  `id` int(11) NOT NULL,
  `sender` varchar(255) DEFAULT NULL,
  `receiver` varchar(255) DEFAULT NULL,
  `amount` varchar(255) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `tid` varchar(2552) DEFAULT NULL,
  `date_added` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `send_money`
--

INSERT INTO `send_money` (`id`, `sender`, `receiver`, `amount`, `note`, `tid`, `date_added`) VALUES
(1, 'mo6014245571@gmail.com', 'foffempire@gmail.com', '90', 'noted', '4R5T2DEWKH', 'Jun 19, 2024 05:22 am'),
(2, 'mo6014245571@gmail.com', 'foffempire@gmail.com', '10', '', '1NYM2DEWKH', 'Jun 19, 2024 05:25 am'),
(3, 'foffempire@gmail.com', 'mo6014245571@gmail.com', '23', '', '6WKSOSIZYX', 'Jun 19, 2024 08:30 am');

-- --------------------------------------------------------

--
-- Table structure for table `support`
--

CREATE TABLE `support` (
  `id` int(11) NOT NULL,
  `ticketid` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `date_added` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `support`
--

INSERT INTO `support` (`id`, `ticketid`, `email`, `title`, `description`, `image`, `date_added`) VALUES
(2, '0', 'foffempire@gmail.com', 'Urgent', 'call me', 'foffempire@gmail.com1718803072.jpg', 'Jun 19, 2024 09:17 am'),
(3, 'K9OHS18PXF', 'foffempire@gmail.com', 'adrgsdfgdf', 'gfgjfnhyjfghjg h', 'foffempire@gmail.com1718803149.jpg', 'Jun 19, 2024 09:19 am'),
(4, 'T5SEKXDOYG', 'foffempire@gmail.com', 'Urgent ticket', 'please treat as urgent', 'foffempire@gmail.com1718803203.jpg', 'Jun 19, 2024 09:20 am'),
(5, '2HNMU94EJW', 'foffempire@gmail.com', 'no image', 'sdvs dv sdoc isjdpichsdjcsdcsdcsdcsdvcsdcsd\r\ns\r\nvd\r\nvs\r\ndv\r\nfv', NULL, 'Jun 19, 2024 09:27 am');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `transaction_id` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `amount` double NOT NULL,
  `fee` double NOT NULL,
  `status` varchar(255) NOT NULL,
  `gateway` varchar(255) NOT NULL,
  `datetime` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `email`, `transaction_id`, `type`, `amount`, `fee`, `status`, `gateway`, `datetime`) VALUES
(2, 'mo6014245571@gmail.com', 'asdfasdfaasdasd', 'Signup Bonus', 10, 0, 'Success', 'System', 'Jun 12, 2024 23:45'),
(4, 'salt@salt.com', 'RVESPXMWXQ', 'Signup Bonus', 10, 0, 'Success', 'System', 'Jun 20, 2024 05:11 am'),
(5, 'salt.ogbuji@saltmts.com', 'ANIRFQESX3', 'Signup Bonus', 10, 0, 'Success', 'System', 'Jun 21, 2024 04:54 am'),
(13, 'foffempire@gmail.com', 'EWCS94BP1J', 'Signup Bonus', 10, 0, 'Success', 'System', 'Jun 23, 2024 04:28 pm');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `middlename` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `addr` text DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `zipcode` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `occupation` varchar(255) DEFAULT NULL,
  `dob` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `is_verified` tinyint(4) NOT NULL DEFAULT 0,
  `pw_reset_code` varchar(255) DEFAULT NULL,
  `unique_id` varchar(255) DEFAULT NULL,
  `referrer` varchar(255) DEFAULT NULL,
  `referrer_bonus` double DEFAULT 0,
  `bal` double NOT NULL DEFAULT 0,
  `profit` double NOT NULL DEFAULT 10,
  `profit_rate` varchar(255) NOT NULL DEFAULT '0',
  `bonusalert` int(11) DEFAULT 0,
  `is_active` int(11) DEFAULT 1,
  `reg_date` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `email`, `username`, `password`, `firstname`, `lastname`, `middlename`, `phone`, `addr`, `state`, `country`, `city`, `zipcode`, `gender`, `occupation`, `dob`, `image`, `is_verified`, `pw_reset_code`, `unique_id`, `referrer`, `referrer_bonus`, `bal`, `profit`, `profit_rate`, `bonusalert`, `is_active`, `reg_date`) VALUES
(9, 'salt@salt.com', 'salt11', 'science', 'salt', 'ogbuji', NULL, '+23412233445', NULL, NULL, 'nigeria', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'Ov5r9tHV2skQ4uT', 'Ov5r9tHV2skQ4uT', 'EKlj3rfuwd', 0, 10, 0, '0', 1, 0, 'Jun 20, 2024 05:11 am'),
(11, 'salt.ogbuji@saltmts.com', 'salt', 'plokijuhy', 'salt', 'ogbuji', NULL, '+23423242434', NULL, NULL, 'nigeria', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'ZUgr6x5aj21S0Yy', 'ZUgr6x5aj21S0Yy', NULL, 0, 49400, 122, '10', 1, 1, 'Jun 21, 2024 05:04 am'),
(17, 'mo6014245571@gmail.com', 'james', 'science', 'James', 'Rodrigo', NULL, '+35607084797585', NULL, NULL, 'Malta', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'IhseZ75Cuw0QXr1', 'IhseZ75Cuw0QXr1', NULL, 0, 2323, 2344, '123', 1, 1, 'Jun 21, 2024 06:58 am'),
(18, 'foffempire@gmail.com', 'foffempire', 'dmbea7U48wl3', 'John', 'Kachibo', NULL, '+21207084797585', NULL, NULL, 'Morocco', NULL, NULL, NULL, NULL, NULL, NULL, 0, 't4HbwXp0GRvPJli', 't4HbwXp0GRvPJli', 'IhseZ75Cuw0QXr1', 0, 100, 10, '0', 0, 1, 'Jun 23, 2024 04:28 pm');

-- --------------------------------------------------------

--
-- Table structure for table `wallets`
--

CREATE TABLE `wallets` (
  `id` int(11) NOT NULL,
  `wallet_type` varchar(255) DEFAULT NULL,
  `wallet_address` varchar(255) DEFAULT NULL,
  `qr_code` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wallets`
--

INSERT INTO `wallets` (`id`, `wallet_type`, `wallet_address`, `qr_code`) VALUES
(12, 'btc', 'btcDRbunqD6J7VipNsMsXiNUYX996YHWcBkK3', ''),
(13, 'eth', 'ethDRbunqD6J7VipNsMsXiNUYX996YHWcBkK3', '');

-- --------------------------------------------------------

--
-- Table structure for table `withdrawals`
--

CREATE TABLE `withdrawals` (
  `id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `transaction_id` varchar(255) DEFAULT NULL,
  `wallet_type` varchar(255) DEFAULT NULL,
  `wallet_address` varchar(255) DEFAULT NULL,
  `amount` varchar(255) DEFAULT NULL,
  `status` enum('pending','completed') NOT NULL DEFAULT 'pending',
  `date_added` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `withdrawals`
--

INSERT INTO `withdrawals` (`id`, `email`, `transaction_id`, `wallet_type`, `wallet_address`, `amount`, `status`, `date_added`) VALUES
(2, 'mo6014245571@gmail.com', 'PKMS5ZWCEY', 'Ethereum', 'bthasdfasdfasdfasdfasdfasdfasdfa', '50000', 'pending', 'Jun 23, 2024 06:53 pm'),
(3, 'salt.ogbuji@saltmts.com', 'EW6XPFIHVU', 'Ethereum', 'etheth1234567eeffddaabbc', '1000', 'completed', 'Jun 24, 2024 03:31 am'),
(4, 'salt.ogbuji@saltmts.com', '2KXMBONGP9', 'BTC', 'btcbtc1234567eeffddaabbc', '100', 'pending', 'Jun 24, 2024 03:33 am');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_user`
--
ALTER TABLE `admin_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`email`);

--
-- Indexes for table `coins`
--
ALTER TABLE `coins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deposit`
--
ALTER TABLE `deposit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `investments`
--
ALTER TABLE `investments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kyc`
--
ALTER TABLE `kyc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `send_money`
--
ALTER TABLE `send_money`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support`
--
ALTER TABLE `support`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `wallets`
--
ALTER TABLE `wallets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `withdrawals`
--
ALTER TABLE `withdrawals`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_user`
--
ALTER TABLE `admin_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `coins`
--
ALTER TABLE `coins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `deposit`
--
ALTER TABLE `deposit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `investments`
--
ALTER TABLE `investments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `kyc`
--
ALTER TABLE `kyc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `plans`
--
ALTER TABLE `plans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `send_money`
--
ALTER TABLE `send_money`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `support`
--
ALTER TABLE `support`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `wallets`
--
ALTER TABLE `wallets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `withdrawals`
--
ALTER TABLE `withdrawals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
