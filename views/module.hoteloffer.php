<?php 
// Hotel Offer
$reshofer='';

if(defined('HOMEPAGE')) { 
	$hoferRec = Roomoffers::get_latestoffer();
	if(!empty($hoferRec)) {
		$reshofer.='  <div class="theme-inline-slider row" data-gutter="10">
		<div class="offerslider owl-carousel " data-items="3" data-loop="true" data-nav="true" data-autoplay="7000">';  
				foreach($hoferRec as $hoferRow) {
					

					$hotelname = Hotelapi::field_by_id($hoferRow->hotel_id, 'title');
					$slug = Hotelapi::field_by_id($hoferRow->hotel_id, 'slug'); 
					$apply_id  =  $hoferRow->apply_id;
					$applyFor='';
					if(empty($apply_id)) {
						$applyFor= "All Room";
					} 
					else {
						if($hoferRow->apply_for=='room_type') {
							$row  = Roomtype::find_by_id($apply_id); 
							$applyFor = $row->title;
						}
						else {
							$row  = Roomapi::find_by_id($apply_id); 
							$applyFor = $row->title;
						}
					}
					$reshofer.=' <div class="theme-inline-slider-item">
					<div class="banner _h-40vh _br-3 _bsh-xs banner-animate banner-animate-mask-in banner-animate-slow">
					  <div class="banner-bg" style="background-image:url('.IMAGE_PATH.'roomoffers/'.$hoferRow->image.');"></div>
					  <figcaption>
					  <span>'.$hoferRow->title.'</span><br>
					  <strong class="caption-title">'.$hoferRow->discount.'% off</strong>
				  </figcaption>
					  <div class="banner-mask"></div>
					  <a class="banner-link" href="'.$hoferRow->linksrc.'"></a>
					  <div class="banner-caption _p-20 _bg-w banner-caption-bottom banner-caption-dark">
						<h5 class="banner-title _fs _fw-b">'.$hoferRow->title.'</h5>
						<p class="banner-subtitle _fw-n _mt-5">Offer For '.$applyFor.'</p>
					  </div>
					</div>
				  </div>';  
	            }
				$reshofer.='</div>
			  </div>';
	}
}

$jVars['module:hotel-offers'] = $reshofer;

$listhofer='';

	$hoferlist = Offers::find_all();
	if(!empty($hoferRec)) {
		$listhofer.='   <section class="rooms rooms-style1">
		<div class="container-xxl px-md-5 px-4">
      
        <div class="room-outer">
            <div class="row  ">';  
				foreach($hoferlist as $hoferli) {
					
					$listhofer.=' 
					<div class="col-md-3 col-sm-6 col-xs-12 mb-4">
                    	<div class="">
                        	<div class="room-image">
							<a href="'.$hoferli->linksrc.'"><img src="'.IMAGE_PATH.'offers/'.$hoferli->image.'" width="100%" alt="'.$hoferli->title.'"></a>
							</div>
							<div class="room-content1">
								<div class="room-title">
									<h4><a href="'.$hoferli->linksrc.'">'.$hoferli->title.'</a></h4>
									
								</div>
							</div>
						</div>
					</div>';  
	            }
				$listhofer.='</div>
				</div>
				</div>
			</section>';
	
}

$jVars['module:offer-list'] = $listhofer;

?>