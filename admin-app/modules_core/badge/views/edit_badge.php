<? if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<div id="main_content">                    
    <!-- Start : main content loads from here -->    
    	<div class="row">
			<div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">Edit Badge</h4>
                    </div>
                    <div class="panel-body">
                        <form method="post" action="<?php echo base_url(); ?>badge/edit/<?php echo $badge_id;?>/<?php echo $page;?>" class="form-validate main parsley_reg" enctype="multipart/form-data" >
			    <input type="hidden" name="action" value="Process">
                            <div class="form_sep">
				
                                <label for="reg_input_name" class="req">Bagde Name</label>
				<input type="text" class="form-control required" name="badge_name" id="badge_name" value="<?php echo $badge_data[0]['badge_name']; ?>" data-required="true">
                            </div>
			    
			    			    
			    <div class="form_sep">
				
                                <label for="reg_input_name" class="req">Bagde Type</label>
				<select name="badge_type" id="badge_type" class="form-control required">
                                  
				   <option value="" class="sc_show option">--Select--</option>
				   <option value="Proud" <?php echo ($badge_data[0]['badge_type'] == 'Proud')?'selected':'';?>>Proud</option>
				   <option value="Silver" <?php echo ($badge_data[0]['badge_type'] == 'Silver')?'selected':'';?>>Silver</option>
				   <option value="Gold" <?php echo ($badge_data[0]['badge_type'] == 'Gold')?'selected':'';?>>Gold</option>
				   <option value="Platinum" <?php echo ($badge_data[0]['badge_type'] == 'Platinum')?'selected':'';?>>Platinum</option>
                                </select>
                            </div>
                            <div class="form_sep">
				
                                <label for="reg_input_name">Image</label>
				<input type="file" name="badge_image" id="badge_image" value="" onchange="ValidateSingleInput(this);">
				<br>
				<img src="<?php echo FILE_UPLOAD_URL.'badge_image/'.$badge_data[0]['badge_image'];?>" height="100" width="100">
                            </div>
			    <div class="form_sep">
				<label for="reg_input_name" class="req">Badge Status</label>
                                    <select name="badge_status" id="badge_status" class="form-control required">
                                    <option value="" class="sc_show option">--Select--</option>
				    <option value="Active" class="sc_show option" <?php echo ($badge_data[0]['badge_status'] == 'Active')?'selected':'';?>>Active</option>
				    <option value="Inactive" class="sc_show option" <?php echo ($badge_data[0]['badge_status'] == 'Inactive')?'selected':'';?>>Inactive</option>
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