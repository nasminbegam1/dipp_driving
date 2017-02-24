<?php (defined('BASEPATH')) OR exit('No direct script access allowed');
class MY_Controller extends MX_Controller {


	function __construct() {
            $this->load->library(array('parser','email'));
	    $this->load->model(array('welcome/model_basic'));
            header('Cache-Control: no-store, no-cache, must-revalidate'); 
            header('Cache-Control: post-check=0, pre-check=0', FALSE); 
            header('Pragma: no-cache'); 
        }

        
	/******************* FOR LAYOUT TEMPLATE **************************/
	public function getTemplate($header_display=true,$banner_display=true,$footer_display=true)
	{
	/*********** FOR LAYOUT ************/
	$menu 		= '';
	$sitesettings			=$this->model_basic->siteSettingValue(array('sitesettings_id'=> 9,10,12,13,14,15,16 ));
	$settings_value = array();
	if($sitesettings){
		foreach($sitesettings as $settings){
		     $settings_value[$settings['sitesettings_name']] =	$settings['sitesettings_value'];
		}
		$menu['settings'] = $settings_value;
	}
	$menu['about']  = $this->model_basic->detailsDB(CMS,array('cms_status' => "Active",'cms_id' =>6),array('cms_content'));
	
	//Student menu
	$student_id 	= $this->session->userdata('STUDENT_ID');
	$instructor_id 	= $this->session->userdata('INSTRUCTOR_ID');
	if(isset($student_id) && $student_id !='')
	{
		$st_details 		= $this->model_basic->getCourseId(array('ST.student_id'=>$student_id));
		$menu['ins_logo']	= $st_details->instructor_logo;
		$menu['business_name']	= $st_details->instructor_business_name;
		$menu['step_dtls']  	= $this->model_basic->detailsDB(STEP_MASTER,array('status' => "Active",'course_id' =>$st_details->course_id),array('id','name','step_type','short_description'));
	}elseif(isset($instructor_id) && $instructor_id != ''){
		
		
		$st_details 		= $this->model_basic->detailsDB(INSTRUCTOR,array('instructor_id' =>$instructor_id),array('instructor_logo','instructor_business_name','DATEDIFF((added_on + interval 14 day),now()) remaining_days','instructor_payment_status'));
		$menu['ins_logo']	= $st_details[0]['instructor_logo'];
		$menu['business_name']	= $st_details[0]['instructor_business_name'];
		$menu['instructor_payment_status']	= $st_details[0]['instructor_payment_status'];
		$menu['remaining_days']	= $st_details[0]['remaining_days'];
		$menu['instractorBusinessName'] = $this->session->userdata('INSTRUCTOR_BUSINESS_NAME');
               
	}
	($header_display == true)?$this->template->write_view('header', 'template/header',$menu):'';
	($footer_display == true)?$this->template->write_view('footer', 'template/footer',$menu):'';
	}
	
/******************* FOR LAYOUT TEMPLATE **************************/
	public function getTemplate_login()
	{
		$this->template->set_template('login');
	}

/******************* FOR MAIL SEND **************************/
    public function send_mail($email='noreply@cheewu.com', $name='Cheewu', $to=NULL, $cc=NULL, $bcc=NULL,$subject_line='No Subject', $message='No Message',$attachment_file=array())
        {
             $config = array (
                  'mailtype' => 'html',
                  'charset'  => 'utf-8',
                  'priority' => '1'
                   );
                $this->email->initialize($config);
                $this->email->clear(TRUE);
                $this->email->from($email, $name);
		$this->email->to($to);

		if($cc!=NULL)
		{
			$this->email->cc($cc);
		}

		if($bcc!=NULL)
		{
			$this->email->bcc($bcc);
		}


		$this->email->subject($subject_line);
		$this->email->message($message);

                if(count($attachment_file) > 0)
                {
                    foreach($attachment_file as $attachment)
                    {
                        $this->email->attach($attachment);
                    }
                }

                /*if($attachment_file!=NULL)
		{


                    $this->email->attach($attachment_file);
		}*/

		if($this->email->send())
		{
			return TRUE;
		}

		else
		{
			return FALSE;
		}

	}


        /******************* FOR IMAGE UPLOAD **************************/
        public function imageUpload($name='',$upload_folder='',$is_thumb='N',$thumb_width=0,$thumb_height=0)
        {
            $this->load->library('upload');
            $config = array('upload_path'       => file_upload_absolute_path().$upload_folder.'/',
                            'allowed_types'     => 'gif|jpg|jpeg|png',
                            'max_size'          => 0,
                            'max_width'         => 0,
                            'encrypt_name'      => TRUE
                            );
	    //pr($config);
            $this->upload->initialize($config);
            $this->upload->do_upload($name,true);
            $data['img_err'] = $this->upload->display_errors();
	    if($data['img_err']!=""){
		//$error = $data['img_err'];
                //return $error;
		return false;
		exit;
	    }
            /*if($data['img_err'] <> "" )
            {
                $error = array('error' => $data['img_err']);
                return $error;
		pr($data);
            }*/
            else
            {
                $fInfo =$this->upload->data();
                if($is_thumb == 'Y')
                {
                   $fileName=$fInfo['file_name'];
                   $originalImage=$fInfo['full_path'];
                   $thumbPath=file_upload_absolute_path().$upload_folder.'/thumbs/'.$fileName;
                   $this->_createThumbnail($originalImage,$thumbPath,$thumb_width,$thumb_height);
                }
                $imagename=$fInfo['file_name'];
                $result = array('image_name' => $imagename);
                return $result;

            }

	}

        /******************* FOR IMAGE THUMB **************************/
        Public function _createThumbnail($original_image='',$thumb_image_pathe='',$thumb_width=0,$thumb_height=0)
        {
            $config_thumb = array(
            'image_library'=>'gd2',
            'source_image' => $original_image, //get original image
            'new_image' => $thumb_image_pathe, //save as new image //need to create thumbs first
            'maintain_ratio' => true,
            'width' => $thumb_width,
            'height' => $thumb_height

            );
            $this->load->library('image_lib');
            $this->image_lib->initialize($config_thumb);
            $this->image_lib->resize();
            $this->image_lib->clear();
            return true;
            //$this->image_lib->display_errors();
         }

        /******************* FOR FILE UPLOAD **************************/
        public function fileUpload($name='',$upload_folder='')	{

            $this->load->library('upload');
            $config = array('upload_path'       => '../uploads/'.$upload_folder.'/',
                                'allowed_types'     => 'doc|docx|pdf',
                                'max_size'          => 0,
                                'max_width'         => 0,
                                'encrypt_name'      => FALSE
                                );
             $this->upload->initialize($config);
             $this->upload->do_upload($name,true);
             $data['err'] = $this->upload->display_errors();
             if($data['err'] <> "" )
             {
                $error = array('error' => $data['err']);
                return $error;
             }
             else
             {
                 $fInfo =$this->upload->data();
                 $fileName=$fInfo['file_name'];
                 $result = array('file_name' => $fileName);
                 return $result;
             }
        }

	public function chk_login(){ 
	    $id 	= $this->session->userdata('STUDENT_ID');
	    $ins_id 	= $this->session->userdata('INSTRUCTOR_ID');
	    if( (!$id || empty($id)) && (!$ins_id || empty($ins_id)) ){
		redirect(base_url().'login');
		return false;
	    }
	   return true;
	}
	public function chk_not_login(){ 
	    $id = $this->session->userdata('STUDENT_ID');
	    if( $id || !empty($id) ){
		redirect(base_url().'learn/');
		return false;
	    }
	   return true;
	}
	public function chk_student_login(){ 
	    $id 	= $this->session->userdata('STUDENT_ID');
	    if( (!$id || empty($id)) ){
		redirect(base_url().'login');
		return false;
	    }
	   return true;
	}
	public function chk_ins_login(){ 
	    $id 	= $this->session->userdata('INSTRUCTOR_ID');
	    if( (!$id || empty($id)) ){
		redirect(base_url().'login');
		return false;
	    }
	   return true;
	}
	
	public function chk_ins_not_login(){ 
	    $id = $this->session->userdata('INSTRUCTOR_ID');
	    if( $id || !empty($id) ){
		redirect(base_url().'instructor/dashboard/');
		return false;
	    }
	   return true;
	}
	
	public function chk_not_login_both(){ 
	    $id = $this->session->userdata('STUDENT_ID');
	    $ins_id = $this->session->userdata('INSTRUCTOR_ID');
	    if( $id || !empty($id) ){
		redirect(base_url().'learn/');
		return false;
	    }else if($ins_id || !empty($ins_id)){
		redirect(base_url().'instructor/dashboard/');
		return false;
	    }
	   return true;
	}
	
	public function chk_payment(){
		$user_id 		= $this->session->userdata('user_id');
		$user_details 		= $this->model_basic->detailsDB('dt_user_master',array('user_id'=>$user_id),'payment');
		$payment 		= $user_details[0]['payment'];
		if($payment == 'N'){
			redirect(base_url().'user/payment_expire/');
			return false;
		}
		return true;
	}

}

/* The MY_Controller class is autoloaded as required */