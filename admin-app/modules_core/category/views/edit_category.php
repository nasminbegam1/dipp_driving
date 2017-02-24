 <!--BEGIN TITLE & BREADCRUMB PAGE-->
<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title">Edit Category</div>
    </div>
 <!--For breadcrump-->    
  <ol class="breadcrumb page-breadcrumb pull-right">
      <li><i class="fa fa-info-circle">&nbsp;&nbsp;</i><a href="<?php echo base_url()?>category">Category List</a></li>
      <li><i class="fa fa-info-circle">&nbsp;&nbsp;</i><a href="<?php echo base_url(); ?>category/edit/<?php echo $cat_id;?>/<?php echo $page;?>">Edit Category</a></li>
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
                                                    <div class="caption">Edit Category Form</div>
                                                    <div class="tools">
                                                        <i class="fa fa-chevron-up"></i>
                                                    </div>
                                            </div>
                                            <div class="portlet-body panel-body pan">
                                                
                                                <form method="post" action="<?php echo base_url(); ?>category/edit/<?php echo $cat_id;?>/<?php echo $page;?>" class="form-validate form-horizontal form-seperated " enctype="multipart/form-data" id="add_form">
													<input type="hidden" name="action" value="Process">
                                                    <div class="form-body">
                                                        <div class="form-group"><label for="inputCategoryname" class="col-md-3 control-label">Category<span class='require'>*</span></label>

                                                            <div class="col-md-4">
                                                                <input name="cat_name" type="text" placeholder="Category" class="form-control required cat_name" minlength="3" id="cat_name" value="<?php echo $cat_name;?>"/>
                                                            </div>
                                                            <div id="status"></div>
                                                            
                                                        </div>
                                                        <div class="form-actions text-right pal">
                                                        <button type="submit" class="btn btn-primary">Edit Category</button>
                                                        &nbsp;
                                                        <button type="button" class="btn btn-green" onclick="location.href='<?php echo base_url(); ?>category/'">Return</button>
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
