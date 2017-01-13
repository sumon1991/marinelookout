<?php
class Home extends MY_Controller{

    public function __construct(){
        parent:: __construct();
	$this->load->model(array('model_home','model_common','model_administrator'));
	 $this->load->helper('text');
    }
    
    public function index()
    {
	$this->data 			= 	'';
	$this->data['top_content'] 	= 	$this->model_basic->getValues_conditions('ep_cms','','','cms_id = 34');
	$this->data['home_content']	= 	$this->model_home->get_home_content();
	$this->templatelayout->header();
	$this->templatelayout->footer();	
	$this->elements['middle']	=	'home/index';			
	$this->elements_data['middle'] 	= 	$this->data;		    
	$this->layout->setLayout('layout');
	$this->layout->multiple_view($this->elements,$this->elements_data);        
    }
    
    public function activate()
    {
	$activate_slug = $this->uri->segment(3);
	$id = $this->model_basic->updateIntoTable('ep_student',array('unique_slug'=> $activate_slug),array('unique_slug'=>'','is_active'=>'yes','wallet'=>100));
	if($id != '')
	{
	    echo "Your Account has been successfuly activated.Click <a href='".FRONTEND_URL."'>here</a> to login.";
	    exit;
	}
	else
	{
	    echo "Not Found";exit;
	}
    }
    
    public function sign_up()
    {
	$user_id = $this->session->userdata('student_id');
	if($user_id != '')
	    redirect(FRONTEND_URL);
	    
	$this->data			= array();
	$this->data['left_content'] 	= $this->model_basic->getValues_conditions('ep_cms','','','cms_id = 34 OR cms_id = 35');
	if($this->input->post('action')=='process')
        {
	    $this->form_validation->set_rules('firstname', 'First Name', 'trim|required');
            $this->form_validation->set_rules('lastname', 'Last Name', 'trim|required');	    
	    $this->form_validation->set_rules('indos', 'Indos', 'trim|required|callback_is_indos_exists');
	    $this->form_validation->set_rules('email', 'Email', 'trim|required');
	    $this->form_validation->set_rules('year', 'year', 'trim|required');
	    $this->form_validation->set_rules('month', 'month', 'trim|required');        
	    $this->form_validation->set_rules('day', 'day', 'trim|required');
	    $this->form_validation->set_rules('gender', 'Gender', 'trim|required');
	    $this->form_validation->set_rules('terms', 'Terms and Condition', 'trim|required');	    
            $this->form_validation->set_rules('password', 'Password', 'trim|required|matches[conf_password]');
	    
	    $is_exsist = $this->model_basic->getValues_conditions('ep_student','','','email = "'.trim($this->input->post('email')).'"');
	    if(isset($is_exsist[0]['email']))
	    {
		$this->session->set_userdata('errmsg', "Sign up can't be completed. email id already exsist.");
		redirect(FRONTEND_URL.'home/sign_up/');
		exit;
	    }
	    
	    if($this->form_validation->run() == TRUE)
            {
					$year 	= $this->input->post('year');
					$month 	= $this->input->post('month');
					$day 	= $this->input->post('day');
		
					$dob 	= $year.'-'.$month.'-'.$day;
		
		
		$firstname 	= addslashes(trim($this->input->post('firstname')));
		$lastname 	= addslashes(trim($this->input->post('lastname')));
		$indos 		= addslashes(trim($this->input->post('indos')));
		$email 		= addslashes(trim($this->input->post('email')));
		//$dob 		= addslashes(trim($this->input->post('dob')));
		$gender 	= addslashes(trim($this->input->post('gender')));
		$mobile 	= addslashes(trim($this->input->post('mobile')));
		$password 	= addslashes(trim($this->input->post('password')));
		$random_string  = rand();
		if(is_array($_FILES) && count($_FILES)>0)
                {
		    $upload_config['field_name']        = 'image';
                    $upload_config['file_upload_path']  = 'student/';
                    $upload_config['max_size']      = '';
                    $upload_config['max_width']     = '';
                    $upload_config['max_height']        = '';
                    $upload_config['allowed_types']     = 'jpg|jpeg|gif|png';
                    
                    $thumb_config['thumb_create']       = false;
                    $thumb_config['thumb_file_upload_path'] = 'thumb/';
                    $thumb_config['thumb_marker']       = '';
                    $thumb_config['thumb_width']        = '304';
                    $thumb_config['thumb_height']       = '138';
                
                    $sUploaded = image_upload($upload_config, $thumb_config);
		    if($sUploaded != '')
		    {
			$Insertarray = array(
					'firstname'   =>  $firstname,
					'lastname'    =>  $lastname,
					'email'       =>  $email,
					'dob'         =>  $dob,
					'indos'	      =>  $indos,
					'added_on'    =>  date('Y-m-d H:i:s', time()),
					'gender'      =>  $gender,
					'mobile'      =>  $mobile,
					'image'       =>  $sUploaded,
					'password'    =>  $password,
					'is_active'   => 'no',
					'unique_slug' => $random_string
				    );
			$id = $this->model_basic->insertIntoTable('ep_student',$Insertarray);
		    }
		    else
		    {
			$Insertarray = array(
					'firstname'   =>  $firstname,
					'lastname'    =>  $lastname,
					'email'       =>  $email,
					'indos'	      =>  $indos,
					'dob'         =>  $dob,
					'gender'      =>  $gender,
					'added_on'    =>  date('Y-m-d H:i:s', time()),
					'mobile'      =>  $mobile,
					'password'    =>  $password,
					'is_active'   => 'no',
					'unique_slug' => $random_string
				    );
			$id = $this->model_basic->insertIntoTable('ep_student',$Insertarray);
		    }
		}
		else
		{
		    $Insertarray = array(
					'firstname'   =>  $firstname,
					'lastname'    =>  $lastname,
					'email'       =>  $email,
					'dob'         =>  $dob,
					'indos'	      =>  $indos,
					'gender'      =>  $gender,
					'added_on'    =>  date('Y-m-d H:i:s', time()),
					'mobile'      =>  $mobile,
					'image'       =>  $sUploaded,
					'password'    =>  $password,
					'is_active'   => 'no',
					'unique_slug' => $random_string
				    );
		    $id = $this->model_basic->insertIntoTable('ep_student',$Insertarray);
		}
		$to      = $email;
		$subject = 'Student Registration';
		$mr_mrs = '';
		if($gender == 'male')
		    $mr_mrs = 'Mr';
		else
		    $mr_mrs = 'Ms';
		    
		$message = '<table>
				<tr>
				    <td>Hello, '.$mr_mrs.'. '.$firstname.' '.$lastname.'</td>
				    <td><img src="'.FRONTEND_URL.'images/logo.jpg"/></td>
				</tr>
				<tr>
				    <td>&nbsp;</td>
				</tr>
				<tr>
				    <td>&nbsp;&nbsp;Welcome to Marinelookout. Please click on the link to activate you account.</td>
				</tr>
				<tr>
				    <td><a href="'.FRONTEND_URL.'home/activate/'.$random_string.'" target="_blank">'.FRONTEND_URL.'.home/activate/'.$random_string.'</a></td>
				</tr>
				<tr>
				    <td>We will not share you email with third parties.</td>
				</tr>
				<tr>
				    <td>&nbsp;</td>
				</tr>
				<tr>
				    <td>&nbsp;</td>
				</tr>
				<tr>
				    <td>Thank you,</td>
				</tr>
				<tr>
				    <td>Team Marinelookout</td>
				</tr>
			    </table>';
		$headers = 'From: info@epariksha.com' . "\r\n".'X-Mailer: PHP/' . phpversion();
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		$is_send = mail($to, $subject, $message, $headers);
		
		$to      = 'info@epariksha.com';
		$subject = 'Student Registration';
		$message = '<table><tr><td>Hello,</td></tr><tr><td>One new student has been registered</td></tr><tr><td>Student Details : </td></tr><tr><td>Student Name : '.$firstname.' '.$lastname.'</td></tr><tr><td>Student dob : '.$dob.' </td></tr><tr><td>Student mobile : '.$mobile.'</td></tr></table>';
		$headers = 'From: '.$email . "\r\n".'X-Mailer: PHP/' . phpversion();
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		$is_send = mail($to, $subject, $message, $headers);
		
		if($is_send == 1)
		{
		    $this->session->set_userdata('succmsg', "Your account is created successfully. A verification link has been sent to your email address. Please check your email to activate your account.");
		}
		else
		{
		    if($id != '')
		    {
			$where = "id = '".$id."'";
			$this->model_basic->deleteData(STUDENT, $where);
		    }
		    $this->session->set_userdata('errmsg', "Sign up can't be completed. Please Sign up with your correct email id.");
		}
	    }
	}
	$this->data['succmsg'] = $this->session->userdata('succmsg');
	$this->data['errmsg'] = $this->session->userdata('errmsg');		
	$this->session->set_userdata('succmsg', "");		
	$this->session->set_userdata('errmsg', "");
	$this->templatelayout->header();
	$this->templatelayout->footer();
	$this->elements['middle']='user/signup';
	$this->elements_data['middle'] = $this->data;			    
	$this->layout->setLayout('layout');
	$this->layout->multiple_view($this->elements,$this->elements_data);
    }


    // LOGIN STUDENT
    public function login()
    {
	    if($this->input->post('action')=='process')
	    {
		    $this->form_validation->set_rules('email', 'Email', 'trim|required');
		    $this->form_validation->set_rules('password', 'Password', 'trim|required');	    
		    
		    if($this->form_validation->run() == TRUE)
		    {
				$email 		= addslashes(trim($this->input->post('email')));
				$password 	= addslashes(trim($this->input->post('password')));
				$details	= $this->model_basic->getValues_conditions('ep_student',array('id','firstname','lastname','gender'),'','email = "'.$email.'" AND password = "'.$password.'" AND is_active = "yes"');

				if(isset($details[0]['id']) && $details[0]['id'] != '')
				{
				    $this->session->set_userdata('student_id',$details[0]['id']);
				    if($details[0]['gender'] == 'male')
					$this->session->set_userdata('student_name','Mr. '.ucfirst($details[0]['firstname']).' '.ucfirst($details[0]['lastname']));
				    else
					$this->session->set_userdata('student_name','Ms. '.ucfirst($details[0]['firstname']).' '.ucfirst($details[0]['lastname']));
				    $idArr		= array('id' => $details[0]['id']);
				    $ip 	  	= isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '';
				    $updateArr		= array('last_login' => date('Y-m-d H:i:s'),'login_ip_address'=>$ip);
				    $this->model_basic->updateIntoTable('ep_student', $idArr, $updateArr);
				    echo 1;exit;
				    //redirect(FRONTEND_URL."my_account/result/");
				}
				else
				{
				    $details	= $this->model_basic->getValues_conditions('ep_student',array('id','firstname','lastname','gender'),'','email = "'.$email.'" AND password = "'.$password.'"');
				    if(isset($details[0]['id']) && $details[0]['id'] != '')
				    {
					echo 2;
					exit;
				    }
				    else
				    {
					echo 0;
					exit;
				    }

				    //$this->session->set_userdata('errmsg', "Wrong username or password");
				    //redirect(FRONTEND_URL."home/login/");
				}
		    }
		}
		
		//$this->data	=	array();
		//$this->data['errmsg'] = $this->session->userdata('errmsg');				
		//$this->session->set_userdata('errmsg', "");
		//$this->templatelayout->header();
		//$this->templatelayout->footer();
		//$this->elements['middle']='user/login';
		//$this->elements_data['middle'] = $this->data;			    
		//$this->layout->setLayout('layout');
		//$this->layout->multiple_view($this->elements,$this->elements_data);
    }
    
    public function general_login()
    {
	    if($this->input->post('action')=='process')
	    {
		    $this->form_validation->set_rules('email', 'Email', 'trim|required');
		    $this->form_validation->set_rules('password', 'Password', 'trim|required');	    
		    
		    if($this->form_validation->run() == TRUE)
		    {
				$email 		= addslashes(trim($this->input->post('email')));
				$password 	= addslashes(trim($this->input->post('password')));
				$details	= $this->model_basic->getValues_conditions('ep_student',array('id','firstname','lastname'),'','email = "'.$email.'" AND password = "'.$password.'"');

				if(isset($details[0]['id']) && $details[0]['id'] != '')
				{
				    $this->session->set_userdata('student_id',$details[0]['id']);
				    $this->session->set_userdata('student_name',ucfirst($details[0]['firstname']).' '.ucfirst($details[0]['lastname']));
				    $idArr		=	array('id' => $details[0]['id']);
				    $ip 	  	= isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '';
				    $updateArr	=	array('last_login' => date('Y-m-d H:i:s'),'login_ip_address'=>$ip);
				    $this->model_basic->updateIntoTable('ep_student', $idArr, $updateArr);
				    //echo 1;exit;
				    redirect(FRONTEND_URL."my_account/result/");
				}
				else
				{
				    //echo 0;
				    //exit;
				    $this->session->set_userdata('errmsg', "Wrong username or password");
				    redirect(FRONTEND_URL."home/login/");
				}
		    }
		}
		
		//$this->data	=	array();
		//$this->data['errmsg'] = $this->session->userdata('errmsg');				
		//$this->session->set_userdata('errmsg', "");
		//$this->templatelayout->header();
		//$this->templatelayout->footer();
		//$this->elements['middle']='user/login';
		//$this->elements_data['middle'] = $this->data;			    
		//$this->layout->setLayout('layout');
		//$this->layout->multiple_view($this->elements,$this->elements_data);
    }
    
    public function logout()
    {
		$this->session->set_userdata('student_id','');
		$this->session->set_userdata('student_name','');
		redirect(FRONTEND_URL);
		exit;
    }

	 public function do_forgotpassword()
        {
            $this->load->library('email');
   	    $email = $this->input->get_post('email');
            
            if(isset($email) && !empty($email))
	    {
		$arrUser 	= $this->model_administrator->getUserByEmail($email);			
	    
		if(count($arrUser) > 0){	
		    
		    $first_name = $arrUser[0]['firstname'];
		    $last_name 	= $arrUser[0]['lastname'];	
		    $password 	= $arrUser[0]['password'];					
		    $settings 	= $this->model_administrator->get_settings('1,6,9');				
		    //pr($settings);
		    //$ConfigMail['mailtype'] 	= 'html';
		    $ConfigMail['to'] 		= $arrUser[0]['email'];
		    $ConfigMail['from']		= $settings['webmaster_email'];
		    $ConfigMail['from_name']	= $settings['sitename'];
		    $ConfigMail['subject']	= "Password Recovery at ".$settings['sitename'];
		    $ConfigMail['message'] = '<html><body>';
		    $ConfigMail['message'].= 'Hello '.$first_name.' '.$last_name;
		    $ConfigMail['message'].= '</br>';
		    $ConfigMail['message'].= '<p> Please note down your password for admin panel : '.$password.'</p>';
		    $ConfigMail['message'].= '</br>';
		    $ConfigMail['message'].= '<p>Thanks, </p>';
		    $ConfigMail['message'].= '</br>';
		    $ConfigMail['message'].= '<p>Team '.$settings['sitename'].'</p>';
		    $ConfigMail['message'].= '</br>';
		    $ConfigMail['message'].= '<a href="'.FRONTEND_URL.'">'.FRONTEND_URL.'</a>';
		    $ConfigMail['message'].= '</body></html>';
				    
		    $mail 		= send_email($ConfigMail);
		    
		    if($mail)	
		    {	
			echo $msg = 1;exit;	
		    }
		    }else{
			echo $msg = stripslashes($email) . ' was not found in our database';exit;
		    }
	    }
	    else
	    {
		echo $msg = 'Please enter mail address';exit;
	    }
	    exit;
	    //$this->session->set_userdata('msg', $msg);
	    //redirect(FRONTEND_URL.'home/');
	    //return true;
        }

    function is_indos_exists()
    {
		$indos		= strip_tags(addslashes(trim($this->input->post('indos'))));
		$whereArr	= array( 'indos' => $indos);
		$bool 	= $this->model_common->checkRowExists(STUDENT, $whereArr );	
		if($bool == 0){
			$this->form_validation->set_message('is_indos_exists', 'This %s already exists');
			return FALSE;
		}else 	{
				return TRUE;
				}
    }
}
?>