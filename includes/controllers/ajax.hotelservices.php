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
			
			$Services = new Hotelservices();
			
			$Services->parent_id 	= $_REQUEST['parent_id'];
			$Services->title    	= $db->escape_value($_REQUEST['title']);
			$Services->icon_class   = $_REQUEST['icon_class'];	
			//$Services->hotelid    	= $_REQUEST['hotelid'];
			$Services->image		= $_REQUEST['imageArrayname'];					
			$Services->status		= $_REQUEST['status'];
			$Services->sortorder	= Hotelservices::find_maximum_byparent("sortorder",$_REQUEST['parent_id']);
			$Services->added_date 	= registered();
			
			$checkDupliTitle = Hotelservices::checkDupliTitle($Services->title,$_REQUEST['parent_id']);			
			if($checkDupliTitle):
				echo json_encode(array("action"=>"warning","message"=>"Services Title Already Exists."));		
				exit;		
			endif;

			/*if(empty($_REQUEST['imageArrayname'])):				
				echo json_encode(array("action"=>"warning","message"=>"Required Upload Services Image!"));
				exit;					
			endif;*/
			
			$db->begin();
			if($Services->save()): $db->commit();
			   $message  = sprintf($GLOBALS['basic']['addedSuccess_'], "Services Image '".$Services->title."'");
			echo json_encode(array("action"=>"success","message"=>$message));
				log_action("Services [".$Services->title."]".$GLOBALS['basic']['addedSuccess'],1,3);
			else: $db->rollback();
				echo json_encode(array("action"=>"error","message"=>$GLOBALS['basic']['unableToSave']));
			endif;				
		break;
		
		case "edit":			
			$Services = Hotelservices::find_by_id($_REQUEST['idValue']);					
			$checkDupliTitle = Hotelservices::checkDupliTitle($db->escape_value($_REQUEST['title']),$Services->parent_id,$Services->id);
			if($checkDupliTitle):
				echo json_encode(array("action"=>"warning","message"=>"Services Title is already exist."));		
				exit;		
			endif;

			// if(!empty($_REQUEST['imageArrayname'])):				
			// 	$Services->image		= $_REQUEST['imageArrayname'];				
			// endif;	
			// pr($_REQUEST['imageArrayname']);
			$Services->image		= (!empty($_REQUEST['imageArrayname']))?$_REQUEST['imageArrayname']:'';			

			// $record->banner_image	= (empty($_REQUEST['imageArrayname2']))?$_REQUEST['imageArrayname2']:'';
			//$Services->hotelid    	= $_REQUEST['hotelid'];
			$Services->title    	= $db->escape_value($_REQUEST['title']);	
			$Services->icon_class    = $_REQUEST['icon_class'];
			$Services->status        = $_REQUEST['status'];	

			$db->begin();				
			if($Services->save()):$db->commit();	
			   $message  = sprintf($GLOBALS['basic']['changesSaved_'], "Services '".$Services->title."'");
			   echo json_encode(array("action"=>"success","message"=>$message));
			   log_action("Services [".$Services->title."] Edit Successfully",1,4);
			else:$db->rollback();echo json_encode(array("action"=>"notice","message"=>$GLOBALS['basic']['noChanges']));
			endif;							
		break;
								
		case "delete":
			$id = $_REQUEST['id'];
			$record = Hotelservices::find_by_id($id);
			log_action("Services  [".$record->title."]".$GLOBALS['basic']['deletedSuccess'],1,6);
			$db->begin();
			$db->query("DELETE FROM tbl_services WHERE parent_id='{$id}'");
			$res = $db->query("DELETE FROM tbl_services WHERE id='{$id}'");
  		    if($res):$db->commit();	else: $db->rollback();endif;
			reOrder("tbl_services", "sortorder");						
			echo json_encode(array("action"=>"success","message"=>"Services  [".$record->title."]".$GLOBALS['basic']['deletedSuccess']));							
		break;
		
		case "toggleStatus":
			$id = $_REQUEST['id'];
			$record = Hotelservices::find_by_id($id);
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
				$record = Hotelservices::find_by_id($allid[$i]);
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
						$db->query("DELETE FROM tbl_services WHERE parent_id='".$allid[$i]."'");
				$res  = $db->query("DELETE FROM tbl_services WHERE id='".$allid[$i]."'");
				$return = 1;
			}
			if($res)$db->commit();else $db->rollback();
			reOrder("tbl_services", "sortorder");
			
			if($return==1):
			    $message  = sprintf($GLOBALS['basic']['deletedSuccess_bulk'], "Services"); 
				echo json_encode(array("action"=>"success","message"=>$message));
			else:
				echo json_encode(array("action"=>"error","message"=>$GLOBALS['basic']['noRecords']));
			endif;
		break;
				
		case "sort":
			$id 	 = $_REQUEST['id']; 	// IS a line containing ids starting with : sortIds
			$sortIds = $_REQUEST['sortIds'];
			$posId   = Hotelservices::field_by_id($id,'parent_id');
			datatableReordering('tbl_services', $sortIds, "sortorder", '', '',1);
			datatableReordering('tbl_services', $sortIds, "sortorder", "parent_id",$posId);
			$message  = sprintf($GLOBALS['basic']['sorted_'], "Services "); 
			echo json_encode(array("action"=>"success","message"=>$message));
		break;		
	}
?>