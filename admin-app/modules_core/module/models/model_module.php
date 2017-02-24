<?php

#########################################################################
#                                                                       #
#			This is Module model.                         #
#	                                         			#
#									#
#########################################################################


class Model_module extends CI_Model {

    function __construct()
    {
	parent::__construct();
    }


#########################################################
#              GET ALL MODULES                        #
#########################################################


	function allModuleDB($search_by='', $limit='', $offset=0,$condition_arr=array()) {

           
            $this->db->select('MM.*,TM.name as topic_name, SM.name as step_name, CM.name as course_name');
            $this->db->from('dipp_module_master MM');
            $this->db->join('dipp_topic_master TM','MM.topic_id = TM.id');
            $this->db->join('dipp_step_master SM','TM.step_id = SM.id');
            $this->db->join('dipp_course_master CM','SM.course_id = CM.id');
            if(count($condition_arr) > 0) {
                $this->db->where($condition_arr); 
            }
            if($limit > 0) 
            {
                $this->db->limit($limit, $offset);
            }
            $this->db->order_by('MM.module_id','DESC');
            if($search_by <> '')
            {
                $this->db->like('MM.module_name',$search_by);
                $this->db->or_like('SM.name',$search_by);
                 $this->db->or_like('TM.name',$search_by);
             }
            $query=$this->db->get();
            //echo $this->db->last_query();
            return $query->result_array();

	}

#########################################################
#              GET TOTAL MODULE NUMBER                  #
#########################################################

	function countModuleDB($search_by='',$condition_arr=array())
        {

            $this->db->select('SUM(IF(MM.module_id<>"",1,0)) as total_module',false);
            $this->db->from('dipp_module_master MM');
            $this->db->join('dipp_topic_master TM','MM.topic_id = TM.id');
            $this->db->join('dipp_step_master SM','TM.step_id = SM.id');
            $this->db->join('dipp_course_master CM','SM.course_id = CM.id');
            if(count($condition_arr) > 0) {
                $this->db->where($condition_arr); 
            }
            if($search_by <> '')
            {
               $this->db->like('MM.module_name',$search_by);
               $this->db->or_like('SM.name',$search_by);
                $this->db->or_like('TM.name',$search_by);
            }
            $query = $this->db->get();
            //echo $this->db->last_query(); exit;
            $result = $query->result_array();
            return $result[0]['total_module'];

	}

#########################################################
#              ADD MODULE INTO DATABASE                 #
#                                                       #
#                                                       #
#                                                       #
#########################################################

        function addModuleDB($insert_arr=array()) {
            $this->db->insert('dipp_module_master', $insert_arr);
            return $this->db->insert_id();

	}
#########################################################
#              EDIT QUESTION INTO DATABASE              #
#########################################################

        function editModuleDB($update_arr=array(),$condition_arr=array()) {
            $this->db->where($condition_arr);
            $update   = $this->db->update('dipp_module_master MM', $update_arr);
	    //echo $this->db->last_query();exit();
            if($update) {
                return TRUE;
            } else {
                return FALSE;
            }
	}

#########################################################
#              DETAILS MODULE                         #
#########################################################

        function detailsModuleDB($condition_arr=array())
        {

            $this->db->select('MM.*, CM.id as course_id, CM.name as course_name, SM.id AS step_id, SM.name as step_name, TM.id as topic_id, TM.name as topic_name');
            $this->db->from('dipp_module_master MM');
	    $this->db->join('dipp_question_master QM', 'MM.module_id = QM.module_id', 'left');
            $this->db->join('dipp_topic_master TM','MM.topic_id = TM.id', 'left');
            $this->db->join('dipp_step_master SM','TM.step_id = SM.id', 'left');
            $this->db->join('dipp_course_master CM','SM.course_id = CM.id', 'left');
            $this->db->where($condition_arr);
            $query=$this->db->get();
	    //echo $this->db->last_query();exit();
            return $query->result_array();
        }

#########################################################
#              MODULE STATUS CHANGE                   #
#########################################################
        
    function statusChangeModuleDB($module_id = 0) {
        $condition_arr       = array('MM.module_id' => $module_id);
	$this->db->select('MM.*');
	$this->db->from('dipp_module_master MM');
	$this->db->where($condition_arr);
	$query=$this->db->get();
	$arr_module		= $query->result_array(); 
        $module_status      = $arr_module[0]['module_status'];
        $status             = ($module_status == 'Active')?'Inactive':'Active';
        
        $updateArr          = array('MM.module_status' => $status);

        $update             = $this->editModuleDB($updateArr,$condition_arr);
        if( $update ) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
#########################################################
#          CHECK QUESTION EXIST OR NOT                   #
#########################################################

        function moduleExistsDB($condition_arr=array())
	{
            $this->db->select('*');
            $this->db->from('dipp_module_master');
            $this->db->where($condition_arr);
            $query = $this->db->get();
            $num = $query->num_rows();
            return ($num > 0) ? TRUE : FALSE;
        }
	
########################################################
#		GET ALL QUESTION                        #
########################################################

    function getAllQuestionDB($condition_arr = array())
    {
        $this->db->select('QM.*');
	$this->db->from('dipp_question_master QM');
	if(count($condition_arr) > 0) {
	    $this->db->where($condition_arr); 
	}
	$this->db->order_by('QM.question_id','DESC');
	
	$query=$this->db->get();
	//echo $this->db->last_query();
	return $query->result_array();
    }
    
########################################################
#		GET ALL MODULE			       #
########################################################

    function getAllModuleDB($condition_arr = array())
    {
        $this->db->select('MM.*');
	$this->db->from('dipp_module_master MM');
	if(count($condition_arr) > 0) {
	    $this->db->where($condition_arr); 
	}
	$this->db->order_by('MM.module_id','DESC');
	
	$query=$this->db->get();
	//echo $this->db->last_query();
	return $query->result_array();
    }    
}