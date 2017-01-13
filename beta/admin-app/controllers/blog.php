<?php
class Blog extends MY_Controller{
    public function __construct(){
        parent:: __construct();     
        $this->load->model("model_blog");
		$this->load->model("model_basic");
    }
    
    public function index()
    {
	$this->chk_login(); 
        $this->data='';
        //<!----------------------code----------------------->
        $config['base_url'] 	= BACKEND_URL."blog/index/";
	$config['per_page'] 	= 20;
	$config['uri_segment']	= 3;
	$config['num_links'] 	= 5;
	$this->pagination->setCustomAdminPaginationStyle($config);
	
	$this->data['search_keyword']	= '';
	$this->data['per_page']			= '';
	$this->data['params']			= $this->nsession->userdata('BLOG_SEARCH');

	if($this->input->get_post('search_keyword') == '' && $this->input->get_post('per_page') == '')
	{
		//$this->nsession->set_userdata('CMS_SEARCH','');
		$this->data['search_keyword'] 	= $this->data['params']['search_keyword'];
		$this->data['per_page']		= $this->data['params']['per_page'];
	}
	else 
	{
		$this->data['search_keyword']	= $this->input->get_post('search_keyword',true);
		$this->data['per_page'] 	= $this->input->get_post('per_page',true);	
	}
	 //For breadcrump..........
	
	$this->data['brdLink'][0]['logo']   =   'fa fa-file';
	$this->data['brdLink'][0]['name']   =   'Blog';
	$this->data['brdLink'][0]['link']   =   'javascript:void(0)';
	
	$this->data['brdLink'][1]['logo']   =   'fa fa-file';
	$this->data['brdLink'][1]['name']   =   'Blog Listing';
	$this->data['brdLink'][1]['link']   =   'javascript:void(0)';

//........................	
	$start 				= 0;
	$page				= $this->uri->segment(3,0);
	$this->data['blogList']		= $this->model_blog->getList($config,$start);
	$this->data['startRecord'] 	= $start;
	
       // $this->data['brdLink']='';
	$this->data['totalRecord'] 	= $config['total_rows'];
	$this->data['per_page'] 	= $config['per_page'];
	$this->data['page']	 	= $page;
	$this->data['controller'] 	= 'blog';	
	$this->data['base_url'] 	= BACKEND_URL.$this->data['controller']."/index/0/1/";				
	$this->data['show_all']      	= BACKEND_URL.$this->data['controller']."/index/0/1/";
	$this->data['add_link']      	= BACKEND_URL.$this->data['controller']."/add_cms/0/".$page."/";
	$this->data['status_link']   	= BACKEND_URL.$this->data['controller']."/do_status/{{ID}}/".$page."/";
	$this->data['edit_link']      	= BACKEND_URL.$this->data['controller']."/edit_cms/{{ID}}/".$page."/";
	

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
        $this->elements['middle']='blog/list';			
        $this->elements_data['middle'] = $this->data;			    
        $this->layout->setLayout('layout');
        $this->layout->multiple_view($this->elements,$this->elements_data);
        
    }
    
    
	public function delete()
	{
		$blog_id 	= $this->uri->segment(3);
		$blog_image 	= $this->model_basic->getValue_condition('ep_blog','bloger_image','','id = '.$blog_id);
		
		$this->model_basic->deleteData('ep_blog', 'id = '.$blog_id);
		
		unlink(FILE_UPLOAD_ABSOLUTE_PATH.'blogger/'.$blog_image);
		
		$this->nsession->set_userdata('succmsg', 'Blog deleted successfully');
		redirect(BACKEND_URL."blog/");
	}
	
    	public function add()
	{
	
		if($this->input->post('action')=='process')
		{
		    $this->form_validation->set_rules('title', 'Title', 'trim|required');
		    $this->form_validation->set_rules('description', 'Description', 'trim|required');
		    $this->form_validation->set_rules('first_name', 'Firstname', 'trim|required');
		    $this->form_validation->set_rules('last_name', 'Lastname', 'trim|required');
		    $this->form_validation->set_rules('qualification', 'Qualification', 'trim|required');		   
		    $this->form_validation->set_rules('designation', 'Designation', 'trim|required');
		    $this->form_validation->set_rules('place', 'Place', 'trim|required');
		    $this->form_validation->set_rules('no_views', 'No of views', 'trim|required');
		    $this->form_validation->set_rules('status', 'Status', 'trim|required');
	
		if ($this->form_validation->run() == TRUE)
		{
			$title		= 	addslashes(trim($this->input->get_post('title')));
			$description	= 	addslashes(trim($this->input->get_post('description')));
			$first_name	= 	addslashes(trim($this->input->get_post('first_name')));
			$last_name	= 	addslashes(trim($this->input->get_post('last_name')));
			$qualification	= 	addslashes(trim($this->input->get_post('qualification')));
			$designation	= 	addslashes(trim($this->input->get_post('designation')));
			$place		= 	addslashes(trim($this->input->get_post('place')));
			$no_views	= 	addslashes(trim($this->input->get_post('no_views')));
			$status		= 	addslashes(trim($this->input->get_post('status')));
			
			if(is_array($_FILES) && COUNT($_FILES)>0)
			{
				$upload_config['field_name']            = 'bloger_image';
				$upload_config['file_upload_path']      = 'blogger/';
				$upload_config['max_size']              = '';
				$upload_config['max_width']             = '';
				$upload_config['max_height']            = '';
				$upload_config['allowed_types']         = 'jpg|jpeg|gif|png';
				$thumb_config['thumb_create']           = false;
				$thumb_config['thumb_file_upload_path'] = 'thumb/';
				$thumb_config['thumb_marker']           = '';
				$thumb_config['thumb_width']            = '200';
				$thumb_config['thumb_height']           = '200';		    
				$sUploaded = image_upload($upload_config, $thumb_config);
				
				if(isset($sUploaded) && count($sUploaded)>0)
				{	    
					$insertArr = array(		    
						    'title'      	=>  $title,
						    'description'	=>   $description,
						    'first_name'    	=>  $first_name,
						    'last_name'     	=>  $last_name,
						    'qualification' 	=>  $qualification,
						    'designation'      	=>  $designation,
						    'place'      	=>  $place,
						    'no_views'     	=>  $no_views,
						    'status'      	=>  $status,
						    'added_on'     	=>  date('Y-m-d H:i:s'),
						    'bloger_image' 	=> $sUploaded
						);                
					
					$insert_new_user = $this->model_basic->insertIntoTable('ep_blog',$insertArr);					
					if($insert_new_user>0)
					    $this->nsession->set_userdata('succmsg', 'Blog added successfully');
				}
				else
				{
					$insertArr = array(		    
						    'title'      	=>  $title,
						    'description'	=>   $description,
						    'first_name'    	=>  $first_name,
						    'last_name'     	=>  $last_name,
						    'qualification' 	=>  $qualification,
						    'designation'      	=>  $designation,
						    'place'      	=>  $place,
						    'no_views'     	=>  $no_views,
						    'status'      	=>  $status,
						    'added_on'     	=>  date('Y-m-d H:i:s'),
						);                
					
					$insert_new_user = $this->model_basic->insertIntoTable('ep_blog',$insertArr);					
					if($insert_new_user>0) 
					    $this->nsession->set_userdata('succmsg', 'Blog added successfully');
				}
			}
			else
			{
				$insertArr = array(		    
						    'title'      	=>  $title,
						    'description'	=>  $description,
						    'first_name'    	=>  $first_name,
						    'last_name'     	=>  $last_name,
						    'qualification' 	=>  $qualification,
						    'designation'      	=>  $designation,
						    'place'      	=>  $place,
						    'no_views'     	=>  $no_views,
						    'status'      	=>  $status,
						    'added_on'     	=>  date('Y-m-d H:i:s')
						);                
					
				$insert_new_user = $this->model_basic->insertIntoTable('ep_blog',$insertArr);					
				if($insert_new_user>0)
				    $this->nsession->set_userdata('succmsg', 'Blog added successfully');				    
			}
			redirect(BACKEND_URL."blog/");
		   }  
		}
	$this->data = '';
	$this->templatelayout->get_topbar();
	$this->templatelayout->get_leftmenu();
	$this->templatelayout->get_footer();
	$this->elements['middle']='blog/add';
	$this->elements_data['middle'] = $this->data;               
	$this->layout->setLayout('layout');
	$this->layout->multiple_view($this->elements,$this->elements_data);        
	}
	
	public function edit()
        {

		$id     = '';
		$id 	= $this->uri->segment(3);
		
		$idArray = array('id' => $id);
		
		$blogDetails = $this->model_blog->get_single($id);
		
		//echo "<pre>";
		//print_r($blogDetails);
		//exit();
        
	
		if(!empty($blogDetails))
		{       
		    $this->data['blog_details'] = $blogDetails;    
		}

		if($this->input->post('action')=='edit')
		{
			$this->form_validation->set_rules('title', 'Title', 'trim|required');
			$this->form_validation->set_rules('description', 'Description', 'trim|required');
			$this->form_validation->set_rules('first_name', 'Firstname', 'trim|required');
			$this->form_validation->set_rules('last_name', 'Lastname', 'trim|required');
			$this->form_validation->set_rules('qualification', 'Qualification', 'trim|required');		   
			$this->form_validation->set_rules('designation', 'Designation', 'trim|required');
			$this->form_validation->set_rules('place', 'Place', 'trim|required');
			$this->form_validation->set_rules('no_views', 'No of views', 'trim|required');
			$this->form_validation->set_rules('status', 'Status', 'trim|required');
		    
			if ($this->form_validation->run() == TRUE)
			{
				$sUploaded = '';
				if(is_array($_FILES) && count($_FILES)>0)
				{
		
				    $upload_config['field_name']        = 'bloger_image';
				    $upload_config['file_upload_path']  = 'blogger/';
				    $upload_config['max_size']          = '';
				    $upload_config['max_width']         = '';
				    $upload_config['max_height']        = '';
				    $upload_config['allowed_types']     = 'jpg|jpeg|gif|png';
				    
				    $thumb_config['thumb_create']       = false;
				    $thumb_config['thumb_file_upload_path'] = 'thumb/';
				    $thumb_config['thumb_marker']       = '';
				    $thumb_config['thumb_width']        = '200';
				    $thumb_config['thumb_height']       = '200';
				
				    $sUploaded = image_upload($upload_config, $thumb_config);
				}
				    if($sUploaded != '')
				    {
					$oldImg = $blogDetails[0]['bloger_image'];
					unlink (FILE_UPLOAD_ABSOLUTE_PATH."blogger/".$oldImg);
					
					$data = array(
						    'bloger_image' =>  $sUploaded
						);
			    
				    }
				    else
				    {
					$data = array(
						    'title'        =>  addslashes(trim($this->input->post('title'))),
						    'alignment'    =>  addslashes(trim($this->input->post('side'))),
						    'is_active'    =>  $this->input->post('status')
						    );
				   }
				
			    $fieldname  = 'id';
			    $updatedRecord = $this->model_common->update_user(ADVERTISEMENT, $data, $fieldname, $id);
			    echo $updatedRecord;
			 
			    
			    if($updatedRecord != 0)
				{
		    
				$this->nsession->set_userdata('succmsg', 'Advertisement information updated successfully');
			       
				}   
				    redirect("advertisement/index");
				    exit;
				}         
			
		}
		
		
		$this->templatelayout->get_topbar();
		$this->templatelayout->get_leftmenu();
		$this->templatelayout->get_footer();
		$this->elements['middle']='blog/edit';
		$this->elements_data['middle'] = $this->data;               
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
    }
    
   
       

	public function category_list(){
		$this->chk_login(); 
        $this->data='';
		$config['base_url'] 	= BACKEND_URL."blog/category_list/";
		$config['per_page'] 	= 10;
		$config['uri_segment']	= 3;
		$config['num_links'] 	= 5;
		$this->pagination->setCustomAdminPaginationStyle($config);
	    $this->data['per_page']			= '';
		
		$this->data['brdLink'][0]['logo']   =   'fa fa-file';
		$this->data['brdLink'][0]['name']   =   'Blog';
		$this->data['brdLink'][0]['link']   =   'javascript:void(0)';
		
		$this->data['brdLink'][1]['logo']   =   'fa fa-file';
		$this->data['brdLink'][1]['name']   =   'Blog Category Listing';
		$this->data['brdLink'][1]['link']   =   'javascript:void(0)';
		
		$start 							= 0;
		$page							= $this->uri->segment(3,0);
		$this->data['categoryList']		= $this->model_blog->getcategoryList($config,$start);
		
		$this->data['startRecord'] 		= $start;
		
		   // $this->data['brdLink']='';
		$this->data['totalRecord'] 		= $config['total_rows'];
		$this->data['per_page'] 		= $config['per_page'];
		$this->data['page']	 			= $page;
		$this->data['controller'] 		= 'blog';	
		$this->data['base_url'] 		= BACKEND_URL.$this->data['controller']."/category_list/0/1/";				
		$this->data['add_link']      	= BACKEND_URL.$this->data['controller']."/category_add/0/".$page."/";
		$this->data['del_link']   	    = BACKEND_URL.$this->data['controller']."/category_delete/{{ID}}/".$page."/";
		$this->data['edit_link']      	= BACKEND_URL.$this->data['controller']."/category_edit/{{ID}}/".$page."/";
		
	
		$this->pagination->initialize($config);
		$this->data['pagination'] = $this->pagination->create_links();
			
		$this->data['succmsg'] = $this->nsession->userdata('succmsg');
		$this->data['errmsg']  = $this->nsession->userdata('errmsg');		
		$this->nsession->set_userdata('succmsg', "");		
		$this->nsession->set_userdata('errmsg', "");
			
		$this->templatelayout->get_topbar();
		$this->templatelayout->get_leftmenu();
		$this->templatelayout->get_footer();
		$this->elements['middle']='blog/category_list';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
	}
	public function category_add(){
		
		if($this->input->post('action') == 'process'){
			$title = $this->input->post('title');
			$slug = $this->input->post('slug');
			$parent_category = $this->input->post('parent_category');
			if($slug==''){
				$slug = strtolower(str_replace(array(' ',',','&','_'),array('-','-','-and-','-'),$title));
			}
			$insertData = array(
								'name' => $title,
								'slug' => $slug,
								'parent_id' => $parent_category,
								'status'=> 'Active',
								'created_at'=> date('Y-m-d H:i:s')
								);
			$this->model_basic->insertIntoTable('ep_blog_categories',$insertData);
			
			$this->nsession->set_userdata('succmsg', 'Category is added successfully');
			       
			redirect("blog/category_list");
		}
		
		$this->data['succmsg'] = $this->nsession->userdata('succmsg');
		$this->data['errmsg']  = $this->nsession->userdata('errmsg');		
		$this->nsession->set_userdata('succmsg', "");		
		$this->nsession->set_userdata('errmsg', "");

		$this->data['categoryList']	= $this->model_blog->getallcategories();
			
		$this->templatelayout->get_topbar();
		$this->templatelayout->get_leftmenu();
		$this->templatelayout->get_footer();
		$this->elements['middle']='blog/category_add';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
	}
	public function category_edit($id){
		if($this->input->post('action') == 'process'){
			$title = $this->input->post('title');
			$slug = $this->input->post('slug');
			$status = $this->input->post('status');
			$parent_category = $this->input->post('parent_category');
			if($slug==''){
				$slug = strtolower(str_replace(array(' ',',','&','_'),array('-','-','-and-','-'),$title));
			}
			$insertData = array(
								'name' => $title,
								'slug' => $slug,
								'parent_id' => $parent_category,
								'status'=> $status
								);
			$this->model_basic->updateIntoTable('ep_blog_categories',array('id'=>$id),$insertData);
			
			$this->nsession->set_userdata('succmsg', 'Category is updated successfully');
			       
			redirect("blog/category_list");
		}
		$this->data['id']=$id;
		$this->data['details']=$this->model_basic->getValues_conditions('ep_blog_categories','','',' id="'.$id.'"');
		$this->data['succmsg'] = $this->nsession->userdata('succmsg');
		$this->data['errmsg']  = $this->nsession->userdata('errmsg');	
		$this->data['categoryList']	= $this->model_blog->getallcategories();	
		$this->nsession->set_userdata('succmsg', "");		
		$this->nsession->set_userdata('errmsg', "");
			
		$this->templatelayout->get_topbar();
		$this->templatelayout->get_leftmenu();
		$this->templatelayout->get_footer();
		$this->elements['middle']='blog/category_edit';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
	}
	public function category_delete($id){
		$this->data['id']=$id;
		$this->data['details']=$this->model_basic->getValues_conditions('ep_blog_categories','','',' id="'.$id.'"');
		if(is_array($this->data['details'])){
			$this->model_basic->deleteData('ep_blog_categories',' id="'.$id.'"');
			
		}
		
		$this->nsession->set_userdata('succmsg', 'Category is deleted successfully');
			       
		redirect("blog/category_list");
	}
	
	public function author_list(){
		$this->chk_login(); 
        $this->data='';
		$config['base_url'] 	= BACKEND_URL."blog/author_list/";
		$config['per_page'] 	= 10;
		$config['uri_segment']	= 3;
		$config['num_links'] 	= 5;
		$this->pagination->setCustomAdminPaginationStyle($config);
	    $this->data['per_page']			= '';
		
		$this->data['brdLink'][0]['logo']   =   'fa fa-file';
		$this->data['brdLink'][0]['name']   =   'Blog';
		$this->data['brdLink'][0]['link']   =   'javascript:void(0)';
		
		$this->data['brdLink'][1]['logo']   =   'fa fa-file';
		$this->data['brdLink'][1]['name']   =   'Blog Author Listing';
		$this->data['brdLink'][1]['link']   =   'javascript:void(0)';
		
		$start 							= 0;
		$page							= $this->uri->segment(3,0);
		$this->data['authorList']		= $this->model_blog->getauthorList($config,$start);
		
		$this->data['startRecord'] 		= $start;
		
		   // $this->data['brdLink']='';
		$this->data['totalRecord'] 		= $config['total_rows'];
		$this->data['per_page'] 		= $config['per_page'];
		$this->data['page']	 			= $page;
		$this->data['controller'] 		= 'blog';	
		$this->data['base_url'] 		= BACKEND_URL.$this->data['controller']."/author_list/0/1/";				
		$this->data['add_link']      	= BACKEND_URL.$this->data['controller']."/author_add/0/".$page."/";
		$this->data['del_link']   	    = BACKEND_URL.$this->data['controller']."/author_delete/{{ID}}/".$page."/";
		$this->data['edit_link']      	= BACKEND_URL.$this->data['controller']."/author_edit/{{ID}}/".$page."/";
		
	
		$this->pagination->initialize($config);
		$this->data['pagination'] = $this->pagination->create_links();
			
		$this->data['succmsg'] = $this->nsession->userdata('succmsg');
		$this->data['errmsg']  = $this->nsession->userdata('errmsg');		
		$this->nsession->set_userdata('succmsg', "");		
		$this->nsession->set_userdata('errmsg', "");
			
		$this->templatelayout->get_topbar();
		$this->templatelayout->get_leftmenu();
		$this->templatelayout->get_footer();
		$this->elements['middle']='blog/author_list';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
	}
	public function author_add(){
		if($this->input->post('action') == 'process'){
			$title = $this->input->post('title');
			$slug = $this->input->post('slug');
			if($slug==''){
				$slug = strtolower(str_replace(array(' ',',','&','_'),array('-','-','-and-','-'),$title));
			}
			$filename='';
			if($_FILES['image']['tmp_name']!=''){
				$file=pathinfo($_FILES['image']['name']);
				$ext = strtolower($file['extension']);
				if($ext!='jpg' and $ext!='png' and $ext!='gif' and $ext!='jpeg'){
					$this->nsession->set_userdata('errmsg', 'Please upload a image file');
					redirect("blog/author_add");
				}
				$filename = md5(microtime()).'.'.$ext;
				
				move_uploaded_file($_FILES['image']['tmp_name'],FILE_UPLOAD_ABSOLUTE_PATH.'blog_author/'.$filename);
			}
			$insertData = array(
								'name' => $title,
								'slug' => $slug,
								'status'=> 'Active',
								'photo'=>$filename,
								'created_at'=> date('Y-m-d H:i:s')
								);
			$this->model_basic->insertIntoTable('ep_blog_author',$insertData);
			
			$this->nsession->set_userdata('succmsg', 'Author is added successfully');
			       
			redirect("blog/author_list");
		}
		
		$this->data['succmsg'] = $this->nsession->userdata('succmsg');
		$this->data['errmsg']  = $this->nsession->userdata('errmsg');		
		$this->nsession->set_userdata('succmsg', "");		
		$this->nsession->set_userdata('errmsg', "");
			
		$this->templatelayout->get_topbar();
		$this->templatelayout->get_leftmenu();
		$this->templatelayout->get_footer();
		$this->elements['middle']='blog/author_add';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
	
	}
	public function author_edit($id){
		
		$this->data['id']=$id;
		$this->data['details']=$this->model_basic->getValues_conditions('ep_blog_author','','',' id="'.$id.'"');
		
		if($this->input->post('action') == 'process'){
			$title = $this->input->post('title');
			$slug = $this->input->post('slug');
			$status = $this->input->post('status');
			if($slug==''){
				$slug = strtolower(str_replace(array(' ',',','&','_'),array('-','-','-and-','-'),$title));
			}
			$filename=$this->data['details'][0]['photo'];
			if($_FILES['image']['tmp_name']!=''){
				$file=pathinfo($_FILES['image']['name']);
				$ext = strtolower($file['extension']);
				if($ext!='jpg' and $ext!='png' and $ext!='gif' and $ext!='jpeg'){
					$this->nsession->set_userdata('errmsg', 'Please upload a image file');
					redirect("blog/author_edit/".$id);
				}
				
				@unlink(FILE_UPLOAD_ABSOLUTE_PATH.'blog_author/'.$filename);
				$filename = md5(microtime()).'.'.$ext;
				move_uploaded_file($_FILES['image']['tmp_name'],FILE_UPLOAD_ABSOLUTE_PATH.'blog_author/'.$filename);
			}
			$insertData = array(
								'name' => $title,
								'slug' => $slug,
								'status'=> $status,
								'photo'=>$filename
								);
			$this->model_basic->updateIntoTable('ep_blog_author',array('id'=>$id),$insertData);
			
			$this->nsession->set_userdata('succmsg', 'Author is updated successfully');
			       
			redirect("blog/author_list");
		}
				
        
		$this->data['succmsg'] = $this->nsession->userdata('succmsg');
		$this->data['errmsg']  = $this->nsession->userdata('errmsg');		
		$this->nsession->set_userdata('succmsg', "");		
		$this->nsession->set_userdata('errmsg', "");
			
		$this->templatelayout->get_topbar();
		$this->templatelayout->get_leftmenu();
		$this->templatelayout->get_footer();
		$this->elements['middle']='blog/author_edit';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
	
	}
	public function author_delete($id){
		$this->data['id']=$id;
		$this->data['details']=$this->model_basic->getValues_conditions('ep_blog_author','','',' id="'.$id.'"');
		if(is_array($this->data['details'])){
			@unlink(FILE_UPLOAD_ABSOLUTE_PATH.'blog_author/'.$this->data['details'][0]['photo']);
			$this->model_basic->deleteData('ep_blog_author',' id="'.$id.'"');
			
		}
		
		$this->nsession->set_userdata('succmsg', 'Author is deleted successfully');
			       
		redirect("blog/author_list");
	}

}
?>