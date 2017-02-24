<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cron extends MY_Controller {
   
    var $instractor 	= INSTRUCTOR;
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('cron/model_cron','welcome/model_basic'));
        $this->url = base_url().'cron/';
    }

    /**
    *
    * @Frontend landing page
    *
    *
    */
    public function index()
    {
	require (DOCUMENT_ROOT.'front-app/libraries/PaypalRecurringPaymentProfile.php');
	
	$api_username               = API_USERNAME;
	$api_pasword                = API_PASSWORD;
	$api_signature              = API_SIGNATURE;
	$api_env                    = API_ENV;
	$api_version                = API_VERSION;
		
	$pp_profile                 = new PaypalRecurringPaymentProfile($api_username, $api_pasword, $api_signature, $api_version, $api_env);
	
	
	$userData = $this->model_cron->checkPayment();
	
	foreach($userData as $user){
	    
	    $pp_profile_details         = $pp_profile->getProfileDetails($user['profile_id']);
	    
	    if($pp_profile_details['STATUS'] == 'Active'){
		
		$profilestartdate = date('Y-m-d',strtotime($pp_profile_details['PROFILESTARTDATE']));
		
		if($profilestartdate ==  date('Y-m-d')){
		    $updateArr	= array('instructor_payment_status' => 'paid');
	    
		    $this->model_basic->editDB(INSTRUCTOR,$updateArr,array('instructor_id'=>$user['instructor_id']));
		}
	    }
	    
	    pr($pp_profile_details,0);
	}
    }


}


/* End of file hmvc.php */
/* Location: ./application/widgets/hmvc/controllers/hmvc.php */
