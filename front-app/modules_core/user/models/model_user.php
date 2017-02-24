<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Model_user extends CI_Model
{
	public function __construct()
	{
	    // Call the Model constructor
	    parent::__construct();
	}

	function userDB($user_id) {

            $this->db->select('UM.*,UC.*');
            $this->db->select('GROUP_CONCAT(CM.name) as user_course',true);
            $this->db->from('dt_user_master UM');
            $this->db->join('dt_user_course UC', 'UM.user_id = UC.user_id','LEFT');
            $this->db->join('dt_course_master CM', 'UC.course_id = CM.id','LEFT');
	    $this->db->where('UM.user_id',$user_id);
            $this->db->order_by('UM.user_id','DESC');
            $this->db->group_by('UM.user_id');
            $query=$this->db->get();
//            echo $this->db->last_query();
//	    pr($query->result_array());
            return $query->result_array();

	}
}