-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: apporder
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.21-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Temporary view structure for view `buku_besar`
--

DROP TABLE IF EXISTS `buku_besar`;
/*!50001 DROP VIEW IF EXISTS `buku_besar`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `buku_besar` AS SELECT 
 1 AS `id_nama_coa`,
 1 AS `id_detail`,
 1 AS `id_coa`,
 1 AS `debit`,
 1 AS `kredit`,
 1 AS `id_session`,
 1 AS `nilai_voucher`,
 1 AS `keterangan`,
 1 AS `uniqid_voucher`,
 1 AS `eod`,
 1 AS `eom`,
 1 AS `eoy`,
 1 AS `status_print`,
 1 AS `waktu`,
 1 AS `nama_coa`,
 1 AS `saldo_normal_special`,
 1 AS `saldo_awal`,
 1 AS `nama_kelompok_coa`,
 1 AS `nama_kategori`,
 1 AS `pos`,
 1 AS `saldo_normal`,
 1 AS `status`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `daftar_coa_neraca`
--

DROP TABLE IF EXISTS `daftar_coa_neraca`;
/*!50001 DROP VIEW IF EXISTS `daftar_coa_neraca`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `daftar_coa_neraca` AS SELECT 
 1 AS `id_coa`,
 1 AS `nama_coa`,
 1 AS `nilai_voucher`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `kumpulan_jurnal`
--

DROP TABLE IF EXISTS `kumpulan_jurnal`;
/*!50001 DROP VIEW IF EXISTS `kumpulan_jurnal`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `kumpulan_jurnal` AS SELECT 
 1 AS `uniqid_voucher`,
 1 AS `waktu`,
 1 AS `eod`,
 1 AS `id_detail`,
 1 AS `id_coa`,
 1 AS `nama_coa`,
 1 AS `debit`,
 1 AS `kredit`,
 1 AS `id_session`,
 1 AS `keterangan`,
 1 AS `status`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `laba_rugi`
--

DROP TABLE IF EXISTS `laba_rugi`;
/*!50001 DROP VIEW IF EXISTS `laba_rugi`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `laba_rugi` AS SELECT 
 1 AS `id_coa`,
 1 AS `saldo`,
 1 AS `eod`,
 1 AS `eom`,
 1 AS `eoy`,
 1 AS `nama_coa`,
 1 AS `nama_kelompok_coa`,
 1 AS `id_kategori`,
 1 AS `nama_kategori`,
 1 AS `pos`,
 1 AS `saldo_normal_special`,
 1 AS `saldo_normal`,
 1 AS `saldo_awal`,
 1 AS `status`,
 1 AS `id_nama_coa`,
 1 AS `id_nama_kelompok_coa`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `laporan_jurnal`
--

DROP TABLE IF EXISTS `laporan_jurnal`;
/*!50001 DROP VIEW IF EXISTS `laporan_jurnal`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `laporan_jurnal` AS SELECT 
 1 AS `uniqid_voucher`,
 1 AS `waktu`,
 1 AS `eod`,
 1 AS `id_detail`,
 1 AS `id_coa`,
 1 AS `nama_coa`,
 1 AS `inversid_coa`,
 1 AS `inversnama_coa`,
 1 AS `debit`,
 1 AS `kredit`,
 1 AS `invers_debit`,
 1 AS `invers_kredit`,
 1 AS `id_session`,
 1 AS `inversid_session`,
 1 AS `keterangan`,
 1 AS `status`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `laporan_keuangan`
--

DROP TABLE IF EXISTS `laporan_keuangan`;
/*!50001 DROP VIEW IF EXISTS `laporan_keuangan`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `laporan_keuangan` AS SELECT 
 1 AS `id_coa`,
 1 AS `debit`,
 1 AS `kredit`,
 1 AS `nilai_voucher`,
 1 AS `eod`,
 1 AS `eom`,
 1 AS `eoy`,
 1 AS `nama_coa`,
 1 AS `saldo_normal_special`,
 1 AS `nama_kelompok_coa`,
 1 AS `id_kategori`,
 1 AS `nama_kategori`,
 1 AS `pos`,
 1 AS `saldo_normal`,
 1 AS `saldo_awal`,
 1 AS `status`,
 1 AS `id_nama_coa`,
 1 AS `id_nama_kelompok_coa`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `laporan_penjualan`
--

DROP TABLE IF EXISTS `laporan_penjualan`;
/*!50001 DROP VIEW IF EXISTS `laporan_penjualan`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `laporan_penjualan` AS SELECT 
 1 AS `id_bill`,
 1 AS `uniqid_transaksi`,
 1 AS `status_print`,
 1 AS `nama_meja`,
 1 AS `waktu_order`,
 1 AS `hari`,
 1 AS `tanggal`,
 1 AS `waktu`,
 1 AS `eod`,
 1 AS `uniqid`,
 1 AS `harga_jual`,
 1 AS `quantity`,
 1 AS `diskon_persen`,
 1 AS `pajak_persen`,
 1 AS `total_kotor`,
 1 AS `nilai_pajak`,
 1 AS `nilai_potongan`,
 1 AS `total_bersih`,
 1 AS `void`,
 1 AS `nama_customer`,
 1 AS `id_jenis`,
 1 AS `nama_jenis`,
 1 AS `id_product`,
 1 AS `nama_product`,
 1 AS `nama_kasir`,
 1 AS `nama_waiters`,
 1 AS `id_metode`,
 1 AS `nama_metode`,
 1 AS `id_tipe`,
 1 AS `nama_tipe`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `laporan_point`
--

DROP TABLE IF EXISTS `laporan_point`;
/*!50001 DROP VIEW IF EXISTS `laporan_point`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `laporan_point` AS SELECT 
 1 AS `uniqid_transaksi`,
 1 AS `uniqid`,
 1 AS `id_point`,
 1 AS `debit`,
 1 AS `kredit`,
 1 AS `nama_product`,
 1 AS `quantity`,
 1 AS `keterangan`,
 1 AS `id_customer`,
 1 AS `first_name`,
 1 AS `last_name`,
 1 AS `id_bill`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `laporan_stock`
--

DROP TABLE IF EXISTS `laporan_stock`;
/*!50001 DROP VIEW IF EXISTS `laporan_stock`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `laporan_stock` AS SELECT 
 1 AS `waktu`,
 1 AS `eod`,
 1 AS `status`,
 1 AS `uniqid`,
 1 AS `uniqid_voucher`,
 1 AS `id_stock`,
 1 AS `id_coa_stock`,
 1 AS `nama_stock`,
 1 AS `total_nilai_stock_awal`,
 1 AS `quantity_awal`,
 1 AS `jenis_pembayaran`,
 1 AS `nama_vendor`,
 1 AS `debit_stock`,
 1 AS `kredit_stock`,
 1 AS `v_stock`,
 1 AS `satuan`,
 1 AS `saldo_quantity_akhir`,
 1 AS `harga_beli`,
 1 AS `nilai_potongan`,
 1 AS `persen_potongan`,
 1 AS `nilai_pajak`,
 1 AS `persen_pajak`,
 1 AS `total_nilai_stock`,
 1 AS `keterangan`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `m_coa_pendapatan`
--

DROP TABLE IF EXISTS `m_coa_pendapatan`;
/*!50001 DROP VIEW IF EXISTS `m_coa_pendapatan`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `m_coa_pendapatan` AS SELECT 
 1 AS `uniqid`,
 1 AS `id_coa`,
 1 AS `id_kelompok_coa`,
 1 AS `id_kategori`,
 1 AS `nama_coa`,
 1 AS `uniqid_sub`,
 1 AS `saldo_awal`,
 1 AS `saldo_normal_special`,
 1 AS `quantity`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `neraca`
--

DROP TABLE IF EXISTS `neraca`;
/*!50001 DROP VIEW IF EXISTS `neraca`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `neraca` AS SELECT 
 1 AS `id_coa`,
 1 AS `saldo`,
 1 AS `eod`,
 1 AS `eom`,
 1 AS `eoy`,
 1 AS `nama_coa`,
 1 AS `nama_kelompok_coa`,
 1 AS `id_kategori`,
 1 AS `nama_kategori`,
 1 AS `pos`,
 1 AS `saldo_normal_special`,
 1 AS `saldo_normal`,
 1 AS `saldo_awal`,
 1 AS `status`,
 1 AS `id_nama_coa`,
 1 AS `id_nama_kelompok_coa`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `pekerja_atasan`
--

DROP TABLE IF EXISTS `pekerja_atasan`;
/*!50001 DROP VIEW IF EXISTS `pekerja_atasan`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `pekerja_atasan` AS SELECT 
 1 AS `id`,
 1 AS `email`,
 1 AS `username`,
 1 AS `nama_group`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `trial_balance`
--

DROP TABLE IF EXISTS `trial_balance`;
/*!50001 DROP VIEW IF EXISTS `trial_balance`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `trial_balance` AS SELECT 
 1 AS `id_nama_coa`,
 1 AS `nama_coa`,
 1 AS `nilai_voucher`,
 1 AS `nilai_debit`,
 1 AS `nilai_kredit`,
 1 AS `eod`,
 1 AS `eom`,
 1 AS `eoy`,
 1 AS `saldo_normal_special`,
 1 AS `saldo_normal`*/;
SET character_set_client = @saved_cs_client;

--
-- Final view structure for view `buku_besar`
--

/*!50001 DROP VIEW IF EXISTS `buku_besar`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `buku_besar` AS select concat(`x`.`id_coa`,' ',`a`.`nama_coa`) AS `id_nama_coa`,`x`.`id_detail` AS `id_detail`,`x`.`id_coa` AS `id_coa`,`x`.`debit` AS `debit`,`x`.`kredit` AS `kredit`,`x`.`id_session` AS `id_session`,(case when (`a`.`saldo_normal_special` = 'd') then (`x`.`debit` - `x`.`kredit`) when (`a`.`saldo_normal_special` = 'k') then (`x`.`kredit` - `x`.`debit`) else if((`c`.`saldo_normal` = 'debit'),(`x`.`debit` - `x`.`kredit`),(`x`.`kredit` - `x`.`debit`)) end) AS `nilai_voucher`,`x`.`keterangan` AS `keterangan`,`x`.`uniqid_voucher` AS `uniqid_voucher`,`d`.`eod` AS `eod`,`d`.`eom` AS `eom`,`d`.`eoy` AS `eoy`,`d`.`status_print` AS `status_print`,`d`.`eod` AS `waktu`,`a`.`nama_coa` AS `nama_coa`,`a`.`saldo_normal_special` AS `saldo_normal_special`,`a`.`saldo_awal` AS `saldo_awal`,`b`.`nama_kelompok_coa` AS `nama_kelompok_coa`,`c`.`nama_kategori` AS `nama_kategori`,`c`.`pos` AS `pos`,`c`.`saldo_normal` AS `saldo_normal`,`d`.`status` AS `status` from ((((`detail_akuntansi_voucher` `x` left join `m_coa` `a` on((`x`.`id_coa` = `a`.`id_coa`))) left join `m_kelompok_coa` `b` on((`a`.`id_kelompok_coa` = `b`.`uniqid`))) left join `m_akuntansi_kategori` `c` on((`b`.`id_kategori` = `c`.`uniqid`))) left join `h_akuntansi_voucher` `d` on((`x`.`uniqid_voucher` = `d`.`uniqid`))) where (`d`.`status` = 1) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `daftar_coa_neraca`
--

/*!50001 DROP VIEW IF EXISTS `daftar_coa_neraca`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `daftar_coa_neraca` AS select `laporan_keuangan`.`id_coa` AS `id_coa`,`laporan_keuangan`.`nama_coa` AS `nama_coa`,(`laporan_keuangan`.`saldo_awal` + sum(`laporan_keuangan`.`nilai_voucher`)) AS `nilai_voucher` from `laporan_keuangan` where (`laporan_keuangan`.`pos` = 'neraca') group by `laporan_keuangan`.`id_nama_coa` order by `laporan_keuangan`.`id_nama_coa` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `kumpulan_jurnal`
--

/*!50001 DROP VIEW IF EXISTS `kumpulan_jurnal`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `kumpulan_jurnal` AS select `a`.`uniqid_voucher` AS `uniqid_voucher`,`a`.`waktu` AS `waktu`,`b`.`eod` AS `eod`,`a`.`id_detail` AS `id_detail`,`a`.`id_coa` AS `id_coa`,`c`.`nama_coa` AS `nama_coa`,`a`.`debit` AS `debit`,`a`.`kredit` AS `kredit`,`a`.`id_session` AS `id_session`,`a`.`keterangan` AS `keterangan`,`b`.`status` AS `status` from ((`detail_akuntansi_voucher` `a` left join `h_akuntansi_voucher` `b` on((`a`.`uniqid_voucher` = `b`.`uniqid`))) left join `m_coa` `c` on((`a`.`id_coa` = `c`.`id_coa`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `laba_rugi`
--

/*!50001 DROP VIEW IF EXISTS `laba_rugi`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `laba_rugi` AS select `laporan_keuangan`.`id_coa` AS `id_coa`,(`laporan_keuangan`.`kredit` - `laporan_keuangan`.`debit`) AS `saldo`,`laporan_keuangan`.`eod` AS `eod`,`laporan_keuangan`.`eom` AS `eom`,`laporan_keuangan`.`eoy` AS `eoy`,`laporan_keuangan`.`nama_coa` AS `nama_coa`,`laporan_keuangan`.`nama_kelompok_coa` AS `nama_kelompok_coa`,`laporan_keuangan`.`id_kategori` AS `id_kategori`,`laporan_keuangan`.`nama_kategori` AS `nama_kategori`,`laporan_keuangan`.`pos` AS `pos`,`laporan_keuangan`.`saldo_normal_special` AS `saldo_normal_special`,`laporan_keuangan`.`saldo_normal` AS `saldo_normal`,if(((`laporan_keuangan`.`saldo_normal` = 'debit') or (`laporan_keuangan`.`saldo_normal_special` = 'd')),(`laporan_keuangan`.`saldo_awal` * -(1)),`laporan_keuangan`.`saldo_awal`) AS `saldo_awal`,`laporan_keuangan`.`status` AS `status`,`laporan_keuangan`.`id_nama_coa` AS `id_nama_coa`,`laporan_keuangan`.`id_nama_kelompok_coa` AS `id_nama_kelompok_coa` from `laporan_keuangan` where (`laporan_keuangan`.`pos` = 'laba rugi') */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `laporan_jurnal`
--

/*!50001 DROP VIEW IF EXISTS `laporan_jurnal`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `laporan_jurnal` AS select `a`.`uniqid_voucher` AS `uniqid_voucher`,`a`.`eod` AS `waktu`,`a`.`eod` AS `eod`,`a`.`id_detail` AS `id_detail`,`a`.`id_coa` AS `id_coa`,`a`.`nama_coa` AS `nama_coa`,`b`.`id_coa` AS `inversid_coa`,`b`.`nama_coa` AS `inversnama_coa`,`a`.`debit` AS `debit`,`a`.`kredit` AS `kredit`,`b`.`debit` AS `invers_debit`,`b`.`kredit` AS `invers_kredit`,`a`.`id_session` AS `id_session`,`b`.`id_session` AS `inversid_session`,`a`.`keterangan` AS `keterangan`,`a`.`status` AS `status` from (`kumpulan_jurnal` `a` left join `kumpulan_jurnal` `b` on((`a`.`id_session` = `b`.`id_session`))) where ((`a`.`id_detail` <> `b`.`id_detail`) and (`a`.`kredit` = 0) and (`a`.`status` = 1)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `laporan_keuangan`
--

/*!50001 DROP VIEW IF EXISTS `laporan_keuangan`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `laporan_keuangan` AS select `x`.`id_coa` AS `id_coa`,ifnull(`a`.`debit`,0) AS `debit`,ifnull(`a`.`kredit`,0) AS `kredit`,`a`.`nilai_voucher` AS `nilai_voucher`,`a`.`eod` AS `eod`,`a`.`eom` AS `eom`,`a`.`eoy` AS `eoy`,`x`.`nama_coa` AS `nama_coa`,`x`.`saldo_normal_special` AS `saldo_normal_special`,`b`.`nama_kelompok_coa` AS `nama_kelompok_coa`,`c`.`id_kategori` AS `id_kategori`,`c`.`nama_kategori` AS `nama_kategori`,`c`.`pos` AS `pos`,`c`.`saldo_normal` AS `saldo_normal`,`x`.`saldo_awal` AS `saldo_awal`,`a`.`status` AS `status`,concat(`x`.`id_coa`,' ',`x`.`nama_coa`) AS `id_nama_coa`,concat(`b`.`id_kelompok_coa`,' ',`b`.`nama_kelompok_coa`) AS `id_nama_kelompok_coa` from (((`m_coa` `x` left join `buku_besar` `a` on((`x`.`id_coa` = `a`.`id_coa`))) left join `m_kelompok_coa` `b` on((`x`.`id_kelompok_coa` = `b`.`uniqid`))) left join `m_akuntansi_kategori` `c` on((`b`.`id_kategori` = `c`.`uniqid`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `laporan_penjualan`
--

/*!50001 DROP VIEW IF EXISTS `laporan_penjualan`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `laporan_penjualan` AS select concat(`b`.`prefix_bill`,convert(date_format(`b`.`waktu_order`,'%y%m') using latin1),`b`.`id_metode`,convert(right(concat(`b`.`prefix_number`,`b`.`id_transaksi`),4) using latin1)) AS `id_bill`,`d`.`uniqid_transaksi` AS `uniqid_transaksi`,`b`.`status_print` AS `status_print`,`a`.`nama_meja` AS `nama_meja`,`b`.`waktu_order` AS `waktu_order`,date_format(`b`.`eod`,'%a') AS `hari`,date_format(`b`.`eod`,'%d-%m-%y') AS `tanggal`,date_format(`b`.`waktu_order`,'%H:%i') AS `waktu`,`b`.`eod` AS `eod`,`b`.`uniqid` AS `uniqid`,`d`.`harga_jual` AS `harga_jual`,`d`.`quantity` AS `quantity`,`d`.`diskon_persen` AS `diskon_persen`,`d`.`pajak` AS `pajak_persen`,(`d`.`harga_jual` * `d`.`quantity`) AS `total_kotor`,(((`d`.`harga_jual` * `d`.`quantity`) * `d`.`pajak`) / 100) AS `nilai_pajak`,(((`d`.`harga_jual` * `d`.`quantity`) * `d`.`diskon_persen`) / 100) AS `nilai_potongan`,(((`d`.`harga_jual` * `d`.`quantity`) + (((`d`.`harga_jual` * `d`.`quantity`) * `d`.`pajak`) / 100)) - (((`d`.`harga_jual` * `d`.`quantity`) * `d`.`diskon_persen`) / 100)) AS `total_bersih`,`d`.`void` AS `void`,`c`.`display_name` AS `nama_customer`,`f`.`id_jenis` AS `id_jenis`,`f`.`nama_jenis` AS `nama_jenis`,`e`.`id_product` AS `id_product`,`e`.`nama_product` AS `nama_product`,`g`.`display_name` AS `nama_kasir`,`h`.`display_name` AS `nama_waiters`,`i`.`id_metode` AS `id_metode`,`i`.`nama_metode` AS `nama_metode`,`j`.`id_tipe` AS `id_tipe`,`j`.`nama_tipe` AS `nama_tipe` from (((((((((`h_transaksi` `b` left join `m_meja` `a` on((`a`.`id_meja` = `b`.`id_meja`))) left join `wp_apporder_users` `c` on((`c`.`ID` = `b`.`id_customer`))) join `detail_transaksi` `d` on((`d`.`uniqid_transaksi` = `b`.`uniqid`))) left join `m_product` `e` on((`d`.`id_product` = `e`.`id_product`))) left join `m_jenis` `f` on((`e`.`id_jenis` = `f`.`id_jenis`))) left join `wp_apporder_users` `g` on((`g`.`ID` = `b`.`id_kasir`))) left join `wp_apporder_users` `h` on((`h`.`ID` = `b`.`id_waiters`))) left join `m_metode_pembayaran` `i` on((`i`.`id_metode` = `b`.`id_metode`))) left join `m_tipe_pembayaran` `j` on((`j`.`id_tipe` = `b`.`id_tipe`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `laporan_point`
--

/*!50001 DROP VIEW IF EXISTS `laporan_point`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `laporan_point` AS select `a`.`uniqid_transaksi` AS `uniqid_transaksi`,`a`.`uniqid` AS `uniqid`,`a`.`id_point` AS `id_point`,`a`.`debit` AS `debit`,`a`.`kredit` AS `kredit`,`c`.`nama_product` AS `nama_product`,`a`.`quantity` AS `quantity`,`a`.`keterangan` AS `keterangan`,`b`.`id_customer` AS `id_customer`,`d`.`first_name` AS `first_name`,`d`.`last_name` AS `last_name`,`e`.`id_bill` AS `id_bill` from ((((`detail_transaksi_point` `a` join `h_transaksi_point` `b` on((`a`.`uniqid_transaksi` = `b`.`uniqid`))) left join `m_product` `c` on((`a`.`id_product` = `c`.`id_product`))) left join `m_customer` `d` on((`b`.`id_customer` = `d`.`uniqid`))) left join `laporan_penjualan` `e` on((`b`.`uniqid_order` = `e`.`uniqid`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `laporan_stock`
--

/*!50001 DROP VIEW IF EXISTS `laporan_stock`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `laporan_stock` AS select `c`.`waktu` AS `waktu`,`c`.`eod` AS `eod`,`c`.`status` AS `status`,`a`.`uniqid` AS `uniqid`,`a`.`uniqid_voucher` AS `uniqid_voucher`,`a`.`id_stock` AS `id_stock`,`a`.`id_coa_stock` AS `id_coa_stock`,`f`.`nama_coa` AS `nama_stock`,`f`.`saldo_awal` AS `total_nilai_stock_awal`,`f`.`quantity` AS `quantity_awal`,`g`.`nama_coa` AS `jenis_pembayaran`,`d`.`name` AS `nama_vendor`,`a`.`debit_stock` AS `debit_stock`,`a`.`kredit_stock` AS `kredit_stock`,(`a`.`debit_stock` - `a`.`kredit_stock`) AS `v_stock`,`e`.`nama_satuan` AS `satuan`,`a`.`saldo_quantity_akhir` AS `saldo_quantity_akhir`,`a`.`harga_beli` AS `harga_beli`,`a`.`nilai_potongan` AS `nilai_potongan`,`a`.`persen_potongan` AS `persen_potongan`,`a`.`nilai_pajak` AS `nilai_pajak`,`a`.`persen_pajak` AS `persen_pajak`,if((`a`.`debit_stock` > 0),`a`.`total_nilai_stock`,(`a`.`total_nilai_stock` * -(1))) AS `total_nilai_stock`,`a`.`keterangan` AS `keterangan` from (((((`detail_akuntansi_stock` `a` left join `h_akuntansi_voucher` `c` on((`c`.`uniqid` = `a`.`uniqid_voucher`))) left join `m_vendor` `d` on((`a`.`id_vendor` = `d`.`id_vendor`))) left join `m_satuan` `e` on((`a`.`satuan` = `e`.`id_satuan`))) left join `m_coa` `f` on((`a`.`id_coa_stock` = `f`.`id_coa`))) left join `m_coa` `g` on((`a`.`id_jenis_pembayaran` = `g`.`id_coa`))) where (`c`.`status` = 1) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `m_coa_pendapatan`
--

/*!50001 DROP VIEW IF EXISTS `m_coa_pendapatan`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `m_coa_pendapatan` AS select `a`.`uniqid` AS `uniqid`,`a`.`id_coa` AS `id_coa`,`a`.`id_kelompok_coa` AS `id_kelompok_coa`,`a`.`id_kategori` AS `id_kategori`,`a`.`nama_coa` AS `nama_coa`,`a`.`uniqid_sub` AS `uniqid_sub`,`a`.`saldo_awal` AS `saldo_awal`,`a`.`saldo_normal_special` AS `saldo_normal_special`,`a`.`quantity` AS `quantity` from (`m_coa` `a` join `m_kelompok_coa` `b` on((`a`.`id_kelompok_coa` = `b`.`uniqid`))) where ((`b`.`id_kelompok_coa` = 4010000) or (`b`.`id_kelompok_coa` = 4011000)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `neraca`
--

/*!50001 DROP VIEW IF EXISTS `neraca`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `neraca` AS select `laporan_keuangan`.`id_coa` AS `id_coa`,(`laporan_keuangan`.`debit` - `laporan_keuangan`.`kredit`) AS `saldo`,`laporan_keuangan`.`eod` AS `eod`,`laporan_keuangan`.`eom` AS `eom`,`laporan_keuangan`.`eoy` AS `eoy`,`laporan_keuangan`.`nama_coa` AS `nama_coa`,`laporan_keuangan`.`nama_kelompok_coa` AS `nama_kelompok_coa`,`laporan_keuangan`.`id_kategori` AS `id_kategori`,`laporan_keuangan`.`nama_kategori` AS `nama_kategori`,`laporan_keuangan`.`pos` AS `pos`,`laporan_keuangan`.`saldo_normal_special` AS `saldo_normal_special`,`laporan_keuangan`.`saldo_normal` AS `saldo_normal`,if(((`laporan_keuangan`.`saldo_normal` = 'kredit') or (`laporan_keuangan`.`saldo_normal_special` = 'k')),(`laporan_keuangan`.`saldo_awal` * -(1)),`laporan_keuangan`.`saldo_awal`) AS `saldo_awal`,`laporan_keuangan`.`status` AS `status`,`laporan_keuangan`.`id_nama_coa` AS `id_nama_coa`,`laporan_keuangan`.`id_nama_kelompok_coa` AS `id_nama_kelompok_coa` from `laporan_keuangan` where (`laporan_keuangan`.`pos` = 'neraca') */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `pekerja_atasan`
--

/*!50001 DROP VIEW IF EXISTS `pekerja_atasan`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `pekerja_atasan` AS select `a`.`id` AS `id`,`a`.`email` AS `email`,`a`.`username` AS `username`,`c`.`name` AS `nama_group` from ((`ion_auth_users` `a` left join `ion_auth_users_groups` `b` on((`a`.`id` = `b`.`user_id`))) left join `ion_auth_groups` `c` on((`b`.`group_id` = `c`.`id`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `trial_balance`
--

/*!50001 DROP VIEW IF EXISTS `trial_balance`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `trial_balance` AS select `buku_besar`.`id_nama_coa` AS `id_nama_coa`,`buku_besar`.`nama_coa` AS `nama_coa`,`buku_besar`.`nilai_voucher` AS `nilai_voucher`,(case when (`buku_besar`.`saldo_normal_special` = 'd') then `buku_besar`.`nilai_voucher` when (`buku_besar`.`saldo_normal_special` = 'k') then 0 else if((`buku_besar`.`saldo_normal` = 'debit'),`buku_besar`.`nilai_voucher`,0) end) AS `nilai_debit`,(case when (`buku_besar`.`saldo_normal_special` = 'd') then 0 when (`buku_besar`.`saldo_normal_special` = 'k') then `buku_besar`.`nilai_voucher` else if((`buku_besar`.`saldo_normal` = 'kredit'),`buku_besar`.`nilai_voucher`,0) end) AS `nilai_kredit`,`buku_besar`.`eod` AS `eod`,`buku_besar`.`eom` AS `eom`,`buku_besar`.`eoy` AS `eoy`,`buku_besar`.`saldo_normal_special` AS `saldo_normal_special`,`buku_besar`.`saldo_normal` AS `saldo_normal` from `buku_besar` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-04-07 21:29:33
