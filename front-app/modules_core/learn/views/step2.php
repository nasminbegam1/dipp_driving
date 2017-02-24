<div class="stepPage">
	 <div class="wrap">
			<h2 class="title">TAKE A LESSON TEST BY SELECTING THE PANELS BELOW</h2>
			<div class="topicArea clear">
			<?php
			if(isset($step_practise) && is_array($step_practise) && count($step_practise)>0){
				 $i = 0;
				 ?>
				 <ul class="clearfix">
						<?php
						foreach($step_practise as $practise_dtls){ 
							 $_StepID= $practise_dtls['step_id'];
							 $_StepName= $practise_dtls['step_name'];
							 $_StepType= $practise_dtls['step_type'];
							 $_TopicID= $practise_dtls['id'];
							 $_TopicName= $practise_dtls['name'];
							 $_TopicShortDescription= $practise_dtls['short_description'];
							 $_TopicImage= $practise_dtls['image'];
							 $i++;
							 ?>
							 <li class="<?php echo $practise_dtls['topic_class'];?>" data-title="<?php echo 'Click here to answer questions on '.stripslashes($_TopicName).' <br/><br/>When you\'ve tested yourself on all of the lessons,<br/> go to Step 3 and try Mock Tests';;?>">
									<a href="<?php echo base_url().'learn/practice/start_test/'.$_TopicID.'/all'; ?>">
										 <?php if(file_exists(FILE_UPLOAD_ABSOLUTE_PATH.'topic/main_image/'.$practise_dtls['main_image']) && $practise_dtls['main_image'] <> ''){?>	
										 <img src="<?php echo FILE_UPLOAD_URL;?>topic/main_image/<?php echo $practise_dtls['main_image'];?>" alt="">
										 <?php } ?>
										 <!--
										 <div class="topicBox">
												<div class="topicImg"><img src="<?php echo FRONTEND_URL.'images/topic.png';?>"></div>	   
												<h3 class="topicTitle"><span>Lesson <?php echo $i;?></span></h3>
												<h4 class="topicSub"><?php echo stripslashes($_TopicName);?></h4>
												<div class="topicContent">
													 <p><?php echo stripslashes($_TopicShortDescription);?></p>
												</div>
										 </div>
										 <div class="tpoicImg">
												<img src="<?php echo FILE_UPLOAD_URL;?>topic/thumbs/<?php echo $_TopicImage;?>" alt="">
										 </div>-->
									</a>
							 </li>
							 <?php
						}
						?>
				 </ul>
				 <?php
			}
			else {
				 ?>
				 <ul><li>No Record Found</li></ul>
				 <?php
			}
			?>
			</div>       
	 </div>
</div>
<script type="text/javascript">
	 $(document).ready(function(){
			$('.fancybox').fancybox();
	 });
</script>