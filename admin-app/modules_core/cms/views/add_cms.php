 <!--BEGIN TITLE & BREADCRUMB PAGE-->
<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title">Add Cms</div>
    </div>
 <!--For breadcrump-->    
  <ol class="breadcrumb page-breadcrumb pull-right">
      <li><i class="fa fa-info-circle">&nbsp;&nbsp;</i><a href="<?php echo base_url()?>cms">Cms List</a></li>
      <li><i class="fa fa-info-circle">&nbsp;&nbsp;</i><a href="<?php echo base_url()?>cms/add">Add Cms</a></li>
  </ol>  
  <!--For breadcrump end-->
    <div class="clearfix"></div>
</div>
<!--END TITLE & BREADCRUMB PAGE-->
<!--BEGIN CONTENT-->
        <div class="page-content">
        <div id="form-layouts" class="row">
        <div class="col-lg-12">
         <div style="background: transparent; border: 0; box-shadow: none !important;" class="pan mtl mbn responsive">
                            <div id="tab-form-seperated" class="tab-pane">
                                <div class="row">
                                    <div class="col-lg-12">
                                        
                                       
                                        <?php if(validation_errors() != FALSE){?>
                                        <div align="center">
                                            <div class="nNote nFailure" style="width: 600px;color:red;">
                                                <?php echo validation_errors('<p>', '</p>'); ?>
                                            
                                            </div>
                                        </div>
                                        <?php } ?>
                                        
                                        <div class="panel panel-yellow portlet box portlet-yellow">
                                            <!--<div class="panel-heading">Admin User Form</div>-->
                                            <div class="portlet-header">
                                                    <div class="caption">Add Cms Form</div>
                                                    <div class="tools">
                                                        <i class="fa fa-chevron-up"></i>
                                                    </div>
                                            </div>
                                            <div class="portlet-body panel-body pan">
                                                
                                                <form method="post" action="<?php echo base_url(); ?>cms/add" class="form-validate form-horizontal form-seperated " enctype="multipart/form-data" id="add_form">
				                <div class="form-body">
                                                        <div class="form-group"><label for="inputCategoryname" class="col-md-3 control-label">Content Title<span class='require'>*</span></label>
                                                            <div class="col-md-9">
                                                                <input name="content_title" id="content_title" type="text" size="30" class="form-control required first_name" value="<?php echo set_value('content_title'); ?>">
                                                            </div>                                                            
                                                        </div>
                                                        
                                                        <div class="form-group"><label for="inputCategoryname" class="col-md-3 control-label">Content Reference<span class='require'>*</span></label>
                                                            <div class="col-md-9">
                                                                <input name="content_ref" id="content_ref" type="text" size="30" class="form-control required first_name" value="<?php echo set_value('content_ref'); ?>">
                                                            </div>                                                            
                                                        </div>
                                                        
                                                        <div class="form-group"><label for="inputCategoryname" class="col-md-3 control-label">Meta Title<span class='require'>*</span></label>
                                                            <div class="col-md-9">
                                                                <input name="meta_title" id="meta_title" type="text" size="30" class="form-control required first_name" value="<?php echo set_value('meta_title'); ?>">
                                                            </div>                                                            
                                                        </div>
                                                        
                                                        <div class="form-group"><label for="inputCategoryname" class="col-md-3 control-label">Meta Key<span class='require'>*</span></label>
                                                            <div class="col-md-9">
                                                                <input name="meta_key" id="meta_key" type="text" size="30" class="form-control required first_name" value="<?php echo set_value('meta_key'); ?>">
                                                            </div>                                                            
                                                        </div>
                                                        
                                                         <div class="form-group"><label for="inputCategoryname" class="col-md-3 control-label">Meta Description<span class='require'>*</span></label>
                                                            <div class="col-md-9">
                                                                <textarea name="meta_desc" id="meta_desc" rows="8" class="form-control required first_name"><?php echo set_value('content_title'); ?></textarea>
                                                            </div>                                                            
                                                        </div>
                                                        
                                                        <div class="form-group"><label for="inputCategoryname" class="col-md-3 control-label">Youtube Link<span class='require'>*</span></label>
                                                            <div class="col-md-9">
                                                                <input name="youtube_link" id="youtube_link" type="text" size="30" class="form-control required first_name" value="<?php echo set_value('youtube_link'); ?>">
                                                            </div>                                                            
                                                        </div>
                                                        
                                                        <div class="form-group"><label for="inputCategoryname" class="col-md-3 control-label">Content<span class='require'>*</span></label>
                                                            <div class="col-md-9">
                                                                <?=$this->fckeditor->Create('content', '');?>
                                                                <!--<textarea  name="content" class="ckeditor form-control"><?php //echo set_value('content');?></textarea>-->
                                                            </div>                                                            
                                                        </div>
                                                        
                                                        <!--<div class="form-group"><label for="inputcmscontent" class="col-md-3 control-label">CMS Content <span class='require'>*</span></label>

                                                            <div class="col-md-9">
                                                                
                                                                    <textarea  name="cms_content"   class="ckeditor form-control"><?php //echo set_value('cms_content');?></textarea>
                                    
                                                            </div>
                                                        </div>-->
                                                        
                                                       
                                                        
                                                        
                                                        
                                                        <div class="form-actions text-right pal">
                                                        <input type="hidden" name="action" value="Process">    
                                                        <button type="submit" class="btn btn-primary">Add Seller</button>
                                                        &nbsp;
                                                        <button type="button" class="btn btn-green" onclick="location.href='<?php echo base_url(); ?>cms/'">Return</button>
                                                        </div>
						</div>
				            </form>		
                                        </div>
                                    </div>
                                </div>
                            </div>
         </div>
        </div>
        </div>
        </div>
<!--END CONTENT-->
<!--BEGIN CONTENT QUICK SIDEBAR-->

<!--END CONTENT QUICK SIDEBAR-->