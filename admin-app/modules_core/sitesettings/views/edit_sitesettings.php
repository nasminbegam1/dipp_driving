<? if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<div id="main_content">                    
    <!-- Start : main content loads from here -->    
    	<?php if(isset($succmsg) && $succmsg != ""){?>
            <div align="center">
                <div class="nNote nSuccess" style="width: 600px;">
                    <p><?php echo stripslashes($succmsg);?></p>
                </div>
            </div>
		<?php } ?>
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
                        <h4 class="panel-title">Edit Sitesettings</h4>
                    </div>
                    <div class="panel-body">
                        <form method="post" action="" class="form-validate main parsley_reg" enctype="multipart/form-data" >
			    <input type="hidden" name="action" value="Process">
				
			    <div class="form_sep">
				<label for="reg_input_name" class="req"><?php echo $sitesettings_lebel;?></label>
				<input type="text" class="form-control required" name="sitesettings_value" id="sitesettings_value" value="<?php echo $sitesettings_value; ?>" data-required="true">
                            </div>
			    <div class="form_sep">
                                <label for="reg_input_name" class="">Status</label>
				<select name="status" class="form-control">
				    <option value="Active" <?php echo ($status == 'Active') ? 'selected' : '' ;?>>Active</option>
				    <option value="Inactive" <?php echo ($status == 'Inactive') ? 'selected' : '' ;?>>Inactive</option>
				</select>
                            </div>
			    
                            <div class="form_sep">
                                <button class="btn btn-default" type="submit">Update</button>
				<button class="btn btn-default" type="button" onclick="location.href='<?php echo $return_link; ?>'">Return</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <!--End : Main content-->    
</div>