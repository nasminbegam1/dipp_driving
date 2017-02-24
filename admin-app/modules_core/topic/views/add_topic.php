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
                        <form method="post" action="<?php echo base_url(); ?>topic/add" class="form-validate main parsley_reg" enctype="multipart/form-data" >
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
				<input type="text" class="form-control required" name="topic_name" id="topic_name" value="" data-required="true">
                            </div>
			    <div class="form_sep">
                                <label for="reg_input_name" class="req">Main Image</label>
				<input type="file" class="form-control required" name="main_image" id="main_image" value="" data-required="true">
                            </div>
                            <div class="form_sep">
				
                                <label for="reg_input_name" class="req">Image</label>
				<input type="file" class="form-control" name="topic_image" id="topic_image" value="" data-required="true">
                            </div>
                            <div class="form_sep">
				
                                <label for="reg_input_name" class="req">Description</label>
                                <textarea name="topic_desc" class="form-control required"></textarea>
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