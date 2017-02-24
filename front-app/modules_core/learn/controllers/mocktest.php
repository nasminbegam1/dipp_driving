<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mocktest extends MY_Controller {
    var $mock_question_master 	= MOCK_QUESTION_MASTER;
    var $mock_test_result 	= MOCK_TEST_RESULT;
    public function __construct(){
        parent::__construct();
        $this->load->model(array('welcome/model_basic','learn/model_mocktest'));
        $this->load->library('form_validation');
        $this->url = base_url().'mocktest/';
	$this->chk_student_login();
    }
    public function start_test(){
	$data = array();
	$data['details'] = $this->model_basic->detailsDB(CMS,array('cms_id'=>5),'cms_content');
	//pr($data);
	$this->getTemplate();
	$this->template->write_view('content','learn/mocktest/start_test',$data);
	$this->template->render();
    }
    public function taketest(){
	
	$data = array();
	$student_id	= $this->session->userdata('STUDENT_ID');
	$st_details 	= $this->model_basic->getCourseId(array('ST.student_id'=>$student_id));
	$course_id	= $st_details->course_id;
	$this->session->set_userdata('addQuestionTime',time());
        $mocktestno = $this->model_basic->get_option_value(18);
	$data['mocktesttime'] = $this->model_basic->get_option_value(20);
        $data['noofquestion'] = $mocktestno;
	$data['mocktestQuestion'] = $this->model_mocktest->getQuestion(array('mock_question_status'=>'Active','mock_course_id'=>$course_id));
	$this->getTemplate();
	$this->template->write_view('content','learn/mocktest/index',$data);
	$this->template->render();
    }
    public function saveGetQuestion(){
	$questionid 	= $this->input->get_post('questionid');
	$answerId   	= $this->input->get_post('answerId');
	$student_id 	= $this->session->userdata('STUDENT_ID');
	$addQuestionTime= $this->session->userdata('addQuestionTime');
	$currentNo	= $this->input->get_post('currentNo');
	$st_details 	= $this->model_basic->getCourseId(array('ST.student_id'=>$student_id));
	$course_id	= $st_details->course_id;
	$recordExist 	= $this->model_basic->existsDB($this->mock_test_result,array('question_id'=>$questionid,'student_id'=>$student_id,'added_time'=>$addQuestionTime));
	if($recordExist){
	    $updateArr = array('answer_id'	=> $answerId);
	    $conditionArr = array('student_id' => $student_id,'question_id'=>$questionid,'added_time'=>$addQuestionTime);
	    $this->model_basic->editDB($this->mock_test_result,$updateArr,$conditionArr);
	    
	    $answerExist 	= $this->model_basic->detailsDB($this->mock_test_result,array('added_time'=> $addQuestionTime,'answer_no'=>$currentNo+1));
	    if(is_array($answerExist) && count($answerExist)>0){
	    $data['userAns']		= $answerExist;
	    $data['questionDetails'] 	= $this->model_mocktest->getQuestion(array('mock_question_id'=>$answerExist[0]['question_id']));
	    $data['curAnsNo']		= $currentNo + 1;
	    }else{
	    $existQuestionId		= $this->model_mocktest->getExistQuestionId($addQuestionTime);
	    $data['questionDetails'] 	= $this->model_mocktest->getQuestion("mock_question_id NOT IN (".$existQuestionId.") AND mock_course_id =".$course_id);
	    $data['curAnsNo']		= $currentNo+1;
	    }
	}else{
	    $insertArr 	= array('student_id'	=> $student_id,
			       'answer_no'      => $currentNo,
			       'question_id'	=> $questionid,
			       'answer_id'	=> $answerId,
			       'added_time'	=> $addQuestionTime);
	    $this->model_basic->addDB($this->mock_test_result,$insertArr);
	    $existQuestionId		= $this->model_mocktest->getExistQuestionId($addQuestionTime);
	    $data['questionDetails'] 	= $this->model_mocktest->getQuestion("mock_question_id NOT IN (".$existQuestionId.") AND mock_course_id =".$course_id);
	    $data['curAnsNo']		= $currentNo+1;
	}
	//$mocktestno 			= $this->model_basic->detailsDB($this->mock_question_master,array('mock_question_status'=> 'Active'),'count(*) total');
	//$data['noofquestion']		= $mocktestno[0]['total'];
        
        $mocktestno = $this->model_basic->get_option_value(18);
        $data['noofquestion'] = $mocktestno;
	if($data['noofquestion'] == $currentNo){
	    echo 'complate';
	}else{
	echo $this->load->view('learn/mocktest/nextQuestion',$data,TRUE);
	}
    }
    public function prevQuestion(){
	$questionid 	= $this->input->get_post('questionid');
	$answerId   	= $this->input->get_post('answerId');
	$student_id 	= $this->session->userdata('STUDENT_ID');
	$addQuestionTime= $this->session->userdata('addQuestionTime');
	$currentNo	= $this->input->get_post('currQuestionNo');
	$recordExist 	= $this->model_basic->existsDB($this->mock_test_result,array('question_id'=>$questionid,'student_id'=>$student_id,'added_time'=>$addQuestionTime));
	if($recordExist){
	    $updateArr = array('answer_id'	=> $answerId);
	    $conditionArr = array('student_id' => $student_id,'question_id'=>$questionid,'added_time'=>$addQuestionTime);
	    $this->model_basic->editDB($this->mock_test_result,$updateArr,$conditionArr);
	}else{
	    $insertArr 	= array('student_id'	=> $student_id,
			       'answer_no'      => $currentNo,
			       'question_id'	=> $questionid,
			       'answer_id'	=> $answerId,
			       'added_time'	=> $addQuestionTime);
	    $this->model_basic->addDB($this->mock_test_result,$insertArr);
	}
	$prevQuestion   		= $this->input->get_post('currQuestionNo')-1;
	$data['userAns']		= $this->model_basic->detailsDB($this->mock_test_result,array('added_time'=> $addQuestionTime,'answer_no'=>$prevQuestion));
	$data['questionDetails'] 	= $this->model_mocktest->getQuestion(array('mock_question_id'=>$data['userAns'][0]['question_id']));
	$data['curAnsNo']		= $prevQuestion;
	$mocktestno 			= $this->model_basic->get_option_value(18);
        $data['noofquestion'] 		= $mocktestno;
	//pr($data);
	echo $this->load->view('learn/mocktest/nextQuestion',$data,TRUE);
    }
    public function result(){
	$addQuestionTime= $this->session->userdata('addQuestionTime');
	$student_id 	= $this->session->userdata('STUDENT_ID');
	$st_details 	= $this->model_basic->getCourseId(array('ST.student_id'=>$student_id));
	$course_id	= $st_details->course_id;
	$recordExist 	= $this->model_basic->existsDB($this->mock_test_result,array('student_id'=>$student_id,'added_time'=>$addQuestionTime));
	if($recordExist){
	    $updateArr = array('is_publish'	=> 'Yes');
	    $conditionArr = array('student_id' => $student_id,'added_time'=>$addQuestionTime);
	    $this->model_basic->editDB($this->mock_test_result,$updateArr,$conditionArr);
	}else{
	    $insertArr 	= array('student_id'	=> $student_id,
				'added_time'	=> $addQuestionTime,
				'is_publish'	=> 'Yes');
	    $this->model_basic->addDB($this->mock_test_result,$insertArr);
	}
	
        $mocktestno                     = $this->model_basic->get_option_value(18);
        $data['noofquestion']           = $mocktestno;
	$mocktestAnsNo 			= $this->model_basic->detailsDB($this->mock_test_result,array('student_id'=>$student_id,'added_time'=>$addQuestionTime,'is_publish'=>'Yes','answer_id != ' => ''),'count(*) totalAns');
	$data['noOfAns'] 		= $mocktestAnsNo[0]['totalAns'];
	$data['mockTestResult']		= $this->model_mocktest->mockTestForOneExam($addQuestionTime,$course_id);
	$data['wrongAns'] 		= $this->model_mocktest->wrongAnswer($addQuestionTime,$course_id);
	//pr($data);
	$this->getTemplate();
	$this->template->write_view('content','learn/mocktest/result',$data);
	$this->template->render();
    }
    public function reviewQuestion(){
	$addQuestionTime		= $this->session->userdata('addQuestionTime');
	$student_id 			= $this->session->userdata('STUDENT_ID');
	$st_details 	= $this->model_basic->getCourseId(array('ST.student_id'=>$student_id));
	$course_id	= $st_details->course_id;

	$noofquestion                   = $this->model_basic->get_option_value(18);
	$mocktestAnsNo 			= $this->model_basic->detailsDB($this->mock_test_result,array('student_id'=>$student_id,'added_time'=>$addQuestionTime,'answer_id != ' => ''),'count(*) totalAns');
	$countCom			= $mocktestAnsNo[0]['totalAns'];
	$incomQuestion			= $noofquestion - $countCom;
	$correctData			= $this->model_mocktest->mockTestForOneExam($addQuestionTime,$course_id);
	$countCorrect			= $correctData['passQuestionNo'];
	$countInCorrect			= $countCom - $countCorrect;
	$percentage			= $correctData['userNumber'];
	$data['total_question']		= $noofquestion;
	$data['complete_question']	= $countCom;
	$data['incomplete_question']	= $incomQuestion;
	$data['correct_answer']		= $countCorrect;
	$data['incorrect_answer']	= $countInCorrect;
	$data['marks_percentage']	= $percentage;
	echo $this->load->view('learn/mocktest/review_questions',$data,TRUE);
	exit;
    }
}