<div class="stepPage">
		<div class="wrap">
				<div class="questionZonePan">
						<h2>Mock Theory Test</h2>
						<a href="<?php echo base_url().'learn'; ?>" class="motoRules">Learning Zone</a>
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
				</div>
		</div>
</div>