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
        $record = new Shareholder();

        $record->internal_id = $_REQUEST['internal_id'];
        $record->name = $_REQUEST['name'];
        $record->gender = $_REQUEST['gender'];
        $record->citizenship = $_REQUEST['citizenship'];
        $record->citizenship_district = $_REQUEST['citizenship_district'];
        $record->citizenship_issue_date = $_REQUEST['citizenship_issue_date'];
        $record->father = $_REQUEST['father'];
        $record->grand_father = $_REQUEST['grand_father'];
        $record->mother = $_REQUEST['mother'];
        $record->spouse = $_REQUEST['spouse'];
        $record->nominee = $_REQUEST['nominee'];
        $record->nominee_citizenship = $_REQUEST['nominee_citizenship'];
        $record->nominee_relationship = $_REQUEST['nominee_relationship'];
        $record->type_id = $_REQUEST['type_id'];
        $record->permanent_address = $_REQUEST['permanent_address'];
        $record->temporary_address = $_REQUEST['temporary_address'];
        $record->changed_address = $_REQUEST['changed_address'];
        $record->pan_number = $_REQUEST['pan_number'];
        $record->bank = $_REQUEST['bank'];
        $record->bank_account = $_REQUEST['bank_account'];
        $record->bank_branch = $_REQUEST['bank_branch'];
        $record->bank_account_name = $_REQUEST['bank_account_name'];
        $record->phone = $_REQUEST['phone'];
        $record->mobile = $_REQUEST['mobile'];
        $record->email = $_REQUEST['email'];
        $record->terminated_date = $_REQUEST['terminated_date'];
        $record->terminated_amount = $_REQUEST['terminated_amount'];
        $record->status = $_REQUEST['status'];
        $record->sortorder = Shareholder::find_maximum();

        $record->company_name = $_REQUEST['company_name'];
        $record->company_address = $_REQUEST['company_address'];
        $record->company_pan = $_REQUEST['company_pan'];

        $record->citizenship_image = (!empty($_REQUEST['imageArrayname1'])) ? $_REQUEST['imageArrayname1'] : '';
        $record->pan_image = (!empty($_REQUEST['imageArrayname2'])) ? $_REQUEST['imageArrayname2'] : '';
        $record->license_image = (!empty($_REQUEST['imageArrayname3'])) ? $_REQUEST['imageArrayname3'] : '';
        $record->pp_image = (!empty($_REQUEST['imageArrayname4'])) ? $_REQUEST['imageArrayname4'] : '';
        $record->company_image = (!empty($_REQUEST['imageArrayname5'])) ? $_REQUEST['imageArrayname5'] : '';;

        $record->added_date = registered();
        $record->meta_keywords = $_REQUEST['meta_keywords'];
        $record->meta_description = $_REQUEST['meta_description'];

        // $checkDupliName = Shareholder::checkDupliName($record->name);
        $checkDupliID = Shareholder::checkDupliID($record->internal_id);
        if ($checkDupliID):
            echo json_encode(array("action" => "warning", "message" => "Title OR ID Already Exists."));
            exit;
        endif;

        $db->begin();
        if ($record->save()): $db->commit();
            $message = sprintf($GLOBALS['basic']['addedSuccess_'], "Shareholder '" . $record->name . "'");
            echo json_encode(array("action" => "success", "message" => $message, "data" => $record));
            log_action("Shareholder [" . $record->name . "]" . $GLOBALS['basic']['addedSuccess'], 1, 3);
        else: $db->rollback();
            echo json_encode(array("action" => "error", "message" => $GLOBALS['basic']['unableToSave']));
        endif;
        break;

    case "edit":
        $record = Shareholder::find_by_id($_REQUEST['idValue']);

        // if ($record->name != $_REQUEST['name']) {
        //     $checkDupliName = Shareholder::checkDupliName($_REQUEST['name']);
        //     if ($checkDupliName):
        //         echo json_encode(array("action" => "warning", "message" => "Shareholder name is already exist."));
        //         exit;
        //     endif;
        // }
        if ($record->internal_id != $_REQUEST['internal_id']) {
            $checkDupliID = Shareholder::checkDupliID($_REQUEST['internal_id']);
            if ($checkDupliID):
                echo json_encode(array("action" => "warning", "message" => "ID is already exist."));
                exit;
            endif;
        }

        $record->internal_id = $_REQUEST['internal_id'];
        $record->name = $_REQUEST['name'];
        $record->gender = $_REQUEST['gender'];
        $record->citizenship = $_REQUEST['citizenship'];
        $record->citizenship_district = $_REQUEST['citizenship_district'];
        $record->citizenship_issue_date = $_REQUEST['citizenship_issue_date'];
        $record->father = $_REQUEST['father'];
        $record->grand_father = $_REQUEST['grand_father'];
        $record->mother = $_REQUEST['mother'];
        $record->spouse = $_REQUEST['spouse'];
        $record->nominee = $_REQUEST['nominee'];
        $record->nominee_citizenship = $_REQUEST['nominee_citizenship'];
        $record->nominee_relationship = $_REQUEST['nominee_relationship'];
        $record->type_id = $_REQUEST['type_id'];
        $record->permanent_address = $_REQUEST['permanent_address'];
        $record->temporary_address = $_REQUEST['temporary_address'];
        $record->changed_address = $_REQUEST['changed_address'];
        $record->pan_number = $_REQUEST['pan_number'];
        $record->bank = $_REQUEST['bank'];
        $record->bank_account = $_REQUEST['bank_account'];
        $record->bank_branch = $_REQUEST['bank_branch'];
        $record->bank_account_name = $_REQUEST['bank_account_name'];
        $record->phone = $_REQUEST['phone'];
        $record->mobile = $_REQUEST['mobile'];
        $record->email = $_REQUEST['email'];
        $record->terminated_date = $_REQUEST['terminated_date'];
        $record->terminated_amount = $_REQUEST['terminated_amount'];
        $record->status = $_REQUEST['status'];
//        $record->sortorder = $_REQUEST['sortorder'];

        $record->company_name = $_REQUEST['company_name'];
        $record->company_address = $_REQUEST['company_address'];
        $record->company_pan = $_REQUEST['company_pan'];

        $record->meta_keywords = $_REQUEST['meta_keywords'];
        $record->meta_description = $_REQUEST['meta_description'];

        if (!empty($_REQUEST['imageArrayname1']) || isset($_REQUEST['imageArrayname1'])):
            $record->citizenship_image = $_REQUEST['imageArrayname1'];
        endif;

        if (!empty($_REQUEST['imageArrayname2']) || isset($_REQUEST['imageArrayname2'])):
            $record->pan_image = $_REQUEST['imageArrayname2'];
        endif;

        if (!empty($_REQUEST['imageArrayname3']) || isset($_REQUEST['imageArrayname3'])):
            $record->license_image = $_REQUEST['imageArrayname3'];
        endif;

        if (!empty($_REQUEST['imageArrayname4']) || isset($_REQUEST['imageArrayname4'])):
            $record->pp_image = $_REQUEST['imageArrayname4'];
        endif;

        if (!empty($_REQUEST['imageArrayname5']) || isset($_REQUEST['imageArrayname5'])):
            $record->company_image = $_REQUEST['imageArrayname5'];
        endif;

        foreach ($_POST as $kk => $vv) {
            $$kk = $vv;
        }

        $db->begin();
        if ($record->save()): $db->commit();
            $message = sprintf($GLOBALS['basic']['changesSaved_'], "Shareholder '" . $record->name . "'");
            echo json_encode(array("action" => "success", "message" => $message, "data" => $record));
            log_action("Shareholder [" . $record->name . "] Edit Successfully", 1, 4);
        else: $db->rollback();
            echo json_encode(array("action" => "notice", "message" => $GLOBALS['basic']['noChanges']));
        endif;
        break;

    case "delete":
        $id = $_REQUEST['id'];
        $record = Shareholder::find_by_id($id);
        log_action("Shareholders  [" . $record->name . "]" . $GLOBALS['basic']['deletedSuccess'], 1, 6);
        $db->query("DELETE FROM tbl_shareholders WHERE id='{$id}'");

        reOrder("tbl_shareholders", "sortorder");
        $folders = ['citizenship_image', 'pan_image', 'license_image', 'pp_image', 'company_image'];
        $objArray = (array)$record;

        foreach ($folders as $folder) {
            @unlink(IMAGE_PATH . 'shareholder/' . $folder . '/thumbnails/' . $objArray[$folder]);
            @unlink(IMAGE_PATH . 'shareholder/' . $folder . '/' . $objArray[$folder]);
        }

        $message = sprintf($GLOBALS['basic']['deletedSuccess_'], "Shareholder '" . $record->name . "'");
        echo json_encode(array("action" => "success", "message" => $message));
        log_action("Shareholder  [" . $record->name . "]" . $GLOBALS['basic']['deletedSuccess'], 1, 6);
        break;

    // Module Setting Sections  >> <<
    case "toggleStatus":
        $id = $_REQUEST['id'];
        $record = Shareholder::find_by_id($id);
        $record->status = ($record->status == 1) ? 0 : 1;
        $record->save();
        echo "";
        break;

    case "bulkToggleStatus":
        $id = $_REQUEST['idArray'];
        $allid = explode("|", $id);
        $return = "0";
        for ($i = 1; $i < count($allid); $i++) {
            $record = Shareholder::find_by_id($allid[$i]);
            $record->status = ($record->status == 1) ? 0 : 1;
            $record->save();
        }
        echo "";
        break;

    case "bulkDelete":
        $id = $_REQUEST['idArray'];
        $allid = explode("|", $id);
        $return = "0";
        $db->begin();
        for ($i = 1; $i < count($allid); $i++) {
            $record = Shareholder::find_by_id($allid[$i]);
            log_action("Shareholder  [" . $record->name . "]" . $GLOBALS['basic']['deletedSuccess'], 1, 6);
            $res = $db->query("DELETE FROM tbl_shareholders WHERE id='" . $allid[$i] . "'");
            $return = 1;
        }
        if ($res) $db->commit(); else $db->rollback();
        reOrder("tbl_shareholders", "sortorder");

        if ($return == 1):
            $message = sprintf($GLOBALS['basic']['deletedSuccess_bulk'], "Shareholder");
            echo json_encode(array("action" => "success", "message" => $message));
        else:
            echo json_encode(array("action" => "error", "message" => $GLOBALS['basic']['noRecords']));
        endif;
        break;

    case "sort":
        $id = $_REQUEST['id'];    // IS a line containing ids starting with : sortIds
        $sortIds = $_REQUEST['sortIds'];
        $posId = Shareholder::field_by_id($id, 'type');
        datatableReordering('tbl_shareholders', $sortIds, "sortorder", "type", $posId, 1);
        $message = sprintf($GLOBALS['basic']['sorted_'], "Shareholder");
        echo json_encode(array("action" => "success", "message" => $message));
        break;

    case "addType":
        $dataJson = json_decode($_REQUEST['data']);
        if (!$dataJson) {
            break;
        }
        $checkDupliName = ShareholderType::checkDupliName($dataJson->title);
        if ($checkDupliName) {
            break;
        }
        $record = new ShareholderType();
        $record->title = $dataJson->title;
        $record->status = 1;
        $record->sortorder = ShareholderType::find_maximum();
        $db->begin();
        if ($record->save()): $db->commit();
            $message = sprintf($GLOBALS['basic']['addedSuccess_'], "Shareholder '" . $record->title . "'");
            echo json_encode(array("action" => "success", "message" => $message, 'data' => json_encode($record)));
            log_action("Shareholder [" . $record->title . "]" . $GLOBALS['basic']['addedSuccess'], 1, 3);
        else: $db->rollback();
            echo json_encode(array("action" => "error", "message" => $GLOBALS['basic']['unableToSave']));
        endif;
        break;
}
?>