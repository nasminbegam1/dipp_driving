<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Video_tutorial extends MY_Controller {

   
    public function __construct()
    {
        parent::__construct();
	$this->load->model(array('welcome/model_basic'));
        $this->load->library('form_validation');
        $this->url = base_url().'video_tutorial/';
    }

/**
*
* @Frontend landing page
*
*
*/
    public function index()
    {
	//$this->chk_payment();
	$this->chk_login();
	$data=array();
	$this->getTemplate();
        $this->template->write_view('content', 'video_tutorial/index', $data);
        $this->template->render();
    }

}


/* End of file hmvc.php */
/* Location: ./application/widgets/hmvc/controllers/hmvc.php */
