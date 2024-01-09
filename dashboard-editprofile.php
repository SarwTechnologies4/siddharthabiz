<?php

define('HOMEPAGE', 0); // Track homepage.
define('DASHBOARD_EDIT_PROFILE_PAGE', 1);// Track page.
define('JCMSTYPE', 0); // Track Current site language.

require_once("includes/initialize.php");

$currentTemplate	= Config::getCurrentTemplate('template');
$jVars 				= array();
$template 			= "template/{$currentTemplate}/dashboard-editprofile.html";

require_once('views/modules.php');

template($template, $jVars, $currentTemplate);

?>