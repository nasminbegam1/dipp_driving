<div class="wrap">
    <style>
        .scroll-details{
            max-height: 450px;
            overflow-y: auto;
        }
    </style>
    <div class="allQusSec">
    <form method="post" name="test_centre" action="<?php echo base_url(); ?>pass_guarantee/payment_process" enctype="multipart/form-data" id="gua_summary" >
        <p><b>Summary and Pay </b></p>
        <p>Do NOT use your browser back and forward buttons - use the Next and Previous buttons on the forms </p>
        <h5>Summary</h5><br>
        <div class="scroll-details thirdSection">
            <p>This is a summary of the details you have entered. Use the Previous button to go back through the forms to make any necessary corrections.</p>
            <table class="summaryTable" width="100%" cellpadding="0" cellspacing="0" border="0">
                <tr>
                    <td width="40%">Test Category: </td>
                    <td width="60%"><?php echo stripslashes($course[0]['name']); ?></td>
                </tr>
                <tr>
                    <td width="40%">Pass Protection: </td>
                    <td width="60%">Yes</td>
                </tr>
                <tr>
                    <td width="40%">On screen language: </td>
                    <td width="60%"><?php echo stripslashes($details->language); ?></td>
                </tr>
                <tr>
                    <td width="40%">British Sign Language: </td>
                    <td width="60%">Not required </td>
                </tr>
                <tr>
                    <td width="40%">Voice-over: </td>
                    <td width="60%">Not required</td>
                </tr>
                <tr>
                    <td width="40%">Other special requirements:</td>
                    <td width="60%"><?php echo stripslashes($details->special_requirement); ?></td>
                </tr>
                <tr>
                    <td width="40%">GB licence number: </td>
                    <td width="60%"><?php echo stripslashes($details->licence_number); ?></td>
                </tr>
                <tr>
                    <td width="40%">Test Centre: </td>
                    <td width="60%"><?php echo stripslashes($centre[0]['name']); ?></td>
                </tr>
                <tr>
                    <td width="40%">Your test date preferences: </td>
                    <td width="60%"><?php echo ($details->when_take_test == 'preferred_date')?'Preferred Date':'As Soon As Possible'; ?></td>
                </tr>
                <?php if($details->when_take_test == 'preferred_date'){?>
                <tr>
                    <td width="40%">Preferred Time Of Day</td>
                    <td width="60%">
                        <?php $days = array('Mon','Tue','Wed','Thu','Fri','Sat'); ?>
                        <table class="timetable" width="100%" cellpadding="0" cellspacing="0" border="0">
                            <tr>
                                <td></td>
                                <th>MON</th>
                                <th>TUE</th>
                                <th>WED</th>
                                <th>THU</th>
                                <th>FRI</th>
                                <th>SAT</th>
                            </tr>
                            <tr>
                                <td>AM (09.00 AM - 12.00 PM)</td>
                                <?php
                                $am = explode(',',$details->am);
                                for($i=0;$i<count($days);$i++){
                                ?>
                                <td><?php if(in_array($days[$i],$am)){echo 'Y';}?></td>
                                <?php
                                }
                                ?>
                                
                            </tr>
                            <tr>
                                <td>AFT (12.00 PM - 05.00 PM)</td>
                                <?php
                                $aft = explode(',',$details->aft);
                                for($i=0;$i<count($days);$i++){
                                ?>
                                <td><?php if(in_array($days[$i],$aft)){echo 'Y';}?></td>
                                <?php
                                }
                                ?>
                            </tr>
                            <tr>
                                <td>EVE (05.00 PM - 07.00 PM)</td>
                                <?php
                                $eve = explode(',',$details->eve);
                                for($i=0;$i<count($days);$i++){
                                ?>
                                <td><?php if(in_array($days[$i],$eve)){echo 'Y';}?></td>
                                <?php
                                }
                                ?>
                            </tr>
                        </table>
                    </td>
                </tr>
                <?php if(count($prefferdate) > 0){ ?>
                <tr>
                    <td width="40%">Dates you are available:</td>
                    <td width="60%">
                        <table class="timetable timetableNew" width="100%" cellpadding="0" cellspacing="0" border="0">
                            <tr>
                                <th>Date from</th>
                                <th>Date to</th>
                            </tr>
                            <?php
                                foreach($prefferdate as $pDate){
                                ?>
                            <tr>
                                <td><?php echo $pDate['from_date'];?></td>
                                <td><?php echo $pDate['to_date'];?></td>
                            </tr>
                            <?php  } ?>
                        </table>
                    </td>
                </tr>
                
                <?php } } ?>
               
                <tr>
                    <td width="40%">Candidate title: </td>
                    <td width="60%"><?php echo stripslashes($details->title);?></td>
                </tr>
                <tr>
                    <td width="40%">Candidate firstname(s): </td>
                    <td width="60%"><?php echo stripslashes($details->first_name).' '.stripslashes($details->middle_name);?></td>
                </tr>
                <tr>
                    <td width="40%">Candidate surname:</td>
                    <td width="60%"><?php echo stripslashes($details->last_name);?></td>
                </tr>
                <tr>
                    <td width="40%">Candidate address:  </td>
                    <td width="60%"><?php echo stripslashes($details->address1).'<br>'.stripslashes($details->address2);?></td>
                </tr>
                <tr>
                    <td width="40%">Candidate town:  </td>
                    <td width="60%"><?php echo stripslashes($details->town);?></td>
                </tr>
                <tr>
                    <td width="40%">Candidate postcode:  </td>
                    <td width="60%"><?php echo stripslashes($details->post_code);?></td>
                </tr>
                <tr>
                    <td width="40%">Candidate telephone number:  </td>
                    <td width="60%"><?php echo stripslashes($details->telephone_no);?></td>
                </tr>
                <tr>
                    <td width="40%">Candidate email address:  </td>
                    <td width="60%"><?php echo stripslashes($details->email);?></td>
                </tr>
            </table>
        </div>
        <br>
        <p>We have now collected all of the necessary information for your Theory Test Booking.</p>
        <label id="errorMsg" class="error"></label>
        <p><input type="checkbox" name="summary_term" id="pasguarantee_terms" value="terms">I agree to the Driving Instructor Partner Programme <a href="<?php echo base_url().'terms-and-conditions'; ?>">Terms and Conditions</a></p>
        <div>
            <div class="paypal-payment" >
                <input type="radio" name="payment_type" value="paypal" checked="checked"/>Paypal
            </div>

            <div class="worldpay-payment">
                <input type="radio" name="payment_type" value="worldpay" />Worldpay
            </div> 
        </div>
        <!--<div>
            <input type="radio" name="payment_type" value="paypal">Paypal
            <input type="radio" name="payment_type" value="world_pay">World Pay
        </div>-->
        <div class="nextPrevBtns"><a class="backBtn" href="<?php echo base_url().'pass_guarantee/fourth';?>">Previous</a><button class="btn-login" type="submit" id="next_passguarantee">Next</button></div>
    </form>
    </div>
</div>