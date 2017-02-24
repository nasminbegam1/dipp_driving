<div class="wrap">
    <form method="post" name="test_centre" enctype="multipart/form-data" id="test_centre" >
    <h2>Start here: </h2>
    <div>
        
        <p>4) Select your Test Centre - over 80 to choose from</p>
        <p>NOTE: The following test centres closed as of 31st August 2011</p>
        <p>Basingstoke, Bath, Birkenhead, Clydebank, Colchester, Dunfermline, Durham, Motherwell, Runcorn, Solihull</p>
        <p>Find your nearest test centre by entering your postcode below or just select one from the test centre list: </p>
    </div>
    <div>
        <p>
            Your FULL postcode: <span><input type="text" name="post_code" id="post_code"></span>
            <input type="button" id="lookup" value="Look up">
        </p>
    </div>
    <div>
        <select size="10" name="test_centre">
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
    <div><button class="btn-login" type="submit">Next</button></div>
    </form>
 </div>