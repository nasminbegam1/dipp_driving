<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Question extends MY_Controller {



    public function __construct(){
        parent::__construct();
        $this->load->model(array('welcome/model_basic','topic/model_topic','mock-test/model_question'));
				$this->load->library('form_validation');
        $this->load->module('course');
        $this->load->module('topic');
        $this->url = base_url().'mock-test/question';
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

		public function all(){
		
				$this->getTemplate();
				$data['per_page']         = PER_PAGE_LISTING;
				$start                    = 0;
				$data['startRecord']      = $start;
				$data['page']             = $this->uri->segment(4);
				$config['base_url'] = base_url().'/mock-test/question/all';
		
				/***************** For Course Dropdown *******************/
				$data['courseOption']       = $this->course->allCourseOptions();
				$conditionArr = array();
				$data['courseId']="";
		
				if($this->uri->segment(5)) {
						$courseId						= $this->uri->segment(5);
						$conditionArr				= array('CM.id'=>$courseId);
						$data['courseId'] 	= $courseId;
						$config['base_url'] = base_url().'/mock-test/question/all/0/'.$data['courseId'];
				}
				/********************************************************/
		
				$total_question  = $this->model_question->countQuestionDB('',$conditionArr);
				$data['totalRecord']      = $total_question;
				$data['search_keyword']   = "";
		
				if($total_question > 0) {
						/********** FOR PAGINATION ***********/
						$config['per_page'] 	= PER_PAGE_LISTING;
						$config['total_rows'] = $total_question;
		
						if(is_numeric($this->uri->segment(6))) {
								$config['uri_segment'] = 6;
								$offset = abs(ceil($this->uri->segment(6)));
						}
						else if(is_numeric($this->uri->segment(4))) {
								$config['uri_segment'] = 4;
								$offset = abs(ceil($this->uri->segment(4))); 
						}
						else {
								$offset = 0;
						}
		
						$search_by ='';
						$resultArr = $this->model_question->allQuestionDB($search_by,PER_PAGE_LISTING,$offset,$conditionArr);
						//pr($resultArr);
		
						if(count($resultArr) > 0) {
								$num = 1+$offset;
								foreach($resultArr as $values) {
										$question_id  	= $values['mock_question_id'];
										$topic_id 	= $values['topic_id'];
										$status       	= $values['mock_question_status'];
										$status_class 	= ($status == 'Active')?'label-green':'label-red';
										
										//Get Topic Name
										$topic_name = $this->model_topic->getValue_condition('dipp_topic_master', 'name', '', 'id='.$topic_id);
										
										
		
										/********** GET GENERATE EDIT AND DELETE LINK ***********/
										$this->uri_segment 	= $this->uri->total_segments();
										$cur_page       		= 0;
										if ($this->uri->segment($this->uri_segment) != 0) {
												$this->cur_page = $this->uri->segment($this->uri_segment);
												$cur_page = (int) $this->cur_page;
										}
		
										$edit_link          = base_url()."mock-test/question/edit/".$question_id."/".$cur_page."/";
										$delete_link        = base_url()."mock-test/question/delete/".$question_id."/".$cur_page."/";
										$answer_link        = base_url()."mock-test/answer/add/".$question_id."/".$cur_page."/";
										$status_link        = base_url()."mock-test/question/changeStatus/".$question_id."/".$cur_page;
		
										if($num%2==0){
												$class = 'class="even"';
										}
										else{
												$class = 'class="odd"';
										}
		
										$total_result[]     = array_merge($values,
																												array(
																														'slno'              => $num,
																														'class'             => $class,
																														'status_class'      => $status_class,
																														'topic_name'				=> $topic_name,
																														'answer_link'       => $answer_link,
																														'edit_link'         => $edit_link,
																														'delete_link'       => $delete_link,
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
								$this->session->unset_userdata('search_str');
								$this->template->write_view('content','question_list',$data);
								$this->template->render();
						}
				}
				else {
						$this->template->write_view('content', 'norecord_question_list.php',$data);
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
        $data['search_keyword']   = "";
        /********** FOR MODULE SEARCH ***********/
        $search_by ='';
	if($this->input->get_post('action') == "Process"){
            $this->session->set_userdata('search_str',trim($this->input->get_post('search_str')));
        }
        if($this->session->userdata('search_str')){
            $search_by = $this->session->userdata('search_str');
        }
				
	$config['base_url'] = base_url().'/mock-test/question/search';			
	//***************** For Course Dropdown *******************/
         $data['courseOption']       = $this->course->allCourseOptions();
        /********************************************************/
        $conditionArr=array();
        $data['courseId']="";
        if($this->uri->segment(5)) {
            $courseId=$this->uri->segment(5);
            $conditionArr=array('CM.id'=>$courseId);
            $data['courseId']=$courseId;
            $config['base_url'] = base_url().'/mock-test/question/search/0/'.$courseId;
        }
				else{
						$courseId='';
				}
        //echo $search_by;
        $data['search_keyword'] = $search_by;
        $total_question=$this->model_question->countQuestionDB($search_by,$conditionArr);
        $data['totalRecord'] 		= $total_question;
				$data['per_page'] 			= PER_PAGE_LISTING;
				$start 									= 0;
        $data['startRecord'] 		= $start;
				$data['page']	 					= $this->uri->segment(5);
        if($total_question > 0)
        {
            /********** FOR PAGINATION ***********/
            $config['per_page'] = PER_PAGE_LISTING;
            $config['total_rows'] = $total_question;
            
            if(is_numeric($this->uri->segment(6))) {
            $config['uri_segment'] = 6;
            $offset=abs(ceil($this->uri->segment(6)));
            } else if(is_numeric($this->uri->segment(4))) {
            $config['uri_segment'] = 4;
            $offset=abs(ceil($this->uri->segment(4))); 
            }
            else {
                $offset=0;
            }

            $resultArr = $this->model_question->allQuestionDB($search_by,PER_PAGE_LISTING,$offset,$conditionArr);
	    
	    if(count($resultArr) > 0)
	    {
		$num    = 1+$offset;
		foreach($resultArr as $values)
		{
		    $question_id          = $values['mock_question_id'];
		    $topic_id 		  = $values['topic_id'];
                    $status               = $values['mock_question_status'];
                    $status_class         = ($status == 'Active')?'label-green':'label-red';
		    $topic_name = $this->model_topic->getValue_condition('dipp_topic_master', 'name', '', 'id='.$topic_id);
										
                    
                    /********** GET GENERATE EDIT AND DELETE LINK ***********/
                    $this->uri_segment = $this->uri->total_segments();
                    $cur_page = 0;
                    if ($this->uri->segment($this->uri_segment) != 0) {
                        $this->cur_page = $this->uri->segment($this->uri_segment);
                        $cur_page = (int) $this->cur_page;
                    }
		    
                    $edit_link          = base_url()."mock-test/question/edit/".$question_id."/".$cur_page."/";
                    $delete_link        = base_url()."mock-test/question/delete/".$question_id."/".$cur_page."/";
                    $status_link        = base_url()."mock-test/question/changeStatus/".$question_id."/".$cur_page;
                    $answer_link        = base_url()."mock-test/answer/add/".$question_id."/".$cur_page."/";
                    

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
							'topic_name'	    => $topic_name,
                                                        'answer_link'       => $answer_link,    
                                                        'edit_link'         => $edit_link,
                                                        'delete_link'       => $delete_link,    
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
                //$this->session->unset_userdata('search_str');
                $data['paging'] = $this->pagination->create_links();
                $this->template->write_view('content','question_list',$data);
                $this->template->render();
            }
        }
        else
        {
            $this->template->write_view('content', 'norecord_question_list.php',$data);
            $this->template->render();
        }
    }


#########################################################
#                   FOR ADD QUESTION                    #
#                                                       #
#                                                       #
#                                                       #
#########################################################
    public function add() {
        $this->getTemplate();
        $data                                   = array();
        $data['base_url']                       = $this->config->item('base_url');
        $data['frmAction']                      = base_url()."mock-test/question/add";
        $data['question']                       = '';
        $data['validation_error']               = '';
        
        /***************** For Course Dropdown *******************/
        $data['courseOption'] = $this->course->allCourseOptions();
        /********************************************************/
				
				/***************** For Topic Dropdown *******************/
        $data['topicOption'] = $this->model_topic->getAllTopicDB($condition_arr = array('status' => 'Active'), $limit='');
        /********************************************************/
        
        if($this->input->get_post('action') == "Process") {
            $this->form_validation->set_rules('question','Question','required');
            
            $data['course_id'] = trim($this->input->get_post('course_id'));
						$data['question_no'] = trim($this->input->get_post('question_no'));
						$data['topic_id']	= trim($this->input->post('topic_id'));
            $data['question']  = addslashes(trim($this->input->get_post('question')));
            $data['question_explanation']  = addslashes(trim($this->input->get_post('question_explanation')));
            
            if ($this->form_validation->run() == TRUE )
            {
                $image_name = '';
                $question_image=$_FILES['question_image']['name'];
                if($question_image <> '') {
                    $mainUpload       = $this->imageUpload('question_image','question/mock_test','Y',150,100);
                    $image_name       = $mainUpload['image_name'];
                } 
                
                $insertArr      = array(
                                    'mock_course_id'            => $data['course_id'],
																		'topic_id'            			=> $data['topic_id'],
																		'question_no'								=> $data['question_no'],
                                    'mock_question_text'        => $data['question'],
                                    'mock_question_image'       => $image_name,
                                    'mock_question_explanation' => $data['question_explanation'],
                                    'mock_question_added_on' 		=> date('Y-m-d H:i:s'),
                                );
                //pr($insertArr);
                $lastId=$this->model_question->addQuestionDB($insertArr);
                if($lastId <> '') {
                    $this->session->set_flashdata('message', array('title'=>'Add Question','content'=>'A new question succesfully added','type'=>'successmsgbox'));
                    redirect(base_url()."mock-test/question");
                } else {
                    $this->session->set_flashdata('message', array('title'=>'Add Question','content'=>'Unable to add question.please try again','type'=>'errormsgbox'));
                    redirect(base_url()."mock-test/question/add");
                }
            }
            else {
                $data['validation_error']=  trim(validation_errors('<p>', '</p>'));
                $this->session->set_flashdata('message', array('title'=>'Add Question','content'=>$data['validation_error'],'type'=>'errormsgbox'));
                redirect(base_url()."mock-test/question/add");
             }
        }
        $data['return_link'] = base_url()."mock-test/question/";
        $this->template->write_view('content','add_question',$data);
        $this->template->render();
    }


		#########################################################
		#                   FOR EDIT COURSE                   	#
		#########################################################

    public function edit(){
	
				$this->getTemplate();
				$data = array();
				$data['base_url']           = $this->config->item('base_url');
				$question_id                = $this->uri->segment(4, 0);
				$data['question_id']        = $question_id;
				$data['page']               = $this->uri->segment(5, 0);
				$conditionArr               = array('mock_question_id'=>$question_id);
				$question_exist             = $this->model_question->questionExistsDB($conditionArr);
            
				if($question_id == 0 || !is_numeric($question_id) || !$question_exist){
            redirect('mock-test/question/all');
        }
            
            /***************** For Course Dropdown *******************/
            $data['courseOption'] = $this->course->allCourseOptions();
            /********************************************************/
						
						/***************** For Topic Dropdown *******************/
						$data['topicOption'] = $this->model_topic->getAllTopicDB($condition_arr = array('status' => 'Active'), $limit='');
						/********************************************************/
						
            $question_data                  = $this->model_question->detailsQuestionDB($conditionArr);
            $data['course_id']              = stripslashes($question_data[0]['mock_course_id']);
						$data['topicid']              	= stripslashes($question_data[0]['topic_id']);
						$data['question_no'] 						= stripslashes($question_data[0]['question_no']);
            $data['question']               = stripslashes($question_data[0]['mock_question_text']);
            $data['question_explanation']   = stripslashes($question_data[0]['mock_question_explanation']);
            $data['question_image']         = $question_data[0]['mock_question_image'];
            $data['validation_error']       = '';
             
             
            if($this->input->get_post('action') == "Process") {
                
                $this->form_validation->set_rules('question','Question','required');
								$data['topic_id']	= trim($this->input->post('topic_id'));
                $data['question']  = addslashes(trim($this->input->get_post('question')));
								$data['question_no']  = addslashes(trim($this->input->get_post('question_no')));
                $data['question_explanation']  = addslashes(trim($this->input->get_post('question_explanation')));
                $data['course_id'] = trim($this->input->get_post('course_id'));
                
                if ($this->form_validation->run() == TRUE )
                {
                    
                    $question_image=$_FILES['question_image']['name'];
                    if($question_image <> '') {
                    $mainUpload       = $this->imageUpload('question_image','question/mock_test','Y',150,100);
                    $image_name       = $mainUpload['image_name'];
                    }
                    else {
                     $image_name       = $this->input->get_post('image_name');
                    }
                
                    $updateArr      = array(
                                    'mock_course_id'             	=> $data['course_id'],
																		'topic_id'            				=> $data['topic_id'],
																		'question_no'									=> $data['question_no'],
                                    'mock_question_text'         	=> $data['question'],
                                    'mock_question_image'        	=> $image_name,
                                    'mock_question_explanation'  	=> $data['question_explanation'],
                                    'mock_question_updated_on'   	=> date('Y-m-d H:i:s'),
                                    );

                    $update        = $this->model_question->editQuestionDB($updateArr,$conditionArr);
                    if($update) {
                        $this->session->set_flashdata('message', array('title'=>'Update Question','content'=>'Data have been successfully edited.','type'=>'successmsgbox'));
                        redirect(base_url()."mock-test/question/all/".$data['page']."/");
                      } else {
                        $this->session->set_flashdata('message', array('title'=>'Update Question','content'=>'Unable to edit data. Please try again.','type'=>'errormsgbox'));
                        redirect('mock-test/question/edit/'.$question_id);
                    }
                
                } 
             else {
                $data['validation_error']=  trim(validation_errors('<p>', '</p>'));
                $this->session->set_flashdata('message', array('title'=>'Edit Question','content' => $data['validation_error'],'type'=>'errormsgbox'));
                redirect('mock-test/question/edit/'.$question_id);
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
            $conditionArr           = array('mock_question_id'=>$id);
            $question_id            = $this->uri->segment(3, 0);
            $data['question_id']    = $question_id;
            $data['page']           = $this->uri->segment(5, 0);
            $checkExist             = $this->model_question->questionExistsDB($conditionArr);
            if($checkExist) {
                $this->model_question->statusChangeQuestionDB($id);
                $this->session->set_flashdata('message', array('title'=>'Question Status','content'=>'Question status has been changed','type'=>'successmsgbox'));
                redirect(base_url()."mock-test/question/all/".$data['page']);
            }

        }
        


#########################################################
#                   FOR DELETE QUESTION                 #
#########################################################

    public function delete() {
	
            $this->getTemplate();
            $data=array();
            $data['base_url']           = $this->config->item('base_url');
            $question_id                = $this->uri->segment(4, 0);
            $data['question_id']        = $question_id;
            $data['page']               = $this->uri->segment(5, 0);
            $conditionArr               = array('mock_question_id'=>$question_id);
            $question_exist             = $this->model_question->questionExistsDB($conditionArr);
            
	    if($question_id == 0 || !is_numeric($question_id) || !$question_exist)
	    {
                    redirect('mock-test/question/all');
            }
            
            if($question_exist) {
                        
                    $delete = $this->model_question->deleteQuestionDB($conditionArr);
                    if($delete) {
                            $this->session->set_flashdata('message', array('title'=>'Delete Question','content'=>'Record deleted successfully.','type'=>'successmsgbox'));
                            redirect(base_url()."mock-test/question/all/".$data['page']."/");
                    } else {
                            $this->session->set_flashdata('message', array('title'=>'Delete Question','content'=>'Unable to delete the record.!. Please try again.','type'=>'errormsgbox'));
                            redirect(base_url()."mock-test/question/all/".$data['page']."/");
                    }

                }
    }     


}


