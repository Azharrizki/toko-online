/*
SQLyog Ultimate v12.5.1 (32 bit)
MySQL - 10.4.19-MariaDB : Database - diby
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `auth_activation_attempts` */

CREATE TABLE `auth_activation_attempts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `auth_activation_attempts` */

/*Table structure for table `auth_groups` */

CREATE TABLE `auth_groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `auth_groups` */

insert  into `auth_groups`(`id`,`name`,`description`) values 
(1,'admin','administrator'),
(2,'guest','guest');

/*Table structure for table `auth_groups_permissions` */

CREATE TABLE `auth_groups_permissions` (
  `group_id` int(11) unsigned NOT NULL DEFAULT 0,
  `permission_id` int(11) unsigned NOT NULL DEFAULT 0,
  KEY `auth_groups_permissions_permission_id_foreign` (`permission_id`),
  KEY `group_id_permission_id` (`group_id`,`permission_id`),
  CONSTRAINT `auth_groups_permissions_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE,
  CONSTRAINT `auth_groups_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `auth_groups_permissions` */

/*Table structure for table `auth_groups_users` */

CREATE TABLE `auth_groups_users` (
  `group_id` int(11) unsigned NOT NULL DEFAULT 0,
  `user_id` int(11) unsigned NOT NULL DEFAULT 0,
  KEY `auth_groups_users_user_id_foreign` (`user_id`),
  KEY `group_id_user_id` (`group_id`,`user_id`),
  CONSTRAINT `auth_groups_users_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE,
  CONSTRAINT `auth_groups_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `auth_groups_users` */

insert  into `auth_groups_users`(`group_id`,`user_id`) values 
(1,1),
(2,2),
(2,3),
(2,4);

/*Table structure for table `auth_logins` */

CREATE TABLE `auth_logins` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `user_id` int(11) unsigned DEFAULT NULL,
  `date` datetime NOT NULL,
  `success` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `email` (`email`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8;

/*Data for the table `auth_logins` */

insert  into `auth_logins`(`id`,`ip_address`,`email`,`user_id`,`date`,`success`) values 
(1,'::1','azharzkii',NULL,'2023-02-07 13:43:42',0),
(2,'::1','azharrizki7834@gmail.com',1,'2023-02-07 13:44:16',1),
(3,'::1','azharrizki7834@gmail.com',1,'2023-02-07 14:19:21',1),
(4,'::1','azharrizki7834@gmail.com',1,'2023-02-07 14:25:17',1),
(5,'::1','azharrizki7834@gmail.com',1,'2023-02-07 14:26:06',1),
(6,'::1','azharrizki7834@gmail.com',1,'2023-02-07 14:27:59',1),
(7,'::1','habibi@gmail.com',2,'2023-02-07 14:28:52',1),
(8,'::1','azharrizki7834@gmail.com',1,'2023-02-07 14:32:04',1),
(9,'::1','azharrizki7834@gmail.com',1,'2023-02-07 14:35:13',1),
(10,'::1','azharrizki7834@gmail.com',1,'2023-02-07 14:37:03',1),
(11,'::1','azharrizki7834@gmail.com',1,'2023-02-07 14:38:34',1),
(12,'::1','habibi@gmail.com',2,'2023-02-07 14:38:53',1),
(13,'::1','azharrizki7834@gmail.com',1,'2023-02-07 14:41:28',1),
(14,'::1','azharrizki7834@gmail.com',1,'2023-02-08 03:35:33',1),
(15,'::1','azharrizki7834@gmail.com',1,'2023-02-08 07:21:09',1),
(16,'::1','azharrizki7834@gmail.com',1,'2023-02-08 11:26:06',1),
(17,'::1','azharrizki',NULL,'2023-02-08 15:28:34',0),
(18,'::1','azharrizki',NULL,'2023-02-08 15:28:47',0),
(19,'::1','azharrizki7834@gmail.com',1,'2023-02-08 18:31:45',1),
(20,'::1','azharrizki7834@gmail.com',1,'2023-02-09 03:09:53',1),
(21,'::1','azharrizki7834@gmail.com',1,'2023-02-09 05:42:01',1),
(22,'::1','azharrizki7834@gmail.com',1,'2023-02-09 07:12:25',1),
(23,'::1','habibi@gmail.com',2,'2023-02-09 11:34:49',1),
(24,'::1','azharrizki7834@gmail.com',1,'2023-02-09 12:31:57',1),
(25,'::1','azharrizki7834@gmail.com',1,'2023-02-10 03:56:41',1),
(26,'::1','habibi@gmail.com',2,'2023-02-10 04:04:09',1),
(27,'::1','habibi@gmail.com',2,'2023-02-10 12:21:53',1),
(28,'::1','azharrizki7834@gmail.com',1,'2023-02-10 12:28:31',1),
(29,'::1','azharrizki7834@gmail.com',1,'2023-02-10 13:51:59',1),
(30,'::1','habibi@gmail.com',2,'2023-02-10 13:52:14',1),
(31,'::1','habibi@gmail.com',2,'2023-02-10 14:13:18',1),
(32,'::1','azharrizki7834@gmail.com',1,'2023-02-10 14:45:53',1),
(33,'::1','habibi@gmail.com',2,'2023-02-10 14:46:46',1),
(34,'::1','bagas@gmail.com',3,'2023-02-10 15:11:28',1),
(35,'::1','azharrizki7834@gmail.com',1,'2023-02-11 03:49:56',1),
(36,'::1','habibi@gmail.com',2,'2023-02-11 03:53:51',1),
(37,'::1','habibi@gmail.com',2,'2023-02-11 07:52:07',1),
(38,'::1','azharrizki7834@gmail.com',1,'2023-02-11 09:59:10',1),
(39,'::1','habibi@gmail.com',2,'2023-02-12 06:59:58',1),
(40,'::1','habibi@gmail.com',2,'2023-02-12 12:18:56',1),
(41,'::1','habibi@gmail.com',2,'2023-02-12 19:20:09',1),
(42,'::1','habibi@gmail.com',2,'2023-02-13 06:09:05',1),
(43,'::1','azharrizki7834@gmail.com',1,'2023-02-13 06:14:37',1),
(44,'::1','habibi@gmail.com',2,'2023-02-13 06:17:06',1),
(45,'::1','azharrizki7834@gmail.com',1,'2023-02-13 06:38:33',1),
(46,'::1','habibi@gmail.com',2,'2023-02-13 06:40:48',1),
(47,'::1','habibi@gmail.com',2,'2023-02-13 10:06:13',1),
(48,'::1','azharrizki',NULL,'2023-02-13 11:55:15',0),
(49,'::1','azharrizki7834@gmail.com',1,'2023-02-13 11:55:22',1),
(50,'::1','gifarizakaria@gmail.com',4,'2023-02-13 13:10:56',1),
(51,'::1','azharrizki7834@gmail.com',1,'2023-02-13 13:15:06',1),
(52,'::1','azharrizki7834@gmail.com',1,'2023-02-15 02:20:49',1),
(53,'::1','habibi@gmail.com',2,'2023-02-15 04:06:05',1),
(54,'::1','azharrizki7834@gmail.com',1,'2023-02-16 08:33:03',1),
(55,'::1','azharrizki7834@gmail.com',1,'2023-02-16 08:42:53',1),
(56,'::1','azharrizki7834@gmail.com',1,'2023-02-16 09:01:01',1),
(57,'::1','azharrizki7834@gmail.com',1,'2023-02-16 09:26:41',1),
(58,'::1','habibiilham',NULL,'2023-02-16 09:54:07',0),
(59,'::1','habibi@gmail.com',2,'2023-02-16 09:54:14',1),
(60,'::1','azharrizki7834@gmail.com',1,'2023-02-16 10:00:02',1),
(61,'::1','bagas@gmail.com',3,'2023-02-16 10:11:24',1),
(62,'::1','azharrizki7834@gmail.com',1,'2023-02-16 10:32:43',1),
(63,'::1','azharrizki7834@gmail.com',1,'2023-02-16 11:08:30',1);

/*Table structure for table `auth_permissions` */

CREATE TABLE `auth_permissions` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `auth_permissions` */

/*Table structure for table `auth_reset_attempts` */

CREATE TABLE `auth_reset_attempts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `auth_reset_attempts` */

/*Table structure for table `auth_tokens` */

CREATE TABLE `auth_tokens` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `selector` varchar(255) NOT NULL,
  `hashedValidator` varchar(255) NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `expires` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `auth_tokens_user_id_foreign` (`user_id`),
  KEY `selector` (`selector`),
  CONSTRAINT `auth_tokens_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `auth_tokens` */

/*Table structure for table `auth_users_permissions` */

CREATE TABLE `auth_users_permissions` (
  `user_id` int(11) unsigned NOT NULL DEFAULT 0,
  `permission_id` int(11) unsigned NOT NULL DEFAULT 0,
  KEY `auth_users_permissions_permission_id_foreign` (`permission_id`),
  KEY `user_id_permission_id` (`user_id`,`permission_id`),
  CONSTRAINT `auth_users_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `auth_users_permissions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `auth_users_permissions` */

/*Table structure for table `banner` */

CREATE TABLE `banner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `meta_text` text DEFAULT NULL,
  `title` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `banner` */

insert  into `banner`(`id`,`meta_text`,`title`,`image`) values 
(3,'Fashion Everyday','Title Paling Baru','1676545474_3e5b9076656fdbb389e5.jpg'),
(4,'Fashion Everyday','Title 2','1676538286_870c1565c43e6f1b3270.jpg'),
(5,'Fashion Everyday','title 3','1676538301_113238723ad5a961aca1.jpg'),
(7,'Fashion Everyday','Banner Lagi','1676545774_37c69b093984f96acfc2.jpg');

/*Table structure for table `barang` */

CREATE TABLE `barang` (
  `id` varchar(11) NOT NULL,
  `nama` varchar(150) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `kategori_id` int(11) DEFAULT NULL,
  `deskripsi` longtext DEFAULT NULL,
  `harga` varchar(100) DEFAULT NULL,
  `stok` varchar(10) DEFAULT NULL,
  `berat` varchar(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `created_by` varchar(10) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_by` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `barang` */

insert  into `barang`(`id`,`nama`,`slug`,`kategori_id`,`deskripsi`,`harga`,`stok`,`berat`,`created_at`,`created_by`,`updated_at`,`updated_by`) values 
('BRG-04852','Tas Kulit Slempang Wanita 2','tas-kulit-slempang-wanita-2',1,'<p>asdsad</p>','500000','100','600','2023-02-16 16:41:09','1','2023-02-16 16:41:09','1'),
('BRG-14279','Tas Kulit Slempang Wanita 5','tas-kulit-slempang-wanita-5',1,'<p>asdsad</p>','230000','95','500','2023-02-16 16:44:22','1','2023-02-16 16:44:22','1'),
('BRG-26083','Tas Kulit Slempang Wanita 4','tas-kulit-slempang-wanita-4',1,'<p>asdsad</p>','150000','100','1000','2023-02-16 16:43:22','1','2023-02-16 16:43:22','1'),
('BRG-30517','Tas Kulit Slempang Wanita 7','tas-kulit-slempang-wanita-7',2,'<p>asdasd</p>','350000','100','500','2023-02-16 16:45:40','1','2023-02-16 16:45:40','1'),
('BRG-47956','Tas Kulit Slempang Wanita 3','tas-kulit-slempang-wanita-3',2,'<p>asdasd</p>','400000','100','500','2023-02-16 16:42:28','1','2023-02-16 16:42:28','1'),
('BRG-52907','Tas Kulit Slempang Wanita 10','tas-kulit-slempang-wanita-10',2,'<p>ASD</p>','310000','94','500','2023-02-16 16:48:10','1','2023-02-16 16:48:10','1'),
('BRG-57069','Tas Kulit Slempang Wanita 11','tas-kulit-slempang-wanita-11',2,'<p>ASDSAD</p>','12000000','92','500','2023-02-16 16:48:35','1','2023-02-16 16:48:35','1'),
('BRG-63701','Tas Kulit Slempang Wanita 9','tas-kulit-slempang-wanita-9',2,'<p>ASDASD</p>','1000000','91','500','2023-02-16 16:47:39','1','2023-02-16 16:47:39','1'),
('BRG-81547','Tas Kulit Slempang Wanita','tas-kulit-slempang-wanita',1,'<p>asdsad</p>','120000','100','500','2023-02-16 16:38:59','1','2023-02-16 16:38:59','1'),
('BRG-83402','Tas Kulit Slempang Wanita 1','tas-kulit-slempang-wanita-1',1,'<p>asdsad</p>','200000','100','600','2023-02-16 16:41:52','1','2023-02-16 16:41:52','1'),
('BRG-86742','Tas Kulit Slempang Wanita 8','tas-kulit-slempang-wanita-8',2,'<p>ASDSA</p>','400000','100','500','2023-02-16 16:46:57','1','2023-02-16 16:46:57','1');

/*Table structure for table `detail_pesanan` */

CREATE TABLE `detail_pesanan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pesanan_id` varchar(11) DEFAULT NULL,
  `barang_id` varchar(11) DEFAULT NULL,
  `jumlah` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;

/*Data for the table `detail_pesanan` */

insert  into `detail_pesanan`(`id`,`pesanan_id`,`barang_id`,`jumlah`) values 
(35,'INV-97205','BRG-57069','4'),
(36,'INV-97205','BRG-14279','5'),
(37,'INV-86593','BRG-57069','4'),
(38,'INV-71935','BRG-52907','6'),
(39,'INV-71935','BRG-63701','9');

/*Table structure for table `gambar` */

CREATE TABLE `gambar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `barang_id` varchar(11) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=90 DEFAULT CHARSET=latin1;

/*Data for the table `gambar` */

insert  into `gambar`(`id`,`barang_id`,`nama`) values 
(78,'BRG-81547','1676540339_7559299b458bd9a0202a.jpg'),
(79,'BRG-04852','1676540469_3c91c4b89ed927c6ed0b.jpg'),
(80,'BRG-83402','1676540512_8562ee765a512c11a4c7.jpg'),
(81,'BRG-47956','1676540548_32ad1e225f0304879246.jpg'),
(82,'BRG-26083','1676540602_eef6a8acf34f3e24270e.jpg'),
(83,'BRG-14279','1676540662_bb3b1f0a1ff5b4e20bb7.jpg'),
(84,'BRG-81273','1676540690_5efce6c1380a70c563b9.jpg'),
(85,'BRG-30517','1676540740_377d35733a49c7403924.jpg'),
(86,'BRG-86742','1676540817_2b13123a72ecdb0ec6e2.jpg'),
(87,'BRG-63701','1676540859_6d975ebc4c0ce08a4415.jpg'),
(88,'BRG-52907','1676540890_298c0cb1c4907a01e8a4.jpg'),
(89,'BRG-57069','1676540915_3be49c4a7ea18e81cd46.jpg');

/*Table structure for table `kategori` */

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `kategori` */

insert  into `kategori`(`id`,`nama`) values 
(1,'Tas Slempang'),
(2,'Tas Tangan');

/*Table structure for table `keranjang` */

CREATE TABLE `keranjang` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `barang_id` varchar(11) DEFAULT NULL,
  `jumlah` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `barang_id` (`barang_id`),
  CONSTRAINT `keranjang_ibfk_1` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

/*Data for the table `keranjang` */

insert  into `keranjang`(`id`,`user_id`,`barang_id`,`jumlah`) values 
(33,2,'BRG-57069',4),
(34,2,'BRG-14279',5),
(36,3,'BRG-52907',6),
(37,3,'BRG-63701',9);

/*Table structure for table `migrations` */

CREATE TABLE `migrations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`version`,`class`,`group`,`namespace`,`time`,`batch`) values 
(1,'2017-11-20-223112','Myth\\Auth\\Database\\Migrations\\CreateAuthTables','default','Myth\\Auth',1675771376,1);

/*Table structure for table `pembayaran` */

CREATE TABLE `pembayaran` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT NULL,
  `rekening` varchar(255) DEFAULT NULL,
  `no_rekening` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `pembayaran` */

insert  into `pembayaran`(`id`,`nama`,`rekening`,`no_rekening`) values 
(1,'Habibi Nur Ilham','BRI','21331232');

/*Table structure for table `pesanan` */

CREATE TABLE `pesanan` (
  `id` varchar(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total` varchar(200) NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `create_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `pesanan` */

insert  into `pesanan`(`id`,`user_id`,`total`,`alamat`,`no_telp`,`create_at`) values 
('INV-86593',3,'48044000','Gejagan RT 02/RW 12, Gemblegan, Kalikotes, Klaten, Jawa Tengah 57451','089634815186','2023-02-16 17:12:04'),
('INV-97205',2,'49245000','Gejagan RT 02/RW 12, Gemblegan, Kalikotes, Klaten, Jawa Tengah 57451','089634815186','2023-02-16 16:55:37');

/*Table structure for table `users` */

CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `user_image` varchar(255) NOT NULL DEFAULT 'default.jpg',
  `password_hash` varchar(255) NOT NULL,
  `reset_hash` varchar(255) DEFAULT NULL,
  `reset_at` datetime DEFAULT NULL,
  `reset_expires` datetime DEFAULT NULL,
  `activate_hash` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `status_message` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `force_pass_reset` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `users` */

insert  into `users`(`id`,`email`,`username`,`fullname`,`user_image`,`password_hash`,`reset_hash`,`reset_at`,`reset_expires`,`activate_hash`,`status`,`status_message`,`active`,`force_pass_reset`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'azharrizki7834@gmail.com','azharrizki',NULL,'default.jpg','$2y$10$G6RxsB4NmYIDAGSABhxGv.oud0asAfmqdvroKXOeGLySu/PPLm9S.',NULL,NULL,NULL,NULL,NULL,NULL,1,0,'2023-02-07 13:43:33','2023-02-07 13:43:33',NULL),
(2,'habibi@gmail.com','habibiilham',NULL,'default.jpg','$2y$10$huDa3c4ZQeJ/36GbBrdf0Oums2SvY8go5k8oEyLgwjSGJsI3DigKO',NULL,NULL,NULL,NULL,NULL,NULL,1,0,'2023-02-07 14:28:45','2023-02-07 14:28:45',NULL),
(3,'bagas@gmail.com','bagas31',NULL,'default.jpg','$2y$10$7TYUfnLmYA9XDip9FXxbb.TwZMExWJG3KU49ptaKKWSA1LcoG6xEK',NULL,NULL,NULL,NULL,NULL,NULL,1,0,'2023-02-10 15:11:18','2023-02-10 15:11:18',NULL),
(4,'gifarizakaria@gmail.com','gifarizakaria',NULL,'default.jpg','$2y$10$y6wJVmAASoa9frJfcrv1.eX2/zYca9uMLYX0U1dDKrsMycxz7quHa',NULL,NULL,NULL,NULL,NULL,NULL,1,0,'2023-02-13 13:10:49','2023-02-13 13:10:49',NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
