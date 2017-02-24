<section>
  <div class="container">
    <article>                          
        <div class="price-box">
          <h3 class="heading-txt">pricing</h3>
          <div class="common-txt-box">
            <p><?php echo stripslashes($cms[0]['cms_content']);?></p>                  
          </div>
          <div class="price-area">
            <h3>Free <span class="text-red">14 Days</span> Trial <strong>With All Accounts</strong></h3>
            <ul class="clearfix">
              <?php
              
              if(is_array($packages_details)){
              foreach($packages_details as $packDtls){
              ?>
              <li>                      
                <div class="pannel-header">
                  <h4><?php echo stripslashes($packDtls['package_name']);?></h4>
                  <?php if($packDtls['is_recommended'] == 'Y'){ ?><span class="most_popular">Most Popular</span><?php } ?>
                </div>                      
                <div class="pannel-body">                        
                  <ul>                        
                    <li><span class="price">&pound;<?php echo $packDtls['package_amount'];?></span>for up to <?php echo $packDtls['no_student'];?> Student Users</li>
                    <?php echo $packDtls['package_desc'];?>
                  </ul>
                </div>                      
                <div class="pannel-footer">
                  <a class="btn-price-signup" href="<?php echo base_url().'instructor/signup/'.$packDtls['package_id']; ?>">sign up</a>                        
                </div>                                                                  
              </li>
              <?php } } ?>
            </ul>
          </div>
          
          
        </div>              
    </article>
  </div>        
</section>