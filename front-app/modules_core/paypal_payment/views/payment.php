<div class="content">
    	<div class="page-title">
            <h1>Payment Process</h1>
        </div>
<div class="textCenter">
	<span style="color:#00349a;">
		<i class="fa fa-spinner fa-spin" style="font-size:80px;"></i>
		<br/>
		Please wait, you are redirecting to paypal interface for payment.
	</span>
</div>
</div>
<form  name="form_paypal" id="paypal_form" action="<?php echo $url ;?>" method="post">


    <input type="hidden" name="cmd" value="_xclick-subscriptions" /> 
    <input type="hidden" name="business" value="<?php echo $business_email_id ?>">
    
    <input type="hidden" name="a1" value="0">
    <input type="hidden" name="p1" value="14">
    <input type="hidden" name="t1" value="D">
    
    
    <input type="hidden" name="a3"  value="<?php echo $amount;?>" />
    <input type="hidden" name="t3" value="M" >
    <input type="hidden" name="p3" value="1" >
     <input type="hidden" name="custom" value="<?php echo $package_id.'@'.$amount.'@'.$ins_id; ?>"> 
        
    <input type="hidden" name="src" value="1" >
    <input type="hidden" name="no_note" value="1" />
    
    <input type="hidden" name="lc" value="US" />
    <input type="hidden" name="currency_code" value="GBP" />
  
    <input type="hidden" name="first_name" value= "<?php echo $fname; ?>"  />
    <input type="hidden" name="last_name" value="<?php echo $lname; ?>"  />
    <input type="hidden" name="item_number" value="<?php echo $package_id; ?>" />
    <input type="hidden" name="item_name" value="Instructor Payment" />

    <input type="hidden" name="notify_url" value="<?php echo $notification_url ?>" />
    <input name="return" type="hidden" value="<?php echo $return_url ?>">
    <input name="cancel_return" type="hidden" value="<?php echo $cancel_url ; ?>">



</form>			
			

<!-- END PAGE CONTENT -->
<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
<script>

     
    $(document).ready(function() {   
  	
	$('#paypal_form').submit();

    });


</script>