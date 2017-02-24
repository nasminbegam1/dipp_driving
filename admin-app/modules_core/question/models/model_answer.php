<?php

#########################################################################
#                                                                       #
#			This is Question model.                         #
#	                                         			#
#									#
#########################################################################


class Model_answer extends CI_Model {

    function __construct()

    {

       parent::__construct();

    }


#########################################################
#          CHECK QUESTION EXIST OR NOT                   #
#########################################################

        function answerExistsDB($condition_arr=array())
	{
            $this->db->select('*');
            $this->db->from('dipp_answer_master');
            $this->db->where($condition_arr);
            $query = $this->db->get();
            $num = $query->num_rows();
            return ($num > 0) ? TRUE : FALSE;
        }
#########################################################
#               GET ANSWERS                             #
#########################################################

        function getAnswersDB($condition_arr=array())
        {

            $this->db->select('AM.*');
            $this->db->from('dipp_answer_master AM');
	    $this->db->join('dipp_question_master QM', 'AM.question_id = QM.question_id');
            $this->db->where($condition_arr);
            $query=$this->db->get();
            return $query->result_array();
        }
#########################################################
#               ADD ANSWERS                             #
#########################################################

        function addAnswersDB($insert_arr=array(),$condition_arr=array()) {
            
            if(count($insert_arr) > 0) {
            $this->db->where($condition_arr);
            $this->db->delete('dipp_answer_master');
            
            $this->db->insert_batch('dipp_answer_master', $insert_arr);
            return TRUE;
            }

	}
        
#########################################################
#               UPDATE ANSWERS                          #
#########################################################

        function updateAnswersDB($update_arr=array()) {
            
            if(count($update_arr) > 0) {
            $this->db->update_batch('dipp_answer_master', $insert_arr);
            return TRUE;
            }

	}
        

 
}