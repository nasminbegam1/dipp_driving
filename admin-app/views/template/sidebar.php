<nav id="sidebar">
    <ul id="icon_nav_v" class="side_ico_nav">
        <li <?php if(currentClass()=='dashboard' ) { echo ' class="active"';} ?>>
            <a href="<?php echo BACKEND_URL; ?>dashboard" title="Dashboard"><i class="fa fa-home"></i></a>
        </li>
	
	<li <?php if(currentClass()=='sitesettings' ) { echo ' class="active"';} ?>>             
            <a href="<?php echo BACKEND_URL; ?>sitesettings" title="Settings"><i class="fa fa-wrench"></i></a>
        </li>
	
	<li <?php if(currentClass()=='packages' ) { echo ' class="active"';} ?>>             
            <a href="<?php echo BACKEND_URL; ?>packages" title="Packages"><i class="glyphicon glyphicon-list"></i></a>
        </li>
	
	<li <?php if(currentClass()=='instructor' ) { echo ' class="active"';} ?>>             
            <a href="<?php echo BACKEND_URL; ?>instructor" title="Instructor"><i class="fa fa-caret-square-o-down"></i></a>
        </li>
	
	<li <?php if(currentClass()=='student' ) { echo ' class="active"';} ?>>             
            <a href="<?php echo BACKEND_URL; ?>student" title="Student"><i class="fa fa-graduation-cap"></i></a>
        </li>
	<li <?php if(currentClass()=='course' ) { echo ' class="active"';} ?>>             
            <a href="<?php echo BACKEND_URL; ?>course" title="Course"><i class="glyphicon glyphicon-book"></i></a>
        </li>
        
	<li <?php if(currentClass()=='step' ) { echo ' class="active"';} ?>>             
            <a href="<?php echo BACKEND_URL; ?>step" title="Step"><i class="glyphicon glyphicon-move"></i></a>
        </li>

	<li <?php if(currentClass()=='topic' ) { echo ' class="active"';} ?>>             
            <a href="<?php echo BACKEND_URL; ?>topic" title="Topic"><i class="glyphicon glyphicon-new-window"></i></a>
        </li>
	
	<li <?php if(currentClass()=='lesson' ) { echo ' class="active"';} ?>>             
            <a href="<?php echo BACKEND_URL; ?>lesson" title="Lesson"><i class="fa-envelope"></i></a>
        </li>
	
	<li <?php if(currentClass()=='module' ) { echo ' class="active"';} ?>>             
            <a href="<?php echo BACKEND_URL; ?>module" title="Module"><i class="fa fa-folder-open"></i></a>
        </li>
	
	<li <?php if(currentClass()=='question' ) { echo ' class="active"';} ?>>             
            <a href="<?php echo BACKEND_URL; ?>question" title="Question"><i class="glyphicon glyphicon-question-sign"></i></a>
        </li>
	
	<li <?php if(currentClass()=='mock-test/question' ) { echo ' class="active"';} ?>>             
            <a href="<?php echo BACKEND_URL; ?>mock-test/question" title="Mock Test"><i class="glyphicon glyphicon-question-sign"></i></a>
        </li>
	
        <!--
	
	<li <?php if(currentClass()=='hazard' ) { echo ' class="active"';} ?>>             
            <a href="<?php echo BACKEND_URL; ?>hazard" title="Hazard"><i class="glyphicon glyphicon-pushpin"></i></a>
        </li>-->
	<li <?php if(currentClass()=='news' ) { echo ' class="active"';} ?>>             
            <a href="<?php echo BACKEND_URL; ?>news" title="NEWS"><i class="fa fa-newspaper-o"></i></a>
        </li>
	<li <?php if(currentClass()=='banner' ) { echo ' class="active"';} ?>>             
            <a href="<?php echo BACKEND_URL; ?>banner" title="BANNER"><i class="fa fa-picture-o"></i></a>
        </li>
	<li <?php if(currentClass()=='advertisement' ) { echo ' class="active"';} ?>>             
            <a href="<?php echo BACKEND_URL; ?>advertisement" title="ADVERTISEMENT"><i class="fa fa-picture-o"></i></a>
        </li>
	<li <?php if(currentClass()=='testimonial' ) { echo ' class="active"';} ?>>             
            <a href="<?php echo BACKEND_URL; ?>testimonial" title="TESTIMONIAL"><i class="fa fa-quote-left"></i></a>
        </li>
	<li <?php if(currentClass()=='test_centre' ) { echo ' class="active"';} ?>>             
            <a href="<?php echo BACKEND_URL; ?>test_centre" title="TEST CENTRE"><i class="fa fa-location-arrow"></i></a>
        </li>
	<li <?php if(currentClass()=='faq' ) { echo ' class="active"';} ?>>             
            <a href="<?php echo BACKEND_URL; ?>faq" title="FAQ"><i class="fa fa-question"></i></a>
        </li>
	
	<li <?php if(currentClass()=='cms' ) { echo ' class="active"';} ?>>             
            <a href="<?php echo BACKEND_URL; ?>cms" title="CMS"><i class="fa fa-bolt"></i></a>
        </li>
        
    </ul>
</nav>