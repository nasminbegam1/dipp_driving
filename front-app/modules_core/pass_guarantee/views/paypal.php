<div class="wrap">
<div class="paypal-payment-details">
<h2 class="payment-processing">Your Payment Is processing..</h2>
<div class="payment-loader"><img src="<?php echo base_url(); ?>images/bx_loader.gif" alt="Mountain View"></div>
</div>
<form action="https://www.paypal.com/cgi-bin/webscr" method="post" name="paypal" id="paypal">
    <input type="hidden" name="cmd" value="_xclick" />
    <input type='hidden' name='business' value='payment@dutchurst.co.uk'>
    <input type="hidden" name="cbt" value="Return to Your Site" />
    <input type='hidden' name='currency_code' value='GBP'>

    <!-- Allow the customer to enter the desired quantity -->
    <input type="hidden" name="quantity" value="1" />
    <input type="hidden" name="item_name" value="<?php echo $course.' theory test with unlimited re-tests'; ?>" />

    <!-- Custom value you want to send and process back in the IPN -->
    <input type="hidden" name="custom" value="<?php echo $custom; ?>" />
    <input type="hidden" name="amount" value="<?php echo $amount; ?>" />
    <input type="hidden" name="return" value="<?php echo base_url(); ?>pass_guarantee/paypal_success"/>
    <input type="hidden" name="cancel_return" value="<?php echo base_url(); ?>pass_guarantee/paypal_cancel" />

    <!-- Where to send the PayPal IPN to. -->
    <input type="hidden" name="notify_url" value="<?php echo base_url(); ?>pass_guarantee/paypal_notify" />
</form>
</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function(){
    $("#paypal").submit();
});
</script>