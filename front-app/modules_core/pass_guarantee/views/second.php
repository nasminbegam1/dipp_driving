<div class="wrap">
<div class="allQusSec">
    <form method="post" name="test_centre" enctype="multipart/form-data" id="test_centre" >
    <input type="hidden" name="action" value="Process">
    <h2>test centre: </h2>
    <div class="qusListDiv">
        
        <h5>5) Select your Test Centre - over 150 to choose from</h5>
        <!--<span class="note">NOTE: The following test centres closed as of 31st August 2011</span>
        <p>Basingstoke, Bath, Birkenhead, Clydebank, Colchester, Dunfermline, Durham, Motherwell, Runcorn, Solihull</p>-->
        
    </div>
    <div class="qusListDivTwo">
    <div class="qusListDiv">
        <p><strong>Find your nearest test centre by entering your postcode below or just select one from the test centre list: </strong></p>
        <p class="lookFileds">
            <div class="postcodePan">
            <label><strong>Your FULL postcode:</strong></label> <input type="text" name="post_code" id="post_code">
            <input type="button" id="lookup" value="Look up">
            </div>
            <span id="result_details"></span>
        </p>
    </div>
    <div class="qusListDiv">
        <select size="10" name="test_centre" id="test_centre">
        <?php
            if(!empty($test_centre)){
                foreach($test_centre as $t_centre){
        ?>
                    <option value="<?php echo $t_centre['id']?>" <?php echo ($details->test_centre_id > 0 && $t_centre['id'] == $details->test_centre_id)?'selected':''; ?>><?php echo stripslashes($t_centre['name']); ?></option>
            <?php
                }
            ?>
            <?php } ?>
        </select>
    </div>
    
    </div>
    
    <div class="nextPrevBtns wrap"><a class="backBtn btn-prev" href="<?php echo base_url().'pass_guarantee/first';?>">Previous</a><button class="btn-login btn-nxt" type="submit">Next</button>
    </div>
    </form>
    </div>
 </div>