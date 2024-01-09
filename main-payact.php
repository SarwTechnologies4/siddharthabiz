<!DOCTYPE html>
<html>
<head>
	<title>Payment Solutions</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script><script>function post_to_url(t,e,n){n=n||"post";var i=document.createElement("form");i.setAttribute("method",n),i.setAttribute("action",t);for(var r in e){var u=document.createElement("input");u.setAttribute("type","hidden"),u.setAttribute("name",r),u.setAttribute("value",e[r]),i.appendChild(u)}document.body.appendChild(i),i.submit()}</script>
</head>
<body>
	<?php if(!empty($_POST['paymentGatewayID'])) {
	$json_data = json_encode($_POST);
	foreach($_POST as $k=>$v) { $$k = $v; }
	if($userDefined2=='local') {
		$redirect_url = 'https://www.payment.rojai.com/payment';
	} else { ?>
        <script type="text/javascript">
            post_to_url('https://www.rojai.com/hblapi/checkout.php', <?php echo $json_data;?>);
        </script>
    <?php $redirect_url = ''; } ?>
	<style>body{margin:0 auto; padding:0px;}</style>
    <div style="margin:0 auto; padding:0px; text-align:center;"><br /><br />
    <img class="retina" alt="logo" src="https://www.payment.rojai.com/vendor/lgo.png"><br /><br /><br />
	    <h2 class="mtitle">Transaction Processing..... Please wait.</h2>
	    <div class="reslt"></div>
	</div>
    <script type="text/javascript">
    jQuery.noConflict();
	(function($) {
    	jQuery.ajax({
            type: "POST",
            dataType:"JSON",
            url: "<?php echo $redirect_url;?>",
            data:<?php echo $json_data;?>,
            success:function(data){
                var msg = eval(data); 
                jQuery('h2.mtitle').html('');
                jQuery('div.reslt').html(msg.result);
            }               
        });    
        return false;	
    })(jQuery);
    </script>
    <?php } else { echo '<script>window.location.href="https://www.google.com";</script>'; exit; } ?>
</body>
</html>