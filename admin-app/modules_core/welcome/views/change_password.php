<div id="main_content">                    
    
    	<div class="row">
			<div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">Change Password</h4>
                    </div>
                                            
                                            <div class="panel-body">
                                                
                                               <form method="post" action="<?php echo base_url(); ?>welcome/do_changepassword" class="form-validate form-horizontal form-seperated " enctype="multipart/form-data" id="add_form">
													<input type="hidden" name="action" value="Process">
                                                    <div class="form-body">
                                                        <div class="form-group"><label for="inputCategoryname" class="col-md-3 control-label">Old Password<span class='require'>*</span></label>
                                                            <div class="col-md-4">
                                                                <input name="old_pass" id="old_pass" type="password" size="30" class="form-control required">
                                                            </div>                                                        
                                                        </div>
                                                        
                                                        <div class="form-group"><label for="inputCategoryname" class="col-md-3 control-label">New Password<span class='require'>*</span></label>
                                                            <div class="col-md-4">
                                                                <input name="new_pass" id="new_pass" type="password" size="30" class="form-control required">
                                                            </div>                                                        
                                                        </div>
                                                        
                                                        <!--<div class="form-group"><label for="inputCategoryname" class="col-md-3 control-label">Confirm New Password<span class='require'>*</span></label>
                                                            <div class="col-md-4">
                                                                <input name="re_new_pass" id="re_new_pass" type="password" size="30" class="form-control required">
                                                            </div>                                                        
                                                        </div>-->
                                                        
                                                        <div class="form-actions text-right pal">
                                                        <input type="hidden" name="action" value="Process">    
                                                        <button type="submit" class="btn btn-primary">Change Password</button>
                                                        &nbsp;
                                                        <button type="button" class="btn btn-green" onclick="location.href='<?php echo base_url(); ?>dashboard/'">Return</button>                                                     
                                                    </form>
                                              </div>                                              
                                            </div>
                                        </div>
					    </div>
            </div>
        </div>
    <!--End : Main content-->    
</div>