<? if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<div id="main_content">                    
    <!-- Start : main content loads from here -->    
    	<div class="row">
			<div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">Edit Packages</h4>
                    </div>
                    <div class="panel-body">
                        <form method="post" action="<?php echo base_url(); ?>packages/edit/<?php echo $package_id;?>/<?php echo $page;?>" class="form-validate main parsley_reg" enctype="multipart/form-data" >
			    <input type="hidden" name="action" value="Process">
                             <div class="form_sep">
				<label for="reg_input_name" class="req">Package Name</label>
				<input type="text" class="form-control required" name="package_name" id="package_name" value="<?php echo $package_name;?>" data-required="true">
                            </div>
                            <div class="form_sep">
				<label for="reg_input_name" class="req">Package Description</label>
				<textarea type="text" class="form-control required" name="package_desc" id="package_desc" data-required="true"><?php echo $package_desc;?></textarea>
                            </div>
                            <div class="form_sep">
				<label for="reg_input_name" class="req">Package Amount</label>
				<input type="text" class="form-control required" name="package_amount" id="package_amount" value="<?php echo $package_amount;?>" data-required="true">
                            </div>
                            <div class="form_sep">
				<label for="reg_input_name" class="req">No Of Student</label>
				<input type="text" class="form-control required" name="no_student" id="no_student" value="<?php echo $no_student;?>" data-required="true">
                            </div>
                            <div class="form_sep">
				<label for="reg_input_name" class="req">Recommended?</label>
				<input type="radio" name="is_recommended" value="Y" <?php echo ($is_recommended=='Y')?'checked':''; ?>>Yes
				<input type="radio" name="is_recommended" value="N" <?php echo ($is_recommended=='N')?'checked':''; ?>>No
                            </div>
			    <div class="form_sep">
				<label for="reg_input_name" class="req">Status</label>
				<select name="package_status" class="form-control">
						<option value="Active" <?php echo ($package_status == 'Active')?'selected':''; ?>>Active</option>
						<option value="Inactive" <?php echo ($package_status == 'Inactive')?'selected':''; ?>>Inactive</option>
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



















        
        

















        
        








