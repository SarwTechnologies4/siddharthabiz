<?php 
	// Load the header files first
	header("Expires: 0"); 
	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); 
	header("cache-control: no-store, no-cache, must-revalidate"); 
	header("Pragma: no-cache");

	// Load necessary files then...
	require_once('../initialize.php');
	
	$action = $_REQUEST['action'];
	$user_hotel_id  =  $session->get('user_hotel_id');
    $hotel_detail   =  Hotelapi::find_by_id($user_hotel_id); 
	
	switch($action) 
	{		
		case "date_detail":	
		    $date  =  $_REQUEST['date'];
		    $date  =  str_replace("_","-",$date);
		    echo "Calender Booking for Date : ".date("F d,Y",strtotime($date));
			?>
			<hr>
			 <form action="" method="post" name="calender_date_booking_form"  id="calender_date_booking_form">
			 <input type="hidden" name="reserve_date" id="reserve_date" value="<?php echo $date?>" >
             <?php 
                 $records = Roomapi::find_by_sql("SELECT * FROM tbl_roomapi WHERE hotel_id='".$user_hotel_id."' ORDER BY sortorder DESC ");	
				  foreach($records as $key=>$record):
				  $row =   Calenderbooking::find_by_room_date($record->id,$date);
				  $total_rooms  =  $record->no_rooms;
				  $no_rooms  =  isset($row->no_rooms) ? $row->no_rooms : $total_rooms;		
             ?> 
             <div class="form-row">
                <div class="form-label col-md-8">
                    <label for=""><?php echo $record->title?></label>
                </div>                
                <div class="form-input col-md-4">
                    <input placeholder="No. of room" class="col-md-12 validate[required,length[0,100]] room_field" type="text" name="room[<?php echo $record->id?>]" value="<?php echo $no_rooms?>" id="room_<?php echo $record->id?>" data-self_id="<?php echo $record->id?>" data-total="<?php echo $total_rooms;?>" >
                </div>                
            </div>  
              
             <?php endforeach; ?>

             <?php 
                 $records = Roomapi::find_by_sql("SELECT * FROM tbl_roomapi WHERE hotel_id='".$user_hotel_id."' ORDER BY sortorder DESC ");	
				  foreach($records as $key=>$record):
				  $total_rooms  =  $record->no_rooms;
				  $row =   Calenderbooking::find_by_room_date($record->id,$date);
				  $total_rooms  =  isset($row->no_rooms) ? ($total_rooms-$row->no_rooms) : 0;		
             ?> 
             <div class="form-row hide">
                <div class="form-label col-md-8">
                    <label for=""><?php echo $record->title?>(Booked)</label>
                </div>                
                <div class="form-input col-md-4">
                    <input placeholder="Booked No. of room" class="col-md-12 validate[required,length[0,100]] booked_field" type="text" name="booked_room[<?php echo $record->id?>]" value="<?php echo $total_rooms?>" id="booked_<?php echo $record->id?>" data-self_id="<?php echo $record->id?>" data-total="<?php echo $record->no_rooms;?>"  >
                </div>                
            </div>  
              
             <?php endforeach; ?>

             <button  type="button" name="submit" class="btn-submit btn large primary-bg text-transform-upr font-bold font-size-11 radius-all-4" id="BtnSubmit" title="Save">
                <span class="button-content">Save</span>
            </button>
			 </form>
			<?php
		break;
		case 'save_date_detail':
		     foreach($_POST as $key=>$val){$$key=$val;}
		     $db->query("delete from tbl_room_calender WHERE hotel_id='".$user_hotel_id."' AND reserve_date='$reserve_date'");
		     if(count($room)>0){
		     	  foreach($room as $key=>$val){ 
		     	  	   $record = new Calenderbooking();
		     	  	   $record->reserve_date   =  $reserve_date;
		     	  	   $record->room_id        =  $key;
		     	  	   $record->no_rooms       =  $val;
		     	  	   $record->added_by       =  $session->get('u_id');
		     	  	   if(empty($session->get('user_hotel_id'))){
				     	echo json_encode(array("action"=>"error","message"=>"No hotel has been selected"));
				     	}
				       $record->hotel_id       =  $session->get('user_hotel_id');
		     	  	   $record->create();
		     	  }
		     }
            echo json_encode(array('result'=>'true','message'=>'Calender Booking Recorded Successfully for Date:'.$reserve_date));
		break;

		case 'newCalendar':
			$rRow = explode('||', $_POST['info_main']);
			$bRoom = addslashes($_POST['room_blok']);
			$hotel_id = !empty($rRow[0])?$rRow[0]:0;
			$reserve_date = !empty($rRow[1])?$rRow[1]:0;
			$room_id = !empty($rRow[2])?$rRow[2]:0;

			$mcount = $db->num_rows($db->query("SELECT id FROM tbl_room_calender WHERE hotel_id='".$hotel_id."' AND reserve_date='".$reserve_date."' AND room_id='".$room_id."' "));
			if($mcount > 0) {
				$sql = "UPDATE tbl_room_calender SET hotel_id='".$hotel_id."', reserve_date='".$reserve_date."', room_id='".$room_id."', no_rooms='".$bRoom."', added_by='".$session->get('u_id')."' WHERE hotel_id='".$hotel_id."' AND reserve_date='".$reserve_date."' AND room_id='".$room_id."' ";
				$db->query($sql);
			}
			else {				
				$sql = "INSERT tbl_room_calender SET hotel_id='".$hotel_id."', reserve_date='".$reserve_date."', room_id='".$room_id."', no_rooms='".$bRoom."', added_by='".$session->get('u_id')."' ";
				$db->query($sql);
			}

			if($db->affected_rows()) {
				echo json_encode(array('room_qty'=>$bRoom, 'room_date'=>date('Md', strtotime($reserve_date)).'-'.$room_id ));
			}
			break;

		case 'bulkroom':
			$rRow = explode('||', $_POST['bulkpost']);
			$hotel_id = !empty($rRow[0])?$rRow[0]:0;
			$room_id = !empty($rRow[1])?$rRow[1]:0;
			$date_from  =  !empty($rRow[2])?$rRow[2] : date('Y-m-d');
    		$date_to    =  !empty($rRow[3])?$rRow[3] : date('Y-m-d',strtotime("+20 days"));
    		$room_max = !empty($rRow[4])?$rRow[4]:0;

			$res='<div class="frm-bulk">
				<div class="form-group">
					<div class="col-sm-12 form-input">
						<label class="control-label">Date From</label>
						<input class="form-control date_from" type="text" name="from_date" value="'.$date_from.'" readonly>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-12 form-input">
						<label class="control-label">Date To</label>
						<input class="form-control date_to" type="text" name="to_date" value="'.$date_to.'" readonly>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-12 form-input">
						<label class="control-label">Room</label>
						<input class="form-control" type="text" name="block_room" value="0">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-12 form-input"><br/>
						<button class="btn bg-blue medium btn-bulk" data-hotel="'.$hotel_id.'" data-room="'.$room_id.'" data-max="'.$room_max.'">Save</button>
					</div>
				</div>
			</div>';
			echo $res;
			break;

		case 'bulkCalendar':
			foreach($_POST as $k=>$v){ $$k=$v; }
			$resArr = array();
			if(!empty($hotel_id) AND !empty($room_id)) {
				$blRoom = ($max_room < $block_room)?$max_room:$block_room;
				for($i = new DateTime( $date_from ); $i <= new DateTime( $date_to ); $i->modify('+1 day')) {
	                $reserve_date = $i->format("Y-m-d");
	                $mcount = $db->num_rows($db->query("SELECT id FROM tbl_room_calender WHERE hotel_id='".$hotel_id."' AND reserve_date='".$reserve_date."' AND room_id='".$room_id."' "));
					if($mcount > 0) {
						$sql = "UPDATE tbl_room_calender SET hotel_id='".$hotel_id."', reserve_date='".$reserve_date."', room_id='".$room_id."', no_rooms='".$blRoom."', added_by='".$session->get('u_id')."' WHERE hotel_id='".$hotel_id."' AND reserve_date='".$reserve_date."' AND room_id='".$room_id."' ";
						$db->query($sql);
					}
					else {				
						$sql = "INSERT tbl_room_calender SET hotel_id='".$hotel_id."', reserve_date='".$reserve_date."', room_id='".$room_id."', no_rooms='".$blRoom."', added_by='".$session->get('u_id')."' ";
						$db->query($sql);
					}
					$m_log = date('Md', strtotime($reserve_date)).'-'.$room_id;
	            	$resArr[$m_log] = $blRoom;
	            }
	        }
	        echo json_encode(array('res' => $resArr));
			break;

		case 'getIndividual':
			$rRow = explode('||', $_POST['m_data']);
			$date_from = !empty($rRow[0])?$rRow[0] : date('Y-m-d');
    		$date_to   = !empty($rRow[1])?$rRow[1] : date('Y-m-d',strtotime("+20 days"));
			$hotel_id  = !empty($rRow[2])?$rRow[2]:0;
			$room_id   = !empty($rRow[3])?$rRow[3]:0;			

			$prRow  = $db->fetch_object($db->query("SELECT one_person, two_person, three_person, extra_bed FROM tbl_roomapi_price WHERE room_id='".$room_id."' LIMIT 1 "));

			$myArr = array();
		 	for($i = new DateTime( $date_from ); $i <= new DateTime( $date_to ); $i->modify('+1 day')) {
                $m_date = $i->format("Y-m-d");               
                $myArr[] = array('s_date' => $m_date);
            }

            $g_one='';
            if($prRow->one_person > 0) {
				$g_one='<td>1 Guest US$ <button class="btn bg-black small qbulk" data-qbulk="'.$hotel_id.'||'.$room_id.'||'.$date_from.'||'.$date_to.'||1"></button></td>';
                foreach($myArr as $k=>$val) {
                    $row = (object) $val;
                    $nwRow  = $db->fetch_object($db->query("SELECT one_person FROM tbl_calendar_price WHERE hotel_id='".$hotel_id."' AND room_id='".$room_id."' AND reserve_date='".$row->s_date."' LIMIT 1 ")); 
                    $main_data = $hotel_id.'||'.$room_id.'||1||'.$prRow->one_person.'||'.$row->s_date;
                    $g_one.='<td><div class="form-input"><input class="room-rate '.date('Md', strtotime($row->s_date)).'-'.$room_id.'-1" type="text" value="'.(!empty($nwRow)?$nwRow->one_person:$prRow->one_person).'" data-main="'.$main_data.'"></div></td>';
                }
            }

            $g_two='';
            if($prRow->two_person > 0) {
                $g_two='<td>2 Guest US$ <button class="btn bg-black small qbulk" data-qbulk="'.$hotel_id.'||'.$room_id.'||'.$date_from.'||'.$date_to.'||2"></button></td>';
                foreach($myArr as $k=>$val) {
                    $row = (object) $val;
                    $nwRow  = $db->fetch_object($db->query("SELECT two_person FROM tbl_calendar_price WHERE hotel_id='".$hotel_id."' AND room_id='".$room_id."' AND reserve_date='".$row->s_date."' LIMIT 1 "));
                    $main_data = $hotel_id.'||'.$room_id.'||2||'.$prRow->two_person.'||'.$row->s_date;
                    $g_two.='<td><div class="form-input"><input class="room-rate '.date('Md', strtotime($row->s_date)).'-'.$room_id.'-2" type="text" value="'.(!empty($nwRow)?$nwRow->two_person:$prRow->two_person).'" data-main="'.$main_data.'"></div></td>';
                }
            }
            
            $g_three='';
            if($prRow->three_person > 0) {
                $g_three='<td>3 Guest US$ <button class="btn bg-black small qbulk" data-qbulk="'.$hotel_id.'||'.$room_id.'||'.$date_from.'||'.$date_to.'||3"></button></td>';
                foreach($myArr as $k=>$val) {
                    $row = (object) $val;
                    $nwRow  = $db->fetch_object($db->query("SELECT three_person FROM tbl_calendar_price WHERE hotel_id='".$hotel_id."' AND room_id='".$room_id."' AND reserve_date='".$row->s_date."' LIMIT 1 "));
                    $main_data = $hotel_id.'||'.$room_id.'||3||'.$prRow->three_person.'||'.$row->s_date;
                    $g_three.='<td><div class="form-input"><input class="room-rate '.date('Md', strtotime($row->s_date)).'-'.$room_id.'-3" type="text" value="'.(!empty($nwRow)?$nwRow->three_person:$prRow->three_person).'" data-main="'.$main_data.'"></div></td>';
                }
            }
            
            $g_extra='';
            if($prRow->extra_bed > 0) {
                $g_extra='<td>Extra Bed US$ <button class="btn bg-black small qbulk" data-qbulk="'.$hotel_id.'||'.$room_id.'||'.$date_from.'||'.$date_to.'||4"></button></td>';
                foreach($myArr as $k=>$val) {
                    $row = (object) $val;
                    $nwRow  = $db->fetch_object($db->query("SELECT extra_bed FROM tbl_calendar_price WHERE hotel_id='".$hotel_id."' AND room_id='".$room_id."' AND reserve_date='".$row->s_date."' LIMIT 1 "));
                    $main_data = $hotel_id.'||'.$room_id.'||4||'.$prRow->extra_bed.'||'.$row->s_date;
                    $g_extra.='<td><div class="form-input"><input class="room-rate '.date('Md', strtotime($row->s_date)).'-'.$room_id.'-4" type="text" value="'.(!empty($nwRow)?$nwRow->extra_bed:$prRow->extra_bed).'" data-main="'.$main_data.'"></div></td>';
                }
            }

            echo json_encode(array('room_id'=>$room_id, 'guest_a'=>$g_one, 'guest_b'=>$g_two, 'guest_c'=>$g_three, 'guest_ex'=>$g_extra));
			break;

		case 'newRate':
			$rRow = explode('||', $_POST['data_main']);
			$nRate = addslashes($_POST['rate_new']);
			$hotel_id = !empty($rRow[0])?$rRow[0]:0;			
			$room_id  = !empty($rRow[1])?$rRow[1]:0;
			$room_typ = !empty($rRow[2])?$rRow[2]:0;
			$old_rate = !empty($rRow[3])?$rRow[3]:0;
			$reserve_date = !empty($rRow[4])?$rRow[4]:0;
					
			$mcount = $db->fetch_array($db->query("SELECT one_person, two_person, three_person, extra_bed FROM tbl_calendar_price WHERE hotel_id='".$hotel_id."' AND reserve_date='".$reserve_date."' AND room_id='".$room_id."' "));
			if(!empty($mcount)) {
				switch ($room_typ) {
					case '1': $mcount['one_person'] = ($nRate > 4)?$nRate:$old_rate; break;
					case '2': $mcount['two_person'] = ($nRate > 4)?$nRate:$old_rate; break;
					case '3': $mcount['three_person'] = ($nRate > 4)?$nRate:$old_rate; break;
					case '4': $mcount['extra_bed'] = $nRate; break;
				}			
				$newquery = http_build_query($mcount, '',', ');
				$sql = "UPDATE tbl_calendar_price SET hotel_id='".$hotel_id."', reserve_date='".$reserve_date."', room_id='".$room_id."', $newquery, added_by='".$session->get('u_id')."' WHERE hotel_id='".$hotel_id."' AND reserve_date='".$reserve_date."' AND room_id='".$room_id."' ";
				$db->query($sql);
			}
			else {				
				$prRow  = $db->fetch_array($db->query("SELECT one_person, two_person, three_person, extra_bed FROM tbl_roomapi_price WHERE room_id='".$room_id."' LIMIT 1 "));
				switch ($room_typ) {
					case '1': $prRow['one_person'] = ($nRate > 4)?$nRate:$old_rate; break;
					case '2': $prRow['two_person'] = ($nRate > 4)?$nRate:$old_rate; break;
					case '3': $prRow['three_person'] = ($nRate > 4)?$nRate:$old_rate; break;
					case '4': $prRow['extra_bed'] = $nRate; break;
				}			
				$newquery = http_build_query($prRow, '',', ');

				$sql = "INSERT tbl_calendar_price SET hotel_id='".$hotel_id."', reserve_date='".$reserve_date."', room_id='".$room_id."', $newquery, added_by='".$session->get('u_id')."' ";
				$db->query($sql);
			}

			$mRate = ($nRate > 4)?$nRate:$old_rate;
			if($room_typ==4) { $mRate = $nRate; }
			echo json_encode(array('room_rate'=>$mRate));
			break;

			case 'getmeRate':
				$rRow = explode('||', $_POST['data_main']);
				$act_type = !empty($rRow[0])?$rRow[0]:0;			
				$hotel_id = !empty($rRow[1])?$rRow[1]:0;			
				$room_id  = !empty($rRow[2])?$rRow[2]:0;
				$rev_date = !empty($rRow[3])?$rRow[3]:0;
				$dis_rate = !empty($rRow[4])?$rRow[4]:0;

				$prRow  = $db->fetch_object($db->query("SELECT one_person, two_person, three_person, extra_bed FROM tbl_roomapi_price WHERE room_id='".$room_id."' LIMIT 1 "));

				$mcount = $db->fetch_object($db->query("SELECT one_person, two_person, three_person, extra_bed FROM tbl_calendar_price WHERE hotel_id='".$hotel_id."' AND reserve_date='".$rev_date."' AND room_id='".$room_id."' LIMIT 1"));

				$res='';
				if(!empty($mcount)) {
					if($act_type=='MRP') {
						$res.=($mcount->one_person > 0)?'1 Guest US$ '.$mcount->one_person.'<br />':'';
                        $res.=($mcount->two_person > 0)?'2 Guest US$ '.$mcount->two_person.'<br />':'';
                        $res.=($mcount->three_person > 0)?'3 Guest US$ '.$mcount->three_person.'<br />':'';
                        $res.=($mcount->extra_bed > 0)?'Extra Bed US$ '.$mcount->extra_bed:'';
					}
					// For Discount
					if($act_type=='DIS') {
						$res.=($mcount->one_person > 0)?'1 Guest US$ '.round($mcount->one_person - ($mcount->one_person * $dis_rate) / 100).'<br />':'';
						$res.=($mcount->two_person > 0)?'2 Guest US$ '.round($mcount->two_person - ($mcount->two_person * $dis_rate) / 100).'<br />':'';
						$res.=($mcount->three_person > 0)?'3 Guest US$ '.round($mcount->three_person - ($mcount->three_person * $dis_rate) / 100).'<br />':'';
						$res.=($mcount->extra_bed > 0)?'Extra Bed US$ '.round($mcount->extra_bed - ($mcount->extra_bed * $dis_rate) / 100):'';
					}
				}
				else {
					if($act_type=='MRP') {
						$res.=($prRow->one_person > 0)?'1 Guest US$ '.$prRow->one_person.'<br />':'';
                        $res.=($prRow->two_person > 0)?'2 Guest US$ '.$prRow->two_person.'<br />':'';
                        $res.=($prRow->three_person > 0)?'3 Guest US$ '.$prRow->three_person.'<br />':'';
                        $res.=($prRow->extra_bed > 0)?'Extra Bed US$ '.$prRow->extra_bed:'';
					}
					// For Discount
					if($act_type=='DIS') {
						$res.=($prRow->one_person > 0)?'1 Guest US$ '.round($prRow->one_person - ($prRow->one_person * $dis_rate) / 100).'<br />':'';
						$res.=($prRow->two_person > 0)?'2 Guest US$ '.round($prRow->two_person - ($prRow->two_person * $dis_rate) / 100).'<br />':'';
						$res.=($prRow->three_person > 0)?'3 Guest US$ '.round($prRow->three_person - ($prRow->three_person * $dis_rate) / 100).'<br />':'';
						$res.=($prRow->extra_bed > 0)?'Extra Bed US$ '.round($prRow->extra_bed - ($prRow->extra_bed * $dis_rate) / 100):'';
					}
				}

				echo json_encode(array('res'=>$res));
				break;

			case 'bulkRate':
				$rRow = explode('||', $_POST['bulkpost']);
				$hotel_id = !empty($rRow[0])?$rRow[0]:0;
				$room_id  = !empty($rRow[1])?$rRow[1]:0;
				$date_from =  !empty($rRow[2])?$rRow[2] : date('Y-m-d');
	    		$date_to   =  !empty($rRow[3])?$rRow[3] : date('Y-m-d',strtotime("+20 days"));
	    		$room_type = !empty($rRow[4])?$rRow[4]:0;

				$res='<div class="frm-qbulk">
					<div class="form-group">
						<div class="col-sm-12 form-input">
							<label class="control-label">Date From</label>
							<input class="form-control date_from" type="text" name="from_date" value="'.$date_from.'" readonly>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-12 form-input">
							<label class="control-label">Date To</label>
							<input class="form-control date_to" type="text" name="to_date" value="'.$date_to.'" readonly>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-12 form-input">
							<label class="control-label">Room Rate</label>
							<input class="form-control bulk-rate" type="text" name="new_rate" value="5">
							<span class="error"></span>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-12 form-input"><br/>
							<button class="btn bg-blue medium btn-qbulk" data-hotel="'.$hotel_id.'" data-room="'.$room_id.'" data-pmax="'.$room_type.'">Save</button>
						</div>
					</div>
				</div>';
				echo $res;
				break;

			case 'bulkRoomprice':
				foreach($_POST as $k=>$v){ $$k=$v; }
				$resArr = array();
				if(!empty($hotel_id) AND !empty($room_id)) {					
					for($i = new DateTime( $date_from ); $i <= new DateTime( $date_to ); $i->modify('+1 day')) {
		                $reserve_date = $i->format("Y-m-d");
		                $mcount = $db->fetch_array($db->query("SELECT one_person, two_person, three_person, extra_bed FROM tbl_calendar_price WHERE hotel_id='".$hotel_id."' AND reserve_date='".$reserve_date."' AND room_id='".$room_id."' LIMIT 1"));
						if(!empty($mcount)) {
							switch ($room_type) {
								case '1': $mcount['one_person'] = ($room_rate > 4)?$room_rate:5; break;
								case '2': $mcount['two_person'] = ($room_rate > 4)?$room_rate:5; break;
								case '3': $mcount['three_person'] = ($room_rate > 4)?$room_rate:5; break;
								case '4': $mcount['extra_bed'] = $room_rate; break;
							}			
							$newquery = http_build_query($mcount, '',', ');
							$sql = "UPDATE tbl_calendar_price SET hotel_id='".$hotel_id."', reserve_date='".$reserve_date."', room_id='".$room_id."', $newquery, added_by='".$session->get('u_id')."' WHERE hotel_id='".$hotel_id."' AND reserve_date='".$reserve_date."' AND room_id='".$room_id."' ";
							$db->query($sql);
						}
						else {				
							$prRow  = $db->fetch_array($db->query("SELECT one_person, two_person, three_person, extra_bed FROM tbl_roomapi_price WHERE room_id='".$room_id."' LIMIT 1 "));
							switch ($room_type) {
								case '1': $prRow['one_person'] = ($room_rate > 4)?$room_rate:5; break;
								case '2': $prRow['two_person'] = ($room_rate > 4)?$room_rate:5; break;
								case '3': $prRow['three_person'] = ($room_rate > 4)?$room_rate:5; break;
								case '4': $prRow['extra_bed'] = $room_rate; break;
							}			
							$newquery = http_build_query($prRow, '',', ');

							$sql = "INSERT tbl_calendar_price SET hotel_id='".$hotel_id."', reserve_date='".$reserve_date."', room_id='".$room_id."', $newquery, added_by='".$session->get('u_id')."' ";
							$db->query($sql);
						}

						$mRate = ($room_rate > 4)?$room_rate:5;
						if($room_type==4) { $mRate = $room_rate; }
						$m_log = date('Md', strtotime($reserve_date)).'-'.$room_id.'-'.$room_type;
		            	$resArr[$m_log] = $mRate;
		            }
		        }
		        echo json_encode(array('res' => $resArr));
				break;
	}	


?>