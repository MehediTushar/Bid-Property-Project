/*
SQLyog Community v13.1.9 (64 bit)
MySQL - 10.4.24-MariaDB : Database - property_bidding_system
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`property_bidding_system` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `property_bidding_system`;

/*Table structure for table `bids` */

DROP TABLE IF EXISTS `bids`;

CREATE TABLE `bids` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `property_id` bigint(20) unsigned NOT NULL,
  `amount` decimal(15,2) DEFAULT NULL,
  `bid_time` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `property_id` (`property_id`),
  CONSTRAINT `bids_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `bids_ibfk_2` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*Data for the table `bids` */

insert  into `bids`(`id`,`user_id`,`property_id`,`amount`,`bid_time`,`created_at`) values 
(1,1,1,80000.00,'2024-08-18 16:31:37','2024-08-18 16:31:37'),
(2,1,1,900000.00,'2024-08-18 17:24:35','2024-08-18 17:24:35'),
(3,1,1,2000000.00,'2024-08-18 17:30:28','2024-08-18 17:30:28');

/*Table structure for table `properties` */

DROP TABLE IF EXISTS `properties`;

CREATE TABLE `properties` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `price` decimal(15,2) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `highest_bidder` bigint(20) unsigned DEFAULT NULL,
  `highest_bid` decimal(15,2) DEFAULT NULL,
  `p_type` varchar(50) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `properties_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*Data for the table `properties` */

insert  into `properties`(`id`,`title`,`description`,`image`,`price`,`location`,`user_id`,`highest_bidder`,`highest_bid`,`p_type`,`status`,`created_at`) values 
(1,'apartment sell','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has su','66c19ca5293b7.jpg',400000.00,'dhaka bangladesh',2,1,2000000.00,'apartment',1,'2024-08-18 12:37:40'),
(2,'new flat sell','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has su','66c19bdc424d5.jpg',400000.00,'dhaka bangladesh',2,NULL,NULL,'flat',1,'2024-08-18 12:59:40'),
(3,'buiding sell','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has su','66c19ca5293b7.jpg',10000000.00,'dhaka, bangladesh',2,NULL,NULL,'building',1,'2024-08-18 13:03:01');

/*Table structure for table `role` */

DROP TABLE IF EXISTS `role`;

CREATE TABLE `role` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `role_name` varchar(255) DEFAULT NULL,
  `permission_name` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*Data for the table `role` */

insert  into `role`(`id`,`role_name`,`permission_name`,`status`,`created_at`) values 
(1,'admin',NULL,7,NULL),
(2,'bidder',NULL,7,NULL),
(3,'property_owner',NULL,7,NULL);

/*Table structure for table `services` */

DROP TABLE IF EXISTS `services`;

CREATE TABLE `services` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(20) DEFAULT NULL,
  `description` varchar(20) DEFAULT NULL,
  `image` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `services` */

insert  into `services`(`id`,`title`,`description`,`image`) values 
(1,'rental service','.\r\n\r\nWhy do we use i','66c1f6c4ac168.jpg');

/*Table structure for table `teams_members` */

DROP TABLE IF EXISTS `teams_members`;

CREATE TABLE `teams_members` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `contact` int(20) DEFAULT NULL,
  `role` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `teams_members` */

insert  into `teams_members`(`id`,`name`,`contact`,`role`,`image`) values 
(1,'Mehedi Hasan',2147483647,'Developer','66c1f342876a4.jpg'),
(2,'Mehedi Hasan',2147483647,'Developer','66c1f342876a4.jpg');

/*Table structure for table `testimonials` */

DROP TABLE IF EXISTS `testimonials`;

CREATE TABLE `testimonials` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `property_id` bigint(20) unsigned NOT NULL,
  `rating` int(11) DEFAULT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `property_id` (`property_id`),
  CONSTRAINT `testimonials_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `testimonials_ibfk_2` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*Data for the table `testimonials` */

insert  into `testimonials`(`id`,`user_id`,`property_id`,`rating`,`comment`,`created_at`) values 
(3,1,1,3,'hjhjh',NULL);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `phone` int(15) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `role_id` int(11) unsigned NOT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `role_id` (`role_id`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*Data for the table `users` */

insert  into `users`(`id`,`user_name`,`email`,`password`,`phone`,`address`,`role_id`,`created_at`) values 
(1,'mehedi hasan','hasan@gmail.com','$2y$10$WojYn/5vHSTZ0sir.AMIou72iHg0C5RZa12K52EazVLLoHL7HN./u',1847347882,'House:145, Suite:604, 5th Floor Road:03, Block:A, Niketon Gulshan-1, Dhaka-1212',2,NULL),
(2,'mehedi','mehedi@gmail.com','$2y$10$sY6ZhgKPH7acy2uyUY3.zuLYXCjgv8cT2yJiE0GbrRCH1yOmwA.3G',1849498957,'House:145, Suite:604, 5th Floor Road:03, Block:A, Niketon Gulshan-1, Dhaka-1212',3,NULL),
(3,'admin','admin@gmail.com','$2y$10$v1X/KxmECEwmNtGUkUAqr.zSbNowyifZt5XFKf.aMnjSPqVAq0No6',1849498957,'House:145, Suite:604, 5th Floor Road:03, Block:A, Niketon Gulshan-1, Dhaka-1212',1,NULL),
(4,'MyAccount','myaccount@gmail.com','$2y$10$2bLIFxxUKujWHntWUvf9R.0iLkCnV/sE0tgD.oyD5fUkUtRlsEL.u',1849498957,'House:145, Suite:604, 5th Floor Road:03, Block:A, Niketon Gulshan-1, Dhaka-1212',3,NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
