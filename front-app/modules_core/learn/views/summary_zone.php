<div class="stepPage">
		<div class="wrap">
				<div class="questionZonePan">
						<h2>Topic Test</h2>
						<a href="<?php echo FRONTEND_URL.'learn';?>" class="motoRules">Learning Zone</a>
						<div class="timeBlockPan">
								<div id="countdown-1"></div>
								<br class="spacer" />
						</div>
					<!--	<p><i class="fa fa-info-circle"></i> You haven't answered this question before </p>-->
						<div class="questionZoneBox btmGap">
								<div class="clearfix" id="answerzone">
										<p><strong>Total number of questions in test: </strong><span><?php echo $total_question; ?></span></p>
										<p><strong>Number of complete questions:</strong> <span><?php echo $complete_question; ?></span></p>
										<p><strong>Number of incomplete questions: </strong><span><?php echo $incomplete_question; ?></span></p>
										<p><strong>Correct Answers:</strong><span><?php echo $correct_answer; ?></span></p>
										<p><strong>Incorrect Answers:</strong><span><?php echo $incorrect_answer; ?></span></p>
										<p><strong>Your score: </strong><span><?php echo number_format($marks_percentage,2); ?>%</span></p>
										<?php
										if(number_format($marks_percentage,2) <=30.00){
												echo "<div class='exam-fail'>Unfortunately you have not passed this practice test</div>";
										}
										else{
												echo "<div class='exam-pass'>You have passed this practice test</div>";
										}
										?>
								</div>
						</div>
						<div class="wrongQuestionZoneBox">
								<?php
								//pr($wrongQuestionArr,0);
								foreach($wrongQuestionArr as $key => $value){
										$arr= array();
										$arr= $value;
										$n= count($arr);
										?>
										<div class="indvQuestion">
												<div class="quesMainPan clearfix">
														<div class="indvLeft">
																<p><strong>Q:<?php echo stripslashes($arr[0]['question_text']); ?></strong></p>
																<?php
																if($arr[0]['question_image'] != ''){
																		?>
																		<div class="questionImage"><img src="<?php echo base_url().'uploads/question/'.$arr[0]['question_image']; ?>"></div>
																		<?php
																}
																?>
																<div class="example answerZone">
																		<ul>
																		<?php
																		for($i=0;$i<count($arr);$i++){
																				if($arr[$i]['is_answer'] == 'Y'){
																						$img= base_url().'images/right.png';
																				}
																				else{
																						$img= base_url().'images/wrong.png';
																				}
																				?>
																				<li>
																						<img src="<?php echo $img; ?>">
																						<?php
																						if($arr[$i]['answer_type'] == 'image'){
																								?>
																								<img src="<?php echo base_url().'uploads/question_answer/'.$arr[$i]['answer_text']; ?>">
																								<?php   
																						}
																						else{
																								echo stripslashes($arr[$i]['answer_text']);
																						}
																						?>
																				</li>
																				<?php
																		}
																		?>
																		</ul>
																</div>
														</div>
														<!--
														<div class="explanation">
																<h3>Explanation:</h3>
																<p>Catalytic converters are designed to reduce a large percentage of toxic emissions. They work more efficiently when the engine has reached its normal working temperature.</p>
														</div>
														-->
												</div>
												<div class="userAnswer">
														<p class="choseAns">You choose the following answer(s):</p>
														<span class="userGivenAnswer">
																<?php
																for($j=0;$j<count($arr);$j++){
																		for($k=0;$k<count($givenAnswerArr);$k++){
																				$_givenAnswerIds= $givenAnswerArr[$k]['answer_id'];
																				if (strpos($_givenAnswerIds,',') !== false):
																						$answer= explode(",",$_givenAnswerIds);
																						for($m=0;$m<count($answer);$m++):
																								if($arr[$j]['answer_id'] == $answer[$m]): ?>
																										<img src="<?php echo base_url(); ?>/images/wrong.png">
																										<?php if($arr[$j]['answer_type'] == 'image'):	?>
																												<img src="<?php echo base_url().'uploads/question_answer/'.$arr[$j]['answer_text']; ?>">
																										<?php else: echo $arr[$j]['answer_text']; endif; ?><br>
																										<?php
																								endif;
																						endfor;
																				else:
																						if($arr[$j]['answer_id'] == $givenAnswerArr[$k]['answer_id']): 												
																								?>
																								<img src="<?php echo base_url(); ?>/images/wrong.png">
																								<?php if($arr[$j]['answer_type'] == 'image'):	?>
																										<img src="<?php echo base_url().'uploads/question_answer/'.$arr[$j]['answer_text']; ?>">
																								<?php else: echo stripslashes($arr[$j]['answer_text']); endif; ?><br>
																						<?php endif; 
																				endif;
																		}
																}
																?>		
														</span>
												</div>
										</div>
										<?php
								}
								?>
						</div>				
				</div>
		</div>
</div>