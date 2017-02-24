<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Instructor extends MY_Controller {


    var $emailTemplate 	= 'dipp_email_template';
    public function __construct(){
        parent::__construct();
        $this->load->model(array('welcome/model_basic', 'instructor/model_instructor'));
	$this->load->library('form_validation');
        $this->url = base_url().'instructor/';
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
        
        $total_user               = $this->model_instructor->countInstructorDB();
        $data['totalRecord']      = $total_user;
	$data['search_keyword']   = "";
        if($total_user > 0) {
            /********** FOR PAGINATION ***********/
            $config['base_url'] = base_url().'/instructor/all';
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
            $resultArr=$this->model_instructor->allInstructorDB($search_by,PER_PAGE_LISTING,$offset);


            if(count($resultArr) > 0) {
                $num = 1+$offset;
                    foreach($resultArr as $values) {
                    $insId         = $values['instructor_id'];
                    $insStatus     = $values['instructor_status'];
                    $status_class=($insStatus == 'Active')?'label-green':'label-red';    
                    
                    /********** GET GENERATE EDIT AND DELETE LINK ***********/
                    $this->uri_segment = $this->uri->total_segments();
                    $cur_page           = 0;
                    if ($this->uri->segment($this->uri_segment) != 0) {
                        $this->cur_page = $this->uri->segment($this->uri_segment);
                        $cur_page = (int) $this->cur_page;
                    }

                    $edit_link          = base_url()."instructor/edit/".$insId."/".$cur_page."/";
                    $status_link        = base_url()."instructor/changeStatus/".$insId."/".$cur_page;
                    $delete_link        = base_url()."instructor/delete/".$insId."/".$cur_page."/";

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

                $data['instructor_all']        = $total_result;
                /********** FOR PAGINATION ***********/
                $config['cur_tag_open']     = '<span class="current-link">';
                $config['cur_tag_close']    = '</span>';
                $this->pagination->initialize($config);
                $data['paging']             = $this->pagination->create_links();
                $this->template->write_view('content','instructor_list',$data);
                $this->template->render();
                
            }
        } else {
            $this->template->write_view('content', 'norecord_instructor_list.php');
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


        $total_instructor=$this->model_instructor->countInstructorDB($search_by);
        $data['totalRecord']      = $total_instructor;
	$data['search_keyword']   = $search_by;
        if($total_instructor > 0)
        {
            /********** FOR PAGINATION ***********/
            $config['base_url'] = base_url().'/instructor/all';
            $config['per_page'] =10;
            $config['total_rows'] = $total_instructor;
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


            $resultArr=$this->model_instructor->allInstructorDB($search_by,$config['per_page'],$offset);

            if(count($resultArr) > 0) {
                $num    = 1+$offset;
		foreach($resultArr as $values) {
                    $insId         = $values['instructor_id'];
                    $insStatus     = $values['instructor_status'];
                    $status_class=($insStatus == 'Active')?'label-green':'label-red'; 
                    
                    /********** GET GENERATE EDIT AND DELETE LINK ***********/
                    $this->uri_segment = $this->uri->total_segments();
                    $cur_page = 0;
                    if ($this->uri->segment($this->uri_segment) != 0) {
                        $this->cur_page = $this->uri->segment($this->uri_segment);
                        $cur_page = (int) $this->cur_page;
                    }
                    $edit_link          = base_url()."instructor/edit/".$insId."/".$cur_page."/";
                    $status_link        = base_url()."instructor/changeStatus/".$insId."/".$cur_page;
                    $delete_link        = base_url()."instructor/delete/".$insId."/".$cur_page."/";

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

                $data['instructor_all']=$total_result;
                /********** FOR PAGINATION ***********/
                $config['cur_tag_open'] = '<span class="current-link">';
                $config['cur_tag_close'] = '</span>';
                $this->pagination->initialize($config);
                $this->session->unset_userdata('search_str');
                $data['paging'] = $this->pagination->create_links();
                $this->template->write_view('content','instructor_list',$data);
                $this->template->render();
            }
        }
        else
        {
            $this->template->write_view('content', 'norecord_instructor_list.php');
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
        $data['frmAction']                      = base_url()."instructor/add";
	
	$conditionArr               		= array('package_status'=>'Active');
        $data['packageList']        		= $this->model_instructor->packageList($conditionArr);
	$data['courseList']        		= $this->model_instructor->courseList(array('status'=>'Active'));
        $data['validation_error']               = '';
        
        if($this->input->get_post('action') == "Process") {
	    $this->form_validation->set_rules('course_id','Select course','required');
            $this->form_validation->set_rules('instructor_business_name','Business Name','required');
	    $this->form_validation->set_rules('instructor_fname','First Name','required');
	    $this->form_validation->set_rules('instructor_lname','Last Name','required');
	    $this->form_validation->set_rules('instructor_email','Email','required|is_unique[dipp_instructor.instructor_email]');
	    $this->form_validation->set_rules('instructor_password','Password','required');
	    $this->form_validation->set_rules('instructor_phone_number','Phone No','required');
	    $this->form_validation->set_rules('instructor_address','Address','required');
            if ($this->form_validation->run() == TRUE )
            {
		$course_id 			= $this->input->post('course_id');
		$instructor_business_name 	= $this->input->post('instructor_business_name');
		$instructor_fname		= $this->input->post('instructor_fname');
		$instructor_lname		= $this->input->post('instructor_lname');
		$instructor_email		= $this->input->post('instructor_email');
		$instructor_password		= $this->input->post('instructor_password');
		$instructor_phone_number	= $this->input->post('instructor_phone_number');
		$instructor_address		= $this->input->post('instructor_address');
		$package_id			= $this->input->post('package_id');
		
		$whereArr	= array( 'instructor_business_name' => url_title($instructor_business_name, 'dash') );
		$bool 		= $this->model_instructor->instructorExistsDB( $whereArr );
		//pr($bool);
		if($bool){
			 $this->session->set_flashdata('message', array('title'=>'Add Instructor','content'=>'Business name is already exist','type'=>'errormsgbox'));
			redirect(base_url()."instructor/add");
		}else{
		
		$image_name = '';
                $question_image=$_FILES['instructor_logo']['name'];
                if($question_image <> '') {
                    $mainUpload       = $this->imageUpload('instructor_logo','instructor_logo','Y',240,85);
                    $image_name       = $mainUpload['image_name'];
                } 
                
		
                $insertArr      = array(
				    'course_id'			    => $course_id,
                                    'instructor_business_name'      => $instructor_business_name,
				    'instructor_fname'		    => $instructor_fname,
				    'instructor_lname'		    => $instructor_lname,
				    'instructor_email'		    => $instructor_email,
				    'instructor_password'	    => $instructor_password,
				    'instructor_phone_number'	    => $instructor_phone_number,
				    'instructor_address'	    => $instructor_address,
				    'instructor_logo'		    => $image_name,
				    'package_id'		    => $package_id,
                                    'added_on'  		    => date('Y-m-d H:i:s')
                                    );
                $lastId=$this->model_instructor->addInstructorDB($insertArr);
                if($lastId <> '') {
		    $sitesettings 		= $this->model_basic->get_settings(6);
		    $sitename 			= stripslashes($sitesettings['sitename']);
		    $email_template    		= $this->model_basic->detailsDB($this->emailTemplate,'template_id = "5"');
		    $message			= stripslashes(str_replace(array('{INSTRUCTOR_NAME}','{INSTRUCTOR_EMAIL}','{INSTRUCTOR_PASSWORD}','{{SITENAME}}'),array(stripslashes($instructor_fname).' '.$instructor_lname,$instructor_email,$instructor_password,$sitename),$email_template[0]['email_content']));
		    $to 			= trim($user_email);
		    //$to 			= 'nasmin.begam@webskitters.com';
		    $from 			= $email_template[0]['response_email'];
		    $email_subject 		= $email_template[0]['email_subject'];
		    $this->send_mail($from,$sitename,$to,'','',$email_subject,$message);
		    
                    $this->session->set_flashdata('message', array('title'=>'Add Instructor','content'=>'A new Instructor succesfully added','type'=>'successmsgbox'));
                    redirect(base_url()."instructor");
                } else {
                    $this->session->set_flashdata('message', array('title'=>'Add Instructor','content'=>'Unable to add Instructor.please try again','type'=>'errormsgbox'));
                    redirect(base_url()."instructor/add");
                }
		}
            }
            else {
                $data['validation_error']=preg_replace('/\s+/', ' ',validation_errors('<p>','</p>'));
                $this->session->set_flashdata('message', array('title'=>'Add Instructor','content'=>$data['validation_error'],'type'=>'errormsgbox'));
                redirect(base_url()."instructor/add");
             }
        }
	$data['return_link'] = base_url()."instructor/";
        $this->template->write_view('content','add_instructor',$data);
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
            $data['base_url']           = $this->config->item('base_url');
            $instructor_id              = $this->uri->segment(3, 0);
            $data['instructor_id']      = $instructor_id;
            $data['page']               = $this->uri->segment(4, 0);
	    $conditionArr               = array('package_status'=>'Active');
	    $data['packageList']        = $this->model_instructor->packageList($conditionArr);
	    $data['courseList']        	= $this->model_instructor->courseList(array('status'=>'Active'));
            $conditionArr               = array('instructor_id'=>$data['instructor_id']);
            $instructor_exist           = $this->model_instructor->instructorExistsDB($conditionArr);
            if($instructor_id == 0 || !is_numeric($instructor_id) || !$instructor_exist) {
                    redirect('instructor/index');
            }

            $data['instractor_data']            = $this->model_instructor->detailsInstructorDB($conditionArr);
            $data['validation_error']   	= '';
           
            if($this->input->get_post('action') == "Process") {
		$this->form_validation->set_rules('course_id','Select course','required');
                $this->form_validation->set_rules('instructor_business_name','Business Name','required');
		$this->form_validation->set_rules('instructor_fname','First Name','required');
		$this->form_validation->set_rules('instructor_lname','Last Name','required');
		$this->form_validation->set_rules('instructor_phone_number','Phone No','required');
		$this->form_validation->set_rules('instructor_address','Address','required');
                
                if ($this->form_validation->run() == TRUE )
                {
		    $course_id 			= $this->input->post('course_id');
		    $instructor_business_name 	= $this->input->post('instructor_business_name');
		    $instructor_fname		= $this->input->post('instructor_fname');
		    $instructor_lname		= $this->input->post('instructor_lname');
		    $instructor_password	= $this->input->post('instructor_password');
		    $instructor_phone_number	= $this->input->post('instructor_phone_number');
		    $instructor_address		= $this->input->post('instructor_address');
		    $instructor_status		= $this->input->post('instructor_status');
		    $package_id			= $this->input->post('package_id');
		    
		    $whereArr	= array( 'instructor_business_name' => url_title($instructor_business_name, 'dash'),'instructor_id !=' => $instructor_id );
		    $bool 		= $this->model_instructor->instructorExistsDB( $whereArr );
		    //pr($bool);
		    if($bool){
			     $this->session->set_flashdata('message', array('title'=>'Add Instructor','content'=>'Business name is already exist','type'=>'errormsgbox'));
			    redirect(base_url()."instructor/add");
		    }else{
		    $instructor_logo=$_FILES['instructor_logo']['name'];
                    if($instructor_logo <> '') {
		    if(file_exists(FILE_UPLOAD_ABSOLUTE_PATH().'instructor_logo/'.stripslashes($data['instractor_data'][0]['instructor_logo']))){
			unlink(FILE_UPLOAD_ABSOLUTE_PATH().'instructor_logo/'.stripslashes($data['instractor_data'][0]['instructor_logo']));
		    }
		    if(file_exists(FILE_UPLOAD_ABSOLUTE_PATH().'instructor_logo/thumbs/'.stripslashes($data['instractor_data'][0]['instructor_logo']))){
			unlink(FILE_UPLOAD_ABSOLUTE_PATH().'instructor_logo/thumbs/'.stripslashes($data['instractor_data'][0]['instructor_logo']));
		    }
		    
		    
                    $mainUpload       = $this->imageUpload('instructor_logo','instructor_logo','Y',240,85);
                    $image_name       = $mainUpload['image_name'];
                    }
                    else {
                     $image_name       = $data['instractor_data'][0]['instructor_logo'];
                    }
		    
		    
		    $updateArr          	= array('course_id'		    => $course_id,
						    'instructor_business_name'      => $instructor_business_name,
						    'instructor_fname'		    => $instructor_fname,
						    'instructor_lname'		    => $instructor_lname,
						    'instructor_phone_number'	    => $instructor_phone_number,
						    'instructor_address'	    => $instructor_address,
						    'instructor_logo'		    => $image_name,
						    'instructor_status'		    => $instructor_status,
						    'package_id'		    => $package_id);
		    if($instructor_password != ''){
			$updateArr['instructor_password']  = $instructor_password;
		    }
                    $update             = $this->model_instructor->editInstractorDB($updateArr,$conditionArr);
                    if($update) {
                        $this->session->set_flashdata('message', array('title'=>'Update Instractor','content'=>'Data have been successfully edited.','type'=>'successmsgbox'));
                        redirect(base_url()."instructor/all/".$data['page']."/");
                      } else {
                        $this->session->set_flashdata('message', array('title'=>'Update Instractor','content'=>'Unable to edit data. Please try again.','type'=>'errormsgbox'));
                        redirect('instructor/edit/'.$instructor_id);
                    }
                
                } 
	    }else {
                $data['validation_error']=preg_replace('/\s+/', ' ',validation_errors('<p>','</p>'));
                $this->session->set_flashdata('message', array('title'=>'Edit Instractor','content'=>$data['validation_error'],'type'=>'errormsgbox'));
                redirect('instructor/edit/'.$instructor_id);
            }  
	    }
	    $data['return_link'] = base_url()."instructor/";
            $this->template->write_view('content','edit_instructor',$data);
            $this->template->render();

    }

#########################################################
#                FOR  INSTRUCTOR STATUS CHANGE            #
#                                                       #
#                                                       #
#                                                       #
#########################################################

        function changeStatus($id) {
            $conditionArr           = array('instructor_id'=>$id);
            $user_id                = $this->uri->segment(3, 0);
            $data['user_id']        = $user_id;
            $data['page']           = $this->uri->segment(4, 0);
            $checkExist             = $this->model_instructor->instructorExistsDB($conditionArr);
            if($checkExist) {
                $this->model_instructor->statusChangeInstructorDB($id);
                $this->session->set_flashdata('message', array('title'=>'Instractor Status','content'=>'Instractor status has been changed','type'=>'successmsgbox'));
                redirect(base_url()."instructor/all/".$data['page']);
            }

        }
        
 /* FOR INSTRACTOR DELETE  */
	
	public function delete(){ 
		$data= array();
		$content_id		= $this->uri->segment(3, 0);
                $data['page']           = $this->uri->segment(4, 0);
                $data['base_url']	= $this->config->item('base_url');
		$data['instructor_id']	= $content_id;
		
		$conditionArr= array('instructor_id' => $data['instructor_id']);
		$instructor_exist= $this->model_instructor->instructorExistsDB($conditionArr);
		
		if($instructor_exist){
			$instractor_data            = $this->model_instructor->detailsInstructorDB($conditionArr);
			unlink(FILE_UPLOAD_ABSOLUTE_PATH().'instructor_logo/'.stripslashes($instractor_data[0]['instructor_logo']));
			unlink(FILE_UPLOAD_ABSOLUTE_PATH().'instructor_logo/thumbs/'.stripslashes($instractor_data[0]['instructor_logo']));
			$delete= $this->model_instructor->deleteInstructorDB($conditionArr);
			if($delete){
				$this->session->set_flashdata('message', array('title'=>'Delete Instractor','content'=>'Data have been successfully deleted.','type'=>'successmsgbox'));
				redirect(base_url()."instructor/all/".$data['page']."/");
			}
			else{
				$this->session->set_flashdata('message', array('title'=>'Delete Instractor','content'=>'Unable to delete data. Please try again.','type'=>'errormsgbox'));
				redirect('instructor/');
			}
		}
	}

     /* FOR INSTRACTOR BANNER ADD  */
    public function banner_add() {
        $this->getTemplate();
        $data                                   = array();
        $data['base_url']                       = $this->config->item('base_url');
        $data['frmAction']                      = base_url()."instructor/banner_add";
        $data['topic_name']                     = '';
        $data['validation_error']               = '';


        if($this->input->get_post('action') == "Process") {
            $this->form_validation->set_rules('banner_title','Title','required');
            $data['banner_title']  = addslashes(trim($this->input->get_post('banner_title')));
            $data['banner_description']  = addslashes(trim($this->input->get_post('banner_description')));
            if ($this->form_validation->run() == TRUE )
                {
                   $f_type=$_FILES['banner_image']['type'];
                  if ($f_type== "image/gif" OR $f_type== "image/png" OR $f_type== "image/jpeg" OR $f_type== "image/JPEG" OR $f_type== "image/PNG" OR $f_type== "image/GIF")
                  {
                    $banner_image=$_FILES['banner_image']['name'];
                    if($banner_image <> '') {
                        $mainUpload       = $this->imageUpload('banner_image','instructor_banner','Y',150,100);
                        $image_name       = $mainUpload['image_name'];
                      
                    } 
                    
                    $insertArr      = array(
                                        'banner_title'              => $data['banner_title'],
                                        'banner_image'              => $image_name,
                                        'banner_description'        => $data['banner_description'],
                                        );
                    //pr($insertArr);
                    $lastId=$this->model_instructor->addInstructorBannerDB($insertArr);
                  }
                else {
                    $this->session->set_flashdata('message', array('title'=>'Add Topic','content'=>'Please upload only image file','type'=>'errormsgbox'));
                    redirect(base_url()."instructor/banner_add");
                }
                if($lastId <> '') {
                    $this->session->set_flashdata('message', array('title'=>'Add Instructor Banner','content'=>'A new Instructor Banner succesfully added','type'=>'successmsgbox'));
                    redirect(base_url()."instructor/banner");
                } else {
                    $this->session->set_flashdata('message', array('title'=>'Add Topic','content'=>'Unable to add Instructor Banner.please try again','type'=>'errormsgbox'));
                    redirect(base_url()."instructor/banner_add");
                }
            }
            else {
                $data['validation_error']=validation_errors();
                $this->session->set_flashdata('message', array('title'=>'Add Topic','content'=>$data['validation_error'],'type'=>'errormsgbox'));
                redirect(base_url()."instructor/banner_add");
             }
        }
 
        
     
        $data['return_link'] = base_url()."instructor/";
        $this->template->write_view('content','add_banner',$data);
        $this->template->render();
        
    }
/* FOR INSTRACTOR BANNER EDIT  */
    public function banner_edit() {
        $this->getTemplate();
        $data                                   = array();
        $data['base_url']                       = $this->config->item('base_url');
        $data['frmAction']                      = base_url()."instructor/banner_edit";
        $data['topic_name']                     = '';
        $data['validation_error']               = '';

         $banner_id = $this->uri->segment(3); 
         $conditionArr               = array('banner_id'=>$banner_id);
         $advertisement_data                = $this->model_instructor->detailsInstructorBannerDB($conditionArr);
         $data['banner_id']                 = $banner_id;
         $data['banner_image']              = stripslashes($advertisement_data[0]['banner_image']);
         $data['banner_title']              = stripslashes($advertisement_data[0]['banner_title']);
         $data['banner_description']        = stripslashes($advertisement_data[0]['banner_description']);
         $data['status']                    = stripslashes($advertisement_data[0]['status']);
        if($this->input->get_post('action') == "Process") {
            $this->form_validation->set_rules('banner_title','Title','required');
            $data['banner_title']  = addslashes(trim($this->input->get_post('banner_title')));
            $data['banner_description']  = addslashes(trim($this->input->get_post('banner_description')));
            $data['status']  = addslashes(trim($this->input->get_post('status')));
            if ($this->form_validation->run() == TRUE )
            {
                
                $banner_image=$_FILES['banner_image']['name'];
                if($banner_image <> '') {
                    $mainUpload       = $this->imageUpload('banner_image','instructor_banner','Y',150,100);
                    $image_name       = $mainUpload['image_name'];
                    unlink(FILE_UPLOAD_ABSOLUTE_PATH().'instructor_banner/'.stripslashes($data['banner_image']));
                    unlink(FILE_UPLOAD_ABSOLUTE_PATH().'instructor_banner/thumbs/'.stripslashes($data['banner_image']));    
                } 
                else {
                       $image_name       =  $data['banner_image'];
                    }
                $updateArr      = array(
                                    'banner_title'              => $data['banner_title'],
                                    'banner_image'              => $image_name,
                                    'banner_description'        => $data['banner_description'],
                                    'status'                   => $data['status'],
                                    );
                //pr($insertArr);
                $conditionAr               = array('banner_id'=>$banner_id);
                $lastId=$this->model_instructor->editInstructorBannerDB($updateArr,$conditionAr);
                if($lastId <> '') {
                    $this->session->set_flashdata('message', array('title'=>'Edit Instructor Banner','content'=>'Instructor Banner succesfully updated','type'=>'successmsgbox'));
                    redirect(base_url()."instructor/banner");
                } else {
                    $this->session->set_flashdata('message', array('title'=>'Edit Instructor Banner','content'=>'Unable to update Instructor Banner.please try again','type'=>'errormsgbox'));
                    redirect(base_url()."instructor/banner_add");
                }
            }
            else {
                $data['validation_error']=validation_errors();
                $this->session->set_flashdata('message', array('title'=>'Edit Instructor Banner','content'=>$data['validation_error'],'type'=>'errormsgbox'));
                redirect(base_url()."instructor/banner_edit");
             }
        }
 
        
     
        $data['return_link'] = base_url()."instructor/banner";
        $this->template->write_view('content','edit_banner',$data);
        $this->template->render();
        
    }
/* FOR INSTRACTOR BANNER LIST*/

public function banner()
{

        $this->getTemplate();
        $total_instructor_banner      = $this->model_instructor->noInstructorBannerDB();
        $data['totalRecord']      = $total_instructor_banner;
        $data['per_page']         = PER_PAGE_LISTING;
        $start                    = 0;
        $data['startRecord']      = $start;
        $data['page']             = $this->uri->segment(3);
        $data['search_keyword']   = "";
    
    if($total_instructor_banner > 0) 
    {
            /********** FOR PAGINATION ***********/
            $config['base_url'] = base_url().'/instructor/banner';
            $config['per_page'] = PER_PAGE_LISTING;
            $config['total_rows'] = $total_instructor_banner;
            if($this->uri->segment(3)) 
            {
                $config['uri_segment'] = 3;
                if(!is_numeric($this->uri->segment(3)))
                 {
                    $offset=0;
                  } else
                   {
                     $offset=abs(ceil($this->uri->segment(3)));
                   }
            } 
            else 
            {
                $offset=0;
            }
            $search_by ='';
            $resultArr=$this->model_instructor->allInstructorBannerDB(PER_PAGE_LISTING,$offset);
           
                
                $data['result_all']        = $resultArr;

                //print_r($data['result_all']); die;
                /********** FOR PAGINATION ***********/
                $config['cur_tag_open']     = '<span class="current-link">';
                $config['cur_tag_close']    = '</span>';
                $this->pagination->initialize($config);
                $data['paging']             = $this->pagination->create_links();
                $this->template->write_view('content','banner_list',$data);
                $this->template->render();
                
    }
     else {
            $this->template->write_view('content', 'norecord_instructor_banner_list.php');
            $this->template->render();
         }
 }
  /* FOR INSTRACTOR BANNER DELETE  */
    
    public function banner_delete(){ 
        $data= array();
         $content_id     = $this->uri->segment(3);
         $conditionArr               = array('banner_id'=>$content_id);
         $banner_data                = $this->model_instructor->detailsInstructorBannerDB($conditionArr);
         $data['banner_image']           = stripslashes($banner_data[0]['banner_image']);
        unlink(FILE_UPLOAD_ABSOLUTE_PATH().'instructor_banner/'.stripslashes($data['banner_image']));
        unlink(FILE_UPLOAD_ABSOLUTE_PATH().'instructor_banner/thumbs/'.stripslashes($data['banner_image'])); 
        $conditionArr= array('banner_id' => $content_id);
        $delete= $this->model_instructor->deleteInstructorBannerDB($conditionArr);
            if($delete)
            {
                $this->session->set_flashdata('message', array('title'=>'Delete Instractor Banner','content'=>'Data have been successfully deleted.','type'=>'successmsgbox'));
                redirect(base_url()."instructor/banner/".$data['page']."/");
            }
            else
            {
                $this->session->set_flashdata('message', array('title'=>'Delete Instractor Banner','content'=>'Unable to delete data. Please try again.','type'=>'errormsgbox'));
                redirect('instructor/banner');
            }
        }
/* FOR INSTRACTOR BANNER SEARCH */
 public function banner_search()
 {

        $this->getTemplate();
        $data['per_page']         = PER_PAGE_LISTING;
        $start                    = 0;
        $data['startRecord']      = $start;
        $data['page']             = $this->uri->segment(3);
        /********** FOR CATEGORY SEARCH ***********/
        $search_by ='';
        if($this->input->get_post('action') == "Process")
        {
           $search_by = $this->input->get_post('search_str');
           $resultArr=$this->model_instructor->searchInstructorBannerDB($search_by);
            if(count($resultArr) > 0) 
            {
                $data['search_by']        = $search_by;
                $data['result_all']        = $resultArr;
                $this->template->write_view('content','search_instructor_banner_list',$data);
                $this->template->render();
            }
            else
           {
               $this->template->write_view('content', 'norecord_instructor_banner_list.php');
               $this->template->render();
           }
        }
  }

}