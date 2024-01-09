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
			$record = new Vehicle();

            $record->parent_id 	= $_REQUEST['parent_id'];
			$record->slug		= create_slug($_REQUEST['title']);
			$record->title 		= $_REQUEST['title'];
            $record->max_pax	= $_REQUEST['max_pax'];
            $record->reg_no     = (!empty($_REQUEST['reg_no'])) ? $_REQUEST['reg_no'] : '';
            $record->make_year  = (!empty($_REQUEST['make_year'])) ? $_REQUEST['make_year'] : '';
            $record->bill_book_image = serialize(array_values(array_filter($_REQUEST['imageBillArrayname'])));
            $record->image		= serialize(array_values(array_filter($_REQUEST['imageArrayname'])));
			$record->content	= $_REQUEST['content'];
			$record->status		= $_REQUEST['status'];
			$record->added_by = !empty($session->get('u_id'))?$session->get('u_id'):0;
			$record->sortorder	= Vehicle::find_maximum();
			$record->added_date = registered();
			
			$checkDupliName=Vehicle::checkDupliName($record->title);			
			if($checkDupliName):
				echo json_encode(array("action"=>"warning","message"=>"Vehicles Name Already Exists."));		
				exit;		
			endif;
			$db->begin();
			if($record->save()): $db->commit();
			$message  = sprintf($GLOBALS['basic']['addedSuccess_'], "Vehicle '".$record->title."'");
			echo json_encode(array("action"=>"success","message"=>$message));
			log_action($message,1,3);
			   //echo json_encode(array("action"=>"success","message"=>$GLOBALS['basic']['changesSaved']));
				//log_action("Vehicle [".$record->title."]".$GLOBALS['basic']['addedSuccess'],1,3);
			else: $db->rollback(); echo json_encode(array("action"=>"error","message"=>$GLOBALS['basic']['unableToSave']));
			endif;
		break;
			
		case "edit":
			$record = Vehicle::find_by_id($_REQUEST['idValue']);
			
			if($record->title!=$_REQUEST['title']){
				$checkDupliName=Vehicle::checkDupliName($_REQUEST['title']);
				if($checkDupliName):
					echo json_encode(array("action"=>"warning","message"=>"Vehicles title is already exist."));		
					exit;		
				endif;
			}

            $record->parent_id 	= $_REQUEST['parent_id'];
			$record->slug		= create_slug($_REQUEST['title']);
			$record->title 		= $_REQUEST['title'];
			$record->max_pax	= $_REQUEST['max_pax'];
            $record->reg_no     = (!empty($_REQUEST['reg_no'])) ? $_REQUEST['reg_no'] : '';
            $record->make_year  = (!empty($_REQUEST['make_year'])) ? $_REQUEST['make_year'] : '';
            $record->bill_book_image = serialize(array_values(array_filter($_REQUEST['imageBillArrayname'])));
			$record->image		= serialize(array_values(array_filter($_REQUEST['imageArrayname'])));	
			$record->content	= $_REQUEST['content'];
			$record->status		= $_REQUEST['status'];
			$db->begin();
			if($record->save()):$db->commit();
			   $message  = sprintf($GLOBALS['basic']['changesSaved_'], "Vehicle '".$record->title."'");
			   echo json_encode(array("action"=>"success","message"=>$message));
			   log_action($message,1,4);
			   //log_action("Vehicle [".$record->title."] Edit Successfully",1,4);
			else: $db->rollback();echo json_encode(array("action"=>"notice","message"=>$GLOBALS['basic']['noChanges']));
			endif;
		break;
			
		case "delete":
			$id = $_REQUEST['id'];
			$record = Vehicle::find_by_id($id);
			$db->begin();
            $db->query("DELETE FROM tbl_vehicle WHERE parent_id='{$id}'");
			$res = $db->query("DELETE FROM tbl_vehicle WHERE id='{$id}'");
			if($res):$db->commit();	else: $db->rollback();endif;
			reOrder("tbl_vehicle", "sortorder");
			$message  = sprintf($GLOBALS['basic']['deletedSuccess_'], "Vehicle '".$record->title."'");
			echo json_encode(array("action"=>"success","message"=>$message));	
			log_action("Vehicles  [".$record->title."]".$GLOBALS['basic']['deletedSuccess'],1,6);
		break;
		
		// Module Setting Sections  >> <<
		case "toggleStatus":
			$id = $_REQUEST['id'];
			$record = Vehicle::find_by_id($id);
			$record->status = ($record->status == 1) ? 0 : 1 ;
			$record->save();
			echo "";
		break;
			
		case "bulkToggleStatus":
			$id = $_REQUEST['idArray'];
			$allid = explode("|", $id);
			$return = "0";
			for($i=1; $i<count($allid); $i++){
				$record = Vehicle::find_by_id($allid[$i]);
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
				$res  = $db->query("DELETE FROM tbl_vehicle WHERE id='".$allid[$i]."'");
				$return = 1;
			}
			if($res)$db->commit();else $db->rollback();
			reOrder("tbl_vehicle", "sortorder");
			
			if($return==1):
			    $message  = sprintf($GLOBALS['basic']['deletedSuccess_bulk'], "Vehicle"); 
				echo json_encode(array("action"=>"success","message"=>$message));
			else:
				echo json_encode(array("action"=>"error","message"=>$GLOBALS['basic']['noRecords']));
			endif;
		break;
			
		case "sort":			
			$id 	 = $_REQUEST['id']; 	// IS a line containing ids starting with : sortIds
			$sortIds = $_REQUEST['sortIds'];
            $posId   = Vehicle::field_by_id($id,'parent_id');
			datatableReordering('tbl_vehicle', $sortIds, "sortorder", '','',1);
            datatableReordering('tbl_vehicle', $sortIds, "sortorder", "parent_id",$posId);
			$message  = sprintf($GLOBALS['basic']['sorted_'], "Vehicle"); 
			echo json_encode(array("action"=>"success","message"=>$message));
		break;
	}
?>