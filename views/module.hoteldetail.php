
<?php
/*
* Hotel detail by Slug
*/
$resbread = $reshotel = $ban = '';
$faqdetails='';
$reviewdetails='';
$star='';
$starp='';
$userreview='';
$userdetails='';
if (!empty($_REQUEST['slug'])) {
    $slug = addslashes($_REQUEST['slug']);
    $hallhotel='';
    $sql = "SELECT *  FROM tbl_roomapi_offers WHERE status='1' ORDER BY sortorder DESC "; 
    $recRow = Hotelapi::find_by_slug($slug);
    if(!empty($recRow)){
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

         ($subpkgRow->hall_size_label == 'feet')? $hallabel = ' sq.ft.': $hallabel =' sq.m.';
        $hallhotel='
        
        <div class="col-lg-5 col-md-6 col-sm-6">
            <div class="grid-image">
                <img src="'.$images.'" alt="image">
            </div>
        </div>

        <div class="col-lg-7 col-md-6 col-sm-6">
            <div class="grid-content">
                <div class="hall-title">
                    <h4>'.$subpkgRow->title.'</h4>
                    <div class="room-services">
                        <ul>';
                        $hallhotel.=  ($subpkgRow->max_people != 0) ? '<li>Capacity:'.$subpkgRow->max_people.' pax</li>
                            <li>|</li>' : '';
                        $hallhotel.=  ($subpkgRow->hall_size != 0) ? ' <li>Area: '.$subpkgRow->hall_size.' '.$hallabel.'</li>
                            <li>|</li>':'';
                        $hallhotel.=  ($subpkgRow->no_hall != 0) ? ' <li>Dimension: '.$subpkgRow->no_hall.' sq.ft.</li>
                            <li>|</li>':'';
                        $hallhotel.=  ($subpkgRow->max_child != 0) ? ' <li>Height: '.$subpkgRow->max_child.' ft.</li>':'';
            $hallhotel.='</ul>
                    </div>
                </div>

                <div class="room-detail">
                '.$subpkgRow->detail.'
                </div>
                
                <div class="grid-btn mar-top-20">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <h5>Seating Style</h5>
                        </div>
                    
                        <div class="col-lg-12 col-md-6">
                            <ul class="row">';
                             $hallhotel.=($subpkgRow->seat_a != '-')?'<li class="col-md-4 col-6 mb-3">
                                     <div class="d-flex align-items-center">
                                         <div class="flex-shrink-0"><img src="'.BASE_URL.'template/nepalhotel/images/icons/theatre.svg"></div>
                                         <div class="flex-grow-1 ms-3">
                                             <small><strong>Theatre:</strong> <br> '.$subpkgRow->seat_a.' pax</small>
                                         </div>
                                     </div>    
                                 </li>':''; 
                             $hallhotel.=($subpkgRow->seat_b != '-')?'<li class="col-md-4 col-6 mb-3">
                                     <div class="d-flex align-items-center">
                                         <div class="flex-shrink-0"><img src="'.BASE_URL.'template/nepalhotel/images/icons/circular.svg"></div>
                                         <div class="flex-grow-1 ms-3">
                                             <small><strong>Circular:</strong> <br> '.$subpkgRow->seat_b.' pax</small>
                                         </div>
                                     </div> 
                                </li>':''; 
                                $hallhotel.=($subpkgRow->seat_c != '-')? '
                                 <li class="col-md-4 col-6 mb-3">
                                     <div class="d-flex align-items-center">
                                         <div class="flex-shrink-0"><img src="'.BASE_URL.'template/nepalhotel/images/icons/ushape.svg"></div>
                                         <div class="flex-grow-1 ms-3">
                                             <small><strong>U-shaped:</strong> <br> '.$subpkgRow->seat_c.' pax</small>
                                         </div>
                                     </div> 
                                 </li>':''; 
                                 $hallhotel.=($subpkgRow->seat_e != '-')? '
                             
                                 <li class="col-md-4 col-6 mb-3">
                                 <div class="d-flex align-items-center">
                                         <div class="flex-shrink-0"><img src="'.BASE_URL.'template/nepalhotel/images/icons/board.svg"></div>
                                         <div class="flex-grow-1 ms-3">
                                             <small><strong>Sit-down:</strong> <br> '.$subpkgRow->seat_e.' pax</small>
                                         </div>
                                     </div> 
                                 </li> ':''; 
                                 $hallhotel.=($subpkgRow->seat_d != '-')? '
                                 <li class="col-md-4 col-6 mb-3">
                                     <div class="d-flex align-items-center">
                                         <div class="flex-shrink-0"><img src="'.BASE_URL.'template/nepalhotel/images/icons/classroom.svg"></div>
                                         <div class="flex-grow-1 ms-3">
                                             <small><strong>Classroom:</strong> <br> '.$subpkgRow->seat_d.' pax</small>
                                         </div>
                                     </div> 
                                 </li>':''; 
                                 $hallhotel.=($subpkgRow->seat_f != '-')? '
                                 <li class="col-md-4 col-6 mb-3"><div class="d-flex align-items-center">
                                 <div class="d-flex align-items-center">
                                         <div class="flex-shrink-0"><img src="'.BASE_URL.'template/nepalhotel/images/icons/reception.svg"></div>
                                         <div class="flex-grow-1 ms-3">
                                             <small><strong>Reception:</strong> <br> '.$subpkgRow->seat_f.' pax</small>
                                         </div>
                                     </div> 
                               </li>':''; 
                               $hallhotel.= '</ul>
                        </div>

                        <div class="col-lg-3 col-md-6 mar-top-25">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Enquiry</button>
                        </div>
                    </div>
                </div>
            </div>
        
    </div>';


    }
    }
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
        $rescontcuisine = explode('<hr id="system_readmore" style="border-style: dashed; border-color: orange;" />', trim($recRow->cuisine));
        $rescontbreads = explode('<hr id="system_readmore" style="border-style: dashed; border-color: orange;" />', trim($recRow->breads));
        $rescontcakes = explode('<hr id="system_readmore" style="border-style: dashed; border-color: orange;" />', trim($recRow->cakes));
        $rescontbeverages  = explode('<hr id="system_readmore" style="border-style: dashed; border-color: orange;" />', trim($recRow->beverages));
        $rescontwhyus  = explode('<hr id="system_readmore" style="border-style: dashed; border-color: orange;" />', trim($recRow->whyus));
        for ($i = 1; $i <= $recRow->star; $i++) {
            $starp .='<span class="fa fa-star checked"></span>';
          }
          
        $resbread .= '

        <div class="detail-title">
            <div class="container">
            <div class="row">
            <div class="col-sm-12 d-flex justify-content-between">
                <div class="title-left">
                    <h3>'.$recRow->title.'</h3>
                    <div class="title-right pull-right">
                        <ul>
                        
                            <a href="'.$recRow->map_embed.'" target="_blank"><li><i class="fa fa-location-dot text-black-50"></i> '.$recRow->street.'</li></a>
                            <li>|</li>
                            <li><i class="fa fa-phone text-black-50"></i> <a href="tel:'.$recRow->contact_no.'">'.$recRow->contact_no.'</a></li>
                            <li>|</li>
                            <li><i class="fa fa-envelope text-black-50"></i> <a href="mailto:'.$recRow->email.'">'.$recRow->email.'</a></li>
                            <li>|</li>
                            <li>
                                <div class="rating">
                                '.$starp.'
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="logo">
                    <img src="'. IMAGE_PATH . 'hotelapi/detail/' . $recRow->detail_image .'" height="50px" alt="">
                </div>
            
            </div></div></div>
        </div>


        <section class="breadcrumb-outer" 
        style="background-image: url('.BASE_URL.'images/hotelapi/banner/'.$imgall.');
        background-repeat:no-repeat;
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
     
          $reviewrec = Review::find_by_hotel($recRow->id);
          if($recRow->hotel_type=='Hotel & Resort'){
            $booksearch=$jVars['module:booking_undergallery'];
          }
          else{
            $booksearch='';
          }
        $resbread .= '

     
       
        <section class="details" slug="' . $recRow->slug . '">
        
         '.$booksearch.'
        <div class="container-xxl px-md-5 px-4">
            <div class="detail-content">
                

                <div class="overview-inner">
                <div class="sbmenu">
                <div class="submenuin">
                    <ul >
                        <li><a href="'.BASE_URL.'hotel/'.$recRow->slug.'">Overview</a></li>
                      
                        <li class="d-none">Rooms</li>
                        ';
                        if(!empty($recRow->restaurant)){
                            $resbread .= '<li><a href="'.BASE_URL.'hotel/'.$recRow->slug.'/restaurant">Restaurant & Bar</a></li>';
                        
                        }
                        else{
                            $resbread .='';
                        }
                        
                        if(!empty($recRow->wedding)){
                            $resbread .= '<li><a href="'.BASE_URL.'hotel/'.$recRow->slug.'/wedding">Wedding</a></li>';
                        
                        }
                        else{
                            $resbread .='';
                        }
                        if(!empty($hallhotel)){
                            $resbread .= '
                            <li><a href="'.BASE_URL.'hotel/'.$recRow->slug.'/hall">Meeting & Events</li>';
                        
                        }
                        else{
                            $resbread .='';
                        }
                        if(!empty($recRow->imp_info)){
                            $resbread .= '
                            <li><a href="'.BASE_URL.'hotel/'.$recRow->slug.'/fitness">Fitness</a></li>';
                        
                        }
                        else{
                            $resbread .='';
                        }

                        if(!empty($recRow->cuisine)){
                            $resbread .= '
                            <li><a href="'.BASE_URL.'hotel/'.$recRow->slug.'/cuisine">Cuisine</a></li>';
                        
                        }
                        else{
                            $resbread .='';
                        }
                        if(!empty($recRow->breads)){
                            $resbread .= '
                            <li><a href="'.BASE_URL.'hotel/'.$recRow->slug.'/breads">Pasteries and Breads</a></li>';
                        
                        }
                        else{
                            $resbread .='';
                        }
                        if(!empty($recRow->cakes)){
                            $resbread .= '
                            <li><a href="'.BASE_URL.'hotel/'.$recRow->slug.'/cakes">Cakes and Sweets</a></li>';
                        
                        }
                        else{
                            $resbread .='';
                        }
                        if(!empty($recRow->beverages)){
                            $resbread .= '
                            <li><a href="'.BASE_URL.'hotel/'.$recRow->slug.'/beverages">Beverages</a></li>';
                        
                        }
                        else{
                            $resbread .='';
                        }
                        if(!empty($recRow->whyus)){
                            $resbread .= '
                            <li><a href="'.BASE_URL.'hotel/'.$recRow->slug.'/whyus">Why Us</a></li>';
                        
                        }
                        else{
                            $resbread .='';
                        }
                        // if(!empty($reviewrec)){
                            $resbread .= '
                            <li><a href="'.BASE_URL.'hotel/'.$recRow->slug.'/review">Reviews</a></li>';
                        
                        // }
                        // else{
                            $resbread .='';
                        // }
                        if(!empty($recRow->wedding)){
                            $resbread .= '';
                        
                        }
                        else{
                            $resbread .='';
                        }
                        
                        
                        
                        $resbread .=' 
                       
                            <li><a href="'.BASE_URL.'hotel/'.$recRow->slug.'/contact">Contact</a></li></ul>
                            <a href="'.BASE_URL.'result.php?hotel_code=UyS5u8" target="_blank" class="btn btn-primary bookbtn">Book Now</a>
                            
                            </div></div>

                    ';

                //   pr($recRow);
                if(!empty($recRow->content)){
                    $reshotel .= '
        <div class="overview-one">
            <h3>
                Overview</h3>
                <div class="room-outer1">'.$recRow->content.'</div>

 
        </div>
        ';
                
                }
                else{
                    $reshotel .='';
                }
        




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

        if(!empty($hallhotel)){
            $reshotel .=  
        '<div class="overview-one">
        <h3>Meeting & Events</h3>
        <div class="row">'
        .$hallhotel.' 
        </div>
        </div>
        '; }
            else{
            $reshotel .='';
                                    }
        

        $reshotel .= ' <div class="overview-one">
        <h3>Amenities</h3>
        <div class="row amenities-2">  ';
        $count = 0;
        $htype=$recRow->hotel_type;
        switch ($htype) {
            case 'Hotel & Resort':
              $feat="5";
              break;
            case 'Cafe':
                $feat="27";
              break;
            case 'Restaurant':
                $feat="26";
              break;
            default:
            $feat="5";
          }

        if ($recRow->feature != '') {
            $feature = unserialize(base64_decode($recRow->feature));
            // pr($feature);

            if(!empty($feature[$feat])){
                $feature = $feature[$feat];
                if (is_array($feature['features'])) {
                    foreach ($feature['features'] as $k => $v) {
                    // print_r($v);
                        if (array_key_exists('id', $v)) {
                            if ($k != 'id') {
                                // pr($v['image_class']);
                                // $icons = (!empty($v['icon_class']))? $v['icon_class'] :'fa fa-check';
                                $imgdata = Hotelservices::get_by_id($v['id']);

                                
                                // pr($imgdata);
                                if(!empty($imgdata->image)){
                                    $reshotel .= '
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <ul class="detail-amenities">
                                            <li><img src="'.IMAGE_PATH.'services/'.$imgdata->image.'"> ' . $v['title'] .'</li>
                                        </ul>
                                        <!--<div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <i class="'.$v['icon_class'].'" ></i>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                            <p>' . $v['title'] . '</p>
                                            </div>
                                        </div>-->
                                    </div>';
                                }else{
                                    $reshotel .= '
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <ul>
                                            <li><i class="'.$imgdata->icon_class.'" ></i> ' . $v['title'] .'</li>
                                        </ul>
                                        <!--<div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <i class="'.$v['icon_class'].'" ></i>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                            <p>' . $v['title'] . '</p>
                                            </div>
                                        </div>-->
                                    </div>';
                                }
                            }
                        }
                    }
                }
            }
        }
        $reshotel .= ' </div>
        </div>  ';
        
            
        if(!empty($recRow->wedding)){
            $reshotel .=  '
            <div class="overview-one">
                <h3>Weddings</h3>
                <div class="room-outer1">'.$rescontwed[0].'</div>
            </div>' ;
         }
            else{
            $reshotel .='';
        }
       
        if(!empty($recRow->imp_info)){
            $reshotel .=  '
        <div class="overview-one">
            <h3>Fitness</h3>
            <div class="room-outer1">'.$rescontfit[0].'</div>
        </div>' ;
         }
            else{
            $reshotel .='';
        }

        if(!empty($recRow->restaurant)){
            $reshotel .=  '
        <div class="overview-one">
            <h3>Restaurant & Bar</h3>
            <div class="room-outer1">'.$rescontrest[0].'</div>
        </div>' ;
         }
            else{
            $reshotel .='';
        }
        if(!empty($recRow->cuisine)){
            $reshotel .=  '
        <div class="overview-one">
            <h3>cuisine</h3>
            <div class="room-outer1">'.$rescontcuisine[0].'</div>
        </div>' ;
         }
            else{
            $reshotel .='';
        }
        if(!empty($recRow->breads)){
            $reshotel .=  '
        <div class="overview-one">
            <h3>Pasteries & breads</h3>
            <div class="room-outer1">'.$rescontbreads[0].'</div>
        </div>' ;
         }
            else{
            $reshotel .='';
        }
        if(!empty($recRow->cakes)){
            $reshotel .=  '
        <div class="overview-one">
            <h3>cakes & sweets</h3>
            <div class="room-outer1">'.$rescontcakes[0].'</div>
        </div>' ;
         }
            else{
            $reshotel .='';
        }
        if(!empty($recRow->beverages)){
            $reshotel .=  '
        <div class="overview-one">
            <h3>Beverages</h3>
            <div class="room-outer1">'.$rescontbeverages[0].'</div>
        </div>' ;
         }
            else{
            $reshotel .='';
        }
        if(!empty($recRow->whyus)){
            $reshotel .=  '
        <div class="overview-one">
            <h3>whyus</h3>
            <div class="room-outer1">'.$rescontwhyus[0].'</div>
        </div>' ;
         }
            else{
            $reshotel .='';
        }
        
        
    
        
    $faqrec = Roomoffers::find_by_hotel($recRow->id);
    foreach($faqrec as $i =>$faq){
            $collapsed = ($i == 0) ? 'collapsed' : '';
            $show = ($i == 0) ? 'show' : '';
            $faqdetails .='
            <div class="accordion-item border-0">
            <h2 class="accordion-header " id="head'.$faq->id.'">
                <button class="fw-bold text-primary px-0 accordion-button '.$collapsed.'" type="button" data-bs-toggle="collapse" data-bs-target="#collapse'.$faq->id.'" aria-expanded="true" aria-controls="collapseOne">
                '.$faq->title.'
                </button>
            </h2>
            <div id="collapse'.$faq->id.'" class="accordion-collapse collapse '.$show.'" aria-labelledby="head'.$faq->id.'" data-bs-parent="#accordionExample">
                <div class="accordion-body p-0 pb-3">
                '.$faq->content.'
                </div>
            </div>
        </div>';
        }

        if(!empty($faqdetails)){
            $reshotel .= ' <div class="overview-one">
        <h3>FAQ</h3>
        <div class="accordion" id="accordionExample">
        '.$faqdetails.'

        </div>
    </div>';
         }
            else{
            $reshotel .='';
        }
        
    $usserId = $session->get('user_id');
    

// pr($recRow->id);
    
//     foreach($userdetails as $key =>$udetails){
//         $uname=$udetails->username;
//     }
    if(!empty($usserId)){
        $userdetails = Generaluser:: find_by_id($usserId);
    $userreview='
    <div class="contact  pad-bottom-10 contact1 mt-4">

            <div class="row">
                <div class="col-md-6 mx-auto">
                    <div id="contact-form" class="contact-form">
                        
                        <div id="contactform-error-msg"></div>
                        <h2>Post Your Review</h2>
                        <form method="post" action="" name="reviewform" id="user_review_frm">
                            
                                <input type="hidden" name="name" value='.$userdetails->username.'  class="form-control" id="name" placeholder="Name *">
                            
                            
                            <div class="form-group">
                                <input type="hidden" name="email" value='.$userdetails->email.'  class="form-control" id="email" placeholder="email *">
                                <input type="hidden" name="user_id" value='.$userdetails->id.'  class="form-control" id="user_id" placeholder="user_id *">
                                <input type="hidden" name="subject"  value="user review" class="form-control" id="subject" placeholder="review *">
                                <input type="hidden" name="status" value="1"  class="form-control" id="status" placeholder="review *">
                            </div>
                            <div class="form-group">
                            <label for="rating">Rating</label> <br>
                            <select class="col-md-2 mb-3" name="rating" id="rating">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                        </div>
                            <div class="form-group">
                            
                                <input type="hidden" name="hotel_id" value='.$recRow->id.' class="form-control" id="hotel_id" placeholder="Phone *">
                            </div>

                            <div class="form-group">
                                <input type="text" name="title"  class="form-control" id="title" placeholder="Subject *">
                            </div>
                            <div class="textarea">
                                <textarea name="review" id="review" placeholder="Review *"></textarea>
                            </div>
                            <div type="hidden" id="reviewmsg"></div>

                            <div class="comment-btn text-right">
                                <button type="submit" class="btn btn-primary" id="btn-submit" >Post your Review</button>
                            </div>
                        </form>
                    </div>
                </div>

                
                
            </div>
        
</div>';
    }
    $viewmore='';
    $reviewrec = Review::find_by_hotel($recRow->id,2);
    // pr($reviewrec);
    foreach($reviewrec as $i =>$reviewdata){
        $star = '';
        // $datein= $reviewdata->added_date;
        // $date= date_format("$datein","Y/f/d H:i:s");
        // pr($reviewdata->rating);
        
        for ($i = 1; $i <= $reviewdata->rating; $i++) {
            $star .='<i class="fa fa-star"></i>';
          }
          $imglink='';
          $userdetails = Generaluser:: find_by_id($reviewdata->user_id);
        if(!empty($userdetails->image)){
            $imglink ='<img src="'. IMAGE_PATH.'user/'. $userdetails->image . '" alt="image">';
            
        }
        else{
            $imglink = '<div class="test1">'.ucfirst(substr($reviewdata->name,0,1)).'</div>';
        }  
        $reviewdetails .='
        
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="review-item">
                
                    <div class="review-image">
                        '.$imglink.'
                    </div>
                    <div class="review-content">
                    <div>'.$star.'</div><div><p class="date">'.$reviewdata->title.', '.date('d F, Y', strtotime($reviewdata->added_date)).' </p>
                     </div>   <p>'.$reviewdata->review.'</p>
                    </div>
                </div>

        
        ';
    }
    if(!empty($reviewdetails)){
        $viewmore='<div class="text-center"><a href="'. BASE_URL .'hotel/'. $slug . '/review" class="btn btn-primary" style="width:120px">View More</a></div>';
    }
    if(!empty($reviewdetails) || ($usserId)){
        $reshotel .= '
        <div class="overview-one">
            <h3>Review</h3>
            <div class="row">
                '.$reviewdetails.'
                '.$viewmore.'

            </div>
            '.$userreview.'
        </div>   ';
     }
        else{
        $reshotel .='';
    }
    

        

        $reshotel .= '                         </div>
        </div>
    </div>
</section>
';


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
                    <h3>
		            Restaurant & Bar</h3>
	                
                    '. $contentres .'                 
              
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

$cuisinehotel = $ban = '';

if (defined('CUISINEDETAIL_PAGE') and !empty($_REQUEST['slug']) and !empty($_REQUEST['cuisine'])) {
    
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
        $rescontcuisine = explode('<hr id="system_readmore" style="border-style: dashed; border-color: orange;" />', trim($recRow->cuisine));
        $contentcuisine = !empty($rescontcuisine[1]) ? $rescontcuisine[1] : $rescontcuisine[0];
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
        $cuisinehotel .='
                    <div class="overview-one">
                    <h3>
		            Cuisine</h3>
	                
                    '. $contentcuisine .'                 
              
                </div>
                </div>
            </div>
        </div>
    </section>
    <!-- details Ends -->
    '.$jVars['module:hotel-offers'].'
    <!-- Deals and offer starts -->
    

                    ';

     

        

                    $cuisinehotel .= '                         </div>
        </div>
    </div>
</section>';


    }

}

$jVars['module:cuisine-details'] = $cuisinehotel;

$beverageshotel = $ban = '';

if (defined('BEVERAGESDETAIL_PAGE') and !empty($_REQUEST['slug']) and !empty($_REQUEST['beverages'])) {
    
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
        $rescontbeverages = explode('<hr id="system_readmore" style="border-style: dashed; border-color: orange;" />', trim($recRow->beverages));
        $contentbeverages = !empty($rescontbeverages[1]) ? $rescontbeverages[1] : $rescontbeverages[0];
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
        $beverageshotel .='
                    <div class="overview-one">
                    <h3>
		            beverages</h3>
	                
                    '. $contentbeverages .'                 
              
                </div>
                </div>
            </div>
        </div>
    </section>
    <!-- details Ends -->
    '.$jVars['module:hotel-offers'].'
    <!-- Deals and offer starts -->
    

                    ';

     

        

                    $beverageshotel .= '                         </div>
        </div>
    </div>
</section>';


    }

}

$jVars['module:beverages-details'] = $beverageshotel;

$whyushotel = $ban = '';

if (defined('WHYUS_PAGE') and !empty($_REQUEST['slug']) and !empty($_REQUEST['whyus'])) {
    
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
        $rescontwhyus = explode('<hr id="system_readmore" style="border-style: dashed; border-color: orange;" />', trim($recRow->whyus));
        $contentwhyus = !empty($rescontwhyus[1]) ? $rescontwhyus[1] : $rescontwhyus[0];
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
        $whyushotel .='
                    <div class="overview-one">
                    <h3>
		            Why Us</h3>
	                
                    '. $contentwhyus .'                 
              
                </div>
                </div>
            </div>
        </div>
    </section>
    <!-- details Ends -->
    '.$jVars['module:hotel-offers'].'
    <!-- Deals and offer starts -->
    

                    ';

     

        

                    $whyushotel .= '                         </div>
        </div>
    </div>
</section>';


    }

}

$jVars['module:whyus-details'] = $whyushotel;

$cakeshotel = $ban = '';

if (defined('CAKESDETAIL_PAGE') and !empty($_REQUEST['slug']) and !empty($_REQUEST['cakes'])) {
    
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
        $rescontcakes = explode('<hr id="system_readmore" style="border-style: dashed; border-color: orange;" />', trim($recRow->cakes));
        $contentcakes = !empty($rescontcakes[1]) ? $rescontcakes[1] : $rescontcakes[0];
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
        $cakeshotel .='
                    <div class="overview-one">
                    <h3>
		            cakes and Sweets</h3>
	                
                    '. $contentcakes .'                 
              
                </div>
                </div>
            </div>
        </div>
    </section>
    <!-- details Ends -->
    '.$jVars['module:hotel-offers'].'
    <!-- Deals and offer starts -->
    

                    ';

     

        

                    $cakeshotel .= '                         </div>
        </div>
    </div>
</section>';


    }

}

$jVars['module:cakes-details'] = $cakeshotel;
$breadshotel = $ban = '';

if (defined('BREADSDETAIL_PAGE') and !empty($_REQUEST['slug']) and !empty($_REQUEST['breads'])) {
    
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
        $rescontbreads = explode('<hr id="system_readmore" style="border-style: dashed; border-color: orange;" />', trim($recRow->breads));
        $contentbreads = !empty($rescontbreads[1]) ? $rescontbreads[1] : $rescontbreads[0];
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
        $breadshotel .='
                    <div class="overview-one">
                    <h3>
		            Pasteries and Breads</h3>
	                
                    '. $contentbreads .'                 
              
                </div>
                </div>
            </div>
        </div>
    </section>
    <!-- details Ends -->
    '.$jVars['module:hotel-offers'].'
    <!-- Deals and offer starts -->
    

                    ';

     

        

                    $breadshotel .= '                         </div>
        </div>
    </div>
</section>';


    }

}

$jVars['module:breads-details'] = $breadshotel;


$contbread='';
$conthotel='';
$booking = $ta =   $expedia = $fb         =   $insta      = '';

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

        $booking    = (!empty($recRow->ota_booking_com)) ? '<a class="mx-1" href="'. $recRow->ota_booking_com.'" target="_blank"><img height="16px" src="'.BASE_URL.'template/nepalhotel/images/icons/booking.png" /></a>': '';
        $ta         = (!empty($recRow->ota_trip_advisor)) ? '<a class="mx-1" href="'. $recRow->ota_trip_advisor.'" target="_blank"><img height="16px" src="'.BASE_URL.'template/nepalhotel/images/icons/ta.png" /></a>': '';
        $expedia    = (!empty($recRow->ota_expedia)) ? '<a class="mx-1" href="'. $recRow->ota_expedia.'" target="_blank"><img height="16px" src="'.BASE_URL.'template/nepalhotel/images/icons/expedia.png" /></a>': '';

        $fb         = (!empty($recRow->social_facebook)) ? '<a class="mx-1" href="'. $recRow->social_facebook.'" target="_blank"><i class="fab fa-facebook"></i></a>': '';
        $insta      = (!empty($recRow->social_instagram)) ? '<a class="mx-1" href="'. $recRow->social_instagram.'" target="_blank"><i class="fab fa-instagram fa-"></i></a>': '';
        $tiktok     = (!empty($recRow->social_tiktok)) ? '<a class="mx-1" href="'. $recRow->social_tiktok.'" target="_blank"><i class="fab fa-tiktok"></i></a>': '';
        
        $resercontact= (!empty($recRow->res_contact_no)) ? 'Tel: <a href="tel:'. $recRow->res_contact_no.'">'. $recRow->res_contact_no .'</a>': '' ;
        $resermail= (!empty($recRow->res_email)) ? 'Email: <a href="mailto:'. $recRow->res_email .'">'. $recRow->res_email .'</a></p>':'';
        $meetcontact= (!empty($recRow->meet_contact_no)) ?  'Tel: <a href="tel:'. $recRow->meet_contact_no .'">'. $recRow->meet_contact_no .'</a>': '';
        $meetmail= (!empty($recRow->meet_email)) ? 'Email: <a href="mailto:'. $recRow->meet_email .'">'. $recRow->meet_email .'</a></p>' : '';
        if(!empty($resercontact || $resermail)){
            $resdetail= '
            <div class="col-md-4">
                                <p><strong>Reservation</strong> <br/>
                                '.$resercontact.'<br/>
                                '.$resermail.'
                                
                            </div>
            ';
        }
        else{
            $resdetail='';
        }
        if(!empty($meetcontact || $meetmail)){
            $meetdetail= '
            <div class="col-md-4">
                                <p><strong>Meeting and Events</strong> <br/>
                                '.$meetcontact.'<br/>
                                '.$meetmail.'
                                
                            </div>
            ';
        }
        else{
            $meetdetail='';
        }
        $conthotel .='

                    <div class="overview-one mar-top-50">
                        <h3>Contact</h3>
                        <iframe src="'. $recRow->map .'" width="1150" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        <div class="row mt-4">
                            <div class="col-md-4">
                              <strong>Address:</strong> '. $recRow->street .'<br/>
                                Tel: <a href="tel:'. $recRow->contact_no .'">'. $recRow->contact_no .'</a><br/>

                                Email: <a href="mailto:'. $recRow->email .'">'. $recRow->email .'</a>
                               <div class="d-flex mt-1">
                              <div class="me-md-3 border-end pe-md-3">
                               '.$booking.'
                               '.$ta.'
                               '.$expedia.'
                              </div><div>
                               '.$fb.'
                               '.$insta.'
                               '.$tiktok.'
                               </div>
</div>
                            </div>

                            '.$resdetail.'

                            '.$meetdetail.'
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
                  <h3>Fitness</h3>
                  '. $contentfit .'                 
                </div>
               
            </div>
        </div>
    </section>
    <!-- details Ends -->
    '.$jVars['module:main-advert'].'
    <!-- Deals and offer starts -->';

        $fithotel .= '</div>
        </div>
    </div>
</section>';


    }

}
$jVars['module:fitness-details'] = $fithotel;


$mainreviewdetails='';
$reviewhotel='';
if (defined('REVIEWDETAIL_PAGE') and !empty($_REQUEST['slug']) and !empty($_REQUEST['review'])) {
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
        $page = (isset($_REQUEST["pageno"]) and !empty($_REQUEST["pageno"]))? $_REQUEST["pageno"] : 1;

        $reviewrec = Review::find_by_hotel($recRow->id);
        $total = count($reviewrec);



        // checking if checkin and checkout dates are available
        $limit = 5;
        // print_r($total); die();
        $startpoint = ($page * $limit) - $limit; 
        // if(!empty($session->get('user_id'))){
        // $usserId = $session->get('user_id');
        
        // $userdetails = Generaluser:: find_by_id($usserId);
        // }
        // else{
        //     $usserId='';
        // }
    

// pr($recRow->id);
    
//     foreach($userdetails as $key =>$udetails){
//         $uname=$udetails->username;
//     }
        $reviewrec = Review::find_by_hotel_pagination($recRow->id, $startpoint, $limit);
        $c=0; 
        $stara='';
    foreach($reviewrec as $i =>$reviewdata){
        
        // pr($reviewdata);
        $stara ='';
        for ($x = 1; $x <= $reviewdata->rating; $x++) {
            $stara .='<i class="fa fa-star"></i>';
        }
        $imglink='';
        // pr($userdetails);
        $userdetails = Generaluser:: find_by_id($reviewdata->user_id);
        if(!empty($userdetails->image)){
            $imglink ='<img src="'. IMAGE_PATH.'user/'. $userdetails->image . '" alt="image">';
            
        }
        else{
            $imglink = '<div class="test1">'.ucfirst(substr($reviewdata->name,0,1)).'</div>';
        }  
    
        
    
        // pr($reviewrec);
        $mainreviewdetails .='
                <div class="review-item">
                    <div class="review-image">
                        '.$imglink.'
                    </div>
                    <div class="review-content">
                    '.$stara.'<p class="date">'.$reviewdata->title.', '.date('d F, Y', strtotime($reviewdata->added_date)).' </p>
                        <p>'.$reviewdata->review.'</p>
                    </div>
                </div>
            
        ';
    
}
// pr($userdetails);
    $reviewhotel .= '
        <div class="overview-one mar-top-50">
            <h3>Reviews</h3>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    '.$mainreviewdetails.'
                    '.get_pagination_review($total, $limit, $page, BASE_URL . 'hotel/' . $slug.'/review').'
                </div>
            </div>
            '.$userreview.'
        </div>
        </div> 
        </div> 
        </div>          
        '.$jVars['module:main-advert'].'
        ';

              

        $reviewhotel .= '                         </div>
        </div>
    </div>
</section>';
        
    }

}
$jVars['module:review-details'] = $reviewhotel;


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
                    <h3>
		            Weddings</h3>
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
$hallmodal='';
$hallpackage='';
if (defined('HALLDETAIL_PAGE') and !empty($_REQUEST['slug']) and !empty($_REQUEST['hall'])) {
    $slug = addslashes($_REQUEST['slug']);
    
    
    
    $recRow = Hotelapi::find_by_slug($slug);
    $pkgRec = Hallapi::find_by_hotel($recRow->id);
    $c=0;
    foreach ($pkgRec as $key => $subpkgRow) {
    // pr($pkgRec);

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
        $padd='';

        if($c>0){
            $padd=' mt-5 ';
        }
        ($subpkgRow->hall_size_label == 'feet')? $hallabel = ' sq.ft.': $hallabel =' sq.m.';
        // pr($subpkgRow,1);

        $hallhotel.='
        
        <div class="col-lg-5 col-md-6 col-sm-6 '.$padd.'">
            <div class="grid-image">
                <img src="'.$images.'" alt="image">
            </div>
        </div>

        <div class="col-lg-7 col-md-6 col-sm-6 '.$padd.'">
            <div class="grid-content">
                <div class="hall-title">
                    <h4>'.$subpkgRow->title.'</h4>
                    <div class="room-services">
                        <ul>';
                        $hallhotel.=  ($subpkgRow->max_people!=0) ? '<li>Capacity:'.$subpkgRow->max_people.' pax</li>
                            <li>|</li>' : '';
                        $hallhotel.=  ($subpkgRow->hall_size!=0) ? ' <li>Area: '.$subpkgRow->hall_size.' '.$hallabel.'</li>
                            <li>|</li>':'';
                        $hallhotel.=  ($subpkgRow->no_hall!=0) ? ' <li>Dimension: '.$subpkgRow->no_hall.' sq.ft.</li>
                            <li>|</li>':'';
                        $hallhotel.=  ($subpkgRow->max_child!=0) ? ' <li>Height: '.$subpkgRow->max_child.' ft.</li>':'';
            $hallhotel.='
                        </ul>
                    </div>
                </div>

                <div class="room-detail">
                '.$subpkgRow->detail.'
                </div>
                
                <div class="grid-btn mar-top-20">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <h5>Seating Style</h5>
                        </div>
                    
                        <div class="col-lg-12 col-md-6">
                             <ul class="row">';
                             $hallhotel.=($subpkgRow->seat_a != '-')?'<li class="col-md-4 col-6 mb-3">
                                     <div class="d-flex align-items-center">
                                         <div class="flex-shrink-0"><img src="'.BASE_URL.'template/nepalhotel/images/icons/theatre.svg"></div>
                                         <div class="flex-grow-1 ms-3">
                                             <small><strong>Theatre:</strong> <br> '.$subpkgRow->seat_a.' pax</small>
                                         </div>
                                     </div>    
                                 </li>':''; 
                             $hallhotel.=($subpkgRow->seat_b != '-')?'<li class="col-md-4 col-6 mb-3">
                                     <div class="d-flex align-items-center">
                                         <div class="flex-shrink-0"><img src="'.BASE_URL.'template/nepalhotel/images/icons/circular.svg"></div>
                                         <div class="flex-grow-1 ms-3">
                                             <small><strong>Circular:</strong> <br> '.$subpkgRow->seat_b.' pax</small>
                                         </div>
                                     </div> 
                                </li>':''; 
                                $hallhotel.=($subpkgRow->seat_c != '-')? '
                                 <li class="col-md-4 col-6 mb-3">
                                     <div class="d-flex align-items-center">
                                         <div class="flex-shrink-0"><img src="'.BASE_URL.'template/nepalhotel/images/icons/ushape.svg"></div>
                                         <div class="flex-grow-1 ms-3">
                                             <small><strong>U-shaped:</strong> <br> '.$subpkgRow->seat_c.' pax</small>
                                         </div>
                                     </div> 
                                 </li>':''; 
                                 $hallhotel.=($subpkgRow->seat_d != '-')? '
                             
                                 <li class="col-md-4 col-6 mb-3">
                                 <div class="d-flex align-items-center">
                                     <div class="flex-shrink-0"><img src="'.BASE_URL.'template/nepalhotel/images/icons/classroom.svg"></div>
                                     <div class="flex-grow-1 ms-3">
                                         <small><strong>Classroom:</strong> <br> '.$subpkgRow->seat_d.' pax</small>
                                     </div>
                                 </div> 
                             </li>':''; 
                                 $hallhotel.=($subpkgRow->seat_e != '-')? '
                                 <li class="col-md-4 col-6 mb-3">
                                 <div class="d-flex align-items-center">
                                         <div class="flex-shrink-0"><img src="'.BASE_URL.'template/nepalhotel/images/icons/board.svg"></div>
                                         <div class="flex-grow-1 ms-3">
                                             <small><strong>Sit-down:</strong> <br> '.$subpkgRow->seat_e.' pax</small>
                                         </div>
                                     </div> 
                                 </li>
                                ':''; 
                                 $hallhotel.=($subpkgRow->seat_f != '-')? '
                                 <li class="col-md-4 col-6 mb-3"><div class="d-flex align-items-center">
                                 <div class="d-flex align-items-center">
                                         <div class="flex-shrink-0"><img src="'.BASE_URL.'template/nepalhotel/images/icons/reception.svg"></div>
                                         <div class="flex-grow-1 ms-3">
                                             <small><strong>Reception:</strong> <br> '.$subpkgRow->seat_f.' pax</small>
                                         </div>
                                     </div> 
                               </li>':''; 
                               $hallhotel.= '</ul>
                        </div>

                        <div class="col-lg-3 col-md-6 mar-top-25">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Enquiry</button>
                        </div>
                    </div>
                </div>
            </div>
        
        </div>';

    $c++;
    
    $hallmodal='
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Enquiry Mail</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body hall-enquiry45">
              <div class="container-xxl px-12">
              <div class="col-md-12">
                  <div id="contact-form" class="contact-form">
                      
                      <div id="contactform-error-msg"></div>
  
                      <form method="post" action="enquery_mail.php" name="contactform" id="frm_contact">
                     
                          <div class="form-group">
                              <input type="text" name="name" class="form-control" id="name" placeholder="Name">
                          </div>
                          <div class="form-group">
                              <input type="hidden" name="hall" class="form-control" id="hall" value="'.$subpkgRow->title.'"placeholder="Name">
                          </div>
                          <div class="form-group">
                              <input type="hidden" name="property" class="form-control" id="property" value="'.$recRow->title.'"placeholder="Name">
                          </div>
                          <div class="form-group">
                              <input type="hidden" name="meetemail" class="form-control" id="meetemail" value="'.$recRow->meet_email.'"placeholder="Name">
                          </div>
                          <div class="form-group">
                              <input type="email" name="email"  class="form-control" id="email" placeholder="Email">
                          </div>
  
                          <div class="form-group">
                              <input type="text" name="phone" class="form-control" id="number" placeholder="Phone">
                          </div>
  
                          <div class="textarea">
                              <textarea name="message" id="message" placeholder="Message"></textarea>
                          </div>
  
                          <div class="comment-btn text-right">
                              <input type="submit" class="btn btn-orange" id="submit" value="Send Feedback">
                          </div>
                      </form>
                  </div>
              </div>
          </div>
          </div>
        </div>
      </div>
    </div>';

    }
    $hallpackage='
    <div class="overview-one">
  
        <h3>Meeting & Events</h3>
        <div class="row mar-bottom-30">
        '.$hallhotel.'
        </div>
                    </div>                 
                </div>
            </div>
        </div>
     
    </section>
        
        ';
}
$jVars['module:hall-details'] = $hallpackage;
$jVars['module:hall-modals'] = $hallmodal;

$hallsmodal='';
if (!empty($_REQUEST['slug'])) {
    $slug = addslashes($_REQUEST['slug']);
    
    
    
    $recRow = Hotelapi::find_by_slug($slug);
    if(!empty($recRow)){
    $pkgRec = Hallapi::find_by_hotel($recRow->id);
    foreach ($pkgRec as $key => $subpkgRow) {
    

        // checking if checkin and checkout dates are available
   
       
    
    $hallsmodal='
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Enquiry Mail</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body hall-enquiry45">
              <div class="container-xxl px-12">
              <div class="col-md-12">
                  <div id="contact-form" class="contact-form">
                      
                      <div id="contactform-error-msg"></div>
  
                      <form method="post" action="enquery_mail.php" name="contactform" id="frm_contact">
                          <div class="form-group">
                              <input type="text" name="name" class="form-control" id="name" placeholder="Name">
                          </div>
                          <div class="form-group">
                              <input type="hidden" name="hall" class="form-control" id="hall" value="'.$subpkgRow->title.'"placeholder="Name">
                          </div>
                          <div class="form-group">
                              <input type="hidden" name="property" class="form-control" id="property" value="'.$recRow->title.'"placeholder="Name">
                          </div>
                          <div class="form-group">
                              <input type="hidden" name="meetemail" class="form-control" id="meetemail" value="'.$recRow->meet_email.'"placeholder="Name">
                          </div>
                          <div class="form-group">
                              <input type="email" name="email"  class="form-control" id="email" placeholder="Email">
                          </div>
  
                          <div class="form-group">
                              <input type="text" name="phone" class="form-control" id="number" placeholder="Phone">
                          </div>
  
                          <div class="textarea">
                              <textarea name="message" id="message" placeholder="Message"></textarea>
                          </div>
  
                          <div class="comment-btn text-right">
                              <input type="submit" class="btn btn-orange" id="submit" value="Send Feedback">
                          </div>
                      </form>
                  </div>
              </div>
          </div>
          </div>
        </div>
      </div>
    </div>';

    }
    $hallpackage='
    <div class="overview-one">
  
        <h3>Meeting & Events</h3>
        <div class="row mar-bottom-30">
        '.$hallhotel.'
        </div>
                    </div>                 
                </div>
            </div>
        </div>
     
    </section>
        
        ';
}
}
$jVars['module:hall-modal'] = $hallsmodal;