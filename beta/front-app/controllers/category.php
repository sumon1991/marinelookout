<?php
class Category extends MY_Controller{

    public function __construct(){
  		parent:: __construct();
		$this->load->model(array('model_home','model_common','model_administrator', 'model_blog_with_category'));
	 	$this->load->helper('text');
	 	$this->load->library('pagination');
    }
    
    public function index($offset)
    {	
    	$slug 	= $this->uri->segment(1);
		$catid 	= $offset = $this->uri->segment(2);
		$blogid = $this->uri->segment(3);
		$recent_notice = $this->model_blog_with_category->recentNotices();
		
		if($catid && $blogid) {
			$idArray = array('catid' => $catid, 'blogid' => $blogid);
			
			$blogDetails = $this->model_blog_with_category->get_single($idArray);
			// print_r($blogDetails['']);
			// die;
	    	$this->data 						= '';
			$this->data['blog_details'] 		= $blogDetails;
			$this->data['all_notice'] 			= $recent_notice;
			$this->data['popular_post_details']	= $this->model_blog_with_category->popularPosts();
        	$this->data['quick_links']          = $this->model_blog_with_category->getAllQuickLinks();
        	$this->data['treeview']          	= $this->model_blog_with_category->getCategoryTree(0);
			$this->templatelayout->header();
			$this->templatelayout->footer();	
			$this->elements['middle']	=	'category/index';			
			$this->elements_data['middle'] 	= 	$this->data;		    
			$this->layout->setLayout('layout');
			$this->layout->multiple_view($this->elements,$this->elements_data);
		} else {
			if($this->uri->segment(2) != ''){
				$page = $this->uri->segment(2);
			} else {
				$page = 0;
			}
			$config                 = array();
		    $config["base_url"]     = FRONTEND_URL.$slug.'/';
		    $config["total_rows"]   = $this->model_blog_with_category->count_total_row($slug);
		    $config["per_page"]     = 8;
		    $config['uri_segment']  = 2;
		    $this->pagination->initialize($config);

		    $this->data['all_details']  = $this->model_blog_with_category->get_slug_page($slug, $config["per_page"], $page);
		    $this->data["links"]    = $this->pagination->create_links();
		    $this->data['all_notice'] 			= $recent_notice;
			$this->data['popular_post_details']	= $this->model_blog_with_category->popularPosts();
        	$this->data['quick_links']          = $this->model_blog_with_category->getAllQuickLinks();
        	$this->data['treeview']          	= $this->model_blog_with_category->getCategoryTree(0);
			
			$this->templatelayout->header();
			$this->templatelayout->footer();	
			$this->elements['middle']	=	'category/details';			
			$this->elements_data['middle'] 	= 	$this->data;		    
			$this->layout->setLayout('layout');
			$this->layout->multiple_view($this->elements,$this->elements_data);

		    // ===
			// $countrow = $this->model_blog_with_category->count_total_row($slug);
			// $config['base_url'] = FRONTEND_URL.$slug.'/';
			// $config['total_rows'] = $countrow;
			// $config['per_page'] = 2;
			// $this->pagination->initialize($config);
			// if(!$offset){
			// 	$offset = 1;
			// }
			// $slugDetails = $this->model_blog_with_category->get_slug_page($slug, $config['per_page'], $offset);

			// $this->data 						= '';
			// $this->data['all_details'] 			= $slugDetails;
			// $this->data['all_notice'] 			= $recent_notice;
			// $this->data['popular_post_details']	= $this->model_blog_with_category->popularPosts();
   //      	$this->data['quick_links']          = $this->model_blog_with_category->getAllQuickLinks();
   //      	$this->data['treeview']          	= $this->model_blog_with_category->getCategoryTree(0);
			
			// $this->templatelayout->header();
			// $this->templatelayout->footer();	
			// $this->elements['middle']	=	'category/details';			
			// $this->elements_data['middle'] 	= 	$this->data;		    
			// $this->layout->setLayout('layout');
			// $this->layout->multiple_view($this->elements,$this->elements_data);
		}     
    }
}
?>