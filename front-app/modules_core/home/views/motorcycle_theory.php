<div class="container">
	<div class="theoryPan">
		<div class="theoryPanTop clearfix">
			<div class="thPanItem clearfix">
				<div class="thPanItemLt">
					<p>Answer 50 Questions</p>
					<p>Score 43 / 50 on Questions</p>
				</div>
				<div class="thPanItemRt"><img src="<?php echo base_url();?>images/img1.jpg" /></div>
			</div>
			<div class="thPanItem clearfix">
				<div class="thPanItemLt">
					<p>Take 14 Hazard Tests</p>
					<p>Score 44 / 75 on Hazard Tests</p>
				</div>
				<div class="thPanItemRt"><img src="<?php echo base_url();?>images/img2.jpg" /></div>
			</div>
			<div class="thPanItem clearfix">
                <div class="thPanlast">
				<img src="<?php echo base_url();?>images/to-pass.jpg" />
				<p><strong>To PASS</strong></p>
                </div>
			</div>
		</div>
		<div class="theoryPanBtm">
			<div class="theoryPanDiv clearfix">
				 <h3>STAGE1</h3>
                                <div class="theoryPanDivLt"><img src="<?php echo base_url();?>images/big-img1.jpg" /></div>
                                <div class="theoryPanDivRt">
					<p>Start your learning with our Stage 1 lesson tests through picture based learning. A great method for those students who prefer to learn through pictures. We provide pictures, diagrams and explanations based around 14 individual lessons, everything you need to learn and develop your driving abilities. The lessons consist of:</p>
                                       <div class="twoTables clearfix">
                                        <table cellspacing="0" cellpadding="0" width="100%" border="0">
                                            <tr>
                                                <td>Accidents</td>
                                            </tr>
                                            <tr>
                                                <td>Attitude</td>
                                            </tr>
                                            <tr>
                                                <td>Hazard Awareness</td>
                                            </tr>
                                            <tr>
                                                <td>Other Types of Vehicle</td>
                                            </tr>
                                            <tr>
                                                <td>Road Rules</td>
                                            </tr>
                                            <tr>
                                                <td>Safety Margins</td>
                                            </tr>
                                            <tr>
                                                <td>Motorcycle Loading</td>
                                            </tr>
                                        </table>
                                        <table cellspacing="0" cellpadding="0" width="100%" border="0">
                                            <tr>
                                                <td>Alertness</td>
                                            </tr>
                                            <tr>
                                                <td>Documents</td>
                                            </tr>
                                            <tr>
                                                <td>Motorway Rules</td>
                                            </tr>
                                            <tr>
                                                <td>Road and Traffic Signs</td>
                                            </tr>
                                            <tr>
                                                <td>Motorcycle Safety</td>
                                            </tr>
                                            <tr>
                                                <td>Motorcycle Handling</td>
                                            </tr>
                                            <tr>
                                                <td>Road Users</td>
                                            </tr>
                                        </table>
                                        </div>
				</div>
			</div>
			<div class="theoryPanDiv clearfix">
                                <h3>STAGE2</h3>
				<div class="theoryPanDivLt"><img src="<?php echo base_url();?>images/big-img2.jpg" /></div>
				<div class="theoryPanDivRt">
                                    <p>Continue your lesson based learning with our Stage 2 lesson tests in multiple choice format. Work your way through at your own pace testing yourself against the information learned during Stage 1 for each lesson.</p>
                                    <p>Take the tests as many times as you like until you ar confident around each lesson subject. Review the questions against the answers detailed for a complete learning experience.</p>
                                    <p>Gain access to test theory questions for each lesson presented, learning and testing yourself at your own pace.</p>
                                    <p>The lesson tests are a great way to embed Official DVSA practice questions and answers into your memory!</p>
				</div>
			</div>
			<div class="theoryPanDiv clearfix">
                               <h3>STAGE3</h3>
				<div class="theoryPanDivLt"><img src="<?php echo base_url();?>images/big-img3.jpg" /></div>
				<div class="theoryPanDivRt">
					<p>Completed the lesson learning and feeling more confident? It is now time to take some Official DVSA mock tests.</p>
                                        <p>The mock tests are designed based on Official DVSA questions, answers and explanations. The test has been designed to be just like the real test so you know what to expect come the day of your test.</p>
                                        <p>Take the test as many times as you like until you are confident of your learning. With randomisation, the test will never be the same, with a total of 50 questions each time and 60 minutes to complete.</p>
                                        <p>Each test is recorded following completion, so you can review your scores and progression through the tests!</p>
				</div>
			</div>
			<div class="theoryPanDiv clearfix">
                                <h3>STAGE4</h3>
				<div class="theoryPanDivLt"><img src="<?php echo base_url();?>images/big-img4.jpg" /></div>
				<div class="theoryPanDivRt">
					<p>Practice for your test with all of the Official DVSA hazard perception videos full with explanations and guidance notes.</p>
                                        <p>Now including the 10 Official DVSA Computer Generated Imagery (CGI) videos for a better learning experience. Test yourself as many times as you like until you are confident in identifying developing hazards.</p>
                                        <p>A developing hazard is something that may result in you having to take some action such as changing direction or speed.</p>
                                        <p>Learn when to click for the developing hazard, ensuring you score the highest possible for each video!</p>
				</div>
			</div>
		</div>
        <div class="fooLogoPan clearfix">
            <div class="logoDiv"><img src="<?php echo base_url();?>images/footer-logo.png" /></div>
           
            <div class="logoText">"Speak to your drivin g instructor today
to see about getting FREE ACCESS to
Official DVSA Approved and Licensed
training material"</div>
            <div class="logoDiv"><img src="<?php echo base_url();?>images/footer-logo.png" /></div>
        </div>
	</div>
</div>
<script>
	equalheight = function(container){
var currentTallest = 0,
     currentRowStart = 0,
     rowDivs = new Array(),
     $el,
     topPosition = 0;
 $(container).each(function() {
   $el = $(this);
   $($el).height('auto')
   topPostion = $el.position().top;
   if (currentRowStart != topPostion) {
     for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
       rowDivs[currentDiv].height(currentTallest);
     }
     rowDivs.length = 0; // empty the array
     currentRowStart = topPostion;
     currentTallest = $el.height();
     rowDivs.push($el);
   } else {
     rowDivs.push($el);
     currentTallest = (currentTallest < $el.height()) ? ($el.height()) : (currentTallest);
  }
   for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
     rowDivs[currentDiv].height(currentTallest);
   }
 });
}
$(window).load(function() {
  equalheight('.theoryPanDiv > div');
});
$(window).resize(function(){
  equalheight('.theoryPanDiv > div');
});
$(document).ajaxSuccess(function(){
  equalheight('.theoryPanDiv > div');
});
</script>