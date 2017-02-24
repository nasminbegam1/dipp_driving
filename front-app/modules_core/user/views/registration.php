<div class="wrap innerAdmin editPassword">
<h2><i class="fa fa-list"></i>New User</h2>
<?php
    $getMessage=$this->session->flashdata('forgot_message');
    if(is_array($getMessage) && count($getMessage) > 0)
    {
        $message_type=$getMessage['type'];
        echo '<div class="'.$message_type.'">'.$getMessage['content'].'</div>';
    }
?>
  <form name="form"  action="" method="post" id="registration" enctype="multipart/form-data" novalidate >
    <input type="hidden" name="action" value="Process">
    <input type="hidden" name="type" value="<?php echo stripslashes($payment_amount[0]['slug']);?>">
    <label>First Name:<span>*</span></label>
    <input name="user_fname" id="user_fname" type="text" required value="" placeholder="Enter user first name">
    <label>Last Name:<span>*</span></label>
    <input name="user_lname" id="user_lname" type="text" required value="" placeholder="Enter user last name">
    <label>Email Address:<span>*</span></label>
    <input type="text" name="user_email" id="user_email" value="" placeholder="Enter user email address">
    <span class="errormsgbox" id="error_user_email"></span>
    <label>Confirm Email Address:<span>*</span></label>
    <input type="text" name="conf_user_email" id="conf_user_email" value="" placeholder="Enter confirm email address">
    <label>Password<span>*</span></label>
    <input type="password" name="user_password" id="user_password" value="" placeholder="Enter Password">
    <label>Confirm Password<span>*</span></label>
    <input type="password" name="conf_password" id="conf_password" value="" placeholder="Enter Confirm Password">
    <div class="termsCls"><input type="checkbox" name="terms" value="" id="terms"><p>I accept the <a href="<?php echo FRONTEND_URL.'terms-of-use/'?>">Terms of Use</a></p></div>
    <div class="editProfileBtn"><input type="submit" value="Continue as new user" id="registration" /></div>
  </form>
 </div>