<?php
// SITE REGULARS
$jVars['site:header'] 		= Config::getField('headers',true);
$jVars['site:footer'] 		= Config::getField('footer',true);
$siteRegulars 				= Config::find_by_id(1);
$jVars['site:copyright']	= str_replace('{year}',date('Y'),$siteRegulars->copyright);
$jVars['site:fevicon']		=  '<link rel="shortcut icon" href="'.IMAGE_PATH.'preference/'.$siteRegulars->icon_upload.'"> 
							    <link rel="apple-touch-icon" href="'.IMAGE_PATH.'preference/'.$siteRegulars->icon_upload.'"> 
							    <link rel="apple-touch-icon" sizes="72x72" href="'.IMAGE_PATH.'preference/'.$siteRegulars->icon_upload.'"> 
							    <link rel="apple-touch-icon" sizes="114x114" href="'.IMAGE_PATH.'preference/'.$siteRegulars->icon_upload.'">';
$jVars['module:logo']		= '<a class="navbar-brand" href="'.BASE_URL.'"><img id="logo" alt="'.$siteRegulars->sitetitle.'" src="'.IMAGE_PATH.'preference/'.$siteRegulars->logo_upload.'"></a>';				    
$jVars['site:seotitle'] 	= MetaTagsFor_SEO();
$jVars['site:base_url'] 	= BASE_URL;
$jVars['site:SITE_FOLDER'] 		= SITE_FOLDER;



// view modules 

// pr($_REQUEST);
require_once("views/module.hoteloffer.php");
require_once("views/module.faq.php");
require_once("views/module.hotelapi.php");
require_once("views/module.page.php");
require_once("views/module.halldetails.php");
require_once("module.booking.php");
require_once("views/module.hoteldetail.php");
require_once("views/module.contact.php");
require_once("views/module.location.php");
require_once("views/module.subscribers.php");
require_once("views/module.vehicle.php");
// require_once("views/module.contactdetail.php");

// SITE MODULES
$modulesList = Module::getAllmode();
foreach($modulesList as $module):
	$fileName = "module.".$module->mode.".php";
	if(file_exists("views/".$fileName)){
	  require_once("views/".$fileName);
	}
endforeach;

require_once("module.booking.php");

require_once("module.header.php");
require_once("module.footer.php");
require_once("module.packagedetail.php");
require_once("module.attractions.php");
?>
