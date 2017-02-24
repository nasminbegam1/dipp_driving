<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends MY_Controller {



    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('model_authentication','model_basic'));
        $this->url = base_url().'welcome/';
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
	    $this->template->write_view('content', 'welcome/index', $data);
	    $this->template->render();
       }
    
    /**
    *
    * @Frontend country state dropdown
    *
    *
    */
   
   
   public function chkstateExists()
    {
        $this->data ='';
        $country_id = $this->input->post('country_id');
        $recexist = $this->model_basic->getFromWhereSelect(STATE, '*', 'country_id = "'.$country_id.'"');
        $html = '';
        if(is_array($recexist)){
                $this->data['states'] = $this->model_basic->getFromWhereSelect(STATE,'default_name','country_id = "'.$country_id.'"');
                if(is_array($this->data['states']) && count($this->data['states'])>0)
                {
                        $html .= '<select name="state" id="state" class="form-control required">';
                        foreach($this->data['states'] as $state_list)
                        {
                        $html .= '<option value="'.$state_list['default_name'].'">'.$state_list['default_name'].'</option>';	
                        }
                        $html .= '</select>';
                }
                
        }
        else
        {
                $html .= '<input name="state" id="state" class="input-text required" type="text" />';
        }
        
        echo $html;
            
    }
    
    function getProduct()
    {
            $term=$this->input->get_post('term');
            $allProducts = $this->model_basic->allProductDB($term);
            $data = array();
            foreach($allProducts as $val)
            {
                  $data[] = array(
                      'brand_name'=>$val['brand_name'],
                      'value'=>$val['pro_name'],
                      'product_id'=>$val['pro_id']
		);
            }
            echo json_encode($data);
            flush();
    }


}


/* End of file hmvc.php */
/* Location: ./application/widgets/hmvc/controllers/hmvc.php */
