<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Answer extends MY_Controller {



    public function __construct(){
        parent::__construct();
        $this->load->model(array('welcome/model_basic','topic/model_topic','mock-test/model_question','mock-test/model_answer'));
	$this->load->library(array('form_validation','upload'));
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
        $data['get_answer_type']    = $data['answer_all'][0]['mock_answer_type'];
        $data['validation_error']   = '';
        
        
        if($this->input->get_post('action') == "Process") {
            
            // For IMAGE Answer //
            if($this->input->get_post('answer_type') == "image") {
                $is_answer=$this->input->get_post('is_answer');
                $files = $_FILES;
                $count = count($_FILES['answer']['name']);
                if($count > 0) { 
                $galleryArr=array();
                $i=0;
                foreach($files['answer']['name'] as $key =>$value)
                {   echo $key."+++".$i;
                    $_FILES['answer']['name']= $files['answer']['name'][$key];
                    $_FILES['answer']['type']= $files['answer']['type'][$key];
                    $_FILES['answer']['tmp_name']= $files['answer']['tmp_name'][$key];
                    $_FILES['answer']['error']= $files['answer']['error'][$key];
                    $_FILES['answer']['size']= $files['answer']['size'][$key];    
                    $this->upload->initialize($this->set_upload_options());

                    if($this->upload->do_upload('answer',true) == False)
                    {
                        $data['img_err'] = $this->upload->display_errors();
                    }
                    else
                    {
                        $image_data = $this->upload->data();
                        $fileName=$image_data['file_name'];
                        $originalImage=$image_data['full_path'];
                        $thumbPath='../uploads/mocktest_answer/thumbs/'.$fileName;
                        $this->_createThumbnail($originalImage,$thumbPath,150,100);
                        $correct_answer=($is_answer[$key] <> '')?$is_answer[$key]:'N';
                        $answer_all[]=array('mock_question_id'=>$question_id,'mock_answer_type'=>'image','mock_answer_text'=>$fileName,'mock_is_answer'=>$correct_answer,'mock_answer_added_on'=>date('Y-m-d H:i:s')); 
                     }
                     $i++;
                }
              } 
              
              if($this->input->get_post('hidden_answer_img')) {
                  $hidden_answer_img = $this->input->get_post('hidden_answer_img');
                  $answerid=$this->input->get_post('answerid');
                  foreach($answerid as $key =>$val)
                  {   
                      $correct_answer=($is_answer[$key] <> '')?$is_answer[$key]:'N'; 
                      $fileName = $hidden_answer_img[$key];
                      $answer_all[]=array('mock_question_id'=>$question_id,'mock_answer_type'=>'image','mock_answer_text'=>$fileName,'mock_is_answer'=>$correct_answer,'mock_answer_added_on'=>date('Y-m-d H:i:s')); 
                  }
              }
            }
           // For TEXT Answer //
            if($this->input->get_post('answer_type') == "text") {
                $answer = $this->input->get_post('answer');
                $is_answer=$this->input->get_post('is_answer');
                foreach($answer as $key =>$val)
                {   
                    $correct_answer=($is_answer[$key] <> '')?$is_answer[$key]:'N';
                    $answer_all[]=array('mock_question_id'=>$question_id,'mock_answer_text'=>$val,'mock_is_answer'=>$correct_answer,'mock_answer_added_on'=>date('Y-m-d H:i:s')); 
                } 
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
        $data['answer_all']    = $this->model_answer->getAnswersDB(array('QM.mock_question_id'=>$question_id,'mock_answer_type'=>'text'));
        echo $this->load->view('ajax_mock_answer_text',$data,TRUE);
        exit;
       } 
       if($answer_type == 'image') {
        $data['answer_all']    = $this->model_answer->getAnswersDB(array('QM.mock_question_id'=>$question_id,'mock_answer_type'=>'image'));
        echo $this->load->view('ajax_mock_answer_image',$data,TRUE);
        exit;
       }
    }

#########################################################
#                 IMAGE UPLOAD OPTION SET             	#
#                                                       #
#                                                       #
#                                                       #
#########################################################     
    private function set_upload_options()
        {   

            $config = array();
            $config['upload_path'] = '../uploads/mocktest_answer/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png';
            $config['max_size'] = 0;
            $config['max_width'] = 0;
            $config['encrypt_name'] = TRUE;
            $config['overwrite']     = FALSE;
            return $config;
        }
         

}


