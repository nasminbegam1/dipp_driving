<div class="stepPage">
		<div class="wrap">
				<div class="questionZonePan">
						<h2>Topic Test</h2>
						<a href="<?php echo FRONTEND_URL.'learn'?>" class="motoRules">Learning Zone</a>
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
										<p><strong></strong></p>
										<div class="example viewsummary">
												<div>
														<a class="motoRules" href="<?php echo base_url(); ?>learn/practice/resultSummary/<?php echo $topic_id; ?>/<?php echo $module_id; ?>">Go and View the Summary</a>
												</div>		
										</div>
								</div>
						</div>
				</div>
		</div>
</div>