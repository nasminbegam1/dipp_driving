<?php
if($video != 'introvideo'){
$video_id = $video[0]['id'];
    switch ($video_id) {
        case 1:
            echo '<link rel="stylesheet" type="text/css" href="'.base_url().'css/video/video-1.css" />';
            break;
        case 2:
            echo '<link rel="stylesheet" type="text/css" href="'.base_url().'css/video/video-2.css" />';
            break;
        case 3:
            echo '<link rel="stylesheet" type="text/css" href="'.base_url().'css/video/video-3.css" />';
            break;
        case 4:
            echo '<link rel="stylesheet" type="text/css" href="'.base_url().'css/video/video-4.css" />';
            break;
        case 5:
            echo '<link rel="stylesheet" type="text/css" href="'.base_url().'css/video/video-5.css" />';
            break;
        case 6:
            echo '<link rel="stylesheet" type="text/css" href="'.base_url().'css/video/video-6.css" />';
            break;
        case 7:
            echo '<link rel="stylesheet" type="text/css" href="'.base_url().'css/video/video-7.css" />';
            break;
        case 8:
            echo '<link rel="stylesheet" type="text/css" href="'.base_url().'css/video/video-8.css" />';
            break;
        case 9:
            echo '<link rel="stylesheet" type="text/css" href="'.base_url().'css/video/video-9.css" />';
            break;
        case 10:
            echo '<link rel="stylesheet" type="text/css" href="'.base_url().'css/video/video-10.css" />';
            break;
        case 11:
            echo '<link rel="stylesheet" type="text/css" href="'.base_url().'css/video/video-11.css" />';
            break;
        case 12:
            echo '<link rel="stylesheet" type="text/css" href="'.base_url().'css/video/video-12.css" />';
            break;
        case 13:
            echo '<link rel="stylesheet" type="text/css" href="'.base_url().'css/video/video-13.css" />';
            break;
        case 14:
            echo '<link rel="stylesheet" type="text/css" href="'.base_url().'css/video/video-14.css" />';
            break;
        case 15:
            echo '<link rel="stylesheet" type="text/css" href="'.base_url().'css/video/video-15.css" />';
            break;
        case 16:
            echo '<link rel="stylesheet" type="text/css" href="'.base_url().'css/video/video-16.css" />';
            break;
        case 17:
            echo '<link rel="stylesheet" type="text/css" href="'.base_url().'css/video/video-17.css" />';
            break;
        case 18:
            echo '<link rel="stylesheet" type="text/css" href="'.base_url().'css/video/video-18.css" />';
            break;
        case 19:
            echo '<link rel="stylesheet" type="text/css" href="'.base_url().'css/video/video-19.css" />';
            break;
        case 20:
            echo '<link rel="stylesheet" type="text/css" href="'.base_url().'css/video/video-20.css" />';
            break;
        case 21:
            echo '<link rel="stylesheet" type="text/css" href="'.base_url().'css/video/video-21.css" />';
            break;
        case 22:
            echo '<link rel="stylesheet" type="text/css" href="'.base_url().'css/video/video-22.css" />';
            break;
        case 23:
            echo '<link rel="stylesheet" type="text/css" href="'.base_url().'css/video/video-23.css" />';
            break;
        case 24:
            echo '<link rel="stylesheet" type="text/css" href="'.base_url().'css/video/video-24.css" />';
            break;
        case 25:
            echo '<link rel="stylesheet" type="text/css" href="'.base_url().'css/video/video-25.css" />';
            break;
        case 26:
            echo '<link rel="stylesheet" type="text/css" href="'.base_url().'css/video/video-26.css" />';
            break; 
        default:
            break;
    }
}
?>

<div class="hazard-perception clearfix">
    <h4>Hazard Perception Videos</h4>
    <div class="lnks">
    <a href="<?php echo base_url().'learn'; ?>">Learning zone</a>
    <div id="back_to_video">Back to video</div>
    </div>
    </div>

<div style="display: none !important;" id="NEXT" data-stop="0" data-prev="a">NEXT</div>
<div class="vidCon">
    <?php if($video == 'introvideo'){ ?>
<div id="videoes" class="video-resize clearfix" style="opacity:1;">
	<div>
		<video class="video-resize"></video>
	</div>
	<div class="video-play"></div><div class="video-ui video-resize width-only">
		<div class="video-ui-progress"></div>
	</div>
</div>
<?php }else{ ?>

<div id="video" class="video-resize clearfix">
	<div class="video-annotations">
		<div class="va-circle"></div>
		<div class="va-square"></div>
		<div class="text"></div>
	</div>
	<div class="video-overlay" style="display: block;">
		<p>Your video is ready.<br>Click the play button to start the video and take your test.<br>Click the video as it plays, each time you see a developing hazard.<br>Your score will be shown at the end of the video.<br>Do not click rapidly, in a pattern or excessively, as you may score 0.</p>
	</div>
	<div class="video-score" style="display: none;">
		<p>You scored <span class="video-score-text">5</span> point(s) out of 5.</p>
		<p class="video-msg">Congratulations, if you consistently score like this you have a good chance of passing your real test!</p>
		<div class="button video-review">Show answers</div>
		<div class="button video-retake">Take test again</div>
	</div>
	<div>
		<video class="video-resize"></video><div class="copy">Copyright &copy; The Driver and Vehicle Standards Agency and Dutchurst Solutions Ltd</div>
	</div>
	<div class="video-play" data-attr="<?php echo $video[0]['id']; ?>"></div><div class="video-ui video-resize width-only">
		<div class="video-ui-progress"></div>
	</div>
</div>
<?php } ?>
</div>
<div class="btm"></div>
<script type="text/javascript">
$(document).ready(function() {
    <?php if($video == 'introvideo'){ ?>
	$("#videoes").interactive({
		hazards: [],
		scoring: [],
		annotations: [],
		videoFile: "<?php echo base_url();?>/videos/HP Introduction.mp4"
	});
	<?php }else{ ?>
        var video_id = '<?php echo $video[0]['id']?>';
        if (video_id == 1) {
	$("#video").interactive({
            
		hazards: [{t: 19.2,c: "c-4 cv_move",d: 5000}],
		scoring: [{t: 19.2,s: 5,c: "c"},
                          {t: 20.2,s: 4},
                          {t: 21.2,s: 3},
                          {t: 22.2,s: 2},
                          {t: 23.2,s: 1}],
		annotations: [{
			t: 8.1,
			c: "va-circle",
			d: "c-1",
			e: "a-1",
			a: "There is an oncoming vehicle entering the narrow tunnel up ahead. Approach cautiously in case the vehicle suddenly stops inside the tunnel.",
			color: "y" 
		}, {
			t: 17.1,
			c: "va-circle",
			d: "c-2",
			e: "a-2",
			a: "There is an oncoming vehicle entering the narrow tunnel up ahead. Approach cautiously in case the vehicle suddenly stops inside the tunnel.",
			color: "y"
		}, {
			t: 18.1,
			c: "va-square",
			d: "c-3",
			e: "a-3",
			a: "The road sign advises you that there is a height restriction for the tunnel. It also notifies you of the road narrowing. Continue cautiously in case of oncoming vehicles entering the tunnel from the opposite direction.",
			color: "b"
		}, {
			t: 19.2,
			c: "va-circle",
			d: "c-4",
			e: "a-4",
			a: "There is a vehicle approaching the tunnel from a blind bend. Be prepared to slow down in case the driver of the oncoming vehicle has not seen you and is not intending on giving way to you. The road signs on your side of the tunnel do not indicate who has priority. <br><div class='va-score'>Score 5</div>",
			color: "r"
		}, {		
			t: 20.2,
			c: "va-circle",
			d: "c-5",
			e: "a-5",
			a: "The vehicle is still approaching the tunnel. Reduce your speed in case the other vehicle does not stop.<br><div class='va-score'>Score 4</div>",
			color: "r"
		}, {
			t: 21.2,
			c: "va-circle",
			d: "c-6",
			e: "a-6",
			a: "The vehicle is still approaching the tunnel. Reduce your speed in case the other vehicle does not stop.<br><div class='va-score'>Score 3</div>",
			color: "r"
		}, {
			t: 22.2,
			c: "va-circle",
			d: "c-7",
			e: "a-7",
			a: "It is not clear who is closest to the tunnel. There are still no priority road signs. Reduce your speed.<br><div class='va-score'>Score 2</div>",
			color: "r"
		}, {
			t: 22.3,
			c: "va-square",
			d: "c-15",
			e: "a-15",
			a: "The road sign confirms the height restriction of the tunnel. Make sure you are aware of your vehicle's height and that your vehicle will fit through the tunnel comfortably.",
			color: "b"
		},
		{
			t: 23.2,
			c: "va-circle",
			d: "c-8",
			e: "a-8",
			a: "It is not clear who is closest to the tunnel. There are still no priority road signs. Reduce your speed. <div class='va-score'>Score 1</div>",
			color: "r"
		}, {
			t: 35.1,
			c: "va-square",
			d: "c-9",
			e: "a-9",
			a: "A dip in the fencing ahead could mean a dip in the road as you travel round the corner. Continue cautiously and be aware of oncoming traffic as well as pedestrians walking towards you.",
			color: "b"
		}, {
			t: 48.2,
			c: "va-square",
			d: "c-10",
			e: "a-10",
			a: "This road sign prompts you to be aware of cattle that could be surrounding or crossing the road. It also points out that there is a bridge up ahead. Continue cautiously.",
			color: "b"
		}, {
			t: 51.1,
			c: "va-circle",
			d: "c-11",
			e: "a-11",
			a: "There is a bridge up ahead. You cannot see oncoming vehicles or pedestrians that could be approaching from the other side. This means that oncoming traffic cannot see you either. The bridge looks narrow and there are no priority road signs so be prepared to slow down and stop.",
			color: "y"
		}, {
			t: 53.1,
			c: "va-square",
			d: "c-12",
			e: "a-12",
			a: "This road sign shows the maximum weight that the bridge can take. Make sure you're aware of how much your vehicle weighs before continuing over the bridge. If your vehicle is too heavy, find an alternative route.",
			color: "b"
		}, {
			t: 58.2,
			c: "va-circle",
			d: "c-13",
			e: "a-13",
			a: "You can see an oncoming vehicle that has just turned round a blind bend. Continue cautiously just in case the other driver has not seen you yet.",
			color: "y"
		}],
		videoFile: "<?php echo base_url();?>/videos/<?php echo $video[0]['video_name']; ?>",
		videoFileReview: "<?php echo base_url();?>/videos/<?php echo $video[0]['video_review_name']; ?>",
	});
        }else if (video_id == 2) {
            $("#video").interactive({
		hazards: [{
			t: 32.5,c: "c-5 cv_move",d: 3000,
		}],
		
		scoring: [{t: 32.5,s: 5,c: "c"},
                          {t: 33.3,s: 4},
                          {t: 34.1,s: 3},
                          {t: 34.8,s: 2},
                          {t: 35.4,s: 1}],
		annotations: [{
			t: 4,
			c: "va-square",
			d: "c-1",
			e: "a-1",
			a: "The road sign indicates that there are traffic calming measures ahead. Reducing your speed will improve your awareness of these measures.",
			color: "b" 
		}, {
			t: 7.8,
			c: "va-square",
			d: "c-2",
			e: "a-2",
			a: "From the left of the road you can see a large amount of trees and bushes, which are likely to be wild animals' habitats. Continue cautiously and be aware of wild animals running into the road.",
			color: "b"
		}, {
			t: 17,
			c: "va-square",
			d: "c-3",
			e: "a-3",
			a: "There is a well hidden pedestrian to the right of the road. As the pedestrian is difficult to see, their actions may not be seen by oncoming vehicles. Continue cautiously.",
			color: "b"
		}, {
			t: 26,
			c: "va-square",
			d: "c-4",
			e: "a-4",
			a: "To the left of the road is a pedestrian who is about to walk behind a lamp post. Be aware of the pedestrian because they may decide to cross the road from behind the lamp post without looking.",
			color: "b"
		}, {		
			t: 32.5,
			c: "va-circle",
			d: "c-5",
			e: "a-5",
			a: "It looks like the cyclist ahead is about to join the road you're travelling on. The cyclist hasn't looked to see how their actions will affect you and the other road users. Reduce your speed in case the cyclist doesn't stop before at the junction to give way.<br><div class='va-score'>Score 5</div>",
			color: "r"
		}, {
			t: 33.3,
			c: "va-circle",
			d: "c-6",
			e: "a-6",
			a: "The cyclist has still not looked to see whether any traffic is approaching and has shown no signs of reducing their speed. Reduce your speed further in case the cyclist doesn't stop behind the give way road markings.<br><div class='va-score'>Score 4</div>",
			color: "r"
		}, {
			t: 34.1,
			c: "va-circle",
			d: "c-7",
			e: "a-7",
			a: "The cyclist has now  joined the road you're travelling on. Whilst the cyclist is travelling at a fast speed, they are not travelling as fast as you. Reduce your speed further.<br><div class='va-score'>Score 3</div>",
			color: "r"
		}, {
			t: 34.8,
			c: "va-circle",
			d: "c-8",
			e: "a-8",
			a: "You are getting closer to the cyclist. Reduce your speed to give yourself enough time to take further action.<br><div class='va-score'>Score 2</div>",
			color: "r"
		}, {
			t: 35,
			c: "va-square",
			d: "c-9",
			e: "a-9",
			a: "A pedestrian is walking along the past.  They could walk out into the road at any time.  Continue cautiously.",
			color: "b"
		}, {
			t: 35.4,
			c: "va-circle",
			d: "c-10",
			e: "a-10",
			a: "The cyclist is now directly in front of your vehicle. Maintain a safe distance and suitable speed until you feel it is safe to overtake and continue. This was a developing hazard as the cyclist joined the road you're travelling on without stopping and giving way, causing you to reduce your speed.<br><div class='va-score'>Score 1</div>",
			color: "r"
		}, {
			t: 46,
			c: "va-circle",
			d: "c-11",
			e: "a-11",
			a: "Be aware of oncoming traffic when overtaking. Oncoming vehicles may also be overtaking or, for larger vehicles, swinging out right to compensate for a left turn. Always check to see how your actions are going to affect the other road users.",
			color: "y"
		}, {
			t: 50,
			c: "va-circle",
			d: "c-12",
			e: "a-12",
			a: "There is a pedestrian to the left of the road who is about to walk behind a large tree. As the pedestrian becomes hidden behind the tree, continue cautiously until you see them again. They may decide to cross the road without looking.",
			color: "y"
		}, {
			t: 57,
			c: "va-circle",
			d: "c-13",
			e: "a-13",
			a: "As you approach the mini roundabout remember to give way to your right. Always reduce your speed on approach and remember that not all road users are as visible as cars or lorries.",
			color: "y"
		}],
		videoFile: "<?php echo base_url();?>/videos/<?php echo $video[0]['video_name']; ?>",
		videoFileReview: "<?php echo base_url();?>/videos/<?php echo $video[0]['video_review_name']; ?>",
	});
        }else if (video_id == 3) {
            $("#video").interactive({
		hazards: [{
			t: 28.1,
			c: "c-6 cv_move",
			d: 4500,
		}],

		scoring: [{
			t: 28.1,
			s: 5,
			c: "c"
		}, {
			t: 29.5,
			s: 4
		}, {
			t: 30.5,
			s: 3
		}, {
			t: 31.7,
			s: 2
		}, {
			t: 32.5,
			s: 1
		}],
		annotations: [{
			t: 2,
			c: "va-circle",
			d: "c-1",
			e: "a-1",
			a: "You see a parked car slightly protruding the road you're travelling on. As you drive towards and past the parked car, remain alert to pedestrians or cyclists who may have to enter the road in order to continue on the path.",
			color: "y" 
		}, {
			t: 6,
			c: "va-square",
			d: "c-2",
			e: "a-2",
			a: "A pedestrian is walking along the pavement. Keep an eye on them in case they decide to cross the road without looking.",
			color: "b"
		}, {
			t: 18,
			c: "va-circle",
			d: "c-3",
			e: "a-3",
			a: "There is a pedestrian to the left of the road who is about to walk behind a lamp post. Keep an eye on this pedestrian in case they decide to cross the road from behind the lamp post without looking.",
			color: "y"
		}, {
			t: 20,
			c: "va-square",
			d: "c-4",
			e: "a-4",
			a: "The road sign to the left indicates that there is a school nearby. Reduce your speed and continue cautiously in case there are children playing close to the road or people crossing.",
			color: "b"
		}, {
			t: 22,
			c: "va-circle",
			d: "c-5",
			e: "a-5",
			a: "A car has just come into view up ahead. There is a side road up to the left of the road you're travelling on. The oncoming car's intentions are not clear from this distance so reduce your speed to give yourself plenty of time to react - the car could decide to turn into the junction.",
			color: "y"
		}, {
			t: 28.1,
			c: "va-circle",
			d: "c-6",
			e: "a-6",
			a: "A learner driver has just driven away from a junction to join the road you're travelling on. Learner drivers are, in most cases, inexperienced. Bear this in mind and reduce your speed.<br><div class='va-score'>Score 5</div>",
			color: "r"
		}, {
			t: 29.5,
			c: "va-circle",
			d: "c-7",
			e: "a-7",
			a: "A learner driver has just driven away from a junction to join the road you're travelling on. Learner drivers are, in most cases, inexperienced. Bear this in mind and reduce your speed.<br><div class='va-score'>Score 4</div>",
			color: "r"
		}, {
			t: 30.5,
			c: "va-circle",
			d: "c-8",
			e: "a-8",
			a: "The learner driver has not yet reached the correct side of the road. Reduce your speed further to allow them plenty of time and space to complete the manoeuvre.<br><div class='va-score'>Score 3</div>",
			color: "r"
		}, {
			t: 31.7,
			c: "va-circle",
			d: "c-9",
			e: "a-9",
			a: "The learner driver has started to enter the correct side of the road but still has a few metres to travel. There are parked cars and oncoming vehicles for the learner driver to consider. Continue to reduce your speed to relieve pressure from the learner driver and to keep a safe distance.<br><div class='va-score'>Score 2</div>",
			color: "r"
		}, {
			t: 32.5,
			c: "va-circle",
			d: "c-10",
			e: "a-10",
			a: "There are parked cars and oncoming vehicles ahead, which will stop the learner drive from continuing until they have assessed the situation. Reduce your speed further. This was a developing hazard as the learner driver pulled out of the junction and caused you to slow down and stop.<br><div class='va-score'>Score 1</div>",
			color: "r"
		}, {
			t: 47.3,
			c: "va-circle",
			d: "c-11",
			e: "a-11",
			a: "The learner driver has signalled to turn right. Learner drivers tend to be inexperienced and may take their time in completing a manoeuvre. Slow down and allow the learner driver plenty of time and space to complete the turn.",
			color: "y"
		}],
		videoFile: "<?php echo base_url();?>/videos/<?php echo $video[0]['video_name']; ?>",
		videoFileReview: "<?php echo base_url();?>/videos/<?php echo $video[0]['video_review_name']; ?>",
	});
        }else if (video_id == 4) {
            $("#video").interactive({
		hazards: [{
			t: 31.2,
			c: "c-5 cv_move",
			d: 4400,
		}],

		scoring: [{
			t: 31.2,
			s: 5,
			c: "c"
		}, {
			t: 32.5,
			s: 4
		}, {
			t: 33.4,
			s: 3
		}, {
			t: 34.4,
			s: 2
		}, {
			t: 35.4,
			s: 1
		}],
		annotations: [{
			t: 2.5,
			c: "va-square",
			d: "c-1",
			e: "a-1",
			a: "There is a parked van up ahead to the left. The rear door is open which suggests a pedestrian is nearby. Continue cautiously just in case a pedestrian walks into the road from in front of the van.",
			color: "b" 
		}, {
			t: 6.8,
			c: "va-circle",
			d: "c-2",
			e: "a-2",
			a: "You can see parked cars up ahead. Continue cautiously and be aware of vehicle doors opening, or people walking or running between cars onto the road.",
			color: "y"
		}, {
			t: 18.6,
			c: "va-circle",
			d: "c-3",
			e: "a-3",
			a: "You can see more parked cars up ahead. Continue cautiously and be aware of vehicle doors opening, or people walking or running between cars onto the road.",
			color: "y"
		}, {
			t: 26,
			c: "va-circle",
			d: "c-4",
			e: "a-4",
			a: "There is a large van parked up ahead covering the exit of the side road. Look out for pedestrians crossing behind the vehicle and vehicles looking to exit the side road.",
			color: "y"
		}, {
			t: 31.2,
			c: "va-circle",
			d: "c-5",
			e: "a-5",
			a: "There are two pedestrians walking behind the large van from the side road to the right. It doesn't look like they have seen you yet. Approach cautiously.<br><div class='va-score'>Score 5</div>",
			color: "r"
		}, {
			t: 32.5,
			c: "va-circle",
			d: "c-6",
			e: "a-6",
			a: "The pedestrians are not yet hidden by the van, however, it is  not clear whether they plan to start crossing or stop. Reduce your speed.<br><div class='va-score'>Score 4</div>",
			color: "r"
		}, {
			t: 33.4,
			c: "va-circle",
			d: "c-7",
			e: "a-7",
			a: "The pedestrians are now completely hidden by the van. It is still not clear  whether they have started crossing or have stopped. Continue to reduce your speed.<br><div class='va-score'>Score 3</div>",
			color: "r"
		}, {
			t: 34.4,
			c: "va-circle",
			d: "c-8",
			e: "a-8",
			a: "The pedestrians have not yet emerged from behind the van. Slow down to give way to them just in case they are crossing and have still not seen you.<br><div class='va-score'>Score 2</div>",
			color: "r"
		}, {
			t: 35.4,
			c: "va-circle",
			d: "c-9",
			e: "a-9",
			a: "Both pedestrians are now in the middle of the road and don't show any signs of returning back to allow you to continue. Stop the vehicle until they have safely reached the other side of the road. This was a developing hazard as the pedestrians caused you to slow down and stop.<br><div class='va-score'>Score 1</div>",
			color: "r"
		}, {
			t: 48,
			c: "va-circle",
			d: "c-10",
			e: "a-10",
			a: "There are two vans parked on your side of the road. As you approach the bend be aware that you will have to give way to oncoming vehicles, if there is not enough space for you to continue. Continue cautiously as you approach the blind bend in case there are oncoming vehicles. Use reflections off of house windows to help improve your vision of approaching vehicles.",
			color: "y"
		},	{
			t: 48.5,
			c: "va-square",
			d: "c-10 c-10-b",
			e: "a-10",
			a: "There are two vans parked on your side of the road. As you approach the bend be aware that you will have to give way to oncoming vehicles, if there is not enough space for you to continue. Continue cautiously as you approach the blind in case there are oncoming vehicles. Use reflections off of house windows to help improve your vision of approaching vehicles.",
			color: "b"
		},
		
		],
		videoFile: "<?php echo base_url();?>/videos/<?php echo $video[0]['video_name']; ?>",
		videoFileReview: "<?php echo base_url();?>/videos/<?php echo $video[0]['video_review_name']; ?>",
	});
        }else if (video_id == '5') {
            $("#video").interactive({
		hazards: [{
			t: 32.5,
			c: "c-7 cv_move",
			d: 8000,
		}],

		scoring: [{
			t: 32.5,
			s: 5,
			c: "c"
		}, {
			t: 34.5,
			s: 4
		}, {
			t: 35.5,
			s: 3
		}, {
			t: 37.5,
			s: 2
		}, {
			t: 39,
			s: 1
		}],
		annotations: [{
			t: 10.4,
			c: "va-circle",
			d: "c-1",
			e: "a-1",
			a: "There is a van parked on your side of the road. Remember, you have to give way to oncoming vehicles if there is not enough space for you to continue. Continue cautiously just in case.",
			color: "y" 
		}, {
			t: 12.7,
			c: "va-square",
			d: "c-2",
			e: "a-2",
			a: "There is a roadworks sign just to the left of the van. Continue carefully as there may be maintenance workers on or close to the road.",
			color: "b"
		}, {
			t: 17.5,
			c: "va-square",
			d: "c-3",
			e: "a-3",
			a: "The road sign to the left indicates that the road is narrowing ahead, with your side of the road merging closer to the opposite side of the road. Continue slowly to avoid incidents with oncoming traffic.",
			color: "b"
		}, {
			t: 19.2,
			c: "va-circle",
			d: "c-4",
			e: "a-4",
			a: "There is a maintenance worker to the left. The worker is slightly hidden by the surrounding trees. Be aware that the worker may be working on something that could result in debris being thrown towards, or onto, the road. Continue cautiously.",
			color: "y"
		}, {
			t: 20.2,
			c: "va-circle",
			d: "c-5",
			e: "a-5",
			a: "There is a van parked on your side of the road. Remember, you have to give way to oncoming vehicles if there is not enough space for you to continue. You can also see two pedestrians up ahead on the pavement to your right. Be aware of them in case they haven't seen you and decide to cross the road. Continue cautiously just in case.",
			color: "y"
		}, {
			t: 30,
			c: "va-circle",
			d: "c-6",
			e: "a-6",
			a: "There are two cars parked on the other side of the road right next to a side road. Although oncoming vehicles have to give way to you, it doesn't mean they will. Approach cautiously in case you need to stop to give way to vehicles already travelling past the parked vehicles.",
			color: "y"
		}, {
			t: 32.5,
			c: "va-circle",
			d: "c-7",
			e: "a-7",
			a: "There is a tractor pulling out of the side road up ahead. It isn't clear from this distance what direction the tractor will be turning. Tractors tend to be slower than most motorised vehicles so reduce your speed just in case the tractor decides to pull out.<br><div class='va-score'>Score 5</div>",
			color: "r"
		}, {
			t: 34.5,
			c: "va-circle",
			d: "c-8",
			e: "a-8",
			a: "It still isn't clear from this distance what direction the tractor will be turning. Slow down even more to ensure that the tractor has plenty of time and space should the tractor's driver decide to pull out.<br><div class='va-score'>Score 4</div>",
			color: "r"
		}, {
			t: 35.5,
			c: "va-circle",
			d: "c-9",
			e: "a-9",
			a: "There is now a car approaching from the opposite direction. Slow down further to give yourself enough time to react to the actions of both drivers.<br><div class='va-score'>Score 3</div>",
			color: "r"
		}, {
			t: 37.5,
			c: "va-circle",
			d: "c-10",
			e: "a-10",
			a: "The tractor has now emerged from the side road and has started to move round the parked vehicles. Slow down and leave enough space for the tractor to complete it's manoeuvre. Be aware of the oncoming vehicle in the distance as the driver may not see you and decide to follow the tractor round the parked vehicles.<br><div class='va-score'>Score 2</div>",
			color: "r"
		}, {
			t: 39,
			c: "va-circle",
			d: "c-11",
			e: "a-11",
			a: "The tractor is now on your side of the road and is stopping you from continuing. Again, leave enough room for the tractor to complete its manoeuvre and remember that there is a car behind it. This was a developing hazard because the tractor turning out of the junction on your side of the road caused you to stop.<br><div class='va-score'>Score 1</div>",
			color: "r"
		}],
		videoFile: "<?php echo base_url();?>/videos/<?php echo $video[0]['video_name']; ?>",
		videoFileReview: "<?php echo base_url();?>/videos/<?php echo $video[0]['video_review_name']; ?>",
	});
        }else if (video_id == 6) {
            $("#video").interactive({
		hazards: [{
			t: 15.7,
			c: "c-4 cv_move",
			d: 9000,
		}],

		scoring: [{
			t: 15.7,
			s: 5,
			c: "c"
		}, {
			t: 16.8,
			s: 4
		}, {
			t: 19.3,
			s: 3
		}, {
			t: 21.2,
			s: 2
		}, {
			t: 23.5,
			s: 1
		}],
		
		annotations: [{
			t: 2.0,
			c: "va-square",
			d: "c-1",
			e: "a-1",
			a: "This road sign points out that for the next half of a mile the road may be slippery. Be aware of this, continue cautiously and always consider how your actions will affect other road users.",
			color: "b" 
		}, {
			t: 5.3,
			c: "va-circle",
			d: "c-2",
			e: "a-2",
			a: "There is a car approaching the give way road marking from the side road to the left. Reduce your speed just in case they force their way out in front of you.",
			color: "y"
		}, {
			t: 8.6,
			c: "va-square",
			d: "c-3",
			e: "a-3",
			a: "There is another road sign idicating that the road ahead is slippery. Continue cautiously.",
			color: "b"
		}, {
			t: 15.7,
			c: "va-circle",
			d: "c-4",
			e: "a-4",
			a: "There is a large white van up ahead in a lay-by. The vehicle appears to be making its way towards the exit of the lay-by to merge onto the main road. Start to reduce your speed because the van could end up forcing its way in front of another vehicle.<br><div class='va-score'>Score 5</div>",
			color: "r"
		}, {
			t: 16.8,
			c: "va-circle",
			d: "c-5",
			e: "a-5",
			a: "The vehicle is taking longer than expected to join the main road. As you get closer, it is increasingly likely that the van will want to join in front of you or in front of the motorcycle ahead of you. Reduce your speed to allow enough time to react to any given situation.<br><div class='va-score'>Score 4</div>",
			color: "r"
		}, {
			t: 19.3,
			c: "va-circle",
			d: "c-6",
			e: "a-6",
			a: "The van is starting to get closer to the main road. Increase the distance between you and the motorcycle in front to leave enough time for you to react to an unexpected situation.<br><div class='va-score'>Score 3</div>",
			color: "r"
		}, {
			t: 21.2,
			c: "va-circle",
			d: "c-7",
			e: "a-7",
			a: "The van is still travelling slowly but is about to join the main road. Its speed doesn't match the speed of traffic already on the road, so reduce your speed further and increase the distance between you and the vehicle in front.<br><div class='va-score'>Score 2</div>",
			color: "r"
		}, {
			t: 23.5,
			c: "va-circle",
			d: "c-8",
			e: "a-8",
			a: "The van is just about to join the main road, albeit at a slower speed to the traffic already travelling on the road. This was a developing hazard because the van joining the main road caused you to slow down. <br><div class='va-score'>Score 1</div>",
			color: "r"
		}, {
			t: 42.5,
			c: "va-circle",
			d: "c-9",
			e: "a-9",
			a: "An oncoming vehicle appears to be tailgating. Reduce your speed to give yourself enough time to react to any unexpected situations.",
			color: "y"
		}],
		videoFile: "<?php echo base_url();?>/videos/<?php echo $video[0]['video_name']; ?>",
		videoFileReview: "<?php echo base_url();?>/videos/<?php echo $video[0]['video_review_name']; ?>",
	});
        }else if (video_id == 7) {
            $("#video").interactive({
		hazards: [{
			t: 44.2,
			c: "c-5 cv_move",
			d: 9000,
		}],

		scoring: [{
			t: 44.2,
			s: 5,
			c: "c"
		}, {
			t: 46,
			s: 4
		}, {
			t: 47.2,
			s: 3
		}, {
			t: 49,
			s: 2
		}, {
			t: 50.2,
			s: 1
		}],
		
		annotations: [{
			t: 21.3,
			c: "va-circle",
			d: "c-1",
			e: "a-1",
			a: "A car has pulled up on the left hand side of the road you're travelling on. They are facing your direction and are slightly obstructing your side of the road. Reduce your speed in case the car doors open or it decides to pull away as you get closer.",
			color: "y" 
		}, {
			t: 27,
			c: "va-square",
			d: "c-2",
			e: "a-2",
			a: "Ahead are two signs alerting you to the mini roundabout. Remember to give way to your right, keep an eye out for cyclists and motorcyclists and be aware of vehicles executing U-turns.",
			color: "b"
		}, {
			t: 31,
			c: "va-square",
			d: "c-3",
			e: "a-3",
			a: "The smaller road sign to your left shows that cyclists, adults, and children use this crossing. You are not required to give way to users of this crossing, but be aware that they may misjudge your speed. Approach this crossing cautiously.",
			color: "b"
		}, {
			t: 34.5,
			c: "va-square",
			d: "c-4",
			e: "a-4",
			a: "There are two pedestrians walking parallel to the road you're travelling on. There are a number of crossings along this road so remain cautious just in case they decide to cross the road without looking.",
			color: "b"
		}, {
			t: 44.2,
			c: "va-circle",
			d: "c-5",
			e: "a-5",
			a: "The cyclist ahead has started to signal that they want to move right. Reduce your speed to allow them and the vehicle in front plenty of time and space to act appropriately.<br><div class='va-score'>Score 5</div>",
			color: "r"
		}, {
			t: 46,
			c: "va-circle",
			d: "c-6",
			e: "a-6",
			a: "The cyclist has started to move right to avoid the road narrowing ahead. The vehicle in front has also started moving right to avoid the cyclist. Reduce your speed to allow the cyclist time to move into the centre of the road.<br><div class='va-score'>Score 4</div>",
			color: "r"
		}, {
			t: 47.2,
			c: "va-circle",
			d: "c-7",
			e: "a-7",
			a: "The cyclist has now moved into the centre of the road but they are very close to the vehicle in front. Reduce your speed further in case the vehicle in front brakes suddenly.<br><div class='va-score'>Score 3</div>",
			color: "r"
		}, {
			t: 49,
			c: "va-circle",
			d: "c-8",
			e: "a-8",
			a: "The vehicle in front has now completely overtaken the cyclist and moved back to the centre of the road. Continue to reduce your speed to allow the cyclist plenty of time to complete their next manoeuvre.<br><div class='va-score'>Score 2</div>",
			color: "r"
		}, {
			t: 49.3,
			c: "va-square",
			d: "c-9",
			e: "a-9",
			a: "The road sign to the left indicates that there is a school nearby. Reduce your speed and continue cautiously in case there are children playing close to the road or people crossing the road.",
			color: "b"
		}, {
			t: 50.2,
			c: "va-circle",
			d: "c-10",
			e: "a-10",
			a: "The cyclist has now started to signal right and appears to be moving into a central reservation in order to turn right into the next side road. Reduce your speed to allow them time and space to do this. This was a developing hazard as the cyclist moving into the centre of the road caused you to slow down.<br><div class='va-score'>Score 1</div>",
			color: "r"
		}],
		videoFile: "<?php echo base_url();?>/videos/<?php echo $video[0]['video_name']; ?>",
		videoFileReview: "<?php echo base_url();?>/videos/<?php echo $video[0]['video_review_name']; ?>",
	});
        }else if (video_id == 8) {
            $("#video").interactive({
		hazards: [{
			t: 30,
			c: "c-3 cv_move",
			d: 9000,
		}],

		scoring: [{
			t: 30,
			s: 5,
			c: "c"
		}, {
			t: 32,
			s: 4
		}, {
			t: 33.8,
			s: 3
		}, {
			t: 36,
			s: 2
		}, {
			t: 39,
			s: 1
		}],
		
		annotations: [{
			t: 4.7,
			c: "va-square",
			d: "c-1",
			e: "a-1",
			a: "There is a lay-by up ahead. There are no vehicles looking to join the main road from it. However, you must be aware of overtaking vehicles that may cut in front of you to access the lay-by and pedestrians that could be walking nearby.",
			color: "b" 
		}, {
			t: 27,
			c: "va-square",
			d: "c-2",
			e: "a-2",
			a: "There is a road sign indicating that there is a crossroads junction up ahead. Continue cautiously just in case vehicles choose to join the main road or cross the junction after misjudging your speed.",
			color: "b"
		}, {
			t: 30,
			c: "va-circle",
			d: "c-3",
			e: "a-3",
			a: "A large lorry has started to turn into a central reservation ready to join the main road you're travelling on. Reduce your speed in case they start to emerge.<br><div class='va-score'>Score 5</div>",
			color: "r"
		}, {
			t: 32,
			c: "va-circle",
			d: "c-4",
			e: "a-4",
			a: "The lorry has started to join the main road. Given its size, it may take a while to complete its manoeuvre. Reduce your speed further.<br><div class='va-score'>Score 4</div>",
			color: "r"
		}, {
			t: 33.8,
			c: "va-circle",
			d: "c-5",
			e: "a-5",
			a: "The lorry has covered the right hand lane of your side of the dual carriageway. The driver may not have seen you approaching, so slow down even more to allow the lorry plenty of time to join the road.<br><div class='va-score'>Score 3</div>",
			color: "r"
		}, {
			t: 36,
			c: "va-circle",
			d: "c-6",
			e: "a-6",
			a: "The lorry has now completely covered both lanes. It isn't clear if the lorry will actually complete its manoeuvre in the space available. Slow down to allow the lorry space to complete the manoeuvre or to adjust itself in order to complete the turn, if required.<br><div class='va-score'>Score 2</div>",
			color: "r"
		}, {
			t: 39,
			c: "va-circle",
			d: "c-7",
			e: "a-7",
			a: "The lorry has nearly completed the turn but is still taking up two lanes preventing you from continuing. This was a developing hazard as the lorry joining the dual carriageway caused you to slow down.<br><div class='va-score'>Score 1</div>",
			color: "r"
		}, {
			t: 52,
			c: "va-circle",
			d: "c-8",
			e: "a-8",
			a: "There is a caravan in a lay-by to the left. Avoid moving into the left lane just in case the caravan is looking to rejoin the main carriageway, which isn't clear from this distance. Also, reduce your speed for potential pedestrians surrounding the caravan.",
			color: "y"
		}],
		videoFile: "<?php echo base_url();?>/videos/<?php echo $video[0]['video_name']; ?>",
		videoFileReview: "<?php echo base_url();?>/videos/<?php echo $video[0]['video_review_name']; ?>",
	});
        }else if (video_id == 9) {
            $("#video").interactive({
		hazards: [{
			t: 34.2,
			c: "c-4 cv_move",
			d: 4000,
		}],

		scoring: [{
			t: 34.2,
			s: 5,
			c: "c"
		}, {
			t: 35.4,
			s: 4
		}, {
			t: 36.8,
			s: 3
		}, {
			t: 37.1,
			s: 2
		}, {
			t: 38,
			s: 1
		}],
		
		annotations: [{
			t: 3.7,
			c: "va-circle",
			d: "c-1",
			e: "a-1",
			a: "There is a car parked to the right on a slight incline. Reduce your speed just in case the vehicle starts to roll back or reverses into your path. Also, be aware of pedestrians potentially walking out from behind the parked vehicle.",
			color: "y" 
		}, {
			t: 6.2,
			c: "va-circle",
			d: "c-2",
			e: "a-2",
			a: "There is a car parked to the right on a slight incline. Reduce your speed just in case the vehicle starts to roll back or reverses into your path. Also, be aware of the pedestrians potetially walking out from behind the parked vehicle.",
			color: "y"
		}, {
			t: 8.5,
			c: "va-circle",
			d: "c-3",
			e: "a-3",
			a: "There is a car parked to the left. Reduce your speed just in case the vehicle reverses into your path or a pedestrian walks out from behind it.",
			color: "y"
		}, {
			t: 34.2,
			c: "va-circle",
			d: "c-4",
			e: "a-4",
			a: "There is a vehicle approaching from the side road to the left. The vehicle isn't in view but you can see it reflected in the windows of the house to the left. Reduce your speed in case the vehicle doesn't stop behind the give way road markings.<br><div class='va-score'>Score 5</div>",
			color: "r"
		}, {
			t: 35.4,
			c: "va-circle",
			d: "c-5",
			e: "a-5",
			a: "The vehicle is now in view but doesn't look like slowing down. Slow your vehicle down further to avoid an incident.<br><div class='va-score'>Score 4</div>",
			color: "r"
		}, {
			t: 36.8,
			c: "va-circle",
			d: "c-6",
			e: "a-6",
			a: "The van has slowed down slightly, but it isn't clear if they will be stopping behind the road markings. You have right of way, but don't assume other road users will give way to you.<br><div class='va-score'>Score 3</div>",
			color: "r"
		}, {
			t: 37.1,
			c: "va-circle",
			d: "c-7",
			e: "a-7",
			a: "The van is now on top of the road markings and doesn't seem to be stopping. Stop your vehicle and let the van driver decide whether it is safe to go or not.<br><div class='va-score'>Score 2</div>",
			color: "r"
		}, {
			t: 38,
			c: "va-circle",
			d: "c-8",
			e: "a-8",
			a: "The van has now blocked your side of the road. The driver is hesitating whether to continue or not. Keep your vehicle stationary until the road ahead is clear. This was a developing hazard as the van caused your vehicle to slow down and stop.<br><div class='va-score'>Score 1</div>",
			color: "r"
		}],
		videoFile: "<?php echo base_url();?>/videos/<?php echo $video[0]['video_name']; ?>",
		videoFileReview: "<?php echo base_url();?>/videos/<?php echo $video[0]['video_review_name']; ?>",
	});
        }else if (video_id == 10) {

            $("#video").interactive({
		hazards: [{
			t: 15.3,
			c: "c-2 cv_move",
			d: 5500,
		}],

		scoring: [{
			t: 15.3,
			s: 5,
			c: "c"
		}, {
			t: 16.8,
			s: 4
		}, {
			t: 18,
			s: 3
		}, {
			t: 19.6,
			s: 2
		}, {
			t: 20.8,
			s: 1
		}],
		
		annotations: [{
			t: 13.1,
			c: "va-square",
			d: "c-1",
			e: "a-1",
			a: "The road sign to the left indicates that there is a school nearby. Reduce your speed and continue cautiously in case there are children playing close to the road or people crossing the road.",
			color: "b" 
		}, {
			t: 15.3,
			c: "va-circle",
			d: "c-2",
			e: "a-2",
			a: "There is a large puddle on the opposite side of the road. Slow down in case vehicles need to move onto your side of the road.<br><div class='va-score'>Score 5</div>",
			color: "r"
		}, {
			t: 16.8,
			c: "va-circle",
			d: "c-3",
			e: "a-3",
			a: "The puddle is now causing oncoming vehicles to move onto your side of the road. Oncoming vehicles should give way to you but slow down further just in case they don't.<br><div class='va-score'>Score 4</div>",
			color: "r"
		}, {
			t: 18,
			c: "va-circle",
			d: "c-4",
			e: "a-4",
			a: "The closest oncoming vehicle is now moving back to their side of the road but there is another oncoming vehicle that may reach the puddle before you. Slow down in case they do not give way to you.<br><div class='va-score'>Score 3</div>",
			color: "r"
		}, {
			t: 19.6,
			c: "va-circle",
			d: "c-5",
			e: "a-5",
			a: "The oncoming vehicle has started moving into the centre of the road. Reduce your speed even further to allow the oncoming vehicle enough space to travel round the puddle.<br><div class='va-score'>Score 2</div>",
			color: "r"
		}, {
			t: 20.8,
			c: "va-circle",
			d: "c-6",
			e: "a-6",
			a: "The oncoming vehicle has reached the puddle and is in the centre of the road. You cannot continue until this vehicle has passed. This was a developing hazard as the oncoming vehicle caused you to slow down and stop.<br><div class='va-score'>Score 1</div>",
			color: "r"
		}, {
			t: 30,
			c: "va-square",
			d: "c-7",
			e: "a-7",
			a: "A pedestrian is walking along the pavemet. Keep an eye on them in case they decide to cross the road without looking.",
			color: "b"
		}, {
			t: 37.1,
			c: "va-circle",
			d: "c-8",
			e: "a-8",
			a: "There is a cyclist ahead approaching a parked car and a side road. Reduce your speed just in case a car door opens or a vehicle comes out of the side road without seeing the cyclist.",
			color: "y"
		}, {
			t: 48.5,
			c: "va-square",
			d: "c-9",
			e: "a-9",
			a: "A pedestrian is running along the pavement. Keep an eye on them in case they decide to cross the road without looking.",
			color: "b"
		}, {
			t: 50.8,
			c: "va-square",
			d: "c-10",
			e: "a-10",
			a: "There are two parked cars to the right. Continue cautiously in case the hidden car suddenly pulls out in front of you.",
			color: "b"
		}],
		videoFile: "<?php echo base_url();?>/videos/<?php echo $video[0]['video_name']; ?>",
		videoFileReview: "<?php echo base_url();?>/videos/<?php echo $video[0]['video_review_name']; ?>",
	});
        }else if (video_id == 11) {
            $("#video").interactive({
		hazards: [{
			t: 36.6,
			c: "c-8 cv_move",
			d: 12000,
		}],

		scoring: [{
			t: 36.6,
			s: 5,
			c: "c"
		}, {
			t: 39.5,
			s: 4
		}, {
			t: 42,
			s: 3
		}, {
			t: 43.4,
			s: 2
		}, {
			t: 45.1,
			s: 1
		}],
		
		annotations: [{
			t: 3,
			c: "va-circle",
			d: "c-1",
			e: "a-1",
			a: "A pedestrian is crossing the road and getting into a vehicle. You may have to slow down if they do not get out of the way.",
			color: "y" 
		}, {
			t: 10.3,
			c: "va-circle",
			d: "c-2",
			e: "a-2",
			a: "A white car is coming towards you, on your side of the road. You may have to change speed and direction if they do not pull over soon.",
			color: "y"
		}, {
			t: 12,
			c: "va-square",
			d: "c-3",
			e: "a-3",
			a: "A pedestrian is walking towards you along the pavement on your right. Stay aware of them, in case they decide to cross the road without looking.",
			color: "b"
		}, {
			t: 13,
			c: "va-circle",
			d: "c-4",
			e: "a-4",
			a: "The white car is still coming towards you, on your side of the road. You may have to change speed and direction if they do not pull over soon.",
			color: "y"
		}, {
			t: 15,
			c: "va-circle",
			d: "c-5",
			e: "a-5",
			a: "Further ahead, a car is parking on the right. You may have to slow down if they do not finish parking soon.",
			color: "y"
		}, {
			t: 16.4,
			c: "va-circle",
			d: "c-6",
			e: "a-6",
			a: "The white car is now back on their side of the road and is slowing down. This car is no longer a potential hazard.",
			color: "y"
		}, {
			t: 27.9,
			c: "va-square",
			d: "c-7",
			e: "a-7",
			a: "A pedestrian is walking away from you along the pavement on your right. Stay aware of them, in case they decide to cross the road without looking.",
			color: "b"
		}, {
			t: 36.6,
			c: "va-circle",
			d: "c-8",
			e: "a-8",
			a: "A person is leaving a house up ahead.Stay aware of them, in case they decide to cross the road without looking. Clicking here would have scored a maximum of 5 points.<br><div class='va-score'>Score 5</div>",
			color: "r"
		}, {
			t: 39.5,
			c: "va-circle",
			d: "c-9",
			e: "a-9",
			a: "A person has crossed the road without looking. Stay aware of them, in case they decide to cross the road without looking.<br><div class='va-score'>Score 4</div>",
			color: "r"
		}, {
			t: 42,
			c: "va-circle",
			d: "c-11",
			e: "a-11",
			a: "A person has crossed the road without looking. Stay aware of this person.<br><div class='va-score'>Score 3</div>",
			color: "r"
		}, {
			t: 43.4,
			c: "va-circle",
			d: "c-13",
			e: "a-13",
			a: "The person has crossed the road and is getting into the passenger side of a car - they appear to be in a hurry.Be careful, they may pull out in front of you.<br><div class='va-score'>Score 2</div>",
			color: "r"
		}, {
			t: 45.1,
			c: "va-circle",
			d: "c-15",
			e: "a-15",
			a: "The car is pulling out in front of you, slow down and be prepared to stop.<br><div class='va-score'>Score 1</div>",
			color: "r"
		}, {
			t: 58.5,
			c: "va-square",
			d: "c-16",
			e: "a-16",
			a: "A person is on your left. Stay aware of them, in case they decide to cross the road without looking.",
			color: "b"
		}],
		videoFile: "<?php echo base_url();?>/videos/<?php echo $video[0]['video_name']; ?>",
		videoFileReview: "<?php echo base_url();?>/videos/<?php echo $video[0]['video_review_name']; ?>",
	});
        }else if (video_id == 12) {
            $("#video").interactive({
		max: 69,
		
		hazards: [{
			t: 51.1,
			c: "c-7 cv_move",
			d: 9000,
		}],

		scoring: [{
			t: 51.1,
			s: 5,
			c: "c"
		}, {
			t: 53.7,
			s: 4
		}, {
			t: 55.1,
			s: 3
		}, {
			t: 57.2,
			s: 2
		}, {
			t: 59,
			s: 1
		}],
		
		annotations: [{
			t: 7.2,
			c: "va-square",
			d: "c-1",
			e: "a-1",
			a: "Two pedestrians are on the left. Stay aware of them, in case they decide to cross the road without looking.",
			color: "b" 
		}, {
			t: 17.1,
			c: "va-square",
			d: "c-2",
			e: "a-2",
			a: "A pedestrian is on the right. Stay aware of them, in case they decide to cross the road without looking.",
			color: "b"
		}, {
			t: 35.5,
			c: "va-circle",
			d: "c-3",
			e: "a-3",
			a: "A car is about to enter the mini roundabout. You should be slowing down anyway, to give way at the junction, but you may also need to stop if they will be going around the round-about.",
			color: "y"
		}, {
			t: 42.5,
			c: "va-square",
			d: "c-4",
			e: "a-4",
			a: "A group of teenagers are on the left. Stay aware of them, in case they decide to cross the road without looking.",
			color: "b"
		}, {
			t: 44,
			c: "va-square",
			d: "c-5",
			e: "a-5",
			a: "A pedestrian is on the right. Stay aware of them, in case they decide to cross the road without looking.",
			color: "b"
		}, {
			t: 47.1,
			c: "va-square",
			d: "c-6",
			e: "a-6",
			a: "Another pedestrian is on the left further ahead, and is approaching a side road which they may want to cross. Stay aware of them, in case they decide to cross your road instead without looking.",
			color: "b"
		}, {
			t: 51.1,
			c: "va-circle",
			d: "c-7",
			e: "a-7",
			a: "A cyclist is approaching the main road from your left, and will reach the junction very quickly. Since they are moving fast, you would click now and continue to be especially aware of them.<br><div class='va-score'>Score 5</div>",
			color: "r"
		}, {
			t: 53.7,
			c: "va-circle",
			d: "c-8",
			e: "a-8",
			a: "The cyclist did not slow down and has entered the main road without looking both ways. Since they don't seem to care about themselves or others around them, continue to be especially aware of them.<br><div class='va-score'>Score 4</div>",
			color: "r"
		}, {
			t: 55.1,
			c: "va-circle",
			d: "c-9",
			e: "a-9",
			a: "A red car on the left is indicating to pull out, stay aware of both the cyclist and the red car.<br><div class='va-score'>Score 3</div>",
			color: "r"
		}, {
			t: 55.7,
			c: "va-square",
			d: "c-10",
			e: "a-10",
			a: "A pedestrian is on the right. Stay aware of them, but you should be concentrating most on the cyclist and red car ahead, and what could possibly happen next.",
			color: "b"
		}, {
			t: 57.2,
			c: "va-circle",
			d: "c-11",
			e: "a-11",
			a: "The red car continues to indicate and is slowly edging out. Be prepared to slow down and stop, if neccessary.<br><div class='va-score'>Score 2</div>",
			color: "r"
		}, {
			t: 59,
			c: "va-circle",
			d: "c-12",
			e: "a-12",
			a: "The cyclist is moving into the road, in front of you, to avoid the red car which continues to pull out. Slow down and be prepared to stop.<br><div class='va-score'>Score 1</div>",
			color: "r"
		}, {
			t: 59.6,
			c: "va-square",
			d: "c-13",
			e: "a-13",
			a: "Some more pedestrians are on the left. Stay aware of them, in case they decide to cross the road without looking.",
			color: "b"
		}, {
			t: 63,
			c: "va-circle",
			d: "c-14",
			e: "a-14",
			a: "A white car is about to enter the mini roundabout. You should be slowing down anyway, to give way at the junction, but you may also need to stop if they will be going around the roundabout.",
			color: "y"
		}],
		videoFile: "<?php echo base_url();?>/videos/<?php echo $video[0]['video_name']; ?>",
		videoFileReview: "<?php echo base_url();?>/videos/<?php echo $video[0]['video_review_name']; ?>",
	});
        }else if (video_id == 13) {
            $("#video").interactive({
		max: 60,
		
		hazards: [{
			t: 9.2,
			c: "c-3 cv_move",
			d: 9000,
		}],

		scoring: [{
			t: 9.2,
			s: 5,
			c: "c"
		}, {
			t: 11.7,
			s: 4
		}, {
			t: 12.7,
			s: 3
		}, {
			t: 14.7,
			s: 2
		}, {
			t: 16.5,
			s: 1
		}],
		
		annotations: [{
			t: 3.3,
			c: "va-square",
			d: "c-1",
			e: "a-1",
			a: "A road sign on the left tells you there is a school ahead. Be very careful here, as this area may have children that might cross the road without looking.",
			color: "b" 
		}, {
			t: 8.5,
			c: "va-circle",
			d: "c-2",
			e: "a-2",
			a: "A white car may emerge from the left. Stay aware of them, in case they decide to pull out into the main road without looking.",
			color: "y"
		}, {
			t: 9.2,
			c: "va-circle",
			d: "c-3",
			e: "a-3",
			a: "A person is running along the pavement on the left side of the road. There is also a bus ahead on the right, coming towards you. As the person could be runing to make sure they don't miss the bus, you need to be prepared to slow down in case they decide to run across the road without looking.<br><div class='va-score'>Score 5</div>",
			color: "r"
		}, {
			t: 11.7,
			c: "va-circle",
			d: "c-4",
			e: "a-4",
			a: "The front of the car on the left has crossed the give way markings on the road, and it continues to move forward slowly. Be prepared to slow down and stop if they don't give way.<br><div class='va-score'>Score 4</div>",
			color: "r",
		}, {
			t: 12.7,
			c: "va-square",
			d: "c-5",
			e: "a-5",
			a: "The pedestrian on the left is still running, and the bus on the right appears to be slowing down as it approaches a bus stop. Be prepared to slow down if the pedestrian runs across the road without looking.<br><div class='va-score'>Score 3</div>",
			color: "r"
		}, {
			t: 14.7,
			c: "va-square",
			d: "c-6",
			e: "a-6",
			a: "You are now getting close to the pedestrian. Be prepared to slow down and stop if the pedestrian crosses the road without looking.<br><div class='va-score'>Score 2</div>",
			color: "r"
		}, {
			t: 16.5,
			c: "va-circle",
			d: "c-7",
			e: "a-7",
			a: "The pedestrian has just waved at somebody and is most likely trying to get the attention of the bus driver. You must assume the pedestrian will cross the road without looking - slow down now and be prepared to stop.<br><div class='va-score'>Score 1</div>",
			color: "r"
		}, {
			t: 20.4,
			c: "va-circle",
			d: "c-8",
			e: "a-8",
			a: "Further head, a car is waiting to emerge from a side road on the right. Stay aware of them, as they may pull out into the main road without looking.",
			color: "y"
		}, {
			t: 40.1,
			c: "va-circle",
			d: "c-9",
			e: "a-9",
			a: "A car is in the middle of the road ahead. As it is most likely they will be wanting to turn into a side road on your left, and cross your path, stay aware of them.",
			color: "y"
		}, {
			t: 41,
			c: "va-circle",
			d: "c-10",
			e: "a-10",
			a: "A pedestrian is on the pavement to the right of the road. As they are close to a set of traffic lights ahead where there is a pedestrian crossing - be prepared to slow down and stop as the lights may change to red.",
			color: "y"
		}],
		videoFile: "<?php echo base_url();?>/videos/<?php echo $video[0]['video_name']; ?>",
		videoFileReview: "<?php echo base_url();?>/videos/<?php echo $video[0]['video_review_name']; ?>",
	});
        }else if (video_id == 14) {
            $("#video").interactive({
		max: 49,
		
		hazards: [{
			t: 22.2,
			c: "c-4 cv_move",
			d: 2500,
		}],

		scoring: [{
			t: 22.2,
			s: 5,
			c: "c"
		}, {
			t: 23.0,
			s: 4
		}, {
			t: 23.6,
			s: 3
		}, {
			t: 24.0,
			s: 2
		}, {
			t: 24.4,
			s: 1
		}],
		
		annotations: [{
			t: 1,
			c: "va-circle",
			d: "c-1",
			e: "a-1",
			a: "A car is parked on your side of the road. As you will need to cross the white lines in the middle of the road to overtake this car, you will need to slow down if you see oncoming traffic. Also, be on the lookout for pedestrians that might be hidden behind the parked car. ",
			color: "y" 
		}, {
			t: 16.5,
			c: "va-square",
			d: "c-2",
			e: "a-2",
			a: "A pedestrian is on your left. Stay aware of them, in case they decide to cross the road without looking.",
			color: "b"
		}, {
			t: 22.0,
			c: "va-circle",
			d: "c-3",
			e: "a-3",
			a: "A pedestrian is on your right. You might also be able to see something to the left of the red car ahead. Stay aware of both of these potential hazards.",
			color: "y"
		}, {
			t: 22.2,
			c: "va-circle",
			d: "c-4",
			e: "a-4",
			a: "The small thing to the left of the red car is a child on a bike, and they have turned towards the road. Click now, as the child is very close to the road, and might be about to cross the road without looking.<br><div class='va-score'>Score 5</div>",
			color: "r",
		}, {
			t: 23,
			c: "va-square",
			d: "c-5",
			e: "a-5",
			a: "The child on the bike is disappearing behind the red car. Slow down and be prepared to stop, as it's very likely they are about to cross the road without looking - this will cause the motorcycle ahead of you to slow down as well.<br><div class='va-score'>Score 4</div>",
			color: "r"
		}, {
			t: 23.6,
			c: "va-square",
			d: "c-6",
			e: "a-6",
			a: "The child on the bike is disappearing behind the red car. Slow down and be prepared to stop, as it's very likely they are about to cross the road without looking - this will cause the motorcycle ahead of you to slow down as well.<br><div class='va-score'>Score 3</div>",
			color: "r"
		}, {
			t: 24.0,
			c: "va-circle",
			d: "c-7",
			e: "a-7",
			a: "The child on the bike is disappearing behind the red car. Slow down and be prepared to stop, as it's very likely they are about to cross the road without looking - this will cause the motorcycle ahead of you to slow down as well.<br><div class='va-score'>Score 2</div>",
			color: "r"
		}, {
			t: 24.4,
			c: "va-circle",
			d: "c-8",
			e: "a-8",
			a: "The child has crossed the road, and the motorcycle will be slowing down quickly and safely. You will also need to slow down quickly and safely.<br><div class='va-score'>Score 1</div>",
			color: "r"
		}, {
			t: 36.7,
			c: "va-circle",
			d: "c-9",
			e: "a-9",
			a: "A car up ahead is in the middle of the road, while overtaking parked cars that are on their side of the road. Stay aware of them, as you will have to slow down and possibly change direction if they do not return to their own side of the road in the next few seconds.",
			color: "y"
		}],
		videoFile: "<?php echo base_url();?>/videos/<?php echo $video[0]['video_name']; ?>",
		videoFileReview: "<?php echo base_url();?>/videos/<?php echo $video[0]['video_review_name']; ?>",
	});
        }else if (video_id == 15) {
            $("#video").interactive({
		max: 69,
		
		hazards: [{
			t: 41.2,
			c: "c-4 cv_move",
			d: 9000,
		}],

		scoring: [{
			t: 41.2,
			s: 5,
			c: "c"
		}, {
			t: 42.6,
			s: 4
		}, {
			t: 45.0,
			s: 3
		}, {
			t: 47.5,
			s: 2
		}, {
			t: 50.3,
			s: 1
		}],
		
		annotations: [{
			t: 5.3,
			c: "va-circle",
			d: "c-1",
			e: "a-1",
			a: "A vehicle is in the outside lane, to your right, and is about to overtake you. You can tell by the shadow the vehicle is making on the road. Stay aware of this vehicle, as they may return to the left lane sooner than you might expect, causing you to have to slow down and maintain a safe distance.",
			color: "y" 
		}, {
			t: 20.0,
			c: "va-circle",
			d: "c-2",
			e: "a-2",
			a: "Another vehicle is in the outside lane, to your right, and is about to overtake you. You can tell by the shadow it is making on the road.",
			color: "y"
		}, {
			t: 29.5,
			c: "va-circle",
			d: "c-3",
			e: "a-3",
			a: "Another vehicle is in the outside lane, to your right, and is about to overtake you. You can tell by the shadow it is making on the road.",
			color: "y"
		}, {
			t: 41.2,
			c: "va-circle",
			d: "c-4",
			e: "a-4",
			a: "There is a lay-by up ahead and on the left. A black car is in the lay-by and is moving - they are probably picking up speed so they may re-join the dual carriageway.<br><div class='va-score'>Score 5</div>",
			color: "r",
		}, {
			t: 42.6,
			c: "va-square",
			d: "c-5",
			e: "a-5",
			a: "As the vehicle moves closer to the carriageway the maximum points you can score decreases.<br><div class='va-score'>Score 4</div>",
			color: "r"
		}, {
			t: 45.0,
			c: "va-square",
			d: "c-6",
			e: "a-6",
			a: "As the vehicle moves closer to the carriageway the maximum points you can score decreases.<br><div class='va-score'>Score 3</div>",
			color: "r"
		}, {
			t: 47.5,
			c: "va-circle",
			d: "c-7",
			e: "a-7",
			a: "As the vehicle moves closer to the carriageway the maximum points you can score decreases.<br><div class='va-score'>Score 2</div>",
			color: "r"
		}, {
			t: 50.3,
			c: "va-circle",
			d: "c-8",
			e: "a-8",
			a: "The black car in the lay-by is almost up to full speed.<br><div class='va-score'>Score 1</div>",
			color: "r"
		}, {
			t: 40.1,
			c: "va-circle",
			d: "c-9",
			e: "a-9",
			a: "Another vehicle is about to overtake you. Stay aware of them.",
			color: "y"
		}],
		videoFile: "<?php echo base_url();?>/videos/<?php echo $video[0]['video_name']; ?>",
		videoFileReview: "<?php echo base_url();?>/videos/<?php echo $video[0]['video_review_name']; ?>",
	});
        }else if (video_id == 16) {
            $("#video").interactive({
		max: 60, 
		
		hazards: [{
			t: 9.4,
			c: "c-3 cv_move",
			d: 4800,
		}],

		scoring: [{
			t: 9.4,
			s: 5,
			c: "c"
		}, {
			t: 11.3,
			s: 4
		}, {
			t: 12.2,
			s: 3
		}, {
			t: 13.7,
			s: 2
		}, {
			t: 14.2,
			s: 1
		}],
		
		annotations: [
		{
			t: 1,
			c: "va-square",
			d: "c-2",
			e: "a-2",
			a: "A pedestrian is to your right. Stay aware of them, in case they decide to cross the road without looking",
			color: "b"
		}, {
			t: 9.4,
			c: "va-circle",
			d: "c-3",
			e: "a-3",
			a: "You are approaching a zebra crossing and it looks like a lot of school children are going home. As many of the children will probably want to use the zebra crossing, stay very aware of them <br><div class='va-score'>Score 5</div>",
			color: "r"
		}, {
			t: 11.3,
			c: "va-circle",
			d: "c-4",
			e: "a-4",
			a: "You are approaching a zebra crossing and it looks like a lot of school children are going home. As many of the children will probably want to use the zebra crossing, stay very aware of them <br><div class='va-score'>Score 4</div>",
			color: "r"
		}, {
			t: 12.2,
			c: "va-circle",
			d: "c-5",
			e: "a-5",
			a: "Several of the children are heading towards the zebra crossing. They do not appear to be looking up and down the road to make sure it is safe to cross, but you must assume that they may be crossing anyway. Be prepared to slow down and stop if necessary <br><div class='va-score'>Score 3</div>",
			color: "r"
		}, {
			t: 13.7,
			c: "va-circle",
			d: "c-6",
			e: "a-6",
			a: "Some of the pedestrians are about to use the zebra crossing. Slow down quickly and safely, and be prepared to stop <br><div class='va-score'>Score 2</div>",
			color: "r"
		}, {
			t: 14.2,
			c: "va-square",
			d: "c-7",
			e: "a-7",
			a: "A pedestrian is to your right. But continue to pay particular attention to those near the crossing <br><div class='va-score'>Score 1</div>",
			color: "b"
		}, {
			t: 24,
			c: "va-square",
			d: "c-8",
			e: "a-8",
			a: "More school children are on the pavement to your left, though are far enough away from the zebra crossing that you do not have wait for them. As the zebra crossing is now empty, and there are no more pedestrians waiting to cross, you can now continue on your journey",
			color: "b"
		}, {
			t: 26,
			c: "va-circle",
			d: "c-9",
			e: "a-9",
			a: "As you are now moving again, you must think and look ahead - a car is at the junction ahead on the left, and is slowly creeping out. Stay aware of them",
			color: "y"
		}, {
			t: 31.7,
			c: "va-circle",
			d: "c-11",
			e: "a-11",
			a: "Another car is approaching the junction on your left. Stay aware of them",
			color: "y"
		}, {
			t: 33.5,
			c: "va-square",
			d: "c-13",
			e: "a-13",
			a: "The car and bus on the left are not moving, but there may be pedestrians behind each of these vehicles - especially the bus as people may be rushing to get on or off it. Stay aware of these vehicles and any pedestrians that may appear.",
			color: "b"
		}, {
			t: 45.1,
			c: "va-square",
			d: "c-15",
			e: "a-15",
			a: "A pedestrian is on your right. They appear to be busy doing something with the boot of their car, so may not be paying attention to traffic on the road. Stay aware of them.",
			color: "b"
		}, {
			t: 51,
			c: "va-square",
			d: "c-16",
			e: "a-16",
			a: "A person is on your left. Stay aware of them, in case they decide to cross the road without looking.",
			color: "b"
		}],
		videoFile: "<?php echo base_url();?>/videos/<?php echo $video[0]['video_name']; ?>",
		videoFileReview: "<?php echo base_url();?>/videos/<?php echo $video[0]['video_review_name']; ?>",
	});
        }else if (video_id == 17) {
            $("#video").interactive({
		max: 55,
		
		hazards: [{
			t: 9.6,
			c: "c-1 cv_move",
			d: 4800,
		}],

		scoring: [{
			t: 9.6,
			s: 5,
			c: "c"
		}, {
			t: 10.6,
			s: 4
		}, {
			t: 11.6,
			s: 3
		}, {
			t: 12.6,
			s: 2
		}, {
			t: 13,
			s: 1
		}],
		
		annotations: [{
			t: 9.6,
			c: "va-square",
			d: "c-1",
			e: "a-1",
			a: "A car is approaching the junction ahead on your right <br><div class='va-score'>Score 5</div>",
			color: "r" 
		}, {
			t: 10.6,
			c: "va-square",
			d: "c-2",
			e: "a-2",
			a: "The car does not appear to be slowing down <br><div class='va-score'>Score 4</div>",
			color: "r"
		}, {
			t: 11.6,
			c: "va-circle",
			d: "c-3",
			e: "a-3",
			a: "The car has now reached the junction where they should give way to traffic on the main road <br><div class='va-score'>Score 3</div>",
			color: "r"
		}, {
			t: 12.6,
			c: "va-square",
			d: "c-4",
			e: "a-4",
			a: "The car has not stopped to give way to you. Even though the parked cars on your side of the road will force you to move to the centre of the road to overtake them, you did have the right of way over the car emerging <br><div class='va-score'>Score 2</div>",
			color: "r"
		}, {
			t: 13,
			c: "va-square",
			d: "c-5",
			e: "a-5",
			a: "The car is still moving into the main road and blocking your path. Slow down and be prepared to stop <br><div class='va-score'>Score 1</div>",
			color: "r"
		}, {
			t: 27,
			c: "va-square",
			d: "c-6",
			e: "a-6",
			a: "A pedestrian is ahead on the pavement to your left. Stay aware of them, in case they decide to cross the road without looking.",
			color: "b"
		}, {
			t: 47,
			c: "va-circle",
			d: "c-7",
			e: "a-7",
			a: "Another pedestrian is ahead on the pavement to your left.  Stay aware of them, in case they decide to cross the road without looking.",
			color: "b"
		}, {
			t: 50.5,
			c: "va-circle",
			d: "c-8",
			e: "a-8",
			a: "A pedestrian is crossing the road just around the corner. If they do not finish crossing the road in the next few seconds, you will have to slow down and prepare to stop.",
			color: "y"
		}],
		videoFile: "<?php echo base_url();?>/videos/<?php echo $video[0]['video_name']; ?>",
		videoFileReview: "<?php echo base_url();?>/videos/<?php echo $video[0]['video_review_name']; ?>",
	});
        }else if (video_id == 18) {
            $("#video").interactive({
		max: 57,
		
		hazards: [{
			t: 30.4,
			c: "c-3 cv_move",
			d: 4000,
		}],

		scoring: [{
			t: 30.4,
			s: 5,
			c: "c"
		}, {
			t: 31.2,
			s: 4
		}, {
			t: 31.9,
			s: 3
		}, {
			t: 32.0,
			s: 2
		}, {
			t: 32.5,
			s: 1
		}],
		
		annotations: [{
			t: 13.5,
			c: "va-circle",
			d: "c-1",
			e: "a-1",
			a: "A white van appears to be on your side of the road up ahead. Stay aware of them, as you will have to slow down and prepare to stop if they do not return to their own side of the road in the next few seconds",
			color: "y" 
		}, {
			t: 19.8,
			c: "va-circle",
			d: "c-2",
			e: "a-2",
			a: "A white van is parked on your side of the road up ahead, on the brow of a hill. As you will need to cross the white lines in the middle of the road to overtake it, and move into the path of oncoming traffic, stay aware of the van and the traffic ahead",
			color: "y"
		}, {
			t: 30.4,
			c: "va-circle",
			d: "c-3",
			e: "a-3",
			a: "The pedestrian is disappearing behind the white van. At this time you don't know if they are staying on the pavement or are about to cross the road at the front of the van but the pedestrian on the other side of the road could be waiting for them<br><div class='va-score'>Score 5</div>",
			color: "r"
		}, {
			t: 31.2,
			c: "va-circle",
			d: "c-4",
			e: "a-4",
			a: "The pedestrian is now completely out of sight. When large vehicles or other things block your view of pedestrians or pavements, you must always assume that someone or something may be hidden which may move into the road<br><div class='va-score'>Score 4</div>",
			color: "r",
		}, {
			t: 31.9,
			c: "va-square",
			d: "c-5",
			e: "a-5",
			a: "The pedestrian is still out of sight. In general with parked vehicles like this, look at the gap under the vehicle to see if you can spot the feet of pedestrians that may be hidden behind the vehicle, then take appropriate actions.<br><div class='va-score'>Score 3</div>",
			color: "r"
		}, {
			t: 32.0,
			c: "va-square",
			d: "c-6",
			e: "a-6",
			a: "The pedestrian is still out of sight, and you are now getting very close to the van. If the pedestrian is about to walk in front of you, there is now very little time remaining to slow down quickly and safely especially if you were travelling faster than shown here. Slow down<br><div class='va-score'>Score 2</div>",
			color: "r"
		}, {
			t: 32.5,
			c: "va-circle",
			d: "c-7",
			e: "a-7",
			a: "You ca now see the pedestrian at the front of the van and you must assume they are going to cross the road without looking especially as the other pedestrian is moving forwards. Slow down quickly and safely.<br><div class='va-score'>Score 1</div>",
			color: "r"
		}, {
			t: 34.4,
			c: "va-square",
			d: "c-8",
			e: "a-8",
			a: "Looking ahead, another pedestrian is on the pavement to your left. Stay aware of them, in case they also decide to cross the road without looking",
			color: "b"
		}],
		videoFile: "<?php echo base_url();?>/videos/<?php echo $video[0]['video_name']; ?>",
		videoFileReview: "<?php echo base_url();?>/videos/<?php echo $video[0]['video_review_name']; ?>",
	});
        }else if (video_id == 19) {
            $("#video").interactive({
		max: 59,
		
		hazards: [{
			t: 22.0,
			c: "c-2 cv_move",
			d: 9000,
		}],

		scoring: [{
			t: 22.0,
			s: 5,
			c: "c"
		}, {
			t: 24.0,
			s: 4
		}, {
			t: 25.0,
			s: 3
		}, {
			t: 27.5,
			s: 2
		}, {
			t: 31.9,
			s: 1
		}],
		
		annotations: [{
			t: 3.5,
			c: "va-circle",
			d: "c-1",
			e: "a-1",
			a: "A white car is approaching the mini roundabout ahead. As they currently have the right of way at this junction, you will have to slow down and be prepared to stop if they will be going around the roundabout",
			color: "y" 
		}, {
			t: 22.0,
			c: "va-circle",
			d: "c-2",
			e: "a-2",
			a: "A cyclist is riding along the pavement ahead on the left. Click here for a maximum score of 5 points as any number of scenarios could evolve <br><div class='va-score'>Score 5</div>",
			color: "r"
		}, {
			t: 24.0,
			c: "va-circle",
			d: "c-3",
			e: "a-3",
			a: "The dark car in front of you has started to indicate left <br><div class='va-score'>Score 4</div>",
			color: "r"
		}, {
			t: 25.0,
			c: "va-circle",
			d: "c-4",
			e: "a-4",
			a: "The dark car has started to indicate left. There is no junction ahead on the left, so the car must be pulling into a parking area on the left, and will need to cross the pavement where the cyclist will soon be <br><div class='va-score'>Score 3</div>",
			color: "r",
		}, {
			t: 27.5,
			c: "va-square",
			d: "c-5",
			e: "a-5",
			a: "The dark car is now slightly ahead of the cyclist. It does not appear that the cyclist is aware of the car, so they will probably keep riding along the pavement without slowing down - this will cause the car to slow down and stop to avoid a collision <br><div class='va-score'>Score 2</div>",
			color: "r"
		}, {
			t: 31.9,
			c: "va-square",
			d: "c-6",
			e: "a-6",
			a: "The dark car is braking and is about to turn to the left. The cyclist has still not looked over their shoulder to check for vehicles that wish to cross the pavement. You must assume the cyclist is not oging to stop, so you must slow down quickly and safely and be prepared to stop. <br><div class='va-score'>Score 1</div>",
			color: "r"
		}, {
			t: 47.6,
			c: "va-circle",
			d: "c-7",
			e: "a-7",
			a: "A car is about to move onto the mini roundabout ahead and is still moving. As you are now approaching the mini roundabout, you must be prepared to slow down in case the other car enters the roundabout and does not leave it within the next few seconds.",
			color: "y"
		}, {
			t: 52,
			c: "va-circle",
			d: "c-8",
			e: "a-8",
			a: "A white car is at a junction ahead on the right. Stay aware of them, in case they decide to cross the road without looking.",
			color: "y"
		}],
		videoFile: "<?php echo base_url();?>/videos/<?php echo $video[0]['video_name']; ?>",
		videoFileReview: "<?php echo base_url();?>/videos/<?php echo $video[0]['video_review_name']; ?>",
	});
        }else if (video_id == 20) {
            $("#video").interactive({
		max: 60,
		
		hazards: [{
			t: 30.2,
			c: "c-4 cv_move",
			d: 5000,
		}],

		scoring: [{
			t: 30.2,
			s: 5,
			c: "c"
		}, {
			t: 31.0,
			s: 4
		}, {
			t: 32.0,
			s: 3
		}, {
			t: 33.0,
			s: 2
		}, {
			t: 33.9,
			s: 1
		}],
		
		annotations: [{
			t: 5.3,
			c: "va-square",
			d: "c-1",
			e: "a-1",
			a: "A pedestrian is on the pavement ahead on the left. Stay aware of them, in case they decide to cross the road without looking",
			color: "b" 
		}, {
			t: 20.0,
			c: "va-circle",
			d: "c-2",
			e: "a-2",
			a: "Another car is approaching a junction ahead on the right. Stay aware of them, in case they decide to cross the road without looking",
			color: "y"
		}, {
			t: 29.5,
			c: "va-square",
			d: "c-3",
			e: "a-3",
			a: "A pedestrian is on the pavement ahead on the left. Stay aware of them, in case they decide to cross the road without looking",
			color: "b"
		}, {
			t: 30.2,
			c: "va-circle",
			d: "c-4",
			e: "a-4",
			a: "Two motocycles are approaching a junction ahead. Motorcycles may move very quickly, watch them carefully in case they emerge without taking proper care. Clicking here would have given you maximum points <br><div class='va-score'>Score 5</div>",
			color: "r",
		}, {
			t: 31.0,
			c: "va-square",
			d: "c-5",
			e: "a-5",
			a: "The motorcycles do not appear to be slowing down, and they have also disappeared behind the trees on the left. As you cannot see the motorcycles now, you must assume that they are about to emerge onto the main road. Be prepared to slow down <br><div class='va-score'>Score 4</div>",
			color: "r"
		}, {
			t: 32.0,
			c: "va-square",
			d: "c-6",
			e: "a-6",
			a: "The first motorcycle is now at the junction and is still moving. It is clear that they will not be giving way to traffic on the main road. Be prepared to slow down <br><div class='va-score'>Score 3</div>",
			color: "r"
		}, {
			t: 33.0,
			c: "va-circle",
			d: "c-7",
			e: "a-7",
			a: "The first motorcycle has now entered the main road and the second motorcycle is close behind it <br><div class='va-score'>Score 2</div>",
			color: "r"
		}, {
			t: 33.9,
			c: "va-circle",
			d: "c-8",
			e: "a-8",
			a: "The second motorcycle is now at the junction and it is clear that it is also not going to give way to traffic on the main road. Slow down now <br><div class='va-score'>Score 1</div>",
			color: "r"
		}, {
			t: 40.1,
			c: "va-circle",
			d: "c-9",
			e: "a-9",
			a: "A cyclist is on the pavement ahead on the left. Stay aware of them, in case they decide to cross the road without looking",
			color: "b"
		}, {
			t: 47.0,
			c: "va-circle",
			d: "c-10",
			e: "a-10",
			a: "A pedestrian is on the pavement ahead on the right. Stay aware of them, in case they decide to cross the road without looking",
			color: "b"
		}],
		videoFile: "<?php echo base_url();?>/videos/<?php echo $video[0]['video_name']; ?>",
		videoFileReview: "<?php echo base_url();?>/videos/<?php echo $video[0]['video_review_name']; ?>",
	});
        }else if (video_id == 21) {
            $("#video").interactive({
		max: 54, 
		
		hazards: [{
			t: 17.6,
			c: "c-4 cv_move",
			d: 9400,
		}],

		scoring: [{
			t: 17.6,
			s: 5,
			c: "c"
		}, {
			t: 20,
			s: 4
		}, {
			t: 22,
			s: 3
		}, {
			t: 23,
			s: 2
		}, {
			t: 26,
			s: 1
		}],
		
		annotations: [{
			t: 14,
			c: "va-circle",
			d: "c-1",
			e: "a-1",
			a: "A vehicle is approaching on the opposite side, however you have right of way.  Be mindful of the vehicle pulling out into the centre of the road",
			color: "y" 
		}, {
			t: 20,
			c: "va-square",
			d: "c-2",
			e: "a-2",
			a: "There is a school crossing warning sign in the distance.  A road crossing point could be near.  Be vigilant for school children crossing",
			color: "b"
		}, {
			t: 24,
			c: "va-square",
			d: "c-3",
			e: "a-3",
			a: "Pedestrians are walking on either side of this busy road.  They could walk out at any time.  Continue cautiously",
			color: "b"
		}, {
			t: 17.7,
			c: "va-circle",
			d: "c-4",
			e: "a-4",
			a: "There is a school crossing patrol officer up ahead in the distance.  Children are approaching the patrol officer.  Start to reduce your speed as the patrol officer could walk into the road to stop traffic <br><div class='va-score'>5</div>",
			color: "r"
		}, {
			t: 20,
			c: "va-circle",
			d: "c-5",
			e: "a-5",
			a: "The children have stopped next to the school crossing patrol officer, a crossing is imminent.  Continue cautiously, keep your distance from the vehicle ahead and reduce your speed.  It is an offence not to stop if signalled by a crossing patroller <br><div class='va-score'>4</div>",
			color: "r"
		}, {
			t: 22,
			c: "va-circle",
			d: "c-6",
			e: "a-6",
			a: "The school crossing patrol officer has turned to face the road.  The officer is looking to enter the road to allow children to cross safely.  The red vehicle appears not to be slowing down.  Be cautious of a sudden stop <br><div class='va-score'>3</div>",
			color: "r"
		}, {
			t: 23,
			c: "va-square",
			d: "c-7",
			e: "a-7",
			a: "The school crossing patrol officer has edged into the road to cross.  The red vehicle ahead appears not to stop or slow down.  Prepare to stop to allow for children to stop <br><div class='va-score'>2</div>",
			color: "r"
		}, {
			t: 26,
			c: "va-circle",
			d: "c-8",
			e: "a-8",
			a: "The school crossing patrol officer has entered the road to stop traffic.  The red vehicle brakes sharply.  This was a developing hazard as the patrol officer caused the traffic to stop to allow the children to cross the road which is UK law <br><div class='va-score'>Score 1</div>",
			color: "r"
		}],
		videoFile: "<?php echo base_url();?>/videos/<?php echo $video[0]['video_name']; ?>",
		videoFileReview: "<?php echo base_url();?>/videos/<?php echo $video[0]['video_review_name']; ?>",
	});
        }else if (video_id == 22) {
            $("#video").interactive({
		max: 59,
		
		hazards: [{
			t: 42,
			c: "c-3 cv_move",
			d: 2800,
		}],

		scoring: [{
			t: 42.0,
			s: 5,
			c: "c"
		}, {
			t: 42.7,
			s: 4
		}, {
			t: 43.3,
			s: 3
		}, {
			t: 44.0,
			s: 2
		}, {
			t: 44.8,
			s: 1
		}],
		
		annotations: [{
			t: 2.7,
			c: "va-circle",
			d: "c-1",
			e: "a-1",
			a: "There is a sharp bend in the road.  Slow down and take the corner with care",
			color: "y" 
		}, {
			t: 13.9,
			c: "va-circle",
			d: "c-2",
			e: "a-2",
			a: "You are approaching the brow of a hill which has reduced your visibility.  Take the hill with care and be aware when coming over the other side for on coming vehicles",
			color: "y"
		}, {
			t: 42.0,
			c: "va-circle",
			d: "c-3",
			e: "a-3",
			a: "There is a pedestrian on a mobility scooter who has turned towards the road. Continue cautiously, the pedestrian may be looking to cross <br><div class='va-score'>5</div>",
			color: "r"
		}, {
			t: 42.7,
			c: "va-circle",
			d: "c-4",
			e: "a-4",
			a: "The pedestrian on the mobility scooter has stopped at the curb side, continue and reduce your speed, they may not have seen you <br><div class='va-score'>Score 4</div>",
			color: "r",
		}, {
			t: 43.3,
			c: "va-square",
			d: "c-5",
			e: "a-5",
			a: "The pedestrian on the mobility scooter has stopped at the curb side, continue and reduce your speed, they may not have seen you<br><div class='va-score'>Score 3</div>",
			color: "r"
		}, {
			t: 44.0,
			c: "va-square",
			d: "c-6",
			e: "a-6",
			a: "You still do not have visibility of the pedestrian. The white van and car are blocking any visibility of the pedestrian’s location. Continue, slowly and patiently, the pedestrian on the mobility scooter may not have seen you and entered in the road <br><div class='va-score'>Score 2</div>",
			color: "r"
		}, {
			t: 44.8,
			c: "va-circle",
			d: "c-7",
			e: "a-7",
			a: "The pedestrian on the mobility scooter had entered the road causing an obstruction.  Slow your vehicle down to allow the pedestrian to cross.  This was a developing hazard as the you were forced to slow your vehicle down and stop to avoid hitting the pedestrian <br><div class='va-score'>Score 1</div>",
			color: "r"
		}],
		videoFile: "<?php echo base_url();?>/videos/<?php echo $video[0]['video_name']; ?>",
		videoFileReview: "<?php echo base_url();?>/videos/<?php echo $video[0]['video_review_name']; ?>",
	});
        }else if (video_id == 23) {
            $("#video").interactive({
		max: 58,
		
		hazards: [{
			t: 15,
			c: "c-3 cv_move",
			d: 5000,
		}],

		scoring: [{
			t: 15.0,
			s: 5,
			c: "c"
		}, {
			t: 16.0,
			s: 4
		}, {
			t: 18.0,
			s: 3
		}, {
			t: 19.0,
			s: 2
		}, {
			t: 20.0,
			s: 1
		}],
		
		annotations: [{
			t: 10,
			c: "va-square",
			d: "c-1",
			e: "a-1",
			a: "There is a slippery road warning sign in the distance.  The twisty road may contain mud, spray or loose chippings.  Continue with care, the road ahead may pose a potential risk",
			color: "b" 
		}, {
			t: 39.5,
			c: "va-square",
			d: "c-2",
			e: "a-2",
			a: "There is a junction road sign in the distance.  Vehicles may be looking to enter the road from the left hand side.  Maintain awareness of vehicles approaching the junction and merging onto the road",
			color: "b"
		}, {
			t: 15.0,
			c: "va-circle",
			d: "c-3",
			e: "a-3",
			a: "There is a vehicle approaching the junction from the left hand side hidden behind the farmer’s field.  Be prepared to slow down in case the driver of the vehicle cannot see you.  The road signs indicate to the oncoming driver that a junction is ahead. <br><div class='va-score'>Score 5</div>",
			color: "r",
		}, {
			t: 16.0,
			c: "va-circle",
			d: "c-4",
			e: "a-4",
			a: "The driver is still approaching at the same speed.  Visibility is still obscured by the farmer’s field.  Reduce your speed just in case the other vehicle does not stop at the junction<br><div class='va-score'>Score 4</div>",
			color: "r"
		}, {
			t: 18.0,
			c: "va-circle",
			d: "c-5",
			e: "a-5",
			a: "The driver is still approaching at the same speed.  Visibility is still obscured by the farmer’s field.  Reduce your speed just in case the other vehicle does not stop at the junction<br><div class='va-score'>Score 3</div>",
			color: "r"
		}, {
			t: 19.0,
			c: "va-circle",
			d: "c-6",
			e: "a-6",
			a: "It is still no clear whether the van driver is going to stop at the junction.  The vehicle has visibility of you but is maintaining speed<br><div class='va-score'>Score 2</div>",
			color: "r"
		}, {
			t: 20.0,
			c: "va-circle",
			d: "c-7",
			e: "a-7",
			a: "The vehicle has not stopped at the junction and started to move into the road.  Slow your vehicle down to allow the other vehicle to continue.  This was a developing hazard as you were forced to slow your vehicle down to avoid colliding with the vehicle that did not stop at the junction <br><div class='va-score'>Score 1</div>",
			color: "r"
		}],
		videoFile: "<?php echo base_url();?>/videos/<?php echo $video[0]['video_name']; ?>",
		videoFileReview: "<?php echo base_url();?>/videos/<?php echo $video[0]['video_review_name']; ?>",
	});
        }else if (video_id == 24) {
            $("#video").interactive({
		max: 59,
		
		hazards: [{
			t: 16.1,
			c: "c-4 cv_move",
			d: 9000,
		}],

		scoring: [{
			t: 16.1,
			s: 5,
			c: "c"
		}, {
			t: 17.0,
			s: 4
		}, {
			t: 18.0,
			s: 3
		}, {
			t: 20.0,
			s: 2
		}, {
			t: 23.9,
			s: 1
		}],
		
		annotations: [{
			t: 2.5,
			c: "va-square",
			d: "c-1",
			e: "a-1",
			a: "There is a junction road sign in the distance.  Vehicles may be looking to enter the road from the left hand side.  Maintain awareness of vehicles approaching the junction and merging onto the road",
			color: "b" 
		}, {
			t: 21.2,
			c: "va-circle",
			d: "c-2",
			e: "a-2",
			a: "There are cyclists approaching from the opposite side of the road.  Maintain awareness as vehicles may look to enter your side of the road to overtake",
			color: "y"
		}, {
			t: 50,
			c: "va-circle",
			d: "c-3",
			e: "a-3",
			a: "A pedestrians is walking along the path.  They could walk out into the road at any time.  Continue cautiously",
			color: "y"
		}, {
			t: 16.1,
			c: "va-circle",
			d: "c-4",
			e: "a-4",
			a: "There is a motorbike approaching the junction in the distance from the left hand side behind the trees.  Be prepared to slow down in case the driver of the vehicle cannot see you or feels there is enough distance and time to enter the road <br><div class='va-score'>Score 5</div>",
			color: "r",
		}, {
			t: 17.0,
			c: "va-square",
			d: "c-5",
			e: "a-5",
			a: "The motorbike is still approaching at the same speed.  There are cyclists and a parked vehicle on the other side of the road.  Continue cautiously.  The parked vehicles and cyclists may impair the motorbike driver’s ability to enter the road effectively <br><div class='va-score'>Score 4</div>",
			color: "r"
		}, {
			t: 18.0,
			c: "va-square",
			d: "c-6",
			e: "a-6",
			a: "The motorbike is still approaching at the same speed.  There are cyclists and a parked vehicle on the other side of the road.  Continue cautiously.  The parked vehicles and cyclists may impair the motorbike driver’s ability to enter the road effectively <br><div class='va-score'>Score 3</div>",
			color: "r"
		}, {
			t: 20.0,
			c: "va-circle",
			d: "c-7",
			e: "a-7",
			a: "The motorbike has entered the road at the junction.  It is not clear who is closest to the parked car.  Reduce your speed in case the motorbike does not stop and enters your side of the road <br><div class='va-score'>Score 2</div>",
			color: "r"
		}, {
			t: 23.9,
			c: "va-circle",
			d: "c-8",
			e: "a-8",
			a: "The motorbike has started to move into your side of the road t over take the parked vehicle.  Slow down to allow the motorbike to continue.  This was a developing hazard as you were forced to slow your vehicle down and stop before you passed the parked car<br><div class='va-score'>Score 1</div>",
			color: "r"
		}],
		videoFile: "<?php echo base_url();?>/videos/<?php echo $video[0]['video_name']; ?>",
		videoFileReview: "<?php echo base_url();?>/videos/<?php echo $video[0]['video_review_name']; ?>",
	});
        }else if(video_id == 25){
            $("#video").interactive({
		max: 59,
		
		hazards: [{
			t: 18.1,
			c: "c-2 cv_move",
			d: 12000,
		}],

		scoring: [{
			t: 18.1,
			s: 5,
			c: "c"
		}, {
			t: 22.5,
			s: 4
		}, {
			t: 26.5,
			s: 3
		}, {
			t: 27.5,
			s: 2
		}, {
			t: 28.8,
			s: 1
		}],
		
		annotations: [{
			t: 12,
			c: "va-circle",
			d: "c-1",
			e: "a-1",
			a: "There are traffic lights in the distance.  Maintain awareness as these could change at any time in this busy village",
			color: "y" 
		}, {
			t: 18.1,
			c: "va-circle",
			d: "c-2",
			e: "a-2",
			a: "There is a cyclist approaching the road from the path on the left hand side hidden behind the trees.  The car in front has not yet indicated any reduction in speed.  Be prepared to slow down in case the cyclist is intending to join the road and the vehicle in front has not seen the cyclist <br><div class='va-score'>Score 5</div>",
			color: "r"
		}, {
			t: 22.5,
			c: "va-circle",
			d: "c-3",
			e: "a-3",
			a: "The driver in front is still approaching at the same speed and may not have seen the cyclist.  The cyclist is still approaching the road from the path and may intend to join.  Reduce your speed just in case the vehicle in front still has not seen the cyclist <br><div class='va-score'>Score 4</div>",
			color: "r"
		}, {
			t: 26.5,
			c: "va-circle",
			d: "c-4",
			e: "a-4",
			a: "The driver in front is still approaching at the same speed and may not have seen the cyclist. The cyclist is still approaching the road from the path and may intend to join. Reduce your speed just in case the vehicle in front still has not seen the cyclist <br><div class='va-score'>Score 3</div>",
			color: "r"
		}, {
			t: 27.5,
			c: "va-circle",
			d: "c-5",
			e: "a-5",
			a: "The cyclist has crossed the junction road and is still approaching the road to join. The vehicle in front has still not shown any indication of slowing down.  Reduce your speed and maintain a suitable distance to the car in front <br><div class='va-score'>Score 2</div>",
			color: "r"
		}, {
			t: 28.8,
			c: "va-circle",
			d: "c-6",
			e: "a-6",
			a: "The cyclist joined the road from the junction causing the car in front to brake suddenly and slow down. This was a developing hazard as you were forced to slow your vehicle down and stop to avoid colliding with the vehicle. Maintain your distance behind the cyclist until it is safe to move into the centre of the road to pass <br><div class='va-score'>Score 1</div>",
			color: "r"
		}],
		videoFile: "<?php echo base_url();?>/videos/<?php echo $video[0]['video_name']; ?>",
		videoFileReview: "<?php echo base_url();?>/videos/<?php echo $video[0]['video_review_name']; ?>",
	});
        }else if(video_id == 26){
           $("#video").interactive({
		max: 59,
		
		hazards: [{
			t: 8.2,
			c: "c-3 cv_move",
			d: 13000,
		}],

		scoring: [{
			t: 8.2,
			s: 5,
			c: "c"
		}, {
			t: 17.0,
			s: 4
		}, {
			t: 18.0,
			s: 3
		}, {
			t: 19.5,
			s: 2
		}, {
			t: 20.2,
			s: 1
		}],
		
		annotations: [{
			t: 48,
			c: "va-circle",
			d: "c-1",
			e: "a-1",
			a: "This is a national speed limit sign.  You are on a dual carriageway, you can maintain a speed of 70mph if driving a car or motorcycle",
			color: "b" 
		}, {
			t: 50,
			c: "va-square",
			d: "c-2",
			e: "a-2",
			a: "There is a roundabout sign in the distance.  This indicated a roundabout is approaching.  Be prepared to slow down to approach and enter the roundabout",
			color: "y"
		}, {
			t: 8.2,
			c: "va-circle",
			d: "c-3",
			e: "a-3",
			a: "A car has just crossed the road ahead of you. A lorry is approaching in the right hand lane in the distance on the opposite side of the road and appearing to slow down. Maintain awareness of the lorry as it may be looking to cross the road <br><div class='va-score'>Score 5</div>",
			color: "r"
		}, {
			t: 17,
			c: "va-circle",
			d: "c-4",
			e: "a-4",
			a: "The lorry has turned into the junction to cross the road ahead of you.  Reduce your speed and maintain awareness just in case the lorry driver does not stop <br><div class='va-score'>Score 4</div>",
			color: "r"
		}, {
			t: 18.0,
			c: "va-circle",
			d: "c-4",
			e: "a-4",
			a: "The lorry has turned into the junction to cross the road ahead of you.  Reduce your speed and maintain awareness just in case the lorry driver does not stop <br><div class='va-score'>Score 3</div>",
			color: "r"
		}, {
			t: 19.5,
			c: "va-circle",
			d: "c-4",
			e: "a-4",
			a: "The lorry has entered the road ahead of you.  Reduce your speed just in case the lorry does not cross the road in time to give you sufficient space to pass <br><div class='va-score'>Score 2</div>",
			color: "r"
		}, {
			t: 20.2,
			c: "va-circle",
			d: "c-4",
			e: "a-4",
			a: "The lorry has attempted a 180 degree U-turn into the left lane and not crossed the road into the junction.  Slow you vehicle down to allow the lorry to merge safely.  This was a developing hazard as you were forced to slow you vehicle down as the lorry undertook a U-turn on the busy road <br><div class='va-score'>Score 1</div>",
			color: "r"
		}],
		videoFile: "<?php echo base_url();?>/videos/<?php echo $video[0]['video_name']; ?>",
		videoFileReview: "<?php echo base_url();?>/videos/<?php echo $video[0]['video_review_name']; ?>",
	});
        }
<?php } ?>
});
</script>