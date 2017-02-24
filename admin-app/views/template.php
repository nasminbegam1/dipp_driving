<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Driver Instructor Partner Program Admin Panel</title>
<meta charset="UTF-8">
<meta http-equiv="Cache-Control" content="no-cache" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Expires" content="0" />
<link rel="shortcut icon" type="image/x-icon" href="<?php echo BACKEND_IMAGE_PATH; ?>favicon.ico">
<link rel="stylesheet" href="<?php echo BACKEND_URL; ?>bootstrap/css/bootstrap.min.css"><!-- bootstrap framework-->
<link rel="stylesheet" href="<?php echo BACKEND_URL; ?>css/admin.css">
<link rel="stylesheet" href="<?php echo BACKEND_CSS_PATH; ?>todc-bootstrap.min.css"><!-- todc-bootstrap -->
<link rel="stylesheet" href="<?php echo BACKEND_CSS_PATH; ?>font-awesome/css/font-awesome.min.css"><!-- font awesome -->
<link rel="stylesheet" href="<?php echo BACKEND_URL; ?>images/flags/flags.css"><!-- flag icon set -->
<link rel="stylesheet" href="<?php echo BACKEND_CSS_PATH; ?>retina.css"> <!-- retina ready -->  
<link rel="stylesheet" href="<?php echo BACKEND_CSS_PATH; ?>style.css"><!-- ebro styles -->
<link rel="stylesheet" href="<?php echo BACKEND_CSS_PATH; ?>theme/color_6.css" id="theme"><!-- ebro theme --> 
<link rel="stylesheet" href="<?php echo BACKEND_CSS_PATH; ?>hint-css/hint.css"><!-- hint.css -->    
<link rel="stylesheet" href="<?php echo BACKEND_JS_PATH; ?>lib/FooTable/css/footable.core.css" type="text/css"/><!-- responsive table -->    
<link rel="stylesheet" href="<?php echo BACKEND_CSS_PATH; ?>custom_style.css"><!-- custom styles added by WDC-->
<link rel="stylesheet"  href="<?php echo BACKEND_CSS_PATH; ?>jquery-ui-1.10.4.custom.min.css">
<link rel="stylesheet" href="<?php echo BACKEND_JS_PATH; ?>lib/multi-select/css/multi-select.css"><!-- 2col multiselect -->
<link rel="stylesheet" href="<?php echo BACKEND_JS_PATH; ?>lib/multi-select/css/ebro_multi-select.css"> 
<link rel="stylesheet" href="<?php echo BACKEND_JS_PATH; ?>lib/select2/select2.css"><!-- select2 --> 
<link type="text/css" rel="stylesheet" href="<?php echo BACKEND_URL; ?>vendors/sco.message/sco.message.css">    

<script src="<?php echo BACKEND_JS_PATH ;?>jquery-1.11.3.min.js"></script>
<script src="<?php echo BACKEND_JS_PATH; ?>jquery-ui.js"></script>
<script src="<?php echo BACKEND_URL; ?>bootstrap/js/bootstrap.min.js"></script><!-- bootstrap framework -->
<script src="<?php echo BACKEND_JS_PATH; ?>jquery.ba-resize.min.js"></script><!-- jQuery resize event -->
<script src="<?php echo BACKEND_JS_PATH; ?>jquery_cookie.min.js"></script><!-- jquery cookie -->
<script src="<?php echo BACKEND_JS_PATH; ?>jquery.sticky.js"></script><!-- sticky sidebar -->
<script src="<?php echo BACKEND_JS_PATH; ?>pages/ebro_dashboard2.js"></script>    
<script src="<?php echo BACKEND_JS_PATH; ?>lib/FooTable/js/footable.js"></script><!-- footable for responsive tables -->
<script src="<?php echo BACKEND_JS_PATH; ?>lib/FooTable/js/footable.sort.js"></script><!-- footable sort -->
<script src="<?php echo BACKEND_JS_PATH; ?>pages/ebro_responsive_table.js"></script><!-- footable responsive table -->    
<script src="<?php echo BACKEND_JS_PATH; ?>lib/multi-select/js/jquery.multi-select.js"></script><!-- 2col multiselect -->
<script src="<?php echo BACKEND_JS_PATH; ?>lib/select2/select2.min.js"></script><!-- select2 -->
<script src="<?php echo BACKEND_URL; ?>vendors/sco.message/sco.message.js"></script>
<script src="<?php echo BACKEND_URL; ?>vendors/jquery-validate/jquery.validate.min.js"></script>
<script src="<?php echo BACKEND_JS_PATH; ?>form-validation.js"></script>


<style>
.state-error + em {
display: block;
margin-top: 6px;
padding: 0 1px;
font-style: normal;
font-size: 11px;
line-height: 15px;
color: #d9534f;
}
.state-success + em {
display: block;
margin-top: 6px;
padding: 0 1px;
font-style: normal;
font-size: 11px;
line-height: 15px;
color: #5cb85c;
}
.state-error input,
.state-error select {
background: #f2dede;
}
.state-success input,
.state-success select {
background: #dff0d8;
}
.state-success .form-control {
border-color: #7edc7f !important;
}
.state-warning .form-control {
border-color: #dcb359 !important;
}
.state-error .form-control {
border-color: #db4c4a !important;
}
.state-success em {
color: #7edc7f !important;
margin-top: 5px;
display: block;
}
.state-warning em {
color: #dcb359 !important;
margin-top: 5px;
display: block;
}
.state-error em {
color: #db4c4a !important;
margin-top: 5px;
display: block;
}
.state-success input,
.state-success select,
.state-success textarea {
background: #dff0d8 !important;
}
.state-warning input,
.state-warning select,
.state-warning textarea {
background: #fcf8e3 !important;
}
.state-error input,
.state-error select,
.state-error textarea {
background: #f2dede !important;
}

</style>

<script type="text/javascript">
var _baseUrl 	= "<?php echo base_url();?>";
<?php
$getMessage=flash_message();
$message_type="";
$message_content="";
if(count($getMessage) > 0)
{
    $message_type=$getMessage['type'];
    $message_content=$getMessage['content'];
} 
?>
    var  msg_type = '<?php echo $message_type;?>';
    var  msg_content = '<?php echo $message_content ?>';
   $(document).ready(function(){ 
        if (msg_type == 'successmsgbox') {
              $.scojs_message(msg_content, $.scojs_message.TYPE_OK);
        }
        if (msg_type == 'errormsgbox') {
              $.scojs_message(msg_content, $.scojs_message.TYPE_ERROR);
        }
        
    });
</script>
<script src="<?php echo BACKEND_JS_PATH; ?>custom.js"></script><!-- custom js functions added by WDC -->

</head>
<?php
$body_class =	'class="sidebar_narrow full_width"';
$contoller 	= $this->router->class;
$method 	= $this->router->method;
if($contoller == 'welcome' && $method == 'index')
{
    $body_class = "";
}    
$login = $this->session->userdata('admin_id');
?>
<body <?php echo $body_class;?> >
    <?php if( $login && !empty($login)){ ?>
    <!-- START : header and menu section will go here for logged in pages--> 
    <div id="wrapper_all">			
    <!--START : header is loaded here-->		
    <?=isset($header)?$header:'';?>
    <!--END : header here-->
    <!--START : top navigation is loaded here-->
    <?=isset($top_menu)?$top_menu:'';?>	            			
    <!--END : top navigation here-->
    
    <section class="container clearfix main_section">
    <div id="main_content_outer" class="clearfix">
    <!--Start : show the main center block here that will be loaded from the method of the controller called-->
    <?=isset($content)?$content:'';?> 
    <!--End : show the main content block-->
    </div>
    <?=isset($sidebar)?$sidebar:'';?>
    </section>	
    <div id="footer_space"></div>
    </div>
    <!-- END : header & menu section -->
    <?php } else { ?>
    <!--Start : show the main center block here that will be loaded from the method of the controller called-->
    <?=isset($content)?$content:'';?> 
    <!--End : show the main content block-->
    <?php } ?>
    <?php if($login != ''){ ?>
    <!-- START : footer section will go here for logged in pages --> 
    <?=isset($footer)?$footer:'';?>
    <!-- END : footer section -->
    <?php } ?>
</body>
</html>
