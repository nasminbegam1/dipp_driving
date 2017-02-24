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
	$this->load->model('learn/model_practice');
    }


#########################################################
#              GET ALL STUDENT                           #
#                                                       #
#                                                       #
#                                                       #
#########################################################


	function allStudentDB($limit='', $offset=0,$condition_arr=array()) {

            $this->db->select('SM.*,SI.instructor_business_name');
            $this->db->from(STUDENT.' SM');
            $this->db->join(INSTRUCTOR.' SI', 'SM.instructor_id = SI.instructor_id');
	    $this->db->where($condition_arr);
            if($limit > 0) {
		$this->db->limit($limit, $offset);
            }
            $this->db->order_by('SM.student_id','DESC');
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

	function countStudentDB($condition_arr=array())
        {

            $this->db->select('SUM(IF(SM.student_id<>"",1,0)) as total_student',false);
            $this->db->from(STUDENT.' SM');
            $this->db->join(INSTRUCTOR.' SI', 'SM.instructor_id = SI.instructor_id');
	    $this->db->where($condition_arr);
            $this->db->order_by('SM.student_id','DESC');
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
        
#########################################################
#              GET INSTRACTOR DETAILS                   #
#                                                       #
#                                                       #
#                                                       #
#########################################################

	function detailsInstructorDB($condition_arr=array())
        {

            $this->db->select('*');
            $this->db->from(INSTRUCTOR);
            $this->db->where($condition_arr);
            $query=$this->db->get();
            return $query->result_array();
        }
	
	function getLastDate($student_id){
	    $res = '';
	    $res['topic_id'] 	= '';
	    $res['module_id'] 	= '';
	    $this->db->select('MAX(added_time) AS MOCKTESTDATE');
            $this->db->from(MOCK_TEST_RESULT);
            $this->db->where('student_id',$student_id);
	    $this->db->where('is_publish','Yes');
            $query=$this->db->get();
            $result = $query->row();
	    $mocktestdate = $result->MOCKTESTDATE;
	    //echo date('r',$mocktestdate);
	    $this->db->select('MAX(date_added) AS TESTDATE,topic_id,module_id');
            $this->db->from(QUESTION_ANSWER_SET);
            $this->db->where('student_id',$student_id);
            $query=$this->db->get();
            $result = $query->row();
	    $testdate = strtotime($result->TESTDATE);
	    if($mocktestdate != '' && $testdate != ''){
		if($mocktestdate > $testdate){
		    $res['type'] = 'moketest';
		    $res['date'] = $mocktestdate;
		}else{
		    $res['type'] 	= 'practicetest';
		    $res['date'] 	= $testdate;
		    $res['topic_id'] 	= $result->topic_id;
		    $res['module_id'] 	= $result->module_id;
		}
	    }else if($mocktestdate == '' && $testdate !=''){
		$res['type'] 		= 'practicetest';
		$res['date'] 		= $testdate;
		$res['topic_id'] 	= $result->topic_id;
		$res['module_id'] 	= $result->module_id;
	    }else if($testdate =='' && $mocktestdate != ''){
		$res['type'] = 'moketest';
		$res['date'] = $mocktestdate;
	    }
	    return $res;
	}
	
	function pactriceTestReport($student_id,$course_id){
	    
		$this->db->select('QAS.module_id,QAS.topic_id,TM.name topic_name,MM.module_name');
		$this->db->from(QUESTION_ANSWER_SET.' QAS');
		$this->db->join(TOPIC_MASTER.' TM', 'TM.id = QAS.topic_id');
		$this->db->join(MODULE_MASTER.' MM', 'MM.module_id = QAS.module_id');
		$this->db->where('QAS.student_id',$student_id);
		$this->db->group_by(array('QAS.topic_id','QAS.module_id'));
		$this->db->order_by('QAS.date_added','DESC');
		$query  	= $this->db->get();
		$result 	= $query->result_array();
		if(is_array($result)){
		    foreach($result as $k=>$res){
		    $conditionArr= array('topic_id'=> $res['topic_id'], 'module_id'=> $res['module_id'], 'student_id' => $student_id);
		    
		    $condArr = array('MM.topic_id' => $res['topic_id'],'MM.module_id' => $res['module_id']);
		    $totQuestionsArr= $this->model_practice->getModuleWiseQuestion($condArr);
		    
		    $view_summary= $this->model_practice->getViewSummary($conditionArr);
		    $noofquestion= count($totQuestionsArr);
		    
		    
		    //pr($totQuestionsArr,0); 
		    //pr($data['view_summary']);
		    //$this->session->set_userdata("viewsummary",$data['view_summary']);
		    
		    $countCom= 0;
		    $countIncom= 0;
		    $countCorrect= 0;
		    $countInCorrect= 0;
		    foreach($view_summary as $key){
		        if($key['answer_id'] != 0){
		    		    $countCom= $countCom+1;
		        }
		        //if($key[answer_id] == 0){
		        //		$countIncom= $countIncom+1;
		        //}
		        if($key['is_correct'] == "Yes"){
		    		    $countCorrect= $countCorrect+1;
		        }
		        if($key['is_correct'] == "No"){
		    		    $countInCorrect= $countInCorrect+1;
		        }
		    }
		    
		    
		    $noofquestion			= count($view_summary);
		    $percentage				= ($countCorrect/$noofquestion)*100;
		    $result[$k]['complete_question']	= ($countCom/$noofquestion)*100;; 
		    $result[$k]['total_question']	= $noofquestion;
		    $result[$k]['answer_percentage']	= $percentage;
		    $result[$k]['incomplete_question']	= ($noofquestion-$countCom);
		    $result[$k]['correct_answer']	= $countCorrect;
		    $result[$k]['incorrect_answer']	= $countInCorrect;
		    
		    }
		}
		//pr($result);
		return $result;
	}
	
	function instractorDetails($conditionArr = array()){
	    $this->db->select('PA.no_student');
	    $this->db->from(INSTRUCTOR.' INS');
	    $this->db->join(PACKAGE.' PA','INS.package_id = PA.package_id');
	    $this->db->where($conditionArr);
	    $query = $this->db->get();
	    //echo $this->db->last_query();exit;
	    return $query->row();
	}
	
	function hazardTestReport($student_id){
		$result = false;
		$this->db->select('HV.video_name,HV.id,HA.score,HA.added_date');
		$this->db->from('dipp_hazard_answer HA');
		$this->db->join('dipp_hazard_video HV', 'HA.video_id = HV.id');
		$this->db->where('HA.user_id',$student_id);
		$this->db->order_by('HA.added_date','DESC');
		$query  	= $this->db->get();
		if($this->db->affected_rows() > 0){
		$result 	= $query->result_array();
		}
		return $result;
	}
	
	function pactriceTestMastery($student_id,$course_id){
		$this->db->select('QAS.module_id,QAS.topic_id');
		$this->db->from(QUESTION_ANSWER_SET.' QAS');
		$this->db->join(TOPIC_MASTER.' TM', 'TM.id = QAS.topic_id');
		$this->db->join(MODULE_MASTER.' MM', 'MM.module_id = QAS.module_id');
		$this->db->where('QAS.student_id',$student_id);
		$this->db->group_by(array('QAS.topic_id','QAS.module_id'));
		$this->db->order_by("QAS.date_added",'DESC');
		$this->db->limit(5);
		$query  	= $this->db->get();
		$result 	= $query->result_array();
		$result['total_question'] = 0;
		$result['correct_answer'] = 0;
		$result['practicetestmastery'] = 0;
		if(is_array($result)){
		    foreach($result as $k=>$res){
		    $conditionArr= array('topic_id'=> $res['topic_id'], 'module_id'=> $res['module_id'], 'student_id' => $student_id);
		    
		    $condArr = array('MM.topic_id' => $res['topic_id'],'MM.module_id' => $res['module_id']);
		    $totQuestionsArr= $this->model_practice->getModuleWiseQuestion($condArr);
		    
		    $view_summary= $this->model_practice->getViewSummary($conditionArr);
		    $noofquestion= count($totQuestionsArr);
		    
		    
		    //pr($totQuestionsArr,0); 
		    //pr($data['view_summary']);
		    //$this->session->set_userdata("viewsummary",$data['view_summary']);
		    
		    $countCom= 0;
		    $countIncom= 0;
		    $countCorrect= 0;
		    $countInCorrect= 0;
		    foreach($view_summary as $key){
		        if($key['answer_id'] != 0){
		    		    $countCom= $countCom+1;
		        }
		        //if($key[answer_id] == 0){
		        //		$countIncom= $countIncom+1;
		        //}
		        if($key['is_correct'] == "Yes"){
		    		    $countCorrect= $countCorrect+1;
		        }
		        if($key['is_correct'] == "No"){
		    		    $countInCorrect= $countInCorrect+1;
		        }
		    }
		    
		    
		    $noofquestion			= count($view_summary);
		    //$result[$k]['total_question']	= $noofquestion;
		    $result['total_question']		+= $noofquestion;
		    $result['correct_answer']		+= $countCorrect;
		    
		    }
		}
		if($result['total_question']>0){
		$result['practicetestmastery'] = number_format((((($result['correct_answer']/$result['total_question'])*100)/500)*100),2);
		}
		//pr($result);
		return $result;
	}
	
	function hazardTestMastery($student_id){
		$result = 0;
		//$this->db->select('HV.video_name,HV.id,HA.score,HA.added_date');
		////$this->db->select_sum('HA.score');
		//$this->db->from('dipp_hazard_answer HA');
		//$this->db->join('dipp_hazard_video HV', 'HA.video_id = HV.id');
		//$this->db->where('HA.user_id',$student_id);
		//$this->db->order_by('HA.added_date','DESC');
		//$this->db->limit(5);
		//$query  	= $this->db->get();
		$query = $this->db->query('SELECT sum(score) as totalScore FROM (SELECT score FROM dipp_hazard_answer where user_id="'.$student_id.'" ORDER BY added_date DESC LIMIT 5 ) AS subquery');
		if($query->num_rows() > 0){
		$result 	= $query->result_array();
		    if($result[0]['totalScore'] != ''){
			$result 	= $result[0]['totalScore'];
		    }else{
			$result = 0;
		    }
		}
		if($result>0){
		    $result = ($result/25)*100;
		}
		return $result;
	}
        
}