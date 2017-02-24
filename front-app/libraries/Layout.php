<?php
/**
 * For include header footer
 */

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Layout {

    private $ci;
    function __construct($config = array())
	{
            $this->ci =& get_instance();
        }

    public function get_menu()
        {
            $header_data=array();
            $header_data['title']="MY MENU HERE";
            return $header_data;
        }

   public function get_footer()
        {
            $footer_data=array();
            $footer_data['title']="MY FOOTER HERE";
            return $footer_data;
        }

}