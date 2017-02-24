<?php

#########################################################################
#                                                                       #
#			This is Question model.                         #
#	                                         			#
#									#
#########################################################################


class Model_faq extends CI_Model {

    function __construct()
    {
	parent::__construct();
    }


#########################################################
#              GET ALL QUESTIONS                        #
#########################################################


    function allFaqDB($search_by='', $limit='', $offset=0,$condition_arr=array()) {
	$this->db->select('*');
	$this->db->from('dipp_faq');
	 if(count($condition_arr) > 0) {
	    $this->db->where($condition_arr); 
	}
	if($limit > 0) 
	{
	    $this->db->limit($limit, $offset);
	}
	$this->db->order_by('id','DESC');
	if($search_by <> '')
	{
	    $this->db->like('question',$search_by);
	 }
	$query=$this->db->get();
	//echo $this->db->last_query();
	return $query->result_array();

    }

#########################################################
#              GET TOTAL QUESTION NUMBER                #
#########################################################

	function countFaqDB($search_by='',$condition_arr=array())
        {

            $this->db->select('SUM(IF(id<>"",1,0)) as total_faq',false);
            $this->db->from('dipp_faq QM');
            if(count($condition_arr) > 0) {
                $this->db->where($condition_arr); 
            }
            if($search_by <> '')
            {
               $this->db->like('question',$search_by);
	       $this->db->or_like('answer',$search_by); 
            }
            $query = $this->db->get();
            //echo $this->db->last_query();
            $result = $query->result_array();
            return $result[0]['total_faq'];

	}

#########################################################
#              ADD QUESTION INTO DATABASE               #
#                                                       #
#                                                       #
#                                                       #
#########################################################

        function addFaqDB($insert_arr=array()) {
            $this->db->insert('dipp_faq', $insert_arr);
            return $this->db->insert_id();

	}
#########################################################
#              EDIT QUESTION INTO DATABASE              #
#########################################################

        function editFaqDB($update_arr=array(),$condition_arr=array()) {
            $this->db->where($condition_arr);
            $update   = $this->db->update('dipp_faq', $update_arr);
            if($update) {
                return TRUE;
            } else {
                return FALSE;
            }
	}

#########################################################
#              DETAILS QUESTION                         #
#########################################################

        function detailsFaqDB($condition_arr=array())
        {

            $this->db->select('*');
            $this->db->from('dipp_faq');
            $this->db->where($condition_arr);
            $query=$this->db->get();
            return $query->result_array();
        }

#########################################################
#              QUESTION STATUS CHANGE                   #
#########################################################
        
    function statusChangeFaqDB($faq_id = 0) {
        $conditionArr       = array('id' => $faq_id);
        $qs_detail          = $this->detailsFaqDB($conditionArr);
        $qs_status          = $qs_detail[0]['status'];
        $status             = ($qs_status == 'Active')?'Inactive':'Active';
        
        $updateArr          = array('status' => $status);

        $update             = $this->editFaqDB($updateArr,$conditionArr);
        if( $update ) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
#########################################################
#          CHECK QUESTION EXIST OR NOT                   #
#########################################################

        function faqExistsDB($condition_arr=array())
	{
            $this->db->select('*');
            $this->db->from('dipp_faq');
            $this->db->where($condition_arr);
            $query = $this->db->get();
            $num = $query->num_rows();
            return ($num > 0) ? TRUE : FALSE;
        }
	

#########################################################
#               DELETE QUESTION                         #
#########################################################

        function deleteFaqDB($condition_arr = array()) {
            $this->db->where($condition_arr);
            $this->db->delete('dipp_faq');
            if($this->db->affected_rows() > 0) {
                return TRUE;
            } else {
                return FALSE;
            }
		}

########################################################
#		GET ALL QUESTION                        #
########################################################

    function getAllQuestionDB($condition_arr = array())
    {
        $this->db->select('*');
	$this->db->from('dipp_faq');
	if(count($condition_arr) > 0) {
	    $this->db->where($condition_arr); 
	}
	$this->db->order_by('id','DESC');
	
	$query=$this->db->get();
	//echo $this->db->last_query();
	return $query->result_array();
    }
    

}