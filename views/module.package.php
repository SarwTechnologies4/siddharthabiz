<?php

$search_form = $package_detail = '';

if (defined('PACKAGE_SEARCH_PAGE')) {

    global $db;
    $sql = "SELECT pkg.id, pkg.title, pkg.slug, pkg.breif, pkg.image, pkg.price, pkg.difficulty, pkg.mapgoogle, pkg.gread,
            act.title as activity, act.slug as activity_slug, 
            dst.title as destination, dst.slug as destination_slug
            FROM tbl_package as pkg 
            INNER JOIN tbl_destination as dst ON pkg.destinationId = dst.id 
            INNER JOIN tbl_activities as act ON pkg.activityId = act.id 
            WHERE pkg.status=1 ";

    $code = (!empty($_REQUEST['code'])) ? addslashes($_REQUEST['code']) : '';
    $urldecode = unserialize(base64_decode(strtr($code, '-_', '+/')));

    if (!empty($urldecode)) {
        foreach ($urldecode as $key => $val) {
            $$key = $val;
        }

        if (@$destination != 'all' and !empty($destination)) {
            $sql .= " AND pkg.destinationId = $destination ";
        }

        if (@$activity != 'all' and !empty($activity)) {
            $sql .= " AND act.id = '$activity' ";
        }

        if (!empty($duration)) {
            switch ($duration) {
                case '5':
                    $sql .= " AND pkg.days <= $duration ";
                    break;
                case '10':
                    $sql .= " AND ( pkg.days > 5 AND pkg.days <= $duration ) ";
                    break;
                case '15':
                    $sql .= " AND ( pkg.days > 10 AND pkg.days <= $duration ) ";
                    break;
                case 'morethan15':
                    $sql .= " AND pkg.days >= 16 ";
                    break;
            }
        }
    }

    $res = $db->query($sql);
    $total = $db->affected_rows($res);

    if ($total > 0) {
        while ($rows = $db->fetch_object($res)) {
            $img = BASE_URL . 'template/nepalhotel/images/gal/1.jpg';
            if (!empty($rows->image)) {
                $file_path = SITE_ROOT . 'images/package/' . $rows->image;
                if (file_exists($file_path)) {
                    $img = IMAGE_PATH . 'package/' . $rows->image;
                }
            }

            $length = strlen($rows->breif);
            $elipses = ($length > 120) ? '...' : '';

            $package_detail .= '
                <div class="listing-item has_one_column" data-jplist-item>
                    <article class="geodir-category-listing fl-wrap">
                        <div class="geodir-category-img">
                            <a href="' . BASE_URL . 'package/' . $rows->slug . '">
                                <img src="' . $img . '" alt="' . $rows->title . '">
                            </a>
                            <div class="geodir-category-opt">
                                <div class="listing-rating card-popup-rainingvis" data-starrating2="' . $rows->gread . '"></div>
                                <div class="rate-class-name">
                                    <span><a href="' . BASE_URL . 'package/' . $rows->slug . '">More</a></span>
                                </div>
                            </div>
                        </div>
                        <div class="geodir-category-content fl-wrap">
                            <div class="geodir-category-content-title fl-wrap">
                                <div class="geodir-category-content-title-item">
                                    <h3 class="title-sin_map">
                                        <a href="' . BASE_URL . 'package/' . $rows->slug . '" class="ttitle">' . $rows->title . '</a>
                                    </h3>
                                    <div class="geodir-category-location fl-wrap">
                                        <a href="javascript:;" class="map-item"><i class="fas fa-map-marker-alt"></i> ' . $rows->destination . '</a>
                                    </div>
                                </div>
                            </div>
                            
                            <p>' . substr($rows->breif, 0, 120) . $elipses . '</p>

                            <div class="geodir-category-footer fl-wrap">
                                <div class="geodir-opt-link">
                                    <div class="geodir-category-price">$ <span class="price">' . $rows->price . '</span> pp</div>
                                </div>
                                <div class="geodir-opt-list">
                                    <a href="' . $rows->mapgoogle . '" target="_blank" >
                                        <i class="fal fa-map-marker-alt"></i>
                                        <span class="geodir-opt-tooltip">On the map</span>
                                    </a>
                                    <a href="#" class="geodir-js-booking">
                                        <i class="fal fa-tachometer-alt"></i>
                                        <span class="geodir-opt-tooltip">Difficulty: ' . $rows->difficulty . '</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
            ';
        }
    } else {
        $package_detail .= '
            <div class="geodir-category-content fl-wrap">
                <h3>No Result Found</h3>
            </div>
        ';
    }


    $search_form .= '
        <form id="toursearchform" action="" method="post" novalidate="novalidate">
        <h3 class="fs-5 text-start">Search Trips</h3>
            <!--col-list-search-input-item -->
            <div class="col-list-search-input-item in-loc-dec not-vis-arrow">
                <label class="mb-0">Destination</label>
                <div class="listsearch-input-item mb-2">
                    <select data-placeholder="Destination" name="destination" class="chosen-select nice-select no-search-select">
                        <option value="all">All Destination</option>
                        ';
    $destId = !empty($destination) ? $destination : '';
    $search_form .= Destination::get_destination_option($destId);
    $search_form .= '
                    </select>
                </div>
                <div class="clearfix"></div>
            </div>
            <!--col-list-search-input-item end-->

            <div class="col-list-search-input-item in-loc-dec not-vis-arrow">
                <label class="mb-0">Activities</label>
                <div class="listsearch-input-item mb-2">
                    <select data-placeholder="Activity" name="activity" class="chosen-select nice-select no-search-select">
                        <option value="all">All Activities</option>
                        ';
    $actId = !empty($activity) ? $activity : '';
    $search_form .= Activities::get_activity_option($actId);
    $search_form .= '     
                    </select>
                </div>
                <div class="clearfix"></div>
            </div>

            <div class="col-list-search-input-item in-loc-dec not-vis-arrow">
                <label class="mb-0">Duration</label>
                <div class="listsearch-input-item mb-2">
                    <select data-placeholder="Duration" name="duration" class="chosen-select nice-select no-search-select">
                        <option value="all">All Duration</option>
                        ';

    $durationRec = array('5' => '1-5 Days', '10' => '6-10 Days', '15' => '11-15 Days', 'morethan15' => 'More than 15 Days');
    foreach ($durationRec as $k => $v) {
        $sel = ($k == @$duration) ? 'selected' : '';
        $search_form .= '<option value="' . $k . '" ' . $sel . '>' . $v . ' </option>';
    }

    $search_form .= '
                    </select>
                </div>
                <div class="clearfix"></div>
            </div>

            <!--col-list-search-input-item  -->
            <div class="col-list-search-input-item fl-wrap">
                <button class="header-search-button" type="submit" id="tourSearchBtn">Search <i class="far fa-search"></i></button>
            </div>
            <!--col-list-search-input-item end-->
        </form>
    ';

}

$jVars['module:package:search-form'] = $search_form;
$jVars['module:package:detail'] = $package_detail;
?>