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
                        <h4 class="panel-title">Add Advertisement</h4>
                    </div>
                    <div class="panel-body">
                        <form method="post" action="<?php echo base_url(); ?>advertisement/add" class="form-validate main parsley_reg" enctype="multipart/form-data" >
			    <input type="hidden" name="action" value="Process">
                            
                            <div class="form_sep">
                                <label for="reg_input_name" class="req">Title</label>
				<input type="text" class="form-control required" name="advertisement_title" id="advertisement_title" value="" data-required="true">
                            </div>
			    <div class="form_sep">
                                <label for="reg_input_name" class="req">Link</label>
				<input type="text" class="form-control required" name="advertisement_link" id="advertisement_link" value="" data-required="true">
                            </div>
                            <div class="form_sep">
				
                                <label for="reg_input_name" class="req">Image</label>
				<input type="file" class="required" name="advertisement_image" id="advertisement_image" value="" data-required="true">
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