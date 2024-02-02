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

        $record = new Dividend();

        $record->company_id = $_REQUEST['company_id'];
        $record->shareholder_id = $_REQUEST['shareholder_id'];
        $record->payment_mode = $_REQUEST['payment_mode'];
        $record->bank_name = $_REQUEST['bank_name'];
        $record->payment_amount = $_REQUEST['payment_amount'];
        $record->date = $_REQUEST['date'];   
        $record->period_fiscal = $_REQUEST['period_fiscal'];   

        $record->added_date = registered();

        $shareHolder = Shareholder::find_by_id($record->shareholder_id);

        $db->begin();
        if ($record->save()): $db->commit();
            $message = sprintf($GLOBALS['basic']['addedSuccess_'], "Dividend to '" . $shareHolder->name . "'");
            echo json_encode(array("action" => "success", "message" => $message, "data" => $record));
            log_action("Dividend to [" . $shareHolder->name . "]" . $GLOBALS['basic']['addedSuccess'], 1, 3);
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

        $record = Dividend::find_by_id($_REQUEST['idValue']);

        $record->company_id = $_REQUEST['company_id'];
        $record->shareholder_id = $_REQUEST['shareholder_id'];
        $record->payment_mode = $_REQUEST['payment_mode'];
        $record->bank_name = $_REQUEST['bank_name'];
        $record->payment_amount = $_REQUEST['payment_amount'];
        $record->date = $_REQUEST['date'];
        $record->period_fiscal = $_REQUEST['period_fiscal'];
        
        $shareHolder = Shareholder::find_by_id($record->shareholder_id);

        $db->begin();
        if ($record->save()): $db->commit();
            $message = sprintf($GLOBALS['basic']['changesSaved_'], "Dividend to'" . $shareHolder->name . "'");
            echo json_encode(array("action" => "success", "message" => $message, "data" => $record));
            log_action("Dividend to [" . $shareHolder->name . "] Edit Successfully", 1, 4);
        else: $db->rollback();
            echo json_encode(array("action" => "notice", "message" => $GLOBALS['basic']['noChanges']));
        endif;
        break;

    case "delete":
        $id = $_REQUEST['id'];
        $record = Dividend::find_by_id($id);

        log_action("Dividends from [" . $record->shareholders_name . "]" . $GLOBALS['basic']['deletedSuccess'], 1, 6);
        $db->query("Update `tbl_dividend` set deleted = 1 WHERE id='{$id}'");

        $message = sprintf($GLOBALS['basic']['deletedSuccess_'], "Dividend to '" . $record->shareholders_name . "'");
        echo json_encode(array("action" => "success", "message" => $message));
        log_action("Dividend to [" . $record->shareholders_name . "]" . $GLOBALS['basic']['deletedSuccess'], 1, 6);
        break;

    case "bulkDelete":
        $id = $_REQUEST['idArray'];
        $allid = explode("|", $id);
        $return = 0;
        $db->begin();
        for ($i = 1; $i < count($allid); $i++) {
            $record = Dividend::find_by_id($allid[$i]);
            log_action("Dividend to [" . $record->shareholders_name . "]" . $GLOBALS['basic']['deletedSuccess'], 1, 6);
            $res = $db->query("Update `tbl_dividend` set deleted=1 WHERE company_id='" . $allid[$i] . "'");
            $return = 1;
        }
        if ($res) $db->commit(); else $db->rollback();

        if ($return == 1):
            $message = sprintf($GLOBALS['basic']['deletedSuccess_bulk'], "Dividend");
            echo json_encode(array("action" => "success", "message" => $message));
        else:
            echo json_encode(array("action" => "error", "message" => $GLOBALS['basic']['noRecords']));
        endif;
        break;

    case "deleteByCompany":
        $id = $_REQUEST['id'];
        $record = Hotelapi::find_by_id($id);

        log_action("Dividends on [" . $record->long_name . "]" . $GLOBALS['basic']['deletedSuccess'], 1, 6);
        $db->query("Update `tbl_dividend` set deleted = 1 WHERE company_id='{$id}'");

        $message = sprintf($GLOBALS['basic']['deletedSuccess_'], "Dividend on '" . $record->long_name . "'");
        echo json_encode(array("action" => "success", "message" => $message));
        log_action("Dividend on [" . $record->long_name . "]" . $GLOBALS['basic']['deletedSuccess'], 1, 6);
        break;

        case 'downloadExcel':

//             require_once(LIB_PATH . '/PhpSpreadsheet/Spreadsheet.php');

// $spreadsheet = new Spreadsheet();
// $activeWorksheet = $spreadsheet->getActiveSheet();
// $activeWorksheet->setCellValue('A1', 'Hello World !');

// $writer = new Xlsx($spreadsheet);
// $writer->save('hello world.xlsx');





            // echo "downloadExcel";die();
            
// require_once(LIB_PATH.DS.'/PhpSpreadsheet/spreadsheet.php');
            // require_once dirname(__FILE__) . 'PHPExcel/PHPExcel.php';


// Create new PHPExcel object
// $objPHPExcel = new PHPExcel();

// // Set document properties
// $objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
// 							 ->setLastModifiedBy("Maarten Balliauw")
// 							 ->setTitle("Office 2007 XLSX Test Document")
// 							 ->setSubject("Office 2007 XLSX Test Document")
// 							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
// 							 ->setKeywords("office 2007 openxml php")
// 							 ->setCategory("Test result file");


// // Add some data
// $objPHPExcel->setActiveSheetIndex(0)
//             ->setCellValue('A1', 'Hello')
//             ->setCellValue('B2', 'world!')
//             ->setCellValue('C1', 'Hello')
//             ->setCellValue('D2', 'world!');

// // Miscellaneous glyphs, UTF-8
// $objPHPExcel->setActiveSheetIndex(0)
//             ->setCellValue('A4', 'Miscellaneous glyphs')
//             ->setCellValue('A5', 'éàèùâêîôûëïüÿäöüç');

// // Rename worksheet
// $objPHPExcel->getActiveSheet()->setTitle('Simple');


// // Set active sheet index to the first sheet, so Excel opens this as the first sheet
// $objPHPExcel->setActiveSheetIndex(0);


// // Redirect output to a client’s web browser (OpenDocument)
// header('Content-Type: application/vnd.oasis.opendocument.spreadsheet');
// header('Content-Disposition: attachment;filename="01simple.ods"');
// header('Cache-Control: max-age=0');
// // If you're serving to IE 9, then the following may be needed
// header('Cache-Control: max-age=1');

// // If you're serving to IE over SSL, then the following may be needed
// header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
// header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
// header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
// header ('Pragma: public'); // HTTP/1.0

// $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'OpenDocument');
// $objWriter->save('php://output');
// exit;
            break;
}
?>