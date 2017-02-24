<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Faq extends MY_Controller {
   
    var $faq = FAQ;
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('welcome/model_authentication','welcome/model_basic'));
        $this->load->library('form_validation');
        $this->url = base_url().'faq/';
    }

    /**
    *
    * @Frontend landing page
    *
    *
    */
    public function index()
    {
	$instructor_id 	= $this->session->userdata('INSTRUCTOR_ID');
	if(isset($instructor_id) && $instructor_id != '')
	     $data['result'] = $this->model_basic->detailsDB($this->faq,"status = 'Active' AND type='instructor'");
	else $data['result'] = $this->model_basic->detailsDB($this->faq,"status = 'Active' AND type='student'");
	//pr($data);
	//echo $this->db->last_query(); exit;
	$this->getTemplate();
        $this->template->write_view('content', 'faq/index', $data);
        $this->template->render();
    }


}


/* End of file hmvc.php */
/* Location: ./application/widgets/hmvc/controllers/hmvc.php */
