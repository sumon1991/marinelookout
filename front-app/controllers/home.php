<?php
class Home extends MY_Controller{

    public function __construct(){
        parent:: __construct();
		$this->load->model(array('model_home','model_basic','model_common','model_administrator', 'model_blog_with_category'));
	 	$this->load->helper('text');
	 	$this->load->library('session');
    }
    
    public function index()
    {
    	$this->data 						= '';
		$this->data['top_content'] 			= $this->model_basic->getValues_conditions('ep_cms','','','cms_id = 34');
		$this->data['home_content']			= $this->model_home->get_home_content();
		$this->data['category_blog_list'] 	= $this->model_blog_with_category->getAllData();
		$this->data['dashboard_cats'] 		= $this->model_blog_with_category->dashboardCategories();
		$this->data['all_notice'] 			= $this->model_blog_with_category->recentNotices();
		$this->data['popular_post_details']	= $this->model_blog_with_category->popularPosts();
        $this->data['quick_links']          = $this->model_blog_with_category->getAllQuickLinks();
		// print_r($this->data['dashboard_cats']);
		// die; 
		$this->templatelayout->header();
		$this->templatelayout->footer();	
		$this->elements['middle']	=	'home/index';			
		$this->elements_data['middle'] 	= 	$this->data;		    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);        
    }

    public function redirect()
    {
    	redirect(FRONTEND_URL.'sign_up');
    }

    public function comingsoon()
    {
    	$this->data 						= '';
		$this->data['top_content'] 			= $this->model_basic->getValues_conditions('ep_cms','','','cms_id = 34');
		$this->data['home_content']			= $this->model_home->get_home_content();
		$this->data['category_blog_list'] 	= $this->model_blog_with_category->getAllData();
		$this->data['dashboard_cats'] 		= $this->model_blog_with_category->dashboardCategories();
		$this->data['all_notice'] 			= $this->model_blog_with_category->recentNotices();
		$this->data['popular_post_details']	= $this->model_blog_with_category->popularPosts();
        $this->data['quick_links']          = $this->model_blog_with_category->getAllQuickLinks();
		// print_r($this->data['dashboard_cats']);
		// die; 
		$this->templatelayout->header();
		$this->templatelayout->footer();	
		$this->elements['middle']	=	'home/coming-soon';			
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

    public function subscribe()
    {
    	
		$email = $this->input->get('emailid', TRUE);
		$response = $this->model_blog_with_category->suscribeme($email);
		echo $response;
    	
    }
    
    public function sign_up()
    {

		$log='';
		$log = $this->uri->segment(3);
	
	
		$user_id = $this->session->userdata('student_id');
		if($user_id != '') {
		    redirect(FRONTEND_URL);
		}
		    
		$this->data			= array();
		$this->data['log'] = $log;
		$this->data['left_content'] 	= $this->model_basic->getValues_conditions('ep_cms','','','cms_id = 34 OR cms_id = 35');

		// print_r($this->data['left_content']);
		// die;
		if($this->input->post('hiddenaction')=='process')
	    {
	        	
		    $this->form_validation->set_rules('firstname', 'First Name', 'trim|required');
	        $this->form_validation->set_rules('lastname', 'Last Name', 'trim|required');	    
		    $this->form_validation->set_rules('email', 'Email', 'trim|required');
		    $this->form_validation->set_rules('terms', 'Terms and Condition', 'trim|required');
		    $this->form_validation->set_rules('password', 'Password', 'trim|required');
		    $this->form_validation->set_rules('conf_password', 'confirm password', 'trim|required|matches[password]');
		    
		    
		    $is_exsist = $this->model_basic->getValues_conditions('ep_student','','','email = "'.trim($this->input->post('email')).'"');
		    if(isset($is_exsist[0]['email']))
		    {
			$this->session->set_userdata('errmsg', "Sign up can't be completed. email id already exsist.");
			redirect(FRONTEND_URL.'sign_up');
			exit;
		    }
		    
		    if($this->form_validation->run() == TRUE)
	        {
			
			
				$firstname 	= addslashes(trim($this->input->post('firstname')));
				$lastname 	= addslashes(trim($this->input->post('lastname')));
				$email 		= addslashes(trim($this->input->post('email')));
				//$dob 		= addslashes(trim($this->input->post('dob')));
				//$gender 	= addslashes(trim($this->input->post('gender')));
				$mobile 	= addslashes(trim($this->input->post('mobile')));
				$password 	= addslashes(trim($this->input->post('password')));
				
				$random_string  = rand();
			
			

			
			    $Insertarray = array(
						'firstname'   =>  $firstname,
						'lastname'    =>  $lastname,
						'email'       =>  $email,
						'added_on'    =>  date('Y-m-d H:i:s', time()),
						'mobile'      =>  $mobile,
						'password'    =>  $password,
						'is_active'   => 'no',
						'unique_slug' => $random_string
					    );
			    $id = $this->model_basic->insertIntoTable('ep_student',$Insertarray);
				
				
				$Insertarray = array(
							'user_login'   =>  $email,
							'user_pass'    =>  md5($password),
							'user_nicename'=>  $firstname.' '.$lastname,
							'user_email'   =>  $email,
							'user_status'  =>  0
						    );
				$id = $this->model_basic->insertIntoTable('epwp_users',$Insertarray);

				$Insertarray = array(
							'umeta_id'   	=>  NULL,
							'user_id'    	=>  $id,
							'meta_key'	=>  'wp_capabilities',
							'meta_value'   	=>  'a:1:{s:7:"student";s:1:"1";}'
						    );
				$id = $this->model_basic->insertIntoTable('epwp_usermeta',$Insertarray);

				$Insertarray = array(
							'umeta_id'   	=>  NULL,
							'user_id'    	=>  $id,
							'meta_key'	=>  'wp_capabilities',
							'meta_value'   	=>  '12'
						    );
				$id = $this->model_basic->insertIntoTable('epwp_usermeta',$Insertarray);

				$arrUser 	= $this->model_administrator->getUserByEmail($email);	
				    
			    $first_name = $arrUser[0]['firstname'];
			    $last_name 	= $arrUser[0]['lastname'];					
								
			    $settings 	= $this->model_administrator->get_settings('1,6,9');
			    $noreplyext = "IMPORTANT: Please do not reply to this message or mail as this is an automated mail service.For any queries, please write us on info@marinelookout.com";
						
			    //pr($settings);
			    //$ConfigMail['mailtype'] 	= 'html';
			    $ConfigMail['to'] 		= $arrUser[0]['email'];
			    $ConfigMail['from']		= $settings['webmaster_email'];
			    $ConfigMail['from_name']= $settings['sitename'];
			    $ConfigMail['subject']	= "Student Registration";
			    $ConfigMail['message'] = '<html><body>';
			    $ConfigMail['message'].= '<table>';
			    $ConfigMail['message'].= '<tr>';
			    $ConfigMail['message'].= '<td>Hello, '.$firstname.' '.$lastname.'</td>';
			    $ConfigMail['message'].= '<td><img src="'.FRONTEND_URL.'images/logo.jpg"/></td>';
			    $ConfigMail['message'].= '</tr>';
			    $ConfigMail['message'].= '<tr>';
			    $ConfigMail['message'].= '<td>&nbsp;</td>';
			    $ConfigMail['message'].= '</tr>';
			    $ConfigMail['message'].= '<tr>';
			    $ConfigMail['message'].= '<td>&nbsp;&nbsp;Welcome to Marinelookout. Please click on the link to activate you account.</td>';
			    $ConfigMail['message'].= '</tr>';
			    $ConfigMail['message'].= '<tr>';
			    $ConfigMail['message'].= '<td><a href="'.FRONTEND_URL.'home/activate/'.$random_string.'" target="_blank">'.FRONTEND_URL.'.home/activate/'.$random_string.'</a></td>';
			    $ConfigMail['message'].= '</tr>';
			    $ConfigMail['message'].= '<tr>';
			    $ConfigMail['message'].= '<td>We will not share you email with third parties.</td>';
			    $ConfigMail['message'].= '</tr>';
			    $ConfigMail['message'].= '<tr>';
			    $ConfigMail['message'].= '<td>&nbsp;</td>';
			    $ConfigMail['message'].= '</tr>';
			    $ConfigMail['message'].= '<tr>';
			    $ConfigMail['message'].= '<td>&nbsp;</td>';
			    $ConfigMail['message'].= '</tr>';
			    $ConfigMail['message'].= '<tr>';
			    $ConfigMail['message'].= '<td>Thank you,</td>';
			    $ConfigMail['message'].= '</tr>';
			    $ConfigMail['message'].= '<tr>';
			    $ConfigMail['message'].= '<td>Team Marinelookout</td>';
			    $ConfigMail['message'].= '</tr>';
			    $ConfigMail['message'].= '<tr>';
			    $ConfigMail['message'].= '<td>&nbsp;</td>';
			    $ConfigMail['message'].= '</tr>';
			    $ConfigMail['message'].= '<tr>';
			    $ConfigMail['message'].= '<td>&nbsp;</td>';
			    $ConfigMail['message'].= '</tr>';
			    $ConfigMail['message'].= '<tr>';
			    $ConfigMail['message'].= '<td>--------------------------------------------</td>';
			    $ConfigMail['message'].= '</tr>';
			    $ConfigMail['message'].= '<tr>';
			    $ConfigMail['message'].= '<td>'.$noreplyext.'</td>';
			    $ConfigMail['message'].= '</tr>';
			    $ConfigMail['message'].= '</table>';
			    $ConfigMail['message'].= '</body></html>';

			    $is_send_first_mail 	= send_email($ConfigMail);
			    
				
			    $ConfigMail1['to'] 		= $settings['webmaster_email'];
			    $ConfigMail1['from']		= $arrUser[0]['email'];
			    $ConfigMail1['from_name']	= $settings['sitename'];
			    $ConfigMail1['subject']	= "Student Registration";
			    $ConfigMail1['message'] = '<html><body>';
			    $ConfigMail1['message'].= '<table>';
			    $ConfigMail1['message'].= '<tr>';
			    $ConfigMail1['message'].= '<td>Hello,</td>';
			    $ConfigMail1['message'].= '</tr>';
			    $ConfigMail1['message'].= '<tr>';
			    $ConfigMail1['message'].= '<td>One new student has been registered</td>';
			    $ConfigMail1['message'].= '</tr>';
			    $ConfigMail1['message'].= '<tr>';
			    $ConfigMail1['message'].= '<td>Student Details : </td>';
			    $ConfigMail1['message'].= '</tr>';
			    $ConfigMail1['message'].= '<tr>';
			    $ConfigMail1['message'].= '<td>Student Name : '.$firstname.' '.$lastname.'</td>';
			    $ConfigMail1['message'].= '</tr>';
			    $ConfigMail1['message'].= '<tr>';
			    $ConfigMail1['message'].= '<td>Student mobile : '.$mobile.'</td>';
			    $ConfigMail1['message'].= '</tr>';
			    $ConfigMail1['message'].= '</table>';

				$is_send 		= send_email($ConfigMail1);

				if($is_send == 1 && $is_send_first_mail == 1)
				{
				    $this->session->set_userdata('succmsg', "Your account is created successfully. A verification link has been sent to your email address. Please check your inbox and Spam to activate your account.");
					redirect(FRONTEND_URL.'sign_up');
					exit;
				}
				else
				{
				    if($id != '')
				    {
						$where = "id = '".$id."'";
						$this->model_basic->deleteData(STUDENT, $where);
				    }
				    $this->session->set_userdata('errmsg', "Sign up can't be completed. Please Sign up with your correct email id.");
				    redirect(FRONTEND_URL.'sign_up');
					exit;
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

				    $this->session->set_userdata('errmsg', "Wrong username or password");
				    redirect(FRONTEND_URL."login");
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
		// echo $this->input->post('email');

		// echo $this->input->post('password');
		// die;
	
	    if($this->input->post('action')=='process')
	    {
		//pr($_POST);
		
		    $this->form_validation->set_rules('email', 'Email', 'trim|required');
		    $this->form_validation->set_rules('password', 'Password', 'trim|required');	    
		    
		    if($this->form_validation->run() == TRUE)
		    {
				$email 		= addslashes(trim($this->input->post('email')));
				$password 	= addslashes(trim($this->input->post('password')));
				
				$loginlValue= $this->model_basic->getValues_conditions('ep_student',array('id','firstname','lastname','gender'),'','email = "'.$email.'" AND password = "'.$password.'"');
				if($loginlValue){
				
				$nullValue= $this->model_basic->getValues_conditions('ep_student',array('id','firstname','lastname','gender'),'','email = "'.$email.'" AND password = "'.$password.'" AND (unique_slug ="" OR unique_slug is NULL)');
				if($nullValue>0){
				$details	= $this->model_basic->getValues_conditions('ep_student',array('id','firstname','lastname','gender'),'','email = "'.$email.'" AND password = "'.$password.'" AND is_active = "yes"');
				   	
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
					   
					    $this->session->set_userdata('errmsg', "Wrong username or password");
					    redirect(FRONTEND_URL."login");
					}
			  }else{ $this->session->set_userdata('errmsg', "Before login, you must active your account with the link sent to your email account's inbox and spam.");
					    redirect(FRONTEND_URL."login");}
					    
					    
				}else{
					    $this->session->set_userdata('errmsg', "Wrong username or password");
					    redirect(FRONTEND_URL."login");}	    
					    
		    }
		    
		     $this->session->set_userdata('errmsg', "Please Enter Your Username or Password");
					    redirect(FRONTEND_URL."login");
		//$this->data	=	array();
		//$this->data['errmsg'] = $this->session->userdata('errmsg');				
		//$this->session->set_userdata('errmsg', "");
		//$this->templatelayout->header();
		//$this->templatelayout->footer();
		//$this->elements['middle']='home/sign_up/student';
		//$this->elements_data['middle'] = $this->data;			    
		//$this->layout->setLayout('layout');
		//$this->layout->multiple_view($this->elements,$this->elements_data);
		   
		}
		
		
    }
    
    public function logout()
    {
		$this->session->set_userdata('student_id','');
		$this->session->set_userdata('student_name','');
		redirect(FRONTEND_URL);
		exit;
    }
    public function forgotpassword()
	{
		$this->data = '';
		
		$this->data['msg'] = $this->session->userdata('msg');
		$this->session->set_userdata('msg', '');
		
		if($this->session->userdata('USER_ID') != '')
		{
			$url = BACKEND_URL."login/";
			redirect($url);
		}
		
		$this->data	=	array();
		$this->data['errmsg'] = $this->session->userdata('errmsg');				
		$this->session->set_userdata('errmsg', "");
		$this->templatelayout->header();
		$this->templatelayout->footer();
		$this->elements['middle']='home/forgotpassword';
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
		
	}

	 public function do_forgotpassword()
        {
            $this->load->library('email');
   	    $email = $this->input->get_post('student_email');
            
            if(isset($email) && !empty($email))
	    {
		$arrUser 	= $this->model_administrator->getUserByEmail($email);			
	    
		if(count($arrUser) > 0){	
		    
		    $first_name = $arrUser[0]['firstname'];
		    $last_name 	= $arrUser[0]['lastname'];	
		    $password 	= $arrUser[0]['password'];					
		    $settings 	= $this->model_administrator->get_settings('1,6,9');
		    $noreplyext = "IMPORTANT: Please do not reply to this message or mail as this is an automated mail service.For any queries, please write us on info@marinelookout.com";
					
		    //pr($settings);
		    //$ConfigMail['mailtype'] 	= 'html';
		    $ConfigMail['to'] 		= $arrUser[0]['email'];
		    $ConfigMail['from']		= $settings['webmaster_email'];
		    $ConfigMail['from_name']	= $settings['sitename'];
		    $ConfigMail['subject']	= "Password Recovery at ".$settings['sitename'];
		    $ConfigMail['message'] = '<html><body>';
		    $ConfigMail['message'].= 'Hello '.$first_name.' '.$last_name;
		    $ConfigMail['message'].= '</br>';
		    $ConfigMail['message'].= '<p> Please note down your password for user login : '.$password.'</p>';
		    $ConfigMail['message'].= '</br>';
		    $ConfigMail['message'].= '<p>Thanks, </p>';
		    $ConfigMail['message'].= '</br>';
		    $ConfigMail['message'].= '<p>Team: '.$settings['sitename'].'</p>';
		    $ConfigMail['message'].= '</br>';
		    $ConfigMail['message'].= '<a href="'.FRONTEND_URL.'">'.FRONTEND_URL.'</a>';
		    $ConfigMail['message'].= '</br>';
		    $ConfigMail['message'].= '</br>';
		    $ConfigMail['message'].= '<p>------------------------------------------------------</p>';
		    $ConfigMail['message'].= '</br>';
		    $ConfigMail['message'].= '<p>'.$noreplyext.'</p>';
		    $ConfigMail['message'].= '</body></html>';
				  
		    $mail 		= send_email($ConfigMail);
		    
		    if($mail)	
		    {	
			//$msg = 'Password sent to your mail address. Please check.';
			$this->session->set_userdata('succmsg', "Password sent to your mail address. Please check your inbox and Spam  ");
			redirect(FRONTEND_URL.'sign_up');
		exit;
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
	
	
	function check_email_availablity()
	{		
		$get_result = $this->model_common->check_email_availablity();
		
		if(!$get_result ){
		echo '<span style="color:#f00">This email address is already in use please go with option </span>';?><a href="<?php echo FRONTEND_URL.'home/forgotpassword';?>">forgot password</a>
		<?php 
		}else{
		echo '<span style="color:#0c0">Email address is available.</span>';}
	}
	
//    public function copyUser()
//    {
//	$student_list = $this->model_basic->getValues_conditions('ep_student');
//	if(is_array($student_list) && COUNT($student_list)>0)
//	{
//	    foreach($student_list as $v)
//	    {
//		$Insertarray = array(
//					'user_login'   =>  $v['email'],
//					'user_pass'    =>  md5($v['password']),
//					'user_nicename'=>  $v['firstname'].' '.$v['lastname'],
//					'user_email'   =>  $v['email'],
//					'user_status'  =>  0
//				    );
//		$id = $this->model_basic->insertIntoTable('epwp_users',$Insertarray);
//
//		$Insertarray = array(
//					'umeta_id'   	=>  NULL,
//					'user_id'    	=>  $id,
//					'meta_key'	=>  'wp_capabilities',
//					'meta_value'   	=>  'a:1:{s:7:"student";s:1:"1";}'
//				    );
//		$id = $this->model_basic->insertIntoTable('epwp_usermeta',$Insertarray);
//		
//		$Insertarray = array(
//					'umeta_id'   	=>  NULL,
//					'user_id'    	=>  $id,
//					'meta_key'	=>  'wp_capabilities',
//					'meta_value'   	=>  '12'
//				    );
//		$id = $this->model_basic->insertIntoTable('epwp_usermeta',$Insertarray);
//	    }
//	}
//	//pr($student_list);
//	echo 'Done';exit;
//    }
}
?>