<section>
  <div class="container">
    <article>                          
        <div class="signup-box">
          
          <h3 class="heading-txt">log in</h3>
            <?php
                $getMessage=flash_message();
                if(is_array($getMessage) && count($getMessage) > 0)
                {
                    $message_type=$getMessage['type'];
                    echo '<div class="'.$message_type.'">'.$getMessage['content'].'</div>';
                }
            ?>
          <div class="car-theory clearfix">
            
            <h3>CAR<strong>THEORY</strong></h3>
            <div class="st-login">
              
              <h4>STUDENT <strong>LOGIN</strong></h4>
              <form name="form" id="studentCarLogin" action="" method="post" enctype="multipart/form-data" novalidate>
                <input type="hidden" name="login_from" value="student">
                <input type="hidden" name="login_type" value="car">
                <input type="hidden" name="action" value="Process">
                    
                <div class="input-box1">
                  <label>Email</label>
                  <input class="input1" name="student_email" type="text" required value="" placeholder="Enter Email" />
                </div>
                <div class="input-box2">
                  <label>Password</label>
                  <input class="input" name="student_password" type="password" required value="" placeholder="Enter Password" />
                </div>
                <div class="input-box2">
                  <label>Business Code</label>
                  <input class="input" type="text" name="student_username"  value="" placeholder="Enter Business Code"/>
                </div>
                
                <button type="submit" class="btn-login">Log In</button>
                <p><a class="fps" href="<?php echo base_url().'student/forgotPassword'; ?>">Forgot Password</a></p>
               
              </form>                    
            </div>
            
            <div class="st-login">
              
              <h4>DRIVING<strong>INSTRUCTOR LOGIN</strong></h4>
              <form name="form" id="instructorCarLogin" action="" method="post" enctype="multipart/form-data" novalidate>
                <input type="hidden" name="login_type" value="car">
                <input type="hidden" name="action" value="Process">
                <input type="hidden" name="login_from" value="instructor">
                <div class="input-box1">
                  <label>Email</label>
                  <input class="input1" type="text"  name="instructor_email" required value="" placeholder="Enter Email"/>
                </div>
                <div class="input-box1">
                  <label>Password</label>
                  <input class="input" name="instructor_password" type="password" required value="" placeholder="Enter Password" />
                </div>                      
                
                <button type="submit" class="btn-login">Log In</button>
                <p><a class="fps" href="<?php echo base_url().'instructor/forgotPassword'; ?>">Forgot Password</a> / <a class="fps" href="<?php echo base_url().'instructor/choose_type/2'; ?>">Sign up</a></p>
               
              </form>                    
            </div>                                   
          </div>
          
          <div class="car-theory clearfix bikeLogin">
            
            <h3>MOTORCYCLE <strong>THEORY</strong></h3>
            <div class="st-login">
              
              <h4>STUDENT <strong>LOGIN</strong></h4>
              <form name="form" id="studentBikeLogin" action="" method="post" enctype="multipart/form-data" novalidate >
                <input type="hidden" name="action" value="Process">
                <input type="hidden" name="login_type" value="bike">
                <input type="hidden" name="login_from" value="student">
                    
                <div class="input-box1">
                  <label>Email</label>
                  <input class="input1" name="student_email" type="text" required value="" placeholder="Enter Email" />
                </div>
                <div class="input-box2">
                  <label>Password</label>
                  <input name="student_password" type="password" required value="" placeholder="Enter Password" />
                </div>
                <div class="input-box2">
                  <label>Business Code</label>
                  <input class="input" type="text" name="student_username"  value="" placeholder="Enter Business Code"/>
                </div>
                
                <button type="submit" class="btn-login">Log In</button>
                <p><a class="fps" href="<?php echo base_url().'student/forgotPassword'; ?>">Forgot Password</a></p>
               
              </form>                    
            </div>
            
            <div class="st-login">
                    
                    <h4>DRIVING <strong>INSTRUCTOR LOGIn</strong></h4>
                    <form name="form" id="instructorBikeLogin" action="" method="post" enctype="multipart/form-data" novalidate>
                        <input type="hidden" name="action" value="Process">
                        <input type="hidden" name="login_type" value="bike">
                        <input type="hidden" name="login_from" value="instructor">
                      <div class="input-box1">
                        <label>Email</label>
                        <input class="input1" name="instructor_email" type="text" required value="" placeholder="Enter Email" />
                      </div>
                      <div class="input-box1">
                        <label>Password</label>
                        <input class="input" name="instructor_password" type="password" required value="" placeholder="Enter Password" />
                      </div>                      
                      <button type="submit" class="btn-login">Log In</button>
                      <p><a class="fps" href="<?php echo base_url().'instructor/forgotPassword'; ?>">Forgot Password</a> / <a class="fps" href="<?php echo base_url().'instructor/choose_type/1'; ?>">Sign up</a></p>
                     
                    </form>                    
                  </div>                                    
          </div>
          
        </div>
        
        
        
        
    </article>
  </div>        
</section>