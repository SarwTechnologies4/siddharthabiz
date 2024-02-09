<?php
require_once('../includes/initialize.php');
$moduleTablename  = "tbl_investment"; 

$data = array();
$temp = array(
  "Shareholder ID",
  "Shareholder Name",
  "Company Name",
  "Alloted Share",
  "Total Price",
  "Paid Amount",
  "Due Amount");
array_push($data, $temp);

$records = Investment::list_report();

foreach ($records as $key => $record) {
  $temp = array(
    $record->internal_id, 
    $record->name, 
    $record->long_name, 
    $record->alloted_quantity, 
    $record->investment_amount,
    $record->payment_amount,
    $record->investment_amount - $record->payment_amount
  );
  array_push($data, $temp);
}

// Set the content type to CSV
header('Content-Type: text/csv; charset=utf-8');

$file = "Investment_report_".date('Y_m_d_H_i_s').".csv";
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