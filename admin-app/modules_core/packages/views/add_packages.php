 <div id="main_content">                    
    <!-- Start : main content loads from here -->    
    	<div class="row">
			<div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">Add Package</h4>
                    </div>
                    <div class="panel-body">
                        <form method="post" action="<?php echo base_url(); ?>packages/add" class="form-validate main parsley_reg" enctype="multipart/form-data" >
			    <input type="hidden" name="action" value="Process">
                            <div class="form_sep">
				<label for="reg_input_name" class="req">Package Name</label>
				<input type="text" class="form-control required" name="package_name" id="package_name" value="" data-required="true">
                            </div>
                             <div class="form_sep">
				<label for="reg_input_name" class="req">Package Description</label>
				<textarea data-required="true" id="package_desc" class="form-control required" name="package_desc"></textarea>
                            </div>
			    <div class="form_sep">
				<label for="reg_input_name" class="req">Package Amount</label>
				<input type="text" class="form-control required" name="package_amount" id="package_amount" value="" data-required="true">
                            </div>
			    <div class="form_sep">
				<label for="reg_input_name" class="req">No Of Student</label>
				<input type="number" class="form-control required" name="no_student" id="no_student" value="" data-required="true">
                            </div>
			    <div class="form_sep">
				<label for="reg_input_name" class="req">Recommended?</label>
				<input type="radio" name="is_recommended" value="Y">Yes
				<input type="radio" checked="checked" name="is_recommended"  value="N">No
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