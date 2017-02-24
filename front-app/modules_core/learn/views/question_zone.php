<div class="stepPage">
  <div class="wrap">
    <div class="questionZonePan">
      <div class="lessonDetailsView">
        <div class="title clearfix"><h2>Lesson Test</h2><a href="<?php echo FRONTEND_URL.'learn'; ?>" class="motoRules moto-new">Learning Zone</a></div>
        <div class="topTimepan">
          <div class="timeBlockPan"> <span><?php echo stripslashes($topic_name); ?> <?php echo $topic_id; ?>:  (<label id="no">1</label>
            of <?php echo $noofquestion; ?>)</span> 
            <!--<span>Accidents 2:  (<label id="no">1</label> of <?php //echo $noofquestion; ?>)</span>--> 
            <!--<strong>00:47:23 <i class="fa fa-question-circle"></i></strong>-->
            <div id="countdown-1"></div>
            <br class="spacer" />
          </div>
          <p><i class="fa fa-info-circle"></i> You haven't answered this question before </p>
        </div>
        <div class="questionZoneBox">
          <div id="answerzone">
            <h3>Select <?php if($answerCorrArr==1){echo 'One';}elseif($answerCorrArr==2){echo 'Two';}elseif($answerCorrArr==3){echo 'Three';}elseif($answerCorrArr==4){echo 'Four';}else{echo 'Five';}?> answer</h3>
            <?php
		$moduleID= $questionsArr[0]['module_id'];
		$questionID= $questionsArr[0]['question_id'];
		$topicID= $questionsArr[0]['topic_id'];
		$questionName= $questionsArr[0]['question_text'];
		$questionImage= $questionsArr[0]['question_image'];
	    ?>
            <div class="questionLeft clearfix">
             <div class="questionSec<?php echo ($questionsArr[0]['question_image'] == '')?' questionWithoutImage':'';?>"> 
             <p><strong><?php echo $questionName; ?></strong></p>
             <?php if($questionsArr[0]['question_image'] != ''){ ?>
              <div class="quesImage"><img src="<?php echo base_url().'uploads/question/'.$questionsArr[0]['question_image']; ?>"></div>
              <?php } ?>
             </div>
              <div class="example">
                <ul class="Questionzone">
                  <?php
		      if(is_array($answerArr)){
			foreach($answerArr as $aArr){
																				$_AnswerType= $aArr['answer_type'];
																				$_Answer= $aArr['answer_text'];
																				$_AnswerID= $aArr['answer_id'];
																			      ?>
                  <li>
                    <div class="answerzone">
                      <input id="chkAnswer_<?php echo $_AnswerID; ?>" type="checkbox" class="Checkbox" name="chkAnswer[]" value="<?php echo $_AnswerID; ?>" <?php if(isset($given_answer)){for($i=0;$i<count($given_answer);$i++){ if($given_answer[$i] == $_AnswerID){ echo "Checked"; }}} ?>>
                      <label for="chkAnswer_<?php echo $_AnswerID; ?>"><span></span></label>
                    </div>
                    <strong>
                    <?php if($_AnswerType == 'text') { echo $_Answer; } ?>
                    <?php if($_AnswerType == 'image') { ?>
                    <img src="<?php echo base_url().'uploads/question_answer/'.$_Answer; ?>">
                    <?php } ?>
                    </strong> </li>
                  <?php
																		}
																}
																?>
                </ul>
              </div>
              
            </div>
          </div>
          <div class="questionZoneBot">
            <input type="hidden" id="stilltoscore" value="<?php echo $this->session->userdata('stilltoscore'); ?>">
            <input type="hidden" id="moduleid" name="moduleid" value="<?php echo $moduleID; ?>">
            <input type="hidden" id="questionid" name="questionid" value="<?php echo $questionID; ?>">
            <input type="hidden" id="topicid" name="topicid" value="<?php echo $topicID; ?>">
            <input type="hidden" id="totqusetion" name="totqusetion" value="<?php echo $noofquestion; ?>">
            <input type="hidden" id="offset" name="offset" value="0">
            <!--<span href="#" class="motoRules">Previous Question</span>--> 
            <a id="prevquestion" class="motoRules disabled_question" style="cursor: pointer;">Previous Question</a> <!--<a href="#" class="motoRulesTwo"><i class="fa fa-question-circle"></i></a>--> 
            <!--<a href="#" class="motoRules">Flag Question</a>--> 
            <a class="motoRules fancyboxNew fancybox.ajax disabled_question" id="reviewQuestion" href="<?php echo base_url().'learn/practice/openFancyBoxTwo/'.$topic_id.'/'.$module_id; ?>"> Review Question </a> <!--<a href="#" class="motoRulesTwo"><i class="fa fa-question-circle"></i></a>--> <a id="nxtquestion" class="motoRules" style="cursor: pointer;">Next Question</a> <a id="viewsum" class="motoRules" style="cursor: pointer;display:none;">View Summary</a> </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
		$(document).ready(function(){
				
				
			$('.fancyboxNew').fancybox({/*'width':1000,'height':1000,'autoSize' : false,'scrolling' : 'yes'*/});
	
				
				
				var base_url_suffix	= 'dipp_driving';
				var base_url = location.protocol + '//' + location.host + '/';
				var i=1;
				var count_next_click=0;
				$('#nxtquestion').click(function(e){
						var stilltoscore = $('#stilltoscore').val();
						count_next_click++;
						var moduleid= $('#moduleid').val();
						var questionid= $('#questionid').val(); 
						var topicid= $('#topicid').val();
						var totqusetion= $("#totqusetion").val()-1;
						var ofset= $("#offset").val();	
						var newofset=eval(ofset)+1;
						var answerIds= $('.Checkbox:checked').map(function() {
																return this.value;
																}).get().join(', ');
						
						var ajaxUrl= base_url+'learn/practice/changeQuestion/';
						var postData= "action=question_search&step=next&module_id="+moduleid+"&question_id="+questionid+"&answer_id="+answerIds+"&topic_id="+topicid+"&offset="+newofset+"&is_del="+count_next_click+"&stilltoscore="+stilltoscore;
						//alert(postData);
						
						$.ajax({  
								type: "POST",  
								url: ajaxUrl,
								data: postData,
								dataType: "json",
								success: function(result){
										//alert(result.query);
										//$('#moduleid').val(result.module_id);
										$('#questionid').val(result.question_id)
										$('#answerzone').html(result.question_zone);
										//$('#offset').val(i);
										$('#offset').val(newofset);
										$('#prevquestion').removeClass('disabled_question');
										$('#reviewQuestion').removeClass('disabled_question');
										
										$('#no').html(parseInt($('#no').html())+1);
										if (i<totqusetion) {
												i++;
												$('#nxtquestion').show();
												$('#viewsum').hide();
										}
										else if (i==totqusetion){
												$('#nxtquestion').addClass('disabled_question');
												$('#nxtquestion').hide();
												$('#viewsum').show();
												//i=1;
										}
								} 
						});	
						
						
						
						
				});
				
				
				$('#viewsum').click(function(e){
						var moduleid= $('#moduleid').val();
						var questionid= $('#questionid').val(); 
						var topicid= $('#topicid').val();
						var totqusetion= $("#totqusetion").val()-1;
						var ofset= $("#offset").val();		
						var answerIds= $('.Checkbox:checked').map(function() {
																return this.value;
																}).get().join(', ');
						
						var ajaxUrl= base_url+'learn/practice/viewSummary/';
						var postData= "action=question_search&module_id="+moduleid+"&question_id="+questionid+"&answer_id="+answerIds+"&topic_id="+topicid+"&total_question="+totqusetion+"&offset="+i;		
						$.ajax({  
								type: "POST",  
								url: ajaxUrl,
								data: postData,
								success: function(result){ 
										if (result == 'Ok') {
												window.location.href= base_url+'learn/practice/answerResult/'+topicid+'/'+moduleid+'/';
										}
								} 
						});
				});	

				
				$('#prevquestion').click(function(e){
						var no = $('#no').html();
						var stilltoscore = $('#stilltoscore').val();
						//alert($('#no').html());
						//i--;
						var moduleid= $('#moduleid').val();
						var questionid= $('#questionid').val();
						var topicid= $('#topicid').val();
						var ofset= $("#offset").val()-1;
						var totqusetion= $("#totqusetion").val();
						var base_url_suffix	= 'dipp_driving';
						var base_url = location.protocol + '//' + location.host + '/';
						var ajaxUrl= base_url+'learn/practice/changeQuestion/';
						var postData= "action=question_search&step=prev&module_id="+moduleid+"&question_id="+questionid+"&topic_id="+topicid+"&offset="+ofset+"&stilltoscore="+stilltoscore;
						//alert(postData);
						$.ajax({  
								type: "POST",  
								url: ajaxUrl,
								data: postData,
								dataType: "json",
								success: function(result){
										//alert(result.query);
										//$('#moduleid').val(result.module_id);
										$('#questionid').val(result.question_id);
										$('#answerzone').html(result.question_zone);
										$('#no').html(no-1);
										$('#offset').val(ofset);
										$('#viewsum').hide();
										$('#nxtquestion').show();
										$('#nxtquestion').removeClass('disabled_question');
										if(ofset == 0) { 
												$('#prevquestion').addClass('disabled_question');
												//$('#reviewQuestion').addClass('disabled_question');
                        i=1;
										}
								} 
						});
				});
				
				//$('#countdown-1').timeTo(<?php echo $noofquestion*60; ?>, function(){
				$('#countdown-1').timeTo(3600, function(){
						alert('Your time has been end');
						window.location.href= base_url+'learn/practice/answerResult/<?php echo $topicID; ?>/<?php echo $moduleID; ?>';
        });
		});
		
		

</script>