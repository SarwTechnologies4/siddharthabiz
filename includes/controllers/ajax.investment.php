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

        if (!isset($_REQUEST['shareholder_id'])):
            echo json_encode(array("action" => "warning", "message" => "Shareholder is not selected."));
            exit;
        endif;

        $record = new Investment();

        $record->company_id = $_REQUEST['company_id'];
        $record->shareholder_id = $_REQUEST['shareholder_id'];
        $record->alloted_quantity = $_REQUEST['alloted_quantity'];
        $record->price_per_share = $_REQUEST['price_per_share'];   
        $record->investment_amount = $record->alloted_quantity * $record->price_per_share;

        $record->added_date = registered();

        $company = Hotelapi::find_by_id($record->company_id);

        $db->begin();
        if ($record->save()): $db->commit();
            $message = sprintf($GLOBALS['basic']['addedSuccess_'], "Investment on '" . $company->long_name . "'");
            echo json_encode(array("action" => "success", "message" => $message, "data" => $record));
            log_action("Investment on [" . $company->long_name . "]" . $GLOBALS['basic']['addedSuccess'], 1, 3);
        else: $db->rollback();
            echo json_encode(array("action" => "error", "message" => $GLOBALS['basic']['unableToSave']));
        endif;
        break;

    case "edit":
        if (empty($_REQUEST['company_id'])):
            echo json_encode(array("action" => "warning", "message" => "Company is not selected."));
            exit;
        endif;

        if (empty($_REQUEST['shareholder_id'])):
            echo json_encode(array("action" => "warning", "message" => "Shareholder is not selected."));
            exit;
        endif;

        $record = Investment::find_by_id($_REQUEST['idValue']);

        $record->company_id = $_REQUEST['company_id'];
        $record->shareholder_id = $_REQUEST['shareholder_id'];
        $record->alloted_quantity = $_REQUEST['alloted_quantity'];
        $record->price_per_share = $_REQUEST['price_per_share'];   
        $record->investment_amount = $record->alloted_quantity * $record->price_per_share;

        $db->begin();
        if ($record->save()): $db->commit();
            $message = sprintf($GLOBALS['basic']['changesSaved_'], "Investment '" . $record->name . "'");
            echo json_encode(array("action" => "success", "message" => $message, "data" => $record));
            log_action("Investment [" . $record->name . "] Edit Successfully", 1, 4);
        else: $db->rollback();
            echo json_encode(array("action" => "notice", "message" => $GLOBALS['basic']['noChanges']));
        endif;
        break;

    case "delete":
        $id = $_REQUEST['id'];
        $record = Investment::find_by_id($id);

        log_action("Investments from [" . $record->shareholders_name . "]" . $GLOBALS['basic']['deletedSuccess'], 1, 6);
        $db->query("Update `tbl_investment` set deleted = 1 WHERE id='{$id}'");

        $message = sprintf($GLOBALS['basic']['deletedSuccess_'], "Investment from '" . $record->shareholders_name . "'");
        echo json_encode(array("action" => "success", "message" => $message));
        log_action("Investment from [" . $record->shareholders_name . "]" . $GLOBALS['basic']['deletedSuccess'], 1, 6);
        break;

    case "bulkDelete":
        $id = $_REQUEST['idArray'];
        $allid = explode("|", $id);
        $return = 0;
        $db->begin();
        for ($i = 1; $i < count($allid); $i++) {
            $record = Hotelapi::find_by_id($allid[$i]);
            log_action("Investment on [" . $record->long_name . "]" . $GLOBALS['basic']['deletedSuccess'], 1, 6);
            $res = $db->query("Update `tbl_investment` set deleted=1 WHERE company_id='" . $allid[$i] . "'");
            $return = 1;
        }
        if ($res) $db->commit(); else $db->rollback();

        if ($return == 1):
            $message = sprintf($GLOBALS['basic']['deletedSuccess_bulk'], "Investment");
            echo json_encode(array("action" => "success", "message" => $message));
        else:
            echo json_encode(array("action" => "error", "message" => $GLOBALS['basic']['noRecords']));
        endif;
        break;

    case "deleteByCompany":
        $id = $_REQUEST['id'];
        $record = Hotelapi::find_by_id($id);

        log_action("Investments on [" . $record->long_name . "]" . $GLOBALS['basic']['deletedSuccess'], 1, 6);
        $db->query("Update `tbl_investment` set deleted = 1 WHERE company_id='{$id}'");

        $message = sprintf($GLOBALS['basic']['deletedSuccess_'], "Investment on '" . $record->long_name . "'");
        echo json_encode(array("action" => "success", "message" => $message));
        log_action("Investment on [" . $record->long_name . "]" . $GLOBALS['basic']['deletedSuccess'], 1, 6);
        break;
}
?>