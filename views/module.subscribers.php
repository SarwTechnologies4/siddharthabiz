<?php
// subscribe

$resub = '';

$resub .= '<h2>NEWSLETTER</h2>
<p>Sign up for our mailing list to get latest updates and offers.</p>
<div class="icon-check">
	<form class="form_subscribe" action="" role="form" id="form_subscribe" method="post">	
	    <input type="text" name="email_address" id="email_address" class="input-text" placeholder="your email" />
	    <button class="btn" type="submit" title="Subscribe" id="btn-submit">Subscribe</button>
	</form>
</div>';

$jVars["module:subscribers"] = $resub;

// nationality fetch start
$nationality_select_options_html = '';
// $nationality_country_data = Countries::find_having_nationalities();
// foreach ($nationality_country_data as $country) {
//     $nationality_select_options_html .= <<<EOD
//         <option value="{$country['id']}">{$country['nationality']}</option>
//     EOD;
// }

function get_nationality_select_html($role) {
    global $nationality_select_options_html;
    return '<select class="form-control" name="' . $role . '_nationality"><option value="">Select a nationality</option>' .
        $nationality_select_options_html .
        '</select>';
}

$get_nationality_select_html = 'get_nationality_select_html';


// province fetch end

// province fetch start
// $province_select_options_html = '';
// $province_data = Province::find_all_by_active_status();
// foreach ($province_data as $province) {
//     $province_select_options_html .= <<<EOD
//         <option value="{$province->id}">{$province->name}</option>
//     EOD;
// }

function get_province_select_html($role) {
    global $province_select_options_html;
    return '<select class="form-control" name="' . $role . '_province_id"><option value="">Select a province</option>' .
        $province_select_options_html .
        '</select>';
}

$get_province_select_html = 'get_province_select_html';

// province fetch end

// // district fetch start
// $district_select_options_html = '';
// $district_data = District::find_all_by_active_status();
// foreach ($district_data as $district) {
//     $district_select_options_html .= <<<EOD
//         <option value="{$district->id}">{$district->name}</option>
//     EOD;
// }

function get_district_select_html($role) {
    global $district_select_options_html;
    /* add class chosen-select for multi-select; but validation not work  */
    return '<select class="form-control" name="' . $role . '_district_id"><option value="">Select a district</option>' .
        $district_select_options_html .
        '</select>';
}

$get_district_select_html = 'get_district_select_html';

// district fetch end

// $todayDate = date('Y-m-d');
$minValidDate = date('Y-m-d', strtotime('-18 year'));

//google social login start 

$NOT_REGISTERED = 'not_registered';
$NOT_VERIFIED = 'not_verified';
$modalDisplay = 'none';
$loginTabDisplay = 'current';
$registerTabDisplay = '';
$loginSectionDisplay = 'block';
$registerSectionDisplay = 'none';
$registrationUserDetailsSectionDisplay = 'block';
$otpVerificationSectionDisplay = 'none';
$defaultEmail = '';
$defaultName = '';
$otpNotificationMsg = 'We have send you an SMS containing the OTP. Please enter it here for verification purposes.';
$registerFormId = 'main-register-form2';

$current_url = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
$current_url = $current_url . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
if(isset($_GET['code'])){ 
    if(explode("?", $current_url)[0] === BASE_URL) {
        $google_client->authenticate($_GET['code']); 
    }
} 

if(isset($_SESSION[$NOT_VERIFIED]) && $_SESSION[$NOT_VERIFIED]) 
    print_r("Your account has not been verified !");
    // echo '<script>alert("Your account has not been verified !")</script>';

if(isset($_SESSION['otp_unavailable']) && $_SESSION['otp_unavailable']){ 
    $otpNotificationMsg = 'OTP mailing service is currently unavailable. Please contact administrator (database).';
} 

if(isset($_SESSION['google_details'])){ 
    $modalDisplay = 'block';
    $loginTabDisplay = '';
    $registerTabDisplay = 'current';
    $loginSectionDisplay = 'none';
    
    if(isset($_SESSION['google_details']['google_email'])) 
        $defaultEmail = $_SESSION['google_details']['google_email'];
    if(isset($_SESSION['google_details']['google_name'])) 
        $defaultName = $_SESSION['google_details']['google_name'];
    $registerFormId = 'google-register-form2';
    $registerSectionDisplay = 'block';

    if(isset($_SESSION['google_details']['otp_verified']) && !$_SESSION['google_details']['otp_verified']) {
        $registrationUserDetailsSectionDisplay = 'none';
        $otpVerificationSectionDisplay = 'block';
    }
} 

unset($_SESSION['otp_unavailable']);
unset($_SESSION[$NOT_VERIFIED]);
unset($_SESSION['google_details']);


function get_auth_block($role) {
    global $registerFormId;
    switch ($registerFormId) {
        case 'main-register-form2': 
            return '<div class="col-sm-12 mb-3">
                <label class=" fs-6 fw-bold">Password <span>*</span></label>
                <input name="password" type="password" class="mb-0" value="">
                </div>';
        case 'google-register-form2':
            return '';
        
        default:
            return '';
    }
}
$get_auth_block = 'get_auth_block';
 
if(isset($google_client) && $google_client->getAccessToken()){ 
    // Get user profile data from google 
    $gpUserProfile = $google_oauthV2->userinfo->get(); 
    if(!empty($gpUserProfile['email'])) {
        $user = User::find_by_mail($gpUserProfile['email']);
        if($user) {
            if(!$user->is_google_verified) {
                $db->begin();
                $otpGenerated = Otp::generate6DigitOTP();
                $otpExpiryDate = date('Y-m-d H:i:s', time() + 60 * 60);
                $user->otp = $otpGenerated;
                $user->otp_expiry_date = $otpExpiryDate;

                    if ($user->save()): $db->commit();

                    if((!defined('IS_SMS_ENABLED') || IS_SMS_ENABLED) && !empty($user->contact)) {
                        
                        $response = APIHandler::CallAPI('POST', 'https://api.sparrowsms.com/v2/sms', [
                            'token' => 'v2_wezxgaFF1kUWTTuBIuvPkOjssB6.YCrk',
                            'from' => 'PathilAlert',
                            'to' => $user->contact,
                            'text' => $otpGenerated . ' is your OTP.'
                        ]);
                        
                        switch ($response['response_code']) {
                            case 200:
                                echo json_encode(array("action" => "success", "message" => "Please verify OTP"));
        
                                break;
                            
                            default:
                                $otpNotificationMsg = $response['response'];
                                echo json_encode(array("action" => "error", "message" => 'Problem sending OTP please contact admin'));
                                break;
                        }
                    }
                    $fullname = $user->first_name;
                    // send otp in email here
                    $body = '
                        <div> Dear user, <br/><br/> Your OTP(One Time Password) has been generated. <br/>
                        Please use this OTP code for verification process : <label> ' . $otpGenerated . ' </label>
                        <br/>
                        Note: This OTP only lasts upto : ' . $otpExpiryDate .
                        'Thank you. <br/><br/>   
                    ';

                    $usermail = User::field_by_id('1', 'email');
                    $sitename = Config::getField('sitename',true);

                    $mail = longtailMailer();
                    $mail->SetFrom($usermail, $sitename);
                    $mail->AddReplyTo($usermail, $sitename);
                    $mail->AddAddress($user->email, $fullname);
                    $mail->Subject = "Account Registration From " . $sitename;
                    $mail->MsgHTML($body);

                    $mail->IsHTML(true); // send as HTML

                    if (! $mail->Send()) {
                        $session->set(
                            'otp_unavailable', true
                        );
                        $session->set(
                            'google_details', [
                                'google_email' => $gpUserProfile['email'],
                                'google_name' => $gpUserProfile['name'],
                                'otp_verified' => false
                            ]
                        );
                        /* $loginTabDisplay = "current";
                        $loginSectionDisplay = "block"; */
                        
                        /* $message = "Sorry! Could not send your request.";
                        echo json_encode(array("action" => "error", "message" => $message)); */
                    } else {
                        $session->set(
                            'google_details', [
                                'google_email' => $gpUserProfile['email'],
                                'google_name' => $gpUserProfile['name'],
                                'otp_verified' => false
                            ]
                        );
                        // echo json_encode(array("action" => "success", "message" => "Please verify OTP"));
                    }
                else: $db->rollback();
                endif;
                
            } else {
                if ($user->status == 0) {
                    $session->set($NOT_VERIFIED, true);
                } else {
                    $session->set('user_type', $user->user_type);
                    $session->set('email_logged', addslashes($gpUserProfile['email']));
                    $session->set('user_id', $user->id);
                    $remember = isset($_REQUEST['remember']) ? 1 : 0;
                    $message = "Welcome " . $user->first_name . "!";
                    header("Location: ". BASE_URL);
                }
            }
        } else {
            $session->set(
                'google_details', [
                    'google_email' => $gpUserProfile['email'],
                    'google_name' => $gpUserProfile['name']
                ]
            );
        }

        if($session->get('redirect_url_path')) {
            header("Location: ". $session->get('redirect_url_path'));
            die();
        }
        else {
            header("Location: ". BASE_URL);
            die();
        }
    }
}

// google social login end


/**
 *      Front User register and login forms
 */
$permissions = array('email'); // Optional permissions
$loginUrl = $helper->getLoginUrl(BASE_URL . 'fb.php', $permissions);
$login_register = '';
$desId = !empty($usersInfo->prop_id) ? $usersInfo->prop_id : '';
$property= Hotelapi::get_user_option($desId);

$login_register .= <<<EOD
    <div class="main-register-wrap modal mb-5 " style="display:{$modalDisplay}">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body p-5">
                    <div class="reg-overlay"></div>
                        <input name="google_email" type="hidden" class="mb-0" value={$defaultEmail}>
                        <div class="main-register-holder">
                            <div class="main-register">
                                <div class="">
                                    <div class="close-reg color-bg text-end"><i class="fa fa-times"></i></div>
                            
                                   
                                </div>
                                <!-- Nav tabs -->
<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
    <button class="nav-link active ps-0" id="home-tab" data-bs-toggle="tab" data-bs-target="#tablog" type="button" role="tab" aria-controls="home" aria-selected="true">Login</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#tabreg" type="button" role="tab" aria-controls="profile" aria-selected="false">Register</button>
  </li>
  
</ul>

<!-- Tab panes -->

                                <!--tabs -->
                               
                                <div class="tab-content">
                                                                            <!--tab -->
                                            <div class="tab-pane fade show active" id="tablog" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                                            <h3 class="fs-3">Sign In </h3>
                                        
                                            <div class="custom-form" id="login">
                                                <label id="msgLogin" class="alert alert-success py-2" style="display: none;"></label>
                                                <form method="post" name="registerform" id="main-login-form2" class="text-start">
                                                    <div class="row">
                                                        <div class="col-sm-12 mb-2 mt-3">
                                                            <label class="text-dark fs-6 fw-bold">Username or Email Address <span>*</span> </label>
                                                            <input name="email" class="mb-0 border-muted" type="text" value="">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-12 mb-2">
                                                            <label class="text-dark fs-6 fw-bold">Password <span>*</span> </label>
                                                            <input name="password" class="mb-0" type="password" value="">
                                                        </div>
                                                    </div>
                                                    <div class="d-flex justify-content-between pt-2 pb-4">
                                                        <div class="">
                                                            <button type="submit" id="submitLogin" class="btn btn-primary text-nowrap">Log In</button>
                                                        </div>
                                                        
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <div class="filter-tags mt-3 fs-6">
                                                        <input id="check-a" type="checkbox" name="remember">
                                                        <label for="check-a" ><strong>Remember me</strong></label>
                                                    </div>
                                                </form>
                                                <div class="lost_password  ">
                                                    <a href="#" class="switch-button" switch-target="#forgotPasswordFormDiv" switch-parent="#loginFormDiv">Lost Your Password?</a>
                                                </div>
                                            </div>
                                            <div class="custom-form" id="forgotPasswordFormDiv" style="display: none;">
                                                <form method="post" id="main-forgot-password-form2">
                                                    <label class="fs-6 fw-bold pt-3">Email Address <span>*</span> </label>
                                                    <input name="email" type="text" value="" class="mb-2">
                                                    <label id="msgForgot" class="alert alert-success" style="display: none;"></label>
                                                    <button type="submit" id="submitForgot" class="btn btn-primary">Recover</span></button>
                                                    <div class="clearfix"></div>
                                                </form>
                                                <div class="lost_password">
                                                    <a href="#" class="switch-button" switch-target="#loginFormDiv" switch-parent="#forgotPasswordFormDiv">Back to Login</a>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        
                                        <!--tab end -->
                                        <!--tab -->
                                        <div class="tab-pane" id="tabreg" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                                        <div  class="tab-content login" >
                                        <h3 class="fs-3">Sign Up </h3>
                                        <div class="custom-form">
                                            <form method="post" name="registerform" class="main-register-form text-start" id="main-register-form2" style="display: {$registrationUserDetailsSectionDisplay}">
                                                <div class="row">
                                                    
                                                    <div class="register-fields-section customer-register-fields">
                                                        <div class="row">
                                                            <div class="col-sm-12 mb-3 pt-3">
                                                                <label class="text-dark fs-6 fw-bold">First Name <span>*</span> </label>
                                                                <input name="first_name" type="text" class="mb-0" value=''>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-12 mb-3 pt-3">
                                                                <label class="text-dark fs-6 fw-bold">Last Name <span>*</span> </label>
                                                                <input name="last_name" type="text" class="mb-0" value=''>
                                                            </div>
                                                        </div>
                                                     
                                                        <div class="row">
                                                            <div class="col-sm-12 mb-3">
                                                                <label class="text-dark fs-6 fw-bold">Email Address <span>*</span></label>
                                                                <input name="email" type="text" class="mb-0" value=''>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-12 mb-3">
                                                                <label class="text-dark fs-6 fw-bold">Contact Number <span>*</span></label>
                                                                <input name="contact" type="text" class="mb-0" value="">
                                                                </div>
                                                        </div>
                                                        <div class="form-row ">
                        <div class="form-label col-md-4">
                        <label class="text-dark fs-6 fw-bold">Property <span>*</span></label>
                        </div>
                        <div class="form-input col-md-8">
                            <select name="prop_id" id="prop_id" class="form-control validate[required]" >
                                <option value="">Choose Property ID</option>
                                
                                '.$property.'
                            </select>
                        </div></div>
                                                        <div class="row">
                                                        <div class="col-sm-12 mb-3">
                                                            <label class="text-dark fs-6 fw-bold">Address <span>*</span></label>
                                                            <input name="address" type="text" class="mb-0" value="">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                        <div class="col-sm-12 mb-3">
                                                            <label class="text-dark fs-6 fw-bold">DOB <span>*</span></label>
                                                            <input name="dob" type="date" class="mb-0" format="YYYY-MM-DD" value="">
                                                            </div>
                                                        </div>
                                                      
                                                        <input name="hotels_no" type="hidden" class="mb-0" value="1">
                                                                <input name="status" type="hidden" class="mb-0" value="1">
                                                            
                                                        <div class="form-row">
                                                        <div class="col-sm-12 mb-3">
                                                                <label class="text-dark fs-6 fw-bold">Gender</label>
                                                                <div class="form-checkbox-radio col-md-9">
                                                                    <input type="radio" class="custom-radio" name="gender" id="check1"
                                                                        value="1" >
                                                                    <label for="">Male</label>
                                                                    <input type="radio" class="custom-radio" name="gender" id="check0"
                                                                        value="0" >
                                                                    <label for="">Female</label>
                                                                </div>
                                                        </div>

                                                        <div class="col-sm-12 mb-3">
                                                                <label class="text-dark fs-6 fw-bold">Physical Mileage Card</label>
                                                                <div class="form-checkbox-radio col-md-9">
                                                                    <input type="radio" class="custom-radio" name="physicalcard" id="check1"
                                                                        value="1" >
                                                                    <label for="">Yes</label>
                                                                    <input type="radio" class="custom-radio" name="physicalcard" id="check0"
                                                                        value="0" >
                                                                    <label for="">No</label>
                                                                </div>
                                                        </div>
                                                        

                                                        <div class="row">
                                                            <div class="col-sm-12 mb-3 ">
                                                                <label class="text-dark fs-6 fw-bold">User Name <span>*</span> </label>
                                                                <input name="username" type="text" class="mb-0" value="">
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            {$get_auth_block('customer')}
                                                        </div>
                                                    </div>




                                                
                                                <div class="row">
                                                    <div class="col-sm-12 pb-4">
                                                        <label id="msgRegister" class="alert alert-success" style="display: none;"></label>
                                                        <button type="submit" id="submitRegister" class="btn btn-primary">Register</button>
                                                    </div>
                                                </div>
                                            
                                            </form>

                                            
                                        </div>
                                    </div>
                                           
                                    </div>
                                </div>
EOD;

$jVars['module:subscribers:login-register-form'] = $login_register;


/**
 *       Reset Password Form
 */
$resetpassword = '';

if (defined('RESET_PASSWORD_PAGE')) {
    $token = $_REQUEST['access_code'];
    $user = User::get_uid_by_accessToken($token);

    if (!empty($user)) {
        $resetpassword .= '
            <form id="resetPasswordForm">
                <input type="hidden" name="id" value="' . $user->id . '">
                <input type="hidden" name="token" value="' . $token . '">
                
                <div class="list-single-main-item-title fl-wrap">
                    <h3>Reset your Password</h3>
                </div>
                <div class="row py-4">
                    <div class="col-sm-6">
                        <label class="fs-6 fw-bold">New Password </label>
                        <input type="password" placeholder="****" name="password" id="password" value=""/>
                    </div>
                    <div class="col-sm-6">
                        <label class="fs-6 fw-bold">Confirm New Password</label>
                        <input type="password" placeholder="****" name="confirm_password" id="confirm_password" value=""/>
                    </div>
                </div>
                <div class="alert alert-success" id="msg" style="display: none;"></div>
                <span class="fw-separator"></span>
                <button type="submit" id="submit" class="float-end action-button btn no-shdow-btn px-5 btn-primary">
                    Submit
                </button>
            </form>
        ';
    } else {
        redirect_to(BASE_URL);
    }
}

$jVars['module:subscribers:password-resetform'] = $resetpassword;


/**
 *      Login button / Welcome
 */
$login_welcome = $vehicle_cart = '';

$userId = $session->get("user_id");
if (!empty($userId)) {
    $user = User::find_by_id($userId);
    if (!empty($user)) {
        $img = BASE_URL . 'template/nepalhotel/images/avatar/user.svg';
        if (!empty($user->image)) {
            $file_path = SITE_ROOT . 'images/user/' . $user->image;
            if (file_exists($file_path)) {
                $img = IMAGE_PATH . 'user/' . $user->image;
            }
        }
        $login_welcome = '
        <div>
            <div class="d-flex">
                <div class="flex-shrink-0"><i class="bi bi-person-circle fs-5 mt-5 ps-3 pt-5 "></i>';
        //$login_welcome .=(!empty($img))?'<img src="' . $img . '" width="15px" alt="Profile">':'';
        $login_welcome .= '</div>
                <div class="flex-grow-1 ms-1">
                <h5 class="p-2">Hi ' . ucwords($user->first_name) . ' !</h5>
                
            </div>
        </div>
        <ul class="navbar-nav justify-content-end flex-grow-1 px-5 py-3 border-bottom ">
        <li class="nav-item"><a class="nav-link log-out-button d-none d-sm-inline-block btn btn-outline-primary py-0 px-2 pe-2 " href="' . BASE_URL . 'logout">Log Out</a></li>
            <li class="nav-item"><a class="nav-link " href="' . BASE_URL . 'dashboard">My Account</a></li>
            <li class="nav-item"><a class="nav-link " href="' . BASE_URL . 'dashboard/profile">My Profile</a></li>
        </ul>

        ';

        $crtot = isset($_SESSION['cart_detail'][$userId]) ? count($_SESSION['cart_detail'][$userId]) : 0;

        if (defined('BOOK_VEHICLE_PAGE') or defined('VEHICLE_SEARCH_PAGE') or defined('VEHICLESEARCH_PAGE')) {

            $vehicle_cart .= '
                <div class=" d-inline-block position-relative border-end ps-2 pe-3 ">
                    <div class="wishlist-link cart-view"><i class="fal fa-shopping-cart"></i><span class="wl_counter">' . $crtot . '</span></div>
            
                    <!-- wishlist-wrap-->
                    <div class="wishlist-wrap scrollbar-inner novis_wishlist">
                        <div class="box-widget-content">
                            <div class="widget-posts fl-wrap cart-list">
                                <!--
                                <ul>
                                    <li class="clearfix">
                                        <a href="javascript:;" class="position-absolute end-0 zindex-2"><i class="fa fa-times"></i></a>  
                                        <a href="#" class="widget-posts-img">
                                            <img src="http://localhost/pathil/template/nepalhotel/images/gal/1.jpg" class="img-fluid" alt="">
                                        </a>
                                        <div class="widget-posts-descr">
                                            <a href="#" title="">Park Central</a>
                                            <div class="geodir-category-location fl-wrap">
                                                <a href="#"><i class="fas fa-map-marker-alt"></i> Kathmandu > Pokhara</a>
                                            </div>
                                            <div class="rooms-price">
                                                <span><i class="fas fa-minus"></i></span>
                                                <span class="pprice">x 1</span>
                                                <span><i class="fas fa-plus"></i></spana> 
                                                &nbsp;&nbsp;&nbsp;&nbsp; $ 80<strong>/ per ride</strong>
                                            </div>
                                        </div>
                                    </li>
                                    <a href="#" class="btn btn-sm checkout book-vehicle">Check Out</a>
                                </ul>
                                -->
                            </div>
                        </div>
                    </div>
                    <!-- wishlist-wrap end-->
                </div>
            ';
        }


    }

} else {
    $login_welcome .= '

    <div>
            <div class="d-flex">
                <div class="flex-shrink-0"><i class="bi bi-person-circle  fs-5 py-4 ps-3"></i></div>
                <div class="flex-grow-1 ms-3">
                <h5 class="float-start pb-1 pe-5">Welcome Guest</h5><br>
                <a href="javascript:void(0)" class="modal-open float-start  "
                 data-target="#login" data-bs-dismiss="offcanvas">
               </i> <span class="d-none d-sm-inline-block btn btn-outline-primary py-0 px-2 pe-2"><small><strong >Log in</strong></small></span></a>
                </div>
            </div>
        </div>


';
}


$jVars['module:subscribers:login-welcome'] = $login_welcome;
$jVars['module:vehicle:cart-info'] = $vehicle_cart;
