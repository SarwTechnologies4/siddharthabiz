<?php 
	// Load the header files first
	header("Expires: 0"); 
	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); 
	header("cache-control: no-store, no-cache, must-revalidate"); 
	header("Pragma: no-cache");

	// Load necessary files then...
	require_once('../initialize.php');
	
	$action = $_REQUEST['action'];
	// pr($_REQUEST);
	switch($action) 
	{

        case "add":
            $record = new Review();

            if (@$session->get('review_hotel_id') != '') {
                $record->hotel_id = $session->get('review_hotel_id');
            } else {
                echo json_encode(array("action" => "error", "message" => "No hotel has been selected"));
            }

            // $record->review_hotel_id= $_REQUEST['review_hotel_id'];
            $record->title 		    = $_REQUEST['title'];
//            $record->hotel_id       = $_REQUEST['hotel_id'];
            $record->review	        = $_REQUEST['review'];
			// $record->banner_image	= (empty($_REQUEST['imageArrayname2']))?$_REQUEST['imageArrayname2']:'';
			$record->name	        = $_REQUEST['name'];
            $record->email	        = $_REQUEST['email'];
            $record->country	        = $_REQUEST['country'];
            $record->subject	        = $_REQUEST['subject'];
			// $record->message	        = $_REQUEST['message'];
            $record->rating	        = $_REQUEST['rating'];




            $record->status			= $_REQUEST['status'];
            $record->sortorder		= Review::find_maximum();
            $record->added_date 	= registered();

            $db->begin();
            if ($record->save()): $db->commit();
                $message = sprintf($GLOBALS['basic']['addedSuccess_'], "Review '" . $record->title . "'");
                echo json_encode(array("action" => "success", "message" => $message));
                log_action("Review [" . $record->title . "]" . $GLOBALS['basic']['addedSuccess'], 1, 3);
            else: $db->rollback();
                echo json_encode(array("action" => "error", "message" => $GLOBALS['basic']['unableToSave']));
            endif;
        break;

        case "edit":
            $record = Review::find_by_id($_REQUEST['idValue']);

            if (@$session->get('review_hotel_id') == '') {
                echo json_encode(array("action" => "error", "message" => "No hotel has been selected"));
            }

			// $record->review_hotel_id		= $_REQUEST['review_hotel_id'];
            $record->title 		    = $_REQUEST['title'];
//            $record->hotel_id       = $_REQUEST['hotel_id'];
            $record->review	        = $_REQUEST['review'];
			// $record->banner_image	= (empty($_REQUEST['imageArrayname2']))?$_REQUEST['imageArrayname2']:'';
			// $record->banner_image = $_REQUEST['imageArrayname2'];
			$record->name	        = $_REQUEST['name'];
            $record->email	        = $_REQUEST['email'];
            $record->country 	= (!empty($_REQUEST['country']))?$_REQUEST['country']:'';;
            $record->subject	        = (!empty($_REQUEST['subject']))?$_REQUEST['subject']:'';
			// $record->message	        = $_REQUEST['message'];
            $record->rating	        = $_REQUEST['rating'];
            $record->status			= $_REQUEST['status'];

            $db->begin();
            if ($record->save()): $db->commit();
                $message = sprintf($GLOBALS['basic']['changesSaved_'], "Review '" . $record->title . "'");
                echo json_encode(array("action" => "success", "message" => $message));
                log_action("Review [" . $record->title . "] Edit Successfully", 1, 4);
            else: $db->rollback();
                echo json_encode(array("action" => "notice", "message" => $GLOBALS['basic']['noChanges']));
            endif;
        break;

		case "delete":
			$id         = $_REQUEST['id'];
			$record     = Review::find_by_id($id);
			$title      = $record->title;
			$db->begin();
			$res        = $db->query("DELETE FROM tbl_review WHERE id='{$id}'");
			if($res)$db->commit();else $db->rollback();
			reOrder("tbl_review", "sortorder");
			
			$message  = sprintf($GLOBALS['basic']['deletedSuccess_'], "Review '".$title."'");
			echo json_encode(array("action"=>"success","message"=>$message));					
			log_action("Review  [".$title."]".$GLOBALS['basic']['deletedSuccess'],1,6);
		break;

		case "usereview":
            $record = new Review();

            if (@$session->get('review_hotel_id') == '') {
                echo json_encode(array("action" => "error", "message" => "No hotel has been selected"));
            }

			// $record->review_hotel_id		= $_REQUEST['review_hotel_id'];
            $record->title 		    = $_REQUEST['title'];
            $record->hotel_id       = $_REQUEST['hotel_id'];
            $record->user_id       = $_REQUEST['user_id'];
            $record->review	        = $_REQUEST['review'];
			// !(empty($_REQUEST['imageArrayname2'])) ? ($record->banner_image	= $_REQUEST['imageArrayname2']): ($record->banner_image	= '');
			$record->name	        = $_REQUEST['name'];
            $record->email	        = $_REQUEST['email'];
			$record->country 	= (!empty($_REQUEST['country']))?$_REQUEST['country']:'';
            $record->subject	        = (!empty($_REQUEST['subject']))?$_REQUEST['subject']:'';
			// $record->message	        = $_REQUEST['message'];
            $record->rating	        = $_REQUEST['rating'];
            $record->status			= $_REQUEST['status'];
			$record->added_date 	= registered();
			$record->sortorder		= Review::find_maximum();

            $db->begin();
            if ($record->save()): $db->commit();
                $message = sprintf($GLOBALS['basic']['changesSaved_'], "'" . $record->title . "'");
                echo json_encode(array("action" => "success", "message" => "your review has been posted"));
                log_action($message, 1, 4);
            else: $db->rollback();
                echo json_encode(array("action" => "notice", "message" => $GLOBALS['basic']['noChanges']));
            endif;
        break;
		
		// Module Setting Sections  >> <<
		case "toggleStatus":
			$id = $_REQUEST['id'];
			$record = Review::find_by_id($id);
			$record->status = ($record->status == 1) ? 0 : 1 ;
			$record->save();
			echo "";
		break;
			
		case "bulkToggleStatus":
			$id = $_REQUEST['idArray'];
			$allid = explode("|", $id);
			$return = "0";
			for($i=1; $i<count($allid); $i++){
				$record = Review::find_by_id($allid[$i]);
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
				$record = Review::find_by_id($allid[$i]);
				log_action("Review  [".$record->title."]".$GLOBALS['basic']['deletedSuccess'],1,6);				
				$res = $db->query("DELETE FROM tbl_review WHERE id='".$allid[$i]."'");				
				$return = 1;
			}
			if($res)$db->commit();else $db->rollback();
			reOrder("tbl_review", "sortorder");
			
			if($return==1):
				$message  = sprintf($GLOBALS['basic']['deletedSuccess_bulk'], "Review"); 
				echo json_encode(array("action"=>"success","message"=>$message));
			else:
				echo json_encode(array("action"=>"error","message"=>$GLOBALS['basic']['noRecords']));
			endif;
		break;
			
		case "sort":
			$id 	= $_REQUEST['id']; 	// IS a line containing ids starting with : sortIds
//			$order	= ($_REQUEST['toPosition']==1)?0:$_REQUEST['toPosition'];// IS a line containing sortorder
//			$db->query("UPDATE tbl_review SET sortorder=".$order." WHERE id=".$id." ");
//			reOrder("tbl_review", "sortorder");
            $sortIds = $_REQUEST['sortIds'];
            $record = Review::find_by_id($id);
            datatableReordering('tbl_review', $sortIds, "sortorder", 'hotel_id', $record->hotel_id, 1);
			$message  = sprintf($GLOBALS['basic']['sorted_'], "Review"); 
			echo json_encode(array("action"=>"success","message"=>$message));
		break;

		case "setUserHotelId" :
			$session->set('review_hotel_id', $_REQUEST['review_hotel_id']);
			echo json_encode(array("action"=>"success","message"=>"User hotel updated successfully"));
			break;
	}
?>