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
			
			$Route = new Route();
			
			$Route->parent_id 	= $_REQUEST['parent_id'];
			$Route->title    	= $db->escape_value($_REQUEST['title']);
            $Route->image		= !empty($_REQUEST['imageArrayname']) ? $_REQUEST['imageArrayname'] : '';
            $Route->status		= $_REQUEST['status'];
            $record->added_by = !empty($session->get('u_id'))?$session->get('u_id'):0;
			$Route->sortorder	= Route::find_maximum_byparent("sortorder",$_REQUEST['parent_id']);
			$Route->added_date 	= registered();
			
			$checkDupliTitle = Route::checkDupliTitle($Route->title,$_REQUEST['parent_id']);			
			if($checkDupliTitle):
				echo json_encode(array("action"=>"warning","message"=>"Route Title Already Exists."));		
				exit;		
			endif;
			
			$db->begin();
			if($Route->save()): $db->commit();
			   $message  = sprintf($GLOBALS['basic']['addedSuccess_'], "Route Image '".$Route->title."'");
			echo json_encode(array("action"=>"success","message"=>$message));
				log_action("Route [".$Route->title."]".$GLOBALS['basic']['addedSuccess'],1,3);
			else: $db->rollback();
				echo json_encode(array("action"=>"error","message"=>$GLOBALS['basic']['unableToSave']));
			endif;				
		break;
		
		case "edit":			
			$Route = Route::find_by_id($_REQUEST['idValue']);					
			$checkDupliTitle = Route::checkDupliTitle($db->escape_value($_REQUEST['title']),$Route->parent_id,$Route->id);
			if($checkDupliTitle):
				echo json_encode(array("action"=>"warning","message"=>"Route Title is already exist."));		
				exit;		
			endif;

            $Route->parent_id 	= $_REQUEST['parent_id'];
			$Route->title    	= $db->escape_value($_REQUEST['title']);
            $Route->image		= !empty($_REQUEST['imageArrayname']) ? $_REQUEST['imageArrayname'] : '';
			$Route->status      = $_REQUEST['status'];

			$db->begin();				
			if($Route->save()):$db->commit();	
			   $message  = sprintf($GLOBALS['basic']['changesSaved_'], "Route '".$Route->title."'");
			   echo json_encode(array("action"=>"success","message"=>$message));
			   log_action("Route [".$Route->title."] Edit Successfully",1,4);
			else:$db->rollback();echo json_encode(array("action"=>"notice","message"=>$GLOBALS['basic']['noChanges']));
			endif;							
		break;
								
		case "delete":
			$id = $_REQUEST['id'];
			$record = Route::find_by_id($id);
			log_action("Route  [".$record->title."]".$GLOBALS['basic']['deletedSuccess'],1,6);
			$db->begin();
			$db->query("DELETE FROM tbl_route WHERE parent_id='{$id}'");
			$res = $db->query("DELETE FROM tbl_route WHERE id='{$id}'");
  		    if($res):$db->commit();	else: $db->rollback();endif;
			reOrder("tbl_route", "sortorder");						
			echo json_encode(array("action"=>"success","message"=>"Route  [".$record->title."]".$GLOBALS['basic']['deletedSuccess']));							
		break;
		
		case "toggleStatus":
			$id = $_REQUEST['id'];
			$record = Route::find_by_id($id);
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
				$record = Route::find_by_id($allid[$i]);
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
						$db->query("DELETE FROM tbl_route WHERE parent_id='".$allid[$i]."'");
				$res  = $db->query("DELETE FROM tbl_route WHERE id='".$allid[$i]."'");
				$return = 1;
			}
			if($res)$db->commit();else $db->rollback();
			reOrder("tbl_route", "sortorder");
			
			if($return==1):
			    $message  = sprintf($GLOBALS['basic']['deletedSuccess_bulk'], "Route"); 
				echo json_encode(array("action"=>"success","message"=>$message));
			else:
				echo json_encode(array("action"=>"error","message"=>$GLOBALS['basic']['noRecords']));
			endif;
		break;
				
		case "sort":
			$id 	 = $_REQUEST['id']; 	// IS a line containing ids starting with : sortIds
			$sortIds = $_REQUEST['sortIds'];
			$posId   = Route::field_by_id($id,'parent_id');
			datatableReordering('tbl_route', $sortIds, "sortorder", '', '',1);
			datatableReordering('tbl_route', $sortIds, "sortorder", "parent_id",$posId);
			$message  = sprintf($GLOBALS['basic']['sorted_'], "Route "); 
			echo json_encode(array("action"=>"success","message"=>$message));
		break;		
	}
?>