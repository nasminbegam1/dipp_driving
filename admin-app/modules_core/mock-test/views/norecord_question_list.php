<div id="main_content">                    
    <!-- Start : main content loads from here -->   
   
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">Question Search Panel</h4>
                </div>
                <div class="panel_controls">
                    <form name="perPageFrm" id="perPageFrm" method="post" action="<?php echo BACKEND_URL;?>mock-test/question/search/">
                        <div class="row">
                            <div class="col-sm-4">
                                <label for="table_search">Search:</label>
                                <input type="text" id="search_keyword" name="search_str" class="form-control" value="">
				<input type="hidden" id="action" name="action" class="form-control" value="Process">
                            </div>                        
                            <div class="col-sm-3 col-xs-6">
                                <label>&nbsp;</label>
                                <input class="btn btn-default btn-sm" type="submit" name="btn_submit" id="btn_submit" value="Search" onclick=" return searchValidation('Search Field Must Contain Question');" />
                                <input type="button" class="btn btn-default btn-sm" name="btn_show_all" id="btn_show_all" onclick="window.location.href='<?php echo BACKEND_URL;?>mock-test/question'" value="Show All" />                                
                            </div>
														<div class="col-sm-3">
                                <label for="table_search">By Course:</label>
                                <?php echo form_dropdown('course_id', $courseOption,$courseId, 'id="courseId" class="form-control required" onchange="getMockTestQuestionByCourse(this.value)"');?>
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
                    <h4 class="panel-title">Question Listing 
                        <a href="<?php echo base_url(); ?>mock-test/question/add">
                            <div title="" data-placement="top auto" data-toggle="tooltip" class="addSign label label-info" data-original-title="Add Admin User">
                                <span class="glyphicon glyphicon-plus"></span>
                            </div>
                        </a>
                    </h4>
                </div>
                    <table id="resp_table" class="table toggle-square">
                        <thead>
                               <tr>
                                <th data-toggle="true" width="50%">Question</th>
                                <th data-toggle="true" width="20%">Status</th>
                                <th data-sort-ignore="true" width="15%">Answer</th>
				<th data-sort-ignore="true" width="15%">Actions</th>
                              </tr>
                            </thead>
        		  <tfoot>
                          <tr>
                            <td colspan="4" align="center">
                           -- Sorry no record found!--
                              </td>
                          </tr>
                        </tfoot>
                     </table>
            </div>
        </div>
    </div>
            
    <!--End : Main content-->    
</div>