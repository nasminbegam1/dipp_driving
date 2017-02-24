<div class="stepPage">
    <div class="wrap">
        <div class="questionZonePan">
            <h2>Mock Theory result</h2>
            <div class="questionZoneBox btmGap">
                <div id="answerzone" class="clearfix">
                    <?php //pr($mockTestResult); ?>
                    <p><strong>Total number of questions in test: </strong><span><?php echo $noofquestion; ?></span></p>
                    <p><strong>Number of complete questions:</strong> <span><?php echo $noOfAns; ?></span></p>
                    <p><strong>Number of incomplete questions: </strong><span><?php echo $noofquestion - $noOfAns; ?></span></p>
                    <p><strong>Correct Answers:</strong><span><?php echo $mockTestResult['passQuestionNo'];?></span></p>
                    <p><strong>Incorrect Answers:</strong><span><?php echo ($noofquestion - $mockTestResult['passQuestionNo']);?></span></p>
                    <p><strong>Your score: </strong><span><?php echo $mockTestResult['userNumber'].'%';?></span></p>
                    <?php if($mockTestResult['userNumber']<=70){ echo "<div class='exam-fail'>Unfortunately you have not passed this mock test</div>"; }else{echo "<div class='exam-pass'>you have passed this mock test</div>"; } ?>
                </div>
            </div>
            <div class="wrongQuestionZoneBox">
             <?php
             if(is_array($wrongAns)){
                //pr($wrongAns);
                foreach($wrongAns as $wAns){ ?>
                <div class="indvQuestion">
                <div class="quesMainPan clearfix">
                <div class="indvLeft">
                <?php
                if($wAns['mock_question_text'] != ''){?><p><strong><?php echo 'Q:'.stripslashes($wAns['mock_question_text']); ?></strong></p><?php } ?>
                <?php if($wAns['mock_question_image'] != ''){ ?>
                <div class="questionImage"><img src="<?php echo base_url().'uploads/question/mock_test/thumbs/'.$wAns['mock_question_image']; ?>"></div>
                <?php } ?>
                
                <div class="example answerZone">
                <?php
                    if(is_array($wAns['answer']) && count($wAns['answer'])>0){                
                ?>
                    <ul>
                <?php
                        foreach($wAns['answer'] as $aArr){
                        $answerText = $aArr['mock_answer_text'];
                        $wrImage = ($aArr['mock_is_answer']  == 'Y')?'right.png':'wrong.png';
                        ?>
                            <li>
                                <img src="<?php echo base_url().'images/'.$wrImage; ?>">
                                <?php if($aArr['mock_answer_type'] == 'image'){ ?>
                                <img src="<?php echo base_url().'uploads/mocktest_answer/'.$aArr['mock_answer_text']; ?>">
                                <?php   
                                }else{
                                    echo $answerText;
                                }
                            ?>
                            </li>
                <?php
                        }
                ?>
                    </ul>
                <?php
                    }
                ?>
                </div>
                </div>
                <div class="explanation"><h3>Explanation:</h3><p><?php echo stripslashes($wAns['mock_question_explanation']); ?></p></div>
                </div>
                <?php if(is_array($wAns['given_answer']) && count($wAns['given_answer'])>0){ ?>
                <div class="userAnswer">
                    <p class="choseAns">You chose the following answer(s):</p>
                    <span class="userGivenAnswer">
                    <?php foreach($wAns['given_answer'] as $aWrArr){ ?>
                    <img src="<?php echo base_url().'images/wrong.png'; ?>">
                    <?php if($aWrArr['mock_answer_type'] == 'image'){ ?>
                    <img src="<?php echo base_url().'uploads/mocktest_answer/'.$aWrArr['mock_answer_text']; ?>">
                    <?php   
                    }else{
                        echo stripslashes($aWrArr['mock_answer_text']);
                    }
                    echo '<br>';
                    } ?>
                    </span>
                </div>
                <?php } ?>
            </div>
            <?php } } ?>
            </div>
        </div>
    </div>
</div>