<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Answer extends MY_Controller {



    public function __construct(){
        parent::__construct();
        $this->load->model(array('welcome/model_basic','topic/model_topic','question/model_question','question/model_answer'));
	$this->load->library(array('form_validation','upload'));
        $this->load->module('course');
        $this->load->module('topic');
        $this->url = base_url().'answer/';
        $this->checkLogin();
    }

#########################################################
#                FOR  QUESTION LISTING                  #
#########################################################

    public function index() {
        $this->all();
	}

#########################################################
#                FOR  QUESTION LISTING                   #
#########################################################

    public function all()
    {
	
        
        $this->getTemplate();
        $question_id                = $this->uri->segment(4, 0);
        $data['question_id']        = $question_id;
        $data['page']               = $this->uri->segment(5, 0);
        
        $total_answer               = $this->model_answer->countAnswerDB();
	
	$data['totalRecord']      = $total_question;
	$data['per_page']         = PER_PAGE_LISTING;
	$start                    = 0;
        $data['startRecord']      = $start;
	$data['page']             = $this->uri->segment(3);
	$data['search_keyword']   = "";
	
	if($total_question > 0) {
            /********** FOR PAGINATION ***********/
            $config['base_url'] = base_url().'/question/all';
            $config['per_page'] = PER_PAGE_LISTING;
            $config['total_rows'] = $total_question;
            if($this->uri->segment(3)) {
                $config['uri_segment'] = 3;
                if(!is_numeric($this->uri->segment(3))) {
                    $offset=0;
                } else {
                    $offset=abs(ceil($this->uri->segment(3)));
                }
            } else {
                $offset=0;
            }
            $search_by ='';
            $resultArr=$this->model_question->allQuestionDB($search_by,PER_PAGE_LISTING,$offset);
            //pr($resultArr);

            if(count($resultArr) > 0) {
                $num = 1+$offset;
                    foreach($resultArr as $values) {
                    $question_id  = $values['question_id'];
                    $status       = $values['question_status'];
                    $status_class =($status == 'Active')?'label-green':'label-red';    
                    
                    /********** GET GENERATE EDIT AND DELETE LINK ***********/
                    $this->uri_segment = $this->uri->total_segments();
                    $cur_page           = 0;
                    if ($this->uri->segment($this->uri_segment) != 0) {
                        $this->cur_page = $this->uri->segment($this->uri_segment);
                        $cur_page = (int) $this->cur_page;
                    }

                    $edit_link          = base_url()."question/edit/".$question_id."/".$cur_page."/";
                    $status_link        = base_url()."question/changeStatus/".$question_id."/".$cur_page;

                    if($num%2==0)
                    {
                        $class = 'class="even"';
                    }
                    else
                    {
                        $class = 'class="odd"';
                    }
                    
                    $total_result[]     = array_merge($values,
                                                        array(
                                                            'slno'              => $num,
                                                            'class'             => $class,
                                                            'status_class'      => $status_class,
                                                            'edit_link'         => $edit_link,
                                                            'status_link'       => $status_link
                                                            )
                                            );
                    $num++;

                }
                //pr($total_result);
                $data['question_all']        = $total_result;
                /********** FOR PAGINATION ***********/
                $config['cur_tag_open']     = '<span class="current-link">';
                $config['cur_tag_close']    = '</span>';
                $this->pagination->initialize($config);
                $data['paging']             = $this->pagination->create_links();
                $this->template->write_view('content','question_list',$data);
                $this->template->render();
                
            }
        } else {
            $this->template->write_view('content', 'norecord_question_list.php');
            $this->template->render();
         }
    }



#########################################################
#                   FOR QUESTION SEARCH                 #
#                                                       #
#                                                       #
#                                                       #
#########################################################

    public function search(){

        $this->getTemplate();
        /********** FOR QUESTION SEARCH ***********/
        $search_by ='';
        if($this->input->get_post('action') == "Process"){
            $this->session->set_userdata('search_str',trim($this->input->get_post('search_str')));
        }
        if($this->session->userdata('search_str')){
            $search_by = $this->session->userdata('search_str');
        }
        
        $data['search_keyword'] = $search_by;
        $total_question=$this->model_question->countQuestionDB($search_by);
        $data['totalRecord'] 	= $total_question;
	$data['per_page'] 	= PER_PAGE_LISTING;
	$start 			= 0;
        $data['startRecord'] 	= $start;
	$data['page']	 	= $this->uri->segment(3);
        if($total_question > 0)
        {
            /********** FOR PAGINATION ***********/
            $config['base_url'] = base_url().'/question/search';
            $config['per_page'] = PER_PAGE_LISTING;
            $config['total_rows'] = $total_question;
            
            if($this->uri->segment(3))
            {
                $config['uri_segment'] = 3;
                if(!is_numeric($this->uri->segment(3)))
                {
                        $offset=0;
                }
                else
                {
                        $offset=abs(ceil($this->uri->segment(3)));

                }
            }
            else
            {
                $offset=0;
            }


            $resultArr = $this->model_question->allQuestionDB($search_by,PER_PAGE_LISTING,$offset);
	    
	    if(count($resultArr) > 0)
	    {
		$num    = 1+$offset;
		foreach($resultArr as $values)
		{
		    $question_id          = $values['question_id'];
                    $status               = $values['question_status'];
                    $status_class         = ($status == 'Active')?'label-green':'label-red';  
                    
                    /********** GET GENERATE EDIT AND DELETE LINK ***********/
                    $this->uri_segment = $this->uri->total_segments();
                    $cur_page = 0;
                    if ($this->uri->segment($this->uri_segment) != 0) {
                        $this->cur_page = $this->uri->segment($this->uri_segment);
                        $cur_page = (int) $this->cur_page;
                    }
		    
                    $edit_link          = base_url()."question/edit/".$question_id."/".$cur_page."/";
                    $status_link        = base_url()."question/changeStatus/".$question_id."/".$cur_page;
                    

                    if($num%2==0)
                    {
                        $class = 'class="even"';
                    }
                    else
                    {
                        $class = 'class="odd"';
                    }

                    $total_result[]     = array_merge($values,
                                                        array(
                                                        'slno'              => $num,
                                                        'class'             => $class,
                                                        'status_class'      => $status_class,
                                                        'edit_link'         => $edit_link,
                                                        'status_link'       => $status_link)
                                                      );
                    $num++;
                }

                $data['question_all']=$total_result;
                //pr($data['question_all']);
                /********** FOR PAGINATION ***********/
                $config['cur_tag_open'] = '<span class="current-link">';
                $config['cur_tag_close'] = '</span>';
                $this->pagination->initialize($config);
                $this->session->unset_userdata('search_str');
                $data['paging'] = $this->pagination->create_links();
                $this->template->write_view('content','question_list',$data);
                $this->template->render();
            }
        }
        else
        {
            $this->template->write_view('content', 'norecord_question_list.php');
            $this->template->render();
        }
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
        $conditionArr               = array('question_id'=>$question_id);
        $question_exist             = $this->model_question->questionExistsDB($conditionArr);

        if($question_id == 0 || !is_numeric($question_id) || !$question_exist)
        {
                redirect('question/all');
        }
        
        $question_data              = $this->model_question->detailsQuestionDB($conditionArr);
        $data['course_name']        = stripslashes($question_data[0]['course_name']);
        $data['step_name']          = stripslashes($question_data[0]['step_name']);
        $data['topic_name']         = stripslashes($question_data[0]['topic_name']);
        $data['module_name']        = stripslashes($question_data[0]['module_name']);
        $data['question']           = stripslashes($question_data[0]['question_text']);
        $data['question_image']     = $question_data[0]['question_image'];
        
        $data['answer_all']         = $this->model_answer->getAnswersDB(array('QM.question_id'=>$question_id));
        $data['get_answer_type']    = $data['answer_all'][0]['answer_type'];
        $data['validation_error']   = '';
        
        
        if($this->input->get_post('action') == "Process") {
            
            // For IMAGE Answer //
            if($this->input->get_post('answer_type') == "image") {
                $is_answer=$this->input->get_post('is_answer');
                $files = $_FILES;
                $count = count($_FILES['answer']['name']);
                if($count > 0) { 
                $galleryArr=array();
                foreach($files['answer']['name'] as $key =>$value)
                {
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
                        $thumbPath='../uploads/question_answer/thumbs/'.$fileName;
                        $this->_createThumbnail($originalImage,$thumbPath,150,100);
                        $correct_answer=($is_answer[$i] <> '')?$is_answer[$i]:'N';
                        $answer_all[]=array('question_id'=>$question_id,'answer_type'=>'image','answer_text'=>$fileName,'is_answer'=>$correct_answer,'answer_added_on'=>date('Y-m-d H:i:s')); 
                     }

                }
              } 
              
              if($this->input->get_post('hidden_answer_img')) {
                  $hidden_answer_img = $this->input->get_post('hidden_answer_img');
                  $answerid=$this->input->get_post('answerid');
                  foreach($answerid as $key =>$val)
                  {   
                      $correct_answer=($is_answer[$key] <> '')?$is_answer[$key]:'N'; 
                      $fileName = $hidden_answer_img[$key];
                      $answer_all[]=array('question_id'=>$question_id,'answer_type'=>'image','answer_text'=>$fileName,'is_answer'=>$correct_answer,'answer_added_on'=>date('Y-m-d H:i:s')); 
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
                    $answer_all[]=array('question_id'=>$question_id,'answer_text'=>$val,'is_answer'=>$correct_answer,'answer_added_on'=>date('Y-m-d H:i:s')); 
                } 
            }
 
                if($this->model_question->questionExistsDB($conditionArr)) {
                    if(count($answer_all) > 0) {
                        $returnData=$this->model_answer->addAnswersDB($answer_all,$conditionArr);
                    }
                   
                } else {
                   $this->session->set_flashdata('message', array('title'=>'Add Answers','content'=>'Unable to add answer.please try again','type'=>'errormsgbox'));
                   redirect(base_url()."question/all/".$data['page']."/");
                }
                if($returnData) {
                    $this->session->set_flashdata('message', array('title'=>'Add Answers','content'=>'Answer has succesfully added','type'=>'successmsgbox'));
                    redirect(base_url()."question/all/".$data['page']."/");
                } else {
                    $this->session->set_flashdata('message', array('title'=>'Add Answers','content'=>'Unable to add answer.please try again','type'=>'errormsgbox'));
                    redirect(base_url()."question/answer/add/".$question_id);
                }
            
        }
        $data['return_link'] = base_url()."question/";
        $this->template->write_view('content','add_answer',$data);
        $this->template->render();
        
    }


#########################################################
#                   FOR EDIT COURSE                   #
#########################################################

    public function edit()
    {
	 $question_data              = $this->model_question->detailsQuestionDB($conditionArr);
            $data['course_id']          = $question_data[0]['course_id'];
            $data['step_id']            = $question_data[0]['step_id'];
            $data['topic_id']           = $question_data[0]['topic_id'];
            $data['module_id']          = $question_data[0]['module_id'];
            $data['question']           = stripslashes($question_data[0]['question_text']);
            $data['question_image']     = $question_data[0]['question_image'];
            $this->getTemplate();
            $data=array();
            $data['base_url']           = $this->config->item('base_url');
            $question_id                = $this->uri->segment(3, 0);
            $data['question_id']        = $question_id;
            $data['page']               = $this->uri->segment(4, 0);
            $conditionArr               = array('question_id'=>$question_id);
            $question_exist             = $this->model_question->questionExistsDB($conditionArr);
            
	    if($question_id == 0 || !is_numeric($question_id) || !$question_exist)
	    {
                    redirect('question/all');
            }
            
            $question_data              = $this->model_question->detailsQuestionDB($conditionArr);
            $data['course_id']          = $question_data[0]['course_id'];
            $data['step_id']            = $question_data[0]['step_id'];
            $data['topic_id']           = $question_data[0]['topic_id'];
            $data['module_id']          = $question_data[0]['module_id'];
            $data['question']           = stripslashes($question_data[0]['question_text']);
            $data['question_image']     = $question_data[0]['question_image'];
            $data['validation_error']   = '';
             
            
            /***************** For Course Dropdown *******************/
            $data['courseOption']       = $this->course->allCourseOptions();
            /********************************************************/
            
             /***************** For Step Dropdown *******************/
            $stepDropdown= $this->model_basic->populateDropdown("id", "name", "dt_step_master", "status='Active' AND course_id=".$data['course_id'], "id", "ASC");
            $stepOptions= array();
            for ($i=0; $i < count($stepDropdown); $i++){
            $stepOptions[$stepDropdown[$i]['id']]=  $stepDropdown[$i]['name'];
            }
            $data['stepOption']         = $stepOptions;
            /********************************************************/
            
           
            /***************** For Topic Dropdown *******************/
            $data['topicOption']       = $this->topic->allTopicOptions($data['step_id']);
            /********************************************************/
            
            /***************** For Module Dropdown *******************/
             $data['moduleOption']       = $this->allModuleOptions($data['topic_id']);
            /********************************************************/
             
            if($this->input->get_post('action') == "Process") {
                
                $this->form_validation->set_rules('question','Question','required');
                $data['module_id']  = trim($this->input->get_post('module_id'));
                $data['question']  = addslashes(trim($this->input->get_post('question')));
                
                if ($this->form_validation->run() == TRUE )
                {
                    
                    $question_image=$_FILES['question_image']['name'];
                    if($question_image <> '') {
                    $mainUpload       = $this->imageUpload('question_image','question','Y',150,100);
                    $image_name       = $mainUpload['image_name'];
                    }
                    else {
                     $image_name       = $this->input->get_post('image_name');
                    }
                
                    $updateArr      = array(
                                    'module_id'             => $data['module_id'],
                                    'question_text'         => $data['question'],
                                    'question_image'        => $image_name,
                                    'question_updated_on'   => date('Y-m-d H:i:s'),
                                    );

                    $update        = $this->model_question->editQuestionDB($updateArr,$conditionArr);
                    if($update) {
                        $this->session->set_flashdata('message', array('title'=>'Update Question','content'=>'Data have been successfully edited.','type'=>'successmsgbox'));
                        redirect(base_url()."question/all/".$data['page']."/");
                      } else {
                        $this->session->set_flashdata('message', array('title'=>'Update Question','content'=>'Unable to edit data. Please try again.','type'=>'errormsgbox'));
                        redirect('question/edit/'.$question_id);
                    }
                
                } 
             else {
                $data['validation_error']=  trim(validation_errors('<p>', '</p>'));
                $this->session->set_flashdata('message', array('title'=>'Edit Question','content' => $data['validation_error'],'type'=>'errormsgbox'));
                redirect('question/edit/'.$question_id);
             }
                
            }
	    
	    $data['return_link'] = base_url()."question/";
            $this->template->write_view('content','edit_question',$data); //pr($data);
	    $this->template->render();
            
        }



#########################################################
#                FOR  COURSE STATUS CHANGE            #
#                                                       #
#                                                       #
#                                                       #
#########################################################

        function changeStatus($id) {
            $conditionArr           = array('question_id'=>$id);
            $question_id            = $this->uri->segment(3, 0);
            $data['question_id']    = $question_id;
            $data['page']           = $this->uri->segment(4, 0);
            $checkExist             = $this->model_question->questionExistsDB($conditionArr);
            if($checkExist) {
                $this->model_question->statusChangeQuestionDB($id);
                $this->session->set_flashdata('message', array('title'=>'Question Status','content'=>'Question status has been changed','type'=>'successmsgbox'));
                redirect(base_url()."question/all/".$data['page']);
            }

        }
        
#########################################################
#                FOR  COURSE STATUS CHANGE            #
#                                                       #
#                                                       #
#                                                       #
#########################################################

        function uniqueCheck() {
            if($this->input->get_post('action') && $this->input->get_post('action')=='availability')
            {    
                $cat_name          = trim($this->input->get_post('cat_name'));
                $cat_id            = '';
                if($this->input->get_post('cat_id')) {
                    $cat_id        = trim($this->input->get_post('cat_id'));
                }
                $conditionArr      = array('cat_name'=>$cat_name);
                $checkExist        = $this->model_course->categoryUniqueDB($conditionArr,$cat_id);
                if($checkExist) {
                    echo '<font color="red">The category <strong>'.$cat_name.'</strong>'.' is already in use.</font>';
                } else {
                    echo 'OK';
                }
            } 

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
#########################################################
#                FOR  MODULE OPTIONS                    #
#########################################################

    public function allModuleOptions($topic_id='') {
        if($topic_id <> '') {
           $condition="module_status='Active' AND topic_id=".$topic_id;
        } else {
            $condition="module_status='Active'";
        }
        $moduleDropdown= $this->model_basic->populateDropdown("module_id", "module_name", " dt_module_master", "$condition", "module_id", "ASC");
	$moduleOptions= array();
        $moduleOptions['']= "--Select Topic--";
        for ($i=0; $i < count($moduleDropdown); $i++){
           $moduleOptions[$moduleDropdown[$i]['module_id']]=  $moduleDropdown[$i]['module_name'];
        }
	//pr($courseOptions);
        return $moduleOptions;
    }   


#########################################################
#                FOR  MODULE OPTIONS FOR AJAX           #
#########################################################

    public function getAllModule()
    {
	$topic_id	= $this->input->get_post('topic_id');
	$conditionArr	= array('topic_id' => $topic_id);
	$module_data 	= $this->model_question->getAllModuleDB($conditionArr); 
	$option='<option value="">--- Select Topic ---</option>';
	if(count($module_data) > 0)
	{
	       foreach($module_data as $val)
	       {
		       $option.="<option value=".$val['module_id'].">".$val['module_name']."</option>";
	       }

	}
	echo $option;
	exit;
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
            $config['upload_path'] = '../uploads/question_answer/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png';
            $config['max_size'] = 0;
            $config['max_width'] = 0;
            $config['encrypt_name'] = TRUE;
            $config['overwrite']     = FALSE;
            return $config;
        }
         

}


