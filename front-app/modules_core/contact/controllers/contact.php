<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contact extends MY_Controller {

var $contactMaster 	= 'dt_contact_us';
var $emailTemplate 	= 'dt_email_template';

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('welcome/model_authentication','welcome/model_basic'));
        $this->load->library('form_validation');
        $this->url = base_url().'contact/';
    }

/**
*
* @Frontend landing page
*
*
*/

   public function index()
   {
        $data=array();
        if($this->input->get_post('action') == 'Process')
		{
			$this->form_validation->set_rules('full_name', 'Name', 'trim|required');
			$this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email');
                        $this->form_validation->set_rules('contact', 'contact', 'trim|required]');
			$this->form_validation->set_rules('comment', 'comment', 'trim|required]');
                        
			
				if ($this->form_validation->run() == FALSE)
				{				
                                    $data['validation_error']=validation_errors();
                                    $this->session->set_flashdata('message', array('title'=>'Contact','content'=>$data['validation_error'],'type'=>'errormsgbox'));
                                    redirect(base_url()."contact");
				}
                                else
                                {
                                    $to	  = $this->model_basic->get_settings(17);
                                    if(isset($to['contact_email']) &&  !empty($to['contact_email']))
					$to_email 	= $to['contact_email'];	
                                        $name    	= $this->input->get_post('full_name');
					$email  	= $this->input->get_post('email');
					$contact	= $this->input->get_post('contact');
					$comment	= $this->input->get_post('comment');
                                        
					$insertArray = array(							     
							'name'		    => addslashes($name),
							'contact' 	    => addslashes($contact),
							'email_address'	    => addslashes($email),
							'comment'	    => addslashes($comment)
							);
                                        $ret = $this->model_basic->insertIntoTable($this->contactMaster,$insertArray);
					
					//E-mail sent to admin
					$sitesettings 			= $this->model_basic->get_settings(6);
					$sitename 			= stripslashes($sitesettings['sitename']);
					$email_template    		= $this->model_basic->detailsDB($this->emailTemplate,'template_id = "3"');
					$message			= stripslashes(str_replace(array('{{CONTACT_NAME}}','{{CONTACT_EMAIL}}','{{PHONE_NO}}','{{MESSAGE}}','{{SITENAME}}'),array(stripslashes($name),$email,$contact,nl2br($comment),$sitename),$email_template[0]['email_content']));
					$from 				= $email_template[0]['response_email'];
					$email_subject 			= $email_template[0]['email_subject'];
	                                $this->send_mail($email,$sitename,$to_email,'','',$email_subject,$message);   
					
					
					//E-mail send to user
					$email_template    		= $this->model_basic->detailsDB($this->emailTemplate,'template_id = "4"');
					$message1			= stripslashes(str_replace(array('{{USERNAME}}','{{SITENAME}}'),array(stripslashes($name),$sitename),$email_template[0]['email_content']));
					
					$from 				= $email_template[0]['response_email'];
					$email_subject1       		= $email_template[0]['email_subject'].' '.$sitename;
					
	                                $is_send = $this->send_mail($from,$sitename,$email,'','',$email_subject1,$message1);

					if($is_send){	
						$this->session->set_userdata('succmsg','Contact submitted successfully');
					}
					else{					
						$this->session->set_userdata('errmsg','contact could not be submitted. Please try again.');
					}
                                }
                }
        $this->getTemplate();
        $data['succmsg'] = $this->session->userdata('succmsg');
	$data['errmsg'] = $this->session->userdata('errmsg');
        $this->template->write_view('content', 'contact/index', $data);
        $this->session->unset_userdata('succmsg');
	$this->session->unset_userdata('errmsg');
        $this->template->render();
   }

/**
*
* @Frontend country state dropdown
*
*
*/
  


}


/* End of file hmvc.php */
/* Location: ./application/widgets/hmvc/controllers/hmvc.php */
