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
        case "filterNearbyAttractions":
            $desId = addslashes($_REQUEST['destid']);
            $rec = Attractions::get_all_filterdata($desId);
            echo json_encode(array("action" => "success", "result" => $rec));
        break;

		case "add":	
			$record = new Hotelapi();	
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
						
			$record->user_id 			    = $_REQUEST['user_id'];
			$record->title 					= $_REQUEST['title'];
			$record->slug 		            = create_slug($_REQUEST['title']);
			$record->long_name 				= $_REQUEST['title'];
            $record->contact_no 			= $_REQUEST['contact_no'];
            $record->meet_contact_no 		= (!empty($_REQUEST['meet_contact_no'])) ? $_REQUEST['meet_contact_no'] : '';
            $record->res_contact_no 		= (!empty($_REQUEST['res_contact_no'])) ? $_REQUEST['res_contact_no'] : '';
			$record->email 		            = $_REQUEST['email'];
			$record->res_email 		        = (!empty($_REQUEST['res_email'])) ? $_REQUEST['res_email'] : '';
			$record->meet_email 		    = (!empty($_REQUEST['meet_email'])) ? $_REQUEST['meet_email'] : '';
			$record->star 		            = $_REQUEST['star'];
			$record->map 		            = $_REQUEST['map'];
			$record->brief 					= $_REQUEST['brief'];
			$record->restaurant            	= (!empty($_REQUEST['restaurant'])) ? $_REQUEST['restaurant'] : '';
			$record->cuisine            	= (!empty($_REQUEST['cuisine'])) ? $_REQUEST['cuisine'] : '';
			$record->breads            	= (!empty($_REQUEST['breads'])) ? $_REQUEST['breads'] : '';
			$record->cakes            	= (!empty($_REQUEST['cakes'])) ? $_REQUEST['cakes'] : '';
			$record->beverages            	= (!empty($_REQUEST['beverages'])) ? $_REQUEST['beverages'] : '';
			$record->whyus            	= (!empty($_REQUEST['whyus'])) ? $_REQUEST['whyus'] : '';
            $record->hotel_type             = (!empty($_REQUEST['hotel_type'])) ? $_REQUEST['hotel_type'] : '';
            $record->map_embed              = (!empty($_REQUEST['map_embed'])) ? $_REQUEST['map_embed'] : '';
            $record->cleaning               = (!empty($_REQUEST['cleaning'])) ? base64_encode(serialize($_REQUEST['cleaning'])) : '';
            $record->about_property         = (!empty($_REQUEST['about_property'])) ? $_REQUEST['about_property'] : '';
            $record->note                   = (!empty($_REQUEST['note'])) ? $_REQUEST['note'] : '';
            $record->imp_info               = (!empty($_REQUEST['imp_info'])) ? $_REQUEST['imp_info'] : '';
//			$record->faq 		            = $_REQUEST['faq'];
            $record->faq 		            = (!empty($_REQUEST['faq']))?base64_encode(serialize($_REQUEST['faq'])):'';
            $record->nearby_attractions 	= (!empty($_REQUEST['nearby_attractions']))?$_REQUEST['nearby_attractions']:'';
            $record->weddinghall 			= (!empty($_REQUEST['weddinghall']))?$_REQUEST['weddinghall']:'';
            $record->rest            		= (!empty($_REQUEST['rest'])) ? $_REQUEST['rest'] : '';
            $record->policy                 = (!empty($_REQUEST['policy'])) ? base64_encode(serialize($_REQUEST['policy'])) : '';
            $record->inquiry_email 		    = (!empty($_REQUEST['inquiry_email'])) ? $_REQUEST['inquiry_email'] : '';
//            $record->inquiry_type 		    = $_REQUEST['inquiry_type'];
            $record->street 				= $_REQUEST['street'];
//            $record->city 			        = $_REQUEST['city'];
//            $record->zone 			        = $_REQUEST['zone'];
//            $record->district 			    = $_REQUEST['district'];
//            $record->detail 				= $_REQUEST['detail'];
            $record->content 				= $_REQUEST['content'];
//            $record->website 				= $_REQUEST['website'];
            $record->destinationId 	        = $_REQUEST['destinationId'];
            $record->feature				= base64_encode(serialize($newArr));

            $record->hotel_rooms            = (!empty($_REQUEST['hotel_rooms'])) ? $_REQUEST['hotel_rooms'] : '';
            $record->customers_per_year     = (!empty($_REQUEST['customers_per_year'])) ? $_REQUEST['customers_per_year'] : '';
            $record->distance_to_center     = (!empty($_REQUEST['distance_to_center'])) ? $_REQUEST['distance_to_center'] : '';
            //$record->restaurants           = (!empty($_REQUEST['restaurants'])) ? $_REQUEST['restaurants'] : '';

            $record->ota_booking_com        = (!empty($_REQUEST['ota_booking_com'])) ? $_REQUEST['ota_booking_com'] : '';
            $record->ota_trip_advisor       = (!empty($_REQUEST['ota_trip_advisor'])) ? $_REQUEST['ota_trip_advisor'] : '';
            $record->ota_expedia            = (!empty($_REQUEST['ota_expedia'])) ? $_REQUEST['ota_expedia'] : '';
            $record->social_facebook        = (!empty($_REQUEST['social_facebook'])) ? $_REQUEST['social_facebook'] : '';
            $record->social_instagram       = (!empty($_REQUEST['social_instagram'])) ? $_REQUEST['social_instagram'] : '';
            $record->social_tiktok          = (!empty($_REQUEST['social_tiktok'])) ? $_REQUEST['social_tiktok'] : '';

            if(!empty($_REQUEST['payment_type'])) {
	            $record->payment_type 			= $_REQUEST['payment_type'];
	        }

	        if(!empty($_REQUEST['payment_type']) AND $_REQUEST['payment_type']=='4') {
	        	$record->merchant_id 		= !empty($_REQUEST['nmerchant_id'])?$_REQUEST['nmerchant_id']:'';
	        } else {
	        	$record->merchant_id 		= !empty($_REQUEST['merchant_id'])?$_REQUEST['merchant_id']:'';
	        }      

	        $record->merchant_key 		= !empty($_REQUEST['merchant_key'])?$_REQUEST['merchant_key']:'';

	        $record->nabil_mode 		= !empty($_REQUEST['nabil_mode'])?$_REQUEST['nabil_mode']:'';
	        $record->twpg_cert_file 	= !empty($_REQUEST['twpg_cert_file'])?$_REQUEST['twpg_cert_file']:'';
	        $record->twpg_key_file 		= !empty($_REQUEST['twpg_key_file'])?$_REQUEST['twpg_key_file']:'';

			$record->prop_code 		= !empty($_REQUEST['prop_code'])?$_REQUEST['prop_code']:'';

			$record->hotel_code 		= !empty($_REQUEST['hotel_code'])?$_REQUEST['hotel_code']:'';


//            $record->contact_person 	= $_REQUEST['contact_person'];
//            $record->contact_person_contact_no 	= $_REQUEST['contact_person_contact_no'];
//            $record->contact_person_email 		= $_REQUEST['contact_person_email'];

            
            $record->code      		= @randomKeys(6);
            
            /*$record->featured 		= $_REQUEST['featured'];
			$record->homepage 		= $_REQUEST['homepage'];
			$record->status					= $_REQUEST['status'];*/
			// $record->image 					= base64_encode(serialize(array_values(array_filter($_REQUEST['imageArrayname']))));
//			$record->logo			        = $_REQUEST['imageArrayname2'];
			$record->home_image			    = $_REQUEST['homeimageArrayname'];
			$record->banner_image			= $_REQUEST['imageArraynameBanner'];

			$record->detail_image			    = $_REQUEST['detailimageArrayname'];

			
			$record->added_date 			= registered();

			//checking duplicate propp_code
			$checkDupliName = Hotelapi::checkDupliName($_REQUEST['prop_code']);	
			if($checkDupliName):
				echo json_encode(array("action"=>"warning","message"=>"Property Code already exists."));		
				exit;		
			endif;

			$db->begin();
			$record_id  =   $record->save(); 

			$user_type  = $session->get('user_type');
			if($user_type=='hotel'){
				$session->set('user_hotel_id',$record_id);
			}        

			if($record_id): $db->commit();
				$message  = sprintf($GLOBALS['basic']['addedSuccess_'], "Property '".$record->title."'");
				echo json_encode(array("action"=>"success","message"=>$message));
				log_action($message,1,3);
			else: $db->rollback(); echo json_encode(array("action"=>"error","message"=>$GLOBALS['basic']['unableToSave']));
			endif;	
		break;
			
		case "edit":
			$record = Hotelapi::find_by_id($_REQUEST['idValue']);
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
			$record->user_id 			    = $_REQUEST['user_id'];			
			$record->title 					= $_REQUEST['title'];			
			$record->slug 		            = create_slug($_REQUEST['title']);
			$record->long_name 				= $_REQUEST['title'];
            $record->contact_no 			= $_REQUEST['contact_no'];
			$record->meet_contact_no 		= (!empty($_REQUEST['meet_contact_no'])) ? $_REQUEST['meet_contact_no'] : '';
            $record->res_contact_no 		= (!empty($_REQUEST['res_contact_no'])) ? $_REQUEST['res_contact_no'] : '';
			$record->email 		            = $_REQUEST['email'];
			$record->res_email 		        = (!empty($_REQUEST['res_email'])) ? $_REQUEST['res_email'] : '';
			$record->meet_email 		    = (!empty($_REQUEST['meet_email'])) ? $_REQUEST['meet_email'] : '';
			$record->star 		            = $_REQUEST['star'];
			$record->map 		            = $_REQUEST['map'];
			$record->brief 					= $_REQUEST['brief'];
			$record->restaurant            	= (!empty($_REQUEST['restaurant'])) ? $_REQUEST['restaurant'] : '';
			$record->cuisine            	= (!empty($_REQUEST['cuisine'])) ? $_REQUEST['cuisine'] : '';
			$record->breads            	= (!empty($_REQUEST['breads'])) ? $_REQUEST['breads'] : '';
			$record->cakes            	= (!empty($_REQUEST['cakes'])) ? $_REQUEST['cakes'] : '';
			$record->beverages            	= (!empty($_REQUEST['beverages'])) ? $_REQUEST['beverages'] : '';
			$record->whyus            	= (!empty($_REQUEST['whyus'])) ? $_REQUEST['whyus'] : '';
            $record->hotel_type             = (!empty($_REQUEST['hotel_type'])) ? $_REQUEST['hotel_type'] : '';
            $record->map_embed              = (!empty($_REQUEST['map_embed'])) ? $_REQUEST['map_embed'] : '';
            $record->cleaning               = (!empty($_REQUEST['cleaning'])) ? base64_encode(serialize($_REQUEST['cleaning'])) : '';
            $record->about_property         = (!empty($_REQUEST['about_property'])) ? $_REQUEST['about_property'] : '';
            $record->note                   = (!empty($_REQUEST['note'])) ? $_REQUEST['note'] : '';
            $record->imp_info               = (!empty($_REQUEST['imp_info'])) ? $_REQUEST['imp_info'] : '';
			$record->weddinghall 			= (!empty($_REQUEST['weddinghall']))?$_REQUEST['weddinghall']:'';
            //$record->restaurants 			= (!empty($_REQUEST['restaurants']))?$_REQUEST['restaurants']:'';
			
//			$record->faq 		            = $_REQUEST['faq'];
            $record->faq 		            = (!empty($_REQUEST['faq']))?base64_encode(serialize($_REQUEST['faq'])):'';
            $record->nearby_attractions 	= (!empty($_REQUEST['nearby_attractions']))?$_REQUEST['nearby_attractions']:'';
            $record->policy                 = (!empty($_REQUEST['policy'])) ? base64_encode(serialize($_REQUEST['policy'])) : '';
            $record->inquiry_email 		    = (!empty($_REQUEST['inquiry_email'])) ? $_REQUEST['inquiry_email'] : '';
//            $record->inquiry_type 		    = $_REQUEST['inquiry_type'];
            $record->street 				= $_REQUEST['street'];
//            $record->city 			        = $_REQUEST['city'];
//            $record->zone 			        = $_REQUEST['zone'];
//            $record->district 			    = $_REQUEST['district'];
//            $record->detail 				= $_REQUEST['detail'];
            $record->content 				= $_REQUEST['content'];
//            $record->website 				= $_REQUEST['website'];
            $record->destinationId 	        = $_REQUEST['destinationId'];
            $record->feature				= base64_encode(serialize($newArr));

            $record->hotel_rooms            = (!empty($_REQUEST['hotel_rooms'])) ? $_REQUEST['hotel_rooms'] : '';
            $record->customers_per_year     = (!empty($_REQUEST['customers_per_year'])) ? $_REQUEST['customers_per_year'] : '';
            $record->distance_to_center     = (!empty($_REQUEST['distance_to_center'])) ? $_REQUEST['distance_to_center'] : '';
            $record->rest            		= (!empty($_REQUEST['rest'])) ? $_REQUEST['rest'] : '';

            $record->ota_booking_com        = (!empty($_REQUEST['ota_booking_com'])) ? $_REQUEST['ota_booking_com'] : '';
            $record->ota_trip_advisor       = (!empty($_REQUEST['ota_trip_advisor'])) ? $_REQUEST['ota_trip_advisor'] : '';
            $record->ota_expedia            = (!empty($_REQUEST['ota_expedia'])) ? $_REQUEST['ota_expedia'] : '';
            $record->social_facebook        = (!empty($_REQUEST['social_facebook'])) ? $_REQUEST['social_facebook'] : '';
            $record->social_instagram       = (!empty($_REQUEST['social_instagram'])) ? $_REQUEST['social_instagram'] : '';
            $record->social_tiktok          = (!empty($_REQUEST['social_tiktok'])) ? $_REQUEST['social_tiktok'] : '';
			
			
			$record->prop_code 		= !empty($_REQUEST['prop_code'])?$_REQUEST['prop_code']:'';

			$record->hotel_code 		= !empty($_REQUEST['hotel_code'])?$_REQUEST['hotel_code']:'';



            if(!empty($_REQUEST['payment_type'])) {
	            $record->payment_type 			= $_REQUEST['payment_type'];
	        

    	        if(!empty($_REQUEST['payment_type']) AND $_REQUEST['payment_type']=='4') {
    	        	$record->merchant_id 		= !empty($_REQUEST['nmerchant_id'])?$_REQUEST['nmerchant_id']:'';
    	        } else {
    	        	$record->merchant_id 		= !empty($_REQUEST['merchant_id'])?$_REQUEST['merchant_id']:'';
    	        }      
    
    	        $record->merchant_key 		= !empty($_REQUEST['merchant_key'])?$_REQUEST['merchant_key']:'';
    
    	        $record->nabil_mode 		= !empty($_REQUEST['nabil_mode'])?$_REQUEST['nabil_mode']:'';
    	        $record->twpg_cert_file 	= !empty($_REQUEST['twpg_cert_file'])?$_REQUEST['twpg_cert_file']:'';
    	        $record->twpg_key_file 		= !empty($_REQUEST['twpg_key_file'])?$_REQUEST['twpg_key_file']:'';
            }
//            $record->contact_person 	                = $_REQUEST['contact_person'];
//            $record->contact_person_contact_no 			= $_REQUEST['contact_person_contact_no'];
//            $record->contact_person_email 				= $_REQUEST['contact_person_email'];
                      
            /*$record->featured 		= $_REQUEST['featured'];
			$record->homepage 		= $_REQUEST['homepage'];
			$record->status					= $_REQUEST['status'];*/
			// $record->image 					= base64_encode(serialize(array_values(array_filter($_REQUEST['imageArrayname']))));
//			$record->logo			        = $_REQUEST['imageArrayname2'];
            		$record->home_image			    = $_REQUEST['homeimageArrayname'];
           $record->banner_image			= $_REQUEST['imageArraynameBanner'];

		   $record->detail_image			    = $_REQUEST['detailimageArrayname'];


			//checking duplicate propp_code
			$checkDupliName = Hotelapi::checkDupliName($_REQUEST['prop_code'],$_REQUEST['user_id']);			
			if($checkDupliName):
				echo json_encode(array("action"=>"warning","message"=>"Property Code already exists."));		
				exit;		
			endif;



            		$db->begin();

			$user_type  = $session->get('user_type');
			if($user_type=='hotel'){
				$session->set('user_hotel_id',$record->id);
			}

			if($record->save()): $db->commit();			
			   $message  = sprintf($GLOBALS['basic']['changesSaved_'], "Property '".$record->title."'");
			   echo json_encode(array("action"=>"success","message"=>$message));
			   log_action("Property [".$record->title."] Edit Successfully",1,4);
			else: $db->rollback(); echo json_encode(array("action"=>"notice","message"=>$GLOBALS['basic']['noChanges']));
			endif;
		break;
			
		case "delete":
			$id = $_REQUEST['id'];
			$record = Hotelapi::find_by_id($id);
			log_action("Property  [".$record->title."]".$GLOBALS['basic']['deletedSuccess'],1,6);
			$db->query("DELETE FROM tbl_apihotel WHERE id='{$id}'");			
			$message  = sprintf($GLOBALS['basic']['deletedSuccess_'], "Property '".$record->title."'");
			echo json_encode(array("action"=>"success","message"=>$message));					
			log_action("Offers  [".$record->title."]".$GLOBALS['basic']['deletedSuccess'],1,6);
		break;
		
		// Module Setting Sections  >> <<
		case "toggleStatus":
			$id = $_REQUEST['id'];
			$record = Hotelapi::find_by_id($id);
			$record->status = ($record->status == 1) ? 0 : 1 ;
			$record->save();
			echo "";
		break;

		case "toggleFeatured":
			$id = $_REQUEST['id'];
			$record = Hotelapi::find_by_id($id);
			$record->featured = ($record->featured == 1) ? 0 : 1 ;
			$record->save();
			echo "";
		break;

		case "togglehome":
			$id = $_REQUEST['id'];
			$record = Hotelapi::find_by_id($id);
			$record->homepage = ($record->homepage == 1) ? 0 : 1 ;
			$record->save();
			echo "";
		break;
			
		case "bulkToggleStatus":
			$id = $_REQUEST['idArray'];
			$allid = explode("|", $id);
			$return = "0";
			for($i=1; $i<count($allid); $i++){
				$record = Hotelapi::find_by_id($allid[$i]);
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
				$record = Hotelapi::find_by_id($allid[$i]);
				log_action("Property  [".$record->title."]".$GLOBALS['basic']['deletedSuccess'],1,6);				
				$res = $db->query("DELETE FROM tbl_apihotel WHERE id='".$allid[$i]."'");				
				$return = 1;
			}
			if($res)$db->commit();else $db->rollback();
			reOrder("tbl_apihotel", "sortorder");
			
			if($return==1):
				$message  = sprintf($GLOBALS['basic']['deletedSuccess_bulk'], "Property"); 
				echo json_encode(array("action"=>"success","message"=>$message));
			else:
				echo json_encode(array("action"=>"error","message"=>$GLOBALS['basic']['noRecords']));
			endif;
		break;
			
		
		case "getdistrict":
			$parentId = $_REQUEST['parentOf'];
			$disId = $_REQUEST['disId'];
			$districtRec = Zonedestrict::getbyparent($parentId);
			$result='<option value="">Choose District</option>';
			if($districtRec){
				foreach($districtRec as $row){
					$sel = ($disId==$row->zone_district)?'selected':'';
					$result.='<option value="'.$row->zone_district.'" '.$sel.'>'.$row->zone_district.'</option> ';
				}
			}
			echo json_encode(array('result'=>$result));
		break;

		case "switch_hotel":
        $code = $_REQUEST['id'];
        $rowInfo    =  Hotelapi::find_by_code($code);
        $hotel_id   =  $rowInfo->id;
        $session->set('user_hotel_id',$hotel_id);
        echo json_encode(array('result'=>true));
		break;

		case "sort":			
			$id 	 = $_REQUEST['id']; 	// IS a line containing ids starting with : sortIds
			$sortIds = $_REQUEST['sortIds'];
			datatableReordering('tbl_apihotel', $sortIds, "sortorder", '','',1);
			$message  = sprintf($GLOBALS['basic']['sorted_'], "Page"); 
			echo json_encode(array("action"=>"success","message"=>$message));
		break;

		
	}
?>