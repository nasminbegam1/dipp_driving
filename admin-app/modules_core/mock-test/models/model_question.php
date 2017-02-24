<?php

#########################################################################
#                                                                       #
#			This is Question model.                         #
#	                                         			#
#									#
#########################################################################


class Model_question extends CI_Model {

    function __construct()

    {

       parent::__construct();

    }


#########################################################
#              GET ALL QUESTIONS                        #
#########################################################


	function allQuestionDB($search_by='', $limit='', $offset=0,$condition_arr=array()) {

           
            $this->db->select('QM.*,CM.name');
            $this->db->from('dipp_mock_question_master QM');
	    $this->db->join('dipp_course_master CM', 'CM.id = QM.mock_course_id');
            if(count($condition_arr) > 0) {
                $this->db->where($condition_arr); 
            }
            if($limit > 0) 
            {
                $this->db->limit($limit, $offset);
            }
            $this->db->order_by('QM.mock_question_id','DESC');
            if($search_by <> '')
            {
                $this->db->like('QM.mock_question_text',$search_by);
		$this->db->or_like('CM.name',$search_by);
             }
            $query=$this->db->get();
            //echo $this->db->last_query();
            return $query->result_array();

	}

#########################################################
#              GET TOTAL QUESTION NUMBER                #
#########################################################

	function countQuestionDB($search_by='',$condition_arr=array())
        {

            $this->db->select('SUM(IF(QM.mock_question_id<>"",1,0)) as total_question',false);
            $this->db->from('dipp_mock_question_master QM');
	    $this->db->join('dipp_course_master CM', 'CM.id = QM.mock_course_id');
            if(count($condition_arr) > 0) {
                $this->db->where($condition_arr); 
            }
            if($search_by <> '')
            {
               $this->db->like('QM.mock_question_text',$search_by);
	       $this->db->or_like('CM.name',$search_by);
            }
            $query = $this->db->get();
            //echo $this->db->last_query();
            $result = $query->result_array();
            return $result[0]['total_question'];

	}

#########################################################
#              ADD QUESTION INTO DATABASE               #
#                                                       #
#                                                       #
#                                                       #
#########################################################

        function addQuestionDB($insert_arr=array()) {
            $this->db->insert('dipp_mock_question_master', $insert_arr);
            return $this->db->insert_id();

	}
#########################################################
#              EDIT QUESTION INTO DATABASE              #
#########################################################

        function editQuestionDB($update_arr=array(),$condition_arr=array()) {
            $this->db->where($condition_arr);
            $update   = $this->db->update('dipp_mock_question_master', $update_arr);
            if($update) {
                return TRUE;
            } else {
                return FALSE;
            }
	}

#########################################################
#              DETAILS QUESTION                         #
#########################################################

        function detailsQuestionDB($condition_arr=array())
        {

            $this->db->select('QM.*');
            $this->db->from('dipp_mock_question_master QM');
            $this->db->where($condition_arr);
            $query=$this->db->get();
            return $query->result_array();
        }

#########################################################
#              QUESTION STATUS CHANGE                   #
#########################################################
        
    function statusChangeQuestionDB($question_id = 0) {
        $conditionArr       = array('mock_question_id' => $question_id);
        $qs_detail          = $this->detailsQuestionDB($conditionArr);
        $qs_status          = $qs_detail[0]['mock_question_status'];
        $status             = ($qs_status == 'Active')?'Inactive':'Active';
        
        $updateArr          = array('mock_question_status' => $status);

        $update             = $this->editQuestionDB($updateArr,$conditionArr);
        if( $update ) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
#########################################################
#          CHECK QUESTION EXIST OR NOT                   #
#########################################################

        function questionExistsDB($condition_arr=array())
	{
            $this->db->select('*');
            $this->db->from('dipp_mock_question_master');
            $this->db->where($condition_arr);
            $query = $this->db->get();
            $num = $query->num_rows();
            return ($num > 0) ? TRUE : FALSE;
        }
	

#########################################################
#               DELETE QUESTION                         #
#########################################################

        function deleteQuestionDB($condition_arr = array()) {
            $this->db->where($condition_arr);
            $this->db->delete('dipp_mock_question_master');
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
        $this->db->select('QM.*');
	$this->db->from('dipp_mock_question_master QM');
	if(count($condition_arr) > 0) {
	    $this->db->where($condition_arr); 
	}
	$this->db->order_by('QM.mock_question_id','DESC');
	
	$query=$this->db->get();
	//echo $this->db->last_query();
	return $query->result_array();
    }
    

}