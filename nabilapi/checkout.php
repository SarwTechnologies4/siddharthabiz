<?php 
error_reporting(E_ALL);
require_once("../includes/initialize.php");
$api_baseurl      =  BASE_URL;
$api_baseurl_api  =  $api_baseurl.'nabilapi/'; 
$hcode = addslashes($_REQUEST['hcode']);
$nRow   = $hotel_row =  Hotelapi::find_by_code($hcode); ?> 
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
    <?php $xml = !empty($_POST['xmlmsg'])?$_POST['xmlmsg']:'';
    $data = simplexml_load_string($xml);
    $data = json_encode($data);
    $data = json_decode($data);

    if(!empty($data) and !empty($nRow)) {
        $bsql = "SELECT * FROM tbl_apibooking WHERE nabil_orderid = '".$data->OrderID."' LIMIT 1 ";
        $bquery = $db->query($bsql); $row = $db->fetch_object($bquery);
        $tran_url = ($nRow->nabil_mode==1)?'https://nabiltest.compassplus.com:8444':'https://nabilpg.compassplus.com:8443';
        $cert_file = SITE_ROOT.'images/hotelapi/docs/'.$nRow->twpg_cert_file; //current folder
        $key_file = SITE_ROOT.'images/hotelapi/docs/'.$nRow->twpg_key_file; //curent folder    
        $key_password = '';
        $oxml='<?xml version="1.0" encoding="UTF-8"?>
        <TKKPG>
            <Request>
                <Language>EN</Language>
                <Operation>GetOrderStatus</Operation>
                <Order>
                    <Merchant>'.$nRow->merchant_id.'</Merchant>
                    <OrderID>'.$data->OrderID.'</OrderID>
                </Order>
                <SessionID>'.$row->nabil_sessionid.'</SessionID>
            </Request>
        </TKKPG>';

        error_log(print_r($oxml,true), 3, SITE_ROOT."/paylog/request_confirm.log");
        $oresponse = sendRequest($oxml, $tran_url, $cert_file, $key_file, $key_password);
        error_log(print_r($oresponse,true), 3, SITE_ROOT."/paylog/order_confirm.log");

        $ostatus = simplexml_load_string($oresponse);
        $ostatus = json_encode($ostatus);
        $ostatus = json_decode($ostatus);

        $success = $message= '';
        $back_url = addhttp($nRow->website).'/result.php?hotel_code='.$nRow->code;
        // $back_url = 'https://www.rojai.com/nabilapi/result.php?hotel_code='.$nRow->code;
        if($ostatus->Response->Status=='00') {

            // 
            if($data->OrderStatus=='APPROVED') {
                //             
                $query="UPDATE tbl_apibooking SET 
                nabil_prn   = '".addslashes(@$data->RRN)."',                             
                nabil_pan   = '".addslashes($data->PAN)."',
                nabil_card  = '".addslashes($data->Brand)."',
                nabil_cardholder    = '".addslashes($data->Name)."',
                nabil_order_status  = '".addslashes($data->OrderStatusScr)."',
                nabil_response_desc = '".addslashes($data->ResponseDescription)."',
                nabil_marchant_id   = '".addslashes($data->MerchantTranID)."',
                nabil_approved_id   = '".addslashes($data->ApprovalCodeScr)."',
                nabil_approved_amt  = '".addslashes($data->PurchaseAmountScr)."',
                nabil_approved_currency = '".addslashes($data->CurrencyScr)."',
                nabil_approved_datetime = '".addslashes($data->TranDateTime)."',
                has_payment = '1', pay_type = 'nabilBank', 
                approved = '1', status = 'approved' WHERE id='".$row->id."' "; 
                $db->query($query);
                $fullname    =  $row->first_name." ".$row->last_name;
                $email       =  $row->email; $master_id   =  $row->id;
                $childs      =  Bookingchild::get_info_by($master_id); 

                $send_email  =  1;    
                require("send_email.php");

                $success = 'Transaction Success'; 
                $message = 'Your booking has been successfully made. We will back you shortly.'; 
            } 
            
            // 
            if($data->OrderStatus=='DECLINED') {

                $query="UPDATE tbl_apibooking SET 
                nabil_pan = '$data->PAN',
                nabil_card = '$data->Brand',
                nabil_cardholder = '$data->Name',
                nabil_order_status  = '$data->OrderStatusScr',
                nabil_response_desc = '$data->ResponseDescription'
                WHERE id='".$row->id."' "; 
                $db->query($query);

                $success = 'Transaction Un-success';
                $message = 'Your booking has been made with incomplete payment. We will back you shortly. <br /> (Error : '.$data->OrderStatusScr.')'; 
            }
            
            // 
            if($data->OrderStatus=='CANCELED') {
                $query="UPDATE tbl_apibooking SET nabil_order_status  = '$data->OrderStatusScr' WHERE id='".$row->id."' "; 
                $db->query($query);

                $success = 'Transaction Un-success';
                $message = 'Your booking has been made with incomplete payment. We will back you shortly. <br /> (Error : '.$data->OrderStatusScr.')'; 
            }
        }
    }
    else {
        redirect_to("https://www.google.com");
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