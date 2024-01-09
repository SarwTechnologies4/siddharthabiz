<?php 
// http://www.hotel.com/hblapi/checkout.php

// Merchant ID : 9102634359
// Secrek Key : HSCER3AC4OXSKHMUF0HM6MCKN7PJX8M2
error_reporting(E_ALL);
require_once("../includes/initialize.php");
$api_baseurl      =  BASE_URL;
$api_baseurl_api  =  $api_baseurl.'hblapi/'; ?> 
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>Payment Result</title>
    <link rel="stylesheet" href="<?php echo $api_baseurl_api;?>css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo $api_baseurl_api;?>css/font-awesome.min.css">    
    <link rel="stylesheet" href="<?php echo $api_baseurl_api;?>css/style.css">
</head>
<body class="common">
    <?php $success = $message= $back_url = '';
    if(isset($_POST['paymentGatewayID'])) {        
        foreach($_POST as $key=>$val){$$key=$val;} 
        if ($respCode=='00' AND $failReason=='Approved') {          
            $htl_token   = $userDefined1; $htl_code = $userDefined2;
            $row         =  Bookingmaster::find_by_token($htl_token);
            $fullname    =  $row->first_name." ".$row->last_name;
            $email       =  $row->email; $master_id   =  $row->id;
            $childs      =  Bookingchild::get_info_by($master_id); 
            $hotel_row   =  Hotelapi::find_by_code($htl_code);
            $payment_date  = date("Y-m-d");
            $sql = "UPDATE tbl_apibooking SET has_payment='1',
            transaction_id='$tranRef', payment_date='$payment_date', pay_type='Himalayan Bank', pay_invoice='$invoiceNo', pay_code='$approvalCode', pay_pan='$Pan', approved='1', status='approved' 
            WHERE id='".$master_id."'"; 
            $db->query($sql);                             
            $send_email  =  1;    
            require("send_email.php");
            
            $back_url = addhttp($hotel_row->website).'/result.php?hotel_code='.$hotel_row->code;
            $success = 'Transaction Success'; 
            $message = 'Your booking has been successfully made. We will back you shortly.'; 

        }
        else {
            $htl_code = $userDefined2;
            $hotel_row   =  Hotelapi::find_by_code($htl_code);
            $back_url = addhttp($hotel_row->website).'/result.php?hotel_code='.$hotel_row->code;

            $success = 'Transaction Un-success';
            $message = 'Your booking has been made with incomplete payment. We will back you shortly. <br /> (Error : '.(!empty($failReason)?$failReason:'Canceled').')'; 
        }
        
        // echo '<pre>';
        // print_r($result); exit;
    }
    else {
        redirect_to("http://www.google.com");
    } ?>
    <div class="detail">                   
        <div class="container">
            <div class="row">
                <div class="col-sm-10 centered ">
                    <div class="pg_title text-center">
                        <h1>Hotel Reservation</h1>
                        <h4><small>online hotel reservation result</small></h4>
                    </div>

                    <div class="panel-cont">
                        <div class="search">
                            <div class="row">
                                <div class="col-sm-8 centered field_plate">
                                  .
                                </div>
                            </div>
                        </div>
                        <div class="list_plate">
                            <div class="row">
                                <div class="col-sm-12 ">
                                    <div class="col-sm-3">&nbsp;</div>
                                    <div class="col-sm-6">
                                        <div class="text-center"><h3><?php echo $success;?></h3></div>
                                        <div class="text-center">
                                            <p><?php echo $message;?></p>

                                        </div>
                                    </div>
                                    <div class="col-sm-3">&nbsp;</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>    

        <div class="fix_block">
            <div class="container">
                <div class="row">
                    <div class="col-sm-10 centered text-right">
                        <a href="<?php echo $back_url;?>" class="btn btn-primary btn-xs pull-right">Back</a>
                        <p class="pull-right note">Book now to lock this deal</p>                 
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>
</html>