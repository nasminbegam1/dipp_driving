<!--BEGIN TITLE & BREADCRUMB PAGE-->
<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title">Category Listing</div>
    </div>
 <!--For breadcrump-->    
  <ol class="breadcrumb page-breadcrumb pull-right">
      <li><i class="fa fa-info-circle">&nbsp;&nbsp;</i><a href="<?php echo base_url()?>">Administrator</a></li>
      <li><i class="fa fa-info-circle">&nbsp;&nbsp;</i><a href="<?php echo base_url()?>category">Manage Category</a></li>
  </ol>  
  <!--For breadcrump end-->
    <div class="clearfix"></div>
</div>
<!--END TITLE & BREADCRUMB PAGE-->
<!--BEGIN CONTENT-->

            <div class="page-content">
                <div id="table-action" class="row">
                    <div class="col-lg-12">
                        
                        <div id="tableactionTabContent" class="tab-content">
                            <div id="table-table-tab" class="tab-pane fade in active">
                                
                                
                                    <!-- Start : main content loads from here -->   
    
                                <div class="row">
                                    <div class="col-lg-12"><h4 class="box-heading">Category Search Panel</h4>

                                        <div class="table-container">
                                            <form name="frmSearch" id="frmSearch" method="post" action="<?php echo base_url()?>category/search">
                                            <div class="row mbl">
                                                <div class="col-lg-6">
                                                    <div class="input-group input-group-sm mbs">
                                                    
                                                    <input type="text" id="search_keyword" name="search_str" placeholder="Enter category..." class="form-control" value="" />
                                                    <input type="hidden" name="action" value="Process">   
                                                    <span class="input-group-btn">
                                                        <button type="submit" class="btn btn-success" onclick=" return searchValidation();">Search</button>
                                                    </span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    
                                                   
                                                    <button class="btn btn-sm btn-primary" name="btn_show_all" id="btn_show_all" onclick="javascript:show_all('<?php echo base_url()?>category');"><i class="fa "></i>&nbsp;
                                                            Show All
                                                    </button>
                                                    
                                                    <div class="tb-group-actions pull-right">
                                                    <div class="actions"><a href="<?php echo base_url()?>category/add" class="btn btn-info btn-sm"><i class="fa fa-plus"></i>&nbsp;
                                                    Add Category</a>&nbsp;
                                                    </div>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            </form>
                                            <div class="row mbm">
                                               
                                                <div class="col-lg-8 text-right">
                                                    <div class="pagination-panel">
                                                        
                                                            <?php //echo $paging;?>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            <table class="table table-hover table-striped table-bordered table-advanced tablesorter tb-sticky-header">
                                                <thead>
                                                <tr>
                                                     <tr>
                                                    <th width="5%">#</th>
                                                    <th width="15%" style="text-align:center" >Category</th>
                                                    <th width="5%" align="center">Status</th>
                                                    <th width="12%">Actions</th>
                                                </tr>
                                                </tr>
						<tr bgcolor="">
                                                <td colspan="4" align="center" height="50" class="no-result">Sorry no record found!</td>
                                                </tr>

                                                <tbody>
                                                 
                           
                                                </tbody>
                                                </thead></table>
                                                <div class="row mbm">
                                                <div class="col-lg-6">
                                                   
                                                </div>
                                                <div class="col-lg-6 text-right">
                                                    <div class="pagination-panel">
                                                        
                                                            <?php //echo $paging;?>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                       </div>
                    </div>
                </div>
            </div>
<script>
  
  function searchValidation()
  {
    if ( $("#search_keyword").val() == '')
    {
       custom_alert("Search Field Must Contain Category Name");
       $("#search_keyword").css('border-color','red');
       $("#search_keyword").focus();
       return false;
    }
    return true;    
  }
  
    
</script>
<!--END CONTENT-->
<!--BEGIN CONTENT QUICK SIDEBAR-->

<!--END CONTENT QUICK SIDEBAR-->
