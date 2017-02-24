<div id="main_content">                    
<!-- Start : main content loads from here -->    
		<div class="row">
				<div class="col-sm-12">
						<div class="panel panel-default">
								<div class="panel-heading">
										<h4 class="panel-title">Edit Question</h4>
								</div>
								<div class="panel-body">
										<form method="post" action="<?php echo base_url(); ?>mock-test/question/edit/<?php echo $question_id;?>/<?php echo $page;?>" class="form-validate main parsley_reg" enctype="multipart/form-data" >
												<input type="hidden" name="action" value="Process">
												<div class="form_sep">
														<label for="reg_input_name" class="req">Course</label>
														<?php echo form_dropdown('course_id', $courseOption,$course_id, 'id="course_id" class="form-control required"');?>
												</div>
												<div class="form_sep">
														<label for="reg_input_name" class="req">Topic</label>
														<select name="topic_id" class="form-control required">
																<?php
																foreach($topicOption as $topic){?>
																		<option value="<?php echo $topic['id'] ?>" <?php if(in_array($topicid,$topic)){ echo 'Selected'; } ?>><?php echo $topic['name'] ?></option>
																<?php		
																}
																?>
														</select>
												</div>
												<div class="form_sep">
														<label for="reg_input_name" class="req">Question No</label>
														<input type="text" name="question_no" id="question_no" data-required="true" value="<?php echo $question_no;?>" class="form-control required" />
												</div>
												<div class="form_sep">
														<label for="reg_input_name" class="req">Question</label>
														<textarea class="form-control required" name="question" id="question" data-required="true"><?php echo $question;?></textarea>
												</div>
												<div class="form_sep">
														<label for="reg_input_name">Image</label>
														<?php
														if($question_image <> '') { ?>
																<img src="<?php echo FILE_UPLOAD_URL?>question/mock_test/<?php echo $question_image;?>" border="0">
																<br><br>
																<?php
														}
														?>
														<input type="file" class="" name="question_image" id="question_image" value="" data-required="true">
												</div>
												<div class="form_sep">
														<label for="reg_input_name" class="req">Explanation</label>
														<textarea id="question_explanation" class="form-control required" name="question_explanation"><?php echo preg_replace('/(?:\s+|\n|\t)/', " ", ltrim($question_explanation));?></textarea>
												</div>
												<div class="form_sep">
														<input type="hidden" name="image_name" value="<?php echo $question_image;?>">
														<button class="btn btn-default" type="submit">Submit</button>
														<button class="btn btn-default" type="button" onclick="location.href='<?php echo $return_link; ?>'">Cancel</button>
												</div>
										</form>
								</div>
						</div>
				</div>
		</div>
<!--End : Main content-->    
</div>