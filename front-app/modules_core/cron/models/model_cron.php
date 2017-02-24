<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Model_cron extends CI_Model
{
	public function __construct()
	{
	    // Call the Model constructor
	    parent::__construct();
	}
	
	function checkPayment(){
		
		$this->db->from(INSTRUCTOR_PAYMENT);
		$this->db->group_by("instructor_id");
		$this->db->order_by('payment_date','desc');
		$query = $this->db->get();
		if($query->num_rows()>0){
			return $query->result_array();
		}
		return false;
	}
        
}