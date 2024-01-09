<?php if(!empty($send_email) and $send_email=='1') {
$hotel_name         =  $hotel_row->long_name;
$hotel_email        =  $hotel_row->inquiry_email;
$hotel_contact_no   =  $hotel_row->contact_no;
$hotel_code         =  $hotel_row->code;
$hotel_street       =  $hotel_row->street;
$hotel_city         =  $hotel_row->city;

$top=$html=$html2=$html3=$admin_header=$admin_footer=$client_header=$client_footer=$bottom='';
$top.='<!DOCTYPE html>
<html>
	<head>
	<title>A Responsive Email Template</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<style type="text/css">
		    a,body,table,td{-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%}table,td{mso-table-lspace:0;mso-table-rspace:0}img{-ms-interpolation-mode:bicubic;border:0;height:auto;line-height:100%;outline:0;text-decoration:none}table{border-collapse:collapse!important}body{height:100%!important;margin:0!important;padding:0!important;width:100%!important}a[x-apple-data-detectors]{color:inherit!important;text-decoration:none!important;font-size:inherit!important;font-family:inherit!important;font-weight:inherit!important;line-height:inherit!important}@media screen and (max-width:525px){.img-max,.wrapper{max-width:100%!important;width:100%!important}.img-max,.responsive-table,.wrapper{width:100%!important}.logo img{margin:0 auto!important}.mobile-hide{display:none!important}.img-max{height:auto!important}.padding{padding:10px 5% 15px!important}.padding-meta{padding:30px 5% 0!important;text-align:center}.padding-copy{padding:10px 5%!important;text-align:center}.no-padding{padding:0!important}.section-padding{padding:50px 15px!important}.mobile-button-container{margin:0 auto;width:100%!important}.mobile-button{padding:15px!important;border:0!important;font-size:16px!important;display:block!important}}div[style*="margin: 16px 0;"]{margin:0!important}
		</style>
	</head>

	<body style="margin: 0 !important; padding: 0 !important; border: 1px solid #CCCC;">

	<!-- HEADER -->
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
	    <tr>
	        <td bgcolor="#ffffff" align="center">
	            <!--[if (gte mso 9)|(IE)]>
	            <table align="center" border="0" cellspacing="0" cellpadding="0" width="500">
	            <tr>
	            <td align="center" valign="top" width="500">
	            <![endif]-->
	            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 500px;" class="wrapper">
	                <tr>
	                    <td align="center" valign="top" style="padding: 15px 0;" class="logo">
	                        <a href="'.$hotel_row->website.'" target="_blank">
	                            <img alt="Logo" src="'.IMAGE_PATH.'hotelapi/logo/'.$hotel_row->logo.'" style="display: block; font-family: Helvetica, Arial, sans-serif; color: #ffffff; font-size: 16px;" border="0">
	                        </a>
	                        <p style="font-family: Helvetica, Arial, sans-serif; color: #666666; font-size: 14px;">'.$hotel_street.' | '.$hotel_city.'</p>
	                    </td>
	                </tr>
	            </table>
	            <!--[if (gte mso 9)|(IE)]>
	            </td>
	            </tr>
	            </table>
	            <![endif]-->
	        </td>
	    </tr>
	    <tr>
	        <td bgcolor="#ffffff" align="center" style="padding: 15px;">
	            <!--[if (gte mso 9)|(IE)]>
	            <table align="center" border="0" cellspacing="0" cellpadding="0" width="500">
	            <tr>
	            <td align="center" valign="top" width="500">
	            <![endif]-->
	            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 500px;" class="responsive-table">
	                <tr>
	                    <td>
	                        <!-- COPY -->';

	                        $admin_header.='<table width="100%" border="0" cellspacing="0" cellpadding="0">
	                            <tr>
	                                <td align="center" style="font-size: 18px; font-family: Helvetica, Arial, sans-serif; color: #333333;" class="padding-copy">Thank you, '.$fullname.' !</td>
	                            </tr>
	                            <tr>
	                                <td align="left" style="padding: 20px 0 0 0; font-size: 16px; line-height: 25px; font-family: Helvetica, Arial, sans-serif; color: #666666;" class="padding-copy">Your booking inquiry has been successfully made. We will back you shortly. We have got inquiry with following details</td>
	                            </tr>
	                        </table>';

	                        $client_header.='<table width="100%" border="0" cellspacing="0" cellpadding="0">
	                            <tr>
	                                <td align="center" style="font-size: 18px; font-family: Helvetica, Arial, sans-serif; color: #333333;" class="padding-copy">Room reservation inquiry from '.$fullname.' !</td>
	                            </tr>
	                            <tr>
	                                <td align="left" style="padding: 20px 0 0 0; font-size: 16px; line-height: 25px; font-family: Helvetica, Arial, sans-serif; color: #666666;" class="padding-copy">We have got booking inquiry with following details</td>
	                            </tr>
	                        </table>';

	                    $html.='</td>
	                </tr>
	            </table>
	            <!--[if (gte mso 9)|(IE)]>
	            </td>
	            </tr>
	            </table>
	            <![endif]-->
	        </td>
	    </tr>
	    <tr>
	        <td bgcolor="#ffffff" align="center" style="padding: 15px;" class="padding">
	            <!--[if (gte mso 9)|(IE)]>
	            <table align="center" border="0" cellspacing="0" cellpadding="0" width="500">
	            <tr>
	            <td align="center" valign="top" width="500">
	            <![endif]-->
	            <p style="font-family: Helvetica, Arial, sans-serif; color: #666666; font-size: 16px;">Room Details</p>
	            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 500px;" class="responsive-table">

	                <tr>    
	                    <td style="padding: 10px 0 0 0; border-top: 1px dashed #aaaaaa;">
	                        <table cellspacing="0" cellpadding="0" border="0" width="100%">
	                            <tr>
	                                <td>Check In</td>
	                                <td>'.$row->checkin_date.'</td>
	                            </tr>
	                            <tr>
	                                <td>Check Out</td>
	                                <td>'.$row->checkout_date.'</td>
	                            </tr>
	                            <tr>
	                                <td>No. Of Nights</td>
	                                <td>'.$row->nights.' nights</td>
	                            </tr>
	                        </table>
	                    </td>
	                </tr>

	                <tr>
	                    <td style="padding: 10px 0 0 0; border-top: 1px dashed #aaaaaa;">
	                        <!-- TWO COLUMNS -->
	                        <table cellspacing="0" cellpadding="0" border="0" width="100%">
	                            <tr style="text-align:center;">
	                                <td>S.No.</td>
	                                <td>Room</td>
	                                <td>Adult</td>
	                                <td>Child</td>
	                                <td>Extra Bed</td>
	                                <td>Total(US$)</td>
	                            </tr>';
	                            $sn=1;
								foreach($childs as $key_child=>$val_child) {
								$equery = $db->query("SELECT extra_bed FROM tbl_roomapi_price WHERE room_id='$val_child->room_type' LIMIT 1");
								$erow = $db->fetch_object($equery);
								$extra_rate = ($val_child->extra_bed>0)?'(+'.$erow->extra_bed.')':'';
								$styl=($sn==1)?'padding: 10px 0 0 0; border-top: 1px dashed #aaaaaa; text-align:center;':'text-align:center;';
								$html.='<tr style="'.$styl.'">
									<td>'.$sn.'</td>
									<td>'.$val_child->room_label.'</td>
									<td>'.$val_child->adult.'</td>
									<td>'.$val_child->child.'</td>
									<td>'.$val_child->extra_bed.'</td>
									<td>'.$val_child->currency.' '.$val_child->price.' '.$extra_rate.'</td>
							 	</tr>';				
								$sn++; }

	                            $html.='<tr style="padding: 10px 0 0 0; border-top: 1px dashed #aaaaaa;">
	                                <td colspan="5">Sub Total</td>
	                                <td style="text-align:center;">'.$row->currency_symbol.' '.$row->subtotal.'</td>
	                            </tr>
	                            <tr>
	                                <td colspan="5">Service Charge(10%)</td>
	                                <td style="text-align:center;">'.$row->currency_symbol.' '.$row->service_charge.'</td>
	                            </tr>
	                            <tr>
	                                <td colspan="5">Tax Amount (13%)</td>
	                                <td style="text-align:center;">'.$row->currency_symbol.' '.$row->tax_amount.'</td>
	                            </tr>
	                            <tr>
	                                <td colspan="5">Grand Total</td>
	                                <td style="text-align:center;">'.$row->currency_symbol.' '.$row->grand_total.'</td>
	                            </tr>';

	                            /*$comision = ceil($row->grand_total*10/100);
	                            $html2.='<tr style="padding: 10px 0 0 0; border-top: 1px dashed #aaaaaa;">
	                                <td colspan="5">Nepal Hotel Commision (10%)</td>
	                                <td style="text-align:center;">'.$row->currency_symbol.' '.$comision.'</td>
	                            </tr>
	                            <tr>
	                                <td colspan="5">Hotel Grand Total</td>
	                                <td style="text-align:center;">'.$row->currency_symbol.' '.($row->grand_total-$comision).'</td>
	                            </tr>';*/

	                        $html3.='</table>
	                    </td>
	                </tr>

	            </table>

	            <p style="font-family: Helvetica, Arial, sans-serif; color: #666666; font-size: 16px;">Personal Details</p>
	            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 500px;" class="responsive-table">
	                <tr>
	                    <td>Booking Code</td>
	                    <td>'.$row->booking_code.'</td>
	                </tr>
	                <tr>
	                    <td>First Name</td>
	                    <td>'.$row->first_name.'</td>
	                </tr>
	                <tr>
	                    <td>Last Name</td>
	                    <td>'.$row->last_name.'</td>
	                </tr>
	                <tr>
	                    <td>Contact No.</td>
	                    <td>'.$row->contact_no.' </td>
	                </tr>
	                <tr>
	                    <td>Email Address</td>
	                    <td>'.$row->email.'</td>
	                </tr>
	                <tr>
	                    <td>Address</td>
	                    <td>'.$row->address.'</td>
	                </tr>
	                <tr>
	                    <td>City</td>
	                    <td>'.$row->city.'</td>
	                </tr>
	                <tr>
	                    <td>Zip Code</td>
	                    <td>'.$row->zipcode.'</td>
	                </tr>
	                <tr>
	                    <td>Country</td>
	                    <td>'.$row->country.'</td>
	                </tr>
	                <tr>
	                    <td>Booking Date</td>
	                    <td>'.$row->booking_date.'</td>
	                </tr>
	            </table>


	            <p style="font-family: Helvetica, Arial, sans-serif; color: #666666; font-size: 16px;">Flight Details</p>
	            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 500px;" class="responsive-table">
	                <tr>
	                    <td>Flight Name</td>
	                    <td>'.$row->flightname.'</td>
	                </tr>
	                <tr>
	                    <td>Arrival time</td>
	                    <td>'.$row->arrivaltime.'</td>
	                </tr>
	            </table>
	            <!--[if (gte mso 9)|(IE)]>
	            </td>
	            </tr>
	            </table>
	            <![endif]-->
	        </td>
	    </tr>
	    <tr>
	        <td bgcolor="#ffffff" align="center" style="padding: 15px;">
	            <!--[if (gte mso 9)|(IE)]>
	            <table align="center" border="0" cellspacing="0" cellpadding="0" width="500">
	            <tr>
	            <td align="center" valign="top" width="500">
	            <![endif]-->
	            <p style="font-family: Helvetica, Arial, sans-serif; color: #666666; font-size: 16px;">Personal Request</p>
	            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 500px;" class="responsive-table">
	                <tr>
	                    <td>
	                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
	                            <tr>
	                                <td>
	                                    <!-- COPY -->
	                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
	                                        <tr>
	                                            <td align="left" style="padding: 0 0 0 0; font-size: 14px; line-height: 18px; font-family: Helvetica, Arial, sans-serif; color: #666666; font-style: italic;" class="padding-copy">'.$row->personal_request.'</td>
	                                        </tr>
	                                    </table>
	                                </td>
	                            </tr>
	                        </table>
	                    </td>
	                </tr>
	            </table>
	            <!--[if (gte mso 9)|(IE)]>
	            </td>
	            </tr>
	            </table>
	            <![endif]-->
	        </td>
	    </tr>
	    <tr>
	        <td bgcolor="#ffffff" align="center" style="padding: 20px 0px;">
	            <!--[if (gte mso 9)|(IE)]>
	            <table align="center" border="0" cellspacing="0" cellpadding="0" width="500">
	            <tr>
	            <td align="center" valign="top" width="500">
	            <![endif]-->
	            <!-- UNSUBSCRIBE COPY -->';

	            $admin_footer.='<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" style="max-width: 500px;" class="responsive-table">
	                <tr>
	                    <td align="center" style="font-size: 12px; line-height: 18px; font-family: Helvetica, Arial, sans-serif; color:#666666;">
	                        '.$fullname.'
	                        <br>
	                        '.$row->address.', '.$row->city.', '.$row->country.'
	                        <br>
	                        Email : '.$email.' | Contact : '.$row->contact_no.'
	                    </td>
	                </tr>
	            </table>';

	            $client_footer.='<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" style="max-width: 500px;" class="responsive-table">
	                <tr>
	                    <td align="center" style="font-size: 12px; line-height: 18px; font-family: Helvetica, Arial, sans-serif; color:#666666;">
	                        '.$hotel_name.'
	                        <br>
	                        '.$hotel_street.', '.$hotel_city.'
	                        <br>
	                        Email : '.$hotel_email.' | Contact : '.$hotel_contact_no.'
	                    </td>
	                </tr>
	            </table>';

	            $bottom.='<!--[if (gte mso 9)|(IE)]>
	            </td>
	            </tr>
	            </table>
	            <![endif]-->
	        </td>
	    </tr>
	</table>

	</body>
</html>';

    // $site_email = Config::getField('email_address',true);
    // $site_name  = Config::getField('sitename',true);

    $site_name         =  $hotel_row->long_name;
	$site_email        =  $hotel_row->email;

	$mail = new PHPMailer(true);

	$mail->IsSMTP();                            // tell the class to use SMTP
    $mail->SMTPAuth = true;                     // enable SMTP authentication
    $mail->Port = 26;                           // set the SMTP server port
    $mail->Host = "173.254.24.30";              // SMTP server
    $mail->Username = "noreply@gundri.com";     // SMTP server username
    $mail->Password = "Gundri@1234";            // SMTP server password

	$mail->SetFrom($email, $fullname);
	$mail->AddReplyTo($email, $fullname);
	$mail->AddAddress($site_email, $site_name);
	$mail->AddBCC("amit@longtail.info", "Longtail e media");
	$mail->AddBCC("bipin@longtail.info", "Longtail e media");

	// $mail->AddAddress('amit@longtail.info', $site_name);
    $mail->Subject    = " Rooms Inquiry - ".$hotel_name;
    $mail->MsgHTML($top.$admin_header.$html.$html2.$html3.$admin_footer.$bottom);
    $mail->IsHTML(true); // send as HTML
	$success          =   @$mail->Send();
	if($success){      
       //Reply to Customer		
		$replymail = new PHPMailer(true);

        $replymail->IsSMTP();                            // tell the class to use SMTP
        $replymail->SMTPAuth = true;                     // enable SMTP authentication
        $replymail->Port = 26;                           // set the SMTP server port
        $replymail->Host = "173.254.24.30";              // SMTP server
        $replymail->Username = "noreply@gundri.com";     // SMTP server username
        $replymail->Password = "Gundri@1234";            // SMTP server password

		$replymail->SetFrom($site_email, $site_name);
		$replymail->AddReplyTo($site_email, $site_name);
		$replymail->AddAddress($email, $fullname);	
		// $replymail->AddAddress('amit@longtail.info', $site_name);	
		$replymail->Subject    = "No-reply - ".$hotel_name;		
		$replymail->MsgHTML($top.$client_header.$html.$html3.$client_footer.$bottom);
        $replymail->IsHTML(true); // send as HTML
		@$replymail->Send();	
		
	}//ifsuccesssendemailtocustomer
}
?>