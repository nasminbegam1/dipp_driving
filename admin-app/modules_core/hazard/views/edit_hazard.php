<div id="main_content">                    
    <!-- Start : main content loads from here -->    
    	<?php if(validation_errors() != FALSE){?>
            <div align="center">
                <div class="nNote nFailure">
                    <?php echo validation_errors('<p>', '</p>'); ?>
                </div>
            </div>
		<?php } ?>
    	<div class="row">
	   <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">Edit Hazard</h4>
                    </div>
                    <div class="panel-body">
                    <div class="row">
                    <div class="col-sm-12">
                    
                    <form method="post" action="<?php echo base_url(); ?>hazard/edit/<?php echo $hazard_id;?>/<?php echo $page;?>" class="form-validate main parsley_reg" enctype="multipart/form-data" >    
                    <div class="tab-content">
                            <div class="tab-pane active" id="tbb_a">
                            <div class="form_sep">
                                <label for="reg_input_name" class="req">Course Name</label>
                                <?php if(count($course_list) > 0) { ?>
                                <select name="course_id" class="form-control" data-required="true">
                                    <?php for($i=0;$i<count($course_list);$i++) { ?>
                                    <option value="<?php echo $course_list[$i]['id'];?>" <?php if($course_list[$i]['id'] == $course_id) { ?>selected<?php } ?>><?php echo $course_list[$i]['name'];?></option>
                                    <?php } ?>
                                </select>
                                <?php } ?>
                            </div>

                            <div class="form_sep">
                                <label for="reg_input_name" class="req">Hazard Title</label>
                                <input type="text" class="form-control" name="hazard_title" id="hazard_title" value="<?php echo $hazard_title; ?>" data-required="true">
                            </div>
			    
			    <div class="form_sep">
				<label for="reg_input_name" class="req">Hazard Content</label>
				<?php echo $this->ckeditor->editor('hazard_content',$hazard_content);?>
                            </div>
			    
                            <div class="form_sep">
                                <label for="reg_input_name" class="">Hazard Status</label>
                                <select name="status" class="form-control">
                                    <option value="Active" <?php echo ($hazard_status == 'Active') ? 'selected' : '' ;?>>Active</option>
                                    <option value="Inactive" <?php echo ($hazard_status == 'Inactive') ? 'selected' : '' ;?>>Inactive</option>
                                </select>
                            </div>
                            </div>
                            
                     </div>
                        <input type="hidden" name="action" value="Process">
                        <div class="form_sep">
                               <button class="btn btn-default" type="submit">Update</button>
                               <button class="btn btn-default" type="button" onclick="location.href='<?php echo $return_link; ?>'">Return</button>
                         </div>   
                     </form>   
                    </div>
                  </div>
                        
                    </div>
                </div>
            </div>
        </div>
    <!--End : Main content-->    
</div>
<script src="<?php echo BACKEND_JS_PATH ;?>tinynav.js"></script>