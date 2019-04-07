-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.21-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table apporder.detail_akuntansi_stock
CREATE TABLE IF NOT EXISTS `detail_akuntansi_stock` (
  `uniqid` varchar(25) NOT NULL,
  `id_stock` smallint(5) NOT NULL AUTO_INCREMENT,
  `id_vendor` char(7) NOT NULL,
  `debit_stock` int(7) NOT NULL,
  `kredit_stock` int(7) NOT NULL,
  `satuan` char(7) NOT NULL,
  `saldo_quantity_akhir` int(7) NOT NULL,
  `harga_beli` decimal(15,0) NOT NULL,
  `persen_potongan` smallint(3) NOT NULL,
  `nilai_potongan` decimal(7,0) NOT NULL,
  `persen_pajak` smallint(3) NOT NULL,
  `nilai_pajak` decimal(15,0) NOT NULL,
  `total_nilai_stock` decimal(15,0) NOT NULL,
  `keterangan` varchar(35) NOT NULL,
  `uniqid_voucher` varchar(25) NOT NULL,
  `id_jenis_pembayaran` char(7) NOT NULL,
  `id_coa_stock` char(7) DEFAULT NULL,
  PRIMARY KEY (`uniqid`),
  KEY `id_point` (`id_stock`),
  KEY `coa` (`id_coa_stock`),
  KEY `uniqid_voucher` (`uniqid_voucher`),
  CONSTRAINT `coa` FOREIGN KEY (`id_coa_stock`) REFERENCES `m_coa` (`id_coa`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `detail_akuntansi_stock_ibfk_1` FOREIGN KEY (`uniqid_voucher`) REFERENCES `h_akuntansi_voucher` (`uniqid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- Dumping data for table apporder.detail_akuntansi_stock: ~12 rows (approximately)
/*!40000 ALTER TABLE `detail_akuntansi_stock` DISABLE KEYS */;
INSERT INTO `detail_akuntansi_stock` (`uniqid`, `id_stock`, `id_vendor`, `debit_stock`, `kredit_stock`, `satuan`, `saldo_quantity_akhir`, `harga_beli`, `persen_potongan`, `nilai_potongan`, `persen_pajak`, `nilai_pajak`, `total_nilai_stock`, `keterangan`, `uniqid_voucher`, `id_jenis_pembayaran`, `id_coa_stock`) VALUES
	('97929932037947412', 1, '', 100, 0, '1', 0, 10000, 0, 0, 0, 0, 1000000, 'Specialty masuk', 'ST5beae437aa56c9.88763068', '1011001', '1014001'),
	('97929932037947415', 2, '', 150, 0, '1', 0, 10000, 0, 0, 0, 0, 1500000, 'peaberry masuk', 'ST5beae437aa56c9.88763068', '1011001', '1014002'),
	('97929932037947418', 3, '', 100, 0, '1', 0, 10000, 0, 0, 0, 0, 1000000, 'semi wash masuk', 'ST5beae437aa56c9.88763068', '1011001', '1014008'),
	('97929932037947421', 4, '', 70, 0, '1', 0, 10000, 0, 0, 0, 0, 700000, 'premium masuk', 'ST5beae437aa56c9.88763068', '1011001', '1014003'),
	('97929932037947424', 5, '', 22500, 0, '1', 0, 67, 0, 0, 0, 0, 1500075, 'coklat bubuk masuk', 'ST5beae517ddad11.83819841', '1011001', '1014014'),
	('97929932037947427', 6, '', 50, 0, '2', 0, 10000, 0, 0, 0, 0, 500000, 'susu full cream masuk', 'ST5beae5912456a8.38377031', '1011001', '1014018'),
	('97932307725287424', 7, '', 0, -3650, '', 3750, 10000, 0, 0, 0, 0, -36500000, 'stockopname specialty', 'SO5becfe95b9f1f9.06104292', '5000000', '1014001'),
	('97932307725287427', 8, '', 0, -5850, '', 6000, 10000, 0, 0, 0, 0, -58500000, 'stockopname peaberry', 'SO5becfe95b9f1f9.06104292', '5000000', '1014002'),
	('97932307725287430', 9, '', 0, -4900, '', 5000, 10000, 0, 0, 0, 0, -49000000, 'stockopname semiwash', 'SO5becfe95b9f1f9.06104292', '5000000', '1014008'),
	('97932307725287433', 10, '', 0, -4930, '', 5000, 10000, 0, 0, 0, 0, -49300000, 'stockopname premium', 'SO5becfe95b9f1f9.06104292', '5000000', '1014003'),
	('97932307725287436', 11, '', 0, 5224, '', 17276, 67, 0, 0, 0, 0, 348284, 'stockopname coklat', 'SO5becfe95b9f1f9.06104292', '5000000', '1014014'),
	('97932307725287439', 12, '', 0, 45, '', 5, 10000, 0, 0, 0, 0, 450000, 'stockopname susu full cream', 'SO5becfe95b9f1f9.06104292', '5000000', '1014018');
/*!40000 ALTER TABLE `detail_akuntansi_stock` ENABLE KEYS */;

-- Dumping structure for table apporder.detail_akuntansi_voucher
CREATE TABLE IF NOT EXISTS `detail_akuntansi_voucher` (
  `uniqid` varchar(25) NOT NULL,
  `uniqid_voucher` varchar(25) NOT NULL,
  `id_detail` int(18) NOT NULL AUTO_INCREMENT,
  `id_user` varchar(18) NOT NULL,
  `id_coa` varchar(9) NOT NULL,
  `debit` decimal(10,0) NOT NULL,
  `kredit` decimal(10,0) NOT NULL,
  `keterangan` varchar(150) NOT NULL,
  `id_session` varchar(25) NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`uniqid`),
  KEY `id_detail` (`id_detail`),
  KEY `detail_akuntansi_voucher_ibfk_1` (`uniqid_voucher`),
  KEY `id_coa` (`id_coa`),
  CONSTRAINT `detail_akuntansi_voucher_ibfk_1` FOREIGN KEY (`id_coa`) REFERENCES `m_coa` (`id_coa`),
  CONSTRAINT `voucher_akunting` FOREIGN KEY (`uniqid_voucher`) REFERENCES `h_akuntansi_voucher` (`uniqid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=214 DEFAULT CHARSET=latin1;

-- Dumping data for table apporder.detail_akuntansi_voucher: ~74 rows (approximately)
/*!40000 ALTER TABLE `detail_akuntansi_voucher` DISABLE KEYS */;
INSERT INTO `detail_akuntansi_voucher` (`uniqid`, `uniqid_voucher`, `id_detail`, `id_user`, `id_coa`, `debit`, `kredit`, `keterangan`, `id_session`, `waktu`) VALUES
	('41345456454sdfsdf\r\n', 'JU5bebb114ac41b6.14518151', 185, '', '1020010', 0, 2083333, 'akumulasi partisi dan interior', '5bebb0a93fce75.10700628', '2018-11-14 12:22:29'),
	('97929932037947392', 'KBmodalfae8a6c6.99018964', 140, '', '1011001', 100000000, 0, 'modal tuan A', '241c375076b887a750434ca6a', '2018-11-13 20:51:55'),
	('97929932037947393', 'KBmodalfae8a6c6.99018964', 141, '', '3010001', 0, 100000000, 'modal tuan A', '241c375076b887a750434ca6a', '2018-11-13 20:51:55'),
	('97929932037947394', 'KBmodalfae8a6c6.99018964', 142, '', '1011001', 100000000, 0, 'modal tuan B', 'c2fe5a413d7673bbbe1724268', '2018-11-13 20:51:55'),
	('97929932037947395', 'KBmodalfae8a6c6.99018964', 143, '', '3010002', 0, 100000000, 'modal tuan B', 'c2fe5a413d7673bbbe1724268', '2018-11-13 20:51:55'),
	('97929932037947396', 'KBmodalfae8a6c6.99018964', 144, '', '1011001', 0, 75000000, 'sewa gedung kantor', '0aeaccd1fdf033944f7625aaf', '2018-11-13 20:51:55'),
	('97929932037947397', 'KBmodalfae8a6c6.99018964', 145, '', '1015001', 75000000, 0, 'sewa gedung kantor', '0aeaccd1fdf033944f7625aaf', '2018-11-13 20:51:55'),
	('97929932037947398', 'KBmodalfae8a6c6.99018964', 146, '', '1011001', 0, 20000000, 'per prab kantor', '759dd6099e5e17380567cdb58', '2018-11-13 20:51:55'),
	('97929932037947399', 'KBmodalfae8a6c6.99018964', 147, '', '1020001', 20000000, 0, 'per prab kantor', '759dd6099e5e17380567cdb58', '2018-11-13 20:51:55'),
	('97929932037947400', 'JU5beadb40e3de34.47256998', 148, '', '6011001', 5000000, 0, 'Biaya ATK', '5beadb1aaa0620.46123295', '2018-11-13 21:10:09'),
	('97929932037947401', 'JU5beadb40e3de34.47256998', 149, '', '2011001', 0, 5000000, 'Biaya ATK', '5beadb1aaa0620.46123295', '2018-11-13 21:10:09'),
	('97929932037947402', 'JU5beadb40e3de34.47256998', 150, '', '6011012', 5000000, 0, 'Biaya Promosi dan Iklan', '5beadb33ed6068.85926153', '2018-11-13 21:10:09'),
	('97929932037947403', 'JU5beadb40e3de34.47256998', 151, '', '2011001', 0, 5000000, 'Biaya Promosi dan Iklan', '5beadb33ed6068.85926153', '2018-11-13 21:10:09'),
	('97929932037947404', 'KB5beadc09bc7f52.27371713', 152, '', '1011001', 0, 50000000, 'Partisi dan interior', 'df4170ba3823555fe93d27d91', '2018-11-13 21:13:29'),
	('97929932037947405', 'KB5beadc09bc7f52.27371713', 153, '', '1020009', 50000000, 0, 'Partisi dan interior', 'df4170ba3823555fe93d27d91', '2018-11-13 21:13:29'),
	('97929932037947406', 'KB5beadc09bc7f52.27371713', 154, '', '1011001', 0, 10000000, 'Keperluan dapur', '70368d3f2f33dbc477f3b1121', '2018-11-13 21:13:29'),
	('97929932037947407', 'KB5beadc09bc7f52.27371713', 155, '', '6011002', 10000000, 0, 'Keperluan dapur', '70368d3f2f33dbc477f3b1121', '2018-11-13 21:13:30'),
	('97929932037947408', 'KB5beadc09bc7f52.27371713', 156, '', '1011001', 0, 15000000, 'cafe supplies', '22c244cec72b0dcca7bf56fbc', '2018-11-13 21:13:30'),
	('97929932037947409', 'KB5beadc09bc7f52.27371713', 157, '', '1016001', 15000000, 0, 'cafe supplies', '22c244cec72b0dcca7bf56fbc', '2018-11-13 21:13:30'),
	('97929932037947410', 'ST5beae437aa56c9.88763068', 158, '', '1011001', 0, 1000000, 'Specialty masuk', 'cdae42328df67c0343219b229', '2018-11-13 21:48:23'),
	('97929932037947411', 'ST5beae437aa56c9.88763068', 159, '', '1014001', 1000000, 0, 'Specialty masuk', 'cdae42328df67c0343219b229', '2018-11-13 21:48:24'),
	('97929932037947413', 'ST5beae437aa56c9.88763068', 160, '', '1011001', 0, 1500000, 'peaberry masuk', 'de74839fe37f33099c86c53bf', '2018-11-13 21:48:24'),
	('97929932037947414', 'ST5beae437aa56c9.88763068', 161, '', '1014002', 1500000, 0, 'peaberry masuk', 'de74839fe37f33099c86c53bf', '2018-11-13 21:48:24'),
	('97929932037947416', 'ST5beae437aa56c9.88763068', 162, '', '1011001', 0, 1000000, 'semi wash masuk', '324e266c18cb19b59e4f621f8', '2018-11-13 21:48:24'),
	('97929932037947417', 'ST5beae437aa56c9.88763068', 163, '', '1014008', 1000000, 0, 'semi wash masuk', '324e266c18cb19b59e4f621f8', '2018-11-13 21:48:24'),
	('97929932037947419', 'ST5beae437aa56c9.88763068', 164, '', '1011001', 0, 700000, 'premium masuk', 'de61c2940cb17e435b262e910', '2018-11-13 21:48:24'),
	('97929932037947420', 'ST5beae437aa56c9.88763068', 165, '', '1014003', 700000, 0, 'premium masuk', 'de61c2940cb17e435b262e910', '2018-11-13 21:48:24'),
	('97929932037947422', 'ST5beae517ddad11.83819841', 166, '', '1011001', 0, 1500075, 'coklat bubuk masuk', '738dbf9adfcc97d3225f0d0cd', '2018-11-13 21:52:08'),
	('97929932037947423', 'ST5beae517ddad11.83819841', 167, '', '1014014', 1500075, 0, 'coklat bubuk masuk', '738dbf9adfcc97d3225f0d0cd', '2018-11-13 21:52:08'),
	('97929932037947425', 'ST5beae5912456a8.38377031', 168, '', '1011001', 0, 500000, 'susu full cream masuk', 'eb08421e7f4b7b94c94c58f0c', '2018-11-13 21:54:09'),
	('97929932037947426', 'ST5beae5912456a8.38377031', 169, '', '1014018', 500000, 0, 'susu full cream masuk', 'eb08421e7f4b7b94c94c58f0c', '2018-11-13 21:54:09'),
	('97930921105162240', 'KB5bebaddf4765e7.70311233', 170, '', '1011001', 0, 1000000, 'Bayar listrik', '0dafcc4b815695f1e6210c52b', '2018-11-14 12:08:47'),
	('97930921105162241', 'KB5bebaddf4765e7.70311233', 171, '', '6011010', 1000000, 0, 'Bayar listrik', '0dafcc4b815695f1e6210c52b', '2018-11-14 12:08:47'),
	('97930921105162242', 'KB5bebaddf4765e7.70311233', 172, '', '1011001', 0, 6500000, 'Bayar gaji', '5e6b362b6eff42a32cb36a2c4', '2018-11-14 12:08:47'),
	('97930921105162243', 'KB5bebaddf4765e7.70311233', 173, '', '6010001', 6500000, 0, 'Bayar gaji', '5e6b362b6eff42a32cb36a2c4', '2018-11-14 12:08:47'),
	('97930921105162244', 'KB5bebaddf4765e7.70311233', 174, '', '1011001', 30000000, 0, 'penjualan minuman', '71e9b053f17a531e161b2cbc9', '2018-11-14 12:08:47'),
	('97930921105162245', 'KB5bebaddf4765e7.70311233', 175, '', '4010003', 0, 30000000, 'penjualan minuman', '71e9b053f17a531e161b2cbc9', '2018-11-14 12:08:47'),
	('97930921105162246', 'KB5bebaddf4765e7.70311233', 176, '', '1011001', 10000000, 0, 'penjualan bubuk kopi', 'e7df51378a4c0e7da6ceab7fd', '2018-11-14 12:08:47'),
	('97930921105162247', 'KB5bebaddf4765e7.70311233', 177, '', '4010005', 0, 10000000, 'penjualan bubuk kopi', 'e7df51378a4c0e7da6ceab7fd', '2018-11-14 12:08:47'),
	('97930921105162248', 'KB5bebaddf4765e7.70311233', 178, '', '1011001', 15000000, 0, 'penjualan makanan', '1c7341e5c7573a620916235cb', '2018-11-14 12:08:47'),
	('97930921105162249', 'KB5bebaddf4765e7.70311233', 179, '', '4010001', 0, 15000000, 'penjualan makanan', '1c7341e5c7573a620916235cb', '2018-11-14 12:08:47'),
	('97930921105162250', 'JU5bebb114ac41b6.14518151', 180, '', '7000002', 333333, 0, 'akumulasi perlengkapan perabotan', '5bebaf142a24f4.98781485', '2018-11-14 12:22:28'),
	('97930921105162251', 'JU5bebb114ac41b6.14518151', 181, '', '1020002', 0, 333333, 'akumulasi perlengkapan perabotan', '5bebaf142a24f4.98781485', '2018-11-14 12:22:28'),
	('97930921105162252', 'JU5bebb114ac41b6.14518151', 182, '', '7000003', 500000, 0, 'akumulasi peralatan kantor', '5bebaf53907786.21332241', '2018-11-14 12:22:29'),
	('97930921105162253', 'JU5bebb114ac41b6.14518151', 183, '', '1020004', 0, 500000, 'akumulasi peralatan kantor', '5bebaf53907786.21332241', '2018-11-14 12:22:29'),
	('97930921105162254', 'JU5bebb114ac41b6.14518151', 184, '', '7000006', 2083333, 0, 'akumulasi partisi dan interior', '5bebb0a93fce75.10700628', '2018-11-14 12:22:29'),
	('97930921105162256', 'JU5bebb114ac41b6.14518151', 186, '', '7000001', 625000, 0, 'amortisasi cafe supplies', '5bebb1079d5b53.80634541', '2018-11-14 12:22:29'),
	('97930921105162257', 'JU5bebb114ac41b6.14518151', 187, '', '1016002', 0, 625000, 'amortisasi cafe supplies', '5bebb1079d5b53.80634541', '2018-11-14 12:22:29'),
	('97932307725287425', 'SO5becfe95b9f1f9.06104292', 188, '', '1014001', 0, -36500000, 'stockopname specialty', '5becfe95cfeaf1.42944075', '2018-11-15 12:05:26'),
	('97932307725287426', 'SO5becfe95b9f1f9.06104292', 189, '', '5000000', -36500000, 0, 'stockopname specialty', '5becfe95cfeaf1.42944075', '2018-11-15 12:05:26'),
	('97932307725287428', 'SO5becfe95b9f1f9.06104292', 190, '', '1014002', 0, -58500000, 'stockopname peaberry', '5becfe96a99694.05047996', '2018-11-15 12:05:26'),
	('97932307725287429', 'SO5becfe95b9f1f9.06104292', 191, '', '5000000', -58500000, 0, 'stockopname peaberry', '5becfe96a99694.05047996', '2018-11-15 12:05:26'),
	('97932307725287431', 'SO5becfe95b9f1f9.06104292', 192, '', '1014008', 0, -49000000, 'stockopname semiwash', '5becfe96e69f93.97415635', '2018-11-15 12:05:27'),
	('97932307725287432', 'SO5becfe95b9f1f9.06104292', 193, '', '5000000', -49000000, 0, 'stockopname semiwash', '5becfe96e69f93.97415635', '2018-11-15 12:05:27'),
	('97932307725287434', 'SO5becfe95b9f1f9.06104292', 194, '', '1014003', 0, -49300000, 'stockopname premium', '5becfe9736d7a9.32488400', '2018-11-15 12:05:27'),
	('97932307725287435', 'SO5becfe95b9f1f9.06104292', 195, '', '5000000', -49300000, 0, 'stockopname premium', '5becfe9736d7a9.32488400', '2018-11-15 12:05:27'),
	('97932307725287437', 'SO5becfe95b9f1f9.06104292', 196, '', '1014014', 0, 348284, 'stockopname coklat', '5becfe9773e0a5.68582224', '2018-11-15 12:05:27'),
	('97932307725287438', 'SO5becfe95b9f1f9.06104292', 197, '', '5000000', 348284, 0, 'stockopname coklat', '5becfe9773e0a5.68582224', '2018-11-15 12:05:27'),
	('97932307725287440', 'SO5becfe95b9f1f9.06104292', 198, '', '1014018', 0, 450000, 'stockopname susu full cream', '5becfe97a996a9.16981324', '2018-11-15 12:05:27'),
	('97932307725287441', 'SO5becfe95b9f1f9.06104292', 199, '', '5000000', 450000, 0, 'stockopname susu full cream', '5becfe97a996a9.16981324', '2018-11-15 12:05:27'),
	('97944286875615234', 'JK5bf7d96b8fbd34.18380085', 200, '', '1011001', 25000, 0, 'transaksi Affogato Blues Es Kr', '5bf7d96b8fbd36.06910128', '2018-11-23 17:41:47'),
	('97944286875615235', 'JK5bf7d96b8fbd34.18380085', 201, '', '4010003', 0, 25000, 'transaksi Affogato Blues Es Kr', '5bf7d96b8fbd36.06910128', '2018-11-23 17:41:47'),
	('97944286875615236', 'JK5bf7d96b8fbd34.18380085', 202, '', '1011001', 0, 0, 'transaksi potongan Affogato Blues Es Kr', '5bf7d96b8fbd37.21624398', '2018-11-23 17:41:47'),
	('97944286875615237', 'JK5bf7d96b8fbd34.18380085', 203, '', '4010004', 0, 0, 'transaksi potonganAffogato Blues Es Kr', '5bf7d96b8fbd37.21624398', '2018-11-23 17:41:48'),
	('97961396968357892', 'JK5c07656b663b27.07609618', 204, '', '1011001', 20000, 0, 'transaksi Ayam Penyet Blues', '5c07656b663b27.59975321', '2018-12-05 12:43:07'),
	('97961396968357893', 'JK5c07656b663b27.07609618', 205, '', '4010001', 0, 20000, 'transaksi Ayam Penyet Blues', '5c07656b663b27.59975321', '2018-12-05 12:43:07'),
	('97961396968357894', 'JK5c07656b663b27.07609618', 206, '', '1011001', 0, 0, 'transaksi potongan Ayam Penyet Blues', '5c07656b663b21.95259266', '2018-12-05 12:43:07'),
	('97961396968357895', 'JK5c07656b663b27.07609618', 207, '', '4010002', 0, 0, 'transaksi potonganAyam Penyet Blues', '5c07656b663b21.95259266', '2018-12-05 12:43:07'),
	('97961396968357896', 'JK5c07656b663b27.07609618', 208, '', '1011001', 5000, 0, 'transaksi Air Putih Teko', '5c07656b663b27.59975321', '2018-12-05 12:43:07'),
	('97961396968357897', 'JK5c07656b663b27.07609618', 209, '', '4010003', 0, 5000, 'transaksi Air Putih Teko', '5c07656b663b27.59975321', '2018-12-05 12:43:07'),
	('97961396968357898', 'JK5c07656b663b27.07609618', 210, '', '1011001', 0, 0, 'transaksi potongan Air Putih Teko', '5c07656b663b21.95259266', '2018-12-05 12:43:07'),
	('97961396968357899', 'JK5c07656b663b27.07609618', 211, '', '4010004', 0, 0, 'transaksi potonganAir Putih Teko', '5c07656b663b21.95259266', '2018-12-05 12:43:07'),
	('97961396968357901', 'KB5c076bdb779543.94642970', 212, '', '1011001', 0, 100000, 'air bulan 12', 'f12fa15099010cfc8cbf67545', '2018-12-05 13:10:35'),
	('97961396968357902', 'KB5c076bdb779543.94642970', 213, '', '6011009', 100000, 0, 'air bulan 12', 'f12fa15099010cfc8cbf67545', '2018-12-05 13:10:35');
/*!40000 ALTER TABLE `detail_akuntansi_voucher` ENABLE KEYS */;

-- Dumping structure for table apporder.h_akuntansi_voucher
CREATE TABLE IF NOT EXISTS `h_akuntansi_voucher` (
  `uniqid` varchar(25) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `prefix_number` smallint(8) NOT NULL DEFAULT '10000',
  `id_tipe_voucher` char(5) NOT NULL,
  `id_voucher` int(8) NOT NULL AUTO_INCREMENT,
  `waktu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_pembuat` varchar(25) NOT NULL,
  `status_print` tinyint(3) NOT NULL,
  `eod` date NOT NULL,
  `eom` date NOT NULL,
  `eoy` year(4) NOT NULL,
  PRIMARY KEY (`uniqid`),
  KEY `id_voucher` (`id_voucher`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=latin1;

-- Dumping data for table apporder.h_akuntansi_voucher: ~13 rows (approximately)
/*!40000 ALTER TABLE `h_akuntansi_voucher` DISABLE KEYS */;
INSERT INTO `h_akuntansi_voucher` (`uniqid`, `status`, `prefix_number`, `id_tipe_voucher`, `id_voucher`, `waktu`, `user_pembuat`, `status_print`, `eod`, `eom`, `eoy`) VALUES
	('JK5bf7d96b8fbd34.18380085', 1, 10000, 'JK', 57, '2018-11-23 17:41:47', '', 0, '2018-09-19', '0000-00-00', '0000'),
	('JK5c07656b663b27.07609618', 1, 10000, 'JK', 58, '2018-12-05 12:43:07', '', 0, '2018-09-19', '0000-00-00', '0000'),
	('JU5beadb40e3de34.47256998', 1, 10000, 'JU', 48, '2018-11-13 21:10:08', '', 0, '2018-11-15', '0000-00-00', '0000'),
	('JU5bebb114ac41b6.14518151', 1, 10000, 'JU', 54, '2018-11-14 12:22:28', '', 0, '2018-11-15', '0000-00-00', '0000'),
	('JU5becff048eee74.83465750', 1, 10000, 'JU', 56, '2018-11-15 12:07:16', '', 0, '2018-11-15', '0000-00-00', '0000'),
	('KB5beadc09bc7f52.27371713', 1, 10000, 'KB', 49, '2018-11-13 21:13:29', '', 0, '2018-11-15', '0000-00-00', '0000'),
	('KB5bebaddf4765e7.70311233', 1, 10000, 'KB', 53, '2018-11-14 12:08:47', '', 0, '2018-11-15', '0000-00-00', '0000'),
	('KB5c076bdb779543.94642970', 0, 10000, 'KB', 59, '2018-12-05 13:10:35', '', 0, '0000-00-00', '0000-00-00', '0000'),
	('KBmodalfae8a6c6.99018964', 1, 10000, 'KB', 47, '2018-11-13 20:51:54', '', 0, '2018-11-15', '0000-00-00', '0000'),
	('SO5becfe95b9f1f9.06104292', 1, 10000, 'SO', 55, '2018-11-15 12:05:25', '', 0, '2018-11-15', '0000-00-00', '0000'),
	('ST5beae437aa56c9.88763068', 1, 10000, 'ST', 50, '2018-11-13 21:48:23', '', 0, '2018-11-15', '0000-00-00', '0000'),
	('ST5beae517ddad11.83819841', 1, 10000, 'ST', 51, '2018-11-13 21:52:07', '', 0, '2018-11-15', '0000-00-00', '0000'),
	('ST5beae5912456a8.38377031', 1, 10000, 'ST', 52, '2018-11-13 21:54:09', '', 0, '2018-11-15', '0000-00-00', '0000');
/*!40000 ALTER TABLE `h_akuntansi_voucher` ENABLE KEYS */;

-- Dumping structure for table apporder.m_akuntansi_kategori
CREATE TABLE IF NOT EXISTS `m_akuntansi_kategori` (
  `uniqid` varchar(25) NOT NULL,
  `id_kategori` varchar(9) NOT NULL,
  `nama_kategori` varchar(35) NOT NULL,
  `pos` set('neraca','laba rugi','','') NOT NULL DEFAULT 'neraca',
  `saldo_normal` enum('debit','kredit','','') NOT NULL,
  PRIMARY KEY (`uniqid`),
  UNIQUE KEY `id_tipe` (`id_kategori`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table apporder.m_akuntansi_kategori: ~15 rows (approximately)
/*!40000 ALTER TABLE `m_akuntansi_kategori` DISABLE KEYS */;
INSERT INTO `m_akuntansi_kategori` (`uniqid`, `id_kategori`, `nama_kategori`, `pos`, `saldo_normal`) VALUES
	('1', '1010000', 'AKTIVA LANCAR', 'neraca', 'debit'),
	('11', '5000000', 'HARGA POKOK PENJUALAN', 'laba rugi', 'debit'),
	('12', '6000000', 'BIAYA OPERASIONAL', 'laba rugi', 'debit'),
	('13', '7000000', 'BIAYA PENYUSUTAN', 'laba rugi', 'debit'),
	('14', '8000000', 'BIAYA LAIN LAIN', 'laba rugi', 'debit'),
	('15', '8010000', 'BIAYA PAJAK', 'laba rugi', 'debit'),
	('16', '9000000', 'IKHTISAR LABA RUGI', 'laba rugi', 'debit'),
	('2', '1020000', 'AKTIVA TETAP', 'neraca', 'debit'),
	('3', '1030000', 'AKTIVA TIDAK BERWUJUD', 'neraca', 'debit'),
	('4', '2010000', 'HUTANG LANCAR', 'neraca', 'kredit'),
	('5', '2020000', 'HUTANGTIDAK LANCAR', 'neraca', 'kredit'),
	('6', '3010000', 'MODAL SETOR', 'neraca', 'kredit'),
	('7', '3011000', 'MODAL SAHAM', 'neraca', 'kredit'),
	('8', '3012000', 'LABA RUGI DI TAHAN', 'neraca', 'kredit'),
	('9', '4010000', 'PENJUALAN', 'laba rugi', 'kredit');
/*!40000 ALTER TABLE `m_akuntansi_kategori` ENABLE KEYS */;

-- Dumping structure for table apporder.m_coa
CREATE TABLE IF NOT EXISTS `m_coa` (
  `uniqid` varchar(25) NOT NULL,
  `id_coa` varchar(9) NOT NULL,
  `id_kelompok_coa` char(8) NOT NULL,
  `id_kategori` varchar(11) NOT NULL,
  `nama_coa` varchar(35) NOT NULL,
  `uniqid_sub` varchar(25) NOT NULL,
  `saldo_awal` decimal(10,0) NOT NULL,
  `saldo_normal_special` varchar(1) NOT NULL,
  `quantity` decimal(10,0) NOT NULL,
  PRIMARY KEY (`uniqid`),
  UNIQUE KEY `id_coa` (`id_coa`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table apporder.m_coa: ~104 rows (approximately)
/*!40000 ALTER TABLE `m_coa` DISABLE KEYS */;
INSERT INTO `m_coa` (`uniqid`, `id_coa`, `id_kelompok_coa`, `id_kategori`, `nama_coa`, `uniqid_sub`, `saldo_awal`, `saldo_normal_special`, `quantity`) VALUES
	('', '1011003', '1', '', 'Kas Kecil', '', 0, '', 0),
	('1', '1011001', '1', '', 'KAS -IDR', '', 0, '', 0),
	('10', '1014003', '4', '', 'Persedian Barang  Arabica Premium', '', 0, '', 0),
	('100', '8000002', '28', '', 'Biaya bunga Bank', '', 0, '', 0),
	('101', '8000003', '28', '', 'Selisih Persedian Barang', '', 0, '', 0),
	('102', '9000000', '30', '', 'Ikhtisar Rugi Laba', '', 0, '', 0),
	('11', '1014004', '4', '', 'Persedian Barang  Arabica Wine', '', 0, '', 0),
	('12', '1014005', '4', '', 'Persedian Barang  Arabica Luwak', '', 0, '', 0),
	('12hpp', '5000000', '24', '', 'HPP', '', 0, '', 0),
	('13', '1014006', '4', '', 'Persedian Barang  Arabica Honey', '', 0, '', 0),
	('14', '1014007', '4', '', 'Persedian Barang  Arabica Full Wash', '', 0, '', 0),
	('15', '1014008', '4', '', 'Persedian Barang  Arabica Semi wash', '', 0, '', 0),
	('16', '1014009', '4', '', 'Persedian Barang  Arabica Blend', '', 0, '', 0),
	('17', '1014010', '4', '', 'Persedian Barang  Robusta', '', 0, '', 0),
	('18', '1014011', '4', '', 'Persedian Barang  Green Coffee', '', 0, '', 0),
	('19', '1014012', '4', '', 'Persedian Barang Tea Tarik ', '', 0, '', 0),
	('2', '1011002', '1', '', 'KAS -USD', '', 0, '', 0),
	('20', '1014013', '4', '', 'Persedian Barang Lemon Tea', '', 0, '', 0),
	('21', '1014014', '4', '', 'Persedian Barang  Coklat', '', 0, '', 0),
	('22', '1014015', '4', '', 'Persedian Barang Sirup ', '', 0, '', 0),
	('23', '1014016', '4', '', 'Persedian Barang Air Mineral', '', 0, '', 0),
	('2322a5ac-0cbf-11e9-b189-7', '100203', '1', '', 'asd', '', 200, '', 0),
	('24', '1014017', '4', '', 'Persedian Barang Air Galon', '', 0, '', 0),
	('25', '1014018', '4', '', 'Persedian Barang Susu Full Cream', '', 0, '', 0),
	('26', '1014019', '4', '', 'Persedian Barang Susu Kental Manis', '', 0, '', 0),
	('27', '1014020', '4', '', 'Persedian Barang Teh Botol Sosro', '', 0, '', 0),
	('28', '1014021', '4', '', 'Persediaan Barang Kemasan Kopi 100 ', '', 0, '', 0),
	('29', '1014022', '4', '', 'Persediaan Barang Kemasan Kopi 250 ', '', 0, '', 0),
	('3', '1012001', '2', '', 'BANK BCA', '', 0, '', 0),
	('30', '1014023', '4', '', 'Persediaan Barang Kemasan Kopi 500 ', '', 0, '', 0),
	('31', '1014024', '4', '', 'Persediaan Barang Kemasan Kopi 1000', '', 0, '', 0),
	('32', '1014025', '4', '', 'Persediaan Barang sticker Kopi Besa', '', 0, '', 0),
	('33', '1014026', '4', '', 'Persediaan Barang sticker Kopi Cup', '', 0, '', 0),
	('34', '1015001', '5', '', 'Sewa Di Bayar Di muka', '', 0, '', 0),
	('35', '1015002', '5', '', 'Uang Muka', '', 0, '', 0),
	('36', '1016001', '6', '', 'Cafe Supllies', '', 0, '', 0),
	('37', '1016002', '6', '', 'Amortisasi Cafe Supplies', '', 0, 'k', 0),
	('38', '1020001', '7', '', 'Perlengkapan & Perabotan Kantor', '', 0, '', 0),
	('39', '1020002', '7', '', 'Akum Penyusutan Perlengkapan & Pera', '', 0, 'k', 0),
	('4', '1012002', '2', '', 'BANK BNI', '', 0, '', 0),
	('40', '1020003', '8', '', 'Peralatan Kantor', '', 0, '', 0),
	('41', '1020004', '8', '', 'Akum Penyusutan Peralatan Kantor', '', 0, 'k', 0),
	('42', '1020005', '9', '', 'Kendaraan', '', 0, '', 0),
	('43', '1020006', '9', '', 'Akum Penyusutan Kendaraan', '', 0, 'k', 0),
	('44', '1020007', '10', '', 'Komputer', '', 0, '', 0),
	('45', '1020008', '10', '', 'Akum Penyusutan Komputer', '', 0, 'k', 0),
	('46', '1020009', '11', '', 'Partisi & Interior', '', 0, '', 0),
	('47', '1020010', '11', '', 'Akum Penyusutan Partisi & Interior', '', 0, 'k', 0),
	('48', '1030001', '12', '', 'Franchise Fee', '', 0, '', 0),
	('49', '1030002', '12', '', 'Goodwill', '', 0, '', 0),
	('5', '1012003', '2', '', 'BANK MANDIRI', '', 0, '', 0),
	('50', '2011001', '14', '', 'Hutang Dagang  A', '', 0, '', 0),
	('51', '2011002', '14', '', 'Hutang Dagang  B', '', 0, '', 0),
	('52', '2011003', '14', '', 'Hutang Dividen', '', 0, '', 0),
	('53', '2012001', '15', '', 'Hutang Karyawan', '', 0, '', 0),
	('54', '2013001', '16', '', 'Hutang PPh ', '', 0, '', 0),
	('55', '2013002', '16', '', 'Hutang PPN', '', 0, '', 0),
	('56', '2021001', '18', '', 'Hutang Bank A', '', 0, '', 0),
	('57', '2021002', '18', '', 'Hutang Bank B', '', 0, '', 0),
	('58', '3010001', '19', '', 'Modal Setor A', '', 0, '', 0),
	('59', '3010002', '19', '', 'Modal Setor B', '', 0, '', 0),
	('6', '1012004', '2', '', 'BANK BSM', '', 0, '', 0),
	('60', '3010003', '19', '', 'Modal Setor C', '', 0, '', 0),
	('61', '3012001', '21', '', 'Laba Rugi di Tahan tahun Lalu', '', 0, '', 0),
	('62', '3012002', '21', '', 'Laba Rugi Bulan Berjalan', '', 0, '', 0),
	('64', '4010001', '22', '', 'Penjualan Makanan', '', 0, '', 0),
	('65', '4010002', '22', '', 'Diskon Penjualan Makanan', '', 0, '', 0),
	('66', '4010003', '22', '', 'Penjualan Minuman', '', 0, '', 0),
	('67', '4010004', '22', '', 'Diskon Penjualan Minuman', '', 0, '', 0),
	('68', '4010005', '22', '', 'Penjualan Bubuk Kopi', '', 0, '', 0),
	('69', '4010006', '22', '', 'Penjualan Snack', '', 0, '', 0),
	('7', '1013001', '3', '', 'PIUTANG DAGANG', '', 0, '', 0),
	('70', '4011001', '23', '', 'Pendapatan Bunga Bank', '', 0, '', 0),
	('71', '6010001', '25', '', 'Biaya Gaji Karyawan', '', 0, '', 0),
	('72', '6010002', '25', '', 'Biaya Tunjangan Karyawan', '', 0, '', 0),
	('73', '6011001', '26', '', 'BIAYA ATK & BARANG CETAKAN', '', 0, '', 0),
	('74', '6011002', '26', '', 'BIAYA KEPERLUAN DAPUR CAFE', '', 0, '', 0),
	('75', '6011003', '26', '', 'BIAYA KEPERLUAN DAPUR MAKANAN', '', 0, '', 0),
	('76', '6011004', '26', '', 'BIAYA KEPERLUAN KANTOR', '', 0, '', 0),
	('77', '6011005', '26', '', 'BIAYA PENDIDIKAN&PELATIHAN', '', 0, '', 0),
	('78', '6011006', '26', '', 'BIAYA TRANSPORTASI', '', 0, '', 0),
	('79', '6011007', '26', '', 'BIAYA PERIZINAN DAN LEGAL', '', 0, '', 0),
	('8', '1014001', '4', '', 'Persedian Barang  Arabica Specialty', '', 0, '', 0),
	('80', '6011008', '26', '', 'BIAYA TELEPON & INTERNET', '', 0, '', 0),
	('81', '6011009', '26', '', 'BIAYA AIR PDAM', '', 0, '', 0),
	('82', '6011010', '26', '', 'BIAYA LISTRIK', '', 0, '', 0),
	('83', '6011011', '26', '', 'BIAYA KURIR DAN EKSPEDISI', '', 0, '', 0),
	('84', '6011012', '26', '', 'BIAYA PROMOSI & IKLAN', '', 0, '', 0),
	('85', '6011013', '26', '', 'BIAYA KEAMANAN & SOSIAL', '', 0, '', 0),
	('86', '6011014', '26', '', 'BIAYA ENTERTAIN', '', 0, '', 0),
	('87', '6011015', '26', '', 'BIAYA PERJALANAN DINAS', '', 0, '', 0),
	('88', '6011016', '26', '', 'BIAYA PEMELIHARAAN DAN PERBAIKAN GE', '', 0, '', 0),
	('89', '6011017', '26', '', 'BIAYA PEMELIHARAAN DAN PERBAIKAN PE', '', 0, '', 0),
	('9', '1014002', '4', '', 'Persedian Barang  Arabica Peaberry', '', 0, '', 0),
	('90', '6011018', '26', '', 'BIAYA PEMELIHARAAN DAN PERLENGKAPAN', '', 0, '', 0),
	('91', '6011019', '29', '', 'Biaya Pajak PPh ', '', 0, '', 0),
	('92', '6011020', '29', '', 'Biaya Pajak PPN', '', 0, '', 0),
	('93', '7000001', '27', '', 'Biaya Amortisasi Cafe Supplies', '', 0, '', 0),
	('94', '7000002', '27', '', 'Biaya Penyusutan Perlengkapan & Per', '', 0, '', 0),
	('95', '7000003', '27', '', 'Biaya Penyusutan Peralatan Kantor', '', 0, '', 0),
	('96', '7000004', '27', '', 'Biaya Penyusutan Kendaraan', '', 0, '', 0),
	('97', '7000005', '27', '', 'Biaya Penyusutan Komputer', '', 0, '', 0),
	('98', '7000006', '27', '', 'Biaya Penyusutan Partisi & Interior', '', 0, '', 0),
	('99', '8000001', '28', '', 'Biaya Adm Bank', '', 0, '', 0);
/*!40000 ALTER TABLE `m_coa` ENABLE KEYS */;

-- Dumping structure for table apporder.m_kelompok_coa
CREATE TABLE IF NOT EXISTS `m_kelompok_coa` (
  `uniqid` varchar(25) NOT NULL,
  `id_kelompok_coa` char(8) NOT NULL,
  `id_kategori` char(8) NOT NULL,
  `nama_kelompok_coa` char(35) NOT NULL,
  PRIMARY KEY (`uniqid`),
  UNIQUE KEY `id_subtipe` (`id_kelompok_coa`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table apporder.m_kelompok_coa: ~30 rows (approximately)
/*!40000 ALTER TABLE `m_kelompok_coa` DISABLE KEYS */;
INSERT INTO `m_kelompok_coa` (`uniqid`, `id_kelompok_coa`, `id_kategori`, `nama_kelompok_coa`) VALUES
	('1', '1011000', '1', 'KAS'),
	('10', '1020004', '2', 'Komputer'),
	('11', '1020005', '2', 'Partisi & Interior'),
	('12', '1031000', '3', 'Franchise Fee'),
	('13', '1032000', '3', 'Goodwill'),
	('14', '2011000', '4', 'HUTANG DAGANG'),
	('15', '2012000', '4', 'HUTANG LAIN-LAIN'),
	('16', '2013000', '4', 'HUTANG PAJAK'),
	('17', '2020000', '5', 'HUTANGTIDAK LANCAR'),
	('18', '2021000', '5', 'HUTANG BANK'),
	('19', '3010000', '6', 'MODAL SETOR'),
	('2', '1012000', '1', 'BANK'),
	('20', '3011000', '7', 'MODAL SAHAM'),
	('21', '3012000', '8', 'LABA RUGI DI TAHAN'),
	('22', '4010000', '9', 'PENJUALAN'),
	('23', '4011000', '9', 'PENDAPATAN LAIN LAIN'),
	('24', '5000000', '11', 'HARGA POKOK PENJUALAN'),
	('25', '6010000', '12', 'BIAYA GAJI'),
	('26', '6011000', '12', 'BIAYA ADM & UMUM'),
	('27', '7000000', '13', 'BIAYA PENYUSUTAN'),
	('28', '8000000', '14', 'BIAYA LAIN LAIN'),
	('29', '8010000', '15', 'BIAYA PAJAK'),
	('3', '1013000', '1', 'PIUTANG'),
	('30', '9000000', '16', 'IKHTISAR LABA RUGI'),
	('4', '1014000', '1', 'PERSEDIAAN BARANG'),
	('5', '1015000', '1', 'BIAYA DI BAYAR DI MUKA'),
	('6', '1016000', '1', 'BIAYA SUPPLIES'),
	('7', '1020001', '2', 'Perlengkapan & Perabotan Kantor'),
	('8', '1020002', '2', 'Peralatan Kantor'),
	('9', '1020003', '2', 'Kendaraan');
/*!40000 ALTER TABLE `m_kelompok_coa` ENABLE KEYS */;

-- Dumping structure for table apporder.m_satuan
CREATE TABLE IF NOT EXISTS `m_satuan` (
  `id_satuan` tinyint(1) NOT NULL,
  `nama_satuan` varchar(12) NOT NULL,
  `keterangan` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id_satuan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table apporder.m_satuan: ~2 rows (approximately)
/*!40000 ALTER TABLE `m_satuan` DISABLE KEYS */;
INSERT INTO `m_satuan` (`id_satuan`, `nama_satuan`, `keterangan`) VALUES
	(1, 'gr', 'gram'),
	(2, 'pcs', 'buah');
/*!40000 ALTER TABLE `m_satuan` ENABLE KEYS */;

-- Dumping structure for table apporder.m_vendor
CREATE TABLE IF NOT EXISTS `m_vendor` (
  `uniqid` varchar(15) NOT NULL,
  `id_vendor` varchar(18) NOT NULL,
  `name` varchar(33) NOT NULL,
  `email` varchar(16) NOT NULL,
  `alamat` varchar(35) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `whatsapp` varchar(15) NOT NULL,
  PRIMARY KEY (`uniqid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table apporder.m_vendor: ~0 rows (approximately)
/*!40000 ALTER TABLE `m_vendor` DISABLE KEYS */;
/*!40000 ALTER TABLE `m_vendor` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
