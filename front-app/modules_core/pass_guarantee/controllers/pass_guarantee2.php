<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pass_guarantee2 extends MY_Controller {
    
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
    public function index()
    {
	echo 'dd';
	
    }
    
}


/* End of file hmvc.php */
/* Location: ./application/widgets/hmvc/controllers/hmvc.php */
