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


class Model_student extends CI_Model {

    function __construct()

    {

       parent::__construct();

    }


#########################################################
#              GET ALL STUDENT                           #
#                                                       #
#                                                       #
#                                                       #
#########################################################


	function allStudentDB($search_by='', $limit='', $offset=0) {

            $this->db->select('SM.*,SI.instructor_business_name');
            $this->db->from('dipp_student SM');
            $this->db->join('dipp_instructor SI', 'SM.instructor_id = SI.instructor_id');
            if($limit > 0) {
		$this->db->limit($limit, $offset);
            }
            $this->db->order_by('SM.student_id','DESC');
            if($search_by <> '')
            {
                $this->db->like('SM.student_fname',$search_by);
                $this->db->or_like('SM.student_lname',$search_by);
                $this->db->or_like('SM.student_email',$search_by);
                $this->db->or_like('SI.instructor_business_name',$search_by);
             }
            $query=$this->db->get();
            //echo $this->db->last_query();
	    //pr($query->result_array());
            return $query->result_array();

	}

#########################################################
#              GET TOTAL STUDENT NUMBER                 #
#                                                       #
#                                                       #
#                                                       #
#########################################################

	function countStudentDB($search_by='')
        {

            $this->db->select('SUM(IF(SM.student_id<>"",1,0)) as total_student',false);
            $this->db->from('dipp_student SM');
            $this->db->join('dipp_instructor SI', 'SM.instructor_id = SI.instructor_id');
            $this->db->order_by('SM.student_id','DESC');
            if($search_by <> '')
            {
                $this->db->like('SM.student_fname',$search_by);
                $this->db->or_like('SM.student_lname',$search_by);
                $this->db->or_like('SM.student_email',$search_by);
                $this->db->or_like('SI.instructor_business_name',$search_by);
             }
            $query=$this->db->get();
            //echo $this->db->last_query();
            $result = $query->result_array();
            return $result[0]['total_student'];

	}
#########################################################
#          CHECK STUDENT EXIST OR NOT                   #
#                                                       #
#                                                       #
#                                                       #
#########################################################

        function studentExistsDB($condition_arr=array()) {
            $this->db->select('*');
            $this->db->from('dipp_student');
            $this->db->where($condition_arr);
            $query = $this->db->get();
            $num = $query->num_rows();
            return ($num > 0) ? TRUE : FALSE;
        }

#########################################################
#                   GENERATE PASSWORD                   #
#                                                       #
#                                                       #
#                                                       #
#########################################################
        function generatePassword(){

          $continue = true;
          
          while ($continue) {
          
            $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%&*_";
            $password = substr( str_shuffle( $chars ), 0, 8 );
            
            $this->db->select('*');
            $this->db->from('dipp_student');
            $this->db->where('student_password',$password);
            $query = $this->db->get();
            $num = $query->num_rows();
            if ($num != 1)
                $continue = false;
                return $password;
            } 
        }  
        
#########################################################
#              ADD STUDENT INTO DATABASE                #
#                                                       #
#                                                       #
#                                                       #
#########################################################

        function addStudentDB($insert_arr=array()) {
            $this->db->insert('dipp_student', $insert_arr);
            return $this->db->insert_id();

	}

#########################################################
#              EDIT STUDENT INTO DATABASE               #
#                                                       #
#                                                       #
#                                                       #
#########################################################

        function editStudentDB($update_arr=array(),$condition_arr=array()) {
            $this->db->where($condition_arr);
            $update = $this->db->update('dipp_student', $update_arr);
            if($update) {
                return TRUE;
            } else {
                return FALSE;
            }
	}

#########################################################
#              DETAILS STUDENT                          #
#                                                       #
#                                                       #
#                                                       #
#########################################################

        function detailsStudentDB($condition_arr=array())
        {

            $this->db->select('*');
            $this->db->from('dipp_student');
            $this->db->where($condition_arr);
            $query=$this->db->get();
            return $query->result_array();
        }

#########################################################
#              STUDENT STATUS CHANGE                    #
#                                                       #
#                                                       #
#                                                       #
#########################################################
        
    function statusChangeStudentDB($student_id = 0) {
        $conditionArr       = array('student_id' => $student_id);
        $student_detail     = $this->detailsStudentDB($conditionArr);
        $student_status     = $student_detail[0]['student_status'];
        $status             =($student_status == 'Active')?'Inactive':'Active';
        
        $updateArr          = array('student_status' => $status);

        $update             = $this->editStudentDB($updateArr,$conditionArr);
        if( $update ) {
            return TRUE;
        } else {
            return FALSE;
        }
    }


#########################################################
#              DELETE STUDENT                           #
#                                                       #
#                                                       #
#                                                       #
#########################################################

        function deleteStudentDB($condition_arr=array()) {
            $this->db->where($condition_arr);
            $this->db->delete('dipp_student');
            if($this->db->affected_rows() > 0) {
                return TRUE;
            } else {
                return FALSE;
            }
	}

        
}