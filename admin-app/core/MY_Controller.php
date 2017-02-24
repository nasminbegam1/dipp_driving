<?php (defined('BASEPATH')) OR exit('No direct script access allowed');
class MY_Controller extends MX_Controller {


	function __construct() {
            $this->load->library(array('parser','email'));
            header('Cache-Control: no-store, no-cache, must-revalidate'); 
            header('Cache-Control: post-check=0, pre-check=0', FALSE); 
            header('Pragma: no-cache'); 
        }

        /******************* FOR LOGIN CHECK **************************/
        public function checkLogin()
	{
            if($this->session->userdata('admin_id')=='')
            {
                    $this->session->set_flashdata('message', array('title'=>'No Access','content'=>'You don\'t have permission to access this page','type'=>'errormsgbox'));
                    redirect(base_url()."welcome");
            }
        }



		/******************* FOR LAYOUT TEMPLATE **************************/
		public function getTemplate($header_display=true,$top_menu_display=true,$sidebar_display=true,$footer_display=true)
		{
		/*********** FOR LAYOUT ************/
		($header_display == true)?$this->template->write_view('header', 'template/header'):'';
                 ($top_menu_display == true)?$this->template->write_view('top_menu', 'template/top_menu'):'';
                ($sidebar_display == true)?$this->template->write_view('sidebar', 'template/sidebar'):'';
                ($footer_display == true)?$this->template->write_view('footer', 'template/footer'):'';
		}
		
        /******************* FOR MAIL SEND **************************/
        public function send_mail($email='noreply@mail.com', $name='DIPP', $to=NULL, $cc=NULL, $bcc=NULL,$subject_line='No Subject', $message='No Message',$attachment_file=array())
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
            $config = array('upload_path'       => '../uploads/'.$upload_folder.'/',
                            'allowed_types'     => 'gif|jpg|jpeg|png',
                            'max_size'          => 0,
                            'max_width'         => 0,
                            'encrypt_name'      => TRUE
                            );
            $this->upload->initialize($config);
            $this->upload->do_upload($name,true);
            $data['img_err'] = $this->upload->display_errors();
            if($data['img_err'] <> "" )
            {
                $error = array('error' => $data['img_err']);
                return $error;

            }
            else
            {
                $fInfo =$this->upload->data();
                if($is_thumb == 'Y')
                {
                   $fileName=$fInfo['file_name'];
                   $originalImage=$fInfo['full_path'];
                   $thumbPath='../uploads/'.$upload_folder.'/thumbs/'.$fileName;
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

        function editor($path,$width) {
            //Loading Library For Ckeditor
            $this->load->library('ckeditor');
            $this->load->library('ckFinder');
            //configure base path of ckeditor folder 
            $this->ckeditor->basePath = base_url().'js/ckeditor/';
            $this->ckeditor-> config['toolbar'] = 'Full';
            $this->ckeditor->config['language'] = 'en';
            $this->ckeditor-> config['width'] = $width;
            //configure ckfinder with ckeditor config 
            $this->ckfinder->SetupCKEditor($this->ckeditor,$path); 
        }

}

/* The MY_Controller class is autoloaded as required */