<section>
  <div class="container">
    <article>                          
        <div class="signup-box inner-box">
          <h3 class="heading-txt">Change Password</h3>
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
                  <h4>password change</h4>
                  <form name="form"  action="" method="post" enctype="multipart/form-data" novalidate id="changeInsPassword">
                    <input type="hidden" name="action" value="Process">
                    <div class="form-box">                      
                      <div class="input-box1">
                        <label>Current Password</label>
                        <input class="input" name="current_password" id="current_password" type="password" required/>
                      </div>
                      <div class="input-box1">
                        <label>New password</label>
                        <input class="input" name="new_password" id="new_password" type="password" required />
                      </div>
                      <div class="input-box1">
                        <label>Confirm password</label>
                        <input class="input" name="confirm_password" id="confirm_password" type="password" required />
                      </div>                      
                      <button class="btn-login" type="submit">Change Password</button>
                    </div><!--form-box-->
                  </form>                 
                  
                </div> <!--info-form-->
        </div>
    </article>
  </div>        
</section>