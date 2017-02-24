<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends MY_Controller {


    public function __construct()
    {
        parent::__construct();
        $this->url = base_url().'dashboard/';
        //$this->checkLogin();
    }

/**
*
* @Admin dashboard page
*
*
*/
    public function index()
    {   
        $this->getTemplate();
        $this->template->write_view('content', 'dashboard');
        $this->template->render();
    }


}

/* End of file welcome.php */
/* Location: ./application/controllers/dashboard.php */