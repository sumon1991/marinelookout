<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Advertisement extends MY_Controller {

	public function __construct()
	{
		parent::__construct();		
		$this->load->model(array('model_common','model_administrator','model_editor','model_advertisement'));

	}
// LIST EDITOR USER
	public function index()
	{ 
		$this->chk_login();
		$data = array();
		$data['advertisement_all'] 	= array();
		$data['pagination'] 		= array();
		$data['per_page']       	= PER_PAGE_LISTING;		
		$data['page']     			= $this->uri->segment(3);
	
		if($this->input->get_post('is_show_all') == 1)
		   $this->nsession->set_userdata('ADVERTISE_SEARCH','');
		  
		//echo $this->nsession->userdata('ADVERTISE_SEARCH');	
		//$data['search_keyword']= "";
		$data['search_keyword']  = $this->nsession->userdata('ADVERTISE_SEARCH');
		
	if($this->input->get_post('search_keyword') == '' && $this->input->get_post('per_page') == '' && $this->nsession->userdata('ADVERTISE_SEARCH')== '')
        {
             $data['search_keyword']   	 = $data['search_keyword'];
             $data['per_page'] 	      	 = $data['per_page'];
        }	
        else 
        {
		if($this->input->get_post('search_keyword',true) != '')
			$data['search_keyword']   = trim($this->input->get_post('search_keyword',true));
		else	
			$data['search_keyword']   = $this->nsession->userdata('ADVERTISE_SEARCH');
			
		$data['per_page']         = $this->input->get_post('per_page',true);  
        }
	$total_student            	= $this->model_advertisement->countAdvertiseDB($data['search_keyword']);
        $data['totalRecord']      	= $total_student;
	if($this->uri->segment(3) == '' || $this->uri->segment(3) == 0)
		$start            	= 0;
	else
		$start            	= ($this->uri->segment(3)-2)*PER_PAGE_LISTING;
		
	$data['startRecord']   	= $start;
	$data['to_record']   	= $start+PER_PAGE_LISTING;
	//echo $data['startRecord'].'--'.$data['to_record'];
        if($total_student > 0)
	{
            /********** FOR PAGINATION ***********/
            $config['base_url'] = base_url().'advertisement/index';
            $config['per_page'] = PER_PAGE_LISTING;
            $config['total_rows'] = $total_student;
	    
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
            $resultArr=$this->model_advertisement->allAdvertiseDB($data['search_keyword'] ,PER_PAGE_LISTING,$offset);
            //pr($resultArr);

            if(count($resultArr) > 0)
	    {
                $num = 1+$offset;
		foreach($resultArr as $values)
		{
			$addId              = $values['id'];
			$subjectStatus      = $values['is_active'];
			$status_class       =($subjectStatus == 'yes')?'label-green':'label-red';    
				
			/********** GET GENERATE EDIT AND DELETE LINK ***********/
			$this->uri_segment  = $this->uri->total_segments();
			$cur_page           = 0;
			if ($this->uri->segment($this->uri_segment) != 0) {
			    $this->cur_page = $this->uri->segment($this->uri_segment);
			    $cur_page = (int) $this->cur_page;
			}
	
			$edit_link    = base_url()."advertisement/edit/".$addId."/".$cur_page."/";
			$delete_link  = base_url()."advertisement/delete/".$addId."/".$cur_page."/";
	
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
								'delete_link'       => $delete_link
								)
						);
			$num++;

                }

                $data['advertisement_all']        = $total_result;
                //pr($data['advertisement_all']);
                /********** FOR PAGINATION ***********/
                //$config['cur_tag_open']     			= '<span class="current-link">';
                //$config['cur_tag_close']    			= '</span>';
		$config['uri_segment']	= 3;
		$config['num_links'] 	= 5;
		//pr($config);
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
		$this->elements['middle']='advertisement/list';
		$this->elements_data['middle'] = $data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);

	}
        public function add()
    {
	$this->chk_login();

        if($this->input->post('action')=='add')
        {
            $aligement = addslashes(trim($this->input->post('side')));
                       
            $this->form_validation->set_rules('title', 'titlename', 'trim|required');
            $this->form_validation->set_rules('advertisement_link', 'Advertisement Link', 'trim|required');
	    $this->form_validation->set_rules('side', 'Side', 'trim|required');
	    $this->form_validation->set_rules('status', 'Status', 'trim|required');
	    
            $upload_config['field_name']            = 'userfile';
            $upload_config['file_upload_path']      = 'advertisement/';
            $upload_config['max_size']              = '';
            $upload_config['max_width']             = '200';
            $upload_config['max_height']            = '200';
            $upload_config['allowed_types']         = 'jpg|jpeg|gif|png';
            $thumb_config['thumb_create']           = false;
            $thumb_config['thumb_file_upload_path'] = 'thumb/';
            $thumb_config['thumb_marker']           = '';
            $thumb_config['maintain_ratio']         = false;
            $thumb_config['thumb_width']            = '200';
            $thumb_config['thumb_height']           = '200';
            
            $sUploaded = image_upload($upload_config, $thumb_config);


            if(isset($sUploaded) && count($sUploaded)>0){

                if ($this->form_validation->run() == TRUE)
                {   
                    
                    $data = array();

                    $data = array(
                                'image'         =>   $sUploaded,
                                'title'         =>  addslashes(trim($this->input->post('title'))),
                                'alignment'     =>  addslashes(trim($this->input->post('side'))),
				'advertisement_link'     =>  addslashes(trim($this->input->post('advertisement_link'))),
                                'added_on'      =>  date('Y-m-d H:i:s', time()),
                                'is_active'     =>  $this->input->post('status')
                            );                

                    // SEND POST DATA ($data)
                    
                    $insert_new_user = $this->model_common->insert_user(ADVERTISEMENT,$data);
                    //echo $insert_new_user;
                    
                    if($insert_new_user>0)
                    {   
                        $this->nsession->set_userdata('succmsg', 'One Advertise added successfully');
                        redirect("advertisement/index");
                    }
                }
            }  
        }
        $this->data = '';
        $this->templatelayout->get_topbar();
        $this->templatelayout->get_leftmenu();
        $this->templatelayout->get_footer();
        $this->elements['middle']='advertisement/add';
        $this->elements_data['middle'] = $this->data;               
        $this->layout->setLayout('layout');
        $this->layout->multiple_view($this->elements,$this->elements_data);        
    }
    public function delete()
    {   
        $this->chk_login();
        // URI Operation
        $id = $this->uri->segment(3);

        // POST Operation
        //$id = $this->input->post('id');

        // Retrieve image name to remove from folder
        $findArray = array('id'=>$id);
        $executeQuery = $this->model_common->fetch_data(ADVERTISEMENT,$findArray);
        $imageNameToRemove = $executeQuery[0]['image'];
        //unlink(FILE_UPLOAD_ABSOLUTE_PATH."student/".$imageNameToRemove);
        
        $fieldname = 'id';
        $deleteRecord = $this->model_common->delete_user(ADVERTISEMENT, $fieldname, $id);

        if($deleteRecord==1)
        {   
            @unlink(FILE_UPLOAD_ABSOLUTE_PATH."advertisement/".$imageNameToRemove);
            $this->nsession->set_userdata('succmsg', 'Advertise information deleted successfully');
            redirect('advertisement/index');
        }   
        
    }   
    public function edit()
        {
		$this->chk_login();
		
        //pr($_POST);
        //exit;
        
        $id     = '';
        $id = $this->uri->segment(3);
        $idArray = array('id'=>$id);
        $this->data['advertisementdata'] = array();
        $userListArray = $this->model_common->fetch_data(ADVERTISEMENT,$idArray);
        //pr($userListArray);
        if(!empty($userListArray))
        {       
            $this->data['advertisementdata'] = $userListArray;    
        }

        if($this->input->post('action')=='edit')
        {
            //$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            $this->form_validation->set_rules('title', 'Titlename', 'trim|required');
            $this->form_validation->set_rules('side', 'Side', 'trim|required');
            //echo $this->form_validation->run();exit;
            if ($this->form_validation->run() == TRUE)
            {   
                $sUploaded = '';
                if($_FILES['userfile']['name'] != '')
                {
                    $imagedetails = list($width, $height, $type, $attr) = getimagesize($_FILES["userfile"]['tmp_name']);
		    
		    $width	= $imagedetails[0];
		    $height	= $imagedetails[1];
		    
		    if($width != 200 && $height != 200)
		    {
			$this->nsession->set_userdata('errmsg', 'Image must be 200x200');
			redirect(BACKEND_URL."advertisement/edit/".$id);
			exit();
		    }

                    $upload_config['field_name']        = 'userfile';
                    $upload_config['file_upload_path']  = 'advertisement/';
                    $upload_config['max_size']          = '';
		    
                    $upload_config['max_width']         = '200';
                    $upload_config['max_height']        = '200';
		    
					$upload_config['min_width']         = '200';
                    $upload_config['min_height']        = '200';
		    
                    $upload_config['allowed_types']     = 'jpg|jpeg|gif|png';
                    
                    $thumb_config['thumb_create']       = false;
                    $thumb_config['thumb_file_upload_path'] = 'thumb/';
                    $thumb_config['thumb_marker']       = '';
                    $thumb_config['maintain_ratio']     = '';
                    $thumb_config['thumb_width']        = '200';
                    $thumb_config['thumb_height']       = '200';
                
                    $sUploaded = image_upload($upload_config, $thumb_config);
                }
                        if($sUploaded != '')
                        {
                                 $oldImg = $userListArray[0]['image'];
                                @unlink (FILE_UPLOAD_ABSOLUTE_PATH."advertisement/".$oldImg);
                                @unlink (FILE_UPLOAD_ABSOLUTE_PATH."advertisement/thumb/".$oldImg);
                        $data = array(
                                        'image'         =>  $sUploaded,
                                        'title'        =>  addslashes(trim($this->input->post('title'))),
                                        'alignment'    =>  addslashes(trim($this->input->post('side'))),
                                        'is_active'    =>  $this->input->post('status'),
					'advertisement_link' =>  addslashes(trim($this->input->post('advertisement_link'))),
                    'advertisement_script' =>  trim($this->input->post('advertisement_script'))
                                    );
                
                        } else {
                                 $data = array(
                                       
                                        'title'        =>  addslashes(trim($this->input->post('title'))),
                                        'alignment'    =>  addslashes(trim($this->input->post('side'))),
                                        'is_active'    =>  $this->input->post('status'),
					'advertisement_link' =>  addslashes(trim($this->input->post('advertisement_link'))),
                    'advertisement_script' =>  trim($this->input->post('advertisement_script'))
                                        );
                                }
                //pr($data);
                $fieldname  = 'id';
                $updatedRecord = $this->model_common->update_user(ADVERTISEMENT, $data, $fieldname, $id);
                //echo $updatedRecord;
             
                
                if($updatedRecord != 0)
                    {
        
                    $this->nsession->set_userdata('succmsg', 'Advertisement information updated successfully');
		    redirect("advertisement/index");
                        exit;
                   
                    }
		    else
		    {
			 //$this->nsession->set_userdata('errmsg', 'Advertisement information not updated successfully');
			redirect("advertisement/index");
                        exit;
		    }
                }         
            
        }
	$this->data['errmsg'] 	= $this->nsession->userdata('errmsg');
	$this->data['succmsg']	= $this->nsession->userdata('succmsg');
	$this->nsession->set_userdata('errmsg', '');
	$this->nsession->set_userdata('succmsg', '');
        $this->templatelayout->get_topbar();
        $this->templatelayout->get_leftmenu();
        $this->templatelayout->get_footer();
        $this->elements['middle']='advertisement/edit';
        $this->elements_data['middle'] = $this->data;               
        $this->layout->setLayout('layout');
        $this->layout->multiple_view($this->elements,$this->elements_data);
    }


}
?>