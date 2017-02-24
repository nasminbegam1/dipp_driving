<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sitesettings extends MY_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model(array('sitesettings/model_sitesettings'));
	$this->load->library('form_validation');
        $this->url = base_url().'sitesettings/';
        $this->checkLogin();
    }

#########################################################
#                FOR  SITESETTINGS LISTING              #
#########################################################

    public function index() { 
        $this->all();
	}

#########################################################
#                FOR  SITESETTINGS LISTING              #
#########################################################

    public function all()
    {
	
	$this->getTemplate();
        $total_record      = $this->model_sitesettings->countSitesettingsDB();
	
	$data['totalRecord'] 	= $total_record;
	$data['per_page'] 	= PER_PAGE_LISTING;
	$start 			= 0;
        $data['startRecord'] 	= $start;
	$data['page']	 	= $this->uri->segment(3);
	$data['search_keyword']	= '';
	
	//if($total_course > 0) {
            /********** FOR PAGINATION ***********/
            $config['base_url'] = base_url().'/sitesettings/index';
            $config['per_page'] = PER_PAGE_LISTING;
            $config['total_rows'] = $total_record;
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
            $resultArr=$this->model_sitesettings->allSitesettingsDB($search_by,PER_PAGE_LISTING,$offset);
            
	    //pr($resultArr);
	    
            if(count($resultArr) > 0) {
                $num = 1+$offset;
				foreach($resultArr as $values) {
                    $id          = $values['sitesettings_id'];
                    $status      = $values['status'];
                    $status_class=($status == 'Active')?'label-green':'label-red';    
                    
                    /********** GET GENERATE EDIT AND DELETE LINK ***********/
                    $this->uri_segment = $this->uri->total_segments();
                    $cur_page           = 0;
                    if ($this->uri->segment($this->uri_segment) != 0) {
                        $this->cur_page = $this->uri->segment($this->uri_segment);
                        $cur_page = (int) $this->cur_page;
                    }

                    $edit_link          = base_url()."sitesettings/edit/".$id."/".$cur_page."/";
                    $status_link        = base_url()."sitesettings/changeStatus/".$id."/".$cur_page;

                    if($num%2 == 0) {
                        $bgcolor='#CCCCCC';
                    } else {
                        $bgcolor='#eeeeee';
                    }
                    
                    $total_result[]     = array_merge($values,
                                                        array(
                                                            'slno'              => $num,
                                                            'bgcolor'           => $bgcolor,
                                                            'status_class'      => $status_class,
                                                            'edit_link'         => $edit_link,
                                                            'status_link'       => $status_link
                                                            )
                                            );
                    $num++;

                }

                $data['sitesettings_all']	= $total_result; 
                /********** FOR PAGINATION ***********/
                $config['cur_tag_open']     = '<span class="current-link">';
                $config['cur_tag_close']    = '</span>';
                $this->pagination->initialize($config);
                $data['paging']             = $this->pagination->create_links();
                $this->template->write_view('content','sitesettings_list',$data);
                $this->template->render();
                
            }
        //} else {
        //    $this->template->write_view('content', 'norecord_course_list.php');
        //    $this->template->render();
        // }
    }



#########################################################
#                   FOR SITESETTINGS SEARCH             #
#########################################################

    public function search(){

        $this->getTemplate();
        /********** FOR SITESETTINGS SEARCH ***********/
        $search_by ='';
        if($this->input->get_post('action') == "Process"){
            $this->session->set_userdata('search_str',trim($this->input->get_post('search_str')));
        }
        if($this->session->userdata('search_str')){
            $search_by = $this->session->userdata('search_str');
        }


        $total_record = $this->model_sitesettings->countSitesettingsDB($search_by); //echo $total_record;
	
	$data['totalRecord'] 	= $total_record;
	$data['per_page'] 	= PER_PAGE_LISTING;
	$start 			= 0;
        $data['startRecord'] 	= $start;
	$data['page']	 	= $this->uri->segment(3);
	
        //if($total_step > 0)
        //{
            /********** FOR PAGINATION ***********/
            $config['base_url'] = base_url().'/sitesettings/all';
            $config['per_page'] =PER_PAGE_LISTING;
            $config['total_rows'] = $total_record;
            if($this->uri->segment(3))
            {
                $config['uri_segment'] = 3;
                if(!is_numeric($this->uri->segment(3)))
                {
                        $offset=0;
                }
                else
                {
                        $offset=abs(ceil($this->uri->segment(3)));

                }
            }
            else
            {
                $offset=0;
            }


            $resultArr = $this->model_sitesettings->allSitesettingsDB($search_by,$config['per_page'],$offset);
	    
	    if(count($resultArr) > 0)
	    {
		$num    = 1+$offset;
		foreach($resultArr as $values)
		{
		    $id          = $values['sitesettings_id'];
                    $status      = $values['status'];
                    $status_class=($status == 'Active')?'label-green':'label-red';  
                    
                    /********** GET GENERATE EDIT AND DELETE LINK ***********/
                    $this->uri_segment = $this->uri->total_segments();
                    $cur_page = 0;
                    if ($this->uri->segment($this->uri_segment) != 0) {
                        $this->cur_page = $this->uri->segment($this->uri_segment);
                        $cur_page = (int) $this->cur_page;
                    }
		    
                    $edit_link          = base_url()."sitesettings/edit/".$id."/".$cur_page."/";
                    $status_link        = base_url()."sitesettings/changeStatus/".$id."/".$cur_page;
                    

                    if($num%2==0)
                    {
                        $bgcolor='#CCCCCC';
                    }
                    else
                    {
                        $bgcolor='#eeeeee';
                    }

                    $total_result[]     = array_merge($values,
                                                        array('slno'        => $num,
                                                        'bgcolor'           => $bgcolor,
                                                        'status_class'      => $status_class,
                                                        'edit_link'         => $edit_link,
                                                        'status_link'       => $status_link)
                                                      );
                    $num++;
                }
		
	    }

                $data['sitesettings_all']	= $total_result;
		$data['search_keyword']		= $search_by;
		
		/********** FOR PAGINATION ***********/
                $config['cur_tag_open'] = '<span class="current-link">';
                $config['cur_tag_close'] = '</span>';
                $this->pagination->initialize($config);
                $this->session->unset_userdata('search_str');
                $data['paging'] = $this->pagination->create_links();
                $this->template->write_view('content','sitesettings_list',$data);
                $this->template->render();
            
	    
        //}
        //else
        //{
        //    $this->template->write_view('content', 'norecord_course_list.php');
        //    $this->template->render();
        //}
    }

#########################################################
#                   FOR EDIT SITESETTINGS               #
#########################################################

    public function edit()
    {
	
            $this->getTemplate();
            $data=array();
            $data['base_url']           = $this->config->item('base_url');
            $id                     	= $this->uri->segment(3, 0);
            $data['id']             	= $id;
            $data['page']               = $this->uri->segment(4, 0);
            $conditionArr               = array('sitesettings_id'=>$data['id']);
            $record_exist             	= $this->model_sitesettings->sitesettingsExistsDB($conditionArr);
            
	    if($id == 0 || !is_numeric($id) || !$record_exist)
	    {
                    redirect('sitesettings/index');
            }

	    $sitesettings_data          = $this->model_sitesettings->detailsSitesettingsDB($conditionArr);
            $data['sitesettings_lebel']	= stripslashes($sitesettings_data[0]['sitesettings_lebel']);
	    $data['sitesettings_value'] = stripslashes($sitesettings_data[0]['sitesettings_value']);
	    $data['status']  		= stripslashes($sitesettings_data[0]['status']);
	    $data['sitesettings_id']  	= stripslashes($sitesettings_data[0]['sitesettings_id']);
	    
            $data['validation_error']   = '';
           
            if($this->input->get_post('action') == "Process") {
                $this->form_validation->set_rules('sitesettings_value','Sitesettings Value','required');
                $data['sitesettings_value']   = addslashes(trim($this->input->get_post('sitesettings_value')));
                if ($this->form_validation->run() == TRUE )
                {
                    $updateArr          = array(
						'sitesettings_value'    => $data['sitesettings_value'],
						'status'		=> $this->input->get_post('status'),
						'updated_on'   		=> date('Y-m-d H:i:s'),
					      );

                    $update             = $this->model_sitesettings->editSitesettingsDB($updateArr, array('sitesettings_id'=>$data['sitesettings_id']));
                    if($update) {
                        $this->session->set_flashdata('message', array('title'=>'Update Step','content'=>'Data have been successfully edited.','type'=>'successmsgbox'));
                        redirect(base_url()."sitesettings/all/".$data['page']."/");
                      } else {
                        $this->session->set_flashdata('message', array('title'=>'Update Step','content'=>'Unable to edit data. Please try again.','type'=>'errormsgbox'));
                        redirect('sitesettings/edit/'.$id);
                    }
                
                } 
             else {
                $data['validation_error']=validation_errors();
                $this->session->set_flashdata('message', array('title'=>'Edit Sitesettings','content' => $data['validation_error'],'type'=>'errormsgbox'));
                redirect('sitesettings/edit/'.$id);
             }
                
            }
	    
	    $data['return_link'] = base_url()."sitesettings/";
            $this->template->write_view('content','edit_sitesettings',$data); //pr($data);
	    $this->template->render();
            
        }



#########################################################
#                FOR  SITESETTINGS STATUS CHANGE            	#
#########################################################

        function changeStatus($id) {
            $conditionArr           = array('cat_id'=>$id);
            $cat_id                 = $this->uri->segment(3, 0);
            $data['cat_id']         = $cat_id;
            $data['page']           = $this->uri->segment(4, 0);
            $checkExist             = $this->model_sitesettings->categoryExistsDB($conditionArr);
            if($checkExist) {
                $this->model_sitesettings->statusChangeCategoryDB($id);
                $this->session->set_flashdata('message', array('title'=>'Category Status','content'=>'Category status has been changed','type'=>'successmsgbox'));
                redirect(base_url()."category/all/".$data['page']);
            }

        }
        
#########################################################
#                FOR  SITESETTINGS STATUS CHANGE            	#
#########################################################

        function uniqueCheck() {
            if($this->input->get_post('action') && $this->input->get_post('action')=='availability')
            {    
                $cat_name          = trim($this->input->get_post('cat_name'));
                $cat_id            = '';
                if($this->input->get_post('cat_id')) {
                    $cat_id        = trim($this->input->get_post('cat_id'));
                }
                $conditionArr      = array('cat_name'=>$cat_name);
                $checkExist        = $this->model_sitesettings->categoryUniqueDB($conditionArr,$cat_id);
                if($checkExist) {
                    echo '<font color="red">The category <strong>'.$cat_name.'</strong>'.' is already in use.</font>';
                } else {
                    echo 'OK';
                }
            } 

        }

}


