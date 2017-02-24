<div id="animationSlide" class="owl-carousel owl-theme">
		<?php
		foreach($lessonDetailsArr as $ldArr){
				$desc_type= $ldArr['desc_type'];
				$desc_content= $ldArr['desc_content'];
				?>
				<div class="item">
						<div class="motorway">
								<?php
								if($desc_type == "text"){
										?>
										<p><?php echo $desc_content; ?></p>
										<?php
								}
								else{
										?>
										<img src="<?php echo file_upload_base_url().'/lesson/'.$desc_content; ?>" />
										<?php
								}
								?>
						</div>
				</div>
				<?php
		}
		?>
</div>