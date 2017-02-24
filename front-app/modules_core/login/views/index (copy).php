<div class="wrap">

<?php
    $getMessage=flash_message();
    if(is_array($getMessage) && count($getMessage) > 0)
    {
        $message_type=$getMessage['type'];
        echo '<div class="'.$message_type.'">'.$getMessage['content'].'</div>';
    }
?>
<h2><i class="fa fa-list"></i>Student Login car Theory</h2>
  <form name="form" id="studentCarLogin" action="" method="post" enctype="multipart/form-data" novalidate >
    <input type="hidden" name="login_from" value="student">
    <input type="hidden" name="login_type" value="car">
    <input type="hidden" name="action" value="Process">
    <label>Email:<span>*</span></label>
    <input name="student_email" type="text" required value="" placeholder="Enter Email">
    <label>Password:<span>*</span></label>
    <input name="student_password" type="password" required value="" placeholder="Enter Password">
    <label>Business Code:<span>*</span></label>
    <input type="text" name="student_username"  value="" placeholder="Enter Business Code">
    <input type="submit" value="Login"/>
    <a href="<?php echo base_url().'student/forgotPassword'; ?>">Forgot password</a>
  </form>
  <h2><i class="fa fa-list"></i>Student Login motorcycle Theory</h2>
  <form name="form" id="studentBikeLogin" action="" method="post" enctype="multipart/form-data" novalidate >
    <input type="hidden" name="action" value="Process">
    <input type="hidden" name="login_type" value="bike">
    <input type="hidden" name="login_from" value="student">
    <label>Email:<span>*</span></label>
    <input name="student_email" type="text" required value="" placeholder="Enter Email">
    <label>Password:<span>*</span></label>
    <input name="student_password" type="password" required value="" placeholder="Enter Password">
     <label>Business Code:<span>*</span></label>
    <input type="text" name="student_username"  value="" placeholder="Enter Business Code">
    <input type="submit" value="Login"/>
    <a href="<?php echo base_url().'student/forgotPassword'; ?>">Forgot password</a>
  </form>
  
  <h2><i class="fa fa-list"></i>Instructor Login car Theory</h2>
  <form name="form" id="instructorCarLogin" action="" method="post" enctype="multipart/form-data" novalidate >
    <input type="hidden" name="login_type" value="car">
    <input type="hidden" name="action" value="Process">
    <input type="hidden" name="login_from" value="instructor">
    <label>Email:<span>*</span></label>
    <input name="instructor_email" type="text" required value="" placeholder="Enter Email">
    <label>Password:<span>*</span></label>
    <input name="instructor_password" type="password" required value="" placeholder="Enter Password">
    <input type="submit" value="Login"/>
    <a href="<?php echo base_url().'instructor/forgotPassword'; ?>">Forgot password</a>
  </form>
  
  <h2><i class="fa fa-list"></i>Instructor Login motorcycle Theory</h2>
  <form name="form" id="instructorBikeLogin" action="" method="post" enctype="multipart/form-data" novalidate >
    <input type="hidden" name="action" value="Process">
    <input type="hidden" name="login_type" value="bike">
    <input type="hidden" name="login_from" value="instructor">
    <label>Email:<span>*</span></label>
    <input name="instructor_email" type="text" required value="" placeholder="Enter Email">
    <label>Password:<span>*</span></label>
    <input name="instructor_password" type="password" required value="" placeholder="Enter Password">
    <input type="submit" value="Login"/>
    <a href="<?php echo base_url().'instructor/forgotPassword'; ?>">Forgot password</a>
  </form>
  
 </div>