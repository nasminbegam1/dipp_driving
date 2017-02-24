<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Topic extends MY_Controller {



    public function __construct(){
        parent::__construct();
        $this->load->model(array('welcome/model_basic','step/model_step','topic/model_topic'));
	$this->load->library('form_validation');
        $this->load->module('course');
        $this->url = base_url().'topic/';
        $this->checkLogin();
    }

#########################################################
#                FOR  TOPIC LISTING                     #
#########################################################

    public function index() {
        $this->all();
	}

#########################################################
#                FOR  TOPIC LISTING                     #
#########################################################

    public function all()
    {
	
        
        $this->getTemplate();
        $total_topic      = $this->model_topic->countTopicDB();
	
	$data['totalRecord']      = $total_topic;
	$data['per_page']         = PER_PAGE_LISTING;
	$start                    = 0;
        $data['startRecord']      = $start;
	$data['page']             = $this->uri->segment(3);
	$data['search_keyword']   = "";
	
	if($total_topic > 0) {
            /********** FOR PAGINATION ***********/
            $config['base_url'] = base_url().'/topic/all';
            $config['per_page'] = PER_PAGE_LISTING;
            $config['total_rows'] = $total_topic;
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
            $resultArr=$this->model_topic->allTopicDB($search_by,PER_PAGE_LISTING,$offset);
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
                $this->template->write_view('content','topic_list',$data);
                $this->template->render();
                
            }
        } else {
            $this->template->write_view('content', 'norecord_topic_list.php');
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
        if($this->input->get_post('action') == "Process"){
            $this->session->set_userdata('search_str',trim($this->input->get_post('search_str')));
        }
        if($this->session->userdata('search_str')){
            $search_by = $this->session->userdata('search_str');
        }
        
        $data['search_keyword'] = $search_by;
        $total_topic=$this->model_topic->countTopicDB($search_by);
        $data['totalRecord'] 	= $total_topic;
	$data['per_page'] 	= PER_PAGE_LISTING;
	$start 			= 0;
        $data['startRecord'] 	= $start;
	$data['page']	 	= $this->uri->segment(3);
        if($total_topic > 0)
        {
            /********** FOR PAGINATION ***********/
            $config['base_url'] = base_url().'/topic/search';
            $config['per_page'] =PER_PAGE_LISTING;
            $config['total_rows'] = $total_topic;
            
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


            $resultArr = $this->model_topic->allTopicDB($search_by,PER_PAGE_LISTING,$offset);
	    
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
                                                        'status_link'       => $status_link)
                                                      );
                    $num++;
                }

                $data['topic_all']=$total_result;
                //pr($data['topic_all']);
                /********** FOR PAGINATION ***********/
                $config['cur_tag_open'] = '<span class="current-link">';
                $config['cur_tag_close'] = '</span>';
                $this->pagination->initialize($config);
                $this->session->unset_userdata('search_str');
                $data['paging'] = $this->pagination->create_links();
                $this->template->write_view('content','topic_list',$data);
                $this->template->render();
            }
        }
        else
        {
            $this->template->write_view('content', 'norecord_topic_list.php');
            $this->template->render();
        }
    }

#########################################################
#                FOR  TOPIC LISTING                     #
#########################################################

    public function data()
    {
	
        
        $this->getTemplate();
        $data['step_id']  = $this->uri->segment(3);
        $condition_arr    = array('step_id'=>$data['step_id']);
        $total_topic      = $this->model_topic->countTopicDB("",$condition_arr);
        $total_topic      = ($total_topic > 0)?$total_topic:0;
	
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
            $this->template->write_view('content','step_wise_topic_list',$data);
            $this->template->render();
           
    }

#########################################################
#                   FOR ADD TOPIC                       #
#                                                       #
#                                                       #
#                                                       #
#########################################################
    public function add() {
        $this->getTemplate();
        $data                                   = array();
        $data['base_url']                       = $this->config->item('base_url');
        $data['frmAction']                      = base_url()."topic/add";
        $data['topic_name']                     = '';
        $data['validation_error']               = '';
        
        /***************** For Course Dropdown *******************/
        $data['courseOption'] = $this->course->allCourseOptions();
        /********************************************************/
        
        
        if($this->input->get_post('action') == "Process") {
            $this->form_validation->set_rules('topic_name','Name','required');
            $data['step_id']  = trim($this->input->get_post('step_id'));
            $data['topic_name']  = addslashes(trim($this->input->get_post('topic_name')));
            $data['topic_desc']  = addslashes(trim($this->input->get_post('topic_desc')));
            if ($this->form_validation->run() == TRUE )
            {
                
                $topic_image=$_FILES['topic_image']['name'];
                if($topic_image <> '') {
                    $mainUpload       = $this->imageUpload('topic_image','topic','Y',150,100);
                    $image_name       = $mainUpload['image_name'];
                } 
                
		$main_image=$_FILES['main_image']['name'];
                if($main_image <> '') {
                    $mainImageUpload       	= $this->imageUpload('main_image','topic/main_image','Y',200,200);
                    $main_image       		= $mainImageUpload['image_name'];
                }
		
                $insertArr      = array(
                                    'step_id'           => $data['step_id'],
                                    'name'              => $data['topic_name'],
                                    'image'             => $image_name,
				    'main_image'        => $main_image,
                                    'short_description' => $data['topic_desc'],
                                    'added_on'          => date('Y-m-d H:i:s'),
                                    );
                //pr($insertArr);
                $lastId=$this->model_topic->addTopicDB($insertArr);
                if($lastId <> '') {
                    $this->session->set_flashdata('message', array('title'=>'Add Topic','content'=>'A new topic succesfully added','type'=>'successmsgbox'));
                    redirect(base_url()."topic");
                } else {
                    $this->session->set_flashdata('message', array('title'=>'Add Topic','content'=>'Unable to add topic.please try again','type'=>'errormsgbox'));
                    redirect(base_url()."topic/add");
                }
            }
            else {
                $data['validation_error']=validation_errors();
                $this->session->set_flashdata('message', array('title'=>'Add Topic','content'=>$data['validation_error'],'type'=>'errormsgbox'));
                redirect(base_url()."topic/add");
             }
        }
        $data['return_link'] = base_url()."topic/";
        $this->template->write_view('content','add_topic',$data);
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
            $topic_id                   = $this->uri->segment(3, 0);
            $data['topic_id']           = $topic_id;
            $data['page']               = $this->uri->segment(4, 0);
            $conditionArr               = array('id'=>$topic_id);
            $topic_exist             	= $this->model_topic->topicExistsDB($conditionArr);
            
	    if($topic_id == 0 || !is_numeric($topic_id) || !$topic_exist)
	    {
                    redirect('topic/all');
            }

            /***************** For Course Dropdown *******************/
            $data['courseOption']       = $this->course->allCourseOptions();
            /********************************************************/
            
            $topic_data              	= $this->model_topic->detailsTopicDB($conditionArr);
            $data['step_id']           	= $topic_data[0]['step_id'];
            
            $condition_array            = array('SM.id'=>$data['step_id']);
            $step_details=$this->model_step->detailsStepDB($condition_array);
            $data['course_id']          = $step_details[0]['course_id'];
            
             /***************** For Step Dropdown *******************/
            $stepDropdown= $this->model_basic->populateDropdown("id", "name", "dipp_step_master", "status='Active' AND course_id=".$data['course_id'], "id", "ASC");
            $stepOptions= array();
            for ($i=0; $i < count($stepDropdown); $i++){
            $stepOptions[$stepDropdown[$i]['id']]=  $stepDropdown[$i]['name'];
            }
            $data['stepOption']         = $stepOptions;
           
            
            $data['name']           	= stripslashes($topic_data[0]['name']);
	    $data['image']           	= stripslashes($topic_data[0]['image']);
	    $data['main_image']         = stripslashes($topic_data[0]['main_image']);
            $data['short_description']  = stripslashes($topic_data[0]['short_description']);
	    $data['status']           	= stripslashes($topic_data[0]['status']);
            $data['validation_error']   = '';
           
            
            if($this->input->get_post('action') == "Process") {
                
                $this->form_validation->set_rules('topic_name','Name','required');
                $data['step_id']  = trim($this->input->get_post('step_id'));
                $data['topic_name']  = addslashes(trim($this->input->get_post('topic_name')));
                $data['topic_desc']  = addslashes(trim($this->input->get_post('topic_desc')));
                
                if ($this->form_validation->run() == TRUE )
                {
                    
                    $topic_image=$_FILES['topic_image']['name'];
                    if($topic_image <> '') {
                    $mainUpload       = $this->imageUpload('topic_image','topic','Y',150,100);
                    $image_name       = $mainUpload['image_name'];
                    }
                    else {
                     $image_name       = $this->input->get_post('image_name');
                    }
                
                    
		    $topic_main_image=$_FILES['main_image']['name'];
		    if($topic_main_image <> '') {
			
			if(file_exists(FILE_UPLOAD_ABSOLUTE_PATH.'topic/main_image/'.$data['main_image']) && $data['main_image'] <> ''){
			    unlink(FILE_UPLOAD_ABSOLUTE_PATH.'topic/main_image/'.$data['main_image']);
			}
			if(file_exists(FILE_UPLOAD_ABSOLUTE_PATH.'topic/main_image/thumbs/'.$data['main_image']) && $data['main_image'] <> ''){
			    unlink(FILE_UPLOAD_ABSOLUTE_PATH.'topic/main_image/thumbs/'.$data['main_image']);
			}
			$mainImageUpload       	= $this->imageUpload('main_image','topic/main_image','Y',200,200);
			$main_image       	= $mainImageUpload['image_name'];
		    }else{
			$main_image       	= $data['main_image'];
		    }
                    
                    $updateArr      = array(
                                    'step_id'           => $data['step_id'],
                                    'name'              => $data['topic_name'],
                                    'image'             => $image_name,
				    'main_image'        => $main_image,
                                    'short_description' => $data['topic_desc'],
                                    'updated_on'        => date('Y-m-d H:i:s'),
                                    );

                    $update        = $this->model_topic->editTopicDB($updateArr,$conditionArr);
                    if($update) {
                        $this->session->set_flashdata('message', array('title'=>'Update Topic','content'=>'Data have been successfully edited.','type'=>'successmsgbox'));
                        redirect(base_url()."topic/all/".$data['page']."/");
                      } else {
                        $this->session->set_flashdata('message', array('title'=>'Update Topic','content'=>'Unable to edit data. Please try again.','type'=>'errormsgbox'));
                        redirect('topic/edit/'.$topic_id);
                    }
                
                } 
             else {
                $data['validation_error']=validation_errors();
                $this->session->set_flashdata('message', array('title'=>'Edit Course','content' => $data['validation_error'],'type'=>'errormsgbox'));
                redirect('topic/edit/'.$topic_id);
             }
                
            }
	    
	    $data['return_link'] = base_url()."topic/";
            $this->template->write_view('content','edit_topic',$data); //pr($data);
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
#                FOR  TOPIC OPTIONS                    #
#                                                       #
#                                                       #
#                                                       #
#########################################################

    public function allTopicOptions($step_id='') {
        
        if($step_id <> '') {
           $condition="status='Active' AND step_id=".$step_id;
        } else {
            $condition="status='Active'";
        }
        $topicDropdown= $this->model_basic->populateDropdown("id", "name", " dipp_topic_master", "$condition", "id", "ASC");
	$topicOptions= array();
        $topicOptions['']= "--Select Topic--";
        for ($i=0; $i < count($topicDropdown); $i++){
           $topicOptions[$topicDropdown[$i]['id']]=  $topicDropdown[$i]['name'];
        }
	//pr($courseOptions);
        return $topicOptions;
    }   

#########################################################
#                FOR  TOPIC OPTIONS            		#
#########################################################

    public function getAllTopic()
    {
	$step_id	= $this->input->get_post('step_id');
	$conditionArr	= array('step_id' => $step_id);
	$topic_data 	= $this->model_topic->getAllTopicDB($conditionArr); 
	$option='<option value="">--- Select Topic ---</option>';
	if(count($topic_data) > 0)
	{
	       foreach($topic_data as $val)
	       {
		       $option.="<option value=".$val['id'].">".$val['name']."</option>";
	       }

	}
	echo $option;
	exit;
    }

}


