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
                        <h4 class="panel-title">Edit Banner</h4>
                    </div>
                    <div class="panel-body">
                        <form method="post" action="<?php echo base_url(); ?>banner/edit/<?php echo $banner_id;?>/<?php echo $page;?>" class="form-validate main parsley_reg" enctype="multipart/form-data" >
			    <input type="hidden" name="action" value="Process">
			    <div class="form_sep">
				
                                <label for="reg_input_name" class="req">Title</label>
				<input type="text" class="form-control required" name="banner_title" id="banner_title" value="<?php if(isset($banner_title)) { echo $banner_title; }?>" data-required="true">
                            </div>
                            <div class="form_sep">
				
                                <label for="reg_input_name" class="req">Image</label>
				<?php if($banner_image!=''){ ?>
                                <img src="<?php echo FILE_UPLOAD_URL?>banner/thumbs/<?php echo $banner_image;?>" border="0">
				<?php } ?>
                                <br><br>
				<input type="file" class="" name="banner_image" id="banner_image" value="" data-required="true">
				<b>[Banner size should be 1600 X 500]</b>
                            </div>
                            <div class="form_sep">
				<label for="reg_input_name" class="req">Status</label>
                                    <select name="banner_status" id="banner_status" class="form-control required">
                                    <option value="" class="sc_show option">--Select--</option>
				    <option value="Active" <?php echo ($banner_status =='Active') ? 'selected' : '' ;?> class="sc_show option">Active</option>
				    <option value="Inactive" <?php echo ($banner_status =='Inactive') ? 'selected' : '' ;?> class="sc_show option">Inactive</option>
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