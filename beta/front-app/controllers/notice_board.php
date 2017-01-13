<?php
class Notice_board extends MY_Controller{

    public function __construct(){
  		parent:: __construct();
		$this->load->model(array('model_home','model_common','model_administrator', 'model_blog_with_category'));
	 	$this->load->helper('text');
    }
    
    public function index()
    {	
    	$slug 		= $this->uri->segment(1);
		$noticeid 	= $this->uri->segment(2);
		$recent_notice = $this->model_blog_with_category->recentNotices();
		
		$idArray = array('noticeid' => $noticeid);
		
		$noticeDetails = $this->model_blog_with_category->get_single_notice($idArray);
		// print_r($blogDetails['']);
		// die;
    	$this->data 						= '';
		$this->data['notice_details'] 		= $noticeDetails;
		$this->data['all_notice'] 			= $recent_notice;
		$this->data['popular_post_details']	= $this->model_blog_with_category->popularPosts();
    	$this->data['quick_links']          = $this->model_blog_with_category->getAllQuickLinks();
    	$this->data['treeview']          	= $this->model_blog_with_category->getCategoryTree(0);
		$this->templatelayout->header();
		$this->templatelayout->footer();	
		$this->elements['middle']	=	'notice_board/index';			
		$this->elements_data['middle'] 	= 	$this->data;		    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
    }
}
?>