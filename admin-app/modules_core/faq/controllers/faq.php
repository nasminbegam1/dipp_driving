<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Faq extends MY_Controller {



    public function __construct(){
        parent::__construct();
        $this->load->model(array('welcome/model_basic','faq/model_faq'));
	$this->load->library('form_validation');
        $this->url = base_url().'faq';
        $this->checkLogin();
    }

#########################################################
#                FOR  QUESTION LISTING                  #
#########################################################

    public function index() {
        $this->all();
	}

#########################################################
#                FOR  QUESTION LISTING                   #
#########################################################

    public function all()
    {
	
        
        $this->getTemplate();
        $total_faq  = $this->model_faq->countFaqDB();
	
	$data['totalRecord']      = $total_faq;
	$data['per_page']         = PER_PAGE_LISTING;
	$start                    = 0;
        $data['startRecord']      = $start;
	$data['page']             = $this->uri->segment(3);
	$data['search_keyword']   = "";
	
	if($total_faq > 0) {
            /********** FOR PAGINATION ***********/
            $config['base_url'] = base_url().'/faq/all';
            $config['per_page'] = PER_PAGE_LISTING;
            $config['total_rows'] = $total_faq;
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
            $resultArr=$this->model_faq->allFaqDB($search_by,PER_PAGE_LISTING,$offset);
            //pr($resultArr);

            if(count($resultArr) > 0) {
		    $num = 1+$offset;
                    foreach($resultArr as $values) {
                    $faq_id  = $values['id'];
                    $status       = $values['status'];
                    $status_class =($status == 'Active')?'label-green':'label-red';    
                    
                    /********** GET GENERATE EDIT AND DELETE LINK ***********/
                    $this->uri_segment = $this->uri->total_segments();
                    $cur_page           = 0;
                    if ($this->uri->segment($this->uri_segment) != 0) {
                        $this->cur_page = $this->uri->segment($this->uri_segment);
                        $cur_page = (int) $this->cur_page;
                    }

                    $edit_link          = base_url()."faq/edit/".$faq_id."/".$cur_page."/";
                    $delete_link        = base_url()."faq/delete/".$faq_id."/".$cur_page."/";
		    $view_link          = base_url()."faq/viewFaq/".$faq_id."/".$cur_page."/";
                    $status_link        = base_url()."faq/changeStatus/".$faq_id."/".$cur_page;

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
                                                            'status_class'      => $status_class,
                                                            'edit_link'         => $edit_link,
							    'view_link'		=> $view_link,
                                                            'delete_link'       => $delete_link,
                                                            'status_link'       => $status_link
                                                            )
                                            );
                    $num++;

                }
                //pr($total_result);
                $data['faq_all']        = $total_result;
                /********** FOR PAGINATION ***********/
                $config['cur_tag_open']     = '<span class="current-link">';
                $config['cur_tag_close']    = '</span>';
                $this->pagination->initialize($config);
                $data['paging']             = $this->pagination->create_links();
                $this->template->write_view('content','list',$data);
                $this->template->render();
                
            }
        } else {
            $this->template->write_view('content', 'norecord_list.php');
            $this->template->render();
         }
    }



#########################################################
#                   FOR QUESTION SEARCH                 #
#                                                       #
#                                                       #
#                                                       #
#########################################################

    public function search(){

        $this->getTemplate();
        /********** FOR QUESTION SEARCH ***********/
        $search_by ='';
        if($this->input->get_post('action') == "Process"){
            $this->session->set_userdata('search_str',trim($this->input->get_post('search_str')));
        }
        if($this->session->userdata('search_str')){
            $search_by = $this->session->userdata('search_str');
        }
        //echo $search_by;exit;
        $data['search_keyword'] = $search_by;
        $total_question=$this->model_faq->countFaqDB($search_by);
        $data['totalRecord'] 	= $total_question;
	$data['per_page'] 	= PER_PAGE_LISTING;
	$start 			= 0;
        $data['startRecord'] 	= $start;
	$data['page']	 	= $this->uri->segment(4);
        if($total_question > 0)
        {
            /********** FOR PAGINATION ***********/
            $config['base_url'] = base_url().'/faq/search';
            $config['per_page'] = PER_PAGE_LISTING;
            $config['total_rows'] = $total_question;
            
            if($this->uri->segment(4))
            {
                $config['uri_segment'] = 4;
                if(!is_numeric($this->uri->segment(4)))
                {
                        $offset=0;
                }
                else
                {
                        $offset=abs(ceil($this->uri->segment(4)));

                }
            }
            else
            {
                $offset=0;
            }


            $resultArr = $this->model_faq->allFaqDB($search_by,PER_PAGE_LISTING,$offset);
	    
	    if(count($resultArr) > 0)
	    {
		$num    = 1+$offset;
		foreach($resultArr as $values)
		{
		    $id          	  = $values['id'];
                    $status               = $values['status'];
                    $status_class         = ($status == 'Active')?'label-green':'label-red';  
                    
                    /********** GET GENERATE EDIT AND DELETE LINK ***********/
                    $this->uri_segment = $this->uri->total_segments();
                    $cur_page = 0;
                    if ($this->uri->segment($this->uri_segment) != 0) {
                        $this->cur_page = $this->uri->segment($this->uri_segment);
                        $cur_page = (int) $this->cur_page;
                    }
		    
                    $edit_link          = base_url()."faq/edit/".$id."/".$cur_page."/";
                    $delet_link         = base_url()."faq/delete/".$id."/".$cur_page."/";
                    $status_link        = base_url()."faq/changeStatus/".$id."/".$cur_page;
                    $view_link          = base_url()."faq/viewFaq/".$faq_id."/".$cur_page."/";

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
                                                        'status_class'      => $status_class,   
                                                        'edit_link'         => $edit_link,
							'view_link'		=> $view_link,
                                                        'delete_link'       => $delete_link,    
                                                        'status_link'       => $status_link)
                                                      );
                    $num++;
                }

                $data['faq_all']=$total_result;
                //pr($data['question_all']);
                /********** FOR PAGINATION ***********/
                $config['cur_tag_open'] = '<span class="current-link">';
                $config['cur_tag_close'] = '</span>';
                $this->pagination->initialize($config);
                $this->session->unset_userdata('search_str');
                $data['paging'] = $this->pagination->create_links();
                $this->template->write_view('content','list',$data);
                $this->template->render();
            }
        }
        else
        {
            $this->template->write_view('content', 'norecord_list.php');
            $this->template->render();
        }
    }


#########################################################
#                   FOR ADD QUESTION                    #
#                                                       #
#                                                       #
#                                                       #
#########################################################
    public function add() {
        $this->getTemplate();
        $data                                   = array();
        $data['base_url']                       = $this->config->item('base_url');
        $data['frmAction']                      = base_url()."faq/add";
        $data['question']                       = '';
        $data['validation_error']               = '';
        
        
        if($this->input->get_post('action') == "Process") {
            $this->form_validation->set_rules('question','Question','required');
	    $this->form_validation->set_rules('answer','Answer','required');
	    $this->form_validation->set_rules('type','Type','required');
            $data['question']  			= addslashes(trim($this->input->get_post('question')));
            $data['answer']  			= addslashes(trim($this->input->get_post('answer')));
            $data['type']  			= addslashes(trim($this->input->get_post('type')));
            if ($this->form_validation->run() == TRUE )
            {
                $insertArr      = array(
                                    'question'        	=> $data['question'],
                                    'answer'       	=> $data['answer'],
                                    'added_on' 		=> date('Y-m-d H:i:s'),
				    'type'		=> $data['type']
                                    );
                //pr($insertArr);
                $lastId=$this->model_faq->addFaqDB($insertArr);
                if($lastId <> '') {
                    $this->session->set_flashdata('message', array('title'=>'Add FAQ','content'=>'A new FAQ succesfully added','type'=>'successmsgbox'));
                    redirect(base_url()."faq");
                } else {
                    $this->session->set_flashdata('message', array('title'=>'Add FAQ','content'=>'Unable to add FAQ.please try again','type'=>'errormsgbox'));
                    redirect(base_url()."faq/add");
                }
            }
            else {
                $data['validation_error']=  trim(validation_errors('<p>', '</p>'));
                $this->session->set_flashdata('message', array('title'=>'Add FAQ','content'=>$data['validation_error'],'type'=>'errormsgbox'));
                redirect(base_url()."faq/add");
             }
        }
        $data['return_link'] = base_url()."faq/";
        $this->template->write_view('content','add_faq',$data);
        $this->template->render();
        
    }


#########################################################
#                   FOR EDIT COURSE                   #
#########################################################

    public function edit()
    {
	
            $this->getTemplate();
            $data=array();
            $data['base_url']           = $this->config->item('base_url');
            $faq_id                	= $this->uri->segment(3, 0);
            $data['faq_id']        	= $faq_id;
            $data['page']               = $this->uri->segment(4, 0);
            $conditionArr               = array('id'=>$faq_id);
            $question_exist             = $this->model_faq->faqExistsDB($conditionArr);
            
	    if($faq_id == 0 || !is_numeric($faq_id) || !$faq_id)
	    {
                    redirect('faq/all');
            }
            
            $faq_data                  	    = $this->model_faq->detailsFaqDB($conditionArr);
	    //pr($faq_data);
            $data['question']               = stripslashes($faq_data[0]['question']);
            $data['answer']   		    = stripslashes($faq_data[0]['answer']);
	    $data['type']   		    = stripslashes($faq_data[0]['type']);
            $data['validation_error']       = '';
             
             
            if($this->input->get_post('action') == "Process") {
		//pr($_POST);
                $this->form_validation->set_rules('question','Question','required');
		$this->form_validation->set_rules('answer','Answer','required');
		$this->form_validation->set_rules('faq_type','Type','required');
                $data['question']  	= addslashes(trim($this->input->get_post('question')));
                $data['answer']  	= addslashes(trim($this->input->get_post('answer')));
                $data['faq_type']  	= $this->input->get_post('faq_type');
		// pr( $data['faq_type'] );
                if ($this->form_validation->run() == TRUE )
                {
                    $updateArr      = array(
                                    'question'         	=> $data['question'],
                                    'answer'        	=> $data['answer'],
				     'type'		=> $data['faq_type']
				    );
				   
		 //pr($updateArr);		   
				   
                    $update        = $this->model_faq->editFaqDB($updateArr,$conditionArr);
                    if($update) {
                        $this->session->set_flashdata('message', array('title'=>'Update FAQ','content'=>'Data have been successfully edited.','type'=>'successmsgbox'));
                        redirect(base_url()."faq/all/".$data['page']."/");
                      } else {
                        $this->session->set_flashdata('message', array('title'=>'Update FAQ','content'=>'Unable to edit data. Please try again.','type'=>'errormsgbox'));
                        redirect('faq/edit/'.$question_id);
                    }
                
                } 
             else {
                $data['validation_error']=  trim(validation_errors('<p>', '</p>'));
                $this->session->set_flashdata('message', array('title'=>'Edit FAQ','content' => $data['validation_error'],'type'=>'errormsgbox'));
                redirect('faq/edit/'.$question_id);
             }
                
            }
	    
	    $data['return_link'] = base_url()."faq/";
            $this->template->write_view('content','edit_faq',$data); //pr($data);
	    $this->template->render();
            
        }



#########################################################
#                FOR  COURSE STATUS CHANGE            #
#                                                       #
#                                                       #
#                                                       #
#########################################################

        function changeStatus($id) {
            $conditionArr           = array('id'=>$id);
            $faq_id            	    = $this->uri->segment(3, 0);
            $data['faq_id']    	    = $faq_id;
            $data['page']           = $this->uri->segment(4, 0);
            $checkExist             = $this->model_faq->faqExistsDB($conditionArr);
            if($checkExist) {
                $this->model_faq->statusChangeFaqDB($id);
                $this->session->set_flashdata('message', array('title'=>'FAQ Status','content'=>'FAQ status has been changed','type'=>'successmsgbox'));
                redirect(base_url()."faq/all/".$data['page']);
            }

        }
        

    function viewFaq() {
	    $this->getTemplate();
            $faq_id            	    = $this->uri->segment(3, 0);
            $data['faq_id']    	    = $faq_id;
            $data['page']           = $this->uri->segment(4, 0);
            $checkExist        	    = $this->model_faq->faqExistsDB(array('id'=>$faq_id));
            if($checkExist) {
		$data['details']     = $this->model_faq->detailsFaqDB(array('id'=>$faq_id));
		$data['return_link'] = base_url()."faq/all/".$data['page'];
		$this->template->write_view('content','view_faq',$data); //pr($data);
		$this->template->render();
            }else{
		redirect(base_url()."faq/all/".$data['page']);
	    }

        }
#########################################################
#                   FOR DELETE QUESTION                 #
#########################################################

    public function delete()
    {
	
            $this->getTemplate();
            $data=array();
            $data['base_url']           = $this->config->item('base_url');
            $faq_id                	= $this->uri->segment(3, 0);
            $data['faq_id']        	= $faq_id;
            $data['page']               = $this->uri->segment(4, 0);
            $conditionArr               = array('id'=>$faq_id);
            $faq_exist             	= $this->model_faq->faqExistsDB($conditionArr);
            
	    if($faq_id == 0 || !is_numeric($faq_id) || !$faq_exist)
	    {
                    redirect('faq/all');
            }
            
            if($faq_exist) {
                    $delete = $this->model_faq->deleteFaqDB($conditionArr);
                    if($delete) {
                            $this->session->set_flashdata('message', array('title'=>'Delete FAQ','content'=>'Record deleted successfully.','type'=>'successmsgbox'));
                            redirect(base_url()."faq/all/".$data['page']."/");
                    } else {
                            $this->session->set_flashdata('message', array('title'=>'Delete FAQ','content'=>'Unable to delete the record.!. Please try again.','type'=>'errormsgbox'));
                            redirect(base_url()."faq/all/".$data['page']."/");
                    }

                }
    }     


}


