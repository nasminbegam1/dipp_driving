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


class Model_Pass_guarantee extends CI_Model {

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


	function getDetails($table,$condition_arr=array(),$orderBy='id',$orderByType='ASC') {
            $this->db->from($table);
	    $this->db->where($condition_arr);
	    $this->db->order_by($orderBy,$orderByType);
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
		$query = "SELECT (((acos(sin(($lat1*pi()/180)) *  sin((latitude*pi()/180))+cos(($lat1*pi()/180)) *  cos((latitude*pi()/180)) * cos((($lon1- longitude)* pi()/180))))*180/pi())*60*1.1515 ) as distance,zip_code,name,address,id

FROM ".TEST_CENTRE." WHERE (latitude <= $latN AND latitude >= $latS AND longitude <= $lonE AND longitude >= $lonW) AND status='Active' ORDER BY distance";
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
	
#########################################################
#              UPDATE PASS GUARANTEE INTO DATABASE      #
#                                                       #
#                                                       #
#                                                       #
#########################################################

	public function updateGuarantDB($update_arr=array(),$condition_arr=array()){
            $this->db->where($condition_arr);
            $update   = $this->db->update(BOOKING_MASTER, $update_arr);
            if($update) {
                return TRUE;
            } else {
                return FALSE;
            }
	}
	
	public function deleteGuarantDB($condition_arr=array()){
            $this->db->where($condition_arr);
            $delete   = $this->db->delete(PREFFERDATE);
	    
            if($delete) {
                return TRUE;
            } else {
                return FALSE;
            }
	}
#####################Update Booking Master Table After Successful Payment####################################
public function updateBookingMasterDB($update_arr=array(),$condition_arr=array()){
            $this->db->where($condition_arr);
            $update   = $this->db->update(BOOKING_MASTER, $update_arr);
            if($update) {
                return TRUE;
            } else {
                return FALSE;
            }
	}
#####################Insert Into Booking Payment Table After Successful Payment####################################
function addBookingPaymentDB($insert_arr=array()) {
            $this->db->insert(BOOKING_PAYMENT, $insert_arr);
            return $this->db->insert_id();

	}
}