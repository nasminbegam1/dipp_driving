<div id="main_content">                    
    
    	<div class="row">
			<div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">Change Email</h4>
                    </div>
                    <div class="panel-body">
                        <form method="post" action="<?php echo base_url(); ?>welcome/do_changeemail" class="form-validate main parsley_reg" enctype="multipart/form-data" >
			    <input type="hidden" name="action" value="Process">
				
			    <div class="form_sep">
				<label for="reg_input_name" class="req">Current Email</label>
                                <strong><?php echo $email;?></strong>
                            </div>
                            <div class="form_sep">
				<label for="reg_input_name" class="req">Email</label>
				<input type="text" class="form-control required" name="email" id="email" value="">
                            </div>
			   <div class="form_sep">
                                <button class="btn btn-default" type="submit">Update</button>
				<button class="btn btn-default" type="button" onclick="location.href='<?php echo base_url(); ?>dashboard/'">Return</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <!--End : Main content-->    
</div>
