<?php
	// Load the header files first
	header("Expires: 0");
	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
	header("cache-control: no-store, no-cache, must-revalidate");
	header("Pragma: no-cache");

	// Load necessary files then...
	require_once('../initialize.php');

	$usermail = User::field_by_id('1', 'email');
	$sitename = Config::getField('sitename',true);
	$bccmail = User::field_by_id('1','optional_email');

	$action = $_REQUEST['action'];

	switch($action)
	{
		case "request_inquiry":
			foreach($_POST as $key=>$val) { $$key=$val; }

			// For tbl_bookinginfo
			$bokRec = new Bookinginfo();

//			$n = explode(':', base64_decode($date_rate));
			$bokRec->pkg_id 		= $pkg_id;
            $bokRec->fixed_date_id = (!empty($fixed_date_id)) ? $fixed_date_id : '';
			$bokRec->trip_date 		= $date;
			$bokRec->trip_currency  = 'USD';
//			$bokRec->date_rate 		= $n[1];
			$bokRec->trip_pax		= $pax + 1;
//			$bokRec->trip_flight 	= $trip_flight;
//			$bokRec->accesskey		= $trans_key;
//			$bokRec->person_title 	= $person_title;
			$bokRec->person_fname 	= $full_name;
//			$bokRec->person_mname 	= $person_mname;
//			$bokRec->person_lname	= $person_lname;

			$bokRec->person_phone 	= $phone;
			$bokRec->person_email	= $email;
			$bokRec->person_address	= $address1;
			$bokRec->person_country = $country;
			$bokRec->person_country_code = Countries::find_by_name($country);
			$bokRec->person_city 	= $province;
			$bokRec->person_postal 	= $state;
//			$bokRec->person_ctype 	= implode(' / ', $person_ctype); // (!empty($person_ctype[0])?$person_ctype[0]:'').' '.(!empty($person_ctype[1])?$person_ctype[1]:'');
            $bokRec->person_hear    = (!empty($address2)) ? $address2 : '';
			$bokRec->person_comment = $message;

			$bokRec->ip_address 	= $_SERVER['REMOTE_ADDR'];
			$bokRec->pay_type 		= 'Inquiry';
			$bokRec->sortorder 		= Bookinginfovehicle::find_maximum();;
			$bokRec->added_date 	= registered();


            $db->begin();
            if ($bokRec->save()) {
                include(SITE_ROOT.'book_mail.php');
                $db->commit();
                if (!empty($additional_name)) {
                    $booking_id = $db->insert_id();
                    $length = sizeof($additional_name);
                    for ($i = 0; $i < $length; $i++) {
                        $csql = "INSERT INTO tbl_bookinginfo_additional SET 
                                  booking_id='" . $booking_id . "', 
                                  name='" . $additional_name[$i] . "', 
                                  phone='" . $additional_phone[$i] . "', 
                                  address='" . $additional_address[$i] . "' ";
                        $db->query($csql);
                    }
                }

                $message = 'Success ! Your information has been sent. You will soon be notified by admin about booking through email.';
                echo json_encode(array("action" => "success", "message" => $message));
            }
			else {
				$db->rollback();
				$message='Error ! Could not book the trip !';
				echo json_encode(array("action"=>"error", "message"=>$message));
			}
			break;

        case "hbl_pay":
            foreach($_POST as $key=>$val) { $$key=$val; }

            $bokRec = new Bookinginfovehicle();

            $bokRec->user_id 		= (!empty($user_id)) ? $user_id : 0;
            $bokRec->route_from 	= $from_id;
            $bokRec->route_to 		= $to_id;
            $bokRec->date 		    = $date;
            $bokRec->currency       = 'USD';
            $bokRec->pax		    = $pax;

            $trans_key = @randomKeys('15');
			$bokRec->accesskey		= $trans_key;

            $bokRec->person_fname 	= $fname;
			$bokRec->person_lname	= $lname;
            $bokRec->person_phone 	= $phone;
            $bokRec->person_email	= $email;
//            $bokRec->person_address	= $address1;
            $bokRec->person_country = $country;
            $bokRec->person_country_code = Countries::find_by_name($country);
            $bokRec->person_city 	= $city;
            $bokRec->person_comment = $message;

            $bokRec->ip_address 	= $_SERVER['REMOTE_ADDR'];
            $bokRec->pay_type 		= 'Inquiry';
            $bokRec->pay_amt 		= $total;
            $bokRec->status         = 0;
            $bokRec->sortorder 		= Bookinginfovehicle::find_maximum();;
            $bokRec->added_date 	= registered();


            $db->begin();
            if ($bokRec->save()) {
                $act_id = $db->insert_id();
                if(!empty($_SESSION['cart_detail'][$user_id])){
                    $vehicles = $_SESSION['cart_detail'][$user_id];
                    foreach ($vehicles as $k => $v) {
                        $qu = "
                          INSERT INTO tbl_bookinginfo_vehicle_extra SET 
                            booking_id='{$act_id}', 
                            vendor_id='{$v['vendor_id']}', 
                            vehicle_id='{$k}', 
                            vehicle_price='{$v['vehicle_price']}', 
                            vehicle_qnt='{$v['quantity']}'";
                        $db->query($qu);
                    }
                }
                include(SITE_ROOT.'book_mail_vehicle.php');
                $db->commit();
                ob_start();
//                require("payment_form_hbl.php");
                $payment_content  =  ob_get_clean();
                $message = 'Success ! Your booking has been sent.';
                unset($_SESSION['cart_detail'][$user_id]);
                echo json_encode(array("action" => "success", "message" => $message,'payment_content'=>$payment_content));
            }
            else {
                $db->rollback();
                $message='Error ! Could not book the package !';
                echo json_encode(array("action"=>"error", "message"=>$message));
            }
        break;

		case "delete":
			$id = $_REQUEST['id'];
			$record = Bookinginfovehicle::find_by_id($id);
			$db->query("DELETE FROM tbl_bookinginfo_vehicle WHERE id='{$id}'");
			reOrder("tbl_bookinginfo_vehicle", "sortorder");

			$records = Bookinginfovehicle::find_all();
			$fixedOrder = "sortOrder";
			foreach($records as $order):
				$fixedOrder.= "|".$order->sortorder;
			endforeach;

            $message = sprintf($GLOBALS['basic']['deletedSuccess_'], "Booking Record '" . $record->accesskey . "'");
            echo json_encode(array("action" => "success", "message" => $message));
//			echo "Delete Booking Record [".$record->accesskey."]".$GLOBALS['basic']['deletedSuccess']."||1>>". $fixedOrder;
			log_action("Delete Booking Record [".$record->accesskey."]".$GLOBALS['basic']['deletedSuccess']."");

		break;

	}
?>