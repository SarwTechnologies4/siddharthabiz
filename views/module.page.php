<?php 
/*
* Inner page
*/
$resbread=$resinn='';

if(defined('INNER_PAGE') and !empty($_REQUEST['slug'])) {
	$slug = addslashes($_REQUEST['slug']);
	$innRec = Page::find_by_slug($slug);
	if(!empty($innRec)) {
		if ($innRec->image != "a:0:{}") {
            $imageList = unserialize($innRec->image);
            $imgno = array_rand($imageList);
            $file_path = SITE_ROOT . 'images/page/' . $imageList[$imgno];
            if (file_exists($file_path)) {
                $imglink = IMAGE_PATH . 'page/' . $imageList[$imgno];
            }
        }

      if($imglink){
        $resbread.='   <!-- breadcrumbs starts -->
        <section class="breadcrumb-outer" style="background-image:url('.$imglink.');">
    
            <div class="container">
                <div class="breadcrumb-content"><h1 class="text-center text-white">'.$innRec->title.'</h1>
                </div
            </div>
        </section>';
      }
		

        $content = explode('<hr id="system_readmore" style="border-style: dashed; border-color: orange;" />', trim($innRec->content));	
		$contentres = !empty($content[1]) ? $content[1] : $content[0];	
		$resinn.=' 
                                <div class="row">
                                   
                                    <div class="col-12">';
if(!$imglink){
    $resinn.= '<h1 class="text-center">'.$innRec->title.'</h1>';
}

                                       
                                    $resinn.= $contentres.'
                                        <!--<a href="#sec2" class="btn  color-bg float-btn custom-scroll-link">View Our Team <i class="fal fa-users"></i></a>-->
                                    </div>
                                </div>
                            ';

	}
}

$jVars['module:inner-breadcrumb'] = $resbread;
$jVars['module:inner-detail'] = $resinn;

$offerbread=$offerinn='';
$imgname='';
if(defined('OFFER_PAGE') and !empty($_REQUEST['slug'])) {
	$slug = addslashes($_REQUEST['slug']);
	$offerRec = Offers::find_by_slug($slug);
	if(!empty($offerRec)) {
		// if ($offerRec->list_image) {
        //     $imageList = $offerRec->list_image;
        //     $file_path = SITE_ROOT . 'images/page/' . $imageList;
        //     if (file_exists($file_path)) {
        //         $imglink = IMAGE_PATH . 'page/' . $imageList;
        //     }
        // }
       
            $imgname= $offerRec->list_image;
        $offerbread.='   <!-- breadcrumbs starts -->
        <section class="breadcrumb-outer" style="background-image:url(' . IMAGE_PATH . 'offers/listimage/' . $imgname . ');">
    
            <div class="container">
                <div class="breadcrumb-content"><h1 class="text-center text-white">'.$offerRec->title.'</h1>
                </div
            </div>
        </section>';
      
        

        $content = explode('<hr id="system_readmore" style="border-style: dashed; border-color: orange;" />', trim($offerRec->content));	
		$content = implode(" ", $content);	
		$offerinn.=' 
                                <div class="row">
                                   
                                    <div class="col-12 col-sm-8 mx-auto ">
                                    <div class="overview-one minh">
                                    ';



                                       
                                    $offerinn.= $offerRec->content.'</div>
                                        <!--<a href="#sec2" class="btn  color-bg float-btn custom-scroll-link">View Our Team <i class="fal fa-users"></i></a>-->
                                    </div>
                                </div>
                            ';

	}
}

$jVars['module:offer-breadcrumb'] = $offerbread;
$jVars['module:offer-detail'] = $offerinn;

$reshome='';

if(defined('HOMEPAGE')) {
	$homeRec = Page::homepagePage();
	if(!empty($homeRec)) {
        
        foreach($homeRec as $homerow){
		if ($homerow->image != "a:0:{}") {
            $imageList = unserialize($homerow->image);
            $imgno = array_rand($imageList);
            $file_path = SITE_ROOT . 'images/page/' . $imageList[$imgno];
            if (file_exists($file_path)) {
                $imglink = IMAGE_PATH . 'page/' . $imageList[$imgno];
            } else {
                $imglink = BASE_URL . 'template/nepalhotel/images/all/npl.jpg';
            }
        } else {
            $imglink = BASE_URL . 'template/nepalhotel/images/all/npl.jpg';
        }
		
        
        $content = explode('<hr id="system_readmore" style="border-style: dashed; border-color: orange;" />', trim($homerow->content));	
        $contentres = !empty($content[1]) ? $content[1] : $content[0];
        if(!empty($content[1])){
            $readmore='<a href="'.BASE_URL.'/page/'.$homerow->slug.'" class="btn btn-orange">Learn More</a>';
        }
        else{
            $readmore=''; 
        }
		$reshome.=' 
        
        <div class="row">
                <div class="col-md-7 col-sm-12 col-xs-12">
                    <div class="about-heading">
                        <blockquote>
                            <h2 class="title">'.$homerow->title.'</h2>
                        </blockquote>
                        
                        <div class="description">
                        '.$content[0].'
                        </div>
                        <div class="expand"><small>Show More</small></div>
                        <div class="head-button">
                        '.$readmore.'
                        </div>
                    </div>
                </div>
                <div class="col-md-5 col-sm-12 col-xs-12">
                    <div class="about-img-box row">
                        <div class="col-sm-12  col-sm-12 col-xs-12">
                            <a href="#"><img src="'.$imglink.'" alt="'.$homerow->title.'"></a>
                        </div>
                    </div>
                </div>
            </div>
            ';

	}
   
}
}
$jVars['module:home-article'] = $reshome;