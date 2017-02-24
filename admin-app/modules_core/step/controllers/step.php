<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Step extends MY_Controller {



    public function __construct(){
        parent::__construct();
        $this->load->model(array('step/model_step', 'course/model_course'));
	$this->load->library('form_validation');
        $this->url = base_url().'step/';
        $this->checkLogin();
    }

#########################################################
#                FOR  STEP LISTING                  #
#########################################################

    public function index() {
        $this->all();
	}

#########################################################
#                FOR  STEP LISTING                  #
#########################################################

    public function all()
    {
	$this->getTemplate();
        $total_course      = $this->model_step->countStepDB();
	
	$data['totalRecord'] 	= $total_course;
	$data['per_page'] 	= PER_PAGE_LISTING;
	$start 			= 0;
        $data['startRecord'] 	= $start;
	$data['page']	 	= $this->uri->segment(3);
	$data['search_keyword']	= '';
	//if($total_course > 0) {
            /********** FOR PAGINATION ***********/
            $config['base_url'] = base_url().'/step/index';
            $config['per_page'] = PER_PAGE_LISTING;
            $config['total_rows'] = $total_course;
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
            $resultArr=$this->model_step->allStepDB($search_by,PER_PAGE_LISTING,$offset);
            
	    //pr($resultArr);
	    
            if(count($resultArr) > 0) {
                $num = 1+$offset;
				foreach($resultArr as $values) {
                    $id          = $values['id'];
                    $status      = $values['status'];
                    $status_class=($status == 'Active')?'label-green':'label-red';    
                    
                    /********** GET GENERATE EDIT AND DELETE LINK ***********/
                    $this->uri_segment = $this->uri->total_segments();
                    $cur_page           = 0;
                    if ($this->uri->segment($this->uri_segment) != 0) {
                        $this->cur_page = $this->uri->segment($this->uri_segment);
                        $cur_page = (int) $this->cur_page;
                    }

                    $edit_link          = base_url()."step/edit/".$id."/".$cur_page."/";
                    $topic_link         = base_url()."topic/all/".$id;
                    $status_link        = base_url()."step/changeStatus/".$id."/".$cur_page;

                    if($num%2 == 0) {
                        $bgcolor='#CCCCCC';
                    } else {
                        $bgcolor='#eeeeee';
                    }
                    
                    $total_result[]     = array_merge($values,
                                                        array(
                                                            'slno'              => $num,
                                                            'bgcolor'           => $bgcolor,
                                                            'status_class'      => $status_class,
                                                            'topic_link'        => $topic_link,
                                                            'edit_link'         => $edit_link,
                                                            'status_link'       => $status_link
                                                            )
                                            );
                    $num++;

                }

                $data['step_all']	= $total_result; //pr($data['course_all']);
		$data['add_url']	= base_url()."step/add/";
                /********** FOR PAGINATION ***********/
                $config['cur_tag_open']     = '<span class="current-link">';
                $config['cur_tag_close']    = '</span>';
                $this->pagination->initialize($config);
                $data['paging']             = $this->pagination->create_links();
                $this->template->write_view('content','step_list',$data);
                $this->template->render();
                
            }
        //} else {
        //    $this->template->write_view('content', 'norecord_course_list.php');
        //    $this->template->render();
        // }
    }



#########################################################
#                   FOR STEP SEARCH                     #
#########################################################

    public function search(){

        $this->getTemplate();
        /********** FOR STEP SEARCH ***********/
        $search_by ='';
        if($this->input->get_post('action') == "Process"){
            $this->session->set_userdata('search_str',trim($this->input->get_post('search_str')));
        }
        if($this->session->userdata('search_str')){
            $search_by = $this->session->userdata('search_str');
        }


        $total_step = $this->model_step->countStepDB($search_by);
	
	$data['totalRecord'] 	= $total_step;
	$data['per_page'] 	= PER_PAGE_LISTING;
	$start 			= 0;
        $data['startRecord'] 	= $start;
	$data['page']	 	= $this->uri->segment(3);
	
        //if($total_step > 0)
        //{
            /********** FOR PAGINATION ***********/
            $config['base_url'] = base_url().'/step/all';
            $config['per_page'] =PER_PAGE_LISTING;
            $config['total_rows'] = $total_step;
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


            $resultArr = $this->model_step->allStepDB($search_by,$config['per_page'],$offset);
	    
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
		    
                    $edit_link          = base_url()."step/edit/".$id."/".$cur_page."/";
                    $topic_link         = base_url()."topic/all/".$id;
                    $status_link        = base_url()."step/changeStatus/".$id."/".$cur_page;
                    

                    if($num%2==0)
                    {
                        $bgcolor='#CCCCCC';
                    }
                    else
                    {
                        $bgcolor='#eeeeee';
                    }

                    $total_result[]     = array_merge($values,
                                                        array('slno'        => $num,
                                                        'bgcolor'           => $bgcolor,
                                                        'status_class'      => $status_class,
                                                        'topic_link'        => $topic_link,    
                                                        'edit_link'         => $edit_link,
                                                        'status_link'       => $status_link)
                                                      );
                    $num++;
                }
		
	    }

                $data['step_all']	= $total_result;
		$data['search_keyword']	= $search_by;
		$data['add_url']	= base_url()."step/add/";
		
                /********** FOR PAGINATION ***********/
                $config['cur_tag_open'] = '<span class="current-link">';
                $config['cur_tag_close'] = '</span>';
                $this->pagination->initialize($config);
                $this->session->unset_userdata('search_str');
                $data['paging'] = $this->pagination->create_links();
                $this->template->write_view('content','step_list',$data);
                $this->template->render();
            
	    
        //}
        //else
        //{
        //    $this->template->write_view('content', 'norecord_course_list.php');
        //    $this->template->render();
        //}
    }

#########################################################
#                   FOR ADD STEP                    #
#                                                       #
#                                                       #
#                                                       #
#########################################################
    public function add()
    {
	$this->getTemplate();
        $data                                   = array();
        $data['base_url']                       = $this->config->item('base_url');
        $data['frmAction']                      = base_url()."step/add";
        $data['cat_name']                       = '';
        $data['validation_error']               = '';
        
        if($this->input->get_post('action') == "Process") {
            $this->form_validation->set_rules('name','Step Name','required');
            $data['name']  = addslashes(trim($this->input->get_post('name')));
            if ($this->form_validation->run() == TRUE )
            {
                $insertArr      = array(
                                    'course_id' => $this->input->get_post('course_id'),
				    'name'      => $data['name'],
                                    'added_on'  => date('Y-m-d H:i:s'),
                                    'status'    => 'Active'
                                    );
                //pr($insertArr);
                $lastId=$this->model_step->addCategoryDB($insertArr);
                if($lastId <> '') {
                    $this->session->set_flashdata('message', array('title'=>'Add Category','content'=>'A new category succesfully added','type'=>'successmsgbox'));
                    redirect(base_url()."category");
                } else {
                    $this->session->set_flashdata('message', array('title'=>'Add Category','content'=>'Unable to add category.please try again','type'=>'errormsgbox'));
                    redirect(base_url()."category/add");
                }
            }
            else {
                $data['validation_error']=validation_errors();
                $this->session->set_flashdata('message', array('title'=>'Add Category','content'=>$data['validation_error'],'type'=>'errormsgbox'));
                redirect(base_url()."category/add");
             }
        }
        $this->template->write_view('content','add_category',$data);
        $this->template->render();
        
    }


#########################################################
#                   FOR EDIT STEP                   #
#########################################################

    public function edit()
    {
	
            $this->getTemplate();
            $data=array();
            $data['base_url']           = $this->config->item('base_url');
            $id                     	= $this->uri->segment(3, 0);
            $data['id']             	= $id;
            $data['page']               = $this->uri->segment(4, 0);
            $conditionArr               = array('SM.id'=>$data['id']);
            $course_exist             	= $this->model_step->stepExistsDB($conditionArr);
            
	    if($id == 0 || !is_numeric($id) || !$course_exist)
	    {
                    redirect('step/index');
            }

	    $data['course_list']	= $this->model_course->allCourseDB(); //pr($data['course_list']);
	    
            $step_data              	= $this->model_step->detailsStepDB($conditionArr); //pr($step_data);
            $data['name']           	= stripslashes($step_data[0]['name']);
	    $data['status']           	= stripslashes($step_data[0]['status']);
	    $data['short_description']  = stripslashes($step_data[0]['short_description']);
	    $data['course_id']  	= stripslashes($step_data[0]['course_id']);
	    
            $data['validation_error']   = '';
            
            $data['video_all']=$this->model_step->getStepVideosDB($conditionArr);
            
            if($this->input->get_post('action') == "Process") {
                
                $this->form_validation->set_rules('name','Name','required');
                $data['name']   = addslashes(trim($this->input->get_post('name')));
                if ($this->form_validation->run() == TRUE )
                {
                    $updateArr          = array(
						'course_id'	=> $this->input->get_post('course_id'),
						'name'         	=> $data['name'],
						'status'	=> $this->input->get_post('status'),
						'updated_on'   	=> date('Y-m-d H:i:s'),
					      );

                    $update             = $this->model_step->editStepDB($updateArr, array('id'=>$data['id']));
                    if($update) {
                        
                        $video_title = $this->input->get_post('video_title');
                        $video_link = $this->input->get_post('video_link');
                        $video_value_all=array();
                        foreach($video_title as $key =>$val)
                        {   
                            $video_value_all[]=array('step_id'=>$data['id'],'video_title'=>$val,'video_link'=>$video_link[$key],'video_updated_on'=>date('Y-m-d H:i:s')); 
                        }  
                        $this->model_step->addStepVideosDB($video_value_all,array('step_id'=>$data['id']));
                        
                        $this->session->set_flashdata('message', array('title'=>'Update Step','content'=>'Data have been successfully edited.','type'=>'successmsgbox'));
                        redirect(base_url()."step/all/".$data['page']."/");
                      } else {
                        $this->session->set_flashdata('message', array('title'=>'Update Step','content'=>'Unable to edit data. Please try again.','type'=>'errormsgbox'));
                        redirect('step/edit/'.$id);
                    }
                
                } 
             else {
                
                $data['validation_error']=  trim(validation_errors('<p>', '</p>'));
                $this->session->set_flashdata('message', array('title'=>'Edit Step','content'=>$data['validation_error'],'type'=>'errormsgbox'));
                redirect('step/edit/'.$id);
                
             }
                
            }
	    
	    $data['return_link'] = base_url()."step/";
            $this->template->write_view('content','edit_step',$data); //pr($data);
	    $this->template->render();
            
        }



#########################################################
#                FOR  STEP STATUS CHANGE            	#
#########################################################

        function changeStatus($id) {
            $conditionArr           = array('cat_id'=>$id);
            $cat_id                 = $this->uri->segment(3, 0);
            $data['cat_id']         = $cat_id;
            $data['page']           = $this->uri->segment(4, 0);
            $checkExist             = $this->model_step->categoryExistsDB($conditionArr);
            if($checkExist) {
                $this->model_step->statusChangeCategoryDB($id);
                $this->session->set_flashdata('message', array('title'=>'Category Status','content'=>'Category status has been changed','type'=>'successmsgbox'));
                redirect(base_url()."category/all/".$data['page']);
            }

        }
        
#########################################################
#                FOR  STEP STATUS CHANGE            	#
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
                $checkExist        = $this->model_step->categoryUniqueDB($conditionArr,$cat_id);
                if($checkExist) {
                    echo '<font color="red">The category <strong>'.$cat_name.'</strong>'.' is already in use.</font>';
                } else {
                    echo 'OK';
                }
            } 

        }

}


