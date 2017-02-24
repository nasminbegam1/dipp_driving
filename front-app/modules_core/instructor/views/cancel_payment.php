<section>
  <div class="container">
    <article>                          
	<div class="signup-box inner-box">
	  <h3 class="heading-txt">Cancel payment</h3>
            <?php
                $getMessage=$this->session->flashdata('message');
                if(is_array($getMessage) && count($getMessage) > 0)
                {
                    $message_type=$getMessage['type'];
                    echo '<div class="'.$message_type.'">'.$getMessage['content'].'</div>';
                }
            ?>
	  <!--info-form 2-->
	  <div class="info-form clearfix">
	    If you cancel your membership you cannot reactivate your account. All 'active' students will lose
access following cancellation.<br><br>
            <a href="<?php echo base_url().'instructor/profile_cancel/';?>">Click here</a> to cancel your membership.
	  </div> <!--info-form-->
	  
	  
	</div>
    </article>
  </div>        
</section>