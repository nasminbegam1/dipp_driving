<div class="wrap">
<div class="allQusSec">
    <form method="post" name="third_step" id="third_step" >
    <h2>date preferences: </h2>
    <div class="qusListDiv">
        
        <h5>6) When would you like to take your Theory Test ? </h5>
        <div class="radioFiledSet">
<!--<div class="radioFiled"><input type="radio" name="preference" value="as_soon_as_possible" id="as_soon_as_possible" <?php //if(isset($result[0]['when_take_test']) && $result[0]['when_take_test'] == 'as_soon_as_possible') echo "checked";?>>As soon as possible</div>-->
<div class="radioFiled"><input type="radio" name="preference" value="preferred_date" id="preferred_date"  <?php if(isset($result[0]['when_take_test']) && $result[0]['when_take_test'] == 'preferred_date') echo "checked";?>>preference date</div>
    </div>
    </div>

    <div id="pref_date_sec" class="thirdSection clearfix" style="display: <?php if(isset($result[0]['when_take_test']) && $result[0]['when_take_test'] == 'preferred_date') echo "block"; else echo "none";?>;">
        <div class="thirdSecLt">
        <h5>Tell us when you are available </h5>
        <span class="note">Please offer as many date and time options as possible as most test centres are extremely busy with waiting periods of 1 - 2 weeks or more depending on day of week and time of day. </span>
        
        <div class="ptime">
             <p>Your preferred Days and times of the week:</p>
                <p>AM = 9 AM to 12 PM (mid-day)</p>
                <p>AFT = 12 PM (mid-day) to 5 PM</p>
                <p>EVE = 5 PM to 7 PM</p>
                
                <table class="timetable">
                    <tr>
                        <td></td>
                        <th> MON </th>
                        <th> TUE </th>
                        <th> WED </th>
                        <th> THU </th>
                        <th> FRI </th>
                        <th> SAT </th>
                    </tr>
                    <tr>
                        <td>AM</td>
                        <td><input type="checkbox" name="am_time[]" class="prefer_time" value="Mon" <?php if(isset($result[0]['am']) && in_array('Mon',explode(',',$result[0]['am']))) echo "checked";?>></td>
                        <td><input type="checkbox" name="am_time[]" class="prefer_time" value="Tue" <?php if(isset($result[0]['am']) && in_array('Tue',explode(',',$result[0]['am']))) echo "checked";?>></td>
                        <td><input type="checkbox" name="am_time[]" class="prefer_time" value="Wed" <?php if(isset($result[0]['am']) && in_array('Wed',explode(',',$result[0]['am']))) echo "checked";?>></td>
                        <td><input type="checkbox" name="am_time[]" class="prefer_time" value="Thu" <?php if(isset($result[0]['am']) && in_array('Thu',explode(',',$result[0]['am']))) echo "checked";?>></td>
                        <td><input type="checkbox" name="am_time[]" class="prefer_time" value="Fri" <?php if(isset($result[0]['am']) && in_array('Fri',explode(',',$result[0]['am']))) echo "checked";?>></td>
                        <td><input type="checkbox" name="am_time[]" class="prefer_time" value="Sat" <?php if(isset($result[0]['am']) && in_array('Sat',explode(',',$result[0]['am']))) echo "checked";?>></td>                        
                    </tr>
                    
                    <tr>
                        <td>AFT</td>
                        <td><input type="checkbox" name="aft_time[]" class="prefer_time" value="Mon" <?php if(isset($result[0]['aft']) && in_array('Mon',explode(',',$result[0]['aft']))) echo "checked";?>></td>
                        <td><input type="checkbox" name="aft_time[]" class="prefer_time" value="Tue" <?php if(isset($result[0]['aft']) && in_array('Tue',explode(',',$result[0]['aft']))) echo "checked";?>></td>
                        <td><input type="checkbox" name="aft_time[]" class="prefer_time" value="Wed" <?php if(isset($result[0]['aft']) && in_array('Wed',explode(',',$result[0]['aft']))) echo "checked";?>></td>
                        <td><input type="checkbox" name="aft_time[]" class="prefer_time" value="Thu" <?php if(isset($result[0]['aft']) && in_array('Thu',explode(',',$result[0]['aft']))) echo "checked";?>></td>
                        <td><input type="checkbox" name="aft_time[]" class="prefer_time" value="Fri" <?php if(isset($result[0]['aft']) && in_array('Fri',explode(',',$result[0]['aft']))) echo "checked";?>></td>
                        <td><input type="checkbox" name="aft_time[]" class="prefer_time" value="Sat" <?php if(isset($result[0]['aft']) && in_array('Sat',explode(',',$result[0]['aft']))) echo "checked";?>></td>                        
                    </tr>
                    
                    <tr>
                        <td>EVE</td>
                        <td><input type="checkbox" name="eve_time[]" class="prefer_time" value="Mon" <?php if(isset($result[0]['eve']) && in_array('Mon',explode(',',$result[0]['eve']))) echo "checked";?>></td>
                        <td><input type="checkbox" name="eve_time[]" class="prefer_time" value="Tue" <?php if(isset($result[0]['eve']) && in_array('Tue',explode(',',$result[0]['eve']))) echo "checked";?>></td>
                        <td><input type="checkbox" name="eve_time[]" class="prefer_time" value="Wed" <?php if(isset($result[0]['eve']) && in_array('Wed',explode(',',$result[0]['eve']))) echo "checked";?>></td>
                        <td><input type="checkbox" name="eve_time[]" class="prefer_time" value="Thu" <?php if(isset($result[0]['eve']) && in_array('Thu',explode(',',$result[0]['eve']))) echo "checked";?>></td>
                        <td><input type="checkbox" name="eve_time[]" class="prefer_time" value="Fri" <?php if(isset($result[0]['eve']) && in_array('Fri',explode(',',$result[0]['eve']))) echo "checked";?>></td>
                    </tr>
                    
                </table>
                
        </div>
        
        </div>
        <div class="thirdSecRt">
            <div class="date_range_section clearfix">
            <div class="titledate clearfix">
            <div class="right_sec">Date From</div>
            <div class="left_sec">Date To</div>
            </div>
            <?php for($i=0;$i<count($date_result);$i++){?>
            <div class="right_sec">             
                <select name="date_from[]" id="date_from" class="date_from">
                    <option value="">Select</option>
                    <?php foreach($dateArr as $dateval => $date){?>
                    <option value="<?php echo $dateval;?>"<?php if(is_array($date_result) && $date_result[$i]['from_date'] == $dateval) echo "selected"; ?>><?php echo $date;?></option>
                    <?php }?>    
                   
                </select>                
            </div>
            <div class="left_sec">            
                <select name="date_to[]" id="date_to" class="date_to">
                    <option value="">Select</option>
                    <?php foreach($dateArr as $dateval => $date){?>
                    <option value="<?php echo $dateval;?>" <?php if(is_array($date_result) && $date_result[$i]['to_date'] == $dateval) echo "selected"; ?>><?php echo $date;?></option>
                    <?php }?>    
                   
                </select>                
            </div>
            <?php }?>
            
            
            <?php for($i=1;$i<=6-count($date_result);$i++){?>
            <div class="right_sec">             
                <select name="date_from[]" id="date_from" class="date_from">
                    <option value="">Select</option>
                    <?php foreach($dateArr as $dateval => $date){?>
                    <option value="<?php echo $dateval;?>"><?php echo $date;?></option>
                    <?php }?>    
                   
                </select>                
            </div>
            <div class="left_sec">            
                <select name="date_to[]" id="date_to" class="date_to">
                    <option value="">Select</option>
                    <?php foreach($dateArr as $dateval => $date){?>
                    <option value="<?php echo $dateval;?>"><?php echo $date;?></option>
                    <?php }?>    
                   
                </select>                
            </div>
            <?php }?>
        </div>
        </div>
    </div>
    <div class="thirdsecBtn wrap"><a class="backBtn btn-prev" href="<?php echo base_url().'pass_guarantee/second';?>">Previous</a><button class="btn-login btn-nxt" type="submit" id="next">Next</button></div>
    <input name="action" type="hidden" value="Process">
    </form>
    </div>
 </div>


<style>
    .date_range_section{
        width: 250px;
        height: 200px;
    }
    .right_sec{
        width: 120px;
        float: left;

    }
    .left_sec{
        width: 120px;
        float: left;
        padding-right: 5px;
    }
    
</style>
<script>
    
    $(document).ready(function(){
    $('input:radio[name="preference"]').trigger("click");
    });
    
    
    $('input:radio[name="preference"]').change(function(){
        var checkval =  $(this).val();
        if (checkval == 'as_soon_as_possible' ) {
            $('#pref_date_sec').hide();
        }
        if (checkval == 'preferred_date' ) {
            $('#pref_date_sec').show();
        }
         
    });
    
    $('#next').click(function(){
        var preference = $('input:radio[name="preference"]').is(':checked');
        if (preference == false) {
            alert('Please select any');
            return false;
        }
   
        if ($('input:radio[name="preference"]:checked').val() == 'preferred_date') {
        
        var date_from = 0;
        var date_to = 0;
        var prefer_time = 0;
        var check_date = 0;
        $('.date_from').each(function(index){
          
           if( $(this).val() != '')
           {
                date_from = 1;
             
                if ($('.date_to').eq(index).val() != '') {
                    date_to = 1;
                  }
                  
                var startDate = new Date($(this).val());
                var endDate = new Date($('.date_to').eq(index).val());
                var no = index + 1;
                if (startDate > endDate){
                    alert('Date From '+no+' should be before Date To '+no);
                    check_date = 1;
                   
                }
                
           }
          
           //alert($('.date_to').eq(index).val());
           
           
        });
        
        if (check_date == 1) {
             return false;
        }
        
        //$('.date_to').each(function(){
        //   if( $(this).val() != '')
        //   {
        //        
        //   }
        //});
   
        if (date_from == 0 || date_to == 0) {
            alert('Please select atleast one Date From  and Date To');
            return false;
        }
        

        
        $('.prefer_time').each(function(){
           if( $(this).is(':checked') == true)
           {
                prefer_time = 1;
           }
        });
        
        if (prefer_time == 0) {
            alert('Select at least one preferred time of day');
            return false;
        }
        
        //return false;
       }

    });
    
</script>
