<?php require_once("../includes/initialize.php");
$session_id = session_id(); 
$_SESSION['the_token']  = $session_id;
$api_baseurl      =  BASE_URL;
$api_baseurl_api  =  $api_baseurl.'hblapi/';
$row         =  Bookingmaster::find_by_token($token_code); 
$htrow   =  Hotelapi::find_by_code($row->hotel_code);

$new_amt = sprintf('%0.2f', $row->grand_total);
$prcNumric = filter_var($new_amt, FILTER_SANITIZE_NUMBER_INT);
$amount_con = $prcNumric;
$amount_con_length = strlen($amount_con);
for($length=$amount_con_length;$length < 12;$length++){
    $amount_con = '0'.$amount_con;  
}
// echo $amount = str_pad($row->grand_total, 12, "0", STR_PAD_LEFT); ?>
<form method="post" action="https://hblpgw.2c2p.com/HBLPGW/Payment/Payment/Payment" id="himalayan">
    <input id="paymentGatewayID" name="paymentGatewayID" value="<?php echo $htrow->merchant_id;?>" type="hidden">
    <input id="invoiceNo" name="invoiceNo" value="<?php echo $token_code.'/'.date('dMy');?>" type="hidden">
    <input id="productDesc" name="productDesc" value="<?php echo $htrow->title.' : '. date('YMd', strtotime($row->checkin_date));?> To <?php echo date('YMd', strtotime($row->checkout_date));?>" type="hidden">
    <input id="amount" name="amount" value="<?php echo $amount_con;?>" type="hidden">
    <input id="currencyCode" name="currencyCode" value="840" type="hidden">
    <input id="userDefined1" name="userDefined1" value="<?php echo $row->booking_code;?>" type="hidden">
    <input id="userDefined1" name="userDefined2" value="<?php echo $row->hotel_code;?>" type="hidden">
    <input id="nonSecure" name="nonSecure" value="Y" type="hidden">
    <input id="hashValue" name="hashValue" value="<?php echo $htrow->merchant_key;?>" type="hidden">
    <input value="Confirm Order" class="btn btn-primary hide" data-loading-text="Loading..." type="submit">   
</form>
<script>jQuery('form#himalayan').submit();</script>