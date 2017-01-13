<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Examination extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('model_examination_list','model_basic'));
	}
	
	public function index()
	{
            $this->chk_login();
	    $this->data = '';          
            
        //<!-----------------code---------------------->
		$student_id		= $this->uri->segment(5);
		$config['base_url'] 	= BACKEND_URL."examination/index/0/0/".$student_id.'/';
		$config['per_page'] 	= PER_PAGE_LISTING;
		$config['uri_segment']	= 6;
		$config['num_links'] 	= 5;
		$this->pagination->setCustomAdminPaginationStyle($config);
		
		$this->data['search_keyword']	= '';
		$this->data['per_page']		= '';
		$this->data['params']		= $this->nsession->userdata('EXAM');
		$this->data['student_id'] 	= $student_id;
		
		if($this->input->get_post('is_show_all') == 1)
		{
		    $this->nsession->set_userdata('EXAM','');
		    $this->data['search_keyword'] 	= '';
		    
		}
		elseif($this->input->get_post('search_keyword') == '' && $this->input->get_post('per_page') == '')
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
		$this->data['examination_all']		= $this->model_examination_list->getAllExamList($config,$start);
		//pr($this->data['examination_all']);
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
		$this->data['base_url'] 		= BACKEND_URL."examination/index/0/0/".$student_id.'/';
		$this->data['show_all']      		= BACKEND_URL.$this->data['controller']."/index/0/0".$student_id.'/';
		$this->data['view_link']      		= BACKEND_URL."examination/view_exam/".$student_id."/".$page."/";
		$this->data['delete_link']     		= BACKEND_URL."examination/delete_exam/".$student_id."/".$page."/";
		    
		//pr($config,0);
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
		$this->elements['middle']='examinationView/resultlist';
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
        }
	
	public function view_exam()
	{
	  $examination_id = $this->uri->segment(5);
	  
	    $this->data['exam_details'] = $this->model_examination_list->getDetails($examination_id);
	    $this->data['studentId'] = $this->uri->segment(3);
	    $this->data['examId'] = $this->uri->segment(5);
	  //pr($this->data['exam_details']);  
	    
	    
	    $this->templatelayout->get_topbar();
	    $this->templatelayout->get_leftmenu();
	    $this->templatelayout->get_footer();
	    $this->elements['middle']='userstudent/exam_list';
	    $this->elements_data['middle'] = $this->data;			    
	    $this->layout->setLayout('layout');
	    $this->layout->multiple_view($this->elements,$this->elements_data);  
	    
	}
}
?>