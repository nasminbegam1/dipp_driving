<? if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<div id="main_content">                    
    <!-- Start : main content loads from here -->    
    	<?php
	$validation_error = $this->session->flashdata('message');
	if(is_array($validation_error) && count($validation_error) && $validation_error['type'] == 'errormsgbox'){
	?>
	    <div align="center">
                <div class="nNote nFailure" style="width: 600px;">
                    <?php echo $validation_error['content']; ?>
                </div>
            </div>
	<?
	}
	?>
    	<div class="row">
			<div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">Add Testimonial</h4>
                    </div>
                    <div class="panel-body">
                        <form method="post" action="<?php echo base_url(); ?>testimonial/add" class="form-validate main parsley_reg" enctype="multipart/form-data" >
			    <input type="hidden" name="action" value="Process">
                            
                            <div class="form_sep">
				
                                <label for="reg_input_name" class="req">Name</label>
				<input type="text" class="form-control required" name="name" id="name" value="" data-required="true">
                            </div>
			    <div class="form_sep">
                                <label for="reg_input_name">Location</label>
				<input type="text" class="form-control" name="company_name" id="company_name" value="">
                            </div>
                            <div class="form_sep">
                                <label for="reg_input_name" class="req">Description</label>
				<textarea class="form-control required" name="description" id="description" data-required="true"></textarea>
                            </div>
			    <div class="form_sep">
                                <label for="reg_input_name" class="req">Image</label>
				<input type="file" class="required" name="image" id="image" value="" data-required="true">
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