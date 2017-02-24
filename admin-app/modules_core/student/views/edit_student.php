<? if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<div id="main_content">                    
    <!-- Start : main content loads from here -->    
    	<div class="row">
			<div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">Edit Student</h4>
                    </div>
                    <div class="panel-body">
                        <form method="post" action="<?php echo base_url(); ?>student/edit/<?php echo $student_id;?>/<?php echo $page;?>" class="form-validate main parsley_reg" enctype="multipart/form-data" >
			    <input type="hidden" name="action" value="Process">
                           <div class="form_sep">
				<label for="reg_input_name" class="req">Instructor</label>
				<?php echo form_dropdown('instructor_id', $instructorOption,$instructor_id, 'id="instructor_id" class="form-control required"');?>
                            </div>
                            <div class="form_sep">
				<label for="reg_input_name" class="req">First Name</label>
				<input type="text" class="form-control required" name="student_fname" id="student_fname" value="<?php echo $student_fname;?>" data-required="true">
                            </div>
                            <div class="form_sep">
				<label for="reg_input_name" class="req">Last Name</label>
				<input type="text" class="form-control required" name="student_lname" id="student_lname" value="<?php echo $student_lname;?>" data-required="true">
                            </div>
                            <div class="form_sep">
				<label for="reg_input_name" class="req">Email</label>
				<input type="text" class="form-control required email" name="student_email" id="student_email" value="<?php echo $student_email;?>" data-required="true">
                            </div>
                            <div class="form_sep">
				<label for="reg_input_name" class="req">Phone Number</label>
				<input type="text" class="form-control required" name="student_phone" id="student_phone" value="<?php echo $student_phone;?>" data-required="true">
                            </div>
                            <div class="form_sep">
				<label for="reg_input_name" class="req">Status</label>
				<?php echo form_dropdown('student_status', $statusOption,$student_status, 'id="student_status" class="form-control required"');?>
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