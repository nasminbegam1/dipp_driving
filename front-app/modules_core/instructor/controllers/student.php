<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Instructor extends MY_Controller {
    
    public function __construct()
    {
	parent::__construct();
	$this->load->model(array('welcome/model_authentication','welcome/model_basic'));
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
	$this->chk_ins_login();
	$this->chk_login();
	$data=array();
	$this->getTemplate();
        $this->template->write_view('content', 'instructor/dashboard', $data);
        $this->template->render();
    }
    
   
    public function logout() {
        $this->session->sess_destroy();
        redirect(base_url());
    }
    
/**Edit Profile **/
    public function editProfile(){
	$this->chk_ins_login();
	$instructor_id 		= $this->session->userdata('INSTRUCTOR_ID');
	$data 	 		= array();
	$data['ins_details'] 	= $this->model_basic->detailsDB(INSTRUCTOR,'instructor_status = "Active" AND instructor_id ='.$instructor_id.'');
	if($this->input->post('action') =='Process')
	{
	    $this->form_validation->set_rules('instructor_business_name','Business Name','required');
		$this->form_validation->set_rules('instructor_fname','First Name','required');
		$this->form_validation->set_rules('instructor_lname','Last Name','required');
		$this->form_validation->set_rules('instructor_password','Password','required');
		$this->form_validation->set_rules('instructor_address','Address','required');
	
		if ($this->form_validation->run() == FALSE)
		{				
		    $data['validation_error']=validation_errors();
		    $this->session->set_flashdata('message', array('title'=>'instructor','content'=>$data['validation_error'],'type'=>'errormsgbox'));
		    redirect(base_url().'instructor/editProfile/');
		}
		else
		{
		    $instructor_business_name 	= $this->input->post('instructor_business_name');
		    $instructor_fname		= $this->input->post('instructor_fname');
		    $instructor_lname		= $this->input->post('instructor_lname');
		    $instructor_password	= $this->input->post('instructor_password');
		    $instructor_phone_number	= $this->input->post('instructor_phone_number');
		    $instructor_address		= $this->input->post('instructor_address');
		    
		    $whereArr	= array( 'instructor_business_name' => url_title($instructor_business_name, 'dash'),'instructor_id' => $instructor_id );
		    $bool 		= $this->model_instructor->instructorExistsDB( $whereArr );
		    //pr($bool);
		    if($bool){
		    $this->session->set_flashdata('message', array('title'=>'instructor','content'=>'Business name is already exist','type'=>'errormsgbox'));
		    redirect(base_url().'instructor/editProfile/');
		    }else{
		    $update_arr = array( 
				    'student_fname'		=>addslashes(trim($this->input->post('student_fname'))),
				    'student_lname'		=>addslashes(trim($this->input->post('student_lname'))),
				    'student_phone'		=>addslashes(trim($this->input->post('student_phone'))),
				    );
		    $res1=$this->model_basic->editDB(STUDENT,$update_arr,array('student_id'=>$student_id));
		    
		    $this->session->set_flashdata('message', array('title'=>'User login','content'=>'Profile Updated Successfully','type'=>'successmsgbox'));
		    redirect(base_url().'instructor/editProfile/');
		    }
		}
	}
	$this->getTemplate();
        $this->template->write_view('content', 'instructor/editProfile', $data);
        $this->template->render();
    }
/************Change Password ************/
    public function changePassword(){
	$this->chk_login();
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
		redirect(base_url().'instructor/changePassword/');
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
		redirect(base_url().'instructor/changePassword/');
	    }
	}
	$this->getTemplate();
        $this->template->write_view('content', 'instructor/changePassword', $data);
        $this->template->render();
    }

/********Forgot password send email******************/
    public function forgotPassword(){
	$this->chk_ins_not_login();
	$data = array();
	if($this->input->post('action') =='Process')
	{
	    $this->form_validation->set_rules('instructor_email','Email address','required|trim|email');
	
	    if ($this->form_validation->run() == FALSE)
	    {				
		$data['validation_error']=validation_errors();
		$this->session->set_flashdata('forgot_message', array('title'=>'Instructor','content'=>$data['validation_error'],'type'=>'errormsgbox'));
		redirect(base_url().'instructor/forgotPassword/');
	    }
	    else
	    {
		$instructor_email 	= $this->input->post('instructor_email');
		$is_exsist 		= $this->model_basic->detailsDB(INSTRUCTOR,'instructor_email = "'.$instructor_email.'" AND instructor_status = "Active"');
		if(is_array($is_exsist) && count($is_exsist)>0)
		{
		    $sitesettings 		= $this->model_basic->get_settings(6);
		    $sitename 			= stripslashes($sitesettings['sitename']);
		    $link	    		= FRONTEND_URL.'instructor/resetPassword/'.md5($instructor_email);
		    $email_template    		= $this->model_basic->detailsDB(EMAIL_TEMPLATE,'template_id = "1"');
		    $message			= stripslashes(str_replace(array('{{USERFNAME}}','{{RESET_LINK}}','{{SITENAME}}'),array(stripslashes($is_exsist[0]['instructor_fname']),$link,$sitename),stripslashes($email_template[0]['email_content'])));
		    $to 			= trim($instructor_email);
		    //$to 			= 'nasmin.begam@webskitters.com';
		    $from 			= $email_template[0]['response_email'];
		    $email_subject 		= $email_template[0]['email_subject'];
		    $this->send_mail($from,$sitename,$to,'','',$email_subject,$message);
		    $this->session->set_flashdata('forgot_message', array('title'=>'Instructor','content'=>'Please check your email to reset password','type'=>'successmsgbox'));
		}else{
		    $this->session->set_flashdata('forgot_message', array('title'=>'Instructor','content'=>'Could not found the email in our site.Please check the email.','type'=>'errormsgbox'));
		}
		redirect(base_url().'instructor/forgotPassword/');
	    }
	}
	$this->getTemplate();
        $this->template->write_view('content', 'instructor/forgotPassword', $data);
        $this->template->render();
    }
/******************Reset Password ****************************/
    public function resetPassword(){
	$this->chk_ins_not_login();
	$data	= array();
	$instructor_email	= $this->uri->segment(3);
	$data['ins_details'] 	= $this->model_basic->detailsDB(INSTRUCTOR,'md5(instructor_email) = "'.$instructor_email.'"');
	if($this->input->post('action') =='Process')
	{
	    if(count($data['ins_details'])>0 && is_array($data['ins_details'])){
		$this->form_validation->set_rules('new_password','New Password','required|trim|matches[confirm_password]');
		$this->form_validation->set_rules('confirm_password','Confirm Password','required|trim');
	    
		if ($this->form_validation->run() == FALSE)
		{				
		    $data['validation_error']=validation_errors();
		    $this->session->set_flashdata('forgot_message', array('title'=>'Instructor','content'=>$data['validation_error'],'type'=>'errormsgbox'));
		    redirect(base_url().'instructor/resetPassword/'.$instructor_email);
		}
		else
		{
		    $new_password 		= $this->input->post('new_password');
		    $confirm_password 		= $this->input->post('confirm_password');
		    $update_arr 		= array('instructor_password'=>$new_password);
		    
		    $this->model_basic->editDB(INSTRUCTOR,$update_arr,array('instructor_id'=>$data['ins_details'][0]['instructor_id']));
		    $this->session->set_flashdata('forgot_message', array('title'=>'Instructor login','content'=>'Password changed Successfully!','type'=>'successmsgbox')); 
		}
	    }else{
		$this->session->set_flashdata('forgot_message', array('title'=>'Instructor','content'=>'You are not a Instructor.Please register your email address','type'=>'errormsgbox'));
	    }
	    redirect(base_url().'instructor/resetPassword/'.$instructor_email);
	}
	$this->getTemplate();
        $this->template->write_view('content', 'instructor/resetPassword', $data);
        $this->template->render();
    }
    public function registration(){
	$this->chk_not_login();
	$data['courseType'] = $this->uri->segment(3);
	$data['payment_amount'] = $this->model_basic->detailsDB($this->courseMaster,'slug = "'.$data['courseType'].'"','price,discount,slug');
	if($this->input->post('action') =='Process')
	{
	    $this->form_validation->set_rules('user_fname','User First Name','required|trim');
	    $this->form_validation->set_rules('user_lname','User Last Name','required|trim');
	    $this->form_validation->set_rules('user_email','User Email','required|email|trim|matches[conf_user_email]|is_unique[dt_user_master.user_email]');
	    $this->form_validation->set_rules('conf_user_email','Confirm Email','required|trim');
	    $this->form_validation->set_rules('user_password','Password','required|trim|matches[conf_password]');
	    $this->form_validation->set_rules('conf_password','Confirm Password','required|trim');
	    if ($this->form_validation->run() == FALSE)
	    {				
		$data['validation_error']=validation_errors();
		$this->session->set_flashdata('forgot_message', array('title'=>'User','content'=>$data['validation_error'],'type'=>'errormsgbox'));
		redirect(base_url().'student/registration/'.$this->input->post('type'));
	    }
	    else
	    {
		$type       = $this->input->post('type');
		$insert_arr = array('user_fname' 	=> $this->input->post('user_fname'),
				    'user_lname' 	=> $this->input->post('user_lname'),
				    'user_email' 	=> $this->input->post('user_email'),
				    'user_password' 	=> $this->input->post('user_password'),
				    'user_status'	=> 'Inactive',
				    'user_added_on'	=> date('Y-m-d H:s:i'));
		$id = $this->model_basic->insertIntoTable($this->userMaster,$insert_arr);
		$this->session->set_userdata('PAYMENT_INFO',array('user_id' => $id,'payment_type'=>$type));
		redirect(base_url().'user/payment/');
	    }
	}
	$this->getTemplate();
        $this->template->write_view('content', 'student/registration', $data);
        $this->template->render();
    }
    
    public function payment(){
	$this->chk_not_login();
	$payment_info = $this->session->userdata('PAYMENT_INFO');
	$data['payment_amount'] = $this->model_basic->detailsDB($this->courseMaster,'slug = "'.$payment_info['payment_type'].'"');
	if($this->payment_mode =='sandbox'){
	    $data['url'] = $this->sandbox_url;    
	}
	else{
	   $data['url'] = $this->live_url;
	}
	$data['business_email_id'] 	= $this->business_email_id;
	$data['return_url'] 		= FRONTEND_URL.'user/payment_successfull';
	$data['cancel_url'] 		= FRONTEND_URL.'user/cancel_payment';
	$data['notification_url'] 	= FRONTEND_URL.'user/payment_notification';
	$data['title']  		= '365 day '.stripslashes($data['payment_amount'][0]['name']).' theory with a money back guarantee';
	$data['amount']     		= $data['payment_amount'][0]['price'] - $data['payment_amount'][0]['discount'];
	$data['course_id'] 		= $data['payment_amount'][0]['id'];
	$data['user_id']		= $payment_info['user_id'];
	$this->getTemplate();
        $this->template->write_view('content', 'student/payment', $data);
        $this->template->render();
    }
    
    public function payment_successfull(){
	$transaction_history = serialize($_POST);
	$tran_id	= $_POST['txn_id'];
	$custom         = $_POST['custom'];
	$custom_data    = explode('@#',$custom);
	$insert_arr = array('user_id' 		=> $custom_data[1],
			    'course_id' 	=> $custom_data[0],
			    'paid_amount' 	=> $_POST['mc_gross'],
			    'transaction_id' 	=> $_POST['txn_id'],
			    'transaction_history'=> $transaction_history,
			    'added_on'		=> date('Y-m-d H:s:i'));
	$this->model_basic->insertIntoTable($this->userCourse,$insert_arr);
	
	$update_arr 	= array('user_status'=>'Active','payment'=>'Y');
	
	$this->model_basic->editDB($this->userMaster,$update_arr,array('user_id'=>$custom_data[1]));
	
	$sitesettings 			= $this->model_basic->get_settings(6);
	$sitename 			= stripslashes($sitesettings['sitename']);
	$userDetails 			= $this->model_user->userDB($custom_data[1]);
	
	$email_template    		= $this->model_basic->detailsDB($this->emailTemplate,'template_id = "2"');
	$message			= stripslashes(str_replace(array('{{USER}}','{{TRANSACTION_ID}}','{{TRANSACTION_AMOUNT}}','{{COURSETYPE}}','{{SITENAME}}'),array(stripslashes($userDetails[0]['user_fname']),$userDetails[0]['transaction_id'],$userDetails[0]['paid_amount'],$userDetails[0]['user_course'],$sitename),$email_template[0]['email_content']));
	$to 			= trim($userDetails[0]['user_email']);
	$from 			= $email_template[0]['response_email'];
	$email_subject 		= $email_template[0]['email_subject'];
	$this->send_mail($from,$sitename,$to,'','',$email_subject,$message);
	
	$data = array();
	$this->getTemplate();
        $this->template->write_view('content', 'student/payment_success', $data);
        $this->template->render();
	
    }
    
    public function payment_notification(){
	
    }
    
    public function cancel_payment(){
	$data = array();
	$this->getTemplate();
        $this->template->write_view('content', 'student/payment_cancel', $data);
        $this->template->render();
    }
    
    public function emailUniqueCheck(){
	$user_email = $this->input->post('user_email');
	$userDetails 			= $this->model_basic->detailsDB($this->userMaster,'user_email = "'.$user_email.'"');
	if(is_array($userDetails) && count($userDetails)>0){
	    echo 1;   
	}
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
