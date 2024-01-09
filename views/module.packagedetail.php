<?php
$respkg_bread = $respkg_detail = '';

if (defined('PACKAGE_PAGE') and !empty($_REQUEST['slug'])) {
    $slug = (isset($_REQUEST['slug']) and !empty($_REQUEST['slug'])) ? addslashes($_REQUEST['slug']) : '';
    $pkgRec = Package::find_by_slug($slug);

    if (!empty($pkgRec)) {

        $img = BASE_URL . 'template/nepalhotel/images/bg/3.jpg';
        $bannerimgs = unserialize($pkgRec->banner_image);
        if (!empty($bannerimgs)) {
            $file_path = SITE_ROOT . 'images/package/banner/' . @$bannerimgs[0];
            if (!empty($bannerimgs[0]) and file_exists($file_path)) {
                $img = IMAGE_PATH . 'package/banner/' . $bannerimgs[0];
            }
        }

        $respkg_bread .= '
            <section class="list-single-hero" data-scrollax-parent="true" id="sec1">
                <div class="bg par-elem " data-bg="' . $img . '" data-scrollax="properties: { translateY: \'30%\' }"></div>
                <div class="list-single-hero-title fl-wrap">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-7">
                                <div class="listing-rating-wrap">
                                    <div class="listing-rating card-popup-rainingvis" data-starrating2="' . $pkgRec->gread . '"></div>
                                </div>
                                <h2><span>' . $pkgRec->title . '</span></h2>
                            </div>
                        </div>
                        <div class="breadcrumbs-hero-buttom fl-wrap bt_hero">
                        <div class="fact_cov">
                            <div class="breadcrumbs d-flex text-white ws-nowrap" >
                            ';

        $respkg_bread .= (!empty($pkgRec->days)) ? '<div class="mx-3 "><i class="fa me-1 fa-clock"></i>' . $pkgRec->days . ' days</div>' : '';
        $respkg_bread .= (!empty($pkgRec->accomodation)) ? '<div class="mx-3 "><i class="fa me-1 fa-route"></i>' . $pkgRec->accomodation . '</div>' : '';
        $respkg_bread .= (!empty($pkgRec->season)) ? '<div class="mx-3 "><i class="fa me-1 fa-cloud-sun"></i>' . $pkgRec->season . '</div>' : '';
        $respkg_bread .= (!empty($pkgRec->group_size)) ? '<div class="mx-3 "><i class="fa me-1 fa-users"></i>Group Size : ' . $pkgRec->group_size . '</div>' : '';

        $respkg_bread .= '
                            </div>
                            </div>
                            <div class="list-single-hero-links">
                            ';

        $respkg_bread .= (!empty($pkgRec->mapgoogle)) ? '<a class="lisd-link" href="' . $pkgRec->mapgoogle . '" target="_blank"><i class="fal fa-map-marked-alt"></i> On The Map</a>' : '';

        $respkg_bread .= '
                                <!-- <a class="custom-scroll-link lisd-link" href="#sec6"><i class="fal fa-comment-alt-check"></i> Add review</a> -->
                            </div>
                            ';

        if (!empty($pkgRec->price)) {
            $respkg_bread .= '<div class="list-single-hero-price"><span>$ ' . $pkgRec->price . '</span> / per person</div>';
        }

        $respkg_bread .= '
                        </div>
                    </div>
                </div>
            </section>
        ';

        $itineraries = Itinerary::getPackage_limit($pkgRec->id);

        $respkg_detail .= '
            <!--  scroll-nav-wrapper  -->
            <div class="scroll-nav-wrapper fl-wrap">
                <div class="hidden-map-container fl-wrap">
                    <input id="pac-input" class="controls fl-wrap controls-mapwn" type="text"
                           placeholder="What Nearby ?   Bar , Gym , Restaurant ">
                    <div class="map-container">
                        <div id="singleMap" data-latitude="40.7427837" data-longitude="-73.11445617675781"></div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="container">
                    <nav class="scroll-nav scroll-init">
                        <ul>
                            <li><a class="act-scrlink" href="#sec1">Top</a></li>
                            <li><a href="#sec2">Highlights</a></li>
                            ';

        $respkg_detail .= (!empty($itineraries)) ? '<li><a href="#sec3">Itinerary</a></li>' : '';
        $respkg_detail .= (!empty($pkgRec->incexc)) ? '<li><a href="#sec4">Inclusions</a></li>' : '';

        $respkg_detail .= '
                            <!--<li><a href="#sec5">Reviews</a></li>-->
                        </ul>
                    </nav>
                    <a href="javascript:;" class=" show-hidden-maps book-btn-check"> <span>Book Now</span> <i class="fal fa-bookmark"></i></a>
                </div>
            </div>
            <!--  scroll-nav-wrapper end  -->
            ';

        $respkg_detail .= '
            <!--   container  -->
            <div class="container">
                <!--   row  -->
                <div class="row">
                    <!--   datails -->
                    <div class="col-md-8">
                        <div class="list-single-main-container ">
                            <!-- fixed-scroll-column  -->
                            <div class="fixed-scroll-column">
                                <div class="fixed-scroll-column-item fl-wrap">
                                    <div class="showshare sfcs fc-button"><i class="far fa-share-alt"></i><span>Share </span></div>
                                    <div class="share-holder fixed-scroll-column-share-container">
                                        <div class="share-container  isShare"></div>
                                    </div>
                                    <!-- <a class="fc-button custom-scroll-link" href="#sec6"><i class="far fa-comment-alt-check"></i> <span>  Add review </span></a> -->
                                    <!-- <a class="fc-button" href="#"><i class="far fa-heart"></i> <span>Save</span></a> -->
                                    <a class="fc-button book-btn-check" href="javascript:;"><i class="far fa-bookmark"></i> <span> Book Now </span></a>
                                </div>
                            </div>
                            <!-- fixed-scroll-column end   -->
                            ';

        $sliderImages = PackageImage::getImagelist_by($pkgRec->id);
        if ($sliderImages) {
            $respkg_detail .= '
                            <div class="list-single-main-media fl-wrap">
                                <!-- gallery-items   -->
                                <div class="gallery-items grid-small-pad  list-single-gallery three-coulms lightgallery">
                                ';
            $image_no = sizeof($sliderImages);
            if ($image_no > 3) {
                $rest_images = '';
                $remaining_img = $image_no - 3;
                $first_img = array_shift($sliderImages);
                $respkg_detail .= '
                    <div class="gallery-item">
                        <div class="grid-item-holder">
                            <div class="box-item">
                                <img src="' . IMAGE_PATH . 'package/galleryimages/' . $first_img->image . '" alt="' . $first_img->title . '">
                                <a href="' . IMAGE_PATH . 'package/galleryimages/' . $first_img->image . '" class="gal-link popup-image"><i class="fa fa-search"></i></a>
                            </div>
                        </div>
                    </div>
                ';

                $second_img = array_shift($sliderImages);
                $respkg_detail .= '
                    <div class="gallery-item">
                        <div class="grid-item-holder">
                            <div class="box-item">
                                <img src="' . IMAGE_PATH . 'package/galleryimages/' . $second_img->image . '" alt="' . $second_img->title . '">
                                <a href="' . IMAGE_PATH . 'package/galleryimages/' . $second_img->image . '" class="gal-link popup-image"><i class="fa fa-search"></i></a>
                            </div>
                        </div>
                    </div>
                ';

                $third_image = array_shift($sliderImages);
                foreach ($sliderImages as $sliderImage) {
                    if ($sliderImage == end($sliderImages)) {
                        $rest_images .= "{'src': '" . IMAGE_PATH . "package/galleryimages/" . $sliderImage->image . "'}";
                    } else {
                        $rest_images .= "{'src': '" . IMAGE_PATH . "package/galleryimages/" . $sliderImage->image . "'}, ";
                    }
                }
                $respkg_detail .= '
                    <div class="gallery-item">
                        <div class="grid-item-holder">
                            <div class="box-item">
                                <img src="' . IMAGE_PATH . 'package/galleryimages/' . $third_image->image . '" alt="' . $third_image->title . '">
                                <div class="more-photos-button dynamic-gal"
                                     data-dynamicPath="[' . $rest_images . ']">
                                    Other <span>' . $remaining_img . ' photos</span><i class="far fa-long-arrow-right"></i></div>
                            </div>
                        </div>
                    </div>
                ';
            } else {
                foreach ($sliderImages as $sliderImage) {
                    $respkg_detail .= '
                        <div class="gallery-item">
                            <div class="grid-item-holder">
                                <div class="box-item">
                                    <img src="' . IMAGE_PATH . 'package/galleryimages/' . $sliderImage->image . '" alt="' . $sliderImage->title . '">
                                    <a href="' . IMAGE_PATH . 'package/galleryimages/' . $sliderImage->image . '" class="gal-link popup-image"><i class="fa fa-search"></i></a>
                                </div>
                            </div>
                        </div>
                    ';
                }
            }
            $respkg_detail .= '
                                </div>
                                <!-- end gallery items -->
                            </div>
            ';
        }

        $respkg_detail .= '
                            <div class="list-single-main-item fl-wrap" id="sec2">
                                <div class="list-single-main-item-title fl-wrap">
                                    <h3>Overview </h3>
                                </div>
                                ' . $pkgRec->overview . '
                            </div>
                            <!--   list-single-main-item end -->
                            ';

        if (!empty($itineraries)) {
            $respkg_detail .= '
                            <!-- accordion-->
                            <div class="accordion mar-top" id="sec3">
                                <h2 class="fs-4 text-start mb-2">Itinerary</h2>
            ';

            foreach ($itineraries as $i => $itinerary) {
                $actaccordion = ($i == 0) ? 'act-accordion' : '';
                $visible = ($i == 0) ? 'visible' : '';
                $respkg_detail .= '
                                <a class="toggle ' . $actaccordion . '" href="#"> ' . $itinerary->title . ' <span></span></a>
                                <div class="accordion-inner ' . $visible . '">
                                    ' . $itinerary->content . '
                                </div>
                ';
            }

            $respkg_detail .= '
                            </div>
                            <!-- accordion end -->
            ';
        }

        if (!empty($pkgRec->incexc)) {
            $respkg_detail .= '
                            <div class="list-single-main-item fl-wrap mt-5" id="sec4">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="list-single-main-item-title fl-wrap">
                                            <h3>What\'s Included</h3>
                                        </div>
                                        <div>
                                            ' . $pkgRec->incexc . '
                                        </div>
                                    </div>
                                </div>
                            </div>
            ';
        }

        if (!empty($pkgRec->booking_info)) {
            $respkg_detail .= '
                            <div class="list-single-main-item fl-wrap" id="">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="list-single-main-item-title fl-wrap">
                                            <h3>What\'s Excluded</h3>
                                        </div>
                                        <div class="listing-features ">
                                            ' . $pkgRec->booking_info . '
                                        </div>
                                    </div>
                                </div>
                            </div>
            ';
        }

        $respkg_detail .= '
                            <!-- list-single-main-item -->
                            <!--
                            <div class="list-single-main-item fl-wrap" id="sec5">
                                <div class="list-single-main-item-title fl-wrap">
                                    <h3>Reviews - <span> 2 </span></h3>
                                </div>
    
                                <div class="reviews-comments-wrap">
                                
                                    <div class="reviews-comments-item">
                                        <div class="review-comments-avatar">
                                            <img src="images/avatar/1.jpg" alt="">
                                        </div>
                                        <div class="reviews-comments-item-text">
                                            <h4><a href="#">Liza Rose</a></h4>
                                            <div class="review-score-user">
                                                <span>4.4</span>
                                                <strong>Good</strong>
                                            </div>
                                            <div class="clearfix"></div>
                                            <p>" Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis
                                                enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus
                                                ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. "</p>
                                            <div class="reviews-comments-item-date"><span><i
                                                    class="far fa-calendar-check"></i>12 April 2018</span><a href="#"><i class="fal fa-reply"></i>
                                                Reply</a></div>
                                        </div>
                                    </div>
                                    
                                    <div class="reviews-comments-item">
                                        <div class="review-comments-avatar">
                                            <img src="images/avatar/1.jpg" alt="">
                                        </div>
                                        <div class="reviews-comments-item-text">
                                            <h4><a href="#">Adam Koncy</a></h4>
                                            <div class="review-score-user">
                                                <span>4.7</span>
                                                <strong>Very Good</strong>
                                            </div>
                                            <div class="clearfix"></div>
                                            <p>" Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc posuere convallis purus non cursus.
                                                Cras metus neque, gravida sodales massa ut. "</p>
                                            <div class="reviews-comments-item-date"><span><i
                                                    class="far fa-calendar-check"></i>03 December 2017</span><a href="#"><i
                                                    class="fal fa-reply"></i> Reply</a></div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            -->
                            <!-- list-single-main-item end -->
                            <!-- list-single-main-item -->
                            <!--
                            <div class="list-single-main-item fl-wrap" id="sec6">
                                <div class="list-single-main-item-title fl-wrap">
                                    <h3>Add Review</h3>
                                </div>
                                <div id="add-review" class="add-review-box">
                                
                                    <form id="add-comment" class="add-comment  custom-form" name="rangeCalc">
                                        <fieldset>
    
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label><i class="fal fa-user"></i></label>
                                                    <input type="text" placeholder="Your Name *" value=""/>
                                                </div>
                                                <div class="col-md-6">
                                                    <label><i class="fal fa-envelope"></i> </label>
                                                    <input type="text" placeholder="Email Address*" value=""/>
                                                </div>
                                            </div>
    
                                            <textarea cols="40" rows="3" placeholder="Your Review:"></textarea>
                                            <label for="">Rate</label>
                                            <select name="" id="">
                                                <option value="1">1</option>
                                            </select>
                                        </fieldset>
                                        <button class="btn  big-btn flat-btn float-btn color2-bg" style="margin-top:30px">Submit Review <i
                                                class="fal fa-paper-plane"></i></button>
                                    </form>
                                </div>
                            </div>
                            -->
                            <!-- list-single-main-item end -->
                        </div>
                    </div>
                    <!--   datails end  -->
                    ';

        $traveldate = date('Y-m-d', strtotime("+1 day"));
        $respkg_detail .= '
                    <!--   sidebar  -->
                    <div class="col-md-4">
                        <!--box-widget-wrap -->
                        <div class="box-widget-wrap">
                            <!--box-widget-item -->
                            <div class="box-widget-item fl-wrap bookin-blur-box">
                                <div class="box-widget">
                                    <div class="box-widget-content">
                                        <div class="box-widget-item-header">
                                            <h3 class="fs-5"> Online Booking</h3>
                                        </div>
                                        <div class=" error-message-guest py-1" style="display:none"></div>
                                        <form name="bookFormCalc" class="book-form custom-form">
                                            <fieldset>
                                            
                                                <input type="hidden" name="pkgid" id="pkgid" value="' . $pkgRec->id . '">
                                                <input type="hidden" name="slug" id="slug" value="' . $pkgRec->slug . '">
    
                                                <div class="cal-item">
                                                    <div class="bookdate-container  fl-wrap">
                                                        <label><i class="fal fa-calendar-check"></i> When </label>
                                                        <!--<input type="text" placeholder="Date In-Out" name="bookdates" value=""/>-->
                                                        <input type="text" placeholder="Select Travel Date" id="travelDate" value="' . $traveldate . '"/>
                                                        <div class="bookdate-container-dayscounter"><i class="far fa-question-circle"></i><span>Days : <strong>0</strong></span>
                                                        </div>
                                                    </div>
                                                </div>
    
                                                <div class="cal-item">
                                                    <div class="listsearch-input-item">
                                                        <label>No. of Pax</label>
                                                        <!--
                                                        <select data-placeholder="Room Type" name="pax" id="pax" class="chosen-select no-search-select">
                                                            <option value="" selected>No. of PAX</option>
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                            <option value="5">5</option>
                                                            <option value="6+">6+</option>
                                                        </select>
                                                        -->
                                                        <input type="number" name="pax" id="pax" class="" min="1" value="1">
                                                        <!--data-formula -->
                                                        <input type="text" name="item_total" class="hid-input" value="" data-form="{repopt}">
                                                    </div>
                                                </div>
    
                                            </fieldset>
                                            <button class="btnaplly color2-bg book-btn-check">Book Now<i class="fal fa-paper-plane"></i></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!--box-widget-item end -->
                            ';

        $similarTours = Package::get_filterpkg_by($pkgRec->id, '', $pkgRec->activityId, '', 8);
        if (!empty($similarTours)) {
            $respkg_detail .= '
                            <!--box-widget-item -->
                            <div class="box-widget-item fl-wrap">
                                <div class="box-widget">
                                    <div class="box-widget-content">
                                        <div class="box-widget-item-header">
                                            <h3>Similar Listings</h3>
                                        </div>
                                        <div class="widget-posts fl-wrap">
                                            <ul>
            ';

            foreach ($similarTours as $similarTour) {
                $img = BASE_URL . 'template/nepalhotel/images/gal/1.jpg';
                if (!empty($similarTour->image)) {
                    $file_path = SITE_ROOT . 'images/package/' . $similarTour->image;
                    if (file_exists($file_path)) {
                        $img = IMAGE_PATH . 'package/' . $similarTour->image;
                    }
                }
                $dest_title = Destination::field_by_id($similarTour->destinationId, 'title');
                $respkg_detail .= '
                    <li class="clearfix">
                        <a href="' . BASE_URL . 'package/' . $similarTour->slug . '" class="widget-posts-img">
                            <img src="' . $img . '" class="respimg" alt="' . $similarTour->title . '">
                        </a>
                        <div class="widget-posts-descr">
                            <a href="' . BASE_URL . 'package/' . $similarTour->slug . '" title="">' . $similarTour->title . '</a>
                            <div class="listing-rating card-popup-rainingvis" data-starrating2="' . $similarTour->gread . '"></div>
                            <div class="geodir-category-location fl-wrap">
                                <a href="#"><i class="fas fa-map-marker-alt"></i> ' . $dest_title . '</a>
                            </div>
                            ';
                $respkg_detail .= (!empty($similarTour->price)) ? '<span class="rooms-price">\$' . $similarTour->price . ' <strong> /  <span title="per person">pp</span></strong></span>' : '';
                $respkg_detail .= '
                        </div>
                    </li>
                ';
            }

            $respkg_detail .= '
                                            </ul>
                                            <a class="widget-posts-link" href="#">See All Listing <i class="fal fa-long-arrow-right"></i> </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--box-widget-item end -->
            ';
        }

        $respkg_detail .= '
                        </div>
                        <!--box-widget-wrap end -->
                    </div>
                    <!--   sidebar end  -->
                </div>
                <!--   row end  -->
            </div>
            <!--   container  end  -->
        ';
    } else {
        redirect_to(BASE_URL);
    }
}

$jVars['module:packagedetail:package-bread'] = $respkg_bread;
$jVars['module:packagedetail:package-detail'] = $respkg_detail;
?>