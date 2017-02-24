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
                        <h4 class="panel-title">Edit Testimonial</h4>
                    </div>
                    <div class="panel-body">
                        <form method="post" action="<?php echo base_url(); ?>testimonial/edit/<?php echo $testimonial_id;?>/<?php echo $page;?>" class="form-validate main parsley_reg" enctype="multipart/form-data" >
			    <input type="hidden" name="action" value="Process">
			    <div class="form_sep">
				
                                <label for="reg_input_name" class="req">Name</label>
				<input type="text" class="form-control required" name="name" id="name" value="<?php if(isset($name)) { echo $name; }?>" data-required="true">
                            </div>
                            <div class="form_sep">
                                <label for="reg_input_name">Location</label>
				<input type="text" class="form-control" name="company_name" id="company_name" value="<?php if(isset($company_name)) { echo $company_name; }?>">
                            </div>
                            <div class="form_sep">
				
                                <label for="reg_input_name" class="req">Description</label>
				<input type="text" class="form-control required" name="description" id="description" value="<?php if(isset($description)) { echo $description; }?>" data-required="true">
                            </div>
			    
			    <div class="form_sep">
				
                                <label for="reg_input_name" class="req">Image</label>
				<?php if($image !=''){ ?>
                                <img src="<?php echo FILE_UPLOAD_URL?>testimonial/thumbs/<?php echo $image;?>" border="0">
				<?php } ?>
                                <br><br>
				<input type="file" class="" name="image" id="image" value="" data-required="true">
                            </div>

                            <div class="form_sep">
				<label for="reg_input_name" class="req">Status</label>
                                    <select name="status" id="status" class="form-control required">
                                    <option value="" class="sc_show option">--Select--</option>
				    <option value="Active" <?php echo ($status =='Active') ? 'selected' : '' ;?> class="sc_show option">Active</option>
				    <option value="Inactive" <?php echo ($status =='Inactive') ? 'selected' : '' ;?> class="sc_show option">Inactive</option>
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