<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Module extends MY_Controller {



    public function __construct(){
        parent::__construct();
        $this->load->model(array('welcome/model_basic','topic/model_topic','module/model_module'));
	$this->load->library('form_validation');
        $this->load->module('course');
        $this->load->module('topic');
        $this->url = base_url().'module/';
        $this->checkLogin();
    }

#########################################################
#                FOR  MODULE LISTING                  #
#########################################################

    public function index() {
        $this->all();
	}

#########################################################
#                FOR  MODULE LISTING                   #
#########################################################

    public function all(){
				$this->getTemplate();
				$data['per_page']         = PER_PAGE_LISTING;
				$start                    = 0;
				$data['startRecord']      = $start;
				$data['page']             = $this->uri->segment(3);
       
				/***************** For Course Dropdown *******************/
				$data['courseOption']       = $this->course->allCourseOptions();
				/********************************************************/
				$conditionArr=array();
				$data['courseId']="";
				if($this->uri->segment(4)) {
						$courseId=$this->uri->segment(4);
						$conditionArr=array('CM.id'=>$courseId);
						$data['courseId']=$courseId;
				}
			 
			  $total_record  						= $this->model_module->countModuleDB('',$conditionArr);
				$data['totalRecord']      = $total_record;
				$data['search_keyword']   = "";
	
				if($total_record > 0) {
            /********** FOR PAGINATION ***********/
            $config['base_url'] = base_url().'/module/all';
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
            $resultArr=$this->model_module->allModuleDB($search_by,PER_PAGE_LISTING,$offset,$conditionArr);
	    
            //pr($resultArr);

            if(count($resultArr) > 0) {
										$num = 1+$offset;
                    foreach($resultArr as $values) {
                    $module_id  	= $values['module_id'];
                    $module_status      = $values['module_status'];
                    $status_class 	=($module_status == 'Active')?'label-green':'label-red';    
                    
                    /********** GET GENERATE EDIT AND DELETE LINK ***********/
                    $this->uri_segment = $this->uri->total_segments();
                    $cur_page           = 0;
                    if ($this->uri->segment($this->uri_segment) != 0) {
                        $this->cur_page = $this->uri->segment($this->uri_segment);
                        $cur_page = (int) $this->cur_page;
                    }

                    $edit_link          = base_url()."module/edit/".$module_id."/".$cur_page."/";
										$delete_link        = base_url()."module/delete/".$module_id."/".$cur_page."/";
                    $status_link        = base_url()."module/changeStatus/".$module_id."/".$cur_page;

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
																														'delete_link'       => $delete_link,
                                                            'status_link'       => $status_link
                                                            )
                                            );
                    $num++;

                }
                //pr($total_result);
                $data['module_all']        = $total_result;
                /********** FOR PAGINATION ***********/
                $config['cur_tag_open']     = '<span class="current-link">';
                $config['cur_tag_close']    = '</span>';
                $this->pagination->initialize($config);
                $data['paging']             = $this->pagination->create_links();
                $this->template->write_view('content','module_list',$data);
                $this->template->render();
                
            }
        } else {
            $this->template->write_view('content', 'norecord_module_list.php',$data);
            $this->template->render();
         }
    }



#########################################################
#                   FOR MODULE SEARCH                   #
#########################################################

    public function search(){ 
        
				$this->getTemplate();
        $search_by ='';
				
			  if($this->input->get_post('action') == "Process"){
            $this->session->set_userdata('search_str',trim($this->input->get_post('search_str')));
        }
        if($this->session->userdata('search_str')){
            $search_by = $this->session->userdata('search_str');
        }
        
        $data['courseOption'] = $this->course->allCourseOptions();
        $conditionArr					= array();
        $data['courseId']			= "";
				
				if($this->uri->segment(3)){
						$courseId=$this->uri->segment(3);
						$conditionArr=array('CM.id'=>$courseId);
						$data['courseId']=$courseId;
				}

        $data['search_keyword'] = $search_by;				
			  $data['totalRecord'] 		= $total_record;
				$data['per_page'] 			= PER_PAGE_LISTING;
				$start 									= 0;
        $data['startRecord'] 		= $start;
				$data['page']	 					= $this->uri->segment(4);
				$total_record						= $this->model_module->countModuleDB($search_by,$conditionArr);
	
        if($total_record > 0){
						$config['base_url'] = base_url().'/module/search/';
            $config['per_page'] = PER_PAGE_LISTING;
            $config['total_rows'] = $total_record;
            
            if($this->uri->segment(3)){
                $config['uri_segment'] = 3;
                if(!is_numeric($this->uri->segment(3))){
                    $offset=0;
                }
                else{
                    $offset=abs(ceil($this->uri->segment(3)));
                }
            }
            else{
                $offset=0;
            }

            $resultArr = $this->model_module->allModuleDB($search_by,PER_PAGE_LISTING,$offset,$conditionArr); 
	    
						if(count($resultArr) > 0){
								$num    = 1+$offset;
								foreach($resultArr as $values){
										$module_id          = $values['module_id'];
										$module_status      = $values['module_status'];
										$status_class       = ($module_status == 'Active')?'label-green':'label-red';  
								
										$this->uri_segment 	= $this->uri->total_segments();
										$cur_page 					= 0;
								
										if ($this->uri->segment($this->uri_segment) != 0) {
												$this->cur_page = $this->uri->segment($this->uri_segment);
												$cur_page 			= (int) $this->cur_page;
										}
								
										$edit_link          = base_url()."module/edit/".$module_id."/".$cur_page."/";
										$delete_link        = base_url()."module/delete/".$module_id."/".$cur_page."/";
										$status_link        = base_url()."module/changeStatus/".$module_id."/".$cur_page;
								
										if($num%2==0){
												$class = 'class="even"';
										}
										else{
												$class = 'class="odd"';
										}
								
										$total_result[] = array_merge($values,
																						array(
																									'slno'           => $num,
																									'class'          => $class,
																									'status_class'   => $status_class,
																									'edit_link'      => $edit_link,
																									'delete_link'    => $delete_link,
																									'status_link'    => $status_link)
																					);
										$num++;
								}
						
								$data['module_all']=$total_result;
						
								$config['cur_tag_open'] = '<span class="current-link">';
								$config['cur_tag_close'] = '</span>';
								
								$this->pagination->initialize($config);
								$this->session->unset_userdata('search_str');
								$data['paging'] = $this->pagination->create_links();
								$this->template->write_view('content','module_list',$data);
								$this->template->render();
						}
        }
        else{
            $this->template->write_view('content', 'norecord_module_list.php',$data);
            $this->template->render();
        }
    }


#########################################################
#                   FOR ADD MODULE                      #
#########################################################
    public function add() {
        $this->getTemplate();
        $data                                   = array();
        $data['base_url']                       = $this->config->item('base_url');
        $data['frmAction']                      = base_url()."module/add";
        $data['module']                       	= '';
        $data['validation_error']               = '';
        
        
        /***************** For Course Dropdown *******************/
         $data['courseOption']       = $this->course->allCourseOptions();
        /********************************************************/
        
        if($this->input->get_post('action') == "Process")
	{
	    $this->form_validation->set_rules('module_name','Module Name','required');
            $data['topic_id'] 		= trim($this->input->get_post('topic_id'));
            $data['module_name']	= addslashes(trim($this->input->get_post('module_name')));
            $data['module_status']	= $this->input->get_post('module_status');
	    
            if ($this->form_validation->run() == TRUE )
            {
                $insertArr      = array(
                                    'topic_id'         	=> $data['topic_id'],
                                    'module_name'     	=> $data['module_name'],
                                    'module_status'    	=> $data['module_status'],
                                    'module_added_on'	=> date('Y-m-d H:i:s'),
                                    );
                //pr($insertArr);
                $lastId=$this->model_module->addModuleDB($insertArr);
                if($lastId <> '') {
                    $this->session->set_flashdata('message', array('title'=>'Add Module','content'=>'A new record succesfully added','type'=>'successmsgbox'));
                    redirect(base_url()."module");
                } else {
                    $this->session->set_flashdata('message', array('title'=>'Add Module','content'=>'Unable to add record.please try again','type'=>'errormsgbox'));
                    redirect(base_url()."module/add");
                }
            }
            else {
                $data['validation_error']=  trim(validation_errors('<p>', '</p>'));
                $this->session->set_flashdata('message', array('title'=>'Add Module','content'=>$data['validation_error'],'type'=>'errormsgbox'));
                redirect(base_url()."module/add");
             }
        }
        $data['return_link'] = base_url()."module/";
        $this->template->write_view('content','add_module',$data);
        $this->template->render();
        
    }


#########################################################
#                   FOR EDIT COURSE                     #
#########################################################

    public function edit()
    {
	
            $this->getTemplate();
            $data=array();
            $data['base_url']           = $this->config->item('base_url');
            $module_id                	= $this->uri->segment(3, 0);
            $data['module_id']        	= $module_id;
            $data['page']               = $this->uri->segment(4, 0);
            $conditionArr               = array('module_id' => $module_id);
            $question_exist             = $this->model_module->moduleExistsDB($conditionArr);
            
	    if($module_id == 0 || !is_numeric($module_id) || !$module_id)
	    {
                    redirect('module/all');
            }
            
            $module_data              	= $this->model_module->detailsModuleDB(array('MM.module_id' => $module_id));
	    //pr($module_data);
            $data['course_id']          = $module_data[0]['course_id'];
            $data['step_id']            = $module_data[0]['step_id'];
            $data['topic_id']           = $module_data[0]['topic_id'];
            $data['module_name']        = $module_data[0]['module_name'];
            $data['module_status']      = $module_data[0]['module_status'];
            $data['validation_error']   = '';
             
            
            /***************** For Course Dropdown *******************/
            $data['courseOption']       = $this->course->allCourseOptions();
            /********************************************************/
            
             /***************** For Step Dropdown *******************/
            $stepDropdown= $this->model_basic->populateDropdown("id", "name", "dipp_step_master", "status='Active' AND course_id=".$data['course_id'], "id", "ASC");
            $stepOptions= array();
            for ($i=0; $i < count($stepDropdown); $i++){
            $stepOptions[$stepDropdown[$i]['id']]=  $stepDropdown[$i]['name'];
            }
            $data['stepOption']         = $stepOptions;
            /********************************************************/
            
           
            /***************** For Topic Dropdown *******************/
            $data['topicOption']       = $this->topic->allTopicOptions($data['step_id']);
            /********************************************************/
            
            if($this->input->get_post('action') == "Process") {
                
                $this->form_validation->set_rules('module_name','Module Name','required');
                $data['topic_id']	= trim($this->input->get_post('topic_id'));
                $data['module_name']	= addslashes(trim($this->input->get_post('module_name')));
		$data['module_status']	= $this->input->get_post('module_status');
                
                if ($this->form_validation->run() == TRUE )
                {
		    $updateArr      = array(
                                    'topic_id'			=> $data['topic_id'],
                                    'module_name'		=> $data['module_name'],
                                    'module_status'        	=> $data['module_status'],
                                    'module_updated_on'   	=> date('Y-m-d H:i:s'),
                                    );

                    $update        = $this->model_module->editModuleDB($updateArr,$conditionArr);
                    
		    if($update) {
                        $this->session->set_flashdata('message', array('title'=>'Update Module','content'=>'Record have been successfully edited.','type'=>'successmsgbox'));
                        redirect(base_url()."module/all/".$data['page']."/");
                      } else {
                        $this->session->set_flashdata('message', array('title'=>'Update Module','content'=>'Unable to edit record. Please try again.','type'=>'errormsgbox'));
                        redirect('module/edit/'.$module_id);
                    }
                
                } 
             else {
                $data['validation_error']=  trim(validation_errors('<p>', '</p>'));
                $this->session->set_flashdata('message', array('title'=>'Edit Module','content' => $data['validation_error'],'type'=>'errormsgbox'));
                redirect('module/edit/'.$module_id);
             }
                
            }
	    
	    $data['return_link'] = base_url()."module/";
            $this->template->write_view('content','edit_module',$data); //pr($data);
	    $this->template->render();
            
        }



#########################################################
#                FOR  MODULE STATUS CHANGE              #
#########################################################

        function changeStatus($id)
	{
	    $conditionArr       = array('module_id'=>$id);
            $module_id        	= $this->uri->segment(3, 0);
            $data['module_id']	= $module_id;
            $data['page']       = $this->uri->segment(4, 0);
            $checkExist         = $this->model_module->moduleExistsDB($conditionArr);
	    
            if($checkExist) {
                $this->model_module->statusChangeModuleDB($id);
                $this->session->set_flashdata('message', array('title'=>'Module Status','content'=>'Module status has been changed','type'=>'successmsgbox'));
                redirect(base_url()."module/all/".$data['page']);
            }

        }
	
#########################################################
#                FOR  MODULE DELETE              	#
#########################################################

        function delete($id)
	{
	    $module_id        	= $this->uri->segment(3, 0);
	    $conditionArr       = array('module_id' => $module_id);
            $data['module_id']	= $module_id;
            $data['page']       = $this->uri->segment(4, 0);
            $checkExist         = $this->model_module->moduleExistsDB($conditionArr);
	    
            if($checkExist)
	    {
                $this->model_basic->deleteRecord('dipp_module_master', $conditionArr);
                $this->session->set_flashdata('message', array('title'=>'Module Delete','content'=>'Record has been successfully deleted','type'=>'successmsgbox'));
                redirect(base_url()."module/all/".$data['page']);
            }

        }
        

#########################################################
#                FOR  COURSE STATUS CHANGE              #
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

    public function allModuleOptions($topic_id='') {
        if($topic_id <> '') {
           $condition="module_status='Active' AND topic_id=".$topic_id;
        } else {
            $condition="module_status='Active'";
        }
        $moduleDropdown= $this->model_basic->populateDropdown("module_id", "module_name", " dipp_module_master", "$condition", "module_id", "ASC");
	$moduleOptions= array();
        $moduleOptions['']= "--Select Topic--";
        for ($i=0; $i < count($moduleDropdown); $i++){
           $moduleOptions[$moduleDropdown[$i]['module_id']]=  $moduleDropdown[$i]['module_name'];
        }
	//pr($courseOptions);
        return $moduleOptions;
    }   




}


