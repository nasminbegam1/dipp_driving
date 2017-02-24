<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category extends MY_Controller {



    public function __construct(){
        parent::__construct();
        $this->load->model(array('welcome/model_basic', 'category/model_category'));
	$this->load->library('form_validation');
        $this->url = base_url().'category/';
        //$this->checkLogin();
    }

function subhra()
{
    echo "hello";
}   
#########################################################
#                FOR  CATEGORY LISTING                  #
#                                                       #
#                                                       #
#                                                       #
#########################################################

    public function index() {
        $this->all();
	}

#########################################################
#                FOR  CATEGORY LISTING                  #
#                                                       #
#                                                       #
#                                                       #
#########################################################

    public function all() {
        $this->getTemplate();
        $total_category      = $this->model_category->countCategoryDB();
        if($total_category > 0) {
            /********** FOR PAGINATION ***********/
            $config['base_url'] = base_url().'/category/all';
            $config['per_page'] =10;
            $config['total_rows'] = $total_category;
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
            $resultArr=$this->model_category->allCategoryDB($search_by,$config['per_page'],$offset);
            //pr($resultArr);

            if(count($resultArr) > 0) {
                $num = 1+$offset;
				foreach($resultArr as $values) {
                    $catId          = $values['cat_id'];
                    $catStatus      = $values['cat_status'];
                    $status_class=($catStatus == 'Active')?'label-green':'label-red';    
                    
                    /********** GET GENERATE EDIT AND DELETE LINK ***********/
                    $this->uri_segment = $this->uri->total_segments();
                    $cur_page           = 0;
                    if ($this->uri->segment($this->uri_segment) != 0) {
                        $this->cur_page = $this->uri->segment($this->uri_segment);
                        $cur_page = (int) $this->cur_page;
                    }

                    $edit_link          = base_url()."category/edit/".$catId."/".$cur_page."/";
                    $status_link        = base_url()."category/changeStatus/".$catId."/".$cur_page;
                    $delete_link        = base_url()."category/delete/".$catId."/".$cur_page."/";

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
                                                            'status_link'       => $status_link,
                                                            'delete_link'       => $delete_link
                                                            )
                                            );
                    $num++;

                }

                $data['category_all']        = $total_result;
                /********** FOR PAGINATION ***********/
                $config['cur_tag_open']     = '<span class="current-link">';
                $config['cur_tag_close']    = '</span>';
                $this->pagination->initialize($config);
                $data['paging']             = $this->pagination->create_links();
                $this->template->write_view('content','category_list',$data);
                $this->template->render();
                
            }
        } else {
            $this->template->write_view('content', 'norecord_category_list.php');
            $this->template->render();
         }
    }



#########################################################
#                   FOR CATEGORY SEARCH                 #
#                                                       #
#                                                       #
#                                                       #
#########################################################

    public function search(){

        $this->getTemplate();
        /********** FOR CATEGORY SEARCH ***********/
        $search_by ='';
        if($this->input->get_post('action') == "Process"){
            $this->session->set_userdata('search_str',trim($this->input->get_post('search_str')));
        }
        if($this->session->userdata('search_str')){
            $search_by = $this->session->userdata('search_str');
        }


        $total_category=$this->model_category->countCategoryDB($search_by);
        if($total_category > 0)
        {
            /********** FOR PAGINATION ***********/
            $config['base_url'] = base_url().'/category/all';
            $config['per_page'] =10;
            $config['total_rows'] = $total_category;
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


            $resultArr=$this->model_category->allCategoryDB($search_by,$config['per_page'],$offset);

            if(count($resultArr) > 0) {
                $num    = 1+$offset;
				foreach($resultArr as $values) {
                    $catId          = $values['cat_id'];
                    $catStatus      = $values['cat_status'];
                    $status_class=($catStatus == 'Active')?'label-green':'label-red';  
                    
                    /********** GET GENERATE EDIT AND DELETE LINK ***********/
                    $this->uri_segment = $this->uri->total_segments();
                    $cur_page = 0;
                    if ($this->uri->segment($this->uri_segment) != 0) {
                        $this->cur_page = $this->uri->segment($this->uri_segment);
                        $cur_page = (int) $this->cur_page;
                    }
                    $edit_link          = base_url()."category/edit/".$catId."/".$cur_page."/";
                    $status_link        = base_url()."category/changeStatus/".$catId."/".$cur_page;
                    $delete_link        = base_url()."category/delete/".$catId."/".$cur_page."/";

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
                                                        'status_link'       => $status_link,        
                                                        'delete_link'       => $delete_link)
                                                      );
                    $num++;
                }

                $data['category_all']=$total_result;
                /********** FOR PAGINATION ***********/
                $config['cur_tag_open'] = '<span class="current-link">';
                $config['cur_tag_close'] = '</span>';
                $this->pagination->initialize($config);
                $this->session->unset_userdata('search_str');
                $data['paging'] = $this->pagination->create_links();
                $this->template->write_view('content','category_list',$data);
                $this->template->render();
            }
        }
        else
        {
            $this->template->write_view('content', 'norecord_category_list.php');
            $this->template->render();
        }
    }

#########################################################
#                   FOR ADD CATEGORY                    #
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
#                   FOR EDIT CATEGORY                   #
#                                                       #
#                                                       #
#                                                       #
#########################################################
    public function edit() {
            $this->getTemplate();
            $data=array();
            $data['base_url']           = $this->config->item('base_url');
            $cat_id                     = $this->uri->segment(3, 0);
            $data['cat_id']             = $cat_id;
            $data['page']               = $this->uri->segment(4, 0);
            $conditionArr               = array('cat_id'=>$data['cat_id']);
            $category_exist             = $this->model_category->categoryExistsDB($conditionArr);
            if($cat_id == 0 || !is_numeric($cat_id) || !$category_exist) {
                    redirect('category/index');
            }

            $category_data              = $this->model_category->detailsCategoryDB($conditionArr);
            $data['cat_name']           = stripslashes($category_data[0]['cat_name']);
            $data['validation_error']   = '';
           
            if($this->input->get_post('action') == "Process") {
                $this->form_validation->set_rules('cat_name','Name','required');
                $data['cat_name']   = addslashes(trim($this->input->get_post('cat_name')));
                if ($this->form_validation->run() == TRUE )
                {
                    $updateArr          = array(
                                        'cat_name'         => $data['cat_name'],
                                        'cat_updated_on'   => date('Y-m-d H:i:s'),
                                        );

                    $update             = $this->model_category->editCategoryDB($updateArr,$conditionArr);
                    if($update) {
                        $this->session->set_flashdata('message', array('title'=>'Update Category','content'=>'Data have been successfully edited.','type'=>'successmsgbox'));
                        redirect(base_url()."category/all/".$data['page']."/");
                      } else {
                        $this->session->set_flashdata('message', array('title'=>'Update Category','content'=>'Unable to edit data. Please try again.','type'=>'errormsgbox'));
                        redirect('category/edit/'.$cat_id);
                    }
                
                } 
             else {
                $data['validation_error']=validation_errors();
                $this->session->set_flashdata('message', array('title'=>'Edit Category','content'=>$data['validation_error'],'type'=>'errormsgbox'));
                redirect('category/edit/'.$cat_id);
             }
                
            }
            $this->template->write_view('content','edit_category',$data);
            $this->template->render();
            
        }



#########################################################
#                FOR  CATEGORY STATUS CHANGE            #
#                                                       #
#                                                       #
#                                                       #
#########################################################

        function changeStatus($id) {
            $conditionArr           = array('cat_id'=>$id);
            $cat_id                 = $this->uri->segment(3, 0);
            $data['cat_id']         = $cat_id;
            $data['page']           = $this->uri->segment(4, 0);
            $checkExist             = $this->model_category->categoryExistsDB($conditionArr);
            if($checkExist) {
                $this->model_category->statusChangeCategoryDB($id);
                $this->session->set_flashdata('message', array('title'=>'Category Status','content'=>'Category status has been changed','type'=>'successmsgbox'));
                redirect(base_url()."category/all/".$data['page']);
            }

        }
        
#########################################################
#                FOR  CATEGORY STATUS CHANGE            #
#                                                       #
#                                                       #
#                                                       #
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
                $checkExist        = $this->model_category->categoryUniqueDB($conditionArr,$cat_id);
                if($checkExist) {
                    echo '<font color="red">The category <strong>'.$cat_name.'</strong>'.' is already in use.</font>';
                } else {
                    echo 'OK';
                }
            } 

        }

}


