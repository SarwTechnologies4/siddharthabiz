<?php
require_once('../includes/initialize.php');
$moduleTablename  = "tbl_users"; 
foreach($_POST as $key=>$val){$$key=$val;}

$addQuery ='';
if($export_type=='selected' && !empty($prop_id)){
              $addQuery .= " AND prop_id='". $_REQUEST['prop_id'] ."' ";

}

$days = !empty($_REQUEST['days'])?$_REQUEST['days']:7;

    $report_by  = "Booking Date";
		    	
          $datefield  =  'added_date';


          // if(!empty($start_date) || !empty($end_date)){
          //   $addQuery .= " AND ";
          //     if(!empty($start_date)){
          //       $addQuery .= " DATE_FORMAT($datefield,'%Y-%m-%d') >='".$start_date."'";
          //     }
          //     if(!empty($start_date) && !empty($end_date)){
          //       $addQuery .= " AND ";
          //     }
          //     if(!empty($end_date)){
          //       $addQuery .= " DATE_FORMAT($datefield,'%Y-%m-%d') <='".$end_date."'";
          //     }

          // }

                $data = array();
                $temp = array("ID","Name","Username","Contact No", "Email","Address","DOB","Gender","Status","Level","Registered Date","Lifetime Points","Useable Point","Property");
                array_push($data,$temp);

    // $records = Generaluser::find_by_sql("SELECT * FROM " . $moduleTablename . " WHERE type='general' {$addQuery} ORDER BY id DESC ");
    
    // $records = Generaluser::find_by_sql("SELECT * FROM " . $moduleTablename . " WHERE type='general' AND status='1' ".$addQuery." ORDER BY CASE
    //             WHEN MONTH(dob) > MONTH(CURDATE()) OR (MONTH(dob) = MONTH(CURDATE()) AND DAY(dob) >= DAY(CURDATE()))
    //             THEN 0
    //             ELSE 1
    //         END,
    //         MONTH(dob),
    //         DAY(dob);");


      $records = Generaluser::find_by_sql("SELECT * FROM " . $moduleTablename . " WHERE type='general' AND status='1' ".$addQuery." AND 
      DATE_FORMAT(dob, '%m-%d') BETWEEN DATE_FORMAT(CURDATE(), '%m-%d') AND DATE_FORMAT(DATE_ADD(CURDATE(), INTERVAL 7 DAY), '%m-%d')
      ORDER BY DATE_FORMAT(dob, '%m-%d')
      ");

  //     $records = Generaluser::find_by_sql("SELECT * FROM " . $moduleTablename . " WHERE type='general' AND status='1' ".$addQuery." AND 
  //     DATEDIFF(DATE_FORMAT(dob, '%Y-%m-%d'), CURDATE()) BETWEEN 0 AND 191
  // ORDER BY 
  //     DATEDIFF(DATE_FORMAT(dob, '%Y-%m-%d'), CURDATE());
  //     ");


    foreach ($records as $key => $usersInfo){

      $gender ='';
      ($usersInfo->gender == 0)?$gender= "Female" : $gender = "Male";

      $status = '';
      ($usersInfo->status== 1)?$status = "Active":$status = "Inactive";
      
      $level = '';
      $user_get = Generaluser::find_by_id($usersInfo->id);
      $count= Level::greater_level_count($user_get->actual_point);
      $data123 = Level::get_level($user_get->actual_point, $count);   
      ($data123)? $level = $data123[0]->title: $level = 'Undefined';

      $property = Hotelapi::find_by_id($usersInfo->prop_id);

      $temp = array($property->prop_code . "-" . $usersInfo->id,$usersInfo->first_name.' '.$usersInfo->middle_name .' '.$usersInfo->last_name,$usersInfo->username,$usersInfo->contact, $usersInfo->email,$usersInfo->address,$usersInfo->dob,$gender,$status,$level,$usersInfo->added_date,$usersInfo->actual_point,$usersInfo->usable_point,$property->title);
      array_push($data,$temp);
    }

    // Set the content type to CSV
    header('Content-Type: text/csv; charset=utf-8');

    $file = "Member_details_".date('Y_m_d_H_i_s').".csv";
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