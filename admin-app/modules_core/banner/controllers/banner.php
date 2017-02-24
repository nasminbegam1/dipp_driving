<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Banner extends MY_Controller {



    public function __construct(){
        parent::__construct();
        $this->load->model(array('welcome/model_basic','step/model_step','banner/model_banner'));
	$this->load->library('form_validation');
        $this->load->module('course');
        $this->url = base_url().'banner/';
        $this->checkLogin();
    }

#########################################################
#                FOR  banner LISTING                     #
#########################################################

    public function index() {
        $this->all();
	}

#########################################################
#                FOR  banner LISTING                     #
#########################################################

    public function all()
    {
	
        
        $this->getTemplate();
        $total_topic      = $this->model_banner->countTopicDB();
	
	$data['totalRecord']      = $total_topic;
	$data['per_page']         = PER_PAGE_LISTING;
	$start                    = 0;
        $data['startRecord']      = $start;
	$data['page']             = $this->uri->segment(3);
	$data['search_keyword']   = "";
	
	if($total_topic > 0) {
            /********** FOR PAGINATION ***********/
            $config['base_url'] = base_url().'/banner/all';
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
            $resultArr=$this->model_banner->allTopicDB($search_by,PER_PAGE_LISTING,$offset);
            //pr($resultArr);

            if(count($resultArr) > 0) {
                $num = 1+$offset;
                    foreach($resultArr as $values) {
                    $id           = $values['id'];
                    $status       = $values['banner_status'];
                    $status_class =($status == 'Active')?'label-green':'label-red';    
                    
                    /********** GET GENERATE EDIT AND DELETE LINK ***********/
                    $this->uri_segment = $this->uri->total_segments();
                    $cur_page           = 0;
                    if ($this->uri->segment($this->uri_segment) != 0) {
                        $this->cur_page = $this->uri->segment($this->uri_segment);
                        $cur_page = (int) $this->cur_page;
                    }

                    $edit_link          = base_url()."banner/edit/".$id."/".$cur_page."/";
		    $delete_link          = base_url()."banner/delete/".$id."/".$cur_page."/";
                    $status_link        = base_url()."banner/changeStatus/".$id."/".$cur_page;

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
							    'delete_link'         => $delete_link,
                                                            'status_link'       => $status_link
                                                            )
                                            );
                    $num++;

                }
                //pr($total_result);
                $data['banner_all']        = $total_result;
                /********** FOR PAGINATION ***********/
                $config['cur_tag_open']     = '<span class="current-link">';
                $config['cur_tag_close']    = '</span>';
                $this->pagination->initialize($config);
                $data['paging']             = $this->pagination->create_links();
                $this->template->write_view('content','banner_list',$data);
                $this->template->render();
                
            }
        } else {
            $this->template->write_view('content', 'norecord_banner_list.php');
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
        $total_topic=$this->model_banner->countTopicDB($search_by);
        $data['totalRecord'] 	= $total_topic;
	$data['per_page'] 	= PER_PAGE_LISTING;
	$start 			= 0;
        $data['startRecord'] 	= $start;
	$data['page']	 	= $this->uri->segment(3);
        if($total_topic > 0)
        {
            /********** FOR PAGINATION ***********/
            $config['base_url'] = base_url().'/banner/search';
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


            $resultArr = $this->model_banner->allTopicDB($search_by,PER_PAGE_LISTING,$offset);
	    
	    if(count($resultArr) > 0)
	    {
		$num    = 1+$offset;
		foreach($resultArr as $values)
		{
		    $id          = $values['id'];
                    $status      = $values['banner_status'];
                    $status_class=($status == 'Active')?'label-green':'label-red';  
                    
                    /********** GET GENERATE EDIT AND DELETE LINK ***********/
                    $this->uri_segment = $this->uri->total_segments();
                    $cur_page = 0;
                    if ($this->uri->segment($this->uri_segment) != 0) {
                        $this->cur_page = $this->uri->segment($this->uri_segment);
                        $cur_page = (int) $this->cur_page;
                    }
		    
                    $edit_link          = base_url()."banner/edit/".$id."/".$cur_page."/";
                    $status_link        = base_url()."banner/changeStatus/".$id."/".$cur_page;
                    $delete_link          = base_url()."banner/delete/".$id."/".$cur_page."/";

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

                $data['banner_all']=$total_result;
                //pr($data['banner_all']);
                /********** FOR PAGINATION ***********/
                $config['cur_tag_open'] = '<span class="current-link">';
                $config['cur_tag_close'] = '</span>';
                $this->pagination->initialize($config);
                $this->session->unset_userdata('search_str');
                $data['paging'] = $this->pagination->create_links();
                $this->template->write_view('content','banner_list',$data);
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
#                   FOR ADD banner                       #
#                                                       #
#                                                       #
#                                                       #
#########################################################
    public function add() {
        $this->getTemplate();
        $data                                   = array();
        $data['base_url']                       = $this->config->item('base_url');
        $data['frmAction']                      = base_url()."banner/add";
        $data['banner_title']                     = '';
        $data['validation_error']               = '';
        
      
        if($this->input->get_post('action') == "Process") {
            $this->form_validation->set_rules('banner_title','Title','required');
            $data['banner_title']  = addslashes(trim($this->input->get_post('banner_title')));
            $data['banner_link']   = addslashes(trim($this->input->get_post('banner_link')));
            if ($this->form_validation->run() == TRUE )
            {
                list($width, $height, $type, $attr) = getimagesize($_FILES["banner_image"]['tmp_name']);
		if($width == '1600' && $height == '500'){
		    $banner_image=$_FILES['banner_image']['name'];
		    if($banner_image <> '') {
			$mainUpload       = $this->imageUpload('banner_image','banner','Y',150,100);
			$image_name       = $mainUpload['image_name'];
		    } 
		   
		    $insertArr      = array(
					'banner_title'           => $data['banner_title'],
					'banner_image'           => $image_name,
					'added_on'               => date('Y-m-d H:i:s'),
					);
		   
		    $lastId=$this->model_banner->addTopicDB($insertArr);
		    
		    if($lastId <> '') {
			$this->session->set_flashdata('message', array('title'=>'Add Banner','content'=>'A new Banner succesfully added','type'=>'successmsgbox'));
			redirect(base_url()."banner");
		    } else {
			$this->session->set_flashdata('message', array('title'=>'Add Banner','content'=>'Unable to add Banner.please try again','type'=>'errormsgbox'));
			redirect(base_url()."banner/add");
		    }
		}else{
		    $this->session->set_flashdata('message', array('title'=>'Add Banner','content'=>'Banner size should be 1600 X 500','type'=>'errormsgbox'));
		    redirect(base_url()."banner/add");
		}
            }
            else {
                $data['validation_error']=preg_replace('/\s+/', ' ',validation_errors('<p>','</p>'));
                $this->session->set_flashdata('message', array('title'=>'Add Banner','content'=>$data['validation_error'],'type'=>'errormsgbox'));
                redirect(base_url()."banner/add");
             }
        }
        $data['return_link'] = base_url()."banner/";
        $this->template->write_view('content','add_banner',$data);
        $this->template->render();
        
    }


#########################################################
#                   FOR EDIT banner                   #
#########################################################

    public function edit()
    {
	
            $this->getTemplate();
            $data=array();
            $data['base_url']           = $this->config->item('base_url');
            $banner_id                   = $this->uri->segment(3, 0);
            $data['banner_id']           = $banner_id;
            $data['page']               = $this->uri->segment(4, 0);
            $conditionArr               = array('id'=>$banner_id);
            $banner_exist             	= $this->model_banner->topicExistsDB($conditionArr);
            
	    if($banner_id == 0 || !is_numeric($banner_id) || !$banner_exist)
	    {
                    redirect('banner/all');
            }        
            
            $banner_data              	= $this->model_banner->detailsTopicDB($conditionArr);
            
            $data['banner_title']           	= stripslashes($banner_data[0]['banner_title']);
	    $data['banner_image']           	= stripslashes($banner_data[0]['banner_image']);
	    $data['banner_status']           	= stripslashes($banner_data[0]['banner_status']);
            $data['validation_error']   = '';
           
            
            if($this->input->get_post('action') == "Process") {
                
                $this->form_validation->set_rules('banner_title','Title','required');
                $data['banner_title']  = addslashes(trim($this->input->get_post('banner_title')));
		$data['banner_link']  = addslashes(trim($this->input->get_post('banner_link')));
                $data['banner_status']  = addslashes(trim($this->input->get_post('banner_status')));
                
                if ($this->form_validation->run() == TRUE )
                {
                    
                    $banner_image=$_FILES['banner_image']['name'];
                    if($banner_image <> '') {
		    list($width, $height, $type, $attr) = getimagesize($_FILES["banner_image"]['tmp_name']);
		    if($width != '1600' || $height != '500'){
			$this->session->set_flashdata('message', array('title'=>'Update Banner','content'=>'Banner size should be 1600 X 500.','type'=>'errormsgbox'));
                        redirect('banner/edit/'.$banner_id);
		    }
		    unlink(FILE_UPLOAD_ABSOLUTE_PATH().'banner/'.stripslashes($data['banner_image']));
		    unlink(FILE_UPLOAD_ABSOLUTE_PATH().'banner/thumbs/'.stripslashes($data['banner_image']));
                    $mainUpload       = $this->imageUpload('banner_image','banner','Y',150,100);
                    $image_name       = $mainUpload['image_name'];
                    }
                    else {
                     $image_name       = $data['banner_image'];
                    }
                
                    
                    
                    $updateArr      = array(
                                    'banner_title'           => $data['banner_title'],
                                    'banner_image'           => $image_name,
                                    'banner_status' 	     => $data['banner_status'],
                                    );

                    $update        = $this->model_banner->editTopicDB($updateArr,$conditionArr);
                    if($update) {
                        $this->session->set_flashdata('message', array('title'=>'Update Banner','content'=>'Data have been successfully edited.','type'=>'successmsgbox'));
                        redirect(base_url()."banner/all/".$data['page']."/");
                      } else {
                        $this->session->set_flashdata('message', array('title'=>'Update Banner','content'=>'Unable to edit data. Please try again.','type'=>'errormsgbox'));
                        redirect('banner/edit/'.$banner_id);
                    }
                
                } 
             else {
                $data['validation_error']=preg_replace('/\s+/', ' ',validation_errors('<p>','</p>'));
                $this->session->set_flashdata('message', array('title'=>'Edit Banner','content' => $data['validation_error'],'type'=>'errormsgbox'));
                redirect('banner/edit/'.$banner_id);
             }
                
            }
	    
	    $data['return_link'] = base_url()."banner/";
            $this->template->write_view('content','edit_banner',$data); //pr($data);
	    $this->template->render();
            
    }



#########################################################
#                FOR  banner STATUS CHANGE            	#
#                                                       #
#                                                       #
#                                                       #
#########################################################

        function changeStatus($id) {
            $conditionArr           = array('id'=>$id);
            $banner_id              = $this->uri->segment(3, 0);
            $data['id']       	    = $banner_id;
            $data['page']           = $this->uri->segment(4, 0);
            $checkExist             = $this->model_banner->topicExistsDB($conditionArr);
            if($checkExist) {
                $this->model_banner->statusChangeTopicDB($id);
                $this->session->set_flashdata('message', array('title'=>'Banner Status','content'=>'Banner status has been changed','type'=>'successmsgbox'));
                redirect(base_url()."banner/all/".$data['page']);
            }

        }

        function delete($id)
	{
	    $banner_id        	= $this->uri->segment(3, 0);
	    $conditionArr       = array('id' => $banner_id);
            $data['banner_id']	= $banner_id;
            $data['page']       = $this->uri->segment(4, 0);
            $checkExist             = $this->model_banner->topicExistsDB($conditionArr);
	    
            if($checkExist)
	    {
		$banner_data              	= $this->model_banner->detailsTopicDB($conditionArr);
		$data['banner_image']           = stripslashes($banner_data[0]['banner_image']);
		unlink(FILE_UPLOAD_ABSOLUTE_PATH().'banner/'.stripslashes($data['banner_image']));
		unlink(FILE_UPLOAD_ABSOLUTE_PATH().'banner/thumbs/'.stripslashes($data['banner_image']));
                $this->model_basic->deleteRecord('dipp_banner', $conditionArr);
                $this->session->set_flashdata('message', array('title'=>'Module Advertisement','content'=>'Record has been successfully deleted','type'=>'successmsgbox'));
                redirect(base_url()."banner/all/".$data['page']);
            }

        }

}