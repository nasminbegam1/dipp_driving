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


class Model_user extends CI_Model {

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


	function allUserDB($search_by='', $limit='', $offset=0) {

            $this->db->select('UM.*,UC.*');
            $this->db->select('GROUP_CONCAT(CM.name) as user_course',true);
            $this->db->from('dt_user_master UM');
            $this->db->join('dt_user_course UC', 'UM.user_id = UC.user_id','LEFT');
            $this->db->join('dt_course_master CM', 'UC.course_id = CM.id','LEFT');
            if($limit > 0) {
		$this->db->limit($limit, $offset);
            }
            $this->db->order_by('UM.user_id','DESC');
            $this->db->group_by('UM.user_id');
            if($search_by <> '')
            {
                $this->db->like('UM.user_fname',$search_by);
                $this->db->or_like('UM.user_lname',$search_by);
                $this->db->or_like('UM.user_fname',$search_by);
                $this->db->or_like('UM.user_email',$search_by);
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

	function countUserDB($search_by='')
        {

            $this->db->select('SUM(IF(UM.user_id<>"",1,0)) as total_user',false);
            $this->db->from('dt_user_master UM');
            $this->db->join('dt_user_course UC', 'UM.user_id = UC.user_id');
            $this->db->join('dt_course_master CM', 'UC.course_id = CM.id');
            if($search_by <> '')
            {
                $this->db->like('UM.user_fname',$search_by);
                $this->db->or_like('UM.user_lname',$search_by);
                $this->db->or_like('UM.user_fname',$search_by);
                $this->db->or_like('UM.user_email',$search_by);
            }
            $this->db->group_by('UM.user_id');
            $query = $this->db->get();
            $result = $query->result_array();
            return $result[0]['total_user'];

	}
#########################################################
#          CHECK USER EXIST OR NOT                      #
#                                                       #
#                                                       #
#                                                       #
#########################################################

        function userExistsDB($condition_arr=array()) {
            $this->db->select('*');
            $this->db->from('dt_user_master');
            $this->db->where($condition_arr);
            $query = $this->db->get();
            $num = $query->num_rows();
            return ($num > 0) ? TRUE : FALSE;
        }

#########################################################
#              ADD USER INTO DATABASE                   #
#                                                       #
#                                                       #
#                                                       #
#########################################################

        function addUserDB($insert_arr=array()) {
            $this->db->insert('dt_user_master', $insert_arr);
            return $this->db->insert_id();

	}

#########################################################
#              EDIT USER INTO DATABASE                  #
#                                                       #
#                                                       #
#                                                       #
#########################################################

        function editUserDB($update_arr=array(),$condition_arr=array()) {
            $this->db->where($condition_arr);
            $update         = $this->db->update('dt_user_master', $update_arr);
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

        function detailsUserDB($condition_arr=array())
        {

            $this->db->select('*');
            $this->db->from('dt_user_master');
            $this->db->where($condition_arr);
            $query=$this->db->get();
            return $query->result_array();
        }

#########################################################
#              USER STATUS CHANGE                       #
#                                                       #
#                                                       #
#                                                       #
#########################################################
        
    function statusChangeUserDB($user_id = 0) {
        $conditionArr       = array('user_id' => $user_id);
        $user_detail        = $this->detailsUserDB($conditionArr);
        $user_status        = $user_detail[0]['user_status'];
        $status             =($user_status == 'Active')?'Inactive':'Active';
        
        $updateArr          = array('user_status' => $status);

        $update             = $this->editUserDB($updateArr,$conditionArr);
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

        function deleteUserDB($condition_arr=array()) {
            $this->db->where($condition_arr);
            $this->db->delete('dt_user_master');
            if($this->db->affected_rows() > 0) {
                return TRUE;
            } else {
                return FALSE;
            }
	}
        
        
}