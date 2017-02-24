<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pass_guarantee extends MY_Controller {
    
    public function __construct()
    {
	parent::__construct();
	$this->load->model(array('welcome/model_basic','model_pass_guarantee'));
	$this->load->library('form_validation');
	$this->url = base_url().'pass_guarantee/';
    }

    /**
    *
    * @Frontend landing page
    *
    *
    */
    public function index(){
	$this->session->set_userdata('GUA_ID','');
	$this->session->set_userdata('STEP','');
	$data = array();
	$this->getTemplate();
        $this->template->write_view('content', 'pass_guarantee/index', $data);
        $this->template->render();
	
    }
    
    public function first()
    {
	//echo $id 		= $this->session->userdata('GUA_ID');
	//exit;
	$data['details'] = array();
	$data		= array();
	$data['testCat']= $this->model_pass_guarantee->getDetails(COURSE_MASTER,array('status' => 'Active'),'id','DESC');
	
	if($this->session->userdata('STEP') == ''){
	    $this->session->set_userdata('GUA_ID','');
	}else{
	    $id 		= $this->session->userdata('GUA_ID');
	    $data['details']  	= $this->model_pass_guarantee->getGuarantDB(array('id' => $id));
	    
	}
	
	if($this->input->post('action') == 'Process'){
	    $insert_array = array('test_category_id' 	=> $this->input->post('testCategory'),
				  'language' 		=> $this->input->post('language'),
				  'special_requirement' => $this->input->post('special_requirement'),
				  'instructor_code'	=> $this->input->post('instructor_code')
				  );
	    if($this->session->userdata('STEP') == ''){
		$id  = $this->model_pass_guarantee->addGuarantDB($insert_array);
	    }else{
		$condition_array 	= array('id' => $id);
		$this->model_pass_guarantee->updateGuarantDB($insert_array,$condition_array);
	    }
	   
	    if($id){
		$this->session->set_userdata('GUA_ID',$id);
		$this->session->set_userdata('STEP','ONE');
		redirect(base_url().'pass_guarantee/second/');
	    }else{
		redirect(base_url().'pass_guarantee/');
	    }
	}
	$this->getTemplate();
        $this->template->write_view('content', 'pass_guarantee/first', $data);
        $this->template->render();
	
    }
    
    public function second(){
	if($this->session->userdata('STEP') != ''){
	$id 	= $this->session->userdata('GUA_ID');
	if($this->input->post('action') == 'Process'){
	    $update_array 	= array('test_centre_id' 	=> $this->input->post('test_centre'),
					'instructor_id'		=> $this->input->post('instructor_id'));
	    $condition_array 	= array('id'		 	=> $this->session->userdata('GUA_ID'));
	    $id  = $this->model_pass_guarantee->updateGuarantDB($update_array,$condition_array);
	    if($id){
		$this->session->set_userdata('STEP','TWO');
		redirect(base_url().'pass_guarantee/third/');
	    }else{
		redirect(base_url().'pass_guarantee/second/');
	    }
	}
	$data['details']  	= $this->model_pass_guarantee->getGuarantDB(array('id' => $id));
	$data['test_centre']  	= $this->model_pass_guarantee->getDetails(TEST_CENTRE,array('status' => 'Active'));
	$this->getTemplate();
        $this->template->write_view('content', 'pass_guarantee/second', $data);
        $this->template->render();
	}else{
	    redirect(base_url().'pass_guarantee/');
	}
    }
    
    public function getLocation(){
	
	    $rec = array();

	    $post_code = $this->input->post('post_code');
        
	    //$result  = $this->model_pass_guarantee->getLatLong($post_code);
            $post_code 	= str_replace(' ', '', $post_code);
        
            $url        = "http://maps.googleapis.com/maps/api/geocode/json?address=".$post_code."&sensor=false";
            $details    = file_get_contents($url);
            $result     = json_decode($details,true);
            if(!empty($result['results'])){
            $lat1       = $result['results'][0]['geometry']['location']['lat'];
            $lon1       = $result['results'][0]['geometry']['location']['lng'];
            
            $d          = 60;
	    //earth's radius in miles
	    $r          = 3959;
    
	    //compute max and min latitudes / longitudes for search square
	    $latN = rad2deg(asin(sin(deg2rad($lat1)) * cos($d / $r) + cos(deg2rad($lat1)) * sin($d / $r) * cos(deg2rad(0))));
	    $latS = rad2deg(asin(sin(deg2rad($lat1)) * cos($d / $r) + cos(deg2rad($lat1)) * sin($d / $r) * cos(deg2rad(180))));
	    $lonE = rad2deg(deg2rad($lon1) + atan2(sin(deg2rad(90)) * sin($d / $r) * cos(deg2rad($lat1)), cos($d / $r) - sin(deg2rad($lat1)) * sin(deg2rad($latN))));
	    $lonW = rad2deg(deg2rad($lon1) + atan2(sin(deg2rad(270)) * sin($d / $r) * cos(deg2rad($lat1)), cos($d / $r) - sin(deg2rad($lat1)) * sin(deg2rad($latN))));
	   
	    $res  = $this->model_pass_guarantee->getNearByZipcode($latN,$latS,$lonE,$lonW,$lat1,$lon1);
	    if($res){
		$rec['type'] = 'success';
		$rec['res']  = $res;
	    }else{
		$rec['type'] = 'not_found';
	    }
	}else{
	    $rec['type'] = 'error';
	    $rec['message'] = 'You did not enter a properly formatted post Code.</strong> Please try again.';
	}
	echo json_encode($rec);
    }
    
    public function third(){
	if($this->session->userdata('STEP') != ''){
	    $id 	= $this->session->userdata('GUA_ID');
	    $data['result']  = '';
	    $data['date_result']  = '';
	    if($id>0)
	    {
		$condition_array 	= array('id'=> $id);
		$data['result'] 	= $this->model_pass_guarantee->getDetails(BOOKING_MASTER,$condition_array);
		$date_condition_array 	= array('booked_id'=> $id);
		$data['date_result'] 	= $this->model_pass_guarantee->getDetails(PREFFERDATE,$date_condition_array);
		
	    }
	    $today = date('Y-m-d');
	    $date_from = date('Y-m-d',strtotime(date("Y-m-d", strtotime($today)) . " +1 day"));	
	    $date_to = date('Y-m-d',strtotime(date("Y-m-d", strtotime($today)) . " +2 month"));
	    
	    $timeDiff = abs(strtotime($date_to) - strtotime($date_from));
    
	    $numberDays = $timeDiff/86400;
	    $numberDays = intval($numberDays);
	    
	    $dateArr = array();
	    
	    for($i=1;$i<=$numberDays;$i++)
	    {
		$new_date = date('Y-m-d',strtotime(date("Y-m-d", strtotime($today)) . " +".$i." day"));
		$dateArr[$new_date] = date('d M Y',strtotime($new_date));
	    }
	    
	    $data['dateArr'] = $dateArr;
	    
	    if($this->input->post('action') == 'Process'){
		$preference = $this->input->post('preference');
		$date_from = $this->input->post('date_from');
		$date_to = $this->input->post('date_to');
		$am_time = $this->input->post('am_time');
		$aft_time = $this->input->post('aft_time');
		$eve_time = $this->input->post('eve_time');
    
		$condition_array 	= array('booked_id'=> $id);
		$this->model_pass_guarantee->deleteGuarantDB($condition_array);
		
		$updata['when_take_test'] = $preference;
	       if($preference == 'as_soon_as_possible')
	       {
		    $updata['am'] = '';
		    $updata['aft'] = '';
		    $updata['eve'] = ''; 
	       }
	       else
	       {
		
		    for($i = 0; $i<count($date_from);$i++)
		    {
			if($date_from[$i] != '')
			{
			    $insert_arr['booked_id'] = $id;
			    $insert_arr['from_date'] = $date_from[$i];
			    $insert_arr['to_date'] = $date_to[$i];
			    $this->db->insert(PREFFERDATE, $insert_arr);
			}
			
		    }
		    
		    
		    if(is_array($am_time))
		    {
			$updata['am'] = implode(',',$am_time);
		    }
		    else
		    {
			$updata['am'] = '';
		    }
		    if(is_array($aft_time))
		    {
			 $updata['aft'] = implode(',',$aft_time);
		    }
		    else
		    {
			$updata['aft'] = '';
		    }
		   if(is_array($eve_time))
		   {
			$updata['eve'] = implode(',',$eve_time); 
		   }
		   else
		   {
			 $updata['eve'] = ''; 
		   }
       
	       }
	       $condition_array 	= array('id'=> $id);
		$id  = $this->model_pass_guarantee->updateGuarantDB($updata,$condition_array);
		if($id){
		    $this->session->set_userdata('STEP','THREE');
		    redirect(base_url().'pass_guarantee/fourth/');
		}
	    }
	    
	    
	    $this->getTemplate();
	    $this->template->write_view('content', 'pass_guarantee/third', $data);
	    $this->template->render();
	}else{
	    redirect(base_url().'pass_guarantee/');
	}
    }
    
    public function fourth(){
	if($this->session->userdata('STEP') != ''){
	    $id 			= $this->session->userdata('GUA_ID');
	    if($this->input->post('action') == 'Process'){
		$update_array 		= array('licence_number' 	=> $this->input->post('licence_number'),
						'title' 		=> $this->input->post('title'),
						'first_name' 		=> $this->input->post('first_name'),
						'middle_name' 		=> $this->input->post('middle_name'),
						'last_name' 		=> $this->input->post('last_name'),
						'address1' 		=> $this->input->post('address1'),
						'address2' 		=> $this->input->post('address2'),
						'town' 			=> $this->input->post('town'),
						'post_code' 		=> $this->input->post('post_code'),
						'telephone_no' 		=> $this->input->post('telephone_no'),
						'email' 		=> $this->input->post('email'));
		$condition_array 	= array('id'		 	=> $this->session->userdata('GUA_ID'));
		$id  = $this->model_pass_guarantee->updateGuarantDB($update_array,$condition_array);
		if($id){
		    $this->session->set_userdata('STEP','FOUR');
		    redirect(base_url().'pass_guarantee/summary/');
		}else{
		    redirect(base_url().'pass_guarantee/third/');
		}
	    }
	    $data['details']  		= $this->model_pass_guarantee->getGuarantDB(array('id' => $id));
	    $data['test_centre']  	= $this->model_pass_guarantee->getDetails(TEST_CENTRE,array('status' => 'Active'));
	    $this->getTemplate();
	    $this->template->write_view('content', 'pass_guarantee/fourth', $data);
	    $this->template->render();
	}else{
	    redirect(base_url().'pass_guarantee/');
	}
    }
    
//    public function terms_condition(){
//	if($this->session->userdata('STEP') != ''){
//	    $data = array();
//	    if($this->input->post('action') == 'Process'){
//		$this->session->set_userdata('STEP','FIVE');
//		$this->session->set_userdata('TERMS',$this->input->post('terms'));
//		redirect(base_url().'pass_guarantee/summary/');
//	    }
//	    $this->getTemplate();
//	    $this->template->write_view('content', 'pass_guarantee/terms_condition', $data);
//	    $this->template->render();
//	}else{
//	    redirect(base_url().'pass_guarantee/');
//	}
//    }
    
    public function summary(){
	if($this->session->userdata('STEP') != ''){
	    $data = array();
	    $id 			= $this->session->userdata('GUA_ID');
	    $data['details']  		= $this->model_pass_guarantee->getGuarantDB(array('id' => $id));
	    $data['course']  		= $this->model_pass_guarantee->getDetails(COURSE_MASTER,array('id'=>$data['details']->test_category_id));
	    $data['centre']  		= $this->model_pass_guarantee->getDetails(TEST_CENTRE,array('id'=>$data['details']->test_centre_id));
	    $data['prefferdate']  	= $this->model_pass_guarantee->getDetails(PREFFERDATE,array('booked_id'=>$data['details']->id));
	    if($this->input->post('action') == 'Process'){
		echo $this->input->post('payment_type');exit;
	    }
	    $this->getTemplate();
	    $this->template->write_view('content', 'pass_guarantee/summary', $data);
	    $this->template->render();
	}else{
	    redirect(base_url().'pass_guarantee/');
	}
    }
    public function payment_process(){
	$data = array();
	$data1 = array();
	$sitesettings 		= $this->model_basic->get_settings(21);
	$data['amount']     	= $sitesettings['pass_guarantee_amount'];
	$id     		= $this->session->userdata('GUA_ID');
	$data['custom']		= $id;
	$data1['details']  	= $this->model_pass_guarantee->getGuarantDB(array('id' => $data['custom']));
	$data1['course']  	= $this->model_pass_guarantee->getDetails(COURSE_MASTER,array('id'=>$data1['details']->test_category_id));
	$data['course']     = $data1['course'] [0]['name'];
	
	//$this->session->set_userdata('GUA_ID','');
	//$this->session->set_userdata('STEP','');
	
	if($_POST['payment_type']=='paypal')
	{
	    $this->getTemplate();
	    $this->template->write_view('content', 'pass_guarantee/paypal', $data);
	    $this->template->render();
	    //$this->load->view('pass_guarantee/paypal', $data);
	}else{
	    $this->getTemplate();
	    $this->template->write_view('content', 'pass_guarantee/worldpay', $data);
	    $this->template->render();
	}
    }
public function paypal_success(){

	$this->session->set_userdata('GUA_ID','');
	$this->session->set_userdata('STEP','');
	//pr($_REQUEST);
//	if($_REQUEST['payment_status']=='Completed'){
//	    
//		$updateArr      = array( 'status'                   => 'Active');
//	        $conditionAr    = array('id'=>$_REQUEST['custom']);
//	        $this->model_pass_guarantee->updateBookingMasterDB($updateArr,$conditionAr);
//	        $insertArr      = array(
//                                        'booking_id'              	=> $_REQUEST['custom'],
//                                        'transaction_id'              	=> $_REQUEST['txn_id'],
//                                        'payment_type'              	=> 'paypal',
//                                        'payment_status'              	=> $_REQUEST['payment_status'],
//                                        'amount'        		=> $_REQUEST['payment_gross'],
//                                        'details' 			=> json_encode($_REQUEST),
//                                        'created_at'			=> date('Y-m-d'),
//                                        );
//            $this->model_pass_guarantee->addBookingPaymentDB($insertArr);
//  // mail send to user;
//         $data = array();
//         $id 			= $_REQUEST['custom'];
//	 $data['details']  		= $this->model_pass_guarantee->getGuarantDB(array('id' => $id));
//	 $data['course']  		= $this->model_pass_guarantee->getDetails(COURSE_MASTER,array('id'=>$data['details']->test_category_id));
//	 $data['centre']  		= $this->model_pass_guarantee->getDetails(TEST_CENTRE,array('id'=>$data['details']->test_centre_id));
//	 $data['prefferdate']  	= $this->model_pass_guarantee->getDetails(PREFFERDATE,array('booked_id'=>$data['details']->id));
//
//	     $test_category     = $data['course'] [0]['name']; 
//	     $gb_licence_number = $data['details']->licence_number; 
//	     $student_name = $data['details']->first_name.$data['details']->last_name;
//	     $student_email =    $data['details']->email;
//	     $test_center =    $data['centre'] [0] ['name']; 
//	     $sitesettings 		= $this->model_basic->get_settings(6);
//		 $sitename 		= stripslashes($sitesettings['sitename']);
//		 $transaction_id = $_REQUEST['txn_id'];
//		 $email_template    	= $this->model_basic->detailsDB(EMAIL_TEMPLATE,'template_id = "7"');
//		 $message		= stripslashes(str_replace(array('{STUDENT_NAME}','{STUDENT_EMAIL}','{TEST_CATEGORY}','{GB_LICENCE_NUMBER}','{TEST_CENTER}','{TRANSACTION_ID}','{SITENAME}'),array(stripslashes($student_name),$student_email,$test_category,$gb_licence_number,$test_center,$transaction_id,$sitename),$email_template[0]['email_content']));
//		 $to 			= trim($student_email);
//		 $from 			= $email_template[0]['response_email'];
//		 $email_subject 		= $email_template[0]['email_subject'];
//		$this->send_mail($from,$sitename,$to,'','',$email_subject,$message);
////mail send end
//		$this->getTemplate();
//	        $this->template->write_view('content', 'pass_guarantee/success');
//	        $this->template->render();
//
//        }
	
	$this->getTemplate();
	$this->template->write_view('content', 'pass_guarantee/success');
	$this->template->render();
     }
    public function paypal_cancel(){

	$this->session->set_userdata('GUA_ID','');
	$this->session->set_userdata('STEP','');
            $this->getTemplate();
	        $this->template->write_view('content', 'pass_guarantee/cancel');
	        $this->template->render();
        }
    public function paypal_notify(){
	$this->session->set_userdata('GUA_ID','');
	$this->session->set_userdata('STEP','');
	if($_REQUEST['payment_status']=='Completed'){
	    
		$updateArr      	= array( 'status'                   => 'Active',);
	        $conditionAr            = array('id'=>$_REQUEST['custom']);
	        $this->model_pass_guarantee->updateBookingMasterDB($updateArr,$conditionAr);
	        $insertArr      = array(
                                        'booking_id'              	=> $_REQUEST['custom'],
                                        'transaction_id'              	=> $_REQUEST['txn_id'],
                                        'payment_type'              	=> 'paypal',
                                        'payment_status'              	=> $_REQUEST['payment_status'],
                                        'amount'        		=> $_REQUEST['payment_gross'],
                                        'details' 			=> json_encode($_REQUEST),
                                        'created_at'			=> date('Y-m-d'),
                                        );
            $this->model_pass_guarantee->addBookingPaymentDB($insertArr);
  // mail send to user;
	    $data = array();
	    $id 			= $_REQUEST['custom'];
	    $data['details']  		= $this->model_pass_guarantee->getGuarantDB(array('id' => $id));
	    $data['course']  		= $this->model_pass_guarantee->getDetails(COURSE_MASTER,array('id'=>$data['details']->test_category_id));
	    $data['centre']  		= $this->model_pass_guarantee->getDetails(TEST_CENTRE,array('id'=>$data['details']->test_centre_id));
	    $data['prefferdate']  	= $this->model_pass_guarantee->getDetails(PREFFERDATE,array('booked_id'=>$data['details']->id));

	    $test_category     		= $data['course'] [0]['name']; 
	    $gb_licence_number 		= $data['details']->licence_number; 
	    $student_name 		= $data['details']->first_name.$data['details']->last_name;
	    $student_email 		= $data['details']->email;
	    $test_center 		= $data['centre'] [0] ['name']; 
	    $sitesettings 		= $this->model_basic->get_settings(6);
	    $sitename 			= stripslashes($sitesettings['sitename']);
	    $transaction_id 		= $_REQUEST['txn_id'];
	    $email_template    		= $this->model_basic->detailsDB(EMAIL_TEMPLATE,'template_id = "7"');
	    $message			= stripslashes(str_replace(array('{STUDENT_NAME}','{STUDENT_EMAIL}','{TEST_CATEGORY}','{GB_LICENCE_NUMBER}','{TEST_CENTER}','{TRANSACTION_ID}','{SITENAME}'),array(stripslashes($student_name),$student_email,$test_category,$gb_licence_number,$test_center,$transaction_id,$sitename),$email_template[0]['email_content']));
	    $to 			= trim($student_email);
	    $from 			= $email_template[0]['response_email'];
	    $email_subject 		= $email_template[0]['email_subject'];
	    $this->send_mail($from,$sitename,$to,'','',$email_subject,$message);
	    //mail send end
//            $this->getTemplate();
//	        $this->template->write_view('content', 'pass_guarantee/success');
//	        $this->template->render();

        }
    }
    
    public function instructor_code(){
	$instructor_code = $this->input->post('instructor_code');
	$details = $this->model_pass_guarantee->getDetails(INSTRUCTOR,array('instructor_business_name'=>$instructor_code),'instructor_id');
	if(!empty($details)){
	    echo $details[0]['instructor_id'];
	}else{
	    echo 'error';
	}
    }
}
/* End of file hmvc.php */
/* Location: ./application/widgets/hmvc/controllers/hmvc.php */
