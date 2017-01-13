<?php
class Cms extends MY_Controller{
    
    var $cmsTable 	= 'ep_cms';
    public function __construct(){
        parent:: __construct();
     
        $this->load->model("model_cms");
    }
    
    public function index()
    {
        $this->chk_login(); 
        $this->data='';
        //<!----------------------code----------------------->
        $config['base_url'] 	= BACKEND_URL."cms/index/";
		$config['per_page'] 	= 20;
		$config['uri_segment']	= 3;
		$config['num_links'] 	= 5;
		$this->pagination->setCustomAdminPaginationStyle($config);
		
		$this->data['search_keyword']	= '';
		$this->data['per_page']			= '';
		$this->data['params']			= $this->nsession->userdata('CMS_SEARCH');

		if($this->input->get_post('search_keyword') == '' && $this->input->get_post('per_page') == '')
		{
			//$this->nsession->set_userdata('CMS_SEARCH','');
			$this->data['search_keyword'] 	= $this->data['params']['search_keyword'];
			$this->data['per_page']		  	= $this->data['params']['per_page'];
		}
		else 
		{
			$this->data['search_keyword']	= $this->input->get_post('search_keyword',true);
			$this->data['per_page'] 		= $this->input->get_post('per_page',true);	
		}
		 //For breadcrump..........
		
		$this->data['brdLink'][0]['logo']   =   'fa fa-file';
		$this->data['brdLink'][0]['name']   =   'CMS';
		$this->data['brdLink'][0]['link']   =   'javascript:void(0)';
		
		$this->data['brdLink'][1]['logo']   =   'fa fa-file';
		$this->data['brdLink'][1]['name']   =   'CMS Listing';
		$this->data['brdLink'][1]['link']   =   'javascript:void(0)';
	
		//........................	
		$start 				= 0;
		$page				= $this->uri->segment(3,0);
		$this->data['cmsList']		= $this->model_cms->getList($config,$start);
		$this->data['startRecord'] 	= $start;
                
               // $this->data['brdLink']='';
		$this->data['totalRecord'] 		= $config['total_rows'];
		$this->data['per_page'] 		= $config['per_page'];
		$this->data['page']	 			= $page;
		$this->data['controller'] 		= 'cms';	
		$this->data['base_url'] 		= BACKEND_URL.$this->data['controller']."/index/0/1/";				
		$this->data['show_all']      	= BACKEND_URL.$this->data['controller']."/index/0/1/";
		$this->data['add_link']      	= BACKEND_URL.$this->data['controller']."/add_cms/0/".$page."/";
		$this->data['status_link']   	= BACKEND_URL.$this->data['controller']."/do_status/{{ID}}/".$page."/";
		$this->data['edit_link']      	= BACKEND_URL.$this->data['controller']."/edit_cms/{{ID}}/".$page."/";
		
		$this->pagination->setCustomAdminPaginationStyle($config);
		$this->pagination->initialize($config);
        $this->data['pagination'] = $this->pagination->create_links();
        
        //<!---------------------code------------------------->
        $this->data['succmsg'] = $this->nsession->userdata('succmsg');
		$this->data['errmsg']  = $this->nsession->userdata('errmsg');		
		$this->nsession->set_userdata('succmsg', "");		
		$this->nsession->set_userdata('errmsg', "");
        
		$this->templatelayout->get_topbar();
		$this->templatelayout->get_leftmenu();
		$this->templatelayout->get_footer();
		$this->elements['middle']='cms/list';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
        
    }
    
    function is_name_exists()
    {
		
		$id 		= $this->uri->segment(3, 0);
		$cms_title	= strip_tags(addslashes(trim($this->input->get_post('cms_title'))));
		
		$whereArr	= array();
		if($id > 0){
			$whereArr	= array( 'cms_title' => $cms_title,
						 'cms_id != ' => $id						
						);
		}else{			
			$whereArr	= array( 'cms_title' => $cms_title );
		}
		$bool 	= $this->model_basic->checkRowExists($this->cmsTable, $whereArr );	
		if($bool == 0){
			$this->form_validation->set_message('is_name_exists', 'The %s name already exists');
			return FALSE;
		}else{
			return TRUE;
		}
    }
    
    public function edit_cms()
    {
        if($this->nsession->userdata('USER_ID') == '')
	{
		$url = BACKEND_URL."login/";
		redirect($url); exit;
	}
        $this->data='';
        
        //<!-------------------code---------------->
        
        $cms_id	= $this->uri->segment(3, 0);
	$page	= $this->uri->segment(4, 0);
		
	if($this->input->get_post('action') == 'Process')
	{			
		$this->form_validation->set_rules('cms_title', 'CMS Title', 'trim|required');
		$this->form_validation->set_rules('cms_content', 'CMS Content', 'trim|required');
		$this->form_validation->set_rules('meta_title', 'Meta Title', 'trim|required');
		$this->form_validation->set_rules('meta_keys', 'Meta keys', 'trim|required');
		$this->form_validation->set_rules('meta_description', 'Meta description', 'trim|required');
				
		if ($this->form_validation->run() == FALSE)
		{
		    
		}
		else
		{			
			$cms_title			= 	addslashes(trim($this->input->get_post('cms_title')));
			//$cms_slug			= 	url_title(strtolower($cms_title));
			$cms_content		= 	addslashes($this->input->post('cms_content'));
			$cms_meta_title 	= 	addslashes($this->input->post('meta_title'));
			$cms_meta_key 		= 	addslashes($this->input->post('meta_keys'));
			$cms_meta_description 	=	addslashes($this->input->post('meta_description'));
	    		$cms_image 		= 	'';
			
			if ($_FILES['cms_image']['name'] != "")
			{				
			    $upload_config['field_name']		= 'cms_image';
			    $upload_config['file_upload_path'] 	= 'cms/';
			    $upload_config['max_size']			= '';
			    $upload_config['max_width']			= '';
			    $upload_config['max_height']		= '';
			    $upload_config['allowed_types']		= 'jpg|jpeg|gif|png';
			    $thumb_config['thumb_create']		= true;
			    $thumb_config['thumb_file_upload_path']	= 'thumb/';
			    $thumb_config['thumb_marker']		= '';
			    $thumb_config['thumb_width']		= '304';
			    $thumb_config['thumb_height']		= '138';					
			    $sUploaded = image_upload($upload_config, $thumb_config);
			    
			    $arr_user_image_old = $this->model_cms->get_single($cms_id);
			    $user_image_old     = $arr_user_image_old[0]['cms_image'];
			    
			    if($sUploaded == '')
			    {
				    $this->nsession->set_userdata('errmsg', $sUploaded);
				    redirect(BACKEND_URL."cms/index/".$page."/");
				    return false;
			    }
			    else
			    {
				    $cms_image = $sUploaded;
			    }
			}
			if($cms_image	==	'')
			{
			    $updArr  	=  array(
						'cms_title' 	=> $cms_title,
						//'cms_slug' 		=> $cms_slug,
						'cms_content' 	=> $cms_content,
						'cms_meta_title'	=>$cms_meta_title,
						'cms_meta_key'  	=>$cms_meta_key,
						'cms_meta_desc' 	=>$cms_meta_description						
					);
			}
			else
			{
			    $updArr  	=  array(
						'cms_title' 	=> $cms_title,
						//'cms_slug' 	=> $cms_slug,
						'cms_content' 	=> $cms_content,
						'cms_meta_title'=> $cms_meta_title,
						'cms_meta_key'  => $cms_meta_key,
						'cms_meta_desc' => $cms_meta_description,
						'cms_image' 	=> $cms_image
					);
			}
			$idArr		= 	array( 'cms_id' => $cms_id );			    
			$ret		=	$this->model_basic->updateIntoTable('ep_cms', $idArr, $updArr);
			if(isset($ret))
			{
			    $this->nsession->set_userdata('succmsg', "CMS updated successfully.");
			}
			else
			{
			    $this->nsession->set_userdata('errmsg', "Unable to update. Please try again later.");
			}						
			redirect(BACKEND_URL."cms/index/".$page."/");
			return true;			    
		}
	}		
		
	$row = array();

	$Condition = " cms_id = '".$cms_id."'";

	$rs = $this->model_basic->getValues_conditions($this->cmsTable, '', '', $Condition);		
	$row = $rs[0];
	
	if($row){
	    $this->data['arr_cms'] = $row;
	} else {
		$this->nsession->set_userdata('errmsg', "Record does not exist.");
		redirect(BACKEND_URL.$this->data['controller']."/edit_cms/".$page."/");
		return false;
	}

        //<!------------------code----------------->
        
        //$this->data['brdLink']='';
	 //For breadcrump..........
		
	$this->data['brdLink'][0]['logo']   =   'fa fa-file';
	$this->data['brdLink'][0]['name']   =   'CMS';
	$this->data['brdLink'][0]['link']   =   'javascript:void(0)';
	
	$this->data['brdLink'][1]['logo']   =   'fa fa-file';
	$this->data['brdLink'][1]['name']   =   'CMS Listing';
	$this->data['brdLink'][1]['link']   =    BACKEND_URL."cms/index";
	
	$this->data['brdLink'][2]['logo']   =   'fa fa-file';
	$this->data['brdLink'][2]['name']   =   'Edit CMS Page';
	$this->data['brdLink'][2]['link']   =   'javascript:void(0)';
	
	//........................	
    $this->data['controller']='cms';
    $this->data['edit_link'] = BACKEND_URL."cms/edit_cms/".$cms_id."/".$page."/";
    $this->data['base_url'] = BACKEND_URL."cms/index";
    $this->data['add_url']      	= BACKEND_URL.$this->data['controller']."/add_cms/0/".$page."/";
    $this->data['succmsg'] = $this->nsession->userdata('succmsg');
	$this->data['errmsg'] = $this->nsession->userdata('errmsg');		
	$this->nsession->set_userdata('succmsg', "");		
	$this->nsession->set_userdata('errmsg', "");
        
    $this->templatelayout->get_topbar();
	$this->templatelayout->get_leftmenu();
	$this->templatelayout->get_footer();
    $this->elements['middle']='cms/edit';			
    $this->elements_data['middle'] = $this->data;			    
    $this->layout->setLayout('layout');
    $this->layout->multiple_view($this->elements,$this->elements_data);      
        
    }
}
?>