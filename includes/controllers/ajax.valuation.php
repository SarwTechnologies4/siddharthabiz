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
        if (!isset($_REQUEST['company_id'])):
            echo json_encode(array("action" => "warning", "message" => "Company is not selected."));
            exit;
        endif;

        $record = new Valuation();

        $record->company_id = $_REQUEST['company_id'];
        $record->share_value = $_REQUEST['share_value'];
        $record->company_value = $_REQUEST['company_value'];
        $record->date = $_REQUEST['date'];   

        $record->added_date = registered();

        $company = Hotelapi::find_by_id($record->company_id);

        $db->begin();
        if ($record->save()): $db->commit();
            $message = sprintf($GLOBALS['basic']['addedSuccess_'], "Valuation of '" . $record->long_name . "'");
            echo json_encode(array("action" => "success", "message" => $message, "data" => $record));
            log_action("Valuation of [" . $record->long_name . "]" . $GLOBALS['basic']['addedSuccess'], 1, 3);
        else: $db->rollback();
            echo json_encode(array("action" => "error", "message" => $GLOBALS['basic']['unableToSave']));
        endif;
        break;

    case "edit":
        if (empty($_REQUEST['company_id'])):
            echo json_encode(array("action" => "warning", "message" => "Company is not selected."));
            exit;
        endif;

        $record = Valuation::find_by_id($_REQUEST['idValue']);

        $record->company_id = $_REQUEST['company_id'];
        $record->share_value = $_REQUEST['share_value'];
        $record->company_value = $_REQUEST['company_value'];
        $record->date = $_REQUEST['date'];

        $db->begin();
        if ($record->save()): $db->commit();
            $message = sprintf($GLOBALS['basic']['changesSaved_'], "Valuation to'" . $record->long_name . "'");
            echo json_encode(array("action" => "success", "message" => $message, "data" => $record));
            log_action("Valuation to [" . $record->long_name . "] Edit Successfully", 1, 4);
        else: $db->rollback();
            echo json_encode(array("action" => "notice", "message" => $GLOBALS['basic']['noChanges']));
        endif;
        break;

    case "delete":
        $id = $_REQUEST['id'];
        $record = Valuation::find_by_id($id);

        log_action("Valuations from [" . $record->long_name . "]" . $GLOBALS['basic']['deletedSuccess'], 1, 6);
        $db->query("Update `tbl_valuation` set deleted = 1 WHERE id='{$id}'");

        $message = sprintf($GLOBALS['basic']['deletedSuccess_'], "Valuation to '" . $record->long_name . "'");
        echo json_encode(array("action" => "success", "message" => $message));
        log_action("Valuation to [" . $record->long_name . "]" . $GLOBALS['basic']['deletedSuccess'], 1, 6);
        break;

    case "bulkDelete":
        $id = $_REQUEST['idArray'];
        $allid = explode("|", $id);
        $return = 0;
        $db->begin();
        for ($i = 1; $i < count($allid); $i++) {
            $record = Valuation::find_by_id($allid[$i]);
            log_action("Valuation to [" . $record->long_name . "]" . $GLOBALS['basic']['deletedSuccess'], 1, 6);
            $res = $db->query("Update `tbl_valuation` set deleted=1 WHERE company_id='" . $allid[$i] . "'");
            $return = 1;
        }
        if ($res) $db->commit(); else $db->rollback();

        if ($return == 1):
            $message = sprintf($GLOBALS['basic']['deletedSuccess_bulk'], "Valuation");
            echo json_encode(array("action" => "success", "message" => $message));
        else:
            echo json_encode(array("action" => "error", "message" => $GLOBALS['basic']['noRecords']));
        endif;
        break;

    case "deleteByCompany":
        $id = $_REQUEST['id'];
        $record = Hotelapi::find_by_id($id);

        log_action("Valuations on [" . $record->long_name . "]" . $GLOBALS['basic']['deletedSuccess'], 1, 6);
        $db->query("Update `tbl_valuation` set deleted = 1 WHERE company_id='{$id}'");

        $message = sprintf($GLOBALS['basic']['deletedSuccess_'], "Valuation on '" . $record->long_name . "'");
        echo json_encode(array("action" => "success", "message" => $message));
        log_action("Valuation on [" . $record->long_name . "]" . $GLOBALS['basic']['deletedSuccess'], 1, 6);
        break;
}
?>