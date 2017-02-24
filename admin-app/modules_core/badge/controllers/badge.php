<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Badge extends MY_Controller {


    var $emailTemplate 	= 'dipp_email_template';
    public function __construct(){
        parent::__construct();
        $this->load->model(array('welcome/model_basic', 'badge/model_badge'));
	$this->load->library('form_validation');
        $this->url = base_url().'badge/';
        $this->checkLogin();
	
    }

 
#########################################################
#                FOR  INSTRUCTOR LISTING                #
#                                                       #
#                                                       #
#                                                       #
#########################################################

    public function index() {
        $this->all();
    }

#########################################################
#                FOR  INSTRUCTOR LISTING                #
#                                                       #
#                                                       #
#                                                       #
#########################################################

    public function all() {
	
        $this->getTemplate();
        $data['per_page']         = PER_PAGE_LISTING;
	$start                    = 0;
        $data['startRecord']      = $start;
	$data['page']             = $this->uri->segment(3);
        
        $total_user               = $this->model_badge->countBadgeDB();
        $data['totalRecord']      = $total_user;
	$data['search_keyword']   = "";
        if($total_user > 0) {
            /********** FOR PAGINATION ***********/
            $config['base_url'] = base_url().'/badge/all';
            $config['per_page'] =10;
            $config['total_rows'] = $total_user;
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
            $resultArr=$this->model_badge->allBadgeDB($search_by,PER_PAGE_LISTING,$offset);

            if(count($resultArr) > 0) {
                $num = 1+$offset;
                    foreach($resultArr as $values) {
                    $insId         = $values['badge_id'];
                    $insStatus     = $values['badge_status'];
                    $status_class=($insStatus == 'Active')?'label-green':'label-red';    
                    
                    /********** GET GENERATE EDIT AND DELETE LINK ***********/
                    $this->uri_segment = $this->uri->total_segments();
                    $cur_page           = 0;
                    if ($this->uri->segment($this->uri_segment) != 0) {
                        $this->cur_page = $this->uri->segment($this->uri_segment);
                        $cur_page = (int) $this->cur_page;
                    }

                    $edit_link          = base_url()."badge/edit/".$insId."/".$cur_page."/";
                    $status_link        = base_url()."badge/changeStatus/".$insId."/".$cur_page;
                    $delete_link        = base_url()."badge/delete/".$insId."/".$cur_page."/";

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
                                                            'status_link'       => $status_link,
                                                            'delete_link'       => $delete_link
                                                            )
                                            );
                    $num++;

                }

                $data['badge_all']        = $total_result;
                /********** FOR PAGINATION ***********/
                $config['cur_tag_open']     = '<span class="current-link">';
                $config['cur_tag_close']    = '</span>';
                $this->pagination->initialize($config);
                $data['paging']             = $this->pagination->create_links();
                $this->template->write_view('content','badge_list',$data);
                $this->template->render();
                
            }
        } else {
            $this->template->write_view('content', 'norecord_badge_list.php');
            $this->template->render();
         }
    }



#########################################################
#                   FOR INSTRUCTOR SEARCH               #
#                                                       #
#                                                       #
#                                                       #
#########################################################

    public function search(){

        $this->getTemplate();
        $data['per_page']         = PER_PAGE_LISTING;
	$start                    = 0;
        $data['startRecord']      = $start;
	$data['page']             = $this->uri->segment(3);
        /********** FOR CATEGORY SEARCH ***********/
        $search_by ='';
        if($this->input->get_post('action') == "Process"){
            $this->session->set_userdata('search_str',trim($this->input->get_post('search_str')));
        }
        if($this->session->userdata('search_str')){
            $search_by = $this->session->userdata('search_str');
        }


        $total_badge=$this->model_badge->countBadgeDB($search_by);
        $data['totalRecord']      = $total_badge;
	$data['search_keyword']   = $search_by;
        if($total_badge > 0)
        {
            /********** FOR PAGINATION ***********/
            $config['base_url'] = base_url().'/badge/all';
            $config['per_page'] =10;
            $config['total_rows'] = $total_badge;
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


            $resultArr=$this->model_badge->allBadgeDB($search_by,$config['per_page'],$offset);

            if(count($resultArr) > 0) {
                $num    = 1+$offset;
		foreach($resultArr as $values) {
                    $insId         = $values['badge_id'];
                    $insStatus     = $values['badge_status'];
                    $status_class=($insStatus == 'Active')?'label-green':'label-red'; 
                    
                    /********** GET GENERATE EDIT AND DELETE LINK ***********/
                    $this->uri_segment = $this->uri->total_segments();
                    $cur_page = 0;
                    if ($this->uri->segment($this->uri_segment) != 0) {
                        $this->cur_page = $this->uri->segment($this->uri_segment);
                        $cur_page = (int) $this->cur_page;
                    }
                    $edit_link          = base_url()."badge/edit/".$insId."/".$cur_page."/";
                    $status_link        = base_url()."badge/changeStatus/".$insId."/".$cur_page;
                    $delete_link        = base_url()."badge/delete/".$insId."/".$cur_page."/";

                    if($num%2==0)
                    {
                        $class = 'class="even"';
                    }
                    else
                    {
                        $class = 'class="odd"';
                    }

                    $total_result[]     = array_merge($values,
                                                        array('slno'        => $num,
                                                        'class'             => $class,
                                                        'status_class'      => $status_class,
                                                        'edit_link'         => $edit_link,
                                                        'status_link'       => $status_link,        
                                                        'delete_link'       => $delete_link)
                                                      );
                    $num++;
                }

                $data['badge_all']=$total_result;
                /********** FOR PAGINATION ***********/
                $config['cur_tag_open'] = '<span class="current-link">';
                $config['cur_tag_close'] = '</span>';
                $this->pagination->initialize($config);
                $this->session->unset_userdata('search_str');
                $data['paging'] = $this->pagination->create_links();
                $this->template->write_view('content','badge_list',$data);
                $this->template->render();
            }
        }
        else
        {
            $this->template->write_view('content', 'norecord_badge_list.php');
            $this->template->render();
        }
    }

#########################################################
#                   FOR ADD USER                        #
#                                                       #
#                                                       #
#                                                       #
#########################################################
    public function add() {
        $this->getTemplate();
        $data                                   = array();
        $data['base_url']                       = $this->config->item('base_url');
        $data['frmAction']                      = base_url()."badge/add";
	
	$conditionArr               		= array('package_status'=>'Active');
        //$data['packageList']        		= $this->model_badge->packageList($conditionArr);
	//$data['courseList']        		= $this->model_badge->courseList(array('status'=>'Active'));
        $data['validation_error']               = '';
        
        if($this->input->get_post('action') == "Process") {
	    $this->form_validation->set_rules('badge_type','Select Type','required');
            $this->form_validation->set_rules('badge_name','Badge Name','required');
	    $this->form_validation->set_rules('badge_status','Select Status','required');

            if ($this->form_validation->run() == TRUE )
            {
		
		$badge_name 		= $this->input->post('badge_name');
		$badge_type		= $this->input->post('badge_type');
		$badge_status		= $this->input->post('badge_status');
		
		//$whereArr	= array( 'badge_name' => url_title($badge_name, 'dash') );
		//$whereArr	= array( 'badge_name' => $badge_name );
		//$bool 		= $this->model_badge->badgeExistsDB( $whereArr );
		//
		//if($bool){
		//	 $this->session->set_flashdata('message', array('title'=>'Add Badge','content'=>'Badge name is already exist','type'=>'errormsgbox'));
		//	redirect(base_url()."badge/add");
		//}else{
		
		$image_name = '';
                $badge_image=$_FILES['badge_image']['name'];
                if($badge_image <> '') {
                    $mainUpload       = $this->imageUpload('badge_image','badge_image','Y',100,100);
                    $image_name       = $mainUpload['image_name'];
                } 
                
		
                $insertArr      = array(
				    'badge_name'	=> $badge_name,
                                    'badge_type'      	=> $badge_type,
				    'badge_image'	=> $image_name,
				    'badge_status'	=> $badge_status,				    
                                    'added_on'  	=> date('Y-m-d H:i:s')
                                    );
                $lastId=$this->model_badge->addBadgeDB($insertArr);
                if($lastId <> '') {		    
		    
                    $this->session->set_flashdata('message', array('title'=>'Add Badge','content'=>'Badge succesfully added','type'=>'successmsgbox'));
                    redirect(base_url()."badge");
                } else {
                    $this->session->set_flashdata('message', array('title'=>'Add Badge','content'=>'Unable to add Badge.please try again','type'=>'errormsgbox'));
                    redirect(base_url()."badge/add");
                }
		//}
            }
            else {
                $data['validation_error']=preg_replace('/\s+/', ' ',validation_errors('<p>','</p>'));
                $this->session->set_flashdata('message', array('title'=>'Add Badge','content'=>$data['validation_error'],'type'=>'errormsgbox'));
                redirect(base_url()."badge/add");
             }
        }
	$data['return_link'] = base_url()."badge/";
        $this->template->write_view('content','add_badge',$data);
        $this->template->render();
        
    }

#########################################################
#                   FOR EDIT INSTRACTOR                       #
#                                                       #
#                                                       #
#                                                       #
#########################################################
    public function edit() {
            $this->getTemplate();
            $data=array();
            $data['base_url']      = $this->config->item('base_url');
            $badge_id              = $this->uri->segment(3, 0);
            $data['badge_id']      = $badge_id;
            $data['page']          = $this->uri->segment(4, 0);
	    //$conditionArr               = array('package_status'=>'Active');
	    //$data['packageList']        = $this->model_badge->packageList($conditionArr);
	    //$data['courseList']        	= $this->model_badge->courseList(array('status'=>'Active'));
            $conditionArr               = array('badge_id'=>$data['badge_id']);
            $badge_exist           = $this->model_badge->badgeExistsDB($conditionArr);
            if($badge_id == 0 || !is_numeric($badge_id) || !$badge_exist) {
                    redirect('badge/index');
            }

            $data['badge_data']            = $this->model_badge->detailsBadgeDB($conditionArr);
            $data['validation_error']   	= '';
           
            if($this->input->get_post('action') == "Process") {
		$this->form_validation->set_rules('badge_type','Select Type','required');
		$this->form_validation->set_rules('badge_name','Badge Name','required');
		$this->form_validation->set_rules('badge_status','Select Status','required');
                
                if ($this->form_validation->run() == TRUE )
                {
		    $badge_name 		= $this->input->post('badge_name');
		    $badge_type		= $this->input->post('badge_type');
		    $badge_status		= $this->input->post('badge_status');
		   
		    
		//    $whereArr	= array( 'badge_business_name' => url_title($badge_business_name, 'dash'),'badge_id !=' => $badge_id );
		//    $bool 		= $this->model_badge->badgeExistsDB( $whereArr );
		//    //pr($bool);
		//    if($bool){
		//	     $this->session->set_flashdata('message', array('title'=>'Add Badge','content'=>'Business name is already exist','type'=>'errormsgbox'));
		//	    redirect(base_url()."badge/add");
		//    }else{
			
		    $badge_image=$_FILES['badge_image']['name'];
                    if($badge_image <> '') {
		    unlink(FILE_UPLOAD_ABSOLUTE_PATH().'badge_image/'.stripslashes($data['badge_data'][0]['badge_image']));
		    unlink(FILE_UPLOAD_ABSOLUTE_PATH().'badge_image/thumbs/'.stripslashes($data['badge_data'][0]['badge_image']));
                    $mainUpload       = $this->imageUpload('badge_image','badge_image','Y',240,85);
                    $image_name       = $mainUpload['image_name'];
                    }
                    else {
                     $image_name       = $data['badge_data'][0]['badge_image'];
                    }
		    
		    
		    $updateArr          	= array(
							    'badge_name'	=> $badge_name,
							    'badge_type'      	=> $badge_type,
							    'badge_image'	=> $image_name,
							    'badge_status'	=> $badge_status);
		    
                    $update             = $this->model_badge->editBadgeDB($updateArr,$conditionArr);
                    if($update) {
                        $this->session->set_flashdata('message', array('title'=>'Update Badge','content'=>'Data have been successfully edited.','type'=>'successmsgbox'));
                        redirect(base_url()."badge/all/".$data['page']."/");
                      } else {
                        $this->session->set_flashdata('message', array('title'=>'Update Badge','content'=>'Unable to edit data. Please try again.','type'=>'errormsgbox'));
                        redirect('badge/edit/'.$badge_id);
                    }
                
                //} 
	    }else {
                $data['validation_error']=preg_replace('/\s+/', ' ',validation_errors('<p>','</p>'));
                $this->session->set_flashdata('message', array('title'=>'Edit Badge','content'=>$data['validation_error'],'type'=>'errormsgbox'));
                redirect('badge/edit/'.$badge_id);
            }  
	    }
	    $data['return_link'] = base_url()."badge/";
            $this->template->write_view('content','edit_badge',$data);
            $this->template->render();

    }

#########################################################
#                FOR  INSTRUCTOR STATUS CHANGE            #
#                                                       #
#                                                       #
#                                                       #
#########################################################

        function changeStatus($id) {
            $conditionArr           = array('badge_id'=>$id);
            $user_id                = $this->uri->segment(3, 0);
            $data['user_id']        = $user_id;
            $data['page']           = $this->uri->segment(4, 0);
            $checkExist             = $this->model_badge->badgeExistsDB($conditionArr);
            if($checkExist) {
                $this->model_badge->statusChangeBadgeDB($id);
                $this->session->set_flashdata('message', array('title'=>'Badge Status','content'=>'Badge status has been changed','type'=>'successmsgbox'));
                redirect(base_url()."badge/all/".$data['page']);
            }

        }
        
 /* FOR INSTRACTOR DELETE  */
	
	public function delete(){ 
		$data= array();
		$content_id		= $this->uri->segment(3, 0);
		$data['base_url']	= $this->config->item('base_url');
		$data['badge_id']	= $content_id;
		
		$conditionArr= array('badge_id' => $data['badge_id']);
		$badge_exist= $this->model_badge->badgeExistsDB($conditionArr);
		
		if($badge_exist){
			$instractor_data            = $this->model_badge->detailsBadgeDB($conditionArr);
			unlink(FILE_UPLOAD_ABSOLUTE_PATH().'badge_image/'.stripslashes($instractor_data[0]['badge_image']));
			unlink(FILE_UPLOAD_ABSOLUTE_PATH().'badge_image/thumbs/'.stripslashes($instractor_data[0]['badge_image']));
			$delete= $this->model_badge->deleteBadgeDB($conditionArr);
			if($delete){
				$this->session->set_flashdata('message', array('title'=>'Delete Badge','content'=>'Data have been successfully deleted.','type'=>'successmsgbox'));
				redirect(base_url()."badge/all/".$data['page']."/");
			}
			else{
				$this->session->set_flashdata('message', array('title'=>'Delete Badge','content'=>'Unable to delete data. Please try again.','type'=>'errormsgbox'));
				redirect('badge/');
			}
		}
	}

}