<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cms extends MY_Controller {
   
    var $CMS = CMS;
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('welcome/model_authentication','welcome/model_basic'));
        $this->load->library('form_validation');
        $this->url = base_url().'cms/';
    }

    /**
    *
    * @Frontend landing page
    *
    *
    */
    public function index()
    {
	$slug = $this->uri->segment(1);
	$data['result'] = $this->model_basic->detailsDB($this->CMS,"cms_slug = '".$slug."'");
	$this->getTemplate();
        $this->template->write_view('content', 'cms/index', $data);
        $this->template->render();
    }

    public function how_it_workes(){
	$data['driving_instructor']         = $this->model_basic->detailsDB(CMS,array('cms_slug'=>'driving-instructor'),array('cms_content'));
        $data['student_learner']            = $this->model_basic->detailsDB(CMS,array('cms_slug'=>'student-learner'),array('cms_content'));
	$this->getTemplate();
        $this->template->write_view('content', 'cms/how_it_workes', $data);
        $this->template->render();
    }
}


/* End of file hmvc.php */
/* Location: ./application/widgets/hmvc/controllers/hmvc.php */
