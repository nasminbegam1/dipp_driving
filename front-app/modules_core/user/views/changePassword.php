<div class="wrap innerAdmin editPassword">
<h2><i class="fa fa-list"></i>Change Password</h2>
<?php
    $getMessage=flash_message();
    if(is_array($getMessage) && count($getMessage) > 0)
    {
        $message_type=$getMessage['type'];
        echo '<div class="'.$message_type.'">'.$getMessage['content'].'</div>';
    }
?>
  <form name="form"  action="" method="post" enctype="multipart/form-data" novalidate >
    <input type="hidden" name="action" value="Process">
    <input type="hidden" name="user_id" value="<?php echo $user_details[0]['user_id'];?>">
    <label>Current Password:<span>*</span></label>
    <input name="current_password" id="current_password" type="password" required>
    <label>New password:<span>*</span></label>
    <input name="new_password" id="new_password" type="password" required>
    <label>Confirm password:<span>*</span></label>
    <input name="confirm_password" id="confirm_password" type="password" required>
    <div class="editProfileBtn"><input type="submit" value="Change Password" id="changePassword" /></div>
  </form>
</div>