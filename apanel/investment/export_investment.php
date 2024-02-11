<?php
require_once('../../includes/initialize.php');

$records = Investment::agg_data();

$data = array();
$temp =
$temp = array(
  "Company Name",
  "# Share Holders",
  "Total Amount Colltected"
);
array_push($data, $temp);


foreach ($records as $key => $record) {
  $temp = array(
    $record->long_name,
    $record->shareholders_number,
    $record->investment_amount
  );
  array_push($data, $temp);
}

// Set the content type to CSV
header('Content-Type: text/csv; charset=utf-8');

$file = "Investment_report_" . date('Y_m_d_H_i_s') . ".csv";
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