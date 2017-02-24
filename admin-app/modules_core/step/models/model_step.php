<?php

#########################################################################
#                                                                       #
#			This is Step model.                         	#
#	                                         			#
#									#
#########################################################################


class Model_step extends CI_Model {

    function __construct()

    {

       parent::__construct();

    }


#########################################################
#              GET ALL STEPS                          #
#########################################################


	function allStepDB($search_by='', $limit='', $offset=0) {


            $this->db->select('SM.*, CM.name AS course_name');
            $this->db->from('dipp_step_master SM');
	    $this->db->join('dipp_course_master CM', 'CM.id = SM.course_id', 'left');
            if($limit > 0) {
			$this->db->limit($limit, $offset);
			}
            $this->db->order_by('SM.course_id','ASC');
            if($search_by <> '')
            {
                $this->db->like('SM.name',$search_by);
             }
            $query=$this->db->get();
            //echo $this->db->last_query();
            return $query->result_array();

	}

#########################################################
#              GET TOTAL Step NUMBER                	#
#########################################################

	function countStepDB($search_by='')
        {

            $this->db->select('SUM(IF(SM.id<>"",1,0)) as total_step',false);
            $this->db->from('dipp_step_master SM');
            if($search_by <> '')
            {
                $this->db->like('SM.name',$search_by);
            }
            $query = $this->db->get();
            $result = $query->result_array();
            return $result[0]['total_step'];

	}


#########################################################
#              EDIT CATEGORY INTO DATABASE              #
#########################################################

        function editStepDB($update_arr=array(),$condition_arr=array()) {
            $this->db->where($condition_arr);
            $update         = $this->db->update('dipp_step_master SM', $update_arr);
            if($update) {
                return TRUE;
            } else {
                return FALSE;
            }
	}

#########################################################
#              DETAILS CATEGORY                         #
#########################################################

        function detailsStepDB($condition_arr=array())
        {

            $this->db->select('SM.*, CM.name AS course_name');
            $this->db->from('dipp_step_master AS SM');
	    $this->db->join('dipp_course_master AS CM', 'CM.id = SM.course_id', 'left');
            $this->db->where($condition_arr);
            $query=$this->db->get();
            return $query->result_array();
        }


#########################################################
#               STEP VIDEOS                             #
#########################################################

        function getStepVideosDB($condition_arr=array())
        {

            $this->db->select('SV.*');
            $this->db->from('dipp_step_master AS SM');
	    $this->db->join('dt_step_videos AS SV', 'SM.id = SV.step_id');
            $this->db->where($condition_arr);
            $query=$this->db->get();
            return $query->result_array();
        }


#########################################################
#               CHECK VIDEOS EXIST                      #
#########################################################

        function stepVideosExist($condition_arr=array()) {
            $this->db->select('*');
            $this->db->from('dt_step_videos');
            $this->db->where($condition_arr);
            $query = $this->db->get();
            $num = $query->num_rows();
            return $num;
        }  

#########################################################
#               ADD STEP VIDEOS                             #
#########################################################

        function addStepVideosDB($insert_arr=array(),$condition_arr=array()) {
            if($this->stepVideosExist($condition_arr) && count($condition_arr) > 0) {
                $this->db->where($condition_arr);
                $this->db->delete('dt_step_videos');
            }
            
            $this->db->insert_batch('dt_step_videos', $insert_arr);
            return TRUE;

	}  
#########################################################
#              CATEGORY STATUS CHANGE                   #
#########################################################
        
    function statusChangeStepDB($cat_id = 0) {
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

        function stepExistsDB($condition_arr=array())
	{
            $this->db->select('SM.*');
            $this->db->from('dipp_step_master SM');
            $this->db->where($condition_arr);
            $query = $this->db->get();
            $num = $query->num_rows();
            return ($num > 0) ? TRUE : FALSE;
        }
        
}