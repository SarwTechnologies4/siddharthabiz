<?php 
require_once("../includes/initialize.php");
ob_start();
$session_id = session_id(); 
$_SESSION['the_token']  = $session_id;
$api_baseurl      =  BASE_URL;
$api_baseurl_api  =  $api_baseurl.'nabilapi/';
$checkin   =  isset($_POST['api_checkin']) ? $_POST['api_checkin'] :'';
$checkout  =  isset($_POST['api_checkout']) ? $_POST['api_checkout'] :'';
$nofnight  =  getDaysDiff($checkin, $checkout);
$code  =  isset($_POST['hotel_code']) ? $_POST['hotel_code'] : '';
if(empty($code)){ die('Sorry Hotel Code is not provided!');}
$hotel_row    =  Hotelapi::find_by_code($code);
$hotel_id     =  $hotel_row->id;
foreach($_POST as $key=>$val){$$key=$val;} 
 	
$record                  =  new Bookingmaster();
$token_code              =  @randomKeys('7');
$record->user_id   	     =  $user_id;
$record->hotel_code   	 =  $code;
$record->booking_code    =  $token_code;
$record->checkin_date 	 =  $checkin;
$record->checkout_date   =  $checkout;
$record->nights 		 =  $nofnight;
$record->first_name 	 =  $api_firstname;
$record->last_name 	     =  $api_lastname;
$record->address 		 =  $api_address;
$record->city 			 =  $api_city;
$record->zipcode 		 =  $api_zipcode;
$record->country 		 =  $api_country;
$record->country_code 	 =  Countries::find_by_name($api_country);
$record->email      	 =  $api_email;
$record->contact_no 	 =  $api_contactno;
$record->flightname 	 =  $api_flightname;
$record->arrivaltime 	 =  $api_arrival_time;
$record->personal_request=  $api_personal_request;
$record->booking_date 	 =  registered();
$record->pay_type 		 =  $payment_method;
$record->has_payment 	 =  '0';

$record->currency    	 =  $api_currency;
$record->currency_symbol =  $api_currency_symbol;
$record->subtotal    	 =  $api_sub_total_all;
$record->grand_total 	 =  $api_grand_total;
$record->tax_amount 	 =  $api_tax;
$record->service_charge  =  $api_service_charge;
$record->status     	 =  'inquiry';
$record->save();
$master_id          =  $record->id;

if(isset($api_no_of_room) and sizeof($api_no_of_room)>0){
	foreach($api_no_of_room as $key_room=>$val_room){	

		foreach($api_room_label[$key_room] as $k=>$v) {

			$bookChild = new Bookingchild();
			$bookChild->master_id 	= $master_id;
			$bookChild->room_type 	= $key_room;
			$bookChild->no_of_room 	= $val_room;
			$bookChild->currency 	= $api_currency_symbol;
			$bookChild->room_label 	= $api_room_label[$key_room][$k];			
			$bookChild->adult 		= $api_adult[$key_room][$k];
			$bookChild->child 		= $api_child[$key_room][$k];
			$bookChild->extra_bed 	= $api_extra_bed[$key_room][$k];
			$bookChild->price 		= $api_room_price[$key_room][$k];
			$bookChild->save();

		}
	}
}

$row         =  Bookingmaster::find_by_token($token_code);
$fullname    =  $row->first_name." ".$row->last_name;
$email       =  $row->email;
$master_id   =  $row->id;
$childs      =  Bookingchild::get_info_by($master_id); 
$send_email  =  0;
if($row->pay_type=='pay_later'){
	$send_email  =  1;
    require("inquiry_email.php");
    $array  =  array('success'=>true,'message'=>'Your booking has been successfully made.');
	die(json_encode($array));
}else{
	ob_start();
	require("payment_form.php");
	$payment_content  =  ob_get_clean();
	$array  =  array('payment_form'=>true,'message'=>'Payment need to be done.','payment_content'=>$payment_content);
    die(json_encode($array));
}
?>