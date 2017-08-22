/*
SQLyog Ultimate v12.09 (64 bit)
MySQL - 10.1.25-MariaDB : Database - jobseeker
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`jobseeker` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `jobseeker`;

/*Table structure for table `address` */

DROP TABLE IF EXISTS `address`;

CREATE TABLE `address` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` tinyint(2) NOT NULL,
  `country` int(11) NOT NULL,
  `state` int(11) DEFAULT NULL,
  `district` int(11) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `street_1` varchar(100) NOT NULL,
  `street_2` varchar(100) DEFAULT NULL,
  `postcode` varchar(50) DEFAULT NULL,
  `is_deleted` char(1) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `address` */

/*Table structure for table `company_profile` */

DROP TABLE IF EXISTS `company_profile`;

CREATE TABLE `company_profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `address_id` int(11) NOT NULL,
  `profile_pic_id` int(11) NOT NULL,
  `company_name` varchar(100) NOT NULL,
  `registration_no` varchar(100) NOT NULL,
  `mobile_no` varchar(50) DEFAULT NULL,
  `office_no` varchar(50) DEFAULT NULL,
  `description` varchar(1024) DEFAULT NULL,
  `is_deleted` char(1) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tbl_company_profile_tbl_user` (`user_id`),
  KEY `fk_tbl_company_profile_tbl_address` (`address_id`),
  CONSTRAINT `fk_tbl_company_profile_tbl_address` FOREIGN KEY (`address_id`) REFERENCES `address` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_company_profile_tbl_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `company_profile` */

/*Table structure for table `job_list` */

DROP TABLE IF EXISTS `job_list`;

CREATE TABLE `job_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `position` varchar(100) NOT NULL,
  `description` varchar(1024) DEFAULT NULL,
  `is_deleted` char(1) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tbl_job_list_tbl_company_profile` (`company_id`),
  CONSTRAINT `fk_tbl_job_list_tbl_company_profile` FOREIGN KEY (`company_id`) REFERENCES `company_profile` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `job_list` */

/*Table structure for table `job_list_skills` */

DROP TABLE IF EXISTS `job_list_skills`;

CREATE TABLE `job_list_skills` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `job_list_id` int(11) NOT NULL,
  `skills_name` varchar(100) NOT NULL,
  `description` varchar(1024) DEFAULT NULL,
  `is_deleted` char(1) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tbl_job_list_skills_tbl_job_list` (`job_list_id`),
  CONSTRAINT `fk_tbl_job_list_skills_tbl_job_list` FOREIGN KEY (`job_list_id`) REFERENCES `job_list` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `job_list_skills` */

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `password_hash` varchar(255) DEFAULT NULL,
  `password_reset_token` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `auth_key` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `is_deleted` char(1) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `user` */

insert  into `user`(`id`,`username`,`password`,`password_hash`,`password_reset_token`,`email`,`auth_key`,`status`,`is_deleted`,`created_at`,`created_by`,`updated_at`,`updated_by`,`deleted_at`,`deleted_by`) values (1,'admin',NULL,'$2y$13$LAx5RBEFpEyUy7oaBRP5LeILAdkltUiJgBbPpij4iCjaBCAwF4N8u',NULL,'admin@jobseeker.com.my','xEe_iCbTL60L9Gq6Eba7IJp6ju7QH092',10,'0','0000-00-00 00:00:00',NULL,'0000-00-00 00:00:00',NULL,NULL,NULL);

/*Table structure for table `user_profile` */

DROP TABLE IF EXISTS `user_profile`;

CREATE TABLE `user_profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `address_id` int(11) NOT NULL,
  `profile_pic_id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `mobile_no` varchar(50) DEFAULT NULL,
  `home_no` varchar(50) DEFAULT NULL,
  `description` varchar(1024) DEFAULT NULL,
  `is_deleted` char(1) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tbl_user_profile_tbl_user` (`user_id`),
  KEY `fk_tbl_user_profile_tbl_address` (`address_id`),
  CONSTRAINT `fk_tbl_user_profile_tbl_address` FOREIGN KEY (`address_id`) REFERENCES `address` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_user_profile_tbl_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `user_profile` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
