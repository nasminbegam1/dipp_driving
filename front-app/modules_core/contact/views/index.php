  <div class="contentPage">
    <div class="wrap">
      <h2 class="title">Contact us</h2>
      <div class="addressSec">
        <h3>Company address</h3>
        <ul>
          <li> <span class="conlocation">3015 Grand Ave, Coconut Grove, Merrick Way, FL 12345</span> <a href="callto:+234 902-497-3014" class="conmobile">(Head Office): +234 902-497-3014</a> </li>
          <li> <a href="callto:+234 902-497-3039" class="conmobile">(Surulere): +234 902-497-3039</a> <a href="callto:+234 704 570 6266" class="conmobile">(Ibadan, Dugbe): +234 704 570 6266</a> <a href="callto:+234 902-497-3041" class="conmobile">(Ibadan, Samonda): +234 902-497-3041</a> </li>
          <li> <a href="callto:+234 902-497-3040" class="conmobile mobile2">(Calabar): +234 902-497-3040</a> <a href="mailto:info@filmhouseng.com" class="conmessage">info@drivertheory4u.com</a> </li>
        </ul>
      </div>
      <div class="mapSec">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3964.7624190912275!2d3.4235904!3d6.4245635000000005!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x103bf533c1419d15%3A0xf4309a4c41c59df7!2s1679+Karimu+Kotun+St%2C+Lagos%2C+Nigeria!5e0!3m2!1sen!2sin!4v1439190380478" width="100%" height="283" frameborder="0" style="border:0" allowfullscreen></iframe>
      </div>
      <div class="contactSec">
         <?php if(validation_errors() != FALSE){?>
                                        <div align="center">
                                            <div class="nNote nFailure" style="width: 600px;color:red;">
                                                <?php echo validation_errors('<p>', '</p>'); ?>
                                            
                                            </div>
                                        </div>
                                        <?php } ?>
            <?php if(isset($succmsg) && $succmsg!='') { ?>
            <div class="succ" style="color: green"><?php echo $succmsg;?></div>
            <?php } if(isset($errmsg) && $errmsg!='') { ?>
            <div class="err" style="color: red"><?php echo $errmsg;?></div>
            <?php } ?>
        <h3 class="pageTitle">Drop Us a Line</h3>
        <form action="<?php echo FRONTEND_URL.'contact'; ?>" method="post" name='contact' id='contact'  class="form-validate"  novalidate="novalidate">
        <input type="hidden" name="action" value="Process">
          <div class="formMain clear">
            <div class="leftForm">
              <label>Name :</label>
            </div>
            <div class="rightForm">
              <input type="text" name="full_name" placeholder="Name" class="required" />
            </div>
          </div>
          <div class="formMain clear">
            <div class="leftForm">
              <label>Email address :</label>
            </div>
            <div class="rightForm">
              <input type="email" name="email" placeholder="Email" class="required" />
            </div>
          </div>
          <div class="formMain clear">
            <div class="leftForm">
              <label>Contact no :</label>
            </div>
            <div class="rightForm">
              <input type="text" name="contact" placeholder="contact No" class="required"  />
            </div>
          </div>
          <div class="formMain clear">
            <div class="leftForm">
              <label>Comment :</label>
            </div>
            <div class="rightForm">
              <textarea name="comment" cols="10" rows="10" class="required"  placeholder="comment" ></textarea>
            </div>
          </div>
          <div class="formMain clear">
            <div class="rightForm">
              <input name="submit" type="submit" value="Submit">
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
	<script>

  $(function() {
  
    // Setup form validation on the #register-form element
    $("#contact").validate();
  });
  
  </script>
  <style>
    #contact label.error {
  color:#FB3A3A;
  font-weight:bold;
}
  </style>