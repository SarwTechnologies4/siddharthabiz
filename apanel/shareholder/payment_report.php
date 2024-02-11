<?php
require_once('../../includes/initialize.php');
$moduleTablename  = "tbl_payment";

$shareholder_id = $_REQUEST['shareholder_id'];
$shareholder = Shareholder::find_by_id($shareholder_id);

$data = array();
$temp = array(
  "Company Name",
  "Payment Mode",
  "Bank",
  "Payment Amount",
  "Date");
array_push($data, $temp);


$sql = "SELECT hotel.long_name, inv.payment_mode, inv.bank_name, inv.payment_amount, DATE_FORMAT(inv.date, '%Y-%m-%d') AS `date`";
$sql .= " FROM " . $moduleTablename . " AS inv";
$sql .= " LEFT JOIN tbl_apihotel AS hotel ON hotel.id = inv.company_id";
$sql .= " WHERE inv.deleted = 0";
$sql .= " AND inv.shareholder_id = " . $shareholder_id;
$sql .= " ORDER BY inv.`id` DESC";

$records = Payment::objectify_sql($sql);

foreach ($records as $key => $record) {
  $temp = array(
    $record->long_name, 
    $record->payment_mode, 
    $record->bank_name, 
    $record->payment_amount,
    $record->date,
  );
  array_push($data, $temp);
}

// Set the content type to CSV
header('Content-Type: text/csv; charset=utf-8');

$file = $shareholder->name . "_payment_report_" . date('Y_m_d_H_i_s') . ".csv";
// Set the response header to specify that the file should be downloaded as an attachment
header('Content-Disposition: attachment; filename='.$file);

// Create an array of data
// $data = [['Name', 'Email', 'Phone'], ['John Smith', 'john@example.com', '555-555-1212'], ['Jane Doe', 'jane@example.com', '555-555-1213']];
// Open a file handle for writing
$fp = fopen('php://output', 'w');

// Write the data to the file
foreach ($data as $row) {
  fputcsv($fp, $row);
}

// Close the file handle
fclose($fp);


?>