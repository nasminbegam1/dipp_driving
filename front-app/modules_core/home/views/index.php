<!--bxslider-->
      <section>
        <ul class="bxslider">
          <?php
              if(is_array($banner)){
                foreach($banner as $bn){
          ?>
          <li>
            <img src="<?php echo FILE_UPLOAD_URL.'banner/'.$bn['banner_image'];?>" />
            <!--<div class="banner-caption">
              <p><?php //echo stripslashes($bn['banner_title']); ?></p>
              <img src="<?php //echo base_url().'images/round_logo.png';?>">
            </div>-->
          </li>
          <?php } } ?> 
        </ul>
      </section>
      
      <!--service-area-->
      <section>
        <div class="container clearfix">
          <ul class="service-area">
            <li>
              <a href="<?php echo base_url().'car-theory-details'; ?>">
                <img src="<?php echo base_url(); ?>images/thumb1.jpg" alt="service-img" />
                <div class="caption">
                  <h3>CAR<strong>Theory</strong></h3>
                  <span class="read_more">Read More</span>
                </div>
                </a>
            </li>
            <li>
              <a href="<?php echo base_url().'motorcycle-theory-details'; ?>">
                <img src="<?php echo base_url(); ?>images/thumb2.jpg" alt="service-img" />
                <div class="caption">
                  <h3>MOTORCYCLE <strong>Theory</strong></h3>
                  <span class="read_more">Read More</span>
                </div>
                </a>
            </li>
            <li>
              <a href="<?php echo base_url().'login'; ?>">
                <img src="<?php echo base_url(); ?>images/thumb3.jpg" alt="service-img" />
                <div class="caption">
                  <h3><?php if($this->session->userdata('STUDENT_ID') != '' || $this->session->userdata('INSTRUCTOR_ID') != ''){ echo 'Dashboard';}else{?>Login<?php } ?></h3>
                   <span class="read_more">&nbsp;</span>
                </div>
                </a>
            </li>
          </ul>          
        </div>
      </section>
      
      <section>
    
        <div class="container">
          <article id="marg-tb">            
              <h3 class="heading-txt">Driving<strong>Instructor</strong></h3>
              <div class="img-box"><img class="di-img" src="<?php echo base_url(); ?>images/driving_instructor.jpg"> <span></span></div>
              <div class="di-text">
                <?php echo stripslashes($driving_instructor[0]['cms_content']);?> 
              </div>            
          </article>
          
          <article id="marg-tb">
            
              <h3 class="heading-txt">Student<strong>Learner</strong></h3>            
              <div class="si-text">
                <?php echo stripslashes($student_learner[0]['cms_content']);?>  
                <div class="serach_instructor">
                    <h4>Search Driving Instructor</h4>
                    <input type="text" name="search_text" id="search_text">
                    <input type="button" name="submit" value="Search" id="search_submit">
                    <input type="button" name="submit" value="Clear" id="clear_result">
                    <span class="error" id="search_text_error"></span> 
                    <span id="search_result"></span>
                </div>  
              </div>
              
              <div class="img-box"><img class="si-img" src="<?php echo base_url(); ?>images/student_learner.jpg"><span></span></div>
              
          </article>
        </div>        
      </section>
      
      <!--textimonial-->
      <section>
        <div class="container">
          <div class="textimonial">
            <?php //pr($testimonial); ?>
            <ul class="bxslider1">
              <?php if(is_array($testimonial)){
                foreach($testimonial as $test){
                ?>
              <li>
                <span><?php echo stripslashes($test['name'])?></span>
                <p class="ctext"><?php echo stripslashes($test['description'])?></p>
                <p><?php echo stripslashes($test['company_name'])?></p>
              </li>
              <?php } } ?>
            </ul>
          </div>
        </div>
      </section>
      <section>
        <div class="container">
      <ul class="twitter_feed">
        <?php
        if(is_array($tweet_list) && count($tweet_list) > 0){
          
          for($i=0; $i< count($tweet_list); $i++){
            
        ?>
        <li>
                  <div class="tweetIcon"> 
                    <i class="fa fa-twitter"></i> </div>
                  <div class="tweetContent">
                    <p> <span> <a target="_blank" style="color:#<?php echo stripslashes($tweet_list[$i]->user->profile_link_color) ?>" href="http://twitter.com/<?php echo stripslashes($tweet_list[$i]->user->screen_name);?>">@<?php echo stripslashes($tweet_list[$i]->user->screen_name);?></a> </span> <span><?php echo stripslashes($tweet_list[$i]->text);?></span> </p>
                    <span class="tweetTime globalCls">
                    <?php $date = str_replace("+0000",'',$tweet_list[$i]->created_at); echo get_time_difference_php($date); ?>
                    </span> </div>
                </li>
                <?php
          } ?>
              
          <?php } ?>
          </ul>
        </div>
      </section>    