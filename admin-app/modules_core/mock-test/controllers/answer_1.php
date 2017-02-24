<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Answer extends MY_Controller {



    public function __construct(){
        parent::__construct();
        $this->load->model(array('welcome/model_basic','topic/model_topic','mock-test/model_question','mock-test/model_answer'));
	$this->load->library('form_validation');
        $this->load->module('course');
        $this->load->module('topic');
        $this->url = base_url().'mock-test/answer/';
        $this->checkLogin();
    }

#########################################################
#                FOR  QUESTION LISTING                  #
#########################################################

    public function index() {
        $this->all();
	}



#########################################################
#                   FOR ADD ANSWER                      #
#                                                       #
#                                                       #
#                                                       #
#########################################################
    public function add() { 
        $this->getTemplate();
        $data                       = array();
        $data['base_url']           = $this->config->item('base_url');
        $question_id                = $this->uri->segment(4, 0);
        $data['question_id']        = $question_id;
        $data['page']               = $this->uri->segment(5, 0);
        $conditionArr               = array('mock_question_id'=>$question_id);
        
        $question_exist             = $this->model_question->questionExistsDB($conditionArr);

        if($question_id == 0 || !is_numeric($question_id) || !$question_exist)
        {
                redirect('question/all');
        }
        
        $question_data              = $this->model_question->detailsQuestionDB($conditionArr);
        $data['question']           = stripslashes($question_data[0]['mock_question_text']);
        $data['question_image']     = $question_data[0]['mock_question_image'];
        
        $data['answer_all']         = $this->model_answer->getAnswersDB(array('QM.mock_question_id'=>$question_id));
        $data['validation_error']   = '';
        
        
        if($this->input->get_post('action') == "Process") {
            $answer = $this->input->get_post('answer');
            $is_answer=$this->input->get_post('is_answer');
            foreach($answer as $key =>$val)
            {   
                $correct_answer=($is_answer[$key] <> '')?$is_answer[$key]:'N';
                $answer_all[]=array('mock_question_id'=>$question_id,'mock_answer_text'=>$val,'mock_is_answer'=>$correct_answer,'mock_answer_added_on'=>date('Y-m-d H:i:s')); 
            }  
           
            
                if($this->model_question->questionExistsDB($conditionArr)) {
                    $returnData=$this->model_answer->addAnswersDB($answer_all,$conditionArr);
                } else {
                   $this->session->set_flashdata('message', array('title'=>'Add Answers','content'=>'Unable to add answer.please try again','type'=>'errormsgbox'));
                   redirect(base_url()."mock-test/question/all/".$data['page']."/");
                }
                if($returnData) {
                    $this->session->set_flashdata('message', array('title'=>'Add Answers','content'=>'Answer has succesfully added','type'=>'successmsgbox'));
                    redirect(base_url()."mock-test/question/all/".$data['page']."/");
                } else {
                    $this->session->set_flashdata('message', array('title'=>'Add Answers','content'=>'Unable to add answer.please try again','type'=>'errormsgbox'));
                    redirect(base_url()."mock-test/answer/add/".$question_id);
                }
            
        }
        $data['return_link'] = base_url()."mock-test/question";
        $this->template->write_view('content','add_answer',$data);
        $this->template->render();
        
    }
    
    
#########################################################
#                FOR  MODULE OPTIONS                    #
#########################################################
    public function getAllAnswer() {
       $data =  array();
       $answer_type           = $this->input->get_post('type');
       $question_id           = $this->input->get_post('question_id');
       if($answer_type == 'text') {
        $data['answer_all']    = $this->model_answer->getAnswersDB(array('QM.question_id'=>$question_id,'answer_type'=>'text'));
        echo $this->load->view('ajax_course_answer_text',$data,TRUE);
        exit;
       } 
       if($answer_type == 'image') {
        $data['answer_all']    = $this->model_answer->getAnswersDB(array('QM.question_id'=>$question_id,'answer_type'=>'image'));
        echo $this->load->view('ajax_course_answer_image',$data,TRUE);
        exit;
       }
    }



}


