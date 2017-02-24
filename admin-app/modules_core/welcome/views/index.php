<?php //require_once('/home/senabide/public_html/auth/phpclient.php');
$errorMsg='';
if($_POST['loginbtn'])
{
    $uname=$_POST['user_name'];
    $upass=$_POST['user_pass'];

    if($uname =='admin' && $upass=='admin')
    {
        header('Location:dashboard.php');
    }
    else
    {
        $errorMsg="Please enter correct Username/password";
    }

}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Commision</title>

<link rel="stylesheet" type="text/css" href="styles/main.css" />
<link rel="stylesheet" type="text/css" href="styles/chromestyle.css" />
</head>
<body>

<!--mainbodycontainer-->
<div id="mainbodycontainer">

  <div id="header_container"><div id="logo"><a href="index.php"><img src="images/logo.png" /></a></div></div>

  <!--body_container-->
  <div id="body_container">
    <!--Navigation-->
    <div class="chromestyle" id="chromemenu" align="left">

    </div>


    <div class="mainbody">
      <div  class="body_txt">

        <!-- log-pannel -->
        <div class="log_seg">
        <h1> Log <span class="blue_txt">in</span></h1>
        <p class="header_line"></p>
        <form name="frm" action="index.php" method="post">
            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non.</p><br />
            <?php
            if(isset($errorMsg) && $errorMsg <>'') { ?>
            <p style="color:red;"><?=$errorMsg;?>
            <?php } ?>
            <p class="input-text"> User Name: <br /> <input name="user_name" type="text" class="input-100" /></p>
            <p class="input-text"> Password: <br /> <input name="user_pass" type="password" class="input-100" /></p>
            <p class="input-text"> <input name="loginbtn" type="submit" value="Login" class="send-btn"/></p>
            <p class="forgetps"><a href="#">Forget password?</a></p>
        </form>
        </div>
        <!-- log-pannel-end -->
        <div class="spacer"></div>
      </div><!--body_txt-->
    </div><!--mainbody-->

    <!--Footer-->
    <div id="footer_container">
      <?php include('footer.php') ?>
    </div>
    <!--Footer-->


  </div>
  <!--end-body_container-->
</div>
<!--end mainbodycontainer-->
</body>
</html>
