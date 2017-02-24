<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class World_payment extends MY_Controller {
    
    var $instId      		= '1124265';
    //var $payment_url	        = 'https://secure-test.worldpay.com/wcc/purchase';
    var $payment_url	        = 'https://secure.worldpay.com/wcc/purchase';

    public function __construct()
    {
	parent::__construct();
	$this->load->model(array('instructor/model_instructor','welcome/model_basic','student/model_student'));
	$this->load->library('form_validation');
	$this->load->helper('gencc');

    }
    
    
    public function payment(){
        
        //$this->chk_ins_login();
	$data=array();
	
	
        $amount 		=  $this->session->userdata('AMOUNT');
	$package_id 		=  $this->session->userdata('PACKAGE_ID');
        $ins_id                 =  $this->session->userdata('INS_ID');
	
	if($ins_id == ''){
	    redirect(base_url().'price');
	}
	
	$ins_dtls		= $this->model_basic->detailsDB(INSTRUCTOR,array('instructor_id'=>$ins_id));
	
	$pack_dtls		= $this->model_basic->detailsDB(PACKAGE,array('package_id'=>$package_id));
	
	$data['start_date']	= date('Y-m-d',strtotime('+14 day',strtotime($ins_dtls[0]['added_on'])));
	//$data['start_date']	= date('Y-m-d',strtotime('+1 day',strtotime($ins_dtls[0]['added_on'])));
	$data['end_date']   	= date('Y-m-d', strtotime('+1 years'));
	$data['amount']     	= $amount;
	$data['package_id'] 	= $package_id;
	$data['ins_id']         = $ins_id;
	
	$data['url']     	= $this->payment_url;
	$data['desc']     	= 'DIPP '.$pack_dtls[0]['package_name'].' Membership Package';
	
	
	$this->session->set_userdata('AMOUNT','');
	$this->session->set_userdata('PACKAGE_ID','');
	$this->session->set_userdata('INS_ID','');
         
            
        $this->getTemplate();
        $this->template->write_view('content', 'world_payment/payment', $data);
        $this->template->render();
        
    }
    
    
    public function payment_notification()
    {
	if($_POST['MC_type'] == 'passGuaranteePayment'){
	    
	    $fp = fopen(FILE_UPLOAD_ABSOLUTE_PATH.'worldpaypassGuaranteePayment.txt', 'w');

	    $updateArr1 = array('status'	  => 'Active');
	    $this->model_basic->editDB(INSTRUCTOR_PAYMENT,$updateArr1,array('id'=>$_POST['cartId']));
	    
	    $insertArr = array('booking_id' 	=> $_POST['cartId'],
			       'payment_type'	=> 'worldpay',
			       'amount'		=> $_POST['amount'],
			       'payment_status' => $_POST['transStatus'],
			       'details'	=> json_encode($_POST),
			       'created_at'	=> date('Y-m-d H:i:s'));
	    
	    
	    $this->model_basic->addDB('dipp_booking_payment',$insertArr);
	    
	}else{
	    
	    $tran_id			= $_POST['transId'];
	    $payment_status		= $_POST['transStatus'];
	    $amount               	= $_POST['amount'];
	    $ins_id               	= $_POST['cartId'];
		
            if($payment_status == 'Y'){
		
		
		    $updateArr1 = array(
                                'profile_id'	  => $_POST['cartId'],
                                'correlationId'	  => $tran_id,
                                'profile_status'  => $payment_status,
                                'payment_date'	  => date('Y-m-d H:i:s',$_POST['transTime'])
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
	    }
	    else
	    {
		    $updateArr2 = array(
			'profile_id'	  => $_POST['cartId'],
			'correlationId'	  => $tran_id,
			'profile_status'  => $payment_status,
			'payment_date'	  => date('Y-m-d H:i:s')
			);
		    $this->model_basic->editDB(INSTRUCTOR_PAYMENT,$updateArr2,array('instructor_id'=>$ins_id));
		
	    }

	    $fp = fopen(FILE_UPLOAD_ABSOLUTE_PATH.'worldpay.txt', 'w');
	    fwrite($fp, print_r($_REQUEST, TRUE));
	    fclose($fp);
	}
	exit;
	
//        $tran_id		= $_POST['transId'];
//        $payment_status		= $_POST['transStatus'];
//        $amount               	= $_POST['amount'];
//        $ins_id               	= $_POST['cartId'];
//        
//	//$msg = $_POST['custom'].'-'.$tran_id.'-'.$payment_status.'-'.$_POST['subscr_id'];
//		
//		
//	//mail("indira.giri@webskitters.com","My subject",$msg);
//            
//            if($payment_status == 'Y'){
//		
//		
//		    $updateArr1 = array(
//                                'profile_id'	  => $_POST['cartId'],
//                                'correlationId'	  => $tran_id,
//                                'profile_status'  => $payment_status,
//                                'payment_date'	  => date('Y-m-d H:i:s',$_POST['transTime'])
//				);
//         
//		    $this->model_basic->editDB(INSTRUCTOR_PAYMENT,$updateArr1,array('instructor_id'=>$ins_id));
//		    
//		    $updateArr	= array('instructor_payment_status' => 'paid');
//	    
//		    $this->model_basic->editDB(INSTRUCTOR,$updateArr,array('instructor_id'=>$ins_id));
//	    }
//	    else
//	    {
//		    $updateArr2 = array(
//			'profile_id'	  => $_POST['cartId'],
//			'correlationId'	  => $tran_id,
//			'profile_status'  => $payment_status,
//			'payment_date'	  => date('Y-m-d H:i:s')
//			);
//		    $this->model_basic->editDB(INSTRUCTOR_PAYMENT,$updateArr2,array('instructor_id'=>$ins_id));
//		
//	    }
            
        
        
    }
    
    public function success(){
            $this->getTemplate();
	    $this->template->write_view('content', 'world_payment/success');
	    $this->template->render();
     }
  
}