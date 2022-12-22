-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.22-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for db_pelatihan_digital_marketing
DROP DATABASE IF EXISTS `db_pelatihan_digital_marketing`;
CREATE DATABASE IF NOT EXISTS `db_pelatihan_digital_marketing` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `db_pelatihan_digital_marketing`;

-- Dumping structure for table db_pelatihan_digital_marketing.tb_alumni
DROP TABLE IF EXISTS `tb_alumni`;
CREATE TABLE IF NOT EXISTS `tb_alumni` (
  `id_alumni` int(11) NOT NULL AUTO_INCREMENT,
  `nama_alumni` varchar(255) NOT NULL,
  `tanggal_mulai_pelatihan` varchar(255) NOT NULL,
  `tanggal_selesai_pelatihan` varchar(255) NOT NULL,
  PRIMARY KEY (`id_alumni`),
  KEY `nama_lengkap` (`nama_alumni`),
  CONSTRAINT `tb_alumni_ibfk_1` FOREIGN KEY (`nama_alumni`) REFERENCES `tb_peserta` (`nama_peserta`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table db_pelatihan_digital_marketing.tb_alumni: ~1 rows (approximately)
/*!40000 ALTER TABLE `tb_alumni` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_alumni` ENABLE KEYS */;

-- Dumping structure for table db_pelatihan_digital_marketing.tb_jeniskelamin
DROP TABLE IF EXISTS `tb_jeniskelamin`;
CREATE TABLE IF NOT EXISTS `tb_jeniskelamin` (
  `id_jeniskelamin` int(11) NOT NULL AUTO_INCREMENT,
  `jenis_kelamin` varchar(255) NOT NULL,
  PRIMARY KEY (`id_jeniskelamin`),
  KEY `jenis_kelamin` (`jenis_kelamin`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table db_pelatihan_digital_marketing.tb_jeniskelamin: ~2 rows (approximately)
/*!40000 ALTER TABLE `tb_jeniskelamin` DISABLE KEYS */;
REPLACE INTO `tb_jeniskelamin` (`id_jeniskelamin`, `jenis_kelamin`) VALUES
	(1, 'Laki-laki'),
	(2, 'Perempuan');
/*!40000 ALTER TABLE `tb_jeniskelamin` ENABLE KEYS */;

-- Dumping structure for table db_pelatihan_digital_marketing.tb_kelas
DROP TABLE IF EXISTS `tb_kelas`;
CREATE TABLE IF NOT EXISTS `tb_kelas` (
  `id_kelas` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kelas` varchar(25) NOT NULL,
  `nama_pengajar` varchar(255) NOT NULL,
  `jumlah_peserta` int(2) NOT NULL,
  `tanggal_waktu_pelaksanaan` varchar(255) NOT NULL,
  `tempat_pelaksanaan` varchar(255) NOT NULL,
  PRIMARY KEY (`id_kelas`),
  KEY `nama_pengajar` (`nama_pengajar`),
  KEY `nama_kelas` (`nama_kelas`),
  CONSTRAINT `tb_kelas_ibfk_1` FOREIGN KEY (`nama_pengajar`) REFERENCES `tb_pengajar` (`nama_pengajar`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table db_pelatihan_digital_marketing.tb_kelas: ~2 rows (approximately)
/*!40000 ALTER TABLE `tb_kelas` DISABLE KEYS */;
REPLACE INTO `tb_kelas` (`id_kelas`, `nama_kelas`, `nama_pengajar`, `jumlah_peserta`, `tanggal_waktu_pelaksanaan`, `tempat_pelaksanaan`) VALUES
	(3, '1', 'Muhammad Farid Fuady Rahman', 30, '13 s/d 15 Desember 2021, Pukul 13.00 s/d 17.00', 'Kantor Gedung Putih'),
	(4, '2', 'Rayleigh', 18, '13 s/d 15 Desember 2021, Pukul 13.00 s/d 17.00', 'Kantor Gedung Putih');
/*!40000 ALTER TABLE `tb_kelas` ENABLE KEYS */;

-- Dumping structure for table db_pelatihan_digital_marketing.tb_level_pengguna
DROP TABLE IF EXISTS `tb_level_pengguna`;
CREATE TABLE IF NOT EXISTS `tb_level_pengguna` (
  `id_level` int(11) NOT NULL AUTO_INCREMENT,
  `level` varchar(255) NOT NULL,
  PRIMARY KEY (`id_level`),
  KEY `level` (`level`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table db_pelatihan_digital_marketing.tb_level_pengguna: ~2 rows (approximately)
/*!40000 ALTER TABLE `tb_level_pengguna` DISABLE KEYS */;
REPLACE INTO `tb_level_pengguna` (`id_level`, `level`) VALUES
	(3, 'Karyawan'),
	(1, 'Pimpinan');
/*!40000 ALTER TABLE `tb_level_pengguna` ENABLE KEYS */;

-- Dumping structure for table db_pelatihan_digital_marketing.tb_pendaftar
DROP TABLE IF EXISTS `tb_pendaftar`;
CREATE TABLE IF NOT EXISTS `tb_pendaftar` (
  `id_pendaftar` int(11) NOT NULL AUTO_INCREMENT,
  `nama_pendaftar` varchar(255) NOT NULL,
  `tempat_tanggal_lahir` varchar(255) NOT NULL,
  `jenis_kelamin` varchar(255) NOT NULL,
  `alamat_lengkap` varchar(255) NOT NULL,
  `bidang_usaha` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  PRIMARY KEY (`id_pendaftar`),
  UNIQUE KEY `nama_lengkap` (`nama_pendaftar`),
  KEY `nama_lengkap_2` (`nama_pendaftar`),
  KEY `jenis_kelamin` (`jenis_kelamin`),
  CONSTRAINT `tb_pendaftar_ibfk_1` FOREIGN KEY (`jenis_kelamin`) REFERENCES `tb_jeniskelamin` (`jenis_kelamin`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table db_pelatihan_digital_marketing.tb_pendaftar: ~2 rows (approximately)
/*!40000 ALTER TABLE `tb_pendaftar` DISABLE KEYS */;
REPLACE INTO `tb_pendaftar` (`id_pendaftar`, `nama_pendaftar`, `tempat_tanggal_lahir`, `jenis_kelamin`, `alamat_lengkap`, `bidang_usaha`, `email`, `no_telp`) VALUES
	(26, 'Muhammad Farid Fuady Rahman', 'Banjarmasin, 15 Agustus 2000', 'Laki-laki', 'Jl Trans Kalimantan', 'Mahasiswa', 'hadisnt15@gmail.com', '082158792743'),
	(27, 'Zori Roronoa', 'Shimotsuki, 15 Agustus 2000', 'Laki-laki', 'Jl Kayu Tangi', 'Jual Pedang Tanjiro', 'zori@gmail.com', '089531488561');
/*!40000 ALTER TABLE `tb_pendaftar` ENABLE KEYS */;

-- Dumping structure for table db_pelatihan_digital_marketing.tb_pengajar
DROP TABLE IF EXISTS `tb_pengajar`;
CREATE TABLE IF NOT EXISTS `tb_pengajar` (
  `id_pengajar` int(11) NOT NULL AUTO_INCREMENT,
  `nama_pengajar` varchar(255) NOT NULL,
  `tempat_tanggal_lahir` varchar(255) NOT NULL,
  `jenis_kelamin` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  PRIMARY KEY (`id_pengajar`),
  KEY `jenis_kelamin` (`jenis_kelamin`),
  KEY `nama_pengajar` (`nama_pengajar`),
  CONSTRAINT `tb_pengajar_ibfk_1` FOREIGN KEY (`jenis_kelamin`) REFERENCES `tb_jeniskelamin` (`jenis_kelamin`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table db_pelatihan_digital_marketing.tb_pengajar: ~3 rows (approximately)
/*!40000 ALTER TABLE `tb_pengajar` DISABLE KEYS */;
REPLACE INTO `tb_pengajar` (`id_pengajar`, `nama_pengajar`, `tempat_tanggal_lahir`, `jenis_kelamin`, `email`, `no_telp`) VALUES
	(1, 'Muhammad Farid Fuady Rahman', 'Banjarmasin, 15 Agustus 2000', 'Laki-laki', 'hadisnt15@gmail.com', '0895314885671'),
	(5, 'Rayleigh', 'West blue, 15 Agustus 2000', 'Laki-laki', 'lufi@gmail.com', '1212'),
	(8, 'Reza Fikri', 'Banjarmasin, 20 Agustus 2021', 'Laki-laki', 'reza@gmail.com', '089531488567');
/*!40000 ALTER TABLE `tb_pengajar` ENABLE KEYS */;

-- Dumping structure for table db_pelatihan_digital_marketing.tb_pengguna
DROP TABLE IF EXISTS `tb_pengguna`;
CREATE TABLE IF NOT EXISTS `tb_pengguna` (
  `id_pengguna` int(11) NOT NULL AUTO_INCREMENT,
  `nama_lengkap` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` varchar(255) NOT NULL,
  PRIMARY KEY (`id_pengguna`),
  KEY `level` (`level`),
  CONSTRAINT `tb_pengguna_ibfk_1` FOREIGN KEY (`level`) REFERENCES `tb_level_pengguna` (`level`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table db_pelatihan_digital_marketing.tb_pengguna: ~2 rows (approximately)
/*!40000 ALTER TABLE `tb_pengguna` DISABLE KEYS */;
REPLACE INTO `tb_pengguna` (`id_pengguna`, `nama_lengkap`, `email`, `password`, `level`) VALUES
	(22, 'farid fuady', 'faridfuady11@gmail.com', '$2y$10$0YMvN8b2RaHWm/zmUMyP/O0fSu9BoPbN9vZUHlIHaJbs0u1Df.vi.', 'Pimpinan'),
	(23, 'Rahman', 'rahman11@gmail.com', '$2y$10$rV6z.TS7ujE.XWxn9ZR/Pu67Nw.M/weaPyfdlrlAKEOP9UV6r6S8.', 'Karyawan');
/*!40000 ALTER TABLE `tb_pengguna` ENABLE KEYS */;

-- Dumping structure for table db_pelatihan_digital_marketing.tb_peserta
DROP TABLE IF EXISTS `tb_peserta`;
CREATE TABLE IF NOT EXISTS `tb_peserta` (
  `id_peserta` int(11) NOT NULL AUTO_INCREMENT,
  `nama_peserta` varchar(255) NOT NULL,
  `nama_kelas` varchar(255) NOT NULL,
  PRIMARY KEY (`id_peserta`),
  KEY `nama_lengkap` (`nama_peserta`),
  KEY `nama_kelas` (`nama_kelas`),
  CONSTRAINT `tb_peserta_ibfk_1` FOREIGN KEY (`nama_peserta`) REFERENCES `tb_pendaftar` (`nama_pendaftar`),
  CONSTRAINT `tb_peserta_ibfk_2` FOREIGN KEY (`nama_kelas`) REFERENCES `tb_kelas` (`nama_kelas`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table db_pelatihan_digital_marketing.tb_peserta: ~2 rows (approximately)
/*!40000 ALTER TABLE `tb_peserta` DISABLE KEYS */;
REPLACE INTO `tb_peserta` (`id_peserta`, `nama_peserta`, `nama_kelas`) VALUES
	(13, 'Zori Roronoa', '2'),
	(16, 'Muhammad Farid Fuady Rahman', '1');
/*!40000 ALTER TABLE `tb_peserta` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
