<?php
// SEO Meta Tags And Meta Description

function className_metatags() {
	$current_url = pathinfo($_SERVER["PHP_SELF"]);
	$fileName = $current_url['filename'];
	
    if($fileName=='booking'):
        $className = 'Package';
        return $className;
        exit;
    endif;
	
	if($fileName=='blogs'):
		$className = 'Blog';
		return $className;
		exit;
	endif;

	if($fileName=='hoteldetail'):
		$className = 'Hotelapi';
		return $className;
		exit;
	endif;

	if($fileName=='restaurant'):
		$className = 'Hotelapi';
		return $className;
		exit;
	endif;

	if($fileName=='cuisine'):
		$className = 'Hotelapi';
		return $className;
		exit;
	endif;
	if($fileName=='breads'):
		$className = 'Hotelapi';
		return $className;
		exit;
	endif;
	if($fileName=='whyus'):
		$className = 'Hotelapi';
		return $className;
		exit;
	endif;
	if($fileName=='cakes'):
		$className = 'Hotelapi';
		return $className;
		exit;
	endif;
	if($fileName=='beverages'):
		$className = 'Hotelapi';
		return $className;
		exit;
	endif;

	if($fileName=='contactdetail'):
		$className = 'Hotelapi';
		return $className;
		exit;
	endif;

	if($fileName=='fitnessdetail'):
		$className = 'Hotelapi';
		return $className;
		exit;
	endif;
	
	if($fileName=='review'):
		$className = 'Hotelapi';
		return $className;
		exit;
	endif;

	


	if($fileName=='weddingdetail'):
		$className = 'Hotelapi';
		return $className;
		exit;
	endif;

    if($fileName=='packagedetail'):
        $className = 'Package';
        return $className;
        exit;
    endif;

	if($fileName=='inner'):
		$className = 'Page';
		return $className;
		exit;
	endif;	
	
	if($fileName=='offer'):
		$className = 'Page';
		return $className;
		exit;
	endif;
	
	if($fileName=='halldetail'):
		$className = 'Hallapi';
		return $className;
		exit;
	endif;


	if($fileName!='index'):
		$className	= ucfirst(strtolower($fileName));
		return $className;
		exit;
	endif;
	
	return '';
}

function MetaTagsFor_SEO(){
	$config 		= Config::find_by_id(1);
	$sitetitle 		= $config->sitetitle;
	$keywords		= $config->site_keywords;
	$description	= $config->site_description;

	$addtitle = '';
	$class 	  = className_metatags();
	
	
	// Transaction start
	if(isset($_REQUEST['slug']) and !empty($_REQUEST['slug'])){
		$cls = new $class;
		$rec = $cls->find_by_slug($_REQUEST['slug']);
		if(!empty($rec)) {
			$addtitle 	 = $rec->title;
			$keywords    = $rec->meta_keywords;
			$description = $rec->meta_description;
		}

	}

	$altclass = !empty($class)? $class:'';
	if($altclass == "Dash"){
		$altclass = "Mileage Card";
	}
	$addtitle = !empty($addtitle)?$addtitle:$altclass;
	$addsep = !empty($addtitle)?'-':'';

	$seoSources = '<title>'.$addtitle.$addsep.$sitetitle.'</title>'."\n";
	$seoSources.= '<meta charset="utf-8">'."\n";
	$seoSources.= '<meta http-equiv="X-UA-Compatible" content="IE=edge">'."\n";
	$seoSources.= '<meta name="viewport" content="width=device-width, initial-scale=1">'."\n";
	$seoSources.= '<meta name="robots" content="index,follow">'."\n";
	$seoSources.= '<meta name="Googlebot" content="index, follow"/>'."\n";
	$seoSources.= '<meta name="distribution" content="Global">'."\n";
	$seoSources.= '<meta name="revisit-after" content="2 Days" />'."\n";
	$seoSources.= '<meta name="classification" content="Hotel, Hotels in Nepal" />'."\n";
	$seoSources.= '<meta name="category" content="Hotel, Hotels in Nepal" />'."\n";
	$seoSources.= '<meta name="language" content="en-us" />'."\n";	
	$seoSources.= '<meta name="keywords" content="'.$keywords.'">'."\n";
	$seoSources.= '<meta name="description" content="'.$description.'">'."\n";
	$seoSources.= '<meta name="author" content="Longtail-e-media">'."\n";
	// $seoSources.= '<link href=\'https://plus.google.com/u/0/+HotelManangnepal/posts\' rel="publisher"/>'."\n";
	$seoSources.= '<base url="'.BASE_URL.'"/>';
	
	return $seoSources;
}

?>