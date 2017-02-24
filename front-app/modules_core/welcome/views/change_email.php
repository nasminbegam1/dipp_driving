 <!--BEGIN TITLE & BREADCRUMB PAGE-->
<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title">Change Email</div>
    </div>
 <!--For breadcrump-->    
  <ol class="breadcrumb page-breadcrumb pull-right">
      <li><i class="fa fa-info-circle">&nbsp;&nbsp;</i><a href="<?php echo base_url()?>dashboard">Administrator</a></li>
      <li><i class="fa fa-info-circle">&nbsp;&nbsp;</i><a href="<?php echo base_url()?>welcome/changeemail">Change Email</a></li>
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
                                                    <div class="caption">Change Email Form</div>
                                                    <div class="tools">
                                                        <i class="fa fa-chevron-up"></i>
                                                    </div>
                                            </div>
                                            <div class="portlet-body panel-body pan">
                                                
                                               <form method="post" action="<?php echo base_url(); ?>welcome/do_changeemail" class="form-validate form-horizontal form-seperated " enctype="multipart/form-data" id="add_form">
                                               
														<input type="hidden" name="action" value="Process">
									                      <div class="form-body">
                                                        <div class="form-group"><label for="inputEmailname" class="col-md-3 control-label">Current Email</label>
                                                            <div class="col-md-4">
                                                                 <?php echo $email; ?>
                                                            </div>                                                        
                                                        </div>
                                                        
                                                        <div class="form-group"><label for="inputEmailname" class="col-md-3 control-label">Email<span class='require'>*</span></label>
                                                            <div class="col-md-4">
                                                                <input name="email" id="email" type="email" size="30" class="form-control required">
                                                            </div>                                                        
                                                        </div>
                                                        
                                                        
                                                        <div class="form-actions text-right pal">
                                                        <input type="hidden" name="action" value="Process">    
                                                        <button type="submit" class="btn btn-primary">Change Email</button>
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
                    <td class="list-top-text" height="30"><strong>Administrator &gt;&gt; Change Email</strong></td>
                </tr>
                <tr>
                    <td>
                        <form name="frm_email" id="frm_email" action="<?php echo base_url(); ?>welcome/do_changeemail/" method="post">
                        <table class="tblborder" align="center" cellpadding="5" cellspacing="1" width="100%">
                            <tbody>
                            <tr>
                                <td colspan="2" class="top-header">Change Email</td>
                            </tr>
                            <tr>
                                <td width="20%" align="left"><strong>Current Email</strong></td>
                                <td width="80%"><? //=$email;?></td>
                            </tr>
                            <tr bgcolor="#EEEEEE">
                                <td align="left"><strong>Email</strong></td>
                                <td><input name="email" id="email" type="email" size="30" class="validate[required,custom[email]] text-feild3"></td>
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


