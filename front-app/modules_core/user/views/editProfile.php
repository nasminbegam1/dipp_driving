<div class="wrap innerAdmin editPassword">
<h2><i class="fa fa-list"></i>Edit Profile</h2>
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
    <label>First Name:<span>*</span></label>
    <input name="user_fname" id="user_fname" type="text" required value="<?php echo $user_details[0]['user_fname']!=''?stripslashes($user_details[0]['user_fname']):'';?>" placeholder="Enter user first name">
    <label> Last Name:<span>*</span></label>
    <input name="user_lname" id="user_lname" type="text" required value="<?php echo $user_details[0]['user_lname']!=''?stripslashes($user_details[0]['user_lname']):'';?>" placeholder="Enter user last name">
     <label> Email Address:</label>
    <input readonly type="text" value="<?php echo $user_details[0]['user_email']!=''?stripslashes($user_details[0]['user_email']):'';?>">
    <div class="editProfileBtn"><input type="submit" value="Edit Profile" id="editProfile" /></div>
  </form>
 </div>