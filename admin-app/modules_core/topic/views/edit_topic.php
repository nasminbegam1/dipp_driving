<? if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<div id="main_content">                    
    <!-- Start : main content loads from here -->    
    	
            <?php if(validation_errors() != FALSE){?>
            <div align="center">
                <div class="nNote nFailure" style="width: 600px;">
                    <?php echo validation_errors('<p>', '</p>'); ?>
                </div>
            </div>
		<?php } ?>
        
    	<div class="row">
			<div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">Add Topic</h4>
                    </div>
                    <div class="panel-body">
                        <form method="post" action="<?php echo base_url(); ?>topic/edit/<?php echo $topic_id;?>/<?php echo $page;?>" class="form-validate main parsley_reg" enctype="multipart/form-data" >
			    <input type="hidden" name="action" value="Process">
                            <div class="form_sep">
				<label for="reg_input_name" class="req">Course</label>
				<?php echo form_dropdown('course_id', $courseOption,$course_id, 'id="course_id" class="form-control required"');?>
                            </div>
                            <div class="form_sep">
				<label for="reg_input_name" class="req">Step</label>
                                    <?php echo form_dropdown('step_id', $stepOption,$step_id, 'id="step_id" class="form-control required"');?>
                                    
                            </div>
                            <div class="form_sep">
				
                                <label for="reg_input_name" class="req">Topic</label>
				<input type="text" class="form-control required" name="topic_name" id="topic_name" value="<?php echo $name;?>" data-required="true">
                            </div>
			    <div class="form_sep">
                                <label for="reg_input_name" class="req">Main Image</label>
				<?php if(file_exists(FILE_UPLOAD_ABSOLUTE_PATH.'topic/main_image/thumbs/'.$main_image) && $main_image <> ''){?>
				<img src="<?php echo FILE_UPLOAD_URL?>topic/main_image/thumbs/<?php echo $main_image;?>" border="0">
                                <br><br>
				<?php } ?>
				<input type="file" class="form-control" name="main_image" id="main_image" value="" data-required="true">
                            </div>
                            <div class="form_sep">
				
                                <label for="reg_input_name" class="req">Image</label>
                                <img src="<?php echo FILE_UPLOAD_URL?>topic/thumbs/<?php echo $image;?>" border="0">
                                <br><br>
				<input type="file" class="" name="topic_image" id="topic_image" value="" data-required="true">
                            </div>
                            <div class="form_sep">
				
                                <label for="reg_input_name" class="req">Description</label>
                                <textarea name="topic_desc" class="form-control required"><?php echo $short_description;?></textarea>
                            </div>
			    
			    
                            <div class="form_sep">
                                <input type="hidden" name="image_name" value="<?php echo $image;?>">
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