<?php
$stepId=$topic_details[0]['step_id'];
$topicId=$topic_details[0]['id'];
?>
<section id="main">
  <div class="stepPage stepPageNew designNewStep">
    <div class="wrap">
		<div class="lessonChangePan">
		<div class="ltLesson">
		<h3>Learn about <?php echo stripslashes($topic_details[0]['name']);?></h3>
		<p><?php echo stripslashes($topic_details[0]['short_description']); ?></p>
		</div>
		<br class="spacer" />
		</div>
		<div class="selectList">
			<ul class="clearfix">
				<?php if(is_array($lesson_master) && count($lesson_master)>0){
			foreach($lesson_master as $k=>$lm){
		    ?>
			<li class="lessonChange <?=($k == 0)?'active':'';?>" id="<?php echo $lm['id'];?>"><?php echo stripslashes($lm['name']);?></li>
		    <?php
			}
			}
		    ?>
			</ul>
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