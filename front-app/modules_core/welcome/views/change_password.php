 <!--BEGIN TITLE & BREADCRUMB PAGE-->
<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title">Change Password</div>
    </div>
 <!--For breadcrump-->    
  <ol class="breadcrumb page-breadcrumb pull-right">
      <li><i class="fa fa-info-circle">&nbsp;&nbsp;</i><a href="<?php echo base_url()?>dashboard">Administrator</a></li>
      <li><i class="fa fa-info-circle">&nbsp;&nbsp;</i><a href="<?php echo base_url()?>welcome/changepassword">Change Password</a></li>
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
                                                    <div class="caption">Change Password Form</div>
                                                    <div class="tools">
                                                        <i class="fa fa-chevron-up"></i>
                                                    </div>
                                            </div>
                                            <div class="portlet-body panel-body pan">
                                                
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
                                                        
                                                        <div class="form-group"><label for="inputCategoryname" class="col-md-3 control-label">Confirm New Password<span class='require'>*</span></label>
                                                            <div class="col-md-4">
                                                                <input name="re_new_pass" id="re_new_pass" type="password" size="30" class="form-control required">
                                                            </div>                                                        
                                                        </div>
                                                        
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
         </div>
        </div>
        </div>
        </div>
<!--END CONTENT-->
<!--BEGIN CONTENT QUICK SIDEBAR-->

<!--END CONTENT QUICK SIDEBAR-->























<!--<table align="center" border="0" cellpadding="0" cellspacing="0" width="90%" class="maintable">
                <tbody>
                <tr>
                    <td class="list-top-text" height="30"><strong>Administrator &gt;&gt; Change Password</strong></td>
                </tr>
                <tr>
                    <td>
                        <form name="frm_pass" id="frm_pass" action="<?php echo base_url(); ?>welcome/do_changepassword/" method="post" onSubmit="return $('#frm_pass').validationEngine({returnIsValid:true})">
                        <table class="tblborder" align="center" cellpadding="5" cellspacing="1" width="100%">
                            <tbody>
                            <tr>
                                <td colspan="2" class="top-header">Change Password</td>
                            </tr>
                            <tr>
                                <td width="20%" align="left"><strong>Old Password</strong></td>
                                <td width="80%"><input name="old_pass" id="old_pass" type="password" size="30" class="validate[required] text-feild3"></td>
                            </tr>
                            <tr bgcolor="#EEEEEE">
                                <td align="left"><strong>New Password</strong></td>
                                <td><input name="new_pass" id="new_pass" type="password" size="30" class="validate[required] text-feild3"></td>
                            </tr>
                            <tr>
                                <td width="20%" align="left"><strong>Confirm New Password</strong></td>
                                <td width="80%"><input name="re_new_pass" id="re_new_pass" type="password" size="30" class="validate[required,equals[new_pass]] text-feild3"></td>
                            </tr>

                            <tr bgcolor="#EEEEEE">
                                <td>&nbsp;</td>
                                <td align="left">
                                 <input type="submit" value="Submit" class="button-css">
                                 <input name="button2" id="button2" value="Cancel" type="button" class="button-css" onclick="javascript:window.location='<?php echo base_url(); ?>dashboard/';">
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        </form>
                    </td>
                </tr>
                <tr>
                    <td height="30">&nbsp;</td>
                </tr>
                </tbody></table>
-->


