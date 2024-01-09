<?php
// Load the header files first
header("Expires: 0");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("cache-control: no-store, no-cache, must-revalidate");
header("Pragma: no-cache");

// Load necessary files then...
require_once('../initialize.php');

$action = $_REQUEST['action'];

switch ($action) {

    case "add":
        $record             = new EventHall();

        if (@$session->get('user_hotel_id') != '') {
            $record->hotel_id = $session->get('user_hotel_id');
        } else {
            echo json_encode(array("action" => "error", "message" => "No hotel has been selected"));
        }

        $record->title      = $_REQUEST['title'];
        $record->slug       = create_slug($_REQUEST['title']);
        $record->content    = $_REQUEST['content'];
        $record->image      = (!empty($_REQUEST['imageArrayname'])) ? $_REQUEST['imageArrayname'] : '';

        $record->area       = (!empty($_REQUEST['area'])) ? $_REQUEST['area'] : '';
        $record->theater    = (!empty($_REQUEST['theater'])) ? $_REQUEST['theater'] : '';
        $record->circular   = (!empty($_REQUEST['circular'])) ? $_REQUEST['circular'] : '';
        $record->u_shaped   = (!empty($_REQUEST['u_shaped'])) ? $_REQUEST['u_shaped'] : '';
        $record->board_room = (!empty($_REQUEST['board_room'])) ? $_REQUEST['board_room'] : '';
        $record->class_room = (!empty($_REQUEST['class_room'])) ? $_REQUEST['class_room'] : '';
        $record->reception  = (!empty($_REQUEST['reception'])) ? $_REQUEST['reception'] : '';

        $record->meta_keywords		= $_REQUEST['meta_keywords'];
        $record->meta_description	= $_REQUEST['meta_description'];

        $record->status     = $_REQUEST['status'];
        $record->sortorder  = EventHall::find_maximum("sortorder");
        $record->added_date = registered();
        $record->modified_date = registered();

        $db->begin();
        if ($record->save()): $db->commit();
            $message = sprintf($GLOBALS['basic']['addedSuccess_'], "Event Hall '" . $record->title . "'");
            echo json_encode(array("action" => "success", "message" => $message));
            log_action($message, 1, 3);
        else: $db->rollback();
            echo json_encode(array("action" => "error", "message" => $GLOBALS['basic']['unableToSave']));
        endif;
        break;

    case "edit":
        $record             = EventHall::find_by_id($_REQUEST['idValue']);

        if (@$session->get('user_hotel_id') == '') {
            echo json_encode(array("action" => "error", "message" => "No hotel has been selected"));
        }

        $record->title      = $_REQUEST['title'];
        $record->slug       = create_slug($_REQUEST['title']);
        $record->content    = $_REQUEST['content'];
        $record->image      = (!empty($_REQUEST['imageArrayname'])) ? $_REQUEST['imageArrayname'] : '';
        $record->area       = (!empty($_REQUEST['area'])) ? $_REQUEST['area'] : '';
        $record->theater    = (!empty($_REQUEST['theater'])) ? $_REQUEST['theater'] : '';
        $record->circular   = (!empty($_REQUEST['circular'])) ? $_REQUEST['circular'] : '';
        $record->u_shaped   = (!empty($_REQUEST['u_shaped'])) ? $_REQUEST['u_shaped'] : '';
        $record->board_room = (!empty($_REQUEST['board_room'])) ? $_REQUEST['board_room'] : '';
        $record->class_room = (!empty($_REQUEST['class_room'])) ? $_REQUEST['class_room'] : '';
        $record->reception  = (!empty($_REQUEST['reception'])) ? $_REQUEST['reception'] : '';
        $record->status     = $_REQUEST['status'];
        $record->modified_date = registered();

        $record->meta_keywords		= $_REQUEST['meta_keywords'];
        $record->meta_description	= $_REQUEST['meta_description'];

        $db->begin();
        if ($record->save()): $db->commit();
            $message = sprintf($GLOBALS['basic']['changesSaved_'], "Event Hall '" . $record->title . "'");
            echo json_encode(array("action" => "success", "message" => $message));
            log_action($message, 1, 4);
        else: $db->rollback();
            echo json_encode(array("action" => "error", "message" => $GLOBALS['basic']['unableToSave']));
        endif;
        break;

    case "delete":
        $id     = $_REQUEST['id'];
        $record = EventHall::find_by_id($id);
        log_action("Event Hall [" . $record->title . "]" . $GLOBALS['basic']['deletedSuccess'], 1, 6);

        $db->begin();
        $res    = $db->query("DELETE FROM tbl_event_hall WHERE id='{$id}'");
        if ($res): $db->commit(); else: $db->rollback(); endif;
        reOrder("tbl_event_hall", "sortorder");
        echo json_encode(array("action" => "success", "message" => "Event Hall [" . $record->title . "]" . $GLOBALS['basic']['deletedSuccess']));
        break;

    case "toggleStatus":
        $id             = $_REQUEST['id'];
        $record         = EventHall::find_by_id($id);
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
            $record = EventHall::find_by_id($allid[$i]);
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
            $record = EventHall::find_by_id($allid[$i]);
            $res    = $db->query("DELETE FROM tbl_event_hall WHERE id='" . $allid[$i] . "'");
            reOrder("tbl_event_hall", "sortorder");
            $return = 1;
        }
        if ($res) $db->commit(); else $db->rollback();

        if ($return == 1):
            $message = sprintf($GLOBALS['basic']['deletedSuccess_bulk'], "Event Hall");
            echo json_encode(array("action" => "success", "message" => $message));
        else:
            echo json_encode(array("action" => "error", "message" => $GLOBALS['basic']['noRecords']));
        endif;
        break;

    case "sort":
        $id 	 = $_REQUEST['id']; 	// IS a line containing ids starting with : sortIds
        $sortIds = $_REQUEST['sortIds'];
        $record  = EventHall::find_by_id($id);
        datatableReordering('tbl_event_hall', $sortIds, "sortorder", 'hotel_id', $record->hotel_id, 1);
        $message  = sprintf($GLOBALS['basic']['sorted_'], "Event Hall");
        echo json_encode(array("action"=>"success","message"=>$message));
        break;

}
?>