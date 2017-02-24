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
                                <th align="left">MON</th>
                                <th align="left">TUE</th>
                                <th align="left">WED</th>
                                <th align="left">THU</th>
                                <th align="left">FRI</th>
                                <th align="left">SAT</th>
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
                                <th align="left">Date from</th>
                                <th align="left">Date to</th>
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
