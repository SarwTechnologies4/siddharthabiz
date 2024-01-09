<?php
// Hotel Info
/**
 *          Recently Added Hotels in Homepage
 */
$resrhapi = '';
if (defined('HOMEPAGE')) {

    $sql = "SELECT hd.id ,hd.title, hd.code, hd.slug, hd.home_image,hd.star,hd.map, hd.street,hd.detail,hd.feature, hd.city, rd.currency, rp.one_person ,ro.discount
		FROM tbl_apihotel AS hd 
		INNER JOIN tbl_roomapi AS rd
		ON hd.id = rd.hotel_id
		INNER JOIN tbl_roomapi_price AS rp 
		ON rd.id = rp.room_id
    LEFT JOIN tbl_roomapi_offers AS ro 
    ON rd.hotel_id = ro.hotel_id and ro.homepage='1' 
   
	WHERE hd.status='1' GROUP BY hd.id ORDER BY hd.id ASC";

    $query = $db->query($sql);
    $totno = $db->num_rows($query);

    if ($totno > 0) {
        $resrhapi .= '<section class="grey-blue-bg">
                        <!-- container-->
                        <div class="container">
                            <div class="section-title">
                                
                                <h2>Recently Added Hotels</h2>
                                
                                <p>Freshly new hotels and places </p>
                            </div>
                        </div>
                        <!-- container end-->
                        <!-- carousel -->
                        <div class="list-carousel fl-wrap card-listing ">
                            <!--listing-carousel-->
                            <div class="listing-carousel  fl-wrap ">';
        while ($rhapiRow = $db->fetch_object($query)) {
            $imgname = $rhapiRow->home_image;
            $resrhapi .= ' <div class="slick-slide-item">
                                    <!-- listing-item  -->
                                    <div class="listing-item">
                                        <article class="geodir-category-listing fl-wrap">
                                            <div class="geodir-category-img">
                                                <a href="' . BASE_URL . 'hotel/' . $rhapiRow->slug . '"><img src="' . IMAGE_PATH . 'hotelapi/home/' . $imgname . '" alt=" ' . $rhapiRow->title . '"></a>';
            if (!empty($rhapiRow->discount)) {
                $resrhapi .= ' <div class="sale-window">Sale ' . $rhapiRow->discount . '%</div>';
            }
            $length = strlen($rhapiRow->detail);
            $elipses = ($length > 112) ? '...' : '';
            $resrhapi .= '  
                                            </div>
                                            <div class="geodir-category-content fl-wrap title-sin_item">
                                                <div class="geodir-category-content-title fl-wrap">
                                                    <div class="geodir-category-content-title-item text-start">
                                                    <small class="badge bg-light text-dark">' . $rhapiRow->star . '</small>
                                                    <br>
                                                        <h3 class="title-sin_map"><a href="' . BASE_URL . 'hotel/' . $rhapiRow->slug . '">' . $rhapiRow->title . '</a></h3>
                                                        <div class="geodir-category-location fl-wrap"><a href="#" class="map-item" title="' . $rhapiRow->street . ' ' . $rhapiRow->city . '"><i class="fas fa-map-marker-alt"></i> ' . $rhapiRow->street . ' ' . $rhapiRow->city . '</a></div>
                                                    </div>
                                                </div>
                                                ';
            /* $rooms = Roomapi::find_by_active_room($rhapiRow->id);
             foreach ($rooms as $room) {
                 $priceRoom = Roomapiprice::find_by_room_id($room->id);
                 $imageRec = unserialize(base64_decode($room->image));
                 $amenity = '';
                 if ($room->feature != '') {
                     $feature = unserialize(base64_decode($room->feature));
                     $count = 0;
                     foreach ($feature as $key => $val) {
                         if ($val['id'] == '165') {
                             foreach ($val['features'] as $k => $v) {
                                 if (array_key_exists('id', $v)) {
                                     if ($k != 'id' and $count < 4) {
                                         $count++;
                                         $amenity .= ' <li><i class="' . $v['icon_class'] . '"></i><span>' . $v['title'] . '</span></li>';
                                     }
                                 }
                             }
                         }
                     }
                 }
             }*/
            $amenity = '';
            if ($rhapiRow->feature != '') {

                $feature = unserialize(base64_decode($rhapiRow->feature));
                $count = 0;
                foreach ($feature as $key => $val) {
                    if (is_array($val['features'])) {
                        foreach ($val['features'] as $k => $v) {
                            if (array_key_exists('id', $v)) {
                                if ($k != 'id' and $count < 4) {
                                    $count++;
                                    $amenity .= '<li><i class="' . $v['icon_class'] . '"></i><span>' . $v['title'] . '</span></li>';
                                }
                            }
                        }
                    }


                }

            }
            $resrhapi .= '<ul class="facilities-list fl-wrap">
                                                
                                                  ' . $amenity . '
                                                <div class="geodir-category-footer fl-wrap">
                                                    <div class="geodir-category-price">Starting From<br><span> ' . $rhapiRow->currency . ' ' . $rhapiRow->one_person . '</span></div>
                                                    
                                                    <div class="geodir-opt-list">
                                                      
                                                        <a href="' . $rhapiRow->map . '" class="geodir-js-booking" target="_blank"><i class="fal fa-exchange"></i><span class="geodir-opt-tooltip">Find Directions</span></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
                                    <!-- listing-item end -->
                                </div>';
        }
        $resrhapi .= '</div>
                            <!--listing-carousel end-->
                            <div class="swiper-button-prev sw-btn"><i class="fa fa-long-arrow-left"></i></div>
                            <div class="swiper-button-next sw-btn"><i class="fa fa-long-arrow-right"></i></div>
                        </div>
                        <!--  carousel end-->
                    </section>
                    <!-- section end -->';
    }
}
$jVars['module:homerecenthotel'] = $resrhapi;

$homeproperty='';
if (defined('HOMEPAGE')) {

    $homedisplay = Hotelapi:: home_all(5);

    $query = $db->query($sql);
    $totno = $db->num_rows($query);

    if (!empty($homedisplay)) {
        $homeproperty .= '<section class="rooms rooms-style1">
        <div class="container-xxl px-md-5 px-4">
        <div class="section-title">
            <p>Featured Hospitality</p>
        </div>
        <div class="room-outer fts">
            <div class="row">
                <div class="col-md-7 col-sm-6 col-xs-12">
                    <div style="background:#ccc;width:100%;height:630px;border-radius:8px;overflow:hidden;position:relative">';
                    foreach($homedisplay as $key => $rhapiRow) {
                        $imgname = $rhapiRow->home_image;
                        if($key == 0){
                            $homeproperty .= '
                            <a href="' . BASE_URL . 'hotel/' . $rhapiRow->slug . '">
                            <img style="width:100%;" class="img-fluid" src="' . IMAGE_PATH . 'hotelapi/home/' . $imgname . '" alt="' . $rhapiRow->title . '"></a>
                            <div class="feat_hero_detail"><h4>'.$rhapiRow->title.'</h4><p>'.$rhapiRow->brief.'</p></div>';
                       
                        }
                        
                     
                       
                    }


                    $homeproperty .= '
                    </div>
                </div>
                <div class="col-md-5 col-sm-6 col-xs-12">
                <div class="row">';
                foreach($homedisplay as $key => $rhapiRow) {
                    $imgname = $rhapiRow->home_image;
                    if($key >= 1){
                        $homeproperty .= '
                    <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="room-item real_feat">
                        <div class="room-image">
                        <a href="' . BASE_URL . 'hotel/' . $rhapiRow->slug . '"><img class="img-fluid" src="' . IMAGE_PATH . 'hotelapi/home/' . $imgname . '" alt="' . $rhapiRow->title . '"></a>
                        </div>
                        <div class="">
                            <div class="room-title">
                                <h4><a href="' . BASE_URL . 'hotel/' . $rhapiRow->slug . '">' . $rhapiRow->title . '</a></h4>
                                
                            </div>
                            <p style="height: 50px;
                            overflow: hidden;
                            line-height: 23px;
                            font-size: 14px;">'.$rhapiRow->brief.'</p>
                        </div>
                    </div>
                </div>';
                    }
                    
                    
                    $length = strlen($rhapiRow->detail);
                    $elipses = ($length > 112) ? '...' : '';
                   
                }
                $homeproperty .='</div></div>
            </div>
            <div class="row feature-slider">
           
            
            
            ';
        // foreach($homedisplay as $rhapiRow) {
        //     $imgname = $rhapiRow->home_image;
        //     $homeproperty .= ' 
        //     <div class="col-md-3 col-sm-6 col-xs-12">
        //             <div class="room-item">
        //                 <div class="room-image">
        //                 <a href="' . BASE_URL . 'hotel/' . $rhapiRow->slug . '"><img src="' . IMAGE_PATH . 'hotelapi/home/' . $imgname . '" alt="' . $rhapiRow->title . '"></a>
        //                 </div>
        //                 <div class="room-content">
        //                     <div class="room-title">
        //                         <h4><a href="' . BASE_URL . 'hotel/' . $rhapiRow->slug . '">' . $rhapiRow->title . '</a></h4>
        //                         <p>'.$rhapiRow->brief.'</p>
        //                     </div>
        //                 </div>
        //             </div>
        //         </div>';
            
        //     $length = strlen($rhapiRow->detail);
        //     $elipses = ($length > 112) ? '...' : '';
           
        // }
        $homeproperty .= '</div>
        </div>
        </div>
    </section>';
    }
}
$jVars['module:homeproperty-all'] = $homeproperty;

$hotelresort='';
if (defined('HOMEPAGE')) {

    $hoteldisplay = Hotelapi:: hotel_all();

    $query = $db->query($sql);
    $totno = $db->num_rows($query);

    if (!empty($hoteldisplay)) {
        $hotelresort .= '<section class="rooms rooms-style1 hotels1">
        <div class="container-xxl px-md-5 px-4">
        
        <div class="room-outer">
            <div class="row feature-slider">';
        foreach($hoteldisplay as $rhapiRow) {
            $imgname = $rhapiRow->home_image;
            $hotelresort .= ' 
            <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="room-item">
                        <div class="room-image">
                        <a href="' . BASE_URL . 'hotel/' . $rhapiRow->slug . '"><img src="' . IMAGE_PATH . 'hotelapi/home/' . $imgname . '" alt="' . $rhapiRow->title . '"></a>
                        </div>
                        <div class="room-content">
                            <div class="room-title">
                                <h4><a href="' . BASE_URL . 'hotel/' . $rhapiRow->slug . '">' . $rhapiRow->title . '</a></h4>
                                
                            </div>
                        </div>
                    </div>
                </div>';
            
            $length = strlen($rhapiRow->detail);
            $elipses = ($length > 112) ? '...' : '';
           
        }
        $hotelresort .= '</div>
        </div>
        </div>
    </section>';
    }
}
$jVars['module:hotelresort-all'] = $hotelresort;

$restaurant='';
if (defined('HOMEPAGE')) {

    $restaurantdisplay = Hotelapi:: restaurant_all();

    $query = $db->query($sql);
    $totno = $db->num_rows($query);

    if (!empty($restaurantdisplay)) {
        $restaurant .= '<section class="rooms rooms-style1 hotels1">
        <div class="container-xxl px-md-5 px-4">
        
        <div class="room-outer">
            <div class="row feature-slider">';
        foreach($restaurantdisplay as $rhapiRow) {
            $imgname = $rhapiRow->home_image;
            $restaurant .= ' 
            <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="room-item">
                        <div class="room-image">
                        <a href="' . BASE_URL . 'hotel/' . $rhapiRow->slug . '"><img src="' . IMAGE_PATH . 'hotelapi/home/' . $imgname . '" alt="' . $rhapiRow->title . '"></a>
                        </div>
                        <div class="room-content">
                            <div class="room-title">
                                <h4><a href="' . BASE_URL . 'hotel/' . $rhapiRow->slug . '">' . $rhapiRow->title . '</a></h4>
                                
                            </div>
                        </div>
                    </div>
                </div>';
            
            $length = strlen($rhapiRow->detail);
            $elipses = ($length > 112) ? '...' : '';
           
        }
        $restaurant .= '</div>
        </div>
        </div>
    </section>';
    }
}
$jVars['module:restaurant-all'] = $restaurant;

$scafe='';
if (defined('HOMEPAGE')) {

    $scafedisplay = Hotelapi:: cafe_all();

    $query = $db->query($sql);
    $totno = $db->num_rows($query);

    if (!empty($scafedisplay)) {
        $scafe .= '<section class="rooms rooms-style1 hotels1">
        <div class="container-xxl px-md-5 px-4">
      
        <div class="room-outer">
            <div class="row feature-slider">';
        foreach($scafedisplay as $rhapiRow) {
            $imgname = $rhapiRow->home_image;
            $scafe .= ' 
            <div class="col-md-4 col-sm-6 col-xs-12 ">
                    <div class="room-item">
                        <div class="room-image">
                        <a href="' . BASE_URL . 'hotel/' . $rhapiRow->slug . '"><img src="' . IMAGE_PATH . 'hotelapi/home/' . $imgname . '" alt="' . $rhapiRow->title . '"></a>
                        </div>
                        <div class="room-content">
                            <div class="room-title">
                                <h4><a href="' . BASE_URL . 'hotel/' . $rhapiRow->slug . '">' . $rhapiRow->title . '</a></h4>
                                
                            </div>
                        </div>
                    </div>
                </div>';
            
            $length = strlen($rhapiRow->detail);
            $elipses = ($length > 112) ? '...' : '';
           
        }
        $scafe.= '</div>
        </div>
        </div>
    </section>';
    }
}
$jVars['module:scafe-all'] = $scafe;

$reshofer='';

if(defined('HOMEPAGE')) { 
	$hoferRec = Offers::get_offer_by(8);
	if(!empty($hoferRec)) {
		$reshofer.='   <section class="rooms rooms-style1">
		<div class="container-xxl px-md-5 px-4">
        <div class="section-title">
            <p>Deals and offers</p>
        </div>
        <div class="room-outer">
            <div class="row feature-slider1">';  
				foreach($hoferRec as $hoferRow) {
					
					$reshofer.=' 
					<div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="room-item">
                        <div class="room-image">
                        <a href="'.$hoferRow->linksrc.'"> <img src="'.IMAGE_PATH.'offers/'.$hoferRow->image.'" alt="'.$hoferRow->title.'"></a>
                        </div>
                        <div class="room-content">
                            <div class="room-title">
                            <h4><a href="'.$hoferRow->linksrc.'">'.$hoferRow->title.'</a></h4>
                               
                            </div>
                        </div>
                    </div>
                </div>';  
	            }
				$reshofer.='</div>
				</div>
				</div>
			</section>';
	}
}

$jVars['module:hotel-offers'] = $reshofer;

//advert
$resadvert='';
if(defined('HOMEPAGE')) { 
	$mainadvert = ADVERTISEMENT::find_by_id(1);
	if(!empty($mainadvert)) {
		$resadvert.='  
        <section class="call-to-action">
        <div class="container-xxl px-md-5 px-4">
            <div class="row">
                <div class="col-md-12">
                    <img src="'.IMAGE_PATH.'advertisement/'.$mainadvert->image.'">
                </div>
            </div>
        </div>
    </section>
        ';
	}
}

$jVars['module:main-advert'] = $resadvert;

//multiadvert
$homeadvert='';

if(defined('HOMEPAGE')) { 
	$advertRec = ADVERTISEMENT::find_main(1);
	if(!empty($advertRec)) {
		$homeadvert.='   <section class="services">
		<div class="container-xxl px-md-5 px-4">
        <div class="service-outer">
            <div class="row team-slider">';  
				foreach($advertRec as $advertRow) {
					
					$homeadvert.=' 
                    <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="service-item">
                        <div class="service-image">
                            <a href="#"><img src="'.IMAGE_PATH.'advertisement/'.$advertRow->image.'" alt="'.$advertRow->title.'"></a>
                        </div>
                    </div>
                </div>';  
	            }
				$homeadvert.='</div>
				</div>
				</div>
			</section>';
	}
}

$jVars['module:home-advert'] = $homeadvert;

//recommeded
/**
 *          Most Popular Hotels in Homepage
 */
$reccapi = '';
if (defined('HOMEPAGE')) {

    $sql = "SELECT hd.title, hd.code, hd.slug, hd.home_image,hd.star, hd.street,hd.detail, hd.city, rd.currency, rp.one_person ,ro.discount
    FROM tbl_apihotel AS hd 
    INNER JOIN tbl_roomapi AS rd
    ON hd.id = rd.hotel_id
    INNER JOIN tbl_roomapi_price AS rp 
    ON rd.id = rp.room_id
    LEFT JOIN tbl_roomapi_offers AS ro 
    ON rd.hotel_id = ro.hotel_id and ro.homepage='1' 
  WHERE hd.status='1' AND hd.featured='1' GROUP BY hd.id ORDER BY hd.id ASC limit 8";

    $query = $db->query($sql);
    $totno = $db->num_rows($query);

    if ($totno > 0) {
        $reccapi .= '<section class="parallax-section" data-scrollax-parent="true">
                        <div class="bg"  data-bg="' . BASE_URL . 'template/nepalhotel/images/bg/1.jpg" data-scrollax="properties: { translateY: \'100px\' }"></div>
                        <div class="overlay op7"></div>
                        <!--container-->
                        <div class="container">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="colomn-text fl-wrap pad-top-column-text_small">
                                        <div class="colomn-text-title">
                                            <h3>Most Popular Hotels</h3>
                                            <p>The collection of most popular hotels of Nepal. View all that we have. Exclusive collections of hotels with us.</p>
                                            <a href="#" class="btn  color2-bg float-btn">View All Hotels<i class="fas fa-caret-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                                 <div class="col-md-8">
                                    <!--light-carousel-wrap-->
                                    <div class="light-carousel-wrap fl-wrap">
                                        <!--light-carousel-->
                                        <div class="light-carousel">';
        while ($rhapiRow = $db->fetch_object($query)) {

            $imgname = $rhapiRow->home_image;


            $reccapi .= '  <div class="slick-slide-item">
                                                <div class="hotel-card fl-wrap title-sin_item">
                                                    <div class="geodir-category-img card-post">
                                                        <a href="' . BASE_URL . 'hotel/' . $rhapiRow->slug . '"><img src="' . IMAGE_PATH . 'hotelapi/home/' . $imgname . '" alt="' . $rhapiRow->title . '"></a>
                                                        <div class="listing-counter"><strong>' . $rhapiRow->currency . ' ' . $rhapiRow->one_person . '</strong></div>';
            if (!empty($rhapiRow->discount)) {

                $reccapi .= ' <div class="sale-window">Sale ' . $rhapiRow->discount . '%</div>';
            }
            $reccapi .= ' 
                                                        <div class="geodir-category-opt">
                                                            <div class="listing-rating card-popup-rainingvis" data-starrating2="' . $rhapiRow->star . '"></div>
                                                            <h4 class="title-sin_map"><a href="' . BASE_URL . 'hotel/' . $rhapiRow->slug . '">' . $rhapiRow->title . '</a></h4>
                                                            <div class="geodir-category-location"><a href="#" class="single-map-item" data-newlatitude="40.90261483" data-newlongitude="-74.15737152"><i class="fas fa-map-marker-alt"></i> ' . $rhapiRow->street . ' ' . $rhapiRow->city . '</a></div>
                                                            <div class="rate-class-name">
                                                                <div class="score"><strong></strong></div>
                                                                <span><a href="' . BASE_URL . 'hotel/' . $rhapiRow->slug . '">More</a></span>                                             
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>';
        }
        $reccapi .= '</div>
                                        <!--light-carousel end-->
                                        <div class="fc-cont  lc-prev"><i class="fal fa-angle-left"></i></div>
                                        <div class="fc-cont  lc-next"><i class="fal fa-angle-right"></i></div>
                                    </div>
                                    <!--light-carousel-wrap end-->
                                </div>
                            </div>
                        </div>
                    </section>';
    }
}
$jVars['module:recommendedHotel'] = $reccapi;


/**
 *          Popular Destinations in Homepage
 */
$destination = '';
$dest = Destination::homepageDestination(6);


$destination .= ' <section id="sec2">
                        <div class="container">
                            <div class="section-title">
                                
                                <h2>Popular Destinations</h2>
                                <p>Explore the most popular desintations of Nepal.</p>
                            </div>
             </div>
                            <!-- portfolio start -->
                            <div class="gallery-items fl-wrap mr-bot spad home-grid">';
foreach ($dest as $dests) {
    $noofhotel = Hotelapi::count_hotel_by_destid($dests->id);
    $destination .= '<div class="gallery-item p-2">
                                    <div class="grid-item-holder">
                                        <div class="listing-item-grid">
                                            <div class="listing-counter"><a href="' . BASE_URL . 'hotellist/' . $dests->slug . '"><span>' . $noofhotel . ' </span> Hotels</a></div>
                                            <img  src="' . IMAGE_PATH . 'destination/' . $dests->image . '"   alt="' . $dests->title . '">
                                            <div class="listing-item-cat">
                                                <h3><a href="' . BASE_URL . 'hotellist/' . $dests->slug . '">' . $dests->title . '</a></h3>
                                                <div class="weather-grid"   data-grcity="Rome"></div>
                                                <div class="clearfix"></div>
                                                <p>' . $dests->content . '</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>';
}
$destination .= ' </div>
                            <!-- portfolio end -->
                            <a href="' . BASE_URL . 'destination" class="btn    color-bg">Explore All Cities<i class="fas fa-caret-right"></i></a>
                    </section>';
$jVars['module:destination'] = $destination;


$destlist = $destinationbread = '';
$destlists = Destination::find_all();

$destinationbread .= '<div class="breadcrumbs-fs fl-wrap">
                        <div class="container">
                            <div class="breadcrumbs fl-wrap"><a href="' . BASE_URL . 'home">Home</a><span>Destination</span></div>
                        </div>
                    </div>';
$destlist .= ' <section id="sec2">
                         <div class="container">
                           <div class="section-title">
                                
                                <h2>Our Destinations</h2>
                                <p>Explore the most popular desintations of Nepal.</p>
                            </div>
             </div>
                            <!-- portfolio start -->
                            <div class="gallery-items fl-wrap mr-bot spad home-grid">';
foreach ($destlists as $dests) {
    $noofhotel = Hotelapi::count_hotel_by_destid($dests->id);


    $destlist .= '<div class="gallery-item">
                                    <div class="grid-item-holder">
                                        <div class="listing-item-grid">
                                            <div class="listing-counter"><a href="' . BASE_URL . 'hotellist/' . $dests->slug . '"><span>' . $noofhotel . ' </span> Hotels</a></div>
                                            <img  src="' . IMAGE_PATH . 'destination/' . $dests->image . '"   alt="' . $dests->title . '">
                                            <div class="listing-item-cat">
                                                <h3><a href="' . BASE_URL . 'hotellist/' . $dests->slug . '">' . $dests->title . '</a></h3>
                                                <div class="weather-grid"   data-grcity="Rome"></div>
                                                <div class="clearfix"></div>
                                                <p>' . $dests->content . '</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>';
}
$destlist .= ' </div>
                            <!-- portfolio end -->
                            <!--<a href="' . BASE_URL . 'destination" class="btn    color-bg">Explore All Cities<i class="fas fa-caret-right"></i></a>-->
                    </section>';

$jVars['module:destinationlist'] = $destlist;
$jVars['module:destinationbread'] = $destinationbread;


$whychooseus = '';

$whychooseus .= '<section>
                        <div class="container">
                            <div class="section-title">
                                <h2>Why Choose Us</h2>
                                <p>We are here to accommodate as per your need and facilitate based on your requirement.</p>
                            </div>
                            <!-- -->
                            <div class="row">
                                <div class="col-md-4">
                                    <!-- process-item-->
                                    <div class="process-item big-pad-pr-item">
                                        <span class="process-count"> </span>
                                        <div class="time-line-icon"><i class="fal fa-headset"></i></div>
                                        <h4><a href="#"> Best service guarantee</a></h4>
                                        <p>Best price is guarantee much cheaper than ever you know. We offer best service all over Nepal. </p>
                                    </div>
                                    <!-- process-item end -->
                                </div>
                                <div class="col-md-4">
                                    <!-- process-item-->
                                    <div class="process-item big-pad-pr-item">
                                        <span class="process-count"> </span>
                                        <div class="time-line-icon"><i class="fal fa-gift"></i></div>
                                        <h4> <a href="#">Exclusive Package</a></h4>
                                        <p>Exclusive package around every corner within Nepal. Every kind of occasion and festival we offer.</p>
                                    </div>
                                    <!-- process-item end -->                                
                                </div>
                                <div class="col-md-4">
                                    <!-- process-item-->
                                    <div class="process-item big-pad-pr-item nodecpre">
                                        <span class="process-count"> </span>
                                        <div class="time-line-icon"><i class="fal fa-credit-card"></i></div>
                                        <h4><a href="#"> Get more from your card</a></h4>
                                        <p>Get more from your card. We offer online transaction through Master card with easy payment system.</p>
                                    </div>
                                    <!-- process-item end -->                                
                                </div>
                            </div>';
$whychooseus .= ' <!--process-wrap   end-->
                            <div class=" single-facts fl-wrap mar-top">
                                <!-- inline-facts -->
                                <div class="inline-facts-wrap">
                                    <div class="inline-facts">
                                        <i class="fal fa-users"></i>
                                        <div class="milestone-counter">
                                            <div class="stats animaper">
                                                <div class="num" data-content="0" data-num="254">154</div>
                                            </div>
                                        </div>
                                        <h6>Rooms booked every day</h6>
                                    </div>
                                </div>
                                <!-- inline-facts end -->
                                <!-- inline-facts  -->
                                <div class="inline-facts-wrap">
                                    <div class="inline-facts">
                                        <i class="fal fa-thumbs-up"></i>
                                        <div class="milestone-counter">
                                            <div class="stats animaper">
                                                <div class="num" data-content="0" data-num="12168">12168</div>
                                            </div>
                                        </div>
                                        <h6>Happy customers every year</h6>
                                    </div>
                                </div>
                                <!-- inline-facts end -->
                                <!-- inline-facts  -->
                                <div class="inline-facts-wrap">
                                    <div class="inline-facts">
                                        <i class="fal fa-award"></i>
                                        <div class="milestone-counter">
                                            <div class="stats animaper">
                                                <div class="num" data-content="0" data-num="172">172</div>
                                            </div>
                                        </div>
                                        <h6>Won Awards</h6>
                                    </div>
                                </div>
                                <!-- inline-facts end -->
                                <!-- inline-facts  -->
                                <div class="inline-facts-wrap">
                                    <div class="inline-facts">
                                        <i class="fal fa-hotel"></i>
                                        <div class="milestone-counter">
                                            <div class="stats animaper">
                                                <div class="num" data-content="0" data-num="732">732</div>
                                            </div>
                                        </div>
                                        <h6>New Listing of Hotel</h6>
                                    </div>
                                </div>
                                <!-- inline-facts end -->
                            </div>
                        </div>
                    </section>';
$jVars['module:whychooseus'] = $whychooseus;


/**
 *           Hotel Search Result
 */
$reshotels = $search_form = $result_for = '';

if (defined('HOTELSEARCH_PAGE') and !empty($_REQUEST['code'])) {
    $code = addslashes($_REQUEST['code']);
    $urldecode = unserialize(base64_decode(strtr($code, '-_', '+/')));

    foreach ($urldecode as $key => $val) {
        $$key = $val;
    }

    if (!empty($checkin) and !empty($checkout)) {
        $session->set('checkin', $checkin);
        $session->set('checkout', $checkout);
    }

    if (!empty($adults)) {
        $session->set('adults', $adults);
    }

    if (!empty($child)) {
        $session->set('child', $child);
    }

    $searchkey = '';
    $search = !empty($hotelid) ? $hotelid : $searchkey;

    $nsql = "SELECT ht.code, ht.id, ht.star, ht.slug, ht.title, ht.home_image, ht.feature , ht.map, ht.destinationId, ht.street, ht.city, ht.zone, ht.district, ht.image, ht.detail, 
                    rd.currency, rp.one_person, ro.discount
        FROM tbl_apihotel AS ht 
        LEFT JOIN tbl_roomapi AS rd
        ON ht.id = rd.hotel_id
        LEFT JOIN tbl_roomapi_price AS rp 
        ON rd.id = rp.room_id
        LEFT JOIN tbl_roomapi_offers AS ro 
        ON rd.hotel_id = ro.hotel_id
        WHERE ht.status='1' ";

    if (!empty($destination_id)) {
        if ($destination_id != 'all') {
            $destination_title = Destination::field_by_id($destination_id, "title");
            $result_for = '
                <div class="list-main-wrap-title col-title">
                    <h2>Results For : <span>' . $destination_title . '</span></h2>
                </div>
            ';
            $nsql .= " AND ht.destinationId = '$destination_id' ";
        }
    }

    if (!empty($price_range)) {
        $prices = explode(';', $price_range);
        if (!empty($prices[0]) and !empty($prices[1])) {
            $nsql .= " AND ( rp.one_person >= $prices[0] AND rp.one_person <= $prices[1]) ";
        }
    }

    if (!empty($rating) and is_array($rating)) {
        foreach ($rating as $star) {
            if (sizeof($rating) > 1) {
                if (array_values($rating)[0] == $star) {
                    $nsql .= " AND ( ht.star = $star ";
                } elseif (end($rating) == $star) {
                    $nsql .= " OR ht.star = $star )";
                } else {
                    $nsql .= " OR ht.star = $star ";
                }
            } else {
                $nsql .= " AND ht.star = $star ";
            }
        }
    }

    if (!empty($search)) {
        $hotell = Hotelapi::find_by_code($search);
        $search = (!empty($hotell)) ? $hotell->title : $search;
        $result_for = '
            <div class="list-main-wrap-title col-title">
                <h2>Results For : <span>' . $search . '</span></h2>
            </div>
        ';
        $nsql .= " AND ( 
        ht.code like '%" . $search . "%' 
        OR CONVERT(ht.title USING utf8) like '%" . $search . "%' 
		OR CONVERT(ht.street USING utf8) like '%" . $search . "%' 
	   	OR CONVERT(ht.city USING utf8) like '%" . $search . "%' 
	   	OR CONVERT(ht.zone USING utf8) like '%" . $search . "%'
	   	OR CONVERT(ht.district USING utf8) like '%" . $search . "%'
        OR CONVERT(ht.country USING utf8) like '%" . $search . "%') ";
    }

    $nsql .= " GROUP BY ht.id ORDER BY locate('$search', code) DESC";

    $nquery = $db->query($nsql);
    $totRec = $db->num_rows($nquery);

    if ($totRec > 0) {
        while ($row = $db->fetch_object($nquery)) {
            $img = BASE_URL . 'template/nepalhotel/images/gal/1.jpg';
            $file_path = SITE_ROOT . 'images/hotelapi/home/' . $row->home_image;
            if (!empty($row->home_image) and file_exists($file_path)) {
                $img = IMAGE_PATH . 'hotelapi/home/' . $row->home_image;
            }
            $discount = (!empty($row->discount)) ? '<div class="sale-window">Sale ' . $row->discount . '%</div>' : '';
            $length = strlen($row->detail);
            $elipses = ($length > 120) ? '...' : '';

            $reshotels .= '
                    <div class="listing-item has_one_column " data-jplist-item>
                        <article class="geodir-category-listing fl-wrap">
                            <div class="geodir-category-img">
                                <a href="' . BASE_URL . 'hotel/' . $row->slug . '"><img src="' . $img . '" alt="' . $row->title . '"></a>
                              
                                ' . $discount . '
                                <div class="geodir-category-opt d-none">
                                    <div class="listing-rating card-popup-rainingvis" data-starrating2="' . $row->star . '"></div>
                                    <div class="rate-class-name " style="opacity:0;">
                                        <div class="score"><strong></strong></div>
                                        <span><a href="' . BASE_URL . 'hotel/' . $row->slug . '">More</a></span> 
                                    </div>
                                </div>
                            </div>
    
                            <div class="geodir-category-content fl-wrap title-sin_item">
                                <div class="geodir-category-content-title ">
                                    <div class="geodir-category-content-title-item">
                                        <h3 class="title-sin_map">
                                            <a href="' . BASE_URL . 'hotel/' . $row->slug . '" class="ttitle">' . $row->title . '</a>
                                        </h3>
                                        <div class="geodir-category-location fl-wrap">
                                            <a href="#" class="map-item">
                                                <i class="fas fa-map-marker-alt"></i> ' . $row->street . ' ' . $row->city . '
                                                </a>
                                            </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                ';
            /*
            $rooms = Roomapi::find_by_active_room($row->id);
            foreach ($rooms as $room) {
                $priceRoom = Roomapiprice::find_by_room_id($room->id);
                $imageRec = unserialize(base64_decode($room->image));
                $amenity = '';
                if ($room->feature != '') {
                    $feature = unserialize(base64_decode($room->feature));
                    $count = 0;
                    foreach ($feature as $key => $val) {
                        if ($val['id'] == '165') {
                            foreach ($val['features'] as $k => $v) {
                                if (array_key_exists('id', $v)) {
                                    if ($k != 'id' and $count < 4) {
                                        $count++;
                                        $amenity .= ' <li><i class="' . $v['icon_class'] . '"></i><span>' . $v['title'] . '</span></li>';
                                    }
                                }
                            }
                        }
                    }
                }
            }
            */
            $amenity = '';
            if ($row->feature != '') {
                $feature = unserialize(base64_decode($row->feature));
                $count = 0;
                foreach ($feature as $key => $val) {
                    if (is_array($val['features'])) {
                        foreach ($val['features'] as $k => $v) {
                            if (array_key_exists('id', $v)) {
                                if ($k != 'id' and $count < 4) {
                                    $count++;
                                    $amenity .= '<li><i class="' . $v['icon_class'] . '"></i><span>' . $v['title'] . '</span></li>';
                                }
                            }
                        }
                    }
                }
            }
            $reshotels .=  
                                '<div class="d-flex">
                                <div class="mt-2 me-3 badge bg-light text-dark">'.$row->star.'</div>
                                <ul class="facilities-list fl-wrap liststyle w-auto">
                                    ' . $amenity . '
                                </ul>
                                </div>
                                <div class="geodir-category-footer fl-wrap">
                                    <!--<div class="geodir-category-price">Awg/Night <span>$ <span class="price">320</span></span>-->
                                    <div class="geodir-category-price"><span>' . $row->currency . ' <span class="price">' . (!empty($row->one_person) ? $row->one_person : 0) . '</span></span>
                                    </div>
                                    <div class="geodir-opt-list">
                                        <!--<a href="#" class="single-map-item" data-newlatitude="40.72956781" data-newlongitude="-73.99726866">
                                            <i class="fal fa-map-marker-alt"></i><span class="geodir-opt-tooltip">On the map</span>
                                        </a>
                                        <a href="#" class="geodir-js-favorite">
                                            <i class="fal fa-heart"></i><span class="geodir-opt-tooltip">Save</span>
                                        </a>-->
                                        <a href="' . $row->map . '"  target="_blank" class="geodir-js-booking">
                                            <i class="fal fa-exchange"></i><span class="geodir-opt-tooltip">Find Directions</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </div>
            ';
        }
    } else {
        redirect_to(BASE_URL);
    }


    /**
     *      Search Form in search page
     */
    $search_form .= '
            <form id="hotelsearchform" action="" method="post">
            <h3 class="fs-5 text-start">Search Stays</h3>
                <!--col-list-search-input-item -->
                <div class="col-list-search-input-item in-loc-dec fl-wrap not-vis-arrow">
                    <label>Destination</label>
                    <div class="listsearch-input-item">
                        <select data-placeholder="City" class="chosen-select" name="destination_id">
                            <option value="all">All Destinations</option>
                            ';
    $destinations = Destination::find_all();
    if (!empty($destinations)) {
        foreach ($destinations as $destination) {
            $sel = '';
            if (!empty($destination_id)) {
                $sel = ($destination_id == $destination->id) ? 'selected="selected"' : '';
            }
            $search_form .= '<option value="' . $destination->id . '" ' . $sel . '>' . $destination->title . '</option>';
        }
    }
    $search_form .= '
                        </select>
                    </div>
                </div>
                <!--col-list-search-input-item end-->

                <!--col-list-search-input-item -->
                <!--<div class="col-list-search-input-item fl-wrap location autocomplete-container">
                    <label>Hotels, City...</label>
                    <span class="header-search-input-item-icon"><i class="fal fa-map-marker-alt"></i></span>
                    <input type="text" placeholder="Hotel , City..." id="searchkey" name="searchkey" autocomplete="off"/>
                    <a href="#"><i class="fal fa-dot-circle"></i></a>
                </div>-->
                <!--col-list-search-input-item end-->

                <!--col-list-search-input-item -->
                <!--<div class="col-list-search-input-item in-loc-dec date-container  fl-wrap">
                    <label>Date In-Out </label>
                    <span class="header-search-input-item-icon"><i class="fal fa-calendar-check"></i></span>
                    <input type="text" placeholder="When" name="dates" value=""/>
                </div>-->
                ';
    $checkin_val = (!empty($checkin)) ? 'value="' . $checkin . '"' : '';
    $checkout_val = (!empty($checkout)) ? 'value="' . $checkout . '"' : '';
    $search_form .= '
                <div class="col-list-search-input-item in-loc-dec fl-wrap">
                    <label>Date Check In</label>
                    <span class="header-search-input-item-icon"><i class="fal fa-calendar-check"></i></span>
                    <input type="text" placeholder="Check In" name="checkin" id="checkin" readonly ' . $checkin_val . '/>
                </div>
                <div class="col-list-search-input-item in-loc-dec fl-wrap">
                    <label>Date Check Out</label>
                    <span class="header-search-input-item-icon"><i class="fal fa-calendar-check"></i></span>
                    <input type="text" placeholder="Check Out" name="checkout" id="checkout" readonly ' . $checkout_val . '/>
                </div>
                <!--col-list-search-input-item end-->

                <!--col-list-search-input-item -->
                <div class="col-list-search-input-item fl-wrap">
                    <!--<div class="quantity-item">
                        <label>Rooms</label>
                        <div class="quantity">
                            <input type="number" min="1" max="3" step="1" value="1">
                        </div>
                    </div>-->
                    ';
    $adults_val = (!empty($adults)) ? $adults : '1';
    $child_val = (!empty($child)) ? $child : '0';
    $search_form .= '
                    <div class="quantity-item">
                        <label>Adults</label>
                        <div class="quantity">
                            <input type="number" name="adults" min="1" max="5" step="1" value="' . $adults_val . '">
                        </div>
                    </div>
                    <div class="quantity-item">
                        <label>Children</label>
                        <div class="quantity">
                            <input type="number" name="child" min="0" max="3" step="1" value="' . $child_val . '">
                        </div>
                    </div>
                </div>
                <!--col-list-search-input-item end-->

                <!--col-list-search-input-item -->
                <div class="col-list-search-input-item fl-wrap">
                    <div class="range-slider-title">Price range</div>
                    <div class="range-slider-wrap fl-wrap">
                    ';
    $prsql = "SELECT MIN(rp.one_person) as min_price, MAX(rp.one_person) as max_price, ro.discount
        FROM tbl_apihotel AS ht 
        LEFT JOIN tbl_roomapi AS rd
        ON ht.id = rd.hotel_id
        LEFT JOIN tbl_roomapi_price AS rp 
        ON rd.id = rp.room_id
        LEFT JOIN tbl_roomapi_offers AS ro 
        ON rd.hotel_id = ro.hotel_id
        WHERE ht.status='1' ";
    $prres = $db->query($prsql);
    $res = $db->fetch_array($prres);
    $price_range_min_val = $res['min_price'];
    $price_range_max_val = $res['max_price'];
    if (!empty($price_range)) {
        $prices = explode(';', $price_range);
        $price_range_min_val = (!empty($prices[0])) ? $prices[0] : $price_range_min_val;
        $price_range_max_val = (!empty($prices[1])) ? $prices[1] : $price_range_max_val;
    }
    $search_form .= '
                        <input class="range-slider" name="price_range"
                               data-from="' . $price_range_min_val . '"
                               data-to="' . $price_range_max_val . '"
                               data-step="50"
                               data-min="' . $res['min_price'] . '"
                               data-max="' . $res['max_price'] . '"
                               data-prefix="$">
                    </div>
                </div>
                <!--col-list-search-input-item end-->

                <!--col-list-search-input-item -->
                <div class="col-list-search-input-item fl-wrap">
                    <label>Star Rating</label>
                    <div class="search-opt-container fl-wrap">
                        <!-- Checkboxes -->
                        <ul class="fl-wrap filter-tags">
                        ';
    $starRatings = Starrating::find_all();
    if (!empty($starRatings)) {
        foreach ($starRatings as $starRating) {
            $checked = '';
            if (!empty($rating)) {
                $checked = (in_array($starRating->title, $rating)) ? 'checked' : '';
            }
            $search_form .= '
                            <li class="">
                                <input id="check-aa' . $starRating->id . '" type="checkbox" name="rating[]" value="' . $starRating->title . '" ' . $checked . '>
                                <label for="check-aa' . $starRating->id . '">
                                    <span class="listing-rating card-popup-rainingvis">
                                        <span>' . $starRating->title . '</span>
                                    </span>
                                </label>
                            </li>
             ';
        }
    }

    $five_star_check = $four_star_check = $three_star_check = '';
    /*
    if (!empty($rating) and is_array($rating)) {
        $five_star_check = (in_array(5, $rating)) ? 'checked' : '';
        $four_star_check = (in_array(4, $rating)) ? 'checked' : '';
        $three_star_check = (in_array(3, $rating)) ? 'checked' : '';
    }
    */
    $search_form .= '
                        </ul>
                        <!--
                        <ul class="fl-wrap filter-tags">
                            <li class="five-star-rating">
                                <input id="check-aa2" type="checkbox" name="rating[]" value="5" ' . $five_star_check . '>
                                <label for="check-aa2">
                                   
                                        <span>5 Stars</span>
                                    </span>
                                </label>
                            </li>
                            <li class="four-star-rating">
                                <input id="check-aa3" type="checkbox" name="rating[]" value="4" ' . $four_star_check . '>
                                <label for="check-aa3">
                                   
                                        <span>4 Stars</span>
                                    </span>
                                </label>
                            </li>
                            <li class="three-star-rating">
                                <input id="check-aa4" type="checkbox" name="rating[]" value="3" ' . $three_star_check . '>
                                <label for="check-aa4">
                                  
                                        <span>3 Stars</span>
                                    </span>
                                </label>
                            </li>
                        </ul>
                        -->
                        <!-- Checkboxes end -->
                    </div>
                </div>
                <!--col-list-search-input-item end-->

                <!--col-list-search-input-item -->
                <!--<div class="col-list-search-input-item fl-wrap">
                    <label>Facility</label>
                    <div class="search-opt-container fl-wrap">
                        <ul class="fl-wrap filter-tags half-tags">
                            <li>
                                <input id="check-aaa5" type="checkbox" name="check" checked>
                                <label for="check-aaa5">Free WiFi</label>
                            </li>
                            <li>
                                <input id="check-bb5" type="checkbox" name="check">
                                <label for="check-bb5">Parking</label>
                            </li>
                            <li>
                                <input id="check-dd5" type="checkbox" name="check">
                                <label for="check-dd5">Fitness Center</label>
                            </li>
                        </ul>
                        <ul class="fl-wrap filter-tags half-tags">
                            <li>
                                <input id="check-ff5" type="checkbox" name="check">
                                <label for="check-ff5">Airport Shuttle</label>
                            </li>
                            <li>
                                <input id="check-cc5" type="checkbox" name="check" checked>
                                <label for="check-cc5">Non-smoking Rooms</label>
                            </li>
                            <li>
                                <input id="check-c4" type="checkbox" name="check" checked>
                                <label for="check-c4">Air Conditioning</label>
                            </li>
                        </ul>
                    </div>
                </div>-->
                <!--col-list-search-input-item end-->

                <!--col-list-search-input-item  -->
                <div class="col-list-search-input-item fl-wrap">
                    <button class="header-search-button" type="submit">Search <i class="far fa-search"></i></button>
                </div>
                <!--col-list-search-input-item end-->
            </form>
    ';
}

$jVars['module:hotelsearch-list'] = $reshotels;
$jVars['module:hotelsearch-form'] = $search_form;
$jVars['module:hotelsearch-result-for'] = $result_for;


$hotellist = $hotbread = '';
if (defined('DESTINATION_PAGE') and !empty($_REQUEST['slug'])) {
    $slug = addslashes($_REQUEST['slug']);
    $des = Destination::find_by_slug($slug);
    if ($des) {
//$des=Destination::find_all();
        $hotbread .= '<div class="breadcrumbs-fs fl-wrap">
                    <div class="container">
                        <div class="breadcrumbs fl-wrap"><a href="' . BASE_URL . 'home">Home</a><a href="' . BASE_URL . 'destination">Destination</a><span>Hotel</span></div>
                    </div>
                </div>';
        $hotellist .= '<section id="sec1" class="middle-padding">
                    <div class="container">
                        <!--about-wrap --> 
                        <div class="about-wrap">
                            <div class="row">
                            <div class="col-sm-12"><h1 class="text-start fs-4 mb-3"><strong>List of Hotels</strong> </h1></div>
                            ';
//foreach ($des as $dess) {
        $hdls = Hotelapi::get_hotel_by_destid($des->id);
        //echo "<pre>";print_r($hdls);die();


        foreach ($hdls as $rhapiRow) {
            $imgname = $rhapiRow->home_image;


            $hotellist .= '  <div class="col-md-4">
                                    <div class="listing-item1"> 
                                    <article class="geodir-category-listing fl-wrap mb-4">
                                            <div class="geodir-category-img1">
                                                <a href="' . BASE_URL . 'hotel/' . $rhapiRow->slug . '" tabindex="-1">';
            if ($imgname) {
                $hotellist .= '<img src="' . IMAGE_PATH . 'hotelapi/home/' . $imgname . '" alt=" ' . $rhapiRow->title . '" width="100%">';
            } else {
                $hotellist .= '<div style="width:100%;height:230px;background:#18458b"></div>';
            }
            $hotellist .= '</a></div>
                                            <div class="geodir-category-content fl-wrap title-sin_item">
                                                <div class="geodir-category-content-title fl-wrap">
                                                    <div class="geodir-category-content-title-item">
                                                   
                                                        <h3 class="title-sin_map"><a href="' . BASE_URL . 'hotel/' . $rhapiRow->slug . '" tabindex="-1">' . $rhapiRow->title . '</a></h3>
                                                        <div class="geodir-category-location fl-wrap"><a href="#" class="map-item" tabindex="-1"><i class="fas fa-map-marker-alt"></i> ' . $rhapiRow->street . ' ' . $rhapiRow->city . '</a></div>
                                                    </div>
                                                </div>
                                               ';


            $amenity = '';
            if ($rhapiRow->feature != '') {

                $feature = unserialize(base64_decode($rhapiRow->feature));
                $count = 0;
                foreach ($feature as $key => $val) {
                    if (!empty($val['features'])) {
                        foreach ($val['features'] as $k => $v) {
                            if (array_key_exists('id', $v)) {
                                if ($k != 'id' and $count < 4) {
                                    $count++;
                                    $amenity .= '<li><i class="' . $v['icon_class'] . '"></i><span>' . $v['title'] . '</span></li>';
                                }
                            }
                        }
                    }
                }

            }

            $hotellist .= '<ul class="facilities-list fl-wrap">
                                                
                                                  ' . $amenity . '</ul>
                                                <div class="geodir-category-footer fl-wrap">
                                                    <div class="geodir-category-price"><span><a href="' . BASE_URL . 'hotel/' . $rhapiRow->slug . '">More</a></span></div>
                                                    
                                                    <div class="geodir-opt-list">
                                                       
                                                        <a href="' . $rhapiRow->map . '" class="geodir-js-booking" target="_blank">
                                                        <i class="fal fa-exchange"></i>
                                                        <span class="geodir-opt-tooltip">Find  </span></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
                                    </div>';
        }
        $hotellist .= ' </div>
                        </div>
                        <!-- about-wrap end  --> 
                            
                    </div>
                </section>';

    }


}

$jVars['module:hotbread'] = $hotbread;
$jVars['module:homedestlist'] = $hotellist;


