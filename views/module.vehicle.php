<?php

/**
 *          Vehicle Search List page
 */
$vehicle = '';

if (defined('VEHICLE_SEARCH_PAGE')) {
    if (!empty($_REQUEST['code'])) {
        $code = addslashes($_REQUEST['code']);
        $urldecode = unserialize(base64_decode(strtr($code, '-_', '+/')));
        $skey = array($urldecode['from_id'], $urldecode['to_id']);
        $first = implode(',', $skey);
        $last = implode(',', array_reverse($skey));

        global $db;
        $sql = "SELECT id FROM tbl_vprice WHERE route_combine='{$first}' OR route_combine='{$last}' ";
        $query = $db->query($sql);

        $addQuery = '';
        while ($row = $db->fetch_object($query)) {
            $addQuery .= "vc.vp_id='{$row->id}' OR ";
        }
        $addQuery = rtrim($addQuery, "OR ");

        if (!empty($addQuery)) {
            /*$sqlz = "SELECT vc.vehicle_price, vc.id as vcid, v.id, v.title, v.content, v.image, v.max_pax, v.added_by FROM tbl_vcombine AS vc
            INNER JOIN tbl_vehicle AS v ON v.id = vc.vehicle_id
            WHERE vc.vp_id='{$row->id}' ";*/
            $sqlz = "SELECT vc.vehicle_price, vc.id as vcid, vc.vp_id as vprice_id, v.id, v.title, v.content, v.image, v.max_pax, v.added_by FROM tbl_vcombine AS vc 
            INNER JOIN tbl_vehicle AS v ON v.id = vc.vehicle_id
            WHERE {$addQuery} ";
            $queryz = $db->query($sqlz);
            $vehicle = ob_start(); ?>
            <div class="row">
                <!--filter sidebar -->
                <div class="col-md-3">
                    <div class="mobile-list-controls fl-wrap">
                        <div class="mlc show-list-wrap-search fl-wrap"><i class="fal fa-filter"></i> Filter</div>
                    </div>
                    <div class="fl-wrap filter-sidebar_item fixed-bar">
                        <div class="filter-sidebar fl-wrap lws_mobile">
                            <h2 class="fs-5 text-start mb-3"><strong>Search for suitable vehicles </strong></h2>
                            <form id="vehicleForm" method="post" autocomplete="off">
                                <div class="col-list-search-input-item date-container fl-wrap">
                                    <span class="inpt_dec"><i class="fal fa-map-marker"></i></span>
                                    <input type="text" id="search-from" name="searchkey_from" value="<?php echo $urldecode['fromkey']; ?>"
                                           autocomplete="off"/>
                                    <input type="hidden" name="search_from" value="<?php echo $urldecode['from_id']; ?>">
                                </div>
                                <div class="col-list-search-input-item date-container fl-wrap">
                                    <span class="inpt_dec"><i class="fal fa-map-marker"></i></span>
                                    <input type="text" id="search-to" name="searchkey_to" value="<?php echo $urldecode['tokey']; ?>"
                                           autocomplete="off"/>
                                    <input type="hidden" name="search_to" value="<?php echo $urldecode['to_id']; ?>">
                                </div>
                                <div class="col-list-search-input-item date-container fl-wrap">
                                    <span class="inpt_dec"><i class="fal fa-calendar-check"></i></span>
                                    <input type="text" id="search-date" name="search_date" value="<?php echo $urldecode['date']; ?>"
                                           autocomplete="off"/>
                                </div>
                                <div class="col-list-search-input-item date-container fl-wrap">
                                    <span class="inpt_dec"><i class="fal fal fa-users"></i></span>
                                    <input type="text" min="1" id="search-pax" name="search_pax" autocomplete="off"
                                           value="<?php echo ($urldecode['pax'] > 0) ? $urldecode['pax'] : 1; ?>"/>
                                </div>
                                <div class="col-list-search-input-item fl-wrap">
                                    <button class="header-search-button">Search <i class="far fa-search"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!--filter sidebar end-->
                <!--listing -->
                <div class="col-md-9">
                    <!--col-list-wrap -->
                    <div class="col-list-wrap fw-col-list-wrap post-container">
                        <!-- list-main-wrap-->
                        <div class="list-main-wrap fl-wrap card-listing">

                            <!-- listing-item-container -->
                            <div class="listing-item-container init-grid-items fl-wrap">
                                <?php $totRec = $db->num_rows($queryz);
                                if ($totRec > 0) {
                                    while ($rowz = $db->fetch_object($queryz)) {
                                        $btnClass = 'plz-login';
                                        $btnText = 'Please Login';
                                        $uId = $session->get("user_id");
                                        if ($uId) {
                                            $btnClass = 'add-vehicle';
                                            $btnText = 'Add Vehicle';
                                        } ?>
                                        <div class="listing-item has_one_column">
                                            <article class="geodir-category-listing fl-wrap">
                                                <div class="geodir-category-img">
                                                    <?php if ($rowz->image != "a:0:{}") {
                                                        $imageList = unserialize($rowz->image);
                                                        $imgno = array_rand($imageList);
                                                        $file_path = SITE_ROOT . 'images/vehicle/' . $imageList[$imgno];
                                                        if (file_exists($file_path)) {
                                                            $imglink = IMAGE_PATH . 'vehicle/' . $imageList[$imgno];
                                                        } else {
                                                            $imglink = IMAGE_PATH . '1.jpg';
                                                        }
                                                    } ?>
                                                    <img src="<?php echo $imglink; ?>" alt="<?php echo $rowz->title; ?>">
                                                </div>
                                                <div class="geodir-category-content fl-wrap title-sin_item">
                                                    <div class="geodir-category-content-title fl-wrap">
                                                        <div class="geodir-category-content-title-item">
                                                            <h2 class="title-sin_map fs-4 text-start mb-2">
                                                                <strong><?php echo $rowz->title; ?></strong></h2>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-8 text-start d-flex">
                                                            <div title="Max. Occupancy">
                                                                <i class="fal fa-user-alt me-1"></i>

                                                                <?php echo $rowz->max_pax; ?>
                                                                <small>pax</small>

                                                            </div>
                                                            <div class="ms-3" title="Route">
                                                                <i class="fal fa-map-marker me-1"></i>

                                                                <?php echo Route::field_by_id($urldecode['from_id'], 'title'); ?>
                                                                - <?php echo Route::field_by_id($urldecode['to_id'], 'title'); ?>
                                                            </div>
                                                            <div title="Car Door" class="ms-3">
                                                                <img src="<?php echo BASE_URL . 'template/nepalhotel/images/car-door.svg' ?>"
                                                                     width="20px"/>
                                                                4

                                                            </div>
                                                            <div><?php echo $rowz->content; ?></div>
                                                        </div>
                                                        <div class="col-sm-4 text-end">
                                                            <div class="fs-4"><strong>$ <?php echo $rowz->vehicle_price; ?></strong></div>
                                                        </div>
                                                        <div class="col-sm-12 text-start mt-2 vehicle-detail">
                                                            <input name="user_id" class="user_id" type="hidden" value="<?= $uId ?>">
                                                            <input name="vehicle_id" class="vehicle_id" type="hidden" value="<?= $rowz->id ?>">
                                                            <input name="vehicle_price" class="vehicle_price" type="hidden"
                                                                   value="<?= $rowz->vehicle_price ?>">
                                                            <input name="vendor_id" class="vendor_id" type="hidden" value="<?= $rowz->added_by ?>">
                                                            <input name="vprice_id" class="vprice_id" type="hidden" value="<?= $rowz->vprice_id ?>">
                                                            <button class="btn btn-primary btn-sm text-start <?= $btnClass ?>"><?= $btnText ?></button>
                                                        </div>
                                                        <?php if ($rowz->max_pax < $urldecode['pax']) { ?>
                                                            <div class="col-sm-12">
                                                                <div>
                                                                    <p>
                                                                        <small>(Please add more than one vehicle)*</small>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </article>
                                        </div>
                                    <?php }
                                    if ($uId) { ?>
                                        <!--
                                        <button class="btn btn-primary text-start book-vehicle"
                                                style="position: fixed; bottom: 65px; right: 20px; box-shadow: 0px 0px 0px 4px rgb(0 0 0 / 20%);">Book Now
                                        </button>
                                        -->
                                        <div class="vehicle-added"
                                             style="position: fixed; bottom: 170px; right: 20px;"></div>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </div>
                        <!-- list-main-wrap end-->
                    </div>
                    <!--col-list-wrap end -->
                </div>
                <!--listing  end-->
            </div>
            <!--row end-->
            <?php
            $vehicle = ob_get_clean();
        } else {
            $vehicle = ob_start(); ?>
            <div class="row">
                <!--filter sidebar -->
                <div class="col-md-3">
                    <div class="mobile-list-controls fl-wrap">
                        <div class="mlc show-list-wrap-search fl-wrap"><i class="fal fa-filter"></i> Filter</div>
                    </div>
                    <div class="fl-wrap filter-sidebar_item fixed-bar">
                        <div class="filter-sidebar fl-wrap lws_mobile">
                            <h2 class="fs-5 text-start mb-3"><strong>Search for suitable vehicles </strong></h2>
                            <form id="vehicleForm" method="post" autocomplete="off">
                                <div class="col-list-search-input-item date-container fl-wrap">
                                    <span class="inpt_dec"><i class="fal fa-map-marker"></i></span>
                                    <input type="text" id="search-from" name="searchkey_from" value="<?php echo $urldecode['fromkey']; ?>"
                                           autocomplete="off"/>
                                    <input type="hidden" name="search_from" value="<?php echo $urldecode['from_id']; ?>">
                                </div>
                                <div class="col-list-search-input-item date-container fl-wrap">
                                    <span class="inpt_dec"><i class="fal fa-map-marker"></i></span>
                                    <input type="text" id="search-to" name="searchkey_to" value="<?php echo $urldecode['tokey']; ?>"
                                           autocomplete="off"/>
                                    <input type="hidden" name="search_to" value="<?php echo $urldecode['to_id']; ?>">
                                </div>
                                <div class="col-list-search-input-item date-container fl-wrap">
                                    <span class="inpt_dec"><i class="fal fa-calendar-check"></i></span>
                                    <input type="text" id="search-date" name="search_date" value="<?php echo $urldecode['date']; ?>"
                                           autocomplete="off"/>
                                </div>
                                <div class="col-list-search-input-item date-container fl-wrap">
                                    <span class="inpt_dec"><i class="fal fal fa-users"></i></span>
                                    <input type="text" min="1" id="search-pax" name="search_pax" autocomplete="off"
                                           value="<?php echo ($urldecode['pax'] > 0) ? $urldecode['pax'] : 1; ?>"/>
                                </div>
                                <div class="col-list-search-input-item fl-wrap">
                                    <button class="header-search-button">Search <i class="far fa-search"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!--filter sidebar end-->
                <!--listing -->
                <div class="col-md-9">
                    <!--col-list-wrap -->
                    <div class="col-list-wrap fw-col-list-wrap post-container">
                        <!-- list-main-wrap-->
                        <div class="list-main-wrap fl-wrap card-listing">

                            <!-- listing-item-container -->
                            <div class="listing-item-container init-grid-items fl-wrap">
                                <div class="listing-item has_one_column" style="">
                                    <article class="geodir-category-listing fl-wrap">
                                        <div class="geodir-category-conten fl-wrap title-sin_item">
                                            <div class="geodir-category-content-title fl-wrap">
                                                <div class="geodir-category-content-title-item">
                                                    <h2 class="title-sin_map fs-4 text-start mb-2 text-center">
                                                        <strong>No Vehicles Found</strong>
                                                    </h2>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                </div>
                            </div>
                        </div>
                        <!-- list-main-wrap end-->
                    </div>
                    <!--col-list-wrap end -->
                </div>
                <!--listing  end-->
            </div>
            <!--row end-->
            <?php $vehicle = ob_get_clean();
        }
    }
}

$jVars['module:vehiclelist'] = $vehicle;


/**
 *          Vehicle Search Page
 */

$vehicle_search = '';

if (defined('VEHICLESEARCH_PAGE')) {

    $popular_dests = Route::get_all_byparnt();
    if (!empty($popular_dests)) {
        $vehicle_search .= '
            <div class="popdest bg-white py-5">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <h2 class="fs-4 my-4 text-start"><strong>Popular destinations for hire</strong></h2>
                        </div>
                        ';

        $length = sizeof($popular_dests);
        $remainder = ($length % 3);
        for ($i = 0; $i < $remainder; $i++) {
            $popped_element = array_pop($popular_dests);
        }

        foreach ($popular_dests as $popular_dest) {
            $img = BASE_URL . 'template/nepalhotel/images/city/kathmandu.jpg';
            $file_path = SITE_ROOT . 'images/route/' . $popular_dest->image;
            if (!empty($popular_dest->image) and file_exists($file_path)) {
                $img = IMAGE_PATH . 'route/' . $popular_dest->image;
            }
            $childs = Route::getTotalChild($popular_dest->id);
            $sql = "SELECT MIN(vehicle_price) as price FROM tbl_vcombine as vc 
                    INNER JOIN tbl_vprice as vp ON vc.vp_id = vp.id
                    INNER JOIN tbl_route as r ON (r.id = vp.route_from OR r.id = vp.route_to)
                    WHERE r.parent_id = {$popular_dest->id} AND vp.status=1";
            $res = $db->query($sql);
            $price = $db->fetch_array($res);
            $vehicle_search .= '
                <div class="col-sm-4">
                    <div class="card overflow-hidden">
                        <div class="card-body p-0">
                            <img src="' . $img . '" alt="' . $popular_dest->title . '" class="img-fluid"/>
                            <div class="popcontent p-4 text-start">
                                <h3 class="fs-5 pb-3"><strong>' . $popular_dest->title . '</strong></h3>
                                <div class="row">
                                    <div class="col-sm-6 d-flex">
                                        <i class="fa fa-map-marker-alt me-2"></i>
                                        <small> Vehicle hire in <strong>' . $childs . '</strong> locations</small>
                                    </div>
                                    <div class="col-sm-6 d-flex">
                                        <i class="fa fa-money-bill me-2"></i>
                                        <small>From <strong>NPR ' . ((!empty($price['price'])) ? $price['price'] : '') . '</strong> per ride</small>
                                    </div>
                                </div>
                                <a href="#" class="text-primary mt-3 d-block">Search vehicles in ' . $popular_dest->title . '</a>
                            </div>
                        </div>
                    </div>
                </div>
            ';
        }

        $vehicle_search .= '
                    </div>
                </div>
            </div>
        ';
    }

    $popular_brands = Page::find_by_id(4);
    if (!empty($popular_brands)) {
        $vehicle_search .= '
            <div class="brands bg-white py-5 text-start">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            ' . $popular_brands->content . '
                        </div>
                    </div>
                </div>
            </div>
        ';
    }

    $faq = Page::find_by_id(5);
    if (!empty($faq)) {
        $vehicle_search .= '
            <div class="faq py-5 text-start">
                <div class="container py-5">
                    <div class="row">
                        ' . $faq->content . '
                    </div>
                </div>
            </div>
        ';
    }
}

$jVars['module:vehicle:search-detail'] = $vehicle_search;