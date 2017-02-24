<div class="wrap">
<div class="allQusSec">
    <form method="post" name="user_info" enctype="multipart/form-data" id="user_info" >
    <input type="hidden" name="action" value="Process">
    <p>Do NOT use your browser back and forward buttons - use the Next and Previous buttons on the forms </p>
    <div class="qusListDiv">
        
        <h5>7) Please enter your Great Britain Driving Licence Number below </h5><br>
        <div class="inpuFiled">
            <label>Licence number (16 characters):</label>
            <input type="text" name="licence_number" maxlength="16" value="<?php echo ((!empty($details) && $details->licence_number != '')? $details->licence_number : '') ?>">
        </div>
        
        <p>An example of where to find your Great Britain driving licence number can be found below:</p>
        <img src="<?php echo base_url().'images/english_dsa-licence.jpg'; ?>">
    </div>
    <div class="qusListDiv">
        <h5>8) Candidate Details  <span>(The person taking the test)</span></h5>
        <p>These details are only passed to the DVSA and are not used for any other purpose</p>
        <div class="inpuFiled">
        <label>Title:</label>
            <select name="title">
                    <option value="">...</option>
                    <option value="Mr" <?php echo (!empty($details) && 'Mr' == $details->title)?'selected':''; ?> >Mr</option>
                    <option value="Mrs" <?php echo (!empty($details) && $details->title == 'Mrs')?'selected':''; ?>>Mrs</option>
                    <option value="Miss" <?php echo (!empty($details) && 'Miss' == $details->title)?'selected':''; ?>>Miss</option>
                    <option value="Ms" <?php echo (!empty($details) && 'Ms' == $details->title)?'selected':''; ?>>Ms</option>
                    <option value="Dr" <?php echo (!empty($details) && 'Dr' == $details->title)?'selected':''; ?>>Dr</option>
            </select>
        </div>
        <div class="inpuFiled">
        <label>First name:</label>
        <input type="text" name="first_name" placeholder="e.g. John" value="<?php echo ((!empty($details) && $details->first_name != '')? $details->first_name : '') ?>">
        </div>
        <div class="inpuFiled">
        <span class="note">If you have a middle name or names, you MUST enter ALL of them below </span>
        <label>Middle names:</label>
        <input type="text" name="middle_name" placeholder="e.g. Andrew Simon" value="<?php echo ((!empty($details) && $details->middle_name != '')? $details->middle_name : '') ?>">
        </div>
        <div class="inpuFiled">
        <label>Last name:</label>
        <input type="text" name="last_name" placeholder="e.g. Smith" value="<?php echo ((!empty($details) && $details->last_name != '')? $details->last_name : '') ?>">
        </div>
        <div class="inpuFiled">
        <label>Address:</label>
        
        <input type="text" name="address1" value="<?php echo ((!empty($details) && $details->address1 != '')? $details->address1 : '') ?>">
        <input type="text" name="address2" value="<?php echo ((!empty($details) && $details->address2 != '')? $details->address2 : '') ?>">
        
        </div>
        <div class="inpuFiled">
        <label>Town: </label>
        <input type="text" name="town" value="<?php echo ((!empty($details) && $details->town != '')? $details->town : '') ?>">
        </div>
        <div class="inpuFiled">
        <label>Post Code: </label>
        <input type="text" name="post_code" value="<?php echo ((!empty($details) && $details->post_code != '')? $details->post_code : '') ?>">
        </div>
        <div class="inpuFiled">
        <span class="note"> (We will only call you if there is a problem with your booking)</span>
        <label> Telephone: </label>
        <input type="text" name="telephone_no" value="<?php echo ((!empty($details) && $details->telephone_no != '')? $details->telephone_no : '') ?>">
        </div>
        <div class="inpuFiled">
        <span class="note"> We will send details of your test to the email address you specify below.<br>
        (Your email address will not be passed elsewhere)</span>
        <label>Email: </label>
        <input type="text" name="email" value="<?php echo ((!empty($details) && $details->email != '')? $details->email : '') ?>">
        </div>
    </div>
    <div class="nextPrevBtns"><a class="backBtn" href="<?php echo base_url().'pass_guarantee/third';?>">Previous</a><button class="btn-login" type="submit">Next</button></div>
    </form>
    </div>
 </div>