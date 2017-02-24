<div id="main_content">                    
    <!-- Start : main content loads from here -->   
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">Banner Search Panel</h4>
                </div>
                <div class="panel_controls">
                    <form name="perPageFrm" id="perPageFrm" method="post" action="<?php echo BACKEND_URL;?>instructor/banner_search/">
                        <div class="row">
                            <div class="col-sm-4">
                                <label for="table_search">Search:</label>
                                <input type="text" id="search_keyword" name="search_str" class="form-control" value="<?php echo $search_keyword; ?>">
				                         <input type="hidden" id="action" name="action" class="form-control" value="Process">
                            </div>                        
                            <div class="col-sm-3 col-xs-6">
                                <label>&nbsp;</label>
                                <input class="btn btn-default btn-sm" type="submit" name="btn_submit" id="btn_submit" value="Search" onclick=" return searchValidation('Search Field Must Contain Banner Name');"/>
                                <input type="button" class="btn btn-default btn-sm" name="btn_show_all" id="btn_show_all" onclick="window.location.href='<?php echo BACKEND_URL;?>instructor/banner'" value="Show All" />                                
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
                    <h4 class="panel-title">Instructor Banner Listing
                        <a href="<?php echo base_url();?>instructor/banner_add">
                            <div title="Add New Advertisement" data-placement="top auto" data-toggle="tooltip" class="addSign label label-info">
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
                                <tr>
                                <th data-toggle="true">Title</th>
                                <th data-toggle="true">Image</th>
                                <th data-toggle="true">Status</th>
				<th data-sort-ignore="true">Actions</th>
                              </tr>
                              </tr>
                            </thead>
        		  <tfoot>
                          <tr>
                            <td colspan="8">
                              <?php
                                  $show_to_record   = $startRecord + $per_page;
                                  $to_record    = $show_to_record;
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
                            foreach($result_all as $result) {
                        ?>
                        <tr>
                          <td><?php echo stripslashes($result['banner_title']);?></td>
                          <td><img src="<?php echo FILE_UPLOAD_URL?>instructor_banner/thumbs/<?php echo $result['banner_image'];?>"></td>
                          <td><?php echo $result['status'];?></td>
                          <td>
			    <a href="<?php echo base_url();?>instructor/banner_edit/<?php echo $result['banner_id'] ?>" class="tablectrl_small bDefault tipS" title="Edit">
			      <span class="glyphicon glyphicon-edit"></span>
			    </a>
			     <a href="<?php echo base_url();?>instructor/banner_delete/<?php echo $result['banner_id'] ?>" class="tablectrl_small bDefault tipS" title="Remove" onclick="return confirm('Are you sure you want to delete this item?');">
			      <span class="glyphicon glyphicon-remove"></span>
			    </a>
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