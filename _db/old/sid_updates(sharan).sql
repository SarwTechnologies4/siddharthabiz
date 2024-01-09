ALTER TABLE `tbl_apihotel` ADD `hotel_code` VARCHAR(255) NOT NULL AFTER `prop_code`;


/*2023-11-19*/
ALTER TABLE `tbl_users` ADD `physicalcard` INT(11) NOT NULL AFTER `gender`;



/*2023-11-29*/
ALTER TABLE `tbl_points` ADD `billamt` INT NOT NULL AFTER `particulars`;

/*2023-11-30*/
ALTER TABLE `tbl_points` ADD `correction` INT NOT NULL AFTER `status`;

/*2023-12-1 */
ALTER TABLE `tbl_pricerange` ADD `pkgtype` INT NOT NULL AFTER `description`;

ALTER TABLE `tbl_points` ADD `pkgtype` INT NOT NULL AFTER `billamt`;


/*2023-12-12*/
ALTER TABLE `tbl_apihotel` ADD `detail_image` VARCHAR(250) NOT NULL AFTER `home_image`;



