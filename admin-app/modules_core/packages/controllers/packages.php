<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Packages extends MY_Controller {

    public function __construct(){
		
        parent::__construct();
        $this->load->model(array('welcome/model_basic', 'packages/model_packages'));
        $this->url = base_url().'packages/';
	$this->load->library('form_validation');
        $this->checkLogin();
    }
	
    /* FOR  Packages LISTING */
	
    public function index() {
        $this->all();
    }

    /*  FOR  Packages LISTING    */

    public function all() {
	    $this->getTemplate();
	    $total_packages= $this->model_packages->countPackagesDB();
	    $data['totalRecord']      = $total_packages;
	    $data['per_page']         = PER_PAGE_LISTING;
	    $start                    = 0;
	    $data['startRecord']      = $start;
	    $data['page']             = $this->uri->segment(4);
	    $data['search_keyword']   = "";
	    if($total_packages > 0) {
		    /********** FOR PAGINATION ***********/
		    $config['base_url'] = base_url().'/packages/all';
		    $config['per_page'] =4;
		    $config['total_rows'] = $total_packages;
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
		    $resultArr= $this->model_packages->allPackagesDB($search_by,$config['per_page'],$offset);
		    //pr($resultArr);
    
		    if(count($resultArr) > 0) {
			    $num = 1+$offset;
			    foreach($resultArr as $values) {
				    $package_id 	= $values['package_id'];
				    $package_name 	= stripslashes($values['package_name']);
				    $package_amount	= stripslashes($values['package_amount']);
				    $no_student		= stripslashes($values['no_student']);
				    $contentStatus	= $values['package_status'];
				    $status_class	= ($contentStatus == 'Active')?'label-green':'label-red';    
    
				    /********** GET GENERATE EDIT AND DELETE LINK ***********/
				    $this->uri_segment  = $this->uri->total_segments();
				    $cur_page= 0;
				    if ($this->uri->segment($this->uri_segment) != 0) {
					    $this->cur_page = $this->uri->segment($this->uri_segment);
					    $cur_page = (int) $this->cur_page;
				    }
    
				    $edit_link= base_url()."packages/edit/".$package_id."/".$cur_page."/";
				    $status_link= base_url()."packages/changeStatus/".$package_id."/".$cur_page;
				    $delete_link= base_url()."packages/delete/".$package_id."/".$cur_page."/";
    
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
    
			    $data['packages_all']= $total_result;
			    /********** FOR PAGINATION ***********/
			    $config['cur_tag_open']= '<span class="current-link">';
			    $config['cur_tag_close']= '</span>';
			    $this->pagination->initialize($config);
			    $data['paging']= $this->pagination->create_links();
			    $this->template->write_view('content','packages_list',$data);
			    $this->template->render();
		    }
	    }
	    else {
		    $this->template->write_view('content', 'norecord_packages_list.php');
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
	
	
		$total_packages=$this->model_packages->countPackagesDB($search_by);
		if($total_packages > 0){
			/********** FOR PAGINATION ***********/
			$config['base_url'] = base_url().'/packages/all';
			$config['per_page'] =4;
			$config['total_rows'] = $total_packages;
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
	
			$resultArr=$this->model_packages->allPackagesDB($search_by,$config['per_page'],$offset);
	
			if(count($resultArr) > 0) {
				$num= 1+$offset;
				foreach($resultArr as $values) {
					$package_id 	= $values['package_id'];
				    $package_name 	= stripslashes($values['package_name']);
				    $package_amount	= stripslashes($values['package_amount']);
				    $no_student		= stripslashes($values['no_student']);
				    $contentStatus	= $values['package_status'];
				    $status_class	= ($contentStatus == 'Active')?'label-green':'label-red';    
    
				    /********** GET GENERATE EDIT AND DELETE LINK ***********/
				    $this->uri_segment  = $this->uri->total_segments();
				    $cur_page= 0;
				    if ($this->uri->segment($this->uri_segment) != 0) {
					    $this->cur_page = $this->uri->segment($this->uri_segment);
					    $cur_page = (int) $this->cur_page;
				    }
    
				    $edit_link= base_url()."packages/edit/".$package_id."/".$cur_page."/";
				    $status_link= base_url()."packages/changeStatus/".$package_id."/".$cur_page;
				    $delete_link= base_url()."packages/delete/".$package_id."/".$cur_page."/";
    
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
		
				$data['packages_all']= $total_result;
				/********** FOR PAGINATION ***********/
				$config['cur_tag_open'] = '<span class="current-link">';
				$config['cur_tag_close'] = '</span>';
				
				$this->pagination->initialize($config);
				$this->session->unset_userdata('search_str');
				$data['paging'] = $this->pagination->create_links();
		
				$this->template->write_view('content','packages_list',$data);
				$this->template->render();
			}
		}
		else{
			$this->template->write_view('content', 'norecord_packages_list.php');
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
        $data['frmAction']                      = base_url()."packages/add";
        $data['question']                       = '';
        $data['validation_error']               = '';
        
        if($this->input->get_post('action') == "Process") {
            $this->form_validation->set_rules('package_name','Package Name','required');
            $this->form_validation->set_rules('package_desc','Package Description','required');
	    $this->form_validation->set_rules('package_amount','Package Amount','required');
	    $this->form_validation->set_rules('no_student','No of student','required');
	    
            if ($this->form_validation->run() == TRUE )
            {
                $insertArr      = array(
                                    'package_name'            	=> $this->input->post('package_name'),
                                    'package_desc'        	=> $this->input->post('package_name'),
                                    'package_amount'       	=> $this->input->post('package_amount'),
                                    'no_student' 		=> $this->input->post('no_student'),
                                    'added_on' 			=> date('Y-m-d H:i:s'),
                                    );
                //pr($insertArr);
                $lastId=$this->model_packages->addPackagesDB($insertArr);
                if($lastId <> '') {
                    $this->session->set_flashdata('message', array('title'=>'Add Package','content'=>'A new package succesfully added','type'=>'successmsgbox'));
                    redirect(base_url()."packages");
                } else {
                    $this->session->set_flashdata('message', array('title'=>'Add Package','content'=>'Unable to add Package.please try again','type'=>'errormsgbox'));
                    redirect(base_url()."packages/add");
                }
            }
            else {
                $data['validation_error']=  trim(validation_errors('<p>', '</p>'));
                $this->session->set_flashdata('message', array('title'=>'Add Package','content'=>$data['validation_error'],'type'=>'errormsgbox'));
                redirect(base_url()."packages/add");
             }
        }
        $data['return_link'] = base_url()."packages";
        $this->template->write_view('content','add_packages',$data);
        $this->template->render();
        
    }

	

	/*  FOR EDIT Packages */

	public function edit() {
		$this->getTemplate();
		$data			= array();
		$content_id		= $this->uri->segment(3, 0);
		$data['base_url']	= $this->config->item('base_url');
		$data['package_id']	= $content_id;
		$data['page']		= $this->uri->segment(4, 0);
		
		$conditionArr= array('package_id'=>$data['package_id']);
		$packages_exist= $this->model_packages->packagesExistsDB($conditionArr);
		if($content_id== 0 || !is_numeric($content_id) || !$packages_exist) { 
			redirect('packages/index');
		}
                
                $packages_data		= $this->model_packages->detailsPackagesDB($conditionArr);
		$data['package_id']	= $packages_data[0]['package_id'];
		$data['package_name']	= stripslashes($packages_data[0]['package_name']);
		$data['package_desc']	= stripslashes($packages_data[0]['package_desc']);
		$data['package_amount']	= stripslashes($packages_data[0]['package_amount']);
		$data['no_student']	= stripslashes($packages_data[0]['no_student']);
		$data['is_recommended']	= stripslashes($packages_data[0]['is_recommended']);
		$data['package_status']	= stripslashes($packages_data[0]['package_status']);
		
		
		if($this->input->get_post('action') == 'Process') { 		
			
                        $this->form_validation->set_rules('package_name','Package Name','required');
			$this->form_validation->set_rules('package_desc','Package Description','required');
			$this->form_validation->set_rules('package_amount','Package Amount','required');
			$this->form_validation->set_rules('no_student','No of student','required');

			if ($this->form_validation->run() == TRUE){ 
                                
                                $data['package_name']	= addslashes(trim($this->input->get_post('package_name')));
				$data['package_desc']	= addslashes(trim($this->input->get_post('package_desc')));
				$data['package_amount']	= addslashes(trim($this->input->get_post('package_amount')));
				$data['no_student']	= addslashes(trim($this->input->get_post('no_student')));
				$data['is_recommended']	= addslashes(trim($this->input->get_post('is_recommended')));
				$data['a1qw']	= trim($this->input->get_post('package_status'));
                                
                                $updateArr= array(
                                        'package_name' 		=> $data['package_name'],
                                        'package_desc' 		=> $data['package_desc'],
                                        'package_amount' 	=> $data['package_amount'],
                                        'no_student' 		=> $data['no_student'],
                                        'is_recommended' 	=> $data['is_recommended'],
                                        'package_status' 	=> $data['package_status'],
                                        'updated_on' 		=> date('Y-m-d H:i:s')
                                );
                                
                                $update= $this->model_packages->editPackagesDB($updateArr,$conditionArr);

                                if($update) {
                                        $this->session->set_flashdata('message', array('title'=>'Update Content','content'=>'Data have been successfully edited.','type'=>'successmsgbox'));
                                        redirect(base_url()."packages/all/".$data['page']."/");
                                }
                                else {
                                        $this->session->set_flashdata('message', array('title'=>'Update Content','content'=>'Unable to edit data. Please try again.','type'=>'errormsgbox'));
                                        redirect('packages/edit/'.$data['package_id']);
                                }
			}
                         else {
                        $data['validation_error']=preg_replace('/\s+/', ' ',validation_errors('<p>','</p>'));
                        $this->session->set_flashdata('message', array('title'=>'Edit Packages','content'=>$data['validation_error'],'type'=>'errormsgbox'));
                        redirect('packages/edit/'.$data['package_id']);
                    }
                    
		}
		$data['return_link'] = base_url()."packages";
		$this->template->write_view('content','edit_packages',$data);
		$this->template->render();
	}


    /* FOR CMS DELETE  */
	
	public function delete(){ 
		$data= array();
		$content_id= $this->uri->segment(3, 0);
		$data['base_url']= $this->config->item('base_url');
		$data['package_id']= $content_id;
		
		$conditionArr= array('package_id' => $data['package_id']);
		$package_exist= $this->model_packages->packagesExistsDB($conditionArr);
		
		if($package_exist){
			$delete= $this->model_packages->deletePackageDB($conditionArr);
			if($delete){
				$this->session->set_flashdata('message', array('title'=>'Delete Package','content'=>'Data have been successfully deleted.','type'=>'successmsgbox'));
				redirect(base_url()."packages/all/".$data['page']."/");
			}
			else{
				$this->session->set_flashdata('message', array('title'=>'Delete Package','content'=>'Unable to delete data. Please try again.','type'=>'errormsgbox'));
				redirect('packages/');
			}
		}
	}
	
	/*  FOR CMS STATUS CHANGE */            

	public function changeStatus($id) {
		$conditionArr     	= array('package_id'=>$id);
		$content_id       	= $this->uri->segment(3, 0);
		$data['package_id']     = $content_id;
		$data['page']     	= $this->uri->segment(4, 0);
		$checkExist       	= $this->model_packages->packagesExistsDB($conditionArr);
		if($checkExist) {
			$this->model_packages->statusChangePackagesDB($id);
			$this->session->set_flashdata('message', array('title'=>'Content Status','content'=>'Content status has been changed','type'=>'successmsgbox'));
			redirect(base_url()."packages/all/".$data['page']);
		}
    }
	
	
	/* FOR PROPER YOUTUBE NAME CHECK */
}