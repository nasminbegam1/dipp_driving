<? if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<div id="main_content">                    
    <!-- Start : main content loads from here -->
    
    <?php //if(validation_errors() != FALSE){?>
    <!--<div align="center">
	<div class="nNote nFailure" style="width: 600px;">
	    <?php echo validation_errors('<p>', '</p>'); ?>
	</div>
    </div>-->
    <?php //} ?>
        
    	<div class="row">
			<div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">Add Instructor</h4>
                    </div>
                    <div class="panel-body">
			<?php
			    $message = $this->session->flashdata('message');
			    if(isset($message['content']) && $message['content'] != ''){
			?>
			    <div align="center">
				    <div class="nNote nFailure" style="width: 600px;">
				    <?php echo $message['content']; ?>
				    </div>
			    </div>
			<?php
			    }
			?>
                        <form method="post" action="<?php echo base_url(); ?>instructor/add" class="form-validate main parsley_reg" enctype="multipart/form-data" >
			    <input type="hidden" name="action" value="Process">
                            <div class="form_sep">
				
                                <label for="reg_input_name" class="req">Course Type</label>
				<select name="course_id" class="form-control required">
                                    <option value="" class="sc_show option">--Select--</option>
				    <?php
				    if(is_array($courseList) && count($courseList) > 0)
				    {
					foreach($courseList AS $cl)
					{
					    ?>
					        <option value="<?php echo $cl['id']; ?>"><?php echo stripslashes($cl['name']); ?></option>
					<?php
					}
				    }
				    ?>
                                </select>
                            </div>
			    
                            <div class="form_sep">
                                <label for="reg_input_name" class="req">Business Name</label>
				<input type="text" class="form-control required" name="instructor_business_name" id="instructor_business_name" value="" data-required="true">
                            </div>
			    <div class="form_sep">
				
                                <label for="reg_input_name" class="req">First Name</label>
				<input type="text" class="form-control required" name="instructor_fname" id="instructor_fname" value="" data-required="true">
                            </div>
			    <div class="form_sep">
				
                                <label for="reg_input_name" class="req">Last Name</label>
				<input type="text" class="form-control required" name="instructor_lname" id="instructor_lname" value="" data-required="true">
                            </div>
			    <div class="form_sep">
				
                                <label for="reg_input_name" class="req">Email</label>
				<input type="text" class="form-control required instructor_email" name="instructor_email" id="instructor_email" value="" data-required="true">
                            </div>
			    <div class="form_sep">
				
                                <label for="reg_input_name" class="req">Password</label>
				<input type="password" class="form-control required" name="instructor_password" id="instructor_password" value="" data-required="true">
                            </div>
			    <div class="form_sep">
				
                                <label for="reg_input_name" class="req">Phone Number</label>
				<input type="text" class="form-control required" name="instructor_phone_number" id="instructor_phone_number" value="" data-required="true">
                            </div>
			    <div class="form_sep">
				
                                <label for="reg_input_name" class="req">Address</label>
				<textarea class="form-control required" name="instructor_address" id="instructor_address" data-required="true"></textarea>
                            </div>
			    <div class="form_sep">
				
                                <label for="reg_input_name" class="req">Package Type</label>
				<select name="package_id" id="package_id" class="form-control required">
                                    <option value="" class="sc_show option">--Select--</option>
				    <?php
				    if(is_array($packageList) && count($packageList) > 0)
				    {
					foreach($packageList AS $pl)
					{
					    ?>
					        <option value="<?php echo $pl['package_id']; ?>"><?php echo stripslashes($pl['package_name']); ?></option>
					<?php
					}
				    }
				    ?>
                                </select>
                            </div>
                            <div class="form_sep">
				
                                <label for="reg_input_name" class="req">Logo</label>
				<input type="file" class="required" name="instructor_logo" id="instructor_logo" value="" data-required="true">
                            </div>
			    
			    
			    
                            <!--<div class="form_sep">
				<label for="reg_input_name" class="req">Instructor Status</label>
                                    <select name="instructor_status" id="instructor_status" class="form-control required">
                                    <option value="" class="sc_show option">--Select--</option>
				    <option value="Active" class="sc_show option">Active</option>
				    <option value="Inactive" class="sc_show option">Inactive</option>
                                    </select>
                            </div>-->
			    
			    
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