<section>
  <div class="container">
    <article>                          
        <div class="news-box">
          <h3 class="heading-txt">NEWS</h3>
          <div>
            <ul class="newsList">
            <?php if(is_array($result) && count($result)>0){
              foreach($result as $k=>$fr){ ?>
              <li class="large">
                  <div class="news_content">
                    <div class="content"><img src="<?php echo FILE_UPLOAD_URL?>news/thumbs/<?php echo $fr['image'];?>" border="0"></div>
                    <div class="hover">
                        <p><?php echo stripslashes($fr['title']);?></p>
                        <p><a href="<?php echo base_url().'news/details/'.$fr['id'];?>">Read More</a></p>
                    </div>
                  </div>
              </li>
            <?php } }else{?>
            <li>No record found</li>
            <?php } ?>
            </ul>
          </div>
      </div>
        
    </article>
  </div>        
</section>