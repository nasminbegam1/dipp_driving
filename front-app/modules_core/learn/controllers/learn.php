<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Learn extends MY_Controller {

    var $lessonMaster 	= LESSION_MASTER;
    var $lessonDetails 	= LESSION_DETAILS;
    var $lessonRead	= LESSION_READ;
    var $topicMaster	= TOPIC_MASTER;
    var $hazardVideo	= 'dipp_hazard_video';
    var $hazardAnswer   = 'dipp_hazard_answer';
   
    public function __construct(){
        parent::__construct();
        $this->load->model(array('welcome/model_authentication','welcome/model_basic','learn/model_learn','learn/model_mocktest','student/model_student'));
        $this->load->library('form_validation');
        $this->url = base_url().'learn/';
	$this->chk_student_login();
    }

    /*** @Frontend landing page **/

    public function index(){   
	$data=array();
	$student_id	= $this->session->userdata('STUDENT_ID');
	$st_details 	= $this->model_basic->getCourseId(array('ST.student_id'=>$student_id));
	$course_id	= $st_details->course_id;
	if($this->input->get_post('course') != '') {
	    $course_id = trim($this->input->get_post('course')); 
	    $this->session->set_userdata('course_id', $course_id);
	    $course_id = $this->session->userdata('course_id');
	}

        if(isset($course_id) && $course_id !=''){
            $data['step_dtls']  = $this->model_basic->detailsDB(STEP_MASTER,array('status' => "Active",'course_id' =>$course_id),array('id','name','short_description'));
        }
       
        // For learn chart section
        $topic_all = $this->model_learn->getTopicAll();
        $learn_complete=0;
        $topic=0;
        foreach($topic_all as $val)
        {
            $topicId =$val['topic_id'];
            $topic_all = $this->model_learn->getCourseComplete($topicId,$student_id);
            if(count($topic_all) > 0) {
                $learn_complete++;
            }
            $topic++;
        }
        $data['learn_topic']=$topic;
        $data['learn_complete']=$learn_complete;
        $data['learn_not_complete']=$data['learn_topic'] - $data['learn_complete'];
        
        // For modules practice section
        $conditionArr= array('module_status' => 'Active');
        $total_module=$this->model_learn->getTotalModules($conditionArr);
        $data['total_module']=$total_module['total_modules'];
        $data['module_pass']=$this->model_learn->getModulePass($student_id);
        $data['module_not_pass']=$data['total_module'] - $data['module_pass'];
        
        
        // For mock test section
        $mockResult= $this->model_mocktest->mockTestResult($student_id,$course_id);
        $data['mock_test_fail']  = $mockResult['totalFail'];
        $data['mock_test_pass']  = $mockResult['totalPass'];
        $data['mock_test_total'] = $mockResult['totalTest'];
	//$this->load->view('learn/index',$data);
	
	
	$data['mockTestMastery']    = $this->model_mocktest->mockTestmastery($student_id,$course_id);
	$data['pactriceTestMastery']= $this->model_student->pactriceTestMastery($student_id,$course_id);
	$data['hazardTestMastery']  = $this->model_student->hazardTestMastery($student_id);
	
        //pr($data);
        $this->getTemplate();
        $this->template->write_view('content', 'learn/index', $data);
        $this->template->render();
    }
   
    public function step(){
	$step_id	= $this->uri->segment('3');
	$student_id	= $this->session->userdata('STUDENT_ID');
	$data= array();
	$st_details 	= $this->model_basic->getCourseId(array('ST.student_id'=>$student_id));
	$course_id	= $st_details->course_id;
	$data['step_details'] 	= $this->model_learn->step_details($step_id);
	if(isset($data['step_details']) && is_array($data['step_details']) && count($data['step_details'] > 0)){
	    foreach($data['step_details'] as $step_dtls){
		if($step_dtls['step_type'] == 'L'){
		    $data['step_learn'] = $this->step_learn($step_dtls['id'],$course_id);
		    
		    $data['getReadCount'] = $this->model_learn->getReadCount($student_id);
		    $view = 'learn/step1';
		}
		if($step_dtls['step_type'] == 'P'){
		    $conditionArr= array('name' => 'Learn','course_id'=>$course_id);
		    $course_idArr= $this->model_learn->getCourseId($conditionArr);
		    $step_id= $course_idArr[0]['id'];
                    $step_practise = $this->step_practise($step_id,$course_id);
		    foreach($step_practise as $values)
		    {
			$topicId= $values['id'];
			$condition_arr=array('topic_id'=>$topicId,'student_id'=>$student_id);
			$topicAttempt=$this->model_learn->getTopicAttemp($condition_arr);
			$topic_class = '';
			if($topicAttempt > 0) {
			    $topic_class='red';
			    $pass=$this->model_learn->getTopicPass($topicId,$student_id);
			    if($pass > 0){
			     $topic_class='green';    
			    }
			}
			$total_result[]  = array_merge($values,array('topic_class'=>$topic_class)); 
		    }
		    $data['step_practise']= $total_result;
		    $view = 'learn/step2';
		}
		if($step_dtls['step_type'] == 'M'){
		    $data['mockTestResult'] = $this->model_mocktest->mockTestResult($student_id,$course_id);
		    //pr($data['mockTestResult']);
		    $data['step_mock'] = $this->step_mock($step_dtls['id'],$course_id);
		    $view = 'learn/step3';
		}
		if($step_dtls['step_type'] == 'H'){
		    $data['step_hazard'] = $this->step_hazard($step_dtls['id'],$course_id);
		    $view = 'learn/step4';
		}
		//echo $view;die;
	    }
	}
	//echo $view;die();
	$this->getTemplate();
	$this->template->write_view('content', $view, $data);
	$this->template->render();
    }
   
	 
    public function step_learn($step_id,$course_id)
    {
	$data=array();
	$data['topic_details']= $topic_details = $this->model_learn->topic_details($step_id,$course_id);

        foreach($topic_details as $values)
        {   $topic_id		= $values['id'];
            $student_id 	= $this->session->userdata('STUDENT_ID');
            $topic_all 		= $this->model_learn->getLessonByTopic($topic_id,$student_id);
	    $total_lesson	= $this->model_learn->totalTopic($topic_id,$student_id);
	    $learn_class 	= '';
	    if($total_lesson > 0 && $topic_all==$total_lesson){
		$learn_class='green';
            }else if($topic_all>0 && $topic_all < $total_lesson){
		$learn_class='red';
	    }
            $total_result[]     = array_merge($values,array('learn_class'=>$learn_class));
        }  
        $data['topic_details']=$total_result;	
	return $data['topic_details'];
    }
    public function step_practise($step_id,$course_id)
    {
	$data=array();
	$data['topic_details'] = $this->model_learn->topic_details($step_id,$course_id);
	return $data['topic_details'];
    }
    public function step_mock($step_id,$course_id)
    {
	$data=array();
	$data['topic_details'] = $this->model_learn->topic_details($step_id,$course_id);
	return $data['topic_details'];
    }
    public function step_hazard($step_id,$course_id)
    {
	$data=array();
	$data['topic_details'] = $this->model_learn->topic_details($step_id,$course_id);
	return $data['topic_details'];
    }
    public function learn_details(){
	$this->chk_login();
	$topic_id 	       = $this->uri->segment('3');
	$student_id 	       = $this->session->userdata('STUDENT_ID');
	$data['topic_details'] = $this->model_basic->detailsDB($this->topicMaster,'id ='.$topic_id,'id,step_id,name,short_description');
	$data['lesson_master'] = $this->model_learn->getLessionDetailsbyTopic($topic_id,$student_id);
        //$data['lesson_master'] = $this->model_basic->detailsDB($this->lessonMaster,'topic_id ='.$topic_id,'id,name');
	$this->getTemplate();
        $this->template->write_view('content', 'learn/lesson_details', $data);
        $this->template->render();
    }
    
    public function lessionDetails(){
	$this->chk_login();
	$student_id 			= $this->session->userdata('STUDENT_ID');
	$lesson_id 			= $this->input->post('lesson_id');
	if($lesson_id != ''){
	    $data['error']		= '';
	    $lesson_master              = $this->model_learn->getLessionDetails($lesson_id,$student_id);
	    $data['lesson_id']		= $lesson_id;
	    $data['lesson_read']	= stripslashes($lesson_master[0]['is_read']);
	    $data['add_lesson']		= stripslashes($lesson_master[0]['add_lesson']);
	    $data['lesson_name']	= stripslashes($lesson_master[0]['name']);
	    $data['lesson_description']	= stripslashes($lesson_master[0]['description']);
	    $data['lesson_details']	= $this->model_basic->detailsDB($this->lessonDetails,'lesson_id ='.$lesson_id.' AND status="Active"','desc_type,desc_content,other_content');
	    echo json_encode($data);
	    exit;
	}else{
	    $data['error'] = 'error';
	    echo json_encode($data);
	    exit;
	}
    }
    
    public function addRemoveRead(){
	$lesson_id 			= $this->input->post('lesson_id');
	$student_id 			= $this->session->userdata('STUDENT_ID');
	$checking_val 			= $this->input->post('checking_val');
	$lesson 			= $this->model_basic->detailsDB($this->lessonRead,'lesson_id ='.$lesson_id.' AND student_id='.$student_id.'');
	if(is_array($lesson) && count($lesson)>0){
	    $update_arr = array('is_read'		=> ($checking_val == 1)?'Yes':'No');
	    $condition  = array('lesson_id'		=> $lesson_id,
				'student_id'		=> $student_id);
	    $this->model_basic->editDB($this->lessonRead,$update_arr,$condition);
	}else{
	$inser_arr = array( 'lesson_id'		=> $lesson_id,
			    'student_id'	=> $student_id,
			    'is_read'		=> 'Yes');
	$this->model_basic->insertIntoTable($this->lessonRead,$inser_arr);
	}
    }
    
    public function addToMyLesson(){
	$lesson_id 			= $this->input->post('lesson_id');
	$student_id 			= $this->session->userdata('STUDENT_ID');
	$lesson 			= $this->model_basic->detailsDB($this->lessonRead,'lesson_id ='.$lesson_id.' AND student_id='.$student_id.'');
	if(is_array($lesson) && count($lesson)>0){
	    $update_arr = array('add_lesson'		=> ($lesson[0]['add_lesson'] != 'Yes')?'Yes':'No');
	    $condition  = array('lesson_id'		=> $lesson_id,
				'student_id'		=> $student_id);
	    $this->model_basic->editDB($this->lessonRead,$update_arr,$condition);
	    echo ($lesson[0]['add_lesson'] == 'Yes')?'Add to my lessons':'Remove from My Lessons';
	}else{
	    $inser_arr = array( 'lesson_id'		=> $lesson_id,
				'student_id'		=> $student_id,
				'add_lesson'		=> 'Yes');
	    $this->model_basic->insertIntoTable($this->lessonRead,$inser_arr);
	    echo 'Remove from My Lessons';
	}
    }
    
    public function mylesson(){
	$this->chk_login();
	$student_id 	       		= $this->session->userdata('STUDENT_ID');
	$data['topic_details'] 		= $this->model_basic->detailsDB($this->topicMaster,'id =15','name,short_description,step_id,id');
	$data['lesson_master'] 		= $this->model_learn->getMyLesson($this->lessonMaster.' LM',$this->lessonRead.' LR','LM.id=LR.lesson_id',array('student_id' => $student_id,'add_lesson' => 'Yes'),'LM.id');
	$this->getTemplate();
        $this->template->write_view('content', 'learn/lesson_details', $data);
        $this->template->render();
    }
    
    public function hpVideo(){
	$this->chk_login();
	$data = array();
	$this->getTemplate();
        $this->template->write_view('content', 'learn/hpvideo', $data);
        $this->template->render();
    }
    
    public function get_video_list(){
	$start_val 	= $this->input->post('start_val');
	$user_id	= $this->session->userdata('STUDENT_ID');
	if($start_val == 'intro_video'){
	    $data['video']  = 'introduction';
	}else{
	$data['video']  = $this->model_learn->getHazardResult($user_id,$start_val);
	}
	echo json_encode($data);
    }
    
    public function view_video(){
	$id 		= $this->input->post('id');
	if($id == 'introvideo'){
	    $data['video'] = 'introvideo';
	}else{
	$data['video']  = $this->model_basic->detailsDB($this->hazardVideo,'id = '.$id.'');
	}
	echo $this->load->view('learn/hpvideoshow',$data);
    }
    
    public function score_save(){
	$user_id	= $this->session->userdata('STUDENT_ID');
	$video_click_id = $this->input->post('video_click_id');
	$score		= $this->input->post('score');
	if($video_click_id != 0){
	    $data  		= $this->model_basic->existsDB($this->hazardAnswer,array('user_id' =>$user_id,'video_id' =>$video_click_id ));
	    if($data){
		$update_arr = array('score'			=> $score);
		$condition  = array('user_id'		=> $user_id,
				    'video_id'		=> $video_click_id);
		$this->model_basic->editDB($this->hazardAnswer,$update_arr,$condition);
	    }else{
		$inser_arr = array( 'user_id'		=> $user_id,
				    'video_id'		=> $video_click_id,
				    'score'			=> $score);
		$this->model_basic->insertIntoTable($this->hazardAnswer,$inser_arr);
	    }
	}
    }
/**
*
* @Frontend country state dropdown
*
*
*/
  


}


/* End of file hmvc.php */
/* Location: ./application/widgets/hmvc/controllers/hmvc.php */
