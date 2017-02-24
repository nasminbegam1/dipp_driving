<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Student extends MY_Controller {



    public function __construct(){
        parent::__construct();
        $this->load->model(array('welcome/model_basic', 'instructor/model_instructor','student/model_student'));
	$this->load->library('form_validation');
        $this->load->helper('string');
        $this->url = base_url().'student/';
        //$this->checkLogin();
    }

 
#########################################################
#                FOR  STUDENT LISTING                   #
#                                                       #
#                                                       #
#                                                       #
#########################################################

    public function index() {
        $this->all();
	}

#########################################################
#                FOR  STUDENT LISTING                   #
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
        
        $total_student            = $this->model_student->countStudentDB();
        
        $data['totalRecord']      = $total_student;
	$data['search_keyword']   = "";
        if($total_student > 0) {
            /********** FOR PAGINATION ***********/
            $config['base_url'] = base_url().'/student/all';
            $config['per_page'] =10;
            $config['total_rows'] = $total_student;
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
            $resultArr=$this->model_student->allStudentDB($search_by,PER_PAGE_LISTING,$offset);
            //pr($resultArr);

            if(count($resultArr) > 0) {
                $num = 1+$offset;
                    foreach($resultArr as $values) {
                    $student_id          = $values['student_id'];
                    $student_status      = $values['student_status'];
                    $status_class        =($student_status == 'Active')?'label-green':'label-red';    
                    
                    /********** GET GENERATE EDIT AND DELETE LINK ***********/
                    $this->uri_segment = $this->uri->total_segments();
                    $cur_page           = 0;
                    if ($this->uri->segment($this->uri_segment) != 0) {
                        $this->cur_page = $this->uri->segment($this->uri_segment);
                        $cur_page = (int) $this->cur_page;
                    }

                    $edit_link          = base_url()."student/edit/".$student_id."/".$cur_page."/";
                    $status_link        = base_url()."student/changeStatus/".$student_id."/".$cur_page;
                    $delete_link        = base_url()."student/delete/".$student_id."/".$cur_page."/";

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

                $data['student_all']        = $total_result;
                /********** FOR PAGINATION ***********/
                $config['cur_tag_open']     = '<span class="current-link">';
                $config['cur_tag_close']    = '</span>';
                $this->pagination->initialize($config);
                $data['paging']             = $this->pagination->create_links();
                $this->template->write_view('content','student_list',$data);
                $this->template->render();
                
            }
        } else {
            $this->template->write_view('content', 'norecord_student_list.php',$data);
            $this->template->render();
         }
    }



#########################################################
#                   FOR STUDENT SEARCH                  #
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


        $total_student=$this->model_student->countStudentDB($search_by);
        $data['totalRecord']      = $total_student;
	$data['search_keyword']   = $search_by;
        if($total_student > 0)
        {
            /********** FOR PAGINATION ***********/
            $config['base_url'] = base_url().'/student/all';
            $config['per_page'] =10;
            $config['total_rows'] = $total_student;
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


            $resultArr=$this->model_student->allStudentDB($search_by,$config['per_page'],$offset);

            if(count($resultArr) > 0) {
                $num    = 1+$offset;
		foreach($resultArr as $values) {
                    $student_id         = $values['student_id'];
                    $student_status     = $values['student_status'];
                    $status_class       =($student_status == 'Active')?'label-green':'label-red'; 
                    
                    /********** GET GENERATE EDIT AND DELETE LINK ***********/
                    $this->uri_segment = $this->uri->total_segments();
                    $cur_page = 0;
                    if ($this->uri->segment($this->uri_segment) != 0) {
                        $this->cur_page = $this->uri->segment($this->uri_segment);
                        $cur_page = (int) $this->cur_page;
                    }
                    $edit_link          = base_url()."student/edit/".$student_id."/".$cur_page."/";
                    $status_link        = base_url()."student/changeStatus/".$student_id."/".$cur_page;
                    $delete_link        = base_url()."student/delete/".$student_id."/".$cur_page."/";

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

                $data['student_all']=$total_result;
                /********** FOR PAGINATION ***********/
                $config['cur_tag_open'] = '<span class="current-link">';
                $config['cur_tag_close'] = '</span>';
                $this->pagination->initialize($config);
                $this->session->unset_userdata('search_str');
                $data['paging'] = $this->pagination->create_links();
                $this->template->write_view('content','student_list',$data);
                $this->template->render();
            }
        }
        else
        {
            $this->template->write_view('content', 'norecord_student_list.php',$data);
            $this->template->render();
        }
    }

#########################################################
#                   FOR ADD STUDENT                     #
#                                                       #
#                                                       #
#                                                       #
#########################################################
    public function add() {
        $this->getTemplate();
        $data                                   = array();
        $data['base_url']                       = $this->config->item('base_url');
        $data['frmAction']                      = base_url()."student/add";
        $data['student_fname']                  = '';
        $data['student_lname']                  = '';
        $data['student_email']                  = '';
        $data['student_phone']                  = '';
        $data['student_password']               = '';
        $data['instructor_id']                  = '';
        $data['validation_error']               = '';
        
        /***************** For Instructor Dropdown *******************/
        $instructorDropdown= $this->model_basic->populateDropdown("instructor_id", "instructor_business_name", " dipp_instructor", "instructor_status='Active'", "instructor_id", "ASC");
	$instructorOptions= array();
        $instructorOptions['']= "--Select Instructor--";
        for ($i=0; $i < count($instructorDropdown); $i++){
           $instructorOptions[$instructorDropdown[$i]['instructor_id']]=  $instructorDropdown[$i]['instructor_business_name'];
        }
        $data['instructorOption'] = $instructorOptions;
        /********************************************************/
	
        if($this->input->get_post('action') == "Process") {
            $this->form_validation->set_rules('instructor_id','Instructor','required');
            $this->form_validation->set_rules('student_fname','First Name','required');
            $this->form_validation->set_rules('student_lname','Last Name','required');
            $this->form_validation->set_rules('student_email','Email','required|valid_emai');
            
            $password                   = $this->model_student->generatePassword();
            $data['student_fname']      = addslashes(trim($this->input->get_post('student_fname')));
            $data['student_lname']      = addslashes(trim($this->input->get_post('student_lname')));
            $data['student_email']      = trim($this->input->get_post('student_email'));
            $data['student_phone']      = trim($this->input->get_post('student_phone'));
            $data['student_password']   = $password;
            $data['instructor_id']      = trim($this->input->get_post('instructor_id'));
            $data['student_status']     = "Active";
            
            $instructor_details         = $this->model_instructor->detailsInstructorDB(array('instructor_id'=>$data['instructor_id']));
            $instructor_business_name   = stripslashes($instructor_details[0]['instructor_business_name']);
            $data['student_username']   = $instructor_business_name;
           
            if ($this->form_validation->run() == TRUE )
            {
                $insertArr      = array(
                                    'instructor_id'      => $data['instructor_id'],
                                    'student_fname'      => $data['student_fname'],
                                    'student_lname'      => $data['student_lname'],
                                    'student_username'   => $data['student_username'],
                                    'student_email'      => $data['student_email'],
                                    'student_phone'      => $data['student_phone'],
                                    'student_password'   => $data['student_password'],
                                    'student_status'     => $data['student_status'],
                                    'added_on'           => date('Y-m-d H:i:s')
                                    );
                //pr($insertArr);
                $lastId=$this->model_student->addStudentDB($insertArr);
                if($lastId <> '') {
                    
                    $student_full_name = $data['student_fname']." ".$data['student_lname'];
                    $sitesettings 	= $this->model_basic->get_settings(6);
		    $sitename 		= stripslashes($sitesettings['sitename']);
                    
                    // For send mail to Student //
                    $email_template   = $this->model_basic->detailsDB('dipp_email_template','template_id = "2"');
                    $mailBody         = $email_template[0]['email_content'];
                    

                    $org_arr          = array('{USER}','{INSTRUCTOR}','{BUSINESSNAME}','{EMAIL_ADDRESS}','{PASSWORD}','{SITENAME}');
                    $replace_arr      = array($student_full_name,$instructor_business_name,$data['student_username'],$data['student_email'],$data['student_password'],$sitename);
                    $message          = str_replace($org_arr,$replace_arr,$mailBody);
                    $to               = $data['student_email'];
                    $from             = $email_template[0]['response_email'];
		    $email_subject    = $email_template[0]['email_subject'];
                    
                     $this->send_mail($from,$sitename,$to,'','',$email_subject,$message);
                    // For send mail to Student //
                    
                    
                    
                    $this->session->set_flashdata('message', array('title'=>'Add Student','content'=>'A new student succesfully added','type'=>'successmsgbox'));
                    redirect(base_url()."student");
                } else {
                    $this->session->set_flashdata('message', array('title'=>'Add Student','content'=>'Unable to add student.please try again','type'=>'errormsgbox'));
                    redirect(base_url()."student/add");
                }
            }
            else {
                $data['validation_error']=validation_errors();
                $this->session->set_flashdata('message', array('title'=>'Add Student','content'=>$data['validation_error'],'type'=>'errormsgbox'));
                redirect(base_url()."student/add");
             }
        }
        $data['return_link'] = base_url()."student/";
        $this->template->write_view('content','add_student',$data);
        $this->template->render();
        
    }


#########################################################
#                   FOR EDIT STUDENT                    #
#                                                       #
#                                                       #
#                                                       #
#########################################################
    public function edit() {
            $this->getTemplate();
            $data=array();
            $data['base_url']           = $this->config->item('base_url');
            $student_id                 = $this->uri->segment(3, 0);
            $data['student_id']         = $student_id;
            $data['page']               = $this->uri->segment(4, 0);
            $conditionArr               = array('student_id'=>$data['student_id']);
            $student_exist              = $this->model_student->studentExistsDB($conditionArr);
            if($student_id == 0 || !is_numeric($student_id) || !$student_exist) {
                    redirect('student/index');
            }

            $student_data               = $this->model_student->detailsStudentDB($conditionArr);
            $data['student_fname']      = stripslashes($student_data[0]['student_fname']);
            $data['student_lname']      = stripslashes($student_data[0]['student_lname']);
            $data['student_email']      = $student_data[0]['student_email'];
            $data['student_phone']      = $student_data[0]['student_phone'];
            $data['instructor_id']      = $student_data[0]['instructor_id'];
            $data['student_status']     = $student_data[0]['student_status'];
            $data['validation_error']   = '';
            
            /***************** For Instructor Dropdown *******************/
            $instructorDropdown= $this->model_basic->populateDropdown("instructor_id", "instructor_business_name", " dipp_instructor", "instructor_status='Active'", "instructor_id", "ASC");
            $instructorOptions= array();
            $instructorOptions['']= "--Select Instructor--";
            for ($i=0; $i < count($instructorDropdown); $i++){
                $instructorOptions[$instructorDropdown[$i]['instructor_id']]=  $instructorDropdown[$i]['instructor_business_name'];
            }
            $data['instructorOption'] = $instructorOptions;
            /********************************************************/
            
            /***************** For Instructor Dropdown *******************/
            $statusArray = array('Active'=>'Active','Inactive'=>'Inactive');
            $data['statusOption'] = $statusArray;
                
            /********************************************************/    
                
           
            if($this->input->get_post('action') == "Process") {
                
                $this->form_validation->set_rules('instructor_id','Instructor','required');
                $this->form_validation->set_rules('student_fname','First Name','required');
                $this->form_validation->set_rules('student_lname','Last Name','required');
                $this->form_validation->set_rules('student_email','Email','required|valid_emai');
                
                $data['student_fname']      = addslashes(trim($this->input->get_post('student_fname')));
                $data['student_lname']      = addslashes(trim($this->input->get_post('student_lname')));
                $data['student_email']      = trim($this->input->get_post('student_email'));
                $data['student_phone']      = trim($this->input->get_post('student_phone'));
                $data['instructor_id']      = trim($this->input->get_post('instructor_id'));
                $data['student_status']     = trim($this->input->get_post('student_status'));
                
                if ($this->form_validation->run() == TRUE )
                {
                    $updateArr      = array(
                                    'instructor_id'      => $data['instructor_id'],
                                    'student_fname'      => $data['student_fname'],
                                    'student_lname'      => $data['student_lname'],
                                    'student_email'      => $data['student_email'],
                                    'student_phone'      => $data['student_phone'],
                                    'student_status'     => $data['student_status'],
                                    'updated_on'         => date('Y-m-d H:i:s')
                                    );

                    $update = $this->model_student->editStudentDB($updateArr,$conditionArr);
                    if($update) {
                        $this->session->set_flashdata('message', array('title'=>'Update Student','content'=>'Data have been successfully edited.','type'=>'successmsgbox'));
                        redirect(base_url()."student/all/".$data['page']."/");
                      } else {
                        $this->session->set_flashdata('message', array('title'=>'Update Student','content'=>'Unable to edit data. Please try again.','type'=>'errormsgbox'));
                        redirect('student/edit/'.$student_id);
                    }
                
                } 
             else {
                $data['validation_error']=validation_errors();
                $this->session->set_flashdata('message', array('title'=>'Edit Student','content'=>$data['validation_error'],'type'=>'errormsgbox'));
                redirect('student/edit/'.$student_id);
             }
                
            }
            $data['return_link'] = base_url()."student/";
            $this->template->write_view('content','edit_student',$data);
            $this->template->render();
            
        }



#########################################################
#                FOR  STUDENT STATUS CHANGE             #
#                                                       #
#                                                       #
#                                                       #
#########################################################

        function changeStatus($id) {
            $conditionArr           = array('student_id'=>$id);
            $student_id             = $this->uri->segment(3, 0);
            $data['student_id']     = $student_id;
            $data['page']           = $this->uri->segment(4, 0);
            $checkExist             = $this->model_student->studentExistsDB($conditionArr);
            if($checkExist) {
                $this->model_student->statusChangeStudentDB($id);
                $this->session->set_flashdata('message', array('title'=>'Student Status','content'=>'Student status has been changed','type'=>'successmsgbox'));
                redirect(base_url()."student/all/".$data['page']);
            }

        }
        

}


