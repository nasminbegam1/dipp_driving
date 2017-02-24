<script type="text/javascript" src="<?php echo base_url();?>js/piechart.js"></script>
<style>
    /*------------------- pie chart start --------------------*/
.chart {
  width:300px;
  height:300px;
  margin:0;
}
.pieTip {
  position: absolute;
  float: left;
  min-width: 30px;
  max-width: 300px;
  padding: 5px 18px 6px;
  border-radius: 2px;
  background: rgba(255,255,255,.97);
  color: #444;
  font-size: 19px;
  text-shadow: 0 1px 0 #fff;
  text-transform: uppercase;
  text-align: center;
  line-height: 1.3;
  letter-spacing: .06em;
  box-shadow: 0 0 3px rgba(0,0,0,0.2), 0 1px 2px rgba(0,0,0,0.5);
  -webkit-transform: all .3s;
     -moz-transform: all .3s;
      -ms-transform: all .3s;
       -o-transform: all .3s;
          transform: all .3s;
  pointer-events: none;
}
.pieTip:after {
      position: absolute;
      left: 50%;
      bottom: -6px;
      content: "";
      height: 0;
      margin: 0 0 0 -6px;
      border-right: 5px solid transparent;
      border-left: 5px solid transparent;
      border-top: 6px solid rgba(255,255,255,.95);
      line-height: 0;
}
.chart path { cursor: pointer; }
/*--------------------------- pie chart end -----------------*/
</style>
<script>
    

/***********************/
$(function(){
  $("#pieChart").drawPieChart([
    { 	title: "Lesson Topics Learnt",    
		value : 2,  
		color: "#31c242"
	},
    { 
		title: "Lesson Topics Not Learnt",
		value:  10,
                color: "#d71921"
	 }
  ]);
});

</script>
<div class="wrap"> 
    <ul>
        <li><a href="<?php echo base_url().'student/editProfile'?>">Edit Profile</a></li>
        <li><a href="<?php echo base_url().'student/changePassword'?>">Change Password</a></li>
        <li><a href="<?php echo base_url().'student/logout'?>">Logout</a></li>
    </ul>
    
    <div class="clear pieChartSec">
            <ul>
              <li>
                <h3>Step 1 - Learn (Optional)</h3>
                  <div id="pieChart" class="chart"></div>
              </li>
            </ul>
    </div>
</div>