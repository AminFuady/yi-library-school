-- Adminer 4.3.1 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `authassignment`;
CREATE TABLE `authassignment` (
  `itemname` varchar(64) NOT NULL,
  `userid` varchar(64) NOT NULL,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`itemname`,`userid`),
  CONSTRAINT `authassignment_ibfk_1` FOREIGN KEY (`itemname`) REFERENCES `authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `authassignment` (`itemname`, `userid`, `bizrule`, `data`) VALUES
('',	'2',	NULL,	'N;'),
('Admin',	'1',	NULL,	'N;');

DROP TABLE IF EXISTS `authitem`;
CREATE TABLE `authitem` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES
('',	2,	'',	NULL,	'N;'),
('Admin',	2,	NULL,	NULL,	'N;'),
('Authenticated',	2,	NULL,	NULL,	'N;'),
('Book.*',	1,	NULL,	NULL,	'N;'),
('Book.AjaxBookDetail',	0,	NULL,	NULL,	'N;'),
('Book.Create',	0,	NULL,	NULL,	'N;'),
('Book.Delete',	0,	NULL,	NULL,	'N;'),
('Book.Import',	0,	NULL,	NULL,	'N;'),
('Book.Index',	0,	NULL,	NULL,	'N;'),
('Book.Update',	0,	NULL,	NULL,	'N;'),
('Book.View',	0,	NULL,	NULL,	'N;'),
('CategoryBook.*',	1,	NULL,	NULL,	'N;'),
('CategoryBook.Actived',	0,	NULL,	NULL,	'N;'),
('CategoryBook.Create',	0,	NULL,	NULL,	'N;'),
('CategoryBook.Delete',	0,	NULL,	NULL,	'N;'),
('CategoryBook.Index',	0,	NULL,	NULL,	'N;'),
('CategoryBook.Update',	0,	NULL,	NULL,	'N;'),
('CategoryBook.View',	0,	NULL,	NULL,	'N;'),
('Dashboard.*',	1,	NULL,	NULL,	'N;'),
('Dashboard.EditProfile',	0,	NULL,	NULL,	'N;'),
('Dashboard.Index',	0,	NULL,	NULL,	'N;'),
('Departement.*',	1,	NULL,	NULL,	'N;'),
('Departement.Actived',	0,	NULL,	NULL,	'N;'),
('Departement.Create',	0,	NULL,	NULL,	'N;'),
('Departement.Delete',	0,	NULL,	NULL,	'N;'),
('Departement.Index',	0,	NULL,	NULL,	'N;'),
('Departement.Update',	0,	NULL,	NULL,	'N;'),
('Departement.View',	0,	NULL,	NULL,	'N;'),
('Duration.*',	1,	NULL,	NULL,	'N;'),
('Duration.Create',	0,	NULL,	NULL,	'N;'),
('Duration.Delete',	0,	NULL,	NULL,	'N;'),
('Duration.Index',	0,	NULL,	NULL,	'N;'),
('Duration.Update',	0,	NULL,	NULL,	'N;'),
('Duration.View',	0,	NULL,	NULL,	'N;'),
('Employee.*',	1,	NULL,	NULL,	'N;'),
('Employee.Create',	0,	NULL,	NULL,	'N;'),
('Employee.Delete',	0,	NULL,	NULL,	'N;'),
('Employee.Index',	0,	NULL,	NULL,	'N;'),
('Employee.Update',	0,	NULL,	NULL,	'N;'),
('Employee.View',	0,	NULL,	NULL,	'N;'),
('Grade.*',	1,	NULL,	NULL,	'N;'),
('Grade.Actived',	0,	NULL,	NULL,	'N;'),
('Grade.Create',	0,	NULL,	NULL,	'N;'),
('Grade.Delete',	0,	NULL,	NULL,	'N;'),
('Grade.Index',	0,	NULL,	NULL,	'N;'),
('Grade.Update',	0,	NULL,	NULL,	'N;'),
('Grade.View',	0,	NULL,	NULL,	'N;'),
('Guest',	2,	NULL,	NULL,	'N;'),
('LoaningBook.*',	1,	NULL,	NULL,	'N;'),
('LoaningBook.AjaxFormLoanDetail',	0,	NULL,	NULL,	'N;'),
('LoaningBook.AjaxGetLoaningBookWithDendaByMember',	0,	NULL,	NULL,	'N;'),
('LoaningBook.AjaxGetReimbursementDate',	0,	NULL,	NULL,	'N;'),
('LoaningBook.AjaxListMember',	0,	NULL,	NULL,	'N;'),
('LoaningBook.Autocomplete',	0,	NULL,	NULL,	'N;'),
('LoaningBook.Create',	0,	NULL,	NULL,	'N;'),
('LoaningBook.Delete',	0,	NULL,	NULL,	'N;'),
('LoaningBook.Denda',	0,	NULL,	NULL,	'N;'),
('LoaningBook.Index',	0,	NULL,	NULL,	'N;'),
('LoaningBook.Update',	0,	NULL,	NULL,	'N;'),
('LoaningBook.View',	0,	NULL,	NULL,	'N;'),
('Position.*',	1,	NULL,	NULL,	'N;'),
('Position.Actived',	0,	NULL,	NULL,	'N;'),
('Position.Create',	0,	NULL,	NULL,	'N;'),
('Position.Delete',	0,	NULL,	NULL,	'N;'),
('Position.Index',	0,	NULL,	NULL,	'N;'),
('Position.Update',	0,	NULL,	NULL,	'N;'),
('Position.View',	0,	NULL,	NULL,	'N;'),
('PreviousEducation.*',	1,	NULL,	NULL,	'N;'),
('PreviousEducation.Actived',	0,	NULL,	NULL,	'N;'),
('PreviousEducation.Create',	0,	NULL,	NULL,	'N;'),
('PreviousEducation.Delete',	0,	NULL,	NULL,	'N;'),
('PreviousEducation.Index',	0,	NULL,	NULL,	'N;'),
('PreviousEducation.Update',	0,	NULL,	NULL,	'N;'),
('PreviousEducation.View',	0,	NULL,	NULL,	'N;'),
('RackBook.*',	1,	NULL,	NULL,	'N;'),
('RackBook.Actived',	0,	NULL,	NULL,	'N;'),
('RackBook.Create',	0,	NULL,	NULL,	'N;'),
('RackBook.Delete',	0,	NULL,	NULL,	'N;'),
('RackBook.Index',	0,	NULL,	NULL,	'N;'),
('RackBook.Update',	0,	NULL,	NULL,	'N;'),
('RackBook.View',	0,	NULL,	NULL,	'N;'),
('ReimbursementBook.*',	1,	NULL,	NULL,	'N;'),
('ReimbursementBook.Admin',	0,	NULL,	NULL,	'N;'),
('ReimbursementBook.Create',	0,	NULL,	NULL,	'N;'),
('ReimbursementBook.Delete',	0,	NULL,	NULL,	'N;'),
('ReimbursementBook.Index',	0,	NULL,	NULL,	'N;'),
('ReimbursementBook.Update',	0,	NULL,	NULL,	'N;'),
('ReimbursementBook.View',	0,	NULL,	NULL,	'N;'),
('Religion.*',	1,	NULL,	NULL,	'N;'),
('Religion.Actived',	0,	NULL,	NULL,	'N;'),
('Religion.Create',	0,	NULL,	NULL,	'N;'),
('Religion.Delete',	0,	NULL,	NULL,	'N;'),
('Religion.Index',	0,	NULL,	NULL,	'N;'),
('Religion.Update',	0,	NULL,	NULL,	'N;'),
('Religion.View',	0,	NULL,	NULL,	'N;'),
('SchoolInfo.*',	1,	NULL,	NULL,	'N;'),
('SchoolInfo.Admin',	0,	NULL,	NULL,	'N;'),
('SchoolInfo.Create',	0,	NULL,	NULL,	'N;'),
('SchoolInfo.Delete',	0,	NULL,	NULL,	'N;'),
('SchoolInfo.Index',	0,	NULL,	NULL,	'N;'),
('SchoolInfo.Update',	0,	NULL,	NULL,	'N;'),
('SchoolInfo.View',	0,	NULL,	NULL,	'N;'),
('Site.*',	1,	NULL,	NULL,	'N;'),
('Site.Error',	0,	NULL,	NULL,	'N;'),
('Site.Index',	0,	NULL,	NULL,	'N;'),
('Site.Logout',	0,	NULL,	NULL,	'N;'),
('Student.*',	1,	NULL,	NULL,	'N;'),
('Student.Create',	0,	NULL,	NULL,	'N;'),
('Student.Delete',	0,	NULL,	NULL,	'N;'),
('Student.Import',	0,	NULL,	NULL,	'N;'),
('Student.Index',	0,	NULL,	NULL,	'N;'),
('Student.Update',	0,	NULL,	NULL,	'N;'),
('Student.View',	0,	NULL,	NULL,	'N;'),
('Teacher.*',	1,	NULL,	NULL,	'N;'),
('Teacher.Create',	0,	NULL,	NULL,	'N;'),
('Teacher.Delete',	0,	NULL,	NULL,	'N;'),
('Teacher.Index',	0,	NULL,	NULL,	'N;'),
('Teacher.Update',	0,	NULL,	NULL,	'N;'),
('Teacher.View',	0,	NULL,	NULL,	'N;'),
('User.*',	1,	NULL,	NULL,	'N;'),
('User.Create',	0,	NULL,	NULL,	'N;'),
('User.CreateDealer',	0,	NULL,	NULL,	'N;'),
('User.Delete',	0,	NULL,	NULL,	'N;'),
('User.Index',	0,	NULL,	NULL,	'N;'),
('User.Update',	0,	NULL,	NULL,	'N;'),
('User.VendorActivation',	0,	NULL,	NULL,	'N;'),
('User.VendorUsers',	0,	NULL,	NULL,	'N;'),
('User.View',	0,	NULL,	NULL,	'N;');

DROP TABLE IF EXISTS `authitemchild`;
CREATE TABLE `authitemchild` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `authitemchild_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `authitemchild_ibfk_2` FOREIGN KEY (`child`) REFERENCES `authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `book`;
CREATE TABLE `book` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(80) NOT NULL,
  `title` varchar(300) NOT NULL,
  `author` varchar(100) NOT NULL,
  `publisher` varchar(100) NOT NULL,
  `publish_year` int(4) NOT NULL,
  `publish_place` varchar(50) NOT NULL,
  `page` int(11) NOT NULL,
  `height` int(11) NOT NULL,
  `ddc` varchar(50) NOT NULL,
  `isbn` varchar(50) NOT NULL,
  `qty` bigint(12) NOT NULL,
  `price` bigint(12) NOT NULL,
  `category_book_id` int(11) NOT NULL,
  `source_book` varchar(70) NOT NULL,
  `no_inventaris` char(20) NOT NULL,
  `description` varchar(500) NOT NULL,
  `rack_book_id` int(11) NOT NULL,
  `status` int(11) NOT NULL COMMENT '10=Active, 0=Inactive',
  `photo` varchar(100) NOT NULL,
  `status_book` int(11) NOT NULL COMMENT '10=Baru, 20=Bekas',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `book` (`id`, `code`, `title`, `author`, `publisher`, `publish_year`, `publish_place`, `page`, `height`, `ddc`, `isbn`, `qty`, `price`, `category_book_id`, `source_book`, `no_inventaris`, `description`, `rack_book_id`, `status`, `photo`, `status_book`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(2,	'BO-1604-000001',	'Laravel 5',	'Hendri Gunawan',	'PT Lokomedia Indonesia',	2015,	'Jakarta',	130,	40,	'12030891',	'12398719231',	15,	55000,	3,	'Dana BOS',	'12397102',	'Ini adalah buku Laravel',	2,	10,	'2016-7ec139bda24da80f0a458e83eba1cef3.jpg',	10,	'2016-04-01 14:49:54',	'2016-04-01 15:09:12',	1,	1),
(3,	'BO-1604-000002',	'Belajar Yii Framework 2.0',	'Hendri Gunawan',	'PT. Tokomedia Indonesia',	2015,	'Jakarta',	54,	40,	'198',	'289871',	0,	54000,	3,	'Mandiri',	'2891820981',	'Pembelian Buku ini memakai dana dari sekolah',	2,	10,	'belajar-yii-framework-2.0-ae9cfd96017703780ad1392a24105018.jpg',	10,	'2016-04-05 11:03:22',	'2016-04-06 16:17:30',	1,	1),
(6,	'BO-1604-000003',	'Menjadi Pebisnis Muda',	'Hendri Gunawan',	'Lokomedia',	2012,	'Jakarta',	100,	60,	'290',	'2901',	10,	120000,	3,	'BOS',	'123123',	'Ok',	2,	10,	'book_dummy.png',	10,	'2016-04-05 17:11:50',	NULL,	1,	NULL),
(7,	'BO-1604-000004',	'Matematika 4',	'Hendri Gunawan',	'Tekmulti Nusantara',	2012,	'Jakarta',	100,	60,	'290',	'2901',	10,	120000,	5,	'BOS',	'123123',	'Ok',	4,	10,	'book_dummy.png',	10,	'2016-04-06 21:12:09',	NULL,	1,	NULL),
(8,	'BO-1604-000005',	'Bahasa Indonesia 4',	'Gunawan Hendri',	'Nusantara Tekmulti',	2010,	'Yogyakarta',	80,	50,	'',	'',	19,	55000,	6,	'BOS',	'123123',	'Ok',	5,	10,	'book_dummy.png',	10,	'2016-04-06 21:12:09',	NULL,	1,	NULL),
(9,	'BO-1604-000006',	'Ilmu Pengetahaun Alam 3',	'Hendri',	'Nusantara',	2011,	'Bandung',	85,	50,	'',	'',	25,	60000,	7,	'BOS',	'123123',	'Ok',	6,	10,	'book_dummy.png',	10,	'2016-04-06 21:12:09',	NULL,	1,	NULL);

DROP TABLE IF EXISTS `category_book`;
CREATE TABLE `category_book` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` varchar(500) NOT NULL,
  `status` int(11) NOT NULL COMMENT '10=Active, 0=Inactive',
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `category_book` (`id`, `name`, `description`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(3,	'Komputer',	'Komputer',	10,	'2016-04-01 14:39:09',	1,	NULL,	NULL),
(4,	'Bahasa',	'Bahasa',	10,	'2016-04-01 14:39:23',	1,	'2016-04-09 09:51:56',	1),
(5,	'Matematika',	'Matematika',	10,	'2016-04-06 20:56:20',	1,	NULL,	NULL),
(6,	'Bahasa Indonesia',	'Bahasa Indonesia',	10,	'2016-04-06 20:56:50',	1,	NULL,	NULL),
(7,	'IPA',	'Ilmu Pengetahuan Alam',	10,	'2016-04-06 20:57:14',	1,	NULL,	NULL);

DROP TABLE IF EXISTS `departement`;
CREATE TABLE `departement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(80) NOT NULL,
  `description` varchar(500) NOT NULL,
  `status` int(11) NOT NULL COMMENT '10=Active, 0=Inactive',
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `departement` (`id`, `name`, `description`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1,	'Sistem Informasi',	'Jurusan Sistem Informasi Fakultas Ilmu Komputer Universitas Mercu Buana',	10,	'2016-04-01 11:53:16',	1,	'2016-04-01 11:53:58',	1);

DROP TABLE IF EXISTS `detail_loaning_book`;
CREATE TABLE `detail_loaning_book` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `loaning_book_id` int(11) NOT NULL,
  `code` varchar(80) NOT NULL,
  `qty` bigint(12) NOT NULL,
  `description` varchar(500) NOT NULL,
  `status` int(11) NOT NULL COMMENT '10=Proses Peminjaman, 20=Kembali, 30=Hilang',
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `detail_loaning_book` (`id`, `loaning_book_id`, `code`, `qty`, `description`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1,	1,	'BO-1604-000001',	3,	'',	20,	'2016-04-06 16:52:54',	1,	NULL,	NULL),
(2,	1,	'BO-1604-000003',	4,	'',	20,	'2016-04-06 16:52:54',	1,	NULL,	NULL),
(4,	3,	'BO-1604-000005',	1,	'',	20,	'2016-04-07 20:55:01',	1,	NULL,	NULL),
(5,	3,	'BO-1604-000001',	1,	'',	20,	'2016-04-07 20:55:01',	1,	NULL,	NULL),
(6,	4,	'BO-1604-000005',	1,	'Pinjam',	20,	'2016-04-09 09:53:06',	1,	NULL,	NULL),
(7,	4,	'BO-1604-000006',	1,	'Pinjam',	20,	'2016-04-09 09:53:06',	1,	NULL,	NULL),
(8,	5,	'BO-1604-000006',	2,	'Pinjam',	20,	'2016-04-09 19:48:33',	1,	NULL,	NULL),
(9,	6,	'BO-1604-000001',	2,	'Pinjam',	20,	'2016-04-11 08:21:13',	1,	NULL,	NULL),
(10,	7,	'BO-1604-000001',	1,	'Pinjam',	20,	'2016-04-11 13:38:52',	1,	NULL,	NULL),
(11,	8,	'BO-1604-000004',	1,	'Pinjam',	20,	'2016-04-11 14:01:00',	1,	NULL,	NULL),
(12,	9,	'BO-1604-000004',	1,	'Pinjam',	20,	'2016-04-11 17:47:43',	1,	NULL,	NULL),
(13,	10,	'BO-1604-000001',	2,	'Pinjam',	20,	'2016-05-27 09:24:49',	1,	NULL,	NULL),
(14,	11,	'BO-1604-000005',	1,	'Pinjam',	20,	'2016-06-10 10:31:19',	1,	NULL,	NULL),
(15,	11,	'BO-1604-000004',	1,	'Pinjam',	20,	'2016-06-10 10:31:19',	1,	NULL,	NULL),
(16,	11,	'BO-1604-000001',	1,	'Pinjam',	20,	'2016-06-10 10:31:19',	1,	NULL,	NULL),
(17,	12,	'BO-1604-000004',	1,	'Pinjam',	20,	'2016-06-18 11:16:12',	1,	NULL,	NULL),
(18,	12,	'BO-1604-000006',	1,	'Pinjam',	20,	'2016-06-18 11:16:12',	1,	NULL,	NULL),
(19,	12,	'BO-1604-000001',	1,	'Pinjam',	20,	'2016-06-18 11:16:12',	1,	NULL,	NULL),
(20,	12,	'BO-1604-000003',	1,	'Pinjam',	20,	'2016-06-18 11:16:12',	1,	NULL,	NULL),
(21,	12,	'BO-1604-000005',	1,	'Pinjam',	20,	'2016-06-18 11:16:12',	1,	NULL,	NULL),
(22,	13,	'BO-1604-000005',	1,	'Pinajam',	10,	'2016-06-20 14:24:57',	1,	NULL,	NULL);

DROP TABLE IF EXISTS `duration`;
CREATE TABLE `duration` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(80) NOT NULL,
  `value` bigint(11) NOT NULL,
  `description` varchar(500) NOT NULL,
  `status` int(11) NOT NULL COMMENT '10=Active, 0=Inactive',
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `duration` (`id`, `name`, `value`, `description`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1,	'Durasi Pinjam Siswa',	6,	'Durasi Peminjaman Buku Siswa',	10,	'2016-03-24 11:32:00',	1,	'2016-04-03 21:56:18',	1),
(2,	'Durasi Pinjam Guru',	30,	'Durasi Peminjaman Buku Guru',	10,	'2016-03-24 11:32:00',	1,	NULL,	NULL),
(3,	'Durasi Pinjam Karyawan',	25,	'Durasi Peminjaman Buku Karyawan',	10,	'2016-03-24 11:32:00',	1,	NULL,	NULL),
(4,	'Denda keterlambatan Siswa',	1000,	'Denda Keterlambatan Siswa perhari',	10,	'2016-03-24 11:32:00',	1,	NULL,	NULL),
(5,	'Denda keterlambatan Guru',	2000,	'Denda Keterlambatan Guru perhari',	10,	'2016-03-24 11:32:00',	1,	NULL,	NULL),
(6,	'Denda keterlambatan Karyawan',	3000,	'Denda Keterlambatan Karyawan perhari',	10,	'2016-03-24 11:32:00',	1,	NULL,	NULL);

DROP TABLE IF EXISTS `employee`;
CREATE TABLE `employee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_code` varchar(20) NOT NULL,
  `nik` bigint(20) NOT NULL,
  `code` bigint(20) DEFAULT NULL,
  `name` varchar(80) NOT NULL,
  `address` varchar(200) NOT NULL,
  `dob_place` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `religion_id` int(11) NOT NULL,
  `gender` char(15) NOT NULL,
  `no_telp` char(15) NOT NULL,
  `photo` varchar(100) NOT NULL,
  `position_id` int(11) NOT NULL,
  `date_in` date NOT NULL,
  `employee_status` int(11) NOT NULL COMMENT '10=PNS, 20=Honorer ',
  `marital_status` int(11) NOT NULL COMMENT '	10=Menikah,20=Belum Menikah,30=Single Parent',
  `previous_education_id` int(11) NOT NULL,
  `instance_previous_education` varchar(80) NOT NULL,
  `graduation_year` int(4) NOT NULL,
  `status` int(11) NOT NULL COMMENT '10=Active,0=Inactive',
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `employee` (`id`, `member_code`, `nik`, `code`, `name`, `address`, `dob_place`, `dob`, `religion_id`, `gender`, `no_telp`, `photo`, `position_id`, `date_in`, `employee_status`, `marital_status`, `previous_education_id`, `instance_previous_education`, `graduation_year`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1,	'EMP-1604-000001',	19238102398,	923810293812,	'Hendri Gunawan, S.Kom',	'Jalan Batu Ceper X No 2Y Jakarta Pusat',	'Jakarta',	'1997-06-15',	1,	'Laki-laki',	'0123891381203',	'2016-55b3d87ff9f905b96891b517e0bce1e1.jpg',	1,	'2016-02-09',	10,	20,	5,	'Universitas Indonesia',	2015,	10,	'2016-04-01 17:50:55',	1,	NULL,	NULL),
(2,	'EMP-1604-000002',	90123123,	NULL,	'Hendri Gunawan',	'Jl Lapangan Tembak 300',	'Jakarta',	'1980-12-02',	1,	'Laki-laki',	'628561471500',	'user_dummy.png',	1,	'1980-12-02',	10,	20,	3,	'SMK Adi Sanggoro',	2015,	10,	'2016-04-06 22:42:48',	1,	NULL,	NULL);

DROP TABLE IF EXISTS `grade`;
CREATE TABLE `grade` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(80) NOT NULL,
  `description` varchar(500) NOT NULL,
  `status` int(11) NOT NULL COMMENT '10=Active, 0=Inactive',
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `grade` (`id`, `name`, `description`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1,	'Kelas 1',	'kelas 1',	10,	'2016-04-01 16:35:37',	1,	NULL,	NULL),
(2,	'Kelas 2',	'Kelas 2',	10,	'2016-04-01 16:35:49',	1,	NULL,	NULL);

DROP TABLE IF EXISTS `loaning_book`;
CREATE TABLE `loaning_book` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `loaning_code` varchar(20) NOT NULL,
  `initial_member` int(11) NOT NULL COMMENT '10=siswa, 20=guru, 30=employe',
  `member_code` varchar(20) NOT NULL,
  `loaning_date` date NOT NULL,
  `reimbursement_date` date NOT NULL,
  `status` int(11) NOT NULL COMMENT '10=pinjam,20=dikembalikan, 30=denda',
  `status_date` datetime NOT NULL COMMENT 'pencatat tanggal perubahan status',
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `loaning_book` (`id`, `loaning_code`, `initial_member`, `member_code`, `loaning_date`, `reimbursement_date`, `status`, `status_date`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1,	'LOAN-1604-000001',	1,	'SIS-1604-000001',	'2016-04-06',	'2016-04-12',	30,	'2016-04-06 11:53:15',	'2016-04-06 16:52:54',	1,	NULL,	NULL),
(3,	'LOAN-1604-000002',	1,	'SIS-1604-000001',	'2016-04-06',	'2016-04-12',	20,	'2016-04-07 15:55:39',	'2016-04-07 20:55:01',	1,	NULL,	NULL),
(4,	'LOAN-1604-000003',	2,	'GUR-1604-000001',	'2016-04-01',	'2016-05-01',	20,	'2016-04-09 10:17:12',	'2016-04-09 09:53:06',	1,	NULL,	NULL),
(5,	'LOAN-1604-000004',	1,	'SIS-1604-000001',	'2016-04-09',	'2016-04-15',	20,	'2016-04-09 19:51:12',	'2016-04-09 19:48:33',	1,	NULL,	NULL),
(6,	'LOAN-1604-000005',	1,	'SIS-1604-000001',	'2016-04-11',	'2016-04-17',	20,	'2016-04-11 08:21:41',	'2016-04-11 08:21:13',	1,	NULL,	NULL),
(7,	'LOAN-1604-000006',	2,	'GUR-1604-000001',	'2016-04-11',	'2016-05-11',	20,	'2016-04-11 13:39:38',	'2016-04-11 13:38:52',	1,	NULL,	NULL),
(8,	'LOAN-1604-000007',	2,	'GUR-1604-000001',	'2016-04-11',	'2016-05-11',	20,	'2016-04-11 14:02:39',	'2016-04-11 14:01:00',	1,	NULL,	NULL),
(9,	'LOAN-1604-000008',	1,	'SIS-1604-000002',	'2016-04-11',	'2016-04-17',	20,	'2016-04-11 17:48:32',	'2016-04-11 17:47:43',	1,	NULL,	NULL),
(10,	'LOAN-1605-000001',	1,	'SIS-1604-000002',	'2016-05-27',	'2016-06-02',	20,	'2016-05-27 09:25:17',	'2016-05-27 09:24:49',	1,	NULL,	NULL),
(11,	'LOAN-1606-000001',	1,	'SIS-1604-000002',	'2016-06-10',	'2016-06-16',	20,	'2016-06-10 10:31:39',	'2016-06-10 10:31:19',	1,	NULL,	NULL),
(12,	'LOAN-1606-000002',	2,	'GUR-1606-000001',	'2016-06-18',	'2016-07-18',	20,	'2016-06-18 11:16:42',	'2016-06-18 11:16:12',	1,	NULL,	NULL),
(13,	'LOAN-1606-000003',	1,	'SIS-1604-000002',	'2016-06-20',	'2016-06-26',	10,	'2016-06-20 14:24:57',	'2016-06-20 14:24:57',	1,	NULL,	NULL);

DROP TABLE IF EXISTS `member`;
CREATE TABLE `member` (
  `member_code` char(20) NOT NULL,
  `member_table` varchar(50) NOT NULL COMMENT 'table yang bersangkutan dengan member_code',
  `status` int(11) NOT NULL COMMENT '10=active, 0=inactive'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `position`;
CREATE TABLE `position` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(80) NOT NULL,
  `description` varchar(500) NOT NULL,
  `status` int(11) NOT NULL COMMENT '10=Active, 0=Inactive',
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `position` (`id`, `name`, `description`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1,	'Guru',	'Guru',	10,	'2016-04-01 16:36:26',	1,	NULL,	NULL),
(2,	'Staff',	'Staff',	10,	'2016-04-01 16:36:35',	1,	NULL,	NULL);

DROP TABLE IF EXISTS `previous_education`;
CREATE TABLE `previous_education` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(80) NOT NULL,
  `description` varchar(500) NOT NULL,
  `status` int(11) NOT NULL COMMENT '10=Active, 0=Inactive',
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `previous_education` (`id`, `name`, `description`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1,	'SD',	'Sekolah Dasar',	10,	'2016-04-01 16:37:46',	1,	NULL,	NULL),
(2,	'SMP',	'Sekolah Menengah Pertama',	10,	'2016-04-01 16:38:17',	1,	NULL,	NULL),
(3,	'SMA / SMK',	'Sekolah Menengah Atas',	10,	'2016-04-01 16:38:32',	1,	NULL,	NULL),
(4,	'D3',	'Diploma 3',	10,	'2016-04-01 16:38:40',	1,	'2016-04-01 16:39:37',	1),
(5,	'Sarjana 1',	'Sarjana Tingkat 1',	10,	'2016-04-01 16:39:26',	1,	NULL,	NULL);

DROP TABLE IF EXISTS `rack_book`;
CREATE TABLE `rack_book` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(80) NOT NULL,
  `description` varchar(500) NOT NULL,
  `status` int(11) NOT NULL COMMENT '10=Active, 0=Inactive',
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `rack_book` (`id`, `name`, `description`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(2,	'C-4 Komputer',	'Rak C No 4 Komputer',	10,	'2016-04-01 14:39:49',	1,	NULL,	NULL),
(3,	'C-5 Komputer',	'Rak C No 5 Komputer',	0,	'2016-04-01 14:40:36',	1,	NULL,	NULL),
(4,	'A1 - Matematika',	'Matematika',	10,	'2016-04-06 20:58:29',	1,	NULL,	NULL),
(5,	'B2 - Bahasa Indonesia',	'Bahasa Indonesia',	10,	'2016-04-06 20:58:53',	1,	NULL,	NULL),
(6,	'C1 - IPA',	'Ilmu Pengetahaun Alam',	10,	'2016-04-06 20:59:13',	1,	NULL,	NULL);

DROP TABLE IF EXISTS `reimbursement_book`;
CREATE TABLE `reimbursement_book` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `loaning_book_id` int(11) NOT NULL,
  `reimbursement_date` date NOT NULL,
  `denda` bigint(12) NOT NULL,
  `total_denda` bigint(12) NOT NULL,
  `description` varchar(500) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `reimbursement_book` (`id`, `loaning_book_id`, `reimbursement_date`, `denda`, `total_denda`, `description`, `user_id`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1,	1,	'2016-04-06',	2000,	6000,	'Okeee',	0,	'2016-04-06 16:53:15',	1,	NULL,	NULL),
(2,	3,	'2016-04-07',	0,	0,	'Sudah dikembalikan',	0,	'2016-04-07 20:55:39',	1,	NULL,	NULL),
(3,	4,	'2016-04-09',	0,	0,	'sudah kembali',	0,	'2016-04-09 10:17:12',	1,	NULL,	NULL),
(4,	5,	'2016-04-09',	0,	0,	'Sudah dikembalikan',	0,	'2016-04-09 19:51:12',	1,	NULL,	NULL),
(5,	6,	'2016-04-11',	0,	0,	'Sudah ikembalikan',	0,	'2016-04-11 08:21:41',	1,	NULL,	NULL),
(6,	7,	'2016-04-11',	0,	0,	'kembali',	0,	'2016-04-11 13:39:38',	1,	NULL,	NULL),
(7,	8,	'2016-04-11',	0,	0,	'Sudah kembali',	0,	'2016-04-11 14:02:39',	1,	NULL,	NULL),
(8,	9,	'2016-04-11',	0,	0,	'Kembali',	0,	'2016-04-11 17:48:32',	1,	NULL,	NULL),
(9,	10,	'2016-05-27',	0,	0,	'Kembali',	0,	'2016-05-27 09:25:16',	1,	NULL,	NULL),
(10,	11,	'2016-06-10',	0,	0,	'kembali',	0,	'2016-06-10 10:31:39',	1,	NULL,	NULL),
(11,	12,	'2016-06-18',	0,	0,	'Kembali',	0,	'2016-06-18 11:16:42',	1,	NULL,	NULL);

DROP TABLE IF EXISTS `religion`;
CREATE TABLE `religion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(80) NOT NULL,
  `description` varchar(500) NOT NULL,
  `status` int(11) NOT NULL COMMENT '10=Active, 0=Inactive',
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `religion` (`id`, `name`, `description`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1,	'Islam',	'Islam',	10,	'2016-04-01 16:36:48',	1,	NULL,	NULL),
(2,	'Kristen Protestan',	'Kristen Protestan',	10,	'2016-04-01 16:37:02',	1,	NULL,	NULL),
(3,	'Kristen Katolik',	'Kristen Katolik',	10,	'2016-04-01 16:37:15',	1,	NULL,	NULL),
(4,	'Budha',	'Budha',	10,	'2016-04-01 16:37:25',	1,	NULL,	NULL);

DROP TABLE IF EXISTS `rights`;
CREATE TABLE `rights` (
  `itemname` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `weight` int(11) NOT NULL,
  PRIMARY KEY (`itemname`),
  CONSTRAINT `rights_ibfk_1` FOREIGN KEY (`itemname`) REFERENCES `authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `school_info`;
CREATE TABLE `school_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `npsn` varchar(50) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` varchar(500) NOT NULL,
  `no_telp` char(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `kepsek` varchar(80) NOT NULL,
  `address` varchar(300) NOT NULL,
  `logo` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `school_info` (`id`, `npsn`, `name`, `description`, `no_telp`, `email`, `kepsek`, `address`, `logo`) VALUES
(1,	'123',	'SDN Ciaruteun Ilir 05',	'SDN',	'0251',	'sdn.testing@gmail.com',	'Sandi Winata, S.Kom',	'Ds. Ciaruteun Ilir',	'logo.png');

DROP TABLE IF EXISTS `student`;
CREATE TABLE `student` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_code` varchar(20) NOT NULL,
  `nisn` char(15) NOT NULL,
  `nis` char(15) NOT NULL,
  `name` varchar(80) NOT NULL,
  `photo` varchar(100) NOT NULL,
  `dob_place` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `gender` char(15) NOT NULL COMMENT 'Laki-laki,Perempuan',
  `religion_id` int(11) NOT NULL,
  `address` varchar(200) NOT NULL,
  `no_telp` char(15) NOT NULL,
  `grade_id` int(11) NOT NULL,
  `departement_id` int(11) NOT NULL,
  `extracurricular` varchar(80) NOT NULL,
  `semester` int(11) NOT NULL COMMENT '10=Ganjil, 20=Genap',
  `date_in` date NOT NULL,
  `previous_education_id` int(11) NOT NULL,
  `mother_name` varchar(80) NOT NULL,
  `family_status` int(11) NOT NULL COMMENT '10=Kandung, 20=Angkat, 30=Tiri',
  `child_of` int(5) NOT NULL,
  `family_qty` int(5) NOT NULL,
  `family_address` varchar(200) NOT NULL,
  `father_earning` varchar(30) DEFAULT NULL,
  `family_telp` char(15) NOT NULL,
  `father_work` varchar(50) NOT NULL,
  `mother_work` varchar(50) NOT NULL,
  `father_name` varchar(80) NOT NULL,
  `mother_earning` varchar(30) DEFAULT NULL,
  `wali_address` varchar(200) DEFAULT NULL,
  `wali_telp` char(15) DEFAULT NULL,
  `wali_work` varchar(100) DEFAULT NULL,
  `student_status` int(11) NOT NULL COMMENT '10=Active, 20=Alumni, 30=Baru Masuk',
  `status` int(11) NOT NULL COMMENT '10=Active, 0=Inactive',
  `wali_name` varchar(80) DEFAULT NULL,
  `expire_date` date NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `student` (`id`, `member_code`, `nisn`, `nis`, `name`, `photo`, `dob_place`, `dob`, `gender`, `religion_id`, `address`, `no_telp`, `grade_id`, `departement_id`, `extracurricular`, `semester`, `date_in`, `previous_education_id`, `mother_name`, `family_status`, `child_of`, `family_qty`, `family_address`, `father_earning`, `family_telp`, `father_work`, `mother_work`, `father_name`, `mother_earning`, `wali_address`, `wali_telp`, `wali_work`, `student_status`, `status`, `wali_name`, `expire_date`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1,	'SIS-1604-000001',	'9973495671',	'12012',	'Hendri Gunawan',	'2016-2c36f16ecf65b6c7b1150c11303d1d44.jpg',	'Jakarta',	'1997-06-15',	'Laki-laki',	1,	'Jl Batu Ceper x No 2Y',	'08561471500',	1,	1,	'-',	10,	'2016-03-05',	3,	'Nengsih',	10,	1,	2,	'Jl Lap tembak',	'3000000',	'08567755081',	'Karyawan Swasta',	'0',	'Budi',	'0',	'',	'',	'',	20,	10,	'',	'2021-04-01',	'2016-04-01 16:45:42',	1,	'2016-04-01 16:59:07',	1),
(2,	'SIS-1604-000002',	'98123791283',	'123898711',	'Rendi Gunawan',	'2016-33b24df4d90a9720d7d79aaf00d3bd29.jpg',	'Bogor',	'2002-07-28',	'Laki-laki',	1,	'Jl Lapangan Tembak',	'01239713912',	2,	1,	'Futsal',	10,	'2016-03-27',	4,	'Nengsih',	10,	2,	2,	'Jl Lapangan Tembak',	'3000000',	'012371923',	'Karyawan',	'-',	'Budi',	'0',	'',	'',	'',	10,	10,	'',	'2021-01-01',	'2016-04-01 20:17:54',	1,	NULL,	NULL),
(4,	'SIS-1604-000003',	'90123123',	'90123123',	'Hendri Gunawan',	'user_dummy.png',	'2012',	'1997-06-15',	'Laki-laki',	1,	'Jl Lapangan Tembak 300',	'628561471500',	1,	1,	'Pramuka',	10,	'1997-06-15',	1,	'Nengsih',	10,	1,	2,	'Jl Batu Ceper',	NULL,	'620192309213',	'Karyawan Swasta',	'',	'Budi',	NULL,	NULL,	'620192309213',	NULL,	10,	10,	NULL,	'2021-04-06',	'2016-04-06 21:45:34',	1,	NULL,	NULL);

DROP TABLE IF EXISTS `teacher`;
CREATE TABLE `teacher` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_code` varchar(20) NOT NULL,
  `nik` bigint(20) NOT NULL,
  `code` bigint(20) DEFAULT NULL,
  `name` varchar(80) NOT NULL,
  `dob_place` varchar(80) NOT NULL,
  `dob` date NOT NULL,
  `gender` char(15) NOT NULL,
  `religion_id` int(11) NOT NULL,
  `address` varchar(300) NOT NULL,
  `no_telp` char(15) NOT NULL,
  `date_in` date NOT NULL,
  `marital_status` int(11) NOT NULL COMMENT '10=Menikah,20=Belum Menikah,30=Single Parent',
  `teacher_status` int(11) NOT NULL COMMENT '10=PNS, 20=Honorer',
  `photo` varchar(100) NOT NULL,
  `previous_education_id` int(11) NOT NULL,
  `instance_previous_education` varchar(50) NOT NULL,
  `status` int(11) NOT NULL COMMENT '10=Active,0=Inactive',
  `graduation_year` int(4) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `teacher` (`id`, `member_code`, `nik`, `code`, `name`, `dob_place`, `dob`, `gender`, `religion_id`, `address`, `no_telp`, `date_in`, `marital_status`, `teacher_status`, `photo`, `previous_education_id`, `instance_previous_education`, `status`, `graduation_year`, `created_at`, `updated_by`, `updated_at`, `created_by`) VALUES
(1,	'GUR-1604-000001',	1923810239123,	12938193813,	'Hendri Gunawan, S.Kom',	'Jakarta',	'1997-06-15',	'Laki-laki',	1,	'Jl Batu Ceper X No 2Y Jakarta Pusat',	'08561471500',	'2016-03-29',	20,	10,	'2016-27e859e19623f3cfc71d77a37db5ed1d.jpg',	5,	'Universitas Mercu Buana',	10,	2015,	'2016-04-01 17:29:07',	NULL,	NULL,	1),
(3,	'GUR-1604-000002',	90123123,	NULL,	'Hendri Gunawan',	'Jakarta',	'1980-12-02',	'Laki-laki',	1,	'Jl Lapangan Tembak 300',	'628561471500',	'1980-12-02',	20,	10,	'user_dummy.png',	3,	'SMK Adi Sanggoro Bogor',	10,	2015,	'2016-04-06 22:22:20',	NULL,	NULL,	1),
(4,	'GUR-1606-000001',	456789056789,	456789056785,	'Nurhabibah Maulani',	'Karawang',	'1997-02-17',	'Perempuan',	1,	'Bogor',	'08883456785678',	'2016-06-01',	20,	10,	'2016-b9e80c936920b4bb37582af96cb3b351.jpg',	5,	'Institut Pertanian Bogor',	10,	2019,	'2016-06-18 11:14:27',	NULL,	NULL,	1);

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `superuser` int(11) NOT NULL,
  `type` int(11) NOT NULL COMMENT '10=Super Admin, 20, Admin',
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` int(11) NOT NULL COMMENT '10=active, 0 inactive',
  `last_visit` datetime NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `user` (`id`, `superuser`, `type`, `name`, `email`, `password`, `status`, `last_visit`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1,	1,	10,	'Sandi Winata',	'sandiwinata@gmail.com',	'd033e22ae348aeb5660fc2140aec35850c4da997',	10,	'2017-10-25 15:49:18',	NULL,	NULL,	'2016-04-09 19:30:42',	1),
(2,	0,	10,	'Sandi Winata',	'sandiwinata@outlook.com',	'43b2b08650393a07d4136498d35ffed4d3770ce6',	10,	'0000-00-00 00:00:00',	'2016-04-09 12:29:34',	1,	'2016-04-09 12:30:22',	1);

-- 2017-10-25 08:57:20
