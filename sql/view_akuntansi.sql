-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versi server:                 10.1.21-MariaDB - mariadb.org binary distribution
-- OS Server:                    Win32
-- HeidiSQL Versi:               9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- membuang struktur untuk view apporder.akuntansi_buku_besar
-- Membuat tabel sementara untuk menangani kesalahan ketergantungan VIEW
CREATE TABLE `akuntansi_buku_besar` (
	`id_voucherjurnal` VARCHAR(13) NULL COLLATE 'latin1_swedish_ci',
	`id_nama_coa` VARCHAR(45) NULL COLLATE 'latin1_swedish_ci',
	`id_detail` INT(18) NOT NULL,
	`id_coa` VARCHAR(9) NOT NULL COLLATE 'latin1_swedish_ci',
	`debit` DECIMAL(10,0) NOT NULL,
	`kredit` DECIMAL(10,0) NOT NULL,
	`id_session` VARCHAR(25) NOT NULL COLLATE 'latin1_swedish_ci',
	`nilai_voucher` DECIMAL(11,0) NULL,
	`keterangan` VARCHAR(150) NOT NULL COLLATE 'latin1_swedish_ci',
	`uniqid_voucher` VARCHAR(25) NOT NULL COLLATE 'latin1_swedish_ci',
	`eod` DATE NULL,
	`eom` DATE NULL,
	`eoy` YEAR NULL,
	`status_print` TINYINT(3) NULL,
	`waktu` DATE NULL,
	`nama_coa` VARCHAR(35) NULL COLLATE 'latin1_swedish_ci',
	`saldo_normal_special` VARCHAR(1) NULL COLLATE 'latin1_swedish_ci',
	`saldo_awal` DECIMAL(10,0) NULL,
	`nama_kelompok_coa` CHAR(35) NULL COLLATE 'latin1_swedish_ci',
	`nama_kategori` VARCHAR(35) NULL COLLATE 'latin1_swedish_ci',
	`pos` SET('neraca','laba rugi','','') NULL COLLATE 'latin1_swedish_ci',
	`saldo_normal` ENUM('debit','kredit','','') NULL COLLATE 'latin1_swedish_ci',
	`status` TINYINT(1) NULL
) ENGINE=MyISAM;

-- membuang struktur untuk view apporder.akuntansi_daftar_coa_neraca
-- Membuat tabel sementara untuk menangani kesalahan ketergantungan VIEW
CREATE TABLE `akuntansi_daftar_coa_neraca` (
	`id_coa` VARCHAR(9) NOT NULL COLLATE 'latin1_swedish_ci',
	`nama_coa` VARCHAR(35) NOT NULL COLLATE 'latin1_swedish_ci',
	`nilai_voucher` DECIMAL(34,0) NULL
) ENGINE=MyISAM;

-- membuang struktur untuk view apporder.akuntansi_kumpulan_jurnal
-- Membuat tabel sementara untuk menangani kesalahan ketergantungan VIEW
CREATE TABLE `akuntansi_kumpulan_jurnal` (
	`uniqid_voucher` VARCHAR(25) NOT NULL COLLATE 'latin1_swedish_ci',
	`waktu` TIMESTAMP NOT NULL,
	`eod` DATE NULL,
	`id_detail` INT(18) NOT NULL,
	`id_coa` VARCHAR(9) NOT NULL COLLATE 'latin1_swedish_ci',
	`nama_coa` VARCHAR(35) NULL COLLATE 'latin1_swedish_ci',
	`debit` DECIMAL(10,0) NOT NULL,
	`kredit` DECIMAL(10,0) NOT NULL,
	`id_session` VARCHAR(25) NOT NULL COLLATE 'latin1_swedish_ci',
	`keterangan` VARCHAR(150) NOT NULL COLLATE 'latin1_swedish_ci',
	`status` TINYINT(1) NULL
) ENGINE=MyISAM;

-- membuang struktur untuk view apporder.akuntansi_laba_rugi
-- Membuat tabel sementara untuk menangani kesalahan ketergantungan VIEW
CREATE TABLE `akuntansi_laba_rugi` (
	`id_coa` VARCHAR(9) NOT NULL COLLATE 'latin1_swedish_ci',
	`saldo` DECIMAL(11,0) NOT NULL,
	`eod` DATE NULL,
	`eom` DATE NULL,
	`eoy` YEAR NULL,
	`nama_coa` VARCHAR(35) NOT NULL COLLATE 'latin1_swedish_ci',
	`nama_kelompok_coa` CHAR(35) NULL COLLATE 'latin1_swedish_ci',
	`id_kategori` VARCHAR(9) NULL COLLATE 'latin1_swedish_ci',
	`nama_kategori` VARCHAR(35) NULL COLLATE 'latin1_swedish_ci',
	`pos` SET('neraca','laba rugi','','') NULL COLLATE 'latin1_swedish_ci',
	`saldo_normal_special` VARCHAR(1) NOT NULL COLLATE 'latin1_swedish_ci',
	`saldo_normal` ENUM('debit','kredit','','') NULL COLLATE 'latin1_swedish_ci',
	`saldo_awal` DECIMAL(11,0) NULL,
	`status` TINYINT(1) NULL,
	`id_nama_coa` VARCHAR(45) NOT NULL COLLATE 'latin1_swedish_ci',
	`id_nama_kelompok_coa` VARCHAR(44) NULL COLLATE 'latin1_swedish_ci'
) ENGINE=MyISAM;

-- membuang struktur untuk view apporder.akuntansi_laporan_jurnal
-- Membuat tabel sementara untuk menangani kesalahan ketergantungan VIEW
CREATE TABLE `akuntansi_laporan_jurnal` (
	`uniqid_voucher` VARCHAR(25) NOT NULL COLLATE 'latin1_swedish_ci',
	`waktu` DATE NULL,
	`eod` DATE NULL,
	`id_detail` INT(18) NOT NULL,
	`id_coa` VARCHAR(9) NOT NULL COLLATE 'latin1_swedish_ci',
	`nama_coa` VARCHAR(35) NULL COLLATE 'latin1_swedish_ci',
	`inversid_coa` VARCHAR(9) NULL COLLATE 'latin1_swedish_ci',
	`inversnama_coa` VARCHAR(35) NULL COLLATE 'latin1_swedish_ci',
	`debit` DECIMAL(10,0) NOT NULL,
	`kredit` DECIMAL(10,0) NOT NULL,
	`invers_debit` DECIMAL(10,0) NULL,
	`invers_kredit` DECIMAL(10,0) NULL,
	`id_session` VARCHAR(25) NOT NULL COLLATE 'latin1_swedish_ci',
	`inversid_session` VARCHAR(25) NULL COLLATE 'latin1_swedish_ci',
	`keterangan` VARCHAR(150) NOT NULL COLLATE 'latin1_swedish_ci',
	`status` TINYINT(1) NULL
) ENGINE=MyISAM;

-- membuang struktur untuk view apporder.akuntansi_laporan_keuangan
-- Membuat tabel sementara untuk menangani kesalahan ketergantungan VIEW
CREATE TABLE `akuntansi_laporan_keuangan` (
	`id_coa` VARCHAR(9) NOT NULL COLLATE 'latin1_swedish_ci',
	`debit` DECIMAL(10,0) NOT NULL,
	`kredit` DECIMAL(10,0) NOT NULL,
	`nilai_voucher` DECIMAL(11,0) NULL,
	`eod` DATE NULL,
	`eom` DATE NULL,
	`eoy` YEAR NULL,
	`nama_coa` VARCHAR(35) NOT NULL COLLATE 'latin1_swedish_ci',
	`saldo_normal_special` VARCHAR(1) NOT NULL COLLATE 'latin1_swedish_ci',
	`nama_kelompok_coa` CHAR(35) NULL COLLATE 'latin1_swedish_ci',
	`id_kategori` VARCHAR(9) NULL COLLATE 'latin1_swedish_ci',
	`nama_kategori` VARCHAR(35) NULL COLLATE 'latin1_swedish_ci',
	`pos` SET('neraca','laba rugi','','') NULL COLLATE 'latin1_swedish_ci',
	`saldo_normal` ENUM('debit','kredit','','') NULL COLLATE 'latin1_swedish_ci',
	`saldo_awal` DECIMAL(10,0) NOT NULL,
	`status` TINYINT(1) NULL,
	`id_nama_coa` VARCHAR(45) NOT NULL COLLATE 'latin1_swedish_ci',
	`id_nama_kelompok_coa` VARCHAR(44) NULL COLLATE 'latin1_swedish_ci'
) ENGINE=MyISAM;

-- membuang struktur untuk view apporder.akuntansi_laporan_stock
-- Membuat tabel sementara untuk menangani kesalahan ketergantungan VIEW
CREATE TABLE `akuntansi_laporan_stock` (
	`waktu` TIMESTAMP NULL,
	`eod` DATE NULL,
	`status` TINYINT(1) NULL,
	`uniqid` VARCHAR(25) NOT NULL COLLATE 'latin1_swedish_ci',
	`uniqid_voucher` VARCHAR(25) NOT NULL COLLATE 'latin1_swedish_ci',
	`id_stock` SMALLINT(5) NOT NULL,
	`id_coa_stock` CHAR(7) NULL COLLATE 'latin1_swedish_ci',
	`nama_stock` VARCHAR(35) NULL COLLATE 'latin1_swedish_ci',
	`total_nilai_stock_awal` DECIMAL(10,0) NULL,
	`quantity_awal` DECIMAL(10,0) NULL,
	`jenis_pembayaran` VARCHAR(35) NULL COLLATE 'latin1_swedish_ci',
	`nama_vendor` VARCHAR(33) NULL COLLATE 'latin1_swedish_ci',
	`debit_stock` INT(7) NOT NULL,
	`kredit_stock` INT(7) NOT NULL,
	`v_stock` BIGINT(12) NOT NULL,
	`satuan` VARCHAR(12) NULL COLLATE 'latin1_swedish_ci',
	`saldo_quantity_akhir` INT(7) NOT NULL,
	`harga_beli` DECIMAL(15,0) NOT NULL,
	`nilai_potongan` DECIMAL(7,0) NOT NULL,
	`persen_potongan` SMALLINT(3) NOT NULL,
	`nilai_pajak` DECIMAL(15,0) NOT NULL,
	`persen_pajak` SMALLINT(3) NOT NULL,
	`total_nilai_stock` DECIMAL(16,0) NOT NULL,
	`keterangan` VARCHAR(35) NOT NULL COLLATE 'latin1_swedish_ci'
) ENGINE=MyISAM;

-- membuang struktur untuk view apporder.akuntansi_m_coa_pendapatan
-- Membuat tabel sementara untuk menangani kesalahan ketergantungan VIEW
CREATE TABLE `akuntansi_m_coa_pendapatan` (
	`uniqid` VARCHAR(25) NOT NULL COLLATE 'latin1_swedish_ci',
	`id_coa` VARCHAR(9) NOT NULL COLLATE 'latin1_swedish_ci',
	`id_kelompok_coa` CHAR(8) NOT NULL COLLATE 'latin1_swedish_ci',
	`id_kategori` VARCHAR(11) NOT NULL COLLATE 'latin1_swedish_ci',
	`nama_coa` VARCHAR(35) NOT NULL COLLATE 'latin1_swedish_ci',
	`uniqid_sub` VARCHAR(25) NOT NULL COLLATE 'latin1_swedish_ci',
	`saldo_awal` DECIMAL(10,0) NOT NULL,
	`saldo_normal_special` VARCHAR(1) NOT NULL COLLATE 'latin1_swedish_ci',
	`quantity` DECIMAL(10,0) NOT NULL
) ENGINE=MyISAM;

-- membuang struktur untuk view apporder.akuntansi_neraca
-- Membuat tabel sementara untuk menangani kesalahan ketergantungan VIEW
CREATE TABLE `akuntansi_neraca` (
	`id_coa` VARCHAR(9) NOT NULL COLLATE 'latin1_swedish_ci',
	`saldo` DECIMAL(11,0) NOT NULL,
	`eod` DATE NULL,
	`eom` DATE NULL,
	`eoy` YEAR NULL,
	`nama_coa` VARCHAR(35) NOT NULL COLLATE 'latin1_swedish_ci',
	`nama_kelompok_coa` CHAR(35) NULL COLLATE 'latin1_swedish_ci',
	`id_kategori` VARCHAR(9) NULL COLLATE 'latin1_swedish_ci',
	`nama_kategori` VARCHAR(35) NULL COLLATE 'latin1_swedish_ci',
	`pos` SET('neraca','laba rugi','','') NULL COLLATE 'latin1_swedish_ci',
	`saldo_normal_special` VARCHAR(1) NOT NULL COLLATE 'latin1_swedish_ci',
	`saldo_normal` ENUM('debit','kredit','','') NULL COLLATE 'latin1_swedish_ci',
	`saldo_awal` DECIMAL(11,0) NULL,
	`status` TINYINT(1) NULL,
	`id_nama_coa` VARCHAR(45) NOT NULL COLLATE 'latin1_swedish_ci',
	`id_nama_kelompok_coa` VARCHAR(44) NULL COLLATE 'latin1_swedish_ci'
) ENGINE=MyISAM;

-- membuang struktur untuk view apporder.akuntansi_trial_balance
-- Membuat tabel sementara untuk menangani kesalahan ketergantungan VIEW
CREATE TABLE `akuntansi_trial_balance` (
	`id_nama_coa` VARCHAR(45) NULL COLLATE 'latin1_swedish_ci',
	`nama_coa` VARCHAR(35) NULL COLLATE 'latin1_swedish_ci',
	`nilai_voucher` DECIMAL(11,0) NULL,
	`nilai_debit` DECIMAL(11,0) NULL,
	`nilai_kredit` DECIMAL(11,0) NULL,
	`eod` DATE NULL,
	`eom` DATE NULL,
	`eoy` YEAR NULL,
	`saldo_normal_special` VARCHAR(1) NULL COLLATE 'latin1_swedish_ci',
	`saldo_normal` ENUM('debit','kredit','','') NULL COLLATE 'latin1_swedish_ci'
) ENGINE=MyISAM;

-- membuang struktur untuk view apporder.akuntansi_voucher_jurnal
-- Membuat tabel sementara untuk menangani kesalahan ketergantungan VIEW
CREATE TABLE `akuntansi_voucher_jurnal` (
	`id_voucher` INT(8) NOT NULL,
	`uniqid` VARCHAR(25) NOT NULL COLLATE 'latin1_swedish_ci',
	`uniqid_detail` VARCHAR(25) NULL COLLATE 'latin1_swedish_ci',
	`id_voucherjurnal` VARCHAR(13) NULL COLLATE 'latin1_swedish_ci',
	`waktu` TIMESTAMP NOT NULL,
	`id_tipe_voucher` CHAR(5) NOT NULL COLLATE 'latin1_swedish_ci',
	`id_detail` INT(18) NULL,
	`id_session` VARCHAR(25) NULL COLLATE 'latin1_swedish_ci',
	`price` DECIMAL(11,0) NULL,
	`keterangan` VARCHAR(150) NULL COLLATE 'latin1_swedish_ci'
) ENGINE=MyISAM;

-- membuang struktur untuk view apporder.akuntansi_voucher_stock
-- Membuat tabel sementara untuk menangani kesalahan ketergantungan VIEW
CREATE TABLE `akuntansi_voucher_stock` (
	`waktu` TIMESTAMP NULL,
	`eod` DATE NULL,
	`status` TINYINT(1) NULL,
	`uniqid` VARCHAR(25) NULL COLLATE 'latin1_swedish_ci',
	`uniqid_voucher` VARCHAR(25) NULL COLLATE 'latin1_swedish_ci',
	`id_stock` SMALLINT(5) NULL,
	`id_coa_stock` CHAR(7) NULL COLLATE 'latin1_swedish_ci',
	`nama_stock` VARCHAR(35) NULL COLLATE 'latin1_swedish_ci',
	`total_nilai_stock_awal` DECIMAL(10,0) NULL,
	`quantity_awal` DECIMAL(10,0) NULL,
	`jenis_pembayaran` VARCHAR(35) NULL COLLATE 'latin1_swedish_ci',
	`nama_vendor` VARCHAR(33) NULL COLLATE 'latin1_swedish_ci',
	`debit_stock` INT(7) NULL,
	`kredit_stock` INT(7) NULL,
	`v_stock` BIGINT(12) NULL,
	`satuan` VARCHAR(12) NULL COLLATE 'latin1_swedish_ci',
	`saldo_quantity_akhir` INT(7) NULL,
	`harga_beli` DECIMAL(15,0) NULL,
	`nilai_potongan` DECIMAL(7,0) NULL,
	`persen_potongan` SMALLINT(3) NULL,
	`nilai_pajak` DECIMAL(15,0) NULL,
	`persen_pajak` SMALLINT(3) NULL,
	`total_nilai_stock` DECIMAL(16,0) NULL,
	`keterangan` VARCHAR(35) NULL COLLATE 'latin1_swedish_ci',
	`id_voucherjurnal` VARCHAR(13) NULL COLLATE 'latin1_swedish_ci',
	`id_tipe_voucher` CHAR(5) NOT NULL COLLATE 'latin1_swedish_ci'
) ENGINE=MyISAM;

-- membuang struktur untuk view apporder.akuntansi_buku_besar
-- Menghapus tabel sementara dan menciptakan struktur VIEW terakhir
DROP TABLE IF EXISTS `akuntansi_buku_besar`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `akuntansi_buku_besar` AS SELECT 
        concat(	d.id_tipe_voucher,
				DATE_FORMAT(d.waktu,"%y%m"),
                right(concat(d.prefix_number,d.id_voucher),4))
                as id_voucherjurnal,
        
        CONCAT(`x`.`id_coa`, ' ', `a`.`nama_coa`) AS `id_nama_coa`,
        `x`.`id_detail` AS `id_detail`,
        `x`.`id_coa` AS `id_coa`,
        `x`.`debit` AS `debit`,
        `x`.`kredit` AS `kredit`,
        `x`.`id_session` AS `id_session`,
        (CASE
            WHEN (`a`.`saldo_normal_special` = 'd') THEN (`x`.`debit` - `x`.`kredit`)
            WHEN (`a`.`saldo_normal_special` = 'k') THEN (`x`.`kredit` - `x`.`debit`)
            ELSE IF((`c`.`saldo_normal` = 'debit'),
                (`x`.`debit` - `x`.`kredit`),
                (`x`.`kredit` - `x`.`debit`))
        END) AS `nilai_voucher`,
        `x`.`keterangan` AS `keterangan`,
        `x`.`uniqid_voucher` AS `uniqid_voucher`,
        `d`.`eod` AS `eod`,
        `d`.`eom` AS `eom`,
        `d`.`eoy` AS `eoy`,
        `d`.`status_print` AS `status_print`,
        `d`.`eod` AS `waktu`,
        `a`.`nama_coa` AS `nama_coa`,
        `a`.`saldo_normal_special` AS `saldo_normal_special`,
        `a`.`saldo_awal` AS `saldo_awal`,
        `b`.`nama_kelompok_coa` AS `nama_kelompok_coa`,
        `c`.`nama_kategori` AS `nama_kategori`,
        `c`.`pos` AS `pos`,
        `c`.`saldo_normal` AS `saldo_normal`,
        `d`.`status` AS `status`
    FROM
        ((((`akuntansi_detail_voucher` `x`
        LEFT JOIN `akuntansi_m_coa` `a` ON ((`x`.`id_coa` = `a`.`id_coa`)))
        LEFT JOIN `akuntansi_m_kelompok_coa` `b` ON ((`a`.`id_kelompok_coa` = `b`.`uniqid`)))
        LEFT JOIN `akuntansi_m_kategori` `c` ON ((`b`.`id_kategori` = `c`.`uniqid`)))
        LEFT JOIN `akuntansi_h_voucher` `d` ON ((`x`.`uniqid_voucher` = `d`.`uniqid`)))
    WHERE
        (`d`.`status` = 1) ;

-- membuang struktur untuk view apporder.akuntansi_daftar_coa_neraca
-- Menghapus tabel sementara dan menciptakan struktur VIEW terakhir
DROP TABLE IF EXISTS `akuntansi_daftar_coa_neraca`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `akuntansi_daftar_coa_neraca` AS SELECT 
        `id_coa` AS `id_coa`,
        `nama_coa` AS `nama_coa`,
        (`saldo_awal` + SUM(`nilai_voucher`)) AS `nilai_voucher`
    FROM
        `akuntansi_laporan_keuangan`
    WHERE
        (`pos` = 'neraca')
    GROUP BY `id_nama_coa`
    ORDER BY `id_nama_coa` ;

-- membuang struktur untuk view apporder.akuntansi_kumpulan_jurnal
-- Menghapus tabel sementara dan menciptakan struktur VIEW terakhir
DROP TABLE IF EXISTS `akuntansi_kumpulan_jurnal`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `akuntansi_kumpulan_jurnal` AS SELECT 
        `a`.`uniqid_voucher` AS `uniqid_voucher`,
        `a`.`waktu` AS `waktu`,
        `b`.`eod` AS `eod`,
        `a`.`id_detail` AS `id_detail`,
        `a`.`id_coa` AS `id_coa`,
        `c`.`nama_coa` AS `nama_coa`,
        `a`.`debit` AS `debit`,
        `a`.`kredit` AS `kredit`,
        `a`.`id_session` AS `id_session`,
        `a`.`keterangan` AS `keterangan`,
        `b`.`status` AS `status`
    FROM
        ((`akuntansi_detail_voucher` `a`
        LEFT JOIN `akuntansi_h_voucher` `b` ON ((`a`.`uniqid_voucher` = `b`.`uniqid`)))
        LEFT JOIN `akuntansi_m_coa` `c` ON ((`a`.`id_coa` = `c`.`id_coa`))) ;

-- membuang struktur untuk view apporder.akuntansi_laba_rugi
-- Menghapus tabel sementara dan menciptakan struktur VIEW terakhir
DROP TABLE IF EXISTS `akuntansi_laba_rugi`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `akuntansi_laba_rugi` AS SELECT 
        `id_coa` AS `id_coa`,
        (`kredit` - `debit`) AS `saldo`,
        `eod` AS `eod`,
        `eom` AS `eom`,
        `eoy` AS `eoy`,
        `nama_coa` AS `nama_coa`,
        `nama_kelompok_coa` AS `nama_kelompok_coa`,
        `id_kategori` AS `id_kategori`,
        `nama_kategori` AS `nama_kategori`,
        `pos` AS `pos`,
        `saldo_normal_special` AS `saldo_normal_special`,
        `saldo_normal` AS `saldo_normal`,
        IF(((`saldo_normal` = 'debit')
                OR (`saldo_normal_special` = 'd')),
            (`saldo_awal` * -(1)),
            `saldo_awal`) AS `saldo_awal`,
        `status` AS `status`,
        `id_nama_coa` AS `id_nama_coa`,
        `id_nama_kelompok_coa` AS `id_nama_kelompok_coa`
    FROM
        `akuntansi_laporan_keuangan`
    WHERE
        (`pos` = 'laba rugi') ;

-- membuang struktur untuk view apporder.akuntansi_laporan_jurnal
-- Menghapus tabel sementara dan menciptakan struktur VIEW terakhir
DROP TABLE IF EXISTS `akuntansi_laporan_jurnal`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `akuntansi_laporan_jurnal` AS SELECT 
        `a`.`uniqid_voucher` AS `uniqid_voucher`,
        `a`.`eod` AS `waktu`,
        `a`.`eod` AS `eod`,
        `a`.`id_detail` AS `id_detail`,
        `a`.`id_coa` AS `id_coa`,
        `a`.`nama_coa` AS `nama_coa`,
        `b`.`id_coa` AS `inversid_coa`,
        `b`.`nama_coa` AS `inversnama_coa`,
        `a`.`debit` AS `debit`,
        `a`.`kredit` AS `kredit`,
        `b`.`debit` AS `invers_debit`,
        `b`.`kredit` AS `invers_kredit`,
        `a`.`id_session` AS `id_session`,
        `b`.`id_session` AS `inversid_session`,
        `a`.`keterangan` AS `keterangan`,
        `a`.`status` AS `status`
    FROM
        (`akuntansi_kumpulan_jurnal` `a`
        LEFT JOIN `akuntansi_kumpulan_jurnal` `b` ON ((`a`.`id_session` = `b`.`id_session`)))
    WHERE
        ((`a`.`id_detail` <> `b`.`id_detail`)
            AND (`a`.`kredit` = 0)
            AND (`a`.`status` = 1)) ;

-- membuang struktur untuk view apporder.akuntansi_laporan_keuangan
-- Menghapus tabel sementara dan menciptakan struktur VIEW terakhir
DROP TABLE IF EXISTS `akuntansi_laporan_keuangan`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `akuntansi_laporan_keuangan` AS SELECT 
		`x`.`id_coa` AS `id_coa`,
        IFNULL(`a`.`debit`, 0) AS `debit`,
        IFNULL(`a`.`kredit`, 0) AS `kredit`,
        `a`.`nilai_voucher` AS `nilai_voucher`,
        `a`.`eod` AS `eod`,
        `a`.`eom` AS `eom`,
        `a`.`eoy` AS `eoy`,
        `x`.`nama_coa` AS `nama_coa`,
        `x`.`saldo_normal_special` AS `saldo_normal_special`,
        `b`.`nama_kelompok_coa` AS `nama_kelompok_coa`,
        `c`.`id_kategori` AS `id_kategori`,
        `c`.`nama_kategori` AS `nama_kategori`,
        `c`.`pos` AS `pos`,
        `c`.`saldo_normal` AS `saldo_normal`,
        `x`.`saldo_awal` AS `saldo_awal`,
        `a`.`status` AS `status`,
        CONCAT(`x`.`id_coa`, ' ', `x`.`nama_coa`) AS `id_nama_coa`,
        CONCAT(`b`.`id_kelompok_coa`,
                ' ',
                `b`.`nama_kelompok_coa`) AS `id_nama_kelompok_coa`
    FROM
        (((`akuntansi_m_coa` `x`
        LEFT JOIN `akuntansi_buku_besar` `a` ON ((`x`.`id_coa` = `a`.`id_coa`)))
        LEFT JOIN `akuntansi_m_kelompok_coa` `b` ON ((`x`.`id_kelompok_coa` = `b`.`uniqid`)))
        LEFT JOIN `akuntansi_m_kategori` `c` ON ((`b`.`id_kategori` = `c`.`uniqid`))) ;

-- membuang struktur untuk view apporder.akuntansi_laporan_stock
-- Menghapus tabel sementara dan menciptakan struktur VIEW terakhir
DROP TABLE IF EXISTS `akuntansi_laporan_stock`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `akuntansi_laporan_stock` AS SELECT 
        `c`.`waktu` AS `waktu`,
        `c`.`eod` AS `eod`,
        `c`.`status` AS `status`,
        `a`.`uniqid` AS `uniqid`,
        `a`.`uniqid_voucher` AS `uniqid_voucher`,
        `a`.`id_stock` AS `id_stock`,
        `a`.`id_coa_stock` AS `id_coa_stock`,
        `f`.`nama_coa` AS `nama_stock`,
        `f`.`saldo_awal` AS `total_nilai_stock_awal`,
        `f`.`quantity` AS `quantity_awal`,
        `g`.`nama_coa` AS `jenis_pembayaran`,
        `d`.`name` AS `nama_vendor`,
        `a`.`debit_stock` AS `debit_stock`,
        `a`.`kredit_stock` AS `kredit_stock`,
        (`a`.`debit_stock` - `a`.`kredit_stock`) AS `v_stock`,
        `e`.`nama_satuan` AS `satuan`,
        `a`.`saldo_quantity_akhir` AS `saldo_quantity_akhir`,
        `a`.`harga_beli` AS `harga_beli`,
        `a`.`nilai_potongan` AS `nilai_potongan`,
        `a`.`persen_potongan` AS `persen_potongan`,
        `a`.`nilai_pajak` AS `nilai_pajak`,
        `a`.`persen_pajak` AS `persen_pajak`,
        IF((`a`.`debit_stock` > 0),
            `a`.`total_nilai_stock`,
            (`a`.`total_nilai_stock` * -(1))) AS `total_nilai_stock`,
        `a`.`keterangan` AS `keterangan`
    FROM
        (((((`akuntansi_detail_stock` `a`
        LEFT JOIN `akuntansi_h_voucher` `c` ON ((`c`.`uniqid` = `a`.`uniqid_voucher`)))
        LEFT JOIN `akuntansi_m_vendor` `d` ON ((`a`.`id_vendor` = `d`.`id_vendor`)))
        LEFT JOIN `akuntansi_m_satuan` `e` ON ((`a`.`satuan` = `e`.`id_satuan`)))
        LEFT JOIN `akuntansi_m_coa` `f` ON ((`a`.`id_coa_stock` = `f`.`id_coa`)))
        LEFT JOIN `akuntansi_m_coa` `g` ON ((`a`.`id_jenis_pembayaran` = `g`.`id_coa`)))
    WHERE
        (`c`.`status` = 1) ;

-- membuang struktur untuk view apporder.akuntansi_m_coa_pendapatan
-- Menghapus tabel sementara dan menciptakan struktur VIEW terakhir
DROP TABLE IF EXISTS `akuntansi_m_coa_pendapatan`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `akuntansi_m_coa_pendapatan` AS SELECT 
        `a`.`uniqid` AS `uniqid`,
        `a`.`id_coa` AS `id_coa`,
        `a`.`id_kelompok_coa` AS `id_kelompok_coa`,
        `a`.`id_kategori` AS `id_kategori`,
        `a`.`nama_coa` AS `nama_coa`,
        `a`.`uniqid_sub` AS `uniqid_sub`,
        `a`.`saldo_awal` AS `saldo_awal`,
        `a`.`saldo_normal_special` AS `saldo_normal_special`,
        `a`.`quantity` AS `quantity`
    FROM
        (`akuntansi_m_coa` `a`
        JOIN `akuntansi_m_kelompok_coa` `b` ON ((`a`.`id_kelompok_coa` = `b`.`uniqid`)))
    WHERE
        ((`b`.`id_kelompok_coa` = 4010000)
            OR (`b`.`id_kelompok_coa` = 4011000)) ;

-- membuang struktur untuk view apporder.akuntansi_neraca
-- Menghapus tabel sementara dan menciptakan struktur VIEW terakhir
DROP TABLE IF EXISTS `akuntansi_neraca`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `akuntansi_neraca` AS SELECT 
        `id_coa` AS `id_coa`,
        (`debit` - `kredit`) AS `saldo`,
        `eod` AS `eod`,
        `eom` AS `eom`,
        `eoy` AS `eoy`,
        `nama_coa` AS `nama_coa`,
        `nama_kelompok_coa` AS `nama_kelompok_coa`,
        `id_kategori` AS `id_kategori`,
        `nama_kategori` AS `nama_kategori`,
        `pos` AS `pos`,
        `saldo_normal_special` AS `saldo_normal_special`,
        `saldo_normal` AS `saldo_normal`,
        IF(((`saldo_normal` = 'kredit')
                OR (`saldo_normal_special` = 'k')),
            (`saldo_awal` * -(1)),
            `saldo_awal`) AS `saldo_awal`,
        `status` AS `status`,
        `id_nama_coa` AS `id_nama_coa`,
        `id_nama_kelompok_coa` AS `id_nama_kelompok_coa`
    FROM
        `akuntansi_laporan_keuangan`
    WHERE
        (`pos` = 'neraca') ;

-- membuang struktur untuk view apporder.akuntansi_trial_balance
-- Menghapus tabel sementara dan menciptakan struktur VIEW terakhir
DROP TABLE IF EXISTS `akuntansi_trial_balance`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `akuntansi_trial_balance` AS SELECT 
        `id_nama_coa` AS `id_nama_coa`,
        `nama_coa` AS `nama_coa`,
        `nilai_voucher` AS `nilai_voucher`,
        (CASE
            WHEN (`saldo_normal_special` = 'd') THEN `nilai_voucher`
            WHEN (`saldo_normal_special` = 'k') THEN 0
            ELSE IF((`saldo_normal` = 'debit'),
                `nilai_voucher`,
                0)
        END) AS `nilai_debit`,
        (CASE
            WHEN (`saldo_normal_special` = 'd') THEN 0
            WHEN (`saldo_normal_special` = 'k') THEN `nilai_voucher`
            ELSE IF((`saldo_normal` = 'kredit'),
                `nilai_voucher`,
                0)
        END) AS `nilai_kredit`,
        `eod` AS `eod`,
        `eom` AS `eom`,
        `eoy` AS `eoy`,
        `saldo_normal_special` AS `saldo_normal_special`,
        `saldo_normal` AS `saldo_normal`
    FROM
        `akuntansi_buku_besar` ;

-- membuang struktur untuk view apporder.akuntansi_voucher_jurnal
-- Menghapus tabel sementara dan menciptakan struktur VIEW terakhir
DROP TABLE IF EXISTS `akuntansi_voucher_jurnal`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `akuntansi_voucher_jurnal` AS SELECT 
        `a`.`id_voucher` AS `id_voucher`,
        `a`.`uniqid` AS `uniqid`,
        `b`.`uniqid` AS `uniqid_detail`,
        CONCAT(`a`.`id_tipe_voucher`,
                CONVERT( DATE_FORMAT(`a`.`waktu`, '%y%m') USING LATIN1),
                CONVERT( RIGHT(CONCAT(`a`.`prefix_number`, `a`.`id_voucher`),
                    4) USING LATIN1)) AS `id_voucherjurnal`,
        `a`.`waktu` AS `waktu`,
        `a`.`id_tipe_voucher` AS `id_tipe_voucher`,
        `b`.`id_detail` AS `id_detail`,
        `b`.`id_session` AS `id_session`,
        (`b`.`debit` - `b`.`kredit`) AS `price`,
        `b`.`keterangan` AS `keterangan`
    FROM
        (`akuntansi_h_voucher` `a`
        LEFT JOIN `akuntansi_detail_voucher` `b` ON ((`a`.`uniqid` = `b`.`uniqid_voucher`))) ;

-- membuang struktur untuk view apporder.akuntansi_voucher_stock
-- Menghapus tabel sementara dan menciptakan struktur VIEW terakhir
DROP TABLE IF EXISTS `akuntansi_voucher_stock`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `akuntansi_voucher_stock` AS SELECT 
        `b`.`waktu` AS `waktu`,
        `b`.`eod` AS `eod`,
        `b`.`status` AS `status`,
        `b`.`uniqid` AS `uniqid`,
        `b`.`uniqid_voucher` AS `uniqid_voucher`,
        `b`.`id_stock` AS `id_stock`,
        `b`.`id_coa_stock` AS `id_coa_stock`,
        `b`.`nama_stock` AS `nama_stock`,
        `b`.`total_nilai_stock_awal` AS `total_nilai_stock_awal`,
        `b`.`quantity_awal` AS `quantity_awal`,
        `b`.`jenis_pembayaran` AS `jenis_pembayaran`,
        `b`.`nama_vendor` AS `nama_vendor`,
        `b`.`debit_stock` AS `debit_stock`,
        `b`.`kredit_stock` AS `kredit_stock`,
        `b`.`v_stock` AS `v_stock`,
        `b`.`satuan` AS `satuan`,
        `b`.`saldo_quantity_akhir` AS `saldo_quantity_akhir`,
        `b`.`harga_beli` AS `harga_beli`,
        `b`.`nilai_potongan` AS `nilai_potongan`,
        `b`.`persen_potongan` AS `persen_potongan`,
        `b`.`nilai_pajak` AS `nilai_pajak`,
        `b`.`persen_pajak` AS `persen_pajak`,
        `b`.`total_nilai_stock` AS `total_nilai_stock`,
        `b`.`keterangan` AS `keterangan`,
        CONCAT(`a`.`id_tipe_voucher`,
                CONVERT( DATE_FORMAT(`a`.`waktu`, '%y%m') USING LATIN1),
                CONVERT( RIGHT(CONCAT(`a`.`prefix_number`, `a`.`id_voucher`),
                    4) USING LATIN1)) AS `id_voucherjurnal`,
        `a`.`id_tipe_voucher` AS `id_tipe_voucher`
    FROM
        (`akuntansi_h_voucher` `a`
        LEFT JOIN `akuntansi_laporan_stock` `b` ON ((`a`.`uniqid` = `b`.`uniqid_voucher`))) ;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
