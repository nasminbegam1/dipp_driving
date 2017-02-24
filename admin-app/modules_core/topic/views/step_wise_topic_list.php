<div id="main_content">                    
    <!-- Start : main content loads from here -->   
   
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">Topic Listing 
                    </h4>
                </div>
                    <input type="hidden" name="group_mode" id="group_mode" value="" />  
                    <input type="hidden" name="totalRecord" id="totalRecord" value="<?php echo $totalRecord; ?>">
                    <input type="hidden" name="startRecord" id="startRecord" value="<?php echo $startRecord; ?>">
                    <input type="hidden" name="per_page1" id="per_page1" value="<?php echo $page; ?>">
                	<table id="resp_table" class="table toggle-square">
                        <thead>
                              <tr>
                                <th data-toggle="true">Course</th>
                                <th data-toggle="true">Step</th>
                                <th data-toggle="true">Topic</th>
                                <th data-toggle="true">Image</th>
                                <th data-toggle="true">Description</th>
                                <th data-toggle="true">Status</th>
				<th data-sort-ignore="true">Actions</th>
                              </tr>
                            </thead>
        		  <tfoot>
                          <tr>
                            <td colspan="8">
                          <?php
                          $show_to_record 	= $startRecord + $per_page;
                          $to_record		= $show_to_record;
                          if($show_to_record > $totalRecord) {
                                $to_record = $totalRecord;
                          }
                          ?>
                            <div class="footerPagination"> <span class="showRecCount">Showing <?php echo $startRecord+1; ?> to <?php echo $to_record; ?> of <?php echo $totalRecord; ?> entries</span> <?php echo $this->pagination->create_links();?> </div>
                              </td>
                          </tr>
                        </tfoot>
                        <tbody>
                        <?php
                        if(count($topic_all) > 0) {
                        foreach($topic_all as $topic) {
                        ?>
                        <tr <?php echo $topic['class']; ?>>
                          <td><?php echo stripslashes($topic['course_name']);?></td>
                          <td><?php echo stripslashes($topic['step_name']);?></td>
                          <td><?php echo stripslashes($topic['name']);?></td>
                          <td><img src="<?php echo FILE_UPLOAD_URL?>topic/thumbs/<?php echo $topic['image'];?>"></td>
                          <td><?php echo sub_word(stripslashes($topic['short_description']),10);?></td>
                          <td><a href="<?php echo $topic['status_link'];?>" class="statusChange" style="padding-top:2px;"><span class="label <?php echo $topic['status_class'];?>"><?php echo $topic['status'];?></span></a></td>
                          <td>
			    <a href="<?php echo $topic['edit_link'];?>" class="tablectrl_small bDefault tipS" title="Edit">
			      <span class="glyphicon glyphicon-edit"></span>
			    </a>
                          </td>
                        </tr>
                        <?php } }  else {?>
                        <tr><td colspan="7" align="center">--Sorry no record found!--</td></tr>
                        <?php } ?>
                      </tbody>
                        
                        
                	</table>
            </div>
        </div>
    </div>
            
    <!--End : Main content-->    
</div>