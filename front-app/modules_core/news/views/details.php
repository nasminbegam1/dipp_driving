<style>
    .news-box h4 {
    color: #000000;
    font-size: 12px;
    line-height: 20px;
    margin: 0 0;
    padding: 4px 0;
    text-align: center;
}
.news-box .red {
    color: #EF0000;
    text-decoration: none;
}
</style>
<section>
  <div class="container">
    <article>                          
        <div class="news-box">
          <h3 class="heading-txt"><?php echo $result[0]['title']; ?></h3>
          <h4>by + <span class="red">admin</span>. Posted on <?php echo $result[0]['news_add_date']; ?></h4>
          <p><?php echo stripslashes($result[0]['description']); ?></p>
          <p><img src="<?php echo FILE_UPLOAD_URL?>news/thumbs/<?php echo $result[0]['image'];?>" border="0"></p>
      </div>
        
    </article>
  </div>        
</section>