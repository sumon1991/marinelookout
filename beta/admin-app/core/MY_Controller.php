<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	public function __construct()
	{	
        parent::__construct();
        $this->load->model('model_basic');
    	$this->load->model('model_common');
	}

	public function chk_login()
	{
		$user_id = $this->nsession->userdata('USER_ID');
		if( $user_id == '' || $user_id < 0 )
		{
			redirect(base_url()."login/");
			return false;
		}
		else
		{
			$permited_module = explode(',',$this->nsession->userdata('MODULES'));
			//pr($permited_module);
			$current_module  = $this->model_basic->getValue_condition('ep_menu','id','','controller_name = "'.$this->router->fetch_class().'"');
			//if(in_array($current_module,$permited_module))
			//	return true;
			//else
			//{
			//	echo 'You dont have permission to access this page. Click <a href="'.BACKEND_URL.'dashboard/">Here</a> to go to Dashboard.';
			//	exit;
			//}
		}
		return true;
	}
	
	
	
}