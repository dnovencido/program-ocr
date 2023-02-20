/*
SQLyog Community v13.2.0 (64 bit)
MySQL - 10.1.40-MariaDB : Database - projdb
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`projdb` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `projdb`;

/*Table structure for table `tbl_trace` */

DROP TABLE IF EXISTS `tbl_trace`;

CREATE TABLE `tbl_trace` (
  `trailid` int(11) NOT NULL AUTO_INCREMENT,
  `uname` varchar(15) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `action` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`trailid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_trace` */

/*Table structure for table `tbl_transaction` */

DROP TABLE IF EXISTS `tbl_transaction`;

CREATE TABLE `tbl_transaction` (
  `tranID` int(11) NOT NULL AUTO_INCREMENT,
  `refnum` varchar(15) DEFAULT NULL,
  `number` int(12) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `name` varchar(20) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  PRIMARY KEY (`tranID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_transaction` */

insert  into `tbl_transaction`(`tranID`,`refnum`,`number`,`amount`,`name`,`date`,`time`) values 
(1,'567',NULL,NULL,NULL,NULL,NULL),
(2,'456',NULL,NULL,NULL,NULL,NULL),
(3,'5676587',NULL,NULL,NULL,NULL,NULL),
(4,'587689',NULL,NULL,NULL,NULL,NULL);

/*Table structure for table `tbl_user` */

DROP TABLE IF EXISTS `tbl_user`;

CREATE TABLE `tbl_user` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `uname` varchar(10) DEFAULT NULL,
  `pass` varchar(10) DEFAULT NULL,
  `lname` varchar(15) DEFAULT NULL,
  `fname` varchar(15) DEFAULT NULL,
  `entry_date` date DEFAULT NULL,
  `position` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_user` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
