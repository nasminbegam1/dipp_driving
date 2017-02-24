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
                        <h4 class="panel-title">Edit Course</h4>
                    </div>
                    <div class="panel-body">
                        <form method="post" action="" class="main parsley_reg" enctype="multipart/form-data" >
			    <input type="hidden" name="action" value="Process">
                            <div class="form_sep">
				
                                <label for="reg_input_name" class="req">Course Name</label>
				<input type="text" class="form-control" name="name" id="name" value="<?php echo $name; ?>" data-required="true">
                            </div>
			    <div class="form_sep">
				
                                <label for="reg_input_name" class="req">Price</label>
				<input type="text" class="form-control" name="price" id="price" value="<?php echo $price; ?>" data-required="true" />
                            </div>
			    <div class="form_sep">
				
                                <label for="reg_input_name">Discount</label>
				<input type="text" class="form-control" name="discount" id="discount" value="<?php echo $discount; ?>">
                            </div>
			    <div class="form_sep">
                                <label for="reg_input_name" class="">Status</label>
				<select name="status">
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
<script src="<?php echo BACKEND_JS_PATH ;?>tinynav.js"></script>