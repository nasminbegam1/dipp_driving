<? if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<div id="main_content">                    
    <!-- Start : main content loads from here -->    
    	<div class="row">
			<div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">Add Module</h4>
                    </div>
                    <div class="panel-body">
                        <form method="post" action="<?php echo base_url(); ?>module/add" class="form-validate main parsley_reg" enctype="multipart/form-data" >
			    <input type="hidden" name="action" value="Process">
                            <div class="form_sep">
				<label for="reg_input_name" class="req">Course</label>
				<?php echo form_dropdown('course_id', $courseOption, "", 'id="question_course_id" class="form-control required"');?>
                            </div>
                            <div class="form_sep">
				<label for="reg_input_name" class="req">Step</label>
                                    <select name="step_id" id="question_step_id" class="form-control required">
                                    <option value="" class="sc_show option">--Select Step--</option>    
                                    </select>
                            </div>
                            <div class="form_sep">
				<label for="reg_input_name" class="req">Topic</label>
                                    <select name="topic_id" id="question_topic_id" class="form-control required">
                                    <option value="" class="sc_show option">--Select Topic--</option>    
                                    </select>
                            </div>
                            
                            <div class="form_sep">
				<label for="reg_input_name" class="req">Module Name</label>
				<input type="text" class="form-control required" name="module_name" id="module_name" value="" data-required="true">
                            </div>
			    
			    <div class="form_sep">
				<label for="reg_input_name" class="req">Module Status</label>
				<select name="module_status" id="module_status" class="form-control required">
				    <option value="Active">Active</option>
				    <option value="Inactive">Inctive</option>
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