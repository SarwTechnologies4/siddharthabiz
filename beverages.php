<?php

ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);

define('HOMEPAGE', 0); // Track homepage.
define('BEVERAGESDETAIL_PAGE', 1);// Track Article page.
define('JCMSTYPE', 0); // Track Current site language.

require_once("includes/initialize.php");

$currentTemplate	= Config::getCurrentTemplate('template');
$jVars 				= array();
$template 			= "template/{$currentTemplate}/beverages-detail.html";

require_once('views/modules.php');

template($template, $jVars, $currentTemplate);

?>