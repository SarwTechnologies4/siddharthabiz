<?php 
require_once("../includes/initialize.php");
ob_start();
$session_id = session_id(); 
$_SESSION['the_token']  = $session_id;
$api_baseurl      =  BASE_URL;
$api_baseurl_api  =  $api_baseurl.'nabilapi/';
$checkin   =  isset($_POST['apifield_checkin']) ? $_POST['apifield_checkin'] :'';
$checkout  =  isset($_POST['apifield_checkout']) ? $_POST['apifield_checkout'] :'';
$nofnight  =  getDaysDiff($checkin,$checkout);
$code  =  isset($_POST['hotel_code']) ? $_POST['hotel_code'] : '';
if(empty($code)){ die('Sorry Hotel Code is not provided!');}
foreach($_POST as $key=>$val){$$key=$val;} 
$currency_arr  =  array('USD'=>'USD','EUR'=>'€');
if(in_array($currency,$currency_arr)){
  $currency_symbol  =  $currency_arr[$currency];
}else{
  $currency_symbol  =  $currency;
} ?>
<h3 class="roomdetail_title my-4 text-start">Room Details</h3>
<div class="form-group">
    <div class="row">
        <div class="col-sm-6 text-start">
            <label class="control-label  labeldetail text-start">From</label> 
            <input type="text" name="api_checkin" id="api_checkin" class="form-control" placeholder="Checkin" value="<?php echo $checkin;?>" readonly='readonly' >
        </div>
        <div class="col-sm-6 text-start">
            <label class="control-label  labeldetail text-start">To</label><br>
            <input type="text" name="api_checkout" id="api_checkout" class="form-control" placeholder="Checkout" value="<?php echo $checkout;?>" readonly='readonly' >
        </div>      
    </div>
</div><br />
<?php $sub_total_all  = array_sum($sub_total);
$service_charge =  round(($sub_total_all*0.1),2);
$total_without_tax = $sub_total_all+$service_charge;
$tax =  round(($total_without_tax*0.13),2);
$grand_total =  round(($tax+$total_without_tax),2);
foreach($no_of_room as $key=>$val): if(!empty($val)){ ?>
    <input type="hidden" name="api_room[<?php echo $key;?>]" value="<?php echo $key;?>">  
    <input type="hidden" name="api_no_of_room[<?php echo $key;?>]" value="<?php echo $val;?>">
    <?php foreach($adult_sub[$key] as $k=>$v) {
        $newAdult = $adult_sub[$key][$k];
        $newChild = $child_sub[$key][$k];
        $newExtrabed = $extra_bed_sub[$key][$k]; 
        $newPrice = 0;
        if($newAdult=='3') {
            $newPrice = $price_list[$key][3];
        }
        if($newAdult=='2') {
            $newPrice = $price_list[$key][2];
        }
        if($newAdult=='1') {
            $newPrice = $price_list[$key][1];
        } ?>
        <input type="hidden" name="api_room_label[<?php echo $key;?>][]" value="<?php echo $room_id[$key];?>">
        <input type="hidden" name="api_adult[<?php echo $key;?>][]" value="<?php echo $newAdult;?>">
        <input type="hidden" name="api_child[<?php echo $key;?>][]" value="<?php echo $newChild;?>">
        <input type="hidden" name="api_extra_bed[<?php echo $key;?>][]" value="<?php echo $newExtrabed;?>">
        <input type="hidden" name="api_room_price[<?php echo $key;?>][]" value="<?php echo $newPrice;?>">
    <?php } ?>
    <input type="hidden" name="api_sub_total[<?php echo $key;?>]" value="<?php echo $sub_total[$key];?>">
    <?php } endforeach;?>
    <input type="hidden" name="code" value="<?php echo $code;?>">
    <input type="hidden" name="api_currency" value="<?php echo $currency;?>">
    <input type="hidden" name="api_currency_symbol" value="<?php echo $currency_symbol;?>">
    <input type="hidden" name="api_sub_total_all" value="<?php echo $sub_total_all;?>">
    <input type="hidden" name="api_service_charge" value="<?php echo $service_charge;?>">
    <input type="hidden" name="api_tax" value="<?php echo $tax;?>">
    <input type="hidden" name="api_grand_total" value="<?php echo $grand_total;?>">
    
    <div class="bill">
        <table class="table">                
            <?php foreach($no_of_room as $key=>$val): if(!empty($val)){
            $adult_no  =  sizeof($adult_sub[$key])>0 ? array_sum($adult_sub[$key]) : 0;
            $child_no  =  sizeof($child_sub[$key])>0 ? array_sum($child_sub[$key]) : 0;
            $extra_bed_no  =  sizeof($extra_bed_sub[$key])>0 ? array_sum($extra_bed_sub[$key]) : 0; ?>
            <tr>
                <td class="room_detail_info">
                    <div class="room_title text-start"><strong><?php echo $room_id[$key];?></strong> x <span><?php echo $val;?></span></div>
                    <div class="pax group">
                        <div><?php echo $adult_no;?> Adult</div>
                        <div><?php echo $child_no;?> Child</div>
                        <div><?php echo $extra_bed_no;?> Extra Bed</div>
                    </div>
                </td>
                <td class="room_amt"><?php echo $currency_symbol;?><?php echo $sub_total[$key];?></td>
            </tr>
            <?php } endforeach;?>

            <tr>
                <td class="text-start">Sub Total</td>
                <td class="amt"><?php echo $currency_symbol;?><?php echo $sub_total_all;?></td>
            </tr>
            <tr>
                <td class="text-start">Service Charge</td>
                <td class="amt"><?php echo $currency_symbol;?><?php echo $service_charge;?></td>
            </tr>
            <tr>
                <td class="text-start">Tax</td>
                <td class="amt"><?php echo $currency_symbol;?><?php echo $tax;?></td>
            </tr>
            <tr>
                <td class="total text-start">Grand Total</td>
                <td class="totamt"><?php echo $currency_symbol;?><?php echo $grand_total;?></td>
            </tr>
        </table>
    </div>

    <h3 class="roomdetail_title my-4 text-start">Pay With</h3>
    <div class="row">
        <div class="form-group">
            <div class="col-sm-12">  
                <p>
                    <!-- <label><input type='radio' name="payment_method" value="nabilBank" checked="checked"> <img class="img-responsive hide-radio" src="<?php echo $api_baseurl_api.'images/nabil.png';?>"  alt="paylog" width="210px" style="position: relative;float: right;"> --->
                    <!-- <i class="fa fa-cc-paypal fa-3x" aria-hidden="true"></i> <i class="fa fa-cc-mastercard fa-3x" aria-hidden="true"></i> <i class="fa fa-cc-visa fa-3x" aria-hidden="true"></i> <i class="fa fa-credit-card fa-3x" aria-hidden="true"></i> --> </label>
                <?php $rows = Hotelapi::find_by_code($code); 
                if(!empty($rows) AND $rows->inquiry_type==2) { ?>
                <!-- <label><input type='radio'  name="payment_method" value="pay_later"> <img class="img-responsive hide-radio" src="<?php echo $api_baseurl;?>hblapi/images/inquiry.png" width="210px" style="position: relative;float: right;width: 170px; top: -10px;"></label> -->
                <?php } else { ?> <style>img.hide-radio{ left: 5px; }</style> <?php } ?></p>
                <label><input type='radio'  name="payment_method" value="pay_later" checked="checked"> <img class="img-responsive hide-radio" src="<?php echo $api_baseurl;?>hblapi/images/inquiry.png" width="210px" style="position: relative;float: right;margin-left:20px;width: 170px; top: -10px;"></label>
            </div>
        </div>
        <br />
        <div class="form-group">
            <div class="col-sm-12">
                <input type="submit" name="api_submitBtn" id="api_submitBtn" value="Book Now" class="btn btn-primary button_submit_now btn-xs">
                <input type="button" name="api_backBtn" id="api_backBtn" value="Back" class="btn btn-default btn-xs">
            </div>
        </div>
    </div>
<?php
$html  =  ob_get_clean();
die(json_encode(array('result'=>'true','html'=>$html)));