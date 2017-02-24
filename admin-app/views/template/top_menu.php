<nav id="top_navigation" class="text_nav">
    <div class="container">
	<?php
	$currentClass 		=  $this->router->class;
	$currentMethod 		=  $this->router->method;
	$segment 		= $this->uri->segment(1);
	?>
    <!--for user_role = 'admin'-->
        <ul id="text_nav_h" class="clearfix j_menu top_text_nav">
            <li <?php if($currentClass == 'dashboard' && $currentMethod == 'index'){echo "class='active'";}?>>
                <a href="<?php echo BACKEND_URL; ?>dashboard">Dashboard</a>
            </li>
	    <li <?php if($currentClass == 'sitesettings' && ($currentMethod == 'index' || $currentMethod == 'all' || $currentMethod == 'edit')){echo "class='active'";}?>>
                <a href="<?php echo BACKEND_URL;?>sitesettings">Settings</a>
            </li>
	    <li <?php if($currentClass == 'packages' && ($currentMethod == 'index' || $currentMethod == 'all' || $currentMethod == 'add' || $currentMethod == 'edit')){echo "class='active'";}?>>
                <a href="<?php echo BACKEND_URL; ?>packages">Packages</a>
            </li>
	    <li <?php if($currentClass == 'instructor' && ($currentMethod == 'index' || $currentMethod == 'all' || $currentMethod == 'search' || $currentMethod == 'add' || $currentMethod == 'edit')){echo "class='active'";}?>>
                <a href="<?php echo BACKEND_URL; ?>instructor">Instructor</a>
            </li>
             <li <?php if($currentClass == 'instructor' && ($currentMethod == 'index' || $currentMethod == 'banner' || $currentMethod == 'search' || $currentMethod == 'banner_add' || $currentMethod == 'banner_edit')){echo "class='active'";}?>>
                <a href="<?php echo BACKEND_URL; ?>instructor/banner">Instructor Banner</a>
            </li>
	    <li <?php if($currentClass == 'student' && ($currentMethod == 'index' || $currentMethod == 'all' || $currentMethod == 'search' || $currentMethod == 'add' || $currentMethod == 'edit')){echo "class='active'";}?>>
                <a href="<?php echo BACKEND_URL; ?>student">Student</a>
            </li>
            
	    
	    <li <?php if($currentClass == 'course' && ($currentMethod == 'index' || $currentMethod == 'edit' || $currentMethod == 'all')){echo "class='active'";}?>>
                <a href="<?php echo BACKEND_URL;?>course">Course</a>
            </li>
	    
	    <li <?php if($currentClass == 'step' && ($currentMethod == 'index' || $currentMethod == 'edit' || $currentMethod == 'all')){echo "class='active'";}?>>
                <a href="<?php echo BACKEND_URL;?>step">Step</a>
            </li>

	    <li <?php if($currentClass == 'topic' && ($currentMethod == 'index' || $currentMethod == 'add' || $currentMethod == 'edit'|| $currentMethod == 'all')){echo "class='active'";}?>>
                <a href="<?php echo BACKEND_URL;?>topic">Topic</a>
            </li>
	    
	    <li <?php if($currentClass == 'lesson' && ($currentMethod == 'index' || $currentMethod == 'add' || $currentMethod == 'edit' || $currentMethod == 'all')){echo "class='active'";}?>>
                <a href="<?php echo BACKEND_URL;?>lesson">Lessons</a>
            </li>
	    <li <?php if($currentClass == 'module' && ($currentMethod == 'index' || $currentMethod == 'add' || $currentMethod == 'edit' || $currentMethod == 'all')){echo "class='active'";}?>>
                <a href="<?php echo BACKEND_URL;?>module">Module Master</a>
            </li>
	    <li <?php if($segment != 'mock-test' && $currentClass == 'question' && ($currentMethod == 'index' || $currentMethod == 'add' || $currentMethod == 'edit' || $currentMethod == 'all')){echo "class='active'";}?>>
                <a href="<?php echo BACKEND_URL;?>question">Practice Question Master</a>
            </li>
            
             <li <?php if($segment == 'mock-test' && $currentClass == 'question' && ($currentMethod == 'index' || $currentMethod == 'add' || $currentMethod == 'edit' || $currentMethod == 'all')){echo "class='active'";}?>>
                <a href="<?php echo BACKEND_URL;?>mock-test/question">Mock Test Question</a>
            </li>
	    <li <?php if($currentClass == 'news' && ($currentMethod == 'index' || $currentMethod == 'all' || $currentMethod == 'search' || $currentMethod == 'add' || $currentMethod == 'edit')){echo "class='active'";}?>>             
            <a href="<?php echo BACKEND_URL; ?>news" title="News">News</a>
	    </li>
	    <li <?php if($currentClass == 'banner' && ($currentMethod == 'index' || $currentMethod == 'all' || $currentMethod == 'search' || $currentMethod == 'add' || $currentMethod == 'edit')){echo "class='active'";}?>>             
            <a href="<?php echo BACKEND_URL; ?>banner" title="Banner">Banner</a>
	    </li>
	    <li <?php if($currentClass == 'advertisement' && ($currentMethod == 'index' || $currentMethod == 'all' || $currentMethod == 'search' || $currentMethod == 'add' || $currentMethod == 'edit')){echo "class='active'";}?>>             
            <a href="<?php echo BACKEND_URL; ?>advertisement" title="Advertisement">Advertisement</a>
	    </li>
	    <li <?php if($currentClass == 'testimonial' && ($currentMethod == 'index' || $currentMethod == 'all' || $currentMethod == 'search' || $currentMethod == 'add' || $currentMethod == 'edit')){echo "class='active'";}?>>
		<a href="<?php echo BACKEND_URL; ?>testimonial">Testimonial</a>
	    </li>
	    <li <?php if($currentClass == 'test_centre' && ($currentMethod == 'index' || $currentMethod == 'all' || $currentMethod == 'search' || $currentMethod == 'add' || $currentMethod == 'edit')){echo "class='active'";}?>>
		<a href="<?php echo BACKEND_URL; ?>test_centre">Test Centre</a>
	    </li>
	    <li <?php if($currentClass == 'faq' && ($currentMethod == 'index' || $currentMethod == 'all' || $currentMethod == 'add' || $currentMethod == 'edit'|| $currentMethod == 'viewFaq' || $currentMethod == 'all')){echo "class='active'";}?>>
		<a href="<?php echo BACKEND_URL; ?>faq">FAQ</a>
	    </li>
	    <li <?php if($currentClass == 'cms' && ($currentMethod == 'index' || $currentMethod == 'all' || $currentMethod == 'edit' || $currentMethod == 'all')){echo "class='active'";}?>>
                <a href="<?php echo BACKEND_URL;?>cms">CMS</a>
            </li>
	    
	    <li <?php if($currentClass == 'badge' && ($currentMethod == 'index' || $currentMethod == 'all' || $currentMethod == 'search' || $currentMethod == 'add' || $currentMethod == 'edit')){echo "class='active'";}?>>
                <a href="<?php echo BACKEND_URL; ?>badge">Badge</a>
            </li>
	    
	    <li <?php if($currentClass == 'payment' && ($currentMethod == 'index' || $currentMethod == 'all' || $currentMethod == 'search')){echo "class='active'";}?>>
                <a href="<?php echo BACKEND_URL; ?>payment">Payment Details</a>
            </li>
            <!--<li <?php if($currentClass == 'user' && ($currentMethod == 'all'  || $currentMethod == 'edit')){echo "class='active'";}?>>
                <a href="<?php echo BACKEND_URL;?>user/all">User</a>
            </li>
	   
	    
	    <li>
                <a href="<?php echo BACKEND_URL;?>hazard">Hazard Master</a>
            </li>-->
	    
	    <!--<li <?php if($currentClass == 'testimonial' && ($currentMethod == 'index' || $currentMethod == 'add' || $currentMethod == 'edit')){echo "class='active'";}?>>
		<a href="<?php echo BACKEND_URL; ?>testimonial">Testimonial</a>
	    </li>-->
	  </ul>
    </div>
</nav>    