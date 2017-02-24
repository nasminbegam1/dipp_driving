<?php
$stepId=$topic_details[0]['step_id'];
$topicId=$topic_details[0]['id'];
?>
<section id="main">
  <div class="stepPage stepPageNew">
    <div class="wrap">
		<div class="lessonChangePan">
		<div class="ltLesson">
		<h3>Learn about <?php echo stripslashes($topic_details[0]['name']);?></h3>
		<p><?php echo stripslashes($topic_details[0]['short_description']); ?></p>
		</div>
		<div class="rtLesson">
		<select name="lessonChange" id="lessonChange">
		  <option value="">--Select One--</option>
		    <?php if(is_array($lesson_master) && count($lesson_master)>0){
			foreach($lesson_master as $k=>$lm){
		    ?>
			<option value="<?php echo $lm['id'];?>" <?php if($lm['is_read'] == 'Yes'){ echo "class='greenclass'";}?> <?php if($k == 0){ echo 'selected';}?>><?php echo stripslashes($lm['name']);?></option>
		    <?php
			}
			}
		    ?>
		</select>
		</div>
		<br class="spacer" />
		</div>
        <div id="lessonDetailsView" class="lessonDetailsView"></div>
        <!--<a class="fancybox fancybox.ajax motoRules motoRulesnew" href="<?php echo base_url().'learn/practice/openFancyBox/'.$topicId.'/'.$stepId; ?>">Take a test on <?php echo stripslashes($topic_details[0]['name']);?></a>--> </div>
        </div>
</section>
<script type="text/javascript">
	 $(document).ready(function(){
			$('.fancybox').fancybox();
	 });
</script>