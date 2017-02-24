<section>
  <div class="container">
    <article>                          
	<div class="signup-box inner-box">
	  <h3 class="heading-txt">Fogot Password</h3>
	  <?php
            $getMessage = $this->session->flashdata('forgot_message');
            
            if(is_array($getMessage) && count($getMessage) > 0)
            {
                $message_type=$getMessage['type'];
                echo '<div class="'.$message_type.'">'.$getMessage['content'].'</div>';
            }
          ?>
	  <!--info-form 2-->
	  <div class="info-form clearfix">
	    <form name="form"  id="sendResetLink"   action="" method="post" enctype="multipart/form-data" novalidate>
	    <input type="hidden" name="action" value="Process">
	      <div class="form-box">
		<div class="input-box1">
		  <label>Email</label>
		  <input type="text" class="input" name="student_email" type="text" required placeholder="Please enter email address" />
		</div>                   
		<button class="btn-login" type="submit">submit</button>
	      </div><!--form-box-->
	    </form>
	    
	  </div> <!--info-form-->
	  
	  
	</div>
    </article>
  </div>        
</section>