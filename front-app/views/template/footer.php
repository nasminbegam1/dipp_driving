<div class="footer-top clearfix">
  <div class="container">
    <div class="row">
      <ul class="footer-links clearfix">
        <li>              
          <h4>About Us</h4>
          <p class="about_badge"><?php echo $about[0]['cms_content']; ?></p>
          <!--<div class="subscribe-box">
            <form id="newsletter" method="post">
              <span id="loader" style="display: none;"><img src="<?php echo base_url().'images/bx_loader.gif'?>"></span>
              <span id="newsletter_success" class="success"></span>
              <input type="text" name="newsletter_email" class="sub-input" placeholder="Email address" />
              <span id="error_newsletter_email" class="error"></span>
              <button class="btn-sub">ok</button>
            </form>
          </div>-->
          <div class="badge">
            <img src="<?php echo base_url();?>images/rd_bg.png" alt="img" />
            <img src="<?php echo base_url();?>images/ylw_bg.png" alt="img" />
          </div>
          
          
        </li>
        
        <li>              
          <h4>Useful Links</h4>
          <ul class="footer-item">
            <li><a href="<?php echo base_url().'about'; ?>">About</a></li>
            <li><a href="<?php echo base_url().'how_it_workes'; ?>">How It Works</a></li>
            <li><a href="<?php echo base_url().'price'; ?>">Pricing</a></li>
            <li><a href="<?php echo base_url().'price'; ?>">Sign Up</a></li>
            <li><a href="<?php echo base_url().'faq'; ?>">FAQs</a></li>                  
          </ul>
        </li>
        
        <li>
          <h4>External Links</h4>
          <ul class="footer-item">
              <li><a href="https://www.gov.uk/government/publications/the-highway-code-traffic-signs" target="_blank">Traffic Signs</a></li>
              <li><a href="https://www.buywithconfidence.gov.uk/" target="_blank">Trading Standards</a></li>
              <li><a href="http://www.youtube.com/watch?annotation_id=annotation_828402&feature=iv&src_vid=fL6b4eS3xDY&v=z_zi6j24F6s&playnext=0" target="_blank">Taking Your Theory Test</a></li>
              <li><a href="https://www.gov.uk/browse/driving/highway-code" target="_blank">The Highway Code</a></li>             
          </ul>
          <div class="think">
           <!--<a href="http://think.direct.gov.uk/index.html" target="_blank"> <img src="<?php echo base_url();?>images/THINK!_logo.png" alt="img" /></a> -->
          </div>
          <!--<img src="<?php echo base_url();?>images/driving.png" alt="img" />-->
        </li>
        
        <li>
          <h4>Crown Copyright Licensed</h4>
          <p>Crown Copyright material reproduced under licence from the Driver and Vehicle Standards Agency which does not accept any responsibility for the accuracy of the
              reproduction.</p><br>
          <a class="btn-tnc" href="<?php echo base_url().'terms-and-conditions'; ?>">terms and conditions</a>
          <ul class="footer-thumb">
            <!--<li><a href="#"><img src="<?php echo base_url(); ?>images/small-thumb1.jpg" alt="img" /></a></li>
            <li><a href="#"><img src="<?php echo base_url(); ?>images/small-thumb2.jpg" alt="img" /></a></li>  -->                                
          </ul>
          <div class="payPal">
             <img src="<?php echo base_url();?>images/Paupal.png" alt="img" />
            
          </div>
          
        </li>
        
        <li>
          <h4>Contact us</h4>
          <ul class="footer-contact">
            <li><a href="javascript:void(0);"><?php echo (isset($settings['contact_address']) && $settings['contact_address']!= '')?$settings['contact_address']:'N/A'; ?></a></li>
            <li><a href="<?php echo (isset($settings['info_email']) && $settings['info_email']!= '')?'mailto:'.$settings['info_email']:''; ?>"><?php echo $settings['info_email']; ?></a></li>
            <li><a href="<?php echo (isset($settings['phone_no']) && $settings['phone_no']!= '')?'tel:'.$settings['phone_no']:'#'; ?>"><?php echo $settings['phone_no']; ?></a></li>
            <!--<li><a class="btn-tnc" href="<?php echo base_url().'terms-and-conditions'; ?>">terms and conditions</a></li>-->
          </ul>
          <div class="pay">
             <img src="<?php echo base_url();?>images/WorldPay.png" alt="img" />
            
          </div>
          
          
        </li>
        
      </ul>
    </div>
  </div>
</div>

<div class="footer-bottom clearfix">
  <div class="container">
    <div class="copyright">
      <p>Copyright  &copy; di-pp.co.uk <?php echo date('Y'); ?> All Rights Reserved</p>            
    </div>
    <ul class="footer-social">
      <li><a href="<?php if(isset($settings['facebook_link']) && $settings['facebook_link']!= ''){echo $settings['facebook_link'];}else{echo '#';} ?>" <?php if(isset($settings['facebook_link']) && $settings['facebook_link']!= ''){echo 'target="_blank"'; }?>></a></li>
      <li><a href="<?php if(isset($settings['twitter_link']) && $settings['twitter_link']!= ''){echo $settings['twitter_link'];}else{echo '#';} ?>" <?php if(isset($settings['twitter_link']) && $settings['twitter_link']!= ''){echo 'target="_blank"'; }?>></a></li>
      <li><a href="<?php if(isset($settings['linkedin_link']) && $settings['linkedin_link']!= ''){echo $settings['linkedin_link'];}else{echo '#';} ?>" <?php if(isset($settings['linkedin_link']) && $settings['linkedin_link']!= ''){echo 'target="_blank"'; }?>></a></li>
      <li><a href="<?php if(isset($settings['googleplus_link']) && $settings['googleplus_link']!= ''){echo $settings['googleplus_link'];}else{echo '#';} ?>" <?php if(isset($settings['googleplus_link']) && $settings['googleplus_link']!= ''){echo 'target="_blank"'; }?>></a></li>
    </ul>        
  </div>
</div>