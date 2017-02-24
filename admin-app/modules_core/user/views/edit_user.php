<? if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<div id="main_content">                    
    <!-- Start : main content loads from here -->    
    	<div class="row">
			<div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">Edit User</h4>
                    </div>
                    <div class="panel-body">
                        <form method="post" action="<?php echo base_url(); ?>user/edit/<?php echo $user_id;?>/<?php echo $page;?>" class="form-validate main parsley_reg" enctype="multipart/form-data" >
			    <input type="hidden" name="action" value="Process">
                            <div class="form_sep">
				<label for="reg_input_name" class="req">Fname</label>
				<input type="text" class="form-control required" name="user_fname" id="user_fname" value="<?php echo stripslashes(trim($user_fname));?>" data-required="true">
                            </div>
                             <div class="form_sep">
				<label for="reg_input_name" class="req">Lname</label>
				<input type="text" class="form-control required" name="user_lname" id="user_lname" value="<?php echo stripslashes(trim($user_fname));?>" data-required="true">
                            </div>
                            <div class="form_sep">
				<label for="reg_input_name" class="req">Email</label>
				<input type="text" class="form-control required" name="user_email" id="user_email" value="<?php echo stripslashes(trim($user_email));?>" data-required="true">
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