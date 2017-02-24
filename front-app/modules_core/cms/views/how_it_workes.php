<section>
  <div class="container">
    <article>                          
        <div class="work-box">
          <h3 class="heading-txt">HOW IT WORKS</h3>
          
          <ul class="service-box">
            <li>
              <div class="service-img-box">
              <a href="javascript:void(0);">
                <img src="<?php echo base_url(); ?>images/service-img1.jpg" alt="service-img" />
                <div class="caption">
                  <h3>Student<strong>Theory</strong></h3>
                </div>
              </a>
              </div>
              <div class="service-text-box" id="first_box">
                <?php echo stripslashes($student_learner[0]['cms_content']);?>
              </div>
            </li>
            
            <li>
              <div class="service-img-box">
              <a href="javascript:void(0);">
                <img src="<?php echo base_url(); ?>images/service-img2.jpg" alt="service-img" />
                <div class="caption">
                  <h3>Driving  <strong>Instructor</strong></h3>
                </div>
              </a>
              </div>
              <div class="service-text-box" id="second_box">
                <?php echo stripslashes($driving_instructor[0]['cms_content']);?>
              </div>
            </li>
            
          </ul>
          
        </div>
    </article>
  </div>        
</section>