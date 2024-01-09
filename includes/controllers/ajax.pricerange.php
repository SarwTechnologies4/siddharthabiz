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
			$record = new Pricerange();

			// $newArr = array();
			// $fparent = (isset($_REQUEST['fparent']) and !empty($_REQUEST['fparent']))?$_REQUEST['fparent']:'';
			// $feature = (isset($_REQUEST['feature']) and !empty($_REQUEST['feature']))?$_REQUEST['feature']:'';
	
			// if(!empty($fparent) and !empty($feature)){				
			// 	foreach($fparent as $key=>$val){
			// 		$final_fpt = !empty($fparent[$key])?$val['name']:'';
			// 		$final_ft  = !empty($feature[$key])?$feature[$key]:'';
			// 		$newArr[$key] = array('id'=>$key,'name'=>$final_fpt,'features'=>$final_ft);
			// 	}
			// }


			// $record->slug 		= create_slug($_REQUEST['title']);
			// $record->title 		= $_REQUEST['title'];

			// $record->date1 	= $_REQUEST['date1'];
			// $record->date2 	= $_REQUEST['date2'];
			// if($_REQUEST['type']==1){
			// 	$record->image		= serialize(array_values(array_filter($_REQUEST['imageArrayname'])));	
			// }else{
			// 	$record->source 	= $_REQUEST['source'];
			// }		
			// $record->linksrc 	= $_REQUEST['linksrc'];
			// $record->linktype 	= $_REQUEST['linktype'];
			
			// $record->feature				= base64_encode(serialize($feature));			

			$record->point 		= $_REQUEST['point'];

			$record->status		= $_REQUEST['status'];

			$record->fromrange		= $_REQUEST['fromrange'];
			$record->torange		= $_REQUEST['torange'];
			$record->pkgtype 		= $_REQUEST['pkgtype'];
			// $record->position	= $_REQUEST['orientation'];
			$record->description		= $_REQUEST['description'];


			$record->sortorder	= Pricerange::find_maximum();
			
			
			// $checkDupliName=Pricerange::checkDupliName($record->title);			
			// if($checkDupliName):
			// 	echo json_encode(array("action"=>"warning","message"=>"Points Title Already Exists."));		
			// 	exit;		
			// endif;
			$db->begin();
			if($record->save()): $db->commit();
				$message  = sprintf($GLOBALS['basic']['addedSuccess_'], "Points '".$record->title."'");
				echo json_encode(array("action"=>"success","message"=>$message));
				log_action($message,1,3);
			else: 
				$db->rollback(); echo json_encode(array("action"=>"error","message"=>$GLOBALS['basic']['unableToSave']));
			endif;
		break;
			
		case "edit":
			$record = Pricerange::find_by_id($_REQUEST['idValue']);


			// $newArr = array();
			// $fparent = (isset($_REQUEST['fparent']) and !empty($_REQUEST['fparent']))?$_REQUEST['fparent']:'';
			// $feature = (isset($_REQUEST['feature']) and !empty($_REQUEST['feature']))?$_REQUEST['feature']:'';

			// if(!empty($fparent) and !empty($feature)){				
			// 	foreach($fparent as $key=>$val){
			// 		$final_fpt = !empty($fparent[$key])?$val['name']:'';
			// 		$final_ft  = !empty($feature[$key])?$feature[$key]:'';
			// 		$newArr[$key] = array('id'=>$key,'name'=>$final_fpt,'features'=>$final_ft); 
			// 	}
			// }



			// if($record->title!=$_REQUEST['title']){
			// 	$checkDupliName=Pricerange::checkDupliName($_REQUEST['title']);
			// 	if($checkDupliName):
			// 		echo json_encode(array("action"=>"warning","message"=>"Points title is already exist."));		
			// 		exit;		
			// 	endif;
			// }
			
			// $record->slug 		= create_slug($_REQUEST['title']);
			// $record->title 		= $_REQUEST['title'];
			

			// $record->date1 	= $_REQUEST['date1'];
			// $record->date2 	= $_REQUEST['date2'];
			// if($_REQUEST['type']==1){
			// 	$record->image		= serialize(array_values(array_filter($_REQUEST['imageArrayname'])));
			// 	$record->source 	= '';
			// }else{
			// 	$record->source 	= $_REQUEST['source'];
			// 	$record->image		= '';
			// }	
			
			// $record->linksrc 	= $_REQUEST['linksrc'];
			// $record->linktype 	= $_REQUEST['linktype'];

			// $record->feature				= base64_encode(serialize($feature));			
			
			$record->point 		= $_REQUEST['point'];
			
			$record->status		= $_REQUEST['status'];

			$record->fromrange		= $_REQUEST['fromrange'];
			$record->torange		= $_REQUEST['torange'];
			
			$record->pkgtype 		= $_REQUEST['pkgtype'];

			// $record->type 		= $_REQUEST['type'];
			// $record->position	= $_REQUEST['orientation'];
		
			$record->description		= $_REQUEST['description'];

			$db->begin();
			if($record->save()):$db->commit();
			   $message  = sprintf($GLOBALS['basic']['changesSaved_'], "Points '".$record->title."'");
			   echo json_encode(array("action"=>"success","message"=>$message));
			   log_action($message,1,4);
			else: $db->rollback();echo json_encode(array("action"=>"notice","message"=>$GLOBALS['basic']['noChanges']));
			endif;
		break;
			
		case "delete":
			$id = $_REQUEST['id'];
			$record = Pricerange::find_by_id($id);
			$db->begin();
			$res = $db->query("DELETE FROM tbl_pricerange WHERE id='{$id}'");
			if($res):$db->commit();	else: $db->rollback();endif;
			reOrder("tbl_pricerange", "sortorder");
			$message  = sprintf($GLOBALS['basic']['deletedSuccess_'], "Points '".$record->title."'");
			echo json_encode(array("action"=>"success","message"=>$message));	
			log_action("Points  [".$record->title."]".$GLOBALS['basic']['deletedSuccess'],1,6);
		break;
		
		// Module Setting Sections  >> <<
		case "toggleStatus":
			$id = $_REQUEST['id'];
			$record = Pricerange::find_by_id($id);
			$record->status = ($record->status == 1) ? 0 : 1 ;
			$record->save();
			echo "";
		break;
			
		case "bulkToggleStatus":
			$id = $_REQUEST['idArray'];
			$allid = explode("|", $id);
			$return = "0";
			for($i=1; $i<count($allid); $i++){
				$record = Pricerange::find_by_id($allid[$i]);
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
				$res  = $db->query("DELETE FROM tbl_pricerange WHERE id='".$allid[$i]."'");
				$return = 1;
			}
			if($res)$db->commit();else $db->rollback();
			reOrder("tbl_pricerange", "sortorder");
			
			if($return==1):
			    $message  = sprintf($GLOBALS['basic']['deletedSuccess_bulk'], "Points"); 
				echo json_encode(array("action"=>"success","message"=>$message));
			else:
				echo json_encode(array("action"=>"error","message"=>$GLOBALS['basic']['noRecords']));
			endif;
		break;
			
		case "sort":			
			$id 	 = $_REQUEST['id']; 	// IS a line containing ids starting with : sortIds
			$sortIds = $_REQUEST['sortIds'];
			datatableReordering('tbl_pricerange', $sortIds, "sortorder", '','',1);
			$message  = sprintf($GLOBALS['basic']['sorted_'], "Points"); 
			echo json_encode(array("action"=>"success","message"=>$message));
		break;
	}
?>