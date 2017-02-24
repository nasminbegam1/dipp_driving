<div class="wrap">
<div class="allQusSec">
    <h2>Start here: </h2>
    <form method="post" name="pass_quarantee_first" enctype="multipart/form-data" id="pass_quarantee_first" >
    <input type="hidden" name="action" value="Process">
    <div class="qusListDiv">
        <h5>1) Select your Driving Theory Test Category</h5>

        <span class="note">(Note that all Driving Theory Tests are conducted by the DVSA not the DVLA)</span>
        
        <select name="testCategory">
            <option value="">Please select one...</option>
        <?php
        
        if(!empty($testCat)){
            foreach($testCat as $tCat){
        ?>
                <option value="<?php echo $tCat['id']; ?>" <?php if(!empty($details) && $details->test_category_id == $tCat['id'] ){echo 'selected';} ?>><?php echo stripslashes($tCat['name']); ?></option>
        <?php
            }
        }
        ?>
        </select>
    </div>
    <div class="qusListDiv">
        <h5>2) Which language would you like to see the questions in?</h5>

        <span class="note">(You will be able to choose an additional voiceover language such as Urdu in the next section)</span>
        <div class="radioFiledSet">
        <div class="radioFiled">
        <input type="radio" name="language" value="English" <?php if((!empty($details) && $details->language == 'English') || empty($details)){echo 'checked';} ?>>English
        </div>
        <div class="radioFiled">
        <input type="radio" name="language" value="Welsh" <?php if(!empty($details) && $details->language == 'Welsh' ){echo 'checked';} ?>>Welsh
        </div>
        </div>
        <span class="note">(these are the only two screen languages available) </span>
    </div>
    <div class="qusListDiv">
        <h5>3) Do you have any special requirements? </h5>
        <div class="radioFiledSet">
        <div class="radioFiled">
        <input type="radio" name="special_requirement" value="No" <?php if((!empty($details) && $details->special_requirement == 'No') || empty($details)){echo 'checked';} ?>>No
        </div>
        <div class="radioFiled">
        <input type="radio" name="special_requirement" value="Yes" <?php if(!empty($details) && $details->special_requirement == 'Yes' ){echo 'checked';} ?>>Yes
        </div>
        </div>
        <p>For example you may need to listen to the test questions through headphones in your own language or see the questions and answers in British Sign Language.</p>
    </div>
    
    <div class="qusListDiv">
        <h5>4) Please enter your Driving Instructors Business Code (as input when you log into the theory learning section): </h5>
        <input type="text" name="instructor_code" value="<?php if(!empty($details) && $details->instructor_code != ''){echo $details->instructor_code;} ?>" class="inst-cde">
        <input type="hidden" name="instructor_id" value="<?php if(!empty($details) && $details->instructor_id != ''){echo $details->instructor_id;} ?>">
        
        <label id="errorMsg" class="error"></label>
    </div>
    
    <div class="wrap"><button class="btn-login btn-nxt" type="submit">Next</button></div>
    </form>
</div>
 </div>