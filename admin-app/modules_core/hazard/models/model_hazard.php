<?php

#########################################################################
#                                                                       #
#			This is Hazard model.                         	#
#	                                         			#
#									#
#########################################################################


class Model_hazard extends CI_Model {

    function __construct()
    {

       parent::__construct();
    }

#########################################################
#              GET ALL HAZARDS                          #
#########################################################


	function allHazardDB($search_by='', $limit='', $offset=0) {


            $this->db->select('H.*, CM.name AS course_name');
            $this->db->from('dt_hazard H');
	    $this->db->join('dt_course_master CM', 'H.course_id = CM.id', 'left');
            if($limit > 0)
	    {
		$this->db->limit($limit, $offset);
	    }
            
	    $this->db->order_by('H.hazard_id','ASC');
            
	    if($search_by <> '')
            {
		$this->db->like('H.hazard_title',$search_by);
            }
            
	    $query=$this->db->get();
            //echo $this->db->last_query();
            return $query->result_array();

	}

#########################################################
#              GET TOTAL HAZARD NUMBER                	#
#########################################################

	function countHazardDB($search_by='')
        {

            $this->db->select('SUM(IF(H.hazard_id<>"",1,0)) as total_hazard',false);
            $this->db->from('dt_hazard H');
	    $this->db->join('dt_course_master CM', 'H.course_id = CM.id', 'left');
            if($search_by <> '')
            {
                $this->db->like('H.hazard_title',$search_by);
            }
            $query = $this->db->get();
            $result = $query->result_array();
            return $result[0]['total_hazard'];

	}


#########################################################
#              EDIT HAZARD INTO DATABASE              #
#########################################################

        function editHazardDB($update_arr=array(),$condition_arr=array()) {
            $this->db->where($condition_arr);
            $update         = $this->db->update('dt_hazard H', $update_arr);
            if($update) {
                return TRUE;
            } else {
                return FALSE;
            }
	}

#########################################################
#              DETAILS HAZARD                           #
#########################################################

        function detailsHazardDB($condition_arr=array())
        {

            $this->db->select('H.*, CM.name AS course_name');
            $this->db->from('dt_hazard AS H');
	    $this->db->join('dt_course_master AS CM', 'H.course_id = CM.id', 'left');
            $this->db->where($condition_arr);
            $query=$this->db->get();
            return $query->result_array();
        }


#########################################################
#              HAZARD STATUS CHANGE                   #
#########################################################
        
    function statusChangeHazardDB($hazard_id = 0) {
        $condition_arr       = array('H.hazard_id' => $hazard_id);
	$this->db->select('H.*');
	$this->db->from('dt_hazard H');
	$this->db->where($condition_arr);
	$query=$this->db->get();
	
	$arr_module	    = $query->result_array(); 
        $hazard_status      = $arr_module[0]['hazard_status'];
        $status             = ($hazard_status == 'Active')?'Inactive':'Active';
        
        $updateArr          = array('H.hazard_status' => $status);

        $update             = $this->editHazardDB($updateArr,$condition_arr);
        if( $update ) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
#########################################################
#          CHECK HAZARD EXIST OR NOT                    #
#########################################################

        function hazardExistsDB($condition_arr=array())
	{
            $this->db->select('H.*');
            $this->db->from('dt_hazard H');
            $this->db->where($condition_arr);
            $query = $this->db->get();
            $num = $query->num_rows();
            return ($num > 0) ? TRUE : FALSE;
        }
	
#########################################################
#              ADD MODULE INTO DATABASE                 #
#########################################################

        function addHazardDB($insert_arr=array()) {
            $this->db->insert('dt_hazard', $insert_arr);
            return $this->db->insert_id();

	}
        
}