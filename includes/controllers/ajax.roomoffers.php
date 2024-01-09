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
		case "add":
			$record             = new Roomoffers();
            $record->slug       = create_slug($_REQUEST['title']);
            $record->title      = $_REQUEST['title'];
            // $record->date_from  = $_REQUEST['date_from'];
            // $record->date_to    = $_REQUEST['date_to'];
//			$record->currency			= $_REQUEST['currency'];
//			$record->price			    = $_REQUEST['price'];
//			$record->discount			= $_REQUEST['discount'];
//			$record->apply_for			= $_REQUEST['apply_for'];
//			$record->apply_id			= $_REQUEST['apply_id'];
//			$record->image			= $_REQUEST['imageArrayname'];
//			$record->linksrc 		= $_REQUEST['linksrc'];
//			$record->linktype 		= $_REQUEST['linktype'];
            $record->content    = $_REQUEST['content'];
			// $record->quick_info		= $_REQUEST['quick_info'];
            $record->status     = $_REQUEST['status'];
            // $record->homepage   = $_REQUEST['homepage'];
            $record->hotel_id   = $_REQUEST['hotel_id'];

            /*if (@$session->get('user_hotel_id') != '') {
                $record->hotel_id = $session->get('user_hotel_id');
            } else {
                echo json_encode(array("action" => "error", "message" => "No hotel has been selected"));
            }*/
			
			$record->sortorder		= Roomoffers::find_maximum();
			$record->added_date 	= registered();
            $record->meta_keywords  = $_REQUEST['meta_keywords'];
            $record->meta_description = $_REQUEST['meta_description'];
			
//			if(empty($_REQUEST['imageArrayname'])):
//				echo json_encode(array("action"=>"warning","message"=>"Required Upload Image !"));
//				exit;
//			endif;

            // $checkDupliName = Roomoffers::checkDupliName($record->title);
            // if($checkDupliName):
            //     echo json_encode(array("action" => "warning", "message" => "Title Already Exists."));
            //     exit;
            // endif;

            $db->begin();
            if ($record->save()): $db->commit();
                $message = sprintf($GLOBALS['basic']['addedSuccess_'], "Offer '" . $record->title . "'");
                echo json_encode(array("action" => "success", "message" => $message));
                log_action("Offer [" . $record->title . "]" . $GLOBALS['basic']['addedSuccess'], 1, 3);
            else: $db->rollback();
                echo json_encode(array("action" => "error", "message" => $GLOBALS['basic']['unableToSave']));
            endif;
		break;
			
		case "edit":
			$record = Roomoffers::find_by_id($_REQUEST['idValue']);

            // if ($record->title != $_REQUEST['title']) {
            //     $checkDupliName = Roomoffers::checkDupliName($_REQUEST['title']);
            //     if ($checkDupliName):
            //         echo json_encode(array("action" => "warning", "message" => "Title already exists."));
            //         exit;
            //     endif;
            // }

            $record->slug       = create_slug($_REQUEST['title']);
            $record->title      = $_REQUEST['title'];
            // $record->date_from  = $_REQUEST['date_from'];
            // $record->date_to    = $_REQUEST['date_to'];
//            $record->currency			= $_REQUEST['currency'];
//            $record->price			    = $_REQUEST['price'];
//			$record->discount			= $_REQUEST['discount'];
//			$record->apply_for			= $_REQUEST['apply_for'];
//			$record->apply_id			= $_REQUEST['apply_id'];
//			$record->linksrc 		= $_REQUEST['linksrc'];
//			$record->linktype 		= $_REQUEST['linktype'];
            $record->content    = $_REQUEST['content'];
//			$record->quick_info		= $_REQUEST['quick_info'];
            $record->status     = $_REQUEST['status'];
            // $record->homepage   = $_REQUEST['homepage'];
            $record->hotel_id   = $_REQUEST['hotel_id'];
            $record->meta_keywords = $_REQUEST['meta_keywords'];
            $record->meta_description = $_REQUEST['meta_description'];

//            if (@$session->get('user_hotel_id') == '') {
//                echo json_encode(array("action" => "error", "message" => "No hotel has been selected"));
//            }

            if (!empty($_REQUEST['imageArrayname'])):
                $record->image  = $_REQUEST['imageArrayname'];
            endif;

            $db->begin();
            if ($record->save()): $db->commit();
                $message = sprintf($GLOBALS['basic']['changesSaved_'], "Offer '" . $record->title . "'");
                echo json_encode(array("action" => "success", "message" => $message));
                log_action("Offer [" . $record->title . "] Edit Successfully", 1, 4);
            else: $db->rollback();
                echo json_encode(array("action" => "notice", "message" => $GLOBALS['basic']['noChanges']));
            endif;
		break;
			
		case "delete":
            $id         = $_REQUEST['id'];
            $record     = Roomoffers::find_by_id($id);
            log_action("Offer [" . $record->title . "]" . $GLOBALS['basic']['deletedSuccess'], 1, 6);
            $db->query("DELETE FROM tbl_roomapi_offers WHERE id='{$id}'");

            reOrder("tbl_roomapi_offers", "sortorder");

            $message    = sprintf($GLOBALS['basic']['deletedSuccess_'], "Offer '" . $record->title . "'");
            echo json_encode(array("action" => "success", "message" => $message));
            log_action("Offer [" . $record->title . "]" . $GLOBALS['basic']['deletedSuccess'], 1, 6);
		break;
		
		// Module Setting Sections  >> <<
		case "toggleStatus":
			$id             = $_REQUEST['id'];
			$record         = Roomoffers::find_by_id($id);
			$record->status = ($record->status == 1) ? 0 : 1 ;
			$record->save();
			echo "";
		break;
			
		case "bulkToggleStatus":
			$id         = $_REQUEST['idArray'];
			$allid      = explode("|", $id);
			$return     = "0";
            for ($i = 1; $i < count($allid); $i++) {
                $record         = Roomoffers::find_by_id($allid[$i]);
                $record->status = ($record->status == 1) ? 0 : 1;
                $record->save();
            }
			echo "";
		break;
			
		case "bulkDelete":
			$id         = $_REQUEST['idArray'];
			$allid      = explode("|", $id);
			$return     = "0";
			$db->begin();
            for ($i = 1; $i < count($allid); $i++) {
                $record = Roomoffers::find_by_id($allid[$i]);
                log_action("Offer [" . $record->title . "]" . $GLOBALS['basic']['deletedSuccess'], 1, 6);
                $res    = $db->query("DELETE FROM tbl_roomapi_offers WHERE id='" . $allid[$i] . "'");
                $return = 1;
            }
			if($res) $db->commit(); else $db->rollback();
			reOrder("tbl_roomapi_offers", "sortorder");

            if ($return == 1):
				$message  = sprintf($GLOBALS['basic']['deletedSuccess_bulk'], "Offers"); 
				echo json_encode(array("action"=>"success","message"=>$message));
			else:
				echo json_encode(array("action"=>"error","message"=>$GLOBALS['basic']['noRecords']));
			endif;
		break;

		case "sortOld":
			$id 	 = $_REQUEST['id']; 	// IS a line containing ids starting with : sortIds
			$sortIds = $_REQUEST['sortIds'];
			datatableReordering('tbl_roomapi_offers', $sortIds, "sortorder", '', '',1);
			$message  = sprintf($GLOBALS['basic']['sorted_'], "Offers"); 
			echo json_encode(array("action"=>"success","message"=>$message));
		break;

        case "sort":
            $id 	    = $_REQUEST['id']; 	// IS a line containing ids starting with : sortIds
            $sortIds    = $_REQUEST['sortIds'];
            $posId      = Roomoffers::field_by_id($id,'hotel_id');
            datatableReordering('tbl_roomapi_offers', $sortIds, "sortorder", 'hotel_id', $posId,1);
            $message    = sprintf($GLOBALS['basic']['sorted_'], "Offers");
            echo json_encode(array("action"=>"success","message"=>$message));
        break;

		case "change_apply_for":
			$session->start();
			$hotel_id = $session->get('user_hotel_id');

			$v = $_REQUEST['v'];
			$contents  ="";
			if($v=='room'){
			   $records = Roomapi::find_by_sql("SELECT * FROM tbl_roomapi WHERE hotel_id='$hotel_id' ORDER BY sortorder DESC ");	
				foreach($records as $key=>$record):	
                $contents  .=  "<option value='".$record->id."'>".$record->title."</option>";
                endforeach;
			}else if($v=='room_type'){
				$records = Roomtype::find_by_sql("SELECT * FROM tbl_roomtype WHERE hotel_id='$hotel_id' ORDER BY sortorder DESC ");
			    foreach($records as $key=>$record):	
                $contents  .=  "<option value='".$record->id."'>".$record->title."</option>";
                endforeach;
			}else{
			   $contents  =  "<option value='0'>All Room</option>";	
			}
			echo json_encode(array("action"=>"success","contents"=>$contents));
		break;
	}
?>