/*
SQLyog Ultimate v12.4.1 (64 bit)
MySQL - 10.1.31-MariaDB : Database - db_praktikum_prognet
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_praktikum_prognet` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `db_praktikum_prognet`;

/*Table structure for table `admin_notifications` */

CREATE TABLE `admin_notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` int(10) unsigned NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `seller_notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`),
  KEY `notifiable_id` (`notifiable_id`),
  CONSTRAINT `admin_notifications_ibfk_1` FOREIGN KEY (`notifiable_id`) REFERENCES `admins` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `admin_notifications` */

/*Table structure for table `admins` */

CREATE TABLE `admins` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sellers_email_unique` (`phone`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `admins` */

insert  into `admins`(`id`,`username`,`password`,`name`,`profile_image`,`phone`,`remember_token`,`created_at`,`updated_at`) values 
(1,'widiana','$2y$10$5KsP6bCJLHE7NK4wUgGcx.ltZSRfpi51mAF4evU.d26PZB7VG5qYq','widi','widi','082146456432',NULL,'2019-05-05 12:06:13','2019-05-05 12:06:13');

/*Table structure for table `carts` */

CREATE TABLE `carts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `product_id` int(10) unsigned NOT NULL,
  `qty` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('checkedout','notyet','cancelled') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `carts_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  CONSTRAINT `carts_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `carts` */

insert  into `carts`(`id`,`user_id`,`product_id`,`qty`,`created_at`,`updated_at`,`status`,`deleted_at`) values 
(7,1,3,1,'2019-05-13 03:19:48','2019-05-13 03:21:26','notyet','2019-05-13 03:21:26'),
(8,1,3,1,'2019-05-13 03:21:37','2019-05-13 03:22:05','notyet','2019-05-13 03:22:05'),
(9,1,3,1,'2019-05-13 03:23:19','2019-05-14 11:09:19','checkedout',NULL),
(10,1,4,1,'2019-05-14 10:18:39','2019-05-14 10:48:58','notyet','2019-05-14 10:48:58'),
(11,1,4,2,'2019-05-14 10:49:27','2019-05-14 11:09:19','checkedout',NULL),
(12,2,3,1,'2019-05-14 11:30:46','2019-05-14 11:31:54','checkedout',NULL),
(13,1,4,1,'2019-05-20 01:56:35','2019-05-20 02:05:08','checkedout',NULL),
(14,1,3,1,'2019-05-20 01:59:25','2019-05-20 02:05:08','checkedout',NULL),
(15,1,4,2,'2019-05-20 02:07:47','2019-05-20 02:10:22','checkedout',NULL),
(16,1,3,1,'2019-05-20 03:05:24','2019-05-20 14:21:20','checkedout',NULL),
(17,1,4,1,'2019-05-20 14:20:06','2019-05-20 14:21:20','checkedout',NULL),
(18,1,4,1,'2019-05-20 14:22:23','2019-05-20 14:22:23','notyet',NULL);

/*Table structure for table `couriers` */

CREATE TABLE `couriers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `courier` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `couriers` */

insert  into `couriers`(`id`,`courier`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'JNE','2019-05-05 12:15:27','2019-05-05 12:48:00','2019-05-05 12:48:00'),
(2,'tiki','2019-05-05 12:15:39','2019-05-05 12:15:39',NULL),
(3,'pos','2019-05-05 12:15:47','2019-05-05 12:15:47',NULL),
(4,'jne','2019-05-05 12:48:09','2019-05-05 12:48:09',NULL);

/*Table structure for table `discounts` */

CREATE TABLE `discounts` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_product` int(10) unsigned DEFAULT NULL,
  `percentage` int(3) DEFAULT NULL,
  `start` date DEFAULT NULL,
  `end` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_product` (`id_product`),
  CONSTRAINT `discounts_ibfk_1` FOREIGN KEY (`id_product`) REFERENCES `products` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `discounts` */

insert  into `discounts`(`id`,`id_product`,`percentage`,`start`,`end`,`created_at`,`updated_at`) values 
(4,4,10,'2019-05-14','2019-06-14','2019-05-14 10:17:58','2019-05-14 10:17:58');

/*Table structure for table `migrations` */

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(3,'2014_10_12_000000_create_users_table',2),
(2,'2014_10_12_100000_create_password_resets_table',1),
(8,'2018_10_20_040609_create_categories_table',3),
(9,'2018_10_24_075802_create_products_table',4),
(10,'2018_11_08_024109_create_product_att_table',5),
(11,'2018_11_20_055123_create_tblgallery_table',6),
(12,'2018_11_26_070031_create_cart_table',7),
(13,'2018_11_28_072535_create_coupons_table',8),
(15,'2018_12_01_042342_create_countries_table',10),
(19,'2018_12_03_043804_add_more_fields_to_users_table',14),
(17,'2018_12_03_093548_create_delivery_address_table',12),
(18,'2018_12_05_024718_create_orders_table',13);

/*Table structure for table `password_resets` */

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `product_categories` */

CREATE TABLE `product_categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `category_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `product_categories` */

insert  into `product_categories`(`id`,`parent_id`,`category_name`,`created_at`,`updated_at`,`deleted_at`) values 
(1,0,'Fashion Pria','2019-05-05 12:07:01','2019-05-05 12:07:01',NULL),
(2,1,'Baju Pria','2019-05-05 12:07:16','2019-05-05 12:07:16',NULL),
(3,1,'Celana Pria','2019-05-05 12:49:08','2019-05-13 03:53:13','2019-05-13 03:53:13'),
(4,1,'Topi Pria','2019-05-05 12:49:53','2019-05-13 03:47:11','2019-05-13 03:47:11'),
(5,1,'Fashion Wanita','2019-05-13 03:26:31','2019-05-13 03:46:53','2019-05-13 03:46:53'),
(6,0,'Fashion Anak','2019-05-13 03:46:48','2019-05-13 03:51:37','2019-05-13 03:51:37');

/*Table structure for table `product_category_details` */

CREATE TABLE `product_category_details` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(10) unsigned NOT NULL,
  `category_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `product_category_details_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  CONSTRAINT `product_category_details_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `product_categories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `product_category_details` */

insert  into `product_category_details`(`id`,`product_id`,`category_id`,`created_at`,`updated_at`,`deleted_at`) values 
(9,3,2,'2019-05-14 19:29:19','0000-00-00 00:00:00',NULL),
(10,4,2,'2019-05-14 19:29:21','0000-00-00 00:00:00',NULL);

/*Table structure for table `product_images` */

CREATE TABLE `product_images` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(10) unsigned NOT NULL,
  `image_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `product_images_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `product_images` */

insert  into `product_images`(`id`,`product_id`,`image_name`,`created_at`,`updated_at`) values 
(4,3,'facebook-f-letter-logo-logotype-256.png','2019-05-13 03:19:13','2019-05-13 03:19:13'),
(6,4,'download.png','2019-05-14 10:18:01','2019-05-14 10:18:01');

/*Table structure for table `product_reviews` */

CREATE TABLE `product_reviews` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `rate` int(1) NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `rate_id` (`rate`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `product_reviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `product_reviews_ibfk_3` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `product_reviews` */

/*Table structure for table `products` */

CREATE TABLE `products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_rate` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `stock` int(10) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `products` */

insert  into `products`(`id`,`product_name`,`price`,`description`,`product_rate`,`created_at`,`updated_at`,`stock`,`deleted_at`) values 
(3,'Baju Facebook',100000,'Baju Facebook',NULL,'2019-05-13 03:19:11','2019-05-13 03:19:11',12,NULL),
(4,'Baju Line',100000,'Baju Line',NULL,'2019-05-14 10:17:58','2019-05-14 10:17:58',12,NULL);

/*Table structure for table `response` */

CREATE TABLE `response` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `review_id` int(10) unsigned NOT NULL,
  `admin_id` int(10) unsigned NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `review_id` (`review_id`),
  KEY `admin_id` (`admin_id`),
  CONSTRAINT `response_ibfk_1` FOREIGN KEY (`review_id`) REFERENCES `product_reviews` (`id`),
  CONSTRAINT `response_ibfk_2` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `response` */

/*Table structure for table `transaction_details` */

CREATE TABLE `transaction_details` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `transaction_id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  `qty` int(11) NOT NULL,
  `discount` int(3) DEFAULT NULL,
  `selling_price` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_transaction` (`transaction_id`),
  KEY `id_product` (`product_id`),
  CONSTRAINT `transaction_details_ibfk_1` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`),
  CONSTRAINT `transaction_details_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `transaction_details` */

insert  into `transaction_details`(`id`,`transaction_id`,`product_id`,`qty`,`discount`,`selling_price`,`created_at`,`updated_at`) values 
(15,13,3,1,NULL,100000,'2019-05-20 14:21:20','2019-05-20 14:21:20'),
(16,13,4,1,10,90000,'2019-05-20 14:21:20','2019-05-20 14:21:20');

/*Table structure for table `transactions` */

CREATE TABLE `transactions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `timeout` datetime NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `regency` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `province` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total` double(12,2) NOT NULL,
  `shipping_cost` double(12,2) NOT NULL,
  `sub_total` double(12,2) NOT NULL,
  `user_id` int(20) unsigned NOT NULL,
  `courier_id` int(10) unsigned NOT NULL,
  `proof_of_payment` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('unverified','verified','delivered','success','expired') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `courier_id` (`courier_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`courier_id`) REFERENCES `couriers` (`id`),
  CONSTRAINT `transactions_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `transactions` */

insert  into `transactions`(`id`,`timeout`,`address`,`regency`,`province`,`total`,`shipping_cost`,`sub_total`,`user_id`,`courier_id`,`proof_of_payment`,`created_at`,`updated_at`,`status`) values 
(13,'2019-05-23 14:21:20','123','Aceh Besar','Nanggroe Aceh Darussalam (NAD)',234000.00,44000.00,190000.00,1,3,NULL,'2019-05-20 14:21:20','2019-05-20 14:21:20','unverified');

/*Table structure for table `user_notifications` */

CREATE TABLE `user_notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` int(11) unsigned NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`),
  KEY `notifiable_id` (`notifiable_id`),
  CONSTRAINT `user_notifications_ibfk_1` FOREIGN KEY (`notifiable_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `user_notifications` */

/*Table structure for table `users` */

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`profile_image`,`status`,`email_verified_at`,`password`,`remember_token`,`created_at`,`updated_at`) values 
(1,'widiana','widianaputraa@gmail.com','NULL','NULL','2019-05-05 12:04:21','$2y$10$fSvZoNT1bXbAKxdH1D.OBedAIw2bITZR43K8CysO50PiktFr70PNa',NULL,'2019-05-05 12:04:08','2019-05-05 12:04:21'),
(2,'widianaputra','widianaputraa1@gmail.com','NULL','NULL','2019-05-14 11:30:36','$2y$10$SEBrUIVv/tsyPAYlOh7VluDzcCPFEfnLUdIw4Iju3snC6F9zWq63m',NULL,'2019-05-14 11:30:20','2019-05-14 11:30:36');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
