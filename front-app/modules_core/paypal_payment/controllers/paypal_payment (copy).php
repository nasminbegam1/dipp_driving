<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Paypal_payment extends MY_Controller {
    
    var $payment_mode 	        = 'live';
    var $business_email_id      = 'payment@dutchurst.co.uk';
    //var $business_email_id      = 'ashesbuisness@gmail.com';
    var $sandbox_url	        = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
    var $live_url		= 'https://www.paypal.com/cgi-bin/webscr';

    public function __construct()
    {
	parent::__construct();
	$this->load->model(array('instructor/model_instructor','welcome/model_basic','student/model_student'));
	$this->load->library('form_validation');
	//$this->load->library('PaypalRecurringPaymentProfile');
	//$this->config->load('gencc');
	$this->load->helper('gencc');
	//$this->url = base_url().'instructor/';

    }
    
    
    public function payment(){
        
        //$this->chk_ins_login();
	$data=array();
        $amount 		=  $this->session->userdata('AMOUNT');
	$package_id 		=  $this->session->userdata('PACKAGE_ID');
        $fname 		        =  $this->session->userdata('FNAME');
        $lname 		        =  $this->session->userdata('LNAME');
        $email 		        =  $this->session->userdata('EMAIL');
        $ins_id                 =  $this->session->userdata('INS_ID');

            if($this->payment_mode =='sandbox'){
                $data['url'] = $this->sandbox_url;    
            }
            else{
               $data['url'] = $this->live_url;
            }
            $data['business_email_id'] 	= $this->business_email_id;
           
            $data['return_url'] 	= base_url().'paypal_payment/return_notification/'.$package_id;
            $data['cancel_url'] 	= base_url().'paypal_payment/cancel_payment/'.$ins_id;
            $data['notification_url'] 	= base_url().'paypal_payment/payment_notification';
            
           
	    $data['amount']     	= $amount;
            $data['package_id'] 	= $package_id;
            $data['fname'] 	        = $fname;
            $data['lname'] 	        = $lname;
            $data['email'] 	        = $email;
            $data['ins_id']             = $ins_id;
	   
         $this->session->set_userdata('AMOUNT','');
         $this->session->set_userdata('PACKAGE_ID','');
         $this->session->set_userdata('FNAME','');
         $this->session->set_userdata('LNAME','');
         $this->session->set_userdata('EMAIL','');
         $this->session->set_userdata('INS_ID','');
         
            
        $this->getTemplate();
        $this->template->write_view('content', 'paypal_payment/payment', $data);
        $this->template->render();
        
    }
    
    
    public function payment_notification()
    {
	
	mail("nasmin.begam@webskitters.com","My subject",'testmail');
	//exit;
	
        $tran_id			= $_POST['txn_id'];
        $payment_status			= $_POST['payment_status'];
        $custom_data    		= explode('@',$_POST['custom']);
        $package_id           		= $custom_data[0];
        $amount               		= $custom_data[1];
        $ins_id               		= $custom_data[2];
        
	$msg = $_POST['custom'].'-'.$tran_id.'-'.$payment_status.'-'.$_POST['subscr_id'];
		
		
	mail("indira.giri@webskitters.com","My subject",$msg);
            
            

	    
	    
            if($payment_status == 'Completed'){
		
		//$profilestartdate = date('Y-m-d',strtotime($pp_profile_details['PROFILESTARTDATE']));
		
		//if($profilestartdate ==  date('Y-m-d')){
		
		    $updateArr1 = array(
                                'profile_id'	  => $_POST['subscr_id'],
                                'correlationId'	  => $tran_id,
                                'profile_status'  => $payment_status,
                                'payment_date'	  => date('Y-m-d H:i:s',strtotime($_POST['payment_date']))
				);
         
		    $this->model_basic->editDB(INSTRUCTOR_PAYMENT,$updateArr1,array('instructor_id'=>$ins_id));
		    
		    $updateArr	= array('instructor_payment_status' => 'paid',
					'instructor_status'	    => 'Active');
	    
		    $this->model_basic->editDB(INSTRUCTOR,$updateArr,array('instructor_id'=>$ins_id));
		    
		    $instructor    		= $this->model_basic->detailsDB(INSTRUCTOR,'instructor_id = "'.$ins_id.'"');
		    
		    $sitesettings 		= $this->model_basic->get_settings(6);
		    $sitename 			= stripslashes($sitesettings['sitename']);
		    $email_template    		= $this->model_basic->detailsDB(EMAIL_TEMPLATE,'template_id = "5"');
		    $message			= stripslashes(str_replace(array('{INSTRUCTOR_NAME}','{INSTRUCTOR_EMAIL}','{INSTRUCTOR_PASSWORD}','{{SITENAME}}'),array(stripslashes($instructor[0]['instructor_fname']).' '.stripslashes($instructor[0]['instructor_lname']),stripslashes($instructor[0]['instructor_email']),stripslashes($instructor[0]['instructor_password']),$sitename),$email_template[0]['email_content']));
		    $to 			= trim($instructor_email);
		    $from 			= $email_template[0]['response_email'];
		    $email_subject 		= $email_template[0]['email_subject'];
		    $this->send_mail($from,$sitename,$to,'','',$email_subject,$message);
		    
		//}
	    }
	    else
	    {
		$updateArr2 = array(
		    'profile_id'	  	=> $_POST['subscr_id'],
		    'correlationId'	  	=> $tran_id,
		    'profile_status'  		=> $payment_status,
		    'payment_date'	  	=> date('Y-m-d H:i:s'));
		$this->model_basic->editDB(INSTRUCTOR_PAYMENT,$updateArr2,array('instructor_id'=>$ins_id));
		
	    }
            
        
        
    }
    
    public function return_notification()
    {
	$package_id 	= $this->uri->segment(3);
	
        $this->session->set_flashdata('message', array('title'=>'Add Instructor','content'=>'A new Instructor succesfully added','type'=>'successmsgbox'));
	redirect(base_url()."instructor/signup/".$package_id);
    }
    
    public function cancel_payment()
    {
        $data = array();
	$ins_id = $this->uri->segment(3);
	$updateArr1 = array(
                                
                                'profile_status'  => 'Cancelled by user',
                                'payment_date'	  => date('Y-m-d H:i:s')
			    );
         
	    $this->model_basic->editDB(INSTRUCTOR_PAYMENT,$updateArr1,array('instructor_id'=>$ins_id));
	    
	    $updateArr	= array('instructor_payment_status' => 'cancel','instructor_status'=>'Inactive');
		
	    $this->model_basic->editDB(INSTRUCTOR,$updateArr,array('instructor_id'=>$ins_id));
	
	
        $this->getTemplate();
        $this->template->write_view('content', 'paypal_payment/paypal_payment_cancel', $data);
        $this->template->render();
    }
    
    public function payment_cancel_type()
    {
	$instructor_id = $this->session->userdata('INSTRUCTOR_ID');
	$ins_payment_details 	= $this->model_basic->detailsDB(INSTRUCTOR_PAYMENT,array('instructor_id' =>$instructor_id));
	$profile_id = $ins_payment_details[0]['profile_id'];
	if($profile_id)
	{
	    $result_set = $this->change_subscription_status($profile_id,'Cancel');
	    if($result_set['ACK'] == 'Success')
	    {
		$insert_arr = array( 'correlationId'	=> $result_set['CORRELATIONID'],
				 'profile_status'	=> 'Cancelled from site',
				 'payment_date'		=> date('Y-m-d H:i:s',strtotime($result_set['TIMESTAMP']))
				 );
		$this->model_basic->editDB(INSTRUCTOR_PAYMENT,$insert_arr,array('instructor_id'=>$instructor_id,'profile_id'=>$profile_id));
		
		$updateArr	= array('instructor_payment_status' => 'cancel','instructor_status'=>'Inactive');
		
		$this->model_basic->editDB(INSTRUCTOR,$updateArr,array('instructor_id'=>$instructor_id));
	    }
	    
	    
	    $this->session->set_flashdata('message', array('title'=>'Instractor','content'=>'Profile cancelled Successfully','type'=>'successmsgbox'));
	}
	else
	{
	  $this->session->set_flashdata('message', array('title'=>'Instractor','content'=>'Profile does not found','type'=>'errormsgbox'));
	}
	redirect(base_url().$this->session->userdata('INSTRUCTOR_BUSINESS_NAME').'/dashboard/');  
	
	
    }
    
    function change_subscription_status( $profile_id, $action )
    {
 
    $api_request = 'USER=' . urlencode( 'ashes321_api1.gmail.com' )
                .  '&PWD=' . urlencode( '1395928820' )
                .  '&SIGNATURE=' . urlencode( 'A3EOU5uiURoLEuLzandpMs4T.Ca6AovYyOo-3kGTgaHernGeLdxeNGKz' )
                .  '&VERSION=76.0'
                .  '&METHOD=ManageRecurringPaymentsProfileStatus'
                .  '&PROFILEID=' . urlencode( $profile_id )
                .  '&ACTION=' . urlencode( $action )
                .  '&NOTE=' . urlencode( 'Profile cancelled at store' );
 
    $ch = curl_init();
    curl_setopt( $ch, CURLOPT_URL, 'https://api-3t.sandbox.paypal.com/nvp' ); // For live transactions, change to 'https://api-3t.paypal.com/nvp'
    curl_setopt( $ch, CURLOPT_VERBOSE, 1 );
 
    // Uncomment these to turn off server and peer verification
    // curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, FALSE );
    // curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, FALSE );
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
    curl_setopt( $ch, CURLOPT_POST, 1 );
 
    // Set the API parameters for this transaction
    curl_setopt( $ch, CURLOPT_POSTFIELDS, $api_request );
 
    // Request response from PayPal
    $response = curl_exec( $ch );
 
    // If no response was received from PayPal there is no point parsing the response
    if( ! $response )
        die( 'Calling PayPal to change_subscription_status failed: ' . curl_error( $ch ) . '(' . curl_errno( $ch ) . ')' );
 
    curl_close( $ch );
 
    // An associative array is more usable than a parameter string
    parse_str( $response, $parsed_response );
 
    return $parsed_response;
   }
    
    
}