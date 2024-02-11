<?php
require_once('../../includes/initialize.php');

$id = $_REQUEST['id'];
$company = Hotelapi::find_by_id($id);
$records = Payment::getPaymentByCompany($id);

$data = array();
$temp = array(
  "Shareholder Name",
  "Shareholder ID",
  "Payment Amount",
  "Payment Mode",
  "Bank Name",
  "Date"
);
array_push($data, $temp);


foreach ($records as $key => $record) {
  $temp = array(
    $record->shareholders_name,
    $record->internal_id,
    $record->payment_amount,
    $record->payment_mode,
    $record->bank_name,
    $record->date
  );
  array_push($data, $temp);
}

// Set the content type to CSV
header('Content-Type: text/csv; charset=utf-8');

$file = implode('_', explode(' ', str_replace(',', " ", $company->long_name))) . "_payment_report_" . date('Y_m_d_H_i_s') . ".csv";
// Set the response header to specify that the file should be downloaded as an attachment
header('Content-Disposition: attachment; filename=' . $file);

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
exit;


?>