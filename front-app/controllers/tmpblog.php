<?php
class Tmpblog extends MY_Controller{

    public function __construct(){
        parent:: __construct();
		$this->load->library('pagination');
    }
    
    public function index()
    {
		
	$this->data = '';
	$config['base_url'] 	= BACKEND_URL."blog/author_list/";
	$config['per_page'] 	= 10;
	$config['uri_segment']	= 3;
	$config['num_links'] 	= 5;
	$this->pagination->setCustomAdminPaginationStyle($config);
	$this->data['per_page']			= '';
	$this->data['recentBlog'] = $this->getposts($config,$start);
	
	$this->pagination->initialize($config);
	$this->data['pagination'] = $this->pagination->create_links();
	$this->data['category']=$this->model_basic->getValues_conditions('ep_blog_categories', array(), '', "status = 'Active'");
	$this->data['recentBlog'] = $this->getposts($config,$start);
	$this->templatelayout->header();
	$this->templatelayout->footer();
	
	$this->elements['middle']='blog/index';
	$this->elements_data['middle'] = $this->data;			    
	$this->layout->setLayout('layout');
	$this->layout->multiple_view($this->elements,$this->elements_data);        
    }
	
	public function getposts(&$config,&$start)
	{		
		$page 		= $this->uri->segment(3,0); //page
		$isSession	= $this->uri->segment(4); // read data from SESSION or POST     (1 == POST , 0 = SESSION )
		
		$start 		= 0;
		$search_keyword	= '';
		$per_page	= '';
		
		
		
		$sql=" SELECT COUNT(*) as TotalrecordCount FROM ep_blog_posts where post_status = 'Publish'";
		
		$rs = $this->db->query($sql);		
		$config['total_rows'] = 0;
		
		$rec = $rs->row_array();
		$config['total_rows'] = $rec['TotalrecordCount'];
		
		if($page > 0 && $page < $config['total_rows'] )
			$start = $page;
		
		$config['start'] = $start;
		$sql = "SELECT * FROM ep_blog_posts  where post_status = 'Publish'
			ORDER BY id DESC
			LIMIT ".$start.",".$config['per_page'];
		
		$rs = $this->db->query($sql);
		
		$rec = false;
		
		if($rs->num_rows())
			$rec = $rs->result_array();
		
		return $rec;
	}


}
?>