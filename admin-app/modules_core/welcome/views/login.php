
<!--    <header class="navbar navbar-default navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
				<a class="navbar-brand" href="#">Driver Theory CRM Administrative Panel Admin</a>
			</div>
			<div class="pull-right">
				<ul class="nav navbar-nav">
					<li class="active"><a href="#" class="login_toggle">Log In</a></li>
					<li><a href="#" class="register_toggle">Forgot Password</a></li>
					<li><a href="#">Help</a></li>
				</ul>
			</div>
		</div>
    </header>-->
   	
<div class="adminLogo"><a href="<?php echo BACKEND_URL;?>"><img src="<?php echo FRONTEND_URL.'images/logo.png'; ?>" alt="dipp driving" /></a></div>

	<div class="login_wrapper">
		<div class="login_panel log_section">
				<h1 class="login_head">Admin LogIn</h1>
				
			
            
            <?php if(!empty($msg)){?>
                   <div class="login_head">
                        <div class="" style="font-weight:bold; color:red;"><?php echo $msg;?></div>
                    </div>
             <?php } ?>
            <div class="leftLoginpanel">
			<form action="<?php echo BACKEND_URL;?>welcome/authenticate/" class="form-validate" id="login_form" method="post">
				<div class="form-group">
					<input type="email" id="login_username" name="email" class="form-control required input-lg" data-required="true" data-minlength="6" data-required-message="Please enter a valid Email" value="<?php if(isset($_COOKIE['ucookname'])){echo $_COOKIE['ucookname'];}?>" placeholder="Email">
				</div>
				<div class="form-group">
					<input type="password" id="login_password" name="password" class="form-control required input-lg" data-required="true" data-minlength="6" data-minlength-message="Password should have at least 6 characters." data-required-message="Please enter a valid Password" value="<?php if(isset($_COOKIE['ucookpass'])){echo $_COOKIE['ucookpass'];}?>" placeholder="Password">
				</div>

				<div class="login_submit">
					<button class="btn btn-primary btn-block btn-lg">Log In</button>
				</div>
				<!--<div class="text-center">
					<small>Forgot password? <a class="form_toggle" href="#reg_form"> Click here</a></small>
				</div>-->
			</form>
			</div>
	    <div class="rightLoginpanel"><img src="<?php echo FRONTEND_URL.'images/lockImg.png'; ?>" title="" /></div>
		</div>
		<div class="login_panel reg_section" style="display:none">
				<h1 class="login_head">Forgot Password</h1>
            
            <?php if(!empty($msg)){?>
                   <div class="login_head">
                        <div class="" style="font-weight:bold; color:red;"><?php echo $msg;?></div>
                    </div>
             <?php } ?>
            
            <div class="leftLoginpanel">
			<form action="<?php echo BACKEND_URL; ?>welcome/do_forgotpassword/" method="post" id="register_form" class="form-validate">
            	<input type="hidden" name="mode" value="">				
				<div class="form-group">
					<input type="test" id="register_email" name="email" class="form-control required input-lg" placeholder="Email"/>
				</div>
				<div class="login_submit">
					<button class="btn btn-primary btn-block btn-lg">Get Password</button>
				</div>
				<div class="text-center">
					<small>Never mind, <a class="form_toggle" href="#login_form">send me back to the sign-in screen</a></small>
				</div>
			</form>
            </div>
	    <div class="rightLoginpanel"><img src="<?php echo FRONTEND_URL.'images/lockImg.png'; ?>" title="" /></div>
		</div>
	</div>
		<!-- jquery cookie -->
	<script src="<?php echo BACKEND_JS_PATH; ?>lib/parsley/parsley.min.js"></script>
	<script>
		$(function() {
			
			
			//* change form
			$('.form_toggle').on('click',function(e){
				$('.login_panel').slideToggle(function() {
					if($('.log_section').is(':visible')) {
						$('.login_toggle').closest('li').addClass('active').siblings('li').removeClass('active');
					} else {
						$('.register_toggle').closest('li').addClass('active').siblings('li').removeClass('active');
					}
				});
				e.preventDefault();
			});
			
			$('.login_toggle').on('click',function(e){
				if($('.log_section').is(':hidden')) {
					$('.reg_section').slideUp();
					$('.log_section').slideDown();
					$(this).closest('li').addClass('active').siblings('li').removeClass('active');
				}
				e.preventDefault();
			});
			$('.register_toggle').on('click',function(e){
				if($('.reg_section').is(':hidden')) {
					$('.log_section').slideUp();
					$('.reg_section').slideDown();
					$(this).closest('li').addClass('active').siblings('li').removeClass('active');
				}
				e.preventDefault();
			});
			
			// set theme from cookie
			if($.cookie('ebro_color') != undefined) {
				$('#theme').attr('href','css/theme/'+$.cookie('ebro_color')+'.css');
			}
			
		});
	</script>