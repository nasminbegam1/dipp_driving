<?php //pr($breadcrump,0); ?>
<section id="breadcrumbs">
  <div class="container">
    <ul>
      <li><a href="<?php echo BACKEND_URL; ?>">Dashboard</a></li>
      <?php if($breadcrump){
		foreach($breadcrump as $key=>$value){
			if($value == ''){ ?>
				<li><span><?php echo $key; ?></span></li>
			<?php } else {?>
				<li><a href="<?php echo $value; ?>" class="no-cache-redirect"><?php echo $key; ?></a></li>
			<?php } ?>
		<?php }
	} ?>
    </ul>
  </div>
</section>

