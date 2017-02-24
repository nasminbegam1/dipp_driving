<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends MY_Controller {

var $courseMaster 	= 'dt_course_master';
var $userMaster 	= 'dt_user_master';
var $emailTemplate 	= 'dt_email_template';
var $userCourse		= 'dt_user_course';
var $business_email_id  = 'tonmoy.nandy-facilitator@gmail.com';

var $payment_mode 	= 'sandbox';
var $sandbox_url	= 'https://www.sandbox.paypal.com/cgi-bin/webscr';
var $live_url		= 'https://www.paypal.com/cgi-bin/webscr';
   
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('welcome/model_authentication','welcome/model_basic','user/model_user'));
        $this->load->library('form_validation');
        $this->url = base_url().'user/';
    }

/**
*
* @Frontend landing page
*
*
*/
    public function index()
    {
    }
    public function login()
    {
        $data=array();
        if($this->input->get_post('action') == 'Process')
		{
			$this->form_validation->set_rules('username', 'Name', 'trim|required');
			$this->form_validation->set_rules('password', 'password', 'trim|required');
                        
			
				if ($this->form_validation->run() == FALSE)
				{				
                                    $data['validation_error']=validation_errors();
                                    $this->session->set_flashdata('message', array('title'=>'User','content'=>$data['validation_error'],'type'=>'errormsgbox'));
                                    redirect(base_url());
				}
                                else
                                {	
				    $name    		= trim($this->input->get_post('username'));
				    $pass  		= trim($this->input->get_post('password'));
				    $result		= $this->model_authentication->check_authentication();
				
				    if(count($result) > 0)
				    {
					$this->session->set_userdata('user_id', $result[0]['user_id']);
					$this->session->set_userdata('user_first_name', stripslashes($result[0]['user_fname']));
					$this->session->set_userdata('user_last_name', stripslashes($result[0]['user_lname']));
					$this->session->set_userdata('user_email', stripslashes($result[0]['user_email']));
					
					if($result[0]['payment'] == 'Y'){
					//$this->session->set_flashdata('message', array('title'=>'User login','content'=>'You have logged in as an user','type'=>'successmsgbox'));
					redirect(base_url()."user/dashboard");
					}else{
					    redirect(base_url()."user/payment_expire");
					}
			    
				    }
				    else
				    {
					$this->session->set_flashdata('message', array('title'=>'user login','content'=>'Login failed, Please try again...','type'=>'errormsgbox'));
					redirect(base_url());
				    }
                                }
                }
    }
    public function dashboard()
    {
	$this->chk_payment();
	$this->chk_login();
	$data=array();
        //$this->getTemplate();
	$data['fetch_course'] = $this->model_basic->getValues_conditions($this->courseMaster,array('id','name','price','discount'),'status = "Active"');
	$this->getTemplate();
        $this->template->write_view('content', 'user/index', $data);
        $this->template->render();
    }
    
    public function payment_expire(){
	$data=array();
	$data['result'] = $this->model_basic->detailsDB('dt_cms',"cms_slug = 'expire_account'");
	$this->getTemplate();
        $this->template->write_view('content', 'user/payment_expire', $data);
        $this->template->render();
    }
    
    public function active_account(){
	$this->chk_login();
	$payment_type 		=  $this->uri->segment(3);
	$user_id 		= $this->session->userdata('user_id');
	$data['payment_amount'] = $this->model_basic->detailsDB($this->courseMaster,'slug = "'.$payment_type.'"');
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
	$data['user_id']		= $user_id;
	$this->getTemplate();
        $this->template->write_view('content', 'user/payment', $data);
        $this->template->render();
    }
    
    public function logout() {
        $this->session->sess_destroy();
        redirect(base_url());
    }
    
/**Edit Profile **/
    public function editProfile(){
	$this->chk_payment();
	$this->chk_login();
	$user_id 		= $this->session->userdata('user_id');
	$data 	 		= array();
	$data['user_details'] 	= $this->model_basic->detailsDB($this->userMaster,'user_status = "Active" AND user_id='.$user_id.'');
	if($this->input->post('action') =='Process')
	{
	    $this->form_validation->set_rules('user_fname','user first name','required|trim');
	    $this->form_validation->set_rules('user_lname','user last name','required|trim');
	
		if ($this->form_validation->run() == FALSE)
		{				
		    $data['validation_error']=validation_errors();
		    $this->session->set_flashdata('message', array('title'=>'User','content'=>$data['validation_error'],'type'=>'errormsgbox'));
		    redirect(base_url().'user/editProfile/');
		}
		else
		{
		    $user_id = $this->input->post('user_id');
		    $update_arr = array( 
				    'user_fname'		=>addslashes(trim($this->input->post('user_fname'))),
				    'user_lname'		=>addslashes(trim($this->input->post('user_lname'))),
				    );				
		    $res1=$this->model_basic->editDB($this->userMaster,$update_arr,array('user_id'=>$user_id));
		    $this->session->set_flashdata('message', array('title'=>'User login','content'=>'Profile Updated Successfully','type'=>'successmsgbox'));
		    redirect(base_url().'user/editProfile/');
		}
	}
	$this->getTemplate();
        $this->template->write_view('content', 'user/editProfile', $data);
        $this->template->render();
    }
/************Change Password ************/
    public function changePassword(){
	$this->chk_payment();
	$this->chk_login();
	$user_id 		= $this->session->userdata('user_id');
	$data 	 		= array();
	$data['user_details'] 	= $this->model_basic->detailsDB($this->userMaster,'user_status = "Active" AND user_id='.$user_id.'');
	if($this->input->post('action') =='Process')
	{
	    $this->form_validation->set_rules('current_password','Current Password','required|trim');
	    $this->form_validation->set_rules('new_password','New Password','required|trim|matches[confirm_password]');
	    $this->form_validation->set_rules('confirm_password','Confirm Password','required|trim');
	
	    if ($this->form_validation->run() == FALSE)
	    {				
		$data['validation_error']=validation_errors();
		$this->session->set_flashdata('message', array('title'=>'User','content'=>$data['validation_error'],'type'=>'errormsgbox'));
		redirect(base_url().'user/changePassword/');
	    }
	    else
	    {
		$current_password = $this->input->post('current_password');
		$new_password = $this->input->post('new_password');
		$confirm_password = $this->input->post('confirm_password');
		if($data['user_details'][0]['user_password'] != $current_password){
		    $this->session->set_flashdata('message', array('title'=>'User login','content'=>'Please enter correct password','type'=>'errormsgbox'));
		}else{
		$user_id 	= $this->input->post('user_id');
		$update_arr 	= array('user_password'=>$new_password);
		
		$this->model_basic->editDB($this->userMaster,$update_arr,array('user_id'=>$user_id));
		$this->session->set_flashdata('message', array('title'=>'User login','content'=>'Password changed Successfully!','type'=>'successmsgbox'));
		}
		redirect(base_url().'user/changePassword/');
	    }
	}
	$this->getTemplate();
        $this->template->write_view('content', 'user/changePassword', $data);
        $this->template->render();
    }

/********Forgot password send email******************/
    public function forgotPassword(){
	$this->chk_not_login();
	$data = array();
	if($this->input->post('action') =='Process')
	{
	    $this->form_validation->set_rules('user_email','Email address','required|trim|email');
	
	    if ($this->form_validation->run() == FALSE)
	    {				
		$data['validation_error']=validation_errors();
		$this->session->set_flashdata('forgot_message', array('title'=>'User','content'=>$data['validation_error'],'type'=>'errormsgbox'));
		redirect(base_url().'user/forgotPassword/');
	    }
	    else
	    {
		$user_email 	= $this->input->post('user_email');
		$is_exsist 	= $this->model_basic->detailsDB($this->userMaster,'user_email = "'.$user_email.'" AND user_status = "Active"');
		if(is_array($is_exsist) && count($is_exsist)>0)
		{
		    $sitesettings 		= $this->model_basic->get_settings(6);
		    $sitename 			= stripslashes($sitesettings['sitename']);
		    $link	    		= FRONTEND_URL.'user/resetPassword/'.md5($user_email);
		    $email_template    		= $this->model_basic->detailsDB($this->emailTemplate,'template_id = "1"');
		    $message			= stripslashes(str_replace(array('{{USERFNAME}}','{{RESET_LINK}}','{{SITENAME}}'),array(stripslashes($is_exsist[0]['user_fname']),$link,$sitename),$email_template[0]['email_content']));
		    $to 			= trim($user_email);
		    //$to 			= 'nasmin.begam@webskitters.com';
		    $from 			= $email_template[0]['response_email'];
		    $email_subject 		= $email_template[0]['email_subject'];
		    $this->send_mail($from,$sitename,$to,'','',$email_subject,$message);
		    $this->session->set_flashdata('forgot_message', array('title'=>'User','content'=>'Please check your email to reset password','type'=>'successmsgbox'));
		}else{
		    $this->session->set_flashdata('forgot_message', array('title'=>'User','content'=>'Could not found the email in our site.Please check the email.','type'=>'errormsgbox'));
		}
		redirect(base_url().'user/forgotPassword/');
	    }
	}
	$this->getTemplate();
        $this->template->write_view('content', 'user/forgotPassword', $data);
        $this->template->render();
    }
/******************Reset Password ****************************/
    public function resetPassword(){
	$this->chk_not_login();
	$data	= array();
	$user_email		= $this->uri->segment(3);
	$data['user_details'] 	= $this->model_basic->detailsDB($this->userMaster,'md5(user_email) = "'.$user_email.'"');
	if($this->input->post('action') =='Process')
	{
	    if(count($data['user_details'])>0 && is_array($data['user_details'])){
		$this->form_validation->set_rules('new_password','New Password','required|trim|matches[confirm_password]');
		$this->form_validation->set_rules('confirm_password','Confirm Password','required|trim');
	    
		if ($this->form_validation->run() == FALSE)
		{				
		    $data['validation_error']=validation_errors();
		    $this->session->set_flashdata('forgot_message', array('title'=>'User','content'=>$data['validation_error'],'type'=>'errormsgbox'));
		    redirect(base_url().'user/resetPassword/'.$user_email);
		}
		else
		{
		    $new_password 		= $this->input->post('new_password');
		    $confirm_password 		= $this->input->post('confirm_password');
		    $update_arr 		= array('user_password'=>$new_password);
		    
		    $this->model_basic->editDB($this->userMaster,$update_arr,array('user_id'=>$data['user_details'][0]['user_id']));
		    $this->session->set_flashdata('forgot_message', array('title'=>'User login','content'=>'Password changed Successfully!','type'=>'successmsgbox')); 
		}
	    }else{
		$this->session->set_flashdata('forgot_message', array('title'=>'User','content'=>'You are not a user.Please register your email address','type'=>'errormsgbox'));
	    }
	    redirect(base_url().'user/resetPassword/'.$user_email);
	}
	$this->getTemplate();
        $this->template->write_view('content', 'user/resetPassword', $data);
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
		redirect(base_url().'user/registration/'.$this->input->post('type'));
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
        $this->template->write_view('content', 'user/registration', $data);
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
        $this->template->write_view('content', 'user/payment', $data);
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
        $this->template->write_view('content', 'user/payment_success', $data);
        $this->template->render();
	
    }
    
    public function payment_notification(){
	
    }
    
    public function cancel_payment(){
	$data = array();
	$this->getTemplate();
        $this->template->write_view('content', 'user/payment_cancel', $data);
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
