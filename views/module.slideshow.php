<?php
/*
* Slideshow dynamic Transaction
*/
$reslide='
';

$slRec = Slideshow::getSlideshow_by();
if(!empty($slRec)) {
	$reslide.='
	<div class="slider">
		<div class="swiper-container">
			<div class="swiper-wrapper">';	
	foreach($slRec as $slRow) {
		$linkTarget = ($slRow->linktype == 1)? ' target="_blank" ' : ''; 
		$linksrc='';
		if(!empty($slRow->linksrc)) {
	        $linksrc  = ($slRow->linktype == 1)? $slRow->linksrc : BASE_URL.$slRow->linksrc;
	    };

		if($slRow->type=='0') {
			$file_path = SITE_ROOT.'images/slideshow/'.$slRow->image;
            if(file_exists($file_path) and !empty($slRow->image)) {
				$reslide.=' 
				<div class="swiper-slide" style="background-image:url('.IMAGE_PATH.'slideshow/'.$slRow->image.')">
                        <div class="swiper-content">
                            <h1 data-animation="animated fadeInUp">'.$slRow->title.'</h1>
                            <h4>'.$slRow->content.'<h4>
                        </div>
                    </div>';
	        };
		} else {
			$reslide.='<div class="item-video" data-merge="2">
	      <h1><a href="'.$linksrc.'" class="">'.$slRow->content.'</a></h1>
            </div>';
		}
	}
	$reslide.='</div>
	<!-- Add Pagination -->
	<div class="swiper-pagination"></div>
	<div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
</div>
<div class="overlay"></div>
</div>';
}

$jVars['module:slideshow']= $reslide;
?>