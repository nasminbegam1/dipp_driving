<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hazard extends MY_Controller {



    public function __construct(){
        parent::__construct();
        $this->load->model(array('hazard/model_hazard', 'course/model_course'));
	$this->load->library('form_validation');
	$this->load->library('fckeditor');
	$this->load->module('course');
        $this->url = base_url().'hazard/';
        $this->checkLogin();
    }

#########################################################
#                FOR  HAZARD LISTING                  #
#########################################################

    public function index() {
        $this->all();
	}

#########################################################
#                FOR  HAZARD LISTING                  #
#########################################################

    public function all()
    {
	$this->getTemplate();
        $total_record      = $this->model_hazard->countHazardDB();
	
	$data['totalRecord'] 	= $total_record;
	$data['per_page'] 	= PER_PAGE_LISTING;
	$start 			= 0;
        $data['startRecord'] 	= $start;
	$data['page']	 	= $this->uri->segment(3);
	$data['search_keyword']	= '';
	
	//if($total_course > 0) {
            /********** FOR PAGINATION ***********/
            $config['base_url'] = base_url().'/hazard/index';
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
	    
            $resultArr = $this->model_hazard->allHazardDB($search_by,PER_PAGE_LISTING,$offset);
            
	    //pr($resultArr);
	    
            if(count($resultArr) > 0) {
                $num = 1+$offset;
		foreach($resultArr as $values) {
                    $hazard_id          = $values['hazard_id'];
                    $hazard_status      = $values['hazard_status'];
                    $status_class=($hazard_status == 'Active')?'label-green':'label-red';    
                    
                    /********** GET GENERATE EDIT AND DELETE LINK ***********/
                    $this->uri_segment = $this->uri->total_segments();
                    $cur_page           = 0;
                    if ($this->uri->segment($this->uri_segment) != 0) {
                        $this->cur_page = $this->uri->segment($this->uri_segment);
                        $cur_page = (int) $this->cur_page;
                    }

                    $edit_link          = base_url()."hazard/edit/".$hazard_id."/".$cur_page."/";
		    $delete_link        = base_url()."hazard/delete/".$hazard_id."/".$cur_page."/";
                    $status_link        = base_url()."hazard/changeStatus/".$hazard_id."/".$cur_page;

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
							    'delete_link'       => $delete_link,
                                                            'status_link'       => $status_link
                                                            )
                                            );
                    $num++;

                }

                $data['hazard_all']	= $total_result; //pr($data['course_all']);
		$data['add_url']	= base_url()."hazard/add/";
                /********** FOR PAGINATION ***********/
                $config['cur_tag_open']     = '<span class="current-link">';
                $config['cur_tag_close']    = '</span>';
                $this->pagination->initialize($config);
                $data['paging']             = $this->pagination->create_links();
                $this->template->write_view('content','hazard_list',$data);
                $this->template->render();
                
            }
        //} else {
        //    $this->template->write_view('content', 'norecord_course_list.php');
        //    $this->template->render();
        // }
    }



#########################################################
#                   FOR HAZARD SEARCH                     #
#########################################################

    public function search(){

        $this->getTemplate();
        /********** FOR HAZARD SEARCH ***********/
        $search_by ='';
        if($this->input->get_post('action') == "Process"){
            $this->session->set_userdata('search_str',trim($this->input->get_post('search_str')));
        }
        if($this->session->userdata('search_str')){
            $search_by = $this->session->userdata('search_str');
        }


        $total_record = $this->model_hazard->countHazardDB($search_by);
	
	$data['totalRecord'] 	= $total_record;
	$data['per_page'] 	= PER_PAGE_LISTING;
	$start 			= 0;
        $data['startRecord'] 	= $start;
	$data['page']	 	= $this->uri->segment(3);
	
        //if($total_step > 0)
        //{
            /********** FOR PAGINATION ***********/
            $config['base_url']		= base_url().'/hazard/all';
            $config['per_page']		= PER_PAGE_LISTING;
            $config['total_rows'] 	= $total_record;
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


            $resultArr = $this->model_hazard->allHazardDB($search_by,$config['per_page'],$offset);
	    
	    if(count($resultArr) > 0)
	    {
		$num    = 1+$offset;
		foreach($resultArr as $values)
		{
		    $hazard_id          = $values['hazard_id'];
                    $hazard_status      = $values['hazard_status'];
                    $status_class=($status == 'Active')?'label-green':'label-red';  
                    
                    /********** GET GENERATE EDIT AND DELETE LINK ***********/
                    $this->uri_segment = $this->uri->total_segments();
                    $cur_page = 0;
                    if ($this->uri->segment($this->uri_segment) != 0) {
                        $this->cur_page = $this->uri->segment($this->uri_segment);
                        $cur_page = (int) $this->cur_page;
                    }
		    
                    $edit_link          = base_url()."hazard/edit/".$id."/".$cur_page."/";
                    $delete_link        = base_url()."hazard/all/".$id;
                    $status_link        = base_url()."hazard/changeStatus/".$id."/".$cur_page;
                    

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
							'hazard_link'       => $hazard_link,
                                                        'status_link'       => $status_link)
                                                      );
                    $num++;
                }
		
	    }

                $data['hazard_all']	= $total_result;
		$data['search_keyword']	= $search_by;
		$data['add_url']	= base_url()."hazard/add/";
		
                /********** FOR PAGINATION ***********/
                $config['cur_tag_open'] = '<span class="current-link">';
                $config['cur_tag_close'] = '</span>';
                $this->pagination->initialize($config);
                $this->session->unset_userdata('search_str');
                $data['paging'] = $this->pagination->create_links();
                $this->template->write_view('content','hazard_list',$data);
                $this->template->render();
            
	    
        //}
        //else
        //{
        //    $this->template->write_view('content', 'norecord_course_list.php');
        //    $this->template->render();
        //}
    }

#########################################################
#                   FOR ADD HAZARD                      #
#########################################################
    public function add()
    {
	$this->getTemplate();
        $data                                   = array();
        $data['base_url']                       = $this->config->item('base_url');
        $data['frmAction']                      = base_url()."hazard/add";
        $data['cat_name']                       = '';
        $data['validation_error']               = '';
	$data['return_link']			= base_url()."hazard";
	
	$path = '../js/ckfinder';
	$width = '850px';
	$this->editor($path, $width);
	
	$this->fckeditor->InstanceName = 'content';
	
	/*************************** For Course Dropdown *******************/
         $data['courseOption']       = $this->course->allCourseOptions();
        /*******************************************************************/
        
        if($this->input->get_post('action') == "Process") { 
            $this->form_validation->set_rules('hazard_title','Hazard Title','required');
	    $this->form_validation->set_rules('hazard_content','Hazard Content','required');
            
	    $data['hazard_title']   	= addslashes(trim($this->input->get_post('hazard_title')));
	    $data['hazard_content']	= addslashes(trim($this->input->get_post('hazard_content')));
		
            if ($this->form_validation->run() == TRUE )
            {
                $insertArr      = array(
                                    'course_id' 	=> $this->input->get_post('course_id'),
				    'hazard_title'      => $data['hazard_title'],
				    'hazard_content'    => $data['hazard_content'],
				    'hazard_status'    	=> $this->input->get_post('hazard_status'),
                                    'hazard_added_on'  	=> date('Y-m-d H:i:s'),
                                    
                                    );
                //pr($insertArr);
                $lastId=$this->model_hazard->addHazardDB($insertArr);
                if($lastId <> '') {
                    $this->session->set_flashdata('message', array('title'=>'Add Hazard','content'=>'A new record succesfully added','type'=>'successmsgbox'));
                    redirect(base_url()."hazard");
                } else {
                    $this->session->set_flashdata('message', array('title'=>'Add Hazard','content'=>'Unable to add record.please try again','type'=>'errormsgbox'));
                    redirect(base_url()."hazard/add");
                }
            }
            else {
                $data['validation_error']=validation_errors();
                $this->session->set_flashdata('message', array('title'=>'Add Hazard','content'=>$data['validation_error'],'type'=>'errormsgbox'));
                redirect(base_url()."hazard/add");
             }
        }
        $this->template->write_view('content','add_hazard',$data);
        $this->template->render();
        
    }

#########################################################
#                FOR  MODULE DELETE              	#
#########################################################

        function delete($id)
	{
	    $hazard_id        	= $this->uri->segment(3, 0);
	    $conditionArr       = array('hazard_id' => $hazard_id);
            $data['hazard_id']	= $hazard_id;
            $data['page']       = $this->uri->segment(4, 0);
            $checkExist         = $this->model_hazard->hazardExistsDB($conditionArr);
	    
            if($checkExist)
	    {
                $this->model_basic->deleteRecord('dt_hazard', $conditionArr);
                $this->session->set_flashdata('message', array('title'=>'Module Hazard','content'=>'Record has been successfully deleted','type'=>'successmsgbox'));
                redirect(base_url()."hazard/all/".$data['page']);
            }

        }
	
#########################################################
#                   FOR EDIT HAZARD                   #
#########################################################

    public function edit()
    {
	
            $this->getTemplate();
            $data=array();
            $data['base_url']           = $this->config->item('base_url');
            $hazard_id                  = $this->uri->segment(3, 0);
            $data['hazard_id']          = $hazard_id;
            $data['page']               = $this->uri->segment(4, 0);
            $conditionArr               = array('H.hazard_id' => $data['hazard_id']);
            $hazard_exist             	= $this->model_hazard->hazardExistsDB($conditionArr);
	    
	    $path = '../js/ckfinder';
	    $width = '850px';
	    $this->editor($path, $width);
	    
	    $this->fckeditor->InstanceName = 'content';
            
	    if($hazard_id == 0 || !is_numeric($hazard_id) || !$hazard_exist)
	    {
                    redirect('hazard/index');
            }

	    $data['course_list']	= $this->model_course->allCourseDB(); //pr($data['course_list']);
	    
            $hazard_data              	= $this->model_hazard->detailsHazardDB($conditionArr); //pr($hazard_data);
            $data['course_id']  	= $hazard_data[0]['course_id'];
	    $data['hazard_title']       = stripslashes($hazard_data[0]['hazard_title']);
	    $data['hazard_content']     = stripslashes($hazard_data[0]['hazard_content']);
	    $data['hazard_status']	= stripslashes($hazard_data[0]['hazard_status']);
	    
	    
            $data['validation_error']   = '';
            
            if($this->input->get_post('action') == "Process") {
                
                $this->form_validation->set_rules('hazard_title','Hazard Name','required');
		$this->form_validation->set_rules('hazard_content','Hazard Course','required');
                $data['hazard_title']   = addslashes(trim($this->input->get_post('hazard_title')));
		$data['hazard_content']	= addslashes(trim($this->input->get_post('hazard_content')));
		
                if ($this->form_validation->run() == TRUE )
                {
                    $updateArr          = array(
						'course_id'		=> $this->input->get_post('course_id'),
						'hazard_title'         	=> $data['hazard_title'],
						'hazard_content'        => $data['hazard_content'],
						'hazard_status'		=> $this->input->get_post('hazard_status'),
						'hazard_updated_on'   	=> date('Y-m-d H:i:s'),
					      );
		    
		    //pr($updateArr);

                   $update             = $this->model_hazard->editHazardDB($updateArr, array('H.hazard_id' => $data['hazard_id']));
                    if($update) {
                        //die('aa');
                        $this->session->set_flashdata('message', array('title'=>'Update Hazard','content'=>'Record have been successfully edited.','type'=>'successmsgbox'));
                        redirect(base_url()."hazard/all/".$data['page']."/");
                      } else {
                        $this->session->set_flashdata('message', array('title'=>'Update Hazard','content'=>'Unable to edit data. Please try again.','type'=>'errormsgbox'));
                        redirect('hazard/edit/'.$id);
                    }
                
                } 
             else {
                
                $data['validation_error']=  trim(validation_errors('<p>', '</p>'));
                $this->session->set_flashdata('message', array('title'=>'Edit Hazard','content'=>$data['validation_error'],'type'=>'errormsgbox'));
                redirect('hazard/edit/'.$id);
                
             }
                
            }
	    
	    $data['return_link'] = base_url()."hazard/";
            $this->template->write_view('content','edit_hazard',$data); //pr($data);
	    $this->template->render();
            
        }



#########################################################
#                FOR  HAZARD STATUS CHANGE            	#
#########################################################

        function changeStatus($id) {
            
            $hazard_id              = $this->uri->segment(3, 0);
            $data['hazard_id']      = $hazard_id;
            $data['page']           = $this->uri->segment(4, 0);
	    $conditionArr	    = array('H.hazard_id' => $data['hazard_id']);
            $checkExist             = $this->model_hazard->hazardExistsDB($conditionArr);
            if($checkExist) { 
                $this->model_hazard->statusChangeHazardDB($hazard_id);
                $this->session->set_flashdata('message', array('title'=>'Hazard Status','content'=>'Status has been changed','type'=>'successmsgbox'));
                redirect(base_url()."hazard/all/".$data['page']);
            }

        }
        
#########################################################
#                FOR  HAZARD STATUS CHANGE            	#
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
                $checkExist        = $this->model_hazard->categoryUniqueDB($conditionArr,$cat_id);
                if($checkExist) {
                    echo '<font color="red">The category <strong>'.$cat_name.'</strong>'.' is already in use.</font>';
                } else {
                    echo 'OK';
                }
            } 

        }

}


