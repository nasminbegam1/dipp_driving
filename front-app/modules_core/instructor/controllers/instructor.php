<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Instructor extends MY_Controller {
    
    public function __construct()
    {
	parent::__construct();
	$this->load->model(array('model_instructor','welcome/model_basic','student/model_student'));
	$this->load->library('form_validation');
	//$this->load->library('PaypalRecurringPaymentProfile');
	//$this->config->load('gencc');
	$this->load->helper('gencc');
	
	$this->url = base_url().'instructor/';
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
	$data=array();
        $data['per_page']         = 3;
	$start                    = 0;
        $data['startRecord']      = $start;
	$data['page']             = $this->uri->segment(3);
        $instructor_id 		  = $this->session->userdata('INSTRUCTOR_ID');
        $total_student            = $this->model_student->countStudentDB(array('SM.instructor_id'=>$instructor_id,'SM.student_status'=>'Active'));
        
        $data['totalRecord']      = $total_student;
	$data['search_keyword']   = "";
	$data['student_all']      = '';
        if($total_student > 0) {
            /********** FOR PAGINATION ***********/
            $config['base_url'] = base_url().'/'.$this->session->userdata('INSTRUCTOR_BUSINESS_NAME').'/dashboard';
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
            if(count($resultArr) > 0) {
		
		foreach($resultArr as $values) {
		$this->uri_segment = $this->uri->total_segments();
		$cur_page           = 0;
		if ($this->uri->segment($this->uri_segment) != 0) {
		    $this->cur_page = $this->uri->segment($this->uri_segment);
		    $cur_page = (int) $this->cur_page;
		}
		$test_date = $this->model_student->getLastDate($values['student_id']);
		if(is_array($test_date) && isset($test_date['date']) && isset($test_date['type'])){
		    $testDate  = $test_date['date'];
		    $testType  = $test_date['type'];
		}else{
		    $testDate = '';
		    $testType  = '';
		}
		$total_result[]     = array_merge($values,
						  array('last_test_date' => $testDate,
							'test_result'	 => ($testDate !='' && $testType != '')?$this->model_instructor->gettestResult($testDate,$testType,$values['student_id'],$test_date):''
							));
		}
                $data['student_all']        = $total_result;
                /********** FOR PAGINATION ***********/
                $config['cur_tag_open']     = '<span class="current-link">';
                $config['cur_tag_close']    = '</span>';
                $this->pagination->initialize($config);
                $data['paging']             = $this->pagination->create_links();
            }
        }
	$data['ins_details'] 	= $this->model_basic->detailsDB(INSTRUCTOR,array('instructor_id' =>$instructor_id));
	$data['packages'] 	= $this->model_basic->detailsDB(PACKAGE,array('package_id' =>$data['ins_details'][0]['package_id']));
	
	$data['cms'] 		= $this->model_basic->detailsDB(CMS,array('cms_id'=>'9'),array('cms_content'));
	$data['advertisement']  = $this->model_basic->detailsDB(ADVERTISEMENT,array('advertisement_status'=>'Active'),array('id','advertisement_title','advertisement_link','advertisement_image'));
	//pr($data);
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
	$data['ins_details'] 	= $this->model_basic->detailsDB(INSTRUCTOR,array('instructor_id' =>$instructor_id));
	if($this->input->post('action') =='Process')
	{
		$this->form_validation->set_rules('instructor_business_name','Business Name','required');
		$this->form_validation->set_rules('instructor_fname','First Name','required');
		$this->form_validation->set_rules('instructor_lname','Last Name','required');
		$this->form_validation->set_rules('instructor_address','Address','required');
		$this->form_validation->set_rules('zip_code','Zip Code','required');
	
		if ($this->form_validation->run() == FALSE)
		{				
		    $data['validation_error']=validation_errors();
		    $this->session->set_flashdata('message', array('title'=>'instructor','content'=>$data['validation_error'],'type'=>'errormsgbox'));
		    redirect(base_url().$this->session->userdata('INSTRUCTOR_BUSINESS_NAME').'/edit-profile/');
		}
		else
		{
		    $instructor_business_name 	= addslashes(trim($this->input->post('instructor_business_name')));
		    $instructor_fname		= addslashes(trim($this->input->post('instructor_fname')));
		    $instructor_lname		= addslashes(trim($this->input->post('instructor_lname')));
		    $instructor_phone_number	= addslashes(trim($this->input->post('instructor_phone_number')));
		    $instructor_address		= addslashes(trim($this->input->post('instructor_address')));
		    $zip_code			= $this->input->post('zip_code');
		    $zipCode 		= str_replace(' ', '', $zip_code);
		    $url 		= "http://maps.googleapis.com/maps/api/geocode/json?address=".$zipCode."&sensor=false";
		    $details		= file_get_contents($url);
		    $result 		= json_decode($details,true);
		    if(!empty($result['results'])){
		    $lat		= $result['results'][0]['geometry']['location']['lat'];
		    
		    $lng		= $result['results'][0]['geometry']['location']['lng'];
			
		    $whereArr	= array( 'instructor_business_name' => url_title($instructor_business_name, 'dash'),'instructor_id <>' => $instructor_id );
		    $bool 		= $this->model_instructor->instructorExistsDB( $whereArr );
		    //pr($bool);
		    if($bool){
		    $this->session->set_flashdata('message', array('title'=>'Instructor','content'=>'Business name is already exist','type'=>'errormsgbox'));
		    redirect(base_url().$this->session->userdata('INSTRUCTOR_BUSINESS_NAME').'/edit-profile/');
		    }else{
		    $instructor_logo=$_FILES['instructor_logo']['name'];
                    if($instructor_logo <> '') {
			if(file_exists(FILE_UPLOAD_ABSOLUTE_PATH().'instructor_logo/'.stripslashes($data['ins_details'][0]['instructor_logo']))){
			unlink(FILE_UPLOAD_ABSOLUTE_PATH().'instructor_logo/'.stripslashes($data['ins_details'][0]['instructor_logo']));
			unlink(FILE_UPLOAD_ABSOLUTE_PATH().'instructor_logo/thumbs/'.stripslashes($data['ins_details'][0]['instructor_logo']));
			}
                    $mainUpload       = $this->imageUpload('instructor_logo','instructor_logo','Y',240,85);
                    $image_name       = $mainUpload['image_name'];
                    }
                    else {
                     $image_name       = $data['ins_details'][0]['instructor_logo'];
                    }
		    $update_arr = array( 
				    'instructor_business_name'      => $instructor_business_name,
				    'instructor_fname'		    => $instructor_fname,
				    'instructor_lname'		    => $instructor_lname,
				    'instructor_phone_number'	    => $instructor_phone_number,
				    'instructor_address'	    => $instructor_address,
				    'zip_code'			    => $zip_code,
				    'latitude'			    => $lat,
				    'longitude'			    => $lng,
				    'instructor_logo'		    => $image_name,
				    );
		    $res1=$this->model_basic->editDB(INSTRUCTOR,$update_arr,array('instructor_id'=>$instructor_id));
		    
		    $this->session->set_flashdata('message', array('title'=>'Instractor login','content'=>'Profile Updated Successfully','type'=>'successmsgbox'));
		    redirect(base_url().$this->session->userdata('INSTRUCTOR_BUSINESS_NAME').'/edit-profile/');
		    }
		    }else{
			$this->session->set_flashdata('message', array('title'=>'Instractor login','content'=>'You did not enter a properly formatted post Code.</strong> Please try again.','type'=>'errormsgbox'));
			redirect(base_url().$this->session->userdata('INSTRUCTOR_BUSINESS_NAME').'/edit-profile/');
		    }
		}
	}
	$this->getTemplate();
        $this->template->write_view('content', 'instructor/editProfile', $data);
        $this->template->render();
    }
/************Change Password ************/
    public function changePassword(){
	$this->chk_ins_login();
	$instructor_id 		= $this->session->userdata('INSTRUCTOR_ID');
	$data 	 		= array();
	if($this->input->post('action') =='Process')
	{
	    $this->form_validation->set_rules('current_password','Current Password','required|trim');
	    $this->form_validation->set_rules('new_password','New Password','required|trim|matches[confirm_password]');
	    $this->form_validation->set_rules('confirm_password','Confirm Password','required|trim');
	
	    if ($this->form_validation->run() == FALSE)
	    {				
		$data['validation_error']=validation_errors();
		$this->session->set_flashdata('message', array('title'=>'Instractor','content'=>$data['validation_error'],'type'=>'errormsgbox'));
		redirect(base_url().$this->session->userdata('INSTRUCTOR_BUSINESS_NAME').'/change-password/');
	    }
	    else
	    {
		$ins_details 	= $this->model_basic->detailsDB(INSTRUCTOR,'instructor_status = "Active" AND instructor_id='.$instructor_id.'');
		$current_password = $this->input->post('current_password');
		$new_password = $this->input->post('new_password');
		$confirm_password = $this->input->post('confirm_password');
		if($ins_details[0]['instructor_password'] != $current_password){
		    $this->session->set_flashdata('message', array('title'=>'Instractor','content'=>'Please enter correct password','type'=>'errormsgbox'));
		}else{
		$update_arr 	= array('instructor_password'=>$new_password);
		
		$this->model_basic->editDB(INSTRUCTOR,$update_arr,array('instructor_id'=>$instructor_id));
		$this->session->set_flashdata('message', array('title'=>'Instractor','content'=>'Password changed Successfully!','type'=>'successmsgbox'));
		}
		redirect(base_url().$this->session->userdata('INSTRUCTOR_BUSINESS_NAME').'/change-password/');
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
    
    public function signup(){	
	
	$this->chk_not_login();
	$data['package_id'] 	= $this->uri->segment(3);
	$data['payment_amount'] = $this->model_basic->detailsDB(PACKAGE,'package_id = "'.$data['package_id'].'"','package_amount');
	$data['course_dtls'] 	= $this->model_basic->detailsDB(COURSE_MASTER,'status = "Active"','name,id');
	if($this->input->post('action') =='Process')
	{
	    $this->form_validation->set_rules('instructor_business_name','Business Name','required');
	    $this->form_validation->set_rules('instructor_fname','First Name','required');
	    $this->form_validation->set_rules('instructor_lname','Last Name','required');
	    $this->form_validation->set_rules('instructor_address','Address','required');
	    $this->form_validation->set_rules('zip_code','Post Code','required');
	    $this->form_validation->set_rules('instructor_email','Email Address','required|email|trim|is_unique['.INSTRUCTOR.'.instructor_email]');
	    $this->form_validation->set_rules('instructor_password','Password','required|trim');
	    //$this->form_validation->set_rules('card_holder_name','Card Holder Name','required');
	    //$this->form_validation->set_rules('card_number','Card Number','required');
	    //$this->form_validation->set_rules('security_code','Security Code','required');
	    
	    if ($this->form_validation->run() == FALSE)
	    {
		$data['validation_error']=validation_errors();
		$this->session->set_flashdata('message', array('title'=>'Instructor','content'=>$data['validation_error'],'type'=>'errormsgbox'));
		//pr($data['validation_error']);
		redirect(base_url().'instructor/signup/'.$data['package_id']);
	    }
	    else
	    {
		$instructor_business_name 	= $this->input->post('instructor_business_name');
		$instructor_fname		= $this->input->post('instructor_fname');
		$instructor_lname		= $this->input->post('instructor_lname');
		$instructor_email		= $this->input->post('instructor_email');
		$instructor_password		= $this->input->post('instructor_password');
		$instructor_phone_number	= $this->input->post('instructor_phone_number');
		$instructor_address		= $this->input->post('instructor_address');
		$zip_code			= $this->input->post('zip_code');
		
		//$card_holder_name		= $this->input->post('card_holder_name');
		//$card_number			= $this->input->post('card_number');
		//$expiry_month			= $this->input->post('expiry_month');
		//$expiry_year			= $this->input->post('expiry_year');
		//$security_code		= $this->input->post('security_code');
		
		$package_id			= $this->input->post('package_id');
		$course_id			= $this->input->post('course_id');
		$payment_type			= $this->input->post('payment_type');
		
		$whereArr	= array( 'instructor_business_name' => url_title($instructor_business_name, 'dash') );
		$bool 		= $this->model_instructor->instructorExistsDB( $whereArr );
		
		if($bool){
			 $this->session->set_flashdata('message', array('title'=>'Add Instructor','content'=>'Business name is already exist','type'=>'errormsgbox'));
			redirect(base_url()."instructor/signup/".$package_id);
		}else{
		    
		    $startDate 			=  date('Y-m-d', time());
		    
		    $data = array();
		    $payment_amount 		= $this->model_basic->detailsDB(PACKAGE,'package_id = "'.$package_id.'"','package_amount');
		    $amount                     = $payment_amount[0]['package_amount'];
		    
		
			$zipCode 	= str_replace(' ', '', $zip_code);
			$url 		= "http://maps.googleapis.com/maps/api/geocode/json?address=".$zipCode."&sensor=false";
			$details	= file_get_contents($url);
			$result 	= json_decode($details,true);
			if(!empty($result['results'])){
			$lat		= $result['results'][0]['geometry']['location']['lat'];
			
			$lng		= $result['results'][0]['geometry']['location']['lng'];
	
			$image_name = '';
			$question_image=$_FILES['instructor_logo']['name'];
			if($question_image <> '') {
			    $mainUpload       = $this->imageUpload('instructor_logo','instructor_logo','Y',240,85);
			    $image_name       = $mainUpload['image_name'];
			} 
                
		
			$insertArr      = array(
					    'instructor_business_name'      => $instructor_business_name,
					    'instructor_fname'		    => $instructor_fname,
					    'instructor_lname'		    => $instructor_lname,
					    'instructor_email'		    => $instructor_email,
					    'instructor_password'	    => $instructor_password,
					    'instructor_phone_number'	    => $instructor_phone_number,
					    'instructor_address'	    => $instructor_address,
					    'zip_code'			    => $zip_code,
					    'latitude'			    => $lat,
					    'longitude'			    => $lng,
					    'instructor_logo'		    => $image_name,
					    'package_id'		    => $package_id,
					    'course_id'			    => $course_id,
					    'payment_type'		    => $payment_type,
					    'instructor_status'		    => 'Inactive',
					    //'card_holder_name'		    => $card_holder_name,
					    //'card_number'		    => $card_number,
					    //'expiry_month'		    => $expiry_month,
					    //'expiry_year'		    => $expiry_year,
					    //'security_code'		    => $security_code,
					    'added_on'  		    => date('Y-m-d H:i:s'));
		
		
			    $lastId = $this->model_basic->addDB(INSTRUCTOR,$insertArr);
			    
			    $paymentAr = array('instructor_id'  => $lastId,
					       'package_id'	=> $package_id,
					       'payment_amount' => $amount,
					       //'profile_id'	=> $pp_create_profile['PROFILEID'],
					       //'correlationId'	=> $pp_create_profile['CORRELATIONID'],
					       //'profile_status' => $pp_create_profile['PROFILESTATUS'],
					       //'payment_date'	=> date('Y-m-d H:i:s',strtotime($pp_create_profile['TIMESTAMP']))
					       );
			
			    $this->model_basic->addDB(INSTRUCTOR_PAYMENT,$paymentAr);
			    if($lastId <> '') {
				//$sitesettings 		= $this->model_basic->get_settings(6);
				//$sitename 		= stripslashes($sitesettings['sitename']);
				//$email_template    	= $this->model_basic->detailsDB(EMAIL_TEMPLATE,'template_id = "5"');
				//$message		= stripslashes(str_replace(array('{INSTRUCTOR_NAME}','{INSTRUCTOR_EMAIL}','{INSTRUCTOR_PASSWORD}','{{SITENAME}}'),array(stripslashes($instructor_fname).' '.$instructor_lname,$instructor_email,$instructor_password,$sitename),$email_template[0]['email_content']));
				//$to 			= trim($instructor_email);
				//$from 			= $email_template[0]['response_email'];
				//$email_subject 		= $email_template[0]['email_subject'];
				//$this->send_mail($from,$sitename,$to,'','',$email_subject,$message);
				
				$this->session->userdata('THEORY_TYPE','');
				
				
				//$this->session->set_flashdata('message', array('title'=>'Add Instructor','content'=>'A new Instructor succesfully added','type'=>'successmsgbox'));
				//redirect(base_url()."instructor/signup/".$package_id);
				
				if($this->input->post('payment_type')=='paypal'){
					
					$this->session->set_userdata('AMOUNT',$amount);
					$this->session->set_userdata('PACKAGE_ID',$package_id);
					$this->session->set_userdata('FNAME',$instructor_fname);
					$this->session->set_userdata('LNAME',$instructor_lname);
					$this->session->set_userdata('EMAIL',$instructor_email);
					$this->session->set_userdata('INS_ID',$lastId);
					
					redirect(base_url()."paypal_payment/payment/");
					
				}else{
					$this->session->set_userdata('AMOUNT',$amount);
					$this->session->set_userdata('PACKAGE_ID',$package_id);
					$this->session->set_userdata('INS_ID',$lastId);
					
					redirect(base_url()."world_payment/payment/");
					
					//redirect(FRONTEND_URL.'vendor_payment/payment_info');
				}
				
				
				
				
			    } else {
				$this->session->set_flashdata('message', array('title'=>'Add Instructor','content'=>'Unable to add Instructor.please try again','type'=>'errormsgbox'));
				redirect(base_url()."instructor/signup/".$package_id);
			    }
			}else{
			    $this->session->set_flashdata('message', array('title'=>'Add Instructor','content'=>'You did not enter a properly formatted post Code.</strong> Please try again.','type'=>'errormsgbox'));
			    redirect(base_url()."instructor/signup/".$package_id);
			}
		   
		}
            }
	}
	$this->getTemplate();
        $this->template->write_view('content', 'instructor/signup', $data);
        $this->template->render();
    }
    
    
    
    public function choose_type(){
	$type  = $this->uri->segment(3);
	$this->session->set_userdata('THEORY_TYPE',$type);
	redirect(base_url().'price');
    }
    
    public function cardDetailsChange(){
	$this->chk_ins_login();
	$instructor_id 		= $this->session->userdata('INSTRUCTOR_ID');
	$data 	 		= array();
	$data['ins_details'] 	= $this->model_basic->detailsDB(INSTRUCTOR,'instructor_status = "Active" AND instructor_id ='.$instructor_id.'');
	if($this->input->post('action') =='Process')
	{
	    $this->form_validation->set_rules('card_holder_name','Card Holder Name','required');
	    $this->form_validation->set_rules('card_number','Card Number','required');
	    $this->form_validation->set_rules('security_code','Security Code','required');
	
		if ($this->form_validation->run() == FALSE)
		{				
		    $data['validation_error']=validation_errors();
		    $this->session->set_flashdata('message', array('title'=>'instructor','content'=>$data['validation_error'],'type'=>'errormsgbox'));
		    redirect(base_url().$this->session->userdata('INSTRUCTOR_BUSINESS_NAME').'/card-details-change/');
		}
		else
		{
		    $card_holder_name			= $this->input->post('card_holder_name');
		    $card_number			= $this->input->post('card_number');
		    $expiry_month			= $this->input->post('expiry_month');
		    $expiry_year			= $this->input->post('expiry_year');
		    $security_code			= $this->input->post('security_code');
		    
		    $update_arr = array( 
				    'card_holder_name'		    => $card_holder_name,
				    'card_number'		    => $card_number,
				    'expiry_month'		    => $expiry_month,
				    'expiry_year'		    => $expiry_year,
				    'security_code'		    => $security_code
				    );
		    $res1=$this->model_basic->editDB(INSTRUCTOR,$update_arr,array('instructor_id'=>$instructor_id));
		    
		    $this->session->set_flashdata('message', array('title'=>'Instractor login','content'=>'Card Details Updated Successfully','type'=>'successmsgbox'));
		    redirect(base_url().$this->session->userdata('INSTRUCTOR_BUSINESS_NAME').'/card-details-change/');
		    
		}
	}
	$this->getTemplate();
        $this->template->write_view('content', 'instructor/cardDetailsChange', $data);
        $this->template->render();
    }
    
    public function advertisement_copy(){
	$adv_id = $this->input->post('id');
	$advertisement  = $this->model_basic->detailsDB(ADVERTISEMENT,array('id'=>$adv_id),array('id','advertisement_title','advertisement_link','advertisement_image'));
	$text = htmlspecialchars('<a href="'.$advertisement[0]['advertisement_link'].'"><img src="'.FILE_UPLOAD_URL.'advertisement/'.$advertisement[0]['advertisement_image'].'" alt="'.$advertisement[0]['advertisement_title'].'" title="'.$advertisement[0]['advertisement_title'].'"></a>');
	echo 'Directions:To add this advertisement to your website simply copy the following HTML code and paste it into the code for your website. This link is served by us. You don\'t need to download the graphic.';
	echo '<textarea id="textar" rows="5" cols="72" readonly="readonly">'.$text.'</textarea>';
	//echo '<a href="javascript:void(0);" id="copy_btn">Copy</a>';
    }
    
    
    public function cancel_payment(){
	$data 	 		= array();
	$this->getTemplate();
        $this->template->write_view('content', 'instructor/cancel_payment', $data);
        $this->template->render();
    }
    
    public function profile_cancel(){
	$instructor_id 		= $this->session->userdata('INSTRUCTOR_ID');

	$ins_details 		= $this->model_basic->detailsDB(INSTRUCTOR,array('instructor_id' =>$instructor_id));
	
	if(is_array($ins_details)){
	
	//    $ins_details 	= $this->model_basic->detailsDB(INSTRUCTOR,array('instructor_id' =>$instructor_id));
	//    
	//    $insert_arr = array( 'instructor_id' 	=> $ins_details[0]['instructor_id'],
	//			 'package_id' 		=> $ins_details[0]['package_id'],
	//			 'payment_amount'	=> $profile_dtls->payment_amount,
	//			 'profile_id'		=> $profile_dtls->profile_id,
	//			 'correlationId'	=> $pp_profile_status['CORRELATIONID'],
	//			 'profile_status'	=> 'Cancelled',
	//			 'payment_date'		=> date('Y-m-d H:i:s')
	//			 );
	//    $this->model_basic->addDB(INSTRUCTOR_PAYMENT,$insert_arr);
	
	    $sitesettings 		= $this->model_basic->get_settings('1,6');
	    $sitename 			= stripslashes($sitesettings['sitename']);
	    $email_template    		= $this->model_basic->detailsDB(EMAIL_TEMPLATE,'template_id = "8"');
	    $message			= stripslashes(str_replace(array('{{USERNAME}}','{{USEREMAIL}}','{{SITENAME}}'),array(stripslashes($ins_details[0]['instructor_fname']),stripslashes($ins_details[0]['instructor_email']),$sitename),stripslashes($email_template[0]['email_content'])));
	    $to 			= $sitesettings['webmaster_email'];
	    //$to 			= 'nasmin.begam@webskitters.com';
	    $from 			= $email_template[0]['response_email'];
	    $email_subject 		= $email_template[0]['email_subject'];
	    $this->send_mail($from,$sitename,$to,'','',$email_subject,$message);

	    $updateArr	= array('instructor_payment_status' => 'cancel');
	    
	    $this->model_basic->editDB(INSTRUCTOR,$updateArr,array('instructor_id'=>$instructor_id));
	    
	    $this->session->set_flashdata('message', array('title'=>'Instractor','content'=>'Profile cancelled Successfully','type'=>'successmsgbox'));
	    
	}else{
	    $this->session->set_flashdata('message', array('title'=>'Instractor','content'=>'Profile does not found','type'=>'errormsgbox'));
	}
	redirect(base_url().$this->session->userdata('INSTRUCTOR_BUSINESS_NAME').'/cancel-payment/');
    }
    
    
    
    public function download()
    {
	$this->chk_ins_login();
	$instructor_id 		  = $this->session->userdata('INSTRUCTOR_ID');
	$data=array();

	$data['badge_records']      = $this->model_instructor->getBadgeList();
	$data['banner_records']      = $this->model_instructor->getBannerList();
	
	$data['cms'] 		= $this->model_basic->detailsDB(CMS,array('cms_id'=>'9'),array('cms_content'));
	$data['advertisement']  = $this->model_basic->detailsDB(ADVERTISEMENT,array('advertisement_status'=>'Active'),array('id','advertisement_title','advertisement_link','advertisement_image'));
	
	$this->getTemplate();
        $this->template->write_view('content', 'instructor/download', $data);
        $this->template->render();
    }
    
    public function download_file()
    {
	$this->load->helper('download');
	$type = $this->uri->segment(2);
	$filename = $this->uri->segment(3);
	
	if($type == 'badge')
	{
	    $data = file_get_contents(FILE_UPLOAD_ABSOLUTE_PATH.'badge_image/'.$filename); // Read the file's contents
	    $name = FILE_UPLOAD_ABSOLUTE_PATH.'badge_image/'.$filename;
	}
	
	if($type == 'banner')
	{
	    $data = file_get_contents(FILE_UPLOAD_ABSOLUTE_PATH.'instructor_banner/'.$filename); // Read the file's contents
	    $name = FILE_UPLOAD_ABSOLUTE_PATH.'instructor_banner/'.$filename;
	}
	
	if($type == 'advertisement')
	{
	    $data = file_get_contents(FILE_UPLOAD_ABSOLUTE_PATH.'advertisement/'.$filename); // Read the file's contents
	    $name = FILE_UPLOAD_ABSOLUTE_PATH.'advertisement/'.$filename;
	}
	
	
	force_download($name, $data);
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
