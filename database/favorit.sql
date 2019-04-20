-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 20, 2019 at 02:09 AM
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
-- Table structure for table `account_payable`
--

CREATE TABLE `account_payable` (
  `tanggal` date NOT NULL,
  `id_debts` int(11) NOT NULL,
  `id_demand` int(11) NOT NULL,
  `id_supplier` int(11) NOT NULL,
  `total_tagihan` int(20) DEFAULT NULL,
  `sisa_tagihan` int(20) DEFAULT NULL,
  `paid` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account_payable`
--

INSERT INTO `account_payable` (`tanggal`, `id_debts`, `id_demand`, `id_supplier`, `total_tagihan`, `sisa_tagihan`, `paid`) VALUES
('2019-04-20', 28, 52, 1238, 2000000, 0, 1),
('2019-04-20', 29, 51, 1239, 3500, 3500, 0);

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
(18, 1238, 'Djarum SUper', 3, 'Box', 4),
(19, 1239, 'Beer', 0, 'Buah', 2000),
(20, 1239, 'kue', 5, 'Lusin', 700),
(21, 1238, 'kentang', 500, 'Rim', 4000);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order`
--

CREATE TABLE `purchase_order` (
  `id_demand` int(5) NOT NULL,
  `tgl` date NOT NULL,
  `id_item` int(5) NOT NULL,
  `qty_demand` int(10) NOT NULL,
  `sum_demand` int(20) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase_order`
--

INSERT INTO `purchase_order` (`id_demand`, `tgl`, `id_item`, `qty_demand`, `sum_demand`, `status`) VALUES
(49, '2019-04-20', 18, 4, 16, 0),
(50, '2019-04-20', 19, 6, 12000, 0),
(51, '2019-04-20', 20, 5, 3500, 1),
(52, '2019-04-20', 21, 500, 2000000, 1);

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
(1238, 'DJARUM', 'dj@mail.com', 'Jalan Jalan no.5 Bandung', 812223, 0),
(1239, 'Bintang', 'star@mail', 'Bali', 81234324, 3500);

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
-- Indexes for table `account_payable`
--
ALTER TABLE `account_payable`
  ADD PRIMARY KEY (`id_debts`),
  ADD KEY `id_supplier` (`id_supplier`),
  ADD KEY `id_demand` (`id_demand`);

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
-- AUTO_INCREMENT for table `account_payable`
--
ALTER TABLE `account_payable`
  MODIFY `id_debts` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id_item` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `purchase_order`
--
ALTER TABLE `purchase_order`
  MODIFY `id_demand` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id_supplier` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1240;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `account_payable`
--
ALTER TABLE `account_payable`
  ADD CONSTRAINT `account_payable_ibfk_1` FOREIGN KEY (`id_demand`) REFERENCES `purchase_order` (`id_demand`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `account_payable_ibfk_2` FOREIGN KEY (`id_supplier`) REFERENCES `suppliers` (`id_supplier`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`id_supplier`) REFERENCES `suppliers` (`id_supplier`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `purchase_order`
--
ALTER TABLE `purchase_order`
  ADD CONSTRAINT `purchase_order_ibfk_1` FOREIGN KEY (`id_item`) REFERENCES `product` (`id_item`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
