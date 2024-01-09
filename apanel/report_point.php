<?php
require_once('../includes/initialize.php');
$moduleTablename  = "tbl_points"; 
foreach($_POST as $key=>$val){$$key=$val;}
	$addQuery =  '';
    $report_by  = "Booking Date";
		    	
          $datefield  =  'reg_date';


          if(!empty($start_date) || !empty($end_date)){
            $addQuery .= " AND ";
              if(!empty($start_date)){
                $addQuery .= " DATE_FORMAT($datefield,'%Y-%m-%d') >='".$start_date."'";
              }
              if(!empty($start_date) && !empty($end_date)){
                $addQuery .= " AND ";
              }
              if(!empty($end_date)){
                $addQuery .= " DATE_FORMAT($datefield,'%Y-%m-%d') <='".$end_date."'";
              }

          }

                $data = array();
                $temp = array("Date","Particulars","Pts","UP","LFT", "Branch","MOP");
                array_push($data,$temp);


                $records = Point::find_by_sql("SELECT * FROM " . $moduleTablename . " WHERE user_id={$userid} {$addQuery} ORDER BY id DESC");

                // $records = Point::find_by_userid($userid);

                foreach ($records as $key => $record){


                  $va =!empty($record->propertyid)?$record->propertyid:'';
                  $dat=Hotelapi::find_by_userid($va);
                  $branch='';
                  !empty($dat->title)?$branch = $dat->title:$branch = 'Super Admin';

                  $mop = '';
                  if($record->status == 1){
                    $mop = 'Cash';
                  }elseif($record->status == 2){
                    $mop = 'Points';
                  }elseif($record->status == 3){
                    $mop = 'Prize';

                  }

                  $temp = array(date("d M Y", strtotime($record->reg_date)),$record->particulars,$record->point,$record->usable_point,$record->actual_point,$branch,$mop);
                  array_push($data,$temp);
                }

                $user_detail = Generaluser::find_by_id($userid);


    // Set the content type to CSV
    header('Content-Type: text/csv; charset=utf-8');

    $file = "UserDetail_".$user_detail->username."_". $user_detail->id ."_".date('Y_m_d_H_i_s').".csv";
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