<div class="questionZoneBox">
    <div id="answerzone">
        <h3>Select <?php if($questionDetails['correct_answer']==1){echo 'One Answer';}elseif($questionDetails['correct_answer']==2){echo 'Two Answers';}else{echo 'Three Answers';}?></h3>
        <!--<span class="understand-question">Understand Question</span>-->
        <div class="box explanation" id="box1" style="display: none;">
            <span class="close_arrow">&times;</span>
            <?php echo stripslashes($questionDetails['mock_question_explanation']);?>
        </div>
	<!--<span class="explanation" style="display: none;"><?php echo stripslashes($questionDetails['mock_question_explanation']);?></span>-->
            <div class="questionLeft clearfix">
            <?php
            if($questionDetails['mock_question_text'] != ''){?>
                <div class="questionSec<?php echo ($questionDetails['mock_question_image'] == '')?' questionWithoutImage':'';?>">
                <p><strong><?php echo stripslashes($questionDetails['mock_question_text']); ?></strong></p>
                <?php if($questionDetails['mock_question_image'] != ''){ ?>
                <div class="quesImage"><img src="<?php echo base_url().'uploads/question/mock_test/'.$questionDetails['mock_question_image']; ?>"></div>
                <?php } ?>
                </div>
            <?php } ?>
            <div class="example">
            <ul class="Questionzone">
            <?php
                if(is_array($questionDetails['answer']) && count($questionDetails['answer'])>0){
                    foreach($questionDetails['answer'] as $aArr){
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
        <input type="hidden" id="questionid" name="questionid" value="<?php echo $questionDetails['mock_question_id'];?>">
        <a <?php if($curAnsNo != 1){echo "id='prevMockQuestion'";}?> class="motoRules<?php echo ($curAnsNo == 1)?' disabled_question':''; ?>" style="cursor: pointer;">Previous Question</a>
        <input type="hidden" id="currQuestionNo" value="<?php echo $curAnsNo; ?>">
        <!--<a href="#" class="motoRulesTwo"><i class="fa fa-question-circle"></i></a>-->
        <!--<a href="#" class="motoRules">Flag Question</a>-->
        <a href="<?php echo FRONTEND_URL.'learn/mocktest/reviewQuestion/'; ?>" class="motoRules fancyboxReviewQuestion fancybox.ajax">Review Question</a>
        <!--<a href="#" class="motoRulesTwo"><i class="fa fa-question-circle"></i></a>-->
        <a id="nxtmockquestion" class="motoRules" style="cursor: pointer;"><?php  echo ($curAnsNo == $noofquestion)?'View Summary':'Next Question'?></a>
    </div>
</div>
