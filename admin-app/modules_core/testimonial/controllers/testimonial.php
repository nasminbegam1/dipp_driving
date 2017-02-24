<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Testimonial extends MY_Controller {



    public function __construct(){
        parent::__construct();
        $this->load->model(array('welcome/model_basic','step/model_step','testimonial/model_testimonial'));
	$this->load->library('form_validation');
        $this->url = base_url().'testimonial/';
        $this->checkLogin();
    }

#########################################################
#                FOR  testimonial LISTING                     #
#########################################################

    public function index() {
        $this->all();
	}

#########################################################
#                FOR  testimonial LISTING                     #
#########################################################

    public function all()
    {
	
        
        $this->getTemplate();
        $total_topic      = $this->model_testimonial->countTopicDB();
	
	$data['totalRecord']      = $total_topic;
	$data['per_page']         = PER_PAGE_LISTING;
	$start                    = 0;
        $data['startRecord']      = $start;
	$data['page']             = $this->uri->segment(3);
	$data['search_keyword']   = "";
	
	if($total_topic > 0) {
            /********** FOR PAGINATION ***********/
            $config['base_url'] = base_url().'/testimonial/all';
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
            $resultArr=$this->model_testimonial->allTopicDB($search_by,PER_PAGE_LISTING,$offset);
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

                    $edit_link          = base_url()."testimonial/edit/".$id."/".$cur_page."/";
		    $delete_link          = base_url()."testimonial/delete/".$id."/".$cur_page."/";
                    $status_link        = base_url()."testimonial/changeStatus/".$id."/".$cur_page;

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
                $data['testimonial_all']        = $total_result;
                /********** FOR PAGINATION ***********/
                $config['cur_tag_open']     = '<span class="current-link">';
                $config['cur_tag_close']    = '</span>';
                $this->pagination->initialize($config);
                $data['paging']             = $this->pagination->create_links();
                $this->template->write_view('content','testimonial_list',$data);
                $this->template->render();
                
            }
        } else {
            $this->template->write_view('content', 'norecord_testimonial_list.php');
            $this->template->render();
         }
    }



#########################################################
#                   FOR banner SEARCH                    #
#                                                       #
#                                                       #
#                                                       #
#########################################################

    public function search(){

        $this->getTemplate();
        /********** FOR banner SEARCH ***********/
        $search_by ='';
        if($this->input->get_post('action') == "Process"){
            $this->session->set_userdata('search_str',trim($this->input->get_post('search_str')));
        }
        if($this->session->userdata('search_str')){
            $search_by = $this->session->userdata('search_str');
        }
        
        $data['search_keyword'] = $search_by;
        $total_topic		= $this->model_testimonial->countTopicDB($search_by);
        $data['totalRecord'] 	= $total_topic;
	$data['per_page'] 	= PER_PAGE_LISTING;
	$start 			= 0;
        $data['startRecord'] 	= $start;
	$data['page']	 	= $this->uri->segment(3);
        if($total_topic > 0)
        {
            /********** FOR PAGINATION ***********/
            $config['base_url'] = base_url().'/testimonial/search';
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


            $resultArr = $this->model_testimonial->allTopicDB($search_by,PER_PAGE_LISTING,$offset);
	    
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
		    
                    $edit_link          = base_url()."testimonial/edit/".$id."/".$cur_page."/";
                    $status_link        = base_url()."testimonial/changeStatus/".$id."/".$cur_page;
                    $delete_link          = base_url()."testimonial/delete/".$id."/".$cur_page."/";

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
                                                        'status_link'       => $status_link)
                                                      );
                    $num++;
                }

                $data['testimonial_all']=$total_result;
                //pr($data['banner_all']);
                /********** FOR PAGINATION ***********/
                $config['cur_tag_open'] = '<span class="current-link">';
                $config['cur_tag_close'] = '</span>';
                $this->pagination->initialize($config);
                $this->session->unset_userdata('search_str');
                $data['paging'] = $this->pagination->create_links();
                $this->template->write_view('content','testimonial_list',$data);
                $this->template->render();
            }
        }
        else
        {
            $this->template->write_view('content', 'norecord_banner_list.php');
            $this->template->render();
        }
    }

#########################################################
#                   FOR ADD testimonial                 #
#                                                       #
#                                                       #
#                                                       #
#########################################################
    public function add() {
        $this->getTemplate();
        $data                                   = array();
        $data['base_url']                       = $this->config->item('base_url');
        $data['frmAction']                      = base_url()."testimonial/add";
        $data['banner_title']                     = '';
        $data['validation_error']               = '';
        
      
        if($this->input->get_post('action') == "Process") {
            $this->form_validation->set_rules('name','Name','required');
	    $this->form_validation->set_rules('description','Description','required');
           
            $data['name']  	  	= addslashes(trim($this->input->get_post('name')));
	    $data['description']  	= addslashes(trim($this->input->get_post('description')));
            $data['status']  		= $this->input->get_post('status');
	    $data['company_name']	= addslashes(trim($this->input->get_post('company_name')));
            if ($this->form_validation->run() == TRUE )
            {
		$image	= $_FILES['image']['name'];
                if($image <> '') {
                    $mainUpload       = $this->imageUpload('image','testimonial','Y',150,100);
                    $image_name       = $mainUpload['image_name'];
                }
		
                $insertArr      = array(
                                    'name'           		=> $data['name'],
                                    'description'           	=> $data['description'],
				    'company_name'		=> $data['company_name'],
				    'image'			=> $image_name,
                                    'added_on'               	=> date('Y-m-d H:i:s'),
                                    );
                $lastId=$this->model_testimonial->addTopicDB($insertArr);
		
                if($lastId <> '') {
                    $this->session->set_flashdata('message', array('title'=>'Add Testimonial','content'=>'A new testimonial succesfully added','type'=>'successmsgbox'));
                    redirect(base_url()."testimonial");
                } else {
                    $this->session->set_flashdata('message', array('title'=>'Add Testimonial','content'=>'Unable to add testimonial.please try again','type'=>'errormsgbox'));
                    redirect(base_url()."testimonial/add");
                }
            }
            else {
		
                $data['validation_error']=validation_errors();
                $this->session->set_flashdata('message', array('title'=>'Add Testimonial','content'=>$data['validation_error'],'type'=>'errormsgbox'));
                redirect(base_url()."testimonial/add");
             }
        }
        $data['return_link'] = base_url()."testimonial/";
        $this->template->write_view('content','add_testimonial',$data);
        $this->template->render();
        
    }


#########################################################
#                   FOR EDIT testimonial                #
#########################################################

    public function edit()
    {
	
            $this->getTemplate();
            $data=array();
            $data['base_url']           	= $this->config->item('base_url');
            $testimonial_id                  	= $this->uri->segment(3, 0);
            $data['testimonial_id']           	= $testimonial_id;
            $data['page']               	= $this->uri->segment(4, 0);
            $conditionArr               	= array('id'=>$testimonial_id);
            $testimonial_exist             	= $this->model_testimonial->topicExistsDB($conditionArr);
            
	    if($testimonial_id == 0 || !is_numeric($testimonial_id) || !$testimonial_exist)
	    {
                    redirect('testimonial/all');
            }        
            
            $testimonial_data              	= $this->model_testimonial->detailsTopicDB($conditionArr);
            
            $data['name']           		= stripslashes($testimonial_data[0]['name']);
	    $data['description']           	= stripslashes($testimonial_data[0]['description']);
	    $data['image']           		= stripslashes($testimonial_data[0]['image']);
	    $data['company_name']		= stripslashes($testimonial_data[0]['company_name']);
	    $data['status']           		= stripslashes($testimonial_data[0]['status']);
            $data['validation_error']   	= '';
           
            
            if($this->input->get_post('action') == "Process") {
		
                
                $this->form_validation->set_rules('name','Name','required');
                $data['name']  		= addslashes(trim($this->input->get_post('name')));
		$data['description']  	= addslashes(trim($this->input->get_post('description')));
		$data['company_name']	= addslashes(trim($this->input->get_post('company_name')));
                $data['status']  	= addslashes(trim($this->input->get_post('status')));
                
                if ($this->form_validation->run() == TRUE )
                {
                    $banner_image=$_FILES['image']['name'];
                    if($banner_image <> '') {
		    unlink(FILE_UPLOAD_ABSOLUTE_PATH().'testimonial/'.stripslashes($data['image']));
		    unlink(FILE_UPLOAD_ABSOLUTE_PATH().'testimonial/thumbs/'.stripslashes($data['image']));
                    $mainUpload       = $this->imageUpload('image','testimonial','Y',150,100);
                    $image_name       = $mainUpload['image_name'];
                    }
                    else {
                     $image_name       = $data['image'];
                    }
                    $updateArr      = array(
                                    'name'           		=> $data['name'],
                                    'description'           	=> $data['description'],
				    'image'			=> $image_name,
				    'company_name'		=> $data['company_name'],
                                    'status' 	     		=> $data['status'],
                                    );

                    $update        = $this->model_testimonial->editTopicDB($updateArr,$conditionArr);
                    if($update) {
                        $this->session->set_flashdata('message', array('title'=>'Update Testimonial','content'=>'Data have been successfully edited.','type'=>'successmsgbox'));
                        redirect(base_url()."testimonial/all/".$data['page']."/");
                      } else {
                        $this->session->set_flashdata('message', array('title'=>'Update Testimonial','content'=>'Unable to edit data. Please try again.','type'=>'errormsgbox'));
                        redirect('testimonial/edit/'.$banner_id);
                    }
                
                } 
             else {
                $data['validation_error']=validation_errors();
                $this->session->set_flashdata('message', array('title'=>'Edit Testimonial','content' => $data['validation_error'],'type'=>'errormsgbox'));
                redirect('testimonial/edit/'.$banner_id);
             }
                
            }
	    
	    $data['return_link'] = base_url()."testimonial/";
            $this->template->write_view('content','edit_testimonial',$data); //pr($data);
	    $this->template->render();
            
    }
#########################################################
#                FOR  STATUS CHANGE            	#
#                                                       #
#                                                       #
#                                                       #
#########################################################

        function changeStatus($id) {
            $conditionArr           = array('id'=>$id);
            $testimonial_id         = $this->uri->segment(3, 0);
            $data['id']       	    = $testimonial_id;
            $data['page']           = $this->uri->segment(4, 0);
            $checkExist             = $this->model_testimonial->topicExistsDB($conditionArr);
            if($checkExist) {
                $this->model_testimonial->statusChangeTopicDB($id);
                $this->session->set_flashdata('message', array('title'=>'Testimonial Status','content'=>'Testimonial status has been changed','type'=>'successmsgbox'));
                redirect(base_url()."testimonial/all/".$data['page']);
            }

        }

        function delete()
	{
	    $testimonial_id        	= $this->uri->segment(3, 0);
	    $conditionArr       	= array('id' => $testimonial_id);
            $data['testimonial_id']	= $testimonial_id;
            $data['page']       	= $this->uri->segment(4, 0);
            $checkExist             	= $this->model_testimonial->topicExistsDB($conditionArr);
	    
            if($checkExist)
	    {
                $this->model_basic->deleteRecord('dipp_testimonial', $conditionArr);
                $this->session->set_flashdata('message', array('title'=>'Module Testimonial','content'=>'Record has been successfully deleted','type'=>'successmsgbox'));
                redirect(base_url()."testimonial/all/".$data['page']);
            }

        }

}