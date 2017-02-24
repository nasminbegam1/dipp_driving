<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News extends MY_Controller {
   
    var $news = NEWS;
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('welcome/model_authentication','welcome/model_basic'));
        $this->load->library('form_validation');
        $this->url = base_url().'news/';
    }

    /**
    *
    * @Frontend landing page
    *
    *
    */
    public function index()
    {
	$data['result'] = $this->model_basic->detailsDB($this->news,"status = 'Active'");
	$this->getTemplate();
        $this->template->write_view('content', 'news/index', $data);
        $this->template->render();
    }
    public function details(){
	$news_id = $this->uri->segment(3);
	$data['result'] = $this->model_basic->detailsNewsDB($this->news,"id = '".$news_id."'","*,DATE_FORMAT(created_at,'%d-%m-%Y') as news_add_date");
        $this->getTemplate();
        $this->template->write_view('content', 'news/details', $data);
        $this->template->render();
    }


}


/* End of file hmvc.php */
/* Location: ./application/widgets/hmvc/controllers/hmvc.php */
