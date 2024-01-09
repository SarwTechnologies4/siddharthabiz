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
			
			$Features = new Roomfeatures();
			
			$Features->parent_id 	= $_REQUEST['parent_id'];
			$Features->title    	= $db->escape_value($_REQUEST['title']);
			$Features->icon_class   = $_REQUEST['icon_class'];	
			$Features->image		= $_REQUEST['imageArrayname'];					
			$Features->status		= $_REQUEST['status'];
			$Features->sortorder	= Roomfeatures::find_maximum_byparent("sortorder",$_REQUEST['parent_id']);
			$Features->added_date 	= registered();
			
			$checkDupliTitle = Roomfeatures::checkDupliTitle($Features->title,$_REQUEST['parent_id']);			
			if($checkDupliTitle):
				echo json_encode(array("action"=>"warning","message"=>"Features Title Already Exists."));		
				exit;		
			endif;

			/*if(empty($_REQUEST['imageArrayname'])):				
				echo json_encode(array("action"=>"warning","message"=>"Required Upload Features Image!"));
				exit;					
			endif;*/
			
			$db->begin();
			if($Features->save()): $db->commit();
			   $message  = sprintf($GLOBALS['basic']['addedSuccess_'], "Features Image '".$Features->title."'");
			echo json_encode(array("action"=>"success","message"=>$message));
				log_action("Features [".$Features->title."]".$GLOBALS['basic']['addedSuccess'],1,3);
			else: $db->rollback();
				echo json_encode(array("action"=>"error","message"=>$GLOBALS['basic']['unableToSave']));
			endif;				
		break;
		
		case "edit":			
			$Features = Roomfeatures::find_by_id($_REQUEST['idValue']);					
			$checkDupliTitle = Roomfeatures::checkDupliTitle($db->escape_value($_REQUEST['title']),$Features->parent_id,$Features->id);
			if($checkDupliTitle):
				echo json_encode(array("action"=>"warning","message"=>"Features Title is already exist."));		
				exit;		
			endif;

			if(!empty($_REQUEST['imageArrayname'])):				
				$Features->image		= $_REQUEST['imageArrayname'];				
			endif;
            $Features->parent_id 	= $_REQUEST['parent_id'];
			$Features->title    	= $db->escape_value($_REQUEST['title']);	
			$Features->icon_class    = $_REQUEST['icon_class'];
			$Features->status        = $_REQUEST['status'];	

			$db->begin();				
			if($Features->save()):$db->commit();	
			   $message  = sprintf($GLOBALS['basic']['changesSaved_'], "Features '".$Features->title."'");
			   echo json_encode(array("action"=>"success","message"=>$message));
			   log_action("Features [".$Features->title."] Edit Successfully",1,4);
			else:$db->rollback();echo json_encode(array("action"=>"notice","message"=>$GLOBALS['basic']['noChanges']));
			endif;							
		break;
								
		case "delete":
			$id = $_REQUEST['id'];
			$record = Roomfeatures::find_by_id($id);
			log_action("Features  [".$record->title."]".$GLOBALS['basic']['deletedSuccess'],1,6);
			$db->begin();
			$db->query("DELETE FROM tbl_roomfeatures WHERE parent_id='{$id}'");
			$res = $db->query("DELETE FROM tbl_roomfeatures WHERE id='{$id}'");
  		    if($res):$db->commit();	else: $db->rollback();endif;
			reOrder("tbl_roomfeatures", "sortorder");						
			echo json_encode(array("action"=>"success","message"=>"Features  [".$record->title."]".$GLOBALS['basic']['deletedSuccess']));							
		break;
		
		case "toggleStatus":
			$id = $_REQUEST['id'];
			$record = Roomfeatures::find_by_id($id);
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
				$record = Roomfeatures::find_by_id($allid[$i]);
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
						$db->query("DELETE FROM tbl_roomfeatures WHERE parent_id='".$allid[$i]."'");
				$res  = $db->query("DELETE FROM tbl_roomfeatures WHERE id='".$allid[$i]."'");
				$return = 1;
			}
			if($res)$db->commit();else $db->rollback();
			reOrder("tbl_roomfeatures", "sortorder");
			
			if($return==1):
			    $message  = sprintf($GLOBALS['basic']['deletedSuccess_bulk'], "Features"); 
				echo json_encode(array("action"=>"success","message"=>$message));
			else:
				echo json_encode(array("action"=>"error","message"=>$GLOBALS['basic']['noRecords']));
			endif;
		break;
				
		case "sort":
			$id 	 = $_REQUEST['id']; 	// IS a line containing ids starting with : sortIds
			$sortIds = $_REQUEST['sortIds'];
			$posId   = Roomfeatures::field_by_id($id,'parent_id');
			datatableReordering('tbl_roomfeatures', $sortIds, "sortorder", '', '',1);
			datatableReordering('tbl_roomfeatures', $sortIds, "sortorder", "parent_id",$posId);
			$message  = sprintf($GLOBALS['basic']['sorted_'], "Features "); 
			echo json_encode(array("action"=>"success","message"=>$message));
		break;		
	}
?>