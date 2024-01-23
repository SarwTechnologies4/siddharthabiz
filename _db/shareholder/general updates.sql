UPDATE `tbl_group_type` SET `permission` = 'a:54:{i:0;s:2:\"74\";i:1;s:3:\"401\";i:2;s:1:\"1\";i:3;s:2:\"45\";i:4;s:2:\"44\";i:5;s:2:\"96\";i:6;s:2:\"86\";i:7;s:2:\"85\";i:8;s:2:\"62\";i:9;s:2:\"34\";i:10;s:2:\"33\";i:11;s:2:\"60\";i:12;s:2:\"75\";i:13;s:2:\"46\";i:14;s:2:\"59\";i:15;s:2:\"61\";i:16;s:2:\"51\";i:17;s:2:\"56\";i:18;s:2:\"53\";i:19;s:2:\"52\";i:20;s:2:\"95\";i:21;s:2:\"90\";i:22;s:3:\"200\";i:23;s:2:\"87\";i:24;s:2:\"89\";i:25;s:2:\"88\";i:26;s:2:\"50\";i:27;s:2:\"49\";i:28;s:2:\"48\";i:29;s:3:\"300\";i:30;s:3:\"109\";i:31;s:2:\"73\";i:32;s:2:\"47\";i:33;s:3:\"100\";i:34;s:3:\"103\";i:35;s:3:\"102\";i:36;s:3:\"101\";i:37;s:2:\"63\";i:38;s:2:\"12\";i:39;s:2:\"55\";i:40;s:2:\"54\";i:41;s:2:\"35\";i:42;s:2:\"43\";i:43;s:2:\"40\";i:44;s:2:\"39\";i:45;s:2:\"38\";i:46;s:2:\"37\";i:47;s:2:\"36\";i:48;s:3:\"402\";i:49;s:3:\"403\";i:50;s:3:\"404\";i:51;s:3:\"405\";i:52;s:3:\"406\";i:53;s:3:\"407\";}' WHERE `id` = '1'; 



INSERT INTO `tbl_modules` (`parent_id`, `name`, `link`, `mode`, `icon_link`, `status`, `sortorder`, `added_date`, `type`) VALUES (0, 'ShareHolder Mgmt', '#', 'shareholder', 'icon-comments', '1', '6', '2024-01-07', 'admin');

INSERT INTO `tbl_modules` (`parent_id`, `name`, `link`, `mode`, `icon_link`, `status`, `sortorder`, `added_date`, `type`) VALUES (402, 'ShareHolder List', 'shareholder/list', 'shareholder', 'icon-comments', '1', '1', '2024-01-07', 'admin');

INSERT INTO `tbl_modules` (`parent_id`, `name`, `link`, `mode`, `icon_link`, `status`, `sortorder`, `added_date`, `type`) VALUES (402, 'Investment List', 'investment/list', 'shareholder', 'icon-money', '1', '2', '2024-01-07', 'admin');

INSERT INTO `tbl_modules` (`parent_id`, `name`, `link`, `mode`, `icon_link`, `status`, `sortorder`, `added_date`, `type`) VALUES ('402', 'Payment List', 'payment/list', 'shareholder', 'icon-money', '1', '3', '2024-01-07', 'admin'); 

INSERT INTO `tbl_modules` (`parent_id`, `name`, `link`, `mode`, `icon_link`, `status`, `sortorder`, `added_date`, `type`) VALUES ('402', 'Valuation', 'valuation/list', 'shareholder', 'icon-comments', '1', '4', '2024-01-07', 'admin'); 

INSERT INTO `tbl_modules` (`parent_id`, `name`, `link`, `mode`, `icon_link`, `status`, `sortorder`, `added_date`, `type`) VALUES ('402', 'Dividend', 'dividend/list', 'shareholder', 'icon-money', '1', '5', '2024-01-07', 'admin'); 

