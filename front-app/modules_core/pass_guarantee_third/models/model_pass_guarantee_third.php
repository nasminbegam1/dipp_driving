<?php

#########################################################################
#                                                                       #
#			This is Student model.                          #
#	                                         			#
#									#
#									#
#									#
#									#
#									#
#########################################################################


class Model_Pass_guarantee_third extends CI_Model {

    function __construct()
    {
	parent::__construct();
    }


#########################################################
#              GET ALL COURSE TYPE                      #
#                                                       #
#                                                       #
#                                                       #
#########################################################


	function getDetails($table,$condition_arr=array()) {
            $this->db->from($table);
	    $this->db->where($condition_arr);
            $query=$this->db->get();
            return $query->result_array();

	}
	
#########################################################
#              ADD PASS GUARANTEE INTO DATABASE                #
#                                                       #
#                                                       #
#                                                       #
#########################################################

        function addGuarantDB($insert_arr=array()) {
            $this->db->insert(BOOKING_MASTER, $insert_arr);
            return $this->db->insert_id();

	}
	
#########################################################
#              GET BOOKING DETAILS                      #
#                                                       #
#                                                       #
#                                                       #
#########################################################

	function getGuarantDB($condition_arr=array())
        {
            $this->db->from(BOOKING_MASTER);
	    $this->db->where($condition_arr);
            $query=$this->db->get();
            return $query->row();

	}
	
	
#########################################################
#              GET NEAR BY LOCATION                     #
#                                                       #
#                                                       #
#                                                       #
#########################################################

	public function getNearByZipcode($latN,$latS,$lonE,$lonW,$lat1,$lon1){
		$query = "SELECT * FROM ".TEST_CENTRE." WHERE (latitude <= $latN AND latitude >= $latS AND longitude <= $lonE AND longitude >= $lonW) AND (latitude != $lat1 AND longitude != $lon1) AND status='Active' ORDER BY latitude, longitude";
                $res   = $this->db->query($query);
		if($res->num_rows()>0){
			return $res->result_array();
		}
		return false;
	}
	
	public function getLatLong($post_code){
	    $this->db->from(TEST_CENTRE);
	    $this->db->where(array('zip_code' => $post_code));
            $query=$this->db->get();
            return $query->row();
	}
        
}