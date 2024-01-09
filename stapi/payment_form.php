<?php require_once("../includes/initialize.php");
require_once('my-config.php');
$session_id = session_id(); 
$_SESSION['the_token']  = $session_id;
$api_baseurl      =  BASE_URL;
$api_baseurl_api  =  $api_baseurl.'stapi/';
$row         =  Bookingmaster::find_by_token($token_code); ?>
<form id="api_checkout" method="post" action="<?php echo $api_baseurl_api;?>checkout.php">    
    <input type="hidden" name="amount" value="<?php echo $row->grand_total;?>">
    <input type="hidden" name="order_id" value="<?php echo $token_code;?>">      
    <input type="hidden" name="first_name" value="<?php echo $row->first_name;?>">
    <input type="hidden" name="last_name" value="<?php echo $row->last_name;?>">
    <input type="hidden" name="contact_no" value="<?php echo $row->contact_no;?>">
    <input type="hidden" name="email" value="<?php echo $row->email;?>">
    <input type="hidden" name="cnt_address" value="<?php echo $row->address;?>">
    <input type="hidden" name="cnt_city" value="<?php echo $row->city;?>">
    <input type="hidden" name="cnt_zipcode" value="<?php echo $row->zipcode;?>">
    <input type="hidden" name="cnt_country" value="<?php echo $row->country_code;?>">
    <input type="hidden" name="code" value="<?php echo $row->hotel_code;?>">
    <input type="hidden" name="website_url" value="<?php echo $current_page;?>">
    <script>
        var submittedForm = false;
        var hotel_logo = jQuery('div.htinfo > img').attr('src');
        var hotel_name = jQuery('div.htinfo > h1').html();
        var handler = StripeCheckout.configure({
            key: '<?php echo $stripe['publishable_key']; ?>',
            image: hotel_logo,
            locale: 'auto',
            token: function(token) {
                submittedForm = true;
                $('form#api_checkout').append('<input type="hidden" name="stripeToken" value="'+token.id+'"><input type="hidden" name="hotel_name" value="'+hotel_name+'">');                
                // You can access the token ID with `token.id`.
                // Get the token ID to your server-side code for use.
            }
        });
        
        $(document).ready(function(e) {
            // Open Checkout with further options:
            handler.open({
                name: hotel_name,
                description: 'Order Id : <?php echo $token_code;?>',
                amount: parseInt(<?php echo ($row->grand_total*100);?>),
                closed: function () {
                    if(submittedForm == false)
                        window.location.href='<?php echo $current_page;?>';
                    else 
                        $('form#api_checkout').submit();
                }           
            });
        });
    </script>
</form>