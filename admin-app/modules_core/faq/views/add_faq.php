<div id="main_content">                    
    <!-- Start : main content loads from here -->    
    	<div class="row">
			<div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">Add FAQ</h4>
                    </div>
                    <div class="panel-body">
                        <form method="post" action="<?php echo base_url(); ?>faq/add" class="form-validate main parsley_reg" enctype="multipart/form-data" >
			    <input type="hidden" name="action" value="Process">
		            <div class="form_sep">
				<label for="reg_input_name" class="req">Type</label>
				<select name= type value="">
				 <option value="">..select..</option>
				 <option value="student">Student</option>
				 <option value="instructor">Instructor</option>
				</select>
                            </div>

                            <div class="form_sep">
				<label for="reg_input_name" class="req">Question</label>
				<input type="text" class="form-control required" name="question" id="question" value="" data-required="true">
                            </div>
			    <div class="form_sep">
				<label for="reg_input_name" class="req">Answer</label>
				<textarea data-required="true" id="answer" class="form-control required" name="answer" data-required="true"></textarea>
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