<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends MY_Controller {



    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('model_authentication','model_basic'));
        $this->url = base_url().'welcome/';
    }

        /**
*
* @Admin landing page
*
*
*/

   public function index()
   {
       $this->getTemplate();
       // Check already logged in
       if($this->session->userdata('admin_id')!='') {
            redirect(base_url()."dashboard");
        }
        $this->template->write_view('content', 'welcome/login');
        $this->template->render();

   }

/**
 *
 * @Admin login method
 *
 *
 */

    public function authenticate() {
        
        $result=$this->model_authentication->check_authentication();
        if(count($result) > 0){
            $this->session->set_userdata('admin_id', $result[0]['admin_id']);
            $this->session->set_userdata('admin_first_name', $result[0]['first_name']);
            $this->session->set_userdata('admin_last_name', $result[0]['last_name']);
            $this->session->set_userdata('admin_email', $result[0]['email_id']);

            $this->session->set_flashdata('message', array('title'=>'Administrator login','content'=>'You have logged in as an administrator','type'=>'successmsgbox'));
            redirect(base_url()."dashboard");

        }
        else {
            $this->session->set_flashdata('message', array('title'=>'Administrator login','content'=>'Login failed, Please try again...','type'=>'errormsgbox'));
            redirect(base_url()."welcome");
        }

    }


/**
 *
 * @Admin change password page
 *
 *
 */
    public function changepassword()
    {
        $this->checkLogin();
        $this->getTemplate();
        $this->template->write_view('content', 'welcome/change_password');
        $this->template->render();
    }

/**
 *
 * @Admin change password method
 *
 *
 */
    public function do_changepassword()
    {
        $this->checkLogin();
        $old_pass = $this->input->get_post('old_pass');
        $id = $this->session->userdata('admin_id');


        if($this->model_basic->getValue_condition('dt_adminuser','COUNT(*)', 'CNT', "admin_id ='".$id."' AND BINARY password = '".$old_pass."' "))
        {
            $this->model_authentication->update_password();
            $this->session->set_flashdata('message', array('title'=>'Change password','content'=>'Password has been successfully updated!','type'=>'successmsgbox'));
        }
        else
        {
            $this->session->set_flashdata('message', array('title'=>'Change password','content'=>'Old password mismatch. Try again later.','type'=>'errormsgbox'));
        }

        redirect(base_url().'welcome/changepassword');
    }

/**
 *
 * @Admin change email page
 *
 *
 */

    public function changeemail() {
        $this->checkLogin();
        $this->getTemplate();
        $data['email'] = $this->model_basic->getValue_condition('dt_adminuser','email_id','',' admin_id = 1 ');
        $this->template->write_view('content', 'welcome/change_email',$data,TRUE);
        $this->template->render();
    }

/**
 *
 * @Admin change email method
 *
 *
 */
    public function do_changeemail()
    {
        $this->checkLogin();
        $mail = trim($this->input->get_post('email'));
            if(!empty($mail)) {
                $setEmail = $this->model_authentication->update_email();
                if($setEmail){
                    $this->session->set_flashdata('message', array('title'=>'Change email','content'=>'Email has been successfully updated!','type'=>'successmsgbox'));
                } else {
                    $this->session->set_flashdata('message', array('title'=>'Change email','content'=>'Unable to update!','type'=>'errormsgbox'));
                }
            } else {
                $this->session->set_flashdata('message', array('title'=>'Change email','content'=>'Please provide an email address','type'=>'errormsgbox'));
             }
            redirect(base_url().'welcome/changeemail');
    }

/**
 *
 * @Admin logout method
 *
 *
 */
    public function logout() {
        $this->session->sess_destroy();
        $this->session->sess_create();
        $this->session->set_flashdata('message', array('title'=>'Administrator Control Panel','content'=>'You are successfully logged out.','type'=>'successmsgbox'));
        redirect(base_url()."welcome");
    }


}


/* End of file hmvc.php */
/* Location: ./application/widgets/hmvc/controllers/hmvc.php */
