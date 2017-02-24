<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends MY_Controller {



    public function __construct(){
        parent::__construct();
        $this->load->model(array('welcome/model_basic', 'user/model_user'));
	$this->load->library('form_validation');
        $this->url = base_url().'user/';
        //$this->checkLogin();
    }

 
#########################################################
#                FOR  USER LISTING                      #
#                                                       #
#                                                       #
#                                                       #
#########################################################

    public function index() {
        $this->all();
	}

#########################################################
#                FOR  USER LISTING                      #
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
        
        $total_user               = $this->model_user->countUserDB();
        $data['totalRecord']      = $total_user;
	$data['search_keyword']   = "";
        if($total_user > 0) {
            /********** FOR PAGINATION ***********/
            $config['base_url'] = base_url().'/user/all';
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
            $resultArr=$this->model_user->allUserDB($search_by,PER_PAGE_LISTING,$offset);
            //pr($resultArr);

            if(count($resultArr) > 0) {
                $num = 1+$offset;
                    foreach($resultArr as $values) {
                    $userId         = $values['user_id'];
                    $userStatus     = $values['user_status'];
                    $status_class=($userStatus == 'Active')?'label-green':'label-red';    
                    
                    /********** GET GENERATE EDIT AND DELETE LINK ***********/
                    $this->uri_segment = $this->uri->total_segments();
                    $cur_page           = 0;
                    if ($this->uri->segment($this->uri_segment) != 0) {
                        $this->cur_page = $this->uri->segment($this->uri_segment);
                        $cur_page = (int) $this->cur_page;
                    }

                    $edit_link          = base_url()."user/edit/".$userId."/".$cur_page."/";
                    $status_link        = base_url()."user/changeStatus/".$userId."/".$cur_page;
                    $delete_link        = base_url()."user/delete/".$userId."/".$cur_page."/";

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
                                                            'status_link'       => $status_link,
                                                            'delete_link'       => $delete_link
                                                            )
                                            );
                    $num++;

                }

                $data['user_all']        = $total_result;
                /********** FOR PAGINATION ***********/
                $config['cur_tag_open']     = '<span class="current-link">';
                $config['cur_tag_close']    = '</span>';
                $this->pagination->initialize($config);
                $data['paging']             = $this->pagination->create_links();
                $this->template->write_view('content','user_list',$data);
                $this->template->render();
                
            }
        } else {
            $this->template->write_view('content', 'norecord_user_list.php');
            $this->template->render();
         }
    }



#########################################################
#                   FOR USER SEARCH                     #
#                                                       #
#                                                       #
#                                                       #
#########################################################

    public function search(){

        $this->getTemplate();
        $data['per_page']         = PER_PAGE_LISTING;
	$start                    = 0;
        $data['startRecord']      = $start;
	$data['page']             = $this->uri->segment(3);
        /********** FOR CATEGORY SEARCH ***********/
        $search_by ='';
        if($this->input->get_post('action') == "Process"){
            $this->session->set_userdata('search_str',trim($this->input->get_post('search_str')));
        }
        if($this->session->userdata('search_str')){
            $search_by = $this->session->userdata('search_str');
        }


        $total_user=$this->model_user->countUserDB($search_by);
        $data['totalRecord']      = $total_user;
	$data['search_keyword']   = $search_by;
        if($total_user > 0)
        {
            /********** FOR PAGINATION ***********/
            $config['base_url'] = base_url().'/user/all';
            $config['per_page'] =10;
            $config['total_rows'] = $total_user;
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


            $resultArr=$this->model_user->allUserDB($search_by,$config['per_page'],$offset);

            if(count($resultArr) > 0) {
                $num    = 1+$offset;
				foreach($resultArr as $values) {
                    $userId          = $values['user_id'];
                    $userStatus      = $values['user_status'];
                    $status_class=($userStatus == 'Active')?'label-green':'label-red';  
                    
                    /********** GET GENERATE EDIT AND DELETE LINK ***********/
                    $this->uri_segment = $this->uri->total_segments();
                    $cur_page = 0;
                    if ($this->uri->segment($this->uri_segment) != 0) {
                        $this->cur_page = $this->uri->segment($this->uri_segment);
                        $cur_page = (int) $this->cur_page;
                    }
                    $edit_link          = base_url()."user/edit/".$catId."/".$cur_page."/";
                    $status_link        = base_url()."user/changeStatus/".$userId."/".$cur_page;
                    $delete_link        = base_url()."user/delete/".$userId."/".$cur_page."/";

                    if($num%2==0)
                    {
                        $class = 'class="even"';
                    }
                    else
                    {
                        $class = 'class="odd"';
                    }

                    $total_result[]     = array_merge($values,
                                                        array('slno'        => $num,
                                                        'class'             => $class,
                                                        'status_class'      => $status_class,
                                                        'edit_link'         => $edit_link,
                                                        'status_link'       => $status_link,        
                                                        'delete_link'       => $delete_link)
                                                      );
                    $num++;
                }

                $data['user_all']=$total_result;
                /********** FOR PAGINATION ***********/
                $config['cur_tag_open'] = '<span class="current-link">';
                $config['cur_tag_close'] = '</span>';
                $this->pagination->initialize($config);
                $this->session->unset_userdata('search_str');
                $data['paging'] = $this->pagination->create_links();
                $this->template->write_view('content','user_list',$data);
                $this->template->render();
            }
        }
        else
        {
            $this->template->write_view('content', 'norecord_user_list.php');
            $this->template->render();
        }
    }

#########################################################
#                   FOR ADD USER                        #
#                                                       #
#                                                       #
#                                                       #
#########################################################
    public function add() {
        $this->getTemplate();
        $data                                   = array();
        $data['base_url']                       = $this->config->item('base_url');
        $data['frmAction']                      = base_url()."category/add";
        $data['cat_name']                       = '';
        $data['validation_error']               = '';
        
        if($this->input->get_post('action') == "Process") {
            $this->form_validation->set_rules('cat_name','Name','required');
            $data['cat_name']  = addslashes(trim($this->input->get_post('cat_name')));
            if ($this->form_validation->run() == TRUE )
            {
                $insertArr      = array(
                                    'cat_name'      => $data['cat_name'],
                                    'cat_added_on'  => date('Y-m-d H:i:s'),
                                    'cat_status'    => 'Active'
                                    );
                //pr($insertArr);
                $lastId=$this->model_category->addCategoryDB($insertArr);
                if($lastId <> '') {
                    $this->session->set_flashdata('message', array('title'=>'Add Category','content'=>'A new category succesfully added','type'=>'successmsgbox'));
                    redirect(base_url()."category");
                } else {
                    $this->session->set_flashdata('message', array('title'=>'Add Category','content'=>'Unable to add category.please try again','type'=>'errormsgbox'));
                    redirect(base_url()."category/add");
                }
            }
            else {
                $data['validation_error']=validation_errors();
                $this->session->set_flashdata('message', array('title'=>'Add Category','content'=>$data['validation_error'],'type'=>'errormsgbox'));
                redirect(base_url()."category/add");
             }
        }
        $this->template->write_view('content','add_category',$data);
        $this->template->render();
        
    }


#########################################################
#                   FOR EDIT USER                       #
#                                                       #
#                                                       #
#                                                       #
#########################################################
    public function edit() {
            $this->getTemplate();
            $data=array();
            $data['base_url']           = $this->config->item('base_url');
            $user_id                    = $this->uri->segment(3, 0);
            $data['user_id']            = $user_id;
            $data['page']               = $this->uri->segment(4, 0);
            $conditionArr               = array('user_id'=>$data['user_id']);
            $user_exist                 = $this->model_user->userExistsDB($conditionArr);
            if($user_id == 0 || !is_numeric($user_id) || !$user_exist) {
                    redirect('user/index');
            }

            $category_data              = $this->model_user->detailsUserDB($conditionArr);
            $data['user_fname']         = stripslashes($category_data[0]['user_fname']);
            $data['user_lname']         = stripslashes($category_data[0]['user_lname']);
            $data['user_email']         = stripslashes($category_data[0]['user_email']);
            $data['validation_error']   = '';
           
            if($this->input->get_post('action') == "Process") {
                $this->form_validation->set_rules('user_fname','Name','required');
                $this->form_validation->set_rules('user_lname','Name','required');
                $this->form_validation->set_rules('user_email','Name','required');
                
                $data['user_fname']   = addslashes(trim($this->input->get_post('user_fname')));
                $data['user_lname']   = addslashes(trim($this->input->get_post('user_lname')));
                $data['user_email']   = addslashes(trim($this->input->get_post('user_email')));
                if ($this->form_validation->run() == TRUE )
                {
                    $updateArr          = array(
                                        'user_fname'       => $data['user_fname'],
                                        'user_lname'       => $data['user_lname'],
                                        'user_email'       => $data['user_email'],
                                        'user_updated_on'  => date('Y-m-d H:i:s'),
                                        );

                    $update             = $this->model_user->editUserDB($updateArr,$conditionArr);
                    if($update) {
                        $this->session->set_flashdata('message', array('title'=>'Update User','content'=>'Data have been successfully edited.','type'=>'successmsgbox'));
                        redirect(base_url()."user/all/".$data['page']."/");
                      } else {
                        $this->session->set_flashdata('message', array('title'=>'Update User','content'=>'Unable to edit data. Please try again.','type'=>'errormsgbox'));
                        redirect('user/edit/'.$user_id);
                    }
                
                } 
             else {
                $data['validation_error']=validation_errors();
                $this->session->set_flashdata('message', array('title'=>'Edit Category','content'=>$data['validation_error'],'type'=>'errormsgbox'));
                redirect('user/edit/'.$user_id);
             }
                
            }
            $data['return_link'] = base_url()."user/";
            $this->template->write_view('content','edit_user',$data);
            $this->template->render();
            
        }



#########################################################
#                FOR  CATEGORY STATUS CHANGE            #
#                                                       #
#                                                       #
#                                                       #
#########################################################

        function changeStatus($id) {
            $conditionArr           = array('user_id'=>$id);
            $user_id                = $this->uri->segment(3, 0);
            $data['user_id']        = $user_id;
            $data['page']           = $this->uri->segment(4, 0);
            $checkExist             = $this->model_user->userExistsDB($conditionArr);
            if($checkExist) {
                $this->model_user->statusChangeUserDB($id);
                $this->session->set_flashdata('message', array('title'=>'User Status','content'=>'User status has been changed','type'=>'successmsgbox'));
                redirect(base_url()."user/all/".$data['page']);
            }

        }
        

}


