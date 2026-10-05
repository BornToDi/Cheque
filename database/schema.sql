/*M!999999\- enable the sandbox mode */

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
DROP TABLE IF EXISTS `aibl_branch`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `aibl_branch` (
  `branch_id` int(10) NOT NULL AUTO_INCREMENT,
  `branch_code` varchar(100) NOT NULL,
  `routing_no` varchar(100) NOT NULL,
  `branch_name` varchar(100) NOT NULL,
  `branch_address` varchar(250) NOT NULL,
  `branch_email` varchar(100) NOT NULL,
  PRIMARY KEY (`branch_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `aibl_chq_rqst`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `aibl_chq_rqst` (
  `rqst_id` int(100) NOT NULL AUTO_INCREMENT,
  `rqst_id_aibl` int(100) NOT NULL,
  `account_no` varchar(100) NOT NULL,
  `start_no` varchar(100) NOT NULL,
  `total_leaf` int(20) NOT NULL,
  `end_no` varchar(100) NOT NULL,
  `micr` varchar(100) NOT NULL,
  `routing_no` varchar(100) NOT NULL,
  `tran_code` varchar(50) NOT NULL,
  `cus_name` varchar(255) NOT NULL,
  `ac_type` varchar(50) NOT NULL,
  `rqst_branch` varchar(100) NOT NULL,
  `severity` varchar(100) NOT NULL,
  `rqst_status` varchar(100) NOT NULL,
  `rqst_branch_code` varchar(100) NOT NULL DEFAULT '',
  `rqst_by` varchar(100) NOT NULL,
  `approve_by` varchar(100) NOT NULL,
  `approval_date_time` varchar(100) NOT NULL,
  `file_name` varchar(100) NOT NULL,
  `stock_code` varchar(100) NOT NULL,
  `collecting_branch` varchar(100) NOT NULL DEFAULT '',
  `collecting_branch_code` varchar(100) NOT NULL,
  `rqst_date` date NOT NULL DEFAULT '0000-00-00',
  `cus_address` varchar(200) NOT NULL DEFAULT '',
  `ac_no_branch` varchar(100) NOT NULL DEFAULT '',
  `ac_no_cus_no` varchar(100) NOT NULL DEFAULT '',
  `ac_no_suffix` varchar(100) NOT NULL DEFAULT '',
  `books` int(10) NOT NULL,
  `order_date_time` datetime /* mariadb-5.3 */ NOT NULL DEFAULT '0000-00-00 00:00:00',
  `dispatch_datetime` datetime /* mariadb-5.3 */ NOT NULL DEFAULT '0000-00-00 00:00:00',
  `delivered_datetime` datetime /* mariadb-5.3 */ NOT NULL,
  `remarks` varchar(200) NOT NULL DEFAULT '',
  PRIMARY KEY (`rqst_id`),
  KEY `rqst_id` (`rqst_id`),
  KEY `start_no` (`start_no`),
  KEY `end_no` (`end_no`),
  KEY `account_no` (`account_no`),
  KEY `rqst_branch_code` (`rqst_branch_code`),
  KEY `collecting_branch_code` (`collecting_branch_code`),
  KEY `collecting_branch` (`collecting_branch`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `aibl_login`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `aibl_login` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(50) NOT NULL DEFAULT '',
  `pass` varchar(255) NOT NULL DEFAULT '',
  `branch_code` varchar(100) DEFAULT NULL,
  `branch_name` varchar(50) NOT NULL DEFAULT '',
  `branch_user_name` varchar(50) NOT NULL DEFAULT '',
  `user_email` varchar(50) NOT NULL,
  `active` int(2) NOT NULL DEFAULT 0,
  `user_type` varchar(50) NOT NULL DEFAULT '',
  `user_create_by` varchar(100) NOT NULL,
  `user_modified_by` varchar(100) NOT NULL,
  `user_create_date` datetime /* mariadb-5.3 */ NOT NULL,
  `user_modified_date` datetime /* mariadb-5.3 */ NOT NULL,
  `flag` int(1) NOT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `aibl_others_rqst`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `aibl_others_rqst` (
  `others_rqst_id` int(100) NOT NULL AUTO_INCREMENT,
  `others_account_no` varchar(100) NOT NULL,
  `others_start_no` varchar(100) NOT NULL,
  `others_total_leaf` int(20) NOT NULL,
  `others_end_no` varchar(100) NOT NULL,
  `others_micr` varchar(100) NOT NULL,
  `others_routing_no` varchar(100) NOT NULL,
  `others_tran_code` varchar(50) NOT NULL,
  `others_cus_name` varchar(255) NOT NULL,
  `item_type` varchar(50) NOT NULL,
  `others_rqst_branch` varchar(100) NOT NULL,
  `others_severity` varchar(100) NOT NULL,
  `others_rqst_status` varchar(100) NOT NULL,
  `others_rqst_branch_code` varchar(100) NOT NULL,
  `others_rqst_by` varchar(100) NOT NULL,
  `others_approve_by` varchar(100) NOT NULL,
  `others_approval_date_time` varchar(100) NOT NULL,
  `file_name` varchar(100) NOT NULL,
  `stock_code` varchar(100) NOT NULL,
  `others_collecting_branch` varchar(100) NOT NULL,
  `others_collecting_branch_code` varchar(100) NOT NULL,
  `others_rqst_date` date NOT NULL DEFAULT '0000-00-00',
  `others_cus_address` varchar(200) NOT NULL,
  `others_ac_no_branch` varchar(100) NOT NULL,
  `others_ac_no_cus_no` varchar(100) NOT NULL,
  `others_ac_no_suffix` varchar(100) NOT NULL,
  `others_books` int(10) NOT NULL,
  `others_order_date_time` datetime /* mariadb-5.3 */ NOT NULL DEFAULT '0000-00-00 00:00:00',
  `others_dispatch_datetime` datetime /* mariadb-5.3 */ NOT NULL DEFAULT '0000-00-00 00:00:00',
  `others_delivered_datetime` datetime /* mariadb-5.3 */ NOT NULL,
  `others_remarks` varchar(200) NOT NULL,
  PRIMARY KEY (`others_rqst_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `aibl_product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `aibl_product` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `pro_name` varchar(100) NOT NULL,
  `pro_sort_name` varchar(100) NOT NULL,
  `pro_code` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `challan_no`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `challan_no` (
  `challan_no_id` int(100) NOT NULL AUTO_INCREMENT,
  `challan_no` varchar(255) NOT NULL,
  `pre_set_date` date NOT NULL,
  `cur_set_date` date NOT NULL,
  PRIMARY KEY (`challan_no_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `del_challan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `del_challan` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `challan_no` int(100) NOT NULL,
  `branch_code` varchar(255) NOT NULL,
  `branch_name` varchar(255) NOT NULL,
  `challan_date` date NOT NULL,
  `c_branch_code` varchar(50) NOT NULL,
  `c_branch_name` varchar(50) NOT NULL,
  `sb` varchar(100) NOT NULL,
  `sb_25` varchar(100) NOT NULL,
  `cd_25` varchar(100) NOT NULL,
  `cd_50` varchar(100) NOT NULL,
  `cd_100` varchar(100) NOT NULL,
  `po` varchar(100) NOT NULL,
  `dd` varchar(100) NOT NULL,
  `fdd` varchar(100) NOT NULL,
  `fdr` varchar(100) NOT NULL,
  `sdr` varchar(100) NOT NULL,
  `total` varchar(100) NOT NULL,
  `priority` varchar(100) NOT NULL,
  `p_sb` varchar(100) NOT NULL,
  `p_sb_25` varchar(100) NOT NULL,
  `p_cd_25` varchar(100) NOT NULL,
  `p_cd_50` varchar(100) NOT NULL,
  `p_cd_100` varchar(100) NOT NULL,
  `p_po` varchar(100) NOT NULL,
  `p_dd` varchar(100) NOT NULL,
  `p_fdd` varchar(100) NOT NULL,
  `p_fdr` varchar(100) NOT NULL,
  `p_sdr` varchar(100) NOT NULL,
  `last_sl_no` varchar(255) NOT NULL,
  `product_type` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `net_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `net_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(200) NOT NULL DEFAULT '',
  `user_fullname` varchar(50) NOT NULL DEFAULT '',
  `user_pass` varchar(200) NOT NULL DEFAULT '',
  `active` int(4) NOT NULL,
  `user_type` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `serial_no`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `serial_no` (
  `serial_id` int(100) NOT NULL AUTO_INCREMENT,
  `start_no` varchar(255) NOT NULL,
  `end_no` varchar(255) NOT NULL,
  `ac_type` varchar(100) NOT NULL,
  `set_date` date NOT NULL,
  PRIMARY KEY (`serial_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
