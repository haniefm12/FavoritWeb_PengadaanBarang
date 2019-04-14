-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 14, 2019 at 07:32 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `favorit`
--

-- --------------------------------------------------------

--
-- Table structure for table `account_recievable`
--

CREATE TABLE `account_recievable` (
  `tanggal` date NOT NULL,
  `id_debts` int(11) NOT NULL,
  `supplier` varchar(30) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `sisa_tagihan` int(20) DEFAULT NULL,
  `total_tagihan` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account_recievable`
--

INSERT INTO `account_recievable` (`tanggal`, `id_debts`, `supplier`, `status`, `sisa_tagihan`, `total_tagihan`) VALUES
('2019-04-13', 1, 'Sindu', 0, 200, 200);

-- --------------------------------------------------------

--
-- Table structure for table `approval`
--

CREATE TABLE `approval` (
  `id_approve` int(5) NOT NULL,
  `id_demand` int(5) NOT NULL,
  `sum_demand` int(20) NOT NULL,
  `approve` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `approval`
--

INSERT INTO `approval` (`id_approve`, `id_demand`, `sum_demand`, `approve`) VALUES
(1, 1, 200, 0),
(2, 2, 200, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id_item` int(5) NOT NULL,
  `id_supplier` int(5) NOT NULL,
  `nama_item` varchar(50) NOT NULL,
  `jumlah_item` int(250) NOT NULL,
  `satuan` varchar(7) NOT NULL,
  `harga_satuan` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id_item`, `id_supplier`, `nama_item`, `jumlah_item`, `satuan`, `harga_satuan`) VALUES
(11, 1235, 'kertas', 1, 'lembar', 100),
(12, 1234, 'kertas', 2, 'lembar', 100),
(13, 1236, 'da', 1, 'lembar', 400);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order`
--

CREATE TABLE `purchase_order` (
  `id_demand` int(5) NOT NULL,
  `id_item` int(5) NOT NULL,
  `qty_demand` int(10) NOT NULL,
  `sum_demand` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase_order`
--

INSERT INTO `purchase_order` (`id_demand`, `id_item`, `qty_demand`, `sum_demand`) VALUES
(3, 11, 2, 200);

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id_supplier` int(5) NOT NULL,
  `nama_supplier` varchar(40) NOT NULL,
  `email` varchar(60) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `no_hp` int(14) DEFAULT NULL,
  `sisa_tagihan` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id_supplier`, `nama_supplier`, `email`, `alamat`, `no_hp`, `sisa_tagihan`) VALUES
(1234, 'Sindu', 'sindu@mail.com', 'bandung', 812678556, 1),
(1235, 'Gramed', 'gramed@mail', 'ciwastra', 595795, 0),
(1236, 'App', 'aap@mail.com', 'utara', 832592375, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(10) NOT NULL,
  `nama` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama`) VALUES
(1, 'owner', '123', 'Owner Favorit'),
(2, 'gudang', '123', 'Petugas Gudang');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_recievable`
--
ALTER TABLE `account_recievable`
  ADD PRIMARY KEY (`id_debts`);

--
-- Indexes for table `approval`
--
ALTER TABLE `approval`
  ADD PRIMARY KEY (`id_approve`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id_item`),
  ADD UNIQUE KEY `id_item` (`id_item`),
  ADD KEY `id_supplier` (`id_supplier`);

--
-- Indexes for table `purchase_order`
--
ALTER TABLE `purchase_order`
  ADD PRIMARY KEY (`id_demand`),
  ADD KEY `id_item` (`id_item`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id_supplier`),
  ADD KEY `id_supplier` (`id_supplier`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_recievable`
--
ALTER TABLE `account_recievable`
  MODIFY `id_debts` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `approval`
--
ALTER TABLE `approval`
  MODIFY `id_approve` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id_item` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `purchase_order`
--
ALTER TABLE `purchase_order`
  MODIFY `id_demand` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id_supplier` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1245;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`id_supplier`) REFERENCES `suppliers` (`id_supplier`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `purchase_order`
--
ALTER TABLE `purchase_order`
  ADD CONSTRAINT `purchase_order_ibfk_1` FOREIGN KEY (`id_item`) REFERENCES `product` (`id_item`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
