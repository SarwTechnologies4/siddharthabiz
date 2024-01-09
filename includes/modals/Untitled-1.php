<?php

$userId = $session->get("user_id");

$sidebar = $dmenu = '';
if (!empty($userId)) {
    $user = User::find_by_id($userId);

    $sidebar .= '
        <div class="dasboard-sidebar">
            <div class="dasboard-sidebar-content fl-wrap">
                <div class="dasboard-avatar">
                ';
    $img = BASE_URL . 'template/nepalhotel/images/avatar/avatar-bg.png';
    if (!empty($user->image)) {
        $file_path = SITE_ROOT . 'images/user/' . $user->image;
        if (file_exists($file_path)) {
            $img = IMAGE_PATH . 'user/' . $user->image;
        }
    }
    $sidebar .= '
                <img src="' . $img . '" alt="Profile Picture">
                </div>
                <div class="dasboard-sidebar-item fl-wrap">
                    <h3>
                        <span>Hi </span>
                        
                    </h3>
                </div>
    
                <div class="user-stats fl-wrap">
                    <ul>
                    ';

    $sql = "SELECT * FROM tbl_apibooking  WHERE checkin_date < CURDATE() AND user_id=$userId GROUP BY id ORDER BY checkin_date DESC";
    $query = $db->query($sql);
    $totno_past = $db->num_rows($query);

    $sql = "SELECT * FROM tbl_apibooking  WHERE checkin_date >= CURDATE() AND user_id=$userId GROUP BY id ORDER BY checkin_date DESC";
    $query = $db->query($sql);
    $totno_coming = $db->num_rows($query);

    $sidebar .= '
                        <li>
                            Upcoming
                            <span>' . $totno_coming . '</span>
                        </li>
                        <li>
                            Past
                            <span>' . $totno_past . '</span>
                        </li>
                        <li>
                            Reviews
                            <span>0</span>
                        </li>
                    </ul>
                </div>
                <a href="' . BASE_URL . 'logout" class="log-out-btn color-bg">Log Out <i class="far fa-sign-out"></i></a>
            </div>
        </div>
    ';
}

$jVars['module:user:dashboard-sidebar'] = $sidebar;


/**
 *      Dashboard Profile Edit page
 */
$profile_page = '';
if (defined('DASHBOARD_EDIT_PROFILE_PAGE')) {
    if (!empty($userId)) {
        $user = User::find_by_id($userId);
        // $sql = "SELECT * FROM tbl_user_info WHERE person_id=$userId LIMIT 1";
        $user_info = $db->fetch_object($db->query($sql));

        if (!empty($user)) {
            // $dmenu .= '
            //     <div class="dasboard-menu">
            //         <div class="dasboard-menu-btn color3-bg">Dashboard Menu <i class="fal fa-bars"></i></div>
            //         <ul class="dasboard-menu-wrap">
            //             <li><a href="' . BASE_URL . 'dashboard"> <i class="far fa-calendar-check"></i> Upcoming Bookings <!--<span>2</span>--></a></li>
            //             <li><a href="' . BASE_URL . 'dashboard/pastbooking"> <i class="far fa-calendar-check"></i> Past Bookings </a></li>
            //             <li>
            //                 <a href="' . BASE_URL . 'dashboard/profile" class="user-profile-act"><i class="far fa-user"></i>Profile</a>
            //             </li>
            //         </ul>
            //     </div>
            // ';

            $email_msg = (empty($user->email)) ? '<span class="alert alert-danger">To continue booking with us, Please fill your profile data !!</span>' : '';
            $profile_page .= '
                <div class="dashboard-content fl-wrap">
                    <div class="box-widget-item-header">
                        <h3>Your Profile</h3>
                    </div>
                    ' . $email_msg . '
                    
                    <form id="editProfileForm">
                        <input type="hidden" name="idValue" value="' . $user->id . '">
                        <!-- profile-edit-container-->
                        <div class="profile-edit-container">
                            <div class="custom-form">
                            <div class="row">
                            <div class="col-md-6">
                                <label> &nbsp;<i class="far fa-user"></i></label>
                                <input name="name" type="text" placeholder="Full Name" value="' . (($user->first_name) ? $user->first_name : '') . '">
                                </div><div class="col-md-6">
                                <label>&nbsp;<i class="far fa-envelope"></i> </label>
                                <input name="email" type="email" placeholder="Email Address" value="' . (($user->email) ? $user->email : '') . '">
                                </div><div class="col-md-6">
                                <label>&nbsp;<i class="far fa-phone"></i> </label>
                                <input name="phone" type="text" placeholder="Contact Number" value="' . (($user->contact) ? $user->contact : '') . '">
                                </div><div class="col-md-6">
                                <label> &nbsp;<i class="far fa-globe"></i> </label>
                                <input name="website" type="text" placeholder="Website" value="' . ((!empty($user_info->website)) ? $user_info->website : '') . '">

                                </div>
                                <div class="col-md-12">
                                <label> &nbsp;<i class="fas fa-map-marker"></i> </label>
                                <input name="address" type="text" placeholder="Address" value="' . ((!empty($user_info->home_town)) ? $user_info->home_town : '') . '">
                                </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-9">
                                        <label class="mt-2"> Notes</label>
                                        <textarea name="description" cols="40" rows="3" placeholder="About Me">' . ((!empty($user_info->short_desc)) ? $user_info->short_desc : '') . '</textarea>
                                    </div>
                                    <div class="col-sm-3">
                                        <label class="mt-2">Change Avatar</label>
                                        <div class="add-list-media-wrap">
                                            <!--<form class="fuzone">
                                                <div class="fu-text">
                                                    <span><i class="far fa-cloud-upload-alt"></i> Click here or drop files to upload</span>
                                                    <div class="photoUpload-files fl-wrap"></div>
                                                </div>
                                                <input type="file" class="upload">
                                            </form>-->
                                            <input type="file" id="img" name="img" accept="image/*">
                                            
                                            


                                            
                                            ';
            if (!empty($user->image)) {
                $profile_page .= '
                    <div class="" id="removeSavedimg1">
                        <div class="infobox info-bg">
                            <div class="button-group" data-toggle="buttons">
                                <a class="btn small float-right" href="javascript:void(0);" onclick="deleteSavedimage(1);">
                                    <i class="glyph-icon icon-trash-o"></i>
                                </a>
                            </div>
                            <img src="' . IMAGE_PATH . 'user/thumbnails/' . $user->image . '" style="width:100%"/>
                            <input type="hidden" name="imageArrayname" value="' . $user->image . '" class=""/>
                        </div>
                    </div>
                ';
            }
            $profile_page .= '
                                        <div id="preview_Image"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
        
                        <div class="box-widget-item-header mat-top ">
                            <h3>Your Socials</h3>
                        </div>
                        <!-- profile-edit-container-->
                        <div class="profile-edit-container">
                            <div class="custom-form">
                                <label>Facebook <i class="fab fa-facebook"></i></label>
                                <input name="facebook" type="text" placeholder="https://www.facebook.com/" value="' . ((!empty($user_info->facebook_link)) ? $user_info->facebook_link : '') . '">
                                <label class="mt-2">Twitter<i class="fab fa-twitter"></i> </label>
                                <input name="twitter" type="text" placeholder="https://twitter.com/" value="' . ((!empty($user_info->twitter_link)) ? $user_info->twitter_link : '') . '">
                                <label class="mt-2">Vkontakte<i class="fab fa-vk"></i> </label>
                                <input name="vk" type="text" placeholder="https://vk.com" value="' . ((!empty($user_info->google_plus)) ? $user_info->google_plus : '') . '">
                                <label class="mt-2"> Instagram <i class="fab fa-instagram"></i> </label>
                                <input name="instagram" type="text" placeholder="https://www.instagram.com/" value="' . ((!empty($user_info->linkedin)) ? $user_info->linkedin : '') . '">
                                <button class="btn    color2-bg  float-btn " id="submitProfile" type="submit">Save Changes<i class="fal fa-save"></i></button>
                            </div>
                        </div>
                        
                        <label class="alert alert-success" id="msgProfile" style="display: none;"></label>
                        
                        <!-- profile-edit-container end-->
                    </form>
                    
                </div>
            ';
        } else {
            redirect_to(BASE_URL);
        }
    } else {
        redirect_to(BASE_URL);
    }
}
$jVars['module:user:dashboard-profile-edit'] = $profile_page;


/**
 *      Dashboard Past Booking Page
 */
$past_booking = '';
        $user = User::find_by_id($userId);
            $dmenu .= '
            <section class="rooms">
            <div class="container-xxl px-md-5">
                <div class="row">
                    <div class="col-sm-3">
                        <h4>Member Details</h4>
        
                        <table class="table table-borderless">
                            <tr>
                                <td>Code</td>
                                <td>0122323423</td>
                            </tr>
                            <tr>
                                <td>Full Name</td>
                                <td>Ram B. Thapa</td>
                            </tr>
                            <tr>
                                <td>Address</td>
                                <td>Thamel, Kathmandu</td>
                            </tr>
                            <tr>
                                <td>Gender</td>
                                <td>Male</td>
                            </tr>
                            <tr>
                                <td>DOB</td>
                                <td>20 Aug, 1990</td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>Active</td>
                            </tr>
                            <tr>
                                <td>Member of</td>
                                <td>Hotel Siddhartha Nepalgunj</td>
                            </tr>
                            <tr>
                                <td>Level</td>
                                <td>Gold</td>
                            </tr>
                        </table>
                        
                    </div>
                    <div class="col-sm-8 offset-md-1">
                        <div class="rewards mb-4">
                            <h4>Reward Points</h4>
                            <div class="card">
                                <div class="card-body">
                                    
                                    <table class="table table-hover">
                                        <tr>
                                            <th width="10%">Date</th>
                                            <th width="40%">Particular</th>
                                            <th width="5%">Points</th>
                                            <th width="5%">Available Points</th>
                                            <th width="5%">Lifetime Points</th>
                                            <th width="35%">Counter</th>
                                        </tr>
                                        <tr>
                                            <td style="white-space: nowrap;">20 Jul, 23</td>
                                            <td>Deduction</td>
                                            <td>20</td>
                                            <td>230</td>
                                            <td>250</td>
                                            <td>Hotel Siddhartha, Nepalgunj</td>
                                        </tr><tr>
                                            <td>20 Jul, 23</td>
                                            <td>Deduction</td>
                                            <td>20</td>
                                            <td>230</td>
                                            <td>250</td>
                                            <td>Hotel Siddhartha, Nepalgunj</td>
                                        </tr><tr>
                                            <td>20 Jul, 23</td>
                                            <td>Deduction</td>
                                            <td>20</td>
                                            <td>230</td>
                                            <td>250</td>
                                            <td>Hotel Siddhartha, Nepalgunj</td>
                                        </tr>
                                    </table>
                                   
                                </div>
                            </div>
                            
                        </div>
                        <div class="prize">
                            <h4>Prize</h4>
                            <div class="card">
                                <div class="card-body">
                                    
                                    <table class="table table-hover">
                                        <tr>
                                            <th>Particular</th>
                                            <th>Description</th>
                                            <th width="10%">Points</th>
                                            
                                        </tr>
                                        <tr>
                                            <td>Buy 2 Get 1</td>
                                            <td>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Consequatur, cumque illum laboriosam aliquid totam a ullam dolorem minus quis. Esse, vitae optio qui suscipit deleniti officia temporibus error dicta alias!</td>
                                            <td>20</td>
                                            
                                        </tr><tr>
                                            <td>Buy 2 Get 1</td>
                                            <td>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Consequatur, cumque illum laboriosam aliquid totam a ullam dolorem minus quis. Esse, vitae optio qui suscipit deleniti officia temporibus error dicta alias!</td>
                                            <td>20</td>
                                            
                                        </tr><tr>
                                            <td>Buy 2 Get 1</td>
                                            <td>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Consequatur, cumque illum laboriosam aliquid totam a ullam dolorem minus quis. Esse, vitae optio qui suscipit deleniti officia temporibus error dicta alias!</td>
                                            <td>20</td>
                                            
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
        
                    </div>
                </div>
            
            </div>
          </section>
            ';
       
        
    
    

$jVars['module:user:dashboard-past-booking'] = $past_booking;

$jVars['module:user:dashboard-menu'] = $dmenu;

/**
 *      Dashboard main page
 */
$upcoming_booking = '';
if (defined('DASHBOARD_PAGE')) {
    if (!empty($userId)) {
        $user = User::find_by_id($userId);
        if (!empty($user)) {
            // $dmenu .= '
            //     <div class="dasboard-menu">
            //         <div class="dasboard-menu-btn color3-bg">Dashboard Menu <i class="fal fa-bars"></i></div>
            //         <ul class="dasboard-menu-wrap">
            //             <li><a href="' . BASE_URL . 'dashboard" class="user-profile-act"> <i class="far fa-calendar-check"></i> Upcoming Bookings <!--<span>2</span>--></a></li>
            //             <li><a href="' . BASE_URL . 'dashboard/pastbooking" > <i class="far fa-calendar-check"></i> Past Bookings</a></li>
            //             <li><a href="' . BASE_URL . 'dashboard/profile"><i class="far fa-user"></i>Profile</a></li>
            //         </ul>
            //     </div>
            // ';

            $today = date('Y-m-d');
            $sql = "SELECT * FROM tbl_apibooking  WHERE checkin_date >= CURDATE() AND user_id=$userId GROUP BY id ORDER BY checkin_date DESC";
            $query = $db->query($sql);
            $totno = $db->num_rows($query);

            $upcoming_booking .= '
                <div class="dashboard-content fl-wrap">
                    <div class="dashboard-list-box fl-wrap" data-jplist-group="group1">
                        <div class="dashboard-header fl-wrap">
                            <h3>Bookings</h3>
                        </div>
            ';
            if ($totno > 0) {
                while ($res = $db->fetch_object($query)) {
                    $img = BASE_URL . 'template/nepalhotel/images/avatar/1.jpg';
                    if (!empty($user->image)) {
                        $file_path = SITE_ROOT . 'images/user/' . $user->image;
                        if (file_exists($file_path)) {
                            $img = IMAGE_PATH . 'user/' . $user->image;
                        }
                    }
                    $hotel = Hotelapi::find_by_code($res->hotel_code);
                    $rooms = Bookingchild::get_bookchild_by($hotel->id);
                    $persons = 0;
                    foreach ($rooms as $room) {
                        $persons += $room->adult;
                        $persons += $room->child;
                    }
                    $payment_status = '<strong class="done-paid">Un-Paid</strong>';
                    if ($res->pay_type == 'nabilBank' and $res->status == 'approved' and $res->has_payment == 1) {
                        $payment_status = '<strong class="done-paid">Paid</strong> using Nabil Bank';
                    }
                    if ($res->pay_type == 'Himalayan Bank' and $res->status == 'approved' and $res->has_payment == 1) {
                        $payment_status = '<strong class="done-paid">Paid</strong> using Himalayan Bank';
                    }
                    if ($res->pay_type == 'braintree' and $res->status == 'approved' and $res->has_payment == 1) {
                        $payment_status = '<strong class="done-paid">Paid</strong> using Brain Tree';
                    }
                    if ($res->pay_type == 'stripe' and $res->status == 'approved' and $res->has_payment == 1) {
                        $payment_status = '<strong class="done-paid">Paid</strong> using Stripe';
                    }
                    $upcoming_booking .= '
                        <!-- dashboard-list end-->
                        <div class="dashboard-list" data-jplist-item>
                            <div class="dashboard-message">
                                <!--<a href="#" class="new-dashboard-item">Write your review</a>-->
                                <div class="dashboard-message-avatar">
                                    <img src="' . $img . '" alt="">
                                </div>
                                <div class="dashboard-message-text">
                                    <h4>' . $res->first_name . ' ' . $res->last_name . ' - <span>' . date('d F Y', strtotime($res->booking_date)) . '</span></h4>
                                    <div class="booking-details fl-wrap">
                                        <span class="booking-title">Listing Item :</span> :
                                        <span class="booking-text"><a href="' . BASE_URL . 'hotel/' . $hotel->slug . '" target="_blank">' . $hotel->title . '</a></span>
                                    </div>
                                    <div class="booking-details fl-wrap">
                                        <span class="booking-title">Persons :</span>
                                        <span class="booking-text">' . $persons . ' Peoples</span>
                                    </div>
                                    <div class="booking-details fl-wrap">
                                        <span class="booking-title">Booking Date :</span>
                                        <span class="booking-text">' . date('d.m.Y', strtotime($res->checkin_date)) . ' - ' . date('d.m.Y', strtotime($res->checkout_date)) . '</span>
                                    </div>
                                    <div class="booking-details fl-wrap">
                                        <span class="booking-title">Mail :</span>
                                        <span class="booking-text"><a href="#" target="_top">' . $res->email . '</a></span>
                                    </div>
                                    <div class="booking-details fl-wrap">
                                        <span class="booking-title">Phone :</span>
                                        <span class="booking-text"><a href="tel:' . $res->contact_no . '" target="_top">' . $res->contact_no . '</a></span>
                                    </div>
                                    <div class="booking-details fl-wrap">
                                        <span class="booking-title">Payment State :</span>
                                        <span class="booking-text"> ' . $payment_status . '</span>
                                    </div>
                                    <!--
                                    <span class="fw-separator"></span>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc posuere convallis purus non cursus. Cras
                                        metus neque, gravida sodales massa ut. </p>
                                    -->
                                </div>
                            </div>
                        </div>
                        <!-- dashboard-list end-->
                    ';
                }
            } else {
                $upcoming_booking .= '
                    <div class="dashboard-list" data-jplist-item>
                        <div class="dashboard-message">
                            <h3>No Bookings Found</h3>
                        </div>
                    </div>
                ';
            }
            $upcoming_booking .= '
                    </div>
                    <!-- pagination-->
                    <div
                        data-jplist-control="pagination"
                        data-group="group1"
                        data-items-per-page="10"
                        data-current-page="0"
                        data-disabled-class="disabled"
                        data-selected-class="active">

                        <!-- first and previous buttons -->
                        <ul class="pagination d-inline-flex">
                            <li class="page-item" data-type="prev">
                                <a class="page-link prevposts-link" href="#"><i class="fa fa-caret-left"></i></a>
                            </li>
                        </ul>

                        <!-- pages buttons -->
                        <ul class="pagination d-inline-flex" data-type="pages">
                            <li class="page-item" data-type="page"><a class="page-link" href="#">{pageNumber}</a></li>
                        </ul>

                        <!-- next and last buttons -->
                        <ul class="pagination d-inline-flex">
                            <li class="page-item" data-type="next">
                                <a class="page-link nextposts-link" href="#"><i class="fa fa-caret-right"></i></a>
                            </li>
                        </ul>

                        <!-- items per page dropdown -->
                        <div class="dropdown d-inline-flex ml-3"
                             data-type="items-per-page-dd"
                             data-opened-class="show">
                        </div>
                        <br>
                        <!-- information labels -->
                        <!--<span data-type="info" class=" ml-3 p-2">Page {pageNumber} of {pagesNumber}</span>-->
                    </div>
                    <!--
                    <div class="pagination">
                        <a href="#" class="prevposts-link"><i class="fa fa-caret-left"></i></a>
                        <a href="#" class="current-page">1</a>
                        <a href="#">2</a>
                        <a href="#">3</a>
                        <a href="#">4</a>
                        <a href="#" class="nextposts-link"><i class="fa fa-caret-right"></i></a>
                    </div>
                    -->
                </div>
            ';
        } else {
            redirect_to(BASE_URL);
        }
    } else {
        redirect_to(BASE_URL);
    }
}
$jVars['module:user:dashboard-upcoming-booking'] = $upcoming_booking;


?>
