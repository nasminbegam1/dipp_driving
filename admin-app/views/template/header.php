<header id="top_header">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-sm-2">
               <!--  FILE_UPLOAD_URL."admin/".$user_info[0]['image'];  -->
               <a href="<?php echo BACKEND_URL; ?>" class="logo_main" title="Admin Panel"><img src="<?php echo FRONTEND_URL.'images/logo.png'; ?>" alt="dipp driving" width="270" height="80"></a> 
             </div>
            <div class="col-sm-push-4 col-sm-3 text-right hidden-xs">
            </div>
            <div class="col-xs-6 col-sm-push-4 col-sm-3">
                <div class="pull-right dropdown">
                    <a href="#" class="user_info dropdown-toggle" title="" data-toggle="dropdown">
                       <?php
                        $user_image = '';
                        $image = $this->session->userdata('user_image');
                        if(file_exists(FILE_UPLOAD_ABSOLUTE_PATH.'admin/'.$image) && $image != "")
                        {
                            $user_image = FILE_UPLOAD_URL."admin/".$image;
                        }
                        else
                        {
                            $user_image = BACKEND_IMAGE_PATH."user_avatar.png";
                        }
                       ?>                       
                       <img src="<?php echo $user_image; ?>" alt="" style="width:38px; height: 38px;">                       
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!--<li><a href="<?php echo BACKEND_URL.'adminusers/profile/' ?>">Profile</a></li>-->
                        <li><a href="<?php echo BACKEND_URL.'welcome/logout/';?>">Log Out</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-xs-12 col-sm-pull-6 col-sm-4">&nbsp;
                
            </div>
        </div>
    </div>
</header>