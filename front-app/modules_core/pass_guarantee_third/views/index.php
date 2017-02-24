<div class="wrap">
    <h2>Start here: </h2>
    <form method="post" name="pass_quarantee_first" enctype="multipart/form-data" id="pass_quarantee_first" >
    <input type="hidden" name="action" value="Process">
    <div>
        <p>1) Select your Driving Theory Test Category</p>

        <p class="note">(Note that all Driving Theory Tests are conducted by the DVSA not the DVLA)</p>
        
        <select name="testCategory">
            <option value="">Please select one...</option>
        <?php
        
        if(!empty($testCat)){
            foreach($testCat as $tCat){
                echo '<option value="'.$tCat['id'].'">'.$tCat['name'].'</option>';
            }
        }
        ?>
        </select>
    </div>
    <div>
        <p>2) Which language would you like to see the questions in?</p>

        <p class="note">(You will be able to choose an additional voiceover language such as Urdu in the next section)</p>
        
        <input type="radio" name="language" value="English" checked="checked">English
        <input type="radio" name="language" value="Welsh">Welsh
        
        <p>(these are the only two screen languages available) </p>
    </div>
    <div>
        <p>3) Do you have any special requirements? </p>
        <input type="radio" name="special_requirement" value="No" checked="checked">No
        <input type="radio" name="special_requirement" value="Yes">Yes
        <p>For example you may need to listen to the test questions through headphones in your own language or see the questions and answers in British Sign Language.</p>
    </div>
    <div><button class="btn-login" type="submit">Next</button></div>
    </form>
 </div>