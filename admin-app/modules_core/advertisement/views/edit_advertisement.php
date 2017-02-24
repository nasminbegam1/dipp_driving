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
                        <h4 class="panel-title">Edit Advertisement</h4>
                    </div>
                    <div class="panel-body">
                        <form method="post" action="<?php echo base_url(); ?>advertisement/edit/<?php echo $advertisement_id;?>/<?php echo $page;?>" class="form-validate main parsley_reg" enctype="multipart/form-data" >
			    <input type="hidden" name="action" value="Process">
			    <div class="form_sep">
				
                                <label for="reg_input_name" class="req">Title</label>
				<input type="text" class="form-control required" name="advertisement_title" id="advertisement_title" value="<?php if(isset($advertisement_title)) { echo $advertisement_title; }?>" data-required="true">
                            </div>
                            <div class="form_sep">
				
                                <label for="reg_input_name" class="req">Link</label>
				<input type="text" class="form-control required" name="advertisement_link" id="advertisement_link" value="<?php if(isset($advertisement_link)) { echo $advertisement_link; }?>" data-required="true">
                            </div>
                            <div class="form_sep">
				
                                <label for="reg_input_name" class="req">Image</label>
				<?php if($advertisement_image!=''){ ?>
                                <img src="<?php echo FILE_UPLOAD_URL?>advertisement/thumbs/<?php echo $advertisement_image;?>" border="0">
				<?php } ?>
                                <br><br>
				<input type="file" class="" name="advertisement_image" id="advertisement_image" value="" data-required="true">
                            </div>
                            <div class="form_sep">
				<label for="reg_input_name" class="req">Status</label>
                                    <select name="advertisement_status" id="advertisement_status" class="form-control required">
                                    <option value="" class="sc_show option">--Select--</option>
				    <option value="Active" <?php echo ($advertisement_status =='Active') ? 'selected' : '' ;?> class="sc_show option">Active</option>
				    <option value="Inactive" <?php echo ($advertisement_status =='Inactive') ? 'selected' : '' ;?> class="sc_show option">Inactive</option>
                                    </select>
                            </div>
			    
			    
                            <div class="form_sep">
                                <button class="btn btn-default" type="submit">Update</button>
				<button class="btn btn-default" type="button" onclick="location.href='<?php echo $return_link; ?>'">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <!--End : Main content-->    
</div>