<?php

#########################################################################
#                                                                       #
#			This is User model.                             #
#	                                         			#
#									#
#									#
#									#
#									#
#									#
#########################################################################


class Model_badge extends CI_Model {

    function __construct()

    {

       parent::__construct();

    }


#########################################################
#              GET ALL USER                             #
#                                                       #
#                                                       #
#                                                       #
#########################################################


	function allBadgeDB($search_by='', $limit='', $offset=0) {

            $this->db->select('*');
            $this->db->from('dipp_badge');
            if($limit > 0) {
		$this->db->limit($limit, $offset);
            }
            $this->db->order_by('badge_id','ASC');
            if($search_by <> '')
            {
                $this->db->like('badge_name',$search_by);
            }
            $query=$this->db->get();
            //echo $this->db->last_query();
	    //pr($query->result_array());
            return $query->result_array();

	}

#########################################################
#              GET TOTAL USER NUMBER                    #
#                                                       #
#                                                       #
#                                                       #
#########################################################

	function countBadgeDB($search_by='')
        {

            $this->db->select('count(*) as total_badge',false);
            $this->db->from('dipp_badge');
            if($search_by <> '')
            {
                $this->db->like('badge_name',$search_by);
            }
            $query = $this->db->get();
            $result = $query->result_array();
            return $result[0]['total_badge'];

	}
#########################################################
#          CHECK USER EXIST OR NOT                      #
#                                                       #
#                                                       #
#                                                       #
#########################################################

        function badgeExistsDB($condition_arr=array()) {
            $this->db->select('*');
            $this->db->from('dipp_badge');
            $this->db->where($condition_arr);
            $query = $this->db->get();
            $num = $query->num_rows();
            return ($num > 0) ? TRUE : FALSE;
        }

#########################################################
#              ADD INSTRUCTOR INTO DATABASE                   #
#                                                       #
#                                                       #
#                                                       #
#########################################################

        function addBadgeDB($insert_arr=array()) {
            $this->db->insert('dipp_badge', $insert_arr);
            return $this->db->insert_id();

	}

#########################################################
#              EDIT USER INTO DATABASE                  #
#                                                       #
#                                                       #
#                                                       #
#########################################################

        function editBadgeDB($update_arr=array(),$condition_arr=array()) {
            $this->db->where($condition_arr);
            $update         = $this->db->update('dipp_badge', $update_arr);
            if($update) {
                return TRUE;
            } else {
                return FALSE;
            }
	}

#########################################################
#              DETAILS USER                             #
#                                                       #
#                                                       #
#                                                       #
#########################################################

        function detailsBadgeDB($condition_arr=array())
        {

            $this->db->select('*');
            $this->db->from('dipp_badge');
            $this->db->where($condition_arr);
            $query=$this->db->get();
            return $query->result_array();
        }
	
	
//	function packageList($condition_arr=array())
//        {
//
//            $this->db->select('*');
//            $this->db->from('dipp_package');
//            $this->db->where($condition_arr);
//            $query=$this->db->get();
//            return $query->result_array();
//        }
	
//	function courseList($condition_arr=array()){
//	    $this->db->select('*');
//            $this->db->from('dipp_course_master');
//            $this->db->where($condition_arr);
//            $query=$this->db->get();
//            return $query->result_array();
//	}
#########################################################
#              USER STATUS CHANGE                       #
#                                                       #
#                                                       #
#                                                       #
#########################################################
        
    function statusChangeBadgeDB($badge_id = 0) {
        $conditionArr       = array('badge_id' => $badge_id);
        $inst_detail        = $this->detailsBadgeDB($conditionArr);
        $inst_status        = $inst_detail[0]['badge_status'];
        $status             =($inst_status == 'Active')?'Inactive':'Active';
        
        $updateArr          = array('badge_status' => $status);

        $update             = $this->editBadgeDB($updateArr,$conditionArr);
        if( $update ) {
            return TRUE;
        } else {
            return FALSE;
        }
    }


#########################################################
#              DELETE USER                              #
#                                                       #
#                                                       #
#                                                       #
#########################################################

    function deleteBadgeDB($condition_arr=array()) {
	$this->db->where($condition_arr);
	$this->db->delete('dipp_badge');
	if($this->db->affected_rows() > 0) {
	    return TRUE;
	} else {
	    return FALSE;
	}
    }
        
        
}