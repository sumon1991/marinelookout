<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Exam extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_exam');
	}
	
	public function index()
	{
            $this->chk_login();
	    $this->data = '';          
            
        //<!-----------------code---------------------->
            
		$config['base_url'] 	= BACKEND_URL."exam/index/";
		$config['per_page'] 	= 20;
		$config['uri_segment']	= 3;
		$config['num_links'] 	= 5;
		$this->pagination->setCustomAdminPaginationStyle($config);
		
		$this->data['search_keyword']	= '';
		$this->data['per_page']		= '';
		$this->data['params']		= $this->nsession->userdata('EXAM');
		
		if($this->input->get_post('search_keyword') == '' && $this->input->get_post('per_page') == '')
		{	
			$this->data['search_keyword'] = $this->data['params']['search_keyword'];
			$this->data['per_page']	= $this->data['params']['per_page'];
		}
		else 
		{
			$this->data['search_keyword']	= $this->input->get_post('search_keyword',true);
			$this->data['per_page'] 	= $this->input->get_post('per_page',true);	
		}
		$start 					= 0;
		$page 					= $this->uri->segment(3,0);
		$this->data['examList']		= $this->model_exam->getAllExamList($config,$start);
		
		$i=0;
		//For breadcrump..........
		
		$this->data['brdLink'][0]['logo']   =   'fa fa-envelope';
		$this->data['brdLink'][0]['name']   =   'Exam';
		$this->data['brdLink'][0]['link']   =   'javascript:void(0)';
		
		$this->data['brdLink'][1]['logo']   =   'fa fa-question';
		$this->data['brdLink'][1]['name']   =   'Exam List';
		$this->data['brdLink'][1]['link']   =   'javascript:void(0)';
		
		//........................

		
		//pr($this->data['latestEnquiry'],1);
		$this->data['startRecord'] 		= $start;
                //$this->data['totalRecord'] =0;
		$this->data['totalRecord'] 		= $config['total_rows'];
		$this->data['per_page'] 		= $config['per_page'];
		$this->data['page']	 		= $page;
		$this->data['controller'] 		= 'exam';	
		$this->data['base_url'] 		= BACKEND_URL."exam/index/0/1/";
		$this->data['show_all']      		= BACKEND_URL.$this->data['controller']."/index/";
		$this->data['view_link']      		= BACKEND_URL."exam/view_exam/{{ID}}/".$page."/";
		$this->data['delete_link']     		= BACKEND_URL."exam/delete_exam/{{ID}}/".$page."/";

		$this->pagination->initialize($config);
		$this->data['pagination'] = $this->pagination->create_links();		
		$this->data['succmsg'] = $this->nsession->userdata('succmsg');
		$this->data['errmsg'] = $this->nsession->userdata('errmsg');
		$this->nsession->set_userdata('succmsg', "");		
		$this->nsession->set_userdata('errmsg', "");
            
            //<!-----------------code-end--------------------->
            
            $this->templatelayout->get_topbar();
	    $this->templatelayout->get_leftmenu();
	    $this->templatelayout->get_footer();
	    $this->elements['middle']='exam/list';
	    $this->elements_data['middle'] = $this->data;			    
	    $this->layout->setLayout('layout');
	    $this->layout->multiple_view($this->elements,$this->elements_data);
        }
	
	
}
?>