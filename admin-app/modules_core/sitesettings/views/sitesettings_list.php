<div id="main_content">                    
    <!-- Start : main content loads from here -->   
    
    <?php if(isset($succmsg) && $succmsg != ""){ ?>
    <div align="center">
      <div class="nNote nSuccess">
        <p><?php echo stripslashes($succmsg);?></p>
      </div>
    </div>
    <?php } ?>
    <?php if(isset($errmsg) && $errmsg != ""){ ?>
    <div align="center">
      <div class="nNote nFailure">
        <p><?php echo stripslashes($errmsg);?></p>
      </div>
    </div>
    <?php } ?>
     
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">Sitesettings Search Panel</h4>
                </div>
                <div class="panel_controls">
                    <form name="perPageFrm" id="perPageFrm" method="post" action="<?php echo BACKEND_URL;?>sitesettings/search/">
                        <div class="row">
                            <div class="col-sm-4">
                                <label for="table_search">Search:</label>
                                <input type="text" id="search_str" name="search_str" class="form-control" value="<?php echo $search_keyword; ?>">
				<input type="hidden" id="action" name="action" class="form-control" value="Process">
                            </div>                        
                            <div class="col-sm-3 col-xs-6">
                                <label>&nbsp;</label>
                                <input class="btn btn-default btn-sm" type="submit" name="btn_submit" id="btn_submit" value="Search" />
                                <input type="button" class="btn btn-default btn-sm" name="btn_show_all" id="btn_show_all" onclick="window.location.href='<?php echo BACKEND_URL;?>sitesettings'" value="Show All" />                                
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
                    <h4 class="panel-title">Sitesettings Listing
		    <!--<a href="<?php echo $add_url;?>">
                            <div class="addSign label label-info" data-toggle="tooltip" data-placement="top auto" title="Add New Step">
                                <span class="glyphicon glyphicon-plus"></span>
                            </div>
                      </a>-->
                    </h4>
                </div>
                    <input type="hidden" name="group_mode" id="group_mode" value="" />  
                    <input type="hidden" name="totalRecord" id="totalRecord" value="<?php echo $totalRecord; ?>">
                    <input type="hidden" name="startRecord" id="startRecord" value="<?php echo $startRecord; ?>">
                    <input type="hidden" name="per_page1" id="per_page1" value="<?php echo $page; ?>">
                	<table id="resp_table" class="table toggle-square">
                        <thead>
                              <tr>
                                <th data-toggle="true">Sitesettings Name</th>
				<th data-toggle="true">Sitesettings Value</th>
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
			    if($sitesettings_all){
                            for($i=0; $i<count($sitesettings_all); $i++){                                
                                $editLink = $sitesettings_all[$i]['edit_link'];
				
                                $class = 'class="even"';
 				if($i%2==0)
				  $class = 'class="even"';
				else
				  $class = 'class="odd"';
                        ?>
                        <tr <?php echo $class; ?>>
                          <td><?php echo stripslashes($sitesettings_all[$i]['sitesettings_lebel']);?></td>
			  <td><?php echo stripslashes($sitesettings_all[$i]['sitesettings_value']);?></td>
                          <td>
			    <a href="<?php echo $editLink;?>" class="tablectrl_small bDefault tipS" title="Edit">
			      <span class="glyphicon glyphicon-edit"></span>
			    </a>
                          </td>
                        </tr>
                        <?php } } else {  ?>
                            <tr><td colspan="7" align="center">..::..No records found..::..</td></tr>
                            <tr><td colspan="7">&nbsp;</td></tr>                
                        <?php } ?>
                      </tbody>
                        
                        
                	</table>
            </div>
        </div>
    </div>
            
    <!--End : Main content-->    
</div>