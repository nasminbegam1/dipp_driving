<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cms extends MY_Controller {

    public function __construct(){
		
        parent::__construct();
        $this->load->model(array('welcome/model_basic', 'cms/model_cms'));
        $this->url = base_url().'cms/';
	$this->load->library('form_validation');
        $this->load->library('fckeditor');
        $this->checkLogin();
    }
	
	/* FOR  CMS LISTING */
	
    public function index() {
        $this->all();
    }

	/*  FOR  CMS LISTING    */

	public function all() {
		$this->getTemplate();
		$total_cms= $this->model_cms->countCmsDB();
		$data['totalRecord'] 	= $total_cms;
		$data['per_page'] 	= PER_PAGE_LISTING;
		$start 			= 0;
		$data['startRecord'] 	= $start;
		$data['page']	 	= $this->uri->segment(3);
		if($total_cms > 0) {
			/********** FOR PAGINATION ***********/
			$config['base_url'] = base_url().'/cms/all';
			$config['per_page'] =PER_PAGE_LISTING;
			$config['total_rows'] = $total_cms;
			if($this->uri->segment(3)) {
				$config['uri_segment'] = 3;
				if(!is_numeric($this->uri->segment(3))) {
					$offset=0;
				}
				else {
					$offset= abs(ceil($this->uri->segment(3)));
				}
			}
			else {
				$offset=0;
			}
			$search_by ='';
			$resultArr= $this->model_cms->allCmsDB($search_by,$config['per_page'],$offset);
			//pr($resultArr);
	
			if(count($resultArr) > 0) {
				$num = 1+$offset;
				foreach($resultArr as $values) {
					$contentID= $values['cms_id'];
					$contentTitle= stripslashes($values['cms_title']);
					$contentRef= stripslashes($values['cms_slug']);
					$metaTitle= stripslashes($values['cms_meta_title']);
					$metaKey= stripslashes($values['cms_meta_key']);
					$metaDesc= stripslashes($values['cms_meta_desc']);
					$content= $values['cms_content'];
					$contentStatus= $values['cms_status'];
					$status_class=($contentStatus == 'Active')?'label-green':'label-red';    
	
					/********** GET GENERATE EDIT AND DELETE LINK ***********/
					$this->uri_segment= $this->uri->total_segments();
					$cur_page= 0;
					if ($this->uri->segment($this->uri_segment) != 0) {
						$this->cur_page = $this->uri->segment($this->uri_segment);
						$cur_page = (int) $this->cur_page;
					}
	
					$edit_link= base_url()."cms/edit/".$contentID."/".$cur_page."/";
					$status_link= base_url()."cms/changeStatus/".$contentID."/".$cur_page;
					$delete_link= base_url()."cms/delete/".$contentID."/".$cur_page."/";
	
                                        if($num%2==0)
                                        {
                                        $class = 'class="even"';
                                        }
                                        else
                                        {
                                        $class = 'class="odd"';
                                        }
					$total_result[]= array_merge($values,
														array(
															'slno'          => $num,
															'class'         => $class,
															'status_class'  => $status_class,
															'edit_link'     => $edit_link,
															'status_link'   => $status_link,
															'delete_link'   => $delete_link
														)
												);
					$num++;
				}
				$data['cms_all']= $total_result;
				$data['search_keyword']    = '';
				/********** FOR PAGINATION ***********/
				$config['cur_tag_open']= '<span class="current-link">';
				$config['cur_tag_close']= '</span>';
				$this->pagination->initialize($config);
				$data['paging']= $this->pagination->create_links();
				$this->template->write_view('content','cms_list',$data);
				$this->template->render();
			}
		}
		else {
			$this->template->write_view('content', 'norecord_cms_list.php');
			$this->template->render();
		}
	}




    /* FOR CMS SEARCH 	*/

	public function search(){
		$this->getTemplate();
		/********** FOR CMS SEARCH ***********/
		$search_by ='';
		if($this->input->get_post('action') == "Process"){
			$this->session->set_userdata('search_str',trim($this->input->get_post('search_str')));
		}
		if($this->session->userdata('search_str')){
			$search_by = $this->session->userdata('search_str');
		}
		//echo $search_by;
	
	
		$total_cms=$this->model_cms->countCmsDB($search_by);
		
		$data['totalRecord'] 	= $total_cms;
		$data['per_page'] 	= PER_PAGE_LISTING;
		$start 			= 0;
		$data['startRecord'] 	= $start;
		$data['page']	 	= $this->uri->segment(3);
		
		if($total_cms > 0){
			/********** FOR PAGINATION ***********/
			$config['base_url'] = base_url().'/cms/all';
			$config['per_page'] =4;
			$config['total_rows'] = $total_cms;
			if($this->uri->segment(3)){
				$config['uri_segment'] = 3;
				if(!is_numeric($this->uri->segment(3))){
					$offset=0;
				}
				else{
					$offset=abs(ceil($this->uri->segment(3)));
				}
			}
			else{
				$offset=0;
			}
	
			$resultArr=$this->model_cms->allCmsDB($search_by,$config['per_page'],$offset);
	
			if(count($resultArr) > 0) {
				$num= 1+$offset;
				foreach($resultArr as $values) {
					$cmsID= $values['cms_id'];
					$contentTitle= stripslashes($values['cms_title']);
					$contentRef= stripslashes($values['cms_slug']);
					$metaTitle= stripslashes($values['cms_meta_title']);
					$metaKey= stripslashes($values['cms_meta_key']);
					$metaDesc= stripslashes($values['cms_meta_desc']);
					$content= $values['cms_content'];
					$contentStatus= $values['cms_status'];
					$status_class=($contentStatus == 'Active')?'label-green':'label-red';      
		
					/********** GET GENERATE EDIT AND DELETE LINK ***********/
					$this->uri_segment = $this->uri->total_segments();
					$cur_page= 0;
					if ($this->uri->segment($this->uri_segment) != 0) {
						$this->cur_page = $this->uri->segment($this->uri_segment);
						$cur_page = (int) $this->cur_page;
					}
					$edit_link= base_url()."cms/edit/".$cmsID."/".$cur_page."/";
					$status_link= base_url()."cms/changeStatus/".$cmsID."/".$cur_page;
					$delete_link= base_url()."cms/delete/".$cmsID."/".$cur_page."/";
		
					if($num%2==0)
                                        {
                                            $class = 'class="even"';
                                        }
                                        else
                                        {
                                            $class = 'class="odd"';
                                        }
		
					$total_result[]= array_merge($values,
														array(	'slno' => $num,
																'class' => $class,
																'status_class' => $status_class,
																'edit_link' => $edit_link,
																'status_link' => $status_link,        
																'delete_link' => $delete_link)
															);
					$num++;
				}
		
				$data['cms_all']=$total_result;
				$data['search_keyword'] = $search_by;
				/********** FOR PAGINATION ***********/
				$config['cur_tag_open'] = '<span class="current-link">';
				$config['cur_tag_close'] = '</span>';
				
				$this->pagination->initialize($config);
				$this->session->unset_userdata('search_str');
				$data['paging'] = $this->pagination->create_links();
		
				$this->template->write_view('content','cms_list',$data);
				$this->template->render();
			}
		}
		else{
			$this->template->write_view('content', 'norecord_cms_list.php');
			$this->template->render();
		}
	}

	
	

	/*  FOR EDIT CMS */

	public function edit() {
		$this->getTemplate();
		$data= array();
		$content_id= $this->uri->segment(3, 0);
		$data['base_url']= $this->config->item('base_url');
		$data['cms_id']= $content_id;
		$data['page']= $this->uri->segment(4, 0);
                
                $path = '../js/ckfinder';
                $width = '850px';
                $this->editor($path, $width);
		
		$this->fckeditor->InstanceName = 'content';
		
		$conditionArr= array('cms_id'=>$data['cms_id']);
		$cms_exist= $this->model_cms->cmsExistsDB($conditionArr);
		if($content_id== 0 || !is_numeric($content_id) || !$cms_exist) { 
			redirect('cms/index');
		}
                
                $cms_data= $this->model_cms->detailsCmsDB($conditionArr);
		$data['cms_id']= $cms_data[0]['cms_id'];
		$data['cms_title']= stripslashes($cms_data[0]['cms_title']);
		$data['cms_slug']= stripslashes($cms_data[0]['cms_slug']);
		$data['cms_meta_title']= stripslashes($cms_data[0]['cms_meta_title']);
		$data['cms_meta_key']= stripslashes($cms_data[0]['cms_meta_key']);
		$data['cms_meta_desc']= stripslashes($cms_data[0]['cms_meta_desc']);
		$data['cms_content']= stripslashes($cms_data[0]['cms_content']);
		
		$this->fckeditor->Value= $cms_data[0]['cms_content'];
		
		if($this->input->get_post('action') == 'Process') { 		
			
                        $this->form_validation->set_rules('cms_title', 'Content Title', 'trim|required');
			$this->form_validation->set_rules('cms_slug', 'Content Reference', 'trim|required');
			$this->form_validation->set_rules('cms_meta_title', 'Meta Title', 'trim|required');
			$this->form_validation->set_rules('cms_meta_key', 'Meta Key', 'trim|required');
			$this->form_validation->set_rules('cms_meta_desc', 'Meta Description', 'trim|required');
			$this->form_validation->set_rules('cms_content', 'Content', 'required');

			if ($this->form_validation->run() == TRUE){ 
                                
                                $data['cms_title']= addslashes(trim($this->input->get_post('cms_title')));
				$data['cms_slug']= addslashes(trim($this->input->get_post('cms_slug')));
				$data['cms_meta_title']= addslashes(trim($this->input->get_post('cms_meta_title')));
				$data['cms_meta_key']= addslashes(trim($this->input->get_post('cms_meta_key')));
				$data['cms_meta_desc']= addslashes(trim($this->input->get_post('cms_meta_desc')));
				$data['cms_content']= trim($this->input->get_post('cms_content'));
                                
                                $updateArr= array(
                                        'cms_title' => $data['cms_title'],
                                        'cms_slug' => $data['cms_slug'],
                                        'cms_meta_title' => $data['cms_meta_title'],
                                        'cms_meta_key' => $data['cms_meta_key'],
                                        'cms_meta_desc' => $data['cms_meta_desc'],
                                        'cms_content' => $data['cms_content'],
                                        'cms_updated_on' => date('Y-m-d')
                                );
                                
                                $update= $this->model_cms->editCmsDB($updateArr,$conditionArr);

                                if($update) {
                                        $this->session->set_flashdata('message', array('title'=>'Update Content','content'=>'Data have been successfully edited.','type'=>'successmsgbox'));
                                        redirect(base_url()."cms/all/".$data['page']."/");
                                }
                                else {
                                        $this->session->set_flashdata('message', array('title'=>'Update Content','content'=>'Unable to edit data. Please try again.','type'=>'errormsgbox'));
                                        redirect('cms/edit/'.$cms_id);
                                }
			}
                         else {
                        $data['validation_error']=validation_errors();
                        $this->session->set_flashdata('message', array('title'=>'Edit CMS','content'=>$data['validation_error'],'type'=>'errormsgbox'));
                        redirect('cms/edit/'.$cms_id);
                    }
                    
		}
		$data['return_link'] = base_url()."cms/all/".$data['page'];
		$this->template->write_view('content','edit_cms',$data);
		$this->template->render();
	}


    /* FOR CMS DELETE  */
	
	public function delete(){ 
		$data= array();
		$content_id= $this->uri->segment(3, 0);
		$data['base_url']= $this->config->item('base_url');
		$data['cms_id']= $content_id;
		
		$conditionArr= array('cms_id' => $data['cms_id']);
		$cms_exist= $this->model_cms->cmsExistsDB($conditionArr);
		
		if($cms_exist){
			$delete= $this->model_cms->deleteCmsDB($conditionArr);
			if($delete){
				$this->session->set_flashdata('message', array('title'=>'Delete Cms','content'=>'Data have been successfully deleted.','type'=>'successmsgbox'));
				redirect(base_url()."cms/all/".$data['page']."/");
			}
			else{
				$this->session->set_flashdata('message', array('title'=>'Delete Cms','content'=>'Unable to delete data. Please try again.','type'=>'errormsgbox'));
				redirect('cms/edit/'.$cms_id);
			}
		}
	}
	
	/*  FOR CMS STATUS CHANGE */            

		public function changeStatus($id) {
		$conditionArr     	= array('cms_id'=>$id);
		$content_id       	= $this->uri->segment(3, 0);
		$data['cms_id']         = $content_id;
		$data['page']     	= $this->uri->segment(4, 0);
		$checkExist       	= $this->model_cms->cmsExistsDB($conditionArr);
		if($checkExist) {
			$this->model_cms->statusChangeCmsDB($id);
			$this->session->set_flashdata('message', array('title'=>'Content Status','content'=>'Content status has been changed','type'=>'successmsgbox'));
			redirect(base_url()."cms/all/".$data['page']);
		}
    }
	
	
	/* FOR PROPER YOUTUBE NAME CHECK */
}