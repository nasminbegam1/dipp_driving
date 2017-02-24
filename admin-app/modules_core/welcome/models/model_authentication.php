<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Model_authentication extends CI_Model
{
	public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
#########################################################
#              ADMIN LOGIN                              #
#                                                       #
#                                                       #
#                                                       #
#########################################################

    public function check_authentication() {
        $email = trim($this->input->get_post('email'));
        $password = trim($this->input->get_post('password'));
        $where="email_id = '".$email."' AND BINARY password = '".$password."'";

        $this->db->select('*');
        $this->db->from('dipp_adminuser');
        $this->db->where($where);
        $query = $this->db->get();
        //echo $this->db->last_query();
        $result=$query->result_array();
        return $result;
    }

#########################################################
#              CHANGE ADMIN PASSWORD                    #
#                                                       #
#                                                       #
#                                                       #
#########################################################


    public function update_password()
    {
        $new_pass = $this->input->get_post('new_pass');
        $sql = "UPDATE dipp_adminuser SET password = '".addslashes(trim($new_pass))."' WHERE admin_id =1 ";
        $this->db->query($sql);
        if($this->db->affected_rows())
        {
            return true;
        }
        return false;
    }

#########################################################
#              CHANGE ADMIN EMAIL                       #
#                                                       #
#                                                       #
#                                                       #
#########################################################
    public function update_email() {
        $email = trim($this->input->get_post('email'));
        $id = $this->session->userdata('admin_id');
        $data = array(
        'email_id' => $email
        );
        $this->db->where('admin_id', $id);
        $this->db->update('dipp_adminuser', $data);
        if($this->db->affected_rows()) {
        return true;
        }
        return false;
    }

	public function sendPassword(&$error, $fromEmail) {
            $email = trim($this->input->get_post('email'));
            $from = $fromEmail['option_name'];
            $sql = "SELECT * FROM user_master WHERE user_email = '".trim($email)."'";
            $rs = $this->db->query($sql);
            if($rs->num_rows()) {
                $rec = $rs->row();
                $password               = $rec->password;
                $email                  = $rec->user_email;
                $filename 		=  server_absolute_path()."email_template/application/views/admin_sendpassword.html";
                //echo filesize($filename); die();
                $handle			= fopen($filename,"r");
                $contents		= fread($handle,filesize($filename));
                $replaceFrom            = array("{USERNAME}","{PASSWORD}","{BASEURL}");
                $replaceTo 		= array($email,$password, base_url());
                $emailContent           = str_replace($replaceFrom,$replaceTo,$contents);
                //echo $mail; die();
                $to 			= $email;
                $subject 		= "Your password information of  Invoice generation Control Panel!";
                $body			= $emailContent;
                $newline 		= "\n";
                $headers  = "MIME-Version: 1.0\r\n";
                $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
                $headers .= "From: Invoice generation <".$from.">\r\n";
                //echo $from."<br />".$to."<br />".$subject."<br />".$body."<br />".$headers; exit;
                $r = @mail($to, $subject, $body, $headers);
                //$r = TRUE;
                $error = 'error_mail_send';
                return $r;
            } else {
                $error  =  'error_email_login';
                return false;
            }
	}
}

