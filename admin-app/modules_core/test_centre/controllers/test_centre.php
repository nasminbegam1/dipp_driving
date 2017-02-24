<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test_centre extends MY_Controller {

    public function __construct(){
		
        parent::__construct();
        $this->load->model(array('welcome/model_basic', 'test_centre/model_test_centre'));
        $this->url = base_url().'test_centre/';
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
	    $total_news= $this->model_test_centre->countCentreDB();
	    $data['totalRecord']      = $total_news;
	    $data['per_page']         = PER_PAGE_LISTING;
	    $start                    = 0;
	    $data['startRecord']      = $start;
	    $data['page']             = $this->uri->segment(4);
	    $data['search_keyword']   = "";
	    if($total_news > 0) {
		    /********** FOR PAGINATION ***********/
		    $config['base_url'] = base_url().'/test_centre/all';
		    $config['per_page'] =20;
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
		    $resultArr= $this->model_test_centre->allCentreDB($search_by,$config['per_page'],$offset);
		    //pr($resultArr);
    
		    if(count($resultArr) > 0) {
			    $num = 1+$offset;
			    foreach($resultArr as $values) {
				    $id 		= $values['id'];
				    $name 		= stripslashes($values['name']);
				    $zip_code 		= stripslashes($values['zip_code']);
				    $contentStatus	= $values['status'];
				    $status_class	= ($contentStatus == 'Active')?'label-green':'label-red';    
    
				    /********** GET GENERATE EDIT AND DELETE LINK ***********/
				    $this->uri_segment  = $this->uri->total_segments();
				    $cur_page= 0;
				    if ($this->uri->segment($this->uri_segment) != 0) {
					    $this->cur_page = $this->uri->segment($this->uri_segment);
					    $cur_page = (int) $this->cur_page;
				    }
    
				    $edit_link= base_url()."test_centre/edit/".$id."/".$cur_page."/";
				    $status_link= base_url()."test_centre/changeStatus/".$id."/".$cur_page;
				    $delete_link= base_url()."test_centre/delete/".$id."/".$cur_page."/";
    
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
    
			    $data['centre_all']= $total_result;
			    /********** FOR PAGINATION ***********/
			    $config['cur_tag_open']= '<span class="current-link">';
			    $config['cur_tag_close']= '</span>';
			    $this->pagination->initialize($config);
			    $data['paging']= $this->pagination->create_links();
			    $this->template->write_view('content','centre_list',$data);
			    $this->template->render();
		    }
	    }
	    else {
		    $this->template->write_view('content', 'norecord_centre_list.php');
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
		
	
		$total_centre 		= $this->model_test_centre->countCentreDB($search_by);
		$data['totalRecord'] 	= $total_centre;
		$data['per_page'] 	= PER_PAGE_LISTING;
		$start 			= 0;
		$data['startRecord'] 	= $start;
		$data['page']	 	= $this->uri->segment(3);
		if($total_centre > 0){
			/********** FOR PAGINATION ***********/
			$config['base_url'] = base_url().'/test_centre/all';
			$config['per_page'] =4;
			$config['total_rows'] = $total_centre;
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
	
			$resultArr=$this->model_test_centre->allCentreDB($search_by,$config['per_page'],$offset);
	
			if(count($resultArr) > 0) {
				$num= 1+$offset;
				foreach($resultArr as $values) {
				    $id 		= $values['id'];
				    $title 		= stripslashes($values['name']);
				    $zip_code 		= stripslashes($values['zip_code']);
				    $contentStatus	= $values['status'];
				    $status_class	= ($contentStatus == 'Active')?'label-green':'label-red';    
    
				    /********** GET GENERATE EDIT AND DELETE LINK ***********/
				    $this->uri_segment  = $this->uri->total_segments();
				    $cur_page= 0;
				    if ($this->uri->segment($this->uri_segment) != 0) {
					    $this->cur_page = $this->uri->segment($this->uri_segment);
					    $cur_page = (int) $this->cur_page;
				    }
    
				    $edit_link= base_url()."test_centre/edit/".$id."/".$cur_page."/";
				    $status_link= base_url()."test_centre/changeStatus/".$id."/".$cur_page;
				    $delete_link= base_url()."test_centre/delete/".$id."/".$cur_page."/";
    
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
		
				$data['centre_all']= $total_result;
				$data['search_keyword'] = $search_by;
				/********** FOR PAGINATION ***********/
				$config['cur_tag_open'] = '<span class="current-link">';
				$config['cur_tag_close'] = '</span>';
				
				$this->pagination->initialize($config);
				$this->session->unset_userdata('search_str');
				$data['paging'] = $this->pagination->create_links();
		
				$this->template->write_view('content','centre_list',$data);
				$this->template->render();
			}
		}
		else{
			$this->template->write_view('content', 'norecord_centre_list.php');
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
        $data['frmAction']                      = base_url()."test_centre/add";
        $data['question']                       = '';
        $data['validation_error']               = '';
	
        /*$file_path = $_SERVER['DOCUMENT_ROOT'].'/dipp_driving/uploads/govuk_data1.csv';
        $getList = csv_to_array($file_path);
        foreach($getList as $val) {
            $name               = $val['City'].' Test Centre';
            $address		= $val['Address'];
            $zipcode		= $val['Postcode'];
            $zipCode 		= str_replace(' ', '', $zipcode); 
          
            $url        = "http://maps.googleapis.com/maps/api/geocode/json?address=".$zipCode."&sensor=false";
            $details    = file_get_contents($url);
            $result     = json_decode($details,true);
            if(!empty($result['results'])){
                $lat1       = $result['results'][0]['geometry']['location']['lat'];

                $lon1       = $result['results'][0]['geometry']['location']['lng'];


                $insertArr      = array(
                                    'name'            		=> $name,
                                    'zip_code'            	=> $val['Postcode'],
                                    'address'        		=> $address,
                                    'latitude'			=> $lat1,
                                    'longitude'			=> $lon1,
                                    'created_at' 		=> date('Y-m-d H:i:s')
                                    );
                
                $lastId=$this->model_test_centre->addCentreDB($insertArr);
            }
          
        }
       
        */
        if($this->input->get_post('action') == "Process") {
            $this->form_validation->set_rules('name','Test Center Name','required');
            $this->form_validation->set_rules('zip_code','Zip Code','required');
	    $this->form_validation->set_rules('address','Address','required');
	    
            if ($this->form_validation->run() == TRUE )
            {
		$zipcode		= $this->input->post('zip_code');
		$zipCode 		= str_replace(' ', '', $zipcode);
        
		$url        = "http://maps.googleapis.com/maps/api/geocode/json?address=".$zipCode."&sensor=false";
		$details    = file_get_contents($url);
		$result     = json_decode($details,true);
		if(!empty($result['results'])){
		    $lat1       = $result['results'][0]['geometry']['location']['lat'];
		    
		    $lon1       = $result['results'][0]['geometry']['location']['lng'];
		    
		    
		    $insertArr      = array(
					'name'            		=> $this->input->post('name'),
					'zip_code'            		=> $this->input->post('zip_code'),
					'address'        		=> $this->input->post('address'),
					'latitude'			=> $lat1,
					'longitude'			=> $lon1,
					'created_at' 		=> date('Y-m-d H:i:s')
					);
		    //pr($insertArr);
		    $lastId=$this->model_test_centre->addCentreDB($insertArr);
		    if($lastId <> '') {
			$this->session->set_flashdata('message', array('title'=>'Add Centre','content'=>'A test centre is succesfully added','type'=>'successmsgbox'));
			redirect(base_url()."test_centre");
		    } else {
			$this->session->set_flashdata('message', array('title'=>'Add Centre','content'=>'Unable to add test centre.please try again','type'=>'errormsgbox'));
			redirect(base_url()."test_centre/add");
		    }
		}else{
		    $this->session->set_flashdata('message', array('title'=>'Add Centre','content'=>'Please enter proper zipcode','type'=>'errormsgbox'));
		    redirect(base_url()."test_centre/add");
		}
            }
            else {
                $data['validation_error']=  trim(validation_errors('<p>', '</p>'));
                $this->session->set_flashdata('message', array('title'=>'Add Centre','content'=>$data['validation_error'],'type'=>'errormsgbox'));
                redirect(base_url()."test_centre/add");
             }
        }
        $data['return_link'] = base_url()."test_centre";
        $this->template->write_view('content','add_centre',$data);
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
		
		$conditionArr= array('id'=>$data['id']);
		$test_centre_exist= $this->model_test_centre->centreExistsDB($conditionArr);
		if($content_id== 0 || !is_numeric($content_id) || !$test_centre_exist) { 
			redirect('test_centre/index');
		}
                
                $test_centre_data	= $this->model_test_centre->detailsCentreDB($conditionArr);
		$data['id']		= $test_centre_data[0]['id'];
		$data['name']		= stripslashes($test_centre_data[0]['name']);
		$data['zip_code']	= stripslashes($test_centre_data[0]['zip_code']);
		$data['address']	= stripslashes($test_centre_data[0]['address']);
		$data['status']		= stripslashes($test_centre_data[0]['status']);
		
		
		if($this->input->get_post('action') == 'Process') { 		
			
                        $this->form_validation->set_rules('name','Test Center Name','required');
			$this->form_validation->set_rules('zip_code','Zip Code','required');
			$this->form_validation->set_rules('address','Address','required');

			if ($this->form_validation->run() == TRUE){ 
                                
                                $data['name']		= addslashes(trim($this->input->get_post('name')));
				$data['zip_code']	= addslashes(trim($this->input->get_post('zip_code')));
				$data['address']	= addslashes(trim($this->input->get_post('address')));
				$data['status']		= trim($this->input->get_post('status'));
                                
				$zipCode 		= str_replace(' ', '', $data['zip_code']);
			
				$url        = "http://maps.googleapis.com/maps/api/geocode/json?address=".'UK+'.$zipCode."&sensor=false";
				$details    = file_get_contents($url);
				$result     = json_decode($details,true);
				if(!empty($result['results'])){
				    $lat1       = $result['results'][0]['geometry']['location']['lat'];
				    
				    $lon1       = $result['results'][0]['geometry']['location']['lng'];
				    
                                $updateArr= array(
                                        'name' 			=> $data['name'],
                                        'zip_code' 		=> $data['zip_code'],
					'address' 		=> $data['address'],
					'latitude'		=> $lat1,
					'longitude'		=> $lon1,
                                        'status' 		=> $data['status']
                                );
                                $update= $this->model_test_centre->editCentreDB($updateArr,$conditionArr);

                                if($update) {
                                        $this->session->set_flashdata('message', array('title'=>'Update Content','content'=>'Data have been successfully edited.','type'=>'successmsgbox'));
                                        redirect(base_url()."test_centre/all/".$data['page']."/");
                                }
                                else {
                                        $this->session->set_flashdata('message', array('title'=>'Update Centre','content'=>'Unable to edit data. Please try again.','type'=>'errormsgbox'));
                                        redirect('test_centre/edit/'.$data['id']);
                                }
				
				    } else {
			    $data['validation_error']=  trim(validation_errors('<p>', '</p>'));
			    $this->session->set_flashdata('message', array('title'=>'Add Centre','content'=>$data['validation_error'],'type'=>'errormsgbox'));
			    redirect(base_url()."test_centre/add");
			 }
			} else {
                        $data['validation_error']=preg_replace('/\s+/', ' ',validation_errors('<p>','</p>'));
                        $this->session->set_flashdata('message', array('title'=>'Edit Centre','content'=>$data['validation_error'],'type'=>'errormsgbox'));
                        redirect('test_centre/edit/'.$data['id']);
                    }
                    
		}
		$data['return_link'] = base_url()."news";
		$this->template->write_view('content','edit_centre',$data);
		$this->template->render();
	}


    /* FOR CMS DELETE  */
	
	public function delete(){ 
		$data= array();
		$content_id= $this->uri->segment(3, 0);
		$data['base_url']= $this->config->item('base_url');
		$data['id']= $content_id;
		
		$conditionArr= array('id' => $data['id']);
		$centre_exist= $this->model_test_centre->centreExistsDB($conditionArr);
		
		if($centre_exist){
			$delete= $this->model_test_centre->deleteCentreDB($conditionArr);
			if($delete){
				$this->session->set_flashdata('message', array('title'=>'Delete Centre','content'=>'Data have been successfully deleted.','type'=>'successmsgbox'));
				redirect(base_url()."test_centre/all/".$data['page']."/");
			}
			else{
				$this->session->set_flashdata('message', array('title'=>'Delete Centre','content'=>'Unable to delete data. Please try again.','type'=>'errormsgbox'));
				redirect('test_centre/');
			}
		}
	}
	
	/*  FOR CMS STATUS CHANGE */            

	public function changeStatus($id) {
		$conditionArr     	= array('id'=>$id);
		$content_id       	= $this->uri->segment(3, 0);
		$data['id']     	= $content_id;
		$data['page']     	= $this->uri->segment(4, 0);
		$checkExist       	= $this->model_test_centre->centreExistsDB($conditionArr);
		if($checkExist) {
			$this->model_test_centre->statusChangeCentreDB($id);
			$this->session->set_flashdata('message', array('title'=>'Content Status','content'=>'Content status has been changed','type'=>'successmsgbox'));
			redirect(base_url()."test_centre/all/".$data['page']);
		}
    }
	
	
	/* FOR PROPER YOUTUBE NAME CHECK */
}