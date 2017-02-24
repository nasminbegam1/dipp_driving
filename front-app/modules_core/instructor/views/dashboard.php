<section>
  <div class="container">          
    <article>
	
	<div class="dil-box">                
	  <article>
	    
	    <?php
            $getMessage=flash_message();
            if(is_array($getMessage) && count($getMessage) > 0)
            {
                $message_type=$getMessage['type'];
                echo '<div class="'.$message_type.'">'.$getMessage['content'].'</div>';
            }
          ?>
	    
	    
	    <h3 class="heading-txt">DRIVING INSTRUCTOR DASHBOARD</h3>
	    <?php if(file_exists(FILE_UPLOAD_ABSOLUTE_PATH.'membership_badge/'.$packages[0]['badge']) && $packages[0]['badge'] != ''){?>
	    <div class="membrshp_bdge">
	      <img class="add-img" src="<?php echo FILE_UPLOAD_URL.'membership_badge/'.$packages[0]['badge']; ?>" alt="img" /></a>
	    </div>
	    <?php } ?>
	    <div class="table-responsive">
	      <table>
		<thead>
		  <tr>
		    <th>Name</th>
		    <th>Email</th>
		    <th>last login</th>
		    <th>Last Test Date</th>
		    <th>Projected test score</th>
		  </tr>
		</thead>
		<tbody>
		  <?php
		  if(is_array($student_all)){
		    foreach($student_all as $stdAll){
		  ?>
		  <tr>
		    <td data-title="Name"><a href="<?php echo base_url().$this->session->userdata('INSTRUCTOR_BUSINESS_NAME').'/report/'.$stdAll['student_id'];?>"><?php echo stripslashes($stdAll['student_fname']).' '.stripslashes($stdAll['student_lname']); ?></a></td>
		    <td data-title="Email"><?php echo $stdAll['student_email']; ?></td>
		    <td data-title="last login"><?php echo ($stdAll['last_login'] != '0000-00-00 00:00:00')?date('d/m/Y',strtotime($stdAll['last_login'])):'N/A'; ?></td>
		    <td data-title="Last Test Date"><?php echo ($stdAll['last_test_date'] != '')?date('d/m/Y',$stdAll['last_test_date']):'N/A'; ?></td>
		    <td data-title="Projected test score"><?php if(is_array($stdAll['test_result'])){echo number_format($stdAll['test_result']['answer_percentage'],2).'%'; }else{ echo 'N/A';}?></td>
		  </tr>
		  <?php }  ?>
		  <?php if(!empty($paging)){ ?>
		  <tr>
		      <td colspan="5">
		      <div class="pagination"><?php echo $paging;?></div>
		      </td>
		  </tr>
		  <?php } }else{ ?>
		   <tr>
		      <td colspan="5">--Record not found--</td>
		   </tr>
		  <?php } ?>
		</tbody>
	      </table>                    
	    </div>
	  </article>
	  
	  <aside>
	    <ul class="aside-list">                    
	      <li>
		<div class="comm-box">
		  <p>You current have "<?php echo strtoupper(stripslashes($packages[0]['package_name'])); ?> MEMBERSHIP"</p>
		  <p>You currently have "<?php echo $totalRecord.'/'.$packages[0]['no_student'];?> users"</p>
		  <!--<p><?php echo stripslashes($cms[0]['cms_content']); ?></p>-->
		</div>
	      </li>
	      <li>
		<!--<div class="comm-box asidebox-1">
		  <h6>Upgrade Membership Package</h6>
		  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
		  <a href="#">Upgrade</a>
		</div>-->
		<div class="comm-box asidebox-1">
		  <h6>Cancel Membership</h6>
		  <p>To give notice to cancel your membership please select below</p>
		  <a href="<?php echo base_url().$this->session->userdata('INSTRUCTOR_BUSINESS_NAME').'/cancel-payment'?>">Cancel</a>
		</div>
	      </li>
	      <li>
		<div class="comm-box asidebox-2">
		<h5><a href="<?php echo base_url().$instractorBusinessName.'/download'?>" style="font-size: 17px">Download Advertising Images</a></h5>
		<?php
		if(is_array($advertisement)){
		  foreach($advertisement as $adv){
		    if($adv['advertisement_image'] != '' && file_exists(FILE_UPLOAD_ABSOLUTE_PATH.'advertisement/thumbs/'.$adv['advertisement_image'])){
		?>
		<!--<a data-fancybox-type="ajax" class="advertisement" id="<?php //echo $adv['id'];?>" href="<?php //echo $adv['advertisement_link']; ?>"><img class="add-img" src="<?php //echo FILE_UPLOAD_URL.'advertisement/thumbs/'.$adv['advertisement_image']; ?>" alt="img" /></a>-->
		
		
		<a class="advertisement-dwnload" id="<?php echo $adv['id'];?>" href="<?php echo FRONTEND_URL."download_file/advertisement/".$adv['advertisement_image'];?>"><img class="add-img" src="<?php echo FILE_UPLOAD_URL.'advertisement/thumbs/'.$adv['advertisement_image']; ?>" alt="img" /></a>
		<?php } } } ?>
		</div>
	      </li>
	      <li>
		<div class="comm-box">
		  <a href="<?php echo FRONTEND_URL.$instractorBusinessName."/video_tutorial/";?>">Click for Video Tutorials</a>
		</div>
	      </li>
	    </ul>
	  </aside>
	</div>
    </article>
  </div>        
</section>
