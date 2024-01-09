<?php
/*
* Hotel detail by Slug
*/
$resbread = $reshotel = $ban = '';
$faqdetails='';
if (!empty($_REQUEST['slug'])) {
    $slug = addslashes($_REQUEST['slug']);

    // $sql = "SELECT *  FROM tbl_roomapi_offers WHERE status='1' ORDER BY sortorder DESC "; 
    $recRow = Hotelapi::find_by_slug($slug);
    $pkgRec = Hallapi::find_by_sql($sql);
    // $sql = "SELECT *  FROM tbl_hall WHERE status='1' ORDER BY sortorder DESC ";
    // foreach ($pkgRec as $key => $subpkgRow) {
    

    //     $imgall = unserialize(base64_decode($subpkgRow->image));
    //     $images = '';

    //     if (is_array($imgall)) {

    //         for ($i = 0; $i < count($imgall); $i++) {
    //             if ($i != count($imgall) - 1) {
    //                 if (file_exists(SITE_ROOT . "images/hallapi/" . @$imgall[$i])) {
    //                     $images .= IMAGE_PATH . 'hallapi/' . $imgall[$i] . ',';
    //                 }
    //             } else {
    //                 if (file_exists(SITE_ROOT . "images/hallapi/" . @$imgall[$i])) {
    //                     $images .= IMAGE_PATH . 'hallapi/' . @$imgall[$i];
    //                 }
    //             }
    //         }
    //     }

    //     // checking if checkin and checkout dates are available
    //     $dateQuery = '';
    //     $checkinDate = $session->get('checkin');
    //     $checkoutDate = $session->get('checkout');
    //     if (!empty($checkinDate) and !empty($checkoutDate)) {
    //         $dateQuery = "&hotel_check_in=$checkinDate&hotel_check_out=$checkoutDate";
    //     }

    //     $userIdQuery = '';
    //     $usserId = $session->get('user_id');
    //     if (!empty($usserId)) {
    //         $userIdQuery = "&user_id=$usserId";
    //     }
    //     $adults = (!empty($session->get('adults'))) ? $session->get('adults') : 1;
    //     $child = (!empty($session->get('child'))) ? $session->get('child') : 0;

    //     $reviews = Review::find_by_package($subpkgRow->id);
    //     $halldetails='
        
    //     <div class="col-lg-5 col-md-6 col-sm-6">
    //         <div class="grid-image">
    //             <img src="'.$images.'" alt="image">
    //         </div>
    //     </div>

    //     <div class="col-lg-7 col-md-6 col-sm-6">
    //         <div class="grid-content">
    //             <div class="room-title">
    //                 <h4>'.$subpkgRow->title.'</h4>
    //                 <div class="room-services">
    //                     <ul>
    //                         <li>Capacity: '.$subpkgRow->max_people.'</li>
    //                         <li>|</li>
    //                         <li>Area: '.$subpkgRow->hall_size.' '.$subpkgRow->hall_size_label.'</li>
    //                         <li>|</li>
    //                         <li>Dimension: '.$subpkgRow->no_hall.'</li>
    //                         <li>|</li>
    //                         <li>Height: '.$subpkgRow->smoking.'</li>
    //                     </ul>
    //                 </div>
    //             </div>

    //             <div class="room-detail">
    //             '.$subpkgRow->detail.'
    //             </div>
                
    //             <div class="grid-btn mar-top-20">
    //                 <div class="row">
    //                     <div class="col-lg-12 col-md-12">
    //                         <h4>Seating Style</h4>
    //                     </div>
                    
    //                     <div class="col-lg-12 col-md-6">
    //                         <ul>
    //                             <li class="pad-right-20"><p><img src="template/nepalhotel/images/icons/bottle.png">Theatre: '.$subpkgRow->seat_a.'</p></li> 
    //                             <li><p><img src="template/nepalhotel/images/icons/ac.png"> Cicular: '.$subpkgRow->seat_b.'<p></li>
    //                             <li><p><img src="template/nepalhotel/images/icons/ac.png"> U-shaped: '.$subpkgRow->seat_c.'<p></li>
    //                         </ul>

    //                         <ul>
    //                             <li><p><img src="template/nepalhotel/images/icons/bottle.png">Theatre: '.$subpkgRow->seat_d.'</p></li> 
    //                             <li><p><img src="template/nepalhotel/images/icons/ac.png"> Cicular: '.$subpkgRow->seat_e.'<p></li>
    //                             <li><p><img src="template/nepalhotel/images/icons/ac.png"> U-shaped: '.$subpkgRow->seat_f.'<p></li>
    //                         </ul>
    //                     </div>

    //                     <div class="col-lg-3 col-md-6 mar-top-25">
    //                         <a href="#" class="btn btn-black mar-right-10">Enquiry</a>
    //                     </div>
    //                 </div>
    //             </div>
    //         </div>
        
    // </div>';


    // }
    if (!empty($recRow)) {

        // $imgall = unserialize(base64_decode($recRow->image));
        // $images = '';

        // if (is_array($imgall)) {

        //     for ($i = 0; $i < count($imgall); $i++) {
        //         if ($i != count($imgall) - 1) {
        //             if (file_exists(SITE_ROOT . "images/hotelapi/" . @$imgall[$i])) {
        //                 $images .= IMAGE_PATH . 'hotelapi/' . $imgall[$i] . ',';
        //             }
        //         } else {
        //             if (file_exists(SITE_ROOT . "images/hotelapi/" . @$imgall[$i])) {
        //                 $images .= IMAGE_PATH . 'hotelapi/' . @$imgall[$i];
        //             }
        //         }
        //     }
        // }
        $imgall = $recRow->banner_image;
        $images = '';

        if (is_array($imgall)) {

            for ($i = 0; $i < count($imgall); $i++) {
                if ($i != count($imgall) - 1) {
                    if (file_exists(SITE_ROOT . "images/hotelapi/" . @$imgall[$i])) {
                        $images .= IMAGE_PATH . 'hotelapi/' . $imgall[$i] . ',';
                    }
                } else {
                    if (file_exists(SITE_ROOT . "images/hotelapi/" . @$imgall[$i])) {
                        $images .= IMAGE_PATH . 'hotelapi/' . @$imgall[$i];
                    }
                }
            }
        }

        // checking if checkin and checkout dates are available
        $dateQuery = '';
        $checkinDate = $session->get('checkin');
        $checkoutDate = $session->get('checkout');
        if (!empty($checkinDate) and !empty($checkoutDate)) {
            $dateQuery = "&hotel_check_in=$checkinDate&hotel_check_out=$checkoutDate";
        }

        $userIdQuery = '';
        $usserId = $session->get('user_id');
        if (!empty($usserId)) {
            $userIdQuery = "&user_id=$usserId";
        }

        $adults = (!empty($session->get('adults'))) ? $session->get('adults') : 1;
        $child = (!empty($session->get('child'))) ? $session->get('child') : 0;

        $reviews = Review::find_by_package($recRow->id);
        $rescontwed = explode('<hr id="system_readmore" style="border-style: dashed; border-color: orange;" />', trim($recRow->weddinghall));
        $rescontrest = explode('<hr id="system_readmore" style="border-style: dashed; border-color: orange;" />', trim($recRow->restaurant));
        $rescontfit = explode('<hr id="system_readmore" style="border-style: dashed; border-color: orange;" />', trim($recRow->imp_info));
        $resbread .= '
        <section class="breadcrumb-outer" 
        style="background-image: url('.BASE_URL.'images/hotelapi/banner/'.$imgall.') no-repeat;
        background-size: cover;
        background-position: center;
        position: relative;
        text-align: center;
        padding: 330px 0px 140px;
        ">
            <div class="container">
                <div class="breadcrumb-content">
                    <div hidden="hidden"><h2>Hotel and Resorts</h2></div>
                </div>
            </div>
        </section>';
        
        // Hotel Detail
        
        $resbread .= '
        '.$jVars['module:booking_undergallery'].'
        <div class="container-xxl px-md-5 px-4">
            <div class="detail-content">
                <div class="detail-title">
                    <div class="title-left">
                        <h3>'.$recRow->title.'</h3>
                        <div class="title-right pull-right">
                            <ul>
                            
                                <li>'.$recRow->street.'</li>
                                <li>|</li>
                                <li>'.$recRow->contact_no.'</li>
                                <li>|</li>
                                <li>
                                    <div class="rating">
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="overview-inner">
                    <ul>
                        <li>Overview</li>
                        <li>|</li>
                        <li>Rooms</li>
                        <li>|</li>
                        <li><a href="'.BASE_URL.'hotel/'.$recRow->slug.'/restaurant">Restaurant & Bar</a></li>
                        <li>|</li>
                        <li><a href="'.BASE_URL.'hotel/'.$recRow->slug.'/wedding">Wedding</a></li>
                        <li>|</li>
                        <li><a href="'.BASE_URL.'hotel/'.$recRow->slug.'/hall">Meeting & Events</li>
                        <li>|</li>
                        <li><a href="'.BASE_URL.'hotel/'.$recRow->slug.'/fitness">Fitness</a></li>
                        <li>|</li>
                        <li>Reviews</li>
                        <li>|</li>
                        <li><a href="'.BASE_URL.'hotel/'.$recRow->slug.'/contact">Contact</a></li>
                    </ul>

                    ';

        
                    //if (defined('HOTELDETAIL_PAGE')){}           
        $reshotel .= $recRow->content;
        


        $reshotel .= '<div class="overview-two">
            <div class="room-grid d-none">
                <h4>Rooms</h4>
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="grid-image">
                            <img src="images/room-list/grid1.jpg" alt="image">
                        </div>
                    </div>

                    <div class="col-lg-8 col-md-6 col-sm-6">
                        <div class="grid-content">
                            <div class="room-title">
                                <h4>Standard Suite</h4>
                                <div class="room-services">
                                    <div class="row">
                                        <div class="col-md-4 col-sm-4 col-xs-6">
                                            Occupancy: 3 
                                        </div>
                                        <div class="col-md-4 col-sm-4 col-xs-6">
                                            Bed Type: King Size
                                        </div>
                                        <div class="col-md-4 col-sm-4 col-xs-6">
                                            Area: 54m
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="room-detail">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ex neque, sodales accumsan sapien et, auctor vulputate quam donec vitae consectetur turpis</p>
                            </div>
                            
                            <div class="grid-btn mar-top-20">
                                <div class="row">
                                    <div class="col-lg-4 col-md-6">
                                        <h4 style="margin-top: 12px;">NRs. 1800</h4>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <a href="#" class="btn btn-black mar-right-10">Read More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
                                     ';


        // $reshotel = '<div class="overview-two">
        // <div class="room-grid d-none">
        //     <h4>Meeting and Events</h4> 
        //     '. $halldetails .'
        //     </div> 
        //     </div>';

        $reshotel .= ' <div class="overview-one">
        <h4>Amenities</h4>
        <div class="row">  ';
        $count = 0;
        if ($recRow->feature != '') {
            $feature = unserialize(base64_decode($recRow->feature));
            
            $feature = $feature[5];
            if (is_array($feature['features'])) {
                foreach ($feature['features'] as $k => $v) {
                   //print_r($v);
                    if (array_key_exists('id', $v)) {
                        if ($k != 'id') {
                            $reshotel .= '
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <!--<img src="..." alt="...">-->
                                        <i class="'.$v['icon_class'].'" ></i>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                    <p>' . $v['title'] . '</p>
                                    </div>
                                </div>
                            </div>
                                ';
                        }
                    }
                }
            }
        }
        $reshotel .= ' </div>
        </div>  ';

        $reshotel .=  $rescontwed[0] ;
        $reshotel .=  $rescontfit[0] ;
        $reshotel .=  $rescontrest[0];
    $sql = "SELECT *  FROM tbl_roomapi_offers WHERE status='1' ORDER BY sortorder DESC ";
    
    $faqrec = Roomoffers::find_by_sql($sql);
    foreach($faqrec as $i =>$faq){
            $collapsed = ($i == 0) ? 'collapsed' : '';
            $show = ($i == 0) ? 'show' : '';
            $faqdetails .='
            <div class="accordion-item">
            <h2 class="accordion-header" id="head'.$faq->id.'">
                <button class="accordion-button '.$collapsed.'" type="button" data-bs-toggle="collapse" data-bs-target="#collapse'.$faq->id.'" aria-expanded="true" aria-controls="collapseOne">
                '.$faq->title.'
                </button>
            </h2>
            <div id="collapse'.$faq->id.'" class="accordion-collapse collapse '.$show.'" aria-labelledby="head'.$faq->id.'" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                '.$faq->content.'
                </div>
            </div>
        </div>';
        }

        $reshotel .= ' <div class="overview-one">
        <h4>FAQ</h4>
        <div class="accordion" id="accordionExample">
        '.$faqdetails.'

        </div>
    </div>

    <div class="overview-one">
        <h4>Review</h4>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="review-item">
                    <div class="review-image">
                        <img src="images/review1.jpg" alt="image">
                    </div>
                    <div class="review-content">
                        <p class="date">Mahesh Gautam, Nepal, July 2023 </p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin id iaculis arcu. Aenean non dolor magna. In sed consectetur nisi. Sed venenatis, nibh sit amet sodales ullamcorper, ipsum orci condimentum tortor, et cursus veli.tturpis at justo. Vivamus pellentesque volutpat urna vel eleifend. </p>
                    </div>
                </div>
            </div>
        </div>
    </div>   ';

        

        $reshotel .= '                         </div>
        </div>
    </div>
</section>';


    }

}





$jVars['module:hotelbreadcrumb'] = $resbread;
$jVars['module:hotel-details'] = $reshotel;





$restbread = $resthotel = $ban = '';

if (defined('RESTAURANTDETAIL_PAGE') and !empty($_REQUEST['slug']) and !empty($_REQUEST['restaurant'])) {
    
    $slug = addslashes($_REQUEST['slug']);

    $recRow = Hotelapi::find_by_slug($slug);

    if (!empty($recRow)) {

        $imgall = unserialize(base64_decode($recRow->image));
        $images = '';

        if (is_array($imgall)) {

            for ($i = 0; $i < count($imgall); $i++) {
                if ($i != count($imgall) - 1) {
                    if (file_exists(SITE_ROOT . "images/hotelapi/" . @$imgall[$i])) {
                        $images .= IMAGE_PATH . 'hotelapi/' . $imgall[$i] . ',';
                    }
                } else {
                    if (file_exists(SITE_ROOT . "images/hotelapi/" . @$imgall[$i])) {
                        $images .= IMAGE_PATH . 'hotelapi/' . @$imgall[$i];
                    }
                }
            }
        }
        $rescontrest = explode('<hr id="system_readmore" style="border-style: dashed; border-color: orange;" />', trim($recRow->restaurant));
        $contentres = !empty($rescontrest[1]) ? $rescontrest[1] : $rescontrest[0];
        // checking if checkin and checkout dates are available
        $dateQuery = '';
        $checkinDate = $session->get('checkin');
        $checkoutDate = $session->get('checkout');
        if (!empty($checkinDate) and !empty($checkoutDate)) {
            $dateQuery = "&hotel_check_in=$checkinDate&hotel_check_out=$checkoutDate";
        }

        $userIdQuery = '';
        $usserId = $session->get('user_id');
        if (!empty($usserId)) {
            $userIdQuery = "&user_id=$usserId";
        }
        $t = Destination::find_by_id($recRow->destinationId);
        $adults = (!empty($session->get('adults'))) ? $session->get('adults') : 1;
        $child = (!empty($session->get('child'))) ? $session->get('child') : 0;

        $reviews = Review::find_by_package($recRow->id);
        $resthotel .='
                    <div class="overview-one">
                    <h4>
		            Restaurant & Bar</h4>
	                <div class="room-outer">
                    '. $contentres .'                 
                </div>
                </div>
                </div>
            </div>
        </div>
    </section>
    <!-- details Ends -->
    '.$jVars['module:hotel-offers'].'
    <!-- Deals and offer starts -->
    

                    ';

     

        

        $resthotel .= '                         </div>
        </div>
    </div>
</section>';


    }

}

$jVars['module:restaurantbreadcrumb'] = $restbread;
$jVars['module:restaurant-details'] = $resthotel;


$contbread='';
$conthotel='';

if (defined('CONTACTDETAIL_PAGE') and !empty($_REQUEST['slug']) and !empty($_REQUEST['contact']) ) {
    $slug = addslashes($_REQUEST['slug']);

    $recRow = Hotelapi::find_by_slug($slug);

    if (!empty($recRow)) {

        $imgall = unserialize(base64_decode($recRow->image));
        $images = '';

        if (is_array($imgall)) {

            for ($i = 0; $i < count($imgall); $i++) {
                if ($i != count($imgall) - 1) {
                    if (file_exists(SITE_ROOT . "images/hotelapi/" . @$imgall[$i])) {
                        $images .= IMAGE_PATH . 'hotelapi/' . $imgall[$i] . ',';
                    }
                } else {
                    if (file_exists(SITE_ROOT . "images/hotelapi/" . @$imgall[$i])) {
                        $images .= IMAGE_PATH . 'hotelapi/' . @$imgall[$i];
                    }
                }
            }
        }

        // checking if checkin and checkout dates are available
        $dateQuery = '';
        $checkinDate = $session->get('checkin');
        $checkoutDate = $session->get('checkout');
        if (!empty($checkinDate) and !empty($checkoutDate)) {
            $dateQuery = "&hotel_check_in=$checkinDate&hotel_check_out=$checkoutDate";
        }

        $userIdQuery = '';
        $usserId = $session->get('user_id');
        if (!empty($usserId)) {
            $userIdQuery = "&user_id=$usserId";
        }
        $t = Destination::find_by_id($recRow->destinationId);
        $adults = (!empty($session->get('adults'))) ? $session->get('adults') : 1;
        $child = (!empty($session->get('child'))) ? $session->get('child') : 0;

        $reviews = Review::find_by_package($recRow->id);
        $conthotel .='

                    <div class="overview-one mar-top-50">
                        <h4>Contact</h4>
                        <iframe src="'. $recRow->map .'" width="1150" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        <div class="row">
                            <div class="col-md-4">
                                <p>Address: '. $recRow->street .'</p>
                                <p>Tel: <a href="tel:'. $recRow->contact_no .'">'. $recRow->contact_no .'</a></p>
                                <p>Email: <a href="mailto:'. $recRow->email .'">'. $recRow->email .'</a></p>
                            </div>

                            <div class="col-md-4">
                                <p>Reservation</p>
                                <p>Tel: <a href="tel:'. $recRow->res_contact_no .'">'. $recRow->res_contact_no .'</a></p>
                                <p>Email: <a href="mailto:'. $recRow->res_email .'">'. $recRow->res_email .'</a></p>
                            </div>

                            <div class="col-md-4">
                                <p>Meeting and Events</p>
                                <p>Tel: <a href="tel:'. $recRow->meet_contact_no .'">'. $recRow->meet_contact_no .'</a></p>
                                <p>Email: <a href="mailto:'. $recRow->meet_email .'">'. $recRow->meet_email .'</a></p>
                            </div>
                        </div>
                    </div>

                    '. $recRow->map_embed .'                 
                </div>
            </div>
        </div>
    </section>
    <!-- details Ends -->
    '.$jVars['module:main-advert'].'
    <!-- Deals and offer starts -->
    

                    ';

     

        

                    $conthotel .= '                         </div>
        </div>
    </div>
</section>';


    }

}
$jVars['module:contact-details'] = $conthotel;



$fithotel='';
if (defined('FITNESSDETAIL_PAGE') and !empty($_REQUEST['slug']) and !empty($_REQUEST['fitness'])) {
    $slug = addslashes($_REQUEST['slug']);

    $recRow = Hotelapi::find_by_slug($slug);

    if (!empty($recRow)) {

        $imgall = unserialize(base64_decode($recRow->image));
        $images = '';

        if (is_array($imgall)) {

            for ($i = 0; $i < count($imgall); $i++) {
                if ($i != count($imgall) - 1) {
                    if (file_exists(SITE_ROOT . "images/hotelapi/" . @$imgall[$i])) {
                        $images .= IMAGE_PATH . 'hotelapi/' . $imgall[$i] . ',';
                    }
                } else {
                    if (file_exists(SITE_ROOT . "images/hotelapi/" . @$imgall[$i])) {
                        $images .= IMAGE_PATH . 'hotelapi/' . @$imgall[$i];
                    }
                }
            }
        }

        // checking if checkin and checkout dates are available
        $dateQuery = '';
        $checkinDate = $session->get('checkin');
        $checkoutDate = $session->get('checkout');
        if (!empty($checkinDate) and !empty($checkoutDate)) {
            $dateQuery = "&hotel_check_in=$checkinDate&hotel_check_out=$checkoutDate";
        }

        $userIdQuery = '';
        $usserId = $session->get('user_id');
        if (!empty($usserId)) {
            $userIdQuery = "&user_id=$usserId";
        }
        $t = Destination::find_by_id($recRow->destinationId);
        $adults = (!empty($session->get('adults'))) ? $session->get('adults') : 1;
        $child = (!empty($session->get('child'))) ? $session->get('child') : 0;

        $reviews = Review::find_by_package($recRow->id);
        $rescontfit = explode('<hr id="system_readmore" style="border-style: dashed; border-color: orange;" />', trim($recRow->imp_info ));
        $contentfit = !empty($rescontfit[1]) ? $rescontfit[1] : $rescontfit[0];
        $fithotel .='
                    <div class="overview-one">
                    <h4>
		            Fitness</h4>
	                <div class="room-outer">
                    '. $contentfit .'                 
                </div>
                </div>
                </div>
            </div>
        </div>
    </section>
    <!-- details Ends -->
    '.$jVars['module:main-advert'].'
    <!-- Deals and offer starts -->
    

                    ';

     

        

        $fithotel .= '                         </div>
        </div>
    </div>
</section>';


    }

}
$jVars['module:fitness-details'] = $fithotel;

$wedhotel='';
if (defined('WEDDINGDETAIL_PAGE') and !empty($_REQUEST['slug']) and !empty($_REQUEST['wedding'])) {
    $slug = addslashes($_REQUEST['slug']);

    $recRow = Hotelapi::find_by_slug($slug);

    if (!empty($recRow)) {

        $imgall = unserialize(base64_decode($recRow->image));
        $images = '';

        if (is_array($imgall)) {

            for ($i = 0; $i < count($imgall); $i++) {
                if ($i != count($imgall) - 1) {
                    if (file_exists(SITE_ROOT . "images/hotelapi/" . @$imgall[$i])) {
                        $images .= IMAGE_PATH . 'hotelapi/' . $imgall[$i] . ',';
                    }
                } else {
                    if (file_exists(SITE_ROOT . "images/hotelapi/" . @$imgall[$i])) {
                        $images .= IMAGE_PATH . 'hotelapi/' . @$imgall[$i];
                    }
                }
            }
        }

        // checking if checkin and checkout dates are available
        $dateQuery = '';
        $checkinDate = $session->get('checkin');
        $checkoutDate = $session->get('checkout');
        if (!empty($checkinDate) and !empty($checkoutDate)) {
            $dateQuery = "&hotel_check_in=$checkinDate&hotel_check_out=$checkoutDate";
        }

        $userIdQuery = '';
        $usserId = $session->get('user_id');
        if (!empty($usserId)) {
            $userIdQuery = "&user_id=$usserId";
        }
        $t = Destination::find_by_id($recRow->destinationId);
        $adults = (!empty($session->get('adults'))) ? $session->get('adults') : 1;
        $child = (!empty($session->get('child'))) ? $session->get('child') : 0;

        $reviews = Review::find_by_package($recRow->id);
        $rescontwed = explode('<hr id="system_readmore" style="border-style: dashed; border-color: orange;" />', trim($recRow->weddinghall));
        $contentwed = !empty($rescontwed[1]) ? $rescontwed[1] : $rescontwed[0];
        $wedhotel.='
                    <div class="overview-one">
                    <h4>
		            Weddings</h4>
	                <div class="room-outer">
                    '. $contentwed .'                 
                </div>
                </div>
                </div>
            </div>
        </div>
    </section>
    <!-- details Ends -->
    '.$jVars['module:main-advert'].'
    <!-- Deals and offer starts -->
    

                    ';

     

        

        $wedhotel .= '                         </div>
        </div>
    </div>
</section>';


    }

}
$jVars['module:wedding-details'] = $wedhotel;

$hallhotel='';
$hallpackage='';
if (defined('HALLDETAIL_PAGE') and !empty($_REQUEST['slug']) and !empty($_REQUEST['hall'])) {
    $slug = addslashes($_REQUEST['slug']);
    $sql = "SELECT *  FROM tbl_hall WHERE status='1' ORDER BY sortorder DESC ";
    
    
    $recRow = Hotelapi::find_by_slug($slug);
    $pkgRec = Hallapi::find_by_hotel($recRow->id);
    foreach ($pkgRec as $key => $subpkgRow) {
    

        $imgall = unserialize(base64_decode($subpkgRow->image));
        $images = '';

        if (is_array($imgall)) {

            for ($i = 0; $i < count($imgall); $i++) {
                if ($i != count($imgall) - 1) {
                    if (file_exists(SITE_ROOT . "images/hallapi/" . @$imgall[$i])) {
                        $images .= IMAGE_PATH . 'hallapi/' . $imgall[$i] . ',';
                    }
                } else {
                    if (file_exists(SITE_ROOT . "images/hallapi/" . @$imgall[$i])) {
                        $images .= IMAGE_PATH . 'hallapi/' . @$imgall[$i];
                    }
                }
            }
        }

        // checking if checkin and checkout dates are available
        $dateQuery = '';
        $checkinDate = $session->get('checkin');
        $checkoutDate = $session->get('checkout');
        if (!empty($checkinDate) and !empty($checkoutDate)) {
            $dateQuery = "&hotel_check_in=$checkinDate&hotel_check_out=$checkoutDate";
        }

        $userIdQuery = '';
        $usserId = $session->get('user_id');
        if (!empty($usserId)) {
            $userIdQuery = "&user_id=$usserId";
        }
        $adults = (!empty($session->get('adults'))) ? $session->get('adults') : 1;
        $child = (!empty($session->get('child'))) ? $session->get('child') : 0;

        $reviews = Review::find_by_package($subpkgRow->id);
        $hallhotel.='
        
        <div class="col-lg-5 col-md-6 col-sm-6">
            <div class="grid-image">
                <img src="'.$images.'" alt="image">
            </div>
        </div>

        <div class="col-lg-7 col-md-6 col-sm-6">
            <div class="grid-content">
                <div class="room-title">
                    <h4>'.$subpkgRow->title.'</h4>
                    <div class="room-services">
                        <ul>
                            <li>Capacity: '.$subpkgRow->max_people.'</li>
                            <li>|</li>
                            <li>Area: '.$subpkgRow->hall_size.' '.$subpkgRow->hall_size_label.'</li>
                            <li>|</li>
                            <li>Dimension: '.$subpkgRow->no_hall.'</li>
                            <li>|</li>
                            <li>Height: '.$subpkgRow->smoking.'</li>
                        </ul>
                    </div>
                </div>

                <div class="room-detail">
                '.$subpkgRow->detail.'
                </div>
                
                <div class="grid-btn mar-top-20">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <h4>Seating Style</h4>
                        </div>
                    
                        <div class="col-lg-12 col-md-6">
                            <ul>
                                <li class="pad-right-20"><p><img src="template/nepalhotel/images/icons/bottle.png">Theatre: '.$subpkgRow->seat_a.'</p></li> 
                                <li><p><img src="template/nepalhotel/images/icons/ac.png"> Cicular: '.$subpkgRow->seat_b.'<p></li>
                                <li><p><img src="template/nepalhotel/images/icons/ac.png"> U-shaped: '.$subpkgRow->seat_c.'<p></li>
                            </ul>

                            <ul>
                                <li><p><img src="template/nepalhotel/images/icons/bottle.png">Theatre: '.$subpkgRow->seat_d.'</p></li> 
                                <li><p><img src="template/nepalhotel/images/icons/ac.png"> Cicular: '.$subpkgRow->seat_e.'<p></li>
                                <li><p><img src="template/nepalhotel/images/icons/ac.png"> U-shaped: '.$subpkgRow->seat_f.'<p></li>
                            </ul>
                        </div>

                        <div class="col-lg-3 col-md-6 mar-top-25">
                            <a href="#" class="btn btn-black mar-right-10">Enquiry</a>
                        </div>
                    </div>
                </div>
            </div>
        
    </div>';


    }
    $hallpackage='
    <div class="overview-two mar-top-50">
    <div class="room-grid">
        <h4>Meeting Hall</h4>
        <div class="row mar-bottom-30">
        '.$hallhotel.'
        </div>
                    </div>                 
                </div>
            </div>
        </div>
        </div>
    </section>
        
        ';
}
$jVars['module:hall-details'] = $hallpackage;