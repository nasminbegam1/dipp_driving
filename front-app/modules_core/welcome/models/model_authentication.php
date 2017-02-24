<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Model_authentication extends CI_Model
{
	public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
#########################################################
#              ADMIN LOGIN                              #
#                                                       #
#                                                       #
#                                                       #
#########################################################

    public function check_authentication() {
        
	$student_email    	= trim($this->input->get_post('student_email'));
	$student_password  	= trim($this->input->get_post('student_password'));
	$student_username  	= trim($this->input->get_post('student_username'));
        $where="student_email = '".$student_email."' AND BINARY student_password = '".$student_password."' AND student_status ='Active' AND student_username='".$student_username."'";

        $this->db->select('*');
        $this->db->from(STUDENT);
        $this->db->where($where);
        $query = $this->db->get();
        $result=$query->result_array();
        return $result;
    }

}

