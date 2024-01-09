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
			$record = new Roomtype();	
			if(@$session->get('user_hotel_id')!=''){	
			 $record->hotel_id 			    = $session->get('user_hotel_id');
	     	}else{
	     	// echo json_encode(array("action"=>"error","message"=>"No hotel has been selected"));
	     	}
       
			$record->title 		    = $_REQUEST['title'];
			$record->slug 		    = create_slug($_REQUEST['title']);
			// $record->description	= $_REQUEST['description'];
			$record->status 		= $_REQUEST['status'];
			
			$record->sortorder		= Roomtype::find_maximum();
			$record->added_date 	= registered();
						
			$db->begin();
			if($record->save()): $db->commit();
			   $message  = sprintf($GLOBALS['basic']['addedSuccess_'], "Room type '".$record->title."'");
			echo json_encode(array("action"=>"success","message"=>$message));
				log_action("Roomtype [".$record->title."]".$GLOBALS['basic']['addedSuccess'],1,3);
			else: $db->rollback();
				echo json_encode(array("action"=>"error","message"=>$GLOBALS['basic']['unableToSave']));
			endif;
		break;
			
		case "edit":
			$record = Roomtype::find_by_id($_REQUEST['idValue']);			
			$record->title 		    = $_REQUEST['title'];
			$record->slug 		    = create_slug($_REQUEST['title']);
			// $record->description	= $_REQUEST['description'];
			$record->status 		= $_REQUEST['status'];

			if(@$session->get('user_hotel_id')==''){
	     	// echo json_encode(array("action"=>"error","message"=>"No hotel has been selected"));
	     	}
            
			$db->begin();
			if($record->save()): $db->commit();
			   $message  = sprintf($GLOBALS['basic']['changesSaved_'], "Room type '".$record->title."'");
			   echo json_encode(array("action"=>"success","message"=>$message));
			   log_action("Roomtype [".$record->title."] Edit Successfully",1,4);
			else: $db->rollback(); echo json_encode(array("action"=>"notice","message"=>$GLOBALS['basic']['noChanges']));
			endif;
		break;
			
		case "delete":
			$id = $_REQUEST['id'];
			$record = Roomtype::find_by_id($id);
			log_action("Roomtype  [".$record->title."]".$GLOBALS['basic']['deletedSuccess'],1,6);
			$db->query("DELETE FROM tbl_roomtype WHERE id='{$id}'");
			
			reOrder("tbl_roomtype", "sortorder");			
			
			$message  = sprintf($GLOBALS['basic']['deletedSuccess_'], "Room type '".$record->title."'");
			echo json_encode(array("action"=>"success","message"=>$message));					
			log_action("Room type  [".$record->title."]".$GLOBALS['basic']['deletedSuccess'],1,6);
		break;
		
		// Module Setting Sections  >> <<
		case "toggleStatus":
			$id = $_REQUEST['id'];
			$record = Roomtype::find_by_id($id);
			$record->status = ($record->status == 1) ? 0 : 1 ;
			$record->save();
			echo "";
		break;
			
		case "bulkToggleStatus":
			$id = $_REQUEST['idArray'];
			$allid = explode("|", $id);
			$return = "0";
			for($i=1; $i<count($allid); $i++){
				$record = Roomtype::find_by_id($allid[$i]);
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
				$record = Roomtype::find_by_id($allid[$i]);
				log_action("Roomtype  [".$record->title."]".$GLOBALS['basic']['deletedSuccess'],1,6);				
				$res = $db->query("DELETE FROM tbl_roomtype WHERE id='".$allid[$i]."'");				
				$return = 1;
			}
			if($res)$db->commit();else $db->rollback();
			reOrder("tbl_roomtype", "sortorder");
			
			if($return==1):
				$message  = sprintf($GLOBALS['basic']['deletedSuccess_bulk'], "Room type"); 
				echo json_encode(array("action"=>"success","message"=>$message));
			else:
				echo json_encode(array("action"=>"error","message"=>$GLOBALS['basic']['noRecords']));
			endif;
		break;
			
		case "sort":
			$id 	= $_REQUEST['id']; 	// IS a line containing ids starting with : sortIds
			$order	= ($_REQUEST['toPosition']==1)?0:$_REQUEST['toPosition'];// IS a line containing sortorder
			
			$db->query("UPDATE tbl_roomtype SET sortorder=".$order." WHERE id=".$id." ");
			
			reOrder("tbl_roomtype", "sortorder");
			$message  = sprintf($GLOBALS['basic']['sorted_'], "Room type"); 
			echo json_encode(array("action"=>"success","message"=>$message));
		break;
	}
?>