<?php
class Notice extends MY_Controller{
    
    var $cmsTable 	= 'ep_notice';
    public function __construct(){
        parent:: __construct();
     
        $this->load->model(array("model_notice","model_common"));
    }
    
    public function index()
    {
        $this->chk_login(); 
        $this->data='';
        //<!----------------------code----------------------->
        $config['base_url'] 	= BACKEND_URL."notice/index/";
		$config['per_page'] 	= 20;
		$config['uri_segment']	= 3;
		$config['num_links'] 	= 5;
		$this->pagination->setCustomAdminPaginationStyle($config);
		
		$this->data['search_keyword']	= '';
		$this->data['per_page']			= '';
		$this->data['params']			= $this->nsession->userdata('NOTICE_SEARCH');

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
		$this->data['brdLink'][0]['name']   =   'NOTICE';
		$this->data['brdLink'][0]['link']   =   'javascript:void(0)';
		
		$this->data['brdLink'][1]['logo']   =   'fa fa-file';
		$this->data['brdLink'][1]['name']   =   'NOTICE Listing';
		$this->data['brdLink'][1]['link']   =   'javascript:void(0)';
	
		//........................	
		$start 								= 0;
		$page								= $this->uri->segment(3,0);
		$this->data['noticeList']			= $this->model_notice->getList($config,$start);
		$this->data['startRecord'] 			= $start;
                
               // $this->data['brdLink']='';
		$this->data['totalRecord'] 		= $config['total_rows'];
		$this->data['per_page'] 		= $config['per_page'];
		$this->data['page']	 			= $page;
		$this->data['controller'] 		= 'notice';	
		$this->data['base_url'] 		= BACKEND_URL.$this->data['controller']."/index/0/1/";				
		$this->data['show_all']      	= BACKEND_URL.$this->data['controller']."/index/0/1/";
		$this->data['add_link']      	= BACKEND_URL.$this->data['controller']."/add_notice/0/".$page."/";
		$this->data['status_link']   	= BACKEND_URL.$this->data['controller']."/do_status/{{ID}}/".$page."/";
		$this->data['edit_link']      	= BACKEND_URL.$this->data['controller']."/edit_notice/{{ID}}/".$page."/";
		$this->data['delete_link']      = BACKEND_URL.$this->data['controller']."/delete_notice/{{ID}}/".$page."/";

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
		$this->elements['middle']='notice/list';			
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
    
    // ADD NOTICE
    public function add_notice()
    {
	
        $this->chk_login();
        $this->data='';
        
        //<!-------------------code---------------->	
	if($this->input->get_post('action') == 'Process')
	{			
		$this->form_validation->set_rules('subject', 'Subject', 'trim|required');
		$this->form_validation->set_rules('content', 'Content', 'trim|required');
		$this->form_validation->set_rules('status', 'Status', 'trim|required');				
		if ($this->form_validation->run() == FALSE)
		{
		    
		}
		else
		{			
			$subject		= 	addslashes(trim($this->input->get_post('subject')));
			$content		= 	addslashes(trim($this->input->post('content')));
			$status 		= 	addslashes(trim($this->input->post('status')));			
			$insertArr  	=  array(
					    'subject' 	=> $subject,
					    'content' 	=> $content,
					    'status' 	=> $status,
					    'added_on' 	=> date('Y-m-d')
				    );		    
			$ret		=	$this->model_basic->insertIntoTable('ep_notice',$insertArr);
			if(isset($ret))
			{
			    $this->nsession->set_userdata('succmsg', "Notice updated successfully.");
			}
			else
			{
			    $this->nsession->set_userdata('errmsg', "Unable to update. Please try again later.");
			}						
			redirect(BACKEND_URL."notice/index/");
			return true;			    
		}
	}		
		
	$row = array();

        //<!------------------code----------------->
        
        //$this->data['brdLink']='';
	 //For breadcrump..........
		
	$this->data['brdLink'][0]['logo']   =   'fa fa-file';
	$this->data['brdLink'][0]['name']   =   'NOTICE';
	$this->data['brdLink'][0]['link']   =   'javascript:void(0)';
	
	$this->data['brdLink'][1]['logo']   =   'fa fa-file';
	$this->data['brdLink'][1]['name']   =   'NOTICE Listing';
	$this->data['brdLink'][1]['link']   =    BACKEND_URL."notice/index";
	
	$this->data['brdLink'][2]['logo']   =   'fa fa-file';
	$this->data['brdLink'][2]['name']   =   'ADD NOTICE Page';
	$this->data['brdLink'][2]['link']   =   'javascript:void(0)';
	
	//........................	
	$this->data['controller']	= 'notice';
	$this->data['base_url'] 	= BACKEND_URL."notice/index";
	$this->data['add_url']      	= BACKEND_URL.$this->data['controller']."/add_notice/";
	$this->data['succmsg'] 		= $this->nsession->userdata('succmsg');
	$this->data['errmsg'] 		= $this->nsession->userdata('errmsg');		
	$this->nsession->set_userdata('succmsg', "");		
	$this->nsession->set_userdata('errmsg', "");
        
	$this->templatelayout->get_topbar();
	$this->templatelayout->get_leftmenu();
	$this->templatelayout->get_footer();
	$this->elements['middle']='notice/add';			
	$this->elements_data['middle'] = $this->data;			    
	$this->layout->setLayout('layout');
	$this->layout->multiple_view($this->elements,$this->elements_data);      
        
    }
    

    // EDIT NOTICE
	public function edit_notice()
	{
		$this->chk_login();
		//pr($_POST);
		//exit;
        
        $id		= '';
        $id = $this->uri->segment(3);
		$idArray = array('id'=>$id);
		$this->data['noticeList'] = array();
		$noticeListArray = $this->model_common->fetch_data(NOTICE,$idArray);
		//pr($noticeListArray);
		if(!empty($noticeListArray))
		{		
			$this->data['noticeList'] = $noticeListArray;	
		}

		if($this->input->post('action')=='edit')
		{
			//$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
	        $this->form_validation->set_rules('subject', 'Subject', 'trim|required|callback_is_subject_exists');
			$this->form_validation->set_rules('content', 'Content', 'trim|required');
			$this->form_validation->set_rules('status', 'Status', 'trim|required');	
	        //echo $this->form_validation->run();exit;

		    if ($this->form_validation->run() == TRUE)
		    {	
					$data = array(
							'subject'		=>	addslashes(trim($this->input->get_post('subject'))),
							'content'		=>	addslashes(trim($this->input->post('content'))),
							'status'		=>	addslashes(trim($this->input->post('status')))
						);
				$fieldname 	= 'id';
				$updatedRecord = $this->model_common->update_user(NOTICE, $data, $fieldname, $id);
				//echo $updatedRecord;
				//exit;
				
				if($updatedRecord != 0)
				{
					$this->nsession->set_userdata('succmsg', 'Notice updated successfully');
					redirect("notice/index");
					exit;
				}
				else
				{
				    redirect("notice/index");
				    exit;
				}
			}			

		}	

		//<!------------------code----------------->

		//$this->data['brdLink']='';
		//For breadcrump..........

		$this->data['brdLink'][0]['logo']   =   'fa fa-file';
		$this->data['brdLink'][0]['name']   =   'NOTICE';
		$this->data['brdLink'][0]['link']   =   'javascript:void(0)';

		$this->data['brdLink'][1]['logo']   =   'fa fa-file';
		$this->data['brdLink'][1]['name']   =   'NOTICE LISTING';
		$this->data['brdLink'][1]['link']   =    BACKEND_URL."notice/index";

		$this->data['brdLink'][2]['logo']   =   'fa fa-file';
		$this->data['brdLink'][2]['name']   =   'EDIT NOTICE Page';
		$this->data['brdLink'][2]['link']   =   'javascript:void(0)';

		//........................


		$data['succmsg'] = $this->nsession->userdata('succmsg');
		$this->nsession->set_userdata('succmsg','');
		$data['errmsg'] = $this->nsession->userdata('errmsg');
		$this->nsession->set_userdata('errmsg','');
	    $this->templatelayout->get_topbar();
	    $this->templatelayout->get_leftmenu();
	    $this->templatelayout->get_footer();
	    $this->elements['middle']='notice/edit';
	    $this->elements_data['middle'] = $this->data;			    
	    $this->layout->setLayout('layout');
	    $this->layout->multiple_view($this->elements,$this->elements_data);
	}
    

    // DELETE NOTICE
    public function delete_notice()
    {
    	$this->chk_login();
		$id = $this->uri->segment(3);
		$deleteRecord = $this->model_basic->deleteData('ep_notice','id = '.$id);
		if($deleteRecord==TRUE)
		{
			redirect("notice/index/");
			exit;
		}

    }

    //Calbacks: My Validation function : INDOS
	function is_subject_exists()
    {
		$id 		= $this->uri->segment(3);
		$subject		= strip_tags(addslashes(trim($this->input->post('subject'))));
		
		$whereArr	= array();
		if($id > 0){
			$whereArr	= array( 'subject' => $subject,
						 'id != ' => $id						
						);
		}else{			
			$whereArr	= array( 'subject' => $subject );
		}
		$bool 	= $this->model_common->checkRowExists(NOTICE, $whereArr );	
		if($bool == 0){
			$this->form_validation->set_message('is_subject_exists', 'This %s already exists');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
    }
}
?>