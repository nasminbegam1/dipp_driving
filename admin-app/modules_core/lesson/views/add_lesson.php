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
                        <h4 class="panel-title">Add Lesson</h4>
                    </div>
                    <div class="panel-body">
                        <form method="post" action="<?php echo base_url(); ?>lesson/add" class="form-validate main parsley_reg" enctype="multipart/form-data" >
			    <input type="hidden" name="action" value="Process">
                            <div class="form_sep">
				<label for="reg_input_name" class="req">Course</label>
				<?php echo form_dropdown('course_id', $courseOption, "", 'id="course_id" class="form-control required"');?>
                            </div>
			    
                            <div class="form_sep">
				<label for="reg_input_name" class="req">Step</label>
                                    <select name="step_id" id="step_id" class="form-control required">
					<option value="" class="sc_show option">--Select Step--</option>    
                                    </select>
                            </div>
			    
			    <div class="form_sep">
				<label for="reg_input_name" class="req">Topic</label>
                                    <select name="topic_id" id="topic_id" class="form-control required">
					<option value="" class="sc_show option">--- Select Topic --</option>    
                                    </select>
                            </div>
			    
                            <div class="form_sep">
				
                                <label for="reg_input_name" class="req">Lesson Name</label>
				<input type="text" class="form-control required" name="name" id="name" value="" data-required="true">
                            </div>
			    
			    <div class="form_sep">
				
                                <label for="reg_input_name" class="req">Lesson Short Description</label>
				<textarea name="description" class="form-control required" id="description" data-required="true"></textarea>
                            </div>
			    
			    
			    <div class="form_sep">
                                <label for="reg_input_name" class="req">Lesson Document Type<a href="javascript:void(0)" id="addMoreDocumentType">Add more</a></label>
				<input type="radio" value="image" name="desc_type_0" id="descTypeImage_0" class="doc_type">Image
				<input type="radio" value="text" name="desc_type_0" id="descTypeText_0" class="doc_type">Text
                            </div>
			    
                            <div class="form_sep" style="display:none;" id="image_div_0">
                                <label for="reg_input_name" class="req">Image</label>
				<input type="file" class="form-control required" name="lesson_image_0" id="lesson_image" data-required="true">
                            </div>
			    
                            <div class="form_sep" style="display:none;" id="description_div_0">
                                <label for="reg_input_name" class="req">Description</label>
                                <textarea name="desc_content_0" class="form-control required"></textarea>
                            </div>
			    
			    <div id="documentTypeContent"></div>
			    <input type="hidden" name="total_value" id="total_value" value="0">
			    <div class="form_sep">
				<label for="reg_input_name" class="req">Status</label>
                                    <select name="status" id="status" class="form-control required">
					<option value="Active" class="sc_show option">Active</option>
					<option value="Inactive" class="sc_show option">Inactive</option>
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