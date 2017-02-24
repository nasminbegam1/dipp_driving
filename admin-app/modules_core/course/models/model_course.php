<?php

#########################################################################
#                                                                       #
#			This is Course model.                         	#
#	                                         			#
#									#
#########################################################################


class Model_course extends CI_Model {

    function __construct()

    {

       parent::__construct();

    }


#########################################################
#              GET ALL COURSES                          #
#########################################################


	function allCourseDB($search_by='', $limit='', $offset=0) {


            $this->db->select('CM.*');
            $this->db->from('dipp_course_master CM');
            if($limit > 0) {
			$this->db->limit($limit, $offset);
			}
            $this->db->order_by('CM.id','DESC');
            if($search_by <> '')
            {
                $this->db->like('CM.name',$search_by);
             }
            $query=$this->db->get();
            //echo $this->db->last_query();
            return $query->result_array();

	}

#########################################################
#              GET TOTAL Course NUMBER                	#
#########################################################

	function countCourseDB($search_by='')
        {

            $this->db->select('SUM(IF(CM.id<>"",1,0)) as total_course',false);
            $this->db->from('dipp_course_master CM');
            if($search_by <> '')
            {
                $this->db->like('CM.name',$search_by);
            }
            $query = $this->db->get();
            $result = $query->result_array();
            return $result[0]['total_course'];

	}


#########################################################
#              EDIT CATEGORY INTO DATABASE              #
#########################################################

        function editCourseDB($update_arr=array(),$condition_arr=array()) {
            $this->db->where($condition_arr);
            $update         = $this->db->update('dipp_course_master', $update_arr);
            if($update) {
                return TRUE;
            } else {
                return FALSE;
            }
	}

#########################################################
#              DETAILS CATEGORY                         #
#########################################################

        function detailsCourseDB($condition_arr=array())
        {

            $this->db->select('*');
            $this->db->from('dipp_course_master');
            $this->db->where($condition_arr);
            $query=$this->db->get();
            return $query->result_array();
        }

#########################################################
#              CATEGORY STATUS CHANGE                   #
#########################################################
        
    function statusChangeCategoryDB($cat_id = 0) {
        $conditionArr       = array('cat_id' => $cat_id);
        $category_detail    = $this->detailsCategoryDB($conditionArr);
        $cat_status         = $category_detail[0]['cat_status'];
        $status             =($cat_status == 'Active')?'Inactive':'Active';
        
        $updateArr          = array('cat_status' => $status);

        $update             = $this->editCategoryDB($updateArr,$conditionArr);
        if( $update ) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
#########################################################
#          CHECK CATEGORY EXIST OR NOT                  #
#########################################################

        function courseExistsDB($condition_arr=array())
	{
            $this->db->select('*');
            $this->db->from('dipp_course_master');
            $this->db->where($condition_arr);
            $query = $this->db->get();
            $num = $query->num_rows();
            return ($num > 0) ? TRUE : FALSE;
        }

/* GET COURSE STEP LIST */
    function getStepDB($condition_arr=array()){
            $this->db->select('SM.id as step_id,SM.name as step_name');
            $this->db->from('dipp_step_master SM');
            $this->db->join('dipp_course_master CM','SM.course_id = CM.id');
            $this->db->where($condition_arr);
            $query = $this->db->get();
            //echo $this->db->last_query();
            return $query->result_array();
    }        
        
}