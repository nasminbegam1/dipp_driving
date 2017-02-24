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
                        <h4 class="panel-title">Edit Lesson</h4>
                    </div>
                    <div class="panel-body">
                        <form method="post" action="<?php echo base_url(); ?>lesson/edit/<?php echo $lesson_id;?>/<?php echo $page;?>" class="form-validate main parsley_reg" enctype="multipart/form-data" >
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
                                    <?php echo form_dropdown('topic_id', $topicOption,$topic_id, 'id="topic_id" class="form-control required"');?>
                            </div>
			    
                            <div class="form_sep">
				
                                <label for="reg_input_name" class="req">Lesson Name</label>
				<input type="text" class="form-control required" name="name" id="name" value="<?php echo $name;?>" data-required="true">
                            </div>
			    
			    <div class="form_sep">
				
                                <label for="reg_input_name" class="req">Lesson Short Description</label>
				<textarea name="description" class="form-control required" id="description" data-required="true"><?php echo $description;?></textarea>
                            </div>
			    <?php
			    //pr($lesson_details_data);
			    if(is_array($lesson_details_data)){
			    foreach($lesson_details_data as $k=>$lessonDetails){
			    ?>
			    <div id='addRemoveDiv<?php echo $k;?>'>
			    <div class="form_sep">
				
                                <label for="reg_input_name" class="req">Lesson Document Type <?php if($k==0){?><a href="javascript:void(0)" id="addMoreDocumentType">Add more</a><?php } ?></label>
				<input type="radio" value="image" name="desc_type_<?php echo $k;?>" id="descTypeImage_<?php echo $k;?>" class="doc_type" <?php if($lessonDetails['desc_type'] == 'image'){?>checked<?php } ?>>Image
				<input type="radio" value="text" name="desc_type_<?php echo $k;?>" id="descTypeText_<?php echo $k;?>" class="doc_type" <?php if($lessonDetails['desc_type'] == 'text'){?>checked<?php } ?>>Text
				<?php if($k != 0){?><a href="<?php echo base_url()."lesson/deleteLessionDetails/".$lessonDetails['id']."/".$lesson_id."/".$page."/"; ?>" id='removeDiv_<?php echo $k;?>' class='removeDiv'>Remove</a><?php } ?>
                            </div>
                            <div class="form_sep" id="image_div_<?php echo $k;?>">
				
                                <label for="reg_input_name" class="req">Image</label>
				<input type="hidden" name="lesson_image_name_<?php echo $k;?>" value="<?php echo $lessonDetails['desc_content'];?>">
				<?php if(file_exists(FILE_UPLOAD_ABSOLUTE_PATH.'lesson/thumbs/'.$lessonDetails['desc_content'])){?>
                                <img src="<?php echo FILE_UPLOAD_URL?>lesson/thumbs/<?php echo $lessonDetails['desc_content'];?>" border="0" width="120" height="160">
				<?php } ?>
                                <br><br>
				<input type="file" class="" name="lesson_image_<?php echo $k;?>" id="lesson_image" value="" data-required="true">
                                <br>
                                <textarea name="other_content_<?php echo $k;?>" class="form-control"><?php echo $lessonDetails['other_content'];?></textarea>
                            </div>
			    
			    
                            <div class="form_sep" id="description_div_<?php echo $k;?>">
				
                                <label for="reg_input_name" class="req">Description</label>
                                <textarea name="desc_content_<?php echo $k;?>" class="form-control required"><?php echo ($lessonDetails['desc_type'] == 'text')?stripcslashes($lessonDetails['desc_content']):'';?></textarea>
                            </div>
			</div>
			<?php } } ?>
			<div id="documentTypeContent"></div>
			<input type="hidden" id="total_value" name="total_value" value="<?php echo count($lesson_details_data)-1;?>">
			    <div class="form_sep state-success">
				<label class="req" for="reg_input_name">Status</label>
                                    <select class="form-control required valid" id="status" name="status">
					<option value="Active" <?php if($status == 'Active') { ?>selected<?php } ?>>Active</option>
					<option value="Inactive" <?php if($status == 'Inactive') { ?>selected<?php } ?>>Inactive</option>
				    </select>
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