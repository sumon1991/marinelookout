<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Notification extends MY_Controller {

	public function __construct()
	{
		parent::__construct();		
		$this->load->model(array('model_notification','model_basic'));

	}


	// LIST EDITOR USER
	public function index()
	{ 
		$this->chk_login(); 
		$this->data='';
		$this->data['startRecord'] 	= 0;
		$this->data['per_page']         = PER_PAGE_LISTING;
		$this->data['search_keyword']   = trim($this->input->post('search_keyword'))?trim($this->input->post('search_keyword')):'';
		
		$condition = $this->data['search_keyword']?" message like '%".$this->data['search_keyword']."%' OR added_on like '%".$this->data['search_keyword']."%' ":"";
		$total_record = $this->model_basic->getValues_conditions('ep_notifications', array('count(*) as count'),'', $condition);
		$this->data['totalRecord']  = $total_record && isset($total_record[0]['count'])?$total_record[0]['count']:0;
		
		$this->data['records'] = $this->model_notification->getList($this->data['search_keyword'],$this->uri->segment(3,0));
		
		$config['base_url'] 			= BACKEND_URL."notification/index/";
		$config['total_rows']           	= $this->data['totalRecord'];
		$config['per_page'] 			= $this->data['per_page'];
		$config['uri_segment']  		= 3;
		$config['num_links'] 			= 5;
	
		$this->pagination->setCustomAdminPaginationStyle($config);
		$this->pagination->initialize($config);
		$this->data['pagination']       = $this->pagination->create_links();

		$this->data['succmsg'] = $this->nsession->userdata('succmsg');
		$this->nsession->set_userdata('succmsg','');
		$this->data['errmsg'] = $this->nsession->userdata('errmsg');
		$this->nsession->set_userdata('errmsg','');
		$this->templatelayout->get_topbar();
		$this->templatelayout->get_leftmenu();
		$this->templatelayout->get_footer();
		$this->elements['middle']='notification/list';
		$this->elements_data['middle'] = $this->data;             
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);

	}
	
	public function send(){
		$this->data = '';
		if($this->input->post()){
			$this->form_validation->set_rules('user_ids[]', 'Student Name', 'trim|required');
			$this->form_validation->set_rules('notification_message', 'Notification Message', 'trim|required');
			
			if ($this->form_validation->run() == TRUE){
				
				$insertArr = array(
								   'user_ids' => implode(',',$this->input->post('user_ids')),
								   'message'  => mysql_real_escape_string($this->input->post('notification_message')),
								   'added_on' => date('Y-m-d H:i:s'),
								   );
				$insert = $this->model_basic->insertIntoTable('ep_notifications',$insertArr);
				if($insert){
					$this->nsession->set_userdata('succmsg','Notification successfully sent');
					redirect(BACKEND_URL . 'notification/index');
				}
			}
		}
		
		 
		
		$this->data['students'] = $this->model_basic->getValues_conditions('ep_student', '', '', 'is_active="yes"','CONCAT(firstname," ",lastname)', 'ASC');
		
		$this->data['succmsg'] = $this->nsession->userdata('succmsg');
		$this->nsession->set_userdata('succmsg','');
		$this->data['errmsg'] = $this->nsession->userdata('errmsg');
		$this->nsession->set_userdata('errmsg','');
		$this->templatelayout->get_topbar();
		$this->templatelayout->get_leftmenu();
		$this->templatelayout->get_footer();
		$this->elements['middle']='notification/add';
		$this->elements_data['middle'] = $this->data;             
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
	}
	
	public function view(){
		$id = $this->uri->segment(3);
		if(!$id) redirect(BACKEND_URL.'notification/index');
		
		$this->data = '';
		
		$this->data['record'] = $this->model_basic->getValues_conditions('ep_notifications', '', '', 'id='.$id);
		$user_ids_arr = explode(',',$this->data['record'][0]['user_ids']);
		$user_name_arr = array();
		foreach($user_ids_arr as $user_id){
			$student = $this->model_basic->getValues_conditions('ep_student', '', '', 'id='.$user_id);
			$user_name_arr[] = $student[0]['firstname'] .' '. $student[0]['lastname'];
		}
		$this->data['students_name'] = $user_name_arr;
		
		$this->data['succmsg'] = $this->nsession->userdata('succmsg');
		$this->nsession->set_userdata('succmsg','');
		$this->data['errmsg'] = $this->nsession->userdata('errmsg');
		$this->nsession->set_userdata('errmsg','');
		$this->templatelayout->get_topbar();
		$this->templatelayout->get_leftmenu();
		$this->templatelayout->get_footer();
		$this->elements['middle']='notification/view';
		$this->elements_data['middle'] = $this->data;             
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
		
	}

}

?>