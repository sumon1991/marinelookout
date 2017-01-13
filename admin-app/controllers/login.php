<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_administrator');

	}

	public function index()
	{
		if(isset($_SESSION['USER_ID']) && $_SESSION['USER_ID']!='') {
			$permited_module = explode(',',$this->nsession->userdata('MODULES'));
			if(in_array(1,$permited_module)){
				redirect(BACKEND_URL."dashboard");
				exit();
			} else {
				redirect(BACKEND_URL."passageplan/index");
				exit();
			}
			// redirect('dashboard/');
			// exit;	
		}	
		$this->data = '';		
		$this->elements['middle']='login/view_login';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout_login');
		$this->layout->multiple_view($this->elements,$this->elements_data);
		
	}
	public function do_login()
	{
		if($this->input->post('action')=='login')
		{
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			$this->form_validation->set_rules('admin_email', 'Email', 'trim|required|valid_email');        
			$this->form_validation->set_rules('password', 'Password', 'trim|required');	        
			// echo $this->input->get_post('admin_email');
			// echo $this->input->get_post('password');
			// die;
			if ($this->form_validation->run() == TRUE)
			{
				$email		= mysql_real_escape_string( trim( $this->input->get_post('admin_email')));
				$password	= mysql_real_escape_string( trim( $this->input->get_post('password')));
				$arrUser 	= $this->model_administrator->getSingle($email, $password);
				
				if(is_array($arrUser) && count($arrUser) > 0)
				{

					if($arrUser['role'] == 'admin')
					{
						$this->nsession->set_userdata(
									array(
											'USER_ID' 	=> $arrUser['id'],
											'FIRST_NAME'	=> $arrUser['first_name'],
											'LAST_NAME'	=> $arrUser['last_name'],
											'ADMIN_EMAIL'	=> $arrUser['admin_email'],
											'ROLE'		=> $arrUser['role'],
											'MODULES'	=> $arrUser['menu_id'],
											'ADMIN_IMAGE'	=> $arrUser['image'],
											'ADMIN_PASSWORD'=> $password
										 )
								);
					}
					else
					{
						$this->nsession->set_userdata(
									array(
											'USER_ID' 	=> $arrUser['id'],
											'FIRST_NAME'	=> $arrUser['first_name'],
											'LAST_NAME'	=> $arrUser['last_name'],
											'ADMIN_EMAIL'	=> $arrUser['admin_email'],
											'ROLE'		=> $arrUser['role'],
											'MODULES'	=> $arrUser['permission'],
											'ADMIN_IMAGE'	=> $arrUser['image'],
											'ADMIN_PASSWORD'=> $password
										 )
								);
					}

					$permited_module = explode(',',$this->nsession->userdata('MODULES'));
					if(in_array(1,$permited_module)){
						redirect(BACKEND_URL."dashboard");
						exit();
					} else {
						redirect(BACKEND_URL."passageplan/index");
						exit();
					}
				}
				else
				{
					$this->nsession->set_userdata('ERROR', 'Invalid username or password');
					redirect(BACKEND_URL);
				}
				
			}
		}	
	}

	public function forgotpassword()
	{
		$this->data = '';
		
		$this->data['msg'] = $this->nsession->userdata('msg');
		$this->nsession->set_userdata('msg', '');
		
		if($this->nsession->userdata('USER_ID') != '')
		{
			$url = BACKEND_URL."login/";
			redirect($url);
		}
		
		$this->elements['middle']='login/forgotpassword';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout_login');
		$this->layout->multiple_view($this->elements,$this->elements_data);
		
	}


		 public function do_forgotpassword()
        {
            $this->load->library('email');
            if($this->nsession->userdata('USER_ID') != '')
			{
				$url = BACKEND_URL."login/";
				redirect($url); exit;
			}
				
            
            $email = $this->input->get_post('admin_email');
            
            if(isset($email) && !empty($email))
			{
			$arrUser 	= $this->model_administrator->getUserByEmail($email);			
			
			if(count($arrUser) > 0){	
				
				$first_name = $arrUser[0]['first_name'];
				$last_name 	= $arrUser[0]['last_name'];	
				$password 	= $arrUser[0]['password'];					
				$settings 	= $this->model_administrator->get_settings('1,6');				
                                
				//$ConfigMail['mailtype'] 	= 'html';
				$ConfigMail['to'] 	= $arrUser[0]['admin_email'];
				$ConfigMail['from']	= $settings['webmaster_email'];
				$ConfigMail['from_name']= $settings['sitename'];
				$ConfigMail['subject']	= "Password Recovery at ".BACKEND_URL;
				$ConfigMail['message'] = '<html><body>';
				$ConfigMail['message'].= 'Hello '.$first_name.' '.$last_name;
				$ConfigMail['message'].= '</br>';
				$ConfigMail['message'].= '<p> Please note down your password for admin panel : '.$password.'</p>';
				$ConfigMail['message'].= '</br>';
				$ConfigMail['message'].= '<p>Thanks, </p>';
				$ConfigMail['message'].= '</br>';
				$ConfigMail['message'].= '<p>Team '.$settings['sitename'].'</p>';
				$ConfigMail['message'].= '</br>';
				$ConfigMail['message'].= '<a href="'.BACKEND_URL.'">'.BACKEND_URL.'</a>';
				$ConfigMail['message'].= '</body></html>';
						
				$mail 		= send_email($ConfigMail);
				
				if($mail)	
				{	
					$msg = 'Password sent to your mail address. Please check.';	
				}
				}else{
					$msg = stripslashes($email) . ' was not found in our database';
				}
			}
			else
			{
				$msg = 'Please enter mail address';			
			}
			
			$this->nsession->set_userdata('msg', $msg);
			redirect('login/forgotpassword');
			return true;
		
            
        }		


}
?>