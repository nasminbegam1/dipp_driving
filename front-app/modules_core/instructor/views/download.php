<section>
  <div class="container">          
    <article>
	
	<div class="dil-box student-list">                
	  <article>
	    <h3 class="heading-txt">Download Badge and Banner</h3>
	    <div class="table-responsive">
	      <table>
		<thead>
		  <tr>
		    <th>Name</th>
		    <th>Image</th>
		    <th></th>
		
		  </tr>
		</thead>
		<tbody>
		  <?php
		  
		  if(is_array($badge_records)>0){
		    foreach($badge_records as $record){
		  ?>
		  <tr>
		    <td data-title="Name"><?php echo stripslashes($record['badge_name']); ?></td>
		    <td data-title="Image"><?php
		    if(file_exists(FILE_UPLOAD_ABSOLUTE_PATH.'badge_image/thumbs/'.$record['badge_image'])){
		      ?>
		      <img src="<?php echo FILE_UPLOAD_URL.'badge_image/thumbs/'.$record['badge_image'];?>" >
		    <?php
		    }
		    ?></td>
		    <td data-title="last login"><a href="<?php echo FRONTEND_URL."download_file/badge/".$record['badge_image'];?>">Download</a></td>
		    
		  </tr>
		  <?php }  ?>
		  
		  <?php } ?>
		  
		  <?php
		  
		  if(is_array($banner_records)>0){
		    foreach($banner_records as $record){
		  ?>
		  <tr>
		    <td data-title="Name"><?php echo stripslashes($record['banner_title']); ?></td>
		    <td data-title="Image"><?php
		    if(file_exists(FILE_UPLOAD_ABSOLUTE_PATH.'instructor_banner/thumbs/'.$record['banner_image'])){
		      ?>
		      <img src="<?php echo FILE_UPLOAD_URL.'instructor_banner/thumbs/'.$record['banner_image'];?>" >
		    <?php
		    }
		    ?></td>
		    <td data-title="last login"><a href="<?php echo FRONTEND_URL."download_file/banner/".$record['banner_image'];?>">Download</a></td>
		    
		  </tr>
		  <?php }  ?>
		  
		  <?php } ?>
		   
		</tbody>
	      </table>                    
	    </div>
	  </article>
	</div>
    </article>
  </div>        
</section>
