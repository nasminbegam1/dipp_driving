<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Payment extends MY_Controller {


    var $emailTemplate 	= 'dipp_email_template';
    public function __construct(){
        parent::__construct();
        $this->load->model(array('welcome/model_basic', 'payment/model_payment'));
	$this->load->library('form_validation');
        $this->url = base_url().'payment/';
        $this->checkLogin();
	
    }

 
#########################################################
#                FOR  Payment LISTING                   #
#                                                       #
#                                                       #
#                                                       #
#########################################################

    public function index() {
        $this->all();
    }

#########################################################
#                FOR  Payment LISTING                   #
#                                                       #
#                                                       #
#                                                       #
#########################################################

    public function all() {
	
        $this->getTemplate();
        $data['per_page']         = PER_PAGE_LISTING;
	$start                    = 0;
        $data['startRecord']      = $start;
	$data['page']             = $this->uri->segment(3);
        
        $total_user               = $this->model_payment->countPaymentDB();
        $data['totalRecord']      = $total_user;
	$data['search_keyword']   = "";
        if($total_user > 0) {
            /********** FOR PAGINATION ***********/
            $config['base_url'] = base_url().'/payment/all';
            $config['per_page'] =10;
            $config['total_rows'] = $total_user;
            if($this->uri->segment(3)) {
                $config['uri_segment'] = 3;
                if(!is_numeric($this->uri->segment(3))) {
                    $offset=0;
                } else {
                    $offset=abs(ceil($this->uri->segment(3)));
                }
            } else {
                $offset=0;
            }
            $search_by ='';
            $resultArr=$this->model_payment->allPaymentDB($search_by,PER_PAGE_LISTING,$offset);

            if(count($resultArr) > 0) {
                $num = 1+$offset;
                    foreach($resultArr as $values) {
                    $insId         = $values['payment_id'];
                   
                    
                    /********** GET GENERATE EDIT AND DELETE LINK ***********/
                    $this->uri_segment = $this->uri->total_segments();
                    $cur_page           = 0;
                    if ($this->uri->segment($this->uri_segment) != 0) {
                        $this->cur_page = $this->uri->segment($this->uri_segment);
                        $cur_page = (int) $this->cur_page;
                    }

                  

                    if($num%2==0)
                    {
                        $class = 'class="even"';
                    }
                    else
                    {
                        $class = 'class="odd"';
                    }
                    
                    $total_result[]     = array_merge($values,
                                                        array(
                                                            'slno'              => $num,
                                                            'class'             => $class,
                                                            )
                                            );
                    $num++;

                }

                $data['payment_all']        = $total_result;
                /********** FOR PAGINATION ***********/
                $config['cur_tag_open']     = '<span class="current-link">';
                $config['cur_tag_close']    = '</span>';
                $this->pagination->initialize($config);
                $data['paging']             = $this->pagination->create_links();
                $this->template->write_view('content','payment_list',$data);
                $this->template->render();
                
            }
        } else {
            $this->template->write_view('content', 'norecord_payment_list.php');
            $this->template->render();
         }
    }



#########################################################
#                   FOR INSTRUCTOR SEARCH               #
#                                                       #
#                                                       #
#                                                       #
#########################################################

//    public function search(){
//
//        $this->getTemplate();
//        $data['per_page']         = PER_PAGE_LISTING;
//	$start                    = 0;
//        $data['startRecord']      = $start;
//	$data['page']             = $this->uri->segment(3);
//        /********** FOR CATEGORY SEARCH ***********/
//        $search_by ='';
//        if($this->input->get_post('action') == "Process"){
//            $this->session->set_userdata('search_str',trim($this->input->get_post('search_str')));
//        }
//        if($this->session->userdata('search_str')){
//            $search_by = $this->session->userdata('search_str');
//        }
//
//
//        $total_badge=$this->model_badge->countBadgeDB($search_by);
//        $data['totalRecord']      = $total_payment;
//	$data['search_keyword']   = $search_by;
//        if($total_badge > 0)
//        {
//            /********** FOR PAGINATION ***********/
//            $config['base_url'] = base_url().'/payment/all';
//            $config['per_page'] =10;
//            $config['total_rows'] = $total_badge;
//            if($this->uri->segment(3))
//            {
//                $config['uri_segment'] = 3;
//                if(!is_numeric($this->uri->segment(3)))
//                {
//                        $offset=0;
//                }
//                else
//                {
//                        $offset=abs(ceil($this->uri->segment(3)));
//
//                }
//            }
//            else
//            {
//                $offset=0;
//            }
//
//
//            $resultArr=$this->model_badge->allBadgeDB($search_by,$config['per_page'],$offset);
//
//            if(count($resultArr) > 0) {
//                $num    = 1+$offset;
//		foreach($resultArr as $values) {
//                    $insId         = $values['badge_id'];
//                    $insStatus     = $values['badge_status'];
//                    $status_class=($insStatus == 'Active')?'label-green':'label-red'; 
//                    
//                    /********** GET GENERATE EDIT AND DELETE LINK ***********/
//                    $this->uri_segment = $this->uri->total_segments();
//                    $cur_page = 0;
//                    if ($this->uri->segment($this->uri_segment) != 0) {
//                        $this->cur_page = $this->uri->segment($this->uri_segment);
//                        $cur_page = (int) $this->cur_page;
//                    }
//                    $edit_link          = base_url()."badge/edit/".$insId."/".$cur_page."/";
//                    $status_link        = base_url()."badge/changeStatus/".$insId."/".$cur_page;
//                    $delete_link        = base_url()."badge/delete/".$insId."/".$cur_page."/";
//
//                    if($num%2==0)
//                    {
//                        $class = 'class="even"';
//                    }
//                    else
//                    {
//                        $class = 'class="odd"';
//                    }
//
//                    $total_result[]     = array_merge($values,
//                                                        array('slno'        => $num,
//                                                        'class'             => $class,
//                                                        'status_class'      => $status_class,
//                                                        'edit_link'         => $edit_link,
//                                                        'status_link'       => $status_link,        
//                                                        'delete_link'       => $delete_link)
//                                                      );
//                    $num++;
//                }
//
//                $data['badge_all']=$total_result;
//                /********** FOR PAGINATION ***********/
//                $config['cur_tag_open'] = '<span class="current-link">';
//                $config['cur_tag_close'] = '</span>';
//                $this->pagination->initialize($config);
//                $this->session->unset_userdata('search_str');
//                $data['paging'] = $this->pagination->create_links();
//                $this->template->write_view('content','badge_list',$data);
//                $this->template->render();
//            }
//        }
//        else
//        {
//            $this->template->write_view('content', 'norecord_badge_list.php');
//            $this->template->render();
//        }
//    }



}