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
            <form method="post" action="" id="editInstractorProfile" enctype="multipart/form-data">
                <input type="hidden" name="action" value="Process">
              <div class="form-box">
                <div class="input-box1">
                  <label>Business Name</label>
                  <input type="text" class="input" name="instructor_business_name" value="<?php echo $ins_details[0]['instructor_business_name']; ?>" data-required="true"/>
                </div>
                <div class="input-box1">
                  <label>First Name</label>
                  <input type="text" class="input" name="instructor_fname" value="<?php echo $ins_details[0]['instructor_fname']; ?>" placeholder="Enter first name" />
                </div>
                <div class="input-box1">
                  <label>Last Name</label>
                  <input type="text" class="input" name="instructor_lname" value="<?php echo $ins_details[0]['instructor_lname']; ?>" placeholder="Enter last name" />
                </div>
                <div class="input-box1">
                  <label>Email</label>
                  <input type="text" class="input" readonly="readonly" name="instructor_email" value="<?php echo $ins_details[0]['instructor_email']; ?>" />
                </div>
                <div class="input-box1">
                  <label>Post Code</label>
                  <input type="text" class="input" name="zip_code" value="<?php echo $ins_details[0]['zip_code']; ?>" placeholder="Enter post code">
                </div>
              </div><!--form-box-->
              
              <div class="form-box">
                <div class="input-box1">
                  <label>Phone Number</label>
                  <input type="text" class="input" name="instructor_phone_number" value="<?php echo $ins_details[0]['instructor_phone_number']; ?>" placeholder="Enter phone name">
                </div>
                <div class="input-box1">
                  <label>Address</label>
                  <textarea name="instructor_address" class="input instractor_address"><?php echo $ins_details[0]['instructor_address']; ?></textarea>
                </div>
                <div class="input-box1 <?php echo ($ins_details[0]['instructor_logo'] != '' && file_exists(FILE_UPLOAD_ABSOLUTE_PATH.'instructor_logo/'.$ins_details[0]['instructor_logo']))?'instructorLogo':''; ?>">
                  <label>Logo</label>
                    <input type="file" name="instructor_logo">
                    <?php if($ins_details[0]['instructor_logo'] != '' && file_exists(FILE_UPLOAD_ABSOLUTE_PATH.'instructor_logo/'.$ins_details[0]['instructor_logo'])){ ?>
                    <img src="<?php echo FILE_UPLOAD_URL.'instructor_logo/'.$ins_details[0]['instructor_logo'];?>" height="100" width="100">
                    <?php } ?>
                </div>
              </div><!--form-box-->
            <button class="btn-login" type="submit">submit</button>
            <button class="btn-login-back" type="button" onclick="location.href='<?php echo FRONTEND_URL.'instructor/dashboard'; ?>'">Back</button>
            </form>
          </div> <!--info-form-->
        </div>
    </article>
  </div>        
</section>
