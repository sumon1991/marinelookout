<?php
class My_account extends MY_Controller {

    public function __construct(){
        parent:: __construct();
		$this->load->model(array('model_examination','model_common', 'model_basic', 'model_blog_with_category'));
    }
    
    public function index()
    {
    	$this->chk_login();
	$slug		= $this->uri->segment(2);
	$id 		= $this->uri->segment(3);
	$student_id	= $this->session->userdata('student_id');
	
	$wallet = $this->model_basic->getValues_conditions('ep_student','','','id = "'.$student_id.'"');
	
	 $wallet_balance = $wallet[0]['wallet'];
	 $this->session->set_userdata('wallet_balance', $wallet_balance);
	//$student_id	= $this->session->userdata('student_id');
	$this->data = '';

	if($slug == 'result')
	{	    
	    $this->data['question_list'] 	= $this->model_examination->get_exam_list();	    
	    $this->elements['middle']		= 'student/exam_list';	    
	}
	else if($slug == 'sample_question_ans'){
		$this->data['slug'] = 'question_and_ans';
		$subjects  = $this->model_basic->getValues_conditions('ep_subject','','','is_active = "yes"');
		$this->data['subject_lists'] = array();
		if(is_array($subjects) and count($subjects)>0){
			foreach($subjects as $s){
				$this->data['subject_lists'][$s['subject_slug']] =$s;
			}	
		}
		$this->data['question_ans'] = array();
		if($this->input->get('s') !=''){
			$subject_slug = $this->input->get('s');
			$subject_details = $this->data['subject_lists'][$subject_slug];
			if(is_array($subject_details)){
			    $subject_id = $subject_details['id'];
				$questions = $this->model_basic->getValues_conditions('ep_sample_questions','','','subject_id="'.$subject_id.'" and is_active = "yes"');
				//pr($questions);
				if(is_array($questions) and count($questions) >0 ){
					foreach( $questions as $q){
						$q['answers'] =  $this->model_basic->getValues_conditions('ep_sample_answer','','','question_id="'.$q['id'].'" and is_active = "yes"');
						$this->data['question_ans'][] = $q;
					}
				}
			}
		}
		//pr($this->data['question_ans']);
		$this->elements['middle']		= 'student/sample_question_ans';	
	}
	else if($slug == 'sample_question'){
		$this->data['slug'] = 'question';
		$subjects  = $this->model_basic->getValues_conditions('ep_subject','','','is_active = "yes"');
		$this->data['subject_lists'] = array();
		if(is_array($subjects) and count($subjects)>0){
			foreach($subjects as $s){
				$this->data['subject_lists'][$s['subject_slug']] =$s;
			}	
		}
		$this->elements['middle']		= 'student/sample_question_ans';
		
		$this->data['question_ans'] = array();
		if($this->input->get('s') !=''){
			$subject_slug = $this->input->get('s');
			$subject_details = $this->data['subject_lists'][$subject_slug];
			if(is_array($subject_details)){
				$subject_id = $subject_details['id'];
				$questions = $this->model_basic->getValues_conditions('ep_sample_questions','','','subject_id="'.$subject_id.'" and is_active = "yes"');
				
				if(is_array($questions) and count($questions) >0 ){
					$this->data['question_ans'] = $questions;
				}
			}
		}
	}
	else if($slug == 'payment_history')
	{
	    $this->data['payment_history'] 	= $this->model_basic->getValues_conditions('ep_payment','','','student_id = "'.$student_id.'"','paid_on','DESC');    
	    $this->elements['middle']		= 'student/payment_history';
	}
	else if($slug == 'profile')
	{
	    $this->data['profile_details'] 	= $this->model_basic->getValues_conditions('ep_student','','','id = "'.$student_id.'"');    
	    $this->elements['middle']		= 'student/profile_edit';
	}
	else if($slug == 'welcome')
	{	    
	    $this->elements['middle']		= 'student/welcome';
	}
	else if($slug == 'test')
	{
	    $this->data['errmsg'] 		= $this->session->userdata('errmsg');
	    $balance				= $this->model_basic->getValue_condition('ep_student','wallet','','id = "'.$student_id.'"');
	    if($balance < 10)
		$this->data['errmsg'] 		= "You Don't Have Enough Balance To Give Exam";
	    else
		$this->data['test_list'] 	= $this->model_examination->get_subject();
		
	    $this->elements['middle']		= 'student/select_test';
	}
	else if($slug == 'notification')
	{		
	    //$id    = $this->session->userdata('student_id');
	    $this->data['notification_list']= $this->model_common->getNotificationList($student_id);
	    //pr($this->data['notification_list']);	    
	    $this->elements['middle']		= 'student/notification';
	}
	else if($slug == 'update_profile')
	{
	    if($this->input->post('action') =='edit_profile')
	    {
		$this->form_validation->set_rules('firstname', 'Firstname', 'trim|required');
		$this->form_validation->set_rules('lastname', 'Lastname', 'trim|required');
		$this->form_validation->set_rules('email', 'Email Address', 'trim|required|callback_is_email_exists');        
		// $this->form_validation->set_rules('password', 'Password', 'trim|required|matches[conf_password]');
		// $this->form_validation->set_rules('conf_password', 'Confirm Password', 'trim|required');
		$this->form_validation->set_rules('mobile', 'Mobile', 'trim|required');
		$this->form_validation->set_rules('terms', 'Terms', 'required');	        
		

		//$this->form_validation->set_rules('datepicker', 'Date of Birth', 'required');
		//$this->form_validation->set_rules('applying_mmd', 'Applying_mmd', 'trim|required');
		//$this->form_validation->set_rules('pre_sea_Institute', 'Pre_sea_Institute', 'trim|required');
		
			if($this->form_validation->run() == TRUE)
			{
			    //echo "ss";exit;
			    if(is_array($_FILES) && COUNT($_FILES)>0)
			    {
				    $upload_config['field_name']		= 'userfile';
				    $upload_config['file_upload_path'] 		= 'student/';
				    $upload_config['max_size']			= '';
				    $upload_config['max_width']			= '';
				    $upload_config['max_height']		= '';
				    $upload_config['allowed_types']		= 'jpg|jpeg|gif|png';
				    
				    $thumb_config['thumb_create']		= false;
				    $thumb_config['thumb_file_upload_path']	= 'thumb/';
				    $thumb_config['thumb_marker']		= '';
				    $thumb_config['thumb_width']		= '304';
				    $thumb_config['thumb_height']		= '138';			
				    $sUploaded = image_upload($upload_config, $thumb_config);
				    if($sUploaded != '')
					$this->session->set_userdata('errmsg', 'Unable to upload the picture...');
			    }	
	    
			   
			    $terms  = $this->input->post('terms')=='on'?'yes':'no';
			    if($sUploaded != '')
			    {
				    //$oldImg = $userListArray[0]['image'];
				    //@unlink (FILE_UPLOAD_ABSOLUTE_PATH."student/".$oldImg);
				    $data = array(
					    
							    'image'		=> 	$sUploaded,
							    'firstname'		=>	addslashes(trim(ucwords($this->input->post('firstname')))),
							    'lastname'		=>	addslashes(trim(ucwords($this->input->post('lastname')))),
							    'email'		=>	addslashes(trim($this->input->post('email'))),
							    'password'		=>	trim($this->input->post('password')),
							    'pre_sea_Institute'	=>	trim($this->input->post('pre_sea_Institute')),
							    'applying_mmd'	=>	trim($this->input->post('applying_mmd')),
							    'mobile'		=>	addslashes(trim($this->input->post('mobile'))),
							    'is_active'		=>	$terms
						    );
					
			    }
			    else
			    {	
				    $data = array(
						    'firstname'		=>	addslashes(trim(ucwords($this->input->post('firstname')))),
						    'lastname'		=>	addslashes(trim(ucwords($this->input->post('lastname')))),
						    'email'		=>	addslashes(trim($this->input->post('email'))),
						    'password'		=>	trim($this->input->post('password')),
						    'pre_sea_Institute'	=>	trim($this->input->post('pre_sea_Institute')),
						    'applying_mmd'	=>	trim($this->input->post('applying_mmd')),
						    'mobile'		=>	addslashes(trim($this->input->post('mobile'))),
						    'is_active'		=>	$terms
					    );
			    }
			   
			    //pr($this->session->all_userdata());
			    $fieldname 	= 'id';
			    $updatedRecord = $this->model_common->update_user(STUDENT, $data, $fieldname, $id);
			    $idArr 	= 	array(
					   'user_login' => trim($this->input->post('email'))
					   );
			    $updateArr 	= array(
					   'user_pass' => md5(trim($this->input->post('password')))
					   );
			    $this->model_basic->updateIntoTable('epwp_users', $idArr, $updateArr);			    
			    
			    //echo $updatedRecord;
			    //exit;
			    
			    if($updatedRecord !=0)
			    {
					$this->session->set_userdata('errmsg','');
				    $this->session->set_userdata('succmsg', 'Student information updated successfully');
				    redirect(FRONTEND_URL."my_account/profile/");
				    exit;
			    }
				$this->session->set_userdata('errmsg','');
			    redirect(FRONTEND_URL."my_account/profile/");
				exit;
			}			
			else
			{ 
				$this->session->set_userdata('errmsg', validation_errors('<p>', '</p>'));
				//echo "CI Validation Failed";exit();
			    redirect(FRONTEND_URL."my_account/profile/");
			    exit;
			}
	    }
	    else
	    {
			//echo "Invalid Post action";exit();
			$this->session->set_userdata('errmsg','');
			redirect(FRONTEND_URL."my_account/profile/");
			exit;
	    }
	}
	$data['succmsg'] = $this->session->userdata('succmsg');
	$this->session->set_userdata('succmsg','');
	$data['errmsg'] = $this->session->userdata('errmsg');
	$this->session->set_userdata('errmsg','');
	$this->templatelayout->header();
	$this->templatelayout->footer();
	$this->elements_data['middle'] = $this->data;
	$this->layout->setLayout('layout');
	$this->layout->multiple_view($this->elements,$this->elements_data);
    }

	//Calbacks: My Validation function : EMAIL
	function is_email_exists()
    {
		$id 		= $this->uri->segment(3);
		$email		= strip_tags(addslashes(trim($this->input->post('email'))));
		
		$whereArr	= array();
		if($id > 0){
			$whereArr	= array( 'email' => $email,
						 'id != ' => $id						
						);
		}else{			
			$whereArr	= array( 'email' => $email );
		}
		$bool 	= $this->model_common->checkRowExists(STUDENT, $whereArr );	
		if($bool == 0){
			$this->form_validation->set_message('is_email_exists', 'This %s already exists');
			return FALSE;
		}else 	{
				return TRUE;
				}
    }

    //Calbacks: My Validation function : INDOS
	function is_indos_exists()
    {
		$id 		= $this->uri->segment(3);
		$indos		= strip_tags(addslashes(trim($this->input->post('indos'))));
		
		$whereArr	= array();
		if($id > 0){
			$whereArr	= array( 'indos' => $indos,
						 'id != ' => $id						
						);
		}else{			
			$whereArr	= array( 'indos' => $indos );
		}
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