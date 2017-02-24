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
          <?php
		$topic_id        = $this->session->userdata('topic_id');
		$selected_module = $this->session->userdata('selected_module');
		$stilltoscore    = $this->session->userdata('stilltoscore');
		if($stilltoscore != ''){
		?>
          <a href="<?php echo base_url().'learn/practice/questionAnswerList/'.$topic_id.'/'.$selected_module.'/'.$stilltoscore; ?>" class="motoRules">Continue</a>
          <?php
		}else{
		?>
          <a href="<?php echo base_url().'learn/practice/questionAnswerList/'.$topic_id.'/'.$selected_module; ?>" class="motoRules">Continue</a>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
</div>
