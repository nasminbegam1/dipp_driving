<? if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<div id="main_content">                    
    <!-- Start : main content loads from here -->    
    	<div class="row">
			<div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">Edit Question</h4>
                    </div>
                    <div class="panel-body">
                        <form method="post" action="<?php echo base_url(); ?>question/edit/<?php echo $question_id;?>/<?php echo $page;?>" class="form-validate main parsley_reg" enctype="multipart/form-data" >
			    <input type="hidden" name="action" value="Process">
                            <div class="form_sep">
				<label for="reg_input_name" class="req">Course</label>
				<?php echo form_dropdown('course_id', $courseOption,$course_id, 'id="question_course_id" class="form-control required"');?>
                            </div>
                            <div class="form_sep">
				<label for="reg_input_name" class="req">Step</label>
				<?php echo form_dropdown('step_id', $stepOption, $step_id, 'id="question_step_id" class="form-control required"');?>
                            </div>
                            <div class="form_sep">
				<label for="reg_input_name" class="req">Topic</label>
				<?php echo form_dropdown('topic_id', $topicOption,$topic_id, 'id="question_topic_id" class="form-control required"');?>
                            </div>
                            <div class="form_sep">
				<label for="reg_input_name" class="req">Module</label>
				<?php echo form_dropdown('module_id', $moduleOption,$module_id, 'id="question_module_id" class="form-control required"');?>
                            </div>
                            <div class="form_sep">
				<label for="reg_input_name" class="req">Question</label>
				<input type="text" class="form-control required" name="question" id="question" value="<?php echo $question;?>" data-required="true">
                            </div>
                            <div class="form_sep">
				<label for="reg_input_name" class="req">Image</label>
                                <?php if($question_image <> '') { ?>
                                <img src="<?php echo FILE_UPLOAD_URL?>question/thumbs/<?php echo $question_image;?>" border="0">
                                <br><br>
                                <?php } ?>
                                <input type="file" class="" name="question_image" id="question_image" value="" data-required="true">
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