<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/*
---------------------------------
STUDENT CONTROLLER
---------------------------------
*/

class Testimonial extends MY_Controller {

	public function __construct()
	{
		parent::__construct();		
		$this->load->model(array('model_basic','model_testimonial'));
		$this->load->helper("file");
	}
	
	// LIST STUDENT USER
	
	public function index()
	{ 
		$this->chk_login();
		$data = array();
		$data['testimonial_all'] 	= array();
		$data['pagination'] 	= array();
		$data['search_keyword'] = "";
		$data['per_page']       = PER_PAGE_LISTING;
		$start                  = 0;
		$data['startRecord']    = $start;
		$data['page']           = $this->uri->segment(3);
		$data['search_keyword'] = "";
		$data['params']  	= $this->nsession->userdata('TESTIMONIAL_SEARCH');
		//pr($_POST);
		if($this->input->get_post('is_show_all') == 1)
		{
		    $this->nsession->set_userdata('TESTIMONIAL_SEARCH','');
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
				$data['search_keyword']   = $this->nsession->userdata('TESTIMONIAL_SEARCH');
				
			$data['per_page']         = $this->input->get_post('per_page',true);   
		}
        
		
		/*
		-------------------------------------
		BEGIN :: PAGINATION
		-------------------------------------
		*/
		
		$total_testimonial	= $this->model_testimonial->countTestimonialDB($data['search_keyword']);
		$data['totalRecord'] = $total_testimonial;
		
        if($total_testimonial > 0) {            
			$config['base_url'] 	= base_url().'/testimonial/index';
            $config['per_page'] 	= PER_PAGE_LISTING;
            $config['total_rows']	= $total_testimonial;
			
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
            $resultArr = $this->model_testimonial->allTestimonialDB($data['search_keyword'], PER_PAGE_LISTING, $offset);
            //pr($resultArr);

            if(count($resultArr) > 0)
			{
                $num = 1+$offset;
				foreach($resultArr as $values)
				{
					$id      	= $values['id'];
					$status		= $values['status'];
					$status_class	= ($status == 'Yes') ? 'label-green' : 'label-red';    
					
					// GET GENERATE EDIT AND DELETE LINK
					
					$this->uri_segment  = $this->uri->total_segments();
					$cur_page           = 0;
					
					if ($this->uri->segment($this->uri_segment) != 0) {
						$this->cur_page = $this->uri->segment($this->uri_segment);
						$cur_page 		= (int) $this->cur_page;
					}
					
					$edit_link    		= base_url()."testimonial/edit/".$id."/".$cur_page."/";
					$delete_link  		= base_url()."testimonial/delete/".$id."/".$cur_page."/";
					
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

                $data['testimonial_all'] = $total_result;
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
		$this->elements['middle']='testimonial/list';
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
	        $this->form_validation->set_rules('name', 'Name', 'trim|required');
	        $this->form_validation->set_rules('comment', 'Comment', 'trim|required');
		date_default_timezone_set('Asia/Kolkata');


	        // Form validation
			$upload_config['field_name']		= 'image';
			$upload_config['file_upload_path'] 	= 'testimonial/';
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
		
				$data = array(
						
						'name'		=>	addslashes(trim($this->input->post('name'))),
						'comment'	=>	addslashes(trim(ucwords($this->input->post('comment')))),
						'image'		=>  	$sUploaded,
						'created_at'	=> 	date('Y-m-d H:s:i')
					);
					
				$insert_new_user = $this->model_basic->insertIntoTable('ep_testimonials',$data);
					//echo $insert_new_user;
					
					if($insert_new_user>0)
					{ 	
						$this->nsession->set_userdata('succmsg', 'testimonial added successfully');
						redirect("testimonial/index");
					}
				}	        
			}
		}
		$data = '';
		$this->templatelayout->get_topbar();
	    $this->templatelayout->get_leftmenu();
	    $this->templatelayout->get_footer();
	    $this->elements['middle']='testimonial/add';
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
		$executeQuery 		= $this->model_basic->getValues_conditions('ep_testimonials','','',"id='".$id."'");
		$imageNameToRemove 	= $executeQuery[0]['image'];
		
		$fieldname 		= 'id';
		$deleteRecord 		= $this->model_basic->deleteData('ep_testimonials', "id='".$id."'");

		if($deleteRecord==1 && $imageNameToRemove!= '' && $imageNameToRemove != 0){	
		if(file_exists(FILE_UPLOAD_ABSOLUTE_PATH."testimonial/".$imageNameToRemove) && $imageNameToRemove != ''){
		unlink (FILE_UPLOAD_ABSOLUTE_PATH."testimonial/".$imageNameToRemove);
		}
		if(file_exists(FILE_UPLOAD_ABSOLUTE_PATH."testimonial/thumb/".$imageNameToRemove) && $imageNameToRemove != ''){
		unlink (FILE_UPLOAD_ABSOLUTE_PATH."testimonial/thumb/".$imageNameToRemove);
		}
		}
		$this->nsession->set_userdata('succmsg', 'Testimonial deleted successfully');
		redirect('testimonial/index');
	}


	// UPDATE STUDENT USER
	public function edit()
	{
		$this->chk_login();
		$id 				= $this->uri->segment(3);
		$idArray 			= array('id'=>$id);
		$this->data['testimonialList'] 	= array();
		$testimonialListArray 		= $this->model_basic->getValues_conditions('ep_testimonials','','',"id='".$id."'");
		//pr($userListArray);
		if(!empty($testimonialListArray))
		{		
			$this->data['testimonialList'] = $testimonialListArray;	
		}
		if($this->input->post('action')=='edit')
		{	
			$this->form_validation->set_rules('name', 'Name', 'trim|required');
			$this->form_validation->set_rules('comment', 'Comment', 'trim|required');

			if ($this->form_validation->run() == TRUE)
			{
				if(is_array($_FILES) && COUNT($_FILES)>0)
				{
					$upload_config['field_name']			= 'image';
					$upload_config['file_upload_path'] 		= 'testimonial/';
					$upload_config['max_size']			= '';
					$upload_config['max_width']			= '';
					$upload_config['max_height']			= '';
					$upload_config['allowed_types']			= 'jpg|jpeg|gif|png';
					
					$thumb_config['thumb_create']			= false;
					$thumb_config['thumb_file_upload_path']		= 'thumb/';
					$thumb_config['thumb_marker']			= '';
					$thumb_config['thumb_width']			= '304';
					$thumb_config['thumb_height']			= '138';			
					$sUploaded = image_upload($upload_config, $thumb_config);
				}	
				if($sUploaded != '')
				{
					$oldImg = $testimonialListArray[0]['image'];
					if(file_exists(FILE_UPLOAD_ABSOLUTE_PATH."testimonial/".$oldImg) && $oldImg != ''){
					unlink (FILE_UPLOAD_ABSOLUTE_PATH."testimonial/".$oldImg);
					}
					if(file_exists(FILE_UPLOAD_ABSOLUTE_PATH."testimonial/thumb/".$oldImg) && $oldImg != ''){
					unlink (FILE_UPLOAD_ABSOLUTE_PATH."testimonial/thumb/".$oldImg);
					}
					$data = array(
						
						'name'		=>	addslashes(trim($this->input->post('name'))),
						'comment'	=>	addslashes(trim(ucwords($this->input->post('comment')))),
						'image'		=>  	$sUploaded,
						'status'	=> 	$this->input->post('status')
					);
				
				}
				else
				{	
					$data = array(
						
						'name'		=>	addslashes(trim($this->input->post('name'))),
						'comment'	=>	addslashes(trim(ucwords($this->input->post('comment')))),
						'status'	=> 	$this->input->post('status')
					);
				}	
				$updatedRecord = $this->model_basic->updateIntoTable('ep_testimonials', array('id'=>$id),$data);
				
				//if($updatedRecord){
				
					$this->nsession->set_userdata('succmsg', 'Testimonial information updated successfully');
					redirect("testimonial/index");
					exit;
				//}				
			}
		}	
	    $this->templatelayout->get_topbar();
	    $this->templatelayout->get_leftmenu();
	    $this->templatelayout->get_footer();
	    $this->elements['middle']='testimonial/edit';
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