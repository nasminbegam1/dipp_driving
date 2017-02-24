<div id="main_content">                    
    <!-- Start : main content loads from here -->   
   
   <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">Lesson Search Panel</h4>
                </div>
                <div class="panel_controls">
                    <form name="perPageFrm" id="perPageFrm" method="post" action="<?php echo BACKEND_URL;?>lesson/search/" class='form-validate'>
                        <div class="row">
                            <div class="col-sm-4">
                                <label for="table_search">Search:</label>
                                <input type="text" id="search_keyword" name="search_str" class="form-control" value="<?php echo $search_keyword; ?>">
                                <label for="reg_input_name" class="req">Course</label>
				<?php echo form_dropdown('course_id', $courseOption, "", 'id="course_id" class="form-control required"');?>
                                <label for="reg_input_name" class="req">Step</label>
                                    <select name="step_id" id="step_id" class="form-control required">
					<option value="" class="sc_show option">--Select Step--</option>    
                                    </select>
                                <label for="reg_input_name" class="req">Topic</label>
                                    <select name="topic_id" id="topic_id" class="form-control required">
					<option value="" class="sc_show option">--- Select Topic --</option>    
                                    </select>
				<input type="hidden" id="action" name="action" class="form-control" value="Process">
                            </div>
                            
                            <div class="col-sm-3 col-xs-6">
                                <label>&nbsp;</label>
                                <input class="btn btn-default btn-sm" type="submit" name="btn_submit" id="btn_submit" value="Search" onclick=" //return searchValidation('Search Field Must Contain Lesson Name');"/>
                                <input type="button" class="btn btn-default btn-sm" name="btn_show_all" id="btn_show_all" onclick="window.location.href='<?php echo BACKEND_URL;?>lesson'" value="Show All" />                                
                            </div>

                        </div>
                    </form>
                </div>
                
            </div>
        </div>
    </div>
   
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">Lesson Listing
			<a href="<?php echo $add_url;?>">
                            <div class="addSign label label-info" data-toggle="tooltip" data-placement="top auto" title="Add New Lesson">
                                <span class="glyphicon glyphicon-plus"></span>
                            </div>
			</a>
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
				<th data-toggle="true">Lesson</th>
                                <th data-toggle="true">Short Description</th>
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
                        if(count($lesson_all) > 0) {
                        foreach($lesson_all as $lesson) {
                        ?>
                        <tr <?php echo $lesson['class']; ?>>
                          <td><?php echo stripslashes($lesson['course_name']);?></td>
                          <td><?php echo stripslashes($lesson['step_name']);?></td>
			  <td><?php echo stripslashes($lesson['topic_name']);?></td>
                          <td><?php echo stripslashes($lesson['name']);?></td>
                          <td><?php echo sub_word(stripslashes($lesson['description']),10);?></td>
                          <td><!--<a href="<?php echo $lesson['status_link'];?>" class="statusChange" style="padding-top:2px;"><span class="label <?php echo $topic['status_class'];?>">--><?php echo $lesson['status'];?><!--</span></a>--></td>
                          <td>
			    <a href="<?php echo $lesson['edit_link'];?>" class="tablectrl_small bDefault tipS" title="Edit">
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