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
            $this->db->from('dipp_mock_answer_master');
            $this->db->where($condition_arr);
            $query = $this->db->get();
            $num = $query->num_rows();
            return ($num > 0) ? TRUE : FALSE;
        }
#########################################################
#               STEP VIDEOS                             #
#########################################################

        function getAnswersDB($condition_arr=array())
        {

            $this->db->select('AM.*');
            $this->db->from('dipp_mock_answer_master AM');
	    $this->db->join('dipp_mock_question_master QM', 'AM.mock_question_id = QM.mock_question_id');
            $this->db->where($condition_arr);
            $query=$this->db->get();
            return $query->result_array();
        }
#########################################################
#              ADD QUESTION INTO DATABASE               #
#                                                       #
#                                                       #
#                                                       #
#########################################################

        function addAnswersDB($insert_arr=array(),$condition_arr=array()) {
            
            if(count($insert_arr) > 0) {
            $this->db->where($condition_arr);
            $this->db->delete('dipp_mock_answer_master');
            
            $this->db->insert_batch('dipp_mock_answer_master', $insert_arr);
            return TRUE;
            }

	}


}