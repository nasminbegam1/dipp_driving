<!doctype html>
<html lang="en">
	 <head>
		  <meta charset="utf-8">
		  <meta http-equiv="X-UA-Compatible" content="IE=edge">
		  <meta name="viewport" content="width=device-width, initial-scale=1">    
		  <title>Dipp Driving</title>    
		  <link href="<?php echo base_url();?>css/style.css" rel="stylesheet">    
		  <link href="<?php echo base_url();?>css/jquery.bxslider.css" rel="stylesheet" />
		  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/video/style.css" />
		  <!--font-->
		  <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
	      
		  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		  <!--[if lt IE 9]>
		  
		    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		  <![endif]-->
		  
		  <script type="text/javascript" src="<?php echo base_url();?>js/jquery-latest.min.js"></script>
		  <script type="text/javascript" src="<?php echo base_url();?>js/custom.js"></script>
		  <script type="text/javascript" src="<?php echo base_url();?>js/jquery.validate.js"></script>
		  <script type="text/javascript" src="<?php echo base_url();?>js/jquery.blockUI.js"></script>
		  
		  <!-- FANCYBOX -->
		  <script type="text/javascript" src="<?php echo base_url();?>js/jquery.fancybox.js?v=2.1.5"></script>
		  <script type="text/javascript" src="<?php echo base_url();?>js/jquery.fancyboxbox.transitions.js"></script>
		  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/fancybox/jquery.fancybox.css?v=2.1.5" media="screen">
		  <!-- FANCYBOX -->
		  
		  <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
		  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
		  <script src="<?php echo base_url();?>js/main.js"></script>
		  
		  <!-- COUNTDOWN TIMER -->
		  <script type="text/javascript" src="<?php echo base_url();?>js/jquery.timeTo.js"></script>
		  <link rel="stylesheet" href="<?php echo base_url();?>css/timeTo.css" type="text/css" rel="stylesheet"/>
		  <!-- COUNTDOWN TIMER -->
		   <link href="<?php echo base_url();?>css/font-awesome.css" rel="stylesheet">
		  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/owl.carousel.css" media="screen">
		  <link rel="stylesheet" href="<?php echo base_url();?>css/owl.theme.css" />
		  <script type="text/javascript">
			   var _baseUrl 	= "<?php echo base_url();?>";
		  </script>
	 </head>
	 
	 <body>
			<!-- Header Start -->
			<?=isset($header)?$header:'';?>
			<!-- Header End -->

			<main>
				 <?=isset($content)?$content:'';?>
			</main>

			<!-- Footer Start -->
			<footer>
				 <?=isset($footer)?$footer:'';?>
			</footer>
			<!-- Footer End -->
			   <script src="<?php echo base_url();?>js/jquery.bxslider.min.js"></script>
			   <script src="<?php echo base_url();?>js/jquery.collapse.js"></script>
			   <script>
			     $(document).ready(function(){
				    $('.bxslider').bxSlider();
				    $('.bxslider1').bxSlider({
					     minSlides: 1,
					     maxSlides: 3,
					     slideWidth: 380,
					     slideMargin: 10,
					     controls:true,
					     pager:false
				    });
			     });
			   </script>
			   <!--Accordion-->
			   <script>
			       new jQueryCollapse($("#custom-show-hide-example"), {
				 open: function() {
				   this.slideDown(500);
				 },
				 close: function() {
				   this.slideUp(500);
				 }
			       });
			   </script>
	 </body>
</html>