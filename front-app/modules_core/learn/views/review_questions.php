<div class="stepPage">
		<div class="wrap">
				<div class="questionZonePan">
						<h2>Lesson Test</h2>
						<a href="javascript:void(0);" class="motoRules">Lesson Name:&nbsp;<?php echo ucwords($topic_name[0]['name']); ?>
						&nbsp;&nbsp;&nbsp;&nbsp;Module Name:&nbsp;<?php echo ucwords($module_name); ?></a>
						<div class="timeBlockPan">
								<div id="countdown-1"></div>
								<br class="spacer" />
						</div>
						<div class="questionZoneBox btmGap">
                <div class="clearfix" id="answerzone">
                    <p><strong>Total number of questions in test: </strong><span><?php echo $total_question; ?></span></p>
                    <p><strong>Number of complete questions:</strong> <span><?php echo $complete_question; ?></span></p>
                    <p><strong>Number of incomplete questions: </strong><span><?php echo $incomplete_question; ?></span></p>
										<p><strong>Correct Answers:</strong><span><?php echo $correct_answer; ?></span></p>
                    <p><strong>Incorrect Answers:</strong><span><?php echo $incorrect_answer; ?></span></p>
                    <p><strong>Your score: </strong><span><?php echo number_format($marks_percentage,2); ?>%</span></p>
								</div>
            </div>
						<div class="questionZoneBot">
							 <input type="hidden" id="moduleid" name="moduleid" value="<?php echo $module_id; ?>">
							 <input type="hidden" id="topicid" name="topicid" value="<?php echo $topic_id; ?>">
							 <input type="hidden" id="totqusetion" name="totqusetion" value="<?php echo $total_question; ?>">
							 <input type="hidden" id="offset" name="offset" value="0">
							 <a href="#" class="motoRulesTwo"><i class="fa fa-question-circle"></i></a>
							 <!--<a href="#" class="motoRules">Review All</a>-->
							 <a class="motoRules learnzone" href="<?php echo base_url().'learn/learn_details/'.$topic_id; ?>">
									 Learning Zone
							 </a>
							 <br><br>
							 <!--<a href="#" class="motoRulesTwo"><i class="fa fa-question-circle"></i></a>
							 <a id="nxtquestion" class="motoRules" style="cursor: pointer;">Review Flagged</a>
							 <a id="viewsum" class="motoRules" style="cursor: pointer;" href="<?php //echo base_url().'learn/practice/answerResult/'.$topic_id.'/'.$module_id; ?>">End the test and show my result</a>	-->
						</div>
				</div>
		</div>
</div>