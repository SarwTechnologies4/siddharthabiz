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
			if($_REQUEST['route_from']=='') {
				echo json_encode(array("action"=>"warning","message"=>"Please choose Route"));	
				exit;		
			}
			if($_REQUEST['route_to']=='') {
				echo json_encode(array("action"=>"warning","message"=>"Please choose Route"));	
				exit;		
			}

			$record = new Vprice();

			$record->route_from = $_REQUEST['route_from'];
			$record->route_to   = $_REQUEST['route_to'];
			$record->route_combine = $_REQUEST['route_from'].','.$_REQUEST['route_to'];
			$record->status		= $_REQUEST['status'];
			$record->added_by = !empty($session->get('u_id'))?$session->get('u_id'):0;
			$record->sortorder	= Vprice::find_maximum();
			$record->added_date = registered();

			$db->begin();
			$record->save();
			$act_id = $db->insert_id();
            foreach ($_REQUEST['velicle_id'] as $k => $parent) {
                if (!empty($parent)) {
                    foreach ($parent as $l => $row) {
                        $rate = $_REQUEST['vehicle_price'][$k][$l];
                        if ($rate > 0) {
                            $qu = "INSERT INTO tbl_vcombine SET vp_id='{$act_id}', vehicle_id='{$row}', vehicle_price='{$rate}'";
                            $db->query($qu);
                        }
                    }
                }
            }
			$db->commit();
			if($act_id > 0):
			$message  = sprintf($GLOBALS['basic']['addedSuccess_'], "Vehicle route price.");
			echo json_encode(array("action"=>"success","message"=>$message));
			log_action($message,1,3);
			else: $db->rollback(); echo json_encode(array("action"=>"error","message"=>$GLOBALS['basic']['unableToSave']));
			endif;
		break;
			
		case "edit":
			if($_REQUEST['route_from']=='') {
				echo json_encode(array("action"=>"warning","message"=>"Please choose Route"));	
				exit;		
			}
			if($_REQUEST['route_to']=='') {
				echo json_encode(array("action"=>"warning","message"=>"Please choose Route"));	
				exit;		
			}
			
			$act_id = $_REQUEST['idValue'];
			$record = Vprice::find_by_id($act_id);			
			$record->route_from = $_REQUEST['route_from'];
			$record->route_to   = $_REQUEST['route_to'];
			$record->route_combine = $_REQUEST['route_from'].','.$_REQUEST['route_to'];
			$record->status		= $_REQUEST['status'];

			$db->begin();
			$record->save();
			$db->query("DELETE FROM tbl_vcombine WHERE vp_id='{$act_id}'");
            foreach ($_REQUEST['velicle_id'] as $k => $parent) {
                if (!empty($parent)) {
                    foreach ($parent as $l => $row) {
                        $rate = $_REQUEST['vehicle_price'][$k][$l];
                        if ($rate > 0) {
                            $qu = "INSERT INTO tbl_vcombine SET vp_id='{$act_id}', vehicle_id='{$row}', vehicle_price='{$rate}'";
                            $db->query($qu);
                        }
                    }
                }
            }
			$db->commit();
			if($act_id > 0):
			   $message  = sprintf($GLOBALS['basic']['changesSaved_'], "Vehicle route price.");
			   echo json_encode(array("action"=>"success","message"=>$message));
			   log_action($message,1,4);
			else: $db->rollback();echo json_encode(array("action"=>"notice","message"=>$GLOBALS['basic']['noChanges']));
			endif;
		break;
			
		case "delete":
			$id = $_REQUEST['id'];
			$record = Vprice::find_by_id($id);
			$db->begin();
			$db->query("DELETE FROM tbl_vcombine WHERE vp_id='{$id}'");
			$res = $db->query("DELETE FROM tbl_vprice WHERE id='{$id}'");
			if($res):$db->commit();	else: $db->rollback();endif;
			reOrder("tbl_vprice", "sortorder");
			$message  = sprintf($GLOBALS['basic']['deletedSuccess_'], "Vehicle route price.");
			echo json_encode(array("action"=>"success","message"=>$message));	
			log_action("Vehicle route price ".$GLOBALS['basic']['deletedSuccess'],1,6);
		break;
		
		// Module Setting Sections  >> <<
		case "toggleStatus":
			$id = $_REQUEST['id'];
			$record = Vprice::find_by_id($id);
			$record->status = ($record->status == 1) ? 0 : 1 ;
			$record->save();
			echo "";
		break;
			
		case "bulkToggleStatus":
			$id = $_REQUEST['idArray'];
			$allid = explode("|", $id);
			$return = "0";
			for($i=1; $i<count($allid); $i++){
				$record = Vprice::find_by_id($allid[$i]);
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
				$res  = $db->query("DELETE FROM tbl_vprice WHERE id='".$allid[$i]."'");
				$return = 1;
			}
			if($res)$db->commit();else $db->rollback();
			reOrder("tbl_vprice", "sortorder");
			
			if($return==1):
			    $message  = sprintf($GLOBALS['basic']['deletedSuccess_bulk'], "Vprice"); 
				echo json_encode(array("action"=>"success","message"=>$message));
			else:
				echo json_encode(array("action"=>"error","message"=>$GLOBALS['basic']['noRecords']));
			endif;
		break;
			
		case "sort":			
			$id 	 = $_REQUEST['id']; 	// IS a line containing ids starting with : sortIds
			$sortIds = $_REQUEST['sortIds'];
			datatableReordering('tbl_vprice', $sortIds, "sortorder", '','',1);
			$message  = sprintf($GLOBALS['basic']['sorted_'], "Vprice"); 
			echo json_encode(array("action"=>"success","message"=>$message));
		break;
	}
?>