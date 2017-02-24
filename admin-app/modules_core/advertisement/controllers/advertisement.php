<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Advertisement extends MY_Controller {



    public function __construct(){
        parent::__construct();
        $this->load->model(array('welcome/model_basic','step/model_step','advertisement/model_advertisement'));
	$this->load->library('form_validation');
        $this->load->module('course');
        $this->url = base_url().'advertisement/';
        $this->checkLogin();
    }

#########################################################
#                FOR  ADVERTISEMENT LISTING                     #
#########################################################

    public function index() {
        $this->all();
    }

#########################################################
#                FOR  ADVERTISEMENT LISTING                     #
#########################################################

    public function all()
    {
	
        
        $this->getTemplate();
        $total_topic      = $this->model_advertisement->countTopicDB();
	
	$data['totalRecord']      = $total_topic;
	$data['per_page']         = PER_PAGE_LISTING;
	$start                    = 0;
        $data['startRecord']      = $start;
	$data['page']             = $this->uri->segment(3);
	$data['search_keyword']   = "";
	
	if($total_topic > 0) {
            /********** FOR PAGINATION ***********/
            $config['base_url'] = base_url().'/advertisement/all';
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
            $resultArr=$this->model_advertisement->allTopicDB($search_by,PER_PAGE_LISTING,$offset);
            //pr($resultArr);

            if(count($resultArr) > 0) {
                $num = 1+$offset;
                    foreach($resultArr as $values) {
                    $id           = $values['id'];
                    $status       = $values['advertisement_status'];
                    $status_class =($status == 'Active')?'label-green':'label-red';    
                    
                    /********** GET GENERATE EDIT AND DELETE LINK ***********/
                    $this->uri_segment = $this->uri->total_segments();
                    $cur_page           = 0;
                    if ($this->uri->segment($this->uri_segment) != 0) {
                        $this->cur_page = $this->uri->segment($this->uri_segment);
                        $cur_page = (int) $this->cur_page;
                    }

                    $edit_link          = base_url()."advertisement/edit/".$id."/".$cur_page."/";
		    $delete_link          = base_url()."advertisement/delete/".$id."/".$cur_page."/";
                    $status_link        = base_url()."advertisement/changeStatus/".$id."/".$cur_page;

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
                $data['advertisement_all']        = $total_result;
                /********** FOR PAGINATION ***********/
                $config['cur_tag_open']     = '<span class="current-link">';
                $config['cur_tag_close']    = '</span>';
                $this->pagination->initialize($config);
                $data['paging']             = $this->pagination->create_links();
                $this->template->write_view('content','advertisement_list',$data);
                $this->template->render();
                
            }
        } else {
            $this->template->write_view('content', 'norecord_advertisement_list.php');
            $this->template->render();
         }
    }



#########################################################
#                   FOR advertisement SEARCH                    #
#                                                       #
#                                                       #
#                                                       #
#########################################################

    public function search(){

        $this->getTemplate();
        /********** FOR ADVERTISEMENT SEARCH ***********/
        $search_by ='';
        if($this->input->get_post('action') == "Process"){
            $this->session->set_userdata('search_str',trim($this->input->get_post('search_str')));
        }
        if($this->session->userdata('search_str')){
            $search_by = $this->session->userdata('search_str');
        }
        
        $data['search_keyword'] = $search_by;
        $total_topic=$this->model_advertisement->countTopicDB($search_by);
        $data['totalRecord'] 	= $total_topic;
	$data['per_page'] 	= PER_PAGE_LISTING;
	$start 			= 0;
        $data['startRecord'] 	= $start;
	$data['page']	 	= $this->uri->segment(3);
        if($total_topic > 0)
        {
            /********** FOR PAGINATION ***********/
            $config['base_url'] = base_url().'/advertisement/search';
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


            $resultArr = $this->model_advertisement->allTopicDB($search_by,PER_PAGE_LISTING,$offset);
	    
	    if(count($resultArr) > 0)
	    {
		$num    = 1+$offset;
		foreach($resultArr as $values)
		{
		    $id          = $values['id'];
                    $status      = $values['advertisement_status'];
                    $status_class=($status == 'Active')?'label-green':'label-red';  
                    
                    /********** GET GENERATE EDIT AND DELETE LINK ***********/
                    $this->uri_segment = $this->uri->total_segments();
                    $cur_page = 0;
                    if ($this->uri->segment($this->uri_segment) != 0) {
                        $this->cur_page = $this->uri->segment($this->uri_segment);
                        $cur_page = (int) $this->cur_page;
                    }
		    
                    $edit_link          = base_url()."advertisement/edit/".$id."/".$cur_page."/";
                    $status_link        = base_url()."advertisement/changeStatus/".$id."/".$cur_page;
                    $delete_link          = base_url()."advertisement/delete/".$id."/".$cur_page."/";

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

                $data['advertisement_all']=$total_result;
                //pr($data['advertisement_all']);
                /********** FOR PAGINATION ***********/
                $config['cur_tag_open'] = '<span class="current-link">';
                $config['cur_tag_close'] = '</span>';
                $this->pagination->initialize($config);
                $this->session->unset_userdata('search_str');
                $data['paging'] = $this->pagination->create_links();
                $this->template->write_view('content','advertisement_list',$data);
                $this->template->render();
            }
        }
        else
        {
            $this->template->write_view('content', 'norecord_advertisement_list.php');
            $this->template->render();
        }
    }

#########################################################
#                FOR  ADVERTISEMENT LISTING                     #
#########################################################

    public function data()
    {
	
        
        $this->getTemplate();
        $data['step_id']  = $this->uri->segment(3);
        $condition_arr    = array('step_id'=>$data['step_id']);
        $total_topic      = $this->model_advertisement->countTopicDB("",$condition_arr);
        $total_topic      = ($total_topic > 0)?$total_topic:0;
	
	$data['totalRecord']      = $total_topic;
	$data['per_page']         = PER_PAGE_LISTING;
	$start                    = 0;
        $data['startRecord']      = $start;
	$data['page']             = $this->uri->segment(4);
	$data['search_keyword']   = "";
	
        /********** FOR PAGINATION ***********/
        $config['base_url'] = base_url().'/advertisement/all';
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
            $resultArr=$this->model_advertisement->allTopicDB($search_by,PER_PAGE_LISTING,$offset,$condition_arr);
            //pr($resultArr);
            $num = 1+$offset;
            foreach($resultArr as $values) {
            $id           = $values['id'];
            $status       = $values['advertisement_status'];
            $status_class =($status == 'Active')?'label-green':'label-red';    

            /********** GET GENERATE EDIT AND DELETE LINK ***********/
            $this->uri_segment = $this->uri->total_segments();
            $cur_page           = 0;
            if ($this->uri->segment($this->uri_segment) != 0) {
                $this->cur_page = $this->uri->segment($this->uri_segment);
                $cur_page = (int) $this->cur_page;
            }

            $edit_link          = base_url()."advertisement/edit/".$id."/".$cur_page."/";
            $status_link        = base_url()."advertisement/changeStatus/".$id."/".$cur_page;
	    $delete_link        = base_url()."advertisement/delete/".$id."/".$cur_page."/";
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
            $data['topic_all']        = $total_result;
            /********** FOR PAGINATION ***********/
            $config['cur_tag_open']     = '<span class="current-link">';
            $config['cur_tag_close']    = '</span>';
            $this->pagination->initialize($config);
            $data['paging']             = $this->pagination->create_links();
            $this->template->write_view('content','step_wise_advertisement_list',$data);
            $this->template->render();
           
    }

#########################################################
#                   FOR ADD advertisement                       #
#                                                       #
#                                                       #
#                                                       #
#########################################################
    public function add() {
        $this->getTemplate();
        $data                                   = array();
        $data['base_url']                       = $this->config->item('base_url');
        $data['frmAction']                      = base_url()."advertisement/add";
        $data['advertisement_title']                     = '';
        $data['validation_error']               = '';
        
      
        if($this->input->get_post('action') == "Process") {
            $this->form_validation->set_rules('advertisement_title','Title','required');
            $this->form_validation->set_rules('advertisement_link','Link','required');
            $data['advertisement_title']  = addslashes(trim($this->input->get_post('advertisement_title')));
            $data['advertisement_link']   = addslashes(trim($this->input->get_post('advertisement_link')));
            if ($this->form_validation->run() == TRUE )
            {
                
                $advertisement_image=$_FILES['advertisement_image']['name'];
                if($advertisement_image <> '') {
                    $mainUpload       = $this->imageUpload('advertisement_image','advertisement','Y',150,100);
                    $image_name       = $mainUpload['image_name'];
                } 
               
                $insertArr      = array(
                                    'advertisement_title'           => $data['advertisement_title'],
				    'advertisement_link'	     => $data['advertisement_link'],
                                    'advertisement_image'           => $image_name,
                                    'added_on'               => date('Y-m-d H:i:s'),
                                    );
               
                $lastId=$this->model_advertisement->addTopicDB($insertArr);
		
                if($lastId <> '') {
                    $this->session->set_flashdata('message', array('title'=>'Add Advertisement','content'=>'A new Advertisement succesfully added','type'=>'successmsgbox'));
                    redirect(base_url()."advertisement");
                } else {
                    $this->session->set_flashdata('message', array('title'=>'Add Advertisement','content'=>'Unable to add Advertisement.please try again','type'=>'errormsgbox'));
                    redirect(base_url()."advertisement/add");
                }
            }
            else {
                $data['validation_error']=preg_replace('/\s+/', ' ',validation_errors('<p>','</p>'));
                $this->session->set_flashdata('message', array('title'=>'Add Advertisement','content'=>$data['validation_error'],'type'=>'errormsgbox'));
                redirect(base_url()."advertisement/add");
             }
        }
        $data['return_link'] = base_url()."advertisement/";
        $this->template->write_view('content','add_advertisement',$data);
        $this->template->render();
        
    }


#########################################################
#                   FOR EDIT advertisement                   #
#########################################################

    public function edit()
    {
	
            $this->getTemplate();
            $data=array();
            $data['base_url']           = $this->config->item('base_url');
            $advertisement_id                   = $this->uri->segment(3, 0);
            $data['advertisement_id']           = $advertisement_id;
            $data['page']               = $this->uri->segment(4, 0);
            $conditionArr               = array('id'=>$advertisement_id);
            $advertisement_exist             	= $this->model_advertisement->topicExistsDB($conditionArr);
            
	    if($advertisement_id == 0 || !is_numeric($advertisement_id) || !$advertisement_exist)
	    {
                    redirect('advertisement/all');
            }        
            
            $advertisement_data              	= $this->model_advertisement->detailsTopicDB($conditionArr);
            
            $data['advertisement_title']           	= stripslashes($advertisement_data[0]['advertisement_title']);
	    $data['advertisement_link']           	= stripslashes($advertisement_data[0]['advertisement_link']);
	    $data['advertisement_image']           	= stripslashes($advertisement_data[0]['advertisement_image']);
	    $data['advertisement_status']           	= stripslashes($advertisement_data[0]['advertisement_status']);
            $data['validation_error']   = '';
           
            
            if($this->input->get_post('action') == "Process") {
                
                $this->form_validation->set_rules('advertisement_title','Title','required');
		$this->form_validation->set_rules('advertisement_link','Link','required');
                $data['advertisement_title']  = addslashes(trim($this->input->get_post('advertisement_title')));
		$data['advertisement_link']  = addslashes(trim($this->input->get_post('advertisement_link')));
                $data['advertisement_status']  = addslashes(trim($this->input->get_post('advertisement_status')));
                
                if ($this->form_validation->run() == TRUE )
                {
                    
                    $advertisement_image=$_FILES['advertisement_image']['name'];
                    if($advertisement_image <> '') {
		    unlink(FILE_UPLOAD_ABSOLUTE_PATH().'advertisement/'.stripslashes($data['advertisement_image']));
		    unlink(FILE_UPLOAD_ABSOLUTE_PATH().'advertisement/thumbs/'.stripslashes($data['advertisement_image']));
                    $mainUpload       = $this->imageUpload('advertisement_image','advertisement','Y',150,100);
                    $image_name       = $mainUpload['image_name'];
                    }
                    else {
                     $image_name       = $data['advertisement_image'];
                    }
                
                    
                    
                    $updateArr      = array(
                                    'advertisement_title'           => $data['advertisement_title'],
				    'advertisement_link'	     => $data['advertisement_link'],
                                    'advertisement_image'           => $image_name,
                                    'advertisement_status' 	     => $data['advertisement_status'],
                                    );

                    $update        = $this->model_advertisement->editTopicDB($updateArr,$conditionArr);
                    if($update) {
                        $this->session->set_flashdata('message', array('title'=>'Update Advertisement','content'=>'Data have been successfully edited.','type'=>'successmsgbox'));
                        redirect(base_url()."advertisement/all/".$data['page']."/");
                      } else {
                        $this->session->set_flashdata('message', array('title'=>'Update Advertisement','content'=>'Unable to edit data. Please try again.','type'=>'errormsgbox'));
                        redirect('advertisement/edit/'.$advertisement_id);
                    }
                
                } 
             else {
                $data['validation_error']=preg_replace('/\s+/', ' ',validation_errors('<p>','</p>'));
                $this->session->set_flashdata('message', array('title'=>'Edit Advertisement','content' => $data['validation_error'],'type'=>'errormsgbox'));
                redirect('advertisement/edit/'.$advertisement_id);
             }
                
            }
	    
	    $data['return_link'] = base_url()."advertisement/";
            $this->template->write_view('content','edit_advertisement',$data); //pr($data);
	    $this->template->render();
            
    }



#########################################################
#                FOR  advertisement STATUS CHANGE            	#
#                                                       #
#                                                       #
#                                                       #
#########################################################

        function changeStatus($id) {
            $conditionArr           = array('id'=>$id);
            $advertisement_id              = $this->uri->segment(3, 0);
            $data['id']       	    = $advertisement_id;
            $data['page']           = $this->uri->segment(4, 0);
            $checkExist             = $this->model_advertisement->topicExistsDB($conditionArr);
            if($checkExist) {
                $this->model_advertisement->statusChangeTopicDB($id);
                $this->session->set_flashdata('message', array('title'=>'Advertisement Status','content'=>'Advertisement status has been changed','type'=>'successmsgbox'));
                redirect(base_url()."advertisement/all/".$data['page']);
            }

        }

        function delete($id)
	{
	    $advertisement_id        	= $this->uri->segment(3, 0);
	    $conditionArr       = array('id' => $advertisement_id);
            $data['advertisement_id']	= $advertisement_id;
            $data['page']       = $this->uri->segment(4, 0);
            $checkExist             = $this->model_advertisement->topicExistsDB($conditionArr);
	    
            if($checkExist)
	    {
		$advertisement_data              	= $this->model_advertisement->detailsTopicDB($conditionArr);
		$data['advertisement_image']           = stripslashes($advertisement_data[0]['advertisement_image']);
		unlink(FILE_UPLOAD_ABSOLUTE_PATH().'advertisement/'.stripslashes($data['advertisement_image']));
		unlink(FILE_UPLOAD_ABSOLUTE_PATH().'advertisement/thumbs/'.stripslashes($data['advertisement_image']));
                $this->model_basic->deleteRecord('dipp_advertisement', $conditionArr);
                $this->session->set_flashdata('message', array('title'=>'Module Advertisement','content'=>'Record has been successfully deleted','type'=>'successmsgbox'));
                redirect(base_url()."advertisement/all/".$data['page']);
            }

        }

}