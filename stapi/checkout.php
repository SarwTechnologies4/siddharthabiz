<?php error_reporting(E_ALL);
require_once("../includes/initialize.php");
require_once('my-config.php');

$api_baseurl      =  BASE_URL;
$api_baseurl_api  =  $api_baseurl.'stapi/'; ?> 
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
    if(isset($_POST['stripeToken'])) {

        foreach($_POST as $key=>$val){$$key=$val;} 
        try {
            $customer = \Stripe\Customer::create(array(
                'email'   => $email,
                'source'  => $stripeToken
            ));
                
            $charge = \Stripe\Charge::create(array(
                'customer' => $customer->id,
                'amount'   => ($amount*100),
                'currency' => 'usd',
                'description' => $first_name.' '.$last_name.' ('.$hotel_name.' / Order Id : '.$order_id.')'
            ));
        } catch (\Stripe\Error\ApiConnection $e) {
            // Network communication with Stripe failed
            $_message= $e->getMessage();

        } catch (\Stripe\Error\InvalidRequest $e) {
            // Invalid parameters were supplied to Stripe's API
            $_message= $e->getMessage();

        } catch (\Stripe\Error\Api $e) {
            $_message= $e->getMessage();

        } catch (\Stripe\Error\Card $e) {
            // Since it's a decline, \Stripe\Error\Card will be caught
            $_message= $e->getMessage();

        } catch (\Stripe\Error\RateLimit $e) {
            // Too many requests made to the API too quickly
            $_message= $e->getMessage();

        } catch (\Stripe\Error\Authentication $e) {
            // Authentication with Stripe's API failed
            // (maybe you changed API keys recently)
            $_message= $e->getMessage();

        } catch (\Stripe\Error\Base $e) {
            // Display a very generic error to the user, and maybe send
            // yourself an email
            $_message= $e->getMessage();

        } catch (Exception $e) {
            // Something else happened, completely unrelated to Stripe
            $_message= $e->getMessage();
        }


        if (!empty($charge->id)) {
            
            $transaction_id  =  $charge->id;
            $orderId         =  $order_id;
            $row         =  Bookingmaster::find_by_token($orderId);
            $fullname    =  $row->first_name." ".$row->last_name;
            $email       =  $row->email;
            $master_id   =  $row->id;
            $childs      =  Bookingchild::get_info_by($master_id); 
            // $code        =  $result->transaction->customFields['code'];
            $hotel_row   =  Hotelapi::find_by_code($code);
            $payment_date  = date("Y-m-d");
            $sql = "UPDATE tbl_apibooking SET has_payment='1',
            transaction_id='$transaction_id',
            payment_date='$payment_date',
            pay_type='Stripe',
            approved='1', 
            status='approved' 
            WHERE id='".$master_id."'"; 
            $db->query($sql);                             
            $send_email  =  1;    
            require("send_email.php");
            
            $success = 'Transaction Success'; 
            $message = 'Your booking has been successfully made. We will back you shortly.'; 

        }
        else {
            $success = 'Transaction Un-success';
            $message = 'Your booking has been made with incomplete payment. We will back you shortly. <br /> (Error : '.$_message.')'; 
        }

        $back_url = $website_url;
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