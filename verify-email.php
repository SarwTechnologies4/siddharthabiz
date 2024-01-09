<?php

define('HOMEPAGE', 0); // Track homepage.
define('VERIFY_EMAIL_PAGE', 1);// Track Login page.
define('JCMSTYPE', 0); // Track Current site language.

require_once("includes/initialize.php");

$currentTemplate	= Config::getCurrentTemplate('template');
$jVars 				= array();
$template 			= "template/{$currentTemplate}/verify-email.html";

require_once('views/modules.php');

$msg_success = '';

$token      = $_REQUEST['access_code'];
// $hotel_slug = $_REQUEST['hotel_slug'];

$user       = User::get_uid_by_accessToken($token);
if (!empty($user)) {
    $user->email_verified   = 1;
    $user->access_code = @randomKeys(10);
    if ($user->save()){
        $msg_success .= '
            <div class="text-center">
                <h2 style="font-size: 18px;">Your Email Address has been verified.</h2>
                <br />
                <p class="text-center">Account Details are provided below :</p>	
                <p class="text-center"<strong>Full Name</strong> : ' . $user->first_name . '</p>
                <p class="text-center"><strong>Username</strong> : ' . $user->username . '</p>
                <p class="text-center"><strong>E-mail Address</strong>: ' . $user->email . '</p>	
                <br />
                
            </div>
        ';
    } else {
        $msg_success .= '
        <div class="text-center">
            <h2 style="font-size: 18px;">We could not verify your email address!</h2>
            <br />
            <a href="'.BASE_URL.'home" class="btn color-bg">Home</a>
            
        </div>
    ';
    }
} else {
    $msg_success .= '
        <div class="text-center">
            <h2 style="font-size: 18px;">Your Email address has already been verified.</h2>
            <br />
            <a href="'.BASE_URL.'home" class="btn color-bg">Home</a>
            
        </div>
    ';
}

$jVars['module:success-msg'] = $msg_success;

template($template, $jVars, $currentTemplate);

?>