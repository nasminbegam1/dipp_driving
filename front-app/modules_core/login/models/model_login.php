<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Model_login extends CI_Model
{
	public function __construct()
	{
	    // Call the Model constructor
	    parent::__construct();
	}

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
	public function check_instructor(){
		$instructor_email    	= trim($this->input->get_post('instructor_email'));
		$instructor_password  	= trim($this->input->get_post('instructor_password'));
		$where			= "INS.instructor_email = '".$instructor_email."' AND BINARY INS.instructor_password = '".$instructor_password."' AND instructor_status ='Active' AND instructor_payment_status <> 'cancel'";
	
		$this->db->select('INS.*,CM.slug');
		$this->db->from(INSTRUCTOR .' AS INS');
		$this->db->join(COURSE_MASTER.' AS CM', 'INS.course_id = CM.id');
		
		$this->db->where($where);
		$query = $this->db->get();
		$result=$query->result_array();
		return $result;
	}
}