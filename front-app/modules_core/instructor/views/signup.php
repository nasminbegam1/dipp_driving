<section>
  <div class="container">
    <article>                          
        <div class="signup-box">
          <h3 class="heading-txt">sign up</h3>
          <?php
                $getMessage=flash_message();
                if(is_array($getMessage) && count($getMessage) > 0)
                {
                    $message_type=$getMessage['type'];
                    echo '<div class="'.$message_type.'">'.$getMessage['content'].'</div>';
                }
            ?>
          <form method="post" name="instractorSignup" enctype="multipart/form-data" id="instractorSignup" >
          <!--info-form 1-->
          <div class="info-form clearfix">
            <h4>personal information</h4>
            
              <input type="hidden" name="action" value="Process">
              <input type="hidden" name="package_id" value="<?php echo $package_id; ?>">
              <div class="form-box">
                
                <div class="input-box1">
                  <label>Business Name</label>
                  <input type="text" class="input" name="instructor_business_name" value="" />
                </div>
                <div class="input-box1">
                  <label>First Name</label>
                  <input type="text" class="input" name="instructor_fname" value=""/>
                </div>
                <div class="input-box1">
                  <label>Last Name</label>
                  <input type="text" class="input" name="instructor_lname" value="" />
                </div>
                <div class="input-box1">
                  <label>Email</label>
                  <input type="text" class="input" name="instructor_email" value="" />
                </div>
                <div class="input-box1">
                  <label>Password</label>
                  <input type="password" class="input" name="instructor_password" value=""/>
                </div>
                <div class="input-box1 bigSel">
                  <label>Select Theory</label>
                  <select name="course_id">
                    <?php
                      if(is_array($course_dtls)){
                      foreach($course_dtls as $cDtls){
                    ?>
                    <option value="<?php echo $cDtls['id']; ?>" <?php echo ($this->session->userdata('THEORY_TYPE')==$cDtls['id'])?'selected':'';?>><?php echo stripslashes($cDtls['name']); ?></option>
                    <?php } } ?>
                  </select>
                </div>
              </div><!--form-box-->
              
              <div class="form-box">
                
                
                <div class="input-box1">
                  <label>Phone Number</label>
                  <input type="text" class="input"  name="instructor_phone_number" value="">
                </div>
                <div class="input-box1 bigText">
                  <label>Business Address</label>
                  <textarea rows="5" name="instructor_address"></textarea>
                </div>
                <div class="input-box1">
                  <label>Post Code</label>
                  <input type="text" class="input"  name="zip_code" value="">
                </div>
                <div class="input-box">
                  <label>Your logo</label>
                  <input type="file" name="instructor_logo" />
                </div>
              </div><!--form-box-->
            
          </div> <!--info-form-->
          
          <div class="info-form clearfix">
            <div class="input-box"><label>Please select which payment method you would like to be billed from. Your payment will commence on the first day following completion of your free 14 day trial. If you cancel within the 14 day trial, no payment will be taken and your access will be terminated. For further information on payments and cancellation policies please see our <a href="<?php echo base_url().'terms-and-conditions'; ?>">Terms and Conditions</a></label> </div>
          </div>
          <div class="info-form clearfix">
            <h4>Payment Method</h4>
              <div class="form-box paymnt-box">
                
                <div class="paypal-payment">
                 
                  <input type="radio" name="payment_type" value="paypal" checked="checked"/>Paypal
                  <p>(You will be directed to Paypal site to complete payment)</p>
                  
                </div>
                
                
                <div class="worldpay-payment">
                  <input type="radio" name="payment_type" value="worldpay" />Worldpay
                  <p>(You will be directed to Worldpay site to complete payment)</p>
                </div> 
                
                <button class="btn-login" type="submit">submit</button>
                
              </div>
          </div>
          
        </form>
          
        </div>
    </article>
  </div>        
</section>

		