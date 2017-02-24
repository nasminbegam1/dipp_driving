<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
	<head>
	<meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Dipp Driving</title>
        </head>
    <body>
        <center>
			<table width="600" align="center" valign="top" style="background: #fafafa; font-size: 14px; font-family: arial, sans-serif; color: #666;">
				<tr>
					<td style="border: none; padding: 0;">
						<table width="100%" align="left" valign="top">
							<tr>
								<td style="border: 1px solid #eaeaea; padding: 7px 5px; height: 20px;">Test Category:</td>
								<td style="border: 1px solid #eaeaea; padding: 7px 5px; height: 20px;"><?php echo stripslashes($course[0]['name']); ?></td>
							</tr>
							<tr>
								<td style="border: 1px solid #eaeaea; padding: 7px 5px; height: 20px;">Pass Protection:</td>
								<td style="border: 1px solid #eaeaea; padding: 7px 5px; height: 20px;">Yes</td>
							</tr>
							<tr>
								<td style="border: 1px solid #eaeaea; padding: 7px 5px; height: 20px;">On screen language:</td>
								<td style="border: 1px solid #eaeaea; padding: 7px 5px; height: 20px;"><?php echo stripslashes($details->language); ?></td>
							</tr>
							<tr>
								<td style="border: 1px solid #eaeaea; padding: 7px 5px; height: 20px;">British Sign Language:</td>
								<td style="border: 1px solid #eaeaea; padding: 7px 5px; height: 20px;">Not required</td>
							</tr>
							<tr>
								<td style="border: 1px solid #eaeaea; padding: 7px 5px; height: 20px;">Voice-over:</td>
								<td style="border: 1px solid #eaeaea; padding: 7px 5px; height: 20px;">Not required</td>
							</tr>
							<tr>
								<td style="border: 1px solid #eaeaea; padding: 7px 5px; height: 20px;">Other special requirements:</td>
								<td style="border: 1px solid #eaeaea; padding: 7px 5px; height: 20px;"><?php echo stripslashes($details->special_requirement); ?></td>
							</tr>
							<tr>
								<td style="border: 1px solid #eaeaea; padding: 7px 5px; height: 20px;">GB licence number:</td>
								<td style="border: 1px solid #eaeaea; padding: 7px 5px; height: 20px;"><?php echo stripslashes($details->licence_number); ?></td>
							</tr>
							<tr>
								<td style="border: 1px solid #eaeaea; padding: 7px 5px; height: 20px;">Test Centre:</td>
								<td style="border: 1px solid #eaeaea; padding: 7px 5px; height: 20px;"><?php echo stripslashes($centre[0]['name']); ?></td>
							</tr>
							<tr>
								<td style="border: 1px solid #eaeaea; padding: 7px 5px; height: 20px;">Your test date preferences:</td>
								<td style="border: 1px solid #eaeaea; padding: 7px 5px; height: 20px;"><?php echo ($details->when_take_test == 'preferred_date')?'Preferred Date':'As Soon As Possible'; ?></td>
							</tr>
						</table>
					</td>
				</tr>
                                <?php if($details->when_take_test == 'preferred_date'){ ?>
                                <?php $days = array('Mon','Tue','Wed','Thu','Fri','Sat'); ?>
				<tr>
					<td style="border: none; height: 20px;">
						<table width="100%" align="left" valign="top">
							<tr>
								<td style="border: 1px solid #eaeaea;">
									<table width="100%" align="left" valign="top">
										<tr rowspan="4"><td style="border: none; font-size: 12px; padding: 7px 5px; height: 20px;">Preferred Time Of Day</td></tr>
									</table>	
								</td>
								<td style="border: 1px solid #eaeaea;">
									<table width="100%" align="left" valign="top">
										<tr><td style="border: none; font-size: 12px; padding: 7px 5px; height: 20px;"></td></tr>
										<tr><td style="border: none; font-size: 12px; padding: 7px 5px; height: 20px;">AM (09.00 AM - 12.00 PM)</td></tr>
										<tr><td style="border: none; font-size: 12px; padding: 7px 5px; height: 20px;">AFT (12.00 PM - 05.00 PM)</td></tr>
										<tr><td style="border: none; font-size: 12px; padding: 7px 5px; height: 20px;">EVE (05.00 PM - 07.00 PM)</td></tr>
									</table>	
								</td>
								<td style="padding: 0; text-align: center; height: 20px; border: 1px solid #eaeaea;">
									<table width="100%" align="left" valign="top">
										<tr>
											<td style="font-weight: 600; color: #666; border: none; padding: 0; font-size: 13px; height: 20px;">
												<table width="100%" align="left" valign="top">
													<tr>
														<td style="border: none;">MON</td>
														<td style="border: none;">TUE</td>
														<td style="border: none;">WED</td>
														<td style="border: none;">THU</td>
														<td style="border: none;">FRI</td>
														<td style="border: none;">SAT</td>
													</tr>
												</table>
											</td>
										</tr>
										<tr>
											<td style="border: none; padding: 0;">
												<table width="100%" align="left" valign="top">
													<tr>
                                                                                                            <?php
                                                                                                            $am = explode(',',$details->am);
                                                                                                            for($i=0;$i<count($days);$i++){
                                                                                                            ?>
                                                                                                            <td style="border: none;"><?= (in_array($days[$i],$am))?'Y':'&nbsp;';?></td>
                                                                                                            <?php
                                                                                                            }
                                                                                                            ?>
													</tr>
												</table>
											</td>
										</tr>
										<tr>
											<td style="border: none; padding: 0;">
												<table width="100%" align="left" valign="top">
													<tr>
                                                                                                            <?php
                                                                                                                $aft = explode(',',$details->aft);
                                                                                                                for($i=0;$i<count($days);$i++){
                                                                                                                ?>
                                                                                                                <td style="border: none;"><?= (in_array($days[$i],$aft))?'Y':'&nbsp;';?></td>
                                                                                                                <?php
                                                                                                                }
                                                                                                                ?>
													</tr>
												</table>
											</td>
										</tr>
										<tr>
											<td style="border: none; padding: 0;">
												<table width="100%" align="left" valign="top">
													<tr>
													    <?php
                                                                                                            $eve = explode(',',$details->eve);
                                                                                                            for($i=0;$i<count($days);$i++){
                                                                                                            ?>
                                                                                                            <td style="border: none;"><?= (in_array($days[$i],$eve))?'Y':'&nbsp;'; ?></td>
                                                                                                            <?php
                                                                                                            }
                                                                                                            ?>
													</tr>
												</table>
											</td>
										</tr>
									</table>	
								</td>
							</tr>
						</table>
					</td>
				</tr>
                                <?php } ?>
				<tr>
					<td style="border: none; padding: 0;">
						<table width="100%" align="left" valign="top">
                                                        <?php if(count($prefferdate) > 0 && $details->when_take_test == 'preferred_date'){ ?>
							<tr>
								<td style="border: none;  padding: 7px 5px"></td>
								<td style="border: none; text-align: center; font-weight: 600; padding: 7px 5px;">Date from</td>
								<td style="border: none; text-align: center; font-weight: 600; padding: 7px 5px;">Date to</td>
							</tr>
                                                        <?php foreach($prefferdate as $k=>$pDate){  ?>
							<tr>
								<td style="border: none; padding: 7px 5px;"><?= ($k == 0)?'Dates you are available:':'';?></td>
								<td style="border: none; padding: 7px 5px;"><?php echo $pDate['from_date'];?></td>
								<td style="border: none; padding: 7px 5px;"><?php echo $pDate['to_date'];?></td>
							</tr>
                                                        <?php } } ?>
							<tr>
								<td style="border: none; padding: 7px 5px;">Candidate title: </td>
								<td style="border: none; padding: 7px 5px;"><?php echo stripslashes($details->title);?></td>
								<td style="border: none; padding: 7px 5px;"></td>
							</tr>
							<tr>
								<td style="border: none; padding: 7px 5px;">Candidate firstname(s):</td>
								<td style="border: none; padding: 7px 5px;"><?php echo stripslashes($details->first_name).' '.stripslashes($details->middle_name);?></td>
								<td style="border: none; padding: 7px 5px;"></td>
							</tr>
							<tr>
								<td style="border: none; padding: 7px 5px;">Candidate surname:</td>
								<td style="border: none; padding: 7px 5px;"><?php echo stripslashes($details->last_name);?></td>
								<td style="border: none; padding: 7px 5px;"></td>
							</tr>
							<tr>
								<td style="border: none; padding: 7px 5px;">Candidate address: </td>
								<td style="border: none; padding: 7px 5px;"><?php echo stripslashes($details->address1).'<br>'.stripslashes($details->address2);?></td>
								<td style="border: none; padding: 7px 5px;"></td>
							</tr>
							<tr>
								<td style="border: none; padding: 7px 5px;">Candidate town:</td>
								<td style="border: none; padding: 7px 5px;"><?php echo stripslashes($details->town);?></td>
								<td style="border: none; padding: 7px 5px;"></td>
							</tr>
							<tr>
								<td style="border: none; padding: 7px 5px;">Candidate postcode: </td>
								<td style="border: none; padding: 7px 5px;"><?php echo stripslashes($details->post_code);?></td>
								<td style="border: none; padding: 7px 5px;"></td>
							</tr>
							<tr>
								<td style="border: none; padding: 7px 5px;">Candidate telephone number:</td>
								<td style="border: none; padding: 7px 5px;"><?php echo stripslashes($details->telephone_no);?></td>
								<td style="border: none; padding: 7px 5px;"></td>
							</tr>
							<tr>
								<td style="border: none; padding: 7px 5px;">Candidate email address:</td>
								<td style="border: none; padding: 7px 5px;"><?php echo stripslashes($details->email);?></td>
								<td style="border: none; padding: 7px 5px;"></td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
        </center>
    </body>
</html>