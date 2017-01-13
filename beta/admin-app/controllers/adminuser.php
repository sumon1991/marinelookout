<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
class Adminuser extends MY_Controller {
	public function __construct()
	{	
		parent::__construct();		
	}

	// LIST ADMIN USER
	public function index()
	{	
		$match = '';
		$findArray = array('role'=>'admin');		
		$this->data['adminList'] = array();
		$adminListArray = $this->model_common->fetch_data(ADMIN,$findArray);
		//pr($adminListArray);

		if(!empty($adminListArray))
		{		
			$this->data['adminList'] = $adminListArray;	
		}
		//$this->load->view('list',$data);

		$data['succmsg'] = $this->nsession->userdata('succmsg');
        $this->nsession->set_userdata('succmsg','');	
	    $this->templatelayout->get_topbar();
	    $this->templatelayout->get_leftmenu();
	    $this->templatelayout->get_footer();
	    $this->elements['middle']='useradmin/list';
	    $this->elements_data['middle'] = $this->data;			    
	    $this->layout->setLayout('layout');
	    $this->layout->multiple_view($this->elements,$this->elements_data);		
		
	}


	// VIEW ADMIN PROFILE
	public function profile()
	{	
		$data 		= array();
		$idArray 	= array();
		$match 		= '';
		$idArray 	= $this->nsession->userdata('USER_ID');
		$role 	 	= $this->nsession->userdata('ROLE');
		$this->data['adminList'] = array();
		$adminListArray = array();
		$adminListArray = $this->model_basic->getValues_conditions(ADMIN,'','','id = '.$idArray);


			//pr($adminListArray);

		if(!empty($adminListArray))
		{		
			$this->data['adminList'] = $adminListArray;	

			//pr($adminListArray);
		}

		/*-----------------------------------
		 BEGIN :: Fetch image name from admin
		 ------------------------------------*/
		$findArray 		= array('id'=>$this->nsession->userdata('USER_ID'));
        $executeQuery 	= $this->model_common->fetch_data(ADMIN,$findArray);
        
        if(!empty($executeQuery))
        {
        	$this->data['user_image'] =  BACKEND_IMAGE_PATH."admin/".$executeQuery[0]['image'];
        	$this->data['file_exists_link'] = FILE_UPLOAD_ABSOLUTE_PATH."admin/".$executeQuery[0]['image'];
        }
        $this->data['default_user_image'] = BACKEND_IMAGE_PATH.'no_image.png';
        /*--------------------------------
        END :: Fetch image name from admin
        ----------------------------------*/


		if($this->input->post('action')=='adminProfile')
        {
        	//pr($_POST);
            //$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            $this->form_validation->set_rules('first_name', 'Firstname', 'trim|required');
            $this->form_validation->set_rules('last_name', 'Lastname', 'trim|required');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|matches[conf_password]');
	        $this->form_validation->set_rules('conf_password', 'Confirm Password', 'trim|required');
            
            //echo $this->form_validation->run();exit;
            if ($this->form_validation->run() == TRUE)
            {   
                if(is_array($_FILES) && count($_FILES)>0)
                {

                    $upload_config['field_name']        = 'userfile';
                    $upload_config['file_upload_path']  = 'admin/';
                    $upload_config['max_size']      	= '';
                    $upload_config['max_width']     	= '';
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
                            $oldImg = $adminListArray[0]['image'];
                            unlink (FILE_UPLOAD_ABSOLUTE_PATH."admin/".$oldImg);
                    		$data = array(
		                                    'image'        =>  $sUploaded,
		                                    'first_name'   =>  addslashes(trim($this->input->post('first_name'))),
		                                    'last_name'    =>  addslashes(trim($this->input->post('last_name'))),
		                                    'password'     =>  trim($this->input->post('password')),
                                    
                        				);
                
                        }
                     	else
                     	{ 
                     		$data = array(
		                            
					                      	'first_name'  => addslashes(trim($this->input->post('first_name'))),
					                        'last_name'   => addslashes(trim($this->input->post('last_name'))),
					                        'password'    => trim($this->input->post('password')),
	                                       
                            			 );
                  		}
               	}
               	else
                {
               		$data = array(
	                            
	                       
			                        'first_name'  => addslashes(trim($this->input->post('first_name'))),
			                        'last_name'   => addslashes(trim($this->input->post('last_name'))),
			                        'password'    => trim($this->input->post('password')),
			                                       
		                          );    
                }
                
                $fieldname  = 'id';
                $updatedRecord = $this->model_common->update_user(ADMIN, $data, $fieldname, $idArray);
                //echo $updatedRecord;
          
                if($updatedRecord != 0)
                {
                    $this->nsession->set_userdata('succmsg', 'Admin information updated successfully');
                    redirect("adminuser/profile");
                    exit();
                }   
	                       
	        }      
            
        }
        $data['succmsg'] = $this->nsession->userdata('succmsg');
        $this->nsession->set_userdata('succmsg','');	
	    $this->templatelayout->get_topbar();
	    $this->templatelayout->get_leftmenu();
	    $this->templatelayout->get_footer();
	    $this->elements['middle']='useradmin/profile';
	    $this->elements_data['middle'] = $this->data;			    
	    $this->layout->setLayout('layout');
	    $this->layout->multiple_view($this->elements,$this->elements_data);
		
	}
}
?>