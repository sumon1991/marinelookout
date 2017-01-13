<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Editor extends MY_Controller {

	public function __construct()
	{
	 parent::__construct();		
	 $this->load->model(array('model_common','model_administrator','model_editor'));
	}
	// LIST EDITOR USER
	public function all()
	{       $this->chk_login(); 
		$this->data='';  
		$data['per_page']         = PER_PAGE_LISTING;
		$start                    = 0;
		$data['startRecord']      = $start;
		$data['page']             = $this->uri->segment(3);
		$data['search_keyword']   = "";
		
		if($this->input->get_post('is_show_all') == 1)
		   $this->nsession->set_userdata('EDITOR_SEARCH','');
		$data['params'] = $this->nsession->userdata('EDITOR_SEARCH');
		
        if($this->input->get_post('search_keyword') == '' && $this->input->get_post('per_page') == '' && $this->nsession->userdata('EDITOR_SEARCH')== '')
        {
            
            $data['search_keyword'] 	= $data['search_keyword'];
            $data['per_page'] 		= $data['per_page'];
        }
        else 
        {
            if($this->input->get_post('search_keyword',true) != '')
			$data['search_keyword']   = trim($this->input->get_post('search_keyword',true));
		else	
			$data['search_keyword']   = $this->nsession->userdata('EDITOR_SEARCH');
			
		$data['per_page']         = $this->input->get_post('per_page',true);  
        }
	$total_subject        = $this->model_editor->countEditorDB($data['search_keyword']);
	$data['totalRecord']  = $total_subject;
	
	if($this->uri->segment(3) == '' || $this->uri->segment(3) == 0)
		$start            	= 0;
	else
		$start            	= ($this->uri->segment(3)-2)*PER_PAGE_LISTING;
		
	$data['startRecord']   	= $start;
	$data['to_record']   	= $start+PER_PAGE_LISTING;
        if($total_subject > 0) {
            /********** FOR PAGINATION ***********/
            $config['base_url'] = base_url().'/editor/all';
            $config['per_page'] = PER_PAGE_LISTING;
            $config['total_rows'] = $total_subject;
            if($this->uri->segment(3)) {
                $config['uri_segment'] = 3;
                if(!is_numeric($this->uri->segment(3))) {
                    $offset=0;
                } else {
                    $offset=abs(ceil($this->uri->segment(3)));
                }
            } else {
                $offset=0;
            }
            $search_by ='';
            $resultArr=$this->model_editor->allEditorDB($data['search_keyword'],PER_PAGE_LISTING,$offset);
            //pr($resultArr);

            if(count($resultArr) > 0) {
                $num = 1+$offset;
                    foreach($resultArr as $values) {
                    $subjectId         = $values['id'];
                    $subjectStatus     = $values['is_active'];
                    $status_class=($subjectStatus == 'Yes')?'label-green':'label-red';    
                    
                    /********** GET GENERATE EDIT AND DELETE LINK ***********/
                    $this->uri_segment  = $this->uri->total_segments();
                    $cur_page           = 0;
                    if ($this->uri->segment($this->uri_segment) != 0) {
                        $this->cur_page = $this->uri->segment($this->uri_segment);
                        $cur_page = (int) $this->cur_page;
                    }

                     $edit_link    = base_url()."editor/edit/".$subjectId."/".$cur_page."/";
                     $delete_link  = base_url()."editor/delete/".$subjectId."/".$cur_page."/";
                     $update_link  = base_url()."editor/update/".$subjectId."/".$cur_page."/";
                    if($num%2==0)
                    {
                        $class = 'class="even"';
                    }
                    else
                    {
                        $class = 'class="odd"';
                    }
                    
                    $total_result[]     = array_merge($values,
                                                        array(
                                                            'slno'              => $num,
                                                            'class'             => $class,
                                                            'status_class'      => $status_class,
                                                            'edit_link'         => $edit_link,
                                                            'delete_link'       => $delete_link,
                                                            'update'            => $update_link
                                                            )
                                            );
                    $num++;

                }

                $data['editor_all']        = $total_result;
                //pr($data['editor_all']);
                /********** FOR PAGINATION ***********/
                $config['uri_segment']	= 3;
		$config['num_links'] 	= 5;
		$this->pagination->setCustomAdminPaginationStyle($config);
                $this->pagination->initialize($config);
                $data['pagination']             		= $this->pagination->create_links();
                

						
				}
        
              } 
                $data['succmsg'] = $this->nsession->userdata('succmsg');
                $this->nsession->set_userdata('succmsg','');
                $data['errmsg'] = $this->nsession->userdata('errmsg');
                $this->nsession->set_userdata('errmsg','');
                $this->templatelayout->get_topbar();
                $this->templatelayout->get_leftmenu();
                $this->templatelayout->get_footer();
                $this->elements['middle']='usereditor/list';
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
        $executeQuery = $this->model_common->fetch_data(ADMIN,$findArray);
        $imageNameToRemove = $executeQuery[0]['image'];
        //unlink(FILE_UPLOAD_ABSOLUTE_PATH."student/".$imageNameToRemove);

        $fieldname = 'id';
        $deleteRecord = $this->model_common->delete_user(ADMIN, $fieldname, $id);

        if($deleteRecord==1)
        {   
            @unlink(FILE_UPLOAD_ABSOLUTE_PATH."editor/".$imageNameToRemove);
            $this->nsession->set_userdata('succmsg', 'One Editor deleted successfully');
            redirect('editor/all');
        }   
        
    }

    // ADD EDITOR USER
	public function add()
	{
		$this->chk_login();

		if($this->input->post('action')=='add')
		{	
		    $this->form_validation->set_rules('firstname', 'Firstname', 'trim|required');
		    $this->form_validation->set_rules('lastname', 'Lastname', 'trim|required');
		    $this->form_validation->set_rules('email', 'Email', 'trim|required|is_unique[ep_admin.admin_email]');		   
		    $this->form_validation->set_rules('conf_password', 'Confirm Password', 'trim|required');
		    $this->form_validation->set_rules('password', 'Password', 'trim|required|matches[conf_password]');
		    $this->form_validation->set_rules('menu', 'Menu', 'required');
		    $this->form_validation->set_rules('status', 'Status', 'trim|required');
	
		    // Form validation
		    $upload_config['field_name']            = 'userfile';
		    $upload_config['file_upload_path']      = 'admin/';
		    $upload_config['max_size']              = '';
		    $upload_config['max_width']             = '';
		    $upload_config['max_height']            = '';
		    $upload_config['allowed_types']         = 'jpg|jpeg|gif|png';
		    $thumb_config['thumb_create']           = false;
		    $thumb_config['thumb_file_upload_path'] = 'thumb/';
		    $thumb_config['thumb_marker']           = '';
		    $thumb_config['thumb_width']            = '304';
		    $thumb_config['thumb_height']           = '138';
		    
		    $sUploaded = image_upload($upload_config, $thumb_config);
	
	
		    if(isset($sUploaded) && count($sUploaded)>0){
	
			if ($this->form_validation->run() == TRUE)
			{   
			    
			    $data = array();
	
			    $data = array(	
					'role'          =>  'editor',
					'image'         =>  $sUploaded,
					'first_name'    =>  addslashes(trim(ucwords($this->input->post('firstname')))),
					'last_name'     =>  addslashes(trim(ucwords($this->input->post('lastname')))),
					'admin_email'   =>  addslashes(trim($this->input->post('email'))),
					'password'      =>  trim($this->input->post('password')),
					'added_on'      =>  date('Y-m-d H:i:s', time()),
					'is_active'     =>  $this->input->post('status'),
					'permission'	=>  implode(',',$this->input->post('menu'))
				    );                

			    // SEND POST DATA ($data)
			    
			    $insert_new_user = $this->model_common->insert_user(ADMIN,$data);
			    //echo $insert_new_user;
			   
			    if($insert_new_user>0)
			    {
				//$this->model_editor->insertWPdata(trim($this->input->post('password')),addslashes(trim(ucwords($this->input->post('firstname')))).' '.addslashes(trim(ucwords($this->input->post('lastname')))),addslashes(trim($this->input->post('email'))));
				$this->nsession->set_userdata('succmsg', 'One Editor added successfully');
				redirect("editor/all");
			    }
			}
		    }  
		}
        $this->data = '';
	$this->data['menu_list'] 	= $this->model_basic->getValues_conditions('ep_menu','','','is_active = "yes"');
        $this->templatelayout->get_topbar();
        $this->templatelayout->get_leftmenu();
        $this->templatelayout->get_footer();
        $this->elements['middle']='usereditor/add';
        $this->elements_data['middle'] = $this->data;               
        $this->layout->setLayout('layout');
        $this->layout->multiple_view($this->elements,$this->elements_data);        
    }

 
	// UPDATE EDITOR USER
    public function edit()
    {
	$this->chk_login();
        $id     = '';
        $id = $this->uri->segment(3);
        $idArray = array('id'=>$id);
        $this->data['editoreditdata'] = array();
	$this->data['menu_list'] 	= $this->model_basic->getValues_conditions('ep_menu','','','is_active = "yes"');
        $userListArray = $this->model_basic->getValues_conditions(ADMIN,'','','id ='.$id);
        if(!empty($userListArray))
        {       
            $this->data['editoreditdata'] = $userListArray;    
        }

        if($this->input->post('action')=='edit')
        {
            //$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            $this->form_validation->set_rules('firstname', 'Firstname', 'trim|required');
            $this->form_validation->set_rules('lastname', 'Lastname', 'trim|required');
            $this->form_validation->set_rules('email', 'Email Address', 'trim|required|callback_is_email_exists');        
            $this->form_validation->set_rules('password', 'Password', 'trim|required|matches[conf_password]');
            $this->form_validation->set_rules('conf_password', 'Confirm Password', 'trim|required');           
            $this->form_validation->set_rules('menu', 'Menu', 'required');
            $this->form_validation->set_rules('status', 'Status', 'trim|required');
            //echo $this->form_validation->run();exit;
            if ($this->form_validation->run() == TRUE)
            {   
                if(is_array($_FILES) && count($_FILES)>0)
                {

                    $upload_config['field_name']        = 'userfile';
                    $upload_config['file_upload_path']  = 'admin/';
                    $upload_config['max_size']          = '';
                    $upload_config['max_width']         = '';
                    $upload_config['max_height']        = '';
                    $upload_config['allowed_types']     = 'jpg|jpeg|gif|png';
                    
                    $thumb_config['thumb_create']       = false;
                    $thumb_config['thumb_file_upload_path'] = 'thumb/';
                    $thumb_config['thumb_marker']       = '';
                    $thumb_config['thumb_width']        = '304';
                    $thumb_config['thumb_height']       = '138';
                
                    $sUploaded = image_upload($upload_config, $thumb_config);
                }
		if($this->input->post('menu') != '')
			$permission = implode(',',$this->input->post('menu'));
		else
			$permission = '';
			
                        if($sUploaded != '')
                        {
                                 $oldImg = $userListArray[0]['image'];
                                @unlink (FILE_UPLOAD_ABSOLUTE_PATH."admin/".$oldImg);
				
                        $data = array(
                                        'image'        =>  $sUploaded,
                                        'role'         =>  'editor',
                                        'first_name'   =>  addslashes(trim(ucwords($this->input->post('firstname')))),
                                        'last_name'    =>  addslashes(trim(ucwords($this->input->post('lastname')))),
                                        'admin_email'  =>  addslashes(trim($this->input->post('email'))),
                                        'password'     =>  trim($this->input->post('password')),
                                        'is_active'    =>  $this->input->post('status'),
					'permission'	=>  $permission
                                    );
                
                        } else {
                                 $data = array(
                                        'role'         =>  'editor',
                                        'first_name'   =>  addslashes(trim(ucwords($this->input->post('firstname')))),
                                        'last_name'    =>  addslashes(trim(ucwords($this->input->post('lastname')))),
                                        'admin_email'  =>  addslashes(trim($this->input->post('email'))),
                                        'password'     =>  trim($this->input->post('password')),
                                        'is_active'    =>  $this->input->post('status'),
					'permission'   =>  $permission
                                    );
                                }
                    
                $fieldname  = 'id';
                $updatedRecord = $this->model_common->update_user(ADMIN, $data, $fieldname, $id);
              
                
                if($updatedRecord != 0)
                    {
        
                    $this->nsession->set_userdata('succmsg', 'Editor information updated successfully');
                   
                    }   
                        redirect("editor/all");
                        exit;
                    }         
            
        }
        $this->templatelayout->get_topbar();
        $this->templatelayout->get_leftmenu();
        $this->templatelayout->get_footer();
        $this->elements['middle']='usereditor/edit';
        $this->elements_data['middle'] = $this->data;               
        $this->layout->setLayout('layout');
        $this->layout->multiple_view($this->elements,$this->elements_data);
    }


    //Calbacks: My Validation function
    function is_email_exists()
    {
        
        $id         = $this->uri->segment(3);
        $email      = strip_tags(addslashes(trim($this->input->post('email'))));
        
        $whereArr   = array();
        if($id > 0){
            $whereArr   = array( 'admin_email' => $email,
                         'id != ' => $id                        
                        );
        }else{          
            $whereArr   = array( 'admin_email' => $email );
        }
        $bool   = $this->model_common->checkRowExists(ADMIN, $whereArr );    
        if($bool == 0){
            $this->form_validation->set_message('is_email_exists', 'This %s already exists');
            return FALSE;
        }else{
            return TRUE;
        }
    }

}

?>