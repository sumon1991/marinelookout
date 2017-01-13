<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	public function __construct()
	{	
            parent::__construct();
	}

	public function chk_login()
	{
		$user_id = $this->session->userdata('student_id');
		if( $user_id == '' || $user_id < 0 )
		{
			redirect(base_url()."sign_up");
			return false;
		}
		return true;
	}
	
}