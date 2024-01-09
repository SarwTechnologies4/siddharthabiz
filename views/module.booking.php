<?php

/**
 *          Package Booking
 */
$book_form = $book_sidebar = '';
if (defined('BOOK_PAGE')) {
    foreach ($_POST as $key => $val) {
        $$key = $val;
    }

    $slug = (!empty($_REQUEST['slug'])) ? addslashes($_REQUEST['slug']) : '';
    $pkgRec = Package::find_by_slug($slug);

    if (!empty($pkgRec)) {
        $book_form .= '
        <div class="customer-information">
            <h3 class="fs-5 mb-2">Personal Information</h3>
            <form id="booking_form">
                <input type="hidden" name="packageId" value="' . $pkgRec->id . '">
                <input type="hidden" name="vendorId" value="' . $pkgRec->added_by . '">
                <input type="hidden" name="traveldate" value="' . $traveldate . '">
                <input type="hidden" name="pax" value="' . $pax . '">
                <input type="hidden" name="total" value="' . ($pax * $pkgRec->price) . '">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label class="form-label">First Name</label>
                            <input type="text" class="form-control" placeholder="John" name="fname">
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label class="form-label">Last Name</label>
                            <input type="text" class="form-control" placeholder="Doe" name="lname">
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" placeholder="youremail@example.com" name="email">
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label class="form-label">Phone</label>
                            <input type="text" class="form-control" placeholder="+xx xxx xxxxx" name="phone">
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label class="form-label">Country</label>
                            <select data-placeholder="Select" name="country" class="form-control">
                                <option value="">Select</option>
                                ';
        $countries = Countries::find_all();
        foreach ($countries as $country) {
            $book_form .= '<option value="' . $country->country_name . '">' . $country->country_name . '</option>';
        }
        $book_form .= '
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label class="form-label">City</label>
                            <input type="text" class="form-control" name="city">
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <div class="form-group">
                            <label class="form-label">Special Requirements</label>
                            <textarea class="form-control" name="message"></textarea>
                        </div>
                    </div>
                    ';
        if ($pax > 1) {
            $book_form .= '
                    <div class="col-md-12 mb-3">
                       <h3 class="fs-5 mb-2">Personal Information</h3>
                    </div>
            ';
            $extra_pax = $pax - 1;
            for ($i = 0; $i < $extra_pax; $i++) {
                $book_form .= '
                    <div class="col-md-4 mb-3">
                        <div class="form-group">
                            <label class="form-label">Full Name</label>
                            <input type="text" class="form-control" placeholder="Full Name" name="pax_full_name[]" required>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="form-group">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" placeholder="Email" name="pax_email[]" required>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="form-group">
                            <label class="form-label">Age</label>
                            <input type="number" class="form-control" placeholder="Age" name="pax_age[]" required>
                        </div>
                    </div>
                ';
            }
        }
        $book_form .= '
                    <div class="col-md-12">
                        <div class="form-btn">
                            <button type="submit" id="submit" class="btn color-bg">Book Now</button>
                        </div>
                    </div>
                    <div id="msg" style="display: none;"></div>
                </div>    
            </form>
        </div>
        ';

        $total = $pkgRec->price * $pax;
        $book_sidebar .= '
            <div class="sidebar-booking">
                <h4 class="mb-2 fs-6"><strong>Booking Detail</strong>    </h4>
                <table>
                    <tr>
                        <td colspan="2" class="text-left">
                            Package Name <br>
                            <strong>' . $pkgRec->title . '</strong>
                        </td>

                    </tr>
                    <tr>
                        <td>Date</td>
                        <td class="text-right">' . $traveldate . '</td>
                    </tr>
                    <tr>
                        <td>Duration</td>
                        <td class="text-right">' . $pkgRec->days . ' Days</td>
                    </tr>

                    <tr>
                        <td>Total Pax</td>
                        <td class="text-right">' . $pax . '</td>
                    </tr>
                </table>
            </div>
            <div class="sidebar-payment">
                <h4 class="mb-2 fs-6"><strong>Payment</strong></h4>
                <table>
                    <tr>
                        <td>Pax Price</td>
                        <td class="text-center">x' . $pax . '</td>
                        <td class="text-right">$ ' . $pkgRec->price . '</td>
                    </tr>
                    <tr>
                        <td class="weight-600" colspan="2">Amount</td>
                        <td class="weight-600 text-right">$ ' . $total . '</td>
                    </tr>
                </table>
            </div>
            <div class="empty-div"></div>
        ';
    }
}
$jVars['module:book:form'] = $book_form;
$jVars['module:book:sidebar'] = $book_sidebar;


/**
 *          Vehicle Booking
 */

$book_form_vehicle = $book_sidebar_vehicle = '';
if (defined('BOOK_VEHICLE_PAGE')) {
    if (!empty($_REQUEST['code'])) {

        $code = addslashes($_REQUEST['code']);
        $urldecode = unserialize(base64_decode(strtr($code, '-_', '+/')));

        foreach ($urldecode as $key => $val) {
            $$key = $val;
        }

        $new_arr = array();
        $total = 0;
        $vehicles = $_SESSION['cart_detail'][$user_id];
        foreach ($vehicles as $k => $v) {
            $vehicle = Vehicle::find_by_id($k);
            if (!empty($vehicle)) {
                $total = $total + ($v['vehicle_price'] * $v['quantity']);
            }
        }

        $userInfo = User::find_by_id($user_id);
        $userName = explode(' ', $userInfo->first_name);
        $firstName = $userName[0];
        $lastName = end($userName);

        $book_form_vehicle .= '
            <form id="booking_form">
                <input type="hidden" name="user_id" value="' . $user_id . '">
                <input type="hidden" name="from_id" value="' . $from_id . '">
                <input type="hidden" name="to_id" value="' . $to_id . '">
                <input type="hidden" name="date" value="' . $date . '">
                <input type="hidden" name="pax" value="' . $pax . '">
                <input type="hidden" name="total" value="' . $total . '">
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label class="form-label">First Name</label>
                            <input type="text" class="form-control" placeholder="John" name="fname" value="' . ((!empty($firstName)) ? $firstName : '') . '">
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label class="form-label">Last Name</label>
                            <input type="text" class="form-control" placeholder="Doe" name="lname" value="' . ((!empty($lastName)) ? $lastName : '') . '">
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" placeholder="youremail@example.com" name="email" value="' . ((!empty($userInfo->email)) ? $userInfo->email : '') . '">
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label class="form-label">Phone</label>
                            <input type="text" class="form-control" placeholder="+xx xxx xxxxx" name="phone" value="' . ((!empty($userInfo->contact)) ? $userInfo->contact : '') . '">
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label class="form-label">Country</label>
                            <select data-placeholder="Select" name="country" class="form-control">
                                <option value="">Select</option>
                                ';
        $countries = Countries::find_all();
        foreach ($countries as $country) {
            $book_form_vehicle .= '<option value="' . $country->country_name . '">' . $country->country_name . '</option>';
        }
        $book_form_vehicle .= '
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label class="form-label">City</label>
                            <input type="text" class="form-control" name="city">
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <div class="form-group">
                            <label class="form-label">Special Requirements</label>
                            <textarea class="form-control" name="message"></textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-btn">
                            <button type="submit" id="submit" class="btn color-bg">Book Now</button>
                        </div>
                    </div>
                    <div id="msg" style="display: none;"></div>
                </div>
            </form>
        ';

        $book_sidebar_vehicle .= '
            <div class="sidebar-booking">
                <h4 class="mb-2 fs-6"><strong>Booking Detail</strong></h4>
                <table>
                    <tr>
                        <td>Date</td>
                        <td class="text-right">' . $date . '</td>
                    </tr>
                    <tr>
                        <td>Total Pax</td>
                        <td class="text-right">' . $pax . '</td>
                    </tr>
                </table>
            </div>
            <div class="sidebar-payment">
                <h4 class="mb-2 fs-6"><strong>Payment</strong></h4>
                <table>
                ';

        foreach ($vehicles as $k => $v) {
            $vehicle = Vehicle::find_by_id($k);
            if (!empty($vehicle)) {
                $book_sidebar_vehicle .= '
                    <tr>
                        <td>' . $vehicle->title . '</td>
                        <td class="text-center">x ' . $v['quantity'] . '</td>
                        <td class="text-right">$ ' . $v['vehicle_price'] . '</td>
                    </tr>
                ';
            }
        }

        $book_sidebar_vehicle .= '
                    <tr>
                        <td class="weight-600" colspan="2">Amount</td>
                        <td class="weight-600 text-right">$ ' . $total . '</td>
                    </tr>
                </table>
            </div>
            <div class="empty-div"></div>
        ';
    }
}
$jVars['module:book:form-vehicle'] = $book_form_vehicle;
$jVars['module:book:sidebar-vehicle'] = $book_sidebar_vehicle;



$booking_undergallery = '  
<div class="banner-form form-style-1 form-style-3">
            <div class="container">
                <div class="row">
                <form id="hotelsearchform" action="result.php" target="_blank" class="form1 clearfix" autocomplete="on">
                <input type="hidden" name="hotelid">
                <input type="hidden" name="hotelslug">
                <input type="hidden" name="hotel_code">
                    <div class="col-sm-12 mx-auto">
                        <div class="form-content text-center row rounded-3">
                            <div class="col-lg-5 d-flex flex-column justify-content-center">
                                <div class="">
                                    <div class="form-group">
                                        <div class="date-range-inner-wrapper">
                                            <img src="'.BASE_URL.'template/nepalhotel/images/icon/search.svg" alt="">
                                            <input type="search" id="searchkey" name="searchkey" class="ps-5" placeholder="keyword search">
        
                                        </div>
                                    </div>
                                </div>
                            </div>
        
                            <div class="col-lg-5">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="position-relative">
                                            <div class="form-group">
                                                <div class="date-range-inner-wrapper">
                                                    <label for="date-range2" class="w-100 d-flex ">
                                                        <div>Check In</div> / <div>Check Out</div>
                                                    </label>
                                                    <img src="'.BASE_URL.'template/nepalhotel/images/icon/calendar.svg" alt="">

                                                    <input id="date-range2" name="date-range2" class="ps-5 pe-0 pt-4 form-control" value="Check In">
                                                   
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                   
        
                                    <div class="col-lg-3 d-none">
                                        <div class="">
                                            <div class="form-group form-icon ocpy">
                                                <label>Ocupancy</label>
                                                <select class="px-0 border-0 pb-1">
                                                    <option value="1">01</option>
                                                    <option value="2">02</option>
                                                    <option value="3">03</option>
                                                    <option value="4">04</option>
                                                    <option value="5">05</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
        
                            <div class="col-lg-2 d-flex align-items-center">
                                
                                <div class="form-btn ">
                                <button id="btn-search" type="submit"><a class="btn btn-primary w-100 px-4">Search</a></button>
                                   
                                </div>
                            </div>

                           
                        </div>
                    </div>

                 </form>  
                </div>
            </div>
        </div>



';


$jVars['module:booking_undergallery'] = $booking_undergallery;
?>