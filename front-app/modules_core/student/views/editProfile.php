<section>
  <div class="container">
    <article>                          
        <div class="signup-box">
          <h3 class="heading-txt">Edit profile</h3>
          <?php
            $getMessage=flash_message();
            if(is_array($getMessage) && count($getMessage) > 0)
            {
                $message_type=$getMessage['type'];
                echo '<div class="'.$message_type.'">'.$getMessage['content'].'</div>';
            }
          ?>
          <!--info-form 1-->
          <div class="info-form clearfix">
            <h4>personal information</h4>
            <form name="form" id="editProfile" action="" method="post" enctype="multipart/form-data" novalidate>
                <input type="hidden" name="action" value="Process">
              <div class="form-box">
                <div class="input-box1">
                  <label>First Name</label>
                  <input type="text" class="input" name="student_fname" required value="<?php echo $std_details[0]['student_fname']!=''?stripslashes($std_details[0]['student_fname']):'';?>" placeholder="Enter first name"/>
                </div>
                <div class="input-box1">
                  <label>Last Name</label>
                  <input type="text" class="input" name="student_lname" id="user_lname" required value="<?php echo $std_details[0]['student_lname']!=''?stripslashes($std_details[0]['student_lname']):'';?>" placeholder="Enter last name" />
                </div>
                
              </div><!--form-box-->
              
              <div class="form-box">
                <div class="input-box1">
                  <label>Phone Number</label>
                  <input type="text" class="input" name="student_phone" id="student_phone" required value="<?php echo $std_details[0]['student_phone']!=''?stripslashes($std_details[0]['student_phone']):'';?>" placeholder="Enter user last name">
                </div>
                <div class="input-box1">
                  <label>Email</label>
                  <input type="text" class="input" readonly value="<?php echo $std_details[0]['student_email']!=''?stripslashes($std_details[0]['student_email']):'';?>" />
                </div>
              </div><!--form-box-->
            <button class="btn-login" type="submit">submit</button>
            </form>
          </div> <!--info-form-->
        </div>
    </article>
  </div>        
</section>
