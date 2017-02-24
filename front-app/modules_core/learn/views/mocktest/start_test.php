<div class="stepPage">
  <div class="wrap">
    <div class="questionZonePan">
      <div class="lessonDetailsView">
        <div class="title clearfix"><a href="<?php echo FRONTEND_URL.'learn'; ?>" class="motoRules">Learning Zone</a></div>
        <div class="questionZoneBox rmvBg">
          <div id="answerzone">
            <div class="questionLeft clearfix">
              <h4>Hi <?php echo $this->session->userdata('STUDENT_FNAME');?>,</h4>
              <p> 
                <?php echo stripslashes($details[0]['cms_content']); ?>
                
              <!--<p>You are about to start a Mock Test. </p>
              <p>When you take Mock Tests you can't use my tools to help you find the answers because I want these tests to be as close to the real thing as possible for you. </p>
              <p>My mock tests simulate the real tests. They include the same number of questions as the real tests and they include the correct balance of questions from each topic area.</p>
              <p> <img src="<?php echo base_url()?>images/red-i.png" alt="red-i"> The case study which will be shown as part of this mock test is a practice case study which I have put together for you, it is NOT an official DVSA practice case study as the DVSA don't make any available.</p>
              <p>If the voiceovers don't work please download the Adobe plug-in from <a href="#">here</a>.</p>-->
            </div>
          </div>
          Good luck and please read this:
          <div class="redBox">
            <div class="redUp"> <strong>DO NOT USE THE BROWSER BACK OR FORWARD BUTTONS</strong><br />
              <p>while taking your test or you will leave the questions pages.</p>
            </div>
            <div class="redDown"> <strong> IF YOUR MOUSE HAS EXTRA BUTTONS FOR BACK OR FORWARD NAVIGATION</strong><br />
              <p>be careful not to click them or you will leave the questions pages.</p>
            </div>
          </div>
        </div>
        <div class="questionZoneBot gryBg clearfix">
          <a href="<?php echo base_url().'learn/mocktest/taketest'?>" class="takeTest">Continue</a>
        </div>
      </div>
    </div>
  </div>
</div>

