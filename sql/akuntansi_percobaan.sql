-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 11, 2019 at 01:21 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `akuntansi_percobaan`
--

-- --------------------------------------------------------

--
-- Stand-in structure for view `akuntansi_buku_besar`
-- (See below for the actual view)
--
CREATE TABLE `akuntansi_buku_besar` (
`id_voucherjurnal` varchar(13)
,`id_nama_coa` varchar(45)
,`id_detail` int(18)
,`id_coa` varchar(9)
,`debit` decimal(10,0)
,`kredit` decimal(10,0)
,`id_session` varchar(25)
,`nilai_voucher` decimal(11,0)
,`keterangan` varchar(150)
,`uniqid_voucher` varchar(25)
,`eod` date
,`eom` date
,`eoy` year(4)
,`status_print` tinyint(3)
,`waktu` date
,`nama_coa` varchar(35)
,`saldo_normal_special` varchar(1)
,`saldo_awal` decimal(10,0)
,`nama_kelompok_coa` char(35)
,`nama_kategori` varchar(35)
,`pos` set('neraca','laba rugi','','')
,`saldo_normal` enum('debit','kredit','','')
,`status` tinyint(1)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `akuntansi_coa`
-- (See below for the actual view)
--
CREATE TABLE `akuntansi_coa` (
`uniqid` varchar(25)
,`pos` set('neraca','laba rugi','','')
,`nama_kategori` varchar(35)
,`saldo_normal` enum('debit','kredit','','')
,`kel_uniqid` varchar(25)
,`id_kelompok_coa` char(8)
,`nama_kelompok_coa` char(35)
,`id_coa` varchar(9)
,`saldo_normal_special` varchar(1)
,`nama_coa` varchar(35)
,`saldo_awal` decimal(10,0)
,`coa_id` varchar(25)
);

-- --------------------------------------------------------

--
-- Table structure for table `akuntansi_detail_hutang`
--

CREATE TABLE `akuntansi_detail_hutang` (
  `uniqid` varchar(25) NOT NULL,
  `uniqid_detail_voucher` varchar(25) DEFAULT NULL,
  `id_people` varchar(25) NOT NULL,
  `debit` decimal(10,0) NOT NULL,
  `kredit` decimal(10,0) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `tgl_jatuh_tempo` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `akuntansi_detail_hutang`
--

INSERT INTO `akuntansi_detail_hutang` (`uniqid`, `uniqid_detail_voucher`, `id_people`, `debit`, `kredit`, `keterangan`, `tgl_jatuh_tempo`) VALUES
('98408169566371842', '5d9de44c1f9371.78272283', '', '0', '0', '', '0000-00-00'),
('98408169566371843', '5d9de450d9ad86.46421383', '', '0', '0', '', '0000-00-00'),
('98408169566371844', '5d9de48c00bad8.37531123', '', '0', '0', '', '0000-00-00'),
('98408169566371845', '5d9df277f225d4.20897932', '101010103', '10000', '0', 'dfsdf', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `akuntansi_detail_piutang`
--

CREATE TABLE `akuntansi_detail_piutang` (
  `uniqid` varchar(25) NOT NULL,
  `uniqid_detail_voucher` varchar(25) NOT NULL,
  `id_people` varchar(25) NOT NULL,
  `debit` decimal(10,0) NOT NULL,
  `kredit` decimal(10,0) NOT NULL,
  `keterangan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `akuntansi_detail_stock`
--

CREATE TABLE `akuntansi_detail_stock` (
  `uniqid` varchar(25) NOT NULL,
  `id_stock` smallint(5) NOT NULL,
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
  `id_coa_stock` char(7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `akuntansi_detail_voucher`
--

CREATE TABLE `akuntansi_detail_voucher` (
  `uniqid` varchar(25) NOT NULL,
  `uniqid_voucher` varchar(25) NOT NULL,
  `id_detail` int(18) NOT NULL,
  `id_user` varchar(18) NOT NULL,
  `id_coa` varchar(9) NOT NULL,
  `debit` decimal(10,0) NOT NULL,
  `kredit` decimal(10,0) NOT NULL,
  `keterangan` varchar(150) NOT NULL,
  `id_session` varchar(25) NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `akuntansi_detail_voucher`
--

INSERT INTO `akuntansi_detail_voucher` (`uniqid`, `uniqid_voucher`, `id_detail`, `id_user`, `id_coa`, `debit`, `kredit`, `keterangan`, `id_session`, `waktu`) VALUES
('5d9de44c1f9371.78272283', 'HT5d9de44c116a46.81864030', 45, '', '', '0', '0', '', '5d9de44c1f9374.35957521', '2019-10-09 13:44:44'),
('5d9de450d9ad86.46421383', 'HT5d9de450c75db7.27336034', 46, '', '', '0', '0', '', '5d9de450d96ef7.09855361', '2019-10-09 13:44:48'),
('5d9de48c00bad8.37531123', 'HT5d9de48be82ca8.28893878', 47, '', '', '0', '0', '', '5d9de48c00bad5.39793622', '2019-10-09 13:45:48'),
('5d9de4fa9b1b46.30466484', 'HT5d9de4fa8dec11.75683849', 48, '', '', '0', '0', '', '5d9de4fa9adcc5.12657130', '2019-10-09 13:47:38'),
('5d9de4fab8a633.34111546', 'HT5d9de4fa8dec11.75683849', 49, '', '', '0', '0', '', '5d9de4fa9adcc5.12657130', '2019-10-09 13:47:38'),
('5d9de4fad3fea4.67248380', 'HT5d9de4fa8dec11.75683849', 50, '', '', '0', '0', '', '5d9de4fad3fea5.29620531', '2019-10-09 13:47:38'),
('5d9de4faec68f2.99314935', 'HT5d9de4fa8dec11.75683849', 51, '', '', '0', '0', '', '5d9de4fad3fea5.29620531', '2019-10-09 13:47:38'),
('5d9de55caf4668.55656575', 'HT5d9de55c9bbe28.65249559', 52, '', '', '0', '0', '', '5d9de55caf4666.04110401', '2019-10-09 13:49:16'),
('5d9de55cbf63a8.14641070', 'HT5d9de55c9bbe28.65249559', 53, '', '', '0', '0', '', '5d9de55caf4666.04110401', '2019-10-09 13:49:16'),
('5d9de55cc4c2b1.91034542', 'HT5d9de55c9bbe28.65249559', 54, '', '', '0', '0', '', '5d9de55cc4c2b1.54109520', '2019-10-09 13:49:16'),
('5d9de55ccfbf66.06400672', 'HT5d9de55c9bbe28.65249559', 55, '', '', '0', '0', '', '5d9de55cc4c2b1.54109520', '2019-10-09 13:49:16'),
('5d9de5fc61ea47.22337171', 'HT5d9de5fc4edef7.75176117', 56, '', '', '0', '0', '', '5d9de5fc61ea47.45250438', '2019-10-09 13:51:56'),
('5d9de5fc668dd3.57283522', 'HT5d9de5fc4edef7.75176117', 57, '', '', '0', '0', '', '5d9de5fc61ea47.45250438', '2019-10-09 13:51:56'),
('5d9de5fc747884.11378180', 'HT5d9de5fc4edef7.75176117', 58, '', '', '0', '0', '', '5d9de5fc747887.02039438', '2019-10-09 13:51:56'),
('5d9de5fc7fb3b6.80533119', 'HT5d9de5fc4edef7.75176117', 59, '', '', '0', '0', '', '5d9de5fc747887.02039438', '2019-10-09 13:51:56'),
('5d9defd8c61b86.60075709', 'HT5d9defd8b6b9c8.86103441', 60, '', '2011001', '100000', '0', 'hghjghg', '5d9defd8c61b87.47019027', '2019-10-09 14:34:00'),
('5d9df240892032.84640652', 'HT5d9df2407bb272.08502791', 61, '', '1011001', '0', '0', 'dsfsd', '5d9df240892036.40265140', '2019-10-09 14:44:16'),
('5d9df277f225d4.20897932', 'HT5d9df277e0d011.59786994', 62, '', '2011001', '10000', '0', 'dfsdf', '5d9df277f225d3.81325453', '2019-10-09 14:45:11'),
('5d9df27813bca6.21032958', 'HT5d9df277e0d011.59786994', 63, '', '1011001', '0', '10000', 'dfsdf', '5d9df277f225d3.81325453', '2019-10-09 14:45:12'),
('98407593554214945', 'JU5d9d8b74632c76.54701123', 34, '', '1011001', '234234', '0', 'sdfsdf', '5d9d8b747e4665.33767079', '2019-10-09 07:25:40'),
('98407593554214946', 'JU5d9d8b74632c76.54701123', 35, '', '3010002', '0', '234234', 'sdfsdf', '5d9d8b747e4665.33767079', '2019-10-09 07:25:40'),
('98408169566371840', 'KB5d9dbb780bb408.53851597', 36, '', '1011001', '0', '100000', 'pdam bulan okt', '5d9dbb78338016.48967160', '2019-10-09 10:50:32'),
('98408169566371841', 'KB5d9dbb780bb408.53851597', 37, '', '6011009', '100000', '0', 'pdam bulan okt', '5d9dbb78338016.48967160', '2019-10-09 10:50:32'),
('98408169566371846', 'KB5d9dff80b68a93.37810766', 64, '', '1011001', '20000', '0', 'mie', '5d9dff80c10a34.53273841', '2019-10-09 15:40:48'),
('98408169566371847', 'KB5d9dff80b68a93.37810766', 65, '', '4010001', '0', '20000', 'mie', '5d9dff80c10a34.53273841', '2019-10-09 15:40:48'),
('98408169566371848', 'KB5d9dff80b68a93.37810766', 66, '', '1011001', '20000', '0', 'jus', '5d9dff80d8f797.12407255', '2019-10-09 15:40:48'),
('98408169566371849', 'KB5d9dff80b68a93.37810766', 67, '', '4010003', '0', '20000', 'jus', '5d9dff80d8f797.12407255', '2019-10-09 15:40:48'),
('98408169566371850', 'KB5d9dff80b68a93.37810766', 68, '', '1011001', '20000', '0', 'jus', '5d9dff80f067e7.50569656', '2019-10-09 15:40:48'),
('98408169566371851', 'KB5d9dff80b68a93.37810766', 69, '', '4010003', '0', '20000', 'jus', '5d9dff80f067e7.50569656', '2019-10-09 15:40:49'),
('98408169566371852', 'KB5d9dff80b68a93.37810766', 70, '', '1011003', '0', '200000', 'pembayaran', '5d9dff810d99a8.17317605', '2019-10-09 15:40:49'),
('98408169566371853', 'KB5d9dff80b68a93.37810766', 71, '', '8000001', '200000', '0', 'pembayaran', '5d9dff810d99a8.17317605', '2019-10-09 15:40:49'),
('98409579053842432', 'KB5d9f02e19de973.89072333', 72, '', '1011002', '10000', '0', 'dad', '5d9f02e1aa1ea9.62635971', '2019-10-10 10:07:29'),
('98409579053842433', 'KB5d9f02e19de973.89072333', 73, '', '4010002', '0', '10000', 'dad', '5d9f02e1aa1ea9.62635971', '2019-10-10 10:07:29'),
('98409579053842434', 'KB5d9f031ab18202.73709462', 74, '', '1011001', '10000', '0', 'assdafsd', '5d9f031ac160c1.22027446', '2019-10-10 10:08:26'),
('98409579053842435', 'KB5d9f031ab18202.73709462', 75, '', '4010001', '0', '10000', 'assdafsd', '5d9f031ac160c1.22027446', '2019-10-10 10:08:26');

-- --------------------------------------------------------

--
-- Table structure for table `akuntansi_h_voucher`
--

CREATE TABLE `akuntansi_h_voucher` (
  `uniqid` varchar(25) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `prefix_number` smallint(8) NOT NULL DEFAULT '10000',
  `id_tipe_voucher` char(5) NOT NULL,
  `id_voucher` int(8) NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_pembuat` varchar(25) NOT NULL,
  `status_print` tinyint(3) NOT NULL,
  `eod` date NOT NULL,
  `eom` date NOT NULL,
  `eoy` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `akuntansi_h_voucher`
--

INSERT INTO `akuntansi_h_voucher` (`uniqid`, `status`, `prefix_number`, `id_tipe_voucher`, `id_voucher`, `waktu`, `user_pembuat`, `status_print`, `eod`, `eom`, `eoy`) VALUES
('HT5d9de2c7309b23.17756521', 0, 10000, 'HT', 16, '2019-10-09 13:38:15', '', 0, '0000-00-00', '0000-00-00', 0000),
('HT5d9de30077f673.39966929', 0, 10000, 'HT', 17, '2019-10-09 13:39:12', '', 0, '0000-00-00', '0000-00-00', 0000),
('HT5d9de312bb5b42.47103262', 0, 10000, 'HT', 18, '2019-10-09 13:39:30', '', 0, '0000-00-00', '0000-00-00', 0000),
('HT5d9de44c116a46.81864030', 0, 10000, 'HT', 19, '2019-10-09 13:44:44', '', 0, '0000-00-00', '0000-00-00', 0000),
('HT5d9de450c75db7.27336034', 0, 10000, 'HT', 20, '2019-10-09 13:44:48', '', 0, '0000-00-00', '0000-00-00', 0000),
('HT5d9de48be82ca8.28893878', 0, 10000, 'HT', 21, '2019-10-09 13:45:47', '', 0, '0000-00-00', '0000-00-00', 0000),
('HT5d9de4fa8dec11.75683849', 0, 10000, 'HT', 22, '2019-10-09 13:47:38', '', 0, '0000-00-00', '0000-00-00', 0000),
('HT5d9de55c9bbe28.65249559', 0, 10000, 'HT', 23, '2019-10-09 13:49:16', '', 0, '0000-00-00', '0000-00-00', 0000),
('HT5d9de5fc4edef7.75176117', 0, 10000, 'HT', 24, '2019-10-09 13:51:56', '', 0, '0000-00-00', '0000-00-00', 0000),
('HT5d9de75fb250f2.82243099', 0, 10000, 'HT', 25, '2019-10-09 13:57:51', '', 0, '0000-00-00', '0000-00-00', 0000),
('HT5d9de80dae65f7.14688608', 0, 10000, 'HT', 26, '2019-10-09 14:00:45', '', 0, '0000-00-00', '0000-00-00', 0000),
('HT5d9de82b305850.41128856', 0, 10000, 'HT', 27, '2019-10-09 14:01:15', '', 0, '0000-00-00', '0000-00-00', 0000),
('HT5d9de841e841a6.00940167', 0, 10000, 'HT', 28, '2019-10-09 14:01:37', '', 0, '0000-00-00', '0000-00-00', 0000),
('HT5d9de8f158b5b9.33130623', 0, 10000, 'HT', 29, '2019-10-09 14:04:33', '', 0, '0000-00-00', '0000-00-00', 0000),
('HT5d9de9ce55b131.40308677', 0, 10000, 'HT', 30, '2019-10-09 14:08:14', '', 0, '0000-00-00', '0000-00-00', 0000),
('HT5d9dea4c3d1542.06220262', 0, 10000, 'HT', 31, '2019-10-09 14:10:20', '', 0, '0000-00-00', '0000-00-00', 0000),
('HT5d9deacaf2c8e9.54521074', 0, 10000, 'HT', 32, '2019-10-09 14:12:26', '', 0, '0000-00-00', '0000-00-00', 0000),
('HT5d9deb1fdc8868.31663892', 0, 10000, 'HT', 33, '2019-10-09 14:13:51', '', 0, '0000-00-00', '0000-00-00', 0000),
('HT5d9debbdf01303.35507073', 0, 10000, 'HT', 34, '2019-10-09 14:16:29', '', 0, '0000-00-00', '0000-00-00', 0000),
('HT5d9debed121354.57558830', 0, 10000, 'HT', 35, '2019-10-09 14:17:17', '', 0, '0000-00-00', '0000-00-00', 0000),
('HT5d9decc76051c7.14449803', 0, 10000, 'HT', 36, '2019-10-09 14:20:55', '', 0, '0000-00-00', '0000-00-00', 0000),
('HT5d9ded9d917404.93242488', 0, 10000, 'HT', 37, '2019-10-09 14:24:29', '', 0, '0000-00-00', '0000-00-00', 0000),
('HT5d9dee8482db18.20559420', 0, 10000, 'HT', 38, '2019-10-09 14:28:20', '', 0, '0000-00-00', '0000-00-00', 0000),
('HT5d9def6be491c0.66782393', 0, 10000, 'HT', 39, '2019-10-09 14:32:11', '', 0, '0000-00-00', '0000-00-00', 0000),
('HT5d9defd8b6b9c8.86103441', 0, 10000, 'HT', 40, '2019-10-09 14:34:00', '', 0, '0000-00-00', '0000-00-00', 0000),
('HT5d9df2407bb272.08502791', 0, 10000, 'HT', 41, '2019-10-09 14:44:16', '', 0, '0000-00-00', '0000-00-00', 0000),
('HT5d9df277e0d011.59786994', 0, 10000, 'HT', 42, '2019-10-09 14:45:11', '', 0, '0000-00-00', '0000-00-00', 0000),
('JU5d9d8b74632c76.54701123', 0, 10000, 'JU', 9, '2019-10-09 07:25:40', '', 0, '0000-00-00', '0000-00-00', 0000),
('KB5d9dbb780bb408.53851597', 0, 10000, 'KB', 10, '2019-10-09 10:50:32', '', 0, '0000-00-00', '0000-00-00', 0000),
('KB5d9dff80b68a93.37810766', 0, 10000, 'KB', 43, '2019-10-09 15:40:48', '', 0, '0000-00-00', '0000-00-00', 0000),
('KB5d9f02e19de973.89072333', 0, 10000, 'KB', 44, '2019-10-10 10:07:29', '', 0, '0000-00-00', '0000-00-00', 0000),
('KB5d9f031ab18202.73709462', 0, 10000, 'KB', 45, '2019-10-10 10:08:26', '', 0, '0000-00-00', '0000-00-00', 0000);

-- --------------------------------------------------------

--
-- Stand-in structure for view `akuntansi_kumpulan_jurnal`
-- (See below for the actual view)
--
CREATE TABLE `akuntansi_kumpulan_jurnal` (
`uniqid_voucher` varchar(25)
,`id_voucher` int(8)
,`waktu` timestamp
,`eod` date
,`eom` date
,`eoy` year(4)
,`id_tipe_voucher` char(5)
,`prefix_number` smallint(8)
,`id_detail` int(18)
,`id_coa` varchar(9)
,`nama_coa` varchar(35)
,`nama_kelompok_coa` char(35)
,`nama_kategori` varchar(35)
,`saldo_normal` enum('debit','kredit','','')
,`saldo_normal_special` varchar(1)
,`saldo_awal` decimal(10,0)
,`pos` set('neraca','laba rugi','','')
,`debit` decimal(10,0)
,`kredit` decimal(10,0)
,`id_session` varchar(25)
,`keterangan` varchar(150)
,`status` tinyint(1)
,`status_print` tinyint(3)
);

-- --------------------------------------------------------

--
-- Table structure for table `akuntansi_m_coa`
--

CREATE TABLE `akuntansi_m_coa` (
  `uniqid` varchar(25) NOT NULL,
  `id_coa` varchar(9) NOT NULL,
  `id_kelompok_coa` char(8) NOT NULL,
  `id_kategori` varchar(11) NOT NULL,
  `nama_coa` varchar(35) NOT NULL,
  `uniqid_sub` varchar(25) NOT NULL,
  `saldo_awal` decimal(10,0) NOT NULL,
  `saldo_normal_special` varchar(1) NOT NULL,
  `quantity` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `akuntansi_m_coa`
--

INSERT INTO `akuntansi_m_coa` (`uniqid`, `id_coa`, `id_kelompok_coa`, `id_kategori`, `nama_coa`, `uniqid_sub`, `saldo_awal`, `saldo_normal_special`, `quantity`) VALUES
('1', '1011001', '1', '', 'KAS -IDR', '', '0', '', '0'),
('10', '1014003', '4', '', 'Persedian Barang  Arabica Premium', '', '0', '', '0'),
('100', '8000002', '28', '', 'Biaya bunga Bank', '', '0', '', '0'),
('101', '8000003', '28', '', 'Selisih Persedian Barang', '', '0', '', '0'),
('102', '9000000', '30', '', 'Ikhtisar Rugi Laba', '', '0', '', '0'),
('11', '1014004', '4', '', 'Persedian Barang  Arabica Wine', '', '0', '', '0'),
('12', '1014005', '4', '', 'Persedian Barang  Arabica Luwak', '', '0', '', '0'),
('12hpp', '5000000', '24', '', 'HPP', '', '0', '', '0'),
('13', '1014006', '4', '', 'Persedian Barang  Arabica Honey', '', '0', '', '0'),
('14', '1014007', '4', '', 'Persedian Barang  Arabica Full Wash', '', '0', '', '0'),
('15', '1014008', '4', '', 'Persedian Barang  Arabica Semi wash', '', '0', '', '0'),
('16', '1014009', '4', '', 'Persedian Barang  Arabica Blend', '', '0', '', '0'),
('17', '1014010', '4', '', 'Persedian Barang  Robusta', '', '0', '', '0'),
('18', '1014011', '4', '', 'Persedian Barang  Green Coffee', '', '0', '', '0'),
('19', '1014012', '4', '', 'Persedian Barang Tea Tarik ', '', '0', '', '0'),
('2', '1011002', '1', '', 'KAS -USD', '', '0', '', '0'),
('20', '1014013', '4', '', 'Persedian Barang Lemon Tea', '', '0', '', '0'),
('21', '1014014', '4', '', 'Persedian Barang  Coklat', '', '0', '', '0'),
('22', '1014015', '4', '', 'Persedian Barang Sirup ', '', '0', '', '0'),
('23', '1014016', '4', '', 'Persedian Barang Air Mineral', '', '0', '', '0'),
('2322a5ac-0cbf-11e9-b189-7', '100203', '1', '', 'asd', '', '200', '', '0'),
('24', '1014017', '4', '', 'Persedian Barang Air Galon', '', '0', '', '0'),
('25', '1014018', '4', '', 'Persedian Barang Susu Full Cream', '', '0', '', '0'),
('26', '1014019', '4', '', 'Persedian Barang Susu Kental Manis', '', '0', '', '0'),
('27', '1014020', '4', '', 'Persedian Barang Teh Botol Sosro', '', '0', '', '0'),
('28', '1014021', '4', '', 'Persediaan Barang Kemasan Kopi 100 ', '', '0', '', '0'),
('29', '1014022', '4', '', 'Persediaan Barang Kemasan Kopi 250 ', '', '0', '', '0'),
('3', '1012001', '2', '', 'BANK BCA', '', '0', '', '0'),
('30', '1014023', '4', '', 'Persediaan Barang Kemasan Kopi 500 ', '', '0', '', '0'),
('31', '1014024', '4', '', 'Persediaan Barang Kemasan Kopi 1000', '', '0', '', '0'),
('32', '1014025', '4', '', 'Persediaan Barang sticker Kopi Besa', '', '0', '', '0'),
('33', '1014026', '4', '', 'Persediaan Barang sticker Kopi Cup', '', '0', '', '0'),
('34', '1015001', '5', '', 'Sewa Di Bayar Di muka', '', '0', '', '0'),
('35', '1015002', '5', '', 'Uang Muka', '', '0', '', '0'),
('36', '1016001', '6', '', 'Cafe Supllies', '', '0', '', '0'),
('37', '1016002', '6', '', 'Amortisasi Cafe Supplies', '', '0', 'k', '0'),
('38', '1020001', '7', '', 'Perlengkapan & Perabotan Kantor', '', '0', '', '0'),
('39', '1020002', '7', '', 'Akum Penyusutan Perlengkapan & Pera', '', '0', 'k', '0'),
('4', '1012002', '2', '', 'BANK BNI', '', '0', '', '0'),
('40', '1020003', '8', '', 'Peralatan Kantor', '', '0', '', '0'),
('41', '1020004', '8', '', 'Akum Penyusutan Peralatan Kantor', '', '0', 'k', '0'),
('42', '1020005', '9', '', 'Kendaraan', '', '0', '', '0'),
('43', '1020006', '9', '', 'Akum Penyusutan Kendaraan', '', '0', 'k', '0'),
('44', '1020007', '10', '', 'Komputer', '', '0', '', '0'),
('45', '1020008', '10', '', 'Akum Penyusutan Komputer', '', '0', 'k', '0'),
('46', '1020009', '11', '', 'Partisi & Interior', '', '0', '', '0'),
('47', '1020010', '11', '', 'Akum Penyusutan Partisi & Interior', '', '0', 'k', '0'),
('48', '1030001', '12', '', 'Franchise Fee', '', '0', '', '0'),
('49', '1030002', '12', '', 'Goodwill', '', '0', '', '0'),
('5', '1012003', '2', '', 'BANK MANDIRI', '', '0', '', '0'),
('50', '2011001', '14', '', 'Hutang Dagang  A', '', '0', '', '0'),
('51', '2011002', '14', '', 'Hutang Dagang  B', '', '0', '', '0'),
('52', '2011003', '14', '', 'Hutang Dividen', '', '0', '', '0'),
('53', '2012001', '15', '', 'Hutang Karyawan', '', '0', '', '0'),
('54', '2013001', '16', '', 'Hutang PPh ', '', '0', '', '0'),
('55', '2013002', '16', '', 'Hutang PPN', '', '0', '', '0'),
('56', '2021001', '18', '', 'Hutang Bank A', '', '0', '', '0'),
('57', '2021002', '18', '', 'Hutang Bank B', '', '0', '', '0'),
('58', '3010001', '19', '', 'Modal Setor A', '', '0', '', '0'),
('59', '3010002', '19', '', 'Modal Setor B', '', '0', '', '0'),
('6', '1012004', '2', '', 'BANK BSM', '', '0', '', '0'),
('60', '3010003', '19', '', 'Modal Setor C', '', '0', '', '0'),
('61', '3012001', '21', '', 'Laba Rugi di Tahan tahun Lalu', '', '0', '', '0'),
('62', '3012002', '21', '', 'Laba Rugi Bulan Berjalan', '', '0', '', '0'),
('64', '4010001', '22', '', 'Penjualan Makanan', '', '0', '', '0'),
('65', '4010002', '22', '', 'Diskon Penjualan Makanan', '', '0', '', '0'),
('66', '4010003', '22', '', 'Penjualan Minuman', '', '0', '', '0'),
('67', '4010004', '22', '', 'Diskon Penjualan Minuman', '', '0', '', '0'),
('68', '4010005', '22', '', 'Penjualan Bubuk Kopi', '', '0', '', '0'),
('69', '4010006', '22', '', 'Penjualan Snack', '', '0', '', '0'),
('7', '1013001', '3', '', 'PIUTANG DAGANG', '', '0', '', '0'),
('70', '4011001', '23', '', 'Pendapatan Bunga Bank', '', '0', '', '0'),
('71', '6010001', '25', '', 'Biaya Gaji Karyawan', '', '0', '', '0'),
('72', '6010002', '25', '', 'Biaya Tunjangan Karyawan', '', '0', '', '0'),
('73', '6011001', '26', '', 'BIAYA ATK & BARANG CETAKAN', '', '0', '', '0'),
('74', '6011002', '26', '', 'BIAYA KEPERLUAN DAPUR CAFE', '', '0', '', '0'),
('75', '6011003', '26', '', 'BIAYA KEPERLUAN DAPUR MAKANAN', '', '0', '', '0'),
('76', '6011004', '26', '', 'BIAYA KEPERLUAN KANTOR', '', '0', '', '0'),
('77', '6011005', '26', '', 'BIAYA PENDIDIKAN&PELATIHAN', '', '0', '', '0'),
('78', '6011006', '26', '', 'BIAYA TRANSPORTASI', '', '0', '', '0'),
('78a', '1011003', '1', '', 'Kas Kecil', '', '0', '', '0'),
('79', '6011007', '26', '', 'BIAYA PERIZINAN DAN LEGAL', '', '0', '', '0'),
('8', '1014001', '4', '', 'Persedian Barang  Arabica Specialty', '', '0', '', '0'),
('80', '6011008', '26', '', 'BIAYA TELEPON & INTERNET', '', '0', '', '0'),
('81', '6011009', '26', '', 'BIAYA AIR PDAM', '', '0', '', '0'),
('82', '6011010', '26', '', 'BIAYA LISTRIK', '', '0', '', '0'),
('83', '6011011', '26', '', 'BIAYA KURIR DAN EKSPEDISI', '', '0', '', '0'),
('84', '6011012', '26', '', 'BIAYA PROMOSI & IKLAN', '', '0', '', '0'),
('85', '6011013', '26', '', 'BIAYA KEAMANAN & SOSIAL', '', '0', '', '0'),
('86', '6011014', '26', '', 'BIAYA ENTERTAIN', '', '0', '', '0'),
('87', '6011015', '26', '', 'BIAYA PERJALANAN DINAS', '', '0', '', '0'),
('88', '6011016', '26', '', 'BIAYA PEMELIHARAAN DAN PERBAIKAN GE', '', '0', '', '0'),
('89', '6011017', '26', '', 'BIAYA PEMELIHARAAN DAN PERBAIKAN PE', '', '0', '', '0'),
('9', '1014002', '4', '', 'Persedian Barang  Arabica Peaberry', '', '0', '', '0'),
('90', '6011018', '26', '', 'BIAYA PEMELIHARAAN DAN PERLENGKAPAN', '', '0', '', '0'),
('91', '6011019', '29', '', 'Biaya Pajak PPh ', '', '0', '', '0'),
('92', '6011020', '29', '', 'Biaya Pajak PPN', '', '0', '', '0'),
('93', '7000001', '27', '', 'Biaya Amortisasi Cafe Supplies', '', '0', '', '0'),
('94', '7000002', '27', '', 'Biaya Penyusutan Perlengkapan & Per', '', '0', '', '0'),
('95', '7000003', '27', '', 'Biaya Penyusutan Peralatan Kantor', '', '0', '', '0'),
('96', '7000004', '27', '', 'Biaya Penyusutan Kendaraan', '', '0', '', '0'),
('97', '7000005', '27', '', 'Biaya Penyusutan Komputer', '', '0', '', '0'),
('98', '7000006', '27', '', 'Biaya Penyusutan Partisi & Interior', '', '0', '', '0'),
('99', '8000001', '28', '', 'Biaya Adm Bank', '', '0', '', '0'),
('COA5ce3c68c7521d4.1709215', '23423423', '1', '', 'dsfsd', '', '232232', '2', '0'),
('COA5ce3c715ed3756.9025639', '3423423', '1', '', 'werwe', '', '23', '2', '0');

-- --------------------------------------------------------

--
-- Table structure for table `akuntansi_m_kategori`
--

CREATE TABLE `akuntansi_m_kategori` (
  `uniqid` varchar(25) NOT NULL,
  `id_kategori` varchar(9) NOT NULL,
  `nama_kategori` varchar(35) NOT NULL,
  `pos` set('neraca','laba rugi','','') NOT NULL DEFAULT 'neraca',
  `saldo_normal` enum('debit','kredit','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `akuntansi_m_kategori`
--

INSERT INTO `akuntansi_m_kategori` (`uniqid`, `id_kategori`, `nama_kategori`, `pos`, `saldo_normal`) VALUES
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

-- --------------------------------------------------------

--
-- Table structure for table `akuntansi_m_kelompok_coa`
--

CREATE TABLE `akuntansi_m_kelompok_coa` (
  `uniqid` varchar(25) NOT NULL,
  `id_kelompok_coa` char(8) NOT NULL,
  `id_kategori` char(8) NOT NULL,
  `nama_kelompok_coa` char(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `akuntansi_m_kelompok_coa`
--

INSERT INTO `akuntansi_m_kelompok_coa` (`uniqid`, `id_kelompok_coa`, `id_kategori`, `nama_kelompok_coa`) VALUES
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
('7', '1020001', '2', 'Perlengkapan & Perabotan Kantor'),
('8', '1020002', '2', 'Peralatan Kantor'),
('9', '1020003', '2', 'Kendaraan');

-- --------------------------------------------------------

--
-- Table structure for table `akuntansi_m_people`
--

CREATE TABLE `akuntansi_m_people` (
  `uniqid` varchar(25) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `no_handphone` varchar(20) NOT NULL,
  `email` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `akuntansi_m_people`
--

INSERT INTO `akuntansi_m_people` (`uniqid`, `nama`, `alamat`, `no_handphone`, `email`) VALUES
('98191786228318210', 'PT. Aceh Sawit Besar', 'Aceh Besar', '0831359599', 'acehsawit@gmail.com'),
('98191786228318211', 'CV. Medan Sawit Raya', 'Jl. K.L Yos Sudarso Medan', '0831359599', 'medan.sawit@gmail.co'),
('98216332469731332', 'CV. Karya Wisata Sawit', 'Jl. Karya Wisata', '0834342342', 'karya@gmail.com'),
('98284808626503680', 'sad', 'dfsd', '323', 'esfsd@gmail.com'),
('98284808626503681', 'sad', 'dfsd', '323', 'esfsd@gmail.com');

-- --------------------------------------------------------

--
-- Stand-in structure for view `akuntansi_trial_balance`
-- (See below for the actual view)
--
CREATE TABLE `akuntansi_trial_balance` (
`id_nama_coa` varchar(45)
,`nama_coa` varchar(35)
,`nilai_voucher` decimal(11,0)
,`nilai_debit` decimal(11,0)
,`nilai_kredit` decimal(11,0)
,`eod` date
,`eom` date
,`eoy` year(4)
,`saldo_normal_special` varchar(1)
,`saldo_normal` enum('debit','kredit','','')
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `akuntantansi_kumpulan_hutang`
-- (See below for the actual view)
--
CREATE TABLE `akuntantansi_kumpulan_hutang` (
`eod` date
,`status` tinyint(1)
,`uniqid_voucher` varchar(25)
,`keterangan` varchar(50)
,`nama` varchar(50)
,`nama_coa` varchar(35)
,`tgl_jatuh_tempo` date
,`debit` decimal(10,0)
,`kredit` decimal(10,0)
);

-- --------------------------------------------------------

--
-- Structure for view `akuntansi_buku_besar`
--
DROP TABLE IF EXISTS `akuntansi_buku_besar`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `akuntansi_buku_besar`  AS  select concat(`x`.`id_tipe_voucher`,convert(date_format(`x`.`waktu`,'%y%m') using latin1),convert(right(concat(`x`.`prefix_number`,`x`.`id_voucher`),4) using latin1)) AS `id_voucherjurnal`,concat(`x`.`id_coa`,' ',`x`.`nama_coa`) AS `id_nama_coa`,`x`.`id_detail` AS `id_detail`,`x`.`id_coa` AS `id_coa`,`x`.`debit` AS `debit`,`x`.`kredit` AS `kredit`,`x`.`id_session` AS `id_session`,(case when (`x`.`saldo_normal_special` = 'd') then (`x`.`debit` - `x`.`kredit`) when (`x`.`saldo_normal_special` = 'k') then (`x`.`kredit` - `x`.`debit`) else if((`x`.`saldo_normal` = 'debit'),(`x`.`debit` - `x`.`kredit`),(`x`.`kredit` - `x`.`debit`)) end) AS `nilai_voucher`,`x`.`keterangan` AS `keterangan`,`x`.`uniqid_voucher` AS `uniqid_voucher`,`x`.`eod` AS `eod`,`x`.`eom` AS `eom`,`x`.`eoy` AS `eoy`,`x`.`status_print` AS `status_print`,`x`.`eod` AS `waktu`,`x`.`nama_coa` AS `nama_coa`,`x`.`saldo_normal_special` AS `saldo_normal_special`,`x`.`saldo_awal` AS `saldo_awal`,`x`.`nama_kelompok_coa` AS `nama_kelompok_coa`,`x`.`nama_kategori` AS `nama_kategori`,`x`.`pos` AS `pos`,`x`.`saldo_normal` AS `saldo_normal`,`x`.`status` AS `status` from `akuntansi_kumpulan_jurnal` `x` where (`x`.`status` = 1) ;

-- --------------------------------------------------------

--
-- Structure for view `akuntansi_coa`
--
DROP TABLE IF EXISTS `akuntansi_coa`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `akuntansi_coa`  AS  select `akuntansi_m_kategori`.`uniqid` AS `uniqid`,`akuntansi_m_kategori`.`pos` AS `pos`,`akuntansi_m_kategori`.`nama_kategori` AS `nama_kategori`,`akuntansi_m_kategori`.`saldo_normal` AS `saldo_normal`,`akuntansi_m_kelompok_coa`.`uniqid` AS `kel_uniqid`,`akuntansi_m_kelompok_coa`.`id_kelompok_coa` AS `id_kelompok_coa`,`akuntansi_m_kelompok_coa`.`nama_kelompok_coa` AS `nama_kelompok_coa`,`akuntansi_m_coa`.`id_coa` AS `id_coa`,`akuntansi_m_coa`.`saldo_normal_special` AS `saldo_normal_special`,`akuntansi_m_coa`.`nama_coa` AS `nama_coa`,`akuntansi_m_coa`.`saldo_awal` AS `saldo_awal`,`akuntansi_m_coa`.`uniqid` AS `coa_id` from ((`akuntansi_m_kategori` left join `akuntansi_m_kelompok_coa` on((`akuntansi_m_kategori`.`uniqid` = `akuntansi_m_kelompok_coa`.`id_kategori`))) left join `akuntansi_m_coa` on((`akuntansi_m_kelompok_coa`.`uniqid` = `akuntansi_m_coa`.`id_kelompok_coa`))) ;

-- --------------------------------------------------------

--
-- Structure for view `akuntansi_kumpulan_jurnal`
--
DROP TABLE IF EXISTS `akuntansi_kumpulan_jurnal`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `akuntansi_kumpulan_jurnal`  AS  select `a`.`uniqid_voucher` AS `uniqid_voucher`,`b`.`id_voucher` AS `id_voucher`,`a`.`waktu` AS `waktu`,`b`.`eod` AS `eod`,`b`.`eom` AS `eom`,`b`.`eoy` AS `eoy`,`b`.`id_tipe_voucher` AS `id_tipe_voucher`,`b`.`prefix_number` AS `prefix_number`,`a`.`id_detail` AS `id_detail`,`a`.`id_coa` AS `id_coa`,`c`.`nama_coa` AS `nama_coa`,`c`.`nama_kelompok_coa` AS `nama_kelompok_coa`,`c`.`nama_kategori` AS `nama_kategori`,`c`.`saldo_normal` AS `saldo_normal`,`c`.`saldo_normal_special` AS `saldo_normal_special`,`c`.`saldo_awal` AS `saldo_awal`,`c`.`pos` AS `pos`,`a`.`debit` AS `debit`,`a`.`kredit` AS `kredit`,`a`.`id_session` AS `id_session`,`a`.`keterangan` AS `keterangan`,`b`.`status` AS `status`,`b`.`status_print` AS `status_print` from ((`akuntansi_detail_voucher` `a` left join `akuntansi_h_voucher` `b` on((`a`.`uniqid_voucher` = `b`.`uniqid`))) left join `akuntansi_coa` `c` on((`a`.`id_coa` = `c`.`id_coa`))) ;

-- --------------------------------------------------------

--
-- Structure for view `akuntansi_trial_balance`
--
DROP TABLE IF EXISTS `akuntansi_trial_balance`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `akuntansi_trial_balance`  AS  select `akuntansi_buku_besar`.`id_nama_coa` AS `id_nama_coa`,`akuntansi_buku_besar`.`nama_coa` AS `nama_coa`,`akuntansi_buku_besar`.`nilai_voucher` AS `nilai_voucher`,(case when (`akuntansi_buku_besar`.`saldo_normal_special` = 'd') then `akuntansi_buku_besar`.`nilai_voucher` when (`akuntansi_buku_besar`.`saldo_normal_special` = 'k') then 0 else if((`akuntansi_buku_besar`.`saldo_normal` = 'debit'),`akuntansi_buku_besar`.`nilai_voucher`,0) end) AS `nilai_debit`,(case when (`akuntansi_buku_besar`.`saldo_normal_special` = 'd') then 0 when (`akuntansi_buku_besar`.`saldo_normal_special` = 'k') then `akuntansi_buku_besar`.`nilai_voucher` else if((`akuntansi_buku_besar`.`saldo_normal` = 'kredit'),`akuntansi_buku_besar`.`nilai_voucher`,0) end) AS `nilai_kredit`,`akuntansi_buku_besar`.`eod` AS `eod`,`akuntansi_buku_besar`.`eom` AS `eom`,`akuntansi_buku_besar`.`eoy` AS `eoy`,`akuntansi_buku_besar`.`saldo_normal_special` AS `saldo_normal_special`,`akuntansi_buku_besar`.`saldo_normal` AS `saldo_normal` from `akuntansi_buku_besar` ;

-- --------------------------------------------------------

--
-- Structure for view `akuntantansi_kumpulan_hutang`
--
DROP TABLE IF EXISTS `akuntantansi_kumpulan_hutang`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `akuntantansi_kumpulan_hutang`  AS  select `e`.`eod` AS `eod`,`e`.`status` AS `status`,`a`.`uniqid_voucher` AS `uniqid_voucher`,`b`.`keterangan` AS `keterangan`,`d`.`nama` AS `nama`,`c`.`nama_coa` AS `nama_coa`,`b`.`tgl_jatuh_tempo` AS `tgl_jatuh_tempo`,`b`.`debit` AS `debit`,`b`.`kredit` AS `kredit` from ((((`akuntansi_detail_voucher` `a` join `akuntansi_detail_hutang` `b` on((`a`.`uniqid` = `b`.`uniqid_detail_voucher`))) left join `akuntansi_m_coa` `c` on((`a`.`id_coa` = `c`.`id_coa`))) left join `akuntansi_m_people` `d` on((`b`.`id_people` = `d`.`uniqid`))) left join `akuntansi_h_voucher` `e` on((`e`.`uniqid` = `a`.`uniqid_voucher`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akuntansi_detail_stock`
--
ALTER TABLE `akuntansi_detail_stock`
  ADD PRIMARY KEY (`uniqid`),
  ADD KEY `id_point` (`id_stock`),
  ADD KEY `coa` (`id_coa_stock`),
  ADD KEY `uniqid_voucher` (`uniqid_voucher`);

--
-- Indexes for table `akuntansi_detail_voucher`
--
ALTER TABLE `akuntansi_detail_voucher`
  ADD PRIMARY KEY (`uniqid`),
  ADD KEY `id_detail` (`id_detail`),
  ADD KEY `detail_akuntansi_voucher_ibfk_1` (`uniqid_voucher`),
  ADD KEY `id_coa` (`id_coa`);

--
-- Indexes for table `akuntansi_h_voucher`
--
ALTER TABLE `akuntansi_h_voucher`
  ADD PRIMARY KEY (`uniqid`),
  ADD KEY `id_voucher` (`id_voucher`);

--
-- Indexes for table `akuntansi_m_coa`
--
ALTER TABLE `akuntansi_m_coa`
  ADD PRIMARY KEY (`uniqid`),
  ADD UNIQUE KEY `id_coa` (`id_coa`) USING BTREE;

--
-- Indexes for table `akuntansi_m_kategori`
--
ALTER TABLE `akuntansi_m_kategori`
  ADD PRIMARY KEY (`uniqid`),
  ADD UNIQUE KEY `id_tipe` (`id_kategori`);

--
-- Indexes for table `akuntansi_m_kelompok_coa`
--
ALTER TABLE `akuntansi_m_kelompok_coa`
  ADD PRIMARY KEY (`uniqid`),
  ADD UNIQUE KEY `id_subtipe` (`id_kelompok_coa`);

--
-- Indexes for table `akuntansi_m_people`
--
ALTER TABLE `akuntansi_m_people`
  ADD PRIMARY KEY (`uniqid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akuntansi_detail_stock`
--
ALTER TABLE `akuntansi_detail_stock`
  MODIFY `id_stock` smallint(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `akuntansi_detail_voucher`
--
ALTER TABLE `akuntansi_detail_voucher`
  MODIFY `id_detail` int(18) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;
--
-- AUTO_INCREMENT for table `akuntansi_h_voucher`
--
ALTER TABLE `akuntansi_h_voucher`
  MODIFY `id_voucher` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `akuntansi_detail_stock`
--
ALTER TABLE `akuntansi_detail_stock`
  ADD CONSTRAINT `akuntansi_detail_stock_ibfk_1` FOREIGN KEY (`uniqid_voucher`) REFERENCES `akuntansi_h_voucher` (`uniqid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `coa` FOREIGN KEY (`id_coa_stock`) REFERENCES `akuntansi_m_coa` (`id_coa`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
