<? if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<div id="main_content">                    
    <!-- Start : main content loads from here -->
    
    <?php //if(validation_errors() != FALSE){?>
    <!--<div align="center">
	<div class="nNote nFailure" style="width: 600px;">
	    <?php echo validation_errors('<p>', '</p>'); ?>
	</div>
    </div>-->
    <?php //} ?>
        
    	<div class="row">
			<div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">Add Badge</h4>
                    </div>
                    <div class="panel-body">
			<?php
			    $message = $this->session->flashdata('message');
			    if(isset($message['content']) && $message['content'] != ''){
			?>
			    <div align="center">
				    <div class="nNote nFailure" style="width: 600px;">
				    <?php echo $message['content']; ?>
				    </div>
			    </div>
			<?php
			    }
			?>
                        <form method="post" action="<?php echo base_url(); ?>badge/add" class="form-validate main parsley_reg" enctype="multipart/form-data" >
			    <input type="hidden" name="action" value="Process">
			    
                            <div class="form_sep">
                                <label for="reg_input_name" class="req">Bagde Name</label>
				<input type="text" class="form-control required" name="badge_name" id="badge_name" value="" data-required="true">
                            </div>
			    
			    <div class="form_sep">
				
                                <label for="reg_input_name" class="req">Bagde Type</label>
				<select name="badge_type" id="badge_type" class="form-control required">
                                    <option value="" class="sc_show option">--Select--</option>
				   <option value="Proud">Proud</option>
				   <option value="Silver">Silver</option>
				   <option value="Gold">Gold</option>
				   <option value="Platinum">Platinum</option>

                                </select>
                            </div>
                            <div class="form_sep">
				
                                <label for="reg_input_name" class="req">Image</label>
				<input type="file" class="required" name="badge_image" id="badge_image" value="" onchange="ValidateSingleInput(this);" data-required="true">
                            </div>
			    <div class="form_sep">
				
                                <label for="reg_input_name" class="req">Status</label>
				<select name="badge_status" id="badge_status" class="form-control required">
                                    <option value="" class="sc_show option">--Select--</option>
				   <option value="Active">Active</option>
				   <option value="Inactive">Inactive</option>

                                </select>
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

<script>
var _validFileExtensions = [".jpg", ".jpeg", ".png"];

function ValidateSingleInput(oInput) {
    if (oInput.type == "file") {
	var sFileName = oInput.value;
	 if (sFileName.length > 0) {
	    var blnValid = false;
	    for (var j = 0; j < _validFileExtensions.length; j++) {
		var sCurExtension = _validFileExtensions[j];
		if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
		    blnValid = true;
		    break;
		}
	    }
	     
	    if (!blnValid) {
		alert("Sorry, " + sFileName + " is invalid, allowed extensions are: " + _validFileExtensions.join(", "));
		oInput.value = "";
		return false;
	    }
	}
    }
    return true;
}
	
		
</script>
