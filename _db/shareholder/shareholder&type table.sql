
DROP TABLE IF EXISTS `tbl_shareholders`;

CREATE TABLE `tbl_shareholders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `internal_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `gender` tinytext NOT NULL,
  `citizenship` varchar(255) NOT NULL,
  `citizenship_district` varchar(255) NOT NULL,
  `citizenship_issue_date` date NOT NULL,
  `father` varchar(255) NOT NULL,
  `grand_father` varchar(255) NOT NULL,
  `mother` varchar(255) NOT NULL,
  `spouse` varchar(255) NOT NULL,
  `nominee` varchar(255) NOT NULL,
  `nominee_citizenship` varchar(255) NOT NULL,
  `nominee_relationship` varchar(255) NOT NULL,
  `type_id` int(11) NOT NULL,
  `permanent_address` text NOT NULL,
  `temporary_address` text NOT NULL,
  `changed_address` text NOT NULL,
  `pan_number` varchar(255) DEFAULT NULL,
  `bank` varchar(255) DEFAULT NULL,
  `bank_account` varchar(255) DEFAULT NULL,
  `bank_branch` varchar(255) DEFAULT NULL,
  `bank_account_name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `terminated_date` date DEFAULT NULL,
  `terminated_amount` decimal(10,2) DEFAULT NULL,
  `citizenship_image` varchar(255) DEFAULT NULL,
  `pan_image` varchar(255) DEFAULT NULL,
  `license_image` varchar(255) DEFAULT NULL,
  `pp_image` varchar(255) DEFAULT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `company_address` varchar(255) DEFAULT NULL,
  `company_pan` varchar(255) DEFAULT NULL,
  `company_image` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `sortorder` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `list_image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


/*Table structure for table `tbl_shareholders_type` */

DROP TABLE IF EXISTS `tbl_shareholders_type`;

CREATE TABLE `tbl_shareholders_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `sortorder` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tbl_shareholders_type` */

insert  into `tbl_shareholders_type`(`id`,`title`,`status`,`sortorder`) values (1,'BOD',1,1),(2,'Active Shareholder',1,1),(3,'Silence Shareholder',1,1);
