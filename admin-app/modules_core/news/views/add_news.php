 <div id="main_content">                    
    <!-- Start : main content loads from here -->    
    	<div class="row">
			<div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">Add News</h4>
                    </div>
                    <div class="panel-body">
                        <form method="post" action="<?php echo base_url(); ?>news/add" class="form-validate main parsley_reg" enctype="multipart/form-data" >
			    <input type="hidden" name="action" value="Process">
                            <div class="form_sep">
				<label for="reg_input_name" class="req">News Title</label>
				<input type="text" class="form-control required" name="title" id="title" value="" data-required="true">
                            </div>
                            <div class="form_sep">
				
                                <label for="reg_input_name" class="req">Image</label>
				<input type="file" class="required" name="news_image" id="news_image" value="" data-required="true">
                            </div>
                             <div class="form_sep">
				<label for="reg_input_name" class="req">Description</label>
				<?=$this->ckeditor->editor('description', '');?>
				
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