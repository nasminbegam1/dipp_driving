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
                                <label for="table_search">Search11:</label>
                                <input type="text" id="search_keyword" name="search_str" class="form-control" value="">
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
                              -- Sorry no record found!--
                          </tr>
                        </tfoot>
                        <tbody>
                      </tbody>
                        
                        
                    </table>
            </div>
        </div>
    </div>
            
    <!--End : Main content-->    
</div>