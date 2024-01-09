<?php
require_once("includes/initialize.php");

if (!empty($_POST['get_code'])) {
    $htRec = Hotelapi::find_by_code($_POST['get_code']);

	if($htRec->payment_type=='1') { $pay_type = 'stapi'; }
	if($htRec->payment_type=='2') { $pay_type = 'btapi'; }
	if($htRec->payment_type=='3') { $pay_type = 'hblapi'; }
	if($htRec->payment_type=='4') { $pay_type = 'nabilapi'; }

	echo json_encode(array('pay_type'=>$pay_type));
}