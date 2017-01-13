<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/*
---------------------------------
STUDENT CONTROLLER
---------------------------------
*/

class Studentuser extends MY_Controller {

	public function __construct()
	{
		parent::__construct();		
		$this->load->model(array('model_common','model_student'));
		$this->load->helper("file");
	}
	
	// LIST STUDENT USER
	
	public function index()
	{ 
		$this->chk_login();
		$data = array();
		$data['student_all'] 	= array();
		$data['pagination'] 	= array();
		$data['search_keyword'] = "";
		$data['per_page']       = PER_PAGE_LISTING;
		$start                  = 0;
		$data['startRecord']    = $start;
		$data['page']           = $this->uri->segment(3);
		$data['search_keyword'] = "";
		$data['params']  	= $this->nsession->userdata('STUDENT_SEARCH');
		//pr($_POST);
		if($this->input->get_post('is_show_all') == 1)
		{
		    $this->nsession->set_userdata('STUDENT_SEARCH','');
		    $data['search_keyword'] 	= '';
		    $data['per_page'] 		= $data['per_page'];
		}
		elseif(trim($this->input->get_post('search_keyword')) == '' && trim($this->input->get_post('per_page')) == '' && $this->nsession->userdata('STUDENT_SEARCH') == '' )
		{
		    $data['search_keyword'] 	= $data['search_keyword'];
		    $data['per_page'] 		= $data['per_page'];
		}
		else 
		{
		    if($this->input->get_post('search_keyword',true) != '')
				$data['search_keyword']   = trim($this->input->get_post('search_keyword',true));
			else	
				$data['search_keyword']   = $this->nsession->userdata('STUDENT_SEARCH');
				
			$data['per_page']         = $this->input->get_post('per_page',true);   
		}
        
		
		/*
		-------------------------------------
		BEGIN :: PAGINATION
		-------------------------------------
		*/
		
		$total_student	= $this->model_student->countStudentDB($data['search_keyword']);
		$data['totalRecord'] = $total_student;
		
        if($total_student > 0) {            
			$config['base_url'] 	= base_url().'/studentuser/index';
            $config['per_page'] 	= PER_PAGE_LISTING;
            $config['total_rows']	= $total_student;
			
            if($this->uri->segment(3))
			{
                $config['uri_segment'] = 3;
				
                if(!is_numeric($this->uri->segment(3)))
				{
                    $offset = 0;
                }
				else
				{
                    $offset = abs(ceil($this->uri->segment(3)));
                }
            }
			else
			{
                $offset = 0;
            }
			
            $search_by = '';
            $resultArr = $this->model_student->allStudentDB($data['search_keyword'], PER_PAGE_LISTING, $offset);
            //pr($resultArr);

            if(count($resultArr) > 0)
			{
                $num = 1+$offset;
				foreach($resultArr as $values)
				{
					$subjectId      = $values['id'];
					$subjectStatus	= $values['is_active'];
					$status_class	= ($subjectStatus == 'Yes') ? 'label-green' : 'label-red';    
					
					// GET GENERATE EDIT AND DELETE LINK
					
					$this->uri_segment  = $this->uri->total_segments();
					$cur_page           = 0;
					
					if ($this->uri->segment($this->uri_segment) != 0) {
						$this->cur_page = $this->uri->segment($this->uri_segment);
						$cur_page 		= (int) $this->cur_page;
					}
					
					$edit_link    		= base_url()."studentuser/edit/".$subjectId."/".$cur_page."/";
					$delete_link  		= base_url()."studentuser/delete/".$subjectId."/".$cur_page."/";
					
					if($num%2==0)
					{
						$class = 'class="even"';
					}
					else
					{
						$class = 'class="odd"';
					}
					$total_result[] = array_merge($values,
								array(
									'slno'              => $num,
									'class'             => $class,
									'status_class'      => $status_class,
									'edit_link'         => $edit_link,
									'delete_link'       => $delete_link
									)
						);
					$num++;

                }

                $data['student_all'] = $total_result;
                //pr($data['subject_all']);
				
                
                $config['cur_tag_open']     = '<span class="current-link">';
                $config['cur_tag_close']    = '</span>';
		$this->pagination->setCustomAdminPaginationStyle($config);
                $this->pagination->initialize($config);
                $data['pagination']         = $this->pagination->create_links();
			}
        }
		
		/*
		-------------------------------------
		END :: PAGINATION
		-------------------------------------
		*/
		
		$data['succmsg'] = $this->nsession->userdata('succmsg');
		$this->nsession->set_userdata('succmsg','');
		$data['errmsg'] = $this->nsession->userdata('errmsg');
		$this->nsession->set_userdata('errmsg','');
		$this->templatelayout->get_topbar();
		$this->templatelayout->get_leftmenu();
		$this->templatelayout->get_footer();
		$this->elements['middle']='userstudent/list';
		$this->elements_data['middle'] = $data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);

	}


	// ADD STUDENT USER
	
	public function add()
	{		
		$this->chk_login();
		if($this->input->post('action')=='add')
		{
			//pr($_POST);
	        //$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
	        $this->form_validation->set_rules('firstname', 'Firstname', 'trim|required');
	        $this->form_validation->set_rules('lastname', 'Lastname', 'trim|required');
	        $this->form_validation->set_rules('email', 'Email Address', 'trim|required|is_unique[ep_student.email]');
	        //$this->form_validation->set_message('email', 'Email address already exists!');
	        $this->form_validation->set_rules('password', 'Password', 'trim|required|matches[conf_password]');
	        $this->form_validation->set_rules('conf_password', 'Confirm Password', 'trim|required');
	        /*$this->form_validation->set_rules('role', 'Role', 'trim|required');*/
	        $this->form_validation->set_rules('view_exam_details', 'View Exam Detais', 'trim|required');
	        $this->form_validation->set_rules('status', 'Status', 'trim|required');

	  		// Fetch max value
	  		// $fieldname = 'role_id';
			// $regionListArray = $this->model_region->fetch_max(USER,$fieldname);
			// $maxValue = $regionListArray[0]['region_order'];

			// Change the line below to your timezone!
			date_default_timezone_set('Asia/Kolkata');
			//$date = date('Y-m-d H:i:s', time());


	        // Form validation
			$upload_config['field_name']		= 'userfile';
			$upload_config['file_upload_path'] 	= 'student/';
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


			if(isset($sUploaded) && count($sUploaded)>0)
			{
			

				if ($this->form_validation->run() == TRUE)
				{    
					// STORE POST DATA IN FOLLOWING VARIABLES
					
					
					$data = array();
		
					$data = array(
								
								'firstname'			=>	addslashes(trim(ucwords($this->input->post('firstname')))),
								'lastname'			=>	addslashes(trim(ucwords($this->input->post('lastname')))),
								'email'				=>	addslashes(trim($this->input->post('email'))),
								'password'			=>	trim($this->input->post('password')),
								'mobile'			=>	addslashes(trim($this->input->post('mobile'))),
								'added_on'			=> 	date('Y-m-d H:i:s', time()),
								'view_exam_details'		=>	$this->input->post('view_exam_details'),
								'pre_sea_Institute'		=>	$this->input->post('pre_sea_Institute'),
								'applying_mmd'			=>	$this->input->post('applying_mmd'),
								'is_active'			=>	$this->input->post('status'),
								'image'				=>  	$sUploaded
							);
					
	
					// SEND POST DATA ($data)
					
					$insert_new_user = $this->model_common->insert_user(STUDENT,$data);
					//echo $insert_new_user;
					
					if($insert_new_user>0)
					{ 	
						$this->nsession->set_userdata('succmsg', 'Student added successfully');
						redirect("studentuser/index");
					}
				}	        
			}
		}
		$data = '';
		$this->templatelayout->get_topbar();
	    $this->templatelayout->get_leftmenu();
	    $this->templatelayout->get_footer();
	    $this->elements['middle']='userstudent/add';
	    $this->elements_data['middle'] = $data;			    
	    $this->layout->setLayout('layout');
	    $this->layout->multiple_view($this->elements,$this->elements_data);
	}

  
	// DELETE STUDENT USER
	public function delete()
	{	
		$this->chk_login();
		// URI Operation
		$id = $this->uri->segment(3);

		// POST Operation
		//$id = $this->input->post('id');

		// Retrieve image name to remove from folder
  		$findArray = array('id'=>$id);
		$executeQuery = $this->model_common->fetch_data(STUDENT,$findArray);
		$imageNameToRemove = $executeQuery[0]['image'];
		//unlink(FILE_UPLOAD_ABSOLUTE_PATH."student/".$imageNameToRemove);
		
		$fieldname = 'id';
		$deleteRecord = $this->model_common->delete_user(STUDENT, $fieldname, $id);

		if($deleteRecord==1 && $imageNameToRemove!= '' && $imageNameToRemove != 0)	
			unlink(FILE_UPLOAD_ABSOLUTE_PATH."student/".$imageNameToRemove);

		$this->nsession->set_userdata('succmsg', 'Student deleted successfully');
		redirect('studentuser/index');
	}


	// UPDATE STUDENT USER
	public function edit()
	{
		$this->chk_login();
		//pr($_POST);
		//exit;
        
        $id		= '';
        $id = $this->uri->segment(3);
		$idArray = array('id'=>$id);
		$this->data['studentList'] = array();
		$userListArray = $this->model_common->fetch_data(STUDENT,$idArray);
		//pr($userListArray);
		if(!empty($userListArray))
		{		
			$this->data['studentList'] = $userListArray;	
		}

		if($this->input->post('action')=='edit')
		{
			//$img = $_POST['updateImg'];
			//$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
	        $this->form_validation->set_rules('firstname', 'Firstname', 'trim|required');
	        $this->form_validation->set_rules('lastname', 'Lastname', 'trim|required');
	        $this->form_validation->set_rules('email', 'Email Address', 'trim|required|callback_is_email_exists');
	        $this->form_validation->set_rules('password', 'Password', 'trim|required|matches[conf_password]');
	        $this->form_validation->set_rules('conf_password', 'Confirm Password', 'trim|required');	        
	        $this->form_validation->set_rules('mobile', 'Mobile', 'trim|required');
	        $this->form_validation->set_rules('view_exam_details', 'View Exam Details', 'required');
	        $this->form_validation->set_rules('status', 'Status', 'trim|required');
	        //echo $this->form_validation->run();exit;

		    if ($this->form_validation->run() == TRUE)
		    {
				if(is_array($_FILES) && COUNT($_FILES)>0)
				{
					$upload_config['field_name']			= 'userfile';
					$upload_config['file_upload_path'] 		= 'student/';
					$upload_config['max_size']				= '';
					$upload_config['max_width']				= '';
					$upload_config['max_height']			= '';
					$upload_config['allowed_types']			= 'jpg|jpeg|gif|png';
					
					$thumb_config['thumb_create']			= false;
					$thumb_config['thumb_file_upload_path']	= 'thumb/';
					$thumb_config['thumb_marker']			= '';
					$thumb_config['thumb_width']			= '304';
					$thumb_config['thumb_height']			= '138';			
					$sUploaded = image_upload($upload_config, $thumb_config);
				}
				
				if($sUploaded != '')
				{
					$oldImg = $userListArray[0]['image'];
                 	unlink (FILE_UPLOAD_ABSOLUTE_PATH."student/".$oldImg);
					$data = array(
						
								'image'			=> 	$sUploaded,
								'firstname'		=>	addslashes(trim(ucwords($this->input->post('firstname')))),
								'lastname'		=>	addslashes(trim(ucwords($this->input->post('lastname')))),
								'email'			=>	addslashes(trim($this->input->post('email'))),
								'password'		=>	trim($this->input->post('password')),
								'mobile'		=>	addslashes(trim($this->input->post('mobile'))),
								'wallet'		=> 	trim($this->input->post('wallet')),
								'view_exam_details'	=>	$this->input->post('view_exam_details'),
								'pre_sea_Institute'	=>	$this->input->post('pre_sea_Institute'),
								'applying_mmd'		=>	$this->input->post('applying_mmd'),
								'is_active'		=>	$this->input->post('status')
							);
				
				}
				else
				{	
					$data = array(
							'firstname'		=> addslashes(trim(ucwords($this->input->post('firstname')))),
							'lastname'		=> addslashes(trim(ucwords($this->input->post('lastname')))),
							'email'			=> addslashes(trim($this->input->post('email'))),
							'password'		=> trim($this->input->post('password')),
							'mobile'		=> addslashes(trim($this->input->post('mobile'))),
							'wallet'		=> trim($this->input->post('wallet')),
							'view_exam_details'	=> $this->input->post('view_exam_details'),
							'pre_sea_Institute'	=> $this->input->post('pre_sea_Institute'),
							'applying_mmd'		=> $this->input->post('applying_mmd'),
							'is_active'		=> $this->input->post('status')
						);
				}
			        	
				$fieldname 	= 'id';
				$updatedRecord = $this->model_common->update_user(STUDENT, $data, $fieldname, $id);
				//echo $updatedRecord;
				//exit;
				
				if($updatedRecord != 0)
				{
					$this->nsession->set_userdata('succmsg', 'Student information updated successfully');
					redirect("studentuser/index");
					exit;
				}				
			}
		}	
	    $this->templatelayout->get_topbar();
	    $this->templatelayout->get_leftmenu();
	    $this->templatelayout->get_footer();
	    $this->elements['middle']='userstudent/edit';
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