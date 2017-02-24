<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contents extends MY_Controller {



    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('welcome/model_authentication','welcome/model_basic'));
        $this->url = base_url().'contents/';
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
        $this->getTemplate();
        $this->template->write_view('content', 'contents/index', $data);
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
