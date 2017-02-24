<?php

#########################################################################
#                                                                       #
#			This is banner model.                         	#
#	                                         			#
#									#
#########################################################################


class Model_banner extends CI_Model {

    function __construct()

    {

       parent::__construct();

    }


#########################################################
#              GET ALL banner                          #
#########################################################


	function allTopicDB($search_by='', $limit='', $offset=0,$condition_arr=array()) {

           
            $this->db->select('BM.*');
            $this->db->from('dipp_banner BM');
            if(count($condition_arr) > 0) {
                $this->db->where($condition_arr); 
            }
            if($limit > 0) 
            {
                $this->db->limit($limit, $offset);
            }
            $this->db->order_by('BM.id','DESC');
            if($search_by <> '')
            {
                $this->db->like('BM.banner_title',$search_by);
             }
            $query=$this->db->get();
            //echo $this->db->last_query();
            return $query->result_array();

	}

#########################################################
#              GET TOTAL banner NUMBER                	#
#########################################################

	function countTopicDB($search_by='',$condition_arr=array())
        {

            $this->db->select('SUM(IF(BM.id<>"",1,0)) as total_topic',false);
            $this->db->from('dipp_banner BM');
            if(count($condition_arr) > 0) {
                $this->db->where($condition_arr); 
            }
            if($search_by <> '')
            {
                $this->db->like('BM.banner_title',$search_by);
            }
            $query = $this->db->get();
            //echo $this->db->last_query();
            $result = $query->result_array();
            return $result[0]['total_topic'];

	}

#########################################################
#              ADD banner INTO DATABASE                  #
#                                                       #
#                                                       #
#                                                       #
#########################################################

        function addTopicDB($insert_arr=array()) {
            $this->db->insert('dipp_banner', $insert_arr);
            return $this->db->insert_id();

	}
#########################################################
#              EDIT banner INTO DATABASE              #
#########################################################

        function editTopicDB($update_arr=array(),$condition_arr=array()) {
            $this->db->where($condition_arr);
            $update   = $this->db->update('dipp_banner', $update_arr);
            if($update) {
                return TRUE;
            } else {
                return FALSE;
            }
	}

#########################################################
#              DETAILS banner                         #
#########################################################

        function detailsTopicDB($condition_arr=array())
        {

            $this->db->select('*');
            $this->db->from('dipp_banner');
            $this->db->where($condition_arr);
            $query=$this->db->get();
            return $query->result_array();
        }

#########################################################
#              CATEGORY STATUS CHANGE                   #
#########################################################
        
    function statusChangeTopicDB($id = 0) {
        $conditionArr       = array('id' => $id);
        $banner_detail       = $this->detailsTopicDB($conditionArr);
        $banner_status       = $banner_detail[0]['banner_status'];
        $status             = ($banner_status == 'Active')?'Inactive':'Active';
        
        $updateArr          = array('banner_status' => $status);

        $update             = $this->editTopicDB($updateArr,$conditionArr);
        if( $update ) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
#########################################################
#          CHECK banner EXIST OR NOT                     #
#########################################################

        function topicExistsDB($condition_arr=array())
	{
            $this->db->select('*');
            $this->db->from('dipp_banner');
            $this->db->where($condition_arr);
            $query = $this->db->get();
            $num = $query->num_rows();
            return ($num > 0) ? TRUE : FALSE;
        }
	
########################################################
#		GET ALL banner				#
########################################################

    function getAllTopicDB($condition_arr = array(), $limit='')
    {
        $this->db->select('TM.*');
	$this->db->from('dt_topic_master TM');
	if(count($condition_arr) > 0) {
	    $this->db->where($condition_arr); 
	}
	if($limit > 0) 
	{
	    $this->db->limit($limit, $offset);
	}
	$this->db->order_by('TM.id','DESC');
	
	$query=$this->db->get();
	//echo $this->db->last_query();
	return $query->result_array();
    }
}