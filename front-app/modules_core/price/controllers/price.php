<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Price extends MY_Controller {
    
    public function __construct()
    {
	parent::__construct();
	$this->load->model(array('model_login','welcome/model_basic'));
	$this->load->library('form_validation');
	$this->url = base_url().'price/';
    }

    /**
    *
    * @Frontend landing page
    *
    *
    */
    public function index()
    {
	$this->chk_not_login_both();
	$data=array();
	$data['cms'] 			= $this->model_basic->detailsDB(CMS,array('cms_id'=>'10'),array('cms_content'));
	$data['packages_details'] 	= $this->model_basic->detailsDB(PACKAGE,array('package_status'=>'Active'));
	//pr($data);
	$this->getTemplate();
        $this->template->write_view('content', 'price/index', $data);
        $this->template->render();
    }


}


/* End of file hmvc.php */
/* Location: ./application/widgets/hmvc/controllers/hmvc.php */
