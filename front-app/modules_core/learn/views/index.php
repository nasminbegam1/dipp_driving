<script type="text/javascript" src="<?php echo base_url();?>js/circles.min.js"></script>
<style>
	.circle {
		display: inline-block;
		margin: 1em;
	}

	.circles-decimals {
		font-size: .4em;
	}
</style>


    <section id="fixedbanner">
        <!--<img src="<?php echo base_url().'images/Road_Graphic_NNN_FINAL-01.jpg'; ?>" alt="img" />   -->
    </section>
  
<section>
        <div class="container">
          <div class="imp-note">
            <h3><span>Hi <?php echo $this->session->userdata('STUDENT_FNAME');?>,</span></h3>
            <p>Welcome to the Learning Zone!</p>
            <p>Just work your way through the simple steps in the menus above and you'll find all you need to know to PASS your theory test!
            <br /> If at any time you're stuck and need help please email our support team.</p>
            <a href="javascript:void(0);" class="btn-gl">Good luck!</a>                  
          </div>
        </div>
      </section>
      <section>       
          <article>
            <div class="container">
              <div class="stu-login">                
                <h3 class="heading-txt">Your progress dashboard</h3>
              </div>
            </div>              
          </article>
          <article id="report-chart">
            <div class="container">                           
                <!--<p>Just score 90% or more in all of the Step 2 Modules and pass at least 10 of the step 3 Mock Tests before your real test.</p>-->
		<p class="xtra-para">It is recommended that you achieve 80% or more in all Stage 2 Lesson tests, your last 10 Stage 3 Mock tests and your last 10 Stage 4 Hazard Perception tests before you take your real test. By achieving 80% or more, you will meet our Pass Guarantee criteria, simply book your test through us to activate this.</p>
                <ul class="chart clearfix">
                  <li>
                   <h4>Lesson Test Mastery</h4>
		   <div class="circle" id="circles-1"></div>               
                  </li>
                  <li>
                   <h4>Mock Test Mastery</h4>
                   <div class="circle" id="circles-2"></div>                
                  </li>
                  <li class="circle-last">
                   <h4>Hazard Perception Test Mastery</h4>
                   <div class="circle" id="circles-3"></div>                  
                  </li>
                </ul>
             
            </div>              
          </article> 
      </section>
<script>
var circles = [];
var mocktestmastery = <?php echo number_format($mockTestMastery['mocktestmastery'],2); ?>;
if (parseFloat(mocktestmastery) > 80) {
  var mock_text = '<div style="color: #31C242;font-size: 58px !important;">'+mocktestmastery+'%<div>';
}else{
  var mock_text = '<div style="color: #ef0000;font-size: 58px !important;">'+mocktestmastery+'%<div>';
}

var practicetestmastery = <?php echo number_format($pactriceTestMastery['practicetestmastery'],2); ?>;
if (parseFloat(practicetestmastery) > 80) {
  var practice_text = '<div style="color: #31C242;font-size: 58px !important;">'+practicetestmastery+'%<div>';
}else{
  var practice_text = '<div style="color: #ef0000;font-size: 58px !important;">'+practicetestmastery+'%<div>';
}

var hazardTestMastery = <?php echo number_format($hazardTestMastery,2); ?>;
if (parseFloat(hazardTestMastery) > 80) {
  var hazard_text = '<div style="color: #31C242;font-size: 58px !important;">'+hazardTestMastery+'%<div>';
}else{
  var hazard_text = '<div style="color: #ef0000;font-size: 58px !important;">'+hazardTestMastery+'%<div>';
}
circles.push(Circles.create({
	id:         "circles-1",
	value:	    mocktestmastery,
	radius:     145,
	width:      10,
	text:       mock_text,
	colors:     ['#808080', '#31C242']
}));

circles.push(Circles.create({
	id:         "circles-2",
	value:	    practicetestmastery,
	radius:     145,
	width:      10,
	text:       practice_text,
	colors:     ['#808080', '#31C242']
}));

circles.push(Circles.create({
	id:         "circles-3",
	value:	    hazardTestMastery,
	radius:     145,
	width:      10,
	text:       hazard_text,
	colors:     ['#808080', '#31C242']
}));

//for (var i = 1; i <= 4; i++) {
//	var child = document.getElementById('circles-' + i),
//		percentage = 31.42 + (i * 9.84);
//
//	circles.push(Circles.create({
//		id:         child.id,
//		value:		percentage,
//		radius:     145,
//		width:      10,
//		//text:       percentage+'%',
//		colors:     ['#808080', '#31C242']
//	}));
//}
      

</script>
<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

ga('create', 'UA-85754672-1', 'auto');
ga('send', 'pageview');

</script>