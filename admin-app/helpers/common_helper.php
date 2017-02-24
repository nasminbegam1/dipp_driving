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

if(!function_exists('csv_to_array')){
function csv_to_array($filename='', $delimiter=',')
{
	if(!file_exists($filename) || !is_readable($filename))
		return FALSE;
	
	$header = NULL;
	$data = array();
	if (($handle = fopen($filename, 'r')) !== FALSE)
	{
		while (($row = fgetcsv($handle, 1000, $delimiter)) !== FALSE)
		{
			if(!$header)
				$header = $row;
			else
				$data[] = array_combine($header, $row);
		}
		fclose($handle);
	}
	return $data;
}
}