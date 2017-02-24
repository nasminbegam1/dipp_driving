<div class="content">
    	<div class="page-title">
            <h1>Payment Process</h1>
        </div>
<div class="textCenter">
	<span style="color:#00349a;">
		<i class="fa fa-spinner fa-spin" style="font-size:80px;"></i>
		<br/>
		Please wait, you are redirecting to worldpay interface for payment.
	</span>
</div>
</div>

	<!--<form name="worldpay_form" id="worldpay_form" action='https://secure-test.worldpay.com/wcc/purchase' method=post>-->
	<form name="worldpay_form" id="worldpay_form" action='https://secure.worldpay.com/wcc/purchase' method=post>
	<input type='hidden' name='instId' value='1122547'/>
	<input type='hidden' name='cartId' value='<?php echo $custom;?>'/>
	<input type="hidden" name="amount" value="<?php echo $amount; ?>" />
	<input type='hidden' name='currency' value='GBP'/>
	<input type='hidden' name="MC_type" value="passGuaranteePayment">
	<input type="hidden" name="desc" value="<?php echo 'Theory Test Booking with Pass Guarantee'; ?>" />
	<input type='hidden' name='accId1' value='DUTCHURSTSOLM1'/>
	<!--<input type='hidden' name='testMode' value='100'/>-->
	<input type='hidden' name='testMode' value='0'/>
	</form>
			

<!-- END PAGE CONTENT -->
<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
<script>
    $(document).ready(function() {   
  	
	$('#worldpay_form').submit();

    });
</script>