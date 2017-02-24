<? if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<div id="main_content">                    
    <!-- Start : main content loads from here -->    
    	<div class="row">
			<div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">Edit Instructor</h4>
                    </div>
                    <div class="panel-body">
                        <form method="post" action="<?php echo base_url(); ?>instructor/edit/<?php echo $instructor_id;?>/<?php echo $page;?>" class="form-validate main parsley_reg" enctype="multipart/form-data" >
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
					        <option value="<?php echo $cl['id']; ?>" <?php echo ($cl['id']==$instractor_data[0]['course_id'])?'selected':'';?>><?php echo stripslashes($cl['name']); ?></option>
					<?php
					}
				    }
				    ?>
                                </select>
                            </div>	
                            <div class="form_sep">
				
                                <label for="reg_input_name" class="req">Business Name</label>
				<input type="text" class="form-control required" name="instructor_business_name" id="instructor_business_name" value="<?php echo $instractor_data[0]['instructor_business_name']; ?>" data-required="true">
                            </div>
			    <div class="form_sep">
				
                                <label for="reg_input_name" class="req">First Name</label>
				<input type="text" class="form-control required" name="instructor_fname" id="instructor_fname" value="<?php echo $instractor_data[0]['instructor_fname']; ?>" data-required="true">
                            </div>
			    <div class="form_sep">
				
                                <label for="reg_input_name" class="req">Last Name</label>
				<input type="text" class="form-control required" name="instructor_lname" id="instructor_lname" value="<?php echo $instractor_data[0]['instructor_lname']; ?>" data-required="true">
                            </div>
			    <div class="form_sep">
				
                                <label for="reg_input_name" class="req">Email</label>
				<input type="text" class="form-control required instructor_email" name="instructor_email" id="instructor_email" value="<?php echo $instractor_data[0]['instructor_email']; ?>" data-required="true" readonly>
                            </div>
			    <div class="form_sep">
				
                                <label for="reg_input_name">Password</label>
				<input type="password" class="form-control" name="instructor_password" id="instructor_password" value="">
                            </div>
			    <div class="form_sep">
				
                                <label for="reg_input_name" class="req">Phone Number</label>
				<input type="text" class="form-control required" name="instructor_phone_number" id="instructor_phone_number" value="<?php echo $instractor_data[0]['instructor_phone_number']; ?>" data-required="true">
                            </div>
			    <div class="form_sep">
				
                                <label for="reg_input_name" class="req">Address</label>
				<textarea class="form-control required" name="instructor_address" id="instructor_address" data-required="true"><?php echo $instractor_data[0]['instructor_address']; ?></textarea>
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
					        <option value="<?php echo $pl['package_id']; ?>" <?php echo ($pl['package_id']==$instractor_data[0]['package_id'])?'selected':'';?>><?php echo $pl['package_name']; ?></option>
					<?php
					}
				    }
				    ?>
                                </select>
                            </div>
                            <div class="form_sep">
				
                                <label for="reg_input_name">Logo</label>
				<input type="file" name="instructor_logo" id="instructor_logo" value="">
				<br>
				<img src="<?php echo FILE_UPLOAD_URL.'instructor_logo/'.$instractor_data[0]['instructor_logo'];?>" height="100" width="100">
                            </div>
			    <div class="form_sep">
				<label for="reg_input_name" class="req">Instructor Status</label>
                                    <select name="instructor_status" id="instructor_status" class="form-control required">
                                    <option value="" class="sc_show option">--Select--</option>
				    <option value="Active" class="sc_show option" <?php echo ($instractor_data[0]['instructor_status'] == 'Active')?'selected':'';?>>Active</option>
				    <option value="Inactive" class="sc_show option" <?php echo ($instractor_data[0]['instructor_status'] == 'Inactive')?'selected':'';?>>Inactive</option>
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