<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Course extends MY_Controller {



    public function __construct(){
        parent::__construct();
        $this->load->model(array('welcome/model_basic', 'course/model_course'));
	$this->load->library('form_validation');
        $this->url = base_url().'course/';
        $this->checkLogin();
    }

#########################################################
#                FOR  COURSE LISTING                  #
#########################################################

    public function index() {
        $this->all();
	}

#########################################################
#                FOR  COURSE LISTING                  #
#########################################################

    public function all()
    {
	$this->getTemplate();
        $total_course      = $this->model_course->countCourseDB();
	
	$data['totalRecord'] 	= $total_course;
	$data['per_page'] 	= PER_PAGE_LISTING;
	$start 			= 0;
        $data['startRecord'] 	= $start;
	$data['page']	 	= $this->uri->segment(3);
	
	//if($total_course > 0) {
            /********** FOR PAGINATION ***********/
            $config['base_url'] = base_url().'/course/index';
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
            $resultArr=$this->model_course->allCourseDB($search_by,PER_PAGE_LISTING,$offset);
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

                    $edit_link          = base_url()."course/edit/".$id."/".$cur_page."/";
                    $status_link        = base_url()."course/changeStatus/".$id."/".$cur_page;

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
                                                            'edit_link'         => $edit_link,
                                                            'status_link'       => $status_link
                                                            )
                                            );
                    $num++;

                }

                $data['course_all']        = $total_result; //pr($data['course_all']);
		$data['search_keyword']    = '';
                /********** FOR PAGINATION ***********/
                $config['cur_tag_open']     = '<span class="current-link">';
                $config['cur_tag_close']    = '</span>';
                $this->pagination->initialize($config);
                $data['paging']             = $this->pagination->create_links();
                $this->template->write_view('content','course_list',$data);
                $this->template->render();
                
            }
        //} 
    }



#########################################################
#                   FOR COURSE SEARCH                 #
#                                                       #
#                                                       #
#                                                       #
#########################################################

    public function search()
    {
	
	$this->getTemplate();
        /********** FOR COURSE SEARCH ***********/
        $search_by ='';
        if($this->input->get_post('action') == "Process"){
            $this->session->set_userdata('search_str',trim($this->input->get_post('search_str')));
        }
        if($this->session->userdata('search_str')){
            $search_by = $this->session->userdata('search_str');
        }


        $total_course=$this->model_course->countCourseDB($search_by);
	
	$data['totalRecord'] 	= $total_course;
	$data['per_page'] 	= PER_PAGE_LISTING;
	$start 			= 0;
        $data['startRecord'] 	= $start;
	$data['page']	 	= $this->uri->segment(3);
	
        //if($total_course > 0)
        //{
            /********** FOR PAGINATION ***********/
            $config['base_url'] = base_url().'/course/all';
            $config['per_page'] =PER_PAGE_LISTING;
            $config['total_rows'] = $total_course;
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


            $resultArr = $this->model_course->allCourseDB($search_by,$config['per_page'],$offset);
	    
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
		    
                    $edit_link          = base_url()."course/edit/".$id."/".$cur_page."/";
                    $status_link        = base_url()."course/changeStatus/".$id."/".$cur_page;
                    

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
                                                        'edit_link'         => $edit_link,
                                                        'status_link'       => $status_link)
                                                      );
                    $num++;
                }
		
	    }

                $data['course_all'] 	= $total_result;
		$data['search_keyword'] = $search_by;
                /********** FOR PAGINATION ***********/
                $config['cur_tag_open'] = '<span class="current-link">';
                $config['cur_tag_close'] = '</span>';
                $this->pagination->initialize($config);
                $this->session->unset_userdata('search_str');
                $data['paging'] = $this->pagination->create_links();
                $this->template->write_view('content','course_list',$data);
                $this->template->render();
        //    }
        //}
        //else
        //{
        //    $this->template->write_view('content', 'norecord_course_list.php');
        //    $this->template->render();
        //}
    }

#########################################################
#                   FOR ADD COURSE                    #
#                                                       #
#                                                       #
#                                                       #
#########################################################
    public function add() {
        $this->getTemplate();
        $data                                   = array();
        $data['base_url']                       = $this->config->item('base_url');
        $data['frmAction']                      = base_url()."category/add";
        $data['cat_name']                       = '';
        $data['validation_error']               = '';
        
        if($this->input->get_post('action') == "Process") {
            $this->form_validation->set_rules('cat_name','Name','required');
            $data['cat_name']  = addslashes(trim($this->input->get_post('cat_name')));
            if ($this->form_validation->run() == TRUE )
            {
                $insertArr      = array(
                                    'cat_name'      => $data['cat_name'],
                                    'cat_added_on'  => date('Y-m-d H:i:s'),
                                    'cat_status'    => 'Active'
                                    );
                //pr($insertArr);
                $lastId=$this->model_course->addCategoryDB($insertArr);
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
#                   FOR EDIT COURSE                   #
#########################################################

    public function edit()
    {
	
            $this->getTemplate();
            $data=array();
            $data['base_url']           = $this->config->item('base_url');
            $id                     	= $this->uri->segment(3, 0);
            $data['id']             	= $id;
            $data['page']               = $this->uri->segment(4, 0);
            $conditionArr               = array('id'=>$data['id']);
            $course_exist             	= $this->model_course->courseExistsDB($conditionArr);
            
	    if($id == 0 || !is_numeric($id) || !$course_exist)
	    {
                    redirect('course/index');
            }

            $course_data              	= $this->model_course->detailsCourseDB($conditionArr);
            $data['name']           	= stripslashes($course_data[0]['name']);
	    $data['status']           	= stripslashes($course_data[0]['status']);
	    $data['price']           	= $course_data[0]['price'];
	    $data['discount']           = $course_data[0]['discount'];
            $data['validation_error']   = '';
           
            if($this->input->get_post('action') == "Process") {
                $this->form_validation->set_rules('name','Name','required');
		$this->form_validation->set_rules('price','Price','required|greater_than[0]');
		
                $data['name']   	= addslashes(trim($this->input->get_post('name')));
		$data['price']   	= trim($this->input->get_post('price'));
		$data['discount']   	= trim($this->input->get_post('discount'));
                if ($this->form_validation->run() != FALSE )
                {
                    $updateArr          = array(
						'name'         	=> $data['name'],
						'price'         => $data['price'],
						'discount'      => $data['discount'],
						'status'	=> $this->input->get_post('status'),
						'updated_on'   	=> date('Y-m-d H:i:s'),
					      );

                    $update             = $this->model_course->editCourseDB($updateArr,$conditionArr);
                    if($update) {
                        $this->session->set_flashdata('message', array('title'=>'Update Course','content'=>'Data have been successfully edited.','type'=>'successmsgbox'));
                        redirect(base_url()."course/all/".$data['page']."/");
                      } else {
                        $this->session->set_flashdata('message', array('title'=>'Update Course','content'=>'Unable to edit data. Please try again.','type'=>'errormsgbox'));
                        redirect('course/edit/'.$cat_id);
                    }
                
                } 
             else {
                $data['validation_error']=  preg_replace('/\s+/', ' ',validation_errors('<p>','</p>'));
                $this->session->set_flashdata('message', array('title'=>'Edit Course','content'=>$data['validation_error'],'type'=>'errormsgbox'));
                redirect('course/edit/'.$id);
             }
                
            }
	    
	    $data['return_link'] = base_url()."course/";
            $this->template->write_view('content','edit_course',$data); //pr($data);
	    $this->template->render();
            
        }


#########################################################
#                FOR  COURSE OPTIONS                    #
#                                                       #
#                                                       #
#                                                       #
#########################################################

    public function allCourseOptions() {
        $courseDropdown= $this->model_basic->populateDropdown("id", "name", " dipp_course_master", "status<>''", "id", "ASC");
	$courseOptions= array();
        $courseOptions['']= "--Select Course--";
        for ($i=0; $i < count($courseDropdown); $i++){
           $courseOptions[$courseDropdown[$i]['id']]=  $courseDropdown[$i]['name'];
        }
	//pr($courseOptions);
        return $courseOptions;
    }        

#########################################################
#                FOR  COURSE STATUS CHANGE            #
#                                                       #
#                                                       #
#                                                       #
#########################################################

        function changeStatus($id) {
            $conditionArr           = array('cat_id'=>$id);
            $cat_id                 = $this->uri->segment(3, 0);
            $data['cat_id']         = $cat_id;
            $data['page']           = $this->uri->segment(4, 0);
            $checkExist             = $this->model_course->categoryExistsDB($conditionArr);
            if($checkExist) {
                $this->model_course->statusChangeCategoryDB($id);
                $this->session->set_flashdata('message', array('title'=>'Category Status','content'=>'Category status has been changed','type'=>'successmsgbox'));
                redirect(base_url()."category/all/".$data['page']);
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
#                FOR  STEP OPTIONS            		#
#########################################################

    public function getStep() {
             $course_id=$this->input->get_post('course_id');
             $step_type=$this->input->get_post('step_type');
             if($step_type == 'learn')
             {
                 $step='L';
             } 
             if($step_type == 'practice')
             {
                 $step='P';
             } 
             //$conditionArr= array('course_id'=>$course_id,'step_type'=>$step);
             $conditionArr= array('course_id'=>$course_id);
             $step_data = $this->model_course->getStepDB($conditionArr);
             $option='<option value="">--- Select Step ---</option>';
             if(count($step_data) > 0)
             {
                    foreach($step_data as $val)
                    {
                            $option.="<option value=".$val['step_id'].">".$val['step_name']."</option>";
                    }

             }
             echo $option;
             exit;
             //pr($category_data);
    }

        
}


