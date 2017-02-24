<section>
  <div class="container">
    <article>                          
	<div class="signup-box inner-box">
	  <h3 class="heading-txt">Reset Password</h3>
            <?php
                $getMessage=$this->session->flashdata('forgot_message');
                if(is_array($getMessage) && count($getMessage) > 0)
                {
                    $message_type=$getMessage['type'];
                    echo '<div class="'.$message_type.'">'.$getMessage['content'].'</div>';
                }
            ?>
	  <!--info-form 2-->
	  <div class="info-form clearfix">
	    <form name="form" id="resetPassword" action="" method="post" enctype="multipart/form-data" novalidate>
	    <input type="hidden" name="action" value="Process">
	      <div class="form-box">                      
		<div class="input-box1">
		  <label>New password</label>
		  <input class="input" name="new_password" type="password" id="new_password" required placeholder="Enter new password" />
		</div>
		<div class="input-box1">
		  <label>Confirm password</label>
		  <input class="input" name="confirm_password" type="password" required placeholder="Enter confirm password"/>
		</div>               
		<button class="btn-login" type="submit">Reset Password</button>
	      </div><!--form-box-->
	    </form>              
	    
	  </div> <!--info-form-->
	  
	  
	</div>
    </article>
  </div>        
</section>