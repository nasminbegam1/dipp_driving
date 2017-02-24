<? if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<div id="main_content">                    
    <!-- Start : main content loads from here -->    
    	<div class="row">
			<div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">Edit Test Centre</h4>
                    </div>
                    <div class="panel-body">
                        <form method="post" action="<?php echo base_url(); ?>test_centre/edit/<?php echo $id;?>/<?php echo $page;?>" class="form-validate main parsley_reg" enctype="multipart/form-data" >
			    <input type="hidden" name="action" value="Process">
                             <div class="form_sep">
				<label for="reg_input_name" class="req">Test Centre Name</label>
				<input type="text" class="form-control required" name="name" id="name" value="<?php echo $name;?>" data-required="true">
                            </div>
			     <div class="form_sep">
				<label for="reg_input_name" class="req">Zip Code</label>
				<input type="text" class="form-control required" name="zip_code" id="zip_code" value="<?php echo $zip_code;?>" data-required="true">
                            </div>
                            <div class="form_sep">
				<label for="reg_input_name" class="req">Address</label>
				<textarea class="form-control required" data-required="true" name="address" id="address"><?php echo $address;?></textarea>
                            </div>
			    <div class="form_sep">
				<label for="reg_input_name" class="req">Status</label>
				<select name="status" class="form-control">
						<option value="Active" <?php echo ($status == 'Active')?'selected':''; ?>>Active</option>
						<option value="Inactive" <?php echo ($status == 'Inactive')?'selected':''; ?>>Inactive</option>
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



















        
        

















        
        








