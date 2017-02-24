<section>
  <div class="container">          
    <article>  
        <div class="src-box">
          <h3 class="heading-txt">Student Report Card</h3>
          <article>
            <div class="report-box">
              <h4>Student Report Card</h4>
              <ul class="clearfix studntInfo">
                <li>
                  <ul>
                    <li><strong>Email:</strong> <?php echo $student[0]['student_email'];?> </li>                      
                    <li><strong>Phone Number:</strong> <?php echo ($student[0]['student_phone'] !='')?$student[0]['student_phone']:'N/A'; ?> </li>                     
                    <li><strong>Vehicle:</strong> <?php echo stripslashes($course_details->name);?></li>
                  </ul>
                </li>
                <li>
                  <ul>
                    <li><strong>Joined on:</strong> <?php echo date('j F Y',strtotime($student[0]['added_on']));?> </li>
                    <li><strong>Last login:</strong> <?php echo ($student[0]['last_login'] !='0000-00-00 00:00:00')?date('j F Y',strtotime($student[0]['last_login'])):'';?></li>
                    <li><strong>Test date:</strong> <?php echo ($last_test != '')?date('j F Y',$last_test):''; ?></li>   
                  </ul>
                </li>
              </ul>
              <!---->
              <div class="tableDivpan">
              <h4 class="heading2">LESSON TEST SUMMARY</h4>
              <div class="tableDivpanIn"> 
              <div class="table-responsive clearfix">
                
                <table cellpadding="0" cellspacing="0" border="0" width="100%">
                  <thead>
                    <tr>
                      <th>Topic</th>
                      <th>Module</th>
                      <th>Attempted </th>
                      <th>Progress</th>                          
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                        if(!empty($pactrice_details)) {
                        foreach($pactrice_details as $pracDtls){
                    ?>
                    <tr>
                      <td data-title="Topic"><?php echo $pracDtls['topic_name']; ?></td>
                      <td data-title="Module"><?php echo $pracDtls['module_name']; ?></td>
                      <td data-title="Attempted"><?php echo number_format($pracDtls['complete_question'],1).'%'; ?></td>
                      <td data-title="Progress">
                      <?php
                        if(number_format($pracDtls['answer_percentage'],2) <=30.00){
                                        echo "Fail";
                        }
                        else{
                                        echo "Pass";
                        }
                        ?></td>                          
                    </tr>
                    <?php } }else{ ?>
                    <tr><td colspan="4">--No record found--</td></tr>
                    <?php } ?>
                    
                  </tbody>
                </table>                    
              </div>
              </div>
            </div>
              <div class="tableDivpan">
            <h4 class="heading2">MOCK TEST SUMMARY</h4>
            <div class="tableDivpanIn"> 
              <div class="table-responsive clearfix">
                
                <table cellpadding="0" cellspacing="0" border="0" width="100%">
                  <thead>
                    <tr>
                      <th>Date</th>
                      <th>Attempted </th>
                      <th>Progress </th>                         
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    if(is_array($mock_details['testRes'])){
                        foreach($mock_details['testRes'] as $tstRs){
                    ?>
                    <tr>
                      <td data-title="Date"><?php echo $tstRs['testDate']?></td>
                      <td data-title="Attempted"><?php echo $tstRs['attemp_question']; ?></td>
                      <td data-title="Progress"><?php echo ($tstRs['result'] == 0)?'Fail':'Pass'; ?></td>                          
                    </tr>
                    <?php } }else{ ?>
                    <tr>
                        <td colspan="3">--No result founs--</td>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>                    
            </div> 
            </div>
              </div>
              <div class="tableDivpan">                
            <h4 class="heading2">HAZARD PERCEPTION TEST SUMMARY</h4>
            <div class="tableDivpanIn"> 
              <div class="table-responsive clearfix">
                
                <table cellpadding="0" cellspacing="0" border="0" width="100%">
                  <thead>
                    <tr>
                      <th>Video</th>
                      <th>Score </th>
                      <th>Date </th>                         
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    if(is_array($hazard_details)){
                        foreach($hazard_details as $hazardDls){
                    ?>
                    <tr>
                      <td data-title="Date"><?php echo 'Video : '.$hazardDls['id']?></td>
                      <td data-title="Attempted"><?php echo $hazardDls['score']; ?></td>
                      <td data-title="Progress"><?php echo date('d-m-Y',strtotime($hazardDls['added_date'])); ?></td>                          
                    </tr>
                    <?php } }else{ ?>
                    <tr>
                        <td colspan="3">--No result founs--</td>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table> 
                </div>                   
            </div>
              </div>
            </div>
            <div class="score-box">
                <h4><?php echo stripslashes($student[0]['student_fname']).' '.stripslashes($student[0]['student_lname']); ?></h4>
                <ul>
                  <li>
                    <div class="project-score">
                      <h5>Lesson Test Mastery</h5>
                      <?php 
                      if($pactriceTestMastery['practicetestmastery'] < 80 ){?>
                      <strong><?php echo number_format($pactriceTestMastery['practicetestmastery'],2); ?>%</strong>
                      <p>Revision Required</p>
                      <?php }else if($pactriceTestMastery['practicetestmastery'] > 80){ ?>
                      <strong style="color:green"><?php echo number_format($pactriceTestMastery['practicetestmastery'],2); ?>%</strong>
                      <p>Excellent</p>
                      <?php } ?>                           
                    </div>
                  </li>
                  <li>
                    <div class="test-bank">
                      <h5>Mock Test Mastery </h5>
                      <?php if($mockTestMastery['mocktestmastery'] < 80 ){?>
                      <strong><?php echo number_format($mockTestMastery['mocktestmastery'],1); ?>%</strong>
                      <p>Revision Required</p>
                      <?php }else if($mockTestMastery['mocktestmastery'] > 80){ ?>
                      <strong style="color:green"><?php echo number_format($mockTestMastery['mocktestmastery'],1); ?>%</strong>
                      <p>Excellent</p>
                      <?php } ?>
                    </div>                          
                  </li>
                  <li>
                    <div class="project-score">
                      <h5>Hazard Perception Test Mastery</h5>
                      <?php if($hazardTestMastery < 80 ){?>
                      <strong><?php echo $hazardTestMastery; ?>%</strong>
                      <p>Revision Required</p>
                      <?php }else if($hazardTestMastery > 80){ ?>
                      <strong style="color:green"><?php echo $hazardTestMastery; ?>%</strong>
                      <p>Excellent</p>
                      <?php } ?>                           
                    </div>
                  </li>
                </ul>
            </div>                  
          </article>
        </div>
    </article>
  </div>        
</section>
<?php //pr($student);?>