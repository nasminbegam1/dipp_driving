<div id="main_content">                    
    <!-- Start : main content loads from here -->    
    	<div class="row">
	    <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">View FAQ</h4>
                    </div>
                    <div class="panel-body">
                            <div class="form_sep">
                                <label for="reg_input_name"><b>Question</b></label>
				<?php echo stripslashes($details[0]['question']);?>
                            </div>
                            <div class="form_sep">
				<label for="reg_input_name"><b>Answer</b></label>
                                    <?php echo stripslashes($details[0]['answer']);?>
                            </div>
			                                <div class="form_sep">
				<label for="reg_input_name"><b>Type</b></label>
                                    <?php echo stripslashes($details[0]['type']);?>
                            </div>

			    <div class="form_sep">
				<button class="btn btn-default" type="button" onclick="location.href='<?php echo $return_link; ?>'">Cancel</button>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    <!--End : Main content-->    
</div>