<div class="stepPage">
  <div class="wrap">
  
    <div class="lessonDetailsView learnQus"> 
    	<div class="title clearfix"><a href="<?php echo FRONTEND_URL.'learn';?>" class="motoRules">Learning Zone</a></div>
      <div class="topicDetailSec clear tDSPan">
        <div class="topicLeft">
          <div class="explanation">
            <div class="leasonPart">
              <p>On a motorway the left-hand lane should be used for normal driving. You should always use the left hand lane unless you are overtaking another vehicle.</p>
              <p>Even if the motorway is empty, you must still use the left-hand lane, regardless of the speed you are travelling. If other vehicles wish to overtake you, or you wish to overtake them, then the next lane to the right may be used.</p>
            </div>
          </div>
        </div>
        <div class="topicRight">
          <div class="animationSec">
            <h3 class="topicTitle detailTitle">Select a topic from the list below:</h3>
            <p>
              <select name="lessontopic" id="lessontopic" class="lesson">
                <?php
		if(is_array($lessonArr)){
				foreach($lessonArr as $lArr){
		?>
				<option value="<?php echo $lArr['id']; ?>"><?php echo $lArr['name']; ?></option>
		<?php
				}
		}
		?>
              </select>
            </p>
            <div id="imageLesson">
              <div id="animationSlide" class="owl-carousel owl-theme"> &nbsp; </div>
            </div>
          </div>
        </div>
      </div>
      </div>
    <a href="<?php echo base_url().'learn/practice/start_test';?>"  class="motoRules motoRulesnew">Start Topic Test</a>
  </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
      $('.lesson').change(function(){
	  var lesson_id= $('#lessontopic').val();
	  if (lesson_id == 0) {
	    return false;
	  }
	  else{
	      var base_url_suffix	= 'dipp_driving';
	      var base_url = location.protocol + '//' + location.host + '/' + base_url_suffix + '/';
	      var ajaxUrl= base_url+'learn/practice/changeLesson/';
	      var postData= "action=lesson_search&lesson_id="+lesson_id;
	      
	      $.ajax({  
		  type: "POST",  
		  url: ajaxUrl,
		  data: postData,
		  success: function(result){
		      $('#imageLesson').html(result);
		      $("#animationSlide").owlCarousel({
				      navigation : true, // Show next and prev buttons
				      slideSpeed : 300,
				      paginationSpeed : 400,
				      singleItem:true,
				      pagination: false			 
				      // "singleItem:true" is a shortcut for:
				      // items : 1, 
				      // itemsDesktop : false,
				      // itemsDesktopSmall : false,
				      // itemsTablet: false,
				      // itemsMobile : false
		      });
		  } 
	      });
	  }
      });		
		
    $('.lesson').trigger('change');
    });

</script>