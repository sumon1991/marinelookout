<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('model_administrator','model_common'));
	}
	
	public function index()
	{
		$this->chk_login();
		$this->data			= array();
		$this->data['total_editor']	= $this->model_basic->getValues_conditions('ep_admin', array('COUNT(*) as no_of_editor'),'','role = "editor" AND is_active = "active"');
		$this->data['total_student']	= $this->model_basic->getValues_conditions('ep_student', array('COUNT(*) as no_of_student'),'','is_active = "yes"');
		$this->data['total_subject']	= $this->model_basic->getValues_conditions('ep_subject', array('COUNT(*) as no_of_subject'),'','is_active = "yes"');
		$this->data['total_question']	= $this->model_basic->getValues_conditions('ep_question', array('COUNT(*) as no_of_question'),'','is_active = "yes"');		
		$this->data['subjects']		= $this->model_administrator->getSubjectList();
		$this->data['questions']	= $this->model_basic->getValues_conditions('ep_question', '', '', 'is_active = "yes"');		
		$this->templatelayout->get_topbar();
		$this->templatelayout->get_leftmenu();
		$this->templatelayout->get_footer();
		$this->elements['middle']='dashboard/dashboard';
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);

	}
 	public function logout()
 	{

		$this->nsession->destroy();
		redirect(BACKEND_URL);
 	}


}
?>