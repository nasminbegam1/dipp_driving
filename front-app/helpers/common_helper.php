<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if( !function_exists('pr') ) {
    function pr($arr,$e=1) {
        if(is_array($arr)) {
            echo "<pre>";
            print_r($arr);
            echo "</pre>";
        } else {
            echo "<br>Not an array...<br>";
            echo "<pre>";
            var_dump($arr);
            echo "</pre>";
        }
        if($e==1) {
            exit();
        } else {
            echo "<br>";
        }
    }
}

if ( ! function_exists('flash_message')){
        function flash_message()
        {
            // get flash message from CI instance
            $ci =& get_instance();
            $flashmsg = $ci->session->flashdata('message');

            /*$html = '';
            if (is_array($flashmsg))
            {
                $html = '<div id="flashmessage" class="'.$flashmsg['type'].'">
                    <img style="float: right; cursor: pointer" id="closemessage" src="'.base_url().'images/delete_icon.gif" />
                    <span style="font-size:16px"><strong>'.$flashmsg['title'].'</strong></span>
                    <p style="font-size:12px;font-weight:bold">'.$flashmsg['content'].'</p>
                    </div>';
            }
            return $html;
            */
            return $flashmsg;
        }
    }

if( ! function_exists('sub_string')) {
    function sub_string($str='',$count=''){
        $len = strlen($str);
        if($len > $count) {
            $sub_str = substr($str,0,$count)."...";
        } else {
            $sub_str = $str;
        }
        return stripslashes($sub_str);
    }
}


if( ! function_exists('sub_word')) {
    function sub_word($str, $limit) {
        $text = explode(' ', $str, $limit);
        if (count($text)>=$limit)  {
            array_pop($text);
            $text = implode(" ",$text).'...';
        } else {
            $text = implode(" ",$text);
        }
        $text = preg_replace('`\[[^\]]*\]`','',$text);
        return $text;
    }
}


if( ! function_exists('server_absolute_path')) {
    function server_absolute_path() {
        $CI =& get_instance();
        return $CI->config->slash_item('server_absolute_path');
    }
}


if( !function_exists('file_upload_absolute_path')) {
    function file_upload_absolute_path() {
        $CI =& get_instance();
	return $CI->config->slash_item('file_upload_absolute_path');
    }
}


if( !function_exists('file_upload_base_url')) {
    function file_upload_base_url() {
        $CI =& get_instance();
        return $CI->config->slash_item('file_upload_base_url');
    }
}

if ( ! function_exists('get_random_password'))
{
    /**
     * Generate a random password.
     *
     * get_random_password() will return a random password with length 6-8 of lowercase letters only.
     *
     * @access    public
     * @param    $chars_min the minimum length of password (optional, default 6)
     * @param    $chars_max the maximum length of password (optional, default 8)
     * @param    $use_upper_case boolean use upper case for letters, means stronger password (optional, default false)
     * @param    $include_numbers boolean include numbers, means stronger password (optional, default false)
     * @param    $include_special_chars include special characters, means stronger password (optional, default false)
     *
     * @return    string containing a random password
     */
    function get_random_password($chars_min=6, $chars_max=8, $use_upper_case=false, $include_numbers=true, $include_special_chars=false)
    {
        $length = rand($chars_min, $chars_max);
        $selection = 'aeuoyibcdfghjklmnpqrstvwxz';
        if($include_numbers) {
            $selection .= "1234567890";
        }
        if($include_special_chars) {
            $selection .= "!@04f7c318ad0360bd7b04c980f950833f11c0b1d1quot;#$%&[]{}?|";
        }

        $password = "";
        for($i=0; $i<$length; $i++) {
            $current_letter = $use_upper_case ? (rand(0,1) ? strtoupper($selection[(rand() % strlen($selection))]) : $selection[(rand() % strlen($selection))]) : $selection[(rand() % strlen($selection))];
            $password .=  $current_letter;
        }

        return $password;
    }
}

if(!function_exists('currentClass')){
	function currentClass(){
		$CI = & get_instance();
		$class = $CI->router->class;
		return  $class;
	}
}

if(!function_exists('currentMethod')){
	function currentMethod(){
		$CI = & get_instance();
		$method = $CI->router->method;
		return  $method;
	}
}

if(!function_exists('activate_menu')){
function activate_menu($controller='',$method='',$segment='') {
    // Getting CI class instance.
    $CI = get_instance();
    $ControllerClass = currentClass();
    $ControllerMethod = currentMethod();
    $segmentVal=$CI->uri->segment(3);
    $activeClass      = ''; 
    
    // Getting router class to active.
    if($controller !='' && $method!='' && $segment=='')
    {    
        if(($ControllerClass == $controller) && ($ControllerMethod == $method)) {
            $activeClass='active';
        }
        
     }
     else {
        if(($ControllerClass == $controller) && ($ControllerMethod == $method) && ($segment == $segmentVal)) {
               $activeClass='active';
           }
     } 
     
     if(($ControllerClass == 'learn') && ($ControllerMethod == 'learn_details') && ($segment == '2')) {
                $activeClass='active';
     }
     
     if(($ControllerClass == 'practice') && ($segment == '6')) {
                $activeClass='active';
     }
     
     return $activeClass;
   }
}

function get_time_difference_php($created_time)
 {
       //date_default_timezone_set('Asia/Calcutta'); //Change as per your default time
        $str = strtotime($created_time);
        $today = strtotime(date('Y-m-d H:i:s'));

        // It returns the time difference in Seconds...
        $time_differnce = $today-$str;

        // To Calculate the time difference in Years...
        $years = 60*60*24*365;

        // To Calculate the time difference in Months...
        $months = 60*60*24*30;

        // To Calculate the time difference in Days...
        $days = 60*60*24;

        // To Calculate the time difference in Hours...
        $hours = 60*60;

        // To Calculate the time difference in Minutes...
        $minutes = 60;

        if(intval($time_differnce/$years) > 1)
        {
            return intval($time_differnce/$years)." years ago";
        }else if(intval($time_differnce/$years) > 0)
        {
            return intval($time_differnce/$years)." year ago";
        }else if(intval($time_differnce/$months) > 1)
        {
            return intval($time_differnce/$months)." months ago";
        }else if(intval(($time_differnce/$months)) > 0)
        {
            return intval(($time_differnce/$months))." month ago";
        }else if(intval(($time_differnce/$days)) > 1)
        {
            return intval(($time_differnce/$days))." days ago";
        }else if (intval(($time_differnce/$days)) > 0) 
        {
            return intval(($time_differnce/$days))." day ago";
        }else if (intval(($time_differnce/$hours)) > 1) 
        {
            return intval(($time_differnce/$hours))." hours ago";
        }else if (intval(($time_differnce/$hours)) > 0) 
        {
            return intval(($time_differnce/$hours))." hour ago";
        }else if (intval(($time_differnce/$minutes)) > 1) 
        {
            return intval(($time_differnce/$minutes))." minutes ago";
        }else if (intval(($time_differnce/$minutes)) > 0) 
        {
            return intval(($time_differnce/$minutes))." minute ago";
        }else if (intval(($time_differnce)) > 1) 
        {
            return intval(($time_differnce))." seconds ago";
        }else
        {
            return "few seconds ago";
        }
  }