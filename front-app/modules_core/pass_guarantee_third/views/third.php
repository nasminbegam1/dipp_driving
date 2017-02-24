<div class="wrap">
    <form method="post" name="third_step" id="third_step" >
    <h2>Start here: </h2>
    <div>
        
        <p>5) When would you like to take your Theory Test ? </p>
<p><input type="radio" name="preference" value="as_soon_as_possible" id="as_soon_as_possible">As soon as possible</p>
<p><input type="radio" name="preference" value="preferred_date" id="preferred_date">preference date</p>
    </div>
    
    <div id="pref_date_sec" style="display: none;">
        <p>Tell us when you are available </p>
        <div class="date_range_section">
            
            <div class="right_sec">Date From</div>
            <div class="left_sec">Date To</div>
            <?php for($i=1;$i<=6;$i++){?>
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
        
        <span>Please offer as many date and time options as possible as most test centres are extremely busy with waiting periods of 1 - 2 weeks or more depending on day of week and time of day. </span>
        
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
                        <td><input type="checkbox" name="am_time[]" class="prefer_time" value="Mon"></td>
                        <td><input type="checkbox" name="am_time[]" class="prefer_time" value="Tue"></td>
                        <td><input type="checkbox" name="am_time[]" class="prefer_time" value="Wed"></td>
                        <td><input type="checkbox" name="am_time[]" class="prefer_time" value="Thu"></td>
                        <td><input type="checkbox" name="am_time[]" class="prefer_time" value="Fri"></td>
                        <td><input type="checkbox" name="am_time[]" class="prefer_time" value="Sat"></td>                        
                    </tr>
                    
                    <tr>
                        <td>AFT</td>
                        <td><input type="checkbox" name="aft_time[]" class="prefer_time" value="Mon"></td>
                        <td><input type="checkbox" name="aft_time[]" class="prefer_time" value="Tue"></td>
                        <td><input type="checkbox" name="aft_time[]" class="prefer_time" value="Wed"></td>
                        <td><input type="checkbox" name="aft_time[]" class="prefer_time" value="Thu"></td>
                        <td><input type="checkbox" name="aft_time[]" class="prefer_time" value="Fri"></td>
                        <td><input type="checkbox" name="aft_time[]" class="prefer_time" value="Sat"></td>                        
                    </tr>
                    
                    <tr>
                        <td>EVE</td>
                        <td><input type="checkbox" name="eve_time[]" class="prefer_time" value="Mon"></td>
                        <td><input type="checkbox" name="eve_time[]" class="prefer_time" value="Tue"></td>
                        <td><input type="checkbox" name="eve_time[]" class="prefer_time" value="Wed"></td>
                        <td><input type="checkbox" name="eve_time[]" class="prefer_time" value="Thu"></td>
                        <td><input type="checkbox" name="eve_time[]" class="prefer_time" value="Fri"></td>
                    </tr>
                    
                </table>
                
        </div>
        
     
        
    </div>
    <div><button class="btn-login" type="submit" id="next">Next</button></div>
    <input name="action" type="hidden" value="Process">
    </form>
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
                }
                
           }
          
           //alert($('.date_to').eq(index).val());
           
           
        });
        
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
