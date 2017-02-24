<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MY_Controller {
    
    public function __construct()
    {
	parent::__construct();
	$this->load->model(array('model_login','welcome/model_basic'));
	$this->load->library('form_validation');
	$this->url = base_url().'login/';
    }

    /**
    *
    * @Frontend landing page
    *
    *
    */
    public function index()
    {
	$this->chk_not_login_both();
	$data=array();
        if($this->input->get_post('action') == 'Process')
	{
	    if($this->input->get_post('login_from') == 'student'){
	    $this->form_validation->set_rules('student_email', 'Email Address', 'trim|required');
	    $this->form_validation->set_rules('student_password', 'password', 'trim|required');
	    $this->form_validation->set_rules('student_username', 'Business Code', 'trim|required');
	    if ($this->form_validation->run() == FALSE)
	    {				
		$data['validation_error']=validation_errors();
		$this->session->set_flashdata('message', array('title'=>'Student','content'=>$data['validation_error'],'type'=>'errormsgbox'));
		redirect(base_url().'login');
	    }
	    else
	    {
		$result			= $this->model_login->check_authentication();
		if(count($result) > 0)
		{
		    $login_type		= $this->input->get_post('login_type');
		    $ins_details 	= $this->model_basic->detailsJoinDB(INSTRUCTOR.' INS',COURSE_MASTER.' CM','INS.course_id = CM.id',array('instructor_id'=>$result[0]['instructor_id']));
		    
		    if($ins_details[0]['slug'] == $login_type && $ins_details[0]['instructor_payment_status'] != 'cancel'){
			
			$update_arr = array( 'last_login'=> date('Y-m-d H:i:s'));
			$res1=$this->model_basic->editDB(STUDENT,$update_arr,array('student_id'=>$result[0]['student_id']));
			
			$this->session->set_userdata('STUDENT_ID', $result[0]['student_id']);
			$this->session->set_userdata('STUDENT_FNAME', stripslashes($result[0]['student_fname']));
			$this->session->set_userdata('STUDENT_LNAME', stripslashes($result[0]['student_lname']));
			//redirect(base_url()."student/landing");
			redirect(base_url()."learn");
		    }else{
			$this->session->set_flashdata('message', array('title'=>'Student','content'=>'You don\'t have permission to access '.$ins_details[0]['slug'].' details','type'=>'errormsgbox'));
			redirect(base_url().'login');
		    }
		    
		}
		else
		{
		    $this->session->set_flashdata('message', array('title'=>'user login','content'=>'Login failed, Please try again...','type'=>'errormsgbox'));
		    redirect(base_url().'login');
		}
	    }
	    }else{
		$this->form_validation->set_rules('instructor_email', 'Email Address', 'trim|required');
		$this->form_validation->set_rules('instructor_password', 'password', 'trim|required');
		if ($this->form_validation->run() == FALSE)
		{				
		    $data['validation_error']=validation_errors();
		    $this->session->set_flashdata('message', array('title'=>'Instructor','content'=>$data['validation_error'],'type'=>'errormsgbox'));
		    redirect(base_url().'login');
		}
		else
		{
		    $result			= $this->model_login->check_instructor();
		    if(count($result) > 0)
		    {
			$login_type		= $this->input->get_post('login_type');
			if($result[0]['slug'] == $login_type){
			    $this->session->set_userdata('INSTRUCTOR_ID', $result[0]['instructor_id']);
			    $this->session->set_userdata('INSTRUCTOR_FNAME', stripslashes($result[0]['instructor_fname']));
			    $this->session->set_userdata('INSTRUCTOR_LNAME', stripslashes($result[0]['instructor_lname']));
			    $this->session->set_userdata('INSTRUCTOR_BUSINESS_NAME', stripslashes($result[0]['instructor_business_name']));
			    redirect(base_url().$result[0]['instructor_business_name']."/dashboard");
			}else{
			    $this->session->set_flashdata('message', array('title'=>'Student','content'=>'You don\'t have permission to access '.$result[0]['slug'].' details','type'=>'errormsgbox'));
			    redirect(base_url().'login');
			}
			
		    }
		    else
		    {
			$this->session->set_flashdata('message', array('title'=>'user login','content'=>'Login failed, Please try again...','type'=>'errormsgbox'));
			redirect(base_url().'login');
		    }
		}
	    }
	}
	$this->getTemplate();
        $this->template->write_view('content', 'login/index', $data);
        $this->template->render();
    }


}


/* End of file hmvc.php */
/* Location: ./application/widgets/hmvc/controllers/hmvc.php */
