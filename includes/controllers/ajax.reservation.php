<?php 
	// Load the header files first
	header("Expires: 0"); 
	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); 
	header("cache-control: no-store, no-cache, must-revalidate"); 
	header("Pragma: no-cache");

	// Load necessary files then...
	require_once('../initialize.php');
	
	$action = $_REQUEST['action'];
	
	switch($action) 
	{			
		case "make_approve":
		$id =  $_REQUEST['idValue'];
		$record = Bookingmaster::find_by_id($id);
		$record->status          =  'approved';
		$record->approved        =   1;	
		$record->approved_by     =  @$session->get('u_id');	
		$record->approved_date   =  registered();	
		$record->save();
        
        $row = Bookingmaster::find_by_id($id);
		$fullname    =  $row->first_name." ".$row->last_name;
		$email       =  $row->email;
		$master_id   =  $row->id;
		$childs      =  Bookingchild::get_info_by($master_id); 

		$site_email = Config::getField('email_address',true);
        $site_name  = Config::getField('sitename',true);

        $hotel_row    =  Hotelapi::find_by_code($record->hotel_code);
        $hotel_name         =  $hotel_row->long_name;
	    $hotel_email        =  $hotel_row->email;
	    $hotel_contact_no   =  $hotel_row->contact_no;
	    $hotel_code         =  $hotel_row->code;
	    $hotel_street       =  $hotel_row->street;
	    $hotel_city         =  $hotel_row->city;


	$html = '';
	$html .= '<h3>Room Details</h3>
	<table class="table-form" width="100%" border="0" cellpadding="5" cellspacing="5" style="">
		<tbody>
			<tr>
				<td>
					<label>CheckIn Date</label>
					<div>'.$row->checkin_date.'</div>
				</td>
				<td>
					<label>CheckOut Date</label>
					<div>'.$row->checkout_date.'</div>
				</td>
				<td>
					<label>No.of Nights</label>
					<div>'.$row->nights.'</div>
				</td>
			</tr>
		</tbody>			
	</table>';
	$html .= '<table class="table-form" width="100%" border="0" cellpadding="5" cellspacing="5" style="">';
	$html .= '<thead>
			        <tr>
			        <th>Room</th>
			        <th>No.</th>
			        <th>Adult</th>
			        <th>Child</th>
			        <th>Extra Bed</th>
			        <th>Total</th>
			        </tr>
		      </thead>';
	$html .= '<tbody>';

    $sn=1;
	foreach($childs as $key_child=>$val_child){
	$html .='<tr>
				<td>'.$sn++.'</td>
				<td>'.$val_child->room_label.'</td>
				<td>'.$val_child->no_of_room.'</td>
				<td>'.$val_child->adult.'</td>
				<td>'.$val_child->child.'</td>
				<td>'.$val_child->extra_bed.'</td>
				<td>'.$val_child->currency.' '.$val_child->price.'</td>
			 </tr>';				
		}
		
				
			
	$html.='<tr>
				<td colspan="5">Sub Total :</td>
				<td>
					<span id="total_price">'.$row->currency_symbol.' '.$row->subtotal.'</span>
				</td>
			</tr>
			<tr>
				<td colspan="5">Service Charge (10%) :</td>
				<td>
					<span id="service_charge">'.$row->currency_symbol.' '.$row->service_charge.'</span>
				</td>
			</tr>
			<tr>
				<td colspan="5">Tax Amount (13%):</td>
				<td>
					<span id="tax_price">'.$row->currency_symbol.' '.$row->tax_amount.'</span>
				</td>
			</tr>
			<tr>
				<td colspan="5">Grand Total:</td>
				<td>
					<span id="grand_total">'.$row->currency_symbol.' '.$row->grand_total.'</span>
				</td>
			</tr>';

	$html .= '</tbody>';			
	$html .= '</table>';

	$html .= '<h3>Personal Information</h3>
			<table class="table-form" width="100%" border="0" cellpadding="5" cellspacing="5" style="">
				<tbody>
					<tr>
						<td colspan="2">
							<label>Booking Code</label> : '.$row->booking_code.'					
						</td>
					</tr>
					<tr>
						<td><label>First Name</label>:</td>
						<td>'.$row->first_name.'</td>
					</tr>
					<tr>
						<td><label>Last Name</label>:</td>
						<td>'.$row->last_name.'</td>
					</tr>

					<tr>
						<td><label>Contact No</label>:</td>
						<td>'.$row->contact_no.'</td>
					</tr>

					<tr>
						<td><label>Email Address</label>:</td>
						<td>'.$row->email.'</td>
					</tr>

					<tr>
						<td><label>Address</label>:</td>
						<td>'.$row->address.'</td>
					</tr>

					<tr>
						<td><label>City</label>:</td>
						<td>'.$row->city.'</td>
					</tr>

					<tr>
						<td><label>Zip Code</label>:</td>
						<td>'.$row->zipcode.'</td>
					</tr>

					<tr>
						<td><label>Country</label>:</td>
						<td>'.$row->country.'</td>
					</tr>

					<tr>
						<td><label>Booking Date</label>:</td>
						<td>'.$row->booking_date.'</td>
					</tr>
                    		
				</tbody>
			</table>';

			$html .= '<h3>Flight Details</h3>
			<table class="table-form" width="100%" border="0" cellpadding="5" cellspacing="5" style="">
				<tbody>
				<tr>
						<td><label>Flight Name</label>:</td>
						<td>'.$row->flightname.'</td>
					</tr>
					<tr>
						<td><label>Arrival time</label>:</td>
						<td>'.$row->arrivaltime.'</td>
					</tr>
					<tr>
						<td colspan="2">
							<label>Personal Request</label><br> : '.$row->personal_request.'					
						</td>
					</tr>					                    		
				</tbody>
			</table>';

	    $body ='Dear '.$fullname.',<br><br>
		            Your booking with following details has been approved.
                    <br><br>'.$html;		
		$body.=     '<br><br>
	             Thank you,<br>
	             <h4>'.$hotel_name.'<h4>
		             Email : '.$hotel_email.'<br>
		             Contact No : '.$hotel_contact_no.'<br>
		             Street : '.$hotel_street.'<br>
		             City : '.$hotel_city.'<br>';

		$mail = new PHPMailer();
		$mail->SetFrom($email, $fullname);
		$mail->AddReplyTo($email, $fullname);
		$mail->AddAddress($site_email, $site_name);
     
		// $mail->AddAddress('naresh@longtail.info', $site_name);
	    $mail->Subject    = " Rooms Booking has been approved - ".$hotel_name;
	    $mail->MsgHTML($body);
		$success    =   @$mail->Send();
        die(json_encode(array('success'=>true,'message'=>'Booking has been approved.'))); 
		break;   

		case "un_approve":
		$id =  $_REQUEST['idValue'];
		$record = Bookingmaster::find_by_id($id);
		$record->status          =  'unapproved';
		$record->approved        =   '0';	
		$record->approved_by     =  '0';	
		$record->approved_date   =  '0000-00-00';	
		$record->save();
        
        $row = Bookingmaster::find_by_id($id);
		$fullname    =  $row->first_name." ".$row->last_name;
		$email       =  $row->email;
		$master_id   =  $row->id;
		$childs      =  Bookingchild::get_info_by($master_id); 

		$site_email = Config::getField('email_address',true);
        $site_name  = Config::getField('sitename',true);

        $hotel_row    =  Hotelapi::find_by_code($record->hotel_code);
        $hotel_name         =  $hotel_row->long_name;
	    $hotel_email        =  $hotel_row->email;
	    $hotel_contact_no   =  $hotel_row->contact_no;
	    $hotel_code         =  $hotel_row->code;
	    $hotel_street       =  $hotel_row->street;
	    $hotel_city         =  $hotel_row->city;


	$html = '';
	$html .= '<h3>Room Details</h3>
	<table class="table-form" width="100%" border="0" cellpadding="5" cellspacing="5" style="">
		<tbody>
			<tr>
				<td>
					<label>CheckIn Date</label>
					<div>'.$row->checkin_date.'</div>
				</td>
				<td>
					<label>CheckOut Date</label>
					<div>'.$row->checkout_date.'</div>
				</td>
				<td>
					<label>No.of Nights</label>
					<div>'.$row->nights.'</div>
				</td>
			</tr>
		</tbody>			
	</table>';
	$html .= '<table class="table-form" width="100%" border="0" cellpadding="5" cellspacing="5" style="">';
	$html .= '<thead>
			        <tr>
			        <th>Room</th>
			        <th>No.</th>
			        <th>Adult</th>
			        <th>Child</th>
			        <th>Extra Bed</th>
			        <th>Total</th>
			        </tr>
		      </thead>';
	$html .= '<tbody>';

    $sn=1;
	foreach($childs as $key_child=>$val_child){
	$html .='<tr>
				<td>'.$sn++.'</td>
				<td>'.$val_child->room_label.'</td>
				<td>'.$val_child->no_of_room.'</td>
				<td>'.$val_child->adult.'</td>
				<td>'.$val_child->child.'</td>
				<td>'.$val_child->extra_bed.'</td>
				<td>'.$val_child->currency.' '.$val_child->price.'</td>
			 </tr>';				
		}
		
				
			
	$html.='<tr>
				<td colspan="5">Sub Total :</td>
				<td>
					<span id="total_price">'.$row->currency_symbol.' '.$row->subtotal.'</span>
				</td>
			</tr>
			<tr>
				<td colspan="5">Service Charge (10%) :</td>
				<td>
					<span id="service_charge">'.$row->currency_symbol.' '.$row->service_charge.'</span>
				</td>
			</tr>
			<tr>
				<td colspan="5">Tax Amount (13%):</td>
				<td>
					<span id="tax_price">'.$row->currency_symbol.' '.$row->tax_amount.'</span>
				</td>
			</tr>
			<tr>
				<td colspan="5">Grand Total:</td>
				<td>
					<span id="grand_total">'.$row->currency_symbol.' '.$row->grand_total.'</span>
				</td>
			</tr>';

	$html .= '</tbody>';			
	$html .= '</table>';

	$html .= '<h3>Personal Information</h3>
			<table class="table-form" width="100%" border="0" cellpadding="5" cellspacing="5" style="">
				<tbody>
					<tr>
						<td colspan="2">
							<label>Booking Code</label> : '.$row->booking_code.'					
						</td>
					</tr>
					<tr>
						<td><label>First Name</label>:</td>
						<td>'.$row->first_name.'</td>
					</tr>
					<tr>
						<td><label>Last Name</label>:</td>
						<td>'.$row->last_name.'</td>
					</tr>

					<tr>
						<td><label>Contact No</label>:</td>
						<td>'.$row->contact_no.'</td>
					</tr>

					<tr>
						<td><label>Email Address</label>:</td>
						<td>'.$row->email.'</td>
					</tr>

					<tr>
						<td><label>Address</label>:</td>
						<td>'.$row->address.'</td>
					</tr>

					<tr>
						<td><label>City</label>:</td>
						<td>'.$row->city.'</td>
					</tr>

					<tr>
						<td><label>Zip Code</label>:</td>
						<td>'.$row->zipcode.'</td>
					</tr>

					<tr>
						<td><label>Country</label>:</td>
						<td>'.$row->country.'</td>
					</tr>

					<tr>
						<td><label>Booking Date</label>:</td>
						<td>'.$row->booking_date.'</td>
					</tr>
                    		
				</tbody>
			</table>';

			$html .= '<h3>Flight Details</h3>
			<table class="table-form" width="100%" border="0" cellpadding="5" cellspacing="5" style="">
				<tbody>
				<tr>
						<td><label>Flight Name</label>:</td>
						<td>'.$row->flightname.'</td>
					</tr>
					<tr>
						<td><label>Arrival time</label>:</td>
						<td>'.$row->arrivaltime.'</td>
					</tr>
					<tr>
						<td colspan="2">
							<label>Personal Request</label><br> : '.$row->personal_request.'					
						</td>
					</tr>					                    		
				</tbody>
			</table>';

	    $body ='Dear '.$fullname.',<br><br>
		            Your booking with following details has been unapproved.
                    <br><br>'.$html;		
		$body.=     '<br><br>
	             Thank you,<br>
	             <h4>'.$hotel_name.'<h4>
		             Email : '.$hotel_email.'<br>
		             Contact No : '.$hotel_contact_no.'<br>
		             Street : '.$hotel_street.'<br>
		             City : '.$hotel_city.'<br>';

		$mail = new PHPMailer();
		$mail->SetFrom($email, $fullname);
		$mail->AddReplyTo($email, $fullname);
		$mail->AddAddress($site_email, $site_name);
     
		// $mail->AddAddress('naresh@longtail.info', $site_name);
	    $mail->Subject    = " Rooms Booking has been unapproved - ".$hotel_name;
	    $mail->MsgHTML($body);
		$success    =   @$mail->Send();
        die(json_encode(array('success'=>true,'message'=>'Booking has been unapproved.'))); 
		break;      
	}
?>