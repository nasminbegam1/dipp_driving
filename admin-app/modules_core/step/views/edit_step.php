<script>
$(document).ready(function(){    
/***** For Add More section ******/ 
var wrapper         = $("#content-2"); //Fields wrapper
var add_button      = $(".add_field_button"); //Add button ID

var x = $('.attr_val').length; //initlal text box count
$(add_button).click(function(e){ //on add input button click
e.preventDefault();
x++; //text box increment
$(wrapper).append('<div id="content_inner" style="padding-top:20px;"><div class="form_sep"><label for="reg_video_title" class="req">Video Title</label><input type="text" class="form-control attr_val" name="video_title['+x+']" id="video_title" value="" data-required="true"></div><div class="form_sep"><label for="reg_video_link" class="req">Youtube Link</label><input type="text" class="form-control" name="video_link['+x+']" id="video_link" value="" data-required="true"></div><div style="float:right;"><a href="" class="remove_field">Remove</a></div></div>');
});

$(wrapper).on("click",".remove_field", function(e){ //user click on remove text 
e.preventDefault(); 
//$(this).closest('div.form_sep').remove();
$(this).parent().parent().remove(); // x--;
})
})
</script>

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
                        <h4 class="panel-title">Edit Step</h4>
                    </div>
                    <div class="panel-body">
                    <div class="row">
                    <div class="col-sm-12">
                    <ul class="nav nav-tabs">
                            <li class="active"><a href="#tbb_a" data-toggle="tab"><?php echo $name; ?></a></li>
                            <li><a href="#tbb_b" data-toggle="tab">Edit Video Link</a></li>
                            
                    </ul>
                    <form method="post" action="<?php echo base_url(); ?>step/edit/<?php echo $id;?>/<?php echo $page;?>" class="form-validate main parsley_reg" enctype="multipart/form-data" >    
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
                                <label for="reg_input_name" class="req">Step Name</label>
                                <input type="text" class="form-control" name="name" id="name" value="<?php echo $name; ?>" data-required="true">
                            </div>
                            <div class="form_sep">
                                <label for="reg_input_name" class="">Status</label>
                                <select name="status" class="form-control">
                                    <option value="Active" <?php echo ($status == 'Active') ? 'selected' : '' ;?>>Active</option>
                                    <option value="Inactive" <?php echo ($status == 'Inactive') ? 'selected' : '' ;?>>Inactive</option>
                                </select>
                            </div>
                            </div>
                            <div class="tab-pane" id="tbb_b">
                                <div id="content-2">
                                    <div style="float:right;"><a class="add_field_button" href="">Add More Fields</a></div>
                                    <?php
                                    $i=1;
                                    foreach($video_all as $video) {
                                    ?>
                                    <div id="content_inner" style="padding-top:30px;">
                                        <div class="form_sep">
                                        <label for="reg_video_title" class="req">Video Title</label>
                                        <input type="text" class="form-control attr_val required" name="video_title[<?php echo $i;?>]" id="video_title" value="<?php echo $video['video_title']; ?>" data-required="true">
                                        </div>
                                        <div class="form_sep">
                                        <label for="reg_video_link" class="req">Youtube Link</label>
                                        <input type="text" class="form-control required" name="video_link[<?php echo $i;?>]" id="video_link" value="<?php echo $video['video_link']; ?>" data-required="true">
                                        </div>
                                        <div style="float:right;"><a href="" class="remove_field">Remove</a></div>
                                    </div>
                                    <?php $i++; } ?>
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