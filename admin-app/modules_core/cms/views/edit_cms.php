<? if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<div id="main_content">                    
    <!-- Start : main content loads from here -->    
    	<div class="row">
			<div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">Edit Cms</h4>
                    </div>
                    <div class="panel-body">
                        <form method="post" action="<?php echo base_url(); ?>cms/edit/<?php echo $cms_id;?>/<?php echo $page;?>" class="form-validate main parsley_reg" enctype="multipart/form-data" >
			    <input type="hidden" name="action" value="Process">
                             <div class="form_sep">
				<label for="reg_input_name" class="req">Title</label>
				<input type="text" class="form-control required" name="cms_title" id="cms_title" value="<?php echo $cms_title;?>" data-required="true">
                            </div>
                            <div class="form_sep">
				<label for="reg_input_name" class="req">Slug</label>
				<input type="text" class="form-control required" name="cms_slug" id="cms_title" value="<?php echo $cms_slug;?>" data-required="true">
                            </div>
                            <div class="form_sep">
				<label for="reg_input_name" class="req">Meta Title</label>
				<input type="text" class="form-control required" name="cms_meta_title" id="cms_meta_title" value="<?php echo $cms_meta_title;?>" data-required="true">
                            </div>
                            <div class="form_sep">
				<label for="reg_input_name" class="req">Meta Key</label>
				<input type="text" class="form-control required" name="cms_meta_key" id="cms_meta_key" value="<?php echo $cms_meta_key;?>" data-required="true">
                            </div>
                            <div class="form_sep">
				<label for="reg_input_name" class="req">Meta Description</label>
                                <textarea class="form-control required" name="cms_meta_desc" id="cms_meta_desc" rows="4" cols="40"><?php echo $cms_meta_desc;?></textarea>
                            </div>
                            <div class="form_sep">
				<label for="reg_input_name" class="req">Content</label>
				<?php echo $this->ckeditor->editor('cms_content',$cms_content);?>
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



















        
        

















        
        








