<section>
  <div class="container">
    <article>                          
	<div class="signup-box">
	  <h3 class="heading-txt">Add Student</h3>
	  <?php
	    $getMessage=flash_message();
	    if(is_array($getMessage) && count($getMessage) > 0)
	    {
		$message_type=$getMessage['type'];
		echo '<div class="'.$message_type.'">'.$getMessage['content'].'</div>';
	    }
	?>
	  <!--info-form 2-->
	  <div class="info-form clearfix">
	    <h4>personal information</h4>
	    <form method="post" action="" enctype="multipart/form-data" id="addStudent">
	    <input type="hidden" name="action" value="Process">
	      <div class="form-box">                      
		<div class="input-box1">
		  <label>First Name</label>
		  <input type="text" class="input" name="student_fname" placeholder="Enter First Name" />
		</div>
		<div class="input-box1">
		  <label>Last Name</label>
		  <input type="text" class="input" name="student_lname" placeholder="Enter Last Name" />
		</div>
		<div class="input-box1">
		  <label>Email</label>
		  <input type="text" class="input" name="student_email" placeholder="Enter Email Address" />
		</div>
		<div class="input-box1">
		  <label>Phone Number</label>
		  <input type="text" class="input" name="student_phone" placeholder="Enter phone Number" />
		</div>                      
		<button class="btn-login" type="submit">submit</button>
		<button type="button" class="btn-login-back" onclick="location.href='<?php echo $return_link; ?>'">Back</button>
	      </div><!--form-box-->
	    </form>               
	    
	  </div> <!--info-form-->
	  
	  
	</div>
    </article>
  </div>        
</section>