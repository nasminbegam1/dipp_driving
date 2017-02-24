<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lesson extends MY_Controller {



    public function __construct(){
        parent::__construct();
        $this->load->model(array('welcome/model_basic','step/model_step','topic/model_topic', 'lesson/model_lesson'));
	$this->load->library('form_validation');
        $this->load->module('course');
        $this->url = base_url().'lesson/';
        $this->checkLogin();
    }

#########################################################
#                FOR  LESSON LISTING                     #
#########################################################

    public function index() {
        $this->all();
	}

#########################################################
#                FOR  LESSON LISTING                    #
#########################################################

		public function all(){
				$this->getTemplate();
				$total_record      = $this->model_lesson->countLessonDB();
		
				$data['totalRecord']      = $total_record;
				$data['per_page']         = PER_PAGE_LISTING;
				$start                    = 0;
				$data['startRecord']      = $start;
				$data['page']             = $this->uri->segment(3);
				$data['search_keyword']   = "";
				$data['add_url']       	  = base_url().'lesson/add';
                                /***************** For Course Dropdown *******************/
                                $data['courseOption'] = $this->course->allCourseOptions(); //pr($data['courseOption']);
                                /********************************************************/    
				
		
		if($total_record > 0) {
		/********** FOR PAGINATION ***********/
		$config['base_url'] = base_url().'/lesson/all';
		$config['per_page'] = PER_PAGE_LISTING;
		$config['total_rows'] = $total_record;
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
                $search_by_topic_id = '';
		$resultArr=$this->model_lesson->allLessonDB($search_by,$search_by_topic_id,PER_PAGE_LISTING,$offset);
		//pr($resultArr);
		
		if(count($resultArr) > 0) {
		$num = 1+$offset;
		foreach($resultArr as $values) {
		$id           = $values['id'];
		$status       = $values['status'];
		$status_class =($status == 'Active')?'label-green':'label-red';    
		
		/********** GET GENERATE EDIT AND DELETE LINK ***********/
		$this->uri_segment = $this->uri->total_segments();
		$cur_page           = 0;
		if ($this->uri->segment($this->uri_segment) != 0) {
		$this->cur_page = $this->uri->segment($this->uri_segment);
		$cur_page = (int) $this->cur_page;
		}
		
		$edit_link          = base_url()."lesson/edit/".$id."/".$cur_page."/";
		$status_link        = base_url()."lesson/changeStatus/".$id."/".$cur_page;
		
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
		$data['lesson_all']        = $total_result;
		/********** FOR PAGINATION ***********/
		$config['cur_tag_open']     = '<span class="current-link">';
		$config['cur_tag_close']    = '</span>';
		$this->pagination->initialize($config);
		$data['paging']             = $this->pagination->create_links();
		$this->template->write_view('content','lesson_list',$data);
		$this->template->render();
		
		}
		} else {
		//echo "Hii";exit();
		$this->template->write_view('content', 'norecord_lesson_list.php',$data);
		$this->template->render();
		}
		}



#########################################################
#                   FOR TOPIC SEARCH                    #
#                                                       #
#                                                       #
#                                                       #
#########################################################

    public function search(){

        $this->getTemplate();
        /********** FOR TOPIC SEARCH ***********/
        $search_by ='';
        $search_by_topic_id = '';
        if($this->input->get_post('action') == "Process"){
            $this->session->set_userdata('search_str',trim($this->input->get_post('search_str')));
            $this->session->set_userdata('topic_id',trim($this->input->get_post('topic_id')));
        }
        if($this->session->userdata('search_str')){
            $search_by = $this->session->userdata('search_str');
            $search_by_topic_id = $this->session->userdata('topic_id');
        }
        /***************** For Course Dropdown *******************/
        $data['courseOption'] = $this->course->allCourseOptions(); //pr($data['courseOption']);
        /********************************************************/ 
        $data['search_keyword'] = $search_by;
        $total_topic=$this->model_lesson->countLessonDB($search_by,$search_by_topic_id);
        $data['totalRecord'] 	= $total_topic;
	$data['per_page'] 	= PER_PAGE_LISTING;
	$start 			= 0;
        $data['startRecord'] 	= $start;
	$data['page']	 	= $this->uri->segment(3);
	$data['add_url']       	 = base_url().'lesson/add';
	
        if($total_topic > 0)
        {
            /********** FOR PAGINATION ***********/
            $config['base_url'] 	= base_url().'/lesson/search';
            $config['per_page'] 	= PER_PAGE_LISTING;
            $config['total_rows'] 	= $total_topic;
            
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


            $resultArr = $this->model_lesson->allLessonDB($search_by,$search_by_topic_id,PER_PAGE_LISTING,$offset);
           
            
	    
	    if(count($resultArr) > 0)
	    {
		$num    = 1+$offset;
		foreach($resultArr as $values)
		{
		    $id          = $values['id'];
                    $status      = $values['status'];
                    $status_class=($status == 'Active')?'label-green':'label-red';  
                    
                    /********** GET GENERATE EDIT AND DELETE LINK ***********/
                    $this->uri_segment = $this->uri->total_segments();
                    $cur_page = 0;
                    if ($this->uri->segment($this->uri_segment) != 0) {
                        $this->cur_page = $this->uri->segment($this->uri_segment);
                        $cur_page = (int) $this->cur_page;
                    }
		    
                    $edit_link          = base_url()."lesson/edit/".$id."/".$cur_page."/";
                    $status_link        = base_url()."lesson/changeStatus/".$id."/".$cur_page;
                    

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

                $data['lesson_all']=$total_result;
                //pr($data['topic_all']);
                /********** FOR PAGINATION ***********/
                $config['cur_tag_open'] = '<span class="current-link">';
                $config['cur_tag_close'] = '</span>';
                $this->pagination->initialize($config);
                //$this->session->unset_userdata('search_str');
                $data['paging'] = $this->pagination->create_links();
                $this->template->write_view('content','lesson_list',$data);
                $this->template->render();
            }
        }
        else
        {
            $this->template->write_view('content', 'norecord_lesson_list.php', $data);
            $this->template->render();
        }
    }

#########################################################
#                FOR  LESSON LISTING                     #
#########################################################

    public function data()
    {
	
        
        $this->getTemplate();
        $data['step_id']  = $this->uri->segment(3);
        $condition_arr    = array('step_id'=>$data['step_id']);
        $total_topic      = $this->model_topic->countTopicDB("",$condition_arr);
	
	$data['totalRecord']      = $total_topic;
	$data['per_page']         = PER_PAGE_LISTING;
	$start                    = 0;
        $data['startRecord']      = $start;
	$data['page']             = $this->uri->segment(4);
	$data['search_keyword']   = "";
	
        /********** FOR PAGINATION ***********/
        $config['base_url'] = base_url().'/topic/all';
        $config['per_page'] = PER_PAGE_LISTING;
        $config['total_rows'] = $total_topic;
            if($this->uri->segment(4)) {
                $config['uri_segment'] = 4;
                if(!is_numeric($this->uri->segment(4))) {
                    $offset=0;
                } else {
                    $offset=abs(ceil($this->uri->segment(4)));
                }
            } else {
                $offset=0;
            }
            $search_by ='';
            $resultArr=$this->model_topic->allTopicDB($search_by,PER_PAGE_LISTING,$offset,$condition_arr);
            //pr($resultArr);
            $num = 1+$offset;
            foreach($resultArr as $values) {
            $id           = $values['id'];
            $status       = $values['status'];
            $status_class =($status == 'Active')?'label-green':'label-red';    

            /********** GET GENERATE EDIT AND DELETE LINK ***********/
            $this->uri_segment = $this->uri->total_segments();
            $cur_page           = 0;
            if ($this->uri->segment($this->uri_segment) != 0) {
                $this->cur_page = $this->uri->segment($this->uri_segment);
                $cur_page = (int) $this->cur_page;
            }

            $edit_link          = base_url()."topic/edit/".$id."/".$cur_page."/";
            $status_link        = base_url()."topic/changeStatus/".$id."/".$cur_page;

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
            $data['topic_all']        = $total_result;
            /********** FOR PAGINATION ***********/
            $config['cur_tag_open']     = '<span class="current-link">';
            $config['cur_tag_close']    = '</span>';
            $this->pagination->initialize($config);
            $data['paging']             = $this->pagination->create_links();
            $this->template->write_view('content','lesson_list',$data);
            $this->template->render();
           
    }

#########################################################
#                   FOR ADD TOPIC                       #
#                                                       #
#                                                       #
#                                                       #
#########################################################
    public function add()
    {
	$this->getTemplate();
        $data                                   = array();
        $data['base_url']                       = $this->config->item('base_url');
        $data['frmAction']                      = base_url()."lesson/add";
        $data['topic_name']                     = '';
        $data['validation_error']               = '';
        
        /***************** For Course Dropdown *******************/
        $data['courseOption'] = $this->course->allCourseOptions(); //pr($data['courseOption']);
        /********************************************************/
        
        
        if($this->input->get_post('action') == "Process") {
            $this->form_validation->set_rules('name','Name','required');
	    
            $data['topic_id']		= trim($this->input->get_post('topic_id'));
            $data['name']		= addslashes(trim($this->input->get_post('name')));
            $data['description']  	= addslashes(trim($this->input->get_post('description')));
	    $total_value                = $this->input->post('total_value');
	    //pr($total_value);
            if ($this->form_validation->run() == TRUE )
            {
                $insertArr      = array(
                                    'topic_id'          => $data['topic_id'],
                                    'name'              => $data['name'],
                                    'description'       => $data['description'],
                                    'status' 		=> $this->input->get_post('status')
                                    );
		$lastId=$this->model_lesson->addLessonMasterDB($insertArr);
		
                if($lastId <> '')
		{
		    
		    for($i=0;$i<=$total_value;$i++){
			$desc_type = $this->input->post('desc_type_'.$i);
			if($desc_type != ''){
			if($desc_type == 'text'){
			    $data['desc_content'] = $this->input->get_post('desc_content_'.$i.'');
			}else{
			    $mainUpload       		= $this->imageUpload('lesson_image_'.$i.'','lesson','Y',240,320);
			    $image_name       		= $mainUpload['image_name'];
			    $data['desc_content'] 	= $image_name;
			}
			$insertArr1      = array(
					    'lesson_id'		=> $lastId,
					    'desc_type'         => $desc_type,
					    'desc_content'	=> $data['desc_content'],
					    'status' 		=> $this->input->get_post('status')
					    );
			$this->model_lesson->addLessonDetailDB($insertArr1);
			}
		    
		    }
		    
                    $this->session->set_flashdata('message', array('title'=>'Add Lesson','content'=>'A new lesson succesfully added','type'=>'successmsgbox'));
                    redirect(base_url()."lesson");
                } else {
                    $this->session->set_flashdata('message', array('title'=>'Add Lesson','content'=>'Unable to add topic.please try again','type'=>'errormsgbox'));
                    redirect(base_url()."lesson/add");
                }
            }
            else {
                $data['validation_error']=validation_errors();
                $this->session->set_flashdata('message', array('title'=>'Add Lesson','content'=>$data['validation_error'],'type'=>'errormsgbox'));
                redirect(base_url()."lesson/add");
             }
        }
        $this->template->write_view('content','add_lesson',$data);
        $this->template->render();
        
    }


#########################################################
#                   FOR EDIT COURSE                   #
#########################################################

    public function edit()
    {
	
            $this->getTemplate();
            $data=array();
            $data['base_url']           = $this->config->item('base_url');
            $lesson_id                  = $this->uri->segment(3, 0);
            $data['lesson_id']          = $lesson_id;
            $data['page']               = $this->uri->segment(4, 0);
            $conditionArr               = array('id'=>$lesson_id);
            $lesson_exist             	= $this->model_lesson->lessonExistsDB($conditionArr);
	    if($lesson_id == 0 || !is_numeric($lesson_id) || !$lesson_exist)
	    {
                    redirect('lesson/all');
            }

            /***************** For Course Dropdown *******************/
            $data['courseOption']       = $this->course->allCourseOptions();
            /********************************************************/
	
            $lesson_data              	= $this->model_lesson->detailsLessonDB(array('LM.id'=>$lesson_id)); //pr($lesson_data,0);
	    $lesson_details_data        = $this->model_lesson->getLessonDetails(array('lesson_id'=>$lesson_id));

            $data['lesson_id']          = $lesson_data[0]['lesson_id'];
	    $data['course_id']          = $lesson_data[0]['course_id'];
	    $data['step_id']           	= $lesson_data[0]['step_id'];
	    $data['topic_id']           = $lesson_data[0]['topic_id'];
	    
	    $data['desc_type']           = $lesson_data[0]['desc_type'];
	    $data['desc_content']        = $lesson_data[0]['desc_content'];
            $data['lesson_details_data'] = $lesson_details_data;
	    //pr($data);
            //$condition_array            = array('SM.id'=>$data['step_id']);
            //$step_details=$this->model_step->detailsStepDB($condition_array);
            //$data['course_id']          = $step_details[0]['course_id'];
            
             /***************** For Step Dropdown *******************/
            $stepDropdown= $this->model_basic->populateDropdown("id", "name", "dipp_step_master", "status='Active' AND course_id=".$data['course_id'], "id", "ASC");
	    
	    //pr($stepDropdown);
	    
            $stepOptions= array();
            for ($i=0; $i < count($stepDropdown); $i++)
	    {
		$stepOptions[$stepDropdown[$i]['id']]=  $stepDropdown[$i]['name'];
            }
	    
            $data['stepOption']         = $stepOptions;
	    
	    /***************** For Topic Dropdown *******************/
            $topicDropdown= $this->model_basic->populateDropdown("id", "name", "dipp_topic_master", "status='Active' AND step_id=".$data['step_id'], "id", "ASC");
           
	    $topicOptions= array();
            for ($i=0; $i < count($topicDropdown); $i++)
	    {
		$topicOptions[$topicDropdown[$i]['id']]=  $topicDropdown[$i]['name'];
            }
	    
            $data['topicOption']        = $topicOptions;
            
	    $data['id']           	= $lesson_data[0]['lesson_id'];
            $data['name']           	= stripslashes($lesson_data[0]['name']);
	    $data['description']        = stripslashes($lesson_data[0]['description']);
            $data['desc_type']  	= stripslashes($lesson_data[0]['desc_type']);
	    $data['desc_content']       = stripslashes($lesson_data[0]['desc_content']);
	    $data['status']       	= stripslashes($lesson_data[0]['status']);
	    
            $data['validation_error']   = '';
           
            
            if($this->input->get_post('action') == "Process") {
		$this->form_validation->set_rules('name','Name','required');
	    
		$data['topic_id']	= trim($this->input->get_post('topic_id'));
		$data['name']		= addslashes(trim($this->input->get_post('name')));
		$data['description']  	= addslashes(trim($this->input->get_post('description')));
	        $total_value            = $this->input->post('total_value');
		
		if ($this->form_validation->run() == TRUE )
		{
		$update_arr      = array(
                                    'topic_id'          => $data['topic_id'],
                                    'name'              => $data['name'],
                                    'description'       => $data['description'],
                                    'status' 		=> $this->input->get_post('status')
                                    );
		
		$condition_arr = array('id' => $data['id']);
		
		//pr($update_arr);
                
		if($this->model_lesson->editLessonDB($update_arr, $condition_arr, 'dipp_lesson_master'))
		{
		    $condition_arr = array('lesson_id' => $data['id']);
		    $this->model_lesson->deleteLessionDetails($condition_arr);
		    
		    for($i=0;$i<=$total_value;$i++){
			
			$desc_type = $this->input->post('desc_type_'.$i);
			if($desc_type != ''){
			if($desc_type == 'text'){
			    $data['desc_content'] = $this->input->get_post('desc_content_'.$i.'');
			}else{
			    if($_FILES['lesson_image_'.$i.'']['name'] != '' && $_FILES['lesson_image_'.$i.'']['tmp_name'] != ''){
			    $mainUpload       		= $this->imageUpload('lesson_image_'.$i.'','lesson','Y',240,320);
			    $image_name       		= $mainUpload['image_name'];
			    }else{
				$image_name       	= $this->input->get_post('lesson_image_name_'.$i.'');
			    }
			    $data['desc_content'] 	= $image_name;
			    
			}
                        $data['other_content'] = $this->input->get_post('other_content_'.$i.'');
                        
			$insertArr1      = array(
					    'lesson_id'		=> $data['id'],
					    'desc_type'         => $desc_type,
					    'desc_content'	=> $data['desc_content'],
                                            'other_content'     => $data['other_content'],
					    'status' 		=> $this->input->get_post('status')
					    );
			$this->model_lesson->addLessonDetailDB($insertArr1);
			}
		    }
		    $this->session->set_flashdata('message', array('title'=>'Edit Lesson','content'=>'Record succesfully updated','type'=>'successmsgbox'));
		    redirect(base_url()."lesson");
		}
		else
		{
		    $this->session->set_flashdata('message', array('title'=>'Edit Lesson','content'=>'Unable to update.please try again','type'=>'errormsgbox'));
                    redirect(base_url()."lesson/edit");
		}
		
	    }
            else {
                $data['validation_error']=validation_errors();
                $this->session->set_flashdata('message', array('title'=>'Add Lesson','content'=>$data['validation_error'],'type'=>'errormsgbox'));
                redirect(base_url()."lesson/edit");
             }
        }
	    
	    $data['return_link'] = base_url()."lesson/";
	    //pr($data);
            $this->template->write_view('content','edit_lesson',$data); //pr($data);
	    $this->template->render();
            
        }



#########################################################
#                FOR  COURSE STATUS CHANGE            #
#                                                       #
#                                                       #
#                                                       #
#########################################################

        function changeStatus($id) {
            $conditionArr           = array('id'=>$id);
            $topic_id               = $this->uri->segment(3, 0);
            $data['topic_id']       = $topic_id;
            $data['page']           = $this->uri->segment(4, 0);
            $checkExist             = $this->model_topic->topicExistsDB($conditionArr);
            if($checkExist) {
                $this->model_topic->statusChangeTopicDB($id);
                $this->session->set_flashdata('message', array('title'=>'Topic Status','content'=>'Topic status has been changed','type'=>'successmsgbox'));
                redirect(base_url()."topic/all/".$data['page']);
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
#               DELETE LESSION DETAILS            #
#########################################################
	function deleteLessionDetails(){
            $id               		= $this->uri->segment(3, 0);
            $lesson_id       		= $this->uri->segment(4, 0);
            $page           		= $this->uri->segment(5, 0);
	    $condition_arr 		= array('id' => $id);
	    $getDetails                 = $this->model_lesson->getLessonDetails($condition_arr);
	    if($getDetails[0]['desc_type']== 'image' && $getDetails[0]['desc_content'] != ''){
		if(file_exists(FILE_UPLOAD_ABSOLUTE_PATH.'lesson/thumbs/'.$getDetails[0]['desc_content']))
		{
		    unlink(FILE_UPLOAD_ABSOLUTE_PATH.'lesson/thumbs/'.$getDetails[0]['desc_content']);
		}
		
		if(file_exists(FILE_UPLOAD_ABSOLUTE_PATH.'lesson/'.$getDetails[0]['desc_content']))
		{
		    unlink(FILE_UPLOAD_ABSOLUTE_PATH.'lesson/'.$getDetails[0]['desc_content']);
		}
	    }
	    $this->model_lesson->deleteLessionDetails($condition_arr);
	    $this->session->set_flashdata('message', array('title'=>'Delete Lesson','content'=>'Lesson details deleted successfully!','type'=>'successmsgbox'));
            redirect(base_url()."lesson/edit/".$lesson_id."/".$page.'/');
	}
	


        
}