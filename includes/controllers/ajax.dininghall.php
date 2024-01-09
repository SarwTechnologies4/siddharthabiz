<?php
// Load the header files first
header("Expires: 0");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("cache-control: no-store, no-cache, must-revalidate");
header("Pragma: no-cache");

// Load necessary files then...
require_once('../initialize.php');

$action = $_REQUEST['action'];
// print_r($_REQUEST);
// die();
switch ($action) {

    case "add":
        $record             = new DiningHall();

        if (@$session->get('user_hotel_id') != '') {
            $record->hotel_id = $session->get('user_hotel_id');
        } else {
            echo json_encode(array("action" => "error", "message" => "No hotel has been selected"));
        }

        $record->title      = $_REQUEST['title'];
        $record->slug       = create_slug($_REQUEST['title']);
        $record->content    = $_REQUEST['content'];
        $record->image      = (!empty($_REQUEST['imageArrayname'])) ? $_REQUEST['imageArrayname'] : '';

        $record->status     = $_REQUEST['status'];
        $record->sortorder  = DiningHall::find_maximum("sortorder");
        $record->added_date = registered();
        $record->modified_date = registered();

        $record->meta_keywords		= $_REQUEST['meta_keywords'];
        $record->meta_description	= $_REQUEST['meta_description'];

        $db->begin();
        if ($record->save()): $db->commit();
            $message = sprintf($GLOBALS['basic']['addedSuccess_'], "Dining Hall '" . $record->title . "'");
            echo json_encode(array("action" => "success", "message" => $message));
            log_action($message, 1, 3);
        else: $db->rollback();
            echo json_encode(array("action" => "error", "message" => $GLOBALS['basic']['unableToSave']));
        endif;
        break;

    case "edit":
        $record             = DiningHall::find_by_id($_REQUEST['idValue']);

        if (@$session->get('user_hotel_id') == '') {
            echo json_encode(array("action" => "error", "message" => "No hotel has been selected"));
        }

        $record->title      = $_REQUEST['title'];
        $record->slug       = create_slug($_REQUEST['title']);
        $record->content    = $_REQUEST['content'];
        $record->image      = (!empty($_REQUEST['imageArrayname'])) ? $_REQUEST['imageArrayname'] : '';
        $record->status     = $_REQUEST['status'];
        $record->modified_date = registered();

        $record->meta_keywords		= $_REQUEST['meta_keywords'];
        $record->meta_description	= $_REQUEST['meta_description'];

        $db->begin();
        if ($record->save()): $db->commit();
            $message = sprintf($GLOBALS['basic']['changesSaved_'], "Dining Hall '" . $record->title . "'");
            echo json_encode(array("action" => "success", "message" => $message));
            log_action($message, 1, 4);
        else: $db->rollback();
            echo json_encode(array("action" => "error", "message" => $GLOBALS['basic']['unableToSave']));
        endif;
        break;

    case "delete":
        $id     = $_REQUEST['id'];
        $record = DiningHall::find_by_id($id);
        log_action("Dining Hall [" . $record->title . "]" . $GLOBALS['basic']['deletedSuccess'], 1, 6);

        $db->begin();
        $res    = $db->query("DELETE FROM tbl_dining_hall WHERE id='{$id}'");
        if ($res): $db->commit(); else: $db->rollback(); endif;
        reOrder("tbl_dining_hall", "sortorder");
        echo json_encode(array("action" => "success", "message" => "Dining Hall [" . $record->title . "]" . $GLOBALS['basic']['deletedSuccess']));
        break;

    case "toggleStatus":
        $id             = $_REQUEST['id'];
        $record         = DiningHall::find_by_id($id);
        $record->status = ($record->status == 1) ? 0 : 1;
        $db->begin();
        $res            = $record->save();
        if ($res): $db->commit(); else: $db->rollback(); endif;
        echo "";
        break;

    case "bulkToggleStatus":
        $id         = $_REQUEST['idArray'];
        $allid      = explode("|", $id);
        $return     = "0";
        for ($i = 1; $i < count($allid); $i++) {
            $record = DiningHall::find_by_id($allid[$i]);
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
            $record = DiningHall::find_by_id($allid[$i]);
            $res    = $db->query("DELETE FROM tbl_dining_hall WHERE id='" . $allid[$i] . "'");
            reOrder("tbl_dining_hall", "sortorder");
            $return = 1;
        }
        if ($res) $db->commit(); else $db->rollback();

        if ($return == 1):
            $message = sprintf($GLOBALS['basic']['deletedSuccess_bulk'], "Dining Hall");
            echo json_encode(array("action" => "success", "message" => $message));
        else:
            echo json_encode(array("action" => "error", "message" => $GLOBALS['basic']['noRecords']));
        endif;
        break;

    case "sort":
        $id 	 = $_REQUEST['id']; 	// IS a line containing ids starting with : sortIds
        $sortIds = $_REQUEST['sortIds'];
        $record  = DiningHall::find_by_id($id);
        datatableReordering('tbl_dining_hall', $sortIds, "sortorder", 'hotel_id', $record->hotel_id, 1);
        $message  = sprintf($GLOBALS['basic']['sorted_'], "Dining Hall");
        echo json_encode(array("action"=>"success","message"=>$message));
        break;

}
?>