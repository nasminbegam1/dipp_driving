<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Student extends MY_Controller {
    
    public function __construct()
    {
	parent::__construct();
	$this->load->model(array('model_student','welcome/model_basic','learn/model_mocktest'));
	$this->load->library('form_validation');
	$this->url = base_url().'student/';
    }

    /**
    *
    * @Frontend landing page
    *
    *
    */
    public function dashboard()
    {
	$this->chk_student_login();
	$data=array();
	$this->getTemplate();
        $this->template->write_view('content', 'student/dashboard', $data);
        $this->template->render();
    }
    
   
    public function logout() {
        $this->session->sess_destroy();
        redirect(base_url());
    }
    
/**Edit Profile **/
    public function editProfile(){
	$this->chk_student_login();
	$student_id 		= $this->session->userdata('STUDENT_ID');
	$data 	 		= array();
	$data['std_details'] 	= $this->model_basic->detailsDB(STUDENT,'student_status = "Active" AND student_id='.$student_id.'');
	if($this->input->post('action') =='Process')
	{
	    $this->form_validation->set_rules('student_fname','Student first name','required|trim');
	    $this->form_validation->set_rules('student_lname','Student last name','required|trim');
	
		if ($this->form_validation->run() == FALSE)
		{				
		    $data['validation_error']=validation_errors();
		    $this->session->set_flashdata('message', array('title'=>'Student','content'=>$data['validation_error'],'type'=>'errormsgbox'));
		    redirect(base_url().'student/editProfile/');
		}
		else
		{
		    $update_arr = array( 
				    'student_fname'		=>addslashes(trim($this->input->post('student_fname'))),
				    'student_lname'		=>addslashes(trim($this->input->post('student_lname'))),
				    'student_phone'		=>addslashes(trim($this->input->post('student_phone'))),
				    );
		    $res1=$this->model_basic->editDB(STUDENT,$update_arr,array('student_id'=>$student_id));
		    $this->session->set_userdata('STUDENT_FNAME', $this->input->post('student_fname'));
		    $this->session->set_flashdata('message', array('title'=>'User login','content'=>'Profile Updated Successfully','type'=>'successmsgbox'));
		    redirect(base_url().'student/editProfile/');
		}
	}
	$this->getTemplate();
        $this->template->write_view('content', 'student/editProfile', $data);
        $this->template->render();
    }
/************Change Password ************/
    public function changePassword(){
	$this->chk_student_login();
	$student_id 		= $this->session->userdata('STUDENT_ID');
	$data 	 		= array();
	if($this->input->post('action') =='Process')
	{
	    $this->form_validation->set_rules('current_password','Current Password','required|trim');
	    $this->form_validation->set_rules('new_password','New Password','required|trim|matches[confirm_password]');
	    $this->form_validation->set_rules('confirm_password','Confirm Password','required|trim');
	
	    if ($this->form_validation->run() == FALSE)
	    {				
		$data['validation_error']=validation_errors();
		$this->session->set_flashdata('message', array('title'=>'User','content'=>$data['validation_error'],'type'=>'errormsgbox'));
		redirect(base_url().'student/changePassword/');
	    }
	    else
	    {
		$std_details 	= $this->model_basic->detailsDB(STUDENT,'student_status = "Active" AND student_id='.$student_id.'');
		$current_password = $this->input->post('current_password');
		$new_password = $this->input->post('new_password');
		$confirm_password = $this->input->post('confirm_password');
		if($std_details[0]['student_password'] != $current_password){
		    $this->session->set_flashdata('message', array('title'=>'Student','content'=>'Please enter correct password','type'=>'errormsgbox'));
		}else{
		$update_arr 	= array('student_password'=>$new_password);
		
		$this->model_basic->editDB(STUDENT,$update_arr,array('student_id'=>$student_id));
		$this->session->set_flashdata('message', array('title'=>'Student','content'=>'Password changed Successfully!','type'=>'successmsgbox'));
		}
		redirect(base_url().'student/changePassword/');
	    }
	}
	$this->getTemplate();
        $this->template->write_view('content', 'student/changePassword', $data);
        $this->template->render();
    }

/********Forgot password send email******************/
    public function forgotPassword(){
	$this->chk_not_login();
	$data = array();
	if($this->input->post('action') =='Process')
	{
	    $this->form_validation->set_rules('student_email','Email address','required|trim|email');
	
	    if ($this->form_validation->run() == FALSE)
	    {				
		$data['validation_error']=validation_errors();
		$this->session->set_flashdata('forgot_message', array('title'=>'Student','content'=>$data['validation_error'],'type'=>'errormsgbox'));
		redirect(base_url().'student/forgotPassword/');
	    }
	    else
	    {
		$student_email 	= $this->input->post('student_email');
		$is_exsist 	= $this->model_basic->detailsDB(STUDENT,'student_email = "'.$student_email.'" AND student_status = "Active"');
		if(is_array($is_exsist) && count($is_exsist)>0)
		{
		    $sitesettings 		= $this->model_basic->get_settings(6);
		    $sitename 			= stripslashes($sitesettings['sitename']);
		    $link	    		= FRONTEND_URL.'student/resetPassword/'.md5($student_email);
		    $email_template    		= $this->model_basic->detailsDB(EMAIL_TEMPLATE,'template_id = "1"');
		    $message			= stripslashes(str_replace(array('{{USERFNAME}}','{{RESET_LINK}}','{{SITENAME}}'),array(stripslashes($is_exsist[0]['student_fname']),$link,$sitename),stripslashes($email_template[0]['email_content'])));
		    $to 			= trim($student_email);
		    //$to 			= 'nasmin.begam@webskitters.com';
		    $from 			= $email_template[0]['response_email'];
		    $email_subject 		= $email_template[0]['email_subject'];
		    $this->send_mail($from,$sitename,$to,'','',$email_subject,$message);
		    $this->session->set_flashdata('forgot_message', array('title'=>'Student','content'=>'Please check your email to reset password','type'=>'successmsgbox'));
		}else{
		    $this->session->set_flashdata('forgot_message', array('title'=>'Student','content'=>'Could not found the email in our site.Please check the email.','type'=>'errormsgbox'));
		}
		redirect(base_url().'student/forgotPassword/');
	    }
	}
	$this->getTemplate();
        $this->template->write_view('content', 'student/forgotPassword', $data);
        $this->template->render();
    }
/******************Reset Password ****************************/
    public function resetPassword(){
	$this->chk_not_login();
	$data	= array();
	$student_email		= $this->uri->segment(3);
	$data['std_details'] 	= $this->model_basic->detailsDB(STUDENT,'md5(student_email) = "'.$student_email.'"');
	if($this->input->post('action') =='Process')
	{
	    if(count($data['std_details'])>0 && is_array($data['std_details'])){
		$this->form_validation->set_rules('new_password','New Password','required|trim|matches[confirm_password]');
		$this->form_validation->set_rules('confirm_password','Confirm Password','required|trim');
	    
		if ($this->form_validation->run() == FALSE)
		{				
		    $data['validation_error']=validation_errors();
		    $this->session->set_flashdata('forgot_message', array('title'=>'Student','content'=>$data['validation_error'],'type'=>'errormsgbox'));
		    redirect(base_url().'student/resetPassword/'.$student_email);
		}
		else
		{
		    $new_password 		= $this->input->post('new_password');
		    $confirm_password 		= $this->input->post('confirm_password');
		    $update_arr 		= array('student_password'=>$new_password);
		    
		    $this->model_basic->editDB(STUDENT,$update_arr,array('student_id'=>$data['std_details'][0]['student_id']));
		    $this->session->set_flashdata('forgot_message', array('title'=>'Student login','content'=>'Password changed Successfully!','type'=>'successmsgbox')); 
		}
	    }else{
		$this->session->set_flashdata('forgot_message', array('title'=>'Student','content'=>'You are not a Student.Please register your email address','type'=>'errormsgbox'));
	    }
	    redirect(base_url().'student/resetPassword/'.$student_email);
	}
	$this->getTemplate();
        $this->template->write_view('content', 'student/resetPassword', $data);
        $this->template->render();
    }
    
    public function all_list() { 
        $this->chk_ins_login();
        $data['per_page']         = 3;
	$start                    = 0;
        $data['startRecord']      = $start;
	$data['page']             = $this->uri->segment(3);
        $instructor_id 		  = $this->session->userdata('INSTRUCTOR_ID');
        $total_student            = $this->model_student->countStudentDB(array('SM.instructor_id'=>$instructor_id));
        $data['totalRecord']      = $total_student;
	
	$data['student_no'] 	  = $this->model_student->instractorDetails(array('INS.instructor_id'=>$instructor_id));
	
	$data['search_keyword']   = "";
        if($total_student > 0) {
            /********** FOR PAGINATION ***********/
            $config['base_url'] = base_url().'/'.$this->session->userdata('INSTRUCTOR_BUSINESS_NAME').'/all_list';
            $config['per_page'] = $data['per_page'];
            $config['total_rows'] = $total_student;
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
            $resultArr=$this->model_student->allStudentDB($data['per_page'],$offset,array('SM.instructor_id'=>$instructor_id));
            //pr($resultArr);

            if(count($resultArr) > 0) {
                $num = 1+$offset;
                    foreach($resultArr as $values) {
                    $student_id          = $values['student_id'];
                    /********** GET GENERATE EDIT AND DELETE LINK ***********/
                    $this->uri_segment = $this->uri->total_segments();
                    $cur_page           = 0;
                    if ($this->uri->segment($this->uri_segment) != 0) {
                        $this->cur_page = $this->uri->segment($this->uri_segment);
                        $cur_page = (int) $this->cur_page;
                    }

                    $edit_link          = base_url().$this->session->userdata('INSTRUCTOR_BUSINESS_NAME')."/edit/".$student_id."/".$cur_page."/";
                    $delete_link        = base_url()."student/delete/".$student_id."/".$cur_page."/";
		    $cancel_link        = base_url().$this->session->userdata('INSTRUCTOR_BUSINESS_NAME')."/cancel/".$student_id."/".$cur_page."/";
                    $total_result[]     = array_merge($values,
                                                        array(
                                                            'slno'              => $num,
                                                            'edit_link'         => $edit_link,
							    'delete_link'	=> $delete_link,
							    'cancel_link'	=> $cancel_link
                                                            )
                                            );
                    $num++;
                }

                $data['student_all']        = $total_result;
                /********** FOR PAGINATION ***********/
                $config['cur_tag_open']     = '<span class="current-link">';
                $config['cur_tag_close']    = '</span>';
                $this->pagination->initialize($config);
                $data['paging']             = $this->pagination->create_links();

		$this->getTemplate();
		$this->template->write_view('content', 'student/student_list', $data);
		$this->template->render();
                
            }
        } else {
	    $this->getTemplate();
            $this->template->write_view('content', 'student/norecord_student_list',$data);
            $this->template->render();
         }
    }
    
    public function add() {
	$this->chk_ins_login();
        $data                     = array();
	$instructor_id 		  = $this->session->userdata('INSTRUCTOR_ID');
	$total_student            = $this->model_student->countStudentDB(array('SM.instructor_id'=>$instructor_id));
	$student_no 	          = $this->model_student->instractorDetails(array('instructor_id'=>$instructor_id));
	if($total_student>$student_no->no_student){
	    $this->session->set_flashdata('message', array('title'=>'Add Student','content'=>'Can not add student','type'=>'errormsgbox'));
	    redirect(base_url().$this->session->userdata('INSTRUCTOR_BUSINESS_NAME')."/all_list/");
	}
        if($this->input->get_post('action') == "Process") {
            $this->form_validation->set_rules('student_fname','First Name','required');
            $this->form_validation->set_rules('student_lname','Last Name','required');
            $this->form_validation->set_rules('student_email','Email','required|valid_email|is_unique['.STUDENT.'.student_email]');
            
            $password                   = $this->model_student->generatePassword();
            $data['student_fname']      = addslashes(trim($this->input->get_post('student_fname')));
            $data['student_lname']      = addslashes(trim($this->input->get_post('student_lname')));
            $data['student_email']      = trim($this->input->get_post('student_email'));
            $data['student_phone']      = trim($this->input->get_post('student_phone'));
            $data['student_password']   = $password;
            $data['student_status']     = "Active";
            
            $instructor_details         = $this->model_student->detailsInstructorDB(array('instructor_id'=>$instructor_id));
            $instructor_business_name   = stripslashes($instructor_details[0]['instructor_business_name']);
            $data['student_username']   = $instructor_business_name;
           
            if ($this->form_validation->run() == TRUE )
            {
                $insertArr      = array(
                                    'instructor_id'      => $instructor_id,
                                    'student_fname'      => $data['student_fname'],
                                    'student_lname'      => $data['student_lname'],
                                    'student_username'   => $data['student_username'],
                                    'student_email'      => $data['student_email'],
                                    'student_phone'      => $data['student_phone'],
                                    'student_password'   => $data['student_password'],
                                    'student_status'     => $data['student_status'],
                                    'added_on'           => date('Y-m-d H:i:s')
                                    );
                //pr($insertArr);
                $lastId=$this->model_student->addStudentDB($insertArr);
                if($lastId <> '') {
                    
                    $student_full_name = $data['student_fname']." ".$data['student_lname'];
                    $sitesettings 	= $this->model_basic->get_settings(6);
		    $sitename 		= stripslashes($sitesettings['sitename']);
                    
                    // For send mail to Student //
                    $email_template   = $this->model_basic->detailsDB('dipp_email_template','template_id = "2"');
                    $mailBody         = $email_template[0]['email_content'];
                    

                    $org_arr          = array('{USER}','{INSTRUCTOR}','{BUSINESSNAME}','{EMAIL_ADDRESS}','{PASSWORD}','{SITENAME}');
                    $replace_arr      = array($student_full_name,$instructor_business_name,$data['student_username'],$data['student_email'],$data['student_password'],$sitename);
                    $message          = str_replace($org_arr,$replace_arr,$mailBody);
                    $to               = $data['student_email'];
                    $from             = $email_template[0]['response_email'];
		    $email_subject    = $email_template[0]['email_subject'];
                    
                     $this->send_mail($from,$sitename,$to,'','',$email_subject,$message);
                    // For send mail to Student //
                    
                    
                    
                    $this->session->set_flashdata('message', array('title'=>'Add Student','content'=>'A new student succesfully added','type'=>'successmsgbox'));
                    redirect(base_url().$this->session->userdata('INSTRUCTOR_BUSINESS_NAME')."/all_list");
                } else {
                    $this->session->set_flashdata('message', array('title'=>'Add Student','content'=>'Unable to add student.please try again','type'=>'errormsgbox'));
                    redirect(base_url().$this->session->userdata('INSTRUCTOR_BUSINESS_NAME')."/add");
                }
            }
            else {
                $data['validation_error']=validation_errors();
                $this->session->set_flashdata('message', array('title'=>'Add Student','content'=>$data['validation_error'],'type'=>'errormsgbox'));
                redirect(base_url().$this->session->userdata('INSTRUCTOR_BUSINESS_NAME')."/add");
             }
        }
        $data['return_link'] = base_url().$this->session->userdata('INSTRUCTOR_BUSINESS_NAME')."/all_list";
	$this->getTemplate();
        $this->template->write_view('content','add_student',$data);
        $this->template->render();
        
    }

    //Edit student
   
    public function edit() {
	 $this->chk_ins_login();
	 $data=array();
	 $instructor_id 	     = $this->session->userdata('INSTRUCTOR_ID');
	 $student_id                 = $this->uri->segment(3, 0);
	 $data['student_id']         = $student_id;
	 $conditionArr               = array('student_id'=>$data['student_id']);
	 $data['page']               = $this->uri->segment(4, 0);
	 $student_exist              = $this->model_student->studentExistsDB($conditionArr);
	 if($student_id == 0 || !is_numeric($student_id) || !$student_exist) {
		 redirect('student/all_list');
	 }

	 $student_data               = $this->model_student->detailsStudentDB($conditionArr);
	 $data['student_fname']      = stripslashes($student_data[0]['student_fname']);
	 $data['student_lname']      = stripslashes($student_data[0]['student_lname']);
	 $data['student_email']      = $student_data[0]['student_email'];
	 $data['student_phone']      = $student_data[0]['student_phone'];
	 $data['instructor_id']      = $student_data[0]['instructor_id'];
	 $data['student_status']     = $student_data[0]['student_status'];
	 $data['validation_error']   = '';
	 
	 /***************** For Instructor Dropdown *******************/
	 $statusArray = array('Active'=>'Active','Inactive'=>'Inactive');
	 $data['statusOption'] = $statusArray;
	     
	 /********************************************************/    
	     
	
	 if($this->input->get_post('action') == "Process") {
	     
	     $this->form_validation->set_rules('student_fname','First Name','required');
	     $this->form_validation->set_rules('student_lname','Last Name','required');
	     $this->form_validation->set_rules('student_email','Email','required|valid_email');
	     
	     $data['student_fname']      = addslashes(trim($this->input->get_post('student_fname')));
	     $data['student_lname']      = addslashes(trim($this->input->get_post('student_lname')));
	     $data['student_email']      = trim($this->input->get_post('student_email'));
	     $data['student_phone']      = trim($this->input->get_post('student_phone'));
	     
	     if ($this->form_validation->run() == TRUE )
	     {
		 $updateArr      = array(
				 'instructor_id'      => $instructor_id,
				 'student_fname'      => $data['student_fname'],
				 'student_lname'      => $data['student_lname'],
				 'student_email'      => $data['student_email'],
				 'student_phone'      => $data['student_phone'],
				 'updated_on'         => date('Y-m-d H:i:s')
				 );

		 $update = $this->model_student->editStudentDB($updateArr,$conditionArr);
		 if($update) {
		     $this->session->set_flashdata('message', array('title'=>'Update Student','content'=>'Data have been successfully edited.','type'=>'successmsgbox'));
		     redirect(base_url().$this->session->userdata('INSTRUCTOR_BUSINESS_NAME')."/all_list/".$data['page']."/");
		   } else {
		     $this->session->set_flashdata('message', array('title'=>'Update Student','content'=>'Unable to edit data. Please try again.','type'=>'errormsgbox'));
		     redirect(base_url().$this->session->userdata('INSTRUCTOR_BUSINESS_NAME').'/edit/'.$student_id);
		 }
	     
	     } 
	  else {
	     $data['validation_error']=validation_errors();
	     $this->session->set_flashdata('message', array('title'=>'Edit Student','content'=>$data['validation_error'],'type'=>'errormsgbox'));
	     redirect(base_url().$this->session->userdata('INSTRUCTOR_BUSINESS_NAME').'/edit/'.$student_id);
	  }
	     
	 }
	 $data['return_link'] = base_url().$this->session->userdata('INSTRUCTOR_BUSINESS_NAME')."/all_list";
	 $this->getTemplate();
	 $this->template->write_view('content','student/edit_student',$data);
	 $this->template->render();
	 
    }

    /* FOR INSTRACTOR DELETE  */
	
    public function delete(){
	$this->chk_ins_login();
	    $data= array();
	    $content_id			= $this->uri->segment(3, 0);
	    $data['student_id']		= $content_id;
	    
	    $conditionArr		= array('student_id' => $data['student_id']);
	    $student_exist		= $this->model_student->studentExistsDB($conditionArr);
	    
	    if($student_exist){
		    $delete= $this->model_student->deleteStudentDB($conditionArr);
		    if($delete){
			    $this->session->set_flashdata('message', array('title'=>'Delete Student','content'=>'Data have been successfully deleted.','type'=>'successmsgbox'));
			    redirect(base_url().$this->session->userdata('INSTRUCTOR_BUSINESS_NAME')."/all_list/");
		    }
		    else{
			    $this->session->set_flashdata('message', array('title'=>'Delete Student','content'=>'Unable to delete data. Please try again.','type'=>'errormsgbox'));
			    redirect(base_url().$this->session->userdata('INSTRUCTOR_BUSINESS_NAME').'/all_list/');
		    }
	    }
    }
    
    public function cancel(){
	$this->chk_ins_login();
	$data= array();
	$content_id			= $this->uri->segment(3, 0);
	$data['student_id']		= $content_id;
	
	$conditionArr			= array('student_id' => $data['student_id']);
	
	$updateArr      		= array('student_status' => 'Inactive');

	$update 			= $this->model_student->editStudentDB($updateArr,$conditionArr);
		 
	if($update){
		$this->session->set_flashdata('message', array('title'=>'Cancel Student','content'=>'User access cancelled','type'=>'successmsgbox'));
		redirect(base_url().$this->session->userdata('INSTRUCTOR_BUSINESS_NAME')."/all_list/");
	}
	else{
		$this->session->set_flashdata('message', array('title'=>'Cancel Student','content'=>'Unable to cancel user. Please try again.','type'=>'errormsgbox'));
		redirect(base_url().$this->session->userdata('INSTRUCTOR_BUSINESS_NAME').'/all_list');
	}
    }
    public function active_users() { 
        $this->chk_ins_login();
        $data['per_page']         = 3;
	$start                    = 0;
        $data['startRecord']      = $start;
	$data['page']             = $this->uri->segment(3);
        $instructor_id 		  = $this->session->userdata('INSTRUCTOR_ID');
        $total_student            = $this->model_student->countStudentDB(array('SM.instructor_id'=>$instructor_id,'SM.student_status'=>'Active'));
        
        $data['totalRecord']      = $total_student;
	$data['search_keyword']   = "";
        if($total_student > 0) {
            /********** FOR PAGINATION ***********/
            $config['base_url'] = base_url().'/'.$this->session->userdata('INSTRUCTOR_BUSINESS_NAME').'/active_users';
            $config['per_page'] = $data['per_page'];
            $config['total_rows'] = $total_student;
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
            $resultArr=$this->model_student->allStudentDB($data['per_page'],$offset,array('SM.instructor_id'=>$instructor_id,'SM.student_status'=>'Active'));
            //pr($resultArr);

            if(count($resultArr) > 0) {
                $data['student_all']        = $resultArr;
                /********** FOR PAGINATION ***********/
                $config['cur_tag_open']     = '<span class="current-link">';
                $config['cur_tag_close']    = '</span>';
                $this->pagination->initialize($config);
                $data['paging']             = $this->pagination->create_links();

		$this->getTemplate();
		$this->template->write_view('content', 'student/active_student_list', $data);
		$this->template->render();
                
            }
        } else {
	    $this->getTemplate();
            $this->template->write_view('content', 'student/norecord_active_student_list',$data);
            $this->template->render();
         }
    }
    
    public function past_users() { 
        $this->chk_ins_login();
        $data['per_page']         = 3;
	$start                    = 0;
        $data['startRecord']      = $start;
	$data['page']             = $this->uri->segment(3);
        $instructor_id 		  = $this->session->userdata('INSTRUCTOR_ID');
        $total_student            = $this->model_student->countStudentDB(array('SM.instructor_id'=>$instructor_id,'SM.student_status'=>'Inactive'));
        
        $data['totalRecord']      = $total_student;
	$data['search_keyword']   = "";
        if($total_student > 0) {
            /********** FOR PAGINATION ***********/
            $config['base_url'] = base_url().'/'.$this->session->userdata('INSTRUCTOR_BUSINESS_NAME').'/past_users';
            $config['per_page'] = $data['per_page'];
            $config['total_rows'] = $total_student;
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
            $resultArr=$this->model_student->allStudentDB($data['per_page'],$offset,array('SM.instructor_id'=>$instructor_id,'SM.student_status'=>'Inactive'));
            //pr($resultArr);
	    if(count($resultArr) > 0) {
                $data['student_all']        = $resultArr;
                /********** FOR PAGINATION ***********/
                $config['cur_tag_open']     = '<span class="current-link">';
                $config['cur_tag_close']    = '</span>';
                $this->pagination->initialize($config);
                $data['paging']             = $this->pagination->create_links();

		$this->getTemplate();
		$this->template->write_view('content', 'student/past_student_list', $data);
		$this->template->render();
                
            }
        } else {
	    $this->getTemplate();
            $this->template->write_view('content', 'student/norecord_active_student_list',$data);
            $this->template->render();
         }
    }

    
    public function report(){
	$this->chk_ins_login();
	$student_id 		    = $this->uri->segment(3);
	//$student_id = 8;
	$conditionArr               = array('student_id'=>$student_id);
	$student_exist              = $this->model_student->studentExistsDB($conditionArr);
	if($student_id == 0 || !is_numeric($student_id) || !$student_exist) {
		redirect('/');
	}
	$data['student']            = $this->model_student->detailsStudentDB($conditionArr);
	$data['course_details']     = $this->model_basic->getCourseId(array('ST.student_id'=>$student_id));
	$last_test		    = $this->model_student->getLastDate($student_id);
	$data['last_test']     	    = (isset($last_test['date'])?$last_test['date']:'');
	
	$data['mock_details']       = $this->model_mocktest->mockTestReport($student_id,$data['course_details']->course_id);
	$data['pactrice_details']   = $this->model_student->pactriceTestReport($student_id,$data['course_details']->course_id);
	$data['hazard_details']     = $this->model_student->hazardTestReport($student_id);
	
	$data['mockTestMastery']    = $this->model_mocktest->mockTestmastery($student_id,$data['course_details']->course_id);
	$data['pactriceTestMastery']= $this->model_student->pactriceTestMastery($student_id,$data['course_details']->course_id);
	$data['hazardTestMastery']  = $this->model_student->hazardTestMastery($student_id);
	//pr($data);
	$this->getTemplate();
	$this->template->write_view('content','student/report',$data);
	$this->template->render();
    }
    
    public function reactive(){
	$this->chk_ins_login();
	$data= array();
	$content_id			= $this->uri->segment(3, 0);
	$data['student_id']		= $content_id;
	
	$conditionArr			= array('student_id' => $data['student_id']);
	
	$updateArr      		= array('student_status' => 'Active');

	$update 			= $this->model_student->editStudentDB($updateArr,$conditionArr);
		 
	if($update){
		$this->session->set_flashdata('message', array('title'=>'Re-active Student','content'=>'User activated successfully!','type'=>'successmsgbox'));
		redirect(base_url().$this->session->userdata('INSTRUCTOR_BUSINESS_NAME')."/active_users/");
	}
	else{
		$this->session->set_flashdata('message', array('title'=>'Re-active Student','content'=>'Unable to re-active user. Please try again.','type'=>'errormsgbox'));
		redirect(base_url().$this->session->userdata('INSTRUCTOR_BUSINESS_NAME').'/past_users');
	}
    }
    
    public function landing(){
	$this->chk_student_login();
	$data = array();
	$this->getTemplate();
	$this->template->write_view('content','student/landing',$data);
	$this->template->render();
    }
/**
*
* @Frontend country state dropdown
*
*
*/

}


/* End of file hmvc.php */
/* Location: ./application/widgets/hmvc/controllers/hmvc.php */
