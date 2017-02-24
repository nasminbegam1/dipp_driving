<section>
  <div class="container">
    <article>                          
        <div class="faq-box">
          <h3 class="heading-txt">faqs</h3>
          
          <!--accordian-->
          <div id="custom-show-hide-example">
            <?php if(is_array($result) && count($result)>0){
              foreach($result as $k=>$fr){ ?>
              <h4 <?php echo ($k==0)?'class="open"':'class="accor_close"'; ?>><?php echo stripslashes($fr['question']);?></h4>
              <div>
                <p><?php echo stripslashes($fr['answer']); ?></p>
              </div>
            <?php } }else{?>
            No record found
            <?php } ?>
          </div>
          <!--end accordian-->
      </div>
        
    </article>
  </div>        
</section>