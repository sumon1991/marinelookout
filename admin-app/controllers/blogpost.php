<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/*
---------------------------------
STUDENT CONTROLLER
---------------------------------
*/

class Blogpost extends MY_Controller {

	public function __construct()
	{
		parent::__construct();		
		$this->load->model(array('model_basic','model_blogpost'));
		$this->load->helper("file");
	}
	
	// LIST STUDENT USER
	
	public function index()
	{ 
		$this->chk_login();
		$data = array();
		$data['blog_post_all'] 		= array();
		$data['pagination'] 		= array();
		$data['search_keyword'] 	= "";
		$data['per_page']       	= PER_PAGE_LISTING;
		$start                  	= 0;
		$data['startRecord']    	= $start;
		$data['page']           	= $this->uri->segment(3);
		$data['search_keyword'] 	= "";
		$data['params']  		= $this->nsession->userdata('BLOGPOST_SEARCH');
		//pr($_POST);
		if($this->input->get_post('is_show_all') == 1)
		{
		    $this->nsession->set_userdata('BLOGPOST_SEARCH','');
		    $data['search_keyword'] 	= '';
		    $data['per_page'] 		= $data['per_page'];
		}
		elseif(trim($this->input->get_post('search_keyword')) == '' && trim($this->input->get_post('per_page')) == '' && $this->nsession->userdata('BLOGPOST_SEARCH') == '' )
		{
		    $data['search_keyword'] 	= $data['search_keyword'];
		    $data['per_page'] 		= $data['per_page'];
		}
		else 
		{
			if($this->input->get_post('search_keyword',true) != '')
				$data['search_keyword']   = trim($this->input->get_post('search_keyword',true));
			else	
				$data['search_keyword']   = $this->nsession->userdata('BLOGPOST_SEARCH');
				
			$data['per_page']         = $this->input->get_post('per_page',true);   
		}
        
		
		/*
		-------------------------------------
		BEGIN :: PAGINATION
		-------------------------------------
		*/
		
		$total_blog_post	= $this->model_blogpost->countBlogPostDB($data['search_keyword']);
		$data['totalRecord'] 	= $total_blog_post;
		
		if($total_blog_post > 0) {
		
		$config['base_url'] 	= base_url().'/blogpost/index';
		$config['per_page'] 	= PER_PAGE_LISTING;
		$config['total_rows']	= $total_blog_post;
			
		if($this->uri->segment(2))
			{
                $config['uri_segment'] = 2;
				
                if(!is_numeric($this->uri->segment(2)))
			$offset = 0;
                }else{
			
                    $offset = abs(ceil($this->uri->segment(2)));
                }
		}else{
			$offset = 0;
		}
			
		$search_by = '';
		$resultArr = $this->model_blogpost->allBlogPostDB($data['search_keyword'], PER_PAGE_LISTING, $offset);
		//pr($resultArr);

		if(count($resultArr) > 0)
			{
                $num = 1+$offset;
				foreach($resultArr as $values)
				{
					$id      	= $values['id'];
					$status		= $values['post_status'];
					$status_class	= ($status == 'Publish') ? 'label-green' : 'label-red';    
					
					// GET GENERATE EDIT AND DELETE LINK
					
					$this->uri_segment  = $this->uri->total_segments();
					$cur_page           = 0;
					
					if ($this->uri->segment($this->uri_segment) != 0) {
						$this->cur_page = $this->uri->segment($this->uri_segment);
						$cur_page 		= (int) $this->cur_page;
					}
					
					$edit_link    		= base_url()."blogpost/edit/".$id."/".$cur_page."/";
					$delete_link  		= base_url()."blogpost/delete/".$id."/".$cur_page."/";
					
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
									'delete_link'       => $delete_link,
									'author'	    => $this->model_basic->getValue_condition('ep_blog_author','name','','id="'.$values['post_author'].'"'),
									'cat_name'	    => $this->model_basic->getValue_condition('ep_blog_categories','name','','id="'.$values['category_id'].'"')	
									)
						);
					$num++;

                }

                $data['blog_post_all'] = $total_result;
                //pr($data['subject_all']);
				
                
                $config['cur_tag_open']     = '<span class="current-link">';
                $config['cur_tag_close']    = '</span>';
		$this->pagination->setCustomAdminPaginationStyle($config);
                $this->pagination->initialize($config);
                $data['pagination']         = $this->pagination->create_links();
		}
        //pr($data);
		
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
		$this->elements['middle']='blogpost/list';
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
	        $this->form_validation->set_rules('category_id', 'Category', 'trim|required');
	        $this->form_validation->set_rules('post_author', 'Post Author', 'trim|required');
			$this->form_validation->set_rules('post_content', 'Post Content', 'trim|required');
			$this->form_validation->set_rules('post_title', 'Post Title', 'trim|required');
			$this->form_validation->set_rules('post_slug', 'Slug ', 'trim|required');
			$this->form_validation->set_rules('post_short_des', 'One Line Description ', 'trim|required');
			date_default_timezone_set('Asia/Kolkata');


	        // Form validation
			$upload_config['field_name']		= 'featured_image';
			$upload_config['file_upload_path'] 	= 'blogpost/';
			$upload_config['max_size']		= '';
			$upload_config['max_width']		= '';
			$upload_config['max_height']		= '';
			$upload_config['allowed_types']		= 'jpg|jpeg|gif|png';
			
			$thumb_config['thumb_create']		= true;
			$thumb_config['thumb_file_upload_path']	= 'thumb/';
			$thumb_config['thumb_marker']		= '';
			$thumb_config['thumb_width']		= '304';
			$thumb_config['thumb_height']		= '138';
			
			$sUploaded = image_upload($upload_config, $thumb_config);


			if(isset($sUploaded) && count($sUploaded)>0)
			{
				if ($this->form_validation->run() == TRUE)
				{    

					// echo $this->input->post('post_content');
					// die;
				$popular = '0';
				// $cat_id = 0;

				// if($this->input->post('category_id') != '' && $this->input->post('first_sub_cat') != '' && $this->input->post('second_sub_cat') == '' && $this->input->post('third_sub_cat') == ''){
				// 	$cat_id = $this->input->post('first_sub_cat');
				// } else if($this->input->post('category_id') != '' && $this->input->post('first_sub_cat') != '' && $this->input->post('second_sub_cat') != '' && $this->input->post('third_sub_cat') == ''){
				// 	$cat_id = $this->input->post('second_sub_cat');
				// } else if($this->input->post('category_id') != '' && $this->input->post('first_sub_cat') != '' && $this->input->post('second_sub_cat') != '' && $this->input->post('third_sub_cat') != ''){
				// 	$cat_id = $this->input->post('third_sub_cat');
				// } else {
				// 	$cat_id = $this->input->post('category_id');
				// }

				$data = array(
						
						'category_id'	=>	$this->input->post('category_id'),
						'sub_cat_id' 	=> 	$this->input->post('first_sub_cat'),
						'sub_sub_cat_id'=> 	$this->input->post('second_sub_cat'),
						'sub_sub_sub_cat_id'=> 	$this->input->post('third_sub_cat'),
						'post_author'	=>	$this->input->post('post_author'),
						'post_content'	=>	$this->input->post('post_content'),
						'post_short_des'	=>	$this->input->post('post_short_des'),

						//'post_content'	=>	addslashes(trim(ucwords($this->input->post('post_content')))),
						 // 'post_content' 	=> trim(addslashes(htmlspecialchars( html_entity_decode(ucwords($this->input->post('post_content'), ENT_QUOTES, 'UTF-8'), ENT_QUOTES, 'UTF-8' ))),
						'featured_image'=>  	$sUploaded,
						'popular_post' => $popular,
						'post_title'	=> 	$this->input->post('post_title'),
						'post_slug'	=> 	trim(strtolower(preg_replace('/\s+/', '_', $this->input->post('post_slug')))),
						'created_at'	=> 	date('Y-m-d H:s:i'),
					);
				// print_r($data);
				// die;
				// if($this->input->post('post_slug') != ''){
				// 	$data['post_slug'] = $this->input->post('post_slug');
				// }
				
				$insert_new = $this->model_basic->insertIntoBlogTable('ep_blog_posts',$data);
					//echo $insert_new_user;
					
					if($insert_new > 0)
					{ 	
						$this->nsession->set_userdata('succmsg', 'Blog Post added successfully');
						redirect("blogpost/index");
					}
				}	        
			}
		}
		$data = '';
		$data['author_list'] 	= $this->model_basic->getValues_conditions('ep_blog_author');
		$data['category_list'] 	= $this->model_basic->getValues_conditions('ep_blog_categories', '', '', 'parent_id=0');
		$this->templatelayout->get_topbar();
		$this->templatelayout->get_leftmenu();
		$this->templatelayout->get_footer();
		$this->elements['middle']='blogpost/add';
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
		$executeQuery 		= $this->model_basic->getValues_conditions('ep_blog_posts','','',"id='".$id."'");
		$imageNameToRemove 	= $executeQuery[0]['featured_image'];
		
		$fieldname 		= 'id';
		$deleteRecord 		= $this->model_basic->deleteData('ep_blog_posts', "id='".$id."'");

		if($deleteRecord==1 && $imageNameToRemove!= '' && $imageNameToRemove != 0){	
		if(file_exists(FILE_UPLOAD_ABSOLUTE_PATH."blogpost/".$imageNameToRemove) && $imageNameToRemove != ''){
		unlink (FILE_UPLOAD_ABSOLUTE_PATH."blogpost/".$imageNameToRemove);
		}
		if(file_exists(FILE_UPLOAD_ABSOLUTE_PATH."blogpost/thumb/".$imageNameToRemove) && $imageNameToRemove != ''){
		unlink (FILE_UPLOAD_ABSOLUTE_PATH."blogpost/thumb/".$imageNameToRemove);
		}
		}
		$this->nsession->set_userdata('succmsg', 'Blog Post deleted successfully');
		redirect('blogpost/index');
	}


	// UPDATE STUDENT USER
	public function edit()
	{
		$this->chk_login();
		$id 				= $this->uri->segment(3);
		$idArray 			= array('id'=>$id);
		$this->data['blogPostList'] 	= array();
		$blogPostListArray 		= $this->model_basic->getValues_conditions('ep_blog_posts','','',"id='".$id."'");
		$this->data['author_list'] 		= $this->model_basic->getValues_conditions('ep_blog_author');
		$this->data['category_list'] 	= $this->model_basic->getValues_conditions('ep_blog_categories', '', '', 'parent_id=0');
		if(!empty($blogPostListArray))
		{		
			$this->data['blogPostList'] = $blogPostListArray;	
		}
		if($this->input->post('action')=='edit')
		{
				
			$this->form_validation->set_rules('category_id', 'Category', 'trim|required');
			$this->form_validation->set_rules('post_author', 'Post Author', 'trim|required');
			$this->form_validation->set_rules('post_content', 'Post Content', 'trim|required');
			$this->form_validation->set_rules('post_title', 'Post Title', 'trim|required');
			$this->form_validation->set_rules('post_slug', 'Slug ', 'trim|required');
			$this->form_validation->set_rules('post_short_des', 'One Line Description ', 'trim|required');

		    if ($this->form_validation->run() == TRUE)
		    {
				if(is_array($_FILES) && COUNT($_FILES)>0)
				{
					$upload_config['field_name']			= 'featured_image';
					$upload_config['file_upload_path'] 		= 'blogpost/';
					$upload_config['max_size']			= '';
					$upload_config['max_width']			= '';
					$upload_config['max_height']			= '';
					$upload_config['allowed_types']			= 'jpg|jpeg|gif|png';
					
					$thumb_config['thumb_create']			= true;
					$thumb_config['thumb_file_upload_path']		= 'thumb/';
					$thumb_config['thumb_marker']			= '';
					$thumb_config['thumb_width']			= '304';
					$thumb_config['thumb_height']			= '138';			
					$sUploaded = image_upload($upload_config, $thumb_config);
				}	
				if($sUploaded != '')
				{

					$oldImg = $blogPostListArray[0]['featured_image'];
					if(file_exists(FILE_UPLOAD_ABSOLUTE_PATH."blogpost/".$oldImg) && $oldImg != ''){
					unlink (FILE_UPLOAD_ABSOLUTE_PATH."blogpost/".$oldImg);
					}
					if(file_exists(FILE_UPLOAD_ABSOLUTE_PATH."blogpost/thumb/".$oldImg) && $oldImg != ''){
					unlink (FILE_UPLOAD_ABSOLUTE_PATH."blogpost/thumb/".$oldImg);
					}
					if($this->input->post('popular_post') == '1'){
						$popular = '1';
					} else {
						$popular = '0';
					}
					$data = array(
						'id'			=> $id,
						'category_id'	=>	$this->input->post('category_id'),
						'sub_cat_id' 	=> 	$this->input->post('first_sub_cat')?$this->input->post('first_sub_cat'):0,
						'sub_sub_cat_id'=> 	$this->input->post('second_sub_cat')?$this->input->post('second_sub_cat'):0,
						'sub_sub_sub_cat_id'=> 	$this->input->post('third_sub_cat')?$this->input->post('third_sub_cat'):0,
						'post_author'	=>	$this->input->post('post_author'),
						'post_content'	=>	$this->input->post('post_content'),
						'post_short_des'	=>	$this->input->post('post_short_des'),
						//'post_content'	=>	addslashes(trim(ucwords($this->input->post('post_content')))),
						'featured_image'=>  	$sUploaded,
						'post_title'	=> 	$this->input->post('post_title'),
						'post_slug'	=> 	trim(strtolower(preg_replace('/\s+/', '_', $this->input->post('post_slug')))),
						'post_status'	=> 	$this->input->post('post_status'),
						'popular_post' 	=> $popular
					);
				
				}
				else
				{
					if($this->input->post('popular_post') == '1'){
						$popular = '1';
					} else {
						$popular = '0';
					}

					$data = array(
						'id'			=> $id,
						'category_id'	=>	$this->input->post('category_id'),
						'sub_cat_id' 	=> 	$this->input->post('first_sub_cat')?$this->input->post('first_sub_cat'):0,
						'sub_sub_cat_id'=> 	$this->input->post('second_sub_cat')?$this->input->post('second_sub_cat'):0,
						'sub_sub_sub_cat_id'=> 	$this->input->post('third_sub_cat')?$this->input->post('third_sub_cat'):0,
						'post_author'	=>	$this->input->post('post_author'),
						'post_content'	=>	$this->input->post('post_content'),
						'post_short_des'	=>	$this->input->post('post_short_des'),
						//'post_content'	=>	addslashes(trim(ucwords($this->input->post('post_content')))),
						'post_title'	=> 	$this->input->post('post_title'),
						'post_slug'	=> 	trim(strtolower(preg_replace('/\s+/', '_', $this->input->post('post_slug')))),
						'post_status'	=> 	$this->input->post('post_status'),
						'popular_post' 	=> $popular
					);
				}
				// if($this->input->post('post_slug') != ''){
				// 	$data['post_slug'] = $this->input->post('post_slug');
				// }
			        // pr($data);	
				$updatedRecord = $this->model_basic->updateIntoBlogTable('ep_blog_posts', array('id'=>$id),$data);
				
				//if($updatedRecord != 0)
				//{
					$this->nsession->set_userdata('succmsg', 'Blog Post information updated successfully');
					redirect("blogpost/index");
					exit;
				//}				
			}
		}	
	    $this->templatelayout->get_topbar();
	    $this->templatelayout->get_leftmenu();
	    $this->templatelayout->get_footer();
	    $this->elements['middle']='blogpost/edit';
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

    public function getsubcategory()
    {
    	$parent_id=$this->input->post('parentid');
        $table='ep_blog_categories';
        $where=array('parent_id' => $parent_id);
        $data['sc_get']=$this->model_blogpost->get_subcat_data($table,$where);
        $sc=json_encode($data['sc_get']);
        echo $sc;
    }
}
?>