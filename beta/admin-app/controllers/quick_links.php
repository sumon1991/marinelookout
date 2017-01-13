<?php
class Quick_links extends MY_Controller{
    
    public function __construct(){
        parent:: __construct();
     
        $this->load->model(array("model_quick_links","model_basic","model_common"));
    }
    
    public function index()
    {
        $this->chk_login(); 
        $this->data='';
        //<!----------------------code----------------------->
        $config['base_url'] 	= BACKEND_URL."quick_links/index/";
		$config['per_page'] 	= 20;
		$config['uri_segment']	= 3;
		$config['num_links'] 	= 5;
		$this->pagination->setCustomAdminPaginationStyle($config);
		
		$this->data['search_keyword']	= '';
		$this->data['per_page']			= '';
		$this->data['params']			= $this->nsession->userdata('QUICK_LINKS_SEARCH');

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
		$this->data['brdLink'][0]['name']   =   'Quick Links';
		$this->data['brdLink'][0]['link']   =   'javascript:void(0)';
		
		$this->data['brdLink'][1]['logo']   =   'fa fa-file';
		$this->data['brdLink'][1]['name']   =   'Quick Links Listing';
		$this->data['brdLink'][1]['link']   =   'javascript:void(0)';
	
		//........................	
		$start 								= 0;
		$page								= $this->uri->segment(3,0);
		$this->data['quickLinksList']		= $this->model_quick_links->getList($config,$start);
		$this->data['startRecord'] 			= $start;
                
               // $this->data['brdLink']='';
		$this->data['totalRecord'] 		= $config['total_rows'];
		$this->data['per_page'] 		= $config['per_page'];
		$this->data['page']	 			= $page;
		$this->data['controller'] 		= 'quick_links';	
		$this->data['base_url'] 		= BACKEND_URL.$this->data['controller']."/index/0/1/";				
		$this->data['show_all']      	= BACKEND_URL.$this->data['controller']."/index/0/1/";
		$this->data['add_link']      	= BACKEND_URL.$this->data['controller']."/add/0/".$page."/";
		$this->data['status_link']   	= BACKEND_URL.$this->data['controller']."/do_status/{{ID}}/".$page."/";
		$this->data['edit_link']      	= BACKEND_URL.$this->data['controller']."/edit/{{ID}}/".$page."/";
		$this->data['delete_link']      = BACKEND_URL.$this->data['controller']."/delete/{{ID}}/".$page."/";

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
		$this->elements['middle']='quick_links/list';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
        
    }
    
    // ADD NOTICE
    public function add()
    {
	
        $this->chk_login();
        $this->data='';
        
        //<!-------------------code---------------->	
	if($this->input->get_post('action') == 'Process')
	{			
		$this->form_validation->set_rules('title', 'Title', 'trim|required');
		$this->form_validation->set_rules('link', 'Link', 'trim|required');			
		if ($this->form_validation->run() == FALSE)
		{
		    
		}
		else
		{			
			$title			= 	addslashes(trim($this->input->get_post('title')));
			$link			= 	addslashes(trim($this->input->post('link')));		
			$insertArr  	=  array(
					    'title' 	=> $title,
					    'link' 		=> $link,
					    'created_at' 	=> date('Y-m-d H:i:s')
				    );		    
			$ret		=	$this->model_basic->insertIntoTable('ep_quick_links',$insertArr);
			if(isset($ret))
			{
			    $this->nsession->set_userdata('succmsg', "Quick Links added successfully.");
			}
			else
			{
			    $this->nsession->set_userdata('errmsg', "Unable to update. Please try again later.");
			}						
			redirect(BACKEND_URL."quick_links/index/");
			return true;			    
		}
	}		
		
	$row = array();

        //<!------------------code----------------->
        
        //$this->data['brdLink']='';
	 //For breadcrump..........
		
	$this->data['brdLink'][0]['logo']   =   'fa fa-file';
	$this->data['brdLink'][0]['name']   =   'Quick Links';
	$this->data['brdLink'][0]['link']   =   'javascript:void(0)';
	
	$this->data['brdLink'][1]['logo']   =   'fa fa-file';
	$this->data['brdLink'][1]['name']   =   'Quick Links Listing';
	$this->data['brdLink'][1]['link']   =    BACKEND_URL."quick_links/index";
	
	$this->data['brdLink'][2]['logo']   =   'fa fa-file';
	$this->data['brdLink'][2]['name']   =   'Add Auick Links Page';
	$this->data['brdLink'][2]['link']   =   'javascript:void(0)';
	
	//........................	
	$this->data['controller']	= 'quick_links';
	$this->data['base_url'] 	= BACKEND_URL."quick_links/index";
	$this->data['succmsg'] 		= $this->nsession->userdata('succmsg');
	$this->data['errmsg'] 		= $this->nsession->userdata('errmsg');		
	$this->nsession->set_userdata('succmsg', "");		
	$this->nsession->set_userdata('errmsg', "");
        
	$this->templatelayout->get_topbar();
	$this->templatelayout->get_leftmenu();
	$this->templatelayout->get_footer();
	$this->elements['middle']='quick_links/add';			
	$this->elements_data['middle'] = $this->data;			    
	$this->layout->setLayout('layout');
	$this->layout->multiple_view($this->elements,$this->elements_data);      
        
    }
    

    // EDIT NOTICE
	public function edit()
	{
		$this->chk_login();
		//pr($_POST);
		//exit;
        
        $id		= '';
        $id = $this->uri->segment(3);
		$idArray = array('id'=>$id);
		$this->data['quickLinksList'] = array();
		$quickLinksListArray = $this->model_common->fetch_data('ep_quick_links',$idArray);
		//pr($noticeListArray);
		if(!empty($quickLinksListArray))
		{		
			$this->data['quickLinksList'] = $quickLinksListArray;	
		}

		if($this->input->post('action')=='edit')
		{
			//$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
	        $this->form_validation->set_rules('title', 'Title', 'trim|required');
			$this->form_validation->set_rules('link', 'Content', 'trim|required');
			$this->form_validation->set_rules('status', 'Status', 'trim|required');	
	        //echo $this->form_validation->run();exit;

		    if ($this->form_validation->run() == TRUE)
		    {	
					$data = array(
							'title'		=>	addslashes(trim($this->input->get_post('title'))),
							'link'		=>	addslashes(trim($this->input->post('link'))),
							'status'	=>	addslashes(trim($this->input->post('status')))
						);
						//pr($data);
				$fieldname 	= 'id';
				$updatedRecord = $this->model_common->update_user('ep_quick_links', $data, $fieldname, $id);
				//echo $updatedRecord;
				//exit;
				
				if($updatedRecord != 0)
				{
					$this->nsession->set_userdata('succmsg', 'Quick Links updated successfully');
					redirect("quick_links/index");
					exit;
				}
				else
				{
				    redirect("quick_links/index");
				    exit;
				}
			}			

		}	

		//<!------------------code----------------->

		//$this->data['brdLink']='';
		//For breadcrump..........

		$this->data['brdLink'][0]['logo']   =   'fa fa-file';
		$this->data['brdLink'][0]['name']   =   'Quick Links';
		$this->data['brdLink'][0]['link']   =   'javascript:void(0)';

		$this->data['brdLink'][1]['logo']   =   'fa fa-file';
		$this->data['brdLink'][1]['name']   =   'Quick Links Listing';
		$this->data['brdLink'][1]['link']   =    BACKEND_URL."quick_links/index";

		$this->data['brdLink'][2]['logo']   =   'fa fa-file';
		$this->data['brdLink'][2]['name']   =   'Edit Quick Links Page';
		$this->data['brdLink'][2]['link']   =   'javascript:void(0)';

		//........................


		$data['succmsg'] = $this->nsession->userdata('succmsg');
		$this->nsession->set_userdata('succmsg','');
		$data['errmsg'] = $this->nsession->userdata('errmsg');
		$this->nsession->set_userdata('errmsg','');
	    $this->templatelayout->get_topbar();
	    $this->templatelayout->get_leftmenu();
	    $this->templatelayout->get_footer();
	    $this->elements['middle']='quick_links/edit';
	    $this->elements_data['middle'] = $this->data;			    
	    $this->layout->setLayout('layout');
	    $this->layout->multiple_view($this->elements,$this->elements_data);
	}
    

    // DELETE NOTICE
    public function delete()
    {
    	$this->chk_login();
		$id = $this->uri->segment(3);
		$deleteRecord = $this->model_basic->deleteData('ep_quick_links','id = '.$id);
		if($deleteRecord==TRUE)
		{
			redirect("quick_links/index/");
			exit;
		}

    }
}
?>