<?php 

$online = ($_SERVER['HTTP_HOST'] == "localhost" || $_SERVER['HTTP_HOST'] == "localhost:2020" || $_SERVER['HTTP_HOST'] == "127.0.0.1" || $_SERVER['HTTP_HOST'] == "192.168.2.82") ? false : true;
defined('SITE_FOLDER') ? '' : define('SITE_FOLDER', 'siddharthabiz');
defined('SITE_STR')    ? '' : define('SITE_STR', '');

if($online){ // ONLINE SETUP

define('DB_SERVER',   'localhost');
define('DB_USER', 	  '');
define('DB_PASS', 	  '');
define('DB_NAME', 	  '');

} else { 	// LOCAL SETUP

define('DB_SERVER',   'localhost');
define('DB_USER', 	  'root');
define('DB_PASS', 	  '');
define('DB_NAME', 	  'siddharthabiz');

}

?>
