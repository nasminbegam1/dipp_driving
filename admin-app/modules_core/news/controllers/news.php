<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News extends MY_Controller {

    public function __construct(){
		
        parent::__construct();
        $this->load->model(array('welcome/model_basic', 'news/model_news'));
        $this->url = base_url().'news/';
	$this->load->library('form_validation');
        $this->load->library('fckeditor');
        $this->checkLogin();
    }
	
    /* FOR  Packages LISTING */
	
    public function index() {
        $this->all();
    }

    /*  FOR  Packages LISTING    */

    public function all() {
	    $this->getTemplate();
	    $total_news= $this->model_news->countNewsDB();
	    $data['totalRecord']      = $total_news;
	    $data['per_page']         = PER_PAGE_LISTING;
	    $start                    = 0;
	    $data['startRecord']      = $start;
	    $data['page']             = $this->uri->segment(4);
	    $data['search_keyword']   = "";
	    if($total_news > 0) {
		    /********** FOR PAGINATION ***********/
		    $config['base_url'] = base_url().'/news/all';
		    $config['per_page'] =4;
		    $config['total_rows'] = $total_news;
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
		    $resultArr= $this->model_news->allNewsDB($search_by,$config['per_page'],$offset);
		    //pr($resultArr);
    
		    if(count($resultArr) > 0) {
			    $num = 1+$offset;
			    foreach($resultArr as $values) {
				    $id 		= $values['id'];
				    $title 		= stripslashes($values['title']);
				    $description	= stripslashes($values['description']);
				    $contentStatus	= $values['status'];
				    $status_class	= ($contentStatus == 'Active')?'label-green':'label-red';    
    
				    /********** GET GENERATE EDIT AND DELETE LINK ***********/
				    $this->uri_segment  = $this->uri->total_segments();
				    $cur_page= 0;
				    if ($this->uri->segment($this->uri_segment) != 0) {
					    $this->cur_page = $this->uri->segment($this->uri_segment);
					    $cur_page = (int) $this->cur_page;
				    }
    
				    $edit_link= base_url()."news/edit/".$id."/".$cur_page."/";
				    $status_link= base_url()."news/changeStatus/".$id."/".$cur_page;
				    $delete_link= base_url()."news/delete/".$id."/".$cur_page."/";
    
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
    
			    $data['news_all']= $total_result;
			    /********** FOR PAGINATION ***********/
			    $config['cur_tag_open']= '<span class="current-link">';
			    $config['cur_tag_close']= '</span>';
			    $this->pagination->initialize($config);
			    $data['paging']= $this->pagination->create_links();
			    $this->template->write_view('content','news_list',$data);
			    $this->template->render();
		    }
	    }
	    else {
		    $this->template->write_view('content', 'norecord_news_list.php');
		    $this->template->render();
	    }
    }




    /* FOR Packages SEARCH 	*/

	public function search(){
		$this->getTemplate();
		/********** FOR Packages SEARCH ***********/
		$search_by ='';
		if($this->input->get_post('action') == "Process"){
			$this->session->set_userdata('search_str',trim($this->input->get_post('search_str')));
		}
		if($this->session->userdata('search_str')){
			$search_by = $this->session->userdata('search_str');
		}
		//echo $search_by;
		
	
		$total_news=$this->model_news->countNewsDB($search_by);
		$data['totalRecord'] 	= $total_news;
		$data['per_page'] 	= PER_PAGE_LISTING;
		$start 			= 0;
		$data['startRecord'] 	= $start;
		$data['page']	 	= $this->uri->segment(3);
		if($total_news > 0){
			/********** FOR PAGINATION ***********/
			$config['base_url'] = base_url().'/news/all';
			$config['per_page'] =4;
			$config['total_rows'] = $total_news;
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
	
			$resultArr=$this->model_news->allNewsDB($search_by,$config['per_page'],$offset);
	
			if(count($resultArr) > 0) {
				$num= 1+$offset;
				foreach($resultArr as $values) {
				    $id 		= $values['id'];
				    $title 		= stripslashes($values['title']);
				    $contentStatus	= $values['status'];
				    $status_class	= ($contentStatus == 'Active')?'label-green':'label-red';    
    
				    /********** GET GENERATE EDIT AND DELETE LINK ***********/
				    $this->uri_segment  = $this->uri->total_segments();
				    $cur_page= 0;
				    if ($this->uri->segment($this->uri_segment) != 0) {
					    $this->cur_page = $this->uri->segment($this->uri_segment);
					    $cur_page = (int) $this->cur_page;
				    }
    
				    $edit_link= base_url()."news/edit/".$id."/".$cur_page."/";
				    $status_link= base_url()."news/changeStatus/".$id."/".$cur_page;
				    $delete_link= base_url()."news/delete/".$id."/".$cur_page."/";
    
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
		
				$data['news_all']= $total_result;
				$data['search_keyword'] = $search_by;
				/********** FOR PAGINATION ***********/
				$config['cur_tag_open'] = '<span class="current-link">';
				$config['cur_tag_close'] = '</span>';
				
				$this->pagination->initialize($config);
				$this->session->unset_userdata('search_str');
				$data['paging'] = $this->pagination->create_links();
		
				$this->template->write_view('content','news_list',$data);
				$this->template->render();
			}
		}
		else{
			$this->template->write_view('content', 'norecord_news_list.php');
			$this->template->render();
		}
	}

	
	
#########################################################
#                   FOR ADD PACKAGES                    #
#                                                       #
#                                                       #
#                                                       #
#########################################################
    public function add() {
        $this->getTemplate();
        $data                                   = array();
        $data['base_url']                       = $this->config->item('base_url');
        $data['frmAction']                      = base_url()."news/add";
        $data['question']                       = '';
        $data['validation_error']               = '';
        $path 					= '../js/ckfinder';
	$width 					= '850px';
	$this->editor($path, $width);
	
	$this->fckeditor->InstanceName = 'description';
	
        if($this->input->get_post('action') == "Process") {
            $this->form_validation->set_rules('title','News Title','required');
            $this->form_validation->set_rules('description','News Description','required');
	    
            if ($this->form_validation->run() == TRUE )
            {
                
                $news_image=$_FILES['news_image']['name'];
                if($news_image <> '') {
                    $mainUpload       = $this->imageUpload('news_image','news','Y',300,200);
                    $image_name       = $mainUpload['image_name'];
                } 
                
                
                $insertArr      = array(
                                    'title'            		=> $this->input->post('title'),
                                    'image'            		=> $image_name,
                                    'description'        	=> $this->input->post('description'),
                                    'created_at' 		=> date('Y-m-d H:i:s')
                                    );
                //pr($insertArr);
                $lastId=$this->model_news->addNewsDB($insertArr);
                if($lastId <> '') {
                    $this->session->set_flashdata('message', array('title'=>'Add News','content'=>'A news is succesfully added','type'=>'successmsgbox'));
                    redirect(base_url()."news");
                } else {
                    $this->session->set_flashdata('message', array('title'=>'Add News','content'=>'Unable to add News.please try again','type'=>'errormsgbox'));
                    redirect(base_url()."news/add");
                }
            }
            else {
                $data['validation_error']=  trim(validation_errors('<p>', '</p>'));
                $this->session->set_flashdata('message', array('title'=>'Add News','content'=>$data['validation_error'],'type'=>'errormsgbox'));
                redirect(base_url()."news/add");
             }
        }
        $data['return_link'] = base_url()."news";
        $this->template->write_view('content','add_news',$data);
        $this->template->render();
        
    }

	

	/*  FOR EDIT Packages */

	public function edit() {
		$this->getTemplate();
		$data			= array();
		$content_id		= $this->uri->segment(3, 0);
		$data['base_url']	= $this->config->item('base_url');
		$data['id']		= $content_id;
		$data['page']		= $this->uri->segment(4, 0);
		$path 					= '../js/ckfinder';
		$width 					= '850px';
		$this->editor($path, $width);
		$conditionArr= array('id'=>$data['id']);
		$news_exist= $this->model_news->newsExistsDB($conditionArr);
		if($content_id== 0 || !is_numeric($content_id) || !$news_exist) { 
			redirect('news/index');
		}
                
                $news_data		= $this->model_news->detailsNewsDB($conditionArr);
		$data['id']		= $news_data[0]['id'];
		$data['title']		= stripslashes($news_data[0]['title']);
                $data['image']		= $news_data[0]['image'];
		$data['description']	= stripslashes($news_data[0]['description']);
		$data['status']		= stripslashes($news_data[0]['status']);
		
		
		if($this->input->get_post('action') == 'Process') { 		
			
                        $this->form_validation->set_rules('title','News Title','required');
			$this->form_validation->set_rules('description','News Description','required');

			if ($this->form_validation->run() == TRUE){ 
                                
                                $data['title']		= addslashes(trim($this->input->get_post('title')));
				$data['description']	= addslashes(trim($this->input->get_post('description')));
				$data['status']		= trim($this->input->get_post('status'));
                                
                                $topic_image=$_FILES['news_image']['name'];
                                if($topic_image <> '') {
                                    $mainUpload       = $this->imageUpload('news_image','news','Y',300,200);
                                    $image_name       = $mainUpload['image_name'];
                                }
                                else {
                                    $image_name       = $this->input->get_post('image_name');
                                }
                                
                                $updateArr= array(
                                        'title' 		=> $data['title'],
                                        'image'                 => $image_name,
                                        'description' 		=> $data['description'],
                                        'status' 		=> $data['status']
                                );
                                $update= $this->model_news->editNewsDB($updateArr,$conditionArr);

                                if($update) {
                                        $this->session->set_flashdata('message', array('title'=>'Update Content','content'=>'Data have been successfully edited.','type'=>'successmsgbox'));
                                        redirect(base_url()."news/all/".$data['page']."/");
                                }
                                else {
                                        $this->session->set_flashdata('message', array('title'=>'Update Content','content'=>'Unable to edit data. Please try again.','type'=>'errormsgbox'));
                                        redirect('news/edit/'.$data['id']);
                                }
			}
                         else {
                        $data['validation_error']=preg_replace('/\s+/', ' ',validation_errors('<p>','</p>'));
                        $this->session->set_flashdata('message', array('title'=>'Edit Packages','content'=>$data['validation_error'],'type'=>'errormsgbox'));
                        redirect('news/edit/'.$data['id']);
                    }
                    
		}
		$data['return_link'] = base_url()."news";
		$this->template->write_view('content','edit_news',$data);
		$this->template->render();
	}


    /* FOR CMS DELETE  */
	
	public function delete(){ 
		$data= array();
		$content_id= $this->uri->segment(3, 0);
		$data['base_url']= $this->config->item('base_url');
		$data['id']= $content_id;
		
		$conditionArr= array('id' => $data['id']);
		$news_exist= $this->model_news->newsExistsDB($conditionArr);
		
		if($news_exist){
			$delete= $this->model_news->deleteNewsDB($conditionArr);
			if($delete){
				$this->session->set_flashdata('message', array('title'=>'Delete News','content'=>'Data have been successfully deleted.','type'=>'successmsgbox'));
				redirect(base_url()."news/all/".$data['page']."/");
			}
			else{
				$this->session->set_flashdata('message', array('title'=>'Delete News','content'=>'Unable to delete data. Please try again.','type'=>'errormsgbox'));
				redirect('news/');
			}
		}
	}
	
	/*  FOR CMS STATUS CHANGE */            

	public function changeStatus($id) {
		$conditionArr     	= array('id'=>$id);
		$content_id       	= $this->uri->segment(3, 0);
		$data['id']     	= $content_id;
		$data['page']     	= $this->uri->segment(4, 0);
		$checkExist       	= $this->model_news->newsExistsDB($conditionArr);
		if($checkExist) {
			$this->model_news->statusChangeNewsDB($id);
			$this->session->set_flashdata('message', array('title'=>'Content Status','content'=>'Content status has been changed','type'=>'successmsgbox'));
			redirect(base_url()."news/all/".$data['page']);
		}
    }
	
	
	/* FOR PROPER YOUTUBE NAME CHECK */
}