<div class="wrap innerAdmin editPassword">
<h2><i class="fa fa-list"></i>Change Password</h2>
<?php
    $getMessage = $this->session->flashdata('forgot_message');
    
    if(is_array($getMessage) && count($getMessage) > 0)
    {
        $message_type=$getMessage['type'];
        echo '<div class="'.$message_type.'">'.$getMessage['content'].'</div>';
    }
?>
  <form name="form"  action="" method="post" enctype="multipart/form-data" novalidate >
    <input type="hidden" name="action" value="Process">
    <label>Email:<span>*</span></label>
    <input name="user_email" id="user_email" type="text" required placeholder="Please enter email address">
    <span class="errormsgbox" id="error_user_email"></span>
    <div class="editProfileBtn"><input type="submit" value="Send reset link" id="sendResetLink" /></div>
  </form>
</div>