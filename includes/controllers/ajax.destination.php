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
			$record = new Destination();
			
			$record->slug 		= create_slug($_REQUEST['title']);
			$record->title 		= $_REQUEST['title'];
			/*$record->title_brief	= $_REQUEST['title_brief'];*/
			$record->image		= $_REQUEST['imageArrayname'];			
			if(!empty($_REQUEST['galleryArrayname'])){
				$record->gallery 		= serialize(array_values(array_filter($_REQUEST['galleryArrayname'])));
			}		
			$record->content	= $_REQUEST['content'];
			$record->status		= $_REQUEST['status'];
			$record->meta_keywords		= $_REQUEST['meta_keywords'];
			$record->meta_description	= $_REQUEST['meta_description'];
			$record->sortorder	= Destination::find_maximum();
			$record->added_date = registered();
			
			$checkDupliName=Destination::checkDupliName($record->title);			
			if($checkDupliName):
				echo json_encode(array("action"=>"warning","message"=>"Destination Title Already Exists."));		
				exit;		
			endif;
			$db->begin();
			if($record->save()): $db->commit();
			$message  = sprintf($GLOBALS['basic']['addedSuccess_'], "Destination '".$record->title."'");
			echo json_encode(array("action"=>"success","message"=>$message));
			log_action($message,1,3);
			   //echo json_encode(array("action"=>"success","message"=>$GLOBALS['basic']['changesSaved']));
				//log_action("Destination [".$record->title."]".$GLOBALS['basic']['addedSuccess'],1,3);
			else: $db->rollback(); echo json_encode(array("action"=>"error","message"=>$GLOBALS['basic']['unableToSave']));
			endif;
		break;
			
		case "edit":
			$record = Destination::find_by_id($_REQUEST['idValue']);
			
			if($record->title!=$_REQUEST['title']){
				$checkDupliName=Destination::checkDupliName($_REQUEST['title']);
				if($checkDupliName):
					echo json_encode(array("action"=>"warning","message"=>"Destination title is already exist."));		
					exit;		
				endif;
			}
			
			$record->slug 		= create_slug($_REQUEST['title']);
			$record->title 		= $_REQUEST['title'];
			/*$record->title_brief	= $_REQUEST['title_brief'];*/
			$record->image		= $_REQUEST['imageArrayname'];
			if(!empty($_REQUEST['galleryArrayname'])){
				$record->gallery 		= serialize(array_values(array_filter($_REQUEST['galleryArrayname'])));
			}
			$record->content	= $_REQUEST['content'];
			$record->status		= $_REQUEST['status'];
			$record->meta_keywords		= $_REQUEST['meta_keywords'];
			$record->meta_description	= $_REQUEST['meta_description'];
			$db->begin();
			if($record->save()):$db->commit();
			   $message  = sprintf($GLOBALS['basic']['changesSaved_'], "Destination '".$record->title."'");
			   echo json_encode(array("action"=>"success","message"=>$message));
			   log_action($message,1,4);
			   //log_action("Destination [".$record->title."] Edit Successfully",1,4);
			else: $db->rollback();echo json_encode(array("action"=>"notice","message"=>$GLOBALS['basic']['noChanges']));
			endif;
		break;
			
		case "delete":
			$id = $_REQUEST['id'];
			$record = Destination::find_by_id($id);
			$db->begin();
			$res = $db->query("DELETE FROM tbl_destination WHERE id='{$id}'");
			if($res):$db->commit();	else: $db->rollback();endif;
			reOrder("tbl_destination", "sortorder");
			$message  = sprintf($GLOBALS['basic']['deletedSuccess_'], "Destination '".$record->title."'");
			echo json_encode(array("action"=>"success","message"=>$message));	
			log_action("Destination  [".$record->title."]".$GLOBALS['basic']['deletedSuccess'],1,6);
		break;
		
		// Module Setting Sections  >> <<
		case "toggleStatus":
			$id = $_REQUEST['id'];
			$record = Destination::find_by_id($id);
			$record->status = ($record->status == 1) ? 0 : 1 ;
			$record->save();
			echo "";
		break;
			
		case "bulkToggleStatus":
			$id = $_REQUEST['idArray'];
			$allid = explode("|", $id);
			$return = "0";
			for($i=1; $i<count($allid); $i++){
				$record = Destination::find_by_id($allid[$i]);
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
				$res  = $db->query("DELETE FROM tbl_destination WHERE id='".$allid[$i]."'");
				$return = 1;
			}
			if($res)$db->commit();else $db->rollback();
			reOrder("tbl_destination", "sortorder");
			
			if($return==1):
			    $message  = sprintf($GLOBALS['basic']['deletedSuccess_bulk'], "Destination"); 
				echo json_encode(array("action"=>"success","message"=>$message));
			else:
				echo json_encode(array("action"=>"error","message"=>$GLOBALS['basic']['noRecords']));
			endif;
		break;
			
		case "sort":			
			$id 	 = $_REQUEST['id']; 	// IS a line containing ids starting with : sortIds
			$sortIds = $_REQUEST['sortIds'];
			datatableReordering('tbl_destination', $sortIds, "sortorder", '','',1);
			$message  = sprintf($GLOBALS['basic']['sorted_'], "Destination"); 
			echo json_encode(array("action"=>"success","message"=>$message));
		break;


        case "addAttraction":
            $record             = new Attractions();

            $record->destination_id = $_REQUEST['destination_id'];
            $record->title          = $_REQUEST['title'];
            $record->slug           = create_slug($_REQUEST['title']);
			$record->image			= $_REQUEST['imageArrayname'];
            $record->content        = $_REQUEST['content'];
            $record->status         = $_REQUEST['status'];
            $record->sortorder      = Attractions::find_maximum_byparent("sortorder", $_REQUEST['destination_id']);

            $record->meta_keywords		= $_REQUEST['meta_keywords'];
            $record->meta_description	= $_REQUEST['meta_description'];

            /*if(empty($_REQUEST['imageArrayname'])):
                echo json_encode(array("action"=>"warning","message"=>"Required Upload Image !"));
                exit;
            endif;*/

            $db->begin();
            if ($record->save()): $db->commit();
                $message = sprintf($GLOBALS['basic']['addedSuccess_'], "Attraction '" . $record->title . "'");
                echo json_encode(array("action" => "success", "message" => $message));
            else: $db->rollback();
                echo json_encode(array("action" => "error", "message" => $GLOBALS['basic']['unableToSave']));
            endif;
        break;

        case "editAttraction":
            $record = Attractions::find_by_id($_REQUEST['idValue']);

            $record->destination_id = $_REQUEST['destination_id'];
            $record->title          = $_REQUEST['title'];
            $record->slug           = create_slug($_REQUEST['title']);
			$record->image			= $_REQUEST['imageArrayname'];
            $record->content        = $_REQUEST['content'];
            $record->status         = $_REQUEST['status'];

            $record->meta_keywords		= $_REQUEST['meta_keywords'];
            $record->meta_description	= $_REQUEST['meta_description'];

            $db->begin();
            if ($record->save()): $db->commit();
                $message = sprintf($GLOBALS['basic']['changesSaved_'], "Attraction '" . $record->title . "'");
                echo json_encode(array("action" => "success", "message" => $message));
            else: $db->rollback();
                echo json_encode(array("action" => "notice", "message" => $GLOBALS['basic']['noChanges']));
            endif;
        break;

        case "deleteAttraction":
            $id             = $_REQUEST['id'];
            $record         = Attractions::find_by_id($id);
            log_action("Attraction [" . $record->title . "]" . $GLOBALS['basic']['deletedSuccess'], 1, 6);
            $db->begin();

            $res = $db->query("DELETE FROM tbl_attractions WHERE id='{$id}'");
            if ($res):$db->commit();
            else: $db->rollback();endif;
            reOrder("tbl_attractions", "sortorder");
            echo json_encode(array("action" => "success", "message" => "Attraction [" . $record->title . "]" . $GLOBALS['basic']['deletedSuccess']));
        break;

        case "SubitoggleStatus":
            $id         = $_REQUEST['id'];
            $record     = Attractions::find_by_id($id);
            $record->status = ($record->status == 1) ? 0 : 1;
            $db->begin();
            $res        = $record->save();
            if ($res):$db->commit();
            else: $db->rollback();endif;
            echo "";
        break;

        case "subibulkToggleStatus":
            $id             = $_REQUEST['idArray'];
            $allid          = explode("|", $id);
            $return         = "0";
            for ($i = 1; $i < count($allid); $i++) {
                $record         = Attractions::find_by_id($allid[$i]);
                $record->status = ($record->status == 1) ? 0 : 1;
                $record->save();
            }
            echo "";
        break;

        case "subibulkDelete":
            $id = $_REQUEST['idArray'];
            $allid = explode("|", $id);
            $return = "0";
            $db->begin();
            for ($i = 1; $i < count($allid); $i++) {
                $record = Attractions::find_by_id($allid[$i]);
                $res = $db->query("DELETE FROM tbl_attractions WHERE id='" . $allid[$i] . "'");
                reOrderSub("tbl_attractions", "sortorder", "destination_id", $record->destination_id);
                $return = 1;
            }
            if ($res) $db->commit(); else $db->rollback();

            if ($return == 1):
                $message = sprintf($GLOBALS['basic']['deletedSuccess_bulk'], "Attractions");
                echo json_encode(array("action" => "success", "message" => $message));
            else:
                echo json_encode(array("action" => "error", "message" => $GLOBALS['basic']['noRecords']));
            endif;
        break;

        case "subiSort":
            $id = $_REQUEST['id'];    // IS a line containing ids starting with : sortIds
            $sortIds = $_REQUEST['sortIds'];
            $posId = Attractions::field_by_id($id, 'destination_id');
            datatableReordering('tbl_attractions', $sortIds, "sortorder", "destination_id", $posId, 0);
            $message = sprintf($GLOBALS['basic']['sorted_'], "Attractions");
            echo json_encode(array("action" => "success", "message" => $message));
        break;
	}
?>