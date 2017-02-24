<div id="main_content">                    
    <!-- Start : main content loads from here -->   
   
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">User Search Panel</h4>
                </div>
                <div class="panel_controls">
                    <form name="perPageFrm" id="perPageFrm" method="post" action="<?php echo BACKEND_URL;?>user/search/">
                        <div class="row">
                            <div class="col-sm-4">
                                <label for="table_search">Search:</label>
                                <input type="text" id="search_keyword" name="search_str" class="form-control" value="<?php echo $search_keyword; ?>">
				<input type="hidden" id="action" name="action" class="form-control" value="Process">
                            </div>                        
                            <div class="col-sm-3 col-xs-6">
                                <label>&nbsp;</label>
                                <input class="btn btn-default btn-sm" type="submit" name="btn_submit" id="btn_submit" value="Search" onclick=" return searchValidation('Search Field Must Contain Question');"/>
                                <input type="button" class="btn btn-default btn-sm" name="btn_show_all" id="btn_show_all" onclick="window.location.href='<?php echo BACKEND_URL;?>user'" value="Show All" />                                
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
                    <h4 class="panel-title">User Listing 
                     
                    </h4>
                </div>
                    <input type="hidden" name="group_mode" id="group_mode" value="" />  
                    <input type="hidden" name="totalRecord" id="totalRecord" value="<?php echo $totalRecord; ?>">
                    <input type="hidden" name="startRecord" id="startRecord" value="<?php echo $startRecord; ?>">
                    <input type="hidden" name="per_page1" id="per_page1" value="<?php echo $page; ?>">
                	<table id="resp_table" class="table toggle-square">
                        <thead>
                              <tr>
                                <th data-toggle="true">User</th>
				<th data-toggle="true">Email Address</th>
				<th data-toggle="true">Transaction Details</th>
                                <th data-toggle="true">Course</th>
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
                            foreach($user_all as $user) {
                        ?>
                        <tr <?php echo $user['class']; ?>>
                          <td><?php echo stripslashes($user['user_fname']).' '.stripslashes($user['user_lname']);?></td>
			  <td><?php echo stripslashes($user['user_email']);?></td>
			  <td>
			    <b>Paid amount : </b><?php echo ($user['paid_amount'] !='')?$user['paid_amount']:'N/A'; ?><br>
			    <b>Transaction Id : </b><?php echo ($user['transaction_id'] !='')?$user['transaction_id']:'N/A'; ?><br>
			    <b>Transaction Date : </b><?php echo ($user['added_on'] != '')?date('Y-m-d',strtotime($user['added_on'])):'N/A';?><br>
			  </td>
                          <td><?php echo stripslashes($user['user_course']);?></td>
                          <td><a href="<?php echo $user['status_link'];?>" class="statusChange" style="padding-top:2px;"><span class="label <?php echo $user['status_class'];?>"><?php echo $user['user_status'];?></span></a></td>
                          <td>
			    <a href="<?php echo $user['edit_link'];?>" class="tablectrl_small bDefault tipS" title="Edit">
			      <span class="glyphicon glyphicon-edit"></span>
			    </a>
			    
			    <!--<a href="<?php echo $user['delete_link'];?>" class="tablectrl_small bDefault tipS confirmDelete" title="Delete">
			      <span class="glyphicon glyphicon-remove"></span>
			    </a>-->
                          </td>
                        </tr>
                        <?php } ?>
                      </tbody>
                        
                        
                	</table>
            </div>
        </div>
    </div>
            
    <!--End : Main content-->    
</div>