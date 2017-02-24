<?php

#########################################################################
#                                                                       #
#			This is Lesson model.                         	#
#	                                         			#
#									#
#########################################################################


class Model_lesson extends CI_Model {

    function __construct()

    {

       parent::__construct();

    }


#########################################################
#              GET ALL LESSON                           #
#########################################################


	function allLessonDB($search_by='',$search_by_topic_id='',$limit='', $offset=0,$condition_arr=array()) {

           
            $this->db->select('LM.*,TM.name as topic_name, SM.name as step_name, CM.name as course_name,CM.id as course_id');
            $this->db->from('dipp_lesson_master LM');
	    $this->db->join('dipp_topic_master TM','LM.topic_id = TM.id');
            $this->db->join('dipp_step_master SM','TM.step_id = SM.id');
            $this->db->join('dipp_course_master CM','SM.course_id = CM.id');
            if(count($condition_arr) > 0) {
                $this->db->where($condition_arr); 
            }
            if($limit > 0) 
            {
                $this->db->limit($limit, $offset);
            }
            $this->db->order_by('LM.id','DESC');
            if($search_by <> '')
            {
                 $this->db->like('LM.name',$search_by);
             }
            if($search_by_topic_id <> '')
            {
               $this->db->where('LM.topic_id',$search_by_topic_id);
            }
            $query=$this->db->get();
            //echo $this->db->last_query();
            return $query->result_array();

	}

#########################################################
#              GET TOTAL TOPIC NUMBER                	#
#########################################################

	function countLessonDB($search_by='',$search_by_topic_id='',$condition_arr=array())
        {

            $this->db->select('SUM(IF(LM.id<>"",1,0)) as total_lesson',false);
	    $this->db->from('dipp_lesson_master LM');
	    $this->db->join('dipp_topic_master TM','LM.topic_id = TM.id');
            $this->db->join('dipp_step_master SM','TM.step_id = SM.id');
            $this->db->join('dipp_course_master CM','SM.course_id = CM.id');
            if(count($condition_arr) > 0) {
                $this->db->where($condition_arr); 
            }
            if($search_by <> '')
            {
                $this->db->like('LM.name',$search_by);
            }
            if($search_by_topic_id <> '')
            {
               $this->db->where('LM.topic_id',$search_by_topic_id);
            }
            $query = $this->db->get();
            //echo $this->db->last_query();
            $result = $query->result_array();
            return $result[0]['total_lesson'];

	}

#########################################################
#              ADD LESSON INTO DATABASE                  #
#                                                       #
#                                                       #
#                                                       #
#########################################################

        function addLessonMasterDB($insert_arr=array()) {
            $this->db->insert('dipp_lesson_master', $insert_arr);
            return $this->db->insert_id();

	}
	
	function addLessonDetailDB($insert_arr=array()) {
            $this->db->insert('dipp_lesson_details', $insert_arr);
            return $this->db->insert_id();

	}
#########################################################
#              EDIT TOPIC INTO DATABASE              #
#########################################################

        function editLessonDB($update_arr=array(),$condition_arr=array(), $table_name) {
            $this->db->where($condition_arr);
            $update   = $this->db->update($table_name, $update_arr);
            if($update) {
                return TRUE;
            } else {
                return FALSE;
            }
	}

#########################################################
#              DETAILS TOPIC                         #
#########################################################

        function detailsLessonDB($condition_arr=array())
        {

            $this->db->select('LM.*, LD.*, CM.id as course_id, SM.id as step_id, TM.id as topic_id');
            $this->db->from('dipp_lesson_master LM');
	    $this->db->join('dipp_lesson_details LD','LM.id = LD.lesson_id','left');
	    $this->db->join('dipp_topic_master TM','LM.topic_id = TM.id');
            $this->db->join('dipp_step_master SM','TM.step_id = SM.id');
            $this->db->join('dipp_course_master CM','SM.course_id = CM.id');
            $this->db->where($condition_arr);
            $query=$this->db->get();
            return $query->result_array();
        }

#########################################################
#              CATEGORY STATUS CHANGE                   #
#########################################################
        
    function statusChangeTopicDB($topic_id = 0) {
        $conditionArr       = array('id' => $topic_id);
        $topic_detail       = $this->detailsTopicDB($conditionArr);
        $topic_status       = $topic_detail[0]['status'];
        $status             = ($topic_status == 'Active')?'Inactive':'Active';
        
        $updateArr          = array('status' => $status);

        $update             = $this->editTopicDB($updateArr,$conditionArr);
        if( $update ) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
#########################################################
#          CHECK TOPIC EXIST OR NOT                     #
#########################################################

        function lessonExistsDB($condition_arr=array())
	{
            $this->db->select('*');
            $this->db->from('dipp_lesson_master');
            $this->db->where($condition_arr);
            $query = $this->db->get();
            $num = $query->num_rows();
            return ($num > 0) ? TRUE : FALSE;
        }
	
#########################################################
#          GET SINGLE LESSON DETAILS                    #
#########################################################
	function getLessonDetails($condition_arr=array()){
	    $this->db->select('*');
            $this->db->from('dipp_lesson_details');
            $this->db->where($condition_arr);
            $query=$this->db->get();
	    $num = $query->num_rows();
	    if($num > 0){
            return $query->result_array();
	    }else{
		return false;
	    }
	}
#########################################################
#          DELETE LESSON DETAILS                    #
#########################################################
	function deleteLessionDetails($condition_arr=array())
	{
            $this->db->where($condition_arr);
	    $this->db->delete('dipp_lesson_details');
        }
        
}