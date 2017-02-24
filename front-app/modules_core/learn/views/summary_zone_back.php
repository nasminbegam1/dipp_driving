<div class="stepPage">
		<div class="wrap">
				<div class="questionZonePan">
						<h2>Topic Test</h2>
						<a href="#" class="motoRules">Learning Zone</a>
						<div class="timeBlockPan">
								<!--<span>Accidents 2:  (1 of 20)</span>-->
								<div id="countdown-1"></div>
								<br class="spacer" />
						</div>
						<p><i class="fa fa-info-circle"></i> You haven't answered this question before </p>
						<div class="questionZoneBox">
								<div id="answerzone">
										<table border="0" width="50%" align="center" cellspacing="0" cellpadding="0">
												<tr>
														<td>Total number of questions in test:</td>
														<td><?php echo $total_question; ?></td>
												</tr>
												<tr>
														<td>Number of incomplete questions:</td>
														<td><?php echo $incomplete_question; ?></td>
												</tr>
												<tr>
														<td>Correct Answers:</td>
														<td><?php echo $correct_answer; ?></td>
												</tr>
												<tr>
														<td>Incorrect Answers:</td>
														<td><?php echo $incorrect_answer; ?></td>
												</tr>
												<tr>
														<td>Your score:</td>
														<td><?php echo number_format($marks_percentage,2); ?>%</td>
												</tr>
										</table>
										<table border="1" width="100%">
												<?php
												foreach($wrongQuestionArr as $key => $value){
														$arr= array();
														$arr= $value;
														$n= count($arr);
														?>
														<tr>
																<td>
																		<b><?php echo $arr[0]['question_text']; ?></b>
																		<table border="1">
																				<tr><td><ul>
																				<?php
																				for($i=0;$i<count($arr);$i++){
																						?>
																						<li><?php echo $arr[$i]['answer_text'] ;?></li>
																						<?php
																				}
																				?>
																				</ul></td></tr>
																		</table>
																</td>
														</tr>
														<?php
												}
												?>
										</table>
										<p><strong></strong></p>
										<div class="example">
												<div>
														<a class="motoRules" href="<?php echo base_url(); ?>learn/practice/resultSummary/<?php echo $topic_id; ?>/<?php echo $module_id; ?>">Go and View the Summary</a>
												</div>		
										</div>
								</div>
						</div>
				</div>
		</div>
</div>