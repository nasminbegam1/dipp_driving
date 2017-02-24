<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {



    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('welcome/model_authentication','welcome/model_basic','instructor/model_instructor'));
        $this->load->library('twitterfetcher');
        $this->url = base_url().'home/';
    }

/**
*
* @Frontend landing page
*
*
*/

   public function index()
   {
        $data=array();
        //$data['menu_dtls']      = $this->model_basic->getValues_conditions('dt_course_master',array('id','name','slug','price','discount','image'));
        $data['testimonial']                = $this->model_basic->detailsDB(TESTIMONIAL,array('status'=>'Active'),array('name','description','company_name','image'),'id');
        $data['banner']                     = $this->model_basic->detailsDB(BANNER,array('banner_status'=>'Active'),array('banner_title','banner_image'));
        $data['driving_instructor']         = $this->model_basic->detailsDB(CMS,array('cms_slug'=>'driver-instrutor-home'),array('cms_content'));
        $data['student_learner']            = $this->model_basic->detailsDB(CMS,array('cms_slug'=>'student-learner-home'),array('cms_content'));
        //pr($data);
        
//        $tweets = $this->twitterfetcher->getTweets(array(
//			'consumerKey'       => 'ylC4pfjOWXhcNOBydIsWlycNr',
//			'consumerSecret'    => 'Yn0UUn1OlzoG44pye7xfr4mEmI1u5Qo0VHQEtWXH2FCsqsLj67',
//			'accessToken'       => '4849325507-ueKXnKugogvkzmFwgFxmAR9t9TaVHV5iIDrwa20',
//			'accessTokenSecret' => 'f9lk4EepZaf3ACP2QobYhNPd7cV3jcRgcfC3weBv5fTN4',
//			'usecache'          => true,
//			'count'             => 5,
//			'numdays'           => 30,
//		));

$tweets = $this->twitterfetcher->getTweets(array(
			'consumerKey'       => 'sEkLiyYgxDYELIgADhLl30U0l',
			'consumerSecret'    => 'eY1RhwmEoDG86UmYWxzV2vfTYwKhwGXpJqfvLdZfFw8MocJkPF',
			'accessToken'       => '747727385953439744-Yk3WurGwvkL5vgsLSBxRBKgoAvgEdRq',
			'accessTokenSecret' => 'fqMRsNY97yupKvbSAIEXLlyRLnPVlv8G2hmlZVnp9IrGd',
			'usecache'          => true,
			'count'             => 5,
			'numdays'           => 30,
		));
	
	$data['tweet_list']    	= $tweets;
        
        //$zipcode="700064";
        //$url = "http://maps.googleapis.com/maps/api/geocode/json?address=".$zipcode."&sensor=false";
        //$details=file_get_contents($url);
        //$result = json_decode($details,true);
        //
        //$lat=$result['results'][0]['geometry']['location']['lat'];
        //
        //$lng=$result['results'][0]['geometry']['location']['lng'];
        //
        //echo "Latitude :" .$lat;
        //echo '<br>';
        //echo "Longitude :" .$lng;
        //        
        //die();
        $this->getTemplate();
        $this->template->write_view('content', 'home/index', $data);
        $this->template->render();
   }
   
   public function newslettersubmit(){
    $newsletter_email = $this->input->post('newsletter_email');
    $exist_email = $this->model_basic->existsDB(NEWSLETTERS,array('email_address'=>$newsletter_email));
    if($exist_email){
        $data = 1;
    }else{
        $data ='';
        $this->model_basic->addDB(NEWSLETTERS,array('email_address'=>$newsletter_email));
    }
    echo $data;
   }
   
   public function car_theory()
   {
        $data=array();
        $this->getTemplate();
        $this->template->write_view('content', 'home/car_theory', $data);
        $this->template->render();
   }
   public function motorcycle_theory(){
        $data=array();
        $this->getTemplate();
        $this->template->write_view('content', 'home/motorcycle_theory', $data);
        $this->template->render();
   }
   public function getDetails(){
            
            $zipcode    = $this->input->post('search_text');   
            
            $zipCode 		= str_replace(' ', '', $zipcode);
        
            $url        = "http://maps.googleapis.com/maps/api/geocode/json?address=".$zipCode."&sensor=false";
            $details    = file_get_contents($url);
            $result     = json_decode($details,true);
            if(!empty($result['results'])){
            $lat1       = $result['results'][0]['geometry']['location']['lat'];
            
            $lon1       = $result['results'][0]['geometry']['location']['lng'];
            $d          = '50';
            //earth's radius in miles
            $r          = 3959;
 
            //compute max and min latitudes / longitudes for search square
            $latN = rad2deg(asin(sin(deg2rad($lat1)) * cos($d / $r) + cos(deg2rad($lat1)) * sin($d / $r) * cos(deg2rad(0))));
            $latS = rad2deg(asin(sin(deg2rad($lat1)) * cos($d / $r) + cos(deg2rad($lat1)) * sin($d / $r) * cos(deg2rad(180))));
            $lonE = rad2deg(deg2rad($lon1) + atan2(sin(deg2rad(90)) * sin($d / $r) * cos(deg2rad($lat1)), cos($d / $r) - sin(deg2rad($lat1)) * sin(deg2rad($latN))));
            $lonW = rad2deg(deg2rad($lon1) + atan2(sin(deg2rad(270)) * sin($d / $r) * cos(deg2rad($lat1)), cos($d / $r) - sin(deg2rad($lat1)) * sin(deg2rad($latN))));
           
            $res  = $this->model_instructor->getNearByZipcode($latN,$latS,$lonE,$lonW,$lat1,$lon1);
            if($res){
                $result['type'] = 'success';
                $result['zipCode']  = $zipCode;
                //$result['res']  = $res;
            }else{
                $result['type'] = 'error';
                $result['message'] = 'Instructor data not found';
            }
            }else{
                $result['type'] = 'error';
                $result['message'] = 'You did not enter a properly formatted post Code.</strong> Please try again.';
            }
            echo json_encode($result);
   }
   
   public function get_instractor(){
            $zipCode =  $this->uri->segment('3');
            $url        = "http://maps.googleapis.com/maps/api/geocode/json?address=".$zipCode."&sensor=false";
            $details    = file_get_contents($url);
            $result     = json_decode($details,true);
            $lat1       = $result['results'][0]['geometry']['location']['lat'];
            
            $lon1       = $result['results'][0]['geometry']['location']['lng'];
            $d          = '50';
            //earth's radius in miles
            $r          = 3959;
 
            //compute max and min latitudes / longitudes for search square
            $latN = rad2deg(asin(sin(deg2rad($lat1)) * cos($d / $r) + cos(deg2rad($lat1)) * sin($d / $r) * cos(deg2rad(0))));
            $latS = rad2deg(asin(sin(deg2rad($lat1)) * cos($d / $r) + cos(deg2rad($lat1)) * sin($d / $r) * cos(deg2rad(180))));
            $lonE = rad2deg(deg2rad($lon1) + atan2(sin(deg2rad(90)) * sin($d / $r) * cos(deg2rad($lat1)), cos($d / $r) - sin(deg2rad($lat1)) * sin(deg2rad($latN))));
            $lonW = rad2deg(deg2rad($lon1) + atan2(sin(deg2rad(270)) * sin($d / $r) * cos(deg2rad($lat1)), cos($d / $r) - sin(deg2rad($lat1)) * sin(deg2rad($latN))));
           
            $data['details']  = $this->model_instructor->getNearByZipcode($latN,$latS,$lonE,$lonW,$lat1,$lon1);
            
            $this->getTemplate();
            $this->template->write_view('content', 'home/get_instractor', $data);
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
