<?php 
// Testimonial List
$restst='';

if(defined('HOMEPAGE')) {

	$tstRec = Testimonial::get_alltestimonial();
	if(!empty($tstRec)) {
	$restst.='<section>
                        <div class="container">
                            <div class="section-title">
                                <div class="section-title-separator"><span></span></div>
                                <h2>Testimonials</h2>
                                <span class="section-separator"></span>
                                <p>We are happy that our users are happy. Few happiness as shared by our valued users.</p>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <!--slider-carousel-wrap -->
                        <div class="slider-carousel-wrap text-carousel-wrap fl-wrap">
                            <div class="swiper-button-prev sw-btn"><i class="fa fa-long-arrow-left"></i></div>
                            <div class="swiper-button-next sw-btn"><i class="fa fa-long-arrow-right"></i></div>
                            <div class="text-carousel single-carousel fl-wrap">';
		foreach($tstRec as $tstRow) {
			$restst.='<div class="slick-item">
                                    <div class="text-carousel-item">
                                        <div class="popup-avatar"><img src="'.IMAGE_PATH.'testimonial/'.$tstRow->image.'" alt="'.$tstRow->name.'"></div>
                                        <!--<div class="listing-rating card-popup-rainingvis" data-starrating2="5"> </div>-->
                                        <div class="review-owner fl-wrap">'.$tstRow->name.' <!-- - <span></span>--></div>
                                        <p> '.strip_tags($tstRow->content).'</p>
                                       <!-- <a class="testim-link">'.$tstRow->name.'</a>-->
                                    </div>
                                </div>';
		}
	$restst.=' <!--slick-item end -->
                            </div>
                        </div>
                        <!--slider-carousel-wrap end-->
                    </section>';
	}

}

$jVars['module:testimonialHome'] = $restst;

$appcomingsoon='';
$appcomingsoon.='<section class="color-bg hidden-section">
                        <div class="wave-bg wave-bg2"></div>
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6">
                                    <!-- -->
                                    <div class="colomn-text  pad-top-column-text fl-wrap">
                                        <div class="colomn-text-title">
                                            <h3>Our App  is COMING SOON</h3>
                                            <p>Our app is launching soon for Android Play Store and Apple Store. Please check this section for new updates in terms of app. An extensive app which allows to book and confirm reservations via app. </p>
                                            <a href="#" class=" down-btn color3-bg"><i class="fab fa-apple"></i> Coming Soon</a>
                                            <a href="#" class=" down-btn color3-bg"><i class="fab fa-android"></i> Coming Soon</a>
                                        </div>
                                    </div>
                                    <!--process-wrap   end-->                                
                                </div>
                                <div class="col-md-6">
                                    <div class="collage-image">
                                        <img src="'.BASE_URL.'template/nepalhotel/images/api.png" class="main-collage-image" alt="">
                                        <div class="images-collage-title color3-bg">Gundri<span> Booking</span></div>
                                        <div class="collage-image-min cim_1"><img src="'.BASE_URL.'template/nepalhotel/images/api/2.jpg" alt=""></div>
                                        <div class="collage-image-min cim_2"><img src="'.BASE_URL.'template/nepalhotel/images/api/1.jpg" alt=""></div>
                                        <div class="collage-image-min cim_3"><img src="'.BASE_URL.'template/nepalhotel/images/api/3.jpg" alt=""></div>
                                        
                                        <div class="collage-image-btn color2-bg">Coming Soon</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>';
$jVars['module:appcomingsoon'] = $appcomingsoon;

$ownerofhotel='';

$ownerofhotel.=' <section class="parallax-section" data-scrollax-parent="true">
                        <div class="bg"  data-bg="'.BASE_URL.'template/nepalhotel/images/bg/rama.jpg" data-scrollax="properties: { translateY: \'100px\' }"></div>
                        <div class="overlay"></div>
                        <!--container-->
                        <div class="container">
                            <div class="row">
                                <div class="col-md-8">
                                    <!-- column text-->
                                    <div class="colomn-text fl-wrap">
                                        <div class="colomn-text-title">
                                            <h3>The owner of the hotel?</h3>
                                            <p>List your hotel with us to attract guests who has never been in your reach.</p>
                                            <a href="'.BASE_URL.'/contact" class="btn  color-bg float-btn">Add your hotel<i class="fal fa-plus"></i></a>
                                        </div>
                                    </div>
                                    <!--column text   end-->
                                </div>
                            </div>
                        </div>
                    </section>';
$jVars['module:ownerofhotel'] = $ownerofhotel;