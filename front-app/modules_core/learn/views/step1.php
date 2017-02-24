<!--<style type="text/css">
	.tooltip{
		margin:8px;
		padding:10px;
		border:1px solid #F2E214;
		background-color:#fff;
		position: absolute;
		z-index: 2;
		color:#333;
		font-size:14px;
}
</style>-->
<div class="stepPage">
  		<div class="container">
              <h2 class="title">COMPLETE THE LESSONS BY SELECTING THE PANELS BELOW</h2>
             <div class="topicArea clearfix">
              <?php
              if(isset($step_learn) && is_array($step_learn) && count($step_learn)>0)
              {
                $i = 0;
                ?>
             	<ul class="clearfix">
                  <?php
                  foreach($step_learn as $learn_dtls)
                  {
                    $i ++;
                    ?>
                    <li class="<?php echo $learn_dtls['learn_class'];?>" data-title="<?php echo 'Click here to learn all about '.stripslashes($learn_dtls['name']).' <br/>Then go to Step 2 to take lesson tests on '.stripslashes($learn_dtls['name']);?>">
                    <a href="<?php echo FRONTEND_URL.'learn/learn_details/'.$learn_dtls['id'];?>">
			<?php if(file_exists(FILE_UPLOAD_ABSOLUTE_PATH.'topic/main_image/'.$learn_dtls['main_image']) && $learn_dtls['main_image'] <> ''){?>	
                    	<img src="<?php echo FILE_UPLOAD_URL;?>topic/main_image/<?php echo $learn_dtls['main_image'];?>" alt="">
			<?php } ?>
			<!--<div class="topicBox">
		          <div class="topicImg"><img src="<?php echo FRONTEND_URL.'images/topic.png';?>"></div>		
                          <h3 class="topicTitle"><span>Lesson <?php echo $i;?></span></h3>
                          <h4 class="topicSub">Lesson <?php echo $i;?> - <?php echo stripslashes($learn_dtls['name']);?></h4>
                          <div class="topicContent">
                            	<p><?php echo stripslashes($learn_dtls['short_description']);?></p>
                            </div>
                        </div>
                        <div class="tpoicImg"><img src="<?php echo FILE_UPLOAD_URL;?>topic/thumbs/<?php echo $learn_dtls['image'];?>" alt=""></div>-->
	           </a>
                    </li>
                    <?php
                  }
                  ?>	
                </ul>
                <?php } else { ?>
                <ul><li>No Record Found</li></ul>
                <?php } ?>
		
             </div>       
        </div>
  </div>