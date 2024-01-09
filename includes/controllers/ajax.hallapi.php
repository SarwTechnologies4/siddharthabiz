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
		
		/*********************** Add hall Section *************************/
		case "add":
			$record	= new Hallapi();            
			$newArr = array();
			$fparent = (isset($_REQUEST['fparent']) and !empty($_REQUEST['fparent']))?$_REQUEST['fparent']:'';
			$feature = (isset($_REQUEST['feature']) and !empty($_REQUEST['feature']))?$_REQUEST['feature']:'';
	
			if(!empty($fparent) and !empty($feature)){				
				foreach($fparent as $key=>$val){
					$final_fpt = !empty($fparent[$key])?$val['name']:'';
					$final_ft  = !empty($feature[$key])?$feature[$key]:'';
					$newArr[$key] = array('id'=>$key,'name'=>$final_fpt,'features'=>$final_ft);
				}
			}
			
			// if(@$session->get('user_hotel_id')!=''){	
			// $record->hall_id 			    = $session->get('user_hall_id');
	     	// }else{
	     	// echo json_encode(array("action"=>"error","message"=>"No hall has been selected"));
	     	// }
			
			$record->title 					= $_REQUEST['title'];
			$record->hotel_id 				= $_REQUEST['hotel_id'];
			$record->slug 		            = create_slug($_REQUEST['title']);
			$record->hall_type 				= (!empty($_REQUEST['hall_type']))?$_REQUEST['hall_type ']:'';
			$record->seat_a 				= (!empty($_REQUEST['seat_a']))?$_REQUEST['seat_a']:'';
			$record->seat_b 				= (!empty($_REQUEST['seat_b']))?$_REQUEST['seat_b']:'';
			$record->seat_c 				= (!empty($_REQUEST['seat_c']))?$_REQUEST['seat_c']:'';
			$record->seat_d 				= (!empty($_REQUEST['seat_d']))?$_REQUEST['seat_d']:'';
			$record->seat_e 				= (!empty($_REQUEST['seat_e']))?$_REQUEST['seat_e']:'';
			$record->seat_f 				= (!empty($_REQUEST['seat_f']))?$_REQUEST['seat_f']:'';
            $record->hall_size 				= $_REQUEST['hall_size'];
            $record->hall_size_label 		= $_REQUEST['hall_size_label'];
            // $record->smoking 				= $_REQUEST['smoking'];

			// $record->bed_type 				= $_REQUEST['bed_type'];

            // $record->single_bed 			= $_REQUEST['single_bed'];
            // $record->double_bed 			= $_REQUEST['double_bed'];
            // $record->large_double 			= $_REQUEST['large_double'];
            // $record->extra_large_double 	= $_REQUEST['extra_large_double'];
            // $record->bunk_bed 				= $_REQUEST['bunk_bed'];
            // $record->sofa_bed 				= $_REQUEST['sofa_bed'];
            // $record->futon_bed 				= $_REQUEST['futon_bed'];
            $record->detail 				= $_REQUEST['detail'];
            // $record->content 				= $_REQUEST['content'];
            $record->no_hall 				= $_REQUEST['no_hall'];
            $record->max_people 			= $_REQUEST['max_people'];
             $record->max_child 				= $_REQUEST['max_child'];
             $record->currency 				= $_REQUEST['currency'];
            $record->currency 				= 'USD';
            $record->extra_bed 				= (!empty($_REQUEST['extra_bed']))?$_REQUEST['extra_bed']:'';
			$record->status					= $_REQUEST['status'];
			$record->image 					= base64_encode(serialize(array_values(array_filter($_REQUEST['imageArrayname']))));
			$record->banner_image			= $_REQUEST['imageArrayname2'];
			$record->feature				= base64_encode(serialize($newArr));			
			$record->sortorder				= Hallapi::find_maximum("sortorder");								
			$record->added_date 			= registered();
            
			$result='1';			
			// if($record->save()){	
			//     $hallId  = $db->insert_id(); 
			
			// 	$pricehed	= !empty($_REQUEST['hall_price'])?$_REQUEST['hall_price']:"";
			// 	foreach($pricehed as $key=>$val){
			// 		$rec 				= new hallapiprice();
			// 		$rec->hall_id		= $hallId;
			// 		$rec->season_id		= $key;
			// 		$rec->one_person	= $val[0];
			// 		$rec->two_person	= $val[1];
			// 		$rec->three_person	= $val[2];
			// 		$rec->extra_bed	    = $val[3];
			// 		$rec->registered 	= registered();
			// 		$rec->save();
			//     }
			// 	$result=1;  				
		    // }
           
			$db->begin();
			if($record->save()): $db->commit();
				$message  = sprintf($GLOBALS['basic']['addedSuccess_'], "hall '".$record->title."'");
				echo json_encode(array("action"=>"success","message"=>$message));
				log_action($message,1,3);
			else: $db->rollback(); echo json_encode(array("action"=>"error","message"=>$GLOBALS['basic']['unableToSave']));
			endif;	
		break;
        
        //Edit hall
		case "edit":
			$record = Hallapi::find_by_id($_REQUEST['idValue']);
            
            $newArr = array();
			$fparent = (isset($_REQUEST['fparent']) and !empty($_REQUEST['fparent']))?$_REQUEST['fparent']:'';
			$feature = (isset($_REQUEST['feature']) and !empty($_REQUEST['feature']))?$_REQUEST['feature']:'';
	
			if(!empty($fparent) and !empty($feature)){				
				foreach($fparent as $key=>$val){
					$final_fpt = !empty($fparent[$key])?$val['name']:'';
					$final_ft  = !empty($feature[$key])?$feature[$key]:'';
					$newArr[$key] = array('id'=>$key,'name'=>$final_fpt,'features'=>$final_ft); 
				}
			}
			
			// if(@$session->get('user_hotel_id')==''){
	     	// echo json_encode(array("action"=>"error","message"=>"No hall has been selected"));
	     	// }
			$record->title 					= $_REQUEST['title'];
			$record->hotel_id 				= $_REQUEST['hotel_id'];
			$record->slug 		            = create_slug($_REQUEST['title']);
			$record->hall_type 				= (!empty($_REQUEST['hall_type ']))?$_REQUEST['hall_type ']:'';
			$record->seat_a 				= (!empty($_REQUEST['seat_a']))?$_REQUEST['seat_a']:'';
			$record->seat_b 				= (!empty($_REQUEST['seat_b']))?$_REQUEST['seat_b']:'';
			$record->seat_c 				= (!empty($_REQUEST['seat_c']))?$_REQUEST['seat_c']:'';
			$record->seat_d 				= (!empty($_REQUEST['seat_d']))?$_REQUEST['seat_d']:'';
			$record->seat_e 				= (!empty($_REQUEST['seat_e']))?$_REQUEST['seat_e']:'';
			$record->seat_f 				= (!empty($_REQUEST['seat_f']))?$_REQUEST['seat_f']:'';
            $record->hall_size 				= $_REQUEST['hall_size'];
            $record->hall_size_label 		= $_REQUEST['hall_size_label'];
            // $record->smoking 				= $_REQUEST['smoking'];

			// $record->bed_type 				= $_REQUEST['bed_type'];

            // $record->single_bed 			= $_REQUEST['single_bed'];
            // $record->double_bed 			= $_REQUEST['double_bed'];
            // $record->large_double 			= $_REQUEST['large_double'];
            // $record->extra_large_double 	= $_REQUEST['extra_large_double'];
            // $record->bunk_bed 				= $_REQUEST['bunk_bed'];
            // $record->sofa_bed 				= $_REQUEST['sofa_bed'];
            // $record->futon_bed 				= $_REQUEST['futon_bed'];
            $record->detail 				= $_REQUEST['detail'];
            // $record->content 				= $_REQUEST['content'];
            $record->no_hall 				= $_REQUEST['no_hall'];
            $record->max_people 			= $_REQUEST['max_people'];
             $record->max_child 				= $_REQUEST['max_child'];
//          $record->currency 				= $_REQUEST['currency'];
            $record->currency 				= 'USD';
            $record->extra_bed 				= (!empty($_REQUEST['extra_bed']))?$_REQUEST['extra_bed']:'';
			$record->status					= $_REQUEST['status'];
			$record->image 					= base64_encode(serialize(array_values(array_filter($_REQUEST['imageArrayname']))));
			$record->banner_image			= $_REQUEST['imageArrayname2'];
			$record->feature				= base64_encode(serialize($newArr));			
			$record->sortorder				= Hallapi::find_maximum("sortorder");								
			$record->added_date 			= registered();
            
			$result='1';			
			// if($record->save()){	
			//     $hallId  = $db->insert_id(); 
			// 	$pricehed	= !empty($_REQUEST['hall_price'])?$_REQUEST['hall_price']:"";
			// 	foreach($pricehed as $key=>$val){
			// 		$query = "UPDATE tbl_hallapi_price 
			// 				  SET 	
			// 				  one_person   = '$val[0]',
			// 				  two_person   = '$val[1]',
			// 				  three_person = '$val[2]',
			// 				  extra_bed    =  '$val[3]'
			// 				  WHERE 
			// 				  hall_id = $record->id 
			// 				  AND
			// 				  season_id = '$key' ";
			// 		$db->query($query);
			//     }
			// 	$result=1;  				
		    // }

			$db->begin();
			if($record->save()): $db->commit();
				$message  = sprintf($GLOBALS['basic']['changesSaved_'], "hall '".$record->title."'");
				echo json_encode(array("action"=>"success","message"=>$message));
				log_action($message,1,4);
			else: $db->rollback(); echo json_encode(array("action"=>"error","message"=>$GLOBALS['basic']['unableToSave']));
			endif;
		break;

		case "delete":
			$id = $_REQUEST['id'];
			$record = Hallapi::find_by_id($id);
			log_action("hall [".$record->title."]".$GLOBALS['basic']['deletedSuccess'],1,6);
			$db->begin();

			$db->query("DELETE FROM tbl_hall WHERE id='{$id}'");
			$res = $db->query("DELETE FROM tbl_hall WHERE hall_id='{$id}'");
  		    if($res):$db->commit();	else: $db->rollback();endif;
			reOrder("tbl_hall", "sortorder");						
			echo json_encode(array("action"=>"success","message"=>"hall [".$record->title."]".$GLOBALS['basic']['deletedSuccess']));							
		break;

		case "toggleStatus":
			$id = $_REQUEST['id'];
			$record = Hallapi::find_by_id($id);
			$record->status = ($record->status == 1) ? 0 : 1 ;
			$db->begin();						
				$res   =  $record->save();
				if($res):$db->commit();	else: $db->rollback();endif;
			echo "";
		break;

		case "bulkToggleStatus":
			$id = $_REQUEST['idArray'];
			$allid = explode("|", $id);
			$return = "0";
			for($i=1; $i<count($allid); $i++){
				$record = Hallapi::find_by_id($allid[$i]);
				$record->status = ($record->status == 1) ? 0 : 1 ;
				$record->save();
			}
			echo "";
		break;
			
		case "bulkDelete":
			$id = $_REQUEST['idArray'];
			$allid = explode("|", $id);
			$return = "0";
			$db->begin();
			for($i=1; $i<count($allid); $i++){
				$record = Hallapi::find_by_id($allid[$i]);
				$res  = $db->query("DELETE FROM tbl_hall WHERE hall_id='".$allid[$i]."'");				
				reOrderSub("tbl_hall", "sortorder");
				$return = 1;
			}
			if($res)$db->commit();else $db->rollback();

			if($return==1):
			    $message  = sprintf($GLOBALS['basic']['deletedSuccess_bulk'], "hall"); 
				echo json_encode(array("action"=>"success","message"=>$message));
			else:
				echo json_encode(array("action"=>"error","message"=>$GLOBALS['basic']['noRecords']));
			endif;
		break;

		

		/*case "gethallsdetails":
			$result='';
			$getdate = addslashes($_REQUEST['getdate']);
			$hallCat  = Subpackage::getPackage_limit(1);
	    	if($hallCat):
	    		foreach($hallCat as $hallRow){ 
	    			$rec = Subpackage::find_by_id($hallRow->id); 
	    			$nos = json_decode($rec->image, true);
	    			global $db;
	    			$sql = "SELECT ss.season,ss.date_from, ss.date_to, rp.one_person, rp.two_person, rp.three_person
	    					FROM 
	    					tbl_seasion AS ss
	    					INNER JOIN tbl_hall_price AS rp
	    					ON ss.id = rp.season_id
	    					WHERE ss.date_to>='$getdate' LIMIT 1";
	    			$dtResult = $db->query($sql);

	    			$sql2 = "SELECT rp.one_person, rp.two_person, rp.three_person
	    			 		FROM 
	    			 		tbl_hall_price AS rp
	    			 		WHERE rp.season_id='0' AND rp.hall_id= $rec->id LIMIT 1";
	    			$dfltResult = $db->query($sql2);
	    				
	    			$myArr='';
	    			if($db->num_rows($dtResult)>0){
	    				$myArr = $dtResult;
	    			}else{
	    				$myArr = $dfltResult;
	    			}

	    			$romprice = array();
	    			while ($row = $db->fetch_array($myArr)) {
	    				foreach($row as $key=>$val){$$key=$val;}
	    				$romprice = array(1=>$one_person,2=>$two_person,3=>$three_person);
	    			}
	    	  $result.='<div class="main_imgdiv">
	    					<img alt="'.$rec->title.'" src="'.IMAGE_PATH.'subpackage/'.$nos[0].'">
	    				</div>
	    				<div class="main_listing">';
	    				for($i=1; $i<=$rec->people_qnty; $i++){ 
					$result.='<ul>
							 	<li>'.$i.'</li>
							 	<li>'.$rec->currency.' '.$romprice[$i].'</li>
							 	<li>
								 	<select name="" id="" class="select-hall" data-person="'.$i.'" data-currency="'.$rec->currency.'" data-price="'.$romprice[$i].'"
                                    data-hall="'.$rec->title.'">
								 		<option value="0">0</option>';
				    					 for($j=1; $j<=$rec->no_halls; $j++){
				    						$result.='<option value="'.$j.'">'.$j.'</option>';
				    					} 
						  $result.='</select>
							 	</li>
							 	<li><span class="ind-total">0</span></li>
							</ul>
							<div class="clear"></div>';
						 } 								
				$result.='</div>
						<div class="clear"></div>';
    	  		 } 
			endif;

			echo json_encode(array("hallresult"=>$result));
		break;*/
	}
?>