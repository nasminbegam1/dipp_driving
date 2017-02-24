<div class="stepPage">
    <div class="wrap">
      <h2 class="title">TAKE A MOCK TEST BELOW</h2>
      <div class="mockTestSec">
        <div class="mockTestTop clear">
          <div class="mockTestTopLeft"><span>Mock Tests Taken:  <?php echo $mockTestResult['totalTest'];?></span></div>
          <div class="mockTestTopRight"> <span class="mocktrue"><?php echo $mockTestResult['totalPass']; ?></span> <span class="mockfalse"><?php echo $mockTestResult['totalFail']; ?></span> <a href="<?php echo base_url().'learn/mocktest/start_test'?>" class="takeTest">Take a test</a> </div>
        </div>
        <div class="mockTestBottom">
          <h3>Your previous Mock Test results</h3>
          <ul class="takenSec">
            <li>Date test taken</li>
            <li>Passed/Fail</li>
          </ul>
          <?php if(is_array($mockTestResult['testRes']) && count($mockTestResult['testRes'])>0){
            foreach($mockTestResult['testRes'] as $tRes){
          ?>
          <ul>
            <li><?php echo $tRes['testDate'];?></li>
            <li><?php echo ($tRes['result']==0)?'Fail':'Pass';?></li>
          </ul>
          <?php } }else{ ?>
          <span class="foundResult">No results found</span>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>