<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pass_guarantee_third extends MY_Controller {
    
    public function __construct()
    {
	parent::__construct();
	$this->load->model(array('welcome/model_basic','model_pass_guarantee_third'));
	$this->load->library('form_validation');
	$this->url = base_url().'pass_guarantee_third/';
    }

    /**
    *
    * @Frontend landing page
    *
    *
    */
    public function index()
    {
	$data		= array();
	$data['testCat']= $this->model_pass_guarantee_third->getDetails(COURSE_MASTER,array('status' => 'Active'));
	if($this->input->post('action') == 'Process'){
	    $insert_array = array('test_category_id' 	=> $this->input->post('testCategory'),
				  'language' 		=> $this->input->post('language'),
				  'special_requirement' => $this->input->post('special_requirement'),
				  );
	    $id  = $this->model_pass_guarantee_third->addGuarantDB($insert_array);
	    if($id){
		$this->session->set_userdata('GUA_ID',$id);
		redirect(base_url().'pass_guarantee_third/second/');
	    }else{
		redirect(base_url().'pass_guarantee_third/');
	    }
	}
	$this->getTemplate();
        $this->template->write_view('content', 'pass_guarantee_third/index', $data);
        $this->template->render();
    }
    
    public function second(){
	$id 			= $this->session->userdata('GUA_ID');
	$data['details']  	= $this->model_pass_guarantee_third->getGuarantDB(array('id' => $id));
	$data['test_centre']  	= $this->model_pass_guarantee_third->getDetails(TEST_CENTRE,array('status' => 'Active'));
	$this->getTemplate();
        $this->template->write_view('content', 'pass_guarantee_third/second', $data);
        $this->template->render();
    }
    
    public function third(){
	$id 			= $this->session->userdata('GUA_ID');
	$id = 1;
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

	    
	   
	    for($i = 0; $i<count($date_from);$i++)
	    {
		if($date_from[$i] != '')
		{
		    $insert_arr['booked_id'] = $id;
		    $insert_arr['from_date'] = $date_from[$i];
		    $insert_arr['to_date'] = $date_to[$i];
		    $this->db->insert('dipp_prefferdate', $insert_arr);
		}
		
	    }
	    $updata['when_take_test'] = $preference;
	    if(is_array($am_time))
	    {
		$updata['am'] = implode(',',$am_time);
	    }
	    if(is_array($aft_time))
	    {
		 $updata['aft'] = implode(',',$aft_time);
	    }
	   if(is_array($eve_time))
	   {
		$updata['eve'] = implode(',',$eve_time); 
	   }
	    
            $this->db->where('id',$id);
	    $this->db->update('dipp_booking_master',$updata);
	}
	
	
	$this->getTemplate();
        $this->template->write_view('content', 'pass_guarantee_third/third', $data);
        $this->template->render();
    }
    
    public function getLocation(){
	
	$rec = array();

	$post_code = $this->input->post('post_code');
        
	$result  = $this->model_pass_guarantee_third->getLatLong($post_code);
	
	if(is_object($result)){
	    $lat1       = $result->latitude;
	    
	    $lon1       = $result->longitude;
	    
	    $d          = '50';
	    //earth's radius in miles
	    $r          = 3959;
    
	    //compute max and min latitudes / longitudes for search square
	    $latN = rad2deg(asin(sin(deg2rad($lat1)) * cos($d / $r) + cos(deg2rad($lat1)) * sin($d / $r) * cos(deg2rad(0))));
	    $latS = rad2deg(asin(sin(deg2rad($lat1)) * cos($d / $r) + cos(deg2rad($lat1)) * sin($d / $r) * cos(deg2rad(180))));
	    $lonE = rad2deg(deg2rad($lon1) + atan2(sin(deg2rad(90)) * sin($d / $r) * cos(deg2rad($lat1)), cos($d / $r) - sin(deg2rad($lat1)) * sin(deg2rad($latN))));
	    $lonW = rad2deg(deg2rad($lon1) + atan2(sin(deg2rad(270)) * sin($d / $r) * cos(deg2rad($lat1)), cos($d / $r) - sin(deg2rad($lat1)) * sin(deg2rad($latN))));
	   
	    $res  = $this->model_pass_guarantee_third->getNearByZipcode($latN,$latS,$lonE,$lonW,$lat1,$lon1);
	    if($res){
		$rec['type'] = 'success';
		$rec['res']  = $res;
	    }else{
		$rec['type'] = 'not_found';
		$rec['message'] = 'Post code not found';
	    }
	}else{
	    $rec['type'] = 'error';
	    $rec['message'] = 'You did not enter a properly formatted post Code.</strong> Please try again.';
	}
	echo json_encode($rec);
    }

}


/* End of file hmvc.php */
/* Location: ./application/widgets/hmvc/controllers/hmvc.php */
