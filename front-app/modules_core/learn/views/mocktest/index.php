<div class="stepPage">
    <div class="wrap">
        <div class="questionZonePan">
            <!--<h2>Mock Theory Test</h2>-->
            <div class="lessonDetailsView"> 
            <div class="title clearfix">Mock Theory Test<a href="<?php echo base_url().'learn/';?>" class="motoRules">Learning Zone</a></div>
	    <?php
		if(empty($mocktestQuestion['answer'])){
		    echo '<div class="topTimepan"><div class="timeBlockPan">Question Not Found</div></div>';
		}else{
		?>
            <div class="topTimepan">
            <div class="timeBlockPan">
		<?php $mocktesttime = explode(':',$mocktesttime); ?>
                <span><span id="question_no">1</span> &nbsp;(of <?php echo $noofquestion; ?>)</span>
                <a class="understand-question" id="open" style="cursor:pointer;">Understand Question</a>
                <strong><span id="hour_span"><?php echo $mocktesttime[0]; ?></span><span>:</span><span id="min_span"><?php echo $mocktesttime[1]; ?></span><span>:</span><span id="sec_span"><?php echo $mocktesttime[2]; ?></span> <i class="fa fa-question-circle"></i></strong>
                <!--<div id="countdown-1"></div>-->
                <br class="spacer" />
            </div>
            <!--<p><i class="fa fa-info-circle"></i> You haven't answered this question before </p>-->
            </div>
            <div id="mocktestQuestion" class="mocktestQuestion">
            <div class="questionZoneBox">
                <div id="answerzone">
                    <h3>Select <?php if($mocktestQuestion['correct_answer']==1){echo 'One Answer';}elseif($mocktestQuestion['correct_answer']==2){echo 'Two Answers';}else{echo 'Three Answers';}?></h3>
                    <div class="box explanation" id="box1" style="display: none;">
                    <span class="close_arrow">&times;</span>
                    <?php echo stripslashes($mocktestQuestion['mock_question_explanation']);?>
                    </div>
		    <!--<span class="explanation" style="display: none;"><?php echo stripslashes($mocktestQuestion['mock_question_explanation']);?></span>-->
			<div class="questionLeft clearfix">
                        <?php
                        if($mocktestQuestion['mock_question_text'] != ''){?>
                            <div class="questionSec<?php echo ($mocktestQuestion['mock_question_image'] == '')?' questionWithoutImage':'';?>">
                            <p><strong><?php echo stripslashes($mocktestQuestion['mock_question_text']); ?></strong></p>
                            <?php if($mocktestQuestion['mock_question_image'] != ''){ ?>
                            <div class="quesImage"><img src="<?php echo base_url().'uploads/question/mock_test/'.$mocktestQuestion['mock_question_image']; ?>"></div>
                            <?php } ?>
                            </div>
                        <?php } ?>
			<div class="example">
                            <ul class="Questionzone">
                        <?php
                            if(is_array($mocktestQuestion['answer']) && count($mocktestQuestion['answer'])>0){
                                foreach($mocktestQuestion['answer'] as $aArr){
                                $answerType= $aArr['mock_answer_type'];
                                $answerText = $aArr['mock_answer_text'];
                                $answerId   = $aArr['mock_answer_id'];
                                ?>
                                <li>    
                                <div class="answerzone">
                                <input id="chkAnswer_<?php echo $answerId; ?>" type="checkbox" class="Checkboxmock" name="chkAnswer[]" <?php if(isset($userAns[0]['answer_id']) && is_array($userAns) && $userAns[0]['answer_id'] != '' && in_array($answerId,explode(',',$userAns[0]['answer_id']))){echo 'checked';}?> value="<?php echo $answerId; ?>">
                                <label for="chkAnswer_<?php echo $answerId; ?>"><span></span></label>
                                </div>
                                <strong>
                                <?php if($answerType == 'text') { echo $answerText; } ?>
                                <?php if($answerType == 'image') { ?>
                                <img src="<?php echo base_url().'uploads/mocktest_answer/thumbs/'.$answerText; ?>">
                                <?php } ?>
                                </strong>
                                </li>  
                                <?php
                                }
                            }
                        ?>
                        </ul>          
			</div>
			</div> 
                </div>
                <div class="questionZoneBot">
                    <input type="hidden" id="questionid" name="questionid" value="<?php echo $mocktestQuestion['mock_question_id'];?>">
                    <a class="motoRules disabled_question" style="cursor: pointer;">Previous Question</a>
		    <input type="hidden" id="currQuestionNo" value="1">
                    <!--<a href="#" class="motoRulesTwo"><i class="fa fa-question-circle"></i></a>-->
                    <!--<a href="#" class="motoRules">Flag Question</a>-->
                    <a href="<?php echo FRONTEND_URL.'learn/mocktest/reviewQuestion/'; ?>" class="motoRules fancyboxReviewQuestion fancybox.ajax disabled_question">Review Question</a>
                    <!--<a href="#" class="motoRulesTwo"><i class="fa fa-question-circle"></i></a>-->
                    <a id="nxtmockquestion" class="motoRules" style="cursor: pointer;">Next Question</a>
                    <a id="viewsum" class="motoRules" style="cursor: pointer;display:none;">View Summary</a>           
                </div>
            </div>
        </div>
            <?php } ?>
	    </div>
            <div class="fooLogoPan clearfix" style="margin-top:10px;">
                <div><span class="image-disclaimer">Image Disclaimer</span> - While the images used have been optimised for quality, some may appear faded on screen. All images are provided by the Driver and Vehicle Standards Agency (DVSA) as part of the license we hold, and still remain current within the Theory Test materials.</div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
function active_time() {
	var _hour = $("#hour_span").text();
	var _min  = $("#min_span").text();
	var _sec  = $("#sec_span").text();

	if (_sec==00) {
	    _sec = 60;
            if (_min==00) {
                _min = 60;
                _min = Number(_min)-1;
                _hour = Number(_hour)-1;
            }else{
                _min = Number(_min)-1;
            }
	}
        if (_sec !=00) {
	    _sec = Number(_sec)-1;
	}
        
	if (Number(_sec) < 10) {
	    _sec="0"+_sec;
	}
        if ((_hour == 0 || _hour == 00) && (_min == 0 || _min == 00) && _sec == 00) {
	    alert('The maximum test time allowed has been reached.\nYou will now be shown your test results.\nAny unanswered questions will be marked as incomplete.')
            window.location.href = _baseUrl + 'learn/mocktest/result/';
        }
	$("#hour_span").text(_hour);
	$("#min_span").text(_min);
	$("#sec_span").text(_sec);
        setTimeout("active_time()",1000);
	
}
setTimeout("active_time()",1000);
</script>