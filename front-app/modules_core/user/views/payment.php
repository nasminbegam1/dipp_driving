<div class="content">
    	<div class="page-title">
            <h1>Payment Process</h1>
        </div>
<div class="textCenter">
	<span>
		<i class="fa fa-spinner fa-spin"></i>
		<br/>
		Please wait, you are redirecting to paypal interface for payment.
	</span>
</div>
</div>
<form id = "paypal_checkout" action="<?php echo $url ;?>" method="post">
		    <!--<input type="hidden" name="cmd" value="_xclick">-->
		    <input name = "cmd" value = "_cart" type = "hidden">
		    <input name = "upload" value = "1" type = "hidden">
		    <input name = "no_note" value = "0" type = "hidden">
		    <input name = "bn" value = "PP-BuyNowBF" type = "hidden">
		    <input name = "tax" value = "0" type = "hidden">
		    <input name = "rm" value = "2" type = "hidden">
		    <input type="hidden" name="business" value="<?php echo $business_email_id ?>" >
		    <input name = "handling_cart" value = "0" type = "hidden">
		    
		    <div id = "item_1" class = "itemwrap">
		    <input name = "item_name_1" value = "<?php echo $title ; ?>" type = "hidden">
		    <input name = "quantity_1" value = "1" type = "hidden">
		    <input name = "amount_1" value = "<?php echo $amount ?>" type = "hidden">
		    </div>
		   
		    <input type="hidden" name="currency_code" value="EUR">
		    <input name = "return" value = "<?php echo $return_url ;?>" type = "hidden">
		    <input name = "cbt" value = "Return to My Site" type = "hidden">
		    <input name = "cancel_return" value = "<?php echo $cancel_url ; ?>" type = "hidden">
		    <input type="hidden" name="notify_url" value="<?php echo $notification_url ?>">
		    <input type="hidden" name="custom" value="<?php echo $course_id.'@#'.$user_id; ?>"> 
</form>			
			

<!-- END PAGE CONTENT -->
<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
<script>

     
    $(document).ready(function() {   
  	
	$('#paypal_checkout').submit();

    });


</script>