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

	<form name="worldpay_form" id="worldpay_form" action='<?php echo $url ;?>' method=post>
	<input type='hidden' name='instId' value='1124265'/>
	<input type='hidden' name='cartId' value='<?php echo $ins_id;?>'/>
	<input type='hidden' name='currency' value='GBP'/>
	<input type='hidden' name='futurePayType' value='regular'/>
	<input type='hidden' name='option' value='0'/>
	<input type='hidden' name='startDate' value='<?php echo $start_date; ?>'/>
	<input type='hidden' name='endDate' value='<?php echo $end_date; ?>'/>
	<input type='hidden' name='noOfPayments' value='0'/>
	<input type='hidden' name="MC_type" value="signupPayment">
	<input type='hidden' name='intervalUnit' value='3'/>
	<input type='hidden' name='intervalMult' value='1'/>
	<input type='hidden' name='normalAmount' value='<?php echo $amount; ?>'/>
	<input type='hidden' name='desc' value='<?php echo $desc; ?>'/>
	<input type='hidden' name='accId1' value='DUTCHURSTSOLM2'/>
	<input type='hidden' name='testMode' value='0'/>
	</form>
			

<!-- END PAGE CONTENT -->
<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
<script>
    $(document).ready(function() {   
  	
	$('#worldpay_form').submit();

    });
</script>