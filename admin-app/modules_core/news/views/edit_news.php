<? if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<div id="main_content">                    
    <!-- Start : main content loads from here -->    
    	<div class="row">
			<div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">Edit News</h4>
                    </div>
                    <div class="panel-body">
                        <form method="post" action="<?php echo base_url(); ?>news/edit/<?php echo $id;?>/<?php echo $page;?>" class="form-validate main parsley_reg" enctype="multipart/form-data" >
			    <input type="hidden" name="action" value="Process">
                             <div class="form_sep">
				<label for="reg_input_name" class="req">News Title</label>
				<input type="text" class="form-control required" name="title" id="title" value="<?php echo $title;?>" data-required="true">
                            </div>
                            <div class="form_sep">
				<label for="reg_input_name" class="req">Image</label>
                                <img src="<?php echo FILE_UPLOAD_URL?>news/thumbs/<?php echo $image;?>" border="0">
                                <br><br>
				<input type="file" class="" name="news_image" id="news_image" value="" data-required="true">
                            </div>
                            <div class="form_sep">
				<label for="reg_input_name" class="req">News Description</label>
				<?php echo $this->ckeditor->editor('description',$description);?>
                            </div>
			    <div class="form_sep">
				<label for="reg_input_name" class="req">Status</label>
				<select name="status" class="form-control">
						<option value="Active" <?php echo ($status == 'Active')?'selected':''; ?>>Active</option>
						<option value="Inactive" <?php echo ($status == 'Inactive')?'selected':''; ?>>Inactive</option>
				</select>
                            </div>
                            <div class="form_sep">
                                <input type="hidden" name="image_name" value="<?php echo $image;?>">
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



















        
        

















        
        








