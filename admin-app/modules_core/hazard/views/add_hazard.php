<? if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<div id="main_content">                    
    <!-- Start : main content loads from here -->    
    	<div class="row">
			<div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">Add Hazard</h4>
                    </div>
                    <div class="panel-body">
                        <form method="post" action="<?php echo base_url(); ?>hazard/add" class="form-validate main parsley_reg" enctype="multipart/form-data" >
			    <input type="hidden" name="action" value="Process">
                            <div class="form_sep">
				<label for="reg_input_name" class="req">Course</label>
				<?php echo form_dropdown('course_id', $courseOption, "", 'id="question_course_id" class="form-control required"');?>
                            </div>
                            
                            
                            <div class="form_sep">
                                <label for="reg_input_name" class="req">Hazard Title</label>
                                <input type="text" class="form-control" name="hazard_title" id="hazard_title" value="" data-required="true">
                            </div>
			    
			    <div class="form_sep">
				<label for="reg_input_name" class="req">Hazard Content</label>
				<?php echo $this->ckeditor->editor('hazard_content');?>
                            </div>
			    
			    <div class="form_sep">
				<label for="reg_input_name" class="req">Hazard Status</label>
				<select name="hazard_status" id="hazard_status" class="form-control required">
				    <option value="Active">Active</option>
				    <option value="Inactive">Inactive</option>
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