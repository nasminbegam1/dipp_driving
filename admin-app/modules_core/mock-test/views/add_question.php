<div id="main_content">                    
<!-- Start : main content loads from here -->    
		<div class="row">
				<div class="col-sm-12">
						<div class="panel panel-default">
								<div class="panel-heading">
										<h4 class="panel-title">Add Mock Test Question</h4>
								</div>
								<div class="panel-body">
										<form method="post" action="<?php echo base_url(); ?>mock-test/question/add" class="form-validate main parsley_reg" enctype="multipart/form-data">
												<input type="hidden" name="action" value="Process">
												<div class="form_sep">
														<label for="reg_input_name" class="req">Course</label>
														<?php echo form_dropdown('course_id', $courseOption, "", 'id="course_id1" class="form-control required"');?>
												</div>
												<div class="form_sep">
														<label for="reg_input_name" class="req">Topic</label>
														<select name="topic_id" class="form-control required">
																<?php
																foreach($topicOption as $topic){?>
																		<option value="<?php echo $topic['id'] ?>"><?php echo $topic['name'] ?></option>
																<?php		
																}
																?>
														</select>
												</div>
												<div class="form_sep">
														<label for="reg_input_name" class="req">Question No</label>
														<input type="text" name="question_no" id="question_no" data-required="true" class="form-control required" />
												</div>
												<div class="form_sep">
														<label for="reg_input_name" class="req">Question</label>
														<textarea class="form-control required" name="question" id="question" data-required="true"></textarea>
												</div>
												<div class="form_sep">
														<label for="reg_input_name">Image</label>
														<input type="file" class="" name="question_image" id="question_image" value="">
												</div>
												<div class="form_sep">
														<label for="reg_input_name" class="req">Explanation</label>
														<textarea data-required="true" id="question_explanation" class="form-control required" name="question_explanation"></textarea>
												</div>
												<div class="form_sep">
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