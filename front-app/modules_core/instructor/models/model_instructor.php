<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Model_instructor extends CI_Model
{
	public function __construct()
	{
	    // Call the Model constructor
	    parent::__construct();
	    $this->load->model(array('welcome/model_basic','learn/model_practice'));
	}

	#########################################################
	#          CHECK USER EXIST OR NOT                      #
	#                                                       #
	#                                                       #
	#                                                       #
	#########################################################
	
	function instructorExistsDB($condition_arr=array()) {
	    $this->db->select('*');
	    $this->db->from(INSTRUCTOR);
	    $this->db->where($condition_arr);
	    $query = $this->db->get();
	    $num = $query->num_rows();
	    return ($num > 0) ? TRUE : FALSE;
	}
	
	function gettestResult($testDate,$testType,$student_id,$test_date = array()){
	    $res ='';
	    $details = $this->model_basic->getCourseId(array('ST.student_id' => $student_id));
	    if($testType == 'moketest'){
		$res = $this->mockTestForOneExam($testDate,$details->course_id);
	    }else if($testType =='practicetest'){
		$topic_id	= $test_date['topic_id']; 
		$module_id	= $test_date['module_id'];
		$st_details 	= $this->model_basic->getCourseId(array('ST.student_id'=>$student_id));
		$course_id	= $st_details->course_id;
		
		$conditionArr= array('topic_id'=> $topic_id, 'module_id'=> $module_id, 'student_id' => $student_id);
		
		$condArr = array('MM.topic_id' => $topic_id,'MM.module_id' => $module_id);
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
		$noofquestion= count($view_summary);
		$percentage= ($countCorrect/$noofquestion)*100;
		//$data['complete_question']= $countCom; 
		//$data['total_question']= $noofquestion;
		$res['answer_percentage']= $percentage;
		//$data['incomplete_question']= ($noofquestion-$countCom);
		//$data['correct_answer']= $countCorrect;
		//$data['incorrect_answer']= $countInCorrect;
		
		
		
	    }
	    return $res;
	}
	
	public function mockTestForOneExam($addQuestionTime,$course_id){

		$sql = "SELECT * FROM ".MOCK_TEST_RESULT." TR INNER JOIN ".MOCK_ANSWER_MASTER." AM ON TR.question_id = AM.mock_question_id AND AM.mock_is_answer = 'Y' WHERE TR.added_time = '".$addQuestionTime."' AND TR.answer_id = (
SELECT GROUP_CONCAT( MA.mock_answer_id ) FROM ".MOCK_ANSWER_MASTER." MA WHERE MA.`mock_is_answer` = 'Y' AND TR.question_id = MA.mock_question_id ) GROUP BY TR.question_id";
		$rs = $this->db->query($sql);
		$passQuestionNo =  $rs->num_rows();
		$this->db->select('*');
		$this->db->from(MOCK_QUESTION_MASTER);
		$this->db->where(array('mock_question_status'=>'Active','mock_course_id'=>$course_id));
		$query 			= $this->db->get();
		//$totalQuestion  	= $query->num_rows();
		$totalQuestion  	= $this->model_basic->get_option_value(18);
		$data['answer_percentage']= ($passQuestionNo/$totalQuestion)*100;
		return $data;
	}
	
	public function getProfileId($conditionArray = array()){
		$this->db->from(INSTRUCTOR_PAYMENT);
		$this->db->where($conditionArray);
		$this->db->order_by('payment_date','desc');
		$query = $this->db->get();
		if($query->num_rows()>0){
			return $query->row();
		}
		return false;
	}
	public function getNearByZipcode($latN,$latS,$lonE,$lonW,$lat1,$lon1){
		$query = "SELECT instructor_fname,instructor_lname,instructor_email,instructor_business_name,zip_code,instructor_phone_number FROM dipp_instructor WHERE (latitude <= $latN AND latitude >= $latS AND longitude <= $lonE AND longitude >= $lonW) AND (latitude != $lat1 AND longitude != $lon1) ORDER BY latitude, longitude";
                $res   = $this->db->query($query);
		if($res->num_rows()>0){
			return $res->result_array();
		}
		return false;
	}
	
	public function getBadgeList(){
		$query = "SELECT * FROM dipp_badge where badge_type = 'Proud'";
                $res   = $this->db->query($query);
		
		if($res->num_rows()>0){
			return $res->result_array();
		}
		return false;
	}
	public function getBannerList(){
		$query = "SELECT * FROM dipp_instructor_banner where status='Active'";
                $res   = $this->db->query($query);
		
		if($res->num_rows()>0){
			return $res->result_array();
		}
		return false;
	}

}