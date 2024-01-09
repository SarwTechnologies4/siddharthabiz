<?php require_once("../includes/initialize.php");
$session_id = session_id(); 
$_SESSION['the_token']  = $session_id;
$api_baseurl      =  BASE_URL;
$api_baseurl_api  =  $api_baseurl.'nabilapi/';
$row         =  Bookingmaster::find_by_token($token_code); 
$htrow   =  Hotelapi::find_by_code($row->hotel_code);

// 
$merchant_id = $htrow->merchant_id;
$orderId = $token_code;
$txtamount = $row->grand_total;
$xmlamount = ($row->grand_total * 100);

$tran_url = ($htrow->nabil_mode==1)?'https://nabiltest.compassplus.com:8444':'https://nabilpg.compassplus.com:8443';
$cert_file = SITE_ROOT.'images/hotelapi/docs/'.$htrow->twpg_cert_file; //current folder
$key_file = SITE_ROOT.'images/hotelapi/docs/'.$htrow->twpg_key_file; //curent folder    
$key_password = '';

$request = '<?xml version="1.0" encoding="UTF-8"?>
<TKKPG>
    <Request>
    <Operation>CreateOrder</Operation>
    <Language>EN</Language>
    <Order>
        <OrderType>Purchase</OrderType>
        <Merchant>'.$merchant_id.'</Merchant>
        <Amount>'.$xmlamount.'</Amount>
        <Currency>840</Currency>
        <Description>Order Id : '.$orderId.'</Description>
        <ApproveURL>'.BASE_URL.'nabilapi/checkout/'.$row->hotel_code.'</ApproveURL>
        <CancelURL>'.BASE_URL.'nabilapi/checkout/'.$row->hotel_code.'</CancelURL>
        <DeclineURL>'.BASE_URL.'nabilapi/checkout/'.$row->hotel_code.'</DeclineURL>
        <Fee>0</Fee>
    </Order>
    </Request>
</TKKPG>';

error_log(print_r($request.'- '.$htrow->title,true), 3, SITE_ROOT."/paylog/create_order.log");
$response = sendRequest($request, $tran_url, $cert_file, $key_file, $key_password);
$data = simplexml_load_string($response);
$data = json_encode($data);
$data = json_decode($data);         
$status = $data->Response->Status;
if($status=='00') {
    $order_id = $data->Response->Order->OrderID;
    $session_id = $data->Response->Order->SessionID;
    $url = $data->Response->Order->URL; 
    $haxorder = substr($data->Response->Order->OrderID, 13);
    $decode = ($htrow->nabil_mode==1)?'0123456789abcdef':'5D30E8E794F2780D';
    $getOrder = hex2bin(bin2hex(decrypt($haxorder, $decode)));
    error_log(print_r($response.'- '.$htrow->title.' : '.$getOrder,true), 3, SITE_ROOT."/paylog/response_order.log");
    $query="UPDATE tbl_apibooking SET 
    nabil_orderid   = '".$getOrder."',
    nabil_sessionid = '".$session_id."',
    nabil_order_desc= 'Order Id : ".$orderId."'
    WHERE id ='".$row->id."' "; 
    $db->query($query); ?>
    <form name="nabilform" action="<?php echo $url;?>" method="post">
        <input type="hidden" id="merid" name="merid" value="<?php echo $merchant_id;?>"/>
        <input type="hidden" id="Version" name="Version" value="1.0">
        <input type="hidden" id="OrderID" name="OrderID" value="<?php echo $order_id;?>" />
        <input type="hidden" id="SessionID" name="SessionID" value="<?php echo $session_id;?>" />
        <input type="hidden" id="Language" name="Language" value="EN" />
        <input type="hidden" id="VisualAmount" name="VisualAmount" value="<?php echo $txtamount;?>" />
        <input type="hidden" id="PurchaseAmount" name="PurchaseAmount"  value="<?php echo $xmlamount;?>"/>            
        <input type="hidden" id="btnSubmit" name="btnSubmit" value="Submit"/>
    </form>
    <script type="text/javascript">document.nabilform.submit();</script>                
<?php } else { echo 'Error ! Please check the inputs !'; }?>
