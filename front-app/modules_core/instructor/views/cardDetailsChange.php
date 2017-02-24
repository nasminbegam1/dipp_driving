<section>
  <div class="container">
    <article>                          
        <div class="signup-box">
          <h3 class="heading-txt">Card Details Change</h3>
          <?php
            $getMessage=flash_message();
            if(is_array($getMessage) && count($getMessage) > 0)
            {
                $message_type=$getMessage['type'];
                echo '<div class="'.$message_type.'">'.$getMessage['content'].'</div>';
            }
          ?>
        <div class="info-form clearfix">
            <h4>payment information</h4>
            <form method="post" action="" id="cardDetailsChange" enctype="multipart/form-data">
              <input type="hidden" name="action" value="Process">
              <div class="form-box">                      
                <div class="input-box1">
                  <label>Cardholder's Name</label>
                  <input type="text" class="input" name="card_holder_name" value="<?php echo stripslashes($ins_details[0]['card_holder_name']); ?>" />
                </div>
                <div class="input-box1">
                  <label>Card number</label>
                  <input type="text" class="input" name="card_number"  value="<?php echo stripslashes($ins_details[0]['card_number']); ?>"  />
                </div>
                <div class="input-box1">
                  <label>Expiry Date (mm/yy) </label>
                  <select class="left-select" name="expiry_month">
                    <option value="01" <?php echo ($ins_details[0]['expiry_month'] == 1)?'selected':''; ?>>Jan</option>
                    <option value="02" <?php echo ($ins_details[0]['expiry_month'] == 2)?'selected':''; ?>>Feb</option>
                    <option value="03" <?php echo ($ins_details[0]['expiry_month'] == 3)?'selected':''; ?>>Mar</option>
                    <option value="04" <?php echo ($ins_details[0]['expiry_month'] == 4)?'selected':''; ?>>Apr</option>
                    <option value="05" <?php echo ($ins_details[0]['expiry_month'] == 5)?'selected':''; ?>>May</option>
                    <option value="06" <?php echo ($ins_details[0]['expiry_month'] == 6)?'selected':''; ?>>Jun</option>
                    <option value="07" <?php echo ($ins_details[0]['expiry_month'] == 7)?'selected':''; ?>>Jul</option>
                    <option value="08" <?php echo ($ins_details[0]['expiry_month'] == 8)?'selected':''; ?>>Aug</option>
                    <option value="09" <?php echo ($ins_details[0]['expiry_month'] == 9)?'selected':''; ?>>Sep</option>
                    <option value="10" <?php echo ($ins_details[0]['expiry_month'] == 10)?'selected':''; ?>>Oct</option>
                    <option value="11" <?php echo ($ins_details[0]['expiry_month'] == 12)?'selected':''; ?>>Nov</option>
                    <option value="12" <?php echo ($ins_details[0]['expiry_month'] == 12)?'selected':''; ?>>Dec</option>
                  </select>
                  <?php $year = date('Y'); ?>
                  <select class="right-select" name="expiry_year">
                    <?php
                    for($i=$year;$i<$year+15;$i++){ ?>
                    <option value="<?php echo $i; ?>" <?php echo ($ins_details[0]['expiry_year'] == $i)?'selected':''; ?>><?php echo $i; ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="input-box1">
                  <label>Security code</label>
                  <input type="text" class="input" name="security_code" value="<?php echo $ins_details[0]['security_code'];?>" />
                </div>                      
                <button class="btn-login" type="submit">submit</button>
              </div><!--form-box-->
            
            
            <div class="form-box">
              <a href="#" class="btn-paypal"><img src="<?php echo base_url();?>images/paypal-img.png"></a>                    
            </div><!--form-box-->                  
            </form>
          </div> <!--info-form-->
        </div>
    </article>
  </div>        
</section>
